<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-arrow-up"></i></button>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
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
</style>
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
        <div class="box-footer">

        </div>
      </div>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">PERHATIAN</h3>
          <div class="box-tools pull-right"></div>
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
elseif ($page=="wilayah_instansi")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $title; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('ol_grafik/wilayah_instansi/view/'.$id_kab,' id="signupform" '); ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
    </div>
      <div class="box-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Provinsi</label>
              <?php
                input_pdselect2fleksibel("id_prov","id_prov",$ambil_prov,"id_prov","nama_prov",$id_prov,"Silahkan Pilih Provinsi Dahulu");
              ?>
          </div>
        </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Kota/Kabupaten</label>
                <?php
                  input_pdselect2("id_kab",$kab,$id_kab);
                //  echo form_dropdown('id_kab',$kab,'0',array('id'=>'id_kab','class'=>'form-control'));
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
           <h3 class="box-title"><?php echo $title; ?></h3>
          <div class="box-tools pull-right"></div>
        </div>
        <div class="box-body">
<?php  
  foreach ($share_data_prov_from_pengurus as $rowambil_prov_dari_pegawai){
?>
    <div class="box box-primary box-solid">
      <div class="box-header with-border">
         <h3 class="box-title"><span class="rainbow-text"><?php echo $rowambil_prov_dari_pegawai['nama_kab']; ?></span></h3>
        <div class="box-tools pull-right"></div>
      </div>
      <div class="box-body">
<?php  
  $grafik_pengcab_area=$this->m_ol_grafik->grafik_working_region('id_kab',$rowambil_prov_dari_pegawai['id_kab']);
  foreach ($grafik_pengcab_area as $rowgrafik_pengcab_area){  
?>
  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
       <h3 class="box-title"><?= $rowgrafik_pengcab_area['nama_working'] ?></h3>
      <div class="box-tools pull-right"></div>
    </div>
    <div class="box-body">
      <div class="row">
        <!-- AWALI -->
        <div class="col-md-12"><h5 class="box-title" style="font-weight:bold;">DAFTAR PEGAWAI</h5>          
  <?php  
  $nografik_pegawai_kab = 0;
  $ambil_bekerja_for_person=$this->m_ol_grafik->ambil_tempat_bekerja_for_person('pi.id_instansi',$rowgrafik_pengcab_area['id_working']);
    foreach ($ambil_bekerja_for_person as $rowambil_bekerja_for_person){
      $nografik_pegawai_kab++;
  ?>
  <div class="col-md-4">
    <div class="box-body table-responsive no-padding">
      <table class="table table-hover">
        <tr>
          <th style="width: 5%;"><?= $nografik_pegawai_kab ?></th>
          <th colspan='6' style="background-color: maroon;color: white;font-weight:bold;"><?= $rowambil_bekerja_for_person['nama_pegawai'] ?></th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="background-color: #e0e0e0;font-weight:bold;">DATA UMUM</th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="font-weight:bold;">Gender : 
            <?php 
              if($rowambil_bekerja_for_person['jk'] == 0){ echo 'Perempuan';}else{ echo 'laki-laki'; }
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="font-weight:bold;">TTL : 
            <?php 
              echo $rowambil_bekerja_for_person['tmp_lahir'].", ". date('d-m-Y', strtotime($rowambil_bekerja_for_person['tgl_lahir']));
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="font-weight:bold;">Age : 
            <?php 
              echo $this->m_rancak->dob($rowambil_bekerja_for_person['tgl_lahir']);
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="font-weight:bold;">Agama : 
            <?php 
              $rel = $this->m_umum->ambil_data('kol_agama','id_agama',$rowambil_bekerja_for_person['id_agama']);
              echo $rel['nama_agama'];
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="font-weight:bold;">Marital : 
            <?php 
              $mar = $this->m_umum->ambil_data('kol_status_kawin','id_status_kawin',$rowambil_bekerja_for_person['id_status_kawin']);
              echo $mar['nama_status_kawin'];
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="font-weight:bold;">Status Pegawai : 
            <?php 
              $mar = $this->m_umum->ambil_data('kol_status_pegawai','id_status_pegawai',$rowambil_bekerja_for_person['id_status_pegawai']);
              echo $mar['nama_status_pegawai'];
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="font-weight:bold;">Jabatan : 
            <?php 
              $mar = $this->m_umum->ambil_data('jabatan_fungsional','id_jabatan_fungsional',$rowambil_bekerja_for_person['id_jabatan_fungsional']);
              echo $mar['nama_jabatan_fungsional'];
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="font-weight:bold;">Pendidikan Terakhir : 
            <?php 
              $mar = $this->m_umum->ambil_data('kol_pendidikan','id_pendidikan',$rowambil_bekerja_for_person['id_pendidikan']);
              if($rowambil_bekerja_for_person['status_perawat'] == 0){ echo 'Non Keperawatan'; }else{ echo $mar['nama_pendidikan']; }          
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="font-weight:bold;">PK : 
            <?php 
              $mar = $this->m_umum->ambil_data('kol_kode_kewenangan','id_kode_kewenangan',$rowambil_bekerja_for_person['id_kode_kewenangan']);
              echo $mar['nama_kode_kewenangan'];
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="background-color: #e0e0e0;font-weight:bold;">SURAT IJIN</th>
        </tr>
        <tr>
<?php  
$dateb = date("Y-m-d", strtotime("+3 month"));
$expired_str_kab=$this->m_ol_rancak->ambil_berkas_from_kab($rowambil_bekerja_for_person['id_kab'],'1',$rowambil_bekerja_for_person['id_pegawai']);
foreach ($expired_str_kab as $rowexpired_str_kab){
?>
          <th>&nbsp;</th>
          <th>STR</th>
          <th>
          <?php 
            if($rowexpired_str_kab['tgl_b_berkas'] <= date('Y-m-d')){
          ?>
                 <button class="btn btn-danger btn-xs">
                    <?= date('d-m-Y', strtotime($rowexpired_str_kab['tgl_b_berkas'])) ?>
                  </button>    
          <?php 
            }elseif(($rowexpired_str_kab['tgl_b_berkas'] >= date('Y-m-d')) && ($rowexpired_str_kab['tgl_b_berkas'] <= $dateb)){
          ?>
                 <button class="btn btn-warning btn-xs">
                    <?= date('d-m-Y', strtotime($rowexpired_str_kab['tgl_b_berkas'])) ?>
                  </button> 
          <?php 
            }else{
           ?>
                 <button class="btn btn-success btn-xs">
                    <?= date('d-m-Y', strtotime($rowexpired_str_kab['tgl_b_berkas'])) ?>
                  </button>            
          <?php             
            }
          ?>
          </th>
<?php  
} 
$expired_sip_kab=$this->m_ol_rancak->ambil_berkas_from_kab($rowambil_bekerja_for_person['id_kab'],'2',$rowambil_bekerja_for_person['id_pegawai']);
foreach ($expired_sip_kab as $rowexpired_sip_kab){
?>
          <th>SIP</th>
          <th>
          <?php 
            if($rowexpired_sip_kab['tgl_b_berkas'] <= date('Y-m-d')){
          ?>
                 <button class="btn btn-danger btn-xs">
                    <?= date('d-m-Y', strtotime($rowexpired_sip_kab['tgl_b_berkas'])) ?>
                  </button>    
          <?php 
            }elseif(($rowexpired_sip_kab['tgl_b_berkas'] >= date('Y-m-d')) && ($rowexpired_sip_kab['tgl_b_berkas'] <= $dateb)){
          ?>
                 <button class="btn btn-warning btn-xs">
                    <?= date('d-m-Y', strtotime($rowexpired_sip_kab['tgl_b_berkas'])) ?>
                  </button> 
          <?php 
            }else{
           ?>
                 <button class="btn btn-success btn-xs">
                    <?= date('d-m-Y', strtotime($rowexpired_sip_kab['tgl_b_berkas'])) ?>
                  </button>            
          <?php             
            }
          ?>
          </th>
<?php  
}
$expired_sik_kab=$this->m_ol_rancak->ambil_berkas_from_kab($rowambil_bekerja_for_person['id_kab'],'3',$rowambil_bekerja_for_person['id_pegawai']);
foreach ($expired_sik_kab as $rowexpired_sik_kab){
?>
          <th>SIK</th>
          <th>
          <?php 
            if($rowexpired_sik_kab['tgl_b_berkas'] <= date('Y-m-d')){
          ?>
                 <button class="btn btn-danger btn-xs">
                    <?= date('d-m-Y', strtotime($rowexpired_sik_kab['tgl_b_berkas'])) ?>
                  </button>    
          <?php 
            }elseif(($rowexpired_sik_kab['tgl_b_berkas'] >= date('Y-m-d')) && ($rowexpired_sik_kab['tgl_b_berkas'] <= $dateb)){
          ?>
                 <button class="btn btn-warning btn-xs">
                    <?= date('d-m-Y', strtotime($rowexpired_sik_kab['tgl_b_berkas'])) ?>
                  </button> 
          <?php 
            }else{
           ?>
                 <button class="btn btn-success btn-xs">
                    <?= date('d-m-Y', strtotime($rowexpired_sik_kab['tgl_b_berkas'])) ?>
                  </button>            
          <?php             
            }
          ?>
          </th>
<?php  
}
?>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="background-color: #e0e0e0;font-weight:bold;">TEMPAT BEKERJA</th>
        </tr>
        
<?php
$ambil_person=$this->m_ol_grafik->ambil_tempat_bekerja_for_person('peg.id_pegawai',$rowambil_bekerja_for_person['id_pegawai']);
foreach ($ambil_person as $rowambil_person){
  $array = array('u.id_instansi'=>$rowambil_person['id_working'],'opu.id_pegawai'=>$rowambil_person['id_pegawai']);
  $ambil_unit_for_person=$this->m_ol_grafik->ambil_unit_for_person($array);
?>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='5'><?= $rowambil_person['nama_working'] ?></th>
          <th colspan='1' style="text-align:right;">
            <?php 
              if($rowambil_person['status_pegawai_instansi'] == 1){
                 echo '<button class="btn btn-success btn-xs">MASIH BEKERJA</button>';
              }else{
                echo '<button class="btn btn-danger btn-xs">RESIGN</button>';
              }
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='5' style="background-color: #e0e0e0;font-weight:bold;">RUANGAN / UNIT</th>
        </tr>
<?php  
  foreach ($ambil_unit_for_person as $rowambil_unit_for_person){
?>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='5'><?= $rowambil_unit_for_person['nama_unit'] ?></th>
        </tr>
<?php 
  }
}
?>
        
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="background-color: #e0e0e0;font-weight:bold;">PELATIHAN KHUSUS</th>
        </tr>
        
<?php
$ambil_pelatihan_person=$this->m_ol_grafik->ambil_berkas_pelatihan_person('peg.id_pegawai',$rowambil_bekerja_for_person['id_pegawai']);
foreach ($ambil_pelatihan_person as $rowambil_pelatihan_person){
?>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6'><?= $rowambil_pelatihan_person['nama_berkas'] ?> [ <?= $rowambil_pelatihan_person['nama_kategori_pelatihan'] ?> ]</th>
        </tr>
<?php  
}
?>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="background-color: #e0e0e0;font-weight:bold;">PEMINATAN</th>
        </tr>
 <?php
$ambil_peminatan_person=$this->m_ol_grafik->ambil_peminatan_person('opm.id_pegawai',$rowambil_bekerja_for_person['id_pegawai']);
foreach ($ambil_peminatan_person as $rowambil_peminatan_person){
?>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6'><?= $rowambil_peminatan_person['nama_peminatan'] ?></th>
        </tr>
<?php  
}
?>       
      </table>
    </div>
  </div>
<?php 
  }
?>
        
        </div>
        <!-- AKHIRI -->
      </div>
    </div>
  </div>
<?php  
}
?>
      </div>
    </div>
<?php 
  }
?>
        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="wilayah_pengcab")
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
  <?php echo form_open_multipart('ol_grafik/wilayah_pengcab/view/'.$id_kab,' id="signupform" '); ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
    </div>
      <div class="box-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Provinsi</label>
              <?php
                input_pdselect2fleksibel("id_prov","id_prov",$ambil_prov,"id_prov","nama_prov",$id_prov,"Silahkan Pilih Provinsi Dahulu");
              ?>
          </div>
        </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Kota/Kabupaten</label>
                <?php
                  input_pdselect2("id_kab",$kab,$id_kab);
                //  echo form_dropdown('id_kab',$kab,'0',array('id'=>'id_kab','class'=>'form-control'));
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
           <h3 class="box-title"><?php echo $title; ?></h3>
          <div class="box-tools pull-right"></div>
        </div>
        <div class="box-body">
<?php  
  foreach ($share_data_prov_from_pengurus as $rowambil_prov_dari_pegawai){
?>
  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
       <h3 class="box-title"><?php echo $rowambil_prov_dari_pegawai['nama_prov']; ?></h3>
      <div class="box-tools pull-right"></div>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-md-12">
<?php  
  $grafik_pengcab_region=$this->m_ol_grafik->grafik_pengcab_kab_region($rowambil_prov_dari_pegawai['id_kab']);
  foreach ($grafik_pengcab_region as $rowgrafik_pengcab_region){
?>
    <div class="box box-primary box-solid">
      <div class="box-header with-border">
         <h3 class="box-title"><span class="rainbow-text"><?php echo $rowgrafik_pengcab_region['nama_kab']; ?></span></h3>
        <div class="box-tools pull-right"></div>
      </div>
      <div class="box-body">
<?php  
  $grafik_pengcab_area=$this->m_ol_grafik->grafik_pengcab_region($rowgrafik_pengcab_region['id_kab']);
  foreach ($grafik_pengcab_area as $rowgrafik_pengcab_area){  
?>
  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
       <h3 class="box-title"><?= $rowgrafik_pengcab_area['nama_pengcab'] ?></h3>
      <div class="box-tools pull-right"></div>
    </div>
    <div class="box-body">
      <div class="row">
      <div class="col-md-12">
        <?php   
        $nografik_pegawai_kab = 0;
          $pengcab_area_4pegawai=$this->m_ol_grafik->grafik_pegawai_area('id_pengcab',$rowgrafik_pengcab_area['id_pengcab']);
         foreach ($pengcab_area_4pegawai as $rowgrafik_pegawai_kab){
          $nografik_pegawai_kab++;
        ?>
    <div class="col-md-4">
    <div class="box-body table-responsive no-padding">
      <table class="table table-hover">
        <tr>
          <th style="background-color: maroon;color: white;font-weight:bold;width:5%;"><?= $nografik_pegawai_kab ?></th>
          <th colspan='6' style="background-color: maroon;color: white;font-weight:bold;"><?= $rowgrafik_pegawai_kab['nama_pegawai'] ?></th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="background-color: #e0e0e0;font-weight:bold;">DATA UMUM</th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="font-weight:bold;">Gender : 
            <?php 
              if($rowgrafik_pegawai_kab['jk'] == 0){ echo 'Perempuan';}else{ echo 'laki-laki'; }
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="font-weight:bold;">TTL : 
            <?php 
              echo $rowgrafik_pegawai_kab['tmp_lahir'].", ". date('d-m-Y', strtotime($rowgrafik_pegawai_kab['tgl_lahir']));
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="font-weight:bold;">Age : 
            <?php 
              echo $this->m_rancak->dob($rowgrafik_pegawai_kab['tgl_lahir']);
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="font-weight:bold;">Agama : 
            <?php 
              $rel = $this->m_umum->ambil_data('kol_agama','id_agama',$rowgrafik_pegawai_kab['id_agama']);
              echo $rel['nama_agama'];
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="font-weight:bold;">Marital : 
            <?php 
              $mar = $this->m_umum->ambil_data('kol_status_kawin','id_status_kawin',$rowgrafik_pegawai_kab['id_status_kawin']);
              echo $mar['nama_status_kawin'];
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="font-weight:bold;">Status Pegawai : 
            <?php 
              $mar = $this->m_umum->ambil_data('kol_status_pegawai','id_status_pegawai',$rowgrafik_pegawai_kab['id_status_pegawai']);
              echo $mar['nama_status_pegawai'];
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="font-weight:bold;">Jabatan : 
            <?php 
              $mar = $this->m_umum->ambil_data('jabatan_fungsional','id_jabatan_fungsional',$rowgrafik_pegawai_kab['id_jabatan_fungsional']);
              echo $mar['nama_jabatan_fungsional'];
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="font-weight:bold;">Pendidikan Terakhir : 
            <?php 
              $mar = $this->m_umum->ambil_data('kol_pendidikan','id_pendidikan',$rowgrafik_pegawai_kab['id_pendidikan']);
              if($rowgrafik_pegawai_kab['status_perawat'] == 0){ echo 'Non Keperawatan'; }else{ echo $mar['nama_pendidikan']; }          
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="font-weight:bold;">PK : 
            <?php 
              $mar = $this->m_umum->ambil_data('kol_kode_kewenangan','id_kode_kewenangan',$rowgrafik_pegawai_kab['id_kode_kewenangan']);
              echo $mar['nama_kode_kewenangan'];
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="background-color: #e0e0e0;font-weight:bold;">SURAT IJIN</th>
        </tr>
        <tr>
<?php  
$dateb = date("Y-m-d", strtotime("+3 month"));
$expired_str_kab=$this->m_ol_rancak->ambil_berkas_from_kab($rowgrafik_pegawai_kab['id_kab'],'1',$rowgrafik_pegawai_kab['id_pegawai']);
foreach ($expired_str_kab as $rowexpired_str_kab){
?>
          <th>&nbsp;</th>
          <th>STR</th>
          <th>
          <?php 
            if($rowexpired_str_kab['tgl_b_berkas'] <= date('Y-m-d')){
          ?>
                 <button class="btn btn-danger btn-xs">
                    <?= date('d-m-Y', strtotime($rowexpired_str_kab['tgl_b_berkas'])) ?>
                  </button>    
          <?php 
            }elseif(($rowexpired_str_kab['tgl_b_berkas'] >= date('Y-m-d')) && ($rowexpired_str_kab['tgl_b_berkas'] <= $dateb)){
          ?>
                 <button class="btn btn-warning btn-xs">
                    <?= date('d-m-Y', strtotime($rowexpired_str_kab['tgl_b_berkas'])) ?>
                  </button> 
          <?php 
            }else{
           ?>
                 <button class="btn btn-success btn-xs">
                    <?= date('d-m-Y', strtotime($rowexpired_str_kab['tgl_b_berkas'])) ?>
                  </button>            
          <?php             
            }
          ?>
          </th>
<?php  
} 
$expired_sip_kab=$this->m_ol_rancak->ambil_berkas_from_kab($rowgrafik_pegawai_kab['id_kab'],'2',$rowgrafik_pegawai_kab['id_pegawai']);
foreach ($expired_sip_kab as $rowexpired_sip_kab){
?>
          <th>SIP</th>
          <th>
          <?php 
            if($rowexpired_sip_kab['tgl_b_berkas'] <= date('Y-m-d')){
          ?>
                 <button class="btn btn-danger btn-xs">
                    <?= date('d-m-Y', strtotime($rowexpired_sip_kab['tgl_b_berkas'])) ?>
                  </button>    
          <?php 
            }elseif(($rowexpired_sip_kab['tgl_b_berkas'] >= date('Y-m-d')) && ($rowexpired_sip_kab['tgl_b_berkas'] <= $dateb)){
          ?>
                 <button class="btn btn-warning btn-xs">
                    <?= date('d-m-Y', strtotime($rowexpired_sip_kab['tgl_b_berkas'])) ?>
                  </button> 
          <?php 
            }else{
           ?>
                 <button class="btn btn-success btn-xs">
                    <?= date('d-m-Y', strtotime($rowexpired_sip_kab['tgl_b_berkas'])) ?>
                  </button>            
          <?php             
            }
          ?>
          </th>
<?php  
}
$expired_sik_kab=$this->m_ol_rancak->ambil_berkas_from_kab($rowgrafik_pegawai_kab['id_kab'],'3',$rowgrafik_pegawai_kab['id_pegawai']);
foreach ($expired_sik_kab as $rowexpired_sik_kab){
?>
          <th>SIK</th>
          <th>
          <?php 
            if($rowexpired_sik_kab['tgl_b_berkas'] <= date('Y-m-d')){
          ?>
                 <button class="btn btn-danger btn-xs">
                    <?= date('d-m-Y', strtotime($rowexpired_sik_kab['tgl_b_berkas'])) ?>
                  </button>    
          <?php 
            }elseif(($rowexpired_sik_kab['tgl_b_berkas'] >= date('Y-m-d')) && ($rowexpired_sik_kab['tgl_b_berkas'] <= $dateb)){
          ?>
                 <button class="btn btn-warning btn-xs">
                    <?= date('d-m-Y', strtotime($rowexpired_sik_kab['tgl_b_berkas'])) ?>
                  </button> 
          <?php 
            }else{
           ?>
                 <button class="btn btn-success btn-xs">
                    <?= date('d-m-Y', strtotime($rowexpired_sik_kab['tgl_b_berkas'])) ?>
                  </button>            
          <?php             
            }
          ?>
          </th>
<?php  
}
?>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="background-color: #e0e0e0;font-weight:bold;">TEMPAT BEKERJA</th>
        </tr>
        
<?php
$ambil_person=$this->m_ol_grafik->ambil_tempat_bekerja_for_person('peg.id_pegawai',$rowgrafik_pegawai_kab['id_pegawai']);
foreach ($ambil_person as $rowambil_person){
  $array = array('u.id_instansi'=>$rowambil_person['id_working'],'opu.id_pegawai'=>$rowambil_person['id_pegawai']);
  $ambil_unit_for_person=$this->m_ol_grafik->ambil_unit_for_person($array);
?>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='5'><?= $rowambil_person['nama_working'] ?></th>
          <th colspan='1' style="text-align:right;">
            <?php 
              if($rowambil_person['status_pegawai_instansi'] == 1){
                 echo '<button class="btn btn-success btn-xs">MASIH BEKERJA</button>';
              }else{
                echo '<button class="btn btn-danger btn-xs">RESIGN</button>';
              }
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='5' style="background-color: #e0e0e0;font-weight:bold;">RUANGAN / UNIT</th>
        </tr>
<?php  
  foreach ($ambil_unit_for_person as $rowambil_unit_for_person){
?>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='5'><?= $rowambil_unit_for_person['nama_unit'] ?></th>
        </tr>
<?php 
  }
}
?>
        
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="background-color: #e0e0e0;font-weight:bold;">PELATIHAN KHUSUS</th>
        </tr>
        
<?php
$ambil_pelatihan_person=$this->m_ol_grafik->ambil_berkas_pelatihan_person('peg.id_pegawai',$rowgrafik_pegawai_kab['id_pegawai']);
foreach ($ambil_pelatihan_person as $rowambil_pelatihan_person){
?>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6'><?= $rowambil_pelatihan_person['nama_berkas'] ?> [ <?= $rowambil_pelatihan_person['nama_kategori_pelatihan'] ?> ]</th>
        </tr>
<?php  
}
?>
         <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="background-color: #e0e0e0;font-weight:bold;">PEMINATAN</th>
        </tr>       
 <?php
$ambil_peminatan_person=$this->m_ol_grafik->ambil_peminatan_person('opm.id_pegawai',$rowgrafik_pegawai_kab['id_pegawai']);
foreach ($ambil_peminatan_person as $rowambil_peminatan_person){
?>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6'><?= $rowambil_peminatan_person['nama_peminatan'] ?></th>
        </tr>
<?php  
}
?> 
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
<?php  
}
?>
      </div>
    </div>
<?php  
  }
?>
        </div>
      </div>
    </div>
  </div>
<?php  
  }
?>
        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="pengcab")
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
        <?php echo $title; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('ol_grafik/pengcab/view/'.$id_pengcab,' id="signupform" '); ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
    </div>
      <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Provinsi</label>
              <?php
                input_pdselect2fleksibel("id_pengcab","id_pengcab",$ambil_pengcab,"id_pengcab","nama_pengcab",$id_pengcab,"Silahkan Pilih Dahulu");
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
           <h3 class="box-title"><?= $ambil_1_pengcab['nama_pengcab'] ?></h3>
          <div class="box-tools pull-right"></div>
        </div>
        <div class="box-body">
<?php
if(!empty($id_pengcab)){
?>
          <div class="row">
            <div class="col-md-4">
<?php 
// ============================================ UTAMA
$laki = 0;$pr = 0;
$kondisi_1=array('status_pegawai'=>1,'visible'=>1,'op.id_jabatan'=>$this->session->id_jabatan,'ope.id_pengcab'=>$ambil_1_pengcab['id_pengcab']);
$select_gender = "SUM(CASE WHEN jk = '1' THEN 1 END) as mlc,SUM(CASE WHEN jk = '0' THEN 1 END) as flc";
$gender=$this->m_ol_grafik->grafik_all_pengcab_pegawai('ope.id_pengcab',$ambil_1_pengcab['id_pengcab'],$select_gender,$kondisi_1);
$select_agama = "COUNT(ope.id_agama) as total_agama,nama_agama,ope.id_agama";
$agama=$this->m_ol_grafik->grafik_pengcab_pegawai($select_agama,$kondisi_1,'ope.id_agama');
$select_status_kawin = "COUNT(ope.id_status_kawin) as total_status_kawin,nama_status_kawin";
$status_kawin=$this->m_ol_grafik->grafik_pengcab_pegawai($select_status_kawin,$kondisi_1,'ope.id_status_kawin');
$select_pendidikan = "COUNT(ope.id_pendidikan) as total_pendidikan,nama_pendidikan";
$pendidikan=$this->m_ol_grafik->grafik_pengcab_pegawai($select_pendidikan,$kondisi_1,'ope.id_pendidikan');
$select_status_pegawai = "COUNT(ope.tipe_pegawai) as total_status_pegawai,nama_status_pegawai";
$status_pegawai=$this->m_ol_grafik->grafik_pengcab_pegawai($select_status_pegawai,$kondisi_1,'ope.tipe_pegawai');
$select_kode_kewenangan = "COUNT(ope.id_kode_kewenangan) as total_kode_kewenangan,if(ope.id_kode_kewenangan = 0,'PK 0 / Non Koperawatan',nama_kode_kewenangan) as nama_kode_kewenangan";
$kode_kewenangan=$this->m_ol_grafik->grafik_pengcab_pegawai($select_kode_kewenangan,$kondisi_1,'ope.id_kode_kewenangan');
$select_jabatan_fungsional = "COUNT(ope.id_jabatan_fungsional) as total_jabatan_fungsional,nama_jabatan_fungsional";
$jf=$this->m_ol_grafik->grafik_pengcab_pegawai($select_jabatan_fungsional,$kondisi_1,'ope.id_jabatan_fungsional');
$pelatihan=$this->m_ol_grafik->ambil_berkas_pelatihan('id_pengcab',$ambil_1_pengcab['id_pengcab'],'b.id_kategori_pelatihan');
$ambil_tempat_bekerja=$this->m_ol_grafik->ambil_tempat_bekerja('peg.id_pengcab',$ambil_1_pengcab['id_pengcab']);
$ambil_peminatan=$this->m_ol_grafik->ambil_peminatan('peg.id_pengcab',$ambil_1_pengcab['id_pengcab'],'opm.id_peminatan');
$ambil_tempat_kat_bekerja=$this->m_ol_grafik->ambil_tempat_kat_bekerja('peg.id_pengcab',$ambil_1_pengcab['id_pengcab']);
$expired_str=$this->m_ol_rancak->ambil_berkas_expired_ijin_pengcab('ol_pegawai.id_pengcab',$ambil_1_pengcab['id_pengcab'],'1');
$expired_sip=$this->m_ol_rancak->ambil_berkas_expired_ijin_pengcab('ol_pegawai.id_pengcab',$ambil_1_pengcab['id_pengcab'],'2');
$expired_sik=$this->m_ol_rancak->ambil_berkas_expired_ijin_pengcab('ol_pegawai.id_pengcab',$ambil_1_pengcab['id_pengcab'],'3');
$kondisi_pegawai_resign=array('status_pegawai_instansi'=>0);
$jml_pegawai_resign = $this->m_umum->jumlah_record_filter('ol_pegawai_instansi',$kondisi_pegawai_resign);
$kondisi_pegawai_bekerja=array('status_pegawai_instansi'=>1);
$jml_pegawai_bekerja = $this->m_umum->jumlah_record_filter('ol_pegawai_instansi',$kondisi_pegawai_bekerja);
$jumlah_pegawai_nganggur = $this->m_ol_grafik->jumlah_pegawai_nganggur('ol_pegawai.id_pengcab = '.$ambil_1_pengcab['id_pengcab'],'ol_pegawai.id_pengcab',$ambil_1_pengcab['id_pengcab']);
$select_prov = "COUNT(ope.id_prov) as total_prov,nama_prov,ope.id_prov";
$prov=$this->m_ol_grafik->grafik_pengcab_pegawai($select_prov,$kondisi_1,'ope.id_prov');
?>
<div class="box-body table-responsive no-padding">
  <table width="100%" class="table table-hover">
    <tbody>
    <tr>
      <td style="background-color:#063970;color:white;vertical-align:middle;">
      Gender || PDF &nbsp;
<a href="<?php echo base_url('ol_grafik/pengcab/pdf_gender/'); ?><?= $ambil_1_pengcab['id_pengcab'] ?>" target="_blank"><i class="fa fa-file-pdf-o text-white"></i>
          </a>
    </td>
      <td style="background-color:#063970;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
    <tr>
      <td style="vertical-align:middle;">Laki-laki</td>
      <td style="vertical-align:middle;text-align: right;"><?= $gender['mlc'] ?></td>
    </tr>
    <tr>
      <td style="vertical-align:middle;">Perempuan</td>
      <td style="vertical-align:middle;text-align: right;"><?= $gender['flc'] ?></td>
    </tr>
    <tr>
      <td style="background-color:#979915;color:white;vertical-align:middle;">
      Agama || PDF &nbsp;
<a href="<?php echo base_url('ol_grafik/pengcab/pdf_religi/'); ?><?= $ambil_1_pengcab['id_pengcab'] ?>" target="_blank"><i class="fa fa-file-pdf-o text-white"></i>
          </a>
    </td>
      <td style="background-color:#979915;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php
foreach ($agama as $rowagama){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowagama['nama_agama'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowagama['total_agama'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#979915;color:white;vertical-align:middle;">
      Marital || PDF &nbsp;
          <a href="<?php echo base_url('ol_grafik/pengcab/pdf_marital/'); ?><?= $ambil_1_pengcab['id_pengcab'] ?>" target="_blank"><i class="fa fa-file-pdf-o text-white"></i>
          </a> 
    </td>
      <td style="background-color:#979915;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php
foreach ($status_kawin as $rowstatus_kawin){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowstatus_kawin['nama_status_kawin'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowstatus_kawin['total_status_kawin'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#979915;color:white;vertical-align:middle;">
      Status Pegawai || PDF &nbsp;
          <a href="<?php echo base_url('ol_grafik/pengcab/pdf_asn/'); ?><?= $ambil_1_pengcab['id_pengcab'] ?>" target="_blank"><i class="fa fa-file-pdf-o text-white"></i>
          </a> 
    </td>
      <td style="background-color:#979915;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($status_pegawai as $rowstatus_pegawai){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowstatus_pegawai['nama_status_pegawai'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowstatus_pegawai['total_status_pegawai'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#979915;color:white;vertical-align:middle;">
      PK || PDF &nbsp;
          <a href="<?php echo base_url('ol_grafik/pengcab/pdf_kd/'); ?><?= $ambil_1_pengcab['id_pengcab'] ?>" target="_blank"><i class="fa fa-file-pdf-o text-white"></i>
          </a> </td>
      <td style="background-color:#979915;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($kode_kewenangan as $rowkode_kewenangan){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowkode_kewenangan['nama_kode_kewenangan'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowkode_kewenangan['total_kode_kewenangan'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#063970;color:white;vertical-align:middle;">
        Surat Ijin
        &nbsp; <i class="fa fa-file-pdf-o text-white"></i>
        || 
          <a href="<?php echo base_url('ol_grafik/pengcab/pdf_surat_ijin_aktif/'); ?><?= $ambil_1_pengcab['id_pengcab'] ?>" target="_blank"> Aktif
          </a> 
        || 
          <a href="<?php echo base_url('ol_grafik/pengcab/pdf_surat_ijin_tenggang/'); ?><?= $ambil_1_pengcab['id_pengcab'] ?>" target="_blank"> Tenggang
          </a> 
        || 
          <a href="<?php echo base_url('ol_grafik/pengcab/pdf_surat_ijin_expired/'); ?><?= $ambil_1_pengcab['id_pengcab'] ?>" target="_blank"> Expired
          </a> 
      </td>
      <td style="background-color:#063970;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php
foreach ($expired_str as $rowexpired_str){
?>
    <tr>
      <td style="background-color:#FE0101;color:white;vertical-align:middle;">Expired STR</td>
      <td style="background-color:#FE0101;color:white;vertical-align:middle;text-align: right;"><?= $rowexpired_str['total_str'] ?></td>
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
foreach ($expired_sik as $rowexpired_sik){
?>
    <tr>
      <td style="background-color:#FE0101;color:white;vertical-align:middle;">Expired SIK</td>
      <td style="background-color:#FE0101;color:white;vertical-align:middle;text-align: right;"><?= $rowexpired_sik['total_str'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#979915;color:white;vertical-align:middle;">Belum Bekerja</td>
      <td style="background-color:#979915;color:white;vertical-align:middle;text-align: right;"><?= $jumlah_pegawai_nganggur ?></td>
    </tr>
    </tbody>
  </table>              
            </div>
            </div>
            <div class="col-md-4">
<div class="box-body table-responsive no-padding">
  <table width="100%" class="table table-hover">
    <tbody>
    <tr>
      <td style="background-color:#063970;color:white;vertical-align:middle;">
      Pendidikan || PDF &nbsp;
          <a href="<?php echo base_url('ol_grafik/pengcab/pdf_pendidikan/'); ?><?= $ambil_1_pengcab['id_pengcab'] ?>" target="_blank"><i class="fa fa-file-pdf-o text-white"></i>
          </a> 
    </td>
      <td style="background-color:#063970;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($pendidikan as $rowpendidikan){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowpendidikan['nama_pendidikan'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowpendidikan['total_pendidikan'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#979915;color:white;vertical-align:middle;">
      Jabatan Fungsional || PDF &nbsp;
          <a href="<?php echo base_url('ol_grafik/pengcab/pdf_jabfung/'); ?><?= $ambil_1_pengcab['id_pengcab'] ?>" target="_blank"><i class="fa fa-file-pdf-o text-white"></i>
          </a> 
    </td>
      <td style="background-color:#979915;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($jf as $rowjf){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowjf['nama_jabatan_fungsional'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowjf['total_jabatan_fungsional'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#979915;color:white;vertical-align:middle;">
      Pelatihan || PDF &nbsp;
<a href="<?php echo base_url('ol_grafik/pengcab/pdf_pelatihan/'); ?><?= $ambil_1_pengcab['id_pengcab'] ?>" target="_blank"><i class="fa fa-file-pdf-o text-white"></i>
          </a>
    </td>
      <td style="background-color:#979915;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($pelatihan as $rowpelatihan){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowpelatihan['nama_kategori_pelatihan'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowpelatihan['total_pelatihan'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#979915;color:white;vertical-align:middle;">
      Status Instansi || PDF &nbsp;
<a href="<?php echo base_url('ol_grafik/pengcab/pdf_instansi/'); ?><?= $ambil_1_pengcab['id_pengcab'] ?>" target="_blank"><i class="fa fa-file-pdf-o text-white"></i>
          </a>
    </td>
      <td style="background-color:#979915;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($ambil_tempat_kat_bekerja as $rowambil_tempat_kat_bekerja){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowambil_tempat_kat_bekerja['nama_kategori_work'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowambil_tempat_kat_bekerja['total_kategori_work'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#979915;color:white;vertical-align:middle;">
      Tempat Bekerja || PDF &nbsp;
<a href="<?php echo base_url('ol_grafik/pengcab/pdf_instansi/'); ?><?= $ambil_1_pengcab['id_pengcab'] ?>" target="_blank"><i class="fa fa-file-pdf-o text-white"></i>
          </a>
      </td>
      <td style="background-color:#979915;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($ambil_tempat_bekerja as $rowambil_tempat_bekerja){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowambil_tempat_bekerja['nama_working'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowambil_tempat_bekerja['total_instansi'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#979915;color:white;vertical-align:middle;">
        Peminatan || PDF &nbsp;
          <a href="<?php echo base_url('ol_grafik/pengcab/pdf_peminatan/'); ?><?= $ambil_1_pengcab['id_pengcab'] ?>" target="_blank"><i class="fa fa-file-pdf-o text-white"></i>
          </a> 
      </td>
      <td style="background-color:#979915;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($ambil_peminatan as $rowambil_peminatan){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowambil_peminatan['nama_peminatan'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowambil_peminatan['total_peminatan'] ?></td>
    </tr>
<?php 
}
?>
    </tbody>
  </table>              
            </div>
            </div>
            <div class="col-md-4">
<div class="box-body table-responsive no-padding">
  <table width="100%" class="table table-hover">
    <tbody>
    <tr>
      <td style="background-color:#979915;color:white;vertical-align:middle;">
        Alamat || PDF &nbsp;
<a href="<?php echo base_url('ol_grafik/pengcab/pdf_alamat/'); ?><?= $ambil_1_pengcab['id_pengcab'] ?>" target="_blank"><i class="fa fa-file-pdf-o text-white"></i>
          </a>
      </td>
      <td style="background-color:#979915;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($prov as $rowprov){
?>
    <tr>
      <td style="background-color:#063970;color:white;vertical-align:middle;"><?= $rowprov['nama_prov'] ?></td>
      <td style="background-color:#063970;color:white;vertical-align:middle;text-align: right;"><?= $rowprov['total_prov'] ?></td>
    </tr>
<?php 
$kondisi_kab=array('op.id_jabatan'=>$this->session->id_jabatan,'ope.id_pengcab'=>$ambil_1_pengcab['id_pengcab'],'ope.id_prov'=>$rowprov['id_prov']);
$select_kab = "COUNT(ope.id_kab) as total_kab,nama_kab,ope.id_kab";
$kab=$this->m_ol_grafik->grafik_pengcab_pegawai($select_kab,$kondisi_kab,'ope.id_kab');
  foreach ($kab as $rowkab){
$kondisi_kec=array('op.id_jabatan'=>$this->session->id_jabatan,'ope.id_pengcab'=>$ambil_1_pengcab['id_pengcab'],'ope.id_kab'=>$rowkab['id_kab']);
$select_kec = "COUNT(ope.id_kec) as total_kec,nama_kec,ope.id_kec";
$kec=$this->m_ol_grafik->grafik_pengcab_pegawai($select_kec,$kondisi_kec,'ope.id_kec');
?>
    <tr>
      <td style="background-color:#8C0720;color:white;vertical-align:middle;padding-left: 20px;">&nbsp;&nbsp;<?= $rowkab['nama_kab'] ?></td>
      <td style="background-color:#8C0720;color:white;vertical-align:middle;text-align: right;"><?= $rowkab['total_kab'] ?></td>
    </tr>
<?php
    foreach ($kec as $rowkec){
$kondisi_kec=array('op.id_jabatan'=>$this->session->id_jabatan,'ope.id_pengcab'=>$ambil_1_pengcab['id_pengcab'],'ope.id_kec'=>$rowkec['id_kec']);
$select_kel = "COUNT(ope.id_kel) as total_kel,nama_kel,ope.id_kel";
$kel=$this->m_ol_grafik->grafik_pengcab_pegawai($select_kel,$kondisi_kec,'ope.id_kel');
?>
    <tr>
      <td style="background-color:#078C8A;color:white;vertical-align:middle;padding-left: 35px;"><?= $rowkec['nama_kec'] ?></td>
      <td style="background-color:#078C8A;color:white;vertical-align:middle;text-align: right;"><?= $rowkec['total_kec'] ?></td>
    </tr>
<?php
      foreach ($kel as $rowkel){
?>
    <tr>
      <td style="background-color:#238C07;color:white;vertical-align:middle;padding-left: 50px;"><?= $rowkel['nama_kel'] ?></td>
      <td style="background-color:#238C07;color:white;vertical-align:middle;text-align: right;"><?= $rowkel['total_kel'] ?></td>
    </tr>
<?php
      }
    }
  }
}
?>
    </tbody>
  </table>              
            </div>
            </div>
          </div><hr />
<?php
// ============================================== TURUNAN
  foreach ($ambil_res_pengcab as $rowambil_res_pengcab){
?>
  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
       <h3 class="box-title"><?= $rowambil_res_pengcab['nama_pengcab'] ?></h3>
      <div class="box-tools pull-right"></div>
    </div>
    <div class="box-body">
          <div class="row">
            <div class="col-md-4">
<?php 
$kondisi_t=array('status_pegawai'=>1,'visible'=>1,'op.id_jabatan'=>$this->session->id_jabatan,'ope.id_pengcab'=>$rowambil_res_pengcab['id_pengcab']);
$select_gendert  = "SUM(CASE WHEN jk = '1' THEN 1 END) as mlc,SUM(CASE WHEN jk = '0' THEN 1 END) as flc";
$gendert =$this->m_ol_grafik->grafik_all_pengcab_pegawai('ope.id_pengcab',$rowambil_res_pengcab['id_pengcab'],$select_gendert,$kondisi_t);
$select_agamat = "COUNT(ope.id_agama) as total_agama,nama_agama,ope.id_agama";
$agamat=$this->m_ol_grafik->grafik_pengcab_pegawai($select_agamat,$kondisi_t,'ope.id_agama');
$select_status_kawint = "COUNT(ope.id_status_kawin) as total_status_kawin,nama_status_kawin";
$status_kawint=$this->m_ol_grafik->grafik_pengcab_pegawai($select_status_kawint,$kondisi_t,'ope.id_status_kawin');
$select_pendidikant = "COUNT(ope.id_pendidikan) as total_pendidikan,nama_pendidikan";
$pendidikant=$this->m_ol_grafik->grafik_pengcab_pegawai($select_pendidikant,$kondisi_t,'ope.id_pendidikan');
$select_status_pegawait = "COUNT(ope.tipe_pegawai) as total_status_pegawai,nama_status_pegawai";
$status_pegawait=$this->m_ol_grafik->grafik_pengcab_pegawai($select_status_pegawait,$kondisi_t,'ope.tipe_pegawai');
$select_kode_kewenangant = "COUNT(ope.id_kode_kewenangan) as total_kode_kewenangan,if(ope.id_kode_kewenangan = 0,'PK 0 / Non Koperawatan',nama_kode_kewenangan) as nama_kode_kewenangan";
$kode_kewenangant=$this->m_ol_grafik->grafik_pengcab_pegawai($select_kode_kewenangant,$kondisi_t,'ope.id_kode_kewenangan');
$select_jabatan_fungsionalt = "COUNT(ope.id_jabatan_fungsional) as total_jabatan_fungsional,nama_jabatan_fungsional";
$jft=$this->m_ol_grafik->grafik_pengcab_pegawai($select_jabatan_fungsionalt,$kondisi_t,'ope.id_jabatan_fungsional');
$pelatihant=$this->m_ol_grafik->ambil_berkas_pelatihan('peg.id_pengcab',$rowambil_res_pengcab['id_pengcab'],'b.id_kategori_pelatihan');
$ambil_tempat_bekerjat=$this->m_ol_grafik->ambil_tempat_bekerja('peg.id_pengcab',$rowambil_res_pengcab['id_pengcab']);
$ambil_peminatant=$this->m_ol_grafik->ambil_peminatan('peg.id_pengcab',$rowambil_res_pengcab['id_pengcab'],'opm.id_peminatan');
$ambil_tempat_kat_bekerjat=$this->m_ol_grafik->ambil_tempat_kat_bekerja('peg.id_pengcab',$rowambil_res_pengcab['id_pengcab']);
$expired_strt=$this->m_ol_rancak->ambil_berkas_expired_ijin_pengcab('ol_pegawai.id_pengcab',$rowambil_res_pengcab['id_pengcab'],'1');
$expired_sipt=$this->m_ol_rancak->ambil_berkas_expired_ijin_pengcab('ol_pegawai.id_pengcab',$rowambil_res_pengcab['id_pengcab'],'2');
$expired_sikt=$this->m_ol_rancak->ambil_berkas_expired_ijin_pengcab('ol_pegawai.id_pengcab',$rowambil_res_pengcab['id_pengcab'],'3');
$kondisi_pegawai_resignt=array('status_pegawai_instansi'=>0);
$jml_pegawai_resignt = $this->m_umum->jumlah_record_filter('ol_pegawai_instansi',$kondisi_pegawai_resignt);
$kondisi_pegawai_bekerjat=array('status_pegawai_instansi'=>1);
$jml_pegawai_bekerjat = $this->m_umum->jumlah_record_filter('ol_pegawai_instansi',$kondisi_pegawai_bekerjat);
$jumlah_pegawai_nganggurt = $this->m_ol_grafik->jumlah_pegawai_nganggur('ol_pegawai.id_pengcab = '.$rowambil_res_pengcab['id_pengcab'],'ol_pegawai.id_pengcab',$rowambil_res_pengcab['id_pengcab']);
$select_provt = "COUNT(ope.id_prov) as total_prov,nama_prov,ope.id_prov";
$provt=$this->m_ol_grafik->grafik_pengcab_pegawai($select_provt,$kondisi_t,'ope.id_prov');
?>
<div class="box-body table-responsive no-padding">
  <table width="100%" class="table table-hover">
    <tbody>
    <tr>
      <td style="background-color:#9b0e27;color:white;vertical-align:middle;">
      Gender || PDF &nbsp;
          <a href="<?php echo base_url('ol_grafik/pengcab/pdf_gender/'); ?><?= $rowambil_res_pengcab['id_pengcab'] ?>" target="_blank"><i class="fa fa-file-pdf-o text-white"></i>
          </a> 
    </td>
      <td style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
    <tr>
      <td style="vertical-align:middle;">Laki-laki</td>
      <td style="vertical-align:middle;text-align: right;"><?= $gendert['mlc'] ?></td>
    </tr>
    <tr>
      <td style="vertical-align:middle;">Perempuan</td>
      <td style="vertical-align:middle;text-align: right;"><?= $gendert['flc'] ?></td>
    </tr>
    <tr>
      <td style="background-color:#761191;color:white;vertical-align:middle;">
      Agama || PDF &nbsp;
          <a href="<?php echo base_url('ol_grafik/pengcab/pdf_religi/'); ?><?= $rowambil_res_pengcab['id_pengcab'] ?>" target="_blank"><i class="fa fa-file-pdf-o text-white"></i>
          </a> 
    </td>
      <td style="background-color:#761191;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php
foreach ($agamat as $rowagamat){ 
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowagamat['nama_agama'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowagamat['total_agama'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#761191;color:white;vertical-align:middle;">
      Marital || PDF &nbsp;
          <a href="<?php echo base_url('ol_grafik/pengcab/pdf_marital/'); ?><?= $rowambil_res_pengcab['id_pengcab'] ?>" target="_blank"><i class="fa fa-file-pdf-o text-white"></i>
          </a> 
    </td>
      <td style="background-color:#761191;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($status_kawint as $rowstatus_kawint){ 
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowstatus_kawint['nama_status_kawin'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowstatus_kawint['total_status_kawin'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#761191;color:white;vertical-align:middle;">
      Status Pegawai || PDF &nbsp;
          <a href="<?php echo base_url('ol_grafik/pengcab/pdf_asn/'); ?><?= $rowambil_res_pengcab['id_pengcab'] ?>" target="_blank"><i class="fa fa-file-pdf-o text-white"></i>
          </a> 
    </td>
      <td style="background-color:#761191;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($status_pegawait as $rowstatus_pegawait){ 
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowstatus_pegawait['nama_status_pegawai'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowstatus_pegawait['total_status_pegawai'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#761191;color:white;vertical-align:middle;">
      PK || PDF &nbsp;
          <a href="<?php echo base_url('ol_grafik/pengcab/pdf_kd/'); ?><?= $rowambil_res_pengcab['id_pengcab'] ?>" target="_blank"><i class="fa fa-file-pdf-o text-white"></i>
          </a> </td>
      <td style="background-color:#761191;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($kode_kewenangant as $rowkode_kewenangant){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowkode_kewenangant['nama_kode_kewenangan'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowkode_kewenangant['total_kode_kewenangan'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#9b0e27;color:white;vertical-align:middle;">
        Surat Ijin
        &nbsp; <i class="fa fa-file-pdf-o text-white"></i>
        || 
          <a href="<?php echo base_url('ol_grafik/pengcab/pdf_surat_ijin_aktif/'); ?><?= $rowambil_res_pengcab['id_pengcab'] ?>" target="_blank"> Aktif
          </a> 
        || 
          <a href="<?php echo base_url('ol_grafik/pengcab/pdf_surat_ijin_tenggang/'); ?><?= $rowambil_res_pengcab['id_pengcab'] ?>" target="_blank"> Tenggang
          </a> 
        || 
          <a href="<?php echo base_url('ol_grafik/pengcab/pdf_surat_ijin_expired/'); ?><?= $rowambil_res_pengcab['id_pengcab'] ?>" target="_blank"> Expired
          </a>        
      </td>
      <td style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php
foreach ($expired_strt as $rowexpired_strt){
?>
    <tr>
      <td style="background-color:#FE0101;color:white;vertical-align:middle;">Expired STR</td>
      <td style="background-color:#FE0101;color:white;vertical-align:middle;text-align: right;width: 15%;"><?= $rowexpired_strt['total_str'] ?></td>
    </tr>
<?php 
}
foreach ($expired_sipt as $rowexpired_sipt){
?>
    <tr>
      <td style="background-color:#FE0101;color:white;vertical-align:middle;">Expired SIP</td>
      <td style="background-color:#FE0101;color:white;vertical-align:middle;text-align: right;width: 15%;"><?= $rowexpired_sipt['total_str'] ?></td>
    </tr>
<?php 
}
foreach ($expired_sikt as $rowexpired_sikt){
?>
    <tr>
      <td style="background-color:#FE0101;color:white;vertical-align:middle;">Expired SIK</td>
      <td style="background-color:#FE0101;color:white;vertical-align:middle;text-align: right;width: 15%;"><?= $rowexpired_sikt['total_str'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#761191;color:white;vertical-align:middle;">Belum Bekerja</td>
      <td style="background-color:#761191;color:white;vertical-align:middle;text-align: right;width: 15%;"><?= $jumlah_pegawai_nganggurt ?></td>
    </tr>
    </tbody>
  </table>              
            </div>
            </div>
            <div class="col-md-4">
<div class="box-body table-responsive no-padding">
  <table width="100%" class="table table-hover">
    <tbody>
    <tr>
      <td style="background-color:#9b0e27;color:white;vertical-align:middle;">
      Pendidikan || PDF &nbsp;
          <a href="<?php echo base_url('ol_grafik/pengcab/pdf_pendidikan/'); ?><?= $rowambil_res_pengcab['id_pengcab'] ?>" target="_blank"><i class="fa fa-file-pdf-o text-white"></i>
          </a> 
    </td>
      <td style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($pendidikant as $rowpendidikant){ 
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowpendidikant['nama_pendidikan'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowpendidikant['total_pendidikan'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#761191;color:white;vertical-align:middle;">
      Jabatan Fungsional || PDF &nbsp;
          <a href="<?php echo base_url('ol_grafik/pengcab/pdf_jabfung/'); ?><?= $rowambil_res_pengcab['id_pengcab'] ?>" target="_blank"><i class="fa fa-file-pdf-o text-white"></i>
          </a> 
    </td>
      <td style="background-color:#761191;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($jft as $rowjft){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowjft['nama_jabatan_fungsional'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowjft['total_jabatan_fungsional'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#761191;color:white;vertical-align:middle;">
      Pelatihan || PDF &nbsp;
<a href="<?php echo base_url('ol_grafik/pengcab/pdf_pelatihan/'); ?><?= $rowambil_res_pengcab['id_pengcab'] ?>" target="_blank"><i class="fa fa-file-pdf-o text-white"></i>
          </a>
    </td>
      <td style="background-color:#761191;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($pelatihant as $rowpelatihant){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowpelatihant['nama_kategori_pelatihan'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowpelatihant['total_pelatihan'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#761191;color:white;vertical-align:middle;">
      Status Instansi || PDF &nbsp;
<a href="<?php echo base_url('ol_grafik/pengcab/pdf_instansi/'); ?><?= $rowambil_res_pengcab['id_pengcab'] ?>" target="_blank"><i class="fa fa-file-pdf-o text-white"></i>
          </a>
    </td>
      <td style="background-color:#761191;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($ambil_tempat_kat_bekerjat as $rowambil_tempat_kat_bekerjat){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowambil_tempat_kat_bekerjat['nama_kategori_work'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowambil_tempat_kat_bekerjat['total_kategori_work'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#761191;color:white;vertical-align:middle;">
      Tempat Bekerja || PDF &nbsp;
<a href="<?php echo base_url('ol_grafik/pengcab/pdf_instansi/'); ?><?= $rowambil_res_pengcab['id_pengcab'] ?>" target="_blank"><i class="fa fa-file-pdf-o text-white"></i>
          </a>
      </td>
      <td style="background-color:#761191;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($ambil_tempat_bekerjat as $rowambil_tempat_bekerjat){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowambil_tempat_bekerjat['nama_working'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowambil_tempat_bekerjat['total_instansi'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#761191;color:white;vertical-align:middle;">
        Peminatan || PDF &nbsp;
<a href="<?php echo base_url('ol_grafik/pengcab/pdf_peminatan/'); ?><?= $rowambil_res_pengcab['id_pengcab'] ?>" target="_blank"><i class="fa fa-file-pdf-o text-white"></i>
          </a>
      </td>
      <td style="background-color:#761191;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($ambil_peminatant as $rowambil_peminatant){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowambil_peminatant['nama_peminatan'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowambil_peminatant['total_peminatan'] ?></td>
    </tr>
<?php 
}
?>
    </tbody>
  </table>              
            </div>
            </div>
            <div class="col-md-4">
<div class="box-body table-responsive no-padding">
  <table width="100%" class="table table-hover">
    <tbody>
    <tr>
      <td style="background-color:#761191;color:white;vertical-align:middle;">
        Alamat || PDF &nbsp;
<a href="<?php echo base_url('ol_grafik/pengcab/pdf_alamat/'); ?><?= $rowambil_res_pengcab['id_pengcab'] ?>" target="_blank"><i class="fa fa-file-pdf-o text-white"></i>
          </a>
      </td>
      <td style="background-color:#761191;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($provt as $rowprovt){
?>
    <tr>
      <td style="background-color:#9b0e27;color:white;vertical-align:middle;">Provinsi :<?= $rowprovt['nama_prov'] ?></td>
      <td style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: right;"><?= $rowprovt['total_prov'] ?></td>
    </tr>
<?php 
$kondisi_kabt=array('op.id_jabatan'=>$this->session->id_jabatan,'ope.id_pengcab'=>$rowambil_res_pengcab['id_pengcab'],'ope.id_prov'=>$rowprovt['id_prov']);
$select_kabt = "COUNT(ope.id_kab) as total_kab,nama_kab,ope.id_kab";
$kabt=$this->m_ol_grafik->grafik_pengcab_pegawai($select_kabt,$kondisi_kabt,'ope.id_kab');
  foreach ($kabt as $rowkabt){
$kondisi_kect=array('op.id_jabatan'=>$this->session->id_jabatan,'ope.id_pengcab'=>$rowambil_res_pengcab['id_pengcab'],'ope.id_kab'=>$rowkabt['id_kab']);
$select_kect = "COUNT(ope.id_kec) as total_kec,nama_kec,ope.id_kec";
$kect=$this->m_ol_grafik->grafik_pengcab_pegawai($select_kect,$kondisi_kect,'ope.id_kec');
?>
    <tr>
      <td style="background-color:#8C0720;color:white;vertical-align:middle;padding-left: 20px;">Kota / Kab : <?= $rowkabt['nama_kab'] ?></td>
      <td style="background-color:#8C0720;color:white;vertical-align:middle;text-align: right;"><?= $rowkabt['total_kab'] ?></td>
    </tr>
<?php
    foreach ($kect as $rowkect){
$kondisi_kelt=array('op.id_jabatan'=>$this->session->id_jabatan,'ope.id_pengcab'=>$rowambil_res_pengcab['id_pengcab'],'ope.id_kec'=>$rowkect['id_kec']);
$select_kelt = "COUNT(ope.id_kel) as total_kel,nama_kel,ope.id_kel";
$kelt=$this->m_ol_grafik->grafik_pengcab_pegawai($select_kelt,$kondisi_kelt,'ope.id_kel');
?>
    <tr>
      <td style="background-color:#078C8A;color:white;vertical-align:middle;padding-left: 35px;">Kecamatan : <?= $rowkect['nama_kec'] ?></td>
      <td style="background-color:#078C8A;color:white;vertical-align:middle;text-align: right;"><?= $rowkect['total_kec'] ?></td>
    </tr>
<?php
      foreach ($kelt as $rowkelt){
?>
    <tr>
      <td style="background-color:#238C07;color:white;vertical-align:middle;padding-left: 50px;">Kelurahan : <?= $rowkelt['nama_kel'] ?></td>
      <td style="background-color:#238C07;color:white;vertical-align:middle;text-align: right;"><?= $rowkelt['total_kel'] ?></td>
    </tr>
<?php
      }
    }
  }
}
?>
    </tbody>
  </table>              
            </div>
            </div>
          </div>
    </div>
  </div>
<?php  
  }
}
?>
        </div>
  </div>
    </section>
</div>
<?php
}
elseif ($page=="peta_ruangan")
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
        <?php echo $title; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('ol_grafik/peta_ruangan/view/'.$id_working,' id="signupform" '); ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
    </div>
      <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Provinsi</label>
              <?php
                input_pdselect2fleksibel("id_working","id_working",$ambil_rs_dari_pegawai,"id_working","nama_working",$id_working,"Silahkan Pilih Instansi Dahulu");
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
           <h3 class="box-title"><?php echo $title; ?></h3>
          <div class="box-tools pull-right"></div>
        </div>
        <div class="box-body">
<?php  
  $grafik_pengcab_area=$this->m_ol_grafik->grafik_working_region('id_working',$id_working);
  foreach ($grafik_pengcab_area as $rowgrafik_pengcab_area){  
?>
  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
       <h3 class="box-title"><?= $rowgrafik_pengcab_area['nama_working'] ?></h3>
      <div class="box-tools pull-right"></div>
    </div>
    <div class="box-body">
      <div class="row">
        <!-- AWALI -->
        <div class="col-md-12">
  <?php  
  $ambil_unit_induk=$this->m_ol_grafik->ambil_unit_induk($rowgrafik_pengcab_area['id_working']);
    foreach ($ambil_unit_induk as $rowambil_unit_induk){
  ?>
          <div class="col-md-4">     
              <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                  <tr>
                    <th colspan='7' style="background-color: maroon;color: white;font-weight:bold;"><?= $rowambil_unit_induk['nama_unit'] ?></th>
                  </tr>
                  <tr>
                    <th colspan='7' style="background-color: #e0e0e0;font-weight:bold;">GENDER</th>
                  </tr>
<?php  
$select_gender = "SUM(CASE WHEN jk = '1' THEN 1 END) as mlc,SUM(CASE WHEN jk = '0' THEN 1 END) as flc";
$gender=$this->m_ol_grafik->grafik_unit_pegawai('opu.id_unit',$rowambil_unit_induk['id_unit'],$select_gender);
    foreach ($gender as $rowgender){
?>
                  <tr>
                    <th style="background-color: #e0e0e0;text-align: right;width:2%;">&nbsp;</th>
                    <th colspan='5' style="background-color: #e0e0e0;">Laki-laki</th>
                    <th style="width: 15%;background-color: #e0e0e0;text-align: right;"><?= $rowgender['mlc'] ?></th>
                  </tr>      
                  <tr>
                    <th style="background-color: #e0e0e0;text-align: right;">&nbsp;</th>
                    <th colspan='5' style="background-color: #e0e0e0;">Perempuan</th>
                    <th style="background-color: #e0e0e0;text-align: right;"><?= $rowgender['flc'] ?></th>
                  </tr>
<?php 
    }
?>
                  <tr>
                    <th colspan='7' style="background-color: #e0e0e0;font-weight:bold;">STATUS PEGAWAI</th>
                  </tr>
<?php
$select_status_pegawai = "COUNT(ope.tipe_pegawai) as total_status_pegawai,nama_status_pegawai";
$status_pegawai=$this->m_ol_grafik->grafik_unit_pegawai('opu.id_unit',$rowambil_unit_induk['id_unit'],$select_status_pegawai);
        foreach ($status_pegawai as $rowstatus_pegawai){
?>
                <tr>
                  <th style="background-color: #e0e0e0;text-align: right;">&nbsp;</th>
                  <th colspan='5' style="background-color: #e0e0e0;"><?= $rowstatus_pegawai['nama_status_pegawai'] ?></th>
                  <th style="background-color: #e0e0e0;text-align: right;"><?= $rowstatus_pegawai['total_status_pegawai'] ?></th>
                </tr> 
<?php
        }
?>
                  <tr>
                    <th colspan='7' style="background-color: #e0e0e0;font-weight:bold;">RELIGION</th>
                  </tr>
<?php
$select_agama = "COUNT(ope.id_agama) as total_agama,nama_agama";
$agama=$this->m_ol_grafik->grafik_unit_pegawai('opu.id_unit',$rowambil_unit_induk['id_unit'],$select_agama);
        foreach ($agama as $rowagama){
?>
                <tr>
                  <th style="background-color: #e0e0e0;text-align: right;">&nbsp;</th>
                  <th colspan='5' style="background-color: #e0e0e0;"><?= $rowagama['nama_agama'] ?></th>
                  <th style="background-color: #e0e0e0;text-align: right;"><?= $rowagama['total_agama'] ?></th>
                </tr> 
<?php
        }
?>
                  <tr>
                    <th colspan='7' style="background-color: #e0e0e0;font-weight:bold;">MARITAL STATUS</th>
                  </tr>
<?php
$select_status_kawin = "COUNT(ope.id_status_kawin) as total_status_kawin,nama_status_kawin";
$marital=$this->m_ol_grafik->grafik_unit_pegawai('opu.id_unit',$rowambil_unit_induk['id_unit'],$select_status_kawin);
        foreach ($marital as $rowmarital){
?>
                <tr>
                  <th style="background-color: #e0e0e0;text-align: right;">&nbsp;</th>
                  <th colspan='5' style="background-color: #e0e0e0;"><?= $rowmarital['nama_status_kawin'] ?></th>
                  <th style="background-color: #e0e0e0;text-align: right;"><?= $rowmarital['total_status_kawin'] ?></th>
                </tr> 
<?php
        }
?>
                  <tr>
                    <th colspan='7' style="background-color: #e0e0e0;font-weight:bold;">PENDIDIKAN</th>
                  </tr>
<?php
$select_pendidikan = "COUNT(ope.id_pendidikan) as total_pendidikan,nama_pendidikan";
$pendidikan=$this->m_ol_grafik->grafik_unit_pegawai('opu.id_unit',$rowambil_unit_induk['id_unit'],$select_pendidikan);
        foreach ($pendidikan as $rowpendidikan){
?>
                <tr>
                  <th style="background-color: #e0e0e0;text-align: right;">&nbsp;</th>
                  <th colspan='5' style="background-color: #e0e0e0;"><?= $rowpendidikan['nama_pendidikan'] ?></th>
                  <th style="background-color: #e0e0e0;text-align: right;"><?= $rowpendidikan['total_pendidikan'] ?></th>
                </tr> 
<?php
        }
?>
                  <tr>
                    <th colspan='7' style="background-color: #e0e0e0;font-weight:bold;">JABATAN FUNGSIONAL</th>
                  </tr>
<?php
$select_jabatan_fungsional = "COUNT(ope.id_jabatan_fungsional) as total_jabatan_fungsional,nama_jabatan_fungsional";
$jf=$this->m_ol_grafik->grafik_unit_pegawai('opu.id_unit',$rowambil_unit_induk['id_unit'],$select_jabatan_fungsional);
    foreach ($jf as $rowjabatan_fungsional){
?>
                <tr>
                  <th style="background-color: #e0e0e0;text-align: right;">&nbsp;</th>
                  <th colspan='5' style="background-color: #e0e0e0;"><?= $rowjabatan_fungsional['nama_jabatan_fungsional'] ?></th>
                  <th style="background-color: #e0e0e0;text-align: right;"><?= $rowjabatan_fungsional['total_jabatan_fungsional'] ?></th>
                </tr>      
<?php 
    }
?>
                  <tr>
                    <th colspan='7' style="background-color: #e0e0e0;font-weight:bold;">PETUGAS KLINIS</th>
                  </tr>
<?php
$select_kode_kewenangan = "COUNT(ope.id_kode_kewenangan) as total_kode_kewenangan,nama_kode_kewenangan";
$kode_kewenangan=$this->m_ol_grafik->grafik_unit_pegawai('opu.id_unit',$rowambil_unit_induk['id_unit'],$select_kode_kewenangan);
    foreach ($kode_kewenangan as $rowkode_kewenangan){
?>
                <tr>
                  <th style="background-color: #e0e0e0;text-align: right;">&nbsp;</th>
                  <th colspan='5' style="background-color: #e0e0e0;"><?= $rowkode_kewenangan['nama_kode_kewenangan'] ?></th>
                  <th style="background-color: #e0e0e0;text-align: right;"><?= $rowkode_kewenangan['total_kode_kewenangan'] ?></th>
                </tr>      
<?php 
    }
?>
                  <tr>
                    <th colspan='7' style="background-color: #e0e0e0;font-weight:bold;">PELATIHAN</th>
                  </tr>
<?php
$pelatihan=$this->m_ol_grafik->ambil_rs_berkas_pelatihan('opu.id_unit',$rowambil_unit_induk['id_unit']);
    foreach ($pelatihan as $rowpelatihan){
?>
                <tr>
                  <th style="background-color: #e0e0e0;text-align: right;">&nbsp;</th>
                  <th colspan='5' style="background-color: #e0e0e0;"><?= $rowpelatihan['nama_pelatihan'] ?></th>
                  <th style="background-color: #e0e0e0;text-align: right;"><?= $rowpelatihan['total_pelatihan'] ?></th>
                </tr>      
<?php 
    }
?>
                  <tr>
                    <th colspan='7' style="background-color: #e0e0e0;font-weight:bold;">SURAT IJIN</th>
                  </tr>
<?php
$expired_str=$this->m_ol_grafik->ambil_berkas_expired_ijin_unit('ol_pegawai_unit.id_unit',$rowambil_unit_induk['id_unit'],'1');
    foreach ($expired_str as $rowexpired_str){
?>
                <tr>
                  <th style="background-color: #e0e0e0;text-align: right;">&nbsp;</th>
                  <th colspan='5' style="background-color: #e0e0e0;">STR EXPIRED</th>
                  <th style="background-color: #e0e0e0;text-align: right;"><?= $rowexpired_str['total_str'] ?></th>
                </tr>      
<?php 
    }
$aktif_str=$this->m_ol_grafik->ambil_berkas_aktif_ijin_unit('ol_pegawai_unit.id_unit',$rowambil_unit_induk['id_unit'],'1');
    foreach ($aktif_str as $rowaktif_str){
?>
                <tr>
                  <th style="background-color: #e0e0e0;text-align: right;">&nbsp;</th>
                  <th colspan='5' style="background-color: #e0e0e0;">STR AKTIF</th>
                  <th style="background-color: #e0e0e0;text-align: right;"><?= $rowaktif_str['total_str'] ?></th>
                </tr>      
<?php 
    }
$expired_sip=$this->m_ol_grafik->ambil_berkas_expired_ijin_unit('ol_pegawai_unit.id_unit',$rowambil_unit_induk['id_unit'],'2');
    foreach ($expired_sip as $rowexpired_sip){
?>
                <tr>
                  <th style="background-color: #e0e0e0;text-align: right;">&nbsp;</th>
                  <th colspan='5' style="background-color: #e0e0e0;">SIP EXPIRED</th>
                  <th style="background-color: #e0e0e0;text-align: right;"><?= $rowexpired_sip['total_sip'] ?></th>
                </tr>      
<?php 
    }
$aktif_sip=$this->m_ol_grafik->ambil_berkas_aktif_ijin_unit('ol_pegawai_unit.id_unit',$rowambil_unit_induk['id_unit'],'2');
    foreach ($aktif_sip as $rowaktif_sip){
?>
                <tr>
                  <th style="background-color: #e0e0e0;text-align: right;">&nbsp;</th>
                  <th colspan='5' style="background-color: #e0e0e0;">SIP AKTIF</th>
                  <th style="background-color: #e0e0e0;text-align: right;"><?= $rowaktif_sip['total_str'] ?></th>
                </tr>      
<?php 
    }
$expired_sik=$this->m_ol_grafik->ambil_berkas_expired_ijin_unit('ol_pegawai_unit.id_unit',$rowambil_unit_induk['id_unit'],'3');
    foreach ($expired_sik as $rowexpired_sik){
?>
                <tr>
                  <th style="background-color: #e0e0e0;text-align: right;">&nbsp;</th>
                  <th colspan='5' style="background-color: #e0e0e0;">SIK EXPIRED</th>
                  <th style="background-color: #e0e0e0;text-align: right;"><?= $rowexpired_sik['total_sik'] ?></th>
                </tr>      
<?php 
    }
$aktif_sik=$this->m_ol_grafik->ambil_berkas_aktif_ijin_unit('ol_pegawai_unit.id_unit',$rowambil_unit_induk['id_unit'],'3');
    foreach ($aktif_sik as $rowaktif_sik){
?>
                <tr>
                  <th style="background-color: #e0e0e0;text-align: right;">&nbsp;</th>
                  <th colspan='5' style="background-color: #e0e0e0;">SIK AKTIF</th>
                  <th style="background-color: #e0e0e0;text-align: right;"><?= $rowaktif_sik['total_str'] ?></th>
                </tr>      
<?php 
    }
?>
                </table>
              </div>
          </div>
<?php
  }
?>
        </div>
        <!-- AKHIRI -->
      </div>
    </div>
  </div>
<?php  
}
?>
        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="demografi_rs")
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
        <?php echo $title; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('ol_grafik/demografi_rs/view/'.$id_working,' id="signupform" '); ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
    </div>
      <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Instansi</label>
              <?php
                input_pdselect2fleksibel("id_working","id_working",$ambil_rs_dari_pegawai,"id_working","nama_working",$id_working,"Silahkan Pilih Instansi Dahulu");
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
           <h3 class="box-title"><?php echo $title; ?></h3>
          <div class="box-tools pull-right"></div>
        </div>
        <div class="box-body">
<?php  
  $grafik_pengcab_area=$this->m_ol_grafik->grafik_working_region('id_working',$id_working);
  foreach ($grafik_pengcab_area as $rowgrafik_pengcab_area){  
?>
  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
       <h3 class="box-title"><?= $rowgrafik_pengcab_area['nama_working'] ?></h3>
      <div class="box-tools pull-right"></div>
    </div>
    <div class="box-body">
      <div class="row">
        <!-- AWALI -->
        <div class="col-md-8">
          <h5 class="box-title" style="font-weight:bold;">DAFTAR PEGAWAI</h5>
  <?php  
  $nografik_pegawai_kab = 0;
  $ambil_bekerja_for_person=$this->m_ol_grafik->ambil_tempat_bekerja_for_person('pi.id_instansi',$rowgrafik_pengcab_area['id_working']);
    foreach ($ambil_bekerja_for_person as $rowambil_bekerja_for_person){
      $nografik_pegawai_kab++;
  ?>
  <div class="col-md-6">
    <div class="box-body table-responsive no-padding">
      <table class="table table-hover">
        <tr>
          <th style="width: 5%;"><?= $nografik_pegawai_kab ?></th>
          <th colspan='6' style="background-color: maroon;color: white;font-weight:bold;"><?= $rowambil_bekerja_for_person['nama_pegawai'] ?></th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="background-color: #e0e0e0;font-weight:bold;">DATA UMUM</th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="font-weight:bold;">Gender : 
            <?php 
              if($rowambil_bekerja_for_person['jk'] == 0){ echo 'Perempuan';}else{ echo 'laki-laki'; }
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="font-weight:bold;">TTL : 
            <?php 
              echo $rowambil_bekerja_for_person['tmp_lahir'].", ". date('d-m-Y', strtotime($rowambil_bekerja_for_person['tgl_lahir']));
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="font-weight:bold;">Age : 
            <?php 
              echo $this->m_rancak->dob($rowambil_bekerja_for_person['tgl_lahir']);
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="font-weight:bold;">Agama : 
            <?php 
              $rel = $this->m_umum->ambil_data('kol_agama','id_agama',$rowambil_bekerja_for_person['id_agama']);
              echo $rel['nama_agama'];
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="font-weight:bold;">Marital : 
            <?php 
              $mar = $this->m_umum->ambil_data('kol_status_kawin','id_status_kawin',$rowambil_bekerja_for_person['id_status_kawin']);
              echo $mar['nama_status_kawin'];
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="font-weight:bold;">Status Pegawai : 
            <?php 
              $mar = $this->m_umum->ambil_data('kol_status_pegawai','id_status_pegawai',$rowambil_bekerja_for_person['id_status_pegawai']);
              echo $mar['nama_status_pegawai'];
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="font-weight:bold;">Jabatan : 
            <?php 
              $mar = $this->m_umum->ambil_data('jabatan_fungsional','id_jabatan_fungsional',$rowambil_bekerja_for_person['id_jabatan_fungsional']);
              echo $mar['nama_jabatan_fungsional'];
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="font-weight:bold;">Pendidikan Terakhir : 
            <?php 
              $mar = $this->m_umum->ambil_data('kol_pendidikan','id_pendidikan',$rowambil_bekerja_for_person['id_pendidikan']);
              if($rowambil_bekerja_for_person['status_perawat'] == 0){ echo 'Non Keperawatan'; }else{ echo $mar['nama_pendidikan']; }          
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="font-weight:bold;">PK : 
            <?php 
              $mar = $this->m_umum->ambil_data('kol_kode_kewenangan','id_kode_kewenangan',$rowambil_bekerja_for_person['id_kode_kewenangan']);
              echo $mar['nama_kode_kewenangan'];
            ?>
          </th>
        </tr>        
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="background-color: #e0e0e0;font-weight:bold;">SURAT IJIN</th>
        </tr>
        <tr>
<?php  
$dateb = date("Y-m-d", strtotime("+3 month"));
$expired_str_kab=$this->m_ol_rancak->ambil_berkas_from_kab($rowambil_bekerja_for_person['id_kab'],'1',$rowambil_bekerja_for_person['id_pegawai']);
foreach ($expired_str_kab as $rowexpired_str_kab){
?>
          <th>&nbsp;</th>
          <th>STR</th>
          <th>
          <?php 
            if($rowexpired_str_kab['tgl_b_berkas'] <= date('Y-m-d')){
          ?>
                 <button class="btn btn-danger btn-xs">
                    <?= date('d-m-Y', strtotime($rowexpired_str_kab['tgl_b_berkas'])) ?>
                  </button>    
          <?php 
            }elseif(($rowexpired_str_kab['tgl_b_berkas'] >= date('Y-m-d')) && ($rowexpired_str_kab['tgl_b_berkas'] <= $dateb)){
          ?>
                 <button class="btn btn-warning btn-xs">
                    <?= date('d-m-Y', strtotime($rowexpired_str_kab['tgl_b_berkas'])) ?>
                  </button> 
          <?php 
            }else{
           ?>
                 <button class="btn btn-success btn-xs">
                    <?= date('d-m-Y', strtotime($rowexpired_str_kab['tgl_b_berkas'])) ?>
                  </button>            
          <?php             
            }
          ?>
          </th>
<?php  
} 
$expired_sip_kab=$this->m_ol_rancak->ambil_berkas_from_kab($rowambil_bekerja_for_person['id_kab'],'2',$rowambil_bekerja_for_person['id_pegawai']);
foreach ($expired_sip_kab as $rowexpired_sip_kab){
?>
          <th>SIP</th>
          <th>
          <?php 
            if($rowexpired_sip_kab['tgl_b_berkas'] <= date('Y-m-d')){
          ?>
                 <button class="btn btn-danger btn-xs">
                    <?= date('d-m-Y', strtotime($rowexpired_sip_kab['tgl_b_berkas'])) ?>
                  </button>    
          <?php 
            }elseif(($rowexpired_sip_kab['tgl_b_berkas'] >= date('Y-m-d')) && ($rowexpired_sip_kab['tgl_b_berkas'] <= $dateb)){
          ?>
                 <button class="btn btn-warning btn-xs">
                    <?= date('d-m-Y', strtotime($rowexpired_sip_kab['tgl_b_berkas'])) ?>
                  </button> 
          <?php 
            }else{
           ?>
                 <button class="btn btn-success btn-xs">
                    <?= date('d-m-Y', strtotime($rowexpired_sip_kab['tgl_b_berkas'])) ?>
                  </button>            
          <?php             
            }
          ?>
          </th>
<?php  
}
$expired_sik_kab=$this->m_ol_rancak->ambil_berkas_from_kab($rowambil_bekerja_for_person['id_kab'],'3',$rowambil_bekerja_for_person['id_pegawai']);
foreach ($expired_sik_kab as $rowexpired_sik_kab){
?>
          <th>SIK</th>
          <th>
          <?php 
            if($rowexpired_sik_kab['tgl_b_berkas'] <= date('Y-m-d')){
          ?>
                 <button class="btn btn-danger btn-xs">
                    <?= date('d-m-Y', strtotime($rowexpired_sik_kab['tgl_b_berkas'])) ?>
                  </button>    
          <?php 
            }elseif(($rowexpired_sik_kab['tgl_b_berkas'] >= date('Y-m-d')) && ($rowexpired_sik_kab['tgl_b_berkas'] <= $dateb)){
          ?>
                 <button class="btn btn-warning btn-xs">
                    <?= date('d-m-Y', strtotime($rowexpired_sik_kab['tgl_b_berkas'])) ?>
                  </button> 
          <?php 
            }else{
           ?>
                 <button class="btn btn-success btn-xs">
                    <?= date('d-m-Y', strtotime($rowexpired_sik_kab['tgl_b_berkas'])) ?>
                  </button>            
          <?php             
            }
          ?>
          </th>
<?php  
}
?>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="background-color: #e0e0e0;font-weight:bold;">TEMPAT BEKERJA</th>
        </tr>
        
<?php
$ambil_person=$this->m_ol_grafik->ambil_tempat_bekerja_for_person('peg.id_pegawai',$rowambil_bekerja_for_person['id_pegawai']);
foreach ($ambil_person as $rowambil_person){
  $array = array('u.id_instansi'=>$rowambil_person['id_working'],'opu.id_pegawai'=>$rowambil_person['id_pegawai']);
  $ambil_unit_for_person=$this->m_ol_grafik->ambil_unit_for_person($array);
?>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='5'><?= $rowambil_person['nama_working'] ?></th>
          <th colspan='1' style="text-align:right;">
            <?php 
              if($rowambil_person['status_pegawai_instansi'] == 1){
                 echo '<button class="btn btn-success btn-xs">MASIH BEKERJA</button>';
              }else{
                echo '<button class="btn btn-danger btn-xs">RESIGN</button>';
              }
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='5' style="background-color: #e0e0e0;font-weight:bold;">RUANGAN / UNIT</th>
        </tr>
<?php  
  foreach ($ambil_unit_for_person as $rowambil_unit_for_person){
?>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='5'><?= $rowambil_unit_for_person['nama_unit'] ?></th>
        </tr>
<?php 
  } 
}
?>
        
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="background-color: #e0e0e0;font-weight:bold;">PELATIHAN KHUSUS</th>
        </tr>
        
<?php
$ambil_pelatihan_person=$this->m_ol_grafik->ambil_berkas_pelatihan_person('peg.id_pegawai',$rowambil_bekerja_for_person['id_pegawai']);
foreach ($ambil_pelatihan_person as $rowambil_pelatihan_person){
?>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6'><?= $rowambil_pelatihan_person['nama_berkas'] ?> [ <?= $rowambil_pelatihan_person['nama_kategori_pelatihan'] ?> ]</th>
        </tr>
<?php  
}
?>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="background-color: #e0e0e0;font-weight:bold;">PEMINATAN</th>
        </tr>
 <?php
$ambil_peminatan_person=$this->m_ol_grafik->ambil_peminatan_person('opm.id_pegawai',$rowambil_bekerja_for_person['id_pegawai']);
foreach ($ambil_peminatan_person as $rowambil_peminatan_person){
?>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6'><?= $rowambil_peminatan_person['nama_peminatan'] ?></th>
        </tr>
<?php  
}
?>       
      
      </table>
    </div>
  </div>
<?php 
  }
?>
        </div>
        <!-- AKHIRI -->
        <div class="col-md-4">
          



<?php
if(!empty($id_working)){
?>
          <div class="row">
            <div class="col-md-12">
<?php 
// ============================================ UTAMA
$laki = 0;$pr = 0;
$kondisi_1=array('status_pegawai'=>1,'visible'=>1,'op.id_jabatan'=>$this->session->id_jabatan,'opi.id_instansi'=>$id_working);
$select_gender = "SUM(CASE WHEN jk = '1' THEN 1 END) as mlc,SUM(CASE WHEN jk = '0' THEN 1 END) as flc";
$gender=$this->m_ol_grafik->grafik_all_pengcab_pegawai_instansi('opi.id_instansi',$id_working,$select_gender,$kondisi_1);
$select_agama = "COUNT(ope.id_agama) as total_agama,nama_agama,ope.id_agama";
$agama=$this->m_ol_grafik->grafik_pengcab_pegawai_instansi($select_agama,$kondisi_1,'ope.id_agama');
$select_status_kawin = "COUNT(ope.id_status_kawin) as total_status_kawin,nama_status_kawin";
$status_kawin=$this->m_ol_grafik->grafik_pengcab_pegawai_instansi($select_status_kawin,$kondisi_1,'ope.id_status_kawin');
$select_pendidikan = "COUNT(ope.id_pendidikan) as total_pendidikan,nama_pendidikan";
$pendidikan=$this->m_ol_grafik->grafik_pengcab_pegawai_instansi($select_pendidikan,$kondisi_1,'ope.id_pendidikan');
$select_status_pegawai = "COUNT(ope.tipe_pegawai) as total_status_pegawai,nama_status_pegawai";
$status_pegawai=$this->m_ol_grafik->grafik_pengcab_pegawai_instansi($select_status_pegawai,$kondisi_1,'ope.tipe_pegawai');
$select_kode_kewenangan = "COUNT(ope.id_kode_kewenangan) as total_kode_kewenangan,if(ope.id_kode_kewenangan = 0,'PK 0 / Non Koperawatan',nama_kode_kewenangan) as nama_kode_kewenangan";
$kode_kewenangan=$this->m_ol_grafik->grafik_pengcab_pegawai_instansi($select_kode_kewenangan,$kondisi_1,'ope.id_kode_kewenangan');
$select_jabatan_fungsional = "COUNT(ope.id_jabatan_fungsional) as total_jabatan_fungsional,nama_jabatan_fungsional";
$jf=$this->m_ol_grafik->grafik_pengcab_pegawai_instansi($select_jabatan_fungsional,$kondisi_1,'ope.id_jabatan_fungsional');
$pelatihan=$this->m_ol_grafik->ambil_berkas_pelatihan_instansi('opi.id_instansi',$id_working,'b.id_kategori_pelatihan');
$ambil_peminatan=$this->m_ol_grafik->ambil_peminatan_instansi('opi.id_instansi',$id_working,'opm.id_peminatan');
$expired_str=$this->m_ol_rancak->ambil_berkas_expired_ijin_instansi('ol_pegawai_instansi.id_instansi',$id_working,'1');
$expired_sip=$this->m_ol_rancak->ambil_berkas_expired_ijin_instansi('ol_pegawai_instansi.id_instansi',$id_working,'2');
$expired_sik=$this->m_ol_rancak->ambil_berkas_expired_ijin_instansi('ol_pegawai_instansi.id_instansi',$id_working,'3');
$kondisi_pegawai_resign=array('status_pegawai_instansi'=>0);
$jml_pegawai_resign = $this->m_umum->jumlah_record_filter('ol_pegawai_instansi',$kondisi_pegawai_resign);
$kondisi_pegawai_bekerja=array('status_pegawai_instansi'=>1);
$jml_pegawai_bekerja = $this->m_umum->jumlah_record_filter('ol_pegawai_instansi',$kondisi_pegawai_bekerja);
$select_prov = "COUNT(ope.id_prov) as total_prov,nama_prov,ope.id_prov";
$prov=$this->m_ol_grafik->grafik_pengcab_pegawai_instansi($select_prov,$kondisi_1,'ope.id_prov');
?>
<div class="box-body table-responsive no-padding">
  <table width="100%" class="table table-hover">
    <tbody>
    <tr>
      <td style="background-color:#063970;color:white;vertical-align:middle;">
      Gender || PDF &nbsp;
<a href="<?php echo base_url('ol_grafik/demografi_rs/pdf_gender/'); ?><?= $id_working ?>" target="_blank"><i class="fa fa-file-pdf-o text-white"></i>
          </a>
    </td>
      <td style="background-color:#063970;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
    <tr>
      <td style="vertical-align:middle;">Laki-laki</td>
      <td style="vertical-align:middle;text-align: right;"><?= $gender['mlc'] ?></td>
    </tr>
    <tr>
      <td style="vertical-align:middle;">Perempuan</td>
      <td style="vertical-align:middle;text-align: right;"><?= $gender['flc'] ?></td>
    </tr>
    <tr>
      <td style="background-color:#979915;color:white;vertical-align:middle;">
      Agama || PDF &nbsp;
<a href="<?php echo base_url('ol_grafik/demografi_rs/pdf_religi/'); ?><?= $id_working ?>" target="_blank"><i class="fa fa-file-pdf-o text-white"></i>
          </a>
    </td>
      <td style="background-color:#979915;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php
foreach ($agama as $rowagama){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowagama['nama_agama'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowagama['total_agama'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#979915;color:white;vertical-align:middle;">
      Marital || PDF &nbsp;
          <a href="<?php echo base_url('ol_grafik/demografi_rs/pdf_marital/'); ?><?= $id_working ?>" target="_blank"><i class="fa fa-file-pdf-o text-white"></i>
          </a> 
    </td>
      <td style="background-color:#979915;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php
foreach ($status_kawin as $rowstatus_kawin){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowstatus_kawin['nama_status_kawin'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowstatus_kawin['total_status_kawin'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#979915;color:white;vertical-align:middle;">
      Status Pegawai || PDF &nbsp;
          <a href="<?php echo base_url('ol_grafik/demografi_rs/pdf_asn/'); ?><?= $id_working ?>" target="_blank"><i class="fa fa-file-pdf-o text-white"></i>
          </a> 
    </td>
      <td style="background-color:#979915;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($status_pegawai as $rowstatus_pegawai){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowstatus_pegawai['nama_status_pegawai'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowstatus_pegawai['total_status_pegawai'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#979915;color:white;vertical-align:middle;">
      PK || PDF &nbsp;
          <a href="<?php echo base_url('ol_grafik/demografi_rs/pdf_kd/'); ?><?= $id_working ?>" target="_blank"><i class="fa fa-file-pdf-o text-white"></i>
          </a> </td>
      <td style="background-color:#979915;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($kode_kewenangan as $rowkode_kewenangan){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowkode_kewenangan['nama_kode_kewenangan'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowkode_kewenangan['total_kode_kewenangan'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#063970;color:white;vertical-align:middle;">
        Surat Ijin &nbsp; <i class="fa fa-file-pdf-o text-white"></i>
        || 
          <a href="<?php echo base_url('ol_grafik/demografi_rs/pdf_surat_ijin_aktif/'); ?><?= $id_working ?>" target="_blank"> Aktif
          </a> 
        || 
          <a href="<?php echo base_url('ol_grafik/demografi_rs/pdf_surat_ijin_tenggang/'); ?><?= $id_working ?>" target="_blank"> Tenggang
          </a> 
        || 
          <a href="<?php echo base_url('ol_grafik/demografi_rs/pdf_surat_ijin_expired/'); ?><?= $id_working ?>" target="_blank"> Expired
          </a> 
      </td>
      <td style="background-color:#063970;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php
foreach ($expired_str as $rowexpired_str){
?>
    <tr>
      <td style="background-color:#FE0101;color:white;vertical-align:middle;">Expired STR</td>
      <td style="background-color:#FE0101;color:white;vertical-align:middle;text-align: right;"><?= $rowexpired_str['total_str'] ?></td>
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
foreach ($expired_sik as $rowexpired_sik){
?>
    <tr>
      <td style="background-color:#FE0101;color:white;vertical-align:middle;">Expired SIK</td>
      <td style="background-color:#FE0101;color:white;vertical-align:middle;text-align: right;"><?= $rowexpired_sik['total_str'] ?></td>
    </tr>
<?php 
}
?>
    </tbody>
  </table>              
            </div>
            </div>
            <div class="col-md-12">
<div class="box-body table-responsive no-padding">
  <table width="100%" class="table table-hover">
    <tbody>
    <tr>
      <td style="background-color:#063970;color:white;vertical-align:middle;">
      Pendidikan || PDF &nbsp;
          <a href="<?php echo base_url('ol_grafik/demografi_rs/pdf_pendidikan/'); ?><?= $id_working ?>" target="_blank"><i class="fa fa-file-pdf-o text-white"></i>
          </a> 
    </td>
      <td style="background-color:#063970;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($pendidikan as $rowpendidikan){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowpendidikan['nama_pendidikan'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowpendidikan['total_pendidikan'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#979915;color:white;vertical-align:middle;">
      Jabatan Fungsional || PDF &nbsp;
          <a href="<?php echo base_url('ol_grafik/demografi_rs/pdf_jabfung/'); ?><?= $id_working ?>" target="_blank"><i class="fa fa-file-pdf-o text-white"></i>
          </a> 
    </td>
      <td style="background-color:#979915;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($jf as $rowjf){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowjf['nama_jabatan_fungsional'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowjf['total_jabatan_fungsional'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#979915;color:white;vertical-align:middle;">
      Pelatihan || PDF &nbsp;
<a href="<?php echo base_url('ol_grafik/demografi_rs/pdf_pelatihan/'); ?><?= $id_working ?>" target="_blank"><i class="fa fa-file-pdf-o text-white"></i>
          </a>
    </td>
      <td style="background-color:#979915;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($pelatihan as $rowpelatihan){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowpelatihan['nama_kategori_pelatihan'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowpelatihan['total_pelatihan'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#979915;color:white;vertical-align:middle;">
        Peminatan || PDF &nbsp;
          <a href="<?php echo base_url('ol_grafik/demografi_rs/pdf_peminatan/'); ?><?= $id_working ?>" target="_blank"><i class="fa fa-file-pdf-o text-white"></i>
          </a> 
      </td>
      <td style="background-color:#979915;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($ambil_peminatan as $rowambil_peminatan){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowambil_peminatan['nama_peminatan'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowambil_peminatan['total_peminatan'] ?></td>
    </tr>
<?php 
}
?>
    </tbody>
  </table>              
            </div>
            </div>
            <div class="col-md-12">
<div class="box-body table-responsive no-padding">
  <table width="100%" class="table table-hover">
    <tbody>
    <tr>
      <td style="background-color:#979915;color:white;vertical-align:middle;">
        Alamat || PDF &nbsp;
<a href="<?php echo base_url('ol_grafik/demografi_rs/pdf_alamat/'); ?><?= $id_working ?>" target="_blank"><i class="fa fa-file-pdf-o text-white"></i>
          </a>
      </td>
      <td style="background-color:#979915;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($prov as $rowprov){
?>
    <tr>
      <td style="background-color:#063970;color:white;vertical-align:middle;"><?= $rowprov['nama_prov'] ?></td>
      <td style="background-color:#063970;color:white;vertical-align:middle;text-align: right;"><?= $rowprov['total_prov'] ?></td>
    </tr>
<?php 
$kondisi_kab=array('op.id_jabatan'=>$this->session->id_jabatan,'opi.id_instansi'=>$id_working,'ope.id_prov'=>$rowprov['id_prov']);
$select_kab = "COUNT(ope.id_kab) as total_kab,nama_kab,ope.id_kab";
$kab=$this->m_ol_grafik->grafik_pengcab_pegawai_instansi($select_kab,$kondisi_kab,'ope.id_kab');
  foreach ($kab as $rowkab){
$kondisi_kec=array('op.id_jabatan'=>$this->session->id_jabatan,'opi.id_instansi'=>$id_working,'ope.id_kab'=>$rowkab['id_kab']);
$select_kec = "COUNT(ope.id_kec) as total_kec,nama_kec,ope.id_kec";
$kec=$this->m_ol_grafik->grafik_pengcab_pegawai_instansi($select_kec,$kondisi_kec,'ope.id_kec');
?>
    <tr>
      <td style="background-color:#8C0720;color:white;vertical-align:middle;padding-left: 20px;">&nbsp;&nbsp;<?= $rowkab['nama_kab'] ?></td>
      <td style="background-color:#8C0720;color:white;vertical-align:middle;text-align: right;"><?= $rowkab['total_kab'] ?></td>
    </tr>
<?php
    foreach ($kec as $rowkec){
$kondisi_kec=array('op.id_jabatan'=>$this->session->id_jabatan,'opi.id_instansi'=>$id_working,'ope.id_kec'=>$rowkec['id_kec']);
$select_kel = "COUNT(ope.id_kel) as total_kel,nama_kel,ope.id_kel";
$kel=$this->m_ol_grafik->grafik_pengcab_pegawai_instansi($select_kel,$kondisi_kec,'ope.id_kel');
?>
    <tr>
      <td style="background-color:#078C8A;color:white;vertical-align:middle;padding-left: 35px;"><?= $rowkec['nama_kec'] ?></td>
      <td style="background-color:#078C8A;color:white;vertical-align:middle;text-align: right;"><?= $rowkec['total_kec'] ?></td>
    </tr>
<?php
      foreach ($kel as $rowkel){
?>
    <tr>
      <td style="background-color:#238C07;color:white;vertical-align:middle;padding-left: 50px;"><?= $rowkel['nama_kel'] ?></td>
      <td style="background-color:#238C07;color:white;vertical-align:middle;text-align: right;"><?= $rowkel['total_kel'] ?></td>
    </tr>
<?php
      }
    }
  }
}
?>
    </tbody>
  </table>              
            </div>
            </div>
          </div>

<?php 
}
?>









        </div>
      </div>
    </div>
  </div>
<?php  
}
?>
        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="demografi_pengcab")
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
        <?php echo $title; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('ol_grafik/demografi_pengcab/view/'.$id_pengcab,' id="signupform" '); ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
    </div>
      <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Instansi</label>
              <?php
                input_pdselect2fleksibel("id_pengcab","id_pengcab",$ambil_pengcab,"id_pengcab","nama_pengcab",$id_pengcab,"Silahkan Pilih Dahulu");
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
           <h3 class="box-title"><?php echo $title; ?></h3>
          <div class="box-tools pull-right"></div>
        </div>
        <div class="box-body">
<?php  
  $grafik_pengcab_region=$this->m_ol_grafik->share_data_prov_from_pengurus('ol_pengurus.id_pengcab',$id_pengcab);
  foreach ($grafik_pengcab_region as $rowgrafik_pengcab_area){
?>
  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
       <h3 class="box-title"><?= $rowgrafik_pengcab_area['nama_pengcab'] ?></h3>
      <div class="box-tools pull-right"></div>
    </div>
    <div class="box-body">
      <div class="row">
      <div class="col-md-12">
        <?php   
        $nografik_pegawai_kab = 0;
          $pengcab_area_4pegawai=$this->m_ol_grafik->grafik_pegawai_area('id_pengcab',$rowgrafik_pengcab_area['id_pengcab']);
         foreach ($pengcab_area_4pegawai as $rowgrafik_pegawai_kab){
          $nografik_pegawai_kab++;
        ?>
        <div class="col-md-4">
    <div class="box-body table-responsive no-padding">
      <table class="table table-hover">
        <tr>
          <th style="background-color: maroon;color: white;font-weight:bold;width:5%;"><?= $nografik_pegawai_kab ?></th>
          <th colspan='6' style="background-color: maroon;color: white;font-weight:bold;"><?= $rowgrafik_pegawai_kab['nama_pegawai'] ?></th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="background-color: #e0e0e0;font-weight:bold;">DATA UMUM</th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="font-weight:bold;">Gender : 
            <?php 
              if($rowgrafik_pegawai_kab['nama_pegawai'] == 0){ echo 'Perempuan';}else{ echo 'laki-laki'; }
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="font-weight:bold;">TTL : 
            <?php 
              echo $rowgrafik_pegawai_kab['tmp_lahir'].", ". date('d-m-Y', strtotime($rowgrafik_pegawai_kab['tgl_lahir']));
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="font-weight:bold;">Age : 
            <?php 
              echo $this->m_rancak->dob($rowgrafik_pegawai_kab['tgl_lahir']);
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="font-weight:bold;">Agama : 
            <?php 
              $rel = $this->m_umum->ambil_data('kol_agama','id_agama',$rowgrafik_pegawai_kab['id_agama']);
              echo $rel['nama_agama'];
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="font-weight:bold;">Marital : 
            <?php 
              $mar = $this->m_umum->ambil_data('kol_status_kawin','id_status_kawin',$rowgrafik_pegawai_kab['id_status_kawin']);
              echo $mar['nama_status_kawin'];
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="font-weight:bold;">Status Pegawai : 
            <?php 
              $mar = $this->m_umum->ambil_data('kol_status_pegawai','id_status_pegawai',$rowgrafik_pegawai_kab['id_status_pegawai']);
              echo $mar['nama_status_pegawai'];
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="font-weight:bold;">Jabatan : 
            <?php 
              $mar = $this->m_umum->ambil_data('jabatan_fungsional','id_jabatan_fungsional',$rowgrafik_pegawai_kab['id_jabatan_fungsional']);
              echo $mar['nama_jabatan_fungsional'];
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="font-weight:bold;">Pendidikan Terakhir : 
            <?php 
              $mar = $this->m_umum->ambil_data('kol_pendidikan','id_pendidikan',$rowgrafik_pegawai_kab['id_pendidikan']);
              if($rowgrafik_pegawai_kab['status_perawat'] == 0){ echo 'Non Keperawatan'; }else{ echo $mar['nama_pendidikan']; }          
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="font-weight:bold;">PK : 
            <?php 
              $mar = $this->m_umum->ambil_data('kol_kode_kewenangan','id_kode_kewenangan',$rowgrafik_pegawai_kab['id_kode_kewenangan']);
              echo $mar['nama_kode_kewenangan'];
            ?>
          </th>
        </tr>        
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="background-color: #e0e0e0;font-weight:bold;">SURAT IJIN</th>
        </tr>
        <tr>
<?php  
$dateb = date("Y-m-d", strtotime("+3 month"));
$expired_str_kab=$this->m_ol_rancak->ambil_berkas_from_kab($rowgrafik_pegawai_kab['id_kab'],'1',$rowgrafik_pegawai_kab['id_pegawai']);
foreach ($expired_str_kab as $rowexpired_str_kab){
?>
          <th>&nbsp;</th>
          <th>STR</th>
          <th>
          <?php 
            if($rowexpired_str_kab['tgl_b_berkas'] <= date('Y-m-d')){
          ?>
                 <button class="btn btn-danger btn-xs">
                    <?= date('d-m-Y', strtotime($rowexpired_str_kab['tgl_b_berkas'])) ?>
                  </button>    
          <?php 
            }elseif(($rowexpired_str_kab['tgl_b_berkas'] >= date('Y-m-d')) && ($rowexpired_str_kab['tgl_b_berkas'] <= $dateb)){
          ?>
                 <button class="btn btn-warning btn-xs">
                    <?= date('d-m-Y', strtotime($rowexpired_str_kab['tgl_b_berkas'])) ?>
                  </button> 
          <?php 
            }else{
           ?>
                 <button class="btn btn-success btn-xs">
                    <?= date('d-m-Y', strtotime($rowexpired_str_kab['tgl_b_berkas'])) ?>
                  </button>            
          <?php             
            }
          ?>
          </th>
<?php  
} 
$expired_sip_kab=$this->m_ol_rancak->ambil_berkas_from_kab($rowgrafik_pegawai_kab['id_kab'],'2',$rowgrafik_pegawai_kab['id_pegawai']);
foreach ($expired_sip_kab as $rowexpired_sip_kab){
?>
          <th>SIP</th>
          <th>
          <?php 
            if($rowexpired_sip_kab['tgl_b_berkas'] <= date('Y-m-d')){
          ?>
                 <button class="btn btn-danger btn-xs">
                    <?= date('d-m-Y', strtotime($rowexpired_sip_kab['tgl_b_berkas'])) ?>
                  </button>    
          <?php 
            }elseif(($rowexpired_sip_kab['tgl_b_berkas'] >= date('Y-m-d')) && ($rowexpired_sip_kab['tgl_b_berkas'] <= $dateb)){
          ?>
                 <button class="btn btn-warning btn-xs">
                    <?= date('d-m-Y', strtotime($rowexpired_sip_kab['tgl_b_berkas'])) ?>
                  </button> 
          <?php 
            }else{
           ?>
                 <button class="btn btn-success btn-xs">
                    <?= date('d-m-Y', strtotime($rowexpired_sip_kab['tgl_b_berkas'])) ?>
                  </button>            
          <?php             
            }
          ?>
          </th>
<?php  
}
$expired_sik_kab=$this->m_ol_rancak->ambil_berkas_from_kab($rowgrafik_pegawai_kab['id_kab'],'3',$rowgrafik_pegawai_kab['id_pegawai']);
foreach ($expired_sik_kab as $rowexpired_sik_kab){
?>
          <th>SIK</th>
          <th>
          <?php 
            if($rowexpired_sik_kab['tgl_b_berkas'] <= date('Y-m-d')){
          ?>
                 <button class="btn btn-danger btn-xs">
                    <?= date('d-m-Y', strtotime($rowexpired_sik_kab['tgl_b_berkas'])) ?>
                  </button>    
          <?php 
            }elseif(($rowexpired_sik_kab['tgl_b_berkas'] >= date('Y-m-d')) && ($rowexpired_sik_kab['tgl_b_berkas'] <= $dateb)){
          ?>
                 <button class="btn btn-warning btn-xs">
                    <?= date('d-m-Y', strtotime($rowexpired_sik_kab['tgl_b_berkas'])) ?>
                  </button> 
          <?php 
            }else{
           ?>
                 <button class="btn btn-success btn-xs">
                    <?= date('d-m-Y', strtotime($rowexpired_sik_kab['tgl_b_berkas'])) ?>
                  </button>            
          <?php             
            }
          ?>
          </th>
<?php  
}
?>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="background-color: #e0e0e0;font-weight:bold;">TEMPAT BEKERJA</th>
        </tr>
        
<?php
$ambil_person=$this->m_ol_grafik->ambil_tempat_bekerja_for_person('peg.id_pegawai',$rowgrafik_pegawai_kab['id_pegawai']);
foreach ($ambil_person as $rowambil_person){
  $array = array('u.id_instansi'=>$rowambil_person['id_working'],'opu.id_pegawai'=>$rowambil_person['id_pegawai']);
  $ambil_unit_for_person=$this->m_ol_grafik->ambil_unit_for_person($array);
?>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='5'><?= $rowambil_person['nama_working'] ?></th>
          <th colspan='1' style="text-align:right;">
            <?php 
              if($rowambil_person['status_pegawai_instansi'] == 1){
                 echo '<button class="btn btn-success btn-xs">MASIH BEKERJA</button>';
              }else{
                echo '<button class="btn btn-danger btn-xs">RESIGN</button>';
              }
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='5' style="background-color: #e0e0e0;font-weight:bold;">RUANGAN / UNIT</th>
        </tr>
<?php  
  foreach ($ambil_unit_for_person as $rowambil_unit_for_person){
?>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='5'><?= $rowambil_unit_for_person['nama_unit'] ?></th>
        </tr>
<?php 
  }
}
?>
        
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="background-color: #e0e0e0;font-weight:bold;">PELATIHAN KHUSUS</th>
        </tr>
        
<?php
$ambil_pelatihan_person=$this->m_ol_grafik->ambil_berkas_pelatihan_person('peg.id_pegawai',$rowgrafik_pegawai_kab['id_pegawai']);
foreach ($ambil_pelatihan_person as $rowambil_pelatihan_person){
?>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6'><?= $rowambil_pelatihan_person['nama_berkas'] ?> [ <?= $rowambil_pelatihan_person['nama_kategori_pelatihan'] ?> ]</th>
        </tr>
<?php  
}
?>
         <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="background-color: #e0e0e0;font-weight:bold;">PEMINATAN</th>
        </tr>       
 <?php
$ambil_peminatan_person=$this->m_ol_grafik->ambil_peminatan_person('opm.id_pegawai',$rowgrafik_pegawai_kab['id_pegawai']);
foreach ($ambil_peminatan_person as $rowambil_peminatan_person){
?>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6'><?= $rowambil_peminatan_person['nama_peminatan'] ?></th>
        </tr>
<?php  
}
?> 
      </table>
    </div>
    </div>
        <?php 
        }          
        ?>
      </div>
    </div>
<?php  
  }
?>
        </div>
      </div>
    </section>
</div>
<?php
}