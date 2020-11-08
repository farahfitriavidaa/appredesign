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
            <h1 class="page-title__title">Portofolio design ID <?=$design->IDDesigner?>
              <img src="<?=base_url()?>asset/logo.png" width="350px">
            </h1>
            <p class="page-title__subtitle">Berikut ini adalah portofolio design</p>
          </div>
        </div>
      </section> <!-- end page title -->


      <!-- Pricing Tables -->
      <section class="section-wrap">
        <div class="container">
          <div class="row">

            <?php foreach ($portofolio as $a): ?>
            <div class="col-lg-4">
              <div class="pricing box-shadow hover-up hover-line pricing--best">
                <div class="pricing__price-box">
                  <h3 class="pricing__title"><?=$a->Judul?></h3>
                  <center>
                  <a data-fancybox="gallery" href="<?=base_url()?>uploads/bukti_portofolio/<?=$a->Bukti_portofolio?>">  <img src="<?=base_url()?>uploads/bukti_portofolio/<?=$a->Bukti_portofolio?>" width="250px"></a>
                </center>
                </div>
                <p class="pricing__text">
                   <?php echo $a->Detail_portofolio ?>
                </p>
              </div>
            </div>
          <?php endforeach; ?>
          </div>
          <a href="<?=base_url()?>Landingpage/designer" class="btn btn--lg btn--color">
            <span>Kembali</span>
          </a>
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
