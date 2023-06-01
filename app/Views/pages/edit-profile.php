<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<?php if(session()->has('email') && session()->has('role_id')) : ?>
<article class="editProfile">
    <div class="judul text-center">
        <span></span>
        </div>
    <div class="container pt-5">
        <div class="row">
            <div class="col-lg-8">

            <?php if($validation->hasError('name')) : ?>
                <div class="alert alert-danger" role="alert">
                <?= $validation->getError('name'); ?>
                </div>
            <?php endif; ?>
            <?php if($validation->hasError('gambar')) : ?>
                <div class="alert alert-danger" role="alert">
                <?= $validation->getError('gambar'); ?>
                </div>
            <?php endif; ?>

            <?php if(session()->getFlashdata('pesan')) : ?>
                  <div class="alert alert-success" role="alert">
                      <?= session()->getFlashdata('pesan') ?>
                  </div>
                <?php endif ?>

            <form action="<?= base_url('/pages/changeProfile') ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id" value="<?= $user['id']; ?>">
                <input type="hidden" id="gambarLama" name="gambarLama" value="<?= $user['gambar']; ?>">
                <div class="row mb-3">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="name" class="col-sm-2 col-form-label">Full Name</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="gambar" class="col-sm-2 col-form-label">Foto Profile</label>
                    <div class="col-sm-2">
                        <img src="<?= base_url('img/profile/'.$user['gambar']); ?>" alt="gambar" class="img-thumbnail img-profile">
                    </div>
                    <div class="col-sm-8">
                    <input class="form-control" id="gambar" name="gambar" type="file" onchange="previewProfile()">
                    </div>
                </div>
            
                <div class="row mb-3 justify-content-end">
                    <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Change Profile</button>
                    </div>
                </div>
            </form>

            </div>
        </div>
    </div>

</article>
<?php else : ?>
<article class="profile p-5 mt-5">
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </symbol>
</svg>
        <div class="alert alert-warning d-flex align-items-center justify-content-center fw-bold fs-4" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
           Anda belum <a href="<?= base_url('/pages/login'); ?>">login</a>, silahkan <a href="<?= base_url('/pages/login'); ?>">login</a> untuk edit profile!
        </div>
        </div>
</article>
<?php endif; ?>

<?= $this->endSection(); ?>