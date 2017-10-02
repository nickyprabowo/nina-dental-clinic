<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//asiyahahaha


class Kasir extends MX_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','form','html'));
        $this->load->module('login'); 
		$this->load->library('session');
		$this->load->library('sending');
		$this->load->library('UUID');
		$this->load->module('sendserver');
        $this->login->is_logged_in();
		$this->load->model('kasir_m');
    }

	public function index()
	{
        $data['content'] = 'antrian';
        $data['navbar'] = 'navbar';
        $data['sidebar'] = 'sidebar';
		$this->load->view('template', $data);    
	}


	public function section($page)
    {
        if(isset($page))
        {
            $data['content'] = $page;
            $data['navbar'] = 'navbar';
			$data['sidebar'] = 'sidebar';
			$data['kasir']=$this;
			if ($page=='antrian'){
				$data['antrian'] = $this->getlistantrian();
					}
					
            $this->load->view('template', $data);
        }
        else
        {
            $data['content'] = 'blank_page';
            $data['navbar'] = 'navbar';
            $data['sidebar'] = 'sidebar';
            $this->load->view('template', $data);
        }
    }
	
	function getlistantrian(){
		$this->load->module('rekam_medik');
		$data['list']=$this->kasir_m->listantrian();
		foreach ($data['list'] as $row){
			 $q=$this->rekam_medik_m->getdetailkaryawan($row->id_antrian,'Antri');
						$row->karyawan[]=$q;
						$data1[]=$row;
				}
			//print_r ($data1);
			return $data1;
		}
		
	public function pushantrian($id){
		if ($_POST!=null){
				if ($_POST['foto1']!=null) $_POST['foto']=$this->camphotoupload();
				$idrekam=$this->kasir_m->pushantrian($id);
			}
			//print_r($_POST);
			$antrian = $this->getlistantrian();
			$this->viewantrian($antrian);
		}
	
	public function viewantrian($antrian){
			if ($antrian==null) $antrian=$this->getlistantrian();
			
					echo '
					  <table id="antri2" class="table table-bordered table-striped">
							  <thead>  
								  <tr>
									<th>No</th>
									<th>Nama Pasien</th>
									<th>Status</th>
									<th class="text-center">Action</th>
								  </tr>
								</thead>
						  <tbody>';
					$a=new DateTime(date("Y-m-d"));
					foreach ($antrian as $row){
						
						$detail='<div class="btn-group"><button type="button" data-toggle="modal"   data-target="#modal" onclick="proses(\''.$row->id_antrian.'\',\''.$row->status.'\',\''.$row->id_rekam_medik.'\');" class="btn btn-flat btn-primary"><i class="fa fa-fw fa-arrow-right"></i> Proses</button>';
						$i++;
						
						// for button//
						if ($row->foto==null) $row->foto="assets/img/unknown.jpg";
						
						if ($row->status=='Antri') {$status='Antri';}
													
						elseif ($row->status=='On Progress') {
															$status='Sedang ditangani oleh <br>';
															$detail .='<button type="button" data-toggle="modal"   data-target="#modal" onclick="editantrian(\''.$row->id_antrian.'\',\''.$row->id_rekam_medik.'\');" class="btn btn-flat btn-warning"><i class="fa fa-fw fa-edit"></i> Ubah Data</button>
																	   <button type="button" onclick="hapusantri(\''.$row->id_antrian.'\');" class="btn btn-flat bg-maroon"><i class="fa fa-fw fa-times"></i> Hapus</button></div>';
															}
															
						elseif ($row->status=='Selesai_ditangani') {
																$status='Selesai Ditangani';
																$detail .=' <button type="button" data-toggle="modal"   data-target="#modal" onclick="editantrian(\''.$row->id_antrian.'\',\''.$row->id_rekam_medik.'\');" class="btn btn-flat btn-warning"><i class="fa fa-fw fa-edit"></i> Ubah Data</button>
																			<button type="button" data-toggle="modal"   data-target="#modal" onclick="detailrekam(\''.$row->id_antrian.'\',\''.$row->id_rekam_medik.'\');" class="btn btn-flat bg-olive"><i class="fa fa-fw fa-search"></i> detail</button>
																			<button type="button" onclick="hapusantri(\''.$row->id_antrian.'\');" class="btn btn-flat bg-maroon"><i class="fa fa-fw fa-times"></i> Hapus</button></div>';}
																			
						else { $status='Selesai';
							   $detail='<button type="button" data-toggle="modal"   data-target="#modal" onclick="detailrekam(\''.$row->id_antrian.'\',\''.$row->id_rekam_medik.'\');" class="btn btn-flat btn-success"><i class="fa fa-fw fa-search"></i> detail</button>
										<button type="button" onclick="window.open(\''.base_url().'kasir/printresi/'.$row->id_rekam_medik.'\',\'cetakresi\',\'scrollbars=yes,status=no,menubar=no,width=800,height=400\')" class="btn btn-flat btn-info"><i class="fa fa-fw fa-print"></i> Cetak</button>';
						}		 										 
						$b=new DateTime($row->tgllhr_pasien);
						$umur=$a->diff($b);
						 
						// echo the list
						echo '<tr>
								<td>'.$row->nomer_antrian.'</td>
								<td>
									<img border="0"  src="'.base_url().$row->foto.'" width="100" height="100">
									<h4><b>'.$row->nama_pasien.'</b></h4>
									<span>'.$umur->y.' Tahun dan '.$umur->m.' Bulan</span>
								</td> 
								<td class="status-antrian" id="'.$row->nomer_antrian.'">'.$status;
								if ($row->status=='On Progress'){
									foreach ($row->karyawan as $q){
										foreach ($q as $z){
											echo $z->nama_karyawan .'<br>';
											}
										}
								}
						echo'</td>
								<td class="text-center">
									'.$detail.'
									
								</td>
							  </tr>	';
							}
					echo '</tbody>
						</table>
						<script>$("#antri2").DataTable({order:[[0,"asc"]]});</script>
						';
	}
	
    public function proses(){ 
		if ($_POST['status']=='Antri'){
			echo '<input type="hidden" name="stat" id="stat" value="'.$_POST['status'].'"> 
				  <input type="hidden" name="id_antrian" id="id_antrian" value="'.$_POST['id_antrian'].'">';
							$this->getlistkaryawan();
				echo '<div class="action">
					  <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Close</button>
					  <button type="button" onclick="pushantrian();" data-dismiss="modal"  class="btn btn-flat btn-primary">Save changes</button>
				  </div>';
			}
		elseif ($_POST['status']=='On Progress') {
				echo '
				   <input type="hidden" name="id_antrian" id="id_antrian" value="'.$_POST['id_antrian'].'"> 
						 <input type="hidden" name="stat" id="stat" value="'.$_POST['status'].'"> 
						 <input type="hidden" name="id_rekam_medik" id="id_rekam_medik" value="'.$_POST['id_rek'].'">';
                    $this->getlistdiagnosa();
					$this->getlisttindakan();
					$this->getresepandobat();
                    echo '</br>';
					$this->getwebcam();
			 echo' <button type="button" class="btn-flat btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" onclick="pushantrian();" data-dismiss="modal"  class="btn-flat btn btn-primary">Save changes</button>
				  <div id="webcam"></div>
				 <div class="modal"></div>
			';	
			}
		
		else {
				$this->load->module('rekam_medik');
				$data =$this->rekam_medik_m->getrekammedik($_POST['id_rek']);
				echo 'Data Rekam Medik Tidak akan bisa diubah/dihapus lagi jika pembayaran selesai. Pastikan Data yang akan Diinput telah Benar. Jumlah biaya yang harus dibayarkan adalah <b>'.$data[0]->biaya.'</b> </br>
						Pembayaran
						<select id="pembayaran" class="form-control" name="pembayaran" onchange="kredit(this.value)">
							<option value="Cash">Cash</option>
							<option value="Kredit">Kredit</option>
							<option value="EDC">EDC</option>
						</select>
						<div class=row>
						<div id="kredit"></div>
						 <input type="hidden" name="id_antrian" id="id_antrian" value="'.$_POST['id_antrian'].'"> 
						 <input type="hidden" name="stat" id="stat" value="'.$_POST['status'].'"> 
						 <input type="hidden" name="id_rekam_medik" id="id_rekam_medik" value="'.$_POST['id_rek'].'"> </div>
					<button type="button" class="btn-flat btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" onclick="pushantrian();" data-dismiss="modal"  class="btn-flat btn btn-primary">Save changes</button>
				';	
			}	
		}
				
	public function editantrian(){
		$data=$this->getdetailrekam();
		//print_r($data);
		foreach ($data as $row){ 
			$i=1;
			echo '<input type="hidden" name="id_antrian" id="id_antrian" value="'.$_POST['id_antrian'].'">
				  <input type="hidden" name="id_antrian" id="id_rekam_medik" value="'.$_POST['id_rekam_medik'].'">';
				$last=count($row->karyawan);
				if ($last==0) $this->getlistkaryawan();
				foreach ($row->karyawan as $a){
					$this->getlistkaryawan($a->id_karyawan,$i,$last);
					$i++;
				}
			if ($row->id_resep!=0 && $row->id_resep!=null){ 
				$i=1;
					$last=count($row->diagnosa);
					if ($last==0) $this->getlistdiagnosa();
                      foreach ($row->diagnosa as $b){ 
							$this->getlistdiagnosa($b->id_diagnosa,$i,$last);
							$i++;
					  }
				$i=1;
					$last=count($row->tindakan);
					if ($last==0) $this->getlisttindakan();
                      foreach ($row->tindakan as $c){ 
							$this->getlisttindakan($c->id_tindakan,$i,$last,$c->biaya);
							$i++;
					  }
				$this->getresepandobat($row->obat,$row->keterangan_resep); 
				echo '</br>';  
				$this->getwebcam($row->galeri);
				
			}	
			echo '
				<div class="row">
				<div class="container">
				<button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Close</button>
				<button type="button" onclick="prosesedit();" data-dismiss="modal"  class="btn btn-flat btn-primary">Save changes</button>
              </div>
			</div>
			<div id="webcam"></div>
			<div class="modal"></div>
			
			';	  
		}
			//$this->getlistkaryawan();	
	}
		
	public function getresepandobat($data,$resep){
			// print_r($data);
			 echo '<div class="formresep">
						<div class="row">
							<label for="resep" class="col-sm-3 control-label">Resep </label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="resep" id="resep" value="'.$resep.'" required>
							</div>
					 </div>
					 <br>
					</div>
				<div class="formobat">
							<div class="row">
							<label for="obat" class="col-sm-3 control-label">Obat</label> 
									<button class="btn-flat btn btn-warning" onclick="tambahform(\'obat\');"><i class="fa fa-fw fa-plus"></i></button>
								<div class="col-sm-8">';
					if ($data!=null){
					$i=1;
					$last=count($data);
					if ($last==0) $this->getlistobat();
                      foreach ($data as $d){
							$this->getlistobat($d->id_obat,$d->jumlah,$i,$last,$d->hargatotal);
							$i++;
							}
						}
					else $this->getlistobat();
							echo '</div>
						</div>
				</div>
				';
					
	} 
	
	public function prosesedit(){	
			$data = $_POST;
			$foto=$data['diagnosaresep']['foto1'];	
			if ($foto!=null) $foto=$this->camphotoupload($foto);
			$this->kasir_m->prosesedit($data,$foto);
			$antrian = $this->getlistantrian();
			$this->viewantrian($antrian);
		} 
				
	public function viewdetailrekam(){
			$data1=$this->getdetailrekam();
			foreach ($data1 as $a){
				if ($a->galeri==null) $a->galeri="assets/img/unknown.jpg";  
				if ($a->foto_pasien==null) $a->foto_pasien="assets/img/unknown.jpg";  
					echo '<div class="container-fluid">
						<div class="row">
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
								<p><b>Foto Pasien</b></p>
	                			<img src="'.base_url().$a->foto_pasien.'" style="width:100px;height:100px;">
								</br></br>
								<p><b>Galeri Pemeriksaan  </br>'.date('d M Y',strtotime($a->tanggal)).'</b></p>
	                			<img src="'.base_url().$a->galeri.'" style="width:100px;height:100px;">
	                		</div>
							<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
	                			<div class="row">
	                				<div class="col-xs-16 col-sm-16 col-md-16 col-lg-16">
										<div class="row">
	                						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
	                							<p><b>Nama Pasien</b></p>
	                						</div>
	                						<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
	                							<p>'.$a->nama_pasien.'</p>
	                						</div>
	                					</div>
										
										<div class="row">
	                						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
	                							<p><b>Ditangani Oleh</b></p>
	                						</div>
	                						<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
	                							<p>';$i=1;
													foreach ($a->karyawan as $b){
														echo $i.' - '.$b->nama_karyawan.'<br>';
														$i++;
													}
											echo '</p>
	                						</div>
	                					</div>
									
										<div class="row">
	                						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
	                							<p><b>Diagnosa yang Diperoleh</b></p>
	                						</div>
	                						<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
	                							<p>';
												$i=1;
													foreach ($a->diagnosa as $c){
														echo $i.' - '.$c->nama_diagnosa.'<br>';
														$i++;
													}
											echo '</p>
	                						</div>
	                					</div>
										
										
										<div class="row">
	                						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
	                							<p><b></b></p>
	                						</div>
	                						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
	                							<p></p>
	                						</div>
											<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
	                							<p><b> Biaya</b></p>
	                						</div>
										
	                					</div>
										
										<div class="row">
	                						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
	                							<p><b>Tindakan yang dilakukan</b></p>
	                						</div>
	                						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
	                							<p>';$i=1;
													foreach ($a->tindakan as $d){
														echo $i.' - '.$d->nama_tindakan.'<br>';
														$i++;
													}
											echo '</p>
	                						</div>
											
											<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
	                							<p>';$i=1;
													foreach ($a->tindakan as $d){
														echo $i.' - '.$d->biaya.'<br>';
														$i++;
													}
												echo '
												</p>
	                						</div>
											
	                					</div>
										<div class="row">
	                						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
	                							<p><b>Resep yang diberikan</b></p>
	                						</div>
	                						<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
	                							<p>'.$a->keterangan_resep.'</p>
	                						</div>
	                					</div>
										<div class="row">
	                						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
	                							<p><b>Obat yang Diberikan</b></p>
	                						</div>
	                						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
	                							<p>';$i=1;
													foreach ($a->obat as $e){
														echo $i.' - '.$e->nama_obat.' ('.$e->jumlah.') <br>';
														$i++;
													}
											echo '</p>
	                						</div>
											<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
	                							<p>';$i=1;
													foreach ($a->obat as $e){
														echo $i.' - '.$e->hargatotal.'<br>';
														$i++;
													}
											echo '</p>
	                						</div>
	                					</div>
										<div class="row">
	                						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
	                							<p><b>Total Biaya</b></p>
	                						</div>
	                						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
	                							<p></p>
	                						</div>
											<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
	                							<p>'.$a->biaya.'</p>
	                						</div>
	                					</div>';
									if ($a->jenis_pembayaran!=null){
										echo '<div class="row">
	                						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
	                							<p><b>Jenis Pembayaran</b></p>
	                						</div>
											<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
	                							<p>'.$a->jenis_pembayaran.'</p>
	                						</div>
	                					</div>
										<div class="row">
	                						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
	                							<p><b>Jumlah Pembayaran</b></p>
	                						</div>
	                						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
	                							<p></p>
	                						</div>
											<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
	                							<p>'.$a->jumlah_pembayaran.'</p>
	                						</div>
	                					</div>';
										if ($a->jenis_pembayaran=='Kredit'){
											echo '<div class="row">
	                						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
	                							<p><b>Keterangan Pembayaran</b></p>
	                						</div>
											<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
	                							<p>'.$a->keterangan_pembayaran.'</p>
	                						</div>
	                					</div>';
										}
										
										
									echo '
											<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
	                							<p><b></b></p>
	                						</div>
											<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
	                							<p><button type="button" onclick="window.open(\''.base_url().'kasir/printresi/'.$a->id_rekam_medik.'\',\'cetakresi\',\'scrollbars=yes,status=no,menubar=no,width=800,height=400\')" class="btn btn-flat btn-info"><i class="fa fa-fw fa-print"></i> Cetak</button></p>
	                						</div>
	                					</div>';	
									}	
									else {
										echo '<div class="row">
	                						<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
	                							<p><b>Pembayaran Belum dilakukan</b></p>
	                						</div>
											<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
	                							<p></p>
	                						</div>
	                					</div>';
									}
								
									
								echo'</div>
								</div>
							</div>
	                	</div>
					</div>';
				}
	}
	
	public function getdetailrekam($id){
			if ($_POST['id_rekam_medik']==null) $_POST['id_rekam_medik']=$id;
			$this->load->module('rekam_medik');
			foreach ($this->rekam_medik_m->getrekammedik($_POST['id_rekam_medik']) as $row){
					$row->karyawan=$this->rekam_medik_m->getdetailkaryawan($_POST['id_rekam_medik']);
					$row->tindakan=$this->rekam_medik_m->getdetailtindakan($_POST['id_rekam_medik']);
					$row->diagnosa=$this->rekam_medik_m->getdetaildiagnosa($_POST['id_rekam_medik']);
					$row->obat=$this->rekam_medik_m->getdetailresep_to_obat($row->id_resep);
					$data1['pasien']=$row;	
			}
			return $data1;
		}
		
	public function listpasien(){
			$listpasien = $this->user_m->listpasien();
			echo '
				<script> $("#antrian").DataTable({
							"aLengthMenu": [[5, 10, 15, 25, -1], [5, 10, 15, 25, "All"]],
							"pageLength": 5}); </script>  
				<table id="antrian" class="table table-bordered">
					<thead>
					  <tr>
						<th>Nama Pasien</th>
						<th>umur</th>
						<th>Foto</th>
						<th class="text-center">Action</th>
					  </tr>
				</thead>
				<tbody id="antrian">';	
					 $i=0;
					$a=new DateTime(date("Y-m-d"));
					foreach ($listpasien as $row){
						if ($row->foto==null) $row->foto="assets/img/unknown.jpg";
						$i++;
						$b=new DateTime($row->tgllahir);
						$umur=$a->diff($b);
						echo '<tr>
								
								<td>'.$row->nama.'</td>
								<td>'.$umur->y.' Tahun dan '.$umur->m.' Bulan</td>
								<td><img src="'.base_url().$row->foto.'" style="heigth:100px;width:100px"> </td>
								<td class="text-center">
									<button type="button" onclick="pushantrian(\''.$row->id_pasien.'\');" data-dismiss="modal"  class="btn btn-flat bg-orange"><i class="fa fa-fw fa-pencil"></i> Pilih</button>
								</td>
							  </tr>	';
							}
			echo '	</tbody>
				  </table>';	
	}
		
	public function getlistkaryawan($a,$i,$l){
			$this->load->module('staff');
			$list=$this->karyawan_m->listkaryawan();
			if ($i==null){	
					$_POST['sum']=substr(key($_POST), 0);
					$_POST['sum']=explode('_',$_POST['sum']);
					$id=$_POST['sum'][1]+1;}	
			else $id=$i;
			if ($id<2){
				echo ' <div class="formkaryawan">
						 <div class="row">
							<label for="karyawan" class="col-sm-3 control-label">List Karyawan</label>
							<button class="btn-tambah btn btn-flat btn-warning" onclick="tambahform(\'karyawan\');">
						  <i class="fa fa-fw fa-plus"></i></button>
						  <div class="col-sm-8">';}
				else echo  '
						<div class="row">
							<label for="karyawan" class="col-sm-3 control-label"></label>
							  <button class="btn-tambah btn btn-flat btn-danger" id="karyawanmin_'.$id.'" onclick="minform(\'karyawan_'.$id.'\');minform(\'karyawanmin_'.$id.'\');">
								<i class="fa fa-fw fa-minus"></i> 
								</button>
								<div class="col-sm-8">';  
					echo ' <select class="form-control" name="karyawan_'.$id.'" id="karyawan_'.$id.'">
						   <option value="0">Pilih Karyawan</option>
					';
					foreach ($list as $row){
						if ($a==$row->id_karyawan) $selected='selected';
						else $selected='';
						echo '<option value="'.$row->id_karyawan.'" '.$selected.'>'.$row->nama.'</option>';	
					}
				echo '</select>  
						<input type="hidden" name="sumkaryawan" id="sumkaryawan" value="'.$id.'">
							</div>
						</div>'; 
				if ($l==null) echo '</div>';   
				if ($id==$l) echo '</div>';
			
				
		}
	
	public function getlistdiagnosa($b,$i,$l){
			$this->load->module('diagnosa');
			$diagnosa=$this->diagnosa_m->getlistdiagnosa();
			if ($i==null){	
					$_POST['sum']=substr(key($_POST), 0);
					$_POST['sum']=explode('_',$_POST['sum']);
					$id=$_POST['sum'][1]+1;}	
			else $id=$i;
			
			if ($id<2){
				echo '<div class="formdiagnosa">
						 <div class="row">
							<label for="karyawan" class="col-sm-3 control-label">List Diagnosa</label> 
							<button class="btn-tambah btn btn-flat btn-warning" onclick="tambahform(\'diagnosa\');"> 
						  <i class="fa fa-fw fa-plus"></i></button>
						  ';}
				else echo  '<div class="row">
							<label for="diagnosa" class="col-sm-3 control-label"></label>
							  <button class="btn-tambah btn btn-flat btn-danger" id="diagnosamin_'.$id.'" onclick="minform(\'diagnosa_'.$id.'\');minform(\'diagnosamin_'.$id.'\');"><i class="fa fa-fw fa-minus"></i></button>
								'; 
				echo '<div class="col-sm-8">
						<select class="form-control" name="diagnosa_'.$id.'" id="diagnosa_'.$id.'">
						<option value="0">Pilih Diagnosa Yang Didapatkan</option>
						';
					foreach ($diagnosa->result() as $row){
						if ($b==$row->id_diagnosa) $selected='selected'; 
						else $selected='';
						echo '<option value="'.$row->id_diagnosa.'" '.$selected.'>'.$row->nama.'</option>';	
					}			
				echo '</select>  
							<input type="hidden" name="sumdiagnosa" id="sumdiagnosa" value="'.$id.'">
								</div>
						</div>';
				if ($l==null && $id<2) echo '</div><br>';  
				if ($id==$l) echo '</div><br>';
		}
		
	public function getlisttindakan($c,$i,$l,$biaya){
			$this->load->module('tindakan');
			$tindakan=$this->tindakan_m->listtindakan();
			if ($i==null){	
					$_POST['sum']=substr(key($_POST), 0);
					$_POST['sum']=explode('_',$_POST['sum']);
					$id=$_POST['sum'][1]+1;}	
			else $id=$i;
			if ($id<2){
				echo '<div class="formtindakan">
						 <div class="row">
							<label for="diagnosa" class="col-sm-3 control-label">List Tindakan</label>
							<button class="btn-tambah btn btn-flat btn-warning" onclick="tambahform(\'tindakan\');"><i class="fa fa-fw fa-plus"></i></button>
						  ';}
				else echo  '<div class="row"> 
								<label for="tindakan" class="col-sm-3 control-label"></label>
									<button class="btn-tambah btn btn-flat btn-danger"  id="tindakanmin_'.$id.'" onclick="minform(\'tindakan_'.$id.'\');minform(\'tindakanmin_'.$id.'\');"><i class="fa fa-fw fa-minus"></i></button>';
				echo '	<div class="col-sm-5">
					<select class="form-control" onchange="hargatindakan(this,\'hargatindakan_'.$id.'\');" name="tindakan_'.$id.'" id="tindakan_'.$id.'">
					<option value="0">Pilih Tindakan Yang Dilakukan</option>
					';
					foreach ($tindakan as $row){
						if ($c==$row->id_tindakan) $selected='selected'; 
						else $selected='';
						echo '<option name="'.$row->biaya.'"  value="'.$row->id_tindakan.'" '.$selected.'>'.$row->nama.' <p>@ '.$row->biaya.'</p></option>';	
					}			 
				echo '</select>  
							<input type="hidden" name="sumtindakan" id="sumtindakan" value="'.$id.'">
						</div>
					<div class="col-sm-3"><input class="form-control" id="hargatindakan_'.$id.'" type="number" placeholder="hargatindakan" value="'.$biaya.'"></div> 
						
					</div>';
				if ($l==null && $id<2) echo '</div><br>';  
				if ($id==$l) echo '</div><br>'; 
					
		}
		
	public function getlistobat($d,$jumlah,$i,$l,$harga){
		
			$this->load->module('obat');
			$obat=$this->obat_m->listobat();
			if ($i==null){	
					$_POST['sum']=substr(key($_POST), 0);
					$_POST['sum']=explode('_',$_POST['sum']);
					$id=$_POST['sum'][1]+1;}	
			else $id=$i;
			if ($jumlah==null) $jumlah=0;
				if ($id>1){
				echo '
				     <div class="row">
						</br>
							<label for="obat" class="col-sm-3 control-label"></label>
							<button class="btn-tambah btn btn-flat btn-danger"  id="obatmin_'.$id.'" onclick="minform(\'hargaobat_'.$id.'\');minform(\'obat_'.$id.'\');minform(\'jumlahobat_'.$id.'\');minform(\'labelobat_'.$id.'\');minform(\'obatmin_'.$id.'\');"><i class="fa fa-fw fa-minus"></i></button>
								<div class="col-sm-8">';
				}
				echo '<select class="form-control" onchange="cekobat('.$id.');" name="obat_'.$id.'" id="obat_'.$id.'">
						<option value="0">Pilih Obat Yang Diperlukan</option>';
					foreach ($obat as $row){ 
						$set='';
						$stok='';
						if ($d==$row->id_obat) $selected='selected';
						else $selected='';
						if ($row->stok <=20)  {
							$set='style="color:red;"';
						}
						echo '<option '.$set.' value="'.$row->id_obat.'" '.$selected.'>'.$row->nama.' @ '.$row->harga.'</option>';	
					}
				echo '</select>
						</div> 
					</div>  
						<div class="row">
							<input type="hidden" name="sumobat" id="sumobat" onchange="hargaobat(this.value);" value="'.$id.'">
							<div id="hideobat_'.$id.'"  style="display:none;" >
							<label for="obat" id="labelobat_'.$id.'" class="col-sm-3 control-label">Jumlah Obat</label>
							<div class="col-sm-3">
								<input type="number" onchange="jumlahobat('.$id.');" class="form-control" name="jumlahobat_'.$id.'"  id="jumlahobat_'.$id.'" value="'.$jumlah.'"  required>
							</div>
							<label for="obat" id="labelobat_'.$id.'" class="col-sm-1 control-label">Harga</label>
							<div class="col-sm-4">	
								<input type="number" class="form-control" name="hargaobat_'.$id.'" id="hargaobat_'.$id.'" value="'.$harga.'" required>
								</div>
							</div>
						</div>
					';
				if ($i!=null){
					echo '<script>$(document).ready(function(){
								document.getElementById("hideobat_'.$id.'").style.display="";
						   });</script>';
					
				}
		}
	
	public function getwebcam($i){
		
		if ($i==null){
			$i='assets/img/unknown.jpg';
		}
		echo '<div class="form-group">
					<div class="row">
					  <label for="foto" class="col-sm-3 control-label">Foto Penanganan</label>
							<div class="col-sm-3">  
								  <div id="results" style="height:100px;width:100px;">
									<img border="0"  id="fotoedit" src="'.base_url().$i.'" width="100" height="100">
								  </div>  
							</div>
								<div class="col-sm-6">
								  <button type="button" class="formedit btn btn-primary" onclick="callwebcam();" class="btn btn-flat btn-success"><i class="fa fa-camera" aria-hidden="true"></i></button> 
								  <button type="button" class="formedit btn btn-primary" onclick="getfoto();" class="btn btn-flat btn-success"><i class="fa fa-upload" aria-hidden="true"></i></button> 
								  <label class="control-label">Jika ingin menggunakan kamera ponsel, silahkan pilih tombol upload dan pilih opsi kamera pada ponsel anda</label>
								  <input class="formedit" type="file" name="foto" id="foto" style="display:none;"> 
								  <script>	document.getElementById("foto").addEventListener(\'change\', handleFileSelect, false);</script> 
								  <input type="hidden" name="foto1" id="foto1" value="">
								 </div>
								 
							</div>
					 </div>';
	}
	
	function printresi($id){
		$data['pasien']=$this->getdetailrekam($id);
		$this->load->view('laporantemplate',$data);
	}
	 
	
	private function camphotoupload($f){   
				
				if ($f==null) {$encoded_data = $_POST['foto1'];
				}
				else  $encoded_data=$f;
				$binary_data = base64_decode( $encoded_data );
				$url = "assets/foto/".uniqid(rand()).'.jpg';
				$result = file_put_contents( $url, $binary_data);
				if (!$result) die("Could not save image!  Check file permissions.");
				else return $url;
		}
} 
