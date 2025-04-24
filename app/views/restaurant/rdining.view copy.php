<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
} ?>


<?php include '../app/views/components/rnav.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">

  <title>Restaurant Management Dashboard</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    }

    :root {
      --primary: #002D40;
      --primary-foreground: #ffffff;
      --muted: #f5f5f5;
      --muted-foreground: #6b7280;
      --border: #e5e7eb;
      --background: #ffffff;
      --card: #ffffff;
      --destructive: #ef4444;
      --destructive-foreground: #ffffff;
      --success: #10b981;
      --success-foreground: #ffffff;
      --warning: #f59e0b;
      --warning-foreground: #ffffff;
    }

    body {
      background-color: rgba(245, 245, 245, 0.4);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .container {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      width: 100%;
    }

    header {
      position: sticky;
      top: 0;
      z-index: 10;
      display: flex;
      height: 64px;
      align-items: center;
      gap: 16px;
      border-bottom: 1px solid var(--border);
      background-color: var(--background);
      padding: 0 16px;
    }

    @media (min-width: 640px) {
      header {
        padding: 0 24px;
      }
    }

    header h1 {
      font-size: 18px;
      font-weight: 600;
    }

    @media (min-width: 768px) {
      header h1 {
        font-size: 24px;
      }
    }

    main {
      display: flex;
      flex: 1;
      flex-direction: column;
      gap: 16px;
      padding: 16px;
      margin-left: 250px;
    }

    @media (min-width: 768px) {
      main {
        gap: 32px;
        padding: 32px;
      }
    }

    .tabs {
      display: flex;
      flex-direction: column;
      gap: 16px;
    }

    .tabs-list {
      display: flex;
      background-color: var(--muted);
      border-radius: 8px;
      padding: 2px;
    }

    .tab-trigger {
      flex: 1;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border-radius: 6px;
      padding: 8px 16px;
      font-size: 14px;
      font-weight: 500;
      background-color: transparent;
      color: var(--muted-foreground);
      border: none;
      cursor: pointer;
      transition: all 0.2s;
      text-decoration: none;
      text-align: center;
    }

    .tab-trigger[aria-selected="true"] {
      background-color: white;
      color: black;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .tab-content {
      display: none;
      flex-direction: column;
      gap: 16px;
    }

    .tab-content[data-active="true"] {
      display: flex;
    }

    .card {
      background-color: var(--card);
      border-radius: 8px;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }

    .card-header {
      padding: 16px;
      border-bottom: 1px solid var(--border);
    }

    .card-title {
      font-size: 18px;
      font-weight: 600;
      margin-bottom: 4px;
    }

    .card-description {
      color: var(--muted-foreground);
      font-size: 14px;
    }

    .card-content {
      padding: 16px;
    }

    .card-footer {
      padding: 12px 24px;
      border-top: 1px solid var(--border);
      background-color: rgba(245, 245, 245, 0.2);
      display: flex;
      gap: 8px;
      flex-wrap: wrap;
    }

    .form-grid {
      display: grid;
      gap: 16px;
    }

    .form-grid-2 {
      grid-template-columns: 1fr;
    }

    @media (min-width: 640px) {
      .form-grid-2 {
        grid-template-columns: repeat(2, 1fr);
      }
      
      .form-grid-3 {
        grid-template-columns: repeat(3, 1fr);
      }
    }

    .form-group {
      display: grid;
      gap: 8px;
    }

    label {
      font-size: 14px;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 4px;
    }

    input, select, textarea {
      padding: 8px 12px;
      border-radius: 6px;
      border: 1px solid var(--border);
      font-size: 14px;
      width: 100%;
      background-color: var(--background);
    }

    input:focus, select:focus, textarea:focus {
      outline: 2px solid var(--primary);
      outline-offset: 1px;
      border-color: var(--primary);
    }

    textarea {
      resize: none;
      min-height: 80px;
    }

    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border-radius: 6px;
      padding: 8px 16px;
      font-size: 14px;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.2s;
      border: none;
    }

    .btn-primary {
      background-color: var(--primary);
      color: var(--primary-foreground);
    }

    .btn-primary:hover {
      background-color: #1A4555;
    }

    .btn-outline {
      background-color: transparent;
      border: 1px solid var(--border);
    }

    .btn-outline:hover {
      background-color: var(--muted);
    }

    .btn-block {
      width: 100%;
    }

    .btn:disabled {
      opacity: 0.5;
      cursor: not-allowed;
    }

    .btn-icon {
      margin-right: 8px;
    }

    .tables-grid {
      display: grid;
      gap: 16px;
    }

    @media (min-width: 640px) {
      .tables-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (min-width: 1024px) {
      .tables-grid {
        grid-template-columns: repeat(3, 1fr);
      }
    }

    .table-card-header {
      background-color: rgba(245, 245, 245, 0.5);
      padding-bottom: 12px;
    }

    .table-card-header-content {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 8px;
      flex-wrap: wrap;
    }

    .table-card-actions {
      display: flex;
      gap: 8px;
    }

    .badge {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border-radius: 4px;
      padding: 2px 8px;
      font-size: 12px;
      font-weight: 500;
    }

    .badge-outline {
      border: 1px solid var(--border);
    }

    .badge-destructive {
      background-color: var(--destructive);
      color: var(--destructive-foreground);
    }

    .badge-success {
      background-color: var(--success);
      color: var(--success-foreground);
    }

    .badge-warning {
      background-color: var(--warning);
      color: var(--warning-foreground);
    }

    .table-card-content {
      padding-top: 16px;
    }

    .table-info {
      display: grid;
      gap: 8px;
    }

    .table-info-item {
      display: flex;
      align-items: center;
      font-size: 14px;
    }

    .table-info-icon {
      margin-right: 8px;
      color: var(--muted-foreground);
    }

    .reservation-info {
      margin-top: 8px;
      background-color: var(--muted);
      border-radius: 6px;
      padding: 8px;
      font-size: 14px;
    }

    .reservation-name {
      font-weight: 500;
    }

    .reservation-time {
      font-size: 12px;
      color: var(--muted-foreground);
    }

    .reservation-card-content {
      padding: 0;
    }

    .reservation-card-layout {
      display: flex;
      flex-direction: column;
    }

    @media (min-width: 640px) {
      .reservation-card-layout {
        flex-direction: row;
      }
    }

    .reservation-card-number {
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: var(--primary);
      padding: 16px;
      color: var(--primary-foreground);
    }

    @media (min-width: 640px) {
      .reservation-card-number {
        width: 120px;
      }
    }

    .reservation-card-number span {
      font-size: 24px;
      font-weight: 700;
    }

    .reservation-card-details {
      padding: 16px;
    }

    .reservation-card-customer {
      font-weight: 600;
    }

    .reservation-card-meta {
      margin-top: 4px;
      display: flex;
      align-items: center;
      font-size: 14px;
      color: var(--muted-foreground);
    }

    .reservation-card-meta-icon {
      margin-right: 4px;
    }

    .reservation-card-time {
      margin-top: 8px;
      font-size: 14px;
      font-weight: 500;
    }

    .reservation-card-notes {
      margin-top: 4px;
      font-size: 14px;
      color: var(--muted-foreground);
    }

    .empty-state {
      display: flex;
      height: 128px;
      align-items: center;
      justify-content: center;
      border: 1px dashed var(--border);
      border-radius: 6px;
    }

    .empty-state p {
      color: var(--muted-foreground);
    }

    .modal-backdrop {
      background-color: rgba(0, 0, 0, 0.5);
      padding: 16px;
      border-radius: 8px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 50;
      width: 100%;
      max-width: 475px;
    }

    .modal {
      background-color: white;
      border-radius: 8px;
      width: 100%;
      max-width: 425px;
      overflow-y: auto;
    }

    .modal-header {
      padding: 16px;
      border-bottom: 1px solid var(--border);
    }

    .modal-title {
      font-size: 18px;
      font-weight: 600;
      margin-bottom: 4px;
    }

    .modal-description {
      color: var(--muted-foreground);
      font-size: 14px;
    }

    .modal-body {
      padding: 16px;
    }

    .modal-footer {
      padding: 16px;
      border-top: 1px solid var(--border);
      display: flex;
      justify-content: flex-end;
      gap: 8px;
    }

    .time-slots {
      display: flex;
      flex-direction: column;
      gap: 8px;
      margin-top: 12px;
    }

    .time-slot {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 8px 12px;
      border-radius: 6px;
      background-color: var(--muted);
      font-size: 14px;
    }

    .time-slot-reserved {
      background-color: rgba(239, 68, 68, 0.1);
      border-left: 3px solid var(--destructive);
    }

    .time-slot-available {
      background-color: rgba(16, 185, 129, 0.1);
      border-left: 3px solid var(--success);
    }

    .time-slot-info {
      display: flex;
      flex-direction: column;
    }

    .time-slot-customer {
      font-weight: 500;
    }

    .time-slot-time {
      font-size: 12px;
      color: var(--muted-foreground);
    }

    .time-slot-actions {
      display: flex;
      gap: 8px;
    }

    .icon {
      width: 16px;
      height: 16px;
      stroke-width: 2;
      stroke: currentColor;
      fill: none;
      stroke-linecap: round;
      stroke-linejoin: round;
    }

    .mt-4 {
      margin-top: 16px;
    }

    .sr-only {
      position: absolute;
      width: 1px;
      height: 1px;
      padding: 0;
      margin: -1px;
      overflow: hidden;
      clip: rect(0, 0, 0, 0);
      white-space: nowrap;
      border-width: 0;
    }

    .reservation-list {
      display: flex;
      flex-direction: column;
      gap: 8px;
      margin-top: 12px;
    }

    .reservation-item {
      padding: 12px;
      border-radius: 6px;
      background-color: var(--muted);
      border-left: 3px solid var(--primary);
    }

    .reservation-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 8px;
    }

    .reservation-table {
      font-weight: 600;
    }

    .reservation-details {
      display: flex;
      flex-direction: column;
      gap: 4px;
    }

    .reservation-detail {
      display: flex;
      align-items: center;
      font-size: 14px;
    }

    .reservation-detail-icon {
      margin-right: 8px;
      color: var(--muted-foreground);
    }

    .date-selector {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 16px;
    }

    .date-selector label {
      margin-bottom: 0;
      font-size: 14px;
      font-weight: 500;
    }

    .date-selector input {
      flex: 1;
      max-width: 200px;
    }

    .date-selector button {
      padding: 8px 12px;
    }

    .error-message {
      color: var(--destructive);
      font-size: 13px;
      margin-top: 4px;
    }

    .success-message {
      color: var(--success);
      font-size: 14px;
      padding: 12px;
      background-color: rgba(16, 185, 129, 0.1);
      border-radius: 6px;
      text-align: center;
      margin-bottom: 12px;
    }

    .success-popup {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 100;
      background-color: var(--background);
      border-radius: 8px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
      padding: 16px;
      max-width: 300px;
      text-align: center;
    }

    .success-popup-content {
      display: flex;
      flex-direction: column;
      gap: 12px;
    }

    .success-popup-message {
      color: var(--success);
      font-size: 16px;
      font-weight: 500;
    }

    .success-popup-close {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 8px 16px;
      background-color: var(--primary);
      color: var(--primary-foreground);
      border-radius: 6px;
      text-decoration: none;
      font-size: 14px;
    }

    .success-popup-close:hover {
      background-color: #0060df;
    }

    form {
      width: 100%;
    }

    .tabs-list a {
      display: block;
      width: 100%;
    }
  </style>
</head>
<body>
  <div class="container">
    <main>
      <!-- Server errors -->
      <?php if (isset($data['error'])): ?>
        <div class="error-message"><?php echo htmlspecialchars($data['error']); ?></div>
      <?php endif; ?>
      
      <!-- Success Popup -->
      <?php if (isset($data['success_message'])): ?>
        <div class="success-popup">
          <div class="success-popup-content">
            <div class="success-popup-message"><?php echo htmlspecialchars($data['success_message']); ?></div>
            <a href="?tab=<?php echo htmlspecialchars($data['tab']); ?>&date=<?php echo htmlspecialchars($data['selectedDate']); ?>" class="success-popup-close">Close</a>
          </div>
        </div>
      <?php endif; ?>

      <div class="tabs">
        <!-- Tab navigation -->
        <div class="tabs-list" role="tablist">
          <a href="?tab=tables&date=<?php echo htmlspecialchars($data['selectedDate']); ?>" class="tab-trigger" role="tab" aria-selected="<?php echo $data['tab'] === 'tables' ? 'true' : 'false'; ?>">Tables</a>
          <a href="?tab=reservations&date=<?php echo htmlspecialchars($data['selectedDate']); ?>" class="tab-trigger" role="tab" aria-selected="<?php echo $data['tab'] === 'reservations' ? 'true' : 'false'; ?>">Reservations</a>
        </div>
        
        <!-- Tables Tab -->
        <div class="tab-content" data-tab="tables" data-active="<?php echo $data['tab'] === 'tables' ? 'true' : 'false'; ?>">
          <!-- Add Table Form -->
          <div class="card">
            <div class="card-header">
              <h2 class="card-title">Add New Table</h2>
              <p class="card-description">Create a new table with its details.</p>
            </div>
            <div class="card-content">
              <form method="POST" action="">
                <input type="hidden" name="add_table" value="1">
                <input type="hidden" name="tab" value="tables">
                <input type="hidden" name="date" value="<?php echo htmlspecialchars($data['selectedDate']); ?>">
                <div class="form-grid form-grid-3">
                  <div class="form-group">
                    <label for="table-number">Table Number</label>
                    <input id="table-number" name="number" type="number" placeholder="Enter table number" value="<?php echo htmlspecialchars($_POST['number'] ?? ''); ?>">
                    <?php if (isset($data['errors']['table']['number'])): ?>
                      <div class="error-message"><?php echo htmlspecialchars($data['errors']['table']['number']); ?></div>
                    <?php endif; ?>
                  </div>
                  <div class="form-group">
                    <label for="capacity">Capacity</label>
                    <input id="capacity" name="capacity" type="number" placeholder="Enter capacity" value="<?php echo htmlspecialchars($_POST['capacity'] ?? ''); ?>">
                    <?php if (isset($data['errors']['table']['capacity'])): ?>
                      <div class="error-message"><?php echo htmlspecialchars($data['errors']['table']['capacity']); ?></div>
                    <?php endif; ?>
                  </div>
                  <div class="form-group">
                    <label for="location">Location</label>
                    <select id="location" name="location">
                      <option value="" disabled <?php echo !isset($_POST['location']) ? 'selected' : ''; ?>>Select location</option>
                      <option value="Indoor" <?php echo ($_POST['location'] ?? '') === 'Indoor' ? 'selected' : ''; ?>>Indoor</option>
                      <option value="Outdoor" <?php echo ($_POST['location'] ?? '') === 'Outdoor' ? 'selected' : ''; ?>>Outdoor</option>
                      <option value="VIP" <?php echo ($_POST['location'] ?? '') === 'VIP' ? 'selected' : ''; ?>>VIP</option>
                    </select>
                    <?php if (isset($data['errors']['table']['location'])): ?>
                      <div class="error-message"><?php echo htmlspecialchars($data['errors']['table']['location']); ?></div>
                    <?php endif; ?>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary mt-4">
                  <svg class="icon btn-icon" viewBox="0 0 24 24">
                    <path d="M12 5v14M5 12h14"></path>
                  </svg>
                  Add Table
                </button>
              </form>
            </div>
          </div>
          
          <!-- Date Selector -->
          <div class="date-selector">
            <form method="GET" action="">
              <input type="hidden" name="tab" value="tables">
              <label for="selected-date">Date:</label>
              <input type="date" id="selected-date" name="date" value="<?php echo htmlspecialchars($data['selectedDate']); ?>">
              <button type="submit" class="btn btn-primary">Update Date</button>
            </form>
          </div>
          
          <!-- Tables Grid -->
          <div class="tables-grid">
            <?php if (empty($data['tables'])): ?>
              <div class="empty-state">
                <p>No tables available.</p>
              </div>
            <?php else: ?>
              <?php foreach ($data['tables'] as $table): ?>
                <?php
                  $reservationsForDate = $table->reservations ?? [];
                  $status = 'Available';
                  if (!empty($reservationsForDate)) {
                      $now = new DateTime();
                      $currentTime = $now->format('H:i');
                      $today = $now->format('Y-m-d');
                      $futureReservations = array_filter($reservationsForDate, function($res) use ($today, $currentTime, $data) {
                          return $data['selectedDate'] !== $today || $res->end_time > $currentTime;
                      });
                      $status = !empty($futureReservations) ? (count($futureReservations) === count($reservationsForDate) ? 'Reserved' : 'Partially Reserved') : 'Available';
                  }
                  $statusBadgeClass = $status === 'Reserved' ? 'badge-destructive' : ($status === 'Partially Reserved' ? 'badge-warning' : 'badge-success');
                ?>
                <div class="card">
                  <div class="card-header table-card-header">
                    <div class="table-card-header-content">
                      <div>
                        <h3 class="card-title">Table #<?php echo htmlspecialchars($table->number); ?></h3>
                        <span class="badge <?php echo $statusBadgeClass; ?>"><?php echo $status; ?></span>
                      </div>
                      <div class="table-card-actions">
                        <form method="POST" action="">
                          <input type="hidden" name="show_update_table" value="1">
                          <input type="hidden" name="table_id" value="<?php echo htmlspecialchars($table->id); ?>">
                          <input type="hidden" name="tab" value="tables">
                          <input type="hidden" name="date" value="<?php echo htmlspecialchars($data['selectedDate']); ?>">
                          <button type="submit" class="btn btn-outline">
                            <svg class="icon btn-icon" viewBox="0 0 24 24">
                              <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                              <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                            Update
                          </button>
                        </form>
                        <form method="POST" action="">
                          <input type="hidden" name="delete_table" value="1">
                          <input type="hidden" name="table_id" value="<?php echo htmlspecialchars($table->id); ?>">
                          <input type="hidden" name="tab" value="tables">
                          <input type="hidden" name="date" value="<?php echo htmlspecialchars($data['selectedDate']); ?>">
                          <button type="submit" class="btn btn-outline" onclick="return confirm('Are you sure you want to delete Table #<?php echo htmlspecialchars($table->number); ?>? This will also delete all associated reservations.')">
                            <svg class="icon btn-icon" viewBox="0 0 24 24">
                              <line x1="18" y1="6" x2="6" y2="18"></line>
                              <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                            Delete
                          </button>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="card-content table-card-content">
                    <div class="table-info">
                      <div class="table-info-item">
                        <svg class="icon table-info-icon" viewBox="0 0 24 24">
                          <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                          <circle cx="9" cy="7" r="4"></circle>
                          <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                          <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        <span>Capacity: <?php echo htmlspecialchars($table->capacity); ?></span>
                      </div>
                      <div class="table-info-item">
                        <svg class="icon table-info-icon" viewBox="0 0 24 24">
                          <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                          <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        <span>Location: <?php echo htmlspecialchars($table->location); ?></span>
                      </div>
                    </div>
                    
                    <div class="time-slots">
                      <h4>Reservations for <?php echo htmlspecialchars(date('D, M d, Y', strtotime($data['selectedDate']))); ?></h4>
                      <?php if (empty($reservationsForDate)): ?>
                        <div class="time-slot time-slot-available">
                          <span>No reservations for this date</span>
                        </div>
                      <?php else: ?>
                        <?php
                          usort($reservationsForDate, function($a, $b) {
                              return strcmp($a->start_time, $b->start_time);
                          });
                        ?>
                        <?php foreach ($reservationsForDate as $reservation): ?>
                          <div class="time-slot time-slot-reserved">
                            <div class="time-slot-info">
                              <span class="time-slot-customer"><?php echo htmlspecialchars($reservation->customer_name); ?></span>
                              <span class="time-slot-time">
                                <?php
                                  $start = DateTime::createFromFormat('H:i:s', $reservation->start_time);
                                  $end = DateTime::createFromFormat('H:i:s', $reservation->end_time);
                                  echo $start->format('h:i A') . ' - ' . $end->format('h:i A');
                                ?>
                              </span>
                            </div>
                            <div class="time-slot-actions">
                              <form method="POST" action="">
                                <input type="hidden" name="edit_reservation" value="1">
                                <input type="hidden" name="reservation_id" value="<?php echo htmlspecialchars($reservation->id); ?>">
                                <input type="hidden" name="table_id" value="<?php echo htmlspecialchars($table->id); ?>">
                                <input type="hidden" name="tab" value="tables">
                                <input type="hidden" name="date" value="<?php echo htmlspecialchars($data['selectedDate']); ?>">
                                <button type="submit" class="btn btn-outline edit-reservation-btn">
                                  <svg class="icon" viewBox="0 0 24 24">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                  </svg>
                                </button>
                              </form>
                              <form method="POST" action="">
                                <input type="hidden" name="cancel_reservation" value="1">
                                <input type="hidden" name="reservation_id" value="<?php echo htmlspecialchars($reservation->id); ?>">
                                <input type="hidden" name="tab" value="tables">
                                <input type="hidden" name="date" value="<?php echo htmlspecialchars($data['selectedDate']); ?>">
                                <button type="submit" class="btn btn-outline cancel-reservation-btn" onclick="return confirm('Are you sure you want to cancel this reservation?')">
                                  <svg class="icon" viewBox="0 0 24 24">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                  </svg>
                                </button>
                              </form>
                            </div>
                          </div>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </div>
                  </div>
                  <!-- Table Actions (Add Reservation Only) -->
                  <div class="card-footer">
                    <form method="POST" action="">
                      <input type="hidden" name="show_add_reservation" value="1">
                      <input type="hidden" name="table_id" value="<?php echo htmlspecialchars($table->id); ?>">
                      <input type="hidden" name="tab" value="tables">
                      <input type="hidden" name="date" value="<?php echo htmlspecialchars($data['selectedDate']); ?>">
                      <button type="submit" class="btn btn-primary btn-block">
                        <svg class="icon btn-icon" viewBox="0 0 24 24">
                          <path d="M12 5v14M5 12h14"></path>
                        </svg>
                        Add Reservation
                      </button>
                    </form>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>
        
        <!-- Reservations Tab -->
        <div class="tab-content" data-tab="reservations" data-active="<?php echo $data['tab'] === 'reservations' ? 'true' : 'false'; ?>">
          <div class="card">
            <div class="card-header">
              <h2 class="card-title">Current Reservations</h2>
              <p class="card-description">View and manage all current table reservations.</p>
            </div>
            <div class="card-content">
              <div class="date-selector">
                <form method="GET" action="">
                  <input type="hidden" name="tab" value="reservations">
                  <label for="reservations-date">Date:</label>
                  <input type="date" id="reservations-date" name="date" value="<?php echo htmlspecialchars($data['selectedDate']); ?>">
                  <button type="submit" class="btn btn-primary">Update Date</button>
                </form>
              </div>
              <div class="reservation-list">
                <?php if (empty($data['reservations'])): ?>
                  <div class="empty-state">
                    <p>No reservations for <?php echo htmlspecialchars(date('D, M d, Y', strtotime($data['selectedDate']))); ?></p>
                  </div>
                <?php else: ?>
                  <?php
                    usort($data['reservations'], function($a, $b) {
                        return strcmp($a->start_time, $b->start_time);
                    });
                  ?>
                  <?php foreach ($data['reservations'] as $reservation): ?>
                    <div class="reservation-item">
                      <div class="reservation-header">
                        <span class="reservation-table">Table #<?php echo htmlspecialchars($reservation->table_number); ?> (<?php echo htmlspecialchars($reservation->table_location); ?>)</span>
                        <div class="time-slot-actions">
                          <form method="POST" action="">
                            <input type="hidden" name="edit_reservation" value="1">
                            <input type="hidden" name="reservation_id" value="<?php echo htmlspecialchars($reservation->id); ?>">
                            <input type="hidden" name="table_id" value="<?php echo htmlspecialchars($reservation->table_id); ?>">
                            <input type="hidden" name="tab" value="reservations">
                            <input type="hidden" name="date" value="<?php echo htmlspecialchars($data['selectedDate']); ?>">
                            <button type="submit" class="btn btn-outline edit-reservation-btn">
                              <svg class="icon" viewBox="0 0 24 24">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                              </svg>
                            </button>
                          </form>
                          <form method="POST" action="">
                            <input type="hidden" name="cancel_reservation" value="1">
                            <input type="hidden" name="reservation_id" value="<?php echo htmlspecialchars($reservation->id); ?>">
                            <input type="hidden" name="tab" value="reservations">
                            <input type="hidden" name="date" value="<?php echo htmlspecialchars($data['selectedDate']); ?>">
                            <button type="submit" class="btn btn-outline cancel-reservation-btn" onclick="return confirm('Are you sure you want to cancel this reservation?')">
                              <svg class="icon" viewBox="0 0 24 24">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                              </svg>
                            </button>
                          </form>
                        </div>
                      </div>
                      <div class="reservation-details">
                        <div class="reservation-detail">
                          <svg class="icon reservation-detail-icon" viewBox="0 0 24 24">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                          </svg>
                          <span><?php echo htmlspecialchars($reservation->customer_name); ?></span>
                        </div>
                        <div class="reservation-detail">
                          <svg class="icon reservation-detail-icon" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                          </svg>
                          <span>
                            <?php
                              $start = DateTime::createFromFormat('H:i:s', $reservation->start_time);
                              $end = DateTime::createFromFormat('H:i:s', $reservation->end_time);
                              echo $start->format('h:i A') . ' - ' . $end->format('h:i A');
                            ?>
                          </span>
                        </div>
                        <?php if (!empty($reservation->notes)): ?>
                          <div class="reservation-detail">
                            <svg class="icon reservation-detail-icon" viewBox="0 0 24 24">
                              <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                              <polyline points="14 2 14 8 20 8"></polyline>
                              <line x1="16" y1="13" x2="8" y2="13"></line>
                              <line x1="16" y1="17" x2="8" y2="17"></line>
                              <polyline points="10 9 9 9 8 9"></polyline>
                            </svg>
                            <span><?php echo htmlspecialchars($reservation->notes); ?></span>
                          </div>
                        <?php endif; ?>
                      </div>
                    </div>
                  <?php endforeach; ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Add Reservation Popup Form -->
        <?php if (isset($data['add_reservation_form'])): ?>
          <div class="modal-backdrop">
            <div class="modal">
              <div class="modal-header">
                <h2 class="modal-title">Reserve Table #<?php echo htmlspecialchars($data['add_reservation_form']['table_number']); ?></h2>
                <p class="modal-description">Enter the customer details to reserve this table.</p>
              </div>
              <div class="modal-body">
                <form method="POST" action="">
                  <input type="hidden" name="add_reservation" value="1">
                  <input type="hidden" name="table_id" value="<?php echo htmlspecialchars($data['add_reservation_form']['table_id']); ?>">
                  <input type="hidden" name="tab" value="<?php echo htmlspecialchars($data['tab']); ?>">
                  <input type="hidden" name="date" value="<?php echo htmlspecialchars($data['selectedDate']); ?>">
                  <div class="form-grid">
                    <div class="form-group">
                      <label for="add-customer-name">
                        <svg class="icon" viewBox="0 0 24 24">
                          <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                          <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        Customer Name
                      </label>
                      <input id="add-customer-name" name="customer_name" type="text" placeholder="Enter customer name" value="<?php echo htmlspecialchars($_POST['customer_name'] ?? ''); ?>">
                      <?php if (isset($data['errors']['reservation']['customer_name'])): ?>
                        <div class="error-message"><?php echo htmlspecialchars($data['errors']['reservation']['customer_name']); ?></div>
                      <?php endif; ?>
                    </div>
                    <div class="form-grid form-grid-2">
                      <div class="form-group">
                        <label for="add-start-time">
                          <svg class="icon" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                          </svg>
                          Start Time
                        </label>
                        <input id="add-start-time" name="start_time" type="time" value="<?php echo htmlspecialchars($_POST['start_time'] ?? ''); ?>">
                        <?php if (isset($data['errors']['reservation']['start_time'])): ?>
                          <div class="error-message"><?php echo htmlspecialchars($data['errors']['reservation']['start_time']); ?></div>
                        <?php endif; ?>
                      </div>
                      <div class="form-group">
                        <label for="add-end-time">
                          <svg class="icon" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                          </svg>
                          End Time
                        </label>
                        <input id="add-end-time" name="end_time" type="time" value="<?php echo htmlspecialchars($_POST['end_time'] ?? ''); ?>">
                        <?php if (isset($data['errors']['reservation']['end_time'])): ?>
                          <div class="error-message"><?php echo htmlspecialchars($data['errors']['reservation']['end_time']); ?></div>
                        <?php endif; ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="add-notes">
                        <svg class="icon" viewBox="0 0 24 24">
                          <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                          <line x1="16" y1="2" x2="16" y2="6"></line>
                          <line x1="8" y1="2" x2="8" y2="6"></line>
                          <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        Notes
                      </label>
                      <textarea id="add-notes" name="notes" placeholder="Any special requests or notes" rows="3"><?php echo htmlspecialchars($_POST['notes'] ?? ''); ?></textarea>
                      <?php if (isset($data['errors']['reservation']['notes'])): ?>
                        <div class="error-message"><?php echo htmlspecialchars($data['errors']['reservation']['notes']); ?></div>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <a href="?tab=<?php echo htmlspecialchars($data['tab']); ?>&date=<?php echo htmlspecialchars($data['selectedDate']); ?>" class="btn btn-outline">Cancel</a>
                    <button type="submit" class="btn btn-primary">Reserve Table</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        <?php endif; ?>
        
        <!-- Update Table Popup Form -->
        <?php if (isset($data['update_table_form'])): ?>
          <div class="modal-backdrop">
            <div class="modal">
              <div class="modal-header">
                <h2 class="modal-title">Update Table #<?php echo htmlspecialchars($data['update_table_form']['number']); ?></h2>
                <p class="modal-description">Modify the table details.</p>
              </div>
              <div class="modal-body">
                <form method="POST" action="">
                  <input type="hidden" name="update_table" value="1">
                  <input type="hidden" name="table_id" value="<?php echo htmlspecialchars($data['update_table_form']['id']); ?>">
                  <input type="hidden" name="tab" value="<?php echo htmlspecialchars($data['tab']); ?>">
                  <input type="hidden" name="date" value="<?php echo htmlspecialchars($data['selectedDate']); ?>">
                  <div class="form-grid form-grid-3">
                    <div class="form-group">
                      <label for="update-table-number">Table Number</label>
                      <input id="update-table-number" name="number" type="number" placeholder="Enter table number" value="<?php echo htmlspecialchars($_POST['number'] ?? $data['update_table_form']['number']); ?>">
                      <?php if (isset($data['errors']['table']['number'])): ?>
                        <div class="error-message"><?php echo htmlspecialchars($data['errors']['table']['number']); ?></div>
                      <?php endif; ?>
                    </div>
                    <div class="form-group">
                      <label for="update-capacity">Capacity</label>
                      <input id="update-capacity" name="capacity" type="number" placeholder="Enter capacity" value="<?php echo htmlspecialchars($_POST['capacity'] ?? $data['update_table_form']['capacity']); ?>">
                      <?php if (isset($data['errors']['table']['capacity'])): ?>
                        <div class="error-message"><?php echo htmlspecialchars($data['errors']['table']['capacity']); ?></div>
                      <?php endif; ?>
                    </div>
                    <div class="form-group">
                      <label for="update-location">Location</label>
                      <select id="update-location" name="location">
                        <option value="" disabled>Select location</option>
                        <option value="Indoor" <?php echo ($_POST['location'] ?? $data['update_table_form']['location']) === 'Indoor' ? 'selected' : ''; ?>>Indoor</option>
                        <option value="Outdoor" <?php echo ($_POST['location'] ?? $data['update_table_form']['location']) === 'Outdoor' ? 'selected' : ''; ?>>Outdoor</option>
                        <option value="VIP" <?php echo ($_POST['location'] ?? $data['update_table_form']['location']) === 'VIP' ? 'selected' : ''; ?>>VIP</option>
                      </select>
                      <?php if (isset($data['errors']['table']['location'])): ?>
                        <div class="error-message"><?php echo htmlspecialchars($data['errors']['table']['location']); ?></div>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <a href="?tab=<?php echo htmlspecialchars($data['tab']); ?>&date=<?php echo htmlspecialchars($data['selectedDate']); ?>" class="btn btn-outline">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Table</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        <?php endif; ?>
        
        <!-- Edit Reservation Popup Form -->
        <?php if (isset($data['edit_reservation'])): ?>
          <div class="modal-backdrop">
            <div class="modal">
              <div class="modal-header">
                <h2 class="modal-title">Edit Reservation for Table #<?php echo htmlspecialchars($data['edit_reservation']['table_number']); ?></h2>
                <p class="modal-description">Update the reservation details.</p>
              </div>
              <div class="modal-body">
                <form method="POST" action="">
                  <input type="hidden" name="update_reservation" value="1">
                  <input type="hidden" name="reservation_id" value="<?php echo htmlspecialchars($data['edit_reservation']['id']); ?>">
                  <input type="hidden" name="table_id" value="<?php echo htmlspecialchars($data['edit_reservation']['table_id']); ?>">
                  <input type="hidden" name="tab" value="<?php echo htmlspecialchars($data['tab']); ?>">
                  <input type="hidden" name="date" value="<?php echo htmlspecialchars($data['selectedDate']); ?>">
                  <div class="form-grid">
                    <div class="form-group">
                      <label for="edit-customer-name">
                        <svg class="icon" viewBox="0 0 24 24">
                          <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                          <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        Customer Name
                      </label>
                      <input id="edit-customer-name" name="customer_name" type="text" placeholder="Enter customer name" value="<?php echo htmlspecialchars($data['edit_reservation']['customer_name']); ?>">
                      <?php if (isset($data['errors']['reservation']['customer_name'])): ?>
                        <div class="error-message"><?php echo htmlspecialchars($data['errors']['reservation']['customer_name']); ?></div>
                      <?php endif; ?>
                    </div>
                    <div class="form-grid form-grid-2">
                      <div class="form-group">
                        <label for="edit-start-time">
                          <svg class="icon" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                          </svg>
                          Start Time
                        </label>
                        <input id="edit-start-time" name="start_time" type="time" value="<?php echo htmlspecialchars($data['edit_reservation']['start_time']); ?>">
                        <?php if (isset($data['errors']['reservation']['start_time'])): ?>
                          <div class="error-message"><?php echo htmlspecialchars($data['errors']['reservation']['start_time']); ?></div>
                        <?php endif; ?>
                      </div>
                      <div class="form-group">
                        <label for="edit-end-time">
                          <svg class="icon" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                          </svg>
                          End Time
                        </label>
                        <input id="edit-end-time" name="end_time" type="time" value="<?php echo htmlspecialchars($data['edit_reservation']['end_time']); ?>">
                        <?php if (isset($data['errors']['reservation']['end_time'])): ?>
                          <div class="error-message"><?php echo htmlspecialchars($data['errors']['reservation']['end_time']); ?></div>
                        <?php endif; ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="edit-notes">
                        <svg class="icon" viewBox="0 0 24 24">
                          <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                          <line x1="16" y1="2" x2="16" y2="6"></line>
                          <line x1="8" y1="2" x2="8" y2="6"></line>
                          <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        Notes
                      </label>
                      <textarea id="edit-notes" name="notes" placeholder="Any special requests or notes" rows="3"><?php echo htmlspecialchars($data['edit_reservation']['notes'] ?? ''); ?></textarea>
                      <?php if (isset($data['errors']['reservation']['notes'])): ?>
                        <div class="error-message"><?php echo htmlspecialchars($data['errors']['reservation']['notes']); ?></div>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <a href="?tab=<?php echo htmlspecialchars($data['tab']); ?>&date=<?php echo htmlspecialchars($data['selectedDate']); ?>" class="btn btn-outline">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Reservation</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </main>
  </div>
</body>
</html>