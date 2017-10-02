<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Kas <small>Arus Keuangan</small>
                </h1>
            </div>
        </div>

        <!-- /.row -->

        <div class="row">
        	<div class="col-lg-12">
        		<div class="control-box">
        			<div class="row">
        				<div class="col-lg-8">
        					<div class="control-button">
		                        <div class="btn-toolbar" role="toolbar" aria-label="">
		                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahKas"><i class="fa fa-plus"></i> Tambah</button>
		                            <div class="btn-group loose" role="group" aria-label="...">
		                              <button type="button" class="btn btn-default"><i class="fa fa-print"></i> Cetak</button>
		                              <div class="btn-group" role="group">
									    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									      <i class="fa fa-download"></i> Export
									      <span class="caret"></span>
									    </button>
									    <ul class="dropdown-menu">
									      <li><a href="#">png</a></li>
									      <li><a href="#">jpg</a></li>
									      <li><a href="#">csv</a></li>
									      <li><a href="#">excel</a></li>
									    </ul>
									  </div>
		                            </div>
		                        </div>
		                    </div>
        				</div>
        				<div class="col-lg-4">
        					<div class="row">
								<div class="col-lg-6 text-left">
									<p class="preview-label">Pemasukan</p>
									<p class="preview-label">Pengeluaran</p>
								</div>
								<div class="col-lg-6 text-right">
									<p class="nilai-kas">Rp 340.000</p>
									<p class="nilai-kas">Rp 100.000</p>
								</div>
							</div>
        				</div>
        			</div>
                    <div class="row">
                    	<div class="col-lg-2">
							<div class="form-group">
								<label for="kategori">Kategori</label>
								<select class="form-control" id="kategori-kas">
									<option>Semua</option>
									<option>Pemasukan</option>
									<option>Pengeluaran</option>
								</select>
							</div>
						</div>
	                	<div class="col-lg-3">
							<div class="form-group">
								<label>Sampai dengan</label>
								<div class='input-group date' id='datetimepicker7'>
									<input type='text' class="form-control" />
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-calendar"></span>
									</span>
								</div>
							</div>
						</div>
	                	<div class="col-lg-3">
							<div class="form-group">
								<label>Sampai dengan</label>
								<div class='input-group date' id='datetimepicker7'>
									<input type='text' class="form-control" />
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-calendar"></span>
									</span>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<hr />
							<div class="row">
								<div class="col-lg-6 text-left">
									<p class="preview-label">Saldo</p>
								</div>
								<div class="col-lg-6 text-right">
									<p class="nilai-saldo">Rp 240.000</p>  					
								</div>	
							</div>
						</div>
					</div>
                </div>
        	</div>	
        </div>
        
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                <table id="table1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Tanggal</th>
                            <th>Kategori</th>
                            <th>Keterangan</th>
                            <th>Jumlah</th>
                            <th>Operator</th>
                            <th>Kontrol</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>$320,800</td>
                            <td></td>
                            <td></td>
                            <td class="control">
                                <button href="" class="edit" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fa fa-pencil"></i></button>
                                <button href="" class="delete" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-trash-o"></i></button>
                                <button href="" class="print" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-print"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>Garrett Winters</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>$170,750</td>
                            <td></td>
                            <td></td>
                            <td class="control">
                                <button href="" class="edit" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fa fa-pencil"></i></button>
                                <button href="" class="delete" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-trash-o"></i></button>
                                <button href="" class="print" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-print"></i></button>
                            </td>
                        </tr>
                    </tbody>
                    </table>
            </div>
        </div>

        <!-- /.row -->

        <!-- Modal -->
		<div class="modal fade" id="tambahKas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Tambah Aktivitas Kas</h4>
		      </div>
		      <div class="modal-body">
		        <form action="">
		        	<div class="form-group">
						<label for="kategori">Kategori</label>
						<select class="form-control" id="kategori-kas">
							<option>Semua</option>
							<option>Pemasukan</option>
							<option>Pengeluaran</option>
						</select>
					</div>
					<div class="form-group">
						<label>Keterangan</label>]
						<textarea class="form-control"></textarea>
					</div>
					<div class="form-group">
						<label>Jumlah</label>
						<input type='text' class="form-control" />
					</div>
		        </form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
		        <button type="button" class="btn btn-primary">Simpan</button>
		      </div>
		    </div>
		  </div>
		</div>

    </div>
</div>