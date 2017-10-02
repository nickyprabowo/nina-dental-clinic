<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Tindakan extends MX_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','form','html'));
        $this->load->library('session');
		$this->load->library('Uuid');
        $this->load->module('login');
        $this->load->module('sendserver');
		$this->load->model('tindakan_m');
        $this->login->is_logged_in();
    }
 
    public function index()
    {
    	$data['content'] = 'tindakan';
        $data['navbar'] = 'navbar';
        $data['sidebar'] = 'sidebar';
		$data['list']=$this->tindakan_m->listTindakan();
		$this->load->view('template', $data);
    }
	
	public function getTindakan()
    {
      $tindakan = $this->tindakan_m->get(null,null,null);
	  if($tindakan->num_rows()==0){
            $data = $tindakan->num_rows();
        }
      else{
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
	  }

      $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }
	
	public function simpanTindakan(){
		$where = null;

        $post_data = json_decode(file_get_contents('php://input'));

        $data = array(
				'id_tindakan' => $this->uuid->v4(),
                'nama'  => $post_data->nama,
                'keterangan' => $post_data->keterangan,
                'biaya'  => $post_data->biaya
            );
		
		// jika update data
        if($post_data->id != null)
        {
            $where = array('id_tindakan' => $post_data->id);
            $data = array(
                'nama'  => $post_data->nama,
                'keterangan' => $post_data->keterangan,
                'biaya'  => $post_data->biaya
            );
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
	
	public function detTindakan(){
		$list=$this->tindakan_m->listTindakan();
		foreach ($list as $row){
			echo '<form class="form-horizontal" action="" method="post">
					<div class="box-body">
					  <div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label">Nama Tindakan</label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="tindakan" id="tindakan" value="'.$row->nama.'" required>
						  <input type="hidden" class="form-control" name="id_tindakan" id="id_tindakan" value="'.$row->id_tindakan.'" required>
						</div>
					  </div>
					  <div class="form-group">
						<label for="inputPassword3" class="col-sm-2 control-label">Rincian Tindakan</label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="detail" id="detail" value="'.$row->keterangan.'" required>
						</div>
					  </div>
					
					
					</div><!-- /.box-footer -->
				  </form>';
		}
	}
}