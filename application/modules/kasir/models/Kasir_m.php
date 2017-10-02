<?php

/**
 * @author Nicky
 * @copyright 2015
 */

?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kasir_m extends CI_Model 
{
    public function __construct()
    {
            parent::__construct();
			
    }

    public function listantrian($date){
		$sql="SELECT a.*, rk.id_rekam_medik, p.nama as nama_pasien, p.foto, p.tgllahir as tgllhr_pasien FROM antrian a
				inner join pasien p on p.id_pasien=a.id_pasien
				left join rekam_medik rk on a.id_antrian=rk.id_antrian
			  where  a.status<>'Batal' ";
		if ($date==null) $sql .=" and a.tanggal='".date('Y-m-d')."' order by a.nomer_antrian DESC";
		else { 
			if ($date=="bulan") {$sql .=" and month(a.tanggal)='".date(m)."'";}
			elseif ($date=="tahun") {$sql .=" and year(a.tanggal)='".date(Y)."'";}
			else {$sql .=" and a.tanggal='".$date."'";}
		}
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	
	
	//proses update antrian dan insert rekam medik beserta korelasinya//
	public function pushantrian($id){
		
	///////////////////////////////hapuss antrian///////////////////////
		if ($_POST['hapus']==true){ ///hapuss
			$sql="update antrian set status='Batal' where id_antrian='".$_POST['id']."'";
			$query = $this->sendserver_m->CRUD($sql);
			}
	
	////////////////////////put pasien to antrian///////////////////////
		else {
			if ($_POST['id']!=null){
				$idantrian=$this->uuid->v4();
				$sql="insert into antrian (id_antrian,id_pasien,nomer_antrian,tanggal,status) select '".$idantrian."','".$_POST['id']."',Count(nomer_antrian)+1,'".date('Y-m-d')."','Antri' from antrian where tanggal='".date('Y-m-d')."'  limit 1 " ;
				$this->sendserver_m->CRUD($sql);
				}
				
	////////////////////put karyawan on antrian and rekam medik//////////
			else {
				if ($_POST['status']=='Antri'){
						$sql="update antrian set  status='On Progress' where id_antrian='".$_POST['id_antrian']."'";
						$query = $this->sendserver_m->CRUD($sql);
						$sql1="select * from pasien where id_pasien=(select id_pasien from antrian where id_antrian='".$_POST['id_antrian']."')";
						$q = $this->db->query($sql1);
						$idrekam=$this->uuid->v4();
						foreach ($q->result() as $row){
							$sql2="insert into rekam_medik values('$idrekam','".$row->id_pasien."','".$row->nama."','".$_POST['id_antrian']."','','".date('Y-m-d')."','','','','','')";
							$this->sendserver_m->CRUD($sql2);
						}
						$this->karyawantorekammedik($_POST['karyawan'],$idrekam);
						return $idrekam;
						//table karyawan_to_rekammedik
				}
	
	
	///////////////////put obat, resep, diagnosa, tindakan to rekam medik//
				elseif ($_POST['status']=='On Progress'){
					$sql="update antrian set  status='Selesai_ditangani' where id_antrian='".$_POST['id_antrian']."'";
					$this->sendserver_m->CRUD($sql);
					if ($_POST['foto']!=null) {
						$sql1="update rekam_medik set galeri='".$_POST['foto']."' where id_rekam_medik='".$_POST['id_rekam_medik']."'";
						$query = $this->sendserver_m->CRUD($sql1);}
					$idresep=$this->uuid->v4();
					$this->reseptorekammedik($_POST['obat'],$_POST['jumlahobat'],$_POST['resep'],$idresep,$_POST['hargaobat']);	//table reseep////////////////////////////////
					$this->tindakantorekammedik($_POST['tindakan'],$_POST['id_rekam_medik'],$_POST['hargatindakan']);				//table tindakan//////////////////////////////
					$this->diagnosatorekammedik($_POST['diagnosa'],$_POST['id_rekam_medik']);				//table diagnosa//////////////////////////////
					$this->rekammediktobiaya($idresep,$_POST['id_rekam_medik']);							//update rekam medik dan biaya//////////////////////// 
				}
				
	///////////////////update rekam medik pembayaran and update stok obat//////////////
				else {
					$time=date("Y-m-d H:i:s");
					$sql="update antrian set  status='Selesai' where id_antrian='".$_POST['id_antrian']."'";
					$this->sendserver_m->CRUD($sql);
					$jumlah=$_POST['jumlahkredit'];
					
					if ($_POST['pembayaran']!='Kredit'){
						$sqli="select biaya from rekam_medik where id_rekam_medik='".$_POST['id_rekam_medik']."'";
						$query=$this->db->query($sqli)->result();
						$jumlah=$query[0]->biaya;
					}
					
					$sql1="update rekam_medik set jenis_pembayaran='".$_POST['pembayaran']."',
												  jumlah_pembayaran='".$jumlah."',
												  keterangan_pembayaran='".$_POST['keterangankredit']."' where id_rekam_medik='".$_POST['id_rekam_medik']."'";
												  
					$this->sendserver_m->CRUD($sql1);
					$sql2="select a.id_obat, a.jumlah from resep_to_obat a
						inner join resep b on a.id_resep=b.id_resep
						inner join rekam_medik c on b.id_resep=c.id_resep
						where c.id_rekam_medik='".$_POST['id_rekam_medik']."'";
					foreach ($this->db->query($sql2)->result() as $q){
						$idlapobat=$this->uuid->v4();
						$sqllaporanobat="insert into laporan_obat select '$idlapobat','".$q->id_obat."', nama,'".$time."', stok, stok-".$q->jumlah.", '', '', 'Pengobatan', 'Pengobatan oleh pasien dengan id rekam medik ".$_POST['id_rekam_medik']."' 
										 from obat where id_obat='".$q->id_obat."'";
						$this->sendserver_m->CRUD($sqllaporanobat);		
						$sql3="update obat set stok=stok-".$q->jumlah." where id_obat='".$q->id_obat."'"; 
						$this->sendserver_m->CRUD($sql3);
					}
					$id="PEM".$this->uuid->v4();
					$sql4="insert into pemasukan select '".$id."','".$time."', jumlah_pembayaran, id_rekam_medik from rekam_medik where id_rekam_medik='".$_POST['id_rekam_medik']."'";
					$this->sendserver_m->CRUD($sql4);
					$idlaporankeuangan=$this->uuid->v4();
					$sql5="insert into laporan_keuangan values('$idlaporankeuangan','".$id."','','".$time."')";  
					$this->sendserver_m->CRUD($sql5);
				}
			}
		}
	}
	
	
	
	
	public function prosesedit($data,$f){
		$karyawan=$data['datakaryawan']; 
		$diagnosaresep=$data['diagnosaresep']; 
		$idrekammedik=$karyawan['id_rekam_medik'];
		if ($f!=null){
				$sqlf="update rekam_medik set galeri='".$f."' where id_rekam_medik='".$idrekammedik."'";
				$this->sendserver_m->CRUD($sqlf);  
		}
		$sql="delete from rekam_medik_to_karyawan where id_rekam_medik='".$idrekammedik."'";
		$this->sendserver_m->CRUD($sql);
		$this->karyawantorekammedik($karyawan['karyawan'],$idrekammedik);
		$sql1="select id_resep from rekam_medik where id_rekam_medik='".$idrekammedik."'";	
			foreach ($this->db->query($sql1)->result() as $q){
					$idresep=$q->id_resep;
				}
		if ($idresep!=0){
			
		///////////////////resep dan obat/////////////////
			$sql2="delete from resep where id_resep='".$idresep."'";
			$this->sendserver_m->CRUD($sql2);
			$sql3="delete from resep_to_obat where id_resep='".$idresep."'";
			$this->sendserver_m->CRUD($sql3);
			$this->reseptorekammedik($diagnosaresep['obat'],$diagnosaresep['jumlahobat'],$diagnosaresep['resep'],$idresep,$diagnosaresep['hargaobat']);
		///////////////////tindakan/////////////////////////	
			$sql4="delete from rekam_medik_to_tindakan where id_rekam_medik='".$idrekammedik."'";
			$this->sendserver_m->CRUD($sql4);
			$this->tindakantorekammedik($diagnosaresep['tindakan'],$idrekammedik,$diagnosaresep['hargatindakan']);
		///////////////////diagnosa////////////////////////
			$sql5="delete from rekam_medik_to_diagnosa where id_rekam_medik='".$idrekammedik."'";
			$this->sendserver_m->CRUD($sql5);
			$this->diagnosatorekammedik($diagnosaresep['diagnosa'],$idrekammedik);	
		///////////////////biaya///////////////////////////
			$this->rekammediktobiaya($idresep,$idrekammedik);
		}
	
	}
	
	public function reseptorekammedik($obat,$jumlahobat,$resep,$idresep,$hargaobat){
		$banyakobat=sizeof($obat);	
					for ($i=0;$i<$banyakobat;$i++){
						if ($obat[$i]!=null && $obat[$i]!='0'){
							
							if ($jumlahobat[$i]!=0){
								$idrsptobat=$this->uuid->v4();
								$sql2="insert into resep_to_obat select '$idrsptobat','$idresep','".$obat[$i]."','".$jumlahobat[$i]."','',".$hargaobat[$i]." from obat where id_obat='".$obat[$i]."'";
								$query = $this->sendserver_m->CRUD($sql2); 
								}
							}
						}
					$sql4="insert into resep select '$idresep','".$resep."', SUM(harga) from resep_to_obat where id_resep='$idresep'";
					$query = $this->sendserver_m->CRUD($sql4);
	}
	
	function tindakantorekammedik($tindakan,$idrekam,$hargatindakan){
		$banyaktindakan=sizeof($tindakan);
					for ($i=0;$i<$banyaktindakan;$i++){
						if ($tindakan[$i]!=null && $tindakan[$i]!=null){
							$id=$this->uuid->v4();
							$sql5="insert into rekam_medik_to_tindakan values('$id','".$idrekam."','".$tindakan[$i]."','".$hargatindakan[$i]."')";
							$query = $this->sendserver_m->CRUD($sql5);
						}
					} 
	}
	
	function diagnosatorekammedik($diagnosa,$idrekam){
		$banyakdiagnosa=sizeof($diagnosa);
					for ($i=0;$i<$banyakdiagnosa;$i++){
						if ($diagnosa[$i]!=null && $diagnosa[$i]!=null){
							$id=$this->uuid->v4();
							$sql6="insert into rekam_medik_to_diagnosa values('$id','".$idrekam."','".$diagnosa[$i]."')";
							$query = $this->sendserver_m->CRUD($sql6);
						}
					}
	}
	
	public function karyawantorekammedik($karyawan,$idrekam){
					$d=sizeof($karyawan);
					for ($i=0;$i<$d;$i++){
						if ($karyawan[$i]!=null){
							$id=$this->uuid->v4();
							$sql3="insert into rekam_medik_to_karyawan values('$id','$idrekam','".$karyawan[$i]."')";
							$this->sendserver_m->CRUD($sql3);
							} 
						}
	}
	
	public function rekammediktobiaya($idresep,$idrekam){
		$sql1="update rekam_medik set id_resep='$idresep', biaya=(SELECT r.biaya+sum(rmt.biaya)  
																			  from resep r, rekam_medik_to_tindakan rmt 
																			  where r.id_resep='$idresep' and rmt.id_rekam_medik='".$idrekam."')
		where id_rekam_medik='".$idrekam."'";
		$query = $this->sendserver_m->CRUD($sql1);
	}
	
	public function statistik($a,$b,$c){
		if ($a!=null) {
			$_POST['type']=$a;
			$_POST['from']=$b;
			$_POST['till']=$c;
		}
		if ($_POST['type']==1) {
		$sql="select a.Date, b.total 
						from (
							select curdate() - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY as Date
							from (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as a
							cross join (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as b
							cross join (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as c
						) a
			  left join (select tanggal, count(tanggal) as total from antrian where status!='Batal'  group by tanggal ) as b
			  on a.Date=b.tanggal 
			  where a.Date between '".date('Y-m-d', strtotime($_POST['from']))."' and  '".date('Y-m-d', strtotime($_POST['till']))."'
			  group by a.Date";}
		else if ($_POST['type']==2) {
			//echo '01-'.$_POST['from'];
			$_POST['from1']=date('Y-m-d', strtotime('01-'.$_POST['from']));
			$_POST['from2']=date('Y-m-d', strtotime('22-'.$_POST['fromm']));
			$_POST['till']=date('Y-m-d', strtotime('30-'.$_POST['till']));
			$sql="select a.tanggal as date, b.total from ( select
					DATE_FORMAT(m1, '%M %Y') as tanggal
					from		(
									select 
									('".$_POST['from1']."' - INTERVAL DAYOFMONTH('".$_POST['from2']."')-1 DAY) 
									+INTERVAL m MONTH as m1
									from 
									(
									select @rownum:=@rownum+1 as m from
									(select 1 union select 2 union select 3 union select 4) t1,
									(select 1 union select 2 union select 3 union select 4) t2,
									(select 1 union select 2 union select 3 union select 4) t3,
									(select 1 union select 2 union select 3 union select 4) t4,
									(select @rownum:=-1) t0 
									) d1
									) d2 
									where m1<='".$_POST['till']."'
									order by m1 ) as a
				left join (select  tanggal, sum(total) as total from (SELECT date_format(tanggal, '%M %Y' ) as tanggal, COUNT( tanggal ) AS total
				FROM antrian
				WHERE STATUS !=  'Batal' group by tanggal) as a group by tanggal) as b on b.tanggal=a.tanggal";
		}
		
		else $sql="select year(tanggal) as date, count(tanggal) as total from antrian where status!='Batal' and year(tanggal) between '".$_POST['from']."' and '".$_POST['till']."' group by date";			 
		
		$query = $this->db->query($sql);
		return $query->result();
	}	
	
	
		
		
				//for statistik by month
				/*select  tanggal, sum(total) from (SELECT date_format(tanggal, '%M %Y' ) as tanggal, COUNT( tanggal ) AS total
				FROM antrian
				WHERE STATUS !=  'Batal' group by tanggal) as a group by tanggal
				*/
				/*
				select 
				DATE_FORMAT(m1, '%b %Y')

				from
				(
				select 
				('2013-01-23' - INTERVAL DAYOFMONTH('2013-01-23')-1 DAY) 
				+INTERVAL m MONTH as m1
				from
				(
				select @rownum:=@rownum+1 as m from
				(select 1 union select 2 union select 3 union select 4) t1,
				(select 1 union select 2 union select 3 union select 4) t2,
				(select 1 union select 2 union select 3 union select 4) t3,
				(select 1 union select 2 union select 3 union select 4) t4,
				(select @rownum:=-1) t0
				) d1
				) d2 
				where m1<='2014-04-01'
				order by m1
				*/


	
}
	
	
/* End of file user_m.php */
/* Location: ./application/models/user_m.php */