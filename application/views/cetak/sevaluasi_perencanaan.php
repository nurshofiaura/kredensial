<?php 
	$this->load->view('style');
	$adata = $this->m_umum->ambil_data('a_data','id_data','1');
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','3');
	$injabdet = $this->m_sample->ambil_all_abk_pola($id);
	$thn0 = $this->m_sample->ambil_thn_pemenuhan($id);
	$thn1 = $this->m_sample->ambil_thn_pemenuhan($id+1);
	$thn2 = $this->m_sample->ambil_thn_pemenuhan($id+2);
	if(empty($thn0['jml_pemenuhan'])){ $prsn0 = '0'; }else{ $prsn0 = $thn0['jml_realisasi'] / $thn0['jml_pemenuhan'] * 100;}
		if(empty($thn1['jml_pemenuhan'])){ $prsn1 = '0'; }else{ $prsn1 = $thn1['jml_realisasi'] / $thn1['jml_pemenuhan'] * 100;}
			if(empty($thn2['jml_pemenuhan'])){ $prsn2 = '0'; }else{ $prsn2 = $thn2['jml_realisasi'] / $thn2['jml_pemenuhan'] * 100;}
?>
<table class="asktable" width="100%">
	<tbody>
		<tr>
			<td class="px-1 py-1" style="text-align:center;"><h3><b>EVALUASI PERENCANAAN</b></h3></td>
		</tr>
		<tr>
			<td class="px-1 py-1" style="text-align:center;">&nbsp;</td>
		</tr>
	</tbody>
</table>
<table width="100%" class="table table-border" style="font-size: 0.8em;">
<thead>
  <tr class="bg-dark px-1 py-1">
    <th rowspan="2" style="border-color: black;text-align:center;vertical-align:middle;width:3%;">No</th>
    <th rowspan="2" style="border-color: black;text-align:center;vertical-align:middle;width:10%;">NAMA JABATAN</th>
    <th colspan="4" style="border-color: black;text-align:center;vertical-align:middle;">KETERSEDIAAN TENAGA</th>
    <th colspan="3" style="border-color: black;text-align:center;vertical-align:middle;">RENCANA PEMENUHAN KEKURANGAN</th>
    <th colspan="3" style="border-color: black;text-align:center;vertical-align:middle;">EVALUASI PERENCANAAN</th>
    <th colspan="3" style="border-color: black;text-align:center;vertical-align:middle;">PERSENTASI TINGKAT PEMENUHAN RENCANA</th>
  </tr>
  <tr class="bg-dark  px-1 py-1">
    <th colspan="2" class="px-1 py-1" style="border-color: black;text-align:center;vertical-align:middle;width:10%;">KETERSEDIAAN</th>
    <th class="px-1 py-1" style="border-color: black;text-align:center;vertical-align:middle;width:7%;">KEBUTUHAN</th>
    <th class="px-1 py-1" style="border-color: black;text-align:center;vertical-align:middle;width:7%;">KELEBIHAN</th>
    <th class="px-1 py-1" style="border-color: black;text-align:center;vertical-align:middle;width:7%;"><?php echo $id; ?></th>
    <th class="px-1 py-1" style="border-color: black;text-align:center;vertical-align:middle;width:7%;"><?php echo $id+1; ?></th>
    <th class="px-1 py-1" style="border-color: black;text-align:center;vertical-align:middle;width:7%;"><?php echo $id+2; ?></th>
    <th class="px-1 py-1" style="border-color: black;text-align:center;vertical-align:middle;width:7%;"><?php echo $id; ?></th>
    <th class="px-1 py-1" style="border-color: black;text-align:center;vertical-align:middle;width:7%;"><?php echo $id+1; ?></th>
    <th class="px-1 py-1" style="border-color: black;text-align:center;vertical-align:middle;width:7%;"><?php echo $id+2; ?></th>
    <th class="px-1 py-1" style="border-color: black;text-align:center;vertical-align:middle;width:7%;"><?php echo $id; ?></th>
    <th class="px-1 py-1" style="border-color: black;text-align:center;vertical-align:middle;width:7%;"><?php echo $id+1; ?></th>
    <th class="px-1 py-1" style="border-color: black;text-align:center;vertical-align:middle;width:7%;"><?php echo $id+2; ?></th>
  </tr>
</thead>
<tbody>
<?php						
	$noa = 0;$allpns = 0;$allcpns = 0;$allblud = 0;$allcpb = 0;$totale = 0;
	foreach($injabdet as $rowinjabdet){			
	$noa++;
	$totale = $rowinjabdet['pns'] + $rowinjabdet['cpns'] + $rowinjabdet['blud'];
	$allpns = $allpns + $rowinjabdet['pns'];
	$allcpns = $allcpns + $rowinjabdet['cpns'];
	$allblud = $allblud + $rowinjabdet['blud'];
	$allcpb = $allpns + $allcpns + $allblud;	
?>
  <tr>
    <td class="px-1 py-1" style="border-color: black;text-align:center;vertical-align:middle;"><?= $noa ?></td>
    <td class="px-1 py-1" style="border-color: black;text-align:left;vertical-align:middle;"><?= $rowinjabdet['nama_jabatan_fungsional'] ?></td>
    <td class="px-1 py-1" style="border-color: black;text-align:center;vertical-align:bottom;line-height:1.6;width:5%;">
	CPNS : <?= $allcpns ?><br>
	PNS : <?= $allpns ?><br>
	BLUD : <?= $allblud ?>
	</td>	
	<td class="px-1 py-1" style="border-color: black;text-align:center;vertical-align:middle;width:4%;"><?= $totale ?></td>
    <td class="px-1 py-1" style="border-color: black;text-align:center;vertical-align:middle;width:7%;"><?= $rowinjabdet['total'] ?></td>
    <td class="px-1 py-1" style="border-color: black;text-align:center;vertical-align:middle;width:7%;"><?= $rowinjabdet['average'] ?></td>	
    <td class="px-1 py-1" style="border-color: black;text-align:center;vertical-align:middle;width:7%;">
	<?php
	echo $thn0['jml_pemenuhan'];
	?>
	</td>
    <td class="px-1 py-1" style="border-color: black;text-align:center;vertical-align:middle;width:7%;">
	<?php
	echo $thn1['jml_pemenuhan'];
	?>	
	</td>
    <td class="px-1 py-1" style="border-color: black;text-align:center;vertical-align:middle;width:7%;">
	<?php
	echo $thn2['jml_pemenuhan'];
	?>	
	</td>
    <td class="px-1 py-1" style="border-color: black;text-align:center;vertical-align:middle;width:7%;">
	<?php
	echo $thn0['jml_realisasi'];
	?>
	</td>
    <td class="px-1 py-1" style="border-color: black;text-align:center;vertical-align:middle;width:7%;">
	<?php
	echo $thn1['jml_realisasi'];
	?>	
	</td>
    <td class="px-1 py-1" style="border-color: black;text-align:center;vertical-align:middle;width:7%;">
	<?php
	echo $thn2['jml_realisasi'];
	?>	
	</td>
    <td class="px-1 py-1" style="border-color: black;text-align:center;vertical-align:middle;width:7%;">
	<?php
	echo round($prsn0,1);
	?> %
	</td>
    <td class="px-1 py-1" style="border-color: black;text-align:center;vertical-align:middle;width:7%;">
	<?php
	echo round($prsn1,1);
	?>	%
	</td>
    <td class="px-1 py-1" style="border-color: black;text-align:center;vertical-align:middle;width:7%;">
	<?php
	echo round($prsn2,1);
	?>	%
	</td>
  </tr> 
<?php
	}
?>   
</tbody>
</table>