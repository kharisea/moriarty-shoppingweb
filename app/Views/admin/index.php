<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>

<article class="dashboard">
        <div class="container-fluid">
            <div class="judul text-center">
            <span></span>
        </div><br><br>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card text-center">
                    <div class="card-header">
                        <h5 class="card-title">MANAGE ITEM</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Untuk menambah/edit/hapus item ke halaman shop klik tombol di bawah ini.</p>
                        <a href="<?= base_url('/admin/item'); ?>" class="btn btn-dark">Go Manage</a>
                    </div>
                    </div>
                </div>
                <div class="col-lg-12 pt-5">
                    <div class="card text-center">
                    <div class="card-header">
                        <h5 class="card-title">MANAGE LOOKBOOK</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Untuk menambah/edit/hapus lookbook dan detail lookbook klik tombol di bawah ini.</p>
                        <a href="<?= base_url('/admin/lookbook'); ?>" class="btn btn-secondary">Go Manage</a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
</article>

<?= $this->endSection(); ?>

