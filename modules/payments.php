<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Payments</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('room.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            margin: 0;
        }
        .card {
            margin-top: 20px;
            background-color: white;
        }
      
        table th, table td {
            vertical-align: middle;
        }
        .table thead th {
            text-align: center;
            background-color: #007bff;
            color: white;
        }
        .table tbody td {
            text-align: center;
        }
        .btn-sm {
            padding: 5px 10px;
            font-size: 0.875em;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <b>List of Tenant Payments</b>
                <span class="float-end">
                    <a class="btn btn-primary btn-sm" href="javascript:void(0)" id="new_payment" data-bs-toggle="modal" data-bs-target="#addPaymentModal">
                        <i class="fa fa-plus"></i> Add Payment
                    </a>
                </span>
            </div>
            <div class="card-body">
            <?php 
    include './database/connection.php';

    // Corrected SQL query to get the required data
    $sql = "
        SELECT 
            p.payment_id, 
            CONCAT(t.tenant_first_name, ' ', t.tenant_last_name) AS tenant_name, 
            a.room_price, 
            p.payment_status 
        FROM 
            payments p
        JOIN 
            tenants t ON p.TenantID = t.TenantID 
        JOIN 
            addproperty a ON p.PropertyID = a.PropertyID
    ";

    // Execute the query and store the result
    $result = $conn->query($sql);

    // If the query returns valid results, display the table
    if ($result->num_rows > 0): 
?>
        <table class="table table-bordered table-hover" id="paymentTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tenant Name</th>
                    <th>To Pay</th>
                    <th>Payment Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['payment_id']; ?></td>
                        <td><?php echo $row['tenant_name']; ?></td>
                        <td><?php echo $row['room_price']; ?></td>
                        <td><?php echo $row['payment_status']; ?></td>
                        <td class="text-center">
                            <a class="btn btn-sm btn-outline-danger" href="#deletePropertyModal" data-bs-toggle="modal" onclick="document.getElementById('property_id').value = '<?php echo htmlspecialchars($row['payment_id']); ?>'">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
<?php 
    else: 
        echo "No payments found.";
    endif;

    $conn->close(); // Close the connection if necessary
?>

                    

            <div class="modal fade" id="addPaymentModal" tabindex="-1" aria-labelledby="addPaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPaymentModalLabel">Add Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="paymentForm">
                    <!-- Tenant Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Tenant Name</label>
                        <select class="form-control" name="name" id="name" required>
                            <option value="">Select tenant name</option>
                            <?php 
                            // Include your database connection file
                            include './database/connection.php';  // Adjust path as needed

                            // Query to fetch tenant details
                            $query = "SELECT TenantID, tenant_first_name, tenant_last_name FROM tenants";
                            $result = mysqli_query($conn, $query);

                            // Check if the query was successful
                            if ($result && mysqli_num_rows($result) > 0) {
                                // Loop through the results and create options
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $tenantID = $row['TenantID'];
                                    $tenantName = $row['tenant_first_name'] . ' ' . $row['tenant_last_name'];

                                    // Create an option for each tenant
                                    echo "<option value='$tenantID'>$tenantName</option>";
                                }
                            } else {
                                echo "<option value=''>No tenants found</option>";
                            }

                            // Close the database connection
                            mysqli_close($conn);
                            ?>
                        </select>
                    </div>

                    <!-- Room Payment -->
                    <div class="mb-3">
                        <label for="paymentAmount" class="form-label">Room Payment Amount</label>
                        <select class="form-select" name="paymentAmount" id="paymentAmount" required>
                            <option value="">Select Amount</option>
                            <?php 
                            // Reopen the database connection
                            include './database/connection.php';  // Adjust path as needed

                            // Query to fetch room prices
                            $query = "SELECT roomNumber, room_price FROM addproperty";
                            $result = mysqli_query($conn, $query);

                            // Check if the query was successful
                            if ($result && mysqli_num_rows($result) > 0) {
                                // Loop through the results and create options
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $roomPrice = $row['room_price'];
                                    $roomNumber = $row['roomNumber'];

                                    // Create an option for each room price
                                    echo "<option value='$roomPrice'>Room $roomNumber - Amount: $roomPrice</option>";
                                }
                            } else {
                                echo "<option value=''>No room prices found</option>";
                            }

                            // Close the database connection
                            mysqli_close($conn);
                            ?>
                        </select>
                    </div>

                    <!-- Payment Date -->
                    <div class="mb-3">
                        <label for="paymentDate" class="form-label">Payment Date</label>
                        <input type="date" class="form-control" name="paymentDate" id="paymentDate" required>
                    </div>

                    <!-- Payment Status -->
                    <div class="mb-3">
                        <label for="paymentStatus" class="form-label">Payment Status</label>
                        <select class="form-select" name="paymentStatus" id="paymentStatus" required>
                            <option value="Completed">Paid</option>
                            <option value="Pending">Pending</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" name="btn_submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

        </div>
    </div>
</body>
</html>

<?php 
include './database/connection.php';

?>
