<?php
/**
*
*
* Obat
*
**/
?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Obat extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','form','html'));
        $this->load->library('session');
        $this->load->library('Uuid');
        $this->load->module('login');
        $this->load->module('sendserver');
        $this->login->is_logged_in();
		$this->load->model('obat_m');
		$this->load->model('user_m');
    }

    public function index()
    {
        $data['content'] = 'obat';
        $data['navbar'] = 'navbar';
        $data['sidebar'] = 'sidebar';
        $this->load->view('template', $data);    
    }

    public function laporan()
    {
        $data['content'] = 'laporan_obat';
        $data['navbar'] = 'navbar';
        $data['sidebar'] = 'sidebar';
        $this->load->view('template', $data); 
    }
	
	public function getObat()
    {
        $post_data =  json_decode(file_get_contents('php://input'));

        if($post_data)
        {
            $where = array(
                    'id' => $post_data->id
                );
        }
        else
        {
            $where = null;
        }

        $query = $this->obat_m->get($where,null,null);

        if($query->num_rows()==0)
        {
            $data = null;
        }
        else
        {
            foreach ($query->result() as $row) {
                $data[] = array(
                            'id'    => $row->id_obat,
                            'nama'  => $row->nama,
                            'harga' => $row->harga,
                            'stok'  => $row->stok,
                            'edited'=> false
                        );
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    public function selectObat()
    {
        $post_data =  json_decode(file_get_contents('php://input'));

        if($post_data)
        {
            $where = array(
                    'nama' => $post_data->nama,
                    'harga'=> $post_data->harga,
                    'stok' => $post_data->stok
                );
        }
        else
        {
            $where = null;
        }

        $query = $this->obat_m->get($where,null,null);

        if($query->num_rows()==0)
        {
            $data = null;
        }
        else
        {
            $row = $query->row();
            $data['id'] = $row->id_obat;
            $data['nama'] = $row->nama;
            $data['stok'] = $row->stok;
            $data['harga'] = $row->harga;
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    public function getLaporanObat()
    {
        $query = $this->obat_m->getLaporanObat(null,null,null);
        if($query->num_rows()==0){
            $data = $query->num_rows();
        }
        else{
            foreach ($query->result() as $row) {
                $data[] = array(
                            'id'    => $row->id_laporan_obat,
                            'id_obat' => $row->id_obat,
                            'nama'  => $row->nama,
                            'tanggal' => $row->tanggal,
                            'stok'  => $row->stok,
                            'prevStok' => $row->prevStok,
                            'prevHarga' => $row->prevHarga,
                            'harga' => $row->harga,
                            'keterangan' => $row->keterangan,
                            'status'=> $row->status
                        );
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }


    public function saveLaporanObat()
    {
        $where = null;

        $post_data = json_decode(file_get_contents('php://input'));
        $data = array(
				'id_laporan_obat' => $this->uuid->v4(),
                'id_obat' => $post_data->id,
                'nama'  => $post_data->nama,
                'stok'  => $post_data->stok,
                'status' => $post_data->status,
                'tanggal' => Date('Y-m-d H:m:s'),
                'prevStok' => $post_data->prevStok,
                'prevHarga' => $post_data->prevHarga,
                'harga' => $post_data->harga,
                'keterangan' => $post_data->keterangan
            );

        if( ($post_data->status) == 'edit' && ($post_data->prevHarga != $post_data->harga) ){
            $data['keterangan'] = $post_data->keterangan.' dari Rp '.$post_data->prevHarga.' menjadi Rp '.$post_data->harga;
        }else{
            $data['keterangan'] = $post_data->keterangan;
        }

        $query = $this->obat_m->saveLaporanObat($data, $where);

    }

    public function simpanObat()
    {
        $where = null;

        $post_data = json_decode(file_get_contents('php://input'));

        $data = array(
				'id_obat' => $this->uuid->v4(),
                'nama'  => $post_data->nama,
                'harga' => $post_data->harga,
                'stok'  => $post_data->stok
            );

        // jika update data
        if($post_data->edited == true)
        {
            $where = array('id_obat' => $post_data->id);
        }
		
		 $query = $this->obat_m->save($data, $where);
    }
		
	public function hapusObat()
    {
		$post_data = json_decode(file_get_contents('php://input'));
		
        $query = $this->obat_m->delete($post_data->id);
		
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

        $query = $this->obat_m->getFilter($where);

        //print_r($query);

        if($query->num_rows() != 0)
        {
            foreach ($query->result() as $row) {
                $data[] = array(
                            'id'    => $row->id_laporan_obat,
                            'id_obat' => $row->id_obat,
                            'nama'  => $row->nama,
                            'tanggal' => $row->tanggal,
                            'stok'  => $row->stok,
                            'prevStok' => $row->prevStok,
                            'prevHarga' => $row->prevHarga,
                            'harga' => $row->harga,
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
        $where['result'] = $this->obat_m->getFilter($where)->result();
        $where['cabang'] = $this->user_m->listcabang();
		$this->load->view('print_laporan_obat',$where);
	}

}    