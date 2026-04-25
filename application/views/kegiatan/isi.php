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
elseif ($page=="pemulihan")
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
					  <th style="width:5%">ID</th>
					  <th style="text-align:left;vertical-align:middle;font-weight:bold;">Mulai</th>
					  <th style="text-align:left;vertical-align:middle;font-weight:bold;">Akhir</th>
					  <th style="text-align:left;vertical-align:middle;font-weight:bold;">Nama</th>
					  <th style="text-align:left;vertical-align:middle;font-weight:bold;">Tempat Kegiatan Pemulihan</th>
					  <th style="text-align:left;vertical-align:middle;font-weight:bold;">V Komite</th>
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
elseif ($page=="pemulihan_tambah")
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
elseif ($page=="pemulihan_isi")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('kegiatan/pemulihan/simpan_isi');?>" onClick="return cek();">
       <input type="hidden" name="id_logbook_pemulihan" value="<?= $id; ?>">
       <input type="hidden" name="result_pemulihan" value="<?= $result_pemulihan; ?>">
	   <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
		<div class="box-body">
			<div class="row">
				<div class="col-md-7">
							<div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
								<div class="box-header with-border">
									 <h3 class="box-title">PILIH KEWENANGAN TERTOLAK</h3>

									<div class="box-tools pull-right">

									</div>
								</div>
								<div class="box-body">
									<div class="box-body table-responsive no-padding">
										<table class="table table-hover">
										<tbody>
											<?php
											foreach($ambil_kewenangan_lobook_pemulihan_detil as $row2){
											?>
										<tr>
											<td style="vertical-align:middle;">
												<div class="checkbox">
												<label>
													<input type="checkbox" class="child" name="chk[]" value="<?php echo $row2['id_kewenangan'];?>">
												</label>
												</div>
											</td>
											<td style="vertical-align:middle;"><?php echo $row2['nama_kewenangan']; ?></td>
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
				<div class="col-md-5">
					<div class="col-md-12">
						<label>Tanggal</label><p>
						<?php
							input_calendar("tgl_kegiatan_pemulihan","tgl_kegiatan_pemulihan",$tgl_kegiatan_pemulihan,"readonly","required");
						?></p>
					</div>
					<div class="col-md-12">
							<label>Penguji</label>
							<?php
								input_pdselect2("id_penguji",$cmd_pegawai,$id_penguji);
							?>
					</div>
					<div class="col-md-12">
						<label>RM</label>
						<?php
							input_text("rm_kegiatan_pemulihan",$rm_kegiatan_pemulihan,"maxlength='255' ","Masukkan RM","text");
						?>
					</div>
				</div>
			 </div>
        <div class="box-footer">
			<button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
	  </FORM>
<script type="text/javascript">
$('#tgl_kegiatan_pemulihan').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_kegiatan_pemulihan").inputmask("datetime", {
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
elseif ($page=="pemulihan_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('kegiatan/pemulihan/simpan_edit');?>" onClick="return cek();">
       <input type="hidden" name="id_logbook_pemulihan" value="<?= $id; ?>">
       <input type="hidden" name="id_kegiatan_pemulihan" value="<?= $idhp; ?>">
       <input type="hidden" name="id_kewenangan" value="<?= $id_kewenangan; ?>">
       <input type="hidden" name="tgl_kegiatan_pemulihan_lama" value="<?= $tgl_kegiatan_pemulihan; ?>">
			 <input type="hidden" name="result_pemulihan" value="<?= $result_pemulihan; ?>">
	   <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
		<div class="box-body">
			<div class="row">
				<div class="col-md-12">
					<label>Tanggal</label><p>
					<?php
						input_calendar("tgl_kegiatan_pemulihan","tgl_kegiatan_pemulihan",$tgl_kegiatan_pemulihan,"readonly","required");
					?></p>
				</div>
					<div class="col-md-12">
							<label>Penguji</label>
							<?php
								input_pdselect2("id_penguji",$cmd_pegawai,$id_penguji);
							?>
					</div>
					<div class="col-md-12">
						<label>RM</label>
						<?php
							input_text("rm_kegiatan_pemulihan",$rm_kegiatan_pemulihan,"maxlength='255' ","Masukkan RM","text");
						?>
					</div>
					<div class="col-md-12">
							<label>Result / Hasil</label>
							<?php
								input_pdselect2("result_kegiatan_pemulihan",$cmd_kompeten,$result_kegiatan_pemulihan);
							?>
					</div>
					<div class="col-md-12">
						<label>Catatan</label>
						<?php
							input_text("catatan_kegiatan_pemulihan",$catatan_kegiatan_pemulihan,"maxlength='255' ","Masukkan Catatan","text");
						?>
					</div>
			 </div>
        <div class="box-footer">
			<button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
      </div>
	  </FORM>
<script type="text/javascript">
$('#tgl_kegiatan_pemulihan').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_kegiatan_pemulihan").inputmask("datetime", {
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
