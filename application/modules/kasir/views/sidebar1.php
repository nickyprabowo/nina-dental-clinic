<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#submenu-penjualan"><i class="fa fa-fw fa-shopping-cart"></i></i> Penjualan <i class="fa fa-fw fa-angle-down"></i></a>
                <ul id="submenu-penjualan" class="collapse">
                    <li>
                        <a href="<?php echo base_url(); ?>kasir/section/penjualan">Transaksi</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>kasir/section/piutang">Piutang</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>kasir/section/daftar_penjualan">Daftar Penjualan</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#submenu-pembelian"><i class="fa fa-fw fa-shopping-bag"></i> Pembelian <i class="fa fa-fw fa-angle-down"></i></a>
                <ul id="submenu-pembelian" class="collapse">
                    <li>
                        <a href="<?php echo base_url(); ?>kasir/section/pembelian">Transaksi</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>kasir/section/hutang">Hutang</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>kasir/section/daftar_pembelian">Daftar Pembelian</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>kasir/section/kas"><i class="fa fa-fw fa-money"></i> Kas</a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>kasir/section/katalog"><i class="fa fa-fw fa-list"></i> Katalog</a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>kasir/section/statistik"><i class="fa fa-fw fa-bar-chart"></i> Statistik</a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>kasir/coba/pengaturan"><i class="fa fa-fw fa-cog"></i> Pengaturan</a>
            </li>
        </ul>
    </div>