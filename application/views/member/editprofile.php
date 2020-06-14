<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="card mb-3">
        <div class="card-header">
            <div class="row">
                <h1 class="col-md-10 ml-md-4 font-weight-bold text-primary align-self-md-center p-2"><?= $title; ?></h1>
            </div>
        </div>
        <div class="card-body ml-md-4">

            <div class="row">
                <div class="col-lg-12">

                    <?= form_open_multipart('member/editprofile'); ?>

                    <h3 class="h5 text-gray-900 mt-sm-5 mb-sm-3">Keterangan Pribadi Member</h3>

                    <div class="row">
                        <div class="col-sm-9">
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label col-form-label-sm" for="id_member">
                                    Id Member
                                </label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control form-control-sm form-control form-control-sm" id="id_member" name="id_member" value="<?= $tbl_member['id_member']; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label col-form-label-sm" for="nama">
                                    Nama Lengkap
                                </label>
                                <div class="col-sm-4">
                                    <input type="text" name="nama" placeholder="Masukkan Nama Lengkap" id="nama" class="form-control form-control-sm" value="<?= $tbl_member['nama']; ?>">
                                </div>
                                <?= form_error('nama', '<div class="col-sm-5"></div><small class="text-danger mt-sm-1 pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label col-form-label-sm" for="tempat_lahir">
                                    Tempat Tanggal Lahir
                                </label>
                                <div class="col-sm-4">
                                    <input type="text" name="tempat_lahir" placeholder="Tempat Lahir" id="tempat_lahir" class="form-control form-control-sm" value="<?= $tbl_member['tempat_lahir']; ?>">
                                </div>
                                <div class="col-sm-3">
                                    <input type="date" name="tanggal_lahir" placeholder="Tanggal Lahir" id="tanggal_lahir" class="form-control form-control-sm" value="<?= $tbl_member['tanggal_lahir']; ?>">
                                </div>
                                <?= form_error('tempat_lahir', '<div class="col-sm-5"></div><small class="text-danger mt-sm-1 pl-3 col-sm-4">', '</small>'); ?>
                                <?= form_error('tanggal_lahir', '<small class="text-danger pl-3 col-sm-3 align-items-sm-end">', '</small>'); ?>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label col-form-label-sm" for="gender">
                                    Jenis Kelamin
                                </label>
                                <div class="col-sm-4">
                                    <?php
                                    $jenis_kelamin = array(
                                        null => '- Silahkan Pilih -',
                                        'L' => 'Laki-laki',
                                        'P' => 'Perempuan'
                                    );
                                    $pilih = $tbl_member['jenis_kelamin'];
                                    echo form_dropdown(
                                        'jenis_kelamin',
                                        $jenis_kelamin,
                                        $pilih,
                                        "class='form-control form-control-sm'"
                                    );
                                    ?>
                                </div>
                                <?= form_error('jenis_kelamin', '<div class="col-sm-5"></div><small class="text-danger mt-sm-1 pl-3 col-sm-7">', '</small>'); ?>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label col-form-label-sm" for="agama">
                                    Agama
                                </label>
                                <div class="col-sm-4">
                                    <?php
                                    $agama = array(
                                        null => '- Silahkan Pilih -',
                                        '01' => 'Islam',
                                        '02' => 'Kristen Protestan',
                                        '03' => 'Katholik',
                                        '04' => 'Hindu',
                                        '05' => 'Budha',
                                        '06' => 'Konghucu',
                                        '99' => 'Lain-lain'
                                    );
                                    $pilih = $tbl_member['kd_agama'];
                                    echo form_dropdown(
                                        'agama',
                                        $agama,
                                        $pilih,
                                        "class='form-control form-control-sm'"
                                    );
                                    ?>
                                </div>
                                <?= form_error('agama', '<div class="col-sm-5"></div><small class="text-danger mt-sm-1 pl-3 col-sm-7">', '</small>'); ?>
                            </div>
                            <div class="form-group row mb-lg-5">
                                <label class="col-sm-5 col-form-label col-form-label-sm" for="email">
                                    E-mail
                                </label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control form-control-sm form-control form-control-sm" id="email" name="email" placeholder="E-mail" value="<?= $tbl_member['email']; ?>" readonly>
                                </div>
                            </div>

                        </div>

                        <!-- Image -->
                        <div class="col-sm-3">
                            <!-- <div class="card float-md-right p-md-2">
                                <img src="<?= base_url('assets/img/profile/') . $tbl_member['image']; ?>" class="card-img rounded mx-auto d-block" style="width: 100px">
                            </div> -->
                            <div class="row">
                                <img src="<?= base_url('assets/img/profile/') . $tbl_member['image']; ?>" class="img-thumbnail mb-sm-3 p-sm-2">
                                <div class="custom-file col-form-label col-form-label-sm">
                                    <input type="file" class="custom-file-input" id="image" name="image">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <h3 class="h5 text-gray-900 mt-sm-5 mb-sm-3">Keterangan Tempat Tinggal Member</h3>
                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label col-form-label-sm" for="alamat">
                            Alamat
                        </label>
                        <div class="col-sm-7">
                            <input name="alamat" id="alamat" class="form-control form-control-sm" value="<?= $tbl_member['alamat']; ?>"></input>
                        </div>
                        <?= form_error('alamat', '<div class="col-sm-5"></div><small class="text-danger mt-sm-1 pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label col-form-label-sm" for="rt">
                            RT / RW
                        </label>
                        <div class="col-sm-3">
                            <input type="text" name="rt" placeholder="RT" id="rt" class="form-control form-control-sm" value="<?= $tbl_member['rt']; ?>">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" name="rw" placeholder="RW" id="rw" class="form-control form-control-sm" value="<?= $tbl_member['rw']; ?>">
                        </div>
                        <?= form_error('rt', '<div class="col-sm-5"></div><small class="text-danger mt-sm-1 pl-3 col-sm-3">', '</small>'); ?>
                        <?= form_error('rw', '<small class="text-danger pl-3 col-sm-3 align-items-sm-end">', '</small>'); ?>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label col-form-label-sm" for="kelurahan">
                            Kelurahan / Desa
                        </label>
                        <div class="col-sm-7">
                            <input type="text" name="kelurahan" placeholder="Kelurahan / Desa" id="kelurahan" class="form-control form-control-sm" value="<?= $tbl_member['kelurahan']; ?>">
                        </div>
                        <?= form_error('kelurahan', '<div class="col-sm-5"></div><small class="text-danger mt-sm-1 pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label col-form-label-sm" for="kecamatan">
                            Kecamatan
                        </label>
                        <div class="col-sm-7">
                            <input type="text" name="kecamatan" placeholder="Kecamatan" id="kecamatan" class="form-control form-control-sm" value="<?= $tbl_member['kecamatan']; ?>">
                        </div>
                        <?= form_error('kecamatan', '<div class="col-sm-5"></div><small class="text-danger mt-sm-1 pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label col-form-label-sm" for="no_hp">
                            No. HP
                        </label>
                        <div class="col-sm-7">
                            <input type="text" name="no_hp" placeholder="Nomor HP" id="no_hp" class="form-control form-control-sm" value="<?= $tbl_member['no_hp']; ?>">
                        </div>
                        <?= form_error('no_hp', '<div class="col-sm-5"></div><small class="text-danger mt-sm-1 pl-3">', '</small>'); ?>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label col-form-label-sm" for="pendidikan">
                            Pendidikan Terakhir
                        </label>
                        <div class="col-sm-7">
                            <input type="text" name="pendidikan" placeholder="Pendidikan Terakhir" id="pendidikan" class="form-control form-control-sm" value="<?= $tbl_member['pendidikan']; ?>">
                        </div>
                        <?= form_error('pendidikan', '<div class="col-sm-5"></div><small class="text-danger mt-sm-1 pl-3">', '</small>'); ?>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label col-form-label-sm" for="pekerjaan">
                            Pekerjaan
                        </label>
                        <div class="col-sm-7">
                            <input type="text" name="pekerjaan" placeholder="Pekerjaan" id="pekerjaan" class="form-control form-control-sm" value="<?= $tbl_member['pekerjaan']; ?>">
                        </div>
                        <?= form_error('pekerjaan', '<div class="col-sm-5"></div><small class="text-danger mt-sm-1 pl-3">', '</small>'); ?>
                    </div>

                    <div class="form-group row justify-content-end">
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                        </div>
                    </div>


                    </form>


                </div>
            </div>
        </div>


    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->