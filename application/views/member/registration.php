<div class="jumbotron daftar luhur">
    <center><img src="<?= base_url(); ?>assets/img/logolibrary.jpg" alt="logo" width="100px" class="img img-responsive full-width rounded-circle mt-4"></center>
    <div class="text-center">
        <h2 style="color:rgb(252, 252, 252)">
            <center><?= $judul; ?></center>
        </h2>
        <h1 style="color:rgb(252, 252, 252)">
            <center><?= $navbar; ?></center>
        </h1>
    </div>
</div>


<div class="container-fluid mt-5">
    <div class="row" style="margin-left:0;margin-right:0;">

        <div class="col-md-8 mx-auto">
            <div class="row bg-light mb-5">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="header">
                            <h3 class="h3 text-gray-900 mb-lg-5">
                                <center>Formulir Pendaftaran</center>
                            </h3>
                        </div>
                        <?php
                        if ($this->session->flashdata('message')) :
                        ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">Selamat! Terima kasih anda sudah mendaftar di Perpustakaan Ciwaru.<br>
                                Silahkan login! dengan menggunakan Usename <strong>Email</strong> dan Password dengan menggunakan Id Member <strong><?= $this->session->flashdata('message'); ?></strong> !"
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>

                        <hr style="border:1px solid light;">

                        <form class="user" method="post" action="">
                            <h3 class="h5 text-gray-900 mt-sm-5 mb-sm-3">Keterangan Pribadi Member</h3>

                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label col-form-label-sm" for="nama">
                                    Nama Lengkap
                                </label>
                                <div class="col-sm-7">
                                    <input type="text" name="nama" placeholder="Masukkan Nama Lengkap" id="nama" class="form-control form-control-sm" value="<?= set_value('nama'); ?>">
                                </div>
                                <?= form_error('nama', '<div class="col-sm-5"></div><small class="text-danger mt-sm-1 pl-3">', '</small>'); ?>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label col-form-label-sm" for="tempat_lahir">
                                    Tempat Tanggal Lahir
                                </label>
                                <div class="col-sm-4">
                                    <input type="text" name="tempat_lahir" placeholder="Tempat Lahir" id="tempat_lahir" class="form-control form-control-sm" value="<?= set_value('tempat_lahir'); ?>">
                                </div>
                                <div class="col-sm-3">
                                    <input type="date" name="tanggal_lahir" placeholder="Tanggal Lahir" id="tanggal_lahir" class="form-control form-control-sm" value="<?= set_value('tanggal_lahir'); ?>">
                                </div>
                                <?= form_error('tempat_lahir', '<div class="col-sm-5"></div><small class="text-danger mt-sm-1 pl-3 col-sm-4">', '</small>'); ?>
                                <?= form_error('tanggal_lahir', '<small class="text-danger pl-3 col-sm-3 align-items-sm-end">', '</small>'); ?>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label col-form-label-sm" for="gender">
                                    Jenis Kelamin
                                </label>
                                <div class="col-sm-5">
                                    <?php
                                    $jenis_kelamin = array(
                                        null => '- Silahkan Pilih -',
                                        'L' => 'Laki-laki',
                                        'P' => 'Perempuan'
                                    );
                                    $pilih = array(null);
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
                                <div class="col-sm-5">
                                    <?php
                                    echo cmb_dinamis('agama', 'tbl_agama', 'nama_agama', 'kd_agama');
                                    ?>
                                </div>
                                <?= form_error('agama', '<div class="col-sm-5"></div><small class="text-danger mt-sm-1 pl-3 col-sm-7">', '</small>'); ?>
                            </div>

                            <div class="form-group row mb-lg-5">
                                <label class="col-sm-5 col-form-label col-form-label-sm" for="email">
                                    E-mail
                                </label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control form-control-sm form-control form-control-sm" id="email" name="email" placeholder="E-mail" value="<?= set_value('email'); ?>">
                                </div>
                                <?= form_error('email', '<div class="col-sm-5"></div><small class="text-danger mt-sm-1 pl-3">', '</small>'); ?>
                            </div>
                            <hr>

                            <h3 class="h5 text-gray-900 mt-sm-5 mb-sm-3">Keterangan Tempat Tinggal Member</h3>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label col-form-label-sm" for="alamat">
                                    Alamat
                                </label>
                                <div class="col-sm-7">
                                    <textarea name="alamat" id="alamat" class="form-control form-control-sm" value="<?= set_value('alamat'); ?>"></textarea>
                                </div>
                                <?= form_error('alamat', '<div class="col-sm-5"></div><small class="text-danger mt-sm-1 pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label col-form-label-sm" for="rt">
                                    RT / RW
                                </label>
                                <div class="col-sm-3">
                                    <input type="text" name="rt" placeholder="RT" id="rt" class="form-control form-control-sm" value="<?= set_value('rt'); ?>">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" name="rw" placeholder="RW" id="rw" class="form-control form-control-sm" value="<?= set_value('rw'); ?>">
                                </div>
                                <?= form_error('rt', '<div class="col-sm-5"></div><small class="text-danger mt-sm-1 pl-3 col-sm-3">', '</small>'); ?>
                                <?= form_error('rw', '<small class="text-danger pl-3 col-sm-3 align-items-sm-end">', '</small>'); ?>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label col-form-label-sm" for="kelurahan">
                                    Kelurahan / Desa
                                </label>
                                <div class="col-sm-7">
                                    <input type="text" name="kelurahan" placeholder="Kelurahan / Desa" id="kelurahan" class="form-control form-control-sm" value="<?= set_value('kelurahan'); ?>">
                                </div>
                                <?= form_error('kelurahan', '<div class="col-sm-5"></div><small class="text-danger mt-sm-1 pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label col-form-label-sm" for="kecamatan">
                                    Kecamatan
                                </label>
                                <div class="col-sm-7">
                                    <input type="text" name="kecamatan" placeholder="Kecamatan" id="kecamatan" class="form-control form-control-sm" value="<?= set_value('kecamatan'); ?>">
                                </div>
                                <?= form_error('kecamatan', '<div class="col-sm-5"></div><small class="text-danger mt-sm-1 pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label col-form-label-sm" for="no_hp">
                                    No. HP
                                </label>
                                <div class="col-sm-7">
                                    <input type="text" name="no_hp" placeholder="Nomor HP" id="no_hp" class="form-control form-control-sm" value="<?= set_value('no_hp'); ?>">
                                </div>
                                <?= form_error('no_hp', '<div class="col-sm-5"></div><small class="text-danger mt-sm-1 pl-3">', '</small>'); ?>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label col-form-label-sm" for="pendidikan">
                                    Pendidikan Terakhir
                                </label>
                                <div class="col-sm-7">
                                    <input type="text" name="pendidikan" placeholder="Pendidikan Terakhir" id="pendidikan" class="form-control form-control-sm" value="<?= set_value('pendidikan'); ?>">
                                </div>
                                <?= form_error('pendidikan', '<div class="col-sm-5"></div><small class="text-danger mt-sm-1 pl-3">', '</small>'); ?>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label col-form-label-sm" for="pekerjaan">
                                    Pekerjaan
                                </label>
                                <div class="col-sm-7">
                                    <input type="text" name="pekerjaan" placeholder="Pekerjaan" id="pekerjaan" class="form-control form-control-sm" value="<?= set_value('pekerjaan'); ?>">
                                </div>
                                <?= form_error('pekerjaan', '<div class="col-sm-5"></div><small class="text-danger mt-sm-1 pl-3">', '</small>'); ?>
                            </div>


                            <!-- <div class="form-group row">
                                <label class="col-sm-5 col-form-label col-form-label-sm" for="password1">
                                    Password
                                </label>
                                <div class="col-sm-3 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-sm form-control form-control-sm" id="password1" name="password1" placeholder="Password">
                                </div>
                                <div class="col-sm-3">
                                    <input type="password" class="form-control form-control-sm form-control form-control-sm" id="password2" name="password2" placeholder="Repeat Password">
                                </div>
                                <?= form_error('password1', '<div class="col-sm-5"></div><small class="text-danger mt-sm-1 pl-3">', '</small>'); ?>
                            </div> -->
                            <div class="text-center mt-lg-5">
                                <button type="submit" class="btn btn-success btn-block btn-user">
                                    Daftar
                                </button>
                            </div>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="text-primary" href="<?= base_url('member/login'); ?>">Aktif Daftar? Silahkan Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>