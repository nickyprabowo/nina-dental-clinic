


 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/morris.css">
	  <div class="content-wrapper" id="keuangan">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Laporan Keuangan 
          </h1>
				<button type="button" class="btn-tambah btn btn-primary btn-flat"  data-toggle="modal"  data-target="#modal"><i class="fa fa-fw fa-plus"></i> Input Pengeluaran</button>
				<button type="button" class="btn-tambah btn btn-primary btn-flat"  data-toggle="modal"  data-target="#modal1"><i class="fa fa-fw fa-plus"></i> Input Excel Pengeluaran</button>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa  fa-user-md"></i> Keuangan</a></li>
          </ol>
        </section>

        <!-- Main content -->
		
		
	<section class="content">
		<div class="row">
          <!-- Your Page Content Here -->
		 <div class="col-md-12">
          <div class="box box-primary">
            <div id="data" class="box-body">
				 <div class="box-body">
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
						<div class="chart" id="chart">
							<canvas id="lineChart" style="height:250px"></canvas>
						</div>
					</div>	
				</div><!-- /.box -->
				</div><!-- /.box-body -->
			</div><!-- /.box -->
			
			<div class="col-md-6">
              <div class="box box-info">
				  <div class="box-header with-border">
					<h3 class="box-title">Laporan Harian</h3>									
					<button class="btn btn-primary btn-flat" onclick="window.open('<?php echo base_url()?>keuangan/printlaporan/harian/'+$('#setdate').val()+'/'+$('#from').val()+'/'+$('#till').val(),'printlaporan','scrollbars=yes,status=no,menubar=no,width=800,height=400')" style="float:right;"><i class="fa fa-fw fa-print"></i></button>
					<button class="btn btn-primary btn-flat" onclick="window.open('<?php echo base_url()?>keuangan/excel/harian/'+$('#setdate').val()+'/'+$('#from').val()+'/'+$('#till').val(),'printlaporan','scrollbars=yes,status=no,menubar=no,width=800,height=400')" style="float:right;"><i class="fa fa-fw fa-file-excel-o"></i></button> 
				  </div><!-- /.box-header -->
                <!--<div class="box-header with-border">
                  <h3 class="box-title">Daftar Pasien</h3>
                </div>-->
				<div id="report" class="box-body">
             
                </div><!-- /.box-body -->
              </div><!-- /. box -->
            </div>
			
			
		<div class="col-md-6">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Detail Perlaporan</h3>
				<button id="buttonbulan"	class="btn btn-primary btn-flat" onclick="window.open('<?php echo base_url()?>keuangan/printlaporan/bulanan/'+$('#setdate').val()+'/'+$('#from').val()+'/'+$('#till').val(),'printlaporan','scrollbars=yes,status=no,menubar=no,width=800,height=400')" style="float:right;" disabled><i class="fa fa-fw fa-print"></i></button>
              </div><!-- /.box-header -->
				<!-- form start -->
				<div id="perreport" class="box-body">
					<label>Klik detil salah satu pasien</label>
              </div>
            </div><!-- /.box -->
          </div>
			
			</div><!-- class row -->
			
			
			
          </div>
        </section>
	  
	  <div class="modal" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Input Pengeluaran</h4>
            </div>
            <div class="modal-body">
				<div id="mod-content">
				<div class="form-horizontal" >
				<div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Keterangan Pengeluaran</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="ket" id="ket" required> 
                    </div>
                  </div>
				  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Jumlah</label>
                    <div class="col-sm-10">
                      <input type="number" class="form-control" name="jumlah" id="jumlah" required>
                    </div>
                  </div>
				</div>
            </div>
            <div class="modal-footer">
             <div class="box-footer">
					
                  <input type="submit" onclick="inputpengeluaran();" data-dismiss="modal"    class="btn btn-flat btn-primary btn-block">
					
                </div>
				</div>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
	  
	  
	  <div class="modal" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Input Pengeluaran</h4>
            </div>
            <div class="modal-body">
				
				<div id="mod-content">
				Mohon Diperiksa kembali apakah file excel telah sesuai aturan seperti pada gambar dibawah ini!!!
				&nbsp; <img src="<?php echo base_url()?>assets/img/aturan.jpg" style="height:250px;">
				</br>
				<div class="form-horizontal">
					Mohon Diperiksa kembali apakah file excel telah sesuai aturan seperti pada gambar diatas ini!!!
						<form  class="form-control" enctype="multipart/form-data" id="myForm" method="POST" action="#" onSubmit="return viaAjax();">
							  <input  type="file" id="f-file" name="file"/>
					</div>
            </div>
			 </div>
            <div class="modal-footer">
             <div class="box-footer">					
                  <input type="submit" value="submit"   class="btn btn-flat btn-primary btn-block">
					</form>  
                </div>
				</div>
           
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
	  
	  
	  <div class="modal" id="modalrekam" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Detail Rekam Medik</h4>
            </div>
            <div class="modal-body">
				<div id="modal-content">
				
            </div>
            
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
	   
	  
		<script>
		
		
		function getreport(i){
			$.ajax({
					   type:"POST",
					   url: '<?php echo base_url();?>keuangan/viewreport',
					   data: i,
					   success:function(msg){
								 var data = JSON.parse(msg);
								 $('#report').html(data[0]);
								 $("#day").DataTable({
										   "ordering": false, 
										   "searching": true, 
										   "info":     false});
								 $('#perreport').html(data[1]);
								 $("#MY").DataTable({
										  
										   "ordering": false, 
										   "searching": true, 
										   "info":     false});
							}
						});
		}
		
		
		
		function inputpengeluaran(){
			var data1={
				'ket' :  $('#ket').val(),
				'jumlah' :  $('#jumlah').val()
			}
			
			$.ajax({
					   type:"POST",
					   url: '<?php echo base_url();?>keuangan/inputpengeluaran',
					   data: data1,
					   success:function(msg){
								toastr.success('Pengeluaran berhasil Ditambahkan');
								getstatistik();
								document.getElementById("ket").value='';
								document.getElementById("jumlah").value='';
								getstatistik();
							}
						});
			
		}
		
		var areaChartOptions = {
          showScale: true,
          scaleShowGridLines: true,
          scaleGridLineColor: "rgba(0,0,0,.05)",
          scaleGridLineWidth: 1,
          scaleShowHorizontalLines: true,
          scaleShowVerticalLines: true,
          bezierCurve: true,
          bezierCurveTension: 0.3, 
          pointDot: true,
          pointDotRadius: 4,
          pointDotStrokeWidth: 1,
          pointHitDetectionRadius: 20,
          datasetStroke: true,
          datasetStrokeWidth: 2,
          datasetFill: true, 
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li onhover=\"aaa('<%=datasets[i].label%>');\"><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%> <%}%></li><%}%></ul>",
		  multiTooltipTemplate: "<%= datasetLabel %> - <%= value %>",
          maintainAspectRatio: true,
          responsive: true
        }; 

		function detaildate(i){
			 alert(i);
		 }
		
		function getstatistik(){
			loading('lineChart');
			var data1={
				'type' :  $('#setdate').val(),
				'from' :  $('#from').val(),
				'till' :  $('#till').val()
			}
		$.ajax({
					   type:"POST",
					   url: "<?php echo base_url();?>keuangan/chart",
					   data: data1,
					   success:function(msg){
							 var data = JSON.parse(msg);
							 var datastatis= { 
	 						 labels: data[0],
											  datasets: [
												{
												  label: "Pemasukan",
												  fillColor: "rgba(210, 214, 222, 1)",
		 										  strokeColor: "rgba(60,141,188, 1)",
												  pointColor: "blue",
												  pointStrokeColor: "#c1c7d1",
												  pointHighlightFill: "#fff",
												  pointHighlightStroke: "rgba(220,220,220,1)",
												  data: data[1]
												},
												
												{
												  label: "Pengeluaran",
												  fillColor: "rgba(60,141,188,0.9)",
												  strokeColor: "rgba(255,0,0,0.8)",
												  pointColor: "red",
												  pointStrokeColor: "white",
												  pointHighlightFill: "#fff",
												  pointHighlightStroke: "rgba(60,141,188,1)",
												  data: data[2]
												}
											]
							 };
								viewchart(datastatis);
								getreport(data1);
							}
						});
		
			}
			
		
		var htmlForGraph='<canvas id="lineChart" style="height:250px"></canvas>';
	
		function viewchart(datastatis){
				$('#lineChart').remove();
				$('#chart').append(htmlForGraph);
				var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
				var lineChart = new Chart(lineChartCanvas);
				var lineChartOptions = areaChartOptions;
				lineChartOptions.datasetFill = false;
				lineChart.Line(datastatis, lineChartOptions);
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
				$('#buttonbulan').prop('disabled', true);
                d.setDate(d.getDate()-15);
            }
            else if (q==2){
                var type={ 
                        0:"mm-yyyy",
                        1:"months", 
                };
                d.setDate(d.getDate()-122);  
				 $('#buttonbulan').removeAttr("disabled");
            }
			
			else {var type={ 
                        0:"yyyy",
                        1:"years", 
                };
					d.setDate(d.getDate()-366); 
					 $('#buttonbulan').removeAttr("disabled");
				}
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
			getstatistik();
         }
	
		
		$( document ).ready(function() {
			setdate(1);
		});
		
		
		///uploading file excel
		
		function viaAjax(){ 
			 var formdata = new FormData();      
			 var file = $('#f-file')[0].files[0];
			  formdata.append('fFile', file);
			  $.each($('#myForm').serializeArray(), function(a, b){
				formdata.append(b.name, b.value);
			  });
			  $.ajax({url: '<?php echo base_url()?>keuangan/exceldatatrain',
				data: formdata,
				processData: false,
				contentType: false,
				type: 'POST',
				beforeSend: function(){
				  // add event or loading animation
				},
				success: function(ret) {
				  console.log(ret); // get return (if success) here
				}
			  });
			  document.getElementById("f-file").value='';
			  $('#modal1').modal('hide');
			  getstatistik();
				return false; 
    }
	
	function detailrekam(id,idrek){
				loading('modal-content');
				var data={
					'id_antrian': id,
					'id_rekam_medik': idrek}
				$.ajax({
						   type:"POST",
						   url: "<?php echo base_url();?>kasir/viewdetailrekam",
							data: data,
						   success:function(msg){
							  $("#modal-content").html(msg);
						   }
					});	
				}
		
		
		
		</script>
		
		
		