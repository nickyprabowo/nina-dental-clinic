 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Pasien
          </h1>
		  <button type="button" class="btn-tambah btn btn-warning" data-toggle="modal" data-target="#modalDokter"><i class="fa fa-fw fa-plus"></i> Tambah</button>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Pasien</a></li>
            <li class="active">Here</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
          <div class="row">
            <div class="col-md-6">
              <div class="box box-info">
                <!--<div class="box-header with-border">
                  <h3 class="box-title">Daftar Pasien</h3>
                </div>-->
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
						  <tr>
							<th></th>
							<th>Nama</th>
							<th>Usia</th>
							<th>Alamat</th>
						  </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <label>
                            <input type="radio" name="r3" class="flat-red" >
                          </label>
                        </td>
                        <td>Trident</td> 
                        <td>24</td>
                        <td>Jl. Sekarputih Indah No.11 RT 2/RW 1, Tegalampel, Bondowoso</td>
                      </tr>
                      <tr>
                        <td>
                          <label>
                            <input type="radio" name="r3" class="flat-red" >
                          </label>
                        </td>
                        <td>Trident</td> 
                        <td>24</td>
                        <td>Villa Bukit Tidar E2-125, Merjosari, Lowokwaru, Malang</td>
                      </tr>
                      <tr>
                        <td>
                          <label>
                            <input type="radio" name="r3" class="flat-red" >
                          </label>
                        </td>
                        <td>Trident</td> 
                        <td>24</td>
                        <td>Jl. Sekarputih Indah</td>
                      </tr>
                      <tr>
                        <td>
                          <label>
                            <input type="radio" name="r3" class="flat-red" >
                          </label>
                        </td>
                        <td>Trident</td> 
                        <td>24</td>
                        <td>Jl. Sekarputih Indah</td>
                      </tr>
                      <tr>
                        <td>
                          <label>
                            <input type="radio" name="r3" class="flat-red" checked>
                          </label>
                        </td>
                        <td>Trident</td> 
                        <td>24</td>
                        <td>Jl. Sekarputih Indah</td>
                      </tr>
                      <tr>
                        <td>
                          <label>
                            <input type="radio" name="r3" class="flat-red">
                          </label>
                        </td>
                        <td>Trident</td> 
                        <td>24</td>
                        <td>Jl. Sekarputih Indah</td>
                      </tr>
                      <tr>
                        <td>
                          <label>
                            <input type="radio" name="r3" class="flat-red" >
                          </label>
                        </td>
                        <td>Trident</td> 
                        <td>24</td>
                        <td>Jl. Sekarputih Indah</td>
                      </tr>
                      <tr>
                        <td>
                          <label>
                            <input type="radio" name="r3" class="flat-red">
                          </label>
                        </td>
                        <td>Trident</td> 
                        <td>24</td>
                        <td>Jl. Sekarputih Indah</td>
                      </tr>
                      <tr>
                        <td>
                          <label>
                            <input type="radio" name="r3" class="flat-red">
                          </label>
                        </td>
                        <td>Trident</td> 
                        <td>24</td>
                        <td>Jl. Sekarputih Indah</td>
                      </tr>
                      <tr>
                        <td>
                          <label>
                            <input type="radio" name="r3" class="flat-red">
                          </label>
                        </td>
                        <td>Trident</td> 
                        <td>24</td>
                        <td>Jl. Sekarputih Indah</td>
                      </tr>
                      <tr>
                        <td>
                          <label>
                            <input type="radio" name="r3" class="flat-red">
                          </label>
                        </td>
                        <td>Trident</td> 
                        <td>24</td>
                        <td>Jl. Sekarputih Indah</td>
                      </tr>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
            </div>
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
	   <div class="modal fade modal-primary" id="modalDokter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Modal Primary</h4>
            </div>
            <div class="modal-body">
              <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-outline">Save changes</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->