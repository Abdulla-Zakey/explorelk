<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>All Restaurants - Travel Website</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
  <link rel="stylesheet" href="<?= CSS ?>/Traveler/navbar.css">

  <style>
    /* Reset and base styles */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
      background-color: #f9fafb;
      color: #374151;
      line-height: 1.5;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 2rem 1rem;
      margin-top: 100px;
    }

    /* Header styles */
    .header {
      margin-bottom: 2rem;
    }

    .header h1 {
      font-size: 1.875rem;
      font-weight: 700;
      margin-bottom: 1.5rem;
      color: #111827;
    }

    .search-container {
      position: relative;
    }

    .search-icon {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      width: 16px;
      height: 16px;
      color: #6b7280;
    }

    .search-input {
      width: 100%;
      padding: 0.75rem 1rem 0.75rem 2.5rem;
      border: 1px solid #d1d5db;
      border-radius: 0.375rem;
      font-size: 0.875rem;
      background-color: white;
      outline: none;
      transition: border-color 0.2s, box-shadow 0.2s;
    }

    .search-input:focus {
      border-color: #3b82f6;
      box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.3);
    }

    /* Restaurant grid */
    .restaurant-grid {
      display: grid;
      grid-template-columns: 1fr;
      gap: 1.5rem;
    }

    @media (min-width: 768px) {
      .restaurant-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (min-width: 1024px) {
      .restaurant-grid {
        grid-template-columns: repeat(3, 1fr);
      }
    }

    @media (min-width: 1280px) {
      .restaurant-grid {
        grid-template-columns: repeat(4, 1fr);
      }
    }

    /* Restaurant card */
    .restaurant-card {
      background-color: white;
      border-radius: 0.5rem;
      overflow: hidden;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
    }

    .restaurant-card:hover {
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      transform: translateY(-2px);
    }

    .restaurant-image {
      position: relative;
      height: 12rem;
      width: 100%;
      overflow: hidden;
    }

    .restaurant-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .restaurant-content {
      padding: 1rem;
    }

    .restaurant-name {
      font-size: 1.25rem;
      font-weight: 600;
      margin-bottom: 0.75rem;
      color: #111827;
    }

    .restaurant-info {
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
      font-size: 0.875rem;
    }

    .info-item {
      display: flex;
      align-items: flex-start;
    }

    .info-icon {
      width: 16px;
      height: 16px;
      margin-right: 0.5rem;
      margin-top: 0.125rem;
      flex-shrink: 0;
      color: #6b7280;
    }

    .info-text {
      color: #4b5563;
      word-break: break-all;
    }
  </style>
</head>
<body>
  <header>
    <nav class="navbar">
      <div class="backToHome">
        <a href="javascript:history.back()">
          <i class="fa-solid fa-arrow-left"></i>
          <span>Back</span>
        </a>
      </div>
    </nav>
  </header>
  <div class="container">
    <header class="header">
      <h1>All Restaurants</h1>
      <div class="search-container">
        <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="11" cy="11" r="8"></circle>
          <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
        <input type="text" class="search-input" id="search-input" placeholder="Search restaurants by name, location or cuisine...">
      </div>
    </header>

    <main>
      <div class="restaurant-grid" id="restaurant-grid">
        <!-- Restaurant cards will be inserted here by JavaScript -->
      </div>
    </main>
  </div>

  <script>
    // Data from PHP
    const restaurantsData = <?php echo json_encode($data['restaurants']); ?>;
    const ROOT = '<?php echo ROOT; ?>'; // Inject ROOT constant into JavaScript
    console.log('Restaurants Data:', restaurantsData); // Debug

    // Function to create restaurant card HTML
    function createRestaurantCard(restaurant) {
      // Use profilePhoto if available, otherwise use a placeholder
      const imageUrl = restaurant.profilePhoto 
        ? ROOT + restaurant.profilePhoto 
        : 'https://placehold.co/300x200/e2e8f0/64748b?text=' + encodeURIComponent(restaurant.restaurantName || 'Restaurant');
      
      // Ensure restaurant ID is available (adjust field name as per your data structure)
      const restaurantId = restaurant.restaurantId || restaurant.id || '';

      return `
        <a href="${ROOT}/traveler/trestaurant?id=${restaurantId}" class="restaurant-card" style="text-decoration: none;">
          <div class="restaurant-image">
            <img src="${imageUrl}" alt="${restaurant.restaurantName || 'Restaurant'}">
          </div>
          <div class="restaurant-content">
            <h2 class="restaurant-name">${restaurant.restaurantName || 'Unknown Restaurant'}</h2>
            <div class="restaurant-info">
              <div class="info-item">
                <svg class="info-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                  <polyline points="22,6 12,13 2,6"></polyline>
                </svg>
                <span class="info-text">${restaurant.restaurantEmail || 'N/A'}</span>
              </div>
              <div class="info-item">
                <svg class="info-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                </svg>
                <span class="info-text">${restaurant.restaurantMobileNum || 'N/A'}</span>
              </div>
              <div class="info-item">
                <svg class="info-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                  <circle cx="12" cy="10" r="3"></circle>
                </svg>
                <span class="info-text">${restaurant.restaurantAddress || ''}${restaurant.district ? ', ' + restaurant.district : ''}${restaurant.province ? ', ' + restaurant.province : ''}</span>
              </div>
            </div>
          </div>
        </a>
      `;
    }

    // Function to render all restaurants
    function renderRestaurants(restaurants) {
      const restaurantGrid = document.getElementById('restaurant-grid');
      restaurantGrid.innerHTML = '';
      
      if (restaurants.length === 0) {
        restaurantGrid.innerHTML = '<p style="grid-column: 1/-1; text-align: center; padding: 2rem;">No restaurants found matching your search.</p>';
        return;
      }
      
      restaurants.forEach(restaurant => {
        const restaurantHTML = createRestaurantCard(restaurant);
        restaurantGrid.innerHTML += restaurantHTML;
      });
    }

    // Function to filter restaurants based on search input
    function filterRestaurants(searchTerm) {
      if (!searchTerm) {
        console.log('No search term, returning all restaurants'); // Debug
        return restaurantsData;
      }
      
      searchTerm = searchTerm.toLowerCase().trim();
      const filtered = restaurantsData.filter(restaurant => {
        return (
          (restaurant.restaurantName || '').toLowerCase().includes(searchTerm) ||
          (restaurant.restaurantAddress || '').toLowerCase().includes(searchTerm) ||
          (restaurant.district || '').toLowerCase().includes(searchTerm) ||
          (restaurant.province || '').toLowerCase().includes(searchTerm) ||
          (restaurant.restaurantEmail || '').toLowerCase().includes(searchTerm)
        );
      });
      console.log('Filtered restaurants:', filtered); // Debug
      return filtered;
    }

    // Initialize the page
    document.addEventListener('DOMContentLoaded', () => {
      // Render all restaurants initially
      renderRestaurants(restaurantsData);
      
      // Add search functionality
      const searchInput = document.getElementById('search-input');
      searchInput.addEventListener('input', (e) => {
        console.log('Search input:', e.target.value); // Debug
        const searchTerm = e.target.value;
        const filteredRestaurants = filterRestaurants(searchTerm);
        renderRestaurants(filteredRestaurants);
      });
    });
  </script>
</body>
</html>