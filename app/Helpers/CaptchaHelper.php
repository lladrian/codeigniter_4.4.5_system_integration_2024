<?php
// In app/Helpers/CaptchaHelper.php
namespace App\Helpers;

class CaptchaHelper
{
  
    public static function generateCaptcha() {
        $session = session();

        // Generate a captcha of length 6
        $random_alpha = md5(rand());
        $captcha_code = substr($random_alpha, 0, 6);

        // Store the captcha code in a session variable
        $session->set('captcha_code', $captcha_code);

        $target_layer = imagecreatetruecolor(170, 50);
        /* Background color of captcha */
        $captcha_background = imagecolorallocate($target_layer, 255, 255, 255);
        imagefill($target_layer, 0, 0, $captcha_background);
        /* Captcha Text Color RGB */
        $captcha_text_color = imagecolorallocate($target_layer, 39, 55, 70);

        /* Text size and properties */
        $font_size = 32;
        $img_width = 80;
        $img_height = 48;
        /** For Lines */
        $line_color = imagecolorallocate($target_layer, 64, 64, 64);
        for ($i = 0; $i < 6; $i++) {
            imageline($target_layer, 0, rand() % 50, 200, rand() % 50, $line_color);
        }

        /* For pixels */
        $pixel_color = imagecolorallocate($target_layer, 0, 0, 255);
        for ($i = 0; $i < 1000; $i++) {
            /** width and height of text image rand() */
            imagesetpixel($target_layer, rand() % 200, rand() % 50, $pixel_color);
        }
        /* Text Size */
        /* you are the one is a font file */

        $font_file = FCPATH . 'captcha_resources/Xpressive Bold.ttf';

        // Render the captcha text onto the image
        imagettftext($target_layer, $font_size, 0, 25, 35, $captcha_text_color, $font_file, $captcha_code);

        // Set the path where you want to save the captcha image

        //$captcha_path = FCPATH;
         $captcha_path = FCPATH . 'captcha/' ;
        // echo   $captcha_path;
         // Create the captcha directory if it doesn't exist
         if (!is_dir($captcha_path)) {
            mkdir($captcha_path, 0777, true);
        }

        // Generate a unique filename for the captcha image
        $captcha_filename = 'captcha_gen.jpg';

        // Save the captcha image
        imagejpeg($target_layer, $captcha_path . $captcha_filename);

        // Destroy the image to free up memory
        imagedestroy($target_layer);

        //return  'captcha/' . $captcha_filename;
        // Output the captcha image path for use in the view
        //return $captcha_path . $captcha_filename;


    }

}


?>