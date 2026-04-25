<?php 
	$this->load->view('style');
	$adata = $this->m_umum->ambil_data('a_data','id_data','1');
	$fcolor = $adata['fcolor'];
	$color = $adata['color'];	
if(empty($id2)){
$kondisi_1=array('status_pegawai'=>1,'visible'=>1,'opi.id_instansi'=>$id);	
	$jabatane = $this->m_umum->ambil_data('jabatan','id_jabatan',$id2);
	$nama_jabatan = "";
}else{
$kondisi_1=array('status_pegawai'=>1,'visible'=>1,'opi.id_instansi'=>$id,'jf.id_jabatan'=>$id2);
	$jabatane = $this->m_umum->ambil_data('jabatan','id_jabatan',$id2);
	$nama_jabatan = "<h3><b>".$jabatane['nama_jabatan']."</b></h3>";
}
$select_prov = "COUNT(ope.id_prov) as total_prov,nama_prov,ope.id_prov";
$provt=$this->m_instansi_user->grafik_all_pegawai_result($select_prov,$kondisi_1,'ope.id_prov');
	$kerjae = $this->m_umum->ambil_data('kol_working','id_working',$id);
?>
<div class="header-report">
	<div class="center">				
		<h3><b><?= $kerjae['nama_working'] ?></b></h3>
		<?= $nama_jabatan ?>
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
$kondisi_kab=array('status_pegawai'=>1,'visible'=>1,'ope.id_prov'=>$rowprovt['id_prov'],'opi.id_instansi'=>$id,'jf.id_jabatan'=>$id2);
$select_kab = "COUNT(ope.id_kab) as total_kab,nama_kab,ope.id_kab";
$kabt=$this->m_instansi_user->grafik_all_pegawai_result($select_kab,$kondisi_kab,'ope.id_kab');
  foreach ($kabt as $rowkabt){
?>
<tr style="border: 1px solid black;">
  <td class="border-1 bg-dark" style="padding-left: 15px;padding-top: 5px;padding-bottom: 5px;border-right: 0px solid;vertical-align:middle;text-align:left;">Kota / Kabupaten : <?= $rowkabt['nama_kab'] ?></td>
  <td class="border-1 bg-dark" style="padding-left: 5px;padding-right: 5px;padding-top: 5px;padding-bottom: 5px;border-left: 0px solid;vertical-align:middle;text-align:right;"><?= $rowkabt['total_kab'] ?></td>
</tr> 
<?php
$kondisi_kec=array('status_pegawai'=>1,'visible'=>1,'ope.id_kab'=>$rowkabt['id_kab'],'opi.id_instansi'=>$id,'jf.id_jabatan'=>$id2);
$select_kec = "COUNT(ope.id_kec) as total_kec,nama_kec,ope.id_kec";
$kect=$this->m_instansi_user->grafik_all_pegawai_result($select_kec,$kondisi_kec,'ope.id_kec');
    foreach ($kect as $rowkect){
?>
<tr style="border: 1px solid black;">
  <td class="border-1 bg-dark" style="padding-left: 25px;padding-top: 5px;padding-bottom: 5px;border-right: 0px solid;vertical-align:middle;text-align:left;">Kecamatan : <?= $rowkect['nama_kec'] ?></td>
  <td class="border-1 bg-dark" style="padding-left: 5px;padding-right: 5px;padding-top: 5px;padding-bottom: 5px;border-left: 0px solid;vertical-align:middle;text-align:right;"><?= $rowkect['total_kec'] ?></td>
</tr> 
<?php
$kondisi_kel=array('status_pegawai'=>1,'visible'=>1,'ope.id_kec'=>$rowkect['id_kec'],'opi.id_instansi'=>$id,'jf.id_jabatan'=>$id2);
$select_kel = "COUNT(ope.id_kel) as total_kel,nama_kel,ope.id_kel";
$kelt=$this->m_instansi_user->grafik_all_pegawai_result($select_kel,$kondisi_kel,'ope.id_kel');
      $no = 0;
      foreach ($kelt as $rowkelt){
?>
<tr style="border: 1px solid black;">
  <td class="border-1 bg-dark" style="padding-left: 35px;padding-top: 5px;padding-bottom: 5px;border-right: 0px solid;vertical-align:middle;text-align:left;"><b>Kelurahan : <?= $rowkelt['nama_kel'] ?></b></td>
  <td class="border-1 bg-dark" style="padding-left: 5px;padding-right: 5px;padding-top: 5px;padding-bottom: 5px;border-left: 0px solid;vertical-align:middle;text-align:right;"><b><?= $rowkelt['total_kel'] ?></b></td>
</tr> 
<?php
$kondisi_2=array('status_pegawai'=>1,'visible'=>1,'opi.id_instansi'=>$id,'jf.id_jabatan'=>$id2,'ope.id_kel'=>$rowkelt['id_kel']);
$select_2 = "*";
$kelte=$this->m_instansi_user->grafik_all_pegawai_result($select_2,$kondisi_2);
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