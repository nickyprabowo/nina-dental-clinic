

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usermodel extends CI_Model 
{
	
    public function __construct()
    {
        parent::__construct();
        //Load Dependencies
    }

	protected $table_name = 'user';
	
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
    public function save($data, $where)
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
	
}