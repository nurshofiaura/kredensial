<?php
class M_ol_daftar extends CI_model{
	function registrasi_all($id)
	{
	$wordsAry = explode("-", $id);
	$wordsCount = count($wordsAry);
		$fields = "*,DATE_FORMAT(wkt_registrasi,'%d-%m-%Y') as wkt_registrasi
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
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(or.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(or.nip LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(or.no_profesi LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_registrasi or');
		$this->db->join('kol_working ol', 'ol.id_working=or.id_instansi','left');
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(or.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(or.nip LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(or.no_profesi LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
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
				//	case 'telp' : $nmf="peg.telp";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(or.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(or.nip LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(or.no_profesi LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
			}
		  }
		}

		$this->db->from('ol_registrasi or');
		$this->db->join('kol_working ol', 'ol.id_working=or.id_instansi','left');
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(or.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(or.nip LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(or.no_profesi LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('ol_registrasi');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function regissdsdtrasi_all($id,$status_online)
	{
	$wordsAry = explode("-", $id);
	$wordsCount = count($wordsAry);
		$fields = "*,
		DATE_FORMAT(wkt_registrasi,'%d-%m-%Y') as wkt_registrasi
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
				$this->db->where('status_registrasi <', '2');
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(or.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(or.nip LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(or.no_profesi LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_registrasi or');
		$this->db->join('kol_working ol', 'ol.id_working=or.id_instansi','left');
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(or.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(or.nip LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(or.no_profesi LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
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
				//	case 'telp' : $nmf="peg.telp";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where('status_registrasi <', '2');
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(or.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(or.nip LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(or.no_profesi LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
		$this->db->from('ol_registrasi or');
		$this->db->join('kol_working ol', 'ol.id_working=or.id_instansi','left');
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(or.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(or.nip LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(or.no_profesi LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('ol_registrasi');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_barcode_registrasi($kode){
		$no_hp = $this->input->post('no_hp');
		$ptn = "/^0/";
		$rpltxt = "62";  // Replacement string
		$cp = preg_replace($ptn, $rpltxt, $no_hp);
		$data_pendaftaran = array(
			'id_instansi' => $this->input->post('id_instansi'),
			'status_registrasi' => 0,
			'cp' => $cp,
			'barcode_registrasi' => $kode
		);
		return $this->db->insert('ol_registrasi', $data_pendaftaran);
	}
	function edit_barcode_registrasi(){
		$barcode_registrasi = $this->input->post('barcode_registrasi');
		$cp = $this->input->post('cp');
		$ptn = "/^0/";
		$rpltxt = "62";  // Replacement string
		$cp = preg_replace($ptn, $rpltxt, $cp);
		$data_pendaftaran = array(
			'id_instansi' => $this->input->post('id_instansi'),
			'cp' => $cp
		);
		$this->db->where('barcode_registrasi',$barcode_registrasi);
		$this->db->update('ol_registrasi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
		function edit_online_registrasi($id){
		$kode_online = 'ol_registrasi';
		$data_pendaftaran = array(
			'status_online' => $id
		);
		$this->db->where('kode_online',$kode_online);
		$this->db->update('a_online', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function simpan_aktifasi(){
		$barcode_registrasi = $this->input->post('barcode_registrasi');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$tgl_lahir = date('Y-m-d', strtotime($tgl_lahir));
		$username= $this->input->post('username');
		$username = strtolower($username);
		$username = str_replace(' ', '-', $username);
		$username = preg_replace('/[^A-Za-z0-9\-]/', '', $username);
		$password = hash("sha512", md5('7654321'));		
		$status_perawat = $this->input->post('status_perawat');		
		if($status_perawat == 0){
			$id_kode_kewenangan = '0';
		}else{
			$id_kode_kewenangan = $this->input->post('id_kode_kewenangan');
		}
		$kode = $this->m_rancak->kode_generator(15,'');
		$data_pendaftaran = array(
			'barcode_pegawai' => $kode,
			'username' => $username,
			'password' => $password,			
			'nama_pegawai' => $this->input->post('nama_pegawai'),
			'jk' => $this->input->post('jk'),
			'tmp_lahir' => $this->input->post('tmp_lahir'),
			'tgl_lahir' => $tgl_lahir,
			'email' => $this->input->post('email'),
			'no_hp' => $this->input->post('no_hp'),
			'nik' => $this->input->post('nik'),
			'nip' => $this->input->post('nip'),
			'id_prov' => $this->input->post('id_prov'),
			'id_kab' => $this->input->post('id_kab'),
			'id_kec' => $this->input->post('id_kec'),
			'id_kel' => $this->input->post('id_kel'),
			'no_profesi' => $this->input->post('no_profesi'),
			'id_status_kawin' => $this->input->post('id_status_kawin'),
			'id_pengcab' => $this->input->post('id_pengcab'),
			'id_agama' => $this->input->post('id_agama'),
			'id_pendidikan' => $this->input->post('id_pendidikan'),
			'tipe_pegawai' => $this->input->post('tipe_pegawai'),
			'id_jabatan_fungsional' => $this->input->post('id_jabatan_fungsional'),
			'alamat' => $this->input->post('alamat'),
			'id_kode_kewenangan' => $id_kode_kewenangan,
			'status_perawat' => $status_perawat,
			'status_pegawai' =>1,
			'foto' =>''
		);
		$this->db->insert('ol_pegawai', $data_pendaftaran);
		return $this->db->insert_id();
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
	function simpan_user($id){
		$kode = $this->m_rancak->kode_generator(15,'');
		$data_pendaftaran = array(
			'id_pegawai' => $id,
			'barcode_user' => $kode,
			'id_level' => $this->input->post('id_level')
		);
		return $this->db->insert('ol_user', $data_pendaftaran);
	}
	function edit_status_registrasi(){
		$barcode_registrasi = $this->input->post('barcode_registrasi');
		$data_pendaftaran = array(
			'status_registrasi' => 2,
			'wkt_aktifasi' => date('Y-m-d H:i:s')
		);
		$this->db->where('barcode_registrasi',$barcode_registrasi);
		$this->db->update('ol_registrasi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function member_all($id)
	{
	$wordsAry = explode("-", $id);
	$wordsCount = count($wordsAry);
		$fields = "*,if(status_perawat = 0,'Non Keperawatan',nama_kode_kewenangan) as nama_kode_kewenangan,
					if (jk = '1' ,'Laki-laki','Perempuan') as jk,
					if (status_pegawai = '1' ,'AKTIF','NON AKTIF') as status_pegawai,
					CONCAT(tmp_lahir,' - ',DATE_FORMAT(tgl_lahir,'%d-%m-%Y'),' / ',(TIMESTAMPDIFF( YEAR, tgl_lahir, now() )), ' Tahun ',
					TIMESTAMPDIFF( MONTH, tgl_lahir, now() ) % 12, ' Bulan ',
					FLOOR( TIMESTAMPDIFF( DAY, tgl_lahir, now() ) % 30.4375 ), ' Hari') as umur
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
				$this->db->where('visible', '1');
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(op.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(op.nip LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(op.no_profesi LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_pegawai op');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=op.id_status_kawin','left');
		$this->db->join('kol_agama kag', 'kag.id_agama=op.id_agama','left');
		$this->db->join('kol_pendidikan kp', 'kp.id_pendidikan=op.id_pendidikan','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=op.id_jabatan_fungsional','left');
		$this->db->join('ol_status_pegawai osp', 'osp.id_status_pegawai=op.tipe_pegawai','left');
		$this->db->join('kol_kode_kewenangan kkk', 'kkk.id_kode_kewenangan=op.id_kode_kewenangan','left');
		$this->db->where('visible', '1');
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(op.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(op.nip LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(op.no_profesi LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
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
				//	case 'telp' : $nmf="peg.telp";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where('visible', '1');
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(op.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(op.nip LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(op.no_profesi LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
			}
		  }
		}

		$this->db->from('ol_pegawai op');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=op.id_status_kawin','left');
		$this->db->join('kol_agama kag', 'kag.id_agama=op.id_agama','left');
		$this->db->join('kol_pendidikan kp', 'kp.id_pendidikan=op.id_pendidikan','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=op.id_jabatan_fungsional','left');
		$this->db->join('ol_status_pegawai osp', 'osp.id_status_pegawai=op.tipe_pegawai','left');
		$this->db->join('kol_kode_kewenangan kkk', 'kkk.id_kode_kewenangan=op.id_kode_kewenangan','left');
		$this->db->where('visible', '1');
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(op.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(op.nip LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(op.no_profesi LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('ol_pegawai');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function edit_pegawai(){
		$barcode_pegawai = $this->input->post('barcode_pegawai');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$tgl_lahir = date('Y-m-d', strtotime($tgl_lahir));
		$status_perawat = $this->input->post('status_perawat');
		if($status_perawat == 0){
			$id_kode_kewenangan = '0';
		}else{
			$id_kode_kewenangan = $this->input->post('id_kode_kewenangan');
		}
		$data_pendaftaran = array(
			'nama_pegawai' => $this->input->post('nama_pegawai'),
			'jk' => $this->input->post('jk'),
			'tmp_lahir' => $this->input->post('tmp_lahir'),
			'tgl_lahir' => $tgl_lahir,
			'email' => $this->input->post('email'),
			'no_hp' => $this->input->post('no_hp'),
			'nik' => $this->input->post('nik'),
			'nip' => $this->input->post('nip'),
			'no_profesi' => $this->input->post('no_profesi'),
			'id_pengcab' => $this->input->post('id_pengcab'),
			'id_status_kawin' => $this->input->post('id_status_kawin'),
			'id_agama' => $this->input->post('id_agama'),
			'id_pendidikan' => $this->input->post('id_pendidikan'),
			'tipe_pegawai' => $this->input->post('tipe_pegawai'),
			'id_jabatan_fungsional' => $this->input->post('id_jabatan_fungsional'),
			'alamat' => $this->input->post('alamat'),
			'id_kode_kewenangan' => $id_kode_kewenangan,
			'status_perawat' => $status_perawat,
			'status_pegawai' =>$this->input->post('status_pegawai'),
		);
		$this->db->where('barcode_pegawai',$barcode_pegawai);
		$this->db->update('ol_pegawai', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function simpan_login(){
		$id_level = $this->input->post('id_level');
		$id_pegawai = $this->input->post('id_pegawai');
		$kondisi=array('id_level'=>$id_level,'id_pegawai'=>$id_pegawai);
		$jml = $this->m_umum->jumlah_record_filter('ol_user',$kondisi);
		$kode = $this->m_rancak->kode_generator(15,'');
		if($jml == 0){
			$data_pendaftaran = array(
				'id_pegawai' => $id,
				'id_level' => $id_level,
				'barcode_user' => $kode,
				'status_user' =>1
			);
			return $this->db->insert('ol_user', $data_pendaftaran);
		}
	}
	function edit_member(){
		$id_level = $this->input->post('id_level');
		$id_pegawai = $this->input->post('id_pegawai');
		$data_pendaftaran = array(
			'id_level' => $id_level
		);
		$this->db->where('id_pegawai',$id_pegawai);
		$this->db->where('id_level','51');
		$this->db->update('ol_user', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function edit_level(){
		$id_level = $this->input->post('id_level');
		$id_user = $this->input->post('id_user');
		$status_user = $this->input->post('status_user');
		$data_pendaftaran = array(
			'id_level' => $id_level,
			'status_user' => $status_user
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
	function reset_password($id){
		$password = hash("sha512", md5("7654321"));
		$data_pendaftaran = array(
			'password' => $password
		);
		$this->db->where('id_pegawai',$id);
		$this->db->update('ol_pegawai', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function user_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*
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
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_user os');
		$this->db->join('ol_pegawai op', 'op.id_pegawai=os.id_pegawai','left');
		$this->db->join('user_level us', 'us.id_level=os.id_level','left');

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

		$this->db->from('ol_user os');
		$this->db->join('ol_pegawai op', 'op.id_pegawai=os.id_pegawai','left');
		$this->db->join('user_level us', 'us.id_level=os.id_level','left');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('ol_user');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function hak_akses_all($id)
	{
	//	$ids = explode(',', $akses);
	//--------- Ambil nama kolom --------- [coding here] .jpg
	$fields = "*
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
				$this->db->where('barcode_pegawai',$id);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	$this->db->from('ol_akses pak');
	$this->db->join('akses ak','ak.id_akses=pak.id_akses','left');
	$this->db->join('ol_pegawai peg','peg.id_pegawai=pak.id_pegawai','left');
	$this->db->where('barcode_pegawai',$id);

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
				$this->db->where('barcode_pegawai',$id);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	$this->db->from('ol_akses pak');
	$this->db->join('akses ak','ak.id_akses=pak.id_akses','left');
	$this->db->join('ol_pegawai peg','peg.id_pegawai=pak.id_pegawai','left');
	$this->db->where('barcode_pegawai',$id);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----

	 		$kondisi=array('barcode_pegawai'=>$id);
			$jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_akses',$kondisi,'ol_pegawai','id_pegawai');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
	//	 print_r($output);die();
		return $output;
	}
	function unit_all($id)
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*
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
				if($id > 0){
				$this->db->where('id_instansi',$id); }
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_unit ou');
		$this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
				if($id > 0){
				$this->db->where('id_instansi',$id); }

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
				if($id > 0){
				$this->db->where('id_instansi',$id); }
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
		$this->db->from('ol_unit ou');
		$this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
				if($id > 0){
				$this->db->where('id_instansi',$id); }

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
			'id_instansi' => $this->input->post('id_instansi'),
			'nama_unit' => $this->input->post('nama_unit'),
			'status_unit' => $this->input->post('status_unit')
		);
		return $this->db->insert('ol_unit', $data_pendaftaran);
	}
	function edit_ol_unit(){
		$id_unit = $this->input->post('id_unit');
		$data_pendaftaran = array(
			'id_instansi' => $this->input->post('id_instansi'),
			'nama_unit' => $this->input->post('nama_unit'),
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
	function work_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*
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

			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('kol_working');
		$this->db->join('kol_kategori_work', 'kol_kategori_work.id_kategori_work=kol_working.id_cara_masuk','left');

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
		$this->db->from('kol_working');
		$this->db->join('kol_kategori_work', 'kol_kategori_work.id_kategori_work=kol_working.id_cara_masuk','left');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('kol_working');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_ol_instansi(){
		$kode = $this->m_rancak->kode_generator(15,'');
		$data_pendaftaran = array(	
			'barcode_working' => $kode,
			'nama_working' => $this->input->post('nama_working'),
			'alamat_working' => $this->input->post('alamat_working'),
			'email_working' => $this->input->post('email_working'),
			'kontak_working' => $this->input->post('kontak_working'),
			'id_cara_masuk' => $this->input->post('id_cara_masuk'),
			'id_prov' => $this->input->post('id_prov'),
			'id_kab' => $this->input->post('id_kab'),
			'id_kec' => $this->input->post('id_kec'),
			'id_kel' => $this->input->post('id_kel')
		);
		$this->db->insert('kol_working', $data_pendaftaran);
		return $this->db->insert_id();
	}
	function edit_ol_instansi(){
		$id_working = $this->input->post('id_working');
		$data_pendaftaran = array(
			'nama_working' => $this->input->post('nama_working'),
			'alamat_working' => $this->input->post('alamat_working'),
			'email_working' => $this->input->post('email_working'),
			'kontak_working' => $this->input->post('kontak_working'),
			'id_cara_masuk' => $this->input->post('id_cara_masuk'),
			'id_prov' => $this->input->post('id_prov'),
			'id_kab' => $this->input->post('id_kab'),
			'id_kec' => $this->input->post('id_kec'),
			'id_kel' => $this->input->post('id_kel')
		);
		$this->db->where('id_working',$id_working);
		$this->db->update('kol_working', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function working_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*
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
				$this->db->where('jabatan_fungsional.id_jabatan',$this->session->id_jabatan);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_pegawai_instansi');
		$this->db->join('kol_working', 'kol_working.id_working=ol_pegawai_instansi.id_instansi','left');
		$this->db->join('kol_kategori_work', 'kol_kategori_work.id_kategori_work=kol_working.id_cara_masuk','left');
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_pegawai_instansi.id_pegawai','left');
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pegawai.id_pengcab','left');
		$this->db->where('jabatan_fungsional.id_jabatan',$this->session->id_jabatan);

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
				$this->db->where('jabatan_fungsional.id_jabatan',$this->session->id_jabatan);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
		$this->db->from('ol_pegawai_instansi');
		$this->db->join('kol_working', 'kol_working.id_working=ol_pegawai_instansi.id_instansi','left');
		$this->db->join('kol_kategori_work', 'kol_kategori_work.id_kategori_work=kol_working.id_cara_masuk','left');
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_pegawai_instansi.id_pegawai','left');
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
		$this->db->where('id_jabatan',$this->session->id_jabatan);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('ol_pegawai_instansi');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function status_pegawai_all($id)
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*
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
		if($id == 0){
			$this->db->where("kunci", 0);
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_status_pegawai or');
		if($id == 0){
			$this->db->where("kunci", 0);
		}

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
		if($id == 0){
			$this->db->where("kunci", 0);
		}
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
		$this->db->from('ol_status_pegawai or');
		if($id == 0){
			$this->db->where("kunci", 0);
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		if($id == 0){
	 		$kondisi=array('kunci'=>0);
			$jml = $this->m_umum->jumlah_record_filter('ol_status_pegawai',$kondisi);
		}else{
			$jml = $this->m_umum->jumlah_record_tabel('ol_status_pegawai');	
		}
		

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_status_pegawai(){
		$kode = $this->m_rancak->kode_generator(15,'');
		$data_pendaftaran = array(
			'nama_status_pegawai' => $this->input->post('nama_status_pegawai'),
			'status' => $this->input->post('status')
		);
		$this->db->insert('ol_status_pegawai', $data_pendaftaran);
		return $this->db->insert_id();
	}
	function edit_status_pegawai(){
		$id_status_pegawai = $this->input->post('id_status_pegawai');
		$data_pendaftaran = array(
			'nama_status_pegawai' => $this->input->post('nama_status_pegawai'),
			'status' => $this->input->post('status')
		);
		$this->db->where('id_status_pegawai',$id_status_pegawai);
		$this->db->update('ol_status_pegawai', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function pengurus_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "if(op.id_cabang = '','PARENT',ope.nama_pengcab) as cabang,op.id_pengcab,op.nama_pengcab,kk.nama_kab,op.alamat_pengcab,op.kontak_pengcab,op.email_pengcab,op.kop_pengcab,op.stempel_pengcab,op.barcode_pengcab,concat(op.alamat_pengcab,' ',op.kontak_pengcab,' ',nama_kab,' ',nama_prov,' ',op.email_pengcab) as alamat_pengcab
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
					 case 'nama_pengcab' : $nmf="op.nama_pengcab";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){
				$this->db->where("op.id_jabatan", $this->session->id_jabatan); 
			}
		}
	//	if ((98 <= $this->session->id_level) && ($this->session->id_level <= 99)){
/*		if ((98 <= $this->session->id_level) && ($this->session->id_level <= 99)){
			$this->db->where("op.id_jabatan", $this->session->id_jabatan); 
		}*/
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_pengcab op');
		$this->db->join('kol_provinsi kp', 'kp.id_prov=op.id_prov','left');
		$this->db->join('kol_kabupaten kk', 'kk.id_kab=op.id_kab','left');
		$this->db->join('ol_pengcab ope', 'ope.id_pengcab=op.id_cabang','left');
		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){
				$this->db->where("op.id_jabatan", $this->session->id_jabatan); 
			}
		}

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
					case 'nama_pengcab' : $nmf="op.nama_pengcab";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){
				$this->db->where("op.id_jabatan", $this->session->id_jabatan); 
			}
		}
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
		$this->db->from('ol_pengcab op');
		$this->db->join('kol_provinsi kp', 'kp.id_prov=op.id_prov','left');
		$this->db->join('kol_kabupaten kk', 'kk.id_kab=op.id_kab','left');
		$this->db->join('ol_pengcab ope', 'ope.id_pengcab=op.id_cabang','left');
		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){
				$this->db->where("op.id_jabatan", $this->session->id_jabatan); 
			}
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
//		if($id == 0){
	 		$kondisi=array('id_jabatan'=>$this->session->id_jabatan);
			$jml = $this->m_umum->jumlah_record_filter('ol_pengcab',$kondisi);
/*		}else{
			$jml = $this->m_umum->jumlah_record_tabel('ol_status_pegawai');	
		}*/
		

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_ol_pengcab($id){
		$kode = $this->m_rancak->kode_generator(15,'');
		if(empty($id)){
			$data_kewenangan = array(
			'id_cabang' => $this->input->post('id_cabang'),
			'nama_pengcab' => $this->input->post('nama_pengcab'),
			'email_pengcab' => $this->input->post('email_pengcab'),
			'kontak_pengcab' => $this->input->post('kontak_pengcab'),
			'alamat_pengcab' => $this->input->post('alamat_pengcab'),
			'id_prov' => $this->input->post('id_prov'),
			'id_kab' => $this->input->post('id_kab'),
			'id_jabatan' => $this->input->post('id_jabatan'),
			'barcode_pengcab' => $kode

			);
		}else{
			$data_kewenangan = array(
			'id_cabang' => $this->input->post('id_cabang'),
			'nama_pengcab' => $this->input->post('nama_pengcab'),
			'email_pengcab' => $this->input->post('email_pengcab'),
			'kontak_pengcab' => $this->input->post('kontak_pengcab'),
			'alamat_pengcab' => $this->input->post('alamat_pengcab'),
			'id_prov' => $this->input->post('id_prov'),
			'id_kab' => $this->input->post('id_kab'),
			'id_jabatan' => $this->input->post('id_jabatan'),
			'barcode_pengcab' => $kode,
			'kop_pengcab' => $id

			);
		}
		return $this->db->insert('ol_pengcab', $data_kewenangan);
	}
	function edit_ol_pengcab($id){
		$id_pengcab = $this->input->post('id_pengcab');
		if(empty($id)){
			$data_pendaftaran = array(
			'id_cabang' => $this->input->post('id_cabang'),
			'nama_pengcab' => $this->input->post('nama_pengcab'),
			'email_pengcab' => $this->input->post('email_pengcab'),
			'kontak_pengcab' => $this->input->post('kontak_pengcab'),
			'alamat_pengcab' => $this->input->post('alamat_pengcab'),
			'id_prov' => $this->input->post('id_prov'),
			'id_kab' => $this->input->post('id_kab')
			);
		}else{
			$user_pic=$this->m_umum->ambil_data('ol_pengcab','id_pengcab',$id_pengcab);
			if(!empty($user_pic['kop_pengcab'])){
				$cek_file=FCPATH.'assets/berkas/kop/'.$user_pic['kop_pengcab'];
				if(file_exists($cek_file)){
					unlink(FCPATH."assets/berkas/kop/".$user_pic['kop_pengcab']);
				}
			}
			$data_pendaftaran = array(
			'id_cabang' => $this->input->post('id_cabang'),
			'nama_pengcab' => $this->input->post('nama_pengcab'),
			'email_pengcab' => $this->input->post('email_pengcab'),
			'kontak_pengcab' => $this->input->post('kontak_pengcab'),
			'alamat_pengcab' => $this->input->post('alamat_pengcab'),
			'id_prov' => $this->input->post('id_prov'),
			'id_kab' => $this->input->post('id_kab'),
			'kop_pengcab' => $id
			);
		}
		$this->db->where('id_pengcab',$id_pengcab);
		$this->db->update('ol_pengcab', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function edit_stempel_pengcab($id){
		$id_pengcab = $this->input->post('id_pengcab');
		if(empty($id)){
			$data_pendaftaran = array(
			'id_cabang' => $this->input->post('id_cabang'),
			'nama_pengcab' => $this->input->post('nama_pengcab'),
			'email_pengcab' => $this->input->post('email_pengcab'),
			'kontak_pengcab' => $this->input->post('kontak_pengcab'),
			'alamat_pengcab' => $this->input->post('alamat_pengcab'),
			'id_prov' => $this->input->post('id_prov'),
			'id_kab' => $this->input->post('id_kab')
			);
		}else{
			$user_pic=$this->m_umum->ambil_data('ol_pengcab','id_pengcab',$id_pengcab);
			if(!empty($user_pic['stempel_pengcab'])){
				$cek_file=FCPATH.'assets/berkas/kop/'.$user_pic['stempel_pengcab'];
				if(file_exists($cek_file)){
					unlink(FCPATH."assets/berkas/kop/".$user_pic['stempel_pengcab']);
				}
			}
			$data_pendaftaran = array(
			'id_cabang' => $this->input->post('id_cabang'),
			'nama_pengcab' => $this->input->post('nama_pengcab'),
			'email_pengcab' => $this->input->post('email_pengcab'),
			'kontak_pengcab' => $this->input->post('kontak_pengcab'),
			'alamat_pengcab' => $this->input->post('alamat_pengcab'),
			'id_prov' => $this->input->post('id_prov'),
			'id_kab' => $this->input->post('id_kab'),
			'stempel_pengcab' => $id
			);
		}
		$this->db->where('id_pengcab',$id_pengcab);
		$this->db->update('ol_pengcab', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function kat_work_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*
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
	
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('kol_kategori_work');

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
		$this->db->from('kol_kategori_work');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
	//	if($id == 0){
	 //		$kondisi=array('visible'=>1);
	//		$jml = $this->m_umum->jumlah_record_filter('kol_kategori_work',$kondisi);
	//	}else{
			$jml = $this->m_umum->jumlah_record_tabel('kol_kategori_work');	
	//	}
		

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_kategori_work(){
		$data_pendaftaran = array(
			'nama_kategori_work' => $this->input->post('nama_kategori_work'),
			'status_kategori_work' => $this->input->post('status_kategori_work')
		);
		$this->db->insert('kol_kategori_work', $data_pendaftaran);
		return $this->db->insert_id();
	}
	function edit_kategori_work(){
		$id_kategori_work = $this->input->post('id_kategori_work');
		$data_pendaftaran = array(
			'nama_kategori_work' => $this->input->post('nama_kategori_work'),
			'status_kategori_work' => $this->input->post('status_kategori_work')
		);
		$this->db->where('id_kategori_work',$id_kategori_work);
		$this->db->update('kol_kategori_work', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function jabatan_pengurus_all($id)
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*
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
		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){
				$this->db->where("id_jabatan", $this->session->id_jabatan); 
				$this->db->or_where("kunci", 1); 
			}
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('kol_ms_pengurus');
		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){
				$this->db->where("id_jabatan", $this->session->id_jabatan); 
				$this->db->or_where("kunci", 1); 
			}
		}

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
		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){
				$this->db->where("id_jabatan", $this->session->id_jabatan); 
				$this->db->or_where("kunci", 1); 
			}
		}
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
		$this->db->from('kol_ms_pengurus');
		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){
				$this->db->where("id_jabatan", $this->session->id_jabatan); 
				$this->db->or_where("kunci", 1); 
			}
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
	//	if($id == 0){
	 		$kondisi=array('id_jabatan'=>$this->session->id_jabatan);
			$jml = $this->m_umum->jumlah_record_filter('kol_ms_pengurus',$kondisi);
/*		}else{
			$jml = $this->m_umum->jumlah_record_tabel('ol_status_pegawai');	
		}*/
		

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_ms_pengurus(){
		$kode = $this->m_rancak->kode_generator(15,'');
		$data_pendaftaran = array(
			'id_prov' => $this->input->post('id_prov'),
			'nama_ms_pengurus' => $this->input->post('nama_ms_pengurus'),
			'id_jabatan' => $this->session->id_jabatan,
			'status_ms_pengurus' => $this->input->post('status_ms_pengurus')
		);
		$this->db->insert('kol_ms_pengurus', $data_pendaftaran);
		return $this->db->insert_id();
	}
	function edit_ms_pengurus(){
		$id_ms_pengurus = $this->input->post('id_ms_pengurus');
		$data_pendaftaran = array(
			'nama_ms_pengurus' => $this->input->post('nama_ms_pengurus'),
			'status_ms_pengurus' => $this->input->post('status_ms_pengurus')
		);
		$this->db->where('id_ms_pengurus',$id_ms_pengurus);
		$this->db->update('kol_ms_pengurus', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function edit_pegawai_instansi(){
		$id_pegawai_instansi = $this->input->post('id_pegawai_instansi');
		$data_pendaftaran = array(
			'id_instansi' => $this->input->post('id_instansi'),
			'status_pegawai_instansi' => $this->input->post('status_pegawai_instansi')
		);
		$this->db->where('id_pegawai_instansi',$id_pegawai_instansi);
		$this->db->update('ol_pegawai_instansi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function pengurusan_all($id)
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*
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
				//	 case 'nama_pengcab' : $nmf="op.nama_pengcab";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){
				$this->db->where("ope.id_jabatan", $this->session->id_jabatan); 
			}
		}
				if($id > 0){
					$this->db->where("op.id_pengcab", $id);
				}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_pengurus op');
		$this->db->join('ol_pengcab ope', 'ope.id_pengcab=op.id_pengcab','left');
		$this->db->join('kol_ms_pengurus kmp', 'kmp.id_ms_pengurus=op.id_ms_pengurus','left');
		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){
				$this->db->where("ope.id_jabatan", $this->session->id_jabatan); 
			}
		}
		if($id > 0){
			$this->db->where("op.id_pengcab", $id);
		}
		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'nama_pengcab' : $nmf="op.nama_pengcab";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){
				$this->db->where("ope.id_jabatan", $this->session->id_jabatan); 
			}
		}
				if($id > 0){
					$this->db->where("op.id_pengcab", $id);
				}

			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
		$this->db->from('ol_pengurus op');
		$this->db->join('ol_pengcab ope', 'ope.id_pengcab=op.id_pengcab','left');
		$this->db->join('kol_ms_pengurus kmp', 'kmp.id_ms_pengurus=op.id_ms_pengurus','left');
		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){
				$this->db->where("ope.id_jabatan", $this->session->id_jabatan); 
			}
		}
		if($id > 0){
			$this->db->where("op.id_pengcab", $id);
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
//		if($id == 0){
	 		$kondisi=array('id_jabatan'=>$this->session->id_jabatan);
		//	$jml = $this->m_umum->jumlah_record_filter('ol_pengurus',$kondisi);
			$jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_pengurus',$kondisi,'ol_pengcab','id_pengcab');
/*		}else{
			$jml = $this->m_umum->jumlah_record_tabel('ol_status_pegawai');	
		}*/
		

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_ol_pengurus(){
		$chk = $this->input->post('chk[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				$this->db->select("COUNT(*) as num");
				$this->db->where('id_pengcab', $chk[$i]);
				$this->db->where('id_ms_pengurus',$this->input->post('id_ms_pengurus'));
			//	$this->db->where('status_pengurus',1);
				$q = $this->db->get('ol_pengurus')->row();
				$jml = $q->num;
				if($jml == 0){
					$kode = $this->m_rancak->kode_generator(15,'');
					$data_pendaftaran = array(
						'id_pengcab' => $chk[$i],
						'barcode_pengurus' => $kode,
						'id_ms_pengurus' =>  $this->input->post('id_ms_pengurus')
					);
					$this->db->insert('ol_pengurus', $data_pendaftaran);
				}
			}
		}
	}
	function edit_ol_pengurus(){
		$id_pengurus = $this->input->post('id_pengurus');
		$data_kewenangan_detil = array(
			'id_ms_pengurus' => $this->input->post('id_ms_pengurus'),
			'status_pengurus' => $this->input->post('status_pengurus')
		);
		$this->db->where('id_pengurus',$id_pengurus);
		$this->db->update('ol_pengurus', $data_kewenangan_detil);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function pegawai_pengurus_all($id)
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "op.nama_pegawai,kmp.nama_ms_pengurus,ope.nama_pengcab,op.ttd_pegawai,opp.status_pegawai_pengurus,opp.id_pegawai_pengurus, opp.barcode_pegawai_pengurus,op.barcode_pegawai
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
				//	 case 'nama_pengcab' : $nmf="op.nama_pengcab";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){
				$this->db->where("ope.id_jabatan", $this->session->id_jabatan); 
			}
		}
		if($id > 0){
		$this->db->where("ope.id_pengcab", $id);
		}
		$this->db->where("kmp.status_ms_pengurus", 1);
//		$this->db->where("opp.status_pegawai_pengurus", 1);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_pegawai_pengurus opp');
		$this->db->join('ol_pegawai op', 'op.id_pegawai=opp.id_pegawai','left');
		$this->db->join('ol_pengurus opg', 'opg.id_pengurus=opp.id_pengurus','left');
		$this->db->join('ol_pengcab ope', 'ope.id_pengcab=opg.id_pengcab','left');
		$this->db->join('kol_ms_pengurus kmp', 'kmp.id_ms_pengurus=opg.id_ms_pengurus','left');
		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){
				$this->db->where("ope.id_jabatan", $this->session->id_jabatan); 
			}
		}
		if($id > 0){
		$this->db->where("ope.id_pengcab", $id);
		}
		$this->db->where("kmp.status_ms_pengurus", 1);
//		$this->db->where("opp.status_pegawai_pengurus", 1);

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'nama_pengcab' : $nmf="op.nama_pengcab";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){
				$this->db->where("ope.id_jabatan", $this->session->id_jabatan); 
			}
		}
		if($id > 0){
		$this->db->where("ope.id_pengcab", $id);
		}
		$this->db->where("kmp.status_ms_pengurus", 1);
//		$this->db->where("opp.status_pegawai_pengurus", 1);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
		$this->db->from('ol_pegawai_pengurus opp');
		$this->db->join('ol_pegawai op', 'op.id_pegawai=opp.id_pegawai','left');
		$this->db->join('ol_pengurus opg', 'opg.id_pengurus=opp.id_pengurus','left');
		$this->db->join('ol_pengcab ope', 'ope.id_pengcab=opg.id_pengcab','left');
		$this->db->join('kol_ms_pengurus kmp', 'kmp.id_ms_pengurus=opg.id_ms_pengurus','left');
		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){
				$this->db->where("ope.id_jabatan", $this->session->id_jabatan); 
			}
		}
		if($id > 0){
		$this->db->where("ope.id_pengcab", $id);
		}
		$this->db->where("kmp.status_ms_pengurus", 1);
//		$this->db->where("opp.status_pegawai_pengurus", 1);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
//		if($id == 0){
	 	//	$kondisi=array('id_jabatan'=>$this->session->id_jabatan);
			$jml = $this->jumlah_pegawai_pengurus_all($id);
/*		}else{
			$jml = $this->m_umum->jumlah_record_tabel('ol_status_pegawai');	
		}*/
		

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
    function jumlah_pegawai_pengurus_all($id)    //igd.php untuk menampilkan jumlah antrian di igd saja
    {
		$this->db->join('ol_pegawai op', 'op.id_pegawai=opp.id_pegawai','left');
		$this->db->join('ol_pengurus opg', 'opg.id_pengurus=opp.id_pengurus','left');
		$this->db->join('ol_pengcab ope', 'ope.id_pengcab=opg.id_pengcab','left');
		$this->db->join('kol_ms_pengurus kmp', 'kmp.id_ms_pengurus=opg.id_ms_pengurus','left');
		$this->db->where("ope.id_jabatan", $this->session->id_jabatan);
		$this->db->where("ope.id_pengcab", $id);
		$this->db->where("kmp.status_ms_pengurus", 1);
		$this->db->where("opp.status_pegawai_pengurus", 1);
        $query = $this->db->select("COUNT(*) as num")->get_where('ol_pegawai_pengurus opp');
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
    }
	function simpan_ol_pegawai_pengurus($id){
		$kode = $this->m_rancak->kode_generator(15,'');
	//		if(empty($id)){
				$data_kewenangan = array(
				'id_pegawai' => $this->input->post('id_pegawai'),
				'id_pengurus' => $this->input->post('id_pengurus'),
				'barcode_pegawai_pengurus' => $kode
				);
/*			}else{
				$data_kewenangan = array(
				'id_pegawai' => $this->input->post('id_pegawai'),
				'id_pengurus' => $this->input->post('id_pengurus'),
				'barcode_pegawai_pengurus' => $kode,
				'ttd_pegawai_pengurus' => $id
				);
			}*/
		return $this->db->insert('ol_pegawai_pengurus', $data_kewenangan);
	}
	function edit_ol_pegawai($gbr,$id){
		$id_pegawai = $this->input->post('id_pegawai');
		$user_pic=$this->m_umum->ambil_data('ol_pegawai','id_pegawai',$id_pegawai);
		if(!empty($user_pic['ttd_pegawai'])){
			$cek_file=FCPATH.'assets/berkas/kop/'.$user_pic['ttd_pegawai'];
			if(file_exists($cek_file)){
				unlink(FCPATH."assets/berkas/kop/".$user_pic['ttd_pegawai']);
			}
		}
		$data_pendaftaran = array(
		'ttd_pegawai' => $gbr
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
	function edit_pegawai_pengurus(){
		$id_pegawai_pengurus = $this->input->post('id_pegawai_pengurus');
		$data_pendaftaran = array(
		'status_pegawai_pengurus' => $this->input->post('status_pegawai_pengurus')
		);
		$this->db->where('id_pegawai_pengurus',$id_pegawai_pengurus);
		$this->db->update('ol_pegawai_pengurus', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function simpan_pegawai_akses(){
		$id_pegawai = $this->input->post('id_pegawai');
		$chk = $this->input->post('chk[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				$this->db->select("COUNT(*) as num");
				$this->db->where('id_pegawai',$id_pegawai);
				$this->db->where('id_akses',$chk[$i]);
				$q = $this->db->get('ol_akses')->row();
				$jml = $q->num;
				if($jml == 0){
					$data_pendaftaran = array(
						'id_akses' => $chk[$i],
						'id_pegawai' => $id_pegawai,
						'status_ol_akses' => 1
					);
					$this->db->insert('ol_akses', $data_pendaftaran);
				}
			}
		}
	}
	function status_pegawai_akses($int,$id){
		$data_pendaftaran = array(
			'status_ol_akses' => $int
		);
		$this->db->where('id_ol_akses',$id);
		$this->db->update('ol_akses', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function kategori_surat_all($id)
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*
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
				//	 case 'nama_pengcab' : $nmf="op.nama_pengcab";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){
				$this->db->where("ol_surat_kategori.id_jabatan", $id); 
				$this->db->or_where("ol_surat_kategori.id_jabatan", 0);
			}
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_surat_kategori');
		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){
				$this->db->where("ol_surat_kategori.id_jabatan", $id);
				$this->db->or_where("ol_surat_kategori.id_jabatan", 0); 
			}
		}

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'nama_pengcab' : $nmf="op.nama_pengcab";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){
				$this->db->where("ol_surat_kategori.id_jabatan", $id); 
				$this->db->or_where("ol_surat_kategori.id_jabatan", 0); 
			}
		}
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
		$this->db->from('ol_surat_kategori');
		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){
				$this->db->where("ol_surat_kategori.id_jabatan", $id); 
				$this->db->or_where("ol_surat_kategori.id_jabatan", 0); 
			}
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
//		if($id == 0){
	 	//	$kondisi=array('id_jabatan'=>$this->session->id_jabatan);
		//	$jml = $this->jumlah_record_filter('ol_surat_detil',$kondisi);
/*		}else{
			$jml = $this->m_umum->jumlah_record_tabel('ol_status_pegawai');	
		}*/
		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){
		 		$kondisi=array('id_jabatan'=>$this->session->id_jabatan);
				$jml = $this->m_umum->jumlah_record_filter('ol_surat_kategori',$kondisi);
			}else{
				$jml = $this->m_umum->jumlah_record_tabel('ol_surat_kategori');
			}
		}else{
			$jml = $this->m_umum->jumlah_record_tabel('ol_surat_kategori');
		}		

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_kategori_surat(){
		$kode = $this->m_rancak->kode_generator(15,'');
		$data_pendaftaran = array(
			'barcode_kategori' => $kode,
			'id_jabatan' => $this->session->id_jabatan,
			'nama_kategori' => $this->input->post('nama_kategori'),
			'status_kategori' => $this->input->post('status_kategori')
		);
		return$this->db->insert('ol_surat_kategori', $data_pendaftaran);
	}
	function edit_kategori_surat(){
		$id_kategori = $this->input->post('id_kategori');
		$data_kewenangan_detil = array(
			'nama_kategori' => $this->input->post('nama_kategori'),
			'syarat_kategori' => $this->input->post('syarat_kategori'),
			'status_kategori' => $this->input->post('status_kategori')
		);
		$this->db->where('id_kategori',$id_kategori);
		$this->db->update('ol_surat_kategori', $data_kewenangan_detil);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function edit_kategori_surat_kunci(){
		$id_kategori = $this->input->post('id_kategori');
		$data_kewenangan_detil = array(
			'syarat_kategori' => $this->input->post('syarat_kategori'),
			'status_kategori' => $this->input->post('status_kategori')
		);
		$this->db->where('id_kategori',$id_kategori);
		$this->db->update('ol_surat_kategori', $data_kewenangan_detil);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function simpan_surat_format(){
		$kode = $this->m_rancak->kode_generator(15,'');
		$data_pendaftaran = array(
			'barcode_format' => $kode,
			'id_jabatan' => $this->session->id_jabatan,
			'id_kategori' => $this->input->post('id_kategori'),
			'isi_format' => $this->input->post('isi_format')
		);
		return$this->db->insert('ol_surat_format', $data_pendaftaran);
	}
	function edit_surat_format(){
		$id_kategori = $this->input->post('id_kategori');
		$data_kewenangan_detil = array(
			'isi_format' => $this->input->post('isi_format')
		);
		$this->db->where('id_kategori',$id_kategori);
		$this->db->update('ol_surat_format', $data_kewenangan_detil);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function surat_pengajuan_all($id)
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,if(wkt_korespodensi = '' ,'Belum Ada Tanggal',DATE_FORMAT(wkt_korespodensi,'%d-%m-%Y')) as wkt_korespodensi
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
				//	 case 'nama_pengcab' : $nmf="op.nama_pengcab";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
		if($id > 0){
			$this->db->where("ok.id_pengirim", $id);
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_korespodensi ok');
		$this->db->join('ol_surat_kategori', 'ol_surat_kategori.id_kategori=ok.id_kategori','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ok.pengcab_asal','left');
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ok.id_pengirim','left');
		if($id > 0){
			$this->db->where("ok.id_pengirim", $id);
		}

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'nama_pengcab' : $nmf="op.nama_pengcab";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		if($id > 0){
			$this->db->where("ok.id_pengirim", $id);
		}
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
		$this->db->from('ol_korespodensi ok');
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ok.id_pengirim','left');
		if($id > 0){
			$this->db->where("ok.id_pengirim", $id);
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/*		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){*/
/*		 		$kondisi=array('id_pengirim'=>$this->session->id_pegawai);
				$jml = $this->m_umum->jumlah_record_filter('ol_korespodensi',$kondisi);*/
/*			}else{
				$jml = $this->m_umum->jumlah_record_tabel('ol_surat');
			}
		}else{
			$jml = $this->m_umum->jumlah_record_tabel('ol_surat');
		}*/		
		$jml = $this->m_umum->jumlah_record_tabel('ol_korespodensi');
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function kategori_berkas_all()
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

	    $this->db->from('ol_berkas_kategori');
		
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
	    $this->db->from('ol_berkas_kategori');
		
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
	function simpan_kategori_berkas($id){
		$data_pendaftaran = array(
			'nama_kategori_berkas' => $this->input->post('nama_kategori_berkas'),
			'id_jabatan' => $id,
			'kunci' => 25,
			'status_kategori_berkas' => $this->input->post('status_kategori_berkas')
		);
		return $this->db->insert('ol_berkas_kategori', $data_pendaftaran);
	}
	function edit_kategori_berkas(){
		$id_kategori_berkas = $this->input->post('id_kategori_berkas');
		$data_pendaftaran = array(
			'nama_kategori_berkas' => $this->input->post('nama_kategori_berkas'),
			'status_kategori_berkas' => $this->input->post('status_kategori_berkas')
		);
		$this->db->where('id_kategori_berkas',$id_kategori_berkas);
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

	    $this->db->from('ol_kategori_pelatihan');
		
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
	    $this->db->from('ol_kategori_pelatihan');
		
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
			'id_jabatan' => $this->session->id_jabatan,
			'status_kategori_pelatihan' => $this->input->post('status_kategori_pelatihan')
		);
		return $this->db->insert('ol_kategori_pelatihan', $data_pendaftaran);
	}
	function edit_kategori_pelatihan(){
		$id_kategori_pelatihan = $this->input->post('id_kategori_pelatihan');
		$data_pendaftaran = array(
			'nama_kategori_pelatihan' => $this->input->post('nama_kategori_pelatihan'),
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
/*	function simpan_kor_detil(){
		$id_korespodensi = $this->input->post('id_korespodensi');
		$id_kategori = $this->input->post('id_kategori');
		$chk = $this->input->post('chk[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				$this->simpan_kor_ttd($chk[$i],$id_kategori,$id_korespodensi);
			}
		}
	}
	function simpan_kor_ttd($id,$id_kategori,$id_korespodensi){
		$d	= $this->m_umum->ambil_data('ol_surat_kategori','id_kategori',$id_kategori);
		$bookseat = explode(',', $d['ttd_kategori']);
		for($i = 0; $i < count($bookseat); ++$i){
			$jml = $this->m_ol_rancak->jumlah_data_pegawai_pengurus_pengcab_4_saving($id,$bookseat[$i]);// $id = id_pengcab, $bookseat = id_ms_pengurus
			if($jml > 0){
				$pp = $this->m_ol_rancak->ambil_data_pegawai_pengurus_pengcab_4_saving($id,$bookseat[$i]);// $id = id_pengcab, $bookseat = id_ms_pengurus
				$this->db->select("COUNT(*) as num");
				$this->db->where('id_korespodensi', $id_korespodensi);
				$this->db->where('id_pegawai_pengurus',$pp['id_pegawai_pengurus']);
				$q = $this->db->get('ol_kor_detil')->row();
				$jmlx = $q->num;
				if($jmlx == 0){
					$data_pendaftaran2 = array(
						'id_korespodensi' => $id_korespodensi,
						'id_pegawai' => 0,
						'id_pegawai_pengurus' =>  $pp['id_pegawai_pengurus']
					);
					$this->db->insert('ol_kor_detil', $data_pendaftaran2);
				}
			}
		}
	}*/
	function rubah_ttd_surat_kategori(){
		$id_kategori = $this->input->post('id_kategori');
		$chk = $this->input->post('chk');
		$eimplo = implode(",",$chk);		
		$data_pendaftaran = array(
			'ttd_kategori' => $eimplo
		);
		$this->db->where('id_kategori',$id_kategori);
		$this->db->update('ol_surat_kategori', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function kor_detil_all($id)
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,if(wkt_korespodensi = '' ,'Belum Ada Tanggal',DATE_FORMAT(wkt_korespodensi,'%d-%m-%Y')) as wkt_korespodensi
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
				//	 case 'nama_pengcab' : $nmf="op.nama_pengcab";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
		if($id > 0){
			$this->db->where("ok.id_pengirim", $id);
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_korespodensi ok');
		$this->db->join('ol_kor_kategori okk', 'okk.id_korespodensi=ok.id_korespodensi','left');
		$this->db->join('ol_surat_kategori', 'ol_surat_kategori.id_kategori=okk.id_kategori','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=okk.pengcab_asal','left');
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ok.id_pengirim','left');
		if($id > 0){
			$this->db->where("ok.id_pengirim", $id);
		}

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'nama_pengcab' : $nmf="op.nama_pengcab";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		if($id > 0){
			$this->db->where("ok.id_pengirim", $id);
		}
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
		$this->db->from('ol_korespodensi ok');
		$this->db->join('ol_kor_kategori okk', 'okk.id_korespodensi=ok.id_korespodensi','left');
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ok.id_pengirim','left');
		if($id > 0){
			$this->db->where("ok.id_pengirim", $id);
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/*		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){*/
/*		 		$kondisi=array('id_pengirim'=>$this->session->id_pegawai);
				$jml = $this->m_umum->jumlah_record_filter('ol_korespodensi',$kondisi);*/
/*			}else{
				$jml = $this->m_umum->jumlah_record_tabel('ol_surat');
			}
		}else{
			$jml = $this->m_umum->jumlah_record_tabel('ol_surat');
		}*/		
		$jml = $this->m_umum->jumlah_record_tabel('ol_korespodensi');
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function rubah_status_korespodensi($id,$isi){
		$data_pendaftaran = array(
			'status_korespodensi' => $isi
		);
		$this->db->where('id_korespodensi',$id);
		$this->db->update('ol_korespodensi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}
	function rubah_data_surat_korespodensi(){
		$id_korespodensi = $this->input->post('id_korespodensi');
		$data_pendaftaran = array(
			'no_korespodensi' => $this->input->post('no_korespodensi'),
			'sifat_surat' => $this->input->post('sifat_surat')
		);
		$this->db->where('id_korespodensi',$id_korespodensi);
		$this->db->update('ol_korespodensi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}
	function peminatan_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*
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
				//	 case 'nama_pengcab' : $nmf="op.nama_pengcab";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){
				$this->db->or_where("ol_peminatan.id_jabatan", $this->session->id_jabatan); 
			}
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_peminatan');
		$this->db->join('jabatan jf', 'jf.id_jabatan=ol_peminatan.id_jabatan','left');
		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){
				$this->db->or_where("ol_peminatan.id_jabatan", $this->session->id_jabatan); 
			}
		}

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'nama_pengcab' : $nmf="op.nama_pengcab";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){
				$this->db->or_where("ol_peminatan.id_jabatan", $this->session->id_jabatan); 
			}
		}
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
		$this->db->from('ol_peminatan');
		$this->db->join('jabatan jf', 'jf.id_jabatan=ol_peminatan.id_jabatan','left');
		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){
				$this->db->or_where("ol_peminatan.id_jabatan", $this->session->id_jabatan); 
			}
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/*		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){*/
/*		 		$kondisi=array('id_pengirim'=>$this->session->id_pegawai);
				$jml = $this->m_umum->jumlah_record_filter('ol_korespodensi',$kondisi);*/
/*			}else{
				$jml = $this->m_umum->jumlah_record_tabel('ol_surat');
			}
		}else{
			$jml = $this->m_umum->jumlah_record_tabel('ol_surat');
		}*/		
		$jml = $this->m_umum->jumlah_record_tabel('ol_peminatan');
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_ms_peminatan(){
		$data_pendaftaran2 = array(
			'nama_peminatan' => $this->input->post('nama_peminatan'),
			'id_jabatan' => $this->input->post('id_jabatan'),
			'status_peminatan' => $this->input->post('status_peminatan')
		);
		return $this->db->insert('ol_peminatan', $data_pendaftaran2);
	}
	function rubah_ms_peminatan(){
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
	function kompetensi_all()
	{
	//	$ids = explode(',', $unit);
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
		if($this->session->id_level !== 99){
			if($this->session->id_level !== 98){
				$this->db->where('k.id_jabatan',$this->session->id_jabatan);
			}
		}				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_kompetensi k');
		$this->db->join('jabatan jf', 'jf.id_jabatan=k.id_jabatan','left');
		if($this->session->id_level !== 99){
			if($this->session->id_level !== 98){
				$this->db->where('k.id_jabatan',$this->session->id_jabatan);
			}
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
		if($this->session->id_level !== 99){
			if($this->session->id_level !== 98){
				$this->db->where('k.id_jabatan',$this->session->id_jabatan);
			}
		}				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('ol_kompetensi k');
		$this->db->join('jabatan jf', 'jf.id_jabatan=k.id_jabatan','left');
		if($this->session->id_level !== 99){
			if($this->session->id_level !== 98){
				$this->db->where('k.id_jabatan',$this->session->id_jabatan);
			}
		}


		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
 		$kondisi=array('id_jabatan'=>$this->session->id_jabatan);
		$jml = $this->m_umum->jumlah_record_filter('ol_kompetensi',$kondisi); 
//		$jml = $this->m_umum->jumlah_record_tabel('kr_kompetensi');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_kompetensi(){
		$data_pendaftaran = array(
			'nama_kompetensi' => $this->input->post('nama_kompetensi'),
			'id_jabatan' => $this->input->post('id_jabatan'),
			'status_kompetensi' => $this->input->post('status_kompetensi')
		);
		return $this->db->insert('ol_kompetensi', $data_pendaftaran);
	}
	function edit_kompetensi(){
		$id_kompetensi = $this->input->post('id_kompetensi');
		$data_pendaftaran = array(
			'nama_kompetensi' => $this->input->post('nama_kompetensi'),
			'id_jabatan' => $this->input->post('id_jabatan'),
			'status_kompetensi' => $this->input->post('status_kompetensi')
		);
		$this->db->where('id_kompetensi',$id_kompetensi);
		$this->db->update('ol_kompetensi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function kewenangan_all($id,$opsi)
	{
	//	$ids = explode(',', $unit);
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
		if($opsi == 0){
			if($id > 0){
				$this->db->where("pf.id_jabatan", $id);
			}			
		}else{
			if($id == 0){
				$this->db->where("jf.id_jabatan", 1);
			}else{
				$this->db->where("jf.id_jabatan", $id);
			}	
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_kewenangan kk');
		if($opsi == 0){
				$this->db->join('ol_kompetensi k', 'k.id_kompetensi=kk.id_kompetensi','left');
				$this->db->join('kol_kode_kewenangan kw', 'kw.id_kode_kewenangan=kk.id_kode_kewenangan','left');
				$this->db->join('kol_sifat_kewenangan sk', 'sk.id_sifat_kewenangan=kk.id_sifat_kewenangan','left');			
				$this->db->join('jabatan pf', 'pf.id_jabatan=k.id_jabatan','left');
			if($id > 0){
				$this->db->where("pf.id_jabatan", $id);
			}			
		}else{
			$this->db->join('ol_kewenangan_bk okbk', 'okbk.id_kewenangan=kk.id_kewenangan','left');
			$this->db->join('butir_kegiatan bk', 'bk.id_butir_kegiatan=okbk.id_butir_kegiatan','left');
			$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=bk.id_jabatan_fungsional','left');
			$this->db->join('jabatan j', 'j.id_jabatan=jf.id_jabatan','left');
			if($id == 0){
				$this->db->where("jf.id_jabatan", 1);
			}else{
				$this->db->where("jf.id_jabatan", $id);
			}
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
		if($opsi == 0){
			if($id > 0){
				$this->db->where("pf.id_jabatan", $id);
			}		
		}else{
			if($id == 0){
				$this->db->where("jf.id_jabatan", 1);
			}else{
				$this->db->where("jf.id_jabatan", $id);
			}	
		}
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('ol_kewenangan kk');
		if($opsi == 0){
				$this->db->join('ol_kompetensi k', 'k.id_kompetensi=kk.id_kompetensi','left');
				$this->db->join('kol_kode_kewenangan kw', 'kw.id_kode_kewenangan=kk.id_kode_kewenangan','left');
				$this->db->join('kol_sifat_kewenangan sk', 'sk.id_sifat_kewenangan=kk.id_sifat_kewenangan','left');			
				$this->db->join('jabatan pf', 'pf.id_jabatan=k.id_jabatan','left');
			if($id > 0){
				$this->db->where("pf.id_jabatan", $id);
			}			
		}else{
			$this->db->join('ol_kewenangan_bk okbk', 'okbk.id_kewenangan=kk.id_kewenangan','left');
			$this->db->join('butir_kegiatan bk', 'bk.id_butir_kegiatan=okbk.id_butir_kegiatan','left');
			$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=bk.id_jabatan_fungsional','left');
			$this->db->join('jabatan j', 'j.id_jabatan=jf.id_jabatan','left');
			if($id == 0){
				$this->db->where("jf.id_jabatan", 1);
			}else{
				$this->db->where("jf.id_jabatan", $id);
			}
		}						

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('ol_kewenangan');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_kewenangan(){
		$data_pendaftaran = array(
			'nama_kewenangan' => $this->input->post('nama_kewenangan'),
			'id_kompetensi' => $this->input->post('id_kompetensi'),
			'id_kode_kewenangan' => $this->input->post('id_kode_kewenangan'),
			'id_sifat_kewenangan' => $this->input->post('id_sifat_kewenangan'),
			'wkt_kewenangan' => $this->input->post('wkt_kewenangan')
		);
		return $this->db->insert('ol_kewenangan', $data_pendaftaran);
	}
	function edit_kewenangan(){
		$id_kewenangan = $this->input->post('id_kewenangan');
		$data_pendaftaran = array(
			'nama_kewenangan' => $this->input->post('nama_kewenangan'),
			'id_kompetensi' => $this->input->post('id_kompetensi'),
			'id_kode_kewenangan' => $this->input->post('id_kode_kewenangan'),
			'id_sifat_kewenangan' => $this->input->post('id_sifat_kewenangan'),
			'wkt_kewenangan' => $this->input->post('wkt_kewenangan')
		);
		$this->db->where('id_kewenangan',$id_kewenangan);
		$this->db->update('ol_kewenangan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function kewenangan_detil_all($id)
	{
	//	$ids = explode(',', $unit);
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,kd.id_kewenangan";
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
		if($this->session->id_level !== 99){
			if($this->session->id_level !== 98){
				if($id > 0){
					$this->db->where("kd.id_ruangan", $id);
				}				
			}
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_kewenangan_detil kd');
		$this->db->join('ol_kewenangan k', 'k.id_kewenangan=kd.id_kewenangan','left');
		$this->db->join('ol_kompetensi kp', 'kp.id_kompetensi=k.id_kompetensi','left');
		$this->db->join('kol_kode_kewenangan kw', 'kw.id_kode_kewenangan=k.id_kode_kewenangan','left');
		$this->db->join('kol_sifat_kewenangan sk', 'sk.id_sifat_kewenangan=k.id_sifat_kewenangan','left');
		$this->db->join('jabatan pro', 'pro.id_jabatan=kp.id_jabatan','left');
		$this->db->join('ol_ruangan r', 'r.id_ruangan=kd.id_ruangan','left');
		if($this->session->id_level !== 99){
			if($this->session->id_level !== 98){
				if($id > 0){
					$this->db->where("kd.id_ruangan", $id);
				}				
			}
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
		if($this->session->id_level !== 99){
			if($this->session->id_level !== 98){
				if($id > 0){
					$this->db->where("kd.id_ruangan", $id);
				}				
			}
		}
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('ol_kewenangan_detil kd');
		$this->db->join('ol_kewenangan k', 'k.id_kewenangan=kd.id_kewenangan','left');
		$this->db->join('ol_kompetensi kp', 'kp.id_kompetensi=k.id_kompetensi','left');
		$this->db->join('kol_kode_kewenangan kw', 'kw.id_kode_kewenangan=k.id_kode_kewenangan','left');
		$this->db->join('kol_sifat_kewenangan sk', 'sk.id_sifat_kewenangan=k.id_sifat_kewenangan','left');
		$this->db->join('jabatan pro', 'pro.id_jabatan=kp.id_jabatan','left');
		$this->db->join('ol_ruangan r', 'r.id_ruangan=kd.id_ruangan','left');
		if($this->session->id_level !== 99){
			if($this->session->id_level !== 98){
				if($id > 0){
					$this->db->where("kd.id_ruangan", $id);
				}				
			}
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('ol_kewenangan_detil');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_kewenangan_detil_unit(){
		$chk = $this->input->post('chk[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				$this->db->select("COUNT(*) as num");
				$this->db->where('id_kewenangan', $chk[$i]);
				$this->db->where('id_ruangan',$this->input->post('id_ruangan'));
				$q = $this->db->get('ol_kewenangan_detil')->row();
				$jml = $q->num;
				$kode = $this->m_rancak->kode_generator(15,'');
				if($jml == 0){
					$data_pendaftaran = array(
						'id_ruangan' =>  $this->input->post('id_ruangan'),
						'barcode_kewenangan_detil' => $kode,
						'id_kewenangan' => $chk[$i]
					);
					$this->db->insert('ol_kewenangan_detil', $data_pendaftaran);
				}
			}
		}
	}
	function edit_kewenangan_detil(){
		$id_kewenangan_detil = $this->input->post('id_kewenangan_detil');
		$data_kewenangan_detil = array(
			'id_kewenangan' => $this->input->post('id_kewenangan'),
			'id_ruangan' =>$this->input->post('id_ruangan')
		);
		$this->db->where('id_kewenangan_detil',$id_kewenangan_detil);
		$this->db->update('ol_kewenangan_detil', $data_kewenangan_detil);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function lulus_all($id)
	{
	//	$ids = explode(',', $unit);
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
		if($id > 0){
		$this->db->where("kl.id_pegawai", $id);
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_kewenangan_lulus kl');
		$this->db->join('ol_kewenangan k', 'k.id_kewenangan=kl.id_kewenangan','left');
		$this->db->join('ol_kompetensi kp', 'kp.id_kompetensi=k.id_kompetensi','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=kl.id_pegawai','left');
		if($id > 0){
		$this->db->where("kl.id_pegawai", $id);
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
		if($id > 0){
		$this->db->where("kl.id_pegawai", $id);
		}
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('ol_kewenangan_lulus kl');
		$this->db->join('ol_kewenangan k', 'k.id_kewenangan=kl.id_kewenangan','left');
		$this->db->join('ol_kompetensi kp', 'kp.id_kompetensi=k.id_kompetensi','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=kl.id_pegawai','left');
		if($id > 0){
		$this->db->where("kl.id_pegawai", $id);
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$kondisi=array('id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('ol_kewenangan_lulus',$kondisi);		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_lulus_kewenangan(){
		$id = $this->input->post('id');
		$chk = $this->input->post('chk[]');
		$Skr = date('Y-m-d');
		$jml_kode = count($chk);
		for ($i=0;$i<$jml_kode;$i++){
		$this->db->select("COUNT(*) as num");
		$this->db->where('id_pegawai',$id);
		$this->db->where('id_kewenangan',$chk[$i]);
		$q = $this->db->get('ol_kewenangan_lulus')->row();
		$jml = $q->num;
		if($jml == 0){
			$data_pendaftaran = array(
				'id_kewenangan' => $chk[$i],
				'id_pegawai' => $id
			);
			$this->db->insert('ol_kewenangan_lulus', $data_pendaftaran);
		}
		}
	}
	function kol_catatan_oppe()
	{
	//	$ids = explode(',', $akses);
	//--------- Ambil nama kolom --------- [coding here] .jpg
	$fields = "*,REPLACE(kode_catatan,'_',' ') as kodes_catatan
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
	if($this->session->id_level !== 99){
		if($this->session->id_level !== 98){
			$this->db->where('ol_catatan.id_jabatan',$this->session->id_jabatan);			
		}
	}
				}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	$this->db->from('ol_catatan');
	$this->db->join('jabatan', 'jabatan.id_jabatan=ol_catatan.id_jabatan','left');
	if($this->session->id_level !== 99){
		if($this->session->id_level !== 98){
			$this->db->where('ol_catatan.id_jabatan',$this->session->id_jabatan);			
		}
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
	if($this->session->id_level !== 99){
		if($this->session->id_level !== 98){
			$this->db->where('ol_catatan.id_jabatan',$this->session->id_jabatan);			
		}
	}
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	$this->db->from('ol_catatan');
	$this->db->join('jabatan', 'jabatan.id_jabatan=ol_catatan.id_jabatan','left');
	if($this->session->id_level !== 99){
		if($this->session->id_level !== 98){
			$this->db->where('ol_catatan.id_jabatan',$this->session->id_jabatan);			
		}
	}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----

		$jml = $this->m_umum->jumlah_record_tabel('ol_catatan');			//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
	//	 print_r($output);die();
		return $output;
	}
	function simpan_ol_catatan(){
		$nama_catatan = "REKOMENDASI";
		$data_pendaftaran = array(
			'kode_catatan' => $this->input->post('kode_catatan'),
			'nama_catatan' => $this->input->post('nama_catatan'),
			'isi_catatan' => $this->input->post('isi_catatan'),
			'id_jabatan' => $this->session->id_jabatan
		);
		return $this->db->insert('ol_catatan', $data_pendaftaran);
	}
	function edit_ol_catatan($id_catatan){
		$data_kewenangan_detil = array(
			'isi_catatan' => $this->input->post('isi_catatan')
		);
		$this->db->where('id_catatan',$id_catatan);
		$this->db->update('ol_catatan', $data_kewenangan_detil);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function tabel_logbook($id,$all,$first_date,$last_date)
	{
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,

		if(lp.id_pegawai = '0' ,'Tidak Ada',peg.nama_pegawai) as nama_pegawai,
		if(lp.id_karu = '0' ,'BLM',peg2.nama_pegawai) as id_karu,
		if(lp.id_kabid = '0' ,'BLM',peg3.nama_pegawai) as id_kabid,
		if(lp.id_asesor = '0' ,'BLM',peg4.nama_pegawai) as id_asesor,
		if(lp.id_komite = '0' ,'BLM',peg5.nama_pegawai) as id_komite,
		if(lp.id_direktur = '0' ,'BLM',peg6.nama_pegawai) as id_direktur,
		if(lp.id_pengajuan = '0' ,'BLM',lp.id_pengajuan) as id_pengajuan,
		lp.id_logbook,
		if(lp.result_tolak = '0' ,'',if(lp.result_tolak = '1' ,'Supervisi','Tidak Kompeten')) as result_tolak,

concat(nama_kode_kewenangan,' - ',nama_sifat_kewenangan) as nama_kode_kewenangan,
if (lp.tgl_logbook = '0000-00-00' ,'TIDAK ADA',if (lp.tgl_logbook = NULL ,'TIDAK ADA',DATE_FORMAT(lp.tgl_logbook,'%d-%m-%Y'))) as tgl_logbook,
if (lp.tgl_v_karu = '0000-00-00' ,'TIDAK ADA',if (lp.tgl_v_karu = NULL ,'TIDAK ADA',DATE_FORMAT(lp.tgl_v_karu,'%d-%m-%Y'))) as tgl_v_karu,
if (lp.tgl_v_kabid = '0000-00-00' ,'TIDAK ADA',if (lp.tgl_v_kabid = NULL ,'TIDAK ADA',DATE_FORMAT(lp.tgl_v_kabid,'%d-%m-%Y'))) as tgl_v_kabid,
if (lp.tgl_v_komite = '0000-00-00' ,'TIDAK ADA',if (lp.tgl_v_komite = NULL ,'TIDAK ADA',DATE_FORMAT(lp.tgl_v_komite,'%d-%m-%Y'))) as tgl_v_komite,
if (lp.tgl_v_asesor = '0000-00-00' ,'TIDAK ADA',if (lp.tgl_v_asesor = NULL ,'TIDAK ADA',DATE_FORMAT(lp.tgl_v_asesor,'%d-%m-%Y'))) as tgl_v_asesor,
if (lp.tgl_v_direktur = '0000-00-00' ,'TIDAK ADA',if (lp.tgl_v_direktur = NULL ,'TIDAK ADA',DATE_FORMAT(lp.tgl_v_direktur,'%d-%m-%Y'))) as tgl_v_direktur
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
		if($id > 0){
		$this->db->where("lp.id_pegawai", $id);
		}
		if($all > 0){
		$this->db->where('lp.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		}
			}
		  }
		}
	//	$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_logbook lp');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=lp.id_pegawai','left');
		$this->db->join('ol_pegawai peg2', 'peg2.id_pegawai=lp.id_karu','left');
		$this->db->join('ol_pegawai peg3', 'peg3.id_pegawai=lp.id_kabid','left');
		$this->db->join('ol_pegawai peg4', 'peg4.id_pegawai=lp.id_asesor','left');
		$this->db->join('ol_pegawai peg5', 'peg5.id_pegawai=lp.id_komite','left');
		$this->db->join('ol_pegawai peg6', 'peg6.id_pegawai=lp.id_direktur','left');
		$this->db->join('ol_kewenangan krw', 'krw.id_kewenangan=lp.id_kewenangan','left');
		$this->db->join('kol_kode_kewenangan kw', 'kw.id_kode_kewenangan=krw.id_kode_kewenangan','left');
		$this->db->join('kol_sifat_kewenangan kf', 'kf.id_sifat_kewenangan=krw.id_sifat_kewenangan','left');
		$this->db->join('ol_pengajuan kp', 'kp.id_pengajuan=lp.id_pengajuan','left');
		$this->db->join('kol_status_diusulkan su', 'su.id_status_diusulkan=kp.id_status_diusulkan','left');
		if($id > 0){
		$this->db->where("lp.id_pegawai", $id);
		}
		if($all > 0){
		$this->db->where('lp.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
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
		if($id > 0){
		$this->db->where("lp.id_pegawai", $id);
		}
		if($all > 0){
		$this->db->where('lp.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		}
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('ol_logbook lp');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=lp.id_pegawai','left');
		$this->db->join('ol_pegawai peg2', 'peg2.id_pegawai=lp.id_karu','left');
		$this->db->join('ol_pegawai peg3', 'peg3.id_pegawai=lp.id_kabid','left');
		$this->db->join('ol_pegawai peg4', 'peg4.id_pegawai=lp.id_asesor','left');
		$this->db->join('ol_pegawai peg5', 'peg5.id_pegawai=lp.id_komite','left');
		$this->db->join('ol_pegawai peg6', 'peg6.id_pegawai=lp.id_direktur','left');
		$this->db->join('ol_kewenangan krw', 'krw.id_kewenangan=lp.id_kewenangan','left');
		$this->db->join('kol_kode_kewenangan kw', 'kw.id_kode_kewenangan=krw.id_kode_kewenangan','left');
		$this->db->join('kol_sifat_kewenangan kf', 'kf.id_sifat_kewenangan=krw.id_sifat_kewenangan','left');
		$this->db->join('ol_pengajuan kp', 'kp.id_pengajuan=lp.id_pengajuan','left');
		$this->db->join('kol_status_diusulkan su', 'su.id_status_diusulkan=kp.id_status_diusulkan','left');
		if($id > 0){
		$this->db->where("lp.id_pegawai", $id);
		}
		if($all > 0){
		$this->db->where('lp.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99');
		$jml = $this->m_umum->jumlah_record_filter('pegawai',$kondisi);	 */
		$jml = $this->m_umum->jumlah_record_tabel('ol_logbook');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function edit_instansi_text(){
		$id_instansi_text = $this->input->post('id_instansi_text');
		$data_pendaftaran = array(
			'welcome' => $this->input->post('welcome'),
			'title1' => $this->input->post('title1'),
			'title2' => $this->input->post('title2'),
			'title3' => $this->input->post('title3'),
			'title4' => $this->input->post('title4'),
			'desc1' => $this->input->post('desc1'),
			'desc2' => $this->input->post('desc2'),
			'desc3' => $this->input->post('desc3'),
			'desc4' => $this->input->post('desc4'),
			'slide1a' => $this->input->post('slide1a'),
			'slide1b' => $this->input->post('slide1b'),
			'slide2a' => $this->input->post('slide2a'),
			'slide2b' => $this->input->post('slide2b'),
			'slide3a' => $this->input->post('slide3a'),
			'slide3b' => $this->input->post('slide3b'),
			'slide4a' => $this->input->post('slide4a'),
			'slide4b' => $this->input->post('slide4b')
		);
		$this->db->where('id_instansi_text',$id_instansi_text);
		$this->db->update('a_instansi_text', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);
	}
	function etik_all($id)
	{
	//	$ids = explode(',', $jabatan);
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
		if($id > 0){
		$this->db->where('ol_etik.id_jabatan',$id);
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_etik');
		$this->db->join('jabatan', 'jabatan.id_jabatan=ol_etik.id_jabatan','left');
		if($id > 0){
		$this->db->where('ol_etik.id_jabatan',$id);
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
		if($id > 0){
		$this->db->where('ol_etik.id_jabatan',$id);
		}
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('ol_etik');
		$this->db->join('jabatan', 'jabatan.id_jabatan=ol_etik.id_jabatan','left');
		if($id > 0){
		$this->db->where('ol_etik.id_jabatan',$id);
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('ol_etik');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_etik(){
		$chk = $this->input->post('chk[]');
		if($chk){
		$jml_kode = count($chk);
		for ($i=0;$i<$jml_kode;$i++){
			$data_pendaftaran = array(
				'id_jabatan' => $chk[$i],
				'nama_etik' => $this->input->post('nama_etik'),
				'answer' => $this->input->post('answer'),
				'pembuat' => $this->session->id_pegawai,
				'status_etik' => $this->input->post('status_etik')
			);
			$this->db->insert('ol_etik', $data_pendaftaran);
		}
		}
	}
	function edit_etik(){
		$id_etik = $this->input->post('id_etik');
		$data_pendaftaran = array(
			'nama_etik' => $this->input->post('nama_etik'),
			'answer' => $this->input->post('answer'),
			'status_etik' => $this->input->post('status_etik')
		);
		$this->db->where('id_etik',$id_etik);
		$this->db->update('ol_etik', $data_pendaftaran);
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
		$ids = explode(',', $this->session->list_instansi);
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
	//	$this->db->where_in('ol_etik_instansi.id_instansi',$ids);
		if($id > 0){
		$this->db->where('ol_etik_instansi.id_jabatan',$id);
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_etik_instansi');
		$this->db->join('jabatan', 'jabatan.id_jabatan=ol_etik_instansi.id_jabatan','left');
		$this->db->join('kol_working', 'kol_working.id_working=ol_etik_instansi.id_instansi','left');
	//	$this->db->where_in('ol_etik_instansi.id_instansi',$ids);
		if($id > 0){
		$this->db->where('ol_etik_instansi.id_jabatan',$id);
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
	//	$this->db->where_in('ol_etik_instansi.id_instansi',$ids);
		if($id > 0){
		$this->db->where('ol_etik_instansi.id_jabatan',$id);
		}
			}
		  }
		}

	    $this->db->from('ol_etik_instansi');
		$this->db->join('jabatan', 'jabatan.id_jabatan=ol_etik_instansi.id_jabatan','left');
		$this->db->join('kol_working', 'kol_working.id_working=ol_etik_instansi.id_instansi','left');
	//	$this->db->where_in('ol_etik_instansi.id_instansi',$ids);
		if($id > 0){
		$this->db->where('ol_etik_instansi.id_jabatan',$id);
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('ol_etik_instansi');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_ms_etik(){
		$chk = $this->input->post('chk[]');
		$etik = implode(",",$chk);
		$data_kewenangan = array(
			'id_jabatan' => $this->input->post('id_jabatan'),
			'id_instansi' => $this->input->post('id_instansi'),
			'etik' => $etik
		);
		return $this->db->insert('ol_etik_instansi', $data_kewenangan);
	}
	function edit_ms_etik(){
		$id_etik_instansi = $this->input->post('id_etik_instansi');
		$chk = $this->input->post('chk[]');
		if(empty($chk)){
			$etik = '';
		}else{
			$etik = implode(",",$chk);
		}
		$data_pendaftaran = array(
			'id_jabatan' => $this->input->post('id_jabatan'),
			'id_instansi' => $this->input->post('id_instansi'),
			'status_etik_instansi' => $this->input->post('status_etik_instansi'),
			'etik' => $etik
		);
		$this->db->where('id_etik_instansi',$id_etik_instansi);
		$this->db->update('ol_etik_instansi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function etik_pegawai_all($id)
	{
		$ids = explode(',', $this->session->list_instansi);
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,p2.nama_pegawai as penguji";
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
		//	$this->db->where_in('ol_etik_pegawai.id_instansi',$ids);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_etik_pegawai');
		$this->db->join('ol_pegawai p1','p1.id_pegawai=ol_etik_pegawai.id_pegawai','left');
		$this->db->join('ol_pegawai p2','p2.id_pegawai=ol_etik_pegawai.id_penguji','left');
		$this->db->join('kol_working', 'kol_working.id_working=ol_etik_pegawai.id_instansi','left');
	//		$this->db->where_in('ol_etik_pegawai.id_instansi',$ids);


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
	//		$this->db->where_in('ol_etik_pegawai.id_instansi',$ids);

			}
		  }
		}

	    $this->db->from('ol_etik_pegawai');
		$this->db->join('ol_pegawai p1','p1.id_pegawai=ol_etik_pegawai.id_pegawai','left');
		$this->db->join('ol_pegawai p2','p2.id_pegawai=ol_etik_pegawai.id_penguji','left');
		$this->db->join('kol_working', 'kol_working.id_working=ol_etik_pegawai.id_instansi','left');		
	//		$this->db->where_in('ol_etik_pegawai.id_instansi',$ids);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('ol_etik_pegawai');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_etik_pegawai(){
		$id_pegawai = $this->input->post('id_pegawai');
		$id_instansi = $this->input->post('id_instansi');
		$sub_total = $this->input->post('sub_total');
		$hasilGR = $this->input->post('hasilGR');
		$total = $this->input->post('total');
		$id_penguji = $this->session->id_pegawai;
		$Skr = date('Y-m-d');
		$clock = date('H:i:s');
		$kode = $this->m_rancak->kode_generator(15,'');
		$data_pendaftaran = array(
				'barcode_etik_pegawai' => $kode,
				'id_pegawai' => $id_pegawai,
				'id_instansi' => $id_instansi,
				'tgl_etik_pegawai' => $Skr,
				'id_penguji' => $id_penguji,
				'total_etik' => $sub_total,
				'hasil_etik' => $hasilGR,
				'jumlah_etik' => $total,
				'jam_etik_pegawai' => $clock
			);
		$this->db->insert('ol_etik_pegawai', $data_pendaftaran);
		return $this->db->insert_id();
	}
	function simpan_etik_pegawai_detil($last_ide){
		$id_etik = $this->input->post('id_etik[]');
		$jml_kode = count($id_etik);
		for ($i=0;$i<$jml_kode;$i++){
		$alle = "skor_etik".$id_etik[$i];
		$skor_etik = $this->input->post($alle);
				$data_pendaftaran = array(
					'id_etik_pegawai' => $last_ide,
					'id_etik' => $id_etik[$i],
					'skor_etik' => $skor_etik
				);
				$this->db->insert('ol_etik_detil', $data_pendaftaran);
		}
	}
	function jabatan_struktur_all($id)
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*
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
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('kol_ms_struktur');
		$this->db->join('kol_working', 'kol_working.id_working=kol_ms_struktur.instansi_struktur','left');

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
		$this->db->from('kol_ms_struktur');
		$this->db->join('kol_working', 'kol_working.id_working=kol_ms_struktur.instansi_struktur','left');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
	//	if($id == 0){
	 //		$kondisi=array('id_jabatan'=>$this->session->id_jabatan);
	//		$jml = $this->m_umum->jumlah_record_filter('kol_ms_struktur',$kondisi);
/*		}else{
			$jml = $this->m_umum->jumlah_record_tabel('ol_status_pegawai');	
		}*/
		$jml = $this->m_umum->jumlah_record_tabel('kol_ms_struktur');	

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_ms_struktur(){
		$kode = $this->m_rancak->kode_generator(15,'');
		$data_pendaftaran = array(
			'nama_ms_struktur' => $this->input->post('nama_ms_struktur'),
			'instansi_struktur' => $this->input->post('id_instansi'),
			'status_ms_struktur' => $this->input->post('status_ms_struktur')
		);
		$this->db->insert('kol_ms_struktur', $data_pendaftaran);
		return $this->db->insert_id();
	}
	function edit_ms_struktur(){
		$id_ms_struktur = $this->input->post('id_ms_struktur');
		$data_pendaftaran = array(
			'nama_ms_struktur' => $this->input->post('nama_ms_struktur'),
			'status_ms_struktur' => $this->input->post('status_ms_struktur'),
			'instansi_struktur' => $this->input->post('id_instansi')
		);
		$this->db->where('id_ms_struktur',$id_ms_struktur);
		$this->db->update('kol_ms_struktur', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function struktur_all($id,$eimplo)
	{
		$ids = explode(',', $eimplo);
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
				//	 case 'nama_pegawai' : $nmf="pegawai.nama_pegawai";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		if($id == 0){
			if ($this->session->id_level !== '99'){
				if($this->session->id_level !== '98'){
					$this->db->where_in('os.id_instansi',$ids);
				}
			}
		}else{
			if ($this->session->id_level !== '99'){
				if($this->session->id_level !== '98'){
					$this->db->where_in('os.id_instansi',$ids);
				}
			}
			$this->db->where('os.id_instansi',$id);
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_struktur os');
		$this->db->join('kol_working kw', 'kw.id_working=os.id_instansi','left');
		$this->db->join('kol_ms_struktur kmst', 'kmst.id_ms_struktur=os.id_ms_struktur','left');
		if($id == 0){
			if ($this->session->id_level !== '99'){
				if($this->session->id_level !== '98'){
					$this->db->where_in('os.id_instansi',$ids);
				}
			}
		}else{
			if ($this->session->id_level !== '99'){
				if($this->session->id_level !== '98'){
					$this->db->where_in('os.id_instansi',$ids);
				}
			}
			$this->db->where('os.id_instansi',$id);
		}

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'nama_pegawai' : $nmf="pegawai.nama_pegawai";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		if($id == 0){
			if ($this->session->id_level !== '99'){
				if($this->session->id_level !== '98'){
					$this->db->where_in('os.id_instansi',$ids);
				}
			}
		}else{
			if ($this->session->id_level !== '99'){
				if($this->session->id_level !== '98'){
					$this->db->where_in('os.id_instansi',$ids);
				}
			}
			$this->db->where('os.id_instansi',$id);
		}
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('ol_struktur os');
		$this->db->join('kol_working kw', 'kw.id_working=os.id_instansi','left');
		$this->db->join('kol_ms_struktur kmst', 'kmst.id_ms_struktur=os.id_ms_struktur','left');
		if($id == 0){
			if ($this->session->id_level !== '99'){
				if($this->session->id_level !== '98'){
					$this->db->where_in('os.id_instansi',$ids);
				}
			}
		}else{
			if ($this->session->id_level !== '99'){
				if($this->session->id_level !== '98'){
					$this->db->where_in('os.id_instansi',$ids);
				}
			}
			$this->db->where('os.id_instansi',$id);
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('ol_struktur');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_ol_struktur(){
		$chk = $this->input->post('chk[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				$this->db->select("COUNT(*) as num");
				$this->db->where('id_ms_struktur', $chk[$i]);
				$this->db->where('id_instansi',$this->input->post('id_instansi'));
			//	$this->db->where('status_struktur',1);
				$q = $this->db->get('ol_struktur')->row();
				$jml = $q->num;
				if($jml == 0){
					$kode = $this->m_rancak->kode_generator(15,'');
					$data_pendaftaran = array(
						'id_ms_struktur' => $chk[$i],
						'barcode_struktur' => $kode,
						'id_instansi' =>  $this->input->post('id_instansi')
					);
					$this->db->insert('ol_struktur', $data_pendaftaran);
				}
			}
		}
	}
	function rubah_kor_print(){
		$id_kor_print = $this->input->post('id_kor_print');
		$tgl_awal = $this->input->post('tgl_awal');
		$tgl_awal = date('Y-m-d', strtotime($tgl_awal));
		$tgl_akhir = $this->input->post('tgl_akhir');
		$tgl_akhir = date('Y-m-d', strtotime($tgl_akhir));
		$tgl_kor_print = $this->input->post('tgl_kor_print');
		$tgl_kor_print = date('Y-m-d', strtotime($tgl_kor_print));
		$data_pendaftaran = array(
			'title_kor_print' => $this->input->post('title_kor_print'),
			'font_size' => $this->input->post('font_size'),
			'tmp_kor_print' => $this->input->post('tmp_kor_print'),
			'modul' => $this->input->post('modul'),
			'tmp_modul' => $this->input->post('tmp_modul'),
			'no_kor_print' => $this->input->post('no_kor_print'),
			'tgl_awal' => $tgl_awal,
			'tgl_akhir' => $tgl_akhir,
			'tgl_kor_print' => $tgl_kor_print
		);
		$this->db->where('id_kor_print',$id_kor_print);
		$this->db->update('ol_kor_print', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}
	function edit_ol_struktur(){
		$id_struktur = $this->input->post('id_struktur');
		$data_kewenangan_detil = array(
			'id_ms_struktur' => $this->input->post('id_ms_struktur'),
			'status_struktur' => $this->input->post('status_struktur')
		);
		$this->db->where('id_struktur',$id_struktur);
		$this->db->update('ol_struktur', $data_kewenangan_detil);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function pegawai_struktur_all($id)
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*
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
				//	 case 'nama_pengcab' : $nmf="op.nama_pengcab";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){
				$this->db->where("ope.id_jabatan", $this->session->id_jabatan); 
			}
		}
		if($id > 0){
		$this->db->where("opg.id_instansi", $id);
		}
		$this->db->where("kmp.status_ms_struktur", 1);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_pegawai_struktur opp');
		$this->db->join('ol_pegawai op', 'op.id_pegawai=opp.id_pegawai','left');
		$this->db->join('ol_struktur opg', 'opg.id_struktur=opp.id_struktur','left');
		$this->db->join('kol_working ope', 'ope.id_working=opg.id_instansi','left');
		$this->db->join('kol_ms_struktur kmp', 'kmp.id_ms_struktur=opg.id_ms_struktur','left');
		if($id > 0){
		$this->db->where("opg.id_instansi", $id);
		}
		$this->db->where("kmp.status_ms_struktur", 1);
//		$this->db->where("opp.status_pegawai_pengurus", 1);

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'nama_pengcab' : $nmf="op.nama_pengcab";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){
				$this->db->where("ope.id_jabatan", $this->session->id_jabatan); 
			}
		}
		if($id > 0){
		$this->db->where("opg.id_instansi", $id);
		}
		$this->db->where("kmp.status_ms_struktur", 1);;
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
		$this->db->from('ol_pegawai_struktur opp');
		$this->db->join('ol_pegawai op', 'op.id_pegawai=opp.id_pegawai','left');
		$this->db->join('ol_struktur opg', 'opg.id_struktur=opp.id_struktur','left');
		$this->db->join('kol_working ope', 'ope.id_working=opg.id_instansi','left');
		$this->db->join('kol_ms_struktur kmp', 'kmp.id_ms_struktur=opg.id_ms_struktur','left');
		if($id > 0){
		$this->db->where("opg.id_instansi", $id);
		}
		$this->db->where("kmp.status_ms_struktur", 1);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
//		if($id == 0){
	 	//	$kondisi=array('id_jabatan'=>$this->session->id_jabatan);
			$jml = $this->jumlah_pegawai_struktur_all($id);
/*		}else{
			$jml = $this->m_umum->jumlah_record_tabel('ol_status_pegawai');	
		}*/
		

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
    function jumlah_pegawai_struktur_all($id)    //igd.php untuk menampilkan jumlah antrian di igd saja
    {
		$this->db->join('ol_pegawai op', 'op.id_pegawai=opp.id_pegawai','left');
		$this->db->join('ol_struktur opg', 'opg.id_struktur=opp.id_struktur','left');
		$this->db->join('kol_working ope', 'ope.id_working=opg.id_instansi','left');
		$this->db->join('kol_ms_struktur kmp', 'kmp.id_ms_struktur=opg.id_ms_struktur','left');
		if($id > 0){
		$this->db->where("opg.id_instansi", $id);
		}
		$this->db->where("kmp.status_ms_struktur", 1);
        $query = $this->db->select("COUNT(*) as num")->get_where('ol_pegawai_struktur opp');
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
    }
	function simpan_ol_pegawai_struktur($id){
		$kode = $this->m_rancak->kode_generator(15,'');
	//		if(empty($id)){
				$data_kewenangan = array(
				'id_pegawai' => $this->input->post('id_pegawai'),
				'id_struktur' => $this->input->post('id_struktur'),
				'barcode_pegawai_struktur' => $kode
				);
/*			}else{
				$data_kewenangan = array(
				'id_pegawai' => $this->input->post('id_pegawai'),
				'id_pengurus' => $this->input->post('id_pengurus'),
				'barcode_pegawai_pengurus' => $kode,
				'ttd_pegawai_pengurus' => $id
				);
			}*/
		return $this->db->insert('ol_pegawai_struktur', $data_kewenangan);
	}
	function simpan_pegawai_struktur_jabatan(){
		$id_pegawai_struktur = $this->input->post('id_pegawai_struktur');
		$chk = $this->input->post('chk[]');
		if(empty($chk)){
			$eimplo = "";
		}else{
			$eimplo = implode(",",$chk);
		}
		$data_pendaftaran = array(
			'id_jabatan' => $eimplo
		);
		$this->db->where('id_pegawai_struktur',$id_pegawai_struktur);
		$this->db->update('ol_pegawai_struktur', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function edit_pegawai_struktur(){
		$id_pegawai_struktur = $this->input->post('id_pegawai_struktur');
		$data_pendaftaran = array(
			'id_struktur' => $this->input->post('id_struktur'),
			'id_pegawai' => $this->input->post('id_pegawai'),
			'status_pegawai_struktur' => $this->input->post('status_pegawai_struktur')
		);
		$this->db->where('id_pegawai_struktur',$id_pegawai_struktur);
		$this->db->update('ol_pegawai_struktur', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function kewenangan_bk($id)
	{
	//	$ids = explode(',', $unit);
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
		if($id == 0){
			$this->db->where("bk.id_jabatan_fungsional", 1);
		}else{
			$this->db->where("bk.id_jabatan_fungsional", $id);
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_kewenangan_bk kbk');
		$this->db->join('ol_kewenangan k', 'k.id_kewenangan=kbk.id_kewenangan','left');
		$this->db->join('butir_kegiatan bk', 'bk.id_butir_kegiatan=kbk.id_butir_kegiatan','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=bk.id_jabatan_fungsional','left');
		if($id == 0){
			$this->db->where("bk.id_jabatan_fungsional", 1);
		}else{
			$this->db->where("bk.id_jabatan_fungsional", $id);
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
		if($id == 0){
			$this->db->where("bk.id_jabatan_fungsional", 1);
		}else{
			$this->db->where("bk.id_jabatan_fungsional", $id);
		}
			}
		  }
		}

	    $this->db->from('ol_kewenangan_bk kbk');
		$this->db->join('ol_kewenangan k', 'k.id_kewenangan=kbk.id_kewenangan','left');
		$this->db->join('butir_kegiatan bk', 'bk.id_butir_kegiatan=kbk.id_butir_kegiatan','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=bk.id_jabatan_fungsional','left');
		if($id == 0){
			$this->db->where("bk.id_jabatan_fungsional", 1);
		}else{
			$this->db->where("bk.id_jabatan_fungsional", $id);
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$kondisi=array('id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('ol_kewenangan_lulus',$kondisi);		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_ol_kewenangan_bk(){
		$chk = $this->input->post('chk[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				$this->db->select("COUNT(*) as num");
				$this->db->where('id_kewenangan', $chk[$i]);
				$this->db->where('id_butir_kegiatan',$this->input->post('id_butir_kegiatan'));
			//	$this->db->where('status_pengurus',1);
				$q = $this->db->get('ol_kewenangan_bk')->row();
			//	$this->edit_olk($chk[$i]);
				$jml = $q->num;
				if($jml == 0){
					$data_pendaftaran = array(
						'id_kewenangan' => $chk[$i],
						'id_butir_kegiatan' =>  $this->input->post('id_butir_kegiatan')
					);
					$this->db->insert('ol_kewenangan_bk', $data_pendaftaran);
				}
			}
		}
	}
	function edit_ol_kewenangan_bk(){
		$id_kewenangan_bk = $this->input->post('id_kewenangan_bk');
		$data_pendaftaran = array(
			'id_kewenangan' => $this->input->post('id_kewenangan'),
			'id_butir_kegiatan' =>  $this->input->post('id_butir_kegiatan'),
			'status_kewenangan_bk' =>  $this->input->post('status_kewenangan_bk')
		);
		$this->db->where('id_kewenangan_bk',$id_kewenangan_bk);
		$this->db->update('ol_kewenangan_bk', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function edit_olk($id){
		$data_pendaftaran = array(
		'bk' => 1
		);
		$this->db->where('id_kewenangan',$id);
		$this->db->update('ol_kewenangan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function butir_kegiatan_kabeh($id)
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,round(angka_kredit, 4),	
			if (status_butir_kegiatan = '1' ,'AKTIF','NON AKTIF') as status_butir_kegiatan
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
				//	 case 'nama_pegawai' : $nmf="pegawai.nama_pegawai";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where("bk.id_jabatan_fungsional", $id);
		
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('butir_kegiatan bk');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=bk.id_jabatan_fungsional','left');
		$this->db->where("bk.id_jabatan_fungsional", $id);
			
		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'nama_pegawai' : $nmf="pegawai.nama_pegawai";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where("bk.id_jabatan_fungsional", $id);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('butir_kegiatan bk');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=bk.id_jabatan_fungsional','left');
		$this->db->where("bk.id_jabatan_fungsional", $id);
		
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('butir_kegiatan');		//[coding here] ganti tabel utamanya
				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;	
	}
	function tambah_butir_kegiatan_kw(){
		$id_kewenangan = $this->tambah_kewenangan_bk();
		$id_butir_kegiatan = $this->tambah_butir_kegiatan();
		$data_pendaftaran = array(
			'id_kewenangan' => $id_kewenangan,
			'id_butir_kegiatan' => $id_butir_kegiatan
		);
		return $this->db->insert('ol_kewenangan_bk', $data_pendaftaran);
	}
	function tambah_butir_kegiatan(){
		$data_pendaftaran = array(
			'id_jabatan_fungsional' => $this->input->post('id_jabatan_fungsional'),
			'nama_butir_kegiatan' => $this->input->post('nama_butir_kegiatan'),						
			'angka_kredit' => $this->input->post('angka_kredit'),
			'satuan_hasil' => $this->input->post('satuan_hasil'),
			'status_butir_kegiatan' => $this->input->post('status_butir_kegiatan')
		);
		$this->db->insert('butir_kegiatan', $data_pendaftaran);
		return $this->db->insert_id();
	}
	function tambah_kewenangan_bk(){
		$data_pendaftaran = array(
			'nama_kewenangan' => $this->input->post('nama_butir_kegiatan'),
			'bk' => 1
		);
		$this->db->insert('ol_kewenangan', $data_pendaftaran);
		return $this->db->insert_id();
	}
	function rubah_butir_kegiatan(){
		$id_butir_kegiatan = $this->input->post('id_butir_kegiatan');	
		$data_pendaftaran = array(
			'id_jabatan_fungsional' => $this->input->post('id_jabatan_fungsional'),
			'nama_butir_kegiatan' => $this->input->post('nama_butir_kegiatan'),						
			'angka_kredit' => $this->input->post('angka_kredit'),
			'satuan_hasil' => $this->input->post('satuan_hasil'),
			'status_butir_kegiatan' => $this->input->post('status_butir_kegiatan')
		);
		$this->db->where('id_butir_kegiatan',$id_butir_kegiatan);
		$this->db->update('butir_kegiatan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function rubah_kewenangan_bk(){
		$id_kewenangan = $this->input->post('id_kewenangan');	
		$data_pendaftaran = array(
			'nama_kewenangan' => $this->input->post('nama_butir_kegiatan')
		);
		$this->db->where('id_kewenangan',$id_kewenangan);
		$this->db->update('ol_kewenangan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function pengajuan_format_rs($id)
	{
	//	$ids = explode(',', $akses);
	//--------- Ambil nama kolom --------- [coding here] .jpg
	$fields = "*
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
	if($id > 0){
		$this->db->where('ol_pengajuan_format_rs.id_instansi',$id);			
	}
				}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	$this->db->from('ol_pengajuan_format_rs');
	$this->db->join('kol_working', 'kol_working.id_working=ol_pengajuan_format_rs.id_instansi','left');
	$this->db->join('jabatan', 'jabatan.id_jabatan=ol_pengajuan_format_rs.id_jabatan','left');
	$this->db->join('kol_status_diusulkan', 'kol_status_diusulkan.id_status_diusulkan=ol_pengajuan_format_rs.id_status_diusulkan','left');
	if($id > 0){
		$this->db->where('ol_pengajuan_format_rs.id_instansi',$id);			
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
	if($id > 0){
		$this->db->where('ol_pengajuan_format_rs.id_instansi',$id);			
	}
			}
		  }
		}

	$this->db->from('ol_pengajuan_format_rs');
	$this->db->join('kol_working', 'kol_working.id_working=ol_pengajuan_format_rs.id_instansi','left');
	$this->db->join('jabatan', 'jabatan.id_jabatan=ol_pengajuan_format_rs.id_jabatan','left');
	$this->db->join('kol_status_diusulkan', 'kol_status_diusulkan.id_status_diusulkan=ol_pengajuan_format_rs.id_status_diusulkan','left');
	if($id > 0){
		$this->db->where('ol_pengajuan_format_rs.id_instansi',$id);			
	}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----

		$jml = $this->m_umum->jumlah_record_tabel('ol_pengajuan_format_rs');			//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
	//	 print_r($output);die();
		return $output;
	}
	function simpan_ol_pengajuan_format_rs(){
		$chk = $this->input->post('chk[]');
		$eimplo = implode(",",$chk);
		if($chk){
			$data_pendaftaran = array(
				'ms_struktur' => $eimplo,
				'id_instansi' =>  $this->input->post('id_instansi'),
				'id_status_diusulkan' =>  $this->input->post('id_status_diusulkan'),
				'id_jabatan' =>  $this->input->post('id_jabatan'),
				'status_pengajuan_format_rs' =>  $this->input->post('status_pengajuan_format_rs')
			);
			$this->db->insert('ol_pengajuan_format_rs', $data_pendaftaran);
		}
	}
	function edit_ol_pengajuan_format_rs(){
		$chk = $this->input->post('chk[]');
		$id_pengajuan_format_rs = $this->input->post('id_pengajuan_format_rs');	
		$eimplo = implode(",",$chk);
		if($chk){
			$data_pendaftaran = array(
				'ms_struktur' => $eimplo,
				'id_instansi' =>  $this->input->post('id_instansi'),
				'id_status_diusulkan' =>  $this->input->post('id_status_diusulkan'),
				'id_jabatan' =>  $this->input->post('id_jabatan'),
				'status_pengajuan_format_rs' =>  $this->input->post('status_pengajuan_format_rs')
			);
			$this->db->where('id_pengajuan_format_rs',$id_pengajuan_format_rs);
			$this->db->update('ol_pengajuan_format_rs', $data_pendaftaran);
			//echo $this->db->last_query();
			$this->db->trans_complete();	// untuk cek sukses update tidak
			if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
			// if (!$this->db->affected_rows()) 
				return(FALSE);
			else 
				return(TRUE);
		}
	}
}