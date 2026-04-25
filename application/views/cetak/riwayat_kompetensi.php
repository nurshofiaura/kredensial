<?php 
	$this->load->view('style');
	$adata = $this->m_umum->ambil_data('a_data','id_data','1');
	$fcolor = $adata['fcolor'];
	$color = $adata['color'];		
	$ambil_data_kewenangan = $this->m_berkas->ambil_data_kewenangan($id_pegawai,$id_kewenangan);
	$member = $this->m_umum->ambil_data('pegawai','barcode_pegawai',$id_pegawai);	
?>
<div class="header-report">
	<div class="center">				
		<h4><b><?= $instance_name ?></b></h4>
	</div>
	<div class="right">
		<h4><b><?= $title; ?></b></h4>		
			<table class="table">
				<tbody>
					<tr>
						<td>&nbsp;</td>				
						<td>&nbsp;</td>	
						<td width="40%" align="center" class="border-1 bg-dark">Nama Pegawai</td>				
			
					</tr>
					<tr>
						<td>&nbsp;</td>												
						<td>&nbsp;</td>	
						<td align="center" class="border-1"><?= $member['nama_pegawai'] ?></td>												
											
					</tr>				
				</tbody>
			</table>
	</div>
</div>
<div class="content-report">
   <table class="table">
	<thead>
		<tr style="border: 1px solid black;">
		  <th class="border-1 bg-dark" style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:center;width:10%;">Tanggal</th>
		  <th class="border-1 bg-dark" style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:center;width:8%;">Kode</th>
		  <th class="border-1 bg-dark" style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:center;">Nama Kewenangan</th>
		  <th class="border-1 bg-dark" style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:center;width:8%;">Jumlah</th>
		  <th class="border-1 bg-dark" style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:center;width:8%;">Karu</th>
		  <th class="border-1 bg-dark" style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:center;width:8%;">Kabid</th>
		  <th class="border-1 bg-dark" style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:center;width:8%;">Asesor</th>
		  <th class="border-1 bg-dark" style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:center;width:8%;">Komite</th>
		  <th class="border-1 bg-dark" style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:center;width:8%;">Direktur</th>
	  </tr>
	</thead>
	  <tbody>	
				<?php
				foreach($ambil_data_kewenangan as $row){
				?>
		<tr style="border: 1px solid black;">
			<td  class="border-1" style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:center;"><?php echo $row['tgl_logbook']; ?></td>
			<td  class="border-1" style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:left;"><?php echo $row['nama_kode_kewenangan'];?></td>
			<td  class="border-1" style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:left;"><?php echo $row['nama_kewenangan'];?></td>
			<td  class="border-1" style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:center;"><?php echo $row['jml_logbook'];?></td>
			<td  class="border-1" style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:center;"><?php echo $row['v_karu'];?></td>
			<td  class="border-1" style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:center;"><?php echo $row['v_kabid'];?></td>
			<td  class="border-1" style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:center;"><?php echo $row['v_asesor'];?></td>
			<td  class="border-1" style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:center;"><?php echo $row['v_komite'];?></td>
			<td  class="border-1" style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:center;"><?php echo $row['v_direktur'];?></td>
		</tr>	
				<?php
					}
				?>
	  </tbody>
	</table>
	<div class="clear">&nbsp;</div>
</div>