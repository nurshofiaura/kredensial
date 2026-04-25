<?php 
	$this->load->view('style');
	$adata = $this->m_umum->ambil_data('a_data','id_data','1');
	$fcolor = $adata['fcolor'];
	$color = $adata['color'];	
	$kondisi_t=array('op.id_jabatan'=>$this->session->id_jabatan,'opi.id_instansi'=>$id_working);	
$select_provt = "COUNT(ope.id_prov) as total_prov,nama_prov,ope.id_prov,ope.id_kec";
$provt=$this->m_ol_grafik->grafik_pengcab_pegawai_instansi($select_provt,$kondisi_t,'ope.id_prov');
	$pengcabe = $this->m_umum->ambil_data('kol_working','id_working',$id_working);
?>
<div class="header-report">
	<div class="center">				
		<h3><b><?= $pengcabe['nama_working'] ?></b></h3>
		<h3><b>DAFTAR ALAMAT</b></h3>	
	</div>
	<br style="line-height:1;">
	<div class="right">	
			<table class="table">
				<tbody>
					<tr>
						<td>&nbsp;</td>				
						<td>&nbsp;</td>	
						<td width="15%" align="center" class="border-1 bg-dark">Tanggal Print</td>				
			
					</tr>
					<tr>
						<td>&nbsp;</td>												
						<td>&nbsp;</td>	
						<td align="center" class="border-1"><?= $this->m_rancak->fullBulan(date('d-m-Y')) ?></td>												
											
					</tr>				
				</tbody>
			</table>
	</div>
</div>
<div class="content-report">
<table class="table">
<tbody>	
<?php 
foreach ($provt as $rowprovt){
?>
<tr style="border: 1px solid black;">
  <td class="border-1 bg-dark" style="padding-left: 5px;padding-top: 5px;padding-bottom: 5px;border-right: 0px solid;vertical-align:middle;text-align:left;">Propinsi : <?= $rowprovt['nama_prov'] ?></td>
  <td class="border-1 bg-dark" style="padding-left: 5px;padding-right: 5px;padding-top: 5px;padding-bottom: 5px;border-left: 0px solid;vertical-align:middle;text-align:right;"><?= $rowprovt['total_prov'] ?></td>
</tr> 
<?php 
$kondisi_kabt=array('op.id_jabatan'=>$this->session->id_jabatan,'opi.id_instansi'=>$id_working,'ope.id_prov'=>$rowprovt['id_prov']);
$select_kabt = "COUNT(ope.id_kab) as total_kab,nama_kab,ope.id_kab";
$kabt=$this->m_ol_grafik->grafik_pengcab_pegawai_instansi($select_kabt,$kondisi_kabt,'ope.id_kab');
  foreach ($kabt as $rowkabt){
?>
<tr style="border: 1px solid black;">
  <td class="border-1 bg-dark" style="padding-left: 15px;padding-top: 5px;padding-bottom: 5px;border-right: 0px solid;vertical-align:middle;text-align:left;">Kota / Kabupaten : <?= $rowkabt['nama_kab'] ?></td>
  <td class="border-1 bg-dark" style="padding-left: 5px;padding-right: 5px;padding-top: 5px;padding-bottom: 5px;border-left: 0px solid;vertical-align:middle;text-align:right;"><?= $rowkabt['total_kab'] ?></td>
</tr> 
<?php
$kondisi_kect=array('op.id_jabatan'=>$this->session->id_jabatan,'opi.id_instansi'=>$id_working,'ope.id_kab'=>$rowkabt['id_kab']);
$select_kect = "COUNT(ope.id_kec) as total_kec,nama_kec,ope.id_kec";
$kect=$this->m_ol_grafik->grafik_pengcab_pegawai_instansi($select_kect,$kondisi_kect,'ope.id_kec');
    foreach ($kect as $rowkect){
?>
<tr style="border: 1px solid black;">
  <td class="border-1 bg-dark" style="padding-left: 25px;padding-top: 5px;padding-bottom: 5px;border-right: 0px solid;vertical-align:middle;text-align:left;">Kecamatan : <?= $rowkect['nama_kec'] ?></td>
  <td class="border-1 bg-dark" style="padding-left: 5px;padding-right: 5px;padding-top: 5px;padding-bottom: 5px;border-left: 0px solid;vertical-align:middle;text-align:right;"><?= $rowkect['total_kec'] ?></td>
</tr> 
<?php
$kondisi_kelt=array('op.id_jabatan'=>$this->session->id_jabatan,'opi.id_instansi'=>$id_working,'ope.id_kec'=>$rowkect['id_kec']);
$select_kelt = "COUNT(ope.id_kel) as total_kel,nama_kel,ope.id_kel";
$kelt=$this->m_ol_grafik->grafik_pengcab_pegawai_instansi($select_kelt,$kondisi_kelt,'ope.id_kel');
      $no = 0;
      foreach ($kelt as $rowkelt){
?>
<tr style="border: 1px solid black;">
  <td class="border-1 bg-dark" style="padding-left: 35px;padding-top: 5px;padding-bottom: 5px;border-right: 0px solid;vertical-align:middle;text-align:left;"><b>Kelurahan : <?= $rowkelt['nama_kel'] ?></b></td>
  <td class="border-1 bg-dark" style="padding-left: 5px;padding-right: 5px;padding-top: 5px;padding-bottom: 5px;border-left: 0px solid;vertical-align:middle;text-align:right;"><b><?= $rowkelt['total_kel'] ?></b></td>
</tr> 
<?php
$kelte=$this->m_ol_grafik->ambil_data_area_pegawai_instansi($id_working,$rowkelt['id_kel']);
        foreach ($kelte as $rowkelte){
        	$no++;
?>
<tr style="border: 1px solid black;">
  <td colspan="2" class="border-1" style="padding-left: 45px;padding-top: 5px;padding-bottom: 5px;border-right: 0px solid;vertical-align:middle;text-align:left;"><?= $no.'. '.$rowkelte['nama_pegawai'] ?></td>
</tr> 
<tr style="border: 1px solid black;">
  <td colspan="2" class="border-1" style="padding-left: 60px;padding-top: 5px;padding-bottom: 5px;border-right: 0px solid;vertical-align:middle;text-align:left;"><?= $rowkelte['alamat'] ?></td>
</tr> 
<?php
        }
      }
    }
  }
}
?>
</tbody>
</table>
	<div class="clear">&nbsp;</div>
</div>