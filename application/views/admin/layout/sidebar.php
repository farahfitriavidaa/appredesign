<div class="sidebar-inner slimscrollleft" id="sidebar-main">

    <div id="sidebar-menu">
        <ul>
            <li class="menu-title">Main Menu</li>

            <li>
                <a href="<?=base_url()?>Admin" class="waves-effect">
                    <i class="mdi mdi-view-dashboard"></i>
                    <span> Dashboard
                        <span class="badge badge-pill badge-primary float-right">7</span>
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
                        <a href="tables-datatable.html">Designer</a>
                    </li>
                </ul>
            </li>

            <li class="has_sub">
                <a href="javascript:void(0);" class="waves-effect">
                    <i class="mdi mdi-cards"></i>
                    <span> Kelola Konten </span>
                    <span class="badge badge-pill badge-info float-right">8</span>
                </a>
                <ul class="list-unstyled">
                    <li>
                        <a href="form-elements.html">Kelola Slide</a>
                    </li>
                    <!-- <li>
                        <a href="form-validation.html">Form Validation</a>
                    </li>
                    <li>
                        <a href="form-advanced.html">Form Advanced</a>
                    </li>
                    <li>
                        <a href="form-mask.html">Form Mask</a>
                    </li>
                    <li>
                        <a href="form-editors.html">Form Editors</a>
                    </li>
                    <li>
                        <a href="form-uploads.html">Form File Upload</a>
                    </li> -->
                </ul>
            </li>

            <li class="has_sub">
                <a href="javascript:void(0);" class="waves-effect">
                    <i class="mdi mdi-map-marker-multiple"></i>
                    <span> Kelola Report </span>
                    <span class="badge badge-pill badge-danger float-right">2</span>
                </a>
                <ul class="list-unstyled">
                    <li>
                        <a href="maps-google.html"> Google Map</a>
                    </li>
                    <li>
                        <a href="maps-vector.html"> Vector Map</a>
                    </li>
                </ul>
            </li>


        </ul>
    </div>
    <div class="clearfix"></div>
</div>
