
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pasien extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','form','html'));
        $this->load->library('session');
		$this->load->library('uuid');
        $this->load->module('login');
        $this->load->module('sendserver');
        $this->login->is_logged_in();
		$this->load->model('pasien_m');
    }

    public function index()
    {	
        $data['content'] = 'pasien_v';
        $data['navbar'] = 'navbar';
        $data['sidebar'] = 'sidebar';
		$data['pasien'] = $this; 
		$data['listpasien']=$this->pasien_m->listPas();
        $this->load->view('template', $data);		
    }
	
	function list_pasien($listpasien){
		echo '<script>$("#example2").DataTable();</script>
			  <table id="example2" class="table table-bordered table-hover">
                    <thead>
						  <tr>
							<th>Nama</th>
							<th>Usia</th>
							<th>Alamat</th>
							<th>Action</th>
						  </tr>
                    </thead>
                    <tbody>';
						$a=new DateTime(date("Y-m-d"));
						foreach($listpasien as $row){
							$b=new DateTime($row->tgllahir);
							$umur=$a->diff($b);
								echo '<tr>
										<td>'.$row->nama.'</td> 
										<td>'.$umur->y.' Tahun dan '.$umur->m.' Bulan</td>
										<td>'.$row->alamat.'</td>
										<td class="text-center">
											<button type="button" onclick="detPas(\''.$row->id_pasien.'\');"  class="btn btn-flat bg-olive"><i class="fa fa-fw fa-search"></i></button>
											<button type="button" onclick="delPas(\''.$row->id_pasien.'\');" class="btn btn-flat bg-maroon"><i class="fa fa-fw fa-times"></i></button>
										</td>
									  </tr>
									';
							}
			echo '</tbody>
                  </table>';
		
		
	}
	
	public function addpasien(){
		if ($_POST['submit']==null){
			$data['content'] = 'addPasien_v';
			$data['navbar']  = 'navbar';
			$data['sidebar'] = 'sidebar';
			$data['cabang'] = $this->user_m->listcabang();
			$this->load->view('template', $data);
		}
		else {
			if ($_FILES["foto"]["name"]!=null) $_POST['foto']=$this->filephotoupload(); 
			if ($_POST["foto1"]!=null) $_POST['foto']=$this->camphotoupload();
			$this->pasien_m->addPas();
			redirect('pasien',refresh);
		}
	}
	
	
	
	public function editPasien(){
		if ($_POST['hapus']==false){  
			if ($_FILES["foto"]["name"]!=null) $_POST['foto']=$this->photoupload();
			if ($_POST["foto1"]!=null) $_POST['foto']=$this->camphotoupload();
			$this->pasien_m->editPas();}
		else { 
			$this->pasien_m->delPas();}
			$listpasien=$this->pasien_m->listPas();
			$this->list_pasien($listpasien);
		}
	
	public function detPasien(){
		foreach ($this->pasien_m->listPas() as $row){
			if ($row->foto==null) $row->foto="assets/img/unknown.jpg";
			$row->tgllahir=date('d-m-Y',strtotime($row->tgllahir));
			echo ' <div class="box-body">
					  <div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
						<div class="col-sm-10">
						  <input type="text" class="form-control formedit" id="nama"  value="'.$row->nama.'" disabled>
						  <input type="hidden" class="form-control formedit" id="id_pasien" value="'.$row->id_pasien.'">
						</div>
					  </div>
					  <div class="form-group">
						<label for="inputPassword3" class="col-sm-2 control-label">Alamat</label>
						<div class="col-sm-10">
						  <input type="text" class="form-control formedit" id="alamat" value="'.$row->alamat.'" disabled>
						</div>
					  </div>
					  <div class="form-group">
						<label for="inputPassword3" class="col-sm-2 control-label">Tgl lahir</label>
						<div class="col-sm-10 date">
							<input type="text" class="form-control formedit" name="tgllahir" id="tglLahir" value="'.$row->tgllahir.'" disabled>
						</div>
					  </div>
					  <div class="form-group">
						<label for="inputPassword3" class="col-sm-2 control-label">Jenis Kelamin</label>
						<div class="col-sm-10">
						  <select class="form-control formedit" id="jeniskelamin" disabled>
							<option value="Laki-laki">Laki-laki</option>
							<option value="Perempuan">Perempuan</option>
						  </select>
						</div>
					  </div>
					  <div class="form-group">
						<label for="inputPassword3" class="col-sm-2 control-label">Pekerjaan</label>
						<div class="col-sm-10">
						  <input type="text" class="form-control formedit" id="pekerjaan" value="'.$row->pekerjaan.'" disabled>
						</div>
					  </div>
					 <div class="form-group">
					  <label for="foto" class="col-sm-2 control-label">Foto</label>
							<div class="row">
							<div class="col-sm-3">  
								  <div id="results" style="height:125px;width:125px;">
									<img border="0"  id="fotoedit" src="'.$row->foto.'" width="125px" height="125px">
								  </div>  
							</div>
								<div class="col-sm-6"> 
								  <button type="button" class="formedit btn btn-primary" onclick="callwebcam();" class="btn btn-flat btn-success" disabled><i class="fa fa-camera" aria-hidden="true" ></i></button> 
								  <button type="button" class="formedit btn btn-primary" onclick="getfoto();" class="btn btn-flat btn-success" disabled><i class="fa fa-upload" aria-hidden="true" ></i></button> 
								  <label class="formedit">Jika ingin menggunakan kamera ponsel, silahkan pilih tombol upload dan pilih opsi kamera pada ponsel anda</label>
								  <input class="formedit" type="file" name="foto" id="foto" style="display:none;"> 
								  <script>	document.getElementById("foto").addEventListener(\'change\', handleFileSelect, false);</script> 
								  <input type="hidden" name="foto1" id="foto1" value="">
								 </div>
							</div>
					 </div>
					  <div class="form-group">
						<label for="inputPassword3" class="col-sm-2 control-label">Email</label>
						<div class="col-sm-10">
						  <input type="email" class="form-control formedit" id="email" value="'.$row->email.'" disabled>
						</div>
					  </div>
					</div><!-- /.box-body -->
					<div id="actionbox" class="box-footer text-right">
						 <a class="btn btn-app">
						   <i class="fa fa-edit" onclick="edit();"></i> Ubah
						 </a>
					</div><!-- /.box-footer -->';
		}
	}

		private function filephotoupload(){
				
				$type = explode('.', $_FILES["foto"]["name"]);
				$type = $type[count($type)-1];
				$url = "assets/foto/".uniqid(rand()).'.'.$type;
				//$_POST["foto"]=$url;
				move_uploaded_file($_FILES["foto"]["tmp_name"], $url);
				if(is_uploaded_file($_FILES["foto"]["tmp_name"])){
						if(move_uploaded_file($_FILES["foto"]["tmp_name"], $url)){
							return $url;
						}
					}
		}
		
		
		private function camphotoupload(){
			    $encoded_data = $_POST['foto1'];
				$binary_data = base64_decode( $encoded_data );
				$url = "assets/foto/".uniqid(rand()).'.jpg';
				//$_POST["foto"]=$url;
				//file_put_contents('http://www.ninadentalcare.com/'.$url, $binary_data);
				echo base_url().$url;
				$result = file_put_contents( $url, $binary_data);
				if (!$result) die("Could not save image!  Check file permissions.");
				else return $url;
			
		}
}    