<?php

/**
 * @author Nicky
 * @copyright 2015
 */

?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Obat_m extends CI_Model 
{

    protected $collection_name = 'obat';

    public function __construct()
    {
            parent::__construct();
            //Load Dependencies
    }

    function find()
    {
        $data = $this->mongo_db->db->selectCollection('rekam_medis');

        return $data;
    }

}
/* End of file user_m.php */
/* Location: ./application/models/user_m.php */