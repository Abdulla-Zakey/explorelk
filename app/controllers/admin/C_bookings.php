<?php 

/**
 * Admin Bookings class
 */
class C_bookings extends Controller
{

	public function index()
	{
		if (!isset($_SESSION['admin_id'])) {
			redirect('admin/C_adminLogin');
		}

		$traveler = new Traveler();
        $tourGuide = new TourGuide_M();
        
        // Fetch user data
        $data = [
            // 'travelers' => $traveler->selectALL(),
            // 'tourGuides' => $tourGuide->selectALL(),
            // Add other user types as needed
            // 'hotels' => $hotel->getUsers(),
            // 'organizers' => $organizer->getUsers()
        ];

		$this->view('admin/bookings',$data);
	}

}