<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<article>
<div class="container p-5">
    <div class="row p-3">
        <div class="col">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner rounded-2 shadow">
            <div class="carousel-item active">
            <img src="<?= base_url('img/lbdetail/'.$lookbook['gslide1']); ?>" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
            <img src="<?= base_url('img/lbdetail/'.$lookbook['gslide2']); ?>" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
            <img src="<?= base_url('img/lbdetail/'.$lookbook['gslide3']); ?>" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
        </div>
        </div>
    </div>
</div>
</article>
<?= $this->endSection(); ?>