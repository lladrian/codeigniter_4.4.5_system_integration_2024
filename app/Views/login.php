<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>

<link rel="stylesheet" href="<?= base_url('bootstrap/css/bootstrap.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('fontawesome-free/css/all.min.css') ?>">
 
<!-- <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="fontawesome-free/css/all.min.css">
  -->

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
  

<body>

    <?php if (session()->has('errors')) : ?>
        <ul>
            <?php foreach (session('errors') as $error) : ?>
                <li><?= esc($error) ?></li>
            <?php endforeach ?>
        </ul>
    <?php endif ?>

<div class="wrapper">
                        <div class="container">
                           
                                <h1 style="text-align: center;">Login Form</h1>
                                
                              <form id="login_form" method="post" action="<?= base_url('/login') ?>">
                              <!-- <?= csrf_field() ?> -->
                              <!-- <div class="col-12 ">
                                    <div class="input-group mb-2">
                                        <a class="btn btn-danger btn-block" href="scan_qr.php" width="100%" role="button"> Scan QR</a>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-5">
                                            <hr>
                                        </div>
                                        <div class="col-2">
                                            <p class="text-center">or</p>
                                        </div>
                                        <div class="col-5">
                                            <hr>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="col-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                                        </div>
                                        <input name="email"  value="<?= old('email') ?>" type="text" class="input form-control" id="email" placeholder="Email Address" aria-label="Email" aria-describedby="basic-addon1" autocomplete="email"
                                       />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                                        </div>
                                        <input name="password" id="password" type="password" class="input form-control" id="password" placeholder="Password" aria-label="password" aria-describedby="basic-addon1" autocomplete="current-password"  />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100" type="submit" name="submit">Login</button>
                                </div>
                                <!-- <div class="col-12">
                                    <div class="form-group form-check" style="display:flex;  align-items: center;">
                                        <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe">
                                        <label class="form-check-label" for="rememberMe">Remember Me</label>
                                    </div>
                                </div> -->
                                <!-- <div class="col-12 mt-3">
                                    <p>Don't have account?<a href="/register"> Create Account.</a></p>
                                </div> -->
                                <div class="col-12 mt-1">
                                    <a class="btn btn-primary btn-danger w-100" href="<?= base_url(' /recovery_account') ?>" style="font-weight: 700;">Forgot Password</a>
                                </div>
                            </form>                                 
                        </div>
                    </div>


</body>
</html>
