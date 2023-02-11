<?php 

namespace Fimage;


use \Fimage\Image;

class Formatter extends Image {
  
  // /**
  //  * @param string $format
  //  * @param string $imagePath relative of your app
  //  * @param string $storePath
  //  */
  public static function reFormat($format, $imagePath, $storePath)
  {
    if ($imagePath instanceof Image) {
      $im = $imagePath;
    } else {
      $im = new Image($imagePath);
    }
    if ($im->editor->setImageFormat($format)){
      if ($im->editor->writeImageFile(fopen($storePath, "wb"))) {
        $im->path = $storePath;
        return $im;
      }
    }
    return false;
  }

}