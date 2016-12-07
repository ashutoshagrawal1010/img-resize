function validate(fileName) {
    if (!fileName || !$.trim(fileName)) {
      alert("Please select a file");
      return false;
    }
    var fileExt = fileName.split(".").pop().toLowerCase();
    var extCheck = $.inArray(fileExt, ["jpg", "jpeg", "png"]);
    if (extCheck == -1) {
      alert("Only jpg/jpeg/png extensions allowed");
      $("#image").val('');
      return false;
    }
    
    return true;
}
    
$(document).ready(function() {

    $("#processing").hide();
    $("#successful").hide();
    
    $("#imageUploadForm").on("submit", function(e) {
      e.preventDefault();
      $("#successful").hide();
      var fileName = $("#image").val().split("\\").pop();
      
      if(!validate(fileName)) {
        return;
      }
      
      $("#processing").show();
      $("#submit").prop("disabled", true);
      $("#reset").prop("disabled", true);
      
      $.ajax({
        url: "upload.php",
        type: "POST",
        data: new FormData(this),
        cache: false,
        processData: false,
        contentType: false,
        success: function(data) {
          $("#processing").hide();
          $("#successful").html(data).show();
          $("#submit").prop("disabled", false);
          $("#reset").prop("disabled", false);
        }
      }); //End AJAX
      
    });

});
