<?php
//=================================== H O M E ================================================
$arraybox = array('warning','success','info','danger');
$arraybg = array('navy','yellow','maroon','olive','purple','red','aqua','light-blue','blue',
					'green','teal','lime','orange','fuchsia');
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
elseif ($page=="daftar")
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
	<?php echo form_open_multipart('pemulihan/daftar/view/'.$id,' id="signupform" '); ?>
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
					  <th style="width:5%"></th>
					  <th style="display:none;width:5%"></th>
					  <th style="text-align:center;vertical-align:middle;font-weight:bold;">Tanggal</th>
					  <th style="text-align:center;vertical-align:middle;font-weight:bold;">Nama</th>
					  <th style="text-align:center;vertical-align:middle;font-weight:bold;">Kewenangan</th>
						<th style="text-align:center;vertical-align:middle;font-weight:bold;width:5%;">Karu</th>
						<th style="text-align:center;vertical-align:middle;font-weight:bold;width:5%;">Kabid</th>
						<th style="text-align:center;vertical-align:middle;font-weight:bold;width:5%;">Asesor</th>
						<th style="text-align:center;vertical-align:middle;font-weight:bold;width:5%;">Komite</th>
						<th style="text-align:center;vertical-align:middle;font-weight:bold;width:5%;">Direktur</th>
						<th style="text-align:center;vertical-align:middle;font-weight:bold;width:5%;">Tolak</th>
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
elseif ($page=="daftar_pendaftaran")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('pemulihan/daftar/simpan_pendaftaran');?>" onClick="return cek();">
       <input type="hidden" name="id_pegawai" value="<?= $id; ?>">
       <input type="hidden" name="id_unit_pegawai" value="<?= $id_unit_pegawai; ?>">
       <input type="hidden" name="id_pengirim" value="<?= $member_id; ?>">
       <input type="hidden" name="id_unit_pengirim" value="<?= $room_id; ?>">
	   <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
		<div class="box-body">
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">SILAHKAN PILIH PENANGGUNG JAWAB DAN RUANGAN</h3>
			</div>
			  <div class="box-body">
					<div class="row">
						<div class="col-md-6">
							<label>Tanggal Mulai</label><p>
							<?php
								input_calendar("tgl_awal","tgl_awal",$tgl_awal,"","required");
							?></p>
						</div>
						<div class="col-md-6">
							<label>Tanggal Selesai</label><p>
							<?php
								input_calendar("tgl_akhir","tgl_akhir",$tgl_akhir,"","required");
							?></p>
						</div>
						<div class="col-md-12">
							  <label>Penanggung Jawab</label>
								<?php
									input_pdselect2("id_pemulihan",$cmd_pegawai,$id_pemulihan);
								?>
						</div>
						<div class="col-md-12">
							  <label>Ruangan Kegiatan Pemulihan</label>
								<?php
									input_pdselect2("id_unit_pemulihan",$cmd_data_ruangan,$id_unit_pemulihan);
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
$(document).ready(function() {
	$('.select2').select2()
});
</script>
<?php
}
elseif ($page=="kegiatan")
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
	<?php echo form_open_multipart('pemulihan/kegiatan/view/'.$id,' id="signupform" '); ?>
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
					  <th style="width:5%">ID</th>
					  <th style="text-align:left;vertical-align:middle;font-weight:bold;">Mulai</th>
					  <th style="text-align:left;vertical-align:middle;font-weight:bold;">Akhir</th>
					  <th style="text-align:left;vertical-align:middle;font-weight:bold;">Nama</th>
					  <th style="text-align:left;vertical-align:middle;font-weight:bold;">Tempat Kegiatan Pemulihan</th>
					  <th style="text-align:left;vertical-align:middle;font-weight:bold;">Result</th>
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
elseif ($page=="kegiatan_edit")
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
           <h3 class="box-title">EDIT DATA</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
		<?php echo form_open_multipart('pemulihan/kegiatan/edit/'.$id,' ');
		input_text("id_logbook_pemulihan",$id,"","","hidden");
		input_text("result_pemulihan",$result_pemulihan,"","","hidden");
		?>
        <div class="box-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Tanggal Mulai</label>
								<?php
									input_calendar("tgl_awal","tgl_awal",$tgl_awal,"","required");
								?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Tanggal Selesai</label>
								<?php
									input_calendar("tgl_akhir","tgl_akhir",$tgl_akhir,"","required");
								?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Penanggung Jawab</label>
								<?php
									input_pdselect2("id_pemulihan",$cmd_pegawai,$id_pemulihan);
								?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Ruangan Kegiatan Pemulihan</label>
								<?php
									input_pdselect2("id_unit_pemulihan",$cmd_data_ruangan,$id_unit_pemulihan);
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
					  <th style="width:5%"></th>
					  <th style="width:5%">ID</th>
					  <th>Tanggal</th>
					  <th>Kewenangan</th>
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
elseif ($page=="kegiatan_tambah")
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
	<?php echo form_open_multipart('pemulihan/kegiatan/tambah/'.$id,' id="signupform" ');
	input_text("id_logbook_pemulihan",$id,"","","hidden");
	input_text("result_pemulihan",$result_pemulihan,"","","hidden");
	?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">PILIH KEWENANGAN TERTOLAK</h3>

          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
		  <table id="example1" width="100%" class="table table-bordered table-striped">
			  <thead>
				<tr>
					<th style="width:3%;background-color:#9b0e27;color:white;vertical-align:middle;">
						<input name="select_all" class="checkall" type="checkbox" />
					</th>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;width:5%;">ID</th>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;width:10%;">Tanggal</th>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kewenangan</th>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;width:10%;">V Karu</th>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;width:10%;">V Kabid</th>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;width:10%;">V Asesor</th>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;width:10%;">V Komite</th>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;width:10%;">V Direktur</th>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;width:10%;">Tolak</th>
				</tr>
			  </thead>
			  <tbody>
					<?php
					foreach($ambil_lobook_perorang as $row){
					?>
				<tr>
					<td style="vertical-align:middle;">
					  <div class="checkbox">
						<label>
						  <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_logbook'];?>">
						</label>
					  </div>
					</td>
					<td style="vertical-align:middle;"><?php echo $row['id_logbook']; ?></td>
					<td style="vertical-align:middle;"><?php echo date('d-m-Y', strtotime($row['tgl_logbook'])); ?></td>
					<td style="vertical-align:middle;"><?php echo $row['nama_kewenangan']; ?></td>
					<td style="vertical-align:middle;">
						<?php
							if($row['v_karu'] == 0){
								echo'<button class="btn btn-xs btn-default">Proses</button>';
							}elseif($row['v_karu'] == 1){
								echo'<button class="btn btn-xs btn-success">Kompeten</button>';
							}else{
								echo'<button class="btn btn-xs btn-danger">Tidak Kompeten</button>';
							}
						?>
					</td>
					<td style="vertical-align:middle;">
						<?php
							if($row['v_kabid'] == 0){
								echo'<button class="btn btn-xs btn-default">Proses</button>';
							}elseif($row['v_kabid'] == 1){
								echo'<button class="btn btn-xs btn-success">Kompeten</button>';
							}else{
								echo'<button class="btn btn-xs btn-danger">Tidak Kompeten</button>';
							}
						?>
					</td>
					<td style="vertical-align:middle;">
						<?php
							if($row['v_asesor'] == 0){
								echo'<button class="btn btn-xs btn-default">Proses</button>';
							}elseif($row['v_asesor'] == 1){
								echo'<button class="btn btn-xs btn-success">Kompeten</button>';
							}else{
								echo'<button class="btn btn-xs btn-danger">Tidak Kompeten</button>';
							}
						?>
					</td>
					<td style="vertical-align:middle;">
						<?php
							if($row['v_komite'] == 0){
								echo'<button class="btn btn-xs btn-default">Proses</button>';
							}elseif($row['v_komite'] == 1){
								echo'<button class="btn btn-xs btn-success">Kompeten</button>';
							}else{
								echo'<button class="btn btn-xs btn-danger">Tidak Kompeten</button>';
							}
						?>
					</td>
					<td style="vertical-align:middle;">
						<?php
							if($row['v_direktur'] == 0){
								echo'<button class="btn btn-xs btn-default">Proses</button>';
							}elseif($row['v_direktur'] == 1){
								echo'<button class="btn btn-xs btn-success">Kompeten</button>';
							}else{
								echo'<button class="btn btn-xs btn-danger">Tidak Kompeten</button>';
							}
						?>
					</td>
					<td style="vertical-align:middle;">
						<?php
							if($row['result_tolak'] == 1){
								echo'<button class="btn btn-xs btn-danger">Supervisi</button>';
							}elseif($row['result_tolak'] == 2){
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
elseif ($page=="kegiatan_hasil")
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
			<div class="row">
				<div class="col-md-12">
				      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
				        <div class="box-header with-border">
				           <h3 class="box-title">LOGBOOK TERTOLAK SEBELUM KEGIATAN</h3>

				          <div class="box-tools pull-right">

				          </div>
				        </div>
				        <div class="box-body">
						  <table id="example1" width="100%" class="table table-bordered table-striped">
							  <thead>
								<tr>
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;width:5%;">ID</th>
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;width:10%;">Tanggal</th>
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kewenangan</th>
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;width:10%;">V Karu</th>
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;width:10%;">V Kabid</th>
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;width:10%;">V Asesor</th>
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;width:10%;">V Komite</th>
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;width:10%;">V Direktur</th>
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;width:10%;">Tolak</th>
								</tr>
							  </thead>
							  <tbody>
									<?php
									foreach($ambil_lobook_pemulihan_detil as $row){
									?>
								<tr>
									<td style="vertical-align:middle;"><?php echo $row['id_logbook']; ?></td>
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
							  </tbody>
						  </table>
				        </div>
				      </div>
				</div>
				<div class="col-md-12">
					<?php echo form_open_multipart('pemulihan/kegiatan/hasil/'.$id,' id="signupform" ');
					input_text("id_logbook_pemulihan",$id,"","","hidden");
					input_text("jml_hasil_kegiatan",$jml_hasil_kegiatan,"","","hidden");
					?>
					<div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
		         <div class="box-header with-border">
		             <h3 class="box-title">SILAHKAN CEK HASIL KEGIATAN KEMUDIAN VALIDASI HASILNYA</h3>

		           <div class="box-tools pull-right">

		           </div>
		         </div>
		 		<div class="box-body">
		 			<div class="row">
		 					<div class="col-md-6">
		 							<label>Result / Hasil</label>
		 							<?php
		 								input_pdselect2("result_pemulihan",$cmd_kompeten,$result_pemulihan);
		 							?>
		 					</div>
		 					<div class="col-md-6">
		 						<label>Catatan</label>
		 						<?php
		 							input_text("catatan_pemulihan",$catatan_pemulihan,"maxlength='255' ","Masukkan Catatan","text");
		 						?>
		 					</div>
		 			 </div>
		         <div class="box-footer">
		         	<?php
		         	if($jml_hasil_kegiatan == 0){
		         	?>
		 						<button type="submit" disabled class="btn btn-primary">Submit</button>
		 					<?php
		         	}else{
		         	?>
		         		<button type="submit" class="btn btn-primary">Submit</button>
		         	<?php
		         	}
		         	?>
		         </div>
		       </div>
		       </div>
					 <?php echo form_close(); ?>
				      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
				        <div class="box-header with-border">
				           <h3 class="box-title">HASIL KEGIATAN</h3>

				          <div class="box-tools pull-right">

				          </div>
				        </div>
				        <div class="box-body">
									<table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
										<thead>
											<tr>
											  <th style="width:5%">ID</th>
											  <th style="text-align:left;vertical-align:middle;font-weight:bold;">Tanggal</th>
											  <th style="text-align:left;vertical-align:middle;font-weight:bold;">Kewenangan</th>
											  <th style="text-align:left;vertical-align:middle;font-weight:bold;">Penguji</th>
											  <th style="text-align:left;vertical-align:middle;font-weight:bold;">RM</th>
											  <th style="text-align:left;vertical-align:middle;font-weight:bold;">Catatan</th>
											  <th style="text-align:left;vertical-align:middle;font-weight:bold;">Result</th>
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
