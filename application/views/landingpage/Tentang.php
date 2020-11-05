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
            <h1 class="page-title__title">Tentang Kami</h1>
            <p class="page-title__subtitle">Focus on engaging, reusable content that decrease the cost per leads while helps you to increase profits margin. Margin strives to deliver the tools and support that helps companies grow with unparalleled success.</p>
          </div>
        </div>
      </section> <!-- end page title -->

      <!-- Benefits -->
      <section class="section-wrap">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-10">
              <div class="benefits box-shadow-large offset-top-171">
                <h3 class="benefits__title">Sales organisations are able to set and manage performance goals</h3>
                <div class="row">
                  <div class="col-lg-6">
                    <ul class="benefits__list">
                      <li class="benefits__item">
                        <i class="ui-check benefits__item-icon"></i>
                        <span class="benefits__item-title">Develop a comprehensive paid search strategy</span>
                      </li>
                      <li class="benefits__item">
                        <i class="ui-check benefits__item-icon"></i>
                        <span class="benefits__item-title">Monitor performance throughout each sales</span>
                      </li>
                    </ul>
                  </div>
                  <div class="col-lg-6">
                    <ul class="benefits__list">
                      <li class="benefits__item">
                        <i class="ui-check benefits__item-icon"></i>
                        <span class="benefits__item-title">Develop a comprehensive paid search strategy</span>
                      </li>
                      <li class="benefits__item">
                        <i class="ui-check benefits__item-icon"></i>
                        <span class="benefits__item-title">Monitor performance throughout each sales</span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section> <!-- end benefits -->

      <!-- Statistic -->
      <section class="section-wrap bg-color-overlay" style="background-image: url(img/statistic/statistic.jpg);">
        <div class="container">
          <div class="row">
            <div class="col-lg-3">
              <div class="statistic">
                <span class="statistic__number">36</span>
                <h5 class="statistic__title">User</h5>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="statistic">
                <span class="statistic__number">100%</span>
                <h5 class="statistic__title">UMKM</h5>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="statistic">
                <span class="statistic__number">550</span>
                <h5 class="statistic__title">Designer</h5>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="statistic">
                <span class="statistic__number">3x</span>
                <h5 class="statistic__title">Order Fix</h5>
              </div>
            </div>
          </div>
        </div>
      </section> <!-- end statistic -->

      <!-- Team -->
      <section class="section-wrap">
        <div class="container">
          <div class="title-row title-row--boxed text-center">
            <h2 class="section-title">Meet Our Experts</h2>
            <p class="subtitle">Margin strives to deliver the tools and support that helps companies grow with unparalleled success.</p>
          </div>
          <div class="row">

            <div class="col-md-4">
              <div class="team">
                <img src="img/team/1.jpg" alt="" class="team__img">
                <h5 class="team__name">Philip Green</h5>
                <span class="team__occupation">CEO</span>
                <p class="team__text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.</p>
                <div class="socials">
                  <a href="#" class="social social-twitter" aria-label="twitter" title="twitter" target="_blank"><i class="ui-twitter"></i></a>
                  <a href="#" class="social social-facebook" aria-label="facebook" title="facebook" target="_blank"><i class="ui-facebook"></i></a>
                  <a href="#" class="social social-google-plus" aria-label="google plus" title="google plus" target="_blank"><i class="ui-google"></i></a>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="team">
                <img src="img/team/2.jpg" alt="" class="team__img">
                <h5 class="team__name">Melissa Shredinger</h5>
                <span class="team__occupation">Email Marketing</span>
                <p class="team__text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.</p>
                <div class="socials">
                  <a href="#" class="social social-twitter" aria-label="twitter" title="twitter" target="_blank"><i class="ui-twitter"></i></a>
                  <a href="#" class="social social-facebook" aria-label="facebook" title="facebook" target="_blank"><i class="ui-facebook"></i></a>
                  <a href="#" class="social social-google-plus" aria-label="google plus" title="google plus" target="_blank"><i class="ui-google"></i></a>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="team">
                <img src="img/team/3.jpg" alt="" class="team__img">
                <h5 class="team__name">Alexander Samokhin</h5>
                <span class="team__occupation">Developer</span>
                <p class="team__text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.</p>
                <div class="socials">
                  <a href="#" class="social social-twitter" aria-label="twitter" title="twitter" target="_blank"><i class="ui-twitter"></i></a>
                  <a href="#" class="social social-facebook" aria-label="facebook" title="facebook" target="_blank"><i class="ui-facebook"></i></a>
                  <a href="#" class="social social-google-plus" aria-label="google plus" title="google plus" target="_blank"><i class="ui-google"></i></a>
                </div>
              </div>
            </div>

          </div>
        </div>
      </section> <!-- end team -->

      <!-- CTA -->
      <div class="call-to-action text-center">
        <div class="call-to-action__container">
          <h3 class="call-to-action__title">
            Get, keep and grow more customers. We’re here to help.
          </h3>
          <a href="#" class="btn btn--lg btn--color">
            <span>Let’s Work Together</span>
          </a>
        </div>
      </div> <!-- end cta -->

      <!-- Footer -->
      <div id="back-to-top">
        <a href="#top"><i class="ui-arrow-up"></i></a>
      </div>

    </div> <!-- end content wrapper -->

<?php $this->load->view('landingpage/Footer'); ?>
</body>
</html>
