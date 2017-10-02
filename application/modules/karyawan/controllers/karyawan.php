<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Karyawan extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','form','html'));
        $this->load->library('session');
        $this->load->module('login');
		$this->load->model('karyawan_m');
        $this->login->is_logged_in();
    }
 
    public function index()
    {
    	$data['content'] = 'karyawan';
        $data['navbar']  = 'navbar';
        $data['sidebar'] = 'sidebar';
		$data['list']=$this->karyawan_m->listkaryawan();
		$this->load->view('template', $data);
    }

   /* public function section($page)
    {
        if(isset($page))
        {
            $data['content'] = $page;
            $data['navbar'] = 'navbar';
            $data['sidebar'] = 'sidebar';
			$data['list']=$this->karyawan_m->listkaryawan($page);
            $this->load->view('template', $data);
        }
        else
        {
            $data['content'] = 'blank_page';
            $data['navbar'] = 'navbar';
            $data['sidebar'] = 'sidebar';
            $this->load->view('template', $data);
        }
    }*/
	
	public function addkaryawan()
    {
        	if ($_POST['submit']==null){
				$data['profesi']=$this->karyawan_m->listprofesi();
				$data['content'] = 'addkaryawan_v';
				$data['navbar'] = 'navbar';
				$data['sidebar'] = 'sidebar';
				$this->load->view('template', $data);
			}
			else {
				if ($_FILES["foto"]["name"]!=null) $_POST['foto']=$this->photoupload();
				$this->karyawan_m->addkaryawan();
				redirect ('karyawan', refresh);
			}
        
        
    }
	public function editkaryawan(){
		if ($_POST['hapus']==false) {
			$this->karyawan_m->editkaryawan();
			}
		else { 
			$this->karyawan_m->delkaryawan();
			}
		echo ' <script>$("#example2").DataTable();</script>
			   <table id="example2" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Profesi</th>
                    <th>SIP</th>
                    <th>Email</th>
                  
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>';
						$i=0;
						foreach ($this->karyawan_m->listkaryawan() as $row){
							echo '<tr>
									<td>'.$row->nama.'</td>
									<td>'.$row->alamat.'</td>
									<td>'.$row->telepon.'</td>
									<td>'.$row->nama_profesi.'</td>
									<td>'.$row->SIP.'</td>
									<td>'.$row->email.'</td>
									
									<td class="text-center">
										<button type="button" data-toggle="modal"  data-target="#modal" onclick="det('.$row->id_karyawan.');" class="btn btn-success"><i class="fa fa-fw fa-edit"></i> Ubah</button>
										<button type="button" onclick="delkary('.$row->id_karyawan.');" class="btn btn-danger"><i class="fa fa-fw fa-remove"></i> Hapus</button>
									</td>
								  </tr>	';
								}
							
			echo '</tbody>
              </table>';
	}
	
	
	
	public function detKaryawan(){
		$list=$this->karyawan_m->listkaryawan();
		$profesi=$this->karyawan_m->listprofesi();
		$row->tgl_lahir=date('d-m-Y',strtotime($row->tgl_lahir));
		foreach ($list as $row){
			echo '<form class="form-horizontal" action="" enctype="multipart/form-data" method="post">
                <div class="box-body">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nama" value="'.$row->nama.'" id="nama" required>
                      <input type="hidden" class="form-control" name="id_karyawan" value="'.$row->id_karyawan.'" id="id_karyawan" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Alamat</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="alamat" value="'.$row->alamat.'"id="alamat" required>
                    </div>
                  </div>
				  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Telepon</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="telepon" value="'.$row->telepon.'" id="telepon" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Tgl lahir</label>
                    <div class="col-sm-10 date">
                        <input type="text" class="form-control" name="tgl_lahir" value="'.$row->tgl_lahir.'" id="tgl_lahir" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="jeniskelamin" id="jeniskelamin">
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">SIP</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="SIP" value="'.$row->SIP.'" id="SIP" required>
                    </div>
                  </div>
				  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Profesi</label>
                    <div class="col-sm-10">
					   <select class="form-control" name="profesi" id="profesi">';
                foreach($profesi as $q){
					echo ' <option value="'.$q->id_profesi.'">'.$q->nama.'</option>'; }
					
                      echo '</select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" name="email" value="'.$row->email.'" id="email" required>
                    </div>
                  </div>
                </div><!-- /.box-body -->
				 <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Foto</label>
                    <div class="col-sm-10">
                      <input type="file" name="foto" id="foto">
                    </div>
                  </div>';
		}
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