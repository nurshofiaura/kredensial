<?php 
	$this->load->view('style');
	$apk = $this->m_ol_rancak->ambil_pengajuan_kompetensi_spk($id);
	$kondisi=array('id_pengajuan'=>$apk['id_pengajuan']);
	$repot = $this->m_umum->ambil_data_kondisi_2tabel_row('ol_pengajuan_report',$kondisi,'ol_direktur','id_direktur');
	$kompetensi = $this->m_ol_rancak->ambil_kompetensi_spk($apk['id_pegawai']);
	$headnya = $this->m_umum->ambil_data('kol_working','id_working',$apk['id_instansi']);
/*	$direktur = $this->m_umum->ambil_data('pegawai','id_pegawai',$repot['id_direktur']);
	$nama_direktur = $direktur["nama_pegawai"];
	$nip = $direktur["nip"];*/
?>
<div class="header-report">
	<table class="table">
		<tbody>
			<tr>	
				<td style="width:7%;">&nbsp;</td>				
				<td style="font-size: 1.2em;font-weight: bold;border-bottom:1px solid"><?= $headnya['nama_working']; ?></td>					
				<td style="width:20%;">&nbsp;</td>	
				<td style="width:25%;">&nbsp;</td>										
			</tr>	
			<tr>				
				<td colspan="4" style="font-size: 1em;font-weight: bold;text-align: center;">&nbsp;</td>										
			</tr>	
			<tr>				
				<td colspan="4" style="font-size: 1em;font-weight: bold;text-align: center;"><?= $repot['lampiran']; ?></td>										
			</tr>
			<tr>				
				<td colspan="4" style="font-size: 1em;font-weight: bold;text-align: center;"><?= $repot['nomor']; ?></td>										
			</tr>
			<tr>				
				<td colspan="4" style="font-size: 1em;font-weight: bold;text-align: center;"><?= $repot['tentang']; ?></td>										
			</tr>
			<tr>				
				<td colspan="4" style="font-size: 1em;font-weight: bold;text-align: center;"><?= $repot['lampiran']; ?></td>										
			</tr>
		</tbody>
	</table>	
	<br style="line-height:1">
	<table class="table">
		<tbody>
			<tr>
				<td align="center" style="font-size: 1.2em;" class="border-1 bg-dark py-1 px-1">Kategori Kewenangan</td>				
	
			</tr>
			<tr>
				<td align="center" style="font-size: 1.2em;" class="border-1 py-1 px-1"><?= $repot['kategori_kewenangan'] ?></td>												
									
			</tr>				
		</tbody>
	</table>
	<br style="line-height:2">
	<table class="table">
		<tbody>
			<tr>
				<td align="center" width="30%" style="font-size: 1.2em;" class="border-1 bg-dark py-1 px-1">Nama</td>				
				<td align="center" width="30%" style="font-size: 1.2em;" class="border-1 bg-dark py-1 px-1">NIP / NIK</td>	
				<td align="center" width="30%" style="font-size: 1.2em;" class="border-1 bg-dark py-1 px-1">Kewenangan Klinis / Area</td>				
	
			</tr>
			<tr>
				<td align="center" style="font-size: 1.2em;" class="border-1 py-1 px-1"><?= $apk['nama_pegawai'] ?></td>												
				<td align="center" style="font-size: 1.2em;" class="border-1 py-1 px-1"><?= $apk['nip'] ?></td>	
				<td align="center" style="font-size: 1.2em;" class="border-1 py-1 px-1"><?= $repot['kewenangan_klinis'] ?></td>												
									
			</tr>				
		</tbody>
	</table>	
	<br style="line-height:2">
	<table class="table">
		<tbody>
			<tr>
				<td colspan="2" style="font-size: 1.2em;" class="border-1 bg-dark py-1 px-1">Tugas Pokok</td>								
			</tr>
			<?php
			$no = 0;
			foreach($kompetensi as $rowkompetensi){		
				
			?>
			<tr>
				<td colspan="2" style="font-size: 1.2em;" class="border-1 py-1 px-1"><?= $rowkompetensi['nama_kompetensi'] ?></td>								
			</tr>			
			<?php
				$kewenangan = $this->m_ol_rancak->ambil_kewenangan_spk($apk['id_pegawai'],$rowkompetensi['id_kompetensi']);				
				foreach($kewenangan as $rowkewenangan){
					if(in_array($rowkewenangan['id_kewenangan'],explode(",", $apk['kw_all']))){
					$no++;
			?>
			<tr>
				<td align="center" style="font-size: 1.2em;" width="8%" class="center border-1 py-1 px-1"><?= $no ?></td>												
				<td style="font-size: 1.2em;" class="left border-1 py-1 px-1"><?= $rowkewenangan['nama_kewenangan'] ?></td>																						
			</tr>	
			<?php
					}
				}
			}
			?>			
		</tbody>
	</table>		
	<br style="line-height:2">
	<table class="table">
		<tbody>
			<tr>
				<td style="font-size: 1.2em;width:20%">&nbsp;</td>				
				<td style="font-size: 1.2em;width:20%">&nbsp;</td>							
				<td style="font-size: 1.2em;text-align:right;">Ditetapkan di</td>
				<td style="font-size: 1.2em;text-align:center;width:2%">:</td>
				<td style="font-size: 1.2em;text-align:left;"><?= $repot['ditetapkan'] ?></td>					
			</tr>
			<tr>
				<td>&nbsp;</td>				
				<td>&nbsp;</td>							
				<td style="font-size: 1.2em;text-align:right;">Pada Tanggal</td>
				<td style="font-size: 1.2em;text-align:center;width:2%">:</td>
				<td style="font-size: 1.2em;text-align:left;"><?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($repot['tgl_ditetapkan']))); ?></td>					
			</tr>
			<tr>
				<td>&nbsp;</td>				
				<td>&nbsp;</td>							
				<td style="font-size: 1.2em;text-align:center;">&nbsp;</td>
				<td style="font-size: 1.2em;text-align:center;">&nbsp;</td>					
				<td style="font-size: 1.2em;text-align:center;">&nbsp;</td>					
			</tr>
			<tr>
				<td>&nbsp;</td>				
				<td>&nbsp;</td>						
				<td colspan="3" style="font-size: 1.2em;text-align:center;">Direktur / Kepala Rumah Sakit</td>				
			</tr>		
			<tr>
				<td>&nbsp;</td>				
				<td>&nbsp;</td>							
				<td style="font-size: 1.2em;text-align:center;">&nbsp;</td>
				<td style="font-size: 1.2em;text-align:center;">&nbsp;</td>					
				<td style="font-size: 1.2em;text-align:center;">&nbsp;</td>					
			</tr>			
			<tr>
				<td>&nbsp;</td>				
				<td>&nbsp;</td>							
				<td style="font-size: 1.2em;text-align:center;">&nbsp;</td>
				<td style="font-size: 1.2em;text-align:center;">&nbsp;</td>					
				<td style="font-size: 1.2em;text-align:center;">&nbsp;</td>					
			</tr>
			<tr>
				<td>&nbsp;</td>				
				<td>&nbsp;</td>							
				<td style="font-size: 1.2em;text-align:center;">&nbsp;</td>
				<td style="font-size: 1.2em;text-align:center;">&nbsp;</td>					
				<td style="font-size: 1.2em;text-align:center;">&nbsp;</td>					
			</tr>
			<tr>
				<td>&nbsp;</td>				
				<td>&nbsp;</td>							
				<td style="font-size: 1.2em;text-align:center;">&nbsp;</td>
				<td style="font-size: 1.2em;text-align:center;">&nbsp;</td>					
				<td style="font-size: 1.2em;text-align:center;">&nbsp;</td>					
			</tr>
			<tr>
				<td>&nbsp;</td>				
				<td>&nbsp;</td>								
				<td colspan="3" style="font-size: 1.2em;text-align:center;"><?= $repot['nama_direktur'] ?></td>						
			</tr>
			<?php 
			
			?>
			<tr>
				<td>&nbsp;</td>				
				<td>&nbsp;</td>								
				<td colspan="3" style="font-size: 1.2em;text-align:center;"><?php if(!empty($repot['pangkat'])){ echo $repot['pangkat'].". "; }  ?> <?= $repot['nip'] ?></td>						
			</tr>
		</tbody>
	</table>
</div>