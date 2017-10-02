	<div id="my_camera"></div>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/webcam.js"></script>
	
	<!-- Configure a few settings and attach camera -->
	<script language="JavaScript">
		Webcam.set({
			width: 320,
			height: 240,
			dest_width: 640,
			dest_height: 480,
			image_format: 'jpeg',
			jpeg_quality: 90
		});
		Webcam.attach( '#my_camera' );
	</script>
	<div id="results"></div>
	<!-- A button for taking snaps -->
	<form>
		<input type=button value="Take Large Snapshot" onClick="take_snapshot()">
	</form>
	
	<!-- Code to handle taking the snapshot and displaying it locally -->
	<script language="JavaScript">
		function take_snapshot() {
			// take snapshot and get image data
			Webcam.snap( function(data_uri) {
				if (document.getElementById('results')) {document.getElementById('results').innerHTML = '<img src="'+data_uri+'" style="widht:100px;height:100px"/>';}
				else {document.getElementById('fotoedit').value= data_uri;}
				var raw_image_data = data_uri.replace(/^data\:image\/\w+\;base64\,/, '');
				document.getElementById('foto1').value = raw_image_data;
			} );
		}
	</script>