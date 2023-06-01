<!DOCTYPE html>
<html lang="en">


    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Checkout | Moriarty</title>
        <link rel="shortcut icon" href="<?= base_url('img/navbar/LOGO.png'); ?>" type="image/x-icon">
        <link href="<?= base_url('css/bootstrap.min.css'); ?>" rel="stylesheet">
        <link href="<?= base_url('css/checkout.css'); ?>" rel="stylesheet">
    </head>


    <body>
    <section class="h-100 h-custom" style="background-color: #fc8803;">
  <div class="container-fluid py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100 me-5">
      <div class="col-lg-8 col-xl-6">
        <div class="card border-top border-bottom border-5 shadow overflow-auto" style="border-color: #f37a27 !important;">
          <div class="card-body p-5">

            <p class="lead fw-bold mb-5" style="color: #f37a27;">Checkout Details</p>

            <div class="row">
              <div class="col mb-3">
                <p class="small text-muted mb-1">Date</p>
                <p><?= date("Y-m-d-l", time()); ?></p>
              </div>
              <div class="col mb-3">
                <p class="small text-muted mb-1">Order By.</p>
                <p><?= $user['name']; ?> </p>
              </div>
            </div>

            <?php 
                $length = count($nama);
                $total = 0;
            ?>
            <?php for($i=0; $i<$length; $i++) : ?>
            <div class="mx-n5 px-5 py-4" style="background-color: #f2f2f2;">
              <div class="row">
                <div class="col-md col-lg-8">
                  <p class="fw-bold"><?= $nama[$i]. " [".$size[$i]."]". "&nbsp &nbsp"; ?> <span class="text-primary"> x <?= $qty[$i]; ?></span></p>
                </div>
                <div class="col-md col-lg-4">
                  <p>Rp. <?= number_format($harga[$i], 0,',','.'); ?></p>
                </div>
              </div>
            </div>
            <?php $total += $harga[$i]; ?>
            <?php endfor; ?>

            <div class="row my-4">
              <div class="col-md offset-md col-lg offset-lg d-flex justify-content-end">
                <p class="lead fw-bold mb-0" style="color: #f37a27;">Rp. <?= number_format($total, 0,',','.'); ?></p>
              </div>
            </div> 
            <p class="text-success fw-bold">Pesanan Anda Akan Segera Dikirim ^_^</p>

            <p class="mt-4 pt-2 mb-0">Back to Cart? <a href="<?= base_url('/pages/cart') ?>" style="color: #f37a27;">GO</a></p>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
    </body>


</html>