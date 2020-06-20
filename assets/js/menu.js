$(function () {

	$('.tombolAddMenu').on('click', function () {
		$('#newMenuModalLabel').html('Add New Menu');
		$('.modal-footer button[type=submit]').html('Add');
		$('#menu').val('');
		$('#id').val('');
	});


	$('.tampilMenu').on('click', function () {

		$('#newMenuModalLabel').html('Edit Menu');
		$('.modal-footer button[type=submit]').html('Edit');
		$('.modal-body form').attr('action', 'http://localhost/perpustakaan/menu/edit');

		const id = $(this).data('id');
		// console.log(id);

		$.ajax({
			url: 'http://localhost/perpustakaan/menu/gedit',
			data: {
				id: id
			},
			method: 'post',
			dataType: 'json',
			success: function (data) {
				// console.log(data);
				$('#menu').val(data.menu);
				$('#id').val(data.id);
			}
		});

	});

});


const menu = $('.menu').data('menu');
if (menu == 'ditambahkan') {
	Swal.fire({
		title: 'Menu',
		text: 'Menu baru berhasil ' + menu,
		icon: 'success'
	});
} else if (menu == 'diubah') {
	Swal.fire({
		title: 'Menu',
		text: 'Menu berhasil ' + menu,
		icon: 'success'
	});
} else if (menu == 'dihapus') {
	Swal.fire({
		title: 'Menu',
		text: 'Menu berhasil ' + menu,
		icon: 'success'
	});
} else if (menu) {
	Swal.fire({
		title: 'Menu',
		html: menu,
		icon: 'warning'
	});
}


// tombol-hapus
$('.tombol-menuhapus').on('click', function (e) {

	e.preventDefault();
	const href = $(this).attr('href');

	Swal.fire({
		title: 'Apakah anda yakin',
		text: "menu akan dihapus",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Hapus Menu!'
	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		}
	})

});
