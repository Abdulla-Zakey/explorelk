<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExploreLK | Payment Confirmation</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
    <style>
       body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
            overflow: hidden;
            
        }

        .confirmation-container {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 50%;
            margin-left: 25%;
            margin-right: 25%;
            height: auto;
            
            
        }

        .confirmation-container h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        .confirmation-container p {
            font-size: 18px;
            color: #666;
            margin-bottom: 20px;
        }

        .ticket {
            background-color: #fff;
            padding: 25px;
            border-radius: 12px;
            border: 1px solid #e0e0e0;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            text-align: left;
            width: 100%;
            max-width: 380px;
            margin-left: auto;
            margin-right: auto;
        }

        .ticket-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .ticket-header h2 {
            font-size: 22px;
            color: #333;
            font-weight: 600;
        }

        .ticket-header span {
            font-size: 16px;
            color: #999;
            font-style: italic;
        }

        .ticket-details {
            font-size: 16px;
            color: #555;
            margin-bottom: 20px;
        }

        .ticket-details p {
            margin: 8px 0;
        }

        .ticket img {
            display: block;
            margin: 15px auto;
            width: 130px;
            border: 3px solid #ddd;
            border-radius: 10px;
        }

        .ticket-footer {
            text-align: center;
            margin-top: 20px;
        }

        .button {
            display: inline-block;
            padding: 12px 25px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-size: 16px;
            cursor: pointer;
            margin: 10px 0;
            border: none;
        }

        .button:hover {
            background-color: #0056b3;
        }

        .ticket-id {
            font-size: 14px;
            color: #999;
            font-weight: 600;
            text-align: center;
        }

    </style>
</head>

<body>
    <div class="confirmation-container" id="ticket">
        <h1>Payment Successful!</h1>
        <p>Thank you for your payment. Your ticket has been confirmed.</p>

        <div class="ticket">
            <!-- Ticket Header -->
            <div class="ticket-header">
                <h2>Whimsical Wonderfest</h2>
                <span>General Entrance</span>
            </div>

            <!-- Ticket Details -->
            <div class="ticket-details">
                <p><strong>Ticket ID:</strong> TICKET-123456789</p>
                <p><strong>Price:</strong> LKR 250.00</p>
                <p><strong>Event Date:</strong> December 15, 2024</p>
                <p><strong>Venue:</strong> ExploreLK Arena</p>
            </div>

            <!-- QR Code -->
            <img src= "<?= ROOT ?>/assets/images/travelers/viewEvents/qrcode.png" alt="QR Code">

            <!-- Footer with download button -->
            <div class="ticket-footer">
                <p class="ticket-id">Ticket ID: 1242588997WF</p>
                <button class="button" id="downloadTicket">Download Ticket</button>
            </div>
        </div>
    </div>

    <script>
        const downloadButton = document.getElementById('downloadTicket');

        downloadButton.addEventListener('click', () => {
            const ticket = document.getElementById('ticket');
            const opt = {
                margin: 1,
                filename: 'Ticket.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
            };

            // Use html2pdf library to download the ticket
            html2pdf().from(ticket).set(opt).save();
        });
    </script>

    <!-- Include html2pdf library for downloading -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
</body>

</html>
