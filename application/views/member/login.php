<div class="container col-md-5 mx-auto">
    <div class="jumbotron login my-auto">
        <div class="image">
            <center><img src="<?= base_url(); ?>assets/img/logolibrary.jpg" alt="logo" width="100px" class="img img-responsive full-width rounded-circle mt-4"></center>
        </div>
        <div class="header">
            <h3 style="color:white">
                <center>Masuk Member</center>
            </h3>
        </div>
        <?= $this->session->flashdata('message'); ?>

        <hr style="border:1px solid light">
        <form action="<?= base_url('member/login'); ?>" method="post">
            <div class="form-group">
                <input type="text" id="email" name="email" class="form-control form-control-sm" placeholder="Enter Email Address..." value="<?= set_value('Enter Email Address...'); ?>">
                <?= form_error('email', '<small class="text-white pl-3">', '</small>'); ?>
            </div>

            <div class="form-group">
                <input type="password" id="password" name="password" class="form-control form-control-sm" placeholder="Password">
                <?= form_error('password', '<small class="text-white pl-3">', '</small>'); ?>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-block btn-success">Login</button>
            </div>
        </form>
        <hr>
        <div class="text-center">
            <a class="text-light" href="<?= base_url('member/registration'); ?>">Pendaftaran Member Baru</a>
        </div>
    </div>
</div>