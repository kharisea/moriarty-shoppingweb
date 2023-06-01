<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>

<article class="addItem">
    <div class="judul text-center">
        <span></span>
        </div> <br> <br>
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg">


                <?php if($validation->hasError('nama')) : ?>
                <div class="alert alert-danger" role="alert">
                <?= $validation->getError('nama'); ?>
                </div>
                <?php endif; ?>
                <?php if($validation->hasError('harga')) : ?>
                <div class="alert alert-danger" role="alert">
                <?= $validation->getError('harga'); ?>
                </div>
                <?php endif; ?>
                <?php if($validation->hasError('stok')) : ?>
                <div class="alert alert-danger" role="alert">
                <?= $validation->getError('stok'); ?>
                </div>
                <?php endif; ?>
                <?php if($validation->hasError('ukuran')) : ?>
                <div class="alert alert-danger" role="alert">
                <?= $validation->getError('ukuran'); ?>
                </div>
                <?php endif; ?>
                <?php if($validation->hasError('sampul')) : ?>
                <div class="alert alert-danger" role="alert">
                <?= $validation->getError('sampul'); ?>
                </div>
                <?php endif; ?>


                <?php if(session()->getFlashdata('pesan')) : ?>
                  <div class="alert alert-success" role="alert">
                      <?= session()->getFlashdata('pesan') ?>
                  </div>
                <?php endif ?>


                <a href="" class="btn btn-primary tombolAdditem" data-bs-toggle="modal" data-bs-target="#itemModal">Add New Item</a> <hr>

                <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Ukuran</th>
                        <th scope="col">Sampul</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; ?>
                    <?php foreach($item as $it) : ?>
                        <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $it['nama']; ?></td>
                        <td>Rp. <?= substr_replace($it['harga'], ".", -3, 0); ?></td>
                        <td><?= $it['stok']; ?></td>
                        <td><?= $it['ukuran']; ?></td>
                        <td><img src="<?= base_url('img/article/'. $it['sampul']); ?>" alt="poster" class="poster"></td>
                        <td>
                            <a href="" class="btn btn-success tombolEdititem" data-bs-toggle="modal" data-bs-target="#itemModal" data-id="<?= $it['id']; ?>">Edit</a>

                          <form action="<?= base_url(); ?>/admin/<?= $it['id']; ?>" method="POST" class="d-inline">
                              <?= csrf_field(); ?>
                              <input type="hidden" name="_method" value="DELETE">
                              <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin Menghapus item?')";>Delete</button>
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
<div class="modal fade" id="itemModal" tabindex="-1" aria-labelledby="itemModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="itemModalLabel">Title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url(); ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" id="id">
        <input type="hidden" name="sampulLama" id="sampulLama">
      <div class="mb-3">
            <label for="nama" class="form-label">Nama Item</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Item Name">
        </div>
      <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control" id="harga" name="harga" placeholder="Item Price">
        </div>
      <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" class="form-control" id="stok" name="stok" placeholder="Item Stock">
        </div>
      <div class="mb-3">
            <label for="ukuran" class="form-label">Ukuran</label>
            <input type="text" class="form-control" id="ukuran" name="ukuran" placeholder="Item Size">
        </div>
        <div class="mb-3">
          <label for="sampul" class="form-label">Sampul</label>
          <input class="form-control form-control-sm" id="sampul" name="sampul" type="file" onchange="previewImg()">
          <div class="col-sm-2 mt-2">
            <img src="<?= base_url('img/default.jpg'); ?>" alt="image" class="img-thumbnail img-preview">
          </div>
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

