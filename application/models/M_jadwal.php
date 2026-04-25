<?php
class M_jadwal extends CI_model{
	function elemen_dinas_all()
	{
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,kw2.kode_warna as text_warna,kw2.nama_warna as text,kw.nama_warna,kw.kode_warna";
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
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where('id_unit',$this->session->unit);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('kol_dinas_jaga kdj');
		$this->db->join('kol_warna kw', 'kw.id_warna=kdj.id_warna','left');
		$this->db->join('kol_warna kw2', 'kw2.id_warna=kdj.id_text','left');
		$this->db->where('id_unit',$this->session->unit);

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
				$this->db->where('id_unit',$this->session->unit);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('kol_dinas_jaga kdj');
		$this->db->join('kol_warna kw', 'kw.id_warna=kdj.id_warna','left');
		$this->db->join('kol_warna kw2', 'kw2.id_warna=kdj.id_text','left');
		$this->db->where('id_unit',$this->session->unit);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$kondisi=array('id_unit'=>$this->session->unit);
		$jml = $this->m_umum->jumlah_record_filter('kol_dinas_jaga',$kondisi);		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function tambah_elemen(){
		 $id_warna = $this->input->post('id_warna');
		if(empty($id_warna)){
			$id_warna = 0;
		}
		$jml_dinas_jaga = $this->input->post('jml_dinas_jaga');
		if(empty($jml_dinas_jaga)){
			$jml_dinas_jaga = 0;
		}
		$id_text = $this->input->post('id_text');
		if(empty($id_text)){
			$id_text = 0;
		}
		$data_pendaftaran = array(
			'nama_dinas_jaga' => $this->input->post('nama_dinas_jaga'),
			'id_unit' => $this->input->post('id_unit'),
			'id_warna' => $id_warna,
			'jml_dinas_jaga' => $jml_dinas_jaga,
			'id_text' => $id_text
		);
		return $this->db->insert('kol_dinas_jaga', $data_pendaftaran);
	}
	function edit_elemen(){
		$id_dinas_jaga = $this->input->post('id_dinas_jaga');
		$id_warna = $this->input->post('id_warna');
	 if(empty($id_warna)){
		 $id_warna = 0;
	 }
	 $jml_dinas_jaga = $this->input->post('jml_dinas_jaga');
	 if(empty($jml_dinas_jaga)){
		 $jml_dinas_jaga = 0;
	 }
	 $id_text = $this->input->post('id_text');
	 if(empty($id_text)){
		 $id_text = 0;
	 }
		$data_pendaftaran = array(
			'nama_dinas_jaga' => $this->input->post('nama_dinas_jaga'),
			'id_warna' => $id_warna,
			'jml_dinas_jaga' => $jml_dinas_jaga,
			'id_text' => $id_text
		);
		$this->db->where('id_dinas_jaga',$id_dinas_jaga);
		$this->db->update('kol_dinas_jaga', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function pelengkap_dinas_all($id)
	{
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,peg.id_pegawai";
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
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where('unit',$id);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_pegawai peg');
		$this->db->join('pegawai_urutan pegu', 'pegu.id_pegawai=peg.id_pegawai','left');
		$this->db->join('ol_user ou', 'ou.id_pegawai=peg.id_pegawai','left');
		$this->db->where('unit',$id);

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
				$this->db->where('unit',$id);
			}
		  }
		}

	    $this->db->from('ol_pegawai peg');
		$this->db->join('pegawai_urutan pegu', 'pegu.id_pegawai=peg.id_pegawai','left');
		$this->db->join('ol_user ou', 'ou.id_pegawai=peg.id_pegawai','left');
		$this->db->where('unit',$id);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$kondisi=array('unit'=>$id);
		$jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_pegawai',$kondisi,'ol_user','id_pegawai');		
	//	$jml = $this->m_umum->jumlah_record_tabel('ol_pegawai_unit');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_urutan(){
		$kode = $this->m_rancak->kode_generator(15,'PU');
		$data_pendaftaran = array(
			'id_urutan' => $kode,
			'id_pegawai' => $this->input->post('id_pegawai'),
			'no_urutan' => $this->input->post('no_urutan')
		);
		return $this->db->insert('pegawai_urutan', $data_pendaftaran);
	}
	function edit_urutan(){
		$id_pegawai = $this->input->post('id_pegawai');
		$data_pendaftaran = array(
			'no_urutan' => $this->input->post('no_urutan')
		);
		$this->db->where('id_pegawai',$id_pegawai);
		$this->db->update('pegawai_urutan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function simpan_signature(){
		$kode = $this->m_rancak->kode_generator(15,'');
		$data_pendaftaran = array(
			'id_pelengkap' => $kode,
			'id_unit' => $this->session->unit,
			'text_kiri_top' => $this->input->post('text_kiri_top'),
			'text_tengah_top' => $this->input->post('text_tengah_top'),
			'text_kanan_top' => $this->input->post('text_kanan_top'),
			'text_kiri_middle' => $this->input->post('text_kiri_middle'),
			'text_tengah_middle' => $this->input->post('text_tengah_middle'),
			'text_kanan_middle' => $this->input->post('text_kanan_middle'),
			'text_kiri_bottom' => $this->input->post('text_kiri_bottom'),
			'text_tengah_bottom' => $this->input->post('text_tengah_bottom'),
			'text_kanan_bottom' => $this->input->post('text_kanan_bottom'),
			'text_kiri_nip' => $this->input->post('text_kiri_nip'),
			'text_tengah_nip' => $this->input->post('text_tengah_nip'),
			'text_kanan_nip' => $this->input->post('text_kanan_nip')
		);
		return $this->db->insert('jadwal_pelengkap', $data_pendaftaran);
	}
	function edit_signature(){
		$id_unit = $this->session->unit;
		$data_pendaftaran = array(
			'text_kiri_top' => $this->input->post('text_kiri_top'),
			'text_tengah_top' => $this->input->post('text_tengah_top'),
			'text_kanan_top' => $this->input->post('text_kanan_top'),
			'text_kiri_middle' => $this->input->post('text_kiri_middle'),
			'text_tengah_middle' => $this->input->post('text_tengah_middle'),
			'text_kanan_middle' => $this->input->post('text_kanan_middle'),
			'text_kiri_bottom' => $this->input->post('text_kiri_bottom'),
			'text_tengah_bottom' => $this->input->post('text_tengah_bottom'),
			'text_kanan_bottom' => $this->input->post('text_kanan_bottom'),
			'text_kiri_nip' => $this->input->post('text_kiri_nip'),
			'text_tengah_nip' => $this->input->post('text_tengah_nip'),
			'text_kanan_nip' => $this->input->post('text_kanan_nip')
		);
		$this->db->where('id_unit',$id_unit);
		$this->db->update('jadwal_pelengkap', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function cmd_pegawai($id){
	//	$this->db->select('*');
		$this->db->join('pegawai_urutan pegu', 'pegu.id_pegawai=peg.id_pegawai','left');
		$this->db->join('ol_pegawai pega', 'pega.id_pegawai=peg.id_pegawai','left');
		$this->db->order_by("no_urutan", "asc");
		$q = $this->db->get_where('ol_pegawai_unit peg',array('id_unit'=>$id));
		return $q->result_array();
	}
	function ambil_data_pegawai($id)
	{
		$this->db->select('peg.nama_pegawai,pegun.id_pegawai,peg.no_hp');
		$this->db->join('pegawai_urutan pegu', 'pegu.id_pegawai=pegun.id_pegawai','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=pegun.id_pegawai','left');
		$this->db->where("id_unit", $id);
		$this->db->order_by("no_urutan", "asc");
		$q = $this->db->get_where('ol_pegawai_unit pegun');	
/*		$this->db->join('ol_user ou', 'ou.id_pegawai=peg.id_pegawai','left');
		$this->db->join('pegawai_urutan pegu', 'pegu.id_pegawai=peg.id_pegawai','left');
		$this->db->where("ou.unit", $id);
		$this->db->order_by("no_urutan", "asc");			
		$q = $this->db->get_where('ol_pegawai peg');*/
		return $q->result_array();
	}
	function ambil_data_pegawai_jadwal($tgl,$bln,$thn,$id)
	{
		$tglnya = $thn."-".$bln."-".$tgl;
		$this->db->select('*,kw.kode_warna as bek_warna,kw2.kode_warna as text_warna');
	//	$this->db->join('ol_pegawai_unit pegun', 'pegun.id_pegawai=pj.id_pegawai','left');
		$this->db->join('pegawai_urutan pegur', 'pegur.id_pegawai=pj.id_pegawai','left');
		$this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=pj.barcode_pegawai','left');
		$this->db->join('kol_dinas_jaga kdj', 'kdj.id_dinas_jaga=pj.id_dinas_jaga','left');
		$this->db->join('kol_warna kw', 'kw.id_warna=kdj.id_warna','left');
		$this->db->join('kol_warna kw2', 'kw2.id_warna=kdj.id_text','left');
/*		$this->db->where('YEAR(tgl_jadwal)', $thn);
		$this->db->where('MONTH(tgl_jadwal)', $bln);*/
		$this->db->where('pj.tgl_jadwal',$tglnya);
		$this->db->where('pj.id_pegawai',$id);
		$this->db->order_by("no_urutan", "asc");
		$q = $this->db->get_where('pegawai_jadwal pj',array('pj.id_unit'=>$this->session->unit));
		return $q->row_array();
	}
	function ambil_data_pegawai_opsi($id,$ruangan)
	{
		$this->db->select('pega.nama_pegawai,peg.id_pegawai,pega.no_hp');
		$this->db->join('pegawai_urutan pegu', 'pegu.id_pegawai=peg.id_pegawai','left');
		$this->db->join('ol_pegawai pega', 'pega.id_pegawai=peg.id_pegawai','left');
		if($ruangan == '0'){
		$this->db->where("id_unit", $id);
		}else{
		$this->db->where("id_unit", $ruangan);
		}
		$this->db->order_by("no_urutan", "asc");
		$q = $this->db->get('ol_pegawai_unit peg');
		return $q->result_array();
	}
	function pegawai_dinas($id_unit,$bln,$thn,$id)
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,kw.kode_warna,kw2.kode_warna as text_warna,
					DATE_FORMAT(tgl_jadwal,'%d-%m-%Y') as tgl_jadwal";
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
					// case 'telp' : $nmf="peg.telp";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('YEAR(tgl_jadwal)', $thn);
		$this->db->where('MONTH(tgl_jadwal)', $bln);
		$this->db->where('pegun.id_unit',$id_unit);
		if($id > 0){
			$this->db->where('pj.id_pegawai',$id);
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('pegawai_jadwal pj');
		$this->db->join('ol_pegawai_unit pegun', 'pegun.id_pegawai=pj.id_pegawai','left');
		$this->db->join('pegawai_urutan pegur', 'pegur.id_pegawai=pj.id_pegawai','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=pj.id_pegawai','left');
		$this->db->join('kol_dinas_jaga kdj', 'kdj.id_dinas_jaga=pj.id_dinas_jaga','left');
		$this->db->join('kol_warna kw', 'kw.id_warna=kdj.id_warna','left');
		$this->db->join('kol_warna kw2', 'kw2.id_warna=kdj.id_text','left');
		$this->db->where('YEAR(tgl_jadwal)', $thn);
		$this->db->where('MONTH(tgl_jadwal)', $bln);
		$this->db->where('pegun.id_unit',$id_unit);
		if($id > 0){
			$this->db->where('pj.id_pegawai',$id);
		}

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'telp' : $nmf="peg.telp";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('YEAR(tgl_jadwal)', $thn);
		$this->db->where('MONTH(tgl_jadwal)', $bln);
		$this->db->where('pegun.id_unit',$id_unit);
		if($id > 0){
			$this->db->where('pj.id_pegawai',$id);
		}
			}
		  }
		}

	    $this->db->from('pegawai_jadwal pj');
		$this->db->join('ol_pegawai_unit pegun', 'pegun.id_pegawai=pj.id_pegawai','left');
		$this->db->join('pegawai_urutan pegur', 'pegur.id_pegawai=pj.id_pegawai','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=pj.id_pegawai','left');
		$this->db->join('kol_dinas_jaga kdj', 'kdj.id_dinas_jaga=pj.id_dinas_jaga','left');
		$this->db->join('kol_warna kw', 'kw.id_warna=kdj.id_warna','left');
		$this->db->join('kol_warna kw2', 'kw2.id_warna=kdj.id_text','left');
		$this->db->where('YEAR(tgl_jadwal)', $thn);
		$this->db->where('MONTH(tgl_jadwal)', $bln);
		$this->db->where('pegun.id_unit',$id_unit);
		if($id > 0){
			$this->db->where('pj.id_pegawai',$id);
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$kondisi=array('id_unit'=>$id_unit);
		$jml = $this->m_umum->jumlah_record_filter('pegawai_jadwal',$kondisi);

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function all_pegawai_dinas()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*";
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
					// case 'telp' : $nmf="peg.telp";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('pegun.id_unit',$this->session->unit);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_pegawai_unit pegun');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=pegun.id_pegawai','left');
		$this->db->join('pegawai_urutan peut', 'peut.id_pegawai=peg.id_pegawai','left');
	//	$this->db->join('ol_user ou', 'ou.id_pegawai=peg.id_pegawai','left');
		$this->db->where('pegun.id_unit',$this->session->unit);

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'telp' : $nmf="peg.telp";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('pegun.id_unit',$this->session->unit);
			}
		  }
		}

	    $this->db->from('ol_pegawai_unit pegun');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=pegun.id_pegawai','left');
		$this->db->join('pegawai_urutan peut', 'peut.id_pegawai=peg.id_pegawai','left');
	//	$this->db->join('ol_user ou', 'ou.id_pegawai=peg.id_pegawai','left');
		$this->db->where('pegun.id_unit',$this->session->unit);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$kondisi=array('ol_pegawai_unit.id_unit'=>$this->session->unit);
		$jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_pegawai_unit',$kondisi,'ol_pegawai','id_pegawai');
	//	$jml = $this->m_umum->jumlah_record_filter('ol_pegawai',$kondisi);

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function print_jadwal($tgl,$id)
	{
		$this->db->select('peg.nama_pegawai,peg.no_hp,kdj.nama_dinas_jaga,kw.kode_warna,kw2.kode_warna as text_warna');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=pj.id_pegawai','left');
		$this->db->join('kol_dinas_jaga kdj', 'kdj.id_dinas_jaga=pj.id_dinas_jaga','left');
		$this->db->join('kol_warna kw', 'kw.id_warna=kdj.id_warna','left');
		$this->db->join('kol_warna kw2', 'kw2.id_warna=kdj.id_text','left');
		$this->db->where("pj.id_pegawai", $id);
		$this->db->where("pj.tgl_jadwal", $tgl);
		$q = $this->db->get_where('pegawai_jadwal pj');
		return $q->result_array();
	}
	function lb($data){
/* 		$tglawalindo	= '01-'.$data['bulan'].'-'.$data['tahun'];
		$tglawal	= date('Y-m-d', strtotime($tglawalindo));
		$akhir = date('t', strtotime($tglawal)); */
		$tglawal = date('Y').'-01-01';
		$tglakhir = date('Y').'-12-31';
	//	$tglakhir = $data['tahun'].'-'.$data['bulan'].'-'.$akhir;
		$this->db->select("DATE_FORMAT(tgl_jadwal,'%d-%m-%Y') as tgl_jadwal,DATE_FORMAT(tgl_jadwal,'%m-%Y') as showtgl_jadwal,pj.id_pegawai");
		$this->db->join('kol_dinas_jaga kdj', 'kdj.id_dinas_jaga=pj.id_dinas_jaga','left');
		$this->db->where('DATE(tgl_jadwal) BETWEEN "'. $tglawal . '" and "'. $tglakhir .'"');
		$this->db->where('pj.id_unit',$this->session->unit);
		$this->db->group_by("MONTH(tgl_jadwal)");
		$q = $this->db->get_where('pegawai_jadwal pj')->result_array();
		//echo $this->db->last_query();die();
		return $q;
	}
	function lb2($tgl,$id){
		$this->db->select("pj.id_pegawai,sum(kdj.jml_dinas_jaga) as jml_dinas_jaga");
		$this->db->join('kol_dinas_jaga kdj', 'kdj.id_dinas_jaga=pj.id_dinas_jaga','left');
	//	$this->db->where('pj.id_pegawai',$id);
		$this->db->where('YEAR(tgl_jadwal)', date('Y', strtotime($tgl)));
		$this->db->where('MONTH(tgl_jadwal)', date('m', strtotime($tgl)));
		$this->db->group_by("pj.id_pegawai");
		$q = $this->db->get_where('pegawai_jadwal pj')->result_array();
		//echo $this->db->last_query();die();
		return $q;
	}
	function cmd_dinas_jaga($id)
	{
		$this->db->select("id_dinas_jaga,nama_dinas_jaga");
		$this->db->where('id_unit','0');
		$this->db->or_where('id_unit',$id);
		$this->db->order_by("nama_dinas_jaga", "asc");
		$q= $this->db->get('kol_dinas_jaga')->result_array();
		$hasil= array_column($q,'nama_dinas_jaga','id_dinas_jaga');
		return $hasil;
    }
	function simpan_jadwal_dinas(){
		$id_dinas_jaga = $this->input->post('id_dinas_jaga');
		$id_unit = $this->session->unit;
		$bln = $this->input->post('bulan');
		$thn = $this->input->post('tahun');
		$id_pegawai = $this->input->post('id_pegawai');
		$chk = $this->input->post('chk[]');
		if($chk && $id_dinas_jaga){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				$tglnya = $thn.'-'.$bln.'-'.$chk[$i];
				$this->db->select("COUNT(*) as num");
				$this->db->where('tgl_jadwal',$tglnya);
				$this->db->where('id_pegawai',$id_pegawai);
				$this->db->where('id_unit',$id_unit);
				$q = $this->db->get('pegawai_jadwal')->row();
				$jml = $q->num;
				if($jml == 0){
					$this->simpan_jd($id_unit,$id_dinas_jaga,$id_pegawai,$tglnya);
				}else{
					$kondisi_jag = array('barcode_pegawai'=>$this->session->barcode_pegawai,'tgl_jadwal'=>$tglnya,'id_unit'=>$id_unit,'id_pegawai'=>$id_pegawai);
					$jagjag = $this->m_umum->jumlah_record_filter('pegawai_jadwal',$kondisi_jag);
					if($jagjag > 0){
						$this->edit_jd($id_unit,$id_dinas_jaga,$id_pegawai,$tglnya);
					}
				}
			}
		}
	}
	function simpan_jd($id_unit,$id_dinas_jaga,$id_pegawai,$tglnya){
		$kode = $this->m_rancak->kode_generator_urut(15,'PJ');
		$data_pendaftaran = array(
			'id_jadwal' => $kode,
			'id_unit' => $this->session->unit,
			'id_dinas_jaga' => $id_dinas_jaga,
			'id_pegawai' => $id_pegawai,
			'barcode_pegawai' => $this->session->barcode_pegawai,
			'tgl_jadwal' => $tglnya
		);
		$this->db->insert('pegawai_jadwal', $data_pendaftaran);
	}
	function edit_jd($id_unit,$id_dinas_jaga,$id_pegawai,$tglnya){
		$data_pendaftaran = array(
			'id_dinas_jaga' => $id_dinas_jaga
		);
		$this->db->where('id_unit',$id_unit);
		$this->db->where('id_pegawai',$id_pegawai);
		$this->db->where('tgl_jadwal',$tglnya);
		$this->db->update('pegawai_jadwal', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function edit_jadwal_dinas(){
		$id_jadwal = $this->input->post('id_jadwal');
		$data_pendaftaran = array(
			'id_dinas_jaga' => $this->input->post('id_dinas_jaga')
		);
		$this->db->where('id_jadwal',$id_jadwal);
		$this->db->update('pegawai_jadwal', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function simpan_hari_libur(){
		$id_unit = $this->input->post('id_unit');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$chk = $this->input->post('chk[]');
		if($chk){
		$eimplo = implode(",",$chk);
		$kode = $this->m_rancak->kode_generator(15,'HL');
		$data_pendaftaran = array(
			'id_hari_libur' => $kode,
			'id_unit' => $id_unit,
			'bulan' => $bulan,
			'tahun' => $tahun,
			'tgl_hari_libur' => $eimplo
		);
		$this->db->insert('hari_libur', $data_pendaftaran);
		}
	}
	function edit_hari_libur(){
		$id_hari_libur = $this->input->post('id_hari_libur');
		$chk = $this->input->post('chk[]');
		if($chk){
		$eimplo = implode(",",$chk);
			$data_pendaftaran = array(
				'tgl_hari_libur' => $eimplo
			);
			$this->db->where('id_hari_libur',$id_hari_libur);
			$this->db->update('hari_libur', $data_pendaftaran);
			//echo $this->db->last_query();
			$this->db->trans_complete();	// untuk cek sukses update tidak
			if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
			// if (!$this->db->affected_rows())
				return(FALSE);
			else
				return(TRUE);
		}

	}
/*	function simpan_chat(){
		$isi_chat = $this->input->post('isi_chat');
		if($isi_chat){
			$kode = $this->m_rancak->kode_generator_urut(15,'CH');
			$data_kewenangan = array(
				'id_pegawai' => $this->session->id_pegawai,
				'id_chat' => $kode,
				'isi_chat' => $isi_chat,
				'id_unit' => $this->session->unit
			);
			return $this->db->insert('chat', $data_kewenangan);
		}
	}*/
	function simpan_tindakan(){
		$kode = $this->m_rancak->kode_generator_urut(15,'TN');
		$data_pendaftaran = array(
			'id_tindakan' => $kode,
			'pembuat_tindakan' => $this->session->id_pegawai,
			'nama_tindakan' => $this->input->post('nama_tindakan'),
			'id_golongan_pemeriksaan' => $this->input->post('id_golongan_pemeriksaan'),
			'status_tindakan' => $this->input->post('status_tindakan')
		);
		$this->db->insert('tindakan', $data_pendaftaran);
		return $kode;
	}
	function cek_tarif($id){
		$tarif = $this->input->post('tarif');
		$tarif	= str_replace("'","&acute;",$tarif);
		$tarif	= str_replace(".","",$tarif);
		$tarif	= str_replace(" ","",$tarif);
		$tarif	= str_replace(",","",$tarif);
		$kondisi = array('id_tindakan'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('tindakan_tarif',$kondisi);
		if($jml == 0){
			$this->simpan_tt($id,$tarif);
		}else{
			$this->edit_tt($id,$tarif);
		}
	}
	function simpan_tt($id,$tarif){
		$kode = $this->m_rancak->kode_generator_urut(15,'TT');
		$data_pendaftaran = array(
			'tarif' => $tarif,
			'id_tindakan' => $id,
			'id_tarif' => $kode			);
		$this->db->insert('tindakan_tarif', $data_pendaftaran);	
	}
	function edit_tt($id,$tarif){
			$data_pendaftaran = array(
				'tarif' => $tarif
			);
			$this->db->where('id_tindakan',$id);
			$this->db->update('tindakan_tarif', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}
	function edit_tindakan(){
		$id_tindakan = $this->input->post('id_tindakan');
		$data_pendaftaran = array(
			'nama_tindakan' => $this->input->post('nama_tindakan'),
			'id_golongan_pemeriksaan' => $this->input->post('id_golongan_pemeriksaan'),
			'status_tindakan' => $this->input->post('status_tindakan')
		);
		$this->db->where('id_tindakan',$id_tindakan);
		$this->db->update('tindakan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}
	function pasien_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,if(jk = 1,'Laki-laki','Perempuan') as jk,
			CONCAT((TIMESTAMPDIFF( YEAR, op.tgl_lahir, now() )), ' Tahun ',
			TIMESTAMPDIFF( MONTH, op.tgl_lahir, now() ) % 12, ' Bulan ',
			FLOOR( TIMESTAMPDIFF( DAY, op.tgl_lahir, now() ) % 30.4375 ), ' Hari') as umur";
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
					// case 'telp' : $nmf="peg.telp";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('op.pasien_instansi',$this->session->refer);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_pasien op');
		$this->db->join('kol_working kw', 'kw.id_working=op.pasien_instansi','left');
		$this->db->where('op.pasien_instansi',$this->session->refer);

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'telp' : $nmf="peg.telp";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('op.pasien_instansi',$this->session->refer);
			}
		  }
		}

	    $this->db->from('ol_pasien op');
		$this->db->join('kol_working kw', 'kw.id_working=op.pasien_instansi','left');
		$this->db->where('op.pasien_instansi',$this->session->refer);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$kondisi=array('pasien_instansi'=>$this->session->refer);
		$jml = $this->m_umum->jumlah_record_filter('ol_pasien',$kondisi);

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function chat_all($first_date,$last_date)
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,concat('<h3><u><strong>Tanggal Laporan : </u></h3></strong>',DATE_FORMAT(wkt_chat,'%d-%m-%Y %H:%i:%s'),'<br><h3><u><strong>Nama Pelapor : </u></h3></strong>',nama_pegawai,'<br>',isi_chat) as isi_chat";
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
					// case 'telp' : $nmf="peg.telp";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('c.id_unit',$this->session->unit);
$this->db->where('DATE(c.wkt_chat) BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('chat c');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=c.id_pegawai','left');
		$this->db->where('c.id_unit',$this->session->unit);
$this->db->where('DATE(c.wkt_chat) BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'telp' : $nmf="peg.telp";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('c.id_unit',$this->session->unit);
$this->db->where('DATE(c.wkt_chat) BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
			}
		  }
		}

	    $this->db->from('chat c');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=c.id_pegawai','left');
		$this->db->where('c.id_unit',$this->session->unit);
$this->db->where('DATE(c.wkt_chat) BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
/*		if(empty($bln)){
			$this->db->limit(150);			
		}else{
			$this->db->where('YEAR(wkt_chat)', $thn);
			$this->db->where('MONTH(wkt_chat)', $bln);			
		}*/


		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$kondisi=array('id_unit'=>$this->session->unit);
		$jml = $this->m_umum->jumlah_record_filter('chat',$kondisi);

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_chat(){
		$isi_chat = $this->input->post('isi_chat');
		if($isi_chat){
			$kode = $this->m_rancak->kode_generator_urut(15,'CH');
			$data_kewenangan = array(
				'id_pegawai' => $this->session->id_pegawai,
				'id_chat' => $kode,
				'isi_chat' => $isi_chat,
				'id_unit' => $this->session->unit
			);
			return $this->db->insert('chat', $data_kewenangan);
		}
	}
	function edit_chat(){
		$id_chat = $this->input->post('id_chat');	
		$data_pendaftaran = array(
			'isi_chat' => $this->input->post('isi_chat')
		);
		$this->db->where('id_chat',$id_chat);
		$this->db->update('chat', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function ambil_data_daftar_range($fd,$ld,$id,$kondisi,$grup=FALSE){
		// $date = d-m-Y / 01-01-1970
$first_date = date('Y-m-d', strtotime($fd .' -1 day'));
$last_date = date('Y-m-d', strtotime($ld .' +5 day'));
		$this->db->select("*,DATE_FORMAT(tgl_daftar,'%d-%m-%Y') as tgl,
			if(jk = 1,'Laki-laki','Perempuan') as jk,
			CONCAT((TIMESTAMPDIFF( YEAR, ops.tgl_lahir, tgl_daftar )), ' Tahun ',
			TIMESTAMPDIFF( MONTH, ops.tgl_lahir, tgl_daftar ) % 12, ' Bulan ',
			FLOOR( TIMESTAMPDIFF( DAY, ops.tgl_lahir, tgl_daftar ) % 30.4375 ), ' Hari') as umur");
		$this->db->join('ol_pasien ops', 'ops.id_pasien=td.id_pasien','left');
		$this->db->join('tindakan t', 't.id_tindakan=td.id_tindakan','left');
		$this->db->join('kol_golongan_pemeriksaan kgp', 'kgp.id_golongan_pemeriksaan=t.id_golongan_pemeriksaan','left');
		$this->db->join('ol_unit upengirim', 'upengirim.id_unit=td.unit_pengirim','left');
		$this->db->where('tgl_daftar BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
/*		$this->db->where('tgl_daftar BETWEEN DATE_SUB(NOW(), INTERVAL 15 DAY) AND NOW()');
		$this->db->where('tgl_daftar BETWEEN DATE_SUB("'. date('Y-m-d', strtotime($first_date)). '", INTERVAL 15 DAY) AND "'. date('Y-m-d', strtotime($first_date)). '"');
		$this->db->where('nh_bookings.booking_req_by_date_time >=', date('Y-m-d H:i:s', strtotime($start_date." 00:00:00")));
		$this->db->where('nh_bookings.booking_req_by_date_time <=', date('Y-m-d H:i:s', strtotime($end_date." 23:59:59")));
		$this->db->where("nh_bookings.booking_req_by_date_time BETWEEN ".date('Y-m-d H:i:s', strtotime($start_date." 00:00:00"))." AND ". date('Y-m-d H:i:s', strtotime($end_date." 23:59:59")));*/
		if($id){
			$this->db->where('t.id_golongan_pemeriksaan',$id);
		}
	  if($grup){
	  	$this->db->group_by($grup);
	  }
	  	$this->db->order_by('tgl_daftar','ASC');
	  $q = $this->db->get_where('tindakan_daftar td',$kondisi);
	  return $q->result_array();
	}
	function rubah_ol_lpasien(){
		$id_logbook = $this->input->post('id_logbook');
		$jml_logbook = $this->input->post('jml_logbook');
		$rm = $this->input->post('rm');
		$kondisi=array('rm'=>$rm);
		$jml = $this->m_umum->jumlah_record_filter('ol_pasien',$kondisi);
		if($jml == 0){
			$psx = $this->simpan_ol_pasien();
		}else{
			$this->rubah_ol_pasien();
			$pasiyen = $this->m_umum->ambil_data('ol_pasien','rm',$rm);
			$psx = $pasiyen['id_pasien'];
		}
		$this->edit_tindakan_daftar($psx);
	}
	function simpan_ol_pasien(){
		$kode = $this->m_rancak->kode_generator(15,'PS');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$tgl_lahir = date('Y-m-d', strtotime($tgl_lahir));
		$data_pendaftaran = array(
			'pasien_instansi' => $this->session->refer,
			'id_pasien' => $kode,
			'rm'  => $this->input->post('rm'),
			'nama_pasien'  => $this->input->post('nama_pasien'),
			'alamat'  => $this->input->post('alamat'),
			'tgl_lahir'  => $tgl_lahir,
			'jk'  => $this->input->post('jk')
		);
		$this->db->insert('ol_pasien', $data_pendaftaran);
		return $kode;
	}
	function simpan_ol_lpasien(){
		$rm = $this->input->post('rm');
		$kondisi=array('rm'=>$rm);
		$jml = $this->m_umum->jumlah_record_filter('ol_pasien',$kondisi);
		if($jml == 0){
			$psx = $this->simpan_ol_pasien();
		}else{
			$this->rubah_ol_pasien();
			$pasiyen = $this->m_umum->ambil_data('ol_pasien','rm',$rm);
			$psx = $pasiyen['id_pasien'];
		}
		$this->simpan_tindakan_daftar($psx);
	}
	function rubah_ol_pasien(){
		$id_pasien = $this->input->post('id_pasien');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$tgl_lahir = date('Y-m-d', strtotime($tgl_lahir));
		$data_pendaftaran = array(
			'rm'  => $this->input->post('rm'),
			'nama_pasien'  => $this->input->post('nama_pasien'),
			'alamat'  => $this->input->post('alamat'),
			'tgl_lahir'  => $tgl_lahir,
			'jk'  => $this->input->post('jk')
		);
		$this->db->where('id_pasien',$id_pasien);
		$this->db->update('ol_pasien', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function pengambilan_all($first_date,$last_date,$key)
	{
		$wordsAry = explode("-", $key);
		$wordsCount = count($wordsAry);
		$fields = "if (jk = '1' ,'Laki-laki','Perempuan') as jk,
CONCAT((TIMESTAMPDIFF( YEAR, tgl_lahir, tgl_ambil )), ' Tahun ', 
TIMESTAMPDIFF( MONTH, tgl_lahir, tgl_ambil ) % 12, ' Bulan ',
FLOOR( TIMESTAMPDIFF( DAY, tgl_lahir, tgl_ambil ) % 30.4375 ), ' Hari') as umur,
ou.nama_unit as unit_pengirim,nama_pengambil,
if(status_ambil = 1,'Pengambilan Hasil',if(status_ambil,'Pinjam Basah','Lain-lain')) as status_ambil,
ou2.nama_unit as unit_tindakan,rm,alamat,id_ambil,
krj.nama_rujukan_dokter as dr_tindakan,
krj2.nama_rujukan_dokter as dr_pengirim,
concat('[RM : ',rm,'] - Nama : ',nama_pasien) as nama_pasien,
DATE_FORMAT(tgl_ambil,'%d-%m-%Y') as tgl_ambil,
id_tindakan as nama_tindakan,
DATE_FORMAT(wkt_ambil,'%d-%m-%Y %H:%i:%s') as wkt_ambil
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
					// case 'telp' : $nmf="peg.telp";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('td.unit_tindakan',$this->session->unit);
		$this->db->where('tgl_daftar BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		if(!empty($key) || $this->input->post('key',true)){
			$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(nama_pasien LIKE '%".$wordsAry[$i]."%' OR rm LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('tindakan_ambil td');
		$this->db->join('ol_unit ou', 'ou.id_unit=td.unit_pengirim','left');
		$this->db->join('ol_unit ou2', 'ou2.id_unit=td.unit_tindakan','left');
		$this->db->join('kol_rujukan_dokter krj', 'krj.id_rujukan_dokter=td.dr_tindakan','left');
		$this->db->join('kol_rujukan_dokter krj2', 'krj2.id_rujukan_dokter=td.dr_pengirim','left');
		$this->db->where('td.unit_tindakan',$this->session->unit);
		$this->db->where('tgl_ambil BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		if(!empty($key) || $this->input->post('key',true)){
			$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(nama_pasien LIKE '%".$wordsAry[$i]."%' OR rm LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
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
				//	case 'telp' : $nmf="peg.telp";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('td.unit_tindakan',$this->session->unit);
		$this->db->where('tgl_daftar BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		if(!empty($key) || $this->input->post('key',true)){
			$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(nama_pasien LIKE '%".$wordsAry[$i]."%' OR rm LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
			}
		  }
		}

	    $this->db->from('tindakan_ambil td');
		$this->db->join('ol_unit ou', 'ou.id_unit=td.unit_pengirim','left');
		$this->db->join('ol_unit ou2', 'ou2.id_unit=td.unit_tindakan','left');
		$this->db->join('kol_rujukan_dokter krj', 'krj.id_rujukan_dokter=td.dr_tindakan','left');
		$this->db->join('kol_rujukan_dokter krj2', 'krj2.id_rujukan_dokter=td.dr_pengirim','left');
		$this->db->where('td.unit_tindakan',$this->session->unit);
		$this->db->where('tgl_ambil BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		if(!empty($key) || $this->input->post('key',true)){
			$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(nama_pasien LIKE '%".$wordsAry[$i]."%' OR rm LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$kondisi=array('unit_tindakan'=>$this->session->unit);
		$jml = $this->m_umum->jumlah_record_filter('tindakan_ambil',$kondisi);

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function rubah_pengambilan(){
		$id_ambil = $this->input->post('id_ambil');
		$rm = $this->input->post('rm');
		$tgl_ambil = $this->input->post('tgl_ambil');
		$tgl_ambil = date('Y-m-d', strtotime($tgl_ambil));
		$tgl_lahir = $this->input->post('tgl_lahir');
		$tgl_lahir = date('Y-m-d', strtotime($tgl_lahir));
		$kondisi = array('rm'=>$rm);
		$jml = $this->m_umum->jumlah_record_filter('ol_pasien',$kondisi);
		if($jml == 0){
			$this->simpan_ol_pasien2();
		}else{
			$this->rubah_ol_pasien2();
		}
		$data_pendaftaran = array(
			'tgl_lahir' => $tgl_lahir,
			'tgl_ambil' => $tgl_ambil,
			'nama_pasien' => $this->input->post('nama_pasien'),
			'rm' => $rm,
			'jk' => $this->input->post('jk'),
			'nama_pengambil' => $this->input->post('nama_pengambil'),
			'id_tindakan' => $this->input->post('id_tindakan'),
			'alamat'  => $this->input->post('alamat'),
			'status_ambil' => $this->input->post('status_ambil'),
			'unit_pengirim' => $this->input->post('unit_pengirim'),
			'dr_tindakan' => $this->input->post('dr_tindakan'),
			'dr_pengirim' => $this->input->post('dr_pengirim'),
		);
		$this->db->where('id_ambil',$id_ambil);
		$this->db->update('tindakan_ambil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function simpan_pengambilan(){
		$kode = $this->m_rancak->kode_generator_urut(15,'AB');
		$rm = $this->input->post('rm');
		$px = $this->m_umum->ambil_data('ol_pasien','rm',$rm);
		$kondisi = array('rm'=>$rm);
		$jml = $this->m_umum->jumlah_record_filter('ol_pasien',$kondisi);
		if($jml == 0){
			$this->simpan_ol_pasien2();
		}else{
			$this->rubah_ol_pasien2();
		}
		if(empty($px)){
			$px = "";
		}else{
			$px = $px['id_pasien'];
		}
		$tgl_ambil = $this->input->post('tgl_ambil');
		$tgl_ambil = date('Y-m-d', strtotime($tgl_ambil));
		$tgl_lahir = $this->input->post('tgl_lahir');
		$tgl_lahir = date('Y-m-d', strtotime($tgl_lahir));
		$data_pengambilan = array(
			'nama_pengambil'  => $this->input->post('nama_pengambil'),
			'unit_pengirim'   => $this->input->post('unit_pengirim'),
			'id_tindakan'     => $this->input->post('id_tindakan'),
			'dr_tindakan'     => $this->input->post('dr_tindakan'),
			'dr_pengirim'     => $this->input->post('dr_pengirim')
		);	
		$this->session->set_userdata($data_pengambilan);
		$data_kewenangan = array(
			'id_ambil' => $kode,
			'id_pasien' => $px,
			'tgl_lahir' => $tgl_lahir,
			'tgl_ambil' => $tgl_ambil,
			'nama_pasien' => $this->input->post('nama_pasien'),
			'rm' => $rm,
			'jk' => $this->input->post('jk'),
			'nama_pengambil' => $this->input->post('nama_pengambil'),
			'id_tindakan' => $this->input->post('id_tindakan'),
			'alamat'  => $this->input->post('alamat'),
			'status_ambil' => $this->input->post('status_ambil'),
			'unit_pengirim' => $this->input->post('unit_pengirim'),
			'dr_tindakan' => $this->input->post('dr_tindakan'),
			'dr_pengirim' => $this->input->post('dr_pengirim'),
			'statuser' => $this->session->id_pegawai,
			'unit_tindakan' => $this->session->unit
		);
		return $this->db->insert('tindakan_ambil', $data_kewenangan);
	}
	function simpan_ol_pasien2(){
		$kode = $this->m_rancak->kode_generator(15,'PS');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$tgl_lahir = date('Y-m-d', strtotime($tgl_lahir));
		$data_pendaftaran = array(
			'pasien_instansi' => $this->session->refer,
			'id_pasien' => $kode,
			'rm'  => $this->input->post('rm'),
			'nama_pasien'  => $this->input->post('nama_pasien'),
			'tgl_lahir'  => $tgl_lahir,
			'jk'  => $this->input->post('jk'),
			'alamat'  => $this->input->post('alamat')
		);
		$this->db->insert('ol_pasien', $data_pendaftaran);
		return $kode;
	}
	function rubah_ol_pasien2(){
		$rm = $this->input->post('rm');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$tgl_lahir = date('Y-m-d', strtotime($tgl_lahir));
		$data_pendaftaran = array(
			'nama_pasien'  => $this->input->post('nama_pasien'),
			'tgl_lahir'  => $tgl_lahir,
			'jk'  => $this->input->post('jk'),
			'alamat'  => $this->input->post('alamat')
		);
		$this->db->where('rm',$rm);
		$this->db->update('ol_pasien', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function daftar_all($first_date,$last_date,$id)
	{
/*		$first_date = '01-'.$bln.'-'.$thn;
		$akhir = date('t', strtotime($first_date));
		$last_date = $akhir.'-'.$bln.'-'.$thn;*/
		$fields = "if (px.jk = '1' ,'Laki-laki','Perempuan') as jk,
CONCAT((TIMESTAMPDIFF( YEAR, px.tgl_lahir, tgl_daftar )), ' Tahun ', 
TIMESTAMPDIFF( MONTH, px.tgl_lahir, tgl_daftar ) % 12, ' Bulan ',
FLOOR( TIMESTAMPDIFF( DAY, px.tgl_lahir, tgl_daftar ) % 30.4375 ), ' Hari') as umur,
ou.nama_unit as unit_pengirim,
ou2.nama_unit as unit_tindakan,
krj.nama_rujukan_dokter as dr_tindakan,
krj2.nama_rujukan_dokter as dr_pengirim,
concat('[RM : ',rm,'] - Nama : ',nama_pasien) as nama_pasien,
hasil,DATE_FORMAT(tgl_daftar,'%d-%m-%Y') as tgl_daftar,
concat(t.nama_tindakan,' - [',nama_golongan_pemeriksaan,']') as nama_tindakan,
td.id_daftar,td.status_daftar,td.pasien_daftar,
DATE_FORMAT(wkt_daftar,'%d-%m-%Y %H:%i:%s') as wkt_daftar,DATE_FORMAT(wkt_status,'%d-%m-%Y %H:%i:%s') as wkt_status
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
					// case 'telp' : $nmf="peg.telp";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('td.unit_tindakan',$this->session->unit);
		$this->db->where('tgl_daftar BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		if($id){
			$this->db->where('t.id_golongan_pemeriksaan',$id);
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('tindakan_daftar td');
		$this->db->join('tindakan t', 't.id_tindakan=td.id_tindakan','left');
		$this->db->join('kol_golongan_pemeriksaan kgp', 'kgp.id_golongan_pemeriksaan=t.id_golongan_pemeriksaan','left');
		$this->db->join('ol_unit ou', 'ou.id_unit=td.unit_pengirim','left');
		$this->db->join('ol_unit ou2', 'ou2.id_unit=td.unit_tindakan','left');
		$this->db->join('kol_rujukan_dokter krj', 'krj.id_rujukan_dokter=td.dr_tindakan','left');
		$this->db->join('kol_rujukan_dokter krj2', 'krj2.id_rujukan_dokter=td.dr_pengirim','left');
		$this->db->join('ol_pasien px', 'px.id_pasien=td.id_pasien','left');
		$this->db->where('td.unit_tindakan',$this->session->unit);
		$this->db->where('tgl_daftar BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		if($id){
			$this->db->where('t.id_golongan_pemeriksaan',$id);
		}

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'telp' : $nmf="peg.telp";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('td.unit_tindakan',$this->session->unit);
		$this->db->where('tgl_daftar BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		if($id){
			$this->db->where('t.id_golongan_pemeriksaan',$id);
		}
			}
		  }
		}

	    $this->db->from('tindakan_daftar td');
		$this->db->join('tindakan t', 't.id_tindakan=td.id_tindakan','left');
		$this->db->join('kol_golongan_pemeriksaan kgp', 'kgp.id_golongan_pemeriksaan=t.id_golongan_pemeriksaan','left');
		$this->db->join('ol_unit ou', 'ou.id_unit=td.unit_pengirim','left');
		$this->db->join('ol_unit ou2', 'ou2.id_unit=td.unit_tindakan','left');
		$this->db->join('kol_rujukan_dokter krj', 'krj.id_rujukan_dokter=td.dr_tindakan','left');
		$this->db->join('kol_rujukan_dokter krj2', 'krj2.id_rujukan_dokter=td.dr_pengirim','left');
		$this->db->join('ol_pasien px', 'px.id_pasien=td.id_pasien','left');
		$this->db->where('td.unit_tindakan',$this->session->unit);
		$this->db->where('tgl_daftar BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		if($id){
			$this->db->where('t.id_golongan_pemeriksaan',$id);
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$kondisi=array('unit_tindakan'=>$this->session->unit);
		$jml = $this->m_umum->jumlah_record_filter('tindakan_daftar',$kondisi);

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_tindakan_daftar($id){
		$kode = $this->m_rancak->kode_generator_urut(15,'TD');
		$tgl_daftar = $this->input->post('tgl_daftar');
		$tgl_daftar = date('Y-m-d', strtotime($tgl_daftar));
		if($tgl_daftar < date('Y-m-d')){ $status_daftar = 1; }else{ $status_daftar = 0; }
		$data_kewenangan = array(
			'id_daftar' => $kode,
			'id_pasien' => $id,
			'tgl_daftar' => $tgl_daftar,
			'status_daftar' => $status_daftar,
			'id_tindakan' => $this->input->post('id_tindakan'),
			'pasien_daftar' => $this->input->post('pasien_daftar'),
			'unit_pengirim' => $this->input->post('unit_pengirim'),
			'dr_tindakan' => $this->input->post('dr_tindakan'),
			'dr_pengirim' => $this->input->post('dr_pengirim'),
			'pendaftar' => $this->session->id_pegawai,
			'unit_tindakan' => $this->session->unit
		);
		return $this->db->insert('tindakan_daftar', $data_kewenangan);
	}
	function edit_tindakan_daftar($id){
		$id_daftar = $this->input->post('id_daftar');	
		$tgl_daftar = $this->input->post('tgl_daftar');
		$tgl_daftar = date('Y-m-d', strtotime($tgl_daftar));	
		$data_pendaftaran = array(
				'id_pasien' => $id,
				'tgl_daftar' => $tgl_daftar,
				'id_tindakan' => $this->input->post('id_tindakan'),
				'pasien_daftar' => $this->input->post('pasien_daftar'),
				'unit_pengirim' => $this->input->post('unit_pengirim'),
				'dr_tindakan' => $this->input->post('dr_tindakan'),
				'dr_pengirim' => $this->input->post('dr_pengirim')
		);
		$this->db->where('id_daftar',$id_daftar);
		$this->db->update('tindakan_daftar', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function edit_hasil(){
		$id_daftar = $this->input->post('id_daftar');		
		$data_pendaftaran = array(
				'wkt_status' => date('Y-m-d H:i:s'),
				'status_daftar' => $this->input->post('status_daftar')
		);
		$this->db->where('id_daftar',$id_daftar);
		$this->db->update('tindakan_daftar', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	// ini pagination
	public function paginater(){
		$this->load->library('pagination'); // Load librari paginationnya

		$query = "SELECT * FROM chat LEFT JOIN ol_pegawai ON ol_pegawai.id_pegawai=chat.id_pegawai";

		$config['base_url'] = base_url('jadwal_all/chat');
		$config['total_rows'] = $this->db->query($query)->num_rows();
		$config['per_page'] = 5;
		$config['uri_segment'] = 3;
		$config['num_links'] = 3;

		// Style Pagination
		// Agar bisa mengganti stylenya sesuai class2 yg ada di bootstrap
		$config['full_tag_open']   = '<ul class="pagination pagination-sm m-t-xs m-b-xs">';
        $config['full_tag_close']  = '</ul>';

        $config['first_link']      = 'First';
        $config['first_tag_open']  = '<li>';
        $config['first_tag_close'] = '</li>';

        $config['last_link']       = 'Last';
        $config['last_tag_open']   = '<li>';
        $config['last_tag_close']  = '</li>';

        $config['next_link']       = '&nbsp;<i class="glyphicon glyphicon-menu-right"></i>&nbsp;';
        $config['next_tag_open']   = '<li>';
        $config['next_tag_close']  = '</li>';

        $config['prev_link']       = '&nbsp;<i class="glyphicon glyphicon-menu-left"></i>&nbsp;';
        $config['prev_tag_open']   = '<li>';
        $config['prev_tag_close']  = '</li>';

        $config['cur_tag_open']    = '<li class="active"><a href="#">';
        $config['cur_tag_close']   = '</a></li>';

        $config['num_tag_open']    = '<li>';
        $config['num_tag_close']   = '</li>';
        // End style pagination

		$this->pagination->initialize($config); // Set konfigurasi paginationnya

		$page = ($this->uri->segment($config['uri_segment'])) ? $this->uri->segment($config['uri_segment']) : 0;
		$query .= " LIMIT ".$page.", ".$config['per_page'];

		$data['limit'] = $config['per_page'];
		$data['total_rows'] = $config['total_rows'];
		$data['pagination'] = $this->pagination->create_links(); // Generate link pagination nya sesuai config diatas
		$data['pegawai'] = $this->db->query($query)->result();

		return $data;
	}
}
