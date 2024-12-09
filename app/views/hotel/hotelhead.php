<html>
 <head>
   <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
        }
        main {
            position:absolute;
            top: -200;
            left: 250px;
            height: 100vh;
            width: calc(100% - 250px);
        }
        .content {
            text-align: center;
        }
        .image-container {
            display: flex;
            justify-content: center;
            width: calc(100% - 3rem);
            margin-left: 1.5rem;
            margin-right: 1.5rem;
            position: relative; /* Ensure relative positioning for the image container */
        }
        .image-container img {
            width: 100%;
            height: 175px;
            border-bottom-left-radius: 15px;  /* Curved bottom-left corner */
            border-bottom-right-radius: 15px; /* Curved bottom-right corner */
        }
        .title {
            font-size: 36px;
            font-weight: bold;
            color: white;
            position: absolute;
            top: 50%; /* Place the text in the middle of the image */
            left: 50%;
            transform: translate(-50%, -50%);
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7); /* Adds a shadow for better contrast */
            z-index: 1; /* Ensures the title appears above the image */
        }
        .date {
            font-size: 18px;
            color: #4b2e2e;
            margin-top: 10px;
        }
  </style>
 </head>
 <body>
    <main>
        <div class="content">
        <div class="image-container">
            <img alt="Hotel entrance with greenery and lights" src="<?=ROOT?>/assets/images/serviceProviders/hotelCover.jpg"/>
            <div class="title">
                CINNAMON GRAND
            </div>
        </div>
        <div class="date" id="current-date"></div>
        <!-- <script src="script.js"></script> -->
        </div>
    </main>
 </body>
 <script>
    function formatDate(date) {
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    return date.toLocaleDateString(undefined, options);
}

const today = new Date();
const formattedDate = formatDate(today);

document.getElementById('current-date').textContent = formattedDate;

 </script>
</html>
