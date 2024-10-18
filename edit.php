<?php
include('./database/connection.php');

// Retrieve the tenant ID from the query string
$id = $_GET['id'];

// Query the database to get the tenant's current data
$query = mysqli_query($conn, "SELECT * FROM tenants WHERE TenantID='$id'");
$row = mysqli_fetch_array($query);

// Check if the form has been submitted for updating the tenant
if (isset($_POST['submit'])) {
    // Retrieve updated values from the form
    $firstname = $conn->real_escape_string($_POST['firstname']);
    $lastname = $conn->real_escape_string($_POST['lastname']);
    $gender = $conn->real_escape_string($_POST['Gender']);
    $phoneNumber = $conn->real_escape_string($_POST['phoneNumber']);
    $birthday = $conn->real_escape_string($_POST['Birthday']);
    $guardianName = $conn->real_escape_string($_POST['Guardian']);
    $guardianNum = $conn->real_escape_string($_POST['guardianNum']);

    // SQL query to update tenant information
    $sql = "UPDATE tenants SET 
            tenant_first_name='$firstname', 
            tenant_last_name='$lastname', 
            gender='$gender', 
            phoneNumber='$phoneNumber', 
            birthday='$birthday', 
            guardian_name='$guardianName', 
            guardian_num='$guardianNum' 
            WHERE TenantID='$id'";

    // Execute the query and check for success
    if ($conn->query($sql) === TRUE) {
        echo '<div style="color: green;">Tenant information updated successfully.</div>';
    } else {
        echo '<div style="color: red;">Error updating tenant: ' . $conn->error . '</div>';
    }
}
?>


    <div class="container mt-5">
        <h2>Edit Tenant</h2>
        <!-- Trigger the modal with a button -->

        <!-- Modal -->
        <div class="modal fade" id="editTenantModal" tabindex="-1" aria-labelledby="editTenantModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editTenantModalLabel">Edit Tenant Information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="?id=<?php echo $id; ?>">
                            <div>
                                <label>First Name:</label>
                                <input type="text" value="<?php echo htmlspecialchars($row['tenant_first_name']); ?>" name="firstname" required>
                            </div>
                            <div>
                                <label>Last Name:</label>
                                <input type="text" value="<?php echo htmlspecialchars($row['tenant_last_name']); ?>" name="lastname" required>
                            </div>
                            <div>
                                <label>Gender:</label>
                                <select name="Gender" required>
                                    <option value="Male" <?php if ($row['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                                    <option value="Female" <?php if ($row['gender'] == 'Female') echo 'selected'; ?>>Female</option>
                                </select>
                            </div>
                            <div>
                                <label>Contact Number:</label>
                                <input type="tel" value="<?php echo htmlspecialchars($row['phoneNumber']); ?>" name="phoneNumber" required>
                            </div>
                            <div>
                                <label>Birthday:</label>
                                <input type="date" value="<?php echo htmlspecialchars($row['birthday']); ?>" name="Birthday" required>
                            </div>
                            <div>
                                <label>Guardian Name:</label>
                                <input type="text" value="<?php echo htmlspecialchars($row['guardian_name']); ?>" name="Guardian">
                            </div>
                            <div>
                                <label>Guardian Contact Number:</label>
                                <input type="tel" value="<?php echo htmlspecialchars($row['guardian_num']); ?>" name="guardianNum">
                            </div>
                            <div>
                                <input type="submit" name="submit" value="Update">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <a href="./modules/tenants.php" class="back-link">Back</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

