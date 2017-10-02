<html><head>  <title>Nina Dental Clinic</title>  
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
   </head><body bgcolor="#ffffff" onLoad="window.print()">
 <table cellpadding="0" cellspacing="0" border="0" width="820" align="center"> 
	<td class="prtext">
		<table cellpadding="0" cellspacing="0" border="0">     
			<td valign="top" width="150">
				<img src="<?php echo base_url()?>assets/img/logoninadentalcare.png" style="width:140px;height:84px;padding-top:5px;border-right:5px;">
			</td>     
			<td class="prsmall" valign="top" width="410">    
				SIP 446.dg/331.1/35.73.306/2015 <br><?php echo $this->session->userdata('alamat_clinic');?><br>
				SISTEM INFORMASI NINA DENTAL CLINIC
				<br>----------------------------------------------------------------------------<br>
			</td>
			<td valign="top">
				Laporan Keuangan Clinic<br><br>
				<br>
				<br>---------------------------------<br>
			</td>
		</table>	
		</br>
		<div class="prtitle" align="center">LAPORAN KEUANGAN CLINIC CABANG 
		 <div id="date"></div> 		
		</div>	
		
		<?php if ($tipe=='harian'){?>
		<table cellpadding="0" cellspacing="0" border="0">  
			 <tr class="prtext" bgcolor="#ffffff" align="center">   
					<td colspan="6" >--------------------------------------------------------------------------------------------------------------------------------------------</td>
				 </tr>  
				 <tr class="prtext" bgcolor="#ffffff" align="center">   
				 
				 <td width="30" height="25"><b>No</b></td>    
				 <td width="150" height="25"><b>Tanggal</b></td>    
				 <td width="250" align="left"><b>KETERANGAN</b></td>    
				 <td width="60" align="right"><b>Kredit</b></td> 
				 <td width="80" align="right"><b>Debet</b></td>		 
				 <td width="80" align="right"><b>Saldo</b></td>    
			 <tr class="prtext" bgcolor="#ffffff" align="center">    
				<td colspan="6" >--------------------------------------------------------------------------------------------------------------------------------------------</td></tr>    
			
			<?php 
				$i=1;
				$pasien=0;
				foreach ($laporan as $row){
				$sumpemasukan=$sumpemasukan+$row->pemasukan;
				$sumpengeluaran=$sumpengeluaran+$row->pengeluaran;
				$saldo=$saldo+$row->pemasukan-$row->pengeluaran;
				$row->ket=$row->ketpengeluaran;
				if ($row->ket==null) {$row->ket='Kunjungan Pasien '. $row->nama_pasien;
									  $pasien=$pasien+1;
				}
				echo '<tr class="prtext" bgcolor="#ffffff" align="center">
										<td align="center">'.$i.'</td> 
										<td align="left">'.date('d-M-Y H:i:s',strtotime($row->tanggal)).'</td> 
										<td align="left">'.$row->ket.'</td> 
										<td align="right">'.$row->pemasukan.'</td>
										<td align="right">'.$row->pengeluaran.'</td>
										<td align="right">'.$saldo.'</td>
					  </tr>'; 
					  if ($i==1) $firstday=date('d M Y',strtotime($row->tanggal));
					  $lastday=date('d M Y',strtotime($row->tanggal));
					  $i++;
				}
				?>
		<tr class="prtext" bgcolor="#ffffff" align="center">    
			<td colspan="6" >--------------------------------------------------------------------------------------------------------------------------------------------</td></tr>  
		<tr class="prtext" bgcolor="#ffffff" align="center" height="25">    
				 <td>&nbsp;</td>    
				 <td>&nbsp;</td>    
				 <td colspan="2" align="left">Total </td>   
				  <td>&nbsp;</td>   
				 <td align="right"><b><?php echo $saldo ?></b></td>    
			</tr>  
		<tr class="prtext" bgcolor="#ffffff" align="center">   
			<td colspan="6" >--------------------------------------------------------------------------------------------------------------------------------------------</td></tr>   
		</table>
		<?php } 
			else {
		?>
			<table cellpadding="0" cellspacing="0" border="0">  
			 <tr class="prtext" bgcolor="#ffffff" align="center">   
					<td colspan="6" >--------------------------------------------------------------------------------------------------------------------------------------------</td>
				 </tr>  
				 <tr class="prtext" bgcolor="#ffffff" align="center">   
				 
				 <td width="30" height="25" align="left"><b>No</b></td>    
				 <td width="150" height="25" align="left"><b>Bulan/Tahun</b></td>      
				 <td width="60" align="right"><b>Kredit</b></td> 
				 <td width="80" align="right"><b>Debet</b></td>		 
				 <td width="80" align="right"><b>Saldo</b></td>    
			 <tr class="prtext" bgcolor="#ffffff" align="center">    
				<td colspan="6" >--------------------------------------------------------------------------------------------------------------------------------------------</td></tr>    
			
			<?php 
			$i=1;
			$saldo=0;		
			foreach ($statistik as $q){
				$sumpemasukan=$pemasukan+$q->pemasukan;
				$sumpengeluaran=$pengeluaran+$q->pengeluaran;
				$saldo=$saldo+$q->pemasukan-$q->pengeluaran;
				echo '<tr>
										<td>'.$i.'</td>  
										<td align="left">'.$q->date.'</td>  
										<td align="right">'.$q->pemasukan.'</td>
										<td align="right">'.$q->pengeluaran.'</td>
										<td align="right">'.$saldo.'</td>
					  </tr>'; 
					  if ($i==1) $firstday=$q->date;
					  $lastday=$q->date;
					  $i++;
			}
			
			
			
			?>
			<tr class="prtext" bgcolor="#ffffff" align="center">    
			<td colspan="6" >--------------------------------------------------------------------------------------------------------------------------------------------</td></tr>  
				<tr class="prtext" bgcolor="#ffffff" align="center" height="25">    
						 <td>&nbsp;</td>    
						 
						 <td align="left">Total </td> 
						 <td align="right"><b><?php echo $sumpemasukan ?></b></td>   						 
						 <td align="right"><b><?php echo $sumpengeluaran ?></b></td>   						 
						 <td align="right"><b><?php echo $saldo ?></b></td>    
					</tr>  
				<tr class="prtext" bgcolor="#ffffff" align="center">   
					<td colspan="6" >--------------------------------------------------------------------------------------------------------------------------------------------</td></tr>   
				</table>
			
			
			<?php } ?>
		
		
		
		Catatan Sementara:
		<table border="0" cellpadding="0" cellspacing="0">   
			<tbody>
				<tr class="prtext">  
					<td width="90"></td>
					<td>Total Pasien</td>      
					<td align="center" width="30"><b>=</b></td>    
					<td width="90"><?php 
					if ($tipe!='harian'){
								foreach ($pasienstatistik as $q){
								$pasien=$pasien+$q->total;
							}
						}
					echo $pasien;
					?> </td>  </tr>
				<tr class="prtext">      
					<td width="90"></td>
					<td>Total Pendapatan</td>      
					<td align="center" width="30"><b>=</b></td>    
					<td width="90"><?php echo  $sumpemasukan ?> </td>  </tr>
				<tr class="prtext">      
					<td width="90"></td>
					<td>Total Pengeluaran</td>      
					<td align="center" width="30"><b>=</b></td>    
					<td width="90"><?php echo  $sumpengeluaran?> </td>  </tr>
				<tr class="prtext">      
				<td width="90"></td>
						<td>Total Saldo</td>      
						<td align="center" width="30"><b>=</b></td>    
						<td width="90"><b><?php echo  $saldo ?></b></td>  </tr>
			</tbody></table>
	</td>
	
	<table border="0" cellpadding="0" cellspacing="0">    
		<tbody>
			<tr>
				<td class="prtext" valign="top" width="550">     
		<td>    
		<td class="prtext" valign="top" align="center" width="200">      Malang, <?php echo date('d M Y')?>
			<br><br><br><br><br><br>______________________<br>drg. Nina Agustin</td></tr>    
			</tbody>
		</table>
	<script>
		document.getElementById("date").innerHTML='<?php echo "Tanggal $firstday Hingga $lastday" ?>';
	</script>

</table>
