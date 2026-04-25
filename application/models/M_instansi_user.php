<?php
class M_instansi_user extends CI_model{
	function user_all($key)
	{
		$wordsAry = explode("-", $key);
		$wordsCount = count($wordsAry);
		$jabatan = explode(',', $this->session->mas_kred);
		$instansi = explode(',', $this->session->mas_ins);
	//--------- Ambil nama kolom --------- [coding here] .jpg
	$fields = "*,if (foto = '' ,'noavatar.jpg',foto) as foto,if(ol_user.status_asesor = 1,kk.nama_komite,'Anggota') as nama_komite,
		DATE_FORMAT(peg.tgl_lahir,'%d-%m-%Y') as tgl_lahir,if (peg.jk = '1' ,'Laki-laki','Perempuan') as jk,peg.id_pegawai,
		DATE_FORMAT(tgl_aplikasi_bayar,'%d-%m-%Y %H:%i:%s') as tgl_aplikasi_bayar,DATE_FORMAT(tgl_expired,'%d-%m-%Y') as tgl_expired,
		if(status_aplikasi_bayar = 1,if(tgl_expired < CURDATE(),'expired','aktif'),'premium') as status_aplikasi_bayar
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
		$this->db->where('visible', 1);
		$this->db->where('status_user', 1);
		$this->db->where_in('ol_user.refer', $instansi);
	//	$this->db->where_in('jabatan_fungsional.id_jabatan', $jabatan);
		if(!empty($key) || $this->input->post('key',true)){
			$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(peg.nama_pegawai LIKE '%".$wordsAry[$i]."%' OR jabatan_fungsional.nama_jabatan_fungsional LIKE '%".$wordsAry[$i]."%' OR kk.nama_komite LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_user');
	    $this->db->join('kol_komite kk', 'kk.id_komite=ol_user.status_asesor','left');
	    $this->db->join('ol_pegawai peg', 'peg.id_pegawai=ol_user.id_pegawai','left');
	    $this->db->join('ol_pegawai_grade opg', 'opg.id_grade=peg.id_grade','left');
	    $this->db->join('ol_pegawai_unit opu', 'opu.id_pegawai=peg.id_pegawai','left');
	    $this->db->join('ol_unit ou', 'ou.id_unit=opu.id_unit','left');
	    $this->db->join('aplikasi_bayar', 'aplikasi_bayar.id_konsumen=peg.id_pegawai','left');
	    $this->db->join('user_level', 'user_level.id_level=ol_user.id_level','left');
	    $this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
	//    $this->db->join('ol_unit', 'ol_unit.id_unit=ol_user.unit','left');
	    $this->db->join('kol_working', 'kol_working.id_working=ol_user.refer','left');
		$this->db->join('kol_status_kawin kss', 'kss.id_status_kawin=peg.id_status_kawin','left');
		$this->db->join('ol_status_pegawai ksp', 'ksp.id_status_pegawai=peg.tipe_pegawai','left');
		$this->db->join('kol_pendidikan kp', 'kp.id_pendidikan=peg.id_pendidikan','left');
		$this->db->where('visible', 1);
		$this->db->where('status_user', 1);
		$this->db->where_in('ol_user.refer', $instansi);
	//	$this->db->where_in('jabatan_fungsional.id_jabatan', $jabatan);
		if(!empty($key) || $this->input->post('key',true)){
			$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(peg.nama_pegawai LIKE '%".$wordsAry[$i]."%' OR jabatan_fungsional.nama_jabatan_fungsional LIKE '%".$wordsAry[$i]."%' OR kk.nama_komite LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
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
				//	case 'no_hp' : $nmf="peg.no_hp";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('visible', 1);
		$this->db->where('status_user', 1);
		$this->db->where_in('ol_user.refer', $instansi);
	//	$this->db->where_in('jabatan_fungsional.id_jabatan', $jabatan);
		if(!empty($key) || $this->input->post('key',true)){
			$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(peg.nama_pegawai LIKE '%".$wordsAry[$i]."%' OR jabatan_fungsional.nama_jabatan_fungsional LIKE '%".$wordsAry[$i]."%' OR kk.nama_komite LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
			}
		  }
		}

	    $this->db->from('ol_user');
	    $this->db->join('kol_komite kk', 'kk.id_komite=ol_user.status_asesor','left');
	    $this->db->join('ol_pegawai peg', 'peg.id_pegawai=ol_user.id_pegawai','left');
	    $this->db->join('ol_pegawai_grade opg', 'opg.id_grade=peg.id_grade','left');
	    $this->db->join('ol_pegawai_unit opu', 'opu.id_pegawai=peg.id_pegawai','left');
	    $this->db->join('ol_unit ou', 'ou.id_unit=opu.id_unit','left');
	    $this->db->join('aplikasi_bayar', 'aplikasi_bayar.id_konsumen=peg.id_pegawai','left');
	    $this->db->join('user_level', 'user_level.id_level=ol_user.id_level','left');
	    $this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
	//    $this->db->join('ol_unit', 'ol_unit.id_unit=ol_user.unit','left');
	    $this->db->join('kol_working', 'kol_working.id_working=ol_user.refer','left');
		$this->db->join('kol_status_kawin kss', 'kss.id_status_kawin=peg.id_status_kawin','left');
		$this->db->join('ol_status_pegawai ksp', 'ksp.id_status_pegawai=peg.tipe_pegawai','left');
		$this->db->join('kol_pendidikan kp', 'kp.id_pendidikan=peg.id_pendidikan','left');
		$this->db->where('visible', 1);
		$this->db->where('status_user', 1);
		$this->db->where_in('ol_user.refer', $instansi);
	//	$this->db->where_in('jabatan_fungsional.id_jabatan', $jabatan);
		if(!empty($key) || $this->input->post('key',true)){
			$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(peg.nama_pegawai LIKE '%".$wordsAry[$i]."%' OR jabatan_fungsional.nama_jabatan_fungsional LIKE '%".$wordsAry[$i]."%' OR kk.nama_komite LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('ol_pegawai');			//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
	//	 print_r($output);die();
		return $output;
	}
	function reset_password($id){
		$password = hash("sha512", md5("7654321"));
		$data_pendaftaran = array(
			'password' => $password
		);
		$this->db->where('id_user',$id);
		$this->db->update('ol_user', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function simpan_status_asesor(){
		$id_user = $this->input->post('id_user');	
		$data_pendaftaran = array(
			'status_asesor' => $this->input->post('status_asesor')
		);
		$this->db->where('id_user',$id_user);
		$this->db->update('ol_user', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function simpan_pegawai_unit(){
		$data_pendaftaran = array(
			'id_unit' => $this->input->post('id_unit'),
			'id_pegawai' => $this->input->post('id_pegawai')
		);
		return $this->db->insert('ol_pegawai_unit', $data_pendaftaran);
	}
	function edit_pegawai_unit(){
		$id_pegawai = $this->input->post('id_pegawai');	
		$data_pendaftaran = array(
			'id_unit' => $this->input->post('id_unit')
		);
		$this->db->where('id_pegawai',$id_pegawai);
		$this->db->update('ol_pegawai_unit', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function simpan_grade(){
		$id_pegawai = $this->input->post('id_pegawai');	
		$data_pendaftaran = array(
			'id_grade' => $this->input->post('id_grade')
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
	function equipment_all()
	{
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
	    $this->db->where('oe.id_unit',$this->session->unit);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_equipment oe');		
	    $this->db->where('oe.id_unit',$this->session->unit);

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
	    $this->db->where('oe.id_unit',$this->session->unit);
			}
		  }
		}

	    $this->db->from('ol_equipment oe');		
	    $this->db->where('oe.id_unit',$this->session->unit);	

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
 		$kondisi=array('id_unit'=>$this->session->unit);
		$jml = $this->m_umum->jumlah_record_filter('ol_equipment',$kondisi);
//		$jml = $this->m_umum->jumlah_record_tabel('ol_logbook_lhu');

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
// ========================================= MASTER
	function pendidikan_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
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
					// case 'telp' : $nmf="peg.telp";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('kol_pendidikan');
		
		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'id_ms_code'   : $nmf="kc.id_ms_code";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('kol_pendidikan');
		
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('kol_pendidikan');		//[coding here] ganti tabel utamanya
				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;	
	}
	function simpan_pendidikan(){
		$data_pendaftaran = array(
			'nama_pendidikan' => $this->input->post('nama_pendidikan')
		);
		return $this->db->insert('kol_pendidikan', $data_pendaftaran);
	}
	function edit_pendidikan(){
		$id_pendidikan = $this->input->post('id_pendidikan');
		$data_pendaftaran = array(
			'nama_pendidikan' => $this->input->post('nama_pendidikan'),
			'status_pendidikan' => $this->input->post('status_pendidikan')
		);
		$this->db->where('id_pendidikan',$id_pendidikan);
		$this->db->update('kol_pendidikan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}
	function ol_unit_all()
	{
		$idx = explode(',', $this->session->mas_ins);
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
					// case 'telp' : $nmf="peg.telp";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where_in("ou.id_instansi",$idx);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_unit ou');
	    $this->db->join('srt_struktur_jabatan sj', 'sj.id_struktur_jabatan=ou.id_struktur_jabatan','left');
	    $this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
	    $this->db->where_in("ou.id_instansi",$idx);
		
		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'id_ms_code'   : $nmf="kc.id_ms_code";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where_in("ou.id_instansi",$idx);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('ol_unit ou');
	    $this->db->join('srt_struktur_jabatan sj', 'sj.id_struktur_jabatan=ou.id_struktur_jabatan','left');
	    $this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
	    $this->db->where_in("ou.id_instansi",$idx);
		
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
			'nama_unit' => $this->input->post('nama_unit'),
			'id_instansi' => $this->input->post('id_instansi'),
			'id_struktur_jabatan' => $this->input->post('id_struktur_jabatan'),
			'status_unit' => $this->input->post('status_unit')
		);
		return $this->db->insert('ol_unit', $data_pendaftaran);
	}
	function edit_ol_unit(){
		$id_unit = $this->input->post('id_unit');
		$data_pendaftaran = array(
			'nama_unit' => $this->input->post('nama_unit'),
			'id_instansi' => $this->input->post('id_instansi'),
			'id_struktur_jabatan' => $this->input->post('id_struktur_jabatan'),
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
	function ol_bahan_all()
	{
		$idx = explode(',', $this->session->mas_ins);
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
					// case 'telp' : $nmf="peg.telp";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where("ob.id_unit",$this->session->unit);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_bahan ob');
	    $this->db->join('ol_unit ou', 'ou.id_unit=ob.id_unit','left');
	    $this->db->where("ob.id_unit",$this->session->unit);
		
		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'id_ms_code'   : $nmf="kc.id_ms_code";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where("ob.id_unit",$this->session->unit);
			}
		  }
		}

	    $this->db->from('ol_bahan ob');
	    $this->db->join('ol_unit ou', 'ou.id_unit=ob.id_unit','left');
	    $this->db->where("ob.id_unit",$this->session->unit);
		
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('ol_bahan');		//[coding here] ganti tabel utamanya
				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;	
	}
	function simpan_ol_bahan(){
		$kode = $this->m_rancak->kode_generator_urut(15,'OB');
		$data_pendaftaran = array(
			'id_bahan' => $kode,
			'nama_bahan' => $this->input->post('nama_bahan'),
			'id_unit' => $this->session->unit,
			'status_bahan' => $this->input->post('status_bahan')
		);
		return $this->db->insert('ol_bahan', $data_pendaftaran);
	}
	function edit_ol_bahan(){
		$id_bahan = $this->input->post('id_bahan');
		$data_pendaftaran = array(
			'nama_bahan' => $this->input->post('nama_bahan'),
			'id_unit' => $this->input->post('id_unit'),
			'status_bahan' => $this->input->post('status_bahan')
		);
		$this->db->where('id_bahan',$id_bahan);
		$this->db->update('ol_bahan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}
	function berkas_kategori_all()
	{
		$instansi = explode(',', $this->session->mas_ins);
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
					// case 'telp' : $nmf="peg.telp";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('kunci', 25);
		$this->db->where_in('instansi_berkas_kategori', $instansi);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_berkas_kategori');
	    $this->db->join('kol_working', 'kol_working.id_working=ol_berkas_kategori.instansi_berkas_kategori','left');
	    $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_berkas_kategori.pembuat_berkas_kategori','left');
	    $this->db->join('jabatan', 'jabatan.id_jabatan=ol_berkas_kategori.id_jabatan','left');
		$this->db->where('kunci', 25);
		$this->db->where_in('instansi_berkas_kategori', $instansi);
		
		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'id_ms_code'   : $nmf="kc.id_ms_code";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('kunci', 25);
		$this->db->where_in('instansi_berkas_kategori', $instansi);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('ol_berkas_kategori');
	    $this->db->join('kol_working', 'kol_working.id_working=ol_berkas_kategori.instansi_berkas_kategori','left');
	    $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_berkas_kategori.pembuat_berkas_kategori','left');
	    $this->db->join('jabatan', 'jabatan.id_jabatan=ol_berkas_kategori.id_jabatan','left');
		$this->db->where('kunci', 25);
		$this->db->where_in('instansi_berkas_kategori', $instansi);
		
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('ol_berkas_kategori');		//[coding here] ganti tabel utamanya
				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;	
	}
	function simpan_berkas_kategori($id){
		$data_pendaftaran = array(
			'nama_berkas_kategori' => $this->input->post('nama_berkas_kategori'),
			'instansi_berkas_kategori' => $this->input->post('instansi_berkas_kategori'),
			'id_jabatan' => $this->session->id_jabatan,
			'pembuat_berkas_kategori' => $this->session->id_pegawai,
			'status_berkas_kategori' => $this->input->post('status_berkas_kategori')
		);
		return $this->db->insert('ol_berkas_kategori', $data_pendaftaran);
	}
	function edit_berkas_kategori(){
		$id_berkas_kategori = $this->input->post('id_berkas_kategori');
		$data_pendaftaran = array(
			'nama_berkas_kategori' => $this->input->post('nama_berkas_kategori'),
			'instansi_berkas_kategori' => $this->input->post('instansi_berkas_kategori'),
			'status_berkas_kategori' => $this->input->post('status_berkas_kategori')
		);
		$this->db->where('id_berkas_kategori',$id_berkas_kategori);
		$this->db->update('ol_berkas_kategori', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}
	function kategori_pelatihan_all()
	{
		$instansi = explode(',', $this->session->mas_ins);
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
					// case 'telp' : $nmf="peg.telp";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where_in('instansi_kategori_pelatihan', $instansi);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_kategori_pelatihan');
	    $this->db->join('kol_working', 'kol_working.id_working=ol_kategori_pelatihan.instansi_kategori_pelatihan','left');
	    $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_kategori_pelatihan.pembuat_kategori_pelatihan','left');
	    $this->db->where_in('instansi_kategori_pelatihan', $instansi);
		
		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'id_ms_code'   : $nmf="kc.id_ms_code";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where_in('instansi_kategori_pelatihan', $instansi);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('ol_kategori_pelatihan');
	    $this->db->join('kol_working', 'kol_working.id_working=ol_kategori_pelatihan.instansi_kategori_pelatihan','left');
	    $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_kategori_pelatihan.pembuat_kategori_pelatihan','left');
	    $this->db->where_in('instansi_kategori_pelatihan', $instansi);
		
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('ol_kategori_pelatihan');		//[coding here] ganti tabel utamanya
				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;	
	}
	function simpan_kategori_pelatihan(){
		$data_pendaftaran = array(
			'nama_kategori_pelatihan' => $this->input->post('nama_kategori_pelatihan'),
			'instansi_kategori_pelatihan' => $this->input->post('instansi_kategori_pelatihan'),
			'pembuat_kategori_pelatihan' => $this->session->id_pegawai,
			'id_jabatan' => $this->session->id_jabatan,
			'status_kategori_pelatihan' => $this->input->post('status_kategori_pelatihan')
		);
		return $this->db->insert('ol_kategori_pelatihan', $data_pendaftaran);
	}
	function edit_kategori_pelatihan(){
		$id_kategori_pelatihan = $this->input->post('id_kategori_pelatihan');
		$data_pendaftaran = array(
			'nama_kategori_pelatihan' => $this->input->post('nama_kategori_pelatihan'),
			'instansi_kategori_pelatihan' => $this->input->post('instansi_kategori_pelatihan'),
			'status_kategori_pelatihan' => $this->input->post('status_kategori_pelatihan')
		);
		$this->db->where('id_kategori_pelatihan',$id_kategori_pelatihan);
		$this->db->update('ol_kategori_pelatihan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}
	function srt_struktur_jabatan_all()
	{
		$idx = explode(',', $this->session->mas_ins);
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
					// case 'telp' : $nmf="peg.telp";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where_in("ou.id_instansi",$idx);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('srt_struktur_jabatan ou');
	    $this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
	    $this->db->where_in("ou.id_instansi",$idx);
		
		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'id_ms_code'   : $nmf="kc.id_ms_code";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where_in("ou.id_instansi",$idx);
			}
		  }
		}

	    $this->db->from('srt_struktur_jabatan ou');
	    $this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
	    $this->db->where_in("ou.id_instansi",$idx);
		
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('srt_struktur_jabatan');		//[coding here] ganti tabel utamanya
				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;	
	}
	function simpan_srt_struktur_jabatan(){
		$kode = $this->m_rancak->kode_generator_urut(15,'EL');
		$data_pendaftaran = array(
			'id_struktur_jabatan' => $kode,
			'nama_struktur_jabatan' => $this->input->post('nama_struktur_jabatan'),
			'id_instansi' => $this->input->post('id_instansi'),
			'status_struktur_jabatan' => $this->input->post('status_struktur_jabatan')
		);
		return $this->db->insert('srt_struktur_jabatan', $data_pendaftaran);
	}
	function edit_srt_struktur_jabatan(){
		$id_struktur_jabatan = $this->input->post('id_struktur_jabatan');
		$data_pendaftaran = array(
			'nama_struktur_jabatan' => $this->input->post('nama_struktur_jabatan'),
			'id_instansi' => $this->input->post('id_instansi'),
			'status_struktur_jabatan' => $this->input->post('status_struktur_jabatan')
		);
		$this->db->where('id_struktur_jabatan',$id_struktur_jabatan);
		$this->db->update('srt_struktur_jabatan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}
	function srt_kategori_surat_all()
	{
		$idx = explode(',', $this->session->mas_ins);
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
					// case 'telp' : $nmf="peg.telp";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where_in("ou.id_instansi",$idx);
				$this->db->where("ou.tipe_jabatan",1);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('srt_kategori_surat ou');
	    $this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
	    $this->db->where_in("ou.id_instansi",$idx);
	    $this->db->where("ou.tipe_jabatan",1);
		
		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'id_ms_code'   : $nmf="kc.id_ms_code";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where_in("ou.id_instansi",$idx);
				$this->db->where("ou.tipe_jabatan",1);
			}
		  }
		}

	    $this->db->from('srt_kategori_surat ou');
	    $this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
	    $this->db->where_in("ou.id_instansi",$idx);
	    $this->db->where("ou.tipe_jabatan",1);
		
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('srt_kategori_surat');		//[coding here] ganti tabel utamanya
				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;	
	}
	function simpan_srt_kategori_surat(){
		$kode = $this->m_rancak->kode_generator_urut(15,'EL');
		$data_pendaftaran = array(
			'id_kategori_surat' => $kode,
			'tipe_jabatan' => 1,
			'nama_kategori_surat' => $this->input->post('nama_kategori_surat'),
			'id_instansi' => $this->input->post('id_instansi'),
			'status_kategori_surat' => $this->input->post('status_kategori_surat')
		);
		return $this->db->insert('srt_kategori_surat', $data_pendaftaran);
	}
	function edit_srt_kategori_surat(){
		$id_kategori_surat = $this->input->post('id_kategori_surat');
		$data_pendaftaran = array(
			'nama_kategori_surat' => $this->input->post('nama_kategori_surat'),
			'id_instansi' => $this->input->post('id_instansi'),
			'status_kategori_surat' => $this->input->post('status_kategori_surat')
		);
		$this->db->where('id_kategori_surat',$id_kategori_surat);
		$this->db->update('srt_kategori_surat', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}
	function golongan_pemeriksaan_all()
	{
	//	$idx = explode(',', $this->session->mas_ins);
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
					// case 'telp' : $nmf="peg.telp";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where("ou.id_instansi",$this->session->refer);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('kol_golongan_pemeriksaan kgp');
	    $this->db->join('ol_unit ou', 'ou.id_unit=kgp.id_unit','left');
	    $this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
	    $this->db->where("ou.id_instansi",$this->session->refer);
		
		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'id_ms_code'   : $nmf="kc.id_ms_code";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where("ou.id_instansi",$this->session->refer);
			}
		  }
		}

	    $this->db->from('kol_golongan_pemeriksaan kgp');
	    $this->db->join('ol_unit ou', 'ou.id_unit=kgp.id_unit','left');
	    $this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
	    $this->db->where("ou.id_instansi",$this->session->refer);
		
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('kol_golongan_pemeriksaan');		//[coding here] ganti tabel utamanya
				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;	
	}
	function simpan_kol_golongan_pemeriksaan(){
		$kode = $this->m_rancak->kode_generator_urut(15,'EL');
		$data_pendaftaran = array(
			'nama_golongan_pemeriksaan' => $this->input->post('nama_golongan_pemeriksaan'),
			'id_unit' => $this->input->post('id_unit'),
			'status_golongan_pemeriksaan' => $this->input->post('status_golongan_pemeriksaan')
		);
		return $this->db->insert('kol_golongan_pemeriksaan', $data_pendaftaran);
	}
	function edit_kol_golongan_pemeriksaan(){
		$id_golongan_pemeriksaan = $this->input->post('id_golongan_pemeriksaan');
		$data_pendaftaran = array(
			'nama_golongan_pemeriksaan' => $this->input->post('nama_golongan_pemeriksaan'),
			'id_unit' => $this->input->post('id_unit'),
			'status_golongan_pemeriksaan' => $this->input->post('status_golongan_pemeriksaan')
		);
		$this->db->where('id_golongan_pemeriksaan',$id_golongan_pemeriksaan);
		$this->db->update('kol_golongan_pemeriksaan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}
	function tindakan_all()
	{
	//	$idx = explode(',', $this->session->mas_ins);
		$fields = "*,FORMAT(tarif,'#,###,##0') as tarif,t.id_tindakan";
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
					// case 'telp' : $nmf="peg.telp";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where("ou.id_instansi",$this->session->refer);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('tindakan t');
	    $this->db->join('tindakan_tarif tt', 'tt.id_tindakan=t.id_tindakan','left');
	    $this->db->join('kol_golongan_pemeriksaan kgp', 'kgp.id_golongan_pemeriksaan=t.id_golongan_pemeriksaan','left');
	    $this->db->join('ol_unit ou', 'ou.id_unit=kgp.id_unit','left');
	    $this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
	    $this->db->where("ou.id_instansi",$this->session->refer);
		
		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'id_ms_code'   : $nmf="kc.id_ms_code";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where("ou.id_instansi",$this->session->refer);
			}
		  }
		}

	    $this->db->from('tindakan t');
	    $this->db->join('tindakan_tarif tt', 'tt.id_tindakan=t.id_tindakan','left');
	    $this->db->join('kol_golongan_pemeriksaan kgp', 'kgp.id_golongan_pemeriksaan=t.id_golongan_pemeriksaan','left');
	    $this->db->join('ol_unit ou', 'ou.id_unit=kgp.id_unit','left');
	    $this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
	    $this->db->where("ou.id_instansi",$this->session->refer);
		
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('tindakan');		//[coding here] ganti tabel utamanya
				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;	
	}
	function simpan_tindakan(){
		$kode = $this->m_rancak->kode_generator_urut(15,'TN');
		$data_pendaftaran = array(
			'id_tindakan' => $kode,
			'pembuat_tindakan' => $this->session->id_pegawai,
			'nama_tindakan' => $this->input->post('nama_tindakan'),
			'id_golongan_pemeriksaan' => $this->input->post('id_golongan_pemeriksaan'),
			'status_tindakan' => $this->input->post('status_tindakan')
		);
		return $this->db->insert('tindakan', $data_pendaftaran);
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
	function rujukan_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
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
					// case 'telp' : $nmf="peg.telp";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where("p.id_instansi",$this->session->refer);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('kol_rujukan_dokter p');
		$this->db->join('kol_provinsi provi', 'provi.id_prov=p.id_prov','left');
		$this->db->join('kol_kabupaten kabu', 'kabu.id_kab=p.id_kab','left');
		$this->db->join('kol_kecamatan keca', 'keca.id_kec=p.id_kec','left');
		$this->db->join('kol_kelurahan kelu', 'kelu.id_kel=p.id_kel','left');
		$this->db->where("p.id_instansi",$this->session->refer);

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'id_ms_code'   : $nmf="kc.id_ms_code";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where("p.id_instansi",$this->session->refer);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('kol_rujukan_dokter p');
		$this->db->join('kol_provinsi provi', 'provi.id_prov=p.id_prov','left');
		$this->db->join('kol_kabupaten kabu', 'kabu.id_kab=p.id_kab','left');
		$this->db->join('kol_kecamatan keca', 'keca.id_kec=p.id_kec','left');
		$this->db->join('kol_kelurahan kelu', 'kelu.id_kel=p.id_kel','left');
		$this->db->where("p.id_instansi",$this->session->refer);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('kol_rujukan_dokter');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_rujukan_dokter(){
		$kode = $this->m_rancak->kode_generator_urut(15,'DR');
		$data_pendaftaran = array(
			'id_rujukan_dokter' => $kode,
			'nama_rujukan_dokter' => $this->input->post('nama_rujukan_dokter'),
			'alamat_rujukan_dokter' => $this->input->post('alamat_rujukan_dokter'),
			'email_rujukan_dokter' => $this->input->post('email_rujukan_dokter'),
			'kontak_rujukan_dokter' => $this->input->post('kontak_rujukan_dokter'),
			'id_instansi' => $this->session->refer
		);
		return $this->db->insert('kol_rujukan_dokter', $data_pendaftaran);
	}
	function edit_rujukan_dokter(){
		$id_rujukan_dokter = $this->input->post('id_rujukan_dokter');
		$data_pendaftaran = array(
			'nama_rujukan_dokter' => $this->input->post('nama_rujukan_dokter'),
			'alamat_rujukan_dokter' => $this->input->post('alamat_rujukan_dokter'),
			'email_rujukan_dokter' => $this->input->post('email_rujukan_dokter'),
			'kontak_rujukan_dokter' => $this->input->post('kontak_rujukan_dokter')
		);
		$this->db->where('id_rujukan_dokter',$id_rujukan_dokter);
		$this->db->update('kol_rujukan_dokter', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function ambil_data_dropdown_kab($id)
	{
		return $this->db->get_where('kol_kabupaten',array('id_prov' => $id))->result_array();
	}
	function srt_other_all()
	{
		$idx = explode(',', $this->session->mas_ins);
		$fields = "*,concat(alamat_other,' - Kota/Kab : ',nama_kab,' - Propinsi : ',nama_prov) as alamat_other
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
					// case 'telp' : $nmf="peg.telp";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where_in("ou.id_instansi",$idx);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('srt_other ou');
	    $this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
	    $this->db->join('kol_provinsi kp', 'kp.id_prov=ou.id_prov','left');
	    $this->db->join('kol_kabupaten kb', 'kb.id_kab=ou.id_kab','left');
	    $this->db->where_in("ou.id_instansi",$idx);
		
		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'id_ms_code'   : $nmf="kc.id_ms_code";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where_in("ou.id_instansi",$idx);
			}
		  }
		}

	    $this->db->from('srt_other ou');
	    $this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
	    $this->db->join('kol_provinsi kp', 'kp.id_prov=ou.id_prov','left');
	    $this->db->join('kol_kabupaten kb', 'kb.id_kab=ou.id_kab','left');
	    $this->db->where_in("ou.id_instansi",$idx);
		
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('srt_other');		//[coding here] ganti tabel utamanya
				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;	
	}
	function simpan_srt_other(){
		$kode = $this->m_rancak->kode_generator_urut(15,'EL');
		$data_pendaftaran = array(
			'id_other' => $kode,
			'id_instansi' => $this->session->refer,
			'nama_other' => $this->input->post('nama_other'),
			'email_other' => $this->input->post('email_other'),
			'kontak_other' => $this->input->post('kontak_other'),
			'alamat_other' => $this->input->post('alamat_other'),
			'id_prov' => $this->input->post('id_prov'),
			'id_kab' => $this->input->post('id_kab'),
			'status_other' => $this->input->post('status_other')
		);
		return $this->db->insert('srt_other', $data_pendaftaran);
	}
	function edit_srt_other(){
		$id_other = $this->input->post('id_other');
		$data_pendaftaran = array(
			'nama_other' => $this->input->post('nama_other'),
			'email_other' => $this->input->post('email_other'),
			'kontak_other' => $this->input->post('kontak_other'),
			'alamat_other' => $this->input->post('alamat_other'),
			'id_prov' => $this->input->post('id_prov'),
			'id_kab' => $this->input->post('id_kab'),
			'status_other' => $this->input->post('status_other')
		);
		$this->db->where('id_other',$id_other);
		$this->db->update('srt_other', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}
  	function ambil_list_unit_pegawai($kondisi,$grup=FALSE){
  		$this->db->join('ol_pegawai op', 'op.id_pegawai=opu.id_pegawai','left');
		$this->db->join('ol_unit opi', 'opi.id_unit=opu.id_unit','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=op.id_jabatan_fungsional','left');
	    if($grup){
	    	$this->db->group_by($grup);
	    }
  		$q = $this->db->get_where('ol_pegawai_unit opu',$kondisi); 
		return $q->result_array();
	}
  	function ambil_list_pegawai($idi,$idj){
  		$this->db->join('ol_pegawai op', 'op.id_pegawai=opi.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=op.id_jabatan_fungsional','left');
  		if(empty($idj)){
			$q = $this->db->get_where('ol_pegawai_instansi opi',array('opi.id_instansi'=>$idi));  
  		}else{
			$q = $this->db->get_where('ol_pegawai_instansi opi',array('opi.id_instansi'=>$idi,'jf.id_jabatan'=>$idj));  			
  		}
		return $q->result_array();
	}
	function ambil_berkas_from_list($idp,$idk,$idi,$idj){
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=ob.id_pegawai','left');
		$this->db->join('ol_pegawai_instansi opi', 'opi.id_pegawai=peg.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
		$this->db->join('ol_berkas_kategori obk', 'obk.id_berkas_kategori=ob.id_kategori_berkas','left');
		$this->db->where("status_berkas", 1);
		$this->db->where("ob.id_pegawai", $idp);
		$this->db->where("ob.id_kategori_berkas", $idk);
  		if(empty($idj)){
		$q = $this->db->get_where('ol_berkas ob',array('opi.id_instansi'=>$idi)); 
  		}else{
		$q = $this->db->get_where('ol_berkas ob',array('opi.id_instansi'=>$idi,'jf.id_jabatan'=>$idj));  			
  		}
		return $q->result_array();
	}
  	function ambil_berkas_pelatihan_person($idr,$ruangan,$idi,$idj,$grup=FALSE,$select=FALSE){
	    $array_check = array(4,5,6,8,9,10,11);
	    if($select){
	    	$this->db->select($select);
	    }
	    $this->db->join('ol_berkas_kategori obk', 'obk.id_berkas_kategori=ob.id_kategori_berkas','left');
		$this->db->join('ol_kategori_pelatihan okp', 'okp.id_kategori_pelatihan=ob.id_kategori_pelatihan','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=ob.id_pegawai','left');
		$this->db->join('ol_pegawai_instansi opi', 'opi.id_pegawai=peg.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
	//    $this->db->where_in('ob.id_kategori_berkas', $array_check);
	    $this->db->where("obk.kunci", 1);
	    $this->db->where("ob.id_kategori_pelatihan >", 0);
	    $this->db->where("ob.status_berkas", 1);
	    $this->db->where($idr, $ruangan);
	    if($grup){
	    	$this->db->group_by($grup);
	    }
  		if(empty($idj)){
		$q = $this->db->get_where('ol_berkas ob',array('opi.id_instansi'=>$idi)); 
  		}else{
		$q = $this->db->get_where('ol_berkas ob',array('opi.id_instansi'=>$idi,'jf.id_jabatan'=>$idj));  			
  		}
		return $q->result_array();
	}
  	function ambil_berkas_unit_pelatihan_person($kondisi,$grup=FALSE,$select=FALSE){
	    $array_check = array(4,5,6,8,9,10,11);
	    if($select){
	    	$this->db->select($select);
	    }
	    $this->db->join('ol_berkas_kategori obk', 'obk.id_berkas_kategori=ob.id_kategori_berkas','left');
		$this->db->join('ol_kategori_pelatihan okp', 'okp.id_kategori_pelatihan=ob.id_kategori_pelatihan','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=ob.id_pegawai','left');
		$this->db->join('ol_pegawai_unit opu', 'opu.id_pegawai=peg.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
	//    $this->db->where_in('ob.id_kategori_berkas', $array_check);
	    $this->db->where("obk.kunci", 1);
	//    $this->db->where("ob.id_kategori_pelatihan >", 0);
	    $this->db->where("ob.status_berkas", 1);
	//    $this->db->where($idr, $ruangan);
	    if($grup){
	    	$this->db->group_by($grup);
	    }
  		if(empty($idj)){
		$q = $this->db->get_where('ol_berkas ob',$kondisi); 
  		}else{
		$q = $this->db->get_where('ol_berkas ob',$kondisi);  			
  		}
		return $q->result_array();
	}
  	function ambil_berkas_pelatihan_biasa($idr,$ruangan,$idi,$idj,$grup=FALSE,$select=FALSE){
	    $array_check = array(4,5,6,8,9,10,11);
	    if($select){
	    	$this->db->select($select);
	    }
	    $this->db->join('ol_berkas_kategori obk', 'obk.id_berkas_kategori=ob.id_kategori_berkas','left');
		$this->db->join('ol_kategori_pelatihan okp', 'okp.id_kategori_pelatihan=ob.id_kategori_pelatihan','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=ob.id_pegawai','left');
		$this->db->join('ol_pegawai_instansi opi', 'opi.id_pegawai=peg.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
	//    $this->db->where_in('ob.id_kategori_berkas', $array_check);
	    $this->db->where("obk.kunci", 1);
	    $this->db->where("ob.status_berkas", 1);
	    $this->db->where("ob.id_kategori_pelatihan", 0);
	    $this->db->where($idr, $ruangan);
	    if($grup){
	    	$this->db->group_by($grup);
	    }
	    if(empty($idj) OR $idj == 0){
			$q = $this->db->get_where('ol_berkas ob',array('opi.id_instansi'=>$idi));
	    }else{
			$q = $this->db->get_where('ol_berkas ob',array('opi.id_instansi'=>$idi,'jf.id_jabatan'=>$idj));
	    }

		return $q->result_array();
	}
  	function ambil_jabatan_from_pegawai(){
  		$jabatan = explode(',', $this->session->mas_kred);
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
		$this->db->join('jabatan j', 'j.id_jabatan=jf.id_jabatan','left');
	    $this->db->where_in('jf.id_jabatan', $jabatan);
	    $this->db->group_by('jf.id_jabatan');
		$q = $this->db->get_where('ol_pegawai peg',array('peg.status_pegawai'=>1)); 
		return $q->result_array();
	}
	function grafik_all_pegawai($select,$kondisi)
	{
		$this->db->select($select);
		$this->db->join('ol_pegawai ope', 'ope.id_pegawai=opi.id_pegawai','left');
		$this->db->join('kol_pendidikan kpen', 'kpen.id_pendidikan=ope.id_pendidikan','left');
		$this->db->join('kol_agama kag', 'kag.id_agama=ope.id_agama','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=ope.id_status_kawin','left');
		$this->db->join('ol_status_pegawai osp', 'osp.id_status_pegawai=ope.tipe_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=ope.id_jabatan_fungsional','left');		
		$q = $this->db->get_where('ol_pegawai_instansi opi',$kondisi);
		return $q->row_array();
	}
	function grafik_all_unit_pegawai($select,$kondisi)
	{
		$this->db->select($select);
		$this->db->join('ol_pegawai ope', 'ope.id_pegawai=opu.id_pegawai','left');
		$this->db->join('kol_pendidikan kpen', 'kpen.id_pendidikan=ope.id_pendidikan','left');
		$this->db->join('kol_agama kag', 'kag.id_agama=ope.id_agama','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=ope.id_status_kawin','left');
		$this->db->join('ol_status_pegawai osp', 'osp.id_status_pegawai=ope.tipe_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=ope.id_jabatan_fungsional','left');		
		$q = $this->db->get_where('ol_pegawai_unit opu',$kondisi);
		return $q->row_array();
	}
	function unit_all_pegawai($select,$kondisi,$grup = FALSE)
	{
		$this->db->select($select);
		$this->db->join('ol_pegawai ope', 'ope.id_pegawai=opu.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=ope.id_jabatan_fungsional','left');
		$this->db->join('ol_unit opi', 'opi.id_unit=opu.id_unit','left');	
		if($grup)
		{ 
		$this->db->group_by($grup);	
		}
		$q = $this->db->get_where('ol_pegawai_unit opu',$kondisi);
		return $q->result_array();	
	}
	function grafik_all_pegawai_result($select,$kondisi,$grup = FALSE)
	{
		$this->db->select($select);
		$this->db->join('ol_pegawai ope', 'ope.id_pegawai=opi.id_pegawai','left');
		$this->db->join('kol_pendidikan kpen', 'kpen.id_pendidikan=ope.id_pendidikan','left');
		$this->db->join('kol_agama kag', 'kag.id_agama=ope.id_agama','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=ope.id_status_kawin','left');
		$this->db->join('ol_status_pegawai osp', 'osp.id_status_pegawai=ope.tipe_pegawai','left');
		$this->db->join('ol_pegawai_grade opg', 'opg.id_grade=ope.id_grade','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=ope.id_jabatan_fungsional','left');
		$this->db->join('kol_provinsi prov', 'prov.id_prov=ope.id_prov','left');
		$this->db->join('kol_kabupaten kab', 'kab.id_kab=ope.id_kab','left');
		$this->db->join('kol_kecamatan kec', 'kec.id_kec=ope.id_kec','left');
		$this->db->join('kol_kelurahan kel', 'kel.id_kel=ope.id_kel','left');		
		if($grup)
		{ 
		$this->db->group_by($grup);	
		}
		$q = $this->db->get_where('ol_pegawai_instansi opi',$kondisi);
		return $q->result_array();	
	}
	function grafik_all_unit_pegawai_result($select,$kondisi,$grup = FALSE)
	{
		$this->db->select($select);
		$this->db->join('ol_pegawai ope', 'ope.id_pegawai=opu.id_pegawai','left');
		$this->db->join('kol_pendidikan kpen', 'kpen.id_pendidikan=ope.id_pendidikan','left');
		$this->db->join('kol_agama kag', 'kag.id_agama=ope.id_agama','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=ope.id_status_kawin','left');
		$this->db->join('ol_status_pegawai osp', 'osp.id_status_pegawai=ope.tipe_pegawai','left');
		$this->db->join('ol_pegawai_grade opg', 'opg.id_grade=ope.id_grade','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=ope.id_jabatan_fungsional','left');
		$this->db->join('kol_provinsi prov', 'prov.id_prov=ope.id_prov','left');
		$this->db->join('kol_kabupaten kab', 'kab.id_kab=ope.id_kab','left');
		$this->db->join('kol_kecamatan kec', 'kec.id_kec=ope.id_kec','left');
		$this->db->join('kol_kelurahan kel', 'kel.id_kel=ope.id_kel','left');		
		if($grup)
		{ 
		$this->db->group_by($grup);	
		}
		$q = $this->db->get_where('ol_pegawai_unit opu',$kondisi);
		return $q->result_array();	
	}
	function ambil_berkas_ijin($kondisi){
		$this->db->select("COUNT(ob.id_pegawai) as total_str");
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=ob.id_pegawai','left');
		$this->db->join('ol_pegawai_instansi opi', 'opi.id_pegawai=peg.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
		$this->db->join('ol_berkas_kategori okb', 'okb.id_berkas_kategori=ob.id_kategori_berkas','left');
		$this->db->where($kondisi);		
		$q = $this->db->get_where('ol_berkas ob');
		return $q->result_array();
	}
	function ambil_berkas_ijin_unit($kondisi){
		$this->db->select("COUNT(ob.id_pegawai) as total_str");
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=ob.id_pegawai','left');
		$this->db->join('ol_pegawai_unit opu', 'opu.id_pegawai=peg.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
		$this->db->join('ol_berkas_kategori okb', 'okb.id_berkas_kategori=ob.id_kategori_berkas','left');
		$this->db->where($kondisi);		
		$q = $this->db->get_where('ol_berkas ob');
		return $q->result_array();
	}
	function ambil_berkas_ijin_print($kondisi){
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=ob.id_pegawai','left');
		$this->db->join('ol_pegawai_instansi opi', 'opi.id_pegawai=peg.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
		$this->db->join('ol_berkas_kategori okb', 'okb.id_berkas_kategori=ob.id_kategori_berkas','left');
		$this->db->where($kondisi);		
		$q = $this->db->get_where('ol_berkas ob');
		return $q->result_array();
	}
	function ambil_range_logbook_bulanane($first_date,$last_date,$id){
		$this->db->select("DATE_FORMAT(tgl_logbook,'%m') as bulan,DATE_FORMAT(tgl_logbook,'%Y') as tahun");
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=lp.id_logbooker','left');
		$this->db->where("peg.barcode_pegawai", $id);
		$this->db->where('DATE(tgl_logbook) BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$this->db->group_by(array("MONTH(tgl_logbook)", "YEAR(tgl_logbook)"));
		$this->db->order_by('tgl_logbook','ASC');
		$q = $this->db->get('ol_logbook lp')->result_array();
	//	echo $this->db->last_query();die();
		return $q;
	}
	function ambil_range_logbook_tahunan($id){
		$this->db->select("DATE_FORMAT(tgl_logbook,'%Y') as tahun");
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=lp.id_logbooker','left');
		$this->db->where("peg.barcode_pegawai", $id);
		$this->db->group_by("year(tgl_logbook)");
		$this->db->order_by('tgl_logbook','ASC');
		$q = $this->db->get_where('ol_logbook lp')->result_array();
	//	echo $this->db->last_query();die();
		return $q;
	}
	function ambil_range_logbook_kompetensi($bln,$thn,$id,$hasile=FALSE){
		$this->db->select("sum(jml_logbook) as jumlahk,kode_unit,nama_kompetensi,kd.id_kompetensi");
		$this->db->join('nkr_kewenangan kd', 'kd.id_kewenangan=lp.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nk', 'nk.id_kompetensi=kd.id_kompetensi','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=lp.id_logbooker','left');
		$this->db->where("peg.barcode_pegawai", $id);
		if($hasile){
			$this->db->where('YEAR(tgl_logbook)', $thn);
		}else{
			$this->db->where('YEAR(tgl_logbook)', $thn);
			$this->db->where('MONTH(tgl_logbook)', $bln);			
		}
		$this->db->group_by("kd.id_kompetensi");
		$this->db->order_by('kd.id_kompetensi','ASC');
		$q = $this->db->get_where('ol_logbook lp')->result_array();
	//	echo $this->db->last_query();die();
		return $q;
	}
	function ambil_range_logbook_bulanane_detil($bln,$thn,$idk,$id,$hasile=FALSE){
		$this->db->select("sum(jml_logbook) as jumlah,nama_kewenangan");
		$this->db->join('nkr_kewenangan kd', 'kd.id_kewenangan=lp.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nk', 'nk.id_kompetensi=kd.id_kompetensi','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=lp.id_logbooker','left');
		$this->db->where("kd.id_kompetensi", $idk);
		$this->db->where("peg.barcode_pegawai", $id);
		if($hasile){
			$this->db->where('YEAR(tgl_logbook)', $thn);
		}else{
			$this->db->where('YEAR(tgl_logbook)', $thn);
			$this->db->where('MONTH(tgl_logbook)', $bln);			
		}
		$this->db->group_by('lp.id_kewenangan');
		$q = $this->db->get_where('ol_logbook lp')->result_array();
		//echo $this->db->last_query();die();
		return $q;
	}
	function cmd_kol_provinsi()
	{
		$this->db->select("id_prov,nama_prov");
		$q= $this->db->get_where('kol_provinsi')->result_array();
		$hasil= array_column($q,'nama_prov','id_prov');
		return $hasil;
    }
	function cmd_tahun_logbook($id)
	{
		$this->db->select("distinct(DATE_FORMAT(tgl_logbook,'%Y')) as tgl_logbook");
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=lp.id_logbooker','left');
		$q= $this->db->get_where('ol_logbook lp',array('peg.barcode_pegawai'=>$id))->result_array();
		$hasil= array_column($q,'tgl_logbook','tgl_logbook');
		return $hasil;
    }
	function ambil_kategori_pelatihan($first_date,$last_date,$id){
		$this->db->select("
			count(lp.id_berkas) as jumlah,lp.id_kategori_pelatihan,sum(kredit) as jml_kredit,
			if(lp.id_kategori_pelatihan = 0,'Pelatihan Umum',nama_kategori_pelatihan) as nama_kategori_pelatihan
			");
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=lp.id_pegawai','left');
		$this->db->join('ol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=lp.id_kategori_pelatihan','left');
		$this->db->join('ol_berkas_kategori obk', 'obk.id_berkas_kategori=lp.id_kategori_berkas','left');
		$this->db->where("kunci", 1);
		$this->db->where('DATE(tgl_a_berkas) BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$this->db->where("peg.barcode_pegawai", $id);
		$this->db->group_by('lp.id_kategori_pelatihan');	
		$this->db->order_by('id_kategori_pelatihan','ASC');
		$q = $this->db->get_where('ol_berkas lp')->result_array();
	//	echo $this->db->last_query();die();
		return $q;
	}
	function ambil_berkas_kategori_pelatihan($first_date,$last_date,$id,$kat){
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=lp.id_pegawai','left');
		$this->db->join('ol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=lp.id_kategori_pelatihan','left');
		$this->db->join('ol_berkas_kategori obk', 'obk.id_berkas_kategori=lp.id_kategori_berkas','left');
		$this->db->where("kunci", 1);
		$this->db->where('DATE(tgl_a_berkas) BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$this->db->where("peg.barcode_pegawai", $id);
		$this->db->where("lp.id_kategori_pelatihan", $kat);
	//	$this->db->group_by("lp.id_kategori_pelatihan");
		$this->db->order_by('tgl_a_berkas','ASC');
		$q = $this->db->get_where('ol_berkas lp')->result_array();
	//	echo $this->db->last_query();die();
		return $q;
	}
	function ambil_etik($first_date,$last_date,$id){
		$this->db->select("*,peg2.nama_pegawai as penguji");
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=oep.id_pegawai','left');
		$this->db->join('ol_pegawai peg2', 'peg2.id_pegawai=oep.id_penguji','left');
		$this->db->where('DATE(tgl_etik_pegawai) BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$this->db->where("peg.barcode_pegawai", $id);
		$this->db->order_by('tgl_etik_pegawai','ASC');
		$q = $this->db->get_where('ol_etik_pegawai oep')->result_array();
	//	echo $this->db->last_query();die();
		return $q;
	}
	function ambil_grafik_logbook_person($id){
		$dateb = date("Y-m-d", strtotime("+3 years"));
		$this->db->select("sum(jml_logbook) as jml_logbookp,DATE_FORMAT(tgl_logbook,'%Y') as thnlg");
	//	$this->db->where("lp.id_logbooker", $id);
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=lp.id_logbooker','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
		$this->db->where("tgl_logbook > DATE_SUB(now(), INTERVAL 3 YEAR)");
		$this->db->group_by('YEAR(tgl_logbook)');	
		$this->db->order_by('YEAR(tgl_logbook)','ASC');
		$q = $this->db->get_where('ol_logbook lp',array('lp.id_logbooker'=>$id))->result_array();
	//	echo $this->db->last_query();die();
		return $q;
	}
	function ambil_grafik_etik_person($id){
		$dateb = date("Y-m-d", strtotime("-3 years"));
	//	$this->db->select("sum(jml_logbook) as jml_logbookp,DATE_FORMAT(tgl_logbook,'%Y') as thnlg");
	//	$this->db->where("lp.id_logbooker", $id);
		$this->db->join('ol_pegawai ope', 'ope.id_pegawai=lp.id_penguji','left');
		$this->db->where("tgl_etik_pegawai > DATE_SUB(now(), INTERVAL 2 YEAR)");
/*		$this->db->where('DATE(tgl_etik_pegawai) <=',$dateb);
		$this->db->where('DATE(tgl_etik_pegawai) >=',date('Y-m-d'));*/
	//	$this->db->group_by('YEAR(tgl_logbook)');	
		$this->db->order_by('DATE(tgl_etik_pegawai)','ASC');
		$q = $this->db->get_where('ol_etik_pegawai lp',array('lp.id_pegawai'=>$id))->result_array();
	//	echo $this->db->last_query();die();
		return $q;
	}
	function ambil_grafik_logbook($select,$kondisi)
	{
		$dateb = date("Y-m-d", strtotime("+3 years"));
		$this->db->select($select);
		$this->db->join('ol_pegawai ope', 'ope.id_pegawai=ol.id_logbooker','left');	
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=ope.id_jabatan_fungsional','left');	
		$this->db->join('ol_pegawai_unit opu', 'opu.id_pegawai=ope.id_pegawai','left');		
		$this->db->where("tgl_logbook > DATE_SUB(now(), INTERVAL 3 YEAR)");
		$this->db->group_by('YEAR(tgl_logbook)');	
		$this->db->order_by('YEAR(tgl_logbook)','ASC');
		$q = $this->db->get_where('ol_logbook ol',$kondisi);
		return $q->result_array();	
	}
  	function ambil_list_unit_kinerja(){
		$this->db->join('ol_unit opi', 'opi.id_unit=opu.id_unit','left');
		$this->db->where('opi.id_instansi',$this->session->refer);
	    $this->db->group_by('opu.id_unit');
  		$q = $this->db->get_where('ol_pegawai_unit opu'); 
		return $q->result_array();
	}
	function ambil_range_logbook_bulanan_unit($first_date,$last_date,$id){
		$this->db->select("DATE_FORMAT(tgl_logbook,'%m') as bulan,DATE_FORMAT(tgl_logbook,'%Y') as tahun");
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=lp.id_logbooker','left');
		$this->db->join('ol_pegawai_unit opu', 'opu.id_pegawai=peg.id_pegawai','left');
		$this->db->where("opu.id_unit", $id);
		$this->db->where('DATE(tgl_logbook) BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$this->db->group_by(array("MONTH(tgl_logbook)", "YEAR(tgl_logbook)"));
		$this->db->order_by('tgl_logbook','ASC');
		$q = $this->db->get('ol_logbook lp')->result_array();
	//	echo $this->db->last_query();die();
		return $q;
	}
	function ambil_range_logbook_kompetensi_unit($first_date,$last_date,$id){
		$this->db->select("sum(jml_logbook) as jumlahk,kode_unit,nama_kompetensi,kd.id_kompetensi");
		$this->db->join('nkr_kewenangan kd', 'kd.id_kewenangan=lp.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nk', 'nk.id_kompetensi=kd.id_kompetensi','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=lp.id_logbooker','left');
		$this->db->join('ol_pegawai_unit opu', 'opu.id_pegawai=peg.id_pegawai','left');
		$this->db->where('DATE(tgl_logbook) BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$this->db->where("opu.id_unit", $id);
	//	$this->db->where('YEAR(tgl_logbook)', $thn);
		$this->db->group_by("kd.id_kompetensi");
		$this->db->order_by('kd.id_kompetensi','ASC');
		$q = $this->db->get_where('ol_logbook lp')->result_array();
	//	echo $this->db->last_query();die();
		return $q;
	}
	function ambil_range_logbook_bulanane_detil_unit($first_date,$last_date,$idk,$id){
		$this->db->select("sum(jml_logbook) as jumlah,nama_kewenangan");
		$this->db->join('nkr_kewenangan kd', 'kd.id_kewenangan=lp.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nk', 'nk.id_kompetensi=kd.id_kompetensi','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=lp.id_logbooker','left');
		$this->db->join('ol_pegawai_unit opu', 'opu.id_pegawai=peg.id_pegawai','left');
		$this->db->where('DATE(tgl_logbook) BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$this->db->where("kd.id_kompetensi", $idk);
		$this->db->where("opu.id_unit", $id);
	//	$this->db->where('YEAR(tgl_logbook)', $thn);
		$this->db->group_by('lp.id_kewenangan');
		$q = $this->db->get_where('ol_logbook lp')->result_array();
		//echo $this->db->last_query();die();
		return $q;
	}
	function ambil_sn_standar_mutu(){
		$this->db->select("id_standar_mutu,concat(nama_standar_mutu,' - ',nama_unit) as nama_standar_mutu");
		$this->db->join('ol_unit ou', 'ou.id_unit=sn_standar_mutu.id_unit','left');
		$q = $this->db->get_where('sn_standar_mutu',array('id_instansi'=>$this->session->refer))->result_array();
		$hasil= array_column($q,'nama_standar_mutu','id_standar_mutu');
		return $hasil;
	}
	function laporan_all($first_date,$last_date,$id)
	{
	$idx = explode(',', $this->session->mas_ins);
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,DATE_FORMAT(tgl_laporan,'%d-%m-%Y') as tgl_laporan,
			DATE_FORMAT(tgl_awal,'%d-%m-%Y') as tgl_awal,DATE_FORMAT(tgl_akhir,'%d-%m-%Y') as tgl_akhir,if(share_it = 1,'Share','Unshare') as share_it
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
	    $this->db->where_in("ou.id_instansi", $idx);		
	    $this->db->where('tgl_laporan BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		if(!empty($id)){
			$this->db->where("olp.barcode_pegawai", $id);
		}

			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_logbook_laporan olp');	
	    $this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=olp.barcode_pegawai','left');
	    $this->db->join('ol_unit ou', 'ou.id_unit=olp.id_unit','left');	
	    $this->db->where_in("ou.id_instansi", $idx);		
	    $this->db->where('tgl_laporan BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		if(!empty($id)){
			$this->db->where("olp.barcode_pegawai", $id);
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
	    $this->db->where_in("ou.id_instansi", $idx);		
	    $this->db->where('tgl_laporan BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		if(!empty($id)){
			$this->db->where("olp.barcode_pegawai", $id);
		}

			}
		  }
		}

	    $this->db->from('ol_logbook_laporan olp');	
	    $this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=olp.barcode_pegawai','left');
	    $this->db->join('ol_unit ou', 'ou.id_unit=olp.id_unit','left');	
	    $this->db->where_in("ou.id_instansi", $idx);		
	    $this->db->where('tgl_laporan BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		if(!empty($id)){
			$this->db->where("olp.barcode_pegawai", $id);
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
 		$kondisi=array('id_unit'=>$this->session->unit);
		$jml = $this->m_umum->jumlah_record_filter('ol_logbook_laporan',$kondisi); 
//		$jml = $this->m_umum->jumlah_record_tabel('sn_laporan');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function laporan_tabel_all($id)
	{
	//	$id = $this->m_umum->ambil_data('sn_laporan','barcode_laporan',$idx);
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
				$this->db->where('ollt.id_laporan',$id);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_logbook_laporan_tabel ollt');	
	    $this->db->join('ol_logbook_laporan oll', 'oll.id_laporan=ollt.id_laporan','left');
	    $this->db->join('ol_unit ou', 'ou.id_unit=oll.id_unit','left');
	    $this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
	    $this->db->join('sn_tabel st', 'st.id_tabel=ollt.tabel','left');		
	    $this->db->where('ollt.id_laporan',$id);

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
				$this->db->where('ollt.id_laporan',$id);
			}
		  }
		}

	    $this->db->from('ol_logbook_laporan_tabel ollt');	
	    $this->db->join('ol_logbook_laporan oll', 'oll.id_laporan=ollt.id_laporan','left');
	    $this->db->join('ol_unit ou', 'ou.id_unit=oll.id_unit','left');
	    $this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
	    $this->db->join('sn_tabel st', 'st.id_tabel=ollt.tabel','left');		
	    $this->db->where('ollt.id_laporan',$id);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('ol_logbook_laporan_tabel');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function grafik_pie($id)
	{
		$lpd = $this->ambil_sn_laporan_detil($id);
		$this->db->select("
			if(total_lhu_detil = 0,
			100*(hasil_lhu_detil/count(*)),
			100*(hasil_lhu_detil/total_lhu_detil)) as total, 
			nama_limbah");
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
	function ambil_sn_laporan_tabel($id)
	{
		$this->db->join('sn_laporan sl', 'sl.id_laporan=sld.id_laporan','left');
		$this->db->order_by('urutan_laporan_tabel','asc');
		$q = $this->db->get_where('sn_laporan_tabel sld',array('sl.barcode_laporan'=>$id));
		return $q->result_array();
	}
	function ambil_sn_laporan_detil($id)
	{
		$this->db->join('sn_laporan sl', 'sl.id_laporan=sld.id_laporan','left');
		$q = $this->db->get_where('sn_laporan_tabel sld',array('sld.barcode_laporan_tabel'=>$id));
		return $q->row_array();
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
	function ol_berkas_in($id,$idp)
	{
		$ids = explode(",", $id);
  		$this->db->where_in('id_berkas', $ids);
  		$this->db->where('id_kategori_pelatihan', $idp);
  		$this->db->where('id_kategori_berkas', 12);
		$q = $this->db->get_where('ol_berkas');
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
		$this->db->where("u.id_instansi", $this->session->refer);
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
		$this->db->where("u.id_instansi", $this->session->refer);
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
		$this->db->where("u.id_instansi", $this->session->refer);
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
		$this->db->where("u.id_instansi", $this->session->refer);
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
}