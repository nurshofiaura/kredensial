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
      <div class="box box-<?php echo $thenarray; ?> box-solid">
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
    <a href="<?php echo base_url('landing/#logbook');?>"
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
          </div>
        </div>
        <div class="box-body">
			<div class="col-md-12">
			  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
				<div class="box-header with-border">
				  <h3 class="box-title">CATATAN</h3>
				</div>
				  <div class="box-body">
				  <div class="box box-widget">
					<div style="font-weight:bold;color:green;" class="box-body">
					<Ol>
						<li>UNTUK OPPE WAJIB MENGISI LOGBOOK MINIMAL 1X DALAM 1BULAN</li>
						<li>UNTUK OPPE WAJIB MENGIKUTI DAN MENGUPLOAD SERTIFIKAT PELATIHAN MINIMAL 4 DALAM 1 BULAN</li>
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
					<a href="<?php echo base_url('s_logbook/logbook/pdf_logbook'); ?>" target="_blank" class="btn btn-white btn-md">
						<i class="fa fa-file-pdf-o"></i> BCP LOGBOOK
					</a> ||
					<a href="<?php echo base_url('s_logbook/logbook/pdf_eukom'); ?>" target="_blank" class="btn btn-white btn-md">
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
							  <th style="vertical-align:middle;font-weight:bold;display:none;"></th>
							  <th style="vertical-align:middle;font-weight:bold;">Tanggal</th>
							  <th style="vertical-align:middle;font-weight:bold;">PK</th>
							  <th style="vertical-align:middle;font-weight:bold;">Nama Kewenangan</th>
							  <th style="vertical-align:middle;font-weight:bold;">Mandiri / Supervisi (Pemulihan)</th>
							</tr>
						</thead>
					</table>
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
		<a href="<?php echo $link_kembali;?>"
			class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
		</a>
    </section>
    <section class="content">
	<?php echo form_open_multipart('s_logbook/logbook/tambah/'.$id_jabatan.'/'.$id_jabatan_fungsional.'/'.$id_ruangan.'/'.$opsi_kewenangan.'/'.$id_kode_kewenangan ,' id="signupform" ');
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
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">SILAHKAN PILIH OPSINYA</h3>
    </div>
      <div class="box-body">
      <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <label>Pilih Opsi</label>
                <?php
                  input_pdselect2("opsi_kewenangan",$cmd_opsi,$opsi_kewenangan);
                ?>
              </div>
            </div>        
            <div class="col-md-3">
              <div class="form-group">
                <label>Profesi (Opsi Butir Kegiatan)</label>
                <?php
                  input_pdselect2("id_jabatan",$cmd_jabatan,$id_jabatan);
                ?>
              </div>
            </div>   
        <div class="col-md-3">
          <div class="form-group">
            <label>Jabatan Fungsional (Opsi Butir Kegiatan)</label>
              <?php
              input_pdselect2("id_jabatan_fungsional",$cmd_jabfung_buket,$id_jabatan_fungsional);
              ?>
          </div>
        </div>                 
        <div class="col-md-2">
          <div class="form-group">
            <label>Kompetensi</label>
              <?php
        input_pdselect2fleksibel("id_ruangan","id_ruangan",$cmd_ruangan,"id_ruangan","nama_ruangan",$id_ruangan,"Semua Kewenangan");
              ?>
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <label>PK</label>
              <?php
        input_pdselect2("id_kode_kewenangan",$kol_kode_kewenangan_null_pk,"id_kode_kewenangan");
              ?>
          </div>
        </div>
      </div>
      </div>
      <div class="box-footer">
    <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
      </div>
    </div>
		  <table id="example1" width="100%" class="table table-bordered table-striped">
			  <thead>
				<tr>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;">
						<input name="select_all" class="checkall" type="checkbox" />
					</th>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kewenangan - Tolak</th>
          <?php  
            if($opsi_kewenangan == 0){
          ?>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kompetensi</th>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kode</th>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Sifat</th>
          <?php  
            }
          ?>
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
						  <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_kewenangan'];?>" >
						</label>
					  </div>
					</td>
					<td style="vertical-align:middle;"><?php echo $row['nama_kewenangan']; ?></td>
          <?php  
            if($opsi_kewenangan == 0){
          ?>
          <td style="vertical-align:middle;"><?php echo $row['nama_kompetensi']; ?></td>
					<td style="vertical-align:middle;"><?php echo $row['nama_kode_kewenangan']; ?></td>
					<td style="vertical-align:middle;"><?php echo $row['nama_sifat_kewenangan']; ?></td>
					<td style="vertical-align:middle;"><?php echo $row['nama_jabatan']; ?></td>
          <?php  
            }else{
          ?>
          <td style="vertical-align:middle;"><?php echo $row['nama_jabatan_fungsional']; ?></td>
          <?php
            }
          ?>
				</tr>
					<?php
						}
					?>
			  </tbody>
		  </table>
        </div>
        <div class="box-footer">
<button type="submit" name="action" value="BtnSimpan" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
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
		<a href="<?php echo $link_awal;?>"
			class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
		</a>
    </section>
    <section class="content">
	<?php echo form_open_multipart('s_logbook/logbook/isi/'.$id_jabatan,' id="signupform" ');
  input_text("id_ruangan",$id_ruangan,"","","hidden"); // chk
	?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
			<div class="col-md-2">
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
					if(in_array($row['id_kewenangan'], $terpilih)){
						input_text("id_kewenangan[]",$row['id_kewenangan'],"","","hidden");
            $jml_log = $this->m_sample->jumlah_record_logbook($row['id_kewenangan']);
            if($jml_log == 0){
				?>
		<div class="row">
			<div class="col-md-2">
				<label><strong>Jumlah</strong></label>
				<?php 
				input_textcustom("jml_logbook[]","1","maxlength='5' required class='form-control' 
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
			<button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
        </div>
      </div>
	<?php echo form_close(); ?>
    </section>
</div>
<?php
}