<?php
class M_laboratorium extends CI_model{
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
		$this->db->where('id_instansi',$this->session->refer);
		$this->db->where('status_lformat',1);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('laboratorium_format lf');
		$this->db->join('tindakan t', 't.id_tindakan=lf.id_tindakan','left');
		$this->db->where('id_instansi',$this->session->refer);
		$this->db->where('status_lformat',1);

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
		$this->db->where('id_instansi',$this->session->refer);
		$this->db->where('status_lformat',1);
			}
		  }
		}

	    $this->db->from('laboratorium_format lf');
		$this->db->join('tindakan t', 't.id_tindakan=lf.id_tindakan','left');
		$this->db->where('id_instansi',$this->session->refer);
		$this->db->where('status_lformat',1);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('laboratorium_format');		//[coding here] ganti tabel utamanya
				
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
		$kode = $this->m_rancak->kode_generator(15,'LN');
		$data_pendaftaran = array(
			'satuan_lformat' => $this->input->post('satuan_lformat'),
			'id_tindakan' => $this->input->post('id_tindakan'),
			'id_instansi' => $this->session->refer,
			'barcode_lformat' => $kode,
			'nilai_rujukan_lformat' => $this->input->post('nilai_rujukan_lformat'),
			'metode_lformat' => $this->input->post('metode_lformat')
		);
		return $this->db->insert('laboratorium_format', $data_pendaftaran);
	}
	function edit_normal(){
		$barcode_lformat = $this->input->post('barcode_lformat');
		$data_pendaftaran = array(
			'satuan_lformat' => $this->input->post('satuan_lformat'),
			'nilai_rujukan_lformat' => $this->input->post('nilai_rujukan_lformat'),
			'metode_lformat' => $this->input->post('metode_lformat')
		);
		$this->db->where('barcode_lformat',$barcode_lformat);
		$this->db->update('laboratorium_format', $data_pendaftaran);
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
			'status_lformat' => $ids
		);
		$this->db->where('barcode_lformat',$id);
		$this->db->update('laboratorium_format', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);
	}
	function ambil_pemeriksaan_billing($id)
	{
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
	function pendaftaran_all($first_date,$last_date,$key)
	{
	//	$ids = explode(',', $unit);
		$wordsAry = explode("-", $key);
		$wordsCount = count($wordsAry);
		$fields = "*,DATE_FORMAT(tgl_pendaftaran_unit,'%d-%m-%Y') as tgl_pendaftaran_unit,
			CONCAT((TIMESTAMPDIFF( YEAR, p.tgl_lahir, tgl_pendaftaran_unit )), ' Tahun ',
			TIMESTAMPDIFF( MONTH, p.tgl_lahir, tgl_pendaftaran_unit ) % 12, ' Bulan ',
			FLOOR( TIMESTAMPDIFF( DAY, p.tgl_lahir, tgl_pendaftaran_unit ) % 30.4375 ), ' Hari') as umur
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
				$this->db->where_in('pu.unit_ke',3);
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

		$this->db->from('pendaftaran_unit pu');
		$this->db->join('pendaftaran pd', 'pd.barcode_pendaftaran=pu.barcode_pendaftaran','left');
		$this->db->join('pasien p', 'p.barcode_pasien=pd.barcode_pasien','left');
	//	$this->db->where('pu.id_status_pasien >',2);
		$this->db->where_in('pu.unit_ke',3);
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

					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where_in('pu.unit_ke',3);
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

		$this->db->from('pendaftaran_unit pu');
		$this->db->join('pendaftaran pd', 'pd.barcode_pendaftaran=pu.barcode_pendaftaran','left');
		$this->db->join('pasien p', 'p.barcode_pasien=pd.barcode_pasien','left');
	//	$this->db->where('pu.id_status_pasien >',2);
		$this->db->where_in('pu.unit_ke',3);
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
	function hasil_lab_all($id)
	{
		$fields = "*,DATE_FORMAT(tgl_pendaftaran_unit,'%d-%m-%Y') as tgl_pendaftaran_unit
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
		$this->db->where('pmr.barcode_pendaftaran_unit',$id);
		$this->db->where("pendaftaran_instansi", $this->session->refer);				
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('pemeriksaan pmr');
		$this->db->join('pendaftaran_unit pu', 'pu.barcode_pendaftaran_unit=pmr.barcode_pendaftaran_unit','left');
		$this->db->join('pendaftaran pd', 'pd.barcode_pendaftaran=pu.barcode_pendaftaran','left');
		$this->db->join('ol_pegawai op', 'op.id_pegawai=pu.dr_petugas','left');
		$this->db->where('pmr.barcode_pendaftaran_unit',$id);
		$this->db->where("pendaftaran_instansi", $this->session->refer);					
		
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
		$this->db->where('pmr.barcode_pendaftaran_unit',$id);
		$this->db->where("pendaftaran_instansi", $this->session->refer);					
		
			}
		  }
		}

		$this->db->from('pemeriksaan pmr');
		$this->db->join('pendaftaran_unit pu', 'pu.barcode_pendaftaran_unit=pmr.barcode_pendaftaran_unit','left');
		$this->db->join('pendaftaran pd', 'pd.barcode_pendaftaran=pu.barcode_pendaftaran','left');
		$this->db->join('ol_pegawai op', 'op.id_pegawai=pu.dr_petugas','left');
		$this->db->where('pmr.barcode_pendaftaran_unit',$id);
		$this->db->where("pendaftaran_instansi", $this->session->refer);					
		

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
	function simpan_bacaan(){
		$barcode_radiologi_result = $this->input->post('barcode_radiologi_result');
		$barcode_pemeriksaan = $this->input->post('barcode_pemeriksaan');
		$this->m_ol_rancak->update_pemeriksaan(3,$barcode_pemeriksaan);
		$data_pendaftaran = array(
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
	function simpan_hasil_lresult(){
		$barcode_pemeriksaan = $this->input->post('barcode_pemeriksaan');
		$hasil_lresult = $this->input->post('hasil_lresult[]');
		$chk = $this->input->post('barcode_lresult[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				$this->m_ol_rancak->update_pemeriksaan(3,$barcode_pemeriksaan);
				$this->simpan_hasile_lresult($hasil_lresult[$i],$chk[$i]);
			}
		}
	}
	function simpan_hasile_lresult($hasil_lresult,$chk){
		$data_pendaftaran = array(
			'hasil_lresult' => $hasil_lresult,
			'waktu_lresult' => date('Y-m-d H:i:s')
		);
		$this->db->where('barcode_lresult',$chk);
		$this->db->update('laboratorium_result', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);
	}
}
