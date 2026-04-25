<?php
class M_komite extends CI_model{
	function cmd_pegawai_null($id,$level){
		$this->db->select('nama_pegawai,user.id_pegawai');
		$this->db->join('user', 'user.id_pegawai=pegawai.id_pegawai','left');
		$this->db->where('id_level','19');
		$this->db->group_by('user.id_pegawai');
		$q = $this->db->get_where('pegawai');
		return $q->result_array();
	}
	function pegawai_all($unit)
	{
		$ids = explode(',', $unit);
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,if (foto = '' ,'noavatar.jpg',foto) as foto";
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
				$this->db->where_in('id_struktur_jabatan',$ids);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('pegawai peg');
		$this->db->join('ruangan r','r.id_ruangan=peg.id_ruangan','left');
		$this->db->where_in('id_struktur_jabatan',$ids);

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
				$this->db->where_in('id_struktur_jabatan',$ids);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('pegawai peg');
		$this->db->join('ruangan r','r.id_ruangan=peg.id_ruangan','left');
		$this->db->where_in('id_struktur_jabatan',$ids);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99');
		$jml = $this->m_umum->jumlah_record_filter('pegawai',$kondisi);	 */
		$jml = $this->m_umum->jumlah_record_tabel('pegawai');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function user_all($id)
	{
	//	$ids = explode(',', $unit);
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,if (status_user = '1' ,'AKTIF','NON AKTIF') as status_user";
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
				$this->db->where("u.id_pegawai", $id);
				$this->db->where("u.id_level !=", '99');
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('user u');
		$this->db->join('user_level ul','ul.id_level=u.id_level','left');
		$this->db->where("u.id_pegawai", $id);
		$this->db->where("u.id_level !=", '99');

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
				$this->db->where("u.id_pegawai", $id);
				$this->db->where("u.id_level !=", '99');
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('user u');
		$this->db->join('user_level ul','ul.id_level=u.id_level','left');
		$this->db->where("u.id_pegawai", $id);
		$this->db->where("u.id_level !=", '99');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi);		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
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
	function simpan_pegawai($pic){
		$kosong = "";
		$nol = "0";
		$tglkosong = "0000-00-00";
		$data_pendaftaran = array(
			'nik' => $kosong,
			'nip' => $kosong,
			'email' =>$this->input->post('email'),
			'nama_pegawai' => $this->input->post('nama_pegawai'),
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
			'id_jabatan_fungsional' =>$nol,
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
		$data_pendaftaran = array(
			'nik' => $kosong,
			'nip' => $kosong,
			'email' =>$this->input->post('email'),
			'nama_pegawai' => $this->input->post('nama_pegawai'),
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
			'id_jabatan_fungsional' =>$nol,
			'id_agama' =>$nol,
			'alamat' => $kosong,
			'foto' => ''
		);
		$this->db->insert('pegawai', $data_pendaftaran);
		return $this->db->insert_id();
	}
	function edit_pegawai($pic){
		$id_pegawai = $this->input->post('id_pegawai');
		$data_pendaftaran = array(
			'email' =>$this->input->post('email'),
			'nama_pegawai' => $this->input->post('nama_pegawai'),
			'id_unit' =>$this->input->post('id_unit'),
			'id_ruangan' =>$this->input->post('id_ruangan'),
			'no_hp' =>$this->input->post('no_hp'),
			'tipe_pegawai' =>$this->input->post('tipe_pegawai'),
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
			'id_unit' =>$this->input->post('id_unit'),
			'id_ruangan' =>$this->input->post('id_ruangan'),
			'no_hp' =>$this->input->post('no_hp'),
			'tipe_pegawai' =>$this->input->post('tipe_pegawai')
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
	function simpan_perawat_detil($id){
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
			'id_kode_kewenangan' => $this->input->post('id_kode_kewenangan')
		);
		return $this->db->insert('perawat_detil', $data_pendaftaran);
	}
	function edit_perawat_detil(){
		$id_pegawai = $this->input->post('id_pegawai');
		$data_pendaftaran = array(
			'id_kode_kewenangan' => $this->input->post('id_kode_kewenangan')
		);
		$this->db->where('id_pegawai',$id_pegawai);
		$this->db->update('perawat_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
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
			'status_user' => 1
		);
		return $this->db->insert('user', $data_pendaftaran);
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
			'id_level' => $this->input->post('id_level'),
			'status_user' => $this->input->post('status_user')
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
	function logbook_all($first_date,$last_date,$id,$id_ruangan,$level)
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,lp.id_kewenangan_detil,
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
		$this->db->where("us.id_level", '19'); // karu
		$this->db->where('v_karu', '1');
		$this->db->where('v_kabid', '1');
		if($id > 0){
			$this->db->where("lp.id_pegawai", $id);
		}
			$this->db->where('lp.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');

	//	$this->db->group_by('us.id_pegawai');

			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('logbook lp');
		$this->db->join('pegawai peg', 'peg.id_pegawai=lp.id_pegawai','left');
		$this->db->join('user us', 'us.id_pegawai=peg.id_pegawai','left');
		$this->db->join('kr_kewenangan_detil kd', 'kd.id_kewenangan_detil=lp.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan krw', 'krw.id_kewenangan=kd.id_kewenangan','left');
		$this->db->join('kol_kode_kewenangan kw', 'kw.id_kode_kewenangan=kd.id_kode_kewenangan','left');
		$this->db->join('ruangan u', 'u.id_ruangan=kd.id_unit','left');
		$this->db->where("us.id_level", '19'); // karu
		$this->db->where('v_karu', '1');
		$this->db->where('v_kabid', '1');
		if($id > 0){
			$this->db->where("lp.id_pegawai", $id);
		}
			$this->db->where('lp.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');

	//	$this->db->group_by('us.id_pegawai');

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
		$this->db->where("us.id_level", '19'); // karu
		$this->db->where('v_karu', '1');
		$this->db->where('v_kabid', '1');
		if($id > 0){
			$this->db->where("lp.id_pegawai", $id);
		}
			$this->db->where('lp.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');

	//	$this->db->group_by('us.id_pegawai');
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('logbook lp');
		$this->db->join('pegawai peg', 'peg.id_pegawai=lp.id_pegawai','left');
		$this->db->join('user us', 'us.id_pegawai=peg.id_pegawai','left');
		$this->db->join('kr_kewenangan_detil kd', 'kd.id_kewenangan_detil=lp.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan krw', 'krw.id_kewenangan=kd.id_kewenangan','left');
		$this->db->join('kol_kode_kewenangan kw', 'kw.id_kode_kewenangan=kd.id_kode_kewenangan','left');
		$this->db->join('ruangan u', 'u.id_ruangan=kd.id_unit','left');
		$this->db->where("us.id_level", '19'); // karu
		$this->db->where('v_karu', '1');
		$this->db->where('v_kabid', '1');
		if($id > 0){
			$this->db->where("lp.id_pegawai", $id);
		}
			$this->db->where('lp.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');

	//	$this->db->group_by('us.id_pegawai');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('logbook');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function pengajuan_kompetensi_all($jabatan,$level,$id)
	{
		$ids = explode(',', $jabatan);
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,peg.nama_pegawai as nama_pegawai,
					if(b.acc_direktur = '0' ,'Proses',if(b.acc_direktur = '1' ,'Kompeten','Ditolak')) as acc_direktur,
					if(b.acc_komite = '0' ,'Proses',if(b.acc_komite = '1' ,'Kompeten','Ditolak')) as acc_komite,
					if(b.acc_asesor = '0' ,'Proses',if(b.acc_asesor = '1' ,'Kompeten','Ditolak')) as acc_asesor,
					if(b.acc_kabid = '0' ,'Proses',if(b.acc_kabid = '1' ,'Kompeten','Ditolak')) as acc_kabid,
					if(b.status_terbitkan= '0' ,'Belum Diterbitkan',if(b.status_terbitkan = '1' ,'Terbitkan','Tidak diterbitkan')) as status_terbitkan,
					if(b.status_terbitkan= '0' ,'0',if(b.status_terbitkan = '1' ,'1','2')) as no_terbitkan,
					if(b.tgl_acc_direktur = '0000-00-00' ,'Proses',DATE_FORMAT(b.tgl_acc_direktur,'%d-%m-%Y')) as tgl_acc_direktur,
					if(b.tgl_acc_komite = '0000-00-00' ,'Proses',DATE_FORMAT(b.tgl_acc_komite,'%d-%m-%Y')) as tgl_acc_komite,
					if(b.tgl_acc_asesor = '0000-00-00' ,'Proses',DATE_FORMAT(b.tgl_acc_asesor,'%d-%m-%Y')) as tgl_acc_asesor,
					if(b.tgl_acc_kabid = '0000-00-00' ,'Proses',DATE_FORMAT(b.tgl_acc_kabid,'%d-%m-%Y')) as tgl_acc_kabid,
					if(b.tgl_kredensial = '0000-00-00' ,'Proses',DATE_FORMAT(b.tgl_kredensial,'%d-%m-%Y')) as tgl_kredensial,
					if(b.tgl_mutu = '0000-00-00' ,'Proses',DATE_FORMAT(b.tgl_mutu,'%d-%m-%Y')) as tgl_mutu,
					if(b.tgl_etika = '0000-00-00' ,'Proses',DATE_FORMAT(b.tgl_etika,'%d-%m-%Y')) as tgl_etika,
					if(b.id_direktur = '' ,'Proses',peg8.nama_pegawai) as id_direktur,
					if(b.id_komite = '' ,'Proses',peg7.nama_pegawai) as id_komite,
					if(b.id_kabid = '' ,'Proses',peg6.nama_pegawai) as id_kabid,
					if(b.id_etika = '' ,'Proses',peg5.nama_pegawai) as id_etika,
					if(b.id_mutu = '' ,'Proses',peg4.nama_pegawai) as id_mutu,
					if(b.id_kredensial = '' ,'Proses',peg3.nama_pegawai) as id_kredensial,
					if(b.id_asesor = '' ,'Proses',peg2.nama_pegawai) as id_asesor,
					if(b.status_pengajuan = '0' ,'Belum Terkirim','Terkirim') as status_pengajuan,
					DATE_FORMAT(b.tgl_pengajuan,'%d-%m-%Y') as tgl_pengajuan
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
					 case 'nama_pegawai' : $nmf="peg.nama_pegawai";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);

		$this->db->where("b.status_pengajuan", "1");
		$this->db->where('acc_asesor', '1');
		$this->db->where('acc_kabid', '1');
		if($this->session->id_level !== '99'){
		$this->db->where_in('jf.id_jabatan',$ids);			
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by
		$this->db->order_by('peg.nama_pegawai', $dir);

	    $this->db->from('kr_pengajuan b');
		$this->db->join('kol_status_diusulkan su', 'su.id_status_diusulkan=b.id_status_diusulkan','left');
		$this->db->join('pegawai peg', 'peg.id_pegawai=b.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
		$this->db->join('pegawai peg2', 'peg2.id_pegawai=b.id_asesor','left');
		$this->db->join('pegawai peg3', 'peg3.id_pegawai=b.id_kredensial','left');
		$this->db->join('pegawai peg4', 'peg4.id_pegawai=b.id_mutu','left');
		$this->db->join('pegawai peg5', 'peg5.id_pegawai=b.id_etika','left');
		$this->db->join('pegawai peg6', 'peg6.id_pegawai=b.id_kabid','left');
		$this->db->join('pegawai peg7', 'peg7.id_pegawai=b.id_komite','left');
		$this->db->join('pegawai peg8', 'peg8.id_pegawai=b.id_direktur','left');
		$this->db->where("b.status_pengajuan", "1");
		$this->db->where('acc_asesor', '1');
		$this->db->where('acc_kabid', '1');
		if($this->session->id_level !== '99'){
		$this->db->where_in('jf.id_jabatan',$ids);			
		}


		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
					case 'nama_pegawai' : $nmf="peg.nama_pegawai";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);

		$this->db->where("b.status_pengajuan", "1");
		$this->db->where('acc_asesor', '1');
		$this->db->where('acc_kabid', '1');
		if($this->session->id_level !== '99'){
		$this->db->where_in('jf.id_jabatan',$ids);			
		}
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('kr_pengajuan b');
		$this->db->join('kol_status_diusulkan su', 'su.id_status_diusulkan=b.id_status_diusulkan','left');
		$this->db->join('pegawai peg', 'peg.id_pegawai=b.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
		$this->db->join('pegawai peg2', 'peg2.id_pegawai=b.id_asesor','left');
		$this->db->join('pegawai peg3', 'peg3.id_pegawai=b.id_kredensial','left');
		$this->db->join('pegawai peg4', 'peg4.id_pegawai=b.id_mutu','left');
		$this->db->join('pegawai peg5', 'peg5.id_pegawai=b.id_etika','left');
		$this->db->join('pegawai peg6', 'peg6.id_pegawai=b.id_kabid','left');
		$this->db->join('pegawai peg7', 'peg7.id_pegawai=b.id_komite','left');
		$this->db->join('pegawai peg8', 'peg8.id_pegawai=b.id_direktur','left');
		$this->db->where("b.status_pengajuan", "1");
		$this->db->where('acc_asesor', '1');
		$this->db->where('acc_kabid', '1');
		if($this->session->id_level !== '99'){
		$this->db->where_in('jf.id_jabatan',$ids);			
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('kr_pengajuan');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
	//	 print_r($output);die();
		return $output;
	}
	function logbook_all_a_b($id)
	{
		$apk	=$this->m_rancak->ambil_pengajuan_kompetensi($id);
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,
					DATE_FORMAT(lp.tgl_logbook,'%d-%m-%Y') as tgl_logbook,DATE_FORMAT(lp.jam_logbook,'%H:%i:%s') as jam_logbook,
					DATE_FORMAT(lp.tgl_v_karu,'%d-%m-%Y') as tgl_v_karu,DATE_FORMAT(lp.tgl_v_kabid,'%d-%m-%Y') as tgl_v_kabid,
					DATE_FORMAT(lp.tgl_v_asesor,'%d-%m-%Y') as tgl_v_asesor,DATE_FORMAT(lp.tgl_v_komite,'%d-%m-%Y') as tgl_v_komite,
					DATE_FORMAT(lp.tgl_v_direktur,'%d-%m-%Y') as tgl_v_direktur,lp.id_logbook,
					if(lp.v_karu = '0' ,'Proses',if(lp.v_karu = '1' ,'Kompeten','Ditolak')) as v_karu,
					if(lp.v_kabid = '0' ,'Proses',if(lp.v_kabid = '1' ,'Kompeten','Ditolak')) as v_kabid,
					if(lp.v_asesor = '0' ,'Proses',if(lp.v_asesor = '1' ,'Kompeten','Ditolak')) as v_asesor,
					if(lp.v_direktur = '0' ,'Proses',if(lp.v_direktur = '1' ,'Kompeten','Ditolak')) as v_direktur,
					if(lp.v_komite = '0' ,'Proses',if(lp.v_komite = '1' ,'Kompeten','Ditolak')) as v_komite,
					if(lp.result_tolak = '0' ,'',if(lp.result_tolak = '1' ,'Supervisi','Tidak Kompeten')) as result_tolak
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
					// case 'nama_pegawai' : $nmf="peg.nama_pegawai";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where("lp.id_pegawai", $apk['id_pegawai']);
		$this->db->where("lp.id_pengajuan", $apk['id_pengajuan']);
		if($apk['id_status_diusulkan'] == 1){
		$this->db->where('v_kabid','1');
		$this->db->where('v_asesor','1');
		}
		$this->db->where('v_karu', '1');
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('logbook lp');
		$this->db->join('pegawai peg', 'peg.id_pegawai=lp.id_pegawai','left');
		$this->db->join('kr_kewenangan_detil kd', 'kd.id_kewenangan_detil=lp.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan krw', 'krw.id_kewenangan=kd.id_kewenangan','left');
		$this->db->join('kol_kode_kewenangan kw', 'kw.id_kode_kewenangan=kd.id_kode_kewenangan','left');
		$this->db->join('ruangan u', 'u.id_ruangan=kd.id_unit','left');
		$this->db->where("lp.id_pegawai", $apk['id_pegawai']);
		$this->db->where("lp.id_pengajuan", $apk['id_pengajuan']);
		if($apk['id_status_diusulkan'] == 1){
		$this->db->where('v_kabid','1');
		$this->db->where('v_asesor','1');
		}
		$this->db->where('v_karu', '1');

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
		$this->db->where("lp.id_pegawai", $apk['id_pegawai']);
		$this->db->where("lp.id_pengajuan", $apk['id_pengajuan']);
		if($apk['id_status_diusulkan'] == 1){
		$this->db->where('v_kabid','1');
		$this->db->where('v_asesor','1');
		}
		$this->db->where('v_karu', '1');
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('logbook lp');
		$this->db->join('pegawai peg', 'peg.id_pegawai=lp.id_pegawai','left');
		$this->db->join('kr_kewenangan_detil kd', 'kd.id_kewenangan_detil=lp.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan krw', 'krw.id_kewenangan=kd.id_kewenangan','left');
		$this->db->join('kol_kode_kewenangan kw', 'kw.id_kode_kewenangan=kd.id_kode_kewenangan','left');
		$this->db->join('ruangan u', 'u.id_ruangan=kd.id_unit','left');
		$this->db->where("lp.id_pegawai", $apk['id_pegawai']);
		$this->db->where("lp.id_pengajuan", $apk['id_pengajuan']);
		if($apk['id_status_diusulkan'] == 1){
		$this->db->where('v_kabid','1');
		$this->db->where('v_asesor','1');
		}
		$this->db->where('v_karu', '1');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('logbook');		//[coding here] ganti tabel utamanya

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
				$this->db->where("logbook_pemulihan.id_pegawai", $apk['id_pegawai']);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('logbook_pemulihan');
		$this->db->join('pegawai', 'pegawai.id_pegawai=logbook_pemulihan.id_pemulihan','left');
		$this->db->join('ruangan', 'ruangan.id_ruangan=logbook_pemulihan.id_unit_pemulihan','left');
		$this->db->where("logbook_pemulihan.id_pegawai", $apk['id_pegawai']);

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
		$this->db->where("logbook_pemulihan.id_pegawai", $apk['id_pegawai']);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
		$this->db->from('logbook_pemulihan');
		$this->db->join('pegawai', 'pegawai.id_pegawai=logbook_pemulihan.id_pemulihan','left');
		$this->db->join('ruangan', 'ruangan.id_ruangan=logbook_pemulihan.id_unit_pemulihan','left');
		$this->db->where("logbook_pemulihan.id_pegawai", $apk['id_pegawai']);

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
	function grafik_logbook($id)	//Laporan Harian
	{
		$apk	=$this->m_rancak->ambil_pengajuan_kompetensi($id);
		$this->db->select("SUM(jml_logbook) as total,kr_kompetensi.nama_kompetensi");
		$this->db->join('kr_kewenangan_detil', 'kr_kewenangan_detil.id_kewenangan_detil=logbook.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan', 'kr_kewenangan.id_kewenangan=kr_kewenangan_detil.id_kewenangan','left');
		$this->db->join('kr_kompetensi', 'kr_kompetensi.id_kompetensi=kr_kewenangan.id_kompetensi','left');
		$this->db->where("lp.id_pegawai", $apk['id_pegawai']);
//		if($apk['acc_komite'] == '0'){
		$this->db->where('v_asesor', '1');
		$this->db->where('v_kabid', '1');
		$this->db->where('v_karu', '1');
//		}
		if ($apk['tgl_pengajuan'] < '2022-04-25') {
			$this->db->where('lp.id_logbook BETWEEN "'.$apk['id_logbook_a']. '" and "'.$apk['id_logbook_b'].'"');
		}else{
			$this->db->where("lp.id_pengajuan", $apk['id_pengajuan']);
		}
		$this->db->group_by('kr_kewenangan.id_kompetensi');
		$q = $this->db->get('logbook');
		return $q->result_array();
	}
	function update_v_kabid_kompetensi($isi,$tolak,$id,$id_karu,$id_pengajuan){
		$d = $this->m_umum->ambil_data('kr_pengajuan','id_pengajuan',$id_pengajuan);
		if($d['id_status_diusulkan'] == 4){
			$data_v_karu = array(
				'v_karu' => $isi,
				'id_karu' => $id_karu,
				'tgl_v_karu' => date('Y-m-d'),
				'v_kabid' => $isi,
				'id_kabid' => $id_karu,
				'tgl_v_kabid' => date('Y-m-d'),
				'v_asesor' => $isi,
				'id_asesor' => $id_karu,
				'tgl_v_asesor' => date('Y-m-d'),
				'v_komite' => $isi,
				'id_komite' => $id_karu,
				'tgl_v_komite' => date('Y-m-d'),
				'result_tolak' => $tolak
			);
			$this->db->where("logbook.id_pengajuan", $id_pengajuan);
			$this->db->where('id_pegawai',$d['id_pegawai']);
			$this->db->where('id_kewenangan_detil',$id);			
		}else{
			$data_v_karu = array(
				'v_komite' => $isi,
				'id_komite' => $id_karu,
				'result_tolak' => $tolak,
				'tgl_v_komite' => date('Y-m-d')
			);
			$this->db->where("logbook.id_pengajuan", $id_pengajuan);
		//	$this->db->where('id_logbook BETWEEN "'.$a. '" and "'.$b.'"');
			$this->db->where('id_pegawai',$d['id_pegawai']);
			$this->db->where('id_kewenangan_detil',$id);
			$this->db->where('v_direktur','0');
			if($isi > 0){
			$this->db->where('v_komite','0');
			}
			if($d['id_status_diusulkan'] == 1){
			$this->db->where('v_asesor','1');
			$this->db->where('v_kabid','1');
			}
			$this->db->where('v_karu','1');
		}
		$this->db->update('logbook', $data_v_karu);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function update_v_kabid_logbook($isi,$tolak,$id,$a,$b,$id_pegawai){
		$id_karu = $this->session->id_user;
		$data_v_karu = array(
			'v_asesor' => $isi,
			'v_komite' => $isi,
			'id_komite' => $id_karu,
			'id_asesor' => $id_karu,
			'result_tolak' => $tolak,
			'tgl_v_komite' => date('Y-m-d'),
			'tgl_v_asesor' => date('Y-m-d')
		);
		$this->db->where('tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($a)). '" and "'. date('Y-m-d', strtotime($b)).'"');
		$this->db->where('id_pegawai',$id_pegawai);
		$this->db->where('id_kewenangan_detil',$id);
		$this->db->where('v_direktur','0');
		if($isi!=='0'){
		$this->db->where('v_komite','0');
		$this->db->where('v_asesor','0');
		}
		$this->db->where('v_karu','1');
		$this->db->where('v_kabid','1');
		$this->db->update('logbook', $data_v_karu);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function Kabid_Acc($id,$idp){
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
		$id_kabid = $idp;
		$data_pendaftaran = array(
			'id_komite' => $id_kabid,
			'acc_komite' => '1',
			'tgl_acc_komite' => date("Y-m-d"),
			'kesesuaian_bukti' => $chkkesesuaian_bukti,
			'id_berkas' => $id_berkas,
			'id_str' => $id_str,
			'id_sertifikat' => $id_sertifikat,
			'id_ijasah' => $id_ijasah
		);
		$this->db->where('id_pengajuan',$id);
		$this->db->update('kr_pengajuan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function Kabid_Tolak($id,$idp){
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
		$id_kabid = $idp;
		$data_pendaftaran = array(
			'id_komite' => $id_kabid,
			'acc_komite' => '2',
			'tgl_acc_komite' => date("Y-m-d"),
			'kesesuaian_bukti' => $chkkesesuaian_bukti,
			'id_berkas' => $id_berkas,
			'id_str' => $id_str,
			'id_sertifikat' => $id_sertifikat,
			'id_ijasah' => $id_ijasah
		);
		$this->db->where('id_pengajuan',$id);
		$this->db->update('kr_pengajuan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function Kabid_Simpan($id){
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
		$data_pendaftaran = array(
			'kesesuaian_bukti' => $chkkesesuaian_bukti,
			'id_berkas' => $id_berkas,
			'id_str' => $id_str,
			'id_sertifikat' => $id_sertifikat,
			'id_ijasah' => $id_ijasah
		);
		$this->db->where('id_pengajuan',$id);
		$this->db->update('kr_pengajuan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
    function jumlah_logbook_pengajuan($id)    //igd.php untuk menampilkan jumlah antrian di igd saja
    {
		$apk = $this->m_rancak->ambil_pengajuan_kompetensi($id);
		// $ids = explode(',', $apk['logbook_pegawai']);
		// $this->db->where_in('id_logbook',$ids);
		$this->db->where('id_logbook BETWEEN "'.$apk['id_logbook_a']. '" and "'.$apk['id_logbook_b'].'"');
		$this->db->where('id_pegawai',$apk['id_pegawai']);
		$this->db->where('v_karu =', '1');
		$this->db->where('v_kabid', '1');
		$this->db->where('v_asesor', '1');
		$this->db->where('v_komite', '0');
		$this->db->where('v_direktur', '0');
        $query = $this->db->select("COUNT(*) as num")->get_where('logbook');
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
    }
	function update_acc_kompetensi_kabid($id){
		$data_v_karu = array(
			'acc_logbook_komite' => 1
		);
		$this->db->where('id_pengajuan',$id);
		$this->db->update('kr_pengajuan', $data_v_karu);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
    function update_berkaspengajuan($data = array()){
		$insert = $this->db->update_batch('kr_pengajuan',$data,'id_pengajuan');
        return $insert?true:false;
    }
	function perbaiki_proses_kabid($id){
		$data_v_karu = array(
			'acc_komite' => 0,
			'acc_logbook_komite' => 0
		);
		$this->db->where('id_pengajuan',$id);
		$this->db->update('kr_pengajuan', $data_v_karu);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function update_proses_kabid($id){
		$data_v_karu = array(
			'acc_komite' => 0,
			'status_pengajuan' => 0,
			'acc_logbook_komite' => 0
		);
		$this->db->where('id_pengajuan',$id);
		$this->db->update('kr_pengajuan', $data_v_karu);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function update_terbitkan($id,$isi){
		$data_v_karu = array(
			'status_terbitkan' => $isi
		);
		$this->db->where('id_pengajuan',$id);
		$this->db->update('kr_pengajuan', $data_v_karu);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function simpan_kewenangan_lulus($id_kewenangan,$id_pegawai){
		$data_pendaftaran = array(
			'id_kewenangan' => $id_kewenangan,
			'id_pegawai' => $id_pegawai
		);
		$this->db->insert('kr_kewenangan_lulus', $data_pendaftaran);
	}
	function hapus_kewenangan_lulus($id_kewenangan,$id_pegawai){
        $this->db->where('id_kewenangan', $id_kewenangan);
        $this->db->where('id_pegawai', $id_pegawai);
        $this->db->delete('kr_kewenangan_lulus');
	}
}
