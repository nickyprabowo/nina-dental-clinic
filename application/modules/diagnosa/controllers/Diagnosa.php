<?php
/**
*
*
* Diagnosa
*
**/
?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Diagnosa extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','form','html'));
        $this->load->library('session');
		$this->load->library('Uuid');
        $this->load->module('login');
        $this->load->module('sendserver');
        $this->load->model('diagnosa_m');
        $this->login->is_logged_in();
    }

    public function index()
    {
        $data['content'] = 'diagnosa';
        $data['navbar'] = 'navbar';
        $data['sidebar'] = 'sidebar';
        $this->load->view('template', $data);    
    }
	
	public function getDiagnosa()
    {
        $query = $this->diagnosa_m->getListDiagnosa();
		if($query->num_rows()==0)
		{
			$data = $query->num_rows();
		}
		else{
			foreach ($query->result() as $row) {
				$data[] = array(
							'id'    => $row->id_diagnosa,
							'nama'  => $row->nama,
							'keterangan' => $row->keterangan,
							'edited'=> false
						);
			}
		}
	
		$this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }
	
	public function simpanDiagnosa(){
		
		$where = null;

        $post_data = json_decode(file_get_contents('php://input'));

        $data = array(
				'id_diagnosa' => $this->uuid->v4(),
                'nama'  => $post_data->nama,
                'keterangan' => $post_data->keterangan
            );

        // jika update data
        if($post_data->id != null)
        {
            $where = array('id_diagnosa' => $post_data->id);
        }

        $query = $this->diagnosa_m->save($data, $where);
			
	}
	
	public function delDiagnosa()
	{
		$post_data = json_decode(file_get_contents('php://input'));
		
		$query = $this->diagnosa_m->delDiagnosa($post_data->id);
		
        if($query==true)
        {
            return true;
        }else
            return false;
	}
	
	public function detDiagnosa(){
		$data=$this->diagnosa_m->getlistdiagnosa();
		foreach ($data as $row){
		echo '   <form class="form-horizontal" action="" method="post">
					<div class="box-body">
					  <div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label">Nama Diagnosa</label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="diagnosa" id="diagnosa" value="'.$row->nama.'" required>
						  <input type="hidden" class="form-control"  id="id_diagnosa" value="'.$row->id_diagnosa.'" required>
						</div>
					  </div>
					  <div class="form-group">
						<label for="inputPassword3" class="col-sm-2 control-label">Rincian Diagnosa</label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="detail" id="detail"  value="'.$row->keterangan.'" required>
							</div>
						</div>
					
					</div><!-- /.box-footer -->
				  </form>';	
			}
		}
	
	}
?>    