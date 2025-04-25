<?php 

/**
 * Booking Requests class
 */
class C_bookingRequests extends Controller
{
    private $tourBookingsModel;
    private $tourPackageModel;
    private $travelerModel;
    private $tourPackageImageModel;

    public function __construct() {
        $this->tourBookingsModel = new TourBookings;
        $this->tourPackageModel = new TourPackages;    
        $this->travelerModel = new Traveler;
        $this->tourPackageImageModel = new TourPackageImages;
    }

    public function index()
    {
		if (!isset($_SESSION['guide_id'])) {
            header("Location: " . ROOT . "/traveler/Login");
            exit();
        }

        $newBookings = $this->tourBookingsModel->where(['guide_id' => $_SESSION['guide_id'], 'request_status' => 'pending']);
        $tourPackages = $this->tourPackageModel->selectAll();
        $travelers = $this->travelerModel->selectAll();
        $images = $this->tourPackageImageModel->selectAll();

        // Get first image for each package (more efficient approach)
        $firstImages = [];
        foreach ($images as $image) {
            $packageId = $image->package_id;
            if (!isset($firstImages[$packageId])) {
                $firstImages[$packageId] = [
                    'package_id' => $packageId,
                    'image_path' => $image->image_path
                ];
            }
        }
        // Convert to simple array if needed
        $firstImages = array_values($firstImages);

        $data = [
            'newBookings' => $newBookings,
            'tourPackages' => $tourPackages,
            'travelers' => $travelers,
            'tourPackageImages' => $firstImages,
        ];

        $this->view('tourGuide/bookingRequests', $data);
    }

	public function accept($id){
		// show($id);
		$data = [
			'request_status' => 'accepted',
		];

		$this->tourBookingsModel->update($id, $data, 'booking_id');
		redirect('tourGuide/C_bookingRequests');
	}

	public function reject($id){
		// show($id);
		$data = [
			'request_status' => 'rejected',
		];

		$this->tourBookingsModel->update($id, $data, 'booking_id');
		redirect('tourGuide/C_bookingRequests');
	}
}