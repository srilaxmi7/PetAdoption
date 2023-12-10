<?php
session_start();

// Function to generate a random string for the CAPTCHA
function generateCaptchaText($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $captchaText = '';
    for ($i = 0; $i < $length; $i++) {
        $captchaText .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $captchaText;
}

// Generate a random string for the CAPTCHA
$captchaText = generateCaptchaText();

// Save the CAPTCHA text in a session variable for validation
$_SESSION['captcha'] = $captchaText;

// Create an image with the CAPTCHA text
$imageWidth = 150;
$imageHeight = 50;
$image = imagecreate($imageWidth, $imageHeight);
$backgroundColor = imagecolorallocate($image, 255, 255, 255);
$textColor = imagecolorallocate($image, 0, 0, 0);

imagestring($image, 5, 50, 20, $captchaText, $textColor);

// Set the content type to image
header('Content-type: image/png');

// Output the image as PNG
imagepng($image);

// Free up memory
imagedestroy($image);
?>
