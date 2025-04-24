<?php
    $title = "ExploreLK | EO - My Events";
    include '../app/views/components/eonavbar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= CSS ?>/Eventorganizer/eomyevents.css">
    <title><?= $title ?></title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #F0F4F8;
            color: #333333;
        }

        .container {
            max-width: 1200px;
            margin-left: 275px;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #002D40;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .search-container {
            position: relative;
            max-width: 300px;
            width: 100%;
        }

        #searchInput {
            width: 100%;
            padding: 12px 12px 12px 40px;
            border: none;
            border-radius: 25px;
            font-size: 1rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        #searchInput:focus {
            outline: none;
            box-shadow: 0 2px 20px rgba(0,0,0,0.2);
        }

        .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #666666;
        }

        .create-btn {
            background-color: #002D40;
            color: #FFFFFF;
            border: none;
            padding: 12px 25px;
            border-radius: 25px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .create-btn:hover {
            background-color: #004D6E;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .event-header {
            display: grid;
            grid-template-columns: 1fr 3fr 1fr 1fr auto;
            gap: 20px;
            background-color: #002D40;
            color: #FFFFFF;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .event-card {
            display: grid;
            grid-template-columns: 1fr 3fr 1fr 1fr auto;
            gap: 20px;
            align-items: center;
            background-color: #FFFFFF;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        .date {
            text-align: center;
            background-color: #002D40;
            color: #FFFFFF;
            padding: 10px;
            border-radius: 8px;
        }

        .date .month {
            font-size: 0.9rem;
            font-weight: 500;
            text-transform: uppercase;
        }

        .date .day {
            font-size: 1.8rem;
            font-weight: 700;
            line-height: 1;
        }

        .event-details {
            display: flex;
            gap: 15px;
        }

        .event-details img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .event-info h3 {
            margin: 0 0 5px 0;
            color: #002D40;
        }

        .event-info p {
            margin: 0;
            font-size: 0.9rem;
            color: #666666;
        }

        .sold, .income {
            font-weight: 600;
            color: #002D40;
        }

        .more-btn {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1.5rem;
            color: #666666;
            transition: all 0.3s ease;
        }

        .more-btn:hover {
            color: #00A896;
            transform: rotate(90deg);
        }

        .no-events {
            text-align: center;
            padding: 20px;
            color: #666;
            font-style: italic;
        }

        @media (max-width: 768px) {
            .event-header, .event-card {
                grid-template-columns: 1fr 2fr 1fr;
            }
            .event-header div:nth-child(4), .event-card div:nth-child(4) {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .event-header, .event-card {
                grid-template-columns: 1fr;
                gap: 10px;
            }
            .event-header {
                display: none;
            }
            .event-details {
                flex-direction: column;
            }
            .event-details img {
                width: 100%;
                height: 150px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>My Events</h1>
        <div class="header">
            <div class="search-container">
                <input type="text" id="searchInput" placeholder="Search Events" disabled>
                <span class="search-icon">🔍</span>
            </div>
            <a href="<?= ROOT ?>/Eventorganizer/Eocreateevent">
                <button class="create-btn">Create An Event</button>
            </a>
        </div>
        <div class="event-header">
            <div>Date</div>
            <div>Event</div>
            <div>Sold</div>
            <div>Income</div>
            <div></div>
        </div>
        <div id="eventsList">
            <?php if (!empty($data['events'])): ?>
                <?php foreach ($data['events'] as $event): ?>
                    <div class="event-card">
                        <div class="date">
                            <div class="month"><?= isset($event->eventDate) ? date('M', strtotime($event->eventDate)) : 'N/A' ?></div>
                            <div class="day"><?= isset($event->eventDate) ? date('d', strtotime($event->eventDate)) : 'N/A' ?></div>
                        </div>
                        <div class="event-details">
                            <img src="<?= !empty($event->eventWebBannerPath) ? htmlspecialchars($event->eventWebBannerPath) : 'https://via.placeholder.com/150' ?>" alt="<?= htmlspecialchars($event->eventName ?? 'Untitled Event') ?>">
                            <div class="event-info">
                                <h3><?= htmlspecialchars($event->eventName ?? 'Untitled Event') ?></h3>
                                <p><?= htmlspecialchars($event->eventLocation ?? 'Unknown Location') ?></p>
                                <p>
                                    <?= isset($event->eventDate) ? date('l, F d, Y', strtotime($event->eventDate)) : 'N/A' ?>
                                    at <?= isset($event->eventStartTime) ? date('h:ia', strtotime($event->eventStartTime)) : 'N/A' ?>
                                    to <?= isset($event->eventEndTime) ? date('h:ia', strtotime($event->eventEndTime)) : 'N/A' ?>
                                </p>
                            </div>
                        </div>
                        <div class="sold">0 / <?= $event->ticketCount ?? 'N/A' ?></div>
                        <div class="income">Rs0</div>
                        <a href="<?= ROOT ?>/Eventorganizer/Eventdetails/<?= $event->event_Id ?? 0 ?>" class="more-btn">⋮</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no-events">No events found.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>