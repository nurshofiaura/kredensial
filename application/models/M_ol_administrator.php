<?php
class M_ol_administrator extends CI_model{
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
	function pengurus_all($id)
	{
		$ids = explode(',', $id);
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "if(op.id_cabang = '','PARENT',ope.nama_pengcab) as cabang,op.id_pengcab,op.nama_pengcab,kk.nama_kab,op.alamat_pengcab,op.kontak_pengcab,op.email_pengcab,op.kop_pengcab,op.stempel_pengcab,op.barcode_pengcab
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
				$this->db->where_in('op.id_pengcab',$ids);

			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_pengcab op');
		$this->db->join('kol_provinsi kp', 'kp.id_prov=op.id_prov','left');
		$this->db->join('kol_kabupaten kk', 'kk.id_kab=op.id_kab','left');
		$this->db->join('ol_pengcab ope', 'ope.id_pengcab=op.id_cabang','left');
		$this->db->where_in('op.id_pengcab',$ids);

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
				$this->db->where_in('op.id_pengcab',$ids);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
		$this->db->from('ol_pengcab op');
		$this->db->join('kol_provinsi kp', 'kp.id_prov=op.id_prov','left');
		$this->db->join('kol_kabupaten kk', 'kk.id_kab=op.id_kab','left');
		$this->db->join('ol_pengcab ope', 'ope.id_pengcab=op.id_cabang','left');
				$this->db->where_in('op.id_pengcab',$ids);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
//		if($id == 0){
	 		$kondisi=array('id_jabatan'=>$this->session->id_jabatan);
			$jml = $this->m_umum->jumlah_record_filter('ol_pengcab',$kondisi);
/*		}else{
			$jml = $this->m_umum->jumlah_record_tabel('ol_status_pegawai');	
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
	function edit_ol_pengcab($id){
		$id_pengcab = $this->input->post('id_pengcab');
		if(empty($id)){
			$data_pendaftaran = array(
			'nama_pengcab' => $this->input->post('nama_pengcab'),
			'email_pengcab' => $this->input->post('email_pengcab'),
			'kontak_pengcab' => $this->input->post('kontak_pengcab'),
			'alamat_pengcab' => $this->input->post('alamat_pengcab'),
			'id_prov' => $this->input->post('id_prov'),
			'id_kab' => $this->input->post('id_kab')
			);
		}else{
			$user_pic=$this->m_umum->ambil_data('ol_pengcab','id_pengcab',$id_pengcab);
			if(!empty($user_pic['kop_pengcab'])){
				$cek_file=FCPATH.'assets/berkas/kop/'.$user_pic['kop_pengcab'];
				if(file_exists($cek_file)){
					unlink(FCPATH."assets/berkas/kop/".$user_pic['kop_pengcab']);
				}
			}
			$data_pendaftaran = array(
			'nama_pengcab' => $this->input->post('nama_pengcab'),
			'email_pengcab' => $this->input->post('email_pengcab'),
			'kontak_pengcab' => $this->input->post('kontak_pengcab'),
			'alamat_pengcab' => $this->input->post('alamat_pengcab'),
			'id_prov' => $this->input->post('id_prov'),
			'id_kab' => $this->input->post('id_kab'),
			'kop_pengcab' => $id
			);
		}
		$this->db->where('id_pengcab',$id_pengcab);
		$this->db->update('ol_pengcab', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function edit_stempel_pengcab($id){
		$id_pengcab = $this->input->post('id_pengcab');
		if(empty($id)){
			$data_pendaftaran = array(
			'nama_pengcab' => $this->input->post('nama_pengcab'),
			'email_pengcab' => $this->input->post('email_pengcab'),
			'kontak_pengcab' => $this->input->post('kontak_pengcab'),
			'alamat_pengcab' => $this->input->post('alamat_pengcab'),
			'id_prov' => $this->input->post('id_prov'),
			'id_kab' => $this->input->post('id_kab')
			);
		}else{
			$user_pic=$this->m_umum->ambil_data('ol_pengcab','id_pengcab',$id_pengcab);
			if(!empty($user_pic['stempel_pengcab'])){
				$cek_file=FCPATH.'assets/berkas/kop/'.$user_pic['stempel_pengcab'];
				if(file_exists($cek_file)){
					unlink(FCPATH."assets/berkas/kop/".$user_pic['stempel_pengcab']);
				}
			}
			$data_pendaftaran = array(
			'nama_pengcab' => $this->input->post('nama_pengcab'),
			'email_pengcab' => $this->input->post('email_pengcab'),
			'kontak_pengcab' => $this->input->post('kontak_pengcab'),
			'alamat_pengcab' => $this->input->post('alamat_pengcab'),
			'id_prov' => $this->input->post('id_prov'),
			'id_kab' => $this->input->post('id_kab'),
			'stempel_pengcab' => $id
			);
		}
		$this->db->where('id_pengcab',$id_pengcab);
		$this->db->update('ol_pengcab', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function pengurusan_all($ids)
	{		
		$pengurus_barcodepengcab = $this->m_ol_rancak->jumlah_akses_pengurus_barcodepengcab($this->session->id_pegawai,$ids);
		if($pengurus_barcodepengcab == 0){
			$id = '0';
		}else{
			$id = $ids;
		}
	//	$jml = $this->jumlah_akses_pengcab($id);
		$ide = explode(',', $ids);
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
				//	 case 'nama_pengcab' : $nmf="op.nama_pengcab";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}		
				$this->db->or_like($nmf, $cari['value'],'both',false);				
				$this->db->where_in('ol_pengcab.id_pengcab',$ide);	
				$this->db->where("ol_pengurus.id_ms_pengurus >", '1');		
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_pengurus');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pengurus.id_pengcab','left');
		$this->db->join('kol_ms_pengurus', 'kol_ms_pengurus.id_ms_pengurus=ol_pengurus.id_ms_pengurus','left');			
				$this->db->where_in('ol_pengcab.id_pengcab',$ide);		
				$this->db->where("ol_pengurus.id_ms_pengurus >", '1');	

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
				$this->db->where_in('ol_pengcab.id_pengcab',$ide);	
				$this->db->where("ol_pengurus.id_ms_pengurus >", '1');	

			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
		$this->db->from('ol_pengurus');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pengurus.id_pengcab','left');
		$this->db->join('kol_ms_pengurus', 'kol_ms_pengurus.id_ms_pengurus=ol_pengurus.id_ms_pengurus','left');				
				$this->db->where_in('ol_pengcab.id_pengcab',$ide);		
				$this->db->where("ol_pengurus.id_ms_pengurus >", '1');	

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
		$jml = $this->m_umum->jumlah_record_tabel('ol_pengurus');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
    function jumlah_akses_pengcab($id)    //igd.php untuk menampilkan jumlah antrian di igd saja
    {
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pengurus.id_pengcab','left');		
				$this->db->where("barcode_pengcab", $id);	

        $query = $this->db->select("COUNT(*) as num")->get_where('ol_pengurus',array('status_pengcab'=>1));
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
    }
	function simpan_ol_pengurus(){
		$chk = $this->input->post('chk[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				$this->db->select("COUNT(*) as num");
				$this->db->where('id_ms_pengurus', $chk[$i]);
				$this->db->where('id_pengcab',$this->input->post('id_pengcab'));
				$q = $this->db->get('ol_pengurus')->row();
				$jml = $q->num;
				if($jml == 0){
					$kode = $this->m_rancak->kode_generator(15,'');
					$data_pendaftaran = array(
						'id_ms_pengurus' => $chk[$i],
						'barcode_pengurus' => $kode,
						'id_pengcab' =>  $this->input->post('id_pengcab')
					);
					$this->db->insert('ol_pengurus', $data_pendaftaran);
				}
			}
		}
	}
	function edit_ol_pengurus(){
		$id_pengurus = $this->input->post('id_pengurus');
		$data_kewenangan_detil = array(
			'id_ms_pengurus' => $this->input->post('id_ms_pengurus'),
			'status_pengurus' => $this->input->post('status_pengurus')
		);
		$this->db->where('id_pengurus',$id_pengurus);
		$this->db->update('ol_pengurus', $data_kewenangan_detil);
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
	function pegawai_pengurus_all($ids)
	{
		$pengurus_barcodepengcab = $this->m_ol_rancak->jumlah_akses_pengurus_barcodepengcab($this->session->id_pegawai,$ids);
		if($pengurus_barcodepengcab == 0){
			$id = '0';
		}else{
			$id = $ids;
		}
		$jml = $this->jumlah_akses_pengurus($id);
		$ide = explode(',', $ids);
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
				$this->db->where_in('ol_pengcab.id_pengcab',$ide);	
		//		$this->db->where("barcode_pengcab", $id);	
				$this->db->where("ol_pengurus.id_ms_pengurus >", '1');	
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_pegawai_pengurus');
		$this->db->join('ol_pengurus', 'ol_pengurus.id_pengurus=ol_pegawai_pengurus.id_pengurus','left');
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_pegawai_pengurus.id_pegawai','left');
		$this->db->join('kol_ms_pengurus', 'kol_ms_pengurus.id_ms_pengurus=ol_pengurus.id_ms_pengurus','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pengurus.id_pengcab','left');
		$this->db->where_in('ol_pengcab.id_pengcab',$ide);			
	//	$this->db->where("barcode_pengcab", $id);	
		$this->db->where("ol_pengurus.id_ms_pengurus >", '1');	

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
				$this->db->where_in('ol_pengcab.id_pengcab',$ide);			
			//	$this->db->where("barcode_pengcab", $id);	
				$this->db->where("ol_pengurus.id_ms_pengurus >", '1');	

			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
		$this->db->from('ol_pegawai_pengurus');
		$this->db->join('ol_pengurus', 'ol_pengurus.id_pengurus=ol_pegawai_pengurus.id_pengurus','left');
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_pegawai_pengurus.id_pegawai','left');
		$this->db->join('kol_ms_pengurus', 'kol_ms_pengurus.id_ms_pengurus=ol_pengurus.id_ms_pengurus','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pengurus.id_pengcab','left');
		$this->db->where_in('ol_pengcab.id_pengcab',$ide);				
		//		$this->db->where("barcode_pengcab", $id);	
				$this->db->where("ol_pengurus.id_ms_pengurus >", '1');	

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
//		if($id == 0){
	 	//	$kondisi=array('id_jabatan'=>$this->session->id_jabatan);
		//	$jml = $this->jumlah_akses_pengurus($id,$eimplo);
/*		}else{
			$jml = $this->m_umum->jumlah_record_tabel('ol_status_pegawai');	
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
    function jumlah_akses_pengurus($id)    //igd.php untuk menampilkan jumlah antrian di igd saja
    {
		$this->db->join('ol_pengurus', 'ol_pengurus.id_pengurus=ol_pegawai_pengurus.id_pengurus','left');
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_pegawai_pengurus.id_pegawai','left');
		$this->db->join('kol_ms_pengurus', 'kol_ms_pengurus.id_ms_pengurus=ol_pengurus.id_ms_pengurus','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pengurus.id_pengcab','left');
					
				$this->db->where("barcode_pengcab", $id);	
				$this->db->where("ol_pengurus.id_ms_pengurus >", '1');	

        $query = $this->db->select("COUNT(*) as num")->get_where('ol_pegawai_pengurus',array('status_pegawai_pengurus'=>1,'status_pengurus'=>1,'status_pengcab'=>1,'status_ms_pengurus'=>1));
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
    }
	function simpan_ol_pegawai_pengurus(){
		$kode = $this->m_rancak->kode_generator(15,'');
		$data_kewenangan = array(
		'id_pegawai' => $this->input->post('id_pegawai'),
		'id_pengurus' => $this->input->post('id_pengurus'),
		'barcode_pegawai_pengurus' => $kode
		);
		return $this->db->insert('ol_pegawai_pengurus', $data_kewenangan);
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
	function edit_pegawai_pengurus(){
		$id_pegawai_pengurus = $this->input->post('id_pegawai_pengurus');
		$data_pendaftaran = array(
		'id_pegawai' => $this->input->post('id_pegawai'),
		'id_pengurus' => $this->input->post('id_pengurus'),
		'status_pegawai_pengurus' => $this->input->post('status_pegawai_pengurus')
		);
		$this->db->where('id_pegawai_pengurus',$id_pegawai_pengurus);
		$this->db->update('ol_pegawai_pengurus', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function kor_detil_all($id,$eimplo)
	{
		// $jml = $this->jumlah_akses_pengurus($id);
		$ide = explode(',', $eimplo);
		$fields = "*,if(wkt_korespodensi = '' ,'Belum Ada Tanggal',DATE_FORMAT(wkt_korespodensi,'%d-%m-%Y')) as wkt_korespodensi
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
	//	$this->db->where('ok.status_korespodensi <',3);
		$this->db->group_start();
		$this->db->where_in('okk.pengcab_asal',$ide);
		$this->db->or_where_in('okk.pengcab_tujuan', $ide);
		$this->db->group_end();
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_korespodensi ok');
		$this->db->join('ol_kor_kategori okk', 'okk.id_korespodensi=ok.id_korespodensi','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=okk.pengcab_asal','left');
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ok.id_pengirim','left');	
	//	$this->db->where('ok.status_korespodensi <',3);
		$this->db->group_start();
		$this->db->where_in('okk.pengcab_asal',$ide);
		$this->db->or_where_in('okk.pengcab_tujuan', $ide);
		$this->db->group_end();


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
	//	$this->db->where('ok.status_korespodensi <',3);
		$this->db->group_start();
		$this->db->where_in('okk.pengcab_asal',$ide);
		$this->db->or_where_in('okk.pengcab_tujuan', $ide);
		$this->db->group_end();


			}
		  }
		}

		$this->db->from('ol_korespodensi ok');
		$this->db->join('ol_kor_kategori okk', 'okk.id_korespodensi=ok.id_korespodensi','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=okk.pengcab_asal','left');
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ok.id_pengirim','left');	
	//	$this->db->where('ok.status_korespodensi <',3);
		$this->db->group_start();
		$this->db->where_in('okk.pengcab_asal',$ide);
		$this->db->or_where_in('okk.pengcab_tujuan', $ide);
		$this->db->group_end();

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
//		if($id == 0){
	 	//	$kondisi=array('id_jabatan'=>$this->session->id_jabatan);
		//	$jml = $this->jumlah_akses_pengurus($id,$eimplo);
/*		}else{
			$jml = $this->m_umum->jumlah_record_tabel('ol_status_pegawai');	
		}*/
		$jml = $this->m_umum->jumlah_record_tabel('ol_korespodensi');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function rubah_status_korespodensi($id,$isi){
		$data_pendaftaran = array(
			'status_korespodensi' => $isi
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
	function rubah_kor_print(){
		$id_kor_print = $this->input->post('id_kor_print');
		$tgl_awal = $this->input->post('tgl_awal');
		$tgl_awal = date('Y-m-d', strtotime($tgl_awal));
		$tgl_akhir = $this->input->post('tgl_akhir');
		$tgl_akhir = date('Y-m-d', strtotime($tgl_akhir));
		$tgl_kor_print = $this->input->post('tgl_kor_print');
		$tgl_kor_print = date('Y-m-d', strtotime($tgl_kor_print));
		$data_pendaftaran = array(
			'title_kor_print' => $this->input->post('title_kor_print'),
			'font_size' => $this->input->post('font_size'),
			'tmp_kor_print' => $this->input->post('tmp_kor_print'),
			'modul' => $this->input->post('modul'),
			'tmp_modul' => $this->input->post('tmp_modul'),
			'no_kor_print' => $this->input->post('no_kor_print'),
			'tgl_awal' => $tgl_awal,
			'tgl_akhir' => $tgl_akhir,
			'tgl_kor_print' => $tgl_kor_print
		);
		$this->db->where('id_kor_print',$id_kor_print);
		$this->db->update('ol_kor_print', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}
	function simpan_kor_detil(){
		$id_korespodensi = $this->input->post('id_korespodensi');
		$id_kategori = $this->input->post('id_kategori');
		$chk = $this->input->post('chk[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				$this->simpan_kor_ttd($chk[$i],$id_kategori,$id_korespodensi);
			}
		}
	}
	function simpan_kor_detil_pegawai(){
		$id_korespodensi = $this->input->post('id_korespodensi');
		$id_kategori = $this->input->post('id_kategori');
		$chk = $this->input->post('chk[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				$this->db->select("COUNT(*) as num");
				$this->db->where('id_korespodensi', $id_korespodensi);
				$this->db->where('id_pegawai_pengurus',$chk[$i]);
				$q = $this->db->get('ol_kor_detil')->row();
				$jmlx = $q->num;
				if($jmlx == 0){
					$data_pendaftaran2 = array(
						'id_korespodensi' => $id_korespodensi,
						'id_pegawai' => 0,
						'id_pegawai_pengurus' => $chk[$i]
					);
					$this->db->insert('ol_kor_detil', $data_pendaftaran2);
				}
			}
		}
	}
	function simpan_kor_ttd($id,$id_kategori,$id_korespodensi){
		$d	= $this->m_umum->ambil_data('ol_surat_kategori','id_kategori',$id_kategori);
		$bookseat = explode(',', $d['ttd_kategori']);
		for($i = 0; $i < count($bookseat); ++$i){
			$jml = $this->m_ol_rancak->jumlah_data_pegawai_pengurus_pengcab_4_saving($id,$bookseat[$i]);// $id = id_pengcab, $bookseat = id_ms_pengurus
			if($jml > 0){
				$pp = $this->m_ol_rancak->ambil_data_pegawai_pengurus_pengcab_4_saving($id,$bookseat[$i]);// $id = id_pengcab, $bookseat = id_ms_pengurus
				$this->db->select("COUNT(*) as num");
				$this->db->where('id_korespodensi', $id_korespodensi);
				$this->db->where('id_pegawai_pengurus',$pp['id_pegawai_pengurus']);
				$q = $this->db->get('ol_kor_detil')->row();
				$jmlx = $q->num;
				if($jmlx == 0){
					$data_pendaftaran2 = array(
						'id_korespodensi' => $id_korespodensi,
						'id_pegawai' => 0,
						'id_pegawai_pengurus' =>  $pp['id_pegawai_pengurus']
					);
					$this->db->insert('ol_kor_detil', $data_pendaftaran2);
				}
			}
		}
	}
	function rubah_ttd_surat_kategori(){
		$id_kategori = $this->input->post('id_kategori');
		$chk = $this->input->post('chk');
		$eimplo = implode(",",$chk);		
		$data_pendaftaran = array(
			'ttd_kategori' => $eimplo
		);
		$this->db->where('id_kategori',$id_kategori);
		$this->db->update('ol_surat_kategori', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function rubah_data_surat_korespodensi(){
		$id_korespodensi = $this->input->post('id_korespodensi');
		$data_pendaftaran = array(
			'no_korespodensi' => $this->input->post('no_korespodensi'),
			'sifat_surat' => $this->input->post('sifat_surat')
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
	function registrasi_all($id)
	{
	$wordsAry = explode("-", $id);
	$wordsCount = count($wordsAry);
	$ide = explode(',', $this->session->list_pengcab);
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
				$this->db->where_in('or.id_pengcab',$ide);
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
		$this->db->where_in('or.id_pengcab',$ide);
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
				$this->db->where_in('or.id_pengcab',$ide);
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
		$this->db->where_in('or.id_pengcab',$ide);
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
	function member_all($eimplo,$id)
	{
	$idx = explode(',', $eimplo);
	$wordsAry = explode("-", $id);
	$wordsCount = count($wordsAry);
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,if(status_perawat = 0,'Non Keperawatan',nama_kode_kewenangan) as nama_kode_kewenangan,
					if (jk = '1' ,'Laki-laki','Perempuan') as jk,
					if (status_pegawai = '1' ,'AKTIF','NON AKTIF') as status_pegawai,
					CONCAT(tmp_lahir,' - ',DATE_FORMAT(tgl_lahir,'%d-%m-%Y'),' / ',(TIMESTAMPDIFF( YEAR, tgl_lahir, now() )), ' Tahun ',
					TIMESTAMPDIFF( MONTH, tgl_lahir, now() ) % 12, ' Bulan ',
					FLOOR( TIMESTAMPDIFF( DAY, tgl_lahir, now() ) % 30.4375 ), ' Hari') as umur
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
				$this->db->where_in("op.id_pengcab",$idx);
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

		$this->db->from('ol_pegawai op');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=op.id_status_kawin','left');
		$this->db->join('kol_agama kag', 'kag.id_agama=op.id_agama','left');
		$this->db->join('kol_pendidikan kp', 'kp.id_pendidikan=op.id_pendidikan','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=op.id_jabatan_fungsional','left');
		$this->db->join('ol_status_pegawai osp', 'osp.id_status_pegawai=op.tipe_pegawai','left');
		$this->db->join('kol_kode_kewenangan kkk', 'kkk.id_kode_kewenangan=op.id_kode_kewenangan','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=op.id_pengcab','left');
		$this->db->where_in("op.id_pengcab",$idx);
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
				$this->db->where_in("op.id_pengcab",$idx);
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

		$this->db->from('ol_pegawai op');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=op.id_status_kawin','left');
		$this->db->join('kol_agama kag', 'kag.id_agama=op.id_agama','left');
		$this->db->join('kol_pendidikan kp', 'kp.id_pendidikan=op.id_pendidikan','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=op.id_jabatan_fungsional','left');
		$this->db->join('ol_status_pegawai osp', 'osp.id_status_pegawai=op.tipe_pegawai','left');
		$this->db->join('kol_kode_kewenangan kkk', 'kkk.id_kode_kewenangan=op.id_kode_kewenangan','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=op.id_pengcab','left');
				$this->db->where_in("op.id_pengcab",$idx);
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
			'id_pengcab' => $this->input->post('id_pengcab'),
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
}