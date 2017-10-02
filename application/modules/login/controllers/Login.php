<?php
/**
*
*
* Pizza Hut Delivery Controller
*
*
**/
?>
 
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MX_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','form','html'));
        $this->load->library('session');
        $this->load->model('user_m');
    }

	public function index()
	{	
		if ($this->session->userdata('logged_in')!=true){
				$data['content'] = 'login';
				$data['navbar'] = null;
				$data['sidebar'] = null;
				$this->load->view('template', $data); 
				$this->cekdb();	
			}
		else redirect ('admin',refresh);
			
	}
	
	public function cekdb(){
		$data=$this->user_m->listcabang();
		if (count ($data)==0){
			redirect ('installer',refresh);
		}
		if (count ($data)!=0){
			foreach ($data as $row){
				if ($row->nama_cabang==null && $row->alamat_clinic==null){
					redirect ('installer/finish',refresh);
				}	
			}
		}
	}

	function validate()
    {
		$username   = $this->input->post('username');
        $password   = md5($this->input->post('password'));
        
        $results = $this->user_m->login($username, $password);
		
        if($results != null)
        {	
			
			foreach ($results as $result){
				$sql="select nama_clinic, alamat_clinic from clinic_cabang";
				$query = $this->db->query($sql);
				$cabang= $query->row_array();
				
				$sql="select foto from karyawan where id_karyawan='".$result->id_karyawan."'";
				$query = $this->db->query($sql);
				$karyawan =  $query->row_array();
					
				$sessions   = array(
								'nama_clinic'		=> $cabang['nama_clinic'],
								'alamat_clinic'		=> $cabang['alamat_clinic'],
								'user_id'    	=> $result->id_user,
								'username'   	=> $result->username,
								'role'      	=> $result->peran,
								'idcabang'      => '0',
								'foto'  		=> $karyawan['foto'],
								'logged_in'  	=> TRUE
							);
				$this->session->set_userdata($sessions);
			};
               
            //print_r($this->session->userdata());
            redirect('admin',refresh);
        }
        else
        {
            redirect('/index.php'.$this->session->set_flashdata('message', 'Username/password salah'), refresh);
        }     
    }

    function is_logged_in()
    {	
        $logged_in = $this->session->userdata('logged_in');
        if(!isset($logged_in) || $logged_in != true)
        {	
            $link = base_url();
            echo "You don\'t have permission to access this page. <a href=$link>Login</a>";    
            die();      
            //$this->load->view('login_form');
        }
		
		$this->cekdb();
    }   
    
	function closing(){
		$this->load->module('kasir');
		$data['harian'] = $this->kasir_m->listantrian();
		$data['type']=1;
		$data['from']=date("d-m-Y");
		$data['till']=date("d-m-Y");
		$this->load->module('keuangan');
		$data['laporan'] = $this->keuangan_m->statistik($data);
		$data['cabang'] = $this->user_m->listcabang();
		$this->load->view('closing',$data);
		
	}
	
    function logout()
	{
		
		
		
        $items = array('user_id','username','role','logged_in');
		$this->session->unset_userdata($items);
		
        redirect('');
	}
}
