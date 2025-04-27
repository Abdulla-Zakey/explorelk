<?php
// Extract data passed from controller
$tables = $data['tables'] ?? [];
$reservations = $data['reservations'] ?? [];
$menuData = $data['menuData'] ?? [];
$selected_date = $data['selected_date'] ?? date('Y-m-d');
$success = $data['success'] ?? null;
$error = $data['error'] ?? null;

// Set timezone to match Sri Lanka (Asia/Colombo)
date_default_timezone_set('Asia/Colombo');
error_log("Server timezone set to: " . date_default_timezone_get());
$serverTime = new DateTime('now', new DateTimeZone('Asia/Colombo'));
error_log("Server current time: " . $serverTime->format('Y-m-d H:i:s P'));

// Attempt to get database time
try {
    $db = new PDO("mysql:host=localhost;dbname=explorelk", 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $db->query("SELECT NOW() as db_time");
    $dbTime = $stmt->fetch(PDO::FETCH_ASSOC)['db_time'];
    error_log("Database current time: " . $dbTime);
} catch (Exception $e) {
    error_log("Failed to fetch database time: " . $e->getMessage());
    $dbTime = "Unknown";
}

// PHP functions for server-side rendering
function getLocationClass($location) {
    switch ($location) {
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

function calculateDuration($startTime, $endTime) {
    error_log("Calculating duration: StartTime=$startTime, EndTime=$endTime");
    $start = DateTime::createFromFormat('H:i', $startTime);
    $end = DateTime::createFromFormat('H:i', $endTime);
    if (!$start || !$end) {
        error_log("Failed to parse times: Start=$startTime, End=$endTime");
        return 'Invalid';
    }
    $interval = $start->diff($end);
    $hours = $interval->h;
    $minutes = $interval->i;
    // Check if end time is before start time (invalid duration)
    if ($interval->invert || ($hours == 0 && $minutes == 0)) {
        error_log("Invalid duration: End time is not after start time or zero duration");
        return 'Invalid';
    }
    if ($hours == 0) {
        return "{$minutes} min";
    }
    if ($minutes == 0) {
        return "{$hours} hr";
    }
    return "{$hours} hr {$minutes} min";
}

function isUpcoming($dateStr, $timeStr) {
    // Create DateTime objects with explicit timezone
    $timezone = new DateTimeZone('Asia/Colombo');
    $reservationDate = DateTime::createFromFormat('Y-m-d H:i', "$dateStr $timeStr", $timezone);
    if (!$reservationDate) {
        error_log("Failed to parse reservation date/time: $dateStr $timeStr");
        // Fallback: Manual comparison
        $resTimestamp = strtotime("$dateStr $timeStr");
        $nowTimestamp = time();
        $isUpcomingFallback = $resTimestamp > $nowTimestamp;
        error_log("Fallback comparison: ReservationTimestamp=$resTimestamp, NowTimestamp=$nowTimestamp, IsUpcomingFallback=" . ($isUpcomingFallback ? 'Yes' : 'No'));
        return $isUpcomingFallback;
    }
    $now = new DateTime('now', $timezone);
    $isUpcoming = $reservationDate > $now;
    error_log("Checking reservation: Date=$dateStr, Time=$timeStr, ReservationDate=" . $reservationDate->format('Y-m-d H:i:s P') . ", Now=" . $now->format('Y-m-d H:i:s P') . ", IsUpcoming=" . ($isUpcoming ? 'Yes' : 'No'));
    return $isUpcoming;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?= CSS ?>/Traveler/navbar.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Traveler/restaurant.css">
  <title>Restaurant Reservation</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --primary: #002D40;
      --primary-hover: #1A4555;
      --text-primary: #1f2937;
      --text-secondary: #4b5563;
      --text-light: #9ca3af;
      --border: #e5e7eb;
      --background: #ffffff;
      --background-alt: #f9fafb;
      --shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
      --indoor: #dbeafe;
      --indoor-text: #1e40af;
      --outdoor: #dcfce7;
      --outdoor-text: #166534;
      --vip: #f3e8ff;
      --vip-text: #7e22ce;
      --radius: 0.375rem;
    }

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
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
      color: var(--text-primary);
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
      background-color: var(--indoor);
      border-radius: var(--radius);
      padding: 0.75rem;
      margin-bottom: 1rem;
    }

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
      color: var(--text-primary);
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
      color: #e11d48;
      font-size: 0.75rem;
      margin-top: 0.25rem;
    }

    .form-buttons {
      display: flex;
      gap: 0.75rem;
      margin-top: 0.5rem;
    }

    .form-buttons .btn {
      flex: 1;
    }

    .btn {
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

    .btn-outline {
      background-color: transparent;
      color: var(--text-primary);
      border: 1px solid var(--border);
    }

    .btn-outline:hover {
      background-color: var(--background-alt);
    }

    .btn-danger {
      background-color: #dc2626;
      color: white;
    }

    .btn-danger:hover {
      background-color: #b91c1c;
    }

    .reservation-item {
      margin: 0.25rem 0;
    }

    .badge-outline {
      background-color: transparent;
      border: 1px solid var(--border);
      color: var(--text-secondary);
    }

    .alert {
      padding: 1rem;
      margin-bottom: 1rem;
      border-radius: var(--radius);
    }

    .alert.success {
      background-color: #dcfce7;
      color: #166534;
    }

    .alert.error {
      background-color: #fee2e2;
      color: #991b1b;
    }

    .debug-message {
      color: #991b1b;
      font-size: 0.875rem;
      margin-top: 0.5rem;
    }

    .calendar {
      width: 100%;
      max-width: 300px;
      margin: 0 auto;
    }

    .calendar-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0.5rem;
      background-color: var(--background-alt);
      border-radius: var(--radius);
    }

    .calendar-nav {
      background: none;
      border: none;
      font-size: 1.25rem;
      cursor: pointer;
      color: var(--text-primary);
    }

    .calendar-title {
      font-weight: 500;
      color: var(--text-primary);
    }

    .calendar-weekdays {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      gap: 0.25rem;
      margin-top: 0.5rem;
    }

    .calendar-weekday {
      text-align: center;
      font-size: 0.875rem;
      color: var(--text-secondary);
      padding: 0.25rem;
    }

    .calendar-days {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      gap: 0.25rem;
      margin-top: 0.5rem;
    }

    .calendar-day {
      text-align: center;
      padding: 0.5rem;
      border: 1px solid var(--border);
      border-radius: var(--radius);
      cursor: pointer;
      color: var(--text-primary);
      transition: background-color 0.2s ease;
    }

    .calendar-day.empty {
      border: none;
      cursor: default;
    }

    .calendar-day.disabled {
      color: var(--text-light);
      cursor: not-allowed;
    }

    .calendar-day.today {
      background-color: var(--primary);
      color: white;
      border-color: var(--primary);
    }

    .calendar-day.selected {
      background-color: var(--primary);
      color: white;
      border-color: var(--primary);
    }

    .calendar-day:hover:not(.empty):not(.disabled) {
      background-color: var(--primary-hover);
      color: white;
      border-color: var(--primary-hover);
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
  <section class="main-content">
    <div class="container">
      <?php if ($success): ?>
        <div class="alert success"><?= htmlspecialchars($success) ?></div>
      <?php endif; ?>
      <?php if ($error): ?>
        <div class="alert error"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>
      <?php if (empty($tables) && empty($reservations) && empty($menuData['starters']) && empty($menuData['mains']) && empty($menuData['desserts']) && empty($menuData['drinks'])): ?>
        <div class="alert error">No data fetched for restaurant_id 6. Please check database and error logs.</div>
      <?php endif; ?>

      <div class="tabs">
        <button class="tab-btn active" data-tab="tables">Tables</button>
        <button class="tab-btn" data-tab="reservations">My Reservations</button>
        <button class="tab-btn" data-tab="menu">Menu</button>
      </div>

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
                  <!-- <h4 class="filter-title">Filter by Capacity</h4>
                  <div class="filter-badges">
                    <span class="badge badge-active" data-filter="capacity" data-value="All">All</span>
                    <span class="badge" data-filter="capacity" data-value="2">2+ People</span>
                    <span class="badge" data-filter="capacity" data-value="4">4+ People</span>
                    <span class="badge" data-filter="capacity" data-value="6">6+ People</span>
                  </div> -->
                </div>
              </div>
            </div>
          </div>
          <div class="main-area">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Available Tables for <span id="selected-date"><?= date('F j, Y', strtotime($selected_date)) ?></span></h3>
              </div>
              <div class="card-content">
                <div class="tables-grid" id="tables-grid">
                  <?php if (empty($tables)): ?>
                    <div class="empty-state">
                      <div class="empty-icon">
                        <i class="fas fa-table"></i>
                      </div>
                      <h3 class="empty-title">No Tables Found</h3>
                      <p class="empty-description">No tables are available for this restaurant. Please contact support or try another date.</p>
                    </div>
                  <?php else: ?>
                    <?php foreach ($tables as $table): ?>
                      <?php
                      $tableReservations = array_filter($reservations, function($res) use ($table) {
                          return $res->table_id == $table->id;
                      });
                      $hasReservations = !empty($tableReservations);
                      ?>
                      <div class="table-card">
                        <div class="table-header">
                          <div>
                            <h3 class="table-title">
                              Table <?= htmlspecialchars($table->number) ?> (ID: <?= $table->id ?>)
                              <?php if ($hasReservations): ?>
                                <span class="badge" style="margin-left: 0.5rem; font-size: 0.625rem;">Has Reservations</span>
                              <?php endif; ?>
                            </h3>
                            <p class="table-description"><?= htmlspecialchars($table->description ?? 'No description available') ?></p>
                          </div>
                        </div>
                        <div class="table-content">
                          <div class="table-details">
                            <div class="table-detail">
                              <i class="fas fa-users"></i>
                              <?= htmlspecialchars($table->capacity) ?> people
                            </div>
                            <div class="table-detail">
                              <i class="fas fa-map-marker-alt"></i>
                              <span class="badge <?= getLocationClass($table->location) ?>"><?= htmlspecialchars($table->location) ?></span>
                            </div>
                            <div class="table-detail">
                              <i class="fas fa-dollar-sign"></i>
                              $<?= number_format($table->price, 2) ?> deposit
                            </div>
                          </div>
                          <?php if ($hasReservations): ?>
                            <div class="table-reservations">
                              <div class="reservation-title">
                                <i class="fas fa-clock"></i>
                                Existing Reservations
                              </div>
                              <div class="reservation-list">
                                <?php foreach ($tableReservations as $res): ?>
                                  <span class="badge badge-outline"><?= htmlspecialchars($res->start_time) ?> - <?= htmlspecialchars($res->end_time) ?></span>
                                <?php endforeach; ?>
                              </div>
                            </div>
                          <?php endif; ?>
                          <button class="btn btn-primary reserve-table-btn" data-table-id="<?= $table->id ?>" onclick="openReservationModal(<?= $table->id ?>)">Reserve This Table</button>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

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
          <?php if (empty($reservations)): ?>
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
          <?php else: ?>
            <?php
            $hasUpcoming = false;
            foreach ($reservations as $reservation) {
                if (isUpcoming($reservation->date, $reservation->start_time)) {
                    $hasUpcoming = true;
                    break;
                }
            }
            ?>
            <?php if (!$hasUpcoming): ?>
              <div class="debug-message">
                No upcoming reservations found. Cancel buttons are only shown for upcoming reservations. Please create a future reservation to test cancellation.
              </div>
            <?php endif; ?>
            <?php foreach ($reservations as $reservation): ?>
              <?php
              $table = $this->tableModel->getTableById($reservation->table_id, $this->restaurant_id);
              $upcoming = isUpcoming($reservation->date, $reservation->start_time);
              error_log("Processing reservation ID {$reservation->id}: Date={$reservation->date}, Time={$reservation->start_time}, Upcoming=" . ($upcoming ? 'Yes' : 'No'));
              ?>
              <div class="reservation-card">
                <div class="reservation-header">
                  <div class="reservation-info">
                    <h3 class="reservation-name"><?= $table ? htmlspecialchars('Table ' . $table->number) : 'Table ' . $reservation->table_id ?></h3>
                    <p class="reservation-date"><?= date('F j, Y', strtotime($reservation->date)) ?> • <?= htmlspecialchars($reservation->start_time) ?> - <?= htmlspecialchars($reservation->end_time) ?></p>
                  </div>
                  <div class="reservation-status <?= $upcoming ? 'status-upcoming' : 'status-past' ?>">
                    <?= $upcoming ? 'Upcoming' : 'Past' ?>
                  </div>
                </div>
                <div class="reservation-content">
                  <div class="reservation-details">
                    <div class="reservation-detail">
                      <i class="fas fa-users"></i>
                      <?= $table ? htmlspecialchars($table->capacity) : 'Unknown' ?> people
                    </div>
                    <div class="reservation-detail">
                      <i class="fas fa-map-marker-alt"></i>
                      <span class="badge <?= $table ? getLocationClass($table->location) : '' ?>">
                        <?= $table ? htmlspecialchars($table->location) : 'Unknown' ?>
                      </span>
                    </div>
                    <div class="reservation-detail">
                      <i class="fas fa-dollar-sign"></i>
                      $<?= $table ? number_format($table->price, 2) : 'Unknown' ?> deposit
                    </div>
                    <div class="reservation-detail">
                      <i class="fas fa-clock"></i>
                      Duration: <?= calculateDuration($reservation->start_time, $reservation->end_time) ?>
                    </div>
                    <?php if ($reservation->notes): ?>
                      <div class="reservation-detail">
                        <i class="fas fa-sticky-note"></i>
                        Has Notes
                      </div>
                    <?php endif; ?>
                  </div>
                  <?php if ($reservation->notes): ?>
                    <div class="reservation-notes">
                      <p class="reservation-notes-title">Special Requests:</p>
                      <p class="reservation-notes-text"><?= htmlspecialchars($reservation->notes) ?></p>
                    </div>
                  <?php endif; ?>
                </div>
                <div class="reservation-footer">
                  <?php if ($upcoming): ?>
                    <button class="btn btn-outline cancel-reservation-btn" data-reservation-id="<?= $reservation->id ?>" onclick="openCancelModal(<?= $reservation->id ?>)">Cancel Reservation</button>
                  <?php else: ?>
                    <p class="debug-message">This reservation is in the past and cannot be cancelled.</p>
                  <?php endif; ?>
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>

      <div class="tab-content" id="menu-tab">
        <h2 class="section-title">Our Menu</h2>
        <div class="menu-tabs">
          <button class="menu-tab-btn active" data-menu="starters">Starters</button>
          <button class="menu-tab-btn" data-menu="mains">Mains</button>
          <button class="menu-tab-btn" data-menu="desserts">Desserts</button>
          <button class="menu-tab-btn" data-menu="drinks">Drinks</button>
        </div>
        <?php foreach (['starters', 'mains', 'desserts', 'drinks'] as $category): ?>
          <div class="menu-content <?= $category === 'starters' ? 'active' : '' ?>" id="<?= $category ?>-menu">
            <div class="menu-grid" id="<?= $category ?>-grid">
              <?php if (empty($menuData[$category])): ?>
                <div class="empty-state">
                  <div class="empty-icon">
                    <i class="fas fa-utensils"></i>
                  </div>
                  <h3 class="empty-title">No <?= ucfirst($category) ?> Found</h3>
                  <p class="empty-description">No menu items are available in this category.</p>
                </div>
              <?php else: ?>
                <?php foreach ($menuData[$category] as $item): ?>
                  <div class="menu-item">
                    <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="menu-image">
                    <div class="menu-details">
                      <div class="menu-header">
                        <h3 class="menu-title"><?= htmlspecialchars($item['name']) ?></h3>
                        <span class="menu-price">$<?= number_format($item['price'], 2) ?></span>
                      </div>
                      <?php if (!empty($item['tags'])): ?>
                        <div class="menu-tags">
                          <?php foreach ($item['tags'] as $tag): ?>
                            <span class="menu-tag"><?= htmlspecialchars($tag) ?></span>
                          <?php endforeach; ?>
                        </div>
                      <?php endif; ?>
                      <p class="menu-description"><?= htmlspecialchars($item['description']) ?></p>
                    </div>
                  </div>
                <?php endforeach; ?>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- Reservation Modal -->
  <div class="modal" id="reservation-modal">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Reserve <span id="modal-table-name"></span></h3>
        <button class="modal-close">×</button>
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
        <form id="reservation-form" class="form" action="<?= ROOT ?>/traveler/restaurant/reserve" method="POST">
          <input type="hidden" name="table_id" id="table-id">
          <input type="hidden" name="date" id="reservation-date" value="<?= htmlspecialchars($selected_date) ?>">
          <div class="form-group">
            <label for="customer-name">Your Name</label>
            <input type="text" id="customer-name" name="customer_name" placeholder="John Doe" required>
            <p class="error-text" id="name-error"></p>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="start-time">Start Time</label>
              <select id="start-time" name="start_time" required>
                <!-- Populated by JS -->
              </select>
              <p class="error-text" id="start-time-error"></p>
            </div>
            <div class="form-group">
              <label for="end-time">End Time</label>
              <select id="end-time" name="end_time" required>
                <!-- Populated by JS -->
              </select>
              <p class="error-text" id="end-time-error"></p>
            </div>
          </div>
          <div class="form-group">
            <label for="notes">Special Requests (Optional)</label>
            <textarea id="notes" name="notes" rows="3" placeholder="Any special requests or dietary requirements?"></textarea>
          </div>
          <div class="form-buttons">
            <button type="button" class="btn btn-outline" id="cancel-reservation-btn">Cancel</button>
            <button type="submit" class="btn btn-primary" id="confirm-reservation-btn">Confirm Reservation</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Cancel Modal -->
  <div class="modal" id="cancel-modal">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Cancel Reservation</h3>
        <button class="modal-close">×</button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to cancel this reservation? Cancellations within 24 hours of the reservation time may incur a fee or forfeit any deposit.</p>
        <div class="form-buttons">
          <button class="btn btn-outline" id="keep-reservation-btn">Keep Reservation</button>
          <form id="cancel-reservation-form" action="<?= ROOT ?>/traveler/restaurant/cancelReservation" method="POST" style="display: inline;">
            <input type="hidden" name="reservation_id" id="cancel-reservation-id">
            <button type="submit" class="btn btn-danger" id="confirm-cancel-btn">Yes, Cancel Reservation</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      console.log('Page loaded, initializing components for date: <?= $selected_date ?>');
      const tables = <?php echo json_encode(array_map(function($t) { return (array)$t; }, $tables)); ?>;
      console.log('Tables data:', tables);
      if (!tables || tables.length === 0) {
        console.error('No tables available in $tables. Check server-side data fetching.');
      } else {
        console.log('Table IDs available:', tables.map(t => t.id));
      }
      const reservations = <?php echo json_encode($reservations); ?>;
      console.log('Reservations data:', reservations);
      if (!reservations || reservations.length === 0) {
        console.error('No reservations available. Cancel buttons will not appear.');
      } else {
        console.log('Reservation IDs available:', reservations.map(r => r.id));
      }
      initTabs();
      initMenuTabs();
      initCalendar();
      initModalHandlers();
      const today = new Date('<?= $selected_date ?>');
      window.selectedDate = today;
      document.getElementById('selected-date').textContent = formatDate(today);
    });

    function initTabs() {
      document.querySelectorAll('[data-tab]').forEach(button => {
        button.addEventListener('click', () => {
          console.log('Tab clicked:', button.dataset.tab);
          const tabName = button.dataset.tab;
          document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
          document.querySelectorAll('.tab-btn[data-tab="' + tabName + '"]').forEach(btn => btn.classList.add('active'));
          document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
          document.getElementById(tabName + '-tab').classList.add('active');
        });
      });
    }

    function initMenuTabs() {
      document.querySelectorAll('.menu-tab-btn').forEach(button => {
        button.addEventListener('click', () => {
          console.log('Menu tab clicked:', button.dataset.menu);
          const menuName = button.dataset.menu;
          document.querySelectorAll('.menu-tab-btn').forEach(btn => btn.classList.remove('active'));
          button.classList.add('active');
          document.querySelectorAll('.menu-content').forEach(content => content.classList.remove('active'));
          document.getElementById(menuName + '-menu').classList.add('active');
        });
      });
    }

    function initCalendar() {
      console.log('Initializing calendar for date:', '<?= $selected_date ?>');
      const calendar = document.getElementById('reservation-calendar');
      const today = new Date('<?= $selected_date ?>');
      const currentMonth = today.getMonth();
      const currentYear = today.getFullYear();
      renderCalendar(calendar, currentMonth, currentYear);
    }

    function renderCalendar(calendar, month, year) {
      console.log('Rendering calendar for month:', month, 'year:', year);
      const today = new Date();
      const firstDay = new Date(year, month, 1);
      const lastDay = new Date(year, month + 1, 0);
      const daysInMonth = lastDay.getDate();
      const startingDay = firstDay.getDay();
      calendar.innerHTML = '';
      const header = document.createElement('div');
      header.className = 'calendar-header';
      const prevButton = document.createElement('button');
      prevButton.innerHTML = '<';
      prevButton.className = 'calendar-nav';
      prevButton.addEventListener('click', () => {
        let newMonth = month - 1;
        let newYear = year;
        if (newMonth < 0) {
          newMonth = 11;
          newYear--;
        }
        console.log('Navigating to previous month:', newMonth, newYear);
        renderCalendar(calendar, newMonth, newYear);
      });
      const monthYearText = document.createElement('div');
      monthYearText.className = 'calendar-title';
      monthYearText.textContent = new Date(year, month, 1).toLocaleDateString('en-US', { month: 'long', year: 'numeric' });
      const nextButton = document.createElement('button');
      nextButton.innerHTML = '>';
      nextButton.className = 'calendar-nav';
      nextButton.addEventListener('click', () => {
        let newMonth = month + 1;
        let newYear = year;
        if (newMonth > 11) {
          newMonth = 0;
          newYear++;
        }
        console.log('Navigating to next month:', newMonth, newYear);
        renderCalendar(calendar, newMonth, newYear);
      });
      header.appendChild(prevButton);
      header.appendChild(monthYearText);
      header.appendChild(nextButton);
      calendar.appendChild(header);
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
      const daysGrid = document.createElement('div');
      daysGrid.className = 'calendar-days';
      for (let i = 0; i < startingDay; i++) {
        const emptyDay = document.createElement('div');
        emptyDay.className = 'calendar-day empty';
        daysGrid.appendChild(emptyDay);
      }
      for (let i = 1; i <= daysInMonth; i++) {
        const dayElem = document.createElement('div');
        dayElem.className = 'calendar-day';
        dayElem.textContent = i;
        const currentDate = new Date(year, month, i);
        if (currentDate < new Date(today.getFullYear(), today.getMonth(), today.getDate())) {
          dayElem.classList.add('disabled');
        } else {
          dayElem.addEventListener('click', () => {
            console.log('Calendar date clicked:', `${year}-${month + 1}-${i}`);
            document.querySelectorAll('.calendar-day.selected').forEach(day => day.classList.remove('selected'));
            dayElem.classList.add('selected');
            window.selectedDate = new Date(year, month, i);
            document.getElementById('selected-date').textContent = formatDate(window.selectedDate);
            const dateStr = formatDateForStorage(window.selectedDate);
            window.location.href = '<?= ROOT ?>/traveler/restaurant?date=' + dateStr;
          });
        }
        if (year === today.getFullYear() && month === today.getMonth() && i === today.getDate()) {
          dayElem.classList.add('today');
          dayElem.classList.add('selected');
        }
        daysGrid.appendChild(dayElem);
      }
      calendar.appendChild(daysGrid);
    }

    document.querySelectorAll('[data-filter]').forEach(badge => {
      badge.addEventListener('click', () => {
        console.log('Filter badge clicked:', badge.dataset.filter, badge.dataset.value);
        const filterType = badge.dataset.filter;
        const filterValue = badge.dataset.value;
        document.querySelectorAll(`[data-filter="${filterType}"]`).forEach(b => b.classList.remove('badge-active'));
        badge.classList.add('badge-active');
        window[filterType + 'Filter'] = filterValue;
      });
    });

    window.locationFilter = 'All';
    window.capacityFilter = 'All';

    function initModalHandlers() {
      document.querySelectorAll('.modal-close').forEach(button => {
        button.addEventListener('click', () => {
          console.log('Modal close button clicked');
          closeAllModals();
        });
      });
      document.getElementById('cancel-reservation-btn').addEventListener('click', () => {
        console.log('Cancel reservation button clicked');
        closeAllModals();
      });
      document.getElementById('reservation-form').addEventListener('submit', function(e) {
        console.log('Reservation form submission attempted');
        const customerName = document.getElementById('customer-name').value.trim();
        const startTime = document.getElementById('start-time').value;
        const endTime = document.getElementById('end-time').value;
        const tableId = document.getElementById('table-id').value;
        const date = document.getElementById('reservation-date').value;
        const notes = document.getElementById('notes').value.trim();

        const formData = { table_id: tableId, customer_name: customerName, date: date, start_time: startTime, end_time: endTime, notes: notes };
        console.log('Form data:', formData);

        document.getElementById('name-error').textContent = '';
        document.getElementById('start-time-error').textContent = '';
        document.getElementById('end-time-error').textContent = '';

        let hasError = false;

        if (!customerName) {
          document.getElementById('name-error').textContent = 'Name is required';
          console.log('Validation error: Name is required');
          hasError = true;
        }
        if (!startTime) {
          document.getElementById('start-time-error').textContent = 'Start time is required';
          console.log('Validation error: Start time is required');
          hasError = true;
        }
        if (!endTime) {
          document.getElementById('end-time-error').textContent = 'End time is required';
          console.log('Validation error: End time is required');
          hasError = true;
        }
        if (startTime && endTime && timeToMinutes(endTime) <= timeToMinutes(startTime)) {
          document.getElementById('end-time-error').textContent = 'End time must be after start time';
          console.log('Validation error: End time must be after start time');
          hasError = true;
        }
        if (!tableId) {
          console.log('Validation error: Table ID is missing');
          hasError = true;
        }
        if (!date) {
          console.log('Validation error: Date is missing');
          hasError = true;
        }

        if (hasError) {
          console.log('Form submission prevented due to validation errors');
          e.preventDefault();
        } else {
          console.log('Form validation passed, submitting to:', '<?= ROOT ?>/traveler/restaurant/reserve');
        }
      });
      document.getElementById('keep-reservation-btn').addEventListener('click', () => {
        console.log('Keep reservation button clicked');
        closeAllModals();
      });
      document.getElementById('cancel-reservation-form').addEventListener('submit', function(e) {
        console.log('Cancel reservation form submission attempted');
        const reservationId = document.getElementById('cancel-reservation-id').value;
        console.log('Cancel reservation ID:', reservationId);
        if (!reservationId) {
          console.error('Cancel reservation ID is missing');
          e.preventDefault();
        } else {
          console.log('Cancel form validation passed, submitting to:', '<?= ROOT ?>/traveler/restaurant/cancelReservation');
        }
      });
    }

    function openReservationModal(tableId) {
      console.log('Opening reservation modal for table ID:', tableId);
      const modal = document.getElementById('reservation-modal');
      const form = document.getElementById('reservation-form');
      const tables = <?php echo json_encode(array_map(function($t) { return (array)$t; }, $tables)); ?>;
      console.log('Available tables:', tables);
      const table = tables.find(t => parseInt(t.id) === parseInt(tableId));
      if (!table) {
        console.error('Table not found for ID:', tableId, 'Available tables:', tables);
        alert('Error: Table not found (ID: ' + tableId + '). Please try another table or contact support.');
        return;
      }
      document.getElementById('modal-table-name').textContent = table.number;
      document.getElementById('modal-table-details').textContent = `${table.number} (${table.capacity} people) - ${table.location}`;
      document.getElementById('modal-date').textContent = `Date: ${formatDate(window.selectedDate)}`;
      document.getElementById('modal-price').textContent = `Reservation Deposit: $${parseFloat(table.price).toFixed(2)}`;
      document.getElementById('modal-price').style.display = table.price > 0 ? 'block' : 'none';
      document.getElementById('table-id').value = tableId;
      document.getElementById('reservation-date').value = '<?php echo htmlspecialchars($selected_date); ?>';
      console.log('Set form fields:', { table_id: tableId, date: '<?php echo htmlspecialchars($selected_date); ?>' });

      // Reset form
      form.reset();
      document.getElementById('customer-name').value = '';
      document.getElementById('notes').value = '';
      document.getElementById('name-error').textContent = '';
      document.getElementById('start-time-error').textContent = '';
      document.getElementById('end-time-error').textContent = '';

      populateTimeOptions();
      const dateStr = formatDateForStorage(window.selectedDate);
      const tableReservations = <?php echo json_encode($reservations); ?>.filter(res => parseInt(res.table_id) === parseInt(tableId) && res.date === dateStr);
      const existingReservationsBox = document.getElementById('existing-reservations-box');
      const existingReservationsList = document.getElementById('existing-reservations-list');
      if (tableReservations.length > 0) {
        console.log('Existing reservations found:', tableReservations);
        existingReservationsBox.style.display = 'block';
        existingReservationsList.innerHTML = tableReservations.map(res => `
          <div class="reservation-item">
            <span class="badge badge-outline">${res.start_time} - ${res.end_time}</span>
          </div>
        `).join('');
      } else {
        console.log('No existing reservations for table ID:', tableId);
        existingReservationsBox.style.display = 'none';
        existingReservationsList.innerHTML = '';
      }
      modal.classList.add('active');
      console.log('Modal opened successfully');
    }

    function populateTimeOptions() {
      console.log('Populating time options');
      const startTimeSelect = document.getElementById('start-time');
      const endTimeSelect = document.getElementById('end-time');
      if (!startTimeSelect || !endTimeSelect) {
        console.error('Time select elements not found');
        return;
      }
      startTimeSelect.innerHTML = '';
      endTimeSelect.innerHTML = '';
      const timeOptions = generateTimeOptions();
      timeOptions.slice(0, -1).forEach(time => {
        const option = document.createElement('option');
        option.value = time;
        option.textContent = time;
        startTimeSelect.appendChild(option);
      });
      timeOptions.slice(1).forEach(time => {
        const option = document.createElement('option');
        option.value = time;
        option.textContent = time;
        endTimeSelect.appendChild(option);
      });
      startTimeSelect.value = '18:00';
      endTimeSelect.value = '20:00';
      console.log('Time options populated:', timeOptions);
    }

    function generateTimeOptions() {
      console.log('Generating time options');
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

    function openCancelModal(reservationId) {
      console.log('Opening cancel modal for reservation ID:', reservationId);
      const modal = document.getElementById('cancel-modal');
      document.getElementById('cancel-reservation-id').value = reservationId;
      modal.classList.add('active');
    }

    function closeAllModals() {
      console.log('Closing all modals');
      document.querySelectorAll('.modal').forEach(modal => modal.classList.remove('active'));
    }

    function timeToMinutes(time) {
      console.log('Converting time to minutes:', time);
      const [hours, minutes] = time.split(':').map(Number);
      return hours * 60 + minutes;
    }

    function formatDate(date) {
      console.log('Formatting date:', date);
      return date.toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
    }

    function formatDateForStorage(date) {
      console.log('Formatting date for storage:', date);
      const year = date.getFullYear();
      const month = (date.getMonth() + 1).toString().padStart(2, '0');
      const day = date.getDate().toString().padStart(2, '0');
      return `${year}-${month}-${day}`;
    }
  </script>
</body>
</html>
