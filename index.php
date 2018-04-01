<?php
	include "fractal.class.php";
	header ("Content-type: image/jpeg");
	
	$f = new Fractal(600, 400);  
	$startAngle = 0;
  $startLength = 150;
  $startPointX = 50;
  $startPointY = $startLength*2;
  $levels = $_POST["level"];
  
  $lastPointX=0;
  $lastPointY=0;
  
  $f->DrawLevels($startPointX, $startPointY, $startAngle, $startLength, $levels, &$lastPointX, &$lastPointY);
  $f->GiveImage();
?> 
