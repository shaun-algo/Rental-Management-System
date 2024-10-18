<table class="table table-bordered table-hover" id="tenantTable">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Name</th>
                            <th>Contact Info</th>
                            <th>Rent Due Date</th>
                            <th>Rent Amount</th>
                            <th>Property ID</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Sample Tenant Row -->
                        <tr>
                            <td class="text-center">1</td>
                            <td>John Doe</td>
                            <td>09061087972</td>
                            <td>May 25, 2024</td>
                            <td>1,500.00</td>
                            <td>01</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-primary">View</button>
                                <button class="btn btn-sm btn-outline-primary">Edit</button>
                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                            </td>
                        </tr>
                        <!-- Add more tenant rows here -->
                    </tbody>
                    <div class="modal fade" id="addTenantModal" tabindex="-1" aria-labelledby="addTenantModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTenantModalLabel">Add Tenant</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="add_tenant.php" method="POST" id="tenantForm">
                    <div class="mb-3">
                        <label for="tenantName" class="form-label">Name</label>
                        <input type="text" class="form-control" name="tenantName" id="tenantName" required>
                    </div>
                    <div class="mb-3">
                        <label for="contactInfo" class="form-label">Contact Info</label>
                        <input type="text" class="form-control" name="contactInfo" id="contactInfo" required>
                    </div>
                    <div class="mb-3">
                        <label for="rentDueDate" class="form-label">Rent Due Date</label>
                        <input type="date" class="form-control" name="rentDueDate" id="rentDueDate" required>
                    </div>
                    <div class="mb-3">
                        <label for="rentAmount" class="form-label">Rent Amount</label>
                        <input type="number" class="form-control" name="rentAmount" id="rentAmount" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="propertyId" class="form-label">Property ID</label>
                        <input type="text" class="form-control" name="propertyId" id="propertyId" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>