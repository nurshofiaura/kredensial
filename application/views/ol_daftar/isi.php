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
    <?php
       //   echo '<pre>'; print_r($this->session->all_userdata());
    ?>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="daftar_registrasi")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('ol_daftar/daftar_registrasi/view/'.$id,' id="signupform" ');
  ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">MULTIPLE SEARCH</h3>
    </div>
      <div class="box-body">
        <div class="col-md-12">
          <div class="form-group">
            <label> Ketik multiple pisahkan dengan spasi untuk NIP, No Profesi dan Nama</label>
              <?php
                input_text("id",$id," autofocus","Ketik multiple pisahkan dengan spasi atau -","text");
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
          <div class="box-tools pull-right"></div>
        </div>
        <div class="box-body">
          <div class="box-tools pull-right">
			<?php
			//	input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
			?>
          </div>
			<table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
				<thead>
					<tr>
					  <th>ID</th>
					  <th>Tanggal</th>
					  <th>Nama</th>
					  <th>Instansi</th>
					  <th>HP</th>
					</tr>
				</thead>
			</table>
        </div>
        <div class="box-footer">
<?php
// include "assets/phpqrcode/qrlib.php"; 
// $penyimpanan = "temp/";
// if (!file_exists($penyimpanan))
//  mkdir($penyimpanan);
// $isi = 'https://www.malasngoding.com'; 
// QRcode::png($isi, $penyimpanan.'qrcodeku_L.png', QR_ECLEVEL_L); 
// QRcode::png($isi, $penyimpanan.'qrcodeku_M.png', QR_ECLEVEL_M); 
// QRcode::png($isi, $penyimpanan.'qrcodeku_Q.png', QR_ECLEVEL_Q); 
// QRcode::png($isi, $penyimpanan.'qrcodeku_H.png', QR_ECLEVEL_H);
// echo '<img src="'.$penyimpanan.'qrcodeku_L.png">';
// echo '<img src="'.$penyimpanan.'qrcodeku_M.png">';
// echo '<img src="'.$penyimpanan.'qrcodeku_Q.png">';
// echo '<img src="'.$penyimpanan.'qrcodeku_H.png">';
?>
        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
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
elseif ($page=="daftar_registrasi_buat_barcode")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_daftar/daftar_registrasi/simpan_buat_barcode');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
		<div class="box-body">
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title"><?php $title; ?></h3>
			</div>
			  <div class="box-body">
					<div class="container col-md-12">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
								  <label>Instansi</label>
									<?php
                  input_pdselect2("id_instansi",$cmd_instansi,$id_instansi);
									?>
								</div>
							</div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>No WA</label>
                <?php
                  input_textcustom("no_hp",$no_hp," required
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "Ketikkan No HP","text");
                ?>
                </div>
              </div>
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
});
</script>
<?php
}
elseif ($page=="daftar_registrasi_edit_barcode")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_daftar/daftar_registrasi/simpan_edit_barcode');?>" onClick="return cek();">
       <input type="hidden" name="barcode_registrasi" value="<?= $barcode_registrasi; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
          <div class="container col-md-12">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Instansi</label>
                  <?php
                  input_pdselect2("id_instansi",$cmd_instansi,$id_instansi);
                  ?>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>No WA</label>
                <?php
                  input_textcustom("cp",$cp," required
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "Ketikkan No HP","text");
                ?>
                </div>
              </div>
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
});
</script>
<?php
}
elseif ($page=="daftar_registrasi_aktifasi")
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
      <?php echo form_open_multipart('ol_daftar/daftar_registrasi/aktifasi/'.$id,' id="signupform" ');
        input_text("barcode_registrasi",$id,"","","hidden");
        input_text("status_registrasi",$status_registrasi,"","","hidden");
      ?>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-3">
              <div class="form-group">
                <label>Nama Pegawai</label>
                <?php
                  input_text("nama_pegawai",$nama_pegawai,"maxlength='60' required autofocus ","Ketikkan Nama","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Tempat Lahir</label>
                <?php
                  input_text("tmp_lahir",$tmp_lahir,"maxlength='255' ","Ketikkan Tempat Lahir","text");
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Tanggal Lahir</label>
                <?php
                  input_calendar("tgl_lahir","tgl_lahir",$tgl_lahir,"Masukkan Tanggal Lahir"," required");
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Jenis Kelamin</label>
                <?php
                  input_pdselect2("jk",$gender,$jk);
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Status Perkawinan</label>
                <?php
                  input_pdselect2("id_status_kawin",$cmd_status_kawin,$id_status_kawin);
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Agama</label>
                <?php
                  input_pdselect2("id_agama",$cmd_agama,$id_agama);
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Status Perawat</label>
                <?php
                  input_pdselect2("status_perawat",$opsi_status_perawat,$status_perawat);
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>PK</label>
                <?php
                  input_pdselect2fleksibel("id_kode_kewenangan","id_kode_kewenangan",$kol_kode_kewenangan_null,"id_kode_kewenangan","nama_kode_kewenangan",$id_kode_kewenangan,"Belum Ada PK");
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>No KTP &nbsp; <small><span style="font-weight:bold;" id="msg2"></span></small></label>
                <?php
                  input_textcustom("nik",$nik," required id='nik'
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "Masukkan No KTP","text");
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Jabatan Pegawai</label>
                <?php
                  input_pdselect2("tipe_pegawai",$cmd_tipe_pegawai,$tipe_pegawai);
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Nomor Induk Karyawan</label>
                <?php
                  input_textcustom("nip",$nip,"  
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "Masukkan No Induk Karyawan","text");
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>No WA </label>
                <?php
                  input_textcustom("no_hp",$no_hp," required
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "Ketikkan No HP format kode negara","text");
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Email</label>
                <?php
                  input_text("email",$email,"maxlength='255' ","Ketikkan Email","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Jabatan Fungsional</label>
                <?php
                  input_pdselect2fleksibel("id_jabatan_fungsional","id_jabatan_fungsional",$cmd_jabfung,"id_jabatan_fungsional","nama_jabatan_fungsional",$id_jabatan_fungsional,"Tidak Ada Jabfung");
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Nomor Profesi</label>
                <?php
                  input_textcustom("no_profesi",$no_profesi,"  
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "Masukkan No Profesi","text");
                ?>
              </div>
            </div>  
            <div class="col-md-3">
              <div class="form-group">
                <label>DPK / DPW</label>
                <?php
                  input_pdselect2("id_pengcab",$null_pengcab,$id_pengcab);
                //  echo form_dropdown('id_kab',$kab,'0',array('id'=>'id_kab','class'=>'form-control'));
                ?>
              </div>
            </div>          
            <div class="col-md-3">
              <div class="form-group">
                <label>Tempat Bekerja</label>
                <?php
                  input_pdselect2fleksibel("id_instansi","id_instansi",$ambil_data_rujukan_working_null,"id_working","nama_working",$id_instansi,"Belum Bekerja");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Pendidikan Terakhir</label>
                <?php
                  input_pdselect2("id_pendidikan",$cmd_pendidikan,$id_pendidikan);
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Alamat</label>
                <?php
                  input_text("alamat",$alamat,"maxlength='255' ","Ketikkan Alamat","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Propinsi</label>
                <?php
                  input_pdselect2fleksibel("id_prov","id_prov",$kol_provinsi,"id_prov","nama_prov",$id_prov,"Silahkan Pilih Provinsi Dulu");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Kota/Kabupaten</label>
                <?php
                  input_pdselect2("id_kab",$kab,$id_kab);
                //  echo form_dropdown('id_kab',$kab,'0',array('id'=>'id_kab','class'=>'form-control'));
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Kecamatan</label>
                <?php
                  input_pdselect2("id_kec",$kec,$id_kec);
                //  echo form_dropdown('id_kec',$kec,'0',array('id'=>'id_kec','class'=>'form-control'));
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Kelurahan</label>
                <?php
                  input_pdselect2("id_kel",$kel,$id_kel);
                //  echo form_dropdown('id_kel',$kel,'0',array('id'=>'id_kel','class'=>'form-control'));
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Level</label>
                  <?php
                    input_pdselect2("id_level",$cmd_level,$id_level);
                  ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Username &nbsp; <small><span style="font-weight:bold;" id="msg"></span></small></label>
                <small><input type="checkbox" onclick="myUsername()"> Hide </small>
                <?php
                  input_textcustom("username",$username," maxlength='60' class='form-control' required autocomplete='off' id='username' ",
                          "Huruf kecil tanpa spasi dan spesial character kecuali -","text");
                ?>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
    <?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="user")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('ol_daftar/user/view/'.$id,' id="signupform" ');
  ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">MULTIPLE SEARCH</h3>
    </div>
      <div class="box-body">
        <div class="col-md-12">
          <div class="form-group">
            <label> Ketik multiple pisahkan dengan spasi untuk NIP, No Profesi dan Nama</label>
              <?php
                input_text("id",$id," autofocus","Ketik multiple pisahkan dengan spasi atau -","text");
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
      <?php
  //      input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th style="width:5%;"></th>
            <th style="display:none;"></th>
            <th>Nama</th>
            <th>JabFung</th>
            <th>No HP</th>
            <th>No KTP</th>
            <th>PK</th>
            <th>Status</th>
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
  <div class="modal-dialog">
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
elseif ($page=="user_login")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_daftar/user/simpan_login');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            <input type="hidden" name="id_pegawai" value="<?= $id; ?>">
          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">DATA LEVEL</h3>
      </div>
        <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <h5><strong>LEVEL USER SEKARANG</strong></h5>
              <?php
                foreach($ambil_user_level_member as $rowambil_user_level_member){
              ?>
              <div class="col-md-6">
                  <?= $rowambil_user_level_member['nama_level'] ?>
              </div>
              <?php 
                }
              ?><br style="line-height:70px;">
            </div>
              

              <div class="col-md-12">
                  <label>Tambah Level</label>
                  <?php
                  input_pdselect2("id_level",$cmd_level_no_member,$id_level);
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
});
</script>
<?php
}
elseif ($page=="user_tambah")
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
      <?php echo form_open_multipart('ol_daftar/user/tambah/',' id="signupform" ');
      ?>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">USER</h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-4">
              <div class="form-group">
                <label>Nama Pegawai</label>
                <?php
                  input_text("nama_pegawai",$nama_pegawai,"maxlength='60' required autofocus ","Ketikkan Nama","text");
                ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Tempat Lahir</label>
                <?php
                  input_text("tmp_lahir",$tmp_lahir,"maxlength='255' ","Ketikkan Tempat Lahir","text");
                ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Tanggal Lahir</label>
                <?php
                  input_calendar("tgl_lahir","tgl_lahir",$tgl_lahir,"Masukkan Tanggal Lahir"," required");
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Jenis Kelamin</label>
                <?php
                  input_pdselect2("jk",$gender,$jk);
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Status Perkawinan</label>
                <?php
                  input_pdselect2("id_status_kawin",$cmd_status_kawin,$id_status_kawin);
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Agama</label>
                <?php
                  input_pdselect2("id_agama",$cmd_agama,$id_agama);
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Status Perawat</label>
                <?php
                  input_pdselect2("status_perawat",$opsi_status_perawat,$status_perawat);
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>PK</label>
                <?php
                  input_pdselect2fleksibel("id_kode_kewenangan","id_kode_kewenangan",$kol_kode_kewenangan_null,"id_kode_kewenangan","nama_kode_kewenangan",$id_kode_kewenangan,"Belum Ada PK");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>No KTP &nbsp; <small><span style="font-weight:bold;" id="msg2"></span></small></label>
                <?php
                  input_textcustom("nik",$nik," required id='nik'
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "Masukkan No KTP","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Jabatan Pegawai</label>
                <?php
                  input_pdselect2("tipe_pegawai",$cmd_tipe_pegawai,$tipe_pegawai);
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Jabatan Fungsional</label>
                <?php
                  input_pdselect2fleksibel("id_jabatan_fungsional","id_jabatan_fungsional",$cmd_jabfung,"id_jabatan_fungsional","nama_jabatan_fungsional",$id_jabatan_fungsional,"Tidak Ada Jabfung");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Nomor Induk Karyawan</label>
                <?php
                  input_textcustom("nip",$nip,"  
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "Masukkan No Induk Karyawan","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>No WA </label>
                <?php
                  input_textcustom("no_hp",$no_hp," required
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "Ketikkan No HP format kode negara","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Email</label>
                <?php
                  input_text("email",$email,"maxlength='255' ","Ketikkan Email","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Nomor Profesi (NIRA/PARI DLL)</label>
                <?php
                  input_textcustom("no_profesi",$no_profesi,"  
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "Masukkan No Profesi (PARI / NIRA DLL)","text");
                ?>
              </div>
            </div>            
            <div class="col-md-3">
              <div class="form-group">
                <label>Tempat Bekerja</label>
                <?php
                  input_pdselect2("id_instansi",$ambil_data_rujukan_instansi,$id_instansi);
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Pendidikan Terakhir</label>
                <?php
                  input_pdselect2("id_pendidikan",$cmd_pendidikan,$id_pendidikan);
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Alamat</label>
                <?php
                  input_text("alamat",$alamat,"maxlength='255' ","Ketikkan Alamat","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Level</label>
                <?php
                  input_pdselect2("id_level",$cmd_level,$id_level);
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Username &nbsp; <small><span style="font-weight:bold;" id="msg"></span></small></label>
                <small><input type="checkbox" onclick="myUsername()"> Hide </small>
                <?php
                  input_textcustom("username",$username," maxlength='60' class='form-control' required autocomplete='off' id='username' ",
                          "Huruf kecil tanpa spasi dan spesial character kecuali -","text");
                ?>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
    <?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="user_edit")
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
      <?php echo form_open_multipart('ol_daftar/user/edit/'.$id,' id="signupform" ');
        input_text("barcode_pegawai",$id,"","","hidden");
        input_text("nik_lama",$nik,"","","hidden");
        input_text("username_lama",$username,"","","hidden");
        input_text("password_lama",$password_lama,"","","hidden");
      ?>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">USER</h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-4">
              <div class="form-group">
                <label>Nama Pegawai</label>
                <?php
                  input_text("nama_pegawai",$nama_pegawai,"maxlength='60' required autofocus ","Ketikkan Nama","text");
                ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Tempat Lahir</label>
                <?php
                  input_text("tmp_lahir",$tmp_lahir,"maxlength='255' ","Ketikkan Tempat Lahir","text");
                ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Tanggal Lahir</label>
                <?php
                  input_calendar("tgl_lahir","tgl_lahir",$tgl_lahir,"Masukkan Tanggal Lahir"," required");
                ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Jenis Kelamin</label>
                <?php
                  input_pdselect2("jk",$gender,$jk);
                ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Status Perkawinan</label>
                <?php
                  input_pdselect2("id_status_kawin",$cmd_status_kawin,$id_status_kawin);
                ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Agama</label>
                <?php
                  input_pdselect2("id_agama",$cmd_agama,$id_agama);
                ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>No KTP &nbsp; <small><span style="font-weight:bold;" id="msg2"></span></small></label>
                <?php
                  input_textcustom("nik",$nik," required id='nik'
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "Masukkan No KTP","text");
                ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Status Perawat</label>
                <?php
                  input_pdselect2("status_perawat",$opsi_status_perawat,$status_perawat);
                ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>PK</label>
                <?php
                  input_pdselect2fleksibel("id_kode_kewenangan","id_kode_kewenangan",$kol_kode_kewenangan_null,"id_kode_kewenangan","nama_kode_kewenangan",$id_kode_kewenangan,"Belum Ada PK");
                ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Nomor Induk Karyawan</label>
                <?php
                  input_textcustom("nip",$nip,"  
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "Masukkan No Induk Karyawan","text");
                ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Jabatan Pegawai</label>
                <?php
                  input_pdselect2("tipe_pegawai",$cmd_tipe_pegawai,$tipe_pegawai);
                ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Jabatan Fungsional</label>
                <?php
                  input_pdselect2fleksibel("id_jabatan_fungsional","id_jabatan_fungsional",$cmd_jabfung,"id_jabatan_fungsional","nama_jabatan_fungsional",$id_jabatan_fungsional,"Tidak Ada Jabfung");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>DPK / DPW</label>
                <?php
                  input_pdselect2fleksibel("id_pengcab","id_pengcab",$null_pengcab,"id_pengcab","nama_pengcab",$id_pengcab,"Tidak Ada Pengcab");
                ?>
              </div>
            </div>    
            <div class="col-md-3">
              <div class="form-group">
                <label>Nomor Profesi (NIRA/PARI DLL)</label>
                <?php
                  input_textcustom("no_profesi",$no_profesi,"  
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "Masukkan No Profesi (PARI / NIRA DLL)","text");
                ?>
              </div>
            </div>  
            <div class="col-md-3">
              <div class="form-group">
                <label>No WA </label>
                <?php
                  input_textcustom("no_hp",$no_hp," required
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "Ketikkan No HP format kode negara","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Email</label>
                <?php
                  input_text("email",$email,"maxlength='255' ","Ketikkan Email","text");
                ?>
              </div>
            </div>          
            <div class="col-md-4">
              <div class="form-group">
                <label>Pendidikan Terakhir</label>
                <?php
                  input_pdselect2("id_pendidikan",$cmd_pendidikan,$id_pendidikan);
                ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Alamat</label>
                <?php
                  input_text("alamat",$alamat,"maxlength='255' ","Ketikkan Alamat","text");
                ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Status</label>
                <?php
                  input_pdselect2("status_pegawai",$cmd_status,$status_pegawai);
                ?>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
    <?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="level")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
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
            <th style="display:none;"></th>
            <th>Nama</th>
            <th>Level</th>
            <th>Username</th>
            <th style="width: 10%;">Status</th>
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
  <div class="modal-dialog">
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
elseif ($page=="level_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_daftar/level/simpan_edit');?>" onClick="return cek();">
       <input type="hidden" name="id_user" value="<?= $id; ?>">
       <input type="hidden" name="id_level_lama" value="<?= $id_level; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
          <div class="container col-md-12">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Level</label>
                  <?php
                  input_pdselect2("id_level",$ambil_user_level_member,$id_level);
                  ?>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Status</label>
                  <?php
                  input_pdselect2("status_user",$cmd_status,$status_user);
                  ?>
                </div>
              </div>
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
});
</script>
<?php
}
elseif ($page=="akses")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
      </h1>
    </section>
    <section class="content">
            <div class="col-md-12">
              <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                <div class="box-header with-border">
                   <h3 class="box-title">HAK AKSES LAINNYA</h3>

                  <div class="box-tools pull-right">
              <?php
         //       input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
              ?>
                  </div>
                </div>
                <div class="box-body">
              <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
                <thead>
                  <tr>
                    <th style="width:5%;display: none;">ID</th>
                    <th>Nama</th>
                    <th>Akses</th>
                    <th>Status</th>
                  </tr>
                </thead>
              </table>
                </div>
                <div class="box-footer">

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
elseif ($page=="akses_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_daftar/akses/simpan_tambah');?>" onClick="return cek();">
       <input type="hidden" name="barcode_pegawai" value="<?= $id; ?>">
       <input type="hidden" name="id_pegawai" value="<?= $id_pegawai; ?>">
     <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th><input name="select_all" class="checkall" type="checkbox" /></th>
                  <th>ID</th>
                  <th>Hak Akses</th>
                </tr>
              <?php
              foreach($hak_akses as $row){
              ?>
                <tr>
                  <td>
                    <div class="checkbox">
                    <label>
                      <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_akses'];?>">
                    </label>
                    </div>
                  </td>
                  <td><?= $row['id_akses'] ?></td>
                  <td><?= $row['nama_akses'] ?></td>
                </tr>
              <?php
              }
              ?>
              </table>
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
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
});
</script>
<?php
}
elseif ($page=="work")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>

          <div class="box-tools pull-right">
      <?php
  //      input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th style="display:none;"></th>
            <th style="width:30%;">Nama</th>
            <th style="width:10%;">Kategori</th>
            <th style="width:40%;">Alamat</th>
            <th style="width:10%;">Kontak</th>
            <th style="width:10%;">Email</th>
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
elseif ($page=="work_tambah")
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
      <?php echo form_open_multipart('ol_daftar/work/tambah',' id="signupform" ');
   //     input_text("barcode_registrasi",$id,"","","hidden");
      ?>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-3">
              <div class="form-group">
                <label>Nama</label>
                <?php
                  input_text("nama_working",$nama_working,"maxlength='255' required autofocus ","Ketikkan Nama","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Kategori</label>
                <?php
                  input_pdselect2("id_cara_masuk",$cmd_kategori_working,$id_cara_masuk);
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Email</label>
                <?php
                  input_text("email_working",$email_working,"maxlength='255' ","Ketikkan Email","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Telepon / Fax</label>
                <?php
                  input_text("kontak_working",$kontak_working,"maxlength='255' ","Ketikkan Tempat Lahir","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Alamat</label>
                <?php
                  input_text("alamat_working",$alamat_working,"maxlength='255' ","Ketikkan Alamat","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Propinsi</label>
                <?php
                  input_pdselect2fleksibel("id_prov","id_prov",$kol_provinsi,"id_prov","nama_prov",$id_prov,"Silahkan Pilih Provinsi Dulu");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Kota/Kabupaten</label>
                <?php
                  input_pdselect2("id_kab",$kab,$id_kab);
                //  echo form_dropdown('id_kab',$kab,'0',array('id'=>'id_kab','class'=>'form-control'));
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Kecamatan</label>
                <?php
                  input_pdselect2("id_kec",$kec,$id_kec);
                //  echo form_dropdown('id_kec',$kec,'0',array('id'=>'id_kec','class'=>'form-control'));
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Kelurahan</label>
                <?php
                  input_pdselect2("id_kel",$kel,$id_kel);
                //  echo form_dropdown('id_kel',$kel,'0',array('id'=>'id_kel','class'=>'form-control'));
                ?>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
    <?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="work_edit")
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
      <?php echo form_open_multipart('ol_daftar/work/edit/'.$id,' id="signupform" ');
        input_text("id_working",$id_working,"","","hidden");
      ?>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-3">
              <div class="form-group">
                <label>Nama</label>
                <?php
                  input_text("nama_working",$nama_working,"maxlength='255' required autofocus ","Ketikkan Nama","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Kategori</label>
                <?php
                  input_pdselect2("id_cara_masuk",$cmd_kategori_working,$id_cara_masuk);
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Email</label>
                <?php
                  input_text("email_working",$email_working,"maxlength='255' ","Ketikkan Email","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Telepon / Fax</label>
                <?php
                  input_text("kontak_working",$kontak_working,"maxlength='255' ","Ketikkan Tempat Lahir","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Alamat</label>
                <?php
                  input_text("alamat_working",$alamat_working,"maxlength='255' ","Ketikkan Alamat","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Propinsi</label>
                <?php
                  input_pdselect2fleksibel("id_prov","id_prov",$kol_provinsi,"id_prov","nama_prov",$id_prov,"Silahkan Pilih Provinsi Dulu");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Kota/Kabupaten</label>
                <?php
                  input_pdselect2("id_kab",$kab,$id_kab);
                //  echo form_dropdown('id_kab',$kab,'0',array('id'=>'id_kab','class'=>'form-control'));
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Kecamatan</label>
                <?php
                  input_pdselect2("id_kec",$kec,$id_kec);
                //  echo form_dropdown('id_kec',$kec,'0',array('id'=>'id_kec','class'=>'form-control'));
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Kelurahan</label>
                <?php
                  input_pdselect2("id_kel",$kel,$id_kel);
                //  echo form_dropdown('id_kel',$kel,'0',array('id'=>'id_kel','class'=>'form-control'));
                ?>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
    <?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="working")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>

          <div class="box-tools pull-right">
      <?php
   //     input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th style="display:none;"></th>
            <th>Nama</th>
            <th>Wilayah</th>
            <th>Instansi</th>
            <th>Status</th>
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
  <div class="modal-dialog">
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
elseif ($page=="unit")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('ol_daftar/unit/view/'.$id,' id="signupform" '); ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
    </div>
      <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Wilayah Kepengurusan</label>
              <?php
                input_pdselect2fleksibel("id_working","id_working",$ambil_data_rujukan_working_null,"id_working","nama_working",$id_working,"Semua");
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
           <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>

          <div class="box-tools pull-right">
      <?php
   //     input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th style="display:none;"></th>
            <th>Nama</th>
            <th>Instansi</th>
            <th>Status</th>
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
  <div class="modal-dialog">
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
elseif ($page=="unit_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_daftar/unit/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>
      </div>
        <div class="box-body">
            <div class="row">     
            <div class="col-md-12">
                <label>Instansi</label>
                <?php
                  input_pdselect2("id_instansi",$ambil_data_rujukan_working,$id_instansi);
                ?>
            </div>    
            <div class="col-md-12">
                <label>Nama</label>
                <?php
                  input_text("nama_unit",$nama_unit,"maxlength='255' ","Ketikkan Nama","text");
                ?>
            </div>   
              <div class="col-md-12">
                  <label>Status</label>
                  <?php
                  input_pdselect2("status_unit",$cmd_status,$status_unit);
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
});
</script>
<?php
}
elseif ($page=="unit_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_daftar/unit/simpan_edit');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            <input type="hidden" name="id_unit" value="<?= $id; ?>">
            <input type="hidden" name="nama_unit_lama" value="<?= $nama_unit; ?>">
          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>
      </div>
        <div class="box-body">
            <div class="row">         
            <div class="col-md-12">
                <label>Instansi</label>
                <?php
                  input_pdselect2("id_instansi",$ambil_data_rujukan_working,$id_instansi);
                ?>
            </div>    
            <div class="col-md-12">
                <label>Nama</label>
                <?php
                  input_text("nama_unit",$nama_unit,"maxlength='255' ","Ketikkan Nama","text");
                ?>
            </div>   
              <div class="col-md-12">
                  <label>Status</label>
                  <?php
                  input_pdselect2("status_unit",$cmd_status,$status_unit);
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
});
</script>
<?php
}
elseif ($page=="status_pegawai")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>

          <div class="box-tools pull-right">
      <?php
   //     input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th style="display:none;"></th>
            <th>Nama</th>
            <th>Status</th>
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
  <div class="modal-dialog">
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
elseif ($page=="working_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_daftar/working/simpan_edit');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            <input type="hidden" name="id_pegawai_instansi" value="<?= $id; ?>">
            <input type="hidden" name="id_pegawai" value="<?= $id_pegawai; ?>">
            <input type="hidden" name="id_instansi_lama" value="<?= $id_instansi; ?>">
          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>
      </div>
        <div class="box-body">
            <div class="row">         
            <div class="col-md-12">
                <label>Instansi</label>
                <?php
                  input_pdselect2("id_instansi",$ambil_data_rujukan_working,$id_instansi);
                ?>
            </div>   
              <div class="col-md-12">
                  <label>Status</label>
                  <?php
                  input_pdselect2("status_pegawai_instansi",$cmd_status,$status_pegawai_instansi);
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
});
</script>
<?php
}
elseif ($page=="status_pegawai_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_daftar/status_pegawai/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>
      </div>
        <div class="box-body">
            <div class="row">         
            <div class="col-md-12">
                <label>Nama</label>
                <?php
                  input_text("nama_status_pegawai",$nama_status_pegawai,"maxlength='255' ","Ketikkan Nama","text");
                ?>
            </div>   
              <div class="col-md-12">
                  <label>Status</label>
                  <?php
                  input_pdselect2("status",$cmd_status,$status);
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
});
</script>
<?php
}
elseif ($page=="status_pegawai_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_daftar/status_pegawai/simpan_edit');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            <input type="hidden" name="id_status_pegawai" value="<?= $id; ?>">
            <input type="hidden" name="kunci" value="<?= $kunci; ?>">
          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>
      </div>
        <div class="box-body">
            <div class="row">         
            <div class="col-md-12">
                <label>Nama</label>
                <?php
                  input_text("nama_status_pegawai",$nama_status_pegawai,"maxlength='255' ","Ketikkan Nama","text");
                ?>
            </div>   
              <div class="col-md-12">
                  <label>Status</label>
                  <?php
                  input_pdselect2("status",$cmd_status,$status);
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
});
</script>
<?php
}
elseif ($page=="kat_work")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>

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
            <th style="display:none;"></th>
            <th>Nama</th>
            <th>Status</th>
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
  <div class="modal-dialog">
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
elseif ($page=="kat_work_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_daftar/kat_work/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>
      </div>
        <div class="box-body">
            <div class="row">         
              <div class="col-md-12">
                  <label>Nama Kategori</label>
                  <?php
                    input_text("nama_kategori_work",$nama_kategori_work,"maxlength='255' ","Ketikkan Nama","text");
                  ?>
              </div>   
              <div class="col-md-12">
                  <label>Status</label>
                  <?php
                  input_pdselect2("status_kategori_work",$cmd_status,$status_kategori_work);
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
});
</script>
<?php
}
elseif ($page=="kat_work_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_daftar/kat_work/simpan_edit');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            <input type="hidden" name="id_kategori_work" value="<?= $id; ?>">
          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>
      </div>
        <div class="box-body">
            <div class="row">         
              <div class="col-md-12">
                  <label>Nama Kategori</label>
                  <?php
                    input_text("nama_kategori_work",$nama_kategori_work,"maxlength='255' ","Ketikkan Nama","text");
                  ?>
              </div>   
              <div class="col-md-12">
                  <label>Status</label>
                  <?php
                  input_pdselect2("status_kategori_work",$cmd_status,$status_kategori_work);
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
});
</script>
<?php
}
elseif ($page=="jabatan_pengurus")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>

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
            <th style="display:none;"></th>
            <th>Nama</th>
            <th>Status</th>
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
  <div class="modal-dialog">
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
elseif ($page=="jabatan_pengurus_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_daftar/jabatan_pengurus/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
          <div class="box-tools pull-right">
              <input type="hidden" name="id_prov" value="<?= $prov_id; ?>">
          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>
      </div>
        <div class="box-body">
            <div class="row">         
            <div class="col-md-12">
                <label>Nama Jabatan Pengurus</label>
                <?php
                  input_text("nama_ms_pengurus",$nama_ms_pengurus,"maxlength='255' ","Ketikkan Nama","text");
                ?>
            </div>   
              <div class="col-md-12">
                  <label>Status</label>
                  <?php
                  input_pdselect2("status_ms_pengurus",$cmd_status,$status_ms_pengurus);
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
});
</script>
<?php
}
elseif ($page=="jabatan_pengurus_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_daftar/jabatan_pengurus/simpan_edit');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            <input type="hidden" name="id_ms_pengurus" value="<?= $id; ?>">
            <input type="hidden" name="kunci" value="<?= $kunci; ?>">
          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>
      </div>
        <div class="box-body">
            <div class="row">         
            <div class="col-md-12">
                <label>Nama Jabatan Pengurus</label>
                <?php
                  input_text("nama_ms_pengurus",$nama_ms_pengurus,"maxlength='255' ","Ketikkan Nama","text");
                ?>
            </div>   
              <div class="col-md-12">
                  <label>Status</label>
                  <?php
                  input_pdselect2("status_ms_pengurus",$cmd_status,$status_ms_pengurus);
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
});
</script>
<?php
}
elseif ($page=="cabang")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>

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
            <th style="display:none;"></th>
            <th style="width: 15%;">Cabang</th>
            <th style="width: 15%;">Kota</th>
            <th style="width: 15%;">Ranting</th>           
            <th>Alamat</th>
            <th>Status</th>
            <th>Kop</th>
            <th>Stempel</th>
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
elseif ($page=="cabang_tambah")
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
      <?php echo form_open_multipart('ol_daftar/cabang/tambah',' id="signupform" ');
   //     input_text("barcode_registrasi",$id,"","","hidden");
      ?>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-2">
              <div class="form-group">
                <label>Upload Kop Surat</label>
                <?php
                  input_textcustom("upload_Files[]","","class='form-control-file' id='exampleInputFile' ","","file");
                ?>
                <p class="help-block">gif, png, jpg, jpeg</p>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Jabatan Profesi</label>
                <?php
                  input_pdselect2("id_jabatan",$cmd_jabatan,$id_jabatan);
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Cabang Kepengurusan</label>
                <?php
                  input_pdselect2fleksibel("id_cabang","id_cabang",$ambil_data_pengcab,"id_pengcab","nama_pengcab",$id_cabang,"PARENT");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Propinsi Kepengurusan</label>
                <?php
                  input_pdselect2fleksibel("id_prov","id_prov",$kol_provinsi,"id_prov","nama_prov",$id_prov,"Pilih Provinsi Dulu");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Kota/Kabupaten</label>
                <?php
                  input_pdselect2("id_kab",$kab,$id_kab);
                //  echo form_dropdown('id_kab',$kab,'0',array('id'=>'id_kab','class'=>'form-control'));
                ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Nama</label>
                <?php
                  input_text("nama_pengcab",$nama_pengcab,"maxlength='255' required autofocus ","Ketikkan Nama","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Email</label>
                <?php
                  input_text("email_pengcab",$email_pengcab,"maxlength='255' ","Ketikkan Email","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Telepon / Fax</label>
                <?php
                  input_text("kontak_pengcab",$kontak_pengcab,"maxlength='255' ","Ketikkan No Telepon","text");
                ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Alamat</label>
                <?php
                  input_text("alamat_pengcab",$alamat_pengcab,"maxlength='255' ","Ketikkan Alamat","text");
                ?>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
    <?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="cabang_edit")
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
      <?php echo form_open_multipart('ol_daftar/cabang/edit/'.$id,' id="signupform" ');
        input_text("id_pengcab",$id_pengcab,"","","hidden");
      ?>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-2">
              <div class="form-group">
                <label>Upload Kop Surat</label>
                <?php
                  input_textcustom("upload_Files[]","","class='form-control-file' id='exampleInputFile' ","","file");
                ?>
                <p class="help-block">gif, png, jpg, jpeg</p>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Cabang Kepengurusan</label>
                <?php
                  input_pdselect2fleksibel("id_cabang","id_cabang",$ambil_data_pengcab,"id_pengcab","nama_pengcab",$id_cabang,"PARENT");
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Propinsi Kepengurusan</label>
                <?php
                  input_pdselect2fleksibel("id_prov","id_prov",$kol_provinsi,"id_prov","nama_prov",$id_prov,"Pilih Provinsi Dulu");
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Kota/Kabupaten</label>
                <?php
                  input_pdselect2("id_kab",$kab,$id_kab);
                //  echo form_dropdown('id_kab',$kab,'0',array('id'=>'id_kab','class'=>'form-control'));
                ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Nama</label>
                <?php
                  input_text("nama_pengcab",$nama_pengcab,"maxlength='255' required autofocus ","Ketikkan Nama","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Email</label>
                <?php
                  input_text("email_pengcab",$email_pengcab,"maxlength='255' ","Ketikkan Email","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Telepon / Fax</label>
                <?php
                  input_text("kontak_pengcab",$kontak_pengcab,"maxlength='255' ","Ketikkan No Telepon","text");
                ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Alamat</label>
                <?php
                  input_text("alamat_pengcab",$alamat_pengcab,"maxlength='255' ","Ketikkan Alamat","text");
                ?>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
    <?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="cabang_stempel")
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
      <?php echo form_open_multipart('ol_daftar/cabang/stempel/'.$id,' id="signupform" ');
        input_text("id_pengcab",$id_pengcab,"","","hidden");
      ?>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-2">
              <div class="form-group">
                <label>Upload Stempel Surat</label>
                <?php
                  input_textcustom("upload_Files[]","","class='form-control-file' id='exampleInputFile' ","","file");
                ?>
                <p class="help-block">gif, png, jpg, jpeg</p>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Cabang Kepengurusan</label>
                <?php
                  input_pdselect2fleksibel("id_cabang","id_cabang",$ambil_data_pengcab,"id_pengcab","nama_pengcab",$id_cabang,"PARENT");
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Propinsi Kepengurusan</label>
                <?php
                  input_pdselect2fleksibel("id_prov","id_prov",$kol_provinsi,"id_prov","nama_prov",$id_prov,"Pilih Provinsi Dulu");
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Kota/Kabupaten</label>
                <?php
                  input_pdselect2("id_kab",$kab,$id_kab);
                //  echo form_dropdown('id_kab',$kab,'0',array('id'=>'id_kab','class'=>'form-control'));
                ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Nama</label>
                <?php
                  input_text("nama_pengcab",$nama_pengcab,"maxlength='255' required autofocus ","Ketikkan Nama","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Email</label>
                <?php
                  input_text("email_pengcab",$email_pengcab,"maxlength='255' ","Ketikkan Email","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Telepon / Fax</label>
                <?php
                  input_text("kontak_pengcab",$kontak_pengcab,"maxlength='255' ","Ketikkan No Telepon","text");
                ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Alamat</label>
                <?php
                  input_text("alamat_pengcab",$alamat_pengcab,"maxlength='255' ","Ketikkan Alamat","text");
                ?>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
    <?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="pegawai_pengurus")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('ol_daftar/pegawai_pengurus/view/'.$id,' id="signupform" '); ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
    </div>
      <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Wilayah Kepengurusan</label>
              <?php
                input_pdselect2fleksibel("id_pengcab","id_pengcab",$ambil_data_pengcab,"id_pengcab","nama_pengcab",$id,"Pilih Wilayah Kepengurusan");
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
           <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>

          <div class="box-tools pull-right">
            <?php
      //        input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
            ?>
          </div>
        </div>
        <div class="box-body">
        <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
          <thead>
            <tr>
              <th style="display:none;"></th>
              <th>Wilayah</th>
              <th>Pengurus</th>
              <th>Nama</th>
              <th>Signature</th>
              <th>Status</th>
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
elseif ($page=="pengurus")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('ol_daftar/pengurus/view/'.$id,' id="signupform" '); ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
    </div>
      <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Wilayah Kepengurusan</label>
              <?php
                input_pdselect2fleksibel("id_pengcab","id_pengcab",$ambil_data_pengcab,"id_pengcab","nama_pengcab",$id,"Pilih Wilayah Kepengurusan");
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
           <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>

          <div class="box-tools pull-right">
            <?php
      //        input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
            ?>
          </div>
        </div>
        <div class="box-body">
        <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
          <thead>
            <tr>
              <th style="display:none;"></th>
              <th>Wilayah</th>
              <th style="width:10%;">Status Wilayah</th>
              <th>Nama Kepengurusan</th>
              <th>Status Kepengurusan</th>
              <th>Status Pengurus</th>
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
  <div class="modal-dialog">
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
elseif ($page=="pengurus_tambah")
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
      <?php echo form_open_multipart('ol_daftar/pengurus/tambah',' id="signupform" ');
    //    input_text("id_pengcab",$id_pengcab,"","","hidden");
      ?>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Nama Kepengurusan</label>
              <?php
                input_pdselect2("id_ms_pengurus",$ambil_data_ms_pengurus_no_null,$id_ms_pengurus);
              ?>
            </div>
          </div>
          <div class="col-md-12">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="width:5%;background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Wilayah</th>
              </tr>
              </thead>
              <tbody>
                <?php
                foreach($ambil_data_dropdown_pengcab as $row){
                ?>
              <tr>
                <td style="vertical-align:middle;text-align: center;">
                  <div class="checkbox">
                  <label>
                    <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_pengcab'];?>">
                  </label>
                  </div>
                </td>
                <td style="vertical-align:middle;"><?php echo $row['nama_pengcab']; ?></td>
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
        <div class="box-footer">
          <button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
    <?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="pengurus_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_daftar/pengurus/simpan_edit');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            <input type="hidden" name="id_pengurus" value="<?= $id; ?>">
            <input type="hidden" name="id_pengcab" value="<?= $id_pengcab; ?>">
            <input type="hidden" name="id_ms_pengurus_lama" value="<?= $id_ms_pengurus; ?>">
          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>
      </div>
        <div class="box-body">
            <div class="row">         
            <div class="col-md-12">
                <label>Nama Kepengurusan</label>
                <?php
                  input_pdselect2("id_ms_pengurus",$ambil_data_ms_pengurus_no_null,$id_ms_pengurus);
                ?>
            </div>   
              <div class="col-md-12">
                  <label>Status</label>
                  <?php
                  input_pdselect2("status_pengurus",$cmd_status,$status_pengurus);
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
});
</script>
<?php
}
elseif ($page=="pengurus_tambah_pengurus")
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
      <?php echo form_open_multipart('ol_daftar/pengurus/tambah_pengurus/'.$id,' id="signupform" ');
        input_text("barcode_pengurus",$id,"","","hidden");
        input_text("id_pengurus",$id_pengurus,"","","hidden");
      ?>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-6">
              <div class="form-group">
                <label>Upload Tanda Tangan</label>
                <?php
                  input_textcustom("upload_Files[]","","class='form-control-file' id='exampleInputFile' ","","file");
                ?>
                <p class="help-block">Saran png</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Nama Pengurus</label>
                <?php
                  input_pdselect2("id_pegawai",$ambil_data_dropdown_pegawai,$id_pegawai);
                ?>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
    <?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="pegawai_pengurus_tambah")
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
      <?php echo form_open_multipart('ol_daftar/pegawai_pengurus/tambah',' id="signupform" ');
  //      input_text("barcode_pengurus",$id,"","","hidden");
  //      input_text("id_pengurus",$id_pengurus,"","","hidden");
      ?>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-4">
              <div class="form-group">
                <label>Upload Tanda Tangan</label>
                <?php
                  input_textcustom("upload_Files[]","","class='form-control-file' id='exampleInputFile' ","","file");
                ?>
                <p class="help-block">Saran png</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Jabatan Pengurus</label>
                <?php
                  input_pdselect2("id_pengurus",$ambil_data_pengurus_master_no_null,$id_pengurus);
                ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Nama Pengurus</label>
                <?php
                  input_pdselect2("id_pegawai",$ambil_data_dropdown_pegawai,$id_pegawai);
                ?>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
    <?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="pegawai_pengurus_edit")
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
      <?php echo form_open_multipart('ol_daftar/pegawai_pengurus/edit/'.$id,' id="signupform" ');
        input_text("barcode_pegawai_pengurus",$id,"","","hidden");
        input_text("id_pegawai_pengurus",$id_pegawai_pengurus,"","","hidden");
        input_text("id_pegawai",$id_pegawai,"","","hidden");
      ?>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-4">
              <div class="form-group">
                <label>Upload Tanda Tangan</label>
                <?php
                  input_textcustom("upload_Files[]","","class='form-control-file' id='exampleInputFile' ","","file");
                ?>
                <p class="help-block">Saran png</p>
              </div>
            </div>
            <div class="col-md-6">
                <label>Status</label>
                <?php
                input_pdselect2("status_pegawai_pengurus",$cmd_status,$status_pegawai_pengurus);
                ?>
            </div>            
          </div>
        </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
    <?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="kategori_surat")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>

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
            <th style="display:none;"></th>
            <th>Nama</th>
            <th>Status</th>
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
  <div class="modal-dialog">
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
elseif ($page=="kategori_surat_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_daftar/kategori_surat/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
          <div class="box-tools pull-right">
              
          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>
      </div>
        <div class="box-body">
            <div class="row">         
            <div class="col-md-12">
                <label>Nama Kategori</label>
                <?php
                  input_text("nama_kategori",$nama_kategori,"maxlength='255' ","Ketikkan Nama","text");
                ?>
            </div>   
              <div class="col-md-12">
                  <label>Status</label>
                  <?php
                  input_pdselect2("status_kategori",$cmd_status,$status_kategori);
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
});
</script>
<?php
}
elseif ($page=="kategori_surat_edit")
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
      <?php echo form_open_multipart('ol_daftar/kategori_surat/edit/'.$id,' id="signupform" ');
        input_text("barcode_kategori",$id,"","","hidden");
        input_text("id_kategori",$id_kategori,"","","hidden");
        input_text("kunci",$kunci,"","","hidden");
      ?>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>
      </div>
        <div class="box-body">
          <div class="row">         
            <div class="col-md-6">
                <label>Nama Kategori</label>
                <?php
                  input_text("nama_kategori",$nama_kategori,"maxlength='255' ","Ketikkan Nama","text");
                ?>
            </div>   
            <div class="col-md-6">
                <label>Status</label>
                <?php
                input_pdselect2("status_kategori",$cmd_status,$status_kategori);
                ?>
            </div>
            <div class="col-md-12">
                <label>Syarat Pengajuan</label>
                <?php
                  input_textareacustom("syarat_kategori",$syarat_kategori," id='editor2' rows='10' cols='100' class='form-control' ","Masukkan Syarat");
                ?>
            </div>
          </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
    <?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="kategori_berkas")
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
      <?php
    //    input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th width="5%" style="display:none;">ID</th>
            <th>Nama</th>
                        <th>Status</th>
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
elseif ($page=="kategori_berkas_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_daftar/kategori_berkas/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
        <div class="col-md-12">
          <div class="form-group">
            <label>Nama</label>
            <?php
              input_text("nama_kategori_berkas",$nama_kategori_berkas,"maxlength='255' required autofocus","Masukkan Nama","text");
            ?>  
          </div>
        </div>    
        <div class="col-md-12">
          <div class="form-group">
            <label>Status</label>
            <?php
              input_pdselect2("status_kategori_berkas",$cmd_status,$status_kategori_berkas);
            ?>  
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
}); 
</script>
<?php
}
elseif ($page=="kategori_berkas_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_daftar/kategori_berkas/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_kategori_berkas" value="<?= $id; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
        <div class="col-md-12">
          <div class="form-group">
            <label>Nama</label>
            <?php
              input_text("nama_kategori_berkas",$nama_kategori_berkas,"maxlength='255' required autofocus","Masukkan Nama","text");
            ?>  
          </div>
        </div>    
        <div class="col-md-12">
          <div class="form-group">
            <label>Status</label>
            <?php
              input_pdselect2("status_kategori_berkas",$cmd_status,$status_kategori_berkas);
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
}); 
</script>
<?php
}
elseif ($page=="kategori_pelatihan")
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
      <?php
   //     input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th style="display:none;">ID</th>
            <th>Nama</th>
                        <th>Status</th>
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
elseif ($page=="kategori_pelatihan_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_daftar/kategori_pelatihan/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
        <div class="col-md-12">
          <div class="form-group">
            <label>Nama</label>
            <?php
              input_text("nama_kategori_pelatihan",$nama_kategori_pelatihan,"maxlength='255' required autofocus","Masukkan Nama","text");
            ?>  
          </div>
        </div>    
        <div class="col-md-12">
          <div class="form-group">
            <label>Status</label>
            <?php
              input_pdselect2("status_kategori_pelatihan",$cmd_status,$status_kategori_pelatihan);
            ?>  
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
}); 
</script>
<?php
}
elseif ($page=="kategori_pelatihan_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_daftar/kategori_pelatihan/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_kategori_pelatihan" value="<?= $id; ?>">
    <input type="hidden" name="nama_kategori_pelatihan_lama" value="<?= $nama_kategori_pelatihan; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
        <div class="col-md-12">
          <div class="form-group">
            <label>Nama</label>
            <?php
              input_text("nama_kategori_pelatihan",$nama_kategori_pelatihan,"maxlength='255' required autofocus","Masukkan Nama","text");
            ?>  
          </div>
        </div>    
        <div class="col-md-12">
          <div class="form-group">
            <label>Status</label>
            <?php
              input_pdselect2("status_kategori_pelatihan",$cmd_status,$status_kategori_pelatihan);
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
}); 
</script>
<?php
}
elseif ($page=="kategori_surat_ms_pengurus")
{
?>
      <div class="row">
        <div class="col-md-12">
    <FORM method="POST" class="form-horizontal" action="<?php echo base_url('ol_daftar/kategori_surat/simpan_ms_pengurus');?>" onClick="return cek();">
          <input type="hidden" name="id_kategori" value="<?= $id; ?>">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
        <div class="col-md-12">
          <h5></h5>
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                  <tr>
                  <th style="background-color:#9b0e27;color:white;vertical-align:middle;width:5%;">
                    <input name="select_all" class="checkall" type="checkbox" />
                  </th>
                  <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Nama</th>
                  </tr>
              </thead>
              <tbody>   
                <?php
                  foreach($ambil_data_ms_pengurus_no_admin as $rowambil_data_ms_pengurus_no_admin){
                ?>
              <tr>
                  <td style="vertical-align:middle;width:10%">
                    <div class="checkbox">
                    <label>
                      <input type="checkbox" class="child" name="chk[]" value="<?= $rowambil_data_ms_pengurus_no_admin['id_ms_pengurus']; ?>" <?php if(in_array($rowambil_data_ms_pengurus_no_admin['id_ms_pengurus'],explode(",", $ttd_kategori))) echo 'checked="checked"'; ?> >
                    </label>
                    </div>        
                  </td>
                  <td style="vertical-align:middle;"><?= $rowambil_data_ms_pengurus_no_admin['nama_ms_pengurus'];?></td>
              </tr> 
                <?php
                  }
                ?>
              </tbody>
            </table> 
        </div>
              </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
          </div>
    </div>  
    </FORM>
    </div>
<script type="text/javascript">
    $(document).ready(function() {
    $('.checkall').on('click', function() {
      $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      "initComplete": function (settings, json) {  
      $("#example1").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
      },
      'paging'        : false,
      'lengthChange'  : false,
      'searching'     : false,
      'ordering'      : false,
      'info'          : true,
//    'scrollX'     : true,
//    'scrollY'     : '500px',
    'scrollCollapse'  : true
    })
  });
</script>
<?php
}
elseif ($page=="pengajuan_korespodensi")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('ol_daftar/pengajuan_korespodensi/view/'.$id,' id="signupform" '); ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
    </div>
      <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Nama</label>
              <?php
                input_pdselect2fleksibel("id_pegawai","id_pegawai",$ambil_data_dropdown_pegawai,"id_pegawai","nama_pegawai",$id,"SEMUA");
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
            <th width="5%" style="display;none;"></th>
            <th>Tanggal</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Wilayah</th>
            <th>No Surat</th>
            <th>Status</th>
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
elseif ($page=="pengajuan_korespodensi_validasi")
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
           <h3 class="box-title">
      <?php echo $title; ?> <small style="color:white;font-weight:bold;"></small>
       </h3>
        </div>
        <div class="box-body">
    <?php echo form_open_multipart('ol_daftar/pengajuan_korespodensi/validasi/'.$id,' ');
    input_text("id_korespodensi",$id_korespodensi,"","","hidden");
 //   input_text("id_kategori",$id_kategori,"","","hidden");
    if(empty($foto_pengaju)){
      $url_thumbx=base_url().'assets/images/noavatar.jpg';
      $url_picbesarx=base_url().'assets/images/noavatar.jpg';
    }else{
      $cek_filesmall=FCPATH.'assets/foto/ol/'.$foto_pengaju;
      if(file_exists($cek_filesmall)){
        $url_thumbx=base_url().'assets/foto/ol/'.$foto_pengaju;
        $url_picbesarx=base_url().'assets/foto/ol/'.$foto_pengaju;
      }else{
        $url_thumbx=base_url().'assets/images/noavatar.jpg';
        $url_picbesarx=base_url().'assets/images/noavatar.jpg';
      }
    }
$arraywarna = array('red','navy','yellow','maroon','olive','purple','aqua','lightblue','blue','green','teal','lime','orange','fuchsia');
      ?>
      <div class="row">
      <div class="col-md-6">
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
               <h3 class="box-title">
              BERKAS <small style="color:white;font-weight:bold;">  </small>
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
                  <a href="<?php echo base_url('assets/berkas/ol/'.$row['link_berkas']);?>" target="_blank" class="btn bg-maroon btn-xs">
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
                  <a href="<?php echo base_url('assets/berkas/ol/'.$row2['link_berkas']);?>" target="_blank" class="btn bg-maroon btn-xs">
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
            <td colspan="2" style="background-color:#9b0e27;color:white;text-weight:bold;">BERKAS</td>
            </tr>
              <?php
              if($sertifikat!==""){
                foreach($ambil_berkas_data as $row3){
                  if (in_array($row3['id_berkas'],$id_sertifikat)) {
              ?>
                <tr>
                <td width="5%"><input name="id_4_sertifikat[]" value="<?php echo $row3['id_berkas']; ?>" checked="checked" type="checkbox"> </td>
                <td class="mailbox-name">
                  <a href="<?php echo base_url('assets/berkas/ol/'.$row3['link_berkas']);?>" target="_blank" class="btn bg-maroon btn-xs">
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
                  <a href="<?php echo base_url('assets/berkas/ol/'.$row4['link_berkas']);?>" target="_blank" class="btn bg-maroon btn-xs">
                    <i class="fa fa-file-text"></i> <?php echo $row4['nama_berkas']; ?>
                  </a>
                </td>
                </tr>
              <?php
                  }
                }
              }
              ?>
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
           <i class="fa fa-search"></i> KLIK BERKAS UNTUK MELIHAT
          </div>
          <!-- /.pull-right -->
          </div>
        </div>
            </div>
          </div>
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
               <h3 class="box-title">PRINT SURAT</h3>

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
                <th width="5%" style="display;none;"></th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Asal</th>
              </tr>
            </thead>
          </table>
            </div>
          </div>
            <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
              <div class="box-header with-border">
                 <h3 class="box-title">SYARAT PENGAJUAN</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                          title="Collapse">
                    <i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="box-body">
                <h4>                   <?php 
                          $syarat_kategori = strip_tags($syarat_kategori); 
                          $syarat_kategori = html_entity_decode($syarat_kategori); 
                          echo $syarat_kategori;  
                  ?> </h4>
              </div>
            </div>
        </div>
        <div class="col-md-6">
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">
            TIME LINE PENGAJUAN <small style="color:white;font-weight:bold;"></small>
            </h3>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <!-- The time line -->
                  <ul class="timeline">
                    <li class="time-label">
                          <span class="bg-<?php echo $arraywarna[array_rand($arraywarna)]; ?>">
                            <i class="fa fa-envelope"></i> &nbsp;<?= strtoupper($nama_kategori) ?>
                          </span>
                    </li>
                    <li>
                      <i class="fa fa-file-text bg-<?php echo $arraywarna[array_rand($arraywarna)]; ?>"></i>
                      <div class="timeline-item">
                        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                          <div class="box-header with-border">
                             <h3 class="box-title">DATA SURAT</h3>
                            <div class="box-tools pull-right">ISI NO SURAT DAN SIFAT SURAT</div>
                          </div>
                          <div class="box-body">
                            <div class="form-group">
                              <label>No Surat</label>
                              <?php
                                input_text("no_korespodensi","$no_korespodensi","maxlength='255' required autofocus ","Ketikkan No Surat","text");
                              ?>
                            </div>
                            <div class="form-group">
                              <label>Sifat Surat</label>
                              <?php
                                input_pdselect2("sifat_surat",$cmd_sifat_surat,$sifat_surat);
                              ?>
                            </div>
                          </div>
                          <div class="box-footer">
                              <button type="submit" class="setuju btn btn-primary btn-sm">Submit</button>
                          </div>
                          <?php echo form_close(); ?>
                        </div>
                      </div>
                    </li>
                    <li>
                      <i class="fa fa-user bg-<?php echo $arraywarna[array_rand($arraywarna)]; ?>"></i>
                      <div class="timeline-item">
                        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                          <div class="box-header with-border">
                             <h3 class="box-title">DATA PENGIRIM</h3>
                              <div class="box-tools pull-right"><i class="fa fa-clock-o"></i> <?= $wkt_korespodensi; ?></div>
                          </div>
                          <div class="box-body">
                            <div class="row">
                              <div class="col-md-8">
                                <p>Nama : <?php echo $nama_pengaju; ?></p>  
                                <p>Gender : <?= $jk; ?></p>        
                                <p>Umur : <?= $umur; ?></p>   
                                <p>Tempat Bekerja : <?= $tempat_kerja; ?></p>        
                              </div>
                              <div class="col-md-4">
                                  <a class="example-image-link" href="<?php echo $url_picbesarx; ?>"
                                    data-lightbox="example-set" data-title="<?php echo $nama_pengaju; ?>">
                                    <img class="profile-user-img img-responsive img-circle"
                                      src="<?php echo $url_thumbx; ?>" style="width:75px" alt="User profile picture">
                                  </a>              
                              </div>
                            </div>
                          </div>
                          <div class="box-footer">
                              <?php  
                                if ($status_korespodensi == 0) {
                                   echo '<a class="btn btn-xs btn-warning">STATUS : REGISTRASI</a>';
                                } else if($status_korespodensi == 1){
                                   echo '<a class="btn btn-xs btn-info">STATUS : PROSES</a>';
                                } else if($status_korespodensi == 2){
                                   echo '<a class="btn btn-xs btn-primary">STATUS : Validasi</a>';
                                } else if($status_korespodensi == 3){
                                   echo '<a class="btn btn-xs btn-success">STATUS : Selesai</a>';
                                } else {
                                   echo '<a class="btn btn-xs btn-danger">STATUS : Ditolak</a>';
                                }
                              ?>
                          </div>
                        </div>
                      </div>
                    </li>
                    <!-- /.timeline-label -->
                    <!-- timeline item -->
                    <li>
                      <i class="fa fa-envelope bg-<?php echo $arraywarna[array_rand($arraywarna)]; ?>"></i>
                      <div class="timeline-item">
                        <div class="timeline-body">
                          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                            <div class="box-header with-border">
                               <h3 class="box-title">TAMBAH SURAT</h3>
                                <div class="box-tools pull-right">MISAL SURAT BALASAN</div>
                            </div>
                            <div class="box-body">
                              <p>Silahkan Pilih Surat Lainnya misalkan perlu balasan</p>
                            </div>
                            <div class="box-footer">
<button type="button" class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?> btn-xs OpenTambahKat" data-toggle="tooltip" data-placement="right" data-id="<?php echo $id_korespodensi; ?>" data-id2="<?php echo $barcode_korespodensi; ?>"
  title="Pilih Kategori Surat" data-toggle="modal" data-target="#exampleModal">
  Tambah Surat
</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                <?php
                  $ambil_kategori_tambah = $this->m_ol_rancak->ambil_kategori_tambah($id_korespodensi);
                  foreach($ambil_kategori_tambah as $rowambil_kategori_tambah){
                ?>
                    <li class="time-label">
                        <span class="bg-<?php echo $arraywarna[array_rand($arraywarna)]; ?>">
                           <?= $rowambil_kategori_tambah['nama_kategori']; ?>
                        </span>
                    </li>
                    <li>
                      <i class="fa fa-send bg-<?php echo $arraywarna[array_rand($arraywarna)]; ?>"></i>

                      <div class="timeline-item">
                          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                            <div class="box-header with-border">
                               <h3 class="box-title"><b><?= $rowambil_kategori_tambah['nama_kategori']; ?></b></h3>
                                <div class="box-tools pull-right"></div>
                            </div>
                            <div class="box-body">
                                <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                                  <div class="box-header with-border">
                                     <h3 class="box-title">TAMBAH VALIDATOR SURAT</h3>

                                      <div class="box-tools pull-right"><b><?= $rowambil_kategori_tambah['nama_kategori']; ?></b></div>
                                  </div>
                                  <div class="box-body text-right">Asal : <?= $rowambil_kategori_tambah['asale']; ?><br>Tujuan : <?= $rowambil_kategori_tambah['tujuane']; ?>
                                    <p>Silahkan Pilih Validator sesuai dengan signature yang diperlukan di surat</p>
<a class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>"><?= $rowambil_kategori_tambah['nama_kategori']; ?></a>
                                    
                                  </div>
                                  <div class="box-footer">
<button type="button" class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?> btn-xs OpenPengurus" data-toggle="tooltip" data-placement="right" data-id="<?php echo $rowambil_kategori_tambah['id_kor_kategori']; ?>" data-id2="<?php echo $barcode_korespodensi; ?>"
  title="Pilih Validator" data-toggle="modal" data-target="#exampleModal">
  Pilih Validator
</button>
          <div class="pull-right">
<a href="<?php echo base_url('ol_daftar/pengajuan_korespodensi/hapus_kor_kategori/'.$rowambil_kategori_tambah['id_kor_kategori']);?>/<?= $id ?>"  onclick="confirmation(event)" class="btn btn-danger btn-xs">
  <i class="fa fa-trash"></i>
  <span>Hapus</span>
</a> &nbsp; || &nbsp;
<a href="<?php echo base_url('ol_daftar/pengajuan_korespodensi/print/'); ?><?= $id ?>/<?= $rowambil_kategori_tambah['barcode_kor_kategori'] ?>"  class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?> btn-xs">
  <i class="fa fa-file-pdf-o"></i> REQ PRINT
</a>
          </div>
                                  </div>
                                </div>
                <?php
                  $ambil_kor_detil_pengcab = $this->m_ol_rancak->ambil_kor_detil_pengcab($rowambil_kategori_tambah['id_kor_kategori']);
                  foreach($ambil_kor_detil_pengcab as $rowambil_data_pengurus_pengcab){
                      if(empty($rowambil_data_pengurus_pengcab['foto'])){
                        $url_thumbxpp=base_url().'assets/images/noavatar.jpg';
                        $url_picbesarxpp=base_url().'assets/images/noavatar.jpg';
                      }else{
                        $cek_filesmall=FCPATH.'assets/foto/ol/'.$rowambil_data_pengurus_pengcab['foto'];
                        if(file_exists($cek_filesmall)){
                          $url_thumbxpp=base_url().'assets/foto/ol/'.$rowambil_data_pengurus_pengcab['foto'];
                          $url_picbesarxpp=base_url().'assets/foto/ol/'.$rowambil_data_pengurus_pengcab['foto'];
                        }else{
                          $url_thumbxpp=base_url().'assets/images/noavatar.jpg';
                          $url_picbesarxpp=base_url().'assets/images/noavatar.jpg';
                        }
                      }
                ?>
                                <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                                  <div class="box-header with-border">
                                     <h3 class="box-title">DATA VALIDATOR</h3>
                                      <div class="box-tools pull-right"><b><?= $rowambil_kategori_tambah['nama_kategori']; ?></b></div>
                                  </div>
                                  <div class="box-body">
                                  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                                    <div class="box-header with-border">
                                       <h3 class="box-title"><?= $rowambil_data_pengurus_pengcab['nama_pengcab']; ?></h3>
                                        <div class="box-tools pull-right"></div>
                                    </div>
                                    <div class="box-body">
                          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                            <div class="box-header with-border">
                               <h3 class="box-title"><?= $rowambil_data_pengurus_pengcab['nama_pegawai_pengurus']; ?></h3>
                                <div class="box-tools pull-right">

                                </div>
                            </div>
                            <div class="box-body">
                                      <div class="row">
                                        <div class="col-md-8">
                                          <h5>Disposisi : <?= $rowambil_data_pengurus_pengcab['disposisi']; ?></h5>  
                          <?php
                            if($rowambil_data_pengurus_pengcab['acc'] == 0){
                              echo '<button class="btn btn-xs btn-warning"> Belum ACC</button>';
                            }else if($rowambil_data_pengurus_pengcab['acc'] == 1){
                              echo '<button class="btn btn-xs btn-success"> ACC</button>';
                            }else{
                              echo '<button class="btn btn-xs btn-danger"> Di Tolak</button>';
                            }
                          ?>      
                                        </div>
                                        <div class="col-md-4">
                                <a class="example-image-link" href="<?php echo $url_picbesarxpp; ?>"
                                  data-lightbox="example-set" data-title="<?php echo $rowambil_data_pengurus_pengcab['nama_pegawai']; ?>">
                                  <img class="profile-user-img img-responsive img-circle"
                                    src="<?php echo $url_thumbx; ?>" style="width:75px" alt="User profile picture">
                                </a>              
                                        </div>
                                      </div>
                            </div>
                            <div class="box-footer">
<a class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="right" 
  href="<?php echo base_url('ol_daftar/pengajuan_korespodensi/acctolak/0/'.$rowambil_data_pengurus_pengcab['id_kor_detil']);?>/<?= $id ?>">
  Proses
</a> &nbsp||&nbsp;
<a class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="right" 
  href="<?php echo base_url('ol_daftar/pengajuan_korespodensi/acctolak/1/'.$rowambil_data_pengurus_pengcab['id_kor_detil']);?>/<?= $id ?>">
  ACC
</a> &nbsp||&nbsp;
<a class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="right" 
  href="<?php echo base_url('ol_daftar/pengajuan_korespodensi/acctolak/2/'.$rowambil_data_pengurus_pengcab['id_kor_detil']);?>/<?= $id ?>">
  Tolak
</a>
                            </div>
                          </div>
                                    </div>
                                    <div class="box-footer">




<a href="<?php echo base_url('ol_daftar/pengajuan_korespodensi/hapus_ttd/'.$rowambil_data_pengurus_pengcab['id_kor_detil']);?>/<?= $id ?>"  onclick="confirmation(event)" class="btn btn-danger btn-xs">
  <i class="fa fa-trash"></i>
  <span>Hapus <?= $rowambil_data_pengurus_pengcab['nama_pegawai']; ?></span>
</a> 
                                    </div>
                                  </div>
                                  </div>
                                  <div class="box-footer">

                                  </div>
                                </div> 
                <?php
                  }
                }
                ?>                                                                 
                            </div>
                            <div class="box-footer">

                            </div>
                          </div>
                      </div>
                    </li>
                    <li>
                      <i class="fa fa-clock-o bg-<?php echo $arraywarna[array_rand($arraywarna)]; ?>"></i>
                    </li>
                  </ul>
                </div>
                <!-- /.col -->
              </div>
            </div>
          </div>
        </div>
      </div>
        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $header; ?> <small><?php echo $instance_name; ?></small></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php
}
elseif ($page=="pengajuan_korespodensi_pengcab")
{
?>
      <div class="row">
        <div class="col-md-12">
    <FORM method="POST" class="form-horizontal" action="<?php echo base_url('ol_daftar/pengajuan_korespodensi/simpan_pengcab');?>" onClick="return cek();">
          <input type="hidden" name="barcode_korespodensi" value="<?= $id; ?>">
          <input type="hidden" name="id_korespodensi" value="<?= $id_korespodensi; ?>">
          <input type="hidden" name="id_kategori" value="<?= $id_kategori; ?>">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
        <div class="col-md-12">
          <h5>JIKA TIDAK MUNCUL PASTIKAN PENGURUS WILAYAH TERSEBUT SUDAH MASUK JABATAN ORGANISASI (KETUA DAN SEKRETARIS)</h5>
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                  <tr>
                  <th style="background-color:#9b0e27;color:white;vertical-align:middle;width:5%;">
                    <input name="select_all" class="checkall" type="checkbox" />
                  </th>
                  <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Nama</th>
                  </tr>
              </thead>
              <tbody>   
                <?php
                  foreach($ambil_data_pengcab as $rowambil_data_pengcab){
                ?>
              <tr>
                  <td style="vertical-align:middle;width:10%">
                    <div class="checkbox">
                    <label>
                      <input type="checkbox" class="child" name="chk[]" value="<?= $rowambil_data_pengcab['id_pengcab']; ?>" >
                    </label>
                    </div>        
                  </td>
                  <td style="vertical-align:middle;"><?= $rowambil_data_pengcab['nama_pengcab'];?></td>
              </tr> 
                <?php
                  }
                ?>
              </tbody>
            </table> 
        </div>
              </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
          </div>
    </div>  
    </FORM>
    </div>
<script type="text/javascript">
    $(document).ready(function() {
    $('.checkall').on('click', function() {
      $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      "initComplete": function (settings, json) {  
      $("#example1").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
      },
      'paging'        : false,
      'lengthChange'  : false,
      'searching'     : false,
      'ordering'      : false,
      'info'          : true,
//    'scrollX'     : true,
//    'scrollY'     : '500px',
    'scrollCollapse'  : true
    })
  });
</script>
<?php
}
elseif ($page=="pengajuan_korespodensi_pengurus")
{
?>
      <div class="row">
        <div class="col-md-12">
    <FORM method="POST" class="form-horizontal" action="<?php echo base_url('ol_daftar/pengajuan_korespodensi/simpan_pengurus');?>" onClick="return cek();">
          <input type="hidden" name="id_kor_kategori" value="<?= $id; ?>">
          <input type="hidden" name="barcode_korespodensi" value="<?= $id2; ?>">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
        <div class="col-md-12">
          <h5>JIKA TIDAK MUNCUL PASTIKAN PENGURUS WILAYAH TERSEBUT SUDAH MASUK JABATAN ORGANISASI (KETUA DAN SEKRETARIS)</h5>
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                  <tr>
                  <th style="background-color:#9b0e27;color:white;vertical-align:middle;width:5%;">
                    <input name="select_all" class="checkall" type="checkbox" />
                  </th>
                  <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Nama</th>
                  </tr>
              </thead>
              <tbody>   
                <?php
                  foreach($ambil_data_pengcab as $rowambil_data_pengcab){
                ?>
              <tr>
                  <td style="vertical-align:middle;width:10%">
                    <div class="checkbox">
                    <label>
                      <input type="checkbox" class="child" name="chk[]" value="<?= $rowambil_data_pengcab['id_pegawai_pengurus']; ?>" >
                    </label>
                    </div>        
                  </td>
                  <td style="vertical-align:middle;">
                    <?= $rowambil_data_pengcab['nama_pegawai_pengurus'];?>
                    <?php  input_text("id_pegawai[]",$rowambil_data_pengcab['id_pegawai'],"","","hidden"); ?>
                    </td>
              </tr> 
                <?php
                  }
                ?>
              </tbody>
            </table> 
        </div>
              </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
          </div>
    </div>  
    </FORM>
    </div>
<script type="text/javascript">
    $(document).ready(function() {
    $('.checkall').on('click', function() {
      $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      "initComplete": function (settings, json) {  
      $("#example1").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
      },
      'paging'        : false,
      'lengthChange'  : false,
      'searching'     : true,
      'ordering'      : false,
      'info'          : true,
//    'scrollX'     : true,
//    'scrollY'     : '500px',
    'scrollCollapse'  : true
    })
  });
</script>
<?php
}
elseif ($page=="pengajuan_korespodensi_tambah_kategori")
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
    <FORM method="POST" class="form-horizontal" action="<?php echo base_url('ol_daftar/pengajuan_korespodensi/simpan_tambah_kategori');?>" onClick="return cek();">
          <input type="hidden" name="barcode_korespodensi" value="<?= $id2; ?>">
          <input type="hidden" name="id_korespodensi" value="<?= $id; ?>">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
        <div class="col-md-12">
          <h5>PILIH KATEGORI SURAT</h5>

<?php input_pdselect2("id_kategori",$ambil_data_surat_kategori,$id_kategori); ?>
        </div>
<div class="col-md-12">
<label>Asal (NAMA PENGURUS INI YANG AKAN JADI VALIDATOR)</label>
<?php input_pdselect2("pengcab_asal",$ambil_data_pengcabnonull,$pengcab_asal); ?>
</div>
<div class="col-md-12">
<label>Tujuan</label>
<?php input_pdselect2("pengcab_tujuan",$ambil_data_pengcabnonull,$pengcab_tujuan); ?>
</div>
              </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
          </div>
    </div>  
    </FORM>
    </div>
<script type="text/javascript">
    $(document).ready(function() {
    $('.select2').select2()
  }); 
</script>
<?php
}
elseif ($page=="pengajuan_korespodensi_print")
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
      <?php echo form_open_multipart('ol_daftar/pengajuan_korespodensi/print/'.$id.'/'.$id2,' id="signupform" ');
        input_text("barcode_korespodensi",$id,"","","hidden");
        input_text("id_korespodensi",$id_korespodensi,"","","hidden");
        input_text("id_kor_kategori",$id_kor_kategori,"","","hidden");
        input_text("barcode_kor_kategori",$id2,"","","hidden");
      ?>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">DATA INI AKAN TERCATAT SEBAGAI PERMINTAAN HASIL SURAT KE ANGGOTA MOHON DIBUAT SEKALI SAJA</h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>No Surat</label>
              <?php
                input_text("no_kor_print",$no_kor_print,"maxlength='255' ","Ketikkan","text");
              ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Judul Surat</label>
              <?php
                input_text("title_kor_print",$title_kor_print,"maxlength='255' ","Ketikkan","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Judul (MODUL)</label>
              <?php
                input_text("modul",$modul,"maxlength='255' ","Ketikkan","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Tempat Modul (MODUL)</label>
              <?php
                input_text("tmp_modul",$tmp_modul,"maxlength='255' ","Ketikkan","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Tanggal Awal</label>
              <?php
                input_calendar("tgl_awal","tgl_awal",$tgl_awal,"Masukkan Tanggal"," required");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Tanggal Akhir</label>
              <?php
                input_calendar("tgl_akhir","tgl_akhir",$tgl_akhir,"Masukkan Tanggal"," required");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Kota Signature</label>
              <?php
                input_text("tmp_kor_print",$tmp_kor_print,"maxlength='255' ","Ketikkan","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Tanggal Signature</label>
              <?php
                input_calendar("tgl_kor_print","tgl_kor_print",$tgl_kor_print,"Masukkan Tanggal"," required");
              ?>
            </div>
          </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Uk Font</label>
                <?php
                  input_textcustom("font_size",$font_size," required
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "Ketikkan Angka","text");
                ?>
                </div>
              </div>
          <div class="col-md-12">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="width:5%;background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">YANG BERTANDA TANGAN</th>
              </tr>
              </thead>
              <tbody>
                <?php
                foreach($ambil_kor_detil_signature as $row){
                ?>
              <tr>
                <td style="vertical-align:middle;text-align: center;">
                  <div class="checkbox">
                  <label>
                    <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_pegawai_pengurus'];?>">
                  </label>
                  </div>
                </td>
                <td style="vertical-align:middle;"><?php echo $row['nama_pegawai_pengurus']; ?>
                  <?php input_text("id_pegawai[]",$row['id_pegawai'],"","","hidden"); ?>
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
        <div class="box-footer">
          <button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
    <?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="pengajuan_korespodensi_edit_korprint")
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
    <FORM method="POST" class="form-horizontal" action="<?php echo base_url('ol_daftar/pengajuan_korespodensi/simpan_edit_korprint');?>" onClick="return cek();">
          <input type="hidden" name="barcode_korespodensi" value="<?= $id; ?>">
          <input type="hidden" name="id_kor_print" value="<?= $id2; ?>">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
              
          <div class="col-md-12">
            <div class="form-group">
              <label>No Surat</label>
              <?php
                input_text("no_kor_print",$no_kor_print,"maxlength='255' ","Ketikkan","text");
              ?>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Judul Surat</label>
              <?php
                input_text("title_kor_print",$title_kor_print,"maxlength='255' ","Ketikkan","text");
              ?>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Judul (MODUL)</label>
              <?php
                input_text("modul",$modul,"maxlength='255' ","Ketikkan","text");
              ?>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Tempat Modul (MODUL)</label>
              <?php
                input_text("tmp_modul",$tmp_modul,"maxlength='255' ","Ketikkan","text");
              ?>
             </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Tanggal Awal</label>
              <?php
                input_calendar("tgl_awal","tgl_awal",$tgl_awal,"Masukkan Tanggal"," required");
              ?>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Tanggal Akhir</label>
              <?php
                input_calendar("tgl_akhir","tgl_akhir",$tgl_akhir,"Masukkan Tanggal"," required");
              ?>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Kota Signature</label>
              <?php
                input_text("tmp_kor_print",$tmp_kor_print,"maxlength='255' ","Ketikkan","text");
              ?>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Tanggal Signature</label>
              <?php
                input_calendar("tgl_kor_print","tgl_kor_print",$tgl_kor_print,"Masukkan Tanggal"," required");
              ?>
            </div>
          </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Uk Font</label>
                <?php
                  input_textcustom("font_size",$font_size," required
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "Ketikkan Angka","text");
                ?>
                </div>
              </div>
                
              </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
          </div>
    </div>  
    </FORM>
    </div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2()
  });
$('#tgl_kor_print').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_kor_print").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$('#tgl_awal').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_awal").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$('#tgl_akhir').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_akhir").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
</script>
<?php
}
elseif ($page=="ms_peminatan")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
            <?php
      //        input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
            ?>
          </div>
        </div>
        <div class="box-body">
        <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
          <thead>
            <tr>
              <th style="display:none;"></th>
              <th>Nama</th>
              <th>Jabatan Profesi</th>
              <th>Status Peminatan</th>
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
  <div class="modal-dialog">
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
elseif ($page=="ms_peminatan_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_daftar/ms_peminatan/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>
      </div>
        <div class="box-body">
            <div class="row">   
            <div class="col-md-12">
                <label>Jabatan Profesi</label>
                <?php
                  input_pdselect2("id_jabatan",$cmd_jabatan,$id_jabatan);
                ?>
            </div>      
            <div class="col-md-12">
                <label>Nama</label>
                <?php
                  input_text("nama_peminatan",$nama_peminatan,"maxlength='255' ","Ketikkan Nama","text");
                ?>
            </div>   
              <div class="col-md-12">
                  <label>Status</label>
                  <?php
                  input_pdselect2("status_peminatan",$cmd_status,$status_peminatan);
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
});
</script>
<?php
}
elseif ($page=="ms_peminatan_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_daftar/ms_peminatan/simpan_edit');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            <input type="hidden" name="id_peminatan" value="<?= $id; ?>">
          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>
      </div>
        <div class="box-body">
            <div class="row">         
            <div class="col-md-12">
                <label>Nama</label>
                <?php
                  input_text("nama_peminatan",$nama_peminatan,"maxlength='255' ","Ketikkan Nama","text");
                ?>
            </div>   
              <div class="col-md-12">
                  <label>Status</label>
                  <?php
                  input_pdselect2("status_peminatan",$cmd_status,$status_peminatan);
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
});
</script>
<?php
}
elseif ($page=="kategori_kompetensi")
{
?>
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
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th width="5%" style="display:none;">ID</th>
            <th>Nama</th>
            <th>Jabatan</th>
            <th>Status</th>
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
elseif ($page=="kategori_kompetensi_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_daftar/kategori_kompetensi/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
          <div class="container col-md-12">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Nama</label>
                  <?php
                    input_text("nama_kompetensi",$nama_kompetensi,"maxlength='255' required autofocus","Masukkan Nama","text");
                  ?>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Struktur</label>
                    <?php
                      input_pdselect2("id_jabatan",$cmd_jabatan,$id_jabatan);
                    ?>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Status</label>
                    <?php
                      input_pdselect2("status_kompetensi",$cmd_status,$status_kompetensi);
                    ?>
                </div>
              </div>
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
});
</script>
<?php
}
elseif ($page=="kategori_kompetensi_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_daftar/kategori_kompetensi/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_kompetensi" value="<?= $id; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
          <div class="container col-md-12">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Nama</label>
                  <?php
                    input_text("nama_kompetensi",$nama_kompetensi,"maxlength='255' required autofocus","Masukkan Nama","text");
                  ?>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Struktur</label>
                    <?php
                      input_pdselect2("id_jabatan",$cmd_jabatan,$id_jabatan);
                    ?>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Status</label>
                    <?php
                      input_pdselect2("status_kompetensi",$cmd_status,$status_kompetensi);
                    ?>
                </div>
              </div>
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
});
</script>
<?php
}
elseif ($page=="kategori_kewenangan")
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
  <?php echo form_open_multipart('ol_daftar/kategori_kewenangan/view/'.$id_jabatan.'/'.$opsi_kewenangan,' id="signupform" '); ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
    </div>
      <div class="box-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Buku Putih / Butir Kegiatan</label>
              <?php
                input_pdselect2("opsi_kewenangan",$cmd_opsi,$opsi_kewenangan);
              ?>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Jabatan</label>
              <?php
                input_pdselect2fleksibel("id_jabatan","id_jabatan",$cmd_jabatan_null,"id_jabatan","nama_jabatan",$id_jabatan,"Semua");
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
            <th style="display:none;">ID</th>
            <th>Nama</th>
            <?php
            if($opsi_kewenangan == 0){
            ?>
            <th>Jabatan</th>            
            <th>Kompetensi</th>
            <th>Jenis</th>
            <th>Jenjang</th>
            <th width="5%">Waktu</th>
            <?php
            }else{
            ?>
            <th>Jabatan Fungsional</th>
            <?php
            }
            ?>
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
elseif ($page=="kategori_kewenangan_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_daftar/kategori_kewenangan/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
          <div class="container col-md-12">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Nama</label>
                  <?php
                    input_text("nama_kewenangan",$nama_kewenangan,"maxlength='255' required autofocus","Masukkan Nama","text");
                  ?>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Kompetensi</label>
                    <?php
                      input_pdselect2("id_kompetensi",$cmd_kompetensi,$id_kompetensi);
                    ?>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                      <label>Kode Kewenangan</label>
              <?php
              //  input_pdselect2("id_kode_kewenangan",$cmd_kode_kewenangan,$id_kode_kewenangan);
      input_pdselect2fleksibel("id_kode_kewenangan","id_kode_kewenangan",$cmd_kode_kewenangan_null,"id_kode_kewenangan","nama_kode_kewenangan",$id_kode_kewenangan,"Tanpa Kode Kewenangan");
              ?>
            </div>
            </div>
              <div class="col-md-12">
                <div class="form-group">
                      <label>Jenis Kewenangan</label>
              <?php
            //    input_pdselect2("id_sifat_kewenangan",$cmd_sifat_kewenangan,$id_sifat_kewenangan);
      input_pdselect2fleksibel("id_sifat_kewenangan","id_sifat_kewenangan",$cmd_sifat_kewenangan_null,"id_sifat_kewenangan","nama_sifat_kewenangan",$id_sifat_kewenangan,"Tanpa Jenis Kewenangan");
              ?>
            </div>
            </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Waktu Pengerjaan Kewenangan</label>
            <?php
            input_textcustom("wkt_kewenangan","0"," style='text-align:right;' required maxlength='5'
                  onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                      "Waktu","text");
            ?>
                </div>
              </div>
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
});
</script>
<?php
}
elseif ($page=="kategori_kewenangan_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_daftar/kategori_kewenangan/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_kewenangan" value="<?= $id_jabatan; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
          <div class="container col-md-12">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Nama</label>
                  <?php
                    input_text("nama_kewenangan",$nama_kewenangan,"maxlength='255' required autofocus","Masukkan Nama","text");
                  ?>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Kompetensi</label>
                    <?php
                      input_pdselect2("id_kompetensi",$cmd_kompetensi,$id_kompetensi);
                    ?>
                </div>
              </div>
            <div class="col-md-12">
              <div class="form-group">
                      <label>Kode Kewenangan</label>
              <?php
              //  input_pdselect2("id_kode_kewenangan",$cmd_kode_kewenangan,$id_kode_kewenangan);
      input_pdselect2fleksibel("id_kode_kewenangan","id_kode_kewenangan",$cmd_kode_kewenangan_null,"id_kode_kewenangan","nama_kode_kewenangan",$id_kode_kewenangan,"Tanpa Kode Kewenangan");
              ?>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                      <label>Jenis Kewenangan</label>
              <?php
            //    input_pdselect2("id_sifat_kewenangan",$cmd_sifat_kewenangan,$id_sifat_kewenangan);
      input_pdselect2fleksibel("id_sifat_kewenangan","id_sifat_kewenangan",$cmd_sifat_kewenangan_null,"id_sifat_kewenangan","nama_sifat_kewenangan",$id_sifat_kewenangan,"Tanpa Jenis Kewenangan");
              ?>
              </div>
            </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Waktu Pengerjaan Kewenangan</label>
            <?php
            input_textcustom("wkt_kewenangan",$wkt_kewenangan," style='text-align:right;' required maxlength='5'
                  onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                      "Waktu","text");
            ?>
                </div>
              </div>
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
});
</script>
<?php
}
elseif ($page=="kompetensi")
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
  <?php echo form_open_multipart('ol_daftar/kompetensi/view/'.$id,' id="signupform" '); ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
    </div>
      <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Ruangan</label>
              <?php
                input_pdselect2fleksibel("id","id",$cmd_ruangan,"id_ruangan","nama_ruangan",$id,"Semua");
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
            <th style="display: none;width:5%;">KD</th>
            <th style="width:20%;">Kewenangan</th>
            <th>PK</th>
            <th style="width:20%;">Kategori Kewenangan</th>
            <th>Jenis</th>
            <th>Jenjang</th>
            <th>Ruangan</th>
            <th>Profesi</th>
            <th>Waktu</th>
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
elseif ($page=="kompetensi_tambah_unit")
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
  <?php echo form_open_multipart('ol_daftar/kompetensi/tambah_unit/'.$id,' id="signupform" ');
  input_text("id_jabatan",$id,"","","hidden");
//  input_text("program_jabatan",$program_jabatan,"","","hidden");
  ?>
    <div class="row">
      <div class="col-md-4">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">PILIH KLASIFIKASI JABATAN UNTUK KEWENANGAN</h3>
        </div>
          <div class="box-body">
              <div class="form-group">
                <label>Jabatan</label>
                  <?php
                    input_pdselect2fleksibel("id_jabatan","id_jabatan",$cmd_jabatan_null,"id_jabatan","nama_jabatan",$id,"Pilih Jabatan");
                  ?>
              </div>
          </div>
          <div class="box-footer">
            <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">DATA YANG AKAN DISIMPAN</h3>
        </div>
          <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                      <label>Ruangan</label>
              <?php
                input_pdselect2("id_ruangan",$cmd_ruangan_no_null,$id_ruangan);
              ?>
              </div>
            </div>
          </div>
          </div>
          <div class="box-footer">

          </div>
        </div>
      </div>
    </div>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">PILIH KEWENANGAN YANG AKAN DISIMPAN DI RUANGAN</h3>

          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
      <table id="example1" width="100%" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th style="width:10%;background-color:#9b0e27;color:white;vertical-align:middle;">
            <input name="select_all" class="checkall" type="checkbox" />
          </th>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Ruangan</th>
        </tr>
        </thead>
        <tbody>
          <?php
          foreach($cmd_kewenangan as $row){
          ?>
        <tr>
          <td style="vertical-align:middle;">
            <div class="checkbox">
            <label>
              <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_kewenangan'];?>">
            </label>
            </div>
          </td>
          <td style="vertical-align:middle;">
            <?php echo $row['nama_kewenangan'].' ( '.$row['nama_kode_kewenangan'].' - '.$row['nama_sifat_kewenangan'].' ) - Kompetensi : '.$row['nama_kompetensi']; ?>
          </td>
        </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
        </div>
        <div class="box-footer">
      <button type="submit" name="action" value="BtnSimpan" class="btn btn-success pull-left"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </div>
    <?php echo form_close(); ?>
    </section>
</div>
<?php
}
elseif ($page=="kompetensi_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_daftar/kompetensi/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_kewenangan_detil" value="<?= $id; ?>">
    <input type="hidden" name="id_kewenangan_lama" value="<?= $id_kewenangan; ?>">
    <input type="hidden" name="id_ruangan_lama" value="<?= $id_ruangan; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
        <div class="col-md-12">
          <div class="form-group">
                  <label>Kewenangan</label>
          <?php
            input_pdselect2("id_kewenangan",$cmd_kewenangan_no_null,$id_kewenangan);
          ?>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
          <label>Ruangan</label>
          <?php
            input_pdselect2("id_ruangan",$cmd_ruangan_no_null,$id_ruangan);
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
});
</script>
<?php
}
elseif ($page=="lulus")
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
  <?php echo form_open_multipart('ol_daftar/lulus/view/'.$id,' id="signupform" '); ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
    </div>
      <div class="box-body">
      <div class="row">
      <div class="col-md-12">
        <div class="form-group">
        <label>Nama Pegawai</label>
          <?php
            input_pdselect2fleksibel("id","id",$cmd_pegawai,"id_pegawai","nama_pegawai",$id,"Pilih Pegawai Lebih Dulu");
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
            <th width="5%">ID</th>
            <th>Nama</th>
            <th>Kompetensi</th>
            <th>Kewenangan</th>
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
elseif ($page=="lulus_tambah")
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
  <?php echo form_open_multipart('ol_daftar/lulus/tambah/'.$id.'/'.$id_kompetensi,' id="signupform" ');
  input_text("id",$id,"","","hidden");
  ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><?php echo $title; ?></h3>
    </div>
      <div class="box-body">
      <div class="row">
      <div class="col-md-12">
        <div class="form-group">
        <label>Pilih Kompetensi</label>
          <?php
            input_pdselect2fleksibel("id_kompetensi","id_kompetensi",$ambil_kr_kewenangan,"id_kompetensi","nama_kompetensi",$id_kompetensi,"Pilih Kompetensi Lebih Dulu");
          ?>
        </div>
      </div>
      </div>
      </div>
      <div class="box-footer">
        <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
      </div>
    </div>

      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
      <table id="example1" width="100%" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;">
            <input name="select_all" class="checkall" type="checkbox" />
          </th>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kewenangan</th>
        </tr>
        </thead>
        <tbody>
          <?php
          $no=0;
          $arr = array();
          foreach($kewenangan_lulus_pegawai as $val){
              $arr[] = $val['id_kewenangan'];
          }
          $eimplo = implode(",", $arr);
          foreach($ambil_kr_kewenangan_per_kompetensi as $row){
          ?>
        <tr>
          <td style="vertical-align:middle;">
            <div class="checkbox">
            <label>
              <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_kewenangan'];?>"
              <?php if(in_array($row['id_kewenangan'],explode(",", $eimplo))) echo 'checked="checked"'; ?> >
            </label>
            </div>
          </td>
          <td style="vertical-align:middle;"><?php echo $row['nama_kewenangan']; ?></td>
        </tr>
          <?php
            }
          ?>
        </tbody>
      </table>
        </div>
        <div class="box-footer">
      <button type="submit" name="action" value="BtnSimpan" class="btn btn-success pull-left"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </div>
    <?php echo form_close(); ?>
    </section>
</div>
<?php
}
elseif ($page=="cat_oppe")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
            <div class="col-md-12">
              <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                <div class="box-header with-border">
                   <h3 class="box-title"> <?php echo $title; ?></h3>

                  <div class="box-tools pull-right">
              <?php
          //      input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
              ?>
                  </div>
                </div>
                <div class="box-body">
              <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
                <thead>
                  <tr>
                    <th>Keterangan</th>
                    <th>Judul</th>
                    <th>Isi</th>
                    <th>Jabatan</th>
                  </tr>
                </thead>
              </table>
                </div>
                <div class="box-footer">

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
elseif ($page=="cat_oppe_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_daftar/cat_oppe/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>
      </div>
        <div class="box-body">
        <div class="col-md-12">
          <div class="form-group">
                  <label>Opsi Catatan</label>
          <?php
            input_pdselect2("kode_catatan",$ambil_data_catatan_oppe,$kode_catatan);
          ?>
          </div>
        </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Isi</label>
                <?php
                  input_text("isi_catatan",$isi_catatan,"maxlength='255' ","Ketikkan","text");
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
});
</script>
<?php
}
elseif ($page=="cat_oppe_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_daftar/cat_oppe/simpan_edit');?>" onClick="return cek();">
       <input type="hidden" name="id_catatan" value="<?= $id_catatan; ?>">
     <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
        <div class="col-md-12">
          <div class="form-group">
                  <label>Opsi Catatan</label>
          <?php
            input_pdselect2("kode_catatan",$ambil_data_catatan_oppe,$kode_catatan);
          ?>
          </div>
        </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Isi</label>
                <?php
                  input_text("isi_catatan",$isi_catatan,"maxlength='255' ","Ketikkan","text");
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
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
});
</script>
<?php
}
elseif ($page=="bcp")
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
    <a href="<?php echo $link_kembali;?>"
      class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
    </a>
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('ol_daftar/bcp/view/'.$id.'/'.$all.'/'.$first_date.'/'.$last_date,' id="signupform" '); ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">PILIH JIKA INGIN MENCARI DATA</h3>
    </div>
      <div class="box-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Pegawai</label>
              <?php
                input_pdselect2fleksibel("id","id",$cmd_pegawai,"id_pegawai","nama_pegawai",$id,"Semua Pegawai");
              ?>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Tipe Pemanggilan</label>
            <?php
              input_pdselect2("all",$cmd_sekarepe_dewe,$all);
            ?>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Tanggal Awal</label>
              <?php
                input_calendar("first_date","first_date",$first_date,"Masukkan Tanggal","required");
              ?>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Tanggal Akhir</label>
            <?php
              input_calendar("last_date","last_date",$last_date,"Masukkan Tanggal","required");
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

          <div class="box-tools pull-right">

          </div>
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
            <th style="width: 3%"></th>
            <th style="width: 3%">ID</th>
            <th style="width: 3%">IDP</th>
            <th style="width: 13%">Tanggal</th>
            <th>Nama</th>
            <th style="width: 7%">PK</th>
            <th style="width: 25%">Kewenangan</th>
            <th style="width: 10%">Pengajuan</th>
            <th style="width: 5%">V Karu</th>
            <th style="width: 5%">V Kabid</th>
            <th style="width: 5%">V Asesor</th>
            <th style="width: 5%">V Komite</th>
            <th style="width: 5%">V Direktur</th>

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
elseif ($page=="slide_title")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
    <?php echo $header; ?> <small><?php echo $instance_name; ?></small>
      </h1>
    </section>
    <section class="content">
      <div class="row">
    <?php echo form_open_multipart('ol_daftar/slide_title',' '); 
    input_text("id_instansi_text",$id_instansi_text,"","","hidden"); ?>
        <div class="col-md-6">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>
          <div class="box-tools pull-right"></div>
        </div>
        <div class="box-body">
                <div class="form-group">
                  <label>Title 1</label>
          <?php
            input_text("title1",$title1,"maxlength='255' ","","text");
          ?>  
                </div>
                <div class="form-group">
                  <label>Description 1</label>
          <?php
            input_text("desc1",$desc1,"maxlength='255' ","","text");
          ?>  
                </div>
                <div class="form-group">
                  <label>Title 2</label>
          <?php
            input_text("title2",$title2,"maxlength='255' ","","text");
          ?>  
                </div>  
                <div class="form-group">
                  <label>Description 2</label>
          <?php
            input_text("desc2",$desc2,"maxlength='255' ","","text");
          ?>  
                </div>        
                <div class="form-group">
                  <label>Title 3</label>
          <?php
            input_text("title3",$title3,"maxlength='255' ","","text");
          ?>  
                </div>  
                <div class="form-group">
                  <label>Description 3</label>
          <?php
            input_text("desc3",$desc3,"maxlength='255' ","","text");
          ?>  
                </div>
                <div class="form-group">
                  <label>Title 4</label>
          <?php
            input_text("title4",$title4,"maxlength='255' ","","text");
          ?>  
                </div>          
                <div class="form-group">
                  <label>Description 4</label>
          <?php
            input_text("desc4",$desc4,"maxlength='255' ","","text");
          ?>  
                </div> 
        </div>
      </div>
    </div>  
        <div class="col-md-6">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>
          <div class="box-tools pull-right"></div>
        </div>
        <div class="box-body">
                <div class="form-group">
                  <label>Slide 1a</label>
          <?php
            input_text("slide1a",$slide1a,"maxlength='255' ","","text");
          ?>  
                </div>
                <div class="form-group">
                  <label>Slide 1b</label>
          <?php
            input_text("slide1b",$slide1b,"maxlength='255' ","","text");
          ?>  
                </div>      
                <div class="form-group">
                  <label>Slide 2a</label>
          <?php
            input_text("slide2a",$slide2a,"maxlength='255' ","","text");
          ?>  
                </div>  
                <div class="form-group">
                  <label>Slide 2b</label>
          <?php
            input_text("slide2b",$slide2b,"maxlength='255' ","","text");
          ?>  
                </div>  
                <div class="form-group">
                  <label>Slide 3a</label>
          <?php
            input_text("slide3a",$slide3a,"maxlength='255' ","","text");
          ?>  
                </div>
                <div class="form-group">
                  <label>Slide 3b</label>
          <?php
            input_text("slide3b",$slide3b,"maxlength='255' ","","text");
          ?>  
                </div>      
                <div class="form-group">
                  <label>Slide 4a</label>
          <?php
            input_text("slide4a",$slide4a,"maxlength='255' ","","text");
          ?>  
                </div>  
                <div class="form-group">
                  <label>Slide 4b</label>
          <?php
            input_text("slide4b",$slide4b,"maxlength='255' ","","text");
          ?>  
                </div> 
        </div>
      </div>
    </div>  
        <div class="col-md-12">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>
          <div class="box-tools pull-right"></div>
        </div>
        <div class="box-body">
                <div class="form-group">
                  <label>Intro Selamat Datang</label>
          <?php
            input_textareacustom("welcome",$welcome," id='editor1' rows='10' cols='100' class='form-control' ","Masukkan Intro");
          ?>  
                </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>   
    </div>  
    <?php echo form_close(); ?>
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
</style>
  <div class="content-wrapper">
    <section class="content">
  <?php echo form_open_multipart('ol_daftar/etik/view/'.$id_jabatan,' id="signupform" '); ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
    </div>
      <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Jabatan</label>
              <?php
                input_pdselect2fleksibel("id_jabatan","id_jabatan",$cmd_jabatan_null,"id_jabatan","nama_jabatan",$id_jabatan,"Semua");
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
            <th style="display:none;">ID</th>
            <th>Nama</th>
            <th>Jabatan</th>
            <th>Status</th>
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
elseif ($page=="etik_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content">
  <?php echo form_open_multipart('ol_daftar/etik/tambah',' id="signupform" '); ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
    </div>
      <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Etik</label>
            <?php
              input_text("nama_etik",$nama_etik,"maxlength='255' autofocus required","Masukkan Nama Etik","text");
            ?>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Jawaban</label>
            <?php
              input_pdselect2("answer",$cmd_ya_tidak,$answer);
            ?>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Status</label>
            <?php
              input_pdselect2("status_etik",$cmd_status,$status_etik);
            ?>
          </div>
        </div>

      </div>
      </div>
      <div class="box-footer">

      </div>
    </div>

      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
      <table id="example1" width="100%" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;width:5%;">
            <input name="select_all" class="checkall" type="checkbox" />
          </th>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Jabatan</th>
        </tr>
        </thead>
        <tbody>
          <?php
          foreach($cmd_jabatan_null as $row){
          ?>
        <tr>
          <td style="vertical-align:middle;">
            <div class="checkbox">
            <label>
              <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_jabatan'];?>" >
            </label>
            </div>
          </td>
          <td style="vertical-align:middle;"><?php echo $row['nama_jabatan'];?></td>
        </tr>
          <?php
            }
          ?>
        </tbody>
      </table>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    <?php echo form_close(); ?>
    </section>
</div>
<?php
}
elseif ($page=="etik_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content">
  <?php echo form_open_multipart('ol_daftar/etik/edit/'.$id_jabatan,' id="signupform" ');
  input_text("id_etik",$id_jabatan,"","","hidden");
  ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
    </div>
      <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Etik</label>
            <?php
              input_text("nama_etik",$nama_etik,"maxlength='255' autofocus required","Masukkan Nama Etik","text");
            ?>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Jawaban</label>
            <?php
              input_pdselect2("answer",$cmd_ya_tidak,$answer);
            ?>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Status</label>
            <?php
              input_pdselect2("status_etik",$cmd_status,$status_etik);
            ?>
          </div>
        </div>

      </div>
      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
    <?php echo form_close(); ?>
    </section>
</div>
<?php
}
elseif ($page=="ms_etik")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content">
  <?php echo form_open_multipart('ol_daftar/ms_etik/view/'.$id,' id="signupform" '); ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><?= $title ?></h3>
    </div>
      <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Jabatan</label>
              <?php
                input_pdselect2fleksibel("id_jabatan","id_jabatan",$cmd_jabatan_null,"id_jabatan","nama_jabatan",$id,"Semua");
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
                <th style="display:none;">ID</th>
                <th>Jabatan</th>
                <th>Instansi</th>
                <th style="width:10%;">Status</th>
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
elseif ($page=="ms_etik_tambah")
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
        <h3 class="box-title"><?= $title ?></h3>
    </section>
    <section class="content">
  <?php echo form_open_multipart('ol_daftar/ms_etik/tambah/'.$id ,' id="signupform" ');

  ?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">
      <?php echo $title; ?> <small style="color:white;font-weight:bold;">  <?php echo $instance_name; ?> </small>
       </h3>
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
        <div class="col-md-6">
          <div class="form-group">
            <label>Jabatan</label>
              <?php
                input_pdselect2("id_jabatan",$cmd_jabatan,$id_jabatan);
              ?>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Instansi</label>
              <?php
                input_pdselect2("id_instansi",$ambil_data_rujukan_working_kab_null,$id_instansi);
              ?>
          </div>
        </div>
      </div>
      </div>
    </div>
      <table id="example1" width="100%" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;">
            <input name="select_all" class="checkall" type="checkbox" />
          </th>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;width:70%;">Etik</th>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Jabatan</th>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;width:5%;">Jawaban</th>
        </tr>
        </thead>
        <tbody>
          <?php
          foreach($ambil_pilih_ms_etik as $row){
          ?>
        <tr>
          <td style="vertical-align:middle;">
            <div class="checkbox">
            <label>
              <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_etik'];?>" >
            </label>
            </div>
          </td>
          <td style="vertical-align:middle;"><?php echo $row['nama_etik']; ?></td>
          <td style="vertical-align:middle;"><?php echo $row['nama_jabatan']; ?></td>
          <td style="vertical-align:middle;"><?php echo $row['answer']; ?></td>
        </tr>
          <?php
            }
          ?>
        </tbody>
      </table>
        </div>
        <div class="box-footer">
<button type="submit" name="action" value="BtnSimpan" class="btn btn-primary pull-left"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </div>
  <?php echo form_close(); ?>
    </section>
</div>
<?php
}
elseif ($page=="ms_etik_edit")
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
        <h3 class="box-title"><?= $title ?></h3>
    </section>
    <section class="content">
  <?php echo form_open_multipart('ol_daftar/ms_etik/edit/'.$id ,' id="signupform" ');
  input_text("id_etik_instansi",$id,"","","hidden");
  ?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">
      <?php echo $title; ?> <small style="color:white;font-weight:bold;">  <?php echo $instance_name; ?> </small>
       </h3>
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
        <div class="col-md-4">
          <div class="form-group">
            <label>Jabatan</label>
              <?php
                input_pdselect2("id_jabatan",$cmd_jabatan,$id_jabatan);
              ?>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>Instansi</label>
              <?php
                input_pdselect2("id_instansi",$ambil_data_rujukan_working_kab_null,$id_instansi);
              ?>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>Instansi</label>
              <?php
                input_pdselect2("status_etik_instansi",$cmd_status,$status_etik_instansi);
              ?>
          </div>
        </div>
      </div>
      </div>
    </div>
      <table id="example1" width="100%" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;">
            <input name="select_all" class="checkall" type="checkbox" />
          </th>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;width:70%;">Etik</th>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Jabatan</th>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;width:5%;">Jawaban</th>
        </tr>
        </thead>
        <tbody>
          <?php
          foreach($ambil_pilih_ms_etik as $row){
          ?>
        <tr>
          <td style="vertical-align:middle;">
            <div class="checkbox">
            <label>
              <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_etik'];?>" <?php if(in_array($row['id_etik'],explode(",", $etik))) echo 'checked="checked"'; ?> >
            </label>
            </div>
          </td>
          <td style="vertical-align:middle;"><?php echo $row['nama_etik']; ?></td>
          <td style="vertical-align:middle;"><?php echo $row['nama_jabatan']; ?></td>
          <td style="vertical-align:middle;"><?php echo $row['answer']; ?></td>
        </tr>
          <?php
            }
          ?>
        </tbody>
      </table>
        </div>
        <div class="box-footer">
<button type="submit" name="action" value="BtnSimpan" class="btn btn-primary pull-left"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </div>
  <?php echo form_close(); ?>
    </section>
</div>
<?php
}
elseif ($page=="etik_pegawai")
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
           <h3 class="box-title"><?= $title ?></h3>
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
                <th style="display:none;">ID</th>
                <th>Tanggal</th>
                <th>Instansi</th>
                <th>Nama</th>
                <th>Jumlah Soal</th>
                <th>Nilai</th>
                <th>Hasil</th>
                <th>Penguji</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="etik_pegawai_tambah")
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
        <h3 class="box-title"><?= $title ?></h3>
    </section>
    <section class="content">
  <?php echo form_open_multipart('ol_daftar/etik_pegawai/tambah/'.$id ,' id="signupform" ');
/*    if($num_kol_daftar_all['count_koletik']==0){
      $disableded = "disabled";
    }else{
      $disableded = "";
    }*/
  ?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">
      <?php echo $title; ?> <small style="color:white;font-weight:bold;">  <?php echo $instance_name; ?> </small>
       </h3>
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
        <div class="col-md-6">
          <div class="form-group">
            <label>Format Etik</label>
              <?php
                input_pdselect2("id",$ambil_etik_instansi,$id);
              ?>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Instansi</label>
              <?php
                input_pdselect2("id_instansi",$ambil_working,$id_instansi);
              ?>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label>Pegawai</label>
              <?php
                input_pdselect2("id_pegawai",$ambil_data_etik_instansi_no_null,$id_pegawai);
              ?>
          </div>
        </div>
      </div>
      </div>
      <div class="box-footer">
    <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
      </div>
    </div>
      <table id="example1" width="100%" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th style="background-color:#9b0e27;color:white;text-align: center;vertical-align:middle;width:5%;">No</th>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;width:70%;">Etik</th>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;">Jabatan</th>
          <th style="background-color:#9b0e27;color:white;text-align: center;vertical-align:middle;width:5%;">YA</th>
          <th style="background-color:#9b0e27;color:white;text-align: center;vertical-align:middle;width:5%;">TIDAK</th>
        </tr>
        </thead>
        <tbody>
          <?php
          $no =0;
          foreach($ambil_pilih_ms_etik as $row){
            if (in_array($row['id_etik'],explode(",", $etik))) {
              $no++;
          ?>
        <tr>
                <td style="vertical-align:middle;"><?php echo $no;?></td>
                <td style="vertical-align:middle;"><?php input_text("id_etik[]",$row['id_etik'],"","","hidden"); ?><?php echo $row['nama_etik'];?></td>
          <td style="vertical-align:middle;text-align: center;"><?php echo $row['nama_jabatan']; ?></td>
                <td style="vertical-align:middle;text-align: center;text-align:center;">
                  <div class="radio">
                  <label>
                    <input type="radio" onchange="total_GR()" name="skor_etik<?php echo $row['id_etik']; ?>" value="<?php if($row['answer']=="1") {echo "1";}else{echo "0";}?>" checked="checked">
                  </label>
                  </div>
                </td>
                <td style="vertical-align:middle;text-align: center;text-align:center;">
                  <div class="radio">
                  <label>
                    <input type="radio" onchange="total_GR()" name="skor_etik<?php echo $row['id_etik']; ?>" value="<?php if($row['answer']=="0") {echo "1";}else{echo "0";}?>">
                  </label>
                  </div>
                </td>
        </tr>
          <?php
              }
            }
          ?>
        </tbody>
      </table>
      <hr>
              <label>Hasil</label>
              <?php
                input_text("sub_total",0,"maxlength='255' onchange='total_GR()' readonly","","hidden");
                input_text("hasilGR",0,"maxlength='255' readonly","","text");
                input_text("total",$no,"maxlength='255' ","","hidden");
              ?>
        </div>
        <div class="box-footer">
<button type="submit" name="action" value="BtnSimpan" class="btn btn-primary pull-left"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </div>
  <?php echo form_close(); ?>
    </section>
</div>
<?php
}
elseif ($page=="etik_pegawai_lihat")
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
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">No</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Etik</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align:center;">Jawaban</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align:center;">Terpilih</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align:center;">Skor</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align:center;">Jumlah</th>
              </tr>
              </thead>
              <tbody>
                <?php
                $jumlahe = 0; $No = 0;
                foreach($ambil_data_etik_pegawai as $row){
                  $jumlahe = $jumlahe + $row['skor_etik'];
                  $No++;
                ?>
              <tr>
                <td style="vertical-align:middle;"><?php echo $No; ?></td>
                <td style="vertical-align:middle;"><?php echo $row['nama_etik'];?></td>
                <td style="vertical-align:middle;text-align:center;">
                <?php
                  if($row['answer']=="0") { // NO
                    echo "TIDAK";
                  }else if($row['answer']=="1"){
                    echo "YA";
                  }
                ?>
                </td>
                <td style="vertical-align:middle;text-align:center;">
                <?php
                  if($row['answer']=="0" AND $row['skor_etik']=="0") { // NO
                    echo "YA";
                  }else if($row['answer']=="0" AND $row['skor_etik']=="1"){
                    echo "TIDAK";
                  }else if($row['answer']=="1" AND $row['skor_etik']=="1"){
                    echo "YA";
                  }else if($row['answer']=="1" AND $row['skor_etik']=="0"){
                    echo "TIDAK";
                  }
                ?>
                </td>
                <td style="vertical-align:middle;text-align:center;"><?php echo $row['skor_etik'];?></td>
                <td style="vertical-align:middle;text-align:center;"><?php echo $jumlahe;?></td>
              </tr>
                <?php
                  }
                ?>
              </tbody>
            </table>
            <hr>
            <div class="col-md-6">
            <div class="form-group">
              <label>Hasil</label>
              <?php
                input_text("total",$hasil_etik,"maxlength='255' readonly","","text");
              ?>
            </div>
             </div>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="jabatan_struktur")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>

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
            <th style="display:none;"></th>
            <th>Nama</th>
            <th>Status</th>
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
  <div class="modal-dialog">
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
elseif ($page=="jabatan_struktur_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_daftar/jabatan_struktur/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
          <div class="box-tools pull-right">
              <input type="hidden" name="id_prov" value="<?= $prov_id; ?>">
          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>
      </div>
        <div class="box-body">
            <div class="row">         
            <div class="col-md-12">
                <label>Nama Jabatan struktur</label>
                <?php
                  input_text("nama_ms_struktur",$nama_ms_struktur,"maxlength='255' ","Ketikkan Nama","text");
                ?>
            </div>   
        <div class="col-md-12">
            <label>Instansi</label>
              <?php
                input_pdselect2fleksibel("id_instansi","id_instansi",$ambil_data_rujukan_working_null,"id_working","nama_working",$id_instansi,"Semua");
              ?>
        </div>
              <div class="col-md-12">
                  <label>Status</label>
                  <?php
                  input_pdselect2("status_ms_struktur",$cmd_status,$status_ms_struktur);
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
});
</script>
<?php
}
elseif ($page=="jabatan_struktur_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_daftar/jabatan_struktur/simpan_edit');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            <input type="hidden" name="id_ms_struktur" value="<?= $id; ?>">
            <input type="hidden" name="kunci" value="<?= $kunci; ?>">
          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>
      </div>
        <div class="box-body">
            <div class="row">         
            <div class="col-md-12">
                <label>Nama Jabatan struktur</label>
                <?php
                  input_text("nama_ms_struktur",$nama_ms_struktur,"maxlength='255' ","Ketikkan Nama","text");
                ?>
            </div>   
        <div class="col-md-12">
            <label>Instansi</label>
              <?php
                input_pdselect2fleksibel("id_instansi","id_instansi",$ambil_data_rujukan_working_null,"id_working","nama_working",$id_instansi,"Semua");
              ?>
        </div>
              <div class="col-md-12">
                  <label>Status</label>
                  <?php
                  input_pdselect2("status_ms_struktur",$cmd_status,$status_ms_struktur);
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
});
</script>
<?php
}
elseif ($page=="struktur")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('ol_daftar/struktur/view/'.$id,' id="signupform" '); ?>
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
                input_pdselect2fleksibel("id_working","id_working",$ambil_data_rujukan_working_null,"id_working","nama_working",$id,"SEMUA");
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
           <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>

          <div class="box-tools pull-right">
            <?php
      //        input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
            ?>
          </div>
        </div>
        <div class="box-body">
        <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
          <thead>
            <tr>
              <th style="display:none;"></th>
              <th>Instansi</th>
              <th>Nama Jabatan Struktur</th>
              <th>Status Jabatan Struktur</th>
              <th>Status Struktur</th>
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
  <div class="modal-dialog">
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
elseif ($page=="struktur_tambah")
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
      <?php echo form_open_multipart('ol_daftar/struktur/tambah',' id="signupform" ');
    //    input_text("id_pengcab",$id_pengcab,"","","hidden");
      ?>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Instansi</label>
              <?php
                input_pdselect2("id_instansi",$ambil_data_rujukan_working,$id_instansi);
              ?>
            </div>
          </div>
          <div class="col-md-12">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="width:5%;background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Wilayah</th>
              </tr>
              </thead>
              <tbody>
                <?php
                foreach($ambil_data_ms_struktur as $row){
                ?>
              <tr>
                <td style="vertical-align:middle;text-align: center;">
                  <div class="checkbox">
                  <label>
                    <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_ms_struktur'];?>">
                  </label>
                  </div>
                </td>
                <td style="vertical-align:middle;"><?php echo $row['nama_ms_struktur']; ?></td>
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
        <div class="box-footer">
          <button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
    <?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="struktur_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_daftar/struktur/simpan_edit');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            <input type="hidden" name="id_struktur" value="<?= $id; ?>">
            <input type="hidden" name="id_instansi" value="<?= $id_instansi; ?>">
            <input type="hidden" name="id_ms_struktur_lama" value="<?= $id_ms_struktur; ?>">
          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>
      </div>
        <div class="box-body">
            <div class="row">         
            <div class="col-md-12">
                <label>Nama Kepengurusan</label>
                <?php
                  input_pdselect2("id_ms_struktur",$ambil_data_ms_struktur_null,$id_ms_struktur);
                ?>
            </div>   
              <div class="col-md-12">
                  <label>Status</label>
                  <?php
                  input_pdselect2("status_struktur",$cmd_status,$status_struktur);
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
});
</script>
<?php
}
elseif ($page=="pegawai_struktur")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('ol_daftar/pegawai_struktur/view/'.$id,' id="signupform" '); ?>
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
                input_pdselect2fleksibel("id_working","id_working",$ambil_data_rujukan_working_null,"id_working","nama_working",$id,"SEMUA");
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
           <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>

          <div class="box-tools pull-right">
            <?php
      //        input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
            ?>
          </div>
        </div>
        <div class="box-body">
        <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
          <thead>
            <tr>
              <th style="display:none;"></th>
              <th>Instansi</th>
              <th>Struktur</th>
              <th>Nama</th>
              <th>Signature</th>
              <th>Status</th>
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
elseif ($page=="pegawai_struktur_tambah")
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
      <?php echo form_open_multipart('ol_daftar/pegawai_struktur/tambah',' id="signupform" ');
  //      input_text("barcode_struktur",$id,"","","hidden");
  //      input_text("id_struktur",$id_struktur,"","","hidden");
      ?>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-2">
              <div class="form-group">
                <label>Upload Tanda Tangan</label>
                <?php
                  input_textcustom("upload_Files[]","","class='form-control-file' id='exampleInputFile' ","","file");
                ?>
                <p class="help-block">Saran png</p>
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <label>Jabatan struktur</label>
                <?php
                  input_pdselect2("id_struktur",$ambil_data_struktur_master_no_null,$id_struktur);
                ?>
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <label>Nama Pengurus</label>
                <?php
                  input_pdselect2("id_pegawai",$ambil_data_dropdown_pegawai_instansi_no_nulls,$id_pegawai);
                ?>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
    <?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="pegawai_struktur_edit")
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

    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
      <?php echo form_open_multipart('ol_daftar/pegawai_struktur/edit/'.$id,' id="signupform" ');
        input_text("barcode_pegawai_struktur",$id,"","","hidden");
        input_text("id_pegawai_struktur",$id_pegawai_struktur,"","","hidden");
        input_text("id_pegawai_lama",$id_pegawai,"","","hidden");
        input_text("id_struktur_lama",$id_struktur,"","","hidden");
      ?>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-3">
            <div class="col-md-12">
              <div class="form-group">
                <label>Upload Tanda Tangan</label>
                <?php
                  input_textcustom("upload_Files[]","","class='form-control-file' id='exampleInputFile' ","","file");
                ?>
              </div>
            </div>
            </div>
            <div class="col-md-9">
          <div class="col-md-9">
              <div class="form-group">
                <label>Struktur Instansi</label>
                <?php
                  input_pdselect2("id_struktur",$ambil_data_struktur_master_no_null,$id_struktur);
                ?>
              </div>
            </div>
            <div class="col-md-3">
                <label>Status</label>
                <?php
                input_pdselect2("status_pegawai_struktur",$cmd_status,$status_pegawai_struktur);
                ?>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Nama Pengurus</label>
                <?php
                  input_pdselect2("id_pegawai",$ambil_data_dropdown_pegawai_instansi_no_nulls,$id_pegawai);
                ?>
              </div>
            </div>            
          </div>
        </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
    <?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="pegawai_struktur_jabatan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_daftar/pegawai_struktur/simpan_jabatan');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">
      <input type="hidden" name="id_pegawai_struktur" value="<?= $id_pegawai_struktur; ?>">
          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
        <div class="row">        
          <div class="col-md-12">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Jabatan</th>
              </tr>
              </thead>
              <tbody>
                <?php
      /*          $arr = array();
                foreach($kewenangan_bk as $val){
                    $arr[] = $val['id_kewenangan'];
                }
                $eimplo = implode(",", $arr);*/
                foreach($cmd_jabatan_null as $row){
  //                if(in_array($row['id_jabatan'],explode(",", $id_jabatan))){
                ?>
              <tr>
                <td style="vertical-align:middle;">
  <div class="checkbox">
  <label>
    <input type="checkbox" <?php if(in_array($row['id_jabatan'],$id_jabatan)) echo 'checked="checked"'; ?> class="child" name="chk[]" value="<?= $row['id_jabatan'] ?>" >
  </label>
  </div>
                </td>
                <td style="vertical-align:middle;"><?php echo $row['nama_jabatan']; ?></td>

              </tr>
                <?php
  //                  }
                  }
                ?>
              </tbody>
            </table>
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
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true
    })
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
}); 
</script>
<?php
}
elseif ($page=="relasi")
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
  <?php echo form_open_multipart('ol_daftar/relasi/view/'.$id_jabatan_fungsional,' id="signupform" '); ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
    </div>
      <div class="box-body">
      <div class="row">
  <div class="col-md-6">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">CATATAN MOHON DIPERHATIKAN</h3>

          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
      <div class="box box-widget">
            <div class="box-body">
              <!-- post text -->
              <h5>
        <ul style="line-height: 1.6;">
        <li>KEWENANGAN INI KHUSUS UNTUK MENGISI BUKU PUTIH KEPERAWATAN</li>
        <li>SETELAH MENGISI INI HARAP MELINK KAN DENGAN BUTIR KEGIATAN AGAR DAPAT PRINT OUT UNTUK EUKOM</li>
        </ul>
        </h5>

            </div>
            <!-- /.box-body -->
          </div>          
        </div>
      </div>
    </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Jabatan Fungsional</label>
              <?php
                input_pdselect2fleksibel("id_jabatan_fungsional","id_jabatan_fungsional",$cmd_jabfung,"id_jabatan_fungsional","nama_jabatan_fungsional",$id_jabatan_fungsional,"Silahkan Pilih Jabatan Fungsional");
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
            <th style="display: none;width:5%;">ID</th>
            <th>Kewenangan</th>
            <th>Butir Kegiatan</th>
            <th style="width:15%;">Jabatan Fungsional</th>
            <th>Status</th>
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
elseif ($page=="relasi_tambah")
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
    <h1><?= $header ?></h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('ol_daftar/relasi/tambah/'.$id_jabatan_fungsional.'/'.$id_ruangan.'/'.$id_kode_kewenangan.'/'.$id_jabatan.'/'.$id_butir_kegiatan ,' id="signupform" ');
  ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">SILAHKAN PILIH BUTIR KEGIATAN YANG AKAN DI LINK KAN</h3>
    </div>
      <div class="box-body">
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label>Jabatan Fungsional</label>
              <?php
              input_pdselect2("id_jabatan_fungsional",$cmd_jabfung_buket,$id_jabatan_fungsional);
              ?>
          </div>
        </div>
        <div class="col-md-8">
          <div class="form-group">
            <label>Butir Kegiatan</label>
              <?php
              input_pdselect2("id_butir_kegiatan",$butir_kegiatan_no_null,$id_butir_kegiatan);
              ?>
          </div>
        </div>
      </div>
      </div>
    </div>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">SILAHKAN PILIH OPSI KEWENANGANNYA</h3>
    </div>
      <div class="box-body">
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label>Kompetensi</label>
              <?php
        input_pdselect2fleksibel("id_ruangan","id_ruangan",$cmd_ruangan,"id_ruangan","nama_ruangan",$id_ruangan,"Semua Kewenangan");
              ?>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>Jabatan</label>
              <?php
              input_pdselect2("id_jabatan",$cmd_jabatan,$id_jabatan);
              ?>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>PK</label>
              <?php
        input_pdselect2fleksibel("id_kode_kewenangan","id_kode_kewenangan",$kol_kode_kewenangan_null_pk,"id_kode_kewenangan","nama_kode_kewenangan",$id_kode_kewenangan,"Pilih Jika Ingin Sesuai PK");
              ?>
          </div>
        </div>
      </div>
      </div>
      <div class="box-footer">
    <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
      </div>
    </div>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"></h3>
          <div class="box-tools pull-right"></div>
        </div>
        <div class="box-body">
    <h5>KEWENANGAN YANG BELUM TERRELASI DENGAN BUTIR KEGIATAN</h5>
      <table id="example1" width="100%" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;">
            <input name="select_all" class="checkall" type="checkbox" />
          </th>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kewenangan</th>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kategori</th>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kode</th>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Sifat</th>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Jabatan</th>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kompetensi</th>
        </tr>
        </thead>
        <tbody>
          <?php
/*          $arr = array();
          foreach($kewenangan_bk as $val){
              $arr[] = $val['id_kewenangan'];
          }
          $eimplo = implode(",", $arr);*/
          foreach($kewenangan_look as $row){
        //    if(!in_array($row['id_kewenangan'],explode(",", $eimplo))){
          ?>
        <tr>
          <td style="vertical-align:middle;">
            <div class="checkbox">
            <label>
              <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_kewenangan'];?>" >
            </label>
            </div>
          </td>
          <td style="vertical-align:middle;"><?php echo $row['nama_kewenangan']; ?></td>
          <td style="vertical-align:middle;"><?php echo $row['nama_kompetensi']; ?></td>
          <td style="vertical-align:middle;"><?php echo $row['nama_kode_kewenangan']; ?></td>
          <td style="vertical-align:middle;"><?php echo $row['nama_sifat_kewenangan']; ?></td>
          <td style="vertical-align:middle;"><?php echo $row['nama_jabatan']; ?></td>
          <td style="vertical-align:middle;"><?php echo $row['nama_ruangan']; ?></td>
        </tr>
          <?php
       //       }
            }
          ?>
        </tbody>
      </table>
        </div>
        <div class="box-footer">
 <button type="submit" name="action" value="BtnSimpan" class="btn btn-success pull-left"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </div>
  <?php echo form_close(); ?>
    </section>
</div>
<?php
}
elseif ($page=="relasi_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_daftar/relasi/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_jabatan_fungsional" value="<?= $id_ruangan; ?>">
    <input type="hidden" name="id_kewenangan_bk" value="<?= $id_kewenangan_bk; ?>">
    <input type="hidden" name="id_butir_kegiatan_lama" value="<?= $id_butir_kegiatan; ?>">
    <input type="hidden" name="id_kewenangan_lama" value="<?= $id_kewenangan; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
          <div class="container col-md-12">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Kewenangan</label>
                    <?php
                      input_pdselect2("id_kewenangan",$cmd_kewenangan,$id_kewenangan);
                    ?>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Kewenangan</label>
                    <?php
                      input_pdselect2("id_butir_kegiatan",$butir_kegiatane,$id_butir_kegiatan);
                    ?>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Status</label>
                    <?php
                      input_pdselect2("status_kewenangan_bk",$cmd_status,$status_kewenangan_bk);
                    ?>
                </div>
              </div>
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
});
</script>
<?php
}
elseif ($page=="butir_kegiatan")
{
?> 
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
  <div class="row">
  <div class="col-md-6">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">CATATAN MOHON DIPERHATIKAN</h3>

          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
      <div class="box box-widget">
            <div class="box-body">
              <!-- post text -->
              <h5>
        <ul style="line-height: 1.6;">
        <li>DENGAN MENGISI INI SECARA OTOMATIS MENAMBAH KEWENANGAN DAN SUDAH TERLINK DENGAN BUTIR KEGIATAN TERSEBUT</li>
        </ul>
        </h5>

            </div>
            <!-- /.box-body -->
          </div>          
        </div>
      </div>
    </div>
  <div class="col-md-6">
  <?php echo form_open_multipart('ol_daftar/butir_kegiatan/view/'.$id,' id="signupform" '); ; 
  ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
    </div>
      <div class="box-body">
      <div class="row">
        <div class="col-md-11">
          <div class="form-group">
            <label>Jabatan Fungsional</label>
              <?php
                input_pdselect2fleksibel("id","id",$cmd_jabfung_buket,"id_jabatan_fungsional","nama_jabatan_fungsional",$id,"Silahkan Pilih JabFung");
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
  </div>    
  </div>    
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
        input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th style="display:none;">ID</th>           
            <th>Butir Kegiatan</th>           
            <th width="25%">Jabatan Fungsional</th>   
            <th>Angka Kredit</th>   
            <th>Satuan</th>   
            <th>Status</th>   
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
      <div class="modal-body" style="padding:10px; font-size:10px;">

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
elseif ($page=="butir_kegiatan_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_daftar/butir_kegiatan/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">
      <input type="hidden" name="id" value="<?= $id; ?>">
          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
        <div class="col-md-12">
          <div class="form-group">
            <label>Jabatan Fungsional</label>
            <?php
              input_pdselect2("id_jabatan_fungsional",$cmd_jabatan_fungsional_id,$id_jabatan_fungsional);
            ?>  
          </div>    
          <div class="form-group">
            <label id="text_nama_butir_kegiatan">Butir Kegiatan</label>
            <?php
              input_text("nama_butir_kegiatan",$nama_butir_kegiatan,"maxlength='255' autofocus required","Masukkan Butir Kegiatan","text");
            ?>  
          </div>  
          <div class="form-group">
            <label id="text_ms_angka_kredit">Angka Kredit</label>
            <?php
              input_textcustom("angka_kredit",$angka_kredit," class='form-control' required onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46' maxlength='7' autocomplete='off' ","","text");
            ?>
          </div>          
          <div class="form-group">
            <label>Satuan Hasil</label>
            <?php
              input_text("satuan_hasil",$satuan_hasil,"maxlength='255' required","Masukkan Satuan Hasil","text");
            ?>  
          </div>          
          <div class="form-group">
            <label>Status</label>
              <?php
                input_pdselect2("status_butir_kegiatan",$cmd_status,$status_butir_kegiatan);
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
}); 
</script>
<?php
}
elseif ($page=="butir_kegiatan_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_daftar/butir_kegiatan/simpan_edit');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">
      <input type="hidden" name="id" value="<?= $id; ?>">
      <input type="hidden" name="id_butir_kegiatan" value="<?= $id_butir_kegiatan; ?>">
      <input type="hidden" name="id_kewenangan" value="<?= $id_kewenangan; ?>">
          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
        <div class="col-md-12">
          <div class="form-group">
            <label>Jabatan Fungsional</label>
            <?php
              input_pdselect2("id_jabatan_fungsional",$cmd_jabatan_fungsional_id,$id_jabatan_fungsional);
            ?>  
          </div>    
          <div class="form-group">
            <label id="text_nama_butir_kegiatan">Butir Kegiatan</label>
            <?php
              input_text("nama_butir_kegiatan",$nama_butir_kegiatan,"maxlength='255' autofocus required","Masukkan Butir Kegiatan","text");
            ?>  
          </div>  
          <div class="form-group">
            <label id="text_ms_angka_kredit">Angka Kredit</label>
            <?php
              input_textcustom("angka_kredit",$angka_kredit," class='form-control' required onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46' maxlength='7' autocomplete='off' ","","text");
            ?>
          </div>          
          <div class="form-group">
            <label>Satuan Hasil</label>
            <?php
              input_text("satuan_hasil",$satuan_hasil,"maxlength='255' required","Masukkan Satuan Hasil","text");
            ?>  
          </div>          
          <div class="form-group">
            <label>Status</label>
              <?php
                input_pdselect2("status_butir_kegiatan",$cmd_status,$status_butir_kegiatan);
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
}); 
</script>
<?php
}
elseif ($page=="format_validator")
{
?> 
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
    <?php echo form_open_multipart('ol_daftar/format_validator/view/'.$id,' id="signupform" '); ; 
    ?>
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
                  input_pdselect2fleksibel("id","id",$ambil_data_rujukan_working_null,"id_working","nama_working",$id,"Silahkan Pilih Instansi");
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
        input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th style="display:none;">ID</th>           
            <th>Instansi</th>           
            <th>Jabatan</th>           
            <th>Jenis Pengajuan</th>   
            <th>Struktur</th>     
            <th>Status</th>   
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
      <div class="modal-body" style="padding:10px; font-size:10px;">

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
elseif ($page=="format_validator_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_daftar/format_validator/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">
      <input type="hidden" name="id" value="<?= $id; ?>">
          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-3">
            <label>Instansi</label>
            <?php
              input_pdselect2("id_instansi",$ambil_data_rujukan_working,$id_instansi);
            ?>  
          </div>    
          <div class="col-md-3">
            <label>Jabatan</label>
            <?php
              input_pdselect2fleksibel("id_jabatan","id_jabatan",$cmd_jabatan_null,"id_jabatan","nama_jabatan",$id_jabatan,"SEMUA");
            ?>  
          </div>    
          <div class="col-md-3">
            <label>Jenis Pengajuan</label>
            <?php
              input_pdselect2("id_status_diusulkan",$status_diusulkan_all,$id_status_diusulkan);
            ?>  
          </div>         
          <div class="col-md-3">
            <label>Status</label>
              <?php
                input_pdselect2("status_pengajuan_format_rs",$cmd_status,$status_pengajuan_format_rs);
              ?>  
          </div> 
          <div class="col-md-12">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Struktur Validator</th>
              </tr>
              </thead>
              <tbody>
                <?php
      /*          $arr = array();
                foreach($kewenangan_bk as $val){
                    $arr[] = $val['id_kewenangan'];
                }
                $eimplo = implode(",", $arr);*/
                foreach($ambil_data_ms_struktur_no_syarat as $row){
              //    if(!in_array($row['id_kewenangan'],explode(",", $eimplo))){
                ?>
              <tr>
                <td style="vertical-align:middle;">
                  <div class="checkbox">
                  <label>
                    <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_ms_struktur'];?>" >
                  </label>
                  </div>
                </td>
                <td style="vertical-align:middle;"><?php echo $row['nama_ms_struktur']; ?></td>

              </tr>
                <?php
             //       }
                  }
                ?>
              </tbody>
            </table>
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
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true
    })
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
}); 
</script>
<?php
}
elseif ($page=="format_validator_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_daftar/format_validator/simpan_edit');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">
      <input type="hidden" name="id_pengajuan_format_rs" value="<?= $id; ?>">
      <input type="hidden" name="id_instansi_lama" value="<?= $id_instansi; ?>">
      <input type="hidden" name="id_status_diusulkan_lama" value="<?= $id_status_diusulkan; ?>">
      <input type="hidden" name="id_jabatan_lama" value="<?= $id_jabatan; ?>">
          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-3">
            <label>Instansi</label>
            <?php
              input_pdselect2("id_instansi",$ambil_data_rujukan_working,$id_instansi);
            ?>  
          </div>    
          <div class="col-md-3">
            <label>Jabatan</label>
            <?php
              input_pdselect2fleksibel("id_jabatan","id_jabatan",$cmd_jabatan_null,"id_jabatan","nama_jabatan",$id_jabatan,"SEMUA");
            ?>  
          </div> 
          <div class="col-md-3">
            <label>Jenis Pengajuan</label>
            <?php
              input_pdselect2("id_status_diusulkan",$status_diusulkan_all,$id_status_diusulkan);
            ?>  
          </div>         
          <div class="col-md-3">
            <label>Status</label>
              <?php
                input_pdselect2("status_pengajuan_format_rs",$cmd_status,$status_pengajuan_format_rs);
              ?>  
          </div> 
          <div class="col-md-12">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Struktur Validator</th>
              </tr>
              </thead>
              <tbody>
                <?php
      /*          $arr = array();
                foreach($kewenangan_bk as $val){
                    $arr[] = $val['id_kewenangan'];
                }
                $eimplo = implode(",", $arr);*/
                foreach($ambil_data_ms_struktur_no_syarat as $row){
                ?>
              <tr>
                <td style="vertical-align:middle;">
                  <div class="checkbox">
<label>
  <input type="checkbox" class="child" name="chk[]" value="<?= $row['id_ms_struktur']; ?>" <?php if(in_array($row['id_ms_struktur'],explode(",", $ms_struktur))) echo 'checked="checked"'; ?> >
</label>
                  </div>
                </td>
                <td style="vertical-align:middle;"><?php echo $row['nama_ms_struktur']; ?></td>

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
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
    $('.select2').select2()
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true,
    })
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
}); 
</script>
<?php
}