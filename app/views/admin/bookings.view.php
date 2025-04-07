<!DOCTYPE html>
<html lang="en">

<head>
    <title>ExploreLK Admin</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/admin.css?v=1.0">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/d11f03c652.js" crossorigin="anonymous"></script>
    <script src="<?= ROOT ?>/assets/js/admin/admin.js?v=1.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="flexContainer">

        <?php include_once APPROOT.'\views\inc\adminNavBar.php'; ?>

        <div class="body-container">
            <?php include_once APPROOT.'\views\inc\profileLink.php'; ?>

            <div class="users">
                <h1 class="heading">Bookings</h1>

                <div class="search-bar">
                    <input type="text" id="searchInput" placeholder="Search User" class="search-input">
                    <button class="search-btn"><i class="fa fa-search"></i> Search</button>
                </div>

                <div class="filter-buttons">
                    <button class="filter-btn active" data-filter="all">All Bookings</button>
                    <button class="filter-btn" data-filter="guide">Tour Guides</button>
                    <button class="filter-btn" data-filter="traveller">Travellers</button>
                    <button class="filter-btn" data-filter="hotel">Hotels</button>
                    <button class="filter-btn" data-filter="organizer">Event Organizers</button>
                </div>

                <table class="booking-table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Booking ID</th>
                            <th>User Name</th>
                            <th>Booking Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-user-type="traveller">
                            <td><i class="fas fa-user-circle"></i></td>
                            <td>T 001</td>
                            <td>Pramin Jonson</td>
                            <td>2025-02-18</td>
                            <td>Confirmed</td>
                            <td>
                                <button class="detail-button view">Detail ></button>
                            </td>
                        </tr>
                        <tr data-user-type="guide">
                            <td><i class="fas fa-user-circle"></i></td>
                            <td>T 002</td>
                            <td>Nihmath Jabir</td>
                            <td>2025-02-17</td>
                            <td>Cancelled</td>
                            <td>
                                <button class="detail-button view">Detail ></button>
                            </td>
                        </tr>
                        <tr data-user-type="hotel">
                            <td><i class="fas fa-user-circle"></i></td>
                            <td>T 003</td>
                            <td>Abdulla Zakey</td>
                            <td>2025-02-16</td>
                            <td>Pending</td>
                            <td>
                                <button class="detail-button view">Detail ></button>
                            </td>
                        </tr>
                        <tr data-user-type="organizer">
                            <td><i class="fas fa-user-circle"></i></td>
                            <td>T 004</td>
                            <td>Thagshan Arulsivam</td>
                            <td>2025-02-15</td>
                            <td>Confirmed</td>
                            <td>
                                <button class="detail-button view">Detail ></button>
                            </td>
                        </tr>
                        <tr data-user-type="guide">
                            <td><i class="fas fa-user-circle"></i></td>
                            <td>T 005</td>
                            <td>Y. Sarma</td>
                            <td>2025-02-14</td>
                            <td>Pending</td>
                            <td>
                                <button class="detail-button view">Detail ></button>
                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Filter functionality
        const filterButtons = document.querySelectorAll('.filter-btn');
        const searchInput = document.getElementById('searchInput');

        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                filterButtons.forEach(btn => btn.classList.remove('active'));

                // Add active class to clicked button
                this.classList.add('active');

                // Get the filter value
                const filterValue = this.getAttribute('data-filter');
                filterTable(filterValue, searchInput.value);
            });
        });

        // Search functionality
        searchInput.addEventListener('input', function() {
            const activeFilter = document.querySelector('.filter-btn.active');
            const filterValue = activeFilter ? activeFilter.getAttribute('data-filter') : 'all';
            filterTable(filterValue, this.value);
        });

        // Enable/Disable button functionality
        const statusButtons = document.querySelectorAll('.detail-button.enable, .detail-button.disable');
        statusButtons.forEach(button => {
            button.addEventListener('click', function() {
                const currentStatus = this.getAttribute('data-status');
                if (currentStatus === 'active') {
                    this.textContent = 'Enable';
                    this.classList.remove('disable');
                    this.classList.add('enable');
                    this.setAttribute('data-status', 'disabled');
                } else {
                    this.textContent = 'Disable';
                    this.classList.remove('enable');
                    this.classList.add('disable');
                    this.setAttribute('data-status', 'active');
                }
            });
        });

        function filterTable(filterValue, searchText) {
            const tableRows = document.querySelectorAll('.booking-table tbody tr');
            const searchLower = searchText.toLowerCase();

            tableRows.forEach(row => {
                const userType = row.getAttribute('data-user-type');
                const text = row.textContent.toLowerCase();
                const matchesFilter = filterValue === 'all' || userType === filterValue;
                const matchesSearch = searchText === '' || text.includes(searchLower);

                row.style.display = matchesFilter && matchesSearch ? '' : 'none';
            });
        }
        const savedTab = localStorage.getItem('activeTab');
        if (savedTab) {
            const targetButton = document.querySelector(`.filter-btn[data-filter="${savedTab}"]`);
            if (targetButton) {
                targetButton.click(); // Trigger click to apply the filter
            }
        }
    });

    function disableUser(userId, currentStatus) {
        let action = 'disable';

        Swal.fire({
            title: `Are you sure you want to ${action} this user?`,
            text: `The user will be ${action}d.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: action === 'disable' ? '#d33' : '#3085d6',
            cancelButtonColor: '#6c757d',
            confirmButtonText: `Yes, ${action} it!`
        }).then((result) => {
            if (result.isConfirmed) {
                const activeTab = document.querySelector('.filter-btn.active').getAttribute('data-filter');
                window.location.href = `<?= ROOT ?>/admin/C_users/disableUser/${userId}?tab=${activeTab}`;
            }
        });
    }

    function enableUser(userId, currentStatus) {
        let action = 'enable';

        Swal.fire({
            title: `Are you sure you want to ${action} this user?`,
            text: `The user will be ${action}d.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#6c757d',
            confirmButtonText: `Yes, ${action} it!`
        }).then((result) => {
            if (result.isConfirmed) {
                const activeTab = document.querySelector('.filter-btn.active').getAttribute('data-filter');
                window.location.href = `<?= ROOT ?>/admin/C_users/enableUser/${userId}?tab=${activeTab}`;
            }
        });
    }
    </script>
</body>

</html>