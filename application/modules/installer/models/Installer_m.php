<?php

/**
 * @author Nicky
 * @copyright 2015
 */

?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Installer_m extends CI_Model 
{

	public function datainstall($table,$data){
		 $this->db->set($data);
         $this->db->insert($table);
	}
	
	function cek(){
		$sql="select * from clinic_cabang";
		$query = $this->db->query($sql);
		return $query->result();
		}
		
	function insdataclinic(){
		$sql="update clinic_cabang set nama_clinic='".$_POST['namaclinic']."', alamat_clinic='".$_POST['alamatclinic']."' where id_cabang=1";
		$this->sendserver_m->CRUD($sql);
		$this->sendserver_m->cabangCRUD($_POST);
		}
	}
/* End of file user_m.php */
/* Location: ./application/models/user_m.php */	