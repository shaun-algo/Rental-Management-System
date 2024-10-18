<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="assets/styles.css" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header id="header" class="header" style="background-color: #ffffff;">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="welcome-text" style="color: black;">Welcome Back, Admin!</h4>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle small-dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="./assets/img/geraldine.png" alt="Admin Photo" class="admin-photo"> 
                    <span class="ml-2 admin-name">Geraldine T. Belono-ac</span> 
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile small-dropdown">
                    <li class="dropdown-header">
                        <h6 class="small-text" style="color: black;">Geraldine T. Belono-ac</h6>
                        <span class="small-text" style="color: black;">Admin</span>
                      
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center small-dropdown-item" data-bs-toggle="modal" data-bs-target="#profileModal" href="#">
                            <i class="fa fa-user small-icon"></i>
                            <span class="small-text">My Profile</span>
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                    <a class="dropdown-item d-flex align-items-center small-dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                        <i class="fa fa-sign-out-alt small-icon"></i>
                        <span class="small-text">Sign Out</span>
                    </a>


                    </li>
                </ul>
            </div>
        </div>
    </header>

    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true"> 
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileModalLabel">My Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6>Profile Information</h6>
                <div class="mb-3">
                    <label class="form-label">Name:</label>
                    <p class="form-control-plaintext">Geraldine Belono-ac</p>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email:</label>
                    <p class="form-control-plaintext">jane.smith@example.com</p>
                </div>

                <h6>Contact Information</h6>
                <div class="mb-3">
                    <label class="form-label">Contact Number:</label>
                    <p class="form-control-plaintext">(987) 654-3210</p>
                </div>
                <div class="mb-3">
                    <label class="form-label">Address:</label>
                    <p class="form-control-plaintext">Valencia city</p>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- Sidebar Navigation -->
    <div id="sidebar" style="background-color: #ffffff;">
        <br>
        <br>
        <br>
        <br>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link collapsed <?php echo ($_GET['page'] ?? '') === 'dashboard' ? 'active' : ''; ?>" href="dashboard.php?page=dashboard">
                    <i class="bi bi-house-door" style="margin-right: 10px;"></i> 
                    <h5><span style="color: #000000;">Dashboard</span></h5>
                </a>
            </li>
        </ul>

        <div class="nav-heading text-white mt-4" style="background-color: #007bff; border-radius: 5px; padding: 10px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
            <h6 class="mb-0">Page Menu</h6>
        </div>

        <ul class="nav flex-column mt-3"> 
            <li class="nav-item">
                <a class="nav-link <?php echo ($_GET['page'] ?? '') === 'tenant_nav' ? 'active' : ''; ?>" href="dashboard.php?page=tenant_nav">
                    <i class="fa fa-user-friends" style="color: #000000;"></i>
                    <span style="color: #000000;">Tenants</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($_GET['page'] ?? '') === 'property' ? 'active' : ''; ?>" href="dashboard.php?page=property">
                    <i class="fa fa-bed" style="color: #000000;"></i>
                    <span style="color: #000000;">Rooms</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($_GET['page'] ?? '') === 'payments' ? 'active' : ''; ?>" href="dashboard.php?page=payments">
                    <i class="fa fa-file-invoice" style="color: #000000;"></i>
                    <span style="color: #000000;">Payments</span>
                </a>
            </li>
        </ul>

        <div class="nav-heading text-white mt-4" style="background-color: #007bff; border-radius: 5px; padding: 10px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
            <h7 class="mb-0">Page Report</h7>
        </div>

        <ul class="nav flex-column mt-3"> 
            <li class="nav-item">
                <a class="nav-link <?php echo ($_GET['page'] ?? '') === 'reminders' ? 'active' : ''; ?>" href="dashboard.php?page=reminders">
                    <i class="fa fa-clipboard" style="color: #000000;"></i>
                    <span style="color: #000000;">Reports</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="main-content">
        <div class="container-fluid">
            <div class="row mt-3 ml-3 mr-3">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5><?php echo "" ?></h5>
                            </div>
                            <hr>
                            <div class="row">
                            
                                <?php 
                                if (isset($_GET['page'])){
                                    $page=$_GET['page'];
                                    switch($page){
                                        case 'landlady':
                                            include './modules/landlady.php';
                                            break;
                                        case 'reminders':
                                            include './modules/reminders.php';
                                            break;
                                        case 'tenant_nav':
                                            include './modules/tenants.php';
                                            break;
                                        case 'property':
                                            include './modules/property.php';
                                            break;
                                        case 'payments':
                                            include './modules/payments.php';
                                            break;
                                        default:
                                            include 'view_list.php';
                                            break;
                                    }
                                } else {
                                    include 'view_list.php';
                                }
                                ?>
                            </div>
                        </div>      			
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>
