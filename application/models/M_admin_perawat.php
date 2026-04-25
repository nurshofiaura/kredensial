<?php
class M_admin_perawat extends CI_model{
	function simpan_pengumuman($id,$level){
		$Skr = date('Y-m-d');
		$id_pegawai = $this->session->id_pegawai;
		$Now = date('H:i:s');
		if($level == '99'){
			$ide= 0;
		}else{
			$ide = $id;
		}
		$data_kewenangan = array(
			'id_pegawai' => $id_pegawai,
			'isi_pengumuman' => $this->input->post('isi_pengumuman'),
//			'id_jabatan' => $ide,
			'tgl_pengumuman' => $Skr,
			'jam_pengumuman' => $Now
		);
		return $this->db->insert('pengumuman', $data_kewenangan);
	}
	function pegawai_all($unit)
	{
		$ids = explode(',', $unit);
	//--------- Ambil nama kolom --------- [coding here] .jpg
	$fields = "*,if (foto = '' ,'noavatar.jpg',foto) as foto,
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
				$this->db->where('visible','1');
	$this->db->where_in('id_jabatan',$ids);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('pegawai peg');
	$this->db->join('jabatan_fungsional r','r.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
	$this->db->join('ruangan rg','rg.id_ruangan=peg.id_ruangan','left');
	$this->db->join('kol_status_kawin kss', 'kss.id_status_kawin=peg.id_status_kawin','left');
	$this->db->join('kol_status_pegawai ksp', 'ksp.id_status_pegawai=peg.tipe_pegawai','left');
		$this->db->join('kol_pendidikan kp', 'kp.id_pendidikan=peg.id_pendidikan','left');
	$this->db->where('visible','1');
	$this->db->where_in('id_jabatan',$ids);

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
				$this->db->where('visible','1');
	$this->db->where_in('id_jabatan',$ids);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	$this->db->from('pegawai peg');
$this->db->join('jabatan_fungsional r','r.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
$this->db->join('ruangan rg','rg.id_ruangan=peg.id_ruangan','left');
$this->db->join('kol_status_kawin kss', 'kss.id_status_kawin=peg.id_status_kawin','left');
	$this->db->join('kol_status_pegawai ksp', 'ksp.id_status_pegawai=peg.tipe_pegawai','left');
		$this->db->join('kol_pendidikan kp', 'kp.id_pendidikan=peg.id_pendidikan','left');
		$this->db->where('visible','1');
	$this->db->where_in('id_jabatan',$ids);

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
	function simpan_pegawai($pic){
		$kosong = "";
		$nol = "0";
		$tglkosong = "0000-00-00";
		$kode = $this->m_rancak->kode_generator(15,'');
		$data_pendaftaran = array(
			'nik' => $kosong,
			'nip' => $this->input->post('nip'),
			'barcode_pegawai' => $kode,
			'email' =>$this->input->post('email'),
			'nama_pegawai' => $this->input->post('nama_pegawai'),
			'id_unit' =>$this->input->post('id_unit'),
			'id_ruangan' =>$this->input->post('id_ruangan'),
			'tipe_pegawai' =>$this->input->post('tipe_pegawai'),
			'id_jabatan_fungsional' =>$this->input->post('id_jabatan_fungsional'),
			'no_hp' =>$this->input->post('no_hp'),
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
		$kode = $this->m_rancak->kode_generator(15,'');
		$data_pendaftaran = array(
			'nik' => $kosong,
			'nip' => $this->input->post('nip'),
			'barcode_pegawai' => $kode,
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
			'status_user' => 1
		);
		return $this->db->insert('user', $data_pendaftaran);
	}
	function simpan_perawat_detil(){
		$id_pegawai = $this->input->post('id_pegawai');
		$data_pendaftaran = array(
			'id_pegawai' => $id_pegawai,
			'id_kode_kewenangan' => $this->input->post('id_kode_kewenangan')
		);
		return $this->db->insert('perawat_detil', $data_pendaftaran);
	}
	function simpan_perawat_detil2($id_pegawai){
		$data_pendaftaran = array(
			'id_pegawai' => $id_pegawai,
			'id_kode_kewenangan' => $this->input->post('id_kode_kewenangan')
		);
		return $this->db->insert('perawat_detil', $data_pendaftaran);
	}
	function edit_pegawai($pic){
		$id_pegawai = $this->input->post('id_pegawai');
		$data_pendaftaran = array(
			'nip' =>$this->input->post('nip'),
			'email' =>$this->input->post('email'),
			'nama_pegawai' => $this->input->post('nama_pegawai'),
			'id_unit' =>$this->input->post('id_unit'),
			'id_ruangan' =>$this->input->post('id_ruangan'),
			'no_hp' =>$this->input->post('no_hp'),
			'id_jabatan_fungsional' =>$this->input->post('id_jabatan_fungsional'),
			'jk' =>$this->input->post('jk'),
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
			'nip' =>$this->input->post('nip'),
			'email' =>$this->input->post('email'),
			'nama_pegawai' => $this->input->post('nama_pegawai'),
			'id_unit' =>$this->input->post('id_unit'),
			'id_ruangan' =>$this->input->post('id_ruangan'),
			'no_hp' =>$this->input->post('no_hp'),
			'id_jabatan_fungsional' =>$this->input->post('id_jabatan_fungsional'),
			'jk' =>$this->input->post('jk'),
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
	function simpan_pegawai_del($id){
		$peg = $this->m_umum->ambil_data('pegawai','id_pegawai',$id);
		$data_pendaftaran = array(
			'id_pegawai' => $id,
			'nama_pegawai' => $peg['nama_pegawai'],
			'no_hp' => $peg['no_hp'],
			'nik' => $peg['nik'],
			'nip' => $peg['nip'],
			'no_profesi' => $peg['no_profesi'],
			'id_ruangan' => $peg['id_ruangan'],
			'alamat' => $peg['alamat']
		);
		$this->db->insert('pegawai_del', $data_pendaftaran);
		return $this->db->insert_id();
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
				$this->db->or_like($nmf, $cari['value'],'both',false);			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	$this->db->from('kol_catatan');

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
	$this->db->from('kol_catatan');


		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----

		$jml = $this->m_umum->jumlah_record_tabel('kol_catatan');			//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
	//	 print_r($output);die();
		return $output;
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
	function rubah_catatan_oppe(){
		$kode_catatan = $this->input->post('kode_catatan');
		$data_pendaftaran = array(
			'isi_catatan' => $this->input->post('isi_catatan'),
			'nama_catatan' => $this->input->post('nama_catatan')
		);
		$this->db->where('kode_catatan',$kode_catatan);
		$this->db->update('kol_catatan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
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
	function warna_all()
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

	    $this->db->from('kol_warna');

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
	    $this->db->from('kol_warna');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('kol_warna');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_warna(){
		$data_pendaftaran = array(
			'nama_warna' => $this->input->post('nama_warna'),
			'kode_warna' => $this->input->post('kode_warna')
		);
		return $this->db->insert('kol_warna', $data_pendaftaran);
	}
	function edit_warna(){
		$id_warna = $this->input->post('id_warna');
		$data_pendaftaran = array(
			'nama_warna' => $this->input->post('nama_warna'),
			'kode_warna' => $this->input->post('kode_warna')
		);
		$this->db->where('id_warna',$id_warna);
		$this->db->update('kol_warna', $data_pendaftaran);
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
		$fields = "*,if(status_kompetensi = '1' ,'AKTIF','NON AKTIF') as status_kompetensi";
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

	    $this->db->from('kr_kompetensi k');
		$this->db->join('jabatan pf', 'pf.id_jabatan=k.id_jabatan','left');

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
	    $this->db->from('kr_kompetensi k');
		$this->db->join('jabatan pf', 'pf.id_jabatan=k.id_jabatan','left');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('kr_kompetensi');

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
		return $this->db->insert('kr_kompetensi', $data_pendaftaran);
	}
	function edit_kompetensi(){
		$id_kompetensi = $this->input->post('id_kompetensi');
		$data_pendaftaran = array(
			'nama_kompetensi' => $this->input->post('nama_kompetensi'),
			'id_jabatan' => $this->input->post('id_jabatan'),
			'status_kompetensi' => $this->input->post('status_kompetensi')
		);
		$this->db->where('id_kompetensi',$id_kompetensi);
		$this->db->update('kr_kompetensi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function kewenangan_all($id_jabatan)
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
				if($id_jabatan >'0'){
					$this->db->where("k.id_jabatan", $id_jabatan);
				}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('kr_kewenangan kk');
		$this->db->join('kr_kompetensi k', 'k.id_kompetensi=kk.id_kompetensi','left');
		$this->db->join('jabatan pf', 'pf.id_jabatan=k.id_jabatan','left');
		if($id_jabatan >'0'){
			$this->db->where("k.id_jabatan", $id_jabatan);
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
				if($id_jabatan >'0'){
					$this->db->where("k.id_jabatan", $id_jabatan);
				}
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('kr_kewenangan kk');
		$this->db->join('kr_kompetensi k', 'k.id_kompetensi=kk.id_kompetensi','left');
		$this->db->join('jabatan pf', 'pf.id_jabatan=k.id_jabatan','left');
		if($id_jabatan >'0'){
			$this->db->where("k.id_jabatan", $id_jabatan);
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('kr_kewenangan');

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
			'wkt_kewenangan' => $this->input->post('wkt_kewenangan')
		);
		return $this->db->insert('kr_kewenangan', $data_pendaftaran);
	}
	function edit_kewenangan(){
		$id_kewenangan = $this->input->post('id_kewenangan');
		$data_pendaftaran = array(
			'nama_kewenangan' => $this->input->post('nama_kewenangan'),
			'id_kompetensi' => $this->input->post('id_kompetensi'),
			'wkt_kewenangan' => $this->input->post('wkt_kewenangan')
		);
		$this->db->where('id_kewenangan',$id_kewenangan);
		$this->db->update('kr_kewenangan', $data_pendaftaran);
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
				if($id!=='0'){
					$this->db->where("kd.id_unit", $id);
				}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('kr_kewenangan_detil kd');
		$this->db->join('kr_kewenangan k', 'k.id_kewenangan=kd.id_kewenangan','left');
		$this->db->join('kr_kompetensi kp', 'kp.id_kompetensi=k.id_kompetensi','left');
		$this->db->join('kol_kode_kewenangan kw', 'kw.id_kode_kewenangan=kd.id_kode_kewenangan','left');
		$this->db->join('kol_sifat_kewenangan sk', 'sk.id_sifat_kewenangan=kd.id_sifat_kewenangan','left');
		$this->db->join('jabatan pro', 'pro.id_jabatan=kp.id_jabatan','left');
		$this->db->join('ruangan r', 'r.id_ruangan=kd.id_unit','left');
		if($id!=='0'){
			$this->db->where("kd.id_unit", $id);
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
				if($id!=='0'){
					$this->db->where("kd.id_unit", $id);
				}
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('kr_kewenangan_detil kd');
		$this->db->join('kr_kewenangan k', 'k.id_kewenangan=kd.id_kewenangan','left');
		$this->db->join('kr_kompetensi kp', 'kp.id_kompetensi=k.id_kompetensi','left');
		$this->db->join('kol_kode_kewenangan kw', 'kw.id_kode_kewenangan=kd.id_kode_kewenangan','left');
		$this->db->join('kol_sifat_kewenangan sk', 'sk.id_sifat_kewenangan=kd.id_sifat_kewenangan','left');
		$this->db->join('jabatan pro', 'pro.id_jabatan=kp.id_jabatan','left');
		$this->db->join('ruangan r', 'r.id_ruangan=kd.id_unit','left');
		if($id!=='0'){
			$this->db->where("kd.id_unit", $id);
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('kr_kewenangan_detil');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function cek_jabatan_untuk_simpan_kd($id){
		$this->db->select('kk.id_jabatan');
		$this->db->join('kr_kompetensi kk', 'kk.id_kompetensi=kke.id_kompetensi','left');
		$q = $this->db->get_where('kr_kewenangan kke',array('id_kewenangan'=>$id));
		return $q->row_array();
	}
	function simpan_kewenangan_detil(){
		// $id_kewenangan = $this->input->post('id_kewenangan');
		// $program    = $this->m_umum->ambil_data('a_program','id_program','1');
		// $program_jabatan = $program['jabatan'];
		// $cek = $this->cek_jabatan_untuk_simpan_kd($id_kewenangan);
		// if(in_array($cek['id_jabatan'],explode(",", $program_jabatan))){
		// 	$id_kode_kewenangan = $this->input->post('id_kode_kewenangan');
		// 	$id_sifat_kewenangan = $this->input->post('id_sifat_kewenangan');
		// 	$kompeten = $this->m_umum->ambil_data('kr_kewenangan','id_kewenangan',$id_kewenangan);
		// 	$kompetensi = $kompeten['id_kompetensi'];
		// }else{
		// 	$id_kode_kewenangan = 0;
		// 	$id_sifat_kewenangan = 0;
		// 	$kompetensi = 0;
		// }
		$chk = $this->input->post('chk[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				$this->db->select("COUNT(*) as num");
				$this->db->where('id_kewenangan',$this->input->post('id_kewenangan'));
				$this->db->where('id_kode_kewenangan',$this->input->post('id_kode_kewenangan'));
				$this->db->where('id_sifat_kewenangan',$this->input->post('id_sifat_kewenangan'));
				$this->db->where('id_unit',$chk[$i]);
				$q = $this->db->get('kr_kewenangan_detil')->row();
				$jml = $q->num;
				if($jml == 0){
					$data_pendaftaran = array(
						'id_unit' => $chk[$i],
						'id_kewenangan' => $this->input->post('id_kewenangan'),
						'id_kode_kewenangan' =>  $this->input->post('id_kode_kewenangan'),
						'id_sifat_kewenangan' =>  $this->input->post('id_sifat_kewenangan')
					);
					$this->db->insert('kr_kewenangan_detil', $data_pendaftaran);
				}
			}
		}
	}
	function simpan_kewenangan_detil_unit(){
		$chk = $this->input->post('chk[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				$this->db->select("COUNT(*) as num");
				$this->db->where('id_kewenangan', $chk[$i]);
				$this->db->where('id_kode_kewenangan',$this->input->post('id_kode_kewenangan'));
				$this->db->where('id_sifat_kewenangan',$this->input->post('id_sifat_kewenangan'));
				$this->db->where('id_unit',$this->input->post('id_unit'));
				$q = $this->db->get('kr_kewenangan_detil')->row();
				$jml = $q->num;
				if($jml == 0){
					$data_pendaftaran = array(
						'id_unit' =>  $this->input->post('id_unit'),
						'id_kewenangan' => $chk[$i],
						'id_kode_kewenangan' =>  $this->input->post('id_kode_kewenangan'),
						'id_sifat_kewenangan' =>  $this->input->post('id_sifat_kewenangan')
					);
					$this->db->insert('kr_kewenangan_detil', $data_pendaftaran);
				}
			}
		}
	}
	function edit_kewenangan_detil(){
		$id_kewenangan_detil = $this->input->post('id_kewenangan_detil');
		$kompeten = $this->m_umum->ambil_data('kr_kewenangan','id_kewenangan',$this->input->post('id_kewenangan'));
		$kompetensi = $kompeten['id_kompetensi'];
		$data_kewenangan_detil = array(
			'id_kewenangan' => $this->input->post('id_kewenangan'),
			'id_kode_kewenangan' => $this->input->post('id_kode_kewenangan'),
			'id_sifat_kewenangan' => $this->input->post('id_sifat_kewenangan'),
			'id_unit' =>$this->input->post('id_unit')
		);
		$this->db->where('id_kewenangan_detil',$id_kewenangan_detil);
		$this->db->update('kr_kewenangan_detil', $data_kewenangan_detil);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function butir_kegiatan_all($id)
	{
	//	$ids = explode(',', $unit);
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,ROUND(angka_kredit, 4) as ms_angka_kredit";
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
				if($id!=='0'){
					$this->db->where("bk.id_jabatan_fungsional", $id);
				}
	//			$this->db->where_in('id_jabatan', ['4','19','20']);

			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('butir_kegiatan bk');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=bk.id_jabatan_fungsional','left');
		$this->db->join('kol_status_pegawai ksp', 'ksp.id_status_pegawai=jf.id_status_pegawai','left');
		if($id!=='0'){
			$this->db->where("bk.id_jabatan_fungsional", $id);
		}
//		$this->db->where_in('id_jabatan', ['4','19','20']);

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
				if($id!=='0'){
					$this->db->where("bk.id_jabatan_fungsional", $id);
				}
//				$this->db->where_in('id_jabatan', ['4','19','20']);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('butir_kegiatan bk');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=bk.id_jabatan_fungsional','left');
		$this->db->join('kol_status_pegawai ksp', 'ksp.id_status_pegawai=jf.id_status_pegawai','left');
		if($id!=='0'){
			$this->db->where("bk.id_jabatan_fungsional", $id);
		}
//		$this->db->where_in('id_jabatan', ['4','19','20']);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('kr_kewenangan_detil');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_butir_kegiatan(){
		$data_pendaftaran = array(
			'id_jabatan_fungsional' => $this->input->post('id_jabatan_fungsional'),
			'nama_butir_kegiatan' => $this->input->post('nama_butir_kegiatan'),
			'angka_kredit' => $this->input->post('ms_angka_kredit'),
			'satuan_hasil' => $this->input->post('ms_satuan_hasil'),
			'status_butir_kegiatan' => 1
		);
		return $this->db->insert('butir_kegiatan', $data_pendaftaran);
	}
	function edit_butir_kegiatan(){
		$id_butir_kegiatan = $this->input->post('id_butir_kegiatan');
		$data_v_karu = array(
			'id_jabatan_fungsional' => $this->input->post('id_jabatan_fungsional'),
			'nama_butir_kegiatan' => $this->input->post('nama_butir_kegiatan'),
			'angka_kredit' => $this->input->post('ms_angka_kredit'),
			'satuan_hasil' => $this->input->post('ms_satuan_hasil')
		);
		$this->db->where('id_butir_kegiatan',$id_butir_kegiatan);
		$this->db->update('butir_kegiatan', $data_v_karu);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function butir_kewenangan_all($id)
	{
	//	$ids = explode(',', $unit);
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,if (kj.status_jabfung = '1' ,'AKTIF','NON AKTIF') as status_jabfung";
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
		//		$this->db->where_in('id_jabatan', ['4','19','20']);
				$this->db->where("kj.id_butir_kegiatan", $id);

			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

   	    $this->db->from('kr_jabfung kj');
		$this->db->join('butir_kegiatan bk', 'bk.id_butir_kegiatan=kj.id_butir_kegiatan','left');
		$this->db->join('kr_kewenangan kk', 'kk.id_kewenangan=kj.id_kewenangan','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=bk.id_jabatan_fungsional','left');
	//	$this->db->where_in('id_jabatan', ['4','19','20']);
		$this->db->where("kj.id_butir_kegiatan", $id);

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
		//		$this->db->where_in('id_jabatan', ['4','19','20']);
				$this->db->where("kj.id_butir_kegiatan", $id);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('kr_jabfung kj');
		$this->db->join('butir_kegiatan bk', 'bk.id_butir_kegiatan=kj.id_butir_kegiatan','left');
		$this->db->join('kr_kewenangan kk', 'kk.id_kewenangan=kj.id_kewenangan','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=bk.id_jabatan_fungsional','left');
	//	$this->db->where_in('id_jabatan', ['4','19','20']);
		$this->db->where("kj.id_butir_kegiatan", $id);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('kr_kewenangan_detil');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_kr_jabfung(){
		$id_butir_kegiatan = $this->input->post('id_butir_kegiatan');
		$chk = $this->input->post('chk[]');
		$Skr = date('Y-m-d');
		$jml_kode = count($chk);
		for ($i=0;$i<$jml_kode;$i++){
			$this->db->select("COUNT(*) as num");
			$this->db->where('id_butir_kegiatan',$id_butir_kegiatan);
			$this->db->where('id_kewenangan',$chk[$i]);
			$q = $this->db->get('kr_jabfung')->row();
			$jml = $q->num;
			if($jml == 0){
				$data_pendaftaran = array(
					'id_kewenangan' => $chk[$i],
					'id_butir_kegiatan' => $id_butir_kegiatan,
					'status_jabfung' => 1
				);
				$this->db->insert('kr_jabfung', $data_pendaftaran);
			}
		}
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
				if($id!=='0'){
					$this->db->where("bp.id_pegawai", $id);
				}
		$this->db->where("bulan_buket_pegawai", $bulan);
		$this->db->where("tahun_buket_pegawai", $tahun);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('kr_buket_pegawai bp');
		$this->db->join('butir_kegiatan bk', 'bk.id_butir_kegiatan=bp.id_butir_kegiatan','left');
		$this->db->join('pegawai peg', 'peg.id_pegawai=bp.id_pegawai','left');
		if($id!=='0'){
			$this->db->where("bp.id_pegawai", $id);
		}
		$this->db->where("bulan_buket_pegawai", $bulan);
		$this->db->where("tahun_buket_pegawai", $tahun);

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
				if($id!=='0'){
					$this->db->where("bp.id_pegawai", $id);
				}
		$this->db->where("bulan_buket_pegawai", $bulan);
		$this->db->where("tahun_buket_pegawai", $tahun);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('kr_buket_pegawai bp');
		$this->db->join('butir_kegiatan bk', 'bk.id_butir_kegiatan=bp.id_butir_kegiatan','left');
		$this->db->join('pegawai peg', 'peg.id_pegawai=bp.id_pegawai','left');
		if($id!=='0'){
			$this->db->where("bp.id_pegawai", $id);
		}
		$this->db->where("bulan_buket_pegawai", $bulan);
		$this->db->where("tahun_buket_pegawai", $tahun);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('kr_jabfung');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function status_buket_pegawai_rubah($id_buket_pegawai,$status_buket_pegawai){
		$data_v_karu = array(
			'status_buket_pegawai' => $status_buket_pegawai
		);
		$this->db->where('id_buket_pegawai',$id_buket_pegawai);
		$this->db->update('kr_buket_pegawai', $data_v_karu);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function etik_all($id_jabatan,$jabatan,$level)
	{
		$ids = explode(',', $jabatan);
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,if(kol_etik.status_etik = '1' ,'AKTIF','NON AKTIF') as status_etik";
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
				if($level !== '99'){
				$this->db->where_in('kol_etik.id_jabatan',$ids);
				}
				if($id_jabatan >'0'){
					$this->db->where("kol_etik.id_jabatan", $id_jabatan);
				}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('kol_etik');
		$this->db->join('jabatan', 'jabatan.id_jabatan=kol_etik.id_jabatan','left');
				if($level !== '99'){
				$this->db->where_in('kol_etik.id_jabatan',$ids);
				}
		if($id_jabatan >'0'){
			$this->db->where("kol_etik.id_jabatan", $id_jabatan);
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
				if($level !== '99'){
				$this->db->where_in('kol_etik.id_jabatan',$ids);
				}
				if($id_jabatan >'0'){
					$this->db->where("kol_etik.id_jabatan", $id_jabatan);
				}
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('kol_etik');
		$this->db->join('jabatan', 'jabatan.id_jabatan=kol_etik.id_jabatan','left');
				if($level !== '99'){
				$this->db->where_in('kol_etik.id_jabatan',$ids);
				}
		if($id_jabatan >'0'){
			$this->db->where("kol_etik.id_jabatan", $id_jabatan);
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('kol_etik');

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
				'status_etik' => $this->input->post('status_etik')
			);
			$this->db->insert('kol_etik', $data_pendaftaran);
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
		$this->db->update('kol_etik', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function kr_jabfung_all($id)
	{
	//	$ids = explode(',', $unit);
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,if (status_jabfung = '1' ,'AKTIF','NON AKTIF') as status_jabfung";
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
		$this->db->where("id_jabatan", $id);
		}

			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

   	    $this->db->from('kr_buket_pegawai kbp');
		$this->db->join('kr_jabfung kj', 'kj.id_butir_kegiatan=kbp.id_butir_kegiatan','left');
		$this->db->join('butir_kegiatan bk', 'bk.id_butir_kegiatan=kj.id_butir_kegiatan','left');
		$this->db->join('kr_kewenangan kk', 'kk.id_kewenangan=kj.id_kewenangan','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=bk.id_jabatan_fungsional','left');
	//	$this->db->where_in('id_jabatan', ['4','19','20']);
		if($id > 0){
		$this->db->where("id_jabatan", $id);
		}
		$this->db->group_by('kj.id_butir_kegiatan');

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
		$this->db->where("id_jabatan", $id);
		}
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
   	    $this->db->from('kr_buket_pegawai kbp');
		$this->db->join('kr_jabfung kj', 'kj.id_butir_kegiatan=kbp.id_butir_kegiatan','left');
		$this->db->join('butir_kegiatan bk', 'bk.id_butir_kegiatan=kj.id_butir_kegiatan','left');
		$this->db->join('kr_kewenangan kk', 'kk.id_kewenangan=kj.id_kewenangan','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=bk.id_jabatan_fungsional','left');
		if($id > 0){
		$this->db->where("id_jabatan", $id);
		}
		$this->db->group_by('kj.id_butir_kegiatan');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('kr_buket_pegawai kbp');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
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

	    $this->db->from('kr_kewenangan_lulus kl');
		$this->db->join('kr_kewenangan k', 'k.id_kewenangan=kl.id_kewenangan','left');
		$this->db->join('kr_kompetensi kp', 'kp.id_kompetensi=k.id_kompetensi','left');
		$this->db->join('pegawai peg', 'peg.id_pegawai=kl.id_pegawai','left');
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
	    $this->db->from('kr_kewenangan_lulus kl');
		$this->db->join('kr_kewenangan k', 'k.id_kewenangan=kl.id_kewenangan','left');
		$this->db->join('kr_kompetensi kp', 'kp.id_kompetensi=k.id_kompetensi','left');
		$this->db->join('pegawai peg', 'peg.id_pegawai=kl.id_pegawai','left');
		if($id > 0){
		$this->db->where("kl.id_pegawai", $id);
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$kondisi=array('id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('kr_kewenangan_lulus',$kondisi);		//[coding here] ganti tabel utamanya

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
		$q = $this->db->get('kr_kewenangan_lulus')->row();
		$jml = $q->num;
		if($jml == 0){
			$data_pendaftaran = array(
				'id_kewenangan' => $chk[$i],
				'id_pegawai' => $id
			);
			$this->db->insert('kr_kewenangan_lulus', $data_pendaftaran);
		}
		}
	}
	function edit_web(){
		$id_instansi = $this->input->post('id_instansi');
		$data_v_karu = array(
			'nama_instansi' => $this->input->post('nama_instansi'),
			'web_header' => $this->input->post('web_header'),
			'web_intro' => $this->input->post('web_intro'),
			'web_slider' => $this->input->post('web_slider'),
			'welcome' => $this->input->post('welcome')
		);
		$this->db->where('id_instansi',1);
		$this->db->update('a_instansi', $data_v_karu);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function faq_all()
	{
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,if (status_faq = '1' ,'AKTIF','NON AKTIF') as status_faq";
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

	    $this->db->from('faq');

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
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('faq');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99');
		$jml = $this->m_umum->jumlah_record_filter('pegawai',$kondisi);	 */
		$jml = $this->m_umum->jumlah_record_tabel('faq');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_faq(){
		$data_pendaftaran = array(
			'judul_faq' => $this->input->post('judul_faq'),
			'isi_faq' => $this->input->post('isi_faq'),
			'status_faq' => $this->input->post('status_faq'),
			'faq' => $this->input->post('faq')
		);
		return $this->db->insert('faq', $data_pendaftaran);
	}
	function edit_faq(){
		$id_faq = $this->input->post('id_faq');
		$data_v_karu = array(
			'judul_faq' => $this->input->post('judul_faq'),
			'isi_faq' => $this->input->post('isi_faq'),
			'status_faq' => $this->input->post('status_faq'),
			'faq' => $this->input->post('faq')
		);
		$this->db->where('id_faq',$id_faq);
		$this->db->update('faq', $data_v_karu);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function upload_all()
	{
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,if (status_faq_image = '1' ,'AKTIF','NON AKTIF') as status_faq_image";
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

	    $this->db->from('faq_image');

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
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('faq_image');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99');
		$jml = $this->m_umum->jumlah_record_filter('pegawai',$kondisi);	 */
		$jml = $this->m_umum->jumlah_record_tabel('faq_image');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_image($id){
		$data_kewenangan = array(
			'nama_faq_image' => $this->input->post('nama_faq_image'),
			'status_faq_image' => $this->input->post('status_faq_image'),
			'link_faq_image' => $id

		);
		return $this->db->insert('faq_image', $data_kewenangan);
	}
	function edit_image(){
		$id_faq_image = $this->input->post('id_faq_image');
		$data_v_karu = array(
			'nama_faq_image' => $this->input->post('nama_faq_image'),
			'status_faq_image' => $this->input->post('status_faq_image')
		);
		$this->db->where('id_faq_image',$id_faq_image);
		$this->db->update('faq_image', $data_v_karu);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
}
