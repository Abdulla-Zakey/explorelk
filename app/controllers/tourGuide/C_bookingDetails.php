<?php 

/**
 * Booking Details class
 */
class C_bookingDetails extends Controller
{
	private $tourBookingsModel;
    private $tourPackageModel;
    private $travelerModel;
    private $tourPackageImageModel;
    private $tourPackageItineraryModel;
    private $tourPackageActivitiesModel;

    public function __construct() {
        $this->tourBookingsModel = new TourBookings;
        $this->tourPackageModel = new TourPackages;    
        $this->travelerModel = new Traveler;
        $this->tourPackageImageModel = new TourPackageImages;
		$this->tourPackageItineraryModel = new TourPackageItinerary;
		$this->tourPackageActivitiesModel = new TourPackageActivities;
    }

	public function index()
	{
		if (!isset($_SESSION['guide_id'])) {
            header("Location: " . ROOT . "/traveler/Login");
            exit();
        }

		$booking_id = $_GET['booking_id'];
		// show($booking_id);

		$bookingDetails = $this->tourBookingsModel->where(['booking_id' => $booking_id]);

		$package_id = $bookingDetails['0']->package_id;
		$traveler_Id = $bookingDetails['0']->traveler_Id;

        $tourPackage = $this->tourPackageModel->where(['package_id' => $package_id]);
        $traveler = $this->travelerModel->where(['traveler_Id' => $traveler_Id]);
        $images = $this->tourPackageImageModel->where(['package_id' => $package_id]);
		$tourPackageItinerary = $this->tourPackageItineraryModel->where(['package_id' => $package_id]);

		// Get activities for each day
		$dayActivities = [];
        foreach ($tourPackageItinerary as $day) {
            $dayActivities[$day->day_id] = $this->tourPackageActivitiesModel->where(['day_id' => $day->day_id]);
        }

		// show($tourPackage);
		// show($traveler);
		// show($images);
		// show($bookingDetails['0']->booking_id);
		// show($traveler_Id);




		// show($dayActivities);
        $data = [
            'bookingDetails' => $bookingDetails,
            'tourPackage' => $tourPackage,
            'traveler' => $traveler,
            'image' => $images['0'],
			'dayActivities' => $dayActivities,
			'tourPackageItinerary' => $tourPackageItinerary,
        ];
		// show($data);

		$this->view('tourGuide/bookingDetails', $data);
	}

	public function startTour(){
		// show($_GET["id"]);
		// echo 'hi';
		$booking_id = $_GET['id'];

		$data = [
			'status' => 'started',
		];

		$this->tourBookingsModel->update($booking_id, $data, 'booking_id');
		redirect('tourGuide/C_bookingDetails?booking_id=' . $booking_id);
	}

	public function completeTour(){
		// show($_GET["id"]);
		// echo 'hi';
		$booking_id = $_GET['id'];

		$data = [
			'status' => 'completed',
		];

		$this->tourBookingsModel->update($booking_id, $data, 'booking_id');
		redirect('tourGuide/C_bookingDetails?booking_id=' . $booking_id);
	}

}