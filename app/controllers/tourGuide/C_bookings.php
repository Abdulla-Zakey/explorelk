<?php 

/**
 * Bookings class
 */
class C_bookings extends Controller
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

		$newBookings = $this->tourBookingsModel->where(['guide_id' => $_SESSION['guide_id'], 'request_status' => 'accepted']);
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

		$this->view('tourGuide/bookings' , $data);
	}

}