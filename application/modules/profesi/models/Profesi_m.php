

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profesi_m extends CI_Model 
{
    public function __construct()
    {
            parent::__construct();
            //Load Dependencies
    }
	
	protected $table = 'profesi';

	function get($where, $limit, $offset) 
    {
        // Select all clause
        if ($where == NULL) 
        {
            return $this->db->get( $this->table, $limit, $offset );
        }

        // Select + where clause
        else 
        {            
            return $this->db->get_where( $where, $limit, $offset );            
        }
    }

	// Menambah atau mengedit user
    function save($data, $where)
    {
        // Insert user
        if ($where == NULL)
        {
            $this->db->set($data);
            $this->db->insert($this->table);
			$this->sendserver_m->singleevent($this->db->last_query());
        }

        // Update user
        else
        {
            $this->db->where($where);
            $this->db->update($this->table, $data);
			$this->sendserver_m->singleevent($this->db->last_query());
        }

    }	
	
	function addkaryawan()
    {	
		$_POST['tgllahir']=date('Y-m-d',strtotime($_POST['tgllahir']));
		$sql= "insert into karyawan values ('','".$_POST['nama']."',
											 '".$_POST['alamat']."',
											 '".$_POST['tgllahir']."',
											 '".$_POST['telepon']."',
											 '".$_POST['jeniskelamin']."',
											 '".$_POST['profesi']."',
											 '".$_POST['SIP']."',
											 '".$_POST['email']."',
											 '".$_POST['foto']."'
											 '"/*.$_POST['cabang']*/."'
											 )";
				
		$query = $this->db->query($sql);
		$this->sendserver_m->singleevent($this->db->last_query());
    }
	
	function editkaryawan(){
		$sql="update karyawan set nama='".$_POST['nama']."',
								  alamat='".$_POST['alamat']."', 
								  tgl_lahir='".$_POST['tgl_lahir']."', 
								  telepon='".$_POST['telepon']."', 
								  jenis_kelamin='".$_POST['jeniskelamin']."', 
								  id_profesi='".$_POST['profesi']."', 
								  SIP='".$_POST['SIP']."', 
								  email='".$_POST['email']."'
			  where id_karyawan='".$_POST['id_karyawan']."'";
		$query = $this->db->query($sql);
		$this->sendserver_m->singleevent($this->db->last_query());
	}
	
	function delProfesi($id_profesi){
		$sql="delete from profesi where id_profesi='".$id_profesi."'";
		$query = $this->db->query($sql);
		$this->sendserver_m->singleevent($this->db->last_query());
	}

}