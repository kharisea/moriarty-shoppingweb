<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>


<article class="about">
    <div class="container-fluid">
        <div class="judul text-center">
        <span></span>
        </div><br><br>
        <h2 class="sub-judul fs-4">MORIARTY > ABOUT</h2>
     <div class="row row-cols-2 mt-5 px-5 justify-content-center">
        <div class="col logo" data-aos="fade-right" data-aos-delay="800">
            <img src="<?= base_url('img/about/bglogo.JPG'); ?>" alt="LOGO" class="bglogo">
        </div>
        <div class="col about" data-aos="fade-left" data-aos-delay="1000">
            <h3 class="fw-bold">ABOUT MORIARTY</h3>
            <p>Website ini hanyalah sebuah website tugas, produk moriarty yang ada di dalam web ini
                memiliki banyak perbedaan dari produk asli moriarty, ini hanyalah ilustrasi!</p>
                <div class="sosmed">
                <a href="https://wa.me/qr/6KM6NOVVOKRAD1" target="_blank">
                    <img src="<?= base_url('img/about/whatsapp.png'); ?>" alt="">
                    </a>
                    <a href="mailto:ataufan509@gmail.com" target="_blank">
                    <img src="<?= base_url('img/about/email.png'); ?>" alt="">
                </a>
                <a href="https://www.instagram.com/moriartyid.club/" target="_blank">
                    <img src="<?= base_url('img/about/instagram.png'); ?>" alt="">
                </a>
        </div>
     </div>
    </div>
</div>
</article>

<?= $this->endSection(); ?>

