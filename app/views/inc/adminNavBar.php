<div class="leftPanel">
    <div class="logo">
        <img src="<?= ROOT ?>/assets/images/Logos/Logo_White.png" alt="Logo">
        <h1>
            ExploreLK
        </h1>
    </div>

    <div class="linkHolder">
        <a href="<?= ROOT?>/admin/C_dashboard" class="linkItem"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
    </div>

    <div class="linkHolder">
        <a href="<?= ROOT?>/admin/C_newRegistrations" class="linkItem"><i class="fa-solid fa-user-plus"></i>New
            Registrations</a>
    </div>

    <div class="linkHolder">
        <a href="<?= ROOT?>/admin/C_bookings" id="bookingsLink" class="linkItem">
            <i class="fas fa-calendar-check"></i>Bookings
        </a>

        <div class="submenu" id="bookingsSubmenu">
            <a href="<?= ROOT?>/admin/C_bookings_travellers">Travellers</a>
            <a href="<?= ROOT?>/admin/C_bookings_carRentals">Car Rentals</a>
            <a href="<?= ROOT?>/admin/C_bookings_tourGuides">Tour Guides</a>
            <a href="<?= ROOT?>/admin/C_bookings_eventOrganizers">Event Organizers</a>
            <a href="<?= ROOT?>/admin/C_bookings_hotels">Hotels & Restaurants</a>
        </div>
    </div>

    <div class="linkHolder">
        <a href="<?= ROOT?>/admin/C_commissions" id="earningsLink" class="linkItem">
            <i class="fas fa-dollar-sign"></i>Earnings
        </a>
        <div class="submenu" id="earningsSubmenu">
            <a href="<?= ROOT?>/admin/C_earnings_carRentals">Car Rentals</a>
            <a href="<?= ROOT?>/admin/C_earnings_tourGuides">Tour Guides</a>
            <a href="<?= ROOT?>/admin/C_earnings_eventOrganizers">Event Organizers</a>
            <a href="<?= ROOT?>/admin/C_earnings_hotelsRestaurants">Hotels & Restaurants</a>
        </div>
    </div>

    <div class="linkHolder">
        <a href="<?= ROOT?>/admin/C_users" id="usersLink" class="linkItem">
            <i class="fas fa-users"></i>Users
        </a>
        <div class="submenu" id="usersSubmenu">
            <a href="<?= ROOT?>/admin/C_users_travellers">Travellers</a>
            <a href="<?= ROOT?>/admin/C_users_carRentals">Car Rentals</a>
            <a href="<?= ROOT?>/admin/C_users_tourGuides">Tour Guides</a>
            <a href="<?= ROOT?>/admin/C_users_eventOrganizers">Event Organizers</a>
            <a href="<?= ROOT?>/admin/C_users_hotelsRestaurants">Hotels & Restaurants</a>
        </div>
    </div>

    <div class="linkHolder">
        <a href="<?= ROOT?>/admin/C_complaints" class="linkItem"><i class="fas fa-comments"></i>Complaints</a>
    </div>

    <div class="linkHolder">
        <a href="<?= ROOT?>/admin/C_attractions" class="linkItem"><i class="fas fa-umbrella-beach"></i> Attractions</a>
    </div>

    <div class="linkHolder">
        <a href="<?= ROOT?>/admin/C_report" class="linkItem"><i class="fas fa-chart-bar"></i>Report</a>
    </div>

    <div class="linkHolder">
        <a href="<?= ROOT?>/admin/C_profile" class="linkItem"><i class="fas fa-user-cog"></i>Profile Setup</a>
    </div>

    <div class="linkHolder">
        <a href="<?= ROOT?>/admin/C_adminLogin/logout" class="linkItem"><i class="fas fa-sign-out-alt"></i>Logout</a>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const currentPath = window.location.pathname; // Get current path
    const navLinks = document.querySelectorAll('.linkHolder > a'); // Select only main navigation links

    navLinks.forEach(link => {
        const linkPath = new URL(link.href, window.location.origin).pathname; // Ensure absolute path

        if (linkPath === currentPath) {
            link.classList.add('active');
        }
    });
});
</script>