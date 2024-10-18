<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Financial Report</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('room.jpg'); /* Replace with your image path */
            background-size: cover; /* Cover the entire viewport */
            background-repeat: no-repeat; /* Prevent tiling */
            margin: 0;
        }
        .card {
            margin-top: 20px;
            background-color: white; /* Set card color to white */
        }

        /* Table styling */
        table th, table td {
            vertical-align: middle;
        }

        .table thead th {
            text-align: center;
            background-color: #007bff; /* Header color */
            color: white; /* Header text color */
        }

        .table tbody td {
            text-align: center;
        }

        .btn-sm {
            padding: 5px 10px;
            font-size: 0.875em;
        }

        /* Print-specific styling */
        @media print {
            body * {
                visibility: hidden; /* Hide everything except the table */
            }
            #reportTable, #reportTable * {
                visibility: visible;
            }
            #reportTable {
                position: absolute;
                left: 200;
                margin: auto;
                width: 150%; /* Make the table take up full width */
                max-width: 100%;
                font-size: 1.2em; /* Increase font size for printing */
            }
            #reportTable th:last-child, #reportTable td:last-child {
                display: none; /* Hide the Action column during print */
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <b>Financial Report</b>
                <span class="float-right">
                    <a class="btn btn-primary btn-sm" href="javascript:void(0)" id="new_report" data-bs-toggle="modal" data-bs-target="#addReportModal">
                        <i class="fa fa-plus"></i> Add Report
                    </a>
                    <button class="btn btn-secondary btn-sm" onclick="printReport()">
                        <i class="fa fa-print"></i> Print Report
                    </button>
                </span>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover" id="reportTable">
                <?php 
include './database/connection.php';

// Update the query to join the tenants table to get tenant names
$sql = "SELECT `report_id`, CONCAT(`tenant_first_name`, ' ', `tenant_last_name`) AS tenant_name, 
        `amount_paid`,`payment_status`,`report_date`
        FROM `financial_reports`
        JOIN `tenants` ON tenant_id = TenantID";

$result = $conn->query($sql);
?>
<thead>
    <tr>
        <th>ID</th>
        <th>Tenant Name</th>
        <th>Amount Paid</th>
        <th>Payment Status</th>
        <th>Date</th>
        <th class="text-center">Action</th>
    </tr>
</thead>
<tbody>
    <!-- Sample Financial Report Row -->
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['report_id']; ?></td> 
        <td><?php echo $row['tenant_name']; ?></td>
        <td><?php echo $row['amount_paid']; ?></td>
        <td><?php echo $row['payment_status']; ?></td>
        <td><?php echo $row['report_date']; ?></td>                  
        <td class="text-center">
            <form action="" method="POST" style="display:inline;">
                <input type="hidden" name="report_id" value="<?php echo htmlspecialchars($row['report_id']); ?>">
                <button type="submit" name="btn_delete" class="btn btn-sm btn-outline-danger">Delete</button>
            </form>
        </td>
    </tr>
    <?php endwhile; ?>
</tbody>

                </table>
            </div>
        </div>
    </div>

    <!-- Add Financial Report Modal -->
    <div class="modal fade" id="addReportModal" tabindex="-1" aria-labelledby="addReportModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addReportModalLabel">Add Financial Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="reportForm">
                    <div class="mb-3">
    <label for="tenantName" class="form-label">Tenant</label>
    <select class="form-select" name="tenantName" id="tenantName" required>
        <option value="">Select a Tenant</option>
        <?php
        // Fetch tenant names from the 'tenants' table
        $sql = "SELECT tenant_first_name, tenant_last_name FROM tenants";
        $result = $conn->query($sql);

        // Populate the dropdown with the tenant's full name
        while ($row = $result->fetch_assoc()) {
            $tenantFullName = htmlspecialchars($row['tenant_first_name'] . ' ' . $row['tenant_last_name']);
            echo "<option value='$tenantFullName'>$tenantFullName</option>";
        }
        ?>
    </select>
</div>


                        <div class="mb-3">
                            <label for="amountPaid" class="form-label">Amount Paid</label>
                            <input type="number" class="form-control" name="amountPaid" id="amountPaid" required>
                        </div>
                        <div class="mb-3">
                            <label for="paymentStatus" class="form-label">Payment Status</label>
                            <select class="form-select" name="paymentStatus" id="paymentStatus" required>
                                <option value="Paid">Paid</option>
                                <option value="Unpaid">Unpaid</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="reportDate" class="form-label">Date</label>
                            <input type="date" class="form-control" name="reportDate" id="reportDate" required>
                        </div>
                        <button type="submit" name="btn_submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (Optional, for modal functionality) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function printReport() {
            window.print(); // Trigger the print dialog
        }
    </script>
</body>
</html>

<?php
   include './database/connection.php';

// Handle the addition of a financial report
if (isset($_POST['btn_submit'])) {
    // Directly capture the inputs
    $tenant_name = $_POST['tenantName']; // tenantName contains the full name (e.g., "John Doe")
    $amount_paid = $_POST['amountPaid'];
    $payment_status = $_POST['paymentStatus'];
    $report_date = $_POST['reportDate'];

    // Split the tenant's full name into first and last names
    $tenant_parts = explode(' ', $tenant_name);
    $tenant_first_name = $tenant_parts[0];
    $tenant_last_name = $tenant_parts[1];

    // Get the tenant_id from the tenants table
    $tenant_sql = "SELECT TenantID FROM tenants WHERE tenant_first_name = '$tenant_first_name' AND tenant_last_name = '$tenant_last_name'";
    $tenant_result = $conn->query($tenant_sql);

    if ($tenant_row = $tenant_result->fetch_assoc()) {
        $tenant_id = $tenant_row['TenantID'];

        // Prepare the SQL query to insert the new report
        $sql = "INSERT INTO `financial_reports`(`tenant_id`, `amount_paid`, `payment_status`, `report_date`) 
                VALUES ('$tenant_id', '$amount_paid', '$payment_status', '$report_date')";

        // Execute the query
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('New Payment added successfully')</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "<script>alert('Tenant not found!')</script>";
    }
}
?>
<?php
if (isset($_POST['btn_delete'])) {
    $report_id = $_POST['report_id'];

    $sql = "DELETE FROM `financial_reports` WHERE `report_id`='$report_id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Report deleted successfully')</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>