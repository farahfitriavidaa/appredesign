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

      <!-- Hero -->
      <section class="hero">

        <div class="container">
          <div class="row">
            <div class="col-lg-5 offset-lg-1">
              <div class="hero__text-holder">
                <h1 class="hero__title hero__title--boxed">Ingin produkmu di buat menarik?!</h1>
                <h2 class="hero__subtitle">Yuk re-design kemasan mu disini✅✅</h2>
              </div>
            </div>
          </div>

          <div class="row justify-content-center">
            <div class="col-lg-10">
              <!-- Optin Form -->
              <div class="optin">
                <div class="row">
                  <div class="col md-6">
                    <h3 class="optin__title">Segera bergabung dengan kami</h3>
                  </div>
                  <div class="col md-6">
                    <button class="optin__btn btn btn--md btn--color btn--button">
                      <a href="<?=base_url()?>Create" style="color:white">Klik disini</a>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section> <!-- end hero -->

      <!-- Service Boxes -->
      <section class="section-wrap pb-72 pb-lg-40">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-7">
              <div class="title-row">
                <h2 class="section-title text-center">
                  “Creativity is nothing but the way to solve <span class="highlight">new problems</span>.”
                </h2>
                <h4> - Diana Santos, Product Strategist and Manager at Intelia</h4>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4">
              <div class="feature box-shadow hover-up hover-line">
                <img src="<?=base_url()?>asset/landingpage/img/icons/logo.png" width="100px">
                <h4 class="feature__title">Logo</h4>
                <p class="feature__text">Simbol untuk mengingatkan para konsumen terkait UMKM yang Anda miliki!</p>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="feature box-shadow hover-up hover-line">
                  <img src="<?=base_url()?>asset/landingpage/img/icons/produk.png" width="100px">
                <h4 class="feature__title">Foto Produk</h4>
                <p class="feature__text">Kualitas foto produk sangat penting bagi para konsumen untuk terlihat lebih menarik untuk membeli</p>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="feature box-shadow hover-up hover-line">
                  <img src="<?=base_url()?>asset/landingpage/img/icons/kemasan.png" width="100px">
                <h4 class="feature__title">Kemasan</h4>
                <p class="feature__text">Kemasan yang menarik pun dapat lebih sering dibeli oleh para konsumen</p>
              </div>
            </div>
          </div>
        </div>
      </section> <!-- end service boxes -->

      <!-- Promo Section -->
      <section class="section-wrap promo-section promo-section--pb-large pt-lg-40">

        <!-- Triangle Image -->
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
           viewBox="0 0 600 480" style="enable-background:new 0 0 600 480;" xml:space="preserve" class="triangle-img triangle-img--align-left">
          <g>
            <path class="st0" d="M232.16,108.54,76.5,357.6C43.2,410.88,81.5,480,144.34,480H455.66c62.83,0,101.14-69.12,67.84-122.4L367.84,108.54C336.51,58.41,263.49,58.41,232.16,108.54Z" fill="url(#img2)" />
          </g>
          <defs>
            <pattern id="img2" patternUnits="userSpaceOnUse" width="600" height="600">
              <image xlink:href="img/promo/promo_img_1.jpg" width="600" height="600"></image>
            </pattern>
          </defs>
        </svg>

        <div class="container">
          <div class="row justify-content-end">
            <div class="col-lg-6">
              <h2 class="promo-section__title promo-section__title--boxed">gDESK</h2>
              <p class="promo-section__text lead">Di masa pandemi ini banyak sekali dampak yang di alami oleh para UMKM-UMKM. Namun kita tidak boleh untuk menyerah karena kita bisa melawan pandemi ini dengan cara melakukan pembaruan dalam re-branding</p>
              <a href="#" class="btn btn--lg btn--color btn--icon">
                <span>Klik disini</span>
                <i class="ui-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
      </section> <!-- end promo section -->


      <!-- Testimonials -->
      <section class="section-wrap bg-color">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-10">
              <div class="title-row">
                <h2 class="section-title">Testimoni</h2>
                <p class="subtitle">Berikut adalah testimoni dari UMKM</p>
              </div>

              <div id="owl-testimonials" class="owl-carousel owl-theme owl-carousel--arrows-outside">

                <div class="testimonial clearfix">
                  <img src="img/testimonials/1.png" alt="" class="testimonial__img">
                  <div class="testimonial__info">
                    <span class="testimonial__author">Joeby Ragpa</span>
                    <span class="testimonial__company">DeoThemes</span>
                  </div>
                  <div class="testimonial__body">
                    <p class="testimonial__text">“I have witnessed and admired the work for years. I highly recommend this work for anyone seeking to increase.”</p>
                    <div class="testimonial__rating">
                      <i class="ui-star"></i>
                      <i class="ui-star"></i>
                      <i class="ui-star"></i>
                      <i class="ui-star"></i>
                      <i class="ui-star"></i>
                    </div>
                  </div>
                </div>

                <div class="testimonial clearfix">
                  <img src="img/testimonials/2.png" alt="" class="testimonial__img">
                  <div class="testimonial__info">
                    <span class="testimonial__author">Alexander Samokhin</span>
                    <span class="testimonial__company">DeoThemes</span>
                  </div>
                  <div class="testimonial__body">
                    <p class="testimonial__text">“Every detail has been taken care these team are realy amazing and talented! I will work only to help your sales goals.”</p>
                    <div class="testimonial__rating">
                      <i class="ui-star"></i>
                      <i class="ui-star"></i>
                      <i class="ui-star"></i>
                      <i class="ui-star"></i>
                      <i class="ui-star"></i>
                    </div>
                  </div>
                </div>

                <div class="testimonial clearfix">
                  <img src="img/testimonials/1.png" alt="" class="testimonial__img">
                  <div class="testimonial__info">
                    <span class="testimonial__author">Joeby Ragpa</span>
                    <span class="testimonial__company">DeoThemes</span>
                  </div>
                  <div class="testimonial__body">
                    <p class="testimonial__text">“I have witnessed and admired the work for years. I highly recommend this work for anyone seeking to increase.”</p>
                    <div class="testimonial__rating">
                      <i class="ui-star"></i>
                      <i class="ui-star"></i>
                      <i class="ui-star"></i>
                      <i class="ui-star"></i>
                      <i class="ui-star"></i>
                    </div>
                  </div>
                </div>

                <div class="testimonial clearfix">
                  <img src="img/testimonials/2.png" alt="" class="testimonial__img">
                  <div class="testimonial__info">
                    <span class="testimonial__author">Alexander Samokhin</span>
                    <span class="testimonial__company">DeoThemes</span>
                  </div>
                  <div class="testimonial__body">
                    <p class="testimonial__text">“Every detail has been taken care these team are realy amazing and talented! I will work only to help your sales goals.”</p>
                    <div class="testimonial__rating">
                      <i class="ui-star"></i>
                      <i class="ui-star"></i>
                      <i class="ui-star"></i>
                      <i class="ui-star"></i>
                      <i class="ui-star"></i>
                    </div>
                  </div>
                </div>

              </div> <!-- end owl-carousel -->
            </div>
          </div>
        </div>
      </section> <!-- end testimonials -->

      <!-- From Blog -->
      <section class="section-wrap">
        <div class="container">
          <div class="title-row title-row--boxed text-center">
            <h2 class="section-title">Order UMKM</h2>
            <p class="subtitle">Ini adalah produk-produk yang dihasilkan oleh gDESK</p>
          </div>
          <div class="row card-row">

            <div class="col-lg-4">
              <article class="entry card box-shadow hover-up">
                <div class="entry__img-holder card__img-holder">
                  <a href="single-post.html">
                    <img src="img/blog/post_1.jpg" class="entry__img" alt="">
                  </a>
                  <div class="entry__date">
                    <span class="entry__date-day">23</span>
                    <span class="entry__date-month">Okt</span>
                  </div>
                  <div class="entry__body card__body">
                    <img src="<?=base_url()?>asset/landingpage/img/produk123.jpg" alt="">
                    <div class="entry__excerpt">
                      <p>UMKM Zahroh Barokah</p>
                    </div>
                  </div>
                </div>
              </article>
            </div>

            <div class="col-lg-4">
              <article class="entry card box-shadow hover-up">
                <div class="entry__img-holder card__img-holder">
                  <a href="single-post.html">
                    <img src="img/blog/post_2.jpg" class="entry__img" alt="">
                  </a>
                  <div class="entry__date">
                    <span class="entry__date-day">26</span>
                    <span class="entry__date-month">Okt</span>
                  </div>
                  <div class="entry__body card__body">
                    <img src="<?=base_url()?>asset/landingpage/img/produk124.jpg" alt="">
                    <div class="entry__excerpt">
                        <p>UMKM Kuy's Pie</p>
                    </div>
                  </div>
                </div>
              </article>
            </div>

            <div class="col-lg-4">
              <article class="entry card box-shadow hover-up">
                <div class="entry__img-holder card__img-holder">
                  <a href="single-post.html">
                    <img src="img/blog/post_3.jpg" class="entry__img" alt="">
                  </a>
                  <div class="entry__date">
                    <span class="entry__date-day">27</span>
                    <span class="entry__date-month">Okt</span>
                  </div>
                  <div class="entry__body card__body">
                    <img src="<?=base_url()?>asset/landingpage/img/produk125.jpg" alt="">
                    <div class="entry__excerpt">
                      <p>UMKM D'Kaligrafi</p>
                    </div>
                  </div>
                </div>
              </article>
            </div>

          </div>
        </div>
      </section> <!-- end from blog -->

      <!-- Partners -->
      <section class="section-wrap section-wrap--pb-large bg-gradient" style="background-image: url(img/partners/map.png);">
        <div class="container">
          <div class="title-row title-row--boxed text-center">
            <h2 class="section-title">Mari gabung dengan <img src="<?=base_url()?>asset/logo.png" alt=""> </h2>
            <p class="subtitle">CDC Telkom</p>
          </div>
          <div class="row justify-content-center text-center">
            <div class="col-lg-10">
              <div class="row pb-48">
                <div class="col-md col-sm-6">
                  <img src="img/partners/1.png" alt="">
                </div>
                <div class="col-md col-sm-6">
                  <img src="img/partners/2.png" alt="">
                </div>
                <div class="col-md col-sm-6">
                  <img src="img/partners/3.png" alt="">
                </div>
                <div class="col-md col-sm-6">
                  <img src="img/partners/4.png" alt="">
                </div>
                <div class="col-md col-sm-6">
                  <img src="img/partners/5.png" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
      </section> <!-- end partners -->

      <!-- CTA -->
      <div class="container offset-top-152 pt-sm-48">
        <div class="row justify-content-center">
          <div class="col-lg-10">
            <div class="call-to-action box-shadow-large text-center">
              <div class="call-to-action__container">
                <h3 class="call-to-action__title">
                  Apakah Anda sudah memiliki akun?
                </h3>
                <a href="<?=base_url()?>Create" class="btn btn--lg btn--color">
                  <span>Register</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div> <!-- end cta -->

<?php $this->load->view('landingpage/Footer'); ?>
</body>
</html>
