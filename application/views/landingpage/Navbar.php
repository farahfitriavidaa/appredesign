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
            <span class="nav__btn-text">Kontak Kami</span>
            <span class="nav__btn-phone">cdc@telkomuniversity.ac.id</span>
          </a>
        </div>

      </div> <!-- end flex-parent -->
    </div> <!-- end container -->

  </div>
</header> <!-- end navigation -->
