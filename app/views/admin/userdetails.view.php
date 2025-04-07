<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Details</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/admin.css?v=1.0">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/d11f03c652.js" crossorigin="anonymous"></script>
    <style>
        /* Add specific styles for the popup */
        body {
            font-family: 'Poppins', sans-serif;
            background: transparent;
            margin: 0;
            padding: 20px;
        }
        .user-detail-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        /* Add the rest of your styles here */
    </style>
</head>
<body>
    <div class="user-detail-container">
        <!-- User details content will go here -->
        <div class="user-header">
            <div class="user-avatar"><i class="fas fa-user-circle"></i></div>
            <div>
                <div class="user-name"><?= $data['user']->fName ?? $data['user']->firstName ?? $data['user']->hotelName ?? $data['user']->company_Name ?? 'User' ?></div>
                <div class="user-role"><?= $data['userType'] ?></div>
            </div>
        </div>
        
        <div class="detail-section">
            <div class="section-title">Account Information</div>
            
            <div class="detail-row">
                <div class="detail-label">User ID:</div>
                <div class="detail-value"><?= $data['user']->traveler_Id ?? $data['user']->guide_Id ?? $data['user']->hotel_Id ?? $data['user']->organizer_Id ?? 'N/A' ?></div>
            </div>
            
            <div class="detail-row">
                <div class="detail-label">Email:</div>
                <div class="detail-value"><?= $data['user']->travelerEmail ?? $data['user']->email ?? $data['user']->hotelEmail ?? $data['user']->company_Email ?? 'N/A' ?></div>
            </div>
            
            <div class="detail-row">
                <div class="detail-label">Status:</div>
                <div class="detail-value">
                    <span class="status-badge <?= $data['user']->status === 'enabled' ? 'status-active' : 'status-disabled' ?>">
                        <?= ucfirst($data['user']->status) ?>
                    </span>
                </div>
            </div>
        </div>
        
        <!-- You can add more sections based on user type -->
        
        <div class="action-buttons">
            <button class="btn btn-edit" id="editButton">Edit</button>
            <button class="btn <?= $data['user']->status === 'enabled' ? 'btn-disable' : 'btn-enable' ?>" 
                    id="statusToggleButton" 
                    onclick="toggleUserStatus('<?= $data['user']->traveler_Id ?? $data['user']->guide_Id ?? $data['user']->hotel_Id ?? $data['user']->organizer_Id ?>', 
                                               '<?= $data['userType'] ?>')">
                <?= $data['user']->status === 'enabled' ? 'Disable' : 'Enable' ?>
            </button>
            <button class="btn btn-close" id="closeButton" onclick="window.parent.closeUserDetailModal()">Close</button>
        </div>
    </div>

    <script>
        function toggleUserStatus(userId, userType) {
            const currentStatus = '<?= $data['user']->status ?>';
            const role = getRoleParam(userType);
            
            if(currentStatus === 'enabled') {
                if(window.parent.disableUser) {
                    window.parent.disableUser(userId, currentStatus, role);
                }
            } else {
                if(window.parent.enableUser) {
                    window.parent.enableUser(userId, currentStatus, role);
                }
            }
        }
        
        function getRoleParam(userType) {
            switch(userType) {
                case 'traveler': return 'traveler';
                case 'guide': return 'guide';  
                case 'hotel': return 'hotel';
                case 'organizer': return 'eventOrganizer';
                default: return '';
            }
        }
    </script>
</body>
</html>