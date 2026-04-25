<?php
class M_developer extends CI_model{
function pengajuan_kompetensi_all($id)
{
	$wordsAry = explode("-", $id);
	$wordsCount = count($wordsAry);
	$fields = "
		*,DATE_FORMAT(b.tgl_pengajuan,'%d-%m-%Y') as tgl_pengajuan,b.id_pegawai,
		if(b.tgl_acc_direktur = '0000-00-00' ,'Proses',DATE_FORMAT(b.tgl_acc_direktur,'%d-%m-%Y')) as tgl_acc_direktur,
		if(b.tgl_acc_komite = '0000-00-00' ,'Proses',DATE_FORMAT(b.tgl_acc_komite,'%d-%m-%Y')) as tgl_acc_komite,
		if(b.tgl_acc_asesor = '0000-00-00' ,'Proses',DATE_FORMAT(b.tgl_acc_asesor,'%d-%m-%Y')) as tgl_acc_asesor,
		if(b.tgl_acc_kabid = '0000-00-00' ,'Proses',DATE_FORMAT(b.tgl_acc_kabid,'%d-%m-%Y')) as tgl_acc_kabid,
		if(b.tgl_kredensial = '0000-00-00' ,'Proses',DATE_FORMAT(b.tgl_kredensial,'%d-%m-%Y')) as tgl_kredensial,
		if(b.tgl_mutu = '0000-00-00' ,'Proses',DATE_FORMAT(b.tgl_mutu,'%d-%m-%Y')) as tgl_mutu,
		if(b.tgl_etika = '0000-00-00' ,'Proses',DATE_FORMAT(b.tgl_etika,'%d-%m-%Y')) as tgl_etika,

		if(b.id_direktur = '0' ,'Proses',peg8.nama_pegawai) as id_direktur,
		if(b.id_komite = '0' ,'Proses',peg7.nama_pegawai) as id_komite,
		if(b.id_kabid = '0' ,'Proses',peg6.nama_pegawai) as id_kabid,
		if(b.id_etika = '0' ,'Proses',peg5.nama_pegawai) as id_etika,
		if(b.id_mutu = '0' ,'Proses',peg4.nama_pegawai) as id_mutu,
		if(b.id_kredensial = '0' ,'Proses',peg3.nama_pegawai) as id_kredensial,
		if(b.id_asesor = '0' ,'Proses',peg2.nama_pegawai) as id_asesor,
		if(b.id_pegawai = '0' ,'Tidak Ada',peg.nama_pegawai) as nama_pegawai
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
					case 'nama_pegawai' : $nmf="peg.nama_pegawai";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}
//		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('kr_pengajuan b');
		$this->db->join('pegawai peg', 'peg.id_pegawai=b.id_pegawai','left');
		$this->db->join('pegawai peg2', 'peg2.id_pegawai=b.id_asesor','left');
		$this->db->join('pegawai peg3', 'peg3.id_pegawai=b.id_kredensial','left');
		$this->db->join('pegawai peg4', 'peg4.id_pegawai=b.id_mutu','left');
		$this->db->join('pegawai peg5', 'peg5.id_pegawai=b.id_etika','left');
		$this->db->join('pegawai peg6', 'peg6.id_pegawai=b.id_kabid','left');
		$this->db->join('pegawai peg7', 'peg7.id_pegawai=b.id_komite','left');
		$this->db->join('pegawai peg8', 'peg8.id_pegawai=b.id_direktur','left');
		$this->db->join('kol_status_diusulkan su', 'su.id_status_diusulkan=b.id_status_diusulkan','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');		
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(peg.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
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
					case 'nama_pegawai' : $nmf="peg.nama_pegawai";break;
					default: $nmf=$k['data'];
				}

			}
		  }
		}

	    $this->db->from('kr_pengajuan b');	
		$this->db->join('pegawai peg', 'peg.id_pegawai=b.id_pegawai','left');
		$this->db->join('pegawai peg2', 'peg2.id_pegawai=b.id_asesor','left');
		$this->db->join('pegawai peg3', 'peg3.id_pegawai=b.id_kredensial','left');
		$this->db->join('pegawai peg4', 'peg4.id_pegawai=b.id_mutu','left');
		$this->db->join('pegawai peg5', 'peg5.id_pegawai=b.id_etika','left');
		$this->db->join('pegawai peg6', 'peg6.id_pegawai=b.id_kabid','left');
		$this->db->join('pegawai peg7', 'peg7.id_pegawai=b.id_komite','left');
		$this->db->join('pegawai peg8', 'peg8.id_pegawai=b.id_direktur','left');
		$this->db->join('kol_status_diusulkan su', 'su.id_status_diusulkan=b.id_status_diusulkan','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');		
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(peg.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
	//	$kondisi=array('id_level !='=>'99');
	//	$jml = $this->m_umum->jumlah_record_filter('user',$kondisi);		//[coding here] ganti tabel utamanya
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
function logbook_all($id)
{
//--------- Ambil nama kolom --------- [coding here]
	$fields = "*,
		if(lp.id_pegawai = '0' ,'Tidak Ada',peg.nama_pegawai) as nama_pegawai,
		if(lp.id_karu = '0' ,'Proses',peg2.nama_pegawai) as id_karu,
		if(lp.id_kabid = '0' ,'Proses',peg3.nama_pegawai) as id_kabid,
		if(lp.id_asesor = '0' ,'Proses',peg4.nama_pegawai) as id_asesor,
		if(lp.id_komite = '0' ,'Proses',peg5.nama_pegawai) as id_komite,
		if(lp.id_direktur = '0' ,'Proses',peg6.nama_pegawai) as id_direktur,
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
	$this->db->where("lp.id_pengajuan", $id);
		}
	  }
	}
	$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

    $this->db->from('logbook lp');
	$this->db->join('pegawai peg', 'peg.id_pegawai=lp.id_pegawai','left');
	$this->db->join('pegawai peg2', 'peg2.id_pegawai=lp.id_karu','left');
	$this->db->join('pegawai peg3', 'peg3.id_pegawai=lp.id_kabid','left');
	$this->db->join('pegawai peg4', 'peg4.id_pegawai=lp.id_asesor','left');
	$this->db->join('pegawai peg5', 'peg5.id_pegawai=lp.id_komite','left');
	$this->db->join('pegawai peg6', 'peg6.id_pegawai=lp.id_direktur','left');
	$this->db->join('kr_kewenangan_detil kd', 'kd.id_kewenangan_detil=lp.id_kewenangan_detil','left');
	$this->db->join('kr_kewenangan krw', 'krw.id_kewenangan=kd.id_kewenangan','left');
	$this->db->join('kol_kode_kewenangan kw', 'kw.id_kode_kewenangan=kd.id_kode_kewenangan','left');
	$this->db->join('ruangan u', 'u.id_ruangan=kd.id_unit','left');
	$this->db->where("lp.id_pengajuan", $id);

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
	$this->db->where("lp.id_pengajuan", $id);
		}
	  }
	}

//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
    $this->db->from('logbook lp');
	$this->db->join('pegawai peg', 'peg.id_pegawai=lp.id_pegawai','left');
	$this->db->join('pegawai peg2', 'peg2.id_pegawai=lp.id_karu','left');
	$this->db->join('pegawai peg3', 'peg3.id_pegawai=lp.id_kabid','left');
	$this->db->join('pegawai peg4', 'peg4.id_pegawai=lp.id_asesor','left');
	$this->db->join('pegawai peg5', 'peg5.id_pegawai=lp.id_komite','left');
	$this->db->join('pegawai peg6', 'peg6.id_pegawai=lp.id_direktur','left');
	$this->db->join('kr_kewenangan_detil kd', 'kd.id_kewenangan_detil=lp.id_kewenangan_detil','left');
	$this->db->join('kr_kewenangan krw', 'krw.id_kewenangan=kd.id_kewenangan','left');
	$this->db->join('kol_kode_kewenangan kw', 'kw.id_kode_kewenangan=kd.id_kode_kewenangan','left');
	$this->db->join('ruangan u', 'u.id_ruangan=kd.id_unit','left');
	$this->db->where("lp.id_pengajuan", $id);

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
	function tabel_logbook($id,$all,$first_date,$last_date)
	{
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,
		CONCAT(DATE_FORMAT(lp.tgl_logbook,'%d-%m-%Y'),' Jam : ',DATE_FORMAT(lp.jam_logbook,'%H:%i:%s')) as tgl_logbook,

		if(lp.id_pegawai = '0' ,'Tidak Ada',peg.nama_pegawai) as nama_pegawai,
		if(lp.id_karu = '0' ,'BLM',peg2.nama_pegawai) as id_karu,
		if(lp.id_kabid = '0' ,'BLM',peg3.nama_pegawai) as id_kabid,
		if(lp.id_asesor = '0' ,'BLM',peg4.nama_pegawai) as id_asesor,
		if(lp.id_komite = '0' ,'BLM',peg5.nama_pegawai) as id_komite,
		if(lp.id_direktur = '0' ,'BLM',peg6.nama_pegawai) as id_direktur,
		if(lp.id_pengajuan = '0' ,'BLM',lp.id_pengajuan) as id_pengajuan,
		lp.id_logbook,
		if(lp.result_tolak = '0' ,'',if(lp.result_tolak = '1' ,'Supervisi','Tidak Kompeten')) as result_tolak,

		DATE_FORMAT(kp.tgl_pengajuan,'%d-%m-%Y') as tgl_pengajuan,
		if(lp.tgl_v_direktur = '0000-00-00' ,'BLM',DATE_FORMAT(lp.tgl_v_direktur,'%d-%m-%Y')) as tgl_v_direktur,
		if(lp.tgl_v_komite = '0000-00-00' ,'BLM',DATE_FORMAT(lp.tgl_v_komite,'%d-%m-%Y')) as tgl_v_komite,
		if(lp.tgl_v_asesor = '0000-00-00' ,'BLM',DATE_FORMAT(lp.tgl_v_asesor,'%d-%m-%Y')) as tgl_v_asesor,
		if(lp.tgl_v_kabid = '0000-00-00' ,'BLM',DATE_FORMAT(lp.tgl_v_kabid,'%d-%m-%Y')) as tgl_v_kabid,
		if(lp.tgl_v_karu = '0000-00-00' ,'BLM',DATE_FORMAT(lp.tgl_v_karu,'%d-%m-%Y')) as tgl_v_karu,
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

	    $this->db->from('logbook lp');
		$this->db->join('pegawai peg', 'peg.id_pegawai=lp.id_pegawai','left');
		$this->db->join('pegawai peg2', 'peg2.id_pegawai=lp.id_karu','left');
		$this->db->join('pegawai peg3', 'peg3.id_pegawai=lp.id_kabid','left');
		$this->db->join('pegawai peg4', 'peg4.id_pegawai=lp.id_asesor','left');
		$this->db->join('pegawai peg5', 'peg5.id_pegawai=lp.id_komite','left');
		$this->db->join('pegawai peg6', 'peg6.id_pegawai=lp.id_direktur','left');
		$this->db->join('kr_kewenangan_detil kd', 'kd.id_kewenangan_detil=lp.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan krw', 'krw.id_kewenangan=kd.id_kewenangan','left');
		$this->db->join('kol_kode_kewenangan kw', 'kw.id_kode_kewenangan=kd.id_kode_kewenangan','left');
		$this->db->join('kr_pengajuan kp', 'kp.id_pengajuan=lp.id_pengajuan','left');
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
	    $this->db->from('logbook lp');
		$this->db->join('pegawai peg', 'peg.id_pegawai=lp.id_pegawai','left');
		$this->db->join('pegawai peg2', 'peg2.id_pegawai=lp.id_karu','left');
		$this->db->join('pegawai peg3', 'peg3.id_pegawai=lp.id_kabid','left');
		$this->db->join('pegawai peg4', 'peg4.id_pegawai=lp.id_asesor','left');
		$this->db->join('pegawai peg5', 'peg5.id_pegawai=lp.id_komite','left');
		$this->db->join('pegawai peg6', 'peg6.id_pegawai=lp.id_direktur','left');
		$this->db->join('kr_kewenangan_detil kd', 'kd.id_kewenangan_detil=lp.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan krw', 'krw.id_kewenangan=kd.id_kewenangan','left');
		$this->db->join('kol_kode_kewenangan kw', 'kw.id_kode_kewenangan=kd.id_kode_kewenangan','left');
		$this->db->join('kr_pengajuan kp', 'kp.id_pengajuan=lp.id_pengajuan','left');
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
	function ambil_data_rujukan_kab_working($eimplo)
	{
		$idx = explode(',', $eimplo);
		$this->db->select("nama_working,id_working");
	//	$this->db->where_in("kol_working.id_working",$idx);
        $query = $this->db->get_where('kol_working')->result_array();
		$q= array_column($query,'nama_working','id_working');
		return $q;
	}
	function ambil_data_rujukan_ol_unit($eimplo)
	{
		$idx = explode(',', $eimplo);
		$this->db->select("concat(nama_unit,' - ',nama_working) as nama_unit,id_unit");
		$this->db->join('kol_working kw', 'kw.id_working=ol_unit.id_instansi','left');
	//	$this->db->where_in("ol_unit.id_unit",$idx);
        $query = $this->db->get_where('ol_unit')->result_array();
		$q= array_column($query,'nama_unit','id_unit');
		return $q;
	}
	function ambil_sn_standar_mutu($id){
	//	$ids = explode(',', $id);
		$this->db->select("id_standar_mutu,nama_standar_mutu");
	//	$this->db->where_in("id_standar_mutu", $id);
		$q = $this->db->get_where('sn_standar_mutu')->result_array();
		$hasil= array_column($q,'nama_standar_mutu','id_standar_mutu');
		return $hasil;
	}
	function laporan_all($first_date,$last_date,$id,$ids,$tgl,$kat)
	{
	$idx = explode(',', $this->session->list_working);
	$idu = explode(',', $this->session->list_unit);
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
	    if($tgl == 0){
	    $this->db->where('tgl_laporan BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		}
		if($id > 0){
			$this->db->where("id_unit", $id);
		}
		if($kat > 0){
			$this->db->where("sl.id_standar_mutu", $ids);
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('sn_laporan sl');	
	    $this->db->join('sn_standar_mutu sm', 'sm.id_standar_mutu=sl.id_standar_mutu','left');
	    $this->db->join('jabatan j', 'j.id_jabatan=sm.id_jabatan','left');
	    $this->db->join('ol_unit ou', 'ou.id_unit=sl.id_unit','left');
	    $this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
	    if($tgl == 0){
	    $this->db->where('tgl_laporan BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		}
		if($id > 0){
			$this->db->where("id_unit", $id);
		}
		if($kat > 0){
			$this->db->where("sl.id_standar_mutu", $ids);
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
	    if($tgl == 0){
	    $this->db->where('tgl_laporan BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		}
		if($id > 0){
			$this->db->where("id_unit", $id);
		}
		if($kat > 0){
			$this->db->where("sl.id_standar_mutu", $ids);
		}
			}
		  }
		}

	    $this->db->from('sn_laporan sl');	
	    $this->db->join('sn_standar_mutu sm', 'sm.id_standar_mutu=sl.id_standar_mutu','left');	
	    $this->db->join('jabatan j', 'j.id_jabatan=sm.id_jabatan','left');
	    $this->db->join('ol_unit ou', 'ou.id_unit=sl.id_unit','left');
	    $this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');				
	    if($tgl == 0){
	    $this->db->where('tgl_laporan BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		}
		if($id > 0){
			$this->db->where("id_unit", $id);
		}
		if($kat > 0){
			$this->db->where("sl.id_standar_mutu", $ids);
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
		if($lpd['id_sumber_emisi'] == NULL OR $lpd['id_sumber_emisi'] == 0 OR empty($lpd['id_sumber_emisi'])){ 
			
		}else{
			$ids = explode(',', $lpd['id_sumber_emisi']);
			$this->db->where_in('sld.id_sumber_emisi', $ids);
		}
/*		if($lpd['id_limbah'] > 0){ 
			$this->db->where('sld.id_limbah', $lpd['id_limbah']);
		}*/
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
		if($lpd['id_sumber_emisi'] == NULL OR $lpd['id_sumber_emisi'] == 0 OR empty($lpd['id_sumber_emisi'])){ 
			
		}else{
			$ids = explode(',', $lpd['id_sumber_emisi']);
			$this->db->where_in('sld.id_sumber_emisi', $ids);
		}
/*		if($lpd['id_limbah'] > 0){ 
			$this->db->where('sld.id_limbah', $lpd['id_limbah']);
		}*/
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
	function jumlah_record_standar_mutu($id)
    {
		$lpd = $this->ambil_sn_laporan_detil($id);
		$this->db->select('COUNT(*) as num');
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);
		$this->db->where('slm.standar_mutu >', 0);		
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
		$this->db->join('sn_tps stp', 'stp.id_tps=sld.id_tps','left');
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
/*		if($lpd['id_limbah'] > 0){ 
			$this->db->where('sld.id_limbah', $lpd['id_limbah']);
		}*/
	//	$this->db->group_by('sld.id_limbah');
	//	$this->db->group_by(array('YEAR(tgl_lhu)','MONTH(tgl_lhu)','sld.id_limbah'));
		$this->db->group_by(array('sld.id_limbah','sld.id_sumber_emisi'));
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
//		$this->db->select("DATE_FORMAT(tgl_lhu,'%d-%m-%Y') as tgl_lhu,sld.id_limbah");
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
		if($lpd['id_sumber_emisi'] == NULL OR $lpd['id_sumber_emisi'] == 0 OR empty($lpd['id_sumber_emisi'])){ 
			
		}else{
			$ids = explode(',', $lpd['id_sumber_emisi']);
			$this->db->where_in('sld.id_sumber_emisi', $ids);
		}
/*		if($lpd['id_limbah'] > 0){ 
			$this->db->where('sld.id_limbah', $lpd['id_limbah']);
		}*/	
		$this->db->group_by("tgl_lhu,sld.id_limbah");
		$q = $this->db->get_where('sn_lhu_detil sld')->result_array();
		//echo $this->db->last_query();die();
		return $q;
	}
	function ambil_limbah_grafik_aza($id){
		$lpd = $this->ambil_sn_laporan_detil($id);
	//	$this->db->select("sld.id_limbah,nama_limbah");
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
/*		if($lpd['id_limbah'] > 0){ 
			$this->db->where('sld.id_limbah', $lpd['id_limbah']);
		}*/	
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
		if($lpd['id_sumber_emisi'] == NULL OR $lpd['id_sumber_emisi'] == 0 OR empty($lpd['id_sumber_emisi'])){ 
			
		}else{
			$ids = explode(',', $lpd['id_sumber_emisi']);
			$this->db->where_in('sld.id_sumber_emisi', $ids);
		}
	//	if($lpd['id_limbah'] > 0){ 
	//		$this->db->where('sld.id_limbah', $idl);
	//	}
		$this->db->group_by(array('YEAR(tgl_lhu)','MONTH(tgl_lhu)','sld.id_limbah','sld.hasil_lhu_detil','sld.id_sumber_emisi'));
	//	$this->db->group_by(array('YEAR(tgl_lhu)','MONTH(tgl_lhu)'));
		$q = $this->db->get_where('sn_lhu_detil sld');
		return $q->result_array();
	}
	function grafik_garis_hasil($tgl,$id){
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
		$this->db->group_by('sld.id_limbah');
		$q = $this->db->get_where('sn_lhu_detil sld')->result_array();
		//echo $this->db->last_query();die();
		return $q;
	}
//========================================================= im
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
}
