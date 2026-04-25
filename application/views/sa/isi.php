<?php
//=================================== H O M E ================================================
$arraybox = array('warning','success','info','danger');
$resarray = array_rand($arraybox);
$thenarray = $arraybox[$resarray];	
$resarray2 = array_rand($arraybox);
$thenarray2 = $arraybox[$resarray2];	
$resarray3 = array_rand($arraybox);
$thenarray3 = $arraybox[$resarray3];
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
		<?php
      //    echo '<pre>'; print_r($this->session->all_userdata());
		?>
		<!--
            <div class="col-md-12">
              <div class="box box-?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                <div class="box-header with-border">
                   <h3 class="box-title">STATUS PENGAJUAN</h3>
                  <div class="box-tools pull-right"></div>
                </div>
                <div class="box-body">
                	<div class="col-md-12">
<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" style="height:500px;" src="?php echo base_url();?>assets/berkas/1.pdf" allowfullscreen></iframe>
</div>
									</div>
                	<div class="col-md-12">
<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" style="height:500px;" src="?php echo base_url();?>assets/berkas/1.pdf" allowfullscreen></iframe>
</div>
									</div>
                	<div class="col-md-12">
<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" style="height:500px;" src="?php echo base_url();?>assets/berkas/1.pdf" allowfullscreen></iframe>
</div>
									</div>
                </div>
              </div>
            </div>
          -->
        </div>
        <div class="box-footer">
          Footer
        </div>
      </div>
    </section>
</div>
<?php
}
//======================================================================================
elseif ($page=="clone_proses_logbook" || $page=="clone_proses_pasien" || $page=="clone_proses_lhu" || $page=="clone_proses_umum" || $page=="clone_proses_buku_putih")
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
      <?php
        input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th>abcd</th>
            <th>abcd</th>
            <th>abcd</th>
            <th>abcd</th>
            <th>abcd</th>
            <th>abcd</th>
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
elseif ($page=="import_csv_tambah")
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
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
		  <?php echo form_open_multipart('sa/import_csv/tambah',' id="signupform" ');  
		 
		  ?>
		<div class="box-body">     
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">IMPORT PASIEN FILE (CSV)</h3>
			</div>
			  <div class="box-body">
				<div class="row">
          <div class="col-md-6">
             <div class="form-group">
              <label for="exampleInputFile">CSV</label>
              <?php
                input_textcustom("upload_Files[]","","class='form-control-file' id='exampleInputFile' ","","file");
              ?>
              <p class="help-block">CSV</p>
            </div>                 
          </div>
          <div class="col-md-6">
          	<label>Tindakan / Pemeriksaan</label>
						<?php
							input_pdselect2("id_instansi",$instansi,$id_instansi);
						?>	
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
elseif ($page=="dk")
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
					  <th width="10%" style="display:none;"></th>
					  <th width="15%">Kode Rekening</th>
					  <th>Nama</th>
					  <th>Instansi</th>
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
elseif ($page=="dk_tambah")
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
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/dk/simpan_tambah');?>" onClick="return cek();">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
								<div class="col-md-6">
									  <label>Kode Rekening</label>
										<?php
											input_text("kode_rekening",$kode_rekening," maxlength='5' ","Masukkan Nama Kode Rekening","text");
										?>
								</div>
								<div class="col-md-6">
									  <label>Nama Komite</label>
										<?php
											input_text("nama_dk",$nama_dk,"maxlength='30' required","Masukkan Nama Kode Rekening","text");
										?>
								</div>
								<div class="col-md-6">
									  <label>Instansi</label>
										<?php
											input_pdselect2("id_instansi",$working,$id_instansi);
										?>
								</div>
								<div class="col-md-6">
									  <label>Status</label>
										<?php
											input_pdselect2("status_dk",$status,$status_dk);
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
<script type="text/javascript">
$(document).ready(function() {
	$('.select2').select2()
});
</script>
<?php
}
elseif ($page=="dk_edit")
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
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/dk/simpan_edit');?>" onClick="return cek();">
		<input type="hidden" name="id_dk" value="<?= $id_dk; ?>">
		<input type="hidden" name="kode_rekening_lama" value="<?= $kode_rekening; ?>">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
								<div class="col-md-6">
									  <label>Kode Rekening</label>
										<?php
											input_text("kode_rekening",$kode_rekening," maxlength='5' ","Masukkan Nama Kode Rekening","text");
										?>
								</div>
								<div class="col-md-6">
									  <label>Nama Komite</label>
										<?php
											input_text("nama_dk",$nama_dk,"maxlength='30' required","Masukkan Nama Kode Rekening","text");
										?>
								</div>
								<div class="col-md-6">
									  <label>Instansi</label>
										<?php
											input_pdselect2("id_instansi",$working,$id_instansi);
										?>
								</div>
								<div class="col-md-6">
									  <label>Status</label>
										<?php
											input_pdselect2("status_dk",$status,$status_dk);
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
<script type="text/javascript">
$(document).ready(function() {
	$('.select2').select2()
});
</script>
<?php
}
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
          </div>
        </div>
		<div class="box-body">    
			<?php echo form_open_multipart('sa/transaksi/view/'.$first_date.'/'.$last_date,' id="signupform" '); 
		if(empty($first_date)){
			$first_date = "01-".date('m-Y');
		}
		if(empty($last_date)){
			$last_date = date('d-m-Y');
		}
			?>
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title"><?php echo $title; ?></h3>
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
						  <th>Jurnal</th>
						  <th>Komite</th>
						  <th>User</th>
						  <th>Total</th>
						  <th>Keterangan</th>
						  <th>PDF</th>
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
elseif ($page=="transaksi_tambah")
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
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
		  <?php echo form_open_multipart('sa/transaksi/tambah',' id="signupform" ');  
		 
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
									input_calendar("tgl_transaksi","tgl_transaksi",$tgl_transaksi,"Masukkan Tanggal Transaksi"," required");
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
					<div class="col-md-2">
						<div class="form-group">
						  <label>Jenis Jurnal</label>
							<?php
								input_pdselect2("id_jenis_jurnal",$cmd_jenis_jurnal,$id_jenis_jurnal);
							?>	
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
						  <label>Keterangan</label>
							<?php
								input_text("ket_transaksi",$ket_transaksi,"maxlength='25' autofocus","Ketik Bila Ada Keterangan","text");
							?>	
						</div>				
					</div>
					<div class="col-md-4">
						<div class="form-group">
						  <label>Komite</label>
							<?php
								input_pdselect2fleksibel("id_dk","id_dk",$cmd_dk,"id_dk","nama_dk",$id_dk,"Tahunan user");
							?>	
						</div>
					</div>
					<div class="col-md-5">
						<div class="form-group">
						  <label>Pembayar</label>
							<?php
								input_pdselect2fleksibel("id_pegawai","id_pegawai",$cmd_pegawai,"id_pegawai","nama_pegawai",$id_pegawai,"Owner");
							?>
						</div>
					</div>
          <div class="col-md-3">
             <div class="form-group">
              <label for="exampleInputFile">Struk</label>
              <?php
                input_textcustom("upload_Files[]","","class='form-control-file' id='exampleInputFile' ","","file");
              ?>
              <p class="help-block">PDF</p>
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
elseif ($page=="transaksi_edit")
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
      </h1>    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
		  <?php echo form_open_multipart('sa/transaksi/edit/'.$first_date,' id="signupform" ');  
		 input_text("id_transaksi",$id_transaksi,"","","hidden");
		 input_text("kode_transaksi",$kode_transaksi,"","","hidden");
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
									input_calendar("tgl_transaksi","tgl_transaksi",$tgl_transaksi,"Masukkan Tanggal Transaksi"," required");
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
					<div class="col-md-2">
						<div class="form-group">
						  <label>Jenis Jurnal</label>
							<?php
								input_pdselect2("id_jenis_jurnal",$cmd_jenis_jurnal,$id_jenis_jurnal);
							?>	
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
						  <label>Keterangan</label>
							<?php
								input_text("ket_transaksi",$ket_transaksi,"maxlength='25' autofocus","Ketik Bila Ada Keterangan","text");
							?>	
						</div>				
					</div>
					<div class="col-md-4">
						<div class="form-group">
						  <label>Komite</label>
							<?php
								input_pdselect2fleksibel("id_dk","id_dk",$cmd_dk,"id_dk","nama_dk",$id_dk,"Tahunan user");
							?>	
						</div>
					</div>
					<div class="col-md-5">
						<div class="form-group">
						  <label>Pembayar</label>
							<?php
								input_pdselect2fleksibel("id_pegawai","id_pegawai",$cmd_pegawai,"id_pegawai","nama_pegawai",$id_pegawai,"Owner");
							?>
						</div>
					</div>
          <div class="col-md-3">
             <div class="form-group">
              <label for="exampleInputFile">Struk</label>
              <?php
                input_textcustom("upload_Files[]","","class='form-control-file' id='exampleInputFile' ","","file");
              ?>
              <p class="help-block">PDF</p>
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
							<th class="text-sm text-label text-center border-0" style="display: none;">ID</th>
							<th class="text-sm text-label text-center border-0" style="width: 25%">COA</th>
							<th class="text-sm text-label text-center border-0" style="width: 15%">Debit</th>
							<th class="text-sm text-label text-center border-0" style="width: 15%">Kredit</th>
							<th class="text-sm text-label text-center border-0" style="width: 20%">Catatan</th>
							<th class="text-sm text-label text-center border-0" style="width: 5%"></th>
						  </tr>
						</thead>
						<tbody>
							<?php 
							foreach($akeu_tr_detil as $rowakeu_tr_detil){
							?>
							  <tr>
							  <td style="display: none;"><?php input_text("id_transaksi_detil_edit[]",$rowakeu_tr_detil['id_transaksi_detil'],"","","hidden"); ?></td>
								<td class="text-sm text-label border-0">
								<?php //function input_pdselect2urlfleksibel($id_var,$nm_var,$class,$caption,$foreach,$id,$name,$selected,$text)
								input_pdselect2urlfleksibel("id_coa","id_coa_edit[]","select_coa form-control select2","required='required'",$cmd_keu_coa,"id_coa","nama_coa",$rowakeu_tr_detil['id_coa'],"Pilih Rekening");
								?>								
								</td>
								<td class="text-sm text-label border-0">
								<?php 
									input_textcustom("td_debet_edit[]",number_format($rowakeu_tr_detil['td_debet'],0)," style='text-align:right;' required 
												onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber debet'",
														"Nominal Transaksi","text");					
								?>							
								</td>
								<td class="text-sm text-label border-0">
								<?php 
									input_textcustom("td_kredit_edit[]",number_format($rowakeu_tr_detil['td_kredit'],0)," style='text-align:right;' required
												onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber kredit'",
														"Nominal Transaksi","text");					
								?>								
								</td>                                                              
								<td class="text-sm text-label border-0">
								<?php
									input_text("ket_transaksi_detil_edit[]",$rowakeu_tr_detil['ket_transaksi_detil'],"maxlength='255' ","Masukkan Keterangan","text");
								?>
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
elseif ($page=="transaksi_jurnal")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
      <div class="box box-<?php echo $thenarray; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">JURNAL</h3>
          <div class="box-tools pull-right"></div>
        </div>
        <div class="box-body">
<table id="example1" width="100%" class="table table-bordered table-striped">
<thead>
<tr>
  <th style="background-color: #800000;color: white;vertical-align:middle;text-align:center;">
  	<u>Tanggal - No Transaksi - Jenis Jurnal</u><br>COA</th>
  <th style="background-color: #800000;color: white;vertical-align:middle;text-align:center;width:15%;"><u>Komite</u><br>Debet</th>
  <th style="background-color: #800000;color: white;vertical-align:middle;text-align:center;width:15%;"><u>User</u><br>Kredit</th>
  <th style="background-color: #800000;color: white;vertical-align:middle;text-align:center;">Keterangan</th>
</tr>
</thead>
<tbody>
<?php
$total_kredit=0;$total_debet=0;
foreach($ambil_akeu_transaksi as $rowambil_akeu_transaksi){
?>
	<tr>
	  <td style="vertical-align:middle;text-align:left;font-weight: bold;">
	  	<?php echo $this->m_rancak->fullBulan(date('d-m-Y',strtotime($rowambil_akeu_transaksi['tgl_transaksi']))); ?><br>No Transaksi : <?php echo $rowambil_akeu_transaksi['no_transaksi']; ?><br>Jurnal : 	<?php echo $rowambil_akeu_transaksi['nama_jenis_jurnal']; ?>
	  	</td>
	  <td style="vertical-align:middle;text-align:center;font-weight: bold;">
	  	<?php
	  	if($rowambil_akeu_transaksi['id_dk'] == 0){
	  		echo 'Tahunan';
	  	}else{
	  		echo $rowambil_akeu_transaksi['nama_dk']; 	  		
	  	}
	  	?>
	  </td>
	  <td style="vertical-align:middle;text-align:center;font-weight: bold;">
	  	<?php
	  	if($rowambil_akeu_transaksi['id_pegawai'] == 0){
	  		echo 'Komite RS';
	  	}else{
	  		echo $rowambil_akeu_transaksi['nama_pegawai'];	  		
	  	} 
	  	?>
	  </td>
	  <td style="vertical-align:middle;text-align:center;font-weight: bold;"><?php echo $rowambil_akeu_transaksi['ket_transaksi']; ?></td>
	</tr>	
<?php
$totalkredit=0;$totaldebet=0;
$akeu_transaksi = $this->m_sa->ambil_akeu_transaksi_detil($rowambil_akeu_transaksi['kode_transaksi']);
foreach($akeu_transaksi as $rowakeu){
	$totalkredit = $totalkredit + $rowakeu['td_kredit'];
	$total_kredit = $total_kredit + $rowakeu['td_kredit'];
	$totaldebet = $totaldebet + $rowakeu['td_debet'];
	$total_debet = $total_debet + $rowakeu['td_debet'];
?>
	<tr>
	  <td style="vertical-align:middle;text-align:left;"><?php echo $rowakeu['nama_coa']; ?></td>
	  <td style="vertical-align:middle;text-align:right;"><?php echo number_format($rowakeu['td_debet'],2); ?></td>
	  <td style="vertical-align:middle;text-align:right;"><?php echo number_format($rowakeu['td_kredit'],2); ?></td>
	  <td style="vertical-align:middle;text-align:center;"><?php echo $rowakeu['ket_transaksi_detil']; ?></td>
	</tr>		
<?php
	}
?>
	<tr>
	  <td style="vertical-align:middle;text-align:right;font-weight:bold;">Jumlah</td>
	  <td style="vertical-align:middle;text-align:right;font-weight:bold;"><?php echo number_format($totaldebet,2); ?></td>
	  <td style="vertical-align:middle;text-align:right;font-weight:bold;"><?php echo number_format($totalkredit,2); ?></td>
	  <td style="vertical-align:middle;text-align:right;font-weight:bold;">&nbsp;</td>
	</tr>	
<?php
}
?>				 
	<tr>
	  <td style="vertical-align:middle;text-align:right;font-weight:bold;">Total</td>
	  <td style="vertical-align:middle;text-align:right;font-weight:bold;"><?php echo number_format($total_debet,2); ?></td>
	  <td style="vertical-align:middle;text-align:right;font-weight:bold;"><?php echo number_format($total_kredit,2); ?></td>
	  <td style="vertical-align:middle;text-align:right;font-weight:bold;">&nbsp;</td>
	</tr> 
</tbody>
</table>	
        </div>
      </div>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
		$('#example1').DataTable({
		  'paging'      : false,
		  'lengthChange': false,
		  'searching'   : true,
		  'ordering'    : false,
		  'info'        : true,
		  'scrollX'		: true ,
		  'scrollX'			: true,
		  'scrollY'			: '350px',
		  'scrollCollapse'	: true,
		})
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
});
</script>
<?php
}
elseif ($page=="transaksi_buku_besar")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
      <div class="box box-<?php echo $thenarray; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">BUKU BESAR</h3>
          <div class="box-tools pull-right"></div>
        </div>
        <div class="box-body">
			   <table id="example1" width="100%" class="table table-bordered table-striped">	
					<thead>
						<tr>
						  <th style="background-color: #800000;color: white;vertical-align:middle;text-align:center;width:10%;">Tanggal</th>
						  <th style="background-color: #800000;color: white;vertical-align:middle;text-align:center;width:10%;">Nomor</th>
						  <th style="background-color: #800000;color: white;vertical-align:middle;text-align:center;">Catatan</th>
						  <th style="background-color: #800000;color: white;vertical-align:middle;text-align:center;width:15%;">Debet</th>
						  <th style="background-color: #800000;color: white;vertical-align:middle;text-align:center;width:15%;">Kredit</th>
						  <th style="background-color: #800000;color: white;vertical-align:middle;text-align:center;width:15%;">Saldo</th>
					  </tr>
					</thead>	 
					  <tbody>			       	
			<?php					
				foreach($ambil_coa_periode as $rowambil_coa_periode){
					$ambil_sum_detil_periode = $this->m_sa->ambil_sum_detil_periode($rowambil_coa_periode['tgl_transaksi'],$rowambil_coa_periode['id_coa']);
				?>										
					<tr>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>
					  <td style="vertical-align:middle;text-align:left;font-weight:bold;">
					  	<?php echo $rowambil_coa_periode['nama_coa']; ?>
					  </td>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>
					</tr>															
								<?php	
									$ambil_detil_periode = $this->m_sa->ambil_detil_periode($first_date,$last_date,$rowambil_coa_periode['id_coa']);
									$saldo = $ambil_sum_detil_periode['total'];$saldoall = 0;$saldodebet = 0;$saldokredit = 0;
									foreach($ambil_detil_periode as $rowambil_detil_periode){
										$saldodebet = $saldodebet + $rowambil_detil_periode['td_debet'];
										$saldokredit = $saldokredit + $rowambil_detil_periode['td_kredit'];
											$saldod = $ambil_sum_detil_periode['debet'] + $saldodebet;
											$saldok = $ambil_sum_detil_periode['kredit'] + $saldokredit;
											$saldo = $saldodebet - $saldokredit;
											$saldoall = $saldod - $saldok;
											$saldoset = $ambil_sum_detil_periode['total'] + $saldoall;
								?>
							<tr>
							  <td style="vertical-align:middle;text-align:center;width:10%;"><?php echo date('d-m-Y',strtotime($rowambil_detil_periode['tgl_transaksi'])); ?></td>
							  <td style="vertical-align:middle;text-align:center;width:10%;"><?php echo $rowambil_detil_periode['no_transaksi']; ?></td>
							  <td style="vertical-align:middle;text-align:center;"><?php echo $rowambil_detil_periode['ket_transaksi_detil']; ?></td>
							  <td style="vertical-align:middle;text-align:right;width:15%;"><?php echo number_format($rowambil_detil_periode['td_debet'],2); ?></td>
							  <td style="vertical-align:middle;text-align:right;width:15%;"><?php echo number_format($rowambil_detil_periode['td_kredit'],2); ?></td>
							  <td style="vertical-align:middle;text-align:right;width:15%;"><?php echo number_format($saldo,2); ?></td>
							</tr>								
								<?php
									}
							?>
					<tr>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>						
					  <td style="vertical-align:middle;text-align:right;font-weight:bold;">
					 		Saldo Bulan Sebelumnya : <?php echo number_format($ambil_sum_detil_periode['total'],2); ?>
					  </td>
					  <td style="vertical-align:middle;text-align:right;width:15%;font-weight:bold;">
					  	<?php  echo number_format($saldod,2); ?>
					  </td>
					  <td style="vertical-align:middle;text-align:right;width:15%;font-weight:bold;">
					  	<?php  echo number_format($saldok,2); ?>					
					  </td>
					  <td style="vertical-align:middle;text-align:right;width:15%;font-weight:bold;">
					  	<?php echo number_format($saldoset,2); ?>
					  </td>
					</tr>
						<?php
				}
						?>
					  </tbody>
			<!--		  <tfoot>			
					  <td colspan="5" style="vertical-align:middle;text-align:left;font-weight:bold;">
					 Saldo Akhir
					  </td>
					  <td style="vertical-align:middle;text-align:right;width:15%;font-weight:bold;">?php echo number_format($saldoall,2); ?></td>			  
					  </tfoot>-->
						</table>
        </div>
      </div>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
		$('#example1').DataTable({
		  'paging'      : false,
		  'lengthChange': false,
		  'searching'   : true,
		  'ordering'    : false,
		  'info'        : true,
		  'scrollX'		: true ,
		  'scrollX'			: true,
		  'scrollY'			: '350px',
		  'scrollCollapse'	: true,
		})
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
});
</script>
<?php
}
elseif ($page=="transaksi_neraca")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
      <div class="box box-<?php echo $thenarray; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">NERACA</h3>
          <div class="box-tools pull-right"></div>
        </div>
        <div class="box-body">
			   <table id="example1" width="100%" class="table table-bordered table-striped">
				<thead>
					<tr>
					  <th style="background-color: #800000;color: white;vertical-align:middle;text-align:left;">Keterangan</th>
					  <th style="background-color: #800000;color: white;vertical-align:middle;text-align:right;">&nbsp;</th>
					  <th style="background-color: #800000;color: white;vertical-align:middle;text-align:right;width:15%;">Saldo</th>
				  </tr>
				</thead>
				  <tbody>											
						  <tr>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">AKTIVA</td>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
						  </tr>
					<?php	
						$tot_aktif = 0;
						foreach($ambil_aktiva as $rowambil_aktiva){
					?>						  
						  <tr>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;"><?php echo $rowambil_aktiva['nama_code']; ?></td>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
						  </tr>
					<?php
							$jumlah_aktif = 0;
							$ambil_transaksi_aktiva_periode = $this->m_sa->ambil_transaksi_aktiva_periode($first_date,$last_date,$rowambil_aktiva['id_code']);
							foreach($ambil_transaksi_aktiva_periode as $rowambil_transaksi_aktiva_periode){
								$tot_aktif = $tot_aktif + $rowambil_transaksi_aktiva_periode['selisih'];
								$jumlah_aktif = $jumlah_aktif + $rowambil_transaksi_aktiva_periode['selisih'];
					?>
						  <tr>
							<td style="vertical-align:middle;text-align:left;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:left;"><?php echo $rowambil_transaksi_aktiva_periode['nama_coa']; ?></td>
							<td style="vertical-align:middle;text-align:right;"><?php echo number_format($rowambil_transaksi_aktiva_periode['selisih'],2); ?></td>
						  </tr> 								
					<?php
							}
					?>
						  <tr>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">JUMLAH <?php echo $rowambil_aktiva['nama_code']; ?></td>
							<td style="vertical-align:middle;text-align:right;font-weight:bold;"><?php echo number_format($jumlah_aktif,2); ?></td>
						  </tr>	
						  <tr>
								<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
								<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
								<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
						  </tr>						  
					<?php
						}
					?>		
						  <tr>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">TOTAL AKTIVA</td>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:right;font-weight:bold;"><?php echo number_format($tot_aktif,2); ?></td>
						  </tr>					
						  <tr>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
						  </tr>
						  <tr>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">PASSIVA</td>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
						  </tr>
					<?php	
						$tot_pasif = 0;
						foreach($ambil_passiva as $rowambil_passiva){
					?>						  
						  <tr>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;"><?php echo $rowambil_passiva['nama_code']; ?></td>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
						  </tr>
					<?php
							$jumlah_pasif = 0;
							$ambil_transaksi_passiva_periode = $this->m_sa->ambil_transaksi_passiva_periode($first_date,$last_date,$rowambil_passiva['id_code']);
							foreach($ambil_transaksi_passiva_periode as $rowambil_transaksi_passiva_periode){
								$tot_pasif = $tot_pasif + $rowambil_transaksi_passiva_periode['selisih'];
								$jumlah_pasif = $jumlah_pasif + $rowambil_transaksi_passiva_periode['selisih'];
					?>
						  <tr>
							<td style="vertical-align:middle;text-align:left;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:left;"><?php echo $rowambil_transaksi_passiva_periode['nama_coa']; ?></td>
							<td style="vertical-align:middle;text-align:right;"><?php echo number_format($rowambil_transaksi_passiva_periode['selisih'],2); ?></td>
						  </tr> 
 								
					<?php
							}
					?>
						  <tr>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">JUMLAH <?php echo $rowambil_passiva['nama_code']; ?></td>
							<td style="vertical-align:middle;text-align:right;font-weight:bold;"><?php echo number_format($jumlah_pasif,2); ?></td>
						  </tr>			
						  <tr>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
						  </tr>						  
					<?php
						}
					?>	
						  <tr>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">TOTAL PASSIVA</td>
							<td style="vertical-align:middle;text-align:right;font-weight:bold;"><?php echo number_format($tot_pasif,2); ?></td>
						  </tr>
				  </tbody>
				</table>
        </div>
      </div>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
		$('#example1').DataTable({
		  'paging'      : false,
		  'lengthChange': false,
		  'searching'   : true,
		  'ordering'    : false,
		  'info'        : true,
		  'scrollX'		: true ,
		  'scrollX'			: true,
		  'scrollY'			: '350px',
		  'scrollCollapse'	: true,
		})
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
});
</script>
<?php
}
elseif ($page=="transaksi_rl")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
      <div class="box box-<?php echo $thenarray; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">RUGI LABA</h3>
          <div class="box-tools pull-right"></div>
        </div>
        <div class="box-body">
			   <table id="example1" width="100%" class="table table-bordered table-striped">
				<thead>
					<tr>
					  <th style="background-color: #800000;color: white;vertical-align:middle;text-align:left;">Keterangan</th>
					  <th style="background-color: #800000;color: white;vertical-align:middle;text-align:right;width:15%;">Jumlah</th>
					  <th style="background-color: #800000;color: white;vertical-align:middle;text-align:right;width:15%;">Total</th>
				  </tr>
				</thead>
				  <tbody>											
					<?php	
					$tot_biaya_lain = 0;
						foreach($ambil_pendapatan as $rowambil_pendapatan){
							$ambil_range_code_pendapatan = $this->m_sa->ambil_range_code($rowambil_pendapatan['id_code'],$first_date,$last_date);
					?>						  
						  <tr>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
						  </tr>
					<?php
							$tot_pendapatan = 0;
							foreach($ambil_range_code_pendapatan as $rowambil_range_code_pendapatan){
								$tot_pendapatan = $tot_pendapatan + $rowambil_range_code_pendapatan['selisih'];
					?>
						  <tr>
							<td style="vertical-align:middle;text-align:right;"><?php echo $rowambil_range_code_pendapatan['nama_coa']; ?></td>
							<td style="vertical-align:middle;text-align:left;">
								D : <?= $count_pendapatan_debet ?> - K : <?= $count_pendapatan_kredit ?> = <?= $count_pendapatan ?>
							</td>
							<td style="vertical-align:middle;text-align:right;"><?php echo number_format($rowambil_range_code_pendapatan['selisih'],2); ?></td> 
						 </tr> 								
					<?php
							}			
					?>
						  <tr>
							<td style="vertical-align:middle;text-align:right;font-weight:bold;">JUMLAH <?php echo $rowambil_pendapatan['nama_code']; ?></td>
							<td style="vertical-align:middle;text-align:left;">
								D : <?= $count_pendapatan_debet ?> - K : <?= $count_pendapatan_kredit ?> = <?= $count_pendapatan ?>
							</td>
							<td style="vertical-align:middle;text-align:right;font-weight:bold;"><?php echo number_format($tot_pendapatan,2); ?></td>
						  </tr>			
						  <tr>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
						  </tr>							
					<?php
						}							
						foreach($ambil_hpp as $rowambil_hpp){
							$ambil_range_code_hpp = $this->m_sa->ambil_range_code($rowambil_hpp['id_code'],$first_date,$last_date);
					?>						  
						  <tr>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
						  </tr>
					<?php
						$tot_hpp = 0;
							foreach($ambil_range_code_hpp as $rowambil_range_code_hpp){
								$tot_hpp = $tot_hpp + $rowambil_range_code_hpp['selisih'];
					?>
						  <tr>
							<td style="vertical-align:middle;text-align:right;"><?php echo $rowambil_range_code_hpp['nama_coa']; ?></td>
							<td style="vertical-align:middle;text-align:left;">
								D : <?= $count_hpp_debet ?> - K : <?= $count_hpp_kredit ?> = <?= $count_hpp ?>
							</td>
							<td style="vertical-align:middle;text-align:right;"><?php echo number_format($rowambil_range_code_hpp['selisih'],2); ?></td>
						  </tr> 								
					<?php
							}		
					?>
						  <tr>
							<td style="vertical-align:middle;text-align:right;font-weight:bold;">JUMLAH <?php echo $rowambil_hpp['nama_code']; ?></td>
							<td style="vertical-align:middle;text-align:left;">
								D : <?= $count_hpp_debet ?> - K : <?= $count_hpp_kredit ?> = <?= $count_hpp ?>
							</td>
							<td style="vertical-align:middle;text-align:right;font-weight:bold;"><?php echo number_format($tot_hpp,2); ?></td>
						  </tr>			
						  <tr>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
						  </tr>						
					<?php
						}
						$rugi_laba_kotor = $tot_pendapatan-$tot_hpp;
					?>
						  <tr>
							<td style="vertical-align:middle;text-align:right;font-weight:bold;">LABA / RUGI KOTOR</td>
							<td style="vertical-align:middle;text-align:left;">
								Pendapatan : <?= $count_pendapatan ?> - HPP : <?= $count_hpp ?> = <?= $count_pendapatan - $count_hpp ?>
							</td>
							<td style="vertical-align:middle;text-align:right;font-weight:bold;"><?php echo number_format($rugi_laba_kotor,2); ?></td>
						  </tr>			
						  <tr>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
						  </tr>	
					<?php
						foreach($ambil_biaya as $rowambil_biaya){
							$ambil_range_code_biaya = $this->m_sa->ambil_range_code($rowambil_biaya['id_code'],$first_date,$last_date);
					?>						  
						  <tr>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
						  </tr>
					<?php
						$tot_biaya = 0;
							foreach($ambil_range_code_biaya as $rowambil_range_code_biaya){
								$tot_biaya = $tot_biaya + $rowambil_range_code_biaya['selisih'];
					?>
						  <tr>
							<td style="vertical-align:middle;text-align:right;"><?php echo $rowambil_range_code_biaya['nama_coa']; ?></td>
							<td style="vertical-align:middle;text-align:left;">
								D : <?= $count_biaya_debet ?> - K : <?= $count_biaya_kredit ?> = <?= $count_biaya ?>
							</td>
							<td style="vertical-align:middle;text-align:right;"><?php echo number_format($rowambil_range_code_biaya['selisih'],2); ?></td>
						  </tr> 								
					<?php
							}		
					?>
						  <tr>
							<td style="vertical-align:middle;text-align:right;font-weight:bold;">JUMLAH <?php echo $rowambil_biaya['nama_code']; ?></td>
							<td style="vertical-align:middle;text-align:left;">
								D : <?= $count_biaya_debet ?> - K : <?= $count_biaya_kredit ?> = <?= $count_biaya ?>
							</td>
							<td style="vertical-align:middle;text-align:right;font-weight:bold;"><?php echo number_format($tot_biaya,2); ?></td>
						  </tr>			
						  <tr>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
						  </tr>						
					<?php
						}
						$rugi_laba_operasional = $rugi_laba_kotor - $tot_biaya;
					?>
						  <tr>
							<td style="vertical-align:middle;text-align:right;font-weight:bold;">LABA / RUGI BERSIH OPERASIONAL</td>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">
								<?= $count_pendapatan - $count_hpp ?> - <?= $count_biaya ?> = <?= $count_pendapatan - $count_hpp - $count_biaya ?>
							</td>
							<td style="vertical-align:middle;text-align:right;font-weight:bold;"><?php echo number_format($rugi_laba_operasional,2); ?></td>
						  </tr>			
						  <tr>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
						  </tr>						
					<?php
						foreach($ambil_pendapatan_lain as $rowambil_pendapatan_lain){
							$ambil_range_code_pendapatan_lain = $this->m_sa->ambil_range_code($rowambil_pendapatan_lain['id_code'],$first_date,$last_date);
					?>						  
						  <tr>
							<td style="vertical-align:middle;text-align:right;font-weight:bold;"><?php echo $rowambil_pendapatan_lain['nama_code']; ?></td>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
						  </tr>
					<?php
						$tot_pendapatan_lain = 0;
							foreach($ambil_pendapatan_lain as $rowambil_range_code_pendapatan_lain){
								$tot_pendapatan_lain = $tot_pendapatan_lain + $rowambil_range_code_pendapatan_lain['selisih'];
					?>
						  <tr>
							<td style="vertical-align:middle;text-align:right;"><?php echo $rowambil_range_code_pendapatan_lain['nama_coa']; ?></td>
							<td style="vertical-align:middle;text-align:left;">
								D : <?= $count_pendapatan_lain_debet ?> - K : <?= $count_pendapatan_lain_kredit ?> = <?= $count_pendapatan_lain ?>
							</td>
							<td style="vertical-align:middle;text-align:right;"><?php echo number_format($rowambil_range_code_pendapatan_lain['selisih'],2); ?></td>
						  </tr> 								
					<?php
							}		
					?>
						  <tr>
						<td style="vertical-align:middle;text-align:right;font-weight:bold;">JUMLAH <?php echo $rowambil_pendapatan_lain['nama_code']; ?></td>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:right;font-weight:bold;"><?php echo number_format($tot_pendapatan_lain,2); ?></td>
						  </tr>						
					<?php
						}
						$rlo_p_lain = $rugi_laba_operasional + $tot_pendapatan_lain;
						foreach($ambil_biaya_lainnya as $rowambil_biaya_lainnya){
							$ambil_range_code_biaya_lain = $this->m_sa->ambil_range_code($rowambil_biaya_lainnya['id_code'],$first_date,$last_date);
					?>						  
						  <tr>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
						  </tr>
					<?php
						$tot_biaya_lain = 0;
							foreach($ambil_biaya_lainnya as $rowambil_range_code_biaya_lain){
								$tot_biaya_lain = $tot_biaya_lain + $rowambil_range_code_biaya_lain['selisih'];
					?>
						  <tr>
							<td style="vertical-align:middle;text-align:right;"><?php echo $rowambil_range_code_biaya_lain['nama_coa']; ?></td>
							<td style="vertical-align:middle;text-align:left;">
								D : <?= $count_baiaya_lainnya_debet ?> - K : <?= $count_baiaya_lainnya_kredit ?> = <?= $count_baiaya_lainnya ?>
							</td>
							<td style="vertical-align:middle;text-align:right;"><?php echo number_format($rowambil_range_code_biaya_lain['selisih'],2); ?></td>
						  </tr> 								
					<?php
							}		
					?>
						  <tr>
							<td style="vertical-align:middle;text-align:right;font-weight:bold;">JUMLAH <?php echo $rowambil_biaya_lainnya['nama_code']; ?></td>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:right;font-weight:bold;"><?php echo number_format($tot_biaya_lain,2); ?></td>
						  </tr>			
						  <tr>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
						  </tr>						
					<?php
						}
						$laba_sebelum_pajak = $rlo_p_lain - $tot_biaya_lain;
					?>
						  <tr>
							<td style="vertical-align:middle;text-align:right;font-weight:bold;">LABA / RUGI SEBELUM PAJAK</td>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">
								<?= $count_pendapatan - $count_hpp ?> - <?= $count_biaya ?> = <?= $count_pendapatan - $count_hpp - $count_biaya ?> + <?= $count_pendapatan_lain ?> - <?= $count_baiaya_lainnya ?>
							</td>
							<td style="vertical-align:middle;text-align:right;font-weight:bold;"><?php echo number_format($laba_sebelum_pajak,2); ?></td>
						  </tr>			
						  <tr>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
						  </tr>	
				  </tbody>
				</table>
        </div>
      </div>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
		$('#example1').DataTable({
		  'paging'      : false,
		  'lengthChange': false,
		  'searching'   : true,
		  'ordering'    : false,
		  'info'        : true,
		  'scrollX'		: true ,
		  'scrollX'			: true,
		  'scrollY'			: '350px',
		  'scrollCollapse'	: true,
		})
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
});
</script>
<?php
}
elseif ($page=="cl_pmr")
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
					  <th>Pasien</th>
					  <th>Kewenangan</th>
					  <th>JML</th>
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
elseif ($page=="skewenangan")
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
					  <th width="35%">Kewenangan</th>
					  <th>Kode</th>
					  <th width="35%">Kompetensi</th>
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
elseif ($page=="whatsnew")
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
					  <th>Isi</th>
					</tr>
				</thead>
			</table>
        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="whatsnew_edit")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
    <?php echo $header; ?> <small><?php echo $instance_name; ?></small>
      </h1>
    </section>
    <section class="content">
      <div class="row">
    <?php echo form_open_multipart('sa/whatsnew/edit/'.$id,' '); 
    input_text("id_whatsnew",$id,"","","hidden"); ?> 
        <div class="col-md-12">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>
          <div class="box-tools pull-right"></div>
        </div>
        <div class="box-body">
                <div class="form-group">
                  <label>Intro Selamat Datang</label>
          <?php
            input_textareacustom("isi_whatsnew",$isi_whatsnew," id='editor1' rows='10' cols='100' class='form-control' ","Masukkan Intro");
          ?>  
                </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>   
    </div>  
    <?php echo form_close(); ?>
    </div>
    </section>
</div>
<?php
}
//================================== INSTANSI ===============================
elseif ($page=="instansi")
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
					  <th>Alamat</th>
					  <th>Email</th>
					  <th>Kontak</th>
					  <th>Pembayaran</th>
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
elseif ($page=="instansi_logo")
{
if(empty($logo)){
	$standar_ft=base_url().'assets/images/noavatar.jpg';			
}else{
	$cek_filesmall=FCPATH.'assets/foto/'.$logo;
	if(file_exists($cek_filesmall)){
		$standar_ft=base_url().'assets/foto/'.$logo;
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
      <h1>
		<?php echo $instance_name; ?>
      </h1>
    </section>
    <section class="content">
	<?php echo form_open_multipart('sa/instansi/logo/'.$id,' class="form-horizontal" id="signupform" '); 
	input_text("id_instansi",$id,"","","hidden");
	?>	
      <div class="box box-<?php echo $thenarray; ?> box-solid">
        <div class="box-header with-border">
          <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>	
        <div class="box-body">
        <div class="row">
			<div class="col-md-4">
			</div>
			<div class="col-md-4">
				<div class="box-body box-profile">
					<a class="example-image-link" href="<?php echo $standar_ft; ?>" 
						data-lightbox="example-set" data-title="Sample Ukuran Gambar">
						<img class="img-responsive" src="<?php echo $standar_ft; ?>" style="width:300px" alt="Photo">
					</a>
					
				</div><hr>
				<div class="col-md-12">
					<div class="form-group">
					  <label for="exampleInputFile">Foto</label>
						<?php
							input_textcustom("upload_Files[]","","class='form-control-file' id='exampleInputFile' required ","","file");
						?>	
					  <p class="help-block">gif, png, jpg, jpeg Ukuran 80 x 80 pixel</p>
					</div>
                </div>
			</div>
			<div class="col-md-4">

			</div>					
        </div>
        </div>
        </div>
		<div class="box-footer">
			<button type="submit" class="btn btn-primary">Submit</button>
		</div>	
      </div>
	  <?php echo form_close(); ?>
    </section>
<?php
}
elseif ($page=="instansi_edit")
{
?>
      <div class="row">
        <div class="col-md-12">
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/instansi/simpan_edit');?>" onClick="return cek();">
		<input type="hidden" name="id_instansi" value="<?= $id; ?>">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
				<div class="col-md-12">
					<div class="form-group">
					  <label>Nama Instansi</label>
						<?php
							input_text("nama_instansi",$nama_instansi,"maxlength='255' required","Masukkan Nama Instansi","text");
						?>
					</div>					
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label>Alamat Instansi</label>
						<?php
							input_text("alamat_instansi",$alamat_instansi,"maxlength='255' ","Masukkan Alamat Instansi","text");
						?>
					</div>					
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label>Email Instansi</label>
						<?php
							input_text("email_instansi",$email_instansi,"maxlength='255' ","Masukkan Email Instansi","text");
						?>
					</div>					
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label>Kontak Instansi</label>
						<?php
							input_text("kontak_instansi",$kontak_instansi,"maxlength='255' ","Masukkan Kontak Instansi","text");
						?>
					</div>					
				</div>
				<div class="col-md-6">
					<div class="form-group">
					  <label>Deskripsi Web</label>
						<?php
							input_text("description",$description,"maxlength='255' ","Masukkan Deskripsi","text");
						?>
					</div>					
				</div>
				<div class="col-md-1">
				</div>
				<div class="col-md-5">
					<div class="form-group">
					  <label>Keyword Web</label>
						<?php
							input_text("keywords",$keywords,"maxlength='255' ","Masukkan Keyword","text");
						?>
					</div>					
				</div>
				<div class="col-md-5">
					<div class="form-group">
					  <label>Header Max 15</label>
						<?php
							input_text("header",$header,"maxlength='15' ","Masukkan Header Max 15 Huruf","text");
						?>
					</div>					
				</div>
				<div class="col-md-1">
				</div>				
				<div class="col-md-6">
					<div class="form-group">
					  <label>Header Collapse 3 Huruf</label>
						<?php
							input_text("header_mini",$header_mini,"maxlength='3' ","Masukkan Header Collapse 3 Huruf","text");
						?>
					</div>					
				</div>
				<div class="col-md-3">
					<div class="form-group">
					  <label>Licensed Web</label>
						<?php
							input_text("licensed",$licensed,"maxlength='255' ","Masukkan Licensed","text");
						?>
					</div>					
				</div>
				<div class="col-md-1">
				</div>				
				<div class="col-md-8">
					<div class="form-group">
					  <label>Footer Web</label>
						<?php
							input_text("footer",$footer,"maxlength='255' ","Masukkan Footer","text");
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
elseif ($page=="instansi_edit_wa")
{
?>
      <div class="row">
        <div class="col-md-12">
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/instansi/simpan_edit_wa');?>" onClick="return cek();">
		<input type="hidden" name="id_instansi" value="<?= $id; ?>">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
				<div class="col-md-12">
					<div class="form-group">
					  <label>Url</label>
						<?php
							input_text("url_api",$url_api,"maxlength='255' required","Masukkan Url","text");
						?>
					</div>					
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label>API</label>
						<?php
							input_text("api",$api,"maxlength='255' ","Masukkan API","text");
						?>
					</div>					
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label>User API</label>
						<?php
							input_text("user_api",$user_api,"maxlength='255' ","Masukkan Username API","text");
						?>
					</div>					
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label>No Sender</label>
						<?php
							input_textcustom("sender",$sender," 
										onkeypress='return event.keyCode > 47 && event.keyCode < 58' class='form-control'",
												"Masukkan Angka","text");
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
elseif ($page=="instansi_edit_email")
{
?>
      <div class="row">
        <div class="col-md-12">
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/instansi/simpan_edit_email');?>" onClick="return cek();">
		<input type="hidden" name="id_instansi" value="<?= $id; ?>">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
				<div class="col-md-12">
					<div class="form-group">
					  <label>Server</label>
						<?php
							input_text("server",$server,"maxlength='255' required","Masukkan Server","text");
						?>
					</div>					
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label>Username</label>
						<?php
							input_text("user",$user,"maxlength='255' ","Masukkan Username","text");
						?>
					</div>					
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label>Password</label>
						<?php
							input_text("pass",$pass,"maxlength='255' ","Masukkan Password","text");
						?>
					</div>					
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label>Port</label>
						<?php
							input_textcustom("port",$port," maxlength='7'
										onkeypress='return event.keyCode > 47 && event.keyCode < 58' class='form-control'",
												"Masukkan Angka","text");
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
elseif ($page=="komunitas")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
      <?php
    //    input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th style="display:none;"></th>
            <th style="width: 15%;">Cabang</th>
            <th style="width: 15%;">Kota</th>
            <th style="width: 15%;">Ranting</th>           
            <th>Alamat</th>
            <th>Status</th>
            <th>Kop</th>
            <th>Stempel</th>
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
elseif ($page=="komunitas_tambah")
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
      <?php echo form_open_multipart('sa/komunitas/tambah',' id="signupform" ');
   //     input_text("barcode_registrasi",$id,"","","hidden");
      ?>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-2">
              <div class="form-group">
                <label>Upload Kop Surat</label>
                <?php
                  input_textcustom("upload_Files[]","","class='form-control-file' id='exampleInputFile' ","","file");
                ?>
                <p class="help-block">gif, png, jpg, jpeg</p>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Jabatan Profesi</label>
                <?php
                  input_pdselect2("id_jabatan",$cmd_jabatan,$id_jabatan);
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Cabang Kepengurusan</label>
                <?php
                  input_pdselect2fleksibel("id_cabang","id_cabang",$ambil_data_pengcab,"id_dpk","nama_dpk",$id_cabang,"PARENT");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Propinsi Kepengurusan</label>
                <?php
                  input_pdselect2fleksibel("id_prov","id_prov",$kol_provinsi,"id_prov","nama_prov",$id_prov,"Pilih Provinsi Dulu");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Kota/Kabupaten</label>
                <?php
                  input_pdselect2("id_kab",$kab,$id_kab);
                //  echo form_dropdown('id_kab',$kab,'0',array('id'=>'id_kab','class'=>'form-control'));
                ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Nama</label>
                <?php
                  input_text("nama_dpk",$nama_dpk,"maxlength='255' required autofocus ","Ketikkan Nama","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Email</label>
                <?php
                  input_text("email_dpk",$email_dpk,"maxlength='255' ","Ketikkan Email","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Telepon / Fax</label>
                <?php
                  input_text("kontak_dpk",$kontak_dpk,"maxlength='255' ","Ketikkan No Telepon","text");
                ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Alamat</label>
                <?php
                  input_text("alamat_dpk",$alamat_dpk,"maxlength='255' ","Ketikkan Alamat","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Status</label>
                <?php
                  input_pdselect2("status_dpk",$status,$status_dpk);
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
elseif ($page=="komunitas_edit")
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

          </div>
        </div>
      <?php echo form_open_multipart('sa/komunitas/edit/'.$id,' id="signupform" ');
        input_text("id_dpk",$id_dpk,"","","hidden");
      ?>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-2">
              <div class="form-group">
                <label>Upload Kop Surat</label>
                <?php
                  input_textcustom("upload_Files[]","","class='form-control-file' id='exampleInputFile' ","","file");
                ?>
                <p class="help-block">gif, png, jpg, jpeg</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Cabang Kepengurusan</label>
                <?php
                  input_pdselect2fleksibel("id_cabang","id_cabang",$ambil_data_pengcab,"id_dpk","nama_dpk",$id_cabang,"PARENT");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Propinsi Kepengurusan</label>
                <?php
                  input_pdselect2fleksibel("id_prov","id_prov",$kol_provinsi,"id_prov","nama_prov",$id_prov,"Pilih Provinsi Dulu");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Kota/Kabupaten</label>
                <?php
                  input_pdselect2("id_kab",$kab,$id_kab);
                //  echo form_dropdown('id_kab',$kab,'0',array('id'=>'id_kab','class'=>'form-control'));
                ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Nama</label>
                <?php
                  input_text("nama_dpk",$nama_dpk,"maxlength='255' required autofocus ","Ketikkan Nama","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Email</label>
                <?php
                  input_text("email_dpk",$email_dpk,"maxlength='255' ","Ketikkan Email","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Telepon / Fax</label>
                <?php
                  input_text("kontak_dpk",$kontak_dpk,"maxlength='255' ","Ketikkan No Telepon","text");
                ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Alamat</label>
                <?php
                  input_text("alamat_dpk",$alamat_dpk,"maxlength='255' ","Ketikkan Alamat","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Status</label>
                <?php
                  input_pdselect2("status_dpk",$status,$status_dpk);
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
elseif ($page=="komunitas_stempel")
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
          </div>
        </div>
      <?php echo form_open_multipart('sa/komunitas/stempel/'.$id,' id="signupform" ');
        input_text("id_dpk",$id_dpk,"","","hidden");
      ?>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-2">
              <div class="form-group">
                <label>Upload Stempel Surat</label>
                <?php
                  input_textcustom("upload_Files[]","","class='form-control-file' id='exampleInputFile' ","","file");
                ?>
                <p class="help-block">gif, png, jpg, jpeg</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Cabang Kepengurusan</label>
                <?php
                  input_pdselect2fleksibel("id_cabang","id_cabang",$ambil_data_pengcab,"id_dpk","nama_dpk",$id_cabang,"PARENT");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Propinsi Kepengurusan</label>
                <?php
                  input_pdselect2fleksibel("id_prov","id_prov",$kol_provinsi,"id_prov","nama_prov",$id_prov,"Pilih Provinsi Dulu");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Kota/Kabupaten</label>
                <?php
                  input_pdselect2("id_kab",$kab,$id_kab);
                //  echo form_dropdown('id_kab',$kab,'0',array('id'=>'id_kab','class'=>'form-control'));
                ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Nama</label>
                <?php
                  input_text("nama_dpk",$nama_dpk,"maxlength='255' required autofocus ","Ketikkan Nama","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Email</label>
                <?php
                  input_text("email_dpk",$email_dpk,"maxlength='255' ","Ketikkan Email","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Telepon / Fax</label>
                <?php
                  input_text("kontak_dpk",$kontak_dpk,"maxlength='255' ","Ketikkan No Telepon","text");
                ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Alamat</label>
                <?php
                  input_text("alamat_dpk",$alamat_dpk,"maxlength='255' ","Ketikkan Alamat","text");
                ?>
              </div>
            </div>
           <div class="col-md-3">
              <div class="form-group">
                <label>Status</label>
                <?php
                  input_pdselect2("status_dpk",$status,$status_dpk);
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
elseif ($page=="pcare")
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
					  <th>Instansi</th>
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
elseif ($page=="pcare_tambah")
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
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/pcare/simpan_tambah');?>" onClick="return cek();">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">		  
				<div class="col-md-6">
					  <label>cons_id</label>
						<?php
							input_text("cons_id",$cons_id," ","Masukkan cons_id","text");
						?>						
				</div>		
				<div class="col-md-6">
					  <label>secret_key</label>
						<?php
							input_text("secret_key",$secret_key," ","Masukkan secret_key","text");
						?>						
				</div>
				<div class="col-md-6">
					  <label>base_url</label>
						<?php
							input_text("base_url",$base_url," ","Masukkan base_url","text");
						?>						
				</div>
				<div class="col-md-6">
					  <label>service_name</label>
						<?php
							input_text("service_name",$service_name," ","Masukkan service_name","text");
						?>				
				</div>
				<div class="col-md-6">
					  <label>pcare_user</label>
						<?php
							input_text("pcare_user",$pcare_user," ","Masukkan pcare_user","text");
						?>					
				</div>
				<div class="col-md-6">
					  <label>pcare_pass</label>
						<?php
							input_text("pcare_pass",$pcare_pass," ","Masukkan pcare_pass","text");
						?>				
				</div>
				<div class="col-md-6">
					  <label>user_key</label>
						<?php
							input_text("user_key",$user_key," ","Masukkan user_key","text");
						?>						
				</div>
				<div class="col-md-6">
					  <label>kd_aplikasi</label>
						<?php
							input_text("kd_aplikasi",$kd_aplikasi," ","Masukkan kd_aplikasi","text");
						?>							
				</div>
					<div class="col-md-6">
						  <label>Status Online</label>
							<?php
								input_pdselect2("status_pcare",$cmd_status,$status_pcare);
							?>
					</div>		
				<div class="col-md-6">
					  <label>Instansi</label>
					    <?php
              input_pdselect2fleksibel("id_instansi","id_instansi",$cmd_kategori_working,"id_working","nama_working",$id_instansi,"Tidak Ada");
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
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="pcare_edit")
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
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/pcare/simpan_edit');?>" onClick="return cek();">
		<input type="hidden" name="id_pcare" value="<?= $id_pcare; ?>">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
				<div class="col-md-6">
					  <label>cons_id</label>
						<?php
							input_text("cons_id",$cons_id," ","Masukkan cons_id","text");
						?>						
				</div>		
				<div class="col-md-6">
					  <label>secret_key</label>
						<?php
							input_text("secret_key",$secret_key," ","Masukkan secret_key","text");
						?>						
				</div>
				<div class="col-md-6">
					  <label>base_url</label>
						<?php
							input_text("base_url",$base_url," ","Masukkan base_url","text");
						?>						
				</div>
				<div class="col-md-6">
					  <label>service_name</label>
						<?php
							input_text("service_name",$service_name," ","Masukkan service_name","text");
						?>				
				</div>
				<div class="col-md-6">
					  <label>pcare_user</label>
						<?php
							input_text("pcare_user",$pcare_user," ","Masukkan pcare_user","text");
						?>					
				</div>
				<div class="col-md-6">
					  <label>pcare_pass</label>
						<?php
							input_text("pcare_pass",$pcare_pass," ","Masukkan pcare_pass","text");
						?>				
				</div>
				<div class="col-md-6">
					  <label>user_key</label>
						<?php
							input_text("user_key",$user_key," ","Masukkan user_key","text");
						?>						
				</div>
				<div class="col-md-6">
					  <label>kd_aplikasi</label>
						<?php
							input_text("kd_aplikasi",$kd_aplikasi," ","Masukkan kd_aplikasi","text");
						?>							
				</div>
					<div class="col-md-6">
						  <label>Status Online</label>
							<?php
								input_pdselect2("status_pcare",$cmd_status,$status_pcare);
							?>
					</div>		
				<div class="col-md-6">
					  <label>Instansi</label>
					    <?php
              input_pdselect2fleksibel("id_instansi","id_instansi",$cmd_kategori_working,"id_working","nama_working",$id_instansi,"Tidak Ada");
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
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="program")
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
					  <th>Program</th>
					  <th>Jabatan</th>
					  <th>Jabatan Fungsional</th>
					  <th>Struktur Jabatan</th>
					  <th>Unit</th>
					  <th>Ruangan</th>
					  <th>Akses</th>
					  <th>User Level</th>
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
elseif ($page=="program_tambah")
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
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/program/simpan_tambah');?>" onClick="return cek();">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">		  
				<div class="col-md-12">
					<div class="form-group">
					  <label>Nama</label>
						<?php
							input_text("nama_program",$nama_program,"maxlength='255' required","Masukkan Nama","text");
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
elseif ($page=="program_edit")
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
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/program/simpan_edit');?>" onClick="return cek();">
		<input type="hidden" name="id_program" value="<?= $id; ?>">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
				<div class="col-md-12">
					<div class="form-group">
					  <label>Nama</label>
						<?php
							input_text("nama_program",$nama_program,"maxlength='255' required","Masukkan Nama","text");
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
elseif ($page=="program_isi")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
.dataTableLayout {
    table-layout:fixed;
    width:100%;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/program/simpan_isi');?>" onClick="return cek();">
		<input type="hidden" name="id_program" value="<?= $id; ?>">
		<input type="hidden" name="table" value="<?= $table; ?>">
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
			</div>
			  <div class="box-body">
					  <table id="example1" width="100%" class="table table-bordered table-striped">
						  <thead>
							<tr>
								<th style="background-color:#9b0e27;color:white;vertical-align:middle;">
									<input name="select_all" class="checkall" type="checkbox" />
								</th>
								<th style="background-color:#9b0e27;color:white;vertical-align:middle;">ID</th>
								<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Nama</th>
							</tr>
						  </thead>
						  <tbody>
								<?php
								foreach($kirik as $row){						
								?>
							<tr>
								<td style="vertical-align:middle;">
								  <div class="checkbox">
									<label>
									  <input type="checkbox" class="child" name="chk[]" value="<?php echo $row[$id_field];?>" 
										<?php if(in_array($row[$id_field],explode(",", $isine))) echo 'checked="checked"'; ?> >
									</label>
								  </div>				
								</td>
								<td style="vertical-align:middle;"><?php echo $row[$id_field];?></td>
								<td style="vertical-align:middle;"><?php echo $row[$nama_field];?></td>
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
<script type="text/javascript">
$(function(){
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
	  'scrollX'		: true ,
	  'scrollX'			: true,
	  'scrollY'			: '500px',
	  'scrollCollapse'	: true,
    })
});
</script>
<?php
}
elseif ($page=="ol_lakon")
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
					  <th width="5%">IDU</th>
					  <th>Nama</th>
					  <th>username</th>					  
					  <th>level</th>
					  <th>Kerja</th>
					  <th>Unit</th>
					  <th>St User</th>
					  <th>St Pegawai</th>
					  <th>Visible</th>
					  <th>Br Level</th>
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
elseif ($page=="ol_lakon_unit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/ol_lakon/simpan_unit');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            <input type="hidden" name="id_pegawai" value="<?= $intstatus; ?>">
            <input type="hidden" name="barcode_pegawai" value="<?= $barcode_pegawai; ?>">
            <input type="hidden" name="id_unit_lama" value="<?= $id_unit; ?>">
          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
            <label>Pilih Unit</label>
              <?php
                input_pdselect2("id_unit",$unit,$id_unit);
              ?>
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
elseif ($page=="ol_lakon_rubah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/ol_lakon/simpan_rubah');?>" onClick="return cek();">
       <input type="hidden" name="id_user" value="<?= $id_user; ?>">
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
                  <label>Instansi</label>
                    <?php
              input_pdselect2fleksibel("id_working","id_working",$ambil_sn_working,"id_working","nama_working",$id_working,"Tidak Ada");
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
</script>
<?php
}
elseif ($page=="ol_lakon_ms_kredensial")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
.dataTableLayout {
    table-layout:fixed;
    width:100%;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/ol_lakon/simpan_ms_kredensial');?>" onClick="return cek();">
		<input type="hidden" name="id_user" value="<?= $id_user; ?>">
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
			</div>
			  <div class="box-body">
					  <table id="example1" width="100%" class="table table-bordered table-striped">
						  <thead>
							<tr>
								<th style="background-color:#9b0e27;color:white;vertical-align:middle;">
									<input name="select_all" class="checkall" type="checkbox" />
								</th>
								<th style="background-color:#9b0e27;color:white;vertical-align:middle;">ID</th>
								<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Nama</th>
							</tr>
						  </thead>
						  <tbody>
								<?php
								foreach($cmd_jabatan as $row){						
								?>
							<tr>
								<td style="vertical-align:middle;">
								  <div class="checkbox">
									<label>
									  <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_jabatan'];?>" 
										<?php if(in_array($row['id_jabatan'],explode(",", $mas_kred))) echo 'checked="checked"'; ?> >
									</label>
								  </div>				
								</td>
								<td style="vertical-align:middle;"><?php echo $row['id_jabatan'];?></td>
								<td style="vertical-align:middle;"><?php echo $row['nama_jabatan'];?></td>
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
<script type="text/javascript">
$(function(){
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
	  'scrollX'		: true ,
	  'scrollX'			: true,
	  'scrollY'			: '500px',
	  'scrollCollapse'	: true,
    })
});
</script>
<?php
}
elseif ($page=="ol_lakon_ms_asesor")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
.dataTableLayout {
    table-layout:fixed;
    width:100%;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/ol_lakon/simpan_ms_asesor');?>" onClick="return cek();">
		<input type="hidden" name="id_user" value="<?= $id_user; ?>">
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
			</div>
			  <div class="box-body">
					  <table id="example1" width="100%" class="table table-bordered table-striped">
						  <thead>
							<tr>
								<th style="background-color:#9b0e27;color:white;vertical-align:middle;">
									<input name="select_all" class="checkall" type="checkbox" />
								</th>
								<th style="background-color:#9b0e27;color:white;vertical-align:middle;">ID</th>
								<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Nama</th>
							</tr>
						  </thead>
						  <tbody>
								<?php
								foreach($cmd_jabatan as $row){						
								?>
							<tr>
								<td style="vertical-align:middle;">
								  <div class="checkbox">
									<label>
									  <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_jabatan'];?>" 
										<?php if(in_array($row['id_jabatan'],explode(",", $mas_asesor))) echo 'checked="checked"'; ?> >
									</label>
								  </div>				
								</td>
								<td style="vertical-align:middle;"><?php echo $row['id_jabatan'];?></td>
								<td style="vertical-align:middle;"><?php echo $row['nama_jabatan'];?></td>
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
<script type="text/javascript">
$(function(){
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
	  'scrollX'		: true ,
	  'scrollX'			: true,
	  'scrollY'			: '500px',
	  'scrollCollapse'	: true,
    })
});
</script>
<?php
}
elseif ($page=="ol_lakon_ms_unit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
.dataTableLayout {
    table-layout:fixed;
    width:100%;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/ol_lakon/simpan_ms_unit');?>" onClick="return cek();">
    <input type="hidden" name="id_user" value="<?= $id_user; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
      </div>
        <div class="box-body">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">ID</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Nama</th>
              </tr>
              </thead>
              <tbody>
                <?php
                foreach($cmd_jabatan as $row){            
                ?>
              <tr>
                <td style="vertical-align:middle;">
                  <div class="checkbox">
                  <label>
                    <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['coun_unit'];?>" 
                    <?php if(in_array($row['coun_unit'],explode(",", $mas_unit))) echo 'checked="checked"'; ?> >
                  </label>
                  </div>        
                </td>
                <td style="vertical-align:middle;"><?php echo $row['coun_unit'];?></td>
                <td style="vertical-align:middle;"><?php echo $row['nama_unit'];?></td>
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
<script type="text/javascript">
$(function(){
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
    'scrollX'   : true ,
    'scrollX'     : true,
    'scrollY'     : '500px',
    'scrollCollapse'  : true,
    })
});
</script>
<?php
}
elseif ($page=="ol_lakon_ms_instansi")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
.dataTableLayout {
    table-layout:fixed;
    width:100%;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/ol_lakon/simpan_ms_instansi');?>" onClick="return cek();">
		<input type="hidden" name="id_user" value="<?= $id_user; ?>">
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
			</div>
			  <div class="box-body">
					  <table id="example1" width="100%" class="table table-bordered table-striped">
						  <thead>
							<tr>
								<th style="background-color:#9b0e27;color:white;vertical-align:middle;">
									<input name="select_all" class="checkall" type="checkbox" />
								</th>
								<th style="background-color:#9b0e27;color:white;vertical-align:middle;">ID</th>
								<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Nama</th>
							</tr>
						  </thead>
						  <tbody>
								<?php
								foreach($cmd_instansi as $row){						
								?>
							<tr>
								<td style="vertical-align:middle;">
								  <div class="checkbox">
									<label>
									  <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_working'];?>" 
										<?php if(in_array($row['id_working'],explode(",", $mas_ins))) echo 'checked="checked"'; ?> >
									</label>
								  </div>				
								</td>
								<td style="vertical-align:middle;"><?php echo $row['id_working'];?></td>
								<td style="vertical-align:middle;"><?php echo $row['nama_working'];?></td>
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
<script type="text/javascript">
$(function(){
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
	  'scrollX'		: true ,
	  'scrollX'			: true,
	  'scrollY'			: '500px',
	  'scrollCollapse'	: true,
    })
});
</script>
<?php
}
elseif ($page=="ol_lakon_udnit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/ol_lakon/simpan_unit');?>" onClick="return cek();">
       <input type="hidden" name="id_user" value="<?= $id_user; ?>">
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
                  <label>Unit</label>
                    <?php
              input_pdselect2fleksibel("id_unit","id_unit",$ambil_data_dropdown_unit,"id_unit","nama_unit",$id_unit,"Tidak Ada");
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
</script>
<?php
}
elseif ($page=="ol_akses")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
						<div class="col-md-12">
				      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
				        <div class="box-header with-border">
				           <h3 class="box-title">HAK AKSES LAINNYA</h3>

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
									  <th>Nama</th>
									  <th>Akses</th>
									  <th>Status</th>
									</tr>
								</thead>
							</table>
				        </div>
				        <div class="box-footer">

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
elseif ($page=="ol_akses_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/ol_akses/simpan_tambah');?>" onClick="return cek();">
       <input type="hidden" name="id_pegawai" value="<?= $id; ?>">
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
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th><input name="select_all" class="checkall" type="checkbox" /></th>
                  <th>ID</th>
                  <th>Hak Akses</th>
                </tr>
              <?php
              foreach($hak_akses as $row){
              ?>
                <tr>
                  <td>
									  <div class="checkbox">
										<label>
										  <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_akses'];?>">
										</label>
									  </div>
                  </td>
                  <td><?= $row['id_akses'] ?></td>
                  <td><?= $row['nama_akses'] ?></td>
                </tr>
              <?php
              }
              ?>
              </table>
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
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
});
</script>
<?php
}
elseif ($page=="lakon")
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
			<?php
				input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
			?>
          </div>
        </div>
        <div class="box-body">
			<table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
				<thead>
					<tr>
					  <th width="5%">US</th>
					  <th width="5%">PEG</th>
					  <th>Username</th>
					  <th>Level</th>
					  <th>Status User</th>
					  <th>Nama</th>
					  <th>Status Pegawai</th>
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
elseif ($page=="akses")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
						<div class="col-md-12">
				      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
				        <div class="box-header with-border">
				           <h3 class="box-title">HAK AKSES LAINNYA</h3>

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
									  <th>Nama</th>
									  <th>Akses</th>
									  <th>Status</th>
									</tr>
								</thead>
							</table>
				        </div>
				        <div class="box-footer">

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
elseif ($page=="akses_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/akses/simpan_tambah');?>" onClick="return cek();">
       <input type="hidden" name="id_pegawai" value="<?= $id; ?>">
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
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th><input name="select_all" class="checkall" type="checkbox" /></th>
                  <th>ID</th>
                  <th>Hak Akses</th>
                </tr>
              <?php
              foreach($hak_akses as $row){
              ?>
                <tr>
                  <td>
									  <div class="checkbox">
										<label>
										  <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_akses'];?>">
										</label>
									  </div>
                  </td>
                  <td><?= $row['id_akses'] ?></td>
                  <td><?= $row['nama_akses'] ?></td>
                </tr>
              <?php
              }
              ?>
              </table>
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
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
});
</script>
<?php
}
elseif ($page=="a_online")
{
?>
  <div class="content-wrapper">
    <section class="content-header">

    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>
          <div class="box-tools pull-right"></div>
        </div>
   			<div class="box-body">
      		<div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			      <div class="box-header with-border">
			        <h3 class="box-title"></h3>
			      </div>
	        	<div class="box-body">
							<table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
								<thead>
									<tr>
									  <th style="display:none;"></th>
									  <th>Kode</th>
									  <th>Nama</th>
									  <th>Status OL</th>
									  <th>Menu</th>
									  <th>Peg Pengurus</th>
									  <th>Kunci</th>
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
elseif ($page=="a_online_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/a_online/simpan_tambah');?>" onClick="return cek();">
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
					<div class="col-md-4">
						  <label>Halaman</label>
							<?php
								input_text("kode_online",$kode_online,"maxlength='255' ","Ketik","text");
							?>				
					</div>
					<div class="col-md-4">
						  <label>Nama Menu</label>
							<?php
								input_text("nama_menu",$nama_menu,"maxlength='255' ","Ketik","text");
							?>				
					</div>
					<div class="col-md-4">
						  <label>Status Online</label>
							<?php
								input_pdselect2("status_online",$cmd_status,$status_online);
							?>
					</div>
					<div class="col-md-4">
						  <label>Menu</label>
							<?php
								input_pdselect2("menu",$cmd_status,$menu);
							?>
					</div>
					<div class="col-md-4">
						  <label>Kunci</label>
							<?php
								input_pdselect2("kunci",$cmd_status,$kunci);
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
</script>
<?php
}
elseif ($page=="a_online_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/a_online/simpan_edit');?>" onClick="return cek();">
       <input type="hidden" name="id_kode_online" value="<?= $id; ?>">
       <input type="hidden" name="kode_online_lama" value="<?= $kode_online; ?>">
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
					<div class="col-md-4">
						  <label>Halaman</label>
							<?php
								input_text("kode_online",$kode_online,"maxlength='255' ","Ketik","text");
							?>				
					</div>
					<div class="col-md-4">
						  <label>Nama Menu</label>
							<?php
								input_text("nama_menu",$nama_menu,"maxlength='255' ","Ketik","text");
							?>				
					</div>
					<div class="col-md-4">
						  <label>Status Online</label>
							<?php
								input_pdselect2("status_online",$cmd_status,$status_online);
							?>
					</div>
					<div class="col-md-4">
						  <label>Menu</label>
							<?php
								input_pdselect2("menu",$cmd_status,$menu);
							?>
					</div>
					<div class="col-md-4">
						  <label>Kunci</label>
							<?php
								input_pdselect2("kunci",$cmd_status,$kunci);
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
</script>
<?php
}
elseif ($page=="enabled")
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
    <div class="box-body">
        <div class="row">
          <div class="col-md-12">
				      <?php echo form_open_multipart('sa/enabled/view/'.$id_kode_online.'/'.$id_jabatan.'/'.$id_instansi.'/'.$id,' id="signupform" ');
				     //   input_text("id_pengcab",$id_pengcab,"","","hidden");
				     //   input_text("id_kode_online",$id_kode_online,"","","hidden");
				      ?>          	
						  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
							<div class="box-header with-border">
							  <h3 class="box-title">MULTIPLE SEARCH</h3>
							</div>
							  <div class="box-body">
									<div class="col-md-6">
										<div class="form-group">
										  <label> Cari Nama / NIP / No Profesi</label>
												<?php
													input_text("id",$id," autofocus","Ketik multiple pisahkan dengan spasi atau -","text");
												?>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
										  <label>Halaman</label>
												<?php
													input_pdselect2fleksibel("id_kode_online","id_kode_online",$ambil_data_a_online_null,"id_kode_online","kode_online",$id_kode_online,"Semua");
												?>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
										  <label>Instansi</label>
												<?php
													input_pdselect2fleksibel("id_instansi","id_instansi",$ambil_instansi,"id_working","nama_working",$id_instansi,"Semua");
												?>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
										  <label>Jabatan</label>
												<?php
													input_pdselect2fleksibel("id_jabatan","id_jabatan",$cmd_jabatan_null,"id_jabatan","nama_jabatan",$id_jabatan,"Semua");
												?>
										</div>
									</div>
							  </div>
								<div class="box-footer">
								  <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
								</div>
						  </div>
					    <?php echo form_close(); ?>
          </div>
          <div class="col-md-12">
							<table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
								<thead>
									<tr>
									  <th></th>
									  <th>Kode</th>
									  <th>Nama</th>
									  <th>No Profesi</th>
									  <th>NIP</th>
									  <th>Jabatan</th>
									  <th>Instansi</th>
									  <th>Menu</th>
									  <th>Enabled</th>
									  <th>Status</th>
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
elseif ($page=="pengurus_enabled")
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
      <?php echo form_open_multipart('sa/pengurus_enabled/view/'.$id_kode_online.'/'.$id_pengcab.'/'.$id_ms_pengurus,' id="signupform" ');
    //    input_text("id_pengcab",$id_pengcab,"","","hidden");
      ?>
    <div class="box-body">
        <div class="row">
          <div class="col-md-12">
						  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
							<div class="box-header with-border">
							  <h3 class="box-title">MULTIPLE SEARCH</h3>
							</div>
							  <div class="box-body">
									<div class="col-md-4">
										<div class="form-group">
										  <label>Halaman</label>
												<?php
													input_pdselect2("id_kode_online",$ambil_data_a_online_no_null,$id_kode_online);
												?>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
										  <label>Pengurus</label>
												<?php
													input_pdselect2fleksibel("id_pengcab","id_pengcab",$ambil_pengcab,"id_pengcab","nama_pengcab",$id_pengcab,"Semua");
												?>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
										  <label>Struktur Pengurus</label>
												<?php
													input_pdselect2fleksibel("id_ms_pengurus","id_ms_pengurus",$ambil_ms_pengurus,"id_ms_pengurus","nama_ms_pengurus",$id_ms_pengurus,"Semua");
												?>
										</div>
									</div>
							  </div>
								<div class="box-footer">
								  <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
								</div>
						  </div>
          </div>
          <div class="col-md-12">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="width:5%;background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width:10%;">ID</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Nama</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Struktur Pengurus</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Pengurus</th>
              </tr>
              </thead>
              <tbody>
                <?php
                foreach($ambil_pengurus as $row){
                ?>
              <tr>
                <td style="vertical-align:middle;text-align: center;">
                  <div class="checkbox">
                  <label>
                    <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_pegawai'];?>">
                  </label>
                  </div>
                </td>
                <td style="vertical-align:middle;"><?php echo $row['id_pegawai']; ?></td>
                <td style="vertical-align:middle;"><?php echo $row['nama_pegawai']; ?></td>
                <td style="vertical-align:middle;"><?php echo $row['nama_ms_pengurus']; ?></td>
                <td style="vertical-align:middle;"><?php echo $row['nama_pengcab']; ?></td>
              </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
      </div>
        </div>
        <div class="box-footer">
          <button type="submit" name="action" value="BtnSimpan" class="btn btn-success pull-left"><i class="fa fa-save"></i> Simpan</button>
        </div>
    <?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="instansi_enabled")
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
      <?php echo form_open_multipart('sa/instansi_enabled/view/'.$id_kode_online.'/'.$id_instansi.'/'.$id_jabatan,' id="signupform" ');
    //    input_text("id_pengcab",$id_pengcab,"","","hidden");
      ?>
    <div class="box-body">
        <div class="row">
          <div class="col-md-12">
						  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
							<div class="box-header with-border">
							  <h3 class="box-title">MULTIPLE SEARCH</h3>
							</div>
							  <div class="box-body">
									<div class="col-md-4">
										<div class="form-group">
										  <label>Halaman</label>
												<?php
													input_pdselect2("id_kode_online",$ambil_data_a_online_no_null,$id_kode_online);
												?>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
										  <label>Instansi</label>
												<?php
													input_pdselect2fleksibel("id_instansi","id_instansi",$ambil_instansi,"id_working","nama_working",$id_instansi,"Semua");
												?>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
										  <label>Jabatan</label>
												<?php
													input_pdselect2fleksibel("id_jabatan","id_jabatan",$cmd_jabatan_null,"id_jabatan","nama_jabatan",$id_jabatan,"Semua");
												?>
										</div>
									</div>
							  </div>
								<div class="box-footer">
								  <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
								</div>
						  </div>
          </div>
          <div class="col-md-12">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="width:5%;background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width:10%;">ID</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Nama</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Instansi</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Jabatan</th>
              </tr>
              </thead>
              <tbody>
                <?php
                foreach($ambil_pengurus as $row){
                ?>
              <tr>
                <td style="vertical-align:middle;text-align: center;">
                  <div class="checkbox">
                  <label>
                    <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_pegawai'];?>">
                  </label>
                  </div>
                </td>
                <td style="vertical-align:middle;"><?php echo $row['id_pegawai']; ?></td>
                <td style="vertical-align:middle;"><?php echo $row['nama_pegawai']; ?></td>
                <td style="vertical-align:middle;"><?php echo $row['nama_working']; ?></td>
                <td style="vertical-align:middle;"><?php echo $row['nama_jabatan']; ?></td>
              </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
      </div>
        </div>
        <div class="box-footer">
          <button type="submit" name="action" value="BtnSimpan" class="btn btn-success pull-left"><i class="fa fa-save"></i> Simpan</button>
        </div>
    <?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="enabled_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/enabled/simpan_edit');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            <input type="hidden" name="id_ol_enabled" value="<?= $id_kode_online; ?>">
            <input type="hidden" name="id_kode_online_lama" value="<?= $id_kode_onlines; ?>">
            <input type="hidden" name="id_pegawai" value="<?= $id_pegawai; ?>">
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
						<div class="col-md-4">
							  <label>Halaman</label>
									<?php
										input_pdselect2("id_kode_online",$ambil_data_a_online_no_null,$id_kode_onlines);
									?>
						</div>      
            <div class="col-md-4">
                <label>Enabled</label>
                <?php
                  input_pdselect2("enabled",$cmd_status,$enabled);
                ?>
            </div>       
              <div class="col-md-4">
                  <label>Status</label>
                  <?php
                  input_pdselect2("status_ol_enabled",$cmd_status,$status_ol_enabled);
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
elseif ($page=="status_bayar")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('sa/status_bayar/view/'.$id,' id="signupform" ');
  ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">MULTIPLE SEARCH</h3>
    </div>
      <div class="box-body">
        <div class="col-md-12">
          <div class="form-group">
            <label> Ketik Nama NIP NIK</label>
              <?php
                input_text("id",$id," autofocus","Ketik multiple pisahkan dengan spasi atau -","text");
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
		            <th>Nama</th>
		            <th>Instansi</th>
		          </tr>
		        </thead>
		      </table>
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
elseif ($page=="status_bayar_bayar")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
.dataTableLayout {
    table-layout:fixed;
    width:100%;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/status_bayar/simpan_bayar');?>" onClick="return cek();">
		<input type="hidden" name="id_pengajuan" value="<?= $id; ?>">
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
			</div>
			  <div class="box-body">
				<div class="col-md-12">
					  <label>Status Bayar</label>
							<?php
								input_pdselect2("status_lunas",$cmd_status,$status_lunas);
							?>
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
elseif ($page=="aktifasi")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('sa/aktifasi/view/'.$id,' id="signupform" ');
  ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">MULTIPLE SEARCH</h3>
    </div>
      <div class="box-body">
        <div class="col-md-12">
          <div class="form-group">
            <label> Ketik multiple pisahkan dengan spasi untuk NIP, No Profesi dan Nama</label>
              <?php
                input_text("id",$id," autofocus","Ketik multiple pisahkan dengan spasi atau -","text");
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
          <div class="box-tools pull-right"></div>
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
							  <th>Tanggal</th>
							  <th>Nama</th>
							  <th>Instansi</th>
							  <th>St Ins</th>
							  <th style="vertical-align:right;">Nominal Ins</th>
							  <th>Tgl Exp</th>
							  <th>HP</th>
							</tr>
						</thead>
					</table>
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
elseif ($page=="aktifasi_tambah")
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
      <?php echo form_open_multipart('sa/aktifasi/tambah/'.$id,' id="signupform" ');
        input_text("barcode_registrasi",$id,"","","hidden");
      ?>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-3">
              <div class="form-group">
                <label>Nama Pegawai</label>
                <?php
                  input_text("nama_pegawai",$nama_pegawai,"maxlength='60' required autofocus ","Ketikkan Nama","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Tempat Lahir</label>
                <?php
                  input_text("tmp_lahir",$tmp_lahir,"maxlength='255' ","Ketikkan Tempat Lahir","text");
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Tanggal Lahir</label>
                <?php
                  input_calendar("tgl_lahir","tgl_lahir",$tgl_lahir,"Masukkan Tanggal Lahir"," required");
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Jenis Kelamin</label>
                <?php
                  input_pdselect2("jk",$gender,$jk);
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Status Perkawinan</label>
                <?php
                  input_pdselect2("id_status_kawin",$cmd_status_kawin,$id_status_kawin);
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Agama</label>
                <?php
                  input_pdselect2("id_agama",$cmd_agama,$id_agama);
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>No KTP &nbsp; <small><span style="font-weight:bold;" id="msg2"></span></small></label>
                <?php
                  input_textcustom("nik",$nik," required id='nik'
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "Masukkan No KTP","text");
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Jabatan Pegawai</label>
                <?php
                  input_pdselect2("tipe_pegawai",$cmd_tipe_pegawai,$tipe_pegawai);
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Nomor Induk Karyawan</label>
                <?php
                  input_textcustom("nip",$nip,"  
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "Masukkan No Induk Karyawan","text");
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>No WA </label>
                <?php
                  input_textcustom("no_hp",$no_hp," required
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "Ketikkan No HP format kode negara","text");
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Email</label>
                <?php
                  input_text("email",$email,"maxlength='255' ","Ketikkan Email","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Jabatan Fungsional</label>
                <?php
                //  input_pdselect2fleksibel("id_jabatan_fungsional","id_jabatan_fungsional",$cmd_jabfung,"id_jabatan_fungsional","nama_jabatan_fungsional",$id_jabatan_fungsional,"Tidak Ada Jabfung");
                  input_pdselect2("id_jabatan_fungsional",$cmd_jabfung,$id_jabatan_fungsional);
                ?>
              </div>
            </div>           
            <div class="col-md-3">
              <div class="form-group">
                <label>Alamat</label>
                <?php
                  input_text("alamat",$alamat,"maxlength='255' ","Ketikkan Alamat","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Level</label>
                  <?php
                    input_pdselect2("id_level",$cmd_level,$id_level);
                  ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Username &nbsp; <small><span style="font-weight:bold;" id="msg"></span></small></label>
                <small><input type="checkbox" onclick="myUsername()"> Hide </small>
                <?php
                  input_textcustom("username",$username," maxlength='60' class='form-control' required autocomplete='off' id='username' ",
                          "Huruf kecil tanpa spasi dan spesial character kecuali -","text");
                ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Tempat Bekerja</label>
                <?php
              //    input_pdselect2fleksibel("id_instansi","id_instansi",$ambil_data_rujukan_working_null,"id_working","nama_working",$id_instansi,"Belum Bekerja");
                input_pdselect2("id_instansi",$ambil_data_rujukan_working_null,$id_instansi);
                ?>
              </div>
            </div>
            <div class="col-md-4">
                  <label>Unit</label>
                    <?php
        //      input_pdselect2fleksibel("id_unit","id_unit",$ambil_data_dropdown_unit,"id_unit","nama_unit",$id_unit,"Tidak Ada");
              input_pdselect2("id_unit",$ambil_data_dropdown_unit,$id_unit);
                    ?>
            </div> 
            <div class="col-md-4">
              <div class="form-group">
                <label>Pendidikan Terakhir</label>
                <?php
                  input_pdselect2("id_pendidikan",$cmd_pendidikan,$id_pendidikan);
                ?>
              </div>
            </div> 
            <div class="col-md-6">
              <div class="form-group">
                <label>Nama Instansi</label>
                <?php
                  input_text("nama_instansi",$nama_instansi,"maxlength='255' ","Ketikkan Alamat","text");
                ?>
              </div>
            </div>        
            <div class="col-md-6">
              <div class="form-group">
                <label>Alamat Instansi</label>
                <?php
                  input_text("alamat_instansi",$alamat_instansi,"maxlength='255' ","Ketikkan Alamat","text");
                ?>
              </div>
            </div> 
            <div class="col-md-6">
              <div class="form-group">
                <label>Nama Unit</label>
                <?php
                  input_text("nama_unit",$nama_unit,"maxlength='255' ","Ketikkan Alamat","text");
                ?>
              </div>
            </div>  
            <div class="col-md-6">
              <div class="form-group">
                <label>Atasan Unit</label>
                <?php
                  input_text("atasan_unit",$atasan_unit,"maxlength='255' ","Ketikkan Alamat","text");
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
elseif ($page=="pengajuan")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('sa/pengajuan/view/'.$id,' id="signupform" ');
  ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">MULTIPLE SEARCH</h3>
    </div>
      <div class="box-body">
        <div class="col-md-12">
          <div class="form-group">
            <label> Ketik multiple pisahkan dengan spasi untuk NIP, No Profesi dan Nama</label>
              <?php
                input_text("id",$id," autofocus","Ketik multiple pisahkan dengan spasi atau -","text");
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
          <div class="box-tools pull-right"></div>
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
							  <th>Tanggal</th>
							  <th>Data</th>
							  <th>Status</th>
							  <th>Waktu</th>
							  <th>Struk</th>
							</tr>
						</thead>
					</table>
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
elseif ($page=="pengajuan_aktifasi")
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
      <?php echo form_open_multipart('sa/pengajuan/aktifasi/'.$id,' id="signupform" ');
        input_text("barcode_pengajuan_temp",$id,"","","hidden");
        input_text("barcode_pegawai",$barcode_pegawai,"","","hidden");
      ?>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"></h3>
      </div>
        <div class="box-body">
        <div class="row">
            <div class="col-md-3">
                <label>Upload Struk</label>
                <?php
                  input_textcustom("upload_Files[]","","class='form-control-file' id='exampleInputFile' ","","file");
                ?>
                <p class="help-block">gif, png, jpg, jpeg</p>
            </div>
            <div class="col-md-4">
                <label>Nama Pegawai</label>
                <?php
                  input_text("nama_pegawai",$nama_pegawai,"maxlength='60' required autofocus ","Ketikkan Nama","text");
                ?>
            </div>
            <div class="col-md-2">
                <label>No WA </label>
                <?php
                  input_textcustom("no_hp",$no_hp," required
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "Ketikkan No HP format kode negara","text");
                ?>
            </div>
            <div class="col-md-3">
                <label>No KTP &nbsp; <small><span style="font-weight:bold;" id="msg2"></span></small></label>
                <?php
                  input_textcustom("nik",$nik," required id='nik'
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "Masukkan No KTP","text");
                ?>
            </div>
            <div class="col-md-3">
                <label>Nomor Induk Karyawan</label>
                <?php
                  input_textcustom("nip",$nip,"  
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "Masukkan No Induk Karyawan","text");
                ?>
            </div>
            <div class="col-md-3">
                <label>Email</label>
                <?php
                  input_text("email",$email,"maxlength='255' ","Ketikkan Email","text");
                ?>
            </div>          
            <div class="col-md-3">
                  <label>Unit</label>
                    <?php
              input_pdselect2("id_unit",$status_diusulkan_all,$id_unit);
                    ?>
            </div> 
            <div class="col-md-3">
              <div class="form-group">
                <label>Tanggal Pengajuan</label>
                <?php
                  input_calendar("tgl_pengajuan","tgl_pengajuan",$tgl_pengajuan,"Masukkan Tanggal"," required");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Kompetensi</label>
                <?php
                input_pdselect2("id_status_diusulkan",$status_diusulkan_all,$id_status_diusulkan);
                ?>
              </div>
            </div> 
            <div class="col-md-3">
              <div class="form-group">
                <label>Nominal Pembayaran</label>
                <?php
                input_textcustom("nominal_pengajuan",$nominal_pengajuan," style='text-align:right;' required id='tanpa-rupiah'
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber debet'",
                          "Nominal Transaksi","text"); 
                ?>
              </div>
            </div>  
            <div class="col-md-3">
              <div class="form-group">
                <label>Tempat Bekerja</label>
                <?php
              //    input_pdselect2fleksibel("id_instansi","id_instansi",$ambil_data_rujukan_working_null,"id_working","nama_working",$id_instansi,"Belum Bekerja");
                input_pdselect2("id_instansi",$cmd_instansi,$id_instansi);
                ?>
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
elseif ($page=="kop")
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
          <div class="box-tools pull-right"></div>
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
         <th>Judul</th>
         <th>Kategori</th>
         <th>Instansi</th>
         <th>Link</th>
         <th>Status</th>
       </tr>
      </thead>
     </table>
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
elseif ($page=="kop_tambah")
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
      <?php echo form_open_multipart('sa/kop/tambah/'.$id,' id="signupform" '); ?>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"></h3>
      </div>
        <div class="box-body">
        <div class="row">
            <div class="col-md-4">
                <label>Upload KOP</label>
                <?php
                  input_textcustom("upload_Files[]","","class='form-control-file' required id='exampleInputFile' ","","file");
                ?>
                <p class="help-block">gif, png, jpg, jpeg</p>
            </div>
            <div class="col-md-4">
                <label>Judul</label>
                <?php
                  input_text("nama_gambar",$nama_gambar,"maxlength='60' required autofocus ","Ketikkan Nama","text");
                ?>
            </div>        
            <div class="col-md-4">
                  <label>Kategori</label>
                    <?php
              input_pdselect2("id_kategori_gambar",$cmd_kategori_gambar,$id_kategori_gambar);
                    ?>
            </div> 
            <div class="col-md-4">
                <label>Instansi</label>
                <?php
                input_pdselect2("id_instansi",$cmd_instansi,$id_instansi);
                ?>
            </div>    
            <div class="col-md-4">
                <label>Status</label>
                <?php
                input_pdselect2("status_gambar",$cmd_status,$status_gambar);
                ?>
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
elseif ($page=="struk")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('sa/struk/view/'.$id,' id="signupform" ');
  ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">MULTIPLE SEARCH</h3>
    </div>
      <div class="box-body">
        <div class="col-md-12">
          <div class="form-group">
            <label> Ketik multiple pisahkan dengan spasi untuk NIP, No Profesi dan Nama</label>
              <?php
                input_text("id",$id," autofocus","Ketik multiple pisahkan dengan spasi atau -","text");
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
          <div class="box-tools pull-right"></div>
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
							  <th>Tanggal</th>
							  <th>Data</th>
							  <th>Waktu</th>
							  <th>Struk</th>
							</tr>
						</thead>
					</table>
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
elseif ($page=="struk_upload")
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
      <?php echo form_open_multipart('sa/struk/upload/'.$id,' id="signupform" ');
        input_text("barcode_pengajuan_temp",$barcode_pengajuan_temp,"","","hidden");
        input_text("barcode_pegawai",$barcode_pegawai,"","","hidden");
        input_text("id_pengajuan",$id,"","","hidden");
      ?>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"></h3>
      </div>
        <div class="box-body">
        <div class="row">
            <div class="col-md-3">
                <label>Upload Struk</label>
                <?php
                  input_textcustom("upload_Files[]","","class='form-control-file' required id='exampleInputFile' ","","file");
                ?>
                <p class="help-block">gif, png, jpg, jpeg</p>
            </div>
            <div class="col-md-4">
                <label>Nama Pegawai</label>
                <?php
                  input_text("nama_pegawai",$nama_pegawai,"maxlength='60' required autofocus ","Ketikkan Nama","text");
                ?>
            </div>
            <div class="col-md-2">
                <label>No WA </label>
                <?php
                  input_textcustom("no_hp",$no_hp," required
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "Ketikkan No HP format kode negara","text");
                ?>
            </div>
            <div class="col-md-3">
                <label>No KTP &nbsp; <small><span style="font-weight:bold;" id="msg2"></span></small></label>
                <?php
                  input_textcustom("nik",$nik," required id='nik'
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "Masukkan No KTP","text");
                ?>
            </div>
            <div class="col-md-3">
                <label>Nomor Induk Karyawan</label>
                <?php
                  input_textcustom("nip",$nip,"  
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "Masukkan No Induk Karyawan","text");
                ?>
            </div>
            <div class="col-md-3">
                <label>Email</label>
                <?php
                  input_text("email",$email,"maxlength='255' ","Ketikkan Email","text");
                ?>
            </div>          
            <div class="col-md-3">
                  <label>Unit</label>
                    <?php
              input_pdselect2("id_unit",$ambil_data_dropdown_unit,$id_unit);
                    ?>
            </div> 
            <div class="col-md-3">
              <div class="form-group">
                <label>Tanggal Pengajuan</label>
                <?php
                  input_calendar("tgl_pengajuan","tgl_pengajuan",$tgl_pengajuan,"Masukkan Tanggal"," required");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Kompetensi</label>
                <?php
                input_pdselect2("id_status_diusulkan",$status_diusulkan_all,$id_status_diusulkan);
                ?>
              </div>
            </div> 
            <div class="col-md-3">
              <div class="form-group">
                <label>Nominal Pembayaran</label>
                <?php
                input_textcustom("nominal_pengajuan",$nominal_pengajuan," style='text-align:right;' required id='tanpa-rupiah'
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber debet'",
                          "Nominal Transaksi","text"); 
                ?>
              </div>
            </div>  
            <div class="col-md-3">
              <div class="form-group">
                <label>Tempat Bekerja</label>
                <?php
              //    input_pdselect2fleksibel("id_instansi","id_instansi",$ambil_data_rujukan_working_null,"id_working","nama_working",$id_instansi,"Belum Bekerja");
                input_pdselect2("id_instansi",$cmd_instansi,$id_instansi);
                ?>
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
elseif ($page=="struktur_jabatan")
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
            <th style="display:none;">ID</th>
            <th>Nama</th>
            <th>Instansi</th>
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
elseif ($page=="struktur_jabatan_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/struktur_jabatan/simpan_tambah');?>" onClick="return cek();">
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
                  <label>Nama</label>
                  <?php
                    input_text("nama_struktur_jabatan",$nama_struktur_jabatan,"maxlength='255' required autofocus","Masukkan Nama","text");
                  ?>  
              </div>  
        <div class="col-md-6">
            <label>Instansi</label>
            <?php
              input_pdselect2("id_instansi",$ambil_data_working,$id_instansi);
            ?>  
        </div>  
        <div class="col-md-6">
            <label>Status</label>
            <?php
              input_pdselect2("status_struktur_jabatan",$cmd_status,$status_struktur_jabatan);
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
elseif ($page=="struktur_jabatan_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/struktur_jabatan/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_struktur_jabatan" value="<?= $id; ?>">
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
                  <label>Nama</label>
                  <?php
                    input_text("nama_struktur_jabatan",$nama_struktur_jabatan,"maxlength='255' required autofocus","Masukkan Nama","text");
                  ?>  
              </div>  
        <div class="col-md-6">
            <label>Instansi</label>
            <?php
              input_pdselect2("id_instansi",$ambil_data_working,$id_instansi);
            ?>  
        </div>  
        <div class="col-md-6">
            <label>Status</label>
            <?php
              input_pdselect2("status_struktur_jabatan",$cmd_status,$status_struktur_jabatan);
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
</script>
<?php
}
elseif ($page=="seting_absen")
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
            <th style="display:none;">ID</th>
            <th>Nama</th>
            <th>Unit</th>
            <th>Location</th>
            <th>Radius</th>
            <th>Zoom</th>
            <th>Clock In</th>
            <th>Clock Out</th>
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
elseif ($page=="seting_absen_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/seting_absen/simpan_tambah');?>" onClick="return cek();">
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
            <label>Nama</label>
            <?php
              input_text("nama_seting",$nama_seting,"maxlength='255' required autofocus","Masukkan Nama","text");
            ?>  
        </div>  
        <div class="col-md-4">
            <label>Unit</label>
            <?php
  input_pdselect2fleksibel("id_unit","id_unit",$ambil_unit,"id_unit","nama_unit",$id_unit,"Tidak Ada Unit");
            ?>  
        </div>  
        <div class="col-md-4">
            <label>Location</label>
            <?php
              input_text("location",$location,"maxlength='255' required","Masukkan Nama","text");
            ?>  
        </div>  
        <div class="col-md-4">
            <label>Radius</label>
            <?php
                  input_textcustom("radius",$radius," required id='radius'
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "Masukkan Radius","text");
            ?>  
        </div>
        <div class="col-md-3">
            <label>Zoom</label>
            <?php
                  input_textcustom("zoom",$zoom," required id='zoom'
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "Masukkan Zoom","text");
            ?>  
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label>Clock In</label>
            <?php
              input_calendar("clock_in","clock_in",$clock_in,"Masukkan Tanggal Lahir"," required");
            ?>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label>Clock Out</label>
            <?php
              input_calendar("clock_out","clock_out",$clock_out,"Masukkan Tanggal Lahir"," required");
            ?>
          </div>
        </div>
        <div class="col-md-3">
            <label>Status</label>
            <?php
              input_pdselect2("status_seting",$cmd_status,$status_seting);
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
$("#clock_in").inputmask("datetime", {
    mask: "h:s", 
    placeholder: "hh:mm"
});
$("#clock_out").inputmask("datetime", {
    mask: "h:s", 
    placeholder: "hh:mm"
});
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    alert("Geolocation is not supported by this browser.");
  }

  function showPosition(position) {
    var latitude  = position.coords.latitude;
    var longitude = position.coords.longitude;
    var latlong   = latitude + ', ' + longitude;
    $('#location').val(latlong);

/*    const map = L.map('map').setView([latitude, longitude], < ?= $setting->zoom_level; ?>);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: ''
    }).addTo(map);

    L.marker([latitude, longitude]).addTo(map)
      .bindPopup('My Location')
      .openPopup();

    var officeIcon = L.icon({
      iconUrl: '< ?= base_url('assets/img/icon/office-center.png'); ?>',

      iconSize:     [38, 95], // size of the icon
      shadowSize:   [50, 64], // size of the shadow
      iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
      popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
    });

    L.marker([< ?= $setting->location; ?>], {icon: officeIcon}).addTo(map)
      .bindPopup('< ?= $setting->company; ?>');

    L.circle([< ?= $setting->location; ?>], {
      color: 'blue',
      fillColor: 'blue',
      fillOpacity: 0.5,
      radius: < ?= $setting->radius; ?>
    }).addTo(map);*/
  }
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="seting_absen_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/seting_absen/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_seting" value="<?= $id; ?>">
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
            <label>Nama</label>
            <?php
              input_text("nama_seting",$nama_seting,"maxlength='255' required autofocus","Masukkan Nama","text");
            ?>  
        </div>  
        <div class="col-md-4">
            <label>Unit</label>
            <?php
  input_pdselect2fleksibel("id_unit","id_unit",$ambil_unit,"id_unit","nama_unit",$id_unit,"Tidak Ada Unit");
            ?>  
        </div>  
        <div class="col-md-4">
            <label>Location</label>
            <?php
              input_text("location",$location,"maxlength='255' required","Masukkan Nama","text");
            ?>  
        </div>  
        <div class="col-md-4">
            <label>Radius</label>
            <?php
                  input_textcustom("radius",$radius," required id='radius'
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "Masukkan Radius","text");
            ?>  
        </div>
        <div class="col-md-3">
            <label>Zoom</label>
            <?php
                  input_textcustom("zoom",$zoom," required id='zoom'
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "Masukkan Zoom","text");
            ?>  
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label>Clock In</label>
            <?php
              input_calendar("clock_in","clock_in",$clock_in,"Masukkan Tanggal Lahir"," required");
            ?>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label>Clock Out</label>
            <?php
              input_calendar("clock_out","clock_out",$clock_out,"Masukkan Tanggal Lahir"," required");
            ?>
          </div>
        </div>
        <div class="col-md-3">
            <label>Status</label>
            <?php
              input_pdselect2("status_seting",$cmd_status,$status_seting);
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
$("#clock_in").inputmask("datetime", {
    mask: "h:s", 
    placeholder: "hh:mm"
});
$("#clock_out").inputmask("datetime", {
    mask: "h:s", 
    placeholder: "hh:mm"
});
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="kategori_absen")
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
            <th style="display:none;">ID</th>
            <th>Nama</th>
            <th>Instansi</th>
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
elseif ($page=="kategori_absen_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/kategori_absen/simpan_tambah');?>" onClick="return cek();">
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
                  <label>Nama</label>
                  <?php
                    input_text("nama_kategori_absen",$nama_kategori_absen,"maxlength='255' required autofocus","Masukkan Nama","text");
                  ?>  
              </div>  
        <div class="col-md-6">
            <label>Instansi</label>
            <?php
              input_pdselect2("id_instansi",$ambil_data_working,$id_instansi);
            ?>  
        </div>  
        <div class="col-md-6">
            <label>Status</label>
            <?php
              input_pdselect2("status_kategori_absen",$cmd_status,$status_kategori_absen);
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
elseif ($page=="kategori_absen_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/kategori_absen/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_kategori_absen" value="<?= $id; ?>">
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
                  <label>Nama</label>
                  <?php
                    input_text("nama_kategori_absen",$nama_kategori_absen,"maxlength='255' required autofocus","Masukkan Nama","text");
                  ?>  
              </div>  
        <div class="col-md-6">
            <label>Instansi</label>
            <?php
              input_pdselect2("id_instansi",$ambil_data_working,$id_instansi);
            ?>  
        </div>  
        <div class="col-md-6">
            <label>Status</label>
            <?php
              input_pdselect2("status_kategori_absen",$cmd_status,$status_kategori_absen);
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
</script>
<?php
}
elseif ($page=="mitra")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
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
            <th>ID</th>
            <th>Nama</th>
            <th>User</th>
            <th>Instansi</th>
            <th>Nominal</th>
            <th>Bayar</th>
            <th>Expired</th>
            <th>Ket</th>
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
  <div class="modal-dialog">
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
elseif ($page=="mitra_tambah")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small><?= $title ?></small>
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('sa/mitra/tambah/'.$id,' id="signupform" ');?>
  <input type="hidden" name="id_working" value="<?= $id ?>">
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
    </div>
      <div class="box-body">
        <div class="col-md-3">
              <label>Upload Kop</label>
              <?php
                input_textcustom("upload_Files[]","","class='form-control-file' id='exampleInputFile' "," ","file");
              ?>
              <p class="help-block">gif, png, jpg, jpeg</p>
        </div>
        <div class="col-md-2">
            <label>Tanggal Pembayaran</label>
              <?php
                input_calendar("tgl_awal_working_mitra","tgl_awal_working_mitra",$tgl_awal_working_mitra,"Masukkan Tanggal Transaksi","required");
              ?>
        </div>
        <div class="col-md-2">
            <label>Tanggal Expired</label>
              <?php
                input_calendar("tgl_akhir_working_mitra","tgl_akhir_working_mitra",$tgl_akhir_working_mitra,"Masukkan Tanggal Transaksi","required");
              ?>
        </div>
        <div class="col-md-3">
            <label>Nama Mitra</label>
            <?php
              input_pdselect2("id_struktur_jabatan",$kol_srt_sjab,$id_struktur_jabatan);
            ?>
        </div>
        <div class="col-md-3">
            <label>Nominal Pembayaran</label>
            <?php
            input_textcustom("nominal_working_mitra",$nominal_working_mitra," style='text-align:right;' required id='tanpa-rupiah'
                  onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber debet'",
                      "Nominal Transaksi","text"); 
            ?>
        </div> 
        <div class="col-md-3">
            <label>Keterangan</label>
            <?php
              input_text("ket_working_mitra",$ket_working_mitra,"","Masukkan Keterangan","text");
            ?>  
        </div> 
        <div class="col-md-3">
            <label>Status Pembayaran</label>
            <?php
              input_pdselect2("status_working_mitra",$cmd_status,$status_working_mitra);
            ?>
        </div>
        <div class="col-md-12">
            <label>Nama User</label>
            <?php
              input_pdselect2("barcode_pegawai",$pegawe,$barcode_pegawai);
            ?>
        </div>
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
elseif ($page=="mitra_edit")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small><?= $title ?></small>
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('sa/mitra/edit/'.$id,' id="signupform" ');?>
  <input type="hidden" name="id_working_mitra" value="<?= $id_working_mitra ?>">
  <input type="hidden" name="id_mitra" value="<?= $id_mitra ?>">
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
    </div>
      <div class="box-body">
        <div class="col-md-3">
              <label>Upload Kop</label>
              <?php
                input_textcustom("upload_Files[]","","class='form-control-file' id='exampleInputFile' "," ","file");
              ?>
              <p class="help-block">gif, png, jpg, jpeg</p>
        </div>
        <div class="col-md-2">
            <label>Tanggal Pembayaran</label>
              <?php
                input_calendar("tgl_awal_working_mitra","tgl_awal_working_mitra",$tgl_awal_working_mitra,"Masukkan Tanggal Transaksi","required");
              ?>
        </div>
        <div class="col-md-2">
            <label>Tanggal Expired</label>
              <?php
                input_calendar("tgl_akhir_working_mitra","tgl_akhir_working_mitra",$tgl_akhir_working_mitra,"Masukkan Tanggal Transaksi","required");
              ?>
        </div>
        <div class="col-md-3">
            <label>Nama Mitra</label>
            <?php
              input_pdselect2("id_struktur_jabatan",$kol_srt_sjab,$id_struktur_jabatan);
            ?>
        </div>
        <div class="col-md-3">
            <label>Nominal Pembayaran</label>
            <?php
            input_textcustom("nominal_working_mitra",$nominal_working_mitra," style='text-align:right;' required id='tanpa-rupiah'
                  onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber debet'",
                      "Nominal Transaksi","text"); 
            ?>
        </div> 
        <div class="col-md-3">
            <label>Keterangan</label>
            <?php
              input_text("ket_working_mitra",$ket_working_mitra,"","Masukkan Keterangan","text");
            ?>  
        </div> 
        <div class="col-md-3">
            <label>Status Pembayaran</label>
            <?php
              input_pdselect2("status_working_mitra",$cmd_status,$status_working_mitra);
            ?>
        </div>
        <div class="col-md-12">
            <label>Nama User</label>
            <?php
              input_pdselect2("barcode_pegawai",$pegawe,$barcode_pegawai);
            ?>
        </div>
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
elseif ($page=="work_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/work/simpan_edit');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            <input type="hidden" name="id_working" value="<?= $id_working; ?>">
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
            <div class="col-md-12">
                <label>Nama</label>
                <?php
                  input_text("nama_working",$nama_working,"maxlength='255' required autofocus ","Ketikkan Nama","text");
                ?>
            </div>
            <div class="col-md-6">
                <label>Email</label>
                <?php
                  input_text("email_working",$email_working,"maxlength='255' ","Ketikkan Email","text");
                ?>
            </div>
            <div class="col-md-6">
                <label>Telepon / Fax</label>
                <?php
                  input_text("kontak_working",$kontak_working,"maxlength='255' ","Ketikkan Tempat Lahir","text");
                ?>
            </div>
            <div class="col-md-12">
                <label>Alamat</label>
                <?php
                  input_text("alamat_working",$alamat_working,"maxlength='255' ","Ketikkan Alamat","text");
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
$('#expired_working').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#expired_working").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
	function formatRupiah(angka, prefix)
	{
		var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split	= number_string.split(','),
			sisa 	= split[0].length % 3,
			rupiah 	= split[0].substr(0, sisa),
			ribuan 	= split[0].substr(sisa).match(/\d{3}/gi);
			
		if (ribuan) {
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}
		
		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
	}
	var tanpa_rupiah = document.getElementById('tanpa-rupiah');
	tanpa_rupiah.addEventListener('keyup', function(e)
	{
		tanpa_rupiah.value = formatRupiah(this.value);
	});
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="work")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
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
            <th>Nama</th>
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
elseif ($page=="work_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/work/simpan_tambah');?>" onClick="return cek();">
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
            <div class="col-md-12">
                <label>Nama</label>
                <?php
                  input_text("nama_working",$nama_working,"maxlength='255' required autofocus ","Ketikkan Nama","text");
                ?>
            </div>
            <div class="col-md-6">
                <label>Email</label>
                <?php
                  input_text("email_working",$email_working,"maxlength='255' ","Ketikkan Email","text");
                ?>
            </div>
            <div class="col-md-6">
                <label>Telepon / Fax</label>
                <?php
                  input_text("kontak_working",$kontak_working,"maxlength='255' ","Ketikkan Tempat Lahir","text");
                ?>
            </div>
            <div class="col-md-12">
                <label>Alamat</label>
                <?php
                  input_text("alamat_working",$alamat_working,"maxlength='255' ","Ketikkan Alamat","text");
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
$('#expired_working').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#expired_working").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
	function formatRupiah(angka, prefix)
	{
		var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split	= number_string.split(','),
			sisa 	= split[0].length % 3,
			rupiah 	= split[0].substr(0, sisa),
			ribuan 	= split[0].substr(sisa).match(/\d{3}/gi);
			
		if (ribuan) {
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}
		
		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
	}
	var tanpa_rupiah = document.getElementById('tanpa-rupiah');
	tanpa_rupiah.addEventListener('keyup', function(e)
	{
		tanpa_rupiah.value = formatRupiah(this.value);
	});
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="work_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/work/simpan_edit');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            <input type="hidden" name="id_working" value="<?= $id_working; ?>">
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
            <div class="col-md-12">
                <label>Nama</label>
                <?php
                  input_text("nama_working",$nama_working,"maxlength='255' required autofocus ","Ketikkan Nama","text");
                ?>
            </div>
            <div class="col-md-6">
                <label>Email</label>
                <?php
                  input_text("email_working",$email_working,"maxlength='255' ","Ketikkan Email","text");
                ?>
            </div>
            <div class="col-md-6">
                <label>Telepon / Fax</label>
                <?php
                  input_text("kontak_working",$kontak_working,"maxlength='255' ","Ketikkan Tempat Lahir","text");
                ?>
            </div>
            <div class="col-md-12">
                <label>Alamat</label>
                <?php
                  input_text("alamat_working",$alamat_working,"maxlength='255' ","Ketikkan Alamat","text");
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
$('#expired_working').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#expired_working").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
	function formatRupiah(angka, prefix)
	{
		var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split	= number_string.split(','),
			sisa 	= split[0].length % 3,
			rupiah 	= split[0].substr(0, sisa),
			ribuan 	= split[0].substr(sisa).match(/\d{3}/gi);
			
		if (ribuan) {
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}
		
		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
	}
	var tanpa_rupiah = document.getElementById('tanpa-rupiah');
	tanpa_rupiah.addEventListener('keyup', function(e)
	{
		tanpa_rupiah.value = formatRupiah(this.value);
	});
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="work_kop")
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
          </div>
        </div>
      <?php echo form_open_multipart('sa/work/kop/'.$id,' id="signupform" ');
        input_text("id_working",$id_working,"","","hidden");
      ?>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
                <label>Upload Kop</label>
                <?php
                  input_textcustom("upload_Files[]","","class='form-control-file' id='exampleInputFile' ","","file");
                ?>
                <p class="help-block">gif, png, jpg, jpeg</p>
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
elseif ($page=="work_kop_sm")
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
          </div>
        </div>
      <?php echo form_open_multipart('sa/work/kop_sm/'.$id,' id="signupform" ');
        input_text("id_working",$id_working,"","","hidden");
      ?>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
                <label>Upload Kop SM</label>
                <?php
                  input_textcustom("upload_Files[]","","class='form-control-file' id='exampleInputFile' ","","file");
                ?>
                <p class="help-block">gif, png, jpg, jpeg</p>
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
elseif ($page=="working")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
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
            <th>IDPI</th>
            <th>ID</th>
            <th>NIK - Nama</th>
            <th>Instansi</th>
            <th>Jabfung</th>
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
  <div class="modal-dialog">
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
elseif ($page=="working_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/working/simpan_tambah');?>" onClick="return cek();">
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
            <div class="col-md-12">
                <label>Pegawai</label>
                <?php
                  input_pdselect2("id_pegawai",$ambil_data_pegawai_4_sa,$id_pegawai);
                ?>
            </div>     
            <div class="col-md-12">
                <label>Instansi</label>
                <?php
                  input_pdselect2("id_instansi",$ambil_data_rujukan_working,$id_instansi);
                ?>
            </div>   
              <div class="col-md-12">
                  <label>Status</label>
                  <?php
                  input_pdselect2("status_pegawai_instansi",$cmd_status,$status_pegawai_instansi);
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
elseif ($page=="working_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/working/simpan_edit');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            <input type="hidden" name="id_pegawai_instansi" value="<?= $id; ?>">
            <input type="hidden" name="id_instansi_lama" value="<?= $id_instansi; ?>">
            <input type="hidden" name="id_pegawai" value="<?= $id_pegawai; ?>">
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
            <div class="col-md-12">
                <label>Instansi</label>
                <?php
                  input_pdselect2("id_instansi",$ambil_data_rujukan_working,$id_instansi);
                ?>
            </div>   
              <div class="col-md-12">
                  <label>Status</label>
                  <?php
                  input_pdselect2("status_pegawai_instansi",$cmd_status,$status_pegawai_instansi);
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
elseif ($page=="grade")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
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
            <th style="display:none;">&nbsp;</th>
            <th>Nama</th>
            <th>Jabatan</th>
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
elseif ($page=="grade_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/grade/simpan_tambah');?>" onClick="return cek();">
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
            <div class="col-md-12">
                <label>Nama Grade</label>
                <?php
                  input_text("nama_grade",$nama_grade,"maxlength='255' ","Nama Grade","text");
                ?>
            </div>          
            <div class="col-md-12">
                <label>Instansi</label>
                <?php
                  input_pdselect2("id_jabatan",$jabatan,$id_jabatan);
                ?>
            </div>   
              <div class="col-md-12">
                  <label>Sifat Tugas</label>
          <?php
            input_textareacustom("sifat_tugas_grade",$sifat_tugas_grade," id='editor1' rows='10' cols='100' class='form-control' ","");
          ?>  
                </div>
              <div class="col-md-12">
                  <label>Persyaratan</label>
          <?php
            input_textareacustom("syarat_grade",$syarat_grade," id='editor2' rows='10' cols='100' class='form-control' ","");
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
CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
CKEDITOR.replace('editor2', {enterMode: CKEDITOR.ENTER_BR});
});
</script>
<?php
}
elseif ($page=="grade_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/grade/simpan_edit');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            <input type="hidden" name="id_grade" value="<?= $id_grade; ?>">
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
            <div class="col-md-12">
                <label>Nama Grade</label>
                <?php
                  input_text("nama_grade",$nama_grade,"maxlength='255' ","Ketikkan pelayanan","text");
                ?>
            </div>          
            <div class="col-md-12">
                <label>Instansi</label>
                <?php
                  input_pdselect2("id_jabatan",$jabatan,$id_jabatan);
                ?>
            </div>   
              <div class="col-md-12">
                  <label>Sifat Tugas</label>
          <?php
            input_textareacustom("sifat_tugas_grade",$sifat_tugas_grade," id='editor1' rows='10' cols='100' class='form-control' ","");
          ?>  
                </div>
              <div class="col-md-12">
                  <label>Persyaratan</label>
          <?php
            input_textareacustom("syarat_grade",$syarat_grade," id='editor2' rows='10' cols='100' class='form-control' ","");
          ?>  
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
CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
CKEDITOR.replace('editor2', {enterMode: CKEDITOR.ENTER_BR});
});
</script>
<?php
}
elseif ($page=="aplikasi_bayar")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
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
            <th style="width:5%;"></th>
            <th>ID</th>
            <th>Nama</th>
            <th>Instansi</th>
            <th>Jabfung</th>
            <th>Tipe</th>
            <th>Status</th>
            <th>Ins Exp</th>
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
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
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
elseif ($page=="aplikasi_bayar_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/aplikasi_bayar/simpan_tambah');?>" onClick="return cek();">
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
            <div class="col-md-12">
                <label>Pegawai</label>
                <?php
                  input_pdselect2("id_konsumen",$ambil_data_pegawai,$id_konsumen);
                ?>
            </div>     
            <div class="col-md-12">
                <label>Instansi</label>
                <?php
                  input_pdselect2fleksibel("id_instansi","id_instansi",$ambil_data_working,"id_working","nama_working",$id_instansi,"Belum Bekerja");
                ?>
            </div>   
              <div class="col-md-6">
                  <label>Tipe</label>
                  <?php
                  input_pdselect2("tipe_konsumen",$cmd_tipe,$tipe_konsumen);
                  ?>
              </div>
              <div class="col-md-6">
                  <label>Status</label>
                  <?php
                  input_pdselect2("status_aplikasi_bayar",$cmd_status,$status_aplikasi_bayar);
                  ?>
              </div>
            <div class="col-md-6">
                <label>Expired</label>
                <?php
                  input_calendar("tgl_expired","tgl_expired",$tgl_expired,"Masukkan Tanggal"," required");
                ?>
            </div>
            <div class="col-md-6">
                <label>Nominal</label>
              <?php 
                input_textcustom("nominal_aplikasi_bayar",$nominal_aplikasi_bayar," style='text-align:right;' required id='tanpa-rupiah'
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber debet'",
                          "Nominal Transaksi","text");          
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
$('#tgl_expired').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_expired").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
	function formatRupiah(angka, prefix)
	{
		var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split	= number_string.split(','),
			sisa 	= split[0].length % 3,
			rupiah 	= split[0].substr(0, sisa),
			ribuan 	= split[0].substr(sisa).match(/\d{3}/gi);
			
		if (ribuan) {
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}
		
		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
	}
	var tanpa_rupiah = document.getElementById('tanpa-rupiah');
	tanpa_rupiah.addEventListener('keyup', function(e)
	{
		tanpa_rupiah.value = formatRupiah(this.value);
	});
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="aplikasi_bayar_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/aplikasi_bayar/simpan_edit');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            <input type="hidden" name="id_aplikasi_bayar" value="<?= $id_aplikasi_bayar; ?>">
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
            <div class="col-md-12">
                <label>Pegawai</label>
                <?php
                  input_pdselect2("id_konsumen",$ambil_data_pegawai,$id_konsumen);
                ?>
            </div>     
            <div class="col-md-12">
                <label>Instansi</label>
                <?php
                  input_pdselect2fleksibel("id_instansi","id_instansi",$ambil_data_working,"id_working","nama_working",$id_instansi,"Belum Bekerja");
                ?>
            </div>   
              <div class="col-md-6">
                  <label>Tipe</label>
                  <?php
                  input_pdselect2("tipe_konsumen",$cmd_tipe,$tipe_konsumen);
                  ?>
              </div>
              <div class="col-md-6">
                  <label>Status</label>
                  <?php
                  input_pdselect2("status_aplikasi_bayar",$cmd_status,$status_aplikasi_bayar);
                  ?>
              </div>
            <div class="col-md-6">
                <label>Expired</label>
                <?php
                  input_calendar("tgl_expired","tgl_expired",$tgl_expired,"Masukkan Tanggal"," required");
                ?>
            </div>
            <div class="col-md-6">
                <label>Nominal</label>
              <?php 
                input_textcustom("nominal_aplikasi_bayar",$nominal_aplikasi_bayar," style='text-align:right;' required id='tanpa-rupiah'
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber debet'",
                          "Nominal Transaksi","text");          
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
$('#tgl_expired').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_expired").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
	function formatRupiah(angka, prefix)
	{
		var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split	= number_string.split(','),
			sisa 	= split[0].length % 3,
			rupiah 	= split[0].substr(0, sisa),
			ribuan 	= split[0].substr(sisa).match(/\d{3}/gi);
			
		if (ribuan) {
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}
		
		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
	}
	var tanpa_rupiah = document.getElementById('tanpa-rupiah');
	tanpa_rupiah.addEventListener('keyup', function(e)
	{
		tanpa_rupiah.value = formatRupiah(this.value);
	});
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="pelayanan")
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
					  <th>Nama</th>
					  <th>Instansi</th>					  
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
elseif ($page=="pelayanan_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/pelayanan/simpan_tambah');?>" onClick="return cek();">
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
                <label>Nama Pelayanan</label>
                <?php
                  input_text("nama_pelayanan",$nama_pelayanan,"maxlength='255' ","Ketikkan pelayanan","text");
                ?>
            </div>
            <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
              input_pdselect2("id_instansi",$ambil_data_working,$id_instansi);
                    ?>
            </div> 
            <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
              input_pdselect2("status_pelayanan",$cmd_status,$status_pelayanan);
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
</script>
<?php
}
elseif ($page=="pelayanan_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/pelayanan/simpan_edit');?>" onClick="return cek();">
       <input type="hidden" name="id_pelayanan" value="<?= $id_pelayanan; ?>">
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
                <label>Nama Pelayanan</label>
                <?php
                  input_text("nama_pelayanan",$nama_pelayanan,"maxlength='255' ","Ketikkan pelayanan","text");
                ?>
            </div>
            <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
              input_pdselect2("id_instansi",$ambil_data_working,$id_instansi);
                    ?>
            </div> 
            <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
              input_pdselect2("status_pelayanan",$cmd_status,$status_pelayanan);
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
</script>
<?php
}
elseif ($page=="ruangan")
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
			<?php
	//			input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
			?>
          </div>
        </div>
        <div class="box-body">
			<table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
				<thead>
					<tr>
					  <th width="5%">ID</th>
					  <th>Nama</th>
					  <th>Struktur Jabatan</th>					  
					  <th>Instansi</th>					  
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
elseif ($page=="ruangan_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/ruangan/simpan_tambah');?>" onClick="return cek();">
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
                <label>Nama Ruangan</label>
                <?php
                  input_text("nama_unit",$nama_unit,"maxlength='255' ","Ketikkan pelayanan","text");
                ?>
            </div>
            <div class="col-md-12">
                  <label>Struktur Jabatan</label>
                    <?php
              input_pdselect2("id_struktur_jabatan",$cmd_struktur_jabatan,$id_struktur_jabatan);
                    ?>
            </div> 
            <div class="col-md-12">
                  <label>Status</label>
                    <?php
              input_pdselect2("status_unit",$cmd_status,$status_unit);
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
</script>
<?php
}
elseif ($page=="ruangan_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/ruangan/simpan_edit');?>" onClick="return cek();">
       <input type="hidden" name="id_unit" value="<?= $id_unit; ?>">
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
                <label>Nama Ruangan</label>
                <?php
                  input_text("nama_unit",$nama_unit,"maxlength='255' ","Ketikkan pelayanan","text");
                ?>
            </div>
            <div class="col-md-12">
                  <label>Struktur Jabatan</label>
                    <?php
              input_pdselect2("id_struktur_jabatan",$cmd_struktur_jabatan,$id_struktur_jabatan);
                    ?>
            </div> 
            <div class="col-md-12">
                  <label>Status</label>
                    <?php
              input_pdselect2("status_unit",$cmd_status,$status_unit);
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
</script>
<?php
}
elseif ($page=="kompetensi")
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
					  <th style="display:none;width: 5%;">ID</th>
					  <th style="width:10%;">Kode Unit</th>
					  <th>Judul Unit</th>
					  <th style="width:20%;">Jab Fung</th>
					  <th style="width:20%;">Instansi</th>
            <th style="width:10%;">Status</th>
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
elseif ($page=="kompetensi_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/kompetensi/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
		<div class="box-body">     
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title"><?= $title ?></h3>
			</div>
			  <div class="box-body">
						<div class="row">
							<div class="col-md-8">
								  <label>Judul Unit</label>
									<?php
										input_text("nama_kompetensi",$nama_kompetensi,"maxlength='255' required","Masukkan Nama","text");
									?>	
							</div>								
							<div class="col-md-4">
								  <label>Kode Unit <span id="errmsg"></span></label>
									<?php
                  input_textcustom("kode_unit",$kode_unit," required maxlength='35' id='kode_unit' class='form-control'",
                            "Masukkan Kode Unit","text");
									?>	
							</div>		
							<div class="col-md-4">
								  <label>Jabatan Fungsional</label>
										<?php
											input_pdselect2("id_jabatan",$cmd_jabatan,$id_jabatan);
										?>					
							</div>
              <div class="col-md-4">
                  <label>Instansi</label>
                    <?php
                  input_pdselect2fleksibel("id_instansi","id_instansi",$cmd_instansi,"id_working","nama_working",$id_instansi,"Semua Instansi");
                    ?>          
              </div>
							<div class="col-md-4">
								  <label>Dengan Kewenangan</label>
										<?php
											input_pdselect2("pluske",$cmd_pluske,$pluske);
										?>					
							</div>
							<div class="col-md-12">
								  <label>Deskripsi</label>
                  <?php
                    input_textareacustom("deskripsi_kompetensi",$deskripsi_kompetensi," id='editor1' rows='3' cols='20' class='form-control' ","Keterangan");
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
	  CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
});	
$('#kode_unit').keypress(function (e) {
    var regex = new RegExp("^[a-zA-Z0-9_]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }
    e.preventDefault();
    return false;
});
$('#kode_unit').on("input",function(event) {
  var current = $(this).val();
  var replaced = current.replace(/[^a-zA-Z0-9 _]/g,'');
  $(this).val(replaced);
});
</script>
<?php
}
elseif ($page=="kompetensi_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/kompetensi/simpan_edit');?>" onClick="return cek();">
		<input type="hidden" name="id_kompetensi" value="<?= $id_kompetensi; ?>">
		<input type="hidden" name="creator_kompetensi" value="<?= $creator_kompetensi; ?>">
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
							<div class="col-md-12">
								  <label>Judul Unit</label>
									<?php
										input_text("nama_kompetensi",$nama_kompetensi,"maxlength='255' required","Masukkan Nama","text");
									?>	
							</div>								
							<div class="col-md-4">
								  <label>Kode Unit <span id="errmsg"></span></label>
									<?php
                  input_textcustom("kode_unit",$kode_unit," required maxlength='35' id='kode_unit' class='form-control'",
                            "Masukkan Kode Unit","text");
									?>	
							</div>		
							<div class="col-md-4">
								  <label>Jabatan Fungsional</label>
										<?php
											input_pdselect2("id_jabatan",$cmd_jabatan,$id_jabatan);
										?>					
							</div>
              <div class="col-md-4">
                  <label>Instansi</label>
                    <?php
                  input_pdselect2fleksibel("id_instansi","id_instansi",$cmd_instansi,"id_working","nama_working",$id_instansi,"Semua Instansi");
                    ?>          
              </div>
							<div class="col-md-12">
								  <label>Deskripsi</label>
                  <?php
                    input_textareacustom("deskripsi_kompetensi",$deskripsi_kompetensi," id='editor1' rows='3' cols='20' class='form-control' ","Keterangan");
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
	  CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
});	
$('#kode_unit').keypress(function (e) {
    var regex = new RegExp("^[a-zA-Z0-9_]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }
    e.preventDefault();
    return false;
});
$('#kode_unit').on("input",function(event) {
  var current = $(this).val();
  var replaced = current.replace(/[^a-zA-Z0-9 _]/g,'');
  $(this).val(replaced);
});
</script>
<?php
}
elseif ($page=="kewenangan")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
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
		            <th style="width:10%;">Kode Unit</th>
                <th>Kewenangan</th>                
		            <th>Kompetensi</th>
		            <th style="width:20%;">Jab Fung</th>
		            <th style="width:20%;">Instansi</th>
		          </tr>
		        </thead>
		      </table>
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
elseif ($page=="kewenangan_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/kewenangan/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
		<div class="box-body">     
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title"><?= $title ?></h3>
			</div>
			  <div class="box-body">
						<div class="row">	
							<div class="col-md-12">
								  <label>Nama Kewenangan</label>
									<?php
										input_text("nama_kewenangan",$nama_kewenangan,"maxlength='255' required","Masukkan Nama","text");
									?>	
							</div>		
							<div class="col-md-12">
								  <label>Kompetensi</label>
										<?php
											input_pdselect2("id_kompetensi",$cmd_kompetensi,$id_kompetensi);
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
elseif ($page=="kewenangan_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('sa/kewenangan/simpan_edit');?>" onClick="return cek();">
		<input type="hidden" name="id_kewenangan" value="<?= $id_kewenangan; ?>">
		<input type="hidden" name="creator_kewenangan" value="<?= $creator_kewenangan; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
		<div class="box-body">     
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">TINDAKAN</h3>
			</div>
			  <div class="box-body">
						<div class="row">
							<div class="col-md-12">
								  <label>Nama Kewenangan</label>
									<?php
										input_text("nama_kewenangan",$nama_kewenangan,"maxlength='255' required","Masukkan Nama","text");
									?>	
							</div>		
							<div class="col-md-12">
								  <label>Kompetensi</label>
										<?php
											input_pdselect2("id_kompetensi",$cmd_kompetensi,$id_kompetensi);
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