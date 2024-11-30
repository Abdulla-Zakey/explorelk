<?php 
  include '../app/views/components/eonavbar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard</title>
    <link rel="stylesheet" href="<?php echo ROOT; ?>/assets/css/Eventorganizer/eodashboard.css">


</head>
<body>
  <div>
    <div class="user-invite">
    <h1>Hi There, Sangeerth!!!</h1>
    </div>
  </div>
  
  <div class="event-create-outcontainer"> 
      <div class="event-create-container">
          <div class="event-create-img">
          <img src="<?php echo ROOT; ?>/assets/images/eo/pen-icon.png" alt="" class="round-img">
          </div>
          <div>
<!--           <button id="create-event-btn" class="create-event-btn">Create An Event</button>
 -->          <a href="Eocreateevent">
          <button class="create-event-btn" type="button">Create An Event</button>
          </a>
          </div>
      </div>
      
      <div class="event-creater-image">
        <img src="<?php echo ROOT; ?>/assets/images/eo/event-org-icon.svg" alt="event-org-icon">
      </div>
  </div>
  
  <script>
    document.getElementById("create-event-btn").addEventListener("click", function() {
        console.log("Button clicked!");  // This will log in the console if the button is clicked
        window.location.href = "/ExploreLKWithMVC/eocreateevent";  // Redirect to the PHP page
    });
  </script>

</body>
</html>


