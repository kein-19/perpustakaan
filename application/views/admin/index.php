<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-sm-12">
            <div class="header d-block p-2 bg-primary text-white">
                <h3>Informasi</h3>
            </div>
            <div class="d-block p-2 bg-light">
                <div class="porlets-content mt-sm-3">
                    <h1 class="h4 mb-sm-3">Yth Saudara/i.
                        <?php echo strtoupper($tbl_admin['nama_lengkap']); ?>
                    </h1>

                    <!-- Daftar Calon Member -->

                    <p style="text-indent: 60px;" class="mb-sm-3 text-justify">Selamat datang <?= ucwords($tbl_admin['nama_lengkap']); ?>, Anda telah berhasil login sebagia Admin. Berikut data calon siswa yang sudah terdaftar. Calon siswa yang telah terdaftar bisa mencetak Formulir dan menyerahkan ke SMK MERAH PUTIH untuk divalidasi agar menjadi Member Baru SMK MERAH PUTIH.</p>

                    <div class="col text-center">
                        <h2 class="h4 mb-sm-3">Daftar Calon Member Baru</h2>
                    </div>
                    <div class="col-sm-12 mx-auto">

                        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>

                        <div class="row mt-3 mb-2">
                            <div class="col-md-6">
                                <a href="<?= base_url('admin/add'); ?>" class="btn btn-primary">Tambah Data Calon Member Baru</a>
                            </div>
                        </div>

                        <table class="table table-sm table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="align-middle text-center">No</th>
                                    <th scope="col" class="align-middle">Id Member</th>
                                    <th scope="col" class="align-middle">Nama Calon Member</th>
                                    <th scope="col" class="align-middle">Asal Sekolah</th>
                                    <th scope="col" class="align-middle">Email</th>
                                    <th scope="col" class="align-middle">Validasi</th>
                                    <th scope="col" class="align-middle text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $i = 0;
                                foreach ($tbl_member as $sb) : ?>

                                    <tr>
                                        <th class="align-middle text-center" scope="row"><?= ++$i; ?></th>
                                        <td class="align-middle"><?= $sb['id_member']; ?></td>
                                        <td class="align-middle"><?= $sb['nama']; ?></td>
                                        <td class="align-middle"><?= $sb['asal_sekolah']; ?></td>
                                        <td class="align-middle"><?= $sb['email']; ?></td>
                                        <td class="align-middle">
                                            <?php if ($sb['is_active'] == 1) : ?>
                                                <span class="align-middle text-success"><i class="fas fa-fw fa-check"></i> Aktif</span>
                                            <?php elseif ($sb['is_active'] == 0) : ?>
                                                <span class="align-middle text-danger"><i class="fas fa-fw fa-exclamation"></i> Tidak Aktif</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="align-middle text-center">
                                            <h4><a href="<?= base_url('admin/detail/') . $sb['id_member']; ?>" class="badge badge-secondary" role="button" title="detail"><i class="far fa-fw fa-id-card"></i></a>
                                                <a href="<?= base_url('admin/edit/') . $sb['id_member']; ?>" class="badge badge-primary" role="button" title="edit"><i class="fas fa-fw fa-edit"></i></a>
                                                <a href="<?= base_url('printdoc/data/') . $sb['id_member']; ?>" class="badge badge-success" role="button" target="blank" title="print"><i class="fas fa-fw fa-print"></i></a>
                                                <a href="<?= base_url('admin/delete/') . $sb['id_member']; ?>" class="badge badge-danger tombol-hapus" role="button" title="delete"><i class="fas fa-fw fa-trash"></i></a></h4>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>

                    </div>



                </div>
            </div>


        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->