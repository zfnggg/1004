<?php
//Initialise image with dimensions of 120 x 30 pixels
$image = @imagecreatetruecolor(120, 30) or die("Cannot Initialize new GD image stream");

//Set background and allocate drawing colours
$background = imagecolorallocate($image, 0x66, 0x99, 0x66);
imagefill($image, 0, 0, $background);
$linecolor = imagecolorallocate($image, 0x99, 0xCC, 0x99);
$textcolor1 = imagecolorallocate($image, 0x00, 0x00, 0x00);
$textcolor2 = imagecolorallocate($image, 0xFF, 0xFF, 0xFF);

// draw random lines on canvas
for($i=0; $i < 6; $i++) {
  imagesetthickness($image, rand(1,3));
  imageline($image, 0, rand(0,30), 120, rand(0,30) , $linecolor);
}

session_start();

// add random digits to canvas using random black/white colour
$digit = '';
for($x = 15; $x <= 95; $x += 20) {
  $textcolor = (rand() % 2) ? $textcolor1 : $textcolor2;
  $digit .= ($num = rand(0, 9));
  imagechar($image, rand(3, 5), $x, rand(2, 14), $num, $textcolor);
}

// record digits in session variable
$_SESSION['captcha_code'] = $digit;

// display image and clean up
header('Content-type: image/png');
imagepng($image);
?>