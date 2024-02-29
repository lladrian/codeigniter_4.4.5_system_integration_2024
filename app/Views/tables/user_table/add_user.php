<!-- edit_user.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?= base_url('fontawesome-free/css/all.min.css') ?>">
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
<body>
    <div class="registration-form">
    <h1 style="margin-bottom: 30px;">Register Form</h1>
    
    <form id="reg_form" method="POST" action="<?= base_url('/dashboard/user/store') ?>">
        <div>
            <div class="form-group">
                <label for="firstname">Firstname:</label>
                <input type="text" id="fname" name="fname" value="<?= old('fname') ?>" placeholder="Enter Firstname">
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
                <input type="text" id="lname" name="lname" value="<?= old('lname') ?>" placeholder="Enter Lastname">
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
                <input type="text" id="uname" name="uname" value="<?= old('uname') ?>" placeholder="Enter Username">
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
                <input type="email" id="email" name="email" value="<?= old('email') ?>" placeholder="Enter Email Address">
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
                        <option value="<?= $role['id'] ?>" <?= ($role['status'] == 1) ? $role['role_name'] : ' (Inactive)' ?> style="<?= ($role['status'] == 1) ? 'color:black;' : 'color:red;' ?> font-size:18px;  text-transform: capitalize;"> <?= ($role['status'] == 1) ? $role['role_name'] : $role['role_name'] . ' (Inactive)' ?></option>
                    <?php endforeach; ?>
                </select>
         
            </div>
            <div class="form-group" style="display: none;">
            </div>
        </div>

        <div class="form-group" style="width: 100%;">
            <input type="submit" value="INSERT DATA "   >
        </div>
        <div class="form-group" style="width: 100%;">
            <a href="<?= base_url('/dashboard/users') ?>" style="font-size:20px;">BACK</a>
        </div>
    </form>
</div>
            
</body>
</html>
