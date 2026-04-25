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
				<li>Validasi Karu dengan PENGAJUAN KOMPETENSI klik validasi Karu Saja (Karu Setuju/Proses/Tolak)</li>
				<li>Validasi Karu tanpa PENGAJUAN KOMPETENSI klik validasi Kabid Saja (Kabid Setuju/Proses/Tolak)</li>
				<li>Validasi Karu tanpa PENGAJUAN KOMPETENSI tidak bisa mendapatkan SURAT PENUGASAN KLINIS</li>
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
	<?php echo form_open_multipart('kabid/logbook/view/'.$first_date.'/'.$last_date.'/'.$id,' id="signupform" '); ; 
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
					  <th>ID</th>
					  <th>Nama</th>
					  <th>Tanggal</th>
					  <th>Ruangan</th>
					  <th>Kode</th>
					  <th>Nama Kewenangan</th>
					  <th>Jml</th>
					  <th width="8%">Karu</th>
					  <th width="8%">Kabid</th>
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
	<?php echo form_open_multipart('kabid/etik/view/'.$id,' id="signupform" '); ; 
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
	  <?php echo form_open_multipart('kabid/etik/tambah/'.$id,' id="signupform" '); ; 
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
elseif ($page=="pengajuan_kompetensi")
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
elseif ($page=="pengajuan_kompetensi_isi")
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
		<a href="<?php echo $link_awal;?>"
			class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
		</a>
    </section>
    <section class="content">
	  <?php echo form_open_multipart('kabid/pengajuan_kompetensi/isi/'.$id,' id="signupform" '); ;   
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
		<div class="row">
			<div class="col-md-4">
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
	    </div>	
			<div class="col-md-8">
	      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
	        <div class="box-header with-border">
	           <h3 class="box-title">BERKAS DAN ETIK</h3>

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
			           <h3 class="box-title">BERKAS</h3>

			          <div class="box-tools pull-right">
			          	<i class="fa fa-search"></i> KLIK BERKAS UNTUK MELIHAT &nbsp;
			            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
			                    title="Collapse">
			              <i class="fa fa-minus"></i></button>
			            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
			              <i class="fa fa-times"></i></button>
			          </div>
			        </div>
			        <div class="box-body">
								  <p><i class="fa fa-book margin-r-5"></i> Ijasah</p>
								  <?php
									if($id_ijasah!==""){
										foreach($ambil_berkas_data as $row){
											if (in_array($row['id_berkas'],$id_ijasah)) {
								  ?>
									<p><a href="<?php echo base_url('assets/berkas/'.$row['link_berkas']);?>" target="_blank" class="label label-primary">
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
									<p><a href="<?php echo base_url('assets/berkas/'.$row2['link_berkas']);?>" target="_blank" class="label label-info">
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
									<p><a href="<?php echo base_url('assets/berkas/'.$row3['link_berkas']);?>" target="_blank" class="label label-success">
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
									<p><a href="<?php echo base_url('assets/berkas/'.$row4['link_berkas']);?>" target="_blank" class="label label-warning">
										<i class="fa fa-search"> </i> <?php echo $row4['nama_berkas']; ?>
									</a></p>						
								  <?php
											}
										}
									}
								  ?>	
			        </div>
			      </div>
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
			        </div>
			      </div>
	        </div>
	      </div>	  
	    </div>	
			<div class="col-md-9">
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
	      </div>	  
	    </div>	
			<div class="col-md-3">
	      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
	        <div class="box-header with-border">
	           <h3 class="box-title">DAFTAR KOMPETENSI</h3>
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
			<div class="col-md-6">
	      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
	        <div class="box-header with-border">
	           <h1 class="box-title">MOHON PERHATIKAN TOMBOL AKAN MUNCUL BILA JUMLAH DAN TERVALIDASI SAMA</h1>
	          <div class="box-tools pull-right"></div>
	        </div>
	        <div class="box-body">
					<p><span class="blinking"><i class="fa fa-exclamation"></i></span>
					<span class="rainbow-text">VALIDASI DAHULU SEMUA LOGBOOK => SIMPAN DAN ACC => SIMPAN SETUJU / TOLAK </span></p>
						 <?php if($acc_logbook_kabid=='0' AND $tampilkan_button == 'sama'){ ?>
							<button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-check"></i> Simpan dan Acc</button>
						<?php
						 } 
						 ?>	
	        </div>
	      </div>	  
	    </div>	
			<div class="col-md-6">
	      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
	        <div class="box-header with-border">
	           <h1 class="box-title">MOHON PERHATIKAN TOMBOL AKAN MUNCUL BILA JUMLAH DAN TERVALIDASI SAMA</h1>
	          <div class="box-tools pull-right"></div>
	        </div>
	        <div class="box-body">
					<p><span class="blinking"><i class="fa fa-exclamation"></i></span>
					<span class="rainbow-text">VALIDASI DAHULU SEMUA LOGBOOK => SIMPAN DAN ACC => SIMPAN SETUJU / TOLAK </span></p>
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
    </div>	
	  <?php echo form_close(); ?>
    </section>
</div>
<?php
}
elseif ($page=="pengajuan_kompetensi_asesor")
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
          <div class="box-tools pull-right">
			<?php
			//	input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
			?>
          </div>
			<table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
				<thead>
					<tr>
					  <th style="width:5%;">ID</th>
					  <th>Nama</th>
					  <th>Hp</th>
					  <th>PK</th>
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
      <div class="modal-body" style="padding:10px; font-size:12px;">

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
elseif ($page=="pengajuan_kompetensi_histori")
{
?>
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
			<div class="box-header with-border">
			  <h3 class="box-title"><i class="fa fa-user"> HISTORI ASESOR</i></h3>
			</div>
			  <ul class="list-group list-group-unbordered">
			  <?php
			  foreach($ambil_asesor as $row){
			  ?>
				<li class="list-group-item">
				  <strong><i class="fa fa-calendar margin-r-5"></i> Tanggal Pengajuan : <?php echo date('d-m-Y', strtotime($row['tgl_pengajuan'])); ?></strong>
				  <p class="text-muted"><strong><i class="fa fa-file-text margin-r-5"></i> Asesi : <?php echo $row['nama_pegawai']; ?></strong></p>
				  
				</li>
			  <?php
			  }
			  ?>
			  </ul>
        </div>
        <div class="box-footer">
          
        </div>
      </div>
<?php
}