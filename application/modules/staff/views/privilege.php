<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" id="privilege">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Privilege
          </h1>
          <button type="button" class="btn-tambah btn btn-primary" data-toggle="modal" data-target="#modalMarketing"><i class="fa fa-fw fa-plus"></i> Tambah</button>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa  fa-user-md"></i> privilege</a></li>
            <li class="active">Privilege</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
          <div class="box box-solid">
            <div id="data" class="box-body">
            	<input type="text" class="searchTable form-control" v-model="search" placeholder="Search Something . . .">

              <table id="tabel-privilege" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th v-on:click="sortBy('nama')">Nama</th>
                    <th v-on:click="sortBy('stok')">Telepon</th>
                    <th>Peran</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="privilege in paginatedItems | orderBy sortKey reverse" track-by="$index">
                    <td v-text="$index + 1 + (current_page * per_page)"></td>
                    <td>{{ privilege.nama }}</td>
                    <td>{{ privilege.telepon }}</td>
                    <td>{{ privilege.privilege }}</td>
                    <td class="text-center">
						<button type="button" class="btn bg-maroon btn-flat" @click="editPrivilege(privilege,$index)"><i class="fa fa-fw fa-edit"></i> Ubah</button>
                        <button type="button" class="btn bg-orange btn-flat" @click="hapus(privilege)" ><i class="fa fa-fw fa-remove"></i> Hapus</button>
                    </td>
                  </tr>
                </tbody>
              </table>
              <ul class="pagination">
                <li v-for="n in Math.ceil(privilege.length/per_page)" @click="current_page = $index" v-bind:class="{'active': $index === current_page}">
                  <a href="#">{{ $index + 1 }}</a>
                </li>
              </ul>
            </div><!-- /.box-body -->
          </div><!-- /.box -->


        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Modal -->
      <div class="modal fade modal-primary" id="modalMarketing" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Modal Primary</h4>
            </div>
            <div class="modal-body">
              <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-outline">Save changes</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->