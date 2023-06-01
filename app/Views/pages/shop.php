<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>

<article class="shop">
    <div class="container-fluid">
        <div class="judul text-center">
            <span></span>     
        </div> <br> <br>
        <h2 class="sub-judul fs-4"> MORIARTY > SHOP</h2>
        <div class="row pt-3 d-flex justify-content-end">
          <div class="col-6">
            <form action="" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Keywords pencarian..." name="keyword">
            <button class="btn btn-outline-secondary" type="submit" name="cari">Cari</button>
          </div>
          </form>
          </div>
        </div>

            <div class="items mt-4 mb-5">
            <?php $i = 1; ?>
            <?php foreach ($products as $prd) : ?>
            <div class="item" data-aos="fade-down">
                <a href="#formModal" class="tombolDetail" data-bs-toggle="modal" data-id="<?= $prd['id']; ?>">
              <img src="<?= base_url('img/article/'.$prd['sampul']); ?>" alt="">
                </a>
              <br>
              <div class="row">
                <div class="col">
                <h3 class="fs-6 fw-bold"><?= $prd['nama']; ?></h2><br>
                <p>
                    PRICE: Rp. <?= substr_replace($prd['harga'], ".", -3, 0); ?>
                </p>
            <form action="<?= base_url('/pages/addCartShop'); ?>" method="post">
                <input type="hidden" name="cookieId" id="cookieId" value=<?= $i; ?>>
                <input type="hidden" name="id" id="id" value="<?= $prd['id']; ?>">
                <button class="add-cart" type="submit" name="addCart" onclick="return confirm('TAMBAH KE KERANJANG?')";>ADD TO CART</button> 
                <br>   
                </div>
                </div>
          </div>
        </form>
          <?php $i++; ?>
          <?php endforeach ?>
        </div>
        <div class="row">
          <div class="col d-flex justify-content-center">
            <?= $pager->links('products', 'shop_pager'); ?>
          </div>
        </div>
    </div>
</article>

<!-- Modal -->
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="judulModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="judulModal">Detail Barang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body d-flex justify-content-center">
      <div class="card  border-3 border-warning" style="width: 18rem;">
        <img src="" class="card-img-top" id="sampul" alt="Gambar Baju/Barang">
        <div class="card-body ">
          <h5 class="card-title" id="nama">Nama Baju</h5>
          <p class="card-text fw-light fst-italic" id="created">Tanggal Rilis</p>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item" id="harga">Harga</li>
          <li class="list-group-item" id="stok">Stok</li>
          <li class="list-group-item" id="ukuran">Ukuran</li>
        </ul>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-warning" data-bs-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->

<?= $this->endSection(); ?>