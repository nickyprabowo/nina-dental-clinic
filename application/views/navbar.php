<body class="hold-transition skin-blue sidebar-mini">
	<div class="loader"></div>
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>N</b>DC</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Nina</b> Dental Care <br> </span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
			  <li>
				<a><?php echo Date('d-M-Y'); ?></a>
			  </li>  
              <li>
				<a><?php echo $this->session->userdata('nama_clinic') ?></a>
			  </li>
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <img src="<?php echo $this->session->userdata('foto')!=null ?  base_url().$this->session->userdata('foto') : base_url().'assets/img/unknown.jpg'; ?>" class="user-image" alt="User Image">
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs"><?php $this->session->userdata('username') ?> <?php
				if ($this->session->userdata('nama_cabang')!=null) echo $this->session->userdata('username')?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <img src="<?php echo $this->session->userdata('foto')!=null ?  base_url().$this->session->userdata('foto') : base_url().'assets/img/unknown.jpg'; ?>" class="img-circle" alt="User Image">
                    <p>
                      <?php echo $this->session->userdata('username') ?> - <?php echo $this->session->userdata('role') ?>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?php echo base_url(); ?>user" class="btn btn-default btn-flat">Profile</a>
                    </div> 
					<div class="pull-left">
					
                      <a data-toggle="modal"  data-target="#settingcabang" class="btn btn-default btn-flat">Setting Cabang</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo base_url(); ?>login/logout" class="btn btn-default btn-flat" onclick="window.open('<?php echo base_url().'login/closing'?>','Closing','scrollbars=yes,status=no,menubar=no,width=800,height=400')">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <!--<li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>-->
            </ul>
          </div>
        </nav>
      </header>
	  
	   <div class="modal" id="settingcabang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Detil Pasien</h4>
            </div>
            <div class="modal-body">
					    <form class="form-horizontal" action="<?php echo base_url()?>installer/dataclinic" method="post" enctype="multipart/form-data">
                <div class="box-body">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="namaclinic"  required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Alamat</label>
                    <div class="col-sm-10">
                      <textarea type="text" class="form-control textarea" name="alamatclinic"  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required></textarea>
                    </div>
                  </div>  
				      <input type="submit" name="submit" value="Simpan" class="btn btn-flat btn-primary btn-block">
				</div>
				</form>
            </div>
			
			
				<div class="modal-footer">
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
	  
	  <script>   
 $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5(); 
  });</script>
	  