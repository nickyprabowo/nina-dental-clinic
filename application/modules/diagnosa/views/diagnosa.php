<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" id="diagnosa">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Diagnosa
          </h1>
          <?php if( $this->session->role == 'admin' || $this->session->role == 'superuser' ) { ?>
          <button type="button" class="btn-tambah btn btn-flat btn-primary" data-toggle="modal" data-target="#modalDiagnosa"><i class="fa fa-fw fa-plus"></i> Tambah</button>
          <?php } ?>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa  fa-user-md"></i> Diagnosa</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
          <div class="box box-solid">
            <div id="data" class="box-body">
				<input type="text" class="searchTable form-control" v-model="search" placeholder="Search Something . . .">
				<table id="example1" class="table table-bordered table-striped">
					<thead>
					  <tr>
						<th>No</th>
						<th v-on:click="sortBy('diagnosa')">Diagnosa</th>
						<th>Keterangan</th>
            <?php if( $this->session->role == 'admin' || $this->session->role == 'superuser' ) { ?>
						<th class="text-center">Action</th>
            <?php } ?>
					  </tr>
					</thead>
					<tbody>
						<tr v-for="diagnosa in paginatedItems | orderBy sortKey reverse" track-by="$index">
							<td v-text="$index + 1 + (current_page * per_page)"></td>
							<td v-if="!diagnosa.edited">{{ diagnosa.nama }}</td>
							<td v-if="diagnosa.edited"><input type="text" name="editNamaDiagnosa" v-model="diagnosa.nama"></td>
							<td v-if="!diagnosa.edited">{{ diagnosa.keterangan }}</td>
							<td v-if="diagnosa.edited"><input type="text" name="editHargadiagnosa" v-model="diagnosa.keterangan"></td>
							<td class="text-center" v-if="diagnosa.edited">
							   <button type="button" class="btn btn-primary btn-flat margin" @click="doneEdit(diagnosa, $index)"><i class="fa fa-fw fa-hdd-o"></i> Save Changes</button>
								<button type="button" class="btn btn-default btn-flat margin" @click="cancelEdit(diagnosa)"><i class="fa fa-fw fa-ban"></i> Cancel Editing</button>
							</td>
              <?php if( $this->session->role == 'admin' || $this->session->role == 'superuser' ) { ?>
							<td class="text-center" v-if="!diagnosa.edited">
                
								<button type="button" class="btn bg-orange btn-flat margin" @click="editData(diagnosa)"><i class="fa fa-fw fa-pencil"></i> Ubah</button>
								<button type="button" class="btn bg-maroon btn-flat margin" id="show-modal" @click="hapus(diagnosa)" ><i class="fa fa-fw fa-trash-o"></i> Hapus</button>
                
							</td>
              <?php } ?>
						</tr>
					</tbody>
				</table>
				<ul class="pagination">
					<li v-for="n in Math.ceil(diagnosa.length/per_page)" @click="current_page = $index" v-bind:class="{'active': $index === current_page}">
					  <a href="#">{{ $index + 1 }}</a>
					</li>
				</ul>
            </div><!-- /.box-body -->
          </div><!-- /.box -->


        </section><!-- /.content -->

      <!-- Modal -->
        <div class="modal fade modal-default" id="modalDiagnosa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Diagnosa</h4>
              </div>
              <form @submit.prevent="onSubmit" class="form-horizontal">
              <div class="modal-body">
                  <div class="form-group">
                    <label for="nama-diagnosa" class="col-sm-2 control-label">Diagnosa</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="namaDiagnosa" placeholder="nama diagnosa" v-model="newDiagnosa.nama" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="keterangan" class="col-sm-2 control-label">Keterangan</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="keterangan" placeholder="keterangan" v-model="newDiagnosa.keterangan" required>
                    </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default  btn-flat" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-flat">Save</button>
              </div>
              </form>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
		
		<delete-modal :show.sync="showDeleteModal"></delete-modal>
        
        <script type="x/template" id="modal-template">
          <div class="modal vue-modal-mask" @click="close" v-show="show" transition="modal">
            <div class="modal-dialog">
              <div class="modal-content" @click.stop>
              <slot></slot>
              </div>
            </div>
          </div>
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
		              @click="removeData('diagnosa')">
		              Hapus
		            </button>
	            </div>
	        </modal>
	    </script>
      </div><!-- /.content-wrapper -->