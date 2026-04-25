<?php
class M_admin_user extends CI_model{
	function mhs_all($key)
	{
		$wordsAry = explode("-", $key);
		$wordsCount = count($wordsAry);
		$jabatan = explode(',', $this->session->mas_kred);
		$instansi = explode(',', $this->session->mas_ins);
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
		$this->db->where('visible', 1);
		$this->db->where('status_user', 1);
		$this->db->where('status_pegawai_unit', 1);
		$this->db->where('ol_user.id_level', 53);
		$this->db->where_in('ol_user.refer', $instansi);
		$this->db->where_in('jabatan_fungsional.id_jabatan', $jabatan);
		if(!empty($key) || $this->input->post('key',true)){
			$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
					$this->db->or_where("(peg.nama_pegawai LIKE '%".$wordsAry[$i]."%' OR jabatan_fungsional.nama_jabatan_fungsional LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_user');
	    $this->db->join('ol_pegawai peg', 'peg.id_pegawai=ol_user.id_pegawai','left');
	    $this->db->join('user_level', 'user_level.id_level=ol_user.id_level','left');
	    $this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
	    $this->db->join('mhs_pegawai_unit opu', 'opu.barcode_pegawai=peg.barcode_pegawai','left');
	    $this->db->join('ol_unit ou', 'ou.id_unit=opu.id_unit','left');
	    $this->db->join('kol_working', 'kol_working.id_working=ol_user.refer','left');
		$this->db->join('kol_status_kawin kss', 'kss.id_status_kawin=peg.id_status_kawin','left');
		$this->db->join('ol_status_pegawai ksp', 'ksp.id_status_pegawai=peg.tipe_pegawai','left');
		$this->db->join('kol_pendidikan kp', 'kp.id_pendidikan=peg.id_pendidikan','left');
		$this->db->where('visible', 1);
		$this->db->where('status_user', 1);
		$this->db->where('status_pegawai_unit', 1);
		$this->db->where('ol_user.id_level', 53);
		$this->db->where_in('ol_user.refer', $instansi);
		$this->db->where_in('jabatan_fungsional.id_jabatan', $jabatan);
		if(!empty($key) || $this->input->post('key',true)){
			$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(peg.nama_pegawai LIKE '%".$wordsAry[$i]."%' OR jabatan_fungsional.nama_jabatan_fungsional LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
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
		$this->db->where('visible', 1);
		$this->db->where('status_user', 1);
		$this->db->where('status_pegawai_unit', 1);
		$this->db->where('ol_user.id_level', 53);
		$this->db->where_in('ol_user.refer', $instansi);
		$this->db->where_in('jabatan_fungsional.id_jabatan', $jabatan);
		if(!empty($key) || $this->input->post('key',true)){
			$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(peg.nama_pegawai LIKE '%".$wordsAry[$i]."%' OR jabatan_fungsional.nama_jabatan_fungsional LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
			}
		  }
		}

	    $this->db->from('ol_user');
	    $this->db->join('ol_pegawai peg', 'peg.id_pegawai=ol_user.id_pegawai','left');
	    $this->db->join('user_level', 'user_level.id_level=ol_user.id_level','left');
	    $this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
	    $this->db->join('mhs_pegawai_unit opu', 'opu.barcode_pegawai=peg.barcode_pegawai','left');
	    $this->db->join('ol_unit ou', 'ou.id_unit=opu.id_unit','left');
	    $this->db->join('kol_working', 'kol_working.id_working=ol_user.refer','left');
		$this->db->where('visible', 1);
		$this->db->where('status_user', 1);
		$this->db->where('status_pegawai_unit', 1);
		$this->db->where('ol_user.id_level', 53);
		$this->db->where_in('ol_user.refer', $instansi);
		$this->db->where_in('jabatan_fungsional.id_jabatan', $jabatan);
		if(!empty($key) || $this->input->post('key',true)){
			$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(peg.nama_pegawai LIKE '%".$wordsAry[$i]."%' OR jabatan_fungsional.nama_jabatan_fungsional LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('ol_user');			//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
	//	 print_r($output);die();
		return $output;
	}
	function ambil_data_unit()	//daftar.php pasien
	{
		$this->db->select("id_unit,concat(nama_unit,' = ',nama_working) as nama_unit");
		$this->db->join('kol_working','kol_working.id_working=ol_unit.id_instansi','left');
		$q = $this->db->get_where('ol_unit',array('status_unit'=>1))->result_array();
		$hasil= array_column($q,'nama_unit','id_unit');
		return $hasil;
	}
	function nonaktif_mhs_unit(){
		$barcode_pegawai = $this->input->post('barcode_pegawai');	
		$id_unit_lama = $this->input->post('id_unit_lama');	
		$data_pendaftaran = array(
			'status_pegawai_unit' => 0
		);
		$this->db->where('barcode_pegawai',$barcode_pegawai);
		$this->db->where('id_unit',$id_unit_lama);
		$this->db->update('mhs_pegawai_unit', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function simpan_mhs_unit(){
		$kode = $this->m_rancak->kode_generator_urut(15,'MH');
		$data_pendaftaran = array(
			'id_pegawai_unit' => $kode,
			'id_unit' => $this->input->post('id_unit'),
			'barcode_pegawai' => $this->input->post('barcode_pegawai')
		);
		return $this->db->insert('mhs_pegawai_unit', $data_pendaftaran);
	}
// ===========================================================
	function cmd_level(){
	//	$idl = array(51,53);
	//	$idl = explode(',', $idk);
		$this->db->select("id_level,nama_level");
		$this->db->where("id_level",51);
		$q= $this->db->get_where('user_level')->result_array();
		$hasil= array_column($q,'nama_level','id_level');
		return $hasil;
	}
	function registrasi_all($id)
	{
		$idx = explode(',', $this->session->mas_ins);
		$fields = "*,DATE_FORMAT(wkt_registrasi,'%d-%m-%Y') as wkt_registrasi,DATE_FORMAT(expired_working,'%d-%m-%Y') as expired_working,if(status_bayar_working = 1,'Premium','Free') as status_bayar_working
		";
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
				$this->db->where_in("id_instansi",$idx);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_registrasi or');
		$this->db->join('kol_working ol', 'ol.id_working=or.id_instansi','left');
		$this->db->where_in("id_instansi",$idx);

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
				$this->db->where_in("id_instansi",$idx);
			}
		  }
		}

		$this->db->from('ol_registrasi or');
		$this->db->join('kol_working ol', 'ol.id_working=or.id_instansi','left');
		$this->db->where_in("id_instansi",$idx);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$kondisi=array('id_instansi'=>$this->session->refer);
		$jml = $this->m_umum->jumlah_record_filter('ol_registrasi',$kondisi);
		//$jml = $this->m_umum->jumlah_record_tabel('ol_registrasi');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_aktifasi(){
		$barcode_registrasi = $this->input->post('barcode_registrasi');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$tgl_lahir = date('Y-m-d', strtotime($tgl_lahir));
		$kode = $this->m_rancak->kode_generator_urut(15,'PG');
		$data_pendaftaran = array(
			'barcode_pegawai' => $kode,		
			'nama_pegawai' => $this->input->post('nama_pegawai'),
			'jk' => $this->input->post('jk'),
			'tmp_lahir' => $this->input->post('tmp_lahir'),
			'tgl_lahir' => $tgl_lahir,
			'email' => $this->input->post('email'),
			'no_hp' => $this->input->post('no_hp'),
			'nik' => $this->input->post('nik'),
			'nip' => $this->input->post('nip'),
			'id_status_kawin' => $this->input->post('id_status_kawin'),
			'id_agama' => $this->input->post('id_agama'),
			'id_pendidikan' => $this->input->post('id_pendidikan'),
			'tipe_pegawai' => $this->input->post('tipe_pegawai'),
			'id_jabatan_fungsional' => $this->input->post('id_jabatan_fungsional'),
			'alamat' => $this->input->post('alamat')
		);
		$this->db->insert('ol_pegawai', $data_pendaftaran);
		return $this->db->insert_id();
	}
	function simpan_user($id){
		$kode = $this->m_rancak->kode_generator_urut(15,'US');
		$id_unit= $this->input->post('id_unit');
    	$username= $this->input->post('username');
		$id_jabatan_fungsional= $this->input->post('id_jabatan_fungsional');
		$jabatane = $this->m_umum->ambil_data('jabatan_fungsional','id_jabatan_fungsional',$id_jabatan_fungsional);
    	$unitee = $this->m_umum->ambil_data('ol_unit','id_unit',$id_unit);
		$username = strtolower($username);
		$username = str_replace(' ', '-', $username);
		$username = preg_replace('/[^A-Za-z0-9\-]/', '', $username);
		$password = hash("sha512", md5('7654321'));		
		$data_pendaftaran = array(
			'refer' => $this->input->post('id_instansi'),
			'unit' => $id_unit,
      		'mas_unit' => $unitee['coun_unit'],
			'mas_ins' => $this->input->post('id_instansi'),
			'mas_kred' => $jabatane['id_jabatan'],
			'mas_asesor' => $jabatane['id_jabatan'],
			'username' => $username,
			'password' => $password,	
			'id_pegawai' => $id,
			'barcode_user' => $kode,
			'id_level' => $this->input->post('id_level')
		);
		return $this->db->insert('ol_user', $data_pendaftaran);
	}
		function simpan_pegawai_unit_user($id){
		$data_pendaftaran = array(
			'id_unit' => $this->input->post('id_unit'),
			'id_pegawai' => $id
		);
		return $this->db->insert('ol_pegawai_unit', $data_pendaftaran);
	}
	function simpan_instansi($id){
		$id_instansi = $this->input->post('id_instansi');
		$kondisi=array('id_instansi'=>$id_instansi,'id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('ol_pegawai_instansi',$kondisi);
		if($jml == 0){
			$data_pendaftaran = array(
				'id_pegawai' => $id,
				'id_instansi' => $id_instansi
			);
			return $this->db->insert('ol_pegawai_instansi', $data_pendaftaran);
		}
	}
	function edit_pegawai(){
		$id_grade = $this->input->post('id_grade');
		$id_pegawai = $this->input->post('id_pegawai');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$tgl_lahir = date('Y-m-d', strtotime($tgl_lahir));
		$nik= $this->input->post('nik');
		$nip= $this->input->post('nip');
		if($id_grade){
			$id_grade = $this->input->post('id_grade');
		}else{
			$id_grade = 0;
		}
		$data_pendaftaran = array(
			'email' =>$this->input->post('email'),
			'nama_pegawai' => $this->input->post('nama_pegawai'),
			'tipe_pegawai' =>$this->input->post('tipe_pegawai'),
			'no_hp' =>$this->input->post('no_hp'),
			'jk' =>$this->input->post('jk'),
			'nik' => $this->input->post('nik'),
			'nip' => $this->input->post('nip'),
			'no_profesi' => $this->input->post('no_profesi'),
			'tmp_lahir' => $this->input->post('tmp_lahir'),
			'id_prov' => $this->input->post('id_prov'),
			'id_kab' => $this->input->post('id_kab'),
			'id_kel' => $this->input->post('id_kel'),
			'id_kec' => $this->input->post('id_kec'),
			'tgl_lahir' => $tgl_lahir,
			'id_status_kawin' => $this->input->post('id_status_kawin'),
			'id_pendidikan' => $this->input->post('id_pendidikan'),
			'id_jabatan_fungsional' => $this->input->post('id_jabatan_fungsional'),
			'id_agama' => $this->input->post('id_agama'),
			'id_grade' => $id_grade,
			'alamat' => $this->input->post('alamat')
		);
		$this->db->where('id_pegawai',$id_pegawai);
		$this->db->update('ol_pegawai', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function edit_user(){
		$id_user = $this->input->post('id_user');
		$username = $this->input->post('username');
		$username = strtolower($username);
		$username = str_replace(' ', '-', $username);
		$username = preg_replace('/[^A-Za-z0-9\-]/', '', $username);
		$username_lama = $this->input->post('username_lama');
		if($username == "" OR empty($username)){
			$username = $username_lama;
		}elseif($username == $username_lama){
			$username = $username_lama;
		}else{
			$username = $username;
		}
		$password = $this->input->post('password');
		$passlama = $this->input->post('password_lama');
		if($password == "" OR empty($password)){
			$passworde = $passlama;
		}else{
			$passworde = hash("sha512", md5($password));
		}
		$data_pendaftaran = array(
			'username' => $username,
			'password' => $passworde,
		);
		$this->db->where('id_user',$id_user);
		$this->db->update('ol_user', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function berkas_kategori_all()
	{
		$instansi = explode(',', $this->session->mas_ins);
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
		$this->db->where('kunci', 25);
		$this->db->where_in('instansi_berkas_kategori', $instansi);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_berkas_kategori');
	    $this->db->join('kol_working', 'kol_working.id_working=ol_berkas_kategori.instansi_berkas_kategori','left');
	    $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_berkas_kategori.pembuat_berkas_kategori','left');
	    $this->db->join('jabatan', 'jabatan.id_jabatan=ol_berkas_kategori.id_jabatan','left');
		$this->db->where('kunci', 25);
		$this->db->where_in('instansi_berkas_kategori', $instansi);
		
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
		$this->db->where('kunci', 25);
		$this->db->where_in('instansi_berkas_kategori', $instansi);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('ol_berkas_kategori');
	    $this->db->join('kol_working', 'kol_working.id_working=ol_berkas_kategori.instansi_berkas_kategori','left');
	    $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_berkas_kategori.pembuat_berkas_kategori','left');
	    $this->db->join('jabatan', 'jabatan.id_jabatan=ol_berkas_kategori.id_jabatan','left');
		$this->db->where('kunci', 25);
		$this->db->where_in('instansi_berkas_kategori', $instansi);
		
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('ol_berkas_kategori');		//[coding here] ganti tabel utamanya
				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;	
	}
	function simpan_berkas_kategori($id){
		$data_pendaftaran = array(
			'nama_berkas_kategori' => $this->input->post('nama_berkas_kategori'),
			'instansi_berkas_kategori' => $this->session->refer,
			'id_jabatan' => $this->session->id_jabatan,
			'pembuat_berkas_kategori' => $this->session->id_pegawai,
			'status_berkas_kategori' => $this->input->post('status_berkas_kategori')
		);
		return $this->db->insert('ol_berkas_kategori', $data_pendaftaran);
	}
	function edit_berkas_kategori(){
		$id_berkas_kategori = $this->input->post('id_berkas_kategori');
		$data_pendaftaran = array(
			'nama_berkas_kategori' => $this->input->post('nama_berkas_kategori'),
			'status_berkas_kategori' => $this->input->post('status_berkas_kategori')
		);
		$this->db->where('id_berkas_kategori',$id_berkas_kategori);
		$this->db->update('ol_berkas_kategori', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}
	function kategori_pelatihan_all()
	{
		$instansi = explode(',', $this->session->mas_ins);
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
				$this->db->where_in('instansi_kategori_pelatihan', $instansi);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_kategori_pelatihan');
	    $this->db->join('kol_working', 'kol_working.id_working=ol_kategori_pelatihan.instansi_kategori_pelatihan','left');
	    $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_kategori_pelatihan.pembuat_kategori_pelatihan','left');
	    $this->db->where_in('instansi_kategori_pelatihan', $instansi);
		
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
				$this->db->where_in('instansi_kategori_pelatihan', $instansi);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('ol_kategori_pelatihan');
	    $this->db->join('kol_working', 'kol_working.id_working=ol_kategori_pelatihan.instansi_kategori_pelatihan','left');
	    $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_kategori_pelatihan.pembuat_kategori_pelatihan','left');
	    $this->db->where_in('instansi_kategori_pelatihan', $instansi);
		
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('ol_kategori_pelatihan');		//[coding here] ganti tabel utamanya
				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;	
	}
	function simpan_kategori_pelatihan(){
		$data_pendaftaran = array(
			'nama_kategori_pelatihan' => $this->input->post('nama_kategori_pelatihan'),
			'instansi_kategori_pelatihan' => $this->session->refer,
			'pembuat_kategori_pelatihan' => $this->session->id_pegawai,
			'id_jabatan' => $this->session->id_jabatan,
			'status_kategori_pelatihan' => $this->input->post('status_kategori_pelatihan')
		);
		return $this->db->insert('ol_kategori_pelatihan', $data_pendaftaran);
	}
	function edit_kategori_pelatihan(){
		$id_kategori_pelatihan = $this->input->post('id_kategori_pelatihan');
		$data_pendaftaran = array(
			'nama_kategori_pelatihan' => $this->input->post('nama_kategori_pelatihan'),
			'instansi_kategori_pelatihan' => $this->session->refer,
			'status_kategori_pelatihan' => $this->input->post('status_kategori_pelatihan')
		);
		$this->db->where('id_kategori_pelatihan',$id_kategori_pelatihan);
		$this->db->update('ol_kategori_pelatihan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}
	function user_all($key)
	{
		$wordsAry = explode("-", $key);
		$wordsCount = count($wordsAry);
		$jabatan = explode(',', $this->session->mas_kred);
		$instansi = explode(',', $this->session->mas_ins);
	//--------- Ambil nama kolom --------- [coding here] .jpg
	$fields = "*,if (foto = '' ,'noavatar.jpg',foto) as foto,if(ol_user.status_asesor = 1,kk.nama_komite,'Anggota') as nama_komite,
		DATE_FORMAT(peg.tgl_lahir,'%d-%m-%Y') as tgl_lahir,if (peg.jk = '1' ,'Laki-laki','Perempuan') as jk,ol_user.id_pegawai,
		DATE_FORMAT(tgl_aplikasi_bayar,'%d-%m-%Y %H:%i:%s') as tgl_aplikasi_bayar,DATE_FORMAT(tgl_expired,'%d-%m-%Y') as tgl_expired,
		if(status_aplikasi_bayar = 1,if(tgl_expired < CURDATE(),'expired','aktif'),'premium') as status_aplikasi_bayar,
		if(peg.pengurus_pengcab = '0','Anggota',nama_ms_pengurus) as nama_ms_pengurus
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
		$this->db->where('visible', 1);
		$this->db->where('status_user', 1);
		$this->db->where_in('ol_user.refer', $instansi);
	//	$this->db->where_in('jabatan_fungsional.id_jabatan', $jabatan);
		if(!empty($key) || $this->input->post('key',true)){
			$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(peg.nama_pegawai LIKE '%".$wordsAry[$i]."%' OR jabatan_fungsional.nama_jabatan_fungsional LIKE '%".$wordsAry[$i]."%' OR kk.nama_komite LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_user');
	    $this->db->join('kol_komite kk', 'kk.id_komite=ol_user.status_asesor','left');
	    $this->db->join('ol_pegawai peg', 'peg.id_pegawai=ol_user.id_pegawai','left');
	    $this->db->join('ol_pegawai_grade opg', 'opg.id_grade=peg.id_grade','left');
	    $this->db->join('srt_dpk opc', 'opc.id_dpk=peg.id_pengcab','left');
	    $this->db->join('kol_ms_pengurus kmp', 'kmp.id_ms_pengurus=peg.pengurus_pengcab','left');
	    $this->db->join('aplikasi_bayar', 'aplikasi_bayar.id_konsumen=peg.id_pegawai','left');
	    $this->db->join('user_level', 'user_level.id_level=ol_user.id_level','left');
	    $this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
	    $this->db->join('ol_pegawai_unit opu', 'opu.id_pegawai=peg.id_pegawai','left');
	    $this->db->join('ol_unit ou', 'ou.id_unit=opu.id_unit','left');
	    $this->db->join('kol_working', 'kol_working.id_working=ol_user.refer','left');
		$this->db->join('kol_status_kawin kss', 'kss.id_status_kawin=peg.id_status_kawin','left');
		$this->db->join('ol_status_pegawai ksp', 'ksp.id_status_pegawai=peg.tipe_pegawai','left');
		$this->db->join('kol_pendidikan kp', 'kp.id_pendidikan=peg.id_pendidikan','left');
		$this->db->where('visible', 1);
		$this->db->where('status_user', 1);
		$this->db->where_in('ol_user.refer', $instansi);
	//	$this->db->where_in('jabatan_fungsional.id_jabatan', $jabatan);
		if(!empty($key) || $this->input->post('key',true)){
			$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(peg.nama_pegawai LIKE '%".$wordsAry[$i]."%' OR jabatan_fungsional.nama_jabatan_fungsional LIKE '%".$wordsAry[$i]."%' OR kk.nama_komite LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
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
		$this->db->where('visible', 1);
		$this->db->where('status_user', 1);
		$this->db->where_in('ol_user.refer', $instansi);
	//	$this->db->where_in('jabatan_fungsional.id_jabatan', $jabatan);
		if(!empty($key) || $this->input->post('key',true)){
			$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(peg.nama_pegawai LIKE '%".$wordsAry[$i]."%' OR jabatan_fungsional.nama_jabatan_fungsional LIKE '%".$wordsAry[$i]."%' OR kk.nama_komite LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
			}
		  }
		}

	    $this->db->from('ol_user');
	    $this->db->join('kol_komite kk', 'kk.id_komite=ol_user.status_asesor','left');
	    $this->db->join('ol_pegawai peg', 'peg.id_pegawai=ol_user.id_pegawai','left');
	    $this->db->join('ol_pegawai_grade opg', 'opg.id_grade=peg.id_grade','left');
	    $this->db->join('srt_dpk opc', 'opc.id_dpk=peg.id_pengcab','left');
	    $this->db->join('kol_ms_pengurus kmp', 'kmp.id_ms_pengurus=peg.pengurus_pengcab','left');
	    $this->db->join('aplikasi_bayar', 'aplikasi_bayar.id_konsumen=peg.id_pegawai','left');
	    $this->db->join('user_level', 'user_level.id_level=ol_user.id_level','left');
	    $this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
	    $this->db->join('ol_pegawai_unit opu', 'opu.id_pegawai=peg.id_pegawai','left');
	    $this->db->join('ol_unit ou', 'ou.id_unit=opu.id_unit','left');
	    $this->db->join('kol_working', 'kol_working.id_working=ol_user.refer','left');
		$this->db->join('kol_status_kawin kss', 'kss.id_status_kawin=peg.id_status_kawin','left');
		$this->db->join('ol_status_pegawai ksp', 'ksp.id_status_pegawai=peg.tipe_pegawai','left');
		$this->db->join('kol_pendidikan kp', 'kp.id_pendidikan=peg.id_pendidikan','left');
		$this->db->where('visible', 1);
		$this->db->where('status_user', 1);
		$this->db->where_in('ol_user.refer', $instansi);
	//	$this->db->where_in('jabatan_fungsional.id_jabatan', $jabatan);
		if(!empty($key) || $this->input->post('key',true)){
			$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(peg.nama_pegawai LIKE '%".$wordsAry[$i]."%' OR jabatan_fungsional.nama_jabatan_fungsional LIKE '%".$wordsAry[$i]."%' OR kk.nama_komite LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('ol_user');			//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
	//	 print_r($output);die();
		return $output;
	}
	function reset_password($id){
		$password = hash("sha512", md5("7654321"));
		$data_pendaftaran = array(
			'password' => $password
		);
		$this->db->where('id_user',$id);
		$this->db->update('ol_user', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function simpan_pegawai_unit(){
		$data_pendaftaran = array(
			'id_unit' => $this->input->post('id_unit'),
			'id_pegawai' => $this->input->post('id_pegawai')
		);
		return $this->db->insert('ol_pegawai_unit', $data_pendaftaran);
	}
	function edit_pegawai_unit(){
		$id_pegawai = $this->input->post('id_pegawai');	
		$data_pendaftaran = array(
			'id_unit' => $this->input->post('id_unit')
		);
		$this->db->where('id_pegawai',$id_pegawai);
		$this->db->update('ol_pegawai_unit', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function simpan_status_pengcab(){
		$id_pegawai = $this->input->post('id_pegawai');	
		$data_pendaftaran = array(
			'id_pengcab' => $this->input->post('id_pengcab')
		);
		$this->db->where('id_pegawai',$id_pegawai);
		$this->db->update('ol_pegawai', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function ambil_data_ms_pengurus()
	{	
		$idj = $this->session->id_jabatan;
		$idi = $this->session->mas_ins;
		$this->db->select("id_ms_pengurus,nama_ms_pengurus");
		$this->db->where('status_ms_pengurus', 1);
		if($idj == 0){
			$array_check = array(0);
		}else{
			$array_check = array(0,$idj);
		}
		if($idi == 0){
			$array_ins = array(0);
		}else{
			$array_ins = array(0,$idi);
		}
		$this->db->where_in('id_jabatan', $array_check);
		$this->db->where_in('id_instansi', $array_ins);
		$q = $this->db->get_where('kol_ms_pengurus');
		return $q->result_array();
	}
	function simpan_pengurus_pengcab(){
		$id_pegawai = $this->input->post('id_pegawai');	
		$data_pendaftaran = array(
			'pengurus_pengcab' => $this->input->post('pengurus_pengcab')
		);
		$this->db->where('id_pegawai',$id_pegawai);
		$this->db->update('ol_pegawai', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function simpan_status_asesor(){
		$id_user = $this->input->post('id_user');	
		$data_pendaftaran = array(
			'status_asesor' => $this->input->post('status_asesor')
		);
		$this->db->where('id_user',$id_user);
		$this->db->update('ol_user', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function simpan_grade(){
		$id_pegawai = $this->input->post('id_pegawai');	
		$data_pendaftaran = array(
			'id_grade' => $this->input->post('id_grade')
		);
		$this->db->where('id_pegawai',$id_pegawai);
		$this->db->update('ol_pegawai', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function ambil_data_pengcab()
	{
		$this->db->select("nama_dpk,id_dpk");
		$this->db->where('id_jabatan', $this->session->id_jabatan);
        $query = $this->db->get_where('srt_dpk')->result_array();
		$q= array_column($query,'nama_dpk','id_dpk');
		return $q;
	}
	function srt_kategori_surat_all()
	{
		$idx = explode(',', $this->session->mas_ins);
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
				$this->db->where_in("ou.id_instansi",$idx);
				$this->db->where("ou.tipe_jabatan",0);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('srt_kategori_surat ou');
	    $this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
	    $this->db->where_in("ou.id_instansi",$idx);
	    $this->db->where("ou.tipe_jabatan",0);
		
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
				$this->db->where_in("ou.id_instansi",$idx);
				$this->db->where("ou.tipe_jabatan",0);
			}
		  }
		}

	    $this->db->from('srt_kategori_surat ou');
	    $this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
	    $this->db->where_in("ou.id_instansi",$idx);
	    $this->db->where("ou.tipe_jabatan",0);
		
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('srt_kategori_surat');		//[coding here] ganti tabel utamanya
				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;	
	}
	function simpan_srt_kategori_surat(){
		$kode = $this->m_rancak->kode_generator_urut(15,'EL');
		$data_pendaftaran = array(
			'id_kategori_surat' => $kode,
			'tipe_jabatan' => 0,
			'nama_kategori_surat' => $this->input->post('nama_kategori_surat'),
			'id_instansi' => $this->input->post('id_instansi'),
			'status_kategori_surat' => $this->input->post('status_kategori_surat')
		);
		return $this->db->insert('srt_kategori_surat', $data_pendaftaran);
	}
	function edit_srt_kategori_surat(){
		$id_kategori_surat = $this->input->post('id_kategori_surat');
		$data_pendaftaran = array(
			'nama_kategori_surat' => $this->input->post('nama_kategori_surat'),
			'id_instansi' => $this->input->post('id_instansi'),
			'status_kategori_surat' => $this->input->post('status_kategori_surat')
		);
		$this->db->where('id_kategori_surat',$id_kategori_surat);
		$this->db->update('srt_kategori_surat', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}
// ========================================= MASTER
	function peminatan_all()
	{
	//	$instansi = explode(',', $this->session->mas_ins);
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
		$this->db->where('opem.id_jabatan', $this->session->id_jabatan);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_peminatan opem');
	    $this->db->join('jabatan j', 'j.id_jabatan=opem.id_jabatan','left');
		$this->db->where('opem.id_jabatan', $this->session->id_jabatan);
		
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
		$this->db->where('opem.id_jabatan', $this->session->id_jabatan);
			}
		  }
		}


	    $this->db->from('ol_peminatan opem');
	    $this->db->join('jabatan j', 'j.id_jabatan=opem.id_jabatan','left');
		$this->db->where('opem.id_jabatan', $this->session->id_jabatan);
		
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('ol_berkas_kategori');		//[coding here] ganti tabel utamanya
				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;	
	}
	function simpan_peminatan(){
		$kode = $this->m_rancak->kode_generator_urut(15,'KW');
		$data_pendaftaran = array(
			'nama_peminatan' => $this->input->post('nama_peminatan'),
			'id_peminatan' => $kode,
			'id_jabatan' => $this->session->id_jabatan,
			'status_peminatan' => $this->input->post('status_peminatan')
		);
		return $this->db->insert('ol_peminatan', $data_pendaftaran);
	}
	function edit_peminatan(){
		$id_peminatan = $this->input->post('id_peminatan');
		$data_pendaftaran = array(
			'nama_peminatan' => $this->input->post('nama_peminatan'),
			'status_peminatan' => $this->input->post('status_peminatan')
		);
		$this->db->where('id_peminatan',$id_peminatan);
		$this->db->update('ol_peminatan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}
	function pendidikan_all()
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

	    $this->db->from('kol_pendidikan');
		
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

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('kol_pendidikan');
		
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('kol_pendidikan');		//[coding here] ganti tabel utamanya
				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;	
	}
	function simpan_pendidikan(){
		$data_pendaftaran = array(
			'nama_pendidikan' => $this->input->post('nama_pendidikan')
		);
		return $this->db->insert('kol_pendidikan', $data_pendaftaran);
	}
	function edit_pendidikan(){
		$id_pendidikan = $this->input->post('id_pendidikan');
		$data_pendaftaran = array(
			'nama_pendidikan' => $this->input->post('nama_pendidikan'),
			'status_pendidikan' => $this->input->post('status_pendidikan')
		);
		$this->db->where('id_pendidikan',$id_pendidikan);
		$this->db->update('kol_pendidikan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}
/*	function berkas_kategori_all()
	{
		$instansi = explode(',', $this->session->mas_ins);
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
		$this->db->where('kunci', 25);
		$this->db->where_in('instansi_berkas_kategori', $instansi);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_berkas_kategori');
	    $this->db->join('kol_working', 'kol_working.id_working=ol_berkas_kategori.instansi_berkas_kategori','left');
	    $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_berkas_kategori.pembuat_berkas_kategori','left');
	    $this->db->join('jabatan', 'jabatan.id_jabatan=ol_berkas_kategori.id_jabatan','left');
		$this->db->where('kunci', 25);
		$this->db->where_in('instansi_berkas_kategori', $instansi);
		
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
		$this->db->where('kunci', 25);
		$this->db->where_in('instansi_berkas_kategori', $instansi);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('ol_berkas_kategori');
	    $this->db->join('kol_working', 'kol_working.id_working=ol_berkas_kategori.instansi_berkas_kategori','left');
	    $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_berkas_kategori.pembuat_berkas_kategori','left');
	    $this->db->join('jabatan', 'jabatan.id_jabatan=ol_berkas_kategori.id_jabatan','left');
		$this->db->where('kunci', 25);
		$this->db->where_in('instansi_berkas_kategori', $instansi);
		
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('ol_berkas_kategori');		//[coding here] ganti tabel utamanya
				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;	
	}
	function simpan_berkas_kategori($id){
		$data_pendaftaran = array(
			'nama_berkas_kategori' => $this->input->post('nama_berkas_kategori'),
			'instansi_berkas_kategori' => $this->input->post('instansi_berkas_kategori'),
			'id_jabatan' => $this->session->id_jabatan,
			'pembuat_berkas_kategori' => $this->session->id_pegawai,
			'status_berkas_kategori' => $this->input->post('status_berkas_kategori')
		);
		return $this->db->insert('ol_berkas_kategori', $data_pendaftaran);
	}
	function edit_berkas_kategori(){
		$id_berkas_kategori = $this->input->post('id_berkas_kategori');
		$data_pendaftaran = array(
			'nama_berkas_kategori' => $this->input->post('nama_berkas_kategori'),
			'instansi_berkas_kategori' => $this->input->post('instansi_berkas_kategori'),
			'status_berkas_kategori' => $this->input->post('status_berkas_kategori')
		);
		$this->db->where('id_berkas_kategori',$id_berkas_kategori);
		$this->db->update('ol_berkas_kategori', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}
	function kategori_pelatihan_all()
	{
		$instansi = explode(',', $this->session->mas_ins);
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
				$this->db->where_in('instansi_kategori_pelatihan', $instansi);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_kategori_pelatihan');
	    $this->db->join('kol_working', 'kol_working.id_working=ol_kategori_pelatihan.instansi_kategori_pelatihan','left');
	    $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_kategori_pelatihan.pembuat_kategori_pelatihan','left');
	    $this->db->where_in('instansi_kategori_pelatihan', $instansi);
		
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
				$this->db->where_in('instansi_kategori_pelatihan', $instansi);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('ol_kategori_pelatihan');
	    $this->db->join('kol_working', 'kol_working.id_working=ol_kategori_pelatihan.instansi_kategori_pelatihan','left');
	    $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_kategori_pelatihan.pembuat_kategori_pelatihan','left');
	    $this->db->where_in('instansi_kategori_pelatihan', $instansi);
		
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('ol_kategori_pelatihan');		//[coding here] ganti tabel utamanya
				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;	
	}
	function simpan_kategori_pelatihan(){
		$data_pendaftaran = array(
			'nama_kategori_pelatihan' => $this->input->post('nama_kategori_pelatihan'),
			'instansi_kategori_pelatihan' => $this->input->post('instansi_kategori_pelatihan'),
			'pembuat_kategori_pelatihan' => $this->session->id_pegawai,
			'id_jabatan' => $this->session->id_jabatan,
			'status_kategori_pelatihan' => $this->input->post('status_kategori_pelatihan')
		);
		return $this->db->insert('ol_kategori_pelatihan', $data_pendaftaran);
	}
	function edit_kategori_pelatihan(){
		$id_kategori_pelatihan = $this->input->post('id_kategori_pelatihan');
		$data_pendaftaran = array(
			'nama_kategori_pelatihan' => $this->input->post('nama_kategori_pelatihan'),
			'instansi_kategori_pelatihan' => $this->input->post('instansi_kategori_pelatihan'),
			'status_kategori_pelatihan' => $this->input->post('status_kategori_pelatihan')
		);
		$this->db->where('id_kategori_pelatihan',$id_kategori_pelatihan);
		$this->db->update('ol_kategori_pelatihan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}*/
	function ol_unit_all()
	{
		$idx = explode(',', $this->session->mas_ins);
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
				$this->db->where_in("ou.id_instansi",$idx);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_unit ou');
	    $this->db->join('srt_struktur_jabatan sj', 'sj.id_struktur_jabatan=ou.id_struktur_jabatan','left');
	    $this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
	    $this->db->where_in("ou.id_instansi",$idx);
		
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
				$this->db->where_in("ou.id_instansi",$idx);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('ol_unit ou');
	    $this->db->join('srt_struktur_jabatan sj', 'sj.id_struktur_jabatan=ou.id_struktur_jabatan','left');
	    $this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
	    $this->db->where_in("ou.id_instansi",$idx);
		
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('ol_unit');		//[coding here] ganti tabel utamanya
				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;	
	}
	function simpan_ol_unit(){
		$kode = $this->m_rancak->kode_generator_urut(15,'OU');
		$data_pendaftaran = array(
			'id_unit' => $kode,
			'nama_unit' => $this->input->post('nama_unit'),
			'id_instansi' => $this->input->post('id_instansi'),
			'id_struktur_jabatan' => $this->input->post('id_struktur_jabatan'),
			'status_unit' => $this->input->post('status_unit')
		);
		return $this->db->insert('ol_unit', $data_pendaftaran);
	}
	function edit_ol_unit(){
		$id_unit = $this->input->post('id_unit');
		$data_pendaftaran = array(
			'nama_unit' => $this->input->post('nama_unit'),
			'id_instansi' => $this->input->post('id_instansi'),
			'id_struktur_jabatan' => $this->input->post('id_struktur_jabatan'),
			'status_unit' => $this->input->post('status_unit')
		);
		$this->db->where('id_unit',$id_unit);
		$this->db->update('ol_unit', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}
	function ms_etik_all($id)
	{
		$idx = explode(',', $this->session->mas_kred);
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
	    $this->db->where("ne.id_instansi",$this->session->refer);
	    if(empty($id)){
			$this->db->where_in("ne.id_jabatan",$idx);
	    }else{
	    	$this->db->where("ne.id_jabatan",$id);
	    }	
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('nkr_etik ne');
	    $this->db->join('jabatan j', 'j.id_jabatan=ne.id_jabatan','left');
	    $this->db->where("ne.id_instansi",$this->session->refer);
	    if(empty($id)){
			$this->db->where_in("ne.id_jabatan",$idx);
	    }else{
	    	$this->db->where("ne.id_jabatan",$id);
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
	    $this->db->where("ne.id_instansi",$this->session->refer);
	    if(empty($id)){
			$this->db->where_in("ne.id_jabatan",$idx);
	    }else{
	    	$this->db->where("ne.id_jabatan",$id);
	    }	
			}
		  }
		}

	    $this->db->from('nkr_etik ne');
	    $this->db->join('jabatan j', 'j.id_jabatan=ne.id_jabatan','left');
	    $this->db->where("ne.id_instansi",$this->session->refer);
	    if(empty($id)){
			$this->db->where_in("ne.id_jabatan",$idx);
	    }else{
	    	$this->db->where("ne.id_jabatan",$id);
	    }	    
		
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('nkr_etik');		//[coding here] ganti tabel utamanya
				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;	
	}
	function simpan_nkr_etik(){
		$kode = $this->m_rancak->kode_generator_urut(15,'ET');
		$data_pendaftaran = array(
			'id_etik' => $kode,
			'nama_etik' => $this->input->post('nama_etik'),
			'id_jabatan' => $this->input->post('id_jabatan'),
			'answer' => $this->input->post('answer'),
			'status_etik' => $this->input->post('status_etik'),
			'id_instansi' => $this->session->refer,
			'pembuat_etik' => $this->session->id_pegawai
		);
		return $this->db->insert('nkr_etik', $data_pendaftaran);
	}
	function edit_nkr_etik(){
		$id_etik = $this->input->post('id_etik');
		$data_pendaftaran = array(
			'nama_etik' => $this->input->post('nama_etik'),
			'id_jabatan' => $this->input->post('id_jabatan'),
			'answer' => $this->input->post('answer'),
			'status_etik' => $this->input->post('status_etik')
		);
		$this->db->where('id_etik',$id_etik);
		$this->db->update('nkr_etik', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}
  	function ambil_list_pegawai($idi,$idj){
  		$this->db->join('ol_pegawai op', 'op.id_pegawai=opi.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=op.id_jabatan_fungsional','left');
		$q = $this->db->get_where('ol_pegawai_instansi opi',array('opi.id_instansi'=>$idi,'jf.id_jabatan'=>$idj,'status_pegawai'=>1));
		return $q->result_array();
	}
	function ambil_berkas_from_list($idp,$idk,$idi,$idj=FALSE){
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=ob.id_pegawai','left');
		$this->db->join('ol_pegawai_instansi opi', 'opi.id_pegawai=peg.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
		$this->db->join('ol_berkas_kategori obk', 'obk.id_berkas_kategori=ob.id_kategori_berkas','left');
		$this->db->where("status_berkas", 1);
		$this->db->where("ob.id_pegawai", $idp);
		$this->db->where("ob.id_kategori_berkas", $idk);
		if($idj){
			$q = $this->db->get_where('ol_berkas ob',array('opi.id_instansi'=>$idi,'jf.id_jabatan'=>$idj));
		}else{
			$q = $this->db->get_where('ol_berkas ob',array('peg.id_pengcab'=>$idi));
		}
		return $q->result_array();
	}
  	function ambil_berkas_pelatihan_person($idr,$ruangan,$idi,$idj,$grup=FALSE,$select=FALSE){
	    $array_check = array(4,5,6,8,9,10,11);
	    if($select){
	    	$this->db->select($select);
	    }
	    $this->db->join('ol_berkas_kategori obk', 'obk.id_berkas_kategori=ob.id_kategori_berkas','left');
		$this->db->join('ol_kategori_pelatihan okp', 'okp.id_kategori_pelatihan=ob.id_kategori_pelatihan','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=ob.id_pegawai','left');
		$this->db->join('ol_pegawai_instansi opi', 'opi.id_pegawai=peg.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
	//    $this->db->where_in('ob.id_kategori_berkas', $array_check);
	    $this->db->where("obk.kunci", 1);
	    $this->db->where("ob.id_kategori_pelatihan >", 0);
	    $this->db->where("ob.status_berkas", 1);
	    $this->db->where($idr, $ruangan);
	    if($grup){
	    	$this->db->group_by($grup);
	    }
	    if(empty($idj) OR $idj == 0){
			$q = $this->db->get_where('ol_berkas ob',array('opi.id_instansi'=>$idi));
	    }else{
			$q = $this->db->get_where('ol_berkas ob',array('opi.id_instansi'=>$idi,'jf.id_jabatan'=>$idj));
	    }

		return $q->result_array();
	}
  	function ambil_berkas_pelatihan_person_pengcab($idr,$ruangan,$idi,$idj,$grup=FALSE,$select=FALSE){
	    $array_check = array(4,5,6,8,9,10,11);
	    if($select){
	    	$this->db->select($select);
	    }
	    $this->db->join('ol_berkas_kategori obk', 'obk.id_berkas_kategori=ob.id_kategori_berkas','left');
		$this->db->join('ol_kategori_pelatihan okp', 'okp.id_kategori_pelatihan=ob.id_kategori_pelatihan','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=ob.id_pegawai','left');
		$this->db->join('ol_pegawai_instansi opi', 'opi.id_pegawai=peg.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
	//    $this->db->where_in('ob.id_kategori_berkas', $array_check);
	    $this->db->where("obk.kunci", 1);
	    $this->db->where("ob.id_kategori_pelatihan >", 0);
	    $this->db->where("ob.status_berkas", 1);
	    $this->db->where($idr, $ruangan);
	    if($grup){
	    	$this->db->group_by($grup);
	    }
	    if(empty($idj) OR $idj == 0){
			$q = $this->db->get_where('ol_berkas ob',array('peg.id_pengcab'=>$idi));
	    }else{
			$q = $this->db->get_where('ol_berkas ob',array('peg.id_pengcab'=>$idi,'jf.id_jabatan'=>$idj));
	    }

		return $q->result_array();
	}
  	function ambil_berkas_pelatihan_profesi($idr,$ruangan,$idi,$idj,$grup=FALSE,$select=FALSE){
	    $array_check = array(4,5,6,8,9,10,11);
	    if($select){
	    	$this->db->select($select);
	    }
	    $this->db->join('ol_berkas_kategori obk', 'obk.id_berkas_kategori=ob.id_kategori_berkas','left');
		$this->db->join('ol_kategori_pelatihan okp', 'okp.id_kategori_pelatihan=ob.id_kategori_pelatihan','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=ob.id_pegawai','left');
		$this->db->join('ol_pegawai_instansi opi', 'opi.id_pegawai=peg.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
	//    $this->db->where_in('ob.id_kategori_berkas', $array_check);
	//    $this->db->where("ob.id_kategori_pelatihan >", 0);
		$this->db->where("obk.kunci", 1);
	    $this->db->where("ob.status_berkas", 1);
	    $this->db->where($idr, $ruangan);
	    if($grup){
	    	$this->db->group_by($grup);
	    }
	    if(empty($idj) OR $idj == 0){
			$q = $this->db->get_where('ol_berkas ob',array('opi.id_instansi'=>$idi));
	    }else{
			$q = $this->db->get_where('ol_berkas ob',array('opi.id_instansi'=>$idi,'jf.id_jabatan'=>$idj));
	    }

		return $q->result_array();
	}
  	function ambil_berkas_pelatihan_biasa($idr,$ruangan,$idi,$idj,$grup=FALSE,$select=FALSE){
	    $array_check = array(4,5,6,8,9,10,11);
	    if($select){
	    	$this->db->select($select);
	    }
		$this->db->join('ol_berkas_kategori obk', 'obk.id_berkas_kategori=ob.id_kategori_berkas','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=ob.id_pegawai','left');
		$this->db->join('ol_pegawai_instansi opi', 'opi.id_pegawai=peg.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
	//    $this->db->where_in('ob.id_kategori_berkas', $array_check);
	    $this->db->where("obk.kunci", 1);
	    $this->db->where("ob.status_berkas", 1);
	    $this->db->where("ob.id_kategori_pelatihan", 0);
	    $this->db->where($idr, $ruangan);
	    if($grup){
	    	$this->db->group_by($grup);
	    }
	    if(empty($idj) OR $idj == 0){
			$q = $this->db->get_where('ol_berkas ob',array('opi.id_instansi'=>$idi));
	    }else{
			$q = $this->db->get_where('ol_berkas ob',array('opi.id_instansi'=>$idi,'jf.id_jabatan'=>$idj));
	    }

		return $q->result_array();
	}
	function grafik_all_pegawai($select,$kondisi)
	{
		$this->db->select($select);
		$this->db->join('ol_pegawai ope', 'ope.id_pegawai=opi.id_pegawai','left');
		$this->db->join('kol_pendidikan kpen', 'kpen.id_pendidikan=ope.id_pendidikan','left');
		$this->db->join('kol_agama kag', 'kag.id_agama=ope.id_agama','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=ope.id_status_kawin','left');
		$this->db->join('ol_status_pegawai osp', 'osp.id_status_pegawai=ope.tipe_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=ope.id_jabatan_fungsional','left');		
		$q = $this->db->get_where('ol_pegawai_instansi opi',$kondisi);
		return $q->row_array();
	}
	function grafik_all_pegawai_result($select,$kondisi,$grup = FALSE)
	{
		$this->db->select($select);
		$this->db->join('ol_pegawai ope', 'ope.id_pegawai=opi.id_pegawai','left');
		$this->db->join('kol_pendidikan kpen', 'kpen.id_pendidikan=ope.id_pendidikan','left');
		$this->db->join('kol_agama kag', 'kag.id_agama=ope.id_agama','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=ope.id_status_kawin','left');
		$this->db->join('ol_status_pegawai osp', 'osp.id_status_pegawai=ope.tipe_pegawai','left');
		$this->db->join('ol_pegawai_grade opg', 'opg.id_grade=ope.id_grade','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=ope.id_jabatan_fungsional','left');
		$this->db->join('jabatan j', 'j.id_jabatan=jf.id_jabatan','left');
		$this->db->join('kol_working kw', 'kw.id_working=opi.id_instansi','left');
		$this->db->join('kol_provinsi prov', 'prov.id_prov=ope.id_prov','left');
		$this->db->join('kol_kabupaten kab', 'kab.id_kab=ope.id_kab','left');
		$this->db->join('kol_kecamatan kec', 'kec.id_kec=ope.id_kec','left');
		$this->db->join('kol_kelurahan kel', 'kel.id_kel=ope.id_kel','left');		
		if($grup)
		{ 
			$this->db->group_by($grup);	
			$this->db->order_by($grup,'ASC');	
		}
		$q = $this->db->get_where('ol_pegawai_instansi opi',$kondisi);
		return $q->result_array();	
	}
	function ambil_berkas_ijin($kondisi){
		$this->db->select("COUNT(ob.id_pegawai) as total_str");
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=ob.id_pegawai','left');
		$this->db->join('ol_pegawai_instansi opi', 'opi.id_pegawai=peg.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
		$this->db->join('ol_berkas_kategori okb', 'okb.id_berkas_kategori=ob.id_kategori_berkas','left');
		$this->db->where($kondisi);		
		$q = $this->db->get_where('ol_berkas ob');
		return $q->result_array();
	}
	function ambil_berkas_ijin_print($kondisi){
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=ob.id_pegawai','left');
		$this->db->join('ol_pegawai_instansi opi', 'opi.id_pegawai=peg.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
		$this->db->join('ol_berkas_kategori okb', 'okb.id_berkas_kategori=ob.id_kategori_berkas','left');
		$this->db->where($kondisi);		
		$q = $this->db->get_where('ol_berkas ob');
		return $q->result_array();
	}
	function grafik_all_pegawai_minat($select,$kondisi,$grup = FALSE)
	{
		$this->db->select($select);	
		$this->db->join('ol_pegawai ope', 'ope.id_pegawai=opm.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=ope.id_jabatan_fungsional','left');
		$this->db->join('ol_pegawai_instansi opi', 'opi.id_pegawai=ope.id_pegawai','left');		
		$this->db->join('ol_peminatan op', 'op.id_peminatan=opm.id_peminatan','left');			
		if($grup)
		{ 
		$this->db->group_by($grup);	
		$this->db->order_by($grup,'ASC');	
		}
		$q = $this->db->get_where('ol_pegawai_minat opm',$kondisi);
		return $q->result_array();	
	}
	function ambil_grafik_logbook($select,$kondisi)
	{
		$dateb = date("Y-m-d", strtotime("+3 years"));
		$this->db->select($select);
		$this->db->join('ol_pegawai ope', 'ope.id_pegawai=ol.id_logbooker','left');	
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=ope.id_jabatan_fungsional','left');	
		$this->db->join('ol_pegawai_unit opu', 'opu.id_pegawai=ope.id_pegawai','left');		
		$this->db->join('ol_unit opi', 'opi.id_unit=opu.id_unit','left');		
		$this->db->where("tgl_logbook > DATE_SUB(now(), INTERVAL 3 YEAR)");
		$this->db->group_by('YEAR(tgl_logbook)');	
		$this->db->order_by('YEAR(tgl_logbook)','ASC');
		$q = $this->db->get_where('ol_logbook ol',$kondisi);
		return $q->result_array();	
	}
	function ambil_grafik_logbook_person($id){
		$dateb = date("Y-m-d", strtotime("+3 years"));
		$this->db->select("sum(jml_logbook) as jml_logbookp,DATE_FORMAT(tgl_logbook,'%Y') as thnlg");
		$this->db->where("lp.id_logbooker", $id);
		$this->db->where("tgl_logbook > DATE_SUB(now(), INTERVAL 3 YEAR)");
		$this->db->group_by('YEAR(tgl_logbook)');	
		$this->db->order_by('YEAR(tgl_logbook)','ASC');
		$q = $this->db->get_where('ol_logbook lp',array('lp.id_logbooker'=>$id))->result_array();
	//	echo $this->db->last_query();die();
		return $q;
	}
  function ambil_grafik_logbook_person_tahunan($thn,$unit){
    $dateb = date("Y-m-d", strtotime("+3 years"));
    $this->db->select("nama_pegawai,nip,sum(jml_logbook) as jml_logbookp,DATE_FORMAT(tgl_logbook,'%Y') as thnlg");
    $this->db->join('ol_pegawai ope', 'ope.id_pegawai=ol.id_logbooker','left'); 
    $this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=ope.id_jabatan_fungsional','left');  
    $this->db->join('ol_pegawai_unit opu', 'opu.id_pegawai=ope.id_pegawai','left');   
    $this->db->join('ol_unit opi', 'opi.id_unit=opu.id_unit','left');   
    $this->db->where("tgl_logbook > DATE_SUB(now(), INTERVAL 3 YEAR)");
    $this->db->group_by('ol.id_logbooker'); 
    $this->db->order_by('ol.id_logbooker','ASC');
    $q = $this->db->get_where('ol_logbook ol',array('YEAR(tgl_logbook)'=>$thn,'opi.id_unit'=>$unit))->result_array();
  //  echo $this->db->last_query();die();
    return $q;
  }
	function ambil_grafik_etik_person($id){
		$dateb = date("Y-m-d", strtotime("-3 years"));
	//	$this->db->select("sum(jml_logbook) as jml_logbookp,DATE_FORMAT(tgl_logbook,'%Y') as thnlg");
	//	$this->db->where("lp.id_logbooker", $id);
		$this->db->join('ol_pegawai ope', 'ope.id_pegawai=lp.id_penguji','left');
		$this->db->where("tgl_etik_pegawai > DATE_SUB(now(), INTERVAL 2 YEAR)");
/*		$this->db->where('DATE(tgl_etik_pegawai) <=',$dateb);
		$this->db->where('DATE(tgl_etik_pegawai) >=',date('Y-m-d'));*/
	//	$this->db->group_by('YEAR(tgl_logbook)');	
		$this->db->order_by('DATE(tgl_etik_pegawai)','ASC');
		$q = $this->db->get_where('ol_etik_pegawai lp',array('lp.id_pegawai'=>$id))->result_array();
	//	echo $this->db->last_query();die();
		return $q;
	}
	function cmd_tahun_logbook($id)
	{
		$this->db->select("distinct(DATE_FORMAT(tgl_logbook,'%Y')) as tgl_logbook");
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=lp.id_logbooker','left');
		$q= $this->db->get_where('ol_logbook lp',array('peg.barcode_pegawai'=>$id))->result_array();
		$hasil= array_column($q,'tgl_logbook','tgl_logbook');
		return $hasil;
    }
	function ambil_range_logbook_bulanane($first_date,$last_date,$id){
		$this->db->select("DATE_FORMAT(tgl_logbook,'%m') as bulan,DATE_FORMAT(tgl_logbook,'%Y') as tahun");
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=lp.id_logbooker','left');
		$this->db->where("peg.barcode_pegawai", $id);
		$this->db->where('DATE(tgl_logbook) BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$this->db->group_by(array("MONTH(tgl_logbook)", "YEAR(tgl_logbook)"));
		$this->db->order_by('tgl_logbook','ASC');
		$q = $this->db->get('ol_logbook lp')->result_array();
	//	echo $this->db->last_query();die();
		return $q;
	}
	function ambil_data_dropdown_pegawai_no_null_instansi()
	{
		$ins = explode(',', $this->session->mas_ins);
		$jab = explode(',', $this->session->mas_kred);
		$this->db->join('ol_pegawai','ol_pegawai.id_pegawai=ol_pegawai_instansi.id_pegawai','left');
	//	$this->db->join('kol_kode_kewenangan','kol_kode_kewenangan.id_kode_kewenangan=ol_pegawai.id_kode_kewenangan','left');
		$this->db->join('kol_working','kol_working.id_working=ol_pegawai_instansi.id_instansi','left');
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
		$this->db->where_in("ol_pegawai_instansi.id_instansi",$ins);
		$this->db->where_in("jabatan_fungsional.id_jabatan",$jab);
		$this->db->order_by('nama_pegawai', 'asc');
		$q = $this->db->get_where('ol_pegawai_instansi',array('status_pegawai'=>1,'visible'=>1));
		return $q->result_array();
	}
	function ambil_range_logbook_kompetensi($bln,$thn,$id,$hasile=FALSE){
		$this->db->select("sum(jml_logbook) as jumlahk,kode_unit,nama_kompetensi,kd.id_kompetensi");
		$this->db->join('nkr_kewenangan kd', 'kd.id_kewenangan=lp.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nk', 'nk.id_kompetensi=kd.id_kompetensi','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=lp.id_logbooker','left');
		$this->db->where("peg.barcode_pegawai", $id);
		if($hasile){
			$this->db->where('YEAR(tgl_logbook)', $thn);
		}else{
			$this->db->where('YEAR(tgl_logbook)', $thn);
			$this->db->where('MONTH(tgl_logbook)', $bln);			
		}
		$this->db->group_by("kd.id_kompetensi");
		$this->db->order_by('kd.id_kompetensi','ASC');
		$q = $this->db->get_where('ol_logbook lp')->result_array();
	//	echo $this->db->last_query();die();
		return $q;
	}
	function ambil_range_logbook_bulanane_detil($bln,$thn,$idk,$id,$hasile=FALSE){
		$this->db->select("sum(jml_logbook) as jumlah,nama_kewenangan");
		$this->db->join('nkr_kewenangan kd', 'kd.id_kewenangan=lp.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nk', 'nk.id_kompetensi=kd.id_kompetensi','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=lp.id_logbooker','left');
		$this->db->where("kd.id_kompetensi", $idk);
		$this->db->where("peg.barcode_pegawai", $id);
		if($hasile){
			$this->db->where('YEAR(tgl_logbook)', $thn);
		}else{
			$this->db->where('YEAR(tgl_logbook)', $thn);
			$this->db->where('MONTH(tgl_logbook)', $bln);			
		}
		$this->db->group_by('lp.id_kewenangan');
		$q = $this->db->get_where('ol_logbook lp')->result_array();
		//echo $this->db->last_query();die();
		return $q;
	}
	function ambil_kategori_pelatihan($first_date,$last_date,$id){
		$this->db->select("
			count(lp.id_berkas) as jumlah,lp.id_kategori_pelatihan,sum(kredit) as jml_kredit,
			if(lp.id_kategori_pelatihan = 0,'Pelatihan Umum',nama_kategori_pelatihan) as nama_kategori_pelatihan
			");
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=lp.id_pegawai','left');
		$this->db->join('ol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=lp.id_kategori_pelatihan','left');
		$this->db->join('ol_berkas_kategori obk', 'obk.id_berkas_kategori=lp.id_kategori_berkas','left');
		$this->db->where("kunci", 1);
		$this->db->where('DATE(tgl_a_berkas) BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$this->db->where("peg.barcode_pegawai", $id);
		$this->db->group_by('lp.id_kategori_pelatihan');	
		$this->db->order_by('id_kategori_pelatihan','ASC');
		$q = $this->db->get_where('ol_berkas lp')->result_array();
	//	echo $this->db->last_query();die();
		return $q;
	}
	function ambil_berkas_kategori_pelatihan($first_date,$last_date,$id,$kat){
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=lp.id_pegawai','left');
		$this->db->join('ol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=lp.id_kategori_pelatihan','left');
		$this->db->join('ol_berkas_kategori obk', 'obk.id_berkas_kategori=lp.id_kategori_berkas','left');
		$this->db->where("kunci", 1);
		$this->db->where('DATE(tgl_a_berkas) BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$this->db->where("peg.barcode_pegawai", $id);
		$this->db->where("lp.id_kategori_pelatihan", $kat);
	//	$this->db->group_by("lp.id_kategori_pelatihan");
		$this->db->order_by('tgl_a_berkas','ASC');
		$q = $this->db->get_where('ol_berkas lp')->result_array();
	//	echo $this->db->last_query();die();
		return $q;
	}
	function ambil_etik($first_date,$last_date,$id){
		$this->db->select("*,peg2.nama_pegawai as penguji");
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=oep.id_pegawai','left');
		$this->db->join('ol_pegawai peg2', 'peg2.id_pegawai=oep.id_penguji','left');
		$this->db->where('DATE(tgl_etik_pegawai) BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$this->db->where("peg.barcode_pegawai", $id);
		$this->db->order_by('tgl_etik_pegawai','ASC');
		$q = $this->db->get_where('ol_etik_pegawai oep')->result_array();
	//	echo $this->db->last_query();die();
		return $q;
	}
  	function ambil_list_unit_kinerja(){
		$this->db->join('ol_unit opi', 'opi.id_unit=opu.id_unit','left');
		$this->db->where('opi.id_instansi',$this->session->refer);
	    $this->db->group_by('opu.id_unit');
  		$q = $this->db->get_where('ol_pegawai_unit opu'); 
		return $q->result_array();
	}
	function ambil_range_logbook_kompetensi_unit($first_date,$last_date,$id){
		$this->db->select("sum(jml_logbook) as jumlahk,kode_unit,nama_kompetensi,kd.id_kompetensi");
		$this->db->join('nkr_kewenangan kd', 'kd.id_kewenangan=lp.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nk', 'nk.id_kompetensi=kd.id_kompetensi','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=lp.id_logbooker','left');
		$this->db->join('ol_pegawai_unit opu', 'opu.id_pegawai=peg.id_pegawai','left');
		$this->db->where('DATE(tgl_logbook) BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$this->db->where("opu.id_unit", $id);
	//	$this->db->where('YEAR(tgl_logbook)', $thn);
		$this->db->group_by("kd.id_kompetensi");
		$this->db->order_by('kd.id_kompetensi','ASC');
		$q = $this->db->get_where('ol_logbook lp')->result_array();
	//	echo $this->db->last_query();die();
		return $q;
	}
	function ambil_range_logbook_bulanane_detil_unit($first_date,$last_date,$idk,$id){
		$this->db->select("sum(jml_logbook) as jumlah,nama_kewenangan");
		$this->db->join('nkr_kewenangan kd', 'kd.id_kewenangan=lp.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nk', 'nk.id_kompetensi=kd.id_kompetensi','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=lp.id_logbooker','left');
		$this->db->join('ol_pegawai_unit opu', 'opu.id_pegawai=peg.id_pegawai','left');
		$this->db->where('DATE(tgl_logbook) BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$this->db->where("kd.id_kompetensi", $idk);
		$this->db->where("opu.id_unit", $id);
	//	$this->db->where('YEAR(tgl_logbook)', $thn);
		$this->db->group_by('lp.id_kewenangan');
		$q = $this->db->get_where('ol_logbook lp')->result_array();
		//echo $this->db->last_query();die();
		return $q;
	}
	function ambil_sn_standar_mutu(){
		$this->db->select("id_standar_mutu,concat(nama_standar_mutu,' - ',nama_unit) as nama_standar_mutu");
		$this->db->join('ol_unit ou', 'ou.id_unit=sn_standar_mutu.id_unit','left');
		$q = $this->db->get_where('sn_standar_mutu',array('id_instansi'=>$this->session->refer))->result_array();
		$hasil= array_column($q,'nama_standar_mutu','id_standar_mutu');
		return $hasil;
	}
	function laporan_all($first_date,$last_date,$id)
	{
	$idx = explode(',', $this->session->unit);
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,DATE_FORMAT(tgl_laporan,'%d-%m-%Y') as tgl_laporan";
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
	    $this->db->where_in("sl.id_unit", $idx);
	    $this->db->where('tgl_laporan BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		if(!empty($id)){
			$this->db->where("sl.id_standar_mutu", $id);
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('sn_laporan sl');	
	    $this->db->join('sn_standar_mutu sm', 'sm.id_standar_mutu=sl.id_standar_mutu','left');
	    $this->db->where_in("sl.id_unit", $idx);		
	    $this->db->where('tgl_laporan BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		if(!empty($id)){
			$this->db->where("sl.id_standar_mutu", $id);
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
		$this->db->where_in("sl.id_unit", $idx);	
	    $this->db->where('tgl_laporan BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		if(!empty($id)){
			$this->db->where("sl.id_standar_mutu", $id);
		}
			}
		  }
		}

	    $this->db->from('sn_laporan sl');	
	    $this->db->join('sn_standar_mutu sm', 'sm.id_standar_mutu=sl.id_standar_mutu','left');
	    $this->db->where_in("sl.id_unit", $idx);		
	    $this->db->where('tgl_laporan BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		if(!empty($id)){
			$this->db->where("sl.id_standar_mutu", $id);
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('sn_laporan');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function laporan_tabel_all($idx)
	{
		$id = $this->m_umum->ambil_data('sn_laporan','barcode_laporan',$idx);
	//--------- Ambil nama kolom --------- [coding here] .jpg
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
				$this->db->where("slt.id_laporan", $id['id_laporan']);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('sn_laporan_tabel slt');	
	    $this->db->join('sn_laporan sl', 'sl.id_laporan=slt.id_laporan','left');
		$this->db->where("slt.id_laporan", $id['id_laporan']);

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
				$this->db->where("slt.id_laporan", $id['id_laporan']);
			}
		  }
		}

	    $this->db->from('sn_laporan_tabel slt');	
	    $this->db->join('sn_laporan sl', 'sl.id_laporan=slt.id_laporan','left');	
		$this->db->where("slt.id_laporan", $id['id_laporan']);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('sn_laporan_tabel');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function grafik_pie($id)
	{
		$lpd = $this->ambil_sn_laporan_detil($id);
		$this->db->select("
			if(total_lhu_detil = 0,
			100*(hasil_lhu_detil/count(*)),
			100*(hasil_lhu_detil/total_lhu_detil)) as total, 
			nama_limbah");
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
	//	$this->db->where("IF(range_mutu = 0 ,hasil_lhu_detil < standar_mutu, hasil_lhu_detil BETWEEN standar_mutu and range_mutu)", NULL, FALSE);
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');		
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}
		$this->db->group_by('sld.id_limbah');
		$q = $this->db->get_where('sn_lhu_detil sld');
		return $q->result_array();
	}
	function grafik_pie_all($id)
	{
		$lpd = $this->ambil_sn_laporan_detil($id);
		$this->db->select("SUM(hasil_lhu_detil) as total,nama_limbah");
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
	//	$this->db->where("IF(range_mutu = 0 ,hasil_lhu_detil < standar_mutu, hasil_lhu_detil BETWEEN standar_mutu and range_mutu)", NULL, FALSE);
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');		
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}
		$this->db->group_by('sld.id_limbah');
		$q = $this->db->get_where('sn_lhu_detil sld');
		return $q->result_array();
	}
	function grafik_batang_range($id)
	{
		$lpd = $this->ambil_sn_laporan_detil($id);
		$this->db->select('*,sum(hasil_lhu_detil) as hasil_lhu_detil');
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->join('sn_sumber_emisi se', 'se.id_sumber_emisi=sld.id_sumber_emisi','left');
	//	$this->db->where("IF(range_mutu = 0 ,hasil_lhu_detil < standar_mutu, hasil_lhu_detil BETWEEN standar_mutu and range_mutu)", NULL, FALSE);
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');		
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}
		if($lpd['id_sumber_emisi'] == NULL OR $lpd['id_sumber_emisi'] == 0 OR empty($lpd['id_sumber_emisi'])){ 
			
		}else{
			$ids = explode(',', $lpd['id_sumber_emisi']);
			$this->db->where_in('sld.id_sumber_emisi', $ids);
		}
		$this->db->group_by(array('sld.id_limbah','sld.id_lhu_detil')); 
		$q = $this->db->get_where('sn_lhu_detil sld');
		return $q->result_array();
	}
	function ambil_sn_laporan_tabel($id)
	{
		$this->db->join('sn_laporan sl', 'sl.id_laporan=sld.id_laporan','left');
		$this->db->order_by('urutan_laporan_tabel','asc');
		$q = $this->db->get_where('sn_laporan_tabel sld',array('sl.barcode_laporan'=>$id));
		return $q->result_array();
	}
	function ambil_sn_laporan_detil($id)
	{
		$this->db->join('sn_laporan sl', 'sl.id_laporan=sld.id_laporan','left');
		$q = $this->db->get_where('sn_laporan_tabel sld',array('sld.barcode_laporan_tabel'=>$id));
		return $q->row_array();
	}
    function max_tanggal_lhu($id)    //igd.php untuk menampilkan jumlah antrian di igd saja
    {
    	$lpd = $this->ambil_sn_laporan_detil($id);
		$this->db->select("max(tgl_lhu) as num");
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);		
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}
		$q = $this->db->get_where('sn_lhu_detil sld');
	    $result = $q->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
    }
    function min_tanggal_lhu($id)    //igd.php untuk menampilkan jumlah antrian di igd saja
    {
    	$lpd = $this->ambil_sn_laporan_detil($id);
		$this->db->select('min(tgl_lhu) as num');
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}
		$q = $this->db->get_where('sn_lhu_detil sld');
	    $result = $q->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
    }
    function max_standar_mutu($id)    //igd.php untuk menampilkan jumlah antrian di igd saja
    {
		$lpd = $this->ambil_sn_laporan_detil($id);
		$this->db->select("max(standar_mutu) as num");
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);		
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}
		$q = $this->db->get_where('sn_lhu_detil sld');
	    $result = $q->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
    }
    function min_standar_mutu($id)    //igd.php untuk menampilkan jumlah antrian di igd saja
    {
    	$lpd = $this->ambil_sn_laporan_detil($id);
		$this->db->select('min(standar_mutu) as num');
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);
/*		if($lpd['id_limbah'] > 0){ 
			$this->db->where('sld.id_limbah', $lpd['id_limbah']);
		}*/		
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}
		if($lpd['id_sumber_emisi'] == NULL OR $lpd['id_sumber_emisi'] == 0 OR empty($lpd['id_sumber_emisi'])){ 
			
		}else{
			$ids = explode(',', $lpd['id_sumber_emisi']);
			$this->db->where_in('sld.id_sumber_emisi', $ids);
		}
		$q = $this->db->get_where('sn_lhu_detil sld');
	    $result = $q->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
    }
    function min_range_mutu($id)    //igd.php untuk menampilkan jumlah antrian di igd saja
    {
    	$lpd = $this->ambil_sn_laporan_detil($id);
		$this->db->select('min(range_mutu) as num');
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}
		$q = $this->db->get_where('sn_lhu_detil sld');
	    $result = $q->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
    }
    function min_hasil($id)    //igd.php untuk menampilkan jumlah antrian di igd saja
    {
    	$lpd = $this->ambil_sn_laporan_detil($id);
		$this->db->select('min(hasil_lhu_detil) as num');
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);
/*		if($lpd['id_limbah'] > 0){ 
			$this->db->where('sld.id_limbah', $lpd['id_limbah']);
		}*/		
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}
		if($lpd['id_sumber_emisi'] == NULL OR $lpd['id_sumber_emisi'] == 0 OR empty($lpd['id_sumber_emisi'])){ 
			
		}else{
			$ids = explode(',', $lpd['id_sumber_emisi']);
			$this->db->where_in('sld.id_sumber_emisi', $ids);
		}
		$q = $this->db->get_where('sn_lhu_detil sld');
	    $result = $q->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
    }
	function jumlah_record_tabel_limbah_detil($id)
	{
		$lpd = $this->ambil_sn_laporan_detil($id);
		$this->db->select('COUNT(*) as num');
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->join('sn_sumber_emisi se', 'se.id_sumber_emisi=sld.id_sumber_emisi','left');
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where('sld.id_sumber_emisi >', 0);
		$q = $this->db->get_where('sn_lhu_detil sld');
	    $result = $q->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
	}
	function jumlah_record_tps($id)
    {
		$lpd = $this->ambil_sn_laporan_detil($id);
		$this->db->select('COUNT(*) as num');
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);
		$this->db->where('sld.id_tps >', 0);		
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}
		if($lpd['id_sumber_emisi'] == NULL OR $lpd['id_sumber_emisi'] == 0 OR empty($lpd['id_sumber_emisi'])){ 
			
		}else{
			$ids = explode(',', $lpd['id_sumber_emisi']);
			$this->db->where_in('sld.id_sumber_emisi', $ids);
		}
	//	$this->db->where("IF(range_mutu = 0 ,hasil_lhu_detil < standar_mutu, hasil_lhu_detil BETWEEN standar_mutu and range_mutu)", NULL, FALSE);
	//	$this->db->where('sld.id_limbah', $idl);
		$this->db->group_by('sld.id_tps');
		$q = $this->db->get_where('sn_lhu_detil sld');
	    $result = $q->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
    }
    function only_blnyear_lhu($id,$min,$max)    //igd.php untuk menampilkan jumlah antrian di igd saja
    {
    	$lpd = $this->ambil_sn_laporan_detil($id);
	//	$this->db->select("LEFT(DATE_FORMAT( tgl_lhu,'%m'),3) AS buln,DATE_FORMAT( tgl_lhu,'%m-%Y') AS blnyear");
		$this->db->select("DATE_FORMAT(tgl_lhu,'%m') AS buln,DATE_FORMAT( tgl_lhu,'%Y-%m') AS blnyear");
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}
		//$this->db->group_by('YEAR(tgl_lhu)','MONTH(tgl_lhu)');
		$this->db->group_by(array("YEAR(tgl_lhu)", "MONTH(tgl_lhu)"));
		$q = $this->db->get_where('sn_lhu_detil sld');
		return $q->result_array();
    }
	function tabel_limbah_detil($id)
	{
		$lpd = $this->ambil_sn_laporan_detil($id);
  	//	$this->db->select("sld.id_limbah,nama_limbah,");
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->join('sn_sumber_emisi se', 'se.id_sumber_emisi=sld.id_sumber_emisi','left');
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}
		$this->db->group_by('sld.id_limbah');
	//	$this->db->group_by(array('YEAR(tgl_lhu)','MONTH(tgl_lhu)','sld.id_limbah'));
		$this->db->order_by('nama_limbah','asc');
		$q = $this->db->get_where('sn_lhu_detil sld');
		return $q->result_array();
	}
    function ambil_berkas_lhu($id,$stm,$tgl_awal,$tgl_akhir)    //igd.php untuk menampilkan jumlah antrian di igd saja
    {
    	if(empty($id)){
			$this->db->where('tgl_lhu BETWEEN "'. $tgl_awal . '" and "'. $tgl_akhir.'"');    		
    	}else{
			$idx = explode(',', $id);
			$this->db->where_in('id_lhu', $idx);    		
    	}
    	$this->db->where('id_standar_mutu', $stm);	
    	$this->db->where('link_lhu is NOT NULL', NULL, FALSE);
    	$this->db->group_by('id_lhu');
		$q = $this->db->get_where('sn_lhu');
		return $q->result_array();
    }
    function count_berkas_lhu($id,$stm,$tgl_awal,$tgl_akhir)
    {
    	$this->db->select("count(id_lhu) as num");
    	if(empty($id)){
			$this->db->where('tgl_lhu BETWEEN "'. $tgl_awal . '" and "'. $tgl_akhir.'"');    		
    	}else{
			$idx = explode(',', $id);
			$this->db->where_in('id_lhu', $idx);    		
    	}
    	$this->db->where('id_standar_mutu', $stm);	
    	$this->db->where('link_lhu is NOT NULL', NULL, FALSE);
    	$this->db->group_by('id_lhu');
		$q = $this->db->get_where('sn_lhu');
	    $result = $q->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
    }
	function grafik_garis_opsi($id){
		$lpd = $this->ambil_sn_laporan_detil($id);
		$this->db->select("DATE_FORMAT(tgl_lhu,'%d-%m-%Y') as tgl_lhu,sld.id_limbah,
			DATE_FORMAT(tgl_lhu,'%Y') as thn,DATE_FORMAT(tgl_lhu,'%m') as bln,DATE_FORMAT(tgl_lhu,'%d') as hr
			");
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);		
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}
		$this->db->group_by("tgl_lhu,sld.id_limbah");
		$q = $this->db->get_where('sn_lhu_detil sld')->result_array();
		//echo $this->db->last_query();die();
		return $q;
	}
	function ambil_limbah_grafik_aza($id){
		$lpd = $this->ambil_sn_laporan_detil($id);
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}
		$this->db->group_by("sld.id_limbah");
		$q = $this->db->get_where('sn_lhu_detil sld')->result_array();
		//echo $this->db->last_query();die();
		return $q;
	}
	function ambil_dt_limbah_grafik($id){
		$lpd = $this->ambil_sn_laporan_detil($id);
		$this->db->select("nama_limbah,sld.id_limbah");
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);		
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}
		if($lpd['id_sumber_emisi'] == NULL OR $lpd['id_sumber_emisi'] == 0 OR empty($lpd['id_sumber_emisi'])){ 
			
		}else{
			$ids = explode(',', $lpd['id_sumber_emisi']);
			$this->db->where_in('sld.id_sumber_emisi', $ids);
		}
		$this->db->group_by('sld.id_limbah');
		$q = $this->db->get_where('sn_lhu_detil sld')->result_array();
	//	echo $this->db->last_query();die();
		return $q;
	}
	function grafik_only_limbah($id)
	{
		$lpd = $this->ambil_sn_laporan_detil($id);
	//	$this->db->select('hasil_lhu_detil,standar_mutu,range_mutu,nama_limbah');
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->join('sn_sumber_emisi se', 'se.id_sumber_emisi=sld.id_sumber_emisi','left');
		$this->db->where("IF(range_mutu = 0 ,hasil_lhu_detil < standar_mutu, hasil_lhu_detil BETWEEN standar_mutu and range_mutu)", NULL, FALSE);
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');		
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}
		if($lpd['id_sumber_emisi'] == NULL OR $lpd['id_sumber_emisi'] == 0 OR empty($lpd['id_sumber_emisi'])){ 
			
		}else{
			$ids = explode(',', $lpd['id_sumber_emisi']);
			$this->db->where_in('sld.id_sumber_emisi', $ids);
		}
		$this->db->group_by('sld.id_limbah');
	//	$this->db->group_by(array('sld.id_lhu_detil')); 
		$q = $this->db->get_where('sn_lhu_detil sld');
		return $q->result_array();
	}
	function grafik_batang_kelola($id)
	{
		$lpd = $this->ambil_sn_laporan_detil($id);
	//	$this->db->select('hasil_lhu_detil,standar_mutu,range_mutu,nama_limbah');
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->join('sn_sumber_emisi se', 'se.id_sumber_emisi=sld.id_sumber_emisi','left');
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');		
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}
		if($lpd['id_sumber_emisi'] == NULL OR $lpd['id_sumber_emisi'] == 0 OR empty($lpd['id_sumber_emisi'])){ 
			
		}else{
			$ids = explode(',', $lpd['id_sumber_emisi']);
			$this->db->where_in('sld.id_sumber_emisi', $ids);
		}
	//	$this->db->where("IF(range_mutu = 0 ,hasil_lhu_detil < standar_mutu, hasil_lhu_detil BETWEEN standar_mutu and range_mutu)", NULL, FALSE);
	//	$this->db->group_by('sld.id_limbah'); 
		$this->db->order_by('tgl_lhu','asc'); 
		$q = $this->db->get_where('sn_lhu_detil sld');
		return $q->result_array();
	}
	function grafik_batang_range_jejer($id)
	{
		$lpd = $this->ambil_sn_laporan_detil($id);
		$this->db->select('*,sum(hasil_lhu_detil) as hasil_lhu_detil');
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->join('sn_sumber_emisi se', 'se.id_sumber_emisi=sld.id_sumber_emisi','left');
	//	$this->db->where("IF(range_mutu = 0 ,hasil_lhu_detil < standar_mutu, hasil_lhu_detil BETWEEN standar_mutu and range_mutu)", NULL, FALSE);
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');		
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}
		if($lpd['id_sumber_emisi'] == NULL OR $lpd['id_sumber_emisi'] == 0 OR empty($lpd['id_sumber_emisi'])){ 
			
		}else{
			$ids = explode(',', $lpd['id_sumber_emisi']);
			$this->db->where_in('sld.id_sumber_emisi', $ids);
		}
		$this->db->group_by(array('sld.id_limbah','sld.id_lhu_detil')); 
		$q = $this->db->get_where('sn_lhu_detil sld');
		return $q->result_array();
	}
	function ol_berkas_in($id,$idp)
	{
		$ids = explode(",", $id);
  		$this->db->where_in('id_berkas', $ids);
  		$this->db->where('id_kategori_pelatihan', $idp);
  		$this->db->where('id_kategori_berkas', 12);
		$q = $this->db->get_where('ol_berkas');
		return $q->result_array();
	}
	function tabel_detil($id,$idl,$blyr,$min,$max,$ids) //belum
	{
		$lpd = $this->ambil_sn_laporan_detil($id);
  	//	$this->db->select("*,YEAR(tgl_lhu) as tahune, MONTH(tgl_lhu) as bulane, COUNT(sld.id_limbah) as hitung,SUM(hasil_lhu_detil) as hasile");
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->where('tgl_lhu BETWEEN "'. $min . '" and "'. $max.'"');
		$this->db->where('sld.id_limbah', $idl);
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);
		$this->db->where("DATE_FORMAT(tgl_lhu,'%Y-%m')", $blyr);
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}
		$this->db->group_by(array('YEAR(tgl_lhu)','MONTH(tgl_lhu)','sld.id_limbah','sld.hasil_lhu_detil'));
	//	$this->db->group_by(array('YEAR(tgl_lhu)','MONTH(tgl_lhu)'));
		$q = $this->db->get_where('sn_lhu_detil sld');
		return $q->result_array();
	}
	function grafik_garis_hasil($tgl,$id){
	//	$this->db->select("sld.id_limbah,hasil_lhu_detil,round(hasil_lhu_detil/total_lhu_detil*100,1) as prosen,nama_limbah");
		$this->db->select("sld.id_limbah,sum(hasil_lhu_detil) as hasil_lhu_detil");
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->where('sld.id_limbah', $id);
		$this->db->where('tgl_lhu', date('Y-m-d', strtotime($tgl)));
	//	$this->db->group_by("sld.id_limbah,hasil_lhu_detil");
		$q = $this->db->get_where('sn_lhu_detil sld')->result_array();
		//echo $this->db->last_query();die();
		return $q;
	}
	function ambil_all_limbah_grafik($id,$idl){
		$lpd = $this->ambil_sn_laporan_detil($id);
		$this->db->select("count(*) as cemua");
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where('sld.id_limbah', $idl);
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);		
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}
		if($lpd['id_sumber_emisi'] == NULL OR $lpd['id_sumber_emisi'] == 0 OR empty($lpd['id_sumber_emisi'])){ 
			
		}else{
			$ids = explode(',', $lpd['id_sumber_emisi']);
			$this->db->where_in('sld.id_sumber_emisi', $ids);
		}
		$this->db->group_by('sld.id_limbah');
		$q = $this->db->get_where('sn_lhu_detil sld')->result_array();
		//echo $this->db->last_query();die();
		return $q;
	}
	function ambil_sesuai_limbah_grafik($id,$idl){
		$lpd = $this->ambil_sn_laporan_detil($id);
		$this->db->select("
			IF(range_mutu = 0 ,SUM(CASE WHEN hasil_lhu_detil < standar_mutu THEN 1 ELSE 0 END),SUM(CASE WHEN hasil_lhu_detil BETWEEN standar_mutu and range_mutu THEN 1 ELSE 0 END)) as cesuai
			");
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where('sld.id_limbah', $idl);
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);		
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
/*		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}*/
		if($lpd['id_sumber_emisi'] == NULL OR $lpd['id_sumber_emisi'] == 0 OR empty($lpd['id_sumber_emisi'])){ 
			
		}else{
			$ids = explode(',', $lpd['id_sumber_emisi']);
			$this->db->where_in('sld.id_sumber_emisi', $ids);
		}
	//	$this->db->where("IF(range_mutu = 0 ,hasil_lhu_detil < standar_mutu, hasil_lhu_detil BETWEEN standar_mutu and range_mutu)", NULL, FALSE);
		$this->db->group_by('sld.id_limbah');
		$q = $this->db->get_where('sn_lhu_detil sld')->result_array();
		//echo $this->db->last_query();die();
		return $q;
	}
  	function ambil_list_unit_pegawai($kondisi,$grup=FALSE){
  		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_pegawai_unit.id_pegawai','left');
		$this->db->join('ol_unit', 'ol_unit.id_unit=ol_pegawai_unit.id_unit','left');
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
	    if($grup){
	    	$this->db->group_by($grup);
	    }
  		$q = $this->db->get_where('ol_pegawai_unit',$kondisi); 
		return $q->result_array();
	}
}