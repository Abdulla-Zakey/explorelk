<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/navbar.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <title>ExploreLK | Hotel Search Results</title>
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
    
    <style>
        :root {
            --primary-color: #1E7A8F;
            --primary-hover: #3DA4BF;
            --primary-light: rgba(30, 122, 143, 0.1);
            --background-color: #f8fafc;
            --card-color: #ffffff;
            --text-color: #333333;
            --text-light: #666666;
            --text-muted: #94a3b8;
            --accent-color: #FF6B6B;
            --success-color: #10b981;
            --shadow: 0 10px 25px rgba(0,0,0,0.06);
            --shadow-hover: 0 15px 35px rgba(0,0,0,0.08);
            --border-radius: 16px;
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-color);
            margin: 0;
            padding: 0;
            color: var(--text-color);
            line-height: 1.6;
        }

        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 2.5rem 1.5rem;
        }

        /* Header Styles
        header {
            background-color: #ffffff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar {
            max-width: 1280px;
            margin: 0 auto;
            padding: 1rem 1.5rem;
        }

        .backToHome a {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            font-size: 1rem;
        }

        .backToHome a:hover {
            color: var(--primary-hover);
            transform: translateX(-5px);
        } */

        .search-header {
            display: flex;
            flex-direction: column;
            margin-bottom: 2.5rem;
            background: linear-gradient(to right, #ffffff, var(--primary-light));
            padding: 1.5rem 2rem;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            margin-top: 100px;
        }

        .search-header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .search-header h1 {
            font-size: 2.2rem;
            margin: 0;
            background: linear-gradient(120deg, var(--primary-color), #0ea5e9);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            font-weight: 700;
        }

        .search-summary {
            color: var(--text-light);
            font-size: 1.05rem;
            display: flex;
            gap: 1.5rem;
            font-weight: 500;
            
        }

        .search-summary p {
            margin: 0.5rem 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            min-width: 600px;
        }

        .search-summary i {
            color: var(--primary-color);
        }

        .search-actions {
            display: flex;
            gap: 1rem;
        }

        .new-search-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.8rem 1.5rem;
            background: linear-gradient(to right, var(--primary-color), var(--primary-hover));
            color: white;
            border: none;
            border-radius: var(--border-radius);
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            box-shadow: 0 4px 10px rgba(30, 122, 143, 0.2);
            min-width: 125px;
        }

        .new-search-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 14px rgba(30, 122, 143, 0.25);
        }

        /* Results Grid */
        .results-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 2.5rem;
        }

        /* Hotel Card */
        .hotel-card {
            background-color: var(--card-color);
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .hotel-card:hover {
            transform: translateY(-7px);
            box-shadow: var(--shadow-hover);
        }

        .hotel-image-container {
            position: relative;
            height: 220px;
            overflow: hidden;
        }

        .hotel-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .hotel-card:hover .hotel-image {
            transform: scale(1.05);
        }

        .hotel-info {
            padding: 1.8rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .hotel-name {
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 0.8rem;
            color: var(--text-color);
            line-height: 1.3;
        }

        .hotel-location {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-light);
            margin-bottom: 1.2rem;
            font-size: 0.95rem;
        }

        .hotel-location i {
            color: var(--primary-color);
        }

        .hotel-description {
            font-size: 0.95rem;
            color: var(--text-light);
            margin-bottom: 1.5rem;
            flex-grow: 1;
            line-height: 1.6;
        }

        .hotel-amenities {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .amenity {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .amenity i {
            color: var(--success-color);
        }

        .hotel-action {
            margin-top: auto;
        }

        .view-hotel-btn {
            display: inline-block;
            width: 100%;
            padding: 1rem 0;
            background: linear-gradient(to right, var(--primary-color), var(--primary-hover));
            color: white;
            text-align: center;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
            box-shadow: 0 4px 10px rgba(30, 122, 143, 0.2);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .view-hotel-btn:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0%;
            height: 100%;
            background: rgba(255, 255, 255, 0.1);
            transition: var(--transition);
            z-index: -1;
        }

        .view-hotel-btn:hover:before {
            width: 100%;
        }

        .view-hotel-btn:hover {
            box-shadow: 0 6px 15px rgba(30, 122, 143, 0.3);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 5rem 2rem;
            background-color: var(--card-color);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            max-width: 800px;
            margin: 0 auto;
        }

        .empty-state img {
            max-width: 300px;
            margin-bottom: 2.5rem;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }

        .empty-state h2 {
            font-size: 1.8rem;
            margin-bottom: 1.2rem;
            color: var(--primary-color);
            font-weight: 700;
        }

        .empty-state p {
            color: var(--text-light);
            margin-bottom: 2.5rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            font-size: 1.05rem;
            line-height: 1.7;
        }

        .empty-state-actions {
            display: flex;
            justify-content: center;
            gap: 1.2rem;
        }

        .empty-state-btn {
            padding: 1rem 2rem;
            background: linear-gradient(to right, var(--primary-color), var(--primary-hover));
            color: white;
            border: none;
            border-radius: var(--border-radius);
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            box-shadow: 0 4px 10px rgba(30, 122, 143, 0.2);
        }

        .empty-state-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(30, 122, 143, 0.3);
        }

        .empty-state-btn.secondary {
            background: transparent;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            box-shadow: none;
        }

        .empty-state-btn.secondary:hover {
            background-color: var(--primary-light);
            transform: translateY(-3px);
        }

        /* Loader */
        .loader {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 300px;
        }

        .loader-spinner {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            position: relative;
            animation: rotate 1s linear infinite;
        }

        .loader-spinner::before,
        .loader-spinner::after {
            content: "";
            box-sizing: border-box;
            position: absolute;
            inset: 0px;
            border-radius: 50%;
            border: 5px solid var(--primary-color);
            animation: prixClipFix 2s linear infinite;
        }

        .loader-spinner::after {
            border-color: var(--accent-color);
            animation: prixClipFix 2s linear infinite, rotate 0.5s linear infinite reverse;
            inset: 6px;
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes prixClipFix {
            0% { clip-path: polygon(50% 50%, 0 0, 0 0, 0 0, 0 0, 0 0); }
            25% { clip-path: polygon(50% 50%, 0 0, 100% 0, 100% 0, 100% 0, 100% 0); }
            50% { clip-path: polygon(50% 50%, 0 0, 100% 0, 100% 100%, 100% 100%, 100% 100%); }
            75% { clip-path: polygon(50% 50%, 0 0, 100% 0, 100% 100%, 0 100%, 0 100%); }
            100% { clip-path: polygon(50% 50%, 0 0, 100% 0, 100% 100%, 0 100%, 0 0); }
        }

        /* Responsive Adjustments */
        @media screen and (max-width: 992px) {
            .results-container {
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            }
        }

        @media screen and (max-width: 768px) {
            .search-header {
                padding: 1.25rem 1.5rem;
            }
            
            .search-header-top {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .search-header h1 {
                font-size: 1.8rem;
            }

            .search-summary {
                flex-direction: column;
                gap: 0.5rem;
            }

            .search-actions {
                width: 100%;
            }

            .new-search-btn {
                width: 100%;
                justify-content: center;
            }

            .results-container {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .empty-state {
                padding: 3rem 1.5rem;
            }

            .empty-state img {
                max-width: 220px;
            }

            .empty-state-actions {
                flex-direction: column;
                gap: 1rem;
            }

            .empty-state-btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="backToHome">
                <a href="<?= ROOT ?>/traveler/findAHotel">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Back to Search</span>
                </a>
            </div>
        </nav>
    </header>

    <div class="container">
        <div class="search-header">
            <div class="search-header-top">
                <h1>Hotel Search Results</h1>
                <div class="search-actions">
                    <a href="<?= ROOT ?>/traveler/findAHotel" class="new-search-btn">
                        <i class="fa-solid fa-search"></i>
                        New Search
                    </a>
                </div>
            </div>
            <div class="search-summary">
                <?php if(isset($data['district']) && isset($data['province'])): ?>
                    <p><i class="fa-solid fa-map-marker-alt"></i> Showing hotels in <?= $data['district'] ?>, <?= $data['province'] .' Province' ?></p>
                <?php endif; ?>
                
                <?php if(isset($data['hotels']) && count($data['hotels']) > 0): ?>
                    <p><i class="fa-solid fa-hotel"></i> <?= count($data['hotels']) ?> hotels found</p>
                <?php endif; ?>
            </div>
        </div>

        <?php if(isset($data['hotels']) && count($data['hotels']) > 0): ?>
            <!-- Hotel Results Grid -->
            <div class="results-container">
                <?php foreach($data['hotels'] as $index => $hotel): ?>
                    <div class="hotel-card">
                        <div class="hotel-image-container">
                            <img src="<?= $hotel->image_path ? ROOT . '/'. $hotel->image_path : ROOT . '/assets/images/default_hotel.jpg' ?>" alt="<?= $hotel->hotelName ?>" class="hotel-image">
                            <?php if($index < 3): ?>
                                <div class="hotel-badge">Popular</div>
                            <?php endif; ?>
                        </div>
                        <div class="hotel-info">
                            <h3 class="hotel-name"><?= $hotel->hotelName ?></h3>
                            
                            <div class="hotel-description">
                                <?= substr($hotel->description_para1, 0, 120) ?>...
                            </div>

                            <div class="hotel-location">
                                <i class="fa-solid fa-location-dot"></i>
                                <span><?= $hotel->hotelAddress ?>, <?= $hotel->district ?></span>
                            </div>
                            
                            <div class="hotel-action">
                                <a href="<?= ROOT ?>/traveler/ViewParticularHotel/index/<?= $hotel->hotel_Id ?>" class="view-hotel-btn">View Hotel</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <!-- Empty State -->
            <div class="empty-state">
                <img src="<?= IMAGES ?>/illustrations/no_results.svg" alt="No results found">
                <h2>No Hotels Found</h2>
                <p>
                    We couldn't find any hotels registered in the selected district. 
                    Please try searching in a different district or check back later as our hotel network is continuously expanding.
                </p>
                <div class="empty-state-actions">
                    <a href="<?= ROOT ?>/traveler/findAHotel" class="empty-state-btn">
                        New Search
                    </a>
                    <a href="<?= ROOT ?>/traveler/RegisteredTravelerHome" class="empty-state-btn secondary">
                        Return to Home
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fade in the results with staggered animation
            const resultsContainer = document.querySelector('.results-container');
            if (resultsContainer) {
                const hotelCards = document.querySelectorAll('.hotel-card');
                
                hotelCards.forEach((card, index) => {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px)';
                    
                    setTimeout(() => {
                        card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, 100 + (index * 100)); // Staggered animation
                });
            }
            
            // Enhance empty state animation if present
            const emptyState = document.querySelector('.empty-state');
            if (emptyState) {
                emptyState.style.opacity = '0';
                emptyState.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    emptyState.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                    emptyState.style.opacity = '1';
                    emptyState.style.transform = 'translateY(0)';
                }, 100);
            }
        });
    </script>
</body>
</html>