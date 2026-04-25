<?php
class M_radiologi extends CI_model{
	function reject_all($id)
	{
	//	$ids = explode(',', $unit);
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,if(status_reject = '1' ,'AKTIF','NON AKTIF') as status_reject";
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

	    $this->db->from('kol_reject k');
			$this->db->where("id_unit", $id);

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
	$this->db->from('kol_reject k');
	$this->db->where("id_unit", $id);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('kol_reject');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_reject(){
		$data_pendaftaran = array(
			'nama_reject' => $this->input->post('nama_reject'),
			'id_unit' => $this->input->post('id_unit'),
			'status_reject' => $this->input->post('status_reject')
		);
		return $this->db->insert('kol_reject', $data_pendaftaran);
	}
	function edit_reject(){
		$id_reject = $this->input->post('id_reject');
		$data_pendaftaran = array(
			'nama_reject' => $this->input->post('nama_reject'),
			'status_reject' => $this->input->post('status_reject')
		);
		$this->db->where('id_reject',$id_reject);
		$this->db->update('kol_reject', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	// ======================================== FOKUS
	function fokus_all()
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

	    $this->db->from('radiologi_field_size k');

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
	    $this->db->from('radiologi_field_size k');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('radiologi_field_size');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_field_size(){
		$data_pendaftaran = array(
			'nama_field_size' => $this->input->post('nama_field_size')
		);
		return $this->db->insert('radiologi_field_size', $data_pendaftaran);
	}
	function edit_field_size(){
		$id_field_size = $this->input->post('id_field_size');
		$data_pendaftaran = array(
			'nama_field_size' => $this->input->post('nama_field_size')
		);
		$this->db->where('id_field_size',$id_field_size);
		$this->db->update('radiologi_field_size', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function thickness_all()
	{
	//	$ids = explode(',', $unit);
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,if(fat='0','SLIM',if(fat='1','FAT','VERY FAT')) as fat";
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

	    $this->db->from('radiologi_thickness k');

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
	    $this->db->from('radiologi_thickness k');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('radiologi_thickness');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_thickness(){
		$data_pendaftaran = array(
			'nama_thickness' => $this->input->post('nama_thickness'),
			'fat' => $this->input->post('fat'),
			'thickness' => $this->input->post('thickness'),
			'deskripsi_thickness' => $this->input->post('deskripsi_thickness')
		);
		return $this->db->insert('radiologi_thickness', $data_pendaftaran);
	}
	function edit_thickness(){
		$id_thickness = $this->input->post('id_thickness');
		$data_pendaftaran = array(
			'nama_thickness' => $this->input->post('nama_thickness'),
			'fat' => $this->input->post('fat'),
			'thickness' => $this->input->post('thickness'),
			'deskripsi_thickness' => $this->input->post('deskripsi_thickness')
		);
		$this->db->where('id_thickness',$id_thickness);
		$this->db->update('radiologi_thickness', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function fe_all()
	{
	//	$ids = explode(',', $unit);
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,concat(nama_thickness,' - ',thickness,' - ',if(fat='0','SLIM',if(fat='1','FAT','VERY FAT'))) as fat,concat(ROUND(kv,1),' - ',ROUND(mas,5),' - ',ROUND(fpd,1)) as kv";
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

	    $this->db->from('radiologi_fe rf');
			$this->db->join('tindakan t', 't.id_tindakan=rf.id_tindakan','left');
			$this->db->join('radiologi_field_size rfs', 'rfs.id_field_size=rf.id_field_size','left');
			$this->db->join('radiologi_thickness rt', 'rt.id_thickness=rf.id_thickness','left');

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
	$this->db->from('radiologi_fe rf');
	$this->db->join('tindakan t', 't.id_tindakan=rf.id_tindakan','left');
	$this->db->join('radiologi_field_size rfs', 'rfs.id_field_size=rf.id_field_size','left');
	$this->db->join('radiologi_thickness rt', 'rt.id_thickness=rf.id_thickness','left');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('radiologi_fe');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function bakhp_all()
	{
	//	$ids = explode(',', $unit);
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,if(status_pemeriksaan_bakhp = '1','AKTIF','NON AKTIF') as status_pemeriksaan_bakhp";
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

	    $this->db->from('pemeriksaan_bakhp pb');
			$this->db->join('tindakan t', 't.id_tindakan=pb.id_tindakan','left');
	$this->db->join('unit r', 'r.id_unit=pb.id_unit','left');
	$this->db->join('keu_barang kb', 'kb.id_barang=pb.id_barang','left');
			$this->db->join('kol_satuan s', 's.id_satuan=pb.id_satuan','left');

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
	$this->db->from('pemeriksaan_bakhp pb');
	$this->db->join('tindakan t', 't.id_tindakan=pb.id_tindakan','left');
	$this->db->join('unit r', 'r.id_unit=pb.id_unit','left');
		$this->db->join('keu_barang kb', 'kb.id_barang=pb.id_barang','left');
	$this->db->join('kol_satuan s', 's.id_satuan=pb.id_satuan','left');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('pemeriksaan_bakhp');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function tindakan_all()
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

		$this->db->from('tindakan t');
		$this->db->join('kol_golongan_pemeriksaan kg', 'kg.id_golongan_pemeriksaan=t.id_golongan_pemeriksaan','left');
		$this->db->where('status_tindakan', '1');
		$this->db->order_by('t.id_golongan_pemeriksaan', 'asc');

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
	$this->db->from('tindakan t');
	$this->db->join('kol_golongan_pemeriksaan kg', 'kg.id_golongan_pemeriksaan=t.id_golongan_pemeriksaan','left');
	$this->db->where('status_tindakan', '1');
	$this->db->order_by('t.id_golongan_pemeriksaan', 'asc');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('tindakan');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_radiologi_fe(){
		$id_tindakan = $this->input->post('id_tindakan');
		$id_thickness = $this->input->post('id_thickness[]');
		$id_field_size = $this->input->post('id_field_size[]');
		$kv = $this->input->post('kv[]');
		$mas = $this->input->post('mas[]');
		$fpd = $this->input->post('fpd[]');
		$jml_kode = count($id_thickness);
		for ($i=0;$i<$jml_kode;$i++){
			$this->db->select("COUNT(*) as num");
			$this->db->where('id_tindakan',$id_tindakan);
			$this->db->where('id_thickness',$id_thickness[$i]);
			$q = $this->db->get('radiologi_fe')->row();
			$jml = $q->num;
			if($jml == 0){
				$data_pendaftaran = array(
					'id_thickness' => $id_thickness[$i],
					'id_field_size' => $id_field_size[$i],
					'kv' => $kv[$i],
					'mas' => $mas[$i],
					'fpd' => $fpd[$i],
					'id_tindakan' => $id_tindakan
				);
				$this->db->insert('radiologi_fe', $data_pendaftaran);
			}else{
				$this->edit_radiologi_fe($id_thickness[$i],$id_tindakan,$id_field_size[$i],$kv[$i],$mas[$i],$fpd[$i]);
			}
		}
	}
	function simpan_pemeriksaan_bakhp(){
		$id_tindakan = $this->input->post('id_tindakan');
		$id_unit = $this->input->post('id_unit');
		$status_pemeriksaan_bakhp = $this->input->post('status_pemeriksaan_bakhp[]');
		$jml_pemeriksaan_bakhp = $this->input->post('jml_pemeriksaan_bakhp[]');
		$id_barang = $this->input->post('id_barang[]');
		$id_satuan = $this->input->post('id_satuan[]');
		$jml_kode = count($id_barang);
		for ($i=0;$i<$jml_kode;$i++){
		if(!empty($jml_pemeriksaan_bakhp[$i]) OR $jml_pemeriksaan_bakhp[$i] > 0){
			$this->db->select("COUNT(*) as num");
			$this->db->where('id_tindakan',$id_tindakan);
			$this->db->where('id_barang',$id_barang[$i]);
			$this->db->where('id_unit',$id_unit);
			$q = $this->db->get('pemeriksaan_bakhp')->row();
			$jml = $q->num;
			if($jml == 0){
				$data_pendaftaran = array(
					'id_barang' => $id_barang[$i],
					'id_satuan' => $id_satuan[$i],
					'status_pemeriksaan_bakhp' => $status_pemeriksaan_bakhp[$i],
					'id_unit' => $id_unit,
					'jml_pemeriksaan_bakhp' => $jml_pemeriksaan_bakhp[$i],
					'id_tindakan' => $id_tindakan
				);
				$this->db->insert('pemeriksaan_bakhp', $data_pendaftaran);
			}else{
				$this->edit_pemeriksaan_bakhp($id_barang[$i],$id_satuan[$i],$status_pemeriksaan_bakhp[$i],$jml_pemeriksaan_bakhp[$i],$id_unit,$id_tindakan);
			}
		}
		}
	}
	function edit_pemeriksaan_bakhp($id_barang,$id_satuan,$status_pemeriksaan_bakhp,$jml_pemeriksaan_bakhp,$id_unit,$id_tindakan){
		$data_pendaftaran = array(
			'id_satuan' => $id_satuan,
			'status_pemeriksaan_bakhp' => $status_pemeriksaan_bakhp,
			'jml_pemeriksaan_bakhp' => $jml_pemeriksaan_bakhp
		);
		$this->db->where('id_unit',$id_unit);
		$this->db->where('id_barang',$id_barang);
		$this->db->where('id_tindakan',$id_tindakan);
		$this->db->update('pemeriksaan_bakhp', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function edit_radiologi_fe($id_thickness,$id_tindakan,$id_field_size,$kv,$mas,$fpd){
		$data_pendaftaran = array(
			'id_field_size' => $id_field_size,
			'kv' => $kv,
			'mas' => $mas,
			'fpd' => $fpd
		);
		$this->db->where('id_thickness',$id_thickness);
		$this->db->where('id_tindakan',$id_tindakan);
		$this->db->update('radiologi_fe', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function basic_program_tr($id)
	{
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
	$this->db->where("id_unit", $id);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('a_program_tr');
	$this->db->where("id_unit", $id);

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
	$this->db->where("id_unit", $id);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	$this->db->from('a_program_tr');
$this->db->where("id_unit", $id);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99');
		$jml = $this->m_umum->jumlah_record_filter('pegawai',$kondisi);	 */
		$jml = $this->m_umum->jumlah_record_tabel('a_program_tr');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_programtr_unit(){
		$id_program_tr = $this->input->post('id_program_tr');
		$chk = $this->input->post('chk[]');
		if(!empty($chk)) {
				$terpilih = implode(",", $chk);
		}else{
			$terpilih = "";
		}
		$data_mirm = array(
			'struktur_jabatan' => $terpilih
			);
		$this->db->where('id_program_tr',$id_program_tr);
			$this->db->update('a_program_tr', $data_mirm);
			//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
			if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
			// if (!$this->db->affected_rows())
				return(FALSE);
			else
				return(TRUE);
	}
	function simpan_programtr_tindakan(){
		$id_program_tr = $this->input->post('id_program_tr');
		$chk = $this->input->post('chk[]');
		if(!empty($chk)) {
				$terpilih = implode(",", $chk);
		}else{
			$terpilih = "";
		}
		$data_mirm = array(
			'tindakan' => $terpilih
			);
		$this->db->where('id_program_tr',$id_program_tr);
			$this->db->update('a_program_tr', $data_mirm);
			//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
			if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
			// if (!$this->db->affected_rows())
				return(FALSE);
			else
				return(TRUE);
	}
	function edit_program_tr_waktu(){
		$id_program_tr = $this->input->post('id_program_tr');
		$data_pendaftaran = array(
			'time' => $this->input->post('time'),
			'begin_time' => $this->input->post('begin_time'),
			'end_time' => $this->input->post('end_time')
		);
		$this->db->where('id_program_tr',$id_program_tr);
		$this->db->update('a_program_tr', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function edit_program_dayofweek(){
		$id_program_tr = $this->input->post('id_program_tr');
		$id_dayofweek = $this->input->post('id_dayofweek[]');
		if(!empty($id_dayofweek)) {
				$terpilih = implode(",", $id_dayofweek);
		}else{
			$terpilih = "";
		}
		$data_pendaftaran = array(
			'dayofweek' => $terpilih
		);
		$this->db->where('id_program_tr',$id_program_tr);
		$this->db->update('a_program_tr', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function grafik_pie($first_date,$last_date,$id)	//Laporan Harian
	{
		$this->db->select("SUM(jml_billing) as total,nama_golongan_pemeriksaan");
		$this->db->join('billing bil','bil.id_billing=rad.id_billing','left');
		$this->db->join('tindakan_tarif tt','tt.id_tindakan_tarif=bil.id_tindakan_tarif','left');
		$this->db->join('pendaftaran_unit pu','pu.id_pendaftaran_unit=bil.id_pendaftaran_unit','left');
		$this->db->join('tindakan t','t.id_tindakan=tt.id_tindakan','left');
		$this->db->join('kol_golongan_pemeriksaan kgp','kgp.id_golongan_pemeriksaan=t.id_golongan_pemeriksaan','left');
		$this->db->where('unit_ke', $id);
		$this->db->where('tgl_pemeriksaan BETWEEN "'.date('Y-m-d', strtotime($first_date)).'" and "'.date('Y-m-d', strtotime($last_date)).'"');
		$this->db->group_by('t.id_golongan_pemeriksaan');
		$q = $this->db->get('pemeriksaan rad');
		return $q->result_array();
	}
	function grafik_range1($bentuk,$data){
		$this->db->select("DATE_FORMAT(tgl_pemeriksaan,'%Y') as tgl_logbook");
		$this->db->join('billing bil', 'bil.id_billing=rad.id_billing','left');
		$this->db->join('tindakan_tarif tt', 'tt.id_tindakan_tarif=bil.id_tindakan_tarif','left');
		$this->db->join('pendaftaran_unit pu', 'pu.id_pendaftaran_unit=bil.id_pendaftaran_unit','left');
		$this->db->where('unit_ke', $data['ruangan']);
		if($bentuk =='lt'){
			$this->db->group_by("year(tgl_pemeriksaan)");
		}
		if($bentuk =='lb'){
			$a = '01-01-'.$data['thn'];
			$b = '31-12-'.$data['thn'];
			$this->db->where('tgl_pemeriksaan BETWEEN "'. date('Y-m-d', strtotime($a)). '" and "'. date('Y-m-d', strtotime($b)).'"');
			$this->db->group_by('tgl_pemeriksaan');
		}
		if($bentuk =='lh'){
			$bulanind = $data['bln']."-".$data['thn'];
			$bulaning = $data['thn']."-".$data['bln'];
			$awal	= $bulaning.'-01';
			$akhir = date('t', strtotime($awal));
			$c = '01-'.$bulanind;
			$d = $akhir.'-'.$bulanind;
			$this->db->where('tgl_pemeriksaan BETWEEN "'. date('Y-m-d', strtotime($c)). '" and "'. date('Y-m-d', strtotime($d)).'"');
			$this->db->group_by('DATE(tgl_pemeriksaan)');
		}
		$q = $this->db->get('pemeriksaan rad')->result_array();
	//	echo $this->db->last_query();die();
		return $q;
	}
	function grafik_range2($bentuk,$tgl,$id){
		$this->db->select("id_golongan_pemeriksaan,SUM(jml_billing) as jml_logbook");
		$this->db->join('billing bil', 'bil.id_billing=rad.id_billing','left');
		$this->db->join('tindakan_tarif tt', 'tt.id_tindakan_tarif=bil.id_tindakan_tarif','left');
		$this->db->join('pendaftaran_unit pu', 'pu.id_pendaftaran_unit=bil.id_pendaftaran_unit','left');
		$this->db->join('tindakan t', 't.id_tindakan=tt.id_tindakan','left');
		$this->db->where('unit_ke', $id);
		if($bentuk =='lt'){
			$this->db->where('year(tgl_pemeriksaan)', $tgl);
		}
		if($bentuk =='lb'){
			$this->db->where('tgl_pemeriksaan', date('Y-m-d', strtotime($tgl)));
		}
		if($bentuk =='lh'){
			$this->db->where('tgl_pemeriksaan', date('Y-m-d', strtotime($tgl)));
		}
		$this->db->group_by("id_golongan_pemeriksaan");
		$q = $this->db->get('pemeriksaan rad')->result_array();
	//	echo $this->db->last_query();die();
		return $q;
	}

	function lt2($thn,$id){
		$this->db->select("id_golongan_pemeriksaan,SUM(jml_billing) as jml_logbook");
		$this->db->join('billing bil', 'bil.id_billing=rad.id_billing','left');
		$this->db->join('tindakan_tarif tt', 'tt.id_tindakan_tarif=bil.id_tindakan_tarif','left');
		$this->db->join('pendaftaran_unit pu', 'pu.id_pendaftaran_unit=bil.id_pendaftaran_unit','left');
		$this->db->join('tindakan t', 't.id_tindakan=tt.id_tindakan','left');
		$this->db->where('unit_ke', $id);
		$this->db->where('year(tgl_pemeriksaan)', $thn);
		$this->db->group_by("id_golongan_pemeriksaan");
		$q = $this->db->get('pemeriksaan rad')->result_array();
	//	echo $this->db->last_query();die();
		return $q;
	}
	function lb2($tgl,$id){
		$this->db->select("kgp.nama_golongan_pemeriksaan,kgp.id_golongan_pemeriksaan,
				DATE_FORMAT(rad.waktu_radiologi,'%d-%m-%Y') as tgl_logbook,COUNT(tt.id_tindakan) as jml_logbook");
		$this->db->join('billing bil', 'bil.id_billing=rad.id_billing','left');
		$this->db->join('tindakan_tarif tt', 'tt.id_tindakan_tarif=bil.id_tindakan_tarif','left');
		$this->db->join('pendaftaran_unit pu', 'pu.id_pendaftaran_unit=bil.id_pendaftaran_unit','left');
		$this->db->join('tindakan t', 't.id_tindakan=tt.id_tindakan','left');
		$this->db->join('kol_golongan_pemeriksaan kgp', 'kgp.id_golongan_pemeriksaan=t.id_golongan_pemeriksaan','left');
		$this->db->where('pu.unit_ke', $id);
		$this->db->where('DATE(rad.waktu_radiologi)', date('Y-m-d', strtotime($tgl)));
		$this->db->group_by("t.id_golongan_pemeriksaan");
		$q = $this->db->get('radiologi rad')->result_array();
		//echo $this->db->last_query();die();
		return $q;
	}
	function lh2($tgl,$id){
		$this->db->select("kgp.nama_golongan_pemeriksaan,kgp.id_golongan_pemeriksaan,
				DATE_FORMAT(rad.waktu_radiologi,'%d-%m-%Y') as tgl_logbook,COUNT(tt.id_tindakan) as jml_logbook");
		$this->db->join('billing bil', 'bil.id_billing=rad.id_billing','left');
		$this->db->join('tindakan_tarif tt', 'tt.id_tindakan_tarif=bil.id_tindakan_tarif','left');
		$this->db->join('pendaftaran_unit pu', 'pu.id_pendaftaran_unit=bil.id_pendaftaran_unit','left');
		$this->db->join('tindakan t', 't.id_tindakan=tt.id_tindakan','left');
		$this->db->join('kol_golongan_pemeriksaan kgp', 'kgp.id_golongan_pemeriksaan=t.id_golongan_pemeriksaan','left');
		$this->db->where('pu.unit_ke', $id);
		$this->db->where('DATE(rad.waktu_radiologi)', date('Y-m-d', strtotime($tgl)));
		$this->db->group_by("t.id_golongan_pemeriksaan");
		$q = $this->db->get('radiologi rad')->result_array();
		//echo $this->db->last_query();die();
		return $q;
	}
	// ===================================================================== RADIOLOGI ==================
	function pendaftaran_all($first_date,$last_date,$key,$ruangan)
	{
//		$ids = explode(',', $unit);
		$wordsAry = explode("-", $key);
		$wordsCount = count($wordsAry);
		$fields = "*,
			if (p.jk = '1' ,'Laki-laki','Perempuan') as jk,p.nik,p.tmp_lahir,
			if (p.id_golongan_darah = '0' ,'Belum Ada Data',nama_golongan_darah) as nama_golongan_darah,
			if (p.id_agama = '0' ,'Belum Ada Data',nama_agama) as nama_agama,
			if (p.id_pekerjaan = '0' ,'Belum Ada Data',nama_pekerjaan) as nama_pekerjaan,
			if (p.id_status_kawin = '0' ,'Belum Ada Data',nama_status_kawin) as nama_status_kawin,
			if (p.id_pendidikan = '0' ,'Belum Ada Data',nama_pendidikan) as nama_pendidikan,
			if (p.id_prov = '0' ,'Belum Ada Data',nama_prov) as nama_prov,
			if (p.id_kab = '0' ,'Belum Ada Data',nama_kab) as nama_kab,
			if (p.id_kec = '0' ,'Belum Ada Data',nama_kec) as nama_kec,
			if (p.id_kel = '0' ,'Belum Ada Data',nama_kel) as nama_kel,
			CONCAT((TIMESTAMPDIFF( YEAR, p.tgl_lahir, now() )), ' Tahun ',
			TIMESTAMPDIFF( MONTH, p.tgl_lahir, now() ) % 12, ' Bulan ',
			FLOOR( TIMESTAMPDIFF( DAY, p.tgl_lahir, now() ) % 30.4375 ), ' Hari') as umur,u.nama_ruangan,
			DATE_FORMAT(p.tgl_lahir,'%d-%m-%Y') as tgl_lahir,DATE_FORMAT(p.dibuat,'%d-%m-%Y %H:%i:%s') as dibuat,peg2.nama_pegawai as petugas,
			pd.id_pendaftaran, pu.id_pendaftaran_unit,if (pd.penunjang = '1' ,'LENGKAP','TIDAK LENGKAP') as v_sign,
			DATE_FORMAT(tgl_pendaftaran_unit,'%d-%m-%Y') as waktu_daftar,  nama_status_pasien, u1.nama_ruangan as order_unit,
			if(pd.id_cara_bayar = '6',peg1.nama_pegawai,ka.nama_detil_cara_bayar) as detil_cara_bayar,
			if(pd.id_cara_masuk = '7',u2.nama_ruangan,if(pd.id_instansi_cara_masuk = '0','-',nama_rujukan_instansi)) as id_instansi_cara_masuk,
			if(pd.id_cara_masuk = '7',rapen.nama_pengirim,if(pd.id_dokter_rujukan = '0','-',nama_rujukan_dokter)) as id_dokter_rujukan
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
					case 'id_pendaftaran' : $nmf="pd.id_pendaftaran";break;
		//			case 'rm' : $nmf="p.rm";break;
					case 'nama_unit' : $nmf="u.nama_unit";break;
					case 'jk' : $nmf='ps.jk';break;
					case 'petugas' : $nmf='peg2.nama_pegawai';break;
				//	case 'umur' : $nmf='YEAR(CURDATE()) - YEAR(ps.tgl_lahir)';break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where('pu.unit_ke',$ruangan);
				$this->db->where('DATE(tgl_pendaftaran_unit) BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
				$this->db->where('pu.id_status_pasien','1');
				if(!empty($key) || $this->input->post('key',true)){
					$this->db->group_start();
					for($i=0;$i<$wordsCount;$i++) {
						$this->db->or_where("(rm LIKE '%".$wordsAry[$i]."%' OR nama_pasien LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
					}
					$this->db->group_end();
				}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('pendaftaran_unit pu');                   //04 Form.. left join
		$this->db->join('pendaftaran pd', 'pd.id_pendaftaran=pu.id_pendaftaran','left');
		$this->db->join('pasien p', 'p.id_pasien=pd.id_pasien','left');
		$this->db->join('kol_cara_bayar cb','cb.id_cara_bayar=pd.id_cara_bayar','left');
		$this->db->join('kol_detil_cara_bayar ka','ka.id_detil_cara_bayar=pd.id_detil_cara_bayar','left');
		$this->db->join('kol_cara_masuk cm',  'cm.id_cara_masuk=pd.id_cara_masuk','left');
		$this->db->join('kol_rujukan_dokter dr','dr.id_rujukan_dokter=pd.id_dokter_rujukan','left');
		$this->db->join('kol_rujukan_instansi ir','ir.id_rujukan_instansi=pd.id_instansi_cara_masuk','left');
		$this->db->join('kol_status_pasien sp',     'sp.id_status_pasien=pu.id_status_pasien','left');
		$this->db->join('radiologi_pengirim rapen',     'rapen.id_pengirim=pd.id_dokter_rujukan','left');
		$this->db->join('pegawai peg1','peg1.id_pegawai=pd.id_detil_cara_bayar','left');
		$this->db->join('pegawai peg2','peg2.id_pegawai=pu.id_petugas','left');
		$this->db->join('pegawai drpeg','drpeg.id_pegawai=pu.dr_pengirim','left');
		$this->db->join('ruangan u','u.id_ruangan=pu.id_unit','left');
		$this->db->join('ruangan u1','u1.id_ruangan=pu.unit_ke','left');
		$this->db->join('ruangan u2','u2.id_ruangan=pd.id_instansi_cara_masuk','left');
		$this->db->join('kol_agama a', 'a.id_agama=p.id_agama','left');
		$this->db->join('kol_golongan_darah kgd', 'kgd.id_golongan_darah=p.id_golongan_darah','left');
		$this->db->join('kol_pendidikan pend', 'pend.id_pendidikan=p.id_pendidikan','left');
		$this->db->join('kol_pekerjaan kp', 'kp.id_pekerjaan=p.id_pekerjaan','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=p.id_status_kawin','left');
		$this->db->join('kol_provinsi provi', 'provi.id_prov=p.id_prov','left');
		$this->db->join('kol_kabupaten kabu', 'kabu.id_kab=p.id_kab','left');
		$this->db->join('kol_kecamatan keca', 'keca.id_kec=p.id_kec','left');
		$this->db->join('kol_kelurahan kelu', 'kelu.id_kel=p.id_kel','left');
		$this->db->where('pu.unit_ke',$ruangan);
		$this->db->where('DATE(tgl_pendaftaran_unit) BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$this->db->where('pu.id_status_pasien','1');
		if(!empty($key) || $this->input->post('key',true)){
			$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(rm LIKE '%".$wordsAry[$i]."%' OR nama_pasien LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
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
					case 'id_pendaftaran' : $nmf="pd.id_pendaftaran";break;
	//				case 'rm' : $nmf="p.rm";break;
					case 'nama_unit' : $nmf="u.nama_unit";break;
					case 'jk' : $nmf='ps.jk';break;
					case 'petugas' : $nmf='peg2.nama_pegawai';break;
				//	case 'umur' : $nmf='YEAR(CURDATE()) - YEAR(ps.tgl_lahir)';break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where('pu.unit_ke',$ruangan);
				$this->db->where('DATE(tgl_pendaftaran_unit) BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
				$this->db->where('pu.id_status_pasien','1');
				if(!empty($key) || $this->input->post('key',true)){
					$this->db->group_start();
					for($i=0;$i<$wordsCount;$i++) {
						$this->db->or_where("(rm LIKE '%".$wordsAry[$i]."%' OR nama_pasien LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
					}
					$this->db->group_end();
				}
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
		$this->db->from('pendaftaran_unit pu');                   //04 Form.. left join
		$this->db->join('pendaftaran pd', 'pd.id_pendaftaran=pu.id_pendaftaran','left');
		$this->db->join('pasien p', 'p.id_pasien=pd.id_pasien','left');
		$this->db->join('kol_cara_bayar cb','cb.id_cara_bayar=pd.id_cara_bayar','left');
		$this->db->join('kol_detil_cara_bayar ka','ka.id_detil_cara_bayar=pd.id_detil_cara_bayar','left');
		$this->db->join('kol_cara_masuk cm',  'cm.id_cara_masuk=pd.id_cara_masuk','left');
		$this->db->join('kol_rujukan_dokter dr','dr.id_rujukan_dokter=pd.id_dokter_rujukan','left');
		$this->db->join('kol_rujukan_instansi ir','ir.id_rujukan_instansi=pd.id_instansi_cara_masuk','left');
		$this->db->join('kol_status_pasien sp',     'sp.id_status_pasien=pu.id_status_pasien','left');
		$this->db->join('radiologi_pengirim rapen',     'rapen.id_pengirim=pd.id_dokter_rujukan','left');
		$this->db->join('pegawai peg1','peg1.id_pegawai=pd.id_detil_cara_bayar','left');
		$this->db->join('pegawai peg2','peg2.id_pegawai=pu.id_petugas','left');
		$this->db->join('pegawai drpeg','drpeg.id_pegawai=pu.dr_pengirim','left');
		$this->db->join('ruangan u','u.id_ruangan=pu.id_unit','left');
		$this->db->join('ruangan u1','u1.id_ruangan=pu.unit_ke','left');
		$this->db->join('ruangan u2','u2.id_ruangan=pd.id_instansi_cara_masuk','left');
		$this->db->join('kol_agama a', 'a.id_agama=p.id_agama','left');
		$this->db->join('kol_golongan_darah kgd', 'kgd.id_golongan_darah=p.id_golongan_darah','left');
		$this->db->join('kol_pendidikan pend', 'pend.id_pendidikan=p.id_pendidikan','left');
		$this->db->join('kol_pekerjaan kp', 'kp.id_pekerjaan=p.id_pekerjaan','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=p.id_status_kawin','left');
		$this->db->join('kol_provinsi provi', 'provi.id_prov=p.id_prov','left');
		$this->db->join('kol_kabupaten kabu', 'kabu.id_kab=p.id_kab','left');
		$this->db->join('kol_kecamatan keca', 'keca.id_kec=p.id_kec','left');
		$this->db->join('kol_kelurahan kelu', 'kelu.id_kel=p.id_kel','left');
		$this->db->where('pu.unit_ke',$ruangan);
		$this->db->where('DATE(tgl_pendaftaran_unit) BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$this->db->where('pu.id_status_pasien','1');
		if(!empty($key) || $this->input->post('key',true)){
			$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(rm LIKE '%".$wordsAry[$i]."%' OR nama_pasien LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
	//	$kondisi=array('id_level !='=>'99');
	//	$jml = $this->m_umum->jumlah_record_filter('user',$kondisi);		//[coding here] ganti tabel utamanya
		$jml = $this->m_umum->jumlah_record_tabel('pendaftaran_unit');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_pasien_ku_umum(){
		$this->edit_penunjang_pendaftaran();
		$data_pendaftaran = array(
			'id_unit' => $this->input->post('id_unit_user'),
			'id_pendaftaran' => $this->input->post('id_pendaftaran'),
			'hamil' => $this->input->post('hamil'),
			'bb' => $this->input->post('bb'),
			'tb' => $this->input->post('tb')
		);
		return $this->db->insert('pemeriksaan_ku', $data_pendaftaran);
	}
	function edit_penunjang_pendaftaran(){
		$id_pendaftaran = $this->input->post('id_pendaftaran');
		$data_pendaftaran = array(
			'penunjang' => 1
		);
		$this->db->where('id_pendaftaran',$id_pendaftaran);
		$this->db->update('pendaftaran', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function edit_pasien_ku_umum(){
		$id_pemeriksaan_ku = $this->input->post('id_pemeriksaan_ku');
		$data_pendaftaran = array(
			'hamil' => $this->input->post('hamil'),
			'bb' => $this->input->post('bb'),
			'tb' => $this->input->post('tb')
		);
		$this->db->where('id_pemeriksaan_ku',$id_pemeriksaan_ku);
		$this->db->update('pemeriksaan_ku', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function pemeriksaan_penunjang_all($id)
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,DATE_FORMAT(pp.tgl_pemeriksaan_penunjang,'%d-%m-%Y') as tgl_pemeriksaan_penunjang";
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
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	  $this->db->from('pemeriksaan_penunjang pp');
		$this->db->join('tindakan t', 't.id_tindakan=pp.id_tindakan','left');
		$this->db->where('pp.id_pendaftaran', $id);

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
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	$this->db->from('pemeriksaan_penunjang pp');
		$this->db->join('tindakan t', 't.id_tindakan=pp.id_tindakan','left');
	$this->db->where('pp.id_pendaftaran', $id);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('pemeriksaan_penunjang');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_pemeriksaan_penunjang(){
		$tgl_pemeriksaan_penunjang = $this->input->post('tgl');
		$tgl_pemeriksaan_penunjang = date('Y-m-d', strtotime($tgl_pemeriksaan_penunjang));
		$data_pendaftaran = array(
			'id_tindakan' => $this->input->post('nama'),
			'hasil_pemeriksaan_penunjang' => $this->input->post('hasil'),
			'tgl_pemeriksaan_penunjang' => $tgl_pemeriksaan_penunjang,
			'id_pendaftaran' => $this->input->post('daftar')
		);
		return $this->db->insert('pemeriksaan_penunjang', $data_pendaftaran);
	}
	function edit_pemeriksaan_penunjang(){
		$id_pemeriksaan_penunjang = $this->input->post('daftar');
		$tgl_pemeriksaan_penunjang = $this->input->post('tgl');
		$tgl_pemeriksaan_penunjang = date('Y-m-d', strtotime($tgl_pemeriksaan_penunjang));
		$data_pendaftaran = array(
			'id_tindakan' => $this->input->post('nama'),
			'hasil_pemeriksaan_penunjang' => $this->input->post('hasil'),
			'tgl_pemeriksaan_penunjang' => $tgl_pemeriksaan_penunjang
		);
		$this->db->where('id_pemeriksaan_penunjang',$id_pemeriksaan_penunjang);
		$this->db->update('pemeriksaan_penunjang', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
}
