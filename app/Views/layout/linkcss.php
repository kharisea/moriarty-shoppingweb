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

    <title><?= $title ?></title>
  </head>
  <body>

<?= $this->renderSection('content'); ?>

  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init({
      once: true
    });
  </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/TextPlugin.min.js"></script>

<script>
  gsap.registerPlugin(TextPlugin);
  gsap.from('.sosmed img', { duration: 1, rotateY: 360, opacity: 0});
  gsap.to('article.login h2.login', {duration: 4, text: "MEMBER LOGIN", ease: "back"});
  gsap.to('article.login h2.register', {duration: 4, text: "MEMBER REGISTER", ease: "back"});

</script>

    <script src="<?= base_url('js/bootstrap.min.js'); ?>"></script>
    <script src="<?= base_url('js/jquery-3.6.0.min.js'); ?>"></script>
    <script src="<?= base_url('js/script.js'); ?>"></script>
  </body>
</html>