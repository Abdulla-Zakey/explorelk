<?php
/**
 * Ticket QR Code Generator
 * Generates QR codes for ticket bookings after successful payment
 */

class TicketQRGenerator {
    private $errorCorrectionLevel = 'H'; // Higher error correction for better reliability
    private $size = 5; // Larger size for more data
    private $margin = 2;
    private $storageBasePath = 'assets/images/Travelers/generatedEventTickets';
    
    public function __construct($errorLevel = 'H', $size = 3, $margin = 2) {
        $this->errorCorrectionLevel = $errorLevel;
        $this->size = $size;
        $this->margin = $margin;
    }
    
    public function generateTicketQR($ticketData, $filename = null) {
        if (!function_exists('imagecreate')) {
            // die('GD Library is required.');
            throw new Exception('GD Library is required.');
        }
        
        include_once('phpqrcode.php');

        // if ($filename === null) {
        //     $filename = 'ticket_qr_' . md5(json_encode($ticketData) . time()) . '.png';
        // }

        // Create full storage path
        if (!file_exists($this->storageBasePath)) {
            if (!mkdir($this->storageBasePath, 0777, true)) {
                throw new Exception('Failed to create storage directory');
            }
        }

        // Generate filename if not provided
        if ($filename === null) {
            $filename = $this->storageBasePath . '/ticket_qr_' . 
                       $ticketData['booking_id'] . '_' . 
                       md5(json_encode($ticketData) . time()) . '.png';
        } else {
            $filename = $this->storageBasePath . '/' . basename($filename);
        }
        
        // Convert ticket data to JSON string
        $qrContent = json_encode($ticketData);
        
        // Generate the QR code
        QRcode::png(
            $qrContent,
            $filename,
            $this->errorCorrectionLevel,
            $this->size,
            $this->margin
        );
        
        return $filename;
    }
}

// Get ticket information from POST or SESSION
$ticketInfo = [];
$qrImage = '';
$message = '';

// Check if this is a post-payment redirect
if (isset($_GET['payment_success']) && $_GET['payment_success'] == 1) {
    // Get ticket details from session or database
    $ticketInfo = [
        'event_name' => 'Whimsical Wonderfest',
        'event_date' => '2024-12-18',
        'event_time' => '6:00 PM',
        'booking_id' => uniqid('WWF-'), // Generate unique booking ID
        'tickets' => [
            'general' => isset($_SESSION['tickets']['general']) ? $_SESSION['tickets']['general'] : 0,
            'kids' => isset($_SESSION['tickets']['kids']) ? $_SESSION['tickets']['kids'] : 0,
            'family' => isset($_SESSION['tickets']['family']) ? $_SESSION['tickets']['family'] : 0
        ],
        'total_amount' => isset($_SESSION['total_amount']) ? $_SESSION['total_amount'] : 0,
        'purchase_date' => date('Y-m-d H:i:s'),
        'venue' => 'Arcade Independence Square, Colombo - 7'
    ];
    
    try {
        $qr = new TicketQRGenerator();
        $filename = 'assets/images/Travelers/generatedEventTickets/' . $ticketInfo['booking_id'] . '_ticket.png';
        
        // Create directory if it doesn't exist
        if (!file_exists('generated_tickets')) {
            mkdir('generated_tickets', 0777, true);
        }
        
        // Generate QR code
        $qrImage = $qr->generateTicketQR($ticketInfo, $filename);
        
    } catch (Exception $e) {
        $message = 'Error generating ticket QR code: ' . $e->getMessage();
    }
}

