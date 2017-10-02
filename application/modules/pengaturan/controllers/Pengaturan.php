<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Pengaturan extends MX_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','form','html'));
        $this->load->library('session');
		// $this->load->library('Uuid');
        $this->load->module('login');
		$this->load->model('user_m');
		$this->load->model('karyawan_m');
        $this->login->is_logged_in();
    }
	
	public function getAccount()
    {
      $tindakan = $this->user_m->get(null,null,null);
      foreach ($tindakan->result() as $row)
      {
        $data[] = array(
                        'id'    => $row->id_tindakan,
                        'nama'  => $row->nama,
                        'keterangan' => $row->keterangan,
                        'biaya'  => $row->biaya,
                        'edited'=> false
                    );
      }

      $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }
	
	public function simpanTindakan(){
		$where = null;

        $post_data = json_decode(file_get_contents('php://input'));

        $data = array(
				
                'nama'  => $post_data->nama,
                'keterangan' => $post_data->keterangan,
                'biaya'  => $post_data->biaya
            );
		
		// jika update data
        if($post_data->id != null)
        {
            $where = array('id_tindakan' => $post_data->id);
        }

        $query = $this->tindakan_m->save($data, $where);
	}
	
	
	public function hapusTindakan()
	{
		$post_data = json_decode(file_get_contents('php://input'));
		
		$query = $this->tindakan_m->delTindakan($post_data->id);

		if($query==true)
		{
			return 'sukses';
		}else
			return 'gagal';
	}
	
}