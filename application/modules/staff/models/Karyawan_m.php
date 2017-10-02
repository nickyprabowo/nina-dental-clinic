

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Karyawan_m extends CI_Model 
{
    public function __construct()
    {
            parent::__construct();
            //Load Dependencies
    }
	
	protected $table_name = 'karyawan';

	function get($table, $where, $limit, $offset) 
    {
        // Select all clause
        if ($where == NULL) 
        {
            return $this->db->get($table, $limit, $offset);
        }

        // Select + where clause
        else 
        {            
            return $this->db->get_where($table, $where, $limit, $offset);            
        }
    }
		
    function listkaryawan($page){
		$sql="select k.*, p.nama as nama_profesi, p.id_profesi from karyawan k
			  inner join profesi p on p.id_profesi=k.id_profesi ";
		if ($_POST['id']!=null) $sql .= "where id_karyawan='".$_POST['id']."'";
		$query = $this->db->query($sql);
		if($query->num_rows()==0){ 
			return 0;
		}else{
			return $query->result();
		}
	}
	
	function getProfesi($id){
		$sql="select * from profesi where id_profesi='".$id."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function listprofesi(){
		$sql="select * from profesi";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function saveCredentials($where,$data)
	{
		// Insert user
        if ($where == NULL)
        {
            $this->db->set($data);
            $this->db->insert('user');
			$this->sendserver_m->savesql($this->db->last_query()); 
        }

        // Update user
        else
        {
            $this->db->where($where);
            $this->db->update('user', $data);
			$this->sendserver_m->savesql($this->db->last_query()); 
        }
	}

	// Menambah atau mengedit user
    function save($data, $where)
    {
        // Insert user
        if ($where == NULL)
        {
            $this->db->set($data);
            $this->db->insert($this->table_name);
			$this->sendserver_m->savesql($this->db->last_query()); 
        }

        // Update user
        else
        {
            $this->db->where($where);
            $this->db->update($this->table_name, $data);
			$this->sendserver_m->savesql($this->db->last_query()); 
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
	}
	
	function delkaryawan($id_karyawan){
		$sql="delete from karyawan where id_karyawan='".$id_karyawan."'";
		$query = $this->db->query($sql);
		$this->sendserver_m->savesql($this->db->last_query()); 
	}


}