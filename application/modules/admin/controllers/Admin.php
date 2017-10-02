<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Admin extends MX_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','form','html'));
        $this->load->library('session');
        $this->load->library('sending');
        // Akses modul lain
        $this->load->module('login');
        //$this->load->model('dashboard_m');
        $this->load->module('pasien');
		$this->load->module('kasir');
        //akses method di di modul lain
        $this->login->is_logged_in();
    }
 
    public function index()
    {
    	$data['content'] = 'dashboard';
        $data['navbar'] = 'navbar';
        $data['sidebar'] = 'sidebar';
		$data['harian'] = $this->kasir_m->listantrian(); 
		$data['bulanan'] = $this->kasir_m->listantrian('bulan');
		$data['tahun'] = $this->kasir_m->listantrian('tahun');
		$data['pasien'] = $this->pasien_m->listPas();
		$this->load->view('template', $data);
		// $this->sentserver->sent();
    }
	
	
	public function statistik(){
		
		$get=$this->kasir_m->statistik();
			foreach ($get as $row){
				if ($_POST['type']==1) $tanggal[]=substr($row->Date,5);
				else $tanggal[]=$row->date; 
				$data[]=$row->total;
			}
		$statistik= array($tanggal, $data);
		echo json_encode($statistik);
	}
	
	public function promo(){
		print_r($_POST);
				$encoded_data = $_POST['foto'];
				$binary_data = base64_decode( $encoded_data );
				$url = "assets/foto/promo.jpg";
				$_POST["foto"]=$url;
				$result = file_put_contents( $url, $binary_data);
				if (!$result) die("Could not save image!  Check file permissions.");
				else return $url;
		
		
	}
}