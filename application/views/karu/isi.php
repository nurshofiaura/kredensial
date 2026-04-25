<?php
//=================================== H O M E ================================================
$arraybox = array('warning','success','info','danger');
$resarray = array_rand($arraybox);
$thenarray = $arraybox[$resarray];
if ($page=="home")
{
?>
  <div class="content-wrapper">
    <section class="content">
	<div class="col-md-8">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">PENGUMUMAN</h3>

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
      </div>
    </div>
	<div class="col-md-4">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">SURAT IJIN EXPIRED</h3>

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
				foreach($ambil_berkas_expired_all as $row){
				if(empty($row['foto'])){
					$url_thumbx=base_url().'assets/images/noavatar.jpg';
					$url_picbesarx=base_url().'assets/images/noavatar.jpg';
				}else{
					$cek_filesmall=FCPATH.'assets/foto/'.$row['foto'];
					if(file_exists($cek_filesmall)){
						$url_thumbx=base_url().'assets/foto/'.$row['foto'];
						$url_picbesarx=base_url().'assets/foto/'.$row['foto'];
					}else{
						$url_thumbx=base_url().'assets/images/noavatar.jpg';
						$url_picbesarx=base_url().'assets/images/noavatar.jpg';
					}
				}
				?>
			<div class="direct-chat-msg">
			  <div class="direct-chat-info clearfix">
				<span class="direct-chat-name pull-left"><?php echo $row['nama_pegawai']; ?></span>
				<span class="direct-chat-timestamp pull-right"> <?php echo date('d-m-Y', strtotime($row['tgl_b_berkas'])); ?></span>
			  </div>
				<a class="example-image-link" href="<?php echo $url_picbesarx; ?>"
					data-lightbox="example-set" data-title="<?php echo $row['nama_pegawai']; ?> - <?php echo $row['nama_ruangan']; ?>">
					<img class="direct-chat-img" src="<?php echo $url_thumbx; ?>" alt="message user image">
				</a>
				<span class="label label-danger pull-right"><?php echo $row['nama_kategori_berkas']; ?></span>
			  <!-- /.direct-chat-text -->
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
elseif ($page=="grafik")
{
?>
  <div class="content-wrapper">
    <section class="content">
      <div class="box">
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
	<div class="col-md-2">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">PILIH PERIODE</h3>

          <div class="box-tools pull-right">

          </div>
        </div>
		<?php echo form_open('karu/grafik/view/'.$bln.'/'.$thn,' class="form-horizontal"'); ?>
        <div class="box-body">
				<label>Tahun</label>
					<?php
						input_pdselect2("thn",$year_logbook,$thn);
					?>

        </div>
		<div class="box-footer">
		<button type="submit" name="action" value="BtnProses" class="btn btn-primary btn-md pull-left"><i class="fa fa-recycle"></i> Proses</button>
        </div>
		<?php echo form_close(); ?>
      </div>
    </div>
	<div class="col-md-10">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">GRAFIK POIN LOGBOOK TIAP PEGAWAI</h3>

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
    </div>
        </div>
      </div>
    </section>
</div>
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
<?php
}
elseif ($page=="user")
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
					  <th>No Profesi</th>
					  <th>E-mail</th>
					  <th>Satus</th>
					  <th>Gambar</th>
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
		  <?php echo form_open_multipart('karu/user/edit/'.$id,' id="signupform" ');
				input_text("id_user",$id_user,"","","hidden");
				input_text("id_pegawai",$id_pegawai,"","","hidden");
				input_text("wa",$pake_wa,"","","hidden");
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
							  <label>Jabatan Pegawai</label>
								<?php
									input_pdselect2("tipe_pegawai",$cmd_tipe_pegawai,$tipe_pegawai);
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
							  <label>Jenis Kelamin</label>
								<?php
									input_pdselect2("jk",$gender,$jk);
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
elseif ($page=="etik")
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
	<?php echo form_open_multipart('karu/etik/view/'.$id,' id="signupform" '); ;
	?>
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
           <h3 class="box-title"></h3>
			<a href="<?php echo base_url('karu/etik/pdf/'); ?>" target="_blank" class="btn btn-white btn-md">
				<i class="fa fa-file-pdf-o"></i> PDF
			</a>
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
elseif ($page=="etik_tambah")
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
	  <?php echo form_open_multipart('karu/etik/tambah/'.$id,' id="signupform" '); ;
	  input_text("id_pegawai",$id,"","","hidden");
	  input_text("id_penguji",$member_id,"","","hidden");
	  if($num_kol_etik_all['count_koletik']==0){
		  $disableded = "disabled";
	  }else{
		  $disableded = "";
	  }
	  ?>
					  <table id="example1" width="100%" class="table table-bordered table-striped">
						  <thead>
							<tr>
								<th style="background-color:#9b0e27;color:white;vertical-align:middle;sidth:5%">No</th>
								<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Etik</th>
								<th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align:center;width:10%;">YA</th>
								<th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align:center;width:10%;">TIDAK</th>
							</tr>
						  </thead>
						  <tbody>
								<?php
								$no = 0;
								foreach($kol_etik_all as $row){
									$no++;
								?>
							<tr>
								<td style="vertical-align:middle;"><?php echo $no;?></td>
								<td style="vertical-align:middle;"><?php input_text("id_etik[]",$row['id_etik'],"","","hidden"); ?><?php echo $row['nama_etik'];?></td>
								<td style="vertical-align:middle;text-align:center;">
								  <div class="radio">
									<label>
									  <input type="radio" onchange="total_GR()" name="skor_etik<?php echo $row['id_etik']; ?>" value="<?php if($row['answer']=="1") {echo "1";}else{echo "0";}?>" checked="checked">
									</label>
								  </div>
								</td>
								<td style="vertical-align:middle;text-align:center;">
								  <div class="radio">
									<label>
									  <input type="radio" onchange="total_GR()" name="skor_etik<?php echo $row['id_etik']; ?>" value="<?php if($row['answer']=="0") {echo "1";}else{echo "0";}?>">
									</label>
								  </div>
								</td>
							</tr>
								<?php
									}
								?>
						  </tbody>
					  </table>
					  <hr>
					  <div class="col-md-3">
						<div class="form-group">
						  <label>Hasil</label>
							<?php
								input_text("sub_total",0,"maxlength='255' onchange='total_GR()' readonly","","hidden");
								input_text("hasilGR",0,"maxlength='255' readonly","","text");
								input_text("total",$num_kol_etik_all['count_koletik'],"maxlength='255' ","","hidden");
							?>
						</div>
					   </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary" <?php echo $disableded; ?> >Submit</button>
        </div>
      </div>
	  <?php echo form_close(); ?>
    </section>
</div>
<?php
}
elseif ($page=="etik_lihat")
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
					  <table id="example1" width="100%" class="table table-bordered table-striped">
						  <thead>
							<tr>
								<th style="background-color:#9b0e27;color:white;vertical-align:middle;">No</th>
								<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Etik</th>
								<th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align:center;">Jawaban</th>
								<th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align:center;">Terpilih</th>
								<th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align:center;">Skor</th>
								<th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align:center;">Jumlah</th>
							</tr>
						  </thead>
						  <tbody>
								<?php
								$jumlahe = 0; $No = 0;
								foreach($kol_etik_detil_all as $row){
									$jumlahe = $jumlahe + $row['skor_etik'];
									$No++;
								?>
							<tr>
								<td style="vertical-align:middle;"><?php echo $No; ?></td>
								<td style="vertical-align:middle;"><?php echo $row['nama_etik'];?></td>
								<td style="vertical-align:middle;text-align:center;">
								<?php
									if($row['answer']=="0") { // NO
										echo "TIDAK";
									}else if($row['answer']=="1"){
										echo "YA";
									}
								?>
								</td>
								<td style="vertical-align:middle;text-align:center;">
								<?php
									if($row['answer']=="0" AND $row['skor_etik']=="0") { // NO
										echo "YA";
									}else if($row['answer']=="0" AND $row['skor_etik']=="1"){
										echo "TIDAK";
									}else if($row['answer']=="1" AND $row['skor_etik']=="1"){
										echo "YA";
									}else if($row['answer']=="1" AND $row['skor_etik']=="0"){
										echo "TIDAK";
									}
								?>
								</td>
								<td style="vertical-align:middle;text-align:center;"><?php echo $row['skor_etik'];?></td>
								<td style="vertical-align:middle;text-align:center;"><?php echo $jumlahe;?></td>
							</tr>
								<?php
									}
								?>
						  </tbody>
					  </table>
					  <hr>
					  <div class="col-md-6">
						<div class="form-group">
						  <label>Hasil</label>
							<?php
								input_text("total",$etik_pegawairow_all['hasil_etik'],"maxlength='255' ","","text");
							?>
						</div>
					   </div>
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
		  <div class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">
			  <?php $logoe=base_url().'assets/images/logosim.png'; ?>
                <img class="img-circle" src="<?php echo $logoe; ?>" alt="User Image">
                <span class="username">CATATAN</span>
                <span class="description"><?php echo $instance_name;?></span>
              </div>
              <!-- /.user-block -->
              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- post text -->
              <h5>Mohon perhatikan :
			  <ul style="line-height: 1.6;">
				<li>Tidak dapat memvalidasi diri sendiri.</li>
				<li>Tidak dapat memvalidasi yang sudah di validasi Jabatan Lainnya.</li>
			  </ul>
			  </h5>

            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </div>
	<div class="col-md-8">
	<?php echo form_open_multipart('karu/logbook/view/'.$first_date.'/'.$last_date.'/'.$id,' id="signupform" '); ;
	?>
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
          <div class="box-tools pull-right">
			<?php
				input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
			?>
          </div>
			<table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
				<thead>
					<tr>
					  <th width="5%"></th>
					  <th>Nama</th>
					  <th>Tanggal</th>
					  <th>Jam</th>
					  <th>Kode</th>
					  <th>Nama Kewenangan</th>
					  <th>Jml</th>
					  <th width="8%">Validasi</th>
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
