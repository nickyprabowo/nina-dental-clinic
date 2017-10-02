<?php 
$a=new DateTime(date("Y-m-d"));
foreach ($pasien as $row) {?>
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
			<td valign="top" width="200">
				NOTA BIAYA PERIKSA POLI GIGI </br></br>
				<br>-----------------------------------<br>
			</td>
		</table>
		</br>
	    <table cellpadding="0" cellspacing="1" border="0">    
			 <tr class="prtext">     
					 <td width="120">Nama Pasien </td> <td width="350">: <?php echo $row->nama_pasien?></td>     
					 <td width="100">Umur  </td> <td width="150">:
					 <?php 
					 $b=new DateTime($row->tgllagir_pasien);
					 $umur=$a->diff($b);
					 echo '<span>'.$umur->y.' Tahun '.$umur->m.' Bulan</span>';
					 ?>				 
					 </td>
			 </tr>   
			 <tr class="prtext">
				 <td>Alamat </td>   <td>: <?php echo $row->alamat ?></td>    
				 <td>Jenis Kelamin</td> <td>: <?php echo $row->jenis_kelamin ?></td></tr>  
		     <tr class="prtext">    
				   
				 <td>Id Rekam Medik</td> <td>: <?php echo $row->id_rekam_medik?> </td>  
				 <td>Tanggal </td>  <td>: <?php echo date('d M Y',  strtotime($row->tanggal)) ?>&nbsp;</td>  </tr>   
	    </table>   
 <table cellpadding="0" cellspacing="0" border="0">  
	 <tr class="prtext" bgcolor="#ffffff" align="center">   
			<td colspan="6" >--------------------------------------------------------------------------------------------------------------------------------------------</td>
		 </tr>  
		 <tr class="prtext" bgcolor="#ffffff" align="center">   
		 <td width="50" height="25"><b>NO</b></td>    
		 <td width="240" align="left"><b>KETERANGAN</b></td>    
		 <td width="60" align="right"><b>HARGA</b></td> 
		 <td width="80" align="right"><b>QY</b></td>		 
		 <td width="80" align="right"><b>TOTAL</b></td>    
	 <tr class="prtext" bgcolor="#ffffff" align="center">    
		<td colspan="6" >--------------------------------------------------------------------------------------------------------------------------------------------</td></tr>    
	
	<?php $i=1;
	 foreach ($row->tindakan as $q) {
	 echo '<tr class="prtext" bgcolor="#ffffff" align="center">     
				 <td height="20">'.$i.'</td>    
				 <td align="left">'.$q->nama_tindakan.'</td>     
				 <td align="right">'.$q->biaya.'</td>
				 <td align="right"></td>       
				 <td align="right">'.$q->biaya.'</td>      
			 </tr> ';
			 $i++;
	}
	foreach ($row->obat as $q) {
	 echo '<tr class="prtext" bgcolor="#ffffff" align="center">     
				 <td height="20">'.$i.'</td>    
				 <td align="left">'.$q->nama_obat.'</td>     
				 <td align="right">'.$q->harga.'</td>
				 <td align="right">'.$q->jumlah.'</td>       
				 <td align="right">'.$q->hargatotal.'</td>      
			 </tr> ';
			 $i++;
	}
	?>	
	 <tr class="prtext" bgcolor="#ffffff" align="center">    
		<td colspan="6" >--------------------------------------------------------------------------------------------------------------------------------------------</td></tr>  
	 <tr class="prtext" bgcolor="#ffffff" align="center" height="25">    
		 <td>&nbsp;</td>    
		 <td colspan="2" align="right">Total Biaya </td>   
		 <td>&nbsp;</td>    
		 <td align="right"><b><?php echo $row->biaya ?></b></td>    
	 </tr>  
 <tr class="prtext" bgcolor="#ffffff" align="center">   
 <td colspan="6" >--------------------------------------------------------------------------------------------------------------------------------------------</td></tr>   
 </table>  
 <table cellpadding="0" cellspacing="0" border="0">   
	 <tr class="prtext">   
		 <td align="center" width="200">Pasien</td>     
		 <td align="center" width="300">Dokter</td>     
		 <td align="center" width="200">&nbsp;</td>     
	</tr>   
	<tr class="prtext">    
	 <td align="center"></br></br></br>______________________</td>  
	 <td align="center"></br></br></br>(drg. Nina Agustin)</td>  
	 <td align="center"></br></br></br> Malang, <?php echo date('d M Y')?></td>  
	 
	 </tr>   
 </table>
 </td>
 </table>
 <br><br>  	
<?php } ?>