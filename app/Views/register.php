<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: wheat;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
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
        }

        .form-group input[type="submit"]:hover {
            color: #fff;
        }

        .form-group input[type="submit"].agree-checked {
            background-color: #4caf50;
        }

        .form-group input[type="submit"].agree-unchecked {
            background-color: #ccc;
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
<body>

<?php if (session()->has('errors')) : ?>
    <ul>
        <?php foreach (session('errors') as $error) : ?>
            <li><?= esc($error) ?></li>
        <?php endforeach ?>
    </ul>
<?php endif ?>


<div class="registration-form">
    <h1 style="margin-bottom: 30px;">Register Form</h1>
    
    <form id="reg_form" method="post" action="<?= base_url('/register') ?>">
        <div>
            <div class="form-group">
                <label for="firstname">Firstname:</label>
                <input type="text" id="fname" name="fname" value="<?= old('fname') ?>" placeholder="Enter Firstname">
            </div>
            <div class="form-group">
                <label for="lastname">Lastname:</label>
                <input type="text" id="lname" name="lname" value="<?= old('lname') ?>" placeholder="Enter Lastname">
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="uname" name="uname" value="<?= old('uname') ?>" placeholder="Enter Username">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= old('email') ?>" placeholder="Enter Email Address">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" value="<?= old('password') ?>" name="password"
                       placeholder="Enter Password">
            </div>
            <div class="form-group">
                <label for="password2">Confirm Password:</label>
                <input type="password" name="confirm_password" id="confirm_password"
                       value="<?= old('confirm_password') ?>" placeholder="Enter Confirm Password">
            </div>
        </div>
       
     
        <!-- <link rel="stylesheet" href="<?= base_url('captcha_resources/captcha_gen.php') ?>">
  -->
        <table class="table table-bordered" style="width:100%; margin:0 auto;">
            <tr>
                <td colspan="3" style="text-align:center;" id="captchaContainer">
                 <img src=" <?= base_url('captcha/captcha_gen.jpg') ?>" alt="Captcha Image" style="width:100%; height:40px;">
                </td> 
               
            </tr>
            <tr>
                <td colspan="3" style="width:10%;">
                    <input type="text" value="<?= old('captcha_code') ?>" id="captcha_code" name="captcha_code"
                           placeholder="Enter Captcha Code" class="form-control" autocomplete="off"/>
                </td>
            </tr>
            <tr>
                <td colspan="11" style="text-align:center;">
                    <input name='submit' value="REFRESH" id="refresh" style="color:white;"
                           class="btn btn-danger btn-block"/>
                </td>
            </tr>
        </table>

        <div>
            <div class="checkbox-group">
                <input type="checkbox" id="agree" name="agree"  onchange="toggleRegisterButton()" required>
                <label for="agree">I agree to the terms and conditions</label>
            </div>
        </div>
        <div class="form-group" style="width: 100%;">
            <input type="submit" value="Register" id="registerButton" class="agree-unchecked" disabled>
        </div>
        <div class="container signin">
            <p>Already have an account? <a href="<?= base_url('/login') ?>">Sign in</a>.</p>
        </div>
    </form>
</div>
<script>
    
document.addEventListener("DOMContentLoaded", function() {
    // Fetch the captcha image URL from the controller
//    fetchCaptchaImage();

//     function fetchCaptchaImage() {
       
//         fetch("<?= base_url('captcha_generate') ?>")
//             .then(response => response.text())
//             .then(data => {
//                 //alert(data);
//                 //alert(data);
//                 // Update the content of the captcha container div with the captcha image tag
//                //  document.getElementById("captchaContainer").innerHTML = `<img src="${data}" alt="Captcha Image" style="width:100%; height:40px;">`;
//             })
//             .catch(error => {
//                 console.error("Error fetching captcha image:", error);
//             });
//     }
});

</script>
<script>
    $(document).ready(function () {
        $("#refresh").on('click', function () {
            location.reload();
        });
    });

    // Function to toggle Register button and save input values
    function toggleRegisterButton() {
        var agreeCheckbox = document.getElementById("agree");
        var registerButton = document.getElementById("registerButton");

        if (agreeCheckbox.checked) {
            registerButton.classList.remove("agree-unchecked");
            registerButton.classList.add("agree-checked");
            registerButton.disabled = false;
        } else {
            registerButton.classList.remove("agree-checked");
            registerButton.classList.add("agree-unchecked");
            registerButton.disabled = true;
        }
    }
</script>
</body>
</html>
