<?php
//=================================== H O M E ================================================
$arraybox = array('warning','success','info','danger','primary');
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
//================================== INSTANSI ===============================
elseif ($page=="transaksi")
{
?>
<style>
    @media (min-width: 768px) {
      .modal-xl {
        width: 90%;
       max-width:1200px;
      }
    }
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $instance_name; ?> <small></small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $header; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
		<div class="box-body">    
			<?php echo form_open_multipart('akunting/transaksi/view/'.$date.'/'.$first_date.'/'.$last_date,' id="signupform" '); ?>
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
			</div>
			  <div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
						  <label>Opsi Pencarian</label>
								<?php
									input_pdselect2("date",$dates,$date);
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
						  <th width="10%">Tanggal</th>
						  <th width="10%">No</th>
						  <th>Nama</th>
						  <th>Unit</th>
						  <th>Debitur / Kreditur</th>
						  <th>Keterangan</th>
						</tr>
					</thead>
				</table>
			</div>
			<div class="box-footer">

			</div>
		  </div>	
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
elseif ($page=="transaksi_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('akunting/transaksi/simpan_edit');?>" onClick="return cek();">
		<input type="hidden" name="id_transaksi" value="<?= $id_transaksi; ?>">
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
			</div>
			  <div class="box-body">
					<div class="col-md-12">
						<div class="form-group">
						  <label>Tanggal Transaksi</label>
								<?php
									input_calendar("tgl_transaksi","tgl_transaksi",$tgl_transaksi,""," readonly required");
								?>	
						</div>					
					</div>
					<div class="col-md-12">
						<div class="form-group">
						  <label>No Transaksi</label>
							<?php
								input_text("no_transaksi",$no_transaksi,"maxlength='25' required autofocus","Masukkan No Transaksi","text");
							?>	
						</div>				
					</div>
					<div class="col-md-12">
						<div class="form-group">
						  <label>Jenis Jurnal</label>
							<?php
								input_pdselect2("id_jenis_jurnal",$cmd_jenis_jurnal,$id_jenis_jurnal);
							?>	
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
						  <label>Unit</label>
							<?php
							//	input_pdselect2fleksibel($id_var,$nm_var,$foreach,$id,$name,$selected,$text)
								input_pdselect2fleksibel("id_unit","id_unit",$cmd_unit,"id_unit","nama_unit",$id_unit,"Pilih Unit");
							?>	
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
						  <label>Kreditur / Debitur</label>
							<?php
								input_pdselect2fleksibel("id_dk","id_dk",$cmd_keu_dk,"id_dk","nama_dk",$id_dk,"Pilih Debitur / Kreditur");
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
						  <label>Keterangan</label>
							<?php
								input_text("ket_transaksi",$ket_transaksi,"maxlength='255' autofocus","Ketik Bila Ada Keterangan","text");
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
$('#tgl_transaksi').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_transaksi").inputmask("datetime", {
	mask: "1-2-y", 
	placeholder: "dd-mm-yyyy", 
	leapday: "-02-29", 
	separator: "-", 
	alias: "dd/mm/yyyy"
});
</script>
<?php
}
elseif ($page=="transaksi_lihat")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
		<div class="box-body">     
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">TRANSAKSI</h3>
			</div>
			  <div class="box-body">
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
						  <label>Tanggal Transaksi</label>
								<?php
									input_calendar("tgl_transaksi","tgl_transaksi",$tgl_transaksi,"","");
								?>	
						</div>					
					</div>
					<div class="col-md-3">
						<div class="form-group">
						  <label>No Transaksi</label>
							<?php
								input_text("no_transaksi",$no_transaksi,"","","text");
							?>	
						</div>				
					</div>
					<div class="col-md-3">
						<div class="form-group">
						  <label>Jenis Jurnal</label>
							<?php
								input_text("nama_jenis_jurnal",$nama_jenis_jurnal,"","","text");
							?>	
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
						  <label>Unit</label>
							<?php
								input_text("nama_unit",$nama_unit,"","","text");
							?>	
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
						  <label>Kreditur / Debitur</label>
							<?php
								input_text("nama_dk",$nama_dk,"","","text");
							?>
						</div>
					</div>
					<div class="col-md-9">
						<div class="form-group">
						  <label>Keterangan</label>
							<?php
								input_text("ket_transaksi",$ket_transaksi,"","","text");
							?>	
						</div>				
					</div>
				</div>	
			  </div>
		  </div>
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">COA</h3>
			</div>
			  <div class="box-body">
				<div class="row">			
					<div class="table-responsive" tabindex="-1">
					<div class="col-md-12">
					  <table id="item_table" class="table table-hover table-transaksi table-sm">
						<thead class="bg-light">
						   <tr style="background-color: #800000;color: white;">
							<th class="text-sm text-label text-center border-0" style="width: 25%">COA</th>
							<th class="text-sm text-label text-center border-0" style="width: 15%">Debit</th>
							<th class="text-sm text-label text-center border-0" style="width: 15%">Kredit</th>
							<th class="text-sm text-label text-center border-0" style="width: 10%">Kurs</th>                                
							<th class="text-sm text-label text-center border-0" style="width: 10%">Mata Uang</th>                                
							<th class="text-sm text-label text-center border-0" style="width: 20%">Catatan</th>
							<th class="text-sm text-label text-center border-0" style="width: 5%"></th>
						  </tr>
						</thead>
						<tbody>
						<?php
						foreach($ambil_keuangan_detil as $rowambil_keuangan_detil){
						?>
						  <tr>
							<td class="text-sm text-label border-0">
							<?php echo $rowambil_keuangan_detil['nama_coa']; ?>							
							</td>
							<td class="text-sm text-label border-0 text-right">
							<?php echo number_format($rowambil_keuangan_detil['td_debet'],2); ?>							
							</td>
							<td class="text-sm text-label border-0 text-right">
							<?php echo number_format($rowambil_keuangan_detil['td_kredit'],2); ?>									
							</td>
							<td class="text-sm text-label border-0 text-center">
							<?php echo $rowambil_keuangan_detil['kurs_mata_uang']; ?>							
							</td>                                
							<td class="text-sm text-label border-0 text-center">
							<?php echo $rowambil_keuangan_detil['nama_mata_uang']; ?>						
							</td>                                
							<td class="text-sm text-label border-0">
							<?php echo $rowambil_keuangan_detil['ket_transaksi_detil']; ?>
							</td>
							<td class="text-sm text-label border-0"></td>
						  </tr>
							<?php
						}
							?>
						</tbody>
						<tfoot>
							<td style="vertical-align:middle;font-weight:bold;text-align:left;">
								<h4>TOTAL</h4>
							</td>
							<td class="text-sm text-label border-0 text-right">
							<?php echo number_format($total_transaksi,2); ?>						
							</td>
							<td class="text-sm text-label border-0 text-right">
							<?php echo number_format($total_transaksi,2); ?>									
							</td>
						</tfoot>
					  </table>
					</div>
					<div class="col-md-12 text-right">Admin<br><br><?php echo $nama_pegawai; ?></div>
					</div>
				</div>	
			  </div>
		  </div>
        </div>
        <div class="box-footer">
         
        </div>
      </div>
<script type="text/javascript">
$(document).ready(function() {
	$('.select2').select2()
});	
</script>
<?php
}
elseif ($page=="jurnal_tambah")
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
						<a href="<?php echo $link_kembali;?>" class="btn btn-success" > <i class="fa fa-reply"></i> Kembali</a>	
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
		  <?php echo form_open_multipart('akunting/jurnal/tambah',' id="signupform" ');  
		  input_text("uraian_detil",$uraian_detil,"","","hidden");
		  ?>
		<div class="box-body">     
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">TRANSAKSI</h3>
			</div>
			  <div class="box-body">
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
						  <label>Tanggal Transaksi</label>
								<?php
									input_calendar("tgl_transaksi","tgl_transaksi",$tgl_transaksi,"Masukkan Tanggal Transaksi","readonly required");
								?>	
						</div>					
					</div>
					<div class="col-md-3">
						<div class="form-group">
						  <label>No Transaksi</label>
							<?php
								input_text("no_transaksi",$no_transaksi,"maxlength='25' required autofocus","Masukkan No Transaksi","text");
							?>	
						</div>				
					</div>
					<div class="col-md-3">
						<div class="form-group">
						  <label>Jenis Jurnal</label>
							<?php
								input_pdselect2("id_jenis_jurnal",$cmd_jenis_jurnal,$id_jenis_jurnal);
							?>	
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
						  <label>Unit</label>
							<?php
								input_pdselect2fleksibel("id_unit","id_unit",$cmd_unit,"id_unit","nama_unit",$id_unit,"Pilih Unit");
							?>	
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
						  <label>Kreditur / Debitur</label>
							<?php
								input_pdselect2fleksibel("id_dk","id_dk",$cmd_keu_dk,"id_dk","nama_dk",$id_dk,"Pilih Debitur / Kreditur");
							?>
						</div>
					</div>
					<div class="col-md-9">
						<div class="form-group">
						  <label>Keterangan</label>
							<?php
								input_text("ket_transaksi",$ket_transaksi,"maxlength='25' autofocus","Ketik Bila Ada Keterangan","text");
							?>	
						</div>				
					</div>
				</div>	
			  </div>
		  </div>
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">COA</h3>
			</div>
			  <div class="box-body">
				<div class="row">			
					<div class="table-responsive" tabindex="-1">
					<div class="col-md-12">
					  <table id="item_table" class="table table-hover table-transaksi table-sm">
						<thead class="bg-light">
						   <tr style="background-color: #800000;color: white;">
							<th class="text-sm text-label text-center border-0" style="width: 25%">COA</th>
							<th class="text-sm text-label text-center border-0" style="width: 15%">Debit</th>
							<th class="text-sm text-label text-center border-0" style="width: 15%">Kredit</th>
							<th class="text-sm text-label text-center border-0" style="width: 10%">Kurs</th>                                
							<th class="text-sm text-label text-center border-0" style="width: 10%">Mata Uang</th>                                
							<th class="text-sm text-label text-center border-0" style="width: 20%">Catatan</th>
							<th class="text-sm text-label text-center border-0" style="width: 5%"></th>
						  </tr>
						</thead>
						<tbody>
						  <tr>
							<td class="text-sm text-label border-0">
							<?php
							input_pdselect2url("id_coa","id_coa[]","select_coa form-control select2","required='required'","Pilih Rekening");
							?>								
							</td>
							<td class="text-sm text-label border-0">
							<?php 
								input_textcustom("td_debet[]",$td_debet," style='text-align:right;' required 
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber debet'",
													"Nominal Transaksi","text");					
							?>							
							</td>
							<td class="text-sm text-label border-0">
							<?php 
								input_textcustom("td_kredit[]",$td_kredit," style='text-align:right;' required
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber kredit'",
													"Nominal Transaksi","text");					
							?>								
							</td>
							<td class="text-sm text-label border-0">
							<?php 
								input_textcustom("kurs_mata_uang[]",$kurs_mata_uang," style='text-align:right;' required 
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber'",
													"Kurs Transaksi","text");					
							?>								
							</td>                                
							<td class="text-sm text-label border-0">
							<?php
								input_pdselect2url("id_mata_uang","id_mata_uang[]","select_kurs form-control select2","required='required'","Mata Uang");
							?>							
							</td>                                
							<td class="text-sm text-label border-0">
							<?php
								input_text("ket_transaksi_detil[]",$ket_transaksi_detil,"maxlength='255' ","Masukkan Keterangan","text");
							?>
							</td>
							<td class="text-sm text-label border-0"></td>
						  </tr>
						  <tr>
							<td class="text-sm text-label border-0">
							<?php 
								input_pdselect2url("id_coa","id_coa[]","select_coa form-control select2","required='required'","Pilih Rekening");
							?>								
							</td>
							<td class="text-sm text-label border-0">
							<?php 
								input_textcustom("td_debet[]",$td_debet," style='text-align:right;' required
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber'",
													"Nominal Transaksi","text");					
							?>							
							</td>
							<td class="text-sm text-label border-0">
							<?php 
								input_textcustom("td_kredit[]",$td_kredit," style='text-align:right;' required
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber'",
													"Nominal Transaksi","text");					
							?>								
							</td>
							<td class="text-sm text-label border-0">
							<?php 
								input_textcustom("kurs_mata_uang[]",$kurs_mata_uang," style='text-align:right;' required
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber'",
													"Kurs Transaksi","text");					
							?>								
							</td>                                
							<td class="text-sm text-label border-0">
							<?php
								input_pdselect2url("id_mata_uang","id_mata_uang[]","select_kurs form-control select2","required='required'","Mata Uang");
							?>							
							</td>                                
							<td class="text-sm text-label border-0">
							<?php
								input_text("ket_transaksi_detil[]",$ket_transaksi_detil,"maxlength='255' ","Masukkan Keterangan","text");
							?>
							</td>
							<td class="text-sm text-label border-0"></td>
						  </tr>
						</tbody>
						<tfoot>
							<td style="vertical-align:middle;font-weight:bold;text-align:left;">
								<h4>TOTAL</h4>
							</td>
							<td class="text-sm text-label border-0">
							<?php 			
								input_textcustom("totaldebet",$totaldebet," style='text-align:right;' id='totaldebet' required readonly
												onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber'",
														"Jumlah Transaksi Debet","text");								
							?>							
							</td>
							<td class="text-sm text-label border-0">
							<?php 		
								input_textcustom("totalkredit",$totalkredit," style='text-align:right;' id='totalkredit' required readonly
												onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber'",
														"Jumlah Transaksi Kredit","text");									
							?>								
							</td>
						</tfoot>
					  </table>
					</div>
					<div class="col-md-12">
					
					
					<button type="button" name="add" class="btn btn-success btn-sm add"><span class="glyphicon glyphicon-plus"></span>Tambah Data</button>
					</div>
					</div>
				</div>	
			  </div>
		  </div>
        </div>
        <div class="box-footer">
          <button type="submit" disabled class="setuju btn btn-primary">Submit</button>
        </div>
		<?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="kas_masuk_tambah")
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
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
		  <?php echo form_open_multipart('akunting/kas_masuk/tambah',' id="signupform" ');  
		   input_text("uraian_detil",$uraian_detil,"","","hidden");
		  ?>
		<div id="item_table" class="box-body">     
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">TRANSAKSI</h3>
			</div>
			  <div class="box-body">
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
						  <label>Tanggal Transaksi</label>
								<?php
									input_calendar("tgl_transaksi","tgl_transaksi",$tgl_transaksi,"Masukkan Tanggal Transaksi","readonly required");
								?>	
						</div>					
					</div>
					<div class="col-md-3">
						<div class="form-group">
						  <label>No Transaksi</label>
							<?php
								input_text("no_transaksi",$no_transaksi,"maxlength='25' required autofocus","Masukkan No Transaksi","text");
							?>	
						</div>				
					</div>
					<div class="col-md-3">
						<div class="form-group">
						  <label>Jenis Jurnal</label>
							<?php
								input_pdselect2("id_jenis_jurnal",$cmd_jenis_jurnal,$id_jenis_jurnal);
							?>	
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
						  <label>Unit</label>
							<?php
							//	input_pdselect2fleksibel($id_var,$nm_var,$foreach,$id,$name,$selected,$text)
								input_pdselect2fleksibel("id_unit","id_unit",$cmd_unit,"id_unit","nama_unit",$id_unit,"Pilih Unit");
							?>	
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
						  <label>Kreditur / Debitur</label>
							<?php
								input_pdselect2fleksibel("id_dk","id_dk",$cmd_keu_dk,"id_dk","nama_dk",$id_dk,"Pilih Debitur / Kreditur");
							?>
						</div>
					</div>
					<div class="col-md-9">
						<div class="form-group">
						  <label>Keterangan</label>
							<?php
								input_text("ket_transaksi",$ket_transaksi,"maxlength='25' autofocus","Ketik Bila Ada Keterangan","text");
							?>	
						</div>				
					</div>
				</div>	
			  </div>
		  </div>
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">KAS</h3>
			</div>
			  <div class="box-body">
				<div class="row">			
					<div class="table-responsive" tabindex="-1">
					<div class="col-md-12">
					  <table class="table table-hover table-transaksi table-sm">
						<thead class="bg-light">
						   <tr style="background-color: #800000;color: white;">
							<th class="text-sm text-label text-center border-0" style="width: 25%">COA</th>
							<th class="text-sm text-label text-center border-0" style="width: 15%">Debit</th>
							<th class="text-sm text-label text-center border-0" style="width: 10%">Kurs</th>                                
							<th class="text-sm text-label text-center border-0" style="width: 10%">Mata Uang</th>                                
							<th class="text-sm text-label text-center border-0" style="width: 20%">Catatan</th>
							<th class="text-sm text-label text-center border-0" style="width: 5%"></th>
						  </tr>
						</thead>
						<tbody>
						  <tr>
							<td class="text-sm text-label border-0">
							<?php 
								input_pdselect2url("id_coa","id_coa[]","select_kas form-control select2","required='required'","Pilih Rekening");
							?>								
							</td>
							<td class="text-sm text-label border-0">
							<?php 
								input_textcustom("td_debet[]",$td_debet," style='text-align:right;' required readonly id='totalkredit'
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber'",
													"Nominal Transaksi","text");					
								input_textcustom("td_kredit[]",$td_kredit," style='text-align:right;' required value='0' 
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber'",
													"Nominal Transaksi Kredit","hidden");	
								input_text("total","","","","hidden");
							?>								
							</td>
							<td class="text-sm text-label border-0">
							<?php 
								input_textcustom("kurs_mata_uang[]",$kurs_mata_uang," style='text-align:right;' required
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber'",
													"Kurs Transaksi","text");					
							?>								
							</td>                                
							<td class="text-sm text-label border-0">
							<?php
								input_pdselect2url("id_mata_uang","id_mata_uang[]","select_kurs form-control select2","required='required'","Mata Uang");
							?>							
							</td>                                
							<td class="text-sm text-label border-0">
							<?php
								input_text("ket_transaksi_detil[]",$ket_transaksi_detil,"maxlength='255' ","Masukkan Keterangan","text");
							?>
							</td>
							<td class="text-sm text-label border-0"></td>
						  </tr>
						</tbody>
						<tfoot>
						</tfoot>
					  </table>
					</div>
					</div>
				</div>	
			  </div>
		  </div>
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">COA</h3>
			</div>
			  <div class="box-body">
				<div class="row">			
					<div class="table-responsive" tabindex="-1">
					<div class="col-md-12">
					  <table id="table_ini" class="table table-hover table-transaksi table-sm">
						<thead class="bg-light">
						   <tr style="background-color: #800000;color: white;">
							<th class="text-sm text-label text-center border-0" style="width: 25%">COA</th>
							<th class="text-sm text-label text-center border-0" style="width: 15%">Kredit</th>
							<th class="text-sm text-label text-center border-0" style="width: 10%">Kurs</th>                                
							<th class="text-sm text-label text-center border-0" style="width: 10%">Mata Uang</th>                                
							<th class="text-sm text-label text-center border-0" style="width: 20%">Catatan</th>
							<th class="text-sm text-label text-center border-0" style="width: 5%"></th>
						  </tr>
						</thead>
						<tbody>
						  <tr>
							<td class="text-sm text-label border-0">
							<?php
							input_pdselect2url("id_coa","id_coa[]","select_coa form-control select2","required='required'","Pilih Rekening");
							?>								
							</td>
							<td class="text-sm text-label border-0">
							<?php 				
								input_textcustom("td_kredit[]",$td_kredit," style='text-align:right;' required
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber kredit'",
													"Nominal Transaksi","text");	
								input_textcustom("td_debet[]",$td_debet," style='text-align:right;' required value='0'
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber debet'",
													"Nominal Transaksi","hidden");													
							?>								
							</td>
							<td class="text-sm text-label border-0">
							<?php 
								input_textcustom("kurs_mata_uang[]",$kurs_mata_uang," style='text-align:right;' required 
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber'",
													"Kurs Transaksi","text");					
							?>								
							</td>                                
							<td class="text-sm text-label border-0">
							<?php
								input_pdselect2url("id_mata_uang","id_mata_uang[]","select_kurs form-control select2","required='required'","Mata Uang");
							?>							
							</td>                                
							<td class="text-sm text-label border-0">
							<?php
								input_text("ket_transaksi_detil[]",$ket_transaksi_detil,"maxlength='255' ","Masukkan Keterangan","text");
							?>
							</td>
							<td class="text-sm text-label border-0"></td>
						  </tr>
						</tbody>
						<tfoot>	
						</tfoot>
					  </table>
					</div>
					<div class="col-md-12">
					
					
					<button type="button" name="add" class="btn btn-success btn-sm add"><span class="glyphicon glyphicon-plus"></span>Tambah Data</button>
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
elseif ($page=="kas_keluar_tambah")
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
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
		  <?php echo form_open_multipart('akunting/kas_keluar/tambah',' id="signupform" ');  
		   input_text("uraian_detil",$uraian_detil,"","","hidden");
		  ?>
		<div id="item_table" class="box-body">     
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">TRANSAKSI</h3>
			</div>
			  <div class="box-body">
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
						  <label>Tanggal Transaksi</label>
								<?php
									input_calendar("tgl_transaksi","tgl_transaksi",$tgl_transaksi,"Masukkan Tanggal Transaksi","readonly required");
								?>	
						</div>					
					</div>
					<div class="col-md-3">
						<div class="form-group">
						  <label>No Transaksi</label>
							<?php
								input_text("no_transaksi",$no_transaksi,"maxlength='25' required autofocus","Masukkan No Transaksi","text");
							?>	
						</div>				
					</div>
					<div class="col-md-3">
						<div class="form-group">
						  <label>Jenis Jurnal</label>
							<?php
								input_pdselect2("id_jenis_jurnal",$cmd_jenis_jurnal,$id_jenis_jurnal);
							?>	
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
						  <label>Unit</label>
							<?php
							//	input_pdselect2fleksibel($id_var,$nm_var,$foreach,$id,$name,$selected,$text)
								input_pdselect2fleksibel("id_unit","id_unit",$cmd_unit,"id_unit","nama_unit",$id_unit,"Pilih Unit");
							?>	
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
						  <label>Kreditur / Debitur</label>
							<?php
								input_pdselect2fleksibel("id_dk","id_dk",$cmd_keu_dk,"id_dk","nama_dk",$id_dk,"Pilih Debitur / Kreditur");
							?>
						</div>
					</div>
					<div class="col-md-9">
						<div class="form-group">
						  <label>Keterangan</label>
							<?php
								input_text("ket_transaksi",$ket_transaksi,"maxlength='25' autofocus","Ketik Bila Ada Keterangan","text");
							?>	
						</div>				
					</div>
				</div>	
			  </div>
		  </div>
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">KAS</h3>
			</div>
			  <div class="box-body">
				<div class="row">			
					<div class="table-responsive" tabindex="-1">
					<div class="col-md-12">
					  <table class="table table-hover table-transaksi table-sm">
						<thead class="bg-light">
						   <tr style="background-color: #800000;color: white;">
							<th class="text-sm text-label text-center border-0" style="width: 25%">COA</th>
							<th class="text-sm text-label text-center border-0" style="width: 15%">Kredit</th>
							<th class="text-sm text-label text-center border-0" style="width: 10%">Kurs</th>                                
							<th class="text-sm text-label text-center border-0" style="width: 10%">Mata Uang</th>                                
							<th class="text-sm text-label text-center border-0" style="width: 20%">Catatan</th>
							<th class="text-sm text-label text-center border-0" style="width: 5%"></th>
						  </tr>
						</thead>
						<tbody>
						  <tr>
							<td class="text-sm text-label border-0">
							<?php 
								input_pdselect2url("id_coa","id_coa[]","select_kas form-control select2","required='required'","Pilih Rekening");
							?>								
							</td>
							<td class="text-sm text-label border-0">
							<?php 
								input_textcustom("td_debet[]",$td_debet," style='text-align:right;' required readonly id='totalkredit'
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber'",
													"Nominal Transaksi","text");					
								input_textcustom("td_kredit[]",$td_kredit," style='text-align:right;' required value='0' 
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber'",
													"Nominal Transaksi Kredit","hidden");	
								input_text("total","","","","hidden");
							?>								
							</td>
							<td class="text-sm text-label border-0">
							<?php 
								input_textcustom("kurs_mata_uang[]",$kurs_mata_uang," style='text-align:right;' required
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber'",
													"Kurs Transaksi","text");					
							?>								
							</td>                                
							<td class="text-sm text-label border-0">
							<?php
								input_pdselect2url("id_mata_uang","id_mata_uang[]","select_kurs form-control select2","required='required'","Mata Uang");
							?>							
							</td>                                
							<td class="text-sm text-label border-0">
							<?php
								input_text("ket_transaksi_detil[]",$ket_transaksi_detil,"maxlength='255' ","Masukkan Keterangan","text");
							?>
							</td>
							<td class="text-sm text-label border-0"></td>
						  </tr>
						</tbody>
						<tfoot>
						</tfoot>
					  </table>
					</div>
					</div>
				</div>	
			  </div>
		  </div>
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">COA</h3>
			</div>
			  <div class="box-body">
				<div class="row">			
					<div class="table-responsive" tabindex="-1">
					<div class="col-md-12">
					  <table id="table_ini" class="table table-hover table-transaksi table-sm">
						<thead class="bg-light">
						   <tr style="background-color: #800000;color: white;">
							<th class="text-sm text-label text-center border-0" style="width: 25%">COA</th>
							<th class="text-sm text-label text-center border-0" style="width: 15%">Debet</th>
							<th class="text-sm text-label text-center border-0" style="width: 10%">Kurs</th>                                
							<th class="text-sm text-label text-center border-0" style="width: 10%">Mata Uang</th>                                
							<th class="text-sm text-label text-center border-0" style="width: 20%">Catatan</th>
							<th class="text-sm text-label text-center border-0" style="width: 5%"></th>
						  </tr>
						</thead>
						<tbody>
						  <tr>
							<td class="text-sm text-label border-0">
							<?php
							input_pdselect2url("id_coa","id_coa[]","select_coa form-control select2","required='required'","Pilih Rekening");
							?>								
							</td>
							<td class="text-sm text-label border-0">
							<?php 				
								input_textcustom("td_kredit[]",$td_kredit," style='text-align:right;' required
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber kredit'",
													"Nominal Transaksi","text");	
								input_textcustom("td_debet[]",$td_debet," style='text-align:right;' required value='0'
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber debet'",
													"Nominal Transaksi","hidden");													
							?>								
							</td>
							<td class="text-sm text-label border-0">
							<?php 
								input_textcustom("kurs_mata_uang[]",$kurs_mata_uang," style='text-align:right;' required 
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber'",
													"Kurs Transaksi","text");					
							?>								
							</td>                                
							<td class="text-sm text-label border-0">
							<?php
								input_pdselect2url("id_mata_uang","id_mata_uang[]","select_kurs form-control select2","required='required'","Mata Uang");
							?>							
							</td>                                
							<td class="text-sm text-label border-0">
							<?php
								input_text("ket_transaksi_detil[]",$ket_transaksi_detil,"maxlength='255' ","Masukkan Keterangan","text");
							?>
							</td>
							<td class="text-sm text-label border-0"></td>
						  </tr>
						</tbody>
						<tfoot>	
						</tfoot>
					  </table>
					</div>
					<div class="col-md-12">
					
					
					<button type="button" name="add" class="btn btn-success btn-sm add"><span class="glyphicon glyphicon-plus"></span>Tambah Data</button>
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
elseif ($page=="bank_masuk_tambah")
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
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
		  <?php echo form_open_multipart('akunting/bank_masuk/tambah',' id="signupform" ');  
		   input_text("uraian_detil",$uraian_detil,"","","hidden");
		  ?>
		<div id="item_table" class="box-body">     
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">TRANSAKSI</h3>
			</div>
			  <div class="box-body">
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
						  <label>Tanggal Transaksi</label>
								<?php
									input_calendar("tgl_transaksi","tgl_transaksi",$tgl_transaksi,"Masukkan Tanggal Transaksi","readonly required");
								?>	
						</div>					
					</div>
					<div class="col-md-3">
						<div class="form-group">
						  <label>No Transaksi</label>
							<?php
								input_text("no_transaksi",$no_transaksi,"maxlength='25' required autofocus","Masukkan No Transaksi","text");
							?>	
						</div>				
					</div>
					<div class="col-md-3">
						<div class="form-group">
						  <label>Jenis Jurnal</label>
							<?php
								input_pdselect2("id_jenis_jurnal",$cmd_jenis_jurnal,$id_jenis_jurnal);
							?>	
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
						  <label>Unit</label>
							<?php
							//	input_pdselect2fleksibel($id_var,$nm_var,$foreach,$id,$name,$selected,$text)
								input_pdselect2fleksibel("id_unit","id_unit",$cmd_unit,"id_unit","nama_unit",$id_unit,"Pilih Unit");
							?>	
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
						  <label>Kreditur / Debitur</label>
							<?php
								input_pdselect2fleksibel("id_dk","id_dk",$cmd_keu_dk,"id_dk","nama_dk",$id_dk,"Pilih Debitur / Kreditur");
							?>
						</div>
					</div>
					<div class="col-md-9">
						<div class="form-group">
						  <label>Keterangan</label>
							<?php
								input_text("ket_transaksi",$ket_transaksi,"maxlength='25' autofocus","Ketik Bila Ada Keterangan","text");
							?>	
						</div>				
					</div>
				</div>	
			  </div>
		  </div>
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">BANK</h3>
			</div>
			  <div class="box-body">
				<div class="row">			
					<div class="table-responsive" tabindex="-1">
					<div class="col-md-12">
					  <table class="table table-hover table-transaksi table-sm">
						<thead class="bg-light">
						   <tr style="background-color: #800000;color: white;">
							<th class="text-sm text-label text-center border-0" style="width: 25%">COA</th>
							<th class="text-sm text-label text-center border-0" style="width: 15%">Debit</th>
							<th class="text-sm text-label text-center border-0" style="width: 10%">Kurs</th>                                
							<th class="text-sm text-label text-center border-0" style="width: 10%">Mata Uang</th>                                
							<th class="text-sm text-label text-center border-0" style="width: 20%">Catatan</th>
							<th class="text-sm text-label text-center border-0" style="width: 5%"></th>
						  </tr>
						</thead>
						<tbody>
						  <tr>
							<td class="text-sm text-label border-0">
							<?php 
								input_pdselect2url("id_coa","id_coa[]","select_kas form-control select2","required='required'","Pilih Rekening");
							?>								
							</td>
							<td class="text-sm text-label border-0">
							<?php 
								input_textcustom("td_debet[]",$td_debet," style='text-align:right;' required readonly id='totalkredit'
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber'",
													"Nominal Transaksi","text");					
								input_textcustom("td_kredit[]",$td_kredit," style='text-align:right;' required value='0' 
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber'",
													"Nominal Transaksi Kredit","hidden");	
								input_text("total","","","","hidden");
							?>								
							</td>
							<td class="text-sm text-label border-0">
							<?php 
								input_textcustom("kurs_mata_uang[]",$kurs_mata_uang," style='text-align:right;' required
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber'",
													"Kurs Transaksi","text");					
							?>								
							</td>                                
							<td class="text-sm text-label border-0">
							<?php
								input_pdselect2url("id_mata_uang","id_mata_uang[]","select_kurs form-control select2","required='required'","Mata Uang");
							?>							
							</td>                                
							<td class="text-sm text-label border-0">
							<?php
								input_text("ket_transaksi_detil[]",$ket_transaksi_detil,"maxlength='255' ","Masukkan Keterangan","text");
							?>
							</td>
							<td class="text-sm text-label border-0"></td>
						  </tr>
						</tbody>
						<tfoot>
						</tfoot>
					  </table>
					</div>
					</div>
				</div>	
			  </div>
		  </div>
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">COA</h3>
			</div>
			  <div class="box-body">
				<div class="row">			
					<div class="table-responsive" tabindex="-1">
					<div class="col-md-12">
					  <table id="table_ini" class="table table-hover table-transaksi table-sm">
						<thead class="bg-light">
						   <tr style="background-color: #800000;color: white;">
							<th class="text-sm text-label text-center border-0" style="width: 25%">COA</th>
							<th class="text-sm text-label text-center border-0" style="width: 15%">Kredit</th>
							<th class="text-sm text-label text-center border-0" style="width: 10%">Kurs</th>                                
							<th class="text-sm text-label text-center border-0" style="width: 10%">Mata Uang</th>                                
							<th class="text-sm text-label text-center border-0" style="width: 20%">Catatan</th>
							<th class="text-sm text-label text-center border-0" style="width: 5%"></th>
						  </tr>
						</thead>
						<tbody>
						  <tr>
							<td class="text-sm text-label border-0">
							<?php
							input_pdselect2url("id_coa","id_coa[]","select_coa form-control select2","required='required'","Pilih Rekening");
							?>								
							</td>
							<td class="text-sm text-label border-0">
							<?php 				
								input_textcustom("td_kredit[]",$td_kredit," style='text-align:right;' required
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber kredit'",
													"Nominal Transaksi","text");	
								input_textcustom("td_debet[]",$td_debet," style='text-align:right;' required value='0'
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber debet'",
													"Nominal Transaksi","hidden");													
							?>								
							</td>
							<td class="text-sm text-label border-0">
							<?php 
								input_textcustom("kurs_mata_uang[]",$kurs_mata_uang," style='text-align:right;' required 
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber'",
													"Kurs Transaksi","text");					
							?>								
							</td>                                
							<td class="text-sm text-label border-0">
							<?php
								input_pdselect2url("id_mata_uang","id_mata_uang[]","select_kurs form-control select2","required='required'","Mata Uang");
							?>							
							</td>                                
							<td class="text-sm text-label border-0">
							<?php
								input_text("ket_transaksi_detil[]",$ket_transaksi_detil,"maxlength='255' ","Masukkan Keterangan","text");
							?>
							</td>
							<td class="text-sm text-label border-0"></td>
						  </tr>
						</tbody>
						<tfoot>	
						</tfoot>
					  </table>
					</div>
					<div class="col-md-12">
					
					
					<button type="button" name="add" class="btn btn-success btn-sm add"><span class="glyphicon glyphicon-plus"></span>Tambah Data</button>
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
elseif ($page=="bank_keluar_tambah")
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
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
		  <?php echo form_open_multipart('akunting/bank_keluar/tambah',' id="signupform" ');  
		   input_text("uraian_detil",$uraian_detil,"","","hidden");
		  ?>
		<div id="item_table" class="box-body">     
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">TRANSAKSI</h3>
			</div>
			  <div class="box-body">
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
						  <label>Tanggal Transaksi</label>
								<?php
									input_calendar("tgl_transaksi","tgl_transaksi",$tgl_transaksi,"Masukkan Tanggal Transaksi","readonly required");
								?>	
						</div>					
					</div>
					<div class="col-md-3">
						<div class="form-group">
						  <label>No Transaksi</label>
							<?php
								input_text("no_transaksi",$no_transaksi,"maxlength='25' required autofocus","Masukkan No Transaksi","text");
							?>	
						</div>				
					</div>
					<div class="col-md-3">
						<div class="form-group">
						  <label>Jenis Jurnal</label>
							<?php
								input_pdselect2("id_jenis_jurnal",$cmd_jenis_jurnal,$id_jenis_jurnal);
							?>	
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
						  <label>Unit</label>
							<?php
							//	input_pdselect2fleksibel($id_var,$nm_var,$foreach,$id,$name,$selected,$text)
								input_pdselect2fleksibel("id_unit","id_unit",$cmd_unit,"id_unit","nama_unit",$id_unit,"Pilih Unit");
							?>	
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
						  <label>Kreditur / Debitur</label>
							<?php
								input_pdselect2fleksibel("id_dk","id_dk",$cmd_keu_dk,"id_dk","nama_dk",$id_dk,"Pilih Debitur / Kreditur");
							?>
						</div>
					</div>
					<div class="col-md-9">
						<div class="form-group">
						  <label>Keterangan</label>
							<?php
								input_text("ket_transaksi",$ket_transaksi,"maxlength='25' autofocus","Ketik Bila Ada Keterangan","text");
							?>	
						</div>				
					</div>
				</div>	
			  </div>
		  </div>
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">BANK</h3>
			</div>
			  <div class="box-body">
				<div class="row">			
					<div class="table-responsive" tabindex="-1">
					<div class="col-md-12">
					  <table class="table table-hover table-transaksi table-sm">
						<thead class="bg-light">
						   <tr style="background-color: #800000;color: white;">
							<th class="text-sm text-label text-center border-0" style="width: 25%">COA</th>
							<th class="text-sm text-label text-center border-0" style="width: 15%">Kredit</th>
							<th class="text-sm text-label text-center border-0" style="width: 10%">Kurs</th>                                
							<th class="text-sm text-label text-center border-0" style="width: 10%">Mata Uang</th>                                
							<th class="text-sm text-label text-center border-0" style="width: 20%">Catatan</th>
							<th class="text-sm text-label text-center border-0" style="width: 5%"></th>
						  </tr>
						</thead>
						<tbody>
						  <tr>
							<td class="text-sm text-label border-0">
							<?php 
								input_pdselect2url("id_coa","id_coa[]","select_kas form-control select2","required='required'","Pilih Rekening");
							?>								
							</td>
							<td class="text-sm text-label border-0">
							<?php 
								input_textcustom("td_debet[]",$td_debet," style='text-align:right;' required readonly id='totalkredit'
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber'",
													"Nominal Transaksi","text");					
								input_textcustom("td_kredit[]",$td_kredit," style='text-align:right;' required value='0' 
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber'",
													"Nominal Transaksi Kredit","hidden");	
								input_text("total","","","","hidden");
							?>								
							</td>
							<td class="text-sm text-label border-0">
							<?php 
								input_textcustom("kurs_mata_uang[]",$kurs_mata_uang," style='text-align:right;' required
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber'",
													"Kurs Transaksi","text");					
							?>								
							</td>                                
							<td class="text-sm text-label border-0">
							<?php
								input_pdselect2url("id_mata_uang","id_mata_uang[]","select_kurs form-control select2","required='required'","Mata Uang");
							?>							
							</td>                                
							<td class="text-sm text-label border-0">
							<?php
								input_text("ket_transaksi_detil[]",$ket_transaksi_detil,"maxlength='255' ","Masukkan Keterangan","text");
							?>
							</td>
							<td class="text-sm text-label border-0"></td>
						  </tr>
						</tbody>
						<tfoot>
						</tfoot>
					  </table>
					</div>
					</div>
				</div>	
			  </div>
		  </div>
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">COA</h3>
			</div>
			  <div class="box-body">
				<div class="row">			
					<div class="table-responsive" tabindex="-1">
					<div class="col-md-12">
					  <table id="table_ini" class="table table-hover table-transaksi table-sm">
						<thead class="bg-light">
						   <tr style="background-color: #800000;color: white;">
							<th class="text-sm text-label text-center border-0" style="width: 25%">COA</th>
							<th class="text-sm text-label text-center border-0" style="width: 15%">Debet</th>
							<th class="text-sm text-label text-center border-0" style="width: 10%">Kurs</th>                                
							<th class="text-sm text-label text-center border-0" style="width: 10%">Mata Uang</th>                                
							<th class="text-sm text-label text-center border-0" style="width: 20%">Catatan</th>
							<th class="text-sm text-label text-center border-0" style="width: 5%"></th>
						  </tr>
						</thead>
						<tbody>
						  <tr>
							<td class="text-sm text-label border-0">
							<?php
							input_pdselect2url("id_coa","id_coa[]","select_coa form-control select2","required='required'","Pilih Rekening");
							?>								
							</td>
							<td class="text-sm text-label border-0">
							<?php 				
								input_textcustom("td_kredit[]",$td_kredit," style='text-align:right;' required
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber kredit'",
													"Nominal Transaksi","text");	
								input_textcustom("td_debet[]",$td_debet," style='text-align:right;' required value='0'
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber debet'",
													"Nominal Transaksi","hidden");													
							?>								
							</td>
							<td class="text-sm text-label border-0">
							<?php 
								input_textcustom("kurs_mata_uang[]",$kurs_mata_uang," style='text-align:right;' required 
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber'",
													"Kurs Transaksi","text");					
							?>								
							</td>                                
							<td class="text-sm text-label border-0">
							<?php
								input_pdselect2url("id_mata_uang","id_mata_uang[]","select_kurs form-control select2","required='required'","Mata Uang");
							?>							
							</td>                                
							<td class="text-sm text-label border-0">
							<?php
								input_text("ket_transaksi_detil[]",$ket_transaksi_detil,"maxlength='255' ","Masukkan Keterangan","text");
							?>
							</td>
							<td class="text-sm text-label border-0"></td>
						  </tr>
						</tbody>
						<tfoot>	
						</tfoot>
					  </table>
					</div>
					<div class="col-md-12">
					
					
					<button type="button" name="add" class="btn btn-success btn-sm add"><span class="glyphicon glyphicon-plus"></span>Tambah Data</button>
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
elseif ($page=="saldo_awal_tambah")
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
		  <?php echo form_open_multipart('akunting/saldo_awal/tambah',' id="signupform" ');  
		   input_text("uraian_detil",$uraian_detil,"","","hidden");
		   input_text("no_transaksi",$no_transaksi,"","","hidden");
		   input_text("ket_transaksi",$ket_transaksi,"","","hidden");
		   input_text("id_jenis_jurnal",$id_jenis_jurnal,"","","hidden");
		  ?>
		<div id="item_table" class="box-body">     
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">TRANSAKSI</h3>
			</div>
			  <div class="box-body">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
						  <label>Tanggal Transaksi</label>
								<?php
									input_calendar("tgl_transaksi","tgl_transaksi",$tgl_transaksi,"Masukkan Tanggal Transaksi","readonly required");
								?>	
						</div>					
					</div>
					<div class="col-md-4">
						<div class="form-group">
						  <label>Unit</label>
							<?php
							//	input_pdselect2fleksibel($id_var,$nm_var,$foreach,$id,$name,$selected,$text)
								input_pdselect2fleksibel("id_unit","id_unit",$cmd_unit,"id_unit","nama_unit",$id_unit,"Pilih Unit");
							?>	
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
						  <label>Kreditur / Debitur</label>
							<?php
								input_pdselect2fleksibel("id_dk","id_dk",$cmd_keu_dk,"id_dk","nama_dk",$id_dk,"Pilih Debitur / Kreditur");
							?>
						</div>
					</div>
				</div>	
			  </div>
		  </div>
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">SALDO AWAL</h3>
			</div>
			  <div class="box-body">
				<div class="row">			
					<div class="table-responsive" tabindex="-1">
					<div class="col-md-12">
					  <table class="table table-hover table-transaksi table-sm">
						<thead class="bg-light">
						   <tr style="background-color: #800000;color: white;">
							<th class="text-sm text-label text-center border-0">COA</th>
							<th class="text-sm text-label text-center border-0" style="width: 25%">Debit</th>
						  </tr>
						</thead>
						<tbody>
						  <tr>
							<td class="text-sm text-label border-0">
							<?php 
								input_pdselect2url("id_coa","id_coa[]","select_kas form-control select2","required='required'","Pilih Rekening");
							?>								
							</td>
							<td class="text-sm text-label border-0">
							<?php 
								input_textcustom("td_debet[]",$td_debet," style='text-align:right;' required
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='inpt form-control inputnumber'",
													"Nominal Transaksi","text");						
								input_textcustom("td_kredit[]","0"," style='text-align:right;'
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
													"Nominal Transaksi Kredit","hidden");	
								input_textcustom("total",$total," style='text-align:right;'
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='inpt form-control'",
													"Nominal Transaksi","hidden");	
								input_text("id_mata_uang[]","1","","","hidden");
								input_text("kurs_mata_uang[]","1","","","hidden");
								input_text("ket_transaksi_detil[]",$ket_transaksi_detil,"","","hidden");
							?>								
							</td>                                                             
						  </tr>
						</tbody>
						<tfoot>
						</tfoot>
					  </table>
					</div>
					</div>
				</div>	
			  </div>
		  </div>
		<div class="col-md-12">
		<?php
			input_text("id_coa[]","56","","","hidden");
			input_text("kurs_mata_uang[]","1","","","hidden");
			input_text("id_mata_uang[]","1","","","hidden");
			input_text("ket_transaksi_detil[]",$ket_transaksi_detil,"","","hidden");
			input_textcustom("td_kredit[]",$td_kredit," style='text-align:right;'
						onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='inpt form-control'",
								"Nominal Transaksi","hidden");	
			input_textcustom("td_debet[]","0"," style='text-align:right;'
						onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
								"Nominal Transaksi","hidden");	
		?>		
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
//================================== ORDER BELI ===============================
elseif ($page=="order_beli")
{
?>
<style>
    @media (min-width: 768px) {
      .modal-xl {
        width: 90%;
       max-width:1200px;
      }
    }
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $instance_name; ?> <small></small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $header; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
		<div class="box-body">    
			<?php echo form_open_multipart('akunting/order_beli/view/'.$first_date.'/'.$last_date,' id="signupform" '); ?>
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
			</div>
			  <div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
						  <label>Opsi Pencarian</label>
								<?php
									input_pdselect2("date",$dates,$date);
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
						  <th width="5%">ID</th>
						  <th width="10%">Tanggal</th>
						  <th width="10%">No</th>
						  <th>Unit</th>
						  <th>Debitur / Kreditur</th>
						  <th>Termin</th>
						  <th>Status</th>
						</tr>
					</thead>
				</table>
			</div>
			<div class="box-footer">

			</div>
		  </div>	
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
elseif ($page=="order_beli_tambahx")
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
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
		  <?php echo form_open_multipart('akunting/order_beli/tambah',' id="signupform" ');  

		  ?>
		<div class="box-body">     
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">TRANSAKSI</h3>
			</div>
			  <div class="box-body">
				<div class="row">
					<div class="col-md-7">
						<div class="col-md-4">
							<div class="form-group">
							  <label>Tanggal</label>
									<?php
										input_calendar("tgl_order_beli","tgl_order_beli",$tgl_order_beli,"Masukkan Tanggal","readonly required");
									?>	
							</div>					
						</div>
						<div class="col-md-4">
							<div class="form-group">
							  <label>No Order</label>
								<?php
									input_text("no_order_beli",$no_order_beli,"maxlength='25' required autofocus","Masukkan No","text");
								?>	
							</div>				
						</div>
						<div class="col-md-4">
							<div class="form-group">
							  <label>Unit</label>
								<?php
									input_pdselect2fleksibel("id_unit","id_unit",$cmd_unit,"id_unit","nama_unit",$id_unit,"Pilih Unit");
								?>	
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							  <label>Keterangan</label>
								<?php
									input_text("ket_order_beli",$ket_order_beli,"maxlength='255' ","Ketik Bila Ada Keterangan","text");
								?>	
							</div>				
						</div>
						<div class="col-md-3">
							<div class="form-group">
							  <label>Tunai / Termin</label>
								<?php
									input_pdselect2fleksibel("id_termin","id_termin",$cmd_termin,"id_termin","nama_termin",$id_termin,"Tunai");
								?>	
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
							  <label>Pajak</label>
									<?php
										input_pdcustom("pajak",$cmd_pajak,$pajak, "onchange='updateDepIT();'");
									?>	
							</div>					
						</div>
					</div>
					<div class="col-md-5">
						<div class="col-md-6">
							<div class="form-group">
							  <label>Kreditur / Debitur</label>
								<?php
									input_pdselect2fleksibel("id_dk","id_dk",$cmd_keu_dk,"id_dk","nama_dk",$id_dk,"Pilih Debitur / Kreditur");
								?>
							</div>		
						</div>
						<div class="col-md-6">
							<div class="form-group">
							  <label>Kontak Person</label>
								<?php
									input_text("kontak",$kontak,"maxlength='255' ","Kontak Person","text");
								?>	
							</div>		
						</div>	
						<div class="col-md-12">
							<div class="form-group">
							  <label>Alamat Kontak</label>
								<?php
									input_text("alamat",$alamat,"maxlength='255' ","Alamat Kontak Person","text");
								?>	
							</div>						
						</div>						
					</div>
				</div>	
			  </div>
		  </div>
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">COA</h3>
			</div>
			  <div class="box-body">
				<div class="row">			
					<div class="table-responsive" tabindex="-1">
					<div class="col-md-12">
					  <table id="item_table" class="table table-hover table-transaksi table-sm">
						<thead class="bg-light">
						  <tr style="background-color: #800000;color: white;">
							<th class="text-sm text-label text-center border-0" style="width: 20%">Nama Barang</th>
							<th class="text-sm text-label text-center border-0" style="width: 12%">Merk</th>
							<th class="text-sm text-label text-center border-0" style="width: 7%">Qty</th>                                
							<th class="text-sm text-label text-center border-0" style="width: 10%">Satuan</th>                                
							<th class="text-sm text-label text-center border-0" style="width: 10%">Harga</th>
							<th class="text-sm text-label text-center border-0" style="width: 10%">Diskon</th>
							<th class="text-sm text-label text-center border-0" style="width: 8%">Disc %</th>
							<th class="text-sm text-label text-center border-0" style="width: 10%">Jumlah</th>
							<th class="text-sm text-label text-center border-0" style="width: 10%">Keterangan</th>
							<th class="text-sm text-label text-center border-0" style="width: 3%"> - </th>
						  </tr>
						</thead>
						<tbody>
						  <tr>
							<td class="text-sm text-label border-0">
							<?php
							input_pdselect2url("id_barang","id_barang[]","select_barang form-control select2","required='required'","Pilih Barang");
							?>								
							</td>
							<td class="text-sm text-label border-0">
							<?php 
								input_text("merk_ob_detil[]",$merk_ob_detil,"maxlength='255' ","Merk","text");				
							?>							
							</td>
							<td class="text-sm text-label border-0">
							<?php 
								input_textcustom("jml_ob_detil[]",$jml_ob_detil," style='text-align:right;' required
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control jml'",
													"Jumlah","text");					
							?>								
							</td>                                
							<td class="text-sm text-label border-0">
							<?php
								input_pdselect2url("satuan_besar","satuan_besar[]","select_satuan form-control select2","required='required'","Satuan");
							?>							
							</td>    
							<td class="text-sm text-label border-0">
							<?php 
								input_textcustom("harga_ob_detil[]",$harga_ob_detil," style='text-align:right;' required 
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber harga'",
													"Harga","text");					
							?>								
							</td>     
							<td class="text-sm text-label border-0">
							<?php 
								input_textcustom("diskon_ob_detil[]",$diskon_ob_detil," style='text-align:right;' required 
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber diskon'",
													"Kurs Transaksi","text");					
							?>								
							</td> 			
							<td class="text-sm text-label border-0">
							<?php 
								input_textcustom("persen_order_beli[]",$persen_order_beli," style='text-align:right;' required 
											maxlength='3' onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control persen'",
													"Persen","text");	
							?>								
							</td> 	
							<td class="text-sm text-label border-0">
								<?php 			
									input_textcustom("total_ob_detil",$total_ob_detil," style='text-align:right;' required readonly
													onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber total'",
															"Total","text");								
								?>	
							</td>							
							<td class="text-sm text-label border-0">
							<?php
								input_text("ket_ob_detil[]",$ket_ob_detil,"maxlength='255' ","Keterangan","text");
							?>
							</td>
							<td class="text-sm text-label border-0">&nbsp;</td>
						  </tr>
							<tr id="addDepIt">
								<td colspan="4" style="vertical-align:middle;font-weight:bold;text-align:right;">
									Sub Total
								</td>
								<td class="text-sm text-label border-0">
								<?php 			
									input_textcustom("subtotal_order_beli",$subtotal_order_beli," style='text-align:right;' required readonly id='subtotal_order_beli'
													onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber'",
															"% Diskon","text");								
								?>							
								</td>		
								<td class="text-sm text-label border-0">
								<?php 			
									input_textcustom("diskon_order_beli",$diskon_order_beli," style='text-align:right;' required
													onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber dob'",
															"Diskon","text");								
								?>							
								</td>	
								<td colspan="3" style="vertical-align:middle;font-weight:bold;text-align:left;">
									Diskon Rp Keseluruhan
								</td>								
							</tr>
							<tr>
								<td colspan="4" style="vertical-align:middle;font-weight:bold;text-align:right;">
									PPN
								</td>
								<td class="text-sm text-label border-0">
								<?php 			
									input_textcustom("ppn_order_beli",$ppn_order_beli," style='text-align:right;' required readonly
													onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber'",
															"% Diskon","text");								
								?>							
								</td>	
								<td class="text-sm text-label border-0">
								<?php 			
									input_textcustom("persen_order_beli",$persen_order_beli," style='text-align:right;' required maxlength='3' 
													onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control pob'",
															"% Diskon","text");								
								?>							
								</td>		
								<td colspan="3" style="vertical-align:middle;font-weight:bold;text-align:left;">
									Diskon Persen Keseluruhan
								</td>								
							</tr>
							<tr>
								<td colspan="4" style="vertical-align:middle;font-weight:bold;text-align:right;">
									Total
								</td>
								<td class="text-sm text-label border-0">
								<?php 			
									input_textcustom("total_order_beli",$total_order_beli," style='text-align:right;' required readonly 
													onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber'",
															"% Diskon","text");								
								?>							
								</td>	
								<td colspan="4" class="text-sm text-label border-0">	
								</td>								
							</tr>
						</tbody>
					  </table>
					</div>
					<div class="col-md-12">							
						<button type="button" name="add" class="btn btn-success btn-sm add">
							<span class="glyphicon glyphicon-plus"></span>Tambah Data
						</button>
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
elseif ($page=="order_beli_tambah")
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
		  <h3 class="box-title">CATATAN</h3>
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
            <div style="font-weight:bold;color:red;" class="box-body">
				<ul>
				<li>SESUDAH MENAMBAH BARANG HARAP LANGSUNG DISIMPAN, APABILA RELOGIN BARANG YANG BELUM DISIMPAN AKAN TERHAPUS</li>
				<li>JIKA MEMILIH DISKON, SALAH SATU ANTARA DISKON RUPIAH ATAU DISKON PERSEN (%) SAJA, APABILA KEDUANYA DIISI YANG DIHITUNG HANYA PERSEN (%)</li>
				<li>APABILA BARANG TIDAK MEMILIKI SATUAN KECIL MAKA ISI KONVERSI NOL (0) DAN SATUAN KECIL SAMA DENGAN SATUAN BESAR</li>
				</ul>
            </div>
            <!-- /.box-body -->
          </div>
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
		  <?php echo form_open_multipart('akunting/order_beli/tambah',' id="signupform" ');  

		  ?>
		<div class="box-body">     
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">TRANSAKSI</h3>
			</div>
			  <div class="box-body">
				<div class="row">
					<div class="col-md-7">
						<div class="col-md-4">
							<div class="form-group">
							  <label>Tanggal</label>
									<?php
										input_calendar("tgl_order_beli","tgl_order_beli",$tgl_order_beli,"Masukkan Tanggal","readonly required");
									?>	
							</div>					
						</div>
						<div class="col-md-4">
							<div class="form-group">
							  <label>No Order</label>
								<?php
									input_text("no_order_beli",$no_order_beli,"maxlength='25' required autofocus","Masukkan No","text");
								?>	
							</div>				
						</div>
						<div class="col-md-4">
							<div class="form-group">
							  <label>Unit</label>
								<?php
									input_pdselect2fleksibel("id_unit","id_unit",$cmd_unit,"id_unit","nama_unit",$id_unit,"Pilih Unit");
								?>	
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							  <label>Keterangan</label>
								<?php
									input_text("ket_order_beli",$ket_order_beli,"maxlength='255' ","Ketik Bila Ada Keterangan","text");
								?>	
							</div>				
						</div>
						<div class="col-md-3">
							<div class="form-group">
							  <label>Tunai / Termin</label>
								<?php
									input_pdselect2fleksibel("id_termin","id_termin",$cmd_termin,"id_termin","nama_termin",$id_termin,"Tunai");
								?>	
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
							  <label>Pajak</label>
									<?php
										input_pdselect2("pajak",$cmd_pajak,$pajak);
									?>	
							</div>					
						</div>
					</div>
					<div class="col-md-5">
						<div class="col-md-6">
							<div class="form-group">
							  <label>Kreditur / Debitur</label>
								<?php
									input_pdselect2fleksibel("id_dk","id_dk",$cmd_keu_dk,"id_dk","nama_dk",$id_dk,"Pilih Debitur / Kreditur");
								?>
							</div>		
						</div>
						<div class="col-md-6">
							<div class="form-group">
							  <label>Kontak Person</label>
								<?php
									input_text("kontak",$kontak,"maxlength='255' ","Kontak Person","text");
								?>	
							</div>		
						</div>	
						<div class="col-md-12">
							<div class="form-group">
							  <label>Alamat Kontak</label>
								<?php
									input_text("alamat",$alamat,"maxlength='255' ","Alamat Kontak Person","text");
								?>	
							</div>						
						</div>						
					</div>
				</div>	
			  </div>
		  </div>
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">
						<button type="submit" name="action" value="BtnTambah" class="btn btn-success btn-xs">
							<i class="glyphicon glyphicon-plus"></i> Tambah
						</button>				  
			  </h3>
			</div>
			  <div class="box-body">
				<div class="row">			
					<div class="table-responsive" tabindex="-1">
					<div class="col-md-12">
					  <table id="item_table" class="table table-hover table-transaksi table-sm">
						<thead class="bg-light">
						  <tr style="background-color: #800000;color: white;">
							<th colspan="2" class="text-sm text-label text-center border-0" style="width: 20%">Nama Barang</th>
							<th class="text-sm text-label text-center border-0" style="width: 15%">Merk</th>
							<th class="text-sm text-label text-center border-0" style="width: 7%">Qty</th>                                                                
							<th class="text-sm text-label text-center border-0" style="width: 10%">Harga</th>
							<th class="text-sm text-label text-center border-0" style="width: 10%">Diskon</th>
							<th class="text-sm text-label text-center border-0" style="width: 7%">Disc %</th>
							<th class="text-sm text-label text-center border-0" style="width: 10%">Jumlah</th>
							<th colspan="2" class="text-sm text-label text-center border-0" style="width: 16%">Keterangan</th>
						  </tr>
						</thead>
						<tbody>
						  <tr>
							<td colspan="2"  class="text-sm text-label border-0">
							<?php
							input_pdselect2url("id_barang","id_barang","select_barang form-control select2","","Pilih Barang");
							?>								
							</td>
							<td class="text-sm text-label border-0">
							<?php 
								input_text("merk_ob_detil",$merk_ob_detil,"maxlength='255' ","Merk","text");				
							?>							
							</td>
							<td class="text-sm text-label border-0">
							<?php 
								input_textcustom("jml_ob_detil",$jml_ob_detil," style='text-align:right;' 
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control jml'",
													"Jumlah","text");					
							?>								
							</td>                                 
							<td class="text-sm text-label border-0">
							<?php 
								input_textcustom("harga_ob_detil",$harga_ob_detil," style='text-align:right;'  
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber harga'",
													"Harga","text");					
							?>								
							</td>     
							<td class="text-sm text-label border-0">
							<?php 
								input_textcustom("diskon_ob_detil",$diskon_ob_detil," style='text-align:right;'  
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber diskon'",
													"Kurs Transaksi","text");					
							?>								
							</td> 			
							<td class="text-sm text-label border-0">
							<?php 
								input_textcustom("persen_ob_detil",$persen_ob_detil," style='text-align:right;'  
											maxlength='3' onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control persen'",
													"Persen","text");	
							?>								
							</td> 	
							<td class="text-sm text-label border-0">
								<?php 			
									input_textcustom("total_ob_detil",$total_ob_detil," style='text-align:right;'  readonly
													onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber total'",
															"Total","text");								
								?>	
							</td>							
							<td colspan="2" class="text-sm text-label border-0">
							<?php
								input_text("ket_ob_detil",$ket_ob_detil,"maxlength='255' ","Keterangan","text");
							?>
							</td>
						  </tr>
						  <tr style="background-color: #800000;color: white;">
							<td colspan="2" rowspan="2" class="text-sm text-label text-center border-0" style="background-color: white;color: #800000;font-weight:bold;vertical-align:middle;">Konversi Satuan</td>
							<td colspan="2" class="text-sm text-label text-left border-0">Satuan Besar</td>                             
							<td colspan="2" class="text-sm text-label text-left border-0">Konversi</td>      						
							<td colspan="2" class="text-sm text-label text-left border-0">Satuan Kecil</td>
							<td colspan="3" class="text-sm text-label text-left border-0" style="background-color: white;color: #800000;font-weight:bold;vertical-align:middle;">&nbsp;</td>
						  </tr>		
						  <tr>

							<td colspan="2" class="text-sm text-label border-0">
							<?php
								input_pdselect2url("satuan_besar","satuan_besar","select_satuan form-control select2"," ","Satuan");
							?>							
							</td>                               
							<td colspan="2" class="text-sm text-label border-0">
							<?php 
								input_textcustom("konversi",$konversi," style='text-align:right;' required
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control konversi'",
													"Konversi","text");					
							?>								
							</td>      							
							<td colspan="2" class="text-sm text-label border-0">
							<?php
								input_pdselect2url("satuan_kecil","satuan_kecil","select_satuan form-control select2","","Satuan");
							?>							
							</td>  
							<td colspan="3" class="text-sm text-label text-left border-0">&nbsp;</td>
						  </tr>		
						</tbody>
						<tfoot>
						  <tr>
							<td colspan="12" class="text-sm text-label text-left border-0">
								<button type="submit" name="action" value="BtnTambah" class="btn btn-success pull-left">
									<i class="glyphicon glyphicon-plus"></i> Tambah
								</button>							
							</td>
						</tfoot>
						  </tr>	
						</table>
						<table class="table table-hover table-transaksi table-sm">
						<thead>
						  <tr style="background-color: #29675B;color: white;">
							<th class="text-sm text-label text-center border-0" style="width: 7%">Tanggal</th>
							<th class="text-sm text-label text-center border-0" style="width: 20%">Nama Barang</th>
							<th class="text-sm text-label text-center border-0">Merk</th>
							<th class="text-sm text-label text-right border-0" style="width: 5%">Qty</th>                                                                
							<th class="text-sm text-label text-right border-0">Harga</th>
							<th class="text-sm text-label text-right border-0" style="width: 10%">Diskon</th>
							<th class="text-sm text-label text-right border-0">Disc %</th>
							<th class="text-sm text-label text-right border-0" style="width: 13%">Jumlah</th>
							<th class="text-sm text-label text-center border-0" style="width: 10%">Keterangan</th>
							<th class="text-sm text-label text-center border-0"><i class="fa fa-trash"></i></th>
						  </tr>			
						</thead> 
						<tbody>
							<?php
							$subtotal = 0;
								foreach($ambil_temp_ob_detil as $rowambil_temp_ob_detil){
									$subtotal = $subtotal + $rowambil_temp_ob_detil['total_ob_detil'];
							?>
						<tr>						  
							<td class="text-sm text-label text-left border-0"><?php echo date('d-m-Y', strtotime($rowambil_temp_ob_detil['tgl_order_beli'])); ?></td>
							<td class="text-sm text-label text-left border-0"><?php echo $rowambil_temp_ob_detil['nama_barang']; ?></td>
							<td class="text-sm text-label text-left border-0"><?php echo $rowambil_temp_ob_detil['merk_ob_detil']; ?></td>
							<td class="text-sm text-label text-right border-0"><?php echo number_format($rowambil_temp_ob_detil['jml_ob_detil'],0); ?></td>                                                                
							<td class="text-sm text-label text-right border-0"><?php echo number_format($rowambil_temp_ob_detil['harga_ob_detil'],0); ?></td>
							<td class="text-sm text-label text-right border-0"><?php echo number_format($rowambil_temp_ob_detil['diskon_ob_detil'],0); ?></td>
							<td class="text-sm text-label text-right border-0"><?php echo $rowambil_temp_ob_detil['persen_ob_detil']; ?></td>
							<td class="text-sm text-label text-right border-0"><?php echo number_format($rowambil_temp_ob_detil['total_ob_detil'],0); ?></td>
							<td class="text-sm text-label text-left border-0"><?php echo $rowambil_temp_ob_detil['ket_ob_detil']; ?></td>
							<td class="text-sm text-label text-center border-0">
								<a href="<?php echo base_url('akunting/order_beli/hapus/'.$rowambil_temp_ob_detil['id_temp_ob_detil']);?>"  onclick="confirmation(event)" class="btn btn-danger btn-xs">
									<i class="fa fa-trash"></i>
								</a>	
							</td>
						</tr>	
							<?php
								}
							?>						  			
						  						  
							<tr>		
								<td colspan="5" style="vertical-align:middle;font-weight:bold;text-align:right;">
													
								</td>	
								<td style="vertical-align:middle;font-weight:bold;text-align:left;">
								<?php 	
									input_textcustom("diskon_order_beli",$diskon_order_beli," style='text-align:right;' required id='diskon_order_beli' 
													onkeyup='total()'
													onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber dob'",
															"Diskon","hidden");																
								?>										
								</td>	
								<td style="vertical-align:middle;font-weight:bold;text-align:right;">
									Sub Total
								</td>
								<td class="text-sm text-label border-0">
								<?php 			
									input_textcustom("subtotal_order_beli",number_format($subtotal)," style='text-align:right;' required readonly id='subtotal_order_beli'
													onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber'",
															"% Diskon","text");								
								?>							
								</td>		
								<td colspan="3" class="text-sm text-label border-0">	
								</td>									
							</tr>
							<tr>	
								<td colspan="5" style="vertical-align:middle;font-weight:bold;text-align:right;">
													
								</td>		
								<td style="vertical-align:middle;font-weight:bold;text-align:left;">
								<?php 			
									input_textcustom("persen_order_beli",$persen_order_beli," style='text-align:right;' required maxlength='3' id='persen_order_beli' 
													onkeyup='total()'
													onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control pob'",
															"% Diskon","hidden");								
								?>										
								</td>		
								<td style="vertical-align:middle;font-weight:bold;text-align:right;">
									PPN
								</td>
								<td class="text-sm text-label border-0">
								<?php 			
									input_textcustom("ppn_order_beli",$ppn_order_beli," style='text-align:right;' required readonly id='ppn_order_beli'
													onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber'",
															"% Diskon","text");								
								?>							
								</td>	
								<td colspan="3" class="text-sm text-label border-0">	
								</td>									
							</tr>
							<tr>
								<td colspan="7" style="vertical-align:middle;font-weight:bold;text-align:right;">
									Total
								</td>
								<td class="text-sm text-label border-0">
								<?php 			
									input_textcustom("total_order_beli",$total_order_beli," style='text-align:right;' required readonly id='total_order_beli'
													onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber'",
															"% Diskon","text");								
								?>							
								</td>	
								<td colspan="2" class="text-sm text-label border-0">	
								</td>								
							</tr>
						</tbody>
					  </table>
					</div>
					</div>
				</div>	
			  </div>
		  </div>
        </div>
        <div class="box-footer">
			<button type="submit" name="action" value="BtnSave" class="btn btn-primary pull-left">
				<i class="glyphicon glyphicon-save"></i> Simpan
			</button>
        </div>
		<?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="order_beli_edit")
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
		  <h3 class="box-title">CATATAN</h3>
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
            <div style="font-weight:bold;color:red;" class="box-body">
				<ul>
				<li>SESUDAH MENAMBAH BARANG HARAP LANGSUNG DISIMPAN, APABILA RELOGIN BARANG YANG BELUM DISIMPAN AKAN TERHAPUS</li>
				<li>JIKA MEMILIH DISKON, SALAH SATU ANTARA DISKON RUPIAH ATAU DISKON PERSEN (%) SAJA, APABILA KEDUANYA DIISI YANG DIHITUNG HANYA PERSEN (%)</li>
				<li>APABILA BARANG TIDAK MEMILIKI SATUAN KECIL MAKA ISI KONVERSI NOL (0) DAN SATUAN KECIL SAMA DENGAN SATUAN BESAR</li>
				</ul>
            </div>
            <!-- /.box-body -->
          </div>
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
		  <?php echo form_open_multipart('akunting/order_beli/edit/'.$date,' id="signupform" ');  
		input_text("id_order_beli",$id_order_beli,"","","hidden");
		input_text("status_order_beli",$status_order_beli,"","","hidden");
		  ?>
		<div class="box-body">     
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">TRANSAKSI</h3>
			</div>
			  <div class="box-body">
				<div class="row">
					<div class="col-md-7">
						<div class="col-md-4">
							<div class="form-group">
							  <label>Tanggal</label>
									<?php
										input_calendar("tgl_order_beli","tgl_order_beli",$tgl_order_beli,"Masukkan Tanggal","readonly required");
									?>	
							</div>					
						</div>
						<div class="col-md-4">
							<div class="form-group">
							  <label>No Order</label>
								<?php
									input_text("no_order_beli",$no_order_beli,"maxlength='25' required autofocus","Masukkan No","text");
								?>	
							</div>				
						</div>
						<div class="col-md-4">
							<div class="form-group">
							  <label>Unit</label>
								<?php
									input_pdselect2fleksibel("id_unit","id_unit",$cmd_unit,"id_unit","nama_unit",$id_unit,"Pilih Unit");
								?>	
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							  <label>Keterangan</label>
								<?php
									input_text("ket_order_beli",$ket_order_beli,"maxlength='255' ","Ketik Bila Ada Keterangan","text");
								?>	
							</div>				
						</div>
						<div class="col-md-3">
							<div class="form-group">
							  <label>Tunai / Termin</label>
								<?php
									input_pdselect2fleksibel("id_termin","id_termin",$cmd_termin,"id_termin","nama_termin",$id_termin,"Tunai");
								?>	
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
							  <label>Pajak</label>
									<?php
										input_pdselect2("pajak",$cmd_pajak,$pajak);
									?>	
							</div>					
						</div>
					</div>
					<div class="col-md-5">
						<div class="col-md-6">
							<div class="form-group">
							  <label>Kreditur / Debitur</label>
								<?php
									input_pdselect2fleksibel("id_dk","id_dk",$cmd_keu_dk,"id_dk","nama_dk",$id_dk,"Pilih Debitur / Kreditur");
								?>
							</div>		
						</div>
						<div class="col-md-6">
							<div class="form-group">
							  <label>Kontak Person</label>
								<?php
									input_text("kontak",$kontak,"maxlength='255' ","Kontak Person","text");
								?>	
							</div>		
						</div>	
						<div class="col-md-12">
							<div class="form-group">
							  <label>Alamat Kontak</label>
								<?php
									input_text("alamat",$alamat,"maxlength='255' ","Alamat Kontak Person","text");
								?>	
							</div>						
						</div>						
					</div>
				</div>	
			  </div>
		  </div>
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">
			  <?php if($status_order_beli == '0'){ ?>
						<button type="submit" name="action" value="BtnTambah" class="btn btn-success btn-xs">
							<i class="glyphicon glyphicon-plus"></i> Tambah
						</button>		
			  <?php } ?>
			  </h3>
			</div>
			  <div class="box-body">
				<div class="row">			
					<div class="table-responsive" tabindex="-1">
					<div class="col-md-12">
					  <table id="item_table" class="table table-hover table-transaksi table-sm">
						<thead class="bg-light">
						  <tr style="background-color: #800000;color: white;">
							<th colspan="2" class="text-sm text-label text-center border-0" style="width: 20%">Nama Barang</th>
							<th class="text-sm text-label text-center border-0" style="width: 15%">Merk</th>
							<th class="text-sm text-label text-center border-0" style="width: 7%">Qty</th>                                                                
							<th class="text-sm text-label text-center border-0" style="width: 10%">Harga</th>
							<th class="text-sm text-label text-center border-0" style="width: 10%">Diskon</th>
							<th class="text-sm text-label text-center border-0" style="width: 7%">Disc %</th>
							<th class="text-sm text-label text-center border-0" style="width: 10%">Jumlah</th>
							<th colspan="2" class="text-sm text-label text-center border-0" style="width: 16%">Keterangan</th>
						  </tr>
						</thead>
						<tbody>
						  <tr>
							<td colspan="2"  class="text-sm text-label border-0">
							<?php
							input_pdselect2url("id_barang","id_barang","select_barang form-control select2","","Pilih Barang");
							?>								
							</td>
							<td class="text-sm text-label border-0">
							<?php 
								input_text("merk_ob_detil",$merk_ob_detil,"maxlength='255' ","Merk","text");				
							?>							
							</td>
							<td class="text-sm text-label border-0">
							<?php 
								input_textcustom("jml_ob_detil",$jml_ob_detil," style='text-align:right;' 
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control jml'",
													"Jumlah","text");					
							?>								
							</td>                                 
							<td class="text-sm text-label border-0">
							<?php 
								input_textcustom("harga_ob_detil",$harga_ob_detil," style='text-align:right;'  
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber harga'",
													"Harga","text");					
							?>								
							</td>     
							<td class="text-sm text-label border-0">
							<?php 
								input_textcustom("diskon_ob_detil",$diskon_ob_detil," style='text-align:right;'  
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber diskon'",
													"Kurs Transaksi","text");					
							?>								
							</td> 			
							<td class="text-sm text-label border-0">
							<?php 
								input_textcustom("persen_ob_detil",$persen_ob_detil," style='text-align:right;'  
											maxlength='3' onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control persen'",
													"Persen","text");	
							?>								
							</td> 	
							<td class="text-sm text-label border-0">
								<?php 			
									input_textcustom("total_ob_detil",$total_ob_detil," style='text-align:right;'  readonly
													onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber total'",
															"Total","text");								
								?>	
							</td>							
							<td colspan="2" class="text-sm text-label border-0">
							<?php
								input_text("ket_ob_detil",$ket_ob_detil,"maxlength='255' ","Keterangan","text");
							?>
							</td>
						  </tr>
						  <tr style="background-color: #800000;color: white;">
							<td colspan="2" rowspan="2" class="text-sm text-label text-center border-0" style="background-color: white;color: #800000;font-weight:bold;vertical-align:middle;">Konversi Satuan</td>
							<td colspan="2" class="text-sm text-label text-left border-0">Satuan Besar</td>                             
							<td colspan="2" class="text-sm text-label text-left border-0">Konversi</td>      						
							<td colspan="2" class="text-sm text-label text-left border-0">Satuan Kecil</td>
							<td colspan="3" class="text-sm text-label text-left border-0" style="background-color: white;color: #800000;font-weight:bold;vertical-align:middle;">&nbsp;</td>
						  </tr>		
						  <tr>

							<td colspan="2" class="text-sm text-label border-0">
							<?php
								input_pdselect2url("satuan_besar","satuan_besar","select_satuan form-control select2"," ","Satuan");
							?>							
							</td>                               
							<td colspan="2" class="text-sm text-label border-0">
							<?php 
								input_textcustom("konversi",$konversi," style='text-align:right;' required
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control konversi'",
													"Konversi","text");					
							?>								
							</td>      							
							<td colspan="2" class="text-sm text-label border-0">
							<?php
								input_pdselect2url("satuan_kecil","satuan_kecil","select_satuan form-control select2","","Satuan");
							?>							
							</td>  
							<td colspan="3" class="text-sm text-label text-left border-0">&nbsp;</td>
						  </tr>		
						</tbody>
						<tfoot>
						  <tr>
							<td colspan="12" class="text-sm text-label text-left border-0">
							<?php if($status_order_beli == '0'){ ?>
								<button type="submit" name="action" value="BtnTambah" class="btn btn-success pull-left">
									<i class="glyphicon glyphicon-plus"></i> Tambah
								</button>	
							<?php } ?>
							</td>
						</tfoot>
						  </tr>	
						</table>
						<table class="table table-hover table-transaksi table-sm">
						<thead>
						  <tr style="background-color: #29675B;color: white;">
							<th class="text-sm text-label text-center border-0" style="width: 20%">Nama Barang</th>
							<th class="text-sm text-label text-center border-0">Merk</th>
							<th class="text-sm text-label text-right border-0" style="width: 5%">Qty</th>                                                                
							<th class="text-sm text-label text-right border-0">Harga</th>
							<th class="text-sm text-label text-right border-0" style="width: 10%">Diskon</th>
							<th class="text-sm text-label text-right border-0">Disc %</th>
							<th class="text-sm text-label text-right border-0" style="width: 13%">Jumlah</th>
							<th class="text-sm text-label text-center border-0" style="width: 10%">Keterangan</th>
							<th class="text-sm text-label text-center border-0"><i class="fa fa-trash"></i></th>
						  </tr>			
						</thead> 
						<tbody>
							<?php
							$subtotal = 0;
								foreach($ambil_keu_ob_detil as $rowambil_temp_ob_detil){
									$subtotal = $subtotal + $rowambil_temp_ob_detil['total_ob_detil'];
									if($rowambil_temp_ob_detil['status_ob_detil'] == 1){
										$back ='green';
										$color ='white';
									}else if($rowambil_temp_ob_detil['status_ob_detil'] == 2){
										$back ='red';
										$color ='white';
									}else{
										$back= 'white';
										$color= 'black';
									}
							?>
						<tr style="background-color: <?php echo $back; ?>;color: <?php echo $color; ?>;"  >						  
							<td class="text-sm text-label text-left border-0"><?php echo $rowambil_temp_ob_detil['nama_barang']; ?></td>
							<td class="text-sm text-label text-left border-0"><?php echo $rowambil_temp_ob_detil['merk_ob_detil']; ?></td>
							<td class="text-sm text-label text-right border-0"><?php echo number_format($rowambil_temp_ob_detil['jml_ob_detil'],0); ?></td>                                                                
							<td class="text-sm text-label text-right border-0"><?php echo number_format($rowambil_temp_ob_detil['harga_ob_detil'],0); ?></td>
							<td class="text-sm text-label text-right border-0"><?php echo number_format($rowambil_temp_ob_detil['diskon_ob_detil'],0); ?></td>
							<td class="text-sm text-label text-right border-0"><?php echo $rowambil_temp_ob_detil['persen_ob_detil']; ?></td>
							<td class="text-sm text-label text-right border-0"><?php echo number_format($rowambil_temp_ob_detil['total_ob_detil'],0); ?></td>
							<td class="text-sm text-label text-left border-0"><?php echo $rowambil_temp_ob_detil['ket_ob_detil']; ?></td>
							<td class="text-sm text-label text-center border-0">
							<?php
									if($rowambil_temp_ob_detil['status_ob_detil'] == 1){
										echo 'Diterima';
									}else if($rowambil_temp_ob_detil['status_ob_detil'] == 2){
										echo 'Ditolak';
									}else{ ?>
								<a href="<?php echo base_url('akunting/order_beli/hapus_ob_detil/'.$rowambil_temp_ob_detil['id_ob_detil'].'/'.$rowambil_temp_ob_detil['id_order_beli']);?>"  onclick="confirmation(event)" class="btn btn-danger btn-xs">
									<i class="fa fa-trash"></i>
								</a>
							<?php		}
							?>	
							</td>
						</tr>	
							<?php
								}
							?>						  			
						  						  
							<tr>		
								<td colspan="4" style="vertical-align:middle;font-weight:bold;text-align:right;">
													
								</td>	
								<td style="vertical-align:middle;font-weight:bold;text-align:left;">
								<?php 	
									input_textcustom("diskon_order_beli",$diskon_order_beli," style='text-align:right;' required id='diskon_order_beli' 
													onkeyup='total()'
													onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber dob'",
															"Diskon","hidden");																
								?>										
								</td>	
								<td style="vertical-align:middle;font-weight:bold;text-align:right;">
									Sub Total
								</td>
								<td class="text-sm text-label border-0">
								<?php 			
									input_textcustom("subtotal_order_beli",number_format($subtotal)," style='text-align:right;' required readonly id='subtotal_order_beli'
													onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber'",
															"% Diskon","text");								
								?>							
								</td>		
								<td colspan="3" class="text-sm text-label border-0">	
								</td>									
							</tr>
							<tr>	
								<td colspan="4" style="vertical-align:middle;font-weight:bold;text-align:right;">
														
								</td>		
								<td style="vertical-align:middle;font-weight:bold;text-align:left;">
								<?php 			
									input_textcustom("persen_order_beli",$persen_order_beli," style='text-align:right;' required maxlength='3' id='persen_order_beli' 
													onkeyup='total()'
													onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control pob'",
															"% Diskon","hidden");								
								?>										
								</td>		
								<td style="vertical-align:middle;font-weight:bold;text-align:right;">
									PPN
								</td>
								<td class="text-sm text-label border-0">
								<?php 			
									input_textcustom("ppn_order_beli",$ppn_order_beli," style='text-align:right;' required readonly id='ppn_order_beli'
													onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber'",
															"% Diskon","text");								
								?>							
								</td>	
								<td colspan="3" class="text-sm text-label border-0">	
								</td>									
							</tr>
							<tr>
								<td colspan="6" style="vertical-align:middle;font-weight:bold;text-align:right;">
									Total
								</td>
								<td class="text-sm text-label border-0">
								<?php 			
									input_textcustom("total_order_beli",$total_order_beli," style='text-align:right;' required readonly id='total_order_beli'
													onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber'",
															"% Diskon","text");								
								?>							
								</td>	
								<td colspan="2" class="text-sm text-label border-0">	
								</td>								
							</tr>
						</tbody>
					  </table>
					</div>
					</div>
				</div>	
			  </div>
		  </div>
        </div>
        <div class="box-footer">
<?php if($status_order_beli == '0'){ ?>
			<button type="submit" name="action" value="BtnSave" class="btn btn-primary pull-left">
				<i class="glyphicon glyphicon-save"></i> Simpan
			</button>
<?php } ?>
        </div>
		<?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
//================================== PROSES ORDER BELI ===============================
elseif ($page=="proses_order_beli")
{
?>
<style>
    @media (min-width: 768px) {
      .modal-xl {
        width: 90%;
       max-width:1200px;
      }
    }
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $instance_name; ?> <small></small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $header; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
		<div class="box-body">    
			<?php echo form_open_multipart('akunting/proses_order_beli/view/'.$first_date.'/'.$last_date,' id="signupform" '); ?>
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
			</div>
			  <div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
						  <label>Opsi Pencarian</label>
								<?php
									input_pdselect2("date",$dates,$date);
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
						  <th width="5%">ID</th>
						  <th width="10%">Tanggal</th>
						  <th width="10%">No</th>
						  <th>Unit</th>
						  <th>Debitur / Kreditur</th>
						  <th>Termin</th>
						  <th>Status</th>
						</tr>
					</thead>
				</table>
			</div>
			<div class="box-footer">

			</div>
		  </div>	
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
elseif ($page=="proses_order_beli_proses")
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
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
		  <?php echo form_open_multipart('akunting/proses_order_beli/proses/'.$date,' id="signupform" ');  
		input_text("id_order_beli",$id_order_beli,"","","hidden");
		input_text("status_order_beli",$status_order_beli,"","","hidden");
		  ?>
		<div class="box-body">    
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">Tanggal : <?php echo date('d-m-Y', strtotime($tgl_order_beli)); ?> &nbsp;
			  No Order : <?php echo $no_order_beli; ?></h3>
			</div>
			  <div class="box-body">
				<div class="row">
					<div class="col-md-7">
						<div class="col-md-4">
							<div class="form-group">
							  <label>Unit</label><br>
								<?php echo $nama_unit; ?>	
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
							  <label>Tunai / Termin</label><br>
								<?php echo $nama_termin; ?>	
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
							  <label>Pajak</label><br>
								<?php echo $pajak; ?>		
							</div>					
						</div>
						<div class="col-md-12">
							<div class="form-group">
							  <label>Keterangan</label><br>
							  <?php echo $ket_order_beli; ?>
							</div>				
						</div>						
					</div>					
					<div class="col-md-5">
						<div class="col-md-6">
							<div class="form-group">
							  <label>Kreditur / Debitur</label><br>
							  <?php echo $nama_dk; ?>
							</div>		
						</div>
						<div class="col-md-6">
							<div class="form-group">
							  <label>Kontak Person</label><br>
								<?php echo $kontak; ?>		
							</div>		
						</div>	
						<div class="col-md-12">
							<div class="form-group">
							  <label>Alamat Kontak</label><br>
								<?php echo $alamat; ?>	
							</div>						
						</div>						
					</div>
				</div>	
			  </div>
		  </div>		
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">
						<button type="submit" class="btn btn-success btn-xs">
							<i class="glyphicon glyphicon-save"></i> Simpan
						</button>		
			  </h3>
			</div>
			  <div class="box-body">			  
				<div class="row">			
					<div class="table-responsive" tabindex="-1">
					<div class="col-md-12">
						<table class="table table-hover table-transaksi table-sm">
						<thead>
						  <tr style="background-color: #29675B;color: white;">
							<th rowspan="2" style="vertical-align:middle;width: 20%;" class="text-sm text-label text-center border-0">Nama Barang</th>
							<th rowspan="2" style="vertical-align:middle;" class="text-sm text-label text-center border-0">Merk</th>
							<th style="vertical-align:middle;width: 5%;" class="text-sm text-label text-right border-0">Qty</th>                                                                
							<th style="vertical-align:middle;" rowspan="2" class="text-sm text-label text-right border-0">Harga</th>
							<th style="vertical-align:middle;width: 10%;" class="text-sm text-label text-right border-0">Diskon</th>
							<th style="vertical-align:middle;width: 13%;" rowspan="2" class="text-sm text-label text-right border-0">Jumlah</th>
							<th style="vertical-align:middle;width: 10%;" rowspan="2" class="text-sm text-label text-center border-0">Keterangan</th>
							<th style="vertical-align:middle;" rowspan="2" class="text-sm text-label text-center border-0">Terima</th>
							<th style="vertical-align:middle;" rowspan="2" class="text-sm text-label text-center border-0">Tolak</th>
						  </tr>	
						  <tr style="background-color: #29675B;color: white;">
							<th class="text-sm text-label text-right border-0" style="width: 10%">Satuan Besar / Kecil</th>                                                                
							<th class="text-sm text-label text-right border-0">Disc %</th>
						  </tr>		
						</thead> 
						<tbody>
							<?php
							$subtotal = 0;
								foreach($ambil_keu_ob_detil as $rowambil_temp_ob_detil){
									$subtotal = $subtotal + $rowambil_temp_ob_detil['total_ob_detil'];
							?>
						  <tr>
							<td rowspan="2" style="vertical-align:middle;" class="text-sm text-label text-center border-0">
								<?php echo $rowambil_temp_ob_detil['nama_barang']; ?>
							</td>
							<td rowspan="2" style="vertical-align:middle;" class="text-sm text-label text-center border-0">
								<?php echo $rowambil_temp_ob_detil['merk_ob_detil']; ?>
							</td>
							<td style="vertical-align:middle;" class="text-sm text-label text-right border-0">
								<?php echo number_format($rowambil_temp_ob_detil['jml_ob_detil'],0); ?>
							</td>                                                                
							<td style="vertical-align:middle;" rowspan="2" class="text-sm text-label text-right border-0">
								<?php echo number_format($rowambil_temp_ob_detil['harga_ob_detil'],0); ?>
							</td>
							<td style="vertical-align:middle;" class="text-sm text-label text-right border-0">
								<?php echo number_format($rowambil_temp_ob_detil['diskon_ob_detil'],0); ?>
							</td>
							<td style="vertical-align:middle;" rowspan="2" class="text-sm text-label text-right border-0">
								<?php echo number_format($rowambil_temp_ob_detil['total_ob_detil'],0); ?>
							</td>
							<td style="vertical-align:middle;" rowspan="2" class="text-sm text-label text-center border-0">
								<?php echo $rowambil_temp_ob_detil['ket_ob_detil']; ?>
							</td>
							<?php
								if($rowambil_temp_ob_detil['status_ob_detil'] == '0'){
							?>
							<td style="vertical-align:middle;" rowspan="2" class="text-sm text-label text-center border-0">
								<a href="<?php echo base_url('akunting/proses_order_beli/deal/'.$rowambil_temp_ob_detil['id_ob_detil'].'/'.$rowambil_temp_ob_detil['id_order_beli']);?>/1"  class="btn btn-success btn-xs">
									<i class="fa fa-check"></i>
								</a>							
							</td>
							<td style="vertical-align:middle;" rowspan="2" class="text-sm text-label text-center border-0">
								<a href="<?php echo base_url('akunting/proses_order_beli/deal/'.$rowambil_temp_ob_detil['id_ob_detil'].'/'.$rowambil_temp_ob_detil['id_order_beli']);?>/2"  class="btn btn-danger btn-xs">
									<i class="fa fa-close"></i>
								</a>							
							</td>
							<?php
								}else{
								if($rowambil_temp_ob_detil["status_ob_detil"] == 0){
									$sod = 'Proses';
								}elseif($rowambil_temp_ob_detil["status_ob_detil"] == 1){
									$sod = '<font color="green"><b>Diterima</b></color>';
								}else{
									$sod = '<font color="red"><b>Ditolak</b></color>';
								}									
							?>
							<td style="vertical-align:middle;" colspan="2" class="text-sm text-label text-center border-0">
								<a href="<?php echo base_url('akunting/proses_order_beli/deal/'.$rowambil_temp_ob_detil['id_ob_detil'].'/'.$rowambil_temp_ob_detil['id_order_beli']);?>/0"  class="btn btn-info btn-xs">
									<i class="fa fa-recycle"></i> Batalkan
								</a>							
							</td>							
							<?php
								}
							?>
						  </tr>	
						  <tr>
							<td class="text-sm text-label text-right border-0">
								<?php echo $rowambil_temp_ob_detil['satuan_besar']; ?> <b>=</b> <?php echo $rowambil_temp_ob_detil['konversi']; ?> <?php echo $rowambil_temp_ob_detil['satuan_kecil']; ?>
							</td>                                                                
							<td class="text-sm text-label text-right border-0">
								<?php echo $rowambil_temp_ob_detil['persen_ob_detil']; ?>
							</td>
							<?php
							if($rowambil_temp_ob_detil["status_ob_detil"] > 0){
								?>
							<td style="vertical-align:middle;" colspan="2" class="text-sm text-label text-center border-0">
								<?php echo $sod; ?>							
							</td>
							<?php
							}
							?>
						  </tr>		
							<?php
								}
							?>						  			
						  						  
							<tr>		
								<td colspan="3" style="vertical-align:middle;font-weight:bold;text-align:right;">
													
								</td>	
								<td style="vertical-align:middle;font-weight:bold;text-align:right;">
																
								</td>	
								<td style="vertical-align:middle;font-weight:bold;text-align:right;">
									Sub Total
								</td>
								<td style="vertical-align:middle;font-weight:bold;text-align:right;">
								<?php echo number_format($subtotal_order_beli,0); ?>						
								</td>		
								<td colspan="4" class="text-sm text-label border-0">	
								</td>									
							</tr>
							<tr>	
								<td colspan="3" style="vertical-align:middle;font-weight:bold;text-align:right;">
														
								</td>		
								<td style="vertical-align:middle;font-weight:bold;text-align:right;">
																	
								</td>		
								<td style="vertical-align:middle;font-weight:bold;text-align:right;">
									PPN
								</td>
								<td style="vertical-align:middle;font-weight:bold;text-align:right;">
								<?php echo number_format($ppn_order_beli,0); ?>						
								</td>	
								<td colspan="4" class="text-sm text-label border-0">	
								</td>									
							</tr>
							<tr>
								<td colspan="5" style="vertical-align:middle;font-weight:bold;text-align:right;">
									Total
								</td>
								<td style="vertical-align:middle;font-weight:bold;text-align:right;" >
								<?php echo number_format($total_order_beli,0); ?>							
								</td>	
								<td colspan="3" class="text-sm text-label border-0">	
								</td>								
							</tr>
						</tbody>
					  </table>
					</div>
					</div>
				</div>	
			  </div>
		  </div>
        </div>
        <div class="box-footer">
			<button type="submit" class="btn btn-primary pull-left">
				<i class="glyphicon glyphicon-save"></i> Simpan
			</button>
        </div>
		<?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}