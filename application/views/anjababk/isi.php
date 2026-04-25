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
        <div class="box-footer">
          
        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="butir_kegiatan")
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
	<div class="col-md-6">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">CATATAN MOHON DIPERHATIKAN</h3>

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
            <div class="box-body">
              <!-- post text -->
              <h5>
			  <ul style="line-height: 1.6;">
				<li>Butir Kegiatan ini dapat digunakan untuk Analisa Beban Kerja dan DUPAK jadi mohon dibuat dengan sebenarnya</li>
			  </ul>
			  </h5>

            </div>
            <!-- /.box-body -->
          </div>				  
        </div>
      </div>
    </div>
	<div class="col-md-6">
	<?php echo form_open_multipart('anjababk/butir_kegiatan/view/'.$id,' id="signupform" '); ; 
	?>
	  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
		<div class="box-header with-border">
		  <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
		</div>
		  <div class="box-body">
			<div class="row">
				<div class="col-md-11">
					<div class="form-group">
					  <label>Jabatan Fungsional</label>
							<?php
								input_pdselect2fleksibel("id","id",$cmd_jabfung_buket,"id_jabatan_fungsional","nama_jabatan_fungsional",$id,"Silahkan Pilih JabFung");
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
					  <th style="display:none;">ID</th>					  
					  <th>Butir Kegiatan</th>					  
					  <th width="25%">Jabatan Fungsional</th>		
					  <th>Angka Kredit</th>		
					  <th>Satuan</th>		
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
elseif ($page=="butir_kegiatan_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('anjababk/butir_kegiatan/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">
			<input type="hidden" name="id" value="<?= $id; ?>">
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
					  <label>Jabatan Fungsional</label>
						<?php
							input_pdselect2("id_jabatan_fungsional",$cmd_jabatan_fungsional_id,$id_jabatan_fungsional);
						?>	
					</div>		
					<div class="form-group">
					  <label id="text_nama_butir_kegiatan">Butir Kegiatan</label>
						<?php
							input_text("nama_butir_kegiatan",$nama_butir_kegiatan,"maxlength='255' autofocus required","Masukkan Butir Kegiatan","text");
						?>	
					</div>	
					<div class="form-group">
					  <label id="text_ms_angka_kredit">Angka Kredit</label>
						<?php
							input_textcustom("angka_kredit",$angka_kredit," class='form-control' required onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46' maxlength='7' autocomplete='off' ","","text");
						?>
					</div>					
					<div class="form-group">
					  <label>Satuan Hasil</label>
						<?php
							input_text("satuan_hasil",$satuan_hasil,"maxlength='255' required","Masukkan Satuan Hasil","text");
						?>	
					</div>					
					<div class="form-group">
					  <label>Status</label>
							<?php
								input_pdselect2("status_butir_kegiatan",$cmd_status,$status_butir_kegiatan);
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
elseif ($page=="butir_kegiatan_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('anjababk/butir_kegiatan/simpan_edit');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">
			<input type="hidden" name="id" value="<?= $id; ?>">
			<input type="hidden" name="id_butir_kegiatan" value="<?= $id_butir_kegiatan; ?>">
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
					  <label>Jabatan Fungsional</label>
						<?php
							input_pdselect2("id_jabatan_fungsional",$cmd_jabatan_fungsional_id,$id_jabatan_fungsional);
						?>	
					</div>		
					<div class="form-group">
					  <label id="text_nama_butir_kegiatan">Butir Kegiatan</label>
						<?php
							input_text("nama_butir_kegiatan",$nama_butir_kegiatan,"maxlength='255' autofocus required","Masukkan Butir Kegiatan","text");
						?>	
					</div>	
					<div class="form-group">
					  <label id="text_ms_angka_kredit">Angka Kredit</label>
						<?php
							input_textcustom("angka_kredit",$angka_kredit," class='form-control' required onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46' maxlength='7' autocomplete='off' ","","text");
						?>
					</div>					
					<div class="form-group">
					  <label>Satuan Hasil</label>
						<?php
							input_text("satuan_hasil",$satuan_hasil,"maxlength='255' required","Masukkan Satuan Hasil","text");
						?>	
					</div>					
					<div class="form-group">
					  <label>Status</label>
							<?php
								input_pdselect2("status_butir_kegiatan",$cmd_status,$status_butir_kegiatan);
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
elseif ($page=="informasi_jabatan_abk")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small> <?php echo $instance_name; ?></small>
      </h1>
    </section>
    <section class="content">
	<?php echo form_open_multipart('anjababk/informasi_jabatan/abk/'.$id.'/'.$id_bk_detil,' '); 
	input_text("id_kompetensi",$id_kompetensi,"","","hidden");
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
							input_text("nama_kompetensi",$nama_kompetensi,"maxlength='255' readonly required","Masukkan Kompetensi","text");
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
					<div class="col-md-2">
						<div class="form-group">
						  <label>Vol Logbook 1 Th</label>
							<?php
								input_text("jumlah",$jumlah,"maxlength='255' readonly","0","text");
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
						  <label id="text_ms_wpk">Waktu Penyelesaian Kegiatan (Jam)</label>
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
								input_textcustom("angka_kredit",$angka_kredit," class='form-control' id='angka_kredit' required onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46' maxlength='7' autocomplete='off' ","","text");
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
// =========================================================
elseif ($page=="pegawai")
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
				input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
			?>
          </div>
			<table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
				<thead>
					<tr>
					  <th>Nama Pegawai</th>					  
					  <th>Jabatan Fungsional</th>					  					  	
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
elseif ($page=="pegawai_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('anjababk/pegawai/simpan_edit');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">
          <input type="hidden" name="id_pegawai" value="<?= $id_pegawai; ?>">
          </div>
        </div>
		<div class="box-body">     
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title"><?php $title; ?></h3>
			</div>
			  <div class="box-body">
					<div class="col-md-12">
					  <label>Nama Pegawai</label>
						<?php
							 input_text("nama_pegawai",$nama_pegawai,"maxlength='255'","Masukkan Nama","text");
						?>	
					</div>
					<div class="col-md-12">
					  <label>Jabatan Fungsional</label>
						<?php
							 input_pdselect2("id_jabatan_fungsional",$cmd_jabatan_fungsional,$id_jabatan_fungsional);
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
elseif ($page=="informasi_jabatan")
{
?> 
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
	<?php echo form_open_multipart('anjababk/informasi_jabatan/view/'.$id,' id="signupform" '); ; 
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
					  <th>ASN</th>					  	
					  <th>CASN</th>					  	
					  <th>BLUD</th>					  	
					  <th>PPPK</th>					  	
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
elseif ($page=="informasi_jabatan_periode")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('anjababk/informasi_jabatan/simpan_periode');?>" onClick="return cek();">
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
				url:'<?php echo base_url();?>anjababk/jabfung/'+$(this).val(),
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
elseif ($page=="informasi_jabatan_pemenuhan_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('anjababk/informasi_jabatan/simpan_pemenuhan_tambah');?>" onClick="return cek();">
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
elseif ($page=="informasi_jabatan_pemenuhan_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('anjababk/informasi_jabatan/simpan_pemenuhan_edit');?>" onClick="return cek();">
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
elseif ($page=="informasi_jabatan_isi_pegawai")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('anjababk/informasi_jabatan/simpan_isi_pegawai');?>" onClick="return cek();">
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
				<div class="form-group">
				<div class="col-md-6">
					  <label>PEGAWAI ASN</label>
						<?php
							input_textcustom("pns",$pns," class='form-control' onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength='4' autocomplete='off' ","","text");
						?>	
					</div>
					<div class="col-md-6">
					  <label>PEGAWAI CASN</label>
						<?php
							input_textcustom("cpns",$cpns," class='form-control' onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength='4' autocomplete='off' ","","text");
						?>	
					</div>
					<div class="col-md-6">
					  <label>PEGAWAI PPPK</label>
						<?php
							input_textcustom("pppk",$pppk," class='form-control' onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength='4' autocomplete='off' ","","text");
						?>	
					</div>
					<div class="col-md-6">
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
elseif ($page=="informasi_jabatan_copy")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('anjababk/informasi_jabatan/simpan_copy');?>" onClick="return cek();">
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
elseif ($page=="informasi_jabatan_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('anjababk/informasi_jabatan/simpan_edit');?>" onClick="return cek();">
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
				<div class="form-group">
					<div class="col-md-2">
					  <label>Periode</label>
						<?php
							input_pdselect2("periode",$cmd_range_tahun,$periode);
						?>
					</div>		
					  <div class="col-md-5">
						<label>Nama Jabatan</label>
						<?php
							input_pdselect2("id_jabatan_fungsional",$cmd_jabatan_fungsional,$id_jabatan_fungsional);
						?>
					  </div>
					  <div class="col-md-5">
						<label>Atasan Langsung</label>
						<?php
							input_pdselect2("id_struktur_jabatan",$cmd_struktur_jabatan,$id_struktur_jabatan);
						?>
					  </div>
					  <div class="col-md-4">
							<label>Header</label>
							<?php
								input_text("header",$header,"  ","Ketik ","text");
							?>
					  </div>
					  <div class="col-md-4">
							<label>Sub Header</label>
							<?php
								input_text("sub_header",$sub_header,"  ","Ketik ","text");
							?>
					  </div>
					  <div class="col-md-4">
							<label>Sub Sub Header</label>
							<?php
								input_text("sub_sub_header",$sub_sub_header,"  ","Ketik ","text");
							?>
					  </div>
					  <div class="col-md-4">
							<label>Header Pemenuhan</label>
							<?php
								input_text("header_pemenuhan",$header_pemenuhan,"  ","Ketik ","text");
							?>
					  </div>
					  <div class="col-md-4">
							<label>Sub Header Pemenuhan</label>
							<?php
								input_text("sub_header_pemenuhan",$sub_header_pemenuhan,"  ","Ketik ","text");
							?>
					  </div>
					  <div class="col-md-4">
							<label>Sub Sub Header Pemenuhan</label>
							<?php
								input_text("sub_sub_header_pemenuhan",$sub_sub_header_pemenuhan,"  ","Ketik ","text");
							?>
					  </div>
					  <div class="col-md-4">
							<label>Header Realisasi</label>
							<?php
								input_text("header_realisasi",$header_realisasi,"  ","Ketik ","text");
							?>
					  </div>
					  <div class="col-md-4">
							<label>Sub Header Realisasi</label>
							<?php
								input_text("sub_header_realisasi",$sub_header_realisasi,"  ","Ketik ","text");
							?>
					  </div>
					  <div class="col-md-4">
							<label>Sub Sub Header Realisasi</label>
							<?php
								input_text("sub_sub_header_realisasi",$sub_sub_header_realisasi,"  ","Ketik ","text");
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
elseif ($page=="informasi_jabatan_urutan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('anjababk/informasi_jabatan/simpan_urutan');?>" onClick="return cek();">
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
elseif ($page=="informasi_jabatan_isi")
{
?> 
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
	<?php echo form_open_multipart('anjababk/informasi_jabatan/isi/'.$id,' id="signupform" '); ; 
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
				<div class="form-group">
				  <label>Iktisar Jabatan</label>
					<?php
						input_textareacustom("iktisar_jabatan",$iktisar_jabatan," id='editor6' rows='5' cols='100' class='form-control' ","");
					?>	
				</div>	
				<div class="form-group">
				  <label>Ringkasan Tugas Jabatan</label>
					<?php
						input_textareacustom("tugas_jabatan",$tugas_jabatan," id='editor1' rows='5' cols='100' class='form-control' ","");
					?>	
				</div>	
				<div class="form-group">
				  <label>Pengetahuan Kerja</label>
					<?php
						input_textareacustom("pengetahuan_kerja",$pengetahuan_kerja," id='editor2' rows='5' cols='100' class='form-control' ","");
					?>	
				</div>	
				<div class="form-group">
				  <label>Ketrampilan</label>
					<?php
						input_textareacustom("ketrampilan",$ketrampilan," id='editor3' rows='5' cols='100' class='form-control' ","");
					?>	
				</div>	
				<div class="form-group">
				  <label>Pelatihan</label>
					<?php
						input_textareacustom("pelatihan",$pelatihan," id='editor4' rows='5' cols='100' class='form-control' ","");
					?>	
				</div>	
				<div class="form-group">
				  <label>Pengalaman</label>
					<?php
						input_textareacustom("pengalaman",$pengalaman," id='editor5' rows='5' cols='100' class='form-control' ","");
					?>	
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
elseif ($page=="informasi_jabatan_pilihan")
{
?> 
<style type="text/css">
td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_close.png') no-repeat center center;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
	<?php echo form_open_multipart('anjababk/informasi_jabatan/pilihan/'.$id,' id="signupform" '); ; 
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
							  <th style="vertical-align:middle;width:5%;"></th>
							  <th style="vertical-align:middle;">Uraian Tugas</th>
							  <th style="vertical-align:middle;">AK</th>
							  <th style="vertical-align:middle;">Vol 1 Thn</th>
							  <th style="vertical-align:middle;">Formasi</th>
							</tr>
						</thead>
					</table>
				</div>
			  </div>	
				<div class="col-md-12">
					<div class="col-md-6">
					  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
						<div class="box-header with-border">
						  <h3 class="box-title">
							<button type="button" class="btn btn-success btn-xs OpenWewenang" data-toggle="tooltip" data-placement="right" 
								title="Pilih Wewenang" data-toggle="modal" data-target="#exampleModal">
							  Pilih Wewenang
							</button>
						</h3>
						  <div class="box-tools pull-right">
							<button type="button" class="btn btn-primary btn-xs openTambahWewenang" data-toggle="tooltip" data-placement="right" 
								title="Tambah Data" data-toggle="modal" data-target="#exampleModal">
							  <i class="fa fa-plus"></i> Tambah
							</button>
							<a href="<?php echo base_url('anjababk/informasi_jabatan/kosong_wewenang/'.$id);?>"  onclick="confirmation(event)" class="btn btn-danger btn-xs">
								<i class="fa fa-trash"></i>
								<span>Kosongkan</span>
							</a>
						  </div>
						</div>
						  <div class="box-body">
							<div class="box-header with-border">
								<div class="form-group">
									<table id="wewenang" width="100%" class="table table-bordered table-striped">
									  <thead>
										  <tr>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;width:10%">No</th>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Wewenang</th>
										  </tr>
									  </thead>
									  <tbody>		
											<?php
												$no = 0;
												foreach($wewenang_terpilih as $rowwewenang_terpilih){
													$no++;
											?>
										<tr>
												<td style="vertical-align:middle;"><?php echo $no;?></td>
												<td style="vertical-align:middle;"><?php echo $rowwewenang_terpilih['nama_wewenang']; ?></td>
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
					</div>	
					<div class="col-md-6">
					  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
						<div class="box-header with-border">
						  <h3 class="box-title">
							<button type="button" class="btn btn-success btn-xs OpenTanggungJawab" data-toggle="tooltip" data-placement="right" 
								title="Pilih Tanggung Jawab" data-toggle="modal" data-target="#exampleModal">
							  Pilih Tanggung Jawab
							</button>
						</h3>
						  <div class="box-tools pull-right">
							<button type="button" class="btn btn-primary btn-xs openTambahTanggungJawab" data-toggle="tooltip" data-placement="right" 
								title="Tambah Data" data-toggle="modal" data-target="#exampleModal">
							  <i class="fa fa-plus"></i> Tambah
							</button>
							<a href="<?php echo base_url('anjababk/informasi_jabatan/kosong_tanggung_jawab/'.$id);?>"  onclick="confirmation(event)" class="btn btn-danger btn-xs">
								<i class="fa fa-trash"></i>
								<span>Kosongkan</span>
							</a>
						  </div>
						</div>
						  <div class="box-body">
							<div class="box-header with-border">
								<div class="form-group">
									<table id="tanggung_jawab" width="100%" class="table table-bordered table-striped">
									  <thead>
										  <tr>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;width:10%">No</th>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Tanggung Jawab</th>
										  </tr>
									  </thead>
									  <tbody>		
											<?php
												$no = 0;
												foreach($tanggung_jawab_terpilih as $rowtanggung_jawab_terpilih){
													$no++;
											?>
										<tr>
												<td style="vertical-align:middle;"><?php echo $no;?></td>
												<td style="vertical-align:middle;"><?php echo $rowtanggung_jawab_terpilih['nama_tanggung_jawab']; ?></td>
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
					</div>
				</div>	
				<div class="col-md-12">
					<div class="col-md-6">
					  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
						<div class="box-header with-border">
						  <h3 class="box-title">
							<button type="button" class="btn btn-success btn-xs OpenHasilKerja" data-toggle="tooltip" data-placement="right" 
								title="Pilih Hasil Kerja" data-toggle="modal" data-target="#exampleModal">
							  Pilih Hasil Kerja
							</button>
						</h3>
						  <div class="box-tools pull-right">
							<button type="button" class="btn btn-primary btn-xs openTambahHasilKerja" data-toggle="tooltip" data-placement="right" 
								title="Tambah Data" data-toggle="modal" data-target="#exampleModal">
							  <i class="fa fa-plus"></i> Tambah
							</button>
							<a href="<?php echo base_url('anjababk/informasi_jabatan/kosong_hasil_kerja/'.$id);?>"  onclick="confirmation(event)" class="btn btn-danger btn-xs">
								<i class="fa fa-trash"></i>
								<span>Kosongkan</span>
							</a>
						  </div>
						</div>
						  <div class="box-body">
							<div class="box-header with-border">
								<div class="form-group">
									<table id="hasil_kerja" width="100%" class="table table-bordered table-striped">
									  <thead>
										  <tr>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;width:5%">No</th>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Hasil Kerja</th>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Satuan</th>
										  </tr>
									  </thead>
									  <tbody>		
											<?php
												$no = 0;
												foreach($hasil_kerja_terpilih as $rowhasil_kerja_terpilih){
													$no++;
											?>
										<tr>
												<td style="vertical-align:middle;"><?php echo $no;?></td>
												<td style="vertical-align:middle;"><?php echo $rowhasil_kerja_terpilih['nama_hasil_kerja']; ?></td>
												<td style="vertical-align:middle;"><?php echo $rowhasil_kerja_terpilih['satuan_hasil_kerja']; ?></td>
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
					</div>	
					<div class="col-md-6">
					  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
						<div class="box-header with-border">
						  <h3 class="box-title">
							<button type="button" class="btn btn-success btn-xs OpenBahanKerja" data-toggle="tooltip" data-placement="right" 
								title="Pilih Bahan Kerja" data-toggle="modal" data-target="#exampleModal">
							  Pilih Bahan Kerja
							</button>
						</h3>
						  <div class="box-tools pull-right">
							<button type="button" class="btn btn-primary btn-xs openTambahBahanKerja" data-toggle="tooltip" data-placement="right" 
								title="Tambah Data" data-toggle="modal" data-target="#exampleModal">
							  <i class="fa fa-plus"></i> Tambah
							</button>
							<a href="<?php echo base_url('anjababk/informasi_jabatan/kosong_bahan_kerja/'.$id);?>"  onclick="confirmation(event)" class="btn btn-danger btn-xs">
								<i class="fa fa-trash"></i>
								<span>Kosongkan</span>
							</a>
						  </div>
						</div>
						  <div class="box-body">
							<div class="box-header with-border">
								<div class="form-group">
									<table id="bahan_kerja" width="100%" class="table table-bordered table-striped">
									  <thead>
										  <tr>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;width:5%">No</th>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Bahan Kerja</th>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Penggunaan</th>
										  </tr>
									  </thead>
									  <tbody>		
											<?php
												$no = 0;
												foreach($bahan_kerja_terpilih as $rowhasil_bahan_terpilih){
													$no++;
											?>
										<tr>
												<td style="vertical-align:middle;"><?php echo $no;?></td>
												<td style="vertical-align:middle;"><?php echo $rowhasil_bahan_terpilih['nama_bahan_kerja']; ?></td>
												<td style="vertical-align:middle;"><?php echo $rowhasil_bahan_terpilih['penggunaan']; ?></td>
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
					</div>
				</div>
				<div class="col-md-12">
					<div class="col-md-6">
					  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
						<div class="box-header with-border">
						  <h3 class="box-title">
							<button type="button" class="btn btn-success btn-xs OpenPerangkatKerja" data-toggle="tooltip" data-placement="right" 
								title="Pilih Perangkat Kerja" data-toggle="modal" data-target="#exampleModal">
							  Pilih PerangKat Kerja
							</button>
						</h3>
						  <div class="box-tools pull-right">
							<button type="button" class="btn btn-primary btn-xs openTambahPerangkatKerja" data-toggle="tooltip" data-placement="right" 
								title="Tambah Data" data-toggle="modal" data-target="#exampleModal">
							  <i class="fa fa-plus"></i> Tambah
							</button>
							<a href="<?php echo base_url('anjababk/informasi_jabatan/kosong_perangkat_kerja/'.$id);?>"  onclick="confirmation(event)" class="btn btn-danger btn-xs">
								<i class="fa fa-trash"></i>
								<span>Kosongkan</span>
							</a>
						  </div>
						</div>
						  <div class="box-body">
							<div class="box-header with-border">
								<div class="form-group">
									<table id="perangkat_kerja" width="100%" class="table table-bordered table-striped">
									  <thead>
										  <tr>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;width:5%">No</th>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Perangkat Kerja</th>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Penggunaan</th>
										  </tr>
									  </thead>
									  <tbody>		
											<?php
												$no = 0;
												foreach($perangkat_kerja_terpilih as $rowperangkat_bahan_terpilih){
													$no++;
											?>
										<tr>
												<td style="vertical-align:middle;"><?php echo $no;?></td>
												<td style="vertical-align:middle;"><?php echo $rowperangkat_bahan_terpilih['nama_perangkat_kerja']; ?></td>
												<td style="vertical-align:middle;"><?php echo $rowperangkat_bahan_terpilih['penggunaan']; ?></td>
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
					</div>	
					<div class="col-md-6">
					  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
						<div class="box-header with-border">
						  <h3 class="box-title">
							<button type="button" class="btn btn-success btn-xs OpenHubunganJabatan" data-toggle="tooltip" data-placement="right" 
								title="Pilih Hubungan Jabatan" data-toggle="modal" data-target="#exampleModal">
							  Pilih Hubungan Jabatan
							</button>
						</h3>
						  <div class="box-tools pull-right">
							<button type="button" class="btn btn-primary btn-xs openTambahHubunganJabatan" data-toggle="tooltip" data-placement="right" 
								title="Tambah Data" data-toggle="modal" data-target="#exampleModal">
							  <i class="fa fa-plus"></i> Tambah
							</button>
							<a href="<?php echo base_url('anjababk/informasi_jabatan/kosong_hubungan_jabatan/'.$id);?>"  onclick="confirmation(event)" class="btn btn-danger btn-xs">
								<i class="fa fa-trash"></i>
								<span>Kosongkan</span>
							</a>
						  </div>
						</div>
						  <div class="box-body">
							<div class="box-header with-border">
								<div class="form-group">
									<table id="hubungan_jabatan" width="100%" class="table table-bordered table-striped">
									  <thead>
										  <tr>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;width:5%">No</th>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Hubungan Jabatan</th>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Unit kerja / Instansi</th>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Dalam Hal</th>
										  </tr>
									  </thead>
									  <tbody>		
											<?php
												$no = 0;
												foreach($hubungan_jabatan_terpilih as $rowhubungan_jabatan){
													$no++;
											?>
										<tr>
												<td style="vertical-align:middle;"><?php echo $no;?></td>
												<td style="vertical-align:middle;"><?php echo $rowhubungan_jabatan['nama_hubungan_jabatan']; ?></td>
												<td style="vertical-align:middle;"><?php echo $rowhubungan_jabatan['unit_kerja']; ?></td>
												<td style="vertical-align:middle;"><?php echo $rowhubungan_jabatan['hal']; ?></td>
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
					</div>
				</div>
				<div class="col-md-12">
					<div class="col-md-6">
					  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
						<div class="box-header with-border">
						  <h3 class="box-title">
							<button type="button" class="btn btn-success btn-xs OpenKondisiTempat" data-toggle="tooltip" data-placement="right" 
								title="Pilih Kondisi Tempat" data-toggle="modal" data-target="#exampleModal">
							  Pilih Kondisi Tempat
							</button>
						</h3>
						  <div class="box-tools pull-right">
							<button type="button" class="btn btn-primary btn-xs openTambahKondisiTempat" data-toggle="tooltip" data-placement="right" 
								title="Tambah Data" data-toggle="modal" data-target="#exampleModal">
							  <i class="fa fa-plus"></i> Tambah
							</button>
							<a href="<?php echo base_url('anjababk/informasi_jabatan/kosong_kondisi_tempat/'.$id);?>"  onclick="confirmation(event)" class="btn btn-danger btn-xs">
								<i class="fa fa-trash"></i>
								<span>Kosongkan</span>
							</a>
						  </div>
						</div>
						  <div class="box-body">
							<div class="box-header with-border">
								<div class="form-group">
									<table id="kondisi_tempat" width="100%" class="table table-bordered table-striped">
									  <thead>
										  <tr>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;width:5%">No</th>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Aspek</th>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Faktor</th>
										  </tr>
									  </thead>
									  <tbody>		
											<?php
												$no = 0;
												foreach($kondisi_tempat_terpilih as $rowkondisi_tempat){
													$no++;
											?>
										<tr>
												<td style="vertical-align:middle;"><?php echo $no;?></td>
												<td style="vertical-align:middle;"><?php echo $rowkondisi_tempat['aspek']; ?></td>
												<td style="vertical-align:middle;"><?php echo $rowkondisi_tempat['faktor']; ?></td>
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
					</div>	
					<div class="col-md-6">
					  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
						<div class="box-header with-border">
						  <h3 class="box-title">
							<button type="button" class="btn btn-success btn-xs OpenFungsiKerja" data-toggle="tooltip" data-placement="right" 
								title="Pilih Fungsi Kerja" data-toggle="modal" data-target="#exampleModal">
							  Pilih Fungsi Kerja
							</button>
						</h3>
						  <div class="box-tools pull-right">
							<button type="button" class="btn btn-primary btn-xs openTambahFungsiKerja" data-toggle="tooltip" data-placement="right" 
								title="Tambah Data" data-toggle="modal" data-target="#exampleModal">
							  <i class="fa fa-plus"></i> Tambah
							</button>
							<a href="<?php echo base_url('anjababk/informasi_jabatan/kosong_fungsi_kerja/'.$id);?>"  onclick="confirmation(event)" class="btn btn-danger btn-xs">
								<i class="fa fa-trash"></i>
								<span>Kosongkan</span>
							</a>
						  </div>
						</div>
						  <div class="box-body">
							<div class="box-header with-border">
								<div class="form-group">
									<table id="fungsi_kerja" width="100%" class="table table-bordered table-striped">
									  <thead>
										  <tr>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;width:5%">No</th>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kode</th>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Arti</th>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Deskripsi</th>
										  </tr>
									  </thead>
									  <tbody>		
											<?php
												$no = 0;
												foreach($fungsi_kerja_terpilih as $rowfungsi_kerja){
													$no++;
											?>
										<tr>
												<td style="vertical-align:middle;"><?php echo $no;?></td>
												<td style="vertical-align:middle;"><?php echo $rowfungsi_kerja['id_fungsi_kerja']; ?></td>
												<td style="vertical-align:middle;"><?php echo $rowfungsi_kerja['arti']; ?></td>
												<td style="vertical-align:middle;"><?php echo $rowfungsi_kerja['deskripsi']; ?></td>
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
					</div>
				</div>
				<div class="col-md-12">
					<div class="col-md-6">
					  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
						<div class="box-header with-border">
						  <h3 class="box-title">
							<button type="button" class="btn btn-success btn-xs OpenResikoBahaya" data-toggle="tooltip" data-placement="right" 
								title="Pilih Resiko Bahaya" data-toggle="modal" data-target="#exampleModal">
							  Pilih Resiko Bahaya
							</button>
						</h3>
						  <div class="box-tools pull-right">
							<button type="button" class="btn btn-primary btn-xs openTambahResikoBahaya" data-toggle="tooltip" data-placement="right" 
								title="Tambah Data" data-toggle="modal" data-target="#exampleModal">
							  <i class="fa fa-plus"></i> Tambah
							</button>
							<a href="<?php echo base_url('anjababk/informasi_jabatan/kosong_resiko_bahaya/'.$id);?>"  onclick="confirmation(event)" class="btn btn-danger btn-xs">
								<i class="fa fa-trash"></i>
								<span>Kosongkan</span>
							</a>
						  </div>
						</div>
						  <div class="box-body">
							<div class="box-header with-border">
								<div class="form-group">
									<table id="resiko_bahaya" width="100%" class="table table-bordered table-striped">
									  <thead>
										  <tr>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;width:5%">No</th>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Fisik / Mental</th>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Penyebab</th>
										  </tr>
									  </thead>
									  <tbody>		
											<?php
												$no = 0;
												foreach($resiko_bahaya_terpilih as $rowresiko_bahaya){
													$no++;
											?>
										<tr>
												<td style="vertical-align:middle;"><?php echo $no;?></td>
												<td style="vertical-align:middle;"><?php echo $rowresiko_bahaya['fisik']; ?></td>
												<td style="vertical-align:middle;"><?php echo $rowresiko_bahaya['penyebab']; ?></td>
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
					</div>	
					<div class="col-md-6">
					  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
						<div class="box-header with-border">
						  <h3 class="box-title">
							<button type="button" class="btn btn-success btn-xs OpenPendidikan" data-toggle="tooltip" data-placement="right" 
								title="Pilih Pendidikan Formal" data-toggle="modal" data-target="#exampleModal">
							  Pilih Pendidikan Formal
							</button>
						</h3>
						  <div class="box-tools pull-right">
							<button type="button" class="btn btn-primary btn-xs openTambahPendidikan" data-toggle="tooltip" data-placement="right" 
								title="Tambah Data" data-toggle="modal" data-target="#exampleModal">
							  <i class="fa fa-plus"></i> Tambah
							</button>
							<a href="<?php echo base_url('anjababk/informasi_jabatan/kosong_pendidikan/'.$id);?>"  onclick="confirmation(event)" class="btn btn-danger btn-xs">
								<i class="fa fa-trash"></i>
								<span>Kosongkan</span>
							</a>
						  </div>
						</div>
						  <div class="box-body">
							<div class="box-header with-border">
								<div class="form-group">
									<table id="pendidikan" width="100%" class="table table-bordered table-striped">
									  <thead>
										  <tr>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;width:5%">No</th>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Nama</th>
										  </tr>
									  </thead>
									  <tbody>		
											<?php
												$no = 0;
												foreach($pendidikan_terpilih as $rowpendidikan){
													$no++;
											?>
										<tr>
												<td style="vertical-align:middle;"><?php echo $no;?></td>
												<td style="vertical-align:middle;"><?php echo $rowpendidikan['nama_pendidikan']; ?></td>
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
					</div>
				</div>
				<div class="col-md-12">
					<div class="col-md-6">
					  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
						<div class="box-header with-border">
						  <h3 class="box-title">
							<button type="button" class="btn btn-success btn-xs OpenPangkat" data-toggle="tooltip" data-placement="right" 
								title="Pilih Pangkat / Golongan" data-toggle="modal" data-target="#exampleModal">
							  Pilih Pangkat / Golongan
							</button>
						</h3>
						  <div class="box-tools pull-right">
							<a href="<?php echo base_url('anjababk/informasi_jabatan/kosong_pangkat/'.$id);?>"  onclick="confirmation(event)" class="btn btn-danger btn-xs">
								<i class="fa fa-trash"></i>
								<span>Kosongkan</span>
							</a>
						  </div>
						</div>
						  <div class="box-body">
							<div class="box-header with-border">
								<div class="form-group">
									<table id="pangkat" width="100%" class="table table-bordered table-striped">
									  <thead>
										  <tr>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;width:5%">No</th>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Pangkat</th>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Golongan/Ruang</th>
										  </tr>
									  </thead>
									  <tbody>		
											<?php
												$no = 0;
												foreach($pangkat_terpilih as $rowpangkat){
													$no++;
											?>
										<tr>
												<td style="vertical-align:middle;"><?php echo $no;?></td>
												<td style="vertical-align:middle;"><?php echo $rowpangkat['nama_pangkat']; ?></td>
												<td style="vertical-align:middle;"><?php echo $rowpangkat['golongan_ruang']; ?></td>
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
					</div>	
					<div class="col-md-6">
					  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
						<div class="box-header with-border">
						  <h3 class="box-title">
							<button type="button" class="btn btn-success btn-xs OpenBakatKerja" data-toggle="tooltip" data-placement="right" 
								title="Pilih Bakat kerja" data-toggle="modal" data-target="#exampleModal">
							  Pilih Bakat Kerja
							</button>
						</h3>
						  <div class="box-tools pull-right">
							<a href="<?php echo base_url('anjababk/informasi_jabatan/kosong_bakat_kerja/'.$id);?>"  onclick="confirmation(event)" class="btn btn-danger btn-xs">
								<i class="fa fa-trash"></i>
								<span>Kosongkan</span>
							</a>
						  </div>
						</div>
						  <div class="box-body">
							<div class="box-header with-border">
								<div class="form-group">
									<table id="bakat_kerja" width="100%" class="table table-bordered table-striped">
									  <thead>
										  <tr>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;width:5%">No</th>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kode</th>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Arti</th>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Deskripsi</th>
										  </tr>
									  </thead>
									  <tbody>		
											<?php
												$no = 0;
												foreach($bakat_kerja_terpilih as $rowbakat_kerja){
													$no++;
											?>
										<tr>
												<td style="vertical-align:middle;"><?php echo $no;?></td>
												<td style="vertical-align:middle;"><?php echo $rowbakat_kerja['id_bakat_kerja']; ?></td>
												<td style="vertical-align:middle;"><?php echo $rowbakat_kerja['arti']; ?></td>
												<td style="vertical-align:middle;"><?php echo $rowbakat_kerja['deskripsi']; ?></td>
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
					</div>
				</div>
				<div class="col-md-12">
					<div class="col-md-6">
					  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
						<div class="box-header with-border">
						  <h3 class="box-title">
							<button type="button" class="btn btn-success btn-xs OpenTemperamenKerja" data-toggle="tooltip" data-placement="right" 
								title="Pilih Hasil Kerja" data-toggle="modal" data-target="#exampleModal">
							  Pilih Temperamen Kerja
							</button>
						</h3>
						  <div class="box-tools pull-right">
							<a href="<?php echo base_url('anjababk/informasi_jabatan/kosong_temperamen_kerja/'.$id);?>"  onclick="confirmation(event)" class="btn btn-danger btn-xs">
								<i class="fa fa-trash"></i>
								<span>Kosongkan</span>
							</a>
						  </div>
						</div>
						  <div class="box-body">
							<div class="box-header with-border">
								<div class="form-group">
									<table id="temperamen_kerja" width="100%" class="table table-bordered table-striped">
									  <thead>
										  <tr>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;width:5%">No</th>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kode</th>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Arti</th>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Deskripsi</th>
										  </tr>
									  </thead>
									  <tbody>		
											<?php
												$no = 0;
												foreach($temperamen_kerja_terpilih as $rowtemperamen_kerja){
													$no++;
											?>
										<tr>
												<td style="vertical-align:middle;"><?php echo $no;?></td>
												<td style="vertical-align:middle;"><?php echo $rowtemperamen_kerja['id_temperamen_kerja']; ?></td>
												<td style="vertical-align:middle;"><?php echo $rowtemperamen_kerja['arti']; ?></td>
												<td style="vertical-align:middle;"><?php echo $rowtemperamen_kerja['deskripsi']; ?></td>
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
					</div>	
					<div class="col-md-6">
					  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
						<div class="box-header with-border">
						  <h3 class="box-title">
							<button type="button" class="btn btn-success btn-xs OpenMinatKerja" data-toggle="tooltip" data-placement="right" 
								title="Pilih Minat kerja" data-toggle="modal" data-target="#exampleModal">
							  Pilih Minat Kerja
							</button>
						</h3>
						  <div class="box-tools pull-right">
							<a href="<?php echo base_url('anjababk/informasi_jabatan/kosong_minat_kerja/'.$id);?>"  onclick="confirmation(event)" class="btn btn-danger btn-xs">
								<i class="fa fa-trash"></i>
								<span>Kosongkan</span>
							</a>
						  </div>
						</div>
						  <div class="box-body">
							<div class="box-header with-border">
								<div class="form-group">
									<table id="minat_kerja" width="100%" class="table table-bordered table-striped">
									  <thead>
										  <tr>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;width:5%">No</th>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kode</th>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Deskripsi</th>
										  </tr>
									  </thead>
									  <tbody>		
											<?php
												$no = 0;
												foreach($minat_kerja_terpilih as $rowminat_kerja){
													$no++;
											?>
										<tr>
												<td style="vertical-align:middle;"><?php echo $no;?></td>
												<td style="vertical-align:middle;"><?php echo $rowminat_kerja['id_minat_kerja']; ?></td>
												<td style="vertical-align:middle;"><?php echo $rowminat_kerja['deskripsi']; ?></td>
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
					</div>
				</div>
				<div class="col-md-12">
					<div class="col-md-6">
					  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
						<div class="box-header with-border">
						  <h3 class="box-title">
							<button type="button" class="btn btn-success btn-xs OpenUpayaFisik" data-toggle="tooltip" data-placement="right" 
								title="Pilih Upaya Fisik" data-toggle="modal" data-target="#exampleModal">
							  Pilih Upaya Fisik
							</button>
						</h3>
						  <div class="box-tools pull-right">
							<a href="<?php echo base_url('anjababk/informasi_jabatan/kosong_upaya_fisik/'.$id);?>"  onclick="confirmation(event)" class="btn btn-danger btn-xs">
								<i class="fa fa-trash"></i>
								<span>Kosongkan</span>
							</a>
						  </div>
						</div>
						  <div class="box-body">
							<div class="box-header with-border">
								<div class="form-group">
									<table id="upaya_fisik" width="100%" class="table table-bordered table-striped">
									  <thead>
										  <tr>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;width:5%">No</th>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Upaya Fisik</th>
											<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Deskripsi</th>
										  </tr>
									  </thead>
									  <tbody>		
											<?php
												$no = 0;
												foreach($upaya_fisik_terpilih as $rowupaya_fisik){
													$no++;
											?>
										<tr>
												<td style="vertical-align:middle;"><?php echo $no;?></td>
												<td style="vertical-align:middle;"><?php echo $rowupaya_fisik['arti']; ?></td>
												<td style="vertical-align:middle;"><?php echo $rowupaya_fisik['deskripsi']; ?></td>
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
					</div>	
				</div>
	<!--			<div class="col-md-12">
					<div class="col-md-6">
					  <div class="box box- box-solid">
						<div class="box-header with-border">
						   <h3 class="box-title"></h3>

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
					</div>	
					<div class="col-md-6">
					  <div class="box box- box-solid">
						<div class="box-header with-border">
						   <h3 class="box-title"></h3>

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
					</div>
				</div> -->
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
//---------------------- Wewenang
elseif ($page=="informasi_jabatan_wewenang")
{
?>
      <div class="row">
        <div class="col-md-12">
		<FORM method="POST" class="form-horizontal" action="<?php echo base_url('anjababk/informasi_jabatan/simpan_wewenang');?>" onClick="return cek();">
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
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Nama</th>
								  </tr>
						  </thead>
						  <tbody>		
								<?php
									foreach($wewenang_all as $row){
								?>
							<tr>
									<td style="vertical-align:middle;width:10%">
									  <div class="checkbox">
										<label>
										  <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_wewenang'];?>" 
											<?php if(in_array($row['id_wewenang'],explode(",", $wewenang))) echo 'checked="checked"'; ?> >
										</label>
									  </div>				
									</td>
									<td style="vertical-align:middle;"><?php echo $row['nama_wewenang'];?></td>
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
elseif ($page=="informasi_jabatan_tambah_wewenang")
{
?>
      <div class="row">
        <div class="col-md-12">
		<FORM method="POST" class="form-horizontal" action="<?php echo base_url('anjababk/informasi_jabatan/simpan_tambah_wewenang');?>" onClick="return cek();">
          <input type="hidden" name="id_jabatan" value="<?= $this->session->id_jabatan; ?>">
		  <input type="hidden" name="id_abk_detil" value="<?= $id; ?>">
		  <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
				<div class="col-md-12">
					<div class="form-group">
					  <label>Nama</label>
						<?php
							input_text("nama_wewenang",$nama_wewenang,"maxlength='255'","Masukkan Nama","text");
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
//---------------------- Tanggung Jawab
elseif ($page=="informasi_jabatan_tanggung_jawab")
{
?>
      <div class="row">
        <div class="col-md-12">
		<FORM method="POST" class="form-horizontal" action="<?php echo base_url('anjababk/informasi_jabatan/simpan_tanggung_jawab');?>" onClick="return cek();">
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
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Nama</th>
								  </tr>
						  </thead>
						  <tbody>		
								<?php
									foreach($tanggung_jawab_all as $row){
								?>
							<tr>
									<td style="vertical-align:middle;">
									  <div class="checkbox">
										<label>
										  <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_tanggung_jawab'];?>" 
											<?php if(in_array($row['id_tanggung_jawab'],explode(",", $tanggung_jawab))) echo 'checked="checked"'; ?> >
										</label>
									  </div>				
									</td>
									<td style="vertical-align:middle;"><?php echo $row['nama_tanggung_jawab'];?></td>
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
elseif ($page=="informasi_jabatan_tambah_tanggung_jawab")
{
?>
      <div class="row">
        <div class="col-md-12">
		<FORM method="POST" class="form-horizontal" action="<?php echo base_url('anjababk/informasi_jabatan/simpan_tambah_tanggung_jawab');?>" onClick="return cek();">
          <input type="hidden" name="id_jabatan" value="<?= $this->session->id_jabatan; ?>">
		  <input type="hidden" name="id_abk_detil" value="<?= $id; ?>">
		  <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
				<div class="col-md-12">
					<div class="form-group">
					  <label>Nama</label>
						<?php
							input_text("nama_tanggung_jawab",$nama_tanggung_jawab,"maxlength='255'","Masukkan Nama","text");
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
//---------------------- Hasil Kerja
elseif ($page=="informasi_jabatan_hasil_kerja")
{
?>
      <div class="row">
        <div class="col-md-12">
		<FORM method="POST" class="form-horizontal" action="<?php echo base_url('anjababk/informasi_jabatan/simpan_hasil_kerja');?>" onClick="return cek();">
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
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Nama</th>
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Satuan</th>
								  </tr>
						  </thead>
						  <tbody>		
								<?php
									foreach($hasil_kerja_all as $row){
								?>
							<tr>
									<td style="vertical-align:middle;">
									  <div class="checkbox">
										<label>
										  <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_hasil_kerja'];?>" 
											<?php if(in_array($row['id_hasil_kerja'],explode(",", $hasil_kerja))) echo 'checked="checked"'; ?> >
										</label>
									  </div>				
									</td>
									<td style="vertical-align:middle;"><?php echo $row['nama_hasil_kerja'];?></td>
									<td style="vertical-align:middle;"><?php echo $row['satuan_hasil_kerja'];?></td>
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
elseif ($page=="informasi_jabatan_tambah_hasil_kerja")
{
?>
      <div class="row">
        <div class="col-md-12">
		<FORM method="POST" class="form-horizontal" action="<?php echo base_url('anjababk/informasi_jabatan/simpan_tambah_hasil_kerja');?>" onClick="return cek();">
          <input type="hidden" name="id_jabatan" value="<?= $this->session->id_jabatan; ?>">
		  <input type="hidden" name="id_abk_detil" value="<?= $id; ?>">
		  <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
				<div class="col-md-12">
					<div class="form-group">
					  <label>Nama</label>
						<?php
							input_text("nama_hasil_kerja",$nama_hasil_kerja,"maxlength='255'","Masukkan Nama","text");
						?>	
					</div>
					<div class="form-group">
					  <label>Satuan</label>
						<?php
							input_text("satuan_hasil_kerja",$satuan_hasil_kerja,"maxlength='255'","Masukkan Satuan","text");
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
//---------------------- Bahan Kerja
elseif ($page=="informasi_jabatan_bahan_kerja")
{
?>
      <div class="row">
        <div class="col-md-12">
		<FORM method="POST" class="form-horizontal" action="<?php echo base_url('anjababk/informasi_jabatan/simpan_bahan_kerja');?>" onClick="return cek();">
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
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Nama</th>
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Penggunaan</th>
								  </tr>
						  </thead>
						  <tbody>		
								<?php
									foreach($bahan_kerja_all as $row){
								?>
							<tr>
									<td style="vertical-align:middle;">
									  <div class="checkbox">
										<label>
										  <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_bahan_kerja'];?>" 
											<?php if(in_array($row['id_bahan_kerja'],explode(",", $bahan_kerja))) echo 'checked="checked"'; ?> >
										</label>
									  </div>				
									</td>
									<td style="vertical-align:middle;"><?php echo $row['nama_bahan_kerja'];?></td>
									<td style="vertical-align:middle;"><?php echo $row['penggunaan'];?></td>
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
elseif ($page=="informasi_jabatan_tambah_bahan_kerja")
{
?>
      <div class="row">
        <div class="col-md-12">
		<FORM method="POST" class="form-horizontal" action="<?php echo base_url('anjababk/informasi_jabatan/simpan_tambah_bahan_kerja');?>" onClick="return cek();">
          <input type="hidden" name="id_jabatan" value="<?= $this->session->id_jabatan; ?>">
		  <input type="hidden" name="id_abk_detil" value="<?= $id; ?>">
		  <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
				<div class="col-md-12">
					<div class="form-group">
					  <label>Nama</label>
						<?php
							input_text("nama_bahan_kerja",$nama_bahan_kerja,"maxlength='255'","Masukkan Nama","text");
						?>	
					</div>
					<div class="form-group">
					  <label>Penggunaan</label>
						<?php
							input_text("penggunaan",$penggunaan,"maxlength='255'","Masukkan Penggunaan","text");
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
//---------------------- Fungsi Kerja
elseif ($page=="informasi_jabatan_fungsi_kerja")
{
?>
      <div class="row">
        <div class="col-md-12">
		<FORM method="POST" class="form-horizontal" action="<?php echo base_url('anjababk/informasi_jabatan/simpan_fungsi_kerja');?>" onClick="return cek();">
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
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kode</th>
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Arti</th>
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Deskripsi</th>
								  </tr>
						  </thead>
						  <tbody>		
								<?php
									foreach($fungsi_kerja_all as $row){
								?>
							<tr>
									<td style="vertical-align:middle;">
									  <div class="checkbox">
										<label>
										  <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_fungsi_kerja'];?>" 
											<?php if(in_array($row['id_fungsi_kerja'],explode(",", $fungsi_kerja))) echo 'checked="checked"'; ?> >
										</label>
									  </div>				
									</td>
									<td style="vertical-align:middle;"><?php echo $row['id_fungsi_kerja'];?></td>
									<td style="vertical-align:middle;"><?php echo $row['arti'];?></td>
									<td style="vertical-align:middle;"><?php echo $row['deskripsi'];?></td>
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
elseif ($page=="informasi_jabatan_tambah_fungsi_kerja")
{
?>
      <div class="row">
        <div class="col-md-12">
		<FORM method="POST" class="form-horizontal" action="<?php echo base_url('anjababk/informasi_jabatan/simpan_tambah_fungsi_kerja');?>" onClick="return cek();">
          <input type="hidden" name="id_jabatan" value="<?= $this->session->id_jabatan; ?>">
		  <input type="hidden" name="id_abk_detil" value="<?= $id; ?>">
		  <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
				<div class="col-md-12">
					<div class="form-group">
					  <label>Kode</label>
						<?php
							input_text("id_fungsi_kerja",$id_fungsi_kerja,"maxlength='3'","Masukkan Kode","text");
						?>	
					</div>
					<div class="form-group">
					  <label>Arti</label>
						<?php
							input_text("arti",$arti,"maxlength='255'","Masukkan Arti Kode","text");
						?>	
					</div>
					<div class="form-group">
					  <label>Deskripsi</label>
						<?php
							input_text("deskripsi",$deskripsi,"maxlength='255'","Masukkan Deskripsi Kode","text");
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
//---------------------- Bahan Kerja
elseif ($page=="informasi_jabatan_perangkat_kerja")
{
?>
      <div class="row">
        <div class="col-md-12">
		<FORM method="POST" class="form-horizontal" action="<?php echo base_url('anjababk/informasi_jabatan/simpan_perangkat_kerja');?>" onClick="return cek();">
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
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Nama</th>
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Penggunaan</th>
								  </tr>
						  </thead>
						  <tbody>		
								<?php
									foreach($perangkat_kerja_all as $row){
								?>
							<tr>
									<td style="vertical-align:middle;">
									  <div class="checkbox">
										<label>
										  <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_perangkat_kerja'];?>" 
											<?php if(in_array($row['id_perangkat_kerja'],explode(",", $perangkat_kerja))) echo 'checked="checked"'; ?> >
										</label>
									  </div>				
									</td>
									<td style="vertical-align:middle;"><?php echo $row['nama_perangkat_kerja'];?></td>
									<td style="vertical-align:middle;"><?php echo $row['penggunaan'];?></td>
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
elseif ($page=="informasi_jabatan_tambah_perangkat_kerja")
{
?>
      <div class="row">
        <div class="col-md-12">
		<FORM method="POST" class="form-horizontal" action="<?php echo base_url('anjababk/informasi_jabatan/simpan_tambah_perangkat_kerja');?>" onClick="return cek();">
          <input type="hidden" name="id_jabatan" value="<?= $this->session->id_jabatan; ?>">
		  <input type="hidden" name="id_abk_detil" value="<?= $id; ?>">
		  <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
				<div class="col-md-12">
					<div class="form-group">
					  <label>Nama</label>
						<?php
							input_text("nama_perangkat_kerja",$nama_perangkat_kerja,"maxlength='255'","Masukkan Nama","text");
						?>	
					</div>
					<div class="form-group">
					  <label>Penggunaan</label>
						<?php
							input_text("penggunaan",$penggunaan,"maxlength='255'","Masukkan Penggunaan","text");
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
//---------------------- Hubungan Jabatan
elseif ($page=="informasi_jabatan_hubungan_jabatan")
{
?>
      <div class="row">
        <div class="col-md-12">
		<FORM method="POST" class="form-horizontal" action="<?php echo base_url('anjababk/informasi_jabatan/simpan_hubungan_jabatan');?>" onClick="return cek();">
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
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Nama</th>
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Unit Kerja / Instansi</th>
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Dalam Hal</th>
								  </tr>
						  </thead>
						  <tbody>		
								<?php
									foreach($hubungan_jabatan_all as $row){
								?>
							<tr>
									<td style="vertical-align:middle;">
									  <div class="checkbox">
										<label>
										  <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_hubungan_jabatan'];?>" 
											<?php if(in_array($row['id_hubungan_jabatan'],explode(",", $hubungan_jabatan))) echo 'checked="checked"'; ?> >
										</label>
									  </div>				
									</td>
									<td style="vertical-align:middle;"><?php echo $row['nama_hubungan_jabatan'];?></td>
									<td style="vertical-align:middle;"><?php echo $row['unit_kerja'];?></td>
									<td style="vertical-align:middle;"><?php echo $row['hal'];?></td>
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
elseif ($page=="informasi_jabatan_tambah_hubungan_jabatan")
{
?>
      <div class="row">
        <div class="col-md-12">
		<FORM method="POST" class="form-horizontal" action="<?php echo base_url('anjababk/informasi_jabatan/simpan_tambah_hubungan_jabatan');?>" onClick="return cek();">
          <input type="hidden" name="id_jabatan" value="<?= $this->session->id_jabatan; ?>">
		  <input type="hidden" name="id_abk_detil" value="<?= $id; ?>">
		  <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
				<div class="col-md-12">
					<div class="form-group">
					  <label>Nama</label>
						<?php
							input_text("nama_hubungan_jabatan",$nama_hubungan_jabatan,"maxlength='255'","Masukkan Nama","text");
						?>	
					</div>
					<div class="form-group">
					  <label>Unit Kerja / Instansi</label>
						<?php
							input_text("unit_kerja",$unit_kerja,"maxlength='255'","Masukkan Unit kerja","text");
						?>	
					</div>
					<div class="form-group">
					  <label>Dalam Hal</label>
						<?php
							input_text("hal",$hal,"maxlength='255'","Masukkan Dalam Hal","text");
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
//---------------------- Kondisi Tempat
elseif ($page=="informasi_jabatan_kondisi_tempat")
{
?>
      <div class="row">
        <div class="col-md-12">
		<FORM method="POST" class="form-horizontal" action="<?php echo base_url('anjababk/informasi_jabatan/simpan_kondisi_tempat');?>" onClick="return cek();">
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
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Aspek</th>
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Faktor</th>
								  </tr>
						  </thead>
						  <tbody>		
								<?php
									foreach($kondisi_tempat_all as $row){
								?>
							<tr>
									<td style="vertical-align:middle;">
									  <div class="checkbox">
										<label>
										  <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_kondisi_tempat'];?>" 
											<?php if(in_array($row['id_kondisi_tempat'],explode(",", $kondisi_tempat))) echo 'checked="checked"'; ?> >
										</label>
									  </div>				
									</td>
									<td style="vertical-align:middle;"><?php echo $row['aspek'];?></td>
									<td style="vertical-align:middle;"><?php echo $row['faktor'];?></td>
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
elseif ($page=="informasi_jabatan_tambah_kondisi_tempat")
{
?>
      <div class="row">
        <div class="col-md-12">
		<FORM method="POST" class="form-horizontal" action="<?php echo base_url('anjababk/informasi_jabatan/simpan_tambah_kondisi_tempat');?>" onClick="return cek();">
          <input type="hidden" name="id_jabatan" value="<?= $this->session->id_jabatan; ?>">
		  <input type="hidden" name="id_abk_detil" value="<?= $id; ?>">
		  <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
				<div class="col-md-12">
					<div class="form-group">
					  <label>Aspek</label>
						<?php
							input_text("aspek",$aspek,"maxlength='255'","Masukkan Aspek","text");
						?>	
					</div>
					<div class="form-group">
					  <label>Faktor</label>
						<?php
							input_text("faktor",$faktor,"maxlength='255'","Masukkan Faktor","text");
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
//---------------------- Kondisi Tempat
elseif ($page=="informasi_jabatan_upaya_fisik")
{
?>
      <div class="row">
        <div class="col-md-12">
		<FORM method="POST" class="form-horizontal" action="<?php echo base_url('anjababk/informasi_jabatan/simpan_upaya_fisik');?>" onClick="return cek();">
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
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Upaya Fisik</th>
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Deskripsi</th>
								  </tr>
						  </thead>
						  <tbody>		
								<?php
									foreach($upaya_fisik_all as $row){
								?>
							<tr>
									<td style="vertical-align:middle;">
									  <div class="checkbox">
										<label>
										  <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_upaya_fisik'];?>" 
											<?php if(in_array($row['id_upaya_fisik'],explode(",", $upaya_fisik))) echo 'checked="checked"'; ?> >
										</label>
									  </div>				
									</td>
									<td style="vertical-align:middle;"><?php echo $row['arti'];?></td>
									<td style="vertical-align:middle;"><?php echo $row['deskripsi'];?></td>
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
//---------------------- Resiko Bahaya
elseif ($page=="informasi_jabatan_resiko_bahaya")
{
?>
      <div class="row">
        <div class="col-md-12">
		<FORM method="POST" class="form-horizontal" action="<?php echo base_url('anjababk/informasi_jabatan/simpan_resiko_bahaya');?>" onClick="return cek();">
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
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Fisik / Mental</th>
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Penyebab</th>
								  </tr>
						  </thead>
						  <tbody>		
								<?php
									foreach($resiko_bahaya_all as $row){
								?>
							<tr>
									<td style="vertical-align:middle;">
									  <div class="checkbox">
										<label>
										  <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_resiko_bahaya'];?>" 
											<?php if(in_array($row['id_resiko_bahaya'],explode(",", $resiko_bahaya))) echo 'checked="checked"'; ?> >
										</label>
									  </div>				
									</td>
									<td style="vertical-align:middle;"><?php echo $row['fisik'];?></td>
									<td style="vertical-align:middle;"><?php echo $row['penyebab'];?></td>
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
elseif ($page=="informasi_jabatan_tambah_resiko_bahaya")
{
?>
      <div class="row">
        <div class="col-md-12">
		<FORM method="POST" class="form-horizontal" action="<?php echo base_url('anjababk/informasi_jabatan/simpan_tambah_resiko_bahaya');?>" onClick="return cek();">
          <input type="hidden" name="id_jabatan" value="<?= $this->session->id_jabatan; ?>">
		  <input type="hidden" name="id_abk_detil" value="<?= $id; ?>">
		  <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
				<div class="col-md-12">
					<div class="form-group">
					  <label>Fisik / Mental</label>
						<?php
							input_text("fisik",$fisik,"maxlength='255'","Masukkan Aspek","text");
						?>	
					</div>
					<div class="form-group">
					  <label>Penyebab</label>
						<?php
							input_text("penyebab",$penyebab,"maxlength='255'","Masukkan Penyebab","text");
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
//---------------------- Pendidikan
elseif ($page=="informasi_jabatan_pendidikan")
{
?>
      <div class="row">
        <div class="col-md-12">
		<FORM method="POST" class="form-horizontal" action="<?php echo base_url('anjababk/informasi_jabatan/simpan_pendidikan');?>" onClick="return cek();">
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
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Pendidikan</th>
								  </tr>
						  </thead>
						  <tbody>		
								<?php
									foreach($pendidikan_all as $row){
								?>
							<tr>
									<td style="vertical-align:middle;">
									  <div class="checkbox">
										<label>
										  <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_pendidikan'];?>" 
											<?php if(in_array($row['id_pendidikan'],explode(",", $pendidikan))) echo 'checked="checked"'; ?> >
										</label>
									  </div>				
									</td>
									<td style="vertical-align:middle;"><?php echo $row['nama_pendidikan'];?></td>
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
      'searching'   	: true,
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
elseif ($page=="informasi_jabatan_tambah_pendidikan")
{
?>
      <div class="row">
        <div class="col-md-12">
		<FORM method="POST" class="form-horizontal" action="<?php echo base_url('anjababk/informasi_jabatan/simpan_tambah_pendidikan');?>" onClick="return cek();">
          <input type="hidden" name="id_jabatan" value="<?= $this->session->id_jabatan; ?>">
		  <input type="hidden" name="id_abk_detil" value="<?= $id; ?>">
		  <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
				<div class="col-md-12">
					<div class="form-group">
					  <label>Nama</label>
						<?php
							input_text("nama_pendidikan",$nama_pendidikan,"maxlength='255'","Masukkan Nama","text");
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
//---------------------- Kondisi Tempat
elseif ($page=="informasi_jabatan_pangkat")
{
?>
      <div class="row">
        <div class="col-md-12">
		<FORM method="POST" class="form-horizontal" action="<?php echo base_url('anjababk/informasi_jabatan/simpan_pangkat');?>" onClick="return cek();">
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
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Pangkat</th>
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Golongan/Ruang</th>
								  </tr>
						  </thead>
						  <tbody>		
								<?php
									foreach($pangkat_all as $row){
								?>
							<tr>
									<td style="vertical-align:middle;">
									  <div class="checkbox">
										<label>
										  <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_pangkat'];?>" 
											<?php if(in_array($row['id_pangkat'],explode(",", $pangkat))) echo 'checked="checked"'; ?> >
										</label>
									  </div>				
									</td>
									<td style="vertical-align:middle;"><?php echo $row['nama_pangkat'];?></td>
									<td style="vertical-align:middle;"><?php echo $row['golongan_ruang'];?></td>
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
//---------------------- Kondisi Tempat
elseif ($page=="informasi_jabatan_bakat_kerja")
{
?>
      <div class="row">
        <div class="col-md-12">
		<FORM method="POST" class="form-horizontal" action="<?php echo base_url('anjababk/informasi_jabatan/simpan_bakat_kerja');?>" onClick="return cek();">
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
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Pangkat</th>
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Golongan/Ruang</th>
								  </tr>
						  </thead>
						  <tbody>		
								<?php
									foreach($bakat_kerja_all as $row){
								?>
							<tr>
									<td style="vertical-align:middle;">
									  <div class="checkbox">
										<label>
										  <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_bakat_kerja'];?>" 
											<?php if(in_array($row['id_bakat_kerja'],explode(",", $bakat_kerja))) echo 'checked="checked"'; ?> >
										</label>
									  </div>				
									</td>
									<td style="vertical-align:middle;"><?php echo $row['id_bakat_kerja'];?></td>
									<td style="vertical-align:middle;"><?php echo $row['arti'];?></td>
									<td style="vertical-align:middle;"><?php echo $row['deskripsi'];?></td>
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
//---------------------- TEMPERAMEN
elseif ($page=="informasi_jabatan_temperamen_kerja")
{
?>
      <div class="row">
        <div class="col-md-12">
		<FORM method="POST" class="form-horizontal" action="<?php echo base_url('anjababk/informasi_jabatan/simpan_temperamen_kerja');?>" onClick="return cek();">
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
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kode</th>
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Arti</th>
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Deskripsi</th>
								  </tr>
						  </thead>
						  <tbody>		
								<?php
									foreach($temperamen_kerja_all as $row){
								?>
							<tr>
									<td style="vertical-align:middle;">
									  <div class="checkbox">
										<label>
										  <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_temperamen_kerja'];?>" 
											<?php if(in_array($row['id_temperamen_kerja'],explode(",", $temperamen_kerja))) echo 'checked="checked"'; ?> >
										</label>
									  </div>				
									</td>
									<td style="vertical-align:middle;"><?php echo $row['id_temperamen_kerja'];?></td>
									<td style="vertical-align:middle;"><?php echo $row['arti'];?></td>
									<td style="vertical-align:middle;"><?php echo $row['deskripsi'];?></td>
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
//---------------------- TEMPERAMEN
elseif ($page=="informasi_jabatan_minat_kerja")
{
?>
      <div class="row">
        <div class="col-md-12">
		<FORM method="POST" class="form-horizontal" action="<?php echo base_url('anjababk/informasi_jabatan/simpan_minat_kerja');?>" onClick="return cek();">
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
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kode</th>
									<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Deskripsi</th>
								  </tr>
						  </thead>
						  <tbody>		
								<?php
									foreach($minat_kerja_all as $row){
								?>
							<tr>
									<td style="vertical-align:middle;">
									  <div class="checkbox">
										<label>
										  <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_minat_kerja'];?>" 
											<?php if(in_array($row['id_minat_kerja'],explode(",", $minat_kerja))) echo 'checked="checked"'; ?> >
										</label>
									  </div>				
									</td>
									<td style="vertical-align:middle;"><?php echo $row['id_minat_kerja'];?></td>
									<td style="vertical-align:middle;"><?php echo $row['deskripsi'];?></td>
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
//---------------------- Butir Kegiatan
elseif ($page=="informasi_jabatan_pilih_bk")
{
?>
      <div class="row">
        <div class="col-md-12">
		<FORM method="POST" class="form-horizontal" action="<?php echo base_url('anjababk/informasi_jabatan/simpan_pilih_bk');?>" onClick="return cek();">
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
									  <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kode Unit</th>
									  <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kompetensi</th>
									  <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Jumlah</th>
								  </tr>
						  </thead>
						  <tbody>		
								<?php
									foreach($butir_kegiatan_all as $row){
										$tot_komp = $this->m_ol_rancak->jumlah_record_logbook_4_anjababk($row['id_kompetensi'],$periode);
								?>
							<tr>
									<td style="vertical-align:middle;">
									  <div class="checkbox">
										<label>
										  <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_kompetensi'];?>" 
											<?php // if(in_array($row['id_kompetensi'],explode(",", $id_kompetensi))) echo 'checked="checked"'; ?> >
										</label>
									  </div>				
									</td>
									<td style="vertical-align:middle;"><?php echo $row['kode_unit'];?></td>
									<td style="vertical-align:middle;"><?php echo $row['nama_kompetensi'];?></td>
									<td style="vertical-align:middle;"><?php echo $tot_komp;?></td>
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
      'searching'   	: true,
      'ordering'    	: false,
      'info'        	: true,
	  'scrollX'			: true,
	  'scrollY'			: '500px',
	  'scrollCollapse'	: true
		})
	});
</script>
<?php
}