<div class="sidebar-inner slimscrollleft" id="sidebar-main">

    <div id="sidebar-menu">
        <ul>
            <li class="menu-title">Main Menu</li>

            <li>
                <a href="<?=base_url()?>cdc/Dashboard" class="waves-effect">
                    <i class="mdi mdi-view-dashboard"></i>
                    <span> Dashboard
                    </span>
                </a>
            </li>

            <li>
                <a href="<?=base_url()?>cdc/Profil" class="waves-effect">
                    <i class="mdi mdi-account"></i>
                    <span> Kelola Profil </span>
                </a>
            </li>
            <li class="has_sub">
                <a href="javascript:void(0);" class="waves-effect">
                    <i class="mdi mdi-animation"></i>
                    <span> UMKM </span>
                    <span class="float-right">
                        <i class="mdi mdi-chevron-right"></i>
                    </span>
                </a>
                <ul class="list-unstyled">
                    <li>
                        <a href="<?=base_url()?>cdc/Umkm/kelolaVerifikasi"><i class="mdi mdi-check-all"> Verifikasi UMKM</i></a>
                    </li>
                    <li>
                        <a href="<?=base_url()?>cdc/Umkm/dataUMKM"><i class="mdi mdi-database"> Data UMKM</i></a>
                    </li>
                </ul>
            </li>
            <li class="has_sub">
                <a href="javascript:void(0);" class="waves-effect">
                    <i class="mdi mdi-desktop-mac"></i>
                    <span> Kelola Report </span>
                    <span class="float-right">
                        <i class="mdi mdi-chevron-right"></i>
                    </span>
                </a>
                <ul class="list-unstyled">
                    <li>
                        <a href="<?=base_url()?>cdc/Report/kelolaOrderOnGoing"><i class="mdi mdi-check-circle"> Report Design On Going</i></a>
                    </li>
                    <li>
                        <a href="<?=base_url()?>cdc/Report/kelolaOrderSelesai"><i class="mdi mdi-check-circle"> Report Design Selesai</i></a>
                    </li>
                    <li>
                        <a href="<?=base_url()?>cdc/Report/kelolaOrderTransaksi"><i class="mdi mdi-check-circle"> Report Transaksi Design</i></a>
                    </li>
                </ul>
            </li>


        </ul>
    </div>
    <div class="clearfix"></div>
</div>
