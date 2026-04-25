<?php
//=================================== H O M E ================================================
$arraybox = array('warning','success','info','danger');
$arraybg = array('navy','yellow','maroon','olive','purple','red','aqua','light-blue','blue',
					'green','teal','lime','orange','fuchsia');
if ($page=="home")
{
$menus = array(
        0 =>array("link"=> base_url('laporan/transaksi'), "name"=> "INVOICE", "id"=> "Akunting" ),
        1 =>array("link"=> base_url('laporan/jurnal'), "name"=> "JURNAL", "id"=> "Akunting" ),
        2 =>array("link"=> base_url('laporan/buku_besar'), "name"=> "BUKU BESAR", "id"=> "Akunting" ),
        3 =>array("link"=> base_url('laporan/neraca'), "name"=> "NERACA", "id"=> "Akunting" ),
        4 =>array("link"=> base_url('laporan/rugi_laba'), "name"=> "RUGI LABA", "id"=> "Akunting" ),
     );
?> 
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
						<a href="<?php echo base_url('akunting');?>" 
							class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-money"></i> Akunting
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
		  <div class="row">
		  <?php
		  foreach($array_laporan as $page_array){
		  ?>
			<div class="col-lg-3 col-xs-6">
			  <a href="<?php echo base_url($page_array['link_m_laporan']); ?>">
			  <div class="small-box bg-<?php echo $arraybg[array_rand($arraybg)]; ?>">
				<div class="inner">
				  <h3><?php echo $page_array['nama_m_laporan']; ?></h3>
				  <p><?php echo $page_array['nama_unit']; ?></p>
				</div>
				<div class="icon">
				  <i class="fa fa-file-text"></i>
				</div>			
			  </div>
			  </a>
			</div>
		  <?php
		  }
		  ?>
		  </div>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<?php
}
//================================== LAPORAN ===============================
elseif ($page=="jurnal")
{
?>

  <div class="content-wrapper">
    <section class="content-header">
						<a href="<?php echo $link_kembali;?>" 
							class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Laporan
						</a>	||
						<a href="<?php echo base_url('akunting');?>" 
							class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-money"></i> Akunting
						</a>	
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
			<?php echo form_open_multipart('laporan/'.$page.'/view/'.$first_date.'/'.$last_date.'/'.$id.'/'.$id_jenis_jurnal,' id="signupform" ');
			?>
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
		<div class="box-header with-border">
			<button type="submit" name="action" value="BtnProses" class="btn btn-primary btn-xs pull-left"><i class="fa fa-recycle"></i> Proses</button>
		</div>
			  <div class="box-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
						  <label>Tipe Transaksi</label>
								<?php
									input_pdselect2fleksibel("id","id",$cmd_uraian_detil,"uraian_detil","uraian_detil",$id,"Pilih Semua Tipe Transaksi");
								?>	
						</div>					
					</div>		
					<div class="col-md-6">
						<div class="form-group">
						  <label>Pilih Jurnal</label>
								<?php
									input_pdselect2("id_jenis_jurnal",$cmd_jenis_jurnal,$id_jenis_jurnal);
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
			<a href="<?php echo base_url('laporan/'.$page.'/pdf/'); ?><?php echo $first_date;?>/<?php echo $last_date;?>/<?php echo str_replace(' ', '-', $id);?>/<?php echo $id_jenis_jurnal;?>" target="_blank" class="btn btn-white btn-md">
				<i class="fa fa-print"></i> PDF
			</a>
			||
			<a href="<?php echo base_url('laporan/'.$page.'/xls/'); ?><?php echo $first_date;?>/<?php echo $last_date;?>/<?php echo str_replace(' ', '-', $id);?>/<?php echo $id_jenis_jurnal;?>" target="_blank" class="btn btn-white btn-md">
				<i class="fa fa-print"></i> Excell
			</a>
		</div>
			<div class="box-body">
				   <table id="example1" width="100%" class="table table-bordered table-striped">
					<thead>
						<tr>
						  <th colspan="2" style="background-color: #800000;color: white;vertical-align:middle;text-align:center;width:10%;">Kode Rekening</th>
						  <th style="background-color: #800000;color: white;vertical-align:middle;text-align:center;width:15%;">Akun / Tipe Rekening</th>
						  <th style="background-color: #800000;color: white;vertical-align:middle;text-align:center;">Catatan</th>
						  <th style="background-color: #800000;color: white;vertical-align:middle;text-align:center;width:15%;">Debet</th>
						  <th style="background-color: #800000;color: white;vertical-align:middle;text-align:center;width:15%;">Kredit</th>
					  </tr>
					</thead>
					  <tbody>
					  <?php
						foreach($ambil_transaksi_periode_jurnal as $rowambil_transaksi_periode_jurnal){
					  ?>
							<tr>
							  <td colspan="2" style="vertical-align:middle;text-align:left;"><?php echo date('d-m-Y',strtotime($rowambil_transaksi_periode_jurnal['tgl_transaksi'])); ?></td>
							  <td style="vertical-align:middle;text-align:left;width:10%;"><?php echo $rowambil_transaksi_periode_jurnal['uraian_detil']; ?></td>
							  <td colspan="3" style="vertical-align:middle;text-align:left;"><?php echo $rowambil_transaksi_periode_jurnal['ket_transaksi']; ?></td>
							</tr>
							<?php
						$ambil_transaksi_periode_jurnal_detil = $this->m_akunting->ambil_transaksi_periode_jurnal_detil($first_date,$last_date,$id,$id_jenis_jurnal,$rowambil_transaksi_periode_jurnal['id_transaksi']);
							$tot_debet = 0;$tot_kredit = 0;
							foreach($ambil_transaksi_periode_jurnal_detil as $rowambil_transaksi_periode_jurnal_detil){
							$tot_debet = $tot_debet + $rowambil_transaksi_periode_jurnal_detil['td_debet'];
							$tot_kredit = $tot_kredit + $rowambil_transaksi_periode_jurnal_detil['td_kredit'];								
							?>
							<tr>
							  <td style="vertical-align:middle;text-align:center;width:3%;">&nbsp;</td>
							  <td style="vertical-align:middle;text-align:left;width:10%;"><?php echo $rowambil_transaksi_periode_jurnal_detil['kode_coa']; ?></td>
							  <td style="vertical-align:middle;text-align:left;"><?php echo $rowambil_transaksi_periode_jurnal_detil['nama_coa']; ?></td>
							  <td style="vertical-align:middle;text-align:left;"><?php echo $rowambil_transaksi_periode_jurnal_detil['ket_transaksi_detil']; ?></td>
							  <td style="vertical-align:middle;text-align:right;"><?php echo number_format($rowambil_transaksi_periode_jurnal_detil['td_debet'],2); ?></td>
							  <td style="vertical-align:middle;text-align:right;"><?php echo number_format($rowambil_transaksi_periode_jurnal_detil['td_kredit'],2); ?></td>
							</tr>		
					  <?php
							}
					  ?>
							<tr>
							  <td colspan="4" style="vertical-align:middle;text-align:right;font-weight:bold;">Jumlah</td>
							  <td style="vertical-align:middle;text-align:right;font-weight:bold;"><?php echo number_format($tot_debet,2); ?></td>
							  <td style="vertical-align:middle;text-align:right;font-weight:bold;"><?php echo number_format($tot_kredit,2); ?></td>
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
        </div>
      </div>
    </section>
</div>
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
</style>
  <div class="content-wrapper">
    <section class="content-header">
						<a href="<?php echo $link_kembali;?>" 
							class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Laporan
						</a>	||
						<a href="<?php echo base_url('akunting');?>" 
							class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-money"></i> Akunting
						</a>	
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
			<?php echo form_open_multipart('laporan/transaksi/view/'.$first_date.'/'.$last_date,' id="signupform" '); ?>
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
						  <tr>
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
elseif ($page=="buku_besar")
{
?>

  <div class="content-wrapper">
    <section class="content-header">
						<a href="<?php echo $link_kembali;?>" 
							class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Laporan
						</a>	||
						<a href="<?php echo base_url('akunting');?>" 
							class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-money"></i> Akunting
						</a>	
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
			<?php echo form_open_multipart('laporan/'.$page.'/view/'.$first_date.'/'.$last_date.'/'.$id.'/'.$transaksix,' id="signupform" ');
			?>		
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
		<div class="box-header with-border">
			<button type="submit" name="action" value="BtnProses" class="btn btn-primary btn-xs pull-left"><i class="fa fa-recycle"></i> Proses</button>
		</div>
			  <div class="box-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
						  <label>NAMA COA</label>
								<?php
									input_pdselect2fleksibel("id","id",$cmd_opsi_keu_coa,"id_coa","nama_coa",$id,"Pilih Semua Akun Rekening / COA");
								?>	
						</div>					
					</div>				
					<div class="col-md-6">
						<div class="form-group">
						  <label>Pilih Transaksi</label>
								<?php
									input_pdselect2("transaksix",$cmd_semua_transaksi,$transaksix);
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
			<a href="<?php echo base_url('laporan/'.$page.'/pdf/'); ?><?php echo $first_date;?>/<?php echo $last_date;?>/<?php echo $id;?>/<?php echo $transaksix;?>" target="_blank" class="btn btn-white btn-md">
				<i class="fa fa-print"></i> PDF
			</a>
			||
			<a href="<?php echo base_url('laporan/'.$page.'/xls/'); ?><?php echo $first_date;?>/<?php echo $last_date;?>/<?php echo $id;?>/<?php echo $transaksix;?>" target="_blank" class="btn btn-white btn-md">
				<i class="fa fa-print"></i> Excell
			</a>
		</div>
			<div class="box-body">
			<?php					
				foreach($ambil_coa_periode as $rowambil_coa_periode){
					$ambil_sum_detil_periode = $this->m_akunting->ambil_sum_detil_periode($first_date,$last_date,$rowambil_coa_periode['id_coa']);
				?>		
			   <table id="example1" width="100%" class="table table-bordered table-striped">										
					<tr>
					  <td colspan="6" style="vertical-align:middle;text-align:left;font-weight:bold;">
					  <?php echo $rowambil_coa_periode['nama_coa']; ?>
					  </td>
					</tr>							
				</table>
				<table id="example1" width="100%" class="table table-bordered table-striped">
					<tr>
					  <td colspan="3" style="vertical-align:middle;text-align:left;font-weight:bold;">
					 Saldo Sebelum Tanggal <?php echo $first_date; ?>
					  </td>
					  <th style="vertical-align:middle;text-align:right;width:15%;font-weight:bold;"><?php // echo number_format($ambil_sum_detil_periode['debet'],2); ?></th>
					  <th style="vertical-align:middle;text-align:right;width:15%;font-weight:bold;"><?php // echo number_format($ambil_sum_detil_periode['kredit'],2); ?></th>
					  <td style="vertical-align:middle;text-align:right;width:15%;font-weight:bold;"><?php echo number_format($ambil_sum_detil_periode['total'],2); ?></td>
					</tr>
				</table>
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
									$ambil_detil_periode = $this->m_akunting->ambil_detil_periode($first_date,$last_date,$rowambil_coa_periode['id_coa']);
									$saldo = $ambil_sum_detil_periode['total'];$saldoall = 0;$saldodebet = 0;$saldokredit = 0;
									foreach($ambil_detil_periode as $rowambil_detil_periode){
										$saldodebet = $saldodebet + $rowambil_detil_periode['td_debet'];
										$saldokredit = $saldokredit + $rowambil_detil_periode['td_kredit'];
											$saldod = $ambil_sum_detil_periode['debet'] + $saldodebet;
											$saldok = $ambil_sum_detil_periode['kredit'] + $saldokredit;
											$saldo = $saldodebet - $saldokredit;
											$saldoall = $saldod - $saldok;
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
					  </tbody>
					  <tfoot>			
					  <td colspan="5" style="vertical-align:middle;text-align:left;font-weight:bold;">
					 Saldo Akhir
					  </td>
					  <td style="vertical-align:middle;text-align:right;width:15%;font-weight:bold;"><?php echo number_format($saldoall,2); ?></td>					  
					  </tfoot>
					</table> <br>
						<?php
				}
						?>
			</div>
			<div class="box-footer">

			</div>
		  </div>	
        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="neraca")
{
?>

  <div class="content-wrapper">
    <section class="content-header">
						<a href="<?php echo $link_kembali;?>" 
							class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Laporan
						</a>	||
						<a href="<?php echo base_url('akunting');?>" 
							class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-money"></i> Akunting
						</a>	
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
			<?php echo form_open_multipart('laporan/'.$page.'/view/'.$first_date,' id="signupform" ');
			?>		
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
		<div class="box-header with-border">
			<button type="submit" name="action" value="BtnProses" class="btn btn-primary btn-xs pull-left"><i class="fa fa-recycle"></i> Proses</button>
		</div>
			  <div class="box-body">
				<div class="row">				
					<div class="col-md-6">
						<div class="form-group">
						  <label>Per Tanggal</label>
								<?php
									input_calendar("first_date","first_date",$first_date,"Masukkan Tanggal Transaksi","required");
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
			<a href="<?php echo base_url('laporan/'.$page.'/pdf/'); ?><?php echo $first_date;?>" target="_blank" class="btn btn-white btn-md">
				<i class="fa fa-print"></i> PDF
			</a>
			||
			<a href="<?php echo base_url('laporan/'.$page.'/xls/'); ?><?php echo $first_date;?>" target="_blank" class="btn btn-white btn-md">
				<i class="fa fa-print"></i> Excell
			</a>
		</div>
			<div class="box-body">	
			   <table id="example1" width="100%" class="table table-bordered table-striped">
				<thead>
					<tr>
					  <th colspan="4" style="background-color: #800000;color: white;vertical-align:middle;text-align:left;">Keterangan</th>
					  <th style="background-color: #800000;color: white;vertical-align:middle;text-align:right;width:15%;">Saldo</th>
				  </tr>
				</thead>
				  <tbody>											
						  <tr>
							<td colspan="5" style="vertical-align:middle;text-align:left;font-weight:bold;">AKTIVA</td>
						  </tr>
					<?php	
						$tot_aktif = 0;
						foreach($ambil_aktiva as $rowambil_aktiva){
					?>						  
						  <tr>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;width:3%;">&nbsp;</td>
							<td colspan="4" style="vertical-align:middle;text-align:left;font-weight:bold;"><?php echo $rowambil_aktiva['nama_code']; ?></td>
						  </tr>
					<?php
							$jumlah_aktif = 0;
							$ambil_transaksi_aktiva_periode = $this->m_akunting->ambil_transaksi_aktiva_periode($first_date,$rowambil_aktiva['id_code']);
							foreach($ambil_transaksi_aktiva_periode as $rowambil_transaksi_aktiva_periode){
								$tot_aktif = $tot_aktif + $rowambil_transaksi_aktiva_periode['selisih'];
								$jumlah_aktif = $jumlah_aktif + $rowambil_transaksi_aktiva_periode['selisih'];
					?>
						  <tr>
							<td style="vertical-align:middle;text-align:left;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:left;width:3%;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:right;width:5%;"><?php echo $rowambil_transaksi_aktiva_periode['kode_coa']; ?></td>
							<td style="vertical-align:middle;text-align:left;"><?php echo $rowambil_transaksi_aktiva_periode['nama_coa']; ?></td>
							<td style="vertical-align:middle;text-align:right;"><?php echo number_format($rowambil_transaksi_aktiva_periode['selisih'],2); ?></td>
						  </tr> 								
					<?php
							}
					?>
						  <tr>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td colspan="3" style="vertical-align:middle;text-align:left;font-weight:bold;">JUMLAH <?php echo $rowambil_aktiva['nama_code']; ?></td>
							<td style="vertical-align:middle;text-align:right;font-weight:bold;"><?php echo number_format($jumlah_aktif,2); ?></td>
						  </tr>	
						  <tr>
							<td colspan="5" style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
						  </tr>						  
					<?php
						}
					?>		
						  <tr>
							<td colspan="4" style="vertical-align:middle;text-align:left;font-weight:bold;">TOTAL AKTIVA</td>
							<td style="vertical-align:middle;text-align:right;font-weight:bold;"><?php echo number_format($tot_aktif,2); ?></td>
						  </tr>					
						  <tr>
							<td colspan="5" style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
						  </tr>
						  <tr>
							<td colspan="5" style="vertical-align:middle;text-align:left;font-weight:bold;">PASSIVA</td>
						  </tr>
					<?php	
						$tot_pasif = 0;
						foreach($ambil_passiva as $rowambil_passiva){
					?>						  
						  <tr>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;width:3%;">&nbsp;</td>
							<td colspan="4" style="vertical-align:middle;text-align:left;font-weight:bold;"><?php echo $rowambil_passiva['nama_code']; ?></td>
						  </tr>
					<?php
							$jumlah_pasif = 0;
							$ambil_transaksi_passiva_periode = $this->m_akunting->ambil_transaksi_passiva_periode($first_date,$rowambil_passiva['id_code']);
							foreach($ambil_transaksi_passiva_periode as $rowambil_transaksi_passiva_periode){
								$tot_pasif = $tot_pasif + $rowambil_transaksi_passiva_periode['selisih'];
								$jumlah_pasif = $jumlah_pasif + $rowambil_transaksi_passiva_periode['selisih'];
					?>
						  <tr>
							<td style="vertical-align:middle;text-align:left;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:left;width:3%;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:right;width:5%;"><?php echo $rowambil_transaksi_passiva_periode['kode_coa']; ?></td>
							<td style="vertical-align:middle;text-align:left;"><?php echo $rowambil_transaksi_passiva_periode['nama_coa']; ?></td>
							<td style="vertical-align:middle;text-align:right;"><?php echo number_format($rowambil_transaksi_passiva_periode['selisih'],2); ?></td>
						  </tr> 
 								
					<?php
							}
					?>
						  <tr>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td colspan="3" style="vertical-align:middle;text-align:left;font-weight:bold;">JUMLAH <?php echo $rowambil_passiva['nama_code']; ?></td>
							<td style="vertical-align:middle;text-align:right;font-weight:bold;"><?php echo number_format($jumlah_pasif,2); ?></td>
						  </tr>			
						  <tr>
							<td colspan="5" style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
						  </tr>						  
					<?php
						}
					?>	
						  <tr>
							<td colspan="4" style="vertical-align:middle;text-align:left;font-weight:bold;">TOTAL PASSIVA</td>
							<td style="vertical-align:middle;text-align:right;font-weight:bold;"><?php echo number_format($tot_pasif,2); ?></td>
						  </tr>
				  </tbody>
				</table>
			</div>
			<div class="box-footer">

			</div>
		  </div>	
        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="rugi_laba")
{
?>

  <div class="content-wrapper">
    <section class="content-header">
						<a href="<?php echo $link_kembali;?>" 
							class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Laporan
						</a>	||
						<a href="<?php echo base_url('akunting');?>" 
							class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-money"></i> Akunting
						</a>	
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
			<?php echo form_open_multipart('laporan/'.$page.'/view/'.$first_date.'/'.$last_date,' id="signupform" ');
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
				</div>	
			  </div>
				<div class="box-footer">
				  <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
				</div>
				
		  </div>
			<?php echo form_close(); ?>
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
		<div class="box-header with-border">
			<a href="<?php echo base_url('laporan/'.$page.'/pdf/'); ?><?php echo $first_date;?>/<?php echo $last_date;?>" target="_blank" class="btn btn-white btn-md">
				<i class="fa fa-print"></i> PDF
			</a>
			||
			<a href="<?php echo base_url('laporan/'.$page.'/xls/'); ?><?php echo $first_date;?>/<?php echo $last_date;?>" target="_blank" class="btn btn-white btn-md">
				<i class="fa fa-print"></i> Excell
			</a>
		</div>
			<div class="box-body">	
			   <table id="example1" width="100%" class="table table-bordered table-striped">
				<thead>
					<tr>
					  <th colspan="3" style="background-color: #800000;color: white;vertical-align:middle;text-align:left;">Keterangan</th>
					  <th style="background-color: #800000;color: white;vertical-align:middle;text-align:right;width:15%;">Saldo</th>
					  <th style="background-color: #800000;color: white;vertical-align:middle;text-align:right;width:15%;">Jumlah</th>
					  <th style="background-color: #800000;color: white;vertical-align:middle;text-align:right;width:15%;">Total</th>
				  </tr>
				</thead>
				  <tbody>											
					<?php	
					$tot_biaya_lain = 0;
						foreach($ambil_pendapatan as $rowambil_pendapatan){
							$ambil_range_code_pendapatan = $this->m_akunting->ambil_range_code($rowambil_pendapatan['id_code'],$first_date,$last_date);
					?>						  
						  <tr>
							<td colspan="6" style="vertical-align:middle;text-align:left;font-weight:bold;"><?php echo $rowambil_pendapatan['nama_code']; ?></td>
						  </tr>
					<?php
							$tot_pendapatan = 0;
							foreach($ambil_range_code_pendapatan as $rowambil_range_code_pendapatan){
								$tot_pendapatan = $tot_pendapatan + $rowambil_range_code_pendapatan['selisih'];
					?>
						  <tr>
							<td style="vertical-align:middle;text-align:left;width:3%;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:right;width:5%;"><?php echo $rowambil_range_code_pendapatan['kode_coa']; ?></td>
							<td style="vertical-align:middle;text-align:left;"><?php echo $rowambil_range_code_pendapatan['nama_coa']; ?></td>
							<td style="vertical-align:middle;text-align:right;"><?php echo number_format($rowambil_range_code_pendapatan['selisih'],2); ?></td>
							<td style="vertical-align:middle;text-align:left;">&nbsp;</td> 
							<td style="vertical-align:middle;text-align:left;">&nbsp;</td> 
						 </tr> 								
					<?php
							}			
					?>
						  <tr>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td colspan="3" style="vertical-align:middle;text-align:left;font-weight:bold;">JUMLAH <?php echo $rowambil_pendapatan['nama_code']; ?></td>
							<td style="vertical-align:middle;text-align:right;font-weight:bold;"><?php echo number_format($tot_pendapatan,2); ?></td>
							<td style="vertical-align:middle;text-align:left;">&nbsp;</td>
						  </tr>			
						  <tr>
							<td colspan="6" style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
						  </tr>							
					<?php
						}							
						foreach($ambil_hpp as $rowambil_hpp){
							$ambil_range_code_hpp = $this->m_akunting->ambil_range_code($rowambil_hpp['id_code'],$first_date,$last_date);
					?>						  
						  <tr>
							<td colspan="6" style="vertical-align:middle;text-align:left;font-weight:bold;"><?php echo $rowambil_hpp['nama_code']; ?></td>
						  </tr>
					<?php
						$tot_hpp = 0;
							foreach($ambil_range_code_hpp as $rowambil_range_code_hpp){
								$tot_hpp = $tot_hpp + $rowambil_range_code_hpp['selisih'];
					?>
						  <tr>
							<td style="vertical-align:middle;text-align:left;width:3%;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:right;width:5%;"><?php echo $rowambil_range_code_hpp['kode_coa']; ?></td>
							<td style="vertical-align:middle;text-align:left;"><?php echo $rowambil_range_code_hpp['nama_coa']; ?></td>
							<td style="vertical-align:middle;text-align:right;"><?php echo number_format($rowambil_range_code_hpp['selisih'],2); ?></td>
							<td style="vertical-align:middle;text-align:left;">&nbsp;</td> 
							<td style="vertical-align:middle;text-align:left;">&nbsp;</td> 
						  </tr> 								
					<?php
							}		
					?>
						  <tr>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td colspan="3" style="vertical-align:middle;text-align:left;font-weight:bold;">JUMLAH <?php echo $rowambil_hpp['nama_code']; ?></td>
							<td style="vertical-align:middle;text-align:right;font-weight:bold;"><?php echo number_format($tot_hpp,2); ?></td>
							<td style="vertical-align:middle;text-align:left;">&nbsp;</td> 
						  </tr>			
						  <tr>
							<td colspan="6" style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
						  </tr>						
					<?php
						}
						$rugi_laba_kotor = $tot_pendapatan-$tot_hpp;
					?>
						  <tr>
							<td colspan="5" style="vertical-align:middle;text-align:left;font-weight:bold;">LABA / RUGI KOTOR</td>
							<td style="vertical-align:middle;text-align:right;font-weight:bold;"><?php echo number_format($rugi_laba_kotor,2); ?></td>
						  </tr>			
						  <tr>
							<td colspan="6" style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
						  </tr>	
					<?php
						foreach($ambil_biaya as $rowambil_biaya){
							$ambil_range_code_biaya = $this->m_akunting->ambil_range_code($rowambil_biaya['id_code'],$first_date,$last_date);
					?>						  
						  <tr>
							<td colspan="6" style="vertical-align:middle;text-align:left;font-weight:bold;"><?php echo $rowambil_biaya['nama_code']; ?></td>
						  </tr>
					<?php
						$tot_biaya = 0;
							foreach($ambil_range_code_biaya as $rowambil_range_code_biaya){
								$tot_biaya = $tot_biaya + $rowambil_range_code_biaya['selisih'];
					?>
						  <tr>
							<td style="vertical-align:middle;text-align:left;width:3%;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:right;width:5%;"><?php echo $rowambil_range_code_biaya['kode_coa']; ?></td>
							<td style="vertical-align:middle;text-align:left;"><?php echo $rowambil_range_code_biaya['nama_coa']; ?></td>
							<td style="vertical-align:middle;text-align:right;"><?php echo number_format($rowambil_range_code_biaya['selisih'],2); ?></td>
							<td style="vertical-align:middle;text-align:left;">&nbsp;</td> 
							<td style="vertical-align:middle;text-align:left;">&nbsp;</td> 
						  </tr> 								
					<?php
							}		
					?>
						  <tr>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td colspan="3" style="vertical-align:middle;text-align:left;font-weight:bold;">JUMLAH <?php echo $rowambil_biaya['nama_code']; ?></td>
							<td style="vertical-align:middle;text-align:right;font-weight:bold;"><?php echo number_format($tot_biaya,2); ?></td>
							<td style="vertical-align:middle;text-align:left;">&nbsp;</td> 
						  </tr>			
						  <tr>
							<td colspan="6" style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
						  </tr>						
					<?php
						}
						$rugi_laba_operasional = $rugi_laba_kotor - $tot_biaya;
					?>
						  <tr>
							<td colspan="5" style="vertical-align:middle;text-align:left;font-weight:bold;">LABA / RUGI BERSIH OPERASIONAL</td>
							<td style="vertical-align:middle;text-align:right;font-weight:bold;"><?php echo number_format($rugi_laba_operasional,2); ?></td>
						  </tr>			
						  <tr>
							<td colspan="6" style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
						  </tr>						
					<?php
						foreach($ambil_pendapatan_lain as $rowambil_pendapatan_lain){
							$ambil_range_code_pendapatan_lain = $this->m_akunting->ambil_range_code($rowambil_pendapatan_lain['id_code'],$first_date,$last_date);
					?>						  
						  <tr>
							<td colspan="6" style="vertical-align:middle;text-align:left;font-weight:bold;"><?php echo $rowambil_pendapatan_lain['nama_code']; ?></td>
						  </tr>
					<?php
						$tot_pendapatan_lain = 0;
							foreach($ambil_range_code_pendapatan_lain as $rowambil_range_code_pendapatan_lain){
								$tot_pendapatan_lain = $tot_pendapatan_lain + $rowambil_range_code_pendapatan_lain['selisih'];
					?>
						  <tr>
							<td style="vertical-align:middle;text-align:left;width:3%;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:right;width:5%;"><?php echo $rowambil_range_code_pendapatan_lain['kode_coa']; ?></td>
							<td style="vertical-align:middle;text-align:left;"><?php echo $rowambil_range_code_pendapatan_lain['nama_coa']; ?></td>
							<td style="vertical-align:middle;text-align:right;"><?php echo number_format($rowambil_range_code_pendapatan_lain['selisih'],2); ?></td>
							<td style="vertical-align:middle;text-align:left;">&nbsp;</td> 
							<td style="vertical-align:middle;text-align:left;">&nbsp;</td> 
						  </tr> 								
					<?php
							}		
					?>
						  <tr>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td colspan="3" style="vertical-align:middle;text-align:left;font-weight:bold;">JUMLAH <?php echo $rowambil_pendapatan_lain['nama_code']; ?></td>
							<td style="vertical-align:middle;text-align:right;font-weight:bold;"><?php echo number_format($tot_pendapatan_lain,2); ?></td>
							<td style="vertical-align:middle;text-align:left;">&nbsp;</td> 
						  </tr>			
						  <tr>
							<td colspan="6" style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
						  </tr>						
					<?php
						}
						$rlo_p_lain = $rugi_laba_operasional + $tot_pendapatan_lain;
						foreach($ambil_biaya_lainnya as $rowambil_biaya_lainnya){
							$ambil_range_code_biaya_lain = $this->m_akunting->ambil_range_code($rowambil_biaya_lainnya['id_code'],$first_date,$last_date);
					?>						  
						  <tr>
							<td colspan="6" style="vertical-align:middle;text-align:left;font-weight:bold;"><?php echo $rowambil_biaya_lainnya['nama_code']; ?></td>
						  </tr>
					<?php
						$tot_biaya_lain = 0;
							foreach($ambil_range_code_biaya_lain as $rowambil_range_code_biaya_lain){
								$tot_biaya_lain = $tot_biaya_lain + $rowambil_range_code_biaya_lain['selisih'];
					?>
						  <tr>
							<td style="vertical-align:middle;text-align:left;width:3%;">&nbsp;</td>
							<td style="vertical-align:middle;text-align:right;width:5%;"><?php echo $rowambil_range_code_biaya_lain['kode_coa']; ?></td>
							<td style="vertical-align:middle;text-align:left;"><?php echo $rowambil_range_code_biaya_lain['nama_coa']; ?></td>
							<td style="vertical-align:middle;text-align:right;"><?php echo number_format($rowambil_range_code_biaya_lain['selisih'],2); ?></td>
							<td style="vertical-align:middle;text-align:left;">&nbsp;</td> 
							<td style="vertical-align:middle;text-align:left;">&nbsp;</td> 
						  </tr> 								
					<?php
							}		
					?>
						  <tr>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td colspan="3" style="vertical-align:middle;text-align:left;font-weight:bold;">JUMLAH <?php echo $rowambil_biaya_lainnya['nama_code']; ?></td>
							<td style="vertical-align:middle;text-align:right;font-weight:bold;"><?php echo number_format($tot_biaya_lain,2); ?></td>
							<td style="vertical-align:middle;text-align:left;">&nbsp;</td> 
						  </tr>			
						  <tr>
							<td colspan="6" style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
						  </tr>						
					<?php
						}
						$laba_sebelum_pajak = $rlo_p_lain - $tot_biaya_lain;
					?>
						  <tr>
							<td colspan="5" style="vertical-align:middle;text-align:left;font-weight:bold;">LABA / RUGI SEBELUM PAJAK</td>
							<td style="vertical-align:middle;text-align:right;font-weight:bold;"><?php echo number_format($laba_sebelum_pajak,2); ?></td>
						  </tr>			
						  <tr>
							<td colspan="6" style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
						  </tr>	
				  </tbody>
				</table>
			</div>
			<div class="box-footer">

			</div>
		  </div>	
        </div>
      </div>
    </section>
</div>
<?php
}