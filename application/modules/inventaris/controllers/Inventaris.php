<?php
/**
*
* Inventaris
*
**/
?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inventaris extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','form','html'));
        $this->load->library('session');
		$this->load->library('Uuid');
        $this->load->module('login');
        $this->load->module('sendserver');
        $this->login->is_logged_in();
		$this->load->model('inventaris_m');
		$this->load->model('user_m');
    }

    public function index()
    {
        $data['content'] = 'inventaris';
        $data['navbar'] = 'navbar';
        $data['sidebar'] = 'sidebar';
        $this->load->view('template', $data);    
    }

    public function laporan()
    {
        $data['content'] = 'laporan_inventaris';
        $data['navbar'] = 'navbar';
        $data['sidebar'] = 'sidebar';
        $this->load->view('template', $data); 
    }
	
	public function getInventaris()
    {
        $post_data =  json_decode(file_get_contents('php://input'));

        if($post_data)
        {
            $where = array(
                    'nama' => $post_data->nama,
                    'stok' => $post_data->stok
                );
        }
        else
        {
            $where = null;
        }

        $query = $this->inventaris_m->get($where,null,null);

        if($query->num_rows()==0)
        {
            $data = null;
        }
        else
        {
            foreach ($query->result() as $row) {
                $data[] = array(
                            'id'    => $row->id_inventaris,
                            'nama'  => $row->nama,
                            'stok'  => $row->stok,
                            'keterangan' => $row->keterangan,
                            'edited'=> false
                        );
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    public function simpanInventaris()
    {
        $where = null;

        $post_data = json_decode(file_get_contents('php://input'));

        $data = array(
				'id_inventaris' => $this->uuid->v4(),
                'nama'  => $post_data->nama,
                'keterangan' => $post_data->keterangan,
                'stok'  => $post_data->stok
            );

        // jika update data
        if($post_data->edited == true)
        {
            $where = array('id_inventaris' => $post_data->id);
        }
        
         $query = $this->inventaris_m->save($data, $where);
    }

    public function selectInventaris()
    {
        $post_data =  json_decode(file_get_contents('php://input'));

        if($post_data)
        {
            $where = array(
                    'nama' => $post_data->nama,
                    'stok' => $post_data->stok
                );
        }
        else
        {
            $where = null;
        }

        $query = $this->inventaris_m->get($where,null,null);

        if($query->num_rows()==0)
        {
            $data = null;
        }
        else
        {
            $row = $query->row();
            $data['id'] = $row->id_inventaris;
            $data['nama'] = $row->nama;
            $data['stok'] = $row->stok;
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    public function getLaporanInventaris()
    {
        $query = $this->inventaris_m->getLaporanInventaris(null,null,null);
        if($query->num_rows()==0){
            $data = $query->num_rows();
        }
        else{
            foreach ($query->result() as $row) {
                $data[] = array(
                            'id'    => $row->id_laporan_inventaris,
                            'id_inventaris' => $row->id_inventaris,
                            'nama'  => $row->nama,
                            'tanggal' => $row->tanggal,
                            'stok'  => $row->stok,
                            'status'=> $row->status,
                            'keterangan' => $row->keterangan,
                            'prevStok' => $row->prevStok
                        );
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }


    public function saveLaporanInventaris()
    {
        $where = null;

        $post_data = json_decode(file_get_contents('php://input'));
        $data = array(
				'id_laporan_inventaris' => $this->uuid->v4(),
                'id_inventaris' => $post_data->id,
                'nama'  => $post_data->nama,
                'stok'  => $post_data->stok,
                'status'=> $post_data->status,
                'tanggal' => Date('Y-m-d H:m:s'),
                'keterangan' => $post_data->sebab,
                'prevStok' => $post_data->prevStok
            );

        $query = $this->inventaris_m->saveLaporanInventaris($data, $where);

    }
	
	public function hapusInventaris()
    {
		$post_data = json_decode(file_get_contents('php://input'));
		
        $query = $this->inventaris_m->delete($post_data->id);
		
        if($query==true)
        {
            return 'sukses';
        }else
            return 'gagal';
    }

    function getFilterLaporan()
    {
        $post_data = json_decode(file_get_contents('php://input'));

        $where = array(
                'start' => $post_data->start,
                'end'   => $post_data->end
            );

        $query = $this->inventaris_m->getFilter($where);

        //print_r($query);

        if($query->num_rows() != 0)
        {
            foreach ($query->result() as $row) {
                $data[] = array(
                            'id'    => $row->id_laporan_inventaris,
                            'id_obat' => $row->id_inventaris,
                            'nama'  => $row->nama,
                            'tanggal' => $row->tanggal,
                            'stok'  => $row->stok,
                            'prevStok' => $row->prevStok,
                            'prevHarga' => $row->prevHarga,
                            'keterangan' => $row->keterangan,
                            'status'=> $row->status,
                            'message' => 'data ditemukan'
                        );
            }
        }
        else
        {
            $data = array(
                    'message' => 'data tidak ditemukan'
                );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }
	
	public function printlaporan($a){
		$data=explode('%20-%20',$a);

		$where = array(
                'start' => $data[0],
                'end'   => $data[1]
            );
		//print_r($where);
        $where['result'] = $this->inventaris_m->getFilter($where)->result();
        $where['cabang'] = $this->user_m->listcabang();
		$this->load->view('print_laporan_inventaris',$where);
	}
}    