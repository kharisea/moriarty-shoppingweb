<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>

<article class="manage">
    <div class="judul text-center">
        <span></span>
        </div> <br> <br>
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-6">

                <?php if(session()->getFlashdata('pesan')) : ?>
                  <div class="alert alert-success" role="alert">
                      <?= session()->getFlashdata('pesan') ?>
                  </div>
                <?php endif ?>


                <h5>Role: <?= $role['role']; ?></h5>

                <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Access</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; ?>
                    <?php foreach($menu as $m) : ?>
                        <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $m['menu']; ?></td>
                        <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" <?= check_access($role['id'], $m['id']); ?> data-role="<?= $role['id']; ?>" data-menu="<?= $m['id']; ?>"> 
                        </div>
                        </td>
                        </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
</article>

<?= $this->endSection(); ?>

