<?php

/**
 * @author Nicky
 * @copyright 2015
 */

?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Diagnosa_m extends CI_Model 
{
	protected $table_name = 'diagnosa';
   
    public function __construct()
    {
            parent::__construct();
            //Load Dependencies
    }

	public function getListDiagnosa(){
		$sql="select * from diagnosa";
			if ($_POST['id']!=null) $sql .= " where id_diagnosa='".$_POST['id']."'";
		$query = $this->db->query($sql);
		return $query;
	}
	
	// Menambah atau mengedit diagnosa
    function save($data, $where)
    {
        // Insert daignosa
        if ($where == NULL)
        {
            $this->db->set($data);
            $this->db->insert($this->table_name);
			$this->sendserver_m->singleevent($this->db->last_query());
        }

        // Update diagnosa
        else
        {
            $this->db->where($where);
            $this->db->update($this->table_name, $data);
			$this->sendserver_m->singleevent($this->db->last_query());
        }

        return true;
    }
	
	public function addDiagnosa(){
		$sql="insert into diagnosa values('','".$_POST['diagnosa']."','".$_POST['detail']."')";
		$query = $this->db->query($sql);
		$this->sendserver_m->singleevent($this->db->last_query());
	}
	
	public function editDiagnosa(){
		$sql="update diagnosa set diagnosa='".$_POST['diagnosa']."', detail_diagnosa='".$_POST['detail_diagnosa']."' where id_diagnosa=".$_POST['id_diagnosa'];  
		$query = $this->db->query($sql);
		$this->sendserver_m->singleevent($this->db->last_query());
	}
	
	public function delDiagnosa($idDiagnosa){
		$sql="delete from diagnosa where id_diagnosa='".$idDiagnosa."'";  
		$query = $this->db->query($sql);
		$this->sendserver_m->singleevent($this->db->last_query());
	}
	
}

	
	
/* End of file user_m.php */
/* Location: ./application/models/user_m.php */