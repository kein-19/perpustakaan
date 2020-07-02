// $(function () {

// 	$('.tombolAddBuku').on('click', function () {
// 		$('#newBukuModalLabel').html('Add New Buku');
// 		$('.modal-footer button[type=submit]').html('Add');
// 		$('#buku').val('');
// 		$('#id').val('');
// 	});


// 	$('.tampilBuku').on('click', function () {

// 		$('#newBukuModalLabel').html('Edit Buku');
// 		$('.modal-footer button[type=submit]').html('Edit');
// 		$('.modal-body form').attr('action', 'http://localhost/perpustakaan/buku/edit');

// 		const id = $(this).data('id');
// 		// console.log(id);

// 		$.ajax({
// 			url: 'http://localhost/perpustakaan/buku/gedit',
// 			data: {
// 				id: id
// 			},
// 			method: 'post',
// 			dataType: 'json',
// 			success: function (data) {
// 				// console.log(data);
// 				$('#buku').val(data.buku);
// 				$('#id').val(data.id);
// 			}
// 		});

// 	});

// });


const buku = $('.buku').data('buku');
if (buku == 'ditambahkan') {
	Swal.fire({
		title: 'Buku',
		text: 'Data buku berhasil ' + buku,
		icon: 'success'
	});
} else if (buku == 'diubah') {
	Swal.fire({
		title: 'Buku',
		text: 'Buku berhasil ' + buku,
		icon: 'success'
	});
} else if (buku == 'dihapus') {
	Swal.fire({
		title: 'Buku',
		text: 'Buku berhasil ' + buku,
		icon: 'success'
	});
} else if (buku) {
	Swal.fire({
		title: 'Buku',
		html: buku,
		icon: 'warning'
	});
}


// tombol-hapus
$('.tombol-bukuhapus').on('click', function (e) {

	e.preventDefault();
	const href = $(this).attr('href');

	Swal.fire({
		title: 'Apakah anda yakin',
		text: "buku akan dihapus",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Hapus Buku!'
	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		}
	})

});
