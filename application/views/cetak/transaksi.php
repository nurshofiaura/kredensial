<?php 
	$this->load->view('style');
	$adata = $this->m_umum->ambil_data('a_data','id_data','1');
	$fcolor = $adata['fcolor'];
	$color = $adata['color'];
	$detil = $this->m_akunting->ambil_transaksi($id_transaksi);
	$trdetil = $this->m_akunting->ambil_only_transaksi_detil($id_transaksi);
	if(empty($logo)){
		$url_thumb=base_url().'assets/images/noavatar.jpg';			
	}else{
		$cek_filesmall=FCPATH.'assets/foto/'.$logo;
		if(file_exists($cek_filesmall)){
			$url_thumb=base_url().'assets/foto/'.$logo;
		}else{
			$url_thumb=base_url().'assets/images/noavatar.jpg';
		}				
	}
	$terbilang = $this->m_rancak->terbilang(floatval($detil['total_transaksi']));
?>
<div class="header-report">
	<?php
	if(empty($logo)){
	?>
	<div class="center">	
		<h3 class="text-blue"><b><?= $instance_name; ?></b></h3>				
		<h5><?= $instance_address ?>, Email : <?= $instance_email ?>, Telp : <?= $instance_contact ?></h5>
	</div>
	<?php
	}else{
	?>
	<div class="logo left">	
		<img src="<?= $url_thumb ?>" width="80" height="80" />
	</div>
	<div class="left px-1" width="38%">
		<h3 class="text-blue"><b><?= $instance_name; ?></b></h3>				
		<h5><?= $instance_address ?>, Email : <?= $instance_email ?>, Telp : <?= $instance_contact ?></h5>		
	</div>
	<?php
	}
	?>
	<div class="right">
		<h3><b><?= $uraian_detil; ?></b></h3>	
		<div class="right py-2">
			<table class="table">
				<tbody>
					<tr>
						<td align="center" class="border-1 bg-dark">Nomor</td>
						<td width="10"></td>
						<td align="center" class="border-1 bg-dark">Tanggal</td>					
					</tr>
					<tr>
						<td align="center" class="border-1"><?= $detil['no_transaksi'] ?></td>
						<td>&nbsp;</td>
						<td align="center" class="border-1"><?= date('d-m-Y', strtotime($detil['tgl_transaksi'])) ?></td>												
					</tr>				
				</tbody>
			</table>
		</div>
	</div>
	<div class="line"></div>
	<div class="left">
		<table class="table" style="margin-top: 5px;">
			<tbody>
				<tr>
					<td class="border-1 px-1 bg-dark">Keterangan :</td>
				</tr>
				<tr>
					<td class="border-1 px-1"><?= $detil['ket_transaksi'] ?></td>
				</tr>				
				<tr>
					<td></td>
				</tr>
			</tbody>
		</table>					
		<table class="table" style="margin-top: 5px;">
			<tbody>
				<tr>
					<td class="border-1 px-1 bg-dark">Unit :</td>
					<td width="10"></td>
					<td class="border-1 px-1 bg-dark">Kreditur / Debitur :</td>
					<td width="10"></td>
					<td class="border-1 px-1 bg-dark">Jumlah :</td>					
				</tr>
				<tr>
					<td class="border-1 px-1"><?= $detil['nama_unit'] ?></td>
					<td>&nbsp;</td>					
					<td class="border-1 px-1"><?= $detil['nama_dk'] ?></td>
					<td>&nbsp;</td>
					<td class="border-1 px-1 right"><?= number_format($detil['total_transaksi'],2) ?></td>												
				</tr>				
			</tbody>
		</table>	
	</div>
</div>
<div class="content-report">
	<table class="table table-border">
		<thead>
			<tr class="bg-dark">
				<th class="left px-1" width="13%">Kode</th>				
				<th class="left px-1">Nama Akun</th>
				<th class="left px-1">Catatan</th>								
				<th class="right px-1" width="20%">Debit</th>
				<th class="right px-1" width="20%">Kredit</th>				
			</tr>
		</thead>
		<tbody>
			<? 
				$tot_debet = 0;$tot_kredit = 0;
				foreach ($trdetil as $rowtrdetil) { 
/* 				$tot_debet = $tot_debet +$rowtrdetil['td_debet'];
				$tot_kredit = $tot_kredit + $rowtrdetil['td_kredit']; */
				$tot_debet += $rowtrdetil['td_debet'];
				$tot_kredit += $rowtrdetil['td_kredit'];
			?>
			<tr>
				<td class="left px-1"><?= $rowtrdetil['kode_coa'] ?></td>				
				<td class="left px-1"><?= $rowtrdetil['nama_coa'] ?></td>
				<td class="left px-1"><?= $rowtrdetil['ket_transaksi_detil'] ?></td>
				<td class="right px-1"><?= number_format($rowtrdetil['td_debet'],2) ?></td>
				<td class="right px-1"><?= number_format($rowtrdetil['td_kredit'],2) ?></td>				
			</tr>
			<? 			
				} 
			?>
		</tbody>
		<tfoot>
			<tr class="bg-dark">
				<th colspan="3" class="right px-1">TOTAL</th>				
				<th class="right px-1"><?= number_format($tot_debet,2) ?></th>
				<th class="right px-1"><?= number_format($tot_kredit,2) ?></th>					
			</tr>			
		</tfoot>
	</table>	
	<table class="table" style="margin-top: 20px;">
		<tbody>
			<tr>
				<td>Terbilang : <?= $terbilang; ?></td>
			</tr>
			<tr>
				<td></td>
			</tr>
		</tbody>
	</table>
	<table class="table" style="margin-top: 20px; width: 50%">
		<tbody>
			<tr>
				<td>Dibuat :</td>
				<td width="10"></td>
				<td>Disetujui :</td>					
			</tr>
			<tr>
				<td align="center" class="py-4 border-bottom-1"></td>
				<td width="10" class="py-4"></td>
				<td align="center" class="py-4 border-bottom-1"></td>									
			</tr>
		</tbody>
	</table>							
</div>