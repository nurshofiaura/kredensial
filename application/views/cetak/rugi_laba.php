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
					  <th colspan="3" style="background-color: <?php echo $fcolor; ?>;color: <?php echo $color; ?>;padding: 5px;font-size: 0.8em;padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;">Keterangan</th>
					  <th style="background-color: <?php echo $fcolor; ?>;color: <?php echo $color; ?>;padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:right;width:15%;">Saldo</th>
					  <th style="background-color: <?php echo $fcolor; ?>;color: <?php echo $color; ?>;padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:right;width:15%;">Jumlah</th>
					  <th style="background-color: <?php echo $fcolor; ?>;color: <?php echo $color; ?>;padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:right;width:15%;">Total</th>
				  </tr>
				</thead>
				  <tbody>											
					<?php	
						foreach($ambil_pendapatan as $rowambil_pendapatan){
							$ambil_range_code_pendapatan = $this->m_akunting->ambil_range_code($rowambil_pendapatan['id_code'],$first_date,$last_date);
					?>						  
						  <tr>
							<td colspan="6" style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;font-weight:bold;"><?php echo $rowambil_pendapatan['nama_code']; ?></td>
						  </tr>
					<?php
							$tot_pendapatan = 0;
							foreach($ambil_range_code_pendapatan as $rowambil_range_code_pendapatan){
								$tot_pendapatan = $tot_pendapatan + $rowambil_range_code_pendapatan['selisih'];
					?>
						  <tr>
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;width:3%;">&nbsp;</td>
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:right;width:10%;"><?php echo $rowambil_range_code_pendapatan['kode_coa']; ?></td>
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;"><?php echo $rowambil_range_code_pendapatan['nama_coa']; ?></td>
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:right;"><?php echo number_format($rowambil_range_code_pendapatan['selisih'],2); ?></td>
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;">&nbsp;</td> 
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;">&nbsp;</td> 
						 </tr> 								
					<?php
							}			
					?>
						  <tr>
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td colspan="3" style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;font-weight:bold;">JUMLAH <?php echo $rowambil_pendapatan['nama_code']; ?></td>
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:right;font-weight:bold;"><?php echo number_format($tot_pendapatan,2); ?></td>
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;">&nbsp;</td>
						  </tr>			
						  <tr>
							<td colspan="6" style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
						  </tr>							
					<?php
						}							
						foreach($ambil_hpp as $rowambil_hpp){
							$ambil_range_code_hpp = $this->m_akunting->ambil_range_code($rowambil_hpp['id_code'],$first_date,$last_date);
					?>						  
						  <tr>
							<td colspan="6" style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;font-weight:bold;"><?php echo $rowambil_hpp['nama_code']; ?></td>
						  </tr>
					<?php
						$tot_hpp = 0;
							foreach($ambil_range_code_hpp as $rowambil_range_code_hpp){
								$tot_hpp = $tot_hpp + $rowambil_range_code_hpp['selisih'];
					?>
						  <tr>
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;width:3%;">&nbsp;</td>
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:right;width:10%;"><?php echo $rowambil_range_code_hpp['kode_coa']; ?></td>
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;"><?php echo $rowambil_range_code_hpp['nama_coa']; ?></td>
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:right;"><?php echo number_format($rowambil_range_code_hpp['selisih'],2); ?></td>
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;">&nbsp;</td> 
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;">&nbsp;</td> 
						  </tr> 								
					<?php
							}		
					?>
						  <tr>
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td colspan="3" style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;font-weight:bold;">JUMLAH <?php echo $rowambil_hpp['nama_code']; ?></td>
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:right;font-weight:bold;"><?php echo number_format($tot_hpp,2); ?></td>
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;">&nbsp;</td> 
						  </tr>			
						  <tr>
							<td colspan="6" style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
						  </tr>						
					<?php
						}
						$rugi_laba_kotor = $tot_pendapatan-$tot_hpp;
					?>
						  <tr>
							<td colspan="5" style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;font-weight:bold;">LABA / RUGI KOTOR</td>
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:right;font-weight:bold;"><?php echo number_format($rugi_laba_kotor,2); ?></td>
						  </tr>			
						  <tr>
							<td colspan="6" style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
						  </tr>	
					<?php
						foreach($ambil_biaya as $rowambil_biaya){
							$ambil_range_code_biaya = $this->m_akunting->ambil_range_code($rowambil_biaya['id_code'],$first_date,$last_date);
					?>						  
						  <tr>
							<td colspan="6" style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;font-weight:bold;"><?php echo $rowambil_biaya['nama_code']; ?></td>
						  </tr>
					<?php
						$tot_biaya = 0;
							foreach($ambil_range_code_biaya as $rowambil_range_code_biaya){
								$tot_biaya = $tot_biaya + $rowambil_range_code_biaya['selisih'];
					?>
						  <tr>
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;width:3%;">&nbsp;</td>
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:right;width:10%;"><?php echo $rowambil_range_code_biaya['kode_coa']; ?></td>
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;"><?php echo $rowambil_range_code_biaya['nama_coa']; ?></td>
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:right;"><?php echo number_format($rowambil_range_code_biaya['selisih'],2); ?></td>
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;">&nbsp;</td> 
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;">&nbsp;</td> 
						  </tr> 								
					<?php
							}		
					?>
						  <tr>
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td colspan="3" style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;font-weight:bold;">JUMLAH <?php echo $rowambil_biaya['nama_code']; ?></td>
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:right;font-weight:bold;"><?php echo number_format($tot_biaya,2); ?></td>
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;">&nbsp;</td> 
						  </tr>			
						  <tr>
							<td colspan="6" style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
						  </tr>						
					<?php
						}
						$rugi_laba_operasional = $rugi_laba_kotor - $tot_biaya;
					?>
						  <tr>
							<td colspan="5" style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;font-weight:bold;">LABA / RUGI BERSIH OPERASIONAL</td>
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:right;font-weight:bold;"><?php echo number_format($rugi_laba_operasional,2); ?></td>
						  </tr>			
						  <tr>
							<td colspan="6" style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
						  </tr>						
					<?php
						foreach($ambil_pendapatan_lain as $rowambil_pendapatan_lain){
							$ambil_range_code_pendapatan_lain = $this->m_akunting->ambil_range_code($rowambil_pendapatan_lain['id_code'],$first_date,$last_date);
					?>						  
						  <tr>
							<td colspan="6" style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;font-weight:bold;"><?php echo $rowambil_pendapatan_lain['nama_code']; ?></td>
						  </tr>
					<?php
						$tot_pendapatan_lain = 0;
							foreach($ambil_range_code_pendapatan_lain as $rowambil_range_code_pendapatan_lain){
								$tot_pendapatan_lain = $tot_pendapatan_lain + $rowambil_range_code_pendapatan_lain['selisih'];
					?>
						  <tr>
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;width:3%;">&nbsp;</td>
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:right;width:10%;"><?php echo $rowambil_range_code_pendapatan_lain['kode_coa']; ?></td>
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;"><?php echo $rowambil_range_code_pendapatan_lain['nama_coa']; ?></td>
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:right;"><?php echo number_format($rowambil_range_code_pendapatan_lain['selisih'],2); ?></td>
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;">&nbsp;</td> 
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;">&nbsp;</td> 
						  </tr> 								
					<?php
							}		
					?>
						  <tr>
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td colspan="3" style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;font-weight:bold;">JUMLAH <?php echo $rowambil_pendapatan_lain['nama_code']; ?></td>
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:right;font-weight:bold;"><?php echo number_format($tot_pendapatan_lain,2); ?></td>
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;">&nbsp;</td> 
						  </tr>			
						  <tr>
							<td colspan="6" style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
						  </tr>						
					<?php
						}
						$rlo_p_lain = $rugi_laba_operasional + $tot_pendapatan_lain;
						foreach($ambil_biaya_lainnya as $rowambil_biaya_lainnya){
							$ambil_range_code_biaya_lain = $this->m_akunting->ambil_range_code($rowambil_biaya_lainnya['id_code'],$first_date,$last_date);
					?>						  
						  <tr>
							<td colspan="6" style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;font-weight:bold;"><?php echo $rowambil_biaya_lainnya['nama_code']; ?></td>
						  </tr>
					<?php
						$tot_biaya_lain = 0;
							foreach($ambil_range_code_biaya_lain as $rowambil_range_code_biaya_lain){
								$tot_biaya_lain = $tot_biaya_lain + $rowambil_range_code_biaya_lain['selisih'];
					?>
						  <tr>
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;width:3%;">&nbsp;</td>
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:right;width:10%;"><?php echo $rowambil_range_code_biaya_lain['kode_coa']; ?></td>
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;"><?php echo $rowambil_range_code_biaya_lain['nama_coa']; ?></td>
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:right;"><?php echo number_format($rowambil_range_code_biaya_lain['selisih'],2); ?></td>
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;">&nbsp;</td> 
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;">&nbsp;</td> 
						  </tr> 								
					<?php
							}		
					?>
						  <tr>
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
							<td colspan="3" style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;font-weight:bold;">JUMLAH <?php echo $rowambil_biaya_lainnya['nama_code']; ?></td>
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:right;font-weight:bold;"><?php echo number_format($tot_biaya_lain,2); ?></td>
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;">&nbsp;</td> 
						  </tr>			
						  <tr>
							<td colspan="6" style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
						  </tr>						
					<?php
						}
						$laba_sebelum_pajak = $rlo_p_lain - $tot_biaya_lain;
					?>
						  <tr>
							<td colspan="5" style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;font-weight:bold;">LABA / RUGI SEBELUM PAJAK</td>
							<td style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:right;font-weight:bold;"><?php echo number_format($laba_sebelum_pajak,2); ?></td>
						  </tr>			
						  <tr>
							<td colspan="6" style="padding: 5px;font-size: 0.8em;vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
						  </tr>	
				  </tbody>
				</table>
	<div class="clear">&nbsp;</div>
</div>