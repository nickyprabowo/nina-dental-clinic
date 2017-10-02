<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" id="user">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            User
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa  fa-eye"></i> User</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <div class="form-horizontal">
              <div class="box-body">

                <div class="form-group">
                    <label for="username" class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-8">
                    	<p v-if="!user.edited" style="padding:7px 0px">{{ user.username }}</p>
                      	<input v-if="user.edited" type="text" class="form-control" id="username" placeholder="" v-model="user.username" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="username" class="col-sm-2 control-label">Peran</label>
                    <div class="col-sm-8">
                    	<p style="padding:7px 0px">{{ user.peran }}</p>
                    </div>
                </div>
                <div v-if="user.edited" class="form-group">
                    <label for="password" class="col-sm-2 control-label">Password Lama</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="oldPassword" placeholder="" v-model="user.oldPassword" required>
                    </div>
                </div>
                <div v-if="user.edited" class="form-group">
                    <label for="password" class="col-sm-2 control-label">Password Baru</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="newPassword" placeholder="" v-model="user.newPassword" required>
                    </div>
                </div>
              </div><!-- /.box-body -->
              <div class="box-footer">
              	<div class="col-sm-offset-2 col-sm-10">
                <button v-if="!user.edited" class="btn bg-orange btn-flat" @click="editProfile()">Edit</button>
                <button v-if="user.edited" class="btn btn-primary btn-flat" @click="saveSetting()">Simpan</button>
                <button v-if="user.edited" class="btn btn-default btn-flat" @click="cancel()">Cancel</button>
                </div>
              </div><!-- /.box-footer -->
            </div>
          </div><!-- /.box -->

        </section><!-- /.content -->
		
		<add-modal :show.sync="showAddModal" :add="newTindakan"></add-modal>
		<delete-modal :show.sync="showDeleteModal" :add="newTindakan"></delete-modal>
		
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
		
		<!-- template for modal add -->
        <script type="x/template" id="add-modal-template">
			<modal :show.sync="show" :on-close="close" :add="newTindakan">
				<div class="modal-header">
					<h4><i class="fa fa-fw fa-plus"></i><b> Menambah Data</b></h4>
				</div>
				<div class="form-horizontal">
					<div class="modal-body text-center">
						<div class="form-group">
							<label for="nama-tindakan" class="col-sm-2 control-label">Nama</label>
							<div class="col-sm-10">
							  <input type="text" class="form-control" id="namaTindakan" placeholder="nama tindakan" v-model="add.nama" required>
							</div>
						  </div>
						  <div class="form-group">
							<label for="detail-tindakan" class="col-sm-2 control-label">Detail</label>
							<div class="col-sm-10">
							  <textarea class="form-control" rows="8" id="detailTindakan" v-model="add.keterangan"></textarea>
							</div>
						  </div>
						  <div class="form-group">
							<label for="harga" class="col-sm-2 control-label">Biaya</label>
							<div class="col-sm-10">
							  <input type="number" class="form-control" id="biaya" placeholder="jumlah" v-model="add.biaya" required>
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
					  @click="saveData('tindakan')">
					  Simpan
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
					  @click="removeData('tindakan')">
					  Hapus
					</button>
				</div>
			</modal>
		</script>
      </div><!-- /.content-wrapper -->
