<?php
/**
*
*
* Obat
*
**/
?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Installer extends MX_Controller {

    public function __construct() {
        parent::__construct();
		$this->load->library('sending');
		$this->load->library('session');
		$this->load->model('installer_m');
		$this->load->module('sendserver');
    }

    public function index() {	
		
		if (sizeof($this->installer_m->cek())!==0){
			redirect('/',refresh);
		}
        $data['content'] = 'installer';
		$data['form'] = 'form';
		$this->load->view('template', $data); 
    }
	
	public function finish(){
			$det=$this->installer_m->cek();
			foreach ($det as $row){
				if ($row->nama_clinic==null || $row->alamat_clinic==null){
					$data['nama']=$row->nama_clinic;
					$data['alamat']=$row->alamat_clinic;
					$data['form']='clinicdata';
				}
				else  {$data['finish']=true;}
			}
			$data['content'] = 'installer';
			$this->load->view('template', $data); 
	}
	
	public function dataclinic(){
			if ($_POST['namaclinic']!=null && $_POST['alamatclinic']!=null ){
					$this->installer_m->insdataclinic();
					echo '<script>window.location.replace(\''.base_url().'\installer/finish\');</script>';
			}
			else {
				$this->load->view('clinicdata');	
				echo' <script>
						toastr.error(\'Maaf Data yang dimasukkan salah, mohon masukkan kembali data yang benar\');
					  </script>
					  ';
			}
	}
	
	
	public function installget(){
		$data=$this->sending->install($_POST);
		$this->session->set_userdata($_POST);
		if ($data!='0'){
			$data=json_decode($data);
			foreach ($data->listtable as $q){
				foreach ($data->$q as $row){
						$this->installer_m->datainstall($q,$row);
				}
			}
			echo '
			<script>window.location.replace(\''.base_url().'\installer/finish\');</script>';
		}
	else { 
		$this->load->view('form');
		echo 	' <script>
					toastr.error(\'Maaf Data yang dimasukkan salah, mohon masukkan kembali data yang benar\');
				  </script>
				  ';
			
	
	}
		
	}

   
}    