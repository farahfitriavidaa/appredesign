<!-- Top Bar Start -->
<div class="topbar">

    <nav class="navbar-custom">

        <ul class="list-inline float-right mb-0 mr-3">
            <li class="list-inline-item dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                    aria-expanded="false">
                    <?php
                        if ($this->session->has_userdata('foto_profil'))
                            $foto_profil = $this->session->foto_profil;
                        else
                            $foto_profil = 'umkm.png';
                    ?>
                    <img src="<?=base_url()?>uploads/foto_user/<?=$foto_profil?>" alt="foto profil umkm" class="rounded-circle img-thumbnail">
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <!-- item-->
                    <a class="dropdown-item" href="<?=base_url();?>umkm/lihatProfil">
                        <i class="mdi mdi-account-circle m-r-5 text-muted"></i> Profil</a>
                    <a class="dropdown-item" href="<?=base_url();?>umkm/logout">
                        <i class="mdi mdi-logout m-r-5 text-muted"></i> Logout</a>
                </div>
            </li>
        </ul>

        <ul class="list-inline menu-left mb-0">
            <li class="float-left">
                <button class="button-menu-mobile open-left waves-light waves-effect">
                    <i class="mdi mdi-menu"></i>
                </button>
            </li>
        </ul>

        <div class="clearfix"></div>

    </nav>

</div>
<!-- Top Bar End -->
