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
    <h1 style="margin-bottom: 30px;">CREATE ROLE</h1>
    
    <form id="reg_form" method="POST" action="<?= base_url('/dashboard/role/store') ?>">
        <div>
            <div class="form-group" style="width:100%;">
                <label for="firstname">Role Name:</label>
                <input type="text" style="text-transform:lowercase;" id="role_name" name="role_name"  placeholder="Enter Role">
                <?php if (session()->has('errors')) : ?>
                    <?php foreach (session('errors') as $error) : ?>
                        <?php if (strpos($error, 'role_name') !== false) : ?>
                            <span class="text-danger"><?= esc($error) ?></span>
                        <?php endif ?>
                    <?php endforeach ?>
                <?php endif ?>
            </div>
                            
            <div class="form-group" style="width:100%; ">
                <label for="category"  style="width:100%;">Status:</label>
                <select id="category" name="category"  style="width:100%; padding:10px; text-transform: capitalize; ">
                        <option value="1" selected>Active</option>
                        <option value="0"> Inactive</option>
                </select> 
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
