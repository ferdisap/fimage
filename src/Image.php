<?php

namespace Fimage;

class Image extends \Imagick
{
  public $editor;
  public $path;
  public $height;
  public $width;

  public function __construct($path)
  {
    $this->path = $path;
    return $this->proccessor();
  }
  private function proccessor()
  {
    return $this->editor = new \Imagick($this->path);
  }
}
