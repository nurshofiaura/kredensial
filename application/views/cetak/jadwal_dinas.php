<?php
	$this->load->view('style');
	$adata = $this->m_umum->ambil_data('a_data','id_data','1');
	$fcolor = $adata['fcolor'];
	$color = $adata['color'];
		$namaBulan = $this->m_rancak->getBulan($bulan);
		$jtext = $this->m_umum->ambil_data('ol_unit','id_unit',$this->session->unit);			
		$ins = $this->m_umum->ambil_data('kol_working','id_working',$jtext['id_instansi']);	
		$headerinstansi = $ins['nama_working'];
		$unit_name = $jtext['nama_unit'];
		$title = "Jadwal Dinas ".$unit_name." Bulan ".$namaBulan." ".$tahun;
		$foot = $this->m_umum->ambil_data('jadwal_pelengkap','id_unit',$this->session->unit);
		$text_kiri_top = $foot['text_kiri_top'];
		$text_tengah_top = $foot['text_tengah_top'];
		$text_kanan_top = $foot['text_kanan_top'];
		$text_kiri_middle = $foot['text_kiri_middle'];
		$text_tengah_middle = $foot['text_tengah_middle'];
		$text_kanan_middle = $foot['text_kanan_middle'];
		$text_kiri_bottom = $foot['text_kiri_bottom'];
		$text_tengah_bottom = $foot['text_tengah_bottom'];
		$text_kanan_bottom = $foot['text_kanan_bottom'];
		$text_kiri_nip = $foot['text_kiri_nip'];
		$text_tengah_nip = $foot['text_tengah_nip'];
		$text_kanan_nip = $foot['text_kanan_nip'];
/*		$footer1 = $jtext['footer1'];
		$footer2 = $jtext['footer2'];*/
		$kondisi=array('bulan'=>$bulan,'tahun'=>$tahun,'id_unit'=>$this->session->unit);
		$jml = $this->m_umum->jumlah_record_filter('hari_libur',$kondisi);
		if($jml == 0){
			$tgl_hari_libur = explode(',', '');
		}else{
			$offday = $this->m_umum->ambil_data_kondisi('hari_libur',$kondisi);
			$tgl_hari_libur = explode(',', $offday['tgl_hari_libur']);
		}
?>
<table class="table">
  <tr>
	<td style="vertical-align:middle;text-align:center;">
	<p style="font-size: 1em;font-weight:bold;text-align:center;line-height: 0.2;"><?php echo $headerinstansi; ?></p>
	<p style="font-size: 1em;font-weight:bold;text-align:center;line-height: 0.2;"><?php echo $title; ?></p>
	</td>
  </tr>
</table>
	  <br style="line-height:1">
		<?php
		$awal	= $tahun.'-'.$bulan.'-01';
		$tglakhir = date('t', strtotime($awal));
		$akhir	= $tahun.'-'.$bulan.'-'.$tglakhir;
		$monthbefore = $bulan - 1;
		$namaBulanbefore = $this->m_rancak->getBulan($monthbefore);
		$awalbefore	= $tahun.'-'.$monthbefore.'-01';
		$tglakhirbefore = date('t', strtotime($awalbefore));
		?>
       <table class="table">
          <thead>
            <tr>
				<th style="padding: 5;font-size: 0.8em;font-weight:bold;border: 1px solid black;background-color:#D3D3D3;color:black;vertical-align:middle;text-align:center;width:10%;">Nama Pegawai</th>
			<?php
				foreach (range(1, $tglakhir) as $number) {
					  if(in_array($number,$tgl_hari_libur)){ ?>
				<th style="padding: 5;font-size: 0.8em;font-weight:bold;border: 1px solid black;background-color:#808080;color:white;vertical-align:middle;text-align:center;width:3%;"><?php echo $number; ?></th>
					<?php
					  }else{ ?>
				<th style="padding: 5;font-size: 0.8em;font-weight:bold;border: 1px solid black;background-color:#D3D3D3;color:black;vertical-align:middle;text-align:center;width:3%;"><?php echo $number; ?></th>
					<?php
					  }
				}
			?>
            </tr>
          </thead>
		  <tbody>
				<?php
					foreach($ambil_data_pegawai as $rowambil_data_pegawai){
				?>
            <tr>
				<td style="padding: 5;font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:left;"><?php echo $rowambil_data_pegawai['nama_pegawai']; ?></td>
				<?php
				foreach (range(1, $tglakhir) as $numbers) {
					$tglenya	= $tahun.'-'.$bulan.'-'.$numbers;
					$id_pegawai	= $rowambil_data_pegawai['id_pegawai'];
					$jadwal_at = $this->m_jadwal->print_jadwal($tglenya,$id_pegawai);
					$kondisi_surat=array('id_pegawai'=>$id_pegawai,'tgl_jadwal'=>$tglenya);
					$jml=$this->m_umum->jumlah_record_filter('pegawai_jadwal',$kondisi_surat);
					if($jml == 0){
						if(in_array($numbers,$tgl_hari_libur)){ ?>
							<td style="padding: 5;font-size: 0.8em;font-weight:bold;border: 1px solid black;background-color:#808080;color:white;vertical-align:middle;text-align:center;">-</td>
						<?php
						}else{ ?>
							<td style="padding: 5;font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center">-</td>
						<?php
						}
					}else{
						foreach($jadwal_at as $rowjadwal_at){
						?>
				<td style="padding: 5;font-size: 0.8em;font-weight:bold;border: 1px solid black;background-color:<?php echo $rowjadwal_at['kode_warna']; ?>;vertical-align:middle;text-align:center;color:<?php echo $rowjadwal_at['text_warna']; ?>;">
					<?php echo $rowjadwal_at['nama_dinas_jaga']; ?>
				</td>
							<?php
						}
					}
				}
				?>
            </tr>
				<?php
					}
				?>
		  </tbody>
        </table>
				<br>
				<table width="100%" style="border:none;" cellspacing="0" cellpadding="0">
				<tr>
				<td style="font-weight:bold;vertical-align:middle;text-align:center;width:30%;font-size:13px;">
				<?php echo $text_kiri_top; ?><br>
				<?php echo $text_kiri_middle; ?><br><br><br>
				<?php echo $text_kiri_bottom; ?><br>
				<?php echo $text_kiri_nip; ?>
				</td>
				<td style="vertical-align:middle;text-align:center;width:5%;font-size:13px;">&nbsp;</td>
				<td style="font-weight:bold;vertical-align:middle;text-align:center;width:30%;font-size:13px;">
				<?php echo $text_tengah_top; ?><br>
				<?php echo $text_tengah_middle; ?><br><br><br>
				<?php echo $text_tengah_bottom; ?><br>
				<?php echo $text_tengah_nip; ?>
				</td>
				<td style="vertical-align:middle;text-align:center;width:5%;font-size:13px;">&nbsp;</td>
				<td style="font-weight:bold;vertical-align:middle;text-align:center;width:30%;font-size:13px;">
				<?php echo $text_kanan_top; ?>, <?php echo $tglakhirbefore.' '.$namaBulanbefore.' '.$tahun; ?><br>
				<?php echo $text_kanan_middle; ?><br><br><br>
				<?php echo $text_kanan_bottom; ?><br>
				<?php echo $text_kanan_nip; ?>
				</td>
				</tr>
				</table>
