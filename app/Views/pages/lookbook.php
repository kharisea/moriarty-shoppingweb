<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>

<article class="lookbook">

  <div class="container-fluid">
    <div class="judul text-center">
    <span></span>
    </div><br><br>
    <h2 class="sub-judul fs-4">MORIARTY > LOOKBOOK</h2>
        <div class="row mt-4">
          <?php foreach($lookbooks as $lb) : ?>
            <div class="col-md-3 mb-4" data-aos="flip-left" data-aos-duration="1000">
              <div class="card lb-detail">
                <a href="<?= base_url('pages/lookbook/'.$lb['id']); ?>"> 
                <img src="<?= base_url('img/lookbook/'.$lb['gambarp']); ?>" class="card-img-top" alt="...">
                <span><p><?= $lb['namalb']; ?></p></span>
                </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
  </div>
</article>

<?= $this->endSection(); ?>