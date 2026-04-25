<?php 
	$this->load->view('style');
	$adata = $this->m_umum->ambil_data('a_data','id_data','1');
	$fcolor = $adata['fcolor'];
	$color = $adata['color'];
	$ambil_transaksi_periode_jurnal = $this->m_akunting->ambil_transaksi_periode_jurnal($first_date,$last_date,$id,$id_jenis_jurnal);
?>
<div class="header-report">
	<h4 class="text-blue"><?php echo $instance_name; ?></h4>	
	<h4><?php echo $title; ?></h4>
	<span>Periode <?php echo $first_date; ?> s/d <?php echo $last_date; ?></span>
</div>
<div class="content-report">
				   <table class="table">
					<thead>
						<tr style="border: 1px solid black;">
						  <th colspan="2" style="background-color: <?php echo $fcolor; ?>;color: <?php echo $color; ?>;padding: 5px;font-size: 1em;vertical-align:middle;text-align:center;">Kode Rekening</th>
						  <th style="background-color: <?php echo $fcolor; ?>;color: <?php echo $color; ?>;padding: 5px;font-size: 1em;vertical-align:middle;text-align:center;">Akun / Tipe Rekening</th>
						  <th style="background-color: <?php echo $fcolor; ?>;color: <?php echo $color; ?>;padding: 5px;font-size: 1em;vertical-align:middle;text-align:center;">Catatan</th>
						  <th style="background-color: <?php echo $fcolor; ?>;color: <?php echo $color; ?>;padding: 5px;font-size: 1em;vertical-align:middle;text-align:center;width:19%;">Debet</th>
						  <th style="background-color: <?php echo $fcolor; ?>;color: <?php echo $color; ?>;padding: 5px;font-size: 1em;vertical-align:middle;text-align:center;width:19%;">Kredit</th>
					  </tr>
					</thead>
					  <tbody>
					  <?php
						foreach($ambil_transaksi_periode_jurnal as $rowambil_transaksi_periode_jurnal){
					  ?>
							<tr style="border: 1px solid black;">
							  <td colspan="2" style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:left;"><?php echo $rowambil_transaksi_periode_jurnal['uraian_detil']; ?></td>
							  <td style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:left;">Tanggal : <?php echo date('d-m-Y',strtotime($rowambil_transaksi_periode_jurnal['tgl_transaksi'])); ?></td>
							  <td colspan="3" style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:left;"><?php echo $rowambil_transaksi_periode_jurnal['ket_transaksi']; ?></td>
							</tr>
							<?php
						$ambil_transaksi_periode_jurnal_detil = $this->m_akunting->ambil_transaksi_periode_jurnal_detil($first_date,$last_date,$id,$id_jenis_jurnal,$rowambil_transaksi_periode_jurnal['id_transaksi']);
							$tot_debet = 0;$tot_kredit = 0;
							foreach($ambil_transaksi_periode_jurnal_detil as $rowambil_transaksi_periode_jurnal_detil){
							$tot_debet = $tot_debet + $rowambil_transaksi_periode_jurnal_detil['td_debet'];
							$tot_kredit = $tot_kredit + $rowambil_transaksi_periode_jurnal_detil['td_kredit'];								
							?>
							<tr style="border: 1px solid black;">
							  <td class="px-1" style="border-left: 1px solid black; padding: 5px;font-size: 1em;vertical-align:middle;text-align:right;width:3%;">&nbsp;</td>
							  <td class="px-1" style="border-right: 1px solid black; padding: 5px;font-size: 1em;vertical-align:middle;text-align:right;width:10%;"><?php echo $rowambil_transaksi_periode_jurnal_detil['kode_coa']; ?></td>
							  <td class="px-1" style="border-left: 1px solid black; border-right: 1px solid black; padding: 5px;font-size: 1em;vertical-align:middle;text-align:left;"><?php echo $rowambil_transaksi_periode_jurnal_detil['nama_coa']; ?></td>
							  <td class="px-1" style="border-left: 1px solid black; border-right: 1px solid black; padding: 5px;font-size: 1em;vertical-align:middle;text-align:left;"><?php echo $rowambil_transaksi_periode_jurnal_detil['ket_transaksi_detil']; ?></td>
							  <td class="px-1" style="border-left: 1px solid black; border-right: 1px solid black; padding: 5px;font-size: 1em;vertical-align:middle;text-align:right;"><?php echo number_format($rowambil_transaksi_periode_jurnal_detil['td_debet'],2); ?></td>
							  <td class="px-1" style="border-left: 1px solid black; border-right: 1px solid black; padding: 5px;font-size: 1em;vertical-align:middle;text-align:right;"><?php echo number_format($rowambil_transaksi_periode_jurnal_detil['td_kredit'],2); ?></td>
							</tr>		
					  <?php
							}
					  ?>
							<tr style="border: 1px solid black;">
							  <td colspan="4" style=" border-right: 1px solid black; padding: 5px;font-size: 1em;vertical-align:middle;text-align:right;font-weight:bold;">Jumlah</td>
							  <td style=" border-right: 1px solid black; padding: 5px;font-size: 1em;vertical-align:middle;text-align:right;font-weight:bold;"><?php echo number_format($tot_debet,2); ?></td>
							  <td style=" border-right: 1px solid black; padding: 5px;font-size: 1em;vertical-align:middle;text-align:right;font-weight:bold;"><?php echo number_format($tot_kredit,2); ?></td>
							</tr>				
							<tr>
							  <td colspan="6" style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:right;font-weight:bold;">&nbsp;</td>
							</tr>								
					  <?php
						}
					  ?>
					  </tbody>
					</table>
	<div class="clear">&nbsp;</div>
</div>