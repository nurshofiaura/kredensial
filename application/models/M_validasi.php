<?php
class M_validasi extends CI_model{
/*
	function pengajuan_berkas_edit_setuju(){
		$barcode_pengajuan = $this->input->post('barcode_pengajuan');
		$data_pendaftaran = array(
			'validasi_asesor' => 1,
			'tgl_asesor_pengajuan' => date('Y-m-d H:i:s'),
			'id_asesor_pengajuan' => $this->session->id_pegawai,
			'ket_pengajuan' => $this->input->post('ket_pengajuan')
		);
		$this->db->where('barcode_pengajuan',$barcode_pengajuan);
		$this->db->update('ol_pengajuan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function pengajuan_berkas_edit_tolak(){
		$barcode_pengajuan = $this->input->post('barcode_pengajuan');
		$data_pendaftaran = array(
			'validasi_asesor' => 2,
			'tgl_asesor_pengajuan' => date('Y-m-d H:i:s'),
			'id_asesor_pengajuan' => $this->session->id_pegawai,
			'ket_pengajuan' => $this->input->post('ket_pengajuan')
		);
		$this->db->where('barcode_pengajuan',$barcode_pengajuan);
		$this->db->update('ol_pengajuan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function pengajuan_validasi_berkas_edit_setuju(){
		$barcode_pengajuan = $this->input->post('barcode_pengajuan');
		$barcode_form = $this->input->post('barcode_form');
		$data_pendaftaran = array(
			'validasi' => 1,
			'tgl_asesor' => date('Y-m-d H:i:s'),
			'id_asesor' => $this->session->id_pegawai,
			'ket_pengajuan_validasi' => $this->input->post('ket_pengajuan_validasi')
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
	function pengajuan_validasi_berkas_edit_tolak(){
		$barcode_pengajuan = $this->input->post('barcode_pengajuan');
		$barcode_form = $this->input->post('barcode_form');
		$data_pendaftaran = array(
			'validasi' => 2,
			'tgl_asesor' => date('Y-m-d H:i:s'),
			'id_asesor' => $this->session->id_pegawai,
			'ket_pengajuan_validasi' => $this->input->post('ket_pengajuan_validasi')
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
*/
	function edit_signature_pegawai($pic){
		$id_pegawai = $this->input->post('id_pegawai');
		$data_pendaftaran = array(
			'ttd_pegawai' =>$pic
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
	function pengajuan_kompetensi_all($id)
	{
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
		$this->db->where('npvl.id_asesor', $this->session->id_pegawai);
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

		$this->db->from('nkr_pengajuan_validator npvl');
		$this->db->join('ol_pengajuan ok', 'ok.barcode_pengajuan=npvl.barcode_pengajuan','left');
		$this->db->join('ol_status_diusulkan okk', 'okk.id_status_diusulkan=ok.id_status_diusulkan','left');
		$this->db->join('ol_pegawai op', 'op.barcode_pegawai=ok.barcode_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=op.id_jabatan_fungsional','left');
		$this->db->join('kol_working kw', 'kw.id_working=ok.id_instansi','left');
	//	$this->db->where("FIND_IN_SET(".$this->session->id_pegawai.",pegawai_pengajuan)!=",0);
		$this->db->where('npvl.id_asesor', $this->session->id_pegawai);
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
		$this->db->where('npvl.id_asesor', $this->session->id_pegawai);
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

		$this->db->from('nkr_pengajuan_validator npvl');
		$this->db->join('ol_pengajuan ok', 'ok.barcode_pengajuan=npvl.barcode_pengajuan','left');
		$this->db->join('ol_status_diusulkan okk', 'okk.id_status_diusulkan=ok.id_status_diusulkan','left');
		$this->db->join('ol_pegawai op', 'op.barcode_pegawai=ok.barcode_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=op.id_jabatan_fungsional','left');
		$this->db->join('kol_working kw', 'kw.id_working=ok.id_instansi','left');
	//	$this->db->where("FIND_IN_SET(".$this->session->id_pegawai.",pegawai_pengajuan)!=",0);
		$this->db->where('npvl.id_asesor', $this->session->id_pegawai);
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
	function pengajuan_validasi_berkas_locked($val){
		$kesesuaian_bukti = $this->input->post('kesesuaian_bukti[]');
		if (empty($kesesuaian_bukti)) {
		   $chkkesesuaian_bukti = "";
		}else{
			$chkkesesuaian_bukti = implode(",",$kesesuaian_bukti);
		}
		$kode = $this->m_rancak->kode_generator(15,'PV');
		$kodeurut = $this->m_rancak->kode_generator_urut(15,'ID');
		$data_pendaftaran2 = array(
			'kesesuaian_bukti_validasi' => $chkkesesuaian_bukti,
			'id_kompetensi' => $this->input->post('id_kompetensi'),
			'id_instansi' => $this->input->post('id_instansi'),
			'id_jenis_form' => $this->input->post('id_jenis_form'),
			'barcode_form' => $this->input->post('barcode_form'),
			'barcode_pengajuan' => $this->input->post('barcode_pengajuan'),
			'barcode_pengajuan_validasi' =>  $kode,
			'id_pengajuan_validasi' =>  $kodeurut,
			'ket_pengajuan_validasi' => $this->input->post('ket_pengajuan_validasi'),
			'locked' => 1,
			'validasi' => $val,
			'tgl_asesor' => date('Y-m-d H:i:s'),
			'id_asesor' =>  $this->session->id_pegawai
		);
		$this->db->insert('nkr_pengajuan_validasi', $data_pendaftaran2);
		return $kode;
	}
	function pengajuan_validasi_berkas_edit_locked($val,$id,$lock){
		$barcode_pengajuan = $this->input->post('barcode_pengajuan');
		$id_jenis_form = $this->input->post('id_jenis_form');
		$id_kompetensi = $this->input->post('id_kompetensi');
		$id_instansi = $this->input->post('id_instansi');
		$kesesuaian_bukti = $this->input->post('kesesuaian_bukti[]');
		if (empty($kesesuaian_bukti)) {
		   $chkkesesuaian_bukti = "";
		}else{
			$chkkesesuaian_bukti = implode(",",$kesesuaian_bukti);
		}
		$data_pendaftaran = array(
			'kesesuaian_bukti_validasi' => $chkkesesuaian_bukti,
			'locked' => $lock,
			'validasi' => $val,
			'ket_pengajuan_validasi' => $this->input->post('ket_pengajuan_validasi')
		);
		$this->db->where('barcode_pengajuan',$barcode_pengajuan);
		$this->db->where('id_jenis_form',$id_jenis_form);
		$this->db->where('id_kompetensi',$id_kompetensi);
		$this->db->where('id_instansi',$id_instansi);
		$this->db->where('id_asesor',$id);
		$this->db->update('nkr_pengajuan_validasi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function pengajuan_validasi_aktifasi_soal($val){
		$kesesuaian_bukti = $this->input->post('kesesuaian_bukti[]');
		if (empty($kesesuaian_bukti)) {
		   $chkkesesuaian_bukti = "";
		}else{
			$chkkesesuaian_bukti = implode(",",$kesesuaian_bukti);
		}
		$kode = $this->m_rancak->kode_generator(15,'PV');
		$kodeurut = $this->m_rancak->kode_generator_urut(15,'ID');
		$data_pendaftaran2 = array(
			'kesesuaian_bukti_validasi' => $chkkesesuaian_bukti,
			'id_kompetensi' => $this->input->post('id_kompetensi'),
			'id_instansi' => $this->input->post('id_instansi'),
			'id_jenis_form' => $this->input->post('id_jenis_form'),
			'barcode_form' => $this->input->post('barcode_form'),
			'barcode_pengajuan' => $this->input->post('barcode_pengajuan'),
			'barcode_pengajuan_validasi' =>  $kode,
			'id_pengajuan_validasi' =>  $kodeurut,
			'ket_pengajuan_validasi' => $this->input->post('ket_pengajuan_validasi'),
			'locked' => $val,
			'tgl_asesor' => date('Y-m-d H:i:s'),
			'id_asesor' =>  $this->session->id_pegawai
		);
		$this->db->insert('nkr_pengajuan_validasi', $data_pendaftaran2);
		return $kode;
	}
	function pengajuan_validasi_berkas_simpan($val){
		$kesesuaian_bukti = $this->input->post('kesesuaian_bukti[]');
		if (empty($kesesuaian_bukti)) {
		   $chkkesesuaian_bukti = "";
		}else{
			$chkkesesuaian_bukti = implode(",",$kesesuaian_bukti);
		}
		$kode = $this->m_rancak->kode_generator(15,'PV');
		$kodeurut = $this->m_rancak->kode_generator_urut(15,'ID');
		$data_pendaftaran2 = array(
			'kesesuaian_bukti_validasi' => $chkkesesuaian_bukti,
			'id_kompetensi' => $this->input->post('id_kompetensi'),
			'id_instansi' => $this->input->post('id_instansi'),
			'id_jenis_form' => $this->input->post('id_jenis_form'),
			'barcode_form' => $this->input->post('barcode_form'),
			'barcode_pengajuan' => $this->input->post('barcode_pengajuan'),
			'barcode_pengajuan_validasi' =>  $kode,
			'id_pengajuan_validasi' =>  $kodeurut,
			'ket_pengajuan_validasi' => $this->input->post('ket_pengajuan_validasi'),
			'validasi' => $val,
			'tgl_asesor' => date('Y-m-d H:i:s'),
			'id_asesor' =>  $this->session->id_pegawai
		);
		$this->db->insert('nkr_pengajuan_validasi', $data_pendaftaran2);
		return $kode;
	}
	function pengajuan_validasi_berkas_edit($val,$id){
		$barcode_pengajuan = $this->input->post('barcode_pengajuan');
		$id_jenis_form = $this->input->post('id_jenis_form');
		$id_kompetensi = $this->input->post('id_kompetensi');
		$id_instansi = $this->input->post('id_instansi');
		$kesesuaian_bukti = $this->input->post('kesesuaian_bukti[]');
		if (empty($kesesuaian_bukti)) {
		   $chkkesesuaian_bukti = "";
		}else{
			$chkkesesuaian_bukti = implode(",",$kesesuaian_bukti);
		}
		$data_pendaftaran = array(
			'kesesuaian_bukti_validasi' => $chkkesesuaian_bukti,
			'validasi' => $val,
			'ket_pengajuan_validasi' => $this->input->post('ket_pengajuan_validasi')
		);
		$this->db->where('barcode_pengajuan',$barcode_pengajuan);
		$this->db->where('id_jenis_form',$id_jenis_form);
		$this->db->where('id_kompetensi',$id_kompetensi);
		$this->db->where('id_instansi',$id_instansi);
		$this->db->where('id_asesor',$id);
		$this->db->update('nkr_pengajuan_validasi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function pengajuan_validasi_banding_berkas_simpan($val,$id){
		$data_pendaftaran = array(
			'validasi' => $val,
			'locked' => 3
		);
		$this->db->where('barcode_pengajuan_validasi',$id);
		$this->db->update('nkr_pengajuan_validasi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function pengajuan_validasi_banding_berkas_simpan_locked($val){
		$kesesuaian_bukti = $this->input->post('kesesuaian_bukti[]');
		if (empty($kesesuaian_bukti)) {
		   $chkkesesuaian_bukti = "";
		}else{
			$chkkesesuaian_bukti = implode(",",$kesesuaian_bukti);
		}
		$bpve = $this->m_umum->ambil_data('nkr_pengajuan_validasi','barcode_pengajuan_validasi',$this->input->post('banding_form'));
		$kode = $this->m_rancak->kode_generator(15,'PV');
		$kodeurut = $this->m_rancak->kode_generator_urut(15,'ID');
		$data_pendaftaran2 = array(
			'kesesuaian_bukti_validasi' => $chkkesesuaian_bukti,
			'id_kompetensi' => $this->input->post('id_kompetensi'),
			'id_instansi' => $this->input->post('id_instansi'),
			'id_jenis_form' => $this->input->post('id_jenis_form'),
			'banding_form' => $bpve['id_jenis_form'],
			'barcode_form' => $this->input->post('barcode_form'),
			'barcode_pengajuan' => $this->input->post('barcode_pengajuan'),
			'barcode_pengajuan_validasi' =>  $kode,
			'id_pengajuan_validasi' =>  $kodeurut,
			'ket_pengajuan_validasi' => $this->input->post('ket_pengajuan_validasi'),
			'locked' => $val,
			'tgl_asesor' => date('Y-m-d H:i:s'),
			'id_asesor' =>  $this->session->id_pegawai
		);
		$this->db->insert('nkr_pengajuan_validasi', $data_pendaftaran2);
		return $kode;
	}
	function pengajuan_validasi_banding_locked_berkas_edit($id){
		$banding_form_lama = $this->input->post('banding_form_lama');
		$banding_form = $this->input->post('banding_form');
		$barcode_pengajuan = $this->input->post('barcode_pengajuan');
		$id_jenis_form = $this->input->post('id_jenis_form');
		$id_kompetensi = $this->input->post('id_kompetensi');
		$id_instansi = $this->input->post('id_instansi');
		$kesesuaian_bukti = $this->input->post('kesesuaian_bukti[]');
		if (empty($kesesuaian_bukti)) {
		   $chkkesesuaian_bukti = "";
		}else{
			$chkkesesuaian_bukti = implode(",",$kesesuaian_bukti);
		}
		if (empty($banding_form)) {
		   $banding_form_last = $banding_form_lama;
		}else{
			$bpve = $this->m_umum->ambil_data('nkr_pengajuan_validasi','barcode_pengajuan_validasi',$this->input->post('banding_form'));
			$banding_form_last = $bpve['id_jenis_form'];
		}
		$data_pendaftaran = array(
			'kesesuaian_bukti_validasi' => $chkkesesuaian_bukti,
			'banding_form' => $banding_form_last,
			'ket_pengajuan_validasi' => $this->input->post('ket_pengajuan_validasi')
		);
		$this->db->where('barcode_pengajuan_validasi',$id);
		$this->db->update('nkr_pengajuan_validasi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function pengajuan_validasi_banding_berkas_edit($val,$id){
		$banding_form_lama = $this->input->post('banding_form_lama');
		$banding_form = $this->input->post('banding_form');
		$barcode_pengajuan = $this->input->post('barcode_pengajuan');
		$id_jenis_form = $this->input->post('id_jenis_form');
		$id_kompetensi = $this->input->post('id_kompetensi');
		$id_instansi = $this->input->post('id_instansi');
		$kesesuaian_bukti = $this->input->post('kesesuaian_bukti[]');
		if (empty($kesesuaian_bukti)) {
		   $chkkesesuaian_bukti = "";
		}else{
			$chkkesesuaian_bukti = implode(",",$kesesuaian_bukti);
		}
		if (empty($banding_form)) {
		   $banding_form_last = $banding_form_lama;
		}else{
			$bpve = $this->m_umum->ambil_data('nkr_pengajuan_validasi','barcode_pengajuan_validasi',$this->input->post('banding_form'));
			$banding_form_last = $bpve['id_jenis_form'];
		}
		$data_pendaftaran = array(
			'kesesuaian_bukti_validasi' => $chkkesesuaian_bukti,
			'validasi' => $val,
			'banding_form' => $banding_form_last,
			'ket_pengajuan_validasi' => $this->input->post('ket_pengajuan_validasi')
		);
		$this->db->where('barcode_pengajuan',$barcode_pengajuan);
		$this->db->where('id_jenis_form',$id_jenis_form);
		$this->db->where('id_kompetensi',$id_kompetensi);
		$this->db->where('id_instansi',$id_instansi);
		$this->db->where('id_asesor',$id);
		$this->db->update('nkr_pengajuan_validasi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function simpan_question_validasi($id){
		$chk = $this->input->post('chk[]');
		$no_urut_detil = $this->input->post('no_urut_detil[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
			$kode = $this->m_rancak->kode_generator(15,'QD');
			$kodeid = $this->m_rancak->kode_generator_urut(15,'');
			$akhirkode = $kodeid .'-'. $chk[$i];
			$temp = $this->ambil_data_nkr_question($chk[$i]);
/*			$this->simpan_nkr_question_validasi($chk[$i]);
			$kondisi=array('id_question'=>$chk[$i]);
			$jml = $this->m_umum->jumlah_record_filter('nkr_question_validasi',$kondisi);
			if($jml == 0){
				$this->simpan_nkr_question_validasi($chk[$i]);				
			}else{
				$this->edit_nkr_question_validasi($chk[$i]);
			}*/
				$data_pendaftaran = array(
					'id_validasi_detil' => $kodeid,
					'no_urut_detil' => $no_urut_detil[$i],
					'id_question' => $chk[$i],
					'nama_question' => $temp['nama_question'],
					'id_asesmen' => $temp['id_asesmen'],
					'barcode_validasi_detil' => $kode,
     'pembuat_validasi_detil' => $this->session->barcode_pegawai,
     'instansi_validasi_detil' => $this->session->barcode_working,
					'barcode_pengajuan_validasi' => $id
				);
				$this->db->insert('nkr_validasi_detil', $data_pendaftaran);
			}
		}
	}
	function ambil_data_nkr_question($id){	
		$q = $this->db->get_where('nkr_question_f2',array('id_question'=>$id));	
		return $q->row_array();	
	}
	function simpan_nkr_question_validasi($id){
		$temp = $this->ambil_data_nkr_question($id);
	//	foreach($temp as $rowtemp){
			$kode = $this->m_rancak->kode_generator_urut(15,'IV');
			$data_pendaftaran = array(
				'id_question_validasi' => $kode,
				'id_question' => $temp['id_question'],
				'id_asesmen' => $temp['id_asesmen'],
				'nama_question' => $temp['nama_question'],
				'pembuat_question' => $temp['pembuat_question']
			);
			$this->db->insert('nkr_question_validasi', $data_pendaftaran);			
	//	}
	}
	function edit_nkr_question_validasi($id){
		$temp = $this->ambil_data_nkr_question($id);
		foreach($temp as $rowtemp){
			$data_pendaftaran = array(
				'id_asesmen' => $rowtemp['id_asesmen'],
				'nama_question' => $rowtemp['nama_question'],
				'pembuat_question' => $rowtemp['pembuat_question']
			);
			$this->db->where('id_question',$rowtemp['id_question']);
			$this->db->update('nkr_question_validasi', $data_pendaftaran);
			//echo $this->db->last_query();
			$this->db->trans_complete();	// untuk cek sukses update tidak
			if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
			// if (!$this->db->affected_rows()) 
				return(FALSE);
			else 
				return(TRUE);
		}	
	}
	function simpan_indikator_metode_perangkat_validasi($id){
		$chk = $this->input->post('chk[]');
		$no_urut_detil = $this->input->post('no_urut_detil[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
			$kode = $this->m_rancak->kode_generator(15,'QD');
			$kodeid = $this->m_rancak->kode_generator_urut(15,'');
			$akhirkode = $kodeid .'-'. $chk[$i];
			$temp = $this->ambil_data_nkr_indikator($chk[$i]);
/*			$this->simpan_nkr_indikator_validasi($chk[$i]);
			$kondisi=array('id_indikator'=>$chk[$i]);
//			$jml = $this->m_umum->jumlah_record_filter('nkr_indikator_validasi',$kondisi);
			$jml2 = $this->m_umum->jumlah_record_filter('nkr_soal_opsi_validasi',$kondisi);
			if($jml == 0){
				$this->simpan_nkr_indikator_validasi($chk[$i]);				
			}else{
				$this->edit_nkr_indikator_validasi($chk[$i]);
			}
			if($jml2 == 0){
				$this->simpan_soal_opsi_validasi($chk[$i]);				
			}else{
				$this->edit_soal_opsi_validasi($chk[$i]);
			}*/
				$data_pendaftaran = array(
					'id_validasi_detil' => $kodeid,
					'id_indikator' => $chk[$i],
					'no_urut_detil' => $no_urut_detil[$i],
					'barcode_validasi_detil' => $kode,
					'id_indikator' => $temp['id_indikator'],
					'id_asesmen' => $temp['id_asesmen'],
					'nama_indikator' => $temp['nama_indikator'],
					'perangkat_indikator' => $temp['perangkat_indikator'],
     'pembuat_validasi_detil' => $this->session->barcode_pegawai,
     'instansi_validasi_detil' => $this->session->barcode_working,
					'metode_indikator' => $temp['metode_indikator'],
					'barcode_pengajuan_validasi' => $id
				);
				$this->db->insert('nkr_validasi_detil', $data_pendaftaran);
			}
		}
	}
	function simpan_indikator_validasi($id){
		$chk = $this->input->post('chk[]');
		$no_urut_detil = $this->input->post('no_urut_detil[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
			$kode = $this->m_rancak->kode_generator(15,'QD');
			$kodeid = $this->m_rancak->kode_generator_urut(15,'');
			$akhirkode = $kodeid .'-'. $chk[$i];
			$temp = $this->ambil_data_nkr_indikator($chk[$i]);
		//	$this->simpan_nkr_indikator_validasi($chk[$i]);
				$data_pendaftaran = array(
					'id_validasi_detil' => $kodeid,
					'id_indikator' => $chk[$i],
					'no_urut_detil' => $no_urut_detil[$i],
					'barcode_validasi_detil' => $kode,
					'id_indikator' => $temp['id_indikator'],
					'id_asesmen' => $temp['id_asesmen'],
     'pembuat_validasi_detil' => $this->session->barcode_pegawai,
     'instansi_validasi_detil' => $this->session->barcode_working,
					'nama_indikator' => $temp['nama_indikator'],
					'poin_indikator' => $temp['poin_indikator'],
					'barcode_pengajuan_validasi' => $id
				);
				$this->db->insert('nkr_validasi_detil', $data_pendaftaran);
			}
		}
	}
 function simpan_indikator_validasi_dokumen($id){
  $chk = $this->input->post('chk[]');
  $no_urut_detil = $this->input->post('no_urut_detil[]');
  if($chk){
   $jml_kode = count($chk);
   for ($i=0;$i<$jml_kode;$i++){
   $kode = $this->m_rancak->kode_generator(15,'QD');
   $kodeid = $this->m_rancak->kode_generator_urut(15,'');
   $akhirkode = $kodeid .'-'. $chk[$i];
   $temp = $this->ambil_data_nkr_indikator($chk[$i]);
  // $this->simpan_nkr_indikator_validasi($chk[$i]);
    $data_pendaftaran = array(
     'id_validasi_detil' => $kodeid,
     'id_indikator' => $chk[$i],
     'no_urut_detil' => $no_urut_detil[$i],
     'barcode_validasi_detil' => $kode,
     'id_indikator' => $temp['id_indikator'],
     'id_asesmen' => $temp['id_asesmen'],
     'nama_indikator' => $temp['nama_indikator'],
     'pembuat_validasi_detil' => $this->session->barcode_pegawai,
     'instansi_validasi_detil' => $this->session->barcode_working,
     'dokumen_indikator' => $temp['dokumen_indikator'],
     'barcode_pengajuan_validasi' => $id
    );
    $this->db->insert('nkr_validasi_detil', $data_pendaftaran);
   }
  }
 }
	function simpan_indikator_validasi_jawaban($id){
		$chk = $this->input->post('chk[]');
		$jawaban_validasi_detil = $this->input->post('jawaban_validasi_detil[]');
				$no_urut_detil = $this->input->post('no_urut_detil[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
			$kode = $this->m_rancak->kode_generator(15,'QD');
			$kodeid = $this->m_rancak->kode_generator_urut(15,'');
			$akhirkode = $kodeid .'-'. $chk[$i];
			$temp = $this->ambil_data_nkr_indikator($chk[$i]);
		//	$this->simpan_nkr_indikator_validasi($chk[$i]);
				$data_pendaftaran = array(
					'jawaban_validasi_detil' => $jawaban_validasi_detil[$i],
					'id_validasi_detil' => $kodeid,
					'id_indikator' => $chk[$i],
					'no_urut_detil' => $no_urut_detil[$i],
					'barcode_validasi_detil' => $kode,
					'id_indikator' => $temp['id_indikator'],
					'id_asesmen' => $temp['id_asesmen'],
					'nama_indikator' => $temp['nama_indikator'],
					'pertanyaan_indikator' => $temp['pertanyaan_indikator'],
     'pembuat_validasi_detil' => $this->session->barcode_pegawai,
     'instansi_validasi_detil' => $this->session->barcode_working,
					'ketercapaian_indikator' => $temp['ketercapaian_indikator'],
					'barcode_pengajuan_validasi' => $id
				);
				$this->db->insert('nkr_validasi_detil', $data_pendaftaran);
			}
		}
	}
	function edit_indikator_validasi_jawaban(){
		$chk = $this->input->post('id_validasi_detil[]');
		$jawaban_validasi_detil = $this->input->post('jawaban_validasi_detil[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				$this->update_indikator_validasi_jawaban($chk[$i],$jawaban_validasi_detil[$i]);
			}
		}
	}
	function update_indikator_validasi_jawaban($id,$jawaban){
			$data_kewenangan_detil = array(
				'jawaban_validasi_detil' =>$jawaban
			);
		$this->db->where('id_validasi_detil',$id);
		$this->db->update('nkr_validasi_detil', $data_kewenangan_detil);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function simpan_indikator_validasi_tulis_locked($id){
		$chk = $this->input->post('chk[]');
		$pertanyaan_indikator = $this->input->post('pertanyaan_indikator[]');
		$jawaban_validasi_detil = $this->input->post('jawaban_validasi_detil[]');
		$jawaban_indikator = $this->input->post('jawaban_indikator[]');
		$no_urut_detil = $this->input->post('no_urut_detil[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
			$kode = $this->m_rancak->kode_generator(15,'QD');
			$kodeid = $this->m_rancak->kode_generator_urut(15,'');
			$akhirkode = $kodeid .'-'. $chk[$i];
			$temp = $this->ambil_data_nkr_indikator($chk[$i]);
			$kondisi=array('id_indikator'=>$chk[$i]);
			$jml = $this->m_umum->jumlah_record_filter('nkr_soal_opsi_validasi',$kondisi);
			if($jml == 0){
				$this->simpan_soal_opsi_validasi($chk[$i]);				
			}else{
				$this->edit_soal_opsi_validasi($chk[$i]);
			}
				$data_pendaftaran = array(
					'jawaban_validasi_detil' => $jawaban_validasi_detil[$i],
					'id_validasi_detil' => $kodeid,
					'id_indikator' => $chk[$i],
					'id_indikator' => $temp['id_indikator'],
					'id_asesmen' => $temp['id_asesmen'],
					'nama_indikator' => $temp['nama_indikator'],
					'pertanyaan_indikator' => $temp['pertanyaan_indikator'],
					'jawaban_indikator' => $temp['jawaban_indikator'],
					'jenis_soal' => $temp['jenis_soal'],
					'no_urut_detil' => $no_urut_detil[$i],
					'jawaban_indikator' => $jawaban_indikator[$i],
     'pembuat_validasi_detil' => $this->session->barcode_pegawai,
     'instansi_validasi_detil' => $this->session->barcode_working,
					'pertanyaan_indikator' => $pertanyaan_indikator[$i],
					'barcode_validasi_detil' => $kode,
					'barcode_pengajuan_validasi' => $id
				);
				$this->db->insert('nkr_validasi_detil', $data_pendaftaran);
			}
		}
	}
	function simpan_validasi_pra_asesmen($id){
		$chk = $this->input->post('chk[]');
	//	$jawaban_validasi_detil = $this->input->post('jawaban_validasi_detil[]');
		$no_urut_detil = $this->input->post('no_urut_detil[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
			$kode = $this->m_rancak->kode_generator(15,'QD');
			$kodeid = $this->m_rancak->kode_generator_urut(15,'');
			$akhirkode = $kodeid .'-'. $chk[$i];
			$temp = $this->ambil_data_nkr_pra_detil($chk[$i]);
				$data_pendaftaran = array(
					'id_validasi_detil' => $kodeid,
					'id_pra_detil' => $chk[$i],
					'no_urut_detil' => $no_urut_detil[$i],
					'barcode_validasi_detil' => $kode,
					'barcode_pra_asesmen' => $temp['barcode_pra_asesmen'],
					'nama_pra_detil' => $temp['nama_pra_detil'],
     'pembuat_validasi_detil' => $this->session->barcode_pegawai,
     'instansi_validasi_detil' => $this->session->barcode_working,
					'barcode_pengajuan_validasi' => $id
				);
				$this->db->insert('nkr_validasi_detil', $data_pendaftaran);
			}
		}
	}
	function simpan_validasi_kaji_ulang($id){
		$chk = $this->input->post('id_kaji_ulang[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
			$kode = $this->m_rancak->kode_generator(15,'QD');
			$kodeid = $this->m_rancak->kode_generator_urut(15,'');
			$akhirkode = $kodeid .'-'. $chk[$i];
			$temp = $this->ambil_data_nkr_kaji_ulang($chk[$i]);
				$data_pendaftaran = array(
					'id_validasi_detil' => $kodeid,
					'id_kaji_ulang' => $chk[$i],
					'barcode_validasi_detil' => $kode,
					'id_kat_kaji' => $temp['id_kat_kaji'],
					'nama_kaji_ulang' => $temp['nama_kaji_ulang'],
					'id_kaji_ulang' => $temp['id_kaji_ulang'],
					'id_jenis_form' => $temp['id_jenis_form'],
     'pembuat_validasi_detil' => $this->session->barcode_pegawai,
     'instansi_validasi_detil' => $this->session->barcode_working,
					'barcode_pengajuan_validasi' => $id
				);
				$this->db->insert('nkr_validasi_detil', $data_pendaftaran);
			}
		}
	}
/*	function simpan_indikator_sample_all($id){
		$chk = $this->input->post('chk[]');
		$no_urut_detil = $this->input->post('no_urut_detil[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
			$kode = $this->m_rancak->kode_generator(15,'QD');
			$kodeid = $this->m_rancak->kode_generator_urut(15,'');
			$akhirkode = $kodeid .'-'. $chk[$i];
			$temp = $this->ambil_data_nkr_indikator($chk[$i]);
			$kondisi=array('id_indikator'=>$chk[$i]);
			$jml = $this->m_umum->jumlah_record_filter('nkr_indikator_validasi',$kondisi);
			$jml2 = $this->m_umum->jumlah_record_filter('nkr_soal_opsi_validasi',$kondisi);
			if($jml == 0){
				$this->simpan_nkr_indikator_validasi($chk[$i]);				
			}else{
				$this->edit_nkr_indikator_validasi($chk[$i]);
			}
			if($jml2 == 0){
				$this->simpan_soal_opsi_validasi($chk[$i]);				
			}else{
				$this->edit_soal_opsi_validasi($chk[$i]);
			}
				$data_pendaftaran = array(
					'id_validasi_detil' => $kodeid,
					'id_indikator' => $chk[$i],
					'no_urut_detil' => $no_urut_detil[$i],
					'barcode_validasi_detil' => $kode,
					'id_indikator' => $temp['id_indikator'],
					'id_asesmen' => $temp['id_asesmen'],
					'nama_indikator' => $temp['nama_indikator'],
					'poin_indikator' => $temp['poin_indikator'],
					'pertanyaan_indikator' => $temp['pertanyaan_indikator'],
					'ketercapaian_indikator' => $temp['ketercapaian_indikator'],
					'jawaban_indikator' => $temp['jawaban_indikator'],
					'jenis_soal' => $temp['jenis_soal'],
					'perangkat_indikator' => $temp['perangkat_indikator'],
					'metode_indikator' => $temp['metode_indikator'],
					'barcode_pengajuan_validasi' => $id
				);
				$this->db->insert('nkr_validasi_detil', $data_pendaftaran);
			}
		}
	}*/
	function print_logbook_per_pasien($id,$idr,$field,$asc,$grup=FALSE)
	{
		$this->db->select("DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_logbook,ol.id_logbook,rm,
		concat(nama_kompetensi,' - <b>[',nama_kewenangan,']</b>') as nama_kompetensi
			");
		$this->db->join('nkr_kewenangan ok', 'ok.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi okm', 'okm.id_kompetensi=ok.id_kompetensi','left');
		if($grup){
	    $this->db->group_by($grup); }
	    $this->db->order_by($field,$asc);
		$this->db->order_by('ol.tgl_logbook','ASC');
		$q = $this->db->get_where('ol_logbook ol',array('ol.id_logbooker'=>$id,'ol.id_pengajuan'=>$idr))->result_array();
		return $q;
    }
	function print_per_pasien($id)
	{
		$this->db->select("*,if(gender_pasien = 1,'Laki-laki','Perempuan') as gender_pasien,
		if(satuan_pasien = 0,'Hari',if(satuan_pasien = 1,'Bulan','Tahun')) as satuan_pasien
			");
		$q = $this->db->get_where('ol_logbook_pasien olp',array('olp.id_logbook'=>$id))->result_array();
		return $q;
    }
	function ambil_data_nkr_pra_detil($id){	
		$q = $this->db->get_where('nkr_pra_detil',array('id_pra_detil'=>$id));	
		return $q->row_array();	
	}
	function ambil_data_nkr_indikator($id){	
		$q = $this->db->get_where('nkr_indikator',array('id_indikator'=>$id));	
		return $q->row_array();	
	}
	function ambil_data_nkr_kaji_ulang($id){	
		$q = $this->db->get_where('nkr_kaji_ulang',array('id_kaji_ulang'=>$id));	
		return $q->row_array();	
	}
	function simpan_nkr_indikator_validasi($id){
		$rowtemp = $this->ambil_data_nkr_indikator($id);
	//	foreach($temp as $rowtemp){
			$kode = $this->m_rancak->kode_generator_urut(15,'IV');
			$data_pendaftaran = array(
				'id_indikator_validasi' => $kode,
				'id_indikator' => $rowtemp['id_indikator'],
				'id_asesmen' => $rowtemp['id_asesmen'],
				'nama_indikator' => $rowtemp['nama_indikator'],
				'poin_indikator' => $rowtemp['poin_indikator'],
				'pertanyaan_indikator' => $rowtemp['pertanyaan_indikator'],
				'ketercapaian_indikator' => $rowtemp['ketercapaian_indikator'],
				'jawaban_indikator' => $rowtemp['jawaban_indikator'],
				'jenis_soal' => $rowtemp['jenis_soal'],
				'perangkat_indikator' => $rowtemp['perangkat_indikator'],
				'metode_indikator' => $rowtemp['metode_indikator'],
				'pembuat_indikator' => $rowtemp['pembuat_indikator'],
				'status_indikator' => $rowtemp['status_indikator']
			);
			$this->db->insert('nkr_indikator_validasi', $data_pendaftaran);			
	//	}
	}
	function edit_nkr_indikator_validasi($id){
		$rowtemp = $this->ambil_data_nkr_indikator($id);
	//	foreach($temp as $rowtemp){
			$data_pendaftaran = array(
				'id_asesmen' => $rowtemp['id_asesmen'],
				'nama_indikator' => $rowtemp['nama_indikator'],
				'poin_indikator' => $rowtemp['poin_indikator'],
				'pertanyaan_indikator' => $rowtemp['pertanyaan_indikator'],
				'ketercapaian_indikator' => $rowtemp['ketercapaian_indikator'],
				'jawaban_indikator' => $rowtemp['jawaban_indikator'],
				'jenis_soal' => $rowtemp['jenis_soal'],
				'perangkat_indikator' => $rowtemp['perangkat_indikator'],
				'metode_indikator' => $rowtemp['metode_indikator'],
				'pembuat_indikator' => $rowtemp['pembuat_indikator'],
				'status_indikator' => $rowtemp['status_indikator']
			);
			$this->db->where('id_indikator',$rowtemp['id_indikator']);
			$this->db->update('nkr_indikator_validasi', $data_pendaftaran);
			//echo $this->db->last_query();
			$this->db->trans_complete();	// untuk cek sukses update tidak
			if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
			// if (!$this->db->affected_rows()) 
				return(FALSE);
			else 
				return(TRUE);
	//	}	
	}
	function ambil_data_nkr_soal_opsi_validasi($id){	
		$q = $this->db->get_where('nkr_soal_opsi',array('id_indikator'=>$id));	
		return $q->result_array();	
	}
	function simpan_soal_opsi_validasi($id){
		$temp = $this->ambil_data_nkr_soal_opsi_validasi($id);
		foreach($temp as $rowtemp){
			$kode = $this->m_rancak->kode_generator_urut(15,'SV');
			$data_pendaftaran = array(
				'id_soal_opsi_validasi' => $kode,
				'id_soal_opsi' => $rowtemp['id_soal_opsi'],
				'id_indikator' => $rowtemp['id_indikator'],
				'no_urut_soal_opsi' => $rowtemp['no_urut_soal_opsi'],
				'nama_soal_opsi' => $rowtemp['nama_soal_opsi'],
				'answer' => $rowtemp['answer'],
				'status_soal_opsi' => $rowtemp['status_soal_opsi']
			);
			$this->db->insert('nkr_soal_opsi_validasi', $data_pendaftaran);			
		}
	}
	function edit_soal_opsi_validasi($id){
		$temp = $this->ambil_data_nkr_soal_opsi_validasi($id);
		$data_pendaftaran = array(
			'no_urut_soal_opsi' => $rowtemp['no_urut_soal_opsi'],
			'nama_soal_opsi' => $rowtemp['nama_soal_opsi'],
			'answer' => $rowtemp['answer'],
			'status_soal_opsi' => $rowtemp['status_soal_opsi']
		);
		$this->db->where('id_indikator',$rowtemp['id_indikator']);
		$this->db->update('nkr_soal_opsi_validasi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}
	function simpan_indikator_validasi_pertanyaanjawaban($id){
		$chk = $this->input->post('chk[]');
		$pertanyaan_indikator = $this->input->post('pertanyaan_indikator[]');
		$jawaban_indikator = $this->input->post('jawaban_indikator[]');
		$no_urut_detil = $this->input->post('no_urut_detil[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
			$kode = $this->m_rancak->kode_generator(15,'QD');
			$kodeid = $this->m_rancak->kode_generator_urut(15,'');
			$akhirkode = $kodeid .'-'. $chk[$i];
				$data_pendaftaran = array(
					'jawaban_validasi_detil' => $jawaban_validasi_detil[$i],
					'id_validasi_detil' => $kodeid,
					'id_indikator' => $chk[$i],
					'no_urut_detil' => $no_urut_detil[$i],
					'jawaban_indikator' => $jawaban_indikator[$i],
					'pertanyaan_indikator' => $pertanyaan_indikator[$i],
					'barcode_validasi_detil' => $kode,
					'barcode_pengajuan_validasi' => $id
				);
				$this->db->insert('nkr_validasi_detil', $data_pendaftaran);
			}
		}
	}
	function edit_indikator_validasi_pertanyaanjawaban($id){
		$chk = $this->input->post('chk[]');
		$pertanyaan_indikator = $this->input->post('pertanyaan_indikator[]');
		$jawaban_indikator = $this->input->post('jawaban_indikator[]');
		$no_urut_detil = $this->input->post('no_urut_detil[]');
		$barcode_validasi_detil = $this->input->post('barcode_validasi_detil[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
			$kode = $this->m_rancak->kode_generator(15,'QD');
			$kodeid = $this->m_rancak->kode_generator_urut(15,'');
			$akhirkode = $kodeid .'-'. $chk[$i];
				$this->edit_logbook($jawaban_validasi_detil[$i]);
			}
		}
	}
	function edit_logbook($jawaban_validasi_detil){
		$id_status_diusulkan = $this->input->post('id_status_diusulkan');
			$data_kewenangan_detil = array(
				'jawaban_validasi_detil' => $jawaban_validasi_detil,
				'id_validasi_detil' => $kodeid,
				'id_indikator' => $chk[$i],
				'no_urut_detil' => $no_urut_detil[$i],
				'jawaban_indikator' => $jawaban_indikator[$i],
				'pertanyaan_indikator' => $pertanyaan_indikator[$i],
				'barcode_validasi_detil' => $kode,
				'barcode_pengajuan_validasi' => $id
			);
		$this->db->where('barcode_validasi_detil',$barcode_validasi_detil);
		$this->db->update('nkr_validasi_detil', $data_kewenangan_detil);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function simpan_pegawai_akses(){
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
	function simpan_berkas_pengajuan(){
		$kesesuaian_bukti = $this->input->post('kesesuaian_bukti[]');
		$barcode_form = $this->input->post('barcode_form');
		$barcode_pengajuan = $this->input->post('barcode_pengajuan');
		if (empty($kesesuaian_bukti)) {
		   $chkkesesuaian_bukti = "";
		}else{
			$chkkesesuaian_bukti = implode(",",$kesesuaian_bukti);
		}
		$data_pendaftaran = array(
			'kesesuaian_bukti' => $chkkesesuaian_bukti
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
	}
	function pengajuan_validasi_form3_setuju(){
		$kode = $this->m_rancak->kode_generator(15,'PV');
		$kodeurut = $this->m_rancak->kode_generator_urut(15,'ID');
		$data_pendaftaran2 = array(
			'kesesuaian_bukti_validasi' => $chkkesesuaian_bukti,
			'barcode_form' => $this->input->post('barcode_form'),
			'barcode_pengajuan' => $this->input->post('barcode_pengajuan'),
			'barcode_pengajuan_validasi' =>  $kode,
			'id_pengajuan_validasi' =>  $kodeurut,
			'validasi' => 1,
			'tgl_asesor' => date('Y-m-d H:i:s'),
			'id_asesor' => $this->session->id_pegawai,
			'ket_pengajuan_validasi' => $this->input->post('ket_pengajuan_validasi')
		);
		$this->db->insert('nkr_pengajuan_validasi', $data_pendaftaran2);
		return $kode;
	}
	function pengajuan_validasi_form3_tolak(){
		$kode = $this->m_rancak->kode_generator(15,'PV');
		$kodeurut = $this->m_rancak->kode_generator_urut(15,'ID');
		$data_pendaftaran2 = array(
			'kesesuaian_bukti_validasi' => $chkkesesuaian_bukti,
			'barcode_form' => $this->input->post('barcode_form'),
			'barcode_pengajuan' => $this->input->post('barcode_pengajuan'),
			'barcode_pengajuan_validasi' =>  $kode,
			'id_pengajuan_validasi' =>  $kodeurut,
			'validasi' => 2,
			'tgl_asesor' => date('Y-m-d H:i:s'),
			'id_asesor' => $this->session->id_pegawai,
			'ket_pengajuan_validasi' => $this->input->post('ket_pengajuan_validasi')
		);
		$this->db->insert('nkr_pengajuan_validasi', $data_pendaftaran2);
		return $kode;
	}
	function tabel_logbook($id)
	{
		$apk = $this->m_kredensial->ambil_pengajuan_kompetensi($id); //barcode
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,
		if(status_validasi = 1,'Kompeten Penuh',if(status_validasi = 2,'Dengan Mentorship',(if(status_validasi = 3,'Tidak Kompeten / Ditolak','Proses / Belum Validasi')))) as status_validasi
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
    $this->db->where("id_logbooker", $apk['id_pegawai']);
    $this->db->where("nkr_kewenangan.id_kompetensi", $apk['kode_unit_pengajuan']);
    $this->db->where('ol_logbook.id_kewenangan NOT IN (select id_kewenangan from ol_rkk where id_sifat_kewenangan = 1 and barcode_pegawai = "'. $apk['barcode_pegawai'] . '")',NULL,FALSE);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_logbook');
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_logbook.id_logbooker','left');
		$this->db->join('ol_validasi', 'ol_validasi.id_kewenangan=ol_logbook.id_kewenangan','left');
		$this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
		$this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
		$this->db->join('kol_sifat_kewenangan', 'kol_sifat_kewenangan.id_sifat_kewenangan=ol_logbook.id_sifat_kewenangan','left');
		$this->db->where("id_logbooker", $apk['id_pegawai']);
		$this->db->where("nkr_kewenangan.id_kompetensi", $apk['kode_unit_pengajuan']);
		$this->db->where('ol_logbook.id_kewenangan NOT IN (select id_kewenangan from ol_rkk where id_sifat_kewenangan = 1 and barcode_pegawai = "'. $apk['barcode_pegawai'] . '")',NULL,FALSE);
	//	$this->db->group_by(array("ol_logbook.id_kewenangan","ol_logbook.id_sifat_kewenangan"));

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute
     //echo $this->db->last_query();
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
    $this->db->where("id_logbooker", $apk['id_pegawai']);
    $this->db->where("nkr_kewenangan.id_kompetensi", $apk['kode_unit_pengajuan']);
    $this->db->where('ol_logbook.id_kewenangan NOT IN (select id_kewenangan from ol_rkk where id_sifat_kewenangan = 1 and barcode_pegawai = "'. $apk['barcode_pegawai'] . '")',NULL,FALSE);
			}
		  }
		}

    $this->db->from('ol_logbook');
    $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_logbook.id_logbooker','left');
    $this->db->join('ol_validasi', 'ol_validasi.id_kewenangan=ol_logbook.id_kewenangan','left');
    $this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
    $this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
    $this->db->join('kol_sifat_kewenangan', 'kol_sifat_kewenangan.id_sifat_kewenangan=ol_logbook.id_sifat_kewenangan','left');
    $this->db->where("id_logbooker", $apk['id_pegawai']);
    $this->db->where("nkr_kewenangan.id_kompetensi", $apk['kode_unit_pengajuan']);
    $this->db->where('ol_logbook.id_kewenangan NOT IN (select id_kewenangan from ol_rkk where id_sifat_kewenangan = 1 and barcode_pegawai = "'. $apk['barcode_pegawai'] . '")',NULL,FALSE);
// 	$this->db->group_by(array("ol_logbook.id_kewenangan","ol_logbook.id_sifat_kewenangan"));

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_logbooker'=>$apk['id_pegawai'],'id_kompetensi'=>$apk['kode_unit_pengajuan']);
		$jml = $this->m_umum->jumlah_record_tabel_pengajuan_select('ol_logbook.id_kewenangan','ol_logbook',$kondisi,'nkr_kewenangan','id_kewenangan','ol_logbook.id_kewenangan');*/
   // $jml = $this->m_umum->jumlah_record_filter('ol_logbook',$kondisi,'id_kewenangan');
		$jml = $this->m_umum->jumlah_record_tabel('ol_logbook');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
  function simpan_rkk(){
    $kode = $this->m_rancak->kode_generator_urut(15,'RK');
    $data_pendaftaran = array(
      'id_rkk' => $kode,
      'validator_rkk' => $this->session->barcode_pegawai,
      'barcode_pegawai' => $this->input->post('barcode_pegawai'),
      'id_kewenangan' => $this->input->post('id_kewenangan'),
      'id_sifat_kewenangan' => $this->input->post('id_sifat_kewenangan'),
      'barcode_pengajuan' => $this->input->post('barcode_pengajuan'),
      'status_rkk' => $this->input->post('status_rkk')
    );
    return $this->db->insert('ol_rkk', $data_pendaftaran);
  }
  function edit_rkk(){
    $id_kewenangan = $this->input->post('id_kewenangan');
    $barcode_pegawai = $this->input->post('barcode_pegawai');
    $data_pendaftaran = array(
      'id_sifat_kewenangan' => $this->input->post('id_sifat_kewenangan'),
      'status_rkk' => $this->input->post('status_rkk')
    );
    $this->db->where('id_kewenangan',$id_kewenangan);
    $this->db->where('barcode_pegawai',$barcode_pegawai);
    $this->db->update('ol_rkk', $data_pendaftaran);
    //echo $this->db->last_query();
    $this->db->trans_complete();  // untuk cek sukses update tidak
    if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
    // if (!$this->db->affected_rows())
      return(FALSE);
    else
      return(TRUE);
  }
  function print_logbook_per_pasien_validasi($id)
  {
    $this->db->select("DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_logbook
      ");
    $this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
    $this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
    $this->db->join('kol_sifat_kewenangan', 'kol_sifat_kewenangan.id_sifat_kewenangan=ol_logbook.id_sifat_kewenangan','left');
    $this->db->order_by('tgl_logbook','ASC');
    $q = $this->db->get_where('ol_logbook',array('nkr_kewenangan.id_kompetensi'=>$id))->result_array();
    return $q;
  }
  function print_per_pasien_validasi($id)
  {
    $this->db->select("*,if(jk = 1,'Laki-laki','Perempuan') as jk,
      CONCAT((TIMESTAMPDIFF( YEAR, ol_pasien.tgl_lahir, tgl_logbook )), ' Tahun ',
      TIMESTAMPDIFF( MONTH, ol_pasien.tgl_lahir, tgl_logbook ) % 12, ' Bulan ',
      FLOOR( TIMESTAMPDIFF( DAY, ol_pasien.tgl_lahir, tgl_logbook ) % 30.4375 ), ' Hari') as umur
      ");
    $this->db->join('ol_logbook', 'ol_logbook.id_logbook=ol_logbook_pasien.id_logbook','left');
    $this->db->join('ol_pasien', 'ol_pasien.id_pasien=ol_logbook_pasien.id_pasien','left');
    $q = $this->db->get_where('ol_logbook_pasien',array('ol_logbook_pasien.id_logbook'=>$id))->result_array();
    return $q;
    }
	function simpan_ol_logbook_validasi_all($validasi,$result,$bl,$idp){
		$kondisi=array('id_pengajuan'=>$idp,'id_kewenangan'=>$bl);
		$sources = $this->m_umum->ambil_data_kondisi_result('ol_logbook',$kondisi);
		foreach($sources as $rowsources){
			$barcode_logbook = $rowsources['barcode_logbook'];
			$this->db->select("COUNT(*) as num");
			$this->db->where('barcode_logbook',$rowsources['barcode_logbook']);
			$q = $this->db->get('ol_logbook_validasi')->row();
			$jml = $q->num;
			if($jml == 0){
				$this->simpan_ol_logbook_validasi($validasi,$result,$rowsources['barcode_logbook']);
			}
		}
	}
	function simpan_ol_logbook_validasi($validasi,$result,$bl){
		$kode = $this->m_rancak->kode_generator_urut(15,'LV');
		if(empty($result)){
			$result = 0;
		}
		$data_pendaftaran2 = array(
			'barcode_logbook_validasi' => $kode,
			'barcode_logbook' => $bl,
			'validasi' => $validasi,
			'result_tolak' => $result
		);
		return $this->db->insert('ol_logbook_validasi', $data_pendaftaran2);
	}
	function edit_ol_logbook_validasi($validasi,$result,$bl){
		if(empty($result)){
			$result = 0;
		}
		$data_pendaftaran = array(
			'validasi' => $validasi,
			'result_tolak' => $result
		);
		$this->db->where('barcode_logbook',$bl);
		$this->db->update('ol_logbook_validasi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function table_link_kompetensi($id)
	{
//		$apk = $this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$id); //barcode
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,npv.id_jenis_form as ijf";
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
					case 'id_jenis_form' : $nmf="nf.id_jenis_form";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where("npv.barcode_pengajuan", $id);
		$this->db->where("npv.id_asesor", $this->session->id_pegawai);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('nkr_pengajuan_validasi npv');
	// 	$this->db->join('nkr_form nf', 'nf.barcode_form=npv.barcode_form','left');
	 	$this->db->join('kol_jenis_form kjf', 'kjf.id_jenis_form=npv.id_jenis_form','left');
	  	$this->db->join('ol_pegawai p', 'p.id_pegawai=npv.id_asesor','left');
	//	$this->db->where("nf.id_jenis_form <", 8);
		$this->db->where("npv.barcode_pengajuan", $id);
		$this->db->where("npv.id_asesor", $this->session->id_pegawai);

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
					case 'id_jenis_form' : $nmf="nf.id_jenis_form";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where("npv.barcode_pengajuan", $id);
		$this->db->where("npv.id_asesor", $this->session->id_pegawai);
			}
		  }
		}

		$this->db->from('nkr_pengajuan_validasi npv');
	// 	$this->db->join('nkr_form nf', 'nf.barcode_form=npv.barcode_form','left');
	 	$this->db->join('kol_jenis_form kjf', 'kjf.id_jenis_form=npv.id_jenis_form','left');
	  	$this->db->join('ol_pegawai p', 'p.id_pegawai=npv.id_asesor','left');
		$this->db->where("npv.barcode_pengajuan", $id);
		$this->db->where("npv.id_asesor", $this->session->id_pegawai);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
 		$kondisi=array('barcode_pengajuan'=>$id,'id_asesor'=>$this->session->id_pegawai);
		$jml = $this->m_umum->jumlah_record_filter('nkr_pengajuan_validasi',$kondisi);	
//		$jml = $this->m_umum->jumlah_record_tabel('ol_logbook');

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
