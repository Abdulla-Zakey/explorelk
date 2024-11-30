<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/navbar.css">
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/viewBookings.css">
    <link rel = "stylesheet" href = "<?= CSS ?>/Traveler/footer.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <title>ExploreLK | Booking Details</title>
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>

    <style>
        .backToHome {
            font-size: 1.6rem;
        }

        .foot {
            font-size: 1.4rem;
        }
    </style>

</head>

<body>
    <header>
        <nav class="navbar">

            <div class="backToHome">
                <a href="<?= ROOT ?>/traveler/Mybookings">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Back</span>
                </a>
            </div>

        </nav>
    </header>

    <section id="main">
        
        <div class="container">


            <div class="bookedItemDetails-Container">

                <div class="topic">
                    Suzuki Alto 800
                </div>

                <div class="itemSpecification-Container">

                    <div class="itemImage-Holder">
                        <img src="<?= IMAGES ?>/travelers/carRental/Alto.jpeg">
                    </div>

                    <div class="itemSpecificationRows-Conatiner">

                        <div class="itemSpecification-Row">

                            <div class="itemSpecification">
                                <label for="seatingCapacity:">Seating Capacity:</label>
                                <input type="text" id="seatingCapacity:" value="4 seater" readonly>
                            </div>

                            <div class="itemSpecification">
                                <label for="fuelType">Fuel Type:</label>
                                <input type="text" id="fuelType" value="Petrol" readonly>
                            </div>

                        </div>

                        <div class="itemSpecification-Row">

                            <div class="itemSpecification">
                                <label for="fuelCapacity">Fuel Capacity:</label>
                                <input type="text" id="fuelCapacity" value="35 Litres" readonly>


                            </div>

                            <div class="itemSpecification">
                                <label for="MileagePerLitre">Mileage per Litre:</label>
                                <input type="text" id="MileagePerLitre" value="25km per litre" readonly>
                            </div>

                        </div>

                        <div class="itemSpecification-Row">

                            <div class="itemSpecification">
                                <label for="transmissionType:">Transmission Type:</label>
                                <input type="text" id="transmissionType:" value="Manual" readonly>


                            </div>

                            <div class="itemSpecification">
                                <label for="airConditioning">Air Conditioning:</label>
                                <input type="text" id="airConditioning:" value="Yes" readonly>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="bookingRelatedDetails-Container">

                <div class="personalInfo-Conatiner">

                    <div class="topic">
                        Booking Person Information
                    </div>

                    <div class="bookingSummary-Row">

                        <div class="bookingSummary-RowItem">
                            <label>
                                Full Name:
                            </label>
                            <input type="text" id="fullName" value="Nihmath Jabir" readonly>
                        </div>

                        <div class="bookingSummary-RowItem">
                            <label>
                                Email:
                            </label>
                            <input type="email" id="email" value="mnnjabir@fakemail.com" readonly>
                        </div>

                        <div class="bookingSummary-RowItem">
                            <label>
                                Mobile Number:
                            </label>
                            <input type="text" id="mobileNum" value="071 577 0109" readonly>
                        </div>

                        <div class="bookingSummary-RowItem">
                            <label>
                                National ID Num:
                            </label>
                            <input type="text" id="nic" value="201018213988" readonly>
                        </div>

                        <div class="bookingSummary-RowItem">
                            <label>
                                Driving License Number:
                            </label>
                            <input type="text" id="drLicenseNum" value="192837465564" readonly>
                        </div>

                    </div>



                </div>

                <div class="bookingSummary-Container">

                    <div class="topic">
                        Booking Summary
                    </div>

                    <div class="bookingSummary-Row">

                        <div class="bookingSummary-RowItem">
                            <label>
                                Booked Date:
                            </label>
                            <input type="date" id="bookedDate:" value="2024-11-15" readonly>
                        </div>

                        <div class="bookingSummary-RowItem">
                            <label>
                                Pickup Date:
                            </label>
                            <input type="date" id="pickupDate:" value="2024-12-15" readonly>
                        </div>

                        <div class="bookingSummary-RowItem">
                            <label>
                                Return Date:
                            </label>
                            <input type="date" id="returnDate:" value="2024-12-18" readonly>
                        </div>

                        <div class="bookingSummary-RowItem">
                            <label>
                                Booking Status:
                            </label>
                            <input type="text" id="bookingStatus" value="Approved" readonly>
                        </div>

                        <div class="bookingSummary-RowItem">
                            <label>
                                Payment Status:
                            </label>
                            <input type="text" id="returnStatus" value="Pending" readonly>
                        </div>

                    </div>

                </div>

                <div class="chargesInfo">

                    <div class="topic">
                        Summary of Charges
                    </div>

                    <div class="bookingSummary-Row">

                        <div class="bookingSummary-RowItem">
                            <label>
                                Car Rental per Day:
                            </label>
                            <input type="text" id="rentalPerDay" value="Rs. 6500.00" readonly>
                        </div>

                        <div class="bookingSummary-RowItem">
                            <label>
                                Rental Period:
                            </label>
                            <input type="text" id="rentalPeriod" value="3 days" readonly>
                        </div>

                        <div class="bookingSummary-RowItem">
                            <label>
                                Taxes and Fees:
                            </label>
                            <input type="text" id="taxAndOther" value="Rs. 0.00" readonly>
                        </div>

                        <div class="bookingSummary-RowItem">
                            <label>
                                Total Rental Charge:
                            </label>
                            <input type="text" id="total" value="Rs. 195000.00" readonly>
                        </div>

                        <div class="bookingSummary-RowItem">
                            <label>
                                Refundable Deposit Amount:
                            </label>
                            <input type="text" id="refundAmount" value="Rs. 250000.00" readonly>
                        </div>



                    </div>


                </div>
            </div>

        </div>

    </section>

    <div class="floating-message">
        <a href="<?= ROOT ?>/traveler/Messages" title = "Send a message to the service provider">
            <img src="<?= IMAGES ?>/travelers/messages/messageIcon.png" alt="Message Icon">
        </a>
    </div>
    


    <script>
        // Function to set background color based on status
        function updateStatusColors() {
            // Get the booking status and payment status input elements
            const bookingStatusInput = document.getElementById("bookingStatus");
            const paymentStatusInput = document.getElementById("returnStatus");

            // Change background color for booking status
            switch (bookingStatusInput.value.toLowerCase()) {
                case "approved":
                    bookingStatusInput.style.backgroundColor = "lightgreen";
                    bookingStatusInput.style.color = "black";
                    break;
                case "pending":
                    bookingStatusInput.style.backgroundColor = "gold";
                    bookingStatusInput.style.color = "black";
                    break;
                case "rejected":
                    bookingStatusInput.style.backgroundColor = "lightcoral";
                    bookingStatusInput.style.color = "white";
                    break;
                default:
                    bookingStatusInput.style.backgroundColor = "white";
                    bookingStatusInput.style.color = "black";
            }

            // Change background color for payment status
            switch (paymentStatusInput.value.toLowerCase()) {
                case "paid":
                    paymentStatusInput.style.backgroundColor = "lightgreen";
                    paymentStatusInput.style.color = "black";
                    break;
                case "pending":
                    paymentStatusInput.style.backgroundColor = "khaki";
                    paymentStatusInput.style.color = "black";
                    break;
                case "unpaid":
                    paymentStatusInput.style.backgroundColor = "lightcoral";
                    paymentStatusInput.style.color = "white";
                    break;
                default:
                    paymentStatusInput.style.backgroundColor = "white";
                    paymentStatusInput.style.color = "black";
            }
        }

        // Call the function when the page loads
        document.addEventListener("DOMContentLoaded", updateStatusColors);

    </script>
    
</body>

</html>