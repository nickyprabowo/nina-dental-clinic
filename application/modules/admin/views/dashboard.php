      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Here</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
          <div class="row">

            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="fa fa-wheelchair"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Kunjungan Hari Ini</span>
				  <span class="info-box-number"><?php 
					echo sizeof($harian);?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
			<div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-aqua">
                <span class="info-box-icon"><i class="fa fa-user"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Kunjungan bulan ini</span>
				  <span class="info-box-number"><?php echo sizeof($bulanan);?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
			<div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-aqua">
                <span class="info-box-icon"><i class="fa fa-users "></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Kunjungan tahun ini</span>
				  <span class="info-box-number"><?php echo sizeof($tahun);?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
           
		   <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-green">
                <span class="info-box-icon"><i class="fa fa-user-plus"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Jumlah Pasien Cabang</span>
                  <span class="info-box-number"><?php echo sizeof($pasien);?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

          <!-- =========================================================== -->
          
          <div class="row">
            <div class="col-md-8 col-sm-6 col-xs-12">
              <!-- TO DO List -->
              <div class="box box-primary">
                <div class="box-header">
                  <i class="ion ion-clipboard"></i>
                  <h3 class="box-title">Daftar lima Antrian terakhir</h3>
                  <div class="box-tools pull-right">
                    <ul class="pagination pagination-sm inline">
                     
                    </ul>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <ul class="antrian">
				  <?php $i=0;
				
					if (sizeof($harian)==0){
					echo '	<li>
								  <!-- drag handle -->
								  <span class="handle">
									<i class="fa fa-ellipsis-v"></i>
									<i class="fa fa-ellipsis-v"></i>
								  </span>
								
								  <span class="text">Belum ada Antrian Hari ini</span>
								
									</li>';
						
						
					}
					foreach ($harian as $row){
						if ($i<=4) {
							if ($row->foto==null) $row->foto='assets/img/unknown.jpg';
							echo '<li>
								  <!-- drag handle -->
								  <span class="handle">
									<i class="fa fa-ellipsis-v"></i>
									<i class="fa fa-ellipsis-v"></i>
								  </span>
								  <!-- number -->
								  <span class="number">'.$row->nomer_antrian.'</span>
								  <!-- checkbox -->
								
								  <!--- foto pasien ---->
								  <img class="img-circle" src="'.base_url().$row->foto.'">
								  <!-- todo text -->
								  <span class="text">'.$row->nama_pasien.'('.$row->status.')</span>
								  <!-- Emphasis label -->
								  <!-- General tools such as edit or delete-->
								  <div class="tools">
									<i class="fa fa-edit"></i>
									<i class="fa fa-trash-o"></i>
								  </div>
									</li>'; 
							}
						$i++;
					} 
					?>
                  </ul>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix no-border">
                  
                </div>
              </div><!-- /.box -->
            </div>
         
            <div class="col-md-4 col-sm-4 col-xs-12">
		    <div class="box box-widget">
                <div class='box-header with-border'>
                  <div class='user-block'>
                    <span class='username'><a href="#">Promosi Harian</a></span>
                    <span class='description'>Shared publicly - 7:30 PM Today</span>
				  </div><!-- /.user-block -->
                  <div class='box-tools'> 
                    <button class="btn btn-box-tool" onclick="changepromo();"><i class='fa fa-plus'></i></button>
					<input type="file" name="promo" id="promo" value="" style="display:none;" >
                  </div><!-- /.box-tools -->  
                </div><!-- /.box-header -->
                <div class='box-body' id="results">
                  <img class="img-responsive pad" src="<?php echo base_url()?>assets/foto/promo.jpg" alt="Promo">
                </div><!-- /.box-body -->
			</div><!-- /.box-body --> 
          </div><!-- /.box-body -->
        <div class="col-md-12 col-sm-4 col-xs-12"> 
		 <div class="callout callout-warning">
            <h4>Catatan!</h4>
            <p><b>Hasil Statistik ini</b> Tidak Menampilkan Data yang Kosong (Tidak ada pengunjung pada hari itu), periksa tanggal ketika memlihat hasil statistik</p>
          </div> 
        </div> 
		  
		  
		<div class="col-md-12 col-sm-4 col-xs-12">  
		     <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Statistik Pengujung</h3>
                  <div class="box-tools pull-right">
                    <div class="col-sm-2 date">
                        <select id="setdate" class="form-control" onchange="setdate(this.value);">
							<option value="1">Harian</option>
							<option value="2">Bulanan</option>
							<option value="3">Tahunan</option>
						</select>
                    </div> 
					<div class="col-sm-4 date">
                        <input type="text" class="form-control" id="from" required>
                    </div>
                    <div class="col-sm-4 date">
                        <input type="text" class="form-control"  id="till" required>
                    </div>
                 
				   <div class="col-sm-2 date">
						<button type="button" onclick="getstatistik();" class="btn btn-success">Lihat statistik</button>
					 </div>
                </div>
                <div class="box-body">
                  <div id="chart" class="chart">
                    <canvas id="barChart" style="height:230px"></canvas>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
		</div><!-- /.box -->
			  
			  
			</div><!-- /.box-body -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	  
	
	
	<script>
	
	var promo=document.getElementById("promo");
	function changepromo() 
	
		{
			var fileinput = promo;
			fileinput.click();
		}
			promo.addEventListener('change', function(evt) { 
					var files = evt.target.files;
					var file = files[0];
					if (files && file) {
						var reader = new FileReader();
						reader.onload = function(readerEvt) {
							var binaryString = readerEvt.target.result;
							var foto={'foto': btoa(binaryString)};
							$.ajax({
									   type:"POST",
									   url: '<?php echo base_url()?>admin/promo',
									   data: foto,
									   success:function(){
											document.getElementById('results').innerHTML='<img class="img-responsive pad" src="data:image/jpeg;base64,'+btoa(binaryString)+'" alt="Promo">'; 
												}
									});
							
						};
						reader.readAsBinaryString(file);
					}
				});  
	
	function showstatis(data){
			$('#barChart').remove();
			 $('#chart').append('<canvas id="barChart" style="height:230px"><canvas>');
			var barChartCanvas = $("#barChart").get(0).getContext("2d");
				var barChart = new Chart(barChartCanvas);
				var barChartData = data;
				var barChartOptions = {
				  //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
				  scaleBeginAtZero: true,
				  //Boolean - Whether grid lines are shown across the chart
				  scaleShowGridLines: true,
				  //String - Colour of the grid lines
				  scaleGridLineColor: "rgba(0,0,0,.05)",
				  //Number - Width of the grid lines
				  scaleGridLineWidth: 1,
				  //Boolean - Whether to show horizontal lines (except X axis)
				  scaleShowHorizontalLines: true,
				  //Boolean - Whether to show vertical lines (except Y axis)
				  scaleShowVerticalLines: true,
				  //Boolean - If there is a stroke on each bar
				  barShowStroke: true,
				  //Number - Pixel width of the bar stroke
				  barStrokeWidth: 2,
				  //Number - Spacing between each of the X value sets
				  barValueSpacing: 5,
				  //Number - Spacing between data sets within X values
				  barDatasetSpacing: 1,
				  //String - A legend template
				  legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
				  //Boolean - whether to make the chart responsive
				  responsive: true,
				  maintainAspectRatio: true
        };
        barChartOptions.datasetFill = false;
        barChart.Bar(barChartData, barChartOptions);
      }
	
	function getstatistik(){
		var data1={
			
			'type' :  $('#setdate').val(),
			'from' :  $('#from').val(),
			'till' :  $('#till').val()
		}
		$.ajax({
					   type:"POST",
					   url: "<?php echo base_url();?>admin/statistik",
					   data: data1,
					   success:function(msg){
							 var data = JSON.parse(msg);
							 var datastatis= { 
							 labels: data[0],
											  datasets: [
												{
												  label: "Electronics",
												  fillColor: "rgba(210, 214, 222, 1)",
												  strokeColor: "rgba(210, 214, 222, 1)",
												  pointColor: "rgba(210, 214, 222, 1)",
												  pointStrokeColor: "#c1c7d1",
												  pointHighlightFill: "#fff",
												  pointHighlightStroke: "rgba(220,220,220,1)",
												  data: data [1]
												}
											]
							 };
							showstatis(datastatis);
							}
						});
		
	}
	
	
	function setdate(q){
		
			$('#from').datepicker('remove');
			$('#till').datepicker('remove');
            var d=new Date();
            if (q==1){
                var type={ 
                        0:"dd-mm-yyyy",
                        1:"days", 
                };
                d.setDate(d.getDate()-15);
            }
            else if (q==2){
                var type={ 
                        0:"mm-yyyy",
                        1:"months", 
                };
                d.setDate(d.getDate()-122);  
            }
			
			else {var type={ 
                        0:"yyyy",
                        1:"years", 
                };
					d.setDate(d.getDate()-366); }
            viewdate(d,type);
         }

         function viewdate(d,type){
            $('#from').datepicker({
                        format: type[0],
						minViewMode:type[1]
                    });
			$('#from').datepicker('setDate',d);
            $('#till').datepicker({
                       format: type[0],
						minViewMode:type[1]
                    });
			$('#till').datepicker('setDate', new Date());
			getstatistik()
         }
	
	
	$( document ).ready(function() {
			setdate(1);
		});
	
	</script>
	  