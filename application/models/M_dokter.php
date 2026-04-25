<?php
class M_dokter extends CI_model{
	function pendaftaran_all($first_date,$last_date,$key)
	{
	//	$ids = explode(',', $unit);
		$wordsAry = explode("-", $key);
		$wordsCount = count($wordsAry);
		$fields = "*,
			if (p.jk = '1' ,'Laki-laki','Perempuan') as jk,p.nik,p.tmp_lahir,drpmr.nama_pegawai as pj,
			if (p.id_golongan_darah = '0' ,'Belum Ada Data',nama_golongan_darah) as nama_golongan_darah,
			if (p.id_agama = '0' ,'Belum Ada Data',nama_agama) as nama_agama,drpeg.nama_pegawai as internal,
			if (p.id_pekerjaan = '0' ,'Belum Ada Data',nama_pekerjaan) as nama_pekerjaan,
			if (p.id_status_kawin = '0' ,'Belum Ada Data',nama_status_kawin) as nama_status_kawin,
			if (p.id_pendidikan = '0' ,'Belum Ada Data',nama_pendidikan) as nama_pendidikan,
			if (p.id_prov = '0' ,'Belum Ada Data',nama_prov) as nama_prov,pu.barcode_pendaftaran_unit as barcode_pendaftaran_unit,
			if(pu.id_status_pasien = 0,'Batal',nama_status_pasien) as nama_status_pasien,pu.barcode_pendaftaran as barcode_pendaftaran,
			if (p.id_kab = '0' ,'Belum Ada Data',nama_kab) as nama_kab,
			if (p.id_kec = '0' ,'Belum Ada Data',nama_kec) as nama_kec,
			if (p.id_kel = '0' ,'Belum Ada Data',nama_kel) as nama_kel,
			CONCAT((TIMESTAMPDIFF( YEAR, p.tgl_lahir, tgl_pendaftaran_unit )), ' Tahun ',
			TIMESTAMPDIFF( MONTH, p.tgl_lahir, tgl_pendaftaran_unit ) % 12, ' Bulan ',
			FLOOR( TIMESTAMPDIFF( DAY, p.tgl_lahir, tgl_pendaftaran_unit ) % 30.4375 ), ' Hari') as umur,u.nama_unit,
			DATE_FORMAT(p.tgl_lahir,'%d-%m-%Y') as tgl_lahir,DATE_FORMAT(p.dibuat,'%d-%m-%Y %H:%i:%s') as dibuat,peg2.nama_pegawai as petugas,
			pd.id_pendaftaran, pu.id_pendaftaran_unit,if (pd.penunjang = '1' ,'LENGKAP','TIDAK LENGKAP') as v_sign,
			DATE_FORMAT(tgl_pendaftaran_unit,'%d-%m-%Y') as waktu_daftar, u1.nama_unit as order_unit,
			if(pd.id_cara_bayar = '6',peg1.nama_pegawai,ka.nama_detil_cara_bayar) as detil_cara_bayar,
			if(pd.id_cara_masuk = '7',u2.nama_unit,if(pd.id_instansi_cara_masuk = '0','-',nama_rujukan_instansi)) as id_instansi_cara_masuk,
			if(pd.id_cara_masuk = '7',rapen.nama_pegawai,if(pd.id_dokter_rujukan = '0','-',nama_rujukan_dokter)) as id_dokter_rujukan,
			if(pd.id_cara_masuk = 7,rapen.nama_pegawai,if(pd.id_cara_masuk = 6,peg1.nama_pegawai,if(pd.id_cara_masuk = 1,'-',if(pd.id_cara_masuk = 2,'-',nama_rujukan_dokter)))) as penjelasan_pengirim,
			if(pd.id_cara_masuk = 7,u2.nama_unit,if(pd.id_cara_masuk = 5,nama_rujukan_instansi,if(pd.id_cara_masuk = 4,nama_rujukan_instansi,if(pd.id_cara_masuk = 3,nama_rujukan_instansi,'-')))) as penjelasan_instansi
			";
	//--------- Siapkan Parameter dari datatables ---------
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));
		$order = $this->input->post('order');
		$cari = $this->input->post('search');
	//--------- Cek kolom mana yg di urut dan asc/desc -----
		$col =$order[0]['column'];
		$dir= $order[0]['dir'];

	//--------- Ambil nama field dari daftar POST columns dttables
		$dt_kolom=$this->input->post('columns');

	//--------- Mulai Query UTAMA ---------------------------
		$this->db->select($fields);  //01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan [coding here]
					case 'id_pendaftaran' : $nmf="pd.id_pendaftaran";break;
				//	case 'rm' : $nmf="pd.rm";break;
					case 'nama_unit' : $nmf="u.nama_unit";break;
					case 'jk' : $nmf='ps.jk';break;
					case 'petugas' : $nmf='peg2.nama_pegawai';break;
				//	case 'umur' : $nmf='YEAR(CURDATE()) - YEAR(ps.tgl_lahir)';break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('u1.pelayanan',0);
	//	$this->db->where('pu.id_status_pasien',1);
		$this->db->where("pendaftaran_instansi", $this->session->refer);
		if(!empty($key) || $this->input->post('key',true)){
			$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(p.rm LIKE '%".$wordsAry[$i]."%' OR p.nama_pasien LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
$this->db->where('DATE(tgl_pendaftaran_unit) BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');			
		
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('pendaftaran_unit pu');                   //04 Form.. left join
		$this->db->join('pendaftaran pd', 'pd.barcode_pendaftaran=pu.barcode_pendaftaran','left');
	//	$this->db->join('pemeriksaan pmr', 'pmr.barcode_pendaftaran_unit=pu.barcode_pendaftaran_unit','left');
		$this->db->join('pemeriksaan_icdten pmricd10', 'pmricd10.barcode_pendaftaran_unit=pu.barcode_pendaftaran_unit','left');
		$this->db->join('kol_icd10', 'kol_icd10.id_icd10=pmricd10.id_icdten','left');
		$this->db->join('pasien p', 'p.barcode_pasien=pd.barcode_pasien','left');
		$this->db->join('kol_cara_bayar cb','cb.id_cara_bayar=pd.id_cara_bayar','left');
		$this->db->join('kol_detil_cara_bayar ka','ka.id_detil_cara_bayar=pd.id_detil_cara_bayar','left');
		$this->db->join('kol_cara_masuk cm',  'cm.id_cara_masuk=pd.id_cara_masuk','left');
		$this->db->join('kol_rujukan_dokter dr','dr.id_rujukan_dokter=pd.id_dokter_rujukan','left');
		$this->db->join('kol_rujukan_instansi ir','ir.id_rujukan_instansi=pd.id_instansi_cara_masuk','left');
		$this->db->join('kol_status_pasien sp', 'sp.id_status_pasien=pu.id_status_pasien','left');
		$this->db->join('kol_kelas kkl', 'kkl.id_kelas=pu.id_kelas','left');
		$this->db->join('ol_pegawai rapen',     'rapen.id_pegawai=pd.id_dokter_rujukan','left');
		$this->db->join('ol_pegawai peg1','peg1.id_pegawai=pd.id_detil_cara_bayar','left');
		$this->db->join('ol_pegawai peg2','peg2.id_pegawai=pu.pembuat_pendaftaran_unit','left');
		$this->db->join('ol_pegawai drpeg','drpeg.id_pegawai=pu.dr_pengirim','left');
		$this->db->join('ol_pegawai drpmr','drpmr.id_pegawai=pu.dr_petugas','left');
		$this->db->join('ol_unit u','u.id_unit=pu.id_unit','left');
		$this->db->join('ol_unit u1','u1.id_unit=pu.unit_ke','left');
		$this->db->join('ol_unit u2','u2.id_unit=pd.id_instansi_cara_masuk','left');
		$this->db->join('kol_agama a', 'a.id_agama=p.id_agama','left');
		$this->db->join('kol_golongan_darah kgd', 'kgd.id_golongan_darah=p.id_golongan_darah','left');
		$this->db->join('kol_pendidikan pend', 'pend.id_pendidikan=p.id_pendidikan','left');
		$this->db->join('kol_pekerjaan kp', 'kp.id_pekerjaan=p.id_pekerjaan','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=p.id_status_kawin','left');
		$this->db->join('kol_provinsi provi', 'provi.id_prov=p.id_prov','left');
		$this->db->join('kol_kabupaten kabu', 'kabu.id_kab=p.id_kab','left');
		$this->db->join('kol_kecamatan keca', 'keca.id_kec=p.id_kec','left');
		$this->db->join('kol_kelurahan kelu', 'kelu.id_kel=p.id_kel','left');
		$this->db->join('kol_working kw', 'kw.id_working=pendaftaran_instansi','left');
		$this->db->where('u1.pelayanan',0);
	//	$this->db->where('pu.id_status_pasien',1);
		$this->db->where("pendaftaran_instansi", $this->session->refer);

		if(!empty($key) || $this->input->post('key',true)){
			$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(p.rm LIKE '%".$wordsAry[$i]."%' OR p.nama_pasien LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
$this->db->where('DATE(tgl_pendaftaran_unit) BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');			
		

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
					case 'id_pendaftaran' : $nmf="pd.id_pendaftaran";break;
				//	case 'rm' : $nmf="pd.rm";break;
					case 'nama_unit' : $nmf="u.nama_unit";break;
					case 'jk' : $nmf='ps.jk';break;
					case 'petugas' : $nmf='peg2.nama_pegawai';break;
				//	case 'umur' : $nmf='YEAR(CURDATE()) - YEAR(ps.tgl_lahir)';break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('u1.pelayanan',0);
	//	$this->db->where('pu.id_status_pasien',1);
		$this->db->where("pendaftaran_instansi", $this->session->refer);
		if(!empty($key) || $this->input->post('key',true)){
			$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(p.rm LIKE '%".$wordsAry[$i]."%' OR p.nama_pasien LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
$this->db->where('DATE(tgl_pendaftaran_unit) BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');			
		
			}
		  }
		}
		$this->db->from('pendaftaran_unit pu');                   //04 Form.. left join
		$this->db->join('pendaftaran pd', 'pd.barcode_pendaftaran=pu.barcode_pendaftaran','left');
	//	$this->db->join('pemeriksaan pmr', 'pmr.barcode_pendaftaran_unit=pu.barcode_pendaftaran_unit','left');
		$this->db->join('pemeriksaan_icdten pmricd10', 'pmricd10.barcode_pendaftaran_unit=pu.barcode_pendaftaran_unit','left');
		$this->db->join('kol_icd10', 'kol_icd10.id_icd10=pmricd10.id_icdten','left');
		$this->db->join('pasien p', 'p.barcode_pasien=pd.barcode_pasien','left');
		$this->db->join('kol_cara_bayar cb','cb.id_cara_bayar=pd.id_cara_bayar','left');
		$this->db->join('kol_detil_cara_bayar ka','ka.id_detil_cara_bayar=pd.id_detil_cara_bayar','left');
		$this->db->join('kol_cara_masuk cm',  'cm.id_cara_masuk=pd.id_cara_masuk','left');
		$this->db->join('kol_rujukan_dokter dr','dr.id_rujukan_dokter=pd.id_dokter_rujukan','left');
		$this->db->join('kol_rujukan_instansi ir','ir.id_rujukan_instansi=pd.id_instansi_cara_masuk','left');
		$this->db->join('kol_status_pasien sp', 'sp.id_status_pasien=pu.id_status_pasien','left');
		$this->db->join('kol_kelas kkl', 'kkl.id_kelas=pu.id_kelas','left');
		$this->db->join('ol_pegawai rapen',     'rapen.id_pegawai=pd.id_dokter_rujukan','left');
		$this->db->join('ol_pegawai peg1','peg1.id_pegawai=pd.id_detil_cara_bayar','left');
		$this->db->join('ol_pegawai peg2','peg2.id_pegawai=pu.pembuat_pendaftaran_unit','left');
		$this->db->join('ol_pegawai drpeg','drpeg.id_pegawai=pu.dr_pengirim','left');
		$this->db->join('ol_pegawai drpmr','drpmr.id_pegawai=pu.dr_petugas','left');
		$this->db->join('ol_unit u','u.id_unit=pu.id_unit','left');
		$this->db->join('ol_unit u1','u1.id_unit=pu.unit_ke','left');
		$this->db->join('ol_unit u2','u2.id_unit=pd.id_instansi_cara_masuk','left');
		$this->db->join('kol_agama a', 'a.id_agama=p.id_agama','left');
		$this->db->join('kol_golongan_darah kgd', 'kgd.id_golongan_darah=p.id_golongan_darah','left');
		$this->db->join('kol_pendidikan pend', 'pend.id_pendidikan=p.id_pendidikan','left');
		$this->db->join('kol_pekerjaan kp', 'kp.id_pekerjaan=p.id_pekerjaan','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=p.id_status_kawin','left');
		$this->db->join('kol_provinsi provi', 'provi.id_prov=p.id_prov','left');
		$this->db->join('kol_kabupaten kabu', 'kabu.id_kab=p.id_kab','left');
		$this->db->join('kol_kecamatan keca', 'keca.id_kec=p.id_kec','left');
		$this->db->join('kol_kelurahan kelu', 'kelu.id_kel=p.id_kel','left');
		$this->db->join('kol_working kw', 'kw.id_working=pendaftaran_instansi','left');
		$this->db->where('u1.pelayanan',0);
	//	$this->db->where('pu.id_status_pasien',1);
		$this->db->where("pendaftaran_instansi", $this->session->refer);
		if(!empty($key) || $this->input->post('key',true)){
			$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(p.rm LIKE '%".$wordsAry[$i]."%' OR p.nama_pasien LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
$this->db->where('DATE(tgl_pendaftaran_unit) BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');			
		

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
	//	$kondisi=array('id_level !='=>'99');
	//	$jml = $this->m_umum->jumlah_record_filter('user',$kondisi);		//[coding here] ganti tabel utamanya
		$jml = $this->m_umum->jumlah_record_tabel('pendaftaran_unit');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function ambil_pemeriksaan_radiologi($id)
	{
		$p = $this->m_umum->ambil_data('pendaftaran_unit','barcode_pendaftaran_unit',$id);
		$array_check = array(2);
		$fields = "*,DATE_FORMAT(pmr.tgl_pemeriksaan,'%d-%m-%Y') as tgl_pemeriksaan,FORMAT(nominal_billing,'#,###,##0') as number_billing";
	//--------- Siapkan Parameter dari datatables ---------
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$cari = $this->input->post("search");
	//--------- Cek kolom mana yg di urut dan asc/desc -----
		$col =$order[0]['column'];
		$dir= $order[0]['dir'];

	//--------- Ambil nama field dari daftar POST columns dttables
		$dt_kolom=$this->input->post("columns");

	//--------- Mulai Query UTAMA ---------------------------
		$this->db->select($fields);  //01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan [coding here]
					// case 'telp' : $nmf="peg.telp";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where_in('kgp.id_unit', $array_check);
		$this->db->where('pu.barcode_pendaftaran', $p['barcode_pendaftaran']);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	  	$this->db->from('billing b');
		$this->db->join('pemeriksaan pmr', 'pmr.barcode_pemeriksaan=b.barcode_pemeriksaan','left');
		$this->db->join('pendaftaran_unit pu', 'pu.barcode_pendaftaran_unit=pmr.barcode_pendaftaran_unit','left');
		$this->db->join('kol_kelas kk', 'kk.id_kelas=pu.id_kelas','left');
		$this->db->join('tindakan_tarif tt', 'tt.barcode_tindakan_tarif=b.barcode_tindakan_tarif','left');
		$this->db->join('tindakan t', 't.id_tindakan=tt.id_tindakan','left');
		$this->db->join('kol_golongan_pemeriksaan kgp', 'kgp.id_golongan_pemeriksaan=t.id_golongan_pemeriksaan','left');
		$this->db->where_in('kgp.id_unit', $array_check);
		$this->db->where('pu.barcode_pendaftaran', $p['barcode_pendaftaran']);

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'telp' : $nmf="peg.telp";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where_in('kgp.id_unit', $array_check);
		$this->db->where('pu.barcode_pendaftaran', $p['barcode_pendaftaran']);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	  	$this->db->from('billing b');
		$this->db->join('pemeriksaan pmr', 'pmr.barcode_pemeriksaan=b.barcode_pemeriksaan','left');
		$this->db->join('pendaftaran_unit pu', 'pu.barcode_pendaftaran_unit=pmr.barcode_pendaftaran_unit','left');
		$this->db->join('kol_kelas kk', 'kk.id_kelas=pu.id_kelas','left');
		$this->db->join('tindakan_tarif tt', 'tt.barcode_tindakan_tarif=b.barcode_tindakan_tarif','left');
		$this->db->join('tindakan t', 't.id_tindakan=tt.id_tindakan','left');
		$this->db->join('kol_golongan_pemeriksaan kgp', 'kgp.id_golongan_pemeriksaan=t.id_golongan_pemeriksaan','left');
		$this->db->where_in('kgp.id_unit', $array_check);
		$this->db->where('pu.barcode_pendaftaran', $p['barcode_pendaftaran']);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('billing');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function ambil_pemeriksaan_dokter($id)
	{
		$array_check = array(0,6);
		$fields = "*,DATE_FORMAT(pmr.tgl_pemeriksaan,'%d-%m-%Y') as tgl_pemeriksaan,FORMAT(nominal_billing,'#,###,##0') as number_billing";
	//--------- Siapkan Parameter dari datatables ---------
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$cari = $this->input->post("search");
	//--------- Cek kolom mana yg di urut dan asc/desc -----
		$col =$order[0]['column'];
		$dir= $order[0]['dir'];

	//--------- Ambil nama field dari daftar POST columns dttables
		$dt_kolom=$this->input->post("columns");

	//--------- Mulai Query UTAMA ---------------------------
		$this->db->select($fields);  //01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan [coding here]
					// case 'telp' : $nmf="peg.telp";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where_in('kgp.id_unit', $array_check);
		$this->db->where('pu.barcode_pendaftaran_unit', $id);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	  	$this->db->from('billing b');
		$this->db->join('pemeriksaan pmr', 'pmr.barcode_pemeriksaan=b.barcode_pemeriksaan','left');
		$this->db->join('pendaftaran_unit pu', 'pu.barcode_pendaftaran_unit=pmr.barcode_pendaftaran_unit','left');
		$this->db->join('kol_kelas kk', 'kk.id_kelas=pu.id_kelas','left');
		$this->db->join('tindakan_tarif tt', 'tt.barcode_tindakan_tarif=b.barcode_tindakan_tarif','left');
		$this->db->join('tindakan t', 't.id_tindakan=tt.id_tindakan','left');
		$this->db->join('kol_golongan_pemeriksaan kgp', 'kgp.id_golongan_pemeriksaan=t.id_golongan_pemeriksaan','left');
		$this->db->where_in('kgp.id_unit', $array_check);
		$this->db->where('pu.barcode_pendaftaran_unit', $id);

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'telp' : $nmf="peg.telp";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where_in('kgp.id_unit', $array_check);
		$this->db->where('pu.barcode_pendaftaran_unit', $id);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	  	$this->db->from('billing b');
		$this->db->join('pemeriksaan pmr', 'pmr.barcode_pemeriksaan=b.barcode_pemeriksaan','left');
		$this->db->join('pendaftaran_unit pu', 'pu.barcode_pendaftaran_unit=pmr.barcode_pendaftaran_unit','left');
		$this->db->join('kol_kelas kk', 'kk.id_kelas=pu.id_kelas','left');
		$this->db->join('tindakan_tarif tt', 'tt.barcode_tindakan_tarif=b.barcode_tindakan_tarif','left');
		$this->db->join('tindakan t', 't.id_tindakan=tt.id_tindakan','left');
		$this->db->join('kol_golongan_pemeriksaan kgp', 'kgp.id_golongan_pemeriksaan=t.id_golongan_pemeriksaan','left');
		$this->db->where_in('kgp.id_unit', $array_check);
		$this->db->where('pu.barcode_pendaftaran_unit', $id);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('billing');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function ambil_pemeriksaan_labe($id)
	{
		$p = $this->m_umum->ambil_data('pendaftaran_unit','barcode_pendaftaran_unit',$id);
		$array_check = array(3);
		$fields = "*,DATE_FORMAT(pmr.tgl_pemeriksaan,'%d-%m-%Y') as tgl_pemeriksaan,FORMAT(nominal_billing,'#,###,##0') as number_billing";
	//--------- Siapkan Parameter dari datatables ---------
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$cari = $this->input->post("search");
	//--------- Cek kolom mana yg di urut dan asc/desc -----
		$col =$order[0]['column'];
		$dir= $order[0]['dir'];

	//--------- Ambil nama field dari daftar POST columns dttables
		$dt_kolom=$this->input->post("columns");

	//--------- Mulai Query UTAMA ---------------------------
		$this->db->select($fields);  //01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan [coding here]
					// case 'telp' : $nmf="peg.telp";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where_in('kgp.id_unit', $array_check);
		$this->db->where('pu.barcode_pendaftaran', $p['barcode_pendaftaran']);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	  	$this->db->from('billing b');
		$this->db->join('pemeriksaan pmr', 'pmr.barcode_pemeriksaan=b.barcode_pemeriksaan','left');
		$this->db->join('pendaftaran_unit pu', 'pu.barcode_pendaftaran_unit=pmr.barcode_pendaftaran_unit','left');
		$this->db->join('kol_kelas kk', 'kk.id_kelas=pu.id_kelas','left');
		$this->db->join('tindakan_tarif tt', 'tt.barcode_tindakan_tarif=b.barcode_tindakan_tarif','left');
		$this->db->join('tindakan t', 't.id_tindakan=tt.id_tindakan','left');
		$this->db->join('kol_golongan_pemeriksaan kgp', 'kgp.id_golongan_pemeriksaan=t.id_golongan_pemeriksaan','left');
		$this->db->where_in('kgp.id_unit', $array_check);
		$this->db->where('pu.barcode_pendaftaran', $p['barcode_pendaftaran']);

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'telp' : $nmf="peg.telp";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where_in('kgp.id_unit', $array_check);
		$this->db->where('pu.barcode_pendaftaran', $p['barcode_pendaftaran']);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	  	$this->db->from('billing b');
		$this->db->join('pemeriksaan pmr', 'pmr.barcode_pemeriksaan=b.barcode_pemeriksaan','left');
		$this->db->join('pendaftaran_unit pu', 'pu.barcode_pendaftaran_unit=pmr.barcode_pendaftaran_unit','left');
		$this->db->join('kol_kelas kk', 'kk.id_kelas=pu.id_kelas','left');
		$this->db->join('tindakan_tarif tt', 'tt.barcode_tindakan_tarif=b.barcode_tindakan_tarif','left');
		$this->db->join('tindakan t', 't.id_tindakan=tt.id_tindakan','left');
		$this->db->join('kol_golongan_pemeriksaan kgp', 'kgp.id_golongan_pemeriksaan=t.id_golongan_pemeriksaan','left');
		$this->db->where_in('kgp.id_unit', $array_check);
		$this->db->where('pu.barcode_pendaftaran', $p['barcode_pendaftaran']);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('billing');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function pemeriksaan_penunjang_all($ids)
	{
		$id = $this->m_umum->ambil_data('pendaftaran_unit','barcode_pendaftaran_unit',$ids);
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,DATE_FORMAT(pp.tgl_pemeriksaan_penunjang,'%d-%m-%Y') as tgl_pemeriksaan_penunjang";
	//--------- Siapkan Parameter dari datatables ---------
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$cari = $this->input->post("search");
	//--------- Cek kolom mana yg di urut dan asc/desc -----
		$col =$order[0]['column'];
		$dir= $order[0]['dir'];

	//--------- Ambil nama field dari daftar POST columns dttables
		$dt_kolom=$this->input->post("columns");

	//--------- Mulai Query UTAMA ---------------------------
		$this->db->select($fields);  //01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan [coding here]
					// case 'telp' : $nmf="peg.telp";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	  $this->db->from('pemeriksaan_penunjang pp');
		$this->db->join('tindakan t', 't.id_tindakan=pp.id_tindakan','left');
		$this->db->join('ol_pegawai op', 'op.id_pegawai=pp.pembuat_pemeriksaan_penunjang','left');
		$this->db->where('pp.barcode_pendaftaran', $id['barcode_pendaftaran']);

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'telp' : $nmf="peg.telp";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	$this->db->from('pemeriksaan_penunjang pp');
		$this->db->join('tindakan t', 't.id_tindakan=pp.id_tindakan','left');
		$this->db->join('ol_pegawai op', 'op.id_pegawai=pp.pembuat_pemeriksaan_penunjang','left');
	$this->db->where('pp.barcode_pendaftaran', $id['barcode_pendaftaran']);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('pemeriksaan_penunjang');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function pmr_has_pmr_all($first_date,$last_date,$key)
	{
	//	$ids = explode(',', $unit);
		$wordsAry = explode("-", $key);
		$wordsCount = count($wordsAry);
		$fields = "*,
			if (p.jk = '1' ,'Laki-laki','Perempuan') as jk,p.nik,p.tmp_lahir,drpmr.nama_pegawai as pj,
			if (p.id_golongan_darah = '0' ,'Belum Ada Data',nama_golongan_darah) as nama_golongan_darah,
			if (p.id_agama = '0' ,'Belum Ada Data',nama_agama) as nama_agama,drpeg.nama_pegawai as internal,
			if (p.id_pekerjaan = '0' ,'Belum Ada Data',nama_pekerjaan) as nama_pekerjaan,
			if (p.id_status_kawin = '0' ,'Belum Ada Data',nama_status_kawin) as nama_status_kawin,
			if (p.id_pendidikan = '0' ,'Belum Ada Data',nama_pendidikan) as nama_pendidikan,
			if (p.id_prov = '0' ,'Belum Ada Data',nama_prov) as nama_prov,pu.barcode_pendaftaran_unit as barcode_pendaftaran_unit,
			if(pu.id_status_pasien = 0,'Batal',nama_status_pasien) as nama_status_pasien,pu.barcode_pendaftaran as barcode_pendaftaran,
			if (p.id_kab = '0' ,'Belum Ada Data',nama_kab) as nama_kab,
			if (p.id_kec = '0' ,'Belum Ada Data',nama_kec) as nama_kec,
			if (p.id_kel = '0' ,'Belum Ada Data',nama_kel) as nama_kel,
			CONCAT((TIMESTAMPDIFF( YEAR, p.tgl_lahir, tgl_pendaftaran_unit )), ' Tahun ',
			TIMESTAMPDIFF( MONTH, p.tgl_lahir, tgl_pendaftaran_unit ) % 12, ' Bulan ',
			FLOOR( TIMESTAMPDIFF( DAY, p.tgl_lahir, tgl_pendaftaran_unit ) % 30.4375 ), ' Hari') as umur,u.nama_unit,
			DATE_FORMAT(p.tgl_lahir,'%d-%m-%Y') as tgl_lahir,DATE_FORMAT(p.dibuat,'%d-%m-%Y %H:%i:%s') as dibuat,peg2.nama_pegawai as petugas,
			pd.id_pendaftaran, pu.id_pendaftaran_unit,if (pd.penunjang = '1' ,'LENGKAP','TIDAK LENGKAP') as v_sign,
			DATE_FORMAT(tgl_pendaftaran_unit,'%d-%m-%Y') as waktu_daftar, u1.nama_unit as order_unit,
			if(pd.id_cara_bayar = '6',peg1.nama_pegawai,ka.nama_detil_cara_bayar) as detil_cara_bayar,
			if(pd.id_cara_masuk = '7',u2.nama_unit,if(pd.id_instansi_cara_masuk = '0','-',nama_rujukan_instansi)) as id_instansi_cara_masuk,
			if(pd.id_cara_masuk = '7',rapen.nama_pegawai,if(pd.id_dokter_rujukan = '0','-',nama_rujukan_dokter)) as id_dokter_rujukan,
			concat('Keluhan : ',keluhan,' - Ket Pendaftaran : ',ket_pendaftaran_unit,' - Keterangan Pmr: ',ket_pemeriksaan) as keluhan
			";
	//--------- Siapkan Parameter dari datatables ---------
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));
		$order = $this->input->post('order');
		$cari = $this->input->post('search');
	//--------- Cek kolom mana yg di urut dan asc/desc -----
		$col =$order[0]['column'];
		$dir= $order[0]['dir'];

	//--------- Ambil nama field dari daftar POST columns dttables
		$dt_kolom=$this->input->post('columns');

	//--------- Mulai Query UTAMA ---------------------------
		$this->db->select($fields);  //01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan [coding here]
					case 'id_pendaftaran' : $nmf="pd.id_pendaftaran";break;
				//	case 'rm' : $nmf="pd.rm";break;
					case 'nama_unit' : $nmf="u.nama_unit";break;
					case 'jk' : $nmf='ps.jk';break;
					case 'petugas' : $nmf='peg2.nama_pegawai';break;
				//	case 'umur' : $nmf='YEAR(CURDATE()) - YEAR(ps.tgl_lahir)';break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where_in('pu.unit_ke',6);
		$this->db->where('pu.id_status_pasien',2);
//		if(!empty($this->session->userdata('bekerja'))){
			$this->db->where("pendaftaran_instansi", $this->session->refer);
//		}
		if(!empty($key) || $this->input->post('key',true)){
			$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(p.rm LIKE '%".$wordsAry[$i]."%' OR p.nama_pasien LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
$this->db->where('DATE(tgl_pendaftaran_unit) BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');			
		
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('pemeriksaan pmr');                   //04 Form.. left join
		$this->db->join('billing bl', 'bl.barcode_pemeriksaan=pmr.barcode_pemeriksaan','left');
		$this->db->join('tindakan_tarif tt', 'tt.barcode_tindakan_tarif=bl.barcode_tindakan_tarif','left');
		$this->db->join('tindakan t', 't.id_tindakan=tt.id_tindakan','left');
		$this->db->join('pendaftaran_unit pu', 'pu.barcode_pendaftaran_unit=pmr.barcode_pendaftaran_unit','left');
		$this->db->join('pendaftaran pd', 'pd.barcode_pendaftaran=pu.barcode_pendaftaran','left');
		$this->db->join('pemeriksaan_icdten pmricd10', 'pmricd10.barcode_pendaftaran_unit=pu.barcode_pendaftaran_unit','left');
		$this->db->join('kol_icd10', 'kol_icd10.id_icd10=pmricd10.id_icdten','left');
		$this->db->join('pasien p', 'p.barcode_pasien=pd.barcode_pasien','left');
		$this->db->join('kol_cara_bayar cb','cb.id_cara_bayar=pd.id_cara_bayar','left');
		$this->db->join('kol_detil_cara_bayar ka','ka.id_detil_cara_bayar=pd.id_detil_cara_bayar','left');
		$this->db->join('kol_cara_masuk cm',  'cm.id_cara_masuk=pd.id_cara_masuk','left');
		$this->db->join('kol_rujukan_dokter dr','dr.id_rujukan_dokter=pd.id_dokter_rujukan','left');
		$this->db->join('kol_rujukan_instansi ir','ir.id_rujukan_instansi=pd.id_instansi_cara_masuk','left');
		$this->db->join('kol_status_pasien sp', 'sp.id_status_pasien=pu.id_status_pasien','left');
		$this->db->join('kol_kelas kkl', 'kkl.id_kelas=pu.id_kelas','left');
		$this->db->join('ol_pegawai rapen',     'rapen.id_pegawai=pd.id_dokter_rujukan','left');
		$this->db->join('ol_pegawai peg1','peg1.id_pegawai=pd.id_detil_cara_bayar','left');
		$this->db->join('ol_pegawai peg2','peg2.id_pegawai=pu.pembuat_pendaftaran_unit','left');
		$this->db->join('ol_pegawai drpeg','drpeg.id_pegawai=pu.dr_pengirim','left');
		$this->db->join('ol_pegawai drpmr','drpmr.id_pegawai=pu.dr_petugas','left');
		$this->db->join('ol_unit u','u.id_unit=pu.id_unit','left');
		$this->db->join('ol_unit u1','u1.id_unit=pu.unit_ke','left');
		$this->db->join('ol_unit u2','u2.id_unit=pd.id_instansi_cara_masuk','left');
		$this->db->join('kol_agama a', 'a.id_agama=p.id_agama','left');
		$this->db->join('kol_golongan_darah kgd', 'kgd.id_golongan_darah=p.id_golongan_darah','left');
		$this->db->join('kol_pendidikan pend', 'pend.id_pendidikan=p.id_pendidikan','left');
		$this->db->join('kol_pekerjaan kp', 'kp.id_pekerjaan=p.id_pekerjaan','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=p.id_status_kawin','left');
		$this->db->join('kol_provinsi provi', 'provi.id_prov=p.id_prov','left');
		$this->db->join('kol_kabupaten kabu', 'kabu.id_kab=p.id_kab','left');
		$this->db->join('kol_kecamatan keca', 'keca.id_kec=p.id_kec','left');
		$this->db->join('kol_kelurahan kelu', 'kelu.id_kel=p.id_kel','left');
		$this->db->join('kol_working kw', 'kw.id_working=pendaftaran_instansi','left');
		$this->db->where_in('pu.unit_ke',6);
		$this->db->where('pu.id_status_pasien',2);
//		if(!empty($this->session->userdata('bekerja'))){
			$this->db->where("pendaftaran_instansi", $this->session->refer);
//		}
		if(!empty($key) || $this->input->post('key',true)){
			$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(p.rm LIKE '%".$wordsAry[$i]."%' OR p.nama_pasien LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
$this->db->where('DATE(tgl_pendaftaran_unit) BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');			
		

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
					case 'id_pendaftaran' : $nmf="pd.id_pendaftaran";break;
				//	case 'rm' : $nmf="pd.rm";break;
					case 'nama_unit' : $nmf="u.nama_unit";break;
					case 'jk' : $nmf='ps.jk';break;
					case 'petugas' : $nmf='peg2.nama_pegawai';break;
				//	case 'umur' : $nmf='YEAR(CURDATE()) - YEAR(ps.tgl_lahir)';break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where_in('pu.unit_ke',6);
		$this->db->where('pu.id_status_pasien',2);
//		if(!empty($this->session->userdata('bekerja'))){
			$this->db->where("pendaftaran_instansi", $this->session->refer);
//		}
		if(!empty($key) || $this->input->post('key',true)){
			$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(p.rm LIKE '%".$wordsAry[$i]."%' OR p.nama_pasien LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
$this->db->where('DATE(tgl_pendaftaran_unit) BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');			
		
			}
		  }
		}

		$this->db->from('pemeriksaan pmr');                   //04 Form.. left join
		$this->db->join('billing bl', 'bl.barcode_pemeriksaan=pmr.barcode_pemeriksaan','left');
		$this->db->join('tindakan_tarif tt', 'tt.barcode_tindakan_tarif=bl.barcode_tindakan_tarif','left');
		$this->db->join('tindakan t', 't.id_tindakan=tt.id_tindakan','left');
		$this->db->join('pendaftaran_unit pu', 'pu.barcode_pendaftaran_unit=pmr.barcode_pendaftaran_unit','left');
		$this->db->join('pendaftaran pd', 'pd.barcode_pendaftaran=pu.barcode_pendaftaran','left');
		$this->db->join('pemeriksaan_icdten pmricd10', 'pmricd10.barcode_pendaftaran_unit=pu.barcode_pendaftaran_unit','left');
		$this->db->join('kol_icd10', 'kol_icd10.id_icd10=pmricd10.id_icdten','left');
		$this->db->join('pasien p', 'p.barcode_pasien=pd.barcode_pasien','left');
		$this->db->join('kol_cara_bayar cb','cb.id_cara_bayar=pd.id_cara_bayar','left');
		$this->db->join('kol_detil_cara_bayar ka','ka.id_detil_cara_bayar=pd.id_detil_cara_bayar','left');
		$this->db->join('kol_cara_masuk cm',  'cm.id_cara_masuk=pd.id_cara_masuk','left');
		$this->db->join('kol_rujukan_dokter dr','dr.id_rujukan_dokter=pd.id_dokter_rujukan','left');
		$this->db->join('kol_rujukan_instansi ir','ir.id_rujukan_instansi=pd.id_instansi_cara_masuk','left');
		$this->db->join('kol_status_pasien sp', 'sp.id_status_pasien=pu.id_status_pasien','left');
		$this->db->join('kol_kelas kkl', 'kkl.id_kelas=pu.id_kelas','left');
		$this->db->join('ol_pegawai rapen',     'rapen.id_pegawai=pd.id_dokter_rujukan','left');
		$this->db->join('ol_pegawai peg1','peg1.id_pegawai=pd.id_detil_cara_bayar','left');
		$this->db->join('ol_pegawai peg2','peg2.id_pegawai=pu.pembuat_pendaftaran_unit','left');
		$this->db->join('ol_pegawai drpeg','drpeg.id_pegawai=pu.dr_pengirim','left');
		$this->db->join('ol_pegawai drpmr','drpmr.id_pegawai=pu.dr_petugas','left');
		$this->db->join('ol_unit u','u.id_unit=pu.id_unit','left');
		$this->db->join('ol_unit u1','u1.id_unit=pu.unit_ke','left');
		$this->db->join('ol_unit u2','u2.id_unit=pd.id_instansi_cara_masuk','left');
		$this->db->join('kol_agama a', 'a.id_agama=p.id_agama','left');
		$this->db->join('kol_golongan_darah kgd', 'kgd.id_golongan_darah=p.id_golongan_darah','left');
		$this->db->join('kol_pendidikan pend', 'pend.id_pendidikan=p.id_pendidikan','left');
		$this->db->join('kol_pekerjaan kp', 'kp.id_pekerjaan=p.id_pekerjaan','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=p.id_status_kawin','left');
		$this->db->join('kol_provinsi provi', 'provi.id_prov=p.id_prov','left');
		$this->db->join('kol_kabupaten kabu', 'kabu.id_kab=p.id_kab','left');
		$this->db->join('kol_kecamatan keca', 'keca.id_kec=p.id_kec','left');
		$this->db->join('kol_kelurahan kelu', 'kelu.id_kel=p.id_kel','left');
		$this->db->join('kol_working kw', 'kw.id_working=pendaftaran_instansi','left');
		$this->db->where_in('pu.unit_ke',6);
		$this->db->where('pu.id_status_pasien',2);
//		if(!empty($this->session->userdata('bekerja'))){
			$this->db->where("pendaftaran_instansi", $this->session->refer);
//		}
		if(!empty($key) || $this->input->post('key',true)){
			$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(p.rm LIKE '%".$wordsAry[$i]."%' OR p.nama_pasien LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
$this->db->where('DATE(tgl_pendaftaran_unit) BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');			
		

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
	//	$kondisi=array('id_level !='=>'99');
	//	$jml = $this->m_umum->jumlah_record_filter('user',$kondisi);		//[coding here] ganti tabel utamanya
		$jml = $this->m_umum->jumlah_record_tabel('pemeriksaan');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_pemeriksaan_dokter(){
		$kode = $this->m_rancak->kode_generator(15,'PD');
		if($this->input->post('id_icd101')){
			$id1 = $this->input->post('id_icd101');
		}else{
			$id1 = 0;
		}
		if($this->input->post('id_icd102')){
			$id2 = $this->input->post('id_icd102');
		}else{
			$id2 = 0;
		}
		if($this->input->post('id_icd103')){
			$id3 = $this->input->post('id_icd103');
		}else{
			$id3 = 0;
		}
		$data_kewenangan = array(
			'barcode_pemeriksaan_dokter' => $kode,
			'barcode_pendaftaran_unit' => $this->input->post('barcode_pendaftaran_unit'),
			'subjective' => $this->input->post('subjective'),
			'objective' => $this->input->post('objective'),
			'asesment' => $this->input->post('asesment'),
			'planning' => $this->input->post('planning'),
			'implementasi' => $this->input->post('implementasi'),
			'id_icdten1' => $id1,
			'id_icdten2' => $id2,
			'id_icdten3' => $id3,
			'id_nilai_kritis' => $this->input->post('id_nilai_kritis'),
			'id_dokter' => $this->session->id_pegawai
		);
		return $this->db->insert('pemeriksaan_dokter', $data_kewenangan);
	}
	function simpan_permintaan_lobby(){
		$barcode_pendaftaran_unit = $this->input->post('barcode_pendaftaran_unit');
		$unit_ke_lobby = $this->input->post('unit_ke_lobby');
		$ket_lobby = $this->input->post('ket_lobby');
		$chk = $this->input->post('chk[]');
		$eimplo = implode(",",$chk);
		$kode = $this->m_rancak->kode_generator(15,'PL');
		$data_pendaftaran = array(
			'barcode_lobby' => $kode,
			'barcode_pendaftaran_unit' => $barcode_pendaftaran_unit,
			'unit_ke_lobby' => $unit_ke_lobby,
			'ket_lobby' => $ket_lobby,
			'id_unit_lobby' => $this->session->unit,
			'id_dokter' => $this->session->id_pegawai,
			'id_instansi' => $this->session->refer,
			'tindakan' => $eimplo
		);
		$this->db->insert('pendaftaran_lobby', $data_pendaftaran);
	}
	function edit_permintaan_lobby(){
		$barcode_pendaftaran_unit = $this->input->post('barcode_pendaftaran_unit');
		$unit_ke_lobby = $this->input->post('unit_ke_lobby');
		$ket_lobby = $this->input->post('ket_lobby');
		$chk = $this->input->post('chk[]');
		$eimplo = implode(",",$chk);		
		$data_pendaftaran = array(
			'tindakan' => $eimplo,
			'ket_lobby' => $ket_lobby
		);
		$this->db->where('barcode_pendaftaran_unit',$barcode_pendaftaran_unit);
		$this->db->where('unit_ke_lobby',$unit_ke_lobby);
		$this->db->update('pendaftaran_lobby', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
}
