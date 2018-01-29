$(document).ready(function() {
  $("input").iCheck({
    checkboxClass: "icheckbox_minimal",
    radioClass: "iradio_minimal",
    increaseArea: "20%" // optional
  });
});

//ini file js digunakan disemua page
$(".btn-logout").on("click", function(e) {
  var confirmation = confirm("Apakah kamu ingin keluar dari aplikasi ?");
  if (confirmation) {
    window.location.replace(base_url + "index/logout");
  }
});

$("#check-all").on("ifChecked", function(e) {
  $('input[type="checkbox"]').iCheck("check");
});

$("#check-all").on("ifUnchecked", function(e) {
  $('input[type="checkbox"]').iCheck("uncheck");
});

$(".input-date").datepicker();
