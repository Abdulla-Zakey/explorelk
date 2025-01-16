document.addEventListener("DOMContentLoaded", () => {
    // Function to toggle submenu visibility
    const toggleSubmenu = (action, submenu) => {
        if (action === "show") {
            submenu.style.display = "block";
        } else if (action === "hide") {
            submenu.style.display = "none";
        }
    };

    // Initialize hover functionality for a menu
    const initializeMenuHover = (menuLinkId, submenuId) => {
        const menuLink = document.getElementById(menuLinkId);
        const submenu = document.getElementById(submenuId);

        menuLink.addEventListener("mouseenter", () => toggleSubmenu("show", submenu));
        submenu.addEventListener("mouseenter", () => toggleSubmenu("show", submenu));

        menuLink.addEventListener("mouseleave", () => toggleSubmenu("hide", submenu));
        submenu.addEventListener("mouseleave", () => toggleSubmenu("hide", submenu));
    };

    // Apply hover functionality for Users menu
    initializeMenuHover("usersLink", "usersSubmenu");

    // Apply hover functionality for Bookings menu
    initializeMenuHover("bookingsLink", "bookingsSubmenu");

    // Apply hover functionality for Earnings menu
    initializeMenuHover("earningsLink", "earningsSubmenu");
});


