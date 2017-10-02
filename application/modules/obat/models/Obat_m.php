<?php

/**
 * @author Nicky
 * @copyright 2015
 */

?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Obat_m extends CI_Model 
{

    protected $table_name = 'obat';

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
	
	// Menambah atau mengedit obat
    function save($data, $where)
    {
        // Insert obat
        if ($where == NULL)
        {
            $this->db->set($data);
            $this->db->insert($this->table_name);
			$this->sendserver_m->singleevent($this->db->last_query());
        }

        // Update obat
        else
        {
            $this->db->where($where);
            $this->db->update($this->table_name, $data);
			
			$this->sendserver_m->singleevent($this->db->last_query());
        }

    }
	
	function getLaporanObat($where, $limit, $offset)
    {
        // Select all clause
        if ($where == NULL) 
        {
            return $this->db->get('laporan_obat', $limit, $offset);
        }

        // Select + where clause
        else 
        {            
            return $this->db->get_where('laporan_obat', $where, $limit, $offset);            
        }
    }

    function saveLaporanObat($data, $where)
    {
        // Insert user
        if ($where == NULL)
        {
            $this->db->set($data);
            $this->db->insert('laporan_obat');
			
			$this->sendserver_m->singleevent($this->db->last_query());
        }

        // Update user
        else
        {
            $this->db->where($where);
            $this->db->update('laporan_obat', $data);
			
			$this->sendserver_m->singleevent($this->db->last_query());
        }
    }
	
	function delete($idObat) 
    {
        if (!$idObat)
        {
            return FALSE;
        }
        
        $where = array('id_obat' => $idObat);

        $this->db->where($where);
        $this->db->delete($this->table_name);
		
		$this->sendserver_m->singleevent($this->db->last_query());
        return TRUE;
    }



	public function listobat(){
		$sql="select * from obat";
		$query = $this->db->query($sql);
		return $query->result();
		
	}

    public function getFilter($where)
    {
        $sql = "select * from laporan_obat where tanggal between '".$where['start']."' AND '".$where['end']."'";
        $query = $this->db->query($sql);
        return $query;
    }
	

}
/* End of file user_m.php */
/* Location: ./application/models/user_m.php */	