<?php

require __DIR__ . "/vendor/autoload.php";

// Set your Stripe secret key
$stripe_secret_key = "sk_test_51QNK9mKKNgosJwD2pQNXV4mfdV3Fk6fFFCptahlORTCL7jznemJcPsJKpsUJfb5LxXRKb8qSB43GymiNssBca2Ra007nJ5tsvB";

\Stripe\Stripe::setApiKey($stripe_secret_key);

// Get the total amount from the query parameter
if (isset($_GET['total'])) {
    $total_amount = (int) $_GET['total']; // Convert to integer for Stripe
} 
else {
    die("Error: Total amount not provided.");
}

// Create the Checkout Session
try {

    //Store the checkout data in session before creating Stripe session
    // $_SESSION['checkout_data'] = [
    //     'event_details' => $_SESSION['current_event'],
    //     'ticket_details' => $_SESSION['ticketDetails'],
    //     'total_amount' => $_SESSION['total_amount']
    // ];

    $_SESSION['checkout_data'] = $data;


    $checkout_session = \Stripe\Checkout\Session::create([
        "mode" => "payment",
        "success_url" => ROOT . "/traveler/QRGenerator/index?session_id={CHECKOUT_SESSION_ID}",
        "cancel_url" => "http://localhost/explorelk/cancel.php",
        "line_items" => [
            [
                "quantity" => 1,
                "price_data" => [
                    "currency" => "lkr",
                    "unit_amount" => $total_amount,
                    "product_data" => [
                        "name" => $_SESSION['current_event']['eventName'] . " Tickets",
                        "description" => "ExploreLK | Purchase Event Tickets"
                    ]
                ]
            ]
        ],

        // Store additional metadata if needed
        "metadata" => [
            "event_id" => $_SESSION['current_event']['eventId'],
            "purchase_date" => date('Y-m-d H:i:s')
        ]
    ]);

    // Redirect to the Stripe Checkout page
    http_response_code(303);
    header("Location: " . $checkout_session->url);
} 
catch (Exception $e) {
    echo "Error creating Stripe Checkout Session: " . $e->getMessage();
}
?>
