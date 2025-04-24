<?php
    $unavailability = $data['unavailability'];
    $errors = $data['errors'];
    // show($unavailability);
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExploreLK Tour Guide</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/tourGuide/tourGuide.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/tourGuide/availability.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoWhite.svg">
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
    <style>
    .error {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 0.25rem;
        display: block;
        font-weight: 400;
        line-height: 1.4;
        animation: fadeIn 0.3s ease;
    }

    /* Delete Confirmation Modal */
    .delete-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .delete-modal .modal-content {
        background-color: white;
        padding: 2rem;
        border-radius: 0.5rem;
        width: 90%;
        max-width: 500px;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
    }

    .delete-modal h3 {
        color: #002D40;
        margin-top: 0;
        margin-bottom: 1rem;
    }

    .delete-modal p {
        margin-bottom: 1rem;
        color: #555;
    }

    .item-details {
        background-color: #f8f9fa;
        padding: 1rem;
        border-radius: 0.25rem;
        margin-bottom: 1.5rem;
    }

    .modal-actions {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
    }

    .modal-actions button {
        padding: 0.5rem 1rem;
        border-radius: 0.25rem;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .cancel-btn {
        background-color: #f0f0f0;
        border: 1px solid #ddd;
        color: #333;
    }

    .cancel-btn:hover {
        background-color: #e0e0e0;
    }

    .confirm-delete-btn {
        background-color: #dc3545;
        border: 1px solid #dc3545;
        color: white;
    }

    .confirm-delete-btn:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }

    /* Toast Message */
    .toast-message {
        position: fixed;
        bottom: 2rem;
        left: 50%;
        transform: translateX(-50%);
        background-color: #28a745;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 0.25rem;
        box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
        animation: slideIn 0.3s ease;
    }

    .toast-message.fade-out {
        animation: fadeOut 0.3s ease;
    }

    @keyframes slideIn {
        from {
            bottom: 0;
            opacity: 0;
        }

        to {
            bottom: 2rem;
            opacity: 1;
        }
    }

    @keyframes fadeOut {
        from {
            opacity: 1;
        }

        to {
            opacity: 0;
        }
    }
    </style>
</head>

<body>
    <div class="flexContainer">

        <?php include_once APPROOT . '\views\inc\tourGuideNavBar.php'; ?>

        <div class="body-container">
            <div class="page-header">
                <h1>Manage Your Availability</h1>
                <p class="subtitle">Set your unavailable periods to prevent bookings during those times</p>
            </div>

            <div class="content-wrapper">
                <!-- Form Card -->
                <div class="form-card">
                    <h2 class="card-title">
                        <i class="fas fa-calendar-times"></i> Set Unavailable Period
                    </h2>
                    <form class="form-fields" method="POST" action="<?= ROOT ?>/tourGuide/C_availability">
                        <div class="form-group">
                            <label for="from-date">From Date</label>
                            <div class="error"><?php if(isset($errors['start_date'])) echo $errors['start_date']; ?>
                            </div>
                            <div class="input-with-icon">
                                <i class="fas fa-calendar-day"></i>
                                <input type="date" id="from-date" name="start_date" placeholder="Select start date">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="to-date">To Date</label>
                            <div class="error"><?php if(isset($errors['end_date'])) echo $errors['end_date']; ?></div>
                            <div class="input-with-icon">
                                <i class="fas fa-calendar-day"></i>
                                <input type="date" id="to-date" name="end_date" placeholder="Select end date">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="reason">Reason</label>
                            <div class="error"><?php if(isset($errors['reason'])) echo $errors['reason']; ?></div>
                            <div class="input-with-icon">
                                <i class="fas fa-comment-alt"></i>
                                <input type="text" id="reason" name="reason" placeholder="E.g. Vacation, Personal days">
                            </div>
                        </div>

                        <button type="submit" class="add-period-btn">
                            <i class="fas fa-plus-circle"></i> Add Unavailable Period
                        </button>
                    </form>
                </div>

                <!-- Calendar Card -->
                <div class="calendar-card">
                    <div class="calendar-header">
                        <button class="calendar-nav-btn" title="Previous month">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <h3>December 2024</h3>
                        <button class="calendar-nav-btn" title="Next month">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                    <table class="calendar-table">
                        <thead>
                            <tr>
                                <th>Sun</th>
                                <th>Mon</th>
                                <th>Tue</th>
                                <th>Wed</th>
                                <th>Thu</th>
                                <th>Fri</th>
                                <th>Sat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="empty-day"></td>
                                <td class="empty-day"></td>
                                <td class="empty-day"></td>
                                <td class="empty-day"></td>
                                <td>6</td>
                                <td>7</td>
                                <td>8</td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>10</td>
                                <td>11</td>
                                <td>12</td>
                                <td>13</td>
                                <td>14</td>
                                <td>15</td>
                            </tr>
                            <tr>
                                <td>16</td>
                                <td>17</td>
                                <td>18</td>
                                <td>19</td>
                                <td>20</td>
                                <td>21</td>
                                <td>22</td>
                            </tr>
                            <tr>
                                <td>23</td>
                                <td>24</td>
                                <td>25</td>
                                <td class="highlight">26</td>
                                <td>27</td>
                                <td>28</td>
                                <td>29</td>
                            </tr>
                            <tr>
                                <td>30</td>
                                <td class="empty-day"></td>
                                <td class="empty-day"></td>
                                <td class="empty-day"></td>
                                <td class="empty-day"></td>
                                <td class="empty-day"></td>
                                <td class="empty-day"></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="calendar-legend">
                        <div class="legend-item">
                            <span class="legend-color highlight"></span>
                            <span>Unavailable</span>
                        </div>
                        <div class="legend-item">
                            <span class="legend-color booked"></span>
                            <span>Booked</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Unavailability Section -->
            <div class="unavailability-section">
                <div class="section-header">
                    <h2 class="sub-heading">
                        <i class="fas fa-list-alt"></i> Your Unavailability Periods
                    </h2>
                </div>
                <div class="table-container">
                    <table class="unavailability-table">
                        <thead>
                            <tr>
                                <th>Reason</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Duration</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($unavailability) : ?>
                            <?php foreach($unavailability as $unavailability_item): ?>
                            <tr data-unavailability_id="<?= $unavailability_item->unavailability_id ?>">
                                <td><?= $unavailability_item->reason ?></td>
                                <td><?= $unavailability_item->start_date ?></td>
                                <td><?= $unavailability_item->end_date ?></td>
                                <td><?php
                                    $start = new DateTime($unavailability_item->start_date);
                                    $end = new DateTime($unavailability_item->end_date);
                                    echo $start->diff($end)->days;
                                ?> day</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="edit-btn" title="Edit period">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="delete-btn" title="Delete period">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else : ?>
                                <p>No unavailability periods found.</p>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle all delete buttons
        const deleteButtons = document.querySelectorAll('.delete-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                // Find the closest table row to get item details
                const row = this.closest('tr');
                const dates = row.querySelectorAll('td:nth-child(2), td:nth-child(3)');
                const fromDate = dates[0].textContent;
                const toDate = dates[1].textContent;
                const reason = row.querySelector('td:first-child').textContent;

                // Create confirmation modal
                const modal = document.createElement('div');
                modal.className = 'delete-modal';
                modal.innerHTML = `
                <div class="modal-content">
                    <h3>Confirm Deletion</h3>
                    <p>Are you sure you want to delete this unavailability period?</p>
                    <div class="item-details">
                        <p><strong>Reason:</strong> ${reason}</p>
                        <p><strong>From:</strong> ${fromDate} <strong>To:</strong> ${toDate}</p>
                    </div>
                    <div class="modal-actions">
                        <button class="cancel-btn">Cancel</button>
                        <button class="confirm-delete-btn">Delete</button>
                    </div>
                </div>
            `;

                document.body.appendChild(modal);

                // Handle modal actions
                modal.querySelector('.cancel-btn').addEventListener('click', () => {
                    document.body.removeChild(modal);
                });

                modal.querySelector('.confirm-delete-btn').addEventListener('click', async () => {
    const unavailabilityId = row.dataset.unavailability_id;
    
    try {
        const formData = new FormData();
        formData.append('id', unavailabilityId);
        
        const response = await fetch(
            `<?= ROOT ?>/tourGuide/C_availability/delete`, {
                method: 'POST',
                body: formData
            });

        const result = await response.json();
        
        if (!response.ok) {
            throw new Error(result.error || 'Failed to delete');
        }

        row.remove();
        showToast('Unavailability period deleted successfully');
    } catch (error) {
        showToast('Error deleting unavailability: ' + error.message, true);
    } finally {
        document.body.removeChild(modal);
    }
});

                // Close modal when clicking outside
                modal.addEventListener('click', (e) => {
                    if (e.target === modal) {
                        document.body.removeChild(modal);
                    }
                });
            });
        });

        // Helper function to show toast messages
        function showToast(message) {
            const toast = document.createElement('div');
            toast.className = 'toast-message';
            toast.textContent = message;
            document.body.appendChild(toast);

            setTimeout(() => {
                toast.classList.add('fade-out');
                setTimeout(() => {
                    document.body.removeChild(toast);
                }, 300);
            }, 3000);
        }
    });
    </script>
</body>

</html>