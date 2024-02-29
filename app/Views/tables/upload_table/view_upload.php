<?php
    // Retrieve the 'user' session variable
    $user = session('user');        
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <title>Display File</title>
<style>
    * {
    margin:0px;
    padding:0px;
}
</style>
</head>
<body>
        <?php if ($extension === 'pdf'): ?>
            <!-- <div><?php echo $extension ?></div> -->
            <iframe src='<?=  base_url('/view_upload/view_pdf.php') ?>' width="100%" height='900px' frameborder='0'></iframe>
        <?php elseif ($extension === 'png' || $extension === 'jpg' || $extension === 'jpeg'): ?>
            <iframe src='<?=  base_url('/view_upload/view_image.php') ?>' width="100%" height='900px' frameborder='0'></iframe>
        <?php elseif ($extension === 'docx'): ?>
            <iframe src='<?=  base_url('/view_upload/view_docx.php') ?>' width="100%" height='900px' frameborder='0'></iframe>
        <?php else : ?> 
            <div>
                <h1>Unsupported file type.</h1>
            </div>
        <?php endif; ?>
</body>
</html>