<script>
	function lapusaha(id){
	$.ajax({
       type:"POST",
       url: "<?php echo base_url();?>index.php/controller/lapusaha/",
	   data: "lap="+id.value,
       success:function(msg){
			$("#llap").html(msg);
			}
		});
	}

</script>

<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dokter
          </h1>
           <a href="../addsection/addDokter"><button type="button" class="btn-tambah btn btn-warning"><i class="fa fa-fw fa-plus"></i> Tambah</button></a>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa  fa-user-md"></i> Karyawan</a></li>
            <li class="active">Dokter</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
          <div class="box box-solid">
            <!--<div class="box-header">
              <h3 class="box-title">Daftar Dokter</h3>
              <button type="button" class="btn btn-primary"><i class="fa fa-fw fa-plus"></i> Tambah</button>
            </div><!-- /.box-header -->
            <div id="data" class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>SIP</th>
                    <th>Email</th>
                    <th>Keterangan</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                
              <?php 
					foreach ($list as $row){
						echo '<tr>
								<td>'.$row->nama_dokter.'</td>
								<td>'.$row->alamat.'</td>
								<td>'.$row->telepon.'</td>
								<td>'.$row->SIP.'</td>
								<td>'.$row->email.'</td>
								<td>'.$row->absensi.'</td>
								<td class="text-center">
									<button type="button" class="btn btn-success"><i class="fa fa-fw fa-edit"></i> Ubah</button>
									<button type="button" class="btn btn-danger"><i class="fa fa-fw fa-remove"></i> Hapus</button>
								</td>
							  </tr>	';
							}
			  
				?>                  
                </tbody>
              </table>
            </div><!-- /.box-body -->
          </div><!-- /.box -->


        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Modal -->
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