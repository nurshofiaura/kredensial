// event pada saat klik
$('.page-scroll').on('click', function (e) {
// ambil isi href
	var tujuan = $(this).attr('href');
	var elemenTujuan = $(tujuan);

	$('html, body').animate({
		scrollTop: elemenTujuan.offset().top -50
	}, 1250, 'easeInOutExpo');
	e.preventDefault();
});


$(document).ready(function() {

// hilangkan tombol cari
$('#tombol-cari').hide();

// event ketika keyword ditulis
$('#keyword').on('keyup', function() {
	// munculkan icon loading
	$('.loader').show();


	// ajax menggunkan load
	// $('#container').load('ajax/mahasiswa.php?keyword=' + $('#keyword').val());

	// $ GET()
	$.get('../../ajax/cari_tulisan.php?keyword=' + $('#keyword').val(), function(data) {
		$('#container').html(data);
		$('.loader').hide();
	});
});


// 	var keyword = document.getElementById('keyword');
// keyword.addEventListener('keyup', function() {
// console.log('ok');
// 	});
});

