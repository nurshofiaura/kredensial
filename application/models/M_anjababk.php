<?php
class M_anjababk extends CI_model{	
	function pegawai_unite()
	{
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
				//	 case 'nama_pegawai' : $nmf="pegawai.nama_pegawai";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where("status_user", 1);
		$this->db->where("status_pegawai", 1);
		$this->db->where("ou.unit", $this->session->unit);
		
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_pegawai peg');
		$this->db->join('ol_user ou', 'ou.id_pegawai=peg.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
		$this->db->where("status_user", 1);
		$this->db->where("status_pegawai", 1);
		$this->db->where("ou.unit", $this->session->unit);
			
		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'nama_pegawai' : $nmf="pegawai.nama_pegawai";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where("status_user", 1);
		$this->db->where("status_pegawai", 1);
		$this->db->where("ou.unit", $this->session->unit);
			}
		  }
		}

	    $this->db->from('ol_pegawai peg');
		$this->db->join('ol_user ou', 'ou.id_pegawai=peg.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
		$this->db->where("status_user", 1);
		$this->db->where("status_pegawai", 1);
		$this->db->where("ou.unit", $this->session->unit);
		
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

 		$kondisi=array('unit'=>$this->session->unit);
		$jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_pegawai',$kondisi,'ol_user','id_pegawai'); 
//		$jml = $this->m_umum->jumlah_record_filter('ol_pegawai',$kondisi); 
//		$jml = $this->m_umum->jumlah_record_tabel('ol_logbook_laporan_tabel');
				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;	
	}
	function tambah_butir_kegiatan(){
		$data_pendaftaran = array(
			'id_jabatan_fungsional' => $this->input->post('id_jabatan_fungsional'),
			'nama_butir_kegiatan' => $this->input->post('nama_butir_kegiatan'),						
			'angka_kredit' => $this->input->post('angka_kredit'),
			'satuan_hasil' => $this->input->post('satuan_hasil'),
			'status_butir_kegiatan' => $this->input->post('status_butir_kegiatan')
		);
		return $this->db->insert('butir_kegiatan', $data_pendaftaran);
	}
	function rubah_butir_kegiatan(){
		$id_butir_kegiatan = $this->input->post('id_butir_kegiatan');	
		$data_pendaftaran = array(
			'id_jabatan_fungsional' => $this->input->post('id_jabatan_fungsional'),
			'nama_butir_kegiatan' => $this->input->post('nama_butir_kegiatan'),						
			'angka_kredit' => $this->input->post('angka_kredit'),
			'satuan_hasil' => $this->input->post('satuan_hasil'),
			'status_butir_kegiatan' => $this->input->post('status_butir_kegiatan')
		);
		$this->db->where('id_butir_kegiatan',$id_butir_kegiatan);
		$this->db->update('butir_kegiatan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function rubah_pegawai(){
		$id_pegawai = $this->input->post('id_pegawai');	
		$data_pendaftaran = array(
			'id_jabatan_fungsional' => $this->input->post('id_jabatan_fungsional'),
			'nama_pegawai' => $this->input->post('nama_pegawai')
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
	function rubah_formasi_pegawai($id_abk_detil){
		$this->db->select('SUM(formasi) as jumlah');
		$this->db->where('id_abk_detil',$id_abk_detil); 
		$q = $this->db->get('p_bk_detil')->row_array();
		$formasi = round($q['jumlah'],0);
		$pabkd = $this->m_umum->ambil_data('p_abk_detil','id_abk_detil',$id_abk_detil);
		$pns = $pabkd['pns'];
		$cpns = $pabkd['cpns'];
		$blud = $pabkd['blud'];
		$pegawai = $pns + $cpns + $blud;
		$average = $pegawai - $formasi;		
		$data_pendaftaran = array(
			'total' => $formasi,
			'average' => $average
		);
		$this->db->where('id_abk_detil',$id_abk_detil);
		$this->db->update('p_abk_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function simpan_bk_detil(){
		$id_abk_detil = $this->input->post('id_abk_detil');
		$id_kompetensi = $this->input->post('id_kompetensi');
		$status_butir_kegiatan = $this->input->post('status_butir_kegiatan');
		if($status_butir_kegiatan=='1' || $status_butir_kegiatan=='4'){
			$ms_konstanta = $this->input->post('konstanta');
			$ms_wpk = 0;		
			$ms_wpv = 0;
			$ms_jam_efektif = 0;
			$ms_angka_kredit = 0;
		}
		elseif($status_butir_kegiatan=='2' || $status_butir_kegiatan=='5'){
			$ms_konstanta = 0;
			$ms_wpk = $this->input->post('wpk');		
			$ms_wpv = $this->input->post('wpv');
			$ms_jam_efektif = $this->input->post('jam_efektif');
			$ms_angka_kredit = 0;			
		}
		else{
			$ms_konstanta = $this->input->post('konstanta');
			$ms_wpk = $this->input->post('wpk');		
			$ms_wpv = $this->input->post('wpv');
			$ms_jam_efektif = $this->input->post('jam_efektif');			
			$ms_angka_kredit = $this->input->post('angka_kredit');			
		}	
	//	$this->rubah_butir_kegiatan_from_bk($ms_angka_kredit);
		$this->rubah_formasi_pegawai($id_abk_detil);
		$kode = $this->m_rancak->kode_generator_urut(15,'BD');
		$data_pendaftaran = array(
			'id_kompetensi' => $this->input->post('id_kompetensi'),
			'keterangan_jumlah' => $this->input->post('keterangan_jumlah'),
			'id_bk_detil' => $kode,
			'konstanta' => $ms_konstanta,
			'id_abk_detil' => $id_abk_detil,
			'wpk' => $ms_wpk,
			'satuan_hasil' => $this->input->post('satuan_hasil'),						
			'angka_kredit' => $ms_angka_kredit,
			'vol1th' => $this->input->post('vol1th'),
			'wpv' => $ms_wpv,
			'formasi' => $this->input->post('formasi'),
			'jam_efektif' => $ms_jam_efektif,
			'status_bk_detil' => $status_butir_kegiatan
		);
		return $this->db->insert('p_bk_detil', $data_pendaftaran);					
	}
	function rubah_bk_detil(){
		$id_abk_detil = $this->input->post('id_abk_detil');
		$id_bk_detil = $this->input->post('id_bk_detil');
		$id_kompetensi = $this->input->post('id_kompetensi');
		$status_butir_kegiatan = $this->input->post('status_butir_kegiatan');
		if($status_butir_kegiatan=='1' || $status_butir_kegiatan=='4'){
			$ms_konstanta = $this->input->post('konstanta');
			$ms_wpk = 0;		
			$ms_wpv = 0;
			$ms_jam_efektif = 0;
			$ms_angka_kredit = 0;
		}
		elseif($status_butir_kegiatan=='2' || $status_butir_kegiatan=='5'){
			$ms_konstanta = 0;
			$ms_wpk = $this->input->post('wpk');		
			$ms_wpv = $this->input->post('wpv');
			$ms_jam_efektif = $this->input->post('jam_efektif');
			$ms_angka_kredit = 0;			
		}
		else{
			$ms_konstanta = $this->input->post('konstanta');
			$ms_wpk = $this->input->post('wpk');		
			$ms_wpv = $this->input->post('wpv');
			$ms_jam_efektif = $this->input->post('jam_efektif');			
			$ms_angka_kredit = $this->input->post('angka_kredit');			
		}	
	//	$this->rubah_butir_kegiatan_from_bk($ms_angka_kredit);
		$this->rubah_formasi_pegawai($id_abk_detil);
		$data_pendaftaran = array(
			'keterangan_jumlah' => $this->input->post('keterangan_jumlah'),
			'konstanta' => $ms_konstanta,
			'wpk' => $ms_wpk,
			'satuan_hasil' => $this->input->post('satuan_hasil'),						
			'angka_kredit' => $ms_angka_kredit,
			'vol1th' => $this->input->post('vol1th'),
			'wpv' => $ms_wpv,
			'formasi' => $this->input->post('formasi'),
			'jam_efektif' => $ms_jam_efektif,
			'status_bk_detil' => $status_butir_kegiatan
		);
		$this->db->where('id_bk_detil',$id_bk_detil);
	//	$this->db->where('id_butir_kegiatan',$id_butir_kegiatan);
		$this->db->update('p_bk_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function rubah_butir_kegiatan_from_bk($ms_angka_kredit){
		$id_butir_kegiatan = $this->input->post('id_butir_kegiatan');		
		$data_pendaftaran = array(
			'nama_butir_kegiatan' => $this->input->post('nama_butir_kegiatan'),						
			'angka_kredit' => $ms_angka_kredit,
			'satuan_hasil' => $this->input->post('satuan_hasil'),
		);
		$this->db->where('id_butir_kegiatan',$id_butir_kegiatan);
		$this->db->update('butir_kegiatan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function abk_all($periode,$id_unit)
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,
			DATE_FORMAT(pind.periode,'%Y') as periode		
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
				//	 case 'nama_pegawai' : $nmf="pegawai.nama_pegawai";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where("pin.id_unit", $id_unit);
		$this->db->where("DATE_FORMAT(periode,'%Y')", $periode);
		
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('p_abk pin');
		$this->db->join('p_abk_detil pind', 'pind.id_abk=pin.id_abk','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=pind.id_jabatan_fungsional','left');
		$this->db->join('srt_struktur_jabatan sj', 'sj.id_struktur_jabatan=pin.id_struktur_jabatan','left');
		$this->db->join('ol_unit u', 'u.id_unit=pin.id_unit','left');
		$this->db->where("pin.id_unit", $id_unit);
		$this->db->where("DATE_FORMAT(periode,'%Y')", $periode);
			
		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'nama_pegawai' : $nmf="pegawai.nama_pegawai";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where("pin.id_unit", $id_unit);
		$this->db->where("DATE_FORMAT(periode,'%Y')", $periode);
			}
		  }
		}

	    $this->db->from('p_abk pin');
		$this->db->join('p_abk_detil pind', 'pind.id_abk=pin.id_abk','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=pind.id_jabatan_fungsional','left');
		$this->db->join('srt_struktur_jabatan sj', 'sj.id_struktur_jabatan=pin.id_struktur_jabatan','left');
		$this->db->join('ol_unit u', 'u.id_unit=pin.id_unit','left');
		$this->db->where("pin.id_unit", $id_unit);
		$this->db->where("DATE_FORMAT(periode,'%Y')", $periode);
		
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('p_abk');		//[coding here] ganti tabel utamanya
				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;	
	}
	function ambil_nkr_kompetensi($id){
		$query = $this->db->get_where('nkr_kompetensi',array('id_jabatan'=>$id));
		return $query->result_array();
	}
	function id_butir_kegiatan_all($id)
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,
				round(bd.angka_kredit,4) as angka_kredit,round(bd.keterangan_jumlah,4) as keterangan_jumlah,
				round(bd.konstanta,4) as konstanta,round(bd.wpk,4) as wpk,round(bd.formasi,4) as formasi,
				round(bd.vol1th,1) as vol1th,round(bd.wpv,4) as wpv,bd.jam_efektif,
				if(bd.status_bk_detil = '0' ,'PNS AUTO COUNT',if(bd.status_bk_detil = '1' ,'NON PNS / SWASTA AUTO COUNT',
				if(bd.status_bk_detil = '2' ,'TANPA KONSTANTA AUTO COUNT',if(bd.status_bk_detil = '3' ,'PNS',
				if(bd.status_bk_detil = '4' ,'NON PNS / SWASTA','TANPA KONSTANTA'))))) as status_bk_detil	
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
				//	 case 'nama_pegawai' : $nmf="pegawai.nama_pegawai";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('bd.id_abk_detil',$id);
		
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('p_bk_detil bd');
		$this->db->join('nkr_kompetensi bk', 'bk.id_kompetensi=bd.id_kompetensi','left');
		$this->db->where('bd.id_abk_detil',$id);
			
		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'nama_pegawai' : $nmf="pegawai.nama_pegawai";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('bd.id_abk_detil',$id);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('p_bk_detil bd');
		$this->db->join('nkr_kompetensi bk', 'bk.id_kompetensi=bd.id_kompetensi','left');
		$this->db->where('bd.id_abk_detil',$id);
		
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('p_bk_detil');		//[coding here] ganti tabel utamanya
				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;	
	}
    function jumlah_record_filter_injab($id_unit,$periode,$id_jabatan_fungsional)    //igd.php untuk menampilkan jumlah antrian di igd saja
    {
		$this->db->join('p_abk', 'p_abk.id_abk=p_abk_detil.id_abk','left');
        $this->db->where("periode", $periode);
        $this->db->where("id_jabatan_fungsional", $id_jabatan_fungsional);
        $this->db->where("id_unit", $id_unit);
        $query = $this->db->select("COUNT(*) as num")->get_where('p_abk_detil');
        $result = $query->row();
        if(isset($result)) 
            return $result->num;
        return 0;
    }
    function jumlah_record_filter_pemenuhan($id_unit,$periode,$id_jabatan_fungsional)    //igd.php untuk menampilkan jumlah antrian di igd saja
    {
        $this->db->where("periode_pemenuhan", $periode);
        $this->db->where("id_jabatan_fungsional", $id_jabatan_fungsional);
        $this->db->where("id_unit", $id_unit);
        $query = $this->db->select("COUNT(*) as num")->get_where('p_abk_pemenuhan');
        $result = $query->row();
        if(isset($result)) 
            return $result->num;
        return 0;
    }
    function jumlah_record_filter_injab_edit($id_unit,$periode,$periode_lama,$id_jabatan_fungsional)    //igd.php untuk menampilkan jumlah antrian di igd saja
    {
		$this->db->join('p_abk', 'p_abk.id_abk=p_abk_detil.id_abk','left');
        $this->db->where("periode", $periode);
        $this->db->where("periode !=", $periode_lama);
        $this->db->where("id_jabatan_fungsional", $id_jabatan_fungsional);
        $this->db->where("id_unit", $id_unit);
        $query = $this->db->select("COUNT(*) as num")->get_where('p_abk_detil');
        $result = $query->row();
        if(isset($result)) 
            return $result->num;
        return 0;
    }
    function jumlah_record_filter_bk_detil_edit($id) 
    {
        $query = $this->db->select("COUNT(*) as num")->get_where('p_bk_detil',array('id_abk_detil'=>$id));
        $result = $query->row();
        if(isset($result)) 
            return $result->num;
        return 0;
    }
	function simpan_injab($id_unit,$id_pegawai){
		$kode = $this->m_rancak->kode_generator_urut(15,'AB');
		$data_pendaftaran = array(
			'id_abk' => $kode,
			'id_unit' => $this->session->unit,
			'id_struktur_jabatan' => $this->input->post('id_struktur_jabatan'),
			'barcode_pegawai' => $this->session->barcode_pegawai
		);
		$this->db->insert('p_abk', $data_pendaftaran);
		return $kode;
	}
	function ambil_abk_pemenuhan($id_unit,$id_jabatan_fungsional){
		$this->db->where('id_unit',$id_unit);
		$this->db->where('id_jabatan_fungsional',$id_jabatan_fungsional);
		$this->db->order_by('periode_pemenuhan','asc');
		$query = $this->db->get('p_abk_pemenuhan');
		return $query->result_array();		
	}
	function rubahabk_pemenuhan($id_abk_pemenuhan,$jml_pemenuhan,$jml_realisasi){
		$data_pendaftaran = array(
			'jml_pemenuhan' => $jml_pemenuhan,
			'jml_realisasi' => $jml_realisasi
		);
		$this->db->where('id_abk_pemenuhan',$id_abk_pemenuhan);
		$this->db->update('p_abk_pemenuhan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}
	function edit_abk_pemenuhan(){
		$id_abk_pemenuhan = $this->input->post('id_abk_pemenuhan[]');
		$jml_pemenuhan = $this->input->post('jml_pemenuhan[]');
		$jml_realisasi = $this->input->post('jml_realisasi[]');
		$jml_kode = count($id_abk_pemenuhan);
		for ($i=0;$i<$jml_kode;$i++){ 					
			$this->rubahabk_pemenuhan($id_abk_pemenuhan[$i],$jml_pemenuhan[$i],$jml_realisasi[$i]);
		}
	}
	function simpan_abk_pemenuhan(){
		$periode = $this->input->post('periode');
		$tgl_periode = $periode."-01-01";
		$kode = $this->m_rancak->kode_generator_urut(15,'AP');
		$data_pendaftaran = array(
			'id_abk_pemenuhan' => $kode,
			'periode_pemenuhan' => $tgl_periode,
			'id_jabatan_fungsional' => $this->input->post('id_jabatan_fungsional'),
			'id_unit' => $this->session->unit,
			'jml_pemenuhan' => $this->input->post('jml_pemenuhan'),
			'jml_realisasi' => $this->input->post('jml_realisasi')
		);
		return $this->db->insert('p_abk_pemenuhan', $data_pendaftaran);
	}
	function simpan_injab_detil($id){
		$Kosong = "";
		$periode = $this->input->post('periode');
		$tgl_periode = $periode."-01-01";
		$kode = $this->m_rancak->kode_generator_urut(15,'AD');
		$data_pendaftaran = array(
			'id_abk_detil' => $kode,
			'periode' => $tgl_periode,
			'id_abk' => $id,
			'id_jabatan_fungsional' => $this->input->post('id_jabatan_fungsional'),
		);
		$this->db->insert('p_abk_detil', $data_pendaftaran);
		return $kode;	
	}
	function ambil_injab4new($id){
		$query = $this->db->get_where('p_abk_detil',array('id_abk_detil'=>$id));
		return $query->row_array();		
	}
	function simpan_copy_injab_detil($id,$id_injab_detil){
		$injabold = $this->ambil_injab4new($id_injab_detil);
		$Kosong = "";
		$tugas_jabatan = $injabold['tugas_jabatan'];
		$iktisar_jabatan = $injabold['iktisar_jabatan'];
		$pengetahuan_kerja = $injabold['pengetahuan_kerja'];
		$ketrampilan = $injabold['ketrampilan'];
		$pendidikan_formal = $injabold['pendidikan_formal'];
		$pelatihan = $injabold['pelatihan'];
		$pengalaman = $injabold['pengalaman'];
		$fungsi_kerja = $injabold['fungsi_kerja'];
		$wewenang = $injabold['wewenang'];
		$tanggung_jawab = $injabold['tanggung_jawab'];
		$hasil_kerja = $injabold['hasil_kerja'];
		$bahan_kerja = $injabold['bahan_kerja'];
		$perangkat_kerja = $injabold['perangkat_kerja'];
		$hubungan_jabatan = $injabold['hubungan_jabatan'];
		$kondisi_tempat_kerja = $injabold['kondisi_tempat_kerja'];
		$upaya_fisik = $injabold['upaya_fisik'];
		$resiko_bahaya = $injabold['resiko_bahaya'];
		$syarat_jabatan = $injabold['syarat_jabatan'];
		$pangkat = $injabold['pangkat'];
		$bakat_kerja = $injabold['bakat_kerja'];
		$temperamen_kerja = $injabold['temperamen_kerja'];
		$minat_kerja = $injabold['minat_kerja'];
//		$id_butir_kegiatan = $injabold['id_butir_kegiatan'];
		$total = $injabold['total'];
		$pns = $injabold['pns'];
		$cpns = $injabold['cpns'];
		$blud = $injabold['blud'];
		$no_urut = $injabold['no_urut'];
		$average = $injabold['average'];
		$formasi = $injabold['formasi'];
		$periode = $this->input->post('periode');
		$tgl_periode = $periode."-01-01";
		$kode = $this->m_rancak->kode_generator_urut(15,'AD');
		$data_pendaftaran = array(
			'id_abk_detil' => $kode,
			'periode' => $tgl_periode,
			'id_abk' => $id,
			'id_jabatan_fungsional' => $this->input->post('id_jabatan_fungsional'),
			'no_urut' => $no_urut,
			'tugas_jabatan' => $tugas_jabatan,
			'iktisar_jabatan' => $iktisar_jabatan,
			'pengetahuan_kerja' => $pengetahuan_kerja,
			'ketrampilan' => $ketrampilan,
			'pendidikan_formal' => $pendidikan_formal,
			'pelatihan' => $pelatihan,
			'pengalaman' => $pengalaman,
			'fungsi_kerja' => $fungsi_kerja,
			'wewenang' => $wewenang,
			'tanggung_jawab' => $tanggung_jawab,
			'hasil_kerja' => $hasil_kerja,
			'bahan_kerja' => $bahan_kerja,
			'perangkat_kerja' => $perangkat_kerja,
			'hubungan_jabatan' => $hubungan_jabatan,
			'kondisi_tempat_kerja' => $kondisi_tempat_kerja,
			'upaya_fisik' => $upaya_fisik,
			'resiko_bahaya' => $resiko_bahaya,
			'syarat_jabatan' => $syarat_jabatan,
			'pangkat' => $pangkat,
			'bakat_kerja' => $bakat_kerja,
			'temperamen_kerja' => $temperamen_kerja,
			'minat_kerja' => $minat_kerja,
//			'id_butir_kegiatan' => $id_butir_kegiatan,
			'total' => 0,
			'pns' => 0,
			'cpns' => 0,
			'blud' => 0,
			'average' => 0,
			'formasi' => 0
		);
		$this->db->insert('p_abk_detil', $data_pendaftaran);
		return $kode;	
	}
	function ambil_injab_detil($id){
	//	$this->db->select("*,ijd.id_abk,ijd.id_abk_detil");
		$this->db->join('p_abk ij', 'ij.id_abk=ijd.id_abk','left');
		$this->db->join('ol_unit ou', 'ou.id_unit=ij.id_unit','left');
		$this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=ijd.id_jabatan_fungsional','left');
		$this->db->join('srt_struktur_jabatan sj', 'sj.id_struktur_jabatan=ij.id_struktur_jabatan','left');
		$q = $this->db->get_where('p_abk_detil ijd',array('ijd.id_abk_detil'=>$id));
		return $q->row_array();
	}
	function ambil_all_abk_pola($id){
	//	$this->db->select("*,ijd.id_abk,ijd.id_abk_detil,ij.id_unit");
/*		$this->db->join('p_abk ij', 'ij.id_abk=ijd.id_abk','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=ijd.id_jabatan_fungsional','left');
		$q = $this->db->get_where('p_abk_detil ijd',array('year(periode)'=>$id));*/
		$this->db->join('p_abk ij', 'ij.id_abk=ijd.id_abk','left');
		$this->db->join('ol_unit ou', 'ou.id_unit=ij.id_unit','left');
		$this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=ijd.id_jabatan_fungsional','left');
		$this->db->join('srt_struktur_jabatan sj', 'sj.id_struktur_jabatan=ij.id_struktur_jabatan','left');
		$q = $this->db->get_where('p_abk_detil ijd',array('ijd.id_abk_detil'=>$id));
		return $q->result_array();
	}
	function ambil_all_abk_e($id,$unit){
		$this->db->join('p_abk ij', 'ij.id_abk=ijd.id_abk','left');
		$this->db->join('ol_unit ou', 'ou.id_unit=ij.id_unit','left');
		$this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=ijd.id_jabatan_fungsional','left');
		$this->db->join('srt_struktur_jabatan sj', 'sj.id_struktur_jabatan=ij.id_struktur_jabatan','left');
		$q = $this->db->get_where('p_abk_detil ijd',array('periode'=>$id,'ij.id_unit'=>$unit));
		return $q->result_array();
	}
	function ambil_thn_pemenuhan($id,$periode){
		$q = $this->db->get_where('p_abk_pemenuhan',array('year(periode_pemenuhan)'=>$periode,'id_unit'=>$id));
		return $q->row_array();
	}
	function jabfung($id)	//daftar.php pasien
	{
		$this->db->where('id_jabatan', $id);
		$query = $this->db->get_where('jabatan_fungsional');
		return $query->result_array();
	}
	function edit_inform_detil(){
		$id_abk_detil = $this->input->post('id_abk_detil');
		$periode = $this->input->post('periode');
		$tgl_periode = $periode."-01-01";
	//	$jml = $this->jumlah_record_filter_bk_detil_edit($id_abk_detil);
	//	if($jml == 0){
		$data_pendaftaran = array(
			'id_jabatan_fungsional' => $this->input->post('id_jabatan_fungsional'),
			'header' => $this->input->post('header'),
			'sub_header' => $this->input->post('sub_header'),
			'sub_sub_header' => $this->input->post('sub_sub_header'),
			'header_pemenuhan' => $this->input->post('header_pemenuhan'),
			'sub_header_pemenuhan' => $this->input->post('sub_header_pemenuhan'),
			'sub_sub_header_pemenuhan' => $this->input->post('sub_sub_header_pemenuhan'),
			'header_realisasi' => $this->input->post('header_realisasi'),
			'sub_header_realisasi' => $this->input->post('sub_header_realisasi'),
			'sub_sub_header_realisasi' => $this->input->post('sub_sub_header_realisasi'),
			'periode' => $tgl_periode
		);
/*		}else{
		$data_pendaftaran = array(
			'periode' => $tgl_periode
		);			
		}*/
		$this->db->where('id_abk_detil',$id_abk_detil);
		$this->db->update('p_abk_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);
	}
	function edit_inform(){
		$id_abk = $this->input->post('id_abk');
		$data_pendaftaran = array(
			'id_struktur_jabatan' => $this->input->post('id_struktur_jabatan')
		);
		$this->db->where('id_abk',$id_abk);
		$this->db->update('p_abk', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);
	}
	function edit_no_urut(){
		$id_abk_detil = $this->input->post('id_abk_detil');
		$data_pendaftaran = array(
			'no_urut' => $this->input->post('no_urut')
		);
		$this->db->where('id_abk_detil',$id_abk_detil);
		$this->db->update('p_abk_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);
	}
	function edit_injab_detil(){
		$id_abk_detil = $this->input->post('id_abk_detil');
		$data_pendaftaran = array(
			'tugas_jabatan' => $this->input->post('tugas_jabatan'),
			'iktisar_jabatan' => $this->input->post('iktisar_jabatan'),
			'pengetahuan_kerja' => $this->input->post('pengetahuan_kerja'),
			'ketrampilan' => $this->input->post('ketrampilan'),
			'pelatihan' => $this->input->post('pelatihan'),
			'pengalaman' => $this->input->post('pengalaman')
		);
		$this->db->where('id_abk_detil',$id_abk_detil);
		$this->db->update('p_abk_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);
	}
// =========================================================
	function wewenang_all($id){
		$query = $this->db->get_where('p_wewenang',array('id_jabatan'=>$id));
		return $query->result_array();		
	}
	function butir_kegiatan_terpilih($id){
		$ids = explode(',', $id);
		$this->db->where_in('id_butir_kegiatan',$ids);
		$query = $this->db->get('butir_kegiatan');
		return $query->result_array();		
	}
	function status_butir_kegiatan_terpilih($id){
		$ids = explode(',', $id);
		$this->db->where_in('id_butir_kegiatan',$ids);
		$query = $this->db->get('butir_kegiatan');
		return $query->row_array();		
	}
	function wewenang_terpilih($id){
		$ids = explode(',', $id);
		$this->db->where_in('id_wewenang',$ids);
		$query = $this->db->get('p_wewenang');
		return $query->result_array();		
	}
	function rubah_wewenang(){
		$id_abk_detil = $this->input->post('id_abk_detil');
		$chk = $this->input->post('chk');
		$eimplo = implode(",",$chk);		
		$data_pendaftaran = array(
			'wewenang' => $eimplo
		);
		$this->db->where('id_abk_detil',$id_abk_detil);
		$this->db->update('p_abk_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function null_wewenang($id){
		$data_pendaftaran = array(
			'wewenang' => ''
		);
		$this->db->where('id_abk_detil',$id);
		$this->db->update('p_abk_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function simpan_wewenang(){
		$data_pendaftaran = array(
			'nama_wewenang' => $this->input->post('nama_wewenang'),
			'id_jabatan' => $this->input->post('id_jabatan')
		);
		return $this->db->insert('p_wewenang', $data_pendaftaran);
	}
	function tanggung_jawab_all($id){
		$query = $this->db->get_where('p_tanggung_jawab',array('id_jabatan'=>$id));
		return $query->result_array();		
	}
	function tanggung_jawab_terpilih($id){
		$ids = explode(',', $id);
		$this->db->where_in('id_tanggung_jawab',$ids);
		$query = $this->db->get('p_tanggung_jawab');
		return $query->result_array();		
	}
	function rubah_tanggung_jawab(){
		$id_abk_detil = $this->input->post('id_abk_detil');
		$chk = $this->input->post('chk');
		$eimplo = implode(",",$chk);		
		$data_pendaftaran = array(
			'tanggung_jawab' => $eimplo
		);
		$this->db->where('id_abk_detil',$id_abk_detil);
		$this->db->update('p_abk_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function simpan_tanggung_jawab(){
		$data_pendaftaran = array(
			'nama_tanggung_jawab' => $this->input->post('nama_tanggung_jawab'),
			'id_jabatan' => $this->input->post('id_jabatan')
		);
		return $this->db->insert('p_tanggung_jawab', $data_pendaftaran);
	}
	function null_tanggung_jawab($id){
		$data_pendaftaran = array(
			'tanggung_jawab' => ''
		);
		$this->db->where('id_abk_detil',$id);
		$this->db->update('p_abk_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function hasil_kerja_all($id){
		$query = $this->db->get_where('p_hasil_kerja',array('id_jabatan'=>$id));
		return $query->result_array();		
	}
	function hasil_kerja_terpilih($id){
		$ids = explode(',', $id);
		$this->db->where_in('id_hasil_kerja',$ids);
		$query = $this->db->get('p_hasil_kerja');
		return $query->result_array();		
	}
	function rubah_hasil_kerja(){
		$id_abk_detil = $this->input->post('id_abk_detil');
		$chk = $this->input->post('chk');
		$eimplo = implode(",",$chk);		
		$data_pendaftaran = array(
			'hasil_kerja' => $eimplo
		);
		$this->db->where('id_abk_detil',$id_abk_detil);
		$this->db->update('p_abk_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function simpan_hasil_kerja(){
		$data_pendaftaran = array(
			'nama_hasil_kerja' => $this->input->post('nama_hasil_kerja'),
			'satuan_hasil_kerja' => $this->input->post('satuan_hasil_kerja'),
			'id_jabatan' => $this->input->post('id_jabatan')
		);
		return $this->db->insert('p_hasil_kerja', $data_pendaftaran);
	}
	function null_hasil_kerja($id){
		$data_pendaftaran = array(
			'hasil_kerja' => ''
		);
		$this->db->where('id_abk_detil',$id);
		$this->db->update('p_abk_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}	
	function bahan_kerja_all($id){
		$query = $this->db->get_where('p_bahan_kerja',array('id_jabatan'=>$id));
		return $query->result_array();		
	}
	function bahan_kerja_terpilih($id){
		$ids = explode(',', $id);
		$this->db->where_in('id_bahan_kerja',$ids);
		$query = $this->db->get('p_bahan_kerja');
		return $query->result_array();		
	}
	function rubah_bahan_kerja(){
		$id_abk_detil = $this->input->post('id_abk_detil');
		$chk = $this->input->post('chk');
		$eimplo = implode(",",$chk);		
		$data_pendaftaran = array(
			'bahan_kerja' => $eimplo
		);
		$this->db->where('id_abk_detil',$id_abk_detil);
		$this->db->update('p_abk_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function simpan_bahan_kerja(){
		$data_pendaftaran = array(
			'nama_bahan_kerja' => $this->input->post('nama_bahan_kerja'),
			'penggunaan' => $this->input->post('penggunaan'),
			'id_jabatan' => $this->input->post('id_jabatan')
		);
		return $this->db->insert('p_bahan_kerja', $data_pendaftaran);
	}
	function null_bahan_kerja($id){
		$data_pendaftaran = array(
			'bahan_kerja' => ''
		);
		$this->db->where('id_abk_detil',$id);
		$this->db->update('p_abk_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}	
	function perangkat_kerja_all($id){
		$query = $this->db->get_where('p_perangkat_kerja');
		return $query->result_array();		
	}
	function perangkat_kerja_terpilih($id){
		$ids = explode(',', $id);
		$this->db->where_in('id_perangkat_kerja',$ids);
		$query = $this->db->get('p_perangkat_kerja');
		return $query->result_array();		
	}
	function rubah_perangkat_kerja(){
		$id_abk_detil = $this->input->post('id_abk_detil');
		$chk = $this->input->post('chk');
		$eimplo = implode(",",$chk);		
		$data_pendaftaran = array(
			'perangkat_kerja' => $eimplo
		);
		$this->db->where('id_abk_detil',$id_abk_detil);
		$this->db->update('p_abk_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function simpan_perangkat_kerja(){
		$data_pendaftaran = array(
			'nama_perangkat_kerja' => $this->input->post('nama_perangkat_kerja'),
			'penggunaan' => $this->input->post('penggunaan')
		);
		return $this->db->insert('p_perangkat_kerja', $data_pendaftaran);
	}
	function null_perangkat_kerja($id){
		$data_pendaftaran = array(
			'perangkat_kerja' => ''
		);
		$this->db->where('id_abk_detil',$id);
		$this->db->update('p_abk_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function hubungan_jabatan_all($id){
		$query = $this->db->get_where('p_hubungan_jabatan');
		return $query->result_array();		
	}
	function hubungan_jabatan_terpilih($id){
		$ids = explode(',', $id);
		$this->db->where_in('id_hubungan_jabatan',$ids);
		$query = $this->db->get('p_hubungan_jabatan');
		return $query->result_array();		
	}
	function rubah_hubungan_jabatan(){
		$id_abk_detil = $this->input->post('id_abk_detil');
		$chk = $this->input->post('chk');
		$eimplo = implode(",",$chk);		
		$data_pendaftaran = array(
			'hubungan_jabatan' => $eimplo
		);
		$this->db->where('id_abk_detil',$id_abk_detil);
		$this->db->update('p_abk_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function simpan_hubungan_jabatan(){
		$data_pendaftaran = array(
			'nama_hubungan_jabatan' => $this->input->post('nama_hubungan_jabatan'),
			'unit_kerja' => $this->input->post('unit_kerja'),
			'hal' => $this->input->post('hal')
		);
		return $this->db->insert('p_hubungan_jabatan', $data_pendaftaran);
	}
	function null_hubungan_jabatan($id){
		$data_pendaftaran = array(
			'hubungan_jabatan' => ''
		);
		$this->db->where('id_abk_detil',$id);
		$this->db->update('p_abk_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function kondisi_tempat_all($id){
		$query = $this->db->get_where('p_kondisi_tempat');
		return $query->result_array();		
	}
	function kondisi_tempat_terpilih($id){
		$ids = explode(',', $id);
		$this->db->where_in('id_kondisi_tempat',$ids);
		$query = $this->db->get('p_kondisi_tempat');
		return $query->result_array();		
	}
	function rubah_kondisi_tempat(){
		$id_abk_detil = $this->input->post('id_abk_detil');
		$chk = $this->input->post('chk');
		$eimplo = implode(",",$chk);		
		$data_pendaftaran = array(
			'kondisi_tempat_kerja' => $eimplo
		);
		$this->db->where('id_abk_detil',$id_abk_detil);
		$this->db->update('p_abk_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function simpan_kondisi_tempat(){
		$data_pendaftaran = array(
			'aspek' => $this->input->post('aspek'),
			'faktor' => $this->input->post('faktor')
		);
		return $this->db->insert('p_kondisi_tempat', $data_pendaftaran);
	}
	function null_kondisi_tempat($id){
		$data_pendaftaran = array(
			'kondisi_tempat_kerja' => ''
		);
		$this->db->where('id_abk_detil',$id);
		$this->db->update('p_abk_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function upaya_fisik_all($id){
		$query = $this->db->get_where('p_upaya_fisik');
		return $query->result_array();		
	}
	function upaya_fisik_terpilih($id){
		$ids = explode(',', $id);
		$this->db->where_in('id_upaya_fisik',$ids);
		$query = $this->db->get('p_upaya_fisik');
		return $query->result_array();		
	}
	function rubah_upaya_fisik(){
		$id_abk_detil = $this->input->post('id_abk_detil');
		$chk = $this->input->post('chk');
		$eimplo = implode(",",$chk);		
		$data_pendaftaran = array(
			'upaya_fisik' => $eimplo
		);
		$this->db->where('id_abk_detil',$id_abk_detil);
		$this->db->update('p_abk_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function null_upaya_fisik($id){
		$data_pendaftaran = array(
			'upaya_fisik' => ''
		);
		$this->db->where('id_abk_detil',$id);
		$this->db->update('p_abk_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function pendidikan_all($id){
		$query = $this->db->get_where('kol_pendidikan');
		return $query->result_array();		
	}
	function pendidikan_terpilih($id){
		$ids = explode(',', $id);
		$this->db->where_in('id_pendidikan',$ids);
		$query = $this->db->get('kol_pendidikan');
		return $query->result_array();		
	}
	function rubah_pendidikan(){
		$id_abk_detil = $this->input->post('id_abk_detil');
		$chk = $this->input->post('chk');
		$eimplo = implode(",",$chk);		
		$data_pendaftaran = array(
			'pendidikan_formal' => $eimplo
		);
		$this->db->where('id_abk_detil',$id_abk_detil);
		$this->db->update('p_abk_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function simpan_pendidikan(){
		$data_pendaftaran = array(
			'nama_pendidikan' => $this->input->post('nama_pendidikan')
		);
		return $this->db->insert('pendidikan', $data_pendaftaran);
	}
	function null_pendidikan($id){
		$data_pendaftaran = array(
			'pendidikan_formal' => ''
		);
		$this->db->where('id_abk_detil',$id);
		$this->db->update('p_abk_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function resiko_bahaya_all($id){
		$query = $this->db->get_where('p_resiko_bahaya');
		return $query->result_array();		
	}
	function resiko_bahaya_terpilih($id){
		$ids = explode(',', $id);
		$this->db->where_in('id_resiko_bahaya',$ids);
		$query = $this->db->get('p_resiko_bahaya');
		return $query->result_array();		
	}
	function rubah_resiko_bahaya(){
		$id_abk_detil = $this->input->post('id_abk_detil');
		$chk = $this->input->post('chk');
		$eimplo = implode(",",$chk);		
		$data_pendaftaran = array(
			'resiko_bahaya' => $eimplo
		);
		$this->db->where('id_abk_detil',$id_abk_detil);
		$this->db->update('p_abk_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function simpan_resiko_bahaya(){
		$data_pendaftaran = array(
			'fisik' => $this->input->post('fisik'),
			'penyebab' => $this->input->post('penyebab')
		);
		return $this->db->insert('p_resiko_bahaya', $data_pendaftaran);
	}
	function null_resiko_bahaya($id){
		$data_pendaftaran = array(
			'resiko_bahaya' => ''
		);
		$this->db->where('id_abk_detil',$id);
		$this->db->update('p_abk_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function pangkat_all($id){
		$query = $this->db->get_where('p_pangkat');
		return $query->result_array();		
	}
	function pangkat_terpilih($id){
		$ids = explode(',', $id);
		$this->db->where_in('id_pangkat',$ids);
		$query = $this->db->get('p_pangkat');
		return $query->result_array();		
	}
	function rubah_pangkat(){
		$id_abk_detil = $this->input->post('id_abk_detil');
		$chk = $this->input->post('chk');
		$eimplo = implode(",",$chk);		
		$data_pendaftaran = array(
			'pangkat' => $eimplo
		);
		$this->db->where('id_abk_detil',$id_abk_detil);
		$this->db->update('p_abk_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function null_pangkat($id){
		$data_pendaftaran = array(
			'pangkat' => ''
		);
		$this->db->where('id_abk_detil',$id);
		$this->db->update('p_abk_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function bakat_kerja_all($id){
		$query = $this->db->get_where('p_bakat_kerja');
		return $query->result_array();		
	}
	function bakat_kerja_terpilih($id){
		$ids = explode(',', $id);
		$this->db->where_in('id_bakat_kerja',$ids);
		$query = $this->db->get('p_bakat_kerja');
		return $query->result_array();		
	}
	function rubah_bakat_kerja(){
		$id_abk_detil = $this->input->post('id_abk_detil');
		$chk = $this->input->post('chk');
		$eimplo = implode(",",$chk);		
		$data_pendaftaran = array(
			'bakat_kerja' => $eimplo
		);
		$this->db->where('id_abk_detil',$id_abk_detil);
		$this->db->update('p_abk_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function null_bakat_kerja($id){
		$data_pendaftaran = array(
			'bakat_kerja' => ''
		);
		$this->db->where('id_abk_detil',$id);
		$this->db->update('p_abk_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function temperamen_kerja_all($id){
		$query = $this->db->get_where('p_temperamen_kerja');
		return $query->result_array();		
	}
	function temperamen_kerja_terpilih($id){
		$ids = explode(',', $id);
		$this->db->where_in('id_temperamen_kerja',$ids);
		$query = $this->db->get('p_temperamen_kerja');
		return $query->result_array();		
	}
	function rubah_temperamen_kerja(){
		$id_abk_detil = $this->input->post('id_abk_detil');
		$chk = $this->input->post('chk');
		$eimplo = implode(",",$chk);		
		$data_pendaftaran = array(
			'temperamen_kerja' => $eimplo
		);
		$this->db->where('id_abk_detil',$id_abk_detil);
		$this->db->update('p_abk_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function null_temperamen_kerja($id){
		$data_pendaftaran = array(
			'temperamen_kerja' => ''
		);
		$this->db->where('id_abk_detil',$id);
		$this->db->update('p_abk_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function minat_kerja_all($id){
		$query = $this->db->get_where('p_minat_kerja');
		return $query->result_array();		
	}
	function minat_kerja_terpilih($id){
		$ids = explode(',', $id);
		$this->db->where_in('id_minat_kerja',$ids);
		$query = $this->db->get('p_minat_kerja');
		return $query->result_array();		
	}
	function rubah_minat_kerja(){
		$id_abk_detil = $this->input->post('id_abk_detil');
		$chk = $this->input->post('chk');
		$eimplo = implode(",",$chk);		
		$data_pendaftaran = array(
			'minat_kerja' => $eimplo
		);
		$this->db->where('id_abk_detil',$id_abk_detil);
		$this->db->update('p_abk_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function null_minat_kerja($id){
		$data_pendaftaran = array(
			'minat_kerja' => ''
		);
		$this->db->where('id_abk_detil',$id);
		$this->db->update('p_abk_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function fungsi_kerja_all($id){
		$query = $this->db->get_where('p_fungsi_kerja');
		return $query->result_array();		
	}
	function fungsi_kerja_terpilih($id){
		$ids = explode(',', $id);
		$this->db->where_in('id_fungsi_kerja',$ids);
		$query = $this->db->get('p_fungsi_kerja');
		return $query->result_array();		
	}
	function rubah_fungsi_kerja(){
		$id_abk_detil = $this->input->post('id_abk_detil');
		$chk = $this->input->post('chk');
		$eimplo = implode(",",$chk);		
		$data_pendaftaran = array(
			'fungsi_kerja' => $eimplo
		);
		$this->db->where('id_abk_detil',$id_abk_detil);
		$this->db->update('p_abk_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function simpan_fungsi_kerja(){
		$data_pendaftaran = array(
			'id_fungsi_kerja' => strtoupper($this->input->post('id_fungsi_kerja')),
			'arti' => $this->input->post('arti'),
			'deskripsi' => $this->input->post('deskripsi')
		);
		return $this->db->insert('p_fungsi_kerja', $data_pendaftaran);
	}
	function null_fungsi_kerja($id){
		$data_pendaftaran = array(
			'fungsi_kerja' => ''
		);
		$this->db->where('id_abk_detil',$id);
		$this->db->update('p_abk_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function totalin_jumlah_pegawai($id){
		$this->db->select('SUM(formasi) as jumlah');
		$this->db->where('id_abk_detil',$id); 
		$q = $this->db->get('p_bk_detil')->row_array();
		$formasi = round($q['jumlah'],0);
		$injab = $this->m_umum->ambil_data('p_abk_detil','id_abk_detil',$id);
		$pns = $injab['pns'];
		$cpns = $injab['cpns'];
		$blud = $injab['blud'];
		$pppk = $injab['pppk'];
		$pegawai = $pns + $cpns + $blud + $pppk;
		$average = $pegawai - $formasi;		
		$data_pendaftaran = array(
			'pns' => $pns,
			'cpns' => $cpns,
			'blud' => $blud,
			'pppk' => $pppk,
			'total' => $formasi,
			'average' => $average
		);
		$this->db->where('id_abk_detil',$id);
		$this->db->update('p_abk_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
// =========================================================
	function ambil_num_volume_abk($periode,$id_kompetensi){
		$this->db->select('SUM(jml_logbook) as jumlah, SUM(wkt_kewenangan) as waktu');
		$this->db->join('nkr_kewenangan kkd', 'kkd.id_kewenangan=l.id_kewenangan','left');
	//	$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=kkd.id_kompetensi','left');
	//	$this->db->where('id_ruangan',$id_unit);
		$this->db->where('id_kompetensi',$id_kompetensi);
		$this->db->where("year(l.tgl_logbook)", $periode);
		$q = $this->db->get_where('ol_logbook l');	
		return $q->row_array();	
	}
	function rubah_jumlah_pegawai(){
		$id_abk_detil = $this->input->post('id_abk_detil');	
		$this->db->select('SUM(formasi) as jumlah');
		$this->db->where('id_abk_detil',$id_abk_detil); 
		$q = $this->db->get('p_bk_detil')->row_array();
		$formasi = round($q['jumlah'],0);
//		$ijd = $this->cari_p_injab($id_injab_detil);
		$pns = $this->input->post('pns');
		$cpns = $this->input->post('cpns');
		$blud = $this->input->post('blud');
		$pppk = $this->input->post('pppk');
		$pegawai = $pns + $cpns + $blud + $pppk;
		$average = $pegawai - $formasi;		
		$data_pendaftaran = array(
			'pns' => $this->input->post('pns'),
			'cpns' => $this->input->post('cpns'),
			'blud' => $this->input->post('blud'),
			'pppk' => $this->input->post('pppk'),
			'total' => $formasi,
			'average' => $average
		);
		$this->db->where('id_abk_detil',$id_abk_detil);
		$this->db->update('p_abk_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function rubah_bk(){
		$id_abk_detil = $this->input->post('id_abk_detil');
		$chk = $this->input->post('chk[]');
		$jml_kode = count($chk);
		for ($i=0;$i<$jml_kode;$i++){ 	
		$this->db->select("COUNT(*) as num");
		$this->db->where('id_abk_detil',$id_abk_detil);
		$this->db->where('id_kompetensi',$chk[$i]);
		$q = $this->db->get('p_bk_detil')->row();
		$jml = $q->num;
			if($jml == 0){	
				$kode = $this->m_rancak->kode_generator_urut(15,'BD');
				$konstanta = '0.004';
				$data_butir = array(
					'id_bk_detil' => $kode,					
					'id_abk_detil' => $id_abk_detil,					
					'id_kompetensi' => $chk[$i],														
					'konstanta' => $konstanta,									
					'jam_efektif' => 1250
				);
				$this->db->insert('p_bk_detil', $data_butir);	
			}				
		}
		$eimplo = implode(",",$chk);
/* 		$this->hapus_butir_kegiatan4new($id_abk_detil,$eimplo); */
		$data_pendaftaran = array(
			'id_kompetensi' => $eimplo
		);
		$this->db->where('id_abk_detil',$id_abk_detil);
		$this->db->update('p_abk_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function ambil_bk_detil4new($id){
		$this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=p_bk_detil.id_kompetensi','left');
		$query = $this->db->get_where('p_bk_detil',array('id_injab_detil'=>$id));
		return $query->result_array();		
	}
    function delete_package($id,$id_injab_detil){
        $this->db->trans_start();
            $this->db->delete('bk_detil', array('id_butir_kegiatan' => $id,'id_abk_detil' => $id_injab_detil));
        $this->db->trans_complete();
    } 
	function hapus_butir_kegiatan4new($id_injab_detil,$id){
		$buketdetold = $this->ambil_bk_detil4new($id_injab_detil);
		foreach($buketdetold as $row) {
			if(!in_array($row['id_butir_kegiatan'], explode(",",$id))) {
			  $this->delete_package($row['id_butir_kegiatan'],$id_injab_detil);
			}
		}		
	}
}