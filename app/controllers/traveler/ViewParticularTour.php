<?php

class ViewParticularTour extends Controller
{

    private $tourguideModel;
    private $tourPackagesModel;
    private $tourPackageImagesModel;
    private $tourPackageItineraryModel;
    private $tourPackageActivitiesModel;
    private $tourGuideUnavailabilityModel;
    private $tourBookingModel;
    private $notificationModel;
    private $tourBookingNotificationModel;


    public function __construct()
    {
        $this->tourPackagesModel = new TourPackages();
        $this->tourPackageImagesModel = new TourPackageImages();
        $this->tourPackageItineraryModel = new TourPackageItinerary();
        $this->tourPackageActivitiesModel = new TourPackageActivities();
        $this->tourGuideUnavailabilityModel = new TourGuideUnavailability();
        $this->tourBookingModel = new TourBookings();
        $this->notificationModel = new NotificationsModel();
        $this->tourBookingNotificationModel = new TourBookingNotificationModel();
        $this->tourguideModel = new TourGuide_M();

    }

    public function index($package_id)
    {
        $result = $this->tourPackagesModel->first(['package_id' => $package_id]);

        $images = $this->tourPackageImagesModel->where(['package_id' => $package_id]);

        $itineraryDays = $this->tourPackageItineraryModel->where(['package_id' => $package_id]);

        // Create a structured array for itinerary data
        $itineraryData = [];

        foreach ($itineraryDays as $itineraryDay) {
            $activities = $this->tourPackageActivitiesModel->where(['day_id' => $itineraryDay->day_id]);
            $itineraryData[$itineraryDay->day_number] = [
                'day_info' => $itineraryDay,
                'activities' => $activities
            ];
        }

        // Get current month start and end dates
        $currentMonth = date('m');
        $currentYear = date('Y');
        $firstDay = date('Y-m-01');
        $lastDay = date('Y-m-t');

        // Get guide unavailable dates for current month
        $unavailableDates = $this->tourGuideUnavailabilityModel->where([
            'guide_id' => $result->guide_id,
            'start_date <= ' => $lastDay,
            'end_date >= ' => $firstDay
        ]);

        // Process unavailable dates to get all individual dates in ranges
        $allUnavailableDates = [];
        foreach ($unavailableDates as $period) {
            $start = max($period->start_date, $firstDay);
            $end = min($period->end_date, $lastDay);

            $startDate = new DateTime($start);
            $endDate = new DateTime($end);
            $interval = new DateInterval('P1D');
            $dateRange = new DatePeriod($startDate, $interval, $endDate->modify('+1 day'));

            foreach ($dateRange as $date) {
                $allUnavailableDates[] = $date->format('Y-m-d');
            }
        }

        $data['tourData'] = $result;
        $data['tourImages'] = $images;
        $data['itineraryDays'] = $itineraryDays;
        $data['itineraryData'] = $itineraryData;
        $data['totalDays'] = count($itineraryDays);
        $data['inclusion'] = $result->inclusions;
        $data['exclusion'] = $result->exclusions;
        $data['unavailableDates'] = $allUnavailableDates;
        $data['currentMonth'] = date('F Y'); // Current month name and year

        $this->view('traveler/particularTour', $data);

    }


    public function createBookingRequest($package_id)
    {

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            // show($_POST);
            // exit();
            $bookingData = [
                'traveler_Id' => $_SESSION['traveler_id'],
                'package_id' => $package_id,
                'guide_id' => $_POST['guide_id'],
                'booking_date' => date('Y-m-d h:i'),
                'tour_date' => $_POST['tourDate'],
                'num_guests' => $_POST['numberOfPeople'],
                'special_instructions' => $_POST['specialRequests'],
                'status' => 'upcoming',
                'request_status' => 'pending',
                'total_price' => $_POST['totalAmount'],
                'paymentStatus' => 'pending'
            ];


            $bookingId = $this->tourBookingModel->insert($bookingData);

            if ($bookingId) {

                $package = $this->tourPackagesModel->first(['package_id' => $package_id]);
                $guide = $this->tourguideModel->first(['guide_id' => $package->guide_id]);

                $notificationData = [
                    'recipient_type' => 'traveler',
                    'recipient_Id' => $_SESSION['traveler_id'],
                    'notification_type' => 'tourguide_related',
                    'notification_title' => 'Booking Request Submitted for ' . $package->name,
                    'notification_text' => 'Your booking request for ' . $package->name . ' by' . $guide->firstName . ' ' . $guide->lastName . ' has been successfully submitted. Please make the advance payment upon approval.'
                ];

                $notificationId = $this->notificationModel->insert($notificationData);

                if ($notificationId) {
                    $tourBookingNotificationData = [
                        'notification_Id' => $notificationId,
                        'booking_Id' => $bookingId
                    ];

                    $result = $this->tourBookingNotificationModel->insert($tourBookingNotificationData);

                    if ($result) {
                        redirect('traveler/ViewParticularTour/index/' . $package_id . '?success=booking_request_submitted&booking_id=' . $bookingId);
                    } else {
                        redirect('traveler/ViewParticularTour/index/' . $package_id . '?error=booking_request_submitted_but_failed_to_generate_accommodation_notification&booking_id=' . $bookingId);
                    }
                } else {
                    redirect('traveler/ViewParticularTour/index/' . $package_id . '?error=booking_request_submitted_but_failed_to_generate_notification&booking_id=' . $bookingId);
                }



                redirect('traveler/ViewParticularTour/index/' . $package_id . '?success=booking_success');
            }
        } else {
            redirect('traveler/ViewParticularTour/index/' . $package_id . '?error=not_a_post_request');
        }
    }

    private function validateBookingData($bookingData)
    {

        $errors = [];

        if (empty($bookingData['tour_date'])) {
            $errors['tour_date'] = 'Tour date is required.';
        } elseif (strtotime($bookingData['tour_date']) < strtotime(date('Y-m-d'))) {
            $errors['tour_date'] = 'Tour date cannot be in the past.';
        }

        // Validate number of guests
        if (empty($bookingData['num_guests'])) {
            $errors['num_guests'] = 'Number of guests is required.';
        } elseif (!filter_var($bookingData['num_guests'], FILTER_VALIDATE_INT) || $bookingData['num_guests'] <= 0) {
            $errors['num_guests'] = 'Number of guests must be a positive integer.';
        }

        // Validate total price
        if (empty($bookingData['total_price'])) {
            $errors['total_price'] = 'Total price is required.';
        } elseif (!is_numeric($bookingData['total_price']) || $bookingData['total_price'] <= 0) {
            $errors['total_price'] = 'Total price must be a positive number.';
        }

        // Validate special instructions (optional but can limit length)
        if (!empty($bookingData['special_instructions']) && strlen($bookingData['special_instructions']) > 100) {
            $errors['special_instructions'] = 'Special instructions must be less than 100 characters.';
        }

        return $errors;

    }
}
