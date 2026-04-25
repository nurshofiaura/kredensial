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

}
else if($page=="surat_ijin")
{
?>
<style type="text/css">
.table-y {
  table-layout: fixed;
  display: block;
  height: 200px;
  overflow-y: auto;
}

.table-y          { overflow: auto; height: 200px; }
.table-y thead th { position: sticky; top: 0; z-index: 1; }
.table-y tbody th { position: sticky; left: 0; }
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
      <?php echo form_open_multipart('ketua_team/surat_ijin/view/'.$id,' id="signupform" '); ?>
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
              <label>Unit</label>
                <?php
                  input_pdselect2fleksibel("id","id",$unitee,"id_unit","nama_unit",$id,"Silahkan Pilih Unit");
                //  input_pdselect2("id2",$jabatan,$id2);
                ?>
          </div>
        </div>
        </div>
        <div class="box-footer">
          <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
        </div>
      </div>
      <?php echo form_close(); ?>
      <div class="box box-<?php echo $thenarray; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">DATA SURAT IJIN</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
<?php  
$dateb = date("Y-m-d", strtotime("+1 years"));
$kondisi_expired_str=array('lifetime_berkas'=>0,'status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>1,'tgl_b_berkas <='=>date('Y-m-d'),'opu.id_unit'=>$id);
$expired_str=$this->m_admin_kredensial->ambil_berkas_ijin_comma($kondisi_expired_str);
$kondisi_expired_sip=array('lifetime_berkas'=>0,'status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>2,'tgl_b_berkas <='=>date('Y-m-d'),'opu.id_unit'=>$id);
$expired_sip=$this->m_admin_kredensial->ambil_berkas_ijin_comma($kondisi_expired_sip);
$kondisi_expired_sik=array('lifetime_berkas'=>0,'status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>3,'tgl_b_berkas <='=>date('Y-m-d'),'opu.id_unit'=>$id);
$expired_sik=$this->m_admin_kredensial->ambil_berkas_ijin_comma($kondisi_expired_sik);

$kondisi_aktif_str=array('lifetime_berkas'=>1,'status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>1,'opu.id_unit'=>$id);
$kondisi_aktif_xstr=array('lifetime_berkas'=>0,'status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>1,'tgl_b_berkas >='=>$dateb,'opu.id_unit'=>$id);
$kondisi_aktif_sip=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>2,'tgl_b_berkas >='=>$dateb,'opu.id_unit'=>$id);
$kondisi_aktif_sik=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>3,'tgl_b_berkas >='=>$dateb,'opu.id_unit'=>$id);

$aktif_str=$this->m_admin_kredensial->ambil_berkas_ijin_comma($kondisi_aktif_str);
$aktif_xstr=$this->m_admin_kredensial->ambil_berkas_ijin_comma($kondisi_aktif_xstr);
$aktif_sip=$this->m_admin_kredensial->ambil_berkas_ijin_comma($kondisi_aktif_sip);
$aktif_sik=$this->m_admin_kredensial->ambil_berkas_ijin_comma($kondisi_aktif_sik);

$kondisi_tenggang_str=array('lifetime_berkas'=>0,'status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>1,'tgl_b_berkas >='=>date('Y-m-d'),'tgl_b_berkas <='=>$dateb,'opu.id_unit'=>$id);
$tenggang_str=$this->m_admin_kredensial->ambil_berkas_ijin_comma($kondisi_tenggang_str);
$kondisi_tenggang_sip=array('lifetime_berkas'=>0,'status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>2,'tgl_b_berkas >='=>date('Y-m-d'),'tgl_b_berkas <='=>$dateb,'opu.id_unit'=>$id);
$tenggang_sip=$this->m_admin_kredensial->ambil_berkas_ijin_comma($kondisi_tenggang_sip);
$kondisi_tenggang_sik=array('lifetime_berkas'=>0,'status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>3,'tgl_b_berkas >='=>date('Y-m-d'),'tgl_b_berkas <='=>$dateb,'opu.id_unit'=>$id);
$tenggang_sik=$this->m_admin_kredensial->ambil_berkas_ijin_comma($kondisi_tenggang_sik);

$loop_expired_str=$this->m_admin_kredensial->ambil_data_berkas_ijin_comma($kondisi_expired_str);
$loop_expired_sip=$this->m_admin_kredensial->ambil_data_berkas_ijin_comma($kondisi_expired_sip);
$loop_expired_sik=$this->m_admin_kredensial->ambil_data_berkas_ijin_comma($kondisi_expired_sik);

$loop_tenggang_str=$this->m_admin_kredensial->ambil_data_berkas_ijin_comma($kondisi_tenggang_str);
$loop_tenggang_sip=$this->m_admin_kredensial->ambil_data_berkas_ijin_comma($kondisi_tenggang_sip);
$loop_tenggang_sik=$this->m_admin_kredensial->ambil_data_berkas_ijin_comma($kondisi_tenggang_sik);

$loop_aktif_str=$this->m_admin_kredensial->ambil_data_berkas_ijin_comma($kondisi_aktif_str);
$loop_aktif_xstr=$this->m_admin_kredensial->ambil_data_berkas_ijin_comma($kondisi_aktif_xstr);
$loop_aktif_sip=$this->m_admin_kredensial->ambil_data_berkas_ijin_comma($kondisi_aktif_sip);
$loop_aktif_sik=$this->m_admin_kredensial->ambil_data_berkas_ijin_comma($kondisi_aktif_sik);
?>
    <table id="example1" width="100%" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th style="background-color:#9b0e27;color:white;vertical-align:middle;">SURAT IJIN</th>
        <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: right;width: 7%;">JML</th>
      </tr>
      </thead>
      <tbody>
<?php
foreach ($aktif_xstr as $rowaktif_xstr){
?>
    <tr>
      <td style="background-color:#008000;color:white;vertical-align:middle;">Aktif STR</td>
      <td style="background-color:#008000;color:white;vertical-align:middle;text-align: right;"><?= $rowaktif_xstr['total_str'] ?></td>
    </tr>
<?php 
}
foreach ($loop_aktif_xstr as $rowloop_aktif_xstr){
?>
    <tr>
      <td style="vertical-align:middle;">AKTIF STR<br>
        <?= $rowloop_aktif_xstr['nama_pegawai'] ?> / <?= $rowloop_aktif_xstr['nip'] ?> [ Expired : <?php if($rowloop_aktif_xstr['lifetime_berkas'] == 0){ echo $this->m_rancak->fullBulan(date('d-m-Y',strtotime($rowloop_aktif_xstr['tgl_b_berkas']))); }else{ echo 'SEUMUR HIDUP'; } ?>]
      </td><td>&nbsp;</td>
    </tr>
<?php 
}
foreach ($aktif_str as $rowaktif_str){
?>
    <tr>
      <td style="background-color:#008000;color:white;vertical-align:middle;">STR Seumur Hidup</td>
      <td style="background-color:#008000;color:white;vertical-align:middle;text-align: right;"><?= $rowaktif_str['total_str'] ?></td>
    </tr>
<?php 
}
foreach ($loop_aktif_str as $rowloop_aktif_str){
?>
    <tr>
      <td style="vertical-align:middle;">STR SEUMUR HIDUP<br>
        <?= $rowloop_aktif_str['nama_pegawai'] ?> / <?= $rowloop_aktif_str['nip'] ?> [ Expired : <?php if($rowloop_aktif_str['lifetime_berkas'] == 0){ echo $this->m_rancak->fullBulan(date('d-m-Y',strtotime($rowloop_aktif_str['tgl_b_berkas']))); }else{ echo 'SEUMUR HIDUP'; } ?>]
      </td><td>&nbsp;</td>
    </tr>
<?php 
}
foreach ($aktif_sip as $rowaktif_sip){
?>
    <tr>
      <td style="background-color:#008000;color:white;vertical-align:middle;">Aktif SIP</td>
      <td style="background-color:#008000;color:white;vertical-align:middle;text-align: right;"><?= $rowaktif_sip['total_str'] ?></td>
    </tr>
<?php 
}
foreach ($loop_aktif_sip as $rowloop_aktif_sip){
?>
    <tr>
      <td style="vertical-align:middle;">AKTIF SIP<br>
        <?= $rowloop_aktif_sip['nama_pegawai'] ?> / <?= $rowloop_aktif_sip['nip'] ?> [ Expired : <?= $this->m_rancak->fullBulan(date('d-m-Y',strtotime($rowloop_aktif_sip['tgl_b_berkas']))) ?>]
      </td><td>&nbsp;</td>
    </tr>
<?php 
}
foreach ($aktif_sik as $rowaktif_sik){
?>
    <tr>
      <td style="background-color:#008000;color:white;vertical-align:middle;">Aktif SIK</td>
      <td style="background-color:#008000;color:white;vertical-align:middle;text-align: right;"><?= $rowaktif_sik['total_str'] ?></td>
    </tr>
<?php 
}
foreach ($loop_aktif_sik as $rowloop_aktif_sik){
?>
    <tr>
      <td style="vertical-align:middle;">AKTIF SIK<br>
        <?= $rowloop_aktif_sik['nama_pegawai'] ?> / <?= $rowloop_aktif_sik['nip'] ?> [ Expired : <?= $this->m_rancak->fullBulan(date('d-m-Y',strtotime($rowloop_aktif_sik['tgl_b_berkas']))) ?>]
      </td><td>&nbsp;</td>
    </tr>
<?php 
}
foreach ($tenggang_str as $rowtenggang_str){
?>
    <tr>
      <td style="background-color:#f37220;color:white;vertical-align:middle;">Tenggang STR</td>
      <td style="background-color:#f37220;color:white;vertical-align:middle;text-align: right;"><?= $rowtenggang_str['total_str'] ?></td>
    </tr>
<?php 
}
foreach ($loop_tenggang_str as $rowloop_tenggang_str){
?>
    <tr>
      <td style="vertical-align:middle;">TENGGANG STR<br>
        <?= $rowloop_tenggang_str['nama_pegawai'] ?> / <?= $rowloop_tenggang_str['nip'] ?> [ Expired : <?= $this->m_rancak->fullBulan(date('d-m-Y',strtotime($rowloop_tenggang_str['tgl_b_berkas']))) ?>]
      </td><td>&nbsp;</td>
    </tr>
<?php 
}
foreach ($tenggang_sip as $rowtenggang_sip){
?>
    <tr>
      <td style="background-color:#f37220;color:white;vertical-align:middle;">Tenggang SIP</td>
      <td style="background-color:#f37220;color:white;vertical-align:middle;text-align: right;"><?= $rowtenggang_sip['total_str'] ?></td>
    </tr>
<?php 
}
foreach ($loop_tenggang_sip as $rowloop_tenggang_sip){
?>
    <tr>
      <td style="vertical-align:middle;">TENGGANG SIP<br>
        <?= $rowloop_tenggang_sip['nama_pegawai'] ?> / <?= $rowloop_tenggang_sip['nip'] ?> [ Expired : <?= $this->m_rancak->fullBulan(date('d-m-Y',strtotime($rowloop_tenggang_sip['tgl_b_berkas']))) ?>]
      </td><td>&nbsp;</td>
    </tr>
<?php 
}
foreach ($tenggang_sik as $rowtenggang_sik){
?>
    <tr>
      <td style="background-color:#f37220;color:white;vertical-align:middle;">Tenggang SIK</td>
      <td style="background-color:#f37220;color:white;vertical-align:middle;text-align: right;"><?= $rowtenggang_sik['total_str'] ?></td>
    </tr>
<?php 
}
foreach ($loop_tenggang_sik as $rowloop_tenggang_sik){
?>
    <tr>
      <td style="vertical-align:middle;">TENGGANG SIK<br>
        <?= $rowloop_tenggang_sik['nama_pegawai'] ?> / <?= $rowloop_tenggang_sik['nip'] ?> [ Expired : <?= $this->m_rancak->fullBulan(date('d-m-Y',strtotime($rowloop_tenggang_sik['tgl_b_berkas']))) ?>]
      </td><td>&nbsp;</td>
    </tr>
<?php 
}
foreach ($expired_str as $rowexpired_str){
?>
    <tr>
      <td style="background-color:#FE0101;color:white;vertical-align:middle;">Expired STR</td>
      <td style="background-color:#FE0101;color:white;vertical-align:middle;text-align: right;"><?= $rowexpired_str['total_str'] ?></td>
    </tr>
<?php 
}
foreach ($loop_expired_str as $rowloop_expired_str){
?>
    <tr>
      <td style="vertical-align:middle;">EXPIRED STR<br>
        <?= $rowloop_expired_str['nama_pegawai'] ?> / <?= $rowloop_expired_str['nip'] ?> [ Expired : <?= $this->m_rancak->fullBulan(date('d-m-Y',strtotime($rowloop_expired_str['tgl_b_berkas']))) ?>]
      </td><td>&nbsp;</td>
    </tr>
<?php 
}
foreach ($expired_sip as $rowexpired_sip){
?>
    <tr>
      <td style="background-color:#FE0101;color:white;vertical-align:middle;">Expired SIP</td>
      <td style="background-color:#FE0101;color:white;vertical-align:middle;text-align: right;"><?= $rowexpired_sip['total_str'] ?></td>
    </tr>
<?php 
}
foreach ($loop_expired_sip as $rowloop_expired_sip){
?>
    <tr>
      <td style="vertical-align:middle;">EXPIRED SIP<br>
        <?= $rowloop_expired_sip['nama_pegawai'] ?> / <?= $rowloop_expired_sip['nip'] ?> [ Expired : <?= $this->m_rancak->fullBulan(date('d-m-Y',strtotime($rowloop_expired_sip['tgl_b_berkas']))) ?>]
      </td><td>&nbsp;</td>
    </tr>
<?php 
}
foreach ($expired_sik as $rowexpired_sik){
?>
    <tr>
      <td style="background-color:#FE0101;color:white;vertical-align:middle;">Expired SIK</td>
      <td style="background-color:#FE0101;color:white;vertical-align:middle;text-align: right;"><?= $rowexpired_sik['total_str'] ?></td>
    </tr>
<?php 
}
foreach ($loop_expired_sik as $rowloop_expired_sik){
?>
    <tr>
      <td style="vertical-align:middle;">EXPIRED SIK<br>
        <?= $rowloop_expired_sik['nama_pegawai'] ?> / <?= $rowloop_expired_sik['nip'] ?> [ Expired : <?= $this->m_rancak->fullBulan(date('d-m-Y',strtotime($rowloop_expired_sik['tgl_b_berkas']))) ?>]
      </td>
      <td>&nbsp;</td>
    </tr>
<?php 
}
?>
    </tbody>
  </table>
        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="report")
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
      <h1>
        <?php echo $header; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
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
      <?php echo form_open_multipart('ketua_team/'.$page.'/view/'.$id.'/'.$id2.'/'.$id3.'/'.$id4,' id="signupform" '); ?>
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">RANGE / PERIODE TANGGAL (OPSI TANGGAL SEMUA UNTUK TAMPILKAN SEMUA DATA)</h3>
        </div>
          <div class="box-body">
          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Tanggal Awal</label>
                    <?php
                      input_calendar("id","id",$id,"Masukkan Tanggal","");
                    ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Tanggal Akhir</label>
                  <?php
                    input_calendar("id2","id2",$id2,"Masukkan Tanggal","");
                  ?>
                </div>
              </div>
            <div class="col-md-8">
              <div class="form-group">
              <label>Indikator</label>
              <?php
input_pdselect2fleksibel("id3","id3",$opsi,"id_equipment","nama_equipment",$id3,"SEMUA");
             //   input_pdselect2("id3",$opsi,$id3);
              ?>   
            </div>
            </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Opsi Tanggal</label>
                  <?php
                    input_pdselect2("id4",$all_kah,$id4);
                  ?>
                </div>
              </div>
          </div>
          </div>
          <div class="box-footer">
            <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
          </div>
        </div>
        <?php echo form_close(); ?>
      <div class="callout callout-success">
          Isi form yang ingin di tampilkan, jika tidak ditampilkan, form dapat di kosongkan<br>
          Tanggal awal dan Tanggal akhir adalah range tanggal mutu dibuat<br>
          Laporan ini dalam bentuk tabel dan grafik, data dapat dipilih sesuai dengan tema dan tujuan laporan
      </div>
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th style="display: none;">&nbsp;</th>            
            <th style="width:10%;text-align: center;vertical-align: middle;">Tanggal</th>
            <th style="width:15%;text-align: center;vertical-align: middle;">Range</th>                                                  
            <th style="text-align: center;vertical-align: middle;">Judul</th>                                                        
            <th style="text-align: center;vertical-align: middle;">Tujuan</th>                            
            <th style="text-align: center;vertical-align: middle;">Unit</th> 
            <th style="text-align: center;vertical-align: middle;">Pembuat</th>
          </tr>
        </thead>
      </table>
        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="sheet")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
#legenddiv {
  max-height: 150px;
  overflow: auto;
}
#chartdiv, #legendwrapper {
  width: 100%;
  height: 1000px;
}
#legenddiv {
  height: 150px;
}

#legendwrapper {
  max-height: 120px;
  overflow-x: none;
  overflow-y: auto;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?= $title ?></h3>

          <div class="box-tools pull-right">
      <?php
  //      input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <div class="callout callout-info">
        <h5>Judul Laporan : <?php echo $judul_laporan; ?><?php if($iddet) echo '</h5><h5>Judul Tabel / Grafik : '.$judul_laporan_detil; ?></h5>
      </div>

      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?= $title ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
      <div class="callout callout-success">
        <div class="row">
        <div class="col-md-6">
          Urutan = urutan di dalam tampilan tabel ini<br>
          Judul = Judul untuk tampilan di tabel ini<br>
          Range = Jika min nilai data dan max nilai data diisi<br>
          Indikator = Data indikator sebagai sebagai master<br>
          Tabel = Bentuk tabel / grafik yang di pilih<br>
          Sub Tombol = Bila di dalam laporan di tampilkan tombol ke tabel lainnya<br>
        </div>
        <div class="col-md-6">
          UNTUK MEMBUAT TABEL DENGAN RANGE BISA MEMILIH TABEL GRAFIK GARIS RANGE COMBINE<br>
          UNTUK MEMBUAT RANGE ISI FORM MINIMAL VALUE DAN ATAU MAXIMAL VALUE<br>
          UNTUK NILAI YANG TIDAK DIPERLUKAN ISI SAJA NOL (0)
        </div>
        </div>
      </div>
          <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
            <thead>
              <tr>
                <th style="width:5%;vertical-align: middle;text-align: center;">Urutan</th>            
                <th style="vertical-align: middle;">Judul</th>            
                <th style="vertical-align: middle;">Bentuk</th>            
                <th style="width:10%;vertical-align: middle;">Range</th>                     
                <th style="width:15%;vertical-align: middle;">Tabel</th>               
                <th style="width:15%;vertical-align: middle;">Unit</th>                                        
                <th style="width:10%;vertical-align: middle;">Sub Tombol</th>               
              </tr>
            </thead>
          </table>

        </div>
      </div>
        </div>       
      </div>
    </section>
</div>
<?php
}
elseif ($page=="demografi")
{
?>
<style type="text/css">
.select2-container {
    width: 100% !important;
    padding: 0;
}
#chartdiv {
  width: 100%;
  height: 500px;
}
#myBtn {
  display: none;
  position: fixed;
  bottom: 20px;
  right: 30px;
  z-index: 99;
  font-size: 18px;
  border: none;
  outline: none;
  background-color: red;
  color: white;
  cursor: pointer;
  padding: 15px;
  border-radius: 4px;
}

#myBtn:hover {
  background-color: #555;
}

.table-y {
  table-layout: fixed;
  display: block;
  height: 200px;
  overflow-y: auto;
}

.table-y          { overflow: auto; height: 200px; }
.table-y thead th { position: sticky; top: 0; z-index: 1; }
.table-y tbody th { position: sticky; left: 0; }

.table-x {
  table-layout: fixed;
  display: block;
  height: 500px;
  overflow-y: auto;
}

.table-x          { overflow: auto; height: 500px; }
.table-x thead th { position: sticky; top: 0; z-index: 1; }
.table-x tbody th { position: sticky; left: 0; }
</style>
<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-arrow-up"></i></button>
<div class="content-wrapper">
  <section class="content-header">
  <a href="<?php echo $link_awal;?>"
    class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" > <i class="fa fa-reply"></i> Kembali
  </a>
  </section>
  <section class="content">
<?php 
$nourutantable=0;
foreach ($loop_unit as $rowloop_unit){
  $nourutantable++;
  $knds_unite = array('id_unit'=>$rowloop_unit['id_unit'],'status_pegawai_unit'=>1);
  $jml_unite = $this->m_umum->jumlah_record_filter('ol_pegawai_unit',$knds_unite);
 // if($jml_unite > 0){
?>
    <div class="box box-<?php echo $thenarray; ?> box-solid">
      <div class="box-header with-border">
         <h3 class="box-title">Unit : <?= $rowloop_unit['nama_unit'] ?></h3>
        <div class="box-tools pull-right"></div>
      </div>
      <div class="box-body">
      <div class="row">
<!-- start 1 -->
        <div class="col-md-8">
<?php  
$nografik_pegawai_kab = 0;
$kondisi_loop = array('ol_pegawai_unit.id_unit'=>$rowloop_unit['id_unit']);
$ambil_list_pegawai = $this->m_admin_user->ambil_list_unit_pegawai($kondisi_loop);
foreach ($ambil_list_pegawai as $rowambil_list_pegawai){
$nografik_pegawai_kab++;
//---------- a ambil_list_pegawai
?>
<div class="col-md-6">
  <div class="box-body table-responsive no-padding">
    <table class="table table-hover table-x">
      <thead>
      <tr>
        <th style="width: 5%;"><?= $nografik_pegawai_kab ?></th>
        <th colspan='6' style="background-color: maroon;color: white;font-weight:bold;"><?= $rowambil_list_pegawai['nama_pegawai'] ?></th>
      </tr>        
      </thead>
      <tbody>
        <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='5' style="font-weight:bold;">Gender : 
            <?php 
              if($rowambil_list_pegawai['jk'] == 0){ echo 'Perempuan';}else{ echo 'laki-laki'; }
            ?>
          </td>
          <td rowspan="2" style="width: 15%;">
  <?php 
  if(empty($rowambil_list_pegawai['foto'])){
    $picprofile=base_url().'assets/images/noavatar.jpg';        
  }else{
    $cek_filesmall=FCPATH.'assets/foto/ol/'.$rowambil_list_pegawai['foto'];
    if(file_exists($cek_filesmall)){
      $picprofile=base_url().'assets/foto/ol/'.$rowambil_list_pegawai['foto'];
    }else{
      $picprofile=base_url().'assets/images/noavatar.jpg';
    }       
  }
    $dateb = date("Y-m-d", strtotime("+1 years"));
  ?>
  <a class="example-image-link" href="<?php echo $picprofile; ?>"
    data-lightbox="example-set" data-title="<?php echo $rowambil_list_pegawai['nama_pegawai']; ?>">
    <img class="profile-user-img img-responsive img-circle" src="<?php echo $picprofile; ?>" style="width: 50px;height: 50px;" alt="Photo">
  </a>
          </td>
        </tr>
        <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='5' style="font-weight:bold;">TTL : 
            <?php 
              echo $rowambil_list_pegawai['tmp_lahir'].", ". $this->m_rancak->fullBulan(date('d-m-Y', strtotime($rowambil_list_pegawai['tgl_lahir'])));    
            ?>
          </td>
        </tr>
        <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='6' style="font-weight:bold;">Age : 
            <?php 
              echo $this->m_rancak->dob($rowambil_list_pegawai['tgl_lahir']);
            ?>
          </td>
        </tr>
        <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='6' style="font-weight:bold;">Agama : 
            <?php 
              $rel = $this->m_umum->ambil_data('kol_agama','id_agama',$rowambil_list_pegawai['id_agama']);
              echo $rel['nama_agama'];
            ?>
          </td>
        </tr>
        <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='6' style="font-weight:bold;">Marital : 
            <?php 
              $mar = $this->m_umum->ambil_data('kol_status_kawin','id_status_kawin',$rowambil_list_pegawai['id_status_kawin']);
              echo $mar['nama_status_kawin'];
            ?>
          </td>
        </tr>
        <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='6' style="font-weight:bold;">Status Pegawai : 
            <?php 
              $st = $this->m_umum->ambil_data('ol_status_pegawai','id_status_pegawai',$rowambil_list_pegawai['tipe_pegawai']);
              echo $st['nama_status_pegawai'];
            ?>
          </td>
        </tr>
        <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='6' style="font-weight:bold;">Jabatan : 
            <?php 
              $jf = $this->m_umum->ambil_data('jabatan_fungsional','id_jabatan_fungsional',$rowambil_list_pegawai['id_jabatan_fungsional']);
              echo $jf['nama_jabatan_fungsional'];
            ?>
          </td>
        </tr>
        <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='6' style="font-weight:bold;">Pendidikan Terakhir : 
            <?php 
              $pen = $this->m_umum->ambil_data('kol_pendidikan','id_pendidikan',$rowambil_list_pegawai['id_pendidikan']);
               echo $pen['nama_pendidikan'];        
            ?>
          </td>
        </tr>
        <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='6' style="font-weight:bold;">Grade : 
            <?php 
              $grade = $this->m_umum->ambil_data('ol_pegawai_grade','id_grade',$rowambil_list_pegawai['id_grade']);
              if(empty($grade['nama_grade'])){
                echo'<button class="btn btn-danger btn-xs">Grade Belum Di Set</button>';
              }else{
               echo $grade['nama_grade'];        
              }
            ?>
          </td>
        </tr>
        <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='6' style="background-color: #e0e0e0;font-weight:bold;">SURAT IJIN</td>
        </tr>
<?php 
  $all_surat_ijin=$this->m_admin_kredensial->ambil_berkas_surat_ijin_list($rowambil_list_pegawai['id_pegawai']);
  foreach ($all_surat_ijin as $rowall_surat_ijin){
?>
        <tr>
            <td style="width: 5%;">&nbsp;</td>
            <td><?= $rowall_surat_ijin['nama_berkas_kategori'] ?></td>
            <td colspan='5'>
            <?php 
        if($rowall_surat_ijin['lifetime_berkas'] == '0'){
              if($rowall_surat_ijin['tgl_b_berkas'] <= date('Y-m-d')){
            ?>
                   <button class="btn btn-danger btn-xs">
                      <?= date('d-m-Y', strtotime($rowall_surat_ijin['tgl_b_berkas'])) ?>
                    </button>    
            <?php 
              }elseif(($rowall_surat_ijin['tgl_b_berkas'] >= date('Y-m-d')) && ($rowall_surat_ijin['tgl_b_berkas'] <= $dateb)){
            ?>
                   <button class="btn btn-warning btn-xs">
                      <?= date('d-m-Y', strtotime($rowall_surat_ijin['tgl_b_berkas'])) ?>
                    </button> 
            <?php 
              }else{
             ?>
                   <button class="btn btn-success btn-xs">
                      <?= date('d-m-Y', strtotime($rowall_surat_ijin['tgl_b_berkas'])) ?>
                    </button>            
            <?php             
              }
        }else{
          echo '<button class="btn btn-success btn-xs">SEUMUR HIDUP</button>';
        }
            ?>
            </td>
        </tr>
<?php 
  }
?>
        <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='6' style="background-color: #e0e0e0;font-weight:bold;">PEMINATAN</td>
        </tr>
  <?php
  $select_minat = "*";
  $kondisi_minat = array('opm.id_pegawai'=>$rowambil_list_pegawai['id_pegawai']);
  $minat=$this->m_admin_user->grafik_all_pegawai_minat($select_minat,$kondisi_minat);
  foreach ($minat as $rowminat){
  ?>
          <tr>
            <td style="width: 5%;">&nbsp;</td>
            <td colspan='6'><?= $rowminat['nama_peminatan'] ?></td>
          </tr>
  <?php  
  }
  ?> 
        <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='6' style="background-color: darkred;color: white; font-weight:bold;">PENILAIAN KINERJA</td>
        </tr>
        <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='6' style="background-color: #e0e0e0;font-weight:bold;">KINERJA KLINIS</td>
        </tr>
  <?php
  $logbook_person=$this->m_admin_user->ambil_grafik_logbook_person($rowambil_list_pegawai['id_pegawai']);
  foreach ($logbook_person as $rowlogbook_person){
  ?>
          <tr>
            <td style="width: 5%;">&nbsp;</td>
            <td colspan='3'><?= $rowlogbook_person['thnlg'] ?></td>
            <td style="text-align:right;" colspan='3'><?= $rowlogbook_person['jml_logbookp'] ?></td>
          </tr>
  <?php  
  }
  ?>
        <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='6' style="background-color: #e0e0e0;font-weight:bold;">ETIKA PROFESI</td>
        </tr>
  <?php
  $etikae=$this->m_admin_user->ambil_grafik_etik_person($rowambil_list_pegawai['id_pegawai']);
  foreach ($etikae as $rowetikae){
  ?>
          <tr>
            <td style="width: 5%;">&nbsp;</td>
            <td colspan='3'>
              <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($rowetikae['tgl_etik_pegawai']))) ?> [Penguji : <?= $rowetikae['nama_pegawai'] ?>]
            </td>
            <td style="text-align:left;" colspan='3'><?= $rowetikae['hasil_etik'] ?></td>
          </tr>
  <?php  
  }
  ?>
        <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='6' style="background-color: #e0e0e0;font-weight:bold;">PENGEMBANGAN PROFESI</td>
        </tr>
  <?php
  $ambil_pelatihan_biasa=$this->m_admin_kredensial->ambil_berkas_pelatihan_biasa('peg.id_pegawai',$rowambil_list_pegawai['id_pegawai']);
  foreach ($ambil_pelatihan_biasa as $rowambil_pelatihan_biasa){
  ?>
          <tr>
            <td style="width: 5%;">&nbsp;</td>
            <td colspan='6'><?= $rowambil_pelatihan_biasa['nama_berkas'] ?><br>Tanggal :  <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($rowambil_pelatihan_biasa['tgl_a_berkas']))) ?> - <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($rowambil_pelatihan_biasa['tgl_b_berkas']))) ?><br>Penyelenggara : <?= $rowambil_pelatihan_biasa['penyelenggara'] ?> - SKP : <?= number_format($rowambil_pelatihan_biasa['kredit'],1) ?>
          </td>
          </tr>
  <?php  
  }
  ?>
  <?php
  $ambil_pelatihan_person=$this->m_admin_kredensial->ambil_berkas_pelatihan_person('peg.id_pegawai',$rowambil_list_pegawai['id_pegawai']);
  foreach ($ambil_pelatihan_person as $rowambil_pelatihan_person){
  ?>
          <tr>
            <td style="width: 5%;">&nbsp;</td>
            <td colspan='6'><u>Kategori Pelatihan : <?= $rowambil_pelatihan_person['nama_kategori_pelatihan'] ?></u><br><?= $rowambil_pelatihan_person['nama_berkas'] ?><br>Tanggal :  <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($rowambil_pelatihan_person['tgl_a_berkas']))) ?> - <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($rowambil_pelatihan_person['tgl_b_berkas']))) ?><br>Penyelenggara : <?= $rowambil_pelatihan_person['penyelenggara'] ?> - SKP : <?= number_format($rowambil_pelatihan_person['kredit'],1) ?>
          </td>
          </tr>
  <?php  
  }
  ?>
        <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='6' style="background-color: #e0e0e0;font-weight:bold;">TEMPAT BEKERJA</td>
        </tr>
  <?php
  $select_tempat_gawe = "*";
  $kondisi_gawe = array('opi.id_pegawai'=>$rowambil_list_pegawai['id_pegawai'],'status_pegawai'=>1);
  $tempat_gawe=$this->m_admin_user->grafik_all_pegawai_result($select_tempat_gawe,$kondisi_gawe);
  foreach ($tempat_gawe as $rowtempat_gawe){
  ?>
          <tr>
            <td style="width: 5%;">&nbsp;</td>
            <td colspan='6'><?= $rowtempat_gawe['nama_working'] ?>, Status : <?php if($rowtempat_gawe['status_pegawai_instansi'] == 0){ echo 'RESIGN'; }else{ echo 'MASIH BEKERJA'; } ?></td>
          </tr>
  <?php  
  }
  ?>               
      </tbody>
    </table>
  </div><br style="line-height:50px;">
</div>
<?php  
//---------- z ambil_list_pegawai
}
?>
        </div>
<!-- end 1 -->
<!-- start 2 -->
        <div class="col-md-4">
          <h5 class="box-title" style="font-weight:bold;">DEMOGRAFI</h5>
<?php 
$laki = 0;$pr = 0;
$dateb = date("Y-m-d", strtotime("+1 years"));
$dateba = date("Y-m-d", strtotime("-1 years"));
$kondisi_1=array('status_pegawai'=>1,'visible'=>1,'opu.id_unit'=>$rowloop_unit['id_unit']);
$select_all = "*";
$select_gender = "SUM(CASE WHEN jk = '1' THEN 1 END) as mlc,SUM(CASE WHEN jk = '0' THEN 1 END) as flc";
$gender=$this->m_admin_kredensial->grafik_all_pegawai($select_gender,$kondisi_1);

$select_agama = "COUNT(ope.id_agama) as total_agama,nama_agama,ope.id_agama";
$agama=$this->m_admin_kredensial->grafik_all_pegawai_result($select_agama,$kondisi_1,'ope.id_agama');

$select_status_kawin = "COUNT(ope.id_status_kawin) as total_status_kawin,nama_status_kawin,ope.id_status_kawin";
$status_kawin=$this->m_admin_kredensial->grafik_all_pegawai_result($select_status_kawin,$kondisi_1,'ope.id_status_kawin');

$select_bebankerja = "sum(jml_logbook) as jml_logbooku,DATE_FORMAT(tgl_logbook,'%Y') as thnlgu";
$bebankerja=$this->m_admin_user->ambil_grafik_logbook($select_bebankerja,$kondisi_1,'ope.id_jabatan_fungsional');

$select_status_pegawai = "COUNT(ope.tipe_pegawai) as total_status_pegawai,nama_status_pegawai,ope.tipe_pegawai";
$status_pegawai=$this->m_admin_kredensial->grafik_all_pegawai_result($select_status_pegawai,$kondisi_1,'ope.tipe_pegawai');

$select_pendidikan = "COUNT(ope.id_pendidikan) as total_pendidikan,nama_pendidikan,ope.id_pendidikan";
$pendidikan=$this->m_admin_kredensial->grafik_all_pegawai_result($select_pendidikan,$kondisi_1,'ope.id_pendidikan');

$select_jabatan_fungsional = "COUNT(ope.id_jabatan_fungsional) as total_jabatan_fungsional,nama_jabatan_fungsional,ope.id_jabatan_fungsional";
$jf=$this->m_admin_kredensial->grafik_all_pegawai_result($select_jabatan_fungsional,$kondisi_1,'ope.id_jabatan_fungsional');

$select_peminatan = "COUNT(opm.id_peminatan) as total_peminatan,nama_peminatan";
$minate=$this->m_admin_kredensial->grafik_all_pegawai_minat($select_peminatan,$kondisi_1,'opm.id_peminatan');

$select_grade = "COUNT(ope.id_grade) as total_grade,nama_grade,ope.id_grade";
$gradee=$this->m_admin_kredensial->grafik_all_pegawai_result($select_grade,$kondisi_1,'ope.id_grade');

$select_pelatihan = "COUNT(peg.id_pegawai) as total_pelatihan,if(ob.id_kategori_pelatihan=0,'Pelatihan Umum',nama_kategori_pelatihan) as nama_kategori_pelatihan";
$pelatihan=$this->m_admin_kredensial->ambil_berkas_pelatihan_profesi('status_pegawai',1,'ob.id_kategori_pelatihan',$select_pelatihan);

$select_jml_bekerja = "COUNT(opu.id_unit) as total_instansie,nama_working";
$jml_bekerja=$this->m_admin_kredensial->grafik_all_pegawai_result($select_jml_bekerja,$kondisi_1);

$kondisi_expired_str=array('lifetime_berkas'=>0,'status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>1,'tgl_b_berkas <='=>date('Y-m-d'),'opu.id_unit'=>$rowloop_unit['id_unit']);
$expired_str=$this->m_admin_kredensial->ambil_berkas_ijin($kondisi_expired_str);
$kondisi_expired_sip=array('lifetime_berkas'=>0,'status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>2,'tgl_b_berkas <='=>date('Y-m-d'),'opu.id_unit'=>$rowloop_unit['id_unit']);
$expired_sip=$this->m_admin_kredensial->ambil_berkas_ijin($kondisi_expired_sip);
$kondisi_expired_sik=array('lifetime_berkas'=>0,'status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>3,'tgl_b_berkas <='=>date('Y-m-d'),'opu.id_unit'=>$rowloop_unit['id_unit']);
$expired_sik=$this->m_admin_kredensial->ambil_berkas_ijin($kondisi_expired_sik);

$kondisi_aktif_str=array('lifetime_berkas'=>1,'status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>1,'opu.id_unit'=>$rowloop_unit['id_unit']);
$kondisi_aktif_xstr=array('lifetime_berkas'=>0,'status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>1,'tgl_b_berkas >='=>$dateb,'opu.id_unit'=>$rowloop_unit['id_unit']);
$kondisi_aktif_sip=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>2,'tgl_b_berkas >='=>$dateb,'opu.id_unit'=>$rowloop_unit['id_unit']);
$kondisi_aktif_sik=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>3,'tgl_b_berkas >='=>$dateb,'opu.id_unit'=>$rowloop_unit['id_unit']);

$aktif_str=$this->m_admin_kredensial->ambil_berkas_ijin($kondisi_aktif_str);
$aktif_xstr=$this->m_admin_kredensial->ambil_berkas_ijin($kondisi_aktif_xstr);
$aktif_sip=$this->m_admin_kredensial->ambil_berkas_ijin($kondisi_aktif_sip);
$aktif_sik=$this->m_admin_kredensial->ambil_berkas_ijin($kondisi_aktif_sik);

$kondisi_tenggang_str=array('lifetime_berkas'=>0,'status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>1,'tgl_b_berkas >='=>date('Y-m-d'),'tgl_b_berkas <='=>$dateb,'opu.id_unit'=>$rowloop_unit['id_unit']);
$tenggang_str=$this->m_admin_kredensial->ambil_berkas_ijin($kondisi_tenggang_str);
$kondisi_tenggang_sip=array('lifetime_berkas'=>0,'status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>2,'tgl_b_berkas >='=>date('Y-m-d'),'tgl_b_berkas <='=>$dateb,'opu.id_unit'=>$rowloop_unit['id_unit']);
$tenggang_sip=$this->m_admin_kredensial->ambil_berkas_ijin($kondisi_tenggang_sip);
$kondisi_tenggang_sik=array('lifetime_berkas'=>0,'status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>3,'tgl_b_berkas >='=>date('Y-m-d'),'tgl_b_berkas <='=>$dateb,'opu.id_unit'=>$rowloop_unit['id_unit']);
$tenggang_sik=$this->m_admin_kredensial->ambil_berkas_ijin($kondisi_tenggang_sik);

$loop_expired_str=$this->m_admin_kredensial->ambil_data_berkas_ijin($kondisi_expired_str);
$loop_expired_sip=$this->m_admin_kredensial->ambil_data_berkas_ijin($kondisi_expired_sip);
$loop_expired_sik=$this->m_admin_kredensial->ambil_data_berkas_ijin($kondisi_expired_sik);

$loop_tenggang_str=$this->m_admin_kredensial->ambil_data_berkas_ijin($kondisi_tenggang_str);
$loop_tenggang_sip=$this->m_admin_kredensial->ambil_data_berkas_ijin($kondisi_tenggang_sip);
$loop_tenggang_sik=$this->m_admin_kredensial->ambil_data_berkas_ijin($kondisi_tenggang_sik);

$loop_aktif_str=$this->m_admin_kredensial->ambil_data_berkas_ijin($kondisi_aktif_str);
$loop_aktif_xstr=$this->m_admin_kredensial->ambil_data_berkas_ijin($kondisi_aktif_xstr);
$loop_aktif_sip=$this->m_admin_kredensial->ambil_data_berkas_ijin($kondisi_aktif_sip);
$loop_aktif_sik=$this->m_admin_kredensial->ambil_data_berkas_ijin($kondisi_aktif_sik);

$select_prov = "COUNT(ope.id_prov) as total_prov,nama_prov,ope.id_prov";
$prov=$this->m_admin_kredensial->grafik_all_pegawai_result($select_prov,$kondisi_1,'ope.id_prov');
?>
  <table id="examplea<?= $nourutantable ?>" width="100%" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th style="vertical-align:middle;background-color:#063970;color:white;width: 5%;text-align: right;">&nbsp;</th>
        <th style="vertical-align:middle;background-color:#063970;color:white;">GENDER</th>
      </tr>        
      </thead>
    <tbody>
      <tr>
        <td style="vertical-align:middle;text-align: right;background-color:#063970;color:white;text-align: right;"><?= $gender['mlc'] ?></td>
        <td style="vertical-align:middle;background-color:#063970;color:white;">Laki-laki</td>
      </tr>
<?php 
$kondisigm=array('jk'=>1,'status_pegawai'=>1,'visible'=>1,'opu.id_unit'=>$rowloop_unit['id_unit']);
$kondisigl=array('jk'=>0,'status_pegawai'=>1,'visible'=>1,'opu.id_unit'=>$rowloop_unit['id_unit']);
$loop_genderm = $this->m_admin_kredensial->grafik_all_pegawai_result($select_all,$kondisigm);
$loop_genderl = $this->m_admin_kredensial->grafik_all_pegawai_result($select_all,$kondisigl);
$nog=0;
foreach ($loop_genderm as $rowloop_genderm){
  $nog++;
?>
      <tr>
        <td style="vertical-align:middle;text-align: right;"><?= $nog ?></td>
        <td style="vertical-align:middle;"><?= $rowloop_genderm['nama_pegawai'] ?> / <?= $rowloop_genderm['nip'] ?></td>
      </tr>
<?php 
}
?>
      <tr>
        <td style="vertical-align:middle;text-align: right;background-color:#063970;color:white;text-align: right;"><?= $gender['flc'] ?></td>
        <td style="vertical-align:middle;background-color:#063970;color:white;">Perempuan</td>
      </tr>
<?php
$nogl=0;
foreach ($loop_genderl as $rowloop_genderl){
  $nogl++;
?>
      <tr>
        <td style="vertical-align:middle;text-align: right;"><?= $nogl ?></td>
        <td style="vertical-align:middle;"><?= $rowloop_genderl['nama_pegawai'] ?> / <?= $rowloop_genderl['nip'] ?></td>
      </tr>
<?php 
}
?>
    </tbody>
  </table><br style="line-height:50px;">
  <table id="exampleb<?= $nourutantable ?>" width="100%" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th style="vertical-align:middle;background-color:#979915;color:white;width: 5%;text-align: right;">&nbsp;</th>
        <th style="vertical-align:middle;background-color:#979915;color:white;">AGAMA</th>
      </tr>        
      </thead>
    <tbody>
<?php
foreach ($agama as $rowagama){
?>
    <tr>
      <td style="vertical-align:middle;text-align: right;background-color:#979915;color:white;text-align: right;"><?= $rowagama['total_agama'] ?></td>
      <td style="vertical-align:middle;background-color:#979915;color:white;">Agama : <?= $rowagama['nama_agama'] ?></td>
    </tr>
<?php
$noa=0;
$kondisiag=array('ope.id_agama'=>$rowagama['id_agama'],'status_pegawai'=>1,'visible'=>1,'opu.id_unit'=>$rowloop_unit['id_unit']);
$loop_agama = $this->m_admin_kredensial->grafik_all_pegawai_result($select_all,$kondisiag);
foreach ($loop_agama as $rowloop_agama){
  $noa++;
?>
      <tr>
        <td style="vertical-align:middle;text-align: right;"><?= $noa ?></td>
        <td style="vertical-align:middle;"><?= $rowloop_agama['nama_pegawai'] ?> / <?= $rowloop_agama['nip'] ?></td>
      </tr>
<?php 
}
}
?>
    </tbody>
  </table><br style="line-height:50px;">
  <table id="examplec<?= $nourutantable ?>" width="100%" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th style="vertical-align:middle;background-color:#063970;color:white;width: 5%;text-align: right;">&nbsp;</th>
        <th style="vertical-align:middle;background-color:#063970;color:white;">MARITAL STATUS</th>
      </tr>        
      </thead>
    <tbody>
<?php
foreach ($status_kawin as $rowstatus_kawin){
?>
    <tr>
      <td style="vertical-align:middle;text-align: right;background-color:#063970;color:white;text-align: right;"><?= $rowstatus_kawin['total_status_kawin'] ?></td>
      <td style="vertical-align:middle;background-color:#063970;color:white;">Status Kawin : <?= $rowstatus_kawin['nama_status_kawin'] ?></td>
    </tr>
<?php
$nosk=0;
$kondisiask=array('ope.id_status_kawin'=>$rowstatus_kawin['id_status_kawin'],'status_pegawai'=>1,'visible'=>1,'opu.id_unit'=>$rowloop_unit['id_unit']);
$loop_sk = $this->m_admin_kredensial->grafik_all_pegawai_result($select_all,$kondisiask);
foreach ($loop_sk as $rowloop_sk){
  $nosk++;
?>
      <tr>
        <td style="vertical-align:middle;text-align: right;"><?= $nosk ?></td>
        <td style="vertical-align:middle;"><?= $rowloop_sk['nama_pegawai'] ?> / <?= $rowloop_sk['nip'] ?></td>
      </tr>
<?php 
} 
}
?>
    </tbody>
  </table><br style="line-height:50px;">
  <table id="exampled<?= $nourutantable ?>" width="100%" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th style="vertical-align:middle;background-color:#979915;color:white;width: 5%;text-align: right;">&nbsp;</th>
        <th style="vertical-align:middle;background-color:#979915;color:white;">STATUS PEGAWAI</th>
      </tr>        
      </thead>
    <tbody>
<?php
foreach ($status_pegawai as $rowstatus_pegawai){
?>
    <tr>
      <td style="vertical-align:middle;text-align: right;background-color:#979915;color:white;text-align: right;"><?= $rowstatus_pegawai['total_status_pegawai'] ?></td>
      <td style="vertical-align:middle;background-color:#979915;color:white;">Status Pegawai : <?= $rowstatus_pegawai['nama_status_pegawai'] ?></td>
    </tr>
<?php
$nosp=0;
$kondisiasp=array('ope.tipe_pegawai'=>$rowstatus_pegawai['tipe_pegawai'],'status_pegawai'=>1,'visible'=>1,'opu.id_unit'=>$rowloop_unit['id_unit']);
$loop_sp = $this->m_admin_kredensial->grafik_all_pegawai_result($select_all,$kondisiasp);
foreach ($loop_sp as $rowloop_sp){
  $nosp++;
?>
      <tr>
        <td style="vertical-align:middle;text-align: right;"><?= $nosp ?></td>
        <td style="vertical-align:middle;"><?= $rowloop_sp['nama_pegawai'] ?> / <?= $rowloop_sp['nip'] ?></td>
      </tr>
<?php 
} 
}
?>
    </tbody>
  </table><br style="line-height:50px;">
  <table id="examplee<?= $nourutantable ?>" width="100%" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th style="vertical-align:middle;background-color:#063970;color:white;width: 5%;text-align: right;">&nbsp;</th>
        <th style="vertical-align:middle;background-color:#063970;color:white;">STATUS PENDIDIDKAN</th>
      </tr>        
      </thead>
    <tbody>
<?php
foreach ($pendidikan as $rowpendidikan){
?>
    <tr>
      <td style="vertical-align:middle;text-align: right;background-color:#063970;color:white;"><?= $rowpendidikan['total_pendidikan'] ?></td>
      <td style="vertical-align:middle;background-color:#063970;color:white;">Pendidikan : <?= $rowpendidikan['nama_pendidikan'] ?></td>
    </tr>
<?php 
$nopddk=0;
$kondisiapddk=array('ope.id_pendidikan'=>$rowpendidikan['id_pendidikan'],'status_pegawai'=>1,'visible'=>1,'opu.id_unit'=>$rowloop_unit['id_unit']);
$loop_pddk = $this->m_admin_kredensial->grafik_all_pegawai_result($select_all,$kondisiapddk);
foreach ($loop_pddk as $rowloop_pddk){
  $nopddk++;
?>
      <tr>
        <td style="vertical-align:middle;"><?= $nopddk ?></td>
        <td style="vertical-align:middle;"><?= $rowloop_pddk['nama_pegawai'] ?> / <?= $rowloop_pddk['nip'] ?></td>
      </tr>
<?php 
} 
}
?>
    </tbody>
  </table><br style="line-height:50px;">
  <table id="examplef<?= $nourutantable ?>" width="100%" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th style="vertical-align:middle;background-color:#979915;color:white;width: 5%;text-align: right;">&nbsp;</th>
        <th style="vertical-align:middle;background-color:#979915;color:white;">JABATAN FUNGSIONAL</th>
      </tr>        
      </thead>
    <tbody>
<?php
foreach ($jf as $rowjf){
?>
    <tr>
      <td style="vertical-align:middle;text-align: right;background-color:#979915;color:white;text-align: right;"><?= $rowjf['total_jabatan_fungsional'] ?></td>
      <td style="vertical-align:middle;background-color:#979915;color:white;">Jabatan Fungsional : <?= $rowjf['nama_jabatan_fungsional'] ?></td>
    </tr>
<?php 
$nojf=0;
$kondisijf=array('ope.id_jabatan_fungsional'=>$rowjf['id_jabatan_fungsional'],'status_pegawai'=>1,'visible'=>1,'opu.id_unit'=>$rowloop_unit['id_unit']);
$loop_jf = $this->m_admin_kredensial->grafik_all_pegawai_result($select_all,$kondisijf);
foreach ($loop_jf as $rowloop_jf){
  $nojf++;
?>
      <tr>
        <td style="vertical-align:middle;text-align: right;"><?= $nojf ?></td>
        <td style="vertical-align:middle;"><?= $rowloop_jf['nama_pegawai'] ?> / <?= $rowloop_jf['nip'] ?></td>
      </tr>
<?php 
} 
}
?>
    </tbody>
  </table><br style="line-height:50px;">
  <table id="exampleg<?= $nourutantable ?>" width="100%" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th style="vertical-align:middle;background-color:#063970;color:white;width: 5%;text-align: right;">&nbsp;</th>
        <th style="vertical-align:middle;background-color:#063970;color:white;">GRADE</th>
      </tr>        
      </thead>
    <tbody>
<?php
foreach ($gradee as $rowgrade){
?>
    <tr>
      <td style="vertical-align:middle;text-align: right;background-color:#063970;color:white;text-align: right;"><?= $rowgrade['total_grade'] ?></td>
      <td style="vertical-align:middle;background-color:#063970;color:white;">Grade : <?= $rowgrade['nama_grade'] ?></td>
    </tr>
<?php 
$nogrd=0;
$kondisigr=array('ope.id_grade'=>$rowgrade['id_grade'],'status_pegawai'=>1,'visible'=>1,'opu.id_unit'=>$rowloop_unit['id_unit']);
$loop_grd = $this->m_admin_kredensial->grafik_all_pegawai_result($select_all,$kondisigr);
foreach ($loop_grd as $rowloop_grd){
  $nogrd++;
?>
      <tr>
        <td style="vertical-align:middle;text-align: right;"><?= $nogrd ?></td>
        <td style="vertical-align:middle;"><?= $rowloop_grd['nama_pegawai'] ?> / <?= $rowloop_grd['nip'] ?></td>
      </tr>
<?php 
} 
}
?>
    </tbody>
  </table><br style="line-height:50px;">
  <table id="exampleh<?= $nourutantable ?>" width="100%" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th style="vertical-align:middle;background-color:#979915;color:white;width: 5%;text-align: right;">&nbsp;</th>
        <th style="vertical-align:middle;background-color:#979915;color:white;">KINERJA KLINIS</th>
      </tr>        
      </thead>
      <tbody>
<?php 
foreach ($bebankerja as $rowbebankerja){
?>
    <tr>
      <td style="vertical-align:middle;text-align: right;background-color:#979915;color:white;text-align: right;"><?= $rowbebankerja['jml_logbooku'] ?></td>
      <td style="vertical-align:middle;background-color:#979915;color:white;"><?= $rowbebankerja['thnlgu'] ?></td>
    </tr>
<?php 
$loopbbnkerja = $this->m_admin_user->ambil_grafik_logbook_person_tahunan($rowbebankerja['thnlgu'],$rowloop_unit['id_unit']);
foreach ($loopbbnkerja as $rowloopbbnkerja){
?>
      <tr>
        <td style="vertical-align:middle;text-align: right;"><?= $nogrd ?></td>
        <td style="vertical-align:middle;"><?= $rowloopbbnkerja['nama_pegawai'] ?> / <?= $rowloopbbnkerja['nip'] ?> Kinerja Klinis : <?= $rowloopbbnkerja['jml_logbookp'] ?></td>
      </tr>
<?php 
} 
}
?>
    </tbody>
  </table><br style="line-height:50px;">
  <table id="examplei<?= $nourutantable ?>" width="100%" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th style="vertical-align:middle;background-color:#063970;color:white;width: 5%;text-align: right;">&nbsp;</th>
        <th style="vertical-align:middle;background-color:#063970;color:white;">SURAT IJIN</th>
      </tr>        
      </thead>
      <tbody>
<?php
foreach ($aktif_xstr as $rowaktif_xstr){
?>
    <tr>
      <td style="background-color:#008000;color:white;vertical-align:middle;text-align: right;"><?= $rowaktif_xstr['total_str'] ?></td>
      <td style="background-color:#008000;color:white;vertical-align:middle;">Aktif STR</td>
    </tr>
<?php 
}
$noaktstrhdp = 0;
foreach ($loop_aktif_xstr as $rowloop_aktif_xstr){
  $noaktstrhdp++;
?>
    <tr>
      <td  style="vertical-align:middle;text-align: right;">
        <?= $noaktstrhdp ?>
      </td>
      <td  style="vertical-align:middle;">
        <?= $rowloop_aktif_xstr['nama_pegawai'] ?> / <?= $rowloop_aktif_xstr['nip'] ?> [ Expired : <?php if($rowloop_aktif_xstr['lifetime_berkas'] == 0){ echo $this->m_rancak->fullBulan(date('d-m-Y',strtotime($rowloop_aktif_xstr['tgl_b_berkas']))); }else{ echo 'SEUMUR HIDUP'; } ?>]
      </td>
    </tr>
<?php 
}
foreach ($aktif_str as $rowaktif_str){
?>
    <tr>
      <td style="background-color:#008000;color:white;vertical-align:middle;text-align: right;"><?= $rowaktif_str['total_str'] ?></td>
      <td style="background-color:#008000;color:white;vertical-align:middle;">STR Seumur Hidup</td>
    </tr>
<?php 
}
$noaktstr = 0;
foreach ($loop_aktif_str as $rowloop_aktif_str){
  $noaktstr++;
?>
    <tr>
      <td  style="vertical-align:middle;text-align: right;">
        <?= $noaktstr ?>
      </td>
      <td style="vertical-align:middle;">
        <?= $rowloop_aktif_str['nama_pegawai'] ?> / <?= $rowloop_aktif_str['nip'] ?> [ Expired : <?php if($rowloop_aktif_str['lifetime_berkas'] == 0){ echo $this->m_rancak->fullBulan(date('d-m-Y',strtotime($rowloop_aktif_str['tgl_b_berkas']))); }else{ echo 'SEUMUR HIDUP'; } ?>]
      </td>
    </tr>
<?php 
}
foreach ($aktif_sip as $rowaktif_sip){
?>
    <tr>
      <td style="background-color:#008000;color:white;vertical-align:middle;text-align: right;"><?= $rowaktif_sip['total_str'] ?></td>
      <td style="background-color:#008000;color:white;vertical-align:middle;">Aktif SIP</td>
    </tr>
<?php 
}
$noaktsip = 0;
foreach ($loop_aktif_sip as $rowloop_aktif_sip){
  $noaktsip++;
?>
    <tr>
      <td  style="vertical-align:middle;text-align: right;">
        <?= $noaktsip ?>
      </td>
      <td style="vertical-align:middle;">
        <?= $rowloop_aktif_sip['nama_pegawai'] ?> / <?= $rowloop_aktif_sip['nip'] ?> [ Expired : <?= $this->m_rancak->fullBulan(date('d-m-Y',strtotime($rowloop_aktif_sip['tgl_b_berkas']))) ?>]
      </td>
    </tr>
<?php 
}
foreach ($aktif_sik as $rowaktif_sik){
?>
    <tr>
      <td style="background-color:#008000;color:white;vertical-align:middle;text-align: right;"><?= $rowaktif_sik['total_str'] ?></td>
      <td style="background-color:#008000;color:white;vertical-align:middle;">Aktif SIK</td>
    </tr>
<?php 
}
$noaktsik = 0;
foreach ($loop_aktif_sik as $rowloop_aktif_sik){
  $noaktsik++;
?>
    <tr>
      <td  style="vertical-align:middle;text-align: right;">
        <?= $noaktsik ?>
      </td>
      <td style="vertical-align:middle;">
        <?= $rowloop_aktif_sik['nama_pegawai'] ?> / <?= $rowloop_aktif_sik['nip'] ?> [ Expired : <?= $this->m_rancak->fullBulan(date('d-m-Y',strtotime($rowloop_aktif_sik['tgl_b_berkas']))) ?>]
      </td>
    </tr>
<?php 
}
foreach ($tenggang_str as $rowtenggang_str){
?>
    <tr>
      <td style="background-color:#f37220;color:white;vertical-align:middle;text-align: right;"><?= $rowtenggang_str['total_str'] ?></td>
      <td style="background-color:#f37220;color:white;vertical-align:middle;">Tenggang STR</td>
    </tr>
<?php 
}
$notgstr = 0;
foreach ($loop_tenggang_str as $rowloop_tenggang_str){
  $notgstr++;
?>
    <tr>
      <td  style="vertical-align:middle;text-align: right;">
        <?= $notgstr ?>
      </td>
      <td style="vertical-align:middle;">
        <?= $rowloop_tenggang_str['nama_pegawai'] ?> / <?= $rowloop_tenggang_str['nip'] ?> [ Expired : <?= $this->m_rancak->fullBulan(date('d-m-Y',strtotime($rowloop_tenggang_str['tgl_b_berkas']))) ?>]
      </td>
    </tr>
<?php 
}
foreach ($tenggang_sip as $rowtenggang_sip){
?>
    <tr>
      <td style="background-color:#f37220;color:white;vertical-align:middle;text-align: right;"><?= $rowtenggang_sip['total_str'] ?></td>
      <td style="background-color:#f37220;color:white;vertical-align:middle;">Tenggang SIP</td>
    </tr>
<?php 
}
$notgsip = 0;
foreach ($loop_tenggang_sip as $rowloop_tenggang_sip){
  $notgsip++;
?>
    <tr>
      <td  style="vertical-align:middle;text-align: right;">
        <?= $notgsip ?>
      </td>
      <td style="vertical-align:middle;">
        <?= $rowloop_tenggang_sip['nama_pegawai'] ?> / <?= $rowloop_tenggang_sip['nip'] ?> [ Expired : <?= $this->m_rancak->fullBulan(date('d-m-Y',strtotime($rowloop_tenggang_sip['tgl_b_berkas']))) ?>]
      </td>
    </tr>
<?php 
}
foreach ($tenggang_sik as $rowtenggang_sik){
?>
    <tr>
      <td style="background-color:#f37220;color:white;vertical-align:middle;text-align: right;"><?= $rowtenggang_sik['total_str'] ?></td>
      <td style="background-color:#f37220;color:white;vertical-align:middle;">Tenggang SIK</td>
    </tr>
<?php 
}
$notgsik = 0;
foreach ($loop_tenggang_sik as $rowloop_tenggang_sik){
  $notgsik++;
?>
    <tr>
      <td  style="vertical-align:middle;text-align: right;">
        <?= $notgsik ?>
      </td>
      <td style="vertical-align:middle;">
        <?= $rowloop_tenggang_sik['nama_pegawai'] ?> / <?= $rowloop_tenggang_sik['nip'] ?> [ Expired : <?= $this->m_rancak->fullBulan(date('d-m-Y',strtotime($rowloop_tenggang_sik['tgl_b_berkas']))) ?>]
      </td>
    </tr>
<?php 
}
foreach ($expired_str as $rowexpired_str){
?>
    <tr>
      <td style="background-color:#FE0101;color:white;vertical-align:middle;text-align: right;"><?= $rowexpired_str['total_str'] ?></td>
      <td style="background-color:#FE0101;color:white;vertical-align:middle;">Expired STR</td>
    </tr>
<?php 
}
$noexpstr = 0;
foreach ($loop_expired_str as $rowloop_expired_str){
  $noexpstr++;
?>
    <tr>
      <td  style="vertical-align:middle;text-align: right;">
        <?= $noexpstr ?>
      </td>
      <td style="vertical-align:middle;">
        <?= $rowloop_expired_str['nama_pegawai'] ?> / <?= $rowloop_expired_str['nip'] ?> [ Expired : <?= $this->m_rancak->fullBulan(date('d-m-Y',strtotime($rowloop_expired_str['tgl_b_berkas']))) ?>]
      </td>
    </tr>
<?php 
}
foreach ($expired_sip as $rowexpired_sip){
?>
    <tr>
      <td style="background-color:#FE0101;color:white;vertical-align:middle;text-align: right;"><?= $rowexpired_sip['total_str'] ?></td>
      <td style="background-color:#FE0101;color:white;vertical-align:middle;">Expired SIP</td>
    </tr>
<?php 
}
$noexpsip = 0;
foreach ($loop_expired_sip as $rowloop_expired_sip){
  $noexpsip++;
?>
    <tr>
      <td  style="vertical-align:middle;text-align: right;">
        <?= $noexpsip ?>
      </td>
      <td style="vertical-align:middle;">
        <?= $rowloop_expired_sip['nama_pegawai'] ?> / <?= $rowloop_expired_sip['nip'] ?> [ Expired : <?= $this->m_rancak->fullBulan(date('d-m-Y',strtotime($rowloop_expired_sip['tgl_b_berkas']))) ?>]
      </td>
    </tr>
<?php 
}
foreach ($expired_sik as $rowexpired_sik){
?>
    <tr>
      <td style="background-color:#FE0101;color:white;vertical-align:middle;text-align: right;"><?= $rowexpired_sik['total_str'] ?></td>
      <td style="background-color:#FE0101;color:white;vertical-align:middle;">Expired SIK</td>
    </tr>
<?php 
}
$noexpsik = 0;
foreach ($loop_expired_sik as $rowloop_expired_sik){
  $noexpsik++;
?>
    <tr>
      <td  style="vertical-align:middle;text-align: right;">
        <?= $noexpsik ?>
      </td>
      <td style="vertical-align:middle;">
        <?= $rowloop_expired_sik['nama_pegawai'] ?> / <?= $rowloop_expired_sik['nip'] ?> [ Expired : <?= $this->m_rancak->fullBulan(date('d-m-Y',strtotime($rowloop_expired_sik['tgl_b_berkas']))) ?>]
      </td>
    </tr>
<?php 
}
?>
</tbody>
</table>
  <table id="examplej<?= $nourutantable ?>" width="100%" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th style="vertical-align:middle;background-color:#979915;color:white;width: 5%;text-align: right;">&nbsp;</th>
        <th style="vertical-align:middle;background-color:#979915;color:white;">DEMOGRAFI</th>
      </tr>        
      </thead>
      <tbody>
<?php 
foreach ($prov as $rowprov){
?>
    <tr>
      <td style="background-color:#063970;color:white;vertical-align:middle;text-align: right;"><?= $rowprov['total_prov'] ?>
      <td style="background-color:#063970;color:white;vertical-align:middle;"><?= $rowprov['nama_prov'] ?></td>
      </td>
    </tr>
<?php 
$kondisi_kab=array('status_pegawai'=>1,'visible'=>1,'ope.id_prov'=>$rowprov['id_prov'],'opu.id_unit'=>$rowloop_unit['id_unit']);
$select_kab = "COUNT(ope.id_kab) as total_kab,nama_kab,ope.id_kab";
$kab=$this->m_admin_kredensial->grafik_all_pegawai_result($select_kab,$kondisi_kab,'ope.id_kab');

  foreach ($kab as $rowkab){
?>
    <tr>
      <td style="background-color:#8C0720;color:white;vertical-align:middle;text-align: right;"><?= $rowkab['total_kab'] ?></td>
      <td style="background-color:#8C0720;color:white;vertical-align:middle;padding-left: 20px;">&nbsp;&nbsp;<?= $rowkab['nama_kab'] ?></td>
    </tr>
<?php
$kondisi_kec=array('status_pegawai'=>1,'visible'=>1,'ope.id_kab'=>$rowkab['id_kab'],'opu.id_unit'=>$rowloop_unit['id_unit']);
$select_kec = "COUNT(ope.id_kec) as total_kec,nama_kec,ope.id_kec";
$kec=$this->m_admin_kredensial->grafik_all_pegawai_result($select_kec,$kondisi_kec,'ope.id_kec');

    foreach ($kec as $rowkec){
?>
    <tr>
      <td style="background-color:#078C8A;color:white;vertical-align:middle;text-align: right;"><?= $rowkec['total_kec'] ?></td>
      <td style="background-color:#078C8A;color:white;vertical-align:middle;padding-left: 35px;"><?= $rowkec['nama_kec'] ?></td>
    </tr>
<?php
$kondisi_kel=array('status_pegawai'=>1,'visible'=>1,'ope.id_kec'=>$rowkec['id_kec'],'opu.id_unit'=>$rowloop_unit['id_unit']);
$select_kel = "COUNT(ope.id_kel) as total_kel,nama_kel,ope.id_kel";
$kel=$this->m_admin_kredensial->grafik_all_pegawai_result($select_kel,$kondisi_kel,'ope.id_kel');

      foreach ($kel as $rowkel){
?>
    <tr>
      <td style="background-color:#238C07;color:white;vertical-align:middle;text-align: right;"><?= $rowkel['total_kel'] ?></td>
      <td style="background-color:#238C07;color:white;vertical-align:middle;padding-left: 50px;"><?= $rowkel['nama_kel'] ?></td>
    </tr>
<?php
$nodemo = 0;
$kndskec=array('status_pegawai'=>1,'visible'=>1,'ope.id_kel'=>$rowkel['id_kel'],'opu.id_unit'=>$rowloop_unit['id_unit']);
$loopbbnkerja = $this->m_admin_kredensial->grafik_all_pegawai_result($select_all,$kndskec);
foreach ($loopbbnkerja as $rowloopbbnkerja){
  $nodemo++;
?>
    <tr>
      <td  style="vertical-align:middle;text-align: right;">
        <?= $nodemo ?>
      </td>
      <td style="vertical-align:middle;">
        <?= $rowloopbbnkerja['nama_pegawai'] ?> / <?= $rowloopbbnkerja['nip'] ?> [ <b>Alamat : <?= $rowloopbbnkerja['alamat'] ?></b> ]
      </td>
    </tr>
<?php 
}
      }
    }
  }
}
?>
    </tbody>
  </table>
        </div>
<!-- end 2 -->
      </div>
      </div>
    </div>
<?php 
//}
}
?>
  </section>
</div>
<?php
}
elseif ($page=="kinerja_klinis_lbulanan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
#chartdiv {
  width: 100%;
  height: 500px;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $title; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('ketua_team/kinerja_klinis/lbulanan/'.$bulan.'/'.$tahun.'/'.$id_pegawai,' id="signupform" '); ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
    </div>
      <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Pegawai</label>
              <?php
                input_pdselect2fleksibel("id_pegawai","id_pegawai",$cmd_pegawai,"barcode_pegawai","nama_pegawai",$id_pegawai,"Silahkan Pilih Pegawai Dahulu");
              ?>
          </div>
        </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Tanggal Awal</label>
                <?php
                  input_calendar("bulan","bulan",$bulan,"Masukkan Tanggal Transaksi","required");
                ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Tanggal Akhir</label>
              <?php
                input_calendar("tahun","tahun",$tahun,"Masukkan Tanggal Transaksi","required");
              ?>
            </div>
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
           <h3 class="box-title">TOTAL KINERJA KLINIS</h3>
          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
       <table id="example1" width="100%" class="table table-bordered table-striped">
          <?php
          foreach($ambil_range as $rowambil_rangex){
            $ambil_range_logbook_kompetensix = $this->m_admin_user->ambil_range_logbook_kompetensi($rowambil_rangex['bulan'],$rowambil_rangex['tahun'],$id_pegawai,'hasile');
            foreach($ambil_range_logbook_kompetensix as $rowambil_rangex_logbook_kompetensi){
          ?>
        <tr>
          <td colspan="2" style="vertical-align:middle;text-align:left;">
            [<?php echo $rowambil_rangex_logbook_kompetensi['kode_unit']; ?>] : <?php echo $rowambil_rangex_logbook_kompetensi['nama_kompetensi']; ?>
            </td>
            <td colspan="2" style="vertical-align:middle;text-align:right;"><?php echo $rowambil_rangex_logbook_kompetensi['jumlahk']; ?></td>
        </tr>
          <?php
            $ambil_range_logbook_bulanane_detilx = $this->m_admin_user->ambil_range_logbook_bulanane_detil($rowambil_rangex['bulan'],$rowambil_rangex['tahun'],$rowambil_rangex_logbook_kompetensi['id_kompetensi'],$id_pegawai,'hasile');
              foreach($ambil_range_logbook_bulanane_detilx as $rowambil_range_logbook_bulanane_detilx){
          ?>
        <tr>
          <td style="vertical-align:middle;text-align:left;width:3%;">&nbsp;</td>
          <td style="vertical-align:middle;text-align:left;">
            <?php echo $rowambil_range_logbook_bulanane_detilx['nama_kewenangan']; ?>
            </td>
            <td style="vertical-align:middle;text-align:right;width: 5%;"><?php echo $rowambil_range_logbook_bulanane_detilx['jumlah']; ?></td>
            <td style="vertical-align:middle;text-align:right;">&nbsp;</td>
        </tr>
          <?php
              }
            }
          }
          ?>
      </table>
        </div>
        <div class="box-footer">

        </div>
      </div>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">RINCIAN KINERJA KLINIS</h3>
          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
       <table id="example2" width="100%" class="table table-bordered table-striped">
          <?php
          foreach($ambil_range as $rowambil_range){
          ?>
        <tr>
          <td style="vertical-align:middle;text-align:left;font-weight:bold;">PERIODE</td>
          <td colspan="2" style="vertical-align:middle;text-align:left;font-weight:bold;"><?php echo $this->m_rancak->getBulan($rowambil_range['bulan']); ?> - <?php echo $rowambil_range['tahun']; ?></td>
          <td colspan="2" style="vertical-align:middle;text-align:center;font-weight:bold;width: 10%;">Jumlah</td>
        </tr>
          <?php
            $ambil_range_logbook_kompetensi = $this->m_admin_user->ambil_range_logbook_kompetensi($rowambil_range['bulan'],$rowambil_range['tahun'],$id_pegawai);
            foreach($ambil_range_logbook_kompetensi as $rowambil_range_logbook_kompetensi){
          ?>
        <tr>
          <td style="vertical-align:middle;text-align:left;width:3%;">&nbsp;</td>
          <td colspan="2" style="vertical-align:middle;text-align:left;">
            [<?php echo $rowambil_range_logbook_kompetensi['kode_unit']; ?>] : <?php echo $rowambil_range_logbook_kompetensi['nama_kompetensi']; ?>
            </td>
            <td colspan="2" style="vertical-align:middle;text-align:right;"><?php echo $rowambil_range_logbook_kompetensi['jumlahk']; ?></td>
        </tr>
          <?php
            $ambil_range_logbook_bulanane_detil = $this->m_admin_user->ambil_range_logbook_bulanane_detil($rowambil_range['bulan'],$rowambil_range['tahun'],$rowambil_range_logbook_kompetensi['id_kompetensi'],$id_pegawai);
              foreach($ambil_range_logbook_bulanane_detil as $rowambil_range_logbook_bulanane_detil){
          ?>
        <tr>
          <td style="vertical-align:middle;text-align:left;width:3%;">&nbsp;</td>
          <td style="vertical-align:middle;text-align:left;width:3%;">&nbsp;</td>
          <td style="vertical-align:middle;text-align:left;">
            <?php echo $rowambil_range_logbook_bulanane_detil['nama_kewenangan']; ?>
            </td>
            <td style="vertical-align:middle;text-align:right;width: 5%;"><?php echo $rowambil_range_logbook_bulanane_detil['jumlah']; ?></td>
            <td style="vertical-align:middle;text-align:right;">&nbsp;</td>
        </tr>
          <?php
              }
            }
          }
          ?>
      </table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="pengembangan_profesi")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
#chartdiv {
  width: 100%;
  height: 500px;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $title; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('ketua_team/pengembangan_profesi/view/'.$first_date.'/'.$last_date.'/'.$id_pegawai,' id="signupform" '); ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
    </div>
      <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Pegawai</label>
              <?php
                input_pdselect2fleksibel("id_pegawai","id_pegawai",$cmd_pegawai,"barcode_pegawai","nama_pegawai",$id_pegawai,"Pilih Pegawai Lebih Dulu");
              ?>
          </div>
        </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Tanggal Awal</label>
                <?php
                  input_calendar("first_date","first_date",$first_date,"Masukkan Tanggal Transaksi","required");
                ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Tanggal Akhir</label>
              <?php
                input_calendar("last_date","last_date",$last_date,"Masukkan Tanggal Transaksi","required");
              ?>
            </div>
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
           <h3 class="box-title">PENGEMBANGAN PROFESI</h3>
          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
       <table id="example1" width="100%" class="table table-bordered table-striped">
        <thead>
      <tr>
        <td colspan="3" style="vertical-align:middle;text-align:center;">NAMA PELATIHAN</td>
          <td style="vertical-align:middle;text-align:center;">PENYELENGGARA</td>
          <td style="vertical-align:middle;text-align:center;">TGL MULAI</td>
          <td style="vertical-align:middle;text-align:center;">TGL SELESAI</td>
          <td style="vertical-align:middle;text-align:right;">SKP</td>
      </tr>          
        </thead>
        <?php
        $nue=0;
        foreach($ambil_range as $rowambil_rangex){
          $nue = $nue + $rowambil_rangex['jml_kredit'];
        ?>
      <tr>
        <td colspan="5" style="vertical-align:middle;text-align:left;font-weight: bold;"><?php echo $rowambil_rangex['nama_kategori_pelatihan']; ?></td>
          <td style="vertical-align:middle;text-align:right;font-weight: bold;"> Jumlah SKP</td>
          <td style="vertical-align:middle;text-align:right;font-weight: bold;"><?= number_format($rowambil_rangex['jml_kredit'],1) ?></td>
      </tr>
        <?php
        $noe=0;
  $berkase = $this->m_admin_user->ambil_berkas_kategori_pelatihan($first_date,$last_date,$id_pegawai,$rowambil_rangex['id_kategori_pelatihan']);
          foreach($berkase as $rowberkase){
            $noe++;
        ?>
      <tr>
        <td style="vertical-align:middle;text-align:center;width: 5%;"><?= $noe ?></td>
        <td colspan="2" style="vertical-align:middle;text-align:left;"><?php echo $rowberkase['nama_berkas']; ?></td>
        <td style="vertical-align:middle;text-align:center;"><?php echo $rowberkase['penyelenggara']; ?></td>
        <td style="vertical-align:middle;text-align:center;"><?php echo $this->m_rancak->fullBulan(date('d-m-Y',strtotime($rowberkase['tgl_a_berkas']))); ?></td>
        <td style="vertical-align:middle;text-align:center;"><?php echo $this->m_rancak->fullBulan(date('d-m-Y',strtotime($rowberkase['tgl_b_berkas']))); ?></td>
        <td style="vertical-align:middle;text-align:right;"><?php echo number_format($rowberkase['kredit'],1); ?></td>
      </tr>
        <?php
          }
        ?>
      <tr>
        <td colspan="6" style="vertical-align:middle;text-align:right;font-weight: bold;">Total SKP</td>
        <td style="vertical-align:middle;text-align:right;font-weight: bold;"><?php echo number_format($nue,1); ?></td>
      </tr>
        <?php
        }
        ?>
      </table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="etik")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
#chartdiv {
  width: 100%;
  height: 500px;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $title; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('ketua_team/etik/view/'.$first_date.'/'.$last_date.'/'.$id_pegawai,' id="signupform" '); ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
    </div>
      <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Pegawai</label>
              <?php
                input_pdselect2fleksibel("id_pegawai","id_pegawai",$cmd_pegawai,"barcode_pegawai","nama_pegawai",$id_pegawai,"Pilih Pegawai Lebih Dulu");
              ?>
          </div>
        </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Tanggal Awal</label>
                <?php
                  input_calendar("first_date","first_date",$first_date,"Masukkan Tanggal Transaksi","required");
                ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Tanggal Akhir</label>
              <?php
                input_calendar("last_date","last_date",$last_date,"Masukkan Tanggal Transaksi","required");
              ?>
            </div>
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
           <h3 class="box-title">ETIKA PROFESI</h3>
          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
       <table id="example1" width="100%" class="table table-bordered table-striped">
        <thead>
      <tr>
          <td style="vertical-align:middle;text-align:center;">TANGGAL</td>
          <td style="vertical-align:middle;text-align:center;">JUMLAH SOAL</td>
          <td style="vertical-align:middle;text-align:center;">NILAI</td>
          <td style="vertical-align:middle;text-align:center;">HASIL</td>
          <td style="vertical-align:middle;text-align:center;">PENGUJI</td>
      </tr>          
        </thead>
        <?php
        foreach($ambil_range as $rowambil_rangex){
        ?>
      <tr>
        <td style="vertical-align:middle;text-align:left;">
          <?php echo $this->m_rancak->fullBulan(date('d-m-Y',strtotime($rowambil_rangex['tgl_etik_pegawai']))); ?>
        </td>
        <td style="vertical-align:middle;text-align:center;"><?php echo $rowambil_rangex['jumlah_etik']; ?></td>
        <td style="vertical-align:middle;text-align:center;"><?php echo $rowambil_rangex['total_etik']; ?></td>
        <td style="vertical-align:middle;text-align:center;"><?php echo $rowambil_rangex['hasil_etik']; ?></td>
        <td style="vertical-align:middle;text-align:center;"><?php echo $rowambil_rangex['penguji']; ?></td>
      </tr>
        <?php
        }
        ?>
      </table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="oppe")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
#chartdiv {
  width: 100%;
  height: 500px;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $title; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('ketua_team/oppe/view/'.$first_date.'/'.$last_date.'/'.$id_pegawai,' id="signupform" '); ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
    </div>
      <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Pegawai</label>
              <?php
                input_pdselect2fleksibel("id_pegawai","id_pegawai",$cmd_pegawai,"barcode_pegawai","nama_pegawai",$id_pegawai,"Pilih Pegawai Lebih Dulu");
              ?>
          </div>
        </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Tanggal Awal</label>
                <?php
                  input_calendar("first_date","first_date",$first_date,"Masukkan Tanggal Transaksi","required");
                ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Tanggal Akhir</label>
              <?php
                input_calendar("last_date","last_date",$last_date,"Masukkan Tanggal Transaksi","required");
              ?>
            </div>
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
           <h3 class="box-title">ETIKA PROFESI</h3>
          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
       <table id="example1" width="100%" class="table table-bordered table-striped">
        <thead>
      <tr>
          <td style="vertical-align:middle;text-align:center;">TANGGAL</td>
          <td style="vertical-align:middle;text-align:center;">JUMLAH SOAL</td>
          <td style="vertical-align:middle;text-align:center;">NILAI</td>
          <td style="vertical-align:middle;text-align:center;">HASIL</td>
          <td style="vertical-align:middle;text-align:center;">PENGUJI</td>
      </tr>          
        </thead>
        <?php
        foreach($etika as $rowetik){
        ?>
      <tr>
        <td style="vertical-align:middle;text-align:left;">
          <?php echo $this->m_rancak->fullBulan(date('d-m-Y',strtotime($rowetik['tgl_etik_pegawai']))); ?>
        </td>
        <td style="vertical-align:middle;text-align:center;"><?php echo $rowetik['jumlah_etik']; ?></td>
        <td style="vertical-align:middle;text-align:center;"><?php echo $rowetik['total_etik']; ?></td>
        <td style="vertical-align:middle;text-align:center;"><?php echo $rowetik['hasil_etik']; ?></td>
        <td style="vertical-align:middle;text-align:center;"><?php echo $rowetik['penguji']; ?></td>
      </tr>
        <?php
        }
        ?>
      </table>
        </div>
        <div class="box-footer">

        </div>
      </div>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">PENGEMBANGAN PROFESI</h3>
          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
       <table id="example2" width="100%" class="table table-bordered table-striped">
        <thead>
      <tr>
        <td colspan="3" style="vertical-align:middle;text-align:center;">NAMA PELATIHAN</td>
          <td style="vertical-align:middle;text-align:center;">PENYELENGGARA</td>
          <td style="vertical-align:middle;text-align:center;">TGL MULAI</td>
          <td style="vertical-align:middle;text-align:center;">TGL SELESAI</td>
          <td style="vertical-align:middle;text-align:right;">SKP</td>
      </tr>          
        </thead>
        <?php
        $nue=0;
        foreach($pelatihan as $rowpelatihan){
          $nue = $nue + $rowpelatihan['jml_kredit'];
        ?>
      <tr>
        <td colspan="5" style="vertical-align:middle;text-align:left;font-weight: bold;"><?php echo $rowpelatihan['nama_kategori_pelatihan']; ?></td>
          <td style="vertical-align:middle;text-align:right;font-weight: bold;"> Jumlah SKP</td>
          <td style="vertical-align:middle;text-align:right;font-weight: bold;"><?= number_format($rowpelatihan['jml_kredit'],1) ?></td>
      </tr>
        <?php
        $noe=0;
  $berkase = $this->m_admin_user->ambil_berkas_kategori_pelatihan($first_date,$last_date,$id_pegawai,$rowpelatihan['id_kategori_pelatihan']);
          foreach($berkase as $rowberkase){
            $noe++;
        ?>
      <tr>
        <td style="vertical-align:middle;text-align:center;width: 5%;"><?= $noe ?></td>
        <td colspan="2" style="vertical-align:middle;text-align:left;"><?php echo $rowberkase['nama_berkas']; ?></td>
        <td style="vertical-align:middle;text-align:center;"><?php echo $rowberkase['penyelenggara']; ?></td>
        <td style="vertical-align:middle;text-align:center;"><?php echo $this->m_rancak->fullBulan(date('d-m-Y',strtotime($rowberkase['tgl_a_berkas']))); ?></td>
        <td style="vertical-align:middle;text-align:center;"><?php echo $this->m_rancak->fullBulan(date('d-m-Y',strtotime($rowberkase['tgl_b_berkas']))); ?></td>
        <td style="vertical-align:middle;text-align:right;"><?php echo number_format($rowberkase['kredit'],1); ?></td>
      </tr>
        <?php
          }
        ?>
      <tr>
        <td colspan="6" style="vertical-align:middle;text-align:right;font-weight: bold;">Total SKP</td>
        <td style="vertical-align:middle;text-align:right;font-weight: bold;"><?php echo number_format($nue,1); ?></td>
      </tr>
        <?php
        }
        ?>
      </table>
        </div>
        <div class="box-footer">

        </div>
      </div>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">KINERJA KLINIS</h3>
          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
       <table id="example3" width="100%" class="table table-bordered table-striped">
          <?php
          foreach($logbook as $rowlogbook){
          ?>
        <tr>
          <td style="vertical-align:middle;text-align:left;font-weight:bold;">PERIODE</td>
          <td colspan="2" style="vertical-align:middle;text-align:left;font-weight:bold;"><?php echo $this->m_rancak->getBulan($rowlogbook['bulan']); ?> - <?php echo $rowlogbook['tahun']; ?></td>
          <td colspan="2" style="vertical-align:middle;text-align:center;font-weight:bold;width: 10%;">Jumlah</td>
        </tr>
          <?php
            $ambil_range_logbook_kompetensi = $this->m_admin_user->ambil_range_logbook_kompetensi($rowlogbook['bulan'],$rowlogbook['tahun'],$id_pegawai);
            foreach($ambil_range_logbook_kompetensi as $rowambil_range_logbook_kompetensi){
          ?>
        <tr>
          <td style="vertical-align:middle;text-align:left;width:3%;">&nbsp;</td>
          <td colspan="2" style="vertical-align:middle;text-align:left;">
            [<?php echo $rowambil_range_logbook_kompetensi['kode_unit']; ?>] : <?php echo $rowambil_range_logbook_kompetensi['nama_kompetensi']; ?>
            </td>
            <td colspan="2" style="vertical-align:middle;text-align:right;"><?php echo $rowambil_range_logbook_kompetensi['jumlahk']; ?></td>
        </tr>
          <?php
            $ambil_range_logbook_bulanane_detil = $this->m_admin_user->ambil_range_logbook_bulanane_detil($rowlogbook['bulan'],$rowlogbook['tahun'],$rowambil_range_logbook_kompetensi['id_kompetensi'],$id_pegawai);
              foreach($ambil_range_logbook_bulanane_detil as $rowambil_range_logbook_bulanane_detil){
          ?>
        <tr>
          <td style="vertical-align:middle;text-align:left;width:3%;">&nbsp;</td>
          <td style="vertical-align:middle;text-align:left;width:3%;">&nbsp;</td>
          <td style="vertical-align:middle;text-align:left;">
            <?php echo $rowambil_range_logbook_bulanane_detil['nama_kewenangan']; ?>
            </td>
            <td style="vertical-align:middle;text-align:right;width: 5%;"><?php echo $rowambil_range_logbook_bulanane_detil['jumlah']; ?></td>
            <td style="vertical-align:middle;text-align:right;">&nbsp;</td>
        </tr>
          <?php
              }
            }
          }
          ?>
      </table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="kinerja_unit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
#chartdiv {
  width: 100%;
  height: 500px;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $title; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('ketua_team/kinerja_unit/view/'.$first_date.'/'.$last_date,' id="signupform" '); ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
    </div>
      <div class="box-body">
      <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Tanggal Awal</label>
                <?php
                  input_calendar("first_date","first_date",$first_date,"Masukkan Tanggal Transaksi","required");
                ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Tanggal Akhir</label>
              <?php
                input_calendar("last_date","last_date",$last_date,"Masukkan Tanggal Transaksi","required");
              ?>
            </div>
          </div>
      </div>
      </div>
      <div class="box-footer">
        <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
      </div>
    </div>
  <?php echo form_close(); ?>
<?php
  foreach($ambil_range as $rowambil_range){
?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?= $rowambil_range['nama_unit'] ?></h3>
          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
               <h3 class="box-title">TOTAL KINERJA KLINIS</h3>
              <div class="box-tools pull-right">

              </div>
            </div>
            <div class="box-body">
           <table id="example1" width="100%" class="table table-bordered table-striped">
              <?php
              $nou=0;
                $ambil_range_logbook_kompetensix = $this->m_admin_user->ambil_range_logbook_kompetensi_unit($first_date,$last_date,$rowambil_range['id_unit']);
                foreach($ambil_range_logbook_kompetensix as $rowambil_rangex_logbook_kompetensi){
                  $nou = $nou + $rowambil_rangex_logbook_kompetensi['jumlahk'];
              ?>
            <tr>
              <td colspan="2" style="vertical-align:middle;text-align:left;">
                [<?php echo $rowambil_rangex_logbook_kompetensi['kode_unit']; ?>] : <?php echo $rowambil_rangex_logbook_kompetensi['nama_kompetensi']; ?>
                </td>
                <td colspan="2" style="vertical-align:middle;text-align:right;"><?php echo $rowambil_rangex_logbook_kompetensi['jumlahk']; ?></td>
            </tr>
              <?php
                $ambil_range_logbook_bulanane_detilx = $this->m_admin_user->ambil_range_logbook_bulanane_detil_unit($first_date,$last_date,$rowambil_rangex_logbook_kompetensi['id_kompetensi'],$rowambil_range['id_unit']);
                  foreach($ambil_range_logbook_bulanane_detilx as $rowambil_range_logbook_bulanane_detilx){
              ?>
            <tr>
              <td style="vertical-align:middle;text-align:left;width:3%;">&nbsp;</td>
              <td style="vertical-align:middle;text-align:left;">
                <?php echo $rowambil_range_logbook_bulanane_detilx['nama_kewenangan']; ?>
                </td>
                <td style="vertical-align:middle;text-align:right;width: 5%;"><?php echo $rowambil_range_logbook_bulanane_detilx['jumlah']; ?></td>
                <td style="vertical-align:middle;text-align:right;">&nbsp;</td>
            </tr>
              <?php
                  }
              ?>
            <tr>
              <td colspan="2" style="vertical-align:middle;text-align:left;font-weight: bold;">
                TOTAL KINERJA KLINIS
                </td>
                <td colspan="2" style="vertical-align:middle;text-align:right;font-weight: bold;"><?php echo $nou; ?></td>
            </tr>
              <?php 
                }
              ?>
          </table>
            </div>
          </div>
        </div>
      </div>
<?php 
  }
?>
    </section>
</div>
<?php
}