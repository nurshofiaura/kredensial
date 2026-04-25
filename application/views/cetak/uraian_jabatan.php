<?php 
	$this->load->view('style');
	$adata = $this->m_umum->ambil_data('a_data','id_data','1');
	$injabdet = $this->m_anjababk->ambil_injab_detil($id);
?>
<table class="asktable" width="100%">
	<thead>
		<tr>
			<th colspan="5" class="px-1 py-1" style="text-align:center;"><h3><b><?= $injabdet['header'] ?></b></h3></th>
		</tr>
		<tr>
			<th colspan="5" class="px-1 py-1" style="text-align:center;"><h3><b><?= $injabdet['sub_header'] ?></b></h3></th>
		</tr>
		<tr>
			<th colspan="5" class="px-1 py-1" style="text-align:center;"><h3><b><?= $injabdet['sub_sub_header'] ?></b></h3></th>
		</tr>
		<tr>
			<th colspan="5" class="px-1 py-1" style="text-align:center;"><h3>&nbsp;</h3></th>
		</tr>
	</thead>
	<tbody>
		<tr>
		  <td style="text-align:left;width:5%;">1.</td>
		  <td colspan="4" style="text-align:left;">IDENTITAS JABATAN</td>
		</tr>
		<tr>
		  <td style="text-align:center;" >&nbsp;</td>
		  <td style="text-align:left;width:8%;" >1.1</td>
		  <td style="text-align:left;width:15%" >NAMA JABATAN</td>
		  <td style="text-align:center;width:3%;" >:</td>
		  <td style="text-align:left;" ><?= $injabdet['nama_jabatan_fungsional'] ?></td>
		</tr>
		<tr>
		  <td style="text-align:center;" >&nbsp;</td>
		  <td style="text-align:left;" >1.2</td>
		  <td style="text-align:left;" >ATASAN LANGSUNG</td>
		  <td style="text-align:center;" >:</td>
		  <td style="text-align:left;" ><?= $injabdet['nama_struktur_jabatan'] ?></td>
		</tr>
		<tr>
		  <td style="text-align:center;" >&nbsp;</td>
		  <td style="text-align:left;" >1.3</td>
		  <td style="text-align:left;" >UNIT</td>
		  <td style="text-align:center;" >:</td>
		  <td style="text-align:left;" ><?= $injabdet['nama_unit'] ?></td>
		</tr>
		<tr>
		  <td style="text-align:center;" >&nbsp;</td>
		  <td style="text-align:left;" >1.4</td>
		  <td style="text-align:left;" >UNIT KERJA</td>
		  <td style="text-align:center;" >:</td>
		  <td style="text-align:left;" ><?= $injabdet['nama_working'] ?></td>
		</tr>
		<tr>
		  <td colspan="5" style="text-align:left;">&nbsp;</td>
		</tr>
		<?php 
			if(!empty($injabdet['iktisar_jabatan'])){
		?>
		<tr>
		  <td style="text-align:left;">2.</td>
		  <td colspan="4" style="text-align:left;">IKTISAR JABATAN</td>
		</tr>
		<tr>
		  <td style="text-align:center;" >&nbsp;</td>
		  <td colspan="4" style="text-align:left;line-height: 1.6;" ><?= $injabdet['iktisar_jabatan'] ?></td>
		</tr>
		<tr>
		  <td colspan="5" style="text-align:left;">&nbsp;</td>
		</tr>
		<?php 
			}
		?>
		<tr>
		  <td style="text-align:left;">3.</td>
		  <td colspan="4" style="text-align:left;">SYARAT JABATAN</td>
		</tr>
		<tr>
		  <td style="text-align:left;">&nbsp;</td>
		  <td colspan="4" style="text-align:left;">
			<table width="100%" class="asktable">
				<tbody>		
				<tr>
				  <td style="text-align:left;width:3%;" >a.</td>
				  <td style="text-align:left;width:15%;">Pendidikan Formal</td>
				  <td style="text-align:center;width:3%;" >:</td>
				  <td style="text-align:left;line-height:1.6;" >
					<?php 
						$pendidikan_terpilih = $this->m_anjababk->pendidikan_terpilih($injabdet['pendidikan_formal']);
						foreach($pendidikan_terpilih as $rowpendidikan){	
					?>	
						<?= $rowpendidikan['nama_pendidikan'] ?><br>
					<?php	
						}
					?>				  
				  </td>
				</tr>	
				<tr>
				  <td style="text-align:left;width:3%;" >b.</td>
				  <td style="text-align:left;width:15%;">Pelatihan/Kursus</td>
				  <td style="text-align:center;width:3%;" >:</td>
				  <td style="text-align:left;" ><?= $injabdet['pelatihan'] ?></td>
				</tr>			
				<tr>
				  <td style="text-align:left;width:3%;" >c.</td>
				  <td style="text-align:left;width:15%;">Pengalaman Kerja</td>
				  <td style="text-align:center;width:3%;" >:</td>
				  <td style="text-align:left;" ><?= $injabdet['pengalaman'] ?></td>
				</tr>				
				</tbody>		  
			</table>		  
		  </td>
		</tr>
		<tr>
		  <td colspan="5" style="text-align:left;">&nbsp;</td>
		</tr>
		<tr>
		  <td style="text-align:left;">4.</td>
		  <td colspan="4" style="text-align:left;">RINCIAN TUGAS JABATAN </td>
		</tr>
		<?php						
			$noa = 0;
			$butir_kegiatan_terpilih = $this->m_rancak->ambil_bk_detil4new($id);
			foreach($butir_kegiatan_terpilih as $rowbutir_kegiatan_terpilih){			
			$noa++;
		?>
		<tr>
		  <td style="text-align:center;" >&nbsp;</td>
		  <td style="text-align:left;" >4.<?= $noa ?></td>
		  <td colspan="3" style="text-align:left;" ><?= $rowbutir_kegiatan_terpilih['nama_kompetensi'] ?></td>
		</tr>
		<?php
			}
		?>
		<tr>
		  <td colspan="5" style="text-align:left;">&nbsp;</td>
		</tr>
		<tr>
		  <td style="text-align:left;">5.</td>
		  <td colspan="4" style="text-align:left;">WEWENANG</td>
		</tr>
		<?php						
			$nob = 0;
			$wewenang_terpilih = $this->m_anjababk->wewenang_terpilih($injabdet['wewenang']);
			foreach($wewenang_terpilih as $rowwewenang_terpilih){			
			$nob++;
		?>
		<tr>
		  <td style="text-align:center;" >&nbsp;</td>
		  <td style="text-align:left;" >5.<?= $nob ?></td>
		  <td colspan="3" style="text-align:left;" ><?= $rowwewenang_terpilih['nama_wewenang'] ?></td>
		</tr>
		<?php
			}
		?>
		<tr>
		  <td colspan="5" style="text-align:left;">&nbsp;</td>
		</tr>
		<tr>
		  <td style="text-align:left;">6.</td>
		  <td colspan="4" style="text-align:left;">TANGGUNG JAWAB</td>
		</tr>
		<?php						
			$noc = 0;
			$tanggung_jawab_terpilih = $this->m_anjababk->tanggung_jawab_terpilih($injabdet['tanggung_jawab']);
			foreach($tanggung_jawab_terpilih as $rowtanggung_jawab_terpilih){		
			$noc++;
		?>
		<tr>
		  <td style="text-align:center;" >&nbsp;</td>
		  <td style="text-align:left;" >6.<?= $noc ?></td>
		  <td colspan="3" style="text-align:left;" ><?= $rowtanggung_jawab_terpilih['nama_tanggung_jawab'] ?></td>
		</tr>
		<?php
			}
		?>
		<tr>
		  <td colspan="5" style="text-align:left;">&nbsp;</td>
		</tr>
		<tr>
		  <td style="text-align:left;">7.</td>
		  <td colspan="4" style="text-align:left;">HASIL KERJA</td>
		</tr>
		<?php						
			$nod = 0;
			$hasil_kerja_terpilih = $this->m_anjababk->hasil_kerja_terpilih($injabdet['hasil_kerja']);
			foreach($hasil_kerja_terpilih as $rowhasil_kerja_terpilih){		
			$nod++;
		?>
		<tr>
		  <td style="text-align:center;" >&nbsp;</td>
		  <td style="text-align:left;" >7.<?= $nod ?></td>
		  <td colspan="3" style="text-align:left;" ><?= $rowhasil_kerja_terpilih['nama_hasil_kerja'] ?></td>
		</tr>
		<?php
			}
		?>		
		<tr>
		  <td colspan="5" style="text-align:left;">&nbsp;</td>
		</tr>
		<tr>
		  <td colspan="5" style="text-align:left;">
			<table width="100%" class="table table-border">
				<tbody>	
				<tr>
				  <td style="text-align:left;border-left:0;border-top:0;border-bottom:0;" >8.</td>
				  <td class="bg-dark" style="text-align:left;" >No</td>
				  <td class="bg-dark" style="text-align:left;" >BAHAN KERJA</td>
				  <td class="bg-dark" style="text-align:left;" >PENGGUNAAN DALAM TUGAS</td>
				</tr>
				<?php						
					$noe = 0;
					$bahan_kerja_terpilih = $this->m_anjababk->bahan_kerja_terpilih($injabdet['bahan_kerja']);
					foreach($bahan_kerja_terpilih as $rowhasil_bahan_terpilih){
					$noe++;
				?>
				<tr>
				  <td style="text-align:left;width:5%;border-left:0;border-top:0;border-bottom:0;" >&nbsp;</td>
				  <td style="text-align:left;width:5%;" >8.<?= $noe ?></td>
				  <td style="text-align:left;" ><?= $rowhasil_bahan_terpilih['nama_bahan_kerja'] ?></td>
				  <td style="text-align:left;" ><?= $rowhasil_bahan_terpilih['penggunaan'] ?></td>
				</tr>
				<?php
					}
				?>				
				</tbody>		  
			</table>		  
		  </td>
		</tr>
		<tr>
		  <td colspan="5" style="text-align:left;">&nbsp;</td>
		</tr>
		<tr>
		  <td colspan="5" style="text-align:left;">
			<table width="100%" class="table table-border">
				<tbody>	
				<tr>
				  <td style="text-align:left;border-left:0;border-top:0;border-bottom:0;" >9.</td>
				  <td class="bg-dark" style="text-align:left;" >No</td>
				  <td class="bg-dark" style="text-align:left;" >PERANGKAT KERJA</td>
				  <td class="bg-dark" style="text-align:left;" >PENGGUNAAN DALAM TUGAS</td>
				</tr>
				<?php						
					$nof = 0;
					$perangkat_kerja_terpilih = $this->m_anjababk->perangkat_kerja_terpilih($injabdet['perangkat_kerja']);
					foreach($perangkat_kerja_terpilih as $rowperangkat_kerja_terpilih){			
					$nof++;
				?>
				<tr>
				  <td style="text-align:left;width:5%;border-left:0;border-top:0;border-bottom:0;" >&nbsp;</td>
				  <td style="text-align:left;width:5%;" >9.<?= $nof ?></td>
				  <td style="text-align:left;" ><?= $rowperangkat_kerja_terpilih['nama_perangkat_kerja'] ?></td>
				  <td style="text-align:left;" ><?= $rowperangkat_kerja_terpilih['penggunaan'] ?></td>
				</tr>
				<?php
					}
				?>				
				</tbody>		  
			</table>		  
		  </td>
		</tr>		
		<tr>
		  <td colspan="5" style="text-align:left;">&nbsp;</td>
		</tr>
		<tr>
		  <td style="text-align:left;">10.</td>
		  <td colspan="4" style="text-align:left;">KORELASI JABATAN</td>
		</tr>
		<tr>
		  <td style="text-align:left;">&nbsp;</td>
		  <td colspan="4" style="text-align:left;">
			<table width="100%" class="table table-border">
				<tbody>	
				<tr class="bg-dark">
				  <td style="text-align:left;width:5%;" >No</td>
				  <td style="text-align:center;" >NAMA JABATAN</td>
				  <td style="text-align:center;" >UNIT KERJA</td>
				  <td style="text-align:center;" >DALAM HAL</td>
				</tr>
				<?php						
					$nog = 0;
					$hubungan_jabatan_terpilih = $this->m_anjababk->hubungan_jabatan_terpilih($injabdet['hubungan_jabatan']);
					foreach($hubungan_jabatan_terpilih as $rowhubungan_jabatan){		
					$nog++;
				?>
				<tr>
				  <td style="text-align:left;width:5%;" >10.<?= $nog ?></td>
				  <td style="text-align:left;" ><?= $rowhubungan_jabatan['nama_hubungan_jabatan'] ?></td>
				  <td style="text-align:left;" ><?= $rowhubungan_jabatan['unit_kerja'] ?></td>
				  <td style="text-align:left;" ><?= $rowhubungan_jabatan['hal'] ?></td>
				</tr>
				<?php
					}
				?>				
				</tbody>		  
			</table>		  
		  </td>
		</tr>
		<tr>
		  <td colspan="5" style="text-align:left;">&nbsp;</td>
		</tr>
		<tr>
		  <td style="text-align:left;">11.</td>
		  <td colspan="4" style="text-align:left;">KONDISI LINGKUNGAN KERJA </td>
		</tr>
		<tr>
		  <td style="text-align:left;">&nbsp;</td>
		  <td colspan="4" style="text-align:left;">
			<table width="100%" class="table table-border">
				<tbody>	
				<tr class="bg-dark">
				  <td style="text-align:left;width:5%;" >No</td>
				  <td style="text-align:center;" >ASPEK</td>
				  <td style="text-align:center;" >FAKTOR</td>
				</tr>
				<?php						
					$noh = 0;
					$kondisi_tempat_terpilih = $this->m_anjababk->kondisi_tempat_terpilih($injabdet['kondisi_tempat_kerja']);
					foreach($kondisi_tempat_terpilih as $rowkondisi_tempat){		
					$noh++;
				?>
				<tr>
				  <td style="text-align:left;width:5%;" >11.<?= $noh ?></td>
				  <td style="text-align:left;" ><?= $rowkondisi_tempat['aspek'] ?></td>
				  <td style="text-align:left;" ><?= $rowkondisi_tempat['faktor'] ?></td>
				</tr>
				<?php
					}
				?>				
				</tbody>		  
			</table>		  
		  </td>
		</tr>
		<tr>
		  <td colspan="5" style="text-align:left;">&nbsp;</td>
		</tr>
		<tr>
		  <td style="text-align:left;">12.</td>
		  <td colspan="4" style="text-align:left;">RESIKO BAHAYA</td>
		</tr>
		<tr>
		  <td style="text-align:left;">&nbsp;</td>
		  <td colspan="4" style="text-align:left;">
			<table width="100%" class="table table-border">
				<tbody>	
				<tr class="bg-dark">
				  <td style="text-align:left;width:5%;" >No</td>
				  <td style="text-align:center;" >FISIK / MENTAL</td>
				  <td style="text-align:center;" >PENYEBAB</td>
				</tr>
				<?php						
					$noi = 0;
					$resiko_bahaya_terpilih = $this->m_anjababk->resiko_bahaya_terpilih($injabdet['resiko_bahaya']);
					foreach($resiko_bahaya_terpilih as $rowresiko_bahaya){		
					$noi++;
				?>
				<tr>
				  <td style="text-align:left;width:5%;" >12.<?= $noi ?></td>
				  <td style="text-align:left;" ><?= $rowresiko_bahaya['fisik'] ?></td>
				  <td style="text-align:left;" ><?= $rowresiko_bahaya['penyebab'] ?></td>
				</tr>
				<?php
					}
				?>				
				</tbody>		  
			</table>		  
		  </td>
		</tr>
		<tr>
		  <td colspan="5" style="text-align:left;">&nbsp;</td>
		</tr>
		<tr>
		  <td colspan="5" style="text-align:left;">
			<table width="100%" class="asktable">
				<tbody>	
				<tr>
				  <td style="text-align:left;width:5%">13.</td>
				  <td colspan="4" style="text-align:left;">SYARAT JABATAN LAINNYA</td>
				</tr>
				<tr>
				  <td style="text-align:left;" >&nbsp;</td>
				  <td style="text-align:left;width:3%;" >a.</td>
				  <td style="text-align:left;width:15%;">Pangkat/Golongan</td>
				  <td style="text-align:center;width:3%;" >:</td>
				  <td style="text-align:left;line-height:1.6;" >
					<?php 
						$pangkat_terpilih = $this->m_anjababk->pangkat_terpilih($injabdet['pangkat']);
						foreach($pangkat_terpilih as $rowpangkat){	
					?>	
						<?= $rowpangkat['nama_pangkat'] ?> / <?= $rowpangkat['golongan_ruang'] ?><br>
					<?php	
						}
					?>				  
				  </td>
				</tr>	 
				<tr>
				 <td style="text-align:left;" >&nbsp;</td>
				  <td style="text-align:left;width:3%;" >b.</td>
				  <td style="text-align:left;width:15%;">Pengetahuan Kerja</td>
				  <td style="text-align:center;width:3%;" >:</td>
				  <td style="text-align:left;" ><?= $injabdet['pengetahuan_kerja'] ?></td>
				</tr>
				<tr>
				 <td style="text-align:left;" >&nbsp;</td>
				  <td style="text-align:left;width:3%;" >c.</td>
				  <td style="text-align:left;width:15%;">Keterampilan kerja</td>
				  <td style="text-align:center;width:3%;" >:</td>
				  <td style="text-align:left;" ><?= $injabdet['ketrampilan'] ?></td>
				</tr>	
				<tr>
				 <td style="text-align:left;" >&nbsp;</td>
				  <td style="text-align:left;width:3%;" >d.</td>
				  <td style="text-align:left;width:15%;">Bakat Kerja</td>
				  <td style="text-align:center;width:3%;" >:</td>
				  <td style="text-align:left;line-height:1.6;" >
					<?php 
						$bakat_kerja_terpilih = $this->m_anjababk->bakat_kerja_terpilih($injabdet['bakat_kerja']);
						foreach($bakat_kerja_terpilih as $rowbakat_kerja){	
					?>	
						<?= $rowbakat_kerja['id_bakat_kerja'] ?> (<?= $rowbakat_kerja['arti'] ?>),
					<?php	
						}
					?>				  
				  </td>
				</tr>				
				<tr>
				 <td style="text-align:left;" >&nbsp;</td>
				  <td style="text-align:left;width:3%;" >e.</td>
				  <td style="text-align:left;width:15%;">Temperamen Kerja</td>
				  <td style="text-align:center;width:3%;" >:</td>
				  <td style="text-align:left;line-height:1.6;" >
					<?php 
						$temperamen_kerja_terpilih = $this->m_anjababk->temperamen_kerja_terpilih($injabdet['temperamen_kerja']);
						foreach($temperamen_kerja_terpilih as $rowtemperamen_kerja){
					?>	
						<?= $rowtemperamen_kerja['id_temperamen_kerja'] ?> (<?= $rowtemperamen_kerja['arti'] ?>),
					<?php	
						}
					?>				  
				  </td>
				</tr>			
				<tr>
				 <td style="text-align:left;" >&nbsp;</td>
				  <td style="text-align:left;width:3%;" >f.</td>
				  <td style="text-align:left;width:15%;">Minat Kerja</td>
				  <td style="text-align:center;width:3%;" >:</td>
				  <td style="text-align:left;line-height:1.6;" >
					<?php 
						$minat_kerja_terpilih = $this->m_anjababk->minat_kerja_terpilih($injabdet['minat_kerja']);
						foreach($minat_kerja_terpilih as $rowminat_kerja){	
					?>	
						<?= $rowminat_kerja['id_minat_kerja'] ?> (<?= $rowminat_kerja['deskripsi'] ?>),
					<?php	
						}
					?>				  
				  </td>
				</tr>				
				<tr>
				 <td style="text-align:left;" >&nbsp;</td>
				  <td style="text-align:left;width:3%;" >g.</td>
				  <td style="text-align:left;width:15%;">Upaya Fisik</td>
				  <td style="text-align:center;width:3%;" >:</td>
				  <td style="text-align:left;line-height:1.6;" >
					<?php 
						$upaya_fisik_terpilih = $this->m_anjababk->upaya_fisik_terpilih($injabdet['upaya_fisik']);
						foreach($upaya_fisik_terpilih as $rowupaya_fisik_terpilih){	
					?>	
						<?= $rowupaya_fisik_terpilih['arti'] ?>,
					<?php	
						}
					?>				  
				  </td>
				</tr>			
				<tr>
				 <td style="text-align:left;" >&nbsp;</td>
				  <td style="text-align:left;width:3%;" >h.</td>
				  <td style="text-align:left;width:15%;">Fungsi Kerja</td>
				  <td style="text-align:center;width:3%;" >:</td>
				  <td style="text-align:left;line-height:1.6;" >
					<?php 
						$fungsi_kerja_terpilih = $this->m_anjababk->fungsi_kerja_terpilih($injabdet['fungsi_kerja']);
						foreach($fungsi_kerja_terpilih as $rowfungsi_kerja_terpilih){	
					?>	
						<?= $rowfungsi_kerja_terpilih['arti'] ?>,
					<?php	
						}
					?>				  
				  </td>
				</tr>				
				</tbody>		  
			</table>		  
		  </td>
		</tr>
	</tbody>
</table>