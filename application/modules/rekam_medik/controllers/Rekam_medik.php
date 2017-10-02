<?php
/**
*
*
* Rekam Medis
*
*
**/
?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rekam_medik extends MX_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','form','html'));
        $this->load->library('session');
		$this->load->module('login');
		$this->load->module('pasien');
		$this->login->is_logged_in();
		$this->load->model('rekam_medik_m');
    }

	public function index()
	{
        $data['content'] = 'rekam_medik';
        $data['navbar'] = 'navbar';
        $data['sidebar'] = 'sidebar';
		$data['pasien'] = $this;
		$data['listpasien']=$this->pasien_m->listPas();
		$this->load->view('template', $data);    
	}

	
	function listrekam(){
		echo '<script>$("#example3").DataTable();</script>
			  <table id="example3" class="table table-bordered table-hover">
                    <thead>
						  <tr>
							<th>id rekam medik</th>
							<th>Tanggal Periksa</th>
							<th>Biaya</th>
							<th>Action</th>
						  </tr>
                    </thead> <tbody>';
		foreach ($this->rekam_medik_m->getrekammedik() as $row){
				$nama=$row->nama_pasien;
				if ($row->tanggal!=null){
					echo ' <tr>
								<td>'.$row->id_rekam_medik.'</td>
								<td>'.$row->tanggal.'</td>
								<td>'.$row->biaya.'</td>
								<td><button type="button" onclick="detailrekam(\''.$row->id_pasien.'\',\''.$row->id_rekam_medik.'\');"  data-toggle="modal"  data-target="#modal" class="btn btn-flat bg-olive"><i class="fa fa-fw fa-search"></i></button>
												
								</tr>';
				}
			
			
		}
		
		if ($_POST==null) $nama=' seluruh pasien';
		echo '</tbody>
			</table>
			<script> document.getElementById("nama_pasien").innerHTML = "'.$nama.'";</script>
				';
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
										</td>
									  </tr>
									';
							}
			echo '</tbody>
                  </table>';
		
		
	}
	
	function getall(){
		
		
		
	}
	
}
