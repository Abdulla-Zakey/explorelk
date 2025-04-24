
<!DOCTYPE html>
<html lang="en">
 <head>
 <link rel="stylesheet" href="<?= ROOT ?>/assets/css/hotel/hotelhead.css?v=1.0">
 </head>
 <body>
    <main>
        <div class="content">
        <div class="image-container">
            <img alt="Hotel entrance with greenery and lights" src="<?=ROOT?>/assets/images/serviceProviders/hotelCover.jpg"/>
            <div class="title">
            <?= htmlspecialchars($data['hotelBasic']->hotelName ?? "Default Hotel") ?>

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
