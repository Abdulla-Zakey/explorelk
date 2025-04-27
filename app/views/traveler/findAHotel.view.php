<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/navbar.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <title>ExploreLK | Find a Hotel</title>
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>

    <style>
        :root {
            --primary-color: #1E7A8F;
            --primary-hover: #3DA4BF;
            --background-color: #f7f9fc;
            --card-color: #ffffff;
            --text-color: #333333;
            --shadow: 0 8px 16px rgba(0, 0, 0, 0.08);
            --border-radius: 12px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-color);
            margin: 0;
            padding: 0;
            color: var(--text-color);
        }

        #main {
            margin-top: 100px;
            padding: 2rem 5%;
        }

        #main h1 {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 2rem;
            color: var(--primary-color);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .form-container {
            background-color: var(--card-color);
            border-radius: var(--border-radius);
            padding: 2.5rem;
            box-shadow: var(--shadow);
        }

        form {
            display: grid;
            gap: 1.5rem;
        }

        .form-header {
            margin-bottom: 1.5rem;
            color: var(--primary-color);
            font-size: 1.3rem;
            font-weight: 600;
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 0.5rem;
            display: inline-block;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #e5e5e5;
            border-radius: 8px;
            font-size: 1rem;
            transition: border 0.3s ease;
            box-sizing: border-box;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            outline: none;
        }

        .input-groups {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .searchButton {
            width: 100%;
            padding: 1rem;
            box-sizing: border-box;
            color: white;
            background-color: var(--primary-color);
            border: none;
            border-radius: var(--border-radius);
            font-size: 1.1rem;
            font-weight: 600;
            transition: transform 0.2s ease, background-color 0.2s ease;
            cursor: pointer;
        }

        .searchButton:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .form-container {
                padding: 1.5rem;
            }

            #main h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="backToHome">
                <a href="<?= ROOT ?>/traveler/RegisteredTravelerHome">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Back to Home</span>
                </a>
            </div>
        </nav>
    </header>

    <section id="main">
        <h1>Find Your Perfect Stay</h1>

        <div class="container">
            <div class="form-container">
                <form name="findaHotel" method="POST" action="<?= ROOT ?>/traveler/HotelSearchResults">
                    <div class="form-header">Search Hotels by District</div>

                    <div class="input-groups">
                        <div class="form-group">
                            <label for="province">Province:</label>
                            <select id="province" name="province" class="form-control" onchange="updateDistricts()">
                                <option value="">Select Province</option>
                                <option value="Western">Western</option>
                                <option value="Central">Central</option>
                                <option value="Southern">Southern</option>
                                <option value="Northern">Northern</option>
                                <option value="Eastern">Eastern</option>
                                <option value="North-Western">North-Western</option>
                                <option value="North-Central">North-Central</option>
                                <option value="Uva">Uva</option>
                                <option value="Sabaragamuwa">Sabaragamuwa</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="district">District:</label>
                            <select id="district" name="district" class="form-control">
                                <option value="">Select Province First</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="searchButton" name="search">
                            <i class="fa-solid fa-search"></i> Find Hotels
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
        // Sri Lanka districts by province
        const districtsByProvince = {
            'Western': ['Colombo', 'Gampaha', 'Kalutara'],
            'Central': ['Kandy', 'Matale', 'Nuwara Eliya'],
            'Southern': ['Galle', 'Matara', 'Hambantota'],
            'Northern': ['Jaffna', 'Kilinochchi', 'Mannar', 'Mullaitivu', 'Vavuniya'],
            'Eastern': ['Batticaloa', 'Ampara', 'Trincomalee'],
            'North-Western': ['Kurunegala', 'Puttalam'],
            'North-Central': ['Anuradhapura', 'Polonnaruwa'],
            'Uva': ['Badulla', 'Monaragala'],
            'Sabaragamuwa': ['Ratnapura', 'Kegalle']
        };

        // Keep the district population functionality
        function updateDistricts() {
            const provinceSelect = document.getElementById('province');
            const districtSelect = document.getElementById('district');

            // Clear existing options
            districtSelect.innerHTML = '<option value="">Select District</option>';

            // Get selected province
            const selectedProvince = provinceSelect.value;

            if (selectedProvince) {
                // Add districts for the selected province
                districtsByProvince[selectedProvince].forEach(district => {
                    const option = document.createElement('option');
                    option.value = district;
                    option.textContent = district;
                    districtSelect.appendChild(option);
                });
            }
        }

        // Add form validation before submission
        document.querySelector('form[name="findaHotel"]').addEventListener('submit', function (event) {
            if (!document.getElementById('district').value) {
                event.preventDefault();
                alert('Please select a district');
                return false;
            }
            // Allow form submission to proceed if district is selected
        });


    </script>
</body>

</html>