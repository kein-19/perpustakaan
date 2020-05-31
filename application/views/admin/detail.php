<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="card mb-3">

        <div class="card-header ml-md-4">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-9 align-self-sm-center">
                            <h1 class="font-weight-bold text-primary"><?= $title; ?></h1>
                            <div class="row">
                                <h4 class="col-sm-5 font-weight-bold text-dark">Nomor Formulir</h4>
                                <h4 class="col-sm-7 font-weight-bold text-dark"><?= $tbl_siswa_baru['kode_pendaftaran']; ?></h4>
                            </div>
                            <div class="row">
                                <h4 class="col-sm-5 font-weight-bold text-info">Status Validasi</h4>

                                <?php if ($tbl_siswa_baru['is_active'] == 1) : ?>
                                    <h4 class="col-sm-7 font-weight-bold text-success">Sudah <i class="fas fa-check"></i></h4>
                                <?php elseif ($tbl_siswa_baru['is_active'] == 0) : ?>
                                    <h4 class="col-sm-7 font-weight-bold text-danger">Belum <i class="fas fa-exclamation"></i></h4>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-3">
                            <img src="<?= base_url('assets/img/profile/') . $tbl_siswa_baru['image']; ?>" class=" img-thumbnail ml-md-5" style="width: 150px">
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="card-body ml-md-4">

            <h3 class="h5 text-gray-900 mt-sm-4 mb-sm-3">Keterangan Pribadi Siswa</h3>

            <!-- <div class="row">
                <p class="card-text col-sm-5">Nomor Formulir</p>
                <p class="card-text col-sm-7"><?= $tbl_siswa_baru['kode_pendaftaran']; ?></p>
            </div> -->

            <div class="row">
                <p class="card-text col-sm-5">Nama Lengkap</p>
                <p class="card-text col-sm-7"><?= $tbl_siswa_baru['nama']; ?></p>
            </div>

            <div class="row">
                <p class="card-text col-sm-5">Tempat Tanggal Lahir</p>
                <p class="card-text col-sm-7"><?= $tbl_siswa_baru['tempat_lahir'] . ", " . date('d F Y', strtotime($tbl_siswa_baru['tanggal_lahir'])); ?></p>
            </div>
            <div class="row">
                <p class="card-text col-sm-5">Jenis Kelamin</p>
                <p class="card-text col-sm-7">
                    <?php
                    if ($tbl_siswa_baru['jenis_kelamin'] == 'L') {
                        echo "Laki-laki";
                    } elseif ($tbl_siswa_baru['jenis_kelamin'] == 'P') {
                        echo "Perempuan";
                    }; ?></p>
            </div>
            <div class="row">
                <p class="card-text col-sm-5">Agama</p>
                <p class="card-text col-sm-7">
                    <?php
                    if ($tbl_siswa_baru['kd_agama'] == '01') {
                        echo "Islam";
                    } elseif ($tbl_siswa_baru['kd_agama'] == '02') {
                        echo "Kristen Protestan";
                    } elseif ($tbl_siswa_baru['kd_agama'] == '03') {
                        echo "Katholik";
                    } elseif ($tbl_siswa_baru['kd_agama'] == '04') {
                        echo "Hindu";
                    } elseif ($tbl_siswa_baru['kd_agama'] == '05') {
                        echo "Budha";
                    } elseif ($tbl_siswa_baru['kd_agama'] == '06') {
                        echo "Konghucu";
                    } elseif ($tbl_siswa_baru['kd_agama']) {
                        echo "Lain-lain";
                    }; ?>
            </div>
            <div class="row">
                <p class="card-text col-sm-5">Kewarganegaraan</p>
                <p class="card-text col-sm-7"><?= $tbl_siswa_baru['warganegara']; ?></p>
            </div>
            <div class="row">
                <p class="card-text col-sm-5">Status Siswa</p>
                <p class="card-text col-sm-7"><?= $tbl_siswa_baru['statussiswa']; ?></p>
            </div>
            <div class="row">
                <p class="card-text col-sm-5">Anak ke</p>
                <p class="card-text col-sm-7"><?= $tbl_siswa_baru['anak_ke'] . " dari " . $tbl_siswa_baru['dari__bersaudara'] . " bersaudara"; ?></p>
            </div>
            <div class="row">
                <p class="card-text col-sm-5">Jumlah Saudara</p>
                <p class="card-text col-sm-7"><?= $tbl_siswa_baru['jumlah_saudara']; ?></p>
            </div>
            <div class="row">
                <p class="card-text col-sm-5">E-mail</p>
                <p class="card-text col-sm-7"><?= $tbl_siswa_baru['email']; ?></p>
            </div>
            <hr>
            <h3 class="h5 text-gray-900 mt-sm-5 mb-sm-3">Keterangan Tempat Tinggal Siswa</h3>
            <div class="row">
                <p class="card-text col-sm-5">Alamat</p>
                <p class="card-text col-sm-7"><?= $tbl_siswa_baru['alamat']; ?></p>
            </div>
            <div class="row">
                <p class="card-text col-sm-5">RT / RW</p>
                <p class="card-text col-sm-7"><?= $tbl_siswa_baru['rt'] . "/" . $tbl_siswa_baru['rw']; ?></p>
            </div>
            <div class="row">
                <p class="card-text col-sm-5">Kelurahan / Desa</p>
                <p class="card-text col-sm-7"><?= $tbl_siswa_baru['kelurahan']; ?></p>
            </div>
            <div class="row">
                <p class="card-text col-sm-5">Kecamatan</p>
                <p class="card-text col-sm-7"><?= $tbl_siswa_baru['kecamatan']; ?></p>
            </div>
            <div class="row">
                <p class="card-text col-sm-5">No. HP</p>
                <p class="card-text col-sm-7"><?= $tbl_siswa_baru['no_hp']; ?></p>
            </div>
            <div class="row">
                <p class="card-text col-sm-5">Tinggal Bersama dengan</p>
                <p class="card-text col-sm-7"><?= $tbl_siswa_baru['tinggalbersama']; ?></p>
            </div>
            <div class="row">
                <p class="card-text col-sm-5">Jarak Rumah ke Sekolah</p>
                <p class="card-text col-sm-7"><?= $tbl_siswa_baru['jarak'] . " km"; ?></p>
            </div>
            <div class="row">
                <p class="card-text col-sm-5">Ke Sekolah dengan</p>
                <p class="card-text col-sm-7"><?= $tbl_siswa_baru['transport']; ?></p>
            </div>
            <hr>

            <h3 class="h5 text-gray-900 mt-sm-5 mb-sm-3">Keterangan Pilihan Kompetensi Keahlian</h3>
            <div class="row">
                <p class="card-text col-sm-5">Kompetensi Keahlian</p>
                <p class="card-text col-sm-7">
                    <?php
                    if ($tbl_siswa_baru['jurusan'] == 'AP') {
                        echo "Administrasi Perkantoran";
                    } elseif ($tbl_siswa_baru['jurusan'] == 'TKJ') {
                        echo "Teknik Komputer dan Jaringan";
                    }; ?></p>
                <!-- <?= $tbl_siswa_baru['jurusan']; ?></p> -->
            </div>
            <hr>

            <h3 class="h5 text-gray-900 mt-sm-5 mb-sm-3">Keterangan Pendidikan Siswa Sebelumnya</h3>
            <div class="row">
                <p class="card-text col-sm-5">SMP/MTs</p>
                <p class="card-text col-sm-7"><?= $tbl_siswa_baru['asal_sekolah']; ?></p>
            </div>
            <div class="row">
                <p class="card-text col-sm-5">Nomor Induk Siswa Nasional (NISN)</p>
                <p class="card-text col-sm-7"><?= $tbl_siswa_baru['nisn']; ?></p>
            </div>
            <div class="row">
                <p class="card-text col-sm-5">Tanggal/Tahun/No.STTB</p>
                <p class="card-text col-sm-7"><?= $tbl_siswa_baru['no_sttb']; ?></p>
            </div>
            <hr>

            <h3 class="h5 text-gray-900 mt-sm-5 mb-sm-3">Keterangan Data Orang Tua Siswa</h3>
            <div class="row">
                <p class="card-text col-sm-5">Nama Orang Tua/Wali</p>
                <p class="card-text col-sm-7"><?= $tbl_siswa_baru['nama_ot']; ?></p>
            </div>
            <div class="row">
                <p class="card-text col-sm-5">Alamat Orang Tua/Wali</p>
                <p class="card-text col-sm-7"><?= $tbl_siswa_baru['alamat_ot']; ?></p>
            </div>
            <div class="row">
                <p class="card-text col-sm-5">No. HP</p>
                <p class="card-text col-sm-7"><?= $tbl_siswa_baru['no_hp_ot']; ?></p>
            </div>
            <div class="row">
                <p class="card-text col-sm-5">Pendidikan Terakhir</p>
                <p class="card-text col-sm-7"><?= $tbl_siswa_baru['pendidikan_ot']; ?></p>
            </div>
            <div class="row">
                <p class="card-text col-sm-5">Pekerjaan</p>
                <p class="card-text col-sm-7"><?= $tbl_siswa_baru['pekerjaan_ot']; ?></p>
            </div>
            <div class="row">
                <p class="card-text col-sm-5">Penghasilan</p>
                <p class="card-text col-sm-7"><?= $tbl_siswa_baru['penghasilan_ot']; ?></p>
            </div>

            <div class="text-sm-right mr-3 mb-5">
                <p class="card-text"><small class="text-muted">Telah Mendaftar pada tanggal <?= date('d F Y', $tbl_siswa_baru['date_created']); ?></small></p>
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
            <p align="right" class="mr-sm-3">Jakarta, <?= date('d F Y'); ?></p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p align="right" class="mr-sm-3"><?= $tbl_siswa_baru['nama']; ?></p>

            <div class="form-group row justify-content-end mt-sm-5">
                <div class="col-sm-3">
                    <a href="<?= base_url('admin/edit/') . $tbl_siswa_baru['kode_pendaftaran']; ?>" class="print btn btn-primary btn-block" role="button">Edit</a>
                </div>
                <div class="col-sm-3">
                    <a href="<?= base_url('printdoc/data/') . $tbl_siswa_baru['kode_pendaftaran']; ?>" class="print btn btn-success btn-block" role="button" target="blank">Print</a>
                </div>
                <div class="col-sm-3">
                    <a href="<?= base_url('admin/delete/') . $tbl_siswa_baru['kode_pendaftaran']; ?>" class="print btn btn-danger btn-block tombol-hapus" role="button">Delete</a>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->