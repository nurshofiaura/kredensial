<?php
class M_kabid extends CI_model{
	function cmd_pegawai_null($id,$level){
		$this->db->select('nama_pegawai,user.id_pegawai');
		$this->db->join('user', 'user.id_pegawai=pegawai.id_pegawai','left');
		$this->db->where('id_level','19');
		$this->db->group_by('user.id_pegawai');
		$q = $this->db->get_where('pegawai');
		return $q->result_array();
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
	function update_v_karu($isi,$first_date,$last_date,$id_pegawai,$id,$id_karu){
		$logbook = $this->m_umum->ambil_data('logbook','id_logbook',$id);
		$data_v_karu = array(
			'id_karu' => $id_karu,
			'tgl_v_karu' => date('Y-m-d'),
			'v_karu' => $isi
		);
		$this->db->where('id_kewenangan_detil',$logbook['id_kewenangan_detil']);
		$this->db->where('id_pegawai',$id_pegawai);
//		$this->db->where('v_karu', '0');
//		$this->db->where('v_kabid', '0');
		$this->db->where('v_asesor', '0');
		$this->db->where('v_komite', '0');
		$this->db->where('v_direktur', '0');
		$this->db->where('tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
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
	function update_v_kabid($isi,$first_date,$last_date,$id_pegawai,$id,$id_karu){
		$logbook = $this->m_umum->ambil_data('logbook','id_logbook',$id);
		$data_v_karu = array(
			'id_karu' => $id_karu,
			'tgl_v_karu' => date('Y-m-d'),
			'v_karu' => $isi,
			'id_kabid' => $id_karu,
			'tgl_v_kabid' => date('Y-m-d'),
			'v_kabid' => $isi
		);
		$this->db->where('id_kewenangan_detil',$logbook['id_kewenangan_detil']);
		$this->db->where('id_pegawai',$id_pegawai);
//		$this->db->where('v_karu', '0');
//		$this->db->where('v_kabid', '0');
		$this->db->where('v_asesor', '0');
		$this->db->where('v_komite', '0');
		$this->db->where('v_direktur', '0');
		$this->db->where('tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$this->db->update('logbook', $data_v_karu);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function update_v_kabid_all($isi,$first_date,$last_date,$id_pegawai,$id_karu){
		$data_v_karu = array(
			'id_karu' => $id_karu,
			'tgl_v_karu' => date('Y-m-d'),
			'v_karu' => $isi,
			'id_kabid' => $id_karu,
			'tgl_v_kabid' => date('Y-m-d'),
			'v_kabid' => $isi
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
		$this->db->where("user.id_level", '19');
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('kr_etik_pegawai');
		$this->db->join('pegawai', 'pegawai.id_pegawai=kr_etik_pegawai.id_pegawai','left');
		$this->db->join('user', 'user.id_pegawai=pegawai.id_pegawai','left');
		$this->db->join('pegawai p2', 'p2.id_pegawai=kr_etik_pegawai.id_penguji','left');
		$this->db->where("user.id_level", '19');

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
		$this->db->where("user.id_level", '19');
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('kr_etik_pegawai');
		$this->db->join('pegawai', 'pegawai.id_pegawai=kr_etik_pegawai.id_pegawai','left');
		$this->db->join('user', 'user.id_pegawai=pegawai.id_pegawai','left');
		$this->db->join('pegawai p2', 'p2.id_pegawai=kr_etik_pegawai.id_penguji','left');
		$this->db->where("user.id_level", '19');

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
	function kol_etik_all($id){
		$q = $this->db->get_where('kol_etik',array('status_etik'=>'1','id_jabatan'=>$id));
		return $q->result_array();
	}
	function num_kol_etik_all($id){
		$this->db->select('COUNT(id_etik) as count_koletik');
		$this->db->where('status_etik', '1');
		$this->db->where('id_jabatan', $id);
		$q = $this->db->get_where('kol_etik');
		return $q->row_array();
	}
	function kol_etik_detil_all($id){
		$this->db->join('kol_etik', 'kol_etik.id_etik=kr_etik_detil.id_etik','left');
		$this->db->join('kr_etik_pegawai', 'kr_etik_pegawai.id_etik_pegawai=kr_etik_detil.id_etik_pegawai','left');
		$q = $this->db->get_where('kr_etik_detil',array('kr_etik_detil.id_etik_pegawai'=>$id));
		return $q->result_array();
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
	function pengajuan_kompetensi_all($jabatan,$level)
	{
		$ids = explode(',', $jabatan);
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,peg.nama_pegawai as nama_pegawai,
					if(b.acc_direktur = '0' ,'Proses',if(b.acc_direktur = '1' ,'Kompeten','Ditolak')) as acc_direktur,
					if(b.acc_komite = '0' ,'Proses',if(b.acc_komite = '1' ,'Kompeten','Ditolak')) as acc_komite,
					if(b.acc_asesor = '0' ,'Proses',if(b.acc_asesor = '1' ,'Kompeten','Ditolak')) as acc_asesor,
					if(b.acc_kabid = '0' ,'Proses',if(b.acc_kabid = '1' ,'Kompeten','Ditolak')) as acc_kabid,peg2.nama_pegawai as id_asesor,
					if(b.tgl_acc_direktur = '0000-00-00' ,'Proses',DATE_FORMAT(b.tgl_acc_direktur,'%d-%m-%Y')) as tgl_acc_direktur,
					if(b.tgl_acc_komite = '0000-00-00' ,'Proses',DATE_FORMAT(b.tgl_acc_komite,'%d-%m-%Y')) as tgl_acc_komite,
					if(b.tgl_acc_asesor = '0000-00-00' ,'Proses',DATE_FORMAT(b.tgl_acc_asesor,'%d-%m-%Y')) as tgl_acc_asesor,
					if(b.tgl_acc_kabid = '0000-00-00' ,'Proses',DATE_FORMAT(b.tgl_acc_kabid,'%d-%m-%Y')) as tgl_acc_kabid,
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
		if($this->session->id_level !== '99'){
		$this->db->where_in('jf.id_jabatan',$ids);
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('kr_pengajuan b');
		$this->db->join('kol_status_diusulkan su', 'su.id_status_diusulkan=b.id_status_diusulkan','left');
		$this->db->join('pegawai peg', 'peg.id_pegawai=b.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
		$this->db->join('pegawai peg2', 'peg2.id_pegawai=b.id_asesor','left');
		$this->db->where("b.status_pengajuan", "1");
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
		$this->db->where("b.status_pengajuan", "1");
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
		// print_r($output);die();
		return $output;
	}
	function logbook_all_a_b($id)
	{
		$apk	=$this->m_rancak->ambil_pengajuan_kompetensi($id);
	//	$ids = explode(',', $lp);
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,
					DATE_FORMAT(lp.tgl_logbook,'%d-%m-%Y') as tgl_logbook,lp.id_logbook,lp.jam_logbook,lp.jml_logbook,peg.id_pegawai,
					DATE_FORMAT(lp.tgl_v_karu,'%d-%m-%Y') as tgl_v_karu,lp.rm,lp.id_pegawai,kd.id_kewenangan,
					if(lp.v_kabid = '0' ,'Proses',if(lp.v_kabid = '1' ,'Kompeten','Ditolak')) as v_kabid";
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
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('logbook lp');
		$this->db->join('pegawai peg', 'peg.id_pegawai=lp.id_pegawai','left');
		$this->db->join('kr_kewenangan_detil kd', 'kd.id_kewenangan_detil=lp.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan krw', 'krw.id_kewenangan=kd.id_kewenangan','left');
		$this->db->join('kol_kode_kewenangan kw', 'kw.id_kode_kewenangan=kd.id_kode_kewenangan','left');
		$this->db->join('unit u', 'u.id_unit=kd.id_unit','left');
		$this->db->where("lp.id_pegawai", $apk['id_pegawai']);
		$this->db->where("lp.id_pengajuan", $apk['id_pengajuan']);

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
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('logbook lp');
		$this->db->join('pegawai peg', 'peg.id_pegawai=lp.id_pegawai','left');
		$this->db->join('kr_kewenangan_detil kd', 'kd.id_kewenangan_detil=lp.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan krw', 'krw.id_kewenangan=kd.id_kewenangan','left');
		$this->db->join('kol_kode_kewenangan kw', 'kw.id_kode_kewenangan=kd.id_kode_kewenangan','left');
		$this->db->join('unit u', 'u.id_unit=kd.id_unit','left');
		$this->db->where("lp.id_pegawai", $apk['id_pegawai']);
		$this->db->where("lp.id_pengajuan", $apk['id_pengajuan']);

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
	function grafik_logbook($id)	//Laporan Harian
	{
		$apk	=$this->m_rancak->ambil_pengajuan_kompetensi($id);
		$this->db->select("SUM(jml_logbook) as total,kr_kompetensi.nama_kompetensi");
		$this->db->join('kr_kewenangan_detil', 'kr_kewenangan_detil.id_kewenangan_detil=logbook.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan', 'kr_kewenangan.id_kewenangan=kr_kewenangan_detil.id_kewenangan','left');
		$this->db->join('kr_kompetensi', 'kr_kompetensi.id_kompetensi=kr_kewenangan.id_kompetensi','left');
		$this->db->where("logbook.id_pegawai", $apk['id_pegawai']);
		$this->db->where("logbook.id_pengajuan", $apk['id_pengajuan']);
		$this->db->group_by('kr_kewenangan.id_kompetensi');
		$q = $this->db->get('logbook');
		return $q->result_array();
	}
	function update_v_kabid_kompetensi($isi,$tolak,$id,$a,$b,$id_pegawai,$id_karu,$id_pengajuan){
		$d = $this->m_umum->ambil_data('kr_pengajuan','id_pengajuan',$id_pengajuan);
		$id_karu = $id_karu;

		$data_v_karu = array(
			'v_kabid' => $isi,
			'id_kabid' => $id_karu,
			'tgl_v_kabid' => date('Y-m-d')
		);
		$this->db->where("logbook.id_pengajuan", $id_pengajuan);
		$this->db->where('id_pegawai',$id_pegawai);
		$this->db->where('id_kewenangan_detil',$id);
		$this->db->where('v_direktur','0');
		$this->db->where('v_komite','0');
		$this->db->where('v_asesor','0');
		if($isi!=='0'){
			$this->db->where('v_kabid','0');
		}
		$this->db->where('v_karu','1');
		$this->db->update('logbook', $data_v_karu);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function update_v_kabid_all_kompetensi($isi,$a,$b,$id_pegawai,$id_karu,$id_pengajuan){
		$d = $this->m_umum->ambil_data('kr_pengajuan','id_pengajuan',$id_pengajuan);
		$id_karu = $id_karu;
			$data_v_karu = array(
				'id_kabid' => $id_karu,
				'tgl_v_kabid' => date('Y-m-d'),
				'v_kabid' => $isi
			);
			$this->db->where("logbook.id_pengajuan", $d['id_pengajuan']);
	//	$this->db->where('id_logbook BETWEEN "'.$a. '" and "'.$b.'"');
		$this->db->where('id_pegawai',$id_pegawai);
		$this->db->where('v_karu =', '1');
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
	function Kabid_Acc($id,$idk){
		$id_kabid = $idk;
		$data_pendaftaran = array(
			'id_kabid' => $id_kabid,
			'acc_kabid' => '1',
			'tgl_acc_kabid' => date("Y-m-d")
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
	function Kabid_Tolak($id,$idk){
		$id_kabid = $idk;
		$data_pendaftaran = array(
			'id_kabid' => $id_kabid,
			'acc_kabid' => '2',
			'tgl_acc_kabid' => date("Y-m-d")
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
		// $this->db->where('id_logbook BETWEEN "'.$apk['id_logbook_a']. '" and "'.$apk['id_logbook_b'].'"');
		$this->db->where("id_pengajuan", $apk['id_pengajuan']);
		$this->db->where('id_pegawai',$apk['id_pegawai']);
		$this->db->where('v_karu =', '1');
		$this->db->where('v_kabid', '0');
		$this->db->where('v_asesor', '0');
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
			'acc_logbook_kabid' => 1
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
	function pegawai_asesor()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,
					DATE_FORMAT(peg.tgl_lahir,'%d-%m-%Y') as tgl_lahir,if (peg.jk = '1' ,'Laki-laki','Perempuan') as jk
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
					 case 'id_pegawai' : $nmf="pa.nama_pegawai";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('pa.id_akses','13');
		$this->db->where('pa.status_pegawai_akses','1');
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	 //    $this->db->from('user us');
		// $this->db->join('pegawai peg', 'peg.id_pegawai=us.id_pegawai','left');
		// $this->db->join('perawat_detil pd', 'pd.id_pegawai=peg.id_pegawai','left');
		// $this->db->join('kol_kode_kewenangan kw', 'kw.id_kode_kewenangan=pd.id_kode_kewenangan','left');
		// $this->db->where('us.id_level','17');
	    $this->db->from('pegawai_akses pa');
		$this->db->join('pegawai peg', 'peg.id_pegawai=pa.id_pegawai','left');
		$this->db->join('perawat_detil pd', 'pd.id_pegawai=peg.id_pegawai','left');
		$this->db->join('kol_kode_kewenangan kw', 'kw.id_kode_kewenangan=pd.id_kode_kewenangan','left');
		$this->db->where('pa.id_akses','13');
		$this->db->where('pa.status_pegawai_akses','1');

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
					case 'id_pegawai' : $nmf="pa.nama_pegawai";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('pa.id_akses','13');
		$this->db->where('pa.status_pegawai_akses','1');
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('pegawai_akses pa');
		$this->db->join('pegawai peg', 'peg.id_pegawai=pa.id_pegawai','left');
		$this->db->join('perawat_detil pd', 'pd.id_pegawai=peg.id_pegawai','left');
		$this->db->join('kol_kode_kewenangan kw', 'kw.id_kode_kewenangan=pd.id_kode_kewenangan','left');
		$this->db->where('pa.id_akses','13');
		$this->db->where('pa.status_pegawai_akses','1');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('user');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function update_pengajuan_asesor($id_pegawai,$idp){
		$data_v_karu = array(
			'id_asesor' => $id_pegawai
		);
		$this->db->where('id_pengajuan',$idp);
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
			'acc_kabid' => 0,
			'acc_logbook_kabid' => 0
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
	function perbaiki_proses_kabid($id){
		$data_v_karu = array(
			'acc_kabid' => 0,
			'status_pengajuan' => 0,
			'acc_logbook_kabid' => 0
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
}
