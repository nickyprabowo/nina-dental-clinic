<!-- REQUIRED JS SCRIPTS -->


   
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url(); ?>assets/plugins/jQueryUI/jquery-ui.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- Moment -->
    <script src="<?php echo base_url(); ?>assets/plugins/daterangepicker/moment.min.js"></script>
    <!-- Datepicker -->
    <script src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Daterangepicker -->
    <script src="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- DataTables -->
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
	
	<script src="<?php echo base_url()?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="<?php echo base_url(); ?>assets/plugins/chartjs/Chart.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>assets/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>assets/js/app.min.js"></script>
    <!-- Vue -->
	 <script src="<?php echo base_url(); ?>assets/plugins/vue/vue.js"></script>
	  <!-- Vue Resource -->
	  <script src="<?php echo base_url(); ?>assets/plugins/vue/vue-resource.js"></script>
	  <!-- Vue App -->
	  <script src="<?php echo base_url(); ?>assets/js/app-vue.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
    <!-- Toastr -->
    <script src="<?php echo base_url(); ?>assets/plugins/toastr/toastr.min.js"></script>
	
	<div id="sendserver"></div>
    <script>

	
	// setInterval(function() {
				 // $.ajax({ 
									   // type:"POST",
									   // url: "<?php echo base_url()?>sendserver",
									   // data: null,
									   // success:function(msg){	 
												 // $('#sendserver').html(msg);
									   // }
								// });	
				// }, 1000 * 60 * 0.3);
	
	
    $("#calendar").datepicker();
		$(window).load(function() {
			$(".loader").fadeOut("slow");
		})
	
	
	function loading(i){		
		document.getElementById(i).innerHTML='<img src="<?php echo base_url()?>assets/img/loading_funny'+Math.floor((Math.random() * 4) + 1)+'.gif" style="display:block;margin:auto;overflow:hidden;max-width:500px;">';   
	}
	
	
    $(document).ready(function(){
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '30%' // optional
      });
      //antrian sortable
      //jQuery UI sortable for the antrian
      $(".antrian").sortable({
        placeholder: "sort-highlight",
        handle: ".handle",
        forcePlaceholderSize: true,
        zIndex: 999999
      });

    });
		
    $("#example2").DataTable(); 
		$("#antrian").DataTable(); 
		
		$("#antri1").DataTable({"order":[[0,"asc"]]});
        

    $('#tglLahirPasien').datepicker({format:'dd-mm-yyyy'});
    $('#tglKonsulPertama').datepicker({format:'dd/mm/yyyy'});
		$("#antri2").DataTable({order:[[0,"asc"]]});

    /* Date and time range */
    $('#reservationtime').daterangepicker({ timePickerIncrement: 30, format: 'YYYY-MM-DD'});  
        //-------------
        //- BAR CHART -
        //-------------
      <?php /*  var barChartCanvas = $("#barChart").get(0).getContext("2d");
        var barChart = new Chart(barChartCanvas);
        var barChartData = areaChartData;
        barChartData.datasets[1].fillColor = "#00a65a";
        barChartData.datasets[1].strokeColor = "#00a65a";
        barChartData.datasets[1].pointColor = "#00a65a";
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
      });*/ ?>
    </script>
    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
  </body>
</html>		