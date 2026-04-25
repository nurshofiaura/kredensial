<?php
//=================================== H O M E ================================================
$arraybox = array('warning','success','info','danger');
$resarray = array_rand($arraybox);
$thenarray = $arraybox[$resarray];
if ($page=="home")
{
?>
<style>
#chartdiv {
  width: 100%;
  height: 400px;
}
</style>
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

				</div>
			  </div>
			</div>
			<div class="col-md-8">
			  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
				<div class="box-header with-border">
				   <h3 class="box-title">GRAFIK BULAN INI</h3>

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
      //      $yourarray = array('15','16','17','18','19','21');
    //        if(!in_array($level_id,$yourarray)){
           ?>
					     <div id="chartdiv"></div>
          <?php
    //        }
           ?>
				</div>
				<div class="box-footer">

				</div>
			  </div>

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
        <?php echo $header; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
		  <?php echo form_open_multipart('pegawai/profil',' id="signupform" ');
				input_text("id_user",$id_user,"","","hidden");
				input_text("id_pegawai",$id_pegawai,"","","hidden");
				input_text("wa",$pake_wa,"","","hidden");
				input_text("instance_name",$instance_name,"","","hidden");
				input_text("username_lama",$username_lama,"","","hidden");
				input_text("password_lama",$password_lama,"","","hidden");
				input_text("nip_lama",$nip,"","","hidden");
		  ?>
      <div class="row">
        <div class="col-md-3">
		      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
		        <div class="box-header with-border">
		           <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
		           <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

		          <div class="box-tools pull-right">
		            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
		                    title="Collapse">
		              <i class="fa fa-minus"></i></button>
		          </div>
		        </div>
		        <div class="box-body">
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
							<div class="col-md-3">
								<div class="form-group">
								  <label>NO KTP</label>
									<?php
                  input_textcustom("nik",$nik," required id='nik'
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "Masukkan No KTP","text");
									?>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
	                <label>No Induk Pegawai/ Karyawan &nbsp; <small><span style="font-weight:bold;" id="msg2"></span></small></label>
	                <?php
										input_textcustom("nip",$nip," required id='nip'
													onkeypress='if (event.keyCode == 32) { return false; }' class='form-control'",
															"Ketikkan NIP","text");
									?>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
								  <label>No Profesi misal IDI / PARI / NIRA</label>
									<?php
										input_text("no_profesi",$no_profesi,"maxlength='25' ","Ketikkan No Profesi","text");
									?>
								</div>
							</div>
						<div class="col-md-3">
							<div class="form-group">
							  <label>DPK / DPW</label>
								<?php
                  input_pdselect2fleksibel("id_pengcab","id_pengcab",$null_pengcab,"id_pengcab","nama_pengcab",$id_pengcab,"Tidak Termasuk");
								//	echo form_dropdown('id_kab',$kab,'0',array('id'=>'id_kab','class'=>'form-control'));
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
								  <label>Unit</label>
									<?php
										input_pdselect2fleksibel("id_unit","id_unit",$cmd_unit_null,"id_unit","nama_unit",$id_unit,"Tidak Ada Unit");
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
								  <small><input type="checkbox" onclick="myUsername()"> Show </small>
									<?php
										input_textcustom("username",$username," maxlength='60' class='form-control' autocomplete='off' id='username' ",
														"Huruf kecil tanpa spasi dan spesial character kecuali -","text");
									?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  <label>Password (ISI JIKA INGIN DIGANTI)</label>
								  <small><input type="checkbox" onclick="myPassword()"> Show </small>
									<?php
										input_textcustom("password",$password," maxlength='255' class='form-control' autocomplete='off' id='password' ",
														"Isi Jika Ingin Di ganti","password");
									?>
								</div>
							</div>
		        </div>
		        <div class="box-footer">
		        		<button type="submit" class="setuju btn btn-primary">Submit</button>
		        </div>
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
		<?php echo form_open_multipart('pegawai/berkas/tambah',' id="signupform" ');
		input_text("id_pegawai",$member_id,"","","hidden");
		?>
        <div class="box-body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
					  <label>Pilih Berkas &nbsp;<small">Format harus PDF</small></label>
						<?php
							input_text("upload_Files[]",""," required","","file");
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
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
		<?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}elseif ($page=="berkas_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('pegawai/berkas/simpan_edit');?>" onClick="return cek();">
		<input type="hidden" name="id_berkas" value="<?= $id; ?>">
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
								  <label>No Berkas</label>
									<?php
										input_text("no_berkas",$no_berkas,"maxlength='255' autofocus","Masukkan No","text");
									?>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
								  <label>Nama Berkas</label>
									<?php
										input_text("nama_berkas",$nama_berkas,"maxlength='255' required","Masukkan Nama","text");
									?>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
								<label>Kategori</label>
								<?php
									input_pdselect2("id_kategori_berkas",$ambil_kategori_berkas,$id_kategori_berkas);
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
					  <th width="5%">ID</th>
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
		<?php echo form_open_multipart('pegawai/ijasah/tambah',' id="signupform" ');
		input_text("id_pegawai",$member_id,"","","hidden");
		?>
        <div class="box-body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
					  <label>Pilih Berkas &nbsp;<small">Format harus PDF</small></label>
						<?php
							input_text("upload_Files[]",""," required","","file");
						?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					  <label>No Ijasah</label>
						<?php
							input_text("no_berkas",$no_berkas,"maxlength='255' autofocus","Masukkan No","text");
						?>
					</div>
				</div>
				<div class="col-md-6">
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
          <button type="submit" class="btn btn-primary">Submit</button>
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
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('pegawai/ijasah/simpan_edit');?>" onClick="return cek();">
		<input type="hidden" name="id_berkas" value="<?= $id; ?>">
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
								  <label>No Ijasah</label>
									<?php
										input_text("no_berkas",$no_berkas,"maxlength='255' autofocus","Masukkan No","text");
									?>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
								  <label>Nama Instansi Pendidikan</label>
									<?php
										input_text("nama_berkas",$nama_berkas,"maxlength='255' required","Masukkan Nama","text");
									?>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
								<label>Jenjang Pendidikan</label>
								<?php
									input_pdselect2("id_pendidikan",$cmd_pendidikan,$id_pendidikan);
								?>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
								<label>Tanggal Kelulusan</label>
								<?php
									input_calendar("first_date","tgl_b_berkas",$tgl_b_berkas,"Masukkan Tanggal"," required");
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
$('#first_date').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#first_date").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
</script>
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
					  <th width="5%">ID</th>
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
		<?php echo form_open_multipart('pegawai/pelatihan/tambah',' id="signupform" ');
		input_text("id_pegawai",$member_id,"","","hidden");
		?>
        <div class="box-body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
					  <label>Pilih Berkas &nbsp;<small">Format harus PDF</small></label>
						<?php
							input_text("upload_Files[]",""," required","","file");
						?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					  <label>No SK / Sertifikat</label>
						<?php
							input_text("no_sertifikat",$no_sertifikat,"maxlength='255' autofocus","Masukkan No","text");
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
                  <label>Nilai SKP / SKS (Gunakan titik untuk desimal misal 1.5)</label>
					<?php
						input_textcustom("kredit",$kredit,"maxlength='4' required
						onkeypress='return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46' class='form-control'
						","Masukkan Nilai SKP / SKS","text");
					?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					<label>Penyelenggara</label>
					<?php
						input_text("penyelenggara",$penyelenggara,"maxlength='255' ","Masukkan penyelenggara","text");
					?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					  <label>Nama Pelatihan</label>
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
				<div class="col-md-6">
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
          <button type="submit" class="btn btn-primary">Submit</button>
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
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('pegawai/pelatihan/simpan_edit');?>" onClick="return cek();">
		<input type="hidden" name="id_berkas" value="<?= $id; ?>">
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
								  <label>No SK / Sertifikat</label>
									<?php
										input_text("no_sertifikat",$no_sertifikat,"maxlength='255' autofocus","Masukkan No","text");
									?>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
								<label>Tanggal Mulai</label>
								<?php
									input_calendar("first_date","tgl_a_berkas",$tgl_a_berkas,"Masukkan Tanggal"," required");
								?>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
								<label>Tanggal Akhir</label>
								<?php
									input_calendar("last_date","tgl_b_berkas",$tgl_b_berkas,"Masukkan Tanggal"," required");
								?>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
							  <label>Nilai SKP / SKS (Gunakan titik untuk desimal misal 1.5)</label>
								<?php
									input_textcustom("kredit",$kredit,"maxlength='4' required
									onkeypress='return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46' class='form-control'
									","Masukkan Nilai SKP / SKS","text");
								?>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
								<label>Penyelenggara</label>
								<?php
									input_text("penyelenggara",$penyelenggara,"maxlength='255' ","Masukkan penyelenggara","text");
								?>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
								  <label>Nama Pelatihan</label>
									<?php
										input_text("nama_berkas",$nama_berkas,"maxlength='255' required","Masukkan Nama","text");
									?>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
								<label>Kategori</label>
								<?php
									input_pdselect2("id_kategori_berkas",$ambil_kategori_berkas,$id_kategori_berkas);
								?>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
								<label>Kategori Pelatihan Unit / Jenjang Karir</label>
								<?php
									input_pdselect2fleksibel("id_kategori_pelatihan","id_kategori_pelatihan",$kategori_pelatihan,"id_kategori_pelatihan","nama_kategori_pelatihan",$id_kategori_pelatihan,"Tidak Ada Kategori");
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
$('#first_date').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#first_date").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$('#last_date').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#last_date").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
</script>
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
					  <th width="5%">ID</th>
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
		<?php echo form_open_multipart('pegawai/surat_ijin/tambah',' id="signupform" ');
		input_text("id_pegawai",$member_id,"","","hidden");
		?>
        <div class="box-body">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
					  <label>Pilih Berkas &nbsp;<small">Format harus PDF</small></label>
						<?php
							input_text("upload_Files[]",""," required","","file");
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
          <button type="submit" class="btn btn-primary">Submit</button>
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
		<?php echo form_open_multipart('pegawai/surat_ijin/perpanjangan/'.$id,' id="signupform" ');
		input_text("id_berkas",$id,"","","hidden");
		input_text("id_pegawai",$member_id,"","","hidden");
		input_text("id_kategori_berkas",$id_kategori_berkas,"","","hidden");
		?>
        <div class="box-body">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
					  <label>Pilih Berkas &nbsp;<small">Format harus PDF</small></label>
						<?php
							input_text("upload_Files[]",""," required","","file");
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
          <button type="submit" class="btn btn-primary">Submit</button>
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
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('pegawai/surat_ijin/simpan_edit');?>" onClick="return cek();">
		<input type="hidden" name="id_berkas" value="<?= $id; ?>">
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
								<label>Tanggal Berlaku</label>
								<?php
									input_calendar("first_date","tgl_a_berkas",$tgl_a_berkas,"Masukkan Tanggal"," required");
								?>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
								<label>Tanggal Expired</label>
								<?php
									input_calendar("last_date","tgl_b_berkas",$tgl_b_berkas,"Masukkan Tanggal"," required");
								?>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
								  <label>Nama Berkas</label>
									<?php
										input_text("nama_berkas",$nama_berkas,"maxlength='255' required","Masukkan Nama","text");
									?>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
							  <label>No STR/SIK/SIP</label>
								<?php
									input_text("no_berkas",$no_berkas,"maxlength='255' required","Masukkan No STR / SIK / SIP","text");
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
$('#first_date').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#first_date").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$('#last_date').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#last_date").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
</script>
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
			<?php echo form_open_multipart('pegawai/logbook/view/'.$first_date.'/'.$last_date,' id="signupform" '); ?>
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
					<div style="font-weight:bold;color:red;" class="box-body">
						<ul>
						<li>BAGI YANG TIDAK MEMPUNYAI DATA PENUGASAN KLINIS SILAHKAN MASUK DI LOGBOOK NON KEPERAWATAN</li>
						<li>PATOKAN WAKTU PRINT PDF MENGGUNAKAN TANGGAL AWAL</li>
						<li>GUNAKAN RANGE / PERIODE TANGGAL UNTUK MELIHAT DATA LOGBOOK LAMA</li>
					</ul>
					<Ol>
						<li>UNTUK OPPE WAJIB MENGISI LOGBOOK MINIMAL 1X DALAM 1BULAN</li>
						<li>UNTUK OPPE WAJIB MENGIKUTI DAN MENGUPLOAD SERTIFIKAT PELATIHAN MINIMAL 4</li>
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
					<a href="<?php echo base_url('pegawai/logbook/pdf_harian/'); ?><?php echo $first_date;?>/<?php echo $last_date;?>/<?php echo $member_id;?>" target="_blank" class="btn btn-white btn-md">
						<i class="fa fa-file-pdf-o"></i> HARIAN
					</a> ||
					<a href="<?php echo base_url('pegawai/logbook/pdf_bulanan'); ?>" target="_blank" class="btn btn-white btn-md">
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
							  <th width="5%"></th>
							  <th style="text-align:center;vertical-align:middle;font-weight:bold;width:7%;">ID</th>
							  <th style="text-align:center;vertical-align:middle;font-weight:bold;width:7%;">Tanggal</th>
							  <th style="text-align:center;vertical-align:middle;font-weight:bold;">PK</th>
							  <th style="text-align:center;vertical-align:middle;font-weight:bold;">Nama Kewenangan</th>
							  <th style="text-align:center;vertical-align:middle;font-weight:bold;">JML</th>
							  <th style="text-align:center;vertical-align:middle;font-weight:bold;width:9%;">Karu</th>
							  <th style="text-align:center;vertical-align:middle;font-weight:bold;width:9%;">Kabid</th>
							  <th style="text-align:center;vertical-align:middle;font-weight:bold;width:9%;">Asesor</th>
							  <th style="text-align:center;vertical-align:middle;font-weight:bold;width:9%;">Komite</th>
							  <th style="text-align:center;vertical-align:middle;font-weight:bold;width:9%;">Direktur</th>
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
elseif ($page=="logbook_non_keperawatan")
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
	<?php echo form_open_multipart('pegawai/logbook/non_keperawatan/'.$first_date.'/'.$last_date.'/'.$id,' id="signupform" ');
	input_text("id_pegawai",$member_id,"","","hidden");
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
		  <table id="example1" width="100%" class="table table-bordered table-striped">
			  <thead>
				<tr>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;">
						<input name="select_all" class="checkall" type="checkbox" />
					</th>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kewenangan</th>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kompetensi</th>
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
						  <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_kewenangan_detil'];?>" >
						</label>
					  </div>
					</td>
					<td style="vertical-align:middle;"><?php echo $row['nama_kewenangan']; ?></td>
					<td style="vertical-align:middle;"><?php echo $row['nama_kompetensi']; ?></td>
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
		<a href="<?php echo $link_kembali;?>"
			class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
		</a>
    </section>
    <section class="content">
	<?php echo form_open_multipart('pegawai/logbook/tambah/'.$first_date.'/'.$last_date.'/'.$id,' id="signupform" ');
	input_text("id_pegawai",$member_id,"","","hidden");
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
		  <table id="example1" width="100%" class="table table-bordered table-striped">
			  <thead>
				<tr>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;">
						<input name="select_all" class="checkall" type="checkbox" />
					</th>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kewenangan</th>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kompetensi</th>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kode</th>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Sifat</th>
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
						  <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_kewenangan_detil'];?>" >
						</label>
					  </div>
					</td>
					<td style="vertical-align:middle;"><?php echo $row['nama_kewenangan']; ?></td>
					<td style="vertical-align:middle;"><?php echo $row['nama_kompetensi']; ?></td>
					<td style="vertical-align:middle;"><?php echo $row['nama_kode_kewenangan']; ?></td>
					<td style="vertical-align:middle;"><?php echo $row['nama_sifat_kewenangan']; ?></td>
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
		<a href="<?php echo $link_kembali;?>"
			class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
		</a>
    </section>
    <section class="content">
	<?php echo form_open_multipart('pegawai/logbook/isi/'.$first_date.'/'.$last_date.'/'.$id,' id="signupform" ');
	input_text("id_pegawai",$member_id,"","","hidden");
	input_text("first_date",$first_date,"","","hidden");
	input_text("last_date",$last_date,"","","hidden");
	input_text("counter",$count,"","","hidden");
	?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
			<div class="col-md-3">
				<div class="form-group">
				  <label>Tanggal</label>
						<?php
							input_calendar("tgl_logbook","tgl_logbook",$tgl_logbook,"Masukkan Tanggal Transaksi"," required");
						?>
				</div>
			</div>
          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
				<?php
				foreach($kr_kewenangan as $row){
					if(in_array($row['id_kewenangan_detil'], $terpilih)){
						input_text("id_kewenangan[]",$row['id_kewenangan'],"","","hidden");
						input_text("id_kewenangan_detil[]",$row['id_kewenangan_detil'],"","","hidden");
            $jml_log = $this->m_rancak->jumlah_record_logbook($member_id,$row['id_kewenangan']);
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
	<?php echo form_open_multipart('pegawai/seting_dupak/view/'.$bulan.'/'.$tahun,' id="signupform" '); ?>
	  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
		<div class="box-header with-border">
		  <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
		</div>
		  <div class="box-body">
			<div class="row">
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
					  <th>Butir Kegiatan</th>
					  <th>Bulan</th>
					  <th>Tahun</th>
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
elseif ($page=="seting_dupak_tambah")
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
	<?php echo form_open_multipart('pegawai/seting_dupak/tambah',' id="signupform" ');
	input_text("id_pegawai",$member_id,"","","hidden");
	?>
	  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
		<div class="box-header with-border">
		  <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
		</div>
		  <div class="box-body">
			<div class="row">
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

			</div>
	  </div>

      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
			<?php

			?>
          </div>
        </div>
        <div class="box-body">
		  <table id="example1" width="100%" class="table table-bordered table-striped">
			  <thead>
				<tr>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;">
						<input name="select_all" class="checkall" type="checkbox" />
					</th>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;">ID</th>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Butir Kegiatan</th>
				</tr>
			  </thead>
			  <tbody>
					<?php
					$no=0;
					$arr = array();
					foreach($kr_buket_personal as $val){
							$arr[] = $val['id_butir_kegiatan'];
					}
					$eimplo = implode(",", $arr);
					foreach($buket as $row){
						$no++;
					?>
				<tr>
					<td style="vertical-align:middle;">
					  <div class="checkbox">
						<label>
						  <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_butir_kegiatan'];?>"
							<?php if(in_array($row['id_butir_kegiatan'],explode(",", $eimplo))) echo 'checked="checked"'; ?> >
						</label>
					  </div>
					</td>
					<td style="vertical-align:middle;"><?php echo $row['id_butir_kegiatan'];?></td>
					<td style="vertical-align:middle;"><?php echo $row['nama_butir_kegiatan']; ?></td>
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
elseif ($page=="seting_dupak_transfer")
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
	<?php echo form_open_multipart('pegawai/seting_dupak/transfer',' id="signupform" '); ?>
	  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
		<div class="box-header with-border">
		  <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
		</div>
		  <div class="box-body">
			<div class="row">
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

			</div>
	  </div>

      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
			<?php
				input_text("id_pegawai",$member_id,"","","hidden");
			?>
          </div>
        </div>
        <div class="box-body">
		  <table id="example1" width="100%" class="table table-bordered table-striped">
			  <thead>
				<tr>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;">
						<input name="select_all" class="checkall" type="checkbox" />
					</th>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;">ID</th>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Butir Kegiatan</th>
				</tr>
			  </thead>
			  <tbody>
					<?php
					$no=0;
					$arr = array();
					foreach($kr_buket_personal as $val){
							$arr[] = $val['id_butir_kegiatan'];
					}
					$eimplo = implode(",", $arr);
					foreach($ambil_buket as $row){
						$no++;
					?>
				<tr>
					<td style="vertical-align:middle;">
					  <div class="checkbox">
						<label>
						  <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_butir_kegiatan'];?>"
							<?php if(in_array($row['id_butir_kegiatan'],explode(",", $eimplo))) echo 'checked="checked"'; ?> >
						</label>
					  </div>
					</td>
					<td style="vertical-align:middle;"><?php echo $row['id_butir_kegiatan'];?></td>
					<td style="vertical-align:middle;"><?php echo $row['nama_butir_kegiatan']; ?></td>
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
elseif ($page=="logbook_dupak")
{
?>
<style media="screen">
.select2-container {
    width: 100% !important;
    padding: 0;
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
        <?php echo $header; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
	<?php echo form_open_multipart('pegawai/logbook_dupak/view/'.$bulan.'/'.$tahun,' id="signupform" '); ?>
	  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
		<div class="box-header with-border">
		  <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
		</div>
		  <div class="box-body">
			<div class="row">
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
			//	input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
			?>
          </div>
        </div>
        <div class="box-body">
			<table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
				<thead>
					<tr>
					  <th>Tanggal</th>
					  <th>Butir Kegiatan</th>
					  <th>Nama Kewenangan</th>
					  <th>LogBook</th>
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
elseif ($page=="dupak")
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
	<?php echo form_open_multipart('pegawai/dupak/view/'.$bulan.'/'.$tahun,' id="signupform" '); ?>
	  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
		<div class="box-header with-border">
		  <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
		</div>
		  <div class="box-body">
			<div class="row">
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
			<a href="<?php echo base_url('pegawai/dupak/pdf_tahunan'); ?>" target="_blank" class="btn btn-white btn-md">
				<i class="fa fa-file-pdf-o"></i> TAHUNAN
			</a>
          </div>
        </div>
        <div class="box-body">
			<table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
				<thead>
					<tr>
					  <th>Tanggal</th>
					  <th>Butir Kegiatan</th>
					  <th>AK</th>
					  <th>LogBook</th>
					  <th>Bulan</th>
					  <th>Tahun</th>
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
					  <th>Tanggal</th>
					  <th>Status Usulan</th>
					  <th>Status</th>
					  <th>ACC Kabid</th>
					  <th>ACC Asesor</th>
					  <th>Asesor</th>
					  <th>ACC Komite</th>
					  <th>ACC Direktur</th>
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
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('pegawai/pengajuan_kompetensi/simpan_tambah');?>" onClick="return cek();">
      <input type="hidden" name="id_status_diusulkan" value="<?= $id; ?>">
      <input type="hidden" name="id_pegawai" value="<?= $member_id; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><?php $title; ?></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
		<div class="box-body">
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title"><?= $nama_status_diusulkan ?></h3>
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
						<div class="box-body box-profile">
						<button type="submit" class="btn btn-primary btn-block"><b>AJUKAN <?= strtoupper($nama_status_diusulkan) ?></b></button>
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
		<a href="<?php echo $link_awal;?>"
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
	  <?php echo form_open_multipart('pegawai/pengajuan_kompetensi/isi/'.$id,' ');
		input_text("id_pengajuan",$id_pengajuan,"","","hidden");
	  ?>
      <div class="row">
  		<div class="col-md-6">
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
               <h3 class="box-title">
    			    <?php echo $title; ?> <small style="color:white;font-weight:bold;">  <?php echo $instance_name; ?> </small>
    		    </h3>
            </div>
            <div class="box-body">
              <div class="box-body box-profile">
      <?php
      	if(empty($foto)){
      		$url_thumbx=base_url().'assets/images/noavatar.jpg';
      		$url_picbesarx=base_url().'assets/images/noavatar.jpg';
      	}else{
      		$cek_filesmall=FCPATH.'assets/foto/'.$foto;
      		if(file_exists($cek_filesmall)){
      			$url_thumbx=base_url().'assets/foto/'.$foto;
      			$url_picbesarx=base_url().'assets/foto/'.$foto;
      		}else{
      			$url_thumbx=base_url().'assets/images/noavatar.jpg';
      			$url_picbesarx=base_url().'assets/images/noavatar.jpg';
      		}
      	}
      ?>
      					<a class="example-image-link" href="<?php echo $url_picbesarx; ?>"
      						data-lightbox="example-set" data-title="<?php echo $member_name; ?>">
      						<img class="profile-user-img img-responsive img-circle"
      							src="<?php echo $url_thumbx; ?>" style="width:75px" alt="User profile picture">
      					</a>
      				  <h3 class="profile-username" style="color:green;text-align:center;"><?php echo $member_name; ?></h3>
      				  <h4 style="color:green;text-align:center;"><strong><?= strtoupper($nama_status_diusulkan) ?></strong></h4>
      					<div class="form-group">
      					</div>
      				  <ul class="list-group list-group-unbordered">
      						<?php
      				if($status_pengajuan=="0"){
	      						?>
												<li class="list-group-item">
				      							<a href="<?php echo base_url('pegawai/berkas_logbook/view/01-'.date("m-Y").'/'.date("d-m-Y").'/'.$id_pengajuan);?>" class="btn bg-green btn-block btn-xs">Pilih Data LogBook</a>
												</li>
	      						<?php
      				}else{
      						?>
	      							<li class="list-group-item">
	      									<a href="<?php echo base_url('pegawai/pengajuan_kompetensi/pdf/'.$id_pengajuan);?>"
	      									target="_blank" class="btn bg-purple btn-block btn-xs">
	      										<i class="fa fa-print"> &nbsp;PRINT LOGBOOK</i>
	      									</a>
	      							</li>
      						<?php
      				}
      						?>
      					<li class="list-group-item">
      						<?php
      							if($status_pengajuan=="0"){
      						?>
      								<a href="<?php echo base_url('pegawai/berkas_ijasah/view/'.$id_pengajuan);?>" class="btn bg-green btn-block btn-xs">
      								Pilih Ijasah</a>
      						<?php
      							}else{
      						?>
      								<a class="btn bg-red btn-block btn-xs">	Ijasah</a>
      						<?php
      							}
      						?>
      					</li>
      					<li class="list-group-item">
      						<?php
      							if($status_pengajuan=="0"){
      						?>
      								<a href="<?php echo base_url('pegawai/berkas_str/view/'.$id_pengajuan);?>" class="btn bg-green btn-block btn-xs">
      								Pilih Surat Ijin</a>
      						<?php
      							}else{
      						?>
      								<a class="btn bg-red btn-block btn-xs">	Surat Ijin</a>
      						<?php
      							}
      						?>
      					</li>
      					<li class="list-group-item">
      						<?php
      							if($status_pengajuan=="0"){
      						?>
      								<a href="<?php echo base_url('pegawai/berkas_sertifikat/view/'.$id_pengajuan);?>" class="btn bg-green btn-block btn-xs">
      								Pilih Sertifikat</a>
      						<?php
      							}else{
      						?>
      								<a class="btn bg-red btn-block btn-xs">	Sertifikat</a>
      						<?php
      							}
      						?>
      					</li>
      					<li class="list-group-item">
      						<?php
      							if($status_pengajuan=="0"){
      						?>
      									<a href="<?php echo base_url('pegawai/berkaslain_berkas/view/'.$id_pengajuan);?>" class="btn bg-green btn-block btn-xs">
      									Pilih Berkas Lain (opsional)</a>
      						<?php
      							}else{
      						?>
      								<a class="btn bg-red btn-block btn-xs">	Berkas Opsional</a>
      						<?php
      							}
      						?>
      					</li>
      								<li class="list-group-item">
      						<?php
      							if($status_pengajuan=="0"){
      								?>
      								<a href="<?php echo base_url('pegawai/berkas_etik/view/'.$id_pengajuan);?>" class="btn bg-green btn-block btn-xs">Pilih Etik</a>
      						<?php
      							}else{
      						?>
      								<a class="btn bg-red btn-block btn-xs">	Etik</a>
      						<?php
      							}
      						?>
      					</li>
      				  </ul>

      						<?php
      								input_text("id_pengajuan",$id,"","","hidden");
      						if($status_pengajuan=="0"){
      						if(($ijasah !== '') AND ($str !== '') AND ($sertifikat !== '') AND
      						($jml_logbooke > 0) AND  ($id_etik_pegawai !== '')){
      						?>

      							<button name="action" value="BtnKirim" class="btn btn-primary btn-block">
      								<i class="fa fa-send"></i> <b>KIRIM KOMPETENSI</b>
      							</button>
      						<?php
      								}else{
      						?>
      							<button name="action" value="Btnsimpan" class="btn btn-primary btn-block">
      								<i class="fa fa-save"></i> <b>SIMPAN KOMPETENSI</b>
      							</button>
      						<?php
      								}
      						}else{
      							?>
      							<a class="btn bg-red btn-block"><i class="fa fa-send"></i> <b>KIRIM KOMPETENSI</b></a>
      						<?php
      						}
      						 ?>
      				</div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">
    			   <?php echo $title; ?> <small style="color:white;font-weight:bold;">  <?php echo $instance_name; ?> </small>
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
									<a href="<?php echo base_url('assets/berkas/'.$row['link_berkas']);?>" target="_blank" class="btn bg-maroon btn-xs">
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
									<a href="<?php echo base_url('assets/berkas/'.$row2['link_berkas']);?>" target="_blank" class="btn bg-maroon btn-xs">
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
									<a href="<?php echo base_url('assets/berkas/'.$row3['link_berkas']);?>" target="_blank" class="btn bg-maroon btn-xs">
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
									<a href="<?php echo base_url('assets/berkas/'.$row4['link_berkas']);?>" target="_blank" class="btn bg-maroon btn-xs">
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
						<td colspan="2" class="mailbox-name">
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
					<a href="<?php echo base_url('pegawai/pengajuan_kompetensi/pdf_etika/'.$rowambil_data_etik_pegawai_oppe['id_etik_pegawai']);?>" class="btn bg-green btn-xs" target="_blank">
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
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">
    			   <?php echo $title; ?> <small style="color:white;font-weight:bold;">  <?php echo $instance_name; ?> </small>
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
						<td style="background-color:#9b0e27;color:white;text-weight:bold;">DOWNLOAD FILES</td>
					  </tr>
					  <tr>
						<td class="mailbox-name">
						<?php
						if(!empty($kredensial)){
						?>
							<a href="<?php echo base_url('assets/berkas/'.$kredensial);?>" target="_blank" class="btn bg-maroon btn-xs">
								<i class="fa fa-download"></i> Sub Kredensial
							</a>
						<?php
						}
						if(!empty($mutu)){
						?>
							<a href="<?php echo base_url('assets/berkas/'.$mutu);?>" target="_blank" class="btn bg-maroon btn-xs">
								<i class="fa fa-download"></i> Sub Mutu
							</a>
						<?php
						}
						if(!empty($etika)){
						?>
							<a href="<?php echo base_url('assets/berkas/'.$etika);?>" target="_blank" class="btn bg-maroon btn-xs">
								<i class="fa fa-download"></i> Sub Etika
							</a>
						<?php
						}
						if(!empty($spk)){
						?>
							<a href="<?php echo base_url('assets/berkas/'.$spk);?>" target="_blank" class="btn bg-maroon btn-xs">
								<i class="fa fa-download"></i> Rekomendasi
							</a>
						<?php
						}
						?>
						</td>
					  </tr>
					  </tbody>
					</table>
					<!-- /.table -->
				  </div>
				  <!-- /.mail-box-messages -->
				</div>
            </div>
          </div>
        </div>
      </div>
	  <?php echo form_close(); ?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">
			LOGBOOK YANG DIAJUKAN
		   </h3>
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
    					  <th style="text-align:center;vertical-align:middle;font-weight:bold;">ID</th>
    					  <th style="text-align:center;vertical-align:middle;font-weight:bold;">Tanggal</th>
    					  <th style="text-align:center;vertical-align:middle;font-weight:bold;">Nama</th>
    					  <th style="text-align:center;vertical-align:middle;font-weight:bold;">PK</th>
    					  <th style="text-align:center;vertical-align:middle;font-weight:bold;">Nama Kewenangan</th>
    					  <th style="text-align:center;vertical-align:middle;font-weight:bold;">JML</th>
    					  <th style="text-align:center;vertical-align:middle;font-weight:bold;">Karu</th>
    					  <th style="text-align:center;vertical-align:middle;font-weight:bold;">Kabid</th>
    					  <th style="text-align:center;vertical-align:middle;font-weight:bold;">Asesor</th>
    					  <th style="text-align:center;vertical-align:middle;font-weight:bold;">Komite</th>
    					  <th style="text-align:center;vertical-align:middle;font-weight:bold;">Direktur</th>
    					</tr>
    				</thead>
    			</table>
        </div>
      </div>
      <?php if($id_status_diusulkan == 4){ ?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">
			LOGBOOK DAN KEGIATAN PEMULIHAN
		   </h3>
        </div>
        <div class="box-body">
          <div class="box-tools pull-right">
          		
          </div>
    			<table id="dttb2" width="100%" class="table table-bordered table-striped table-hover" >
    				<thead>
    					<tr>
    					  <th style="text-align:center;vertical-align:middle;font-weight:bold;width:5%;">ID</th>
    					  <th style="text-align:center;vertical-align:middle;font-weight:bold;">Awal</th>
    					  <th style="text-align:center;vertical-align:middle;font-weight:bold;">Akhir</th>
    					  <th style="text-align:center;vertical-align:middle;font-weight:bold;">Penanggung Jawab</th>
    					  <th style="text-align:center;vertical-align:middle;font-weight:bold;">Ruangan</th>
    					  <th style="text-align:center;vertical-align:middle;font-weight:bold;">Hasil</th>
    					  <th style="text-align:center;vertical-align:middle;font-weight:bold;">Catatan</th>
    					</tr>
    				</thead>
    			</table>
        </div>
      </div>
    <?php } ?>
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
elseif ($page=="berkas_logbook")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
		<a href="<?php echo $link_kembali;?>"
			class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
		</a>
    </section>
    <section class="content">
	<?php echo form_open_multipart('pegawai/berkas_logbook/view/'.$first_date.'/'.$last_date.'/'.$id,' id="signupform" ');
	input_text("id_pengajuan",$id,"","","hidden");
	?>
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
						input_calendar("first_date","first_date",$first_date,"Masukkan Tanggal","required");
					?>
			  </div>
			</div>
			<div class="col-md-6">
			  <div class="form-group">
				<label>Tahun Akhir</label>
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
	  	<?php 
	  		if($id_status_diusulkan == 100){
	  	?>
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
							  <th>Tanggal</th>
							  <th>RM</th>
							  <th>Kode</th>
							  <th>Nama Kompetensi</th>
							  <th>Nama Kewenangan</th>
							  <th>Jumlah</th>
							  <th width="8%">V Karu</th>
							  <th>Tgl V</th>
							</tr>
						</thead>
					</table>
        </div>
      </div>
      <?php 
    		}
	  	?>
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
    					  <th style="text-align:center;vertical-align:middle;font-weight:bold;">ID</th>
    					  <th style="text-align:center;vertical-align:middle;font-weight:bold;">Tanggal</th>
    					  <th style="text-align:center;vertical-align:middle;font-weight:bold;">Nama Kewenangan</th>
   					  <th style="text-align:center;vertical-align:middle;font-weight:bold;">PK</th>
    					  <th style="text-align:center;vertical-align:middle;font-weight:bold;">Karu</th>
    					  <th style="text-align:center;vertical-align:middle;font-weight:bold;">Kabid</th>
    					  <th style="text-align:center;vertical-align:middle;font-weight:bold;">Asesor</th>
    					  <th style="text-align:center;vertical-align:middle;font-weight:bold;">Komite</th>
    					  <th style="text-align:center;vertical-align:middle;font-weight:bold;">Direktur</th>
    					  <th style="text-align:center;vertical-align:middle;font-weight:bold;">Result</th>
						</tr>
					  </thead>
					  <tbody>
							<?php
							foreach($logbook_pengajuan as $row){
							?>
						<tr>
							<td style="vertical-align:middle;text-align:center;">
							  <div class="checkbox">
								<label>
								  <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_logbook'];?>">
								</label>
							  </div>
							</td>
							<td style="vertical-align:middle;text-align:center;"><?php echo $row['id_logbook']; ?></td>
							<td style="vertical-align:middle;"><?php echo $row['tgl_logbook']; ?></td>
							<td style="vertical-align:middle;"><?php echo $row['nama_kewenangan']; ?></td>
							<td style="vertical-align:middle;"><?php echo $row['nama_kode_kewenangan']; ?></td>
							<td style="vertical-align:middle;">
								<?php 
										if($row['v_karu'] == 'Proses'){
											echo '<button class="btn btn-xs btn-default">Proses</button>'; 
										}else if($row['v_karu'] == 'Kompeten'){
											echo '<button class="btn btn-xs btn-success">Kompeten</button>'; 
										}else{
											echo '<button class="btn btn-xs btn-danger">Tolak</button>'; 
										}
								?>	
						  </td>
							<td style="vertical-align:middle;">
								<?php 
										if($row['v_kabid'] == 'Proses'){
											echo '<button class="btn btn-xs btn-default">Proses</button>'; 
										}else if($row['v_kabid'] == 'Kompeten'){
											echo '<button class="btn btn-xs btn-success">Kompeten</button>'; 
										}else{
											echo '<button class="btn btn-xs btn-danger">Tolak</button>'; 
										}
								?>	
						  </td>
							<td style="vertical-align:middle;">
								<?php 
										if($row['v_asesor'] == 'Proses'){
											echo '<button class="btn btn-xs btn-default">Proses</button>'; 
										}else if($row['v_asesor'] == 'Kompeten'){
											echo '<button class="btn btn-xs btn-success">Kompeten</button>'; 
										}else{
											echo '<button class="btn btn-xs btn-danger">Tolak</button>'; 
										}
								?>	
						  </td>
							<td style="vertical-align:middle;">
								<?php 
										if($row['v_komite'] == 'Proses'){
											echo '<button class="btn btn-xs btn-default">Proses</button>'; 
										}else if($row['v_komite'] == 'Kompeten'){
											echo '<button class="btn btn-xs btn-success">Kompeten</button>'; 
										}else{
											echo '<button class="btn btn-xs btn-danger">Tolak</button>'; 
										}
								?>	
						  </td>
							<td style="vertical-align:middle;">
								<?php 
										if($row['v_direktur'] == 'Proses'){
											echo '<button class="btn btn-xs btn-default">Proses</button>'; 
										}else if($row['v_direktur'] == 'Kompeten'){
											echo '<button class="btn btn-xs btn-success">Kompeten</button>'; 
										}else{
											echo '<button class="btn btn-xs btn-danger">Tolak</button>'; 
										}
								?>	
						  </td>
							<td style="vertical-align:middle;">
								<?php 
										if($row['result_tolak'] == 'Supervisi'){
											echo '<button class="btn btn-xs btn-danger">Supervisi</button>'; 
										}else if($row['result_tolak'] == 'Kompeten'){
											echo '<button class="btn btn-xs btn-danger">Tidak Kompeten</button>'; 
										}else{
											
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
        <div class="box-footer">
					<button type="submit" name="action" value="BtnTolak" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> SUBMIT</button>
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
					  <th>Nama Instansi</th>
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
					  <th>Nama File</th>
					  <th>No Surat Ijin</th>
					  <th>No Sertifikat</th>
					  <th>Expired</th>
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
					  <th>Nama Pelatihan</th>
					  <th>Penyelenggara</th>
					  <th>Tanggal Mulai</th>
					  <th>Tanggal Selesai</th>
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
elseif ($page=="berkaslain_berkas")
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
					  <th width="50%">Nama File</th>
					  <th width="13%">Kategori</th>
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
	<?php echo form_open('pegawai/lt/view/'.$bln.'/'.$thn,' class="form-horizontal"'); ?>
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
	<?php echo form_open('pegawai/lb/view/'.$bln.'/'.$thn,' class="form-horizontal"'); ?>
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
	<?php echo form_open('pegawai/lh/view/'.$bln.'/'.$thn,' class="form-horizontal"'); ?>
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
