<?php
session_start();
$ranStr = md5(microtime());
$ranStr = substr($ranStr, 0, 6);
$_SESSION['cap_code'] = $ranStr;
$newImage = imagecreatefrompng("cap_bg.png");

$txtColor = imagecolorallocate($newImage, 0, 0, 0);

// Replace path by your own font path
$font = '/usr/share/fonts/truetype/msttcorefonts/Verdana.ttf';

// Add the text
imagettftext($newImage, 20, 0, 10, 40, $txtColor, $font, $ranStr);

// imagestring($newImage, 5, 5, 5, $ranStr, $txtColor);
header("Content-type: image/png");
// imagejpeg($newImage);

// Using imagepng() results in clearer text compared with imagejpeg()
imagepng($newImage);
imagedestroy($newImage);