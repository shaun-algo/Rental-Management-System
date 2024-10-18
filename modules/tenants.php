<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Information</title>
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
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <b>Tenant Table</b>
                <span class="float-right">
                    <a class="btn btn-sm btn-outline-primary" href="#viewTenantModal" data-bs-toggle="modal" data-id="<?php echo htmlspecialchars($row['TenantID']); ?>">View Tenant Data</a>
                    <a class="btn btn-primary btn-sm" href="javascript:void(0)" id="new_room" data-bs-toggle="modal" data-bs-target="#addRoomModal">
                        <i class="fa fa-plus"></i> Add Tenant
                    </a>

                </span>
            </div>
            <div class="card-body">
            <?php 
            include './database/connection.php';

            $sql= "SELECT `TenantID`, `tenant_first_name`, `tenant_last_name`,`roomNumber`, `phoneNumber` FROM `tenants`";
            $result = $conn->query($sql);
            ?>
                <table class="table table-bordered table-hover" id="roomTable">
                <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tenant</th>
                            <th>Room Number</th>
                            <th>Contact</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['TenantID']); ?></td>
                            <td><?php echo htmlspecialchars($row['tenant_first_name'] . ' ' . $row['tenant_last_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['roomNumber']); ?></td>
                            <td><?php echo htmlspecialchars($row['phoneNumber']); ?></td>
                         
                            <td class="text-center">
                            <a class="btn btn-sm btn-outline-primary" href="#editTenantModal?page=edit&id=<?php echo htmlspecialchars($row['TenantID']); ?>">Edit</a>

                            <a class="btn btn-sm btn-outline-danger" href="#deleteTenantModal" data-bs-toggle="modal" onclick="document.getElementById('tenant_id').value = '<?php echo htmlspecialchars($row['TenantID']); ?>'">Delete</a>                           
                           </td>
                        </tr>
                        <?php endwhile;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php 
    if (isset($_GET['page'])){
        $page=$_GET['page'];
        switch($page){
            case 'edit':
                include 'edit.php';
                break;

        }
    }else{
        include './modules/tenants.php';
    }
    ?>

   
    <div class="modal fade" id="addRoomModal" tabindex="-1" aria-labelledby="addRoomModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRoomModalLabel">Add Tenant</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="roomForm">
                    <div class="mb-3">
                        <label for="roomSelect" class="form-label">Room Number</label>
                        <select class="form-control" name="roomNumber" id="roomSelect" required>
                            <option value="">Select a Room Number</option>
                            <?php 
                                $sql = "SELECT PropertyID, roomNumber FROM addproperty"; 
                                if ($result = $conn->query($sql)) {
                                    while ($row = $result->fetch_assoc()):
                            ?>
                            <option value="<?php echo htmlspecialchars($row['roomNumber']); ?>">
                                <?php echo htmlspecialchars($row['roomNumber']); ?>
                            </option>
                            <?php 
                                    endwhile; 
                                    $result->free(); 
                                } else {
                                    echo "<option value=''>Error fetching room numbers</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <!-- Other fields remain the same -->
                    <div class="mb-3">
                        <label for="tenantFirstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" name="tenantFirstName" id="tenantFirstName" required>
                    </div>
                    <div class="mb-3">
                        <label for="tenantLastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="tenantLastName" id="tenantLastName" required>
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" name="gender" id="gender" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="phoneNumber" class="form-label">Contact Number</label>
                        <input type="tel" class="form-control" name="phoneNumber" id="phoneNumber" required>
                    </div>
                      <div class="mb-3">
                        <label for="birthday" class="form-label">Birthday</label>
                        <input type="date" class="form-control" name="birthday" id="birthday" required>
                    </div>                 
                    <div class="mb-3">
                        <label for="guardianName" class="form-label">Guardian Name</label>
                        <input type="text" class="form-control" name="guardianName" id="guardianName">
                    </div>
                    <div class="mb-3">
                        <label for="guardianNum" class="form-label">Guardian Contact Number</label>
                        <input type="tel" class="form-control" name="guardianNum" id="guardianNum">
                    </div>
                    <div class="mb-3 text-left">
                        <button type="submit" name="btn_submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="viewTenantModal" tabindex="-1" aria-labelledby="viewTenantModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewTenantModalLabel">Tenant Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php 
                include './Database/connection.php';
                $sql = "SELECT `TenantID`, `tenant_first_name`, `tenant_last_name`, `roomNumber`, `phoneNumber`, `Gender`, `Birthday`, `Guardian`, `GuardianPhoneNumber` FROM `tenants` ";
                $result = $conn->query($sql);

                // Loop through each tenant's data
                while($row = $result->fetch_assoc()):
                ?>
                <div class="tenant-info" style="border-bottom: 2px solid #007bff; padding: 15px 0; margin-bottom: 20px;">
                    <h6 style="color: #007bff;">Tenant ID: <?php echo ($row['TenantID']); ?></h6>
                    <p><strong>Name:</strong> <?php echo ($row['tenant_first_name'] . ' ' . $row['tenant_last_name']); ?></p>
                    <p><strong>Room Number:</strong> <?php echo ($row['roomNumber']); ?></p>
                    <p><strong>Contact:</strong> <?php echo ($row['phoneNumber']); ?></p>
                    <p><strong>Gender:</strong> <?php echo ($row['Gender']); ?></p>
                    <p><strong>Birthday:</strong> <?php echo ($row['Birthday']); ?></p>
                    <p><strong>Guardian:</strong> <?php echo ($row['Guardian']); ?></p>
                    <p><strong>Guardian Contact:</strong> <?php echo ($row['GuardianPhoneNumber']); ?></p>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</div>

<!-- delete Tenant Modal -->
<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteTenantModal" tabindex="-1" aria-labelledby="deleteTenantModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteTenantModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this tenant?</p>
            </div>
            <div class="modal-footer">
                <form action="" method="POST" id="deleteTenantForm">
                    <input type="hidden" name="tenant_id" id="tenant_id">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="btn_delete" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

 <!-- Edit Tenant Modal -->
 <!-- Edit Tenant Modal -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
include './database/connection.php';
if (isset($_POST['btn_submit'])) {
    // Sanitize input
    $room_number = $conn->real_escape_string($_POST['roomNumber']);
    $first_name = $conn->real_escape_string($_POST['tenantFirstName']);
    $last_name = $conn->real_escape_string($_POST['tenantLastName']);
    $tenant_gender = $conn->real_escape_string($_POST['gender']);
    $phone_no = $conn->real_escape_string($_POST['phoneNumber']);
    $birthday = $conn->real_escape_string($_POST['birthday']);
    $guardian_name = $conn->real_escape_string($_POST['guardianName']);
    $guardian_phone_no = $conn->real_escape_string($_POST['guardianNum']);

    // Corrected SQL statement without PropertyID
    $sql = "INSERT INTO `tenants` 
            (`tenant_first_name`, `tenant_last_name`, `roomNumber`, `phoneNumber`, `Gender`, `Birthday`, `Guardian`, `GuardianPhoneNumber`) 
            VALUES 
            ('$first_name', '$last_name', '$room_number', '$phone_no', '$tenant_gender', '$birthday', '$guardian_name', '$guardian_phone_no')";

    // Execute query
    if ($conn->query($sql) === TRUE) {
        echo '<div class="alert alert-success" role="alert">New Tenant Added successfully</div>';
    } else {
        echo "Error: " . $conn->error;
    }
}
?>


<?php
if (isset($_POST['btn_delete'])) {
    $tenant_id = $_POST['tenant_id'];

    // Perform deletion logic
    $sql = "DELETE FROM tenants WHERE TenantID='$tenant_id'";

    if ($conn->query($sql) === TRUE) {
        // Display success message as a paragraph
        echo '<div class="alert alert-success" role="alert">Tenant deleted successfully</div>';
         // Success message
    } else {
        echo '<div class="alert alert-danger" role="alert">Error: ' . $conn->error . '</div>'; // Error message
    }
}
?>
