<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>

<article class="manage">
    <div class="judul text-center">
        <span>Menu Magement</span>
        </div> <br> <br>
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-6">

                <?php if($validation->hasError('menu')) : ?>
                <div class="alert alert-danger" role="alert">
                <?= $validation->getError('menu'); ?>
                </div>
                <?php endif; ?>

                <?php if(session()->getFlashdata('pesan')) : ?>
                  <div class="alert alert-success" role="alert">
                      <?= session()->getFlashdata('pesan') ?>
                  </div>
                <?php endif ?>

                <a href="" class="btn btn-primary tombolAddMenu" data-bs-toggle="modal" data-bs-target="#menuModal">Add New Menu</a> <hr>

                <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; ?>
                    <?php foreach($menu as $m) : ?>
                        <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $m['menu']; ?></td>
                        <td>
                            <a href="" class="btn btn-success tombolEditMenu" data-bs-toggle="modal" data-bs-target="#menuModal" data-id="<?= $m['id']; ?>">Edit</a>

                          <form action="<?= base_url(); ?>/menu/<?= $m['id']; ?>" method="POST" class="d-inline">
                              <?= csrf_field(); ?>
                              <input type="hidden" name="_method" value="DELETE">
                              <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin Menghapus Menu?')";>Delete</button>
                          </form>

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


<!-- Modal -->
<div class="modal fade" id="menuModal" tabindex="-1" aria-labelledby="menuModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="menuModalLabel">Title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url(); ?>" method="post">
        <input type="hidden" name="id" id="id">
      <div class="mb-3">
            <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu Name">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Confirm</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- END MODAL -->
<?= $this->endSection(); ?>

