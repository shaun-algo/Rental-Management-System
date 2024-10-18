<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View list</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background-color: #f4f4f4;
        background-image: url('room.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        margin: 0;
    }
    .background-container {
        padding: 20px;
        border-radius: 8px;
        background-color: rgba(255, 255, 255, 0.8);
    }
    .summary_icon {
        font-size: 24px;
    }
    .list-container {
        margin-top: 10px;  /* Space above the scrollable area */
        max-height: 100000px; /* Set a maximum height for scrolling */
    }
</style>

</head>
<body>
    <div class="container mt-4">
        <div class="background-container">
            <div class="row">
                <?php 
                include './database/connection.php';

                // Query to count total rooms
                $roomCountSql = "SELECT COUNT(*) as total_rooms FROM `addproperty`";
                $roomCountResult = $conn->query($roomCountSql);
                $roomCount = $roomCountResult->fetch_assoc()['total_rooms'];

                // Query to count total tenants
                $tenantCountSql = "SELECT COUNT(*) as total_tenants FROM `tenants`";
                $tenantCountResult = $conn->query($tenantCountSql);
                $tenantCount = $tenantCountResult->fetch_assoc()['total_tenants'];

                $totalMoneySql = "SELECT SUM(amount_paid) as total_money FROM `financial_reports`";
                $totalMoneyResult = $conn->query($totalMoneySql);
                $total_money = $totalMoneyResult->fetch_assoc()['total_money'] ?? 0; // Default to 0 if NULL
                ?>
                
                <!-- Total Rooms Card -->
                <div class="col-md-4 mb-3">
                    <div class="card border-primary">
                        <div class="card-body bg-primary text-white">
                            <span class="float-end summary_icon"><i class="fa fa-home"></i></span>
                            <h4><b>Total Rooms:  <?php echo $roomCount; ?></b></h4>
                        </div>
                        <div class="card-footer">
                            <a href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#roomList" class="text-primary float-end">
                                View List <span class="fa fa-angle-right"></span>
                            </a>
                            <div id="roomList" class="collapse list-container">
                                <h5>Room List</h5>
                                <ul class="list-group">
                                    <?php 
                                    $sql= "SELECT `PropertyID`, `roomNumber`, `room_price`, `capacity`, `description` FROM `addproperty`";
                                    $result = $conn->query($sql);
                                    
                                    // Check if there are results and display room numbers
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()): ?>
                                            <li class="list-group-item">
                                                <?php echo 'Room: ' . htmlspecialchars($row['roomNumber']); ?>
                                                <span class="float-end">
                                                    <form action="" method="POST" style="display:inline;">
                                                        <input type="hidden" name="tenant_id" value="<?php echo htmlspecialchars($row['PropertyID']); ?>">
                                                    </form>
                                                </span>
                                            </li>
                                        <?php endwhile; 
                                    } else {
                                        echo '<li class="list-group-item">No rooms available.</li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Tenants Card -->
                <div class="col-md-4 mb-3">
                    <div class="card border-warning">
                        <div class="card-body bg-warning text-white">
                            <span class="float-end summary_icon"><i class="fa fa-user-friends"></i></span>
                            <h4><b>Total Tenants: <?php echo $tenantCount; ?></b></h4>
                        </div>
                        <div class="card-footer">
                            <a href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#tenantList" class="text-primary float-end">
                                View List <span class="fa fa-angle-right"></span>
                            </a>
                            <div id="tenantList" class="collapse list-container">
                                <h5>Tenant List</h5>
                                <ul class="list-group">
                                    <?php
                                    $sql = "SELECT tenant_first_name, tenant_last_name FROM tenants"; 
                                    $result = $conn->query($sql);

                                    // Check if the query was successful
                                    if ($result) {
                                        // Fetch and display each tenant's name in the list
                                        while ($row = $result->fetch_assoc()) {
                                            $fullName = htmlspecialchars($row['tenant_first_name'] . ' ' . $row['tenant_last_name']);
                                            echo "<li class='list-group-item'>{$fullName}</li>";
                                        }
                                    } else {
                                        echo "<li class='list-group-item'>No tenants found.</li>";
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payments This Month Card -->
                <div class="col-md-4 mb-3">
                    <div class="card border-success">
                        <div class="card-body bg-success text-white">
                            <span class="float-end summary_icon"><i class="fa fa-file-invoice"></i></span>
                            <h4><b>Financial report</b></h4>
                        </div>
                        <div class="card-footer">
                            <a href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#paymentList" class="text-primary float-end">
                                View reports <span class="fa fa-angle-right"></span>   
                            </a>
                            <div id="paymentList" class="collapse list-container active">
                                <h5>Financial report: <?php echo number_format($total_money, 2); ?></h5>
                                <ul class="list-group">
                                    <?php
                                    $sql = "SELECT `amount_paid`, `report_date` FROM `financial_reports`"; 
                                    $result = $conn->query($sql);

                                    if ($result) {
                                        // Fetch and display each payment in the list
                                        while ($row = $result->fetch_assoc()) {
                                            $reports = htmlspecialchars($row['amount_paid'] . ' ' . $row['report_date']);
                                            echo "<li class='list-group-item'>{$reports}</li>";
                                        }
                                    } else {
                                        echo "<li class='list-group-item'>No Payments found.</li>";
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (Optional, for icons and collapse) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
