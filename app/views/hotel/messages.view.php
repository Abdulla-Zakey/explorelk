<?php 
    include_once APPROOT.'/views/hotel/nav.php';
    include_once APPROOT.'/views/hotel/hotelhead.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin-top: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            min-height: 90vh;
            background-color: #f4f4f4;
            color: #333;
            width: 75%;
            border-radius: 15px;
        }

        .flexContainer {
            display: flex;
            width: 100%;
            flex-wrap: wrap;
            height: 40vh;
            border-radius: 50%;
        }

        .body-container {
          position: absolute; 
          bottom: 260px; 
          top:198px;
          right: 11px;
          display: flex;
          justify-content: space-between;
          width: 100%;
          max-width: 1165px;
          margin: 0;
          padding: 15px;
          border-radius: 50%;
        }

        .sidebar1 {
            width: 25%;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 15px;
        }

        .heading h2 {
            font-size: 1.5em;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .contact {
            display: flex;
            align-items: center;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .contact.active {
            background-color: #B3D9FF;
        }

        .contact img {
            border-radius: 50%;
            width: 50px;
            height: 50px;
            margin-right: 15px;
        }

        .contact-info .name {
            font-weight: 600;
            font-size: 1.1em;
        }

        .contact-info .preview {
            color: #777;
            font-size: 14px;
        }

        .contact:hover {
            background-color: #B3D9FF;
        }

        .chat {
            width: 75%;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }

        .chat-header {
            display: flex;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid #ddd;
        }

        .chat-header img {
            border-radius: 50%;
            width: 50px;
            height: 50px;
            margin-right: 15px;
        }

        .chat-header h3 {
            font-size: 1.2em;
            font-weight: bold;
        }

        .chat-messages {
            flex-grow: 1;
            padding: 15px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            overflow-y: auto;
        }
       
        .message {
            padding: 10px 15px;
            background-color: #f0f0f0;
            border-radius: 15px;
            max-width: 70%;
            font-size: 0.9rem;
            line-height: 1.4;
        }

        .message.reply {
            align-self: flex-end;
            background-color: #B3D9FF;
        }

        .chat-input {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            border-top: 1px solid #ddd;
            background-color: #fff;
        }

        .chat-input input {
            flex-grow: 1;
            padding: 10px;
            border-radius: 25px;
            border: 1px solid #ddd;
            font-size: 1rem;
            margin-right: 10px;
        }

        .chat-input button {
            background-color: #002D40;
            border: none;
            color: white;
            font-size: 1.2rem;
            padding: 0.625rem 1rem;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .chat-input button:hover {
            background-color: #B3D9FF;
        }
    </style>
    <title>Dynamic Chat</title>
</head>
<body>
    <div class="body-container flexContainer">
        <div class="sidebar1">
            <div class="heading">
                <h2>Messages</h2>
            </div>
            <div class="contact" data-contact="james">
                <img src="<?=ROOT?>/assets/images/profile.jpg" alt="James Bond">
                <div class="contact-info">
                    <p class="name">James Bond</p>
                    <p class="preview">Thank you! That was very helpful!</p>
                </div>
            </div>
            <div class="contact" data-contact="kate">
                <img src="<?=ROOT?>/assets/images/profile1.jpg" alt="Kate Upton">
                <div class="contact-info">
                    <p class="name">Kate Upton</p>
                    <p class="preview">See you at the location.</p>
                </div>
            </div>
            <div class="contact active" data-contact="beth">
                <img src="<?=ROOT?>/assets/images/profile2.jpg" alt="Beth Moonie">
                <div class="contact-info">
                    <p class="name">Beth Moonie</p>
                    <p class="preview">And finish with a visit to the viewpoint for sunset.</p>
                </div>
            </div>
            <div class="contact" data-contact="will">
                <img src="<?=ROOT?>/assets/images/profile3.jpg" alt="Will Jacks">
                <div class="contact-info">
                    <p class="name">Will Jacks</p>
                    <p class="preview">We provide refunds, if you cancel prior 3 days to the event.</p>
                </div>
            </div>
        </div>
        <div class="chat">
            <div class="chat-header">
                <img src="<?=ROOT?>/assets/images/profile2.jpg" alt="Beth Moonie">
                <h3>Beth Moonie</h3>
            </div>
            <div class="chat-messages" id="chat-messages">
                <div class="message">Hello</div>
                <div class="message">Are you the tour guide for the city tour?</div>
                <div class="message reply">Yes, that’s me! Welcome! Are you excited to explore the city?</div>
                <div class="message">Absolutely! I heard there are some amazing spots there. Where will we be going?</div>
                <div class="message reply">We’ll start with the historic old town.</div>
                <div class="message reply">And finish with a visit to the viewpoint for sunset.</div>
            </div>
            <div class="chat-input">
                <input type="text" placeholder="Message...">
                <button>&#x27A4;</button>
      
            </div>
        </div>
    </div>

    <script>
        const contacts = {
            james: [
                { text: "Hey there!", type: "received" },
                { text: "Thank you! That was very helpful!", type: "received" }
            ],
            kate: [
                { text: "See you at the location.", type: "received" }
            ],
            beth: [
                { text: "Hello", type: "received" },
                { text: "Are you the tour guide for the city tour?", type: "received" },
                { text: "Yes, that’s me! Welcome! Are you excited to explore the city?", type: "sent" },
                { text: "Absolutely! I heard there are some amazing spots there. Where will we be going?", type: "received" },
                { text: "We’ll start with the historic old town.", type: "sent" },
                { text: "Then head to the main market for some local snacks.", type: "sent" },
                
            ],
            will: [
                { text: "We provide refunds, if you cancel prior 3 days to the event.", type: "received" }
            ]
        };

        const chatMessages = document.getElementById("chat-messages");
        const contactElements = document.querySelectorAll(".contact");

        contactElements.forEach(contact => {
            contact.addEventListener("click", () => {
                document.querySelector(".contact.active").classList.remove("active");
                contact.classList.add("active");

                const contactKey = contact.getAttribute("data-contact");
                const messages = contacts[contactKey];

                chatMessages.innerHTML = "";
                messages.forEach(msg => {
                    const messageDiv = document.createElement("div");
                    messageDiv.classList.add("message");
                    if (msg.type === "sent") {
                        messageDiv.classList.add("reply");
                    }
                    messageDiv.textContent = msg.text;
                    chatMessages.appendChild(messageDiv);
                });

                const contactName = contact.querySelector(".name").textContent;
                const chatHeader = document.querySelector(".chat-header");
                chatHeader.querySelector("h3").textContent = contactName;
                chatHeader.querySelector("img").src = contact.querySelector("img").src;
            });
        });
    </script>
</body>
</html>
