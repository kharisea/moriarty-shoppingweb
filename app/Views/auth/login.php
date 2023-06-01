<?= $this->extend('layout/linkcss'); ?>


<?= $this->section('content'); ?>

<article class="login">
<div class="form-box shadow-lg" data-aos="zoom-in-up">
    <h2>MEMBER LOGIN</h2>
        <form method="post" action="<?= base_url('/auth/klikLogin'); ?>">
        <div class="input">
            <input type="email" name="email" id="email" required>
            <span></span>
            <label for="email">Email</label>
        </div>
        <div class="input">
            <input type="password" name="password" id="password" required>
            <span></span>
        <label for="password">Password</label>
    </div>
    <button type="submit" value="login">Login</button>
        <div class="signup">
        Not a Member? <a href="<?= base_url('/auth/register'); ?>">Signup</a>
    </div>
        <div class="sosmed">
            <a href="<?= base_url('/'); ?>">
                <img src="<?= base_url('img/login/bglogo.jpg'); ?>" alt="" class="rounded-circle">
            </a>
            </div>
    <?php if(session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-danger" role="alert">
             <?= session()->getFlashdata('pesan') ?>
        </div>
    <?php endif ?>

    </div>
</article>

<?= $this->endSection(); ?>