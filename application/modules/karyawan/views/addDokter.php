      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dokter
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
                <h3 class="box-title">Data Dokter</h3>
              </div><!-- /.box-header -->
              <!-- form start -->
               <form class="form-horizontal" action="dokter" method="post">
                <div class="box-body">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nama" id="nama" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Alamat</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="alamat" id="alamat" required>
                    </div>
                  </div>
				  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Telepon</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="telepon" id="telepon" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Tgl lahir</label>
                    <div class="col-sm-10 date">
                        <input type="text" class="form-control" name="tgllahir" id="tglLahirPasien" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="jeniskelamin" id="jeniskelamin">
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">SIP</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="SIP" id="SIP" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                  </div>
                </div><!-- /.box-body -->
                <div class="box-footer text-right">
					
                  <input type="submit" name="submit" value="Simpan" class="form-control">
					
                </div><!-- /.box-footer -->
              </form>
            </div><!-- /.box -->
          </div>
			</div>
        </section><!-- /.content -->
     </div><!-- /.content-wrapper -->