//ini file js digunakan disemua page
$('.btn-logout').on('click', function(e) {
    var confirmation = confirm('Apakah kamu ingin keluar dari aplikasi ?');
    if (confirmation) {
        window.location.replace(base_url + 'index/logout');
    }
});

$('.input-date').datepicker();