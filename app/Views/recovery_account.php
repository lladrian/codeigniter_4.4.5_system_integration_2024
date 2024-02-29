<!DOCTYPE html>
<html lang="en">


<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>QR SYSTEM</title>
    <meta charset="utf-8">


    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

  
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('css/sb-admin-2.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('fontawesome-free/css/all.min.css') ?>">
 


    <style>
        
     * {
    margin: 0;
    padding: 0;
  box-sizing: border-box;
}
body {
    background: wheat;
}
.wrapper {
    width: 400px;
    background: white;
    position: absolute;
  top: 50%;
  left: 50%;
  padding: 40px;
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
}

    </style>



    <!-- endinject -->
    <link rel="shortcut icon" href="" />
</head>

<body>


                        <div class="wrapper">
                        <?php if (session()->has('errors')) : ?>
                            <ul>
                                <?php foreach (session('errors') as $error) : ?>
                                    <li>
                                        <span style="color:red;">
                                            <?= esc($error) ?>
                                        </span>
                                </li>
                                <?php endforeach ?>
                            </ul>
                        <?php endif ?>

                            <div >
                                <h4 style="text-align:center;">Account Recovery</h4>
                            </div>
                                
                            <form id="recovery_form"  method="post" action="<?= base_url('/email_verification') ?>">
                                <div class="row"> 
                                    <div class="col-12">
                                        <div class="input-group mb-2">
                                            <a class="btn btn-primary btn-block" href="<?= base_url('/login') ?>" role="button"> Back</a>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div class="input-group mb-2">
                                            <input type="email" class="input form-control" name="email" id="email"  placeholder="Enter Email Address" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-group mb-2">
                                            <input class="btn form-control" style="background:#bba644; font-weight: 600; color: white;" type="submit">
                                        </div>
                                    </div>    
                                    
             
                                    <div class="col-12">
                                        <div class="input-group mb-2">
                                            <a style="background: #454643; font-weight: 600; color: white;" class="btn btn-block" href="<?= base_url('/register') ?>" role="button">Create an account</a>
                                        </div>
                                    </div>
                                </div>
                              

                            </form>

                        </div>


  
<script src="<?= base_url('jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('js/sb-admin-2.min.js') ?>"></script>
    <script src="<?= base_url('jquery-easing/jquery.easing.min.js') ?>"></script>




</body>

</html>