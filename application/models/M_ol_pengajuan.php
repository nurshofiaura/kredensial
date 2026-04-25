<?php
class M_ol_pengajuan extends CI_model{
	function pengajuan_kompetensi_all()
	{
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,DATE_FORMAT(b.tgl_pengajuan,'%d-%m-%Y') as tgl_pengajuan,if(mas_bayar = 0,'free',if(status_lunas = 0,'blm','free')) as status_lunas
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
		$this->db->where("ou.id_user", $this->session->id_user);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_pengajuan b');
		$this->db->join('ol_status_diusulkan su', 'su.id_status_diusulkan=b.id_status_diusulkan','left');
		$this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=b.barcode_pegawai','left');
		$this->db->join('ol_user ou', 'ou.id_pegawai=peg.id_pegawai','left');
		$this->db->join('kol_working kw', 'kw.id_working=b.id_instansi','left');
		$this->db->where("ou.id_user", $this->session->id_user);

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
		$this->db->where("ou.id_user", $this->session->id_user);
			}
		  }
		}

	    $this->db->from('ol_pengajuan b');
		$this->db->join('ol_status_diusulkan su', 'su.id_status_diusulkan=b.id_status_diusulkan','left');
		$this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=b.barcode_pegawai','left');
		$this->db->join('ol_user ou', 'ou.id_pegawai=peg.id_pegawai','left');
		$this->db->join('kol_working kw', 'kw.id_working=b.id_instansi','left');
		$this->db->where("ou.id_user", $this->session->id_user);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
 		$kondisi=array('barcode_pegawai'=>$this->session->barcode_pegawai);
		$jml = $this->m_umum->jumlah_record_filter('ol_pengajuan',$kondisi);	 
//		$jml = $this->m_umum->jumlah_record_tabel('ol_pengajuan');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
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
    $query = $this->db->select("COUNT(*) as num")->get_where('ol_logbook');
    $result = $query->row();
    if(isset($result))
        return $result->num;
    return 0;
 }
 function simpan_3_pengajuan_kompetensi($idx){
  $id_status_diusulkan = $this->input->post('id_status_diusulkan');
  $id_instansi = $this->input->post('id_instansi');
  $id = $this->m_rancak->kode_generator_urut(15,'PK');
  $kode = $this->m_rancak->kode_generator(15,'PK');
   $data_kewenangan = array(
    'barcode_pegawai' =>$this->session->barcode_pegawai,
    'id_status_diusulkan' =>$id_status_diusulkan,
    'barcode_pengajuan_temp' =>$idx,
    'nominal_pengajuan' =>0,
    'id_instansi' =>$id_instansi,
    'tgl_pengajuan' => date('Y-m-d'),
    'status_lunas' => 1,
    'id_pengajuan' => $id,
    'barcode_pengajuan' => $kode
   );   
  return $this->db->insert('ol_pengajuan', $data_kewenangan);
 }
 function simpan_3_pengajuan_kompetensi_temp($id){
  $id_status_diusulkan = $this->input->post('id_status_diusulkan');
  $id_instansi = $this->input->post('id_instansi');
  $kode = $this->m_rancak->kode_generator(15,'PT');
  $nominal_pengajuan_temp = substr($kode, -14);
  $data_kewenangan = array(
   'id_status_diusulkan' =>$id_status_diusulkan,
   'id_instansi' =>$id_instansi,
   'id_instansi' =>$id_instansi,
   'barcode_pengajuan_temp' => $kode,
   'status_pengajuan_temp' => $id,
   'tgl_pengajuan' => date('Y-m-d'),
   'barcode_pegawai' => $this->session->barcode_pegawai
  );
  $this->db->insert('ol_pengajuan_temp', $data_kewenangan);
  return $kode;
 }
	function simpan_pengajuan_kompetensi_temp(){
		$id_status_diusulkan = $this->input->post('id_status_diusulkan');
		$id_instansi = $this->input->post('id_instansi');
		$kode = $this->m_rancak->kode_generator(15,'PT');
		$nominal_pengajuan_temp = substr($kode, -14);
		$data_kewenangan = array(
			'id_status_diusulkan' =>$id_status_diusulkan,
			'id_instansi' =>$id_instansi,
			'barcode_pengajuan_temp' => $kode,
			'tgl_pengajuan' => date('Y-m-d'),
			'barcode_pegawai' => $this->session->barcode_pegawai
		);
		$this->db->insert('ol_pengajuan_temp', $data_kewenangan);
		return $kode;
	}
	function simpan_pengajuan_kompetensi(){
		$id = $this->m_rancak->kode_generator_urut(15,'PK');
		$kode = $this->m_rancak->kode_generator(15,'PK');
		$id_status_diusulkan = $this->input->post('id_status_diusulkan');
		$id_instansi = $this->input->post('id_instansi');
		$data_kewenangan = array(
			'id_status_diusulkan' =>$id_status_diusulkan,
			'id_instansi' =>$this->session->refer,
			'tgl_pengajuan' => date('Y-m-d'),
			'id_pengajuan' => $id,
			'barcode_pengajuan' => $kode,
			'barcode_pegawai' => $this->session->barcode_pegawai
		);
		$this->db->insert('ol_pengajuan', $data_kewenangan);
		return $id;
	}
	function simpan_pengajuan_validasi($eimplo,$last){
		$bookseat = explode(',', $eimplo);
		for($i = 0; $i < count($bookseat); ++$i){
			$this->db->select("COUNT(*) as num");
			$this->db->where('plan_pengajuan_validasi', $bookseat[$i]);
			$this->db->where('id_pengajuan',$last);
			$q = $this->db->get('ol_pengajuan_validasi')->row();
			$jmlx = $q->num;
			if($jmlx == 0){
				$kode = $this->m_rancak->kode_generator(15,'');
				$data_pendaftaran2 = array(
					'plan_pengajuan_validasi' => $bookseat[$i],
					'barcode_pengajuan_validasi' => $kode,
					'id_pengajuan' =>  $last
				);
				$this->db->insert('ol_pengajuan_validasi', $data_pendaftaran2);
			}
		}
	}
	function edit_pengajuan(){
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
		$this->db->update('ol_pengajuan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function rubah_status_kompetensi($isi,$id){
		$data_pendaftaran = array(
			'status_pengajuan' => $isi
		);
		$this->db->where('id_pengajuan',$id);
		$this->db->update('ol_pengajuan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}
	function tabel_logbook($id)
	{
		$apk = $this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$id); //barcode
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_logbook,b.barcode_logbook,
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
		$this->db->where("b.id_logbooker", $this->session->id_pegawai);
		$this->db->where("b.id_pengajuan", $apk['id_pengajuan']);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_logbook b');
				$this->db->join('ol_logbook_validasi olv', 'olv.barcode_logbook=b.barcode_logbook','left');
		$this->db->join('kol_working kow', 'kow.id_working=b.id_instansi','left');
		$this->db->join('ol_pegawai p', 'p.id_pegawai=b.id_logbooker','left');
		$this->db->join('nkr_kewenangan ok', 'ok.id_kewenangan=b.id_kewenangan','left');
		$this->db->join('nkr_kompetensi okm', 'okm.id_kompetensi=ok.id_kompetensi','left');
		$this->db->where("b.id_logbooker", $this->session->id_pegawai);
		$this->db->where("b.id_pengajuan", $apk['id_pengajuan']);

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
		$this->db->where("b.id_logbooker", $this->session->id_pegawai);
			$this->db->where("b.id_pengajuan", $apk['id_pengajuan']);
			}
		  }
		}

		$this->db->from('ol_logbook b');
				$this->db->join('ol_logbook_validasi olv', 'olv.barcode_logbook=b.barcode_logbook','left');
		$this->db->join('kol_working kow', 'kow.id_working=b.id_instansi','left');
		$this->db->join('ol_pegawai p', 'p.id_pegawai=b.id_logbooker','left');
		$this->db->join('nkr_kewenangan ok', 'ok.id_kewenangan=b.id_kewenangan','left');
		$this->db->join('nkr_kompetensi okm', 'okm.id_kompetensi=ok.id_kompetensi','left');
		$this->db->where("b.id_logbooker", $this->session->id_pegawai);
		$this->db->where("b.id_pengajuan", $apk['id_pengajuan']);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
 		$kondisi=array('id_pengajuan'=>$apk['id_pengajuan']);
		$jml = $this->m_umum->jumlah_record_filter('ol_logbook',$kondisi);	
	//	$jml = $this->m_umum->jumlah_record_tabel('ol_logbook');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function logbook_pengajuan($first_date,$last_date,$id)
	{
		$peng = $this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$id);
		$ids = explode(',', $peng['kode_unit_pengajuan']);
		$this->db->select("*,DATE_FORMAT(lp.tgl_logbook,'%d-%m-%Y') as tgl_logbook");
		$this->db->join('nkr_kewenangan krw', 'krw.id_kewenangan=lp.id_kewenangan','left');
		$this->db->where("lp.id_logbooker", $this->session->id_pegawai);
		$this->db->where("lp.id_pengajuan", 0);
		$this->db->where("lp.mandiri", 1);
	//	$this->db->where('lp.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$this->db->where_in('krw.id_kompetensi',$ids);
		$q = $this->db->get('ol_logbook lp');
		return $q->result_array();
	}
	function logbook_ditolak($first_date,$last_date)
	{
		$this->db->select("*,DATE_FORMAT(lp.tgl_logbook,'%d-%m-%Y') as tgl_logbook");
		$this->db->join('ol_kewenangan krw', 'krw.id_kewenangan=lp.id_kewenangan','left');
		$this->db->join('kol_kode_kewenangan kw', 'kw.id_kode_kewenangan=krw.id_kode_kewenangan','left');
		$this->db->where("lp.id_logbooker", $this->session->id_pegawai);
		$this->db->where("lp.id_pengajuan", 0);
		$this->db->where("lp.mandiri", 0);
	//	$this->db->where('lp.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$q = $this->db->get('ol_logbook lp');
		return $q->result_array();
	}
	function simpan_logbook(){
		$chk = $this->input->post('chk[]');
		$id_kewenangan = $this->input->post('id_kewenangan[]');
		$id_status_diusulkan = $this->input->post('id_status_diusulkan');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				if($id_status_diusulkan == 4){ //pemulihan
					$this->edit_logbook($chk[$i]);
				}else{
					$this->cek_logbook_tolak($chk[$i],$id_kewenangan[$i]);
				}
				
			}
		}
	}
	function simpan_kode_unit_pengajuan(){
		$chk = $this->input->post('chk[]');
		if($chk){
   $eimplo = implode(",",$chk);
  }else{
   $eimplo = "";
  }
			$id_pengajuan = $this->input->post('id_pengajuan');
				$data_kewenangan_detil = array(
					'kode_unit_pengajuan' =>$eimplo
				);
			$this->db->where('id_pengajuan',$id_pengajuan);
			$this->db->update('ol_pengajuan', $data_kewenangan_detil);
			//echo $this->db->last_query();
			$this->db->trans_complete();	// untuk cek sukses update tidak
			if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
			// if (!$this->db->affected_rows())
				return(FALSE);
			else
				return(TRUE);
	}
	function simpan_berkas_modal($id,$eimplo){
			$chk = $this->input->post('chk[]');
			$id_pengajuan = $this->input->post('id_pengajuan');
			if($chk){
				$data_kewenangan_detil = array(
					$id =>$eimplo
				);
			}else{
				$data_kewenangan_detil = array(
					$id =>''
				);
			}
			$this->db->where('id_pengajuan',$id_pengajuan);
			$this->db->update('ol_pengajuan', $data_kewenangan_detil);
			//echo $this->db->last_query();
			$this->db->trans_complete();	// untuk cek sukses update tidak
			if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
			// if (!$this->db->affected_rows())
				return(FALSE);
			else
				return(TRUE);
	}
	function cek_logbook_tolak($chk,$id_kewenangan){
		$id_pegawai=$this->session->id_pegawai;
		$this->db->select("COUNT(*) as num");
		$this->db->where('id_logbooker',$id_pegawai);
		$this->db->where('id_kewenangan',$id_kewenangan);
		$this->db->where('tolak >',0);
		$q = $this->db->get('ol_logbook')->row();
		$jml = $q->num;
		if($jml == 0){
			$this->edit_logbook($chk);
		}
	}
	function edit_logbook($id){
		$id_status_diusulkan = $this->input->post('id_status_diusulkan');
			$data_kewenangan_detil = array(
				'id_pengajuan' =>$this->input->post('id_pengajuan')
			);
		$this->db->where('id_logbook',$id);
		$this->db->update('ol_logbook', $data_kewenangan_detil);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function berkas_ijasah_all()
	{
		$ids = explode(',', $this->session->mas_asesor);
		$idx = explode(',', $this->session->mas_ins);
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,
		if (b.tgl_a_berkas = '0000-00-00' ,'TIDAK ADA',if (b.tgl_a_berkas = NULL ,'TIDAK ADA',DATE_FORMAT(b.tgl_a_berkas,'%d-%m-%Y'))) as tgl_a_berkas,
		if (b.tgl_b_berkas = '0000-00-00' ,'TIDAK ADA',if (b.tgl_b_berkas = NULL ,'TIDAK ADA',DATE_FORMAT(b.tgl_b_berkas,'%d-%m-%Y'))) as tgl_b_berkas
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
				//	 case 'nama_pengcab' : $nmf="op.nama_pengcab";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}	
				$this->db->where("b.id_kategori_berkas", 7);
				$this->db->where("b.id_pegawai", $this->session->id_pegawai);	
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_berkas b');
		$this->db->join('kol_pendidikan kp', 'kp.id_pendidikan=b.id_pendidikan','left');
		$this->db->where("b.id_kategori_berkas", 7);
		$this->db->where("b.id_pegawai", $this->session->id_pegawai);

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'nama_pengcab' : $nmf="op.nama_pengcab";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where("b.id_kategori_berkas", 7);
				$this->db->where("b.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}

	    $this->db->from('ol_berkas b');
		$this->db->join('kol_pendidikan kp', 'kp.id_pendidikan=b.id_pendidikan','left');
		$this->db->where("b.id_kategori_berkas", 7);
		$this->db->where("b.id_pegawai", $this->session->id_pegawai);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----	
		$jml = $this->m_umum->jumlah_record_tabel('ol_berkas');
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_berkas_ijasah($id_pengajuan,$id_berkas_data,$id_ijasahe){
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
		$this->db->update('ol_pengajuan', $data_count);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function reset_logbook($id,$status){
			$data_pendaftaran = array(
				'id_pengajuan' => 0
			);			
		$this->db->where('id_logbook',$id);
		$this->db->update('ol_logbook', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function berkas_str_all()
	{
		$fields = "*,
		if (b.tgl_a_berkas = '0000-00-00' ,'TIDAK ADA',if (b.tgl_a_berkas = NULL ,'TIDAK ADA',DATE_FORMAT(b.tgl_a_berkas,'%d-%m-%Y'))) as tgl_a_berkas,
		if (b.tgl_b_berkas = '0000-00-00' ,'TIDAK ADA',if (b.tgl_b_berkas = NULL ,'TIDAK ADA',DATE_FORMAT(b.tgl_b_berkas,'%d-%m-%Y'))) as tgl_b_berkas
		";
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));
		$order = $this->input->post('order');
		$cari = $this->input->post('search');
		$col =$order[0]['column'];
		$dir= $order[0]['dir'];
		$dt_kolom=$this->input->post('columns');
		$this->db->select($fields);  
		if(!empty($cari['value'])) {    
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ 
				switch($k['data']){		
				//	 case 'no_hp' : $nmf="peg.no_hp";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where("kunci", 0);
				$this->db->where("status_berkas", 1);
				$this->db->where("b.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir); 
	    $this->db->from('ol_berkas b');
		$this->db->join('ol_berkas_kategori kb', 'kb.id_berkas_kategori=b.id_kategori_berkas','left');
		$this->db->join('ol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=b.id_kategori_pelatihan','left');
		$this->db->where("kunci", 0);
		$this->db->where("status_berkas", 1);
		$this->db->where("b.id_pegawai", $this->session->id_pegawai);
		$q = $this->db->limit($length,$start)->get_where(); 
		$list=$q->result_array(); //06 Hasil
		$this->db->select("COUNT(*) as num");	
		if(!empty($cari['value'])) {    
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ 
				switch($k['data']){		
				//	case 'no_hp' : $nmf="peg.no_hp";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where("kunci", 0);
				$this->db->where("status_berkas", 1);
				$this->db->where("b.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}
	    $this->db->from('ol_berkas b');
		$this->db->join('ol_berkas_kategori kb', 'kb.id_berkas_kategori=b.id_kategori_berkas','left');
		$this->db->join('ol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=b.id_kategori_pelatihan','left');
		$this->db->where("kunci", 0);
		$this->db->where("status_berkas", 1);
		$this->db->where("b.id_pegawai", $this->session->id_pegawai);
		$q = $this->db->get_where();
		$jml_filter = $q->row()->num;
/* 		$kondisi=array('ol_berkas_kategori.kunci'=>0, 'ol_berkas.id_pegawai'=>$this->session->id_pegawai);
		$jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_berkas',$kondisi,'ol_berkas_kategori','id_kategori_berkas');*/	
		$jml = $this->m_umum->jumlah_record_tabel('ol_berkas');
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
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
		$this->db->update('ol_pengajuan', $data_count);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function berkas_pelatihan_all()
	{
		$fields = "*,
		if (b.tgl_a_berkas = '0000-00-00' ,'TIDAK ADA',if (b.tgl_a_berkas = NULL ,'TIDAK ADA',DATE_FORMAT(b.tgl_a_berkas,'%d-%m-%Y'))) as tgl_a_berkas,
		if (b.tgl_b_berkas = '0000-00-00' ,'TIDAK ADA',if (b.tgl_b_berkas = NULL ,'TIDAK ADA',DATE_FORMAT(b.tgl_b_berkas,'%d-%m-%Y'))) as tgl_b_berkas
		";
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));
		$order = $this->input->post('order');
		$cari = $this->input->post('search');
		$col =$order[0]['column'];
		$dir= $order[0]['dir'];
		$dt_kolom=$this->input->post('columns');
		$this->db->select($fields);  
		if(!empty($cari['value'])) {    
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ 
				switch($k['data']){		
				//	 case 'no_hp' : $nmf="peg.no_hp";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where("kunci", 1);
				$this->db->where("b.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir); 
	    $this->db->from('ol_berkas b');
		$this->db->join('ol_berkas_kategori kb', 'kb.id_berkas_kategori=b.id_kategori_berkas','left');
		$this->db->join('ol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=b.id_kategori_pelatihan','left');
		$this->db->where("kunci", 1);
		$this->db->where("b.id_pegawai", $this->session->id_pegawai);
		$q = $this->db->limit($length,$start)->get_where(); 
		$list=$q->result_array(); //06 Hasil
		$this->db->select("COUNT(*) as num");	
		if(!empty($cari['value'])) {    
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ 
				switch($k['data']){		
				//	case 'no_hp' : $nmf="peg.no_hp";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where("kunci", 1);
				$this->db->where("b.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}
	    $this->db->from('ol_berkas b');
		$this->db->join('ol_berkas_kategori kb', 'kb.id_berkas_kategori=b.id_kategori_berkas','left');
		$this->db->join('ol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=b.id_kategori_pelatihan','left');
		$this->db->where("kunci", 1);
		$this->db->where("b.id_pegawai", $this->session->id_pegawai);
		$q = $this->db->get_where();
		$jml_filter = $q->row()->num;
/* 		$kondisi=array('ol_berkas_kategori.kunci'=>1, 'ol_berkas.id_pegawai'=>$this->session->id_pegawai);
		$jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_berkas',$kondisi,'ol_berkas_kategori','id_kategori_berkas');*/	
		$jml = $this->m_umum->jumlah_record_tabel('ol_berkas');
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
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
		$this->db->update('ol_pengajuan', $data_count);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function berkas_pribadi_all()
	{
		$fields = "*,
		if (b.tgl_a_berkas = '0000-00-00' ,'TIDAK ADA',if (b.tgl_a_berkas = NULL ,'TIDAK ADA',DATE_FORMAT(b.tgl_a_berkas,'%d-%m-%Y'))) as tgl_a_berkas,
		if (b.tgl_b_berkas = '0000-00-00' ,'TIDAK ADA',if (b.tgl_b_berkas = NULL ,'TIDAK ADA',DATE_FORMAT(b.tgl_b_berkas,'%d-%m-%Y'))) as tgl_b_berkas
		";
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));
		$order = $this->input->post('order');
		$cari = $this->input->post('search');
		$col =$order[0]['column'];
		$dir= $order[0]['dir'];
		$dt_kolom=$this->input->post('columns');
		$this->db->select($fields);  
		if(!empty($cari['value'])) {    
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ 
				switch($k['data']){		
				//	 case 'no_hp' : $nmf="peg.no_hp";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where("b.id_kategori_berkas >", 11);
				$this->db->where("b.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir); 
	    $this->db->from('ol_berkas b');
		$this->db->join('ol_berkas_kategori kb', 'kb.id_berkas_kategori=b.id_kategori_berkas','left');
		$this->db->where("b.id_kategori_berkas >", 11);
		$this->db->where("b.id_pegawai", $this->session->id_pegawai);
		$q = $this->db->limit($length,$start)->get_where(); 
		$list=$q->result_array(); //06 Hasil
		$this->db->select("COUNT(*) as num");	
		if(!empty($cari['value'])) {    
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ 
				switch($k['data']){		
				//	case 'no_hp' : $nmf="peg.no_hp";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where("b.id_kategori_berkas >", 11);
				$this->db->where("b.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}
	    $this->db->from('ol_berkas b');
		$this->db->join('ol_berkas_kategori kb', 'kb.id_berkas_kategori=b.id_kategori_berkas','left');
		$this->db->where("b.id_kategori_berkas >", 11);
		$this->db->where("b.id_pegawai", $this->session->id_pegawai);
		$q = $this->db->get_where();
		$jml_filter = $q->row()->num;
/* 		$kondisi=array('ol_berkas_kategori.id_kategori_berkas >'=>11, 'ol_berkas.id_pegawai'=>$this->session->id_pegawai);
		$jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_berkas',$kondisi,'ol_berkas_kategori','id_kategori_berkas');*/	
		$jml = $this->m_umum->jumlah_record_tabel('ol_berkas');
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
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
		$this->db->update('ol_pengajuan', $data_count);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function etik_pegawai_all()
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
		$this->db->where("ol_etik_pegawai.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_etik_pegawai');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=ol_etik_pegawai.id_penguji','left');
		$this->db->where("ol_etik_pegawai.id_pegawai", $this->session->id_pegawai);

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
		$this->db->where("ol_etik_pegawai.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('ol_etik_pegawai');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=ol_etik_pegawai.id_penguji','left');
		$this->db->where("ol_etik_pegawai.id_pegawai", $this->session->id_pegawai);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
 		$kondisi=array('id_pegawai'=> $this->session->id_pegawai);
		$jml = $this->m_umum->jumlah_record_filter('ol_etik_pegawai',$kondisi);	
//		$jml = $this->m_umum->jumlah_record_tabel('kr_etik_pegawai');

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
		$this->db->update('ol_pengajuan', $data_count);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function pengajuan_validasi_berkas_edit_setuju(){
		$barcode_pengajuan_validasi = $this->input->post('barcode_pengajuan_validasi');
		$data_pendaftaran = array(
			'tgl_asesi' => date('Y-m-d H:i:s')
		);
		$this->db->where('barcode_pengajuan_validasi',$barcode_pengajuan_validasi);
		$this->db->update('nkr_pengajuan_validasi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function pengajuan_validasi_berkas_edit_locked(){
		$barcode_pengajuan_validasi = $this->input->post('barcode_pengajuan_validasi');
		$data_pendaftaran = array(
			'locked'=> 2
		);
		$this->db->where('barcode_pengajuan_validasi',$barcode_pengajuan_validasi);
		$this->db->update('nkr_pengajuan_validasi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function pengajuan_validasi_berkas_akhir_locked(){
		$barcode_pengajuan_validasi = $this->input->post('barcode_pengajuan_validasi');
		$data_pendaftaran = array(
			'tgl_asesi' => date('Y-m-d H:i:s'),
			'locked'=> 4
		);
		$this->db->where('barcode_pengajuan_validasi',$barcode_pengajuan_validasi);
		$this->db->update('nkr_pengajuan_validasi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function edit_jawaban_asesi_locked($id,$jawaban_validasi_detil){
		$barcode_pengajuan_validasi = $this->input->post('barcode_pengajuan_validasi');
		$data_pendaftaran = array(
			'jawaban_validasi_detil'=> $jawaban_validasi_detil
		);
		$this->db->where('id_validasi_detil',$id);
		$this->db->update('nkr_validasi_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function simpan_indikator_validasi_tulis_locked(){
		$chk = $this->input->post('chk[]');
		$jenis_soal = $this->input->post('jenis_soal[]');
		$jawaban_validasi_detil = $this->input->post('jawaban_validasi_detil[]');
		$id_soal_opsi = $this->input->post('id_soal_opsi[]');
		$jml_kode = count($chk);
		for ($i=0;$i<$jml_kode;$i++){
/*			if($jenis_soal[$i] == 0){
				$jvd = $jawaban_validasi_detil[$i];
			}else{
				$jvd = implode(",",$jawaban_validasi_detil);
			}*/
			$this->edit_jawaban_asesi_locked($chk[$i],$jawaban_validasi_detil[$i]);
		}
	}
	function pengajuan_validasi_berkas_banding_simpan(){
		$barcode_pengajuan_validasi = $this->input->post('barcode_pengajuan_validasi');
		$data_pendaftaran = array(
			'banding_asesi' =>$this->input->post('banding_asesi')
		);
		$this->db->where('barcode_pengajuan_validasi',$barcode_pengajuan_validasi);
		$this->db->update('nkr_pengajuan_validasi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function pengajuan_validasi_berkas_banding_konfirm(){
		$barcode_pengajuan_validasi = $this->input->post('barcode_pengajuan_validasi');
		$data_pendaftaran = array(
			'banding_asesi' =>$this->input->post('banding_asesi'),
			'locked' =>2
		);
		$this->db->where('barcode_pengajuan_validasi',$barcode_pengajuan_validasi);
		$this->db->update('nkr_pengajuan_validasi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function pengajuan_validasi_berkas_banding_setuju(){
		$barcode_pengajuan_validasi = $this->input->post('barcode_pengajuan_validasi');
		$tgl_asesi = $this->input->post('tgl_asesi');
		if(empty($tgl_asesi)){
			$data_pendaftaran = array(
				'tgl_asesi' => date('Y-m-d H:i:s'),
				'locked' =>4
			);
		}else{
		$data_pendaftaran = array(
				'banding_asesi' =>$this->input->post('banding_asesi')
			);			
		}
		$this->db->where('barcode_pengajuan_validasi',$barcode_pengajuan_validasi);
		$this->db->update('nkr_pengajuan_validasi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function pengajuan_validasi_berkas_kaji_ulang_setuju(){
		$barcode_pengajuan_validasi = $this->input->post('barcode_pengajuan_validasi');
		$kesesuaian_bukti = $this->input->post('kesesuaian_bukti[]');
		if (empty($kesesuaian_bukti)) {
		   $chkkesesuaian_bukti = "";
		}else{
			$chkkesesuaian_bukti = implode(",",$kesesuaian_bukti);
		}
		$tgl_asesi = $this->input->post('tgl_asesi');
		if(empty($tgl_asesi)){
			$data_pendaftaran = array(
				'kesesuaian_bukti_validasi' => $chkkesesuaian_bukti
			);
		}else{
		$data_pendaftaran = array(
			'kesesuaian_bukti_validasi' => $chkkesesuaian_bukti
			);			
		}
		$this->db->where('barcode_pengajuan_validasi',$barcode_pengajuan_validasi);
		$this->db->update('nkr_pengajuan_validasi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function pengajuan_validasi_berkas_komponen_konfirm(){
		$barcode_pengajuan_validasi = $this->input->post('barcode_pengajuan_validasi');
		$data_pendaftaran = array(
			'locked' =>2
		);
		$this->db->where('barcode_pengajuan_validasi',$barcode_pengajuan_validasi);
		$this->db->update('nkr_pengajuan_validasi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function pengajuan_validasi_berkas_komponen_setuju(){
		$barcode_pengajuan_validasi = $this->input->post('barcode_pengajuan_validasi');
		$tgl_asesi = $this->input->post('tgl_asesi');
		if(empty($tgl_asesi)){
			$data_pendaftaran = array(
				'tgl_asesi' => date('Y-m-d H:i:s'),
				'locked' =>4
			);
		}else{
		$data_pendaftaran = array(
				'banding_asesi' =>$this->input->post('banding_asesi')
			);			
		}
		$this->db->where('barcode_pengajuan_validasi',$barcode_pengajuan_validasi);
		$this->db->update('nkr_pengajuan_validasi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function simpan_kaji_ulang_setuju(){
		$chk = $this->input->post('id_validasi_detil[]');
		$komentar_kesenjangan = $this->input->post('komentar_kesenjangan[]');
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				$this->edit_kaji_ulang_setuju($komentar_kesenjangan[$i],$chk[$i]);
			}
	}
	function edit_kaji_ulang_setuju($komentar_kesenjangan,$chk){
		$data_pendaftaran = array(
			'komentar_kesenjangan' =>$komentar_kesenjangan
		);
		$this->db->where('id_validasi_detil',$chk);
		$this->db->update('nkr_validasi_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function tabel_logbook_validasi($id)
	{
		$kondisi=array('barcode_pengajuan_validasi'=>$id);
		$apk = $this->m_umum->ambil_data_kondisi_2tabel_row('nkr_pengajuan_validasi',$kondisi,'ol_pengajuan','barcode_pengajuan'); //barcode
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_logbook,b.barcode_logbook,
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
		$this->db->where("b.id_logbooker", $this->session->id_pegawai);
		$this->db->where("b.id_pengajuan", $apk['id_pengajuan']);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_logbook b');
				$this->db->join('ol_logbook_validasi olv', 'olv.barcode_logbook=b.barcode_logbook','left');
		$this->db->join('kol_working kow', 'kow.id_working=b.id_instansi','left');
		$this->db->join('ol_pegawai p', 'p.id_pegawai=b.id_logbooker','left');
		$this->db->join('nkr_kewenangan ok', 'ok.id_kewenangan=b.id_kewenangan','left');
		$this->db->join('nkr_kompetensi okm', 'okm.id_kompetensi=ok.id_kompetensi','left');
		$this->db->where("b.id_logbooker", $this->session->id_pegawai);
		$this->db->where("b.id_pengajuan", $apk['id_pengajuan']);

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
		$this->db->where("b.id_logbooker", $this->session->id_pegawai);
			$this->db->where("b.id_pengajuan", $apk['id_pengajuan']);
			}
		  }
		}

		$this->db->from('ol_logbook b');
				$this->db->join('ol_logbook_validasi olv', 'olv.barcode_logbook=b.barcode_logbook','left');
		$this->db->join('kol_working kow', 'kow.id_working=b.id_instansi','left');
		$this->db->join('ol_pegawai p', 'p.id_pegawai=b.id_logbooker','left');
		$this->db->join('nkr_kewenangan ok', 'ok.id_kewenangan=b.id_kewenangan','left');
		$this->db->join('nkr_kompetensi okm', 'okm.id_kompetensi=ok.id_kompetensi','left');
		$this->db->where("b.id_logbooker", $this->session->id_pegawai);
		$this->db->where("b.id_pengajuan", $apk['id_pengajuan']);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
 		$kondisi=array('id_pengajuan'=>$apk['id_pengajuan']);
		$jml = $this->m_umum->jumlah_record_filter('ol_logbook',$kondisi);	
	//	$jml = $this->m_umum->jumlah_record_tabel('ol_logbook');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function kol_etik_detil_all($id){
		$this->db->join('ol_etik_pegawai oep', 'oep.id_etik_pegawai=oed.id_etik_pegawai','left');
		$this->db->where('oep.id_etik_pegawai =', $id);
		$q = $this->db->get_where('ol_etik_detil oed');
		return $q->result_array();
	}
	function etik_pegawairow_all($id){
		$this->db->where('oep.id_etik_pegawai', $id);
		$q = $this->db->get_where('ol_etik_pegawai oep');
		return $q->row_array();
	}
	function ambil_data_instansi_row($id)
	{
		$this->db->join('kol_working kw', 'kw.id_working=pi.id_instansi','left');
		$q = $this->db->get_where('ol_pegawai_instansi pi',array('id_pegawai'=>$id));
			return $q->row_array();
	}
/*	function pengajuan_validasi_berkas_edit_setuju(){
		$barcode_pengajuan = $this->input->post('barcode_pengajuan');
		$barcode_form = $this->input->post('barcode_form');
		$data_pendaftaran = array(
			'tgl_asesi' => date('Y-m-d H:i:s')
		);
		$this->db->where('barcode_pengajuan',$barcode_pengajuan);
		$this->db->where('barcode_form',$barcode_form);
		$this->db->update('nkr_pengajuan_validasi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function pengajuan_validasi_permohonan_setuju(){
		$barcode_pengajuan = $this->input->post('barcode_pengajuan');
		$barcode_form = $this->input->post('barcode_form');
		$data_pendaftaran = array(
			'tgl_asesi_pengajuan' => date('Y-m-d H:i:s')
		);
		$this->db->where('barcode_pengajuan',$barcode_pengajuan);
	//	$this->db->where('barcode_form',$barcode_form);
		$this->db->update('ol_pengajuan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}*/
}