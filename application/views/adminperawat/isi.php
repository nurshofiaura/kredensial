<?php
//=================================== H O M E ================================================
$arraybox = array('warning','success','info','danger');
$resarray = array_rand($arraybox);
$thenarray = $arraybox[$resarray];
if ($page=="home")
{
?>
  <div class="content-wrapper">
    <section class="content">
	<div class="col-md-8">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">SEBELUM ISI PENGUMUMAN MOHON CEK DI PROFIL HARUS SESUAI DENGAN JABFUNG TUJUAN (PERAWAT/BIDAN)</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
					  <div class="direct-chat-messages">
						<?php
						foreach($ambil_pengumuman as $rowumum){
							if(empty($rowumum['foto'])){
								$url_thumbex=base_url().'assets/images/noavatar.jpg';
								$url_picbesarex=base_url().'assets/images/noavatar.jpg';
							}else{
								$cek_filesmall=FCPATH.'assets/foto/'.$rowumum['foto'];
								if(file_exists($cek_filesmall)){
									$url_thumbex=base_url().'assets/foto/'.$rowumum['foto'];
									$url_picbesarex=base_url().'assets/foto/'.$rowumum['foto'];
								}else{
									$url_thumbex=base_url().'assets/images/noavatar.jpg';
									$url_picbesarex=base_url().'assets/images/noavatar.jpg';
								}
							}
						?>
						<div class="direct-chat-msg">
						  <div class="direct-chat-info clearfix">
							<span class="direct-chat-name pull-left"><?php echo $rowumum['nama_pegawai']; ?></span>
							<span class="direct-chat-timestamp pull-right">
							<?php echo date('d-m-Y', strtotime($rowumum['tgl_pengumuman'])); ?> <?php echo $rowumum['jam_pengumuman']; ?></span>
						  </div>
							<a class="example-image-link" href="<?php echo $url_picbesarex; ?>"
								data-lightbox="example-set" data-title="<?php echo $rowumum['nama_pegawai']; ?>">
								<img class="direct-chat-img" src="<?php echo $url_thumbex; ?>" alt="message user image">
							</a>
						  <div class="direct-chat-text">
							<?php echo $rowumum['isi_pengumuman']; ?>
						  </div>
						  <!-- /.direct-chat-text -->
						</div>
						<!-- /.direct-chat-msg -->
						<?php
						}
						?>
					  </div>
        </div>
        <div class="box-footer">
		  <?php echo form_open('admin_perawat',' class="form-horizontal"'); ?>
			<div class="input-group">
			  <input type="hidden" name="id_pegawai" value="<?php echo $member_id; ?>" class="form-control">
			  <input type="text" name="isi_pengumuman" placeholder="Ketik Pengumuman ..." class="form-control">
			  <span class="input-group-btn">
					<button type="submit" name="action" value="BtnProses" class="btn btn-warning btn-flat">Send</button>
				  </span>
			</div>
		  <?php echo form_close(); ?>
        </div>
      </div>
    </div>
	<div class="col-md-4">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">SURAT IJIN EXPIRED</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
					  <div class="direct-chat-messages">
							<?php
							foreach($ambil_berkas_expired_all as $row){
							if(empty($row['foto'])){
								$url_thumbx=base_url().'assets/images/noavatar.jpg';
								$url_picbesarx=base_url().'assets/images/noavatar.jpg';
							}else{
								$cek_filesmall=FCPATH.'assets/foto/'.$row['foto'];
								if(file_exists($cek_filesmall)){
									$url_thumbx=base_url().'assets/foto/'.$row['foto'];
									$url_picbesarx=base_url().'assets/foto/'.$row['foto'];
								}else{
									$url_thumbx=base_url().'assets/images/noavatar.jpg';
									$url_picbesarx=base_url().'assets/images/noavatar.jpg';
								}
							}
							?>
						<div class="direct-chat-msg">
						  <div class="direct-chat-info clearfix">
							<span class="direct-chat-name pull-left"><?php echo $row['nama_pegawai']; ?></span>
							<span class="direct-chat-timestamp pull-right"> <?php echo date('d-m-Y', strtotime($row['tgl_b_berkas'])); ?></span>
						  </div>
							<a class="example-image-link" href="<?php echo $url_picbesarx; ?>"
								data-lightbox="example-set" data-title="<?php echo $row['nama_pegawai']; ?> - <?php echo $row['nama_ruangan']; ?>">
								<img class="direct-chat-img" src="<?php echo $url_thumbx; ?>" alt="message user image">
							</a>
						  	<span class="label label-danger pull-right"><?php echo $row['nama_kategori_berkas']; ?></span>
						  <!-- /.direct-chat-text -->
						</div>
							<?php
							}
							?>
					  </div>
        </div>
      </div>
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
        <?php echo $header; ?> - Cek Jabfung Non Keperawatan Jika Tidak Muncul di Tabel Ini
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
            <th style="width:5%;"></th>
					  <th style="display:none;"></th>
					  <th>Nama</th>
					  <th>Jabfung</th>
					  <th>Ruangan</th>
					  <th>NIP</th>
					  <th>NIRA</th>
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
  <div class="modal-dialog modal-md">
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
				           <h3 class="box-title">HAK AKSES LAINNYA</h3>

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
									  <th>Keterangan</th>
									  <th>Judul</th>
									  <th>Isi</th>
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
elseif ($page=="cat_oppe_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_perawat/cat_oppe/simpan_edit');?>" onClick="return cek();">
       <input type="hidden" name="kode_catatan" value="<?= $id; ?>">
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
							  <label>Judul</label>
								<?php
									input_text("nama_catatan",$nama_catatan,"maxlength='255' ","Ketikkan","text");
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
elseif ($page=="akses")
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
				           <h3 class="box-title">HAK AKSES LAINNYA</h3>

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
									  <th style="width:5%">ID</th>
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
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_perawat/akses/simpan_tambah');?>" onClick="return cek();">
       <input type="hidden" name="id_pegawai" value="<?= $id; ?>">
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
// ================================== di controller user
elseif ($page=="user_tambah")
{
$standar_ft=base_url().'assets/images/noavatar.jpg';
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
        <?php echo $header; ?> <small> <?php echo $instance_name; ?></small>
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
		  <?php echo form_open_multipart('admin_perawat/user/tambah',' id="signupform" ');
	input_text("wa",$pake_wa,"","","hidden");
	input_text("instance_name",$instance_name,"","","hidden");
		  ?>
		<div class="box-body">
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">USER</h3>
			</div>
			  <div class="box-body">
				<div class="row">
					<div class="col-md-4">
						<div class="box-body box-profile">
							<a class="example-image-link" href="<?php echo $standar_ft; ?>"
								data-lightbox="example-set" data-title="Sample Ukuran Gambar">
								<img class="img-responsive" src="<?php echo $standar_ft; ?>" alt="Photo">
							</a>

						</div><hr>
						<div class="col-md-12">
							<div class="form-group">
							  <label for="exampleInputFile">Foto</label>
								<?php
									input_textcustom("upload_Files[]","","class='form-control-file' id='exampleInputFile' ","","file");
								?>
							  <p class="help-block">gif, png, jpg, jpeg</p>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<div class="col-md-6">
							<div class="form-group">
							  <label>Nama Pegawai</label>
								<?php
									input_text("nama_pegawai",$nama_pegawai,"maxlength='60' required autofocus ","Ketikkan Nama","text");
								?>
							</div>
						</div>
            <div class="col-md-6">
							<div class="form-group">
                <label>No Induk Pegawai/ Karyawan &nbsp; <small><span style="font-weight:bold;" id="msg2"></span></small></label>
                <?php
									input_textcustom("nip",$nip," required id='nip'
												onkeypress='if (event.keyCode == 32) { return false; }' class='form-control'",
														"Ketikkan NIP","text");
								?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							  <label>Email</label>
								<?php
									input_text("email",$email,"maxlength='255' ","Ketikkan Email","text");
								?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							  <label>Jabatan Pegawai</label>
								<?php
									input_pdselect2("tipe_pegawai",$cmd_tipe_pegawai,$tipe_pegawai);
								?>
							</div>
						</div>
            <div class="col-md-6">
							<div class="form-group">
							  <label>Jabatan Fungsional</label>
								<?php
									input_pdselect2fleksibel("id_jabatan_fungsional","id_jabatan_fungsional",$cmd_jabfung,"id_jabatan_fungsional","nama_jabatan_fungsional",$id_jabatan_fungsional,"Tidak Ada Jabfung");
								?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							  <label>No WA </label><small><b> Format : 628xxxxx</b></small>
								<?php
									input_textcustom("no_hp",$no_hp," required
												onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
														"Ketikkan No HP format kode negara","text");
								?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							  <label>Level</label>
								<?php
									input_pdselect2("id_level",$cmd_level_program,$id_level);
								?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							  <label>Unit</label>
								<?php
									input_pdselect2("id_unit",$cmd_unit,$id_unit);
								?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							  <label>Ruangan</label>
								<?php
									input_pdselect2fleksibel("id_ruangan","id_ruangan",$cmd_ruangan,"id_ruangan","nama_ruangan",$id_ruangan,"Tidak Ada Ruangan");
								?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							  <label>Jenis Kelamin</label>
								<?php
									input_pdselect2("jk",$gender,$jk);
								?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							  <label>PK</label>
								<?php
									input_pdselect2fleksibel("id_kode_kewenangan","id_kode_kewenangan",$cmd_ambil_kode_kewenangan,"id_kode_kewenangan","nama_kode_kewenangan",$id_kode_kewenangan,"Belum Ada PK");
								?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							  <label>Username &nbsp; <small><span style="font-weight:bold;" id="msg"></span></small></label>
								<?php
									input_textcustom("username",$username," maxlength='60' class='form-control' autocomplete='off' id='username' required ",
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
// ================================== di controller user
elseif ($page=="user_edit")
{
if(empty($foto)){
	$standar_ft=base_url().'assets/images/noavatar.jpg';
}else{
	$cek_filesmall=FCPATH.'assets/foto/'.$foto;
	if(file_exists($cek_filesmall)){
		$standar_ft=base_url().'assets/foto/'.$foto;
	}else{
		$standar_ft=base_url().'assets/images/noavatar.jpg';
	}
}
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
        <?php echo $header; ?> <small> <?php echo $instance_name; ?></small>
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
		  <?php echo form_open_multipart('admin_perawat/user/edit/'.$id,' id="signupform" ');
				input_text("id_pegawai",$id,"","","hidden");
				input_text("wa",$pake_wa,"","","hidden");
				input_text("nip_lama",$nip,"","","hidden");
				input_text("instance_name",$instance_name,"","","hidden");
		  ?>
		<div class="box-body">
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">USER</h3>
			</div>
			  <div class="box-body">
				<div class="row">
					<div class="col-md-4">
						<div class="box-body box-profile">
							<a class="example-image-link" href="<?php echo $standar_ft; ?>"
								data-lightbox="example-set" data-title="Sample Ukuran Gambar">
								<img class="img-responsive" src="<?php echo $standar_ft; ?>" style="width:300px" alt="Photo">
							</a>

						</div><hr>
						<div class="col-md-12">
							<div class="form-group">
							  <label for="exampleInputFile">Foto</label>
								<?php
									input_textcustom("upload_Files[]","","class='form-control-file' id='exampleInputFile' ","","file");
								?>
							  <p class="help-block">gif, png, jpg, jpeg</p>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<div class="col-md-6">
							<div class="form-group">
							  <label>Nama Pegawai</label>
								<?php
									input_text("nama_pegawai",$nama_pegawai,"maxlength='60' required autofocus ","Ketikkan Nama","text");
								?>
							</div>
						</div>
            <div class="col-md-6">
							<div class="form-group">
							  <label>Nomor Induk Pegawai / Karyawan</label>
                <?php
									input_textcustom("nip",$nip," required
												onkeypress='if (event.keyCode == 32) { return false; }' class='form-control'",
														"Ketikkan NIP","text");
								?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							  <label>Email</label>
								<?php
									input_text("email",$email,"maxlength='255' ","Ketikkan Email","text");
								?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							  <label>Jabatan Pegawai</label>
								<?php
									input_pdselect2("tipe_pegawai",$cmd_tipe_pegawai,$tipe_pegawai);
								?>
							</div>
						</div>
            <div class="col-md-6">
							<div class="form-group">
							  <label>Jabatan Fungsional</label>
								<?php
									input_pdselect2fleksibel("id_jabatan_fungsional","id_jabatan_fungsional",$cmd_jabfung,"id_jabatan_fungsional","nama_jabatan_fungsional",$id_jabatan_fungsional,"Tidak Ada Jabfung");
								?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							  <label>No WA </label><small><b> Format : 628xxxxx</b></small>
								<?php
									input_textcustom("no_hp",$no_hp," required
												onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
														"Ketikkan No HP format kode negara","text");
								?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							  <label>Unit</label>
								<?php
									input_pdselect2("id_unit",$cmd_unit,$id_unit);
								?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							  <label>Ruangan</label>
								<?php
									input_pdselect2fleksibel("id_ruangan","id_ruangan",$cmd_ruangan,"id_ruangan","nama_ruangan",$id_ruangan,"Tidak Ada Ruangan");
								?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							  <label>Jenis Kelamin</label>
								<?php
									input_pdselect2("jk",$gender,$jk);
								?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							  <label>PK</label>
								<?php
									input_pdselect2fleksibel("id_kode_kewenangan","id_kode_kewenangan",$cmd_ambil_kode_kewenangan,"id_kode_kewenangan","nama_kode_kewenangan",$id_kode_kewenangan,"Belum Ada PK");
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
					  <th style="display:none;"></th>
					  <th>Username</th>
					  <th>Level</th>
					  <th>Satus</th>
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
  <div class="modal-dialog modal-xl">
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
<?php
}
elseif ($page=="user_user_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_perawat/user/simpan_tambah');?>" onClick="return cek();">
       <input type="hidden" name="id_pegawai" value="<?= $id; ?>">
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
					<div class="container col-md-12">
						<div class="row">
						<div class="col-md-12">
							<div class="form-group">
							  <label>Username</label>
								<?php
									input_textcustom("username",$username," maxlength='60' class='form-control' autocomplete='off' required ",
													"Huruf kecil tanpa spasi dan spesial character kecuali -","text");
								?>
							</div>
						</div>
							<div class="col-md-12">
								<div class="form-group">
								  <label>Level</label>
										<?php
											input_pdselect2("id_level",$cmd_level_program,$id_level);
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
elseif ($page=="user_user_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_perawat/user/simpan_edit');?>" onClick="return cek();">
		<input type="hidden" name="id_user" value="<?= $id; ?>">
		<input type="hidden" name="id_pegawai" value="<?= $idpeg; ?>">
		<input type="hidden" name="username_lama" value="<?= $username; ?>">
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
					<div class="container col-md-12">
						<div class="row">
						<div class="col-md-12">
							<div class="form-group">
							  <label>Username</label>
								<?php
									input_textcustom("username",$username," maxlength='60' class='form-control' autocomplete='off' required ",
													"Huruf kecil tanpa spasi dan spesial character kecuali -","text");
								?>
							</div>
						</div>
							<div class="col-md-12">
								<div class="form-group">
								  <label>Level</label>
										<?php
											input_pdselect2("id_level",$cmd_level_program,$id_level);
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
elseif ($page=="user_lihat")
{
  if(empty($potonya)){
  	$standar_fte=base_url().'assets/images/noavatar.jpg';
  }else{
  	$cek_filesmall=FCPATH.'assets/foto/'.$potonya;
  	if(file_exists($cek_filesmall)){
  		$standar_fte=base_url().'assets/foto/'.$potonya;
  	}else{
  		$standar_fte=base_url().'assets/images/noavatar.jpg';
  	}
  }
?>
	   <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo $namanya; ?></h3>
            <div class="box-tools pull-right">

            </div>
        </div>
    		<div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="box-body box-profile">
                <a class="example-image-link" href="<?php echo $standar_fte; ?>"
                  data-lightbox="example-set" data-title="Sample Ukuran Gambar">
                  <img class="img-responsive" src="<?php echo $standar_fte; ?>" style="width:300px" alt="Photo">
                </a>
              </div>
            </div>
            <div class="col-md-6">
              USER LEVEL : USERNAME
              <hr>
              <?php
              foreach($levelnya as $row){
              ?>
              <p class="text-muted">
                <?= $row['nama_level'] ?> : <font color="green"><strong><?= $row['username'] ?></strong></font>
              </p>
              <hr>
              <?php
              }
               ?>
            </div>
           </div>
        </div>
      </div>
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
					  <th width="5%">ID</th>
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
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_perawat/kategori_kompetensi/simpan_tambah');?>" onClick="return cek();">
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
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_perawat/kategori_kompetensi/simpan_edit');?>" onClick="return cek();">
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
	<?php echo form_open_multipart('admin_perawat/kategori_kewenangan/view/'.$id_jabatan,' id="signupform" '); ?>
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
					  <th width="5%">ID</th>
					  <th width="45%">Nama</th>
					  <th>Kompetensi</th>
					  <th>Jabatan</th>
					  <th width="5%">Waktu</th>
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
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_perawat/kategori_kewenangan/simpan_tambah');?>" onClick="return cek();">
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
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_perawat/kategori_kewenangan/simpan_edit');?>" onClick="return cek();">
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
elseif ($page=="warna")
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
			<table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
				<thead>
					<tr>
					  <th width="5%" >KD</th>
					  <th>Nama</th>
					  <th>Kode</th>
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
elseif ($page=="warna_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_perawat/warna/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
		<div class="box-body">
	  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
		<div class="box-header with-border">
		  <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
		</div>
		  <div class="box-body">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
                  <label>Nama Warna</label>
					<?php
						input_text("nama_warna",$nama_warna,"maxlength='255' autofocus required","Masukkan Nama","text");
					?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
                  <label>Kode Warna</label>
					<input type="text" name="kode_warna" class="form-control colorpicker">
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
	$('.colorpicker').colorpicker()
});
</script>
<?php
}
elseif ($page=="warna_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_perawat/warna/simpan_edit');?>" onClick="return cek();">
		<input type="hidden" name="id_warna" value="<?= $id; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
		<div class="box-body">
	  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
		<div class="box-header with-border">
		  <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
		</div>
		  <div class="box-body">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
                  <label>Nama Warna</label>
					<?php
						input_text("nama_warna",$nama_warna,"maxlength='255' autofocus required","Masukkan Nama","text");
					?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
                  <label>Kode Warna</label>
					<input type="text" name="kode_warna" class="form-control colorpicker">
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
	$('.colorpicker').colorpicker()
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
	<?php echo form_open_multipart('admin_perawat/kompetensi/view/'.$id,' id="signupform" '); ?>
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
					  <th style="width:5%;">KD</th>
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
elseif ($page=="kompetensi_tambah")
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
	<?php echo form_open_multipart('admin_perawat/kompetensi/tambah',' id="signupform" ');
	input_text("program_jabatan",$program_jabatan,"","","hidden");
	?>
	  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
		<div class="box-header with-border">
		  <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
		</div>
		  <div class="box-body">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
                  <label>Kewenangan</label>
					<?php
						input_pdselect2("id_kewenangan",$cmd_kewenangan,$id_kewenangan);
					?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
                  <label>Kode Kewenangan</label>
					<?php
					//	input_pdselect2("id_kode_kewenangan",$cmd_kode_kewenangan,$id_kode_kewenangan);
	input_pdselect2fleksibel("id_kode_kewenangan","id_kode_kewenangan",$cmd_kode_kewenangan_null,"id_kode_kewenangan","nama_kode_kewenangan",$id,"Tanpa Kode Kewenangan");
					?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
                  <label>Jenis Kewenangan</label>
					<?php
				//		input_pdselect2("id_sifat_kewenangan",$cmd_sifat_kewenangan,$id_sifat_kewenangan);
	input_pdselect2fleksibel("id_sifat_kewenangan","id_sifat_kewenangan",$cmd_sifat_kewenangan_null,"id_sifat_kewenangan","nama_sifat_kewenangan",$id,"Tanpa Jenis Kewenangan");
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
           <h3 class="box-title">PILIH RUANGAN</h3>

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
					foreach($cmd_ruangan as $row){
					?>
				<tr>
					<td style="vertical-align:middle;">
					  <div class="checkbox">
						<label>
						  <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_ruangan'];?>">
						</label>
					  </div>
					</td>
					<td style="vertical-align:middle;"><?php echo $row['nama_ruangan']; ?></td>
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
	<?php echo form_open_multipart('admin_perawat/kompetensi/tambah_unit/'.$id,' id="signupform" ');
	input_text("id_jabatan",$id,"","","hidden");
	input_text("program_jabatan",$program_jabatan,"","","hidden");
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
								input_pdselect2("id_unit",$cmd_ruangan_unit,$id_unit);
							?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
		                  <label>Kode Kewenangan</label>
							<?php
							//	input_pdselect2("id_kode_kewenangan",$cmd_kode_kewenangan,$id_kode_kewenangan);
			input_pdselect2fleksibel("id_kode_kewenangan","id_kode_kewenangan",$cmd_kode_kewenangan_null,"id_kode_kewenangan","nama_kode_kewenangan",$id_kode_kewenangan,"Tanpa Kode Kewenangan");
							?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
		                  <label>Jenis Kewenangan</label>
							<?php
						//		input_pdselect2("id_sifat_kewenangan",$cmd_sifat_kewenangan,$id_sifat_kewenangan);
			input_pdselect2fleksibel("id_sifat_kewenangan","id_sifat_kewenangan",$cmd_sifat_kewenangan_null,"id_sifat_kewenangan","nama_sifat_kewenangan",$id_sifat_kewenangan,"Tanpa Jenis Kewenangan");
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
					foreach($cmd_kewenangan_with_jabatan as $row){
					?>
				<tr>
					<td style="vertical-align:middle;">
					  <div class="checkbox">
						<label>
						  <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_kewenangan'];?>">
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
elseif ($page=="kompetensi_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_perawat/kompetensi/simpan_edit');?>" onClick="return cek();">
		<input type="hidden" name="id_kewenangan_detil" value="<?= $id; ?>">
		<input type="hidden" name="id_kewenangan_lama" value="<?= $id_kewenangan; ?>">
		<input type="hidden" name="id_kode_kewenangan_lama" value="<?= $id_kode_kewenangan; ?>">
		<input type="hidden" name="id_unit_lama" value="<?= $id_unit; ?>">
		<input type="hidden" name="id_sifat_kewenangan_lama" value="<?= $id_sifat_kewenangan; ?>">
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
						input_pdselect2("id_kewenangan",$cmd_kewenangan,$id_kewenangan);
					?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
                  <label>Kode Kewenangan</label>
					<?php
					//	input_pdselect2("id_kode_kewenangan",$cmd_kode_kewenangan,$id_kode_kewenangan);
	input_pdselect2fleksibel("id_kode_kewenangan","id_kode_kewenangan",$cmd_kode_kewenangan_null,"id_kode_kewenangan","nama_kode_kewenangan",$id_kode_kewenangan,"Tanpa Kode Kewenangan");
					?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
                  <label>Jenis Kewenangan</label>
					<?php
				//		input_pdselect2("id_sifat_kewenangan",$cmd_sifat_kewenangan,$id_sifat_kewenangan);
	input_pdselect2fleksibel("id_sifat_kewenangan","id_sifat_kewenangan",$cmd_sifat_kewenangan_null,"id_sifat_kewenangan","nama_sifat_kewenangan",$id_kode_kewenangan,"Tanpa Jenis Kewenangan");
					?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					<label>Ruangan</label>
					<?php
						input_pdselect2("id_unit",$cmd_ruangan_rperawat,$id_unit);
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
elseif ($page=="kompetensi_clone")
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
	<?php echo form_open_multipart('admin_perawat/kompetensi/clone/'.$id,' id="signupform" '); ?>
	  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
		<div class="box-header with-border">
		  <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
		</div>
		  <div class="box-body">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
                  <label>Kewenangan</label>
					<?php
						input_pdselect2("id_kewenangan",$cmd_kewenangan,$id_kewenangan);
					?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
                  <label>Kode Kewenangan</label>
					<?php
					//	input_pdselect2("id_kode_kewenangan",$cmd_kode_kewenangan,$id_kode_kewenangan);
	input_pdselect2fleksibel("id_kode_kewenangan","id_kode_kewenangan",$cmd_kode_kewenangan_null,"id_kode_kewenangan","nama_kode_kewenangan",$id,"Tanpa Kode Kewenangan");
					?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
                  <label>Jenis Kewenangan</label>
					<?php
				//		input_pdselect2("id_sifat_kewenangan",$cmd_sifat_kewenangan,$id_sifat_kewenangan);
	input_pdselect2fleksibel("id_sifat_kewenangan","id_sifat_kewenangan",$cmd_sifat_kewenangan_null,"id_sifat_kewenangan","nama_sifat_kewenangan",$id,"Tanpa Jenis Kewenangan");
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
           <h3 class="box-title">PILIH RUANGAN</h3>

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

					foreach($cmd_ruangan as $row){
					?>
				<tr>
					<td style="vertical-align:middle;">
					  <div class="checkbox">
						<label>
						  <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_ruangan'];?>">
						</label>
					  </div>
					</td>
					<td style="vertical-align:middle;"><?php echo $row['nama_ruangan']; ?></td>
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
elseif ($page=="butir_kegiatan")
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
	<?php echo form_open_multipart('admin_perawat/butir_kegiatan/view/'.$id,' id="signupform" '); ?>
	  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
		<div class="box-header with-border">
		  <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
		</div>
		  <div class="box-body">
			<div class="row">
			<div class="col-md-12">
			  <div class="form-group">
				<label>Status Pegawai</label>
					<?php
						input_pdselect2("id_status_pegawai",$cmd_tipe_pegawai,$id_status_pegawai);
					?>
			  </div>
			</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label>Jabatan</label>
							<?php
								input_pdselect2fleksibel("id","id",$cmd_jabfung,"id_jabatan_fungsional","nama_jabatan_fungsional",$id,"Semua");
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
					  <th>Nama Butir Kegiatan</th>
					  <th>A K</th>
					  <th>Output</th>
					  <th>Jabatan Fungsional</th>
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
elseif ($page=="butir_kegiatan_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_perawat/butir_kegiatan/simpan_tambah');?>" onClick="return cek();">
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
										input_text("nama_butir_kegiatan",$nama_butir_kegiatan,"maxlength='255' required autofocus","Masukkan Nama","text");
									?>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
								  <label>Angka Kredit (untuk desimal pakai titik .)</label>
									<?php
										input_text("ms_angka_kredit",$ms_angka_kredit,"maxlength='9' required
										onkeypress='return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46' ","Masukkan Angka Kredit","text");
									?>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
								  <label>Satuan Hasil</label>
									<?php
										input_text("ms_satuan_hasil",$ms_satuan_hasil,"maxlength='255' required","Masukkan Nama","text");
									?>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
							  <label>Jabatan</label>
									<?php
										input_pdselect2("id_jabatan_fungsional",$cmd_jabatan_fungsional,$id_jabatan_fungsional);
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
elseif ($page=="butir_kegiatan_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_perawat/butir_kegiatan/simpan_edit');?>" onClick="return cek();">
		<input type="hidden" name="id_butir_kegiatan" value="<?= $id; ?>">
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
										input_text("nama_butir_kegiatan",$nama_butir_kegiatan,"maxlength='255' required autofocus","Masukkan Nama","text");
									?>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
								  <label>Angka Kredit (untuk desimal pakai titik .)</label>
									<?php
										input_text("ms_angka_kredit",$ms_angka_kredit,"maxlength='9' required
										onkeypress='return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46' ","Masukkan Angka Kredit","text");
									?>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
								  <label>Satuan Hasil</label>
									<?php
										input_text("ms_satuan_hasil",$ms_satuan_hasil,"maxlength='255' required","Masukkan Nama","text");
									?>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
							  <label>Jabatan</label>
									<?php
										input_pdselect2("id_jabatan_fungsional",$cmd_jabatan_fungsional,$id_jabatan_fungsional);
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
elseif ($page=="butir_kewenangan")
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
	<?php echo form_open_multipart('admin_perawat/butir_kewenangan/view/'.$id_jabatan_fungsional.'/'.$id_butir_kegiatan,' id="signupform" '); ?>
	  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
		<div class="box-header with-border">
		  <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
		</div>
		  <div class="box-body">
			<div class="row">
			<div class="col-md-12">
			  <div class="form-group">
				<label>Jabatan Fungsional</label>
					<?php
						input_pdselect2("id_jabatan_fungsional",$cmd_jabatan_fungsional,$id_jabatan_fungsional);
					?>
			  </div>
			</div>
				<div class="col-md-12">
			  <div class="form-group">
				<label>Butir Kegiatan</label>
					<?php
						input_pdselect2("id_butir_kegiatan",$cmd_butir_kegiatan,$id_butir_kegiatan);
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
					  <th width="5%">IDKW</th>
					  <th>Kewenangan</th>
					  <th>Butir Kegiatan</th>
					  <th>Jabatan Fungsional</th>
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
if ($page=="butir_kewenangan_tambah")
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
	  <?php echo form_open('admin_perawat/butir_kewenangan/tambah/'.$id_jabatan_fungsional.'/'.$id_butir_kegiatan.'/'.$id_kode_kewenangan,' '); ?>
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
              <div class="box-body">
				<?php //	input_text("id_butir_kegiatan",$id_butir_kegiatan,"","","hidden");
						input_text("id_kode_kewenangan",$id_kode_kewenangan,"","","hidden");
					//	input_text("id_jabatan_fungsional",$id_jabatan_fungsional,"","","hidden");
				?>
				<div class="col-md-12">
					<a href="<?php echo base_url();?>admin_perawat/butir_kewenangan/view/<?php echo $id_jabatan_fungsional; ?>/<?php echo $id_butir_kegiatan; ?>"
						class="btn btn-success btn-xs" > <i class="fa fa-reply"></i> Kembali
					</a>
				</div>
				<div class="col-md-12"><hr><h3><?php echo $title; ?> <small>Tanggal : <?php echo date('d-m-Y'); ?></small></h3><hr>
			<div class="col-md-12">
			  <div class="form-group">
				<label>Jabatan Fungsional</label>
					<?php
						input_pdselect2("id_jabatan_fungsional",$cmd_jabatan_fungsional,$id_jabatan_fungsional);
					?>
			  </div>
			</div>
				<div class="col-md-12">
			  <div class="form-group">
				<label>Butir Kegiatan</label>
					<?php
						input_pdselect2("id_butir_kegiatan",$cmd_butir_kegiatan,$id_butir_kegiatan);
					?>
			  </div>
				</div>
					  <table id="example1" width="100%" class="table table-bordered table-striped">
						  <thead>
							<tr>
								<th style="background-color:#9b0e27;color:white;vertical-align:middle;">
									<input name="select_all" class="checkall" type="checkbox" />
								</th>
								<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kewenangan</th>
								<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kode</th>
								<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Sifat</th>
							</tr>
						  </thead>
						  <tbody>
								<?php
								$no=0;
								$arr = array();
								foreach($kr_jabatan_fungsional as $val){
										$arr[] = $val['id_kewenangan'];
								}
								$eimplo = implode(",", $arr);
								foreach($kewenangan as $row){
									$no++;
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
								<td style="vertical-align:middle;"><?php echo $row['id_kewenangan'];?> - <?php echo $row['nama_kewenangan']; ?></td>
								<td style="vertical-align:middle;"><?php echo $row['nama_kode_kewenangan']; ?></td>
								<td style="vertical-align:middle;"><?php echo $row['nama_sifat_kewenangan']; ?></td>
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
		<?php echo form_close(); ?>
	  </div>
    </section>
</div>
<?php
}
elseif ($page=="seting_dupak")
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
	<?php echo form_open_multipart('admin_perawat/seting_dupak/view/'.$id_pegawai.'/'.$bulan.'/'.$tahun,' id="signupform" '); ?>
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
						input_pdselect2fleksibel("id_pegawai","id_pegawai",$cmd_pegawai,"id_pegawai","nama_pegawai",$id_pegawai,"Pilih Pegawai Lebih Dulu");
					?>
			  </div>
			</div>
			<div class="col-md-6">
			  <div class="form-group">
				<label>Bulan</label>
					<?php
						input_pdselect2("bulan",$cmd_bulan,$bulan);
					?>
			  </div>
			</div>
			<div class="col-md-6">
			  <div class="form-group">
				<label>Tahun</label>
					<?php
						input_pdselect2("tahun",$cmd_range_tahun,$tahun);
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
					  <th>Butir Kegiatan</th>
					  <th style="text-align:right">Bulan</th>
					  <th style="text-align:right">Tahun</th>
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
    <section class="content-header">
		<a href="<?php echo $link_kembali;?>"
			class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
		</a>
    </section>
    <section class="content">
	<?php echo form_open_multipart('etik/etik/view/'.$id_jabatan,' id="signupform" '); ?>
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
					  <th>ID</th>
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
    <section class="content-header">
		<a href="<?php echo $link_awal;?>"
			class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
		</a>
    </section>
    <section class="content">
	<?php echo form_open_multipart('etik/etik/tambah',' id="signupform" '); ?>
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
    <section class="content-header">
		<a href="<?php echo $link_awal;?>"
			class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
		</a>
    </section>
    <section class="content">
	<?php echo form_open_multipart('etik/etik/edit/'.$id_jabatan,' id="signupform" ');
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
elseif ($page=="butir_pegawai")
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
	<?php echo form_open_multipart('admin_perawat/butir_pegawai/view/'.$id_jabatan,' id="signupform" '); ?>
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
						input_pdselect2fleksibel("id_jabatan","id_jabatan",$cmd_jabatan_null,"id_jabatan","nama_jabatan",$id_jabatan,"Semua Jabatan");
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
					  <th width="5%">IDKW</th>
					  <th>Kewenangan</th>
					  <th>Butir Kegiatan</th>
					  <th>Jabatan Fungsional</th>
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
	<?php echo form_open_multipart('admin_perawat/lulus/view/'.$id,' id="signupform" '); ?>
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
	<?php echo form_open_multipart('admin_perawat/lulus/tambah/'.$id.'/'.$id_kompetensi,' id="signupform" ');
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
elseif ($page=="intro")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
	  <?php echo form_open_multipart('admin_perawat/intro',' ');
		input_text("id_instansi",$instance_id,"","","hidden");
		?>
      <div class="box box-<?php echo $thenarray; ?> box-solid">
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
			  <label>Nama Website</label>
				<?php
					input_text("nama_instansi",$instance_name,"maxlength='255' ","","text");
				?>
			  <label>Header Website</label>
				<?php
					input_text("web_header",$web_header,"maxlength='255' ","","text");
				?>
			  <label>Intro Website</label>
				<?php
					input_text("web_intro",$web_intro,"maxlength='255' ","","text");
				?>
			  <label>Slider Website ( GUNAKAN | UNTUK KATA SELANJUTNYA)</label>
				<?php
					input_text("web_slider",$web_slider,"maxlength='255' ","","text");
				?>
			  <label>Narasi Website</label>
				<?php
					input_textareacustom("welcome",$welcome," id='editor1' rows='10' cols='100' class='form-control' ","Masukkan Intro");
				?>
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
elseif ($page=="faq")
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
			<table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
				<thead>
					<tr>
					  <th width="5%">ID</th>
					  <th>Pertanyaan</th>
					  <th>Judul</th>
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
elseif ($page=="faq_tambah")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
	  <?php echo form_open_multipart('admin_perawat/faq/tambah',' ');
		?>
      <div class="box box-<?php echo $thenarray; ?> box-solid">
        <div class="box-header with-border">
          <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
			  <label>Pertanyaan</label>
				<?php
					input_text("faq",$faq,"maxlength='255' ","","text");
				?>
			  <label>Judul</label>
				<?php
					input_text("judul_faq",$judul_faq,"maxlength='255' ","","text");
				?>
			  <label>Status</label>
					<?php
						input_pdselect2("status_faq",$cmd_status,$status_faq);
					?>
			  <label>Jawaban</label>
				<?php
					input_textareacustom("isi_faq",$isi_faq," id='editor1' rows='10' cols='100' class='form-control' ","Masukkan Isi");
				?>
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
elseif ($page=="faq_edit")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
	  <?php echo form_open_multipart('admin_perawat/faq/edit/'.$id,' ');
	  input_text("id_faq",$id_faq,"","","hidden");
		?>
      <div class="box box-<?php echo $thenarray; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
			  <label>Pertanyaan</label>
				<?php
					input_text("faq",$faq,"maxlength='255' ","","text");
				?>
			  <label>Judul</label>
				<?php
					input_text("judul_faq",$judul_faq,"maxlength='255' ","","text");
				?>
			  <label>Status</label>
					<?php
						input_pdselect2("status_faq",$cmd_status,$status_faq);
					?>
			  <label>Jawaban</label>
				<?php
					input_textareacustom("isi_faq",$isi_faq," id='editor1' rows='10' cols='100' class='form-control' ","Masukkan Isi");
				?>
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
elseif ($page=="faq_input")
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
		<?php echo form_open_multipart('admin_perawat/faq/input',' id="signupform" ');
		?>
        <div class="box-body">
			  <label>Pilih Berkas &nbsp;<small">Format harus JPG,GIF,JPEG,PNG</small></label>
				<?php
					input_text("upload_Files[]",""," required","","file");
				?>

			  <label>Nama Image</label>
				<?php
					input_text("nama_faq_image",$nama_faq_image,"maxlength='255' required","Masukkan Nama","text");
						?>
			  <label>Status</label>
					<?php
						input_pdselect2("status_faq_image",$cmd_status,$status_faq_image);
					?>
        </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
		<?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="faq_rubah")
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
		<?php echo form_open_multipart('admin_perawat/faq/rubah/'.$id,' id="signupform" ');
		input_text("id_faq_image",$id_faq_image,"","","hidden");
		?>
        <div class="box-body">
			  <label>Nama Image</label>
				<?php
					input_text("nama_faq_image",$nama_faq_image,"maxlength='255' required","Masukkan Nama","text");
						?>
			  <label>Status</label>
					<?php
						input_pdselect2("status_faq_image",$cmd_status,$status_faq_image);
					?>
        </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
		<?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
