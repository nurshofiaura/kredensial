<?php 
$this->load->view('style');
$adata = $this->m_umum->ambil_data('a_data','id_data','1');
$kompetensi = $this->m_umum->ambil_data('ol_pengajuan','id_pengajuan',$id);
$ins = $this->m_umum->ambil_data('kol_working','id_working',$kompetensi['id_instansi']);
$member = $this->m_umum->ambil_data('ol_pegawai','barcode_pegawai',$kompetensi['barcode_pegawai']);
$kondisi_tahun = array('status_rkk'=>1,'ol_rkk.barcode_pegawai'=>$kompetensi['barcode_pegawai']);
$select = "*,
  if(status_rkk = 1,'Kompeten Penuh',if(status_rkk = 2,'Dengan Mentorship',(if(status_rkk = 3,'Tidak Kompeten / Ditolak','Proses / Belum Validasi')))) as status_rkk
";
$komp = $this->m_ol_rancak->ambil_berkas_rkk($select,$kondisi_tahun,'nkr_kewenangan.id_kompetensi');
$fcolor = $adata['fcolor'];
$color = $adata['color'];
?>
<div class="header-report">
	<div class="center">				
		<h3><b>LAPORAN RKK</b></h3>	
		<h3><b><?= $member['nama_pegawai'] ?></b></h3>	
	</div>
	<br style="line-height:1;">
	<div class="right">	

	</div>
</div>
<div class="content-report">
	<table class="table">
			<tr>	
				<td colspan="2" style="padding: 5px;vertical-align:middle;font-weight: bold;" class="border-1 bg-dark">Nama Kompetensi</td>			
    <td style="padding: 5px;vertical-align:middle;font-weight: bold;text-align: center;" class="border-1 bg-dark">Sifat Kewenangan</td>   
    <td style="padding: 5px;vertical-align:middle;font-weight: bold;text-align: center;" class="border-1 bg-dark">Status</td>   
    <td style="padding: 5px;vertical-align:middle;font-weight: bold;text-align: center;" class="border-1 bg-dark">Validator</td>   
			</tr>		
<?php
	foreach ($komp as $rowkomp){
$kk = array('status_rkk'=>1,'ol_rkk.barcode_pegawai'=>$kompetensi['barcode_pegawai'],'nkr_kewenangan.id_kompetensi'=>$rowkomp['id_kompetensi']);
$kw = $this->m_ol_rancak->ambil_berkas_rkk($select,$kk,'ol_rkk.id_kewenangan');
?>
		<tr>
				<td colspan="5" class="border-1" style="padding: 5px;vertical-align:middle;"><?= $rowkomp['nama_kompetensi'] ?></td>
		</tr>
<?php 
		foreach ($kw as $rowkw){
?>
		<tr>
				<td class="border-1" style="padding: 5px;vertical-align:middle;width: 3%;border-right: 0:">&nbsp;</td>
				<td class="border-1" style="padding: 5px;vertical-align:middle;border-left: 0;"><?= $rowkw['nama_kewenangan'] ?></td>
    <td class="border-1" style="padding: 5px;vertical-align:middle;border-left: 0;text-align: center;"><?= $rowkw['nama_sifat_kewenangan'] ?></td>
    <td class="border-1" style="padding: 5px;vertical-align:middle;border-left: 0;text-align: center;"><?= $rowkw['status_rkk'] ?></td>
				<td class="border-1" style="padding: 5px;vertical-align:middle;text-align: center;"><?= $rowkw['nama_pegawai'] ?></td>
		</tr>
<?php
   }
		}
?>	
	</table>
	<div class="clear">&nbsp;</div>
</div>