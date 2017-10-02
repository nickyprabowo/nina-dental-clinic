<?php

/**
 * @author Nicky
 * @copyright 2015
 */

?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Keuangan_m extends CI_Model 
{
	public function inputpengeluaran($a,$b){
		if ($a!=null){
				$_POST['jumlah']=$a;
				$_POST['ket']=$b;
		}
		$id="PEN".$this->uuid->v4();
		$time=date("Y-m-d H:i:s");
		$sql="insert into pengeluaran values('".$id."','".$_POST['jumlah']."','".$_POST['ket']."','".$time."')";  
		$this->sendserver_m->CRUD($sql);
		$idlaporankeuangan=$this->uuid->v4();
		$sql1="insert into laporan_keuangan values('$idlaporankeuangan','','".$id."','".$time."')";  
		$this->sendserver_m->CRUD($sql1);
	}
	
	public function getlaporan($a,$b,$c){
		if ($a!=null) {
			$_POST['type']=$a;
			$_POST['from']=$b;
			$_POST['till']=$c;
		}
		$date=$this->getdate($_POST);
		// print_r($_POST);
		$sql="select a.*, 
		      b.jumlah as pengeluaran, b.keterangan as ketpengeluaran, 
		      c.jumlah as pemasukan, c.id_rekam_medik, d.nama_pasien
			  from laporan_keuangan a
			  left join pengeluaran b on a.id_pengeluaran=b.id_pengeluaran
			  left join pemasukan c on a.id_pemasukan=c.id_pemasukan
			  left join rekam_medik d on c.id_rekam_medik=d.id_rekam_medik
		      where a.tanggal between '".$date['from']."' and '".$date['till']."' order by a.tanggal ASC";
		$query = $this->db->query($sql)->result();
		return $query;	
	}
	
	public function getpemasukan(){
		$date=$this->getdate($_POST);
		$sql="select a.*, c.id_pasien, c.nama  from pemasukan a
			  inner join rekam_medik as b on a.id_rekam_medik=b.id_rekam_medik
			  left join pasien as c on b.id_pasien=c.id_pasien
			  where a.tanggal between '".$date['from']."' and '".$date['till']."' order by a.tanggal ASC";
		$query = $this->db->query($sql)->result();
		return $query;
	}
	
	public function getpengeluaran(){ 
		$date=$this->getdate($_POST);
		$sql="select * from pengeluaran where tanggal between '".$date['from']."' and '".$date['till']."'";
		$query = $this->db->query($sql)->result();	
		return $query;
	}
	  
	function getdate($a){
		if ($a['type']==1){
			$date['from']=date('Y-m-d', strtotime($a['from']));
			$date['till']=date('Y-m-d', strtotime("+1 day", strtotime($a['till'])));
			}
		else if ($a['type']==2){
			$date['from']=date('Y-m-d', strtotime('01-'.$a['from']));
			$date['till']=date('Y-m-t', strtotime('01-'.$a['till']));
		}	
		else {
			$date['from']=date('Y-m-d', strtotime('01-01-'.$a['from']));
			$date['till']=date('Y-m-t', strtotime('01-12-'.$a['till']));
		}
		return $date;
	}
	
	public function getsaldo(){
		$date=$this->getdate($_POST);
		$data['from']=$date;
		$data['pemasukan']="select sum(jumlah) as jumlah from pemasukan where tanggal < '".$date['from']."'";
		$data['pengeluaran']="select sum(jumlah) as jumlah from pengeluaran where tanggal < '".$date['from']."'";
		$data['pemasukan']=$this->db->query($data['pemasukan'])->result();  
		$data['pengeluaran']=$this->db->query($data['pengeluaran'])->result();
		if ($data['pemasukan'][0]->jumlah==null) $data['pemasukan'][0]->jumlah=0;
		if ($data['pengeluaran'][0]->jumlah==null) $data['pengeluaran'][0]->jumlah=0;
		$data['saldo'] = $data['pemasukan'][0]->jumlah-$data['pengeluaran'][0]->jumlah;
		if ($data['saldo']==null) $saldo=0;		
		return $data;	
	}
	
	
	 
	public function statistik($data){
		if ($data!=null) $_POST=$data;
	 
		if ($_POST['type']==1) {
			$sql=$this->statistikday($_POST);
		}
		else if ($_POST['type']==2) {
			$sql=$this->statistikmonth($_POST);
		}
		
		else $sql=$this->statistikyear($_POST);
		
		$query = $this->db->query($sql);
		return $query->result(); 
	}	
	
	
	public function statistikday($a){
		$sql="select a.Date, b.pemasukan, c.pengeluaran
						from (
							select curdate() - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY as Date
							from (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as a
							cross join (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as b
							cross join (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as c
						) a
			  left join (select date_format(tanggal, '%Y-%m-%d') as tanggal, sum(jumlah) as pemasukan from pemasukan group by date_format(tanggal, '%Y-%m-%d')) as b 
			  on a.Date=b.tanggal 
			  left join (select date_format(tanggal, '%Y-%m-%d') as tanggal, sum(jumlah) as pengeluaran from pengeluaran group by date_format(tanggal, '%Y-%m-%d')) as c
			  on a.Date=c.tanggal  
			  where a.Date between '".date('Y-m-d', strtotime($a['from']))."' and  '".date('Y-m-d', strtotime($a['till']))."'
			  group by a.Date";
		return $sql;
	}
	
	public function statistikmonth($a){
		$a['from1']=date('Y-m-d', strtotime('01-'.$a['from']));
			$a['from2']=date('Y-m-d', strtotime('22-'.$a['from']));
			$a['till']=date('Y-m-d', strtotime('30-'.$a['till']));
			$sql="select a.tanggal as date, b.pemasukan as pemasukan, c.pengeluaran as pengeluaran from ( select
					DATE_FORMAT(m1, '%M %Y') as tanggal
					from		(
									select 
									('".$a['from1']."' - INTERVAL DAYOFMONTH('".$a['from2']."')-1 DAY) 
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
									where m1<='".$a['till']."'
									order by m1 ) as a
			 	left join (select  tanggal, sum(pemasukan) as pemasukan
									from (SELECT date_format(tanggal, '%M %Y' ) as tanggal, sum(jumlah) as pemasukan 
													from pemasukan  group by tanggal) as b1
										  group by tanggal) as b on b.tanggal=a.tanggal
			 	left join (select  tanggal, sum(pengeluaran) as pengeluaran
									from (SELECT date_format(tanggal, '%M %Y' ) as tanggal, sum(jumlah) as pengeluaran
													from pengeluaran group by tanggal) as c1
										  group by tanggal) as c on c.tanggal=a.tanggal ";
		return $sql;
	}
	 
	public function statistikyear($a){
		$sql="select year(tanggal) as date, sum(jumlah) as pemasukan, b.pengeluaran from pemasukan as a
				   left join (select year(tanggal) as date, sum(jumlah) as pengeluaran from pengeluaran) as b
					on year(a.tanggal)=b.date  
					and year(tanggal) between '".$a['from']."' and '".$a['till']."' group by year(a.tanggal)";
		return $sql;
	}
	
}

	
	
/* End of file user_m.php */
/* Location: ./application/models/user_m.php */ 