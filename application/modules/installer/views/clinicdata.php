				<div class="col-sm-12 col-xs-12 invoice-col">
									Isikan data Clinic pada Form dibawah ini
				
				<div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Nama clinic</label>
                    <div class="col-sm-10">
                      <input class="form-control" name="namaclinic" id="namaclinic" required="" type="text" value="<?php echo $nama?>">
                    </div>
                  </div>
				  	</br>
				  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Alamat Clinic</label>
                    <div class="col-sm-10">
                      <input class="form-control" name="alamatclinic" id="alamatclinic" required="" type="text" value="<?php echo $alamat?>">
                    </div>
                  </div> 
					</br>
				  
				  <div class="row">
					<div class="col-xs-8">
					
					</div><!-- /.col -->
					<div class="col-xs-4">
					  <button onclick="dataclinic();" class="btn btn-primary btn-block btn-flat">Tambahkan</button>
					</div><!-- /.col -->
				  </div>