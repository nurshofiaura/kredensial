<?php 
	$this->load->view('style');
/*	$this->load->view('surat_style');
	$apk = $this->m_rancak->ambil_pengajuan_kompetensi($id);
	$repot = $this->m_umum->ambil_data('kr_pengajuan_report','id_pengajuan',$apk['id_pengajuan']);
	$kompetensi = $this->m_direktur->ambil_kompetensi($id);
	$direktur = $this->m_umum->ambil_data('pegawai','id_pegawai',$repot['id_direktur']);
	$nama_direktur = $direktur["nama_pegawai"];*/
	$apk = $this->m_rancak->ambil_pengajuan_kompetensi($id);
	$repot = $this->m_umum->ambil_data('kr_pengajuan_report','id_pengajuan',$apk['id_pengajuan']);
	$kompetensi = $this->m_direktur->ambil_kompetensi($id);
	$direktur = $this->m_umum->ambil_data('pegawai','id_pegawai',$repot['id_direktur']);
	$headnya = $this->m_umum->ambil_data('a_instansi','id_instansi','7');
	$nama_direktur = $direktur["nama_pegawai"];
	$nip = $direktur["nip"];
?>
<div class="header-report">
	<table class="table">
		<tbody>
			<tr>
				<td style="width:25%">&nbsp;</td>				
				<td style="width:25%">&nbsp;</td>						
				<td style="font-size: 1em;text-align:right;">Lampiran</td>
				<td style="font-size: 1em;width:2%;text-align:center;">:</td>	
				<td style="font-size: 1em;"><?= $repot['lampiran']; ?></td>					
			</tr>		
			<tr>
				<td>&nbsp;</td>				
				<td>&nbsp;</td>						
				<td style="font-size: 1em;text-align:right;">Nomor</td>
				<td style="font-size: 1em;text-align:center;">:</td>	
				<td style="font-size: 1em;"><?= $repot['nomor']; ?></td>					
			</tr>			
			<tr>
				<td>&nbsp;</td>				
				<td>&nbsp;</td>						
				<td style="font-size: 1em;text-align:right;">Tanggal</td>
				<td style="font-size: 1em;text-align:center;">:</td>	
				<td style="font-size: 1em;"><?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($repot['tgl_nomor']))); ?></td>					
			</tr>
			<tr>
				<td>&nbsp;</td>				
				<td>&nbsp;</td>							
				<td style="font-size: 1em;text-align:right;">Tentang</td>	
				<td style="font-size: 1em;text-align:center;">:</td>	
				<td style="font-size: 1em;"><?= $repot['tentang']; ?></td>					
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
				$kewenangan = $this->m_direktur->ambil_kewenangan($id,$rowkompetensi['id_kompetensi']);				
				foreach($kewenangan as $rowkewenangan){
					$no++;
			?>
			<tr>
				<td align="center" style="font-size: 1.2em;" width="8%" class="center border-1 py-1 px-1"><?= $no ?></td>												
				<td style="font-size: 1.2em;" class="left border-1 py-1 px-1"><?= $rowkewenangan['nama_kewenangan'] ?></td>																						
			</tr>	
			<?php
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
				<td style="font-size: 1.2em;text-align:center;width:2%"></td>
				<td style="font-size: 1.2em;text-align:left;"><?= $repot['ditetapkan'] ?></td>					
			</tr>
			<tr>
				<td>&nbsp;</td>				
				<td>&nbsp;</td>							
				<td style="font-size: 1.2em;text-align:right;">Pada Tanggal</td>
				<td style="font-size: 1.2em;text-align:center;width:2%"></td>
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
				<td colspan="3" style="font-size: 1.2em;text-align:center;">Direktur</td>				
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
				<td colspan="3" style="font-size: 1.2em;text-align:center;"><?= $nama_direktur ?></td>						
			</tr>
		</tbody>
	</table>
</div>