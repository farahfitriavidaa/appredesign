<div class="sidebar-inner slimscrollleft" id="sidebar-main">

    <div id="sidebar-menu">
        <ul>
            <li class="menu-title">Main Menu</li>

            <li>
                <a href="<?=base_url()?>Admin" class="waves-effect">
                    <i class="mdi mdi-view-dashboard"></i>
                    <span> Dashboard
                    </span>
                </a>
            </li>

            <li>
                <a href="<?=base_url()?>Admin/kelolaAkun" class="waves-effect">
                    <i class="mdi mdi-calendar-clock"></i>
                    <span> Kelola Akun </span>
                </a>
            </li>

            <li class="has_sub">
                <a href="javascript:void(0);" class="waves-effect">
                    <i class="mdi mdi-animation"></i>
                    <span> Kelola Pengguna </span>
                    <span class="float-right">
                        <i class="mdi mdi-chevron-right"></i>
                    </span>
                </a>
                <ul class="list-unstyled">
                    <li>
                        <a href="<?=base_url()?>Admin/kelolaTelkom">CDC Telkom</a>
                    </li>
                    <li>
                        <a href="<?=base_url()?>Admin/kelolaDesigner">Designer</a>
                    </li>
                    <li>
                        <a href="<?=base_url()?>Admin/kelolaUMKM">UMKM</a>
                    </li>
                </ul>
            </li>
            <li class="has_sub">
                <a href="javascript:void(0);" class="waves-effect">
                    <i class="mdi mdi-table"></i>
                    <span> Kelola Order </span>
                    <span class="float-right">
                        <i class="mdi mdi-chevron-right"></i>
                    </span>
                </a>
                <ul class="list-unstyled">
                    <li>
                        <a href="<?=base_url()?>Admin/kelolaPemesanan">Pengguna</a>
                    </li>
                    <li>
                        <a href="<?=base_url()?>Admin/kelolaOrderDesigner">Designer</a>
                    </li>
                </ul>
            </li>

            <li class="has_sub">
                <a href="javascript:void(0);" class="waves-effect">
                    <i class="mdi mdi-desktop-mac"></i>
                    <span> Kelola Report </span>
                </a>
                <ul class="list-unstyled">
                  <li>
                    <a href="<?=base_url()?>Admin/kelolaOrderPermintaan"> Report Permintaan Design </a>
                  </li>
                  <li>
                      <a href="<?=base_url()?>Admin/kelolaOrderOnGoing"> Report Design On Going</a>
                  </li>
                  <li>
                      <a href="<?=base_url()?>Admin/kelolaOrderSelesai"> Report Design Selesai</a>
                  </li>
                  <li>
                      <a href="<?=base_url()?>Admin/kelolaTransaksi"> Report Transaksi Design</a>
                  </li>
                </ul>
            </li>


        </ul>
    </div>
    <div class="clearfix"></div>
</div>
