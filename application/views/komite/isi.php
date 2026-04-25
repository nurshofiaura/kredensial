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
           <h3 class="box-title">PENGUMUMAN</h3>

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
        <?php echo $header; ?> <small> <?php echo $instance_name; ?></small>
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
					  <th style="display:none;"></th>
					  <th>Nama</th>
					  <th>No HP</th>
					  <th>Ruangan</th>
					  <th>NIP</th>
					  <th>NIRA</th>
					  <th>Gambar</th>
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
		  <?php echo form_open_multipart('komite/user/tambah',' id="signupform" ');
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
		  <?php echo form_open_multipart('komite/user/edit/'.$id,' id="signupform" ');
				input_text("id_pegawai",$id_pegawai,"","","hidden");
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
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('komite/user/simpan_tambah');?>" onClick="return cek();">
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
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('komite/user/simpan_edit');?>" onClick="return cek();">
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
elseif ($page=="logbook")
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
	<div class="col-md-4">
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
		  <div class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">
			  <?php $logoe=base_url().'assets/images/logosim.png'; ?>
                <img class="img-circle" src="<?php echo $logoe; ?>" alt="User Image">
                <span class="username">CATATAN</span>
                <span class="description"><?php echo $instance_name;?></span>
              </div>
              <!-- /.user-block -->
              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- post text -->
              <h5>Mohon perhatikan :
			  <ul style="line-height: 1.6;">
				<li>Tidak dapat memvalidasi diri sendiri.</li>
				<li>Tidak dapat memvalidasi yang sudah di validasi Jabatan Lainnya.</li>
				<li>Validasi ini digunakan untuk Karu tanpa PENGAJUAN KOMPETENSI</li>
				<li>Validasi Karu tanpa PENGAJUAN KOMPETENSI tidak bisa mendapatkan SURAT PENUGASAN KLINIS</li>
			  </ul>
			  </h5>

            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </div>
	<div class="col-md-8">
	<?php echo form_open_multipart('komite/logbook/view/'.$first_date.'/'.$last_date.'/'.$id,' id="signupform" '); ;
	?>
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
								input_pdselect2fleksibel("id","id",$cmd_pegawai_null,"id_pegawai","nama_pegawai",$id,"Semua");
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
					  <th width="5%"></th>
					  <th>ID</th>
					  <th>Tanggal</th>
					  <th>Nama</th>
					  <th>Kode</th>
					  <th>Nama Kewenangan</th>
					  <th>Jumlah</th>
					  <th>Asesor</th>
					  <th>Komite</th>
					  <th>Ditolak</th>
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
elseif ($page=="pengajuan_kompetensi")
{
?>
		<style>
		.rainbow-text {
		  background-image: linear-gradient(to left, violet, indigo, blue, green, yellow, orange, red);
		  -webkit-background-clip: text;
		  -webkit-text-fill-color: transparent;
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
           <h3 class="box-title"></h3>

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
					  <th width="5%">ID</th>
					  <th>Nama Pegawai</th>
					  <th>Kompetensi</th>
					  <th>Tanggal</th>
					  <th>Komite</th>
					  <th><i class="fa fa-search"></i> Sub Kredensial</th>
					  <th><i class="fa fa-search"></i> Sub Mutu</th>
					  <th><i class="fa fa-search"></i> Sub Etika</th>
					  <th><i class="fa fa-search"></i> Rekomendasi</th>
					  <th>Status SPK</th>
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
elseif ($page=="pengajuan_kompetensi_isi")
{
?>
<style>
	.rainbow-text {
	  background-image: linear-gradient(to left, violet, indigo, blue, green, yellow, orange, red);
	  -webkit-background-clip: text;
	  -webkit-text-fill-color: transparent;
	}
	table td {
		word-wrap: break-word;
	}
</style>
  <div class="content-wrapper">
    <section class="content-header">
		<a href="<?php echo $link_awal;?>"
			class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
		</a>
    </section>
    <section class="content">
	  <?php echo form_open_multipart('komite/pengajuan_kompetensi/isi/'.$id,' id="signupform" '); ;
			if(empty($foto)){
				$url_thumbx=base_url().'assets/images/noavatar.jpg';
				$url_picbesarx=base_url().'assets/images/noavatar.jpg';
			}else{
				$cek_filesmall=FCPATH.'assets/foto/member/small/'.$foto;
				if(file_exists($cek_filesmall)){
					$url_thumbx=base_url().'assets/foto/member/small/'.$foto;
					$url_picbesarx=base_url().'assets/foto/member/original/'.$foto;
				}else{
					$url_thumbx=base_url().'assets/images/noavatar.jpg';
					$url_picbesarx=base_url().'assets/images/noavatar.jpg';
				}
			}
	  ?>
		<div class="row">
			<div class="col-md-4">
	      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
	        <div class="box-header with-border">
	           <h3 class="box-title">PROFIL</h3>

	          <div class="box-tools pull-right">
	            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
	                    title="Collapse">
	              <i class="fa fa-minus"></i></button>
	            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
	              <i class="fa fa-times"></i></button>
	          </div>
	        </div>
					<div class="box-body box-profile">
								<a class="example-image-link" href="<?php echo $url_picbesarx; ?>" 
									data-lightbox="example-set" data-title="<?php echo $nama_pegawai; ?>">
									<img class="profile-user-img img-responsive img-circle" 
										src="<?php echo $url_thumbx; ?>" style="width:50px;height:50px;" alt="User profile picture">
								</a>

							  <h3 class="profile-username text-center"><?php echo $nama_pegawai; ?><br><?php echo $nama_status_diusulkan; ?></h3>

							  <p class="text-muted text-center"></p>	
							  <strong><i class="fa fa-book margin-r-5"></i> TTL / Umur</strong>
							  <p class="text-muted">
								<?php echo $tmp_lahir; ?>, <?php echo date('d-m-Y', strtotime($tgl_lahir)); ?> / 
								<?php
									$birthage = $tgl_lahir;
									$interval = date_diff(date_create(), date_create($birthage));
									$umur = $interval->format("%Y Tahun, %M Bulan, %d Hari");
									echo $umur;						
								?>
							  </p>
							  <strong><i class="fa fa-book margin-r-5"></i> Agama</strong>
							  <p class="text-muted">
								<?php echo $nama_agama; ?>
							  </p>
							  <strong><i class="fa fa-book margin-r-5"></i> Marital Status</strong>
							  <p class="text-muted">
								<?php echo $nama_status_kawin; ?>
							  </p>
							  <strong><i class="fa fa-pencil margin-r-5"></i> No</strong>
							  <p>
								NIP : <?php echo $nip; ?><br>
								NIRA / IBI : <?php echo $no_profesi; ?>
							  </p>
							  <strong><i class="fa fa-book margin-r-5"></i> Pendidikan</strong>
							  <p class="text-muted">
								<?php echo $nama_pendidikan; ?>
							  </p>			
							  <strong><i class="fa fa-phone margin-r-5"></i> No HP</strong>
							  <p class="text-muted">
								<a href="tel:<?php echo $no_hp; ?>" target="_blank"><?php echo $no_hp; ?></a>
							  </p>
							  <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>
							  <p class="text-muted">
								<a href="mailto:<?php echo $email; ?>" target="_blank"><?php echo $email; ?></a>
							  </p>
							  <strong><i class="fa fa-book margin-r-5"></i> Status Pegawai</strong>
							  <p class="text-muted">
								<?php echo $nama_status_pegawai; ?>
							  </p>
								<strong><i class="fa fa-map-marker margin-r-5"></i> Unit / Ruangan</strong>
							  <p class="text-muted">
								<?php echo $nama_ruangan; ?>
							  </p>
								<strong><i class="fa fa-map-marker margin-r-5"></i> Jabatan Fungsional</strong>
							  <p class="text-muted">
								<?php echo $nama_jabatan_fungsional; ?>
							</p>
								<strong><i class="fa fa-map-marker margin-r-5"></i> Alamat</strong>
							  <p class="text-muted">
								<?php echo $alamat; ?>					  
							  </p>		  
	        </div>
	      </div>	
	      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
	        <div class="box-header with-border">
	           <h3 class="box-title"><i class="fa fa-exclamation btn btn-warning blinking"></i> 
	           	<font color="red">SIMPAN DATA SAJA TANPA ACC</font>
	           </h3>

	          <div class="box-tools pull-right">

	          </div>
	        </div>
	        <div class="box-body">
						<?php
						if($status_pengajuan=="1" AND $acc_kabid=="1" AND $acc_asesor=="1" AND $acc_komite=="0" AND $acc_direktur=="0" AND $acc_logbook_komite=="0"){
						?>
							<p><strong><font color="green">(UNTUK KEPERLUAN TES KREDENSIAL, MUTU DAN ETIKA)</font>
							</strong></p>
							<button type="submit" name="action" value="BtnSimpan" class="btn btn-app">
								<i class="fa fa-save"></i> Simpan
							</button>
						<?php
						}
						?> 
	        </div>
	      </div>
	    </div>	
			<div class="col-md-8">
	      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
	        <div class="box-header with-border">
	           <h3 class="box-title">BERKAS DAN ETIK</h3>

	          <div class="box-tools pull-right">
	            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
	                    title="Collapse">
	              <i class="fa fa-minus"></i></button>
	            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
	              <i class="fa fa-times"></i></button>
	          </div>
	        </div>
	        <div class="box-body">
					  <div class="table-responsive mailbox-messages">
						<table class="table table-hover table-striped">
						  <thead>
							  <tr>
								<th rowspan="2" style="vertical-align:middle;text-align:center;background: #800000;color:white;width:10%;">PILIH</th>
								<th rowspan="2" style="vertical-align:middle;text-align:center;background: #800000;color:white;">Nama Berkas</th>
								<th colspan="4" style="vertical-align:middle;text-align:center;background: #800000;color:white;">KESESUAIAN BUKTI </th>
							  </tr>
							  <tr>
								<th style="vertical-align:middle;text-align:center;width:5%;background: #800000;color:white;">Tersedia</th>
								<th style="vertical-align:middle;text-align:center;width:5%;background: #800000;color:white;">Shahih</th>
								<th style="vertical-align:middle;text-align:center;width:5%;background: #800000;color:white;">Asli</th>
								<th style="vertical-align:middle;text-align:center;width:5%;background: #800000;color:white;">Terkini</th>
							  </tr>
						  </thead>
						  <tbody>
								  <tr>
									<td colspan="6" style="vertical-align:middle;text-align:left;background: #800000;color:white;"><i class="fa fa-file-text"></i> IJASAH</td>
								  </tr>
								  <?php
									if(!empty($id_ijasah)){
										foreach($ambil_berkas_data as $row){
											if (in_array($row['id_berkas'],$id_ijasah)) {
								  ?>
									  <tr>
										<td style="vertical-align:middle;text-align:center;">
											<div class="checkbox">
											  <label>
												<input name="id_4_ijasah[]" value="<?php echo $row['id_berkas']; ?>" checked="checked" type="checkbox">
											  </label>
											</div>
										</td>
										<td style="vertical-align:middle;text-align:left;">
											<a href="<?php echo base_url('assets/berkas/'.$row['link_berkas']);?>" target="_blank" class="btn bg-maroon btn-xs">
												<i class="fa fa-search"> <?php echo substr($row['nama_berkas'], 0, 50); ?> ...</i>
											</a>
										</td>
									<td style="vertical-align:middle;text-align:center;">
										<div class="checkbox">
										  <label>
											<input name="kesesuaian_bukti[]" value="<?php echo $row['id_berkas']; ?>_1" <?php if(in_array($row['id_berkas']."_1",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
										  </label>
										</div>
									</td>
									<td style="vertical-align:middle;text-align:center;">
										<div class="checkbox">
										  <label>
											<input name="kesesuaian_bukti[]" value="<?php echo $row['id_berkas']; ?>_2" <?php if(in_array($row['id_berkas']."_2",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
										  </label>
										</div>
									</td>
									<td style="vertical-align:middle;text-align:center;">
										<div class="checkbox">
										  <label>
											<input name="kesesuaian_bukti[]" value="<?php echo $row['id_berkas']; ?>_3" <?php if(in_array($row['id_berkas']."_3",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
										  </label>
										</div>
									</td>
									<td style="vertical-align:middle;text-align:center;">
										<div class="checkbox">
										  <label>
											<input name="kesesuaian_bukti[]" value="<?php echo $row['id_berkas']; ?>_4" <?php if(in_array($row['id_berkas']."_4",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
										  </label>
										</div>
									</td>
									  </tr>
								  <?php
											}
										}
									}
								  ?>
								  <tr>
									<td colspan="6" style="vertical-align:middle;text-align:left;background: #800000;color:white;"><i class="fa fa-file-text"></i> STR</td>
								  </tr>
								  <?php
									if($id_str!==""){
										foreach($ambil_berkas_data as $row2){
											if (in_array($row2['id_berkas'],$id_str)) {
								  ?>
									  <tr>
										<td style="vertical-align:middle;text-align:center;">
											<div class="checkbox">
											  <label>
												<input name="id_4_str[]" value="<?php echo $row2['id_berkas']; ?>" checked="checked" type="checkbox">
											  </label>
											</div>
										</td>
										<td style="vertical-align:middle;text-align:left;">
											<a href="<?php echo base_url('assets/berkas/'.$row2['link_berkas']);?>" target="_blank" class="btn bg-maroon btn-xs">
												<i class="fa fa-search"> <?php echo substr($row2['nama_berkas'], 0, 50); ?> ...</i>
											</a>
										</td>
									<td style="vertical-align:middle;text-align:center;">
										<div class="checkbox">
										  <label>
											<input name="kesesuaian_bukti[]" value="<?php echo $row2['id_berkas']; ?>_1" <?php if(in_array($row2['id_berkas']."_1",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
										  </label>
										</div>
									</td>
									<td style="vertical-align:middle;text-align:center;">
										<div class="checkbox">
										  <label>
											<input name="kesesuaian_bukti[]" value="<?php echo $row2['id_berkas']; ?>_2" <?php if(in_array($row2['id_berkas']."_2",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
										  </label>
										</div>
									</td>
									<td style="vertical-align:middle;text-align:center;">
										<div class="checkbox">
										  <label>
											<input name="kesesuaian_bukti[]" value="<?php echo $row2['id_berkas']; ?>_3" <?php if(in_array($row2['id_berkas']."_3",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
										  </label>
										</div>
									</td>
									<td style="vertical-align:middle;text-align:center;">
										<div class="checkbox">
										  <label>
											<input name="kesesuaian_bukti[]" value="<?php echo $row2['id_berkas']; ?>_4" <?php if(in_array($row2['id_berkas']."_4",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
										  </label>
										</div>
									</td>
									  </tr>
								  <?php
											}
										}
									}
								  ?>
								  <tr>
									<td colspan="6" style="vertical-align:middle;text-align:left;background: #800000;color:white;"><i class="fa fa-file-text"></i> SERTIFIKAT </td>
								  </tr>
								  <?php
									if($id_sertifikat!==""){
										foreach($ambil_berkas_data as $row3){
											if (in_array($row3['id_berkas'],$id_sertifikat)) {
								  ?>
									  <tr>
										<td style="vertical-align:middle;text-align:center;">
											<div class="checkbox">
											  <label>
												<input name="id_4_sertifikat[]" value="<?php echo $row3['id_berkas']; ?>" checked="checked" type="checkbox">
											  </label>
											</div>
										</td>
										<td style="vertical-align:middle;text-align:left;">
											<a href="<?php echo base_url('assets/berkas/'.$row3['link_berkas']);?>" target="_blank" class="btn bg-maroon btn-xs">
												<i class="fa fa-search"> <?php echo substr($row3['nama_berkas'], 0, 50); ?> ...</i>
											</a>
										</td>
									<td style="vertical-align:middle;text-align:center;">
										<div class="checkbox">
										  <label>
											<input name="kesesuaian_bukti[]" value="<?php echo $row3['id_berkas']; ?>_1" <?php if(in_array($row3['id_berkas']."_1",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
										  </label>
										</div>
									</td>
									<td style="vertical-align:middle;text-align:center;">
										<div class="checkbox">
										  <label>
											<input name="kesesuaian_bukti[]" value="<?php echo $row3['id_berkas']; ?>_2" <?php if(in_array($row3['id_berkas']."_2",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
										  </label>
										</div>
									</td>
									<td style="vertical-align:middle;text-align:center;">
										<div class="checkbox">
										  <label>
											<input name="kesesuaian_bukti[]" value="<?php echo $row3['id_berkas']; ?>_3" <?php if(in_array($row3['id_berkas']."_3",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
										  </label>
										</div>
									</td>
									<td style="vertical-align:middle;text-align:center;">
										<div class="checkbox">
										  <label>
											<input name="kesesuaian_bukti[]" value="<?php echo $row3['id_berkas']; ?>_4" <?php if(in_array($row3['id_berkas']."_4",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
										  </label>
										</div>
									</td>
									  </tr>
								  <?php
											}
										}
									}
								  ?>
								  <tr>
									<td colspan="6" style="vertical-align:middle;text-align:left;background: #800000;color:white;"><i class="fa fa-file-text"></i> Berkas Lainnya</td>
								  </tr>
								  <?php
								//	if($id_ijasah!==""){
									if(!empty($id_berkas)){
										foreach($ambil_berkas_data as $row){
											if (in_array($row['id_berkas'],$id_berkas)) {
								  ?>
									  <tr>
										<td style="vertical-align:middle;text-align:center;">
											<div class="checkbox">
											  <label>
												<input name="id_4_berkas[]" value="<?php echo $row['id_berkas']; ?>" checked="checked" type="checkbox">
											  </label>
											</div>
										</td>
										<td style="vertical-align:middle;text-align:left;">
											<a href="<?php echo base_url('assets/berkas/'.$row['link_berkas']);?>" target="_blank" class="btn bg-maroon btn-xs">
												<i class="fa fa-search"> <?php echo substr($row['nama_berkas'], 0, 50); ?> ...</i>
											</a>
										</td>
									<td style="vertical-align:middle;text-align:center;">
										<div class="checkbox">
										  <label>
											<input name="kesesuaian_bukti[]" value="<?php echo $row['id_berkas']; ?>_1" <?php if(in_array($row['id_berkas']."_1",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
										  </label>
										</div>
									</td>
									<td style="vertical-align:middle;text-align:center;">
										<div class="checkbox">
										  <label>
											<input name="kesesuaian_bukti[]" value="<?php echo $row['id_berkas']; ?>_2" <?php if(in_array($row['id_berkas']."_2",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
										  </label>
										</div>
									</td>
									<td style="vertical-align:middle;text-align:center;">
										<div class="checkbox">
										  <label>
											<input name="kesesuaian_bukti[]" value="<?php echo $row['id_berkas']; ?>_3" <?php if(in_array($row['id_berkas']."_3",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
										  </label>
										</div>
									</td>
									<td style="vertical-align:middle;text-align:center;">
										<div class="checkbox">
										  <label>
											<input name="kesesuaian_bukti[]" value="<?php echo $row['id_berkas']; ?>_4" <?php if(in_array($row['id_berkas']."_4",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
										  </label>
										</div>
									</td>
									  </tr>
								  <?php
											}
										}
									}
								  ?>
								  <tr>
									<td colspan="6" style="vertical-align:middle;text-align:left;background: #800000;color:white;"><i class="fa fa-book"></i> LOGBOOK</td>
								  </tr>
								  <tr>
									<td colspan="2" style="vertical-align:middle;text-align:center;">LOGBOOK BISA LIHAT GRAFIK </td>
									<td style="vertical-align:middle;text-align:center;">
										<div class="checkbox">
										  <label>
											<input name="kesesuaian_bukti[]" value="9" <?php if(in_array("9",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
										  </label>
										</div>
									</td>
									<td style="vertical-align:middle;text-align:center;">
										<div class="checkbox">
										  <label>
											<input name="kesesuaian_bukti[]" value="10" <?php if(in_array("10",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
										  </label>
										</div>
									</td>
									<td style="vertical-align:middle;text-align:center;">
										<div class="checkbox">
										  <label>
											<input name="kesesuaian_bukti[]" value="11" <?php if(in_array("11",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
										  </label>
										</div>
									</td>
									<td style="vertical-align:middle;text-align:center;">
										<div class="checkbox">
										  <label>
											<input name="kesesuaian_bukti[]" value="12" <?php if(in_array("12",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
										  </label>
										</div>
									</td>
								  </tr>
								  <tr>
									<td colspan="6" style="vertical-align:middle;text-align:left;background: #800000;color:white;"><i class="fa fa-file-o"></i> ETIK PEGAWAI</td>
								  </tr>
								  <tr>
									<td colspan="6">
										<table width="100%" class="table table-bordered table-striped">
											<thead>
												<tr>
													<th style="vertical-align:middle;text-align:center;font-weight:bold;background: #800000;color:white;">Tanggal</th>
													<th style="vertical-align:middle;text-align:center;font-weight:bold;background: #800000;color:white;">Hasil</th>
													<th style="vertical-align:middle;text-align:center;font-weight:bold;background: #800000;color:white;">Penguji</th>
													<th style="vertical-align:middle;text-align:center;font-weight:bold;background: #800000;color:white;"><i class="fa fa-search"></i></th>
													<th style="vertical-align:middle;text-align:center;width:5%;font-weight:bold;background: #800000;color:white;">Tersedia</th>
													<th style="vertical-align:middle;text-align:center;width:5%;font-weight:bold;background: #800000;color:white;">Shahih</th>
													<th style="vertical-align:middle;text-align:center;width:5%;font-weight:bold;background: #800000;color:white;">Asli</th>
													<th style="vertical-align:middle;text-align:center;width:5%;font-weight:bold;background: #800000;color:white;">Terkini</th>
												</tr>
											</thead>
											<tbody>
											<?php
												foreach($ambil_data_etik_pegawai_oppe as $rowambil_data_etik_pegawai_oppe){
													if (in_array($rowambil_data_etik_pegawai_oppe['id_etik_pegawai'],$id_etik_pegawai)) {
											?>
											  <tr>
												<td style="vertical-align:middle;text-align:center;"><?php echo date('d-m-Y', strtotime($rowambil_data_etik_pegawai_oppe['tgl_etik_pegawai'])); ?></td>
												<td style="vertical-align:middle;text-align:center;"><?php echo $rowambil_data_etik_pegawai_oppe['hasil_etik']; ?></td>
												<td style="vertical-align:middle;text-align:center;"><?php echo $rowambil_data_etik_pegawai_oppe['nama_pegawai']; ?></td>
												<td style="vertical-align:middle;text-align:center;">
												<a href="<?php echo base_url('pegawai/pengajuan_kompetensi/pdf_etika/'.$rowambil_data_etik_pegawai_oppe['id_etik_pegawai']);?>" class="btn bg-green btn-xs" target="_blank">
												<i class="fa fa-file-pdf-o"></i> pdf</a>
												</td>
												<td style="vertical-align:middle;text-align:center;">
													<div class="checkbox">
													  <label>
														<input name="kesesuaian_bukti[]" value="<?php echo $rowambil_data_etik_pegawai_oppe['id_etik_pegawai']; ?>_etik1" <?php if(in_array($rowambil_data_etik_pegawai_oppe['id_etik_pegawai']."_etik1",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
													  </label>
													</div>
												</td>
												<td style="vertical-align:middle;text-align:center;">
													<div class="checkbox">
													  <label>
														<input name="kesesuaian_bukti[]" value="<?php echo $rowambil_data_etik_pegawai_oppe['id_etik_pegawai']; ?>_etik2" <?php if(in_array($rowambil_data_etik_pegawai_oppe['id_etik_pegawai']."_etik2",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
													  </label>
													</div>
												</td>
												<td style="vertical-align:middle;text-align:center;">
													<div class="checkbox">
													  <label>
														<input name="kesesuaian_bukti[]" value="<?php echo $rowambil_data_etik_pegawai_oppe['id_etik_pegawai']; ?>_etik3" <?php if(in_array($rowambil_data_etik_pegawai_oppe['id_etik_pegawai']."_etik3",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
													  </label>
													</div>
												</td>
												<td style="vertical-align:middle;text-align:center;">
													<div class="checkbox">
													  <label>
														<input name="kesesuaian_bukti[]" value="<?php echo $rowambil_data_etik_pegawai_oppe['id_etik_pegawai']; ?>_etik4" <?php if(in_array($rowambil_data_etik_pegawai_oppe['id_etik_pegawai']."_etik4",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
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
									</td>
								  </tr>
						  </tbody>
						</table>
						<!-- /.table -->
					  </div>
	        </div>
					<div class="box-footer">
					  <div class="mailbox-controls">
						<!-- Check all button -->
								<div class="pull-right">
									<button type="button" class="btn btn-default btn-sm checkbox-toggle">
									<i class="fa fa-search"></i> KLIK BERKAS UNTUK MELIHAT BERKAS DAN UNCHECK UNTUK <i class="fa fa-trash"></i> MEMBUANG BERKAS
									</button>
								</div>
						<!-- /.pull-right -->
					  </div>
					</div>
	      </div>	  
	    </div>	
			<div class="col-md-9">
	      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
	        <div class="box-header with-border">
	           <h3 class="box-title">VALIDASI DATA LOGBOOK</h3>

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
									  <th>Tanggal</th>
									  <th>Jam</th>
									  <th>Kode</th>
									  <th>Nama Kewenangan</th>
									  <th>Jumlah</th>
									  <th>Komite</th>
									  <th>Ditolak</th>
									</tr>
								</thead>
							</table>
	        </div>
	      </div>	  
	    </div>	
			<div class="col-md-3">
	      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
	        <div class="box-header with-border">
	           <h3 class="box-title">DAFTAR KOMPETENSI</h3>
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
								<th style="background-color:#9b0e27;color:white;text-align:left;">Kewenangan</th>
								<th style="background-color:#9b0e27;color:white;text-align:right;">Jumlah</th>
							</tr>
						  </thead>
						  <tbody>
								<?php
								foreach($ambil_lobook_kompetensi_group_pengajuan as $row){
								?>
							<tr>
								<td style="text-align:left;"><?php echo $row['nama_kewenangan']; ?></td>
								<td style="text-align:right;"><?php echo $row['num']; ?></td>
							</tr>
								<?php
									}
								?>
						  </tbody>
					  </table>
	        </div>
	      </div>	  
	    </div>	
			<div class="col-md-6">
	      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
	        <div class="box-header with-border">
	           <h1 class="box-title">MOHON PERHATIKAN TOMBOL AKAN MUNCUL BILA JUMLAH DAN TERVALIDASI SAMA</h1>
	          <div class="box-tools pull-right"></div>
	        </div>
	        <div class="box-body">
					<p><span class="blinking"><i class="fa fa-exclamation"></i></span>
					<span class="rainbow-text">VALIDASI DAHULU SEMUA LOGBOOK => SIMPAN DAN ACC => SIMPAN SETUJU / TOLAK </span></p>
						 <?php if($acc_logbook_komite=='0' AND $tampilkan_button == 'sama'){ ?>
							<button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-check"></i> Simpan dan Acc</button>
						<?php
						 } ?>
	        </div>
	      </div>	  
	    </div>	
			<div class="col-md-6">
	      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
	        <div class="box-header with-border">
	           <h1 class="box-title">MOHON PERHATIKAN TOMBOL AKAN MUNCUL BILA JUMLAH DAN TERVALIDASI SAMA</h1>
	          <div class="box-tools pull-right"></div>
	        </div>
	        <div class="box-body">
					<p><span class="blinking"><i class="fa fa-exclamation"></i></span>
					<span class="rainbow-text">VALIDASI DAHULU SEMUA LOGBOOK => SIMPAN DAN ACC => SIMPAN SETUJU / TOLAK </span></p>
					  <div class="mailbox-controls">
							<?php
							if($status_pengajuan=="1" AND $acc_kabid=="1" AND $acc_asesor=="1" AND $acc_komite=="0" AND $acc_direktur=="0" AND $acc_logbook_komite=="1"){
							?>
								<button type="submit" name="action" value="BtnOke" class="btn btn-app">
									<i class="fa fa-check"></i> Simpan & Setuju
								</button>
								<button name="action" value="BtnTolak" class="btn btn-app">
									<i class="fa fa-close"></i> Simpan & Tolak
								</button>
							<?php
							}
							?>
					  </div>
	        </div>
	      </div>	  
	    </div>
	    <?php if($id_status_diusulkan == 4){ ?>
			<div class="col-md-12">
	      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
	        <div class="box-header with-border">
	           <h3 class="box-title">
							LOGBOOK DAN KEGIATAN PEMULIHAN <?= $tahun ?>
			   </h3>
	        </div>
	        <div class="box-body">
	          <div class="box-tools pull-right">
	          		
	          </div>
	    			<table width="100%" class="table table-bordered table-striped table-hover" >
						<thead>
								<tr>
									<th class="center py-1 px-1 bg-dark" style="vertical-align:middle;font-weight:bold;width:5%;">ID</th>
									<th class="center py-1 px-1 bg-dark" style="vertical-align:middle;font-weight:bold;width:10%;">Tanggal Awal</th>
									<th class="center py-1 px-1 bg-dark" style="vertical-align:middle;font-weight:bold;width:10%;">Tanggal Akhir</th>
									<th class="center py-1 px-1 bg-dark" style="vertical-align:middle;font-weight:bold;width:15%">Nama</th>
									<th class="center py-1 px-1 bg-dark" style="vertical-align:middle;font-weight:bold;width:15%">Ruangan</th>
									<th class="center py-1 px-1 bg-dark" style="vertical-align:middle;font-weight:bold;width:15%">Penanggung Jawab</th>
									<th class="center py-1 px-1 bg-dark" style="vertical-align:middle;font-weight:bold;width:15%">Tempat</th>
									<th class="center py-1 px-1 bg-dark" style="vertical-align:middle;font-weight:bold;">Hasil</th>
									<th class="center py-1 px-1 bg-dark" style="vertical-align:middle;font-weight:bold;">Catatan</th>
								</tr>
						</thead>
						<tbody>
						<?php
							$ambil_lobook_pemulihan_pertahun = $this->m_rancak->ambil_lobook_pemulihan_pertahun($id_pegawai,$tahun);
							foreach($ambil_lobook_pemulihan_pertahun as $rowambil_lobook_pemulihan_pertahun){
						?>
					  <tr> 
					  	<td class="center py-1 px-1" style="vertical-align:middle;"><?= $rowambil_lobook_pemulihan_pertahun['id_logbook_pemulihan'] ?></td>
					    <td class="center py-1 px-1" style="vertical-align:middle;"><?= date('d-m-Y', strtotime($rowambil_lobook_pemulihan_pertahun['tgl_awal'])) ?></td>
					    <td class="center py-1 px-1" style="vertical-align:middle;"><?= date('d-m-Y', strtotime($rowambil_lobook_pemulihan_pertahun['tgl_akhir'])) ?></td>
					    <td class="left py-1 px-1" style="vertical-align:middle;"><?= $rowambil_lobook_pemulihan_pertahun['nama_pegawai'] ?></td>
					    <td class="left py-1 px-1" style="vertical-align:middle;"><?= $rowambil_lobook_pemulihan_pertahun['nama_ruangan'] ?></td>
					    <td class="left py-1 px-1" style="vertical-align:middle;"><?= $rowambil_lobook_pemulihan_pertahun['penanggungjawab'] ?></td>
					    <td class="left py-1 px-1" style="vertical-align:middle;"><?= $rowambil_lobook_pemulihan_pertahun['tujuan'] ?></td>
					    <td class="left py-1 px-1" style="vertical-align:middle;">
					    	<?php
					    		if($rowambil_lobook_pemulihan_pertahun['result_pemulihan'] == 0){
					    			echo 'Proses';
					    		}elseif($rowambil_lobook_pemulihan_pertahun['result_pemulihan'] == 1){
					    			echo 'Kompeten';
					    		}else{
					    			echo 'Tidak Kompeten';
					    		}
					    	?>
					    </td>
					    <td class="left py-1 px-1" style="vertical-align:middle;"><?= $rowambil_lobook_pemulihan_pertahun['catatan_pemulihan'] ?></td>
					  </tr>
								<tr>
									<th class="center py-1 px-1 bg-dark" colspan="9"  style="text-align: center;">KEGIATAN PEMULIHAN</th>
								</tr>
							  <tr>
							    <th style="vertical-align:middle;" class="center py-1 px-1 bg-dark" colspan="2" >Tanggal</th>
							    <th style="vertical-align:middle;" class="center py-1 px-1 bg-dark" >RM</th>
							    <th style="vertical-align:middle;" class="center py-1 px-1 bg-dark" >Penguji</th>
							    <th style="vertical-align:middle;" class="center py-1 px-1 bg-dark"  colspan="2">Kompetensi</th>
							    <th style="vertical-align:middle;" class="center py-1 px-1 bg-dark" >Hasil</th>
							    <th style="vertical-align:middle;" class="center py-1 px-1 bg-dark"  colspan="2">Catatan</th>
							  </tr>
								<?php
									$ambil_lobook_pemulihan_detil = $this->m_rancak->ambil_kewenangan_lobook_kegiatan_pemulihan_detil($rowambil_lobook_pemulihan_pertahun['id_logbook_pemulihan']);
									foreach($ambil_lobook_pemulihan_detil as $rowambil_lobook_pemulihan_detil){
								?>
							  <tr>
							    <td class="center py-1 px-1" colspan="2" style="vertical-align:middle;"><?= date('d-m-Y', strtotime($rowambil_lobook_pemulihan_detil['tgl_kegiatan_pemulihan'])) ?></td>
							    <td class="left py-1 px-1" style="vertical-align:middle"><?= $rowambil_lobook_pemulihan_detil['rm_kegiatan_pemulihan'] ?></td>
							    <td class="left py-1 px-1" style="vertical-align:middle"><?= $rowambil_lobook_pemulihan_detil['nama_pegawai'] ?></td>
							    <td class="left py-1 px-1" style="vertical-align:middle" colspan="2"><?= $rowambil_lobook_pemulihan_detil['nama_kewenangan'] ?></td>
							    <td class="left py-1 px-1" style="vertical-align:middle;">
						    	<?php
						    		if($rowambil_lobook_pemulihan_detil['result_kegiatan_pemulihan'] == 0){
						    			echo 'Proses';
						    		}elseif($rowambil_lobook_pemulihan_detil['result_kegiatan_pemulihan'] == 1){
						    			echo 'Kompeten';
						    		}else{
						    			echo 'Tidak Kompeten';
						    		}
						    	?>
							    </td>
							    <td class="left py-1 px-1" style="vertical-align:middle;" colspan="2"><?= $rowambil_lobook_pemulihan_detil['catatan_kegiatan_pemulihan'] ?></td>
							  </tr>
						<?php
									}
							}
						?>
							</tbody>
	    			</table>
	        </div>
	      </div>
	    </div>	
	    <?php } ?>	
	  </div>	
	  <?php echo form_close(); ?>
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
<?php
}
elseif ($page=="pengajuan_kompetensi_lihat_pemulihan")
{
?>
	   <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
				<div class="box-body">
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;width:10%;">Tanggal</th>
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kewenangan</th>
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;width:10%;">V Karu</th>
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;width:10%;">V Kabid</th>
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;width:10%;">V Asesor</th>
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;width:10%;">V Komite</th>
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;width:10%;">V Direktur</th>
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;width:10%;">Tolak</th>
                </tr>
									<?php
									foreach($ambil_lobook_pemulihan_detil as $row){
									?>
								<tr>
									<td style="vertical-align:middle;"><?php echo date('d-m-Y', strtotime($row['tgl_logbook'])); ?></td>
									<td style="vertical-align:middle;"><?php echo $row['nama_kewenangan']; ?></td>
									<td style="vertical-align:middle;">
										<?php
											if($row['v_karub'] == 0){
												echo'<button class="btn btn-xs btn-default">Proses</button>';
											}elseif($row['v_karub'] == 1){
												echo'<button class="btn btn-xs btn-success">Kompeten</button>';
											}else{
												echo'<button class="btn btn-xs btn-danger">Tidak Kompeten</button>';
											}
										?>
									</td>
									<td style="vertical-align:middle;">
										<?php
											if($row['v_kabidb'] == 0){
												echo'<button class="btn btn-xs btn-default">Proses</button>';
											}elseif($row['v_kabidb'] == 1){
												echo'<button class="btn btn-xs btn-success">Kompeten</button>';
											}else{
												echo'<button class="btn btn-xs btn-danger">Tidak Kompeten</button>';
											}
										?>
									</td>
									<td style="vertical-align:middle;">
										<?php
											if($row['v_asesorb'] == 0){
												echo'<button class="btn btn-xs btn-default">Proses</button>';
											}elseif($row['v_asesorb'] == 1){
												echo'<button class="btn btn-xs btn-success">Kompeten</button>';
											}else{
												echo'<button class="btn btn-xs btn-danger">Tidak Kompeten</button>';
											}
										?>
									</td>
									<td style="vertical-align:middle;">
										<?php
											if($row['v_komiteb'] == 0){
												echo'<button class="btn btn-xs btn-default">Proses</button>';
											}elseif($row['v_komiteb'] == 1){
												echo'<button class="btn btn-xs btn-success">Kompeten</button>';
											}else{
												echo'<button class="btn btn-xs btn-danger">Tidak Kompeten</button>';
											}
										?>
									</td>
									<td style="vertical-align:middle;">
										<?php
											if($row['v_direkturb'] == 0){
												echo'<button class="btn btn-xs btn-default">Proses</button>';
											}elseif($row['v_direkturb'] == 1){
												echo'<button class="btn btn-xs btn-success">Kompeten</button>';
											}else{
												echo'<button class="btn btn-xs btn-danger">Tidak Kompeten</button>';
											}
										?>
									</td>
									<td style="vertical-align:middle;">
										<?php
											if($row['result_tolakb'] == 1){
												echo'<button class="btn btn-xs btn-danger">Supervisi</button>';
											}elseif($row['result_tolakb'] == 2){
												echo'<button class="btn btn-xs btn-danger">Tidak Kompeten</button>';
											}else{
												echo'';
											}
										?>
									</td>
								</tr>
									<?php
									}
									?>
              </table>
            </div>
		    </div>
    </div>
<?php
}
elseif ($page=="pengajuan_kompetensi_lihat_kegiatan")
{
?>
	   <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
				<div class="box-body">
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;width:10%;">Tanggal</th>
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kewenangan</th>
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;">RM</th>
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Hasil</th>
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Catatan</th>
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Penguji</th>
                </tr>
									<?php
									foreach($ambil_lobook_pemulihan_detil as $row){
									?>
								<tr>
									<td style="vertical-align:middle;"><?php echo date('d-m-Y', strtotime($row['tgl_kegiatan_pemulihan'])); ?></td>
									<td style="vertical-align:middle;"><?php echo $row['nama_kewenangan']; ?></td>
									<td style="vertical-align:middle;"><?php echo $row['rm_kegiatan_pemulihan']; ?></td>
									<td style="vertical-align:middle;">
										<?php
											if($row['result_kegiatan_pemulihan'] == 0){
												echo'<button class="btn btn-xs btn-default">Proses</button>';
											}elseif($row['result_kegiatan_pemulihan'] == 1){
												echo'<button class="btn btn-xs btn-success">Kompeten</button>';
											}else{
												echo'<button class="btn btn-xs btn-danger">Tidak Kompeten</button>';
											}
										?>
									</td>
									<td style="vertical-align:middle;"><?php echo $row['catatan_kegiatan_pemulihan']; ?></td>
									<td style="vertical-align:middle;"><?php echo $row['nama_pegawai']; ?></td>
								</tr>
									<?php
									}
									?>
              </table>
            </div>
		    </div>
    </div>
<?php
}
elseif ($page=="pengajuan_kompetensi_upload_kredensial" || $page=="pengajuan_kompetensi_upload_mutu" || $page=="pengajuan_kompetensi_upload_etika" || $page=="pengajuan_kompetensi_upload_spk")
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
		<?php echo form_open_multipart('komite/pengajuan_kompetensi/'.$halaman.'/'.$id,' ');
		input_text("id_pengajuan",$id_pengajuan,"","","hidden");
		?>
        <div class="box-body">
			<div class="form-group">
			  <label>Pilih Berkas</label>
				<?php
					input_text("upload_Files[]",""," required","","file");
				?><p class="help-block">Format harus PDF</p>
			</div>
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
