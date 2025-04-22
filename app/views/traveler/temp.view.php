<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/registeredUser.css">
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/notification.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <title>ExploreLK | Notifications</title>
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
   
</head>

<body>
    <div class="mainContainer">
        <!-- Left panel with navigation links -->
        <div class="leftPanel">
            <div class="logo">
                <img src="<?= IMAGES ?>/logos/logoWhite.svg" alt="Logo">
                <h1>ExploreLK</h1>
            </div>

            <div class="linkHolder">
                <a href="<?= ROOT ?>/traveler/RegisteredTravelerHome" class="linkItem"><i
                        class="fa-solid fa-house"></i>Home</a>
            </div>

            <div class="linkHolder">
                <a href="<?= ROOT ?>/traveler/MyTrips" class="linkItem"><i
                        class="fa-solid fa-person-walking-luggage"></i>My Trips</a>
            </div>

            <div class="linkHolder">
                <a href="<?= ROOT ?>/traveler/MyBookings" class="linkItem"><i class="fa-solid fa-book-open"></i>My
                    Bookings</a>
            </div>

            <div class="linkHolder">
                <a href="<?= ROOT ?>/traveler/Messages" class="linkItem"><i class="fa-solid fa-message"></i>Messages</a>
            </div>

            <div id="activeLink" class="linkHolder">
                <a href="<?= ROOT ?>/traveler/Notifications" class="linkItem" style="color:#002D40 ;">
                    <i class="fa-solid fa-bell"></i>
                    Notifications<?php if(($data['unreadNotifications']) > 0): ?><span id="notificationCount" class="notificationCountIndicator"><?= $data['unreadNotifications'] ?></span><?php endif; ?>
                </a>
            </div>

            <div class="linkHolder">
                <a href="<?= ROOT ?>/traveler/ViewProfile" class="linkItem"><i class="fa-solid fa-user"></i>View
                    Profile</a>
            </div>

            <div class="linkHolder">
                <a href="<?= ROOT ?>/traveler/EditProfile" class="linkItem"><i class="fa-solid fa-user-pen"></i></i>Edit
                    Profile</a>
            </div>

            <div class="linkHolder">
                <a href="<?= ROOT ?>/traveler/Login/logout" class="linkItem">
                    <i class="fas fa-sign-out-alt"></i>Logout
                </a>
            </div>
        </div>

        <!-- Right panel with notifications content -->
        <div class="rightPanel">
            <div class="header-container">
                <h1>Notifications</h1>
                <?php if (($data['unreadNotifications']) > 0): ?>
                    <a href="<?= ROOT ?>/traveler/Notifications/markAllAsRead/traveler/<?= $_SESSION['traveler_id'] ?>" style="text-decoration: none;">
                        <button class="buttonStyle">
                            <i class="fa-solid fa-envelope-open"></i>Mark All as Read   
                        </button>
                    </a>
                <?php endif; ?>
            </div>

            <?php if (empty($data['todayNotifications']) && empty($data['thisWeekNotifications']) && empty($data['thisMonthNotifications'])): ?>
                <div class="notificationHolder empty-notifications">
                    <div class="empty-state-container">
                        <!-- Animated bell icon -->
                        <div class="animated-bell">
                            <i class="fa-regular fa-bell-slash"></i>
                        </div>

                        <h3 class="empty-state-title">
                            No Notifications Yet
                        </h3>
                        <p class="empty-state-message">
                            There are no notifications for you at the moment
                        </p>

                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($data['todayNotifications'])): ?>
                
                <div id="todayNotifications" class="notificationHolder">
                    <h2>Today</h2>
                    <?php foreach ($data['todayNotifications'] as $todayNotification): ?>
                        <div class="notificationItem unread new-notification">
                            <div class="profilePic">
                                <img src="<?= ROOT . '/' . $todayNotification->profilePic ?>" alt="profilePic">
                            </div>
                            <div class="notificationContent">

                                <div class="notificationTitle">
                                    <?= htmlspecialchars($todayNotification->notification_title) ?>
                                </div>

                                <div class="notificationText">
                                    <?= htmlspecialchars($todayNotification->notification_text) ?>
                                    <div class="notificationMeta">
                                        <span class="time-indicator">
                                            <?= htmlspecialchars(date('F d, Y, h:i A', strtotime($todayNotification->created_at))) ?>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="actionButtons">
                                <a href="<?= htmlspecialchars($todayNotification->buttonHyperLink) ?>" style="text-decoration: none;">
                                    <button class="primary-button">
                                        <i class="<?= htmlspecialchars($todayNotification->buttonIconClass) ?>"></i>
                                        <?= htmlspecialchars($todayNotification->buttonAction) ?>
                                    </button>
                                </a>
                                <?php if($todayNotification->is_read == 0):?>
                                    <a href= "<?= ROOT?>/traveler/Notifications/markAsRead/<?= $todayNotification->notification_Id ?>" style="text-decoration: none;">
                                        <button class="primary-button">
                                            <i class = "fas fa-envelope-open"></i>
                                            Mark as read
                                        </button>
                                    </a>
                                <?php endif;?>
                            </div>
                        </div>
                    
                    <?php endforeach; ?>
                </div>

            <?php endif; ?>

            <!-- This Week's notifications -->
            <?php if (!empty($data['thisWeekNotifications'])): ?>
                
                <div id="thisWeekNotifications" class="notificationHolder">
                    
                    <h2>This Week</h2>
                    <?php foreach ($data['thisWeekNotifications'] as $thisWeekNotification): ?>

                        <div class="notificationItem unread new-notification">
                            <div class="profilePic">
                                <img src="<?= ROOT . '/' . $thisWeekNotification->profilePic ?>" alt="profilePic">
                            </div>
                            <div class="notificationContent">

                                <div class="notificationTitle">
                                    <?= htmlspecialchars($thisWeekNotification->notification_title) ?>
                                </div>

                                <div class="notificationText">
                                    <?= htmlspecialchars($thisWeekNotification->notification_text) ?>
                                    <div class="notificationMeta">
                                        <span class="time-indicator">
                                            <?= htmlspecialchars(date('F d, Y, h:i A', strtotime($thisWeekNotification->created_at))) ?>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="actionButtons">
                                <a href="<?= htmlspecialchars($thisWeekNotification->buttonHyperLink) ?>" style="text-decoration: none;">
                                    <button class="primary-button">
                                        <i class="<?= htmlspecialchars($thisWeekNotification->buttonIconClass) ?>"></i>
                                        <?= htmlspecialchars($thisWeekNotification->buttonAction) ?>
                                    </button>
                                </a>
                                <?php if($thisWeekNotification->is_read == 0):?>
                                    <a href= "<?= ROOT?>/traveler/Notifications/markAsRead/<?= $thisWeekNotification->notification_Id ?>" style="text-decoration: none;">
                                        <button class="primary-button">
                                            <i class = "fas fa-envelope-open"></i>
                                            Mark as read
                                        </button>
                                    </a>
                                <?php endif;?>
                            </div>
                        </div>
                
                    <?php endforeach; ?>
                </div>

            <?php endif; ?>

            <!-- This Month's notifications -->
            <?php if (!empty($data['thisMonthNotifications'])): ?>
                
                <div id="thisWeekNotifications" class="notificationHolder">
                    
                    <h2>This Month</h2>
                    
                    <?php foreach ($data['thisMonthNotifications'] as $thisMonthNotification): ?>

                        <div class="notificationItem unread new-notification">
                            <div class="profilePic">
                                <img src="<?= ROOT . '/' . $thisMonthNotification->profilePic ?>" alt="profilePic">
                            </div>
                            <div class="notificationContent">

                                <div class="notificationTitle">
                                    <?= htmlspecialchars($thisMonthNotification->notification_title) ?>
                                </div>

                                <div class="notificationText">
                                    <?= htmlspecialchars($thisMonthNotification->notification_text) ?>
                                    <div class="notificationMeta">
                                        <span class="time-indicator">
                                            <?= htmlspecialchars(date('F d, Y, h:i A', strtotime($thisMonthNotification->created_at))) ?>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="actionButtons">
                                <a href="<?= htmlspecialchars($thisMonthNotification->buttonHyperLink) ?>" style="text-decoration: none;">
                                    <button class="primary-button">
                                        <i class="<?= htmlspecialchars($thisMonthNotification->buttonIconClass) ?>"></i>
                                        <?= htmlspecialchars($thisMonthNotification->buttonAction) ?>
                                    </button>
                                </a>
                                <?php if($thisMonthNotification->is_read == 0):?>
                                    <a href= "<?= ROOT?>/traveler/Notifications/markAsRead/<?= $thisMonthNotification->notification_Id ?>" style="text-decoration: none;">
                                        <button class="primary-button">
                                            <i class = "fas fa-envelope-open"></i>
                                            Mark as read
                                        </button>
                                    </a>
                                <?php endif;?>
                            </div>
                        </div>
                    
                    <?php endforeach; ?>

                </div>

            <?php endif; ?>

        </div>

    </div>

</body>

</html>