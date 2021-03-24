<div class="topbar">

    <nav class="navbar-custom">

        <ul class="list-inline float-right mb-0 mr-3">
            <li class="list-inline-item dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                    aria-expanded="false">
                    <?php
                        if ($this->session->has_userdata('foto_profil'))
                            $foto_profil = $this->session->foto_profil;
                        else {
                            $foto_profil = $this->Model_diskusi->getFotoUser($this->session->user);
                            $foto_profil = $foto_profil[0]->Foto;

                            $this->session->foto_profil = $foto_profil;
                        }
                    ?>
                    <img src="<?=base_url()?>uploads/foto_user/<?= $foto_profil; ?>" alt="foto profil" class="rounded-circle img-thumbnail">
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <!-- item-->

                    <?php if ($level === 'admin'): ?>
                        <a class="dropdown-item" href="<?=base_url()?>admin/Akun/kelolaProfil">
                            <i class="mdi mdi-account-circle m-r-5 text-muted"></i> Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?=base_url()?>Create/logout">
                            <i class="mdi mdi-logout m-r-5 text-muted"></i> Logout</a>
                    <?php else: ?>
                        <a class="dropdown-item" href="<?=base_url();?><?=$level?>/profil">
                            <i class="mdi mdi-account-circle m-r-5 text-muted"></i> Profil</a>
                        <a class="dropdown-item" href="<?=base_url();?><?=$level?>/logout">
                            <i class="mdi mdi-logout m-r-5 text-muted"></i> Logout</a>
                    <?php endif; ?>
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
