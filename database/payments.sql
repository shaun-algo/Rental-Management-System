CREATE TABLE payments (
    payment_id INT AUTO_INCREMENT PRIMARY KEY,
    tenant_id INT NOT NULL,
    property_id INT NOT NULL,
    payment_amount DECIMAL(10, 2) NOT NULL,
    payment_date DATE NOT NULL,
    payment_status ENUM('Completed', 'Pending') NOT NULL,
    FOREIGN KEY (tenant_id) REFERENCES tenants(TenantID) ON DELETE CASCADE,
    FOREIGN KEY (property_id) REFERENCES addproperty(PropertyID) ON DELETE CASCADE
);
