
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sendserver extends MX_Controller {


	private $id_db;
	
	public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','form','html'));
        $this->load->library('session');
		$this->load->library('sending');
		$this->load->model('sendserver_m');
		$this->id_db=$this->sendserver_m->getiddb();
    }
	
	
	
	
	public function index(){
		$savesql=$this->sendserver_m->getsavesql();
			foreach ($savesql as $row){	
					$data[]=$row->query;
					$id[]=$row->id_sql;
				}
				$result=$this->sending->send($this->id_db,$data);
				// print_r ($result);
				if ($result!='0'){
					$i=0;
					print_r ($id);
					while ($i<sizeof($id)){
						$this->sendserver_m->delsavesql($id[$i]);
						$i++;
					}
					if ($result!='no data')	{
						print_r ($result);
						$this->sendserver_m->serversql($result);
							echo '<script>location.reload();</script>';
						}
			}
	}
	
	// public function test(){		
		// $query=$this->sendserver_m->test();
		// print_r ($query);
		// //print_r($query->result());
		// // $sql='zzzz';
		// // $result=$this->sendserver_m->singleevent($sql);  
		// // // $result = $this->sendserver_m->singleevent($sql);
		// // print_r ($result); 
		// // // $data =json_decode($result);
		// // echo $data[1];
	// }
}

?>