<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" id="laporan-inventaris">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Laporan Inventaris Barang
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa  fa-eye"></i> Inventaris</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Your Page Content Here -->
          <div class="box box-solid">
            <!--<div class="box-header">
              <h3 class="box-title">Daftar Dokter</h3>
              <button type="button" class="btn btn-primary"><i class="fa fa-fw fa-plus"></i> Tambah</button>
            </div><!-- /.box-header -->
          <div class="box">           
            <div class="box-body">
              <div class="row">
                <div class="col-sm-8">
                    <input type="text" class="searchTable form-control" v-model="search" placeholder="Search Something . . .">
                </div>
                <div class="col-sm-4">
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="reservationtime" placeholder="Masukkan tanggal" v-model="range"> 
                      <div class="input-group-addon btn btn-primary btn-flat" id="filterLaporanInventaris" @click="filterLaporanInventaris()">	  
                        <i class="fa fa-filter fa-fw"></i> Filter
                      </div>
					  <button class="btn btn-primary btn-flat" onclick="window.open('<?php echo base_url()?>inventaris/printlaporan/'+$('#reservationtime').val(),'printlaporan','scrollbars=yes,status=no,menubar=no,width=800,height=400')" style="float:right;"><i class="fa fa-fw fa-print"></i></button>
                    </div><!-- /.input group -->
                </div>
              </div>
              
              <table id="daftar-obat" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th v-on:click="sortBy('nama')">Nama</th>
                    <th>Tanggal</th>
                    <th v-on:click="sortBy('prevStok')">Stok Sebelumnya</th>
                    <th v-on:click="sortBy('stok')">Stok</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="laporan in paginatedItems | orderBy sortKey reverse" track-by="$index">
                    <td v-text="$index + 1 + (current_page * per_page)"></td>
                    <td v-if="!laporan.edited">{{ laporan.nama }}</td>
                    <td v-if="laporan.edited"><input type="text" name="editNamaObat" v-model="laporan.nama"></td>
                    <td> {{ laporan.tanggal }} </td>
                    <td v-if="!laporan.edited">{{ laporan.prevStok }}</td>
                    <td v-if="!laporan.edited">{{ laporan.stok }}</td>
                    <td v-if="laporan.edited"><input type="text" name="editStokObat" v-model="laporan.stok"></td>
                    <td> <span class="badge bg-blue" v-bind:class="{'bg-blue': laporan.status === 'tambah', 'bg-green': laporan.status === 'edit', 'bg-red': laporan.status === 'hapus'}"> {{ laporan.status }} </span> </td>
                    <td>{{ laporan.keterangan }}</td>
                  </tr>
                </tbody>
              </table>
              <ul class="pagination">
                <li v-for="n in Math.ceil(laporanInventaris.length/per_page)" @click="current_page = $index" v-bind:class="{'active': $index === current_page}">
                  <a href="#">{{ $index + 1 }}</a>
                </li>
              </ul>
            </div><!-- /.box-body -->
          </div><!-- /.box -->

        </section><!-- /.content -->

      </div>
