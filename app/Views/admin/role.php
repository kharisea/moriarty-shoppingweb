<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>

<article class="manage">
    <div class="judul text-center">
        <span></span>
        </div> <br> <br>
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-6">

                <?php if($validation->hasError('role')) : ?>
                <div class="alert alert-danger" role="alert">
                <?= $validation->getError('role'); ?>
                </div>
                <?php endif; ?>

                <?php if(session()->getFlashdata('pesan')) : ?>
                  <div class="alert alert-success" role="alert">
                      <?= session()->getFlashdata('pesan') ?>
                  </div>
                <?php endif ?>

                <a href="" class="btn btn-primary tombolAddRole" data-bs-toggle="modal" data-bs-target="#roleModal">Add New Role</a> <hr>

                <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; ?>
                    <?php foreach($role as $r) : ?>
                        <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $r['role']; ?></td>
                        <td>
                            <a href="<?= base_url(); ?>/admin/role-access/<?= $r['id']; ?>" class="btn btn-warning tombolAccessRole">Access</a>
                            <a href="" class="btn btn-success tombolEditRole" data-bs-toggle="modal" data-bs-target="#roleModal" data-id="<?= $r['id']; ?>">Edit</a>

                          <form action="<?= base_url(); ?>/admin/role/<?= $r['id']; ?>" method="POST" class="d-inline">
                              <?= csrf_field(); ?>
                              <input type="hidden" name="_method" value="DELETE">
                              <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin Menghapus Role')";>Delete</button>
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
<div class="modal fade" id="roleModal" tabindex="-1" aria-labelledby="roleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="roleModalLabel">Title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url(); ?>" method="post">
        <input type="hidden" name="id" id="id">
      <div class="mb-3">
            <input type="text" class="form-control" id="role" name="role" placeholder="Role Name">
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

