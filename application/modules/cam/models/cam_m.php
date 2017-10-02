

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tindakan_m extends CI_Model 
{
    public function __construct()
    {
            parent::__construct();
            //Load Dependencies
    }
	
	function listTindakan(){
		$sql="select * from tindakan ";
		if ($_POST['id']!=null) $sql .= "where id_tindakan=".$_POST['id'];
		$query = $this->db->query($sql);
		return $query->result();
	}	
	
    function addTindakan(){
		$sql= "insert into tindakan values ('','".$_POST['nama']."',,'".$_POST['biaya']."')";
		$query = $this->db->query($sql);
    }
	
	function editTindakan(){
		$sql="update tindakan set tindakan='".$_POST['tindakan']."', detail_tindakan='".$_POST['detail_tindakan']."' where id_tindakan=".$_POST['id_tindakan'];  
		$query = $this->db->query($sql); 
	}
	
	function delTindakan(){
		$sql="delete from tindakan where id_tindakan=".$_POST['id_tindakan'];
		$query = $this->db->query($sql);
	}

}