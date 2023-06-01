<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?= base_url('img/navbar/LOGO.png'); ?>" type="image/x-icon">

  <!-- AOS -->
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <!-- Bootstrap CSS -->
    <link href="<?= base_url('css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('css/style.css'); ?>" rel="stylesheet">

    <title><?= $title; ?> | MORIARTY </title>
  </head>
  <body>

<?= $this->include('layout/header'); ?>

<?= $this->renderSection('content'); ?>


<footer class="text-center text-lg-start bg-dark text-light mt-5">
  <!-- Section: Social media -->

  <!-- Section: Links  -->
  <section class="pt-3">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <!-- Content -->
          <h6 class="text-uppercase fw-bold mb-4 fs-5">
            <i class="fas fa-gem"></i>MORIARTY
          </h6>
          <p>
            Moriarty merupakan sebuah brand T-Shirt di Indonesia tepatnya di Makassar
          </p>
        </div>
        <!-- Grid column -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4 fs-5">
            Contact
          </h6>
          <p><i class="fas fa-home"></i>Makassar, Jl-Moncongloe 02, IND</p>
          <p>
            <i class="fas fa-envelope"></i>
            moriarty@example.com
          </p>
          <p><i class="fas fa-phone"></i> +628124567890</p>
        </div>
        <!-- Grid column -->
                <!-- Grid column -->
        <div class="col-md-2 col-lg-2 col-xl-3 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4 fs-5">
            CONNECT WITH US
          </h6>
          <div class="input-group mb-3">
            <form action="<?= base_url('/pages/sendMail'); ?>" method="post" class="d-flex">
          <input type="email" id="email" name="email" class="form-control" placeholder="email@example.com">
          <button class="btn btn-outline-warning" type="submit" id="button-addon2" name="join">JOIN</button>
          </form>
        </div>
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#ff5500" fill-opacity="1" d="M0,96L40,106.7C80,117,160,139,240,133.3C320,128,400,96,480,106.7C560,117,640,171,720,197.3C800,224,880,224,960,202.7C1040,181,1120,139,1200,117.3C1280,96,1360,96,1400,96L1440,96L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path></svg>
  </section>
  <!-- Section: Links  -->

</footer>
<!-- Footer -->

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>

<script>
  const item = document.querySelectorAll('.item');

  item.forEach((item, i ) =>{
    item.dataset.aosDelay = i * 50;
  })
</script>

  <script>

    AOS.init({
      offset: 150,
      once: true
    });
  </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/TextPlugin.min.js"></script>

<script>
  gsap.registerPlugin(TextPlugin);
  gsap.from('.navbar', { duration: 0.5, y: '-100%', opacity: 0});
  gsap.to('article.shop .judul span', {duration: 2, text: "SHOP", ease: "back"});
  gsap.to('article.lookbook .judul span', {duration: 2, text: "LOOKBOOK", ease: "back"});
  gsap.to('article.shipping .judul span', {duration: 2, text: "SHIPPING", ease: "back"});
  gsap.to('article.about .judul span', {duration: 2, text: "ABOUT", ease: "back"});
  gsap.to('article.profile .judul span', {duration: 2, text: "MY PROFILE", ease: "back"});
  gsap.to('article.editProfile .judul span', {duration: 2, text: "EDIT PROFILE", ease: "back"});
  gsap.to('article.manage .judul span', {duration: 2, text: "ROLE", ease: "back"});
  gsap.to('article.dashboard .judul span', {duration: 2, text: "DASHBOARD", ease: "back"});
  gsap.to('article.addLookbook .judul span', {duration: 2, text: "LOOKBOOK MANAGEMENT", ease: "back"});
  gsap.to('article.addLookbook .judul span', {duration: 2, text: "LOOKBOOK MANAGEMENT", ease: "back"});
  gsap.to('article.addItem .judul span', {duration: 2, text: "ITEM MANAGEMENT MANAGEMENT", ease: "back"});
</script>

    <script src="<?= base_url('js/bootstrap.min.js'); ?>"></script>
    <script src="<?= base_url('js/jquery-3.6.0.min.js'); ?>"></script>
    <script src="<?= base_url('js/script.js'); ?>"></script>


  </body>
</html>

