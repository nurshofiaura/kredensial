<?php 
	$this->load->view('style');
	$adata = $this->m_umum->ambil_data('a_data','id_data','1');
	$fcolor = $adata['fcolor'];
	$color = $adata['color'];
	$ambil_aktiva   = $this->m_akunting->ambil_aktiva();
	$ambil_passiva   = $this->m_akunting->ambil_passiva();
?>
<div class="header-report">
	<h4 class="text-blue"><?php echo $instance_name; ?></h4>	
	<h4><?php echo $title; ?></h4>
	<span>Per Tanggal : <?php echo $first_date; ?></span>
</div>
<div class="content-report">
			   <table class="table">
				<thead>
					<tr>
					  <th colspan="4" style="background-color: <?php echo $fcolor; ?>;color: <?php echo $color; ?>;padding: 5px;font-size: 1em;vertical-align:middle;text-align:left;">Keterangan</th>
					  <th style="background-color: <?php echo $fcolor; ?>;color: <?php echo $color; ?>;padding: 5px;font-size: 1em;vertical-align:middle;text-align:right;width:15%;">Saldo</th>
				  </tr>
				</thead>
				  <tbody>											
						  <tr>
							<td colspan="5" style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:left;font-weight:bold;">AKTIVA</td>
						  </tr>
					<?php	
						$tot_aktif = 0;
						foreach($ambil_aktiva as $rowambil_aktiva){
					?>						  
						  <tr>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;width:3%;">&nbsp;</td>
							<td colspan="4" style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:left;font-weight:bold;"><?php echo $rowambil_aktiva['nama_code']; ?></td>
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
							<td style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:right;width:10%;"><?php echo $rowambil_transaksi_aktiva_periode['kode_coa']; ?></td>
							<td style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:left;"><?php echo $rowambil_transaksi_aktiva_periode['nama_coa']; ?></td>
							<td style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:right;"><?php echo number_format($rowambil_transaksi_aktiva_periode['selisih'],2); ?></td>
						  </tr> 								
					<?php
							}
					?>
						  <tr>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td colspan="3" style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:left;font-weight:bold;">JUMLAH <?php echo $rowambil_aktiva['nama_code']; ?></td>
							<td style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:right;font-weight:bold;"><?php echo number_format($jumlah_aktif,2); ?></td>
						  </tr>	
						  <tr>
							<td colspan="5" style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
						  </tr>						  
					<?php
						}
					?>		
						  <tr>
							<td colspan="4" style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:left;font-weight:bold;">TOTAL AKTIVA</td>
							<td style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:right;font-weight:bold;"><?php echo number_format($tot_aktif,2); ?></td>
						  </tr>					
						  <tr>
							<td colspan="5" style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
						  </tr>
						  <tr>
							<td colspan="5" style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:left;font-weight:bold;">PASSIVA</td>
						  </tr>
					<?php	
						$tot_pasif = 0;
						foreach($ambil_passiva as $rowambil_passiva){
					?>						  
						  <tr>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;width:3%;">&nbsp;</td>
							<td colspan="4" style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:left;font-weight:bold;"><?php echo $rowambil_passiva['nama_code']; ?></td>
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
							<td style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:right;width:10%;"><?php echo $rowambil_transaksi_passiva_periode['kode_coa']; ?></td>
							<td style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:left;"><?php echo $rowambil_transaksi_passiva_periode['nama_coa']; ?></td>
							<td style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:right;"><?php echo number_format($rowambil_transaksi_passiva_periode['selisih'],2); ?></td>
						  </tr> 
 								
					<?php
							}
					?>
						  <tr>
							<td style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td colspan="3" style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:left;font-weight:bold;">JUMLAH <?php echo $rowambil_passiva['nama_code']; ?></td>
							<td style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:right;font-weight:bold;"><?php echo number_format($jumlah_pasif,2); ?></td>
						  </tr>			
						  <tr>
							<td colspan="5" style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
						  </tr>						  
					<?php
						}
					?>	
						  <tr>
							<td colspan="4" style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:left;font-weight:bold;">TOTAL PASSIVA</td>
							<td style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:right;font-weight:bold;"><?php echo number_format($tot_pasif,2); ?></td>
						  </tr>
				  </tbody>
				</table>
	<div class="clear">&nbsp;</div>
</div>