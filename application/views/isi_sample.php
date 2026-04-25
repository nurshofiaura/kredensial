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
  height: 600px;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
		<a href="<?php echo $link_kembali;?>"
			class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" > <i class="fa fa-reply"></i> Kembali
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
        <div class="box-body">
<div id="chartdiv"></div>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="normal")
{
?>
<style>
#chartdiv {
  width: 100%;
  height: 600px;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
		<a href="<?php echo $link_kembali;?>"
			class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" > <i class="fa fa-reply"></i> Kembali
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
    					  <th width="5%"></th>
    					  <th width="5%" style="display:none;">ID</th>
    					  <th>Nama Tindakan</th>
    					  <th>Subyek</th>
    					  <th>Radiolog</th>
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
			<?php echo form_open_multipart('sample/logbook/view/'.$first_date.'/'.$last_date,' id="signupform" '); ?>
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
			  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> collapsed-box box-solid">
				<div class="box-header with-border">
				  <h3 class="box-title">CATATAN SILAHKAN DIBACA <i class="fa fa-exclamation btn-xs btn-warning blinking"></i> ==== KLIK ======></h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
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
					</div>
					<!-- /.box-header -->
					<div style="font-weight:bold;color:red;" class="box-body">
						<ul>
						<li>BAGI YANG TIDAK MEMPUNYAI DATA PENUGASAN KLINIS SILAHKAN MASUK DI LOGBOOK NON KEPERAWATAN</li>
						<li>UNTUK SAMPLE LOGBOOK NON KEPERAWATAN / UMUM DI NON AKTIFKAN</li>
						<li>PRINT PDF UNTUK SAMPLE DI NON AKTIFKAN</li>
						<li>GUNAKAN RANGE / PERIODE TANGGAL UNTUK MELIHAT DATA LOGBOOK LAMA</li>
						<li>KEPERAWATAN YANG ADA DI SAMPLE PROFESI PERAWAT, BIDAN, ANESTESI</li>
						<li>PENGISIAN LOGBOOK BERDASARAKAN PK (PETUGAS KLINIS)</li>
						</ul>
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
					<a href="#" class="btn btn-white btn-md">
						<i class="fa fa-file-pdf-o"></i> HARIAN
					</a> ||
					<a href="#" class="btn btn-white btn-md">
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
							  <th style="text-align:center;vertical-align:middle;font-weight:bold;width:6%;">ID</th>
							  <th style="text-align:center;vertical-align:middle;font-weight:bold;width:7%;">Tanggal</th>
							  <th style="text-align:center;vertical-align:middle;font-weight:bold;">PK</th>
							  <th style="text-align:center;vertical-align:middle;font-weight:bold;">Nama Kewenangan</th>
							  <th style="text-align:center;vertical-align:middle;font-weight:bold;">JML</th>
							  <th style="text-align:center;vertical-align:middle;font-weight:bold;width:9%;">Karu</th>
							  <th style="text-align:center;vertical-align:middle;font-weight:bold;width:9%;">Kabid</th>
							  <th style="text-align:center;vertical-align:middle;font-weight:bold;width:9%;">Asesor</th>
							  <th style="text-align:center;vertical-align:middle;font-weight:bold;width:9%;">Komite</th>
							  <th style="text-align:center;vertical-align:middle;font-weight:bold;width:9%;">Direktur</th>
							  <th style="text-align:center;vertical-align:middle;font-weight:bold;width:9%;">Result Tolak</th>
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
	<?php echo form_open_multipart('sample/logbook/tambah/'.$first_date.'/'.$last_date.'/'.$id,' id="signupform" ');
	input_text("id_pegawai",$member_id,"","","hidden");
	input_text("first_date",$first_date,"","","hidden");
	input_text("last_date",$last_date,"","","hidden");
	?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">
			<button type="submit" class="btn btn-xs btn-primary">Submit</button>
		   </h3>
          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
		  <table id="example1" width="100%" class="table table-bordered table-striped">
			  <thead>
				<tr>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;">

					</th>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kewenangan</th>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kompetensi</th>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kode</th>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Sifat</th>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Ruangan</th>
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
					<td style="vertical-align:middle;"><?php echo $room_name; ?></td>
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
	<?php echo form_open_multipart('sample/logbook/isi/'.$first_date.'/'.$last_date.'/'.$id,' id="signupform" ');
	input_text("id_pegawai",$member_id,"","","hidden");
	input_text("first_date",$first_date,"","","hidden");
	input_text("last_date",$last_date,"","","hidden");
	?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
			<div class="col-md-3">
				<div class="form-group">
				  <label>Tanggal</label>
						<?php
							input_calendar("tgl_logbook","tgl_logbook",$tgl_logbook,"Masukkan Tanggal Transaksi","readonly required");
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
				?>
		<div class="row">
			<div class="col-md-2">
				<label><strong>Jumlah</strong></label>
				<?php $read = '';
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
elseif ($page=="v_karu")
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
			<?php echo form_open_multipart('sample/v_karu/view/'.$first_date.'/'.$last_date,' id="signupform" '); ?>
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
			  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> collapsed-box box-solid">
				<div class="box-header with-border">
				  <h3 class="box-title">CATATAN SILAHKAN DIBACA <i class="fa fa-exclamation btn-xs btn-warning blinking"></i> ==== KLIK ======></h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
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
					</div>
					<!-- /.box-header -->
					<div style="font-weight:bold;color:red;" class="box-body">
						<ul>
						<li>SEBELUM MELAKUKAN PENGAJUAN KOMPETENSI HARUS DI VALIDASI KEPALA RUANGAN DULU</li>
						<li>TIDAK DAPAT MEMVALIDASI YANG SUDAH DI VALIDASI KABID, ASESOR, KOMITE DAN DIREKTUR</li>
						<li>UNTUK MENCOBA VALIDASI KEPALA RUANGAN COBALAH MELAKUKAN PENGISIAN LOGBOOK</li>
						</ul>
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
							  <th style="text-align:center;vertical-align:middle;font-weight:bold;width:6%;">ID</th>
							  <th style="text-align:center;vertical-align:middle;font-weight:bold;width:7%;">Tanggal</th>
							  <th style="text-align:center;vertical-align:middle;font-weight:bold;">PK</th>
							  <th style="text-align:center;vertical-align:middle;font-weight:bold;">Nama Kewenangan</th>
							  <th style="text-align:center;vertical-align:middle;font-weight:bold;">JML</th>
							  <th style="text-align:center;vertical-align:middle;font-weight:bold;width:9%;">Karu</th>
							  <th style="text-align:center;vertical-align:middle;font-weight:bold;width:9%;">Kabid</th>
							  <th style="text-align:center;vertical-align:middle;font-weight:bold;width:9%;">Asesor</th>
							  <th style="text-align:center;vertical-align:middle;font-weight:bold;width:9%;">Komite</th>
							  <th style="text-align:center;vertical-align:middle;font-weight:bold;width:9%;">Direktur</th>
							  <th style="text-align:center;vertical-align:middle;font-weight:bold;width:9%;">Result Tolak</th>
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
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sample/pengajuan_kompetensi/simpan_tambah');?>" onClick="return cek();">
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
									<li>Siapkan file Etik Minimal 2x Penilaian Etik</li>
									<li>Semua berkas di upload di menu berkas sesuai kategorinya (Surat Ijin, Seminar dll, Ijasah dan berkas lainnya) dalam format PDF</li>
									<li>Semua berkas yang diupload tidak akan hilang dan dapat di download atau digunakan untuk pengajuan selanjutnya</li>
								</ul>
							  </div>
							</div>
						  </li>
						  <li>
							<i class="fa fa-user bg-aqua"></i>

							<div class="timeline-item">
							  <h3 class="timeline-header no-border">Logbook range tanggal awal dan akhir
							  </h3>
							</div>
						  </li>
						  <li>
							<i class="fa fa-comments bg-yellow"></i>

							<div class="timeline-item">
							  <h3 class="timeline-header">Pengiriman</h3>

							  <div class="timeline-body">
								<ul>
									<li>Lengkapi berkas dan logbook terlebih dahulu baru kemudian pengajuan dapat diajukan</li>
									<li>Selama pengajuan belum terkirim / belum lengkap maka tidak dapat mengajukan kompetensi baru</li>
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
						<?php
								input_text("id_pegawai",$member_id,"","","hidden");
						?>
						<div class="form-group">
						  <label>Pilih Status yang diusulkan</label>
							<?php
								input_pdselect2("id_status_diusulkan",$status_diusulkan_all,$id_status_diusulkan);
							?>
						</div>
						<button type="submit" class="btn btn-primary btn-block"><b>AJUKAN KOMPETENSI</b></button>
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
          <h3 class="box-title"><?php echo $title; ?></h3>
        </div>
        <div class="box-body">
		<?php echo form_open_multipart('sample/pengajuan_kompetensi/isi/'.$id,' ');
		input_text("id_pengajuan",$id_pengajuan,"","","hidden");
		?>
		<div class="row">
			<div class="col-md-5">
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
				  <h3 class="profile-username text-center"><?php echo $member_name; ?></h3>
				  <p class="text-muted text-center">PENGAJUAN KOMPETENSI</p>
					<div class="form-group">
						<?php
						if($status_pengajuan=="0"){
							input_pdselect2("id_status_diusulkan",$status_diusulkan_all,$id_status_diusulkan);
						}
						?>
					</div>
				  <ul class="list-group list-group-unbordered">
					<li class="list-group-item">
						<?php
							if($status_pengajuan=="0"){

							if($id_logbook_a!==""){
							?>
							<a href="<?php echo base_url('sample/berkas_logbook/view/01-'.date("m-Y").'/'.date("d-m-Y").'/'.$id_pengajuan);?>" class="btn bg-default btn-xs">Ganti ID Awal LogBook</a>
						<?php
							}else{
						?>
							<a href="<?php echo base_url('sample/berkas_logbook/view/01-'.date("m-Y").'/'.date("d-m-Y").'/'.$id_pengajuan);?>" class="btn bg-purple btn-xs">Pilih ID Awal LogBook</a>
						<?php
							}
						?>&nbsp;|
						<a href="#" class="btn bg-green btn-xs"><i class="fa fa-file-pdf-o"></i> pdf</a>
						&nbsp;|
						<div class="pull-right">
						<?php
							if($id_logbook_b!==""){
						?>
							<a href="<?php echo base_url('sample/berkas_logbook/view/01-'.date("m-Y").'/'.date("d-m-Y").'/'.$id_pengajuan);?>" class="btn bg-default btn-xs">Ganti ID Akhir LogBook</a>
						<?php
							}else{
						?>
							<a href="<?php echo base_url('sample/berkas_logbook/view/01-'.date("m-Y").'/'.date("d-m-Y").'/'.$id_pengajuan);?>" class="btn bg-purple btn-xs">Pilih ID Akhir LogBook</a>
						<?php
							}
						?>
						</div>
						<?php
							}else{
						?>
							<td colspan="2" style="vertical-align:middle;text-align:center;width:50%;">
									<a href="#"
									class="btn bg-purple btn-block btn-xs">
										<i class="fa fa-print"> &nbsp;PRINT LOGBOOK</i>
									</a>
							</td>
						<?php
							}
						?>
					</li>
					<li class="list-group-item">
						<?php
							if($status_pengajuan=="0"){
						?>
								<a href="<?php echo base_url('sample/berkas_ijasah/view/'.$id_pengajuan);?>" class="btn bg-green btn-block btn-xs">
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
								<a href="<?php echo base_url('sample/berkas_str/view/'.$id_pengajuan);?>" class="btn bg-green btn-block btn-xs">
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
								<a href="<?php echo base_url('sample/berkas_sertifikat/view/'.$id_pengajuan);?>" class="btn bg-green btn-block btn-xs">
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
									<a href="<?php echo base_url('sample/berkaslain_berkas/view/'.$id_pengajuan);?>" class="btn bg-green btn-block btn-xs">
									Pilih Berkas Lain (opsional)</a>
						<?php
							}else{
						?>
								<a class="btn bg-red btn-block btn-xs">	Berkas Opsional</a>
						<?php
							}
						?>
					</li>
				  </ul>

						<?php
								input_text("id_pengajuan",$id,"","","hidden");
						if($status_pengajuan=="0"){
						if(($ijasah !== '') AND ($str !== '') AND ($sertifikat !== '') AND
						($id_logbook_a !== '') AND ($id_logbook_b !== '') AND ($id_etik_pegawai !== '')){
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
			<div class="col-md-7">
			  <div class="nav-tabs-custom">
				<!-- Tabs within a box -->
				<ul class="nav nav-tabs pull-right">
				  <li class="active"><a href="#revenue-chart" data-toggle="tab"><i class="fa fa-folder-open"></i> File</a></li>
				  <li><a href="#sales-chart" data-toggle="tab"><i class="fa fa-pie-chart"></i> Grafik LogBook</a></li>
				  <li class="pull-left header"></li>
				  <li><a href="#tabel" data-toggle="tab"><i class="fa fa-pie-chart"></i> Tabel LogBook</a></li>
				</ul>
				<div class="tab-content no-padding">
				  <!-- Morris chart - Sales -->
				  <div class="chart tab-pane active" id="revenue-chart" style="position: relative;">
					  <div class="box box-primary">
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
								INI ADALAH SAMPLE, TIDAK DAPAT PRINT OUT PDF
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
								<th style="vertical-align:middle;text-align:center;font-weight:bold;"><i class="fa fa-search"></i></th>
							</tr>
						</thead>
						<tbody>
						<?php
							foreach($ambil_data_etik_pegawai_oppe as $rowambil_data_etik_pegawai_oppe){
						?>
						  <tr>
							<td style="vertical-align:middle;text-align:center;"><input name="id_etik_pegawai[]" value="<?php echo $rowambil_data_etik_pegawai_oppe['id_etik_pegawai']; ?>" checked="checked" type="checkbox"></td>
							<td style="vertical-align:middle;text-align:center;"><?php echo date('d-m-Y', strtotime($rowambil_data_etik_pegawai_oppe['tgl_etik_pegawai'])); ?></td>
							<td style="vertical-align:middle;text-align:center;"><?php echo $rowambil_data_etik_pegawai_oppe['hasil_etik']; ?></td>
							<td style="vertical-align:middle;text-align:center;"><?php echo $rowambil_data_etik_pegawai_oppe['nama_pegawai']; ?></td>
							<td style="vertical-align:middle;text-align:center;">
							<a href="#" class="btn bg-green btn-xs">
							<i class="fa fa-file-pdf-o"></i> pdf</a>
							</td>
						  </tr>
						<?php
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
				  <div class="chart tab-pane" id="sales-chart" style="position: relative;">
					  <div class="box-header with-border">
							<div id="chartdiv"></div>
					  </div>
						<div class="box-footer no-padding">
						  <div class="mailbox-controls">
							<!-- Check all button -->
							<div class="pull-right">
							 <font color="red"><i class="fa fa-check"></i> APABILA GRAFIK TIDAK MUNCUL RUBAH ID - AWAL DAN ID - AKHIR LOGBOOK </font>
							</div>
							<!-- /.pull-right -->
						  </div>
						</div>
				  </div>
				  <div class="chart tab-pane" id="tabel" style="position: relative;">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">
			<?php echo $title; ?> <small style="color:white;font-weight:bold;">  <?php echo $instance_name; ?> </small>
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
					  <th width="8%"></th>
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
				  </div>
				</div>
			  </div>
			</div>
		</div>
		<?php echo form_close(); ?>
      </div>
      </div>
    </section>
</div>
<style>
#chartdiv {
  width: 100%;
  height: 500px;
}
</style>
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
	<?php echo form_open_multipart('sample/berkas_logbook/view/'.$first_date.'/'.$last_date.'/'.$id,' id="signupform" ');
	input_text("id",$id,"","","hidden");
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
        <div class="box-footer">

        </div>
      </div>
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
elseif ($page=="v_kabid")
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
					  <th>Nama Pegawai</th>
					  <th>Tanggal</th>
					  <th>Status Diusulkan</th>
					  <th>Asesor</th>
					  <th>Validasi</th>
					  <th>Tanggal Validasi</th>
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
elseif ($page=="v_kabid_isi")
{
?>
<style>
#chartdiv {
  width: 100%;
  height: 500px;
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
        <div class="box-body">
	  <?php echo form_open_multipart('sample/v_kabid/isi/'.$id,' id="signupform" '); ;
				$url_thumbx=base_url().'assets/images/noavatar.jpg';
				$url_picbesarx=base_url().'assets/images/noavatar.jpg';
	  ?>
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
              <li><a href="#profil" data-toggle="tab">Profil</a></li>
              <li class="active"><a href="#tabel" data-toggle="tab">Tabel Logbook</a></li>
              <li><a href="#grafik" data-toggle="tab">Grafik Logbook</a></li>
              <li class="pull-left header"><i class="fa fa-th"></i> <?php echo $title; ?></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane" id="profil">
			<div class="row">
				<div class="col-md-6">
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

					  <h3 class="profile-username text-center"><?php echo $nama_pegawai; ?></h3>

					  <p class="text-muted text-center"></p>
					  <strong><i class="fa fa-book margin-r-5"></i> TTL / Umur</strong>
					  <p class="text-muted">

					  </p>
					  <strong><i class="fa fa-book margin-r-5"></i> Agama</strong>
					  <p class="text-muted">

					  </p>
					  <strong><i class="fa fa-book margin-r-5"></i> Marital Status</strong>
					  <p class="text-muted">

					  </p>
					  <strong><i class="fa fa-pencil margin-r-5"></i> No</strong>
					  <p>
						NIP : <br>
						NIRA / IBI :
					  </p>
					  <strong><i class="fa fa-book margin-r-5"></i> Pendidikan</strong>
					  <p class="text-muted">

					  </p>
					</div>
					<div class="box-footer">

					</div>
				  </div>
				</div>
				<div class="col-md-6">
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
					<div class="box-body">
						<div class="box-header with-border">
						  <h3 class="box-title">Profil</h3>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
						  <strong><i class="fa fa-phone margin-r-5"></i> No HP</strong>
						  <p class="text-muted">

						  </p>
						  <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>
						  <p class="text-muted">

						  </p>
						  <strong><i class="fa fa-book margin-r-5"></i> Status Pegawai</strong>
						  <p class="text-muted">

						  </p>
							<strong><i class="fa fa-map-marker margin-r-5"></i> Unit / Ruangan</strong>
						  <p class="text-muted">
							Ruangan Sample
						  </p>
							<strong><i class="fa fa-map-marker margin-r-5"></i> Jabatan Fungsional</strong>
						  <p class="text-muted">

						</p>
							<strong><i class="fa fa-map-marker margin-r-5"></i> Alamat</strong>
						  <p class="text-muted">

						  </p>
						</div>
					</div>
					<div class="box-footer">

					</div>
				  </div>
				</div>
				<div class="col-md-12">
				  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
					<div class="box-header with-border">
					   <h3 class="box-title">BERKAS</h3>

					  <div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
								title="Collapse">
						  <i class="fa fa-minus"></i></button>
						<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
						  <i class="fa fa-times"></i></button>
					  </div>
					</div>
					<div class="box-body">
						<div class="box-header with-border">
						  <h3 class="box-title">Berkas File</h3>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
						  <p><i class="fa fa-book margin-r-5"></i> Ijasah</p>
						  <?php
							if($id_ijasah!==""){
								foreach($ambil_berkas_data as $row){
									if (in_array($row['id_berkas'],$id_ijasah)) {
						  ?>
							<p><a href="#" class="label label-primary">
								<i class="fa fa-search"> <?php echo $row['nama_berkas']; ?></i>
							</a></p>
						  <?php
									}
								}
							}
						  ?>
						  <p><i class="fa fa-book margin-r-5"></i> Surat Ijin</p>
						  <?php
							if($id_str!==""){
								foreach($ambil_berkas_data as $row2){
									if (in_array($row2['id_berkas'],$id_str)) {
						  ?>
							<p><a href="#" class="label label-info">
								<i class="fa fa-search"> <?php echo $row2['nama_berkas']; ?></i>
							</a></p>
						  <?php
									}
								}
							}
						  ?>
						  <p><i class="fa fa-book margin-r-5"></i> Sertifikat</p>
						  <?php
							if($id_sertifikat!==""){
								foreach($ambil_berkas_data as $row3){
									if (in_array($row3['id_berkas'],$id_sertifikat)) {
						  ?>
							<p><a href="#" class="label label-success">
								<i class="fa fa-search"> <?php echo $row3['nama_berkas']; ?></i>
							</a></p>
						  <?php
									}
								}
							}

							if($id_berkas!==""){
								foreach($ambil_berkas_data as $row4){
									if (in_array($row4['id_berkas'],$id_berkas)) {
						  ?>
							<p><a href="#" class="label label-warning">
								<i class="fa fa-search"> </i> <?php echo $row4['nama_berkas']; ?>
							</a></p>
						  <?php
									}
								}
							}
						  ?>

							<div class="pull-right">
							 <i class="fa fa-search"></i> KLIK BERKAS UNTUK MELIHAT
							</div>
						</div>
					</div>
					<div class="box-footer">

					</div>
				  </div>
				</div>
				<div class="col-md-12">
				  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
					<div class="box-header with-border">
					   <h3 class="box-title">ETIK</h3>

					  <div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
								title="Collapse">
						  <i class="fa fa-minus"></i></button>
						<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
						  <i class="fa fa-times"></i></button>
					  </div>
					</div>
					<div class="box-body">
						<table width="100%" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th style="vertical-align:middle;text-align:center;font-weight:bold;">Tanggal</th>
									<th style="vertical-align:middle;text-align:center;font-weight:bold;">Hasil</th>
									<th style="vertical-align:middle;text-align:center;font-weight:bold;">Penguji</th>
									<th style="vertical-align:middle;text-align:center;font-weight:bold;"><i class="fa fa-search"></i></th>
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
								<a href="#" class="btn bg-green btn-xs">
								<i class="fa fa-file-pdf-o"></i> pdf</a>
								</td>
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
				</div>
			</div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane active" id="tabel">
						  <div class="box-tools pull-right">
							<?php
								input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
							?>
						  </div>
						<div class="box-body">
							<table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
								<thead>
									<tr>
					  <th>Nama</th>
					  <th>Tanggal</th>
					  <th>Jam</th>
					  <th>Kode</th>
					  <th>Nama Kewenangan</th>
					  <th>Jumlah</th>
					  <th>Validasi</th>
									</tr>
								</thead>
							</table>
						</div>
						<div class="box-footer">
						 <?php if($acc_logbook_kabid=='0'){ ?>
						 <font color="red"><strong>MOHON VALIDASI DAHULU SEBELUM KLIK SIMPAN DAN ACC</strong></font><br><br>
							<button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-check"></i> Simpan dan Acc</button>
						<?php
						 } ?>
						</div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="grafik">
				  <div class="box-header with-border">
<div id="chartdiv"></div>
				  </div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
        </div>
        <div class="box-footer">
 				<div class="box-footer no-padding">
				  <div class="mailbox-controls">
				<?php
				if($status_pengajuan=="1" AND $acc_kabid=="0" AND $acc_asesor=="0" AND $acc_komite=="0" AND $acc_direktur=="0" AND $acc_logbook_kabid=="1"){
				?>
				<div class="col-md-4">
					<button name="action" value="BtnOke" class="btn btn-primary btn-block">
						<i class="fa fa-check"></i> Simpan & Setuju
					</button>
				</div>
				<div class="col-md-4">
					<button name="action" value="BtnTolak" class="btn btn-primary btn-block">
						<i class="fa fa-close"></i> Simpan & Tolak
					</button>
				</div>
				<?php
				}
				?>
				  </div>
				</div>
        </div>
      </div>
	  <?php echo form_close(); ?>
    </section>
</div>
<?php
}
elseif ($page=="v_asesor")
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
					  <th>Nama Pegawai</th>
					  <th>Tanggal</th>
					  <th>Status DIusulkan</th>
					  <th>Validasi</th>
					  <th>Tanggal Validasi</th>
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
elseif ($page=="v_asesor_isi")
{
?>
<style>
#chartdiv {
  width: 100%;
  height: 500px;
}

</style>
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
	  <?php echo form_open_multipart('sample/v_asesor/isi/'.$id,' id="signupform" '); ;
				$url_thumbx=base_url().'assets/images/noavatar.jpg';
				$url_picbesarx=base_url().'assets/images/noavatar.jpg';
	  ?>
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
              <li><a href="#profil" data-toggle="tab">Profil</a></li>
              <li class="active"><a href="#tabel" data-toggle="tab">Tabel Logbook</a></li>
              <li><a href="#grafik" data-toggle="tab">Grafik Logbook</a></li>
              <li class="pull-left header"><i class="fa fa-th"></i> <?php echo $title; ?></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane" id="profil">
			<div class="row">
				<div class="col-md-6">
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

					  <h3 class="profile-username text-center"><?php echo $nama_pegawai; ?></h3>

					  <p class="text-muted text-center"></p>
					  <strong><i class="fa fa-book margin-r-5"></i> TTL / Umur</strong>
					  <p class="text-muted">

					  </p>
					  <strong><i class="fa fa-book margin-r-5"></i> Agama</strong>
					  <p class="text-muted">

					  </p>
					  <strong><i class="fa fa-book margin-r-5"></i> Marital Status</strong>
					  <p class="text-muted">

					  </p>
					  <strong><i class="fa fa-pencil margin-r-5"></i> No</strong>
					  <p>
						NIP : <br>
						NIRA / IBI :
					  </p>
					  <strong><i class="fa fa-book margin-r-5"></i> Pendidikan</strong>
					  <p class="text-muted">

					  </p>
					</div>
					<div class="box-footer">

					</div>
				  </div>
				</div>
				<div class="col-md-6">
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
					<div class="box-body">
						<div class="box-header with-border">
						  <h3 class="box-title">Profil</h3>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
						  <strong><i class="fa fa-phone margin-r-5"></i> No HP</strong>
						  <p class="text-muted">

						  </p>
						  <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>
						  <p class="text-muted">

						  </p>
						  <strong><i class="fa fa-book margin-r-5"></i> Status Pegawai</strong>
						  <p class="text-muted">

						  </p>
							<strong><i class="fa fa-map-marker margin-r-5"></i> Unit / Ruangan</strong>
						  <p class="text-muted">

						  </p>
							<strong><i class="fa fa-map-marker margin-r-5"></i> Jabatan Fungsional</strong>
						  <p class="text-muted">

						</p>
							<strong><i class="fa fa-map-marker margin-r-5"></i> Alamat</strong>
						  <p class="text-muted">

						  </p>
						</div>
					</div>
					<div class="box-footer">

					</div>
				  </div>
				</div>
				<div class="col-md-12">
				  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
					<div class="box-header with-border">
					   <h3 class="box-title">BERKAS</h3>

					  <div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
								title="Collapse">
						  <i class="fa fa-minus"></i></button>
						<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
						  <i class="fa fa-times"></i></button>
					  </div>
					</div>
					<div class="box-body">
						<div class="box-header with-border">
						  <h3 class="box-title">Berkas File</h3>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
						  <p><i class="fa fa-book margin-r-5"></i> Ijasah</p>
						  <?php
							if($id_ijasah!==""){
								foreach($ambil_berkas_data as $row){
									if (in_array($row['id_berkas'],$id_ijasah)) {
						  ?>
							<p><a href="#" class="label label-primary">
								<i class="fa fa-search"> <?php echo $row['nama_berkas']; ?></i>
							</a></p>
						  <?php
									}
								}
							}
						  ?>
						  <p><i class="fa fa-book margin-r-5"></i> Surat Ijin</p>
						  <?php
							if($id_str!==""){
								foreach($ambil_berkas_data as $row2){
									if (in_array($row2['id_berkas'],$id_str)) {
						  ?>
							<p><a href="#" class="label label-info">
								<i class="fa fa-search"> <?php echo $row2['nama_berkas']; ?></i>
							</a></p>
						  <?php
									}
								}
							}
						  ?>
						  <p><i class="fa fa-book margin-r-5"></i> Sertifikat</p>
						  <?php
							if($id_sertifikat!==""){
								foreach($ambil_berkas_data as $row3){
									if (in_array($row3['id_berkas'],$id_sertifikat)) {
						  ?>
							<p><a href="#" class="label label-success">
								<i class="fa fa-search"> <?php echo $row3['nama_berkas']; ?></i>
							</a></p>
						  <?php
									}
								}
							}

							if($id_berkas!==""){
								foreach($ambil_berkas_data as $row4){
									if (in_array($row4['id_berkas'],$id_berkas)) {
						  ?>
							<p><a href="#" class="label label-warning">
								<i class="fa fa-search"> </i> <?php echo $row4['nama_berkas']; ?>
							</a></p>
						  <?php
									}
								}
							}
						  ?>

							<div class="pull-right">
							 <i class="fa fa-search"></i> KLIK BERKAS UNTUK MELIHAT
							</div>
						</div>
					</div>
					<div class="box-footer">

					</div>
				  </div>
				</div>
				<div class="col-md-12">
				  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
					<div class="box-header with-border">
					   <h3 class="box-title">ETIK</h3>

					  <div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
								title="Collapse">
						  <i class="fa fa-minus"></i></button>
						<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
						  <i class="fa fa-times"></i></button>
					  </div>
					</div>
					<div class="box-body">
						<table width="100%" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th style="vertical-align:middle;text-align:center;font-weight:bold;">Tanggal</th>
									<th style="vertical-align:middle;text-align:center;font-weight:bold;">Hasil</th>
									<th style="vertical-align:middle;text-align:center;font-weight:bold;">Penguji</th>
									<th style="vertical-align:middle;text-align:center;font-weight:bold;"><i class="fa fa-search"></i></th>
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
								<a href="#" class="btn bg-green btn-xs" >
								<i class="fa fa-file-pdf-o"></i> pdf</a>
								</td>
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
				</div>
			</div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane active" id="tabel">
						  <div class="box-tools pull-right">
							<?php
								input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
							?>
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
					  <th>Validasi</th>
					  <th>Result Tolak</th>
									</tr>
								</thead>
							</table>
						</div>
						<div class="box-footer">
						 <?php if($acc_logbook_asesor=='0'){ ?>
						 <font color="red"><strong>MOHON VALIDASI DAHULU SEBELUM KLIK SIMPAN DAN ACC</strong></font><br><br>
							<button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-check"></i> Simpan dan Acc</button>
						<?php
						 } ?>
						</div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="grafik">
				  <div class="box-header with-border">
<div id="chartdiv"></div>
				  </div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
        </div>
        <div class="box-footer">
 				<div class="box-footer no-padding">
				  <div class="mailbox-controls">
				<?php
				if($status_pengajuan=="1" AND $acc_kabid=="1" AND $acc_asesor=="0" AND $acc_komite=="0" AND $acc_direktur=="0" AND $acc_logbook_asesor=="1"){
				?>
				<div class="col-md-4">
					<button name="action" value="BtnOke" class="btn btn-primary btn-block">
						<i class="fa fa-check"></i> Simpan & Setuju
					</button>
				</div>
				<div class="col-md-4">
					<button name="action" value="BtnTolak" class="btn btn-primary btn-block">
						<i class="fa fa-close"></i> Simpan & Tolak
					</button>
				</div>
				<?php
				}
				?>
				  </div>
				</div>
        </div>
      </div>
	  <?php echo form_close(); ?>
    </section>
</div>
<?php
}
elseif ($page=="v_komite")
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
			//	input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
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
					  <th>Tanggal</th>
					  <th>Komite</th>
					  <th><i class="fa fa-search"></i> Sub Kredensial</th>
					  <th><i class="fa fa-search"></i> Sub Mutu</th>
					  <th><i class="fa fa-search"></i> Sub Etika</th>
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
elseif ($page=="v_komite_isi")
{
?>
<style>
#chartdiv {
  width: 100%;
  height: 500px;
}
table td {
	word-wrap: break-word;
}
</style>
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
	  <?php echo form_open_multipart('sample/v_komite/isi/'.$id,' id="signupform" '); ;
				$url_thumbx=base_url().'assets/images/noavatar.jpg';
				$url_picbesarx=base_url().'assets/images/noavatar.jpg';
	  ?>
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
              <li><a href="#profil" data-toggle="tab">Profil</a></li>
              <li class="active"><a href="#tabel" data-toggle="tab">Tabel Logbook</a></li>
              <li><a href="#grafik" data-toggle="tab">Grafik Logbook</a></li>
              <li class="pull-left header"><i class="fa fa-th"></i> <?php echo $title; ?></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane" id="profil">
			<div class="row">
				<div class="col-md-6">
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

					  <h3 class="profile-username text-center"><?php echo $nama_pegawai; ?></h3>

					  <p class="text-muted text-center"></p>
					  <strong><i class="fa fa-book margin-r-5"></i> TTL / Umur</strong>
					  <p class="text-muted">

					  </p>
					  <strong><i class="fa fa-book margin-r-5"></i> Agama</strong>
					  <p class="text-muted">

					  </p>
					  <strong><i class="fa fa-book margin-r-5"></i> Marital Status</strong>
					  <p class="text-muted">

					  </p>
					  <strong><i class="fa fa-pencil margin-r-5"></i> No</strong>
					  <p>
						NIP : <br>
						NIRA / IBI :
					  </p>
					  <strong><i class="fa fa-book margin-r-5"></i> Pendidikan</strong>
					  <p class="text-muted">

					  </p>
					</div>
					<div class="box-footer">

					</div>
				  </div>
				</div>
				<div class="col-md-6">
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
					<div class="box-body">
						<div class="box-header with-border">
						  <h3 class="box-title">Profil</h3>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
						  <strong><i class="fa fa-phone margin-r-5"></i> No HP</strong>
						  <p class="text-muted">

						  </p>
						  <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>
						  <p class="text-muted">

						  </p>
						  <strong><i class="fa fa-book margin-r-5"></i> Status Pegawai</strong>
						  <p class="text-muted">

						  </p>
							<strong><i class="fa fa-map-marker margin-r-5"></i> Unit / Ruangan</strong>
						  <p class="text-muted">

						  </p>
							<strong><i class="fa fa-map-marker margin-r-5"></i> Jabatan Fungsional</strong>
						  <p class="text-muted">

						</p>
							<strong><i class="fa fa-map-marker margin-r-5"></i> Alamat</strong>
						  <p class="text-muted">

						  </p>
						</div>
					</div>
					<div class="box-footer">

					</div>
				  </div>
				</div>
				<div class="col-md-12">
				  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
					<div class="box-header with-border">
					   <h3 class="box-title">BERKAS</h3>

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
											<a href="#" class="btn bg-maroon btn-xs">
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
											<a href="#" class="btn bg-maroon btn-xs">
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
											<a href="#" class="btn bg-maroon btn-xs">
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
											<a href="#" class="btn bg-maroon btn-xs">
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
									<td colspan="2" style="vertical-align:middle;text-align:center;">LOGBOOK BISA LIHAT GRAFIK & TABEL </td>
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
												<a href="#" class="btn bg-green btn-xs" >
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
			</div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane active" id="tabel">
						  <div class="box-tools pull-right">
							<?php
								input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
							?>
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
					  <th>Asesor</th>
					  <th>Komite</th>
					  <th>Ditolak</th>
									</tr>
								</thead>
							</table>
						</div>
						<div class="box-footer">
						 <?php if($acc_logbook_komite=='0'){ ?>
						 <font color="red"><strong>MOHON VALIDASI DAHULU SEBELUM KLIK SIMPAN DAN ACC</strong></font><br><br>
							<button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-check"></i> Simpan dan Acc</button>
						<?php
						 } ?>
						</div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="grafik">
				  <div class="box-header with-border">
<div id="chartdiv"></div>
				  </div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
        </div>
        <div class="box-footer">
 				<div class="box-footer no-padding">
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
				<?php
				if($status_pengajuan=="1" AND $acc_kabid=="1" AND $acc_asesor=="1" AND $acc_komite=="0" AND $acc_direktur=="0" AND $acc_logbook_komite=="0"){
				?>
					<button type="submit" name="action" value="BtnSimpan" class="btn btn-app">
						<i class="fa fa-save"></i> Simpan
					</button>	||
					<button type="button" class="btn btn-default btn-sm checkbox-toggle">
					<strong>
					<i class="fa fa-exclamation btn btn-warning blinking"></i> <font color="red">SIMPAN DATA SAJA TANPA ACC</font> <font color="green">(UNTUK KEPERLUAN TES KREDENSIAL, MUTU DAN ETIKA)</font> <font color="red">SETELAH ITU SIMPAN DAN ACC</font>
					</strong>
					</button>
				<?php
				}
				?>
				  </div>
				</div>
        </div>
      </div>
	  <?php echo form_close(); ?>
    </section>
</div>
<?php
}
elseif ($page=="v_direktur")
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
			//	input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
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
					  <th>Tanggal</th>
					  <th>Direktur</th>
					  <th><i class="fa fa-search"></i> Sub Kredensial</th>
					  <th><i class="fa fa-search"></i> Sub Mutu</th>
					  <th><i class="fa fa-search"></i> Sub Etika</th>
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
elseif ($page=="v_direktur_isi")
{
?>
<style>
#chartdiv {
  width: 100%;
  height: 500px;
}
table td {
	word-wrap: break-word;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?>
		<small><span class="btn btn-warning btn-xs blinking"><i class="fa fa-exclamation"></i></span> <span class="rainbow-text">
		<strong>JIKA NAMA DIREKTUR KOSONG VALIDASI TIDAK DAPAT DILAKUKAN</strong></span></small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">
					<span class="blinking"><i class="fa fa-exclamation"></i></span>
					Direktur :
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
	  <?php echo form_open_multipart('sample/v_direktur/isi/'.$id,' id="signupform" '); ;
				$url_thumbx=base_url().'assets/images/noavatar.jpg';
				$url_picbesarx=base_url().'assets/images/noavatar.jpg';
	  ?>
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
              <li><a href="#profil" data-toggle="tab">Profil</a></li>
              <li class="active"><a href="#tabel" data-toggle="tab">Tabel Logbook</a></li>
              <li><a href="#grafik" data-toggle="tab">Grafik Logbook</a></li>
              <li class="pull-left header"><i class="fa fa-th"></i> <?php echo $title; ?></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane" id="profil">
			<div class="row">
				<div class="col-md-6">
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

					  <h3 class="profile-username text-center"><?php echo $nama_pegawai; ?></h3>

					  <p class="text-muted text-center"></p>
					  <strong><i class="fa fa-book margin-r-5"></i> TTL / Umur</strong>
					  <p class="text-muted">

					  </p>
					  <strong><i class="fa fa-book margin-r-5"></i> Agama</strong>
					  <p class="text-muted">

					  </p>
					  <strong><i class="fa fa-book margin-r-5"></i> Marital Status</strong>
					  <p class="text-muted">

					  </p>
					  <strong><i class="fa fa-pencil margin-r-5"></i> No</strong>
					  <p>
						NIP : <br>
						NIRA / IBI :
					  </p>
					  <strong><i class="fa fa-book margin-r-5"></i> Pendidikan</strong>
					  <p class="text-muted">

					  </p>
					</div>
					<div class="box-footer">

					</div>
				  </div>
				</div>
				<div class="col-md-6">
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
					<div class="box-body">
						<div class="box-header with-border">
						  <h3 class="box-title">Profil</h3>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
						  <strong><i class="fa fa-phone margin-r-5"></i> No HP</strong>
						  <p class="text-muted">

						  </p>
						  <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>
						  <p class="text-muted">

						  </p>
						  <strong><i class="fa fa-book margin-r-5"></i> Status Pegawai</strong>
						  <p class="text-muted">

						  </p>
							<strong><i class="fa fa-map-marker margin-r-5"></i> Unit / Ruangan</strong>
						  <p class="text-muted">

						  </p>
							<strong><i class="fa fa-map-marker margin-r-5"></i> Jabatan Fungsional</strong>
						  <p class="text-muted">

						</p>
							<strong><i class="fa fa-map-marker margin-r-5"></i> Alamat</strong>
						  <p class="text-muted">

						  </p>
						</div>
					</div>
					<div class="box-footer">

					</div>
				  </div>
				</div>
				<div class="col-md-12">
				  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
					<div class="box-header with-border">
					   <h3 class="box-title">BERKAS</h3>

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
											<a href="#" class="btn bg-maroon btn-xs">
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
											<a href="#" class="btn bg-maroon btn-xs">
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
											<a href="#" class="btn bg-maroon btn-xs">
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
											<a href="#" class="btn bg-maroon btn-xs">
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
									<td colspan="2" style="vertical-align:middle;text-align:center;">LOGBOOK BISA LIHAT GRAFIK & TABEL </td>
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
												<a href="#" class="btn bg-green btn-xs" >
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

					</div>
				  </div>
				</div>
			</div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane active" id="tabel">
						  <div class="box-tools pull-right">
							<?php
								input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
							?>
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
					  <th>Direktur</th>
									</tr>
								</thead>
							</table>
						</div>
						<div class="box-footer">
						 <?php if($acc_logbook_direktur=='0'){ ?>
						 <font color="red"><strong>MOHON VALIDASI DAHULU SEBELUM KLIK SIMPAN DAN ACC</strong></font><br><br>
							<button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-check"></i> Simpan dan Acc</button>
						<?php
						 } ?>
						</div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="grafik">
				  <div class="box-header with-border">
<div id="chartdiv"></div>
				  </div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
        </div>
        <div class="box-footer">
 				<div class="box-footer no-padding">
				  <div class="mailbox-controls">
				<?php
				if($status_pengajuan=="1" AND $acc_kabid=="1" AND $acc_asesor=="1" AND $acc_komite=="1" AND $acc_direktur=="0" AND $acc_logbook_direktur=="1"){
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
	  <?php echo form_close(); ?>
    </section>
</div>
<?php
}
elseif ($page=="abk")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
	<?php echo form_open_multipart('sample/abk/view/'.$id,' id="signupform" '); ;
	?>
	  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
		<div class="box-header with-border">
		  <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
		</div>
		  <div class="box-body">
				<div class="col-md-12">
					<div class="form-group">
					  <label>Periode</label>
							<?php
								input_pdselect2fleksibel("id","id",$year_periode,"periode","periode",$id,"Silahkan Pilih Periode");
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
					  <th width="10%">No Urut</th>
					  <th width="10%">Periode</th>
					  <th>Nama Jabatan</th>
					  <th>Atasan Langsung</th>
					  <th>PNS</th>
					  <th>CPNS</th>
					  <th>BLUD</th>
					  <th>ABK</th>
					  <th>+ / -</th>
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
      <div class="modal-body" style="padding:10px; font-size:10px;">

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
elseif ($page=="abk_periode")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sample/abk/simpan_periode');?>" onClick="return cek();">
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
					<label>Jabatan</label>
						<?php
							input_pdselect2fleksibel("id_jabatan","id_jabatan",$cmd_jabatan_null,"id_jabatan","nama_jabatan",$id_jabatan,"Jika Mencari Jabfung Lain");
						?>
					</div>
					<div class="form-group">
					<label>Nama Jabatan Fungsional</label>
					<?php
						input_pdselect2("id_jabatan_fungsional",$cmd_jabatan_fungsional,$id_jabatan_fungsional);
					?>
					</div>
					<div class="form-group">
					<label>Periode</label>
					<?php
						input_pdselect2("periode",$cmd_range_tahun,$periode);
					?>
					</div>
					<div class="form-group">
					<label>Atasan Langsung</label>
					<?php
						input_pdselect2("id_struktur_jabatan",$cmd_struktur_jabatan,$id_struktur_jabatan);
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
		$('select[name=id_jabatan]').on('change',function(){
			$.ajax({
				url:'<?php echo base_url();?>sample/jabfung/'+$(this).val(),
				type: "POST",
				dataType: 'json'
			 }).done(function(data) {
				// alert(data[0]["nama_kab"]);
				// $('select[name=id_kab]').html(data);
				   var len = data.length;
	// alert("id="+data[1]["id_kab"]+" nama="+data[1]["nama_kab"]);
					$("#id_jabatan_fungsional").empty();
					for( var i = 0; i<len; i++){
						var id = data[i]["id_jabatan_fungsional"];
						var name = data[i]["nama_jabatan_fungsional"];

						$("#id_jabatan_fungsional").append("<option value='"+id+"'>"+name+"</option>");

					}
			 }).fail(function() {

			 }).always(function() {

			});
		});
});
</script>
<?php
}
elseif ($page=="abk_isi")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
	<?php echo form_open_multipart('sample/abk/isi/'.$id,' id="signupform" '); ;
	input_text("id_abk_detil",$id,"","","hidden");
	?>
	  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
		<div class="box-header with-border">
		  <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
		</div>
		  <div class="box-body">
			  <div class="row">
				  <div class="col-md-2">
						<div class="form-group">
						  <label>Periode</label>
							<?php
								input_text("periode",$periode,"readonly ","","text");
							?>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
						  <label>Ruangan / Unit</label>
							<?php
								input_text("nama_unit",$nama_unit,"readonly ","","text");
							?>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
						  <label>Atasan Langsung</label>
							<?php
								input_text("nama_struktur_jabatan",$nama_struktur_jabatan,"readonly ","","text");
							?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
						  <label>Nama Jabatan</label>
							<?php
								input_text("nama_jabatan_fungsional",$nama_jabatan_fungsional,"readonly ","","text");
							?>
						</div>
					</div>
                </div>
		  </div>
	  </div>

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
			  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
				<div class="box-header with-border">
				   <h3 class="box-title">URAIAN BUTIR KEGIATAN</h3>

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
							  <th style="vertical-align:middle;width:5%;"></th>
							  <th style="vertical-align:middle;">Uraian Tugas</th>
							  <th style="vertical-align:middle;">AK</th>
							  <th style="vertical-align:middle;">Satuan Hasil</th>
							  <th style="vertical-align:middle;">Formasi</th>
							</tr>
						</thead>
					</table>
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
<div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $header; ?> <small><?php echo $instance_name; ?></small></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php
}
elseif ($page=="abk_pilih_bk")
{
?>
      <div class="row">
        <div class="col-md-12">
		<FORM method="POST" class="form-horizontal" action="<?php echo base_url('sample/abk/simpan_pilih_bk');?>" onClick="return cek();">
          <input type="hidden" name="id_abk_detil" value="<?= $id; ?>">
		  <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
				<div class="col-md-12">
						<table id="example1" width="100%" class="table table-bordered table-striped">
						  <thead>
							<tr>
								  <tr>
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;">
										<input name="select_all" class="checkall" type="checkbox" />
									</th>
									  <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Butir Kegiatan</th>
									  <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Angka Kredit</th>
									  <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Satuan Hasil</th>
								  </tr>
						  </thead>
						  <tbody>
								<?php
									foreach($butir_kegiatan_all as $row){
								?>
							<tr>
									<td style="vertical-align:middle;">
									  <div class="checkbox">
										<label>
										  <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_butir_kegiatan'];?>"
											<?php if(in_array($row['id_butir_kegiatan'],explode(",", $id_butir_kegiatan))) echo 'checked="checked"'; ?> >
										</label>
									  </div>
									</td>
									<td style="vertical-align:middle;"><?php echo $row['nama_butir_kegiatan'];?></td>
									<td style="vertical-align:middle;"><?php echo $row['angka_kredit'];?></td>
									<td style="vertical-align:middle;"><?php echo $row['satuan_hasil'];?></td>
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
		</FORM>
	  </div>
<script type="text/javascript">
    $(document).ready(function() {
		$('.checkall').on('click', function() {
			$('.child').prop('checked', this.checked)
		});
		$('#example1').DataTable({
		  "initComplete": function (settings, json) {
			$("#example1").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");
		  },
      'paging'      	: false,
      'lengthChange'	: false,
      'searching'   	: false,
      'ordering'    	: false,
      'info'        	: true,
//	  'scrollX'			: true,
//	  'scrollY'			: '500px',
	  'scrollCollapse'	: true
		})
	});
</script>
<?php
}
elseif ($page=="abk_formasi")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small> <?php echo $instance_name; ?></small>
      </h1>
    </section>
    <section class="content">
	<?php echo form_open_multipart('sample/abk/formasi/'.$id.'/'.$id_bk_detil,' ');
	input_text("id_butir_kegiatan",$id_butir_kegiatan,"","","hidden");
	input_text("id_abk_detil",$id,"","","hidden");
	input_text("id_bk_detil",$id_bk_detil,"","","hidden");
	  ?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>
          <div class="box-tools pull-right">
			  <label id="text_ms_formasi">Formasi</label>
				<?php
					input_textcustom("formasi",$formasi," class='form-control input-sm' id='formasi' required onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46' maxlength='7' autocomplete='off' ","","text");
				?>
          </div>
        </div>
        <div class="box-body">
				<div class="col-md-4">
					<div class="form-group">
					  <label>Jenis Uraian Tugas</label>
						<?php
							input_pdselect2("status_butir_kegiatan",$option,$status_butir_kegiatan);
						?>
					</div>
                </div>
				<div class="col-md-8">
					<div class="form-group">
					  <label id="text_nama_butir_kegiatan">Butir Kegiatan</label>
						<?php
							input_text("nama_butir_kegiatan",$nama_butir_kegiatan,"maxlength='255' autofocus readonly required","Masukkan Butir Kegiatan","text");
						?>
					</div>
                </div>
					<div class="col-md-2">
						<div class="form-group">
						  <label id="text_ms_vol1th">Volume 1 Tahun</label>
							<?php
								input_textcustom("vol1th",$vol1th," class='form-control' id='vol1th' required onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46' maxlength='7' autocomplete='off' ","","text");
							?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
						  <label id="text_ms_keterangan_jumlah">Keterangan Jumlah</label>
							<?php
								input_textcustom("keterangan_jumlah",$keterangan_jumlah," class='form-control' id='keterangan_jumlah' required onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46' maxlength='7' autocomplete='off' ","","text");
							?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
						  <label>Satuan Hasil</label>
							<?php
								input_text("satuan_hasil",$satuan_hasil,"maxlength='255' required","Masukkan Satuan Hasil","text");
							?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
						  <label id="text_ms_konstanta">Konstanta</label>
							<?php
								input_textcustom("konstanta",$konstanta," class='form-control' id='konstanta' required onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46' maxlength='7' autocomplete='off' ","","text");
							?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
						  <label id="text_ms_wpk">Waktu Penyelesaian Kegiatan</label>
							<?php
								input_textcustom("wpk",$wpk," class='form-control' id='wpk' required onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46' maxlength='7' autocomplete='off' ","","text");
							?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
						  <label id="text_ms_jam_efektif">Jam Kerja Efektif 1 Thn</label>
							<?php
								input_textcustom("jam_efektif",$jam_efektif," class='form-control' id='jam_efektif' required onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46' maxlength='7' autocomplete='off' ","","text");
							?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
						  <label id="text_ms_angka_kredit">Angka Kredit</label>
							<?php
								input_textcustom("angka_kredit",$angka_kredit," class='form-control' id='angka_kredit' required readonly onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46' maxlength='7' autocomplete='off' ","","text");
							?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
						  <label id="text_ms_wpv">Waktu Penyelesaian Volume</label>
							<?php
								input_textcustom("wpv",$wpv," class='form-control' id='wpv' required onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46' maxlength='7' autocomplete='off' ","","text");
							?>
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
elseif ($page=="abk_urutan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sample/abk/simpan_urutan');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">
          <input type="hidden" name="id_abk_detil" value="<?= $id; ?>">

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
					  <label>Periode</label>
						<?php
							input_text("periode",$periode,"readonly ","","text");
						?>
					</div>
					  <div class="form-group">
						<label>Nama Jabatan</label>
						<?php
							input_text("nama_jabatan_fungsional",$nama_jabatan_fungsional,"readonly ","","text");
						?>
					  </div>
					  <div class="form-group">
						<label>No Urut</label>
						<?php
							input_textcustom("no_urut",$no_urut," class='form-control' onkeypress='return event.keyCode > 47 && event.keyCode < 58' maxlength='4' autocomplete='off' id='periode' ","","text");
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
elseif ($page=="abk_isi_pegawai")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sample/abk/simpan_isi_pegawai');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">
			<input type="hidden" name="id_abk_detil" value="<?= $id; ?>">
			<input type="hidden" name="periode" value="<?= $periode; ?>">
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
					  <label>PEGAWAI PNS</label>
						<?php
							input_textcustom("pns",$pns," class='form-control' onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength='4' autocomplete='off' ","","text");
						?>
					</div>
					<div class="form-group">
					  <label>PEGAWAI CPNS</label>
						<?php
							input_textcustom("cpns",$cpns," class='form-control' onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength='4' autocomplete='off' ","","text");
						?>
					</div>
					<div class="form-group">
					  <label>PEGAWAI BLUD</label>
						<?php
							input_textcustom("blud",$blud," class='form-control' onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength='4' autocomplete='off' ","","text");
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
elseif ($page=="abk_pemenuhan_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sample/abk/simpan_pemenuhan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">
			<input type="hidden" name="id_jabatan_fungsional" value="<?= $id_jabatan_fungsional; ?>">
			<input type="hidden" name="id_unit" value="<?= $id_unit; ?>">
			<input type="hidden" name="periode_lama" value="<?= $periode_lama; ?>">
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
					  <label>Periode</label>
						<?php
							input_pdselect2("periode",$cmd_range_tahun,$periode);
						?>
					</div>
					<div class="form-group">
					  <label>Rencana Jumlah Pemenuhan</label>
						<?php
							input_textcustom("jml_pemenuhan",$jml_pemenuhan," class='form-control' onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength='4' autocomplete='off' ","","text");
						?>
					</div>
					<div class="form-group">
					  <label>Jika Ada Realisasi Pemenuhan</label>
						<?php
							input_textcustom("jml_realisasi",$jml_realisasi," class='form-control' onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength='4' autocomplete='off' ","","text");
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
elseif ($page=="abk_pemenuhan_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sample/abk/simpan_pemenuhan_edit');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right"><input type="hidden" name="periodex" value="<?= $id_bk_detil; ?>">
          </div>
        </div>
		<div class="box-body">
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title"><?php $title; ?></h3>
			</div>
			  <div class="box-body">
			<?php
				$h01 = $id_bk_detil - 1;
				$h = $id_bk_detil;
				$h1 = $id_bk_detil + 1;
				$h2 = $id_bk_detil + 2;
				$exp = [$h01,$h,$h1,$h2];
				$imp = implode(",", $exp);
				$terpilih = explode(",", $imp);
			foreach($ambil_abk_pemenuhan as $row){
				if(in_array(date('Y', strtotime($row['periode_pemenuhan'])), $terpilih)){
				input_text("id_abk_pemenuhan[]",$row['id_abk_pemenuhan'],"","","hidden");
			?>
		<div class="row">
			<div class="col-md-2">
				<label>Periode</label>
				<?php input_text("periode",date('Y', strtotime($row['periode_pemenuhan'])),"readonly maxlength='255'","Masukkan Nama","text"); ?>
			</div>
			<div class="col-md-4">
				  <label>Rencana Jumlah Pemenuhan</label>
					<?php
						input_textcustom("jml_pemenuhan[]",$row['jml_pemenuhan']," class='form-control' onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength='4' autocomplete='off' ","","text");
					?>
			</div>
			<div class="col-md-6">
				  <label>Jika Ada Realisasi Pemenuhan</label>
					<?php
						input_textcustom("jml_realisasi[]",$row['jml_realisasi']," class='form-control' onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength='4' autocomplete='off' ","","text");
					?>
			</div>
		</div><br>
			<?php
				}
			}
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
</script>
<?php
}
elseif ($page=="abk_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sample/abk/simpan_edit');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">
          <input type="hidden" name="id_abk_detil" value="<?= $id; ?>">
          <input type="hidden" name="id_abk" value="<?= $id_abk; ?>">
          <input type="hidden" name="periode_lama" value="<?= $periode; ?>">
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
					  <label>Periode</label>
						<?php
							input_pdselect2("periode",$cmd_range_tahun,$periode);
						?>
					</div>
					  <div class="form-group">
						<label>Nama Jabatan</label>
						<?php
							input_pdselect2("id_jabatan_fungsional",$cmd_jabatan_fungsional,$id_jabatan_fungsional);
						?>
					  </div>
					  <div class="form-group">
						<label>Atasan Langsung</label>
						<?php
							input_pdselect2("id_struktur_jabatan",$cmd_struktur_jabatan,$id_struktur_jabatan);
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
