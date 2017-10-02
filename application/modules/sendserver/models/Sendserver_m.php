<?php 

	class Sendserver_m extends CI_Model {
		
		
		private $id_db;
		
		public function __construct() {
			parent::__construct();
			$this->id_db=$this->getiddb();
		}
		
		public function test(){
			$this->db->get('obat');
			$str = $this->db->last_query();
			return $str;
		}
		
		public function getiddb(){
			$sql="select * from clinic_cabang";
			$query = $this->db->query($sql);
			foreach ($query->result() as $row){
				$data['db_name']=$row->db_name;
				$data['db_username']=$row->db_username;
				$data['db_passwd']=$row->db_passwd;
			}
			return $data;
		}
		
		public function getsavesql(){
			$sql="select * from savesql";
			$query = $this->db->query($sql);
			return $query->result();
		}
		
		public function delsavesql($id){
			$sql="delete from savesql where id_sql=$id";
			$query = $this->db->query($sql);
		}
		
		public function savesql($sql){
			$time=date("Y-m-d H:i:s");
			$sql="insert into savesql values ('',\"$sql\",'$time')";
			$query = $this->db->query($sql);
		}
		
		public function singleevent($sql){
			$data[]=$sql;
			$result=$this->sending->send($this->id_db,$data);
			// return $result;
			// print_r($result);
				if ($result=='0'){
						// $time=date("Y-m-d H:i:s");
						// $sql1="insert into savesql values ('',\"$sql\",'$time')";
						// $this->db->query($sql1);
						$this->savesql($sql);
			}
			else return $result;
		}

			
		public function CRUD($sql){
			$this->singleevent($sql);
			$this->db->query($sql);
		}	
		
		public function cabangCRUD($z){
			$data=$this->getiddb();
			$sql="insert into cabang (nama_cabang,alamat_cabang,db_name,db_username,db_passwd) 
				  value('".$z['namaclinic']."','".$z['alamatclinic']."','".$data['db_name']."','".$data['db_username']."','".$data['db_passwd']."')
				  ON DUPLICATE KEY UPDATE 
				  nama_cabang='".$z['nama']."',
				  alamat_cabang='".$z['alamat']."'";
			$q[]=$sql;
			$id_db['db_name']='u207585127_list';
			$id_db['db_username']='u207585127_list';
			$id_db['db_passwd']='ninanina123';
			$this->sending->send($id_db,$q);
		}		
		
		public function serversql($result){
			$data=json_decode($result);
			$i=0;
			while ($i<sizeof($data)){
				$this->db->query($data[$i]);
				$i++;
			}
		}
	
				
	}
	
?>
	
