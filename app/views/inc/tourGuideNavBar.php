<div class = "leftPanel">
    <div class = "logo">
        <img src = "<?= ROOT ?>/assets/images/Logos/Logo_White.png" alt = "Logo">
        <h1>
            ExploreLK
        </h1>
    </div>

    <div class = "linkHolder">
        <a href = "<?= ROOT?>/tourGuide/C_dashboard" class = "linkItem"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
    </div>

    <div class = "linkHolder">
        <a href = "<?= ROOT?>/tourGuide/C_bookingRequests" class = "linkItem"><i class="fas fa-envelope"></i>Booking Requests</a>
    </div>

    <div class = "linkHolder">
        <a href = "<?= ROOT?>/tourGuide/C_bookings" class = "linkItem"><i class="fas fa-calendar-check"></i>My Bookings</a>
    </div>
    
    <div class = "linkHolder">
        <a href = "<?= ROOT?>/tourGuide/C_tourPackages" class = "linkItem"><i class="fas fa-map"></i>Tour Packages</a>
    </div>
    
    <div class = "linkHolder">
        <a href = "<?= ROOT?>/tourGuide/C_chats" class = "linkItem"><i class="fas fa-users"></i>Chats</a>
    </div>

    <div class = "linkHolder">
        <a href = "<?= ROOT?>/tourGuide/C_earnings" class = "linkItem"><i class="fas fa-dollar-sign"></i>Earnings</a>
    </div>

    <div class = "linkHolder">
        <a href = "<?= ROOT?>/tourGuide/C_availability" class = "linkItem"><i class="fas fa-calendar-alt"></i>Availability</a>
    </div>

    <div class = "linkHolder">
        <a href = "<?= ROOT?>/tourGuide/C_reviews" class = "linkItem"><i class="fas fa-star"></i>Reviews</a>
    </div>

    <div class = "linkHolder">
        <a href = "<?= ROOT?>/tourGuide/C_profile" class = "linkItem"><i class="fas fa-user-cog"></i>Profile Setup</a>
    </div>

    <div class = "linkHolder">
        <a href = "<?= ROOT ?>/traveler/Login/logout" class = "linkItem"><i class="fas fa-sign-out-alt"></i>Logout</a>
    </div>
</div>
<script>
const currentPath = window.location.pathname + window.location.search; // Full path with query
const navLinks = document.querySelectorAll('.linkHolder a');

navLinks.forEach(link => {
    const linkPath = new URL(link.href).pathname; // Extract full pathname from href
    if (linkPath === currentPath) {
        link.classList.add('active');
    }
});
</script>