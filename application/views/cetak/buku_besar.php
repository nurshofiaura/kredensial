<?php 
	$this->load->view('style');
	$adata = $this->m_umum->ambil_data('a_data','id_data','1');
	$fcolor = $adata['fcolor'];
	$color = $adata['color'];
	$ambil_coa_periode   = $this->m_akunting->ambil_coa_periode($first_date,$last_date,$id,$transaksix);
?>
<div class="header-report">
	<h4 class="text-blue"><?php echo $instance_name; ?></h4>	
	<h4><?php echo $title; ?></h4>
	<span>Periode : <?php echo $first_date; ?> s/d <?php echo $last_date; ?></span>
</div>
<div class="content-report">
	<?php					
		foreach($ambil_coa_periode as $rowambil_coa_periode){
			$ambil_sum_detil_periode = $this->m_akunting->ambil_sum_detil_periode($first_date,$last_date,$rowambil_coa_periode['id_coa']);
		?>		
	   <table class="table">										
			<tr>
			  <td colspan="6" style="vertical-align:middle;text-align:left;font-weight:bold;">
			  <?php echo $rowambil_coa_periode['nama_coa']; ?>
			  </td>
			</tr>							
		</table>
	   <table class="table">	
			<tr>
			  <td colspan="3" style="font-size: 0.8em;vertical-align:middle;text-align:left;font-weight:bold;">
			 Saldo Sebelum Tanggal <?php echo $first_date; ?>
			  </td>
			  <td style="font-size: 0.8em;vertical-align:middle;text-align:right;width:15%;font-weight:bold;"><?php // echo number_format($ambil_sum_detil_periode['debet'],2); ?></td>
			  <td style="font-size: 0.8em;vertical-align:middle;text-align:right;width:15%;font-weight:bold;"><?php // echo number_format($ambil_sum_detil_periode['kredit'],2); ?></td>
			  <td style="font-size: 0.8em;vertical-align:middle;text-align:right;width:15%;font-weight:bold;"><?php echo number_format($ambil_sum_detil_periode['total'],2); ?></td>
			</tr>	   					
		</table>		
		   <table class="table">
			<thead>
				<tr style="border: 1px solid black;">
				  <th style="background-color: <?php echo $fcolor; ?>;color: <?php echo $color; ?>;padding: 5px;font-size: 0.8em;border: 1px solid black;vertical-align:middle;text-align:center;width:10%;">Tanggal</th>
				  <th style="background-color: <?php echo $fcolor; ?>;color: <?php echo $color; ?>;padding: 5px;font-size: 0.8em;border: 1px solid black;vertical-align:middle;text-align:center;width:10%;">Nomor</th>
				  <th style="background-color: <?php echo $fcolor; ?>;color: <?php echo $color; ?>;padding: 5px;font-size: 0.8em;border: 1px solid black;vertical-align:middle;text-align:center;">Catatan</th>
				  <th style="background-color: <?php echo $fcolor; ?>;color: <?php echo $color; ?>;padding: 5px;font-size: 0.8em;border: 1px solid black;vertical-align:middle;text-align:center;width:15%;">Debet</th>
				  <th style="background-color: <?php echo $fcolor; ?>;color: <?php echo $color; ?>;padding: 5px;font-size: 0.8em;border: 1px solid black;vertical-align:middle;text-align:center;width:15%;">Kredit</th>
				  <th style="background-color: <?php echo $fcolor; ?>;color: <?php echo $color; ?>;padding: 5px;font-size: 0.8em;border: 1px solid black;vertical-align:middle;text-align:center;width:15%;">Saldo</th>
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
					<tr style=";border: 1px solid black;">
					  <td style="font-size: 0.8em;border: 1px solid black;vertical-align:middle;text-align:center;width:10%;"><?php echo date('d-m-Y',strtotime($rowambil_detil_periode['tgl_transaksi'])); ?></td>
					  <td style="font-size: 0.8em;border: 1px solid black;vertical-align:middle;text-align:center;width:10%;"><?php echo $rowambil_detil_periode['no_transaksi']; ?></td>
					  <td style="font-size: 0.8em;border: 1px solid black;vertical-align:middle;text-align:center;"><?php echo $rowambil_detil_periode['ket_transaksi_detil']; ?></td>
					  <td style="font-size: 0.8em;border: 1px solid black;vertical-align:middle;text-align:right;width:15%;"><?php echo number_format($rowambil_detil_periode['td_debet'],2); ?></td>
					  <td style="font-size: 0.8em;border: 1px solid black;vertical-align:middle;text-align:right;width:15%;"><?php echo number_format($rowambil_detil_periode['td_kredit'],2); ?></td>
					  <td style="font-size: 0.8em;border: 1px solid black;vertical-align:middle;text-align:right;width:15%;"><?php echo number_format($saldo,2); ?></td>
					</tr>								
						<?php
							}
					?>
			  </tbody>
			</table>
	   <table class="table">	   
			<tr>
			  <td colspan="5" style="font-size: 0.8em;vertical-align:middle;text-align:left;font-weight:bold;">
			 Saldo Akhir
			  </td>
			  <td style="font-size: 0.8em;vertical-align:middle;text-align:right;width:15%;font-weight:bold;">
			  <?php echo number_format($saldoall,2); ?>
			  </td>	
			</tr>					
		</table>		<br>		  
				<?php
		}
				?>
	<div class="clear">&nbsp;</div>
</div>