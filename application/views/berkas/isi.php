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
elseif ($page=="surat_ijin")
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
        <?php echo $header; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
	<?php echo form_open_multipart('berkas/surat_ijin/view/'.$id,' id="signupform" '); ?>
	  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
		<div class="box-header with-border">
		  <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
		</div>
		  <div class="box-body">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
					  <label>Status</label>
							<?php
								input_pdselect2("id",$cmd_expired,$id);
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
           <h3 class="box-title">
		   <?php
		   if($level_id == '19'){
			   echo $title;
		   }else{
		   ?>
			<a href="<?php echo base_url('berkas/surat_ijin/pdf/'); ?><?php echo $id;?>" target="_blank" class="btn btn-white btn-md">
				<i class="fa fa-print"></i> PDF
			</a>
			||
			<a href="<?php echo base_url('berkas/surat_ijin/xls/'); ?><?php echo $id;?>" target="_blank" class="btn btn-white btn-md">
				<i class="fa fa-print"></i> Excell
			</a>
			<?php
		   }
			?>
			</h3>
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
					  <th>Expired</th>
					  <th>Nama</th>
					  <th>Nama Berkas</th>
					  <th>No STR/SIK/SIP</th>
					  <th>Link</th>
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
	<?php echo form_open_multipart('berkas/berkas/view/'.$id,' id="signupform" '); ?>
	  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
		<div class="box-header with-border">
		  <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
		</div>
		  <div class="box-body">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
					  <label>Kategori</label>
							<?php
								input_pdselect2fleksibel("id","id",$ambil_kategori_berkas,"id_kategori_berkas","nama_kategori_berkas",$id,"Semua");
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
           <h3 class="box-title">
		   <?php
		   if($level_id == '19'){
			   echo $title;
		   }else{
		   ?>
			<a href="<?php echo base_url('berkas/berkas/pdf/'.$id); ?>" target="_blank" class="btn btn-white btn-md">
				<i class="fa fa-print"></i> PDF
			</a>
			||
			<a href="<?php echo base_url('berkas/berkas/xls/'.$id); ?>" target="_blank" class="btn btn-white btn-md">
				<i class="fa fa-print"></i> Excell
			</a>
			<?php
		   }
			?></h3>
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
#chartdiv {
  width: 100%;
  height: 500px;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
	<?php echo form_open_multipart('berkas/ijasah/view/'.$id,' id="signupform" '); ?>
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
								input_pdselect2fleksibel("id","id",$cmd_pegawai_null,"barcode_pegawai","nama_pegawai",$id,"Semua");
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
           <h3 class="box-title">
		   <?php
		   if($level_id == '19'){
			   echo $title;
		   }else{
		   ?>
			<a href="<?php echo base_url('berkas/ijasah/pdf/'); ?>" target="_blank" class="btn btn-white btn-md">
				<i class="fa fa-print"></i> PDF
			</a>
			||
			<a href="<?php echo base_url('berkas/ijasah/xls/'); ?>" target="_blank" class="btn btn-white btn-md">
				<i class="fa fa-print"></i> Excell
			</a>
			<?php
		   }
			?></h3>
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
					  <th style="vertical-align:middle;width:5%;">ID</th>
					  <th style="vertical-align:middle;">Nama</th>
					  <th style="vertical-align:middle;">Pendidikan</th>
					  <th style="vertical-align:middle;">Nama Instansi</th>
					  <th style="vertical-align:middle;">No Ijasah</th>
					  <th style="vertical-align:middle;">Lulus Tahun</th>
					  <th style="vertical-align:middle;">link</th>
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
elseif ($page=="pelatihan")
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
	<?php echo form_open_multipart('berkas/pelatihan/view/'.$first_date.'/'.$last_date.'/'.$id_kategori_pelatihan.'/'.$id_unit,' id="signupform" '); ?>
	  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
		<div class="box-header with-border">
		  <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
		</div>
		  <div class="box-body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
					  <label>Kategori</label>
							<?php
								input_pdselect2fleksibel("id_kategori_pelatihan","id_kategori_pelatihan",$kategori_pelatihan,"id_kategori_pelatihan","nama_kategori_pelatihan",$id_kategori_pelatihan,"Semua");
							?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					  <label>Ruangan</label>
							<?php
								input_pdselect2fleksibel("id_unit","id_unit",$cmd_ruangan,"id_ruangan","nama_ruangan",$id_unit,"Semua");
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
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">
		   <?php
		   if($level_id == '19'){
			   echo $title;
		   }else{
		   ?>
			<a href="<?php echo base_url('berkas/pelatihan/pdf/'); ?><?php echo $first_date;?>/<?php echo $last_date;?>/<?php echo $id_kategori_pelatihan;?>/<?php echo $id_unit;?>" target="_blank" class="btn btn-white btn-md">
				<i class="fa fa-print"></i> PDF
			</a>
			||
			<a href="<?php echo base_url('berkas/pelatihan/xls/'); ?><?php echo $first_date;?>/<?php echo $last_date;?>/<?php echo $id_kategori_pelatihan;?>/<?php echo $id_unit;?>" target="_blank" class="btn btn-white btn-md">
				<i class="fa fa-print"></i> Excell
			</a>
			<?php
		   }
			?>
			</h3>
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
					  <th style="vertical-align:middle;width:5%;"></th>
					  <th style="vertical-align:middle;">Mulai</th>
					  <th style="vertical-align:middle;">Sampai</th>
					  <th style="vertical-align:middle;">Pegawai</th>
					  <th style="vertical-align:middle;">Ruangan</th>
					  <th style="vertical-align:middle;">Kategori</th>
					  <th style="vertical-align:middle;">link</th>
					</tr>
				</thead>
			</table>
        </div>
        <div class="box-footer">

        </div>
      </div>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">GRAFIK</h3>
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
elseif ($page=="pengembangan_profesi")
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
	<?php echo form_open_multipart('berkas/pengembangan_profesi/view/'.$first_date.'/'.$last_date.'/'.$id_kategori_pelatihan.'/'.$id_pegawai,' id="signupform" '); ?>
	  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
		<div class="box-header with-border">
		  <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
		</div>
		  <div class="box-body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
					  <label>Kategori</label>
							<?php
								input_pdselect2fleksibel("id_kategori_pelatihan","id_kategori_pelatihan",$kategori_pelatihan,"id_kategori_pelatihan","nama_kategori_pelatihan",$id_kategori_pelatihan,"Semua");
							?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					  <label>Pegawai</label>
							<?php
								input_pdselect2fleksibel("id_pegawai","id_pegawai",$cmd_pegawai,"barcode_pegawai","nama_pegawai",$id_pegawai,"Pilih Pegawai Lebih Dulu");
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
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"></h3>
			<a href="<?php echo base_url('berkas/pengembangan_profesi/pdf/'); ?><?php echo $first_date;?>/<?php echo $last_date;?>/<?php echo $id_kategori_pelatihan;?>/<?php echo $id_pegawai;?>" target="_blank" class="btn btn-white btn-md">
				<i class="fa fa-print"></i> PDF
			</a>
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
					  <th style="vertical-align:middle;width:5%;"></th>
					  <th style="vertical-align:middle;">Mulai</th>
					  <th style="vertical-align:middle;">Sampai</th>
					  <th style="vertical-align:middle;">Pegawai</th>
					  <th style="vertical-align:middle;">Ruangan</th>
					  <th style="vertical-align:middle;">Kategori</th>
					  <th style="vertical-align:middle;">link</th>
					</tr>
				</thead>
			</table>
        </div>
        <div class="box-footer">

        </div>
      </div>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">GRAFIK</h3>
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
elseif ($page=="kinerja_klinis_lharian")
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
	<?php echo form_open_multipart('berkas/kinerja_klinis/'.$pages.'/'.$bulan.'/'.$tahun.'/'.$id_pegawai,' id="signupform" '); ?>
	  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
		<div class="box-header with-border">
		  <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
		</div>
		  <div class="box-body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
					  <label>Pegawai</label>
							<?php
								input_pdselect2fleksibel("id_pegawai","id_pegawai",$cmd_pegawai,"barcode_pegawai","nama_pegawai",$id_pegawai,"Silahkan Pilih Pegawai Dahulu");
							?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					  <label>Bentuk Laporan</label>
							<?php
								input_pdselect2("pages",$cmd_bentuk_laporan,$pages);
							?>
					</div>
				</div>
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
           <h3 class="box-title"></h3>
			<a href="<?php echo base_url('berkas/kinerja_klinis/pdf_harian/'); ?><?php echo $bulan;?>/<?php echo $tahun;?>/<?php echo $id_pegawai;?>" target="_blank" class="btn btn-white btn-md">
				<i class="fa fa-print"></i> PDF
			</a>
          <div class="box-tools pull-right">

          </div>
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
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;">No</th>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kegiatan</th>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;">PK</th>
				<?php
					foreach (range(1, $tglakhir) as $number) {
				?>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;"><?php echo $number; ?></th>
				<?php
					}
				?>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Jml</th>
				</tr>
			  </thead>
			  <tbody>
					<?php
						$no = 0;
						foreach($print_logbook_bulanane as $row){
							$no++;
					?>
				<tr>
					<td style="vertical-align:middle;text-align:center"><?php echo $no; ?></td>
					<td style="vertical-align:middle;text-align:left"><?php echo $row['nama_kewenangan']; ?></td>
					<td style="vertical-align:middle;text-align:center"><?php echo substr($row['nama_kode_kewenangan'],3); ?></td>
					<?php
					foreach (range(1, $tglakhir) as $numbers) {
						$tglenya	= $tahun.'-'.$bulan.'-'.$numbers;
						$this->db->select("COUNT(*) as num");
						$this->db->join('kr_kewenangan_detil kd', 'kd.id_kewenangan_detil=lp.id_kewenangan_detil','left');
						$this->db->where('tgl_logbook',$tglenya);
						$this->db->where("id_pegawai", $id_pegawai);
						$this->db->where("tgl_logbook", $tglenya);
						$this->db->where("id_kewenangan", $row['id_kewenangan']);
						$qx = $this->db->get('logbook lp')->row();
						$jml = $qx->num;
						if($jml == 0){
					?>
					<td style="vertical-align:middle;text-align:center">0</td>
					<?php
						}else{
							$this->db->select('SUM(jml_logbook) as jumlahe');
							$this->db->join('kr_kewenangan_detil kd', 'kd.id_kewenangan_detil=lp.id_kewenangan_detil','left');
							$this->db->where("id_pegawai", $id_pegawai);
							$this->db->where("tgl_logbook", $tglenya);
							$this->db->where("id_kewenangan", $row['id_kewenangan']);
							$q = $this->db->get('logbook lp')->result_array();
							foreach($q as $row2){
					?>
					<td style="vertical-align:middle;text-align:center"><?php echo $row2['jumlahe']; ?></td>
					<?php
							}
						}
					}
					?>
					<td style="vertical-align:middle;text-align:center"><?php echo $row['jumlaha']; ?></td>
				</tr>
					<?php
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
elseif ($page=="kinerja_klinis_lbulanan")
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
	<?php echo form_open_multipart('berkas/kinerja_klinis/'.$pages.'/'.$bulan.'/'.$tahun.'/'.$id_pegawai,' id="signupform" '); ?>
	  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
		<div class="box-header with-border">
		  <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
		</div>
		  <div class="box-body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
					  <label>Pegawai</label>
							<?php
								input_pdselect2fleksibel("id_pegawai","id_pegawai",$cmd_pegawai,"barcode_pegawai","nama_pegawai",$id_pegawai,"Silahkan Pilih Pegawai Dahulu");
							?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					  <label>Bentuk Laporan</label>
							<?php
								input_pdselect2("pages",$cmd_bentuk_laporan,$pages);
							?>
					</div>
				</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label>Tanggal Awal</label>
								<?php
									input_calendar("bulan","bulan",$bulan,"Masukkan Tanggal Transaksi","required");
								?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label>Tanggal Akhir</label>
							<?php
								input_calendar("tahun","tahun",$tahun,"Masukkan Tanggal Transaksi","required");
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
           <h3 class="box-title"></h3>
			<a href="<?php echo base_url('berkas/kinerja_klinis/pdf_bulanan/'); ?><?php echo $bulan;?>/<?php echo $tahun;?>/<?php echo $id_pegawai;?>" target="_blank" class="btn btn-white btn-md">
				<i class="fa fa-print"></i> PDF
			</a>
          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
		   <table id="example1" width="100%" class="table table-bordered table-striped">
				  <?php
					foreach($ambil_range as $rowambil_range){
				  ?>
				<tr>
					<td style="vertical-align:middle;text-align:left;font-weight:bold;">PERIODE</td>
					<td colspan="2" style="vertical-align:middle;text-align:left;font-weight:bold;"><?php echo $this->m_rancak->getBulan($rowambil_range['bulan']); ?> - <?php echo $rowambil_range['tahun']; ?></td>
				</tr>
				  <?php
						$ambil_range_detil = $this->m_berkas->ambil_range_logbook_bulanane_detil($rowambil_range['bulan'],$rowambil_range['tahun'],$id_pegawai);
						foreach($ambil_range_detil as $rowambil_range_detil){
				  ?>
				<tr>
					<td style="vertical-align:middle;text-align:left;width:3%;">&nbsp;</td>
					<td style="vertical-align:middle;text-align:left;"><?php echo $rowambil_range_detil['nama_kewenangan']; ?></td>
					<td style="vertical-align:middle;text-align:right;"><?php echo $rowambil_range_detil['jumlah']; ?></td>
				</tr>
				  <?php
						}
					}
				  ?>
			</table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="kinerja_klinis_ltahunan")
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
	<?php echo form_open_multipart('berkas/kinerja_klinis/'.$pages.'/'.$bulan.'/'.$tahun.'/'.$id_pegawai,' id="signupform" '); ?>
	  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
		<div class="box-header with-border">
		  <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
		</div>
		  <div class="box-body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
					  <label>Pegawai</label>
							<?php
								input_pdselect2fleksibel("id_pegawai","id_pegawai",$cmd_pegawai,"id_pegawai","nama_pegawai",$id_pegawai,"Silahkan Pilih Pegawai Dahulu");
							?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					  <label>Bentuk Laporan</label>
							<?php
								input_pdselect2("pages",$cmd_bentuk_laporan,$pages);
							?>
					</div>
				</div>
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
           <h3 class="box-title"></h3>
			<a href="<?php echo base_url('berkas/kinerja_klinis/pdf_tahunan/'); ?><?php echo $bulan;?>/<?php echo $tahun;?>/<?php echo $id_pegawai;?>" target="_blank" class="btn btn-white btn-md">
				<i class="fa fa-print"></i> PDF
			</a>
          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
		   <table id="example1" width="100%" class="table table-bordered table-striped">
				  <?php
					foreach($ambil_range as $rowambil_range){
				  ?>
				<tr>
					<td style="vertical-align:middle;text-align:left;font-weight:bold;">PERIODE</td>
					<td colspan="2" style="vertical-align:middle;text-align:left;font-weight:bold;"><?php echo $rowambil_range['tahun']; ?></td>
				</tr>
				  <?php
						$ambil_range_detil = $this->m_berkas->ambil_range_logbook_tahunan_detil($rowambil_range['tahun'],$id_pegawai);
						foreach($ambil_range_detil as $rowambil_range_detil){
				  ?>
				<tr>
					<td style="vertical-align:middle;text-align:left;width:3%;">&nbsp;</td>
					<td style="vertical-align:middle;text-align:left;"><?php echo $rowambil_range_detil['nama_kewenangan']; ?></td>
					<td style="vertical-align:middle;text-align:right;"><?php echo $rowambil_range_detil['jumlah']; ?></td>
				</tr>
				  <?php
						}
					}
				  ?>
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
	<?php echo form_open_multipart('berkas/penilaian_kinerja/view/'.$id_pegawai.'/'.$tahun,' id="signupform" '); ?>
	  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
		<div class="box-header with-border">
		  <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
		</div>
		  <div class="box-body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
					  <label>Pegawai</label>
							<?php
								input_pdselect2fleksibel("id_pegawai","id_pegawai",$cmd_pegawai,"barcode_pegawai","nama_pegawai",$id_pegawai,"Silahkan Pilih Pegawai Dahulu");
							?>
					</div>
				</div>
				<div class="col-md-6">
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
           <h3 class="box-title">OPPE TAHUN <?php echo $tahun; ?></h3>

          <div class="box-tools pull-right">
			<a href="<?php echo base_url('berkas/penilaian_kinerja/pdf/'); ?><?php echo $id_pegawai;?>/<?php echo $tahun;?>" target="_blank" class="btn btn-white btn-md">
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
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">GRAFIK</h3>
          <div class="box-tools pull-right">

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
	<?php echo form_open_multipart('berkas/fppe/view/'.$id_pegawai.'/'.$tahun,' id="signupform" '); ?>
	  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
		<div class="box-header with-border">
		  <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
		</div>
		  <div class="box-body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
					  <label>Pegawai</label>
							<?php
								input_pdselect2fleksibel("id_pegawai","id_pegawai",$cmd_pegawai,"id_pegawai","nama_pegawai",$id_pegawai,"Silahkan Pilih Pegawai Dahulu");
							?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					  <label>Tahun</label>
						<?php
							input_pdselect2("tahun",$cmd_tahun,$tahun);
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
			<a href="<?php echo base_url('berkas/fppe/pdf/'); ?><?php echo $id_pegawai;?>/<?php echo $tahun;?>" target="_blank" class="btn btn-white btn-md">
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
							$ambil_lobook_pemulihan_pertahun = $this->m_rancak->ambil_lobook_pemulihan_pertahun($id_pegawai,$tahun);
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
elseif ($page=="etika_profesi")
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
	<?php echo form_open_multipart('berkas/etika_profesi/view/'.$id,' id="signupform" '); ?>
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
								input_pdselect2fleksibel("id","id",$cmd_pegawai,"barcode_pegawai","nama_pegawai",$id,"Semua");
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
					  <th>ID</th>
					  <th>Tanggal</th>
					  <th>Jam</th>
					  <th>Nama</th>
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
elseif ($page=="riwayat")
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
        <?php echo $title; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
	<?php echo form_open_multipart('berkas/riwayat/view/'.$id_pegawai.'/'.$id_kewenangan,' id="signupform" '); ?>
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
								input_pdselect2fleksibel("id_pegawai","id_pegawai",$cmd_pegawai,"barcode_pegawai","nama_pegawai",$id_pegawai,"Silahkan Pilih Pegawai Dahulu");
							?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label>Kompetensi Kewenangan</label>
							<?php
								input_pdselect2fleksibel("id_kewenangan","id_kewenangan",$cmd_kewenangan,"id_kewenangan","nama_kewenangan",$id_kewenangan,"Silahkan Pilih Kewenangan");
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
           <h3 class="box-title"></h3>
			<a href="<?php echo base_url('berkas/riwayat/pdf/'); ?><?php echo $id_pegawai;?>/<?php echo $id_kewenangan;?>" target="_blank" class="btn btn-white btn-md">
				<i class="fa fa-print"></i> PDF
			</a>
          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
 			<table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
				<thead>
					<tr>
					  <th width="3%"></th>
					  <th>Tanggal</th>
					  <th>Jam</th>
					  <th>Kode</th>
					  <th>Nama Kewenangan</th>
					  <th>Jumlah</th>
					  <th width="8%">Karu</th>
					  <th width="8%">Kabid</th>
					  <th width="8%">Asesor</th>
					  <th width="8%">Komite</th>
					  <th width="8%">Direktur</th>
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
elseif ($page=="gender" || $page=="pendidikan" || $page=="agama" || $page=="marital" || $page=="status" || $page=="ruangan"
		|| $page=="pk" || $page=="jabatan_fungsional")
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
	<?php echo form_open_multipart('berkas/'.$page.'/view/'.$id_ruangan,' id="signupform" '); ?>
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
								input_pdselect2fleksibel("id_ruangan","id_ruangan",$cmd_ruangan,"id_ruangan","nama_ruangan",$id_ruangan,"Semua");
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
           <h3 class="box-title">TABEL</h3>
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
					<?php
					if($page=="pendidikan"){
					?>
					  <th>Nama</th>
					  <th style="vertical-align:middle;">Pendidikan</th>
					  <th style="vertical-align:middle;">Nama Instansi</th>
					  <th style="vertical-align:middle;">No Ijasah</th>
					  <th style="vertical-align:middle;">Lulus Tahun</th>
					  <th style="vertical-align:middle;">link</th>
					<?php
					}else{
					?>
					  <th>Nama</th>
					  <th>Gender</th>
					  <th>Agama</th>
					  <th>Marital</th>
					  <th>Status</th>
					  <th>Ruangan</th>
					  <th>Kode</th>
					  <th>Jabfung</th>
					<?php
					}
					?>
					</tr>
				</thead>
			</table>
        </div>
        <div class="box-footer">

        </div>
      </div>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">GRAFIK</h3>
          <div class="box-tools pull-right">

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
elseif ($page=="grafik")
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
	<?php echo form_open_multipart('berkas/'.$page.'/view/'.$tahun.'/'.$id_ruangan,' id="signupform" '); ?>
	  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
		<div class="box-header with-border">
		  <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
		</div>
		  <div class="box-body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
					  <label>Ruangan</label>
							<?php
								input_pdselect2fleksibel("id_ruangan","id_ruangan",$cmd_ruangan,"id_ruangan","nama_ruangan",$id_ruangan,"Silahkan Pilih Ruangan Dulu");
							?>
					</div>
				</div>
					<div class="col-md-6">
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
           <h3 class="box-title">GRAFIK</h3>
          <div class="box-tools pull-right">

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
elseif ($page=="peta_ruangan")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
			<a href="<?php echo $link_kembali;?>"
				class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" > <i class="fa fa-reply"></i> Kembali
			</a>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?> TAHUN : <?= date('Y') ?></h3>

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
						foreach($ruangan as $rowruangan){
					?>
						<div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			        <div class="box-header with-border">
			           	<h3 class="box-title"><?php echo substr($rowruangan['nama_ruangan'],0,40); ?></h3>
				          <div class="box-tools pull-right">
				          </div>
			        </div>
			        <div class="box-body">
								<?php
								$gender=$this->m_berkas->peta_count($rowruangan['id_ruangan'],'jk');
								$pendidikan=$this->m_berkas->peta_count($rowruangan['id_ruangan'],'id_pendidikan');
								$agama=$this->m_berkas->peta_count($rowruangan['id_ruangan'],'id_agama');
								$kawin=$this->m_berkas->peta_count($rowruangan['id_ruangan'],'id_status_kawin');
								$pk=$this->m_berkas->peta_count($rowruangan['id_ruangan'],'id_kode_kewenangan');
								$jf=$this->m_berkas->peta_count($rowruangan['id_ruangan'],'id_jabatan_fungsional');
								$sp=$this->m_berkas->peta_count($rowruangan['id_ruangan'],'tipe_pegawai');
								$pelatihan=$this->m_berkas->ambil_berkas_pelatihan($rowruangan['id_ruangan']);
								?>
								<div class="col-md-12">
									<div class="col-md-2">
										<strong>Jabatan Fungsional</strong><br>
										<?php
										foreach($jf as $rowjf){
											$njf = $this->m_umum->ambil_data('jabatan_fungsional','id_jabatan_fungsional',$rowjf['id_jabatan_fungsional']);
												echo $njf['nama_jabatan_fungsional'].' = '.$rowjf['total_jf'].'<br>';
										}
										?>
									</div>
									<div class="col-md-2">
									<strong>Jumlah Pegawai</strong><br>
									Laki-laki : <?= $gender['MALE_COUNT'] ?><br>
									Perempuan : <?= $gender['FEMALE_COUNT'] ?><br><br>
									<strong>Status Pegawai</strong><br>
									<?php
									foreach($sp as $rowsp){
										$nsp = $this->m_umum->ambil_data('kol_status_pegawai','id_status_pegawai',$rowsp['tipe_pegawai']);
											echo $nsp['nama_status_pegawai'].' = '.$rowsp['total_pegawai'].'<br>';
									}
									?>
									</div>
									<div class="col-md-2">
									<strong>Pendidikan Terakhir</strong><br>
									<?php
									foreach($pendidikan as $rowpendidikan){
										$npendidikan = $this->m_umum->ambil_data('kol_pendidikan','id_pendidikan',$rowpendidikan['id_pendidikan']);
											echo $npendidikan['nama_pendidikan'].' = '.$rowpendidikan['total_pendidikan'].'<br>';
									}
									?>
								</div>
								<div class="col-md-2">
									<strong>Agama</strong><br>
									<?php
									foreach($agama as $rowagama){
										$nagama = $this->m_umum->ambil_data('kol_agama','id_agama',$rowagama['id_agama']);
											echo $nagama['nama_agama'].' = '.$rowagama['total_agama'].'<br>';
									}
									?>
								</div>
								<div class="col-md-2">
									<strong>Marital Status</strong><br>
									<?php
									foreach($kawin as $rowkawin){
										$nkawin = $this->m_umum->ambil_data('kol_status_kawin','id_status_kawin',$rowkawin['id_status_kawin']);
											echo $nkawin['nama_status_kawin'].' = '.$rowkawin['total_kawin'].'<br>';
									}
									?>
								</div>
								<div class="col-md-2">
									<strong>Petugas Klinis</strong><br>
									<?php
									foreach($pk as $rowpk){
										$npk = $this->m_umum->ambil_data('kol_kode_kewenangan','id_kode_kewenangan',$rowpk['id_kode_kewenangan']);
											if(!empty($rowpk['total_kode_kewenangan'])){
											echo $npk['nama_kode_kewenangan'].' = '.$rowpk['total_kode_kewenangan'].'<br>';
										}
									}
									?>
								</div>
							</div>
							<?php
								$kondisi_sik_aktif=array('tgl_b_berkas >='=>date('Y-m-d'),'status_berkas'=>1,'id_kategori_berkas'=>3,'id_ruangan'=>$rowruangan['id_ruangan']);
							  $sik_aktif=$this->m_umum->jumlah_record_tabel_pengajuan('berkas',$kondisi_sik_aktif,'pegawai','id_pegawai');
								$kondisi_sik_exp=array('tgl_b_berkas <'=>date('Y-m-d'),'status_berkas'=>1,'id_kategori_berkas'=>3,'id_ruangan'=>$rowruangan['id_ruangan']);
							  $sik_exp=$this->m_umum->jumlah_record_tabel_pengajuan('berkas',$kondisi_sik_exp,'pegawai','id_pegawai');
								$kondisi_str_aktif=array('tgl_b_berkas >='=>date('Y-m-d'),'status_berkas'=>1,'id_kategori_berkas'=>1,'id_ruangan'=>$rowruangan['id_ruangan']);
							  $str_aktif=$this->m_umum->jumlah_record_tabel_pengajuan('berkas',$kondisi_str_aktif,'pegawai','id_pegawai');
								$kondisi_str_exp=array('tgl_b_berkas <'=>date('Y-m-d'),'status_berkas'=>1,'id_kategori_berkas'=>1,'id_ruangan'=>$rowruangan['id_ruangan']);
							  $str_exp=$this->m_umum->jumlah_record_tabel_pengajuan('berkas',$kondisi_str_exp,'pegawai','id_pegawai');
								$kondisi_sip_aktif=array('tgl_b_berkas >='=>date('Y-m-d'),'status_berkas'=>1,'id_kategori_berkas'=>2,'id_ruangan'=>$rowruangan['id_ruangan']);
							  $sip_aktif=$this->m_umum->jumlah_record_tabel_pengajuan('berkas',$kondisi_sip_aktif,'pegawai','id_pegawai');
								$kondisi_sip_exp=array('tgl_b_berkas <'=>date('Y-m-d'),'status_berkas'=>1,'id_kategori_berkas'=>2,'id_ruangan'=>$rowruangan['id_ruangan']);
							  $sip_exp=$this->m_umum->jumlah_record_tabel_pengajuan('berkas',$kondisi_sip_exp,'pegawai','id_pegawai');
								$injabdet = $this->m_berkas->ambil_all_abk_pola(date('Y'),$rowruangan['id_ruangan']);
								$thn0 = $this->m_berkas->ambil_thn_pemenuhan($rowruangan['id_ruangan'],date('Y'));
								$thn1 = $this->m_berkas->ambil_thn_pemenuhan($rowruangan['id_ruangan'],date('Y')+1);
								$thn2 = $this->m_berkas->ambil_thn_pemenuhan($rowruangan['id_ruangan'],date('Y')+2);
								if(empty($thn0['jml_pemenuhan'])){ $prsn0 = '0'; }else{ $prsn0 = $thn0['jml_realisasi'] / $thn0['jml_pemenuhan'] * 100;}
									if(empty($thn1['jml_pemenuhan'])){ $prsn1 = '0'; }else{ $prsn1 = $thn1['jml_realisasi'] / $thn1['jml_pemenuhan'] * 100;}
										if(empty($thn2['jml_pemenuhan'])){ $prsn2 = '0'; }else{ $prsn2 = $thn2['jml_realisasi'] / $thn2['jml_pemenuhan'] * 100;}
							 ?>
							<div class="col-md-12">
								<div class="col-md-2">
									<br><strong>Pelatihan Khusus</strong><br>
									<?php
									foreach($pelatihan as $rowpelatihan){
										$npelatihan = $this->m_umum->ambil_data('kol_kategori_pelatihan','id_kategori_pelatihan',$rowpelatihan['id_kategori_pelatihan']);
											echo $npelatihan['nama_kategori_pelatihan'].' = '.$rowpelatihan['total_pelatihan'].'<br>';
									}
									?>
									<br><strong>Surat Ijin</strong><br>
									<?php echo
										'STR AKTIF : '.$str_aktif.'<br>'.
										'STR Expired : '.$str_exp.'<br>'.
										'SIK AKTIF : '.$sik_aktif.'<br>'.
										'SIK Expired : '.$sik_exp.'<br>'.
										'SIP AKTIF : '.$sip_aktif.'<br>'.
										'SIP Expired : '.$sip_exp.'<br>'
										;
									 ?>
								</div>
								<div class="col-md-10">
									<br><strong>Analisa Beban Kerja</strong><br>
										<table width="100%" class="table table-border" style="font-size: 0.8em;">
										<thead>
										  <tr>
										    <th rowspan="2" style="border-color: black;font-size: 1em;text-align:center;vertical-align:middle;width:3%;">No</th>
										    <th rowspan="2" style="border-color: black;font-size: 1em;text-align:center;vertical-align:middle;width:10%;">NAMA JABATAN</th>
										    <th colspan="4" style="border-color: black;font-size: 1em;text-align:center;vertical-align:middle;">KETERSEDIAAN TENAGA</th>
										    <th colspan="3" style="border-color: black;font-size: 1em;text-align:center;vertical-align:middle;">RENCANA PEMENUHAN KEKURANGAN</th>
										    <th colspan="3" style="border-color: black;font-size: 1em;text-align:center;vertical-align:middle;">EVALUASI PERENCANAAN</th>
										    <th colspan="3" style="border-color: black;font-size: 1em;text-align:center;vertical-align:middle;">PERSENTASI TINGKAT PEMENUHAN RENCANA</th>
										  </tr>
										  <tr>
										    <th colspan="2" style="border-color: black;font-size: 1em;text-align:center;vertical-align:middle;width:10%;">KETERSEDIAAN</th>
										    <th style="border-color: black;font-size: 1em;text-align:center;vertical-align:middle;width:7%;">KEBUTUHAN</th>
										    <th style="border-color: black;font-size: 1em;text-align:center;vertical-align:middle;width:7%;">KELEBIHAN</th>
										    <th style="border-color: black;font-size: 1em;text-align:center;vertical-align:middle;width:7%;"><?php echo date('Y'); ?></th>
										    <th style="border-color: black;font-size: 1em;text-align:center;vertical-align:middle;width:7%;"><?php echo date('Y')+1; ?></th>
										    <th style="border-color: black;font-size: 1em;text-align:center;vertical-align:middle;width:7%;"><?php echo date('Y')+2; ?></th>
										    <th style="border-color: black;font-size: 1em;text-align:center;vertical-align:middle;width:7%;"><?php echo date('Y'); ?></th>
										    <th style="border-color: black;font-size: 1em;text-align:center;vertical-align:middle;width:7%;"><?php echo date('Y')+1; ?></th>
										    <th style="border-color: black;font-size: 1em;text-align:center;vertical-align:middle;width:7%;"><?php echo date('Y')+2; ?></th>
										    <th style="border-color: black;font-size: 1em;text-align:center;vertical-align:middle;width:7%;"><?php echo date('Y'); ?></th>
										    <th style="border-color: black;font-size: 1em;text-align:center;vertical-align:middle;width:7%;"><?php echo date('Y')+1; ?></th>
										    <th style="border-color: black;font-size: 1em;text-align:center;vertical-align:middle;width:7%;"><?php echo date('Y')+2; ?></th>
										  </tr>
										</thead>
										<tbody>
										<?php
											$noa = 0;$allpns = 0;$allcpns = 0;$allblud = 0;$allcpb = 0;$totale = 0;
											foreach($injabdet as $rowinjabdet){
											$noa++;
											$totale = $rowinjabdet['pns'] + $rowinjabdet['cpns'] + $rowinjabdet['blud'];
											$allpns = $allpns + $rowinjabdet['pns'];
											$allcpns = $allcpns + $rowinjabdet['cpns'];
											$allblud = $allblud + $rowinjabdet['blud'];
											$allcpb = $allpns + $allcpns + $allblud;
										?>
										  <tr>
										    <td style="border-color: black;text-align:center;vertical-align:middle;"><?= $noa ?></td>
										    <td style="border-color:black;font-size: 0.8em;text-align:left;vertical-align:middle;"><?= $rowinjabdet['nama_jabatan_fungsional'] ?></td>
										    <td style="border-color: black;text-align:center;vertical-align:bottom;line-height:1.6;width:5%;">
											CPNS : <?= $allcpns ?><br>
											PNS : <?= $allpns ?><br>
											BLUD : <?= $allblud ?>
											</td>
											<td style="border-color: black;text-align:center;vertical-align:middle;width:4%;"><?= $totale ?></td>
										    <td style="border-color: black;text-align:center;vertical-align:middle;width:7%;"><?= $rowinjabdet['total'] ?></td>
										    <td style="border-color: black;text-align:center;vertical-align:middle;width:7%;"><?= $rowinjabdet['average'] ?></td>
										    <td style="border-color: black;text-align:center;vertical-align:middle;width:7%;">
											<?php
											echo $thn0['jml_pemenuhan'];
											?>
											</td>
										    <td style="border-color: black;text-align:center;vertical-align:middle;width:7%;">
											<?php
											echo $thn1['jml_pemenuhan'];
											?>
											</td>
										    <td style="border-color: black;text-align:center;vertical-align:middle;width:7%;">
											<?php
											echo $thn2['jml_pemenuhan'];
											?>
											</td>
										    <td style="border-color: black;text-align:center;vertical-align:middle;width:7%;">
											<?php
											echo $thn0['jml_realisasi'];
											?>
											</td>
										    <td style="border-color: black;text-align:center;vertical-align:middle;width:7%;">
											<?php
											echo $thn1['jml_realisasi'];
											?>
											</td>
										    <td style="border-color: black;text-align:center;vertical-align:middle;width:7%;">
											<?php
											echo $thn2['jml_realisasi'];
											?>
											</td>
										    <td style="border-color: black;text-align:center;vertical-align:middle;width:7%;">
											<?php
											echo round($prsn0,1);
											?> %
											</td>
										    <td style="border-color: black;text-align:center;vertical-align:middle;width:7%;">
											<?php
											echo round($prsn1,1);
											?>	%
											</td>
										    <td style="border-color: black;text-align:center;vertical-align:middle;width:7%;">
											<?php
											echo round($prsn2,1);
											?>	%
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
						</div>
						<?php
					}
						?>
        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="peta_rs")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
			<a href="<?php echo $link_kembali;?>"
				class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" > <i class="fa fa-reply"></i> Kembali
			</a>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?> TAHUN : <?= date('Y') ?></h3>

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
			           	<h3 class="box-title"><?= $title ?></h3>
				          <div class="box-tools pull-right">
				          </div>
			        </div>
			        <div class="box-body">
								<?php
								$gender=$this->m_berkas->peta_count('ALL','jk');
								$pendidikan=$this->m_berkas->peta_count('ALL','id_pendidikan');
								$agama=$this->m_berkas->peta_count('ALL','id_agama');
								$kawin=$this->m_berkas->peta_count('ALL','id_status_kawin');
								$pk=$this->m_berkas->peta_count('ALL','id_kode_kewenangan');
								$jf=$this->m_berkas->peta_count('ALL','id_jabatan_fungsional');
								$sp=$this->m_berkas->peta_count('ALL','tipe_pegawai');
								$pelatihan=$this->m_berkas->ambil_berkas_pelatihan('ALL');
								?>
								<div class="col-md-12">
									<div class="col-md-4">
										<strong>Jabatan Fungsional</strong><br>
										<?php
										foreach($jf as $rowjf){
											$njf = $this->m_umum->ambil_data('jabatan_fungsional','id_jabatan_fungsional',$rowjf['id_jabatan_fungsional']);
												echo $njf['nama_jabatan_fungsional'].' = '.$rowjf['total_jf'].'<br>';
										}
										?>
										<br><strong>Petugas Klinis</strong><br>
										<?php
										foreach($pk as $rowpk){
								//			$npk = $this->m_umum->ambil_data('kol_kode_kewenangan','id_kode_kewenangan',$rowpk['id_kode_kewenangan']);
								//				echo $npk['nama_kode_kewenangan'].' = '.$rowpk['total_kode_kewenangan'].'<br>';
												$npk = $this->m_umum->ambil_data('kol_kode_kewenangan','id_kode_kewenangan',$rowpk['id_kode_kewenangan']);
													if(!empty($rowpk['total_kode_kewenangan'])){
													echo $npk['nama_kode_kewenangan'].' = '.$rowpk['total_kode_kewenangan'].'<br>';
												}
										}
											$kondisi_sik_aktif=array('tgl_b_berkas >='=>date('Y-m-d'),'status_berkas'=>1,'id_kategori_berkas'=>3);
										  $sik_aktif=$this->m_umum->jumlah_record_tabel_pengajuan('berkas',$kondisi_sik_aktif,'pegawai','id_pegawai');
											$kondisi_sik_exp=array('tgl_b_berkas <'=>date('Y-m-d'),'status_berkas'=>1,'id_kategori_berkas'=>3);
										  $sik_exp=$this->m_umum->jumlah_record_tabel_pengajuan('berkas',$kondisi_sik_exp,'pegawai','id_pegawai');
											$kondisi_str_aktif=array('tgl_b_berkas >='=>date('Y-m-d'),'status_berkas'=>1,'id_kategori_berkas'=>1);
										  $str_aktif=$this->m_umum->jumlah_record_tabel_pengajuan('berkas',$kondisi_str_aktif,'pegawai','id_pegawai');
											$kondisi_str_exp=array('tgl_b_berkas <'=>date('Y-m-d'),'status_berkas'=>1,'id_kategori_berkas'=>1);
										  $str_exp=$this->m_umum->jumlah_record_tabel_pengajuan('berkas',$kondisi_str_exp,'pegawai','id_pegawai');
											$kondisi_sip_aktif=array('tgl_b_berkas >='=>date('Y-m-d'),'status_berkas'=>1,'id_kategori_berkas'=>2);
										  $sip_aktif=$this->m_umum->jumlah_record_tabel_pengajuan('berkas',$kondisi_sip_aktif,'pegawai','id_pegawai');
											$kondisi_sip_exp=array('tgl_b_berkas <'=>date('Y-m-d'),'status_berkas'=>1,'id_kategori_berkas'=>2);
										  $sip_exp=$this->m_umum->jumlah_record_tabel_pengajuan('berkas',$kondisi_sip_exp,'pegawai','id_pegawai');
										 ?>
									</div>
									<div class="col-md-4">
									<strong>Jumlah Pegawai</strong><br>
									Laki-laki : <?= $gender['MALE_COUNT'] ?><br>
									Perempuan : <?= $gender['FEMALE_COUNT'] ?><br>
									<br><strong>Status Pegawai</strong><br>
									<?php
									foreach($sp as $rowsp){
										$nsp = $this->m_umum->ambil_data('kol_status_pegawai','id_status_pegawai',$rowsp['tipe_pegawai']);
											echo $nsp['nama_status_pegawai'].' = '.$rowsp['total_pegawai'].'<br>';
									}
									?>
									<br><strong>Agama</strong><br>
									<?php
									foreach($agama as $rowagama){
										$nagama = $this->m_umum->ambil_data('kol_agama','id_agama',$rowagama['id_agama']);
											echo $nagama['nama_agama'].' = '.$rowagama['total_agama'].'<br>';
									}
									?>
									<br><strong>Marital Status</strong><br>
									<?php
									foreach($kawin as $rowkawin){
										$nkawin = $this->m_umum->ambil_data('kol_status_kawin','id_status_kawin',$rowkawin['id_status_kawin']);
											echo $nkawin['nama_status_kawin'].' = '.$rowkawin['total_kawin'].'<br>';
									}
									?>
									<br><strong>Surat Ijin</strong><br>
									<?php echo
										'STR AKTIF : '.$str_aktif.'<br>'.
										'STR Expired : '.$str_exp.'<br>'.
										'SIK AKTIF : '.$sik_aktif.'<br>'.
										'SIK Expired : '.$sik_exp.'<br>'.
										'SIP AKTIF : '.$sip_aktif.'<br>'.
										'SIP Expired : '.$sip_exp.'<br>'
										;
									 ?>
									</div>
									<div class="col-md-4">
									<strong>Pendidikan Terakhir</strong><br>
									<?php
									foreach($pendidikan as $rowpendidikan){
										$npendidikan = $this->m_umum->ambil_data('kol_pendidikan','id_pendidikan',$rowpendidikan['id_pendidikan']);
											echo $npendidikan['nama_pendidikan'].' = '.$rowpendidikan['total_pendidikan'].'<br>';
									}
									?>
									<br><strong>Pelatihan Khusus</strong><br>
									<?php
									foreach($pelatihan as $rowpelatihan){
										$npelatihan = $this->m_umum->ambil_data('kol_kategori_pelatihan','id_kategori_pelatihan',$rowpelatihan['id_kategori_pelatihan']);
											echo $npelatihan['nama_kategori_pelatihan'].' = '.$rowpelatihan['total_pelatihan'].'<br>';
									}
									?>
								</div>
							</div>
			        </div>
						</div>
        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="demografi_rs")
{
?>
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
				<div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
	        <div class="box-header with-border">
	           	<h3 class="box-title"><?= $title ?></h3>
		          <div class="box-tools pull-right"></div>
	        </div>
	        <div class="box-body">


<?php  
	$id_working = 1; // Ansari Saleh
  $grafik_pengcab_area=$this->m_berkas->grafik_working_region('id_working',$id_working);
  foreach ($grafik_pengcab_area as $rowgrafik_pengcab_area){  
?>
  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
       <h3 class="box-title"><?= $rowgrafik_pengcab_area['nama_working'] ?></h3>
      <div class="box-tools pull-right"></div>
    </div>
    <div class="box-body">
      <div class="row">
        <!-- AWALI -->
        <div class="col-md-8">
          <h5 class="box-title" style="font-weight:bold;">DAFTAR PEGAWAI</h5>
  <?php  
  $nografik_pegawai_kab = 0;
  $ambil_bekerja_for_person=$this->m_berkas->ambil_tempat_bekerja_for_person();
    foreach ($ambil_bekerja_for_person as $rowambil_bekerja_for_person){
      $nografik_pegawai_kab++;
  ?>
  <div class="col-md-6">
    <div class="box-body table-responsive no-padding">
      <table class="table table-hover">
        <tr>
          <th style="width: 5%;"><?= $nografik_pegawai_kab ?></th>
          <th colspan='6' style="background-color: maroon;color: white;font-weight:bold;"><?= $rowambil_bekerja_for_person['nama_pegawai'] ?></th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="background-color: #e0e0e0;font-weight:bold;">DATA UMUM</th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="font-weight:bold;">Gender : 
            <?php 
              if($rowambil_bekerja_for_person['jk'] == 0){ echo 'Perempuan';}else{ echo 'laki-laki'; }
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="font-weight:bold;">TTL : 
            <?php 
              echo $rowambil_bekerja_for_person['tmp_lahir'].", ". date('d-m-Y', strtotime($rowambil_bekerja_for_person['tgl_lahir']));
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="font-weight:bold;">Age : 
            <?php 
              echo $this->m_rancak->dob($rowambil_bekerja_for_person['tgl_lahir']);
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="font-weight:bold;">Agama : 
            <?php 
              $rel = $this->m_umum->ambil_data('kol_agama','id_agama',$rowambil_bekerja_for_person['id_agama']);
              echo $rel['nama_agama'];
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="font-weight:bold;">Marital : 
            <?php 
              $mar = $this->m_umum->ambil_data('kol_status_kawin','id_status_kawin',$rowambil_bekerja_for_person['id_status_kawin']);
              echo $mar['nama_status_kawin'];
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="font-weight:bold;">Status Pegawai : 
            <?php 
              $mar = $this->m_umum->ambil_data('kol_status_pegawai','id_status_pegawai',$rowambil_bekerja_for_person['id_status_pegawai']);
              echo $mar['nama_status_pegawai'];
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="font-weight:bold;">Jabatan : 
            <?php 
              $mar = $this->m_umum->ambil_data('jabatan_fungsional','id_jabatan_fungsional',$rowambil_bekerja_for_person['id_jabatan_fungsional']);
              echo $mar['nama_jabatan_fungsional'];
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="font-weight:bold;">Pendidikan Terakhir : 
            <?php 
              $mar = $this->m_umum->ambil_data('kol_pendidikan','id_pendidikan',$rowambil_bekerja_for_person['id_pendidikan']);
               echo $mar['nama_pendidikan'];        
            ?>
          </th>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="font-weight:bold;">PK : 
            <?php 
              $mar = $this->m_umum->ambil_data('kol_kode_kewenangan','id_kode_kewenangan',$rowambil_bekerja_for_person['id_kode_kewenangan']);
              echo $mar['nama_kode_kewenangan'];
            ?>
          </th>
        </tr>        
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="background-color: #e0e0e0;font-weight:bold;">SURAT IJIN</th>
        </tr>
        <tr>
<?php  
$dateb = date("Y-m-d", strtotime("+3 month"));
$expired_str_kab=$this->m_berkas->ambil_berkas_from_kab($rowambil_bekerja_for_person['id_kab'],'1',$rowambil_bekerja_for_person['id_pegawai']);
foreach ($expired_str_kab as $rowexpired_str_kab){
?>
          <th>&nbsp;</th>
          <th>STR</th>
          <th>
          <?php 
            if($rowexpired_str_kab['tgl_b_berkas'] <= date('Y-m-d')){
          ?>
                 <button class="btn btn-danger btn-xs">
                    <?= date('d-m-Y', strtotime($rowexpired_str_kab['tgl_b_berkas'])) ?>
                  </button>    
          <?php 
            }elseif(($rowexpired_str_kab['tgl_b_berkas'] >= date('Y-m-d')) && ($rowexpired_str_kab['tgl_b_berkas'] <= $dateb)){
          ?>
                 <button class="btn btn-warning btn-xs">
                    <?= date('d-m-Y', strtotime($rowexpired_str_kab['tgl_b_berkas'])) ?>
                  </button> 
          <?php 
            }else{
           ?>
                 <button class="btn btn-success btn-xs">
                    <?= date('d-m-Y', strtotime($rowexpired_str_kab['tgl_b_berkas'])) ?>
                  </button>            
          <?php             
            }
          ?>
          </th>
<?php  
} 
$expired_sip_kab=$this->m_berkas->ambil_berkas_from_kab($rowambil_bekerja_for_person['id_kab'],'2',$rowambil_bekerja_for_person['id_pegawai']);
foreach ($expired_sip_kab as $rowexpired_sip_kab){
?>
          <th>SIP</th>
          <th>
          <?php 
            if($rowexpired_sip_kab['tgl_b_berkas'] <= date('Y-m-d')){
          ?>
                 <button class="btn btn-danger btn-xs">
                    <?= date('d-m-Y', strtotime($rowexpired_sip_kab['tgl_b_berkas'])) ?>
                  </button>    
          <?php 
            }elseif(($rowexpired_sip_kab['tgl_b_berkas'] >= date('Y-m-d')) && ($rowexpired_sip_kab['tgl_b_berkas'] <= $dateb)){
          ?>
                 <button class="btn btn-warning btn-xs">
                    <?= date('d-m-Y', strtotime($rowexpired_sip_kab['tgl_b_berkas'])) ?>
                  </button> 
          <?php 
            }else{
           ?>
                 <button class="btn btn-success btn-xs">
                    <?= date('d-m-Y', strtotime($rowexpired_sip_kab['tgl_b_berkas'])) ?>
                  </button>            
          <?php             
            }
          ?>
          </th>
<?php  
}
$expired_sik_kab=$this->m_berkas->ambil_berkas_from_kab($rowambil_bekerja_for_person['id_kab'],'3',$rowambil_bekerja_for_person['id_pegawai']);
foreach ($expired_sik_kab as $rowexpired_sik_kab){
?>
          <th>SIK</th>
          <th>
          <?php 
            if($rowexpired_sik_kab['tgl_b_berkas'] <= date('Y-m-d')){
          ?>
                 <button class="btn btn-danger btn-xs">
                    <?= date('d-m-Y', strtotime($rowexpired_sik_kab['tgl_b_berkas'])) ?>
                  </button>    
          <?php 
            }elseif(($rowexpired_sik_kab['tgl_b_berkas'] >= date('Y-m-d')) && ($rowexpired_sik_kab['tgl_b_berkas'] <= $dateb)){
          ?>
                 <button class="btn btn-warning btn-xs">
                    <?= date('d-m-Y', strtotime($rowexpired_sik_kab['tgl_b_berkas'])) ?>
                  </button> 
          <?php 
            }else{
           ?>
                 <button class="btn btn-success btn-xs">
                    <?= date('d-m-Y', strtotime($rowexpired_sik_kab['tgl_b_berkas'])) ?>
                  </button>            
          <?php             
            }
          ?>
          </th>
<?php  
}
?>
        </tr>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="background-color: #e0e0e0;font-weight:bold;">UNIT / RUANGAN</th>
        </tr>
        <?php // $this->m_umum->ambil_data('ruangan','id_ruangan',$rowambil_bekerja_for_person['id_ruangan']); ?>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='5'><?= $rowambil_bekerja_for_person['nama_ruangan'] ?></th>
        </tr>
        
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6' style="background-color: #e0e0e0;font-weight:bold;">PELATIHAN KHUSUS</th>
        </tr>
        
<?php
$ambil_pelatihan_person=$this->m_berkas->ambil_berkas_pelatihan_person('peg.id_pegawai',$rowambil_bekerja_for_person['id_pegawai']);
foreach ($ambil_pelatihan_person as $rowambil_pelatihan_person){
?>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6'><?= $rowambil_pelatihan_person['nama_berkas'] ?> [ <?= $rowambil_pelatihan_person['nama_kategori_pelatihan'] ?> ]</th>
        </tr>
<?php  
}
?>      
      
      </table>
    </div>
  </div>
<?php 
  }
?>
        </div>
        <!-- AKHIRI -->
        <div class="col-md-4">
          



<?php
if(!empty($id_working)){
?>
          <div class="row">
            <div class="col-md-12">
<?php 
// ============================================ UTAMA
$laki = 0;$pr = 0;
$kondisi_1=array('status_pegawai'=>1,'visible'=>1);
$select_gender = "SUM(CASE WHEN jk = '1' THEN 1 END) as mlc,SUM(CASE WHEN jk = '0' THEN 1 END) as flc";
$gender=$this->m_berkas->grafik_all_pengcab_pegawai_instansi($select_gender,$kondisi_1);
$select_agama = "COUNT(ope.id_agama) as total_agama,nama_agama,ope.id_agama";
$agama=$this->m_berkas->grafik_pengcab_pegawai_instansi($select_agama,$kondisi_1,'ope.id_agama');
$select_status_kawin = "COUNT(ope.id_status_kawin) as total_status_kawin,nama_status_kawin";
$status_kawin=$this->m_berkas->grafik_pengcab_pegawai_instansi($select_status_kawin,$kondisi_1,'ope.id_status_kawin');
$select_pendidikan = "COUNT(ope.id_pendidikan) as total_pendidikan,nama_pendidikan";
$pendidikan=$this->m_berkas->grafik_pengcab_pegawai_instansi($select_pendidikan,$kondisi_1,'ope.id_pendidikan');
$select_status_pegawai = "COUNT(ope.tipe_pegawai) as total_status_pegawai,nama_status_pegawai";
$status_pegawai=$this->m_berkas->grafik_pengcab_pegawai_instansi($select_status_pegawai,$kondisi_1,'ope.tipe_pegawai');
$select_kode_kewenangan = "COUNT(pd.id_kode_kewenangan) as total_kode_kewenangan,if(pd.id_kode_kewenangan = 0,'PK 0 / Non Koperawatan',nama_kode_kewenangan) as nama_kode_kewenangan";
$kode_kewenangan=$this->m_berkas->grafik_pengcab_pegawai_instansi($select_kode_kewenangan,$kondisi_1,'pd.id_kode_kewenangan');
$select_jabatan_fungsional = "COUNT(ope.id_jabatan_fungsional) as total_jabatan_fungsional,nama_jabatan_fungsional";
$jf=$this->m_berkas->grafik_pengcab_pegawai_instansi($select_jabatan_fungsional,$kondisi_1,'ope.id_jabatan_fungsional');
$pelatihan=$this->m_berkas->ambil_berkas_pelatihan_instansi('b.id_kategori_pelatihan');
$expired_str=$this->m_berkas->ambil_berkas_expired_ijin_instansi('1');
$expired_sip=$this->m_berkas->ambil_berkas_expired_ijin_instansi('2');
$expired_sik=$this->m_berkas->ambil_berkas_expired_ijin_instansi('3');
$select_prov = "COUNT(ope.id_prov) as total_prov,nama_prov,ope.id_prov";
$prov=$this->m_berkas->grafik_pengcab_pegawai_instansi($select_prov,$kondisi_1,'ope.id_prov');
?>
<div class="box-body table-responsive no-padding">
  <table width="100%" class="table table-hover">
    <tbody>
    <tr>
      <td style="background-color:#063970;color:white;vertical-align:middle;">
      Gender || PDF &nbsp;
<a href="<?php echo base_url('ol_grafik/demografi_rs/pdf_gender/'); ?><?= $id_working ?>" target="_blank"><i class="fa fa-file-pdf-o text-white"></i>
          </a>
    </td>
      <td style="background-color:#063970;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
    <tr>
      <td style="vertical-align:middle;">Laki-laki</td>
      <td style="vertical-align:middle;text-align: right;"><?= $gender['mlc'] ?></td>
    </tr>
    <tr>
      <td style="vertical-align:middle;">Perempuan</td>
      <td style="vertical-align:middle;text-align: right;"><?= $gender['flc'] ?></td>
    </tr>
    <tr>
      <td style="background-color:#979915;color:white;vertical-align:middle;">
      Agama || PDF &nbsp;
<a href="<?php echo base_url('ol_grafik/demografi_rs/pdf_religi/'); ?><?= $id_working ?>" target="_blank"><i class="fa fa-file-pdf-o text-white"></i>
          </a>
    </td>
      <td style="background-color:#979915;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php
foreach ($agama as $rowagama){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowagama['nama_agama'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowagama['total_agama'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#979915;color:white;vertical-align:middle;">
      Marital || PDF &nbsp;
          <a href="<?php echo base_url('ol_grafik/demografi_rs/pdf_marital/'); ?><?= $id_working ?>" target="_blank"><i class="fa fa-file-pdf-o text-white"></i>
          </a> 
    </td>
      <td style="background-color:#979915;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php
foreach ($status_kawin as $rowstatus_kawin){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowstatus_kawin['nama_status_kawin'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowstatus_kawin['total_status_kawin'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#979915;color:white;vertical-align:middle;">
      Status Pegawai || PDF &nbsp;
          <a href="<?php echo base_url('ol_grafik/demografi_rs/pdf_asn/'); ?><?= $id_working ?>" target="_blank"><i class="fa fa-file-pdf-o text-white"></i>
          </a> 
    </td>
      <td style="background-color:#979915;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($status_pegawai as $rowstatus_pegawai){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowstatus_pegawai['nama_status_pegawai'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowstatus_pegawai['total_status_pegawai'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#979915;color:white;vertical-align:middle;">
      PK || PDF &nbsp;
          <a href="<?php echo base_url('ol_grafik/demografi_rs/pdf_kd/'); ?><?= $id_working ?>" target="_blank"><i class="fa fa-file-pdf-o text-white"></i>
          </a> </td>
      <td style="background-color:#979915;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($kode_kewenangan as $rowkode_kewenangan){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowkode_kewenangan['nama_kode_kewenangan'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowkode_kewenangan['total_kode_kewenangan'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#063970;color:white;vertical-align:middle;">
        Surat Ijin &nbsp; <i class="fa fa-file-pdf-o text-white"></i>
        || 
          <a href="<?php echo base_url('ol_grafik/demografi_rs/pdf_surat_ijin_aktif/'); ?><?= $id_working ?>" target="_blank"> Aktif
          </a> 
        || 
          <a href="<?php echo base_url('ol_grafik/demografi_rs/pdf_surat_ijin_tenggang/'); ?><?= $id_working ?>" target="_blank"> Tenggang
          </a> 
        || 
          <a href="<?php echo base_url('ol_grafik/demografi_rs/pdf_surat_ijin_expired/'); ?><?= $id_working ?>" target="_blank"> Expired
          </a> 
      </td>
      <td style="background-color:#063970;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php
foreach ($expired_str as $rowexpired_str){
?>
    <tr>
      <td style="background-color:#FE0101;color:white;vertical-align:middle;">Expired STR</td>
      <td style="background-color:#FE0101;color:white;vertical-align:middle;text-align: right;"><?= $rowexpired_str['total_str'] ?></td>
    </tr>
<?php 
}
foreach ($expired_sip as $rowexpired_sip){
?>
    <tr>
      <td style="background-color:#FE0101;color:white;vertical-align:middle;">Expired SIP</td>
      <td style="background-color:#FE0101;color:white;vertical-align:middle;text-align: right;"><?= $rowexpired_sip['total_str'] ?></td>
    </tr>
<?php 
}
foreach ($expired_sik as $rowexpired_sik){
?>
    <tr>
      <td style="background-color:#FE0101;color:white;vertical-align:middle;">Expired SIK</td>
      <td style="background-color:#FE0101;color:white;vertical-align:middle;text-align: right;"><?= $rowexpired_sik['total_str'] ?></td>
    </tr>
<?php 
}
?>
    </tbody>
  </table>              
            </div>
            </div>
            <div class="col-md-12">
<div class="box-body table-responsive no-padding">
  <table width="100%" class="table table-hover">
    <tbody>
    <tr>
      <td style="background-color:#063970;color:white;vertical-align:middle;">
      Pendidikan || PDF &nbsp;
          <a href="<?php echo base_url('ol_grafik/demografi_rs/pdf_pendidikan/'); ?><?= $id_working ?>" target="_blank"><i class="fa fa-file-pdf-o text-white"></i>
          </a> 
    </td>
      <td style="background-color:#063970;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($pendidikan as $rowpendidikan){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowpendidikan['nama_pendidikan'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowpendidikan['total_pendidikan'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#979915;color:white;vertical-align:middle;">
      Jabatan Fungsional || PDF &nbsp;
          <a href="<?php echo base_url('ol_grafik/demografi_rs/pdf_jabfung/'); ?><?= $id_working ?>" target="_blank"><i class="fa fa-file-pdf-o text-white"></i>
          </a> 
    </td>
      <td style="background-color:#979915;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($jf as $rowjf){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowjf['nama_jabatan_fungsional'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowjf['total_jabatan_fungsional'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#979915;color:white;vertical-align:middle;">
      Pelatihan || PDF &nbsp;
<a href="<?php echo base_url('ol_grafik/demografi_rs/pdf_pelatihan/'); ?><?= $id_working ?>" target="_blank"><i class="fa fa-file-pdf-o text-white"></i>
          </a>
    </td>
      <td style="background-color:#979915;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($pelatihan as $rowpelatihan){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowpelatihan['nama_kategori_pelatihan'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowpelatihan['total_pelatihan'] ?></td>
    </tr>
<?php 
}
?>
    </tbody>
  </table>              
            </div>
            </div>
            <div class="col-md-12">
<div class="box-body table-responsive no-padding">
  <table width="100%" class="table table-hover">
    <tbody>
    <tr>
      <td style="background-color:#979915;color:white;vertical-align:middle;">
        Alamat || PDF &nbsp;
<a href="<?php echo base_url('ol_grafik/demografi_rs/pdf_alamat/'); ?><?= $id_working ?>" target="_blank"><i class="fa fa-file-pdf-o text-white"></i>
          </a>
      </td>
      <td style="background-color:#979915;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($prov as $rowprov){
?>
    <tr>
      <td style="background-color:#063970;color:white;vertical-align:middle;"><?= $rowprov['nama_prov'] ?></td>
      <td style="background-color:#063970;color:white;vertical-align:middle;text-align: right;"><?= $rowprov['total_prov'] ?></td>
    </tr>
<?php 
$kondisi_kab=array('ope.id_prov'=>$rowprov['id_prov']);
$select_kab = "COUNT(ope.id_kab) as total_kab,nama_kab,ope.id_kab";
$kab=$this->m_berkas->grafik_pengcab_pegawai_instansi($select_kab,$kondisi_kab,'ope.id_kab');
  foreach ($kab as $rowkab){
$kondisi_kec=array('ope.id_kab'=>$rowkab['id_kab']);
$select_kec = "COUNT(ope.id_kec) as total_kec,nama_kec,ope.id_kec";
$kec=$this->m_berkas->grafik_pengcab_pegawai_instansi($select_kec,$kondisi_kec,'ope.id_kec');
?>
    <tr>
      <td style="background-color:#8C0720;color:white;vertical-align:middle;padding-left: 20px;">&nbsp;&nbsp;<?= $rowkab['nama_kab'] ?></td>
      <td style="background-color:#8C0720;color:white;vertical-align:middle;text-align: right;"><?= $rowkab['total_kab'] ?></td>
    </tr>
<?php
    foreach ($kec as $rowkec){
$kondisi_kec=array('ope.id_kec'=>$rowkec['id_kec']);
$select_kel = "COUNT(ope.id_kel) as total_kel,nama_kel,ope.id_kel";
$kel=$this->m_berkas->grafik_pengcab_pegawai_instansi($select_kel,$kondisi_kec,'ope.id_kel');
?>
    <tr>
      <td style="background-color:#078C8A;color:white;vertical-align:middle;padding-left: 35px;"><?= $rowkec['nama_kec'] ?></td>
      <td style="background-color:#078C8A;color:white;vertical-align:middle;text-align: right;"><?= $rowkec['total_kec'] ?></td>
    </tr>
<?php
      foreach ($kel as $rowkel){
?>
    <tr>
      <td style="background-color:#238C07;color:white;vertical-align:middle;padding-left: 50px;"><?= $rowkel['nama_kel'] ?></td>
      <td style="background-color:#238C07;color:white;vertical-align:middle;text-align: right;"><?= $rowkel['total_kel'] ?></td>
    </tr>
<?php
      }
    }
  }
}
?>
    </tbody>
  </table>              
            </div>
            </div>
          </div>

<?php 
}
?>









        </div>
      </div>
    </div>
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
