<?php

/**
 * @author Nicky
 * @copyright 2015
 */

?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_m extends CI_Model 
{

    //protected $collection_name = 'user';

   
	
	
	
	function listcabang(){
		$sql="select * from clinic_cabang";
		$query = $this->db->query($sql);
		return $query->result();
		}
		
	function listpasien(){
		$sql="select * from pasien";
		$query = $this->db->query($sql);
		return $query->result();
		}
	
    function login($username, $password)
    {		
			$sql="select * from user where username='".$username."' and password='".$password."'";
			$query = $this->db->query($sql);
			
			if($query->num_rows()==1){ 
				return $query->result();}
			else{ 
				return null; }
	}
         
            
   

    function get_data_by_id($user_id)
    {
            $result = $this->get(array("user_id"=>$user_id));
            return $result->row() ; 
    }

    // Menampilkan semua user atau user tertentu
    function get($where) 
    {
            // Select all clause
            if ($where == NULL) 
            {
                    return $this->db->get($this->table_name);
            }

            // Select + where clause
            else 
            {            
                    return $this->db->get_where($this->table_name, $where);            
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
            }

            // Update user
            else
            {
        $this->db->where($where);
                    $this->db->update($this->table_name, $data);
            }
    }

    // Menghapus user
    function delete($id) 
    {
            $filter = $this->primary_filter;
            $id = $filter($id);

            if (!$id)
            {
                    return FALSE;
            }

            $this->db->where($this->primary_key, $id);
            $this->db->delete($this->table_name);
    }

}
/* End of file user_m.php */
/* Location: ./application/models/user_m.php */