<?php 
	$this->load->view('style');
	$adata = $this->m_umum->ambil_data('a_data','id_data','1');
//	$injabdet = $this->m_anjababk->ambil_all_abk_pola($id);
	$injabdet = $this->m_anjababk->ambil_all_abk_pola($id);
	$injabdetx = $this->m_anjababk->ambil_injab_detil($id);
	$perid = date('Y', strtotime($injabdetx['periode']));
	$thn0 = $this->m_anjababk->ambil_thn_pemenuhan($this->session->unit,$perid+1);
	$thn1 = $this->m_anjababk->ambil_thn_pemenuhan($this->session->unit,$perid+2);
	$thn2 = $this->m_anjababk->ambil_thn_pemenuhan($this->session->unit,$perid+3);
?>
<table class="asktable" width="100%">
	<thead>
		<tr>
			<th class="px-1 py-1" style="text-align:center;"><h3><b><?= $injabdetx['header_pemenuhan'] ?></b></h3></th>
		</tr>
		<tr>
			<th class="px-1 py-1" style="text-align:center;"><h3><b><?= $injabdetx['sub_header_pemenuhan'] ?></b></h3></th>
		</tr>
		<tr>
			<th class="px-1 py-1" style="text-align:center;"><h3><b><?= $injabdetx['sub_sub_header_pemenuhan'] ?></b></h3></th>
		</tr>
	</thead>
</table>
<br style="margin-top:10px; line-height:22px;">
<table width="100%" class="table table-border" style="font-size: 0.8em;">
<thead>
  <tr class="bg-dark px-1 py-1">
    <th rowspan="2" style="border-color: black;text-align:center;vertical-align:middle;width:3%;">No</th>
    <th rowspan="2" style="border-color: black;text-align:center;vertical-align:middle;width:10%;">NAMA JABATAN</th>
    <th rowspan="2" style="border-color: black;text-align:center;vertical-align:middle;">SYARAT JABATAN</th>
    <th colspan="4" style="border-color: black;text-align:center;vertical-align:middle;">KETERSEDIAAN TENAGA</th>
    <th colspan="3" style="border-color: black;text-align:center;vertical-align:middle;">RENCANA PEMENUHAN KEKURANGAN</th>
  </tr>
  <tr class="bg-dark  px-1 py-1">
    <th colspan="2" class="px-1 py-1" style="border-color: black;text-align:center;vertical-align:middle;width:10%;">KETERSEDIAAN</th>
    <th class="px-1 py-1" style="border-color: black;text-align:center;vertical-align:middle;width:7%;">KEBUTUHAN</th>
    <th class="px-1 py-1" style="border-color: black;text-align:center;vertical-align:middle;width:7%;">KELEBIHAN</th>
    <th class="px-1 py-1" style="border-color: black;text-align:center;vertical-align:middle;width:7%;"><?php echo $perid+1; ?></th>
    <th class="px-1 py-1" style="border-color: black;text-align:center;vertical-align:middle;width:7%;"><?php echo $perid+2; ?></th>
    <th class="px-1 py-1" style="border-color: black;text-align:center;vertical-align:middle;width:7%;"><?php echo $perid+3; ?></th>
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
    <td class="px-1 py-1" style="border-color: black;text-align:left;vertical-align:middle;">
	<table width="100%" class="asktable" style="border-left:0;border-right:0;">
		<tbody>		
		<tr>
		  <td class="px-1 py-1" style="border-left:0;border-right:0;text-align:left;width:3%;" >a.</td>
		  <td class="px-1 py-1" style="border-left:0;border-right:0;text-align:left;width:15%;">Pendidikan Formal</td>
		  <td class="px-1 py-1" style="border-left:0;border-right:0;text-align:center;width:3%;" >:</td>
		  <td class="px-1 py-1" style="border-left:0;border-right:0;text-align:left;line-height:1.6;" >
			<?php 
			if(!empty($rowinjabdet['pendidikan_formal'])){
				$pendidikan_terpilih = $this->m_anjababk->pendidikan_terpilih($rowinjabdet['pendidikan_formal']);
				foreach($pendidikan_terpilih as $rowpendidikan){
			?>	
				<?= $rowpendidikan['nama_pendidikan'] ?><br>
			<?php	
				}
			}
			?>				  
		  </td>
		</tr>	
		<tr>
		  <td class="px-1 py-1" style="border-left:0;border-right:0;text-align:left;width:3%;" >b.</td>
		  <td class="px-1 py-1" style="border-left:0;border-right:0;text-align:left;width:15%;">Pelatihan/Kursus</td>
		  <td class="px-1 py-1" style="border-left:0;border-right:0;text-align:center;width:3%;" >:</td>
		  <td class="px-1 py-1" style="border-left:0;border-right:0;text-align:left;" >
		  	<?php 
		  	if(!empty($rowinjabdet['pelatihan'])){
		  	echo $rowinjabdet['pelatihan'];
		  	}
		  	?>
		  </td>
		</tr>			
		<tr>
		  <td class="px-1 py-1" style="border-left:0;border-right:0;text-align:left;width:3%;" >c.</td>
		  <td class="px-1 py-1" style="border-left:0;border-right:0;text-align:left;width:15%;">Pengalaman Kerja</td>
		  <td class="px-1 py-1" style="border-left:0;border-right:0;text-align:center;width:3%;" >:</td>
		  <td class="px-1 py-1" style="border-left:0;border-right:0;text-align:left;" >
		  	<?php 
		  	if(!empty($rowinjabdet['pengalaman'])){
		  	echo $rowinjabdet['pengalaman'];
		  	}
		  	?></td>
		</tr>				
		</tbody>		  
	</table>	
	</td>
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
	if(!empty($thn0['jml_pemenuhan'])){
	echo $thn0['jml_pemenuhan'];
	}else{ echo '0'; }
	?>
	</td>
    <td class="px-1 py-1" style="border-color: black;text-align:center;vertical-align:middle;width:7%;">
	<?php
	if(!empty($thn1['jml_pemenuhan'])){
	echo $thn1['jml_pemenuhan'];
	}else{ echo '0'; }
	?>	
	</td>
    <td class="px-1 py-1" style="border-color: black;text-align:center;vertical-align:middle;width:7%;">
	<?php
	if(!empty($rowinjabdet['jml_pemenuhan'])){
	echo $thn2['thn2'];
	}else{ echo '0'; }
	?>	
	</td>
  </tr> 
<?php
	}
?>   
</tbody>
</table>