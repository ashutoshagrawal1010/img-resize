<?php

namespace ImageLib;

class ImageResizer {
    private $sourceWidth;
    
    private $sourceHeight;
    
    private $sourceImageType;
    
    private $sourceImage;
    
    private $targetWidth;
    
    private $targetHeight;
    
    /**
     * Initializes the image parameters.
     * Creates image resource from the given path.
     */
    public function __construct($name) {
        $info = getimagesize($name);
        if(!$info) {
            throw new Exception('Image file could not be read');
        }
        list($this->sourceWidth, $this->sourceHeight, $this->sourceImageType) = $info;
        
        switch ($this->sourceImageType) {
            case IMAGETYPE_JPEG:
                $this->sourceImage = imagecreatefromjpeg($name);
                break;
            case IMAGETYPE_PNG:
                $this->sourceImage = imagecreatefrompng($name);
                break;
            default:
                throw new Exception('Unsupported type');
                break;
        }
        
        if ($this->sourceImage == null) {
            throw new Exception('Some error occurred while loading image');
        }
    }
    
    
    /**
     * Calculates and sets the width and height of target image by maintaining the aspect ratio.
     * Does not change the width or height if the source image itself is small.
     */
    public function resize($width, $height) {
        if($width >= $this->sourceWidth && $height >= $this->sourceHeight) {
            $this->targetWidth = $this->sourceWidth;
            $this->targetHeight = $this->sourceHeight;
        } else {
            $w = $width * 1.0;
            $h = $height * 1.0;
            $ratio = max($this->sourceWidth/$width, $this->sourceHeight/$height);
            $this->targetWidth = ceil($this->sourceWidth/$ratio);
            $this->targetHeight = ceil($this->sourceHeight/$ratio);
        }
        return $this;
    }
    
    /**
     * Saves the image at the given path
     */
    public function save($name) {
        $targetImage = imagecreatetruecolor($this->targetWidth, $this->targetHeight);
        switch ($this->sourceImageType) {
            case IMAGETYPE_JPEG:
                $background = imagecolorallocate($targetImage, 255, 255, 255);
                imagefilledrectangle($targetImage, 0, 0, $this->targetWidth, $this->targetHeight, $background);
                break;
            case IMAGETYPE_PNG:
                imagealphablending($targetImage, false);
                imagesavealpha($targetImage, true);
                break;
        }
        imagecopyresampled(
            $targetImage, $this->sourceImage, 
            0, 0, 0, 0, 
            $this->targetWidth, $this->targetHeight , $this->sourceWidth, $this->sourceHeight
        );
        
        switch ($this->sourceImageType) {
            case IMAGETYPE_JPEG:
                imagejpeg($targetImage, $name);
                break;
            case IMAGETYPE_PNG:
                imagepng($targetImage, $name);
                break;
        }
        imagedestroy($targetImage);
    }
}