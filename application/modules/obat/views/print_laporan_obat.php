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
				Laporan Obat Clinic<br><br>
				<br>
				<br>---------------------------------<br>
			</td>
		</table>	
		</br>
		<div class="prtitle" align="center">LAPORAN OBAT CLINIC 
		 <div id="date"> Tanggal <?php echo date('d M Y ', strtotime($start)).' hingga '.date('d M Y ', strtotime($end)); ?></div> 		
		</div>	
			<table cellpadding="0" cellspacing="0" border="0">  
			 <tr class="prtext" bgcolor="#ffffff" align="center">   
					<td colspan="6" >--------------------------------------------------------------------------------------------------------------------------------------------</td>
				 </tr>  
					 <td width="30" height="25"><b>No</b></td>    
					 <td width="80" align="left"><b>Nama Obat</b></td>    
					 <td width="80" align="left"><b>Status</b></td>    
					 <td width="200" align="left"><b>Keterangan</b></td>		 
					 <td width="80" align="right"><b>Stok Sebelumnya</b></td>    
					 <td width="80" align="right"><b>Stok</b></td>    
				<tr class="prtext" bgcolor="#ffffff" align="center"> 
					<td colspan="6" >--------------------------------------------------------------------------------------------------------------------------------------------</td>
				</tr>    
				
			<?php $i=0;
				//print_r($result);
				foreach($result as $row){
				 
					$i++; 
				echo '<tr>
						<td width="30" height="25"><b>'.$i.'</b></td>    
						<td width="80" align="left"><b>'.$row->nama.'</b></td>    
						<td width="80" align="left"><b>'.$row->status.'<b></td>		 
						<td width="200" align="left"><b>'.$row->keterangan.'</b></td>		 
						<td width="80" align="right"><b>'.$row->prevStok.'</b></td>   
						<td width="80" align="right"><b>'.$row->stok.'</b></td>   
					</tr>';
			} ?>
			
			 <tr class="prtext" bgcolor="#ffffff" align="center">   
					<td colspan="6" >--------------------------------------------------------------------------------------------------------------------------------------------</td>
				 </tr>  
			
			 <tr class="prtext" bgcolor="#ffffff" align="center">   
					<td colspan="6" >--------------------------------------------------------------------------------------------------------------------------------------------</td>
				 </tr>  
			
			
			
		
	<table border="0" cellpadding="0" cellspacing="0">    
		<tbody>
			<tr>
				<td class="prtext" valign="top" width="550">     
		<td>    
		<td class="prtext" valign="top" align="center" width="200">      Malang, <?php echo date('d M Y')?>
			<br><br><br><br><br><br>______________________<br>drg. Nina Agustin</td></tr>    
			</tbody>
		</table>
	

</table>

