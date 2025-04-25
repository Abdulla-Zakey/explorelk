<?php
    
    class Checkout extends Controller {
        public function index() {

            // Check if event details exist in session
            if (!isset($_SESSION['current_event'])) {
                // Redirect to home if no event details found
                redirect('traveler/RegisteredTravelerHome');
                return;
            }
    
            // Get total amount from URL
            $totalAmount = isset($_GET['total']) ? $_GET['total'] / 100 : 0;
            
            // Get ticket details from URL parameters
            $ticketDetails = [];
            if (isset($_GET['tickets']) && is_array($_GET['tickets'])) {
                foreach ($_GET['tickets'] as $type => $quantity) {
                    if ($quantity > 0) {
                        $ticketDetails[] = [
                            'ticketTypeName' => $type,
                            'quantity' => (int)$quantity
                        ];
                    }
                }
            }

            // Get purchaser details from URL parameters
            $purchaserDetails = [
                'fullName' => isset($_GET['name']) ? htmlspecialchars($_GET['name']) : '',
                'nic' => isset($_GET['nic']) ? htmlspecialchars($_GET['nic']) : '',
                'email' => isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '',
                'mobileNum' => isset($_GET['mobile']) ? htmlspecialchars($_GET['mobile']) : ''
               
            ];
    
            // Store details in session for QR generation
            $_SESSION['event_details'] = $_SESSION['current_event'];
            $_SESSION['ticket_details'] = $ticketDetails;
            $_SESSION['total_amount'] = $totalAmount;
            $_SESSION['purchaser_details'] = $purchaserDetails; // Store purchaser details in session
    
            // Create data array for view
            $data = [
                'event_details' => $_SESSION['current_event'],
                'ticket_details' => $_SESSION['ticket_details'],
                'total_amount' => $totalAmount
            ];
    
            // Load the checkout view
            $this->view('traveler/checkout', $data);
            // $this->view('traveler/ticketPurchaseConfirmation', $data);
        }
    
    }