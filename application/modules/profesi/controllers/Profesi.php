<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Profesi extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','form','html'));
        $this->load->library('session');
        $this->load->library('Uuid');
        $this->load->module('login');
        $this->load->model('profesi_m');
		$this->load->module('sendserver');
        $this->login->is_logged_in();
    }
 
    public function index()
    {
    	$data['content'] = 'profesi';
        $data['navbar']  = 'navbar';
        $data['sidebar'] = 'sidebar';
		$this->load->view('template', $data);
    }
	
	public function listProfesi(){
      $profesi = $this->profesi_m->get(null, null, null);
      foreach ($profesi->result() as $row)
      {
        $data[] = array(
                        'id'    => $row->id_profesi,
                        'nama'  => $row->nama,
                        'edited'=> FALSE
                    );
      }

      $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

	public function simpanProfesi(){

		$where = null;

        $post_data = json_decode(file_get_contents('php://input'));

        $data = array(
				'id_profesi' => $this->uuid->v4(),
                'nama'  => $post_data->profesi
            );

        // jika update data
        if($post_data->id != null)
        {
            $where = array('id_profesi' => $post_data->id);
            $data = array(
        			'nama' => $post_data->nama
        		);
        }

        $query = $this->profesi_m->save($data, $where);
	}

	public function hapusProfesi()
	{
		$post_data = json_decode(file_get_contents('php://input'));
		
		$query = $this->profesi_m->delProfesi($post_data->id);

		if($query==true)
		{
			return 'sukses';
		}else
			return 'gagal';
	}
	
}