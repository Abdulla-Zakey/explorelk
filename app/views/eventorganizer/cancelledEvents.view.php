<?php
// $title defined for page title
$title = "EO - Cancelled Events";
include '../app/views/components/eonavbar.php';

// Helper function to format date
function formatDate($dateString)
{
    $date = new DateTime($dateString);
    return $date->format('l, F j, Y');
}

// Helper function to format time
function formatTime($timeString)
{
    $time = new DateTime($timeString);
    return $time->format('g:i A');
}

// Helper function to get status badge HTML
function getStatusBadge($status)
{
    switch ($status) {
        case 'pending':
            return '<span class="status-badge pending">Pending Review</span>';
        case 'approved':
            return '<span class="status-badge approved">Approved</span>';
        case 'rejected':
            return '<span class="status-badge rejected">Rejected</span>';
        default:
            return '<span class="status-badge">Unknown</span>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= CSS ?>/Eventorganizer/eoevents.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title><?= $title ?></title>

    <style>
        /* Primary Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .content-wrapper {
            margin-left: 18%;
            padding: 2rem;
        }

        /* Event Container Styles */
        .events-container {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 45, 64, 0.08);
            margin-bottom: 2rem;
            overflow: hidden;
        }

        .events-header {
            background: linear-gradient(135deg, #002D40 0%, #004d6e 100%);
            color: white;
            padding: 1.5rem 2rem;
        }

        /* Add this to your style block */
        .section-title {
            font-size: 1.4rem;
            color: #002D40;
            margin: 1rem 0;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e9ecef;
        }

        .events-header h2 {
            font-size: 1.8rem;
            margin: 0;
            display: flex;
            align-items: center;
            color: white;
        }

        .events-header h2 i {
            margin-right: 12px;
        }

        .events-header p {
            margin: 0.5rem 0 0;
            opacity: 0.9;
            font-size: 0.95rem;
        }

        /* Empty State Styles */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: #6c757d;
        }

        .empty-state i {
            color: #adb5bd;
            margin-bottom: 1rem;
        }

        .empty-state h3 {
            margin-bottom: 0.5rem;
            font-size: 1.4rem;
        }

        .empty-state p {
            margin-bottom: 1.5rem;
        }

        /* Cancellation Card Styles */
        .events-list {
            padding: 1.5rem;
        }

        .cancellation-card {
            background-color: #fff;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .cancellation-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .cancellation-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .cancellation-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #002D40;
            margin: 0;
        }

        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            text-align: center;
            display: inline-block;
        }

        .status-badge.pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-badge.approved {
            background-color: #d4edda;
            color: #155724;
        }

        .status-badge.rejected {
            background-color: #f8d7da;
            color: #721c24;
        }

        .cancellation-meta {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin: 1rem 0;
        }

        .meta-item {
            display: flex;
            align-items: center;
            font-size: 0.9rem;
            color: #555;
        }

        .meta-item i {
            margin-right: 8px;
            color: #002D40;
            width: 16px;
            text-align: center;
        }

        .cancellation-section {
            margin-top: 1.5rem;
            padding-top: 1rem;
            border-top: 1px solid #e9ecef;
        }

        .cancellation-section h4 {
            font-size: 1.1rem;
            color: #002D40;
            margin-bottom: 0.5rem;
        }

        .reason-box {
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 6px;
            padding: 1rem;
            margin-bottom: 1rem;
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .admin-notes {
            background-color: #e9f5ff;
            border: 1px solid #bee5eb;
            border-radius: 6px;
            padding: 1rem;
            margin-bottom: 1rem;
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .refund-status {
            background-color: #f8f9fa;
            border-radius: 6px;
            padding: 1rem;
            margin-top: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .refund-status i {
            font-size: 1.2rem;
        }

        .refund-status.processed {
            background-color: #d4edda;
            color: #155724;
        }

        .refund-status.pending {
            background-color: #fff3cd;
            color: #856404;
        }

        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .content-wrapper {
                margin-left: 0;
                padding: 1rem;
            }
        }

        @media (max-width: 768px) {
            .cancellation-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .cancellation-meta {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <?php
    // show($data['cancellationPendingEvents']);
    // exit();
    ?>
    <div class="content-wrapper">
        <!-- Cancelled Events Section -->
        <div class="events-container cancelled">
            <div class="events-header">
                <h2><i class="fas fa-ban"></i> Cancelled Events</h2>
                <p>Track your cancelled events</p>
            </div>

            <!-- In the events-list div of your cancelledEvents.view.php -->
            <div class="events-list">
                <?php if (
                    (isset($data['cancellationPendingEvents']) && !empty($data['cancellationPendingEvents'])) ||
                    (isset($data['cancelledEvents']) && !empty($data['cancelledEvents']))
                ): ?>

                    <?php if (isset($data['cancellationPendingEvents']) && !empty($data['cancellationPendingEvents'])): ?>
                        <h3 class="section-title">Pending Cancellations</h3>
                        <?php foreach ($data['cancellationPendingEvents'] as $cancellation): ?>
                            <div class="cancellation-card">
                                <!-- Card content as before -->
                                <div class="cancellation-header">
                                    <h3 class="cancellation-title"><?= $cancellation->eventName ?></h3>
                                    <span class="status-badge pending">Cancellation Pending</span>
                                </div>

                                <!-- Rest of the card details -->
                                <div class="cancellation-meta">
                                    <div class="meta-item">
                                        <i class="fas fa-calendar"></i>
                                        <span><?= formatDate($cancellation->eventDate) ?></span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-clock"></i>
                                        <span><?= formatTime($cancellation->eventStartTime) ?> -
                                            <?= formatTime($cancellation->eventEndTime) ?></span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-calendar-times"></i>
                                        <span>Cancellation requested:
                                            <?= formatDate($cancellation->cancellation_date ?? $cancellation->created_at) ?></span>
                                    </div>
                                </div>

                                <div class="cancellation-section">
                                    <h4>Cancellation Reason</h4>
                                    <div class="reason-box">
                                        <?= htmlspecialchars($cancellation->cancellation_reason ?? $cancellation->reason ?? 'No reason provided') ?>
                                    </div>
                                </div>

                                <div class="cancellation-section">
                                    <h4>Status</h4>
                                    <div class="admin-notes">
                                        <p>Your cancellation request is pending admin approval.</p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <?php if (isset($data['cancelledEvents']) && !empty($data['cancelledEvents'])): ?>
                        <h3 class="section-title">Cancelled Events</h3>
                        <?php foreach ($data['cancelledEvents'] as $cancellation): ?>
                            <div class="cancellation-card">
                                <div class="cancellation-header">
                                    <h3 class="cancellation-title"><?= $cancellation->eventName ?></h3>
                                    <span class="status-badge rejected">Cancelled</span>
                                </div>

                                <div class="cancellation-meta">
                                    <div class="meta-item">
                                        <i class="fas fa-calendar"></i>
                                        <span><?= formatDate($cancellation->eventDate) ?></span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-clock"></i>
                                        <span><?= formatTime($cancellation->eventStartTime) ?> -
                                            <?= formatTime($cancellation->eventEndTime) ?></span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-calendar-times"></i>
                                        <span>Cancelled on:
                                            <?= formatDate($cancellation->cancellation_date ?? $cancellation->created_at) ?></span>
                                    </div>
                                </div>

                                <div class="cancellation-section">
                                    <h4>Cancellation Reason</h4>
                                    <div class="reason-box">
                                        <?= htmlspecialchars($cancellation->cancellation_reason ?? $cancellation->reason ?? 'No reason provided') ?>
                                    </div>
                                </div>

                                <?php if (!empty($cancellation->admin_notes)): ?>
                                    <div class="cancellation-section">
                                        <h4>Admin Response</h4>
                                        <div class="admin-notes">
                                            <?= htmlspecialchars($cancellation->admin_notes) ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div class="cancellation-section">
                                    <h4>Refund Status</h4>
                                    <?php if (isset($cancellation->refund_processed) && $cancellation->refund_processed): ?>
                                        <div class="refund-status processed">
                                            <i class="fas fa-check-circle"></i>
                                            <span>Refunds have been processed for all ticket purchasers</span>
                                        </div>
                                    <?php else: ?>
                                        <div class="refund-status pending">
                                            <i class="fas fa-clock"></i>
                                            <span>Refunds are pending processing by admin</span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="fas fa-calendar-times fa-3x"></i>
                        <h3>No cancelled events</h3>
                        <p>You don't have any cancelled events at the moment</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>