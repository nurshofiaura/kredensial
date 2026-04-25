<?php
class M_radiolog extends CI_model{
	function normal_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*";
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
		$this->db->where('id_dokter',$this->session->id_pegawai);
		$this->db->where('status_pemeriksaan_format',1);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('pemeriksaan_format pf');
		$this->db->join('tindakan t', 't.id_tindakan=pf.id_tindakan','left');
		$this->db->where('id_dokter',$this->session->id_pegawai);
		$this->db->where('status_pemeriksaan_format',1);

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
		$this->db->where('id_dokter',$this->session->id_pegawai);
		$this->db->where('status_pemeriksaan_format',1);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('pemeriksaan_format pf');
		$this->db->join('tindakan t', 't.id_tindakan=pf.id_tindakan','left');
		$this->db->where('id_dokter',$this->session->id_pegawai);
		$this->db->where('status_pemeriksaan_format',1);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('pemeriksaan_format');		//[coding here] ganti tabel utamanya
				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;	
	}
	function simpan_normal(){
		$data_pendaftaran = array(
			'nama_pemeriksaan_format' => $this->input->post('nama_pemeriksaan_format'),
			'id_tindakan' => $this->input->post('id_tindakan'),
			'id_dokter' => $this->session->id_pegawai,
			'hasil_pemeriksaan_format' => $this->input->post('hasil_pemeriksaan_format'),
			'kesimpulan_pemeriksaan_format' => $this->input->post('kesimpulan_pemeriksaan_format')
		);
		return $this->db->insert('pemeriksaan_format', $data_pendaftaran);
	}
	function edit_normal(){
		$id_pemeriksaan_format = $this->input->post('id_pemeriksaan_format');
		$data_pendaftaran = array(
			'nama_pemeriksaan_format' => $this->input->post('nama_pemeriksaan_format'),
			'hasil_pemeriksaan_format' => $this->input->post('hasil_pemeriksaan_format'),
			'kesimpulan_pemeriksaan_format' => $this->input->post('kesimpulan_pemeriksaan_format')
		);
		$this->db->where('id_pemeriksaan_format',$id_pemeriksaan_format);
		$this->db->update('pemeriksaan_format', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);
	}
	function non_normal($ids,$id){
		$data_pendaftaran = array(
			'status_pemeriksaan_format' => $ids
		);
		$this->db->where('id_pemeriksaan_format',$id);
		$this->db->update('pemeriksaan_format', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);
	}
	function pendaftaran_all($first_date,$last_date,$key)
	{
	//	$ids = explode(',', $unit);
		$wordsAry = explode("-", $key);
		$wordsCount = count($wordsAry);
		$fields = "*,DATE_FORMAT(tgl_pendaftaran_unit,'%d-%m-%Y') as tgl_pendaftaran_unit,
			CONCAT((TIMESTAMPDIFF( YEAR, p.tgl_lahir, tgl_pendaftaran_unit )), ' Tahun ',
			TIMESTAMPDIFF( MONTH, p.tgl_lahir, tgl_pendaftaran_unit ) % 12, ' Bulan ',
			FLOOR( TIMESTAMPDIFF( DAY, p.tgl_lahir, tgl_pendaftaran_unit ) % 30.4375 ), ' Hari') as umur,
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

				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('rr.id_radiolog',$this->session->id_pegawai);
		$this->db->where('pu.id_status_pasien >',2);
	//	$this->db->where("pendaftaran_instansi", $this->session->refer);
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

		$this->db->from('radiologi_result rr');
		$this->db->join('pemeriksaan pmr', 'pmr.barcode_pemeriksaan=rr.barcode_pemeriksaan','left');
		$this->db->join('billing bl', 'bl.barcode_pemeriksaan=pmr.barcode_pemeriksaan','left');
		$this->db->join('tindakan_tarif tt', 'tt.barcode_tindakan_tarif=bl.barcode_tindakan_tarif','left');
		$this->db->join('tindakan t', 't.id_tindakan=tt.id_tindakan','left');
		$this->db->join('pendaftaran_unit pu', 'pu.barcode_pendaftaran_unit=pmr.barcode_pendaftaran_unit','left');
		$this->db->join('pendaftaran pd', 'pd.barcode_pendaftaran=pu.barcode_pendaftaran','left');
		$this->db->join('pasien p', 'p.barcode_pasien=pd.barcode_pasien','left');
		$this->db->join('kol_working kw', 'kw.id_working=pd.pendaftaran_instansi','left');
		$this->db->where('rr.id_radiolog',$this->session->id_pegawai);
		$this->db->where('pu.id_status_pasien >',2);
	//	$this->db->where("pendaftaran_instansi", $this->session->refer);
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

					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('rr.id_radiolog',$this->session->id_pegawai);
		$this->db->where('pu.id_status_pasien >',2);
	//	$this->db->where("pendaftaran_instansi", $this->session->refer);
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

		$this->db->from('radiologi_result rr');
		$this->db->join('pemeriksaan pmr', 'pmr.barcode_pemeriksaan=rr.barcode_pemeriksaan','left');
		$this->db->join('billing bl', 'bl.barcode_pemeriksaan=pmr.barcode_pemeriksaan','left');
		$this->db->join('tindakan_tarif tt', 'tt.barcode_tindakan_tarif=bl.barcode_tindakan_tarif','left');
		$this->db->join('tindakan t', 't.id_tindakan=tt.id_tindakan','left');
		$this->db->join('pendaftaran_unit pu', 'pu.barcode_pendaftaran_unit=pmr.barcode_pendaftaran_unit','left');
		$this->db->join('pendaftaran pd', 'pd.barcode_pendaftaran=pu.barcode_pendaftaran','left');
		$this->db->join('pasien p', 'p.barcode_pasien=pd.barcode_pasien','left');
		$this->db->join('kol_working kw', 'kw.id_working=pd.pendaftaran_instansi','left');
		$this->db->where('rr.id_radiolog',$this->session->id_pegawai);
		$this->db->where('pu.id_status_pasien >',2);
	//	$this->db->where("pendaftaran_instansi", $this->session->refer);
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
		$jml = $this->m_umum->jumlah_record_tabel('radiologi_result');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function baca_all($id)
	{
		$fields = "*,DATE_FORMAT(tgl_pendaftaran_unit,'%d-%m-%Y') as tgl_pendaftaran_unit,
			CONCAT((TIMESTAMPDIFF( YEAR, p.tgl_lahir, tgl_pendaftaran_unit )), ' Tahun ',
			TIMESTAMPDIFF( MONTH, p.tgl_lahir, tgl_pendaftaran_unit ) % 12, ' Bulan ',
			FLOOR( TIMESTAMPDIFF( DAY, p.tgl_lahir, tgl_pendaftaran_unit ) % 30.4375 ), ' Hari') as umur,
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

				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('p.barcode_pasien',$id);
/*		$this->db->where('rr.id_radiolog',$this->session->id_pegawai);
		$this->db->where('pu.id_status_pasien >',2);
		$this->db->where("pendaftaran_instansi", $this->session->refer);*/			
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('radiologi_result rr');
		$this->db->join('pemeriksaan pmr', 'pmr.barcode_pemeriksaan=rr.barcode_pemeriksaan','left');
		$this->db->join('billing bl', 'bl.barcode_pemeriksaan=pmr.barcode_pemeriksaan','left');
		$this->db->join('tindakan_tarif tt', 'tt.barcode_tindakan_tarif=bl.barcode_tindakan_tarif','left');
		$this->db->join('tindakan t', 't.id_tindakan=tt.id_tindakan','left');
		$this->db->join('pendaftaran_unit pu', 'pu.barcode_pendaftaran_unit=pmr.barcode_pendaftaran_unit','left');
		$this->db->join('pendaftaran pd', 'pd.barcode_pendaftaran=pu.barcode_pendaftaran','left');
		$this->db->join('pasien p', 'p.barcode_pasien=pd.barcode_pasien','left');
		$this->db->where('p.barcode_pasien',$id);
/*		$this->db->where('rr.id_radiolog',$this->session->id_pegawai);
		$this->db->where('pu.id_status_pasien >',2);
		$this->db->where("pendaftaran_instansi", $this->session->refer);*/					
		
		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]

					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('p.barcode_pasien',$id);
/*		$this->db->where('rr.id_radiolog',$this->session->id_pegawai);
		$this->db->where('pu.id_status_pasien >',2);
		$this->db->where("pendaftaran_instansi", $this->session->refer);*/					
		
			}
		  }
		}

		$this->db->from('radiologi_result rr');
		$this->db->join('pemeriksaan pmr', 'pmr.barcode_pemeriksaan=rr.barcode_pemeriksaan','left');
		$this->db->join('billing bl', 'bl.barcode_pemeriksaan=pmr.barcode_pemeriksaan','left');
		$this->db->join('tindakan_tarif tt', 'tt.barcode_tindakan_tarif=bl.barcode_tindakan_tarif','left');
		$this->db->join('tindakan t', 't.id_tindakan=tt.id_tindakan','left');
		$this->db->join('pendaftaran_unit pu', 'pu.barcode_pendaftaran_unit=pmr.barcode_pendaftaran_unit','left');
		$this->db->join('pendaftaran pd', 'pd.barcode_pendaftaran=pu.barcode_pendaftaran','left');
		$this->db->join('pasien p', 'p.barcode_pasien=pd.barcode_pasien','left');
		$this->db->where('p.barcode_pasien',$id);
/*		$this->db->where('rr.id_radiolog',$this->session->id_pegawai);
		$this->db->where('pu.id_status_pasien >',2);
		$this->db->where("pendaftaran_instansi", $this->session->refer);	*/				
		

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
	//	$kondisi=array('id_level !='=>'99');
	//	$jml = $this->m_umum->jumlah_record_filter('user',$kondisi);		//[coding here] ganti tabel utamanya
		$jml = $this->m_umum->jumlah_record_tabel('radiologi_result');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_bacaan(){
		$barcode_radiologi_result = $this->input->post('barcode_radiologi_result');
		$barcode_pemeriksaan = $this->input->post('barcode_pemeriksaan');
		$this->m_ol_rancak->update_pemeriksaan(3,$barcode_pemeriksaan);
		$data_pendaftaran = array(
			'waktu_radiologi_result' => date('Y-m-d H:i:s'),
			'id_nilai_kritis' => $this->input->post('id_nilai_kritis'),
			'hasil_radiologi_result' => $this->input->post('hasil_radiologi_result'),
			'kesimpulan_radiologi_result' => $this->input->post('kesimpulan_radiologi_result')
		);
		$this->db->where('barcode_radiologi_result',$barcode_radiologi_result);
		$this->db->update('radiologi_result', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);
	}
}
