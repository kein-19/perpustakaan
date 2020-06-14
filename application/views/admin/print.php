<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/print.css" rel="stylesheet">
    <!-- <link href="<?= base_url('assets/'); ?>css/print.css" rel="stylesheet" media="screen, print" /> -->

</head>

<!-- <body id="page-top" onload="print()"> -->

<body onload="window.print()">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-8">
                </div>
            </div>

            <div class="card mb-3">

                <div class="card-header ml-md-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-9 align-self-sm-center">
                                    <h1 class="font-weight-bold text-primary"><?= $title; ?></h1>
                                    <div class="row">
                                        <h4 class="col-sm-5 font-weight-bold text-dark">Id Member</h4>
                                        <h4 class="col-sm-7 font-weight-bold text-dark"><?= $tbl_member['id_member']; ?></h4>
                                    </div>
                                    <div class="row">
                                        <h4 class="col-sm-5 font-weight-bold text-info">Status Validasi</h4>

                                        <?php if ($tbl_member['is_active'] == 1) : ?>
                                            <h4 class="col-sm-7 font-weight-bold text-success">Sudah <i class="fas fa-check"></i></h4>
                                        <?php elseif ($tbl_member['is_active'] == 0) : ?>
                                            <h4 class="col-sm-7 font-weight-bold text-danger">Belum <i class="fas fa-exclamation"></i></h4>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <img src="<?= base_url('assets/img/profile/') . $tbl_member['image']; ?>" class=" img-thumbnail ml-md-5" style="width: 150px">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card-body ml-md-4">

                    <?= $this->session->flashdata('message'); ?>
                    <h3 class="h5 text-gray-900 mt-sm-4 mb-sm-3">Keterangan Pribadi Member</h3>

                    <!-- <div class="row">
                <p class="card-text col-sm-5">Id Member</p>
                <p class="card-text col-sm-7"><?= $tbl_member['id_member']; ?></p>
            </div> -->

                    <div class="row">
                        <p class="card-text col-sm-5">Nama Lengkap</p>
                        <p class="card-text col-sm-7"><?= $tbl_member['nama']; ?></p>
                    </div>

                    <div class="row">
                        <p class="card-text col-sm-5">Tempat Tanggal Lahir</p>
                        <p class="card-text col-sm-7"><?= $tbl_member['tempat_lahir'] . ", " . date('d F Y', strtotime($tbl_member['tanggal_lahir'])); ?></p>
                    </div>
                    <div class="row">
                        <p class="card-text col-sm-5">Jenis Kelamin</p>
                        <p class="card-text col-sm-7">
                            <?php
                            if ($tbl_member['jenis_kelamin'] == 'L') {
                                echo "Laki-laki";
                            } elseif ($tbl_member['jenis_kelamin'] == 'P') {
                                echo "Perempuan";
                            }; ?></p>
                    </div>
                    <div class="row">
                        <p class="card-text col-sm-5">Agama</p>
                        <p class="card-text col-sm-7">
                            <?php
                            if ($tbl_member['kd_agama'] == '01') {
                                echo "Islam";
                            } elseif ($tbl_member['kd_agama'] == '02') {
                                echo "Kristen Protestan";
                            } elseif ($tbl_member['kd_agama'] == '03') {
                                echo "Katholik";
                            } elseif ($tbl_member['kd_agama'] == '04') {
                                echo "Hindu";
                            } elseif ($tbl_member['kd_agama'] == '05') {
                                echo "Budha";
                            } elseif ($tbl_member['kd_agama'] == '06') {
                                echo "Konghucu";
                            } elseif ($tbl_member['kd_agama']) {
                                echo "Lain-lain";
                            }; ?>
                    </div>
                    <div class="row">
                        <p class="card-text col-sm-5">Kewarganegaraan</p>
                        <p class="card-text col-sm-7"><?= $tbl_member['warganegara']; ?></p>
                    </div>
                    <div class="row">
                        <p class="card-text col-sm-5">Status Member</p>
                        <p class="card-text col-sm-7"><?= $tbl_member['statussiswa']; ?></p>
                    </div>
                    <div class="row">
                        <p class="card-text col-sm-5">Anak ke</p>
                        <p class="card-text col-sm-7"><?= $tbl_member['anak_ke'] . " dari " . $tbl_member['dari__bersaudara'] . " bersaudara"; ?></p>
                    </div>
                    <div class="row">
                        <p class="card-text col-sm-5">Jumlah Saudara</p>
                        <p class="card-text col-sm-7"><?= $tbl_member['jumlah_saudara']; ?></p>
                    </div>
                    <div class="row">
                        <p class="card-text col-sm-5">E-mail</p>
                        <p class="card-text col-sm-7"><?= $tbl_member['email']; ?></p>
                    </div>
                    <hr>
                    <h3 class="h5 text-gray-900 mt-sm-5 mb-sm-3">Keterangan Tempat Tinggal Member</h3>
                    <div class="row">
                        <p class="card-text col-sm-5">Alamat</p>
                        <p class="card-text col-sm-7"><?= $tbl_member['alamat']; ?></p>
                    </div>
                    <div class="row">
                        <p class="card-text col-sm-5">RT / RW</p>
                        <p class="card-text col-sm-7"><?= $tbl_member['rt'] . "/" . $tbl_member['rw']; ?></p>
                    </div>
                    <div class="row">
                        <p class="card-text col-sm-5">Kelurahan / Desa</p>
                        <p class="card-text col-sm-7"><?= $tbl_member['kelurahan']; ?></p>
                    </div>
                    <div class="row">
                        <p class="card-text col-sm-5">Kecamatan</p>
                        <p class="card-text col-sm-7"><?= $tbl_member['kecamatan']; ?></p>
                    </div>
                    <div class="row">
                        <p class="card-text col-sm-5">No. HP</p>
                        <p class="card-text col-sm-7"><?= $tbl_member['no_hp']; ?></p>
                    </div>
                    <div class="row">
                        <p class="card-text col-sm-5">Tinggal Bersama dengan</p>
                        <p class="card-text col-sm-7"><?= $tbl_member['tinggalbersama']; ?></p>
                    </div>
                    <div class="row">
                        <p class="card-text col-sm-5">Jarak Rumah ke Sekolah</p>
                        <p class="card-text col-sm-7"><?= $tbl_member['jarak'] . " km"; ?></p>
                    </div>
                    <div class="row">
                        <p class="card-text col-sm-5">Ke Sekolah dengan</p>
                        <p class="card-text col-sm-7"><?= $tbl_member['transport']; ?></p>
                    </div>
                    <hr>

                    <h3 class="h5 text-gray-900 mt-sm-5 mb-sm-3">Keterangan Pilihan Kompetensi Keahlian</h3>
                    <div class="row">
                        <p class="card-text col-sm-5">Kompetensi Keahlian</p>
                        <p class="card-text col-sm-7">
                            <?php
                            if ($tbl_member['jurusan'] == 'AP') {
                                echo "Administrasi Perkantoran";
                            } elseif ($tbl_member['jurusan'] == 'TKJ') {
                                echo "Teknik Komputer dan Jaringan";
                            }; ?></p>
                        <!-- <?= $tbl_member['jurusan']; ?></p> -->
                    </div>
                    <hr>

                    <h3 class="h5 text-gray-900 mt-sm-5 mb-sm-3">Keterangan Pendidikan Member Sebelumnya</h3>
                    <div class="row">
                        <p class="card-text col-sm-5">SMP/MTs</p>
                        <p class="card-text col-sm-7"><?= $tbl_member['asal_sekolah']; ?></p>
                    </div>
                    <div class="row">
                        <p class="card-text col-sm-5">Nomor Induk Member Nasional (NISN)</p>
                        <p class="card-text col-sm-7"><?= $tbl_member['nisn']; ?></p>
                    </div>
                    <div class="row">
                        <p class="card-text col-sm-5">Tanggal/Tahun/No.STTB</p>
                        <p class="card-text col-sm-7"><?= $tbl_member['no_sttb']; ?></p>
                    </div>
                    <hr>

                    <h3 class="h5 text-gray-900 mt-sm-5 mb-sm-3">Keterangan Data Orang Tua Member</h3>
                    <div class="row">
                        <p class="card-text col-sm-5">Nama Orang Tua/Wali</p>
                        <p class="card-text col-sm-7"><?= $tbl_member['nama']; ?></p>
                    </div>
                    <div class="row">
                        <p class="card-text col-sm-5">Alamat Orang Tua/Wali</p>
                        <p class="card-text col-sm-7"><?= $tbl_member['alamat']; ?></p>
                    </div>
                    <div class="row">
                        <p class="card-text col-sm-5">No. HP</p>
                        <p class="card-text col-sm-7"><?= $tbl_member['no_hp']; ?></p>
                    </div>
                    <div class="row">
                        <p class="card-text col-sm-5">Pendidikan Terakhir</p>
                        <p class="card-text col-sm-7"><?= $tbl_member['pendidikan']; ?></p>
                    </div>
                    <div class="row">
                        <p class="card-text col-sm-5">Pekerjaan</p>
                        <p class="card-text col-sm-7"><?= $tbl_member['pekerjaan']; ?></p>
                    </div>
                    <div class="row">
                        <p class="card-text col-sm-5">Penghasilan</p>
                        <p class="card-text col-sm-7"><?= $tbl_member['penghasilan']; ?></p>
                    </div>

                    <div class="text-sm-right mr-3 mb-5">
                        <p class="card-text"><small class="text-muted">Telah Mendaftar pada tanggal <?= date('d F Y', $tbl_member['date_created']); ?></small></p>
                    </div>
                    <hr>

                    <!-- Persyaratan -->

                    <h3 class="h5 text-gray-900 mt-sm-5 mb-sm-3">Keterangan Persyaratan Yang Harus Dilengkapi</h3>
                    <ol>
                        <li>Fotokopi Surat Tanda kelulusan</li>
                        <li>Fotokopi NISN</li>
                        <li>Fotokopi Rapor Semester 6 Dilegalisir</li>
                        <li>Fotokopi KK</li>
                        <li>Fotokopi KTP Orang Tua/Wali</li>
                        <li>Materai 6000</li>
                    </ol>
                    <p>Biaya untuk menjadi siswa SMK MERAH PUTIH sebesar Rp. 3.436.000,- yang dapat di angsur sebanyak 3x. Perincian pembiayaan dapat di terdapat pada Brosur.
                    </p>
                    <p>Dengan menyerahkan persyaratan di atas maka calon siswa tersebut, dinyatakan sebagai siswa SMK MERAH PUTIH.</p>
                    <p align="right" class="mr-sm-3">Bekasi, <?= date('d F Y'); ?></p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p align="right" class="mr-sm-3"><?= $tbl_member['nama']; ?></p>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Page Wrapper -->



        <!-- Bootstrap core JavaScript-->
        <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
        <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

        <script>
            $('.custom-file-input').on('change', function() {
                let fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass("selected").html(fileName);
            });



            $('.form-check-input').on('click', function() {
                const menuId = $(this).data('menu');
                const roleId = $(this).data('role');

                $.ajax({
                    url: "<?= base_url('admin/changeaccess'); ?>",
                    type: 'post',
                    data: {
                        menuId: menuId,
                        roleId: roleId
                    },
                    success: function() {
                        document.location.href = "<?= base_url('admin/roleaccess/'); ?>" + roleId;
                    }
                });

            });
        </script>

        <script type="text/javascript">
            window.onload = function() {
                window.print();
            }
        </script>

</body>

</html>