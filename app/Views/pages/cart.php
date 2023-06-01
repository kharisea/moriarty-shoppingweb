<?= $this->extend('layout/linkcss'); ?>


<?= $this->section('content'); ?>

<article class="cart">

<div class="container bg-light overflow-auto rounded-3 shadow cart-box">
    <div class="row border-bottom border-5 border-warning p-3">
        <div class="col">
            <h2 class="judulcart fs-4 fw-bold">Shopping Cart</h2>
        </div>
    </div>
  <?php for ($i=0; $i < 50 ; $i++) : ?>
    
    <?php if(session()->has('email')) : ?>
      <?php 
        $sesCookie = session()->get('email');
        $specialChars = array(" ", "-", "_", ".", ",", '^', '@');
        $sesCookie = str_replace($specialChars,"", $sesCookie);
      ?> <?php if(isset($_COOKIE[$sesCookie.$i])) : ?>     
      <?php 
          $cartId = $_COOKIE[$sesCookie.$i];
          $cart = stripslashes($cartId);    // string is stored with escape double quotes 
          $cart = json_decode($cart, true);
      ?>
      <input type="hidden" name="nama[]" id="nama" value="<?= $cart['nama']; ?>" form="formCheckout">
      <input type="hidden" name="harga[]" id="harga" value="<?= $cart['harga']; ?>" form="formCheckout">
          <div class="row g-2 p-3 border-bottom border-secondary border-2 mt-2 cart-konten">
            <div class="col-8">
              <div class="p-3 bg-light d-flex">
                <img src="<?= base_url('img/article/'.$cart['sampul']); ?>" alt="" class="bg-warning rounded-3 img-thumbnail shadow-sm" style = "border: 2px solid #fc3d03">
                <div class="container ms-5 align-self-center fs-6">
                <h3><?= $cart['nama']; ?></h3>
                    <p>Price: Rp.  <?= substr_replace($cart['harga'], ".", -3, 0); ?></p>
                    <label for="size">Ukuran: </label>
                    <select name="size[]" id="size" form="formCheckout">
                        <option value="M" selected>M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                </select>
                <br><br>
                    <label for="quantity">Jumlah: </label>
                    <select name="quantity[]" id="quantity" form="formCheckout">
                        <option value="1" selected>1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                </select>
                </div>
              </div>
              </div>
              <div class="row">
                <div class="col-lg ms-2">
                <form action="<?= base_url('pages/deltCookies'); ?>" method="post">
                    <input type="hidden" name="cookies" id="cookies" value="<?= $sesCookie.$i; ?>">
                    <button type="submit" class="btn btn-danger fs-5 fw-bold rounded-3" name="remove" onclick="return confirm('HAPUS DARI KERANJANG?')";>REMOVE</button>
                </form>
                </div>
                </div>
          </div>
      <?php endif; ?>
    <?php endif; ?>
  <?php endfor; ?>

    <div class="row mt-5 p-3">
        <div class="col d-flex justify-content-between">
            <a href="<?= base_url('/pages/shop'); ?>" class="text-danger text-decoration-none back">
            <span><p class="fs-5"> <- Back To Shop</p></span>
            </a>
            <form action="<?= base_url('pages/checkout'); ?>" method="post" id="formCheckout">
            <button type="submit" name="checkout" class="bg-warning fw-bold text-white">CHECKOUT</button>
            </form>
        </div>
    </div>
</div>

</article>


<?= $this->endSection(); ?>