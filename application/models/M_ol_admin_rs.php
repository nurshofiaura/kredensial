<?php
class M_ol_admin_rs extends CI_model{
	function simpan_pengumuman($id){
		$Skr = date('Y-m-d');
		$id_pegawai = $this->session->id_pegawai;
		$Now = date('H:i:s');
		$data_kewenangan = array(
			'id_pegawai' => $id_pegawai,
			'isi_pengumuman' => $this->input->post('isi_pengumuman'),
			'id_pegawai_pengurus' => $this->input->post('id_pegawai_pengurus'),
			'tgl_pengumuman' => $Skr,
			'jam_pengumuman' => $Now
		);
		return $this->db->insert('ol_pengumuman', $data_kewenangan);
	}
	function instansi_all($id)
	{
		$ids = explode(',', $id);
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*, concat(alamat_working,' ',kontak_working,' Kel : ',nama_kel,' Kec : ',nama_kec,' ',nama_kab,' ',nama_prov) as alamat_working
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
					 case 'nama_pengcab' : $nmf="op.nama_pengcab";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
	//	$this->db->where_in('id_working',$ids);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('kol_working kw');
		$this->db->join('kol_provinsi kp', 'kp.id_prov=kw.id_prov','left');
		$this->db->join('kol_kabupaten kk', 'kk.id_kab=kw.id_kab','left');
		$this->db->join('kol_kecamatan kc', 'kc.id_kec=kw.id_kec','left');
		$this->db->join('kol_kelurahan kl', 'kl.id_kel=kw.id_kel','left');
	//	$this->db->where_in('id_working',$ids);

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
					case 'nama_pengcab' : $nmf="op.nama_pengcab";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
	//	$this->db->where_in('id_working',$ids);
			}
		  }
		}

		$this->db->from('kol_working kw');
		$this->db->join('kol_provinsi kp', 'kp.id_prov=kw.id_prov','left');
		$this->db->join('kol_kabupaten kk', 'kk.id_kab=kw.id_kab','left');
		$this->db->join('kol_kecamatan kc', 'kc.id_kec=kw.id_kec','left');
		$this->db->join('kol_kelurahan kl', 'kl.id_kel=kw.id_kel','left');
	//	$this->db->where_in('id_working',$ids);


		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
//		if($id == 0){
	 	//	$kondisi=array('id_jabatan'=>$this->session->id_jabatan);
		//	$jml = $this->m_umum->jumlah_record_filter('kol_ms_struktur',$kondisi);
/*		}else{
			$jml = $this->m_umum->jumlah_record_tabel('ol_status_pegawai');	
		}*/
		$jml = $this->m_umum->jumlah_record_tabel('kol_working');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function edit_kol_working($id){
		$id_working = $this->input->post('id_working');
		if(empty($id)){
			$data_pendaftaran = array(
			'nama_working' => $this->input->post('nama_working'),
			'email_working' => $this->input->post('email_working'),
			'kontak_working' => $this->input->post('kontak_working'),
			'alamat_working' => $this->input->post('alamat_working'),
			'id_kel' => $this->input->post('id_kel'),
			'id_kec' => $this->input->post('id_kec'),
			'id_prov' => $this->input->post('id_prov'),
			'id_kab' => $this->input->post('id_kab')
			);
		}else{
			$user_pic=$this->m_umum->ambil_data('kol_working','id_working',$id_working);
			if(!empty($user_pic['kop_working'])){
				$cek_file=FCPATH.'assets/berkas/kop/'.$user_pic['kop_working'];
				if(file_exists($cek_file)){
					unlink(FCPATH."assets/berkas/kop/".$user_pic['kop_working']);
				}
			}
			$data_pendaftaran = array(
			'nama_working' => $this->input->post('nama_working'),
			'email_working' => $this->input->post('email_working'),
			'kontak_working' => $this->input->post('kontak_working'),
			'alamat_working' => $this->input->post('alamat_working'),
			'id_kel' => $this->input->post('id_kel'),
			'id_kec' => $this->input->post('id_kec'),
			'id_prov' => $this->input->post('id_prov'),
			'id_kab' => $this->input->post('id_kab'),
			'kop_working' => $id
			);
		}
		$this->db->where('id_working',$id_working);
		$this->db->update('kol_working', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function edit_stkol_working($id){
		$id_working = $this->input->post('id_working');
		if(empty($id)){
			$data_pendaftaran = array(
			'nama_working' => $this->input->post('nama_working'),
			'email_working' => $this->input->post('email_working'),
			'kontak_working' => $this->input->post('kontak_working'),
			'alamat_working' => $this->input->post('alamat_working'),
			'id_kel' => $this->input->post('id_kel'),
			'id_kec' => $this->input->post('id_kec'),
			'id_prov' => $this->input->post('id_prov'),
			'id_kab' => $this->input->post('id_kab')
			);
		}else{
			$user_pic=$this->m_umum->ambil_data('kol_working','id_working',$id_working);
			if(!empty($user_pic['stempel_working'])){
				$cek_file=FCPATH.'assets/berkas/kop/'.$user_pic['stempel_working'];
				if(file_exists($cek_file)){
					unlink(FCPATH."assets/berkas/kop/".$user_pic['stempel_working']);
				}
			}
			$data_pendaftaran = array(
			'nama_working' => $this->input->post('nama_working'),
			'email_working' => $this->input->post('email_working'),
			'kontak_working' => $this->input->post('kontak_working'),
			'alamat_working' => $this->input->post('alamat_working'),
			'id_kel' => $this->input->post('id_kel'),
			'id_kec' => $this->input->post('id_kec'),
			'id_prov' => $this->input->post('id_prov'),
			'id_kab' => $this->input->post('id_kab'),
			'stempel_working' => $id
			);
		}
		$this->db->where('id_working',$id_working);
		$this->db->update('kol_working', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function pengajuan_format_rs($id)
	{
	//	$ids = explode(',', $akses);
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
	if($id > 0){
		$this->db->where('ol_pengajuan_format_rs.id_instansi',$id);			
	}
				}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	$this->db->from('ol_pengajuan_format_rs');
	$this->db->join('kol_working', 'kol_working.id_working=ol_pengajuan_format_rs.id_instansi','left');
	$this->db->join('jabatan', 'jabatan.id_jabatan=ol_pengajuan_format_rs.id_jabatan','left');
	$this->db->join('kol_status_diusulkan', 'kol_status_diusulkan.id_status_diusulkan=ol_pengajuan_format_rs.id_status_diusulkan','left');
	if($id > 0){
		$this->db->where('ol_pengajuan_format_rs.id_instansi',$id);			
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
		$this->db->where('ol_pengajuan_format_rs.id_instansi',$id);			
	}
			}
		  }
		}

	$this->db->from('ol_pengajuan_format_rs');
	$this->db->join('kol_working', 'kol_working.id_working=ol_pengajuan_format_rs.id_instansi','left');
	$this->db->join('jabatan', 'jabatan.id_jabatan=ol_pengajuan_format_rs.id_jabatan','left');
	$this->db->join('kol_status_diusulkan', 'kol_status_diusulkan.id_status_diusulkan=ol_pengajuan_format_rs.id_status_diusulkan','left');
	if($id > 0){
		$this->db->where('ol_pengajuan_format_rs.id_instansi',$id);			
	}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----

		$jml = $this->m_umum->jumlah_record_tabel('ol_pengajuan_format_rs');			//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
	//	 print_r($output);die();
		return $output;
	}
	function simpan_ol_pengajuan_format_rs(){
		$chk = $this->input->post('chk[]');
		$eimplo = implode(",",$chk);
		if($chk){
			$data_pendaftaran = array(
				'ms_struktur' => $eimplo,
				'id_instansi' =>  $this->input->post('id_instansi'),
				'id_status_diusulkan' =>  $this->input->post('id_status_diusulkan'),
				'id_jabatan' =>  $this->input->post('id_jabatan'),
				'kunci' =>  $this->input->post('kunci'),
				'status_pengajuan_format_rs' =>  $this->input->post('status_pengajuan_format_rs')
			);
			$this->db->insert('ol_pengajuan_format_rs', $data_pendaftaran);
		}
	}
	function edit_ol_pengajuan_format_rs(){
		$chk = $this->input->post('chk[]');
		$id_pengajuan_format_rs = $this->input->post('id_pengajuan_format_rs');	
		$eimplo = implode(",",$chk);
		if($chk){
			$data_pendaftaran = array(
				'ms_struktur' => $eimplo,
				'id_instansi' =>  $this->input->post('id_instansi'),
				'id_status_diusulkan' =>  $this->input->post('id_status_diusulkan'),
				'id_jabatan' =>  $this->input->post('id_jabatan'),
				'kunci' =>  $this->input->post('kunci'),
				'status_pengajuan_format_rs' =>  $this->input->post('status_pengajuan_format_rs')
			);
			$this->db->where('id_pengajuan_format_rs',$id_pengajuan_format_rs);
			$this->db->update('ol_pengajuan_format_rs', $data_pendaftaran);
			//echo $this->db->last_query();
			$this->db->trans_complete();	// untuk cek sukses update tidak
			if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
			// if (!$this->db->affected_rows()) 
				return(FALSE);
			else 
				return(TRUE);
		}
	}
	function struktur_all($id)
	{		
		$ids = explode(',', $id);
		$fields = "*
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
				$this->db->or_like($nmf, $cari['value'],'both',false);
	//	$this->db->where_in('id_working',$ids);				
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_struktur');
		$this->db->join('kol_working','kol_working.id_working=ol_struktur.id_instansi','left');
		$this->db->join('kol_ms_struktur','kol_ms_struktur.id_ms_struktur=ol_struktur.id_ms_struktur','left');
	//	$this->db->where_in('id_working',$ids);

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
	//	$this->db->where_in('id_working',$ids);
			}
		  }
		}

		$this->db->from('ol_struktur');
		$this->db->join('kol_working','kol_working.id_working=ol_struktur.id_instansi','left');
		$this->db->join('kol_ms_struktur','kol_ms_struktur.id_ms_struktur=ol_struktur.id_ms_struktur','left');
	//	$this->db->where_in('id_working',$ids);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
//		if($id == 0){
	 	//	$kondisi=array('id_jabatan'=>$this->session->id_jabatan);
		//	$jml = $this->m_umum->jumlah_record_filter('ol_pengurus',$kondisi);
		//	$jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_pengurus',$kondisi,'ol_pengcab','id_pengcab');
/*		}else{
			$jml = $this->m_umum->jumlah_record_tabel('ol_status_pegawai');	
		}*/
		$jml = $this->m_umum->jumlah_record_tabel('ol_struktur');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_ol_struktur(){
		$chk = $this->input->post('chk[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				$this->db->select("COUNT(*) as num");
				$this->db->where('id_ms_struktur', $chk[$i]);
				$this->db->where('id_instansi',$this->input->post('id_working'));
				$q = $this->db->get('ol_struktur')->row();
				$jml = $q->num;
				if($jml == 0){
					$kode = $this->m_rancak->kode_generator(15,'');
					$data_pendaftaran = array(
						'id_ms_struktur' => $chk[$i],
						'barcode_struktur' => $kode,
						'id_instansi' =>  $this->input->post('id_working')
					);
					$this->db->insert('ol_struktur', $data_pendaftaran);
				}
			}
		}
	}
	function edit_ol_struktur(){
		$id_struktur = $this->input->post('id_struktur');
		$data_kewenangan_detil = array(
			'id_ms_struktur' => $this->input->post('id_ms_struktur'),
			'id_instansi' =>  $this->input->post('id_working'),
			'status_struktur' => $this->input->post('status_struktur')
		);
		$this->db->where('id_struktur',$id_struktur);
		$this->db->update('ol_struktur', $data_kewenangan_detil);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function simpan_anggota_ol_pengurus($id){
		$chk = $this->input->post('chk[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				$this->db->select("COUNT(*) as num");
				$this->db->where('id_pegawai', $chk[$i]);
				$this->db->where('id_pengurus',$id);
				$q = $this->db->get('ol_pegawai_pengurus')->row();
				$jml = $q->num;
				if($jml == 0){
					$kode = $this->m_rancak->kode_generator(15,'');
					$data_pendaftaran = array(
						'id_pegawai' => $chk[$i],
						'barcode_pegawai_pengurus' => $kode,
						'id_pengurus' =>  $id
					);
					$this->db->insert('ol_pegawai_pengurus', $data_pendaftaran);
				}
			}
		}
	}
	function pegawai_struktur_all($id)
	{
		$ids = explode(',', $id);
		$fields = "*
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
				$this->db->or_like($nmf, $cari['value'],'both',false);
	//	$this->db->where_in('id_working',$ids);
		$this->db->where("ol_struktur.id_ms_struktur >", 1);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_pegawai_struktur');
		$this->db->join('ol_struktur', 'ol_struktur.id_struktur=ol_pegawai_struktur.id_struktur','left');
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_pegawai_struktur.id_pegawai','left');
		$this->db->join('kol_ms_struktur', 'kol_ms_struktur.id_ms_struktur=ol_struktur.id_ms_struktur','left');
		$this->db->join('kol_working', 'kol_working.id_working=ol_struktur.id_instansi','left');			
	//	$this->db->where_in('id_working',$ids);
		$this->db->where("ol_struktur.id_ms_struktur >", 1);	

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
//case 'nama_pengcab' : $nmf="op.nama_pengcab";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
	//	$this->db->where_in('id_working',$ids);
		$this->db->where("ol_struktur.id_ms_struktur >", 1);
			}
		  }
		}

		$this->db->from('ol_pegawai_struktur');
		$this->db->join('ol_struktur', 'ol_struktur.id_struktur=ol_pegawai_struktur.id_struktur','left');
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_pegawai_struktur.id_pegawai','left');
		$this->db->join('kol_ms_struktur', 'kol_ms_struktur.id_ms_struktur=ol_struktur.id_ms_struktur','left');
		$this->db->join('kol_working', 'kol_working.id_working=ol_struktur.id_instansi','left');			
	//	$this->db->where_in('id_working',$ids);
		$this->db->where("ol_struktur.id_ms_struktur >", 1);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
//		if($id == 0){
	 	//	$kondisi=array('id_jabatan'=>$this->session->id_jabatan);
		//	$jml = $this->jumlah_akses_pengurus($id,$eimplo);
/*		}else{*/
			$jml = $this->m_umum->jumlah_record_tabel('ol_pegawai_struktur');	
//		}
		

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_struktur_instansi(){
		$id_struktur = $this->input->post('id_struktur');
		$chk = $this->input->post('chk[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				$this->db->select("COUNT(*) as num");
				$this->db->where('id_struktur', $id_struktur);
				$this->db->where('id_pegawai',$chk[$i]);
				$q = $this->db->get('ol_pegawai_struktur')->row();
				$jmlx = $q->num;
				if($jmlx == 0){
					$kode = $this->m_rancak->kode_generator(15,'');
					$data_pendaftaran2 = array(
						'barcode_pegawai_struktur' => $kode,
						'id_struktur' => $id_struktur,
						'id_pegawai' => $chk[$i]
					);
					$this->db->insert('ol_pegawai_struktur', $data_pendaftaran2);
				}
			}
		}
	}
	function simpan_pegawai_struktur_jabatan(){
		$id_pegawai_struktur = $this->input->post('id_pegawai_struktur');
		$chk = $this->input->post('chk[]');
		if(empty($chk)){
			$eimplo = "";
		}else{
			$eimplo = implode(",",$chk);
		}
		$data_pendaftaran = array(
			'id_jabatan' => $eimplo
		);
		$this->db->where('id_pegawai_struktur',$id_pegawai_struktur);
		$this->db->update('ol_pegawai_struktur', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function edit_ol_pegawai($gbr,$id){
		$id_pegawai = $this->input->post('id_pegawai');
		$user_pic=$this->m_umum->ambil_data('ol_pegawai','id_pegawai',$id_pegawai);
		if(!empty($user_pic['ttd_pegawai'])){
			$cek_file=FCPATH.'assets/berkas/kop/'.$user_pic['ttd_pegawai'];
			if(file_exists($cek_file)){
				unlink(FCPATH."assets/berkas/kop/".$user_pic['ttd_pegawai']);
			}
		}
		$data_pendaftaran = array(
		'ttd_pegawai' => $gbr
		);
		$this->db->where('id_pegawai',$id_pegawai);
		$this->db->update('ol_pegawai', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function edit_pegawai_struktur(){
		$id_pegawai_struktur = $this->input->post('id_pegawai_struktur');
		$data_pendaftaran = array(
			'id_struktur' => $this->input->post('id_struktur'),
			'id_pegawai' => $this->input->post('id_pegawai'),
			'status_pegawai_struktur' => $this->input->post('status_pegawai_struktur')
		);
		$this->db->where('id_pegawai_struktur',$id_pegawai_struktur);
		$this->db->update('ol_pegawai_struktur', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function pengajuan_kompetensi_all($eimplo,$jabatan,$id)
	{
		$ids = explode(',', $eimplo);
		$idj = explode(',', $jabatan);
	$wordsAry = explode("-", $id);
	$wordsCount = count($wordsAry);
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,if(tgl_pengajuan = '' ,'Belum Ada Tanggal',DATE_FORMAT(tgl_pengajuan,'%d-%m-%Y')) as tgl_pengajuan
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
	//	$this->db->where_in('ok.id_instansi',$ids);
/*		if(!($jabatan == NULL)){
		$this->db->where_in('jf.id_jabatan',$idj); }*/
		$this->db->where('ok.status_pengajuan >', 0);
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(op.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}				
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_pengajuan ok');
		$this->db->join('kol_status_diusulkan okk', 'okk.id_status_diusulkan=ok.id_status_diusulkan','left');
		$this->db->join('ol_pegawai op', 'op.id_pegawai=ok.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=op.id_jabatan_fungsional','left');
	//	$this->db->where_in('ok.id_instansi',$ids);
/*		if(!($jabatan == NULL)){
		$this->db->where_in('jf.id_jabatan',$idj); }*/
		$this->db->where('ok.status_pengajuan >', 0);
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(op.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
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
				//	case 'nama_pengcab' : $nmf="op.nama_pengcab";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
	//	$this->db->where_in('ok.id_instansi',$ids);
/*		if(!($jabatan == NULL)){
		$this->db->where_in('jf.id_jabatan',$idj); }*/
		$this->db->where('ok.status_pengajuan >', 0);
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(op.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
			}
		  }
		}

		$this->db->from('ol_pengajuan ok');
		$this->db->join('kol_status_diusulkan okk', 'okk.id_status_diusulkan=ok.id_status_diusulkan','left');
		$this->db->join('ol_pegawai op', 'op.id_pegawai=ok.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=op.id_jabatan_fungsional','left');
	//	$this->db->where_in('ok.id_instansi',$ids);
/*		if(!($jabatan == NULL)){
		$this->db->where_in('jf.id_jabatan',$idj); }*/
		$this->db->where('ok.status_pengajuan >', 0);
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(op.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/*		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){*/
/*		 		$kondisi=array('id_pengirim'=>$this->session->id_pegawai);
				$jml = $this->m_umum->jumlah_record_filter('ol_korespodensi',$kondisi);*/
/*			}else{
				$jml = $this->m_umum->jumlah_record_tabel('ol_surat');
			}
		}else{
			$jml = $this->m_umum->jumlah_record_tabel('ol_surat');
		}*/		
		$jml = $this->m_umum->jumlah_record_tabel('ol_pengajuan');
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function seting_validator_kompetensi($pengajuan)
	{
		$dtpengajuan = $this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$pengajuan);
		$fields = "*,if(opv.plan_pengajuan_validasi = 0,'Tidak Melalui Format',kms.nama_ms_struktur) as nama_ms_struktur,
					kms2.nama_ms_struktur as nms,
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
				default: $nmf=$k['data'];
				}
		$this->db->where('opv.id_pengajuan', $dtpengajuan['id_pengajuan']);			
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_pengajuan_validasi opv');
		$this->db->join('ol_pengajuan opg', 'opg.id_pengajuan=opv.id_pengajuan','left');
		$this->db->join('kol_ms_struktur kms', 'kms.id_ms_struktur=opv.plan_pengajuan_validasi','left');
		$this->db->join('ol_pegawai_struktur ops', 'ops.id_pegawai_struktur=opv.id_pegawai_struktur','left');
		$this->db->join('ol_pegawai op', 'op.id_pegawai=ops.id_pegawai','left');
		$this->db->join('ol_struktur os', 'os.id_struktur=ops.id_struktur','left');
		$this->db->join('kol_ms_struktur kms2', 'kms2.id_ms_struktur=os.id_ms_struktur','left');
		$this->db->join('kol_working kw', 'kw.id_working=os.id_instansi','left');
		$this->db->where('opv.id_pengajuan', $dtpengajuan['id_pengajuan']);

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
		$this->db->where('opv.id_pengajuan', $dtpengajuan['id_pengajuan']);
			}
		  }
		}

		$this->db->from('ol_pengajuan_validasi opv');
		$this->db->join('ol_pengajuan opg', 'opg.id_pengajuan=opv.id_pengajuan','left');
		$this->db->join('kol_ms_struktur kms', 'kms.id_ms_struktur=opv.plan_pengajuan_validasi','left');
		$this->db->join('ol_pegawai_struktur ops', 'ops.id_pegawai_struktur=opv.id_pegawai_struktur','left');
		$this->db->join('ol_pegawai op', 'op.id_pegawai=ops.id_pegawai','left');
		$this->db->join('ol_struktur os', 'os.id_struktur=ops.id_struktur','left');
		$this->db->join('kol_ms_struktur kms2', 'kms2.id_ms_struktur=os.id_ms_struktur','left');
		$this->db->join('kol_working kw', 'kw.id_working=os.id_instansi','left');
		$this->db->where('opv.id_pengajuan', $dtpengajuan['id_pengajuan']);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/*		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){*/
/*		 		$kondisi=array('id_pengirim'=>$this->session->id_pegawai);
				$jml = $this->m_umum->jumlah_record_filter('ol_pengajuan_validasi',$kondisi);*/
/*			}else{
				$jml = $this->m_umum->jumlah_record_tabel('ol_surat');
			}
		}else{
			$jml = $this->m_umum->jumlah_record_tabel('ol_surat');
		}*/		
		$kondisi=array('id_pengajuan'=>$dtpengajuan['id_pengajuan']);
		$jml = $this->m_umum->jumlah_record_filter('ol_pengajuan_validasi',$kondisi);
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function logbook_null($pengajuan,$pegstr)
	{
		$dtpengajuan = $this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$pengajuan);
		$kondisi=array('barcode_pegawai_struktur'=>$pegstr);
		$dtpegstr = $this->m_umum->ambil_data_kondisi_2tabel_row('ol_pegawai_struktur',$kondisi,'ol_struktur','id_struktur');
		$fields = "*,ol.id_logbook
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
	// $this->db->query('SELECT column_name(s) FROM table_name1 UNION SELECT column_name(s) FROM table_name2');
	// $query = 'select * from etudiant where NOT EXISTS (select * from etudiant where matricule ='.$new_matricule.') ';
	//	$this->db->query($fields);
		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan [coding here]
				default: $nmf=$k['data'];
				}
	//	$this->db->where('olv.id_pegawai_struktur IS NULL', null, false);
		$this->db->where("not exists (select 1 from ol_logbook_validasi  olv where olv.id_logbook = ol.id_logbook)",null,false);
		$this->db->where('ol.id_pengajuan', $dtpengajuan['id_pengajuan']);
	//	$this->db->where_not_in('olv.id_pegawai_struktur', $dtpegstr['id_ms_struktur']);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

/*
SELECT * FROM ol_logbook ol
WHERE NOT EXISTS (SELECT * FROM ol_logbook_validasi olv WHERE olv.`id_logbook`=ol.`id_logbook`)
*/
		$this->db->from('ol_logbook ol');
	//	$this->db->join('ol_logbook_validasi olv', 'ol.id_logbook = olv.id_logbook', 'left outer');
		$this->db->join('ol_kewenangan ok', 'ok.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('kol_working kw', 'kw.id_working=ol.id_instansi','left');
		$this->db->join('ol_pegawai op', 'op.id_pegawai=ol.id_logbooker','left');
	//	$this->db->where('olv.id_pegawai_struktur IS NULL', null, false);
		$this->db->where("not exists (select 1 from ol_logbook_validasi  olv where olv.id_logbook = ol.id_logbook)",null,false);
		$this->db->where('ol.id_pengajuan', $dtpengajuan['id_pengajuan']);
	//	$this->db->where_not_in('olv.id_pegawai_struktur', $dtpegstr['id_ms_struktur']);

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
	//	$this->db->where('olv.id_pegawai_struktur IS NULL', null, false);
		$this->db->where("not exists (select 1 from ol_logbook_validasi  olv where olv.id_logbook = ol.id_logbook)",null,false);
		$this->db->where('ol.id_pengajuan', $dtpengajuan['id_pengajuan']);
	//	$this->db->where_not_in('olv.id_pegawai_struktur', $dtpegstr['id_ms_struktur']);
			}
		  }
		}

		$this->db->from('ol_logbook ol');
	//	$this->db->join('ol_logbook_validasi olv', 'ol.id_logbook = olv.id_logbook', 'left outer');
		$this->db->join('ol_kewenangan ok', 'ok.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('kol_working kw', 'kw.id_working=ol.id_instansi','left');
		$this->db->join('ol_pegawai op', 'op.id_pegawai=ol.id_logbooker','left');
	//	$this->db->where('olv.id_pegawai_struktur IS NULL', null, false);
		$this->db->where("
			not exists (select 1 from ol_logbook_validasi  olv where olv.id_logbook = ol.id_logbook AND olv.validasi > 2)
			",null,false);
		$this->db->where('ol.id_pengajuan', $dtpengajuan['id_pengajuan']);
	//	$this->db->where_not_in('olv.id_pegawai_struktur', $dtpegstr['id_ms_struktur']);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/*		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){*/
/*		 		$kondisi=array('id_pengirim'=>$this->session->id_pegawai);
				$jml = $this->m_umum->jumlah_record_filter('ol_pengajuan_validasi',$kondisi);*/
/*			}else{
				$jml = $this->m_umum->jumlah_record_tabel('ol_surat');
			}
		}else{
			$jml = $this->m_umum->jumlah_record_tabel('ol_surat');
		}*/		
		$kondisi=array('id_pengajuan'=>$dtpengajuan['id_pengajuan']);
		$jml = $this->m_umum->jumlah_record_filter('ol_logbook',$kondisi);
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function pegawai_struktur_kompetensi($id,$id2)
	{
		$ids = explode(',', $this->session->list_instansi);
		$pengval = $this->m_umum->ambil_data('ol_pengajuan_validasi','barcode_pengajuan_validasi',$id);
		$fields = "*,if(ol_pegawai.id_kode_kewenangan = '0','NON PERAWAT',nama_kode_kewenangan) as nama_kode_kewenangan
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
				$this->db->or_like($nmf, $cari['value'],'both',false);
		if(empty($id2)){
	//		$this->db->where_in('id_working',$ids);
		}else{
			$this->db->where('barcode_working',$id2);
		}			
	//	$this->db->where('ol_struktur.id_ms_struktur',$pengval['plan_pengajuan_validasi']);
	//	$this->db->where("ol_struktur.id_ms_struktur >", 1);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_pegawai_struktur');
		$this->db->join('ol_struktur', 'ol_struktur.id_struktur=ol_pegawai_struktur.id_struktur','left');
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_pegawai_struktur.id_pegawai','left');
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
		$this->db->join('kol_kode_kewenangan', 'kol_kode_kewenangan.id_kode_kewenangan=ol_pegawai.id_kode_kewenangan','left');
		$this->db->join('kol_ms_struktur', 'kol_ms_struktur.id_ms_struktur=ol_struktur.id_ms_struktur','left');
		$this->db->join('kol_working', 'kol_working.id_working=ol_struktur.id_instansi','left');
		if(empty($id2)){
	//		$this->db->where_in('id_working',$ids);
		}else{
			$this->db->where('barcode_working',$id2);
		}			
	//	$this->db->where('ol_struktur.id_ms_struktur',$pengval['plan_pengajuan_validasi']);
	//	$this->db->where("ol_struktur.id_ms_struktur >", 1);

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
//case 'nama_pengcab' : $nmf="op.nama_pengcab";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		if(empty($id2)){
	//		$this->db->where_in('id_working',$ids);
		}else{
			$this->db->where('barcode_working',$id2);
		}			
	//	$this->db->where('ol_struktur.id_ms_struktur',$pengval['plan_pengajuan_validasi']);
	//	$this->db->where("ol_struktur.id_ms_struktur >", 1);
			}
		  }
		}

		$this->db->from('ol_pegawai_struktur');
		$this->db->join('ol_struktur', 'ol_struktur.id_struktur=ol_pegawai_struktur.id_struktur','left');
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_pegawai_struktur.id_pegawai','left');
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
		$this->db->join('kol_kode_kewenangan', 'kol_kode_kewenangan.id_kode_kewenangan=ol_pegawai.id_kode_kewenangan','left');
		$this->db->join('kol_ms_struktur', 'kol_ms_struktur.id_ms_struktur=ol_struktur.id_ms_struktur','left');
		$this->db->join('kol_working', 'kol_working.id_working=ol_struktur.id_instansi','left');	
		if(empty($id2)){
	//		$this->db->where_in('id_working',$ids);
		}else{
			$this->db->where('barcode_working',$id2);
		}			
	//	$this->db->where('ol_struktur.id_ms_struktur',$pengval['plan_pengajuan_validasi']);
	//	$this->db->where("ol_struktur.id_ms_struktur >", 1);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
//		if($id == 0){
	 	//	$kondisi=array('id_jabatan'=>$this->session->id_jabatan);
		//	$jml = $this->jumlah_akses_pengurus($id,$eimplo);
/*		}else{*/
			$jml = $this->m_umum->jumlah_record_tabel('ol_pegawai_struktur');	
//		}
		

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function rubah_plan_pengajuan_validasi($id,$id2){
		$data_pendaftaran = array(
			'wkt_pengajuan_validasi' => date('Y-m-d H:i:s'),
			'id_pegawai_struktur' => $id2
		);
		$this->db->where('barcode_pengajuan_validasi',$id);
		$this->db->update('ol_pengajuan_validasi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function simpan_logbook_validasi($isi,$tolak,$struktur,$eimplo){
		$bookseat = explode(',', $eimplo);
		for($i = 0; $i < count($bookseat); ++$i){
				$this->db->select("COUNT(*) as num");
				$this->db->where('id_logbook', $bookseat[$i]);
				$this->db->where('id_pegawai_struktur',$struktur);
				$q = $this->db->get('ol_logbook_validasi')->row();
				$jmlx = $q->num;
				if($jmlx == 0){
					$data_pendaftaran2 = array(
						'id_logbook' => $bookseat[$i],
						'id_pegawai_struktur' => $struktur,
						'validasi' =>  $isi,
						'result_tolak' =>  $tolak
					);
					$this->db->insert('ol_logbook_validasi', $data_pendaftaran2);
				}
		}
	}
	function rubah_pengajuan_validasi($id,$isi){
		$data_v_karu = array(
			'validasi' => $isi
		);
		$this->db->where('barcode_pengajuan_validasi',$id); 
		$this->db->update('ol_pengajuan_validasi', $data_v_karu);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function pengajuan_berkas_Simpan($id){
		$id_4_berkas = $this->input->post('id_4_berkas');
		$id_4_ijasah = $this->input->post('id_4_ijasah');
		$id_4_str = $this->input->post('id_4_str');
		$id_4_sertifikat = $this->input->post('id_4_sertifikat');
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
		$this->db->where('barcode_pengajuan',$id);
		$this->db->update('ol_pengajuan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function pengajuan_validasi_berkas_Simpan($id){
		$kesesuaian_bukti = $this->input->post('kesesuaian_bukti');
		if (empty($kesesuaian_bukti)) {
		   $chkkesesuaian_bukti = "";
		}else{
			$chkkesesuaian_bukti = implode(",",$kesesuaian_bukti);
		}
		$data_pendaftaran = array(
			'kesesuaian_bukti_validasi' => $chkkesesuaian_bukti
		);
		$this->db->where('barcode_pengajuan_validasi',$id);
		$this->db->update('ol_pengajuan_validasi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function rubah_logbook_validasi($isi,$tolak,$struktur,$eimplo){
		$bookseat = explode(',', $eimplo);
		for($i = 0; $i < count($bookseat); ++$i){
			$data_pendaftaran = array(
				'validasi' => $isi,
				'result_tolak' => $tolak
			);
			$this->db->where('id_logbook',$bookseat[$i]);
			$this->db->where('id_pegawai_struktur',$struktur);
			$this->db->update('ol_logbook_validasi', $data_pendaftaran);
			//echo $this->db->last_query();
			$this->db->trans_complete();	// untuk cek sukses update tidak
			if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
			// if (!$this->db->affected_rows())
				return(FALSE);
			else
				return(TRUE);
		}
	}
	function member_all($eimplo,$id)
	{
	$idx = explode(',', $eimplo);
	$wordsAry = explode("-", $id);
	$wordsCount = count($wordsAry);
		$fields = "*,if(status_perawat = 0,'Non Keperawatan',nama_kode_kewenangan) as nama_kode_kewenangan,
					if (jk = '1' ,'Laki-laki','Perempuan') as jk,
					if (status_pegawai = '1' ,'AKTIF','NON AKTIF') as status_pegawai,
					CONCAT(tmp_lahir,' - ',DATE_FORMAT(tgl_lahir,'%d-%m-%Y'),' / ',(TIMESTAMPDIFF( YEAR, tgl_lahir, now() )), ' Tahun ',
					TIMESTAMPDIFF( MONTH, tgl_lahir, now() ) % 12, ' Bulan ',
					FLOOR( TIMESTAMPDIFF( DAY, tgl_lahir, now() ) % 30.4375 ), ' Hari') as umur,opi.id_pegawai
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
				$this->db->where_in("opi.id_instansi",$idx);
				$this->db->where('visible', '1');
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(op.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(op.nip LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(op.no_profesi LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(ol_pengcab.nama_pengcab LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_pegawai_instansi opi');
		$this->db->join('kol_working kw', 'kw.id_working=opi.id_instansi','left');
		$this->db->join('ol_pegawai op', 'op.id_pegawai=opi.id_pegawai','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=op.id_status_kawin','left');
		$this->db->join('kol_agama kag', 'kag.id_agama=op.id_agama','left');
		$this->db->join('kol_pendidikan kp', 'kp.id_pendidikan=op.id_pendidikan','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=op.id_jabatan_fungsional','left');
		$this->db->join('ol_status_pegawai osp', 'osp.id_status_pegawai=op.tipe_pegawai','left');
		$this->db->join('kol_kode_kewenangan kkk', 'kkk.id_kode_kewenangan=op.id_kode_kewenangan','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=op.id_pengcab','left');
		$this->db->where_in("opi.id_instansi",$idx);
		$this->db->where('visible', '1');
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(op.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(op.nip LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(op.no_profesi LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(ol_pengcab.nama_pengcab LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
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
				$this->db->where_in("opi.id_instansi",$idx);
				$this->db->where('visible', '1');
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(op.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(op.nip LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(op.no_profesi LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(ol_pengcab.nama_pengcab LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
			}
		  }
		}

		$this->db->from('ol_pegawai_instansi opi');
		$this->db->join('kol_working kw', 'kw.id_working=opi.id_instansi','left');
		$this->db->join('ol_pegawai op', 'op.id_pegawai=opi.id_pegawai','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=op.id_status_kawin','left');
		$this->db->join('kol_agama kag', 'kag.id_agama=op.id_agama','left');
		$this->db->join('kol_pendidikan kp', 'kp.id_pendidikan=op.id_pendidikan','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=op.id_jabatan_fungsional','left');
		$this->db->join('ol_status_pegawai osp', 'osp.id_status_pegawai=op.tipe_pegawai','left');
		$this->db->join('kol_kode_kewenangan kkk', 'kkk.id_kode_kewenangan=op.id_kode_kewenangan','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=op.id_pengcab','left');
				$this->db->where_in("opi.id_instansi",$idx);
				$this->db->where('visible', '1');
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(op.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(op.nip LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(op.no_profesi LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(ol_pengcab.nama_pengcab LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('ol_pegawai');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function reset_password($id){
		$password = hash("sha512", md5("7654321"));
		$data_pendaftaran = array(
			'password' => $password
		);
		$this->db->where('id_pegawai',$id);
		$this->db->update('ol_pegawai', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function edit_pegawai(){
		$barcode_pegawai = $this->input->post('barcode_pegawai');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$tgl_lahir = date('Y-m-d', strtotime($tgl_lahir));
		$data_pendaftaran = array(
			'nama_pegawai' => $this->input->post('nama_pegawai'),
			'jk' => $this->input->post('jk'),
			'tmp_lahir' => $this->input->post('tmp_lahir'),
			'tgl_lahir' => $tgl_lahir,
			'email' => $this->input->post('email'),
			'no_hp' => $this->input->post('no_hp'),
			'nik' => $this->input->post('nik'),
			'nip' => $this->input->post('nip'),
			'no_profesi' => $this->input->post('no_profesi'),
			'id_status_kawin' => $this->input->post('id_status_kawin'),
			'id_agama' => $this->input->post('id_agama'),
			'id_pendidikan' => $this->input->post('id_pendidikan'),
			'tipe_pegawai' => $this->input->post('tipe_pegawai'),
			'alamat' => $this->input->post('alamat'),
			'status_pegawai' =>$this->input->post('status_pegawai')
		);
		$this->db->where('barcode_pegawai',$barcode_pegawai);
		$this->db->update('ol_pegawai', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function ol_hak_akses_all($id)
	{
	//	$ids = explode(',', $akses);
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
				$this->db->where('peg.barcode_pegawai',$id);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	$this->db->from('ol_akses pak');
	$this->db->join('akses ak','ak.id_akses=pak.id_akses','left');
	$this->db->join('ol_pegawai peg','peg.id_pegawai=pak.id_pegawai','left');
	$this->db->where('peg.barcode_pegawai',$id);

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
				$this->db->where('peg.barcode_pegawai',$id);
			}
		  }
		}

	$this->db->from('ol_akses pak');
	$this->db->join('akses ak','ak.id_akses=pak.id_akses','left');
	$this->db->join('ol_pegawai peg','peg.id_pegawai=pak.id_pegawai','left');
	$this->db->where('peg.barcode_pegawai',$id);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----

		$jml = $this->m_umum->jumlah_record_tabel('ol_akses');			//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
	//	 print_r($output);die();
		return $output;
	}
	function ol_simpan_pegawai_akses(){
		$id_pegawai = $this->input->post('id_pegawai');
		$chk = $this->input->post('chk[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				$this->db->select("COUNT(*) as num");
				$this->db->where('id_pegawai',$id_pegawai);
				$this->db->where('id_akses',$chk[$i]);
				$q = $this->db->get('ol_akses')->row();
				$jml = $q->num;
				if($jml == 0){
					$data_pendaftaran = array(
						'id_akses' => $chk[$i],
						'id_pegawai' => $id_pegawai,
						'status_ol_akses' => 1
					);
					$this->db->insert('ol_akses', $data_pendaftaran);
				}
			}
		}
	}
	function simpan_pengajuan_validasi(){
		$id_pengajuan = $this->input->post('id_pengajuan');
		$chk = $this->input->post('chk[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				$this->db->select("COUNT(*) as num");
				$this->db->where('id_pengajuan',$id_pengajuan);
				$this->db->where('id_pegawai_struktur',$chk[$i]);
				$q = $this->db->get('ol_pengajuan_validasi')->row();
				$jml = $q->num;
				if($jml == 0){
					$kode = $this->m_rancak->kode_generator(15,'');
					$data_pendaftaran = array(
						'id_pegawai_struktur' => $chk[$i],
						'barcode_pengajuan_validasi' => $kode,
						'id_pengajuan' => $id_pengajuan
					);
					$this->db->insert('ol_pengajuan_validasi', $data_pendaftaran);
				}
			}
		}
	}
	function simpan_pegawai_pengajuan(){
		$barcode_pengajuan = $this->input->post('barcode_pengajuan');
		$chk = $this->input->post('chk[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				$this->db->select("COUNT(*) as num");
				$this->db->where('barcode_pengajuan',$barcode_pengajuan);
				$this->db->where('id_asesor',$chk[$i]);
				$q = $this->db->get('nkr_pengajuan_validator')->row();
				$jml = $q->num;
				if($jml == 0){
					$kode = $this->m_rancak->kode_generator_urut(15,'PV');
					$data_pendaftaran = array(
						'id_asesor' => $chk[$i],
						'barcode_pengajuan_validator' => $kode,
						'barcode_pengajuan' => $barcode_pengajuan
					);
					$this->db->insert('nkr_pengajuan_validator', $data_pendaftaran);
				}
			}
		}
/*		$id_pengajuan = $this->input->post('id_pengajuan');
		$chk = $this->input->post('chk[]');
		$eimplo = implode(",",$chk);		
		$data_pendaftaran = array(
			'pegawai_pengajuan' => $eimplo
		);
		$this->db->where('id_pengajuan',$id_pengajuan);
		$this->db->update('ol_pengajuan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);*/					
	}
	function nkr_pengajuan_validator_tabel($id)
	{
/*		$ids = explode(',', $this->session->list_instansi);
		$pengval = $this->m_umum->ambil_data('ol_pengajuan_validasi','barcode_pengajuan_validasi',$id);*/
		$fields = "*,if(nkr_form IS NOT NULL,'SUDAH','BELUM') as nkr_form
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
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('npvl.barcode_pengajuan',$id);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('nkr_pengajuan_validator npvl');
		$this->db->join('ol_pengajuan op', 'op.barcode_pengajuan=npvl.barcode_pengajuan','left');
		$this->db->join('ol_pegawai ol', 'ol.id_pegawai=npvl.id_asesor','left');
		$this->db->where('npvl.barcode_pengajuan',$id);

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
//case 'nama_pengcab' : $nmf="op.nama_pengcab";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('npvl.barcode_pengajuan',$id);
			}
		  }
		}

		$this->db->from('nkr_pengajuan_validator npvl');
		$this->db->join('ol_pengajuan op', 'op.barcode_pengajuan=npvl.barcode_pengajuan','left');
		$this->db->join('ol_pegawai ol', 'ol.id_pegawai=npvl.id_asesor','left');
		$this->db->where('npvl.barcode_pengajuan',$id);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
//		if($id == 0){
	 	//	$kondisi=array('id_jabatan'=>$this->session->id_jabatan);
		//	$jml = $this->jumlah_akses_pengurus($id,$eimplo);
/*		}else{*/
			$jml = $this->m_umum->jumlah_record_tabel('nkr_pengajuan_validator');	
//		}
		

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_form_pengajuan_validator(){
		$barcode_pengajuan_validator = $this->input->post('barcode_pengajuan_validator');
		$chk = $this->input->post('chk[]');
		$eimplo = implode(",",$chk);		
		$data_pendaftaran = array(
			'nkr_form' => $eimplo
		);
		$this->db->where('barcode_pengajuan_validator',$barcode_pengajuan_validator);
		$this->db->update('nkr_pengajuan_validator', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function ol_status_pegawai_akses($int,$id){
		$data_pendaftaran = array(
			'status_ol_akses' => $int
		);
		$this->db->where('id_ol_akses',$id);
		$this->db->update('ol_akses', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function unit_all($id,$eimplo)
	{
		$idx = explode(',', $eimplo);
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*
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
				$this->db->where_in("id_instansi",$idx);
				if($id == 0){
					$this->db->where_in("id_instansi",$idx);
				}else{
					$this->db->where('id_instansi',$id); 
				}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_unit ou');
		$this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
		$this->db->where_in("id_instansi",$idx);
				if($id == 0){
					$this->db->where_in("id_instansi",$idx);
				}else{
					$this->db->where('id_instansi',$id); 
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
				if($id == 0){
					$this->db->where_in("id_instansi",$idx);
				}else{
					$this->db->where('id_instansi',$id); 
				}
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
		$this->db->from('ol_unit ou');
		$this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
				if($id == 0){
					$this->db->where_in("id_instansi",$idx);
				}else{
					$this->db->where('id_instansi',$id); 
				}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('ol_unit');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_ol_unit(){
		$kode = $this->m_rancak->kode_generator_urut(15,'OU');
		$data_pendaftaran = array(	
			'id_unit' => $kode,
			'id_instansi' => $this->input->post('id_instansi'),
			'nama_unit' => $this->input->post('nama_unit'),
			'status_unit' => $this->input->post('status_unit')
		);
		return $this->db->insert('ol_unit', $data_pendaftaran);
	}
	function edit_ol_unit(){
		$id_unit = $this->input->post('id_unit');
		$data_pendaftaran = array(
			'id_instansi' => $this->input->post('id_instansi'),
			'nama_unit' => $this->input->post('nama_unit'),
			'status_unit' => $this->input->post('status_unit')
		);
		$this->db->where('id_unit',$id_unit);
		$this->db->update('ol_unit', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function registrasi_all($id)
	{
	$wordsAry = explode("-", $id);
	$wordsCount = count($wordsAry);
	$ide = explode(',', $this->session->list_instansi);
		$fields = "*,
		DATE_FORMAT(wkt_registrasi,'%d-%m-%Y') as wkt_registrasi,
		DATE_FORMAT(wkt_simpan,'%d-%m-%Y') as wkt_simpan,if(status_registrasi = '0','null',if (jk = '1' ,'Laki-laki','Perempuan'))
		 as jk,
		CONCAT((TIMESTAMPDIFF( YEAR, tgl_lahir, now() )), ' Tahun ',
		TIMESTAMPDIFF( MONTH, tgl_lahir, now() ) % 12, ' Bulan ',
		FLOOR( TIMESTAMPDIFF( DAY, tgl_lahir, now() ) % 30.4375 ), ' Hari') as umur,
		DATE_FORMAT(tgl_lahir,'%d-%m-%Y') as tgl_lahir
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
				$this->db->where_in('or.id_instansi',$ide);
				$this->db->where('status_registrasi <', '2');
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(or.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(or.nip LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(or.no_profesi LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_registrasi or');
		$this->db->join('ol_pengcab opc', 'opc.id_pengcab=or.id_pengcab','left');
		$this->db->join('kol_working ol', 'ol.id_working=or.id_instansi','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=or.id_status_kawin','left');
		$this->db->join('kol_agama kag', 'kag.id_agama=or.id_agama','left');
		$this->db->join('kol_pendidikan kp', 'kp.id_pendidikan=or.id_pendidikan','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=or.id_jabatan_fungsional','left');
		$this->db->where_in('or.id_instansi',$ide);
		$this->db->where('status_registrasi <', '2');
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(or.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(or.nip LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(or.no_profesi LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
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
				$this->db->where_in('or.id_instansi',$ide);
				$this->db->where('status_registrasi <', '2');
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(or.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(or.nip LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(or.no_profesi LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
		$this->db->from('ol_registrasi or');
		$this->db->join('ol_pengcab opc', 'opc.id_pengcab=or.id_pengcab','left');
		$this->db->join('kol_working ol', 'ol.id_working=or.id_instansi','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=or.id_status_kawin','left');
		$this->db->join('kol_agama kag', 'kag.id_agama=or.id_agama','left');
		$this->db->join('kol_pendidikan kp', 'kp.id_pendidikan=or.id_pendidikan','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=or.id_jabatan_fungsional','left');
		$this->db->where_in('or.id_instansi',$ide);
		$this->db->where('status_registrasi <', '2');
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(or.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(or.nip LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(or.no_profesi LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('ol_registrasi');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_aktifasi(){
		$barcode_registrasi = $this->input->post('barcode_registrasi');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$tgl_lahir = date('Y-m-d', strtotime($tgl_lahir));
		$username= $this->input->post('username');
		$username = strtolower($username);
		$username = str_replace(' ', '-', $username);
		$username = preg_replace('/[^A-Za-z0-9\-]/', '', $username);
		$password = hash("sha512", md5('7654321'));		
		$status_perawat = $this->input->post('status_perawat');		
		if($status_perawat == 0){
			$id_kode_kewenangan = '0';
		}else{
			$id_kode_kewenangan = $this->input->post('id_kode_kewenangan');
		}
		$kode = $this->m_rancak->kode_generator(15,'');
		$data_pendaftaran = array(
			'barcode_pegawai' => $kode,
			'username' => $username,
			'password' => $password,			
			'nama_pegawai' => $this->input->post('nama_pegawai'),
			'jk' => $this->input->post('jk'),
			'tmp_lahir' => $this->input->post('tmp_lahir'),
			'tgl_lahir' => $tgl_lahir,
			'email' => $this->input->post('email'),
			'no_hp' => $this->input->post('no_hp'),
			'nik' => $this->input->post('nik'),
			'nip' => $this->input->post('nip'),
			'id_prov' => $this->input->post('id_prov'),
			'id_kab' => $this->input->post('id_kab'),
			'id_kec' => $this->input->post('id_kec'),
			'id_kel' => $this->input->post('id_kel'),
			'no_profesi' => $this->input->post('no_profesi'),
			'id_status_kawin' => $this->input->post('id_status_kawin'),
			'id_pengcab' => $this->input->post('id_pengcab'),
			'id_agama' => $this->input->post('id_agama'),
			'id_pendidikan' => $this->input->post('id_pendidikan'),
			'tipe_pegawai' => $this->input->post('tipe_pegawai'),
			'id_jabatan_fungsional' => $this->input->post('id_jabatan_fungsional'),
			'alamat' => $this->input->post('alamat'),
			'id_kode_kewenangan' => $id_kode_kewenangan,
			'status_perawat' => $status_perawat,
			'status_pegawai' =>1,
			'foto' =>''
		);
		$this->db->insert('ol_pegawai', $data_pendaftaran);
		return $this->db->insert_id();
	}
	function simpan_instansi($id){
		$id_instansi = $this->input->post('id_instansi');
		$kondisi=array('id_instansi'=>$id_instansi,'id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('ol_pegawai_instansi',$kondisi);
		if($jml == 0){
			$data_pendaftaran = array(
				'id_pegawai' => $id,
				'id_instansi' => $id_instansi
			);
			return $this->db->insert('ol_pegawai_instansi', $data_pendaftaran);
		}
	}
	function simpan_user($id){
		$kode = $this->m_rancak->kode_generator(15,'');
		$data_pendaftaran = array(
			'id_pegawai' => $id,
			'barcode_user' => $kode,
			'id_level' => $this->input->post('id_level')
		);
		return $this->db->insert('ol_user', $data_pendaftaran);
	}
	function edit_status_registrasi(){
		$barcode_registrasi = $this->input->post('barcode_registrasi');
		$data_pendaftaran = array(
			'status_registrasi' => 2,
			'wkt_aktifasi' => date('Y-m-d H:i:s')
		);
		$this->db->where('barcode_registrasi',$barcode_registrasi);
		$this->db->update('ol_registrasi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function direktur_all($eimplo,$id)
	{
	$idx = explode(',', $eimplo);
	$wordsAry = explode("-", $id);
	$wordsCount = count($wordsAry);
		$fields = "*,if (jk = '1' ,'Laki-laki','Perempuan') as jk,if (status_direktur = '1' ,'AKTIF','NON AKTIF') as status_direktur
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
	//	$this->db->where_in("od.id_instansi",$idx);
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(od.nama_direktur LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(od.nip LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_direktur od');
		$this->db->join('kol_working kw', 'kw.id_working=od.id_instansi','left');
		$this->db->join('ol_status_pegawai osp', 'osp.id_status_pegawai=od.id_status_pegawai','left');
	//	$this->db->where_in("od.id_instansi",$idx);
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(od.nama_direktur LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(od.nip LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
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
	//	$this->db->where_in("od.id_instansi",$idx);
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(od.nama_direktur LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(od.nip LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
			}
		  }
		}

		$this->db->from('ol_direktur od');
		$this->db->join('kol_working kw', 'kw.id_working=od.id_instansi','left');
		$this->db->join('ol_status_pegawai osp', 'osp.id_status_pegawai=od.id_status_pegawai','left');
	//	$this->db->where_in("od.id_instansi",$idx);
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(od.nama_direktur LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(od.nip LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('ol_direktur');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_direktur(){
		$kode = $this->m_rancak->kode_generator(15,'');
		$data_pendaftaran = array(
			'barcode_direktur' => $kode,
			'jk' => $this->input->post('jk'),
			'nama_direktur' => $this->input->post('nama_direktur'),
			'id_status_pegawai' => $this->input->post('id_status_pegawai'),
			'id_instansi' => $this->input->post('id_instansi'),
			'nip' => $this->input->post('nip'),
			'status_direktur' => $this->input->post('status_direktur')
		);
		return $this->db->insert('ol_direktur', $data_pendaftaran);
	}
	function edit_direktur(){
		$id_direktur = $this->input->post('id_direktur');
		$data_pendaftaran = array(
			'jk' => $this->input->post('jk'),
			'nama_direktur' => $this->input->post('nama_direktur'),
			'id_status_pegawai' => $this->input->post('id_status_pegawai'),
			'id_instansi' => $this->input->post('id_instansi'),
			'nip' => $this->input->post('nip'),
			'status_direktur' => $this->input->post('status_direktur')
		);
		$this->db->where('id_direktur',$id_direktur);
		$this->db->update('ol_direktur', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
}