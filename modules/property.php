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
                <b>Room Information</b>
                <span class="float-right">
                    <a class="btn btn-primary btn-sm" href="javascript:void(0)" id="new_room" data-bs-toggle="modal" data-bs-target="#addRoomModal">
                        <i class="fa fa-plus"></i> Add Room
                    </a>
                </span>
            </div>
            <div class="card-body">
            <?php 
            include './database/connection.php';

            $sql= "SELECT `PropertyID`, `roomNumber`, `room_price`, `capacity`, `description` FROM `addproperty`";
            $result = $conn->query($sql);
            ?>
                <table class="table table-bordered table-hover" id="roomTable">
                    <thead>
                        <tr>
                            <th>Room ID</th>
                            <th>Room Number</th>
                            <th>Room Price</th>
                            <th>Room Capacity</th>
                            <th>Room Description</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row=$result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['PropertyID'];?></td>
                            <td><?php echo $row['roomNumber'];?></td>
                            <td><?php echo $row['room_price'];?></td>
                            <td><?php echo $row['capacity'];?></td>
                            <td><?php echo $row['description'];?></td>
                            <td class="text-center">
                                <a class="btn btn-sm btn-outline-danger" href="#deletePropertyModal" data-bs-toggle="modal" onclick="document.getElementById('property_id').value = '<?php echo htmlspecialchars($row['PropertyID']); ?>'">Delete</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addRoomModal" tabindex="-1" aria-labelledby="addRoomModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRoomModalLabel">Add Room</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="roomForm">
                        <div class="mb-3">
                            <label for="roomNumber" class="form-label">Room Number</label>
                            <input type="text" class="form-control" name="roomNumber" id="roomNumber" required>
                        </div>
                        <div class="mb-3">
                            <label for="roomPrice" class="form-label">Room Price</label>
                            <input type="number" class="form-control" name="roomPrice" id="roomPrice" required step="0.01">
                        </div>
                        <div class="mb-3">
                            <label for="roomCapacity" class="form-label">Room Capacity</label>
                            <input type="number" class="form-control" name="roomCapacity" id="roomCapacity" required step="1">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Room Description</label>
                            <textarea rows="5" class="form-control" name="description" id="description" required></textarea>
                        </div>
                        <div class="mb-3 text-left">
                            <button type="submit" name="btn_submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deletePropertyModal" tabindex="-1" aria-labelledby="deletePropertyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deletePropertyModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this room?</p>
                </div>
                <div class="modal-footer">
                    <form action="" method="POST" id="deletePropertyForm">
                        <input type="hidden" name="property_id" id="property_id"> <!-- This should match your delete handler -->
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="btn_delete" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
include './database/connection.php';

if (isset($_POST['btn_submit'])) {
    $room_number = $_POST['roomNumber'];
    $room_price = $_POST['roomPrice'];
    $room_capacity = $_POST['roomCapacity'];
    $room_des = $_POST['description'];

    $sql = "INSERT INTO `addproperty`(`roomNumber`, `room_price`, `capacity`, `description`) VALUES ('$room_number', '$room_price', '$room_capacity', '$room_des')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('New Property added successfully')</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

if (isset($_POST['btn_update_room'])) {
    $property_id = $_POST['property_id'];
    $room_number = $_POST['room_number'];  
    $room_price = $_POST['room_price'];    
    $room_capacity = $_POST['capacity'];    
    $room_des = $_POST['description'];      

    $sql = "UPDATE addproperty SET 
            roomNumber = '$room_number',
            room_price = '$room_price',
            capacity = '$room_capacity',
            description = '$room_des'
            WHERE PropertyID = '$property_id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Property updated successfully')</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_POST['btn_delete'])) {
    // Use the correct key from the form submission
    if (isset($_POST['property_id'])) {
        $property_id = $_POST['property_id'];

        // Perform deletion logic
        $sql = "DELETE FROM addproperty WHERE PropertyID='$property_id'";

        if ($conn->query($sql) === TRUE) {
            // Display success message
            echo '<div class="alert alert-success" role="alert">Room deleted successfully</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Error: ' . $conn->error . '</div>'; // Error message
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">Error: Property ID not set.</div>'; // Error handling
    }
}
?>
