<!-- edit_user.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Comment Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?= base_url('fontawesome-free/css/all.min.css') ?>">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-Nj2EC7hAPojo1ssbK/xPO7tcZN4KLP3m1Jk+uYin2mxJXdO1/kt06vEdXmBlL3Fv" crossorigin="anonymous"> -->
    <script src="https://kit.fontawesome.com/bf7d389ac4.js" crossorigin="anonymous"></script>

    <style>
        * {
            box-sizing: border-box; /* Ensure padding is included in the width */
            padding: 0px;
            margin: 0px;
          
        }
        body {
            font-family: Arial, sans-serif;
            background-color: wheat;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .registration-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px 10px 0px 0px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 800px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;

        }
        .comment-form {
            border-top: 1px solid black;
            background-color: #fff;
            padding: 10px;
            border-radius: 0 0 10px 10px;
            width: 800px;
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

i {
    color:black;
}

        .form-group .checkbox-group {
            display: flex;
            align-items: center;
        }

        .form-group input[type="checkbox"] {
            margin-right: 5px;
        }
        textarea[readonly] {
            border-color: transparent; /* Set border color to transparent */
        }
        textarea[readonly]:focus {
            outline: none; /* Remove the default focus outline */
            border-color: transparent; /* Set border color to transparent on focus */
        }
        .ellipse-container {
                    display: inline-block; 
                    text-align: center; 
                    list-style-type: none;
                    margin-left: auto; 
        }
        .ellipse {
            margin-left: auto; 
                    font-size:20px; cursor:pointer; 
                    display: inline-block; 
                    width: 50px; 
                    height: 50px; 
                    border-radius: 50%; 
                    background-color: transparent; 
                    text-align: center; 
                    line-height: 50px;
        }
        .ellipse:hover {
            background-color: #ccc; 
        }
        .popup {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 20px;
        border: 1px solid #ccc;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        z-index: 9999;
    }
    .dropdown-menu > a:hover {
        background-color: #ccc; 
        color:black;

    }
    </style>
</head>
<body>
<?php
$index = 0;
// Original date string
$original_date_str = $upload['upload_date'];

// Create a DateTime object from the original date string
$original_date = new DateTime($original_date_str);

// Format the DateTime object into the desired format
$formatted_date_str = $original_date->format("F j, Y");

$currentURL = current_url(); 
?>
<a href="<?=  $currentURL; ?>" id="myLink" style="display:none;">Link Text</a>

<div>

    <div class="registration-form">               
        <div style="width:100%;">
            <div style="background:none; text-align:center;">
            <div class="form-group" style="width: 100%; margin-top:10px;">
                <a href="<?= base_url('/dashboard/uploads') ?>" style="font-size:20px;">BACK</a>
            </div>
                <?php if (isset($user['firstname']) && isset($user['lastname'])) : ?>
                    <span style="text-transform: capitalize; text-align:center; font-weight:bold; font-size:40px;">
                        <span>
                            <?= $user['firstname']; ?> 
                            <?= $user['lastname']; ?>
                        </span>
                        <span>
                             -
                        </span>
                        <span>
                            <?= $formatted_date_str; ?>
                        </span>                                                 
                    </span>
                <?php endif; ?>
            </div>
            <div>
            <?php if ($extension === 'pdf'|| $extension === 'jpg' || $extension === 'jpeg' || $extension === 'png'): ?>
                <form method="get" style="width:100%; padding:0px 20px 0px 20px;" action="<?= base_url('/dashboard/upload/view_upload_id/'.$upload['id']) ?>">
                    <button type="submit"  style="width:100%;" class="btn  btn-success ">VIEW</button>
                </form> 
            <?php elseif ($extension === 'docx' || $extension === 'zip' || $extension === 'rar'): ?>
                <form method="get" style="width:100%; padding:0px 20px 0px 20px;" action="<?= base_url('/dashboard/upload/view_upload_id/'.$upload['id']) ?>">
                    <button type="submit" disabled style="width:100%;" class="btn  btn-success ">VIEW</button>
                </form> 
            <?php endif; ?> 
                <div style="width:100%; padding:0px 20px 0px 20px; margin-top:5px;">
                <button style="width:100%;"  onclick="copyLink()"  class="btn  btn-info ">COPY LINK</button>

                </div>
             
             
            </div>
            <!-- <div style="margin-top: 15px;">
                <?php if (isset($upload['file_name'])) : ?>
                    <span>Current file: <?= $upload['file_name']; ?></span>
                <?php endif; ?>
            </div> -->
            <!-- <h1 style="margin-bottom: 15px;">Comment Form</h1> -->
        </div>
 
    </div>
 
    <div class="comment-form">
        <div style="width: 100%; display:block;">
            <?php foreach ($comments as $comment): ?>
             <div  style="width: 100%; display:inline-flex; justify-content:start; align-items:start;">             
                <img class="img-profile rounded-circle" style="height: 40px;" src="<?= base_url('img/undraw_profile.svg') ?>">
                <div style="width: 100%;">
                    <div style="display: flex; align-items: center; justify-content:center;">
                    <?php
                    // Original date string
                    $original_date_str = $comment['created_at'];

                    // Create a DateTime object from the original date string
                    $original_date = new DateTime($original_date_str);

                    // Format the DateTime object into the desired format
                    $formatted_date_str = $original_date->format("F j, Y");

                    $currentURL = current_url(); 
                    ?>
                        <p style="margin-left: 20px; font-weight: bold; font-size: 15px;">
                            <span style="text-transform:capitalize;"><?=$comment['firstname']?>  <?=$comment['lastname']?>  </span> 
                            - 
                            <span style="text-transform:capitalize;"><?=$formatted_date_str;?> </span> 
                        </p>
                        <!-- Popup Box -->
                        <!-- <span class="ellipse" onclick="showPopup()">
                            <i class="fas fa-light fa-ellipsis-vertical"></i>
                        </span> -->
                        <ul class="navbar-nav ml-auto ellipse-container">
                            <li class="nav-item dropdown no-arrow" >
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="ellipse" onclick="showPopup()">
                                                <i class="fas fa-light fa-ellipsis-vertical"></i>
                                                </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown" style="background: transparent;">
                                    <!-- <div class="dropdown-item" style="width:100%;">
                                         <form method="get" style="width:100%;" action="<?= base_url('/dashboard/upload/comment/edit/'.$comment['id']) ?>">
                                            <button type="submit" style="width:100%;   border-radius: 0px;" class="btn  btn-info">EDIT</button>
                                        </form> 
                                        <button onclick="editTextarea(<?= $index; ?>)">Edit</button>
                                    </div> -->
                                    <!-- <a class="dropdown-item" style="display:block; font-size:18px; text-align:start; text-decoration: none;"  href="#">
                                        EDIT
                                    </a> -->
                                    <div class="dropdown-item" style="width:100%;">
                                        <form method="post" style="width:100%;" action="<?= base_url('/dashboard/upload/comment/delete/'.$comment['id'].'/'.$upload['id']) ?>">
                                            <button type="submit" style="width:100%;   border-radius: 0px;" class="btn  btn-danger">DELETE</button>
                                        </form> 
                                    </div>
                                    <!-- <a class="dropdown-item" style="display:block; font-size:18px; text-align:start; text-decoration: none;" href="#">
                                        DELETE
                                    </a> -->

                                    <div class="dropdown-item" style="width:100%;">
                                     <!-- <form method="post" style="width:100%;" action="<?= base_url('/dashboard/upload/comment/copy_link/'.$comment['id']) ?>"> -->

                                        <!-- <form method="post" style="width:100%;" action="#"> -->
                                            <!-- <button onclick="copyLink()"  style="width:100%;   border-radius: 0px;" class="btn  btn-info">COPY LINK</button> -->
                                        <!-- </form>  -->
                                    </div>
                                    <!-- <a class="dropdown-item" style="display:block;  font-size:18px; text-align:start; text-decoration: none;" href="#">
                                        Copy Link
                                    </a> -->
                                </div>
                            </li>
                        </ul>
                    </div>
                            <textarea 
                            id='myTextarea<?= $index; ?>'
                            name='myTextarea<?= $index; ?>'
                            readonly
                            style=" 
                            text-indent: 20px; 
                            display:inline-flex; 
                            justify-content:start; 
                            border-color:transparent; 
                            align-items:start;  
                            padding:0px 20px 20px 20px;
                            border-radius: 20px; 
                            overflow: hidden; 
                            width: 95%; 
                            resize: none;   
                            height: 100px;">
                            </textarea>
                        <script>
                            // Function to adjust textarea height based on content
                            function adjustTextareaHeight() {
                                const textarea = document.getElementById('myTextarea<?= $index; ?>');
                                textarea.style.height = 'auto'; // Reset height to auto to allow it to shrink
                                textarea.style.height = textarea.scrollHeight + 'px'; // Set the height to match the content
                            }

                            // Function to populate textarea with value and adjust height
                            function populateTextareaAndAdjustHeight(value) {
                                const textarea = document.getElementById('myTextarea<?= $index; ?>');
                                textarea.value = value; // Set the value
                                adjustTextareaHeight(); // Adjust height based on content
                            }

                            // Example of fetching value from server (replace this with your actual data fetching mechanism)
                            const fetchedValue<?= $index; ?> = "<?= $comment['comments']; ?>";
                        //    var trimmedString = "<?= $comment['comments']; ?>".trim();
                        //    let chunkedText = chunkText("<?= $comment['comments']; ?>", 50);
                            populateTextareaAndAdjustHeight(fetchedValue<?= $index; ?>);
                       

                            function chunkText(text, chunkSize) {
                                // Split the text into an array of words
                                let words = text.split(' ');

                                let chunks = [];
                                let currentChunk = '';

                                // Iterate through the words and group them into chunks
                                for (let i = 0; i < words.length; i++) {
                                    // Add the current word to the current chunk
                                    currentChunk += words[i] + ' ';

                                    // If the current chunk reaches the desired size or we're at the end of the text
                                    if (currentChunk.length >= chunkSize || i === words.length - 1) {
                                        // Push the current chunk to the chunks array
                                        chunks.push(currentChunk.trim());

                                        // Reset the current chunk
                                        currentChunk = '';
                                    }
                                }

                                return chunks;
                            }

                        </script>
                </div>
            </div> 
        <?php $index++;?>
        <?php endforeach; ?>
        </div>
        <form id="commentForm1" method="post" action="<?= base_url('/dashboard/upload/comment_upload_post/'.$upload['id']) ?>"  style="width: 100%; display:flex; justify-content:center; align-items:center;">
            <img class="img-profile rounded-circle" style="height: 40px; padding-right:10px;" src="<?= base_url('img/undraw_profile.svg') ?>">
            <textarea id="comment" placeholder="comment here" name="comment"  style="padding:15px; border-radius: 20px; overflow: hidden; width: 95%; resize: none;  height: 50px;"></textarea>
       
            <button style=" border: 1px solid transparent; background:transparent;
 writing-mode: vertical-lr; transform: rotate(0deg); font-size:20px; font-weight:bold;">SUBMIT</button>
        </form>
        <div style="text-align: center; width:100%;">
        <?php if (session()->has('errors')) : ?>
                    <?php foreach (session('errors') as $error) : ?>
                        <?php if (strpos($error, 'comment') !== false) : ?>
                            <span  style="text-align: center;" class="text-danger"><?= esc($error) ?></span>
                        <?php endif ?>
                    <?php endforeach ?>
                <?php endif ?>
        </div>
    </div>
</div>


<script>
        function copyLink() {
            // Get the link element
            var link = document.getElementById("myLink");
            
            // Create a temporary input element
            var tempInput = document.createElement("input");
            tempInput.value = link.href;
            document.body.appendChild(tempInput);
            
            // Select the link's text
            tempInput.select();
            tempInput.setSelectionRange(0, 99999); /*For mobile devices*/
            
            // Copy the text to the clipboard
            document.execCommand("copy");
            
            // Remove the temporary input
            document.body.removeChild(tempInput);
            
            // Alert the user that the link has been copied (optional)
            alert("Link copied!");
        }
    </script>

<script>
// Get the textarea element
var textarea = document.getElementById('comment');
// Add an event listener for input changes
textarea.addEventListener('input', function() {
  // Set the height of the textarea to auto to adjust its height based on content
  this.style.height = 'auto';
  // Set the height to the scrollHeight of the textarea to fit all the content
  this.style.height = this.scrollHeight + 'px';
});
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

            // // Function to adjust textarea height based on content
            // function adjustTextareaHeight() {
            //     const textarea = document.getElementById('myTextarea');
            //     textarea.style.height = 'auto'; // Reset height to auto to allow it to shrink
            //     textarea.style.height = textarea.scrollHeight + 'px'; // Set the height to match the content
            // }

            // // Function to populate textarea with value and adjust height
            // function populateTextareaAndAdjustHeight(value) {
            //     const textarea = document.getElementById('myTextarea');
            //     textarea.value = value; // Set the value
            //     adjustTextareaHeight(); // Adjust height based on content
            // }

            // // Example of fetching value from server (replace this with your actual data fetching mechanism)
            // const fetchedValue = "This is a long text that will fill the textarea. This text will make the textarea adjust its height dynamically.This text will make the textarea adjust its height dynamically.This text will make the textarea adjust its height dynamically.This text will make the textarThis text will make the textarea adjust its height dynamically.This text will make the textarea adjust its height dynamically.This text will make the textarea adjust its height dynamically.This text will make the This text will make the textarea adjust its height dynamically.This text will make the textarea adjust its height dynamically.This text will make the textarea adjust its height dynamically.This text will make the textarea adjust its height dynamically.This text will make the textarea adjust its height dynamically.This text will make the textarea adjust its height dynamically.This text will make the textarea adjust its height dynamically.This text will make the textarea adjust its height dynamically.This text will make the textarea adjust its height dynamically.This text will make the textarea adjust its height dynamically.This text will make the textarea adjust its height dynamically.This text will make the textarea adjust its height dynamically.This text will make the textarea adjust its height dynamically.This text will make the textarea adjust its height dynamically.This text will make the textarea adjust its height dynamically.This text will make the textarea adjust its height dynamically.This text will make the textarea adjust its height dynamically.This text will make the textarea adjust its height dynamically.This text will make the textarea adjust its height dynamically.This text will make the textarea adjust its height dynamically.This text will make the textarea adjust its height dynamically.This text will make the textarea adjust its height dynamically. textarea adjust its height dynamically.ea adjust its height dynamically.";
            // populateTextareaAndAdjustHeight(fetchedValue);
        </script>

</body>
</html>
