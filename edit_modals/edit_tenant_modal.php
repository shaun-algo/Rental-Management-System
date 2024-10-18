 <!-- Edit Tenant Modal -->
 <div class="modal fade" id="editTenantModal" tabindex="-1" aria-labelledby="editTenantModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTenantModalLabel">Edit Tenant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="editTenantForm">
                        <div class="mb-3">
                            <label for="editTenantID" class="form-label">Tenant ID</label>
                            <input type="text" class="form-control" name="tenant_id" id="editTenantID" required readonly>
                        </div>
                        <div class="mb-3">
                            <label for="editTenantFirstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" name="tenantFirstName" id="editTenantFirstName" required>
                        </div>
                        <div class="mb-3">
                            <label for="editTenantLastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="tenantLastName" id="editTenantLastName" required>
                        </div>
                        <div class="mb-3">
                            <label for="editRoomNumber" class="form-label">Room Number</label>
                            <input type="text" class="form-control" name="roomNumber" id="editRoomNumber" required>
                        </div>
                        <div class="mb-3">
                            <label for="editPhoneNumber" class="form-label">Contact Number</label>
                            <input type="tel" class="form-control" name="phoneNumber" id="editPhoneNumber" required>
                        </div>
                        <div class="mb-3 text-left">
                            <button type="submit" name="btn_update" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
