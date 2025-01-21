// navHighlight.js

// Highlight active link
const currentPath = window.location.pathname + window.location.search; // Full path with query
const navLinks = document.querySelectorAll('.linkHolder a');

navLinks.forEach(link => {
    const linkPath = new URL(link.href).pathname; // Extract full pathname from href
    if (linkPath === currentPath) {
        link.classList.add('active');
    }
});