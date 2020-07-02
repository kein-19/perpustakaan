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
                    <?= form_open_multipart(''); ?>

                    <div class="row">
                        <div class="col-sm-9">
                            <input type="hidden" name="id" id="id" value="<?= $t_buku['id']; ?>">

                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label col-form-label-sm" for="kategori">
                                    Kategori
                                </label>
                                <div class="col-sm-5">
                                    <?php
                                    $kategori = array(
                                        null => '- Silahkan Pilih -',
                                        '1' => 'Orang Tua dan Anak',
                                        '2' => 'Romance',
                                        '3' => 'Pengembangan Diri',
                                        '4' => 'Metropop',
                                        '5' => 'Remaja',
                                        '6' => 'Fiksi',
                                        '7' => 'Fashion & Beauty',
                                        '8' => 'Drama',
                                        '9' => 'Sejarah Dunia'
                                    );
                                    $pilih = $t_buku['id_kelas'];
                                    echo form_dropdown(
                                        'kategori',
                                        $kategori,
                                        $pilih,
                                        "class='form-control form-control-sm'"
                                    );
                                    ?>
                                </div>
                                <?= form_error('kategori', '<div class="col-sm-5"></div><small class="text-danger mt-sm-1 pl-3 col-sm-7">', '</small>'); ?>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label col-form-label-sm" for="jenis">
                                    Jenis
                                </label>
                                <div class="col-sm-5">
                                    <?php
                                    $jenis = array(
                                        null => '- Silahkan Pilih -',
                                        '1' => 'Buku',
                                        '2' => 'Majalah',
                                        '3' => 'Surat Kabar'
                                    );
                                    $pilih = $t_buku['id_jenis'];
                                    echo form_dropdown(
                                        'jenis',
                                        $jenis,
                                        $pilih,
                                        "class='form-control form-control-sm'"
                                    );
                                    ?>
                                </div>
                                <?= form_error('jenis', '<div class="col-sm-5"></div><small class="text-danger mt-sm-1 pl-3 col-sm-7">', '</small>'); ?>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label col-form-label-sm" for="judul">
                                    Judul
                                </label>
                                <div class="col-sm-7">
                                    <input type="text" name="judul" placeholder="Judul" id="judul" class="form-control form-control-sm" value="<?= $t_buku['judul']; ?>">
                                </div>
                                <?= form_error('judul', '<div class="col-sm-5"></div><small class="text-danger mt-sm-1 pl-3">', '</small>'); ?>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label col-form-label-sm" for="pengarang">
                                    Pengarang
                                </label>
                                <div class="col-sm-7">
                                    <input type="text" name="pengarang" placeholder="Pengarang" id="pengarang" class="form-control form-control-sm" value="<?= $t_buku['pengarang']; ?>">
                                </div>
                                <?= form_error('pengarang', '<div class="col-sm-5"></div><small class="text-danger mt-sm-1 pl-3">', '</small>'); ?>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label col-form-label-sm" for="penerbit">
                                    Penerbit
                                </label>
                                <div class="col-sm-7">
                                    <input type="text" name="penerbit" placeholder="Penerbit" id="penerbit" class="form-control form-control-sm" value="<?= $t_buku['penerbit']; ?>">
                                </div>
                                <?= form_error('penerbit', '<div class="col-sm-5"></div><small class="text-danger mt-sm-1 pl-3">', '</small>'); ?>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label col-form-label-sm" for="th_terbit">
                                    Tahun Terbit
                                </label>
                                <div class="col-sm-7">
                                    <input type="text" name="th_terbit" placeholder="Tahun Terbit" id="th_terbit" class="form-control form-control-sm" value="<?= $t_buku['th_terbit']; ?>">
                                </div>
                                <?= form_error('th_terbit', '<div class="col-sm-5"></div><small class="text-danger mt-sm-1 pl-3">', '</small>'); ?>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label col-form-label-sm" for="isbn">
                                    No. ISBN
                                </label>
                                <div class="col-sm-7">
                                    <input type="text" name="isbn" placeholder="No. ISBN" id="isbn" class="form-control form-control-sm" value="<?= $t_buku['isbn']; ?>">
                                </div>
                                <?= form_error('isbn', '<div class="col-sm-5"></div><small class="text-danger mt-sm-1 pl-3">', '</small>'); ?>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label col-form-label-sm" for="jml_hal">
                                    Jumlah Halaman
                                </label>
                                <div class="col-sm-7">
                                    <input type="text" name="jml_hal" placeholder="Jumlah Halaman" id="jml_hal" class="form-control form-control-sm" value="<?= $t_buku['jml_hal']; ?>">
                                </div>
                                <?= form_error('jml_hal', '<div class="col-sm-5"></div><small class="text-danger mt-sm-1 pl-3">', '</small>'); ?>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label col-form-label-sm" for="harga">
                                    Harga
                                </label>
                                <div class="col-sm-7">
                                    <input type="text" name="harga" placeholder="Harga" id="harga" class="form-control form-control-sm" value="<?= $t_buku['harga']; ?>">
                                </div>
                                <?= form_error('harga', '<div class="col-sm-5"></div><small class="text-danger mt-sm-1 pl-3">', '</small>'); ?>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label col-form-label-sm" for="asal_perolehan">
                                    Asal Perolehan
                                </label>
                                <div class="col-sm-7">
                                    <input type="text" name="asal_perolehan" placeholder="Asal Perolehan" id="asal_perolehan" class="form-control form-control-sm" value="<?= $t_buku['asal_perolehan']; ?>">
                                </div>
                                <?= form_error('asal_perolehan', '<div class="col-sm-5"></div><small class="text-danger mt-sm-1 pl-3">', '</small>'); ?>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label col-form-label-sm" for="id_lokasi">
                                    Lokasi Buku
                                </label>
                                <div class="col-sm-5">
                                    <?php
                                    $id_lokasi = array(
                                        null => '- Silahkan Pilih -',
                                        '1' => '1A1',
                                        '2' => '1A2'
                                    );
                                    $pilih = $t_buku['id_lokasi'];
                                    echo form_dropdown(
                                        'id_lokasi',
                                        $id_lokasi,
                                        $pilih,
                                        "class='form-control form-control-sm'"
                                    );
                                    ?>
                                </div>
                                <?= form_error('id_lokasi', '<div class="col-sm-5"></div><small class="text-danger mt-sm-1 pl-3 col-sm-7">', '</small>'); ?>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label col-form-label-sm" for="stat">
                                    Kondisi Buku
                                </label>
                                <div class="col-sm-5">
                                    <?php
                                    $stat = array(
                                        null => '- Silahkan Pilih -',
                                        'B' => 'Baik',
                                        'RR' => 'Rusak Ringan',
                                        'RB' => 'Rusak Berat',
                                        'H' => 'Hilang'
                                    );
                                    $pilih = $t_buku['stat'];
                                    echo form_dropdown(
                                        'stat',
                                        $stat,
                                        $pilih,
                                        "class='form-control form-control-sm'"
                                    );
                                    ?>
                                </div>
                                <?= form_error('stat', '<div class="col-sm-5"></div><small class="text-danger mt-sm-1 pl-3 col-sm-7">', '</small>'); ?>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label col-form-label-sm" for="deskripsi">
                                    Deskripsi
                                </label>
                                <div class="col-sm-7">
                                    <textarea name="deskripsi" placeholder="Deskripsi" id="deskripsi" class="form-control form-control-sm" placeholder="Deskripsi"><?= $t_buku['deskripsi']; ?></textarea>
                                </div>
                                <?= form_error('deskripsi', '<div class="col-sm-5"></div><small class="text-danger mt-sm-1 pl-3">', '</small>'); ?>
                            </div>

                        </div>

                        <!-- Image -->
                        <div class="col-sm-3">
                            <div class="row">
                                <img src="<?= base_url('assets/img/noimage.png'); ?>" class="img-thumbnail mb-sm-3 p-sm-2">
                                <div class="custom-file col-form-label col-form-label-sm">
                                    <input type="file" class="custom-file-input" id="image" name="image">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row justify-content-end">
                        <div class="col-sm-2">
                            <button type="submit" name="edit" class="btn btn-primary btn-block">Simpan</button>
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