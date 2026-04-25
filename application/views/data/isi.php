  <div class="danger-data" data-flashdata="<?php echo $this->session->flashdata('danger'); ?>"></div>
  <div class="sukses-data" data-flashdata="<?php echo $this->session->flashdata('sukses'); ?>"></div>
<?php
if ($page=="gender" || $page=="pk" || $page=="jabfung" || $page=="pendidikan" || $page=="agama" || $page=="status_perkawinan" || $page=="status_pegawai" || $page=="pelatihan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
#chartdiv {
  width: 100%;
  height: 600px;
}
</style>
<section class="page-header page-header-lg parallax parallax-3" style="background-image:url('<?php echo base_url();?>assets/images/red.jpg')">
	<div class="overlay dark-2"><!-- dark overlay [1 to 9 opacity] --></div>
</section>
<section>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
					<header class="text-center mb-40">
						<h1 class="fw-300"><?= $title ?></h1>
						<h2 class="fw-300 letter-spacing-1 fs-13"><span>DATA PERAWAT DAN BIDAN YANG TERDATA DI PROGRAM</span></h2>
					</header>
						<?php echo form_open_multipart('data/'.$page.'/view/'.$id,' id="signupform" '); ?>
						<div class="card card-default">
							<div class="card-heading card-heading-transparent">
								<h2 class="card-title bold">PILIH AREA</h2>
							</div>
							<div class="card-block">
<!-- ISI DISINI -->
					<div class="fancy-form fancy-form-select">
						<select class="form-control select2" id="id" name="id" >
							<option value="0">SEMUA INSTANSI</option>
							<?php foreach($datae as $roedatae){
								$terpilih = ($roedatae['id_working'] == $id) ? 'selected' : ''; // bikin kondisi kaya gini
							?>
							<option value="<?php echo $roedatae['id_working'];?>" <?= $terpilih; ?> ><?php echo $roedatae['nama_working']; ?></option>
							<?php } ?>
						</select>
	<i class="fancy-arrow-double"></i>
					</div>

<!-- BATAs ISI -->
							</div>
							<div class="card-footer">
<button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
							</div>
						</div>
							<?php echo form_close(); ?>
						<div class="card card-default">
							<div class="card-heading card-heading-transparent">
								<h2 class="card-title bold"><?= $title ?></h2>
							</div>
							<div class="card-block">
<!-- ISI DISINI -->
									<div id="chartdiv"></div>
<!-- BATAs ISI -->
							</div>
							<div class="card-block">
								<div id="legenddiv"></div>
							</div>
						</div>

			</div>
		</div>
	</div>
</section>
<?php
}
elseif ($page=="demografi")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
#chartdiv {
  width: 100%;
  height: 600px;
}
</style>
<section class="page-header page-header-lg parallax parallax-3" style="background-image:url('<?php echo base_url();?>assets/images/red.jpg')">
	<div class="overlay dark-2"><!-- dark overlay [1 to 9 opacity] --></div>
</section>
<section>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
					<header class="text-center mb-40">
						<h1 class="fw-300"><?= $title ?></h1>
						<h2 class="fw-300 letter-spacing-1 fs-13"><span>DATA PERAWAT DAN BIDAN YANG TERDATA DI PROGRAM</span></h2>
					</header>
						<?php echo form_open_multipart('data/'.$page.'/view/'.$id.'/'.$cr.'/'.$id_prov.'/'.$id_kab.'/'.$id_kel.'/'.$id_kec,' id="signupform" '); ?>
						<div class="card card-default">
							<div class="card-heading card-heading-transparent">
								<h2 class="card-title bold">PILIH AREA</h2>
							</div>
							<div class="card-block">
<!-- ISI DISINI -->
<div class="row">
	<div class="col-md-6">
		<label>Pilih Demografi</label>
					<div class="fancy-form fancy-form-select">
						<select class="form-control select2" id="id" name="id" >
							<option value="0" <?php if($id == 0){ echo 'selected="selected"'; } ?> >Provinsi </option>
							<option value="1" <?php if($id == 1){ echo 'selected="selected"'; } ?> >Kabupaten / Kota </option>
							<option value="2" <?php if($id == 2){ echo 'selected="selected"'; } ?> >Kecamatan</option>
							<option value="3" <?php if($id == 3){ echo 'selected="selected"'; } ?> >Kelurahan</option>

						</select>
	<i class="fancy-arrow-double"></i>
					</div><br>
	</div>
	<div class="col-md-6">
		<label>Pilih Data yang dicari</label>
					<div class="fancy-form fancy-form-select">
						<select class="form-control select2" id="cr" name="cr" >
							<option value="0" <?php if($cr == 0){ echo 'selected="selected"'; } ?> >Sesuai Opsi </option>
							<option value="1" <?php if($cr == 1){ echo 'selected="selected"'; } ?> >Semua </option>

						</select>
	<i class="fancy-arrow-double"></i>
					</div><br>
	</div>
	<div class="col-md-3">
		<label>Provinsi</label>
			<div class="fancy-form fancy-form-select">
				<select class="form-control select2" id="id_prov" name="id_prov" >
					<option value="0">Semua Provinsi</option>
					<?php foreach($kol_provinsi as $rowkol_provinsi){
						$terpilih = ($rowkol_provinsi['id_prov'] == $id_prov) ? 'selected' : ''; // bikin kondisi kaya gini
					?>
					<option value="<?php echo $rowkol_provinsi['id_prov'];?>" <?= $terpilih; ?> ><?php echo $rowkol_provinsi['nama_prov']; ?></option>
					<?php } ?>
				</select>
			<!--
			.fancy-arrow
			.fancy-arrow-double
			-->
				<i class="fancy-arrow-double"></i>
			</div>
	</div>

	<div class="col-md-3">
		<label>Kota / Kab</label>
			<div class="fancy-form fancy-form-select">
				<select class="form-control" id="id_kab" name="id_kab" >
					<?php foreach($kab as $rowkab){
						$terpilih = ($rowkab['id_kab'] == $id_kab) ? 'selected' : ''; // bikin kondisi kaya gini
					?>
					<option value="<?php echo $rowkab['id_kab'];?>" <?= $terpilih; ?> ><?php echo $rowkab['nama_kab']; ?></option>
					<?php } ?>
				</select>
			<!--
			.fancy-arrow
			.fancy-arrow-double
			-->
				<i class="fancy-arrow-double"></i>
			</div>
	</div>

	<div class="col-md-3">
		<label>Kecamatan</label>
			<div class="fancy-form fancy-form-select">
				<select class="form-control" id="id_kec" name="id_kec" >
					<?php foreach($kec as $rowkec){
						$terpilih = ($rowkec['id_kec'] == $id_kec) ? 'selected' : ''; // bikin kondisi kaya gini
					?>
					<option value="<?php echo $rowkec['id_kec'];?>" <?= $terpilih; ?> ><?php echo $rowkec['nama_kec']; ?></option>
					<?php } ?>
				</select>
			<!--
			.fancy-arrow
			.fancy-arrow-double
			-->
				<i class="fancy-arrow-double"></i>
			</div>
	</div>

	<div class="col-md-3">
		<label>Kelurahan</label>
			<div class="fancy-form fancy-form-select">
				<select class="form-control" id="id_kel" name="id_kel" >
					<?php foreach($kel as $rowkel){
						$terpilih = ($rowkel['id_kel'] == $id_kel) ? 'selected' : ''; // bikin kondisi kaya gini
					?>
					<option value="<?php echo $rowkel['id_kel'];?>" <?= $terpilih; ?> ><?php echo $rowkel['nama_kel']; ?></option>
					<?php } ?>
				</select>
			<!--
			.fancy-arrow
			.fancy-arrow-double
			-->
				<i class="fancy-arrow-double"></i>
			</div>
	</div>
</div>
<!-- BATAs ISI -->
							</div>
							<div class="card-footer">
<button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
							</div>
						</div>
							<?php echo form_close(); ?>
						<div class="card card-default">
							<div class="card-heading card-heading-transparent">
								<h2 class="card-title bold"><?= $title ?></h2>
							</div>
							<div class="card-block">
<!-- ISI DISINI -->
									<div id="chartdiv"></div>
<!-- BATAs ISI -->
							</div>
							<div class="card-block">
								<div id="legenddiv"></div>
							</div>
						</div>

			</div>
		</div>
	</div>
</section>
<?php
}
elseif ($page=="registrasi")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
#chartdiv {
  width: 100%;
  height: 600px;
}
</style>
<section class="page-header page-header-lg parallax parallax-3" style="background-image:url('<?php echo base_url();?>assets/images/red.jpg')">
	<div class="overlay dark-2"><!-- dark overlay [1 to 9 opacity] --></div>
</section>
<section>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
					<header class="text-center mb-40">
						<h1 class="fw-300"><?= $title ?></h1>
						<h2 class="fw-300 letter-spacing-1 fs-13"><span>=================================</span></h2>
					</header>
						<?php echo form_open_multipart('data/registrasi',' id="signupform" '); 

						?><input type="hidden" name="status_online" value="<?= $status_online; ?>">
						<div class="card card-default">
							<div class="card-heading card-heading-transparent">
								<h2 class="card-title bold">LENGKAPI FORM UNTUK REGISTRASI</h2>
							</div>
							<div class="card-block">
<!-- ISI DISINI -->
<div class="row">
	<div class="col-md-6">
		<label>Nama</label>
			<div class="fancy-form">
				<i class="fa fa-user"></i>

				<input type="text" id="nama_pegawai" name="nama_pegawai"  value="<?= $nama_pegawai ?>" required autofocus class="form-control" placeholder="">

				<!-- tooltip - optional, bootstrap tooltip can be used instead -->
				<span class="fancy-tooltip top-left"> <!-- positions: .top-left | .top-right -->
					<em>Masukkan Nama Lengkap</em>
				</span>
			</div>
	</div>
	<div class="col-md-3">
		<label>Tempat Lahir</label>
			<input type="text" class="form-control" id="tmp_lahir" name="tmp_lahir" required value="<?= $tmp_lahir ?>" placeholder="Tempat Kelahiran">
	</div>
	<div class="col-md-3">
		<label>Tanggal Lahir</label>
			<input type="text" class="form-control masked"  id="tgl_lahir" name="tgl_lahir" required  value="<?= $tgl_lahir ?>" data-format="99-99-9999" data-placeholder="_" placeholder="DD-MM-YYYY"><br>
	</div>
	<div class="col-md-3">
		<label>Jenis Kelamin</label>
					<div class="fancy-form fancy-form-select">
						<select class="form-control select2" id="jk" name="jk" required value="<?= $jk ?>">
							<option value="0" <?php if($jk == 0){ echo 'selected="selected"'; } ?> >Perempuan</option>
							<option value="1" <?php if($jk == 1){ echo 'selected="selected"'; } ?> >Laki-laki</option>
						</select>
	<i class="fancy-arrow-double"></i>
					</div><br>
	</div>
	<div class="col-md-3">
		<label>Status Perkawinan</label>
					<div class="fancy-form fancy-form-select">
						<select class="form-control select2" id="id_status_kawin" required name="id_status_kawin" value="<?= $id_status_kawin ?>">
							<?php foreach($cmd_status_kawin as $rowcmd_status_kawin){
								$terpilih = ($rowcmd_status_kawin['id_status_kawin'] == $id_status_kawin) ? 'selected' : ''; // bikin kondisi kaya gini
							?>
							<option value="<?php echo $rowcmd_status_kawin['id_status_kawin'];?>" <?php echo $terpilih; ?> ><?php echo $rowcmd_status_kawin['nama_status_kawin'];?></option>
							<?php } ?>
						</select>
	<i class="fancy-arrow-double"></i>
					</div><br>
	</div>
	<div class="col-md-3">
		<label>Agama</label>
					<div class="fancy-form fancy-form-select">
						<select class="form-control select2" id="id_agama" required name="id_agama" value="<?= $id_agama ?>">
							<?php foreach($cmd_agama as $rowcmd_agama){
								$terpilih = ($rowcmd_agama['id_agama'] == $id_agama) ? 'selected' : ''; // bikin kondisi kaya gini
							?>
							<option value="<?php echo $rowcmd_agama['id_agama'];?>" <?php echo $terpilih; ?> ><?php echo $rowcmd_agama['nama_agama'];?></option>
							<?php } ?>
						</select>
	<i class="fancy-arrow-double"></i>
					</div><br>
	</div>
	<div class="col-md-3">
		<label>Username</label>
			<div class="fancy-form">
				<i class="fa fa-lock"></i>

				<input type="text" id="username" name="username"  value="<?= $username ?>" autofocus required class="form-control" placeholder="">

				<!-- tooltip - optional, bootstrap tooltip can be used instead -->
				<span class="fancy-tooltip top-right"> <!-- positions: .top-left | .top-right -->
					<em>huruf kecil tanpa spasi dan tanpa spesial character</em>
				</span>
			</div>   &nbsp;<small><span style="font-weight:bold;" id="msg"></span></small>
	</div>
	<div class="col-md-4">
		<label>No KTP  &nbsp;<small><span style="font-weight:bold;" id="msg2"></span></small></label>
			<input type="text" class="form-control" id="nik" name="nik" required value="<?= $nik ?>" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="">
	</div>
	<div class="col-md-4">
		<label>Status Pegawai</label>
					<div class="fancy-form fancy-form-select">
						<select class="form-control select2" id="id_status_pegawai" required name="id_status_pegawai" value="<?= $id_status_pegawai ?>">
							<?php foreach($cmd_tipe_pegawai as $rowcmd_tipe_pegawai){
								$terpilih = ($rowcmd_tipe_pegawai['id_status_pegawai'] == $id_status_pegawai) ? 'selected' : ''; // bikin kondisi kaya gini
							?>
							<option value="<?php echo $rowcmd_tipe_pegawai['id_status_pegawai'];?>" <?php echo $terpilih; ?> ><?php echo $rowcmd_tipe_pegawai['nama_status_pegawai'];?></option>
							<?php } ?>
						</select>
	<i class="fancy-arrow-double"></i>
					</div><br>
	</div>
	<div class="col-md-4">
		<label>Jabatan Fungsional</label>
					<div class="fancy-form fancy-form-select">
						<select class="form-control select2" id="id_jabatan_fungsional" required name="id_jabatan_fungsional" value="<?= $id_jabatan_fungsional ?>">
							<?php foreach($jabatan_fungsional as $rowjabatan_fungsional){
								$terpilih = ($rowjabatan_fungsional['id_jabatan_fungsional'] == $id_jabatan_fungsional) ? 'selected' : ''; // bikin kondisi kaya gini
							?>
							<option value="<?php echo $rowjabatan_fungsional['id_jabatan_fungsional'];?>" <?php echo $terpilih; ?> ><?php echo $rowjabatan_fungsional['nama_jabatan_fungsional'];?></option>
							<?php } ?>
						</select>
	<i class="fancy-arrow-double"></i>
					</div><br>
	</div>
	<div class="col-md-4">
		<label>No Induk Pegawai</label>
			<input type="text" class="form-control" id="nip" name="nip" required value="<?= $nip ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="">
	</div>
	<div class="col-md-4">
		<label>No HP</label>
			<input type="text" class="form-control" id="no_hp" name="no_hp" required value="<?= $no_hp ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="">
	</div>
	<div class="col-md-4">
		<label>Email</label>
			<input type="email" class="form-control" id="email" name="email" required value="<?= $email ?>" placeholder=""><br>
	</div>
	<div class="col-md-6">
		<label>Pendidikan Terakhir</label>
					<div class="fancy-form fancy-form-select">
						<select class="form-control select2" id="id_pendidikan" required name="id_pendidikan" value="<?= $id_pendidikan ?>">
							<?php foreach($cmd_pendidikan as $rowcmd_pendidikan){
								$terpilih = ($rowcmd_pendidikan['id_pendidikan'] == $id_pendidikan) ? 'selected' : ''; // bikin kondisi kaya gini
							?>
							<option value="<?php echo $rowcmd_pendidikan['id_pendidikan'];?>" <?php echo $terpilih; ?> ><?php echo $rowcmd_pendidikan['nama_pendidikan'];?></option>
							<?php } ?>
						</select>
	<i class="fancy-arrow-double"></i>
					</div><br>
	</div>
	<div class="col-md-6">
		<label>Alamat</label>
			<input type="text" class="form-control" id="alamat" required name="alamat"  value="<?= $alamat ?>" placeholder=""><br>
	</div>
	<div class="col-md-6">
		<label>Tempat Bekerja (Jika tidak ada silahkan isi kolom berikutnya)</label>
					<div class="fancy-form fancy-form-select">
						<select class="form-control select2" id="id_working" required name="id_working" value="">
														<option value="0"> === INSTANSI LAINNYA ===</option>
							<?php foreach($ambil_instansi as $rowambil_instansi){
							//	$terpilih = ($rowambil_instansi['id_working'] == $id_working) ? 'selected' : ''; // bikin kondisi kaya gini
							?>
							<option value="<?php echo $rowambil_instansi['id_working'];?>" <?php echo $terpilih; ?> ><?php echo $rowambil_instansi['nama_working'];?></option>
							<?php } ?>
						</select>
	<i class="fancy-arrow-double"></i>
					</div><br>
	</div>
		<div class="col-md-6">
		<label>Opsi Tempat Bekerja</label>
			<input type="text" class="form-control" id="nama_instansi" name="nama_instansi"  value="<?= $nama_instansi ?>" placeholder="Tempat Bekerja (Isi jika di pilihan tidak ada)"><br>
	</div>
		<div class="col-md-4">
		<label>Alamat Tempat Bekerja</label>
			<input type="text" class="form-control" id="alamat_instansi" name="alamat_instansi"  value="<?= $alamat_instansi ?>" placeholder="Alamat Lengkap - Email - No Telp"><br>
	</div>
		<div class="col-md-4">
		<label>Unit / Ruangan</label>
			<input type="text" class="form-control" id="nama_unit" name="nama_unit"  value="<?= $nama_unit ?>" placeholder="Radiologi, IGD, ICU dll"><br>
	</div>
		<div class="col-md-4">
		<label>Penanggung Jawab Unit</label>
			<input type="text" class="form-control" id="atasan_unit" name="atasan_unit"  value="<?= $atasan_unit ?>" placeholder="Misal Kepala Seksi Penunjang Medik"><br>
	</div>
<!-- BATAs ISI -->
							</div>
							<div class="card-footer">
<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
							</div>
						</div>
							<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</section>
<?php
}
elseif ($page=="sukses")
{
?>
			<div class="maintenance">

				<h1><?= $title ?></h1>
				<p>

					<!-- custom text -->
					<strong>Registrasi Berhasil, Silahkan Hubungi Adiministrator Untuk Aktifasi</strong>
					<!-- /custom text -->

				</p>

				<hr />

<div class="callout alert alert-info mt-60 mb-60">

	<div class="row">

		<div class="col-md-8 col-sm-8"><!-- left text -->
			<h4>Kredensial <strong>ONLINE</strong></h4>
			<p>
				Aplikasi untuk kemudahan kredensial dan Indikator Mutu
			</p>
		</div><!-- /left text -->

		
		<div class="col-md-4 col-sm-4 text-right"><!-- right btn -->
			<a href="<?php echo base_url();?>" rel="nofollow" class="btn btn-info btn-lg">BERANDA</a>
		</div><!-- /right btn -->

	</div>

</div>

				<hr />

				<!-- socials -->
				<a href="https://web.facebook.com/simrsbanjarmasin" target="_blank" class="social-icon social-icon-sm social-facebook" title="Facebook">
					<i class="icon-facebook"></i>
					<i class="icon-facebook"></i>
				</a>

				<a href="https://www.instagram.com/aplikasikredensial/" target="_blank" class="social-icon social-icon-sm social-instagram" title="Instagram">
					<i class="icon-instagram"></i>
					<i class="icon-instagram"></i>
				</a>

				<a href="https://www.youtube.com/@programmerwahyudin7836" target="_blank" class="social-icon social-icon-sm social-youtube" title="Youtube">
					<i class="icon-youtube"></i>
					<i class="icon-youtube"></i>
				</a>
				<!-- /socials -->
				
				
			</div><!-- /maintenance -->
<?php
}
elseif ($page=="expired")
{
?>
			<div class="maintenance">

				<h1><?= $title ?></h1>
				<p>

					<!-- custom text -->
					<strong>Akun Expired, Silahkan Hubungi Adiministrator atau Cek Billing Anda / Instansi Anda</strong>
					<!-- /custom text -->

				</p>

				<hr />

<div class="callout alert alert-info mt-60 mb-60">

	<div class="row">

		<div class="col-md-8 col-sm-8"><!-- left text -->
			<h4>Kredensial <strong>ONLINE</strong></h4>
			<p>
				Aplikasi untuk kemudahan kredensial dan Indikator Mutu
			</p>
		</div><!-- /left text -->

		
		<div class="col-md-4 col-sm-4 text-right"><!-- right btn -->
			<a href="<?php echo base_url();?>" rel="nofollow" class="btn btn-info btn-lg">BERANDA</a>
		</div><!-- /right btn -->

	</div>

</div>

				<hr />

				<!-- socials -->
				<a href="https://web.facebook.com/simrsbanjarmasin" target="_blank" class="social-icon social-icon-sm social-facebook" title="Facebook">
					<i class="icon-facebook"></i>
					<i class="icon-facebook"></i>
				</a>

				<a href="https://www.instagram.com/aplikasikredensial/" target="_blank" class="social-icon social-icon-sm social-instagram" title="Instagram">
					<i class="icon-instagram"></i>
					<i class="icon-instagram"></i>
				</a>

				<a href="https://www.youtube.com/@programmerwahyudin7836" target="_blank" class="social-icon social-icon-sm social-youtube" title="Youtube">
					<i class="icon-youtube"></i>
					<i class="icon-youtube"></i>
				</a>
				<!-- /socials -->
				
				
			</div><!-- /maintenance -->
<?php
}