<?php 
    // var_dump($data);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <title>ExploreLK | Your Tickets - <?php echo htmlspecialchars($data['ticket_info']['event_name']); ?></title>
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.2/html2pdf.bundle.js"></script>
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
            box-sizing: border-box;
        }

        .ticket-container {
            margin: 1rem;
            padding: 1rem 1.5rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .ticket-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .ticket-details {
            margin-bottom: 30px;
        }
        .qr-container {
            text-align: center;
            margin: 30px 0;
        }
        .success-message {
            color: #28a745;
            text-align: center;
            font-size: 1.2em;
            margin-bottom: 20px;
        }
        .ticket-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 20px;
        }
        .ticket-info div, .venue {
            padding: 10px;
            background: #f8f9fa;
            border-radius: 5px;
        }
        .download-button {
            display: inline-block;
            background: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            margin-bottom: 30px;
            width: 25%;
            margin-top: 1.5rem;
            margin-bottom: 0.5rem;
            margin-left: 72.5%;
            box-sizing: border-box;
        }
        .download-button:hover {
            background: #0056b3;
            cursor: pointer;
        }

        .download-button i {
            /* margin-right: 8px; For icon-before-text */
            margin-left: 5px; /* For icon-after-text */
        }

        .total-amount {
            text-align: left;
            /* font-size: 1.2em; */
            margin-top: 20px;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 5px;
        }

        .ticketTypesAndQuants-Container{
            border: 2px solid #f8f9fa;
            margin-top: 20px;
            padding: 20px;
            box-sizing: border-box;
        }

        .ticketTypesAndQuants-Container .heading{
            margin-bottom: 5px;
        }

    </style>
</head>
<body>

    <?php if (isset($data['success']) && $data['success']): ?>

        <button id = "download" class="download-button">
            Download Ticket
            <i class="fa-solid fa-file-arrow-down"></i>
        </button>

        <div id = "reciept" class="ticket-container">

            <div class="ticket-header">
                <h1><?php echo htmlspecialchars($data['ticket_info']['event_name']); ?></h1>
                <div class="success-message">✅ Booking Confirmed!</div>
            </div>
            
            <div class="ticket-details">

                <div class="ticket-info">

                    <div>
                        <strong>Reference Number:</strong><br>
                        <?php echo htmlspecialchars($data['ticket_info']['booking_id']); ?>
                    </div>

                    <div>
                        <strong>Purchase Date:</strong><br>
                        <?php echo htmlspecialchars($data['ticket_info']['purchase_date']); ?>
                    </div>

                    <div>
                        <strong>Event Date:</strong><br>
                        <?php echo htmlspecialchars($data['ticket_info']['event_date']); ?>
                    </div>

                    <div>
                        <strong>Event Time:</strong><br>
                        <?php echo htmlspecialchars($data['ticket_info']['event_time']); ?>
                    </div>

                </div>

                <div class = "venue">

                    <strong>Venue:</strong><br>
                    <?php echo htmlspecialchars($data['ticket_info']['event_location']); ?>

                </div>

                <div class="total-amount">
                    <strong>Total Amount:</strong> Rs. <?php echo number_format($data['ticket_info']['total_amount'], 2); ?>
                </div>
                
                <div class = "ticketTypesAndQuants-Container">

                    <strong class = "heading">Tickets Purchased:</strong>

                        <div class = "ticket-info">

                            <?php if (isset($data['ticketTypes']) && !empty($data['ticketTypes'])): ?>

                                <?php if (is_array($data['ticketTypes'])): ?>

                                    <?php foreach (($data['ticketTypes']) as $ticket): ?>

                                        <div>
                                            <?php 
                                                if (isset($ticket['ticketTypeName'])) {
                                                    echo htmlspecialchars($ticket['ticketTypeName']); 
                                                }
                                            ?>
                                        </div>

                                        <div>
                                            <?php
                                                if(isset($ticket['quantity'])){
                                                    echo htmlspecialchars($ticket['quantity']);
                                                }
                                            ?>
                                        </div>

                                    <?php endforeach; ?>

                                <?php else: ?>
                                    <p>Booking confirmed. Please check your email for ticket details.</p>
                                <?php endif; ?>

                            <?php else: ?>
                                <p>Booking confirmed. Your ticket details will be updated shortly.</p>
                            <?php endif; ?>

                        </div>

                </div>
                
                

            </div>
            
            <div class="qr-container">

                <h3>Your Ticket QR Code</h3>

                <?php if (isset($data['qr_image']) && file_exists($data['qr_image'])): ?>
                    <img src="<?php echo ROOT . "/" . htmlspecialchars($data['qr_image']); ?>" alt="Ticket QR Code">
                    <p>Please present this QR code at the entrance</p>
                    <!-- <a href="<?php echo ROOT . "/" . htmlspecialchars($data['qr_image']); ?>" download class="download-button">
                        Download Ticket
                    </a> -->
                <?php else: ?>
                    <p>QR code generation in progress. Please check your email for the ticket.</p>
                <?php endif; ?>

            </div>

        </div>

    <?php else: ?>

        <div class="ticket-container">

            <div class="ticket-header">

                <h1>Error</h1>
                <p>Unable to generate ticket. Please contact support with your booking reference.</p>
                <?php if (isset($data['message'])): ?>
                    <p class="error-message"><?php echo htmlspecialchars($data['message']); ?></p>
                <?php endif; ?>
                
            </div>

        </div>

    <?php endif; ?>

</body>

    <script>

        window.onload = function () {
            document.getElementById('download').addEventListener('click', () => {
                const content = this.document.getElementById("reciept");
                html2pdf().from(content).save();
            });
        }

    </script>

</html>