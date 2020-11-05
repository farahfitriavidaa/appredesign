<!DOCTYPE html>
<html lang="en">

    <?php $this->load->view('landingpage/Head'); ?>

<body>

  <main class="main-wrapper">

    <!-- Navigation -->
    <header class="nav">
      <div class="nav__holder nav--sticky">
        <div class="container-fluid container-semi-fluid nav__container">
          <div class="flex-parent">

            <div class="nav__header">
              <!-- Logo -->
              <a href="index.html" class="logo-container flex-child">
                <img class="logo" src="<?=base_url()?>asset/logo.png" srcset="<?=base_url()?>asset/logo.png 1x, <?=base_url()?>asset/logo.png 2x" alt="logooo">
              </a>

              <!-- Mobile toggle -->
              <button type="button" class="nav__icon-toggle" id="nav__icon-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="nav__icon-toggle-bar"></span>
                <span class="nav__icon-toggle-bar"></span>
                <span class="nav__icon-toggle-bar"></span>
              </button>
            </div>

            <!-- Navbar -->
            <nav id="navbar-collapse" class="nav__wrap collapse navbar-collapse">
              <ul class="nav__menu">
                <li class="active">
                  <a href="index.html">Beranda</a>
                </li>
                <li>
                  <a href="index.html">Designer</a>
                </li>
                <li>
                  <a href="index.html">Tentang Kami</a>
                </li>
                <li>
                  <a href="index.html">Kontak Kami</a>
                </li>
                <li>
                  <a href="<?=base_url()?>Create/login">Login</a>
                </li>
                <li>
                  <a href="<?=base_url()?>Create">Register
                </li>
              </ul>
            </nav>

            <div class="nav__btn-holder nav--align-right">
              <a href="#" class="btn nav__btn">
                <span class="nav__btn-text">Call us for Free</span>
                <span class="nav__btn-phone">63-995-3959</span>
              </a>
            </div>

          </div> <!-- end flex-parent -->
        </div> <!-- end container -->

      </div>
    </header> <!-- end navigation -->

    <!-- Triangle Image -->
    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
       viewBox="0 0 600 480" style="enable-background:new 0 0 600 480;" xml:space="preserve" class="triangle-img triangle-img--align-right">
      <g>
        <path class="st0" d="M232.16,108.54,76.5,357.6C43.2,410.88,81.5,480,144.34,480H455.66c62.83,0,101.14-69.12,67.84-122.4L367.84,108.54C336.51,58.41,263.49,58.41,232.16,108.54Z" fill="url(#img1)" />
        <path class="st0" d="M232.16,108.54,76.5,357.6C43.2,410.88,81.5,480,144.34,480H455.66c62.83,0,101.14-69.12,67.84-122.4L367.84,108.54C336.51,58.41,263.49,58.41,232.16,108.54Z" fill="url(#triangle-gradient)" fill-opacity="0.7" />
      </g>
      <defs>
        <pattern id="img1" patternUnits="userSpaceOnUse" width="500" height="500">
          <image xlink:href="img/hero/hero.jpg" x="50" y="70" width="500" height="500"></image>
        </pattern>

        <linearGradient id="triangle-gradient" y2="100%" x2="0" y1="50%" gradientUnits="userSpaceOnUse" >
        <stop offset="0" stop-color="#4C86E7"/>
        <stop offset="1" stop-color="#B939E5"/>
        </linearGradient>
      </defs>
    </svg>


    <div class="content-wrapper oh">

      <!-- Page Title -->
      <section class="page-title text-center">
        <div class="container">
          <div class="page-title__holder">
            <h1 class="page-title__title">Kontak Kami</h1>
          </div>
        </div>
      </section> <!-- end page title -->

      <!-- Contact -->
      <section class="section-wrap">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8">
              <div class="contact box-shadow-large offset-top-171">
                <center>
                <img src="<?=base_url()?>asset/logocdc.jpg" alt="">
              </center>
                <ul class="contact__items">
                  <li class="contact__item">
                    <address>Bangkit Building 3rd floor, Jl. Telekomunikasi Terusan Buah Batu Bandung</address>
                  </li>
                  <li class="contact__item">
                    <span class="contact__item-label">No. tlp: </span>
                    <a href="tel:+1-800-1554-456-123">Isti : 081320451745 | Sari : 081223951658</a>
                  </li>
                  <li class="contact__item">
                    <span class="contact__item-label">Email: </span>
                    <a href="mailto:cdc@telkomuniversity.ac.id">cdc@telkomuniversity.ac.id</a>
                  </li>
                </ul>

                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1980.1472419458028!2d107.63030305255332!3d-6.974541088618285!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x5a804adec3f366b!2sGedung%20Bangkit%20(Rektorat)!5e0!3m2!1sid!2sid!4v1604439619239!5m2!1sid!2sid" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

      <div id="back-to-top">
        <a href="#top"><i class="ui-arrow-up"></i></a>
      </div>

    </div> <!-- end content wrapper -->
<?php $this->load->view('landingpage/Footer'); ?>
</body>
</html>
