<!DOCTYPE html>
<html lang="en">   
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landlady Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('room.jpg'); 
            background-size: cover; 
            background-repeat: no-repeat; 
            margin: 0;
        }
        .profile-card {
            margin-top: 50px;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }
        .profile-header {
            text-align: center;
            padding: 30px;
            background-color: #f8f9fa;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }
        .profile-pic {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 4px solid #007bff; 
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
        }
        .profile-info {
            padding: 30px;
        }
        .profile-info h2 {
            border-bottom: 2px solid #007bff; 
            padding-bottom: 10px;
            color: #007bff;
        }
        .edit-btn {
            margin-top: 10px;
        }
        .modal-content {
            border-radius: 12px;
        }
        .modal-header {
            border-bottom: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="profile-card">
            <div class="profile-header">
                <img src="./assets/img/geraldine.png" alt="geraldine" class="profile-pic">
                <h1 class="name">Geraldine Belono-ac</h1>
                <p class="title">Landlady</p>
                <button class="btn btn-primary edit-btn" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Profile</button>
            </div>
            <div class="profile-info">
                <h2>About Me</h2>
                <p>I'm the landlady of this boarding house with 10 rooms.</p>
                <h2>Properties</h2>
                <ul>
                    <li>Owner of Boarding House</li>
                </ul>
                <h2>Contact Information</h2>
                <p>Email: <a href="mailto:vice.ganda@example.com">vice.ganda@example.com</a></p>
                <p>Phone: (987) 654-3210</p>
            </div>
        </div>
    </div>

   
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="landladyForm">
                        <div class="mb-3">
                            <label for="landladyName" class="form-label">Name</label>
                            <input type="text" class="form-control" name="landladyName" id="landladyName" required value="Jane Smith">
                        </div>
                        <div class="mb-3">
                            <label for="contactInfo" class="form-label">Contact Information</label>
                            <input type="text" class="form-control" name="contactInfo" id="contactInfo" required value="(987) 654-3210">
                        </div>
                        <div class="mb-3">
                            <label for="landladyEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" name="landladyEmail" id="landladyEmail" required value="jane.smith@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="landladyAddress" class="form-label">Address</label>
                            <input type="text" class="form-control" name="landladyAddress" id="landladyAddress" required value="123 Main St, Apartment 1">
                        </div>
                        <button type="submit" name="btn_submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
