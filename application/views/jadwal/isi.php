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
elseif ($page=="elemen")
{
?>
<style media="screen">
table.dataTable tbody tr.selected {
  background-color: #0088cc !important;
  color: white !important;
  border: 1px solid #2083eb;
}
</style>
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
					  <th style="display:none;"></th>
					  <th>Nama Dinas</th>
					  <th>Warna</th>
					  <th>Text</th>
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
elseif ($page=="elemen_tambah")
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
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('jadwal/elemen/simpan_tambah');?>" onClick="return cek();">
          <input type="hidden" name="id_unit" value="<?= $id_unit; ?>">
		  <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
				<div class="col-md-12">
					<div class="form-group">
					  <label>Huruf Elemen misal P, S, M</label>
						<?php
							input_text("nama_dinas_jaga",$nama_dinas_jaga,"maxlength='5' required","Masukkan Nama","text");
						?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label>Jumlah Jam Dinas</label>
						<?php
							input_textcustom("jml_dinas_jaga",$jml_dinas_jaga," style='text-align:right;' required
										onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
												"Jumlah Jam Dinas","text");
						?>
					</div>
				</div>
					<div class="col-sm-12">
						<div class="form-group">
						  <label>Warna Background</label>
							<select  name="id_warna" required class="form-control s1">
							<option value="0" selected disabled hidden>Pilih Background</option>
							<?php
								foreach($cmd_kol_warna as $rowback){
							?>
								<option value="<?php echo $rowback['id_warna']; ?>" required style="background-color:<?php echo $rowback['kode_warna']; ?>;" warna="<?php echo $rowback['kode_warna']; ?>">
									<?php echo $rowback['nama_warna']; ?>
								</option>
							<?php
								}
							?>
							</select>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group">
						  <label>Warna Text</label>
							<select name="id_text" required class="form-control s2">
							<option value="0" selected disabled hidden>Pilih Text</option>
							<?php
								foreach($cmd_kol_warna as $rowtext){
							?>
								<option value="<?php echo $rowtext['id_warna']; ?>" required style="color:<?php echo $rowtext['kode_warna']; ?>;" warna2="<?php echo $rowtext['kode_warna']; ?>">
									<?php echo $rowtext['nama_warna']; ?>
								</option>
							<?php
								}
							?>
							</select>
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
		setColor1();
		setColor2();
		  $('select.s1').change(function(){
				setColor1();
		 });
		  $('select.s2').change(function(){
				setColor2();
		 });
	});
	function setColor1()
	{
		var color =  $('select.s1').find('option:selected').attr('warna');
		$('select.s1').css('background', color);
		$('select.s1').css('color', 'black');
	}
	function setColor2()
	{
		var color =  $('select.s2').find('option:selected').attr('warna2');
		$('select.s2').css('background', 'white');
		$('select.s2').css('color', color);
	}
</script>
<?php
}
elseif ($page=="elemen_edit")
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
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('jadwal/elemen/simpan_edit');?>" onClick="return cek();">
		<input type="hidden" name="id_dinas_jaga" value="<?= $id; ?>">
		<input type="hidden" name="id_unit" value="<?= $id_unit; ?>">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
				<div class="col-md-12">
					<div class="form-group">
					  <label>Huruf Elemen misal P, S, M</label>
						<?php
							input_text("nama_dinas_jaga",$nama_dinas_jaga,"maxlength='5' required","Masukkan Nama","text");
						?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label>Jumlah Jam Dinas</label>
						<?php
							input_textcustom("jml_dinas_jaga",$jml_dinas_jaga," style='text-align:right;' required
										onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
												"Jumlah Jam Dinas","text");
						?>
					</div>
				</div>
					<div class="col-sm-12">
						<div class="form-group">
						  <label>Warna Background</label>
							<select  name="id_warna" required class="form-control s1">
							<option value="" disabled hidden>Pilih Background</option>
							<?php
								foreach($cmd_kol_warna as $rowback){
									$selected = ($val == $row1['name'] ? 'selected="selected"' : '');
							?>
								<option value="<?php echo $rowback['id_warna']; ?>" required style="background-color:<?php echo $rowback['kode_warna']; ?>;" warna="<?php echo $rowback['kode_warna']; ?>" <?php echo ($rowback['id_warna'] == $id_warna) ? 'selected="selected"' : ''; ?> >
									<?php echo $rowback['nama_warna']; ?>
								</option>
							<?php
								}
							?>
							</select>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group">
						  <label>Warna Text</label>
							<select name="id_text" required class="form-control s2">
							<option value="" disabled hidden>Pilih Text</option>
							<?php
								foreach($cmd_kol_warna as $rowtext){
									if($rowtext[$id_warna] == $id_text){ $terpilih2 = 'selected'; } else{ $terpilih2 = ''; }
							?>
								<option value="<?php echo $rowtext['id_warna']; ?>" required style="color:<?php echo $rowtext['kode_warna']; ?>;" warna2="<?php echo $rowtext['kode_warna']; ?>" <?php echo ($rowtext['id_warna'] == $id_text) ? 'selected="selected"' : ''; ?> >
									<?php echo $rowtext['nama_warna']; ?>
								</option>
							<?php
								}
							?>
							</select>
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
		setColor1();
		setColor2();
		  $('select.s1').change(function(){
				setColor1();
		 });
		  $('select.s2').change(function(){
				setColor2();
		 });
	});
	function setColor1()
	{
		var color =  $('select.s1').find('option:selected').attr('warna');
		$('select.s1').css('background', color);
		$('select.s1').css('color', 'black');
	}
	function setColor2()
	{
		var color =  $('select.s2').find('option:selected').attr('warna2');
		$('select.s2').css('background', 'white');
		$('select.s2').css('color', color);
	}
</script>
<?php
}
elseif ($page=="pelengkap")
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
					  <th width="5%">Urutan</th>
					  <th>Nama Pegawai</th>
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
elseif ($page=="pelengkap_urutan")
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
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('jadwal/pelengkap/simpan_urutan');?>" onClick="return cek();">
		<input type="hidden" name="id_pegawai" value="<?= $id; ?>">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
				<div class="col-md-12">
					<div class="form-group">
					  <label>Urutan</label>
						<?php
							input_textcustom("no_urutan",$no_urutan,"style='text-align:right;' autofocus maxlength='3'
										onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
												"Masukkan No Urutan","text");
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
<?php
}
elseif ($page=="pelengkap_signature")
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
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('jadwal/pelengkap/simpan_signature');?>" onClick="return cek();">
		<input type="hidden" name="id_unit" value="<?= $this->session->unit; ?>">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
				<div class="col-sm-6">
					  <label>Text Kiri Atas (ex : Mengetahui)</label>
						<?php
							input_text("text_kiri_top",$text_kiri_top,"maxlength='255'","Masukkan Signature","text");
						?>
				</div>
				<div class="col-sm-6">
					 <label>Text Tengah Atas (ex : Mengetahui)</label>
						<?php
							input_text("text_tengah_top",$text_tengah_top,"maxlength='255'","Masukkan Signature","text");
						?>
				</div>
				<div class="col-sm-6">
					 <label>Text Kanan Atas (Kota, Tanggal)</label>
						<?php
							input_text("text_kanan_top",$text_kanan_top,"maxlength='255'","Masukkan Signature","text");
						?>
				</div>
				<div class="col-sm-6">
					  <label>Text Kiri Kedua (ex : Kepala Instalasi)</label>
						<?php
							input_text("text_kiri_middle",$text_kiri_middle,"maxlength='255'","Masukkan Signature","text");
						?>
				</div>
				<div class="col-sm-6">
					 <label>Text Tengah Kedua (ex : Kepala Ruangan / Bagian)</label>
						<?php
							input_text("text_tengah_middle",$text_tengah_middle,"maxlength='255'","Masukkan Signature","text");
						?>
				</div>
				<div class="col-sm-6">
					 <label>Text Kanan Kedua (ex : Kepala Ruangan / Bagian)</label>
						<?php
							input_text("text_kanan_middle",$text_kanan_middle,"maxlength='255'","Masukkan Signature","text");
						?>
				</div>
				<div class="col-sm-6">
					  <label>Text Kiri Bawah (ex : Nama)</label>
						<?php
							input_text("text_kiri_bottom",$text_kiri_bottom,"maxlength='255'","Masukkan Signature","text");
						?>
				</div>
				<div class="col-sm-6">
					 <label>Text Tengah Bawah (ex : Nama)</label>
						<?php
							input_text("text_tengah_bottom",$text_tengah_bottom,"maxlength='255'","Masukkan Signature","text");
						?>
				</div>
				<div class="col-sm-6">
					 <label>Text Kanan Bawah (ex : Nama)</label>
						<?php
							input_text("text_kanan_bottom",$text_kanan_bottom,"maxlength='255'","Masukkan Signature","text");
						?>
				</div>
				<div class="col-sm-6">
					  <label>Text Kiri NIP</label>
						<?php
							input_text("text_kiri_nip",$text_kiri_nip,"maxlength='255'","Masukkan Signature","text");
						?>
				</div>
				<div class="col-sm-6">
					 <label>Text Tengah NIP</label>
						<?php
							input_text("text_tengah_nip",$text_tengah_nip,"maxlength='255'","Masukkan Signature","text");
						?>
				</div>
				<div class="col-sm-6">
					 <label>Text Kanan NIP</label>
						<?php
							input_text("text_kanan_nip",$text_kanan_nip,"maxlength='255'","Masukkan Signature","text");
						?>
				</div>
              </div>
				<div class="box-footer">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
          </div>
		</div>
		</FORM>
	  </div>
<?php
}
elseif ($page=="jadwal_dinas")
{
?>
<style media="screen">
table.dataTable tbody tr.selected {
  background-color: #0088cc !important;
  color: white !important;
  border: 1px solid #2083eb;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
		<a href="<?php echo $link_kembali;?>"
			class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Kembali
		</a>
      </h1>
    </section>
    <section class="content">
      <div class="box">
        <div class="box-body">
			<?php echo form_open_multipart('jadwal/jadwal_dinas/view/'.$bulan.'/'.$tahun,' id="signupform" ');
			?>
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
		<div class="box-header with-border">
			<button type="submit" name="action" value="BtnProses" class="btn btn-primary btn-xs pull-left"><i class="fa fa-recycle"></i> Proses</button>
		</div>
			  <div class="box-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
						<label>Bulan</label>
							<?php
								input_pdselect2("bulan",$cmd_year,$bulan);
							?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						<label>Tahun</label>
							<?php
								input_textcustom("tahun",$tahun," class='form-control' id='tahun' ","","text");
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
			</div>
			<div class="box-body">
				<table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
					<thead>
						<tr>
						  <th style="display:none;">&nbsp;</th>
						  <th>Nama Pegawai</th>
						</tr>
					</thead>
				</table>
			</div>
			<div class="box-footer">

			</div>
		  </div>
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
				<div class="box-header with-border">
				<a href="<?php echo base_url('jadwal/jadwal_dinas/pdf/'); ?><?php echo $bulan;?>/<?php echo $tahun;?>/<?php echo $ruangan;?>" target="_blank" class="btn btn-white btn-md">
					<i class="fa fa-print"></i> PDF
				</a>
				</div>
			<div class="box-body">
				<?php
				$awal	= $tahun.'-'.$bulan.'-01';
				$tglakhir = date('t', strtotime($awal));
				$akhir	= $tahun.'-'.$bulan.'-'.$tglakhir;
				?>
				<table id="example1" width="100%" class="table table-bordered table-striped">
				  <thead>
					<tr>
						<th style="background-color:#D3D3D3;color:black;">Nama Pegawai</th>
					<?php
						foreach (range(1, $tglakhir) as $number) {
							  if(in_array($number,$tgl_hari_libur)){ ?>
						<th style="background-color:#ff0000;color:white;font-size:12px;vertical-align:middle;text-align:center;width: 3%;"><?php echo $number; ?></th>
							<?php
							  }else{ ?>
						<th style="background-color:#D3D3D3;color:black;font-size:12px;vertical-align:middle;text-align:center;width: 3%;"><?php echo $number; ?></th>
							<?php
							  }
						}
					?>
					</tr>
				  </thead>
				  <tbody>
						<?php
							foreach($ambil_data_pegawai as $rowambil_data_pegawai){
						?>
					<tr>
						<td style="background-color:#D3D3D3;color:black;vertical-align:middle;text-align:left"><?php echo $rowambil_data_pegawai['nama_pegawai']; ?><br><?php echo $rowambil_data_pegawai['no_hp']; ?></td>
						<?php
						foreach (range(1, $tglakhir) as $numbers) {
							$tglenya	= $tahun.'-'.$bulan.'-'.$numbers;
							$id_pegawai	= $rowambil_data_pegawai['id_pegawai'];
							$jadwal_at = $this->m_jadwal->print_jadwal($tglenya,$id_pegawai);
							$kondisi_surat=array('id_pegawai'=>$id_pegawai,'tgl_jadwal'=>$tglenya);
							$jml=$this->m_umum->jumlah_record_filter('pegawai_jadwal',$kondisi_surat);
							if($jml == 0){
								if(in_array($numbers,$tgl_hari_libur)){ ?>
									<td style="background-color:#ff0000;color:white;font-size:12px;vertical-align:middle;text-align:center;">-</td>
								<?php
								}else{ ?>
									<td style="vertical-align:middle;text-align:center">-</td>
								<?php
								}
							}else{
								foreach($jadwal_at as $rowjadwal_at){
						?>
						<td style="background-color:<?php echo $rowjadwal_at['kode_warna']; ?>;vertical-align:middle;text-align:center;color:<?php echo $rowjadwal_at['text_warna']; ?>;">
							<?php echo $rowjadwal_at['nama_dinas_jaga']; ?>
						</td>
						<?php
								}
							}
						}
						?>
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
<style>
#chartdiv {
  width: 100%;
  height: 500px;
}
</style>
<?php
}
elseif ($page=="jadwal_dinas_hari_libur")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
		<a href="<?php echo $link_awal;?>"
			class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Kembali
		</a>
      </h1>
    </section>
    <section class="content">
		<?php echo form_open('jadwal/jadwal_dinas/hari_libur/'.$bulan.'/'.$tahun,' ');
		input_text("id_unit",$this->session->unit,"","","hidden");
		input_text("id_hari_libur",$id_hari_libur,"","","hidden");
		input_text("bulan",$bulan,"","","hidden");
		input_text("tahun",$tahun,"","","hidden");
		?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>
          <div class="box-tools pull-right">
			 <button type="submit" class="btn btn-primary btn-xs">Submit</button>
          </div>
        </div>
        <div class="box-body">
		  <table id="example1" width="100%" class="table table-bordered table-striped">
			  <thead>
				<tr>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;;width:5%;">
				<!--		<input name="select_all" class="checkall" type="checkbox" /> -->
					</th>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle">Tanggal</th>
				</tr>
			  </thead>
			  <tbody>
					<?php
					foreach(range(1, $tglakhir) as $number){
					?>
				<tr>
					<td style="vertical-align:middle;">
					  <div class="main checkbox">
						<label>
						  <input type="checkbox" class="flat-red" name="chk[]" value="<?php echo $number; ?>" <?php if(in_array($number,$tgl_hari_libur)) echo 'checked="checked"'; ?> >
						</label>
					  </div>
					</td>
					<td style="vertical-align:middle;"><?php echo $number; ?></td>
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
<script type="text/javascript">
    $(document).ready(function() {
		$('.checkall').on('click', function() {
			$('.child').prop('checked', this.checked)
		});
	});
</script>
<?php
}
elseif ($page=="jadwal_dinas_tanggal")
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
		<a href="<?php echo $link_awal;?>"
			class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Kembali
		</a>
      </h1>
    </section>
    <section class="content">
	<?php echo form_open('jadwal/jadwal_dinas/tanggal/'.$bulan.'/'.$tahun.'/'.$id_pegawai,' ');
	input_text("bulan",$bulan,"","","hidden");
	input_text("tahun",$tahun,"","","hidden");
	input_text("id_pegawai",$id_pegawai,"","","hidden");
	input_text("id_unit",$this->session->unit,"","","hidden");
	?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button> || Nama Pegawai : <?php echo $nameeke; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
		  <div class="form-group">
			<label>Dinas Jaga</label>
				<?php
					input_pdselect2("id_dinas_jaga",$cmd_dinas_jaga,$id_dinas_jaga);
				?>
		  </div>
		  <table id="example1" width="100%" class="table table-bordered table-striped">
			  <thead>
				<tr>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;;width:5%;">
					<!--		<input name="select_all" class="checkall" type="checkbox" /> -->
					</th>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle">Tanggal</th>
				</tr>
			  </thead>
			  <tbody>
					<?php
					foreach(range(1, $tglakhir) as $number){
					?>
				<tr>
					<td style="vertical-align:middle;">
					  <div class="main checkbox">
						<label>
						  <input type="checkbox" class="minimal" name="chk[]" value="<?php echo $number; ?>" >
						</label>
					  </div>
					</td>
					<td style="vertical-align:middle;"><?php echo $number; ?></td>
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
elseif ($page=="jadwal_dinas_tambah_dinas")
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
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
	<FORM method="POST" class="form-horizontal" action="<?php echo base_url('jadwal/jadwal_dinas/simpan_tambah_dinas');?>" onClick="return cek();">
		<input type="hidden" name="id_pegawai" value="<?= $id_pegawai; ?>">
		<input type="hidden" name="bulan" value="<?= $bulan; ?>">
		<input type="hidden" name="tahun" value="<?= $tahun; ?>">
		<input type="hidden" name="id_unit" value="<?= $this->session->unit; ?>">
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
			<label>Dinas Jaga</label>
				<?php
					input_pdselect2("id_dinas_jaga",$cmd_dinas_jaga,$id_dinas_jaga);
				?>
		  </div>
		  <table id="examples" width="100%" class="table table-bordered table-striped">
			  <thead>
				<tr>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;;width:5%;">
					<!--		<input name="select_all" class="checkall" type="checkbox" /> -->
					</th>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle">Tanggal</th>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle">Dinas</th>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle">Pembuat</th>
				</tr>
			  </thead>
			  <tbody>
					<?php
					foreach(range(1, $tglakhir) as $number){
						$pegawai_jadwal = $this->m_jadwal->ambil_data_pegawai_jadwal($number,$bulan,$tahun,$id_pegawai);
						$pembuate = $this->m_umum->ambil_data('ol_pegawai','barcode_pegawai',$pegawai_jadwal['barcode_pegawai']);
						if(empty($pegawai_jadwal)){
							$bek_warnae = "white";
							$text_warnae = "black";
							$nama_dinas_jaga = "-";
						}else{
							$bek_warnae = $pegawai_jadwal['bek_warna'];
							$text_warnae = $pegawai_jadwal['text_warna'];
							$nama_dinas_jaga = $pegawai_jadwal['nama_dinas_jaga'];
						}
					?>
				<tr>
					<td style="vertical-align:middle;">
					  <div class="main checkbox">
						<label>
						  <input type="checkbox" class="minimal" name="chk[]" value="<?php echo $number; ?>" >
						</label>
					  </div>
					</td>
					<td style="vertical-align:middle;background-color:<?= $bek_warnae ?>;color:<?= $text_warnae ?>;">
						<?php echo $number; ?>
					</td>
					<td style="vertical-align:middle;background-color:<?= $bek_warnae ?>;color:<?= $text_warnae ?>;">
						<?= $nama_dinas_jaga ?>
					</td>
					<td style="vertical-align:middle;background-color:<?= $bek_warnae ?>;color:<?= $text_warnae ?>;">
						<?= $pembuate['nama_pegawai'] ?>
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
	</FORM>
    </section>
</div>
<script type="text/javascript">
    $(document).ready(function() {
		$('.select2').select2()
		$('.checkall').on('click', function() {
			$('.child').prop('checked', this.checked)
		});
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
	  radioClass   : 'iradio_minimal-blue'
    })
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
	  radioClass   : 'iradio_minimal-red'
    })
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
	  radioClass   : 'iradio_flat-green'
    })
		var table = $('#examples').DataTable({
		  'paging'      : false,
		  'lengthChange': false,
		  'searching'   : false,
		  'ordering'    : false,
		  'info'        : true,
		  'scrollX'		: true ,
		  'scrollX'			: true,
		  'scrollY'			: '300px',
		  'scrollCollapse'	: true
		})
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#examples').DataTable();
           table.columns.adjust();
    });
	});
</script>
<?php
}
elseif ($page=="jadwal_dinas_rubah_dinas")
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
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
	<FORM method="POST" class="form-horizontal" action="<?php echo base_url('jadwal/jadwal_dinas/simpan_rubah_dinas');?>" onClick="return cek();">
		<input type="hidden" name="id_jadwal" value="<?= $dinas; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
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
			  <label>Dinas</label>
				<?php
					input_pdselect2("id_dinas_jaga",$cmd_dinas_jaga,$id_dinas_jaga);
				?>
        </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
	</FORM>
    </section>
</div>
<script type="text/javascript">
    $(document).ready(function() {
		$('.select2').select2()
	});
</script>
<?php
}
elseif ($page=="lihat_jadwal")
{
?>
<style media="screen">
table.dataTable tbody tr.selected {
  background-color: #0088cc !important;
  color: white !important;
  border: 1px solid #2083eb;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
		<a href="<?php echo $link_kembali;?>"
			class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Kembali
		</a>
		||
		<a href="<?php echo $link_awal;?>"
			class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Laporan Jaga
		</a> ||
		<a href="<?php echo $link_tambahan;?>"
			class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Pengambilan Hasil
		</a>
      </h1>
    </section>
    <section class="content">
      <div class="box">
        <div class="box-body">
			<?php echo form_open_multipart('jadwal_all/lihat_jadwal/view/'.$bulan.'/'.$tahun,' id="signupform" ');
			?>
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
		<div class="box-header with-border">
			<button type="submit" name="action" value="BtnProses" class="btn btn-primary btn-xs pull-left"><i class="fa fa-recycle"></i> Proses</button>
		</div>
			  <div class="box-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
						<label>Bulan</label>
							<?php
								input_pdselect2("bulan",$cmd_year,$bulan);
							?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						<label>Tahun</label>
							<?php
								input_textcustom("tahun",$tahun," class='form-control' id='tahun' ","","text");
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
			<a href="<?php echo base_url('jadwal_all/lihat_jadwal/pdf/'); ?><?php echo $bulan;?>/<?php echo $tahun;?>/<?php echo $ruangan;?>" target="_blank" class="btn btn-white btn-md">
				<i class="fa fa-print"></i> PDF
			</a>
			</div>
			<div class="box-body">
				<?php
				$awal	= $tahun.'-'.$bulan.'-01';
				$tglakhir = date('t', strtotime($awal));
				$akhir	= $tahun.'-'.$bulan.'-'.$tglakhir;
				?>
				<table id="example1" width="100%" class="table table-bordered table-striped">
				  <thead>
					<tr>
						<th style="background-color:#D3D3D3;color:black;">Nama Pegawai</th>
					<?php
						foreach (range(1, $tglakhir) as $number) {
							  if(in_array($number,$tgl_hari_libur)){ ?>
						<th style="background-color:#ff0000;color:white;font-size:12px;vertical-align:middle;text-align:center;width: 3%;"><?php echo $number; ?></th>
							<?php
							  }else{ ?>
						<th style="background-color:#D3D3D3;color:black;font-size:12px;vertical-align:middle;text-align:center;width: 3%;"><?php echo $number; ?></th>
							<?php
							  }
						}
					?>
					</tr>
				  </thead>
				  <tbody>
						<?php
							foreach($ambil_data_pegawai as $rowambil_data_pegawai){
						?>
					<tr>
						<td style="background-color:#D3D3D3;color:black;vertical-align:middle;text-align:left"><?php echo $rowambil_data_pegawai['nama_pegawai']; ?><br><?php echo $rowambil_data_pegawai['no_hp']; ?></td>
						<?php
						foreach (range(1, $tglakhir) as $numbers) {
							$tglenya	= $tahun.'-'.$bulan.'-'.$numbers;
							$id_pegawai	= $rowambil_data_pegawai['id_pegawai'];
							$jadwal_at = $this->m_jadwal->print_jadwal($tglenya,$id_pegawai);
							$kondisi_surat=array('id_pegawai'=>$id_pegawai,'tgl_jadwal'=>$tglenya);
							$jml=$this->m_umum->jumlah_record_filter('pegawai_jadwal',$kondisi_surat);
							if($jml == 0){
								if(in_array($numbers,$tgl_hari_libur)){ ?>
									<td style="background-color:#ff0000;color:white;font-size:12px;vertical-align:middle;text-align:center;">-</td>
								<?php
								}else{ ?>
									<td style="vertical-align:middle;text-align:center">-</td>
								<?php
								}
							}else{
								foreach($jadwal_at as $rowjadwal_at){
						?>
						<td style="background-color:<?php echo $rowjadwal_at['kode_warna']; ?>;vertical-align:middle;text-align:center;color:<?php echo $rowjadwal_at['text_warna']; ?>;">
							<?php echo $rowjadwal_at['nama_dinas_jaga']; ?>
						</td>
						<?php
								}
							}
						}
						?>
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
    </section>
</div>
<?php
}
elseif ($page=="pasien")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
		<a href="<?php echo $link_kembali;?>"
			class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Kembali
		</a> ||
		<a href="<?php echo $link_awal;?>"
			class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Jadwal
		</a> ||
		<a href="<?php echo $link_daftar;?>"
			class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Pendaftaran
		</a>
    </section>
    <section class="content">
      <div class="box">
        <div class="box-body">
					 <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
						<div class="box-header with-border">
						  <h3 class="box-title">DATA PASIEN
						  </h3>

          <div class="box-tools pull-right">
			<?php
				input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI LAPORAN DI TABEL","text");
			?>
          </div>
						<!-- /.box-header -->

					 </div>
						<div class="box-body">
					<table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
						<thead>
							<tr>
							  <th>RM</th>
							  <th>Data Pasien</th>
							  <th>Instansi</th>
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
elseif ($page=="pasien_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
    .autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
    .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
    .autocomplete-selected { background: #F0F0F0; }
    .autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
    .autocomplete-group { padding: 2px 5px; }
    .autocomplete-group strong { display: block; border-bottom: 1px solid #000; } 
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('jadwal_all/pasien/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Laporan Jaga</h3>
      </div>
        <div class="box-body">
              <div class="col-md-8">
                  <label for="autocomplete">Cari Nama Pasien</label>
                  <?php
                input_textcustom("nama_pasien",$nama_pasien," maxlength='70' required id='nama_pasien'
                      class='form-control autocomplete'",
                          "Cari RM / Nama Pasien","text"); 
                  ?>
              </div>        	
              <div class="col-md-4">
                  <label>RM</label>
                  <?php
                 input_textcustom("rm",$rm," maxlength='15' required id='rm'
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control autocomplete'",
                          "RM","text"); 
                  ?>
              </div>
              <div class="col-md-4">
                  <label>Tanggal Lahir</label>
                  <?php
                 input_calendar("tgl_lahir","tgl_lahir",$tgl_lahir,"Masukkan Tanggal","");  
                  ?>
              </div>
              <div class="col-md-3">
                  <label>Jenis Kelamin</label>
                  <?php
                 input_pd("jk",$cmd_jk,$jk);
                  ?>
              </div>
            <div class="col-md-5">
                <label>Alamat</label>
                <?php
                  input_text("alamat",$alamat,"maxlength='255' ","Ketikkan Alamat","text");
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
var status=0;
$('#tgl_lahir').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_lahir").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$(document).ready(function() {
  $('.select2').select2()
      $('#nama_pasien').autocomplete({
        minChars : '3',
        type: 'GET',
        serviceUrl: '<?php echo base_url();?>jadwal_all/pasien_cari_data',
        dataType: 'json',
        onSelect: function (data) {
            document.getElementById("nama_pasien").value = data.data;
            $('#nama_pasien').val(data.nama_pasien);
            $('#rm').val(data.rm);
            $('#tgl_lahir').val(data.tgl_lahir);
            $('#jk').val(data.jk);
            $('#alamat').val(data.alamat);
            status=1;
        }
      });
});
</script>
<?php
}
elseif ($page=="pasien_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
    .autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
    .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
    .autocomplete-selected { background: #F0F0F0; }
    .autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
    .autocomplete-group { padding: 2px 5px; }
    .autocomplete-group strong { display: block; border-bottom: 1px solid #000; } 
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('jadwal_all/pasien/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_pasien" value="<?= $id_pasien; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">PASIEN</h3>
      </div>
        <div class="box-body">
              <div class="col-md-8">
                  <label for="autocomplete">Cari Nama Pasien</label>
                  <?php
                input_textcustom("nama_pasien",$nama_pasien," maxlength='70' required id='nama_pasien'
                      class='form-control autocomplete'",
                          "Cari RM / Nama Pasien","text"); 
                  ?>
              </div>        	
              <div class="col-md-4">
                  <label>RM</label>
                  <?php
                 input_textcustom("rm",$rm," maxlength='15' required id='rm'
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control autocomplete'",
                          "RM","text"); 
                  ?>
              </div>
              <div class="col-md-4">
                  <label>Tanggal Lahir</label>
                  <?php
                 input_calendar("tgl_lahir","tgl_lahir",$tgl_lahir,"Masukkan Tanggal","");  
                  ?>
              </div>
              <div class="col-md-3">
                  <label>Jenis Kelamin</label>
                  <?php
                 input_pd("jk",$cmd_jk,$jk);
                  ?>
              </div>
            <div class="col-md-5">
                <label>Alamat</label>
                <?php
                  input_text("alamat",$alamat,"maxlength='255' ","Ketikkan Alamat","text");
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
var status=0;
$('#tgl_lahir').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_lahir").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$(document).ready(function() {
  $('.select2').select2()
      $('#nama_pasien').autocomplete({
        minChars : '3',
        type: 'GET',
        serviceUrl: '<?php echo base_url();?>jadwal_all/pasien_cari_data',
        dataType: 'json',
        onSelect: function (data) {
            document.getElementById("nama_pasien").value = data.data;
            $('#nama_pasien').val(data.nama_pasien);
            $('#rm').val(data.rm);
            $('#tgl_lahir').val(data.tgl_lahir);
            $('#jk').val(data.jk);
            $('#alamat').val(data.alamat);
            status=1;
        }
      });
});
</script>
<?php
}
elseif ($page=="chat")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
		<a href="<?php echo $link_kembali;?>"
			class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Kembali
		</a> ||
		<a href="<?php echo $link_awal;?>"
			class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Jadwal
		</a> ||
		<a href="<?php echo $link_tambahan;?>"
			class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Pengambilan Hasil
		</a>
    </section>
    <section class="content">
			<?php echo form_open_multipart('jadwal_all/chat/view/'.$first_date.'/'.$last_date,' id="signupform" ');
			?>
		<div class="row">
			<div class="col-md-12">
			  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
				<div class="box-header with-border">
				  <h3 class="box-title">
				  	LAPORAN DINAS JAGA
				  </h3>

				  <div class="box-tools pull-right">
					
					</button>
				  </div>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="col-md-5">
					 <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
						<div class="box-header with-border">
						  <h3 class="box-title">
				<button type="submit" name="action" value="BtnProses" class="btn btn-primary btn-xs pull-left"><i class="fa fa-save"></i> Simpan</button>
						  </h3>

						  <div class="box-tools pull-right">
						</div>
						<!-- /.box-header -->

					 </div>
						<div class="box-body">
				  <label>Tulis Laporan Jaga</label>
					<?php
						input_textareacustom("isi_chat",$isi_chat," id='editor1' rows='5' cols='100' class='form-control' ","");
					?>
						</div>
				<div class="box-footer">
				<button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-save"></i> Simpan</button>
				</div>
				  </div>

				</div>
				<div class="col-md-7">
					 <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
						<div class="box-header with-border">
						  <h3 class="box-title">
<button type="submit" name="action" value="BtnCari" class="btn btn-primary btn-xs pull-left"><i class="fa fa-recycle"></i> Proses</button>
						  </h3>

          <div class="box-tools pull-right">
			<?php
				input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI LAPORAN DI TABEL","text");
			?>
          </div>
						<!-- /.box-header -->

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
					<table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
						<thead>
							<tr>
							  <th style="display:none;">Tanggal</th>
							  <th>Isi Laporan</th>
							</tr>
						</thead>
					</table>
				  </div>
				<div class="box-footer">
				<button type="submit" name="action" value="BtnCari" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
				</div>
				</div>
			  </div>
			</div>
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
elseif ($page=="chat_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('jadwal_all/chat/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_chat" value="<?= $id_chat; ?>">
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
        <h3 class="box-title">Laporan Jaga</h3>
      </div>
        <div class="box-body">
              <div class="col-md-12">
                  <?php
                    input_textareacustom("isi_chat",$isi_chat," id='editor2' rows='5' cols='100' class='form-control' ","");
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
	CKEDITOR.replace('editor2', {enterMode: CKEDITOR.ENTER_BR});
</script>
<?php
}
elseif ($page=="pengambilan")
{
?>
<style media="screen">
table.dataTable tbody tr.selected {
  background-color: #0088cc !important;
  color: white !important;
  border: 1px solid #2083eb;
}
td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_close.png') no-repeat center center;
}
.anyClass {
  height:500px;
  overflow-y: scroll;
}
.bolded {
  font-weight:bold;
}
.autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
.autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
.autocomplete-selected { background: #F0F0F0; }
.autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
.autocomplete-group { padding: 2px 5px; }
.autocomplete-group strong { display: block; border-bottom: 1px solid #000; } 
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
		<a href="<?php echo $link_kembali;?>"
			class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Kembali
		</a>
		||
		<a href="<?php echo $link_awal;?>"
			class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Jadwal
		</a> ||
		<a href="<?php echo $link_daftar;?>"
			class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Laporan Jaga
		</a>
      </h1>
    </section>
 			<?php echo form_open_multipart('jadwal_all/pengambilan/view/'.$first_date.'/'.$last_date.'/'.$key,' id="signupform" ');
			?>   
    <section class="content">
      <div class="box">
        <div class="box-body">
    <div class="col-md-12">
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
		<div class="box-header with-border">
			<button type="submit" name="action" value="BtnProses" class="btn btn-primary btn-xs pull-left"><i class="fa fa-recycle"></i> Proses</button>
		</div>
			  <div class="box-body">
				<div class="row">
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
					<div class="col-md-12">
						<div class="form-group">
            <label> Ketik multiple pisahkan dengan spasi untuk Nama Pasien dan RM</label>
              <?php
                input_text("key",$key," autofocus","Ketik multiple pisahkan dengan spasi atau -","text");
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
								<h3 class="box-title">DATA TANGGAL <?= $this->m_rancak->fullBulan($first_date) .' &nbsp;S/D&nbsp; '. $this->m_rancak->fullBulan($last_date) ?></h3>
								  <div class="box-tools pull-right">
									<?php
								//		input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
									?>
			          	</div>
							</div>
							<div class="box-body">
								<table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
									<thead>
										<tr>
										  <th style="width:5%;"></th>
										  <th style="width:10%;">Tanggal</th>
										  <th style="text-align: center;">Pasien</th>
										  <th>Pemeriksaan</th>
										  <th>Dokter</th>
										  <th>Ruangan</th>
										  <th>Pengirim</th>
										  <th>Pengambil</th>
										</tr>
									</thead>
								</table>
							</div>
					  </div>

				
   </div>
        </div>
      </div>
    </section>
    <?php echo form_close(); ?>   
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
elseif ($page=="pengambilan_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
    .autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
    .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
    .autocomplete-selected { background: #F0F0F0; }
    .autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
    .autocomplete-group { padding: 2px 5px; }
    .autocomplete-group strong { display: block; border-bottom: 1px solid #000; } 
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('jadwal_all/pengambilan/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Laporan Jaga</h3>
      </div>
        <div class="box-body">
            <div class="col-md-12">
            <div class="col-md-4">
            	<label>Tanggal</label>
							<?php
								input_calendar("tgl_ambil","tgl_ambil",$tgl_ambil,"Masukkan Tanggal","");
							?>	
            </div>
            <div class="col-md-4">
            	<label>Status</label>
							<?php
								input_pdselect2("status_ambil",$status,$status_ambil);
							?>	
            </div>
              <div class="col-md-4">
                  <label>RM</label>
                  <?php
                 input_textcustom("rm",$rm," maxlength='15' id='rm'
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control autocomplete'",
                          "RM","text");
                  ?>
              </div>
              <div class="col-md-4">
                  <label for="autocomplete">Nama Pasien</label>
                  <?php
                input_textcustom("nama_pasien",$nama_pasien," maxlength='70' id='nama_pasien'
                      class='form-control autocomplete'",
                          "Cari RM / Nama Pasien","text"); 
                  ?>
              </div>
              <div class="col-md-4">
                  <label>Tanggal Lahir</label>
                  <?php
                 input_calendar("tgl_lahir","tgl_lahir",$tgl_lahir,"Masukkan Tanggal","");  
                  ?>
              </div>
              <div class="col-md-4">
                  <label>Jenis Kelamin</label>
                  <?php
                 input_pd("jk",$cmd_jk,$jk);
                  ?>
              </div> 
            </div>
            <div class="col-md-12">
            <div class="col-md-6">
            	<label>Alamat</label>
							<?php
								input_text("alamat",$alamat," ","Masukkan Alamat Pasien","text");
							?>	
            </div> 
            <div class="col-md-6">
            	<label>Dokter Pembaca</label>
							<?php
								input_pdselect2("dr_tindakan",$cmd_dokter,$dr_tindakan);
							?>	
            </div>
            <div class="col-md-6">
            	<label>Ruangan / Unit Pengirim</label>
							<?php
								input_pdselect2("unit_pengirim",$cmd_unit,$unit_pengirim);
							?>	
            </div>
            <div class="col-md-6">
            	<label>Dokter Pengirim</label>
							<?php
								input_pdselect2("dr_pengirim",$cmd_dokter,$dr_pengirim);
							?>	
            </div> 
            <div class="col-md-6">
            	<label>Tindakan / Pemeriksaan</label>
							<?php
								input_text("id_tindakan",$id_tindakan," ","Masukkan Pemeriksaan","text");
							?>	
            </div> 
            <div class="col-md-6">
            	<label>Nama Pengambil</label>
							<?php
								input_text("nama_pengambil",$nama_pengambil," ","Masukkan Nama Pengambil","text");
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
	CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
    $('#tgl_ambil').datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true
    })
	$("#tgl_ambil").inputmask("datetime", {
		mask: "1-2-y", 
		placeholder: "dd-mm-yyyy", 
		leapday: "-02-29", 
		separator: "-", 
		alias: "dd/mm/yyyy"
	});
$('#tgl_lahir').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_lahir").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$(document).ready(function() {
  $('.select2').select2()
      $('#nama_pasien').autocomplete({
        minChars : '3',
        type: 'GET',
        serviceUrl: '<?php echo base_url();?>jadwal_all/pasien_cari_data',
        dataType: 'json',
        onSelect: function (data) {
            document.getElementById("nama_pasien").value = data.data;
            $('#nama_pasien').val(data.nama_pasien);
            $('#rm').val(data.rm);
            $('#tgl_lahir').val(data.tgl_lahir);
            $('#jk').val(data.jk);
            $('#alamat').val(data.alamat);
            status=1;
        }
      });
      $('#rm').autocomplete({
        minChars : '3',
        type: 'GET',
        serviceUrl: '<?php echo base_url();?>jadwal_all/rm_cari_data',
        dataType: 'json',
        onSelect: function (data) {
            document.getElementById("rm").value = data.data;
            $('#nama_pasien').val(data.nama_pasien);
            $('#rm').val(data.rm);
            $('#tgl_lahir').val(data.tgl_lahir);
            $('#jk').val(data.jk);
            $('#alamat').val(data.alamat);
            status=1;
        }
      });
});
</script>
<?php
}
elseif ($page=="pengambilan_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
    .autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
    .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
    .autocomplete-selected { background: #F0F0F0; }
    .autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
    .autocomplete-group { padding: 2px 5px; }
    .autocomplete-group strong { display: block; border-bottom: 1px solid #000; } 
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('jadwal_all/pengambilan/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_ambil" value="<?= $id_ambil; ?>">
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
        <h3 class="box-title">Laporan Jaga</h3>
      </div>
        <div class="box-body">
              <div class="col-md-4">
                  <label>RM</label>
                  <?php
                 input_textcustom("rm",$rm," maxlength='15' id='rm'
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control autocomplete'",
                          "RM","text");
                  ?>
              </div>
              <div class="col-md-4">
                  <label>Tanggal Lahir</label>
                  <?php
                 input_calendar("tgl_lahir","tgl_lahir",$tgl_lahir,"Masukkan Tanggal","");  
                  ?>
              </div>
              <div class="col-md-4">
                  <label>Jenis Kelamin</label>
                  <?php
                 input_pd("jk",$cmd_jk,$jk);
                  ?>
              </div>
              <div class="col-md-6">
                  <label for="autocomplete">Nama Pasien</label>
                  <?php
                input_textcustom("nama_pasien",$nama_pasien," maxlength='70' id='nama_pasien'
                      class='form-control autocomplete'",
                          "Cari RM / Nama Pasien","text"); 
                  ?>
              </div>
            <div class="col-md-6">
            	<label>Alamat</label>
							<?php
								input_text("alamat",$alamat," ","Masukkan Alamat Pasien","text");
							?>	
            </div> 
            <div class="col-md-6">
            	<label>Tanggal</label>
							<?php
								input_calendar("tgl_ambil","tgl_ambil",$tgl_ambil,"Masukkan Tanggal","");
							?>	
            </div>
            <div class="col-md-6">
            	<label>Status</label>
							<?php
								input_pdselect2("status_ambil",$status,$status_ambil);
							?>	
            </div> 
            <div class="col-md-6">
            	<label>Dokter Pembaca</label>
							<?php
								input_pdselect2("dr_tindakan",$cmd_dokter,$dr_tindakan);
							?>	
            </div>
            <div class="col-md-6">
            	<label>Ruangan / Unit Pengirim</label>
							<?php
								input_pdselect2("unit_pengirim",$cmd_unit,$unit_pengirim);
							?>	
            </div>
            <div class="col-md-6">
            	<label>Dokter Pengirim</label>
							<?php
								input_pdselect2("dr_pengirim",$cmd_dokter,$dr_pengirim);
							?>	
            </div> 
            <div class="col-md-6">
            	<label>Tindakan / Pemeriksaan</label>
							<?php
								input_text("id_tindakan",$id_tindakan," ","Masukkan Pemeriksaan","text");
							?>	
            </div> 
            <div class="col-md-12">
            	<label>Nama Pengambil</label>
							<?php
								input_text("nama_pengambil",$nama_pengambil," ","Masukkan Nama Pengambil","text");
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
    $('#tgl_ambil').datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true
    })
	$("#tgl_ambil").inputmask("datetime", {
		mask: "1-2-y", 
		placeholder: "dd-mm-yyyy", 
		leapday: "-02-29", 
		separator: "-", 
		alias: "dd/mm/yyyy"
	});
$('#tgl_lahir').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_lahir").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
var status=0;
$(document).ready(function() {
  $('.select2').select2()
      $('#nama_pasien').autocomplete({
        minChars : '3',
        type: 'GET',
        serviceUrl: '<?php echo base_url();?>jadwal_all/pasien_cari_data',
        dataType: 'json',
        onSelect: function (data) {
            document.getElementById("nama_pasien").value = data.data;
            $('#nama_pasien').val(data.nama_pasien);
            $('#rm').val(data.rm);
            $('#tgl_lahir').val(data.tgl_lahir);
            $('#jk').val(data.jk);
            $('#alamat').val(data.alamat);
            status=1;
        }
      });
      $('#rm').autocomplete({
        minChars : '3',
        type: 'GET',
        serviceUrl: '<?php echo base_url();?>jadwal_all/rm_cari_data',
        dataType: 'json',
        onSelect: function (data) {
            document.getElementById("rm").value = data.data;
            $('#nama_pasien').val(data.nama_pasien);
            $('#rm').val(data.rm);
            $('#tgl_lahir').val(data.tgl_lahir);
            $('#jk').val(data.jk);
            $('#alamat').val(data.alamat);
            status=1;
        }
      });
});
</script>
<?php
}
elseif ($page=="pengambilan_ffedit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
    .autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
    .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
    .autocomplete-selected { background: #F0F0F0; }
    .autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
    .autocomplete-group { padding: 2px 5px; }
    .autocomplete-group strong { display: block; border-bottom: 1px solid #000; } 
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('jadwal_all/pengambilan/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_ambil" value="<?= $id_ambil ?>">
    <input type="hidden" name="id_pegawai" value="<?= $statuser ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">RUBAH DATA PENGAMBILAN</h3>
      </div>
        <div class="box-body">
              <div class="col-md-4">
                  <label>RM</label>
                  <?php
                 input_textcustom("rm",$rm," maxlength='15' id='rm'
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control autocomplete'",
                          "RM","text");
                  ?>
              </div>
              <div class="col-md-4">
                  <label>Tanggal Lahir</label>
                  <?php
                 input_calendar("tgl_lahir","tgl_lahir",$tgl_lahir,"Masukkan Tanggal","");  
                  ?>
              </div>
              <div class="col-md-4">
                  <label>Jenis Kelamin</label>
                  <?php
                 input_pd("jk",$cmd_jk,$jk);
                  ?>
              </div>
              <div class="col-md-6">
                  <label for="autocomplete">Nama Pasien</label>
                  <?php
                input_textcustom("nama_pasien",$nama_pasien," maxlength='70' id='nama_pasien'
                      class='form-control autocomplete'",
                          "Cari RM / Nama Pasien","text"); 
                  ?>
              </div>
            <div class="col-md-6">
            	<label>Alamat</label>
							<?php
								input_text("alamat",$alamat," ","Masukkan Alamat Pasien","text");
							?>	
            </div> 
            <div class="col-md-6">
            	<label>Tanggal</label>
							<?php
								input_calendar("tgl_ambil","tgl_ambil",$tgl_ambil,"Masukkan Tanggal","");
							?>	
            </div>
            <div class="col-md-6">
            	<label>Status</label>
							<?php
								input_pdselect2("status_ambil",$status,$status_ambil);
							?>	
            </div> 
            <div class="col-md-6">
            	<label>Dokter Pembaca</label>
							<?php
								input_pdselect2("dr_tindakan",$cmd_dokter,$dr_tindakan);
							?>	
            </div>
            <div class="col-md-6">
            	<label>Ruangan / Unit Pengirim</label>
							<?php
								input_pdselect2("unit_pengirim",$cmd_unit,$unit_pengirim);
							?>	
            </div>
            <div class="col-md-6">
            	<label>Dokter Pengirim</label>
							<?php
								input_pdselect2("dr_pengirim",$cmd_dokter,$dr_pengirim);
							?>	
            </div> 
            <div class="col-md-6">
            	<label>Tindakan / Pemeriksaan</label>
							<?php
								input_text("id_tindakan",$id_tindakan," ","Masukkan Pemeriksaan","text");
							?>	
            </div> 
            <div class="col-md-12">
            	<label>Nama Pengambil</label>
							<?php
								input_text("nama_pengambil",$nama_pengambil," ","Masukkan Nama Pengambil","text");
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
    $('#tgl_ambil').datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true
    })
	$("#tgl_ambil").inputmask("datetime", {
		mask: "1-2-y", 
		placeholder: "dd-mm-yyyy", 
		leapday: "-02-29", 
		separator: "-", 
		alias: "dd/mm/yyyy"
	});
$('#tgl_lahir').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_lahir").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
var status=0;
$(document).ready(function() {
  $('.select2').select2()
      $('#nama_pasien').autocomplete({
        minChars : '3',
        type: 'GET',
        serviceUrl: '<?php echo base_url();?>jadwal_all/pasien_cari_data',
        dataType: 'json',
        onSelect: function (data) {
            document.getElementById("nama_pasien").value = data.data;
            $('#nama_pasien').val(data.nama_pasien);
            $('#rm').val(data.rm);
            $('#tgl_lahir').val(data.tgl_lahir);
            $('#jk').val(data.jk);
            $('#alamat').val(data.alamat);
            status=1;
        }
      });
      $('#rm').autocomplete({
        minChars : '3',
        type: 'GET',
        serviceUrl: '<?php echo base_url();?>jadwal_all/rm_cari_data',
        dataType: 'json',
        onSelect: function (data) {
            document.getElementById("rm").value = data.data;
            $('#nama_pasien').val(data.nama_pasien);
            $('#rm').val(data.rm);
            $('#tgl_lahir').val(data.tgl_lahir);
            $('#jk').val(data.jk);
            $('#alamat').val(data.alamat);
            status=1;
        }
      });
});
</script>
<?php
}
elseif ($page=="daftar_tindakan")
{
?>
<style media="screen">
table.dataTable tbody tr.selected {
  background-color: #0088cc !important;
  color: white !important;
  border: 1px solid #2083eb;
}
td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_close.png') no-repeat center center;
}
.anyClass {
  height:500px;
  overflow-y: scroll;
}
.bolded {
  font-weight:bold;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
		<a href="<?php echo $link_kembali;?>"
			class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Kembali
		</a>
		||
		<a href="<?php echo $link_awal;?>"
			class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Jadwal
		</a> ||
		<a href="<?php echo $link_daftar;?>"
			class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Laporan Jaga
		</a>
 ||
		<a href="<?php echo $link_tambahan;?>"
			class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Pengambilan Hasil
		</a>
      </h1>
    </section>
    <section class="content">
      <div class="box">
        <div class="box-body">
					<div class="col-md-8">
			<?php echo form_open_multipart('jadwal_all/daftar_tindakan/view/'.$first_date.'/'.$last_date.'/'.$id,' id="signupform" ');
			?>
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
		<div class="box-header with-border">
			<button type="submit" name="action" value="BtnProses" class="btn btn-primary btn-xs pull-left"><i class="fa fa-recycle"></i> Proses</button>
		</div>
			  <div class="box-body">
				<div class="row">
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
					<div class="col-md-12">
						<div class="form-group">
						  <label>Golongan Pemeriksaan</label>
							<?php
							//	input_pdselect2("id_tindakan",$ambil_golongan,$id);
                input_pdselect2fleksibel("id_tindakan","id_tindakan",$ambil_golongan,"id_golongan_pemeriksaan","nama_golongan_pemeriksaan",$id,"SEMUA");   
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
								<h3 class="box-title">DATA PENDAFTARAN TANGGAL <?= $this->m_rancak->fullBulan($first_date) .' &nbsp;S/D&nbsp; '. $this->m_rancak->fullBulan($last_date) ?></h3>
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
										  <th style="width:10%;">Tanggal</th>
										  <th style="text-align: center;">Pasien</th>
										  <th style="text-align: center;">Umur</th>
										  <th>Pemeriksaan</th>
										  <th>Unit</th>
										  <th>Dokter</th>
										  <th>Pengirim</th>
										  <th>Pengirim</th>
										  <th>Status</th>
										</tr>
									</thead>
								</table>
							</div>
					  </div>
					</div>
					<div class="col-md-4">
					  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
							<div class="box-header with-border">
								<h3 class="box-title">JADWAL PEMERIKSAAN</h3>
								  <div class="box-tools pull-right"></div>
							</div>
							<div class="box-body anyClass">
								<table width="100%" class="table table-bordered table-striped table-hover" >
									<?php  
										foreach($ambil_data_daftar_tgl as $rowambil_data_daftar_tgl){
				$kondizipmr = array('td.unit_tindakan'=>$this->session->unit,'tgl_daftar'=>$rowambil_data_daftar_tgl['tgl_daftar']);
				$ambil_data_daftar_pmr = $this->m_jadwal->ambil_data_daftar_range($first_date,$last_date,$id,$kondizipmr,'t.id_golongan_pemeriksaan'); 
											foreach($ambil_data_daftar_pmr as $rowambil_data_daftar_pmr){
				$kondizidet = array('td.unit_tindakan'=>$this->session->unit,'tgl_daftar'=>$rowambil_data_daftar_tgl['tgl_daftar'],'t.id_golongan_pemeriksaan'=>$rowambil_data_daftar_pmr['id_golongan_pemeriksaan']);
				$ambil_data_daftar_det = $this->m_jadwal->ambil_data_daftar_range($first_date,$last_date,$id,$kondizidet);
									?>
										<tr>
										  <th colspan="3" style="font-size: 0.8em;text-indent: 2em;font-weight: bold;"><?= $rowambil_data_daftar_pmr['nama_golongan_pemeriksaan'] ?></th>
										</tr>
									<thead>
										<tr>
										  <th colspan="3" style="font-size: 0.8em;"><?= $this->m_rancak->fullBulan($rowambil_data_daftar_tgl['tgl']) ?></th>
										</tr>
									</thead>
									<tbody>
									<?php
											$noe =0;
												foreach($ambil_data_daftar_det as $rowambil_data_daftar_det){
													$noe++;
									?>
										<tr>
											<td style="font-size: 0.8em;text-align: center;"><?= $noe ?></td>
										  <td style="font-size: 0.8em;">
										  	<?= $rowambil_data_daftar_det['nama_tindakan'] ?>										  		
										  </td>
										  <td style="font-size: 0.8em;"><?= $rowambil_data_daftar_det['nama_unit'] ?>
										  </td>
										</tr>
										<tr>
											<td style="font-size: 0.8em;text-align: center;">&nbsp;</td>
										  <td colspan="2" style="font-size: 0.8em;">
										  	<div class="col-md-6">
											  	<?= $rowambil_data_daftar_det['nama_pasien'].' / '.$rowambil_data_daftar_det['umur']?><br>										  		
											  	<?= $rowambil_data_daftar_det['pasien_daftar'] ?>	
										  	</div>
										  	<div class="col-md-6">
										  		<?php  
										  			if($rowambil_data_daftar_det['status_daftar'] == 0){ echo '<button class="btn btn-xs btn-info"> Proses</button>';
										  			}elseif($rowambil_data_daftar_det['status_daftar'] == 1){ echo '<button class="btn btn-xs btn-success"> Selesai</button>'; 
										  			}else{ echo '<button class="btn btn-xs btn-danger">Batal</button>'; }
										  		?>
										  	</div>
									  		
										  </td>
										</tr>
									<?php
												}
											}
									?>
									</tbody>
									<?php  
										}
									?>
								</table>
							</div>
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
elseif ($page=="daftar_tindakan_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
    .autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
    .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
    .autocomplete-selected { background: #F0F0F0; }
    .autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
    .autocomplete-group { padding: 2px 5px; }
    .autocomplete-group strong { display: block; border-bottom: 1px solid #000; } 
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('jadwal_all/daftar_tindakan/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Laporan Jaga</h3>
      </div>
        <div class="box-body">
            <div class="col-md-12">
              <div class="col-md-3">
                  <label>RM</label>
                  <?php
                 input_textcustom("rm",$rm," maxlength='15' required id='rm'
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control autocomplete'",
                          "RM","text");
                  ?>
              </div>
              <div class="col-md-3">
                  <label for="autocomplete">Cari Nama Pasien</label>
                  <?php
                input_textcustom("nama_pasien",$nama_pasien," maxlength='70' required id='nama_pasien'
                      class='form-control autocomplete'",
                          "Cari RM / Nama Pasien","text"); 
                  ?>
              </div>
              <div class="col-md-3">
                  <label>Tanggal Lahir</label>
                  <?php
                 input_calendar("tgl_lahir","tgl_lahir",$tgl_lahir,"Masukkan Tanggal","");  
                  ?>
              </div>
              <div class="col-md-3">
                  <label>Jenis Kelamin</label>
                  <?php
                 input_pd("jk",$cmd_jk,$jk);
                  ?>
              </div>
            </div>
            <div class="col-md-12">
            <div class="col-md-3">
            	<label>Tanggal</label>
							<?php
								input_calendar("tgl_daftar","tgl_daftar",$tgl_daftar,"Masukkan Tanggal","");
							?>	
            </div>
            <div class="col-md-4">
            	<label>Tindakan / Pemeriksaan</label>
							<?php
								input_pdselect2("id_tindakan",$cmd_tindakan,$id_tindakan);
							?>	
            </div>  
            <div class="col-md-5">
            	<label>Dokter Tindakan</label>
							<?php
								input_pdselect2("dr_tindakan",$cmd_dokter,$dr_tindakan);
							?>	
            </div>
            <div class="col-md-12">
					  <label>Data Penunjang</label>
						<?php
							input_textareacustom("pasien_daftar",$pasien_daftar," id='editor1' rows='5' cols='100' class='form-control' ","");
						?>
            </div>
            <div class="col-md-6">
            	<label>Ruangan / Unit Pengirim</label>
							<?php
								input_pdselect2("unit_pengirim",$cmd_unit,$unit_pengirim);
							?>	
            </div>
            <div class="col-md-6">
            	<label>Dokter Pengirim</label>
							<?php
								input_pdselect2("dr_pengirim",$cmd_dokter,$dr_pengirim);
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
	CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
    $('#tgl_daftar').datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true
    })
	$("#tgl_daftar").inputmask("datetime", {
		mask: "1-2-y", 
		placeholder: "dd-mm-yyyy", 
		leapday: "-02-29", 
		separator: "-", 
		alias: "dd/mm/yyyy"
	});
var status=0;
$('#tgl_lahir').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_lahir").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$(document).ready(function() {
  $('.select2').select2()
      $('#nama_pasien').autocomplete({
        minChars : '3',
        type: 'GET',
        serviceUrl: '<?php echo base_url();?>jadwal_all/pasien_cari_data',
        dataType: 'json',
        onSelect: function (data) {
            document.getElementById("nama_pasien").value = data.data;
            $('#nama_pasien').val(data.nama_pasien);
            $('#rm').val(data.rm);
            $('#tgl_lahir').val(data.tgl_lahir);
            $('#jk').val(data.jk);
            $('#alamat').val(data.alamat);
            status=1;
        }
      });
      $('#rm').autocomplete({
        minChars : '3',
        type: 'GET',
        serviceUrl: '<?php echo base_url();?>jadwal_all/rm_cari_data',
        dataType: 'json',
        onSelect: function (data) {
            document.getElementById("rm").value = data.data;
            $('#nama_pasien').val(data.nama_pasien);
            $('#rm').val(data.rm);
            $('#tgl_lahir').val(data.tgl_lahir);
            $('#jk').val(data.jk);
            $('#alamat').val(data.alamat);
            status=1;
        }
      });
});
</script>
<?php
}
elseif ($page=="daftar_tindakan_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
    .autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
    .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
    .autocomplete-selected { background: #F0F0F0; }
    .autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
    .autocomplete-group { padding: 2px 5px; }
    .autocomplete-group strong { display: block; border-bottom: 1px solid #000; } 
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('jadwal_all/daftar_tindakan/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_daftar" value="<?= $id_daftar; ?>">
    <input type="hidden" name="id_pegawai" value="<?= $pendaftar; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Laporan Jaga</h3>
      </div>
        <div class="box-body">
            <div class="col-md-12">
              <div class="col-md-3">
                  <label>RM</label>
                  <?php
                 input_textcustom("rm",$rm," maxlength='15' required id='rm'
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control autocomplete'",
                          "RM","text");
                  ?>
              </div>
              <div class="col-md-3">
                  <label for="autocomplete">Cari Nama Pasien</label>
                  <?php
                input_textcustom("nama_pasien",$nama_pasien," maxlength='70' required id='nama_pasien'
                      class='form-control autocomplete'",
                          "Cari RM / Nama Pasien","text"); 
                  ?>
              </div>
              <div class="col-md-3">
                  <label>Tanggal Lahir</label>
                  <?php
                 input_calendar("tgl_lahir","tgl_lahir",$tgl_lahir,"Masukkan Tanggal","");  
                  ?>
              </div>
              <div class="col-md-3">
                  <label>Jenis Kelamin</label>
                  <?php
                 input_pd("jk",$cmd_jk,$jk);
                  ?>
              </div>
            </div>
            <div class="col-md-12">
            <div class="col-md-3">
            	<label>Tanggal</label>
							<?php
								input_calendar("tgl_daftar","tgl_daftar",$tgl_daftar,"Masukkan Tanggal","");
							?>	
            </div>
            <div class="col-md-4">
            	<label>Tindakan / Pemeriksaan</label>
							<?php
								input_pdselect2("id_tindakan",$cmd_tindakan,$id_tindakan);
							?>	
            </div>  
            <div class="col-md-5">
            	<label>Dokter Tindakan</label>
							<?php
								input_pdselect2("dr_tindakan",$cmd_dokter,$dr_tindakan);
							?>	
            </div>
            <div class="col-md-12">
					  <label>Data Penunjang</label>
						<?php
							input_textareacustom("pasien_daftar",$pasien_daftar," id='editor1' rows='5' cols='100' class='form-control' ","");
						?>
            </div>
            <div class="col-md-6">
            	<label>Ruangan / Unit Pengirim</label>
							<?php
								input_pdselect2("unit_pengirim",$cmd_unit,$unit_pengirim);
							?>	
            </div>
            <div class="col-md-6">
            	<label>Dokter Pengirim</label>
							<?php
								input_pdselect2("dr_pengirim",$cmd_dokter,$dr_pengirim);
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
	CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
    $('#tgl_daftar').datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true
    })
	$("#tgl_daftar").inputmask("datetime", {
		mask: "1-2-y", 
		placeholder: "dd-mm-yyyy", 
		leapday: "-02-29", 
		separator: "-", 
		alias: "dd/mm/yyyy"
	});
var status=0;
$('#tgl_lahir').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_lahir").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$(document).ready(function() {
  $('.select2').select2()
      $('#nama_pasien').autocomplete({
        minChars : '3',
        type: 'GET',
        serviceUrl: '<?php echo base_url();?>jadwal_all/pasien_cari_data',
        dataType: 'json',
        onSelect: function (data) {
            document.getElementById("nama_pasien").value = data.data;
            $('#nama_pasien').val(data.nama_pasien);
            $('#rm').val(data.rm);
            $('#tgl_lahir').val(data.tgl_lahir);
            $('#jk').val(data.jk);
            $('#alamat').val(data.alamat);
            status=1;
        }
      });
      $('#rm').autocomplete({
        minChars : '3',
        type: 'GET',
        serviceUrl: '<?php echo base_url();?>jadwal_all/rm_cari_data',
        dataType: 'json',
        onSelect: function (data) {
            document.getElementById("rm").value = data.data;
            $('#nama_pasien').val(data.nama_pasien);
            $('#rm').val(data.rm);
            $('#tgl_lahir').val(data.tgl_lahir);
            $('#jk').val(data.jk);
            $('#alamat').val(data.alamat);
            status=1;
        }
      });
});
</script>
<?php
}
elseif ($page=="daftar_tindakan_hasil")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('jadwal_all/daftar_tindakan/simpan_hasil');?>" onClick="return cek();">
    <input type="hidden" name="id_daftar" value="<?= $id_daftar; ?>">
    <input type="hidden" name="id_pegawai" value="<?= $pendaftar; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Hasil</h3>
      </div>
        <div class="box-body">
            <div class="col-md-12">
            	<label>Status</label>
							<?php
								input_pdselect2("status_daftar",$status,$status_daftar);
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
	CKEDITOR.replace('editorx', {enterMode: CKEDITOR.ENTER_BR});
    $(document).ready(function() {
    	$('.select2').select2()
	});
</script>
<?php
}
elseif ($page=="tindakan")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
		<a href="<?php echo $link_kembali;?>"
			class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Kembali
		</a>
		||
		<a href="<?php echo $link_awal;?>"
			class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Jadwal
		</a> ||
		<a href="<?php echo $link_daftar;?>"
			class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Laporan Jaga
		</a>
 ||
		<a href="<?php echo $link_tambahan;?>"
			class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Pengambilan Hasil
		</a>
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
            <th style="display:none;">ID</th>
            <th>Nama</th>
            <th>Golongan Pemeriksaan</th>
            <th style="text-align:right;">Harga</th>
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
elseif ($page=="tindakan_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('jadwal_all/tindakan/simpan_tambah');?>" onClick="return cek();">
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
              <div class="col-md-6">
                  <label>Nama</label>
                  <?php
                    input_text("nama_tindakan",$nama_tindakan,"maxlength='255' required autofocus","Masukkan Nama","text");
                  ?>  
              </div>  
        <div class="col-md-6">
            <label>Golongan Pemeriksaan</label>
            <?php
              input_pdselect2("id_golongan_pemeriksaan",$ambil_golongan,$id_golongan_pemeriksaan);
            ?>  
        </div>  
        <div class="col-md-6">
            <label>Tarif Tindakan</label>
            <?php
								input_textcustom("tarif",$tarif," style='text-align:right;' required 
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control' oninput='seprator(this)' ",
													"Harga","text");	
            ?>  
        </div> 
        <div class="col-md-6">
            <label>Status</label>
            <?php
              input_pdselect2("status_tindakan",$cmd_status,$status_tindakan);
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
$(document).ready(function() {
  $('.select2').select2()
}); 
function seprator(input) {
  let nums = input.value.replace(/,/g, '');
  if (!nums || nums.endsWith('.')) return;
  input.value = parseFloat(nums).toLocaleString();
}
</script>
<?php
}
elseif ($page=="tindakan_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('jadwal_all/tindakan/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_tindakan" value="<?= $id_tindakan; ?>">
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
              <div class="col-md-6">
                  <label>Nama</label>
                  <?php
                    input_text("nama_tindakan",$nama_tindakan,"maxlength='255' required autofocus","Masukkan Nama","text");
                  ?>  
              </div>  
        <div class="col-md-6">
            <label>Golongan Pemeriksaan</label>
            <?php
              input_pdselect2("id_golongan_pemeriksaan",$ambil_golongan,$id_golongan_pemeriksaan);
            ?>  
        </div>  
        <div class="col-md-6">
            <label>Tarif Tindakan</label>
            <?php
								input_textcustom("tarif",$tarif," style='text-align:right;' required 
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control' oninput='seprator(this)' ",
													"Harga","text");	
            ?>  
        </div> 
        <div class="col-md-6">
            <label>Status</label>
            <?php
              input_pdselect2("status_tindakan",$cmd_status,$status_tindakan);
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
function seprator(input) {
  let nums = input.value.replace(/,/g, '');
  if (!nums || nums.endsWith('.')) return;
  input.value = parseFloat(nums).toLocaleString();
}
</script>
<?php
}
elseif ($page=="pengirim")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
		<a href="<?php echo $link_kembali;?>"
			class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Kembali
		</a>
		||
		<a href="<?php echo $link_awal;?>"
			class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Jadwal
		</a> ||
		<a href="<?php echo $link_daftar;?>"
			class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Laporan Jaga
		</a>
 ||
		<a href="<?php echo $link_tambahan;?>"
			class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Pengambilan Hasil
		</a>
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
            <th style="display:none;width: 5%;">ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Kontak</th>
            <th>Alamat</th>
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
elseif ($page=="pengirim_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('jadwal_all/pengirim/simpan_tambah');?>" onClick="return cek();">
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
                  <div class="col-md-6">
                      <label>Nama</label>
                      <?php
                        input_text("nama_rujukan_dokter",$nama_rujukan_dokter,"maxlength='255' required autofocus","Masukkan Angka dan Huruf","text");
                      ?>  
                  </div>    
                  <div class="col-md-6">
                      <label>Email</label>
                        <?php
                          input_text("email_rujukan_dokter",$email_rujukan_dokter,"maxlength='255' ","Masukkan Angka dan Huruf","text");
                        ?>          
                  </div>
                  <div class="col-md-6">
                      <label>Kontak</label>
                        <?php
                          input_text("kontak_rujukan_dokter",$kontak_rujukan_dokter,"maxlength='255' ","Masukkan Angka dan Huruf","text");
                        ?>          
                  </div>    
                  <div class="col-md-6">
                      <label>Alamat</label>
                        <?php
                          input_text("alamat_rujukan_dokter",$alamat_rujukan_dokter,"maxlength='255' ","Masukkan Angka dan Huruf","text");
                        ?>          
                  </div>        
                </div>
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
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
elseif ($page=="pengirim_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('jadwal_all/pengirim/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_rujukan_dokter" value="<?= $id_rujukan_dokter; ?>">
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
                  <div class="col-md-6">
                      <label>Nama</label>
                      <?php
                        input_text("nama_rujukan_dokter",$nama_rujukan_dokter,"maxlength='255' required autofocus","Masukkan Angka dan Huruf","text");
                      ?>  
                  </div>   
                  <div class="col-md-6">
                      <label>Email</label>
                        <?php
                          input_text("email_rujukan_dokter",$email_rujukan_dokter,"maxlength='255' ","Masukkan Angka dan Huruf","text");
                        ?>          
                  </div>
                  <div class="col-md-6">
                      <label>Kontak</label>
                        <?php
                          input_text("kontak_rujukan_dokter",$kontak_rujukan_dokter,"maxlength='255' ","Masukkan Angka dan Huruf","text");
                        ?>          
                  </div>    
                  <div class="col-md-6">
                      <label>Alamat</label>
                        <?php
                          input_text("alamat_rujukan_dokter",$alamat_rujukan_dokter,"maxlength='255' ","Masukkan Angka dan Huruf","text");
                        ?>          
                  </div>        
                </div>
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
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