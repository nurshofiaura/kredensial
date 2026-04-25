<?php
class M_administrator extends CI_model{
	function ambil_barcode_user_pegawai($id){
		$this->db->join('pegawai p', 'p.id_pegawai=u.id_pegawai','left');
		$this->db->join('user_level ul', 'ul.id_level=u.id_level','left');
		$q = $this->db->get_where('user u',array('p.barcode_pegawai'=>$id));
		return $q->row_array();
	}
	function get_banner_logo()	
	{
		$this->db->select('*');
		$this->db->where('tgl_expired >=',date('Y-m-d'));
		$this->db->where('status_bnr_logo','1');
		$query = $this->db->get_where('bnr_logo');
		return $query->result_array();
	}
// ================================================= USER ==============================
	function user_all($unit,$level)
	{
		$ids = explode(',', $unit);
	//--------- Ambil nama kolom --------- [coding here] .jpg
	$fields = "*,if (foto = '' ,'noavatar.jpg',foto) as foto,if(status_pegawai = '0' ,'NON AKTIF','AKTIF') as status_pegawai,
						DATE_FORMAT(peg.tgl_lahir,'%d-%m-%Y') as tgl_lahir,if (peg.jk = '1' ,'Laki-laki','Perempuan') as jk";
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
		$this->db->where('visible', '1');
	// $this->db->or_where('u.id_level !=', '98');
	// $this->db->group_by('u.id_pegawai');
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('pegawai peg');
		$this->db->join('jabatan_fungsional jf','jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
		$this->db->join('ruangan r','r.id_ruangan=peg.id_ruangan','left');
		$this->db->join('unit un','un.id_unit=peg.id_unit','left');
		$this->db->join('kol_status_kawin kss', 'kss.id_status_kawin=peg.id_status_kawin','left');
		$this->db->join('kol_status_pegawai ksp', 'ksp.id_status_pegawai=peg.tipe_pegawai','left');
		$this->db->join('kol_pendidikan kp', 'kp.id_pendidikan=peg.id_pendidikan','left');
		$this->db->where('visible', '1');
		// $this->db->or_where('u.id_level !=', '98');
		// $this->db->group_by('u.id_pegawai');

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
		$this->db->where('visible', '1');
	// $this->db->or_where('u.id_level !=', '98');
	// $this->db->group_by('u.id_pegawai');
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	$this->db->from('pegawai peg');
	$this->db->where('visible', '1');
	// $this->db->or_where('u.id_level !=', '98');
	// $this->db->group_by('u.id_pegawai');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('pegawai');			//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
	//	 print_r($output);die();
		return $output;
	}
	function num_last_registrasi()	//sa.php
	{
        //Cari id terakhir dengan unit dan tanggal yang sama
        $this->db->select("id_registrasi");
        $this->db->order_by('id_registrasi', 'DESC');
        $query=$this->db->get_where("registrasi");
        $result = $query->row();
        // echo $this->db->last_query();
        // echo "No Antri = ".$result->no_antri;die();
        if(isset($result))
            return $result->id_registrasi;
        return 0;
	}
	function simpan_registrasi(){
		$username= $this->input->post('username');
		$username = strtolower($username);
		$username = str_replace(' ', '-', $username);
		$username = preg_replace('/[^A-Za-z0-9\-]/', '', $username);
		$password = hash("sha512", md5('7654321'));
		$ptn = "/^0/";  // Regex
		$str = $this->input->post('no_hp'); //Your input, perhaps $_POST['textbox'] or whatever
		$rpltxt = "62";  // Replacement string
		$no_hp = preg_replace($ptn, $rpltxt, $str);
		$jml_last_id = $this->num_last_registrasi();
		if($jml_last_id == 0){
			$ide = 1;
		}else{
			$ide = $jml_last_id + 1;
		}
		$tgl_lahir = $this->input->post('tgl_lahir');
		$tgl_lahir = date('Y-m-d', strtotime($tgl_lahir));
		$data_pendaftaran = array(
			'id_registrasi' => $ide,
			'username' => $username,
			'tgl_lahir' => $tgl_lahir,
			'nama_pegawai' => $this->input->post('nama_pegawai'),
			'tmp_lahir' => $this->input->post('tmp_lahir'),
			'jk' => $this->input->post('jk'),
			'id_status_kawin' => $this->input->post('id_status_kawin'),
			'id_agama' => $this->input->post('id_agama'),
			'nip' => $this->input->post('nip'),
			'tipe_pegawai' => $this->input->post('tipe_pegawai'),
			'no_hp' => $this->input->post('no_hp'),
			'email' => $this->input->post('email'),
			'id_jabatan_fungsional' => $this->input->post('id_jabatan_fungsional'),
			'id_ruangan' => $this->input->post('id_ruangan'),
			'id_pendidikan' => $this->input->post('id_pendidikan'),
			'alamat' => $this->input->post('alamat')
		);
		return $this->db->insert('registrasi', $data_pendaftaran);
	}
	function simpan_aktifasi(){
		$kosong = "";
		$nol = "0";
		$tglkosong = "0000-00-00";
		$nip= $this->input->post('nip');
		$nip = str_replace(' ', '', $nip);
		$tgl_lahir = $this->input->post('tgl_lahir');
		$tgl_lahir = date('Y-m-d', strtotime($tgl_lahir));
		$kode = $this->m_rancak->kode_generator(15,'');
		$data_pendaftaran = array(
			'nik' => $kosong,
			'nip' => $nip,
			'email' =>$this->input->post('email'),
			'nama_pegawai' => $this->input->post('nama_pegawai'),
			'barcode_pegawai' =>$kode,
			'id_unit' =>$nol,
			'id_ruangan' =>$this->input->post('id_ruangan'),
			'tipe_pegawai' =>$this->input->post('tipe_pegawai'),
			'no_hp' =>$this->input->post('no_hp'),
			'no_profesi' => $kosong,
			'tmp_lahir' => $this->input->post('tmp_lahir'),
			'tgl_lahir' => $tgl_lahir,
			'jk' =>$this->input->post('jk'),
			'id_status_kawin' =>$this->input->post('id_status_kawin'),
			'id_pendidikan' =>$this->input->post('id_pendidikan'),
			'id_jabatan_fungsional' =>$this->input->post('id_jabatan_fungsional'),
			'id_agama' =>$this->input->post('id_agama'),
			'alamat' => $this->input->post('alamat'),
			'foto' => $kosong
		);
		$this->db->insert('pegawai', $data_pendaftaran);
		return $this->db->insert_id();
	}
	function simpan_pegawai($pic){
		$kosong = "";
		$nol = "0";
		$tglkosong = "0000-00-00";
		$kode = $this->m_rancak->kode_generator(15,'');
		$nip= $this->input->post('nip');
		$nip = str_replace(' ', '', $nip);
		$data_pendaftaran = array(
			'nik' => $kosong,
			'nip' => $nip,
			'email' =>$this->input->post('email'),
			'barcode_pegawai' => $kode,
			'nama_pegawai' => $this->input->post('nama_pegawai'),
			'id_unit' =>$this->input->post('id_unit'),
			'id_ruangan' =>$this->input->post('id_ruangan'),
			'tipe_pegawai' =>$this->input->post('tipe_pegawai'),
			'no_hp' =>$this->input->post('no_hp'),
			'id_jabatan_fungsional' =>$this->input->post('id_jabatan_fungsional'),
			'no_profesi' => $kosong,
			'tmp_lahir' => $kosong,
			'tgl_lahir' => $tglkosong,
			'jk' =>$this->input->post('jk'),
			'id_status_kawin' =>$nol,
			'id_pendidikan' =>$nol,
			'id_agama' =>$nol,
			'alamat' => $kosong,
			'foto' => $pic
		);
		$this->db->insert('pegawai', $data_pendaftaran);
		return $this->db->insert_id();
	}
	function simpan_pegawai_no_pic(){
		$kosong = "";
		$nol = "0";
		$tglkosong = "0000-00-00";
		$nip= $this->input->post('nip');
		$nip = str_replace(' ', '', $nip);
		$kode = $this->m_rancak->kode_generator(15,'');
		$data_pendaftaran = array(
			'nik' => $kosong,
			'nip' => $nip,
			'email' =>$this->input->post('email'),
			'nama_pegawai' => $this->input->post('nama_pegawai'),
			'barcode_pegawai' => $kode,
			'id_unit' =>$this->input->post('id_unit'),
			'id_ruangan' =>$this->input->post('id_ruangan'),
			'tipe_pegawai' =>$this->input->post('tipe_pegawai'),
			'no_hp' =>$this->input->post('no_hp'),
			'no_profesi' => $kosong,
			'tmp_lahir' => $kosong,
			'tgl_lahir' => $tglkosong,
			'jk' =>$this->input->post('jk'),
			'id_status_kawin' =>$nol,
			'id_pendidikan' =>$nol,
			'id_jabatan_fungsional' =>$this->input->post('id_jabatan_fungsional'),
			'id_agama' =>$nol,
			'alamat' => $kosong,
			'foto' => ''
		);
		$this->db->insert('pegawai', $data_pendaftaran);
		return $this->db->insert_id();
	}
	function simpan_user($id,$kode){
		$username= $this->input->post('username');
		$username = strtolower($username);
		$username = str_replace(' ', '-', $username);
		$username = preg_replace('/[^A-Za-z0-9\-]/', '', $username);
		$password = hash("sha512", md5('7654321'));
		$ptn = "/^0/";  // Regex
		$str = $this->input->post('no_hp'); //Your input, perhaps $_POST['textbox'] or whatever
		$rpltxt = "62";  // Replacement string
		$no_hp = preg_replace($ptn, $rpltxt, $str);
		$data_pendaftaran = array(
			'id_pegawai' => $id,
			'username' => $username,
			'password' => $password,
			'barcode_user' => $kode,
			'id_level' => $this->input->post('id_level'),
			'status_user' => $this->input->post('status_user')
		);
		return $this->db->insert('user', $data_pendaftaran);
	}
	function edit_pegawai($pic){
		$id_pegawai = $this->input->post('id_pegawai');
		$data_pendaftaran = array(
			'email' =>$this->input->post('email'),
			'nama_pegawai' => $this->input->post('nama_pegawai'),
			'nip' => $this->input->post('nip'),
			'tipe_pegawai' => $this->input->post('tipe_pegawai'),
			'id_jabatan_fungsional' => $this->input->post('id_jabatan_fungsional'),
			'id_unit' =>$this->input->post('id_unit'),
			'id_ruangan' =>$this->input->post('id_ruangan'),
			'no_hp' =>$this->input->post('no_hp'),
			'jk' =>$this->input->post('jk'),
			'status_pegawai' => $this->input->post('status_user'),
			'foto' =>$pic
		);
		$this->db->where('id_pegawai',$id_pegawai);
		$this->db->update('pegawai', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function edit_pegawai_no_pic(){
		$id_pegawai = $this->input->post('id_pegawai');
		$data_pendaftaran = array(
			'email' =>$this->input->post('email'),
			'nama_pegawai' => $this->input->post('nama_pegawai'),
			'nip' => $this->input->post('nip'),
			'tipe_pegawai' => $this->input->post('tipe_pegawai'),
			'id_jabatan_fungsional' => $this->input->post('id_jabatan_fungsional'),
			'id_unit' =>$this->input->post('id_unit'),
			'id_ruangan' =>$this->input->post('id_ruangan'),
			'no_hp' =>$this->input->post('no_hp'),
			'status_pegawai' => $this->input->post('status_user'),
			'jk' =>$this->input->post('jk')
		);
		$this->db->where('id_pegawai',$id_pegawai);
		$this->db->update('pegawai', $data_pendaftaran);
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
		$username_lama = $this->input->post('username_lama');
		if($username==""){
			$username = $username_lama;
		}else{
			$username = strtolower($username);
			$username = str_replace(' ', '-', $username);
			$username = preg_replace('/[^A-Za-z0-9\-]/', '', $username);
		}
		$ptn = "/^0/";  // Regex
		$str = $this->input->post('no_user'); //Your input, perhaps $_POST['textbox'] or whatever
		$rpltxt = "62";  // Replacement string
		$no_user = preg_replace($ptn, $rpltxt, $str);
		$data_pendaftaran = array(
			'username' => $username,
			'id_level' => $this->input->post('id_level')
		);
		$this->db->where('id_user',$id_user);
		$this->db->update('user', $data_pendaftaran);
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
		$this->db->where('id_user',$id);
		$this->db->update('user', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function registrasi_all()
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
				//	 case 'no_hp' : $nmf="peg.no_hp";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('registrasi reg');
		$this->db->join('ruangan r', 'r.id_ruangan=reg.id_ruangan','left');
		$this->db->join('kol_status_pegawai ksp', 'ksp.id_status_pegawai=reg.tipe_pegawai','left');

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
					case 'no_hp' : $nmf="peg.no_hp";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('registrasi reg');
		$this->db->join('ruangan r', 'r.id_ruangan=reg.id_ruangan','left');
		$this->db->join('kol_status_pegawai ksp', 'ksp.id_status_pegawai=reg.tipe_pegawai','left');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('registrasi');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function ambil_registrasi($id){
		$q = $this->db->get_where('registrasi reg',array('id_registrasi'=>$id));
		return $q->row_array();
	}
// ================================================= CODE ==============================
	function kurs_all()
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
					 case 'id_ms_code'   : $nmf="kc.id_ms_code";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('keu_mata_uang kmu');

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
					case 'id_ms_code'   : $nmf="kc.id_ms_code";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('keu_mata_uang kmu');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('keu_mata_uang');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_mata_uang(){
		$data_pendaftaran = array(
			'nama_mata_uang' => $this->input->post('nama_mata_uang'),
			'kode_mata_uang' => $this->input->post('kode_mata_uang'),
			'simbol_mata_uang' => $this->input->post('simbol_mata_uang')
		);
		return $this->db->insert('keu_mata_uang', $data_pendaftaran);
	}
	function edit_mata_uang(){
		$id_mata_uang = $this->input->post('id_mata_uang');
		$data_pendaftaran = array(
			'nama_mata_uang' => $this->input->post('nama_mata_uang'),
			'kode_mata_uang' => $this->input->post('kode_mata_uang'),
			'simbol_mata_uang' => $this->input->post('simbol_mata_uang')
		);
		$this->db->where('id_mata_uang',$id_mata_uang);
		$this->db->update('keu_mata_uang', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
// ================================================= UNIT ==============================
	function unit_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,if(status_unit = '0' ,'TIDAK AKTIF','AKTIF') as status_unit";
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
					 case 'id_ms_code'   : $nmf="kc.id_ms_code";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('unit u');
		$this->db->join('struktur_jabatan sj', 'sj.id_struktur_jabatan=u.id_struktur_jabatan','left');

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
	    $this->db->from('unit u');
		$this->db->join('struktur_jabatan sj', 'sj.id_struktur_jabatan=u.id_struktur_jabatan','left');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('unit');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function ruangan_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,if(status_ruangan = '0' ,'TIDAK AKTIF','AKTIF') as status_ruangan";
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
					// case 'id_ms_code'   : $nmf="kc.id_ms_code";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ruangan r');
		$this->db->join('struktur_jabatan sj', 'sj.id_struktur_jabatan=r.id_struktur_jabatan','left');

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
	    $this->db->from('ruangan r');
		$this->db->join('struktur_jabatan sj', 'sj.id_struktur_jabatan=r.id_struktur_jabatan','left');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('ruangan');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_unit(){
		$data_pendaftaran = array(
			'nama_unit' => $this->input->post('nama_unit'),
			'status_unit' => $this->input->post('status_unit'),
			'id_struktur_jabatan' => $this->input->post('id_struktur_jabatan')
		);
		return $this->db->insert('unit', $data_pendaftaran);
	}
	function simpan_ruangan(){
		$data_pendaftaran = array(
			'nama_ruangan' => $this->input->post('nama_ruangan'),
			'status_ruangan' => $this->input->post('status_ruangan'),
			'id_struktur_jabatan' => $this->input->post('id_struktur_jabatan')
		);
		return $this->db->insert('ruangan', $data_pendaftaran);
	}
	function edit_ruangan(){
		$id_ruangan = $this->input->post('id_ruangan');
		$data_pendaftaran = array(
			'nama_ruangan' => $this->input->post('nama_ruangan'),
			'status_ruangan' => $this->input->post('status_ruangan'),
			'id_struktur_jabatan' => $this->input->post('id_struktur_jabatan')
		);
		$this->db->where('id_ruangan',$id_ruangan);
		$this->db->update('ruangan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function edit_unit(){
		$id_unit = $this->input->post('id_unit');
		$data_pendaftaran = array(
			'nama_unit' => $this->input->post('nama_unit'),
			'status_unit' => $this->input->post('status_unit'),
			'id_struktur_jabatan' => $this->input->post('id_struktur_jabatan')
		);
		$this->db->where('id_unit',$id_unit);
		$this->db->update('unit', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
// ================================================= CODE ==============================
	function code_all()
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
					 case 'id_ms_code'   : $nmf="kc.id_ms_code";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('keu_code kc');

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
	    $this->db->from('keu_code kc');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('keu_code');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_keu_code(){
		$data_pendaftaran = array(
			'nama_code' => $this->input->post('nama_code')
		);
		return $this->db->insert('keu_code', $data_pendaftaran);
	}
	function edit_keu_code(){
		$id_code = $this->input->post('id_code');
		$data_pendaftaran = array(
			'nama_code' => $this->input->post('nama_code')
		);
		$this->db->where('id_code',$id_code);
		$this->db->update('keu_code', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
// ================================================= CODE ==============================
	function coa_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "kc.nama_code,kcoa.id_coa,kcoa.nama_coa,kcoa.kode_coa,if(kcoa.status_coa = '0' ,'TIDAK AKTIF','AKTIF') as status_coa,
					kcoa2.nama_coa as coa";
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
					 case 'nama_coa' : $nmf="kcoa.nama_coa";break;
					 case 'kode_coa' : $nmf="kcoa.kode_coa";break;
					// case 'telp' : $nmf="peg.telp";break;
/* 					 case 'kode_coa'   : $nmf="kcoa.kode_coa";break;
					 case 'nama_coa'   : $nmf="kcoa.nama_coa";break; */
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('keu_coa kcoa');
		$this->db->join('keu_code kc', 'kc.id_code=kcoa.id_code','left');
		$this->db->join('keu_coa kcoa2', 'kcoa2.id_coa=kcoa.parent','left');

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
					 case 'nama_coa' : $nmf="kcoa.nama_coa";break;
					 case 'kode_coa' : $nmf="kcoa.kode_coa";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('keu_coa kcoa');
		$this->db->join('keu_code kc', 'kc.id_code=kcoa.id_code','left');
		$this->db->join('keu_coa kcoa2', 'kcoa2.parent=kcoa.id_coa','left');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('keu_coa');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_keu_coa(){
		$parent = $this->input->post('parent');
		if(empty($parent)){
			$parent = '0';
		}else{
			$parent = $this->input->post('parent');
		}
		$data_pendaftaran = array(
			'id_code' => $this->input->post('id_code'),
			'nama_coa' => $this->input->post('nama_coa'),
			'kode_coa' => $this->input->post('kode_coa'),
			'parent' => $parent,
			'protect' => 0,
			'status_coa' => $this->input->post('status_coa')
		);
		return $this->db->insert('keu_coa', $data_pendaftaran);
	}
	function edit_keu_coa(){
		$id_coa = $this->input->post('id_coa');
		$parent = $this->input->post('parent');
		if(empty($parent)){
			$parent = '0';
		}else{
			$parent = $this->input->post('parent');
		}
		$data_pendaftaran = array(
			'id_code' => $this->input->post('id_code'),
			'nama_coa' => $this->input->post('nama_coa'),
			'kode_coa' => $this->input->post('kode_coa'),
			'parent' => $parent,
			'status_coa' => $this->input->post('status_coa')
		);
		$this->db->where('id_coa',$id_coa);
		$this->db->update('keu_coa', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
// ================================================= D/K ==============================
	function dk_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,if (status_dk = '1' ,'AKTIF','NON AKTIF') as status_dk";
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

	    $this->db->from('keu_dk');

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
	    $this->db->from('keu_dk');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('keu_dk');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_keu_dk(){
		$data_pendaftaran = array(
			'dk' => $this->input->post('dk'),
			'nama_dk' => $this->input->post('nama_dk'),
			'status_dk' => $this->input->post('status_dk'),
			'no_dk' => $this->input->post('no_dk'),
			'alamat_dk' => $this->input->post('alamat_dk'),
			'kode_rekening' => $this->input->post('kode_rekening')
		);
		return $this->db->insert('keu_dk', $data_pendaftaran);
	}
	function edit_keu_dk(){
		$id_dk = $this->input->post('id_dk');
		$data_pendaftaran = array(
			'dk' => $this->input->post('dk'),
			'nama_dk' => $this->input->post('nama_dk'),
			'status_dk' => $this->input->post('status_dk'),
			'no_dk' => $this->input->post('no_dk'),
			'alamat_dk' => $this->input->post('alamat_dk'),
			'kode_rekening' => $this->input->post('kode_rekening')
		);
		$this->db->where('id_dk',$id_dk);
		$this->db->update('keu_dk', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
// ================================================= CODE ==============================
	function kategori_item_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,if (status_item_kategori = '1' ,'AKTIF','NON AKTIF') as status_item_kategori";
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

	    $this->db->from('keu_item_kategori kik');

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
	    $this->db->from('keu_item_kategori kik');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('keu_item_kategori');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_item_kategori(){
		$data_pendaftaran = array(
			'nama_item_kategori' => $this->input->post('nama_item_kategori'),
			'kode_item_kategori' => $this->input->post('kode_item_kategori'),
			'status_item_kategori' => $this->input->post('status_item_kategori')
		);
		return $this->db->insert('keu_item_kategori', $data_pendaftaran);
	}
	function edit_item_kategori(){
		$id_item_kategori = $this->input->post('id_item_kategori');
		$data_pendaftaran = array(
			'nama_item_kategori' => $this->input->post('nama_item_kategori'),
			'kode_item_kategori' => $this->input->post('kode_item_kategori'),
			'status_item_kategori' => $this->input->post('status_item_kategori')
		);
		$this->db->where('id_item_kategori',$id_item_kategori);
		$this->db->update('keu_item_kategori', $data_pendaftaran);
	//	echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
// ================================================= BARANG ==============================
	function item_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,if (jenis_barang = '1' ,'PERSEDIAAN','JASA') as jenis_barang";
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

	    $this->db->from('keu_barang kb');
		$this->db->join('keu_item_kategori kik', 'kik.id_item_kategori=kb.id_item_kategori','left');
		$this->db->join('unit u', 'u.id_unit=kb.id_unit','left');

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
	    $this->db->from('keu_barang kb');
		$this->db->join('keu_item_kategori kik', 'kik.id_item_kategori=kb.id_item_kategori','left');
		$this->db->join('unit u', 'u.id_unit=kb.id_unit','left');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('keu_barang');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_barang(){
		$data_pendaftaran = array(
			'jenis_barang' => $this->input->post('jenis_barang'),
			'id_item_kategori' => $this->input->post('id_item_kategori'),
			'nama_barang' => $this->input->post('nama_barang'),
			'barcode_barang' => $this->input->post('barcode_barang'),
			'id_unit' => $this->input->post('id_unit'),
			'kode_barang' => $this->input->post('kode_barang')
		);
		$this->db->insert('keu_barang', $data_pendaftaran);
		return $this->db->insert_id();
	}
	function edit_barang(){
		$id_barang = $this->input->post('id_barang');
		$data_pendaftaran = array(
			'jenis_barang' => $this->input->post('jenis_barang'),
			'id_item_kategori' => $this->input->post('id_item_kategori'),
			'nama_barang' => $this->input->post('nama_barang'),
			'barcode_barang' => $this->input->post('barcode_barang'),
			'id_unit' => $this->input->post('id_unit'),
			'kode_barang' => $this->input->post('kode_barang')
		);
		$this->db->where('id_barang',$id_barang);
		$this->db->update('keu_barang', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
// ================================================= TERMIN ==============================
	function termin_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,if (status_termin = '1' ,'AKTIF','NON AKTIF') as status_termin";
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

	    $this->db->from('kol_termin kt');

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
	    $this->db->from('kol_termin kt');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('kol_termin');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_termin(){
		$data_pendaftaran = array(
			'nama_termin' => $this->input->post('nama_termin'),
			'tempo_termin' => $this->input->post('tempo_termin'),
			'ket_termin' => $this->input->post('ket_termin'),
			'status_termin' => $this->input->post('status_termin')
		);
		$this->db->insert('kol_termin', $data_pendaftaran);
		return $this->db->insert_id();
	}
	function edit_termin(){
		$id_termin = $this->input->post('id_termin');
		$data_pendaftaran = array(
			'nama_termin' => $this->input->post('nama_termin'),
			'tempo_termin' => $this->input->post('tempo_termin'),
			'ket_termin' => $this->input->post('ket_termin'),
			'status_termin' => $this->input->post('status_termin')
		);
		$this->db->where('id_termin',$id_termin);
		$this->db->update('kol_termin', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function download_all()
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


			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('download');

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

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('download');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('download');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_download($id,$id_level){
		$chk = $this->input->post('chk[]');
		if (empty($chk)) {
		   $id_jabatan = "";
		}else{
			$id_jabatan = implode(",",$chk);
		}
		$data_kewenangan = array(
			'nama_download' => $this->input->post('nama_download'),
			'id_level' => $id_level,
			'id_jabatan' => $id_jabatan,
			'link_download' => $id,
			'status_download' =>$this->input->post('status_download')

		);
		return $this->db->insert('download', $data_kewenangan);
	}
	function edit_download($id,$id_level){
		$id_download = $this->input->post('id_download');
		$chk = $this->input->post('chk[]');
		if (empty($chk)) {
		   $id_jabatan = "";
		}else{
			$id_jabatan = implode(",",$chk);
		}
		$data_pendaftaran = array(
			'nama_download' => $this->input->post('nama_download'),
			'id_level' => $id_level,
			'id_jabatan' => $id_jabatan,
			'link_download' => $id,
			'status_download' =>$this->input->post('status_download')
		);
		$this->db->where('id_download',$id_download);
		$this->db->update('download', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	public function ambil_faq(){
		$this->load->library('pagination'); // Load librari paginationnya

		$this->db->select("COUNT(*) as num");
	    $this->db->from('faq');
	//	$this->db->join('pegawai peg', 'peg.id_pegawai=pj.id_pegawai','left');
		$this->db->where('status_faq','1');
		$q = $this->db->get_where();
		$jml_filter = $q->row()->num;

		$config['base_url'] = base_url('web/faq');
		$config['total_rows'] = $jml_filter;
		$config['per_page'] = 10;
		$config['uri_segment'] = 3;
		$config['num_links'] = 3;

		// Style Pagination
		// Agar bisa mengganti stylenya sesuai class2 yg ada di bootstrap
		$config['full_tag_open']   = '<div class="b-pagination-outer"><ul id="border-pagination">';
        $config['full_tag_close']  = '</ul></div>';

        $config['first_link']      = 'Awal';
        $config['first_tag_open']  = '<li>';
        $config['first_tag_close'] = '</li>';

        $config['last_link']       = 'Akhir';
        $config['last_tag_open']   = '<li>';
        $config['last_tag_close']  = '</li>';

        $config['next_link']       = '&nbsp;Selanjutnya</i>&nbsp;';
        $config['next_tag_open']   = '<li>';
        $config['next_tag_close']  = '</li>';

        $config['prev_link']       = '&nbsp;Sebelumnya&nbsp;';
        $config['prev_tag_open']   = '<li>';
        $config['prev_tag_close']  = '</li>';

        $config['cur_tag_open']    = '<li class="active"><a href="#">';
        $config['cur_tag_close']   = '</a></li>';

        $config['num_tag_open']    = '<li>';
        $config['num_tag_close']   = '</li>';
        // End style pagination

		$this->pagination->initialize($config); // Set konfigurasi paginationnya

		$page = ($this->uri->segment($config['uri_segment'])) ? $this->uri->segment($config['uri_segment']) : 0;
		$fields = "
		*
		";
		$this->db->select($fields);
	//	$this->db->join('pegawai peg', 'peg.id_pegawai=pj.id_pegawai','left');
		$this->db->where('status_faq','1');
		$this->db->order_by('id_faq', 'asc');
	//	$this->db->order_by('id_faq', 'RANDOM');
		$this->db->limit($config['per_page'],$page);
		$q = $this->db->get_where('faq');

		$data['limit'] = $config['per_page'];
		$data['total_rows'] = $config['total_rows'];
		$data['pagination'] = $this->pagination->create_links(); // Generate link pagination nya sesuai config diatas
		$data['faq'] = $q->result_array();
		return $data;
	}
	function logbook(){
		$this->db->select("DATE_FORMAT(logbook.tgl_logbook,'%Y') as tgl_logbook");
		$this->db->join('kr_kewenangan_detil', 'kr_kewenangan_detil.id_kewenangan_detil=logbook.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan', 'kr_kewenangan.id_kewenangan=kr_kewenangan_detil.id_kewenangan','left');
		$this->db->join('kr_kompetensi', 'kr_kompetensi.id_kompetensi=kr_kewenangan.id_kompetensi','left');
		$this->db->where('year(logbook.tgl_logbook) >=', date('Y-m-d', strtotime('-5 years')));
		$this->db->group_by("year(logbook.tgl_logbook)");
		$q = $this->db->get('logbook')->result_array();
	//	echo $this->db->last_query();die();
		return $q;
	}
	function logbook2($thn){
		$this->db->select("kr_kompetensi.id_kompetensi,SUM(logbook.jml_logbook) as jml_logbook");
		$this->db->join('kr_kewenangan_detil', 'kr_kewenangan_detil.id_kewenangan_detil=logbook.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan', 'kr_kewenangan.id_kewenangan=kr_kewenangan_detil.id_kewenangan','left');
		$this->db->join('kr_kompetensi', 'kr_kompetensi.id_kompetensi=kr_kewenangan.id_kompetensi','left');
		$this->db->where('year(logbook.tgl_logbook)', $thn);
//		$this->db->where('year(logbook.tgl_logbook) >=', date('Y-m-d', strtotime('-1 years')));
		$this->db->group_by("kr_kompetensi.id_kompetensi");
		$q = $this->db->get('logbook')->result_array();
	//	echo $this->db->last_query();die();
		return $q;
	}
	function jumlah_record_kompetensi_logbook($thn,$id)
	{
		$this->db->join('kr_kewenangan_detil', 'kr_kewenangan_detil.id_kewenangan_detil=logbook.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan', 'kr_kewenangan.id_kewenangan=kr_kewenangan_detil.id_kewenangan','left');
		$this->db->join('kr_kompetensi', 'kr_kompetensi.id_kompetensi=kr_kewenangan.id_kompetensi','left');
		$this->db->join('jabatan', 'jabatan.id_jabatan=kr_kompetensi.id_jabatan','left');
		$this->db->where('year(logbook.tgl_logbook)', $thn);
		$this->db->where('kr_kompetensi.id_kompetensi', $id);
			$query = $this->db->select("COUNT(*) as num")->get_where('logbook');
			$result = $query->row();
			if(isset($result))
					return $result->num;
			return 0;
	}
	function tbl_kompetensi($thn){
		$this->db->select("*,SUM(logbook.jml_logbook) as jml_logbook");
		$this->db->join('kr_kewenangan_detil', 'kr_kewenangan_detil.id_kewenangan_detil=logbook.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan', 'kr_kewenangan.id_kewenangan=kr_kewenangan_detil.id_kewenangan','left');
		$this->db->join('kr_kompetensi', 'kr_kompetensi.id_kompetensi=kr_kewenangan.id_kompetensi','left');
		$this->db->join('jabatan', 'jabatan.id_jabatan=kr_kompetensi.id_jabatan','left');
		$this->db->where('year(logbook.tgl_logbook)', $thn);
//		$this->db->where('year(logbook.tgl_logbook) >=', date('Y-m-d', strtotime('-1 years')));
		$this->db->order_by("jml_logbook",'desc');
		$this->db->group_by("kr_kompetensi.id_kompetensi");
		$q = $this->db->get('logbook')->result_array();
	//	echo $this->db->last_query();die();
		return $q;
	}
	function hak_akses_all($id)
	{
	//	$ids = explode(',', $akses);
	//--------- Ambil nama kolom --------- [coding here] .jpg
	$fields = "*,if(status_pegawai_akses = '0' ,'NON AKTIF','AKTIF') as status_pegawai_akses
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
				$this->db->where('pak.id_pegawai',$id);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	$this->db->from('pegawai_akses pak');
	$this->db->join('akses ak','ak.id_akses=pak.id_akses','left');
	$this->db->join('pegawai peg','peg.id_pegawai=pak.id_pegawai','left');
	$this->db->where('pak.id_pegawai',$id);

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
				$this->db->where('pak.id_pegawai',$id);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	$this->db->from('pegawai_akses pak');
	$this->db->join('akses ak','ak.id_akses=pak.id_akses','left');
	$this->db->join('pegawai peg','peg.id_pegawai=pak.id_pegawai','left');
	$this->db->where('pak.id_pegawai',$id);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----

		$jml = $this->m_umum->jumlah_record_tabel('pegawai_akses');			//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
	//	 print_r($output);die();
		return $output;
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
				$q = $this->db->get('pegawai_akses')->row();
				$jml = $q->num;
				if($jml == 0){
					$data_pendaftaran = array(
						'id_akses' => $chk[$i],
						'id_pegawai' => $id_pegawai,
						'status_pegawai_akses' => 1
					);
					$this->db->insert('pegawai_akses', $data_pendaftaran);
				}
			}
		}
	}
	function status_pegawai_akses($int,$id){
		$data_pendaftaran = array(
			'status_pegawai_akses' => $int
		);
		$this->db->where('id_pegawai_akses',$id);
		$this->db->update('pegawai_akses', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
}
