      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Obat
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dokter</a></li>
            <li class="active">Here</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
    <div class="row">
			<div class="col-md-6">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Data Obat</h3>
              </div><!-- /.box-header -->
              <!-- form start -->
               <form class="form-horizontal" action="" method="post">
                <div class="box-body">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Nama Obat</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nama" id="nama" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Harga</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="harga" id="alamat" required>
                    </div>
                  </div>
				  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">jumlah</label>
                    <div class="col-sm-10">
                      <input type="number" class="form-control" name="jumlah" id="telepon" required>
                    </div>
                  </div>
             
				
				<?php 
					if ($this->session->userdata('role')!="superuser"){
						echo '<input type="hidden" name="cabang" value="'.$this->session->userdata('idcabang').'">';	
					}
					else { 
						echo '<div class="form-group">
								<label for="inputPassword3" class="col-sm-2 control-label">clinic cabang</label>
								<div class="col-sm-10"><select class="form-control" name="cabang">';
							foreach ($cabang as $row){
									echo '<option value="'.$row->idcabang.'">'.$row->nama_clinic.'</option>';
							}
						echo '  </select>
							</div>
						</div>';
					}
				  ?>
				  
                <div class="box-footer text-right">
					
                  <input type="submit" name="submit" value="Simpan" class="form-control">
					
                </div><!-- /.box-footer -->
              </form>
            </div><!-- /.box -->
          </div>
			</div>
        </section><!-- /.content -->
     </div><!-- /.content-wrapper -->