<?php
class M_ms_kredensial extends MY_Model{
	function kompetensi_all($id)
	{
		$ids = explode(',', $id);
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,if(syarat_kompetensi IS NULL or syarat_kompetensi = 0,'Tidak Ada', 'Ada') as syarat_kompetensi";
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
					// case 'telp' : $nmf="peg.telp";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		if ( $this->session->has_userdata('id_level') && $this->session->userdata('id_level')==99 ){

		}else{
			$this->db->where('kp.status_kompetensi', 1);
			$this->db->where_in('kp.id_jabatan', $ids);
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('nkr_kompetensi kp');
		$this->db->join('jabatan j', 'j.id_jabatan=kp.id_jabatan','left');
		if ( $this->session->has_userdata('id_level') && $this->session->userdata('id_level')==99 ){

		}else{
			$this->db->where('kp.status_kompetensi', 1);
			$this->db->where_in('kp.id_jabatan', $ids);
		}

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'id_ms_code'   : $nmf="kc.id_ms_code";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		if ( $this->session->has_userdata('id_level') && $this->session->userdata('id_level')==99 ){

		}else{
			$this->db->where('kp.status_kompetensi', 1);
			$this->db->where_in('kp.id_jabatan', $ids);
		}
			}
		  }
		}

	    $this->db->from('nkr_kompetensi kp');
		$this->db->join('jabatan j', 'j.id_jabatan=kp.id_jabatan','left');
		if ( $this->session->has_userdata('id_level') && $this->session->userdata('id_level')==99 ){

		}else{
			$this->db->where('kp.status_kompetensi', 1);
			$this->db->where_in('kp.id_jabatan', $ids);
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('nkr_kompetensi');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_nkr_kompetensi(){
		$kode = strtoupper($this->input->post('kode_unit'));
		$nama_kompetensi = strtoupper($this->input->post('nama_kompetensi'));
		$nama_kompetensi = trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $nama_kompetensi)));
		$idkode = $this->m_rancak->kode_generator_urut(15,'KM');
		$data_pendaftaran = array(
			'id_jabatan' => $this->input->post('id_jabatan'),
			'id_kompetensi' => $idkode,
			'kode_unit' => $kode,
			'creator_kompetensi' => $this->session->id_pegawai,
			'instansi_kompetensi' => $this->session->refer,
			'nama_kompetensi' => $nama_kompetensi,
			'deskripsi_kompetensi' => $this->input->post('deskripsi_kompetensi')
		);
		// print_r($data_pendaftaran);die();
		return $this->db->insert('nkr_kompetensi', $data_pendaftaran);		
		// $this->db->insert_id();			
	}
	function edit_nkr_kompetensi(){
		$id_kompetensi = $this->input->post('id_kompetensi');
		$nama_kompetensi = strtoupper($this->input->post('nama_kompetensi'));
		$nama_kompetensi = trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $nama_kompetensi)));
		$kode = strtoupper($this->input->post('kode_unit'));
		$data_pendaftaran = array(
			'id_jabatan' => $this->input->post('id_jabatan'),
			'kode_unit' => $kode,
			'nama_kompetensi' => $nama_kompetensi,
			'deskripsi_kompetensi' => $this->input->post('deskripsi_kompetensi')
		);
		$this->db->where('id_kompetensi',$id_kompetensi);
		$this->db->update('nkr_kompetensi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function edit_syarat_kompetensi(){
		$chk = $this->input->post('chk[]');
		$id_kompetensi = $this->input->post('id_kompetensi');	
		$eimplo = implode(",",$chk);
		if($chk){
			$data_pendaftaran = array(
				'syarat_kompetensi' => $eimplo
			);
			$this->db->where('id_kompetensi',$id_kompetensi);
			$this->db->update('nkr_kompetensi', $data_pendaftaran);
			//echo $this->db->last_query();
			$this->db->trans_complete();	// untuk cek sukses update tidak
			if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
			// if (!$this->db->affected_rows()) 
				return(FALSE);
			else 
				return(TRUE);
		}
	}
	function pasien_baru_all($key,$id)
	{
		$wordsAry = explode("-", $key);
		$wordsCount = count($wordsAry);
		$ids = explode(',', $id);
		$fields = "*";
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
				//	 case 'no_hp' : $nmf="peg.no_hp";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		if ( $this->session->has_userdata('id_level') && $this->session->userdata('id_level')==99 ){

		}else{
			$this->db->where('kp.status_kompetensi', 1);
			$this->db->where_in('kp.id_jabatan', $ids);
		}
		if(!empty($key) || $this->input->post('key',true)){
			$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(kw.nama_kewenangan LIKE '%".$wordsAry[$i]."%' OR kp.nama_kompetensi LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

   	    $this->db->from('nkr_kewenangan kw');
		$this->db->join('nkr_kompetensi kp', 'kp.id_kompetensi=kw.id_kompetensi','left');
		$this->db->join('jabatan j', 'j.id_jabatan=kp.id_jabatan','left');
		if ( $this->session->has_userdata('id_level') && $this->session->userdata('id_level')==99 ){

		}else{
			$this->db->where('kp.status_kompetensi', 1);
			$this->db->where_in('kp.id_jabatan', $ids);
		}
		if(!empty($key) || $this->input->post('key',true)){
			$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(kw.nama_kewenangan LIKE '%".$wordsAry[$i]."%' OR kp.nama_kompetensi LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'no_hp' : $nmf="peg.no_hp";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		if ( $this->session->has_userdata('id_level') && $this->session->userdata('id_level')==99 ){

		}else{
			$this->db->where('kp.status_kompetensi', 1);
			$this->db->where_in('kp.id_jabatan', $ids);
		}
		if(!empty($key) || $this->input->post('key',true)){
			$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(kw.nama_kewenangan LIKE '%".$wordsAry[$i]."%' OR kp.nama_kompetensi LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
			}
		  }
		}

   	    $this->db->from('nkr_kewenangan kw');
		$this->db->join('nkr_kompetensi kp', 'kp.id_kompetensi=kw.id_kompetensi','left');
		$this->db->join('jabatan j', 'j.id_jabatan=kp.id_jabatan','left');
		if ( $this->session->has_userdata('id_level') && $this->session->userdata('id_level')==99 ){

		}else{
			$this->db->where('kp.status_kompetensi', 1);
			$this->db->where_in('kp.id_jabatan', $ids);
		}
		if(!empty($key) || $this->input->post('key',true)){
			$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(kw.nama_kewenangan LIKE '%".$wordsAry[$i]."%' OR kp.nama_kompetensi LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
	//	$kondisi=array('id_level !='=>'99');
	//	$jml = $this->m_umum->jumlah_record_filter('user',$kondisi);		//[coding here] ganti tabel utamanya
		$jml = $this->m_umum->jumlah_record_tabel('nkr_kewenangan');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_nkr_kewenangan(){
		$idkode = $this->m_rancak->kode_generator_urut(15,'KW');
		$nama_kewenangan = strtoupper($this->input->post('nama_kewenangan'));
		$nama_kewenangan = trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $nama_kewenangan)));
		$data_pendaftaran = array(
			'id_kompetensi' => $this->input->post('id_kompetensi'),
			'id_kewenangan' => $idkode,
			'creator_kewenangan' => $this->session->id_pegawai,
			'nama_kewenangan' => $nama_kewenangan
		);
		// print_r($data_pendaftaran);die();
		return $this->db->insert('nkr_kewenangan', $data_pendaftaran);		
		// $this->db->insert_id();			
	}
	function edit_nkr_kewenangan(){
		$id_kewenangan = $this->input->post('id_kewenangan');
		$nama_kewenangan = strtoupper($this->input->post('nama_kewenangan'));
		$nama_kewenangan = trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $nama_kewenangan)));
		$data_pendaftaran = array(
			'id_kompetensi' => $this->input->post('id_kompetensi'),
			'nama_kewenangan' => $nama_kewenangan
		);
		$this->db->where('id_kewenangan',$id_kewenangan);
		$this->db->update('nkr_kewenangan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function elemen_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*";
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
					// case 'telp' : $nmf="peg.telp";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('nkr_elemen kp');
	    $this->db->join('jabatan j', 'j.id_jabatan=kp.jabatan_elemen','left');

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'id_ms_code'   : $nmf="kc.id_ms_code";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}

	    $this->db->from('nkr_elemen kp');
	    $this->db->join('jabatan j', 'j.id_jabatan=kp.jabatan_elemen','left');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('nkr_elemen');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_nkr_elemen(){
		$data_pendaftaran = array(
			'pembuat_elemen' => $this->session->id_pegawai,
			'jabatan_elemen' => $this->input->post('jabatan_elemen'),
			'nama_elemen' => $this->input->post('nama_elemen')
		);
		// print_r($data_pendaftaran);die();
		return $this->db->insert('nkr_elemen', $data_pendaftaran);		
		// $this->db->insert_id();			
	}
	function edit_nkr_elemen(){
		$id_elemen = $this->input->post('id_elemen');
		$data_pendaftaran = array(
			'nama_elemen' => $this->input->post('nama_elemen'),
			'jabatan_elemen' => $this->input->post('jabatan_elemen')
		);
		$this->db->where('id_elemen',$id_elemen);
		$this->db->update('nkr_elemen', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function asesmen_all()
	{
		$fields = "*,nkr_asesmen.id_elemen as ide";
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
					 case 'id_elemen' : $nmf="nkr_asesmen.id_elemen";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

   	    $this->db->from('nkr_asesmen');
		$this->db->join('nkr_elemen', 'nkr_elemen.id_elemen=nkr_asesmen.id_elemen','left');
		$this->db->join('jabatan', 'jabatan.id_jabatan=nkr_asesmen.id_jabatan','left');

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
					case 'id_elemen' : $nmf="nkr_asesmen.id_elemen";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}

   	    $this->db->from('nkr_asesmen');
		$this->db->join('nkr_elemen', 'nkr_elemen.id_elemen=nkr_asesmen.id_elemen','left');
		$this->db->join('jabatan', 'jabatan.id_jabatan=nkr_asesmen.id_jabatan','left');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
	//	$kondisi=array('id_level !='=>'99');
	//	$jml = $this->m_umum->jumlah_record_filter('user',$kondisi);		//[coding here] ganti tabel utamanya
		$jml = $this->m_umum->jumlah_record_tabel('nkr_asesmen');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_nkr_asesmen(){
		$data_pendaftaran = array(
			'id_elemen' => $this->input->post('id_elemen'),
			'id_jabatan' => $this->input->post('id_jabatan'),
			'pembuat_asesmen' => $this->session->id_pegawai,
			'nama_asesmen' => $this->input->post('nama_asesmen')
		);
		// print_r($data_pendaftaran);die();
		return $this->db->insert('nkr_asesmen', $data_pendaftaran);		
		// $this->db->insert_id();			
	}
	function edit_nkr_asesmen(){
		$id_asesmen = $this->input->post('id_asesmen');
		$data_pendaftaran = array(
			'id_elemen' => $this->input->post('id_elemen'),
			'id_jabatan' => $this->input->post('id_jabatan'),
			'nama_asesmen' => $this->input->post('nama_asesmen')
		);
		$this->db->where('id_asesmen',$id_asesmen);
		$this->db->update('nkr_asesmen', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function edit_urutan_nkr_asesmen(){
		$id_asesmen = $this->input->post('id_asesmen');
		$data_pendaftaran = array(
			'no_urut_asesmen' => $this->input->post('no_urut_asesmen')
		);
		$this->db->where('id_asesmen',$id_asesmen);
		$this->db->update('nkr_asesmen', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function qf_2_all()
	{
		$fields = "*";
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
				//	 case 'no_hp' : $nmf="peg.no_hp";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

   	    $this->db->from('nkr_question_f2 nf2');
		$this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nf2.id_asesmen','left');
		$this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
		$this->db->join('jabatan j', 'j.id_jabatan=nas.id_jabatan','left');

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'no_hp' : $nmf="peg.no_hp";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}

   	    $this->db->from('nkr_question_f2 nf2');
		$this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nf2.id_asesmen','left');
		$this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
		$this->db->join('jabatan j', 'j.id_jabatan=nas.id_jabatan','left');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
	//	$kondisi=array('id_level !='=>'99');
	//	$jml = $this->m_umum->jumlah_record_filter('user',$kondisi);		//[coding here] ganti tabel utamanya
		$jml = $this->m_umum->jumlah_record_tabel('nkr_question_f2');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_nkr_question(){
		$data_pendaftaran = array(
			'id_asesmen' => $this->input->post('id_asesmen'),
			'pembuat_question' => $this->session->id_pegawai,
			'nama_question' => $this->input->post('nama_question')
		);
		// print_r($data_pendaftaran);die();
		return $this->db->insert('nkr_question_f2', $data_pendaftaran);		
		// $this->db->insert_id();			
	}
	function edit_nkr_question(){
		$id_question = $this->input->post('id_question');
		$data_pendaftaran = array(
			'id_asesmen' => $this->input->post('id_asesmen'),
			'nama_question' => $this->input->post('nama_question')
		);
		$this->db->where('id_question',$id_question);
		$this->db->update('nkr_question_f2', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function form_all($id)
	{
		$fields = "*";
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
				//	 case 'no_hp' : $nmf="peg.no_hp";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('nf.id_jenis_form',$id);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

   	    $this->db->from('nkr_form nf');
		$this->db->join('nkr_kompetensi kp', 'kp.id_kompetensi=nf.id_kompetensi','left');
		$this->db->join('kol_jenis_form kjf', 'kjf.id_jenis_form=nf.id_jenis_form','left');
		$this->db->join('kol_working kw', 'kw.id_working=nf.id_instansi','left');
		$this->db->join('jabatan j', 'j.id_jabatan=kp.id_jabatan','left');
		$this->db->where('nf.id_jenis_form',$id);

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'no_hp' : $nmf="peg.no_hp";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('nf.id_jenis_form',$id);
			}
		  }
		}

   	    $this->db->from('nkr_form nf');
		$this->db->join('nkr_kompetensi kp', 'kp.id_kompetensi=nf.id_kompetensi','left');
		$this->db->join('kol_jenis_form kjf', 'kjf.id_jenis_form=nf.id_jenis_form','left');
		$this->db->join('kol_working kw', 'kw.id_working=nf.id_instansi','left');
		$this->db->join('jabatan j', 'j.id_jabatan=kp.id_jabatan','left');
		$this->db->where('nf.id_jenis_form',$id);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$kondisi=array('id_jenis_form'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);		//[coding here] ganti tabel utamanya
	//	$jml = $this->m_umum->jumlah_record_tabel('nkr_form');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function form_question_detil($id)
	{
		$fields = "*";
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
				//	 case 'no_hp' : $nmf="peg.no_hp";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('nfd.barcode_form',$id);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

   	    $this->db->from('nkr_form_detil nfd');
		$this->db->join('nkr_form nf', 'nf.barcode_form=nfd.barcode_form','left');
		$this->db->join('nkr_question_f2 nq2', 'nq2.id_question=nfd.id_question','left');
		$this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nq2.id_asesmen','left');
		$this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
		$this->db->where('nfd.barcode_form',$id);

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'no_hp' : $nmf="peg.no_hp";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('nfd.barcode_form',$id);
			}
		  }
		}

   	    $this->db->from('nkr_form_detil nfd');
		$this->db->join('nkr_form nf', 'nf.barcode_form=nfd.barcode_form','left');
		$this->db->join('nkr_question_f2 nq2', 'nq2.id_question=nfd.id_question','left');
		$this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nq2.id_asesmen','left');
		$this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
		$this->db->where('nfd.barcode_form',$id);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$kondisi=array('barcode_form'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('nkr_form_detil',$kondisi);		//[coding here] ganti tabel utamanya
	//	$jml = $this->m_umum->jumlah_record_tabel('nkr_form_detil');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function form_indikator_detil($id)
	{
		$fields = "*,
		if(jenis_soal = 1,'Pilihan',if(jenis_soal = 2,'Berganda','Isian')) as jenis_soal,
		if(metode_form_detil IS NULL OR metode_form_detil = '','Tidak Ada Metode','Ada Metode') as metode_form_detil,
		if(perangkat_form_detil IS NULL OR perangkat_form_detil = '','Tidak Ada Perangkat','Ada Perangkat') as perangkat_form_detil
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
				//	 case 'no_hp' : $nmf="peg.no_hp";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('nfd.barcode_form',$id);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

   	    $this->db->from('nkr_form_detil nfd');
		$this->db->join('nkr_form nf', 'nf.barcode_form=nfd.barcode_form','left');
		$this->db->join('nkr_kaji_ulang nku', 'nku.id_kaji_ulang=nfd.id_kaji_ulang','left');
		$this->db->join('nkr_indikator nin', 'nin.id_indikator=nfd.id_indikator','left');
		$this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nin.id_asesmen','left');
		$this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
		$this->db->join('nkr_pra_detil npd', 'npd.id_pra_detil=nfd.id_pra_detil','left');
		$this->db->join('nkr_pra_asesmen npa', 'npa.barcode_pra_asesmen=npd.barcode_pra_asesmen','left');
		$this->db->where('nfd.barcode_form',$id);

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'no_hp' : $nmf="peg.no_hp";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('nfd.barcode_form',$id);
			}
		  }
		}

   	    $this->db->from('nkr_form_detil nfd');
		$this->db->join('nkr_form nf', 'nf.barcode_form=nfd.barcode_form','left');
		$this->db->join('nkr_kaji_ulang nku', 'nku.id_kaji_ulang=nfd.id_kaji_ulang','left');
		$this->db->join('nkr_indikator nin', 'nin.id_indikator=nfd.id_indikator','left');
		$this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nin.id_asesmen','left');
		$this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
		$this->db->join('nkr_pra_detil npd', 'npd.id_pra_detil=nfd.id_pra_detil','left');
		$this->db->join('nkr_pra_asesmen npa', 'npa.barcode_pra_asesmen=npd.barcode_pra_asesmen','left');
		$this->db->where('nfd.barcode_form',$id);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$kondisi=array('barcode_form'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('nkr_form_detil',$kondisi);		//[coding here] ganti tabel utamanya
	//	$jml = $this->m_umum->jumlah_record_tabel('nkr_form_detil');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function indikator_all()
	{
		$fields = "*,concat(nama_asesmen,' : <br><b>[',nama_elemen,']</b> - [',nama_jabatan,']') as nama_asesmen,
				if(jenis_soal = 1,'Pilihan',if(jenis_soal = 2,'Berganda','Isian')) as jenis_soal,
		if(metode_indikator IS NULL OR metode_indikator = '','Tidak Ada Metode','Ada Metode') as metode_indikator,
		if(perangkat_indikator IS NULL OR perangkat_indikator = '','Tidak Ada Perangkat','Ada Perangkat') as perangkat_indikator
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
				//	 case 'no_hp' : $nmf="peg.no_hp";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

   	    $this->db->from('nkr_indikator nid');
		$this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nid.id_asesmen','left');
		$this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
		$this->db->join('jabatan j', 'j.id_jabatan=nas.id_jabatan','left');

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'no_hp' : $nmf="peg.no_hp";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}

   	    $this->db->from('nkr_indikator nid');
		$this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nid.id_asesmen','left');
		$this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
		$this->db->join('jabatan j', 'j.id_jabatan=nas.id_jabatan','left');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
	//	$kondisi=array('id_level !='=>'99');
	//	$jml = $this->m_umum->jumlah_record_filter('user',$kondisi);		//[coding here] ganti tabel utamanya
		$jml = $this->m_umum->jumlah_record_tabel('nkr_indikator');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_nkr_indikator(){
		$data_pendaftaran = array(
			'id_asesmen' => $this->input->post('id_asesmen'),
			'pembuat_indikator' => $this->session->id_pegawai,
			'nama_indikator' => $this->input->post('nama_indikator')
		);
		// print_r($data_pendaftaran);die();
		return $this->db->insert('nkr_indikator', $data_pendaftaran);		
		// $this->db->insert_id();			
	}
	function edit_nkr_indikator(){
		$id_indikator = $this->input->post('id_indikator');
		$data_pendaftaran = array(
			'id_asesmen' => $this->input->post('id_asesmen'),
			'nama_indikator' => $this->input->post('nama_indikator')
		);
		$this->db->where('id_indikator',$id_indikator);
		$this->db->update('nkr_indikator', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function edit_jenis_soal_nkr_indikator(){
		$id_indikator = $this->input->post('id_indikator');
		$data_pendaftaran = array(
			'jenis_soal' => $this->input->post('jenis_soal')
		);
		$this->db->where('id_indikator',$id_indikator);
		$this->db->update('nkr_indikator', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function no_urutan_opsi_soal($id){
        //Cari id terakhir dengan unit dan tanggal yang sama
        $this->db->select("id_soal_opsi, no_urut_soal_opsi");
        $this->db->where("id_indikator", $id);
        $this->db->order_by('no_urut_soal_opsi', 'DESC');
        $query=$this->db->get_where("nkr_soal_opsi");
        $result = $query->row();
        if(isset($result))
            return $result->no_urut_soal_opsi;
        return 0;
	}
	function simpan_opsi_soal(){
		$id_soal_opsi = $this->input->post('id_soal_opsi[]');
		$chk = $this->input->post('chk[]');
		if($chk){
			$this->tambah_opsi_soal();
		}
		$id_soal_opsi_edit = $this->input->post('id_soal_opsi_edit[]');
		if($id_soal_opsi_edit){
			$id_soal_opsi_edit = $this->input->post('id_soal_opsi_edit[]');		
			$nama_soal_opsi_edit = $this->input->post('nama_soal_opsi_edit[]');		
			$status_soal_opsi_edit = $this->input->post('status_soal_opsi_edit[]');			
			$answer = $this->input->post('answer[]');			
			$no_urut_soal_opsi_edit = $this->input->post('no_urut_soal_opsi_edit[]');			
			$jml_kode = count($id_soal_opsi_edit);
			for ($i=0;$i<$jml_kode;$i++){ 	
				$this->edit_opsi_soal($id_soal_opsi_edit[$i],$no_urut_soal_opsi_edit[$i],$nama_soal_opsi_edit[$i],$status_soal_opsi_edit[$i],$answer[$i]);				
			}
		}
	}
	function tambah_opsi_soal(){
		$chk = $this->input->post('chk[]');		
		$nama_soal_opsi = $this->input->post('nama_soal_opsi[]');		
		$status_soal_opsi = $this->input->post('status_soal_opsi[]');		
		$answer = $this->input->post('answer[]');		
		$id_indikator = $this->input->post('id_indikator');		
		$jml_kode = count($chk);
		$no_urut_soal_opsi = $this->no_urutan_opsi_soal($id_indikator);
		for ($i=0;$i<$jml_kode;$i++){
			if(!empty($nama_soal_opsi[$i])){
				$kode = $this->m_rancak->kode_generator_urut(15,'OS');
				$data_pendaftaran = array(
					'id_soal_opsi' => $kode,					
					'id_indikator' => $id_indikator,					
					'no_urut_soal_opsi' => $no_urut_soal_opsi++,					
					'nama_soal_opsi' => $nama_soal_opsi[$i],					
					'answer' => $answer[$i],					
					'status_soal_opsi' => $status_soal_opsi[$i]
				);
				$this->db->insert('nkr_soal_opsi', $data_pendaftaran);
			}				
		}		
	}
	function edit_opsi_soal($id_soal_opsi,$no_urut_soal_opsi,$nama_soal_opsi,$status_soal_opsi,$answer){
		$data_pendaftaran = array(
			'answer' => $answer,					
			'no_urut_soal_opsi' => $no_urut_soal_opsi,					
			'nama_soal_opsi' => $nama_soal_opsi,					
			'status_soal_opsi' => $status_soal_opsi
		);
		$this->db->where('id_soal_opsi',$id_soal_opsi);
		$this->db->update('nkr_soal_opsi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function simpan_nkr_metode_indikator(){
		$chk = $this->input->post('chk[]');
		$id_indikator = $this->input->post('id_indikator');	
		$eimplo = implode(",",$chk);
		if($chk){
			$data_pendaftaran = array(
				'metode_indikator' => $eimplo
			);
			$this->db->where('id_indikator',$id_indikator);
			$this->db->update('nkr_indikator', $data_pendaftaran);
			//echo $this->db->last_query();
			$this->db->trans_complete();	// untuk cek sukses update tidak
			if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
			// if (!$this->db->affected_rows()) 
				return(FALSE);
			else 
				return(TRUE);
		}
	}
	function simpan_nkr_perangkat_indikator(){
		$chk = $this->input->post('chk[]');
		$id_indikator = $this->input->post('id_indikator');	
		$eimplo = implode(",",$chk);
		if($chk){
			$data_pendaftaran = array(
				'perangkat_indikator' => $eimplo
			);
			$this->db->where('id_indikator',$id_indikator);
			$this->db->update('nkr_indikator', $data_pendaftaran);
			//echo $this->db->last_query();
			$this->db->trans_complete();	// untuk cek sukses update tidak
			if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
			// if (!$this->db->affected_rows()) 
				return(FALSE);
			else 
				return(TRUE);
		}
	}
	function metode_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*";
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
					// case 'telp' : $nmf="peg.telp";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('nkr_metode');

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'id_ms_code'   : $nmf="kc.id_ms_code";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}

	    $this->db->from('nkr_metode');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('nkr_metode');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_nkr_metode(){
		$data_pendaftaran = array(
			'pembuat_metode' => $this->session->id_pegawai,
			'nama_metode' => $this->input->post('nama_metode')
		);
		// print_r($data_pendaftaran);die();
		return $this->db->insert('nkr_metode', $data_pendaftaran);		
		// $this->db->insert_id();			
	}
	function edit_nkr_metode(){
		$id_metode = $this->input->post('id_metode');
		$data_pendaftaran = array(
			'nama_metode' => $this->input->post('nama_metode')
		);
		$this->db->where('id_metode',$id_metode);
		$this->db->update('nkr_metode', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function perangkat_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*";
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
					// case 'telp' : $nmf="peg.telp";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('nkr_perangkat');

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'id_ms_code'   : $nmf="kc.id_ms_code";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}

	    $this->db->from('nkr_perangkat');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('nkr_perangkat');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_nkr_perangkat(){
		$data_pendaftaran = array(
			'pembuat_perangkat' => $this->session->id_pegawai,
			'nama_perangkat' => $this->input->post('nama_perangkat')
		);
		// print_r($data_pendaftaran);die();
		return $this->db->insert('nkr_perangkat', $data_pendaftaran);		
		// $this->db->insert_id();			
	}
	function edit_nkr_perangkat(){
		$id_perangkat = $this->input->post('id_perangkat');
		$data_pendaftaran = array(
			'nama_perangkat' => $this->input->post('nama_perangkat')
		);
		$this->db->where('id_perangkat',$id_perangkat);
		$this->db->update('nkr_perangkat', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function alat_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*";
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
					// case 'telp' : $nmf="peg.telp";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('nkr_alat');

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'id_ms_code'   : $nmf="kc.id_ms_code";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}

	    $this->db->from('nkr_alat');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('nkr_alat');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_nkr_alat(){
		$data_pendaftaran = array(
			'pembuat_alat' => $this->session->id_pegawai,
			'nama_alat' => $this->input->post('nama_alat')
		);
		// print_r($data_pendaftaran);die();
		return $this->db->insert('nkr_alat', $data_pendaftaran);		
		// $this->db->insert_id();			
	}
	function edit_nkr_alat(){
		$id_alat = $this->input->post('id_alat');
		$data_pendaftaran = array(
			'nama_alat' => $this->input->post('nama_alat')
		);
		$this->db->where('id_alat',$id_alat);
		$this->db->update('nkr_alat', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function alat_bahan_all($id)
	{
	$ids = explode(',', $id);
		$fields = "*";
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
					// case 'telp' : $nmf="peg.telp";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		if ( $this->session->has_userdata('id_level') && $this->session->userdata('id_level')==99 ){

		}else{
			$this->db->where_in('nab.id_instansi', $ids);
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('nkr_alat_bahan nab');
	    $this->db->join('nkr_elemen nel', 'nel.id_elemen=nab.id_elemen','left');
	    $this->db->join('nkr_kompetensi kp', 'kp.id_kompetensi=nab.id_kompetensi','left');
	    $this->db->join('kol_working kw', 'kw.id_working=nab.id_instansi','left');
		if ( $this->session->has_userdata('id_level') && $this->session->userdata('id_level')==99 ){

		}else{
			$this->db->where_in('nab.id_instansi', $ids);
		}

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'id_ms_code'   : $nmf="kc.id_ms_code";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		if ( $this->session->has_userdata('id_level') && $this->session->userdata('id_level')==99 ){

		}else{
			$this->db->where_in('nab.id_instansi', $ids);
		}
			}
		  }
		}

	    $this->db->from('nkr_alat_bahan nab');
	    $this->db->join('nkr_elemen nel', 'nel.id_elemen=nab.id_elemen','left');
	    $this->db->join('nkr_kompetensi kp', 'kp.id_kompetensi=nab.id_kompetensi','left');
	    $this->db->join('kol_working kw', 'kw.id_working=nab.id_instansi','left');
		if ( $this->session->has_userdata('id_level') && $this->session->userdata('id_level')==99 ){

		}else{
			$this->db->where_in('nab.id_instansi', $ids);
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('nkr_alat_bahan');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_alat_bahan(){
		$chk = $this->input->post('chk[]');
		$eimplo = implode(",",$chk);
		if($chk){
			$data_pendaftaran = array(
				'alat' => $eimplo,
				'id_instansi' =>  $this->input->post('id_instansi'),
				'id_elemen' =>  $this->input->post('id_elemen'),
				'id_kompetensi' =>  $this->input->post('id_kompetensi'),
				'pembuat_alat_bahan' =>  $this->session->id_pegawai
			);
			$this->db->insert('nkr_alat_bahan', $data_pendaftaran);
		}
	}
	function edit_alat_bahan(){
		$chk = $this->input->post('chk[]');
		$id_alat_bahan = $this->input->post('id_alat_bahan');	
		$eimplo = implode(",",$chk);
		if($chk){
			$data_pendaftaran = array(
				'alat' => $eimplo
			);
			$this->db->where('id_alat_bahan',$id_alat_bahan);
			$this->db->update('nkr_alat_bahan', $data_pendaftaran);
			//echo $this->db->last_query();
			$this->db->trans_complete();	// untuk cek sukses update tidak
			if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
			// if (!$this->db->affected_rows()) 
				return(FALSE);
			else 
				return(TRUE);
		}
	}
	function simpan_nkr_formmetper_detil(){
		$barcode_form = $this->input->post('barcode_form');
		$chk = $this->input->post('chk[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				$this->db->select("COUNT(*) as num");
				$this->db->where('barcode_form',$barcode_form);
				$this->db->where('id_indikator',$chk[$i]);
				$q = $this->db->get('nkr_form_detil')->row();
				$jml = $q->num;
				if($jml == 0){
					$kode = $this->m_rancak->kode_generator_urut(15,'3F');
					$take_indikator = $this->m_umum->ambil_data('nkr_indikator','id_indikator',$chk[$i]);
					$urut_form_detil = $this->m_kredensial->urut_form_detil($barcode_form);
					$urut_form_detil++;
					$data_pendaftaran = array(
						'no_urut_detil' => $urut_form_detil,
						'id_indikator' => $chk[$i],
						'metode_form_detil' => $take_indikator['metode_indikator'],
						'perangkat_form_detil' => $take_indikator['perangkat_indikator'],
						'barcode_form_detil' => $kode,
						'barcode_form' => $barcode_form
					);
					$this->db->insert('nkr_form_detil', $data_pendaftaran);
				}
			}
		}
	}
	function simpan_nkr_form3_detil(){
		$barcode_form = $this->input->post('barcode_form');
		$chk = $this->input->post('chk[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				$this->db->select("COUNT(*) as num");
				$this->db->where('barcode_form',$barcode_form);
				$this->db->where('id_indikator',$chk[$i]);
				$q = $this->db->get('nkr_form_detil')->row();
				$jml = $q->num;
				if($jml == 0){
					$kode = $this->m_rancak->kode_generator_urut(15,'3F');
					$urut_form_detil = $this->m_kredensial->urut_form_detil($barcode_form);
					$urut_form_detil++;
					$data_pendaftaran = array(
						'no_urut_detil' => $urut_form_detil,
						'id_indikator' => $chk[$i],
						'barcode_form_detil' => $kode,
						'barcode_form' => $barcode_form
					);
					$this->db->insert('nkr_form_detil', $data_pendaftaran);
				}
			}
		}
	}
	function simpan_form_pra_detil(){
		$barcode_form = $this->input->post('barcode_form');
		$chk = $this->input->post('chk[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				$this->db->select("COUNT(*) as num");
				$this->db->where('barcode_form',$barcode_form);
				$this->db->where('id_pra_detil',$chk[$i]);
				$q = $this->db->get('nkr_form_detil')->row();
				$jml = $q->num;
				if($jml == 0){
					$kode = $this->m_rancak->kode_generator_urut(15,'3F');
					$urut_form_detil = $this->m_kredensial->urut_form_detil($barcode_form);
					$urut_form_detil++;
					$data_pendaftaran = array(
						'no_urut_detil' => $urut_form_detil,
						'id_pra_detil' => $chk[$i],
						'barcode_form_detil' => $kode,
						'barcode_form' => $barcode_form
					);
					$this->db->insert('nkr_form_detil', $data_pendaftaran);
				}
			}
		}
	}
	function simpan_form_kaji_ulang(){
		$barcode_form = $this->input->post('barcode_form');
		$chk = $this->input->post('chk[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				$this->db->select("COUNT(*) as num");
				$this->db->where('barcode_form',$barcode_form);
				$this->db->where('id_kaji_ulang',$chk[$i]);
				$q = $this->db->get('nkr_form_detil')->row();
				$jml = $q->num;
				if($jml == 0){
					$kode = $this->m_rancak->kode_generator_urut(15,'3F');
					$urut_form_detil = $this->m_kredensial->urut_form_detil($barcode_form);
					$urut_form_detil++;
					$data_pendaftaran = array(
						'no_urut_detil' => $urut_form_detil,
						'id_kaji_ulang' => $chk[$i],
						'barcode_form_detil' => $kode,
						'barcode_form' => $barcode_form
					);
					$this->db->insert('nkr_form_detil', $data_pendaftaran);
				}
			}
		}
	}
	function edit_nkr_indikator_pertanyaan(){
		$id_indikator = $this->input->post('id_indikator');
		$data_pendaftaran = array(
			'poin_indikator' => $this->input->post('poin_indikator'),
			'pertanyaan_indikator' => $this->input->post('pertanyaan_indikator'),
			'jawaban_indikator' => $this->input->post('jawaban_indikator'),
			'ketercapaian_indikator' => $this->input->post('ketercapaian_indikator')
		);
		$this->db->where('id_indikator',$id_indikator);
		$this->db->update('nkr_indikator', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function edit_urutan_detil(){
		$id_form_detil = $this->input->post('id_form_detil');
		$data_pendaftaran = array(
			'no_urut_detil' => $this->input->post('no_urut_detil')
		);
		$this->db->where('id_form_detil',$id_form_detil);
		$this->db->update('nkr_form_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function simpan_nkr_form(){
		$kode = $this->m_rancak->kode_generator_urut(15,'UF');
		$data_pendaftaran = array(
			'id_jenis_form' => $this->input->post('id_jenis_form'),
			'id_kompetensi' => $this->input->post('id_kompetensi'),
			'pembuat_form' => $this->session->id_pegawai,
			'barcode_form' => $kode,
			'id_instansi' => $this->input->post('id_instansi')
		);
		// print_r($data_pendaftaran);die();
		return $this->db->insert('nkr_form', $data_pendaftaran);		
		// $this->db->insert_id();			
	}
	function edit_nkr_form(){
		$id_form = $this->input->post('id_form');
		$data_pendaftaran = array(
			'id_kompetensi' => $this->input->post('id_kompetensi'),
			'id_instansi' => $this->input->post('id_instansi')
		);
		$this->db->where('id_form',$id_form);
		$this->db->update('nkr_form', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function simpan_nkr_question_form_detil(){
		$barcode_form = $this->input->post('barcode_form');
		$chk = $this->input->post('chk[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				$this->db->select("COUNT(*) as num");
				$this->db->where('barcode_form',$barcode_form);
				$this->db->where('id_question',$chk[$i]);
				$q = $this->db->get('nkr_form_detil')->row();
				$jml = $q->num;
				if($jml == 0){
					$kode = $this->m_rancak->kode_generator_urut(15,'QF');
					$urut_form_detil = $this->m_kredensial->urut_form_detil($barcode_form);
					$urut_form_detil++;
					$data_pendaftaran = array(
						'no_urut_detil' => $urut_form_detil,
						'id_question' => $chk[$i],
						'barcode_form_detil' => $kode,
						'barcode_form' => $barcode_form
					);
					$this->db->insert('nkr_form_detil', $data_pendaftaran);
				}
			}
		}
	}
	function simpan_nkr_indikator_form_detil(){
		$barcode_form = $this->input->post('barcode_form');
		$chk = $this->input->post('chk[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				$this->db->select("COUNT(*) as num");
				$this->db->where('barcode_form',$barcode_form);
				$this->db->where('id_indikator',$chk[$i]);
				$q = $this->db->get('nkr_form_detil')->row();
				$jml = $q->num;
				if($jml == 0){
					$kode = $this->m_rancak->kode_generator_urut(15,'QF');
					$urut_form_detil = $this->m_kredensial->urut_form_detil($barcode_form);
					$urut_form_detil++;
					$data_pendaftaran = array(
						'no_urut_detil' => $urut_form_detil,
						'id_indikator' => $chk[$i],
						'barcode_form2_detil' => $kode,
						'barcode_form' => $barcode_form
					);
					$this->db->insert('nkr_form_detil', $data_pendaftaran);
				}
			}
		}
	}
	function simpan_nkr_metode_form_detil(){
		$chk = $this->input->post('chk[]');
		$id_form_detil = $this->input->post('id_form_detil');	
		$eimplo = implode(",",$chk);
		if($chk){
			$data_pendaftaran = array(
				'metode_form_detil' => $eimplo
			);
			$this->db->where('id_form_detil',$id_form_detil);
			$this->db->update('nkr_form_detil', $data_pendaftaran);
			//echo $this->db->last_query();
			$this->db->trans_complete();	// untuk cek sukses update tidak
			if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
			// if (!$this->db->affected_rows()) 
				return(FALSE);
			else 
				return(TRUE);
		}
	}
	function simpan_nkr_perangkat_form_detil(){
		$chk = $this->input->post('chk[]');
		$id_form_detil = $this->input->post('id_form_detil');	
		$eimplo = implode(",",$chk);
		if($chk){
			$data_pendaftaran = array(
				'perangkat_form_detil' => $eimplo
			);
			$this->db->where('id_form_detil',$id_form_detil);
			$this->db->update('nkr_form_detil', $data_pendaftaran);
			//echo $this->db->last_query();
			$this->db->trans_complete();	// untuk cek sukses update tidak
			if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
			// if (!$this->db->affected_rows()) 
				return(FALSE);
			else 
				return(TRUE);
		}
	}
	function langkah_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*";
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
					// case 'telp' : $nmf="peg.telp";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('nkr_pra_asesmen npa');

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'id_ms_code'   : $nmf="kc.id_ms_code";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}

	    $this->db->from('nkr_pra_asesmen npa');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('nkr_pra_asesmen');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_nkr_pra_asesmen(){
		$kode = $this->m_rancak->kode_generator_urut(15,'PA');
		$data_pendaftaran = array(
			'pembuat_pra_asesmen' => $this->session->id_pegawai,
			'barcode_pra_asesmen' => $kode,
			'nama_pra_asesmen' => $this->input->post('nama_pra_asesmen')
		);
		// print_r($data_pendaftaran);die();
		return $this->db->insert('nkr_pra_asesmen', $data_pendaftaran);		
		// $this->db->insert_id();			
	}
	function edit_nkr_pra_asesmen(){
		$id_pra_asesmen = $this->input->post('id_pra_asesmen');
		$data_pendaftaran = array(
			'nama_pra_asesmen' => $this->input->post('nama_pra_asesmen')
		);
		$this->db->where('id_pra_asesmen',$id_pra_asesmen);
		$this->db->update('nkr_pra_asesmen', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function kegiatan_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,if(npd.id_jabatan = 0,'Semua Profesi',nama_jabatan) as nama_jabatan";
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
					// case 'telp' : $nmf="peg.telp";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('nkr_pra_detil npd');
	    $this->db->join('nkr_pra_asesmen npa', 'npa.barcode_pra_asesmen=npd.barcode_pra_asesmen','left');
	    	    $this->db->join('jabatan j', 'j.id_jabatan=npd.id_jabatan','left');

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'id_ms_code'   : $nmf="kc.id_ms_code";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}

	    $this->db->from('nkr_pra_detil npd');
	    $this->db->join('nkr_pra_asesmen npa', 'npa.barcode_pra_asesmen=npd.barcode_pra_asesmen','left');
	    $this->db->join('jabatan j', 'j.id_jabatan=npd.id_jabatan','left');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('nkr_pra_detil');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_nkr_pra_detil(){
		$kode = $this->m_rancak->kode_generator_urut(15,'PD');
		$data_pendaftaran = array(
			'pembuat_pra_detil' => $this->session->id_pegawai,
			'barcode_pra_detil' => $kode,
			'id_jabatan' => $this->input->post('id_jabatan'),
			'barcode_pra_asesmen' => $this->input->post('barcode_pra_asesmen'),
			'nama_pra_detil' => $this->input->post('nama_pra_detil')
		);
		// print_r($data_pendaftaran);die();
		return $this->db->insert('nkr_pra_detil', $data_pendaftaran);		
		// $this->db->insert_id();			
	}
	function edit_nkr_pra_detil(){
		$id_pra_detil = $this->input->post('id_pra_detil');
		$data_pendaftaran = array(
			'nama_pra_detil' => $this->input->post('nama_pra_detil'),
			'id_jabatan' => $this->input->post('id_jabatan'),
			'barcode_pra_asesmen' => $this->input->post('barcode_pra_asesmen')
		);
		$this->db->where('id_pra_detil',$id_pra_detil);
		$this->db->update('nkr_pra_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function kat_kaji_ulang_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*";
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
					// case 'telp' : $nmf="peg.telp";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('nkr_kat_kaji');

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'id_ms_code'   : $nmf="kc.id_ms_code";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}

	    $this->db->from('nkr_kat_kaji');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('nkr_kat_kaji');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_nkr_kat_kaji(){
		$kode = $this->m_rancak->kode_generator_urut(15,'KU');
		$data_pendaftaran = array(
			'pembuat_kat_kaji' => $this->session->id_pegawai,
			'nama_kat_kaji' => $this->input->post('nama_kat_kaji')
		);
		// print_r($data_pendaftaran);die();
		return $this->db->insert('nkr_kat_kaji', $data_pendaftaran);		
		// $this->db->insert_id();			
	}
	function edit_nkr_kat_kaji(){
		$id_kat_kaji = $this->input->post('id_kat_kaji');
		$data_pendaftaran = array(
			'id_kat_kaji' => $this->input->post('id_kat_kaji'),
			'nama_kat_kaji' => $this->input->post('nama_kat_kaji')
		);
		$this->db->where('id_kat_kaji',$id_kat_kaji);
		$this->db->update('nkr_kat_kaji', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function kaji_ulang_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,if(nku.id_kat_kaji = 0,'-',nama_kat_kaji) as nama_kat_kaji";
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
					// case 'telp' : $nmf="peg.telp";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('nkr_kaji_ulang nku');
	    $this->db->join('kol_jenis_form kjf', 'kjf.id_jenis_form=nku.id_jenis_form','left');
	    $this->db->join('nkr_kat_kaji nkk', 'nkk.id_kat_kaji=nku.id_kat_kaji','left');

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'id_ms_code'   : $nmf="kc.id_ms_code";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}

	    $this->db->from('nkr_kaji_ulang nku');
	    $this->db->join('kol_jenis_form kjf', 'kjf.id_jenis_form=nku.id_jenis_form','left');
	    $this->db->join('nkr_kat_kaji nkk', 'nkk.id_kat_kaji=nku.id_kat_kaji','left');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('nkr_kaji_ulang');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_nkr_kaji_ulang(){
		$kode = $this->m_rancak->kode_generator_urut(15,'KU');
		$data_pendaftaran = array(
			'pembuat_kaji_ulang' => $this->session->id_pegawai,
			'id_jenis_form' => $this->input->post('id_jenis_form'),
			'id_kat_kaji' => $this->input->post('id_kat_kaji'),
			'nama_kaji_ulang' => $this->input->post('nama_kaji_ulang')
		);
		// print_r($data_pendaftaran);die();
		return $this->db->insert('nkr_kaji_ulang', $data_pendaftaran);		
		// $this->db->insert_id();			
	}
	function edit_nkr_kaji_ulang(){
		$id_kaji_ulang = $this->input->post('id_kaji_ulang');
		$data_pendaftaran = array(
			'id_kat_kaji' => $this->input->post('id_kat_kaji'),
			'id_jenis_form' => $this->input->post('id_jenis_form'),
			'nama_kaji_ulang' => $this->input->post('nama_kaji_ulang')
		);
		$this->db->where('id_kaji_ulang',$id_kaji_ulang);
		$this->db->update('nkr_kaji_ulang', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
}