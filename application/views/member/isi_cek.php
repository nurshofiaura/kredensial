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
    <?php
          echo '<pre>'; print_r($this->session->all_userdata());
    ?>
        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="profil")
{
if(empty($foto)){
	$standar_ft=base_url().'assets/images/noavatar.jpg';
}else{
	$cek_filesmall=FCPATH.'assets/foto/ol/'.$foto;
	if(file_exists($cek_filesmall)){
		$standar_ft=base_url().'assets/foto/ol/'.$foto;
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
        <?php echo $header; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
		  <?php echo form_open_multipart('member/profil',' id="signupform" ');
				input_text("id_pegawai",$id_pegawai,"","","hidden");
				input_text("username_lama",$username_lama,"","","hidden");
				input_text("password_lama",$password_lama,"","","hidden");
				input_text("nik_lama",$nik,"","","hidden");
		  ?>
      <div class="row">
        <div class="col-md-3">
		      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
		        <div class="box-header with-border">
		           <h3 class="box-title">PROFIL</h3>

		          <div class="box-tools pull-right">
		            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
		                    title="Collapse">
		              <i class="fa fa-minus"></i></button>
		          </div>
		        </div>
		        <div class="box-body">
	            <div class="box-body box-profile">
	              <img class="profile-user-img img-responsive img-circle" src="<?php echo $standar_ft; ?>" alt="User profile picture">

	              <p class="text-center"><?php echo $nama_pegawai; ?></p>

	            </div>
		        </div>
		        <div class="box-footer">
							<div class="form-group">
							  <label for="exampleInputFile">Ganti Foto</label>
								<?php
									input_textcustom("upload_Files[]","","class='form-control-file' id='exampleInputFile' ","","file");
								?>
							  <p class="help-block">gif, png, jpg, jpeg</p>
							</div>
		        </div>
		      </div>
        </div>
        <!-- /.col -->
        <div class="col-md-9">
		      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
		        <div class="box-header with-border">
		           <h3 class="box-title">PROFIL</h3>

		          <div class="box-tools pull-right">
		            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
		                    title="Collapse">
		              <i class="fa fa-minus"></i></button>
		          </div>
		        </div>
		        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-6">
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
            <div class="col-md-3">
              <div class="form-group">
                <label>Tanggal Lahir</label>
                <?php
                  input_calendar("tgl_lahir","tgl_lahir",$tgl_lahir,"Masukkan Tanggal Lahir"," required");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Jenis Kelamin</label>
                <?php
                  input_pdselect2("jk",$gender,$jk);
                ?>
              </div>
            </div>
            <div class="col-md-3">
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
            <div class="col-md-3">
              <div class="form-group">
                <label>No KTP &nbsp; <small><span style="font-weight:bold;" id="msg2"></span></small></label>
                <?php
                  input_textcustom("nik",$nik," required id='nik'
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "No KTP","text");
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
                <label>Nomor Induk Karyawan</label>
                <?php
                  input_textcustom("nip",$nip,"  
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "No Induk Karyawan","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>No WA </label>
                <?php
                  input_textcustom("no_hp",$no_hp," required
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "No HP format kode negara","text");
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
                <label>Jabatan Fungsional</label>
                <?php
                  input_pdselect2fleksibel("id_jabatan_fungsional","id_jabatan_fungsional",$cmd_jabfung,"id_jabatan_fungsional","nama_jabatan_fungsional",$id_jabatan_fungsional,"Tidak Ada Jabfung");
                ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>No Profesi (NIRA/PARI DLL)</label>
                <?php
                  input_textcustom("no_profesi",$no_profesi,"  
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "No Profesi (PARI / NIRA DLL)","text");
                ?>
              </div>
            </div>   
						<div class="col-md-4">
							<div class="form-group">
							  <label>DPK / DPW</label>
								<?php
                  input_pdselect2fleksibel("id_pengcab","id_pengcab",$null_pengcab,"id_pengcab","nama_pengcab",$id_pengcab,"Tidak Termasuk");
								//	echo form_dropdown('id_kab',$kab,'0',array('id'=>'id_kab','class'=>'form-control'));
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
            <div class="col-md-6">
              <div class="form-group">
                <label>Username &nbsp; <small><span style="font-weight:bold;" id="msg"></span></small></label>
                <?php
                  input_textcustom("username",$username," maxlength='60' class='form-control' required autocomplete='off' id='username' ",
                          "Huruf kecil tanpa spasi dan spesial character kecuali -","text");
                ?>
              </div>
            </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Password (ISI JIKA INGIN DIGANTI)</label>
                  <?php
                    input_textcustom("password",''," maxlength='255' class='form-control' autocomplete='off' id='password' ",
                            "Isi Jika Ingin Di ganti","text");
                  ?>
                </div>
              </div>
          </div>
        </div>
		        </div>
        <?php 
        	if(empty($this->session->id_level)){
        ?>
        <div class="box-footer">
<button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
        <?php 
					}
        ?>
		      </div>

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
		<?php echo form_close(); ?>
    </section>
</div>
<?php
}
elseif ($page=="berkas")
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
elseif ($page=="berkas_tambah")
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
		<?php echo form_open_multipart('member/berkas/tambah',' id="signupform" ');
		input_text("id_pegawai",$member_id,"","","hidden");
		?>
        <div class="box-body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
					  <label>Pilih Berkas &nbsp;<small">Format harus PDF</small></label>
						<?php
							input_text("upload_Files[]","","","","file");
						?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					  <label>No Berkas</label>
						<?php
							input_text("no_berkas",$no_berkas,"maxlength='255' autofocus","Masukkan No","text");
						?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					  <label>Nama Berkas</label>
						<?php
							input_text("nama_berkas",$nama_berkas,"maxlength='255' required","Masukkan Nama","text");
						?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					<label>Kategori</label>
					<?php
						input_pdselect2("id_kategori_berkas",$ambil_kategori_berkas,$id_kategori_berkas);
					?>
					</div>
				</div>
			</div>
        </div>
        <div class="box-footer">
        <?php 
        	if(empty($this->session->id_level)){
        ?>
        <div class="box-footer">
<button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
        <?php 
					}
        ?>
        </div>
		<?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="berkas_edit")
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
		<?php echo form_open_multipart('member/berkas/edit/'.$id,' id="signupform" ');
		input_text("id_berkas",$id_berkas,"","","hidden");
		input_text("link_berkas_lama",$link_berkas,"","","hidden");
		?>
        <div class="box-body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
					  <label>Pilih Berkas Jika ingin di ganti &nbsp;<small">(Format harus PDF)</small></label>
						<?php
							input_text("upload_Files[]","","","","file");
						?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					  <label>No Berkas</label>
						<?php
							input_text("no_berkas",$no_berkas,"maxlength='255' autofocus","Masukkan No","text");
						?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					  <label>Nama Berkas</label>
						<?php
							input_text("nama_berkas",$nama_berkas,"maxlength='255' required","Masukkan Nama","text");
						?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					<label>Kategori</label>
					<?php
						input_pdselect2("id_kategori_berkas",$ambil_kategori_berkas,$id_kategori_berkas);
					?>
					</div>
				</div>
			</div>
        </div>
        <div class="box-footer">
        <?php 
        	if(empty($this->session->id_level)){
        ?>
        <div class="box-footer">
<button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
        <?php 
					}
        ?>
        </div>
		<?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="ijasah")
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
elseif ($page=="ijasah_tambah")
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
		<?php echo form_open_multipart('member/ijasah/tambah',' id="signupform" ');
		input_text("id_pegawai",$member_id,"","","hidden");
		?>
        <div class="box-body">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
					  <label>Pilih Berkas &nbsp;<small">Format harus PDF</small></label>
						<?php
							input_text("upload_Files[]","","","","file");
						?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					  <label>No Ijasah</label>
						<?php
							input_text("no_berkas",$no_berkas,"maxlength='255' autofocus","Masukkan No","text");
						?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					  <label>Nama Instansi Pendidikan</label>
						<?php
							input_text("nama_berkas",$nama_berkas,"maxlength='255' required","Masukkan Nama","text");
						?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					<label>Jenjang Pendidikan</label>
					<?php
						input_pdselect2("id_pendidikan",$cmd_pendidikan,$id_pendidikan);
					?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					<label>Tanggal Kelulusan</label>
					<?php
						input_calendar("first_date","tgl_b_berkas",$tgl_b_berkas,"Masukkan Tanggal"," required");
					?>
					</div>
				</div>
			</div>
        </div>
        <div class="box-footer">
        <?php 
        	if(empty($this->session->id_level)){
        ?>
        <div class="box-footer">
<button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
        <?php 
					}
        ?>
        </div>
		<?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="ijasah_edit")
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
		<?php echo form_open_multipart('member/ijasah/edit/'.$id,' id="signupform" ');
		input_text("id_berkas",$id_berkas,"","","hidden");
		input_text("link_berkas_lama",$link_berkas,"","","hidden");
		?>
        <div class="box-body">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
					  <label>Pilih Berkas &nbsp;<small">Format harus PDF</small></label>
						<?php
							input_text("upload_Files[]","","","","file");
						?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					  <label>No Ijasah</label>
						<?php
							input_text("no_berkas",$no_berkas,"maxlength='255' autofocus","Masukkan No","text");
						?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					  <label>Nama Instansi Pendidikan</label>
						<?php
							input_text("nama_berkas",$nama_berkas,"maxlength='255' required","Masukkan Nama","text");
						?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					<label>Jenjang Pendidikan</label>
					<?php
						input_pdselect2("id_pendidikan",$cmd_pendidikan,$id_pendidikan);
					?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					<label>Tanggal Kelulusan</label>
					<?php
						input_calendar("first_date","tgl_b_berkas",$tgl_b_berkas,"Masukkan Tanggal"," required");
					?>
					</div>
				</div>
			</div>
        </div>
        <div class="box-footer">
        <?php 
        	if(empty($this->session->id_level)){
        ?>
        <div class="box-footer">
<button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
        <?php 
					}
        ?>
        </div>
		<?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="pelatihan")
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
elseif ($page=="pelatihan_tambah")
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
		<?php echo form_open_multipart('member/pelatihan/tambah',' id="signupform" ');
		input_text("id_pegawai",$member_id,"","","hidden");
		?>
        <div class="box-body">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
					  <label>Pilih Berkas &nbsp;<small">Format harus PDF</small></label>
						<?php
							input_text("upload_Files[]",""," ","","file");
						?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					<label>Tanggal Mulai</label>
					<?php
						input_calendar("first_date","tgl_a_berkas",$tgl_a_berkas,"Masukkan Tanggal"," required");
					?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					<label>Tanggal Akhir</label>
					<?php
						input_calendar("last_date","tgl_b_berkas",$tgl_b_berkas,"Masukkan Tanggal"," required");
					?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					  <label>No SK / Sertifikat</label>
						<?php
							input_text("no_sertifikat",$no_sertifikat,"maxlength='255' autofocus","Masukkan No","text");
						?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
                  <label>Nilai SKP / SKS (Gunakan titik untuk desimal misal 1.5)</label>
					<?php
						input_textcustom("kredit",$kredit,"maxlength='4' required
						onkeypress='return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46' class='form-control'
						","Masukkan Nilai SKP / SKS","text");
					?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					<label>Penyelenggara</label>
					<?php
						input_text("penyelenggara",$penyelenggara,"maxlength='255' ","Masukkan penyelenggara","text");
					?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					  <label>Nama Pelatihan</label>
						<?php
							input_text("nama_berkas",$nama_berkas,"maxlength='255' required","Masukkan Nama","text");
						?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					<label>Kategori</label>
					<?php
						input_pdselect2("id_kategori_berkas",$ambil_kategori_berkas,$id_kategori_berkas);
					?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					<label>Kategori Pelatihan Unit / Jenjang Karir</label>
					<?php
						input_pdselect2fleksibel("id_kategori_pelatihan","id_kategori_pelatihan",$kategori_pelatihan,"id_kategori_pelatihan","nama_kategori_pelatihan",$id_kategori_pelatihan,"Tidak Ada Kategori");
					?>
					</div>
				</div>
			</div>
        </div>
        <div class="box-footer">
        <?php 
        	if(empty($this->session->id_level)){
        ?>
        <div class="box-footer">
<button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
        <?php 
					}
        ?>
        </div>
		<?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="pelatihan_edit")
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
		<?php echo form_open_multipart('member/pelatihan/edit/'.$id,' id="signupform" ');
		input_text("id_berkas",$id_berkas,"","","hidden");
		input_text("link_berkas_lama",$link_berkas,"","","hidden");
		?>
        <div class="box-body">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
					  <label>Pilih Berkas &nbsp;<small">Format harus PDF</small></label>
						<?php
							input_text("upload_Files[]",""," ","","file");
						?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					<label>Tanggal Mulai</label>
					<?php
						input_calendar("first_date","tgl_a_berkas",$tgl_a_berkas,"Masukkan Tanggal"," required");
					?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					<label>Tanggal Akhir</label>
					<?php
						input_calendar("last_date","tgl_b_berkas",$tgl_b_berkas,"Masukkan Tanggal"," required");
					?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					  <label>No SK / Sertifikat</label>
						<?php
							input_text("no_sertifikat",$no_sertifikat,"maxlength='255' autofocus","Masukkan No","text");
						?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
                  <label>Nilai SKP / SKS (Gunakan titik untuk desimal misal 1.5)</label>
					<?php
						input_textcustom("kredit",$kredit,"maxlength='4' required
						onkeypress='return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46' class='form-control'
						","Masukkan Nilai SKP / SKS","text");
					?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					<label>Penyelenggara</label>
					<?php
						input_text("penyelenggara",$penyelenggara,"maxlength='255' ","Masukkan penyelenggara","text");
					?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					  <label>Nama Pelatihan</label>
						<?php
							input_text("nama_berkas",$nama_berkas,"maxlength='255' required","Masukkan Nama","text");
						?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					<label>Kategori</label>
					<?php
						input_pdselect2("id_kategori_berkas",$ambil_kategori_berkas,$id_kategori_berkas);
					?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					<label>Kategori Pelatihan Unit / Jenjang Karir</label>
					<?php
						input_pdselect2fleksibel("id_kategori_pelatihan","id_kategori_pelatihan",$kategori_pelatihan,"id_kategori_pelatihan","nama_kategori_pelatihan",$id_kategori_pelatihan,"Tidak Ada Kategori");
					?>
					</div>
				</div>
			</div>
        </div>
        <div class="box-footer">
        <?php 
        	if(empty($this->session->id_level)){
        ?>
        <div class="box-footer">
<button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
        <?php 
					}
        ?>
        </div>
		<?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="surat_ijin")
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
elseif ($page=="surat_ijin_tambah")
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
		<?php echo form_open_multipart('member/surat_ijin/tambah',' id="signupform" ');
		input_text("id_pegawai",$member_id,"","","hidden");
		?>
        <div class="box-body">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
					  <label>Pilih Berkas &nbsp;<small">Format harus PDF</small></label>
						<?php
							input_text("upload_Files[]",""," ","","file");
						?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					  <label>Nama Berkas</label>
						<?php
							input_text("nama_berkas",$nama_berkas,"maxlength='255' required","Masukkan Nama","text");
						?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
                  <label>No STR/SIK/SIP</label>
					<?php
						input_text("no_berkas",$no_berkas,"maxlength='255' required","Masukkan No STR / SIK / SIP","text");
						?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					<label>Tanggal Berlaku</label>
					<?php
						input_calendar("first_date","tgl_a_berkas",$tgl_a_berkas,"Masukkan Tanggal"," required");
					?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					<label>Tanggal Expired</label>
					<?php
						input_calendar("last_date","tgl_b_berkas",$tgl_b_berkas,"Masukkan Tanggal"," required");
					?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					<label>Kategori</label>
					<?php
						input_pdselect2("id_kategori_berkas",$kategori_str_all,$id_kategori_berkas);
					?>
					</div>
				</div>
			</div>
        </div>
        <div class="box-footer">
         <?php 
        	if(empty($this->session->id_level)){
        ?>
        <div class="box-footer">
<button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
        <?php 
					}
        ?>
        </div>
		<?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="surat_ijin_perpanjangan")
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
		<?php echo form_open_multipart('member/surat_ijin/perpanjangan/'.$id,' id="signupform" ');
		input_text("id_berkas",$id_berkas,"","","hidden");
		input_text("id_pegawai",$member_id,"","","hidden");
		input_text("id_kategori_berkas",$id_kategori_berkas,"","","hidden");
		?>
        <div class="box-body">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
					  <label>Pilih Berkas &nbsp;<small">Format harus PDF</small></label>
						<?php
							input_text("upload_Files[]",""," ","","file");
						?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					  <label>Nama Berkas</label>
						<?php
							input_text("nama_berkas",$nama_berkas,"maxlength='255' required","Masukkan Nama","text");
						?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
                  <label>No STR/SIK/SIP</label>
					<?php
						input_text("no_berkas",$no_berkas,"maxlength='255' required","Masukkan No STR / SIK / SIP","text");
						?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					<label>Tanggal Berlaku</label>
					<?php
						input_calendar("first_date","tgl_a_berkas",$tgl_a_berkas,"Masukkan Tanggal"," required");
					?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					<label>Tanggal Expired</label>
					<?php
						input_calendar("last_date","tgl_b_berkas",$tgl_b_berkas,"Masukkan Tanggal"," required");
					?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					<label>Kategori</label>
					<?php
						input_pdselect2("id_kategori_berkas",$kategori_str_all,$id_kategori_berkas);
					?>
					</div>
				</div>
			</div>
        </div>
        <div class="box-footer">
        <?php 
        	if(empty($this->session->id_level)){
        ?>
        <div class="box-footer">
        <?php 
        	if(empty($this->session->id_level)){
        ?>
        <div class="box-footer">
<button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
        <?php 
					}
        ?>
        </div>
        <?php 
					}
        ?>
        </div>
		<?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="surat_ijin_edit")
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
		<?php echo form_open_multipart('member/surat_ijin/edit/'.$id,' id="signupform" ');
		input_text("id_berkas",$id_berkas,"","","hidden");
		input_text("link_berkas_lama",$link_berkas,"","","hidden");
		?>
        <div class="box-body">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
					  <label>Pilih Berkas &nbsp;<small">Format harus PDF</small></label>
						<?php
							input_text("upload_Files[]",""," ","","file");
						?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					<label>Tanggal Berlaku</label>
					<?php
						input_calendar("first_date","tgl_a_berkas",$tgl_a_berkas,"Masukkan Tanggal"," required");
					?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					<label>Tanggal Expired</label>
					<?php
						input_calendar("last_date","tgl_b_berkas",$tgl_b_berkas,"Masukkan Tanggal"," required");
					?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					  <label>Nama Berkas</label>
						<?php
							input_text("nama_berkas",$nama_berkas,"maxlength='255' required","Masukkan Nama","text");
						?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
                  <label>No STR/SIK/SIP</label>
					<?php
						input_text("no_berkas",$no_berkas,"maxlength='255' required","Masukkan No STR / SIK / SIP","text");
						?>
					</div>
				</div>
			</div>
        </div>
        <div class="box-footer">
        <?php 
        	if(empty($this->session->id_level)){
        ?>
        <div class="box-footer">
<button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
        <?php 
					}
        ?>
        </div>
		<?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="logbook")
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
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
		   <h3 class="box-title">
			<?php echo $header; ?> <small style="color:white;font-weight:bold;">  <?php echo $instance_name; ?> </small>
		   </h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
			<div class="col-md-6">
			<?php echo form_open_multipart('ol_logbook/logbook/view/'.$first_date.'/'.$last_date.'/'.$id_ruangan,' id="signupform" '); ?>
			  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
				<div class="box-header with-border">
				  <h3 class="box-title">RANGE /PERIODE TANGGAL</h3>
				</div>
				  <div class="box-body">
					<div class="row">
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
              <div class="col-md-12">
                <div class="form-group">
                  <label>Instansi</label>
                  <?php
  input_pdselect2fleksibel("id_instansi","id_instansi",$ambil_data_instansi_null,"id_working","nama_working",$id_ruangan,"Semua");
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
			<div class="col-md-6">
			  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
				<div class="box-header with-border">
				  <h3 class="box-title">CATATAN</h3>
				</div>
				  <div class="box-body">
				  <div class="box box-widget">
					<div style="font-weight:bold;color:green;" class="box-body">
						<ul>
						<li>BAGI YANG TIDAK MEMPUNYAI DATA PENUGASAN KLINIS SILAHKAN MASUK DI LOGBOOK NON KEPERAWATAN</li>
						<li>PATOKAN WAKTU PRINT PDF MENGGUNAKAN TANGGAL AWAL</li>
						<li>GUNAKAN RANGE / PERIODE TANGGAL UNTUK MELIHAT DATA LOGBOOK LAMA</li>
					</ul>
					<Ol>
						<li>UNTUK OPPE WAJIB MENGISI LOGBOOK MINIMAL 1X DALAM 1BULAN</li>
						<li>UNTUK OPPE WAJIB MENGIKUTI DAN MENGUPLOAD SERTIFIKAT PELATIHAN MINIMAL 4 DALAM 1 BULAN</li>
						<li>UNTUK OPPE WAJIB DINILAI ETIK OLEH KEPALA RUANGAN</li>
					</Ol>
						
					</div>
					<!-- /.box-body -->
				  </div>
				  </div>
			  </div>
			</div>
			<div class="col-md-12">
			  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
				<div class="box-header with-border">
				   <h3 class="box-title">
					DATA LOGBOOK
				   </h3>
				  <div class="box-tools pull-right">
					<a href="<?php echo base_url('ol_logbook/logbook/pdf_harian/'); ?><?php echo $first_date;?>/<?php echo $last_date;?>/<?php echo $this->session->id_pegawai;?>" target="_blank" class="btn btn-white btn-md">
						<i class="fa fa-file-pdf-o"></i> HARIAN
					</a> ||
					<a href="<?php echo base_url('ol_logbook/logbook/pdf_bulanan'); ?>" target="_blank" class="btn btn-white btn-md">
						<i class="fa fa-file-pdf-o"></i> BCP UKOM
					</a>
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
							  <th style="vertical-align:middle;font-weight:bold;display:none;"></th>
							  <th style="vertical-align:middle;font-weight:bold;">Tanggal</th>
							  <th style="vertical-align:middle;font-weight:bold;">PK</th>
							  <th style="vertical-align:middle;font-weight:bold;">Nama Kewenangan</th>
							  <th style="vertical-align:middle;font-weight:bold;">Instansi</th>
							</tr>
						</thead>
					</table>
				</div>
				<div class="box-footer">

				</div>
			  </div>
			  </div>
        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="logbook_tambah")
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
	<?php echo form_open_multipart('ol_logbook/logbook/tambah/'.$first_date.'/'.$last_date.'/'.$id_ruangan.'/'.$id_jabatan_fungsional.'/'.$opsi_kewenangan.'/'.$id_kode_kewenangan ,' id="signupform" ');
  	input_text("first_date",$first_date,"","","hidden");
  	input_text("last_date",$last_date,"","","hidden");
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
      <h3 class="box-title">SILAHKAN PILIH OPSINYA</h3>
    </div>
      <div class="box-body">
      <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Sumber Kompetensi</label>
                <?php
                  input_pdselect2("opsi_kewenangan",$cmd_opsi,$opsi_kewenangan);
                ?>
              </div>
            </div>
        <div class="col-md-3">
          <div class="form-group">
            <label>Kompetensi</label>
              <?php
        input_pdselect2fleksibel("id_ruangan","id_ruangan",$cmd_ruangan,"id_ruangan","nama_ruangan",$id_ruangan,"Semua Kewenangan");
              ?>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label>Jabatan Fungsional</label>
              <?php
              input_pdselect2("id_jabatan_fungsional",$cmd_jabfung_buket,$id_jabatan_fungsional);
              ?>
          </div>
        </div>
        <div class="col-md-3">
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
		  <table id="example1" width="100%" class="table table-bordered table-striped">
			  <thead>
				<tr>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;">
						<input name="select_all" class="checkall" type="checkbox" />
					</th>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kewenangan</th>
          <?php  
            if($opsi_kewenangan == 0){
          ?>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kompetensi</th>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kode</th>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Sifat</th>
          <?php  
            }
          ?>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Jabatan</th>
				</tr>
			  </thead>
			  <tbody>
					<?php
					foreach($kr_kewenangan_detil as $row){
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
          <?php  
            if($opsi_kewenangan == 0){
          ?>
          <td style="vertical-align:middle;"><?php echo $row['nama_kompetensi']; ?></td>
					<td style="vertical-align:middle;"><?php echo $row['nama_kode_kewenangan']; ?></td>
					<td style="vertical-align:middle;"><?php echo $row['nama_sifat_kewenangan']; ?></td>
					<td style="vertical-align:middle;"><?php echo $row['nama_jabatan']; ?></td>
          <?php  
            }else{
          ?>
          <td style="vertical-align:middle;"><?php echo $row['nama_jabatan_fungsional']; ?></td>
          <?php
            }
          ?>
				</tr>
					<?php
						}
					?>
			  </tbody>
		  </table>
        </div>
        <div class="box-footer">
<button type="submit" name="action" value="BtnSimpan" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
        </div>
      </div>
	<?php echo form_close(); ?>
    </section>
</div>
<?php
}
elseif ($page=="logbook_isi")
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
	<?php echo form_open_multipart('ol_logbook/logbook/isi/'.$first_date.'/'.$last_date.'/'.$id_ruangan,' id="signupform" ');
	input_text("id_pegawai",$this->session->id_pegawai,"","","hidden");
	input_text("first_date",$first_date,"","","hidden");
	input_text("last_date",$last_date,"","","hidden");
  input_text("id_ruangan",$id_ruangan,"","","hidden"); // chk
	input_text("counter",$count,"","","hidden");
	?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
			<div class="col-md-2">
				<div class="form-group">
				  <label>Tanggal</label>
						<?php
							input_calendar("tgl_logbook","tgl_logbook",$tgl_logbook,"Masukkan Tanggal Transaksi"," required");
						?>
				</div>
			</div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Instansi</label>
                <?php
                  input_pdselect2("id_instansi",$ambil_data_instansi,$id_instansi);
                ?>
        </div>
      </div>
          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
				<?php
				foreach($kr_kewenangan as $row){
					if(in_array($row['id_kewenangan'], $terpilih)){
						input_text("id_kewenangan[]",$row['id_kewenangan'],"","","hidden");
            $jml_log = $this->m_ol_rancak->jumlah_record_logbook($row['id_kewenangan']);
            if($jml_log == 0){
				?>
		<div class="row">
			<div class="col-md-2">
				<label><strong>Jumlah</strong></label>
				<?php if($count=='0') { $read = 'readonly'; } else { $read = '';}
				input_textcustom("jml_logbook[]","1","maxlength='5' required class='form-control' $read
					onkeypress='return event.keyCode > 47 && event.keyCode < 58'" ,"Masukkan Jumlah","text"); ?>
			</div>
			<div class="col-md-4">
				<label><strong>RM</strong></label>
			  <?php
			  input_text("rm[]","","maxlength='255' ","Masukkan RM","text");
			  ?>
			</div>
			<div class="col-md-6">
				<label><strong>Kewenangan</strong></label>
			  <?php
			  input_textarea("nama_kewenangan[]",$row['nama_kewenangan'],"readonly ","","text");
			  ?>
			</div>
		</div><br>
				<?php
      }
    }
  }
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
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/unit/simpan_tambah');?>" onClick="return cek();">
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
            <div class="row">     
            <div class="col-md-12">
                <label>Instansi</label>
                <?php
                  input_pdselect2("id_unit",$ambil_data_unit_instansi,$id_unit);
                ?>
            </div>       
              <div class="col-md-12">
                  <label>Status</label>
                  <?php
                  input_pdselect2("status_pegawai_unit",$cmd_status,$status_pegawai_unit);
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
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/unit/simpan_edit');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            <input type="hidden" name="id_pegawai_unit" value="<?= $id; ?>">
            <input type="hidden" name="id_unit_lama" value="<?= $id_unit; ?>">
          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
            <div class="row">         
            <div class="col-md-12">
                <label>Instansi</label>
                <?php
                  input_pdselect2("id_unit",$ambil_data_unit_instansi,$id_unit);
                ?>
            </div>       
              <div class="col-md-12">
                  <label>Status</label>
                  <?php
                  input_pdselect2("status_pegawai_unit",$cmd_status,$status_pegawai_unit);
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
elseif ($page=="penilaian_kinerja")
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
	<?php echo form_open_multipart('pegawai/penilaian_kinerja/view/'.$tahun,' id="signupform" '); ?>
	  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
		<div class="box-header with-border">
		  <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
		</div>
		  <div class="box-body">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
					  <label>Tahun</label>
						<?php
							input_pdselect2("tahun",$cmd_tahun_logbook,$tahun);
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
           <h3 class="box-title">LOGBOOK <?php echo $title; if($tahun > 0) {echo ' TAHUN '.$tahun;} ?></h3>

          <div class="box-tools pull-right">
			<a href="<?php echo base_url('pegawai/penilaian_kinerja/pdf/'); ?><?php echo $tahun;?>" target="_blank" class="btn btn-white btn-md">
				<i class="fa fa-print"></i> PDF
			</a>
          </div>
        </div>
        <div class="box-body">
		   <table id="example1" width="100%" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th style="vertical-align:middle;text-align:center;font-weight:bold;">KEGIATAN</th>
					<th style="vertical-align:middle;text-align:center;font-weight:bold;">NILAI</th>
				</tr>
			</thead>
			<tbody>
			  <tr>
				<td colspan="2" style="vertical-align:middle;text-align:left;font-weight:bold;">KINERJA KLINIS</td>
			  </tr>
			  <tr>
				<td>
					<table width="100%" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th style="vertical-align:middle;text-align:left;font-weight:bold;">KOMPETENSI</th>
								<th style="vertical-align:middle;text-align:right;font-weight:bold;width:10%;">JUMLAH</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$total_logbook = 0;$total =0;
							foreach($ambil_data_kompetensi_pegawai_oppe as $rowambil_data_kompetensi_pegawai_oppe){
								$total_logbook = $total_logbook + $rowambil_data_kompetensi_pegawai_oppe['jml_logbook'];
						?>
						  <tr>
							<td style="vertical-align:middle;text-align:left;"><?php echo $rowambil_data_kompetensi_pegawai_oppe['nama_kompetensi']; ?></td>
							<td style="vertical-align:middle;text-align:right;"><?php echo $rowambil_data_kompetensi_pegawai_oppe['jml_logbook']; ?></td>
						  </tr>
						<?php
							}
						?>
						</tbody>
					</table>
				</td>
				<td style="vertical-align:middle;text-align:center;font-weight:bold;">
					<?php
						$total_logbook = $this->m_rancak->get_oppe_in_year($this->session->id_pegawai,$tahun);
						if($total_logbook < 7){
							$nilai_logbook = "KURANG";
							$skor_logbook = 0;

						}elseif($total_logbook < 12){
							$nilai_logbook = "CUKUP";
							$skor_logbook = 1;
						}
						else{
							$nilai_logbook = "BAIK";
							$skor_logbook = 2;
						}
						echo $nilai_logbook;						
					?>
				</td>
			  </tr>
			  <tr>
				<td colspan="2" style="vertical-align:middle;text-align:left;font-weight:bold;">PENGEMBANGAN PROFESI</td>
			  </tr>
			  <tr>
				<td>
					<table width="100%" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th style="vertical-align:middle;text-align:center;font-weight:bold;width:10%;">Mulai</th>
								<th style="vertical-align:middle;text-align:center;font-weight:bold;width:10%;">Akhir</th>
								<th style="vertical-align:middle;text-align:center;font-weight:bold;">Nama Pelatihan</th>
								<th style="vertical-align:middle;text-align:center;font-weight:bold;">Penyelenggara</th>
								<th style="vertical-align:middle;text-align:center;font-weight:bold;">Kategori</th>
								<th style="vertical-align:middle;text-align:right;font-weight:bold;width:10%;">SKS / SKP</th>
							</tr>
						</thead>
						<tbody>
						<?php
							foreach($ambil_data_pelatihan_pegawai_oppe as $rowambil_data_pelatihan_pegawai_oppe){
						?>
						  <tr>
							<td style="vertical-align:middle;text-align:center;"><?php echo date('d-m-Y', strtotime($rowambil_data_pelatihan_pegawai_oppe['tgl_a_berkas'])); ?></td>
							<td style="vertical-align:middle;text-align:center;"><?php echo date('d-m-Y', strtotime($rowambil_data_pelatihan_pegawai_oppe['tgl_b_berkas'])); ?></td>
							<td style="vertical-align:middle;text-align:center;"><?php echo $rowambil_data_pelatihan_pegawai_oppe['nama_berkas']; ?></td>
							<td style="vertical-align:middle;text-align:center;"><?php echo $rowambil_data_pelatihan_pegawai_oppe['penyelenggara']; ?></td>
							<td style="vertical-align:middle;text-align:center;"><?php echo $rowambil_data_pelatihan_pegawai_oppe['nama_kategori_pelatihan']; ?></td>
							<td style="vertical-align:middle;text-align:right;"><?php echo $rowambil_data_pelatihan_pegawai_oppe['kredit']; ?></td>
						  </tr>
						<?php
							}
						?>
						</tbody>
					</table>
				</td>
				<td style="vertical-align:middle;text-align:center;font-weight:bold;">
					<?php
						if($jml_pelatihan == 0){
							$nilai_pelatihan = "KURANG";
							$skor_pelatihan = 0;

						}elseif($jml_pelatihan < 4){
							$nilai_pelatihan = "CUKUP";
							$skor_pelatihan = 1;
						}
						else{
							$nilai_pelatihan = "BAIK";
							$skor_pelatihan = 2;
						}
						echo $nilai_pelatihan;
					?>
				</td>
			  </tr>
			  <tr>
				<td colspan="2" style="vertical-align:middle;text-align:left;font-weight:bold;">ETIKA PROFESI</td>
			  </tr>
			  <tr>
				<td>
					<table width="100%" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th style="vertical-align:middle;text-align:center;font-weight:bold;">Tanggal</th>
								<th style="vertical-align:middle;text-align:center;font-weight:bold;">Hasil</th>
								<th style="vertical-align:middle;text-align:center;font-weight:bold;">Penguji</th>
								<th style="vertical-align:middle;text-align:center;font-weight:bold;width:5%;"><i class="fa fa-print"></i></th>
							</tr>
						</thead>
						<tbody>
						<?php
							foreach($ambil_data_etik_pegawai_oppe as $rowambil_data_etik_pegawai_oppe){
						?>
						  <tr>
							<td style="vertical-align:middle;text-align:center;"><?php echo date('d-m-Y', strtotime($rowambil_data_etik_pegawai_oppe['tgl_etik_pegawai'])); ?></td>
							<td style="vertical-align:middle;text-align:center;"><?php echo $rowambil_data_etik_pegawai_oppe['hasil_etik']; ?></td>
							<td style="vertical-align:middle;text-align:center;"><?php echo $rowambil_data_etik_pegawai_oppe['nama_pegawai']; ?></td>
							<td style="vertical-align:middle;text-align:center;">
								<a href="<?php echo base_url('pegawai/pengajuan_kompetensi/pdf_etika/'.$rowambil_data_etik_pegawai_oppe['id_etik_pegawai']);?>" class="btn bg-green btn-xs" target="_blank">
								<i class="fa fa-file-pdf-o"></i></a>
							</td>
						  </tr>
						<?php
							}
						?>
						</tbody>
					</table>
				</td>
				<td style="vertical-align:middle;text-align:center;font-weight:bold;">
					<?php
						if($jml_etik == 0){
							$nilai_etik = "KURANG";
							$skor_etik = 0;
						}
						else{
							$nilai_etik = "BAIK";
							$skor_etik = 2;
						}
						echo $nilai_etik;
					?>
				</td>
			  </tr>
			</tbody>
			<tfoot>
			  <tr>
				<td style="vertical-align:middle;text-align:right;font-weight:bold;">RESULT</td>
				<td style="vertical-align:middle;text-align:center;font-weight:bold;">
				<?php
					$total = $skor_logbook + $skor_pelatihan + $skor_etik;
					if($total == 0){
						$nilai_total = "KURANG";

					}elseif($total < 3){
						$nilai_total = "CUKUP";
					}
					elseif($total < 5){
						$nilai_total = "BAIK";
					}
					else{
						$nilai_total = "EXCELLENT";
					}
					echo $nilai_total;
				?>
				</td>
			  </tr>
			</tfoot>
			</table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="fppe")
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
	<?php echo form_open_multipart('pegawai/fppe/view/'.$tahun,' id="signupform" '); ?>
	  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
		<div class="box-header with-border">
		  <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
		</div>
		  <div class="box-body">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
					  <label>Tahun</label>
						<?php
							input_pdselect2("tahun",$cmd_tahun_logbook,$tahun);
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
           <h3 class="box-title"><?php echo $title; if($tahun > 0) {echo ' TAHUN '.$tahun;} ?></h3>

          <div class="box-tools pull-right">
			<a href="<?php echo base_url('pegawai/fppe/pdf/'); ?><?php echo $id_pegawai;?>/<?php echo $tahun;?>" target="_blank" class="btn btn-white btn-md">
				<i class="fa fa-print"></i> PDF
			</a>
          </div>
        </div>
        <div class="box-body">
				   <table id="example1" width="100%" class="table table-bordered table-striped">
						<thead>
								<tr>
									<th style="background-color: #e0e0e0;vertical-align:middle;text-align:center;font-weight:bold;width:5%;">ID</th>
									<th style="background-color: #e0e0e0;vertical-align:middle;text-align:center;font-weight:bold;width:10%;">Tanggal Awal</th>
									<th style="background-color: #e0e0e0;vertical-align:middle;text-align:center;font-weight:bold;width:10%;">Tanggal Akhir</th>
									<th style="background-color: #e0e0e0;vertical-align:middle;text-align:center;font-weight:bold;width:15%">Nama</th>
									<th style="background-color: #e0e0e0;vertical-align:middle;text-align:center;font-weight:bold;width:15%">Ruangan</th>
									<th style="background-color: #e0e0e0;vertical-align:middle;text-align:center;font-weight:bold;width:15%">Penanggung Jawab</th>
									<th style="background-color: #e0e0e0;vertical-align:middle;text-align:center;font-weight:bold;width:15%">Tempat</th>
									<th style="background-color: #e0e0e0;vertical-align:middle;text-align:center;font-weight:bold;">Hasil</th>
									<th style="background-color: #e0e0e0;vertical-align:middle;text-align:center;font-weight:bold;">Catatan</th>
								</tr>
						</thead>
						<tbody>
						<?php
							$ambil_lobook_pemulihan_pertahun = $this->m_rancak->ambil_lobook_pemulihan_pertahun($this->session->id_user,$tahun);
							foreach($ambil_lobook_pemulihan_pertahun as $rowambil_lobook_pemulihan_pertahun){
						?>
					  <tr> 
					  	<td style="vertical-align:middle;text-align:center;"><?= $rowambil_lobook_pemulihan_pertahun['id_logbook_pemulihan'] ?></td>
					    <td style="vertical-align:middle;text-align:center;"><?= date('d-m-Y', strtotime($rowambil_lobook_pemulihan_pertahun['tgl_awal'])) ?></td>
					    <td style="vertical-align:middle;text-align:center;"><?= date('d-m-Y', strtotime($rowambil_lobook_pemulihan_pertahun['tgl_akhir'])) ?></td>
					    <td style="vertical-align:middle;text-align:left;"><?= $rowambil_lobook_pemulihan_pertahun['nama_pegawai'] ?></td>
					    <td style="vertical-align:middle;text-align:left;"><?= $rowambil_lobook_pemulihan_pertahun['nama_ruangan'] ?></td>
					    <td style="vertical-align:middle;text-align:left;"><?= $rowambil_lobook_pemulihan_pertahun['penanggungjawab'] ?></td>
					    <td style="vertical-align:middle;text-align:left;"><?= $rowambil_lobook_pemulihan_pertahun['tujuan'] ?></td>
					    <td style="vertical-align:middle;text-align:left;">
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
					    <td style="vertical-align:middle;text-align:left;"><?= $rowambil_lobook_pemulihan_pertahun['catatan_pemulihan'] ?></td>
					  </tr>
								<tr>
									<th colspan="9" style="background-color: #e0e0e0;text-align: center;">KEGIATAN PEMULIHAN</th>
								</tr>
							  <tr>
							    <th style="background-color: #e0e0e0;vertical-align:middle;text-align:center;">&nbsp;</th>
							    <th style="background-color: #e0e0e0;vertical-align:middle;text-align:center;">Tanggal</th>
							    <th style="background-color: #e0e0e0;vertical-align:middle;text-align:center;">RM</th>
							    <th style="background-color: #e0e0e0;vertical-align:middle;text-align:center;">Penguji</th>
							    <th style="background-color: #e0e0e0;vertical-align:middle;text-align:center;" colspan="2">Kompetensi</th>
							    <th style="background-color: #e0e0e0;vertical-align:middle;text-align:center;">Hasil</th>
							    <th style="background-color: #e0e0e0;vertical-align:middle;text-align:center;" colspan="2">Catatan</th>
							  </tr>
								<?php
									$ambil_lobook_pemulihan_detil = $this->m_rancak->ambil_kewenangan_lobook_kegiatan_pemulihan_detil($rowambil_lobook_pemulihan_pertahun['id_logbook_pemulihan']);
									foreach($ambil_lobook_pemulihan_detil as $rowambil_lobook_pemulihan_detil){
								?>
							  <tr>
							  	<td style="vertical-align:middle;text-align:left;">&nbsp;</td>
							    <td style="vertical-align:middle;text-align:center;"><?= date('d-m-Y', strtotime($rowambil_lobook_pemulihan_detil['tgl_kegiatan_pemulihan'])) ?></td>
							    <td style="vertical-align:middle;text-align:left;"><?= $rowambil_lobook_pemulihan_detil['rm_kegiatan_pemulihan'] ?></td>
							    <td style="vertical-align:middle;text-align:left;"><?= $rowambil_lobook_pemulihan_detil['nama_pegawai'] ?></td>
							    <td style="vertical-align:middle;text-align:left;" colspan="2"><?= $rowambil_lobook_pemulihan_detil['nama_kewenangan'] ?></td>
							    <td style="vertical-align:middle;text-align:left;">
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
							    <td style="vertical-align:middle;text-align:left;" colspan="2"><?= $rowambil_lobook_pemulihan_detil['catatan_kegiatan_pemulihan'] ?></td>
							  </tr>
						<?php
									}
							}
						?>
							</tbody>
						</table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="lt")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
	<?php echo form_open('member/lt/view/'.$bln.'/'.$thn,' class="form-horizontal"'); ?>
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
			<div class="col-md-4">
				<label>Range</label>
					<?php
						input_pdselect2("page",$array_page,$page);
					?>
			</div>
			<div class="col-md-4">
				<label>Bulan</label>
					<?php
						input_pdselect2("bln",$array_month,$bln);
					?>
			</div>
			<div class="col-md-4">
				<label>Tahun</label>
					<?php
						input_pdselect2("thn",$year_logbook,$thn);
					?>
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
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
			<div id="chartdiv"></div>
        </div>
      </div>
	  <?php echo form_close(); ?>
    </section>
</div>
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
<?php
}
elseif ($page=="lb")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
	<?php echo form_open('member/lb/view/'.$bln.'/'.$thn,' class="form-horizontal"'); ?>
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
			<div class="col-md-4">
				<label>Range</label>
					<?php
						input_pdselect2("page",$array_page,$page);
					?>
			</div>
			<div class="col-md-4">
				<label>Bulan</label>
					<?php
						input_pdselect2("bln",$array_month,$bln);
					?>
			</div>
			<div class="col-md-4">
				<label>Tahun</label>
					<?php
						input_pdselect2("thn",$year_logbook,$thn);
					?>
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
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
			<div id="chartdiv"></div>
        </div>
      </div>
	  <?php echo form_close(); ?>
    </section>
</div>
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
<?php
}
elseif ($page=="lh")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
	<?php echo form_open('member/lh/view/'.$bln.'/'.$thn,' class="form-horizontal"'); ?>
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
			<div class="col-md-4">
				<label>Range</label>
					<?php
						input_pdselect2("page",$array_page,$page);
					?>
			</div>
			<div class="col-md-4">
				<label>Bulan</label>
					<?php
						input_pdselect2("bln",$array_month,$bln);
					?>
			</div>
			<div class="col-md-4">
				<label>Tahun</label>
					<?php
						input_pdselect2("thn",$year_logbook,$thn);
					?>
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
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
			<div id="chartdiv"></div>
        </div>
      </div>
	  <?php echo form_close(); ?>
    </section>
</div>
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
elseif ($page=="working_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/working/simpan_tambah');?>" onClick="return cek();">
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
elseif ($page=="working_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/working/simpan_edit');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            <input type="hidden" name="id_pegawai_instansi" value="<?= $id; ?>">
            <input type="hidden" name="id_instansi_lama" value="<?= $id_instansi; ?>">
          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
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
elseif ($page=="peminatan")
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
              <th>Peminatan</th>
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
elseif ($page=="peminatan_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/peminatan/simpan_tambah');?>" onClick="return cek();">
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
            <div class="row">         
            <div class="col-md-12">
                <label>Nama</label>
                <?php
                  input_pdselect2("id_peminatan",$ambil_peminatan,$id_peminatan);
                ?>
            </div>   
              <div class="col-md-12">
                  <label>Status</label>
                  <?php
                  input_pdselect2("status_minat",$cmd_status,$status_minat);
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
elseif ($page=="peminatan_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/peminatan/simpan_edit');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            <input type="hidden" name="id_minat" value="<?= $id; ?>">
            <input type="hidden" name="id_peminatan_lama" value="<?= $id_peminatan; ?>">
          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
            <div class="row">         
            <div class="col-md-12">
                <label>Nama</label>
                <?php
                  input_pdselect2("id_peminatan",$ambil_peminatan,$id_peminatan);
                ?>
            </div>   
              <div class="col-md-12">
                  <label>Status</label>
                  <?php
                  input_pdselect2("status_minat",$cmd_status,$status_minat);
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
elseif ($page=="lt")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
  <?php echo form_open('member/lt/view/'.$bln.'/'.$thn,' class="form-horizontal"'); ?>
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
      <div class="col-md-4">
        <label>Range</label>
          <?php
            input_pdselect2("page",$array_page,$page);
          ?>
      </div>
      <div class="col-md-4">
        <label>Bulan</label>
          <?php
            input_pdselect2("bln",$array_month,$bln);
          ?>
      </div>
      <div class="col-md-4">
        <label>Tahun</label>
          <?php
            input_pdselect2("thn",$year_logbook,$thn);
          ?>
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
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
      <div id="chartdiv"></div>
        </div>
      </div>
    <?php echo form_close(); ?>
    </section>
</div>
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
<?php
}
elseif ($page=="lb")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
  <?php echo form_open('member/lb/view/'.$bln.'/'.$thn,' class="form-horizontal"'); ?>
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
      <div class="col-md-4">
        <label>Range</label>
          <?php
            input_pdselect2("page",$array_page,$page);
          ?>
      </div>
      <div class="col-md-4">
        <label>Bulan</label>
          <?php
            input_pdselect2("bln",$array_month,$bln);
          ?>
      </div>
      <div class="col-md-4">
        <label>Tahun</label>
          <?php
            input_pdselect2("thn",$year_logbook,$thn);
          ?>
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
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
      <div id="chartdiv"></div>
        </div>
      </div>
    <?php echo form_close(); ?>
    </section>
</div>
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
<?php
}
elseif ($page=="lh")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
  <?php echo form_open('member/lh/view/'.$bln.'/'.$thn,' class="form-horizontal"'); ?>
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
      <div class="col-md-4">
        <label>Range</label>
          <?php
            input_pdselect2("page",$array_page,$page);
          ?>
      </div>
      <div class="col-md-4">
        <label>Bulan</label>
          <?php
            input_pdselect2("bln",$array_month,$bln);
          ?>
      </div>
      <div class="col-md-4">
        <label>Tahun</label>
          <?php
            input_pdselect2("thn",$year_logbook,$thn);
          ?>
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
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
      <div id="chartdiv"></div>
        </div>
      </div>
    <?php echo form_close(); ?>
    </section>
</div>
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
<?php
}