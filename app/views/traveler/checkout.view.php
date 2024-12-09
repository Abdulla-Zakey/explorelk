<?php
// require __DIR__ . "/vendor/autoload.php";
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
    $checkout_session = \Stripe\Checkout\Session::create([
        "mode" => "payment",
        "success_url" => ROOT . "/traveler/PaymentConfirmation",
        "cancel_url" => "http://localhost/explorelk/cancel.php",
        "line_items" => [
            [
                "quantity" => 1,
                "price_data" => [
                    "currency" => "lkr",
                    "unit_amount" => $total_amount, // Use the dynamic total amount
                    "product_data" => [
                        "name" => "Total Amount"
                    ]
                ]
            ]
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
