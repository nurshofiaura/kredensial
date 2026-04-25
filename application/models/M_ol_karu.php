<?php
class M_ol_karu extends CI_model{
	function etik_all($id)
	{
	//	$ids = explode(',', $jabatan);
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
		$this->db->where('ol_etik.id_jabatan',$id);
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_etik');
		$this->db->join('jabatan', 'jabatan.id_jabatan=ol_etik.id_jabatan','left');
		if($id > 0){
		$this->db->where('ol_etik.id_jabatan',$id);
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
		$this->db->where('ol_etik.id_jabatan',$id);
		}
			}
		  }
		}

	    $this->db->from('ol_etik');
		$this->db->join('jabatan', 'jabatan.id_jabatan=ol_etik.id_jabatan','left');
		if($id > 0){
		$this->db->where('ol_etik.id_jabatan',$id);
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('ol_etik');

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
				'status_etik' => $this->input->post('status_etik'),
				'pembuat' => $this->session->id_pegawai
			);
			$this->db->insert('ol_etik', $data_pendaftaran);
		}
		}
	}
	function edit_etik(){
		$id_etik = $this->input->post('id_etik');
		$data_pendaftaran = array(
			'id_jabatan' => $this->input->post('id_jabatan'),
			'nama_etik' => $this->input->post('nama_etik'),
			'answer' => $this->input->post('answer'),
			'status_etik' => $this->input->post('status_etik')
		);
		$this->db->where('id_etik',$id_etik);
		$this->db->update('ol_etik', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function ms_etik_all($id)
	{
		$ids = explode(',', $this->session->list_instansi);
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
		$this->db->where_in('ol_etik_instansi.id_instansi',$ids);
		if($id > 0){
		$this->db->where('ol_etik_instansi.id_jabatan',$id);
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_etik_instansi');
		$this->db->join('jabatan', 'jabatan.id_jabatan=ol_etik_instansi.id_jabatan','left');
		$this->db->join('kol_working', 'kol_working.id_working=ol_etik_instansi.id_instansi','left');
		$this->db->where_in('ol_etik_instansi.id_instansi',$ids);
		if($id > 0){
		$this->db->where('ol_etik_instansi.id_jabatan',$id);
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
		$this->db->where_in('ol_etik_instansi.id_instansi',$ids);
		if($id > 0){
		$this->db->where('ol_etik_instansi.id_jabatan',$id);
		}
			}
		  }
		}

	    $this->db->from('ol_etik_instansi');
		$this->db->join('jabatan', 'jabatan.id_jabatan=ol_etik_instansi.id_jabatan','left');
		$this->db->join('kol_working', 'kol_working.id_working=ol_etik_instansi.id_instansi','left');
		$this->db->where_in('ol_etik_instansi.id_instansi',$ids);
		if($id > 0){
		$this->db->where('ol_etik_instansi.id_jabatan',$id);
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('ol_etik_instansi');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_ms_etik(){
		$chk = $this->input->post('chk[]');
		$etik = implode(",",$chk);
		$data_kewenangan = array(
			'id_jabatan' => $this->input->post('id_jabatan'),
			'id_instansi' => $this->input->post('id_instansi'),
			'etik' => $etik
		);
		return $this->db->insert('ol_etik_instansi', $data_kewenangan);
	}
	function edit_ms_etik(){
		$id_etik_instansi = $this->input->post('id_etik_instansi');
		$chk = $this->input->post('chk[]');
		if(empty($chk)){
			$etik = '';
		}else{
			$etik = implode(",",$chk);
		}
		$data_pendaftaran = array(
			'id_jabatan' => $this->input->post('id_jabatan'),
			'id_instansi' => $this->input->post('id_instansi'),
			'status_etik_instansi' => $this->input->post('status_etik_instansi'),
			'etik' => $etik
		);
		$this->db->where('id_etik_instansi',$id_etik_instansi);
		$this->db->update('ol_etik_instansi', $data_pendaftaran);
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
		$ids = explode(',', $this->session->list_instansi);
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,p2.nama_pegawai as penguji";
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
			$this->db->where_in('ol_etik_pegawai.id_instansi',$ids);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_etik_pegawai');
		$this->db->join('ol_pegawai p1','p1.id_pegawai=ol_etik_pegawai.id_pegawai','left');
		$this->db->join('ol_pegawai p2','p2.id_pegawai=ol_etik_pegawai.id_penguji','left');
		$this->db->join('kol_working', 'kol_working.id_working=ol_etik_pegawai.id_instansi','left');
			$this->db->where_in('ol_etik_pegawai.id_instansi',$ids);


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
			$this->db->where_in('ol_etik_pegawai.id_instansi',$ids);

			}
		  }
		}

	    $this->db->from('ol_etik_pegawai');
		$this->db->join('ol_pegawai p1','p1.id_pegawai=ol_etik_pegawai.id_pegawai','left');
		$this->db->join('ol_pegawai p2','p2.id_pegawai=ol_etik_pegawai.id_penguji','left');
		$this->db->join('kol_working', 'kol_working.id_working=ol_etik_pegawai.id_instansi','left');		
			$this->db->where_in('ol_etik_pegawai.id_instansi',$ids);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('ol_etik_pegawai');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_etik_pegawai(){
		$id_pegawai = $this->input->post('id_pegawai');
		$id_instansi = $this->input->post('id_instansi');
		$sub_total = $this->input->post('sub_total');
		$hasilGR = $this->input->post('hasilGR');
		$total = $this->input->post('total');
		$id_penguji = $this->session->id_pegawai;
		$Skr = date('Y-m-d');
		$clock = date('H:i:s');
		$kode = $this->m_rancak->kode_generator(15,'');
		$data_pendaftaran = array(
				'barcode_etik_pegawai' => $kode,
				'id_pegawai' => $id_pegawai,
				'id_instansi' => $id_instansi,
				'tgl_etik_pegawai' => $Skr,
				'id_penguji' => $id_penguji,
				'total_etik' => $sub_total,
				'hasil_etik' => $hasilGR,
				'jumlah_etik' => $total,
				'jam_etik_pegawai' => $clock
			);
		$this->db->insert('ol_etik_pegawai', $data_pendaftaran);
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
				$this->db->insert('ol_etik_detil', $data_pendaftaran);
		}
	}
}