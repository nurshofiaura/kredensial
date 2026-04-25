<?php
class M_im extends CI_model{
	function standar_mutu_all()
	{
		$idx = explode(',', $this->session->mas_ins);
	//	$ids = explode(',', $unit);
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
$this->db->where('se.id_unit',$this->session->unit);	
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_equipment se');	
	    $this->db->where('se.id_unit',$this->session->unit);

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
$this->db->where('se.id_unit',$this->session->unit);	
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('ol_equipment se');	
	    $this->db->where('se.id_unit',$this->session->unit);				

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
 		$kondisi=array('id_unit'=>$this->session->unit);
		$jml = $this->m_umum->jumlah_record_filter('ol_equipment',$kondisi);
	//	$jml = $this->m_umum->jumlah_record_tabel('sn_standar_mutu');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_equipment(){
		$kode = $this->m_rancak->kode_generator_urut(15,'EQ');
		$data_pendaftaran = array(
			'id_equipment' => $kode,
			'id_unit' => $this->session->unit,
			'pembuat_equipment' => $this->session->barcode_pegawai,
			'nama_equipment' => $this->input->post('nama_equipment'),
			'status_equipment' => $this->input->post('status_equipment')
		);
		return $this->db->insert('ol_equipment', $data_pendaftaran);
	}
	function edit_equipment(){
		$id_equipment = $this->input->post('id_equipment');	
		$data_pendaftaran = array(
			'nama_equipment' => $this->input->post('nama_equipment'),
			'status_equipment' => $this->input->post('status_equipment')
		);
		$this->db->where('id_equipment',$id_equipment);
		$this->db->update('ol_equipment', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function simpan_sn_standar_mutu(){
		$data_pendaftaran = array(
			'nama_standar_mutu' => $this->input->post('nama_standar_mutu'),
			'id_unit' => $this->session->unit,
			'id_jabatan' => $this->session->id_jabatan,
			'pembuat_standar_mutu' => $this->session->id_pegawai,
			'status_standar_mutu' => $this->input->post('status_standar_mutu')
		);
		$this->db->insert('sn_standar_mutu', $data_pendaftaran);
		return $this->db->insert_id();
	}
	function edit_sn_standar_mutu(){
		$id_standar_mutu = $this->input->post('id_standar_mutu');
		$data_pendaftaran = array(
			'nama_standar_mutu' => $this->input->post('nama_standar_mutu'),
			'status_standar_mutu' => $this->input->post('status_standar_mutu')
		);
		$this->db->where('id_standar_mutu',$id_standar_mutu);
		$this->db->update('sn_standar_mutu', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function limbah_all()
	{
	//	$ids = explode(',', $unit);
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
 $this->db->where('se.id_unit',$this->session->unit);				

			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_equipment se');	
	    $this->db->where('se.id_unit',$this->session->unit);

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
$this->db->where('se.id_unit',$this->session->unit);
			}
		  }
		}

	    $this->db->from('ol_equipment se');	
	    $this->db->where('se.id_unit',$this->session->unit);				

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
 		$kondisi=array('id_unit'=>$this->session->unit);
		$jml = $this->m_umum->jumlah_record_filter('ol_equipment',$kondisi);
//		$jml = $this->m_umum->jumlah_record_tabel('sn_limbah');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_sn_limbah(){
		$standar_mutu = $this->input->post('standar_mutu');
		$standar_mutu = str_replace(',', '.', $standar_mutu);
		$range_mutu = $this->input->post('range_mutu');
		$range_mutu = str_replace(',', '.', $range_mutu);
		$data_pendaftaran = array(
			'nama_limbah' => $this->input->post('nama_limbah'),
			'id_standar_mutu' => $this->input->post('id_standar_mutu'),
			'standar_mutu' => $standar_mutu,
			'range_mutu' => $range_mutu,
			'satuan_limbah' => $this->input->post('satuan_limbah'),
			'pembuat_limbah' => $this->session->id_pegawai,
			'status_limbah' => $this->input->post('status_limbah')
		);
		$this->db->insert('sn_limbah', $data_pendaftaran);
		return $this->db->insert_id();
	}
	function edit_sn_limbah(){
		$id_limbah = $this->input->post('id_limbah');
		$standar_mutu = $this->input->post('standar_mutu');
		$standar_mutu = str_replace(',', '.', $standar_mutu);
		$range_mutu = $this->input->post('range_mutu');
		$range_mutu = str_replace(',', '.', $range_mutu);
		$data_pendaftaran = array(
			'nama_limbah' => $this->input->post('nama_limbah'),
			'id_standar_mutu' => $this->input->post('id_standar_mutu'),
			'standar_mutu' => $standar_mutu,
			'range_mutu' => $range_mutu,
			'satuan_limbah' => $this->input->post('satuan_limbah'),
			'status_limbah' => $this->input->post('status_limbah')
		);
		$this->db->where('id_limbah',$id_limbah);
		$this->db->update('sn_limbah', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function sumber_emisi_all()
	{
		$idx = explode(',', $this->session->mas_ins);
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
	    $this->db->where('sm.id_jabatan',$this->session->id_jabatan);
	    $this->db->where_in('sm.id_instansi', $idx);		

			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('sn_sumber_emisi se');	
	    $this->db->join('sn_standar_mutu sm', 'sm.id_standar_mutu=se.id_standar_mutu','left');
	    $this->db->join('kol_working kw', 'kw.id_working=sm.id_instansi','left');
	    $this->db->join('sn_opsi_pengukuran sop', 'sop.id_opsi_pengukuran=se.id_opsi_pengukuran','left');
	    $this->db->where('sm.id_jabatan',$this->session->id_jabatan);
	    $this->db->where_in('sm.id_instansi', $idx);

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
	    $this->db->where('sm.id_jabatan',$this->session->id_jabatan);
	    $this->db->where_in('sm.id_instansi', $idx);
			}
		  }
		}

	    $this->db->from('sn_sumber_emisi se');	
	    $this->db->join('sn_standar_mutu sm', 'sm.id_standar_mutu=se.id_standar_mutu','left');	
	    $this->db->join('sn_opsi_pengukuran sop', 'sop.id_opsi_pengukuran=se.id_opsi_pengukuran','left');
	    $this->db->join('kol_working kw', 'kw.id_working=sm.id_instansi','left');	
	    $this->db->where('sm.id_jabatan',$this->session->id_jabatan);
	    $this->db->where_in('sm.id_instansi', $idx);		

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('sn_sumber_emisi');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_sn_sumber_emisi(){
		$data_pendaftaran = array(
			'nama_sumber_emisi' => $this->input->post('nama_sumber_emisi'),
			'deskripsi_sumber_emisi' => $this->input->post('deskripsi_sumber_emisi'),
			'id_standar_mutu' => $this->input->post('id_standar_mutu'),
			'id_opsi_pengukuran' => $this->input->post('id_opsi_pengukuran'),
			'status_sumber_emisi' => $this->input->post('status_sumber_emisi')
		);
		$this->db->insert('sn_sumber_emisi', $data_pendaftaran);
		return $this->db->insert_id();
	}
	function edit_sn_sumber_emisi(){
		$id_sumber_emisi = $this->input->post('id_sumber_emisi');
		$data_pendaftaran = array(
			'nama_sumber_emisi' => $this->input->post('nama_sumber_emisi'),
			'deskripsi_sumber_emisi' => $this->input->post('deskripsi_sumber_emisi'),
			'id_standar_mutu' => $this->input->post('id_standar_mutu'),
			'id_opsi_pengukuran' => $this->input->post('id_opsi_pengukuran'),
			'status_sumber_emisi' => $this->input->post('status_sumber_emisi')
		);
		$this->db->where('id_sumber_emisi',$id_sumber_emisi);
		$this->db->update('sn_sumber_emisi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function pengolah_limbah_all()
	{
		$idx = explode(',', $this->session->mas_ins);
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
	    $this->db->where('sm.id_jabatan',$this->session->id_jabatan);
	    $this->db->where_in('sm.id_instansi', $idx);				

			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('sn_pengolah_limbah se');	
	    $this->db->join('sn_standar_mutu sm', 'sm.id_standar_mutu=se.id_standar_mutu','left');
	    $this->db->join('kol_working kw', 'kw.id_working=sm.id_instansi','left');
	    $this->db->where('sm.id_jabatan',$this->session->id_jabatan);
	    $this->db->where_in('sm.id_instansi', $idx);	

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
	    $this->db->where('sm.id_jabatan',$this->session->id_jabatan);
	    $this->db->where_in('sm.id_instansi', $idx);
			}
		  }
		}

	    $this->db->from('sn_pengolah_limbah se');	
	    $this->db->join('sn_standar_mutu sm', 'sm.id_standar_mutu=se.id_standar_mutu','left');
	    $this->db->join('kol_working kw', 'kw.id_working=sm.id_instansi','left');
	    $this->db->where('sm.id_jabatan',$this->session->id_jabatan);
	    $this->db->where_in('sm.id_instansi', $idx);							

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('sn_pengolah_limbah');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_sn_pengolah_limbah(){
		$data_pendaftaran = array(
			'nama_pengolah_limbah' => $this->input->post('nama_pengolah_limbah'),
			'deskripsi_pengolah_limbah' => $this->input->post('deskripsi_pengolah_limbah'),
			'id_standar_mutu' => $this->input->post('id_standar_mutu'),
			'status_pengolah_limbah' => $this->input->post('status_pengolah_limbah')
		);
		$this->db->insert('sn_pengolah_limbah', $data_pendaftaran);
		return $this->db->insert_id();
	}
	function edit_sn_pengolah_limbah(){
		$id_pengolah_limbah = $this->input->post('id_pengolah_limbah');
		$data_pendaftaran = array(
			'nama_pengolah_limbah' => $this->input->post('nama_pengolah_limbah'),
			'deskripsi_pengolah_limbah' => $this->input->post('deskripsi_pengolah_limbah'),
			'id_standar_mutu' => $this->input->post('id_standar_mutu'),
			'status_pengolah_limbah' => $this->input->post('status_pengolah_limbah')
		);
		$this->db->where('id_pengolah_limbah',$id_pengolah_limbah);
		$this->db->update('sn_pengolah_limbah', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function lokasi_all()
	{
		$idx = explode(',', $this->session->mas_ins);
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
			$this->db->where_in("sl.id_instansi", $idx);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('sn_tps sl');	
	    $this->db->join('kol_working kw', 'kw.id_working=sl.id_instansi','left');
			$this->db->where_in("sl.id_instansi", $idx);
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
			$this->db->where_in("sl.id_instansi", $idx);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('sn_tps sl');	
	    $this->db->join('kol_working kw', 'kw.id_working=sl.id_instansi','left');			
			$this->db->where_in("sl.id_instansi", $idx);
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('sn_tps');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_sn_tps(){
		$data_pendaftaran = array(
			'nama_tps' => $this->input->post('nama_tps'),
			'id_instansi' => $this->input->post('id_instansi'),
			'status_tps' => $this->input->post('status_tps')
		);
		$this->db->insert('sn_tps', $data_pendaftaran);
		return $this->db->insert_id();
	}
	function edit_sn_tps(){
		$id_tps = $this->input->post('id_tps');
		$data_pendaftaran = array(
			'nama_tps' => $this->input->post('nama_tps'),
			'id_instansi' => $this->input->post('id_instansi'),
			'status_tps' => $this->input->post('status_tps')
		);
		$this->db->where('id_tps',$id_tps);
		$this->db->update('sn_tps', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function perlakuan_emisi_all()
	{
	//	$ids = explode(',', $unit);
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

			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('sn_perlakuan_emisi pe');	

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

			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('sn_perlakuan_emisi pe');							

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('sn_perlakuan_emisi');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_sn_perlakuan_emisi(){
		$data_pendaftaran = array(
			'nama_perlakuan_emisi' => $this->input->post('nama_perlakuan_emisi'),
			'status_perlakuan_emisi' => $this->input->post('status_perlakuan_emisi')
		);
		$this->db->insert('sn_perlakuan_emisi', $data_pendaftaran);
		return $this->db->insert_id();
	}
	function edit_sn_perlakuan_emisi(){
		$id_perlakuan_emisi = $this->input->post('id_perlakuan_emisi');
		$data_pendaftaran = array(
			'nama_perlakuan_emisi' => $this->input->post('nama_perlakuan_emisi'),
			'status_perlakuan_emisi' => $this->input->post('status_perlakuan_emisi')
		);
		$this->db->where('id_perlakuan_emisi',$id_perlakuan_emisi);
		$this->db->update('sn_perlakuan_emisi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function lhu_all($first_date,$last_date,$all)
	{
		$idx = explode(',', $this->session->mas_ins);
		$idu = explode(',', $this->session->mas_ins);
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,DATE_FORMAT(tgl_lhu,'%d-%m-%Y') as tgl_lhu";
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
	    $this->db->where('sm.id_jabatan',$this->session->id_jabatan);
	    $this->db->where('se.pembuat_lhu',$this->session->id_pegawai);			
	    if($all == 0){
	    $this->db->where('se.tgl_lhu BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('sn_lhu se');	
	    $this->db->join('sn_standar_mutu sm', 'sm.id_standar_mutu=se.id_standar_mutu','left');
	    $this->db->join('ol_unit ou', 'ou.id_unit=se.id_unit','left');
	    $this->db->where('sm.id_jabatan',$this->session->id_jabatan);
	    $this->db->where('se.pembuat_lhu',$this->session->id_pegawai);
	    if($all == 0){
	    $this->db->where('se.tgl_lhu BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
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
	    $this->db->where('sm.id_jabatan',$this->session->id_jabatan);
	    $this->db->where('se.pembuat_lhu',$this->session->id_pegawai);
	    if($all == 0){
	    $this->db->where('se.tgl_lhu BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		}
			}
		  }
		}

	    $this->db->from('sn_lhu se');	
	    $this->db->join('sn_standar_mutu sm', 'sm.id_standar_mutu=se.id_standar_mutu','left');	
	    $this->db->join('ol_unit ou', 'ou.id_unit=se.id_unit','left');	
	    $this->db->where('sm.id_jabatan',$this->session->id_jabatan);
	    $this->db->where('se.pembuat_lhu',$this->session->id_pegawai);
	    if($all == 0){
	    $this->db->where('se.tgl_lhu BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		}				

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('sn_lhu');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_sn_lhu(){
		$kode = $this->m_rancak->kode_generator(15,'');
		$tgl_lhu = $this->input->post('tgl_lhu');
		$tgl_lhu = date('Y-m-d', strtotime($tgl_lhu));
		$data_pendaftaran = array(
			'id_standar_mutu' => $this->input->post('id_standar_mutu'),
			'barcode_lhu' => $kode,
			'no_lhu' => $this->input->post('no_lhu'),
			'tgl_lhu' => $tgl_lhu,
			'pembuat_lhu' => $this->session->id_pegawai,
			'id_unit' => $this->session->unit
		);
		return $this->db->insert('sn_lhu', $data_pendaftaran);
	//	return $this->db->insert_id();
	}
	function edit_sn_lhu(){
		$id_lhu = $this->input->post('id_lhu');
		$tgl_lhu = $this->input->post('tgl_lhu');
		$tgl_lhu = date('Y-m-d', strtotime($tgl_lhu));
		$data_pendaftaran = array(
			'id_standar_mutu' => $this->input->post('id_standar_mutu'),
			'no_lhu' => $this->input->post('no_lhu'),
			'tgl_lhu' => $tgl_lhu,
			'deskripsi_lhu' => $this->input->post('deskripsi_lhu')
		);
		$this->db->where('id_lhu',$id_lhu);
		$this->db->update('sn_lhu', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function lhu_detil_all($id)
	{
	$lpd = $this->ambil_sn_lhu_detil($id);
	//--------- Ambil nama kolom --------- [coding here] .jpg
	$fields = "*,round(hasil_lhu_detil,2) as hasil_lhu_detil,round(total_lhu_detil,2) as total_lhu_detil,
	if(range_mutu > 0,concat(round(standar_mutu,2),' s.d ',round(range_mutu,2)),round(standar_mutu,2)) as standar_mutu
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
	    $this->db->where('sm.id_jabatan',$this->session->id_jabatan);
	    $this->db->where('ld.pembuat_lhu',$this->session->id_pegawai);
	    $this->db->where("ild.id_lhu", $lpd['id_lhu']);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('sn_lhu_detil ild');	
	    $this->db->join('sn_lhu ld', 'ld.id_lhu=ild.id_lhu','left');
	    $this->db->join('sn_standar_mutu sm', 'sm.id_standar_mutu=ld.id_standar_mutu','left');	
	    $this->db->join('sn_limbah sl', 'sl.id_limbah=ild.id_limbah','left');
	    $this->db->where('sm.id_jabatan',$this->session->id_jabatan);
	    $this->db->where('ld.pembuat_lhu',$this->session->id_pegawai);
	    $this->db->where("ild.id_lhu", $lpd['id_lhu']);

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
	    $this->db->where('sm.id_jabatan',$this->session->id_jabatan);
	    $this->db->where('ld.pembuat_lhu',$this->session->id_pegawai);
	    $this->db->where("ild.id_lhu", $lpd['id_lhu']);
			}
		  }
		}

	    $this->db->from('sn_lhu_detil ild');	
	    $this->db->join('sn_lhu ld', 'ld.id_lhu=ild.id_lhu','left');
	    $this->db->join('sn_standar_mutu sm', 'sm.id_standar_mutu=ld.id_standar_mutu','left');	
	    $this->db->join('sn_limbah sl', 'sl.id_limbah=ild.id_limbah','left');
	    $this->db->where('sm.id_jabatan',$this->session->id_jabatan);
	    $this->db->where('ld.pembuat_lhu',$this->session->id_pegawai);
	    $this->db->where("ild.id_lhu", $lpd['id_lhu']);			

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('sn_lhu_detil');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function ambil_data_rujukan_ol_unit($eimplo)
	{
		$idx = explode(',', $eimplo);
		$this->db->select("concat(nama_unit,' - ',nama_working) as nama_unit,id_unit");
		$this->db->join('kol_working kw', 'kw.id_working=ol_unit.id_instansi','left');
		$this->db->where_in("ol_unit.id_unit",$idx);
        $query = $this->db->get_where('ol_unit')->result_array();
		$q= array_column($query,'nama_unit','id_unit');
		return $q;
	}
	function ambil_sn_laporan_detil($id)
	{
		$this->db->join('sn_laporan sl', 'sl.id_laporan=sld.id_laporan','left');
		$q = $this->db->get_where('sn_laporan_tabel sld',array('sld.barcode_laporan_tabel'=>$id));
		return $q->row_array();
	}
	function ambil_sn_laporan_4_print($id)
	{
		$this->db->join('sn_standar_mutu sm', 'sm.id_standar_mutu=sl.id_standar_mutu','left');
		$this->db->join('jabatan j', 'j.id_jabatan=sl.pengumpul_data','left');
		$q = $this->db->get_where('sn_laporan sl',array('sl.barcode_laporan'=>$id));
		return $q->row_array();
	}
	function ambil_sn_tabel()
	{
		$this->db->select("id_tabel,nama_tabel");
   	//	$this->db->where("(id_tabel = 1 OR id_jabatan = 0 OR id_jabatan = ".$this->session->id_jabatan.")", NULL, FALSE);
		$ignore = array(2, 4);
		$this->db->where_not_in('id_tabel', $ignore);
   		$this->db->order_by("urut_tabel", "asc");
		$q = $this->db->get_where('sn_tabel',array('status_tabel'=>1))->result_array();
		$hasil= array_column($q,'nama_tabel','id_tabel');
		return $hasil;
	}
	function ambil_data_sn_lhu($tgla,$tglb,$id)
	{
		$this->db->join('sn_standar_mutu sm', 'sm.id_standar_mutu=sn_lhu.id_standar_mutu','left');
		$this->db->where('tgl_lhu BETWEEN "'. $tgla. '" and "'. $tglb.'"');
		$this->db->where('sn_lhu.id_standar_mutu', $id);
		$query = $this->db->get_where('sn_lhu');
		return $query->result_array();
	}
	function ambil_sn_standar_mutu($id){
		$this->db->select("id_standar_mutu,nama_standar_mutu");
	    $this->db->where_in('id_unit', $id);
		$q = $this->db->get_where('sn_standar_mutu',array('id_jabatan'=>$this->session->id_jabatan))->result_array();
		$hasil= array_column($q,'nama_standar_mutu','id_standar_mutu');
		return $hasil;
	}
	function opsi_sumes(){
	//	$ids = explode(',', $id);
		$this->db->select("id_opsi_pengukuran,nama_opsi_pengukuran");
	//	$this->db->where_in("id_opsi_pengukuran", $id);
		$q = $this->db->get_where('sn_opsi_pengukuran')->result_array();
		$hasil= array_column($q,'nama_opsi_pengukuran','id_opsi_pengukuran');
		return $hasil;
	}
	function ambil_sn_lhu_detil($id)
	{
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$q = $this->db->get_where('sn_lhu_detil sld',array('barcode_lhu'=>$id));
		return $q->row_array();
	}
	function ambil_limbah($id)
	{
		$q = $this->db->get_where('sn_limbah',array('id_standar_mutu'=>$id,'status_limbah'=>1));
		return $q->result_array();
	}
	function ambil_limbah_no_null($id)
	{
		$this->db->select("id_limbah,nama_limbah");
		$q = $this->db->get_where('sn_limbah',array('id_standar_mutu'=>$id,'status_limbah'=>1))->result_array();
		$hasil= array_column($q,'nama_limbah','id_limbah');
		return $hasil;
	}
	function simpan_sn_lhu_detil(){
		$hasil_lhu_detil = $this->input->post('hasil_lhu_detil');
		$hasil_lhu_detil = str_replace(',', '.', $hasil_lhu_detil);
		$data_pendaftaran = array(
			'id_lhu' => $this->input->post('id_lhu'),
			'id_limbah' => $this->input->post('id_limbah'),
			'hasil_lhu_detil' => $hasil_lhu_detil
		);
		return $this->db->insert('sn_lhu_detil', $data_pendaftaran);
		// $this->db->insert_id();
	}
	function edit_sn_lhu_detil(){
		$hasil_lhu_detil = $this->input->post('hasil_lhu_detil');
		$hasil_lhu_detil = str_replace(',', '.', $hasil_lhu_detil);
		$id_lhu_detil = $this->input->post('id_lhu_detil');
		$data_pendaftaran = array(
			'id_limbah' => $this->input->post('id_limbah'),
			'hasil_lhu_detil' => $hasil_lhu_detil
		);
		$this->db->where('id_lhu_detil',$id_lhu_detil);
		$this->db->update('sn_lhu_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function upload_sn_lhu($id){
		$id_lhu = $this->input->post('id_lhu');
		$data_pendaftaran = array(
			'link_lhu' => $id
		);
		$this->db->where('id_lhu',$id_lhu);
		$this->db->update('sn_lhu', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function laporan_all($first_date,$last_date,$ids,$tgl,$kat)
	{
	$idx = explode(',', $this->session->mas_ins);
	$idu = explode(',', $this->session->unit);
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,DATE_FORMAT(tgl_laporan,'%d-%m-%Y') as tgl_laporan";
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
	    $this->db->where('id_pegawai',$this->session->id_pegawai);			
	//    $this->db->where_in("sl.id_unit", $this->session->unit);		
	    if($tgl == 0){
	    $this->db->where('tgl_laporan BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		}
		if($kat > 0){
			$this->db->where("sl.id_standar_mutu", $ids);
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('sn_laporan sl');	
	    $this->db->join('sn_standar_mutu sm', 'sm.id_standar_mutu=sl.id_standar_mutu','left');
	    $this->db->join('ol_unit ou', 'ou.id_unit=sl.id_unit','left');
	    $this->db->where('id_pegawai',$this->session->id_pegawai);	
	//    $this->db->where_in("sl.id_unit", $this->session->unit);		
	    if($tgl == 0){
	    $this->db->where('tgl_laporan BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		}	
		if($kat > 0){
			$this->db->where("sl.id_standar_mutu", $ids);
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
	    $this->db->where('id_pegawai',$this->session->id_pegawai);	
	//    $this->db->where_in("sl.id_unit", $this->session->unit);		
	    if($tgl == 0){
	    $this->db->where('tgl_laporan BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		}	
		if($kat > 0){
			$this->db->where("sl.id_standar_mutu", $ids);
		}
			}
		  }
		}

	    $this->db->from('sn_laporan sl');	
	    $this->db->join('sn_standar_mutu sm', 'sm.id_standar_mutu=sl.id_standar_mutu','left');		
	    $this->db->join('ol_unit ou', 'ou.id_unit=sl.id_unit','left');	
	    $this->db->where('id_pegawai',$this->session->id_pegawai);	
	//    $this->db->where_in("sl.id_unit", $this->session->unit);		
	    if($tgl == 0){
	    $this->db->where('tgl_laporan BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		}
		if($kat > 0){
			$this->db->where("sl.id_standar_mutu", $ids);
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('sn_laporan');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function edit_sn_laporan(){
		$barcode_laporan = $this->input->post('barcode_laporan');
		$tgl_laporan = $this->input->post('tgl_laporan');
		$tgl_laporan = date('Y-m-d', strtotime($tgl_laporan));
		$tgl_awal = $this->input->post('tgl_awal');
		$tgl_awal = date('Y-m-d', strtotime($tgl_awal));
		$tgl_akhir = $this->input->post('tgl_akhir');
		$tgl_akhir = date('Y-m-d', strtotime($tgl_akhir));
		$data_pendaftaran = array(
			'tgl_laporan' => $tgl_laporan,
			'tgl_awal' => $tgl_awal,
			'tgl_akhir' => $tgl_akhir,
			'id_standar_mutu'  => $this->input->post('id_standar_mutu'),
			'header_profil'  => $this->input->post('header_profil'),
			'sub_header_profil'  => $this->input->post('sub_header_profil'),
			'sejarah'  => $this->input->post('sejarah'),
			'visi_misi'  => $this->input->post('visi_misi'),
			'tujuan_fungsi'  => $this->input->post('tujuan_fungsi'),
			'informasi_layanan'  => $this->input->post('informasi_layanan'),
			'header_laporan'  => $this->input->post('header_laporan'),
			'sub_header_laporan'  => $this->input->post('sub_header_laporan'),
			'sub_sub_header_laporan'  => $this->input->post('sub_sub_header_laporan'),
			'judul_laporan'  => $this->input->post('judul_laporan'),
			'dimensi_laporan'  => $this->input->post('dimensi_laporan'),
			'tujuan_laporan'  => $this->input->post('tujuan_laporan'),
			'jenis_laporan'  => $this->input->post('jenis_laporan'),
			'satuan_laporan'  => $this->input->post('satuan_laporan'),
			'standar_laporan'  => $this->input->post('standar_laporan'),
			'metode_laporan'  => $this->input->post('metode_laporan'),
			'sumber_laporan'  => $this->input->post('sumber_laporan'),
			'instrumen_laporan'  => $this->input->post('instrumen_laporan'),
			'sampel_laporan'  => $this->input->post('sampel_laporan'),
			'teknis_laporan'  => $this->input->post('teknis_laporan'),
			'frekuensi_laporan'  => $this->input->post('frekuensi_laporan'),
			'periode_laporan'  => $this->input->post('periode_laporan'),
			'penyajian_laporan'  => $this->input->post('penyajian_laporan'),
			'tgjawab_laporan'  => $this->input->post('tgjawab_laporan'),
			'dasar_laporan'  => $this->input->post('dasar_laporan'),
			'definisi_laporan'  => $this->input->post('definisi_laporan'),			
			'numerator_laporan'  => $this->input->post('numerator_laporan'),
			'denominator_laporan'  => $this->input->post('denominator_laporan'),
			'kriteria_laporan'  => $this->input->post('kriteria_laporan'),
			'formula_laporan'  => $this->input->post('formula_laporan'),	
			'pengumpul_data'  => $this->input->post('pengumpul_data')
		);
		$this->db->where('barcode_laporan',$barcode_laporan);
		$this->db->update('sn_laporan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function simpan_sn_laporan(){
		$kode = $this->m_rancak->kode_generator_urut(15,'LP');
		$tgl_laporan = $this->input->post('tgl_laporan');
		$tgl_laporan = date('Y-m-d', strtotime($tgl_laporan));
		$tgl_awal = $this->input->post('tgl_awal');
		$tgl_awal = date('Y-m-d', strtotime($tgl_awal));
		$tgl_akhir = $this->input->post('tgl_akhir');
		$tgl_akhir = date('Y-m-d', strtotime($tgl_akhir));
		$data_pendaftaran = array(
			'id_pegawai' => $this->session->id_pegawai,
			'id_unit' => $this->session->unit,
			'barcode_laporan' => $kode,
			'tgl_laporan' => $tgl_laporan,
			'tgl_awal' => $tgl_awal,
			'tgl_akhir' => $tgl_akhir,
			'id_standar_mutu'  => $this->input->post('id_standar_mutu'),
			'header_profil'  => $this->input->post('header_profil'),
			'sub_header_profil'  => $this->input->post('sub_header_profil'),
			'sejarah'  => $this->input->post('sejarah'),
			'visi_misi'  => $this->input->post('visi_misi'),
			'tujuan_fungsi'  => $this->input->post('tujuan_fungsi'),
			'informasi_layanan'  => $this->input->post('informasi_layanan'),
			'header_laporan'  => $this->input->post('header_laporan'),
			'sub_header_laporan'  => $this->input->post('sub_header_laporan'),
			'sub_sub_header_laporan'  => $this->input->post('sub_sub_header_laporan'),
			'judul_laporan'  => $this->input->post('judul_laporan'),
			'dimensi_laporan'  => $this->input->post('dimensi_laporan'),
			'tujuan_laporan'  => $this->input->post('tujuan_laporan'),
			'jenis_laporan'  => $this->input->post('jenis_laporan'),
			'satuan_laporan'  => $this->input->post('satuan_laporan'),
			'standar_laporan'  => $this->input->post('standar_laporan'),
			'metode_laporan'  => $this->input->post('metode_laporan'),
			'sumber_laporan'  => $this->input->post('sumber_laporan'),
			'instrumen_laporan'  => $this->input->post('instrumen_laporan'),
			'sampel_laporan'  => $this->input->post('sampel_laporan'),
			'teknis_laporan'  => $this->input->post('teknis_laporan'),
			'frekuensi_laporan'  => $this->input->post('frekuensi_laporan'),
			'periode_laporan'  => $this->input->post('periode_laporan'),
			'penyajian_laporan'  => $this->input->post('penyajian_laporan'),
			'tgjawab_laporan'  => $this->input->post('tgjawab_laporan'),
			'dasar_laporan'  => $this->input->post('dasar_laporan'),
			'definisi_laporan'  => $this->input->post('definisi_laporan'),			
			'numerator_laporan'  => $this->input->post('numerator_laporan'),
			'denominator_laporan'  => $this->input->post('denominator_laporan'),
			'kriteria_laporan'  => $this->input->post('kriteria_laporan'),
			'formula_laporan'  => $this->input->post('formula_laporan'),	
			'pengumpul_data'  => $this->input->post('pengumpul_data')
		);
		return $this->db->insert('sn_laporan', $data_pendaftaran);
		// $this->db->insert_id();
	}
	function laporan_tabel_all($idx)
	{
		$id = $this->m_umum->ambil_data('sn_laporan','barcode_laporan',$idx);
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
				$this->db->where("slt.id_laporan", $id['id_laporan']);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('sn_laporan_tabel slt');	
	    $this->db->join('sn_laporan sl', 'sl.id_laporan=slt.id_laporan','left');
		$this->db->where("slt.id_laporan", $id['id_laporan']);

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
				$this->db->where("slt.id_laporan", $id['id_laporan']);
			}
		  }
		}

	    $this->db->from('sn_laporan_tabel slt');	
	    $this->db->join('sn_laporan sl', 'sl.id_laporan=slt.id_laporan','left');	
		$this->db->where("slt.id_laporan", $id['id_laporan']);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('sn_laporan_tabel');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function tambah_sn_laporan_tabel(){
		$kode = $this->m_rancak->kode_generator(15,'LT');
		$data_pendaftaran = array(
			'barcode_laporan_tabel' => $kode,
			'id_lhu' => 0,
			'id_sumber_emisi' => 0,
			'id_limbah' => 0,
			'id_laporan'  => $this->input->post('id_laporan'),
			'judul_laporan_tabel'  => $this->input->post('judul_laporan_tabel'),
			'analisa_laporan_tabel'  => $this->input->post('analisa_laporan_tabel'),
			'rekomendasi_laporan_tabel'  => $this->input->post('rekomendasi_laporan_tabel')
		);
		return $this->db->insert('sn_laporan_tabel', $data_pendaftaran);
		// $this->db->insert_id();
	}
	function edit_sn_laporan_tabel(){
		$id_laporan_tabel = $this->input->post('id_laporan_tabel');
		$data_pendaftaran = array(
			'judul_laporan_tabel'  => $this->input->post('judul_laporan_tabel'),
			'analisa_laporan_tabel'  => $this->input->post('analisa_laporan_tabel'),
			'rekomendasi_laporan_tabel'  => $this->input->post('rekomendasi_laporan_tabel')
		);
		$this->db->where('id_laporan_tabel',$id_laporan_tabel);
		$this->db->update('sn_laporan_tabel', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function edit_urutan_laporan_tabel(){
		$id_laporan_tabel = $this->input->post('id_laporan_tabel');
		$data_pendaftaran = array(
			'urutan_laporan_tabel'  => $this->input->post('urutan_laporan_tabel')
		);
		$this->db->where('id_laporan_tabel',$id_laporan_tabel);
		$this->db->update('sn_laporan_tabel', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
    function max_tanggal_lhu($id)    //igd.php untuk menampilkan jumlah antrian di igd saja
    {
    	$lpd = $this->ambil_sn_laporan_detil($id);
		$this->db->select("max(tgl_lhu) as num");
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);		
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}
		$q = $this->db->get_where('sn_lhu_detil sld');
	    $result = $q->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
    }
    function min_tanggal_lhu($id)    //igd.php untuk menampilkan jumlah antrian di igd saja
    {
    	$lpd = $this->ambil_sn_laporan_detil($id);
		$this->db->select('min(tgl_lhu) as num');
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}
		$q = $this->db->get_where('sn_lhu_detil sld');
	    $result = $q->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
    }
	function rec_tabel_detil($id,$idl,$blyr,$min,$max,$ids) //belum
	{
		$lpd = $this->ambil_sn_laporan_detil($id);
  		$this->db->select('COUNT(*) as num');
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->where('tgl_lhu BETWEEN "'. $min . '" and "'. $max.'"');
		$this->db->where('sld.id_limbah', $idl);
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);
		$this->db->where("DATE_FORMAT(tgl_lhu,'%Y-%m')", $blyr);
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}
		$this->db->group_by(array('YEAR(tgl_lhu)','MONTH(tgl_lhu)','sld.id_limbah','sld.hasil_lhu_detil'));
	//	$this->db->group_by(array('YEAR(tgl_lhu)','MONTH(tgl_lhu)'));
		$q = $this->db->get_where('sn_lhu_detil sld');
	    $result = $q->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
	}
    function only_blnyear_lhu($id,$min,$max)    //igd.php untuk menampilkan jumlah antrian di igd saja
    {
    	$lpd = $this->ambil_sn_laporan_detil($id);
	//	$this->db->select("LEFT(DATE_FORMAT( tgl_lhu,'%m'),3) AS buln,DATE_FORMAT( tgl_lhu,'%m-%Y') AS blnyear");
		$this->db->select("DATE_FORMAT(tgl_lhu,'%m') AS buln,DATE_FORMAT( tgl_lhu,'%Y-%m') AS blnyear");
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}
		//$this->db->group_by('YEAR(tgl_lhu)','MONTH(tgl_lhu)');
		$this->db->group_by(array("YEAR(tgl_lhu)", "MONTH(tgl_lhu)"));
		$q = $this->db->get_where('sn_lhu_detil sld');
		return $q->result_array();
    }
	function tabel_limbah_detil($id)
	{
		$lpd = $this->ambil_sn_laporan_detil($id);
  	//	$this->db->select("sld.id_limbah,nama_limbah,");
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->join('sn_sumber_emisi se', 'se.id_sumber_emisi=sld.id_sumber_emisi','left');
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}
		$this->db->group_by('sld.id_limbah');
	//	$this->db->group_by(array('YEAR(tgl_lhu)','MONTH(tgl_lhu)','sld.id_limbah'));
		$this->db->order_by('nama_limbah','asc');
		$q = $this->db->get_where('sn_lhu_detil sld');
		return $q->result_array();
	}
	function tabel_detil($id,$idl,$blyr,$min,$max,$ids) //belum
	{
		$lpd = $this->ambil_sn_laporan_detil($id);
  	//	$this->db->select("*,YEAR(tgl_lhu) as tahune, MONTH(tgl_lhu) as bulane, COUNT(sld.id_limbah) as hitung,SUM(hasil_lhu_detil) as hasile");
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->where('tgl_lhu BETWEEN "'. $min . '" and "'. $max.'"');
		$this->db->where('sld.id_limbah', $idl);
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);
		$this->db->where("DATE_FORMAT(tgl_lhu,'%Y-%m')", $blyr);
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}
		$this->db->group_by(array('YEAR(tgl_lhu)','MONTH(tgl_lhu)','sld.id_limbah','sld.hasil_lhu_detil'));
	//	$this->db->group_by(array('YEAR(tgl_lhu)','MONTH(tgl_lhu)'));
		$q = $this->db->get_where('sn_lhu_detil sld');
		return $q->result_array();
	}
	function edit_input_tabel(){
		$id_laporan_tabel = $this->input->post('id_laporan_tabel');
		$chk = $this->input->post('chk[]');
		if (empty($chk)) {
		   $id_lhu = "0";
		}else{
			$id_lhu = implode(",",$chk);
		}
		$data_pendaftaran = array(
			'id_lhu' => $id_lhu,
			'tabel'  => $this->input->post('tabel')
		);
		$this->db->where('id_laporan_tabel',$id_laporan_tabel);
		$this->db->update('sn_laporan_tabel', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function edit_input_limbah(){
		$id_laporan_tabel = $this->input->post('id_laporan_tabel');
		$chk = $this->input->post('chk[]');
		if (empty($chk)) {
		   $id_limbah = "0";
		}else{
			$id_limbah = implode(",",$chk);
		}
		$data_pendaftaran = array(
			'id_limbah' => $id_limbah
		);
		$this->db->where('id_laporan_tabel',$id_laporan_tabel);
		$this->db->update('sn_laporan_tabel', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function ambil_data_sn_lhu_detil($tgla,$tglb,$id)	//daftar.php pasien
	{
		$this->db->join('sn_lhu', 'sn_lhu.id_lhu=sn_lhu_detil.id_lhu','left');
		$this->db->join('sn_standar_mutu sm', 'sm.id_standar_mutu=sn_lhu.id_standar_mutu','left');
		$this->db->join('sn_limbah sl', 'sl.id_limbah=sn_lhu_detil.id_limbah','left');
		$this->db->where('tgl_lhu BETWEEN "'. $tgla. '" and "'. $tglb.'"');
		$this->db->where('sn_lhu.id_standar_mutu', $id);
		$this->db->group_by('sn_lhu_detil.id_limbah');
		$query = $this->db->get_where('sn_lhu_detil');
		return $query->result_array();
	}
	function ambil_id_limbah_fr_detil($id){
		$lpd = $this->ambil_sn_laporan_detil($id);
		$this->db->select("sld.id_limbah,nama_limbah");
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);		
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}
		$this->db->group_by("sld.id_limbah");
		$q = $this->db->get_where('sn_lhu_detil sld')->result_array();
		//echo $this->db->last_query();die();
		return $q;
	}
    function max_standar_mutu($id)    //igd.php untuk menampilkan jumlah antrian di igd saja
    {
		$lpd = $this->ambil_sn_laporan_detil($id);
		$this->db->select("max(standar_mutu) as num");
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);		
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}
		$q = $this->db->get_where('sn_lhu_detil sld');
	    $result = $q->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
    }
    function min_range_mutu($id)    //igd.php untuk menampilkan jumlah antrian di igd saja
    {
    	$lpd = $this->ambil_sn_laporan_detil($id);
		$this->db->select('min(range_mutu) as num');
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}
		$q = $this->db->get_where('sn_lhu_detil sld');
	    $result = $q->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
    }
//==================================== grafik
	function ambil_limbah_grafik_aza($id){
		$lpd = $this->ambil_sn_laporan_detil($id);
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}
		$this->db->group_by("sld.id_limbah");
		$q = $this->db->get_where('sn_lhu_detil sld')->result_array();
		//echo $this->db->last_query();die();
		return $q;
	}
	function grafik_garis_opsi($id){
		$lpd = $this->ambil_sn_laporan_detil($id);
		$this->db->select("DATE_FORMAT(tgl_lhu,'%d-%m-%Y') as tgl_lhu,sld.id_limbah,
			DATE_FORMAT(tgl_lhu,'%Y') as thn,DATE_FORMAT(tgl_lhu,'%m') as bln,DATE_FORMAT(tgl_lhu,'%d') as hr
			");
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);		
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}
		$this->db->group_by("tgl_lhu,sld.id_limbah");
		$q = $this->db->get_where('sn_lhu_detil sld')->result_array();
		//echo $this->db->last_query();die();
		return $q;
	}
	function grafik_garis_hasil($tgl,$id){
	//	$this->db->select("sld.id_limbah,hasil_lhu_detil,round(hasil_lhu_detil/total_lhu_detil*100,1) as prosen,nama_limbah");
		$this->db->select("sld.id_limbah,sum(hasil_lhu_detil) as hasil_lhu_detil");
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->where('sld.id_limbah', $id);
		$this->db->where('tgl_lhu', date('Y-m-d', strtotime($tgl)));
	//	$this->db->group_by("sld.id_limbah,hasil_lhu_detil");
		$q = $this->db->get_where('sn_lhu_detil sld')->result_array();
		//echo $this->db->last_query();die();
		return $q;
	}
	function grafik_pie_all($id)
	{
		$lpd = $this->ambil_sn_laporan_detil($id);
		$this->db->select("SUM(hasil_lhu_detil) as total,nama_limbah");
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
	//	$this->db->where("IF(range_mutu = 0 ,hasil_lhu_detil < standar_mutu, hasil_lhu_detil BETWEEN standar_mutu and range_mutu)", NULL, FALSE);
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');		
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}
		$this->db->group_by('sld.id_limbah');
		$q = $this->db->get_where('sn_lhu_detil sld');
		return $q->result_array();
	}
	function grafik_pie($id)
	{
		$lpd = $this->ambil_sn_laporan_detil($id);
		$this->db->select("
			if(total_lhu_detil = 0,
			100*(hasil_lhu_detil/count(*)),
			100*(hasil_lhu_detil/total_lhu_detil)) as total, 
			nama_limbah");
/*		$this->db->select("
			if(total_lhu_detil = 0,
			100*(hasil_lhu_detil/count(*)),
			100*(hasil_lhu_detil/total_lhu_detil)) as total, 
			nama_limbah");*/
/* 		$this->db->select("
SUM(CASE WHEN if(range_mutu = 0 ,hasil_lhu_detil < standar_mutu, hasil_lhu_detil BETWEEN standar_mutu and range_mutu) THEN 1 ELSE 0 END) TotalXorD
	round((100*count(if(range_mutu = 0 ,hasil_lhu_detil < standar_mutu, hasil_lhu_detil BETWEEN standar_mutu and range_mutu))/count(*),0) as total, nama_limbah
			");*/
 /*      SUM(CASE WHEN status NOT IN ('X','D') OR status IS NULL THEN 1 ELSE 0 END) TotalNotXorD,
        SUM(CASE WHEN status IN ('X','D') AND cancel_date >= '2012-02-01' THEN 1 ELSE 0 END) TotalXorD */
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
	//	$this->db->where("IF(range_mutu = 0 ,hasil_lhu_detil < standar_mutu, hasil_lhu_detil BETWEEN standar_mutu and range_mutu)", NULL, FALSE);
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');		
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}
		$this->db->group_by('sld.id_limbah');
		$q = $this->db->get_where('sn_lhu_detil sld');
		return $q->result_array();
	}
	function rec_baku_mutu($id)
	{
		$lpd = $this->ambil_sn_laporan_detil($id);
    	$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
    	$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where('slm.standar_mutu >', 0);
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}
		$this->db->group_by('sld.id_limbah');
        $query = $this->db->select("COUNT(*) as num")->get_where('sn_lhu_detil sld');
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
	}
	function ambil_all_limbah_grafik($id,$idl){
		$lpd = $this->ambil_sn_laporan_detil($id);
		$this->db->select("count(*) as cemua");
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where('sld.id_limbah', $idl);
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);		
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}
		if($lpd['id_sumber_emisi'] == NULL OR $lpd['id_sumber_emisi'] == 0 OR empty($lpd['id_sumber_emisi'])){ 
			
		}else{
			$ids = explode(',', $lpd['id_sumber_emisi']);
			$this->db->where_in('sld.id_sumber_emisi', $ids);
		}
		$this->db->group_by('sld.id_limbah');
		$q = $this->db->get_where('sn_lhu_detil sld')->result_array();
		//echo $this->db->last_query();die();
		return $q;
	}
	function ambil_sesuai_limbah_grafik($id,$idl){
		$lpd = $this->ambil_sn_laporan_detil($id);
		$this->db->select("
			IF(range_mutu = 0 ,SUM(CASE WHEN hasil_lhu_detil < standar_mutu THEN 1 ELSE 0 END),SUM(CASE WHEN hasil_lhu_detil BETWEEN standar_mutu and range_mutu THEN 1 ELSE 0 END)) as cesuai
			");
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where('sld.id_limbah', $idl);
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);		
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
/*		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}*/
		if($lpd['id_sumber_emisi'] == NULL OR $lpd['id_sumber_emisi'] == 0 OR empty($lpd['id_sumber_emisi'])){ 
			
		}else{
			$ids = explode(',', $lpd['id_sumber_emisi']);
			$this->db->where_in('sld.id_sumber_emisi', $ids);
		}
	//	$this->db->where("IF(range_mutu = 0 ,hasil_lhu_detil < standar_mutu, hasil_lhu_detil BETWEEN standar_mutu and range_mutu)", NULL, FALSE);
		$this->db->group_by('sld.id_limbah');
		$q = $this->db->get_where('sn_lhu_detil sld')->result_array();
		//echo $this->db->last_query();die();
		return $q;
	}
	function grafik_batang_kelola($id)
	{
		$lpd = $this->ambil_sn_laporan_detil($id);
	//	$this->db->select('hasil_lhu_detil,standar_mutu,range_mutu,nama_limbah');
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->join('sn_sumber_emisi se', 'se.id_sumber_emisi=sld.id_sumber_emisi','left');
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');		
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}
		if($lpd['id_sumber_emisi'] == NULL OR $lpd['id_sumber_emisi'] == 0 OR empty($lpd['id_sumber_emisi'])){ 
			
		}else{
			$ids = explode(',', $lpd['id_sumber_emisi']);
			$this->db->where_in('sld.id_sumber_emisi', $ids);
		}
	//	$this->db->where("IF(range_mutu = 0 ,hasil_lhu_detil < standar_mutu, hasil_lhu_detil BETWEEN standar_mutu and range_mutu)", NULL, FALSE);
	//	$this->db->group_by('sld.id_limbah'); 
		$this->db->order_by('tgl_lhu','asc'); 
		$q = $this->db->get_where('sn_lhu_detil sld');
		return $q->result_array();
	}
	function grafik_batang_range($id)
	{
		$lpd = $this->ambil_sn_laporan_detil($id);
		$this->db->select('*,sum(hasil_lhu_detil) as hasil_lhu_detil');
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->join('sn_sumber_emisi se', 'se.id_sumber_emisi=sld.id_sumber_emisi','left');
	//	$this->db->where("IF(range_mutu = 0 ,hasil_lhu_detil < standar_mutu, hasil_lhu_detil BETWEEN standar_mutu and range_mutu)", NULL, FALSE);
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');		
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}
		if($lpd['id_sumber_emisi'] == NULL OR $lpd['id_sumber_emisi'] == 0 OR empty($lpd['id_sumber_emisi'])){ 
			
		}else{
			$ids = explode(',', $lpd['id_sumber_emisi']);
			$this->db->where_in('sld.id_sumber_emisi', $ids);
		}
		$this->db->group_by(array('sld.id_limbah','sld.id_lhu_detil')); 
		$q = $this->db->get_where('sn_lhu_detil sld');
		return $q->result_array();
	}
	function ol_berkas_in($id,$idp)
	{
		$ids = explode(",", $id);
  		$this->db->where_in('id_berkas', $ids);
  		$this->db->where('id_kategori_pelatihan', $idp);
  		$this->db->where('id_kategori_berkas', 12);
		$q = $this->db->get_where('ol_berkas');
		return $q->result_array();
	}
	function grafik_batang_range_jejer($id)
	{
		$lpd = $this->ambil_sn_laporan_detil($id);
		$this->db->select('*,sum(hasil_lhu_detil) as hasil_lhu_detil');
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->join('sn_sumber_emisi se', 'se.id_sumber_emisi=sld.id_sumber_emisi','left');
	//	$this->db->where("IF(range_mutu = 0 ,hasil_lhu_detil < standar_mutu, hasil_lhu_detil BETWEEN standar_mutu and range_mutu)", NULL, FALSE);
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');		
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}
		if($lpd['id_sumber_emisi'] == NULL OR $lpd['id_sumber_emisi'] == 0 OR empty($lpd['id_sumber_emisi'])){ 
			
		}else{
			$ids = explode(',', $lpd['id_sumber_emisi']);
			$this->db->where_in('sld.id_sumber_emisi', $ids);
		}
		$this->db->group_by(array('sld.id_limbah','sld.id_lhu_detil')); 
		$q = $this->db->get_where('sn_lhu_detil sld');
		return $q->result_array();
	}
	function grafik_only_limbah($id)
	{
		$lpd = $this->ambil_sn_laporan_detil($id);
	//	$this->db->select('hasil_lhu_detil,standar_mutu,range_mutu,nama_limbah');
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->join('sn_sumber_emisi se', 'se.id_sumber_emisi=sld.id_sumber_emisi','left');
		$this->db->where("IF(range_mutu = 0 ,hasil_lhu_detil < standar_mutu, hasil_lhu_detil BETWEEN standar_mutu and range_mutu)", NULL, FALSE);
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');		
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}
		if($lpd['id_sumber_emisi'] == NULL OR $lpd['id_sumber_emisi'] == 0 OR empty($lpd['id_sumber_emisi'])){ 
			
		}else{
			$ids = explode(',', $lpd['id_sumber_emisi']);
			$this->db->where_in('sld.id_sumber_emisi', $ids);
		}
		$this->db->group_by('sld.id_limbah');
	//	$this->db->group_by(array('sld.id_lhu_detil')); 
		$q = $this->db->get_where('sn_lhu_detil sld');
		return $q->result_array();
	}
	function ambil_dt_limbah_grafik($id){
		$lpd = $this->ambil_sn_laporan_detil($id);
		$this->db->select("nama_limbah,sld.id_limbah");
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);		
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}
		if($lpd['id_sumber_emisi'] == NULL OR $lpd['id_sumber_emisi'] == 0 OR empty($lpd['id_sumber_emisi'])){ 
			
		}else{
			$ids = explode(',', $lpd['id_sumber_emisi']);
			$this->db->where_in('sld.id_sumber_emisi', $ids);
		}
		$this->db->group_by('sld.id_limbah');
		$q = $this->db->get_where('sn_lhu_detil sld')->result_array();
	//	echo $this->db->last_query();die();
		return $q;
	}
	function ambil_sn_laporan_tabel($id)
	{
		$this->db->join('sn_laporan sl', 'sl.id_laporan=sld.id_laporan','left');
		$this->db->order_by('urutan_laporan_tabel','asc');
		$q = $this->db->get_where('sn_laporan_tabel sld',array('sl.barcode_laporan'=>$id));
		return $q->result_array();
	}
    function min_standar_mutu($id)    //igd.php untuk menampilkan jumlah antrian di igd saja
    {
    	$lpd = $this->ambil_sn_laporan_detil($id);
		$this->db->select('min(standar_mutu) as num');
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);
/*		if($lpd['id_limbah'] > 0){ 
			$this->db->where('sld.id_limbah', $lpd['id_limbah']);
		}*/		
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}
		if($lpd['id_sumber_emisi'] == NULL OR $lpd['id_sumber_emisi'] == 0 OR empty($lpd['id_sumber_emisi'])){ 
			
		}else{
			$ids = explode(',', $lpd['id_sumber_emisi']);
			$this->db->where_in('sld.id_sumber_emisi', $ids);
		}
		$q = $this->db->get_where('sn_lhu_detil sld');
	    $result = $q->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
    }
    function min_hasil($id)    //igd.php untuk menampilkan jumlah antrian di igd saja
    {
    	$lpd = $this->ambil_sn_laporan_detil($id);
		$this->db->select('min(hasil_lhu_detil) as num');
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);
/*		if($lpd['id_limbah'] > 0){ 
			$this->db->where('sld.id_limbah', $lpd['id_limbah']);
		}*/		
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}
		if($lpd['id_sumber_emisi'] == NULL OR $lpd['id_sumber_emisi'] == 0 OR empty($lpd['id_sumber_emisi'])){ 
			
		}else{
			$ids = explode(',', $lpd['id_sumber_emisi']);
			$this->db->where_in('sld.id_sumber_emisi', $ids);
		}
		$q = $this->db->get_where('sn_lhu_detil sld');
	    $result = $q->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
    }
	function jumlah_record_tabel_limbah_detil($id)
	{
		$lpd = $this->ambil_sn_laporan_detil($id);
		$this->db->select('COUNT(*) as num');
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->join('sn_sumber_emisi se', 'se.id_sumber_emisi=sld.id_sumber_emisi','left');
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where('sld.id_sumber_emisi >', 0);
		$q = $this->db->get_where('sn_lhu_detil sld');
	    $result = $q->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
	}
	function jumlah_record_tps($id)
    {
		$lpd = $this->ambil_sn_laporan_detil($id);
		$this->db->select('COUNT(*) as num');
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);
		$this->db->where('sld.id_tps >', 0);		
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}
		if($lpd['id_sumber_emisi'] == NULL OR $lpd['id_sumber_emisi'] == 0 OR empty($lpd['id_sumber_emisi'])){ 
			
		}else{
			$ids = explode(',', $lpd['id_sumber_emisi']);
			$this->db->where_in('sld.id_sumber_emisi', $ids);
		}
	//	$this->db->where("IF(range_mutu = 0 ,hasil_lhu_detil < standar_mutu, hasil_lhu_detil BETWEEN standar_mutu and range_mutu)", NULL, FALSE);
	//	$this->db->where('sld.id_limbah', $idl);
		$this->db->group_by('sld.id_tps');
		$q = $this->db->get_where('sn_lhu_detil sld');
	    $result = $q->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
    }
    function ambil_berkas_lhu($id,$stm,$tgl_awal,$tgl_akhir)    //igd.php untuk menampilkan jumlah antrian di igd saja
    {
    	if(empty($id)){
			$this->db->where('tgl_lhu BETWEEN "'. $tgl_awal . '" and "'. $tgl_akhir.'"');    		
    	}else{
			$idx = explode(',', $id);
			$this->db->where_in('id_lhu', $idx);    		
    	}
    	$this->db->where('id_standar_mutu', $stm);	
    	$this->db->where('link_lhu is NOT NULL', NULL, FALSE);
    	$this->db->group_by('id_lhu');
		$q = $this->db->get_where('sn_lhu');
		return $q->result_array();
    }
    function count_berkas_lhu($id,$stm,$tgl_awal,$tgl_akhir)
    {
    	$this->db->select("count(id_lhu) as num");
    	if(empty($id)){
			$this->db->where('tgl_lhu BETWEEN "'. $tgl_awal . '" and "'. $tgl_akhir.'"');    		
    	}else{
			$idx = explode(',', $id);
			$this->db->where_in('id_lhu', $idx);    		
    	}
    	$this->db->where('id_standar_mutu', $stm);	
    	$this->db->where('link_lhu is NOT NULL', NULL, FALSE);
    	$this->db->group_by('id_lhu');
		$q = $this->db->get_where('sn_lhu');
	    $result = $q->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
    }
	function berkas_all()
	{
    $idu = array(50,60);
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
	    $this->db->where_in('id_kategori_pelatihan', $idu);
	    $this->db->where('id_kategori_berkas', 12);
	    $this->db->where('id_pegawai', $this->session->id_jabatan);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_berkas ob');	
	    $this->db->where_in('id_kategori_pelatihan', $idu);
	    $this->db->where('id_kategori_berkas', 12);
	    $this->db->where('id_pegawai', $this->session->id_jabatan);

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
	    $this->db->where_in('id_kategori_pelatihan', $idu);
	    $this->db->where('id_kategori_berkas', 12);
	    $this->db->where('id_pegawai', $this->session->id_jabatan);
			}
		  }
		}

	    $this->db->from('ol_berkas ob');	
	    $this->db->where_in('id_kategori_pelatihan', $idu);
	    $this->db->where('id_kategori_berkas', 12);
	    $this->db->where('id_pegawai', $this->session->id_jabatan);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
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
	function edit_berkas_file(){
		$id_berkas = $this->input->post('id_berkas');
		$data_pendaftaran = array(
			'nama_berkas' => $this->input->post('nama_berkas'),
			'no_berkas' => $this->input->post('no_berkas')
		);
		$this->db->where('id_berkas',$id_berkas);
		$this->db->update('ol_berkas', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function simpan_berkas_file($id,$idp){
		$kode = $this->m_rancak->kode_generator(15,'');
		$data_kewenangan = array(
			'id_pegawai' => $this->session->id_jabatan,
			'nama_berkas' => $this->input->post('nama_berkas'),
			'id_kategori_berkas' => 12,
			'id_kategori_pelatihan' => $idp,
			'no_berkas' => $this->input->post('no_berkas'),
			'barcode_berkas' => $kode,
			'link_berkas' => $id
		);
		$this->db->insert('ol_berkas', $data_kewenangan);
		return $this->db->insert_id();
	}
}
/*
PERCENTASE
-------------
$sql = "select * from tbl_user";
$query = $this->db->query($sql);
$this->db->query('YOUR QUERY HERE');
select count(*) from agents into @AgentCount;

SELECT user_agent_parsed
     , user_agent_original
     , COUNT( user_agent_parsed )  AS thecount
     , COUNT( * ) / ( @AgentCount) AS percentage
 FROM agents
GROUP BY user_agent_parsed
ORDER BY thecount DESC LIMIT 50;
===================================
function detail_metagenome_microbe_grafik($trflp_code, $metacode) {
    $total = '(select count(*) from tb_browser)';
    $query = $this->db->select('concat(round((100*count(*))/'.$total.',0),"%") as data_percentage')
                  ->from('tb_browser')
                  ->group_by('browser')
                  ->get();      
    return $query->result_array();  
}
|   safari      |   25% |
|   opera mini  |   17% |
|   firefox     |   33% |
|   chrome      |   25% |

	function grafik_pie($id,$total)
	{
		$lpd = $this->ambil_sn_laporan_detil($id);
		$this->db->select('((100*count(*))/'.$total.') as total,nama_limbah');
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}
		if($lpd['id_sumber_emisi'] == NULL OR $lpd['id_sumber_emisi'] == 0 OR empty($lpd['id_sumber_emisi'])){ 
			
		}else{
			$ids = explode(',', $lpd['id_sumber_emisi']);
			$this->db->where_in('sld.id_sumber_emisi', $ids);
		}
		$limbh = $this->m_umum->ambil_data('sn_limbah','id_limbah')
	//	$this->db->where('hasil_lhu_detil BETWEEN standar_mutu and range_mutu');
	//	$this->db->where('hasil_lhu_detil <', 'standar_mutu');
		$this->db->group_by('sld.id_limbah');
		$q = $this->db->get_where('sn_lhu_detil sld');
		return $q->result_array();
	}
*/