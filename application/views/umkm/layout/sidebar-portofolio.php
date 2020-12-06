<div class="sidebar-inner slimscrollleft" id="sidebar-main">

    <div id="sidebar-menu">
        <ul>

            <li class="menu-title">Daftar desainer</li>

            <?php foreach($daftar_designer as $designer): ?>
            <li>
                <a href="<?=base_url()?>umkm/request/lihatPortofolio/<?=trimId('DG', $designer->IDDesigner)?>" class="waves-effect">
                    <i class="mdi mdi-brush"></i>
                    <span><?php
                        $tambahan = strlen($designer->Nama_lengkap)>=47?'...':'';
                        echo substr($designer->Nama_lengkap, '0', '47').$tambahan;
                    ?></span>
                </a>
            </li>
            <?php endforeach; ?>

        </ul>
    </div>
    <div class="clearfix"></div>
</div>
