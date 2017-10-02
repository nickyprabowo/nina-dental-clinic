

<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Karyawan
          </h1>
           <a href="karyawan/addKaryawan"><button type="button" class="btn-tambah btn btn-warning"><i class="fa fa-fw fa-plus"></i> Karyawan</button></a>
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
                    <th>Profesi</th>
                    <th>SIP</th>
                    <th>Email</th>
                   
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                
              <?php 
					foreach ($list as $row){
						echo '<tr>
								<td>'.$row->nama.'</td>
								<td>'.$row->alamat.'</td>
								<td>'.$row->telepon.'</td>
								<td>'.$row->nama_profesi.'</td>
								<td>'.$row->SIP.'</td>
								<td>'.$row->email.'</td>
								<td class="text-center">
									<button type="button" data-toggle="modal"  data-target="#modal" onclick="det('.$row->id_karyawan.');" class="btn btn-success"><i class="fa fa-fw fa-edit"></i> Ubah</button>
									<button type="button" onclick="delkary('.$row->id_karyawan.');" class="btn btn-danger"><i class="fa fa-fw fa-remove"></i> Hapus</button>
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
      <div class="modal fade modal-primary" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
              <button type="button" onclick="edit();" class="btn btn-outline" data-dismiss="modal">Save changes</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
	  
	   <script>
	 function edit(){
				var data1={
					'nama': $('#nama').val(),
					'id_karyawan': $('#id_karyawan').val(),
					'alamat': $('#alamat').val(),
					'tgl_lahir': $('#tgl_lahir').val(),
					'telepon': $('#telepon').val(),
					'jenis_kelamin': $('#jenis_kelamin').val(),
					'profesi': $('#profesi').val(),
					'SIP': $('#SIP').val(),
					'email': $('#email').val(),
				}
				
				$.ajax({
					   type:"POST",
					   url: "<?php echo base_url();?>karyawan/editkaryawan",
					   data: data1,
					   success:function(msg){
						   $("#data").html(msg);
							}
						});
					}
	 
	  function det(id){
					$.ajax({
					   type:"POST",
					   url: "<?php echo base_url();?>karyawan/detkaryawan",
					   data: 'id='+id,
					   success:function(msg){
						   $(".modal-body").html(msg);
							}
						});
					}
	 
	  function delkary(id){
				if (confirm('Apakah anda yakin akan menghapus karyawan ini?')){
				var data1={
					'hapus': true,
					'id_karyawan' : id,
				}
				$.ajax({
					   type:"POST",
					   url: "<?php echo base_url();?>karyawan/editkaryawan",
					   data: data1,
					   success:function(msg){
						   $("#data").html(msg);
							}
						});
				}
			}
			
	</script>