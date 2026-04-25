<?php
class M_profil extends CI_model{
	function cmd_jabfung(){
		$this->db->select("id_jabatan_fungsional,nama_jabatan_fungsional");
		if($this->session->id_level !=='99'){$this->db->where('id_jabatan', $this->session->id_jabatan);}		
		$q = $this->db->get_where('jabatan_fungsional');
		return $q->result_array();
	}
	function tlh($id){
		$awal	= date('Y').'-'.date('m').'-01';
		$akhir = date('t', strtotime($awal));
		$first_date = '01-'.date('m').'-'.date('Y');
		$last_date = $akhir.'-'.date('m').'-'.date('Y');
		$this->db->select("DATE_FORMAT(ld.tgl_logbook,'%d-%m-%Y') as tgl_logbook,sum(jml_logbook) as jml_logbook");
		$this->db->where('id_pegawai', $id);
		$this->db->where('tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$this->db->group_by("tgl_logbook");
		$q = $this->db->get('logbook ld')->result_array();
		//echo $this->db->last_query();die();
		return $q;
	}
	function edit_pegawai($pic){
		$id_pegawai = $this->input->post('id_pegawai');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$tgl_lahir = date('Y-m-d', strtotime($tgl_lahir));
		$data_pendaftaran = array(
			'email' =>$this->input->post('email'),
			'nama_pegawai' => $this->input->post('nama_pegawai'),
			'id_unit' =>$this->input->post('id_unit'),
			'id_ruangan' =>$this->input->post('id_ruangan'),
			'tipe_pegawai' =>$this->input->post('tipe_pegawai'),
			'no_hp' =>$this->input->post('no_hp'),
			'jk' =>$this->input->post('jk'),
			'nik' => $this->input->post('nik'),
			'nip' => $this->input->post('nip'),
			'no_profesi' => $this->input->post('no_profesi'),
			'tmp_lahir' => $this->input->post('tmp_lahir'),
			'tgl_lahir' => $tgl_lahir,
			'id_status_kawin' => $this->input->post('id_status_kawin'),
			'id_pengcab' => $this->input->post('id_pengcab'),
			'id_prov' => $this->input->post('id_prov'),
			'id_kab' => $this->input->post('id_kab'),
			'id_kec' => $this->input->post('id_kec'),
			'id_kel' => $this->input->post('id_kel'),
			'id_pendidikan' => $this->input->post('id_pendidikan'),
			'id_jabatan_fungsional' => $this->input->post('id_jabatan_fungsional'),
			'id_agama' => $this->input->post('id_agama'),
			'alamat' => $this->input->post('alamat'),
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
		$tgl_lahir = $this->input->post('tgl_lahir');
		$tgl_lahir = date('Y-m-d', strtotime($tgl_lahir));
		$data_pendaftaran = array(
			'email' =>$this->input->post('email'),
			'nama_pegawai' => $this->input->post('nama_pegawai'),
			'id_unit' =>$this->input->post('id_unit'),
			'id_ruangan' =>$this->input->post('id_ruangan'),
			'tipe_pegawai' =>$this->input->post('tipe_pegawai'),
			'no_hp' =>$this->input->post('no_hp'),
			'jk' =>$this->input->post('jk'),
			'nik' => $this->input->post('nik'),
			'nip' => $this->input->post('nip'),
			'no_profesi' => $this->input->post('no_profesi'),
			'tmp_lahir' => $this->input->post('tmp_lahir'),
			'tgl_lahir' => $tgl_lahir,
			'id_status_kawin' => $this->input->post('id_status_kawin'),
			'id_pengcab' => $this->input->post('id_pengcab'),
			'id_prov' => $this->input->post('id_prov'),
			'id_kab' => $this->input->post('id_kab'),
			'id_kec' => $this->input->post('id_kec'),
			'id_kel' => $this->input->post('id_kel'),
			'id_pendidikan' => $this->input->post('id_pendidikan'),
			'id_jabatan_fungsional' => $this->input->post('id_jabatan_fungsional'),
			'id_agama' => $this->input->post('id_agama'),
			'alamat' => $this->input->post('alamat')
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
		$password = $this->input->post('password');
		$passlama = $this->input->post('password_lama');
		if($password==""){
			$passworde = $passlama;
		}else{
			$passworde = hash("sha512", md5($password));
		}
		$ptn = "/^0/";  // Regex
		$str = $this->input->post('no_user'); //Your input, perhaps $_POST['textbox'] or whatever
		$rpltxt = "62";  // Replacement string
		$no_user = preg_replace($ptn, $rpltxt, $str);
		$data_pendaftaran = array(
			'username' => $username,
			'password' => $passworde
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
	function simpan_berkas_ijin($id){
		$tgl_a_berkas = $this->input->post('tgl_a_berkas');
		$tgl_a_berkas = date('Y-m-d', strtotime($tgl_a_berkas));
		$tgl_b_berkas = $this->input->post('tgl_b_berkas');
		$tgl_b_berkas = date('Y-m-d', strtotime($tgl_b_berkas));
		$kosong = "";
		$nol = "0";
		$tgl_null = "0000-00-00";
		$data_kewenangan = array(
			'id_pegawai' => $this->input->post('id_pegawai'),
			'nama_berkas' => $this->input->post('nama_berkas'),
			'id_kategori_berkas' => $this->input->post('id_kategori_berkas'),
			'tgl_a_berkas' => $tgl_a_berkas,
			'tgl_b_berkas' => $tgl_b_berkas,
			'tgl_kelulusan' => $tgl_null,
			'penyelenggara' => $kosong,
			'kredit' => $nol,
			'no_berkas' => $this->input->post('no_berkas'),
			'no_sertifikat' => $kosong,
			'link_berkas' => $id,
			'id_pendidikan' => $nol,
			'id_kategori_pelatihan' => $nol,
			'status_berkas' => 1

		);
		return $this->db->insert('berkas', $data_kewenangan);
	}
	function edit_berkas_ijin(){
		$tgl_a_berkas = $this->input->post('tgl_a_berkas');
		$tgl_a_berkas = date('Y-m-d', strtotime($tgl_a_berkas));
		$tgl_b_berkas = $this->input->post('tgl_b_berkas');
		$tgl_b_berkas = date('Y-m-d', strtotime($tgl_b_berkas));
		$id_berkas = $this->input->post('id_berkas');
		$data_pendaftaran = array(
			'nama_berkas' => $this->input->post('nama_berkas'),
			'tgl_a_berkas' => $tgl_a_berkas,
			'tgl_b_berkas' => $tgl_b_berkas,
			'no_berkas' => $this->input->post('no_berkas')
		);
		$this->db->where('id_berkas',$id_berkas);
		$this->db->update('berkas', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function simpan_berkas_file($id){
		$kosong = "";
		$nol = "0";
		$tgl_null = "0000-00-00";
		$data_kewenangan = array(
			'id_pegawai' => $this->input->post('id_pegawai'),
			'nama_berkas' => $this->input->post('nama_berkas'),
			'id_kategori_berkas' => $this->input->post('id_kategori_berkas'),
			'tgl_a_berkas' => $tgl_null,
			'tgl_b_berkas' => $tgl_null,
			'tgl_kelulusan' => $tgl_null,
			'penyelenggara' => $kosong,
			'kredit' => $nol,
			'no_berkas' => $this->input->post('no_berkas'),
			'no_sertifikat' => $kosong,
			'link_berkas' => $id,
			'id_pendidikan' => $nol,
			'id_kategori_pelatihan' => $nol,
			'status_berkas' => 1

		);
		return $this->db->insert('berkas', $data_kewenangan);
	}
	function edit_berkas_file(){
		$id_berkas = $this->input->post('id_berkas');
		$data_pendaftaran = array(
			'nama_berkas' => $this->input->post('nama_berkas'),
			'id_kategori_berkas' => $this->input->post('id_kategori_berkas'),
			'no_berkas' => $this->input->post('no_berkas'),
		);
		$this->db->where('id_berkas',$id_berkas);
		$this->db->update('berkas', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function simpan_berkas_file_ijasah($id){
		$tgl_b_berkas = $this->input->post('tgl_b_berkas');
		$tgl_b_berkas = date('Y-m-d', strtotime($tgl_b_berkas));
		$kosong = "";
		$nol = "0";
		$tgl_null = "0000-00-00";
		$data_kewenangan = array(
			'id_pegawai' => $this->input->post('id_pegawai'),
			'nama_berkas' => $this->input->post('nama_berkas'),
			'id_kategori_berkas' => 7,
			'tgl_a_berkas' => $tgl_null,
			'tgl_b_berkas' => $tgl_b_berkas,
			'tgl_kelulusan' => $tgl_null,
			'penyelenggara' => $kosong,
			'kredit' => $nol,
			'no_berkas' => $this->input->post('no_berkas'),
			'no_sertifikat' => $kosong,
			'link_berkas' => $id,
			'id_pendidikan' =>$this->input->post('id_pendidikan'),
			'id_kategori_pelatihan' => $nol,
			'status_berkas' => 1

		);
		return $this->db->insert('berkas', $data_kewenangan);
	}
	function edit_berkas_ijasah(){
		$id_berkas = $this->input->post('id_berkas');
		$tgl_b_berkas = $this->input->post('tgl_b_berkas');
		$tgl_b_berkas = date('Y-m-d', strtotime($tgl_b_berkas));
		$data_pendaftaran = array(
			'nama_berkas' => $this->input->post('nama_berkas'),
			'id_pendidikan' => $this->input->post('id_pendidikan'),
			'no_berkas' => $this->input->post('no_berkas'),
			'tgl_b_berkas' => $tgl_b_berkas
		);
		$this->db->where('id_berkas',$id_berkas);
		$this->db->update('berkas', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function simpan_berkas_file_pelatihan($id){
		$tgl_a_berkas = $this->input->post('tgl_a_berkas');
		$tgl_a_berkas = date('Y-m-d', strtotime($tgl_a_berkas));
		$tgl_b_berkas = $this->input->post('tgl_b_berkas');
		$tgl_b_berkas = date('Y-m-d', strtotime($tgl_b_berkas));
		$kosong = "";
		$nol = "0";
		$tgl_null = "0000-00-00";
		$data_kewenangan = array(
			'id_pegawai' => $this->input->post('id_pegawai'),
			'nama_berkas' => $this->input->post('nama_berkas'),
			'id_kategori_berkas' => $this->input->post('id_kategori_berkas'),
			'tgl_a_berkas' => $tgl_a_berkas,
			'tgl_b_berkas' => $tgl_b_berkas,
			'tgl_kelulusan' => $tgl_null,
			'penyelenggara' => $this->input->post('penyelenggara'),
			'kredit' => $this->input->post('kredit'),
			'no_berkas' => $kosong,
			'no_sertifikat' => $this->input->post('no_sertifikat'),
			'link_berkas' => $id,
			'id_pendidikan' => $nol,
			'id_kategori_pelatihan' =>$this->input->post('id_kategori_pelatihan'),
			'status_berkas' => 1

		);
		return $this->db->insert('berkas', $data_kewenangan);
	}
	function edit_berkas_pelatihan(){
		$tgl_a_berkas = $this->input->post('tgl_a_berkas');
		$tgl_a_berkas = date('Y-m-d', strtotime($tgl_a_berkas));
		$tgl_b_berkas = $this->input->post('tgl_b_berkas');
		$tgl_b_berkas = date('Y-m-d', strtotime($tgl_b_berkas));
		$id_berkas = $this->input->post('id_berkas');
		$data_pendaftaran = array(
			'nama_berkas' => $this->input->post('nama_berkas'),
			'id_kategori_berkas' => $this->input->post('id_kategori_berkas'),
			'tgl_a_berkas' => $tgl_a_berkas,
			'tgl_b_berkas' => $tgl_b_berkas,
			'penyelenggara' => $this->input->post('penyelenggara'),
			'kredit' => $this->input->post('kredit'),
			'no_sertifikat' => $this->input->post('no_sertifikat'),
			'id_kategori_pelatihan' =>$this->input->post('id_kategori_pelatihan')
		);
		$this->db->where('id_berkas',$id_berkas);
		$this->db->update('berkas', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function perpanjangan_str(){
		$id_berkas = $this->input->post('id_berkas');
		$data_pendaftaran = array(
			'status_berkas' => 0
		);
		$this->db->where('id_berkas',$id_berkas);
		$this->db->update('berkas', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function ijasah_all($id)
	{
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,
					if (b.tgl_kelulusan = '0000-00-00' ,'TIDAK ADA',DATE_FORMAT(b.tgl_kelulusan,'%d-%m-%Y')) as tgl_kelulusan,
					if (b.tgl_a_berkas = '0000-00-00' ,'TIDAK ADA',DATE_FORMAT(b.tgl_a_berkas,'%d-%m-%Y')) as tgl_a_berkas,
					if (b.tgl_b_berkas = '0000-00-00' ,'TIDAK ADA',DATE_FORMAT(b.tgl_b_berkas,'%d-%m-%Y')) as tgl_b_berkas
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
		$this->db->where("b.id_kategori_berkas", 7);
		$this->db->where("b.id_pegawai", $id);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('berkas b');
		$this->db->join('kol_kategori_berkas kb', 'kb.id_kategori_berkas=b.id_kategori_berkas','left');
		$this->db->join('kol_pendidikan kp', 'kp.id_pendidikan=b.id_pendidikan','left');
		$this->db->where("b.id_kategori_berkas", 7);
		$this->db->where("b.id_pegawai", $id);

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
		$this->db->where("b.id_kategori_berkas", 7);
		$this->db->where("b.id_pegawai", $id);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('berkas b');
		$this->db->join('kol_kategori_berkas kb', 'kb.id_kategori_berkas=b.id_kategori_berkas','left');
		$this->db->join('kol_pendidikan kp', 'kp.id_pendidikan=b.id_pendidikan','left');
		$this->db->where("b.id_kategori_berkas", 7);
		$this->db->where("b.id_pegawai", $id);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99');
		$jml = $this->m_umum->jumlah_record_filter('pegawai',$kondisi);	 */
		$jml = $this->m_umum->jumlah_record_tabel('berkas');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function berkas_pribadi_all($id)
	{
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,
					if (b.tgl_kelulusan = '0000-00-00' ,'TIDAK ADA',DATE_FORMAT(b.tgl_kelulusan,'%d-%m-%Y')) as tgl_kelulusan,
					if (b.tgl_a_berkas = '0000-00-00' ,'TIDAK ADA',DATE_FORMAT(b.tgl_a_berkas,'%d-%m-%Y')) as tgl_a_berkas,
					if (b.tgl_b_berkas = '0000-00-00' ,'TIDAK ADA',DATE_FORMAT(b.tgl_b_berkas,'%d-%m-%Y')) as tgl_b_berkas
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
		$this->db->where("b.id_kategori_berkas >", 9);
		$this->db->where("b.id_pegawai", $id);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('berkas b');
		$this->db->join('kol_kategori_berkas kb', 'kb.id_kategori_berkas=b.id_kategori_berkas','left');
		$this->db->where("b.id_kategori_berkas >", 9);
		$this->db->where("b.id_pegawai", $id);

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
		$this->db->where("b.id_kategori_berkas >", 9);
		$this->db->where("b.id_pegawai", $id);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('berkas b');
		$this->db->join('kol_kategori_berkas kb', 'kb.id_kategori_berkas=b.id_kategori_berkas','left');
		$this->db->where("b.id_kategori_berkas >", 9);
		$this->db->where("b.id_pegawai", $id);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99');
		$jml = $this->m_umum->jumlah_record_filter('pegawai',$kondisi);	 */
		$jml = $this->m_umum->jumlah_record_tabel('berkas');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function pelatihan_all($id)
	{
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,
					if (b.tgl_kelulusan = '0000-00-00' ,'TIDAK ADA',DATE_FORMAT(b.tgl_kelulusan,'%d-%m-%Y')) as tgl_kelulusan,
					if (b.tgl_a_berkas = '0000-00-00' ,'TIDAK ADA',DATE_FORMAT(b.tgl_a_berkas,'%d-%m-%Y')) as tgl_a_berkas,
					if (b.tgl_b_berkas = '0000-00-00' ,'TIDAK ADA',DATE_FORMAT(b.tgl_b_berkas,'%d-%m-%Y')) as tgl_b_berkas
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
		$this->db->where("kunci", 1);
		$this->db->where("b.id_pegawai", $id);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('berkas b');
		$this->db->join('kol_kategori_berkas kb', 'kb.id_kategori_berkas=b.id_kategori_berkas','left');
		$this->db->join('kol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=b.id_kategori_pelatihan','left');
		$this->db->where("kunci", 1);
		$this->db->where("b.id_pegawai", $id);

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
		$this->db->where("kunci", 1);
		$this->db->where("b.id_pegawai", $id);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('berkas b');
		$this->db->join('kol_kategori_berkas kb', 'kb.id_kategori_berkas=b.id_kategori_berkas','left');
		$this->db->join('kol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=b.id_kategori_pelatihan','left');
		$this->db->where("kunci", 1);
		$this->db->where("b.id_pegawai", $id);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99');
		$jml = $this->m_umum->jumlah_record_filter('pegawai',$kondisi);	 */
		$jml = $this->m_umum->jumlah_record_tabel('berkas');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function str_all($id)
	{
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,if(b.status_berkas = '1' ,'AKTIF','NON AKTIF') as status_berkas,
					if (b.tgl_kelulusan = '0000-00-00' ,'TIDAK ADA',DATE_FORMAT(b.tgl_kelulusan,'%d-%m-%Y')) as tgl_kelulusan,
					if (b.tgl_a_berkas = '0000-00-00' ,'TIDAK ADA',DATE_FORMAT(b.tgl_a_berkas,'%d-%m-%Y')) as tgl_a_berkas,
					if (b.tgl_b_berkas = '0000-00-00' ,'TIDAK ADA',DATE_FORMAT(b.tgl_b_berkas,'%d-%m-%Y')) as tgl_b_berkas
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
		$this->db->where("kunci", 0);
		$this->db->where("b.id_pegawai", $id);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('berkas b');
		$this->db->join('kol_kategori_berkas kb', 'kb.id_kategori_berkas=b.id_kategori_berkas','left');
		$this->db->join('kol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=b.id_kategori_pelatihan','left');
		$this->db->where("kunci", 0);
		$this->db->where("b.id_pegawai", $id);

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
		$this->db->where("kunci", 0);
		$this->db->where("b.id_pegawai", $id);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('berkas b');
		$this->db->join('kol_kategori_berkas kb', 'kb.id_kategori_berkas=b.id_kategori_berkas','left');
		$this->db->join('kol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=b.id_kategori_pelatihan','left');
		$this->db->where("kunci", 0);
		$this->db->where("b.id_pegawai", $id);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99');
		$jml = $this->m_umum->jumlah_record_filter('pegawai',$kondisi);	 */
		$jml = $this->m_umum->jumlah_record_tabel('berkas');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function logbook_all($first_date,$last_date,$id)
	{
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,
					DATE_FORMAT(lp.tgl_logbook,'%d-%m-%Y') as tgl_logbook,
					DATE_FORMAT(lp.tgl_v_karu,'%d-%m-%Y') as tgl_v_karu,
					DATE_FORMAT(lp.tgl_v_kabid,'%d-%m-%Y') as tgl_v_kabid,
					DATE_FORMAT(lp.tgl_v_komite,'%d-%m-%Y') as tgl_v_komite,
					DATE_FORMAT(lp.tgl_v_asesor,'%d-%m-%Y') as tgl_v_asesor,
					DATE_FORMAT(lp.tgl_v_direktur,'%d-%m-%Y') as tgl_v_direktur,
					if(lp.v_karu = '0' ,'Proses',if(lp.v_karu = '1' ,'Kompeten','Ditolak')) as v_karu,
					if(lp.v_kabid = '0' ,'Proses',if(lp.v_kabid = '1' ,'Kompeten','Ditolak')) as v_kabid,
					if(lp.v_asesor = '0' ,'Proses',if(lp.v_asesor = '1' ,'Kompeten','Ditolak')) as v_asesor,
					if(lp.v_komite = '0' ,'Proses',if(lp.v_komite = '1' ,'Kompeten','Ditolak')) as v_komite,
					if(lp.v_direktur = '0' ,'Proses',if(lp.v_direktur = '1' ,'Kompeten','Ditolak')) as v_direktur
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
		$this->db->where("lp.id_pegawai", $id);
		$this->db->where('lp.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('logbook lp');
		$this->db->join('pegawai peg', 'peg.id_pegawai=lp.id_pegawai','left');
		$this->db->join('kr_kewenangan_detil kd', 'kd.id_kewenangan_detil=lp.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan krw', 'krw.id_kewenangan=kd.id_kewenangan','left');
		$this->db->join('kol_kode_kewenangan kw', 'kw.id_kode_kewenangan=kd.id_kode_kewenangan','left');
		$this->db->where("lp.id_pegawai", $id);
		$this->db->where('lp.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');

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
		$this->db->where("lp.id_pegawai", $id);
		$this->db->where('lp.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('logbook lp');
		$this->db->join('pegawai peg', 'peg.id_pegawai=lp.id_pegawai','left');
		$this->db->join('kr_kewenangan_detil kd', 'kd.id_kewenangan_detil=lp.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan krw', 'krw.id_kewenangan=kd.id_kewenangan','left');
		$this->db->join('kol_kode_kewenangan kw', 'kw.id_kode_kewenangan=kd.id_kode_kewenangan','left');
		$this->db->where("lp.id_pegawai", $id);
		$this->db->where('lp.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99');
		$jml = $this->m_umum->jumlah_record_filter('pegawai',$kondisi);	 */
		$jml = $this->m_umum->jumlah_record_tabel('logbook');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_logbook0(){
		$id_kewenangan_detil = $this->input->post('id_kewenangan_detil[]');
		$id_kewenangan = $this->input->post('id_kewenangan[]');
		$id_pegawai = $_SESSION['id_pegawai'];
		$jml_logbook = $this->input->post('jml_logbook[]');
		$rm = $this->input->post('rm[]');
		$tgl_logbook = $this->input->post('tgl_logbook');
		$tgl_logbook = date('Y-m-d', strtotime($tgl_logbook));
		$jml_kode = count($id_kewenangan_detil);
		for ($i=0;$i<$jml_kode;$i++){
			$this->db->select("COUNT(*) as num");
			$this->db->where('id_pegawai',$id_pegawai);
			$this->db->where('tgl_logbook',$tgl_logbook);
			$this->db->where('id_kewenangan_detil',$id_kewenangan_detil[$i]);
			$q = $this->db->get('logbook_pegawai')->row();
			$jml = $q->num;
			if($jml == 0){
				$Q = $this->simpan_logbook_final($id_kewenangan_detil[$i],$jml_logbook[$i],$rm[$i],$id_kewenangan[$i],$tgl_logbook,$id_pegawai);
			}
		}
	}
	function simpan_logbook(){
		$id_kewenangan_detil = $this->input->post('id_kewenangan_detil[]');
		$id_pegawai = $this->input->post('id_pegawai');
		$jml_logbook = $this->input->post('jml_logbook[]');
		$id_kewenangan = $this->input->post('id_kewenangan[]');
	//	$jml_logbook = $this->db->escape_str($this->input->post('jml_logbook'));
		$rm = $this->input->post('rm[]');
	//	$rm = $this->db->escape_str($this->input->post('rm'));
		$tgl_logbook = $this->input->post('tgl_logbook');
		$tgl_logbook = date('Y-m-d', strtotime($tgl_logbook));
		$jml_kode = count($id_kewenangan_detil);
		for ($i=0;$i<$jml_kode;$i++){
				$Q = $this->simpan_logbook_final($id_kewenangan_detil[$i],$jml_logbook[$i],$rm[$i],$id_kewenangan[$i],$tgl_logbook,$id_pegawai);
			}
	}
	function cek_jabatan_untuk_simpan_logbook($id){
//		$this->db->select('j.validate');
//		$this->db->join('kr_kompetensi kk', 'kk.id_kompetensi=kke.id_kompetensi','left');
//		$this->db->join('jabatan j', 'j.id_jabatan=kk.id_jabatan','left');
//		$q = $this->db->get_where('kr_kewenangan kke',array('id_kewenangan'=>$id));
		$q = $this->db->get_where('jabatan',array('id_jabatan'=>$id));
		return $q->row_array();
	}
	function simpan_logbook_final($id_kewenangan_detil,$jml_logbook,$rm,$id_kewenangan,$Skr,$id_pegawai){
		$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
		$tgl_std = "0000-00-00";
		$time_std = date("H:i:s");
		if($jml_logbook == '0' OR empty($jml_logbook)){
			$jml_logbook = '1';
		}
		$KosonG = "";
		$krkd = $this->cek_jabatan_untuk_simpan_logbook($pegawai['id_jabatan']);
		if($krkd['validate'] == 0){
			$data_pendaftaran = array(
				'id_kewenangan_detil' => $id_kewenangan_detil,
				'jml_logbook' => $jml_logbook,
				'jam_logbook' => $time_std,
				'rm' => $rm,
				'id_karu' => 0,
				'id_kabid' => 0,
				'id_asesor' => 0,
				'id_komite' => 0,
				'id_direktur' => 0,
				'result_tolak' => 0,
				'id_pengajuan' => 0,
				'status_logbook_dupak' => 1,
				'v_karu' => 1,
				'v_kabid' => 1,
				'v_komite' => 0,
				'v_asesor' => 1,
				'v_direktur' => 0,
				'tgl_v_karu' => $Skr,
				'tgl_v_kabid' => $Skr,
				'tgl_v_komite' => $tgl_std,
				'tgl_v_asesor' => $Skr,
				'tgl_v_direktur' => $tgl_std,
				'tgl_logbook' => $Skr,
				'id_pegawai' => $id_pegawai
			);
			$this->db->insert('logbook', $data_pendaftaran);
		}else{
			$this->db->select("COUNT(*) as num");
			$this->db->where('id_pegawai',$id_pegawai);
			$this->db->where('id_kewenangan',$id_kewenangan);
			$q = $this->db->get('kr_kewenangan_lulus')->row();
			$jml = $q->num;
			if($jml == 0){
				$data_pendaftaran = array(
					'id_kewenangan_detil' => $id_kewenangan_detil,
					'jml_logbook' => $jml_logbook,
					'rm' => $rm,
					'tgl_logbook' => $Skr,
					'jam_logbook' => $time_std,
					'id_karu' => 0,
					'v_karu' => 0,
					'id_kabid' => 0,
					'v_kabid' => 0,
					'id_asesor' => 0,
					'v_asesor' => 0,
					'v_komite' => 0,
					'id_komite' => 0,
					'id_direktur' => 0,
					'v_direktur' => 0,
					'result_tolak' => 0,
					'id_pengajuan' => 0,
					'status_logbook_dupak' => 1,
					'tgl_v_karu' => $tgl_std,
					'tgl_v_kabid' => $tgl_std,
					'tgl_v_asesor' => $tgl_std,
					'tgl_v_komite' => $tgl_std,
					'tgl_v_direktur' => $tgl_std,
					'id_pegawai' => $id_pegawai
				);
				$this->db->insert('logbook', $data_pendaftaran);
			}else{
				$data_pendaftaran = array(
					'id_kewenangan_detil' => $id_kewenangan_detil,
					'jml_logbook' => $jml_logbook,
					'jam_logbook' => $time_std,
					'rm' => $rm,
					'id_karu' => 0,
					'id_kabid' => 0,
					'id_asesor' => 0,
					'id_komite' => 0,
					'id_direktur' => 0,
					'result_tolak' => 0,
					'id_pengajuan' => 0,
					'status_logbook_dupak' => 1,
					'v_karu' => '1',
					'v_kabid' => '1',
					'v_komite' => '1',
					'v_asesor' => '1',
					'v_direktur' => '1',
					'tgl_v_karu' => $Skr,
					'tgl_v_kabid' => $Skr,
					'tgl_v_komite' => $Skr,
					'tgl_v_asesor' => $Skr,
					'tgl_v_direktur' => $Skr,
					'tgl_logbook' => $Skr,
					'id_pegawai' => $id_pegawai
				);
				$this->db->insert('logbook', $data_pendaftaran);
			}
		}
		return $this->db->insert_id();
	}
	function print_logbook_bulanane($first_date,$id)
	{
		$year = date('Y', strtotime($first_date));
		$month = date('m', strtotime($first_date));
		$bulan = $year."-".$month;
		$awal	= $year.'-'.$month.'-01';
		$tglakhir = date('t', strtotime($awal));
		$akhir	= $year.'-'.$month.'-'.$tglakhir;
		$this->db->select('SUM(lp.jml_logbook) as jumlaha,kd.id_kewenangan,krw.nama_kewenangan');
		$this->db->join('kr_kewenangan_detil kd', 'kd.id_kewenangan_detil=lp.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan krw', 'krw.id_kewenangan=kd.id_kewenangan','left');
		$this->db->where("lp.id_pegawai", $id);
		$this->db->where("DATE_FORMAT(lp.tgl_logbook,'%Y-%m')", $bulan);
		$this->db->group_by('kd.id_kewenangan');
		$q = $this->db->get('logbook lp')->result_array();
	//	print_r($q);die();
		return $q;
	}
	function print_dupak_bulanane($year,$month,$id)
	{
		$bulan = $year."-".$month;
		$this->db->select('SUM(lp.jml_logbook) as jml_logbook,kj.id_butir_kegiatan,nama_butir_kegiatan,angka_kredit');
		$this->db->join('kr_kewenangan_detil kd', 'kd.id_kewenangan_detil=lp.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan kk', 'kk.id_kewenangan=kd.id_kewenangan','left');
		$this->db->join('kr_jabfung kj', 'kj.id_kewenangan=kk.id_kewenangan','left');
		$this->db->join('kr_buket_pegawai kbp', 'kbp.id_butir_kegiatan=kj.id_butir_kegiatan','left');
		$this->db->join('butir_kegiatan bk', 'bk.id_butir_kegiatan=kj.id_butir_kegiatan','left');
		$this->db->where("lp.id_pegawai", $id);
		$this->db->where("status_logbook_dupak", '1');
		$this->db->where('tahun_buket_pegawai', $year);
		$this->db->where('bulan_buket_pegawai', $month);
		$this->db->where('year(tgl_logbook)', $year);
		$this->db->where('month(tgl_logbook)', $month);
	//	$this->db->where("DATE_FORMAT(tgl_logbook,'%Y-%m')", $bulan);
		$this->db->group_by('kj.id_butir_kegiatan');
		$q = $this->db->get('logbook lp')->result_array();
	//	print_r($q);die();
		return $q;
	}
	function ambil_range_logbook_bulanane_detil($tgl,$id){
	//	$this->db->select('SUM(jml_logbook) as jml_logbook,krw.nama_kewenangan');
		$this->db->join('kr_kewenangan_detil kd', 'kd.id_kewenangan_detil=lp.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan krw', 'krw.id_kewenangan=kd.id_kewenangan','left');
		$this->db->where('id_pegawai', $id);
		$this->db->where('DATE(tgl_logbook)', $tgl);
	//	$this->db->group_by("t.id_golongan_pemeriksaan");
		$q = $this->db->get('logbook lp')->result_array();
		//echo $this->db->last_query();die();
		return $q;
	}
	function buket_pegawai($id,$bulan,$tahun)
	{
	//	$ids = explode(',', $unit);
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,ROUND(angka_kredit, 4) as ms_angka_kredit,if(bp.status_buket_pegawai = '1' ,'AKTIF','NON AKTIF') as status_buket_pegawai,
			  CASE bulan_buket_pegawai
				WHEN '1' THEN 'Januari'
				WHEN '2' THEN 'Februari'
				WHEN '3' THEN 'Maret'
				WHEN '4' THEN 'April'
				WHEN '5' THEN 'Mei'
				WHEN '6' THEN 'Juni'
				WHEN '7' THEN 'Juli'
				WHEN '8' THEN 'Agustus'
				WHEN '9' THEN 'September'
				WHEN '10' THEN 'Oktober'
				WHEN '11' THEN 'Nopember'
				WHEN '12' THEN 'Desember'
			  END as bulan_buket_pegawai";
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
					$this->db->where("bp.id_pegawai", $id);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('kr_buket_pegawai bp');
		$this->db->join('butir_kegiatan bk', 'bk.id_butir_kegiatan=bp.id_butir_kegiatan','left');
		$this->db->join('pegawai peg', 'peg.id_pegawai=bp.id_pegawai','left');
		$this->db->where("bp.id_pegawai", $id);
		if($bulan > 0){
		$this->db->where('tahun_buket_pegawai', $tahun);
		$this->db->where('bulan_buket_pegawai', $bulan);
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
				$this->db->where("bp.id_pegawai", $id);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('kr_buket_pegawai bp');
		$this->db->join('butir_kegiatan bk', 'bk.id_butir_kegiatan=bp.id_butir_kegiatan','left');
		$this->db->join('pegawai peg', 'peg.id_pegawai=bp.id_pegawai','left');
		$this->db->where("bp.id_pegawai", $id);
		if($bulan > 0){
		$this->db->where('tahun_buket_pegawai', $tahun);
		$this->db->where('bulan_buket_pegawai', $bulan);
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('kr_buket_pegawai');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_buket_pegawai(){
		$id_pegawai = $this->input->post('id_pegawai');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$chk = $this->input->post('chk[]');
		$Skr = date('Y-m-d');
		$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
			$this->db->select("COUNT(*) as num");
			$this->db->where('id_pegawai',$id_pegawai);
			$this->db->where('tahun_buket_pegawai',$tahun);
			$this->db->where('bulan_buket_pegawai',$bulan);
			$this->db->where('id_butir_kegiatan',$chk[$i]);
			$q = $this->db->get('kr_buket_pegawai')->row();
			$jml = $q->num;
			if($jml == 0){
				$data_pendaftaran = array(
					'id_butir_kegiatan' => $chk[$i],
					'id_pegawai' => $id_pegawai,
					'bulan_buket_pegawai' => $bulan,
					'tahun_buket_pegawai' => $tahun,
					'status_buket_pegawai' => 1
				);
				$this->db->insert('kr_buket_pegawai', $data_pendaftaran);
			}
		}
	}
	function ambil_buket(){
		$this->db->select('*');
		$this->db->join('butir_kegiatan', 'butir_kegiatan.id_butir_kegiatan=dupak_buket.id_butir_kegiatan','left');
		$this->db->group_by('dupak_buket.id_butir_kegiatan');
		$q = $this->db->get_where('dupak_buket');
		return $q->result_array();
	}
    function jumlah_record_logbook_dupak($id_pegawai,$tglenya,$id_butir_kegiatan,$tahun,$bulan)    //igd.php untuk menampilkan jumlah antrian di igd saja
    {
		$this->db->join('kr_kewenangan_detil kd', 'kd.id_kewenangan_detil=lp.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan kk', 'kk.id_kewenangan=kd.id_kewenangan','left');
		$this->db->join('kr_jabfung kj', 'kj.id_kewenangan=kk.id_kewenangan','left');
		$this->db->join('kr_buket_pegawai kbp', 'kbp.id_butir_kegiatan=kj.id_butir_kegiatan','left');
		$this->db->join('butir_kegiatan bk', 'bk.id_butir_kegiatan=kj.id_butir_kegiatan','left');
		$this->db->where("lp.id_pegawai", $id_pegawai);
		$this->db->where("status_logbook_dupak", '1');
		$this->db->where('tgl_logbook',$tglenya);
		$this->db->where('tahun_buket_pegawai', $tahun);
		$this->db->where('bulan_buket_pegawai', $bulan);
		$this->db->where("kj.id_butir_kegiatan", $id_butir_kegiatan);
		$this->db->group_by('kj.id_butir_kegiatan');
        $query = $this->db->select("COUNT(*) as num")->get_where('logbook lp');
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
    }
	function total_record_logbook_dupak($id_pegawai,$tglenya,$id_butir_kegiatan,$tahun,$bulan){
		$this->db->select('SUM(jml_logbook) as jumlahe');
		$this->db->join('kr_kewenangan_detil kd', 'kd.id_kewenangan_detil=lp.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan kk', 'kk.id_kewenangan=kd.id_kewenangan','left');
		$this->db->join('kr_jabfung kj', 'kj.id_kewenangan=kk.id_kewenangan','left');
		$this->db->join('kr_buket_pegawai kbp', 'kbp.id_butir_kegiatan=kj.id_butir_kegiatan','left');
		$this->db->join('butir_kegiatan bk', 'bk.id_butir_kegiatan=kj.id_butir_kegiatan','left');
		$this->db->where("lp.id_pegawai", $id_pegawai);
		$this->db->where("status_logbook_dupak", '1');
		$this->db->where('tgl_logbook',$tglenya);
		$this->db->where('tahun_buket_pegawai', $tahun);
		$this->db->where('bulan_buket_pegawai', $bulan);
		$this->db->where("kj.id_butir_kegiatan", $id_butir_kegiatan);
		$q = $this->db->get_where('logbook lp');
		return $q->result_array();
	}
    function jumlah_record_logbook($id_pegawai,$tglenya,$id_kewenangan)    //igd.php untuk menampilkan jumlah antrian di igd saja
    {
		$this->db->join('kr_kewenangan_detil kd', 'kd.id_kewenangan_detil=lp.id_kewenangan_detil','left');
		$this->db->where('tgl_logbook',$tglenya);
		$this->db->where("id_pegawai", $id_pegawai);
		$this->db->where("id_kewenangan", $id_kewenangan);
        $query = $this->db->select("COUNT(*) as num")->get_where('logbook lp');
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
    }
	function total_record_logbook($id_pegawai,$tglenya,$id_kewenangan){
		$this->db->select('SUM(jml_logbook) as jumlahe');
		$this->db->join('kr_kewenangan_detil kd', 'kd.id_kewenangan_detil=lp.id_kewenangan_detil','left');
		$this->db->where('tgl_logbook',$tglenya);
		$this->db->where("id_pegawai", $id_pegawai);
		$this->db->where("id_kewenangan", $id_kewenangan);
		$q = $this->db->get_where('logbook lp');
		return $q->result_array();
	}
	function dupak_personil($id_pegawai,$bulan,$tahun)
	{
	//	$ids = explode(',', $unit);
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,ROUND(angka_kredit, 4) as ms_angka_kredit,if(status_logbook_dupak = '1' ,'INCLUDE','EXCLUDE') as status_logbook_dupak,
				DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_logbook,
				CASE bulan_buket_pegawai
					WHEN '1' THEN 'Januari'
					WHEN '2' THEN 'Februari'
					WHEN '3' THEN 'Maret'
					WHEN '4' THEN 'April'
					WHEN '5' THEN 'Mei'
					WHEN '6' THEN 'Juni'
					WHEN '7' THEN 'Juli'
					WHEN '8' THEN 'Agustus'
					WHEN '9' THEN 'September'
					WHEN '10' THEN 'Oktober'
					WHEN '11' THEN 'Nopember'
					WHEN '12' THEN 'Desember'
				END as bulan_buket_pegawai";
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
		$this->db->where("lp.id_pegawai", $id_pegawai);
		$this->db->where('YEAR(tgl_logbook)', $tahun);
		$this->db->where('MONTH(tgl_logbook)', $bulan);
		$this->db->where('tahun_buket_pegawai', $tahun);
		$this->db->where('bulan_buket_pegawai', $bulan);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('logbook lp');
		$this->db->join('kr_kewenangan_detil kd', 'kd.id_kewenangan_detil=lp.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan kk', 'kk.id_kewenangan=kd.id_kewenangan','left');
		$this->db->join('kr_jabfung kj', 'kj.id_kewenangan=kd.id_kewenangan','left');
		$this->db->join('kr_buket_pegawai kbp', 'kbp.id_butir_kegiatan=kj.id_butir_kegiatan','left');
		$this->db->join('butir_kegiatan bk', 'bk.id_butir_kegiatan=kbp.id_butir_kegiatan','left');
		$this->db->where("lp.id_pegawai", $id_pegawai);
		$this->db->where('YEAR(tgl_logbook)', $tahun);
		$this->db->where('MONTH(tgl_logbook)', $bulan);
		$this->db->where('tahun_buket_pegawai', $tahun);
		$this->db->where('bulan_buket_pegawai', $bulan);


		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil
	//	print_r($list);die();
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
		$this->db->where("lp.id_pegawai", $id_pegawai);
		$this->db->where('YEAR(tgl_logbook)', $tahun);
		$this->db->where('MONTH(tgl_logbook)', $bulan);
		$this->db->where('tahun_buket_pegawai', $tahun);
		$this->db->where('bulan_buket_pegawai', $bulan);
			}
		  }
		}

	    $this->db->from('logbook lp');
		$this->db->join('kr_kewenangan_detil kd', 'kd.id_kewenangan_detil=lp.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan kk', 'kk.id_kewenangan=kd.id_kewenangan','left');
		$this->db->join('kr_jabfung kj', 'kj.id_kewenangan=kd.id_kewenangan','left');
		$this->db->join('kr_buket_pegawai kbp', 'kbp.id_butir_kegiatan=kj.id_butir_kegiatan','left');
		$this->db->join('butir_kegiatan bk', 'bk.id_butir_kegiatan=kbp.id_butir_kegiatan','left');
		$this->db->where("lp.id_pegawai", $id_pegawai);
		$this->db->where('YEAR(tgl_logbook)', $tahun);
		$this->db->where('MONTH(tgl_logbook)', $bulan);
		$this->db->where('tahun_buket_pegawai', $tahun);
		$this->db->where('bulan_buket_pegawai', $bulan);
	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
/* 	    $this->db->from('kr_jabfung kj');
		$this->db->join('kr_buket_pegawai kbp', 'kbp.id_butir_kegiatan=kj.id_butir_kegiatan','left');
		$this->db->join('butir_kegiatan bk', 'bk.id_butir_kegiatan=kbp.id_butir_kegiatan','left');
		$this->db->join('kr_kewenangan_detil kd', 'kd.id_kewenangan=kj.id_kewenangan','left');
		$this->db->join('kr_kewenangan kk', 'kk.id_kewenangan=kd.id_kewenangan','left');
		$this->db->join('logbook lp', 'lp.id_kewenangan_detil=kd.id_kewenangan_detil','left');
		$this->db->where("lp.id_pegawai", $id_pegawai);
		$this->db->where("status_logbook_dupak", '1');
		$this->db->where('YEAR(tgl_logbook)', $tahun);
		$this->db->where('MONTH(tgl_logbook)', $bulan); */

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('logbook');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
	//	 print_r($q);die();
		return $output;
	}
	function logbook_dupak_personil($id_pegawai,$bulan,$tahun)
	{
	//	$ids = explode(',', $unit);
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,ROUND(angka_kredit, 4) as ms_angka_kredit,SUM(jml_logbook) as jml_logbook,
				DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_logbook,
				CASE bulan_buket_pegawai
					WHEN '1' THEN 'Januari'
					WHEN '2' THEN 'Februari'
					WHEN '3' THEN 'Maret'
					WHEN '4' THEN 'April'
					WHEN '5' THEN 'Mei'
					WHEN '6' THEN 'Juni'
					WHEN '7' THEN 'Juli'
					WHEN '8' THEN 'Agustus'
					WHEN '9' THEN 'September'
					WHEN '10' THEN 'Oktober'
					WHEN '11' THEN 'Nopember'
					WHEN '12' THEN 'Desember'
				END as bulan_buket_pegawai";
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
		$this->db->where("lp.id_pegawai", $id_pegawai);
		$this->db->where("status_logbook_dupak", '1');
		$this->db->where('YEAR(tgl_logbook)', $tahun);
		$this->db->where('MONTH(tgl_logbook)', $bulan);
		$this->db->where('tahun_buket_pegawai', $tahun);
		$this->db->where('bulan_buket_pegawai', $bulan);
		$this->db->group_by('kj.id_butir_kegiatan');
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('logbook lp');
		$this->db->join('kr_kewenangan_detil kd', 'kd.id_kewenangan_detil=lp.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan kk', 'kk.id_kewenangan=kd.id_kewenangan','left');
		$this->db->join('kr_jabfung kj', 'kj.id_kewenangan=kd.id_kewenangan','left');
		$this->db->join('kr_buket_pegawai kbp', 'kbp.id_butir_kegiatan=kj.id_butir_kegiatan','left');
		$this->db->join('butir_kegiatan bk', 'bk.id_butir_kegiatan=kbp.id_butir_kegiatan','left');
		$this->db->where("lp.id_pegawai", $id_pegawai);
		$this->db->where("status_logbook_dupak", '1');
		$this->db->where('YEAR(tgl_logbook)', $tahun);
		$this->db->where('MONTH(tgl_logbook)', $bulan);
		$this->db->where('tahun_buket_pegawai', $tahun);
		$this->db->where('bulan_buket_pegawai', $bulan);
	//	$this->db->group_by('kd.id_kewenangan_detil');
		$this->db->group_by('kj.id_butir_kegiatan');


		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil
	//	print_r($list);die();
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
		$this->db->where("lp.id_pegawai", $id_pegawai);
		$this->db->where("status_logbook_dupak", '1');
		$this->db->where('YEAR(tgl_logbook)', $tahun);
		$this->db->where('MONTH(tgl_logbook)', $bulan);
		$this->db->where('tahun_buket_pegawai', $tahun);
		$this->db->where('bulan_buket_pegawai', $bulan);
		$this->db->group_by('kj.id_butir_kegiatan');
			}
		  }
		}

	    $this->db->from('logbook lp');
		$this->db->join('kr_kewenangan_detil kd', 'kd.id_kewenangan_detil=lp.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan kk', 'kk.id_kewenangan=kd.id_kewenangan','left');
		$this->db->join('kr_jabfung kj', 'kj.id_kewenangan=kd.id_kewenangan','left');
		$this->db->join('kr_buket_pegawai kbp', 'kbp.id_butir_kegiatan=kj.id_butir_kegiatan','left');
		$this->db->join('butir_kegiatan bk', 'bk.id_butir_kegiatan=kbp.id_butir_kegiatan','left');
		$this->db->where("lp.id_pegawai", $id_pegawai);
		$this->db->where("status_logbook_dupak", '1');
		$this->db->where('YEAR(tgl_logbook)', $tahun);
		$this->db->where('MONTH(tgl_logbook)', $bulan);
		$this->db->where('tahun_buket_pegawai', $tahun);
		$this->db->where('bulan_buket_pegawai', $bulan);
	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
/* 	    $this->db->from('kr_jabfung kj');
		$this->db->join('kr_buket_pegawai kbp', 'kbp.id_butir_kegiatan=kj.id_butir_kegiatan','left');
		$this->db->join('butir_kegiatan bk', 'bk.id_butir_kegiatan=kbp.id_butir_kegiatan','left');
		$this->db->join('kr_kewenangan_detil kd', 'kd.id_kewenangan=kj.id_kewenangan','left');
		$this->db->join('kr_kewenangan kk', 'kk.id_kewenangan=kd.id_kewenangan','left');
		$this->db->join('logbook lp', 'lp.id_kewenangan_detil=kd.id_kewenangan_detil','left');
		$this->db->where("lp.id_pegawai", $id_pegawai);
		$this->db->where("status_logbook_dupak", '1');
		$this->db->where('YEAR(tgl_logbook)', $tahun);
		$this->db->where('MONTH(tgl_logbook)', $bulan); */
	//	$this->db->group_by('kd.id_kewenangan_detil');
		$this->db->group_by('kj.id_butir_kegiatan');

		$q = $this->db->get_where(); //04 Execute
		$result = $q->row();
	    if(isset($result))
	    	$jml_filter = $result->num;
	    $jml_filter = 0;


	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('logbook');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
	//	 print_r($q);die();
		return $output;
	}
	function edit_status_logbook($status,$id){
		$data_pendaftaran = array(
			'status_logbook_dupak' => $status
		);
		$this->db->where('id_logbook',$id);
		$this->db->update('logbook', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function pengajuan_kompetensi_all($id)
	{
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,
					if(b.acc_kabid = '0' ,'Proses',if(b.acc_kabid = '1' ,'Kompeten','Ditolak')) as acc_kabid,
					if(b.id_asesor = '0' ,'TIDAK',nama_pegawai) as nama_asesor,
					if(b.acc_asesor = '0' ,'Proses',if(b.acc_asesor = '1' ,'Kompeten','Ditolak')) as acc_asesor,
					if(b.acc_komite = '0' ,'Proses',if(b.acc_komite = '1' ,'Kompeten','Ditolak')) as acc_komite,
					if(b.acc_direktur = '0' ,'Proses',if(b.acc_direktur = '1' ,'Kompeten','Ditolak')) as acc_direktur,
					if(b.status_pengajuan = '0' ,'Belum Terkirim','Terkirim') as status_pengajuan,
					if(b.status_terbitkan= '0' ,'Belum Diterbitkan',if(b.status_terbitkan = '1' ,'Terbitkan','Tidak diterbitkan')) as status_terbitkan,
					DATE_FORMAT(b.tgl_pengajuan,'%d-%m-%Y') as tgl_pengajuan
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
		$this->db->where("b.id_pegawai", $id);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('kr_pengajuan b');
		$this->db->join('kol_status_diusulkan su', 'su.id_status_diusulkan=b.id_status_diusulkan','left');
		$this->db->join('pegawai peg', 'peg.id_pegawai=b.id_asesor','left');
		$this->db->where("b.id_pegawai", $id);

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
		$this->db->where("b.id_pegawai", $id);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('kr_pengajuan b');
		$this->db->join('kol_status_diusulkan su', 'su.id_status_diusulkan=b.id_status_diusulkan','left');
		$this->db->join('pegawai peg', 'peg.id_pegawai=b.id_asesor','left');
		$this->db->where("b.id_pegawai", $id);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99');
		$jml = $this->m_umum->jumlah_record_filter('pegawai',$kondisi);	 */
		$jml = $this->m_umum->jumlah_record_tabel('kr_pengajuan');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_pengajuan_kompetensi($level){
		$tgl_std = "0000-00-00";
		$Kosong = "";
		$kode = $this->m_rancak->kode_generator(15,'PK');
		$id_status_diusulkan = $this->input->post('id_status_diusulkan');
		if($id_status_diusulkan == 1){
			$acc_kabid = 0;
			$acc_asesor = 0;
			$acc_komite = 0;
			$acc_direktur = 0;
			$acc_logbook_kabid = 0;
			$acc_logbook_asesor = 0;
			$acc_logbook_komite = 0;
			$acc_logbook_direktur = 0;
		}else{
			$acc_kabid = 1;
			$acc_asesor = 1;
			$acc_komite = 0;
			$acc_direktur = 0;
			$acc_logbook_kabid = 1;
			$acc_logbook_asesor = 1;
			$acc_logbook_komite = 0;
			$acc_logbook_direktur = 0;
		}
		$data_kewenangan = array(
			'id_status_diusulkan' =>$id_status_diusulkan,
			'tgl_pengajuan' => date('Y-m-d'),
			'barcode_pengajuan' => $kode,
			'id_berkas' => $Kosong,
			'id_ijasah' => $Kosong,
			'id_sertifikat' => $Kosong,
			'id_etik_pegawai' => $Kosong,
			'id_str' => $Kosong,
			'id_logbook_a' => $Kosong,
			'id_logbook_b' => $Kosong,
			'kesesuaian_bukti' => $Kosong,
			'kredensial' => $Kosong,
			'mutu' => $Kosong,
			'etika' => $Kosong,
			'spk' => $Kosong,
			'status_pengajuan' => 0,
			'acc_kabid' => $acc_kabid,
			'acc_asesor' => $acc_asesor,
			'acc_komite' => $acc_komite,
			'acc_direktur' => $acc_direktur,
			'acc_logbook_kabid' => $acc_logbook_kabid,
			'acc_logbook_asesor' => $acc_logbook_asesor,
			'acc_logbook_komite' => $acc_logbook_komite,
			'acc_logbook_direktur' => $acc_logbook_direktur,
			'id_kabid' => 0,
			'id_asesor' => 0,
			'id_komite' => 0,
			'id_direktur' => 0,
			'id_kredensial' => 0,
			'id_mutu' => 0,
			'id_etika' => 0,
			'id_spk' => 0,
			'id_level' => $level,
			'tgl_acc_kabid' => $tgl_std,
			'tgl_acc_komite' => $tgl_std,
			'tgl_acc_asesor' => $tgl_std,
			'tgl_acc_direktur' => $tgl_std,
			'tgl_kredensial' => $tgl_std,
			'tgl_mutu' => $tgl_std,
			'tgl_etika' => $tgl_std,
			'tgl_spk' => $tgl_std,
			'status_terbitkan' => 0,
			'id_pegawai' => $this->input->post('id_pegawai')
		);
		$this->db->insert('kr_pengajuan', $data_kewenangan);
		return $this->db->insert_id();
	}
	function edit_pengajuan($level){
		$id_pengajuan = $this->input->post('id_pengajuan');
		$id_etik_pegawai = $this->input->post('id_etik_pegawai');
		$id_4_berkas = $this->input->post('id_4_berkas');
		$id_4_ijasah = $this->input->post('id_4_ijasah');
		$id_4_str = $this->input->post('id_4_str');
		$id_4_sertifikat = $this->input->post('id_4_sertifikat');
		$kesesuaian_bukti = $this->input->post('kesesuaian_bukti');
		if (empty($kesesuaian_bukti)) {
		   $chkkesesuaian_bukti = "";
		}else{
			$chkkesesuaian_bukti = implode(",",$kesesuaian_bukti);
		}
		if (empty($id_etik_pegawai)) {
		   $chk_etik_pegawai = "";
		}else{
			$chk_etik_pegawai = implode(",",$id_etik_pegawai);
		}
		if (empty($id_4_berkas)) {
		   $id_berkas = "";
		}else{
			$id_berkas = implode(",",$id_4_berkas);
		}
		if (empty($id_4_ijasah)) {
		   $id_ijasah = "";
		}else{
			$id_ijasah = implode(",",$id_4_ijasah);
		}
		if (empty($id_4_str)) {
		   $id_str = "";
		}else{
			$id_str = implode(",",$id_4_str);
		}
		if (empty($id_4_sertifikat)) {
		   $id_sertifikat = "";
		}else{
			$id_sertifikat = implode(",",$id_4_sertifikat);
		}
	//	$this->simpan_pengajuan_logbook_pegawai($id_pengajuan,$level);
		$data_pendaftaran = array(
			'id_etik_pegawai' => $chk_etik_pegawai,
			'id_berkas' => $id_berkas,
			'id_str' => $id_str,
			'id_sertifikat' => $id_sertifikat,
			'id_ijasah' => $id_ijasah
		);
		$this->db->where('id_pengajuan',$id_pengajuan);
		$this->db->update('kr_pengajuan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function simpan_pengajuan_logbook_pegawai($id,$level){
		$sp=$this->m_umum->ambil_data('kr_pengajuan','id_pengajuan',$id);
		$a = $sp['id_logbook_a'];
		$b = $sp['id_logbook_b'];
		$id_pegawai = $sp['id_pegawai'];
		if(!empty($a) AND !empty($b)){
			$data_pendaftaran = array(
				'id_pengajuan' => $sp['id_pengajuan']
			);
			$this->db->where('v_direktur', '0');
			$this->db->where('v_komite', '0');
			$this->db->where('v_asesor', '0');
			$this->db->where('v_kabid', '0');
			$this->db->where('v_karu', '1');
			$this->db->where('id_pegawai', $id_pegawai);
		//	$this->db->where('id_logbook BETWEEN "'. $a . '" and "'. $b .'"');
			$this->db->update('logbook', $data_pendaftaran);
			//echo $this->db->last_query();
			$this->db->trans_complete();	// untuk cek sukses update tidak
			if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
			// if (!$this->db->affected_rows())
				return(FALSE);
			else
				return(TRUE);
		}
	}
	function terkirim($level){
		$id_pengajuan = $this->input->post('id_pengajuan');
		$id_etik_pegawai = $this->input->post('id_etik_pegawai');
		$id_4_ijasah = $this->input->post('id_4_ijasah');
		$id_4_str = $this->input->post('id_4_str');
		$id_4_sertifikat = $this->input->post('id_4_sertifikat');
		$kesesuaian_bukti = $this->input->post('kesesuaian_bukti');
		if (empty($kesesuaian_bukti)) {
		   $chkkesesuaian_bukti = "";
		}else{
			$chkkesesuaian_bukti = implode(",",$kesesuaian_bukti);
		}
		if (empty($id_4_ijasah)) {
		   $id_ijasah = "";
		}else{
			$id_ijasah = implode(",",$id_4_ijasah);
		}
		if (empty($id_4_str)) {
		   $id_str = "";
		}else{
			$id_str = implode(",",$id_4_str);
		}
		if (empty($id_4_sertifikat)) {
		   $id_sertifikat = "";
		}else{
			$id_sertifikat = implode(",",$id_4_sertifikat);
		}
		if (empty($id_etik_pegawai)) {
		   $chk_etik_pegawai = "";
		}else{
			$chk_etik_pegawai = implode(",",$id_etik_pegawai);
		}
//		$this->simpan_pengajuan_logbook_pegawai($id_pengajuan,$level);
		if(empty($chk_etik_pegawai) || empty($id_str) || empty($id_sertifikat) || empty($id_ijasah)){
			$data_pendaftaran = array(
				'id_etik_pegawai' => $chk_etik_pegawai,
				'id_str' => $id_str,
				'id_sertifikat' => $id_sertifikat,
				'id_ijasah' => $id_ijasah
			);
		}else{
			$data_pendaftaran = array(
				'id_etik_pegawai' => $chk_etik_pegawai,
				'id_str' => $id_str,
				'id_sertifikat' => $id_sertifikat,
				'id_ijasah' => $id_ijasah,
				'status_pengajuan' => '1'
			);

		}
		$this->db->where('id_pengajuan',$id_pengajuan);
		$this->db->update('kr_pengajuan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function logbook_pengajuan_all($first_date,$last_date,$id,$level,$idp)
	{
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,
					DATE_FORMAT(lp.tgl_logbook,'%d-%m-%Y') as tgl_logbook,DATE_FORMAT(lp.tgl_v_karu,'%d-%m-%Y') as tgl_v_karu,
					if(lp.v_karu = '0' ,'Proses',if(lp.v_karu = '1' ,'Kompeten','Ditolak')) as v_karu,km.nama_kompetensi,
					if(lp.v_kabid = '0' ,'Proses',if(lp.v_kabid = '1' ,'Kompeten','Ditolak')) as v_kabid,
					if(lp.v_komite = '0' ,'Proses',if(lp.v_komite = '1' ,'Kompeten','Ditolak')) as v_komite
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
		$this->db->where("lp.id_pegawai", $id);
		$this->db->where("lp.v_karu =", "1");
		$this->db->where("lp.v_kabid =", "0");
		$this->db->where("lp.v_asesor =", "0");
		$this->db->where("lp.v_komite =", "0");
		$this->db->where("lp.v_direktur =", "0");
		$this->db->where('lp.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('logbook lp');
		$this->db->join('kr_kewenangan_detil kd', 'kd.id_kewenangan_detil=lp.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan krw', 'krw.id_kewenangan=kd.id_kewenangan','left');
		$this->db->join('kr_kompetensi km', 'km.id_kompetensi=krw.id_kompetensi','left');
		$this->db->join('kol_kode_kewenangan kw', 'kw.id_kode_kewenangan=kd.id_kode_kewenangan','left');
		$this->db->where("lp.id_pegawai", $id);
		$this->db->where("lp.v_karu =", "1");
		$this->db->where("lp.v_kabid =", "0");
		$this->db->where("lp.v_asesor =", "0");
		$this->db->where("lp.v_komite =", "0");
		$this->db->where("lp.v_direktur =", "0");
		$this->db->where('lp.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');

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
		$this->db->where("lp.id_pegawai", $id);
		$this->db->where("lp.v_karu =", "1");
		$this->db->where("lp.v_kabid =", "0");
		$this->db->where("lp.v_asesor =", "0");
		$this->db->where("lp.v_komite =", "0");
		$this->db->where("lp.v_direktur =", "0");
		$this->db->where('lp.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('logbook lp');
		$this->db->join('kr_kewenangan_detil kd', 'kd.id_kewenangan_detil=lp.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan krw', 'krw.id_kewenangan=kd.id_kewenangan','left');
		$this->db->join('kr_kompetensi km', 'km.id_kompetensi=krw.id_kompetensi','left');
		$this->db->join('kol_kode_kewenangan kw', 'kw.id_kode_kewenangan=kd.id_kode_kewenangan','left');
		$this->db->where("lp.id_pegawai", $id);
		$this->db->where("lp.v_karu =", "1");
		$this->db->where("lp.v_kabid =", "0");
		$this->db->where("lp.v_asesor =", "0");
		$this->db->where("lp.v_komite =", "0");
		$this->db->where("lp.v_direktur =", "0");
		$this->db->where('lp.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99');
		$jml = $this->m_umum->jumlah_record_filter('pegawai',$kondisi);	 */
		$jml = $this->m_umum->jumlah_record_tabel('logbook');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function logbook_pengajuan_perawat($first_date,$last_date)	//Laporan Harian
	{
		$this->db->select("*,lp.id_kewenangan_detil,
			DATE_FORMAT(lp.tgl_logbook,'%d-%m-%Y') as tgl_logbook,lp.id_logbook,lp.jam_logbook,lp.rm,
			DATE_FORMAT(lp.tgl_v_karu,'%d-%m-%Y') as tgl_v_karu,DATE_FORMAT(lp.tgl_v_kabid,'%d-%m-%Y') as tgl_v_kabid,
			DATE_FORMAT(lp.tgl_v_direktur,'%d-%m-%Y') as tgl_v_direktur,
			DATE_FORMAT(lp.tgl_v_asesor,'%d-%m-%Y') as tgl_v_asesor,DATE_FORMAT(lp.tgl_v_komite,'%d-%m-%Y') as tgl_v_komite,
			if(lp.v_karu = '0' ,'Proses',if(lp.v_karu = '1' ,'Kompeten','Ditolak')) as v_karu,lp.jml_logbook,
			if(lp.v_kabid = '0' ,'Proses',if(lp.v_kabid = '1' ,'Kompeten','Ditolak')) as v_kabid,
			if(lp.v_asesor = '0' ,'Proses',if(lp.v_asesor = '1' ,'Kompeten','Ditolak')) as v_asesor,
			if(lp.v_direktur = '0' ,'Proses',if(lp.v_direktur = '1' ,'Kompeten','Ditolak')) as v_direktur,
			if(lp.v_komite = '0' ,'Proses',if(lp.v_komite = '1' ,'Kompeten','Ditolak')) as v_komite,
			if(lp.result_tolak = '0' ,'',if(lp.result_tolak = '1' ,'Supervisi','Tidak Kompeten')) as result_tolak
			");
		$this->db->join('kr_kewenangan_detil kd', 'kd.id_kewenangan_detil=lp.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan krw', 'krw.id_kewenangan=kd.id_kewenangan','left');
		$this->db->join('kol_kode_kewenangan kw', 'kw.id_kode_kewenangan=kd.id_kode_kewenangan','left');
		$this->db->join('ruangan u', 'u.id_ruangan=kd.id_unit','left');
		$this->db->where("lp.id_pegawai", $this->session->id_pegawai);
		$this->db->where("lp.v_karu", "1");
		$this->db->where("lp.v_kabid", "0");
		$this->db->where("lp.v_asesor", "0");
		$this->db->where("lp.v_komite", "0");
		$this->db->where("lp.v_direktur", "0");
		$this->db->where("lp.id_pengajuan", "0");
		$this->db->where('lp.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$q = $this->db->get('logbook lp');
		return $q->result_array();
	}
	function logbook_pengajuan_tolak()	//Laporan Harian
	{
		$this->db->select("*,lp.id_kewenangan_detil,
			DATE_FORMAT(lp.tgl_logbook,'%d-%m-%Y') as tgl_logbook,lp.id_logbook,lp.jam_logbook,lp.rm,
			DATE_FORMAT(lp.tgl_v_karu,'%d-%m-%Y') as tgl_v_karu,DATE_FORMAT(lp.tgl_v_kabid,'%d-%m-%Y') as tgl_v_kabid,
			DATE_FORMAT(lp.tgl_v_direktur,'%d-%m-%Y') as tgl_v_direktur,
			DATE_FORMAT(lp.tgl_v_asesor,'%d-%m-%Y') as tgl_v_asesor,DATE_FORMAT(lp.tgl_v_komite,'%d-%m-%Y') as tgl_v_komite,
			if(lp.v_karu = '0' ,'Proses',if(lp.v_karu = '1' ,'Kompeten','Ditolak')) as v_karu,lp.jml_logbook,
			if(lp.v_kabid = '0' ,'Proses',if(lp.v_kabid = '1' ,'Kompeten','Ditolak')) as v_kabid,
			if(lp.v_asesor = '0' ,'Proses',if(lp.v_asesor = '1' ,'Kompeten','Ditolak')) as v_asesor,
			if(lp.v_direktur = '0' ,'Proses',if(lp.v_direktur = '1' ,'Kompeten','Ditolak')) as v_direktur,
			if(lp.v_komite = '0' ,'Proses',if(lp.v_komite = '1' ,'Kompeten','Ditolak')) as v_komite,
			if(lp.result_tolak = '0' ,'',if(lp.result_tolak = '1' ,'Supervisi','Tidak Kompeten')) as result_tolak
			");
		$this->db->join('kr_kewenangan_detil kd', 'kd.id_kewenangan_detil=lp.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan krw', 'krw.id_kewenangan=kd.id_kewenangan','left');
		$this->db->join('kol_kode_kewenangan kw', 'kw.id_kode_kewenangan=kd.id_kode_kewenangan','left');
		$this->db->join('ruangan u', 'u.id_ruangan=kd.id_unit','left');
	    $this->db->group_start();
	    $this->db->or_where("v_karu", '2');
	    $this->db->or_where("v_kabid", '2');
	    $this->db->or_where("v_asesor", '2');
	    $this->db->or_where("v_komite", '2');
	    $this->db->or_where("v_direktur", '2');
	    $this->db->group_end();
		$q = $this->db->get('logbook lp');
		return $q->result_array();
	}
	function logbook_pengajuan_kredensial($first_date,$last_date)	//Laporan Harian
	{
		$this->db->select("*,lp.id_kewenangan_detil,
			DATE_FORMAT(lp.tgl_logbook,'%d-%m-%Y') as tgl_logbook,lp.id_logbook,lp.jam_logbook,lp.rm,
			DATE_FORMAT(lp.tgl_v_karu,'%d-%m-%Y') as tgl_v_karu,DATE_FORMAT(lp.tgl_v_kabid,'%d-%m-%Y') as tgl_v_kabid,
			DATE_FORMAT(lp.tgl_v_direktur,'%d-%m-%Y') as tgl_v_direktur,
			DATE_FORMAT(lp.tgl_v_asesor,'%d-%m-%Y') as tgl_v_asesor,DATE_FORMAT(lp.tgl_v_komite,'%d-%m-%Y') as tgl_v_komite,
			if(lp.v_karu = '0' ,'Proses',if(lp.v_karu = '1' ,'Kompeten','Ditolak')) as v_karu,lp.jml_logbook,
			if(lp.v_kabid = '0' ,'Proses',if(lp.v_kabid = '1' ,'Kompeten','Ditolak')) as v_kabid,
			if(lp.v_asesor = '0' ,'Proses',if(lp.v_asesor = '1' ,'Kompeten','Ditolak')) as v_asesor,
			if(lp.v_direktur = '0' ,'Proses',if(lp.v_direktur = '1' ,'Kompeten','Ditolak')) as v_direktur,
			if(lp.v_komite = '0' ,'Proses',if(lp.v_komite = '1' ,'Kompeten','Ditolak')) as v_komite,
			if(lp.result_tolak = '0' ,'',if(lp.result_tolak = '1' ,'Supervisi','Tidak Kompeten')) as result_tolak
			");
		$this->db->join('kr_kewenangan_detil kd', 'kd.id_kewenangan_detil=lp.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan krw', 'krw.id_kewenangan=kd.id_kewenangan','left');
		$this->db->join('kol_kode_kewenangan kw', 'kw.id_kode_kewenangan=kd.id_kode_kewenangan','left');
		$this->db->join('ruangan u', 'u.id_ruangan=kd.id_unit','left');
		$this->db->where("lp.id_pegawai", $this->session->id_pegawai);
	    $this->db->where("v_karu", '1');
	    $this->db->where("v_kabid", '1');
	    $this->db->where("v_asesor", '1');
	    $this->db->where("v_komite", '0');
	    $this->db->where("v_direktur", '0');
	    $this->db->where("lp.id_pengajuan", "0");
	    $this->db->where('lp.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$q = $this->db->get('logbook lp');
		return $q->result_array();
	}
	function logbook_pengajuan_penambahan($first_date,$last_date)	//Laporan Harian
	{
		$this->db->select("*,lp.id_kewenangan_detil,
			DATE_FORMAT(lp.tgl_logbook,'%d-%m-%Y') as tgl_logbook,lp.id_logbook,lp.jam_logbook,lp.rm,
			DATE_FORMAT(lp.tgl_v_karu,'%d-%m-%Y') as tgl_v_karu,DATE_FORMAT(lp.tgl_v_kabid,'%d-%m-%Y') as tgl_v_kabid,
			DATE_FORMAT(lp.tgl_v_direktur,'%d-%m-%Y') as tgl_v_direktur,
			DATE_FORMAT(lp.tgl_v_asesor,'%d-%m-%Y') as tgl_v_asesor,DATE_FORMAT(lp.tgl_v_komite,'%d-%m-%Y') as tgl_v_komite,
			if(lp.v_karu = '0' ,'Proses',if(lp.v_karu = '1' ,'Kompeten','Ditolak')) as v_karu,lp.jml_logbook,
			if(lp.v_kabid = '0' ,'Proses',if(lp.v_kabid = '1' ,'Kompeten','Ditolak')) as v_kabid,
			if(lp.v_asesor = '0' ,'Proses',if(lp.v_asesor = '1' ,'Kompeten','Ditolak')) as v_asesor,
			if(lp.v_direktur = '0' ,'Proses',if(lp.v_direktur = '1' ,'Kompeten','Ditolak')) as v_direktur,
			if(lp.v_komite = '0' ,'Proses',if(lp.v_komite = '1' ,'Kompeten','Ditolak')) as v_komite,
			if(lp.result_tolak = '0' ,'',if(lp.result_tolak = '1' ,'Supervisi','Tidak Kompeten')) as result_tolak
			");
		$this->db->join('kr_kewenangan_detil kd', 'kd.id_kewenangan_detil=lp.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan krw', 'krw.id_kewenangan=kd.id_kewenangan','left');
		$this->db->join('kol_kode_kewenangan kw', 'kw.id_kode_kewenangan=kd.id_kode_kewenangan','left');
		$this->db->join('ruangan u', 'u.id_ruangan=kd.id_unit','left');
		$this->db->where("lp.id_pegawai", $this->session->id_pegawai);
	    $this->db->where("v_karu", '1');
	    $this->db->where("v_kabid <", '2');
	    $this->db->where("v_asesor <", '2');
	    $this->db->where("v_komite", '0');
	    $this->db->where("v_direktur", '0');
	    $this->db->where('lp.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$q = $this->db->get('logbook lp');
		return $q->result_array();
	}
	function reset_logbook($id){
		$data_pendaftaran = array(
			'id_pengajuan' => 0
		);
		$this->db->where('id_logbook',$id);
		$this->db->update('logbook', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
    function jumlah_record_logbook_tolak()  
    {
		$this->db->where("id_pegawai", $this->session->id_pegawai);
	    $this->db->group_start();
	    $this->db->where("v_karu", '2');
	    $this->db->or_where("v_kabid", '2');
	    $this->db->or_where("v_asesor", '2');
	    $this->db->or_where("v_komite", '2');
	    $this->db->or_where("v_direktur", '2');
	    $this->db->group_end();
        $query = $this->db->select("COUNT(*) as num")->get_where('logbook');
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
    }
	function simpan_logbook_tolak(){
		$chk = $this->input->post('chk[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				$this->edit_logbook_tolak($chk[$i]);
			}
		}
	}
	function edit_logbook_tolak($id){
		$data_kewenangan_detil = array(
			'id_pengajuan' =>$this->input->post('id_pengajuan')
		);
		$this->db->where('id_logbook',$id);
		$this->db->update('logbook', $data_kewenangan_detil);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function simpan_pengajuan_logbook_a($id_pengajuan,$id_logbook){
		$data_count = array(
			'id_logbook_a' => $id_logbook
		);
		$this->db->where('id_pengajuan',$id_pengajuan);
		$this->db->update('kr_pengajuan', $data_count);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function simpan_pengajuan_logbook_b($id_pengajuan,$id_logbook){
		$data_count = array(
			'id_logbook_b' => $id_logbook
		);
		$this->db->where('id_pengajuan',$id_pengajuan);
		$this->db->update('kr_pengajuan', $data_count);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function grafik_logbook($id)	//Laporan Harian
	{
		$apk = $this->m_rancak->ambil_pengajuan_kompetensi($id);
		$this->db->select("SUM(jml_logbook) as total,nama_kompetensi,nama_kewenangan");
		$this->db->join('kr_kewenangan_detil', 'kr_kewenangan_detil.id_kewenangan_detil=logbook.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan', 'kr_kewenangan.id_kewenangan=kr_kewenangan_detil.id_kewenangan','left');
		$this->db->join('kr_kompetensi', 'kr_kompetensi.id_kompetensi=kr_kewenangan.id_kompetensi','left');
		$this->db->where("logbook.id_pegawai", $apk['id_pegawai']);
		if ($apk['tgl_pengajuan'] < '2022-04-25') {
			$this->db->where('logbook.id_logbook BETWEEN "'.$apk['id_logbook_a']. '" and "'.$apk['id_logbook_b'].'"');
		}else{
			$this->db->where("logbook.id_pengajuan", $apk['id_pengajuan']);
		}
		$this->db->group_by('kr_kewenangan.id_kompetensi');
		$q = $this->db->get('logbook');
		return $q->result_array();
	}
	function tabel_logbook($id)
	{
		$apk = $this->m_rancak->ambil_pengajuan_kompetensi($id);
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,
					DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_logbook,
					DATE_FORMAT(tgl_v_karu,'%d-%m-%Y') as tgl_v_karu,
					DATE_FORMAT(tgl_v_kabid,'%d-%m-%Y') as tgl_v_kabid,
					DATE_FORMAT(tgl_v_asesor,'%d-%m-%Y') as tgl_v_asesor,
					DATE_FORMAT(tgl_v_komite,'%d-%m-%Y') as tgl_v_komite,
					DATE_FORMAT(tgl_v_direktur,'%d-%m-%Y') as tgl_v_direktur,
					if(v_karu = '0' ,'Proses',if(v_karu = '1' ,'Kompeten','Ditolak')) as v_karu,nama_kompetensi,
					if(v_asesor = '0' ,'Proses',if(v_asesor = '1' ,'Kompeten','Ditolak')) as v_asesor,
					if(v_direktur = '0' ,'Proses',if(v_direktur = '1' ,'Kompeten','Ditolak')) as v_direktur,
					if(v_kabid = '0' ,'Proses',if(v_kabid = '1' ,'Kompeten','Ditolak')) as v_kabid,
					if(v_komite = '0' ,'Proses',if(v_komite = '1' ,'Kompeten','Ditolak')) as v_komite
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
		$this->db->where("logbook.id_pegawai", $apk['id_pegawai']);
			$this->db->where("logbook.id_pengajuan", $apk['id_pengajuan']);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('logbook');
		$this->db->join('pegawai', 'pegawai.id_pegawai=logbook.id_pegawai','left');
		$this->db->join('kr_kewenangan_detil', 'kr_kewenangan_detil.id_kewenangan_detil=logbook.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan', 'kr_kewenangan.id_kewenangan=kr_kewenangan_detil.id_kewenangan','left');
		$this->db->join('kr_kompetensi', 'kr_kompetensi.id_kompetensi=kr_kewenangan.id_kompetensi','left');
		$this->db->join('kol_kode_kewenangan', 'kol_kode_kewenangan.id_kode_kewenangan=kr_kewenangan_detil.id_kode_kewenangan','left');
		$this->db->where("logbook.id_pegawai", $apk['id_pegawai']);
		$this->db->where("logbook.id_pengajuan", $apk['id_pengajuan']);

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
		$this->db->where("logbook.id_pegawai", $apk['id_pegawai']);
			$this->db->where("logbook.id_pengajuan", $apk['id_pengajuan']);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
		$this->db->from('logbook');
		$this->db->join('pegawai', 'pegawai.id_pegawai=logbook.id_pegawai','left');
		$this->db->join('kr_kewenangan_detil', 'kr_kewenangan_detil.id_kewenangan_detil=logbook.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan', 'kr_kewenangan.id_kewenangan=kr_kewenangan_detil.id_kewenangan','left');
		$this->db->join('kr_kompetensi', 'kr_kompetensi.id_kompetensi=kr_kewenangan.id_kompetensi','left');
		$this->db->join('kol_kode_kewenangan', 'kol_kode_kewenangan.id_kode_kewenangan=kr_kewenangan_detil.id_kode_kewenangan','left');
		$this->db->where("logbook.id_pegawai", $apk['id_pegawai']);
			$this->db->where("logbook.id_pengajuan", $apk['id_pengajuan']);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99');
		$jml = $this->m_umum->jumlah_record_filter('pegawai',$kondisi);	 */
		$jml = $this->m_umum->jumlah_record_tabel('logbook');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function tabel_pemulihan($id)
	{
		$apk = $this->m_rancak->ambil_pengajuan_kompetensi($id);
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,logbook_pemulihan.id_logbook_pemulihan,ruangan.nama_ruangan,
					DATE_FORMAT(tgl_awal,'%d-%m-%Y') as tgl_awal,
					DATE_FORMAT(tgl_akhir,'%d-%m-%Y') as tgl_akhir
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
				$this->db->where("logbook_pemulihan.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('logbook_pemulihan');
		$this->db->join('pegawai', 'pegawai.id_pegawai=logbook_pemulihan.id_pemulihan','left');
		$this->db->join('ruangan', 'ruangan.id_ruangan=logbook_pemulihan.id_unit_pemulihan','left');
		$this->db->where("logbook_pemulihan.id_pegawai", $this->session->id_pegawai);

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
		$this->db->where("logbook_pemulihan.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
		$this->db->from('logbook_pemulihan');
		$this->db->join('pegawai', 'pegawai.id_pegawai=logbook_pemulihan.id_pemulihan','left');
		$this->db->join('ruangan', 'ruangan.id_ruangan=logbook_pemulihan.id_unit_pemulihan','left');
		$this->db->where("logbook_pemulihan.id_pegawai", $this->session->id_pegawai);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99');
		$jml = $this->m_umum->jumlah_record_filter('pegawai',$kondisi);	 */
		$jml = $this->m_umum->jumlah_record_tabel('logbook_pemulihan');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function pdf_logbook($id)	//Laporan Harian
	{
		$apk = $this->m_rancak->ambil_pengajuan_kompetensi($id);
		$this->db->select("jml_logbook,nama_kompetensi,nama_kewenangan,DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_logbook");
		$this->db->join('kr_kewenangan_detil', 'kr_kewenangan_detil.id_kewenangan_detil=logbook.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan', 'kr_kewenangan.id_kewenangan=kr_kewenangan_detil.id_kewenangan','left');
		$this->db->join('kr_kompetensi', 'kr_kompetensi.id_kompetensi=kr_kewenangan.id_kompetensi','left');
		$this->db->where("logbook.id_pegawai", $apk['id_pegawai']);
		$this->db->where("logbook.id_pengajuan", $apk['id_pengajuan']);
		$q = $this->db->get('logbook');
		return $q->result_array();
	}
	function ambil_tgl_awal_logbook($id)	//Laporan Harian
	{
		$apk = $this->m_rancak->ambil_pengajuan_kompetensi($id);
		$this->db->select("DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_logbook");
		$this->db->join('kr_kewenangan_detil', 'kr_kewenangan_detil.id_kewenangan_detil=logbook.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan', 'kr_kewenangan.id_kewenangan=kr_kewenangan_detil.id_kewenangan','left');
		$this->db->join('kr_kompetensi', 'kr_kompetensi.id_kompetensi=kr_kewenangan.id_kompetensi','left');
		$this->db->where("logbook.id_pengajuan", $apk['id_pengajuan']);
		$this->db->order_by('id_logbook', 'asc');
		$q = $this->db->get('logbook');
		return $q->row_array();
	}
	function ambil_tgl_akhir_logbook($id)	//Laporan Harian
	{
		$apk = $this->m_rancak->ambil_pengajuan_kompetensi($id);
		$this->db->select("DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_logbook");
		$this->db->join('kr_kewenangan_detil', 'kr_kewenangan_detil.id_kewenangan_detil=logbook.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan', 'kr_kewenangan.id_kewenangan=kr_kewenangan_detil.id_kewenangan','left');
		$this->db->join('kr_kompetensi', 'kr_kompetensi.id_kompetensi=kr_kewenangan.id_kompetensi','left');
		$this->db->where("logbook.id_pengajuan", $apk['id_pengajuan']);
		$this->db->order_by('id_logbook', 'desc');
		$q = $this->db->get('logbook');
		return $q->row_array();
	}
	function simpan_berkas_ijasah($id_pengajuan,$id_berkas_data,$id_ijasahe){
	//	$this->edit_berkas_4pengajuan($id_berkas_data);
		if($id_ijasahe==""){
			$data_count = array(
				'id_ijasah' => $id_berkas_data
			);
		}else{
			$all_id_ijasah = $id_ijasahe.",".$id_berkas_data;
			$data_count = array(
				'id_ijasah' => $all_id_ijasah
			);
		}

		$this->db->where('id_pengajuan',$id_pengajuan);
		$this->db->update('kr_pengajuan', $data_count);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function simpan_berkas_str($id_pengajuan,$id_berkas_data,$id_stre){
	//	$this->edit_berkas_4pengajuan($id_berkas_data);
		if($id_stre==""){
			$data_count = array(
				'id_str' => $id_berkas_data
			);
		}else{
			$all_id_str = $id_stre.",".$id_berkas_data;
			$data_count = array(
				'id_str' => $all_id_str
			);
		}

		$this->db->where('id_pengajuan',$id_pengajuan);
		$this->db->update('kr_pengajuan', $data_count);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function simpan_berkas_sertifikat($id_pengajuan,$id_berkas_data,$id_sertifikate){
	//	$this->edit_berkas_4pengajuan($id_berkas_data);
		if($id_sertifikate==""){
			$data_count = array(
				'id_sertifikat' => $id_berkas_data
			);
		}else{
			$all_id_sertifikat = $id_sertifikate.",".$id_berkas_data;
			$data_count = array(
				'id_sertifikat' => $all_id_sertifikat
			);
		}

		$this->db->where('id_pengajuan',$id_pengajuan);
		$this->db->update('kr_pengajuan', $data_count);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function simpan_berkaslain_berkas($id_pengajuan,$id_berkas_data,$id_berkas){
	//	$this->edit_berkas_4pengajuan($id_berkas_data);
		if($id_berkas==""){
			$data_count = array(
				'id_berkas' => $id_berkas_data
			);
		}else{
			$all_id_ijasah = $id_berkas.",".$id_berkas_data;
			$data_count = array(
				'id_berkas' => $all_id_ijasah
			);
		}

		$this->db->where('id_pengajuan',$id_pengajuan);
		$this->db->update('kr_pengajuan', $data_count);
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
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,
					DATE_FORMAT(tgl_etik_pegawai,'%d-%m-%Y') as tgl_etik_pegawai
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
		$this->db->where("kr_etik_pegawai.id_pegawai", $id);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('kr_etik_pegawai');
		$this->db->join('pegawai peg', 'peg.id_pegawai=kr_etik_pegawai.id_penguji','left');
		$this->db->where("kr_etik_pegawai.id_pegawai", $id);

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
		$this->db->where("kr_etik_pegawai.id_pegawai", $id);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('kr_etik_pegawai');
		$this->db->join('pegawai peg', 'peg.id_pegawai=kr_etik_pegawai.id_penguji','left');
		$this->db->where("kr_etik_pegawai.id_pegawai", $id);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99');
		$jml = $this->m_umum->jumlah_record_filter('pegawai',$kondisi);	 */
		$jml = $this->m_umum->jumlah_record_tabel('kr_etik_pegawai');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_berkas_etik($id_pengajuan,$id_berkas_etik,$id_etik_pegawai){
		if($id_berkas_etik==""){
			$data_count = array(
				'id_etik_pegawai' => $id_etik_pegawai
			);
		}else{
			$all_id_ijasah = $id_berkas_etik.",".$id_etik_pegawai;
			$data_count = array(
				'id_etik_pegawai' => $all_id_ijasah
			);
		}
		$this->db->where('id_pengajuan',$id_pengajuan);
		$this->db->update('kr_pengajuan', $data_count);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function download_all($id,$level)
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
		if($level!=='99'){
			$this->db->where('find_in_set("'.$id.'", id_jabatan) != 0');
		}

			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('download');
		if($level!=='99'){
			$this->db->where('find_in_set("'.$id.'", id_jabatan) != 0');
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
		if($level!=='99'){
			$this->db->where('find_in_set("'.$id.'", id_jabatan) != 0');
		}
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('download');
		if($level!=='99'){
			$this->db->where('find_in_set("'.$id.'", id_jabatan) != 0');
		}

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
	function lh($data){
		$bulanind = $data['bln']."-".$data['thn'];
		$bulaning = $data['thn']."-".$data['bln'];
		$awal	= $bulaning.'-01';
		$akhir = date('t', strtotime($awal));
		$first_date = '01-'.$bulanind;
		$last_date = $akhir.'-'.$bulanind;
		$this->db->select("DATE_FORMAT(logbook.tgl_logbook,'%d-%m-%Y') as tgl_logbook");
		$this->db->join('kr_kewenangan_detil', 'kr_kewenangan_detil.id_kewenangan_detil=logbook.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan', 'kr_kewenangan.id_kewenangan=kr_kewenangan_detil.id_kewenangan','left');
		$this->db->join('kr_kompetensi', 'kr_kompetensi.id_kompetensi=kr_kewenangan.id_kompetensi','left');
		$this->db->where('logbook.id_pegawai', $data['member_id']);
		$this->db->where('kr_kompetensi.id_jabatan', $data['jabatan_id']);
		$this->db->where('logbook.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$this->db->group_by("logbook.tgl_logbook");
		$q = $this->db->get('logbook')->result_array();
		//echo $this->db->last_query();die();
		return $q;
	}
	function lh2($tgl,$id,$id_pegawai){
		$this->db->select("kr_kompetensi.id_kompetensi,SUM(logbook.jml_logbook) as jml_logbook");
		$this->db->join('kr_kewenangan_detil', 'kr_kewenangan_detil.id_kewenangan_detil=logbook.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan', 'kr_kewenangan.id_kewenangan=kr_kewenangan_detil.id_kewenangan','left');
		$this->db->join('kr_kompetensi', 'kr_kompetensi.id_kompetensi=kr_kewenangan.id_kompetensi','left');
		$this->db->where('logbook.id_pegawai', $id_pegawai);
		$this->db->where('kr_kompetensi.id_jabatan', $id);
		$this->db->where('logbook.tgl_logbook', date('Y-m-d', strtotime($tgl)));
		$this->db->group_by("kr_kompetensi.id_kompetensi");
		$q = $this->db->get('logbook')->result_array();
		//echo $this->db->last_query();die();
		return $q;
	}
	function lb($data){
		$first_date = '01-01-'.$data['thn'];
		$last_date = '31-12-'.$data['thn'];
		$this->db->select("DATE_FORMAT(logbook.tgl_logbook,'%d-%m-%Y') as tgl_logbook,DATE_FORMAT(logbook.tgl_logbook,'%m-%Y') as tgl_logbooke");
		$this->db->join('kr_kewenangan_detil', 'kr_kewenangan_detil.id_kewenangan_detil=logbook.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan', 'kr_kewenangan.id_kewenangan=kr_kewenangan_detil.id_kewenangan','left');
		$this->db->join('kr_kompetensi', 'kr_kompetensi.id_kompetensi=kr_kewenangan.id_kompetensi','left');
		$this->db->where('logbook.id_pegawai', $data['member_id']);
		$this->db->where('kr_kompetensi.id_jabatan', $data['jabatan_id']);
		$this->db->where('logbook.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$this->db->group_by("MONTH(logbook.tgl_logbook)");
		$q = $this->db->get('logbook')->result_array();
		//echo $this->db->last_query();die();
		return $q;
	}
	function lb2($tgl,$id,$id_pegawai){
		$this->db->select("kr_kompetensi.id_kompetensi,SUM(logbook.jml_logbook) as jml_logbook");
		$this->db->join('kr_kewenangan_detil', 'kr_kewenangan_detil.id_kewenangan_detil=logbook.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan', 'kr_kewenangan.id_kewenangan=kr_kewenangan_detil.id_kewenangan','left');
		$this->db->join('kr_kompetensi', 'kr_kompetensi.id_kompetensi=kr_kewenangan.id_kompetensi','left');
		$this->db->where('logbook.id_pegawai', $id_pegawai);
		$this->db->where('kr_kompetensi.id_jabatan', $id);
		$this->db->where('YEAR(logbook.tgl_logbook)', date('Y', strtotime($tgl)));
		$this->db->where('MONTH(logbook.tgl_logbook)', date('m', strtotime($tgl)));
		$this->db->group_by("kr_kompetensi.id_kompetensi");
		$q = $this->db->get('logbook')->result_array();
	//	echo $this->db->last_query();die();
		return $q;
	}
	function lt($data){
		$this->db->select("DATE_FORMAT(logbook.tgl_logbook,'%Y') as tgl_logbook");
		$this->db->join('kr_kewenangan_detil', 'kr_kewenangan_detil.id_kewenangan_detil=logbook.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan', 'kr_kewenangan.id_kewenangan=kr_kewenangan_detil.id_kewenangan','left');
		$this->db->join('kr_kompetensi', 'kr_kompetensi.id_kompetensi=kr_kewenangan.id_kompetensi','left');
		$this->db->where('logbook.id_pegawai', $data['member_id']);
		$this->db->where('kr_kompetensi.id_jabatan', $data['jabatan_id']);
		$this->db->group_by("year(logbook.tgl_logbook)");
		$q = $this->db->get('logbook')->result_array();
	//	echo $this->db->last_query();die();
		return $q;
	}
	function lt2($thn,$id,$id_pegawai){
		$this->db->select("kr_kompetensi.id_kompetensi,SUM(logbook.jml_logbook) as jml_logbook");
		$this->db->join('kr_kewenangan_detil', 'kr_kewenangan_detil.id_kewenangan_detil=logbook.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan', 'kr_kewenangan.id_kewenangan=kr_kewenangan_detil.id_kewenangan','left');
		$this->db->join('kr_kompetensi', 'kr_kompetensi.id_kompetensi=kr_kewenangan.id_kompetensi','left');
		$this->db->where('logbook.id_pegawai', $id_pegawai);
		$this->db->where('kr_kompetensi.id_jabatan', $id);
		$this->db->where('year(logbook.tgl_logbook)', $thn);
		$this->db->group_by("kr_kompetensi.id_kompetensi");
		$q = $this->db->get('logbook')->result_array();
	//	echo $this->db->last_query();die();
		return $q;
	}
}
