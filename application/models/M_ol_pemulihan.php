<?php
class M_ol_pemulihan extends CI_model{
	function kewenangan_tolak($id)
	{
	$idx = explode(',', $this->session->list_instansi);
	$wordsAry = explode("-", $id);
	$wordsCount = count($wordsAry);
		$fields = "*,DATE_FORMAT(wkt_logbook,'%d-%m-%Y') as wkt_logbook
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
		$this->db->where_in("opi.id_instansi", $idx);
		$this->db->where("tolak >", 0);
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(peg.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	  	$this->db->from('ol_logbook ol');
/*	  	$this->db->from('ol_logbook_validasi olv');
		$this->db->join('ol_pegawai_struktur ops', 'ops.id_pegawai_struktur=olv.id_pegawai_struktur','left');
		$this->db->join('ol_struktur os', 'os.id_struktur=ops.id_struktur','left');
		$this->db->join('kol_ms_struktur kms', 'kms.id_ms_struktur=os.id_ms_struktur','left');
		$this->db->join('ol_logbook ol', 'ol.id_logbook=olv.id_logbook','left');*/
		$this->db->join('ol_kewenangan ok', 'ok.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=ol.id_logbooker','left');
		$this->db->join('ol_pegawai_instansi opi', 'opi.id_pegawai=peg.id_pegawai','left');
		$this->db->join('kol_working kwo', 'kwo.id_working=opi.id_instansi','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
//		$this->db->where("not exists (select 1 from ol_logbook_kegiatan_pemulihan_detil  olv where olv.id_logbook = ol.id_logbook AND olv.result_kegiatan_pemulihan = 1)",null,false);
		$this->db->where_in("opi.id_instansi", $idx);
		$this->db->where("tolak >", 0);
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
				//	case 'no_hp' : $nmf="peg.no_hp";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where_in("opi.id_instansi", $idx);
		$this->db->where("tolak >", 0);
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(peg.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	  	$this->db->from('ol_logbook_validasi olv');
		$this->db->join('ol_pegawai_struktur ops', 'ops.id_pegawai_struktur=olv.id_pegawai_struktur','left');
		$this->db->join('ol_struktur os', 'os.id_struktur=ops.id_struktur','left');
		$this->db->join('kol_ms_struktur kms', 'kms.id_ms_struktur=os.id_ms_struktur','left');
		$this->db->join('ol_logbook ol', 'ol.id_logbook=olv.id_logbook','left');
		$this->db->join('ol_kewenangan ok', 'ok.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=ol.id_logbooker','left');
		$this->db->join('ol_pegawai_instansi opi', 'opi.id_pegawai=peg.id_pegawai','left');
		$this->db->join('kol_working kwo', 'kwo.id_working=opi.id_instansi','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
		$this->db->join('ol_kewenangan kk', 'kk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->where_in("opi.id_instansi", $idx);
		$this->db->where("tolak >", 0);
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
 		$kondisi=array('tolak >'=>0);
		$jml = $this->m_umum->jumlah_record_filter('ol_logbook',$kondisi);	 
/*		$jml = $this->m_umum->jumlah_record_tabel('logbook');*/

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
  function simpan_pemulihan($id){
		$tgl_awal = $this->input->post('tgl_awal');
		$tgl_awal = date('Y-m-d', strtotime($tgl_awal));
    $tgl_akhir = $this->input->post('tgl_akhir');
		$tgl_akhir = date('Y-m-d', strtotime($tgl_akhir));
		$id_pegawai = $this->input->post('id_pegawai');
		$kode = $this->m_rancak->kode_generator(15,'');
		$data_pendaftaran = array(
			'barcode_logbook_pemulihan' => $kode,
			'tgl_awal' => $tgl_awal,
			'tgl_akhir' => $tgl_akhir,
			'id_pegawai' => $id,
			'id_instansi_pegawai' => $this->input->post('id_instansi_pegawai'),
			'id_unit_pegawai' => $this->input->post('id_unit_pegawai'),
			'id_pemulihan' => $this->input->post('id_pemulihan'),
			'id_instansi_pemulihan' => $this->input->post('id_instansi'),
			'id_unit_pemulihan' => $this->input->post('id_unit_pemulihan'),
			'id_pengirim' => $this->session->id_pegawai
		);
		$this->db->insert('ol_logbook_pemulihan', $data_pendaftaran);
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
			'id_instansi_pegawai' => $this->input->post('id_instansi_pegawai'),
			'id_unit_pegawai' => $this->input->post('id_unit_pegawai'),
			'id_pemulihan' => $this->input->post('id_pemulihan'),
			'id_instansi_pemulihan' => $this->input->post('id_instansi'),
			'id_unit_pemulihan' => $this->input->post('id_unit_pemulihan'),
		);
		$this->db->where('id_logbook_pemulihan',$id_logbook_pemulihan);
		$this->db->update('ol_logbook_pemulihan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function edit_status_pemulihan(){
		$id_logbook_pemulihan = $this->input->post('id_logbook_pemulihan');
		$data_pendaftaran = array(
			'catatan_pemulihan' => $this->input->post('catatan_pemulihan'),
			'result_pemulihan' => $this->input->post('result_pemulihan'),
			'status_pemulihan' => $this->input->post('status_pemulihan')
		);
		$this->db->where('id_logbook_pemulihan',$id_logbook_pemulihan);
		$this->db->update('ol_logbook_pemulihan', $data_pendaftaran);
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
		$ids = explode("," , $this->session->list_instansi);
	$wordsAry = explode("-", $id);
	$wordsCount = count($wordsAry);
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,
					if (tgl_awal = '0000-00-00' ,'TIDAK ADA',DATE_FORMAT(tgl_awal,'%d-%m-%Y')) as tgl_awal,
					if (tgl_akhir = '0000-00-00' ,'TIDAK ADA',DATE_FORMAT(tgl_akhir,'%d-%m-%Y')) as tgl_akhir
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
		$this->db->where_in("l.id_instansi_pegawai", $ids);
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(peg.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	  $this->db->from('ol_logbook_pemulihan l');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=l.id_pegawai','left');
		$this->db->join('kol_working kw', 'kw.id_working=l.id_instansi_pemulihan','left');
		$this->db->join('ol_unit ou', 'ou.id_unit=l.id_unit_pemulihan','left');
		$this->db->where_in("l.id_instansi_pegawai", $ids);
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
				//	case 'no_hp' : $nmf="peg.no_hp";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where_in("l.id_instansi_pegawai", $ids);
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(peg.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	  $this->db->from('ol_logbook_pemulihan l');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=l.id_pegawai','left');
		$this->db->join('kol_working kw', 'kw.id_working=l.id_instansi_pemulihan','left');
		$this->db->join('ol_unit ou', 'ou.id_unit=l.id_unit_pemulihan','left');
		$this->db->where_in("l.id_instansi_pegawai", $ids);
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
/* 		$kondisi=array('id_level !='=>'99');
		$jml = $this->m_umum->jumlah_record_filter('pegawai',$kondisi);	 */
		$jml = $this->m_umum->jumlah_record_tabel('ol_logbook_pemulihan');

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
		$fields = "*,
					if (tgl_logbook = '0000-00-00' ,'TIDAK ADA',DATE_FORMAT(tgl_logbook,'%d-%m-%Y')) as tgl_logbook
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
        	$this->db->where("olp.barcode_logbook_pemulihan", $id);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	$this->db->from('ol_logbook_pemulihan_detil lpd');
	$this->db->join('ol_logbook_pemulihan olp', 'olp.id_logbook_pemulihan=lpd.id_logbook_pemulihan','left');
	$this->db->join('ol_logbook_validasi olv', 'olv.id_logbook_validasi=lpd.id_logbook_validasi','left');
	$this->db->join('ol_logbook l', 'l.id_logbook=olv.id_logbook','left');
	$this->db->join('ol_kewenangan kk', 'kk.id_kewenangan=l.id_kewenangan','left');
	$this->db->where("olp.barcode_logbook_pemulihan", $id);

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
        	$this->db->where("olp.barcode_logbook_pemulihan", $id);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	$this->db->from('ol_logbook_pemulihan_detil lpd');
	$this->db->join('ol_logbook_pemulihan olp', 'olp.id_logbook_pemulihan=lpd.id_logbook_pemulihan','left');
	$this->db->join('ol_logbook_validasi olv', 'olv.id_logbook_validasi=lpd.id_logbook_validasi','left');
	$this->db->join('ol_logbook l', 'l.id_logbook=olv.id_logbook','left');
	$this->db->join('ol_kewenangan kk', 'kk.id_kewenangan=l.id_kewenangan','left');
	$this->db->where("olp.barcode_logbook_pemulihan", $id);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99');
		$jml = $this->m_umum->jumlah_record_filter('pegawai',$kondisi);	 */
		$jml = $this->m_umum->jumlah_record_tabel('ol_logbook_pemulihan_detil');

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
		$id_logbook_validasi = $this->input->post('id_logbook_validasi[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				$this->db->select("COUNT(*) as num");
				$this->db->where('id_logbook_validasi',$id_logbook_validasi[$i]);
				$q = $this->db->get('ol_logbook_pemulihan_detil')->row();
				$jml = $q->num;
				if($jml == 0){
					$kode = $this->m_rancak->kode_generator(15,'');
					$lb = $this->m_umum->ambil_data('ol_logbook_validasi','id_logbook_validasi',$id_logbook_validasi[$i]);
					$data_pendaftaran = array(
						'barcode_logbook_pemulihan_detil' => $kode,
						'id_logbook_validasi' => $id_logbook_validasi[$i],
						'id_logbook' => $chk[$i],
						'id_logbook_pemulihan' => $id_logbook_pemulihan,
						'result_tolak' => $lb['result_tolak']
					);
					$this->db->insert('ol_logbook_pemulihan_detil', $data_pendaftaran);
				}
			}
		}
	}
	function logbook_kegiatan_pemulihan_personal($id)
	{
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
        $this->db->where("barcode_logbook_pemulihan", $id);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

    $this->db->from('ol_logbook_kegiatan_pemulihan lkp');
    $this->db->join('ol_logbook_pemulihan olp', 'olp.id_logbook_pemulihan=lkp.id_logbook_pemulihan','left');
    $this->db->join('ol_kewenangan kk', 'kk.id_kewenangan=lkp.id_kewenangan','left');
    $this->db->join('ol_pegawai peg', 'peg.id_pegawai=lkp.id_penguji','left');
    $this->db->where("barcode_logbook_pemulihan", $id);

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
        $this->db->where("barcode_logbook_pemulihan", $id);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
    $this->db->from('ol_logbook_kegiatan_pemulihan lkp');
    $this->db->join('ol_logbook_pemulihan olp', 'olp.id_logbook_pemulihan=lkp.id_logbook_pemulihan','left');
    $this->db->join('ol_kewenangan kk', 'kk.id_kewenangan=lkp.id_kewenangan','left');
    $this->db->join('ol_pegawai peg', 'peg.id_pegawai=lkp.id_penguji','left');
    $this->db->where("barcode_logbook_pemulihan", $id);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99');
		$jml = $this->m_umum->jumlah_record_filter('pegawai',$kondisi);	 */
		$jml = $this->m_umum->jumlah_record_tabel('ol_logbook_kegiatan_pemulihan');

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
      'status_pemulihan' => $this->input->post('status_pemulihan'),
      'catatan_pemulihan' => $this->input->post('catatan_pemulihan')
		);
		$this->db->where('id_logbook_pemulihan',$id_logbook_pemulihan);
		$this->db->update('ol_logbook_pemulihan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
  function logbook_pemulihan_validasi()
	{
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,
					if (tgl_awal = '0000-00-00' ,'TIDAK ADA',DATE_FORMAT(tgl_awal,'%d-%m-%Y')) as tgl_awal,
					if (tgl_akhir = '0000-00-00' ,'TIDAK ADA',DATE_FORMAT(tgl_akhir,'%d-%m-%Y')) as tgl_akhir
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
    $this->db->where("l.id_pemulihan", $this->session->id_pegawai);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	  $this->db->from('ol_logbook_pemulihan l');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=l.id_pegawai','left');
		$this->db->join('kol_working kw', 'kw.id_working=l.id_instansi_pemulihan','left');
		$this->db->join('ol_unit ou', 'ou.id_unit=l.id_unit_pemulihan','left');
      $this->db->where("l.id_pemulihan", $this->session->id_pegawai);

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
    $this->db->where("l.id_pemulihan", $this->session->id_pegawai);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	  $this->db->from('ol_logbook_pemulihan l');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=l.id_pegawai','left');
		$this->db->join('kol_working kw', 'kw.id_working=l.id_instansi_pemulihan','left');
		$this->db->join('ol_unit ou', 'ou.id_unit=l.id_unit_pemulihan','left');
    $this->db->where("l.id_pemulihan", $this->session->id_pegawai);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99');
		$jml = $this->m_umum->jumlah_record_filter('pegawai',$kondisi);	 */
		$jml = $this->m_umum->jumlah_record_tabel('ol_logbook_pemulihan');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
  function logbook_kegiatan_pemulihan($id)
	{
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,
					if (tgl_kegiatan_pemulihan = '0000-00-00' ,'TIDAK ADA',DATE_FORMAT(tgl_kegiatan_pemulihan,'%d-%m-%Y')) as tgl_kegiatan_pemulihan
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
    $this->db->where("lkp.id_logbook_pemulihan", $id);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	$this->db->from('ol_logbook_kegiatan_pemulihan lkp');
	$this->db->join('ol_logbook_pemulihan olp', 'olp.id_logbook_pemulihan=lkp.id_logbook_pemulihan','left');
	$this->db->join('ol_pegawai peg', 'peg.id_pegawai=lkp.id_penguji','left');
	$this->db->join('ol_kewenangan ok', 'ok.id_kewenangan=lkp.id_kewenangan','left');
    $this->db->where("barcode_logbook_pemulihan", $id);

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
    $this->db->where("lkp.id_logbook_pemulihan", $id);
			}
		  }
		}

	$this->db->from('ol_logbook_kegiatan_pemulihan lkp');
	$this->db->join('ol_logbook_pemulihan olp', 'olp.id_logbook_pemulihan=lkp.id_logbook_pemulihan','left');
	$this->db->join('ol_pegawai peg', 'peg.id_pegawai=lkp.id_penguji','left');
	$this->db->join('ol_kewenangan ok', 'ok.id_kewenangan=lkp.id_kewenangan','left');
    $this->db->where("barcode_logbook_pemulihan", $id);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99');
		$jml = $this->m_umum->jumlah_record_filter('pegawai',$kondisi);	 */
		$jml = $this->m_umum->jumlah_record_tabel('ol_logbook_pemulihan');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function edit_status_logbook_pemulihan($id){
		$data_pendaftaran = array(
      'status_pemulihan' => 1
		);
		$this->db->where('id_logbook_pemulihan',$id);
		$this->db->update('ol_logbook_pemulihan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
  function simpan_logbook_kegiatan_pemulihan(){
    $rm_kegiatan_pemulihan = $this->input->post('rm_kegiatan_pemulihan');
    $jml_kegiatan_pemulihan = $this->input->post('jml_kegiatan_pemulihan');
    $id_logbook_pemulihan = $this->input->post('id_logbook_pemulihan');
    $tgl_kegiatan_pemulihan = $this->input->post('tgl_kegiatan_pemulihan');
		$tgl_kegiatan_pemulihan = date('Y-m-d', strtotime($tgl_kegiatan_pemulihan));
		$chk = $this->input->post('chk[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				$this->db->select("COUNT(*) as num");
				$this->db->where('id_kewenangan',$chk[$i]);
				$this->db->where('tgl_kegiatan_pemulihan',$tgl_kegiatan_pemulihan);
				$this->db->where('id_logbook_pemulihan',$id_logbook_pemulihan);
				$q = $this->db->get('ol_logbook_kegiatan_pemulihan')->row();
				$jml = $q->num;
				if($jml == 0){
					$kode = $this->m_rancak->kode_generator(15,'');
					$lb = $this->m_umum->ambil_data('logbook','id_logbook',$chk[$i]);
					$q = $this->simpan_logbook($jml_kegiatan_pemulihan,$rm_kegiatan_pemulihan,$chk[$i],$tgl_kegiatan_pemulihan);
					$data_pendaftaran = array(
						'id_kewenangan' => $chk[$i],
						'id_logbook_pemulihan' => $id_logbook_pemulihan,
						'id_logbook' => $q,
						'barcode_kegiatan_pemulihan' => $kode,
						'tgl_kegiatan_pemulihan' => $tgl_kegiatan_pemulihan,
			            'rm_kegiatan_pemulihan' => $rm_kegiatan_pemulihan,
			            'jml_kegiatan_pemulihan' => $jml_kegiatan_pemulihan,
			            'result_kegiatan_pemulihan' => 0,
			            'id_penguji' => $this->input->post('id_penguji')
					);
					$this->db->insert('ol_logbook_kegiatan_pemulihan', $data_pendaftaran);
				}
			}
		}
	}
	function simpan_logbook($jml_logbook,$rm,$id_kewenangan,$tgl_logbook){
		$id_pegawai=$this->input->post('id_pegawai');
		$kode = $this->m_rancak->kode_generator(15,'LP');
		$id_instansi_pemulihan=$this->input->post('id_instansi_pemulihan');
		if($jml_logbook == '0' OR empty($jml_logbook)){
			$jml_logbook = '1';
		}
			$data_pendaftaran = array(
				'id_kewenangan' => $id_kewenangan,
				'id_instansi' => $id_instansi_pemulihan,
				'jml_logbook' => $jml_logbook,
				'rm' => $rm,
				'barcode_logbook' => $kode,
				'tgl_logbook' => $tgl_logbook,
				'mandiri' => 0,
				'id_logbooker' => $id_pegawai
			);
			$this->db->insert('ol_logbook', $data_pendaftaran);
		return $this->db->insert_id();
	}
	function edit_logbook_kegiatan_pemulihan(){
		$id_kegiatan_pemulihan = $this->input->post('id_kegiatan_pemulihan');
		$tgl_kegiatan_pemulihan = $this->input->post('tgl_kegiatan_pemulihan');
		$tgl_kegiatan_pemulihan = date('Y-m-d', strtotime($tgl_kegiatan_pemulihan));
		$data_pendaftaran = array(
      'tgl_kegiatan_pemulihan' => $tgl_kegiatan_pemulihan,
      'rm_kegiatan_pemulihan' => $this->input->post('rm_kegiatan_pemulihan'),
      'catatan_kegiatan_pemulihan' => $this->input->post('catatan_kegiatan_pemulihan'),
      'result_kegiatan_pemulihan' => $this->input->post('result_kegiatan_pemulihan'),
      'id_penguji' => $this->input->post('id_penguji')
		);
		$this->db->where('id_kegiatan_pemulihan',$id_kegiatan_pemulihan);
		$this->db->update('ol_logbook_kegiatan_pemulihan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
}