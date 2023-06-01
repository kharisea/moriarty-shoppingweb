<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>

<article class="submanage">
    <div class="judul text-center">
        <span>SubMenu Magement</span>
        </div> <br> <br>
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg">
                    
                <?php if($validation->hasError('title')) : ?>
                <div class="alert alert-danger" role="alert">
                <?= $validation->getError('title'); ?>
                </div>
                <?php endif; ?>
                <?php if($validation->hasError('menu_id')) : ?>
                <div class="alert alert-danger" role="alert">
                <?= $validation->getError('menu_id'); ?>
                </div>
                <?php endif; ?>
                <?php if($validation->hasError('url')) : ?>
                <div class="alert alert-danger" role="alert">
                <?= $validation->getError('url'); ?>
                </div>
                <?php endif; ?>

                <?php if(session()->getFlashdata('pesan')) : ?>
                  <div class="alert alert-success" role="alert">
                      <?= session()->getFlashdata('pesan') ?>
                  </div>
                <?php endif ?>

                <a href="" class="btn btn-primary tombolAddSubMenu" data-bs-toggle="modal" data-bs-target="#submenuModal">Add New SubMenu</a> <hr>

                <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Url</th>
                        <th scope="col">Active</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; ?>
                    <?php foreach($subMenu as $sm) : ?>
                        <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $sm['title']; ?></td>
                        <td><?= $sm['menu']; ?></td>
                        <td><?= $sm['url']; ?></td>
                        <td><?= $sm['is_active']; ?></td>
                        <td>

                        <a href="" class="btn btn-success tombolEditSubMenu" data-bs-toggle="modal" data-bs-target="#submenuModal" data-id="<?= $sm['id']; ?>">Edit</a>

                        <form action="<?= base_url(); ?>/menu/submenu/<?= $sm['id']; ?>" method="POST" class="d-inline">
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
<div class="modal fade" id="submenuModal" tabindex="-1" aria-labelledby="submenuModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="submenuModalLabel">Add New Sub Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url(); ?>" method="post">
        <input type="hidden" name="id" id="id">
      <div class="mb-3">
            <input type="text" class="form-control" id="title" name="title" placeholder="SubMenu Name">
        </div>
        <div class="mb-3">
            <select name="menu_id" id="menu_id" class="form-control">
                <option value="">Select Menu</option>
                <?php foreach($menu as $m) : ?>
                    <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" id="url" name="url" placeholder="SubMenu URL">
        </div>
        <div class="mb-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
            <label class="form-check-label" for="is_active">
                Active?
            </label>
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

