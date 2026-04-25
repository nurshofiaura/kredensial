<?php
//=================================== H O M E ================================================
$arraybox = array('warning','success','info','danger');
$resarray = array_rand($arraybox);
$thenarray = $arraybox[$resarray];
$arrayboxBOX = array('aqua','green','yellow','red');
$resarrayBOX = array_rand($arrayboxBOX);
$thenarrayBOX = $arrayboxBOX[$resarrayBOX];
if ($page=="home")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">PERHATIAN</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">

        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="pengajuan_kompetensi")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <small>
    <a href="<?php echo base_url('landing/#pengajuan');?>"
      class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
    </a>   
        </small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
      <?php
    //    input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th style="display:none;width: 5%;">ID</th>
            <th style="width:15%;">Tanggal</th>
            <th>Nama</th>
            <th>Status Usulan</th>
            <th style="width:15%;">Status</th>
          </tr>
        </thead>
      </table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <?php echo $header; ?> <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="pengajuan_kompetensi_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('s_pengajuan/pengajuan_kompetensi/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><?php $title; ?></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?= $title ?></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <ul class="timeline timeline-inverse">
              <!-- timeline time label -->
              <li class="time-label">
                <span class="bg-red">
                  <?php echo date('d-m-Y'); ?>
                </span>
              </li>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <li>
              <i class="fa fa-envelope bg-blue"></i>

              <div class="timeline-item">
                <h3 class="timeline-header">File</h3>
                <div class="timeline-body">
                <ul>
                  <li>Siapkan file surat ijin (STR) yang berlaku</li>
                  <li>Siapkan file ijasah pendidikan terakhir</li>
                  <li>Siapkan file sertifikat pelatihan, workshop, kongres, simposium dll</li>
                  <li>Siapkan file berkas lainnya (opsional)</li>
                  <li>Minta kepala ruangan untuk membuat Penilaian Etik</li>
                  <li>Semua berkas di upload di menu berkas sesuai kategorinya (Surat Ijin, Seminar dll, Ijasah dan berkas lainnya) dalam format PDF</li>
                  <li>Semua berkas yang diupload tidak akan hilang dan dapat di download atau digunakan untuk pengajuan selanjutnya</li>
                </ul>
                </div>
              </div>
              </li>
              <li>
              <i class="fa fa-user bg-aqua"></i>
              <div class="timeline-item">
                <h3 class="timeline-header">Logbook</h3>
                <div class="timeline-body">
                <ul>
                  <li>Pengajuan Kredensial / Non Keperawatan hanya akan divlidasi oleh komite / penilai</li>
                  <li>Pengajuan Kenaikan Tingkat (Keperawatan) akan divlidasi sesuai alur kabid=>asesor=>komite=>direktur</li>
                  <li>Pengajuan Pemulihan kewenangan diambil dari logbook yang ditolak</li>
                  <li>Pengajuan Penambahan Kewenangan / Kompetensi hanya divlidasi oleh komite</li>
                </ul>
                </div>
              </div>
              </li>
              <li>
              <i class="fa fa-comments bg-yellow"></i>

              <div class="timeline-item">
                <h3 class="timeline-header">Pengiriman</h3>

                <div class="timeline-body">
                <ul>
                  <li>Lengkapi berkas dan logbook terlebih dahulu baru kemudian pengajuan dapat diajukan</li>
                  <li>Setelah pengajuan terkirim mohon untuk menghubungi tim kompetensi</li>
                </ul>
                </div>
              </div>
              </li>
              <li>
              <i class="fa fa-clock-o bg-gray"></i>
              </li>
            </ul>
            <br />
              <?php
              echo '<label>Jenis Pengajuan Kompetensi</label>';
              input_pdselect2("id_status_diusulkan",$status_diusulkan_all,$id_status_diusulkan);

              ?>           
            <div class="box-body box-profile">
            <button type="submit" class="btn btn-primary btn-block"><b>AJUKAN</b></button>
            </div>
          </div>
        </div>
        </div>
      </div>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="pengajuan_kompetensi_isi")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
    <a href="<?php echo base_url('s_pengajuan');?>"
      class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
    </a>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">
      <?php echo $title; ?> <small style="color:white;font-weight:bold;">  <?php echo $instance_name; ?> </small>
       </h3>
        </div>
        <div class="box-body">
    <?php echo form_open_multipart('s_pengajuan/pengajuan_kompetensi/isi/'.$id,' ');
    input_text("id_pengajuan",$id_pengajuan,"","","hidden");
    ?>
      <div class="row">
      <div class="col-md-4">
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
               <h3 class="box-title">
                PILIH BERKAS
                </h3>
            </div>
            <div class="box-body">
              <div class="box-body box-profile">
      <?php
          $url_thumbx=base_url().'assets/images/noavatar.jpg';
          $url_picbesarx=base_url().'assets/images/noavatar.jpg';
      ?>
                <a class="example-image-link" href="<?php echo $url_picbesarx; ?>"
                  data-lightbox="example-set" data-title="<?php echo $nama; ?>">
                  <img class="profile-user-img img-responsive img-circle"
                    src="<?php echo $url_thumbx; ?>" style="width:75px" alt="User profile picture">
                </a>
                <h3 class="profile-username" style="color:green;text-align:center;"><?php echo $nama; ?></h3>
                <h4 style="color:green;text-align:center;"><strong><?= strtoupper($nama_status_diusulkan) ?></strong></h4>
                <div class="form-group">
                </div>
                <ul class="list-group list-group-unbordered">
                  <?php
              if($status_pengajuan=="0"){
                    ?>
                        <li class="list-group-item">
                            <a href="<?php echo base_url('s_pengajuan/berkas_logbook/view/'.$id);?>" class="btn bg-green btn-block btn-xs">Pilih Data LogBook</a>
                        </li>
                    <?php
              }
                    if($status_pengajuan=="0"){
                  ?><li class="list-group-item">
                      <a href="<?php echo base_url('s_pengajuan/berkas_ijasah/view/'.$id);?>" class="btn bg-green btn-block btn-xs">
                      Pilih Ijasah</a></li>
                  <?php
                    }
                    if($status_pengajuan=="0"){
                  ?><li class="list-group-item">
                      <a href="<?php echo base_url('s_pengajuan/berkas_str/view/'.$id);?>" class="btn bg-green btn-block btn-xs">
                      Pilih Surat Ijin</a></li>
                  <?php
                    }
                    if($status_pengajuan=="0"){
                  ?> <li class="list-group-item">
                      <a href="<?php echo base_url('s_pengajuan/berkas_sertifikat/view/'.$id);?>" class="btn bg-green btn-block btn-xs">
                      Pilih Sertifikat</a> </li>
                  <?php
                    }
                    if($status_pengajuan=="0"){
                  ?><li class="list-group-item">
                        <a href="<?php echo base_url('s_pengajuan/berkaslain_berkas/view/'.$id);?>" class="btn bg-green btn-block btn-xs">
                        Pilih Berkas Lain (opsional)</a></li>
                  <?php
                    }
                    if($status_pengajuan=="0"){
                      ?><li class="list-group-item">
                      <a href="<?php echo base_url('s_pengajuan/berkas_etik/view/'.$id);?>" class="btn bg-green btn-block btn-xs">Pilih Etik</a></li>
                  <?php
                    }
                  ?>
                
                </ul>

              </div>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">
             DATA BERKAS
            </h3>
            </div>
            <div class="box-body">
        <div class="box-body no-padding">
          <div class="mailbox-controls">

          </div>
          <div class="table-responsive mailbox-messages">
          <table class="table table-hover table-striped">
            <tbody>
            <tr>
            <td colspan="2" style="background-color:#9b0e27;color:white;text-weight:bold;">IJASAH</td>
            </tr>
              <?php
              if($ijasah!==""){
                foreach($ambil_berkas_data as $row){
                  if (in_array($row['id_berkas'],$id_ijasah)) {
              ?>
                <tr>
                <td width="5%"><input name="id_4_ijasah[]" value="<?php echo $row['id_berkas']; ?>" checked="checked" type="checkbox"></td>
                <td class="mailbox-name">
                  <a href="<?php echo base_url('assets/berkas/sample/'.$row['link_berkas']);?>" target="_blank" class="btn bg-maroon btn-xs">
                    <i class="fa fa-file-text"></i> <?php echo $row['nama_berkas']; ?> - <?php echo $row['penyelenggara']; ?>
                  </a>
                </td>
                </tr>
              <?php
                  }
                }
              }
              ?>
            <tr>
            <td colspan="2" style="background-color:#9b0e27;color:white;text-weight:bold;">SURAT IJIN</td>
            </tr>
              <?php
              if($str!==""){
                foreach($ambil_berkas_data as $row2){
                  if (in_array($row2['id_berkas'],$id_str)) {
              ?>
                <tr>
                <td width="5%"><input name="id_4_str[]" value="<?php echo $row2['id_berkas']; ?>" checked="checked" type="checkbox"> </td>
                <td class="mailbox-name">
                  <a href="<?php echo base_url('assets/berkas/sample/'.$row2['link_berkas']);?>" target="_blank" class="btn bg-maroon btn-xs">
                    <i class="fa fa-file-text"></i> <?php echo $row2['nama_berkas']; ?>
                  </a>
                </td>
                </tr>
              <?php
                  }
                }
              }
              ?>
            <tr>
            <td colspan="2" style="background-color:#9b0e27;color:white;text-weight:bold;">SERTIFIKAT</td>
            </tr>
              <?php
              if($sertifikat!==""){
                foreach($ambil_berkas_data as $row3){
                  if (in_array($row3['id_berkas'],$id_sertifikat)) {
              ?>
                <tr>
                <td width="5%"><input name="id_4_sertifikat[]" value="<?php echo $row3['id_berkas']; ?>" checked="checked" type="checkbox"> </td>
                <td class="mailbox-name">
                  <a href="<?php echo base_url('assets/berkas/sample/'.$row3['link_berkas']);?>" target="_blank" class="btn bg-maroon btn-xs">
                    <i class="fa fa-file-text"></i> <?php echo $row3['nama_berkas']; ?>
                  </a>
                </td>
                </tr>
              <?php
                  }
                }
              }
              if($berkas!==""){
                foreach($ambil_berkas_data as $row4){
                  if (in_array($row4['id_berkas'],$id_berkas)) {
              ?>
                <tr>
                <td width="5%"><input name="id_4_berkas[]" value="<?php echo $row4['id_berkas']; ?>" checked="checked" type="checkbox"> </td>
                <td class="mailbox-name">
                  <a href="<?php echo base_url('assets/berkas/sample/'.$row4['link_berkas']);?>" target="_blank" class="btn bg-maroon btn-xs">
                    <i class="fa fa-file-text"></i> <?php echo $row4['nama_berkas']; ?>
                  </a>
                </td>
                </tr>
              <?php
                  }
                }
              }
              ?>
            <tr>
            <td colspan="2" style="background-color:#9b0e27;color:white;text-weight:bold;">ETIK&nbsp;
            <?php if($id_etik_pegawai == 0){ echo 'TIDAK MENCUKUPI SILAHKAN HUBUNGI KEPALA RUANGAN'; } ?>
            </td>
            </tr>
            <tr>
              <td colspan="2">
                <table width="100%" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="vertical-align:middle;text-align:center;font-weight:bold;width:5%;"></th>
                      <th style="vertical-align:middle;text-align:center;font-weight:bold;">Tanggal</th>
                      <th style="vertical-align:middle;text-align:center;font-weight:bold;">Hasil</th>
                      <th style="vertical-align:middle;text-align:center;font-weight:bold;">Penguji</th>
                      <th style="vertical-align:middle;text-align:center;font-weight:bold;"><i class="fa fa-print"></i></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    foreach($ambil_data_etik_pegawai_oppe as $rowambil_data_etik_pegawai_oppe){
                      if (in_array($rowambil_data_etik_pegawai_oppe['id_etik_pegawai'],$etike)) {
                  ?>
                    <tr>
                    <td style="vertical-align:middle;text-align:center;"><input name="id_etik_pegawai[]" value="<?php echo $rowambil_data_etik_pegawai_oppe['id_etik_pegawai']; ?>" checked="checked" type="checkbox"></td>
                    <td style="vertical-align:middle;text-align:center;"><?php echo date('d-m-Y', strtotime($rowambil_data_etik_pegawai_oppe['tgl_etik_pegawai'])); ?></td>
                    <td style="vertical-align:middle;text-align:center;"><?php echo $rowambil_data_etik_pegawai_oppe['hasil_etik']; ?></td>
                    <td style="vertical-align:middle;text-align:center;"><?php echo $rowambil_data_etik_pegawai_oppe['nama_pegawai']; ?></td>
                    <td style="vertical-align:middle;text-align:center;">
                    <a href="#" class="btn bg-green btn-xs" target="_blank">
                    <i class="fa fa-file-pdf-o"></i> pdf</a>
                    </td>
                    </tr>
                  <?php
                      }
                    }
                  ?>
                  </tbody>
                </table>
              </td>
            </tr>
            </tbody>
          </table>
          <!-- /.table -->
          </div>
          <!-- /.mail-box-messages -->
        </div>
        <div class="box-footer no-padding">
          <div class="mailbox-controls">
          <!-- Check all button -->
          <div class="pull-right">
           <i class="fa fa-search"></i> KLIK BERKAS UNTUK MELIHAT <i class="fa fa-trash-o"></i> UNCHECK KEMUDIAN SIMPAN UNTUK MEMBUANG BERKAS
          </div>
          <!-- /.pull-right -->
          </div>
        </div>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">
             <small style="color:white;font-weight:bold;">  <?php echo $instance_name; ?> </small>
            </h3>
            </div>
            <div class="box-body">
              <div class="nav-tabs-custom" id="oke">
                <ul class="nav nav-tabs pull-right">
                  <li class="active"><a href="#tab_1-1" data-toggle="tab">LOGBOOK YANG DIAJUKAN</a></li>
                  <li><a href="#tab_2-2" data-toggle="tab">HASIL VALIDASI</a></li>
                  <li class="pull-left header"><i class="fa fa-th"></i> <?php echo $instance_name; ?> </li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1-1">
                      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                        <div class="box-header with-border">
                           <h3 class="box-title"></h3>
                        </div>
                        <div class="box-body">
                          <div class="box-tools pull-right">
                      <?php
                        input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
                      ?>
                          </div>
                          <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
                            <thead>
                              <tr>
                                <th width="5%"></th>
                                <th style="text-align:center;vertical-align:middle;font-weight:bold;display: none;">ID</th>
                                <th style="text-align:center;vertical-align:middle;font-weight:bold;">Tanggal</th>
                                <th style="text-align:center;vertical-align:middle;font-weight:bold;">PK</th>
                                <th style="text-align:center;vertical-align:middle;font-weight:bold;">Nama Kewenangan</th>
                              </tr>
                            </thead>
                          </table>
                        </div>
                      </div>
                  </div>
                  <div class="tab-pane" id="tab_2-2">
                  <div class="box-body table-responsive no-padding">
                    <table width="100%" class="table table-hover">
                      <thead>
                      <tr>
                        <th style="background-color:#9b0e27;color:white;text-align:center;vertical-align: middle;">Waktu</th>
                        <th style="background-color:#9b0e27;color:white;text-align:left;vertical-align: middle;">Kewenangan</th>
                        <th style="background-color:#9b0e27;color:white;text-align:center;vertical-align: middle;">Jabatan</th>
                        <th style="background-color:#9b0e27;color:white;text-align:center;vertical-align: middle;">Nama</th>
                        <th style="background-color:#9b0e27;color:white;text-align:center;vertical-align: middle;">Hasil</th>
                        <th style="background-color:#9b0e27;color:white;text-align:center;vertical-align: middle;">Result Tolak</th>
                      </tr>
                      </thead>
                      <tbody>
                        <?php
                        foreach($ambil_lobook_validasi_group_pengajuan as $row){
                        ?>
                      <tr>
                        <td style="text-align:center;"><?php echo date('d-m-Y H:i:s', strtotime($row['wkt_logbook_validasi'])); ?></td>
                        <td style="text-align:left;"><?php echo $row['nama_kewenangan']; ?></td>
                        <td style="text-align:center;"><?php echo $row['nama_ms_struktur']; ?></td>
                        <td style="text-align:center;"><?php echo $row['nama_pegawai']; ?></td>
                        <td style="text-align:center;">
                          <?php  
                            if($row['validasi'] == 1){
                              echo '<button class="btn btn-xs btn-warning"> Setuju</button>';
                            }elseif($row['validasi'] == 2){
                              echo '<button class="btn btn-xs btn-danger"> Tolak</button>';
                            }else{
                              echo '<button class="btn btn-xs btn-success"> Proses</button>';
                            }
                          ?>
                        </td>
                        <td style="text-align:center;">
                          <?php  
                            if($row['result_tolak'] == 1){
                              echo '<button class="btn btn-xs btn-danger"> Supervisi</button>';
                            }elseif($row['result_tolak'] == 2){
                              echo '<button class="btn btn-xs btn-danger"> Tidak Kompeten</button>';
                            }else{
                              echo '';
                            }
                          ?>
                        </td>
                      </tr>
                        <?php
                          }
                        ?>
                      </tbody>
                    </table>
                  </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php echo form_close(); ?>
        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
       <?php echo $instance_name; ?>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<style>
#chartdiv {
  width: 100%;
  height: 500px;
}
</style>
<?php
}
elseif ($page=="berkas_logbook")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
    <a href="<?php echo base_url('s_pengajuan/pengajuan_kompetensi/isi/'.$id);?>"
      class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
    </a>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">PILIH KEWENANGAN</h3>
          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
          <table id="example1" width="100%" class="table table-bordered table-striped table-hover" >
            <thead>
            <tr>
              <th style="width:5%;text-align:center;vertical-align:middle;">
                <input name="select_all" class="checkall" type="checkbox" />
              </th>
                <th style="text-align:center;vertical-align:middle;font-weight:bold;">Tanggal</th>
                <th style="text-align:center;vertical-align:middle;font-weight:bold;">Nama Kewenangan</th>
              <th style="text-align:center;vertical-align:middle;font-weight:bold;">PK</th>
            </tr>
            </thead>
            <tbody>
              <?php
              $kondisi=array('id_logbooker'=>$this->session->id_pegawai,'tolak >'=> 0);
              $tolake = $this->m_umum->ambil_data_kondisi_result('s_logbook',$kondisi);
              $kw_tolak = array();
              foreach($tolake as $valambil_kw_tolak){
                  $kw_tolak[] = $valambil_kw_tolak['id_kewenangan'];
              }
              $eimplokw_tolak = implode(",", $kw_tolak);
              foreach($logbook_pengajuan as $row){
                if (in_array($row['id_kewenangan'],explode(",", $eimplokw_tolak))){ 
                  $tol = ' - <b><font color="red">TOLAK</font></b>'; 
                }else{ 
                  $tol = ''; 
                }
              ?>
            <tr>
              <td style="vertical-align:middle;text-align:center;">
                <div class="checkbox">
                <label>
                  <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_logbook'];?>">
                </label>
                </div>
              </td>
              <td style="vertical-align:middle;text-align:center;"><?php echo $row['tgl_logbook']; ?></td>
              <td style="vertical-align:middle;"><?php echo $row['nama_kewenangan']; ?> <?php echo $tol; ?></td>
              <td style="vertical-align:middle;text-align:center;"><?php echo $row['nama_kode_kewenangan']; ?>
                <?php input_text("id_kewenangan[]",$row['id_kewenangan'],"","","hidden"); ?>
              </td>
            </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
        </div>
        <div class="box-footer">
          <button type="submit" name="action" value="BtnSimpan" class="btn btn-primary pull-left"><i class="fa fa-save"></i> SUBMIT</button>
        </div>
      </div>
      <?php 
        echo form_close(); 
      ?>
    </section>
</div>
<?php
}
elseif ($page=="berkas_ijasah")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
    <a href="<?php echo base_url('s_pengajuan/pengajuan_kompetensi/isi/'.$id);?>"
      class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
    </a>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
      <?php
        input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
                <th width="5%" style="display:none;">ID</th>
                <th>Nama Instansi</th>
                <th>Jenjang Pendidikan</th>
                <th>No Ijasah</th>
                <th>Lulus Tahun</th>
                <th><i class="fa fa-search"></i> </th>
          </tr>
        </thead>
      </table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="berkas_str")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
    <a href="<?php echo base_url('s_pengajuan/pengajuan_kompetensi/isi/'.$id);?>"
      class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
    </a>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?> <small>  <?php echo $instance_name; ?> </small></h3>
          <div class="box-tools pull-right">
      <?php
        input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
          <thead>
          <tr>
            <th width="5%" style="display:none;">ID</th>
            <th>Nama File</th>
            <th>Nama Berkas</th>
            <th>No STR/SIK/SIP</th>
            <th>Berlaku</th>
            <th>Expired</th>
            <th>Status</th>
            <th><i class="fa fa-search"></i> </th>
          </tr>
          </thead>
      </table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="berkas_sertifikat")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
    <a href="<?php echo base_url('s_pengajuan/pengajuan_kompetensi/isi/'.$id);?>"
      class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
    </a>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?> <small>  <?php echo $instance_name; ?> </small></h3>
          <div class="box-tools pull-right">
      <?php
        input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
          <thead>
          <tr>
            <th width="5%"></th>
            <th width="5%" style="display:none;">ID</th>
            <th>Nama Pelatihan</th>
            <th>SKP / SKS</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Selesai</th>
            <th><i class="fa fa-search"></i> </th>
          </tr>
          </thead>
      </table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="berkaslain_berkas")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
    <a href="<?php echo base_url('s_pengajuan/pengajuan_kompetensi/isi/'.$id);?>"
      class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
    </a>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $header; ?> <small>  <?php echo $instance_name; ?> </small></h3>
          <div class="box-tools pull-right">
      <?php
        input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
          <thead>
          <tr>
            <th width="5%" style="display:none;">ID</th>
            <th>Nama File</th>
            <th>No File</th>
            <th>Kategori</th>
            <th><i class="fa fa-search"></i> </th>
          </tr>
          </thead>
      </table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="berkas_etik")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
    <a href="<?php echo base_url('s_pengajuan/pengajuan_kompetensi/isi/'.$id);?>"
      class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
    </a>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
      <?php
        input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th>Tanggal</th>
            <th>Jam</th>
            <th>Jumlah Soal</th>
            <th>Nilai</th>
            <th>Hasil</th>
            <th>Penguji</th>
          </tr>
        </thead>
      </table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<?php
}