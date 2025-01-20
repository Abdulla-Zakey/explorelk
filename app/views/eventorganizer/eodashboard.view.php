<?php 
  $title = 'ExploreLK | EO - Home';
  include '../app/views/components/eonavbar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= CSS ?>/Eventorganizer/eodashboard.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <title><?= $title ?></title>
    <script src="https://kit.fontawesome.com/d11f03c652.js" crossorigin="anonymous"></script>
    
</head>

<body>

  <div class = "rightContainer">

    <div class="user-invite">
      <h1 >Welcome, Event Visionary!</h1>
    </div>

    <div class="event-create-outcontainer"> 
      <div class="event-create-container">
        <div class="event-create-img">
          <img src="<?php echo ROOT; ?>/assets/images/eo/pen-icon.png" alt="" class="round-img">
        </div>

        <div>
          <a href="<?= ROOT ?>/Eventorganizer/Eocreateevent">
            <button class="create-event-btn" type="button">Create an Event</button>
          </a>
        </div>
    </div>

    <div class="event-creater-image">
        <img src="<?php echo ROOT; ?>/assets/images/eo/event-org-icon.svg" alt="event-org-icon">
    </div>



  </div>
  
  
  
  <!-- <div class="event-create-outcontainer"> 
    <div class="event-create-container" style = "margin-left: 175px; margin-top: 50px">
      <div class="event-create-img">
          <img src="<?php echo ROOT; ?>/assets/images/eo/pen-icon.png" alt="" class="round-img">
      </div>

      <div> -->
      <!--<button id="create-event-btn" class="create-event-btn">Create An Event</button>-->      
           <!-- <a href="<?= ROOT ?>/Eventorganizer/Eocreateevent">
            <button class="create-event-btn" type="button">Create An Event</button>
          </a>
        </div>
      </div>
      
      <div class="event-creater-image" style = "margin-top: 85px; margin-left: 100px;">
        <img src="<?php echo ROOT; ?>/assets/images/eo/event-org-icon.svg" alt="event-org-icon">
      </div>
  </div> -->
  
  <script>
    document.getElementById("create-event-btn").addEventListener("click", function() {
        console.log("Button clicked!");  // This will log in the console if the button is clicked
        window.location.href = "/ExploreLKWithMVC/eocreateevent";  // Redirect to the PHP page
    });
  </script>

</body>
</html>


