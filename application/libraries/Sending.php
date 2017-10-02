<?php 

	class Sending{
		
		public function __construct() {
			$id_cabang='zzz';
			$ci=&get_instance();
			$ci->load->database();
			// $this->load->library('database');
		}
		 
		public function send($id,$sql){ 
				$data = array (
						'id' => $id, 
						'sql' => $sql
						);
						
				$data = http_build_query($data);

				$context_options = array (
						'http' => array (
							'method' => 'POST',
							'header'=> "Content-type: application/x-www-form-urlencoded\r\n"
										. "Content-Length: " . strlen($data) . "\r\n",
							'content' => $data
							)
						); 

				$context = stream_context_create($context_options);
				$fp = file_get_contents('http://www.ninadentalcare.com/serviceapis/get', false, $context);
				
				if ($fp === FALSE) {
					return 0;
				}
				else return $fp;
		}
		
		public function install($q){ 
				$data = array (	
						'id' => array (
									'db_name' => $q['name'], 
									'db_username' => $q['username'],
									'db_passwd' => $q['password']
							)
						);
						
				$data = http_build_query($data);

				$context_options = array (
						'http' => array (
							'method' => 'POST',
							'header'=> "Content-type: application/x-www-form-urlencoded\r\n"
										. "Content-Length: " . strlen($data) . "\r\n",
							'content' => $data
							)
						); 

				$context = stream_context_create($context_options);
				$fp = file_get_contents('http://www.ninadentalcare.com/serviceapis/install', false, $context);
				
				if ($fp === FALSE) {
					return 0;
				}
				else return $fp;
		}
		
	}
		
		
	
?>