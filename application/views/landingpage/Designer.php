<!DOCTYPE html>
<html lang="en">

    <?php $this->load->view('landingpage/Head'); ?>

<body>

  <main class="main-wrapper">

    <?php $this->load->view('landingpage/Navbar'); ?>

    <div class="content-wrapper oh">

      <!-- Page Title -->
      <section class="page-title text-center">
        <div class="container">
          <div class="page-title__holder">
            <h1 class="page-title__title">Designer
              <img src="<?=base_url()?>asset/logo.png" width="350px">
            </h1>
            <p class="page-title__subtitle">Berikut ini adalah designer-designer yang sudah bekerja sama dengan pihak kami</p>
          </div>
        </div>
      </section> <!-- end page title -->


      <!-- Pricing Tables -->
      <section class="section-wrap">
        <div class="container">
          <div class="row">

            <?php foreach ($designer as $a): ?>
            <div class="col-lg-4">
              <div class="pricing box-shadow hover-up hover-line pricing--best">
                <div class="pricing__price-box">
                  <h3 class="pricing__title"><?=$a->Nama_lengkap?></h3>
                  <center>
                  <img src="<?=base_url()?>uploads/foto_user/<?=$a->Foto?>" width="250px">
                </center>
                </div>
                <p class="pricing__text">
                   <?php echo $a->Keterangan ?>
                </p>
                <a href="<?=base_url()?>Landingpage/ambilPortofolio/<?=$a->IDDesigner?>" class="pricing__button btn btn--lg btn--color"><span>Lihat portofolio</span></a>
              </div>
            </div>
          <?php endforeach; ?>

          </div>
        </div>
      </section> <!-- end pricing tables -->

      <!-- CTA -->
      <div class="call-to-action text-center">
        <div class="call-to-action__container">
          <h3 class="call-to-action__title">
            Ingin bergabung menjadi designer?
          </h3>
          <a href="<?=base_url()?>Create" class="btn btn--lg btn--color">
            <span>Klik disini✅</span>
          </a>
        </div>
      </div> <!-- end cta -->

      <!-- Footer -->
      <?php $this->load->view('landingpage/Footer'); ?>

      <div id="back-to-top">
        <a href="#top"><i class="ui-arrow-up"></i></a>
      </div>

    </div> <!-- end content wrapper -->
  </main> <!-- end main wrapper -->
