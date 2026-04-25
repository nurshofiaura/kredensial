<?php
class M_analisa extends CI_model{
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
function multi_akses_all($id)
{
	$wordsAry = explode("-", $id);
	$wordsCount = count($wordsAry);
	$fields = "
		*
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
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(peg.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(ak.nama_akses LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
			}
		  }
		}
//		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('pegawai_akses pg');
		$this->db->join('pegawai peg', 'peg.id_pegawai=pg.id_pegawai','left');
		$this->db->join('akses ak', 'ak.id_akses=pg.id_akses','left');	
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(peg.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(ak.nama_akses LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
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
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(peg.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(ak.nama_akses LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
			}
		  }
		}

	    $this->db->from('pegawai_akses pg');
		$this->db->join('pegawai peg', 'peg.id_pegawai=pg.id_pegawai','left');
		$this->db->join('akses ak', 'ak.id_akses=pg.id_akses','left');	
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(peg.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(ak.nama_akses LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
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
}
