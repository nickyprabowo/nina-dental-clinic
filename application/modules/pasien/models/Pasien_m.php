

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pasien_m extends CI_Model 
{
    public function __construct()
    {
            parent::__construct();
            //Load Dependencies
    }
	
	function listPas(){
		$sql="select * from pasien ";
		if ($_POST['id_pasien']!=null) $sql .= "where id_pasien='".$_POST['id_pasien']."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function listcabang(){
		$sql="select * from clinic_cabang";
		$query = $this->db->query($sql);
		return $query->result();
		}
	
	
    function addPas()
    {	$id=$this->uuid->v4();
		$_POST['tgllahir']=date('Y-m-d',strtotime($_POST['tgllahir']));
		$sql= "insert into pasien values ('".$id."','".$_POST['nama']."',
										     '".$_POST['alamat']."',
										     '".$_POST['pekerjaan']."',
											 '".$_POST['tgllahir']."',
											 '".$_POST['jeniskelamin']."',
											 '".$_POST['email']."',
											 '".$_POST['foto']."',
											 '".$_POST['cabang']."')";
		$this->sendserver_m->CRUD($sql);
    }
	
	function editPas(){
		$_POST['tglLahir']=date('Y-m-d', strtotime($_POST['tglLahir']));
		$sql="update pasien set nama='".$_POST['nama']."',
								alamat='".$_POST['alamat']."',
								pekerjaan='".$_POST['pekerjaan']."',
								tgllahir='".$_POST['tglLahir']."',
								jenis_kelamin='".$_POST['jeniskelamin']."',
								email='".$_POST['email']."'";
		if ($_POST['foto']!=null) $sql .=", foto='".$_POST['foto']."'";
		$sql .=" where id_pasien='".$_POST['idPas']."'";
		$this->sendserver_m->CRUD($sql);			  
	}
	
	function delPas(){
		$sql="delete from pasien where id_pasien='".$_POST['idPas']."'";
		$this->sendserver_m->CRUD($sql);
	}

}