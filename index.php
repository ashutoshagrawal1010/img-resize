<?php include_once("includes/header.inc.php"); ?>  
  <body>
    <?php include_once("includes/navbar.inc.php"); ?>

    <!-- Begin page content -->
    <div class="container">
      <div id="processing" class="alert alert-info alert-dismissible" role="alert">
        Uploading your image... Please wait...
      </div>
      
      <div id = "successful" class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        Upload Successful
      </div>
      <div class="page-header">
        <h1>Upload Image</h1>
      </div>
      <form id = "imageUploadForm" enctype="multipart/form-data">
        <div class="form-group">
          <label for="image">Select Image</label>
          <input type="file" id="image" name = "image">
        </div>
        <button id = "submit" type="submit" class="btn btn-primary">Submit</button>
        <button id = "reset" type="reset" class="btn btn-default">Reset</button>
      </form>
    </div>

    <?php include_once("includes/footer.inc.php"); ?>
    
    <script type="text/javascript" src="assets/js/upload.js"></script>

  </body>
</html>