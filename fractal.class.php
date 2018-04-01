<?php
class Fractal
{
  function Fractal($width, $height)
  {    
    $this->im = @ImageCreate($width, $height);
    $this->background_color = ImageColorAllocate ($this->im, 0, 0, 0);
    $this->text_color = ImageColorAllocate ($this->im, 255, 255, 255);    
  }
  
	  
  function Draw($startPointX, $startPointY, $length, $angle, &$lastPointX, &$lastPointY)
  {
      $endX = $length * cos($angle * (double)180 / pi()) + $startPointX;
      $endY = $length * sin($angle * (double)180 / pi()) + $startPointY;
      //die("end X = ".$endX);
      
      imageline($this->im, $startPointX, $startPointY, $endX, $endY, $this->text_color); 
      
      $lastPointX = $endX;
      $lastPointY = $endY;
  }
  
  function DrawLevels($startX, $startY, $startAngle, $startLength, $levels, &$lastPointX, &$lastPointY)
  {
    $angle = $startAngle;
    $lastPointX=0;
    $lastPointY=0;
        
    if($levels == 0)
    {        
        $this->Draw($startX, $startY, $startLength, $angle, &$lastPointX, &$lastPointY);
        
        $angle -= 60;
        $this->Draw($lastPointX, $lastPointY, $startLength, $angle, &$lastPointX, &$lastPointY);
        $angle -= -120;
        $this->Draw($lastPointX, $lastPointY, $startLength, $angle, &$lastPointX, &$lastPointY);
        $angle -= 60;
        $this->Draw($lastPointX, $lastPointY, $startLength, $angle, &$lastPointX, &$lastPointY);
        
    }
    else
    {
          $tempLength = (double)$startLength / 3.333333;
          $tempPointX = $startX;
          $tempPointY = $startY;
          
          $this->DrawLevels($tempPointX, $tempPointY, $angle, $tempLength, $levels - 1, &$lastPointX, &$lastPointY);
          
          $tempPointX = $startLength * cos($angle * (double)180 / pi()) + $tempPointX;
          $tempPointY = $startLength * sin($angle * (double)180 / pi()) + $tempPointY;
          $angle -= 60;
          $this->DrawLevels($tempPointX, $tempPointY, $angle, $tempLength, $levels - 1, &$lastPointX, &$lastPointY);

          $tempPointX = $startLength * cos($angle * (double)180 / pi()) + $tempPointX;
          $tempPointY = $startLength * sin($angle * (double)180 / pi()) + $tempPointY;
          $angle -= -120;
          $this->DrawLevels($tempPointX, $tempPointY, $angle, $tempLength, $levels - 1, &$lastPointX, &$lastPointY);

          $tempPointX = $startLength * cos($angle * (double)180 / pi()) + $tempPointX;
          $tempPointY = $startLength * sin($angle * (double)180 / pi()) + $tempPointY;
          $angle -= 60;
          $this->DrawLevels($tempPointX, $tempPointY, $angle, $tempLength, $levels - 1, &$lastPointX, &$lastPointY);

    }
  }
  
  function GiveImage()
  {
      ImageJpeg($this->im);
  }
}
?>