<?php
class M_admin_even extends CI_model{
	function abs_even_all()
	{
	//	$idx = explode(',', $this->session->mas_ins);
		$fields = "*,concat(DATE_FORMAT(tgl_even,'%d-%m-%Y'),'  ',DATE_FORMAT(time_even,'%H:%i')) as tgl_even,
		tgl_even as tgl_sort,if(include_radius = '0','Tidak','Ya') as include_radius,
		if(status_even = '0','Proses',if(status_even = '1','Pendaftaran',if(status_even = '2','Mulai Acara','Selesai'))) as status_even,
		if(seen_even = '0','Unshare',if(seen_even = '1','Unit',if(seen_even = '2','Instansi',if(seen_even = '3','Komuintas','Profesi')))) as seen_even
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
				$this->db->where("ae.barcode_pegawai",$this->session->barcode_pegawai);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('abs_even ae');
	    $this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=ae.barcode_pegawai','left');
	    $this->db->where("ae.barcode_pegawai",$this->session->barcode_pegawai);
		
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
				$this->db->where("ae.barcode_pegawai",$this->session->barcode_pegawai);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('abs_even ae');
	    $this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=ae.barcode_pegawai','left');
	    $this->db->where("ae.barcode_pegawai",$this->session->barcode_pegawai);
		
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
 		$kondisi=array('barcode_pegawai'=>$this->session->barcode_pegawai);
		$jml = $this->m_umum->jumlah_record_filter('abs_even',$kondisi);	 
	//	$jml = $this->m_umum->jumlah_record_tabel('ol_unit');		//[coding here] ganti tabel utamanya
				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;	
	}
	function simpan_abs_even(){
		$kode = $this->m_rancak->kode_generator_urut(15,'AE');
		$tgl_even = $this->input->post('tgl_even');
		$tgl_even = date('Y-m-d', strtotime($tgl_even));
		$data_pendaftaran = array(
			'id_even' => $kode,
			'barcode_pegawai' => $this->session->barcode_pegawai,
			'tgl_even' => $tgl_even,
			'time_even' => $this->input->post('time_even'),
			'nama_even' => $this->input->post('nama_even'),
			'alamat_even' => $this->input->post('alamat_even'),
			'location_even' => $this->input->post('location'),
			'include_radius' => $this->input->post('include_radius'),
			'status_even' => $this->input->post('status_even')
		);
		return $this->db->insert('abs_even', $data_pendaftaran);
	}
	function edit_abs_even(){
		$id_even = $this->input->post('id_even');
		$tgl_even = $this->input->post('tgl_even');
		$tgl_even = date('Y-m-d', strtotime($tgl_even));
		$data_pendaftaran = array(
			'tgl_even' => $tgl_even,
			'time_even' => $this->input->post('time_even'),
			'nama_even' => $this->input->post('nama_even'),
			'alamat_even' => $this->input->post('alamat_even'),
			'location_even' => $this->input->post('location'),
			'include_radius' => $this->input->post('include_radius'),
			'status_even' => $this->input->post('status_even')
		);
		$this->db->where('id_even',$id_even);
		$this->db->update('abs_even', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}
	function abs_even_detil_all($id)
	{
	//	$idx = explode(',', $this->session->mas_ins);
		$fields = "*,concat(DATE_FORMAT(tgl_even_detil,'%d-%m-%Y'),'  ',DATE_FORMAT(time_even_detil,'%H:%i')) as tgl_even_detil,
		tgl_even_detil as tgl_sort,if(include_radius = '0','Tidak','Ya') as include_radius,
		concat(DATE_FORMAT(tgl_even,'%d-%m-%Y'),'  ',DATE_FORMAT(time_even,'%H:%i')) as tgl_even,
		if(status_even = '0','Proses',if(status_even = '1','Pendaftaran',if(status_even = '2','Mulai Acara','Selesai'))) as status_even,
		if(seen_even = '0','Unshare',if(seen_even = '1','Unit',if(seen_even = '2','Instansi',if(seen_even = '3','Komuintas','Profesi')))) as seen_even
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
	    $this->db->where("ae.barcode_pegawai",$this->session->barcode_pegawai);
	    $this->db->where("aed.id_even",$id);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('abs_even_detil aed');
	    $this->db->join('abs_even ae', 'ae.id_even=aed.id_even','left');
	    $this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=ae.barcode_pegawai','left');
	    $this->db->where("ae.barcode_pegawai",$this->session->barcode_pegawai);
	    $this->db->where("aed.id_even",$id);
		
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
	    $this->db->where("ae.barcode_pegawai",$this->session->barcode_pegawai);
	    $this->db->where("aed.id_even",$id);
			}
		  }
		}

	    $this->db->from('abs_even_detil aed');
	    $this->db->join('abs_even ae', 'ae.id_even=aed.id_even','left');
	    $this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=ae.barcode_pegawai','left');
	    $this->db->where("ae.barcode_pegawai",$this->session->barcode_pegawai);
	    $this->db->where("aed.id_even",$id);
		
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
 		$kondisi=array('id_even'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('abs_even_detil',$kondisi);	 
	//	$jml = $this->m_umum->jumlah_record_tabel('ol_unit');		//[coding here] ganti tabel utamanya
				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;	
	}
	function simpan_abs_even_detil(){
		$kode = $this->m_rancak->kode_generator_urut(15,'AE');
		$id_even = $this->session->even_acara;
		$tgl_even_detil = $this->input->post('tgl_even_detil');
		$tgl_even_detil = date('Y-m-d', strtotime($tgl_even_detil));
		$data_pendaftaran = array(
			'id_even' => $id_even,
			'id_even_detil' => $kode,
			'tgl_even_detil' => $tgl_even_detil,
			'time_even_detil' => $this->input->post('time_even_detil'),
			'nama_even_detil' => $this->input->post('nama_even_detil'),
			'speaker_even_detil' => $this->input->post('speaker_even_detil'),
			'hasil_even_detil' => $this->input->post('hasil_even_detil'),
			'kesimpulan_even_detil' => $this->input->post('kesimpulan_even_detil')
		);
		return $this->db->insert('abs_even_detil', $data_pendaftaran);
	}
	function edit_abs_even_detil(){
		$id_even_detil = $this->input->post('id_even_detil');
		$tgl_even_detil = $this->input->post('tgl_even_detil');
		$tgl_even_detil = date('Y-m-d', strtotime($tgl_even_detil));
		$data_pendaftaran = array(
			'tgl_even_detil' => $tgl_even_detil,
			'time_even_detil' => $this->input->post('time_even_detil'),
			'nama_even_detil' => $this->input->post('nama_even_detil'),
			'speaker_even_detil' => $this->input->post('speaker_even_detil')
		);
		$this->db->where('id_even_detil',$id_even_detil);
		$this->db->update('abs_even_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}
	function edit_abs_even_hasil_detil(){
		$id_even_detil = $this->input->post('id_even_detil');
		$data_pendaftaran = array(
			'hasil_even_detil' => $this->input->post('hasil_even_detil'),
			'kesimpulan_even_detil' => $this->input->post('kesimpulan_even_detil')
		);
		$this->db->where('id_even_detil',$id_even_detil);
		$this->db->update('abs_even_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}
	function abs_even_peserta_all($id)
	{
		$even = $this->m_umum->ambil_data('abs_even','id_even',$this->session->even_acara);
		$idx = explode(',', $even['peserta_even']);
		$fields = "*,CONCAT((TIMESTAMPDIFF( YEAR, tgl_lahir, now() )), ' Tahun ',TIMESTAMPDIFF( MONTH, tgl_lahir, now() ) % 12, ' Bulan ',
		FLOOR( TIMESTAMPDIFF( DAY, tgl_lahir, now() ) % 30.4375 ), ' Hari') as umur,
		DATE_FORMAT(peg.tgl_lahir,'%d-%m-%Y') as tgl_lahir,if (peg.jk = '1' ,'Laki-laki','Perempuan') as jk
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
		$this->db->where_in('peg.barcode_pegawai', $idx);
	    $this->db->where("peg.status_pegawai",1);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_user');
	    $this->db->join('ol_pegawai peg', 'peg.id_pegawai=ol_user.id_pegawai','left');
	    $this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
	    $this->db->join('ol_pegawai_unit opu', 'opu.id_pegawai=peg.id_pegawai','left');
	    $this->db->join('ol_unit ou', 'ou.id_unit=opu.id_unit','left');
	    $this->db->join('kol_working', 'kol_working.id_working=ol_user.refer','left');
		$this->db->join('kol_status_kawin kss', 'kss.id_status_kawin=peg.id_status_kawin','left');
		$this->db->join('kol_agama kag', 'kag.id_agama=peg.id_agama','left');
		$this->db->join('ol_status_pegawai ksp', 'ksp.id_status_pegawai=peg.tipe_pegawai','left');
		$this->db->join('kol_pendidikan kp', 'kp.id_pendidikan=peg.id_pendidikan','left');
		$this->db->where_in('peg.barcode_pegawai', $idx);
	    $this->db->where("peg.status_pegawai",1);
		
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
		$this->db->where_in('peg.barcode_pegawai', $idx);
	    $this->db->where("peg.status_pegawai",1);
			}
		  }
		}

	    $this->db->from('ol_user');
	    $this->db->join('ol_pegawai peg', 'peg.id_pegawai=ol_user.id_pegawai','left');
	    $this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
	    $this->db->join('ol_pegawai_unit opu', 'opu.id_pegawai=peg.id_pegawai','left');
	    $this->db->join('ol_unit ou', 'ou.id_unit=opu.id_unit','left');
	    $this->db->join('kol_working', 'kol_working.id_working=ol_user.refer','left');
		$this->db->join('kol_status_kawin kss', 'kss.id_status_kawin=peg.id_status_kawin','left');
		$this->db->join('kol_agama kag', 'kag.id_agama=peg.id_agama','left');
		$this->db->join('ol_status_pegawai ksp', 'ksp.id_status_pegawai=peg.tipe_pegawai','left');
		$this->db->join('kol_pendidikan kp', 'kp.id_pendidikan=peg.id_pendidikan','left');
		$this->db->where_in('peg.barcode_pegawai', $idx);
	    $this->db->where("peg.status_pegawai",1);
		
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('barcode_pegawai'=>$this->session->barcode_pegawai);
		$jml = $this->m_umum->jumlah_record_filter('abs_even',$kondisi);*/	 
		$jml = $this->m_umum->jumlah_record_tabel('ol_user');		//[coding here] ganti tabel utamanya
				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;	
	}
	function simpan_peserta(){
		$chk = $this->input->post('chk[]');
		if($chk){
			$eimplo = implode(",",$chk);
		}else{
			$eimplo = "";
		}
		$data_kewenangan_detil = array(
			'peserta_even' =>$eimplo
		);
		$this->db->where('id_even',$this->session->even_acara);
		$this->db->update('abs_even', $data_kewenangan_detil);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
}