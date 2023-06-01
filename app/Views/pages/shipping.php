<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>

<article class="shipping">
<div class="container-fluid">
    <div class="judul text-center">
        <span></span>
            </div><br><br>
        <h2 class="sub-judul fs-4">MORIARTY > SHIPPING</h2>
    <div class="row justify-content-center">
    <div class="shippings mt-4 justify-content-center">   
        <div class="shipping1">
            <img src="<?= base_url('img/shipping/box.png'); ?>" alt="">
            <p>
                Pesanan dikemas dan dikirim hanya pada hari Senin-Jumat. 
                Sebagian besar pesanan dikirim dalam waktu 24 jam dari tanggal 
                pemesanan. Pesanan yang dilakukan pada akhir pekan dan hari libur 
                tertentu diproses pada hari kerja berikutnya.
            </p>
        </div>
        <div class="shipping2">
            <img src="<?= base_url('img/shipping/pay.png'); ?>" alt="">
            <p>
                Jika kami tidak dapat memproses pesanan Anda karena informasi 
                pembayaran yang tidak akurat atau tidak lengkap, 
                pemrosesan pesanan Anda dapat dibatalkan.
            </p>
        </div>
        <div class="shipping3">
            <img src="<?= base_url('img/shipping/phone.png'); ?>" alt="">
            <p>
            Besarnya biaya pengiriman ditunjukkan saat pelanggan 
            melengkapi informasi alamat.
            </p>
        </div>
        </div>
        </div>
    </div>
</article>

<?= $this->endSection(); ?>