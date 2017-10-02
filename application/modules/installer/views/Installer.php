<body class="hold-transition login-page" style="padding-top:40px;">
  <section class="invoice" style="width:700px; margin:auto; ">
          <!-- title row -->
          <div class="row">
            <div class="col-xs-12">
				<div style="margin:auto;"><img src="<?php echo base_url()?>assets/img/logoninadentalcare.png" style="width:140px;height:84px;padding-top:5px;border-right:5px;"> </div>
				
              <h2 class="page-header">
               Instalation Information System of NinaDental Care
              </h2>
            </div><!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row invoice-info">
            
			<?php if ($finish==false){
					echo '		<div class="col-sm-12 col-xs-12 invoice-col">
								  Selamat datang di sistim informasi Ninadental Care. Anda telah mencapai proses akhir dari keseluruhan proses instalasi ini. 
								  Untuk menyelesaikan dibutuhkan sedikit lagi informasi dari server utama. Untuk itu segera hubungi admin Sistim ini. Berikut Form yang perlu anda isi sesuai data yang telah diberikan.
								   
								</div><!-- /.col -->
								<div class="col-xs-12">
								<h2 class="page-header">
									Informasi Yang Dibutuhkan
								  </h2>
								  </div>
								 <div class="box-body" id="installer">';
									$this->load->view($form);
					echo '</div>';
				}
			else { echo '	<div class="col-sm-12 col-xs-12 invoice-col">
								  Selamat, aplikasi telah dapat digunakan sesuai dengan mestinya. Mohon tunggu beberapa menit selama proses instalasi sedang berlangsung.
								  Dan kami selaku tim www.Ministun.com mengucapkan terima kasih yang sebesar-besarnya telah mempercayakan kami dalam pembuatan sistim informasi ini dan memohon maaf 
								  jika terdapat kesalahan atau kekurangan pada pembuatan aplikasi ini. 
								</div><!-- /.col -->
								<div class="col-sm-12 col-xs-12 invoice-col" margin="auto">
								 <img src='.base_url().'/assets/img/truestory.png width="250px" height="250px">
								</div><!-- /.col -->
								<script>
													setInterval(function() {
														window.location.replace(\''.base_url().'\');
														}, 1000 * 30 * 1);</script>
								
								
								';
					}
				?>
			
			  
			</div><!-- /.col -->  
		</div>
        </section>
		
<script>
	function install(){
			
				 var posting ={
					 name: $('#name').val(),
					 username: $('#username').val(),  
					 password: $('#passwd').val()
				 };
				 loading('installer');
				var address="<?php echo base_url();?>installer/installget";
				$.ajax({ 
					   type:"POST",
					   url: address,
					   data: posting, 
					   success:function(msg){
						  $('#installer').html(msg);
					   }
					});
			
			
	}
	
	function dataclinic(){
				 var posting ={
					 namaclinic: $('#namaclinic').val(),
					 alamatclinic: $('#alamatclinic').val()
				 };
				 loading('installer');
				var address="<?php echo base_url();?>installer/dataclinic";
				$.ajax({ 
					   type:"POST",
					   url: address,
					   data: posting, 
					   success:function(msg){
						  $('#installer').html(msg);
					   }
					});
			
			
	}

</script>