<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="d-block p-2 bg-light">
            <div class="porlets-content mt-sm-3">
                <!-- Daftar Buku -->

                <div class="col-sm-12 mx-auto">

                    <?php if (validation_errors()) : ?>
                        <div class="buku" data-buku="<?= validation_errors(); ?>"></div>
                    <?php endif; ?>

                    <div class="buku" data-buku="<?= $this->session->flashdata('flash'); ?>"></div>

                    <!-- <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div> -->

                    <div class="row mt-3 mb-2">
                        <div class="col-md-4">
                            <a href="<?= base_url('buku/add'); ?>" class="btn btn-primary">Tambah Data Buku</a>
                        </div>

                        <div class="col-md-2">
                            <h5 class="mt-2 mb-2">Results : <?= $total_rows; ?></h5>
                        </div>

                        <div class="col-md-6">
                            <form action="<?= base_url('buku'); ?>" method="post">

                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Search keyword.." name="keyword" autocomplete="off" autofocus>
                                    <div class="input-group-append">
                                        <input class="btn btn-primary fas fa-search" type="submit" name="submit">
                                        <!-- <button class="btn btn-circle btn-primary" type="submit" name="submit"><i class="fas fa-search"></i></button> -->
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>

                    <table class="table table-sm table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="align-middle text-center">No</th>
                                <th scope="col" class="align-middle">No. ISBN</th>
                                <th scope="col" class="align-middle">Judul</th>
                                <th scope="col" class="align-middle">Pengarang</th>
                                <th scope="col" class="align-middle">Penerbit</th>
                                <th scope="col" class="align-middle">Tahun Terbit</th>
                                <th scope="col" class="align-middle">Jumlah Halaman</th>
                                <th scope="col" class="align-middle">Lokasi</th>
                                <!-- <th scope="col" class="align-middle">Status</th> -->
                                <th scope="col" class="align-middle text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php if (empty($t_buku)) : ?>
                                <tr>
                                    <td colspan="8">
                                        <div class="alert alert-danger" role="alert">
                                            data not found.
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>

                            <?php foreach ($t_buku as $sb) : ?>

                                <tr>
                                    <th class="align-middle text-center" scope="row"><?= ++$start; ?></th>
                                    <td class="align-middle"><?= $sb['isbn']; ?></td>
                                    <td class="align-middle"><?= $sb['judul']; ?></td>
                                    <td class="align-middle"><?= $sb['pengarang']; ?></td>
                                    <td class="align-middle"><?= $sb['penerbit']; ?></td>
                                    <td class="align-middle"><?= $sb['th_terbit']; ?></td>
                                    <td class="align-middle"><?= $sb['jml_hal']; ?></td>
                                    <td class="align-middle"><?= $sb['id_lokasi']; ?></td>
                                    <!-- <td class="align-middle">
                                            <?php if ($sb['is_active'] == 1) : ?>
                                                <span class="align-middle text-success"><i class="fas fa-fw fa-check"></i> Aktif</span>
                                            <?php elseif ($sb['is_active'] == 0) : ?>
                                                <span class="align-middle text-danger"><i class="fas fa-fw fa-exclamation"></i> Tidak Aktif</span>
                                            <?php endif; ?>
                                        </td> -->
                                    <td class="align-middle text-center">
                                        <h4><a href="<?= base_url('buku/detail/') . $sb['id']; ?>" class="btn btn-circle btn-secondary" role="button" title="detail"><i class="far fa-fw fa-id-card"></i></a></h4>
                                        <h4><a href="<?= base_url('buku/edit/') . $sb['id']; ?>" class="btn btn-circle btn-primary" role="button" title="edit"><i class="fas fa-fw fa-edit"></i></a></h4>
                                        <!-- <a href="<?= base_url('printdoc/data/') . $sb['id']; ?>" class="btn btn-circle btn-success" role="button" target="blank" title="print"><i class="fas fa-fw fa-print"></i></a> -->
                                        <h4><a href="<?= base_url('buku/delete/') . $sb['id']; ?>" class="btn btn-circle btn-danger tombol-bukuhapus" role="button" title="delete"><i class="fas fa-fw fa-trash"></i></a></h4>
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
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->