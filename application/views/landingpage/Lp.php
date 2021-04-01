<!DOCTYPE html>
<html lang="en">

    <?php $this->load->view('landingpage/Head'); ?>

<body>

  <main class="main-wrapper">

    <!-- Navigation -->
    <?php $this->load->view('landingpage/Navbar') ?>

    <!-- Triangle Image -->
    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
       viewBox="0 0 600 480" style="enable-background:new 0 0 600 480;" xml:space="preserve" class="triangle-img triangle-img--align-right">
      <g>
        <path class="st0" d="M232.16,108.54,76.5,357.6C43.2,410.88,81.5,480,144.34,480H455.66c62.83,0,101.14-69.12,67.84-122.4L367.84,108.54C336.51,58.41,263.49,58.41,232.16,108.54Z" fill="url(#img1)" />
        <path class="st0" d="M232.16,108.54,76.5,357.6C43.2,410.88,81.5,480,144.34,480H455.66c62.83,0,101.14-69.12,67.84-122.4L367.84,108.54C336.51,58.41,263.49,58.41,232.16,108.54Z" fill="url(#triangle-gradient)" fill-opacity="0.7" />
      </g>
      <defs>
        <pattern id="img1" patternUnits="userSpaceOnUse" width="500" height="500">
          <image xlink:href="<?=base_url()?>asset/landingpage/img/background1.jpg" x="50" y="70" height="500"></image>
        </pattern>

        <linearGradient id="triangle-gradient" y2="100%" x2="0" y1="50%" gradientUnits="userSpaceOnUse" >
        <stop offset="0" stop-color="#800000"/>
        <stop offset="1" stop-color="#FFFFFF"/>
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
                <h1 class="hero__title hero__title--boxed">Bagaimana cara membuat produk kita lebih bagus??🙄🙄</h1>
                <h2 class="hero__subtitle">Tepat sekali! gDESK akan membuat produk Anda terlihat lebih menarik dan mengikuti trend masa kini, tunggu apalagi yuk re-design kemasan produk Anda✅✅</h2>
              </div>
            </div>
          </div>

          <div class="row justify-content-center">
            <div class="col-lg-10">
              <div class="optin">
                <div class="row">
                  <div class="col md-6">
                    <h3 class="optin__title">Yuk segera memulai bergabung bersama kami 😊😊</h3>
                  </div>
                  <div>
                    <button class="optin__btn btn btn--md btn--color btn--button">
                      <a href="<?=base_url()?>Create" style="color:white">Klik disini</a>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row justify-content-center mt-4">
            <div class="col-lg-10">
              <div class="optin">
                <div class="row">
                  <div class="col md-6">
                    <h3 class="optin__title">Buat <i lang="en">request</i> desain kemasan 🎨🎨</h3>
                  </div>
                  <div>
                    <button class="optin__btn btn btn--md btn--color btn--button">
                      <a href="<?=base_url()?>Create/buatRequest" style="color:white">Klik disini</a>
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
                <p class="feature__text">Simbol untuk mengingatkan para konsumen terkait UMKM yang Anda miliki✅ </p>
                <br>
              </div>
            </div>
            <div class="col-lg-4" >
              <div class="feature box-shadow hover-up hover-line">
                  <img src="<?=base_url()?>asset/landingpage/img/icons/produk.png" width="100px">
                <h4 class="feature__title">Foto Produk</h4>
                <p class="feature__text">Kualitas foto produk itu penting karena konsumen akan membeli barang yang terlihat lebih menarik</p>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="feature box-shadow hover-up hover-line">
                  <img src="<?=base_url()?>asset/landingpage/img/icons/kemasan.png" width="100px">
                <h4 class="feature__title">Kemasan</h4>
                <p class="feature__text">Kemasan yang menarik pun dapat lebih sering dibeli oleh para konsumen</p>
                <br>
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
              <image xlink:href="<?=base_url()?>asset/landingpage/img/background2.jpeg" width="600" height="600"></image>
            </pattern>
          </defs>
        </svg>

        <div class="container">
          <div class="row justify-content-end">
            <div class="col-lg-6">
              <h2 class="promo-section__title promo-section__title--boxed">gDESK</h2>
              <p class="promo-section__text lead">Di masa pandemi ini banyak sekali dampak yang di alami oleh para UMKM-UMKM. Namun kita tidak boleh untuk menyerah karena kita bisa melawan pandemi ini dengan cara melakukan pembaruan dalam re-branding.
                Maka dari itu kami berinovasi untuk membuat gDESK sebagai sarana untuk para UMKM dalam melakukan re-design dan re-packaging kemasan produk agar terlihat semakin menarik dan berkembang di era kini.</p>
              <!-- <a href="#" class="btn btn--lg btn--color btn--icon">
                <span>Klik disini</span>
                <i class="ui-arrow-right"></i>
              </a> -->
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
                <p class="subtitle">Berikut adalah testimoni dari mitra yang telah bekerja sama dengan kami😊😊</p>
              </div>

              <div id="owl-testimonials" class="owl-carousel owl-theme owl-carousel--arrows-outside">

                <div class="testimonial clearfix">
                  <img src="<?=base_url()?>asset/landingpage/img/testimonials/1.png" alt="" class="testimonial__img">
                  <div class="testimonial__info">
                    <span class="testimonial__author">Raden Roro</span>
                    <span class="testimonial__company">UMKM Keripik Pisang Nur Hayati</span>
                  </div>
                  <div class="testimonial__body">
                    <p class="testimonial__text">“Bagus yaa👍😍, terimakasih bantuan re design produk saya, designnya bagus kekinian.. semoga setelah kami pakai nanti menambah naiknya pembeli🙏🙏”</p>
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
                  <img src="<?=base_url()?>asset/landingpage/img/testimonials/2.png" alt="" class="testimonial__img">
                  <div class="testimonial__info">
                    <span class="testimonial__author">Eci Candra</span>
                    <span class="testimonial__company">UMKM Batam Yunik</span>
                  </div>
                  <div class="testimonial__body">
                    <p class="testimonial__text">“Kemasan sangat menarik dan cocok buat olahan kripik Singkong, semoga dengan kemasan yang baru pemasaran kami semakin meningkat dan omzetnya bertambah”</p>
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
                  <img src="<?=base_url()?>asset/landingpage/img/testimonials/3.png" alt="" class="testimonial__img">
                  <div class="testimonial__info">
                    <span class="testimonial__author">Wida Lestari</span>
                    <span class="testimonial__company">Bunda Didza</span>
                  </div>
                  <div class="testimonial__body">
                    <p class="testimonial__text">“Waahh kreen nyaa...👍👍”</p>
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
                  <img src="<?=base_url()?>asset/landingpage/img/testimonials/4.png" alt="" class="testimonial__img">
                  <div class="testimonial__info">
                    <span class="testimonial__author">Meimulah</span>
                    <span class="testimonial__company">UMKM Dapur Seesu</span>
                  </div>
                  <div class="testimonial__body">
                    <p class="testimonial__text">“Makasih banyak .. 👍👍👍🙏”</p>
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
                  <img src="<?=base_url()?>asset/landingpage/img/testimonials/5.png" alt="" class="testimonial__img">
                  <div class="testimonial__info">
                    <span class="testimonial__author">Rosmiati</span>
                    <span class="testimonial__company">UMKM Sagon Bakar Batam</span>
                  </div>
                  <div class="testimonial__body">
                    <p class="testimonial__text">“Udah mantap mas terima kasih banyak”</p>
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
                  <img src="<?=base_url()?>asset/landingpage/img/testimonials/6.png" alt="" class="testimonial__img">
                  <div class="testimonial__info">
                    <span class="testimonial__author">Sukaesih</span>
                    <span class="testimonial__company">UMKM Falah Bakpao</span>
                  </div>
                  <div class="testimonial__body">
                    <p class="testimonial__text">“Terimakasih pak saya suka banget bagus👍”</p>
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
                    <img src="<?=base_url()?>asset/landingpage/img/product/produk126.jpg" class="entry__img" alt="">
                  </a>
                  <div class="entry__date">
                    <span class="entry__date-day">23</span>
                    <span class="entry__date-month">Okt</span>
                  </div>
                  <center>
                  <p>UMKM Keripik Pisang Nur Hayati</p>
                </center>
                </div>
              </article>
            </div>

            <div class="col-lg-4">
              <article class="entry card box-shadow hover-up">
                <div class="entry__img-holder card__img-holder">
                  <a href="single-post.html">
                    <img src="<?=base_url()?>asset/landingpage/img/product/produk127.jpg" class="entry__img" alt="">
                  </a>
                  <div class="entry__date">
                    <span class="entry__date-day">23</span>
                    <span class="entry__date-month">Okt</span>
                  </div>
                  <center>
                  <p>UMKM Batam Yunik</p>
                </center>
                </div>
              </article>
            </div>

            <div class="col-lg-4">
              <article class="entry card box-shadow hover-up">
                <div class="entry__img-holder card__img-holder">
                  <a href="single-post.html">
                    <img src="<?=base_url()?>asset/landingpage/img/product/produk128.png" class="entry__img" alt="">
                  </a>
                  <div class="entry__date">
                    <span class="entry__date-day">23</span>
                    <span class="entry__date-month">Okt</span>
                  </div>
                  <center>
                  <p>UMKM Bunda Didza</p>
                </center>
                </div>
              </article>
            </div>

            <div class="col-lg-4">
              <article class="entry card box-shadow hover-up">
                <div class="entry__img-holder card__img-holder">
                  <a href="single-post.html">
                    <img src="<?=base_url()?>asset/landingpage/img/product/produk120.png" class="entry__img" alt="">
                  </a>
                  <div class="entry__date">
                    <span class="entry__date-day">23</span>
                    <span class="entry__date-month">Okt</span>
                  </div>
                  <center>
                  <p>UMKM Dapur Seesu</p>
                </center>
                </div>
              </article>
            </div>

            <div class="col-lg-4">
              <article class="entry card box-shadow hover-up">
                <div class="entry__img-holder card__img-holder">
                  <a href="single-post.html">
                    <img src="<?=base_url()?>asset/landingpage/img/product/produk122.png" class="entry__img" alt="">
                  </a>
                  <div class="entry__date">
                    <span class="entry__date-day">23</span>
                    <span class="entry__date-month">Okt</span>
                  </div>
                  <center>
                  <p>UMKM Sagon Bakar</p>
                </center>
                </div>
              </article>
            </div>

            <div class="col-lg-4">
              <article class="entry card box-shadow hover-up">
                <div class="entry__img-holder card__img-holder">
                  <a href="single-post.html">
                    <img src="<?=base_url()?>asset/landingpage/img/product/produk129.jpg" class="entry__img" alt="">
                  </a>
                  <div class="entry__date">
                    <span class="entry__date-day">23</span>
                    <span class="entry__date-month">Okt</span>
                  </div>
                  <center>
                  <p>UMKM Falah Bakpao</p>
                </center>
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
            <img src="<?=base_url()?>asset/telkom.png" alt="">
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
