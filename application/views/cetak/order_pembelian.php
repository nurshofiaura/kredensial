<?php 
	$this->load->view('style');
	$adata = $this->m_umum->ambil_data('a_data','id_data','1');
	$fcolor = $adata['fcolor'];
	$color = $adata['color'];
	$detil = $this->m_akunting->ambil_keu_order_beli($id_order_beli);
	$trdetil = $this->m_akunting->ambil_only_ob_detil($id_order_beli);
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
	$terbilang = $this->m_rancak->terbilang(floatval($detil['total_order_beli']));
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
		<h3><?= $title; ?></h3>		
		<div class="right py-2">
			<table class="table">
				<tbody>
					<tr>
						<td align="center" class="border-1 bg-dark">Nomor</td>
						<td width="10"></td>
						<td align="center" class="border-1 bg-dark">Tanggal</td>					
					</tr>
					<tr>
						<td align="center" class="border-1"><?= $detil['no_order_beli'] ?></td>
						<td>&nbsp;</td>
						<td align="center" class="border-1"><?= date('d-m-Y', strtotime($detil['tgl_order_beli'])) ?></td>												
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
					<td align="center" class="border-1 bg-dark" width="50%">Supplier :</td>
					<td width="10"></td>
					<td align="center" class="border-1 bg-dark">Unit :</td>
				</tr>
				<tr>
					<td align="center" class="border-1 px-1"><?= $detil['nama_dk'] ?> &nbsp; <?= $detil['kontak'] ?></td>
					<td>&nbsp;</td>					
					<td class="border-1 px-1"><?= $detil['nama_unit'] ?></td>
				</tr>				
			</tbody>
		</table>	
		<table class="table" style="margin-top: 5px;">
			<tbody>
				<tr>
					<td align="center" class="border-1 bg-dark" width="50%">Alamat :</td>
					<td width="10"></td>					
					<td align="center" class="border-1 bg-dark">Termin :</td>
					<td width="10"></td>	
					<td align="center" class="border-1 bg-dark">Pajak :</td>					
				</tr>
				<tr>
					<td class="border-1 px-1 py-1"><?= $detil['alamat'] ?></td>
					<td>&nbsp;</td>
					<td class="border-1 px-1 py-1"><?= $detil['nama_termin'] ?></td>	
					<td>&nbsp;</td>
					<td class="border-1 px-1 py-1"><?= $detil['pajak'] ?></td>					
				</tr>				
				<tr>
					<td></td>
				</tr>
			</tbody>
		</table>	
	</div>
</div>
<div class="content-report">
	<table class="table table-border">
		<thead>
			<tr class="bg-dark">			
				<th align="center" width="15%">Kode</th>				
				<th align="center">Nama Barang</th>
				<th align="center" width="10%">Qty</th>
				<th align="center" width="20%">Harga</th>
				<th align="center" width="15%">Disc</th>
				<th align="center" width="20%">Jumlah</th>								
			</tr>
		</thead>
		<tbody>
			<?
				$subtotal = 0;
			    foreach ($trdetil as $rowtrdetil) { 
				$jph = $rowtrdetil['jml_ob_detil'] * $rowtrdetil['harga_ob_detil'];
				if($rowtrdetil['diskon_ob_detil'] > 0){
					$disko = $rowtrdetil['diskon_ob_detil'];
					$jphkd = $jph - $disko;
				}elseif($rowtrdetil['persen_ob_detil'] > 0){
					$disko = $rowtrdetil['persen_ob_detil'];
					$diskone = $jph * $disko / 100;
					$jphkd = $jph - $diskone;
				}else{
					$disko = '0';
					$jphkd= $jph;
				}			
				$subtotal = $subtotal + $jphkd;
				if ($detil['pajak'] == 'Tanpa Pajak') { //tanpa
					$pajake = 0;
				}else if($detil['pajak'] == 'Sudah Termasuk Pajak') {  //belum tpph22 = Math.floor((tpph22*100)/100);
					$sebtotal = $subtotal * 100 / 110;			
					$pajake = 10/100 * $sebtotal;			
				}else{
					$pajake = $subtotal * 10 / 110;	
				}
				$total = $subtotal - $pajake;
			?>
				<tr>
					<td class="left px-1 py-1"><?= $rowtrdetil['kode_barang'] ?></td>	
					<td class="left px-1 py-1"><?= $rowtrdetil['nama_barang'] ?></td>
					<td class="right px-1 py-1"><?= $rowtrdetil['jml_ob_detil'].' '.$rowtrdetil['nama_satuan'] ?></td>							
					<td class="right px-1 py-1"><?= number_format($rowtrdetil['harga_ob_detil'],0) ?></td>
					<td class="right px-1 py-1"><?= number_format($disko,0) ?></td>
					<td class="right px-1 py-1"><?= number_format($jphkd,0) ?></td>
				</tr>
			<?
				}
			?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="4" rowspan="3" class="left py-1" style="vertical-align: middle;">Terbilang : <br><?= $terbilang; ?></td>
				<th class="right px-1 py-1">Sub Total</th>
				<th class="right px-1 py-1"><?= number_format($subtotal,0) ?></th>				
			</tr>					
			<tr>
				<th class="right px-1 py-1">Pajak</th>
				<th class="right px-1 py-1"><?= number_format($pajake,0) ?></th>				
			</tr>							
			<tr>
				<th class="right px-1 py-1">Total</th>
				<th class="right px-1 py-1"><?= number_format($total,0) ?></th>				
			</tr>											
		</tfoot>
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