<?php
class M_ol_korespodensi extends CI_model{
	function surat_pengajuan_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,if(wkt_korespodensi = '' ,'Belum Ada Tanggal',DATE_FORMAT(wkt_korespodensi,'%d-%m-%Y')) as wkt_korespodensi,
			ok.id_korespodensi
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
					 case 'id_korespodensi' : $nmf="ok.id_korespodensi";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->where("id_pengirim", $this->session->id_pegawai);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_korespodensi ok');
		$this->db->join('ol_kor_kategori okk', 'okk.id_korespodensi=ok.id_korespodensi','left');
		$this->db->join('ol_surat_kategori', 'ol_surat_kategori.id_kategori=okk.id_kategori','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=okk.pengcab_asal','left');
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ok.id_pengirim','left');
		$this->db->where("id_pengirim", $this->session->id_pegawai);
		$this->db->order_by('id_kor_kategori', 'asc');


		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				case 'id_korespodensi' : $nmf="ok.id_korespodensi";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where("id_pengirim", $this->session->id_pegawai);
			}
		  }
		}

		$this->db->from('ol_korespodensi ok');
		$this->db->join('ol_kor_kategori okk', 'okk.id_korespodensi=ok.id_korespodensi','left');
		$this->db->join('ol_surat_kategori', 'ol_surat_kategori.id_kategori=okk.id_kategori','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=okk.pengcab_asal','left');
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ok.id_pengirim','left');
		$this->db->where("id_pengirim", $this->session->id_pegawai);
		$this->db->order_by('id_kor_kategori', 'asc');


		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/*		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){*/
		 		$kondisi=array('id_pengirim'=>$this->session->id_pegawai);
				$jml = $this->m_umum->jumlah_record_filter('ol_korespodensi',$kondisi);
/*			}else{
				$jml = $this->m_umum->jumlah_record_tabel('ol_surat');
			}
		}else{
			$jml = $this->m_umum->jumlah_record_tabel('ol_surat');
		}*/		

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_korespondensi(){
		$kode = $this->m_rancak->kode_generator(15,'SR');
		$data_pendaftaran = array(
			'barcode_korespodensi' => $kode,
			'id_pengirim' => $this->session->id_pegawai,
			'id_jabatan' => $this->session->id_jabatan,
			'id_instansi' => $this->input->post('id_instansi')
		);
		$this->db->insert('ol_korespodensi', $data_pendaftaran);
		return $this->db->insert_id();
	}
	function simpan_kor_kategori($id){
		$kode = $this->m_rancak->kode_generator(15,'KK');
		$data_pendaftaran = array(
			'barcode_kor_kategori' => $kode,
			'id_korespodensi' => $id,
			'id_kategori' => $this->input->post('id_kategori'),
			'pengcab_asal' => $this->input->post('pengcab_asal'),
			'pengcab_tujuan' => $this->input->post('pengcab_tujuan')
		);
		return $this->db->insert('ol_kor_kategori', $data_pendaftaran);
	}
	function edit_pengajuan(){
		$id_korespodensi = $this->input->post('id_korespodensi');
		$id_4_berkas = $this->input->post('id_4_berkas');
		$id_4_ijasah = $this->input->post('id_4_ijasah');
		$id_4_str = $this->input->post('id_4_str');
		$id_4_sertifikat = $this->input->post('id_4_sertifikat');
	//	$pengcab_tujuan  = empty($pengcab_tujuan) ? NULL : $pengcab_tujuan;
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
			$data_pendaftaran = array(
				'id_berkas' => $id_berkas,
				'id_str' => $id_str,
				'id_sertifikat' => $id_sertifikat,
				'id_ijasah' => $id_ijasah
			);
		$this->db->where('id_korespodensi',$id_korespodensi);
		$this->db->update('ol_korespodensi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function kirim($id){
			$data_pendaftaran = array(
				'status_korespodensi' => 1
			);			
		$this->db->where('id_korespodensi',$id);
		$this->db->update('ol_korespodensi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function ijasah_all()
	{
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,
					if (b.tgl_b_berkas = '0000-00-00' ,'TIDAK ADA',if (b.tgl_b_berkas = NULL ,'TIDAK ADA',DATE_FORMAT(b.tgl_b_berkas,'%d-%m-%Y'))) as tgl_b_berkas
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
				//	case 'no_hp' : $nmf="peg.no_hp";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where("b.id_kategori_berkas", 7);
		$this->db->where("b.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('ol_berkas b');
		$this->db->join('kol_pendidikan kp', 'kp.id_pendidikan=b.id_pendidikan','left');
		$this->db->where("b.id_kategori_berkas", 7);
		$this->db->where("b.id_pegawai", $this->session->id_pegawai);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
 		$kondisi=array('kol_kategori_berkas.id_kategori_berkas'=>7, 'ol_berkas.id_pegawai'=>$this->session->id_pegawai);
		$jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_berkas',$kondisi,'kol_kategori_berkas','id_kategori_berkas');	

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

		$this->db->where('barcode_korespodensi',$id_pengajuan);
		$this->db->update('ol_korespodensi', $data_count);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function pelatihan_all()
	{
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,
					if (b.tgl_a_berkas = '0000-00-00' ,'TIDAK ADA',if (b.tgl_a_berkas = NULL ,'TIDAK ADA',DATE_FORMAT(b.tgl_a_berkas,'%d-%m-%Y'))) as tgl_a_berkas,
					if (b.tgl_b_berkas = '0000-00-00' ,'TIDAK ADA',if (b.tgl_b_berkas = NULL ,'TIDAK ADA',DATE_FORMAT(b.tgl_b_berkas,'%d-%m-%Y'))) as tgl_b_berkas
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
		$this->db->where("kunci", 1);
		$this->db->where("b.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_berkas b');
		$this->db->join('kol_kategori_berkas kb', 'kb.id_kategori_berkas=b.id_kategori_berkas','left');
		$this->db->join('kol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=b.id_kategori_pelatihan','left');
		$this->db->where("kunci", 1);
		$this->db->where("b.id_pegawai", $this->session->id_pegawai);

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
		$this->db->where("kunci", 1);
		$this->db->where("b.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('ol_berkas b');
		$this->db->join('kol_kategori_berkas kb', 'kb.id_kategori_berkas=b.id_kategori_berkas','left');
		$this->db->join('kol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=b.id_kategori_pelatihan','left');
		$this->db->where("kunci", 1);
		$this->db->where("b.id_pegawai", $this->session->id_pegawai);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99');
		$jml = $this->m_umum->jumlah_record_filter('pegawai',$kondisi);	 */
 		$kondisi=array('kol_kategori_berkas.kunci'=>1, 'ol_berkas.id_pegawai'=>$this->session->id_pegawai);
		$jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_berkas',$kondisi,'kol_kategori_berkas','id_kategori_berkas');

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

		$this->db->where('barcode_korespodensi',$id_pengajuan);
		$this->db->update('ol_korespodensi', $data_count);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function str_all()
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
				$this->db->where("b.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir); 
	    $this->db->from('ol_berkas b');
		$this->db->join('kol_kategori_berkas kb', 'kb.id_kategori_berkas=b.id_kategori_berkas','left');
		$this->db->join('kol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=b.id_kategori_pelatihan','left');
		$this->db->where("kunci", 0);
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
				$this->db->where("b.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}
	    $this->db->from('ol_berkas b');
		$this->db->join('kol_kategori_berkas kb', 'kb.id_kategori_berkas=b.id_kategori_berkas','left');
		$this->db->join('kol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=b.id_kategori_pelatihan','left');
		$this->db->where("kunci", 0);
		$this->db->where("b.id_pegawai", $this->session->id_pegawai);
		$q = $this->db->get_where();
		$jml_filter = $q->row()->num;
 		$kondisi=array('kol_kategori_berkas.kunci'=>0, 'ol_berkas.id_pegawai'=>$this->session->id_pegawai);
		$jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_berkas',$kondisi,'kol_kategori_berkas','id_kategori_berkas');	
	//	$jml = $this->m_umum->jumlah_record_tabel('berkas');
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

		$this->db->where('barcode_korespodensi',$id_pengajuan);
		$this->db->update('ol_korespodensi', $data_count);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
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

		$this->db->where('barcode_korespodensi',$id_pengajuan);
		$this->db->update('ol_korespodensi', $data_count);
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
		$fields = "*";
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
				$this->db->where("b.id_kategori_berkas >", 9);
				$this->db->where("b.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir); 
	    $this->db->from('ol_berkas b');
		$this->db->join('kol_kategori_berkas kb', 'kb.id_kategori_berkas=b.id_kategori_berkas','left');
		$this->db->where("b.id_kategori_berkas >", 9);
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
				$this->db->where("b.id_kategori_berkas >", 9);
				$this->db->where("b.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}
	    $this->db->from('ol_berkas b');
		$this->db->join('kol_kategori_berkas kb', 'kb.id_kategori_berkas=b.id_kategori_berkas','left');
		$this->db->where("b.id_kategori_berkas >", 9);
		$this->db->where("b.id_pegawai", $this->session->id_pegawai);
		$q = $this->db->get_where();
		$jml_filter = $q->row()->num;
 		$kondisi=array('kol_kategori_berkas.id_kategori_berkas >'=>9, 'ol_berkas.id_pegawai'=>$this->session->id_pegawai);
		$jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_berkas',$kondisi,'kol_kategori_berkas','id_kategori_berkas');	
	//	$jml = $this->m_umum->jumlah_record_tabel('berkas');
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