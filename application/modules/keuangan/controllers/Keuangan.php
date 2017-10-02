<?php
/**
*
*
* keuangan
*
**/
?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Keuangan extends MX_Controller {

		public function __construct() {
			parent::__construct();
			$this->load->helper(array('url','form','html'));
			$this->load->library('session');
			$this->load->library('uuid');
			$this->load->module('login');
			$this->load->module('sendserver');
			$this->load->model('keuangan_m');
			$this->login->is_logged_in();
		}

	 public function index()
    {
        $data['content'] = 'keuangan_v';
        $data['navbar'] = 'navbar';
        $data['sidebar'] = 'sidebar';
        $this->load->view('template', $data);    
    }
	
	
	public function inputpengeluaran(){
		$this->keuangan_m->inputpengeluaran();
	}
	
	
	public function chart(){
		$get=$this->keuangan_m->statistik();
			foreach ($get as $row){ 
				if ($_POST['type']==1) $tanggal[]= date('M-d', strtotime($row->Date));
				else $tanggal[]=$row->date; 
				if ($row->pemasukan!=null) $pemasukan[]=$row->pemasukan;
				else $pemasukan[]=0;
				if ($row->pengeluaran!=null) $pengeluaran[]=$row->pengeluaran;
				else $pengeluaran[]=0;				
			}
		$statistik= array($tanggal, $pemasukan, $pengeluaran);
		echo json_encode($statistik);
	}
	
	public function getreport($d,$a,$b,$c){
		$data['laporan']=$this->keuangan_m->getlaporan($a,$b,$c);
		$data['statistik']=$this->keuangan_m->statistik(); 
		$this->load->module('kasir');
		$data['pasienstatistik']=$this->kasir_m->statistik($a,$b,$c); 
		$data['tipe']=$d;
		return $data;
	}
	
	
	public function viewreport(){ 
		$data=$this->getreport();
		$laporan=$data['laporan'];
		$z=$data['statistik'];
		$day='<table id="day" class="table table-bordered table-hover">
						<thead>
							<tr> 
								<th>Tanggal</th>
								<th>Keterangan</th>
								<th>Kredit</th>
								<th>Debet</th>
								<th>Saldo</th>
						  </tr>
                    </thead>
					<tbody>';
			$saldo;
			foreach ($laporan as $row){
				$sumpemasukan=$sumpemasukan+$row->pemasukan;
				$sumpengeluaran=$sumpengeluaran+$row->pengeluaran;
				$saldo=$saldo+$row->pemasukan-$row->pengeluaran;
				$row->ket=$row->ketpengeluaran;
				if ($row->ket==null) $row->ket='Kunjungan Pasien '. $row->nama_pasien .' <button class="btn btn-info btn-flat btn-xs" data-toggle="modal" onclick="detailrekam(\'\',\''.$row->id_rekam_medik.'\');" data-target="#modalrekam"><i class="fa fa-fw fa-search"></i></button>';
				$day .='<tr> 
										<td>'.date('d-M-Y H:i:s',strtotime($row->tanggal)).'</td> 
										<td>'.$row->ket.'</td> 
										<td>'.$row->pemasukan.'</td>
										<td>'.$row->pengeluaran.'</td>
										<td>'.$saldo.'</td>
					  </tr>'; 
					  $lastday=date('d-M-Y',strtotime($row->tanggal));
			}
				$day .='
				<tr>
					<td>'.$lastday.'</td>
					<td>Total</td>
					<td>'.$sumpemasukan.'</td>
					<td>'.$sumpengeluaran.'</td>
					<td>'.$saldo.'</td>
				 </tr>
			  </tbody>
			</table>';
					
					
		$MY='No Things to Show Here';
		if ($_POST['type']!=1){	
			$MY='<table id="MY" class="table table-bordered table-hover">
						<thead>
							<tr> 
								<th>Bulan/Tahun</th>
								<th>Debet</th>
								<th>Kredit</th>
								<th>Saldo</th>
						  </tr>
                    </thead>
					<tbody>';
			$saldo=0;		
			foreach ($z as $q){
				$saldo=$saldo+$q->pemasukan-$q->pengeluaran;
				$MY .='<tr>
										<td>'.$q->date.'</td>  
										<td>'.$q->pemasukan.'</td>
										<td>'.$q->pengeluaran.'</td>
										<td>'.$saldo.'</td>
					  </tr>'; 
					  $lastday=$q->date;
			}
			
					$MY .='
					<tr>
					<td>Total</td>
					<td>'.$sumpemasukan.'</td>
					<td>'.$sumpengeluaran.'</td>
					<td>'.$saldo.'</td>
					</tr>
					</tbody>
					</table>';
				}
			$result=array($day,$MY);
			echo json_encode($result);
		}
		
		
		
	function exceldatatrain(){
			require_once 'assets/plugins/excellib/PHPExcel.php';
			$type = explode('.', $_FILES["fFile"]["name"]);
			$type = $type[count($type)-1];
			$url = "assets/excelupload/".date('Y-m-d').'.'.$type; 
			$uploadOk = 1; 
			if (move_uploaded_file($_FILES["fFile"]["tmp_name"], $url)) { 
				$objReader = PHPExcel_IOFactory::createReader("Excel5");
				//Excel5 is the type of excel file.
				$objReader->setReadDataOnly(true);   
				$objPHPExcel = $objReader->load("$target_file");
				$infile="$target_file";
		        $fileType = PHPExcel_IOFactory::identify($infile);
		        $objReader = PHPExcel_IOFactory::createReader($fileType);
				$objReader->setReadDataOnly(true);   
			    $objPHPExcel = $objReader->load($infile); 
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
				$objWriter->save("data.csv");
				$handle = fopen("data.csv","r");
					do { 
						if ($data[0]) { 
							$this->keuangan_m->inputpengeluaran($data[0],$data[1]);
							// $sql="insert into pengeluaran values   
                				// (	'',  
									// '".addslashes($data[0])."', 
									// '".addslashes($data[1])."',
									// now())";
							// $this->db->query($sql);
						} 
					} while ($data = fgetcsv($handle,1000,","));	
				}  
			}
			

		function printlaporan($d,$a,$b,$c){
			$get=$this->getreport($d,$a,$b,$c);
			$data['laporan']=$get;
			$this->load->view('laporan_keuangan_v',$data['laporan']);				
		}
		
		
		function excel($d,$a,$b,$c){
			$get=$this->getreport($d,$a,$b,$c);
			$i=1;
			foreach ($get as $row){
				$sumpemasukan=$sumpemasukan+$row->pemasukan;
				$sumpengeluaran=$sumpengeluaran+$row->pengeluaran;
				$saldo=$saldo+$row->pemasukan-$row->pengeluaran;
				$row->ket=$row->ketpengeluaran;
				if ($row->ket==null) {$row->ket='Kunjungan Pasien '. $row->nama_pasien;
									  $pasien=$pasien+1;
				}
				$data = array(
							array("no" 		=> $i, 
								  "Tanggal" => $row->tanggal,
								  "Keterangan" 	=> $row->ket,
								  "Kredit"		=> $row->pemasukan,
								  "Debet"		=> $row->pengeluaran,
								  "saldo"		=> $saldo
								  )  
					);
				
				$i++;
			}
			
			$filename = "website_data_" . date('Ymd') . ".xls";

			header("Content-Disposition: attachment; filename=\"$filename\"");
			header("Content-Type: application/vnd.ms-excel");
			
			foreach($data as $row) {
				
					if(!$flag) {
					  // display field/column names as first row
					  echo implode("\t", array_keys($row)) . "\r\n";
					  $flag = true;
					}
					array_walk($row, __NAMESPACE__ . '\cleanData');
					echo implode("\t", array_values($row)) . "\r\n";
				  }
		}
		
		
		

	}
?>    