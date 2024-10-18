<?php

class User {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    
    public function authenticate($username, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                return $row; 
            }
        }
        return false; 
    }
}

class Register {
    private $conn;
   
    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function register($username, $password) { 
       
        $checkSql = "SELECT id FROM users WHERE username = ?";
        $checkStmt = $this->conn->prepare($checkSql);

       
        if ($checkStmt === false) {
            throw new Exception("Failed to prepare statement: " . $this->conn->error);
        }

      
        $checkStmt->bind_param("s", $username);
        $checkStmt->execute();
        $checkStmt->store_result();
    
        if ($checkStmt->num_rows > 0) {
            throw new Exception("Error: Username already exists.");
        }
   
        $sql = "INSERT INTO users (username, password, created_at) VALUES (?, ?, NOW())"; // Use NOW() for created_at
        $stmt = $this->conn->prepare($sql);

       
        if ($stmt === false) {
            throw new Exception("Failed to prepare statement: " . $this->conn->error);
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("ss", $username, $hashedPassword); 
    
        if ($stmt->execute()) {
          
            header("Location: index.php?register=success");
            exit();
        } else {
            throw new Exception("Error in registering: " . $this->conn->error);
        }
    }
}
?>