<?php 

namespace Fimage;

use \Fimage\Image;

class Resizer {

  private static $filterType = Image::FILTER_LANCZOS;
  public $image;  

  /**
   * @param mix \Fimage\Image or string of $imagePath
   * @param int $width
   * @param \Imagick $filterType
   * @param int $blur
   * @param bool $bestFit
   * @return \Fimage\Image if success
   * @return false if failure
   */
  public static function resizeToWidth($imagePath, $width, $filterType = null, $blur = 1, $bestFit = false)
  {
    if ($imagePath instanceof Image) {
      $im = $imagePath;
      $imagePath = $imagePath->path;
    } else {
      $im = new Image($imagePath);
    }
    $height = (int) ($im->editor->getImageHeight() * ($width /  $im->editor->getImageWidth()));
    if ($im->editor->resizeImage($width, $height, $filterType ?? self::$filterType, $blur, $bestFit)){
      $im->width = $width;
      $im->height = $height;
      return $im->editor->writeImage($imagePath) ? $im : false;      
    }
    return false;
  }
  
  // /**
  //  * @param string $imagePath
  //  * @param int $width
  //  * @param \Imagick $filterType
  //  * @param int $blur
  //  * @param bool $bestFit
  //  * @return true if success
  //  * @return false if failure
  //  */
  // public static function resizeToWidth($imagePath, $width, $filterType = null, $blur = 1, $bestFit = false)
  // {
  //   $im = new \Imagick($imagePath);
  //   $height = (int) ($im->getImageHeight() * ($width /  $im->getImageWidth()));
  //   $im->resizeImage($width, $height, $filterType ?? self::$filterType, $blur, $bestFit);
  //   return $im->writeImage($imagePath) ?? false;
  // }

  // /**
  //  * @param string $format
  //  * @param string $imagePath relative of your app
  //  * @param string $storePath
  //  */
  // public static function setFormat($format, $imagePath, $storePath)
  // {
  //   $im = new \Imagick($imagePath);
  //   $im->setImageFormat($format);
  //   return $im->writeImageFile(fopen($storePath, "wb")) ?? false;
  // }
  
}