<?php 
$this->load->view('style');
$adata = $this->m_umum->ambil_data('a_data','id_data','1');
$kompetensi = $this->m_umum->ambil_data('ol_pengajuan','id_pengajuan',$id);
$ins = $this->m_umum->ambil_data('kol_working','id_working',$kompetensi['id_instansi']);
$member = $this->m_umum->ambil_data('ol_pegawai','barcode_pegawai',$kompetensi['barcode_pegawai']);
$kondisi_tahun = array('id_instansi'=>$kompetensi['id_instansi'],'id_logbooker'=>$member['id_pegawai']);
$select_tahun = "*";
$tahun = $this->m_ol_rancak->ambil_berkas_logbook_pengajuan($kompetensi['kode_unit_pengajuan'],$select_tahun,$kondisi_tahun,'YEAR(tgl_logbook)');
$fcolor = $adata['fcolor'];
$color = $adata['color'];
?>
<div class="header-report">
	<div class="center">				
		<h3><b>LAPORAN KEGIATAN HARIAN / LOGBOOK</b></h3>	
		<h3><b><?= $member['nama_pegawai'] ?></b></h3>	
	</div>
	<br style="line-height:1;">
	<div class="right">	

	</div>
</div>
<div class="content-report">
<?php 
if(!empty($kompetensi['kode_unit_pengajuan'])){
?>
<h3 style="font-weight:bold;">TOTAL PEMERIKSAAN YANG TELAH DILAKUKAN</h3><br>
	<table class="table">
			<tr>	
				<td colspan="3" style="padding: 5px;vertical-align:middle;font-weight: bold;" class="border-1 bg-dark">Nama Kompetensi</td>									
				<td width="15%" style="padding: 5px;vertical-align:middle;font-weight: bold;" align="center" class="border-1 bg-dark">Jumlah</td>					
			</tr>		
<?php
foreach ($tahun as $rowtahun){
$ks = array('id_instansi'=>$kompetensi['id_instansi'],'id_logbooker'=>$member['id_pegawai'],'YEAR(tgl_logbook)'=>date('Y',strtotime($rowtahun['tgl_logbook'])));
$select_komp = "*";
$komp = $this->m_ol_rancak->ambil_berkas_logbook_pengajuan($kompetensi['kode_unit_pengajuan'],$select_komp,$ks,'krw.id_kompetensi');
?>
		<tr>
				<td colspan="4" class="border-1" style="padding: 5px;vertical-align:middle;">TAHUN : <?= date('Y',strtotime($rowtahun['tgl_logbook'])) ?></td>
		</tr>
<?php
	foreach ($komp as $rowkomp){
$kk = array('id_instansi'=>$kompetensi['id_instansi'],'id_logbooker'=>$member['id_pegawai'],'krw.id_kompetensi'=>$rowkomp['id_kompetensi'],'YEAR(tgl_logbook)'=>date('Y',strtotime($rowtahun['tgl_logbook'])));
$select_kw = "*,SUM(jml_logbook) as jml_logbook";
$kw = $this->m_ol_rancak->ambil_berkas_logbook_pengajuan($kompetensi['kode_unit_pengajuan'],$select_kw,$kk,'ol.id_kewenangan');
?>
		<tr>
				<td class="border-1" style="padding: 5px;vertical-align:middle;width: 3%;border-right: 0:">&nbsp;</td>
				<td colspan="3" class="border-1" style="padding: 5px;vertical-align:middle;border-left: 0;"><?= $rowkomp['nama_kompetensi'] ?></td>
		</tr>
<?php 
		foreach ($kw as $rowkw){
?>
		<tr>
				<td class="border-1" style="padding: 5px;vertical-align:middle;width: 3%;border-right: 0:">&nbsp;</td>
				<td class="border-1" style="padding: 5px;vertical-align:middle;width: 3%;border-left: 0:;border-right: 0:">&nbsp;</td>
				<td class="border-1" style="padding: 5px;vertical-align:middle;border-left: ;: 0:"><?= $rowkw['nama_kewenangan'] ?></td>
				<td class="border-1" style="padding: 5px;vertical-align:middle;text-align: center;"><?= $rowkw['jml_logbook'] ?></td>
		</tr>
<?php
		}
	}
}
?>	
	</table>
<?php 
}
?>
	<div class="clear">&nbsp;</div>
</div>