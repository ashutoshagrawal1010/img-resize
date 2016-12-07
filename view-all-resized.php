<?php include_once("includes/header.inc.php"); ?>  
  <body>
    <?php include_once("includes/navbar.inc.php"); ?>

    <!-- Begin page content -->
    <div class="container">
      
      <div class="page-header">
        <h1>All Resized Images</h1>
      </div>
      
      <div class="row">
        <?php 
        $configs = (include "configs/image.php");
        $path = rtrim($configs["target_path"], "//");
        if (file_exists($path)) {
          $dir = new DirectoryIterator($path);
          foreach ($dir as $fileinfo) {
            if (!$fileinfo->isDot()) {
        ?>
        <div class="col-sm-6">
          <div class="thumbnail">
            <img src="<?php echo $path."/".$fileinfo->getFilename(); ?>">
            <div class="caption">
              <p class="text-center"><?php echo $fileinfo->getFilename(); ?></p>
            </div>
          </div>
        </div>
        <?php
            }
          }
        } 
        ?>
      </div>
    
    </div>

    <?php include_once("includes/footer.inc.php"); ?>

  </body>
</html>