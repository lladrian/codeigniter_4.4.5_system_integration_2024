<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Qr Code</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

  
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('css/sb-admin-2.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('fontawesome-free/css/all.min.css') ?>">
 


   <style type="text/css">
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
    display: flex;
    justify-content: center;
    align-items: center;
  top: 50%;
  left: 50%;
  padding: 20px;
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
}


    </style>

</head>

<body>


                        <div class="wrapper">
                        <?php if(!empty(session()->getFlashdata ('error'))) : ?> 
                            <div class="alert alert-danger"> <?= session()->getFlashdata('error'); ?></div> 
                        <?php endif ?> 
                        <?php if(!empty(session()->getFlashdata('success'))) : ?> 
                            <div class="alert alert-success"> <?= session()->getFlashdata('success'); ?></div>
                        <?php endif ?>
                            <div class="container">
                                <form method="POST" action="<?= base_url('/recovery_code') ?>">

                                    <div class="col-md-12">
                                        <h4 class="card-title pb-1 fs-4 text-center">OTP Verification</h4>
                                    </div>

                                    <div class="col-12">
                                        <div class="input-group mb-3 mt-3">
                                            <input type="text" class="input form-control" name="code" id="code" placeholder="Please enter OTP Code" aria-label="password" aria-describedby="basic-addon1"/>
                                        </div>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <button class="btn btn-success w-100" id="start_button" name="submit" type="submit">Submit</button>
                                    </div>
                                            <div class="col-12">
                                            <div class="input-group mb-2">
                                                <a class="btn btn-primary btn-block" href="<?= base_url('recovery_account') ?>" role="button"> Back</a>
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>


<script src="resources/js/jquery.js"></script>

<script src="resources/sweetalert/sweetalert.js"></script>


<script src="<?= base_url('jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('js/sb-admin-2.min.js') ?>"></script>
    <script src="<?= base_url('jquery-easing/jquery.easing.min.js') ?>"></script>

 
</html>