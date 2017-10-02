<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" id="tindakan">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Tindakan Medis
          </h1>
          <?php if( $this->session->role == 'admin' || $this->session->role == 'superuser' ) { ?>
          <button @click="tambahTindakan()" class="btn-tambah btn btn-primary btn-flat" ><i class="fa fa-fw fa-plus"></i> Tambah</button>
          <?php } ?>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa  fa-eye"></i> Tindakan Medis</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
          <div class="box box-solid">
            <div id="data" class="box-body">
            	<input type="text" class="searchTable form-control" v-model="search" placeholder="Search Something . . .">
                <table id="daftar-tindakan" class="table table-bordered table-striped">
                    <thead>
						  <tr>
							<th>No</th>
							<th v-on:click="sortBy('nama')">Nama Tindakan</th>
							<th v-on:click="sortBy('keterangan')">Detail Tindakan</th>
							<th v-on:click="sortBy('biaya')">Biaya</th>
							<?php if( $this->session->role == 'admin' || $this->session->role == 'superuser' ) { ?>
							<th class="text-center">Action</th>
							<?php } ?>
						  </tr>
                    </thead>
                    <tbody>
						<tr v-for="tindakan in paginatedItems | orderBy sortKey reverse" track-by="$index">
							<td v-text="$index + 1 + (current_page * per_page)"></td>
							<td v-if="!tindakan.edited">{{ tindakan.nama }}</td>
							<td v-if="tindakan.edited"><input type="text" name="editTindakan" v-model="tindakan.nama"></td>
							<td v-if="!tindakan.edited">{{ tindakan.keterangan }}</td>
							<td v-if="tindakan.edited"><input type="text" name="editKeterangan" v-model="tindakan.keterangan"></td>
							<td v-if="!tindakan.edited">{{ tindakan.biaya }}</td>
							<td v-if="tindakan.edited"><input type="number" name="editBiaya" v-model="tindakan.biaya"></td>
							<?php if( $this->session->role == 'admin' || $this->session->role == 'superuser' ) { ?>
							<td class="text-center" v-if="tindakan.edited">
							   <button type="button" class="btn btn-primary btn-flat margin" @click="doneEdit(tindakan, $index)"><i class="fa fa-fw fa-hdd-o"></i> Save Changes</button>
								<button type="button" class="btn btn-default btn-flat margin" @click="cancelEdit(tindakan)"><i class="fa fa-fw fa-ban"></i> Cancel Editing</button>
							</td>
							<td class="text-center"v-if="!tindakan.edited">
								<button type="button" class="btn bg-maroon btn-flat" @click="editTindakan(tindakan)"><i class="fa fa-fw fa-edit"></i> Ubah</button>
								<button type="button" class="btn bg-orange btn-flat" @click="hapus(tindakan)" ><i class="fa fa-fw fa-remove"></i> Hapus</button>
							</td>
							<?php } ?>
						</tr>
                    </tbody>
                  </table>
                <ul class="pagination">
                <li v-for="n in Math.ceil(tindakan.length/per_page)" @click="current_page = $index" v-bind:class="{'active': $index === current_page}">
                  <a href="#">{{ $index + 1 }}</a>
                </li>
              </ul>
            </div><!-- /.box-body -->
          </div><!-- /.box -->

        </section><!-- /.content -->
		
		<add-modal :show.sync="showAddModal" :tambah="newTindakan"></add-modal>
		<delete-modal :show.sync="showDeleteModal"></delete-modal>
		
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
			<modal :show.sync="show" :on-close="close" :tambah="newTindakan">
				<div class="modal-header">
					<h4><i class="fa fa-fw fa-plus"></i><b> Menambah Data</b></h4>
				</div>
				<div class="form-horizontal">
					<div class="modal-body text-center">
						<div class="form-group">
							<label for="nama-tindakan" class="col-sm-2 control-label">Nama</label>
							<div class="col-sm-10">
							  <input type="text" class="form-control" id="namaTindakan" placeholder="nama tindakan" v-model="tambah.nama" required>
							</div>
						  </div>
						  <div class="form-group">
							<label for="detail-tindakan" class="col-sm-2 control-label">Detail</label>
							<div class="col-sm-10">
							  <textarea class="form-control" rows="8" id="detailTindakan" v-model="tambah.keterangan"></textarea>
							</div>
						  </div>
						  <div class="form-group">
							<label for="harga" class="col-sm-2 control-label">Biaya</label>
							<div class="col-sm-10">
							  <input type="number" class="form-control" id="biaya" placeholder="jumlah" v-model="tambah.biaya" required>
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