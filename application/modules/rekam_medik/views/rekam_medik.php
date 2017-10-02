 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          Rekam Medik Pasien
          </h1>
		  <a href="pasien/addpasien"><button type="button" class="btn-primary btn btn-flat"><i class="fa fa-fw fa-plus"></i> Tambah Rekam Medik</button></a>
		 <button type="button" class="btn-primary btn btn-flat" onclick="getall();"><i class="fa fa-fw fa-plus"></i> Tampilkan seluruh Rekam Medik</button>
          <ol class="breadcrumb">
            <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Rekam Medik</a></li>
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
                  
					  <?php 
						$pasien->list_pasien($listpasien);
					  ?>
                   
                </div><!-- /.box-body -->
              </div><!-- /. box -->
            </div>
            <div class="col-md-6">
            <div class="box box-primary">
			<div class="box-body">
              <div class="box-header with-border">
                <h3 class="box-title">Informasi Rekam Medik &nbsp; <p style="float:right;"id="nama_pasien"> </p></h3>
              </div><!-- /.box-header -->
              <!-- form start -->
              <form id="detail" class="form-horizontal">
                <label>No Pasien Data  Viewed</label>
              </form>
            </div><!-- /.box -->
            </div><!-- /.box -->
          </div>
        </div>

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	    <div class="modal" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Detil Pasien</h4>
            </div>
            <div class="modal-body">
					<div id="modal-content">
				</div>
            </div>
				<div class="modal-footer">
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
	  
	 <script>
			function detPas(id){
				loading('detail');
				$.ajax({
					   type:"POST",
					   url: "<?php echo base_url();?>rekam_medik/listrekam",
					   data: "id_pasien="+id,
					   success:function(msg){	   
						   $("#detail").html(msg);
						    $('#tglLahir').datepicker({format: 'dd-mm-yyyy'});
							}
						});
					}
					
			function detailrekam(id,idrek){
				loading('modal-content');
				var data={
					'id_antrian': id,
					'id_rekam_medik': idrek}
				$.ajax({
						   type:"POST",
						   url: "<?php echo base_url();?>kasir/viewdetailrekam",
							data: data,
						   success:function(msg){
							  $("#modal-content").html(msg);
						   }
					});	
				}
				
				function getall(){
					loading('detail');
					$.ajax({
						   type:"POST",
						   url: "<?php echo base_url();?>rekam_medik/listrekam",
						   success:function(msg){
							  $("#detail").html(msg);
						   }
					});	
					
					
				}
			
	  </script>