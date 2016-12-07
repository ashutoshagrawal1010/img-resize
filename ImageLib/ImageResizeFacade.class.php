<?php
namespace ImageLib;

use ImageLib\ImageResizer;

class ImageResizeFacade {
    
    private $targetWidth;
    
    private $targetHeight;
    
    private $targetPath;
    
    public function __construct() {
        $config = (include(__DIR__."/../configs/image.php"));
        $this->targetWidth = $config["final_width"];
        $this->targetHeight = $config["final_height"];
        $this->targetPath = $config["target_path"];
        if (!file_exists($this->targetPath)) {
            mkdir(__DIR__."/../".$this->targetPath, 0777, true);
        }
    }
    
    public function resizeAndSave($sourcePath, $targetName) {
        $image = new ImageResizer($sourcePath);
        $image->resize($this->targetWidth, $this->targetHeight)->save($this->targetPath.$targetName);
    }
}