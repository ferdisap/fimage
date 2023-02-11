<?php 

namespace Fimage;

class ImageResizer {

  private $filterType = \Imagick::FILTER_LANCZOS;

  /**
   * @param string $imagePath
   * @param int $width
   * @param \Imagick $filterType
   * @param int $blur
   * @param bool $bestFit
   * @return true if success
   * @return false if failure
   */
  public static function resizeToWidth($imagePath, $width, $filterType = null, $blur = 1, $bestFit = false)
  {
    $im = new \Imagick($imagePath);
    $height = (int) ($im->getImageHeight() * ($width /  $im->getImageWidth()));
    $im->resizeImage($width, $height, $filterType ?? self::$filterType, $blur, $bestFit);
    return $im->writeImage($imagePath) ?? false;
  }

  /**
   * @param string $format
   * @param string $imagePath relative of your app
   * @param string $storePath
   */
  public static function setFormat($format, $imagePath, $storePath)
  {
    $im = new \Imagick($imagePath);
    if ($im->getImageFormat() == $format) {
      return false;
    }
    $im->setImageFormat($format);
    return $im->writeImageFile(fopen($storePath, "wb")) ?? false;
  }
}