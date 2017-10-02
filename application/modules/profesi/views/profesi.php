<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" id="profesi">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Profesi
          </h1>
          <?php if( $this->session->role == 'admin' || $this->session->role == 'superuser' ) { ?>
          <button @click="tambahProfesi()" class="btn-tambah btn btn-primary btn-flat" ><i class="fa fa-fw fa-plus"></i> Tambah</button>
          <?php } ?>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa  fa-eye"></i> Profesi </a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
          <div class="box box-solid">
            <div id="data" class="box-body">
              <input type="text" class="searchTable form-control" v-model="search" placeholder="Search Something . . .">
                <table id="daftar-profesi" class="table table-bordered table-striped">
                    <thead>
              <tr>
              <th>No</th>
              <th v-on:click="sortBy('nama')">profesi</th>
              <?php if( $this->session->role == 'admin' || $this->session->role == 'superuser' ) { ?>
              <th class="text-center">Action</th>
              <?php } ?>
              </tr>
                    </thead>
                    <tbody>
            <tr v-for="profesi in paginatedItems | orderBy sortKey reverse" track-by="$index">
              <td v-text="$index + 1 + (current_page * per_page)"></td>
              <td v-if="!profesi.edited">{{ profesi.nama }}</td>
              <td v-if="profesi.edited"><input type="text" name="editprofesi" v-model="profesi.nama"></td>
              <?php if( $this->session->role == 'admin' || $this->session->role == 'superuser' ) { ?>
              <td class="text-center" v-if="profesi.edited">
                 <button type="button" class="btn btn-primary btn-flat margin" @click="doneEdit(profesi, $index)"><i class="fa fa-fw fa-hdd-o"></i> Save Changes</button>
                <button type="button" class="btn btn-default btn-flat margin" @click="cancelEdit(profesi)"><i class="fa fa-fw fa-ban"></i> Cancel Editing</button>
              </td>
              <td class="text-center"v-if="!profesi.edited">
                <button type="button" class="btn bg-maroon btn-flat" @click="editProfesi(profesi)"><i class="fa fa-fw fa-edit"></i> Ubah</button>
                <button type="button" class="btn bg-orange btn-flat" @click="hapus(profesi)" ><i class="fa fa-fw fa-remove"></i> Hapus</button>
              </td>
              <?php } ?>
            </tr>
                    </tbody>
                  </table>
              <ul class="pagination">
                <li v-for="n in Math.ceil(profesi.length/per_page)" @click="current_page = $index" v-bind:class="{'active': $index === current_page}">
                  <a href="#">{{ $index + 1 }}</a>
                </li>
              </ul>
            </div><!-- /.box-body -->
          </div><!-- /.box -->

        </section><!-- /.content -->
    
    <add-modal :show.sync="showAddModal" :tambah="newProfesi"></add-modal>
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
      <modal :show.sync="show" :on-close="close" :tambah="newProfesi">
        <div class="modal-header">
          <h4><i class="fa fa-fw fa-plus"></i><b> Menambah Data</b></h4>
        </div>
        <div class="form-horizontal">
          <div class="modal-body text-center">
            <div class="form-group">
              <label for="nama-profesi" class="col-sm-2 control-label">Nama</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="namaProfesi" placeholder="nama profesi" v-model="tambah.profesi" required>
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
            @click="saveData('profesi')">
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
            @click="removeData('profesi')">
            Hapus
          </button>
        </div>
      </modal>
    </script> 
  </div><!-- /.content-wrapper -->