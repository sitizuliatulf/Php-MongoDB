$(document).ready(function() {
  // fungsi untuk membuat checkbox menjadi icheck
  $('input[type="checkbox"]').icheck();
  // fungsi untuk membuat radio menjadi incheck
  $('input[type="radio"]').icheck();
});

//ini file js digunakan disemua page
$(".btn-logout").on("click", function(e) {
  var confirmation = confirm("Apakah kamu ingin keluar dari aplikasi ?");
  if (confirmation) {
    window.location.replace(base_url + "index/logout");
  }
});

$(".input-date").datepicker();
