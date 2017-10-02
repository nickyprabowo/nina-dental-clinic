 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Pasien
          </h1> 
		  <a href="pasien/addpasien"><button type="button" class="btn-tambah btn btn-primary btn-flat"><i class="fa fa-fw fa-plus"></i> Tambah</button></a>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Pasien</a></li>
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
                <div id="pasiendata" class="box-body">
                  <?php $pasien->list_pasien($listpasien); ?>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
            </div>
            <div class="col-md-6">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Informasi Pasien</h3>
              </div><!-- /.box-header -->
              <!-- form start -->
              <form id="detail" class="form-horizontal">
                <label>Klik detil salah satu pasien</label>
              </form>
            </div><!-- /.box -->
          </div>
        </div>

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	   <div class="modal fade modal-primary" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Modal Primary</h4>
            </div>
            <div class="modal-body">
				<div id="webcam"></div>
            </div>
            <div class="modal-footer">
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
	  
	  <script>
			function callwebcam(){
				$('#modal').modal('show'); 
					var address="<?php echo base_url();?>cam";
					var element="webcam";
					sendajax(null,address,element,null);
			}
			function getfoto() 
			{
				var fileinput = document.getElementById("foto");
				fileinput.click();
			}
			
			function detPas(id){
				var data={
					'id_pasien' : id
				}
				var address="<?php echo base_url();?>pasien/detpasien";
				var element="detail"; 
				sendajax(data,address,element,null); 
			}
					
			function edit(z){
				if (z=="batal"){
					 $('.formedit').prop('disabled', true); // Element(s) are now enabled.
					 $("#actionbox").html('<a class="btn btn-app"><i class="fa fa-pencil" onclick="edit();"></i> Ubah</a>');
				}
				else {
				 $('.formedit').removeAttr("disabled"); // Element(s) are now enabled.
				 $("#actionbox").html('<a class="btn btn-app"><i onclick="edit(\'batal\');" class="fa fa-times"></i> Batal</a><a class="btn btn-app"><i onclick="editsubmit();" class="fa fa-save"></i> Simpan</a>');
				}
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
						$('#modal').modal('hide');
					}
				};
			
			function editsubmit(){
				 var posting ={
					 nama: $('#nama').val(),
					 idPas: $('#id_pasien').val(),  
					 alamat: $('#alamat').val(),
					 tglLahir: $('#tglLahir').val(),
					 jeniskelamin: $('#jeniskelamin').val(), 
					 pekerjaan: $('#pekerjaan').val(),
					 email: $('#email').val(), 
					 foto1: $('#foto1').val() 
				 };
				 
				edit('batal');					
				var address="<?php echo base_url();?>pasien/editpasien";
				var element="pasiendata";
				var notif="Data Pasien berhasil diubah";
				sendajax(posting,address,element,notif);
			 }

			function delPas(id){
				if (confirm('Apakah anda yakin akan menghapus antrian ini?')){
				var data1={
					'hapus': true,
					'idPas' : id,
				}				
					var address="<?php echo base_url();?>pasien/editpasien";
					var element="pasiendata";
					var notif="Pasien berhasil Dihapus";
					sendajax(data1,address,element,notif);
				}
			}
			
			function sendajax(data1,address,element,notif,type){
				loading(element);
				//document.getElementById(element).innerHTML='<img src="assets/img/loading_funny'+Math.floor((Math.random() * 4) + 1)+'.gif" style="position:middle;">';  
				$.ajax({ 
					   type:"POST",
					   url: address,
					   data: data1, 
					   dataType:type,
					   success:function(msg){
						   $('#'+element).html(msg);
						   if (notif!=null){
								toastr.success(notif);
								}
							}
						});
			}
			
			
	  </script>