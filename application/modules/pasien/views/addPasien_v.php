      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Pasien
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Pasien</a></li>
            <li class="active">Tambah Pasien</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
    <div class="row">
			<div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Tambah Data Pasien</h3>
              </div><!-- /.box-header -->
              <!-- form start -->
              <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
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
                    <label for="inputPassword3" class="col-sm-2 control-label">Pekerjaan</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" name="email" id="email">
                    </div>
                  </div> 
				  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Foto</label>
                    <div class="col-sm-10">
					 <button type="button" class="formedit btn btn-primary" onclick="callwebcam();" class="btn btn-flat btn-success"><i class="fa fa-camera" aria-hidden="true"></i></button> 
					 <button type="button" class="formedit btn btn-primary" onclick="getfoto();" class="btn btn-flat btn-success"><i class="fa fa-upload" aria-hidden="true"></i></button> 
					 <label class="control-label">Jika ingin menggunakan kamera ponsel, silahkan pilih tombol upload dan pilih opsi kamera pada ponsel anda</label>
					  <div id="results"></div>
					  <input class="formedit" type="file" name="foto" id="foto" style="display:none;"> 
                      <input type="hidden" name="foto1" id="foto1" value="">
                    </div>
                  </div>
				  <?php 
					if ($this->session->userdata('role')!="super user"){
						echo '<input type="hidden" name="cabang" value="'.$this->session->userdata('role').'">';	
					}
					else { 
						echo '<div class="form-group">
								<label for="inputPassword3" class="col-sm-2 control-label">Pasien cabang</label>
								<div class="col-sm-10"><select class="form-control" name="cabang">';
							foreach ($cabang as $row){
									echo '<option value="'.$row->idcabang.'">'.$row->nama_clinic.'</option>';
							}
						echo '  </select>
							</div>
						</div>';
					}
				  ?>
				  
                </div><!-- /.box-body -->
				
                <div class="box-footer">
					
                  <input type="submit" name="submit" value="Simpan" class="btn btn-flat btn-primary btn-block">
					
                </div><!-- /.box-footer -->
              </form>
            </div><!-- /.box -->
          </div>
			</div>
        </section><!-- /.content -->
		<div id="webcam"></div>
     </div><!-- /.content-wrapper -->
	 
	 
	 <script>
		function getfoto() 
			{
				var fileinput = document.getElementById("foto");
				fileinput.click();
			}
		function callwebcam(){
			$.ajax({
					   url: "<?php echo base_url();?>cam",
					   success:function(msg){	   
						    $('#webcam').html(msg);
							}
						});
			}
			
		var handleFileSelect = function(evt) {
					var files = evt.target.files;
					var file = files[0];
					if (files && file) {
						var reader = new FileReader();
						reader.onload = function(readerEvt) {
							var binaryString = readerEvt.target.result;
							document.getElementById("foto1").value=btoa(binaryString); 
							document.getElementById('results').innerHTML='<img src="data:image/jpeg;base64,'+btoa(binaryString)+'" style="widht:100px;height:100px"/>' 
						};
						reader.readAsBinaryString(file);
					}
		};
		document.getElementById("foto").addEventListener('change', handleFileSelect, false);
	 </script>