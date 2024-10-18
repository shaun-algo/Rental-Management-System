CREATE TABLE financial_reports (
    report_id INT AUTO_INCREMENT PRIMARY KEY,
    tenant_id INT NOT NULL,
    amount_paid DECIMAL(10, 2) NOT NULL,
    payment_status ENUM('Paid', 'Unpaid') NOT NULL,
    report_date DATE NOT NULL,
    FOREIGN KEY (tenant_id) REFERENCES tenants(TenantID)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);
