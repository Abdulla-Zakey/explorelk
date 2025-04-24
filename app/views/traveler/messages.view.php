<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel = "stylesheet" href = "<?= CSS ?>/Traveler/registeredUser.css">
    <link rel = "stylesheet" href = "<?= CSS ?>/Traveler/messages.css">
    <link rel = "icon" href = "<?= IMAGES ?>/logos/logoBlack.svg">
    <title>ExploreLK | Mesaages</title>
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
   
</head>
<body>
    <div class = "mainContainer">

        <div class = "leftPanel">
            <div class = "logo">
                <img src = "<?= IMAGES ?>/logos/logoWhite.svg" alt = "Logo">
                <h1>
                    ExploreLK
                </h1>
            </div>

            <div class = "linkHolder">
                <a href = "<?= ROOT ?>/traveler/RegisteredTravelerHome" class = "linkItem"><i class="fa-solid fa-house"></i>Home</a>
            </div>

            <div class = "linkHolder">
                <a href = "<?= ROOT ?>/traveler/MyTrips" class = "linkItem"><i class="fa-solid fa-person-walking-luggage"></i>My Trips</a>
            </div>

            <div class = "linkHolder">
                <a href = "<?= ROOT ?>/traveler/MyBookings" class = "linkItem"><i class="fa-solid fa-book-open"></i>My Bookings</a>
            </div>

            <div id = "activeLink" class = "linkHolder">
                <a href = "<?= ROOT ?>/traveler/Messages" class = "linkItem" style="color:#002D40 ;"><i class="fa-solid fa-message"></i>Messages</a>
            </div>

            <div class = "linkHolder">
                <a href = "<?= ROOT ?>/traveler/Notifications" class = "linkItem">
                    <i class="fa-solid fa-bell"></i>
                    Notifications
                    <?php if(($data['unreadNotifications']) > 0): ?>
                        <span id="notificationCount" class="notificationCountIndicator">
                            <?= $data['unreadNotifications'] ?>
                        </span>
                    <?php endif; ?>
            </a>
            </div>

            <div class = "linkHolder">
                <a href = "<?= ROOT ?>/traveler/ViewProfile" class = "linkItem"><i class="fa-solid fa-user"></i>View Profile</a>
            </div>

            <div class = "linkHolder">
                <a href = "<?= ROOT ?>/traveler/EditProfile" class = "linkItem"><i class="fa-solid fa-user-pen"></i></i>Edit Profile</a>
            </div>

            <div class = "linkHolder">
                <a href="<?= ROOT ?>/traveler/Login/logout" class="linkItem">
                    <i class="fas fa-sign-out-alt"></i>Logout
                </a>
            </div>
            
            
        </div>

        <div class = "rightPane">
            <div class = "chats-Conatiner">
                <h1>
                    Messages
                </h1>

                <div class = "chatImageAndName-Conatiner" style = "background-color: #f2f2f2;">
                    <div class = "chatImage-Conatiner">
                        <img src = "<?= IMAGES ?>/travelers/messages/newLankaTransport.png">
                    </div>

                    <div class = "chatName-Conatiner">
                        <h2>
                            New Lanka Transports
                        </h2>
                        <span>
                            Welcome!
                        </span>
                    </div>
                </div>

                <div class = "chatImageAndName-Conatiner">
                    <div class = "chatImage-Conatiner">
                        <img src = "<?= IMAGES ?>/travelers/messages/hotelChatIcon.webp">
                    </div>

                    <div class = "chatName-Conatiner">
                        <h2>
                            Luxury Hotel
                        </h2>
                        <span>
                            Please check your email
                        </span>
                    </div>
                </div>

                <div class = "chatImageAndName-Conatiner">
                    <div class = "chatImage-Conatiner">
                        <img src = "<?= IMAGES ?>/travelers/messages/chatIcon3.png">
                    </div>

                    <div class = "chatName-Conatiner">
                        <h2>
                            Amanda Nethmini
                        </h2>
                        <span>
                            Sorry, food is not provided
                        </span>
                    </div>
                </div>

                <div class = "chatImageAndName-Conatiner">
                    <div class = "chatImage-Conatiner">
                        <img src = "<?= IMAGES ?>/travelers/messages/chatIcon4.png">
                    </div>

                    <div class = "chatName-Conatiner">
                        <h2>
                            Chamari Athapaththu
                        </h2>
                        <span>
                            We'll check and confirm you 
                        </span>
                    </div>
                </div>

                <div class = "chatImageAndName-Conatiner">
                    <div class = "chatImage-Conatiner">
                        <img src = "<?= IMAGES ?>/travelers/messages/chatIcon5.png">
                    </div>

                    <div class = "chatName-Conatiner">
                        <h2>
                            Hiruni Imasha
                        </h2>
                        <span>
                            It's my pleasure
                        </span>
                    </div>
                </div>

                <div class = "chatImageAndName-Conatiner">
                    <div class = "chatImage-Conatiner">
                        <img src = "<?= IMAGES ?>/travelers/messages/chatIcon6.png">
                    </div>

                    <div class = "chatName-Conatiner">
                        <h2>
                            Mahesh Raj
                        </h2>
                        <span>
                            See you at the location
                        </span>
                    </div>
                </div>

                

                


            </div>

            <div class = "message-Conatiner">

                <div class = "chatHeader">

                    <div class = "chatHeaderImage-Conatiner">
                        <img src = "<?= IMAGES ?>/travelers/messages/chatIcon1.png">
                    </div>

                    <div>
                        <h2>
                            New Lanka Transports
                        </h2>
                    </div>

                </div>

                <div class = "messages">

                    <div class = "sendMessages">
                        Hi there! I'm looking to rent a car for a 3 day trip around Nuwara Eliya. Any suggestions on a suitable vehicle?
                    </div>

                    <div class = "receiveMessages">
                        Hello
                    </div>

                    <div class = "receiveMessages">
                        A compact car like a Toyota Yaris or a Nissan Sunny would be ideal for exploring upcountry. It's fuel-efficient and easy to maneuver.
                    </div>

                    <div class = "sendMessages">
                        Okay, that sounds good.
                    </div>

                    <div class = "receiveMessages">
                        Glad to hear. If you need further assistanse please feel free to reach us.
                    </div>

                    <div class = "sendMessages">
                        Thanks, I'll check the collection and if anything so I'll let you know.
                    </div>

                    <div class = "sendMessages">
                        Hey, I just wanted to confirm that do we need to come and collect the car ?
                    </div>

                    <div class = "receiveMessages">
                        No, we will deliver the car to your location.
                    </div>

                    <div class = "sendMessages">
                        Great, thanks for letting me know.
                    </div>

                    <div class = "receiveMessages">
                        Welcome!
                    </div>

                </div>

                <div class="input-box">

                    <input type="text" placeholder="Message..." />
                    <div>
                        <button>&#9658;</button>
                    </div>
                    

                  </div>

            </div>


            
            
        </div>

    </div>
        
</body>
</html>