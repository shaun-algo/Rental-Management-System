CREATE TABLE `tenants` (
    `TenantID` INT AUTO_INCREMENT PRIMARY KEY,
    `tenant_first_name` VARCHAR(50) NOT NULL,
    `tenant_last_name` VARCHAR(50) NOT NULL,
    `roomNumber` VARCHAR(20) NOT NULL,
    `phoneNumber` VARCHAR(15) NOT NULL,
    `Gender` ENUM('Male', 'Female') NOT NULL,
    `Birthday` DATE NOT NULL,
    `Guardian` VARCHAR(50),
    `GuardianPhoneNumber` VARCHAR(15),
    `PropertyID` INT,

    FOREIGN KEY (`PropertyID`) REFERENCES `addproperty`(`PropertyID`) ON DELETE CASCADE
);
