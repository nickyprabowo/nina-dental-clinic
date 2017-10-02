      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Pasien
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Pasien</a></li>
            <li class="active">Here</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
    <div class="row">
			<div class="col-md-6">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Informasi Pasien</h3>
              </div><!-- /.box-header -->
              <!-- form start -->
              <form class="form-horizontal">
                <div class="box-body">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="namaPasien">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Alamat</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="alamatPasien">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Tgl lahir</label>
                    <div class="col-sm-10 date">
                        <input type="text" class="form-control" id="tglLahirPasien">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                      <select class="form-control" id="jenisKelaminPasien">
                        <option>Laki-laki</option>
                        <option>Perempuan</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Pekerjaan</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="pekerjaanPasien">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Konsul Pertama</label>
                    <div class="col-sm-10 date">
                      <input type="text" class="form-control" id="tglKonsulPertama">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="emailPasien">
                    </div>
                  </div>
                </div><!-- /.box-body -->
                <div class="box-footer text-right">
                  <a class="btn btn-app">
                    <i class="fa fa-plus"></i> Tambah
                  </a>
                  <a class="btn btn-app">
                    <i class="fa fa-edit"></i> Ubah
                  </a>
                  <a class="btn btn-app">
                    <i class="fa fa-remove"></i> Hapus
                  </a>
                  <a class="btn btn-app">
                    <i class="fa fa-save"></i> Simpan
                  </a>
                </div><!-- /.box-footer -->
              </form>
            </div><!-- /.box -->
          </div>
			</div>
        </section><!-- /.content -->
     </div><!-- /.content-wrapper -->