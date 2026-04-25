<?php
//=================================== H O M E ================================================
$arraybox = array('warning','success','info','danger');
$resarray = array_rand($arraybox);
$thenarray = $arraybox[$resarray];
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
           <h3 class="box-title"><?php echo $title; ?></h3>

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
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="format_hasil")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_close.png') no-repeat center center;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <table id="dttb" style="width:100%" class="table table-hover table-transaksi table-sm">
            <thead>
              <tr>
                <th style="width: 5%;"></th>
                <th style="width: 5%;display:none;"></th>
                <th>Pemeriksaan</th>
                <th>Nama Format</th>
              </tr>
            </thead>
          </table> 
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
         <small><?php echo $instance_name; ?></small>
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
elseif ($page=="format_hasil_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('radiolog/format_hasil/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
          <div class="row">
            <div class="col-md-12">
                <label>Nama Format</label>
                <?php
                  input_text("nama_pemeriksaan_format",$nama_pemeriksaan_format,"maxlength='255' required autofocus","Masukkan Nama","text");
                ?>  
            </div>    
            <div class="col-md-12">
                <label>Tindakan</label>
                  <?php
                    input_pdselect2("id_tindakan",$cmd_tindakan,$id_tindakan);
                  ?>          
            </div>
            <div class="col-md-12">
                <label>Hasil</label>
                  <?php
                    input_textareacustom("hasil_pemeriksaan_format",$hasil_pemeriksaan_format," id='editor1' rows='10' cols='100' class='form-control' ","Masukkan Format Hasil");
                  ?>          
            </div>
            <div class="col-md-12">
                <label>Kesimpulan</label>
                  <?php
          input_textareacustom("kesimpulan_pemeriksaan_format",$kesimpulan_pemeriksaan_format," id='editor2' rows='10' cols='100' class='form-control' ","Masukkan Kesimpulan");
                  ?>          
            </div>
          </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
  CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
  CKEDITOR.replace('editor2', {enterMode: CKEDITOR.ENTER_BR});
}); 
</script>
<?php
}
elseif ($page=="format_hasil_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('radiolog/format_hasil/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_pemeriksaan_format" value="<?= $id_pemeriksaan_format; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">FORMAT HASIL</h3>
        </div>
        <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                  <label>Nama Format</label>
                  <?php
                    input_text("nama_pemeriksaan_format",$nama_pemeriksaan_format,"maxlength='255' required autofocus","Masukkan Nama","text");
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Hasil</label>
                    <?php
                      input_textareacustom("hasil_pemeriksaan_format",$hasil_pemeriksaan_format," id='editor1' rows='10' cols='100' class='form-control' ","Masukkan Format Hasil");
                    ?>          
              </div>
              <div class="col-md-12">
                  <label>Kesimpulan</label>
                    <?php
            input_textareacustom("kesimpulan_pemeriksaan_format",$kesimpulan_pemeriksaan_format," id='editor2' rows='10' cols='100' class='form-control' ","Masukkan Kesimpulan");
                    ?>          
              </div>
            </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
  CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
  CKEDITOR.replace('editor2', {enterMode: CKEDITOR.ENTER_BR});
}); 
</script>
<?php
}
elseif ($page=="daftar_data_lab")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_close.png') no-repeat center center;
}
ul.no-bullets {
  list-style-type: none; /* Remove bullets */
  padding: 0; /* Remove padding */
  margin: 15; /* Remove margins */
}
.select2-container {
    width: 90% !important;
    padding: 0;
}
#chartdiv {
  width: 100%;
  height: 500px;
}
table.dataTable tbody tr.selected {
  color:#fff;
  background-color: #0088cc !important;
  border: 1px solid #2083eb;
}
table.dataTable tbody td {
    word-break: break-word;
    vertical-align: top;
}
.text-wrap{
    white-space:normal;
}
.width-200{
    width:200px;
}
ul {
  list-style-type: none;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">     
      <a href="<?php echo $kembali;?>"
        class="btn btn-info" > <i class="fa fa-reply"></i> Kembali
      </a>
      <div class="box-tools pull-right">
         <h3>WAKTU PENDAFTARAN : <?= $wkt_daftar ?></h3>
      </div>
    </section>
    <section class="content">

      <div class="row">
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li><a href="<?php echo base_url('radiolog/daftar/tambah/'.$first_date);?>">Pemeriksaan</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_dokter/'.$first_date);?>" >Dokter</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_penunjang/'.$first_date);?>" >Penunjang Luar</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_vital/'.$first_date);?>" >Hasil Pemeriksaan Pasien</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_asuhan/'.$first_date);?>" >Asuhan Keperawatan</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_radiolog/'.$first_date);?>" >Radiologi</a></li>
              <li class="active"><a href="<?php echo base_url('radiolog/daftar/data_lab/'.$first_date);?>" >Laboratorium</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_apotek/'.$first_date);?>" >Apotek</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_ps/'.$first_date);?>" >Riwayat Kunjungan</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/grafik_vital/'.$first_date);?>" >Vital Sign</a></li>
              <li class="pull-right"><h3><i class="fa fa-server"></i> E REKAM MEDIS</h3></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active">
                <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                  <div class="box-header with-border">
                     <h3 class="box-title"><?php echo $title; ?></h3>
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                          <i class="fa fa-minus"></i></button>
                      </div>
                  </div>
                  <div class="box-body">
                    <div class="row">
                    <div class="col-md-12">
                      <table id="dttb" style="width:100%" class="table table-hover table-transaksi table-sm">
                        <thead>
                          <tr>
                            <th style="width: 5%;"></th>
                            <th>Tanggal</th>
                            <th>NO Pendaftaran</th>
                            <th>NO Hasil</th>
                            <th>Pengirim</th>
                          </tr>
                        </thead>
                      </table> 
                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.tab-content -->
          </div>
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
         <small><?php echo $instance_name; ?></small>
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
elseif ($page=="daftar_lab_view")
{
?>
  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
       <h3 class="box-title"><?php echo $title; ?></h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
            <i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body">
      <div class="row">
        <?php  
          foreach($lab as $rowlab){
        ?>
          <div class="col-md-12">
            <div class="box-body box-profile">
              <h3 class="profile-username" style="font-weight:bold;">No Pendaftran : <?= $rowlab['no_pendaftaran'] ?></h3>
          <?php  
            $labpu = $this->m_ol_rancak->ambil_pemeriksaan_laboratorium_pu($rowlab['barcode_pemeriksaan']);
            foreach($labpu as $rowlabpu){
          ?>
              <h3 class="profile-username" style="font-weight:bold;">Tanggal : <?= $rowlabpu['tgl_pendaftaran_unit'] ?></h3>
              <h3 class="profile-username" style="font-weight:bold;">
                Analis : <br>
                <?php
                $labanalis = $this->m_ol_rancak->ambil_pemeriksaan_laboratorium_analis($rowlabpu['barcode_pemeriksaan']);
                  foreach($labanalis as $rowlabanalis){
                  echo  '<b>'.$rowlabanalis['nama_pegawai'].'</b><br>';
                  }
                 ?>
               <br> Penanggung Jawab :<br> 
                <?php  
                $labpj = $this->m_ol_rancak->ambil_pemeriksaan_laboratorium_pj($rowlabpu['barcode_pemeriksaan']);
                  foreach($labpj as $rowlabpj){
                   echo '<b>'.$rowlabpj['nama_pegawai'].'</b><br><br>';
                  }
                 ?>
           <div class="table-responsive">
            <table width="100%" class="table table-bordered">
              <thead>
                <tr>
                  <th>Nama Test</th>
                  <th style="vertical-align:middle;text-align: center;">Hasil</th>
                  <th style="vertical-align:middle;text-align: center;">Satuan</th>
                  <th style="vertical-align:middle;text-align: center;">Nilai Rujukan</th>
                  <th style="vertical-align:middle;text-align: center;">Metode</th>
                </tr>
              </thead>
              <tbody>
                <?php  
            $kgp = $this->m_ol_rancak->ambil_pemeriksaan_laboratorium_kgp($first_date,$rowlab['barcode_pendaftaran_unit']);
            foreach($kgp as $rowkgp){
                ?>
                  <tr>
                    <td style="font-weight:bold;" colspan="5"><?= $rowkgp['nama_golongan_pemeriksaan'] ?></td>
                  </tr>
                <?php  
            $lres = $this->m_ol_rancak->ambil_pemeriksaan_laboratorium($first_date,$rowkgp['id_golongan_pemeriksaan']);
            foreach($lres as $rowlres){
                ?>
                <tr>
                  <td><?= $rowlres['nama_tindakan'] ?></td>
                  <td style="vertical-align:middle;text-align: center;"><?= $rowlres['hasil_lresult'] ?></td>
                  <td style="vertical-align:middle;text-align: center;"><?= $rowlres['satuan_lformat'] ?></td>
                  <td style="vertical-align:middle;text-align: center;"><?= $rowlres['nilai_rujukan_lformat'] ?></td>
                  <td style="vertical-align:middle;text-align: center;"><?= $rowlres['metode_lformat'] ?></td>
                </tr>
                <?php 
            }
            }
                ?>
              </tbody>
            </table>
            </div>              </h3> 

          <?php 
            }
          ?>
        <?php  
          }
        ?>
      </div>
    </div>
  </div>
<?php
}
elseif ($page=="daftar_data_radiologi")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_close.png') no-repeat center center;
}
ul.no-bullets {
  list-style-type: none; /* Remove bullets */
  padding: 0; /* Remove padding */
  margin: 15; /* Remove margins */
}
.select2-container {
    width: 90% !important;
    padding: 0;
}
#chartdiv {
  width: 100%;
  height: 500px;
}
table.dataTable tbody tr.selected {
  color:#fff;
  background-color: #0088cc !important;
  border: 1px solid #2083eb;
}
table.dataTable tbody td {
    word-break: break-word;
    vertical-align: top;
}
.text-wrap{
    white-space:normal;
}
.width-200{
    width:200px;
}
ul {
  list-style-type: none;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">     
      <a href="<?php echo $kembali;?>"
        class="btn btn-info" > <i class="fa fa-reply"></i> Kembali
      </a>
      <div class="box-tools pull-right">
         <h3>TANGGAL PENDAFTARAN : <?= $wkt_daftar ?></h3>
      </div>
    </section>
    <section class="content">

      <div class="row">
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li><a href="<?php echo base_url('radiolog/daftar/data_dokter/'.$first_date);?>" >Dokter</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_penunjang/'.$first_date);?>" >Penunjang Luar</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_vital/'.$first_date);?>" >Hasil Pemeriksaan Pasien</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_asuhan/'.$first_date);?>" >Asuhan Keperawatan</a></li>
              <li class="active"><a href="<?php echo base_url('radiolog/daftar/data_radiologi/'.$first_date);?>" >Radiologi</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_lab/'.$first_date);?>" >Laboratorium</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_apotek/'.$first_date);?>" >Apotek</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_ps/'.$first_date);?>" >Riwayat Kunjungan</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/grafik_vital/'.$first_date);?>" >Vital Sign</a></li>
              <li class="pull-right"><h3><i class="fa fa-server"></i> E REKAM MEDIS</h3></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active">
                <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                  <div class="box-header with-border">
                     <h3 class="box-title"><?php echo $title; ?></h3>
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                          <i class="fa fa-minus"></i></button>
                      </div>
                  </div>
                  <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                          <table id="dttb" style="width:100%" class="table table-hover table-transaksi table-sm">
                            <thead>
                              <tr style="background-color: #29675B;color: white;">
                                <th class="text-sm text-label text-left border-0" style="width: 5%"></th>
                                <th class="text-sm text-label text-left border-0" style="width: 15%">Waktu</th>
                                <th class="text-sm text-label text-left border-0" >Kode</th>
                                <th class="text-sm text-label text-left border-0" >Tindakan</th>
                                <th class="text-sm text-label text-left border-0" >Radiolog</th>
                                <th class="text-sm text-label text-left border-0" >Kritis</th>
                              </tr>
                            </thead>
                          </table> 
                        </div> 
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.tab-content -->
          </div>
        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="daftar_data_dokter")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_close.png') no-repeat center center;
}
ul.no-bullets {
  list-style-type: none; /* Remove bullets */
  padding: 0; /* Remove padding */
  margin: 15; /* Remove margins */
}
.select2-container {
    width: 90% !important;
    padding: 0;
}
#chartdiv {
  width: 100%;
  height: 500px;
}
table.dataTable tbody tr.selected {
  color:#fff;
  background-color: #0088cc !important;
  border: 1px solid #2083eb;
}
table.dataTable tbody td {
    word-break: break-word;
    vertical-align: top;
}
.text-wrap{
    white-space:normal;
}
.width-200{
    width:200px;
}
ul {
  list-style-type: none;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">     
      <a href="<?php echo $kembali;?>"
        class="btn btn-info" > <i class="fa fa-reply"></i> Kembali
      </a>
      <div class="box-tools pull-right">
         <h3>WAKTU PENDAFTARAN : <?= $wkt_daftar ?></h3>
      </div>
    </section>
    <section class="content">

      <div class="row">
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="<?php echo base_url('radiolog/daftar/data_dokter/'.$first_date);?>" >Dokter</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_penunjang/'.$first_date);?>" >Penunjang Luar</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_vital/'.$first_date);?>" >Hasil Pemeriksaan Pasien</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_asuhan/'.$first_date);?>" >Asuhan Keperawatan</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_radiologi/'.$first_date);?>" >Radiologi</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_lab/'.$first_date);?>" >Laboratorium</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_apotek/'.$first_date);?>" >Apotek</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_ps/'.$first_date);?>" >Riwayat Kunjungan</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/grafik_vital/'.$first_date);?>" >Vital Sign</a></li>
              <li class="pull-right"><h3><i class="fa fa-server"></i> E REKAM MEDIS</h3></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active">
                <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                  <div class="box-header with-border">
                     <h3 class="box-title"><?php echo $title; ?></h3>
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                          <i class="fa fa-minus"></i></button>
                      </div>
                  </div>
                  <div class="box-body">
                    <div class="row">
                      <?php  
                        foreach($dokter as $rowdokter){
                      ?>
                        <div class="col-md-12">
                        <div class="box-header with-border">
                           <div class="box-title">No Pendaftaran : <?= $rowdokter['no_pendaftaran'] ?></div>
                              <p>Tanggal Periksa : <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($rowdokter['waktu_pemeriksaan_dokter']))); ?><br>
                              Pemeriksa : <?= $rowdokter['perawate'] ?><br>
                              Keluhan : <?= $rowdokter['keluhan'] ?><br>
                              Keterangan : <?= $rowdokter['ket_pendaftaran_unit'] ?></p>
                              <div class="box-tools pull-right">
                              <p>Cara Bayar : <?= $rowdokter['nama_bayar'] ?><br>
                              Pengirim : <?= $rowdokter['nama_instansi'] ?> <?= $rowdokter['nama_dokter'] ?><br>
                              Admin : <?= $rowdokter['nama_pegawai'] ?></p>
                              </div>
                        </div>
                          <div class="box-body box-profile">
                            <h3 class="profile-username" style="font-weight:bold;">Dokter : <?= $rowdokter['dr_pemeriksa'] ?></h3> 
                          </div>
                          <div class="col-md-6">
                            <p style="font-size:12px;font-weight:bold;">SUBJEKTIF</p>
                            <p><?= $rowdokter['subjective'] ?></p>
                          </div> 
                          <div class="col-md-6">
                            <p style="font-size:12px;font-weight:bold;">OBJEKTIF</p>
                            <p><?= $rowdokter['objective'] ?></p>
                          </div> 
                          <div class="col-md-6">
                            <p style="font-size:12px;font-weight:bold;">ASESMEN</p>
                            <p><?= $rowdokter['asesment'] ?></p>
                          </div> 
                          <div class="col-md-6">
                            <p style="font-size:12px;font-weight:bold;">PLANING</p>
                            <p><?= $rowdokter['planning'] ?></p>
                          </div> 
                          <div class="col-md-6">
                            <p style="font-size:12px;font-weight:bold;">IMPLEMENTASI</p>
                            <p><?= $rowdokter['implementasi'] ?></p>
                          </div> 
                          <div class="col-md-6">
                            <p style="font-size:12px;font-weight:bold;">DIAGNOSA 1</p>
                            <p><?= $rowdokter['cd1'] ?></p>
                            <p style="font-size:12px;font-weight:bold;">DIAGNOSA 2</p>
                            <p><?= $rowdokter['cd2'] ?></p>
                            <p style="font-size:12px;font-weight:bold;">DIAGNOSA 3</p>
                            <p><?= $rowdokter['cd3'] ?></p>
                          </div> 
                        </div> 
                      <?php  
                        }
                      ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.tab-content -->
          </div>
        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="daftar_data_vital")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
ul.no-bullets {
  list-style-type: none; /* Remove bullets */
  padding: 0; /* Remove padding */
  margin: 15; /* Remove margins */
}
.select2-container {
    width: 90% !important;
    padding: 0;
}
#chartdiv {
  width: 100%;
  height: 500px;
}
table.dataTable tbody tr.selected {
  color:#fff;
  background-color: #0088cc !important;
  border: 1px solid #2083eb;
}
table.dataTable tbody td {
    word-break: break-word;
    vertical-align: top;
}
.text-wrap{
    white-space:normal;
}
.width-200{
    width:200px;
}
ul {
  list-style-type: none;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">     
      <a href="<?php echo $kembali;?>"
        class="btn btn-info" > <i class="fa fa-reply"></i> Kembali
      </a>
      <div class="box-tools pull-right">
         <h3>WAKTU PENDAFTARAN : <?= $wkt_daftar ?></h3>
      </div>
    </section>
    <section class="content">

      <div class="row">
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li><a href="<?php echo base_url('radiolog/daftar/data_dokter/'.$first_date);?>" >Dokter</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_penunjang/'.$first_date);?>" >Penunjang Luar</a></li>
              <li class="active"><a href="<?php echo base_url('radiolog/daftar/data_vital/'.$first_date);?>" >Hasil Pemeriksaan Pasien</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_asuhan/'.$first_date);?>" >Asuhan Keperawatan</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_radiologi/'.$first_date);?>" >Radiologi</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_lab/'.$first_date);?>" >Laboratorium</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_apotek/'.$first_date);?>" >Apotek</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_ps/'.$first_date);?>" >Riwayat Kunjungan</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/grafik_vital/'.$first_date);?>" >Vital Sign</a></li>
              <li class="pull-right"><h3><i class="fa fa-server"></i> E REKAM MEDIS</h3></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active">
                <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                  <div class="box-header with-border">
                     <h3 class="box-title"><?php echo $title; ?></h3>
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                          <i class="fa fa-minus"></i></button>
                      </div>
                  </div>
                  <div class="box-body">
                        <?php 
                          foreach ($vital as $rowvital){ 
                            $waktu_pemeriksaan_ku = $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($rowvital['waktu_pemeriksaan_vital_sign'])));
                            if($rowvital['hamil'] == 1){ $hamil = 'Hamil';}else{$hamil  = 'Tidak Hamil';}
                        ?>
                        <div class="col-md-12">
<input value="<?php echo $rowvital['nama_triase']; ?>" class="form-control" readonly style="text-shadow: 0.000em 0.075em #608b31, 0.029em 0.069em #608b31, 0.053em 0.053em #608b31, 0.069em 0.029em #608b31, 0.075em 0.000em #608b31, 0.069em -0.029em #608b31, 0.053em -0.053em #608b31, 0.029em -0.069em #608b31, 0.000em -0.075em #608b31, -0.029em -0.069em #608b31, -0.053em -0.053em #608b31, -0.069em -0.029em #608b31, -0.075em -0.000em #608b31, -0.069em 0.029em #608b31, -0.053em 0.053em #608b31, -0.029em 0.069em #608b31;color: white;font-weight:bold;background-color:<?php echo $rowvital['warna_triase']; ?>;text-align:center;">
                        <div class="box-header with-border">
                           <div class="box-title">No Pendaftaran : <?= $rowvital['no_pendaftaran'] ?></div>
                              <p>Tanggal Periksa : <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($rowvital['waktu_pemeriksaan_vital_sign']))); ?><br>
                              Pemeriksa : <?= $rowvital['perawate'] ?><br>
                              Keluhan : <?= $rowvital['keluhan'] ?><br>
                              Keterangan : <?= $rowvital['ket_pendaftaran_unit'] ?></p>
                              <div class="box-tools pull-right">
                              <p>Cara Bayar : <?= $rowvital['nama_bayar'] ?><br>
                              Pengirim : <?= $rowvital['nama_instansi'] ?> <?= $rowvital['nama_dokter'] ?><br>
                              Admin : <?= $rowvital['nama_pegawai'] ?></p>
                              </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                      <div class="box-body box-profile">
                        <h3 class="profile-username text-center" style="font-weight:bold;">KEADAAN VITAL</h3>
                        <p class="text-muted text-center" style="font-weight:bold;"><?= $waktu_pemeriksaan_ku ?></p>

                        <ul class="list-group list-group-unbordered">
          <li class="list-group-item"><b>Hamil</b> <a class="pull-right"><?php echo $hamil; ?></a></li>
          <li class="list-group-item"><b>Tinggi Badan</b> <a class="pull-right"><?php echo $rowvital['tb']; ?></a></li>        
          <li class="list-group-item"><b>Berat Badan</b> <a class="pull-right"><?php echo $rowvital['bb']; ?></a></li>
          <li class="list-group-item"><b>Tensi</b> <a class="pull-right"><?php echo $rowvital['sistole']; ?> / <?php echo $rowvital['diastole']; ?></a></li>
          <li class="list-group-item"><b>RR</b> <a class="pull-right"><?php echo $rowvital['rr']; ?></a></li>        
          <li class="list-group-item"><b>Nadi</b> <a class="pull-right"><?php echo $rowvital['nadi']; ?></a></li>
          <li class="list-group-item"><b>SUhu</b> <a class="pull-right"><?php echo $rowvital['suhu']; ?></a></li>
          <li class="list-group-item"><b>SPO2</b> <a class="pull-right"><?php echo $rowvital['spo2']; ?></a></li>
          <li class="list-group-item"><b>GCS Eye</b> 
      <a class="pull-right">
        <?php $eye = $this->m_umum->ambil_data('kol_gcs_eye','id_gcs_eye',$rowvital['id_gcs_eye']); echo $eye['nama_gcs_eye'].', Skor : '.$eye['skor_gcs_eye']; ?>              
      </a>
          </li>
          <li class="list-group-item"><b>GCS Motorik</b> 
      <a class="pull-right">
        <?php $motorik = $this->m_umum->ambil_data('kol_gcs_motorik','id_gcs_motorik',$rowvital['id_gcs_motorik']); echo $motorik['nama_gcs_motorik'].', Skor : '.$motorik['skor_gcs_motorik']; ?>              
      </a>
          </li>
          <li class="list-group-item"><b>GCS Verbal</b> 
      <a class="pull-right">
        <?php $verb = $this->m_umum->ambil_data('kol_gcs_verb','id_gcs_verb',$rowvital['id_gcs_verb']); echo $verb['nama_gcs_verb'].', Skor : '.$verb['skor_gcs_verb']; ?>              
      </a>
          </li>
          <li class="list-group-item"><b>Keterangan</b> <a class="pull-right"><?php echo $rowvital['ket_pemeriksaan_vital_sign']; ?></a></li>
          <li class="list-group-item"><b>Masalah dalam Berbicara</b> <a class="pull-right"><?php echo $rowvital['talk_problem']; ?></a></li>
          <li class="list-group-item"><b>Kebiasaan</b> <a class="pull-right"><?php echo $rowvital['habit']; ?></a></li>
          <li class="list-group-item"><b>Penyakit Penyerta</b> <a class="pull-right"><?php echo $rowvital['hereditary']; ?></a></li>
          <li class="list-group-item"><b>Komplikasi</b> <a class="pull-right"><?php echo $rowvital['komplikasi']; ?></a></li>
                        </ul>
                      </div> 
                    </div> 
                    <div class="col-md-6">
                      <div class="box-body box-profile">
                        <h3 class="profile-username text-center" style="font-weight:bold;">KEADAAN FISIK</h3>
                        <p class="text-muted text-center" style="font-weight:bold;"><?= $waktu_pemeriksaan_ku ?></p>
                        <ul class="list-group list-group-unbordered">
          <li class="list-group-item"><b>Jalan Napas</b> 
      <a class="pull-right">
        <?php $jalan_napas = $this->m_umum->ambil_data('kol_jalan_napas','id_jalan_napas',$rowvital['id_jalan_napas']); echo $jalan_napas['nama_jalan_napas']; ?>      
      </a>
          </li>
          <li class="list-group-item"><b>Pernapasan</b> 
      <a class="pull-right">
        <?php $pernapasan = $this->m_umum->ambil_data('kol_pernapasan','id_pernapasan',$rowvital['id_pernapasan']); echo $pernapasan['nama_pernapasan']; ?>      
      </a>
          </li>
          <li class="list-group-item"><b>Nyeri</b> 
      <a class="pull-right">
        <?php $nyeri = $this->m_umum->ambil_data('kol_nyeri','id_nyeri',$rowvital['id_nyeri']); echo $nyeri['nama_nyeri']; ?>      
      </a>
          </li>
          <li class="list-group-item"><b>Lokasi Nyeri</b> <a class="pull-right"><?php echo $rowvital['nyeri_lokasi']; ?></a></li>
          <li class="list-group-item"><b>Nyeri Hilang Apabila</b> <a class="pull-right"><?php echo $rowvital['nyeri_hilang']; ?></a></li>
          <li class="list-group-item"><b>Nutrisi</b> 
      <a class="pull-right">
        <?php $nutrisi = $this->m_umum->ambil_data('kol_nutrisi','id_nutrisi',$rowvital['id_nutrisi']); echo $nutrisi['nama_nutrisi']; ?>      
      </a>
          </li>
          <li class="list-group-item"><b>Riwayat Alergi</b> <a class="pull-right"><?php echo $rowvital['riwayat_alergi']; ?></a></li>         
          <li class="list-group-item"><b>Geriatri</b> 
      <a class="pull-right">
        <?php $geriatri = $this->m_umum->ambil_data('kol_geriatri','id_geriatri',$rowvital['id_geriatri']); echo $geriatri['nama_geriatri']; ?>      
      </a>
          </li>
          <li class="list-group-item"><b>Edmonson</b> 
      <a class="pull-right">
        <?php $edmonson = $this->m_umum->ambil_data('kol_edmonson','id_edmonson',$rowvital['id_edmonson']); echo $edmonson['nama_edmonson']; ?>      
      </a>
          </li>
          <li class="list-group-item"><b>Morse</b> 
      <a class="pull-right">
        <?php $morse = $this->m_umum->ambil_data('kol_morse','id_morse',$rowvital['id_morse']); echo $morse['nama_morse']; ?>      
      </a>
          </li>
          <li class="list-group-item"><b>Humpty Dumpty</b> 
      <a class="pull-right">
        <?php $hd = $this->m_umum->ambil_data('kol_hd','id_hd',$rowvital['id_hd']); echo $hd['nama_hd']; ?>      
      </a>
          </li>
          <li class="list-group-item"><b>Sirkulasi</b></li> 
          <li class="list-style-type"><p></p></li>
          <li class="list-style-type">
            <p style="padding-left: 30px;">
              <?php $sirkulasi = $this->m_umum->ambil_data_explode('kol_sirkulasi','id_sirkulasi',$rowvital['sirkulasi']); 
                foreach ($sirkulasi as $rowsirkulasi){
                   echo $rowsirkulasi['nama_sirkulasi'].', ';
                }
              ?> 
            </p>
          </li> 
          <li class="list-group-item"><b>Kasus</b></li> 
          <li class="list-style-type"><p></p></li>
          <li class="list-style-type">
            <p style="padding-left: 30px;">
              <?php $kasus = $this->m_umum->ambil_data_explode('kol_kasus','id_kasus',$rowvital['kasus']);
                foreach ($kasus as $rowkasus){
                   echo $rowkasus['nama_kasus'].', ';
                }
              ?> 
            </p>
          </li> 
          <li class="list-group-item"><b>Respon</b></li> 
          <li class="list-style-type"><p></p></li>
          <li class="list-style-type">
            <p style="padding-left: 30px;">
              <?php $respon = $this->m_umum->ambil_data_explode('kol_respon','id_respon',$rowvital['respon']); 
                foreach ($respon as $rowrespon){
                   echo $rowrespon['nama_respon'].', ';
                }
              ?> 
            </p>
          </li> 
                        </ul>
                      </div> 
                    </div> 
                        <?php  
                          }
                        ?> 
                  </div>
                </div>
              </div>
            </div>
            <!-- /.tab-content -->
          </div>
        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="daftar_data_ps")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_close.png') no-repeat center center;
}
ul.no-bullets {
  list-style-type: none; /* Remove bullets */
  padding: 0; /* Remove padding */
  margin: 15; /* Remove margins */
}
.select2-container {
    width: 90% !important;
    padding: 0;
}
#chartdiv {
  width: 100%;
  height: 500px;
}
table.dataTable tbody tr.selected {
  color:#fff;
  background-color: #0088cc !important;
  border: 1px solid #2083eb;
}
table.dataTable tbody td {
    word-break: break-word;
    vertical-align: top;
}
.text-wrap{
    white-space:normal;
}
.width-200{
    width:200px;
}
ul {
  list-style-type: none;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">     
      <a href="<?php echo $kembali;?>"
        class="btn btn-info" > <i class="fa fa-reply"></i> Kembali
      </a>
      <div class="box-tools pull-right">
         <h3>WAKTU PENDAFTARAN : <?= $wkt_daftar ?></h3>
      </div>
    </section>
    <section class="content">

      <div class="row">
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li><a href="<?php echo base_url('radiolog/daftar/data_dokter/'.$first_date);?>" >Dokter</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_penunjang/'.$first_date);?>" >Penunjang Luar</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_vital/'.$first_date);?>" >Hasil Pemeriksaan Pasien</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_asuhan/'.$first_date);?>" >Asuhan Keperawatan</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_radiologi/'.$first_date);?>" >Radiologi</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_lab/'.$first_date);?>" >Laboratorium</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_apotek/'.$first_date);?>" >Apotek</a></li>
              <li class="active"><a href="<?php echo base_url('radiolog/daftar/data_ps/'.$first_date);?>" >Riwayat Kunjungan</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/grafik_vital/'.$first_date);?>" >Vital Sign</a></li>
              <li class="pull-right"><h3><i class="fa fa-server"></i> E REKAM MEDIS</h3></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active">
                <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                  <div class="box-header with-border">
                     <h3 class="box-title"><?php echo $title; ?></h3>
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                          <i class="fa fa-minus"></i></button>
                      </div>
                  </div>
                  <div class="box-body">
                    <div class="row">
                    <div class="col-md-8">
                      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                        <div class="box-header with-border">
                           <h3 class="box-title"><?php echo $title; ?></h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                    title="Collapse">
                              <i class="fa fa-minus"></i></button>
                          </div>
                        </div>
                        <div class="box-body">
                          <table id="dttb" style="width:100%" class="table table-hover table-transaksi table-sm">
                            <thead>
                              <tr style="background-color: #29675B;color: white;">
                                <th class="text-sm text-label text-left border-0" style="width: 5%"></th>
                                <th class="text-sm text-label text-left border-0" style="width: 15%">Waktu</th>
                                <th class="text-sm text-label text-left border-0" >Kode</th>
                                <th class="text-sm text-label text-left border-0" >Unit</th>
                                <th class="text-sm text-label text-left border-0" >Keluhan</th>
                              </tr>
                            </thead>
                          </table> 
                        </div>
                      </div>
                    </div>
                        <div class="col-md-4">
                          <div class="box-body box-profile">
                            <h3 class="profile-username text-center" style="font-weight:bold;"><?php echo $rm; ?></h3>             
                            <p class="text-muted text-center" style="font-weight:bold;"><?php echo $nama_pasien; ?></p>
                            <ul class="list-group list-group-unbordered">
                            <li class="list-group-item"><b>No KTP</b> <p class="pull-right"><?php echo $nik; ?></p></li>
                            <li class="list-group-item"><b>TTL</b> <p class="pull-right"><?php echo $ttl; ?></p></li>
                            <li class="list-group-item"><b>Umur</b> <p class="pull-right"><?php echo $umur; ?></p></li>
                            <li class="list-group-item"><b>Agama</b> <p class="pull-right"><?php echo $nama_agama; ?></p></li>
                            <li class="list-group-item"><b>Satus Pernikahan</b> <p class="pull-right"><?php echo $nama_status_kawin; ?></p></li>
                            <li class="list-group-item"><b>Golongan Darah</b> <p class="pull-right"><?php echo $nama_golongan_darah; ?></p></li>
                            <li class="list-group-item"><b>Pekerjaan</b> <p class="pull-right"><?php echo $nama_pekerjaan; ?></p></li>
                            <li class="list-group-item"><b>Pendidikan</b> <p class="pull-right"><?php echo $nama_pendidikan; ?></p></li>
                            <li class="list-group-item"><b>Nama Pasangan</b> <p class="pull-right"><?php echo $nama_pasangan; ?></p></li>
                            <li class="list-group-item"><b>Nama Ayah</b> <p class="pull-right"><?php echo $nama_ayah; ?></p></li>
                            <li class="list-group-item"><b>Nama Ibu</b> <p class="pull-right"><?php echo $nama_ibu; ?></p></li>
                            <li class="list-group-item"><b>Alamat</b></li>
                            <li class="list-style-type"><p></p></li>
                            <li class="list-style-type"><p class="pull-right"><?php echo $alamat; ?></p></li>
                            </ul>
                          </div> 
                        </div> 
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.tab-content -->
          </div>
        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="daftar_data_penunjang")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_close.png') no-repeat center center;
}
ul.no-bullets {
  list-style-type: none; /* Remove bullets */
  padding: 0; /* Remove padding */
  margin: 15; /* Remove margins */
}
.select2-container {
    width: 90% !important;
    padding: 0;
}
#chartdiv {
  width: 100%;
  height: 500px;
}
table.dataTable tbody tr.selected {
  color:#fff;
  background-color: #0088cc !important;
  border: 1px solid #2083eb;
}
table.dataTable tbody td {
    word-break: break-word;
    vertical-align: top;
}
.text-wrap{
    white-space:normal;
}
.width-200{
    width:200px;
}
ul {
  list-style-type: none;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">     
      <a href="<?php echo $kembali;?>"
        class="btn btn-info" > <i class="fa fa-reply"></i> Kembali
      </a>
      <div class="box-tools pull-right">
         <h3>WAKTU PENDAFTARAN : <?= $wkt_daftar ?></h3>
      </div>
    </section>
    <section class="content">

      <div class="row">
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li><a href="<?php echo base_url('radiolog/daftar/data_dokter/'.$first_date);?>" >Dokter</a></li>
              <li class="active"><a href="<?php echo base_url('radiolog/daftar/data_penunjang/'.$first_date);?>" >Penunjang Luar</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_vital/'.$first_date);?>" >Hasil Pemeriksaan Pasien</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_asuhan/'.$first_date);?>" >Asuhan Keperawatan</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_radiologi/'.$first_date);?>" >Radiologi</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_lab/'.$first_date);?>" >Laboratorium</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_apotek/'.$first_date);?>" >Apotek</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_ps/'.$first_date);?>" >Riwayat Kunjungan</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/grafik_vital/'.$first_date);?>" >Vital Sign</a></li>
              <li class="pull-right"><h3><i class="fa fa-server"></i> E REKAM MEDIS</h3></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active">
                <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                  <div class="box-header with-border">
                     <h3 class="box-title"><?php echo $title; ?></h3>
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                          <i class="fa fa-minus"></i></button>
                      </div>
                  </div>
                  <div class="box-body">
                    <div class="row">
                    <div class="col-md-8">
                      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                        <div class="box-header with-border">
                           <h3 class="box-title"><?php echo $title; ?></h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                    title="Collapse">
                              <i class="fa fa-minus"></i></button>
                          </div>
                        </div>
                        <div class="box-body">
                          <table id="dttb" style="width:100%" class="table table-hover table-transaksi table-sm">
                            <thead>
                              <tr style="background-color: #29675B;color: white;">
                                <th class="text-sm text-label text-left border-0" style="width: 5%"></th>
                                <th class="text-sm text-label text-left border-0">Waktu Pendaftaran</th>
                                <th class="text-sm text-label text-left border-0" >Tanggal Pemeriksaan</th>
                                <th class="text-sm text-label text-left border-0" >Tindakan</th>
                              </tr>
                            </thead>
                          </table> 
                        </div>
                      </div>
                    </div>
                        <div class="col-md-4">
                          <div class="box-body box-profile">
                            <h3 class="profile-username text-center" style="font-weight:bold;"><?php echo $rm; ?></h3>             
                            <p class="text-muted text-center" style="font-weight:bold;"><?php echo $nama_pasien; ?></p>
                            <ul class="list-group list-group-unbordered">
                            <li class="list-group-item"><b>No KTP</b> <p class="pull-right"><?php echo $nik; ?></p></li>
                            <li class="list-group-item"><b>TTL</b> <p class="pull-right"><?php echo $ttl; ?></p></li>
                            <li class="list-group-item"><b>Umur</b> <p class="pull-right"><?php echo $umur; ?></p></li>
                            <li class="list-group-item"><b>Agama</b> <p class="pull-right"><?php echo $nama_agama; ?></p></li>
                            <li class="list-group-item"><b>Satus Pernikahan</b> <p class="pull-right"><?php echo $nama_status_kawin; ?></p></li>
                            <li class="list-group-item"><b>Golongan Darah</b> <p class="pull-right"><?php echo $nama_golongan_darah; ?></p></li>
                            <li class="list-group-item"><b>Pekerjaan</b> <p class="pull-right"><?php echo $nama_pekerjaan; ?></p></li>
                            <li class="list-group-item"><b>Pendidikan</b> <p class="pull-right"><?php echo $nama_pendidikan; ?></p></li>
                            <li class="list-group-item"><b>Nama Pasangan</b> <p class="pull-right"><?php echo $nama_pasangan; ?></p></li>
                            <li class="list-group-item"><b>Nama Ayah</b> <p class="pull-right"><?php echo $nama_ayah; ?></p></li>
                            <li class="list-group-item"><b>Nama Ibu</b> <p class="pull-right"><?php echo $nama_ibu; ?></p></li>
                            <li class="list-group-item"><b>Alamat</b></li>
                            <li class="list-style-type"><p></p></li>
                            <li class="list-style-type"><p class="pull-right"><?php echo $alamat; ?></p></li>
                            </ul>
                          </div> 
                        </div> 
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.tab-content -->
          </div>
        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="daftar_grafik_vital")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_close.png') no-repeat center center;
}
ul.no-bullets {
  list-style-type: none; /* Remove bullets */
  padding: 0; /* Remove padding */
  margin: 15; /* Remove margins */
}
.select2-container {
    width: 90% !important;
    padding: 0;
}
#chartdiv {
  width: 100%;
  height: 1500px;
}
table.dataTable tbody tr.selected {
  color:#fff;
  background-color: #0088cc !important;
  border: 1px solid #2083eb;
}
table.dataTable tbody td {
    word-break: break-word;
    vertical-align: top;
}
.text-wrap{
    white-space:normal;
}
.width-200{
    width:200px;
}
ul {
  list-style-type: none;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">     
      <a href="<?php echo $kembali;?>"
        class="btn btn-info" > <i class="fa fa-reply"></i> Kembali
      </a>
      <div class="box-tools pull-right">
         <h3>WAKTU PENDAFTARAN : <?= $wkt_daftar ?></h3>
      </div>
    </section>
    <section class="content">

      <div class="row">
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li><a href="<?php echo base_url('radiolog/daftar/data_dokter/'.$first_date);?>" >Dokter</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_penunjang/'.$first_date);?>" >Penunjang Luar</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_vital/'.$first_date);?>" >Hasil Pemeriksaan Pasien</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_asuhan/'.$first_date);?>" >Asuhan Keperawatan</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_radiologi/'.$first_date);?>" >Radiologi</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_lab/'.$first_date);?>" >Laboratorium</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_apotek/'.$first_date);?>" >Apotek</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_ps/'.$first_date);?>" >Riwayat Kunjungan</a></li>
              <li class="active"><a href="<?php echo base_url('radiolog/daftar/grafik_vital/'.$first_date);?>" >Vital Sign</a></li>
              <li class="pull-right"><h3><i class="fa fa-server"></i> E REKAM MEDIS</h3></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active">
                <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                  <div class="box-header with-border">
                     <h3 class="box-title">TABEL DAN GRAFIK VITAL SIGN</h3>
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                          <i class="fa fa-minus"></i></button>
                      </div>
                  </div>
                  <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <table id="dttb" style="width:100%" class="table table-hover table-transaksi table-sm">
            <thead>
              <tr style="background-color: #29675B;color: white;">
                <th class="text-sm text-label text-left border-0">Waktu Pemeriksaan</th>
                <th class="text-sm text-label text-left border-0" >Sistole</th>
                <th class="text-sm text-label text-left border-0" >Diastole</th>
                <th class="text-sm text-label text-left border-0" >RR</th>
                <th class="text-sm text-label text-left border-0" >Nadi</th>
                <th class="text-sm text-label text-left border-0" >Suhu</th>
                <th class="text-sm text-label text-left border-0" >Spo2</th>
              </tr>
            </thead>
          </table>
        </div>
        <div class="col-md-12">
            <div class="box box-solid">
              <div class="box-header">
                <h3 class="box-title text-blue">Sistole</h3>
              </div>
              <div class="box-body text-center">
                <div class="sparkline" data-type="line" data-spot-Radius="3" data-highlight-Spot-Color="#f39c12" data-highlight-Line-Color="#222" data-min-Spot-Color="#f56954" data-max-Spot-Color="#00a65a" data-spot-Color="#39CCCC" data-offset="90" data-width="100%" data-height="100px" data-line-Width="2" data-line-Color="#39CCCC" data-fill-Color="rgba(57, 204, 204, 0.08)">
                  <?php  
                    foreach($grafik as $rowgrafik){
                      echo $rowgrafik['sistole'].',';
                    }
                  ?>
                </div>
              </div>
            </div>
            <div class="box box-solid">
              <div class="box-header">
                <h3 class="box-title text-blue">Diastole</h3>
              </div>
              <div class="box-body text-center">
                <div class="sparkline" data-type="line" data-spot-Radius="3" data-highlight-Spot-Color="#f39c12" data-highlight-Line-Color="#222" data-min-Spot-Color="#f56954" data-max-Spot-Color="#00a65a" data-spot-Color="#39CCCC" data-offset="90" data-width="100%" data-height="100px" data-line-Width="2" data-line-Color="#39CCCC" data-fill-Color="rgba(57, 204, 204, 0.08)">
                  <?php  
                    foreach($grafik as $rowgrafik){
                      echo $rowgrafik['diastole'].',';
                    }
                  ?>
                </div>
              </div>
            </div>
            <div class="box box-solid">
              <div class="box-header">
                <h3 class="box-title text-blue">Respirasi Rate</h3>
              </div>
              <div class="box-body text-center">
                <div class="sparkline" data-type="line" data-spot-Radius="3" data-highlight-Spot-Color="#f39c12" data-highlight-Line-Color="#222" data-min-Spot-Color="#f56954" data-max-Spot-Color="#00a65a" data-spot-Color="#39CCCC" data-offset="90" data-width="100%" data-height="100px" data-line-Width="2" data-line-Color="#39CCCC" data-fill-Color="rgba(57, 204, 204, 0.08)">
                  <?php  
                    foreach($grafik as $rowgrafik){
                      echo $rowgrafik['rr'].',';
                    }
                  ?>
                </div>
              </div>
            </div>
            <div class="box box-solid">
              <div class="box-header">
                <h3 class="box-title text-blue">Nadi</h3>
              </div>
              <div class="box-body text-center">
                <div class="sparkline" data-type="line" data-spot-Radius="3" data-highlight-Spot-Color="#f39c12" data-highlight-Line-Color="#222" data-min-Spot-Color="#f56954" data-max-Spot-Color="#00a65a" data-spot-Color="#39CCCC" data-offset="90" data-width="100%" data-height="100px" data-line-Width="2" data-line-Color="#39CCCC" data-fill-Color="rgba(57, 204, 204, 0.08)">
                  <?php  
                    foreach($grafik as $rowgrafik){
                      echo $rowgrafik['nadi'].',';
                    }
                  ?>
                </div>
              </div>
            </div>
            <div class="box box-solid">
              <div class="box-header">
                <h3 class="box-title text-blue">Suhu (C)</h3>
              </div>
              <div class="box-body text-center">
                <div class="sparkline" data-type="line" data-spot-Radius="3" data-highlight-Spot-Color="#f39c12" data-highlight-Line-Color="#222" data-min-Spot-Color="#f56954" data-max-Spot-Color="#00a65a" data-spot-Color="#39CCCC" data-offset="90" data-width="100%" data-height="100px" data-line-Width="2" data-line-Color="#39CCCC" data-fill-Color="rgba(57, 204, 204, 0.08)">
                  <?php  
                    foreach($grafik as $rowgrafik){
                      echo $rowgrafik['suhu'].',';
                    }
                  ?>
                </div>
              </div>
            </div>
            <div class="box box-solid">
              <div class="box-header">
                <h3 class="box-title text-blue">Spo2</h3>
              </div>
              <div class="box-body text-center">
                <div class="sparkline" data-type="line" data-spot-Radius="3" data-highlight-Spot-Color="#f39c12" data-highlight-Line-Color="#222" data-min-Spot-Color="#f56954" data-max-Spot-Color="#00a65a" data-spot-Color="#39CCCC" data-offset="90" data-width="100%" data-height="100px" data-line-Width="2" data-line-Color="#39CCCC" data-fill-Color="rgba(57, 204, 204, 0.08)">
                  <?php  
                    foreach($grafik as $rowgrafik){
                      echo $rowgrafik['spo2'].',';
                    }
                  ?>
                </div>
              </div>
            </div>
        </div>
      </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.tab-content -->
          </div>
        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="daftar_data_asuhan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_close.png') no-repeat center center;
}
ul.no-bullets {
  list-style-type: none; /* Remove bullets */
  padding: 0; /* Remove padding */
  margin: 15; /* Remove margins */
}
.select2-container {
    width: 90% !important;
    padding: 0;
}
#chartdiv {
  width: 100%;
  height: 1500px;
}
table.dataTable tbody tr.selected {
  color:#fff;
  background-color: #0088cc !important;
  border: 1px solid #2083eb;
}
table.dataTable tbody td {
    word-break: break-word;
    vertical-align: top;
}
.text-wrap{
    white-space:normal;
}
.width-200{
    width:200px;
}
ul {
  list-style-type: none;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">     
      <a href="<?php echo $kembali;?>"
        class="btn btn-info" > <i class="fa fa-reply"></i> Kembali
      </a>
      <div class="box-tools pull-right">
         <h3>WAKTU PENDAFTARAN : <?= $wkt_daftar ?></h3>
      </div>
    </section>
    <section class="content">

      <div class="row">
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li><a href="<?php echo base_url('radiolog/daftar/data_dokter/'.$first_date);?>" >Dokter</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_penunjang/'.$first_date);?>" >Penunjang Luar</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_vital/'.$first_date);?>" >Hasil Pemeriksaan Pasien</a></li>
              <li class="active"><a href="<?php echo base_url('radiolog/daftar/data_asuhan/'.$first_date);?>" >Asuhan Keperawatan</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_radiologi/'.$first_date);?>" >Radiologi</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_lab/'.$first_date);?>" >Laboratorium</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_apotek/'.$first_date);?>" >Apotek</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/data_ps/'.$first_date);?>" >Riwayat Kunjungan</a></li>
              <li><a href="<?php echo base_url('radiolog/daftar/grafik_vital/'.$first_date);?>" >Vital Sign</a></li>
              <li class="pull-right"><h3><i class="fa fa-server"></i> E REKAM MEDIS</h3></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active">
                <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                  <div class="box-header with-border">
                     <h3 class="box-title"><?php echo $title; ?></h3>
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                          <i class="fa fa-minus"></i></button>
                      </div>
                  </div>
                  <div class="box-body">
                    <div class="row">
<?php  
  foreach($ambil_data_asuhan as $rowambil_data_asuhan){
?>
                      <div class="col-md-12">
                        <div class="box-header with-border">
                           <div class="box-title">No Pendaftaran : <?= $rowambil_data_asuhan['no_pendaftaran'] ?></div>
                              <p>Tanggal Periksa : <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($rowambil_data_asuhan['waktu_pemeriksaan_asuhan']))); ?><br>
                              Pemeriksa : <?= $rowambil_data_asuhan['perawate'] ?><br>
                              Keluhan : <?= $rowambil_data_asuhan['keluhan'] ?><br>
                              Keterangan : <?= $rowambil_data_asuhan['ket_pendaftaran_unit'] ?></p>
                              <div class="box-tools pull-right">
                              <p>Cara Bayar : <?= $rowambil_data_asuhan['nama_bayar'] ?><br>
                              Pengirim : <?= $rowambil_data_asuhan['nama_instansi'] ?> <?= $rowambil_data_asuhan['nama_dokter'] ?><br>
                              Admin : <?= $rowambil_data_asuhan['nama_pegawai'] ?></p>
                              </div>
                        </div>
            <div class="table-responsive">
              <table width="100%" class="table table-bordered">
                <tr>
                <td colspan="2" style="border-color: black;text-align:center;vertical-align:middle;padding:5px;width:50%;"> PENGKAJIAN </td>
                <td colspan="2" style="border-color: black;text-align:center;vertical-align:middle;padding:5px;width:25%;"> MASALAH KEPERAWATAN </td>
                <td colspan="2" style="border-color: black;text-align:center;vertical-align:middle;padding:5px;width:25%;"> IMPLEMENTASI </td>
                </tr>
                <!-- BATAS STANDAR -->
                <tr>
                <td colspan="2" style="border-color: black;vertical-align:middle;padding:5px;border-bottom:none;">
      <?php 
      foreach($asuhan_pengkajian_1 as $rowasuhan_kategori_1){
      ?>                
      A. <?php echo $rowasuhan_kategori_1['nama_pengkajian']; 
      }
      ?>
                </td>
                <td colspan="2" style="border-color: black;vertical-align:middle;padding:5px;border-bottom:none;">&nbsp;</td>
                <td colspan="2" style="border-color: black;vertical-align:middle;padding:5px;border-bottom:none;">&nbsp;</td>
                </tr>
                <tr>
                <td style="border-color: black;vertical-align:middle;padding:5px;width:1%;border-right:0;border-top:none;">&nbsp;</td>
                <td style="border-color: black;vertical-align:middle;padding:5px;border-left:0;border-top:none;">
      <?php
      foreach($asuhan_pengkajian_1 as $rowasuhan_kategori_1){
        $asuhan_kaji_detil_1 = $this->m_ol_rancak->asuhan_pengkajian_detil($rowasuhan_kategori_1['id_pengkajian']);
        checkboxflatred("id_kaji_detil","id_kaji_detil[]",$asuhan_kaji_detil_1,"id_kaji_detil","nama_kaji_detil",$rowambil_data_asuhan['id_kaji_detil'],"flat-red","<br>","","array");  
      }       
      ?>                
                </td>
                <td style="border-color: black;vertical-align:middle;padding:5px;width:1%;border-right:0;border-top:none;">&nbsp;</td>
                <td style="border-color: black;vertical-align:middle;padding:5px;border-left:0;border-top:none;">
      <?php
      foreach($asuhan_masalah_1 as $rowasuhan_masalah_1){
        echo $rowasuhan_masalah_1['nama_masalah']; ?><br style="margin-bottom: 0.5em;"> 
      <?php
        $asuhan_mas_detil_1 = $this->m_ol_rancak->asuhan_masalah_detil($rowasuhan_masalah_1['id_masalah']);
        checkboxflatred("id_mas_detil","id_mas_detil[]",$asuhan_mas_detil_1,"id_mas_detil","nama_mas_detil",$rowambil_data_asuhan['id_mas_detil'],"flat-red","<br>","","array");  
      }
      ?>
                </td>
                <td style="border-color: black;vertical-align:middle;padding:5px;width:1%;border-right:0;border-top:none;">&nbsp;</td>
                <td style="border-color: black;vertical-align:bottom;padding:5px;border-left:0;border-top:none;">
      <?php
      foreach($asuhan_implementasi_1 as $rowasuhan_implementasi_1){
        $asuhan_imp_detil_1 = $this->m_ol_rancak->asuhan_implementasi_detil($rowasuhan_implementasi_1['id_implementasi']);
        checkboxflatred("id_imp_detil","id_imp_detil[]",$asuhan_imp_detil_1,"id_imp_detil","nama_imp_detil",$rowambil_data_asuhan['id_imp_detil'],"flat-red","<br>","","array");  
      }
      ?>                
                </td>
                </tr>
                <!-- BATAS -->
                <tr>
                <td colspan="2" style="border-color: black;vertical-align:middle;padding:5px;border-bottom:none;">
      <?php 
      foreach($asuhan_pengkajian_2 as $rowasuhan_kategori_2){
      ?>                
      B. <?php echo $rowasuhan_kategori_2['nama_pengkajian']; 
      }
      ?>
                </td>
                <td colspan="2" style="border-color: black;vertical-align:middle;padding:5px;border-bottom:none;">&nbsp;</td>
                <td colspan="2" style="border-color: black;vertical-align:middle;padding:5px;border-bottom:none;">&nbsp;</td>
                </tr>
                <tr>
                <td style="border-color: black;vertical-align:middle;padding:5px;width:1%;border-right:0;border-top:none;">&nbsp;</td>
                <td style="border-color: black;vertical-align:middle;padding:5px;border-left:0;border-top:none;">
                <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                  <label>RR</label><br>
                  <?php
                    echo $rowambil_data_asuhan['rr_pemeriksaan_asuhan'];
                  ?>  
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                  <label>RR</label><br>
                  <?php
                    if($rowambil_data_asuhan['rr_ritme'] == 0){ echo 'Tidak Teratur'; }else{ echo 'Teratur'; }
                  ?>  
                  </div>
                </div>
                <div class="col-sm-12">
      <?php
      foreach($asuhan_pengkajian_2 as $rowasuhan_kategori_2){
        $asuhan_kaji_detil_2 = $this->m_ol_rancak->asuhan_pengkajian_detil($rowasuhan_kategori_2['id_pengkajian']);
        checkboxflatred("id_kaji_detil","id_kaji_detil[]",$asuhan_kaji_detil_2,"id_kaji_detil","nama_kaji_detil",$rowambil_data_asuhan['id_kaji_detil'],"flat-red","<br>","","array");  
      }       
      ?>                
                </div>
                </div>
                </td>
                <td style="border-color: black;vertical-align:middle;padding:5px;width:1%;border-right:0;border-top:none;">&nbsp;</td>
                <td style="border-color: black;vertical-align:middle;padding:5px;border-left:0;border-top:none;">
      <?php
      foreach($asuhan_masalah_2 as $rowasuhan_masalah_2){
        echo $rowasuhan_masalah_2['nama_masalah']; ?><br style="margin-bottom: 0.5em;"> 
      <?php
        $asuhan_mas_detil_2 = $this->m_ol_rancak->asuhan_masalah_detil($rowasuhan_masalah_2['id_masalah']);
        checkboxflatred("id_mas_detil","id_mas_detil[]",$asuhan_mas_detil_2,"id_mas_detil","nama_mas_detil",$rowambil_data_asuhan['id_mas_detil'],"flat-red","<br>","","array");  
      }
      ?>                
                </td>
                <td style="border-color: black;vertical-align:middle;padding:5px;width:1%;border-right:0;border-top:none;">&nbsp;</td>
                <td style="border-color: black;vertical-align:top;padding:5px;border-left:0;border-top:none;">
      <?php
      foreach($asuhan_implementasi_2 as $rowasuhan_implementasi_2){
        $asuhan_imp_detil_2 = $this->m_ol_rancak->asuhan_implementasi_detil($rowasuhan_implementasi_2['id_implementasi']);
        checkboxflatred("id_imp_detil","id_imp_detil[]",$asuhan_imp_detil_2,"id_imp_detil","nama_imp_detil",$rowambil_data_asuhan['id_imp_detil'],"flat-red","<br>","","array");  
      }
      foreach($asuhan_implementasi_3 as $rowasuhan_implementasi_3){
        echo $rowasuhan_implementasi_3['nama_implementasi']; ?><br style="margin-bottom: 0.5em;"> 
      <?php
        $asuhan_imp_detil_3 = $this->m_ol_rancak->asuhan_implementasi_detil($rowasuhan_implementasi_3['id_implementasi']);
        checkboxflatred("id_imp_detil","id_imp_detil[]",$asuhan_imp_detil_3,"id_imp_detil","nama_imp_detil",$rowambil_data_asuhan['id_imp_detil'],"flat-red","<br>","","array");  
      }
      ?>      
                  <div class="form-group">
                  <label>Volume Pemberian Oksigen</label>
                  <?php
                  echo $rowambil_data_asuhan['breathingo2'];
                  ?>  
                  </div>    
                </td>
                </tr>
                <!-- BATAS -->
                <tr>
                <td colspan="2" style="border-color: black;vertical-align:middle;padding:5px;border-bottom:none;">
      <?php 
      foreach($asuhan_pengkajian_3 as $rowasuhan_kategori_3){
      ?>                        
      C. <?php echo $rowasuhan_kategori_3['nama_pengkajian']; 
      }
      ?>
                </td>
                <td colspan="2" style="border-color: black;vertical-align:middle;padding:5px;border-bottom:none;">&nbsp;</td>
                <td colspan="2" style="border-color: black;vertical-align:middle;padding:5px;border-bottom:none;">&nbsp;</td>
                </tr>
                <tr>
                <td style="border-color: black;vertical-align:middle;padding:5px;width:1%;border-right:0;border-top:none;">&nbsp;</td>
                <td style="border-color: black;vertical-align:middle;padding:5px;border-left:0;border-top:none;">
      <?php
      foreach($asuhan_pengkajian_3 as $rowasuhan_kategori_3){
        $asuhan_kaji_detil_3 = $this->m_ol_rancak->asuhan_pengkajian_detil($rowasuhan_kategori_3['id_pengkajian']);
        checkboxflatred("id_kaji_detil","id_kaji_detil[]",$asuhan_kaji_detil_3,"id_kaji_detil","nama_kaji_detil",$rowambil_data_asuhan['id_kaji_detil'],"flat-red","<br>","","array");  
      }   
      foreach($asuhan_pengkajian_4 as $rowasuhan_kategori_4){
        echo $rowasuhan_kategori_4['nama_pengkajian']; ?><br style="margin-bottom: 0.5em;"> <?php
        $asuhan_kaji_detil_4 = $this->m_ol_rancak->asuhan_pengkajian_detil($rowasuhan_kategori_4['id_pengkajian']);
        checkboxflatred("id_kaji_detil","id_kaji_detil[]",$asuhan_kaji_detil_4,"id_kaji_detil","nama_kaji_detil",$rowambil_data_asuhan['id_kaji_detil'],"flat-red","<br>","","array");  
      }     
      foreach($asuhan_pengkajian_5 as $rowasuhan_kategori_5){
        echo $rowasuhan_kategori_5['nama_pengkajian']; ?><br style="margin-bottom: 0.5em;"> 
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                    <label>Sistole</label><br>
                    <?php
                    echo $rowambil_data_asuhan['sistole_pemeriksaan_asuhan'];
                    ?>  
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                    <label>Diastole</label><br>
                    <?php
                    echo $rowambil_data_asuhan['diastole_pemeriksaan_asuhan'];
                    ?>  
                    </div>
                  </div>
                  <div class="col-sm-12">
                
      <?php
        $asuhan_kaji_detil_5 = $this->m_ol_rancak->asuhan_pengkajian_detil($rowasuhan_kategori_5['id_pengkajian']);
        checkboxflatred("id_kaji_detil","id_kaji_detil[]",$asuhan_kaji_detil_5,"id_kaji_detil","nama_kaji_detil",$rowambil_data_asuhan['id_kaji_detil'],"flat-red","<br>","","array");  
      }       
      ?>      
                  </div>
                </div>
      <?php
      foreach($asuhan_pengkajian_6 as $rowasuhan_kategori_6){
        echo $rowasuhan_kategori_6['nama_pengkajian']; ?><br style="margin-bottom: 0.5em;"> <?php
        $asuhan_kaji_detil_6 = $this->m_ol_rancak->asuhan_pengkajian_detil($rowasuhan_kategori_6['id_pengkajian']);
        checkboxflatred("id_kaji_detil","id_kaji_detil[]",$asuhan_kaji_detil_6,"id_kaji_detil","nama_kaji_detil",$rowambil_data_asuhan['id_kaji_detil'],"flat-red","<br>","","array");  
      }   
      foreach($asuhan_pengkajian_7 as $rowasuhan_kategori_7){
        echo $rowasuhan_kategori_7['nama_pengkajian']; ?><br style="margin-bottom: 0.5em;"> <?php
        $asuhan_kaji_detil_7 = $this->m_ol_rancak->asuhan_pengkajian_detil($rowasuhan_kategori_7['id_pengkajian']);
        checkboxflatred("id_kaji_detil","id_kaji_detil[]",$asuhan_kaji_detil_7,"id_kaji_detil","nama_kaji_detil",$rowambil_data_asuhan['id_kaji_detil'],"flat-red","<br>","","array");  
      }     
      foreach($asuhan_pengkajian_8 as $rowasuhan_kategori_8){
        echo $rowasuhan_kategori_8['nama_pengkajian']; ?><br style="margin-bottom: 0.5em;"> <?php
        $asuhan_kaji_detil_8 = $this->m_ol_rancak->asuhan_pengkajian_detil($rowasuhan_kategori_8['id_pengkajian']);
        checkboxflatred("id_kaji_detil","id_kaji_detil[]",$asuhan_kaji_detil_8,"id_kaji_detil","nama_kaji_detil",$rowambil_data_asuhan['id_kaji_detil'],"flat-red","<br>","","array");  
      }     
      foreach($asuhan_pengkajian_9 as $rowasuhan_kategori_9){
        echo $rowasuhan_kategori_9['nama_pengkajian']; ?><br style="margin-bottom: 0.5em;"> <?php
        $asuhan_kaji_detil_9 = $this->m_ol_rancak->asuhan_pengkajian_detil($rowasuhan_kategori_9['id_pengkajian']);
        checkboxflatred("id_kaji_detil","id_kaji_detil[]",$asuhan_kaji_detil_9,"id_kaji_detil","nama_kaji_detil",$rowambil_data_asuhan['id_kaji_detil'],"flat-red","<br>","","array");  
      }       
      ?>
                </td>
                <td style="border-color: black;vertical-align:middle;padding:5px;width:1%;border-right:0;border-top:none;">&nbsp;</td>
                <td style="border-color: black;vertical-align:middle;padding:5px;border-left:0;border-top:none;">
      <?php
      foreach($asuhan_masalah_3 as $rowasuhan_masalah_3){
        echo $rowasuhan_masalah_3['nama_masalah']; ?><br style="margin-bottom: 0.5em;"> 
      <?php
        $asuhan_mas_detil_3 = $this->m_ol_rancak->asuhan_masalah_detil($rowasuhan_masalah_3['id_masalah']);
        checkboxflatred("id_mas_detil","id_mas_detil[]",$asuhan_mas_detil_3,"id_mas_detil","nama_mas_detil",$rowambil_data_asuhan['id_mas_detil'],"flat-red","<br>","","array");  
      }

      foreach($asuhan_masalah_4 as $rowasuhan_masalah_4){
        echo $rowasuhan_masalah_4['nama_masalah']; ?><br style="margin-bottom: 0.5em;"> 
      <?php
        $asuhan_mas_detil_4 = $this->m_ol_rancak->asuhan_masalah_detil($rowasuhan_masalah_4['id_masalah']);
        checkboxflatred("id_mas_detil","id_mas_detil[]",$asuhan_mas_detil_4,"id_mas_detil","nama_mas_detil",$rowambil_data_asuhan['id_mas_detil'],"flat-red","<br>","","array");  
      }
      ?>      
                </td>
                <td style="border-color: black;vertical-align:middle;padding:5px;width:1%;border-right:0;border-top:none;">&nbsp;</td>
                <td style="border-color: black;vertical-align:middle;padding:5px;border-left:0;border-top:none;">
      <?php
      foreach($asuhan_implementasi_4 as $rowasuhan_implementasi_4){
        echo $rowasuhan_implementasi_4['nama_implementasi']; ?><br style="margin-bottom: 0.5em;"> 
      <?php
        $asuhan_imp_detil_4 = $this->m_ol_rancak->asuhan_implementasi_detil($rowasuhan_implementasi_4['id_implementasi']);
        checkboxflatred("id_imp_detil","id_imp_detil[]",$asuhan_imp_detil_4,"id_imp_detil","nama_imp_detil",$rowambil_data_asuhan['id_imp_detil'],"flat-red","<br>","","array");  
      }
      foreach($asuhan_implementasi_5 as $rowasuhan_implementasi_5){
        echo $rowasuhan_implementasi_5['nama_implementasi']; ?><br style="margin-bottom: 0.5em;"> 
      <?php
        $asuhan_imp_detil_5 = $this->m_ol_rancak->asuhan_implementasi_detil($rowasuhan_implementasi_5['id_implementasi']);
        checkboxflatred("id_imp_detil","id_imp_detil[]",$asuhan_imp_detil_5,"id_imp_detil","nama_imp_detil",$rowambil_data_asuhan['id_imp_detil'],"flat-red","<br>","","array");  
      }
      ?>                  
                </td>
                </tr>
                <!-- BATAS  -->
                <tr>
                <td colspan="2" style="border-color: black;vertical-align:middle;padding:5px;border-bottom:none;">
                D. Disability
                </td>
                <td colspan="2" style="border-color: black;vertical-align:middle;padding:5px;border-bottom:none;">&nbsp;</td>
                <td colspan="2" style="border-color: black;vertical-align:middle;padding:5px;border-bottom:none;">&nbsp;</td>
                </tr>
                <tr>
                <td style="border-color: black;vertical-align:middle;padding:5px;width:1%;border-right:0;border-top:none;">&nbsp;</td>
                <td style="border-color: black;vertical-align:middle;padding:5px;border-left:0;border-top:none;">
                <div class="row">
                  <div class="col-sm-12">
                
      <?php
      foreach($asuhan_pengkajian_10 as $rowasuhan_kategori_10){
        echo $rowasuhan_kategori_10['nama_pengkajian']; 
        $asuhan_kaji_detil_10 = $this->m_ol_rancak->asuhan_pengkajian_detil($rowasuhan_kategori_10['id_pengkajian']);
        checkboxflatred("id_kaji_detil","id_kaji_detil[]",$asuhan_kaji_detil_10,"id_kaji_detil","nama_kaji_detil",$rowambil_data_asuhan['id_kaji_detil'],"flat-red","<br>","","array"); 
      }     
      ?>      
                  </div><br>
                  <div class="col-sm-12">
                    <label>Eye</label><p>
                    <?php
                      $eyasu = $this->m_umum->ambil_data('kol_gcs_eye','id_gcs_eye',$rowambil_data_asuhan['eye_pemeriksaan_asuhan']);
                      echo $eyasu['nama_gcs_eye'].' - Skor : '.$eyasu['skor_gcs_eye'];
                    ?></p>  
                  </div>
                  <div class="col-sm-12">
                    <label>Motorik</label><p>
                    <?php
                      $eyamo = $this->m_umum->ambil_data('kol_gcs_motorik','id_gcs_motorik',$rowambil_data_asuhan['motorik_pemeriksaan_asuhan']);
                      echo $eyamo['nama_gcs_motorik'].' - Skor : '.$eyamo['skor_gcs_motorik'];
                    ?></p>  
                  </div>
                  <div class="col-sm-12">
                    <label>Verbal</label><p>
                    <?php
                      $eyaver = $this->m_umum->ambil_data('kol_gcs_verb','id_gcs_verb',$rowambil_data_asuhan['verbal_pemeriksaan_asuhan']);
                      echo $eyaver['nama_gcs_verb'].' - Skor : '.$eyaver['skor_gcs_verb'];
                    ?></p>  
                  </div>  
                  <div class="col-sm-12">
                    <label>GCS</label><p>
                    <?php
                    echo $rowambil_data_asuhan['gcs_pemeriksaan_asuhan'];
                    ?></p>  
                  </div>
                  <div class="col-sm-12">                 
      <?php
      foreach($asuhan_pengkajian_11 as $rowasuhan_kategori_11){
        echo $rowasuhan_kategori_11['nama_pengkajian'];  
      }
      ?>

                    <label>&nbsp;&nbsp;Diameter Pupil</label><p>
                    <?php
                    echo $rowambil_data_asuhan['diameter_pupil'];
                    ?>  </p>
                  </div>                    
                  <div class="col-sm-12">
      <?php
      foreach($asuhan_pengkajian_11 as $rowasuhan_kategori_11){
        $asuhan_kaji_detil_11 = $this->m_ol_rancak->asuhan_pengkajian_detil($rowasuhan_kategori_11['id_pengkajian']);
        checkboxflatred("id_kaji_detil","id_kaji_detil[]",$asuhan_kaji_detil_11,"id_kaji_detil","nama_kaji_detil",$rowambil_data_asuhan['id_kaji_detil'],"flat-red","<br>","","array"); 
      }     
      ?>      
                  </div>
                  <div class="col-sm-12">
                
      <?php
      foreach($asuhan_pengkajian_12 as $rowasuhan_kategori_12){
        echo $rowasuhan_kategori_12['nama_pengkajian']; ?><br style="margin-bottom: 0.5em;">
      <?php
        $asuhan_kaji_detil_12 = $this->m_ol_rancak->asuhan_pengkajian_detil($rowasuhan_kategori_12['id_pengkajian']);
        checkboxflatred("id_kaji_detil","id_kaji_detil[]",$asuhan_kaji_detil_12,"id_kaji_detil","nama_kaji_detil",$rowambil_data_asuhan['id_kaji_detil'],"flat-red","<br>","","array"); 
      }     
      ?>      
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">                
                    Kekuatan Otot :
                    </div>  
                  </div>  
                  <div class="col-sm-5">
                    <div class="form-group">                
                    <label>Ext Atas</label><br>
                    <?php
                    echo $rowambil_data_asuhan['ext_atas'];
                    ?>  
                    </div>
                  </div>  
                  <div class="col-sm-5">
                    <div class="form-group">                
                    <label>Ext Bawah</label><br>
                    <?php
                    echo $rowambil_data_asuhan['ext_bawah'];
                    ?>  
                    </div>
                  </div>
                </div>              
                </td>
                <td style="border-color: black;vertical-align:middle;padding:5px;width:1%;border-right:0;border-top:none;">&nbsp;</td>
                <td style="border-color: black;vertical-align:middle;padding:5px;border-left:0;border-top:none;">
      <?php
      foreach($asuhan_masalah_5 as $rowasuhan_masalah_5){
        echo $rowasuhan_masalah_5['nama_masalah']; ?><br style="margin-bottom: 0.5em;"> 
      <?php
        $asuhan_mas_detil_5 = $this->m_ol_rancak->asuhan_masalah_detil($rowasuhan_masalah_5['id_masalah']);
        checkboxflatred("id_mas_detil","id_mas_detil[]",$asuhan_mas_detil_5,"id_mas_detil","nama_mas_detil",$rowambil_data_asuhan['id_mas_detil'],"flat-red","<br>","","array");  
      }
      ?>                    
                </td>
                <td style="border-color: black;vertical-align:middle;padding:5px;width:1%;border-right:0;border-top:none;">&nbsp;</td>
                <td style="border-color: black;vertical-align:middle;padding:5px;border-left:0;border-top:none;">
      <?php
      foreach($asuhan_implementasi_6 as $rowasuhan_implementasi_6){
        echo $rowasuhan_implementasi_6['nama_implementasi']; ?><br style="margin-bottom: 0.5em;"> 
      <?php
        $asuhan_imp_detil_6 = $this->m_ol_rancak->asuhan_implementasi_detil($rowasuhan_implementasi_6['id_implementasi']);
        checkboxflatred("id_imp_detil","id_imp_detil[]",$asuhan_imp_detil_6,"id_imp_detil","nama_imp_detil",$rowambil_data_asuhan['id_imp_detil'],"flat-red","<br>","","array");  
      }
      ?>
      <div class="form-group">                
      <label>GCS</label><p>
      <?php
      echo $rowambil_data_asuhan['disabilitygcs'];
      ?>  </p>
      </div>      
      <?php
      foreach($asuhan_implementasi_7 as $rowasuhan_implementasi_7){
        echo $rowasuhan_implementasi_7['nama_implementasi']; ?><br style="margin-bottom: 0.5em;"> 
      <?php
        $asuhan_imp_detil_7 = $this->m_ol_rancak->asuhan_implementasi_detil($rowasuhan_implementasi_7['id_implementasi']);
        checkboxflatred("id_imp_detil","id_imp_detil[]",$asuhan_imp_detil_7,"id_imp_detil","nama_imp_detil",$rowambil_data_asuhan['id_imp_detil'],"flat-red","<br>","","array");  
      }
      ?>  
      <div class="form-group">                
      <label>Volume Pemberian Oksigen</label><p>
      <?php
      echo $rowambil_data_asuhan['disabilityo2'];
      ?>  </p>
      </div>        
                </td>
                </tr>
                <!-- BATAS -->
                <tr>
                <td colspan="2" style="border-color: black;vertical-align:middle;padding:5px;border-bottom:none;">
      <?php 
      foreach($asuhan_pengkajian_13 as $rowasuhan_kategori_13){
      ?>                
      E. <?php echo $rowasuhan_kategori_13['nama_pengkajian']; 
      }
      ?>
                </td>
                <td colspan="2" style="border-color: black;vertical-align:middle;padding:5px;border-bottom:none;">&nbsp;</td>
                <td colspan="2" style="border-color: black;vertical-align:middle;padding:5px;border-bottom:none;">&nbsp;</td>
                </tr>
                <tr>
                <td style="border-color: black;vertical-align:middle;padding:5px;width:1%;border-right:0;border-top:none;">&nbsp;</td>
                <td style="border-color: black;vertical-align:middle;padding:5px;border-left:0;border-top:none;">
      <?php
      foreach($asuhan_pengkajian_13 as $rowasuhan_kategori_13){
        $asuhan_kaji_detil_13 = $this->m_ol_rancak->asuhan_pengkajian_detil($rowasuhan_kategori_13['id_pengkajian']);
        checkboxflatred("id_kaji_detil","id_kaji_detil[]",$asuhan_kaji_detil_13,"id_kaji_detil","nama_kaji_detil",$rowambil_data_asuhan['id_kaji_detil'],"flat-red","<br>","","array"); 
      }       
      ?>                
                </td>
                <td style="border-color: black;vertical-align:middle;padding:5px;width:1%;border-right:0;border-top:none;">&nbsp;</td>
                <td style="border-color: black;vertical-align:middle;padding:5px;border-left:0;border-top:none;">
      <?php
      foreach($asuhan_masalah_6 as $rowasuhan_masalah_6){
        echo $rowasuhan_masalah_6['nama_masalah']; ?><br style="margin-bottom: 0.5em;"> 
      <?php
        $asuhan_mas_detil_6 = $this->m_ol_rancak->asuhan_masalah_detil($rowasuhan_masalah_6['id_masalah']);
        checkboxflatred("id_mas_detil","id_mas_detil[]",$asuhan_mas_detil_6,"id_mas_detil","nama_mas_detil",$rowambil_data_asuhan['id_mas_detil'],"flat-red","<br>","","array");  
      }

      foreach($asuhan_masalah_7 as $rowasuhan_masalah_7){
        echo $rowasuhan_masalah_7['nama_masalah']; ?><br style="margin-bottom: 0.5em;"> 
      <?php
        $asuhan_mas_detil_7 = $this->m_ol_rancak->asuhan_masalah_detil($rowasuhan_masalah_7['id_masalah']);
        checkboxflatred("id_mas_detil","id_mas_detil[]",$asuhan_mas_detil_7,"id_mas_detil","nama_mas_detil",$rowambil_data_asuhan['id_mas_detil'],"flat-red","<br>","","array");  
      }
      
      foreach($asuhan_masalah_8 as $rowasuhan_masalah_8){
        echo $rowasuhan_masalah_8['nama_masalah']; ?><br style="margin-bottom: 0.5em;"> 
      <?php
        $asuhan_mas_detil_8 = $this->m_ol_rancak->asuhan_masalah_detil($rowasuhan_masalah_8['id_masalah']);
        checkboxflatred("id_mas_detil","id_mas_detil[]",$asuhan_mas_detil_8,"id_mas_detil","nama_mas_detil",$rowambil_data_asuhan['id_mas_detil'],"flat-red","<br>","","array");  
      }
      ?>                  
                </td>
                <td style="border-color: black;vertical-align:middle;padding:5px;width:1%;border-right:0;border-top:none;">&nbsp;</td>
                <td style="border-color: black;vertical-align:middle;padding:5px;border-left:0;border-top:none;">
      <?php
      foreach($asuhan_implementasi_8 as $rowasuhan_implementasi_8){
        $asuhan_imp_detil_8 = $this->m_ol_rancak->asuhan_implementasi_detil($rowasuhan_implementasi_8['id_implementasi']);
        checkboxflatred("id_imp_detil","id_imp_detil[]",$asuhan_imp_detil_8,"id_imp_detil","nama_imp_detil",$rowambil_data_asuhan['id_imp_detil'],"flat-red","<br>","","array");  
      }
      foreach($asuhan_implementasi_9 as $rowasuhan_implementasi_9){
        echo $rowasuhan_implementasi_9['nama_implementasi']; ?><br style="margin-bottom: 0.5em;"> 
      <?php
        $asuhan_imp_detil_9 = $this->m_ol_rancak->asuhan_implementasi_detil($rowasuhan_implementasi_9['id_implementasi']);
        checkboxflatred("id_imp_detil","id_imp_detil[]",$asuhan_imp_detil_9,"id_imp_detil","nama_imp_detil",$rowambil_data_asuhan['id_imp_detil'],"flat-red","<br>","","array");  
      }
      ?>                
                </td>
                </tr>
                <!-- BATAS -->
                <tr>
                <td colspan="2" style="border-color: black;vertical-align:middle;padding:5px;border-bottom:none;">              
                Psikososial           
                </td>
                <td colspan="2" style="border-color: black;vertical-align:middle;padding:5px;border-bottom:none;">&nbsp;</td>
                <td colspan="2" style="border-color: black;vertical-align:middle;padding:5px;border-bottom:none;">&nbsp;</td>
                </tr>
                <tr>
                <td style="border-color: black;vertical-align:middle;padding:5px;width:1%;border-right:0;border-top:none;">&nbsp;</td>
                <td style="border-color: black;vertical-align:middle;padding:5px;border-left:0;border-top:none;">
      <?php 
      foreach($asuhan_pengkajian_14 as $rowasuhan_kategori_14){
        echo $rowasuhan_kategori_14['nama_pengkajian'];  ?><br style="margin-bottom: 0.5em;">
      <?php
        $asuhan_kaji_detil_14 = $this->m_ol_rancak->asuhan_pengkajian_detil($rowasuhan_kategori_14['id_pengkajian']);
        checkboxflatred("id_kaji_detil","id_kaji_detil[]",$asuhan_kaji_detil_14,"id_kaji_detil","nama_kaji_detil",$rowambil_data_asuhan['id_kaji_detil'],"flat-red","<br>","","array"); 
      }   
      foreach($asuhan_pengkajian_15 as $rowasuhan_kategori_15){
        echo $rowasuhan_kategori_15['nama_pengkajian'];  ?><br style="margin-bottom: 0.5em;">
      <?php
        $asuhan_kaji_detil_15 = $this->m_ol_rancak->asuhan_pengkajian_detil($rowasuhan_kategori_15['id_pengkajian']);
        checkboxflatred("id_kaji_detil","id_kaji_detil[]",$asuhan_kaji_detil_15,"id_kaji_detil","nama_kaji_detil",$rowambil_data_asuhan['id_kaji_detil'],"flat-red","<br>","","array"); 
      }         
      ?>                
                </td>
                <td style="border-color: black;vertical-align:middle;padding:5px;width:1%;border-right:0;border-top:none;">&nbsp;</td>
                <td style="border-color: black;vertical-align:middle;padding:5px;border-left:0;border-top:none;">
                Gangguan Rasa Aman / Cemas
                </td>
                <td style="border-color: black;vertical-align:middle;padding:5px;width:1%;border-right:0;border-top:none;">&nbsp;</td>
                <td style="border-color: black;vertical-align:middle;padding:5px;border-left:0;border-top:none;">
      <?php
      foreach($asuhan_implementasi_10 as $rowasuhan_implementasi_10){
        $asuhan_imp_detil_10 = $this->m_ol_rancak->asuhan_implementasi_detil($rowasuhan_implementasi_10['id_implementasi']);
        checkboxflatred("id_imp_detil","id_imp_detil[]",$asuhan_imp_detil_10,"id_imp_detil","nama_imp_detil",$rowambil_data_asuhan['id_imp_detil'],"flat-red","<br>","","array"); 
      }               
      ?>
                </td>
                </tr>
              </table>
            </div>  
                      </div>
<?php  
  }
?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.tab-content -->
          </div>
        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="daftar")
{
?>
<style type="text/css">
td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_close.png') no-repeat center center;
}
table.dataTable tbody tr.selected {
  background-color: #0088cc !important;
  color: white !important;
  border: 1px solid #2083eb;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('radiolog/daftar/view/'.$first_date.'/'.$last_date.'/'.$key,' id="signupform" '); ;
  ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
    </div>
      <div class="box-body">
        <div class="col-md-12">
          <div class="form-group">
            <label>Cari RM DAN NAMA PASIEN ( Ketik multiple pisahkan dengan spasi atau - ) Contoh (00000 NAMA)</label>
              <?php
                input_text("key",$key," autofocus","Ketik multiple pisahkan dengan spasi atau -","text");
              ?>
          </div>
        </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Tanggal Awal</label>
                <?php
                  input_calendar("first_date","first_date",$first_date,"Masukkan Tanggal","");
                ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Tanggal Akhir</label>
              <?php
                input_calendar("last_date","last_date",$last_date,"Masukkan Tanggal","");
              ?>
            </div>
          </div>
      </div>
      <div class="box-footer">
        <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
      </div>
    </div>
  <?php echo form_close(); ?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="box-tools pull-right">
      <?php
    //    input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th width="5%"></th>
            <th style="display:none;">ID</th>
            <th>Tanggal</th>
            <th>Data Pasien</th>
            <th>Pemeriksaan</th>
            <th>Keluhan-Keterangan</th>
            <th>Instansi</th>
            <th>Kritis</th>
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
        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="daftar_read")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
<div class="row">
  <div class="col-md-12">
    <FORM method="POST" class="form-horizontal" action="<?php echo base_url('radiolog/daftar/simpan_read');?>" onClick="return cek();">
    <input type="hidden" name="barcode_radiologi_result" value="<?= $barcode_radiologi_result; ?>">
    <input type="hidden" name="barcode_pemeriksaan" value="<?= $barcode_pemeriksaan; ?>">
    <input type="hidden" name="barcode_radiologi_result" value="<?= $barcode_radiologi_result; ?>">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
      </div>
        <div class="box-body">
          <div class="col-md-6">
              <label>Format Hasil</label>
              <?php
                input_pdselect2fleksibel("id_pemeriksaan_format","id_pemeriksaan_format",$format,"id_pemeriksaan_format","nama_pemeriksaan_format",$id_pemeriksaan_format,"Pilih Format");
              ?>
          </div>
          <div class="col-md-6">
            <label>Skala Kritis</label>
            <?php
              input_pdselect2("id_nilai_kritis",$nilai_kritis,$id_nilai_kritis);
            ?>
          </div>
<div class="awaktextarea"></div>
        </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
    </FORM>
  </div>   
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $('.select2').select2()
    $('#id_pemeriksaan_format').on('change', function(){
      inputValue = document.getElementById("id_pemeriksaan_format").value;
      $('.awaktextarea').load('<?php echo base_url('radiolog/daftar/format_hasil_awal_clicked/'); ?>'+inputValue);
    });
    $('.awaktextarea').load('<?php echo base_url('radiolog/daftar/format_hasil_awal/'); ?><?= $first_date ?>');
  });
</script>
<?php
}
elseif ($page=="daftar_format_hasil_awal")
{
?>
        <div class="col-md-12">
            <label>Hasil</label>
            <?php
input_textareacustom("hasil_radiologi_result",$hasil_radiologi_result," id='editor1' rows='5' cols='50' class='form-control' ","Hasil");
            ?>     
        </div>
        <div class="col-md-12">
            <label>Kesimpulan</label>
            <?php
input_textareacustom("kesimpulan_radiologi_result",$kesimpulan_radiologi_result," id='editor2' rows='5' cols='50' class='form-control' ","Kesimpulan");
            ?>         
        </div>
<script type="text/javascript">
    $(document).ready(function() {
    CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
    CKEDITOR.replace('editor2', {enterMode: CKEDITOR.ENTER_BR});    
  }); 
</script>
<?php
}
elseif ($page=="daftar_format_hasil_awal_clicked")
{
?>
        <div class="col-md-12">
          <div class="form-group">
            <label>Hasil</label>
            <?php
input_textareacustom("hasil_radiologi_result",$hasil_radiologi_result," id='editor1' rows='5' cols='50' class='form-control' ","Hasil");
            ?>  
          </div>        
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label>Kesimpulan</label>
            <?php
input_textareacustom("kesimpulan_radiologi_result",$kesimpulan_radiologi_result," id='editor2' rows='5' cols='50' class='form-control' ","Kesimpulan");
            ?>  
          </div>        
        </div>
<script type="text/javascript">
    $(document).ready(function() {
    CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
    CKEDITOR.replace('editor2', {enterMode: CKEDITOR.ENTER_BR});    
  }); 
</script>
<?php
}
