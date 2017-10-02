<?php

/**
 * @author Nicky
 * @copyright 2015
 */

?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class rekam_medik_m extends CI_Model 
{

   
    public function __construct()
    {
            parent::__construct();
            //Load Dependencies
    }

   function getdetail($id){
		$sql="select a.*, b.id_karyawan, c.nama, c.tgl_lahir, c.email, c.foto from rekam_medik a 
				inner join rekam_medik_to_karyawan b on a.id_rekam_medik=b.id_rekam_medik
				inner join karyawan c on b.id_karyawan=c.id_karyawan
				where a.id_antrian='$id'"; 
		$query = $this->db->query($sql);
		return $query->result();
   }

}
/* End of file user_m.php */
/* Location: ./application/models/user_m.php */