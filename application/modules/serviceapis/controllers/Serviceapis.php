<?php 

	class Serviceapis extends MX_Controller{
		
		
		
		public function get(){
			
			$sql="select * from pasien";
			$query = $this->db->query($sql);
			foreach ($query->result() as $row){
				echo $row->nama.';'; 
			} 
			    //$query = $this->db->query($_POST['sql']);
				// json_encode($cars);
		}
		
		  
	}
	
?>