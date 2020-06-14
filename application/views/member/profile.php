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
                                <h4 class="col-sm-5 font-weight-bold text-info">Status Member</h4>

                                <?php if ($tbl_member['is_active'] == 1) : ?>
                                    <h4 class="col-sm-7 font-weight-bold text-success">Aktif <i class="fas fa-check"></i></h4>
                                <?php elseif ($tbl_member['is_active'] == 0) : ?>
                                    <h4 class="col-sm-7 font-weight-bold text-danger">Tidak Aktif <i class="fas fa-exclamation"></i></h4>
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
                <p class="card-text col-sm-5">Pendidikan Terakhir</p>
                <p class="card-text col-sm-7"><?= $tbl_member['pendidikan']; ?></p>
            </div>
            <div class="row">
                <p class="card-text col-sm-5">Pekerjaan</p>
                <p class="card-text col-sm-7"><?= $tbl_member['pekerjaan']; ?></p>
            </div>

            <div class="text-sm-right mr-3 mb-5">
                <p class="card-text"><small class="text-muted">Telah Mendaftar pada tanggal <?= date('d F Y', $tbl_member['date_created']); ?></small></p>
            </div>
            <hr>

            <div class="form-group row justify-content-end mt-sm-5">
                <div class="col-sm-3">
                    <a href="<?= base_url('printdoc/'); ?>" class="print btn btn-success btn-block" role="button" target="blank">Print</a>
                    <!-- <a href="<?= base_url('mpdfcontroller/printPDF'); ?>" type="submit" class="print btn btn-success btn-block">Print</a> -->
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->