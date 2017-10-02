<?php

/**
 * @author Nicky
 * @copyright 2015
 */

?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rekam_medik_m extends CI_Model 
{

   
    public function __construct()
    {
            parent::__construct();
            //Load Dependencies
    }

   function getrekammedik($id){
		$sql="select a.*, p.nama as nama_pasien, p.alamat, p.jenis_kelamin, p.tgllahir as tgllagir_pasien, p.foto as foto_pasien, r.keterangan as keterangan_resep from rekam_medik a
			  right join pasien p on p.id_pasien=a.id_pasien
			  left join resep r on r.id_resep=a.id_resep ";
		if ($id!=null) $sql .="where a.id_rekam_medik='$id'"; //for antrian and detailed rekam_medik later
		if ($_POST['id_pasien']!=null )$sql .="where p.id_pasien='".$_POST['id_pasien']."' and a.jenis_pembayaran!=''"; //for geting list of rekam_medik include this ( and a.jenis_pembayaran !=null)
		$query = $this->db->query($sql);
		return $query->result();
	}
	
   function getdetailkaryawan($id,$get){
		$sql="select a.*, b.id_karyawan, c.nama as nama_karyawan, c.foto as foto_karyawan , c.tgl_lahir, c.email, c.foto from rekam_medik a 
				inner join rekam_medik_to_karyawan b on a.id_rekam_medik=b.id_rekam_medik
				inner join karyawan c on b.id_karyawan=c.id_karyawan "; 
		if ($get=='Antri') $sql .= 'where a.id_antrian=\''.$id.'\'';
		else $sql .='where a.id_rekam_medik=\''.$id."'";
		$query = $this->db->query($sql);
		return $query->result();
   }
   
   function getdetailtindakan($id){
	   $sql="select a.*, b.nama as nama_tindakan from rekam_medik_to_tindakan a 
			 inner join tindakan b on a.id_tindakan=b.id_tindakan
			 where a.id_rekam_medik='$id'";
		$query = $this->db->query($sql);
		return $query->result();	  
   }
   
   function getdetaildiagnosa($id){
	   $sql="select a.*, b.nama as nama_diagnosa from rekam_medik_to_diagnosa a 
			 inner join diagnosa b on a.id_diagnosa=b.id_diagnosa
			 where a.id_rekam_medik='$id'";
		$query = $this->db->query($sql);
		return $query->result();	  
   }
   
   
   function getdetailresep_to_obat($id){
	   $sql="select *,a.harga as hargatotal, b.nama as nama_obat, b.harga as hargasatuan  from resep_to_obat a
			 inner join obat b on a.id_obat=b.id_obat
			 where id_resep='$id'";
	   $query = $this->db->query($sql);
	   return $query->result();	
	    
   }

}
/* End of file user_m.php */
/* Location: ./application/models/user_m.php */