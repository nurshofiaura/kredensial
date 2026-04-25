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
		<a href="<?php echo $link_kembali;?>"
			class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
		</a>	||
		<a href="<?php echo $link_awal;?>"
			class="btn btn-info" > <i class="fa fa-file-o"></i> Pengajuan Kompetensi
		</a>
      </h1>
    </section>
    <section class="content">
	<?php echo form_open_multipart('developer/pengajuan_kompetensi/view/'.$id,' id="signupform" ');
	?>
	  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
		<div class="box-header with-border">
		  <h3 class="box-title">MULTIPLE SEARCH</h3>
		</div>
		  <div class="box-body">
				<div class="col-md-12">
					<div class="form-group">
					  <label> Ketik multiple pisahkan dengan spasi atau -  Contoh (00000 NAMA)</label>
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
           <h3 class="box-title">TABEL PENGAJUAN KOMPETENSI</h3>

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
					  <th style="vertical-align: middle; width: 5%;"></th>
					  <th style="vertical-align: middle; width: 5%;">ID</th>
					  <th style="vertical-align: middle;">Tanggal</th>
					  <th style="vertical-align: middle;">Nama Pegawai</th>
					  <th style="vertical-align: middle;">Kompetensi</th>
					  <th style="vertical-align: middle;">St Pengajuan</th>
					  <th style="vertical-align: middle;">Kabid</th>
					  <th style="vertical-align: middle;">ACC Kabid</th>
					  <th style="vertical-align: middle;">Asesor</th>
					  <th style="vertical-align: middle;">ACC Asesor</th>
					  <th style="vertical-align: middle;">Komite</th>
					  <th style="vertical-align: middle;">ACC Komite</th>
					  <th style="vertical-align: middle;">Direktur</th>
					  <th style="vertical-align: middle;">ACC Direktur</th>
					  <th style="vertical-align: middle;">Status SPK</th>
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
elseif ($page=="pengajuan_kompetensi_logbook")
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
		<a href="<?php echo $link_kembali;?>"
			class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
		</a>	||
		<a href="<?php echo $link_awal;?>"
			class="btn btn-info" > <i class="fa fa-file-o"></i> Pengajuan Kompetensi
		</a>
    </section>
    <section class="content">
	  <?php echo form_open_multipart('komite/pengajuan_kompetensi/logbook/'.$id,' id="signupform" '); ;
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
	      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> collapsed-box box-solid">
	        <div class="box-header with-border">
	           <h3 class="box-title">PROFIL</h3>

	          <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
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
	      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> collapsed-box box-solid">
	        <div class="box-header with-border">
	           <h3 class="box-title">DAFTAR KOMPETENSI</h3>
			          <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>	     
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
			<div class="col-md-8">
	      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> collapsed-box box-solid">
	        <div class="box-header with-border">
	           <h3 class="box-title">BERKAS DAN ETIK</h3>

	          <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
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
	      </div>	  
	    </div>	
			<div class="col-md-12">
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
				 						<th style="width:5%"></th>
				 						<th style="width:5%">IDL</th>
				 						<th style="width:5%">IDP</th>
									  <th>Tanggal</th>
									  <th>Jam</th>
									  <th>Kode</th>
									  <th>Nama Kewenangan</th>
									  <th>Jumlah</th>
									  <th>Karu</th>
									  <th>Kabid</th>
									  <th>Asesor</th>
									  <th>Komite</th>
									  <th>Direktur</th>
									  <th>Ditolak</th>
									</tr>
								</thead>
							</table>
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
elseif ($page=="pengajuan_kompetensi_bcp")
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
		</a>	||
		<a href="<?php echo $link_awal;?>"
			class="btn btn-info" > <i class="fa fa-file-o"></i> Pengajuan Kompetensi
		</a>
      </h1>
    </section>
    <section class="content">
	<?php echo form_open_multipart('developer/pengajuan_kompetensi/bcp/'.$id.'/'.$all.'/'.$first_date.'/'.$last_date,' id="signupform" '); ?>
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
					  <th style="width: 4%">PK</th>
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
elseif ($page=="lihat")
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
  //      input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <?php echo form_open_multipart('developer/lihat/view/'.$id.'/'.$id2.'/'.$id3.'/'.$id4,' id="signupform" '); ?>
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
              <div class="col-md-6">
                <div class="form-group">
                  <label>Opsi Tanggal</label>
                  <?php
                    input_pdselect2("id5",$all_kah,$id5);
                  ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Opsi Kategori</label>
                  <?php
                    input_pdselect2("id6",$kategori_kah,$id6);
                  ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Instansi</label>
                  <?php
                    input_pdselect2("id3",$ambil_data_unit,$id3);
                  ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Kategori</label>
                  <?php
                    input_pdselect2("id4",$ambil_sn_standar_mutu,$id4);
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
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th style="display:none;">ID</th>
            <th>Kategori</th>
            <th>Tanggal Laporan</th>            
            <th>Unit</th>                                 
            <th>Jabatan</th>                                 
            <th>Instansi</th>                                 
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
elseif ($page=="lihat_profil")
{
  $btnarray = array('green','blue','yellow','red','purple','navy','maroon','olive','aqua','light-blue','teal','lime','orange','fuchsia');
  $btnk = array_rand($btnarray);
  $btnv = $btnarray[$btnk];
?>
<style type="text/css">
.huruf-12 {
  font-family: Times New Roman;
  font-size: 12pt;
  line-height: 2;  
}
@media print {
a {
  color: black;
}
 a[href]:after {
    display: none;
    visibility: hidden;
 }
}
</style>
  <div class="content-wrapper">
    <section class="content-header"></section>
    <section class="invoice">
      <section class="content-header text-center">

      </section>
      <div class="row invoice-info">
        <div class="col-sm-12 huruf-12">
         <h3 style="font-weight:bold;text-align: center;"><?= $header_profil ?></h3>
        <h3 style="font-weight:bold;text-align: center;"><?= $sub_header_profil ?></h3>                 <br style="line-height:2">
<?php
if(!empty($sejarah))
$sejarah = strip_tags($sejarah); 
$sejarah = html_entity_decode($sejarah); 
 echo '<br style="line-height:1"><br style="line-height:1">'. $sejarah;

if(!empty($visi_misi))
$visi_misi = strip_tags($visi_misi); 
$visi_misi = html_entity_decode($visi_misi); 
 echo '<br style="line-height:1"><br style="line-height:1">'.  $visi_misi;

if(!empty($tujuan_fungsi))
$tujuan_fungsi = strip_tags($tujuan_fungsi); 
$tujuan_fungsi = html_entity_decode($tujuan_fungsi); 
 echo '<br style="line-height:1"><br style="line-height:1">'.  $tujuan_fungsi;

if(!empty($struktur_organisasi)){
   echo '<br style="line-height:1"><br style="line-height:1">';
?>
  <div class="timeline-item">            
    <h3 style="font-weight:bold;" class="timeline-header">STRUKTUR ORGANISASI</h3>
    <div class="timeline-body">
<?php
  $br_struktur = $this->m_sanitasi->ol_berkas_in($struktur_organisasi,'60');
  foreach($br_struktur as $rowbr_struktur){
?>
<a class="example-image-link" href="<?php echo base_url('assets/berkas/im/'.$rowbr_struktur['link_berkas']);?>" 
  data-lightbox="example-set" data-title="<?php echo $rowbr_struktur['no_berkas'].' - '.$rowbr_struktur['nama_berkas']; ?>">
  <img class="margin" src="<?php echo base_url('assets/berkas/im/'.$rowbr_struktur['link_berkas']);?>" style="width: 700px;" alt="Photo">
</a>
<?php
  }
?>
    </div>
  </div>
<?php
}

if(!empty($informasi_layanan))
$informasi_layanan = strip_tags($informasi_layanan); 
$informasi_layanan = html_entity_decode($informasi_layanan); 
 echo '<br style="line-height:1"><br style="line-height:1">'.  $informasi_layanan;

if(!empty($regulasi)){
   echo '<br style="line-height:1"><br style="line-height:1">';
?>
  <div class="timeline-item">     
    <h3 style="font-weight:bold;" class="timeline-header">REGULASI / BERKAS TERKAIT</h3>       
    <div class="timeline-body">
<?php  
  $br_regulasi = $this->m_sanitasi->ol_berkas_in($regulasi,'50');
  foreach($br_regulasi as $rowbr_regulasi){
?>
  <table class="table no-border">
      <tbody>
        <tr>
          <td style="width:4%;">&nbsp;</td>
          <td style="width:25%;">
              <?= $rowbr_regulasi['nama_berkas'] ?>
          </td>
          <td style="width:3%;text-align: center;">:</td>
          <td>
            <a href="<?php echo base_url('assets/berkas/im/'.$rowbr_regulasi['link_berkas']);?>" target="_blank">
              <?= $rowbr_regulasi['no_berkas'] ?>
            </a> 
          </td>
        </tr>
      </tbody>
  </table>
<?php
  }
?>
    </div>
  </div>
<?php
}
if(!empty($berkas_laporan)){
   echo '<br style="line-height:1"><br style="line-height:1">';
?>
  <div class="timeline-item">     
    <h3 style="font-weight:bold;" class="timeline-header">BERKAS</h3>       
    <div class="timeline-body">
<?php  
  $br_berkas_laporan = $this->m_sanitasi->ol_berkas_in($berkas_laporan,'50');
  foreach($br_berkas_laporan as $rowbr_berkas_laporan){
?>
  <table class="table no-border">
      <tbody>
        <tr>
          <td style="width:4%;">&nbsp;</td>
          <td style="width:25%;">
              <?= $rowbr_berkas_laporan['nama_berkas'] ?>
          </td>
          <td style="width:3%;text-align: center;">:</td>
          <td>
            <a href="<?php echo base_url('assets/berkas/im/'.$rowbr_berkas_laporan['link_berkas']);?>" target="_blank">
              <?= $rowbr_berkas_laporan['no_berkas'] ?>
            </a> 
          </td>
        </tr>
      </tbody>
  </table>
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
      <hr/>
      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
 <!--          <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
         <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
          </button>-->
          <a href="<?php echo base_url('developer/lihat/laporan/'.$id);?>" class="btn btn-primary pull-right" style="margin-right: 5px;">
            Laporan <i class="fa fa-share"></i>
          </a>
          <a href="<?php echo base_url('developer/lihat/galeri/'.$id);?>" class="btn btn-success pull-right" style="margin-right: 5px;">
            Galeri <i class="fa fa-image"></i>
          </a>          
        </div>
          <div class="col-xs-12">
            <hr>        
          <?php 
            foreach($ambil_sn_laporan_tabel as $rowambil_sn_laporan_tabel){
          ?>
          <div class="col-xs-6">
           <a href="<?php echo base_url('developer/lihat/tabel/'.$id.'/'.$rowambil_sn_laporan_tabel['barcode_laporan_tabel']);?>" class="btn btn-block btn-sm bg-<?php echo $btnarray[array_rand($btnarray)]; ?>" style="margin: 5px;"><i class="fa fa-line-chart"></i> <?= $rowambil_sn_laporan_tabel['judul_laporan_tabel'] ?>
            </a>
          </div>
          <?php
            }
          ?>
         </div>          
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
<?php
}
elseif ($page=="lihat_galeri")
{
  $btnarray = array('green','blue','yellow','red','purple','navy','maroon','olive','aqua','light-blue','teal','lime','orange','fuchsia');
  $btnk = array_rand($btnarray);
  $btnv = $btnarray[$btnk];
?>
<style type="text/css">
.huruf-12 {
  font-family: Times New Roman;
  font-size: 12pt;
  line-height: 2;  
}
* {
    margin: 0;
    padding: 0;
}
.imgbox {
    display: grid;
    height: 100%;
}
.center-fit {
    max-width: 100%;
    max-height: 100vh;
    margin: auto;
}
</style>
  <div class="content-wrapper">
    <section class="content-header"></section>
    <section class="invoice">

      <div class="row invoice-info">
        <div class="col-sm-12 huruf-12">
      <section class="text-center">
        <h3 style="font-weight:bold;">GALERI</h3>
      </section>
<?php
if(!empty($galeri_laporan)){
   echo '<br style="line-height:1">';
  $br_galeri_laporan = $this->m_sanitasi->ol_berkas_in($galeri_laporan,'60');
  foreach($br_galeri_laporan as $rowbr_galeri_laporan){
?>
<div class="col-md-12">
  <table class="table no-border">
      <tbody>
        <tr>
          <td style="vertical-align:middle;text-align: center;">
            <div class="imgbox">
<a class="example-image-link" href="<?php echo base_url('assets/berkas/im/'.$rowbr_galeri_laporan['link_berkas']);?>" 
  data-lightbox="example-set" data-title="<?php echo $rowbr_galeri_laporan['no_berkas'].' - '.$rowbr_galeri_laporan['nama_berkas']; ?>">
  <img class="center-fit" src="<?php echo base_url('assets/berkas/im/'.$rowbr_galeri_laporan['link_berkas']);?>" alt="Photo">
</a>
            </div>
          </td>
        </tr>
        <tr>
          <td style="vertical-align:top;text-align: center;"><?= $rowbr_galeri_laporan['nama_berkas'] ?></td>
        </tr>
      </tbody>
  </table>  
</div>

<?php
  }
}
?>
        </div>
      </div>
      <hr/>
      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
 <!--          <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
         <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
          </button>-->
          <a href="<?php echo base_url('developer/lihat/laporan/'.$id);?>" class="btn btn-primary pull-right" style="margin-right: 5px;">
            Laporan <i class="fa fa-share"></i>
          </a>
           <a href="<?php echo base_url('developer/lihat/profil/'.$id);?>" class="btn btn-warning pull-right" style="margin-right: 5px;"><i class="fa fa-reply"></i> Profil
            </a>
        </div>
          <div class="col-xs-12">
            <hr>        
          <?php 
            foreach($ambil_sn_laporan_tabel as $rowambil_sn_laporan_tabel){
          ?>
          <div class="col-xs-6">
           <a href="<?php echo base_url('developer/lihat/tabel/'.$id.'/'.$rowambil_sn_laporan_tabel['barcode_laporan_tabel']);?>" class="btn btn-block btn-sm bg-<?php echo $btnarray[array_rand($btnarray)]; ?>" style="margin: 5px;"><i class="fa fa-line-chart"></i> <?= $rowambil_sn_laporan_tabel['judul_laporan_tabel'] ?>
            </a>
          </div>
          <?php
            }
          ?>
         </div>          
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
<?php
}

elseif ($page=="lihat_laporan")
{
  $btnarray = array('green','blue','yellow','red','purple','navy','maroon','olive','aqua','light-blue','teal','lime','orange','fuchsia');
  $btnk = array_rand($btnarray);
  $btnv = $btnarray[$btnk];  
?>
<style type="text/css">
.huruf-12 {
  font-family: Times New Roman;
  font-size: 12pt;
  line-height: 2;  
}
</style>
  <div class="content-wrapper">
    <section class="content-header"></section>
    <section class="invoice">
<!--
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header text-center">
            AdminLTE, Inc.
            <small class="pull-right"></small>
          </h2>
        </div>
      </div>
-->
      <section class="content-header text-center">

      </section>

        <div class="row invoice-info">
          <div class="col-sm-12 huruf-12">
        <h3 style="font-weight:bold;text-align: center;"><?= $header_laporan ?></h3>
        <h3 style="font-weight:bold;text-align: center;"><?= $sub_header_laporan ?></h3>
                <br style="line-height:2">
            <table class="table no-border">
                <tbody>
                  <tr>
                    <td colspan="4" style="border-bottom: 0;border-top: 0;border-left: 0;border-right: 0;">
                      <p style="font-weight:bold;"><?= $sub_sub_header_laporan ?></p>
                    </td>
                  </tr>
                  <?php  
                    if(!empty($judul_laporan)){
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;width:4%;">&nbsp;</td>
                    <td style="width:25%;">Judul</td>
                    <td style="width:3%;text-align: center;">:</td>
                    <td><?= $judul_laporan ?></td>
                  </tr>
                  <?php  
                    }
                    if(!empty($dimensi_laporan)){
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td >Dimensi Mutu</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $dimensi_laporan ?></td>
                  </tr>
                  <?php  
                    }
                    if(!empty($tujuan_laporan)){
                      $tujuan_laporan = strip_tags($tujuan_laporan); 
                      $tujuan_laporan = html_entity_decode($tujuan_laporan);
                  ?>    
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Tujuan</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $tujuan_laporan ?></td>
                  </tr>
                  <?php  
                    }
                    if(!empty($definisi_laporan)){
                      $definisi_laporan = strip_tags($definisi_laporan); 
                      $definisi_laporan = html_entity_decode($definisi_laporan);
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Definisi Operasional</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $definisi_laporan ?></td>
                  </tr>
                  <?php  
                    }
                    if(!empty($dasar_laporan)){
                      $dasar_laporan = strip_tags($dasar_laporan); 
                      $dasar_laporan = html_entity_decode($dasar_laporan);
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Dasar Pemikiran</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $dasar_laporan ?></td>
                  </tr>
                  <?php  
                    }
                    if(!empty($frekuensi_laporan)){
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Frekuensi Pengumpulan Data</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $frekuensi_laporan ?></td>
                  </tr>
                  <?php  
                    }
                    if(!empty($periode_laporan)){
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Periode Analisis dan Pelaporan Data</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $periode_laporan ?></td>
                  </tr>
                  <?php  
                    }
                    if(!empty($numerator_laporan)){
                      $numerator_laporan = strip_tags($numerator_laporan); 
                      $numerator_laporan = html_entity_decode($numerator_laporan); 
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Numerator</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $numerator_laporan ?></ul>
                  </tr>
                  <?php  
                    }
                    if(!empty($denominator_laporan)){
                      $denominator_laporan = strip_tags($denominator_laporan); 
                      $denominator_laporan = html_entity_decode($denominator_laporan); 
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Denomerator</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $denominator_laporan ?></td>
                  </tr>
                  <?php  
                    }
                    if(!empty($sumber_laporan)){
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Sumber Data</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $sumber_laporan ?></td>
                  </tr>
                  <?php  
                    }
                    if(!empty($standar_laporan)){
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Metode Pengumpulan Data</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $standar_laporan ?></td>
                  </tr>
                  <?php  
                    }
                    if(!empty($teknis_laporan)){
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Teknis Pengambilan Data</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $teknis_laporan ?></td>
                  </tr>     
                  <?php  
                    }
                    if(!empty($tgjawab_laporan)){
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Penanggung Jawab</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $tgjawab_laporan ?></td>
                  </tr>     
                  <?php  
                    }
                    if(!empty($jenis_laporan)){
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Jenis Indikator</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $jenis_laporan ?></td>
                  </tr>     
                  <?php  
                    }
                    if(!empty($satuan_laporan)){
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Satuan Pengukuran</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $satuan_laporan ?></td>
                  </tr>     
                  <?php  
                    }
                    if(!empty($kriteria_laporan)){
                      $kriteria_laporan = strip_tags($kriteria_laporan); 
                      $kriteria_laporan = html_entity_decode($kriteria_laporan);
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Kriteria</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $kriteria_laporan ?></td>
                  </tr>     
                  <?php  
                    }
                    if(!empty($formula_laporan)){
                      $formula_laporan = strip_tags($formula_laporan); 
                      $formula_laporan = html_entity_decode($formula_laporan);
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Formula</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $formula_laporan ?></td>
                  </tr>     
                  <?php  
                    }
                    if(!empty($metode_laporan)){
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Metode Pengumpulan Data</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $metode_laporan ?></td>
                  </tr>     
                  <?php  
                    }
                    if(!empty($sampel_laporan)){
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Besar Sampel</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $sampel_laporan ?></td>
                  </tr>     
                  <?php  
                    }
                    if(!empty($penyajian_laporan)){
                      $penyajian_laporan = strip_tags($penyajian_laporan); 
                      $penyajian_laporan = html_entity_decode($penyajian_laporan);
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Penyajian Data</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $penyajian_laporan ?></td>
                  </tr>     
                  <?php  
                    }
                    if(!empty($id_jabatan)){
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Pengumpul Data</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $nama_jabatan ?></td>
                  </tr>
                  <?php  
                    }
                  ?>
                </tbody>
            </table>
          </div>
        </div>
        <hr/>
        <!-- this row will not appear when printing -->
        <div class="row no-print">
          <div class="col-xs-12">
   <!--          <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>-->
               <a href="<?php echo base_url('developer/lihat/laporan/'.$id);?>" class="btn btn-primary pull-right">
              Laporan <i class="fa fa-share"></i>
            </a>
           <a href="<?php echo base_url('developer/lihat/profil/'.$id);?>" class="btn btn-warning pull-right" style="margin-right: 5px;"><i class="fa fa-reply"></i> Profil
            </a>
          <a href="<?php echo base_url('developer/lihat/galeri/'.$id);?>" class="btn btn-success pull-right" style="margin-right: 5px;">
            Galeri <i class="fa fa-image"></i>
          </a>   
          </div>
          <div class="col-xs-12">
            <hr>          
          <?php 
            foreach($ambil_sn_laporan_tabel as $rowambil_sn_laporan_tabel){
          ?>
          <div class="col-xs-6">
           <a href="<?php echo base_url('developer/lihat/tabel/'.$id.'/'.$rowambil_sn_laporan_tabel['barcode_laporan_tabel']);?>" class="btn btn-block btn-sm bg-<?php echo $btnarray[array_rand($btnarray)]; ?>" style="margin: 5px;"><i class="fa fa-line-chart"></i> <?= $rowambil_sn_laporan_tabel['judul_laporan_tabel'] ?>
            </a>
          </div>
          <?php
            }
          ?>
          </div>          
        </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
<?php
}
elseif ($page=="lihat_tabel")
{
  $btnarray = array('green','blue','yellow','red','purple','navy','maroon','olive','aqua','light-blue','teal','lime','orange','fuchsia');
  $btnk = array_rand($btnarray);
  $btnv = $btnarray[$btnk];
?>
<style type="text/css">
.huruf-12 {
  font-family: Times New Roman;
  font-size: 12pt;
  line-height: 2;  
}
#chartdiv {
  width: 100%;
  height: 500px;
}
td, th {
  padding-top:5px;
  padding-bottom:5px;
  padding-right:10px;   
  padding-left:10px;   
}
@media print {
a {
  color: black;
}
 a[href]:after {
    display: none;
    visibility: hidden;
 }
}
</style>
  <div class="content-wrapper">
    <section class="content-header"></section>
    <section class="invoice">
      <section class="content-header">
        
      </section>
        
        <div class="row invoice-info">
          <div class="col-sm-12 huruf-12">
            <h4 style="font-weight:bold;"><?= $judul_laporan_tabel ?></h4><br style="line-height:2">
            <table style="width:100%;" class="table-bordered">
                <thead>
                  <tr>
                  <?php  
                    if($jumlah_record_tabel_limbah_detil > 0){
                  ?>
                    <th style="background-color:lightgray;vertical-align:middle;text-align: center;" rowspan="2">Sumber Pengukuran</th>
                  <?php  
                    }
                  ?>
                  <?php  
                    if($jumlah_record_tps > 0){
                  ?>
                    <th style="background-color:lightgray;vertical-align:middle;text-align: center;" rowspan="2">TPS</th>
                  <?php  
                    }
                    $cols = $jumlah_bulan * 2;
                  ?>
                    <th style="background-color:lightgray;vertical-align:middle;text-align: center;" rowspan="2">Parameter</th>
                  <?php 
                  	if($jumlah_record_standar_mutu > 0){
                  ?>
                    <th style="background-color:lightgray;vertical-align:middle;text-align: center;" rowspan="2">Baku Mutu</th>
                  <?php 
                  	}
                  ?>
                    <th style="background-color:lightgray;vertical-align:middle;text-align: center;" rowspan="2">Satuan</th>
                    <th style="background-color:lightgray;vertical-align:middle;text-align: center;" colspan="<?= $cols ?>">Realisasi Bulan</th>
                  </tr>
                  <tr>
                    <?php  
                      foreach ($only_blnyear_lhu as $rowonly_blnyear_lhu){
                    ?>
                   <th style="background-color:lightgray;vertical-align:middle;text-align: center;"><?php echo $this->m_rancak->getsemiBulan($rowonly_blnyear_lhu['buln']); ?></th>
                   <?php  
                    }
                   ?>
                  </tr>
                </thead>
                <tbody>
                  <?php  foreach($tabel_limbah_detil as $rowtabel_limbah_detil){
                  ?>
                  <tr>
                    <?php  
                      if($jumlah_record_tabel_limbah_detil > 0){
                    ?>
                    <td><?= $rowtabel_limbah_detil['nama_sumber_emisi'] ?></td>
                    <?php  
                      }
                    ?>
                    <?php  
                      if($jumlah_record_tps > 0){
                    ?>
                    <td><?= $rowtabel_limbah_detil['nama_tps'] ?></td>
                    <?php  
                      }
                    ?>
                    <td><?= $rowtabel_limbah_detil['nama_limbah'] ?></td>
                  <?php 
                  	if($jumlah_record_standar_mutu > 0){
                  ?>
                    <td class="text-right"><?= ROUND($rowtabel_limbah_detil['standar_mutu'],3) ?> <?php if($rowtabel_limbah_detil['range_mutu'] > 0){ echo ' s.d '.ROUND($rowtabel_limbah_detil['range_mutu'],3); } ?></td>
                  <?php 
                  	}
                  ?>
                    <td><?= $rowtabel_limbah_detil['satuan_limbah'] ?></td>
                      <?php  
                        foreach ($only_blnyear_lhu as $rowonly_blnyear_lhu){
                          $tabel_detil = $this->m_developer->tabel_detil($id2,$rowtabel_limbah_detil['id_limbah'],$rowonly_blnyear_lhu['blnyear'],$min_tanggal,$max_tanggal,$rowtabel_limbah_detil['id_sumber_emisi']);
                          foreach($tabel_detil as $rowtabel_detil){
                      ?>
                     <td style="vertical-align:middle;text-align: center;"><?= round($rowtabel_detil['hasil_lhu_detil'],3) ?></td>
                     <?php  
                          }
                      }
                     ?>
                  </tr> 
                  <?php } ?>                 
                </tbody>
            </table>
          </div>
        </div>
        <br style="line-height:4">
            <?php  
            if($grafik > 1){
            ?>
            <div class="box box-default box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
              <div class="box-body">
                <div id="chartdiv"></div>
                <div id="legenddiv"></div>          
              </div>
            </div>
            <?php
            }
            ?>
        <hr/> 
        <div class="col-sm-12 huruf-12">     
<?php 
if(!empty($analisa_laporan_tabel))
$analisa_laporan_tabel = strip_tags($analisa_laporan_tabel); 
//$analisa_laporan_tabel = html_entity_decode($analisa_laporan_tabel); 
/*$analisa_laporan_tabel = htmlentities($analisa_laporan_tabel); 
$analisa_laporan_tabel = preg_replace('/<span[^>]+\>|<\/span>/i', '', $analisa_laporan_tabel);
$analisa_laporan_tabel = htmlspecialchars_decode($analisa_laporan_tabel, ENT_QUOTES);
$analisa_laporan_tabel = strip_tags($analisa_laporan_tabel);*/
$analisa_laporan_tabel = htmlspecialchars_decode($analisa_laporan_tabel);  
 echo '<br style="line-height:1"><br style="line-height:2">'.  $analisa_laporan_tabel;

if(!empty($rekomendasi_laporan_tabel))
$rekomendasi_laporan_tabel = strip_tags($rekomendasi_laporan_tabel); 
/*$rekomendasi_laporan_tabel = html_entity_decode($rekomendasi_laporan_tabel); 
$rekomendasi_laporan_tabel = htmlentities($rekomendasi_laporan_tabel); */
$rekomendasi_laporan_tabel = htmlspecialchars_decode($rekomendasi_laporan_tabel);  
 echo '<br style="line-height:1"><br style="line-height:2">'.  $rekomendasi_laporan_tabel;
?>
        </div>
        <?php 
          if($count_berkas_lhu > 0){
        ?>
        <div class="col-sm-12"> 
<br style="line-height:1"><br style="line-height:4">
  <div class="timeline-item">     
    <h4 style="font-weight:bold;" class="timeline-header">BERKAS HASIL PENGUJIAN</h4>       
    <div class="timeline-body">
<?php  
  foreach($ambil_berkas_lhu as $rowambil_berkas_lhu){
?>
  <table style="width:100%;" class="table table-border">
    <thead>
      <tr>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="width:4%;">&nbsp;</td>
        <td>
            <?= date('d-m-Y', strtotime($rowambil_berkas_lhu['tgl_lhu'])) ?>
        </td>
        <td><?= $rowambil_berkas_lhu['deskripsi_lhu'] ?></td>
        <td style="text-align:center;">
          <a href="<?php echo base_url('assets/berkas/sanitasi/'.$rowambil_berkas_lhu['link_lhu']);?>" target="_blank">
            <?= $rowambil_berkas_lhu['no_lhu'] ?>
          </a> 
        </td>
      </tr>
    </tbody>
  </table>
<?php
  }
?>
    </div>
  </div>
        </div>
        <?php 
          }
        ?>
        <div class="row no-print">
          <div class="col-xs-12">
   <!--          <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>-->
               <a href="<?php echo base_url('developer/lihat/laporan/'.$id);?>" class="btn btn-primary pull-right">
              Laporan <i class="fa fa-share"></i>
            </a>
           <a href="<?php echo base_url('developer/lihat/profil/'.$id);?>" class="btn btn-success pull-right" style="margin-right: 5px;"><i class="fa fa-reply"></i> Profil
            </a>
          </div>
          <div class="col-xs-12">
            <hr>          
          <?php 
            foreach($ambil_sn_laporan_tabel as $rowambil_sn_laporan_tabel){
          ?>
          <div class="col-xs-6">
           <a href="<?php echo base_url('developer/lihat/tabel/'.$id.'/'.$rowambil_sn_laporan_tabel['barcode_laporan_tabel']);?>" class="btn btn-block btn-sm bg-<?php echo $btnarray[array_rand($btnarray)]; ?>" style="margin: 5px;"><i class="fa fa-line-chart"></i> <?= $rowambil_sn_laporan_tabel['judul_laporan_tabel'] ?>
            </a>
          </div>
          <?php
            }
          ?>
          </div>          
        </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div> 
<?php 
}