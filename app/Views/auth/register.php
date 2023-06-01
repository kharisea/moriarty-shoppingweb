<?= $this->extend('layout/linkcss'); ?>


<?= $this->section('content'); ?>

<article class="login">
<div class="form-box shadow-lg" data-aos="zoom-in-down">
    <h2>MEMBER REGISTER</h2>
        <form method="post" action="<?= base_url('/auth/registration'); ?>">
        <?= csrf_field(); ?>
        <div class="input">
            <input type="email" name="email" id="email" value="<?= old('email'); ?>" required>
            <span></span>
            <label for="email">Email</label>
        </div>
        <div class="input">
            <input type="text" name="name" id="name" value="<?= old('name'); ?>" required>
            <span></span>
            <label for="name">Nama</label>
        </div>
        <div class="input">
            <input type="password" name="password" id="password" value="<?= old('password'); ?>" required>
            <span></span>
            <label for="password">Password</label>
        </div>
        <button type="submit" value="register">Register</button>
        <div class="signup">
        Already have an Account? <a href="<?= base_url('/auth/login'); ?>">Login</a>
    </div>
        <div class="sosmed">
            <a href="<?= base_url('/'); ?>">
                <img src="<?= base_url('img/login/bglogo.jpg'); ?>" alt="" class="rounded-circle">
            </a>
        </div>

    <?php if($validation->hasError('email')) : ?>
    <div class="alert alert-danger" role="alert">
        <?= $validation->getError('email'); ?>
    </div>
    <?php endif ?>
    <?php if(session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success" role="alert">
             <?= session()->getFlashdata('pesan') ?>
        </div>
    <?php endif ?>
    </div>
</article>

<?= $this->endSection(); ?>