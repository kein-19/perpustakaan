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

                    <!-- Daftar Member -->

                    <p style="text-indent: 60px;" class="mb-sm-3 text-justify">Selamat datang <?= ucwords($tbl_admin['nama_lengkap']); ?>, Anda telah berhasil login sebagai Admin. Berikut data member yang sudah terdaftar.</p>

                    <div class="col text-center">
                        <h2 class="h4 mb-sm-3">Daftar Member</h2>
                    </div>
                    <div class="col-sm-12 mx-auto">

                        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>

                        <div class="row mt-3 mb-2">
                            <div class="col-md-4">
                                <a href="<?= base_url('admin/add'); ?>" class="btn btn-primary">Tambah Data Member</a>
                            </div>

                            <div class="col-md-2">
                                <h5 class="mt-2 mb-2">Results : <?= $total_rows; ?></h5>
                            </div>

                            <div class="col-md-6">
                                <form action="<?= base_url('admin'); ?>" method="post">

                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Search keyword.." name="keyword" autocomplete="off" autofocus>
                                        <div class="input-group-append">
                                            <input class="btn btn-primary fas fa-search" type="submit" name="submit">
                                            <!-- <button class="btn btn-primary" type="submit" name="submit"><i class="fas fa-search"></i></button> -->
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>

                        <table class="table table-sm table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="align-middle text-center">No</th>
                                    <th scope="col" class="align-middle">Id Member</th>
                                    <th scope="col" class="align-middle">Nama Lengkap</th>
                                    <th scope="col" class="align-middle">Email</th>
                                    <th scope="col" class="align-middle">Alamat</th>
                                    <th scope="col" class="align-middle">Pendidikan</th>
                                    <th scope="col" class="align-middle">Pekerjaan</th>
                                    <!-- <th scope="col" class="align-middle">Status</th> -->
                                    <th scope="col" class="align-middle text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php if (empty($tbl_member)) : ?>
                                    <tr>
                                        <td colspan="8">
                                            <div class="alert alert-danger" role="alert">
                                                data not found.
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>

                                <?php foreach ($tbl_member as $sb) : ?>

                                    <tr>
                                        <th class="align-middle text-center" scope="row"><?= ++$start; ?></th>
                                        <td class="align-middle"><?= $sb['id_member']; ?></td>
                                        <td class="align-middle"><?= $sb['nama']; ?></td>
                                        <td class="align-middle"><?= $sb['email']; ?></td>
                                        <td class="align-middle"><?= $sb['kelurahan']; ?></td>
                                        <td class="align-middle"><?= $sb['pendidikan']; ?></td>
                                        <td class="align-middle"><?= $sb['pekerjaan']; ?></td>
                                        <!-- <td class="align-middle">
                                            <?php if ($sb['is_active'] == 1) : ?>
                                                <span class="align-middle text-success"><i class="fas fa-fw fa-check"></i> Aktif</span>
                                            <?php elseif ($sb['is_active'] == 0) : ?>
                                                <span class="align-middle text-danger"><i class="fas fa-fw fa-exclamation"></i> Tidak Aktif</span>
                                            <?php endif; ?>
                                        </td> -->
                                        <td class="align-middle text-center">
                                            <h4><a href="<?= base_url('admin/detail/') . $sb['id_member']; ?>" class="badge badge-secondary" role="button" title="detail"><i class="far fa-fw fa-id-card"></i></a>
                                                <a href="<?= base_url('admin/edit/') . $sb['id_member']; ?>" class="badge badge-primary" role="button" title="edit"><i class="fas fa-fw fa-edit"></i></a>
                                                <!-- <a href="<?= base_url('printdoc/data/') . $sb['id_member']; ?>" class="badge badge-success" role="button" target="blank" title="print"><i class="fas fa-fw fa-print"></i></a> -->
                                                <a href="<?= base_url('admin/delete/') . $sb['id_member']; ?>" class="badge badge-danger tombol-hapus" role="button" title="delete"><i class="fas fa-fw fa-trash"></i></a></h4>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>

                        <?= $this->pagination->create_links(); ?>

                    </div>



                </div>
            </div>


        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->