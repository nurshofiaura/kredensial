<?php
class M_karu extends CI_model{
	function lb($data){
		$first_date = '01-01-'.$data['thn'];
		$last_date = '31-12-'.$data['thn'];
		$this->db->select("DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_logbook,DATE_FORMAT(tgl_logbook,'%m-%Y') as tgl_logbooke");
		$this->db->join('pegawai', 'pegawai.id_pegawai=logbook.id_pegawai','left');
	//	$this->db->where('logbook.id_pegawai', '459');
		$this->db->where('pegawai.id_ruangan', $data['room_id']);
		$this->db->where('tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$this->db->group_by("MONTH(tgl_logbook)");
		$q = $this->db->get('logbook')->result_array();
		//echo $this->db->last_query();die();
		return $q;
	}
	function lb2($tgl,$id,$id_pegawai){
		$this->db->select("logbook.id_pegawai,SUM(logbook.jml_logbook) as jml_logbook");
		$this->db->join('pegawai', 'pegawai.id_pegawai=logbook.id_pegawai','left');
	//	$this->db->where('logbook.id_pegawai', '459');
		$this->db->where('pegawai.id_ruangan', $id);
		$this->db->where('YEAR(logbook.tgl_logbook)', date('Y', strtotime($tgl)));
		$this->db->where('MONTH(logbook.tgl_logbook)', date('m', strtotime($tgl)));
		$this->db->group_by("logbook.id_pegawai");
		$q = $this->db->get('logbook')->result_array();
	//	echo $this->db->last_query();die();
		return $q;
	}
// ================================================= USER ==============================
	function user_all($unit,$level)
	{
		$ids = explode(',', $unit);
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,if (status_user = '1' ,'AKTIF','NON AKTIF') as status_user,if (foto = '' ,'noavatar.jpg',foto) as foto";
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
				$this->db->where('peg.id_ruangan',$unit);
				}
				$this->db->where("u.id_level !=", '99');
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('user u');
		$this->db->join('pegawai peg','peg.id_pegawai=u.id_pegawai','left');
		$this->db->join('user_level ul','ul.id_level=u.id_level','left');
		if($level !== '99'){
		$this->db->where('peg.id_ruangan',$unit);
		}
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
				if($level !== '99'){
				$this->db->where('peg.id_ruangan',$unit);
				}
				$this->db->where("u.id_level !=", '99');
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('user u');
		$this->db->join('pegawai peg','peg.id_pegawai=u.id_pegawai','left');
		$this->db->join('user_level ul','ul.id_level=u.id_level','left');
		if($level !== '99'){
		$this->db->where_in('peg.id_unit',$ids);
		}
		$this->db->where("u.id_level !=", '99');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$kondisi=array('id_level !='=>'99');
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
	function edit_pegawai_no_pic(){
		$id_pegawai = $this->input->post('id_pegawai');
		$data_pendaftaran = array(
			'nama_pegawai' => $this->input->post('nama_pegawai'),
			'id_ruangan' =>$this->input->post('id_ruangan'),
			'tipe_pegawai' =>$this->input->post('tipe_pegawai'),
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
	function etik_pegawai_all($id,$idp,$level)
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,pegawai.nama_pegawai as nama_pegawai,p2.nama_pegawai as id_penguji";
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
		if($level !== '99'){
			$this->db->where("pegawai.id_ruangan", $id);
		}
		if($idp > 0){
			$this->db->where("kr_etik_pegawai.id_pegawai", $idp);
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('kr_etik_pegawai');
		$this->db->join('pegawai', 'pegawai.id_pegawai=kr_etik_pegawai.id_pegawai','left');
		$this->db->join('pegawai p2', 'p2.id_pegawai=kr_etik_pegawai.id_penguji','left');
		if($level !== '99'){
			$this->db->where("pegawai.id_ruangan", $id);
		}
		if($idp > 0){
			$this->db->where("kr_etik_pegawai.id_pegawai", $idp);
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
		if($level !== '99'){
			$this->db->where("pegawai.id_ruangan", $id);
		}
		if($idp > 0){
			$this->db->where("kr_etik_pegawai.id_pegawai", $idp);
		}
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('kr_etik_pegawai');
		$this->db->join('pegawai', 'pegawai.id_pegawai=kr_etik_pegawai.id_pegawai','left');
		$this->db->join('pegawai p2', 'p2.id_pegawai=kr_etik_pegawai.id_penguji','left');
		if($level !== '99'){
			$this->db->where("pegawai.id_ruangan", $id);
		}
		if($idp > 0){
			$this->db->where("kr_etik_pegawai.id_pegawai", $idp);
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('kr_etik_pegawai');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function cmd_pegawai_null($id,$level){
		$this->db->select('nama_pegawai,id_pegawai');
		$this->db->where('id_ruangan',$id);
		$q = $this->db->get_where('pegawai');
		return $q->result_array();
	}
	function kol_etik_all($id){
		$q = $this->db->get_where('kol_etik',array('status_etik'=>'1','id_jabatan'=>$id));
		return $q->result_array();
	}
	function kol_etik_detil_all($id){
		$this->db->join('kol_etik', 'kol_etik.id_etik=kr_etik_detil.id_etik','left');
		$this->db->join('kr_etik_pegawai', 'kr_etik_pegawai.id_etik_pegawai=kr_etik_detil.id_etik_pegawai','left');
		$q = $this->db->get_where('kr_etik_detil',array('kr_etik_detil.id_etik_pegawai'=>$id));
		return $q->result_array();
	}
	function num_kol_etik_all($id){
		$this->db->select('COUNT(id_etik) as count_koletik');
		$this->db->where('status_etik', '1');
		$this->db->where('id_jabatan', $id);
		$q = $this->db->get_where('kol_etik');
		return $q->row_array();
	}
	function etik_pegawairow_all($id){
		$this->db->select('*');
		$this->db->where('kr_etik_pegawai.id_etik_pegawai =', $id);
		$q = $this->db->get_where('kr_etik_pegawai');
		return $q->row_array();
	}
	function simpan_etik_pegawai(){
		$id_pegawai = $this->input->post('id_pegawai');
		$sub_total = $this->input->post('sub_total');
		$hasilGR = $this->input->post('hasilGR');
		$total = $this->input->post('total');
		$id_penguji = $this->input->post('id_penguji');
		$Skr = date('Y-m-d');
		$clock = date('H:i:s');
		$data_pendaftaran = array(
				'id_pegawai' => $id_pegawai,
				'tgl_etik_pegawai' => $Skr,
				'id_penguji' => $id_penguji,
				'total_etik' => $sub_total,
				'hasil_etik' => $hasilGR,
				'jumlah_etik' => $total,
				'jam_etik_pegawai' => $clock
			);
		$this->db->insert('kr_etik_pegawai', $data_pendaftaran);
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
				$this->db->insert('kr_etik_detil', $data_pendaftaran);
		}
	}
	function logbook_all($first_date,$last_date,$id,$id_ruangan,$level)
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,
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
		$this->db->where("peg.id_ruangan", $id_ruangan);
		if($id > 0){
			$this->db->where("lp.id_pegawai", $id);
			$this->db->where('lp.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		}

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
		$this->db->where("peg.id_ruangan", $id_ruangan);
		if($id > 0){
			$this->db->where("lp.id_pegawai", $id);
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
				//	case 'nama_pegawai' : $nmf="pegawai.nama_pegawai";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where("peg.id_ruangan", $id_ruangan);
		if($id > 0){
			$this->db->where("lp.id_pegawai", $id);
			$this->db->where('lp.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		}
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
		$this->db->where("peg.id_ruangan", $id_ruangan);
		if($id > 0){
			$this->db->where("lp.id_pegawai", $id);
			$this->db->where('lp.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		}

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
	function update_v_karu($isi,$id,$id_karu){
		$data_v_karu = array(
			'id_karu' => $id_karu,
			'tgl_v_karu' => date('Y-m-d'),
			'v_karu' => $isi
		);
		$this->db->where('id_logbook',$id);
//		$this->db->where('v_karu', '0');
		$this->db->where('v_kabid', '0');
		$this->db->where('v_asesor', '0');
		$this->db->where('v_komite', '0');
		$this->db->where('v_direktur', '0');
		$this->db->update('logbook', $data_v_karu);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function update_v_karu_all($isi,$first_date,$last_date,$id_pegawai,$id_karu){
		$data_v_karu = array(
			'id_karu' => $id_karu,
			'tgl_v_karu' => date('Y-m-d'),
			'v_karu' => $isi
		);
		$this->db->where('id_pegawai',$id_pegawai);
		$this->db->where('v_karu', '0');
		$this->db->where('v_kabid', '0');
		$this->db->where('v_asesor', '0');
		$this->db->where('v_komite', '0');
		$this->db->where('v_direktur', '0');
		$this->db->where('tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
/* 		$this->db->where('tgl_logbook >=', $first_date);
		$this->db->where('tgl_logbook <=', $last_date); */
		$this->db->update('logbook', $data_v_karu);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
}
