<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bistro Moderne - Restaurant Reservation</title>
  <!-- <link rel="stylesheet" href="styles.css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    
  <!-- Header -->
  <header class="header">
    <div class="container">
      <h1 class="logo">Bistro Moderne</h1>
      <nav class="nav">
        <button class="nav-link active" data-tab="tables">Tables</button>
        <button class="nav-link" data-tab="reservations">My Reservations</button>
        <button class="nav-link" data-tab="menu">Menu</button>
      </nav>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="hero">
    <div class="container">
      <h2 class="hero-title">Fine Dining Experience</h2>
      <p class="hero-description">
        Reserve your table at Bistro Moderne and enjoy our carefully crafted menu in an elegant atmosphere.
      </p>
      <div class="hero-buttons">
        <button class="btn btn-primary" data-tab="tables">Reserve a Table</button>
        <button class="btn btn-secondary" data-tab="menu">View Menu</button>
      </div>
    </div>
  </section>

  <!-- Main Content -->
  <section class="main-content">
    <div class="container">
      <!-- Tabs Navigation -->
      <div class="tabs">
        <button class="tab-btn active" data-tab="tables">Tables</button>
        <button class="tab-btn" data-tab="reservations">My Reservations</button>
        <button class="tab-btn" data-tab="menu">Menu</button>
      </div>

      <!-- Tables Tab -->
      <div class="tab-content active" id="tables-tab">
        <h2 class="section-title">Reserve a Table</h2>
        <div class="table-reservation">
          <div class="sidebar">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Select a Date</h3>
              </div>
              <div class="card-content">
                <div class="calendar" id="reservation-calendar"></div>
                
                <div class="filter-section">
                  <h4 class="filter-title">Filter by Location</h4>
                  <div class="filter-badges">
                    <span class="badge badge-active" data-filter="location" data-value="All">All</span>
                    <span class="badge badge-blue" data-filter="location" data-value="Indoor">Indoor</span>
                    <span class="badge badge-green" data-filter="location" data-value="Outdoor">Outdoor</span>
                    <span class="badge badge-purple" data-filter="location" data-value="VIP">VIP</span>
                  </div>
                </div>
                
                <div class="filter-section">
                  <h4 class="filter-title">Filter by Capacity</h4>
                  <div class="filter-badges">
                    <span class="badge badge-active" data-filter="capacity" data-value="All">All</span>
                    <span class="badge" data-filter="capacity" data-value="2">2+ People</span>
                    <span class="badge" data-filter="capacity" data-value="4">4+ People</span>
                    <span class="badge" data-filter="capacity" data-value="6">6+ People</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="main-area">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Available Tables for <span id="selected-date"></span></h3>
              </div>
              <div class="card-content">
                <div class="tables-grid" id="tables-grid">
                  <!-- Tables will be dynamically inserted here -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- My Reservations Tab -->
      <div class="tab-content" id="reservations-tab">
        <h2 class="section-title">My Reservations</h2>
        <div class="policy-alert">
          <h3 class="alert-title">Cancellation Policy</h3>
          <p class="alert-text">
            Reservations can be cancelled up to 24 hours before the scheduled time. Cancellations within 24 hours may
            incur a fee or forfeit any deposit.
          </p>
        </div>
        <div class="reservations-grid" id="my-reservations-grid">
          <!-- Reservations will be dynamically inserted here -->
        </div>
      </div>

      <!-- Menu Tab -->
      <div class="tab-content" id="menu-tab">
        <h2 class="section-title">Our Menu</h2>
        <div class="menu-tabs">
          <button class="menu-tab-btn active" data-menu="starters">Starters</button>
          <button class="menu-tab-btn" data-menu="mains">Mains</button>
          <button class="menu-tab-btn" data-menu="desserts">Desserts</button>
          <button class="menu-tab-btn" data-menu="drinks">Drinks</button>
        </div>
        
        <div class="menu-content active" id="starters-menu">
          <div class="menu-grid" id="starters-grid">
            <!-- Menu items will be dynamically inserted here -->
          </div>
        </div>
        
        <div class="menu-content" id="mains-menu">
          <div class="menu-grid" id="mains-grid">
            <!-- Menu items will be dynamically inserted here -->
          </div>
        </div>
        
        <div class="menu-content" id="desserts-menu">
          <div class="menu-grid" id="desserts-grid">
            <!-- Menu items will be dynamically inserted here -->
          </div>
        </div>
        
        <div class="menu-content" id="drinks-menu">
          <div class="menu-grid" id="drinks-grid">
            <!-- Menu items will be dynamically inserted here -->
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-column">
          <h3 class="footer-title">Bistro Moderne</h3>
          <p class="footer-text">
            123 Culinary Street<br>
            Foodie City, FC 12345
          </p>
        </div>
        <div class="footer-column">
          <h3 class="footer-title">Hours</h3>
          <p class="footer-text">
            Monday - Friday: 11am - 10pm<br>
            Saturday - Sunday: 10am - 11pm
          </p>
        </div>
        <div class="footer-column">
          <h3 class="footer-title">Contact</h3>
          <p class="footer-text">
            Phone: (123) 456-7890<br>
            Email: info@bistromoderne.com
          </p>
        </div>
      </div>
      <div class="footer-bottom">
        <p>&copy; <span id="current-year"></span> Bistro Moderne. All rights reserved.</p>
      </div>
    </div>
  </footer>

  <!-- Reservation Modal -->
  <div class="modal" id="reservation-modal">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Reserve <span id="modal-table-name"></span></h3>
        <button class="modal-close">&times;</button>
      </div>
      <div class="modal-body">
        <div class="info-box">
          <p class="info-title">Table Details</p>
          <p class="info-text" id="modal-table-details"></p>
          <p class="info-text" id="modal-date"></p>
          <p class="info-text" id="modal-price"></p>
        </div>
        
        <div class="existing-reservations-box" id="existing-reservations-box">
          <div class="info-title">
            <i class="fas fa-info-circle"></i>
            Existing Reservations for This Table
          </div>
          <div id="existing-reservations-list"></div>
        </div>
        
        <form id="reservation-form" class="form">
          <div class="form-group">
            <label for="customer-name">Your Name</label>
            <input type="text" id="customer-name" placeholder="John Doe" required>
            <p class="error-text" id="name-error"></p>
          </div>
          
          <div class="form-row">
            <div class="form-group">
              <label for="start-time">Start Time</label>
              <select id="start-time" required>
                <!-- Time options will be dynamically inserted here -->
              </select>
              <p class="error-text" id="start-time-error"></p>
            </div>
            
            <div class="form-group">
              <label for="end-time">End Time</label>
              <select id="end-time" required>
                <!-- Time options will be dynamically inserted here -->
              </select>
              <p class="error-text" id="end-time-error"></p>
            </div>
          </div>
          
          <div class="form-group">
            <label for="note">Special Requests (Optional)</label>
            <textarea id="note" rows="3" placeholder="Any special requests or dietary requirements?"></textarea>
          </div>
          
          <div class="form-buttons">
            <button type="button" class="btn btn-outline" id="cancel-reservation-btn">Cancel</button>
            <button type="submit" class="btn btn-primary" id="confirm-reservation-btn">Confirm Reservation</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Cancel Reservation Modal -->
  <div class="modal" id="cancel-modal">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Cancel Reservation</h3>
        <button class="modal-close">&times;</button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to cancel this reservation? Cancellations within 24 hours of the reservation time
          may incur a fee or forfeit any deposit.</p>
        <div class="form-buttons">
          <button class="btn btn-outline" id="keep-reservation-btn">Keep Reservation</button>
          <button class="btn btn-danger" id="confirm-cancel-btn">Yes, Cancel Reservation</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
    // Set current year in footer
    document.getElementById('current-year').textContent = new Date().getFullYear();
    
    // Initialize the app
    initTabs();
    initMenuTabs();
    initCalendar();
    loadTables();
    loadReservations();
    loadMenu();
    initModalHandlers();
    
    // Set default selected date
    const today = new Date();
    document.getElementById('selected-date').textContent = formatDate(today);
  });
  
  // Tab Navigation
  function initTabs() {
    const tabButtons = document.querySelectorAll('[data-tab]');
    
    tabButtons.forEach(button => {
      button.addEventListener('click', () => {
        const tabName = button.dataset.tab;
        
        // Update tab buttons
        document.querySelectorAll('.tab-btn').forEach(btn => {
          btn.classList.remove('active');
        });
        document.querySelectorAll('.tab-btn[data-tab="' + tabName + '"]').forEach(btn => {
          btn.classList.add('active');
        });
        
        // Update nav links
        document.querySelectorAll('.nav-link').forEach(link => {
          link.classList.remove('active');
        });
        document.querySelectorAll('.nav-link[data-tab="' + tabName + '"]').forEach(link => {
          link.classList.add('active');
        });
        
        // Show active tab content
        document.querySelectorAll('.tab-content').forEach(content => {
          content.classList.remove('active');
        });
        document.getElementById(tabName + '-tab').classList.add('active');
      });
    });
  }
  
  // Menu Tabs
  function initMenuTabs() {
    const menuTabButtons = document.querySelectorAll('.menu-tab-btn');
    
    menuTabButtons.forEach(button => {
      button.addEventListener('click', () => {
        const menuName = button.dataset.menu;
        
        // Update menu tab buttons
        document.querySelectorAll('.menu-tab-btn').forEach(btn => {
          btn.classList.remove('active');
        });
        button.classList.add('active');
        
        // Show active menu content
        document.querySelectorAll('.menu-content').forEach(content => {
          content.classList.remove('active');
        });
        document.getElementById(menuName + '-menu').classList.add('active');
      });
    });
  }
  
  // Simple Calendar Implementation
  function initCalendar() {
    const calendar = document.getElementById('reservation-calendar');
    const today = new Date();
    const currentMonth = today.getMonth();
    const currentYear = today.getFullYear();
    
    renderCalendar(calendar, currentMonth, currentYear);
    
    // Store selected date
    window.selectedDate = today;
  }
  
  function renderCalendar(calendar, month, year) {
    const today = new Date();
    const firstDay = new Date(year, month, 1);
    const lastDay = new Date(year, month + 1, 0);
    const daysInMonth = lastDay.getDate();
    const startingDay = firstDay.getDay(); // 0 = Sunday
    
    // Clear calendar
    calendar.innerHTML = '';
    
    // Create header
    const header = document.createElement('div');
    header.className = 'calendar-header';
    
    const prevButton = document.createElement('button');
    prevButton.innerHTML = '&lt;';
    prevButton.className = 'calendar-nav';
    prevButton.addEventListener('click', () => {
      let newMonth = month - 1;
      let newYear = year;
      if (newMonth < 0) {
        newMonth = 11;
        newYear--;
      }
      renderCalendar(calendar, newMonth, newYear);
    });
    
    const monthYearText = document.createElement('div');
    monthYearText.className = 'calendar-title';
    monthYearText.textContent = new Date(year, month, 1).toLocaleDateString('en-US', { month: 'long', year: 'numeric' });
    
    const nextButton = document.createElement('button');
    nextButton.innerHTML = '&gt;';
    nextButton.className = 'calendar-nav';
    nextButton.addEventListener('click', () => {
      let newMonth = month + 1;
      let newYear = year;
      if (newMonth > 11) {
        newMonth = 0;
        newYear++;
      }
      renderCalendar(calendar, newMonth, newYear);
    });
    
    header.appendChild(prevButton);
    header.appendChild(monthYearText);
    header.appendChild(nextButton);
    calendar.appendChild(header);
    
    // Create weekday headers
    const weekdays = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    const weekdaysRow = document.createElement('div');
    weekdaysRow.className = 'calendar-weekdays';
    
    weekdays.forEach(day => {
      const dayElem = document.createElement('div');
      dayElem.className = 'calendar-weekday';
      dayElem.textContent = day;
      weekdaysRow.appendChild(dayElem);
    });
    
    calendar.appendChild(weekdaysRow);
    
    // Create days grid
    const daysGrid = document.createElement('div');
    daysGrid.className = 'calendar-days';
    
    // Add empty cells for days before the first day of the month
    for (let i = 0; i < startingDay; i++) {
      const emptyDay = document.createElement('div');
      emptyDay.className = 'calendar-day empty';
      daysGrid.appendChild(emptyDay);
    }
    
    // Add days of the month
    for (let i = 1; i <= daysInMonth; i++) {
      const dayElem = document.createElement('div');
      dayElem.className = 'calendar-day';
      dayElem.textContent = i;
      
      const currentDate = new Date(year, month, i);
      
      // Disable past dates
      if (currentDate < new Date(today.getFullYear(), today.getMonth(), today.getDate())) {
        dayElem.classList.add('disabled');
      } else {
        dayElem.addEventListener('click', () => {
          // Remove selected class from all days
          document.querySelectorAll('.calendar-day.selected').forEach(day => {
            day.classList.remove('selected');
          });
          
          // Add selected class to clicked day
          dayElem.classList.add('selected');
          
          // Update selected date
          window.selectedDate = new Date(year, month, i);
          document.getElementById('selected-date').textContent = formatDate(window.selectedDate);
          
          // Reload tables for the new date
          loadTables();
        });
      }
      
      // Mark today
      if (year === today.getFullYear() && month === today.getMonth() && i === today.getDate()) {
        dayElem.classList.add('today');
        // Select today by default
        dayElem.classList.add('selected');
      }
      
      daysGrid.appendChild(dayElem);
    }
    
    calendar.appendChild(daysGrid);
    
    // Add styles
    const style = document.createElement('style');
    style.textContent = `
      .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.5rem;
        background-color: var(--background);
        border-bottom: 1px solid var(--border);
      }
      
      .calendar-nav {
        background: none;
        border: none;
        cursor: pointer;
        font-size: 1rem;
        padding: 0.25rem 0.5rem;
        border-radius: var(--radius);
      }
      
      .calendar-nav:hover {
        background-color: var(--background-alt);
      }
      
      .calendar-title {
        font-weight: 500;
      }
      
      .calendar-weekdays {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        text-align: center;
        font-size: 0.75rem;
        font-weight: 500;
        padding: 0.5rem 0;
        background-color: var(--background-alt);
      }
      
      .calendar-days {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 1px;
        background-color: var(--border);
      }
      
      .calendar-day {
        height: 2.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: var(--background);
        cursor: pointer;
        font-size: 0.875rem;
      }
      
      .calendar-day:hover:not(.empty):not(.disabled) {
        background-color: var(--background-alt);
      }
      
      .calendar-day.empty {
        background-color: var(--background);
        cursor: default;
      }
      
      .calendar-day.today {
        font-weight: 700;
        color: var(--primary);
      }
      
      .calendar-day.selected {
        background-color: var(--primary);
        color: white;
      }
      
      .calendar-day.disabled {
        color: var(--text-light);
        cursor: not-allowed;
      }
    `;
    
    document.head.appendChild(style);
  }
  
  // Filter Handlers
  document.querySelectorAll('[data-filter]').forEach(badge => {
    badge.addEventListener('click', () => {
      const filterType = badge.dataset.filter;
      const filterValue = badge.dataset.value;
      
      // Update active state for this filter type
      document.querySelectorAll(`[data-filter="${filterType}"]`).forEach(b => {
        b.classList.remove('badge-active');
      });
      badge.classList.add('badge-active');
      
      // Store filter value
      window[filterType + 'Filter'] = filterValue;
      
      // Reload tables with filters
      loadTables();
    });
  });
  
  // Initialize filter values
  window.locationFilter = 'All';
  window.capacityFilter = 'All';
  
  // Tables Data
  const tables = [
    {
      id: 1,
      number: 'Table 1',
      capacity: 2,
      location: 'Indoor',
      price: 0,
      description: 'Cozy table for two near the window'
    },
    {
      id: 2,
      number: 'Table 2',
      capacity: 4,
      location: 'Indoor',
      price: 0,
      description: 'Family table in the main dining area'
    },
    {
      id: 3,
      number: 'Table 3',
      capacity: 6,
      location: 'Indoor',
      price: 10,
      description: 'Large table for groups, reservation deposit required'
    },
    {
      id: 4,
      number: 'Table 4',
      capacity: 2,
      location: 'Outdoor',
      price: 5,
      description: 'Romantic table on the terrace with city view'
    },
    {
      id: 5,
      number: 'Table 5',
      capacity: 4,
      location: 'Outdoor',
      price: 10,
      description: 'Garden table surrounded by plants and flowers'
    },
    {
      id: 6,
      number: 'Table 6',
      capacity: 8,
      location: 'VIP',
      price: 50,
      description: 'Private dining experience with dedicated service'
    }
  ];
  
  // Load Tables
  function loadTables() {
    const tablesGrid = document.getElementById('tables-grid');
    tablesGrid.innerHTML = '';
    
    // Apply filters
    const filteredTables = tables.filter(table => {
      const locationMatch = window.locationFilter === 'All' || table.location === window.locationFilter;
      const capacityMatch = window.capacityFilter === 'All' || table.capacity >= parseInt(window.capacityFilter);
      return locationMatch && capacityMatch;
    });
    
    // Get reservations for selected date
    const dateStr = formatDateForStorage(window.selectedDate);
    const reservationsForDate = getReservationsForDate(dateStr);
    
    filteredTables.forEach(table => {
      const tableReservations = reservationsForDate.filter(res => res.tableId === table.id);
      const hasReservations = tableReservations.length > 0;
      
      const tableCard = document.createElement('div');
      tableCard.className = 'table-card';
      
      tableCard.innerHTML = `
        <div class="table-header">
          <div>
            <h3 class="table-title">
              ${table.number}
              ${hasReservations ? '<span class="badge" style="margin-left: 0.5rem; font-size: 0.625rem;">Has Reservations</span>' : ''}
            </h3>
            <p class="table-description">${table.description}</p>
          </div>
        </div>
        <div class="table-content">
          <div class="table-details">
            <div class="table-detail">
              <i class="fas fa-users"></i>
              ${table.capacity} people
            </div>
            <div class="table-detail">
              <i class="fas fa-map-marker-alt"></i>
              <span class="badge ${getLocationClass(table.location)}">${table.location}</span>
            </div>
            ${table.price > 0 ? `
            <div class="table-detail">
              <i class="fas fa-dollar-sign"></i>
              $${table.price} deposit
            </div>
            ` : ''}
          </div>
          
          ${hasReservations ? `
          <div class="table-reservations">
            <div class="reservation-title">
              <i class="fas fa-clock"></i>
              Existing Reservations
            </div>
            <div class="reservation-list">
              ${tableReservations.map(res => `
                <span class="badge badge-outline">${res.startTime} - ${res.endTime}</span>
              `).join('')}
            </div>
          </div>
          ` : ''}
          
          <button class="btn btn-primary reserve-table-btn" data-table-id="${table.id}">
            Reserve This Table
          </button>
        </div>
      `;
      
      tablesGrid.appendChild(tableCard);
    });
    
    // Add event listeners to reserve buttons
    document.querySelectorAll('.reserve-table-btn').forEach(button => {
      button.addEventListener('click', () => {
        const tableId = parseInt(button.dataset.tableId);
        openReservationModal(tableId);
      });
    });
    
    // Add styles for badge outline
    const style = document.createElement('style');
    style.textContent = `
      .badge-outline {
        background-color: transparent;
        border: 1px solid var(--border);
      }
    `;
    document.head.appendChild(style);
  }
  
  // Get location class for badge
  function getLocationClass(location) {
    switch (location) {
      case 'Indoor':
        return 'badge-blue';
      case 'Outdoor':
        return 'badge-green';
      case 'VIP':
        return 'badge-purple';
      default:
        return '';
    }
  }
  
  // Menu Data
  const menuData = [
    {
      id: 'starters',
      name: 'Starters',
      items: [
        {
          id: 1,
          name: 'Bruschetta',
          description: 'Grilled bread rubbed with garlic and topped with olive oil, salt, tomato, and basil',
          price: 8.95,
          image: 'https://via.placeholder.com/120',
          tags: ['Vegetarian']
        },
        {
          id: 2,
          name: 'Calamari Fritti',
          description: 'Crispy fried calamari served with lemon aioli',
          price: 12.95,
          image: 'https://via.placeholder.com/120'
        },
        {
          id: 3,
          name: 'Caprese Salad',
          description: 'Fresh mozzarella, tomatoes, and basil drizzled with balsamic glaze',
          price: 10.95,
          image: 'https://via.placeholder.com/120',
          tags: ['Vegetarian', 'Gluten-Free']
        }
      ]
    },
    {
      id: 'mains',
      name: 'Mains',
      items: [
        {
          id: 4,
          name: 'Filet Mignon',
          description: '8oz center-cut filet with red wine reduction, served with roasted potatoes and seasonal vegetables',
          price: 34.95,
          image: 'https://via.placeholder.com/120',
          tags: ['Signature']
        },
        {
          id: 5,
          name: 'Grilled Salmon',
          description: 'Fresh Atlantic salmon with lemon butter sauce, asparagus, and wild rice pilaf',
          price: 26.95,
          image: 'https://via.placeholder.com/120',
          tags: ['Gluten-Free']
        },
        {
          id: 6,
          name: 'Mushroom Risotto',
          description: 'Creamy Arborio rice with wild mushrooms, truffle oil, and Parmesan',
          price: 22.95,
          image: 'https://via.placeholder.com/120',
          tags: ['Vegetarian']
        }
      ]
    },
    {
      id: 'desserts',
      name: 'Desserts',
      items: [
        {
          id: 7,
          name: 'Tiramisu',
          description: 'Classic Italian dessert with layers of coffee-soaked ladyfingers and mascarpone cream',
          price: 9.95,
          image: 'https://via.placeholder.com/120',
          tags: ["Chef's Choice"]
        },
        {
          id: 8,
          name: 'Crème Brûlée',
          description: 'Rich custard topped with a layer of caramelized sugar',
          price: 8.95,
          image: 'https://via.placeholder.com/120',
          tags: ['Gluten-Free']
        },
        {
          id: 9,
          name: 'Chocolate Lava Cake',
          description: 'Warm chocolate cake with a molten center, served with vanilla ice cream',
          price: 10.95,
          image: 'https://via.placeholder.com/120'
        }
      ]
    },
    {
      id: 'drinks',
      name: 'Drinks',
      items: [
        {
          id: 10,
          name: 'Signature Cocktail',
          description: 'House specialty with gin, elderflower liqueur, cucumber, and mint',
          price: 12.95,
          image: 'https://via.placeholder.com/120',
          tags: ['Signature']
        },
        {
          id: 11,
          name: 'Craft Beer Selection',
          description: 'Rotating selection of local craft beers',
          price: 7.95,
          image: 'https://via.placeholder.com/120'
        },
        {
          id: 12,
          name: 'Wine by the Glass',
          description: 'Selection of premium red, white, and sparkling wines',
          price: 9.95,
          image: 'https://via.placeholder.com/120'
        }
      ]
    }
  ];
  
  // Load Menu
  function loadMenu() {
    menuData.forEach(category => {
      const menuGrid = document.getElementById(`${category.id}-grid`);
      menuGrid.innerHTML = '';
      
      category.items.forEach(item => {
        const menuItem = document.createElement('div');
        menuItem.className = 'menu-item';
        
        menuItem.innerHTML = `
          <img src="${item.image}" alt="${item.name}" class="menu-image">
          <div class="menu-details">
            <div class="menu-header">
              <h3 class="menu-title">${item.name}</h3>
              <span class="menu-price">$${item.price.toFixed(2)}</span>
            </div>
            ${item.tags ? `
            <div class="menu-tags">
              ${item.tags.map(tag => `<span class="menu-tag">${tag}</span>`).join('')}
            </div>
            ` : ''}
            <p class="menu-description">${item.description}</p>
          </div>
        `;
        
        menuGrid.appendChild(menuItem);
      });
    });
  }
  
  // Reservation Modal Handlers
  function initModalHandlers() {
    // Close modal buttons
    document.querySelectorAll('.modal-close').forEach(button => {
      button.addEventListener('click', () => {
        closeAllModals();
      });
    });
    
    // Cancel reservation button in modal
    document.getElementById('cancel-reservation-btn').addEventListener('click', () => {
      closeAllModals();
    });
    
    // Reservation form submission
    document.getElementById('reservation-form').addEventListener('submit', function(e) {
      e.preventDefault();
      
      // Validate form
      const customerName = document.getElementById('customer-name').value.trim();
      const startTime = document.getElementById('start-time').value;
      const endTime = document.getElementById('end-time').value;
      const note = document.getElementById('note').value.trim();
      
      // Reset errors
      document.getElementById('name-error').textContent = '';
      document.getElementById('start-time-error').textContent = '';
      document.getElementById('end-time-error').textContent = '';
      
      let hasError = false;
      
      if (!customerName) {
        document.getElementById('name-error').textContent = 'Name is required';
        hasError = true;
      }
      
      if (timeToMinutes(endTime) <= timeToMinutes(startTime)) {
        document.getElementById('end-time-error').textContent = 'End time must be after start time';
        hasError = true;
      }
      
      // Check for time slot availability
      const tableId = parseInt(document.getElementById('reservation-form').dataset.tableId);
      const dateStr = formatDateForStorage(window.selectedDate);
      
      if (!isTimeSlotAvailable(tableId, dateStr, startTime, endTime)) {
        document.getElementById('start-time-error').textContent = 'This time slot overlaps with an existing reservation';
        hasError = true;
      }
      
      if (hasError) return;
      
      // Create reservation
      const reservation = {
        id: Date.now(),
        tableId: tableId,
        customerName: customerName,
        startTime: startTime,
        endTime: endTime,
        date: dateStr,
        note: note || undefined
      };
      
      // Save reservation
      saveReservation(reservation);
      
      // Close modal
      closeAllModals();
      
      // Reload tables and reservations
      loadTables();
      loadReservations();
    });
    
    // Cancel reservation confirmation
    document.getElementById('keep-reservation-btn').addEventListener('click', () => {
      closeAllModals();
    });
    
    document.getElementById('confirm-cancel-btn').addEventListener('click', () => {
      const reservationId = parseInt(document.getElementById('cancel-modal').dataset.reservationId);
      cancelReservation(reservationId);
      closeAllModals();
      loadReservations();
    });
  }
  
  // Open reservation modal
  function openReservationModal(tableId) {
    const table = tables.find(t => t.id === tableId);
    const modal = document.getElementById('reservation-modal');
    const form = document.getElementById('reservation-form');
    
    // Set table details
    document.getElementById('modal-table-name').textContent = table.number;
    document.getElementById('modal-table-details').textContent = `${table.number} (${table.capacity} people) - ${table.location}`;
    document.getElementById('modal-date').textContent = `Date: ${formatDate(window.selectedDate)}`;
    
    if (table.price > 0) {
      document.getElementById('modal-price').textContent = `Reservation Deposit: $${table.price.toFixed(2)}`;
      document.getElementById('modal-price').style.display = 'block';
    } else {
      document.getElementById('modal-price').style.display = 'none';
    }
    
    // Set form table ID
    form.dataset.tableId = tableId;
    
    // Reset form
    form.reset();
    document.getElementById('name-error').textContent = '';
    document.getElementById('start-time-error').textContent = '';
    document.getElementById('end-time-error').textContent = '';
    
    // Populate time options
    populateTimeOptions();
    
    // Show existing reservations
    const dateStr = formatDateForStorage(window.selectedDate);
    const tableReservations = getReservationsForDate(dateStr).filter(res => res.tableId === tableId);
    
    const existingReservationsBox = document.getElementById('existing-reservations-box');
    const existingReservationsList = document.getElementById('existing-reservations-list');
    
    if (tableReservations.length > 0) {
      existingReservationsBox.style.display = 'block';
      existingReservationsList.innerHTML = tableReservations.map(res => `
        <div class="reservation-item">
          <span class="badge badge-outline">${res.startTime} - ${res.endTime}</span>
        </div>
      `).join('');
    } else {
      existingReservationsBox.style.display = 'none';
    }
    
    // Show modal
    modal.classList.add('active');
  }
  
  // Populate time options
  function populateTimeOptions() {
    const startTimeSelect = document.getElementById('start-time');
    const endTimeSelect = document.getElementById('end-time');
    
    startTimeSelect.innerHTML = '';
    endTimeSelect.innerHTML = '';
    
    const timeOptions = generateTimeOptions();
    
    // Populate start time options (all except last)
    timeOptions.slice(0, -1).forEach(time => {
      const option = document.createElement('option');
      option.value = time;
      option.textContent = time;
      startTimeSelect.appendChild(option);
    });
    
    // Set default start time to 18:00
    startTimeSelect.value = '18:00';
    
    // Populate end time options (all except first)
    timeOptions.slice(1).forEach(time => {
      const option = document.createElement('option');
      option.value = time;
      option.textContent = time;
      endTimeSelect.appendChild(option);
    });
    
    // Set default end time to 20:00
    endTimeSelect.value = '20:00';
  }
  
  // Generate time options from 11:00 to 22:00 in 30-minute intervals
  function generateTimeOptions() {
    const options = [];
    for (let hour = 11; hour <= 22; hour++) {
      for (const minute of [0, 30]) {
        const hourStr = hour.toString().padStart(2, '0');
        const minuteStr = minute.toString().padStart(2, '0');
        options.push(`${hourStr}:${minuteStr}`);
      }
    }
    return options;
  }
  
  // Open cancel reservation modal
  function openCancelModal(reservationId) {
    const modal = document.getElementById('cancel-modal');
    modal.dataset.reservationId = reservationId;
    modal.classList.add('active');
  }
  
  // Close all modals
  function closeAllModals() {
    document.querySelectorAll('.modal').forEach(modal => {
      modal.classList.remove('active');
    });
  }
  
  // Reservation Storage Functions
  function getReservations() {
    const reservations = localStorage.getItem('reservations');
    return reservations ? JSON.parse(reservations) : [];
  }
  
  function saveReservation(reservation) {
    const reservations = getReservations();
    reservations.push(reservation);
    localStorage.setItem('reservations', JSON.stringify(reservations));
  }
  
  function cancelReservation(reservationId) {
    const reservations = getReservations().filter(res => res.id !== reservationId);
    localStorage.setItem('reservations', JSON.stringify(reservations));
  }
  
  function getReservationsForDate(dateStr) {
    return getReservations().filter(res => res.date === dateStr);
  }
  
  function isTimeSlotAvailable(tableId, dateStr, startTime, endTime) {
    const reservations = getReservations().filter(res => res.tableId === tableId && res.date === dateStr);
    
    // Convert times to minutes for easier comparison
    const startMinutes = timeToMinutes(startTime);
    const endMinutes = timeToMinutes(endTime);
    
    // Check against existing reservations
    for (const reservation of reservations) {
      const resStartMinutes = timeToMinutes(reservation.startTime);
      const resEndMinutes = timeToMinutes(reservation.endTime);
      
      // Check for overlap
      if (
        (startMinutes >= resStartMinutes && startMinutes < resEndMinutes) ||
        (endMinutes > resStartMinutes && endMinutes <= resEndMinutes) ||
        (startMinutes <= resStartMinutes && endMinutes >= resEndMinutes)
      ) {
        return false;
      }
    }
    
    return true;
  }
  
  // Convert time string to minutes
  function timeToMinutes(time) {
    const [hours, minutes] = time.split(':').map(Number);
    return hours * 60 + minutes;
  }
  
  // Load Reservations
  function loadReservations() {
    const reservationsGrid = document.getElementById('my-reservations-grid');
    const reservations = getReservations();
    
    if (reservations.length === 0) {
      reservationsGrid.innerHTML = `
        <div class="empty-state">
          <div class="empty-icon">
            <i class="fas fa-calendar"></i>
          </div>
          <h3 class="empty-title">No Reservations Found</h3>
          <p class="empty-description">
            You don't have any reservations yet. Browse our available tables and make your first reservation.
          </p>
          <button class="btn btn-primary" data-tab="tables">Make a Reservation</button>
        </div>
      `;
      
      // Add event listener to the button
      reservationsGrid.querySelector('button[data-tab="tables"]').addEventListener('click', () => {
        document.querySelector('.tab-btn[data-tab="tables"]').click();
      });
      
      return;
    }
    
    // Sort reservations by date and time
    const sortedReservations = [...reservations].sort((a, b) => {
      const dateCompare = a.date.localeCompare(b.date);
      if (dateCompare !== 0) return dateCompare;
      return a.startTime.localeCompare(b.startTime);
    });
    
    reservationsGrid.innerHTML = '';
    
    sortedReservations.forEach(reservation => {
      const table = tables.find(t => t.id === reservation.tableId);
      const upcoming = isUpcoming(reservation.date, reservation.startTime);
      
      const reservationCard = document.createElement('div');
      reservationCard.className = 'reservation-card';
      
      reservationCard.innerHTML = `
        <div class="reservation-header">
          <div class="reservation-info">
            <h3 class="reservation-name">${table ? table.number : `Table ${reservation.tableId}`}</h3>
            <p class="reservation-date">${formatDate(new Date(reservation.date))} • ${reservation.startTime} - ${reservation.endTime}</p>
          </div>
          <div class="reservation-status ${upcoming ? 'status-upcoming' : 'status-past'}">
            ${upcoming ? 'Upcoming' : 'Past'}
          </div>
        </div>
        <div class="reservation-content">
          <div class="reservation-details">
            <div class="reservation-detail">
              <i class="fas fa-users"></i>
              ${table ? table.capacity : 'Unknown'} people
            </div>
            <div class="reservation-detail">
              <i class="fas fa-map-marker-alt"></i>
              <span class="badge ${getLocationClass(table ? table.location : '')}">
                ${table ? table.location : 'Unknown'}
              </span>
            </div>
            <div class="reservation-detail">
              <i class="fas fa-clock"></i>
              Duration: ${calculateDuration(reservation.startTime, reservation.endTime)}
            </div>
            ${reservation.note ? `
            <div class="reservation-detail">
              <i class="fas fa-sticky-note"></i>
              Has Notes
            </div>
            ` : ''}
          </div>
          
          ${reservation.note ? `
          <div class="reservation-notes">
            <p class="reservation-notes-title">Special Requests:</p>
            <p class="reservation-notes-text">${reservation.note}</p>
          </div>
          ` : ''}
        </div>
        ${upcoming ? `
        <div class="reservation-footer">
          <button class="btn btn-outline cancel-reservation-btn" data-reservation-id="${reservation.id}">
            Cancel Reservation
          </button>
        </div>
        ` : ''}
      `;
      
      reservationsGrid.appendChild(reservationCard);
    });
    
    // Add event listeners to cancel buttons
    document.querySelectorAll('.cancel-reservation-btn').forEach(button => {
      button.addEventListener('click', () => {
        const reservationId = parseInt(button.dataset.reservationId);
        openCancelModal(reservationId);
      });
    });
  }
  
  // Check if a reservation is upcoming
  function isUpcoming(dateStr, timeStr) {
    const [year, month, day] = dateStr.split('-').map(Number);
    const [hours, minutes] = timeStr.split(':').map(Number);
    
    const reservationDate = new Date(year, month - 1, day, hours, minutes);
    const now = new Date();
    
    return reservationDate > now;
  }
  
  // Calculate duration between two time strings
  function calculateDuration(startTime, endTime) {
    const [startHours, startMinutes] = startTime.split(':').map(Number);
    const [endHours, endMinutes] = endTime.split(':').map(Number);
    
    const durationMinutes = endHours * 60 + endMinutes - (startHours * 60 + startMinutes);
    
    // Handle negative duration (should not happen with validation)
    if (durationMinutes <= 0) return 'Invalid';
    
    const hours = Math.floor(durationMinutes / 60);
    const minutes = durationMinutes % 60;
    
    if (hours === 0) return `${minutes} min`;
    if (minutes === 0) return `${hours} hr`;
    return `${hours} hr ${minutes} min`;
  }
  
  // Format date for display
  function formatDate(date) {
    return date.toLocaleDateString('en-US', {
      year: 'numeric',
      month: 'long',
      day: 'numeric'
    });
  }
  
  // Format date for storage
  function formatDateForStorage(date) {
    const year = date.getFullYear();
    const month = (date.getMonth() + 1).toString().padStart(2, '0');
    const day = date.getDate().toString().padStart(2, '0');
    return `${year}-${month}-${day}`;
  }
  </script>
</body>

<style>
    /* Base Styles */
:root {
    --primary: #e11d48;
    --primary-hover: #be123c;
    --secondary: #f8f5f2;
    --text-primary: #1f2937;
    --text-secondary: #4b5563;
    --text-light: #9ca3af;
    --border: #e5e7eb;
    --background: #ffffff;
    --background-alt: #f9fafb;
    --shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    --indoor: #dbeafe;
    --indoor-text: #1e40af;
    --outdoor: #dcfce7;
    --outdoor-text: #166534;
    --vip: #f3e8ff;
    --vip-text: #7e22ce;
    --radius: 0.375rem;
  }
  
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }
  
  body {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    color: var(--text-primary);
    line-height: 1.5;
    background-color: var(--background-alt);
  }
  
  .container {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1rem;
  }
  
  /* Typography */
  h1, h2, h3, h4, h5, h6 {
    font-weight: 600;
    line-height: 1.2;
  }
  
  /* Buttons */
  .btn {
    display: inline-block;
    padding: 0.75rem 1.5rem;
    border-radius: var(--radius);
    font-weight: 500;
    text-align: center;
    cursor: pointer;
    transition: all 0.2s ease;
    border: none;
    font-size: 1rem;
  }
  
  .btn-primary {
    background-color: var(--primary);
    color: white;
  }
  
  .btn-primary:hover {
    background-color: var(--primary-hover);
  }
  
  .btn-secondary {
    background-color: transparent;
    color: var(--text-primary);
    border: 1px solid var(--border);
  }
  
  .btn-secondary:hover {
    background-color: var(--background-alt);
  }
  
  .btn-outline {
    background-color: transparent;
    color: var(--text-primary);
    border: 1px solid var(--border);
  }
  
  .btn-outline:hover {
    background-color: var(--background-alt);
  }
  
  .btn-danger {
    background-color: var(--primary);
    color: white;
  }
  
  .btn-danger:hover {
    background-color: var(--primary-hover);
  }
  
  /* Header */
  .header {
    background-color: var(--background);
    box-shadow: var(--shadow);
    position: sticky;
    top: 0;
    z-index: 10;
  }
  
  .header .container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem 1rem;
  }
  
  .logo {
    font-size: 1.5rem;
    color: var(--text-primary);
  }
  
  .nav {
    display: none;
  }
  
  @media (min-width: 768px) {
    .nav {
      display: flex;
      gap: 1.5rem;
    }
  }
  
  .nav-link {
    color: var(--text-secondary);
    background: none;
    border: none;
    cursor: pointer;
    font-size: 1rem;
    transition: color 0.2s ease;
  }
  
  .nav-link:hover, .nav-link.active {
    color: var(--primary);
  }
  
  /* Hero Section */
  .hero {
    background-color: var(--secondary);
    padding: 4rem 0;
    text-align: center;
  }
  
  .hero-title {
    font-size: 2.5rem;
    margin-bottom: 1rem;
    color: var(--text-primary);
  }
  
  @media (min-width: 768px) {
    .hero-title {
      font-size: 3rem;
    }
  }
  
  .hero-description {
    font-size: 1.25rem;
    max-width: 36rem;
    margin: 0 auto 2rem;
    color: var(--text-secondary);
  }
  
  .hero-buttons {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 1rem;
  }
  
  /* Main Content */
  .main-content {
    padding: 4rem 0;
    background-color: var(--background);
  }
  
  .section-title {
    font-size: 1.875rem;
    text-align: center;
    margin-bottom: 3rem;
    color: var(--text-primary);
  }
  
  /* Tabs */
  .tabs {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 0.5rem;
    margin-bottom: 2rem;
  }
  
  .tab-btn {
    padding: 0.75rem;
    background-color: var(--background-alt);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    cursor: pointer;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.2s ease;
  }
  
  @media (min-width: 768px) {
    .tab-btn {
      font-size: 1rem;
    }
  }
  
  .tab-btn.active {
    background-color: var(--background);
    border-color: var(--primary);
    color: var(--primary);
  }
  
  .tab-content {
    display: none;
  }
  
  .tab-content.active {
    display: block;
  }
  
  /* Cards */
  .card {
    background-color: var(--background);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    overflow: hidden;
  }
  
  .card-header {
    padding: 1rem;
    border-bottom: 1px solid var(--border);
  }
  
  .card-title {
    font-size: 1.25rem;
    color: var(--text-primary);
  }
  
  .card-content {
    padding: 1rem;
  }
  
  /* Table Reservation */
  .table-reservation {
    display: grid;
    grid-template-columns: 1fr;
    gap: 2rem;
  }
  
  @media (min-width: 1024px) {
    .table-reservation {
      grid-template-columns: 1fr 3fr;
    }
  }
  
  /* Calendar */
  .calendar {
    margin-bottom: 1.5rem;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    overflow: hidden;
  }
  
  /* Filter Section */
  .filter-section {
    margin-bottom: 1.5rem;
  }
  
  .filter-title {
    font-size: 0.875rem;
    font-weight: 500;
    margin-bottom: 0.5rem;
  }
  
  .filter-badges {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
  }
  
  .badge {
    display: inline-block;
    padding: 0.25rem 0.5rem;
    border-radius: 9999px;
    font-size: 0.75rem;
    font-weight: 500;
    background-color: #e5e7eb;
    color: var(--text-secondary);
    cursor: pointer;
    transition: all 0.2s ease;
  }
  
  .badge:hover {
    background-color: #d1d5db;
  }
  
  .badge-active {
    background-color: var(--primary);
    color: white;
  }
  
  .badge-blue {
    background-color: var(--indoor);
    color: var(--indoor-text);
  }
  
  .badge-blue:hover {
    background-color: #bfdbfe;
  }
  
  .badge-green {
    background-color: var(--outdoor);
    color: var(--outdoor-text);
  }
  
  .badge-green:hover {
    background-color: #bbf7d0;
  }
  
  .badge-purple {
    background-color: var(--vip);
    color: var(--vip-text);
  }
  
  .badge-purple:hover {
    background-color: #e9d5ff;
  }
  
  /* Tables Grid */
  .tables-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.5rem;
  }
  
  @media (min-width: 768px) {
    .tables-grid {
      grid-template-columns: repeat(2, 1fr);
    }
  }
  
  .table-card {
    border: 1px solid var(--border);
    border-radius: var(--radius);
    overflow: hidden;
  }
  
  .table-header {
    padding: 1rem;
    border-bottom: 1px solid var(--border);
  }
  
  .table-title {
    font-size: 1.125rem;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 0.5rem;
  }
  
  .table-description {
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin-top: 0.25rem;
  }
  
  .table-content {
    padding: 1rem;
  }
  
  .table-details {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-bottom: 1rem;
  }
  
  .table-detail {
    display: flex;
    align-items: center;
    font-size: 0.875rem;
    color: var(--text-secondary);
  }
  
  .table-detail i {
    margin-right: 0.25rem;
    font-size: 1rem;
  }
  
  .table-reservations {
    margin-bottom: 1rem;
  }
  
  .reservation-title {
    font-size: 0.875rem;
    font-weight: 500;
    display: flex;
    align-items: center;
    margin-bottom: 0.5rem;
  }
  
  .reservation-title i {
    margin-right: 0.25rem;
  }
  
  .reservation-list {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
  }
  
  /* Reservations Grid */
  .reservations-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.5rem;
  }
  
  @media (min-width: 768px) {
    .reservations-grid {
      grid-template-columns: repeat(2, 1fr);
    }
  }
  
  .reservation-card {
    border: 1px solid var(--border);
    border-radius: var(--radius);
    overflow: hidden;
  }
  
  .reservation-header {
    padding: 1rem;
    border-bottom: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
  }
  
  .reservation-info {
    flex: 1;
  }
  
  .reservation-name {
    font-size: 1.125rem;
    font-weight: 500;
  }
  
  .reservation-date {
    font-size: 0.875rem;
    color: var(--text-secondary);
  }
  
  .reservation-status {
    padding: 0.25rem 0.5rem;
    border-radius: 9999px;
    font-size: 0.75rem;
  }
  
  .status-upcoming {
    background-color: var(--outdoor);
    color: var(--outdoor-text);
  }
  
  .status-past {
    background-color: #e5e7eb;
    color: var(--text-secondary);
  }
  
  .reservation-content {
    padding: 1rem;
  }
  
  .reservation-details {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 0.5rem;
    margin-bottom: 0.75rem;
  }
  
  .reservation-detail {
    display: flex;
    align-items: center;
    font-size: 0.875rem;
    color: var(--text-secondary);
  }
  
  .reservation-detail i {
    margin-right: 0.25rem;
    width: 1rem;
    text-align: center;
  }
  
  .reservation-notes {
    padding-top: 0.5rem;
    border-top: 1px solid var(--border);
    margin-top: 0.5rem;
  }
  
  .reservation-notes-title {
    font-size: 0.875rem;
    font-weight: 500;
  }
  
  .reservation-notes-text {
    font-size: 0.875rem;
    color: var(--text-secondary);
  }
  
  .reservation-footer {
    padding: 1rem;
    border-top: 1px solid var(--border);
  }
  
  /* Menu Tabs */
  .menu-tabs {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 0.5rem;
    max-width: 36rem;
    margin: 0 auto 2rem;
  }
  
  @media (min-width: 768px) {
    .menu-tabs {
      grid-template-columns: repeat(4, 1fr);
    }
  }
  
  .menu-tab-btn {
    padding: 0.75rem;
    background-color: var(--background-alt);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    cursor: pointer;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.2s ease;
  }
  
  .menu-tab-btn.active {
    background-color: var(--background);
    border-color: var(--primary);
    color: var(--primary);
  }
  
  .menu-content {
    display: none;
  }
  
  .menu-content.active {
    display: block;
  }
  
  /* Menu Grid */
  .menu-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.5rem;
  }
  
  @media (min-width: 768px) {
    .menu-grid {
      grid-template-columns: repeat(2, 1fr);
    }
  }
  
  .menu-item {
    border: 1px solid var(--border);
    border-radius: var(--radius);
    overflow: hidden;
    display: flex;
    flex-direction: column;
  }
  
  @media (min-width: 640px) {
    .menu-item {
      flex-direction: row;
    }
  }
  
  .menu-image {
    width: 100%;
    height: 120px;
    object-fit: cover;
  }
  
  @media (min-width: 640px) {
    .menu-image {
      width: 33.333%;
      height: auto;
    }
  }
  
  .menu-details {
    padding: 1rem;
    flex: 1;
  }
  
  .menu-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 0.25rem;
  }
  
  .menu-title {
    font-size: 1.125rem;
    font-weight: 500;
  }
  
  .menu-price {
    color: var(--primary);
    font-weight: 500;
  }
  
  .menu-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.25rem;
    margin: 0.25rem 0 0.5rem;
  }
  
  .menu-tag {
    padding: 0.125rem 0.375rem;
    border-radius: var(--radius);
    font-size: 0.75rem;
    border: 1px solid var(--border);
  }
  
  .menu-description {
    font-size: 0.875rem;
    color: var(--text-secondary);
  }
  
  /* Policy Alert */
  .policy-alert {
    background-color: #fff1f2;
    border: 1px solid #fecdd3;
    border-radius: var(--radius);
    padding: 1rem;
    margin-bottom: 1.5rem;
  }
  
  .alert-title {
    color: #be123c;
    font-size: 1rem;
    font-weight: 500;
    margin-bottom: 0.5rem;
  }
  
  .alert-text {
    color: #e11d48;
    font-size: 0.875rem;
  }
  
  /* Empty State */
  .empty-state {
    text-align: center;
    padding: 3rem 0;
  }
  
  .empty-icon {
    width: 6rem;
    height: 6rem;
    background-color: var(--background-alt);
    border-radius: 9999px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
  }
  
  .empty-icon i {
    font-size: 3rem;
    color: var(--text-light);
  }
  
  .empty-title {
    font-size: 1.25rem;
    font-weight: 500;
    margin-bottom: 0.5rem;
  }
  
  .empty-description {
    color: var(--text-secondary);
    max-width: 24rem;
    margin: 0 auto 1.5rem;
  }
  
  /* Modal */
  .modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 100;
    align-items: center;
    justify-content: center;
    padding: 1rem;
  }
  
  .modal.active {
    display: flex;
  }
  
  .modal-content {
    background-color: var(--background);
    border-radius: var(--radius);
    box-shadow: var(--shadow-lg);
    width: 100%;
    max-width: 28rem;
    max-height: 90vh;
    overflow-y: auto;
  }
  
  .modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    border-bottom: 1px solid var(--border);
  }
  
  .modal-title {
    font-size: 1.25rem;
    font-weight: 500;
  }
  
  .modal-close {
    background: none;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
    color: var(--text-secondary);
  }
  
  .modal-body {
    padding: 1rem;
  }
  
  /* Info Box */
  .info-box {
    background-color: #fff1f2;
    border-radius: var(--radius);
    padding: 0.75rem;
    margin-bottom: 1rem;
  }
  
  .info-title {
    color: #be123c;
    font-weight: 500;
    margin-bottom: 0.5rem;
  }
  
  .info-text {
    color: #e11d48;
    font-size: 0.875rem;
  }
  
  .existing-reservations-box {
    background-color: #dbeafe;
    border-radius: var(--radius);
    padding: 0.75rem;
    margin-bottom: 1rem;
  }
  
  /* Form */
  .form {
    display: flex;
    flex-direction: column;
    gap: 1rem;
  }
  
  .form-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
  }
  
  .form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
  }
  
  label {
    font-size: 0.875rem;
    font-weight: 500;
  }
  
  input, select, textarea {
    padding: 0.5rem;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    font-size: 0.875rem;
    width: 100%;
  }
  
  input:focus, select:focus, textarea:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 1px var(--primary);
  }
  
  .error-text {
    color: var(--primary);
    font-size: 0.75rem;
  }
  
  .form-buttons {
    display: flex;
    gap: 0.75rem;
    margin-top: 0.5rem;
  }
  
  .form-buttons .btn {
    flex: 1;
  }
  
  /* Footer */
  .footer {
    background-color: #1f2937;
    color: white;
    padding: 3rem 0;
  }
  
  .footer-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 2rem;
  }
  
  @media (min-width: 768px) {
    .footer-grid {
      grid-template-columns: repeat(3, 1fr);
    }
  }
  
  .footer-title {
    font-size: 1.25rem;
    margin-bottom: 1rem;
  }
  
  .footer-text {
    color: #d1d5db;
    line-height: 1.6;
  }
  
  .footer-bottom {
    text-align: center;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid #374151;
    color: #9ca3af;
  }
</style>
</html>