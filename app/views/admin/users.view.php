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
    <style>

    </style>
</head>

<body>
    <div class="flexContainer">

        <?php include_once APPROOT.'\views\inc\adminNavBar.php'; ?>

        <div class="body-container">
            <?php include_once APPROOT.'\views\inc\profileLink.php'; ?>

            <div class="users">
                <h1 class="heading">Users</h1>

                <div class="search-bar">
                    <input type="text" id="searchInput" placeholder="Search User" class="search-input">
                    <button class="search-btn"><i class="fa fa-search"></i> Search</button>
                </div>

                <div class="filter-buttons">
                    <button class="filter-btn active" data-filter="all">All Users</button>
                    <button class="filter-btn" data-filter="guide">Tour Guides</button>
                    <button class="filter-btn" data-filter="traveller">Travellers</button>
                    <button class="filter-btn" data-filter="hotel">Hotels</button>
                    <button class="filter-btn" data-filter="organizer">Event Organizers</button>
                </div>

                <table class="booking-table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>User ID</th>
                            <th>Email</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <!-- Replace your current static table body with this dynamic one -->
                    <tbody>
                        <?php 
                    // Display travelers
                    if(!empty($data['travelers'])): 
                        foreach($data['travelers'] as $traveler): ?>
                        <tr data-user-type="traveller">
                            <td><i class="fas fa-user-circle"></i></td>
                            <td><?= htmlspecialchars($traveler->traveler_Id) ?></td>
                            <td><?= htmlspecialchars($traveler->travelerEmail) ?></td>
                            <td><?= htmlspecialchars($traveler->fName) . " " . htmlspecialchars($traveler->lName) ?></td>
                            <td>
                                <button class="detail-button view">Detail ></button>
                                <button onclick="<?= $traveler->status === 'enabled' ? 
                                    "disableUser('{$traveler->traveler_Id}', '{$traveler->status}', 'traveler')" : 
                                    "enableUser('{$traveler->traveler_Id}', '{$traveler->status}', 'traveler')"?>"
                                    class="detail-button <?= $traveler->status === 'enabled' ? 'disable' : 'enable' ?>"
                                    data-status="<?= htmlspecialchars($traveler->status) ?>">
                                    <?= $traveler->status === 'enabled' ? 'Disable' : 'Enable' ?>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach;
                    endif;

                    // show($data);

                    // Display tour guides
                    if(!empty($data['tourGuides'])): 
                        foreach($data['tourGuides'] as $guide): ?>
                        <tr data-user-type="guide">
                            <td><i class="fas fa-user-circle"></i></td>
                            <td><?= htmlspecialchars($guide->guide_Id) ?></td>
                            <td><?= htmlspecialchars($guide->email) ?></td>
                            <td><?= htmlspecialchars($guide->firstName) . " " . htmlspecialchars($guide->lastName) ?>
                            </td>
                            <td>
                                <button class="detail-button view">Detail ></button>
                                <button onclick="<?= $guide->status === 'enabled' ? 
                                    "disableUser('{$guide->guide_Id}', '{$guide->status}', 'guide')" : 
                                    "enableUser('{$guide->guide_Id}', '{$guide->status}', 'guide')"?>"
                                    class="detail-button <?= $guide->status === 'enabled' ? 'disable' : 'enable' ?>"
                                    data-status="<?= htmlspecialchars($guide->status) ?>">
                                    <?= $guide->status === 'enabled' ? 'Disable' : 'Enable' ?>
                                </button>

                            </td>
                        </tr>
                        <?php endforeach;
                    endif;

                    // Display Hotels
                    if(!empty($data['hotels'])): 
                        foreach($data['hotels'] as $hotel): ?>
                        <tr data-user-type="hotel">
                            <td><i class="fas fa-user-circle"></i></td>
                            <td><?= htmlspecialchars($hotel->hotel_Id) ?></td>
                            <td><?= htmlspecialchars($hotel->hotelEmail) ?></td>
                            <td><?= htmlspecialchars($hotel->hotelName) ?>
                            </td>
                            <td>
                                <button class="detail-button view">Detail ></button>
                                <button onclick="<?= $hotel->status === 'enabled' ? 
                                    "disableUser('{$hotel->hotel_Id}', '{$hotel->status}', 'hotel')" : 
                                    "enableUser('{$hotel->hotel_Id}', '{$hotel->status}', 'hotel')"?>"
                                    class="detail-button <?= $hotel->status === 'enabled' ? 'disable' : 'enable' ?>"
                                    data-status="<?= htmlspecialchars($hotel->status) ?>">
                                    <?= $hotel->status === 'enabled' ? 'Disable' : 'Enable' ?>
                                </button>

                            </td>
                        </tr>
                        <?php endforeach;
                    endif;

                    // Display Event Organizers
                    if(!empty($data['organizers'])): 
                        foreach($data['organizers'] as $organizer): ?>
                        <tr data-user-type="organizer">
                            <td><i class="fas fa-user-circle"></i></td>
                            <td><?= htmlspecialchars($organizer->organizer_Id) ?></td>
                            <td><?= htmlspecialchars($organizer->company_Email) ?></td>
                            <td><?= htmlspecialchars($organizer->company_Name) ?>
                            </td>
                            <td>
                                <button class="detail-button view">Detail ></button>
                                <button onclick="<?= $organizer->status === 'enabled' ? 
                                    "disableUser('{$organizer->organizer_Id}', '{$organizer->status}', 'eventOrganizer')" : 
                                    "enableUser('{$organizer->organizer_Id}', '{$organizer->status}', 'eventOrganizer')"?>"
                                    class="detail-button <?= $organizer->status === 'enabled' ? 'disable' : 'enable' ?>"
                                    data-status="<?= htmlspecialchars($organizer->status) ?>">
                                    <?= $organizer->status === 'enabled' ? 'Disable' : 'Enable' ?>
                                </button>

                            </td>
                        </tr>
                        <?php endforeach;
                    endif; ?>

                        <!-- Add similar loops for hotels and organizers when you have those models -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    

    <script>
    document.addEventListener('DOMContentLoaded', function () {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const searchInput = document.getElementById('searchInput');

    filterButtons.forEach(button => {
        button.addEventListener('click', function () {
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            const filterValue = this.getAttribute('data-filter');
            localStorage.setItem('activeTab', filterValue); // Save active tab
            filterTable(filterValue, searchInput.value);
        });
    });

    searchInput.addEventListener('input', function () {
        const activeFilter = document.querySelector('.filter-btn.active');
        const filterValue = activeFilter ? activeFilter.getAttribute('data-filter') : 'all';
        filterTable(filterValue, this.value);
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

    const savedTab = localStorage.getItem('activeTab') || 'all';
    const targetButton = document.querySelector(`.filter-btn[data-filter="${savedTab}"]`);
    if (targetButton) {
        targetButton.click();
    } else {
        document.querySelector('.filter-btn[data-filter="all"]').click();
    }
});

function disableUser(userId, currentStatus, role) {
    Swal.fire({
        title: `Are you sure you want to disable this user?`,
        text: `The user will be disabled.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: `Yes, disable it!`
    }).then((result) => {
        if (result.isConfirmed) {
            const activeTab = document.querySelector('.filter-btn.active').getAttribute('data-filter');
            window.location.href = `<?= ROOT ?>/admin/C_users/disableUser/${userId}/${role}?tab=${activeTab}`;
        }
    });
}

function enableUser(userId, currentStatus, role) {
    Swal.fire({
        title: `Are you sure you want to enable this user?`,
        text: `The user will be enabled.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#6c757d',
        confirmButtonText: `Yes, enable it!`
    }).then((result) => {
        if (result.isConfirmed) {
            const activeTab = document.querySelector('.filter-btn.active').getAttribute('data-filter');
            window.location.href = `<?= ROOT ?>/admin/C_users/enableUser/${userId}/${role}?tab=${activeTab}`;
        }
    });
}

    </script>
</body>

</html>