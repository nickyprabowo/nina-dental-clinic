

<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" id="karyawan">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Karyawan
          </h1>
          <?php if( $this->session->role == 'superuser' ) { ?>

           <button type="button" class="btn-tambah btn btn-primary btn-flat" data-toggle="modal" data-target="#modalKaryawan"><i class="fa fa-fw fa-plus"></i> Tambah</button>

		  <?php } ?>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa  fa-user-md"></i> Karyawan</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
          <div class="box box-solid">
            <div id="data" class="box-body">
            	<input type="text" class="searchTable form-control" v-model="search" placeholder="Search Something . . .">

              <table id="tabel-karyawan" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th v-on:click="sortBy('nama')">Nama</th>
                    <th v-on:click="sortBy('harga')">Alamat</th>
                    <th v-on:click="sortBy('stok')">Telepon</th>
                    <th>Profesi</th>
                    <th>SIP</th>
                    <th>Peran</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="karyawan in paginatedItems | orderBy sortKey reverse" track-by="$index">
                    <td v-text="$index + 1 + (current_page * per_page)"></td>
                    <td>{{ karyawan.nama }}</td>
                    <td>{{ karyawan.alamat }}</td>
                    <td>{{ karyawan.telepon }}</td>
                    <td>{{ karyawan.profesi }}</td>
                    <td>{{ karyawan.SIP }}</td>
                    <td>{{ karyawan.privilege }}</td>
                    <td class="text-center">
                    	<?php if( $this->session->role == 'superuser' ) { ?>
                    	<button type="button" class="btn btn-sm bg-purple btn-flat" @click="settingKaryawan(karyawan)" ><i class="fa fa-fw fa-gear"></i> Setting</button>
                    	<?php } ?>
                        <button type="button" class="btn btn-sm bg-olive btn-flat" @click="viewKaryawan(karyawan)" ><i class="fa fa-fw fa-search"></i> Detil</button>

                        <?php if( $this->session->role == 'superuser' ) { ?>
                        <button type="button" class="btn btn-sm bg-orange btn-flat" @click="editKaryawan(karyawan,$index)"><i class="fa fa-fw fa-edit"></i> Ubah</button>
						
                        <button type="button" class="btn btn-sm bg-maroon btn-flat" @click="hapus(karyawan)" ><i class="fa fa-fw fa-remove"></i> Hapus</button>
                        <?php } ?>
                    </td>
                  </tr>
                </tbody>
              </table>
              <ul class="pagination">
                <li v-for="n in Math.ceil(karyawan.length/per_page)" @click="current_page = $index" v-bind:class="{'active': $index === current_page}">
                  <a href="#">{{ $index + 1 }}</a>
                </li>
              </ul>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </section><!-- /.content -->
        <!-- Modal Tambah Karyawan-->
	    <div class="modal fade modal-default" id="modalKaryawan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	        <div class="modal-dialog">
	          <div class="modal-content">
	            <div class="modal-header">
	              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	              <h4 class="modal-title">Tambah Karyawan</h4>
	            </div>
	            <form @submit.prevent="onSubmit" class="form-horizontal">
	            <div class="modal-body">
	                  <div class="form-group">
	                    <label for="nama-obat" class="col-sm-2 control-label">Nama</label>
	                    <div class="col-sm-10">
	                      <input type="text" class="form-control" id="namaKaryawan" placeholder="nama karyawan" v-model="newKaryawan.nama" required>
	                    </div>
	                  </div>
	                  <div class="form-group">
	                    <label for="alamat" class="col-sm-2 control-label">Alamat</label>
	                    <div class="col-sm-10">
	                      <input type="text" class="form-control" id="alamat" placeholder="alamat" v-model="newKaryawan.alamat" required>
	                    </div>
	                  </div>
	                  <div class="form-group">
	                    <label for="tempat_lahir" class="col-sm-2 control-label">Tempat Lahir</label>
	                    <div class="col-sm-10">
	                      <input type="text" class="form-control" id="tempat_lahir" placeholder="tempat lahir" v-model="newKaryawan.tempat_lahir" required>
	                    </div>
	                  </div>
	                  <div class="form-group">
	                    <label for="tgl_lahir" class="col-sm-2 control-label">Tgl Lahir</label>
	                    <div class="col-sm-10">
	                      <input type="date" class="form-control" id="tgl_lahir" placeholder="tgl lahir" v-model="newKaryawan.tgl_lahir" required>
	                    </div>
	                  </div>
	                  <div class="form-group">
	                    <label for="jenis_kelamin" class="col-sm-2 control-label">Jenis Kelamin</label>
	                    <div class="col-sm-10">
	                      <select class="form-control" name="jeniskelamin" id="jenis_kelamin" v-model="newKaryawan.jenis_kelamin" required>
	                      	<option></option>
	                        <option>Laki-laki</option>
	                        <option>Perempuan</option>
	                      </select>
	                    </div>
	                  </div>
	                  <div class="form-group">
	                    <label for="telepon" class="col-sm-2 control-label">Telepon</label>
	                    <div class="col-sm-10">
	                      <input type="number" class="form-control" id="telepon" placeholder="telepon" v-model="newKaryawan.telepon" required>
	                    </div>
	                  </div>
	                  <div class="form-group">
	                    <label for="profesi" class="col-sm-2 control-label">Profesi</label>
	                    <div class="col-sm-10">
							<select v-model="newKaryawan.profesi" required>
								<option></option>
							    <option v-for="option in options" v-bind:value="option.id">
							      {{ option.nama }}
							    </option>
							</select>
	                    </div>
	                  </div>
	                  <div class="form-group">
	                    <label for="sip" class="col-sm-2 control-label">SIP</label>
	                    <div class="col-sm-10">
	                      <input type="text" class="form-control" id="sip" placeholder="sip" v-model="newKaryawan.SIP" required>
	                    </div>
	                  </div>
	                  <div class="form-group">
	                    <label for="email" class="col-sm-2 control-label">Email</label>
	                    <div class="col-sm-10">
	                      <input type="email" class="form-control" id="email" placeholder="email" v-model="newKaryawan.email" >
	                    </div>
	                  </div>
					  <div class="form-group">
	                    <label for="peran" class="col-sm-2 control-label">Peran</label>
	                    <div class="col-sm-10">
	                      <select class="form-control" name="peran" id="peran" v-model="newKaryawan.privilege">
	                      	<option></option>
	                      	<option value="admin">Admin</option>
	                      	<option value="kasir">Kasir</option>
	                      </select>
	                    </div>
	                  </div>
	                  <div class="form-group">
	                    <label for="foto" class="col-sm-2 control-label">Foto</label>
	                    <div class="col-sm-10">
	                      <input type="file" name="foto" id="foto_karyawan" v-model="newKaryawan.foto">
	                    </div>
	                  </div>
	            </div>
	            <div class="modal-footer">
	            	<button type="button" class="btn btn-default  btn-flat" data-dismiss="modal">Close</button>
	            	<button type="submit" id="simpan" class="btn btn-primary btn-flat">Save Changes</button>
	          	</div>
	            </form>
	          </div><!-- /.modal-content -->
	        </div><!-- /.modal-dialog -->
	    </div><!-- /.modal -->

        <!-- template for the modal component -->
        <script type="x/template" id="modal-template">
          <div class="modal vue-modal-mask" @click="close" v-show="show" transition="modal">
            <div class="modal-dialog">
              <div class="modal-content" @click.stop>
              <slot></slot>
              </div>
            </div>
          </div>
        </script>

        <!-- template for modal setting -->
        <script type="x/template" id="setting-modal-template">
        	<modal :show.sync="show" :on-close="close" :setting="setting">
        		<div class="modal-header">
	                <h4><i class="fa fa-fw fa-eye"></i><b> Setting Password</b></h4>
	            </div>
	            <div class="form-horizontal">
	            	<div class="modal-body">
	            	  <div class="form-group">
	                    <label for="password" class="col-sm-2 control-label">Username</label>
	                    <div class="col-sm-10">
	                      <input type="text" class="form-control" id="username" placeholder="username" v-model="setting.username" required>
	                    </div>
	                  </div>
	                  <div class="form-group">
	                    <label for="password" class="col-sm-2 control-label">Password</label>
	                    <div class="col-sm-10">
	                      <input type="text" class="form-control" id="password" placeholder="password" v-model="setting.password" required>
	                    </div>
	                  </div>
	                </div>
	            </div>
	            <div class="modal-footer text-right">
					<button class="btn btn-default"
		              @click="close()">
		              Batal
		            </button>
		            <button class="btn btn-danger"
		              @click="saveSetting()">
		              Simpan
		            </button>
	            </div>
        	</modal>
        </script>

        <!-- template for modal viewer -->
        <script type="x/template" id="view-modal-template">
	        <modal :show.sync="show" :on-close="close" :view="selectedKaryawan">
	            <div class="modal-header">
	                <h4><i class="fa fa-fw fa-eye"></i><b> Detail Data Karyawan</b></h4>
	            </div>
	            <div class="modal-body text-center">
	                <div class="container-fluid">
	                	<div class="row">
	                		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
	                			<img height="90" width="100" src="<?php echo base_url(); ?>{{view.foto}}" class="img-responsive" alt="Image">
	                		</div>
	                		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
	                			<div class="row">
	                				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	                					<div class="row">
	                						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
	                							<p><b>Nama</b></p>
	                						</div>
	                						<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
	                							<p>{{view.nama}}</p>
	                						</div>
	                					</div>
	                					<div class="row">
	                						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
	                							<p><b>TTL</b></p>
	                						</div>
	                						<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
	                							<p>{{view.tempat_lahir}} {{view.tgl_lahir}}</p>
	                						</div>
	                					</div>
	                					<div class="row">
	                						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
	                							<p><b>Alamat</b></p>
	                						</div>
	                						<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
	                							<p>{{view.alamat}}</p>
	                						</div>
	                					</div>
	                					<div class="row">
	                						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
	                							<p><b>Jenis Kelamin</b></p>
	                						</div>
	                						<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
	                							<p>{{view.jenis_kelamin}}</p>
	                						</div>
	                					</div>
	                					<div class="row">
	                						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
	                							<p><b>Telepon</b></p>
	                						</div>
	                						<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
	                							<p>{{view.telepon}}</p>
	                						</div>
	                					</div>
	                					<div class="row">
	                						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
	                							<p><b>Profesi</b></p>
	                						</div>
	                						<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
	                							<p>{{view.profesi}}</p>
	                						</div>
	                					</div>
	                					<div class="row">
	                						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
	                							<p><b>SIP</b></p>
	                						</div>
	                						<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
	                							<p>{{view.SIP}}</p>
	                						</div>
	                					</div>
	                					<div class="row">
	                						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
	                							<p><b>Email</b></p>
	                						</div>
	                						<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
	                							<p>{{view.email}}</p>
	                						</div>
	                					</div>
										<div class="row">
	                						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
	                							<p><b>Peran</b></p>
	                						</div>
	                						<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
	                							<p>{{view.privilege}}</p>
	                						</div>
	                					</div>
	                				</div>
	                			</div>
	                		</div>
	                	</div>
	                </div>
	            </div>
	            <div class="modal-footer text-right">
	                <button class="btn btn-danger"
		              @click="close()">
		              Tutup
		            </button>
	            </div>
	        </modal>
	    </script>

		<!-- template for modal delete -->
        <script type="x/template" id="delete-modal-template">
	        <modal :show.sync="show" :on-close="close">
	            <div class="modal-header">
	                <h4><i class="fa fa-fw fa-exclamation-triangle"></i><b> Menghapus Data</b></h4>
	            </div>
	            <div class="modal-body text-center">
	                <p>Yakin menghapus data Ini ?</p>
	            </div>
	            <div class="modal-footer text-right">
	                <button class="btn btn-default"
		              @click="close()">
		              Batal
		            </button>
		            <button class="btn btn-danger"
		              @click="removeData('karyawan')">
		              Hapus
		            </button>
	            </div>
	        </modal>
	    </script>

	    <!-- template for modal edit -->
        <script type="x/template" id="edit-modal-template">
	        <modal :show.sync="show" :on-close="close" :edit="editedKaryawan" :options="options">
	            <div class="modal-header">
	                <h4><i class="fa fa-fw fa-pencil"></i><b> Perubahan Data</b></h4>
	            </div>
	            <div class="form-horizontal">
	            	<div class="modal-body">
	                  <div class="form-group">
	                    <label for="nama-obat" class="col-sm-2 control-label">Nama</label>
	                    <div class="col-sm-10">
	                      <input type="text" class="form-control" id="namaKaryawan" placeholder="nama karyawan" v-model="edit.nama" required>
	                    </div>
	                  </div>
	                  <div class="form-group">
	                    <label for="alamat" class="col-sm-2 control-label">Alamat</label>
	                    <div class="col-sm-10">
	                      <input type="text" class="form-control" id="alamat" placeholder="alamat" v-model="edit.alamat" required>
	                    </div>
	                  </div>
	                  <div class="form-group">
	                    <label for="tempat_lahir" class="col-sm-2 control-label">Tempat Lahir</label>
	                    <div class="col-sm-10">
	                      <input type="text" class="form-control" id="tempat_lahir" placeholder="tempat lahir" v-model="edit.tempat_lahir" required>
	                    </div>
	                  </div>
	                  <div class="form-group">
	                    <label for="tgl_lahir" class="col-sm-2 control-label">Tgl Lahir</label>
	                    <div class="col-sm-10">
	                      <input type="date" class="form-control" id="tgl_lahir" placeholder="tgl lahir" v-model="edit.tgl_lahir" required>
	                    </div>
	                  </div>
	                  <div class="form-group">
	                    <label for="jenis_kelamin" class="col-sm-2 control-label">Jenis Kelamin</label>
	                    <div class="col-sm-10">
	                      <select class="form-control" name="jeniskelamin" id="jenis_kelamin" v-model="edit.jenis_kelamin" required>
	                      	<option></option>
	                      	<option value="laki-laki">Laki-laki</option>
	                      	<option value="perempuan">Perempuan</option>
	                      </select>
	                    </div>
	                  </div>
	                  <div class="form-group">
	                    <label for="telepon" class="col-sm-2 control-label">Telepon</label>
	                    <div class="col-sm-10">
	                      <input type="number" class="form-control" id="telepon" placeholder="telepon" v-model="edit.telepon" required>
	                    </div>
	                  </div>
	                  <div class="form-group">
	                    <label for="profesi" class="col-sm-2 control-label">Profesi</label>
	                    <div class="col-sm-10">
	                      <select class="form-control" name="profesi" id="profesi" v-model="edit.profesi" required>
	                      	<option value=""></option>
							<option v-for="option in options" v-bind:value="option.nama">
							    {{ option.nama }}
							</option>
	                      </select>
	                    </div>
	                  </div>
	                  <div class="form-group">
	                    <label for="sip" class="col-sm-2 control-label">SIP</label>
	                    <div class="col-sm-10">
	                      <input type="text" class="form-control" id="sip" placeholder="sip" v-model="edit.SIP" required>
	                    </div>
	                  </div>
	                  <div class="form-group">
	                    <label for="email" class="col-sm-2 control-label">Email</label>
	                    <div class="col-sm-10">
	                      <input type="email" class="form-control" id="email" placeholder="email" v-model="edit.email" >
	                    </div>
	                  </div>
					  <div class="form-group">
	                    <label for="peran" class="col-sm-2 control-label">Peran</label>
	                    <div class="col-sm-10">
	                      <select class="form-control" name="peran" id="peran" v-model="edit.privilege" required>
	                      	<option value=""></option>
	                      	<option value="admin">Admin</option>
	                      	<option value="kasir">Kasir</option>
	                      </select>
	                    </div>
	                  </div>
					  <div class="row">
						  <div class="col-sm-6">
								<div class="form-group">
									<label for="existing-foto" class="col-sm-4 control-label">Foto Sebelumnya</label>
									<div class="col-sm-8">
									  <img height="60" width="100" src="<?php echo base_url(); ?>{{edit.foto}}" class="img-responsive" alt="Image">
									</div>
								</div>
						  </div>
						  <div class="col-sm-6">
								<div class="form-group">
									<label for="foto" class="col-sm-3 control-label">Ubah Foto</label>
									<div class="col-sm-9">
									  <input type="file" name="foto" id="edit_foto_karyawan">
									</div>
								</div>
						  </div>
					  </div>
					</div>
	            </div>
	            <div class="modal-footer text-right">
	                <button class="btn btn-default"
		              @click="close()">
		              Batal
		            </button>
		            <button class="btn btn-danger"
		              @click="saveData('karyawan')">
		              Simpan
		            </button>
	            </div>
	            </div>
	        </modal>
	    </script>

	    <delete-modal :show.sync="showDeleteModal"></delete-modal>
	    <edit-modal :show.sync="showEditModal" :edit="editedKaryawan" :options="options"></edit-modal>
	    <view-modal :show.sync="showViewModal" :view="selectedKaryawan"></view-modal>
	    <setting-modal :show.sync="showSettingModal" :setting="setting"></setting-modal>

      </div><!-- /.content-wrapper -->

    
	  
	   