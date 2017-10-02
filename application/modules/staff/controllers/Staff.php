<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Staff extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','form','html'));
        $this->load->library('session');
		$this->load->library('Uuid');
        $this->load->module('login');
        $this->load->module('sendserver');
		$this->load->model('karyawan_m');
        $this->login->is_logged_in();
    }
 
    public function index()
    {
		// echo $this->db->database;
    	$data['content'] = 'karyawan';
        $data['navbar']  = 'navbar';
        $data['sidebar'] = 'sidebar';
		$data['list']=$this->karyawan_m->listkaryawan();
		$this->load->view('template', $data);
    }
	
	public function privilege(){
		$data['content'] = 'privilege';
        $data['navbar']  = 'navbar';
        $data['sidebar'] = 'sidebar';
		$data['list']=$this->karyawan_m->getPrivilege();
		$this->load->view('template', $data);
	}

	public function getSetting()
  	{

  	  	$post_data = json_decode(file_get_contents('php://input'));

      	$where = array(
      			'id_karyawan' => $post_data->id
      		);

      	$user = $this->karyawan_m->get('user', $where, null, null);

	    if($user->num_rows()==0)
		{
	        
	        $data = null;

	    }
	    else
	    {
		  	$row = $user->row();
		  	$data = array(
							'id_user'    => $row->id_user,
							'username'   => $row->username,
							'password' 	 => $row->password,
							'edited'	 => false
						);
		}

      	$this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
  	}

    public function getKaryawan()
    {
      $karyawan = $this->karyawan_m->listkaryawan();
      foreach ($karyawan as $row)
      {
		$profesi = $this->getProfesi($row->id_profesi);
        $data[] = array(
                        'id'    => $row->id_karyawan,
                        'nama'  => $row->nama,
                        'alamat' => $row->alamat,
                        'tempat_lahir'  => $row->tempat_lahir,
                        'tgl_lahir' => $row->tgl_lahir,
                        'telepon' => $row->telepon,
                        'jenis_kelamin' => $row->jenis_kelamin,
                        'profesi' => $profesi,
                        'SIP' => $row->SIP,
                        'email' => $row->email,
                        'foto'  => $row->foto,
						'privilege' => $row->privilege,
                        'edited'=> false
                    );
      }

      $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }
	
	public function getProfesi($id){
		$profesi = $this->karyawan_m->getProfesi($id);
		$ret='';
		foreach ($profesi as $row){
			$ret = $row->nama;
		}
		return $ret;
	}

	public function getIdProfesi(){

		$post_data = json_decode(file_get_contents('php://input'));

		$where = array(
					'nama' => $post_data->nama
				);
		
		$query = $this->karyawan_m->get('profesi', $where, null, null);

		$row = $query->row();
		$idProfesi = $row->id_profesi;

		echo json_encode($idProfesi);
	}

	public function saveSetting(){

		$post_data = json_decode(file_get_contents('php://input'));

		$data = array(

					'id_karyawan' => $post_data->id_karyawan,

					'password' => md5($post_data->password),

					'peran' => $post_data->peran,

					'username' => $post_data->username

				);

		$where = array(

					'id_karyawan' => $post_data->id_karyawan
					
				);

		$lookUp = $this->karyawan_m->get('user', $where, null, null);

		if( $lookUp->num_rows() == 0)
		{
			$query = $this->karyawan_m->saveCredentials(null,$data);

			$ret = array(

					'message' => true

				);

			echo json_encode($ret);
		}
		else
		{
			$query = $this->karyawan_m->saveCredentials($where,$data);

			$ret = array(

					'message' => true

				);

			echo json_encode($ret);
		}
		
	}
	
	public function listProfesi(){
      $profesi = $this->karyawan_m->listprofesi();
      foreach ($profesi as $row)
      {
        $data[] = array(
                        'id'    => $row->id_profesi,
                        'nama'  => $row->nama
                    );
      }

      $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }
	
	public function addKaryawan()
    {
        $url = $this->photoupload();
		if($this->input->post('email')==''||$this->input->post('email')==null) {
			$email = '';
		}else{
			$email = $this->input->post('email');
		} 
		$data = array(	  'id_karyawan' => $this->uuid->v4(),
						  'nama'  => $this->input->post('nama'),
						  'alamat' => $this->input->post('alamat'),
						  'tempat_lahir'  => $this->input->post('tempat_lahir'),
						  'tgl_lahir' => $this->input->post('tgl_lahir'),
						  'telepon' => $this->input->post('telepon'),
						  'jenis_kelamin' => $this->input->post('jenis_kelamin'),
						  'id_profesi' => $this->input->post('profesi'),
						  'SIP' => $this->input->post('SIP'),
						  'email' => $email,
						  'privilege' => $this->input->post('privilege'),
						  'foto'  => $url
						); 

		$query =  $this->karyawan_m->save($data, null);

		if( $query == true )
		{
			$message = $this->session->set_flashdata('message', 'berhasil menyimpan');
		}
		else
		{
			$message = $this->session->set_flashdata('message', 'Maaf tidak berhasil menyimpan data');
		}
        
    }
	
	public function updateKaryawan(){

      $url = $this->photoupload();

      $data = array( 
                      'nama'  => $this->input->post('nama'),
                      'alamat' => $this->input->post('alamat'),
                      'tempat_lahir'  => $this->input->post('tempat_lahir'),
                      'tgl_lahir' => $this->input->post('tgl_lahir'),
                      'telepon' => $this->input->post('telepon'),
                      'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                      'id_profesi' => $this->input->post('id_profesi'),
                      'SIP' => $this->input->post('SIP'),
                      'email' => $this->input->post('email'),
					  'privilege' => $this->input->post('privilege'),
                      'foto'  => $url
                    ); 

      $where = array('id_karyawan' => $this->input->post('id'));
      $query =  $this->karyawan_m->save($data, $where);

      if( $query == true )
      {
          $message = $this->session->set_flashdata('message', 'berhasil menyimpan');
      }
      else
      {
          $message = $this->session->set_flashdata('message', 'Maaf tidak berhasil menyimpan data');
      }

    }
	
	public function hapusKaryawan()
	{
		$post_data = json_decode(file_get_contents('php://input'));
		
		$query = $this->karyawan_m->delKaryawan($post_data->id);

		if($query==true)
		{
			return 'sukses';
		}else
			return 'gagal';
	}	
	
	private function photoupload(){
		$type = explode('.', $_FILES["foto"]["name"]);
		$type = $type[count($type)-1];
		$url = "assets/foto/".uniqid(rand()).'.'.$type;
		if(is_uploaded_file($_FILES["foto"]["tmp_name"])){
				if(move_uploaded_file($_FILES["foto"]["tmp_name"], $url)){
					return $url;
				}
			}
	}
	
}