<?php
class M_pemulihan extends CI_model{
	function kewenangan_tolak($id)
	{
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,concat(nama_pegawai,'  [ ',nama_jabatan_fungsional,' ]') as nama_pegawai,
					if (tgl_logbook = '0000-00-00' ,'TIDAK ADA',DATE_FORMAT(tgl_logbook,'%d-%m-%Y')) as tgl_logbook,
          DATE_FORMAT(tgl_v_karu,'%d-%m-%Y') as tgl_v_karu,DATE_FORMAT(tgl_v_kabid,'%d-%m-%Y') as tgl_v_kabid,
    			DATE_FORMAT(tgl_v_direktur,'%d-%m-%Y') as tgl_v_direktur,
    			DATE_FORMAT(tgl_v_asesor,'%d-%m-%Y') as tgl_v_asesor,DATE_FORMAT(tgl_v_komite,'%d-%m-%Y') as tgl_v_komite,
    			if(v_karu = '0' ,'Proses',if(v_karu = '1' ,'Kompeten','Ditolak')) as v_karu,
    			if(v_kabid = '0' ,'Proses',if(v_kabid = '1' ,'Kompeten','Ditolak')) as v_kabid,
    			if(v_asesor = '0' ,'Proses',if(v_asesor = '1' ,'Kompeten','Ditolak')) as v_asesor,
    			if(v_direktur = '0' ,'Proses',if(v_direktur = '1' ,'Kompeten','Ditolak')) as v_direktur,
    			if(v_komite = '0' ,'Proses',if(v_komite = '1' ,'Kompeten','Ditolak')) as v_komite,
    			if(result_tolak = '0' ,'',if(result_tolak = '1' ,'Supervisi','Tidak Kompeten')) as result_tolak
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
          $this->db->where("l.id_pegawai", $id);
        }
        $this->db->group_start();
        $this->db->where("v_karu", '2');
        $this->db->or_where("v_kabid", '2');
        $this->db->or_where("v_asesor", '2');
        $this->db->or_where("v_komite", '2');
        $this->db->group_end();
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	  $this->db->from('logbook l');
		$this->db->join('pegawai peg', 'peg.id_pegawai=l.id_pegawai','left');
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
		$this->db->join('kr_kewenangan_detil kkd', 'kkd.id_kewenangan_detil=l.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan kk', 'kk.id_kewenangan=kkd.id_kewenangan','left');
    if($id > 0){
      $this->db->where("l.id_pegawai", $id);
    }
    $this->db->group_start();
    $this->db->where("v_karu", '2');
    $this->db->or_where("v_kabid", '2');
    $this->db->or_where("v_asesor", '2');
    $this->db->or_where("v_komite", '2');
    $this->db->group_end();

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
          $this->db->where("l.id_pegawai", $id);
        }
        $this->db->group_start();
        $this->db->where("v_karu", '2');
        $this->db->or_where("v_kabid", '2');
        $this->db->or_where("v_asesor", '2');
        $this->db->or_where("v_komite", '2');
        $this->db->group_end();
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
  $this->db->from('logbook l');
  $this->db->join('pegawai peg', 'peg.id_pegawai=l.id_pegawai','left');
	$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
  $this->db->join('kr_kewenangan_detil kkd', 'kkd.id_kewenangan_detil=l.id_kewenangan_detil','left');
  $this->db->join('kr_kewenangan kk', 'kk.id_kewenangan=kkd.id_kewenangan','left');
  if($id > 0){
    $this->db->where("l.id_pegawai", $id);
  }
  $this->db->group_start();
  $this->db->where("v_karu", '2');
  $this->db->or_where("v_kabid", '2');
  $this->db->or_where("v_asesor", '2');
  $this->db->or_where("v_komite", '2');
  $this->db->group_end();

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
  function simpan_pemulihan(){
		$tgl_awal = $this->input->post('tgl_awal');
		$tgl_awal = date('Y-m-d', strtotime($tgl_awal));
    $tgl_akhir = $this->input->post('tgl_akhir');
		$tgl_akhir = date('Y-m-d', strtotime($tgl_akhir));
		$id_pegawai = $this->input->post('id_pegawai');
		$data_pendaftaran = array(
			'tgl_awal' => $tgl_awal,
			'tgl_akhir' => $tgl_akhir,
			'id_pemulihan' => $this->input->post('id_pemulihan'),
			'id_unit_pemulihan' => $this->input->post('id_unit_pemulihan'),
			'id_pegawai' => $this->input->post('id_pegawai'),
			'id_unit' => $this->input->post('id_unit_pegawai'),
			'id_pengirim' => $this->input->post('id_pengirim'),
			'id_unit_pengirim' => $this->input->post('id_unit_pengirim'),
			'catatan_pemulihan' => ''
		);
		$this->db->insert('logbook_pemulihan', $data_pendaftaran);
		return $this->db->insert_id();
	}
	function edit_pemulihan(){
		$id_logbook_pemulihan = $this->input->post('id_logbook_pemulihan');
		$tgl_awal = $this->input->post('tgl_awal');
		$tgl_awal = date('Y-m-d', strtotime($tgl_awal));
    $tgl_akhir = $this->input->post('tgl_akhir');
		$tgl_akhir = date('Y-m-d', strtotime($tgl_akhir));
		$data_pendaftaran = array(
			'tgl_awal' => $tgl_awal,
			'tgl_akhir' => $tgl_akhir,
			'id_pemulihan' => $this->input->post('id_pemulihan'),
			'id_unit_pemulihan' => $this->input->post('id_unit_pemulihan')
		);
		$this->db->where('id_logbook_pemulihan',$id_logbook_pemulihan);
		$this->db->update('logbook_pemulihan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
  function logbook_pemulihan_all($id)
	{
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,
					if (tgl_awal = '0000-00-00' ,'TIDAK ADA',DATE_FORMAT(tgl_awal,'%d-%m-%Y')) as tgl_awal,
					if (tgl_akhir = '0000-00-00' ,'TIDAK ADA',DATE_FORMAT(tgl_akhir,'%d-%m-%Y')) as tgl_akhir,
    			if(result_pemulihan = '0' ,'Proses',if(result_pemulihan = '1' ,'Kompeten','Tidak Kompeten')) as result_pemulihan
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
          $this->db->where("l.id_pegawai", $id);
        }
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	  $this->db->from('logbook_pemulihan l');
		$this->db->join('pegawai peg', 'peg.id_pegawai=l.id_pegawai','left');
		$this->db->join('ruangan r', 'r.id_ruangan=l.id_unit_pemulihan','left');
    if($id > 0){
      $this->db->where("l.id_pegawai", $id);
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
          $this->db->where("l.id_pegawai", $id);
        }
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
  $this->db->from('logbook_pemulihan l');
  $this->db->join('pegawai peg', 'peg.id_pegawai=l.id_pegawai','left');
  $this->db->join('ruangan r', 'r.id_ruangan=l.id_unit_pemulihan','left');
  if($id > 0){
    $this->db->where("l.id_pegawai", $id);
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
	function logbook_pemulihan_detil_pegawai($id)
	{
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "lpd.id_logbook_pemulihan,r.nama_ruangan,kk.nama_kewenangan,lpd.id_logbook_pemulihan_detil,l.rm,
					if (tgl_logbook = '0000-00-00' ,'TIDAK ADA',DATE_FORMAT(tgl_logbook,'%d-%m-%Y')) as tgl_logbook,
					DATE_FORMAT(tgl_v_karub,'%d-%m-%Y') as tgl_v_karub,DATE_FORMAT(tgl_v_kabidb,'%d-%m-%Y') as tgl_v_kabidb,
    			DATE_FORMAT(tgl_v_direkturb,'%d-%m-%Y') as tgl_v_direkturb,
    			DATE_FORMAT(tgl_v_asesorb,'%d-%m-%Y') as tgl_v_asesorb,DATE_FORMAT(tgl_v_komiteb,'%d-%m-%Y') as tgl_v_komiteb,
    			if(v_karub = '0' ,'Proses',if(v_karub = '1' ,'Kompeten','Ditolak')) as v_karub,
    			if(v_kabidb = '0' ,'Proses',if(v_kabidb = '1' ,'Kompeten','Ditolak')) as v_kabidb,
    			if(v_asesorb = '0' ,'Proses',if(v_asesorb = '1' ,'Kompeten','Ditolak')) as v_asesorb,
    			if(v_direkturb = '0' ,'Proses',if(v_direkturb = '1' ,'Kompeten','Ditolak')) as v_direkturb,
    			if(v_komiteb = '0' ,'Proses',if(v_komiteb = '1' ,'Kompeten','Ditolak')) as v_komiteb,
    			if(result_tolakb = '0' ,'',if(result_tolakb = '1' ,'Supervisi','Tidak Kompeten')) as result_tolakb
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
        	$this->db->where("lpd.id_logbook_pemulihan", $id);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	  $this->db->from('logbook_pemulihan_detil lpd');
		$this->db->join('logbook l', 'l.id_logbook=lpd.id_logbook','left');
		$this->db->join('kr_kewenangan_detil kkd', 'kkd.id_kewenangan_detil=l.id_kewenangan_detil','left');
		$this->db->join('ruangan r', 'r.id_ruangan=kkd.id_unit','left');
		$this->db->join('kr_kewenangan kk', 'kk.id_kewenangan=kkd.id_kewenangan','left');
    $this->db->where("lpd.id_logbook_pemulihan", $id);

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
        	$this->db->where("lpd.id_logbook_pemulihan", $id);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	$this->db->from('logbook_pemulihan_detil lpd');
	$this->db->join('logbook l', 'l.id_logbook=lpd.id_logbook','left');
	$this->db->join('kr_kewenangan_detil kkd', 'kkd.id_kewenangan_detil=l.id_kewenangan_detil','left');
	$this->db->join('kr_kewenangan kk', 'kk.id_kewenangan=kkd.id_kewenangan','left');
	$this->db->where("lpd.id_logbook_pemulihan", $id);

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
	function simpan_logbook_pemulihan_detil(){
		$id_logbook_pemulihan = $this->input->post('id_logbook_pemulihan');
		$chk = $this->input->post('chk[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				$this->db->select("COUNT(*) as num");
				$this->db->where('id_logbook',$chk[$i]);
				$q = $this->db->get('logbook_pemulihan_detil')->row();
				$jml = $q->num;
				if($jml == 0){
					$lb = $this->m_umum->ambil_data('logbook','id_logbook',$chk[$i]);
					$data_pendaftaran = array(
						'id_logbook' => $chk[$i],
						'id_logbook_pemulihan' => $id_logbook_pemulihan,
						'v_karub' => $lb['v_karu'],
						'v_kabidb' => $lb['v_kabid'],
						'v_asesorb' => $lb['v_asesor'],
						'v_komiteb' => $lb['v_komite'],
						'v_direkturb' => $lb['v_direktur'],
						'tgl_v_karub' => $lb['tgl_v_karu'],
						'tgl_v_kabidb' => $lb['tgl_v_kabid'],
						'tgl_v_asesorb' => $lb['tgl_v_asesor'],
						'tgl_v_komiteb' => $lb['tgl_v_komite'],
						'tgl_v_direkturb' => $lb['tgl_v_direktur'],
						'result_tolakb' => $lb['result_tolak'],
						'id_karub' => $lb['id_karu'],
						'id_kabidb' => $lb['id_kabid'],
						'id_asesorb' => $lb['id_asesor'],
						'id_komiteb' => $lb['id_komite'],
						'id_direkturb' => $lb['id_direktur']
					);
					$this->db->insert('logbook_pemulihan_detil', $data_pendaftaran);
				}
			}
		}
	}
	function logbook_kegiatan_pemulihan_personal($id)
	{
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,
					if (tgl_kegiatan_pemulihan = '0000-00-00' ,'TIDAK ADA',DATE_FORMAT(tgl_kegiatan_pemulihan,'%d-%m-%Y')) as tgl_kegiatan_pemulihan,
    			if(result_kegiatan_pemulihan = '0' ,'Proses',if(result_kegiatan_pemulihan = '1' ,'Kompeten','Tidak Kompeten')) as result_kegiatan_pemulihan
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
        $this->db->where("id_logbook_pemulihan", $id);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

    $this->db->from('logbook_kegiatan_pemulihan lkp');
    $this->db->join('kr_kewenangan kk', 'kk.id_kewenangan=lkp.id_kewenangan','left');
    $this->db->join('pegawai peg', 'peg.id_pegawai=lkp.id_penguji','left');
    $this->db->where("id_logbook_pemulihan", $id);

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
        $this->db->where("id_logbook_pemulihan", $id);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
  $this->db->from('logbook_kegiatan_pemulihan lkp');
  $this->db->join('kr_kewenangan kk', 'kk.id_kewenangan=lkp.id_kewenangan','left');
  $this->db->join('pegawai peg', 'peg.id_pegawai=lkp.id_penguji','left');
  $this->db->where("id_logbook_pemulihan", $id);

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
	function edit_logbook_pemulihan(){
		$id_logbook_pemulihan = $this->input->post('id_logbook_pemulihan');
		$data_pendaftaran = array(
      'result_pemulihan' => $this->input->post('result_pemulihan'),
      'catatan_pemulihan' => $this->input->post('catatan_pemulihan')
		);
		$this->db->where('id_logbook_pemulihan',$id_logbook_pemulihan);
		$this->db->update('logbook_pemulihan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
}
