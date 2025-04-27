<?php 

/**
 * Dashboard class
 */
class C_dashboard extends Controller
{
	private $tourGuideModel;
	private $tourBookingsModel;
	private $tourPackagesModel;
	private $travelerModel;

	public function __construct(){
		$this->tourGuideModel = new TourGuide_M;
		$this->tourBookingsModel = new TourBookings;
		$this->tourPackagesModel = new TourPackages;
		$this->travelerModel = new Traveler;
	}

	public function index()
	{

		if (!isset($_SESSION['guide_id'])) {
            header("Location: " . ROOT . "/traveler/Login");
            exit();
        }

		$guideBookingData = $this->tourBookingsModel->where(['guide_id' => $_SESSION['guide_id'], 'request_status' => 'accepted', 'status' => 'upcoming'],['order_by' => 'tour_date', 'order_type' => 'ASC']);
		$tourPackages = $this->tourPackagesModel->where(['guide_id' => $_SESSION['guide_id']]);
		$travelers = $this->travelerModel->selectAll();

		$holidays = $this->getUpcomingHolidays();
		// show($holidays);

		// show($guideBookingData);

		$guide = new TourGuide_M;
        $results = $guide->where(['guide_id' => $_SESSION['guide_id']]);
		$user = $results[0];

		$data = [
			'guideBookingData' => $guideBookingData,
			'tourPackages' => $tourPackages,
			'travelers' => $travelers,
			'holidays' => $holidays,
		];

		$this->view('tourGuide/dashboard', $data);
	}

	public function getUpcomingHolidays() {
		// Fetch ICS data
		$icsUrl = 'https://calendar.google.com/calendar/ical/en.lk%23holiday%40group.v.calendar.google.com/public/basic.ics';
		$icsData = @file_get_contents($icsUrl);
	
		if (!$icsData) {
			throw new Exception("Failed to fetch ICS data.");
		}
	
		// Parse ICS data
		$holidays = [];
		preg_match_all('/BEGIN:VEVENT(.*?)END:VEVENT/s', $icsData, $events);
	
		foreach ($events[1] as $event) {
			// Extract date and name
			preg_match('/DTSTART;VALUE=DATE:(\d{8})/', $event, $dateMatch);
			preg_match('/SUMMARY:(.*?)(\r?\n|$)/', $event, $nameMatch);
	
			if ($dateMatch && $nameMatch) {
				$date = DateTime::createFromFormat('Ymd', $dateMatch[1]);
				$holidays[] = [
					'date' => $date->format('Y-m-d'),
					'name' => trim($nameMatch[1])
				];
			}
		}
	
		$todayDate = date('Y-m-d');
	
		// Filter holidays greater than today
		$upcomingHolidays = array_filter($holidays, function($holiday) use ($todayDate) {
			return $holiday['date'] > $todayDate;
		});
	
		// Sort the filtered holidays by date
		usort($upcomingHolidays, function($a, $b) {
			return strtotime($a['date']) - strtotime($b['date']);
		});
	
		// Get the first 5 upcoming holidays
		return array_slice($upcomingHolidays, 0, 5);
	}

}