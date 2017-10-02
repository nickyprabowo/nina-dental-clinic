<!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo $this->session->userdata('foto')!=null ?  base_url().$this->session->userdata('foto') : base_url().'assets/img/unknown.jpg'; ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $this->session->username; ?></p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i> <?php echo $this->session->role; ?></a>
            </div>
          </div>
          <!-- Sidebar Menu -->
          <ul class="sidebar-menu" id="sidebar-app">
            <li class="header">NAVIGATION</li>
            <!-- Optionally, you can add icons to the links -->
            <li><a href="<?php echo base_url(); ?>admin"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <li><a href="<?php echo base_url(); ?>kasir/section/antrian"><i class="fa fa-users"></i> <span>Antrian</span></a></li>
            <li><a href="<?php echo base_url(); ?>pasien"><i class="fa fa-wheelchair"></i> <span>Pasien</span></a></li>
            <li><a href="<?php echo base_url(); ?>rekam_medik"><i class="fa fa-folder"></i> <span>Rekam Medis</span></a></li>
            <li>
                <a href="#">
                  <i class="fa fa-user-md"></i> <span>Karyawan</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="<?php echo base_url(); ?>staff"><i class="fa fa-circle-o"></i> Daftar Karyawan</a></li>
                  <li><a href="<?php echo base_url(); ?>profesi"><i class="fa fa-circle-o"></i> Profesi</a></li>
                </ul>
            </li>
            <li><a href="<?php echo base_url(); ?>diagnosa"><i class="fa fa-eye"></i> <span>Diagnosa</span></a></li>
			<li><a href="<?php echo base_url(); ?>tindakan"><i class="fa fa-hand-paper-o"></i> <span>Tindakan</span></a></li>
            <li>
                <a href="#">
                  <i class="fa fa-medkit"></i> <span>Obat</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="<?php echo base_url(); ?>obat"><i class="fa fa-circle-o"></i> Daftar Obat</a></li>
                  <li><a href="<?php echo base_url(); ?>obat/laporan"><i class="fa fa-circle-o"></i> Laporan</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                  <i class="fa fa-umbrella"></i> <span>Inventaris</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="<?php echo base_url(); ?>inventaris"><i class="fa fa-circle-o"></i> Daftar Barang</a></li>
                  <li><a href="<?php echo base_url(); ?>inventaris/laporan"><i class="fa fa-circle-o"></i> Log Barang</a></li>
                </ul>
            </li>
            <li><a href="<?php echo base_url(); ?>keuangan"><i class="fa fa fa-money"></i> <span>Keuangan</span></a></li>
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>