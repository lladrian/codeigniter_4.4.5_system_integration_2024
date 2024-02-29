<?php
    // Retrieve the 'user' session variable
    $user = session('user');        
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

  
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('css/sb-admin-2.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('fontawesome-free/css/all.min.css') ?>">
 
<style>
      body {
            font-family: Arial, sans-serif;
            background-color: wheat;
            margin: 0;
            padding: 0;
        }
        .wrapper-registration-form {
            display: flex;
            justify-content: center;
            align-items: center;
            /* height: 100vh; */
        }
        .registration-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 600px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;

        }

        .registration-form > form {
            width: 100%;
            height: 100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .registration-form > form > div {
            width: 100%;
            height: 100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .form-group {
            width: 48%;
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input, .form-group textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group input[type="submit"] {
            color: #fff;
            cursor: pointer;
            background-color: #4caf50;
        }

        .form-group input[type="submit"]:hover {
            color: #fff;
        }



        .form-group .checkbox-group {
            display: flex;
            align-items: center;
        }

        .form-group input[type="checkbox"] {
            margin-right: 5px;
        }
</style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <div>
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                    <div class="sidebar-brand-text"><?= $user['role_name'] ?? '' ?></div>
                </a>
            </div>
            

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="<?= base_url('dashboard') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

             <!-- Nav Item - Pages Collapse Menu -->
             <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <!-- <i class="fas fa-fw fa-cog"></i> -->
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Tables:</h6>
                        <?php if ($user['is_admin'] == 1 || $user['is_super_admin'] == 1): ?>
                        <a class="collapse-item" href="<?= base_url('dashboard/users') ?>">
                            <span>Users Tables</span>
                        </a>
                        <a class="collapse-item" href="<?= base_url('dashboard/admins') ?>">
                            <span>Admins Tables</span>
                        </a>
                        <?php endif; ?>
                        <?php if ($user['is_super_admin'] == 1): ?>
                        <a class="collapse-item" href="<?= base_url('dashboard/roles') ?>">
                            <span>Roles Table</span>
                        </a>
                        <a class="collapse-item" href="<?= base_url('dashboard/permissions') ?>">
                            <span>Permissions Table</span>
                        </a>
                        <?php endif; ?>
                        <a class="collapse-item" href="<?= base_url('dashboard/uploads') ?>">
                            <span>Uploads Table</span>
                        </a>
                    </div>  
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Accessibility</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Accessibility:</h6>
                        <a class="collapse-item" href="utilities-color.html">Colors</a>
                        <a class="collapse-item" href="utilities-border.html">Borders</a>
                        <a class="collapse-item" href="utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.html">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a>
                    </div>
                </div>
            </li>

            <!-- <li class="nav-item">
                <a class="nav-link" href="<?= base_url('dashboard/users') ?>">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Users Tables</span></a>
            </li>
            
             <li class="nav-item">
                <a class="nav-link" href="<?= base_url('dashboard/admins') ?>">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Admins Tables</span></a>
            </li> -->

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

         

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
               
                    
                    <div style="background:none;"><h1 style="font-weight:bold; color:black;">Profile Data</h1></div>
                    <div style="width:50%; display:inline-flex; justify-content:center; align-items:center;">
                        <!-- Check if the flash data for success message exists -->
                        <?php if(session()->getFlashdata('success')): ?>
                            <!-- Display the success message -->
                            <div class="alert alert-success">
                                <?php echo session()->getFlashdata('success'); ?>
                            </div>
                        <?php endif; ?>
                        <?php if(session()->getFlashdata('error')): ?>
                            <!-- Display the success message -->
                            <div class="alert alert-danger">
                                <?php echo session()->getFlashdata('error'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                 

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                    
                        <!-- Nav Item - User Information -->
                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw fa-2x"></i>

                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>


                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user['username'] ?? '' ?></span>
                                <img class="img-profile rounded-circle"
                                    src="<?= base_url('img/undraw_profile.svg') ?>">
                                    
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?= base_url('/dashboard/profile') ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Content Row -->
                    
                    <div class="row" style="display:flex;  flex-direction: column;  justify-content:center; align-items:center;  width:100%;">
                        <div style="width:100%;">
                        <div class="wrapper-registration-form">
                        <div class="registration-form">
                            <h1 style="margin-bottom: 30px;">Update Profile</h1>
                            
                            <form id="reg_form" method="post" action="<?= base_url('/dashboard/profile/update/'.$user['id']) ?>">
                                <div>
                                    <div class="form-group">
                                        <label for="firstname">Firstname:</label>
                                        <input type="text" id="fname" name="fname" value="<?= $user['firstname'] ?>" placeholder="Enter Firstname">
                                        <?php if (session()->has('errors')) : ?>
                                            <?php foreach (session('errors') as $error) : ?>
                                                <?php if (strpos($error, 'fname') !== false) : ?>
                                                    <span class="text-danger"><?= esc($error) ?></span>
                                                <?php endif ?>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="lastname">Lastname:</label>
                                        <input type="text" id="lname" name="lname" value="<?= $user['lastname'] ?>" placeholder="Enter Lastname">
                                        <?php if (session()->has('errors')) : ?>
                                            <?php foreach (session('errors') as $error) : ?>
                                                <?php if (strpos($error, 'lname') !== false) : ?>
                                                    <span class="text-danger"><?= esc($error) ?></span>
                                                <?php endif ?>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Username:</label>
                                        <input type="text" id="uname" name="uname" value="<?= $user['username'] ?>" placeholder="Enter Username">
                                        <?php if (session()->has('errors')) : ?>
                                            <?php foreach (session('errors') as $error) : ?>
                                                <?php if (strpos($error, 'uname') !== false) : ?>
                                                    <span class="text-danger"><?= esc($error) ?></span>
                                                <?php endif ?>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" id="email" name="email" value="<?= $user['email'] ?>" placeholder="Enter Email Address">
                                        <?php if (session()->has('errors')) : ?>
                                            <?php foreach (session('errors') as $error) : ?>
                                                <?php if (strpos($error, 'email') !== false) : ?>
                                                    <span class="text-danger"><?= esc($error) ?></span>
                                                <?php endif ?>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password:</label>
                                        <input type="password" id="password" value="<?= old('password') ?>" name="password" placeholder="Enter Password">
                                        <?php if (session()->has('errors')) : ?>
                                            <?php foreach (session('errors') as $error) : ?>
                                                <?php if (strpos($error, 'password') !== false) : ?>
                                                    <span class="text-danger"><?= esc($error) ?></span>
                                                <?php endif ?>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="password2">Confirm Password:</label>
                                        <input type="password" name="confirm_password" id="confirm_password" value="<?= old('confirm_password') ?>" placeholder="Enter Confirm Password">
                                        <?php if (session()->has('errors')) : ?>
                                            <?php foreach (session('errors') as $error) : ?>
                                                <?php if (strpos($error, 'confirm_password') !== false) : ?>
                                                    <span class="text-danger"><?= esc($error) ?></span>
                                                <?php endif ?>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    </div>
                                    
                                    <div class="form-group" style="width:100%; ">
                                        <label for="category"  style="width:100%; padding:10px; ">Role:</label>
                                        <select id="category" name="category"  style="width:100%; padding:10px; text-transform: capitalize; ">
                                            <?php foreach ($roles as $role): ?> 
                                                <?php if ($role['id'] == $user['role_id']): ?>
                                                    <!-- <option value="<?= $user['role_id'] ?>" selected><?= $role['role_name'] ?></option> -->
                                                    <option value="<?= $user['role_id'] ?>" selected
                                                    style="<?= ($role['status'] == 1) ? 'color:black;' : 'color:red;' ?> font-size:18px;  text-transform: capitalize;"> 
                                                    <?= ($role['status'] == 1) ? $role['role_name'] : $role['role_name'] . ' (Inactive)' ?>
                                                    </option>
                                                <?php endif; ?>
                                                <?php if ($role['id'] !== $user['role_id']): ?>
                                                    <option value="<?= $role['id'] ?>" 
                                                    style="<?= ($role['status'] == 1) ? 'color:black;' : 'color:red;' ?> font-size:18px;  text-transform: capitalize;"> 
                                                    <?= ($role['status'] == 1) ? $role['role_name'] : $role['role_name'] . ' (Inactive)' ?>
                                                    </option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                
                                    
                                
                                    <!-- <div class="form-group" style="width:100%; ">
                                        <label for="category"  style="width:100%; padding:10px; ">User Type:</label>
                                        <select id="category" name="category"  style="width:100%; padding:10px; ">
                                            <option value="admin" style="font-size:18px;">System Administrator</option>
                                            <option value="user" style="font-size:18px;">Regular User</option>
                                            <option value="user" style="font-size:18px;">Irregular User</option>
                                        </select>
                                    </div> -->
                                </div>

                                <div class="form-group" style="width: 100%;">
                                    <input type="submit" value="UPDATE DATA "   >
                                </div>
                                <!-- <div class="form-group" style="width: 100%;">
                                    <a href="<?= base_url('/dashboard/users') ?>" style="font-size:20px;">BACK</a>
                                </div> -->
                            </form>
                        </div>
                        </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                     <span>Copyright &copy; GROUP LEVELING 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= base_url('/dashboard/logout') ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>
  
    

    <script src="<?= base_url('jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('js/sb-admin-2.min.js') ?>"></script>
    <script src="<?= base_url('jquery-easing/jquery.easing.min.js') ?>"></script>

 
</body>

</html>