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
elseif ($page=="download")
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
		<a href="<?php echo $link_kembali;?>"
			class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
		</a> ||

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
					  <th width="5%" style="display:none;"></th>
					  <th>Nama File</th>
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
elseif ($page=="download_tambah")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
	<h1>
		<a href="<?php echo $link_awal;?>"
			class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
		</a> ||

        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
	<?php echo form_open_multipart('upload/download/tambah',' id="signupform" ');
		?>
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
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
					  <label>Pilih Berkas &nbsp;<small">Format PDF, DOC, DOCX, XLS, XLSX, PPT</small></label>
						<?php
							input_text("upload_Files[]",""," required","","file");
						?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					  <label>Nama Download</label>
						<?php
							input_text("nama_download",$nama_download,"maxlength='255' autofocus","Masukkan Nama","text");
						?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					<label>Status Download</label>
					<?php
						input_pdselect2("status_download",$cmd_status,$status_download);
					?>
					</div>
				</div>
			</div>
        </div>
        <div class="box-footer">
		<button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">PILIH JABATAN</h3>

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
						  <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_jabatan'];?>">
						</label>
					  </div>
					</td>
					<td style="vertical-align:middle;"><?php echo $row['nama_jabatan']; ?></td>
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
elseif ($page=="download_edit")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
	<h1>
		<a href="<?php echo $link_awal;?>"
			class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
		</a> ||

        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
	<?php echo form_open_multipart('upload/download/edit/'.$id,' id="signupform" ');
	input_text("id_download",$id,"","","hidden");
		?>
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
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
					  <label>Pilih Berkas &nbsp;<small">Format PDF, DOC, DOCX, XLS, XLSX, PPT</small></label>
						<?php
							input_text("upload_Files[]",""," required","","file");
						?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					  <label>Nama Download</label>
						<?php
							input_text("nama_download",$nama_download,"maxlength='255' autofocus","Masukkan Nama","text");
						?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					<label>Status Download</label>
					<?php
						input_pdselect2("status_download",$cmd_status,$status_download);
					?>
					</div>
				</div>
			</div>
        </div>
        <div class="box-footer">
		<button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">PILIH JABATAN</h3>

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
						  <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_jabatan'];?>"
						  <?php if(in_array($row['id_jabatan'],$id_jabatan)) echo 'checked="checked"'; ?> >
						</label>
					  </div>
					</td>
					<td style="vertical-align:middle;"><?php echo $row['nama_jabatan']; ?></td>
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
// ================================== di controller user
//================================== USER ===============================
elseif ($page=="user")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
		<a href="<?php echo $link_kembali;?>"
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
					  <th style="width:5%;"></th>
					  <th style="display:none;"></th>
					  <th>Nama</th>
					  <th>Unit</th>
					  <th>Ruangan</th>
					  <th>Jabfung</th>
					  <th>status Pegawai</th>
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
              USER LEVEL :
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
		<a href="<?php echo $link_awal;?>"
			class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
		</a>
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
		  <?php echo form_open_multipart('user/user/tambah',' id="signupform" ');
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
									input_pdselect2("id_level",$level,$id_level);
								?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							  <label>Unit</label>
								<?php
									input_pdselect2("id_unit",$unit,$id_unit);
								?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							  <label>Ruangan</label>
								<?php
									input_pdselect2fleksibel("id_ruangan","id_ruangan",$cmd_ruangan,"id_ruangan","nama_ruangan",$id_ruangan,"Tidak Ada Ruangan")
								?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							  <label>Status Pegawai</label>
								<?php
									input_pdselect2("status_user",$status,$status_user);
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
							  <label>Username &nbsp; <small><span style="font-weight:bold;" id="msg"></span></small></label>
								<?php
									input_textcustom("username",$username," maxlength='60' class='form-control' autocomplete='off' required id='username' ",
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
		<a href="<?php echo $link_awal;?>"
			class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
		</a>
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
		  <?php echo form_open_multipart('user/user/edit/'.$id,' id="signupform" ');
				input_text("id_user",$id_user,"","","hidden");
				input_text("id_pegawai",$id_pegawai,"","","hidden");
				input_text("wa",$pake_wa,"","","hidden");
				input_text("instance_name",$instance_name,"","","hidden");
				input_text("username_lama",$username,"","","hidden");
				input_text("password_lama",$password_lama,"","","hidden");
				input_text("nip_lama",$nip,"","","hidden");
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
										input_pdselect2("id_level",$level,$id_level);
									?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  <label>Unit</label>
									<?php
										input_pdselect2("id_unit",$unit,$id_unit);
									?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  <label>Ruangan</label>
									<?php
										input_pdselect2fleksibel("id_ruangan","id_ruangan",$cmd_ruangan,"id_ruangan","nama_ruangan",$id_ruangan,"Tidak Ada Ruangan")
									?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  <label>Status Pegawai</label>
									<?php
										input_pdselect2("status_user",$status,$status_user);
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
								  <label>Username &nbsp; <small><span style="font-weight:bold;" id="msg"></span></small></label>
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
elseif ($page=="aktifasi")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
		<a href="<?php echo $link_kembali;?>"
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
					  <th style="display:none;"></th>
					  <th>Nama</th>
					  <th>No HP</th>
					  <th>Username</th>
					  <th>Ruangan</th>
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
elseif ($page=="aktifasi_proses")
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
		  <?php echo form_open_multipart('aktifasi/aktifasi/proses/'.$id,' id="signupform" ');
				input_text("id_registrasi",$id,"","","hidden");
				input_text("status_user",'1',"","","hidden");
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
									input_calendar("tgl_lahir","tgl_lahir",$tgl_lahir,"Masukkan Tanggal Lahir","required");
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
							  <label>No Induk Pegawai/ Karyawan</label>
								<?php
									input_text("nip",$nip,"maxlength='25' ","Ketikkan NIP / NIK","text");
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
							  <label>No WA </label><small><b> Format : 628xxxxx</b></small>
								<?php
									input_textcustom("no_hp",$no_hp," required
												onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
														"Ketikkan No HP format kode negara","text");
								?>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
							  <label>Email</label>
								<?php
									input_text("email",$email,"maxlength='255' ","Ketikkan Email","text");
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
						<div class="col-md-4">
							<div class="form-group">
							  <label>Ruangan</label>
								<?php
									input_pdselect2fleksibel("id_ruangan","id_ruangan",$cmd_ruangan,"id_ruangan","nama_ruangan",$id_ruangan,"Tidak Ada Ruangan");
								?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							  <label>Pendidikan Terakhir</label>
								<?php
									input_pdselect2("id_pendidikan",$cmd_pendidikan,$id_pendidikan);
								?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							  <label>Alamat</label>
								<?php
									input_text("alamat",$alamat,"maxlength='255' ","Ketikkan Alamat","text");
								?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							  <label>Level</label>
								<?php
									input_pdselect2("id_level",$level,$id_level);
								?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							  <label>Username &nbsp; <small><span style="font-weight:bold;" id="msg"></span></small></label>
							  <small><input type="checkbox" onclick="myUsername()"> Show </small>
								<?php
									input_textcustom("username",$username," maxlength='60' class='form-control' autocomplete='off' id='username' ",
													"Huruf kecil tanpa spasi dan spesial character kecuali -","password");
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
// ================================== di controller unit
elseif ($page=="unit")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
		<a href="<?php echo $link_kembali;?>"
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
					  <th width="7%">ID</th>
					  <th>Nama Unit</th>
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
// ================================== di controller unit
elseif ($page=="unit_tambah")
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
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('unit/unit/simpan_tambah');?>" onClick="return cek();">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
				<div class="col-md-12">
					<div class="form-group">
					  <label>Nama Unit</label>
						<?php
							input_text("nama_unit",$nama_unit,"maxlength='255' required","Masukkan Nama Rekening","text");
						?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label>Struktur</label>
						<?php
							input_pdselect2("id_struktur_jabatan",$cmd_struktur_jabatan,$id_struktur_jabatan);
						?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label>Status</label>
						<?php
							input_pdselect2("status_unit",$status,$status_unit);
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
</script>
<?php
}
// ================================== di controller unit
elseif ($page=="unit_edit")
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
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('unit/unit/simpan_edit');?>" onClick="return cek();">
		<input type="hidden" name="id_unit" value="<?= $id; ?>">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
				<div class="col-md-12">
					<div class="form-group">
					  <label>Nama Unit</label>
						<?php
							input_text("nama_unit",$nama_unit,"maxlength='255' required","Masukkan Nama Rekening","text");
						?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label>Struktur</label>
						<?php
							input_pdselect2("id_struktur_jabatan",$cmd_struktur_jabatan,$id_struktur_jabatan);
						?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label>Status</label>
						<?php
							input_pdselect2("status_unit",$status,$status_unit);
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
</script>
<?php
}
// ================================== di controller ruangan
elseif ($page=="ruangan")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
		<a href="<?php echo $link_kembali;?>"
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
					  <th width="7%">ID</th>
					  <th>Nama Ruangan</th>
					  <th>Kategori</th>
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
// ================================== di controller ruangan
elseif ($page=="ruangan_tambah")
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
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ruangan/ruangan/simpan_tambah');?>" onClick="return cek();">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
				<div class="col-md-12">
					<div class="form-group">
					  <label>Nama Ruangan</label>
						<?php
							input_text("nama_ruangan",$nama_ruangan,"maxlength='255' required","Masukkan Nama","text");
						?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label>Struktur</label>
						<?php
							input_pdselect2("id_struktur_jabatan",$cmd_struktur_jabatan,$id_struktur_jabatan);
						?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label>Status</label>
						<?php
							input_pdselect2("status_ruangan",$status,$status_ruangan);
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
</script>
<?php
}
// ================================== di controller ruangan
elseif ($page=="ruangan_edit")
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
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ruangan/ruangan/simpan_edit');?>" onClick="return cek();">
		<input type="hidden" name="id_ruangan" value="<?= $id; ?>">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
				<div class="col-md-12">
					<div class="form-group">
					  <label>Nama Ruangan</label>
						<?php
							input_text("nama_ruangan",$nama_ruangan,"maxlength='255' required","Masukkan Nama","text");
						?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label>Struktur</label>
						<?php
							input_pdselect2("id_struktur_jabatan",$cmd_struktur_jabatan,$id_struktur_jabatan);
						?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label>Status</label>
						<?php
							input_pdselect2("status_ruangan",$status,$status_ruangan);
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
</script>
<?php
}
elseif ($page=="kurs")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
		<?php echo $header; ?> <small><?php echo $instance_name; ?></small>
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
					  <th width="10%">ID</th>
					  <th>Kode</th>
					  <th>Nama</th>
					  <th>Simbol</th>
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
elseif ($page=="kurs_tambah")
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
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_keuangan/kurs/simpan_tambah');?>" onClick="return cek();">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
				<div class="col-md-12">
					<div class="form-group">
					  <label>Kode Mata Uang</label>
						<?php
							input_text("kode_mata_uang",$kode_mata_uang,"maxlength='5' required","Masukkan Kode Misal IDR","text");
						?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label>Simbol Mata Uang</label>
						<?php
							input_text("simbol_mata_uang",$simbol_mata_uang,"maxlength='5' required","Masukkan Simbol Misal Rp","text");
						?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label>Nama Mata Uang</label>
						<?php
							input_text("nama_mata_uang",$nama_mata_uang,"maxlength='255' required","Masukkan Nama","text");
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
</script>
<?php
}
elseif ($page=="kurs_edit")
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
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_keuangan/kurs/simpan_edit');?>" onClick="return cek();">
		<input type="hidden" name="id_mata_uang" value="<?= $id; ?>">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
				<div class="col-md-12">
					<div class="form-group">
					  <label>Kode Mata Uang</label>
						<?php
							input_text("kode_mata_uang",$kode_mata_uang,"maxlength='5' required","Masukkan Kode Misal IDR","text");
						?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label>Simbol Mata Uang</label>
						<?php
							input_text("simbol_mata_uang",$simbol_mata_uang,"maxlength='5' required","Masukkan Simbol Misal Rp","text");
						?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label>Nama Mata Uang</label>
						<?php
							input_text("nama_mata_uang",$nama_mata_uang,"maxlength='255' required","Masukkan Nama","text");
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
</script>
<?php
}
elseif ($page=="ms_sub")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
		<?php echo $header; ?> <small><?php echo $instance_name; ?></small>
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
					  <th width="10%">Kode 1</th>
					  <th width="10%">Kode 2</th>
					  <th>Nama Akun</th>
					  <th>Master Code</th>
					  <th width="10%">D / K</th>
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
elseif ($page=="ms_sub_tambah")
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
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_keuangan/ms_sub/simpan_tambah');?>" onClick="return cek();">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
				<div class="col-md-12">
					<div class="form-group">
					  <label>Master Code</label>
						<?php
							input_pdselect2("id_ms_code",$cmd_ms_code,$id_ms_code);
						?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label>Nama Sub</label>
						<?php
							input_text("nama_ms_sub",$nama_ms_sub,"maxlength='60' required","Masukkan Nama Kode Rekening","text");
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
</script>
<?php
}
elseif ($page=="ms_sub_edit")
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
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_keuangan/ms_sub/simpan_edit');?>" onClick="return cek();">
		<input type="hidden" name="id_ms_sub" value="<?= $id; ?>">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
				<div class="col-md-12">
					<div class="form-group">
					  <label>Master Code</label>
						<?php
							input_pdselect2("id_ms_code",$cmd_ms_code,$id_ms_code);
						?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label>Nama Sub</label>
						<?php
							input_text("nama_ms_sub",$nama_ms_sub,"maxlength='60' required","Masukkan Nama Kode Rekening","text");
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
</script>
<?php
}
elseif ($page=="code")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
		<?php echo $header; ?> <small><?php echo $instance_name; ?></small>
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
					  <th width="7%">Kode</th>
					  <th>Tipe</th>
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
elseif ($page=="code_tambah")
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
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_keuangan/code/simpan_tambah');?>" onClick="return cek();">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
				<div class="col-md-12">
					<div class="form-group">
					  <label>Nama Tipe</label>
						<?php
							input_text("nama_code",$nama_code,"maxlength='60' required","Masukkan Nama Kode Rekening","text");
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
</script>
<?php
}
elseif ($page=="code_edit")
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
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_keuangan/code/simpan_edit');?>" onClick="return cek();">
		<input type="hidden" name="id_code" value="<?= $id; ?>">
		<input type="hidden" name="proteksi" value="<?= $proteksi; ?>">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
				<div class="col-md-12">
					<div class="form-group">
					  <label>Nama Tipe</label>
						<?php
							input_text("nama_code",$nama_code,"maxlength='60' required","Masukkan Nama Kode Rekening","text");
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
</script>
<?php
}
elseif ($page=="coa")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
		<?php echo $header; ?> <small><?php echo $instance_name; ?></small>
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
					  <th width="7%">ID</th>
					  <th width="17%">Kode Rekening</th>
					  <th>Nama Akun</th>
					  <th>Tipe</th>
					  <th>Parent</th>
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
elseif ($page=="coa_tambah")
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
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_keuangan/coa/simpan_tambah');?>" onClick="return cek();">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
				<div class="col-md-12">
					<div class="form-group">
					  <label>Nama Rekening</label>
						<?php
							input_text("nama_coa",$nama_coa,"maxlength='60' required","Masukkan Nama Rekening","text");
						?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					  <label>Kode Rekening</label>
						<?php
							input_text("kode_coa",$kode_coa,"maxlength='15' required","Masukkan Kode Rekening","text");
						?>
					</div>
				</div>
				<div class="col-md-1">
				</div>
				<div class="col-md-7">
					<div class="form-group">
					  <label>Tipe</label>
						<?php
							input_pdselect2("id_code",$cmd_code,$id_code);
						?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					  <label>Parent / Sub Akun Dari</label>
						<?php
						input_pdselect2fleksibel("parent","parent",$cmd_opsi_keu_coa,"id_coa","nama_coa",$parent,"Silahkan Pilih Parent / Sub")
						?>
					</div>
				</div>
				<div class="col-md-1">
				</div>
				<div class="col-md-5">
					<div class="form-group">
					  <label>Status</label>
						<?php
							input_pdselect2("status_coa",$cmd_status,$status_coa);
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
</script>
<?php
}
elseif ($page=="coa_edit")
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
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_keuangan/coa/simpan_edit');?>" onClick="return cek();">
		<input type="hidden" name="id_coa" value="<?= $id; ?>">
		<input type="hidden" name="protect" value="<?= $protect; ?>">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
				<div class="col-md-12">
					<div class="form-group">
					  <label>Nama Rekening</label>
						<?php
							input_text("nama_coa",$nama_coa,"maxlength='60' required","Masukkan Nama Rekening","text");
						?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					  <label>Kode Rekening</label>
						<?php
							input_text("kode_coa",$kode_coa,"maxlength='15' required","Masukkan Kode Rekening","text");
						?>
					</div>
				</div>
				<div class="col-md-1">
				</div>
				<div class="col-md-7">
					<div class="form-group">
					  <label>Tipe</label>
						<?php
							input_pdselect2("id_code",$cmd_code,$id_code);
						?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					  <label>Parent / Sub Akun Dari</label>
						<?php
						input_pdselect2fleksibel("parent","parent",$cmd_opsi_keu_coa,"id_coa","nama_coa",$parent,"SIlahkan Pilih Parent / Sub")
						?>
					</div>
				</div>
				<div class="col-md-1">
				</div>
				<div class="col-md-5">
					<div class="form-group">
					  <label>Status</label>
						<?php
							input_pdselect2("status_coa",$cmd_status,$status_coa);
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
</script>
<?php
}
elseif ($page=="dk")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
		<?php echo $header; ?> <small><?php echo $instance_name; ?></small>
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
					  <th width="10%" style="display:none;"></th>
					  <th width="15%">Kode Rekening</th>
					  <th>Nama</th>
					  <th width="10%">D / K</th>
					  <th>No</th>
					  <th>Alamat</th>
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
elseif ($page=="dk_tambah")
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
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_keuangan/dk/simpan_tambah');?>" onClick="return cek();">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
				<div class="col-md-12">
					<div class="form-group">
					  <label>Debitur / Keditur</label>
						<?php
							input_pdselect2("dk",$cmd_ms_dk,$dk);
						?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label>Kode Rekening</label>
						<?php
							input_text("kode_rekening",$kode_rekening," maxlength='5' ","Masukkan Nama Kode Rekening","text");
						?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label>Nama Debitur / Kreditur</label>
						<?php
							input_text("nama_dk",$nama_dk,"maxlength='30' required","Masukkan Nama Kode Rekening","text");
						?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label>No Kontak Debitur / Kreditur</label>
						<?php
							input_textcustom("no_dk",$no_dk," maxlength='20'
										onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
												"Masukkan No Kontak","text");
						?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label>Alamat Debitur / Kreditur</label>
						<?php
							input_text("alamat_dk",$alamat_dk," ","Masukkan Alamat","text");
						?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label>Status</label>
						<?php
							input_pdselect2("status_dk",$status,$status_dk);
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
</script>
<?php
}
elseif ($page=="dk_edit")
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
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_keuangan/dk/simpan_edit');?>" onClick="return cek();">
		<input type="hidden" name="id_dk" value="<?= $id_dk; ?>">
		<input type="hidden" name="kode_rekening_lama" value="<?= $kode_rekening; ?>">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
				<div class="col-md-12">
					<div class="form-group">
					  <label>Debitur / Keditur</label>
						<?php
							input_pdselect2("dk",$cmd_ms_dk,$dk);
						?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label>Kode Rekening</label>
						<?php
							input_text("kode_rekening",$kode_rekening," maxlength='5' ","Masukkan Nama Kode Rekening","text");
						?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label>Nama Debitur / Kreditur</label>
						<?php
							input_text("nama_dk",$nama_dk,"maxlength='30' required","Masukkan Nama Kode Rekening","text");
						?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label>No Kontak Debitur / Kreditur</label>
						<?php
							input_textcustom("no_dk",$no_dk," maxlength='20'
										onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
												"Masukkan No Kontak","text");
						?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label>Alamat Debitur / Kreditur</label>
						<?php
							input_text("alamat_dk",$alamat_dk," ","Masukkan Alamat","text");
						?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label>Status</label>
						<?php
							input_pdselect2("status_dk",$status,$status_dk);
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
</script>
<?php
}
//================================== KATEGORI BARANG ===============================
elseif ($page=="kategori_barang")
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
				input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
			?>
          </div>
        </div>
        <div class="box-body">
			<table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
				<thead>
					<tr>
					  <th width="5%">ID</th>
					  <th>Kode</th>
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
elseif ($page=="kategori_barang_tambah")
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
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_keuangan/kategori_barang/simpan_tambah');?>" onClick="return cek();">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
				<div class="col-md-12">
					<div class="form-group">
					  <label>Nama Kategori Barang</label>
						<?php
							input_text("nama_item_kategori",$nama_item_kategori,"maxlength='255' required","Masukkan Nama","text");
						?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label>Kode Untuk Penamaan Kode Barang Misal 1 => 001.xxx.xxx dst</label>
						<?php
							input_textcustom("kode_item_kategori",$kode_item_kategori," maxlength='5'
										onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
												"Masukkan No Kontak","text");
						?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label>Status</label>
						<?php
							input_pdselect2("status_item_kategori",$status,$status_item_kategori);
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
</script>
<?php
}
elseif ($page=="kategori_barang_edit")
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
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_keuangan/kategori_barang/simpan_edit');?>" onClick="return cek();">
		<input type="hidden" name="id_item_kategori" value="<?= $id; ?>">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
				<div class="col-md-12">
					<div class="form-group">
					  <label>Nama Kategori Barang</label>
						<?php
							input_text("nama_item_kategori",$nama_item_kategori,"maxlength='255' required","Masukkan Nama","text");
						?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label>Kode Untuk Penamaan Kode Barang Misal 1 => 001.xxx.xxx dst</label>
						<?php
							input_textcustom("kode_item_kategori",$kode_item_kategori," maxlength='5'
										onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
												"Masukkan No Kontak","text");
						?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label>Status</label>
						<?php
							input_pdselect2("status_item_kategori",$status,$status_item_kategori);
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
</script>
<?php
}
//================================== BARANG ===============================
elseif ($page=="barang")
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
				input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
			?>
          </div>
        </div>
        <div class="box-body">
			<table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
				<thead>
					<tr>
					  <th width="5%">ID</th>
					  <th>Kode</th>
					  <th>Nama</th>
					  <th>Unit</th>
					  <th>Kategori</th>
					  <th>Jenis</th>
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
elseif ($page=="barang_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_keuangan/barang/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
		<div class="box-body">
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">TRANSAKSI</h3>
			</div>
			  <div class="box-body">
					<div class="container col-md-12">
						<div class="row">
							<div class="col-md-5">
								<div class="form-group">
								  <label>Kode Barang</label>
									<?php
										input_text("kode_barang",$kode_barang,"maxlength='30' required autofocus","Masukkan Kode","text");
									?>
								</div>
							</div>
							<div class="col-md-1">
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  <label>Barcode Barang</label>
									<?php
										input_text("barcode_barang",$barcode_barang,"maxlength='30' ","Masukkan Barcode","text");
									?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  <label>Nama Barang</label>
									<?php
										input_text("nama_barang",$nama_barang,"maxlength='255' ","Masukkan Nama","text");
									?>
								</div>
							</div>
							<div class="col-md-1">
							</div>
							<div class="col-md-5">
								<div class="form-group">
								  <label>Jenis Barang</label>
										<?php
											input_pdselect2("jenis_barang",$cmd_jenis_barang,$jenis_barang);
										?>
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-group">
								  <label>Kategori Barang</label>
									<?php
										input_pdselect2("id_item_kategori",$cmd_item_kategori,$id_item_kategori);
									?>
								</div>
							</div>
							<div class="col-md-1">
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  <label>Unit</label>
									<?php
										input_pdselect2fleksibel("id_unit","id_unit",$cmd_unit_null,"id_unit","nama_unit",$id_unit,"Tanpa Unit / Umum");
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
function formatRupiah(angka, prefix)
{
	var number_string = angka.replace(/[^,\d]/g, '').toString(),
		split	= number_string.split(','),
		sisa 	= split[0].length % 3,
		rupiah 	= split[0].substr(0, sisa),
		ribuan 	= split[0].substr(sisa).match(/\d{3}/gi);

	if (ribuan) {
		separator = sisa ? '.' : '';
		rupiah += separator + ribuan.join('.');
	}

	rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
	return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}
var tanpa_rupiah = document.getElementById('tanpa-rupiah');
tanpa_rupiah.addEventListener('keyup', function(e)
{
	tanpa_rupiah.value = formatRupiah(this.value);
});

</script>
<?php
}
elseif ($page=="barang_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_keuangan/barang/simpan_edit');?>" onClick="return cek();">
		<input type="hidden" name="id_barang" value="<?= $id; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
		<div class="box-body">
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">TRANSAKSI</h3>
			</div>
			  <div class="box-body">
					<div class="container col-md-12">
						<div class="row">
							<div class="col-md-5">
								<div class="form-group">
								  <label>Kode Barang</label>
									<?php
										input_text("kode_barang",$kode_barang,"maxlength='30' required autofocus","Masukkan Kode","text");
									?>
								</div>
							</div>
							<div class="col-md-1">
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  <label>Barcode Barang</label>
									<?php
										input_text("barcode_barang",$barcode_barang,"maxlength='30' ","Masukkan Barcode","text");
									?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  <label>Nama Barang</label>
									<?php
										input_text("nama_barang",$nama_barang,"maxlength='255' ","Masukkan Nama","text");
									?>
								</div>
							</div>
							<div class="col-md-1">
							</div>
							<div class="col-md-5">
								<div class="form-group">
								  <label>Jenis Barang</label>
										<?php
											input_pdselect2("jenis_barang",$cmd_jenis_barang,$jenis_barang);
										?>
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-group">
								  <label>Kategori Barang</label>
									<?php
										input_pdselect2("id_item_kategori",$cmd_item_kategori,$id_item_kategori);
									?>
								</div>
							</div>
							<div class="col-md-1">
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  <label>Unit</label>
									<?php
										input_pdselect2fleksibel("id_unit","id_unit",$cmd_unit_null,"id_unit","nama_unit",$id_unit,"Tanpa Unit / Umum");
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
function formatRupiah(angka, prefix)
{
	var number_string = angka.replace(/[^,\d]/g, '').toString(),
		split	= number_string.split(','),
		sisa 	= split[0].length % 3,
		rupiah 	= split[0].substr(0, sisa),
		ribuan 	= split[0].substr(sisa).match(/\d{3}/gi);

	if (ribuan) {
		separator = sisa ? '.' : '';
		rupiah += separator + ribuan.join('.');
	}

	rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
	return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}
var tanpa_rupiah = document.getElementById('tanpa-rupiah');
tanpa_rupiah.addEventListener('keyup', function(e)
{
	tanpa_rupiah.value = formatRupiah(this.value);
});
</script>
<?php
}
//================================== TERMIN ===============================
elseif ($page=="termin")
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
					  <th>Tempo</th>
					  <th>Keterangan</th>
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
elseif ($page=="termin_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_keuangan/termin/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
		<div class="box-body">
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">TERMIN</h3>
			</div>
			  <div class="box-body">
			  <div class="box-body">
					<div class="container col-md-12">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
								  <label>Nama Termin</label>
									<?php
										input_text("nama_termin",$nama_termin,"maxlength='255' required autofocus","Masukkan Nama","text");
									?>
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-group">
								  <label>Tempo</label>
								<?php
									input_textcustom("tempo_termin",$tempo_termin," maxlength='3'
												onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
														"Masukkan Tempo","text");
								?>
								</div>
							</div>
							<div class="col-md-1">
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  <label>Status</label>
										<?php
											input_pdselect2("status_termin",$cmd_status,$status_termin);
										?>
								</div>
							</div>
							<div class="col-md-7">
								<div class="form-group">
								  <label>Keterangan</label>
									<?php
										input_text("ket_termin",$ket_termin,"maxlength='255' ","Masukkan Keterangan","text");
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
elseif ($page=="termin_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_keuangan/termin/simpan_edit');?>" onClick="return cek();">
		<input type="hidden" name="id_termin" value="<?= $id; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
		<div class="box-body">
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">TERMIN</h3>
			</div>
			  <div class="box-body">
					<div class="container col-md-12">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
								  <label>Nama Termin</label>
									<?php
										input_text("nama_termin",$nama_termin,"maxlength='255' required autofocus","Masukkan Nama","text");
									?>
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-group">
								  <label>Tempo</label>
								<?php
									input_textcustom("tempo_termin",$tempo_termin," maxlength='3'
												onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
														"Masukkan Tempo","text");
								?>
								</div>
							</div>
							<div class="col-md-1">
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  <label>Status</label>
										<?php
											input_pdselect2("status_termin",$cmd_status,$status_termin);
										?>
								</div>
							</div>
							<div class="col-md-7">
								<div class="form-group">
								  <label>Keterangan</label>
									<?php
										input_text("ket_termin",$ket_termin,"maxlength='255' ","Masukkan Katerangan","text");
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
		<a href="<?php echo $link_awal;?>"
			class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
		</a>
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
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('user/akses/simpan_tambah');?>" onClick="return cek();">
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
