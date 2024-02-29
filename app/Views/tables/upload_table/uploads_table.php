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
    <script src="https://kit.fontawesome.com/bf7d389ac4.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 
   
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
               
                    
                    <div style="background:none;"><h1 style="font-weight:bold; color:black;">Upload Table</h1></div>
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
                <div class="container-fluid" style="display:flex;  flex-direction: column;  justify-content:center; align-items:center;">
                    <!-- Content Row -->
                    <div style=" width:100%;">
                        <div> 
                            <form method="post" action="<?= base_url('dashboard/uploads/filter') ?>">
                                <div>
                                        <label for="start_date">Start Date:</label>
                                        <input type="date" id="start_date" name="start_date">
                            
                                        <label for="end_date">   End Date:</label>
                                        <input type="date" id="end_date" name="end_date">
                            
                                        <button type="submit">Filter</button>
                                </div>
                            </form>
                        </div>
                        <div>
                            <form method="post" action="<?= base_url('/dashboard/uploads/filterQuarterly') ?>">
                                <label for="year">Select Year:</label>
                                <input type="number" id="year" name="year" min="1900" max="2099" step="1" value="<?= date('Y') ?>" required>
                                </select>
                                <label for="quarter">Select Quarter:</label>
                                <select name="quarter" id="quarter">
                                    <option value="1">Q1</option>
                                    <option value="2">Q2</option>
                                    <option value="3">Q3</option>
                                    <option value="4">Q4</option>
                                </select>
                                <button type="submit">Filter</button>
                            </form>
                        </div>    
                        <div>
                            <form method="post" action="<?= base_url('/dashboard/uploads/filterMonthly') ?>">
                                <label for="month">Select Month:</label>
                                <select name="month" id="month">
                                    <?php
                                    // Display options for all 12 months
                                    for ($i = 1; $i <= 12; $i++) {
                                        echo "<option value='$i'>" . date("F", mktime(0, 0, 0, $i, 1)) . "</option>";
                                    }
                                    ?>
                                </select>
                                <label for="year">Select Year:</label>
                                <input type="number" id="year" name="year" min="1900" max="2099" step="1" value="<?= date('Y') ?>" required>
                                <button type="submit">Filter</button>
                            </form>
                        </div>
                        <div>
                            <form method="post" action="<?= base_url('/dashboard/uploads/filterYearly') ?>">
                                <label for="year">Select Year:</label>
                                <input type="number" id="year" name="year" min="1900" max="2099" step="1" value="<?= date('Y') ?>" required>
                                <button type="submit">Filter</button>
                            </form>
                        </div>           
                       
                        <div style="margin-bottom: 5px;">
                            <form method="get" action="<?= base_url('/dashboard/uploads') ?>">
                                <button type="submit">REFRESH</button>
                            </form>
                        </div>          
                    </div>

                    <div class="row" style="display:flex;  flex-direction: column;  justify-content:center; align-items:center;  width:100%;">
                        <div style="width:100%;">
                            <div style="margin-bottom:5px; background:red; width:100%;">
                                <a class="btn btn-success btn-block" href="<?= base_url('/dashboard/upload/add_upload') ?>">INSERT DATA</a>        
                                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">INSERT DATA</button> -->
                            </div>
                            <!-- Button to trigger the modal -->
                            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">INSERT DATA </button> -->
                            <table border="1" style="width: 100%;">
                                    <colgroup>
                                            <col width="10%">
                                            <col width="30%">
                                            <col width="30%">
                                            <col width="10%">
                                            <col width="10%">
                                            <col width="20%">
                                        </colgroup>
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">ID</th>
                                        <th>Filename</th>
                                        <!-- <th>File Path</th> -->
                                        <th>File Type</th>
                                        <th style="min-width: 90px;">File Size</th>
                                        <th>Upload Date</th>
                                        <th style="text-align:center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($uploads as $upload): ?>
                                        <tr >
                                            <td style="text-align: center;"><?= $upload['id'] ?></td>
                                            <td ><?= $upload['file_name'] ?></td>
                                            <!-- <td ><?= $upload['file_path'] ?></td> -->
                                            <td><?= $upload['file_type'] ?></td>
                                            <td ><?= $upload['file_size'] ?></td>
                                            <td ><?= $upload['upload_date'] ?></td>
                                            <td >
                                                <div style="display:inline-flex; justify-content:space-between; width:100%;">
                                                        <div  style="display:flex; justify-content:center; align-items:center;">
                                                            <div  style="width:100%; background:blue;  border-radius: 5px;  padding:7px; display:flex; justify-content:center; align-items:center;">
                                                                <a href="<?= base_url($upload['file_path']) ?>" style="color:white; font-weight:bold;   text-decoration: none;"  download  title="Download File">
                                                                    DOWNLOAD
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            $file_name =  $upload['file_name'];
                                                            $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                                                    
                                                    ?>
                                                        <?php if ($file_extension === 'docx' || $file_extension === 'zip' || $file_extension === 'rar'): ?>
                                                            <div>
                                                                <form method="get" style="width:100%;" action="<?= base_url('/dashboard/upload/view_upload_id/'.$upload['id']) ?>">
                                                                    <button type="submit" disabled class="btn  btn-secondary " >VIEW</button>
                                                                </form>   
                                                            </div>
                                                            <!-- <form method="get" style="width:100%; padding:0px 20px 0px 20px;" action="<?= base_url('/dashboard/upload/view_upload_id/'.$upload['id']) ?>">
                                                                <button type="submit" disabled style="width:100%;" class="btn  btn-success ">VIEW</button>
                                                            </form>  -->
                                                        <?php elseif (
                                                        $file_extension === 'png' 
                                                        || $file_extension === 'jpg' 
                                                        || $file_extension === 'jpeg' 
                                                        || $file_extension === 'pdf') : ?>
                                                            <div>
                                                                <form method="get" style="width:100%;" action="<?= base_url('/dashboard/upload/view_upload_id/'.$upload['id']) ?>">
                                                                    <button type="submit" class="btn  btn-secondary ">VIEW</button>
                                                                </form>   
                                                            </div>
                                                    
                                                        <?php endif; ?>

                                                        <div>
                                                            <form method="get" style="width:100%;" action="<?= base_url('/dashboard/upload/edit/'.$upload['id']) ?>">
                                                                    <button type="submit" class="btn  btn-info">EDIT</button>
                                                            </form> 
                                                        </div>

                                                        <div>
                                                            <form method="get" style="width:100%;" action="<?= base_url('/dashboard/upload/comment/'.$upload['id']) ?>">
                                                                    <button type="submit" class="btn  btn-warning">COMMENT</button>
                                                            </form> 
                                                        </div>

                                                        <div>
                                                            <form method="POST" style="width:100%;"  action="<?= base_url('/dashboard/upload/delete/'.$upload['id'].'/'.$upload['file_name']) ?>">
                                                                <button type="submit" class="btn btn-danger">DELETE</button>
                                                            </form>  
                                                        </div>
                                                        
                                                    
                                                        
                                                </div>                            
                                            </td>
                                    
                                        </tr>
                                    
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
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