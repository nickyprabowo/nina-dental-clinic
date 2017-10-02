<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Daftar Antrian
          </h1>
			 <button type="button" class="btn-tambah btn btn-primary btn-flat" onclick="listpasien();" data-toggle="modal"  data-target="#modal"><i class="fa fa-fw fa-plus"></i> Tambah</button>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa  fa-eye"></i> Antrian</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
          <div class="box box-solid">
            <!--<div class="box-header">
              <h3 class="box-title">Daftar Dokter</h3>
              <button type="button" class="btn btn-primary"><i class="fa fa-fw fa-plus"></i> Tambah</button>
            </div><!-- /.box-header -->
            <div class="box-body">
			  <div id="list">
                  <?php 
					$kasir->viewantrian($antrian);
				?>              
             </div>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	 
	
      <!-- Modal -->
      <div class="modal " id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Detil Pasien</h4>
            </div>
            <div class="modal-body">
					<div id="mod-content">
				</div>
            </div>
				<div class="modal-footer">
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
	  
	
	  <script>
		function cekobat(i){
			var sum=document.getElementById("hideobat_"+i);
		
			if (document.getElementById('obat_'+i).value!=0){
				sum.style.display = '' ;
				jumlahobat(i);
			}
			
			else sum.style.display = "none";		
		}
	
		function getharga(i){
			var a=i.options[i.selectedIndex].innerHTML;
			var b=a.split(" ").length;
			b=b-1;
			a=a.split(" "); 
			return a[b];
		}
	
		function hargatindakan(i,element){
			var a=getharga(i);
			document.getElementById(element).value=a; 
		}
		
		function jumlahobat(id){
			var i= document.getElementById('obat_'+id);
			var a=getharga(i); 
			calcobat(a,id)
			
		}
		
		function calcobat(a,id){
			var jumlah= document.getElementById("jumlahobat_"+id).value;
			var harga=a*jumlah;
			document.getElementById("hargaobat_"+id).value=harga;
		}
	
	
		function getfoto() 
			{
				var fileinput = document.getElementById("foto");
				fileinput.click();
			}
	  
		function callwebcam(){
			$('#modal').modal('show'); 
				var address="<?php echo base_url();?>cam";
				var element="webcam";
				sendajax(null,address,element,null);
			}
			
		var handleFileSelect = function(evt) {
				var files = evt.target.files;
				var file = files[0];
				if (files && file) {
					var reader = new FileReader();
					reader.onload = function(readerEvt) {
						var binaryString = readerEvt.target.result;
						document.getElementById("foto1").value=btoa(binaryString);
						document.getElementById('results').innerHTML='<img src="data:image/jpeg;base64,'+btoa(binaryString)+'" style="widht:100px;height:100px"/>' 
					};
					reader.readAsBinaryString(file);
				}
			};
		
			function kredit(i){
				if(i=='Kredit'){
					document.getElementById('kredit').innerHTML="</br><div class=\"row\"><div class=\"form-group col-sm-12\"><label for=\"inputEmail3\" class=\"col-sm-2 control-label\">Keterangan Kredit</label><div class=\"col-sm-4\"><input id=\"keterangankredit\" type=\"text\" class=\"form-control\"></div><div class=\"form-group\"><label for=\"inputEmail3\" class=\"col-sm-2 control-label\">Jumlah Kredit</label><div class=\"col-sm-4\"><input id=\"JumlahKredit\" type=\"number\" class=\"form-control\"></div></div>";
				}
				else document.getElementById('kredit').innerHTML=''; 
				
			}
			
			
			function tambahform(id) {
				$.ajax({
						   type:"POST",
						   url: "<?php echo base_url();?>kasir/getlist"+id,
						   data: $('[id^="'+id+'_"]').last(),
						   success:function(msg){
							  $(".form"+id).append(msg);
								}
							});		
					
				}
				
			function minform(id) {
				$('#' + id).parent().remove();
			}
				
			function listpasien(){	
				var address="<?php echo base_url();?>kasir/listpasien";
				var element="mod-content";
				sendajax(null,address,element)
			}
					
			function proses(id,stat,idrek){
				var data1={
					'id_antrian':id,
					'status':stat,
					'id_rek':idrek
				}
				var address="<?php echo base_url();?>kasir/proses";
				var element="mod-content";
				sendajax(data1,address,element);
			}
					
			function hapusantri(id,stat){
				if (confirm('Apakah anda yakin akan menghapus antrian ini?')){
					var data1={
						'hapus': true,
						'id' : id,
					}
					var address="<?php echo base_url();?>kasir/pushantrian";
					var element="list";
					var notif="Antrian Berhasil Dihapus";
					sendajax(data1,address,element,notif);
					
				}
			}
			
			function editantrian(id,idrek){
				var data1={
					'id_antrian' 	 : id,
					'id_rekam_medik' : idrek
				}
				var address="<?php echo base_url();?>kasir/editantrian";
				var element="mod-content";
				sendajax(data1,address,element,null);
			}
			
			function antri(){
				var data1 = { 
							'status' :  $('#stat').val(),
							'id_antrian': $('#id_antrian').val(),
							'id_rekam_medik': $('#id_rekam_medik').val(),
							'karyawan' : []
						}
						for (var i=1;i<=$('[id^=sumkaryawan]').last().val();i++){
								data1['karyawan'].push($('#karyawan_'+i).val());
						}	
				return data1;		
			}
			
			function onprogress(){
						var data1 = { 
							'status' :  $('#stat').val(),
							'diagnosa' : [],
							'tindakan' : [],
							'hargatindakan' : [],
							'resep' :  $('#resep').val(),
							'obat' : [],
							'foto1' : $('#foto1').val(),  
							'jumlahobat' : [],
							'hargaobat' : [], 
							'id_antrian': $('#id_antrian').val(),
							'id_rekam_medik': $('#id_rekam_medik').val()
						};
							for (var i=1;i<=$('[id^=sumobat]').last().val();i++){
							data1['obat'].push($('#obat_'+i).val());
							data1['jumlahobat'].push($('#jumlahobat_'+i).val());
							data1['hargaobat'].push($('#hargaobat_'+i).val());
							}
							for (var i=1;i<=$('[id^=sumdiagnosa]').last().val();i++){
								data1['diagnosa'].push($('#diagnosa_'+i).val());
							}
							for (var i=1;i<=$('[id^=sumtindakan]').last().val();i++){
								data1['tindakan'].push($('#tindakan_'+i).val());
								data1['hargatindakan'].push($('#hargatindakan_'+i).val());
							}	
				return data1;
				
			}
			
			function prosesedit(){
					var datakaryawan = antri();
					var diagnosaresep = onprogress();
					var dataedit = {
						 datakaryawan,
						 diagnosaresep
						}
					var data= dataedit;
						var element="list";
						var notif="Antrian Berhasil di Edit"; 
				var address="<?php echo base_url();?>kasir/prosesedit"; 
				sendajax(data,address,'list',notif);
			}
					
			function pembayaran(){
					if (confirm('Periksa Kembali Apakah Data sudah Benar?')){
							var data1=[];
							data1= {
								'status' :  $('#stat').val(),
								'id_antrian': $('#id_antrian').val(),
								'id_rekam_medik': $('#id_rekam_medik').val(),
								'pembayaran' : $('#pembayaran').val(),
									}
							if ($('#pembayaran').val()=='Kredit'){
								if ($('#JumlahKredit').val() !== ''){
									data1['keterangankredit'] = $('#keterangankredit').val();
									data1['jumlahkredit'] = $('#JumlahKredit').val();
								}
								else {	
									toastr.error('jumlah kredit harus berupa angka');
									data1=null;
								}
							}
						return data1;
					}
			}
			
			function pushantrian(id,id_dok){
				if (id!=null){
					var data1 = { 
						id:id,
						id_dok:id_dok
					}
				}
				else {
					if ($('#stat').val()=='Antri'){
						var data1=antri();
						}
					else if ($('#stat').val()=='On Progress'){
							var data1=onprogress();
						}
					else {
							var data1=pembayaran();
						}
				}
				var address="<?php echo base_url();?>kasir/pushantrian/";
				var element="list";
				var notif;
				if (data1['notif']==null){
					notif='Antrian Berhasil di Proses';}
				sendajax(data1,address,element,notif);
				
			}
			
			function detailrekam(id,idrek){
				var data1={
					'id_antrian': id,
					'id_rekam_medik': idrek
					}
				var address ="<?php echo base_url();?>kasir/viewdetailrekam";
				var element="mod-content";
				sendajax(data1,address,element,null);
			}
			
			function sendajax(data1,address,element,notif,tipe){
				loading(element);
				 
				$.ajax({ 
					   type:"POST",
					   url: address,
					   data: data1,
					   dataType:tipe, 
					   success:function(msg){
						 
						   $('#'+element).html(msg);
						   if (notif!=null){
								toastr.success(notif);
								}
							return true;
							}
						});
			}
			
			</script>