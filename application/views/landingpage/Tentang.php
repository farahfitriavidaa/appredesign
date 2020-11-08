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
          <image xlink:href="<?=base_url()?>asset/logo.png" x="50" y="70" width="500" height="500"></image>
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
            <p class="page-title__subtitle">Kami hadir untuk membangun UMKM Anda lebih maju dalam branding produk, maka dari itu marilah bergabung bersama kami disini</p>
          </div>
        </div>
      </section> <!-- end page title -->

      <!-- Benefits -->
      <section class="section-wrap">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-10">
              <div class="benefits box-shadow-large offset-top-171">
                <h3 class="benefits__title">Keuntungan di gDESK</h3>
                <div class="row">
                  <div class="col-lg-6">
                    <ul class="benefits__list">
                      <li class="benefits__item">
                        <i class="ui-check benefits__item-icon"></i>
                        <span class="benefits__item-title">Dapat melakukan request kemasan sesuai dengan keinginan</span>
                      </li>
                      <li class="benefits__item">
                        <i class="ui-check benefits__item-icon"></i>
                        <span class="benefits__item-title">Mendapat kemasan yang sesuai dengan trend saat ini</span>
                      </li>
                    </ul>
                  </div>
                  <div class="col-lg-6">
                    <ul class="benefits__list">
                      <li class="benefits__item">
                        <i class="ui-check benefits__item-icon"></i>
                        <span class="benefits__item-title">Dapat memilih desainer kemasan sesuai dengan selera Anda</span>
                      </li>
                      <li class="benefits__item">
                        <i class="ui-check benefits__item-icon"></i>
                        <span class="benefits__item-title">Dapat dicetak dengan vendor termurah</span>
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
                <span class="statistic__number"><?=$user->hasil?></span>
                <h5 class="statistic__title">User</h5>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="statistic">
                <span class="statistic__number"><?=$umkm->hasil?></span>
                <h5 class="statistic__title">UMKM</h5>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="statistic">
                <span class="statistic__number"><?=$designer->hasil?></span>
                <h5 class="statistic__title">Designer</h5>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="statistic">
                <span class="statistic__number"><?=$order->hasil?></span>
                <h5 class="statistic__title">Order Fix</h5>
              </div>
            </div>
          </div>
        </div>
      </section> <!-- end statistic -->

      <!-- CTA -->
      <div class="call-to-action text-center">
        <div class="call-to-action__container">
          <h3 class="call-to-action__title">
            Mari bergabung dengan gDESK
          </h3>
          <a href="<?=base_url()?>Create" class="btn btn--lg btn--color">
            <span>Gabung</span>
          </a>
        </div>
      </div> <!-- end cta -->

      <?php $this->load->view('landingpage/Footer'); ?>
      <!-- Footer -->
      <div id="back-to-top">
        <a href="#top"><i class="ui-arrow-up"></i></a>
      </div>

    </div> <!-- end content wrapper -->

</body>
</html>
