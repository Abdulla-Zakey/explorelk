<html lang="en"></html>
<head>
    <title>ExploreLK Admin</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/admin.css?v=1.0">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/d11f03c652.js" crossorigin="anonymous"></script>
    <script src="<?= ROOT ?>/assets/js/admin/admin.js?v=1.0"></script>
</head>
<body>
    <div class="flexContainer">
        
        <?php include_once APPROOT.'\views\inc\adminNavBar.php'; ?>

        <div class="body-container">
            <?php include_once APPROOT.'\views\inc\profileLink.php'; ?>

            <div class="content-management-detailed-container">
                <a href="<?=ROOT?>/admin/C_contentManagement" class="back_button">&larr; Back</a>
                <h1 class="heading">Gartmore Falls</h1>
                <h2 class="sub-heading" style="margin-top: -2%;">Sri Lanka's Hidden Gem for Waterfall Chasers: Gartmore Falls</h2>
                <p class="description">
                    Gartmore Falls offers a peaceful retreat where you can relax and immerse yourself in the natural surroundings.
                    The misty spray from the falls, combined with the cool mountain breeze, creates a refreshing atmosphere that
                    rejuvenates both body and soul...
                </p>
                <p class="full-description">
                    In a land of beautiful waterfalls, Gartmore Falls ranks near the top. This stunning two-tier waterfall features not
                    only a dramatic 30-metre drop but a natural infinity pool that you can bathe in. Relaxing at the top waterfall is one
                    of the most unique things to do in Sri Lanka. And if all that wasn't enough, Gartmore Falls is still completely off the
                    beaten track in Sri Lanka, meaning few foreign tourists even know about it, let alone visit.
                </p>
                <p><strong>Location:</strong> Maskeliya, Sri Lanka</p>
                <p><strong>Province:</strong> Central Province</p>
                <h3>Photos</h3>
                <div class="photo-gallery">
                    <img src="<?=ROOT?>/assets/images/tourGuide/gartmore 1.png" alt="Gartmore Falls 1">
                    <img src="<?=ROOT?>/assets/images/tourGuide/gartmore 2.png" alt="Gartmore Falls 2">
                    <img src="<?=ROOT?>/assets/images/tourGuide/gartmore 3.png" alt="Maskeliya">
                    <img src="<?=ROOT?>/assets/images/tourGuide/gartmore 4.png" alt="Gartmore Falls 4">
                </div>
                <a href="#" class="edit-content">Edit Content</a>
            </div>
        </div>
    </div>
</body>
</html>