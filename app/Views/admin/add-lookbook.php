<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>

<article class="addLookbook">
    <div class="judul text-center">
        <span></span>
        </div> <br> <br>
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg">

                <?php if($validation->hasError('namalb')) : ?>
                <div class="alert alert-danger" role="alert">
                <?= $validation->getError('namalb'); ?>
                </div>
                <?php endif; ?>

                <?php if($validation->hasError('gambarp')) : ?>
                <div class="alert alert-danger" role="alert">
                <?= $validation->getError('gambarp'); ?>
                </div>
                <?php endif; ?>

                <?php if($validation->hasError('gslide1')) : ?>
                <div class="alert alert-danger" role="alert">
                <?= $validation->getError('gslide1'); ?>
                </div>
                <?php endif; ?>
                <?php if($validation->hasError('gslide2')) : ?>
                <div class="alert alert-danger" role="alert">
                <?= $validation->getError('gslide2'); ?>
                </div>
                <?php endif; ?>
                <?php if($validation->hasError('gslide3')) : ?>
                <div class="alert alert-danger" role="alert">
                <?= $validation->getError('gslide3'); ?>
                </div>
                <?php endif; ?>


              
                <?php if(session()->getFlashdata('pesan')) : ?>
                  <div class="alert alert-success" role="alert">
                      <?= session()->getFlashdata('pesan') ?>
                  </div>
                <?php endif ?>

                <a href="" class="btn btn-primary tombolAddlookbook" data-bs-toggle="modal" data-bs-target="#lookbookModal">Add New Lookbook</a> <hr>

                <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Judul Lookbook</th>
                        <th scope="col">Poster Lookbook</th>
                        <th scope="col">Gambar Slide 1</th>
                        <th scope="col">Gambar Slide 2</th>
                        <th scope="col">Gambar Slide 3</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; ?>
                    <?php foreach($lookbook as $lb) : ?>
                        <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $lb['namalb']; ?></td>
                        <td><img src="<?= base_url('img/lookbook/'. $lb['gambarp']); ?>" alt="poster" class="poster"></td>
                        <td><img src="<?= base_url('img/lbdetail/'. $lb['gslide1']); ?>" alt="slidesh" class="slidesh"></td>
                        <td><img src="<?= base_url('img/lbdetail/'. $lb['gslide2']); ?>" alt="slidesh" class="slidesh"></td>
                        <td><img src="<?= base_url('img/lbdetail/'. $lb['gslide3']); ?>" alt="slidesh" class="slidesh"></td>
                        <td>
                            <a href="" class="btn btn-success tombolEditlookbook" data-bs-toggle="modal" data-bs-target="#lookbookModal" data-id="<?= $lb['id']; ?>">Edit</a>

                          <form action="<?= base_url(); ?>/admin/lookbook/<?= $lb['id']; ?>" method="POST" class="d-inline">
                              <?= csrf_field(); ?>
                              <input type="hidden" name="_method" value="DELETE">
                              <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin Menghapus Lookbook?')";>Delete</button>
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
<div class="modal fade" id="lookbookModal" tabindex="-1" aria-labelledby="lookbookModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="lookbookModalLabel">Title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url(); ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" id="id">
        <input type="hidden" name="posterLama" id="posterLama">
        <input type="hidden" name="gslideLama1" id="gslideLama1">
        <input type="hidden" name="gslideLama2" id="gslideLama2">
        <input type="hidden" name="gslideLama3" id="gslideLama3">
      <div class="mb-3">
            <label for="namalb" class="form-label">Nama Lookbook</label>
            <input type="text" class="form-control" id="namalb" name="namalb" placeholder="Lookbook Name">
        </div>
      <div class="mb-3">
      <label for="gambarp" class="form-label">Poster</label>
          <input class="form-control form-control-sm " id="gambarp" name="gambarp" type="file" onchange="previewImgLb1()">
                    <div class="col-sm-2 mt-2">
            <img src="<?= base_url('img/default.jpg'); ?>" alt="image" class="img-thumbnail img-previewlb1">
          </div>
        </div>
      <div class="mb-3">
      <label for="gslide1" class="form-label">Slideshow 1</label>
          <input class="form-control form-control-sm " id="gslide1" name="gslide1" type="file" onchange="previewImgLb2()">
                    <div class="col-sm-2 mt-2">
            <img src="<?= base_url('img/default.jpg'); ?>" alt="image" class="img-thumbnail img-previewlb2">
          </div>
        </div>
      <div class="mb-3">
      <label for="gslide2" class="form-label">Slideshow 2</label>
          <input class="form-control form-control-sm " id="gslide2" name="gslide2" type="file" onchange="previewImgLb3()">
                    <div class="col-sm-2 mt-2">
            <img src="<?= base_url('img/default.jpg'); ?>" alt="image" class="img-thumbnail img-previewlb3">
          </div>
        </div>
      <div class="mb-3">
      <label for="gslide3" class="form-label">Slideshow 3</label>
          <input class="form-control form-control-sm " id="gslide3" name="gslide3" type="file" onchange="previewImgLb4()">
                    <div class="col-sm-2 mt-2">
            <img src="<?= base_url('img/default.jpg'); ?>" alt="image" class="img-thumbnail img-previewlb4">
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

