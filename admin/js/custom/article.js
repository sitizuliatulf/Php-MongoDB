$(document).ready(function() {
  $("textarea").wysihtml5();
});

$("input[type='file']").on("change", function(e) {
  if (e.target.files && e.target.files[0]) {
    var reader = new FileReader();
    reader.onload = function(result) {
      if ($("#wrapper-image > img").length > 0) {
        $("#wrapper-image > img").attr("src", result.target.result);
      } else {
        var html_image =
          '<img src="' +
          result.target.result +
          '" alt="gambar utama" style="width: 100%";></img>';
        $("#wrapper-image").append(html_image);
      }
      $('input[name="is_delete"]').val(0); // nandain kalau dia gak di delete
      $("#wrapper-image > div").css({ display: "none" });
    };
    reader.readAsDataURL(e.target.files[0]);
  }
});

$(".btn-danger").on("click", function(e) {
  if ($("#wrapper-image > img").length > 0) {
    $("#wrapper-image > img").remove();
  }
  $('input[name="is_delete"]').val(1); // nandain kalau di hapus
  $("#wrapper-image > div").css({ display: "block" });
  $('input[type="file"]').val("");
});
