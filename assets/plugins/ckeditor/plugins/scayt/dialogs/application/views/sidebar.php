<!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo base_url(); ?>assets/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $this->session->username; ?></p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i> <?php echo $this->session->role; ?></a>
            </div>
          </div>

          <!-- search form (Optional) 
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">NAVIGATION</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="<?php echo base_url(); ?>admin"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <li><a href="<?php echo base_url(); ?>pasien"><i class="fa fa-wheelchair"></i> <span>Pasien</span></a></li>
            <li><a href="<?php echo base_url(); ?>rekam_medis"><i class="fa fa-folder"></i> <span>Rekam Medis</span></a></li>
            <li class="treeview">
              <a href="#"><i class="fa fa-fw fa-user-md"></i> <span>Karyawan</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url(); ?>karyawan/section/dokter">Dokter</a></li>
                <li><a href="<?php echo base_url(); ?>karyawan/section/perawat">Perawat</a></li>
                <li><a href="<?php echo base_url(); ?>karyawan/section/marketing">Marketing</a></li>
              </ul>
            </li>
            <li><a href="<?php echo base_url(); ?>obat"><i class="fa fa-medkit"></i> <span>Obat</span></a></li>
            <li><a href="<?php echo base_url(); ?>diagnosa"><i class="fa fa-eye"></i> <span>Diagnosa</span></a></li>
            <li><a href="<?php echo base_url(); ?>tindakan"><i class="fa fa-hand-paper-o"></i> <span>Tindakan</span></a></li>
            <li><a href="<?php echo base_url(); ?>pengeluaran"><i class="fa fa-arrow-left"></i> <span>Pengeluaran</span></a></li>
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>