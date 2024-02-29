<!-- edit_user.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Roles Permission</title>
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
    <h1 style="margin-bottom: 30px;">Update User Roles Permission</h1>
<div style="width:100%;">
        <div>
            <div class="form-group" style="width:100%;">
                <label for="firstname">First Name:</label>
                <span style="text-transform:capitalize;"><?= $user['firstname'] ?></span>
             </div>

             <div class="form-group" style="width:100%;">
                <label for="role_name">Role Name:</label>
                <span style="text-transform:capitalize;"><?= $user['role_name'] ?></span>
             </div>
                            
                       
            <div class="form-group" style="width:100%; ">
                <label  style="width:100%;">Role Permissions:</label>
                <div >
                   
                </div>
            </div> 
         
        </div>

            <div class="form-group" style="width:100%; display:inline-flex; flex-wrap: wrap; ">
                <?php if ($permissions_2) : ?>
                    <?php foreach ($permissions_2 as $permission) : ?>
                        <form method="POST" style=" margin:5px; color:white;" action="<?= base_url('/dashboard/user_permission/delete/'.$permission['id'].'/'.$user['id']) ?>">
                            <button type="submit"style="padding:10px; background:red; border-color:red;"><?= $permission['permission_name'] ?></button>
                            </form>
                    <?php endforeach ?>
                <?php endif ?>
            </div>
    
            <div class="form-group" style="width:100%;">
                <label for="category"  style="width:100%;">Permissions:</label>
                <form id="assign_form" style="width:100%;"  method="POST" action="<?= base_url('/dashboard/user_permission/store/'.$user['id']) ?>">
                    <select id="category" name="category"  style="width:100%; padding:10px; text-transform: capitalize; ">
                        <?php if ($permissions_1) : ?>
                            <?php foreach ($permissions_1 as $permission) : ?>
                                <option value="<?= $permission['id'] ?>" 
                                style="font-size:18px;  text-transform: capitalize;"> 
                                <?= $permission['permission_name'] ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif ?>
                    </select>
                    <div style="width:100%; margin-top:10px; "> 
                        <button style="width:100%; padding:10px; border-color:#4caf50; font-size:15px;  color:white;  background: #4caf50; " type="submit">Assign</button>
                    </div>                    
                </form>
            </div>
        <div class="form-group" style="width: 100%;">
            <a href="<?= base_url('/dashboard/users') ?>" style="font-size:20px;">BACK</a>
        </div>
</div>
</div>
<script>
    // Get the form element
    var form = document.getElementById('assign_form');


    // Add an event listener for the submit event
    form.addEventListener('submit', function() {
        // Reload the page after form submission
        setTimeout(function() {
            location.reload();
        }, 1000);
    });
</script>
</body>
</html>
