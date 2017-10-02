

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tindakan_m extends CI_Model 
{
	 protected $table_name = 'tindakan';
	
    public function __construct()
    {
            parent::__construct();
            //Load Dependencies
    }
	
	function get($where, $limit, $offset) 
    {
        // Select all clause
        if ($where == NULL) 
        {
            return $this->db->get($this->table_name, $limit, $offset);
        }

        // Select + where clause
        else 
        {            
            return $this->db->get_where($this->table_name, $where, $limit, $offset);            
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
			$this->sendserver_m->singleevent($this->db->last_query());
        }

        // Update user
        else
        {
            $this->db->where($where);
            $this->db->update($this->table_name, $data);
			$this->sendserver_m->singleevent($this->db->last_query());
        }

    }
	
	function listTindakan(){
		$sql="select * from tindakan ";
		if ($_POST['id']!=null) $sql .= "where id_tindakan=".$_POST['id'];
		$query = $this->db->query($sql);
		return $query->result();
	}	
	
    function addTindakan(){
		$sql= "insert into tindakan values ('','".$_POST['nama']."',
													  '".$_POST['detail']."')";
		$query = $this->db->query($sql);
		$this->sendserver_m->singleevent($this->db->last_query());
    }
	
	function editTindakan(){
		$sql="update tindakan set tindakan='".$_POST['tindakan']."', detail_tindakan='".$_POST['detail_tindakan']."' where id_tindakan=".$_POST['id_tindakan'];  
		$query = $this->db->query($sql); 
		$this->sendserver_m->singleevent($this->db->last_query());
	}
	
	function delTindakan($id_tindakan){
		$sql="delete from tindakan where id_tindakan='".$id_tindakan."'";
		$query = $this->db->query($sql);
		$this->sendserver_m->singleevent($this->db->last_query());
	}

}