<?php
class M_admin_asesor extends CI_model{
	function pengajuan_kompetensi_all($key)
	{
		$wordsAry = explode("-", $key);
		$wordsCount = count($wordsAry);
		$ids = explode(',', $this->session->mas_asesor);
		$idx = explode(',', $this->session->mas_ins);
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,if(tgl_pengajuan = '' ,'Belum Ada Tanggal',DATE_FORMAT(tgl_pengajuan,'%d-%m-%Y')) as tgl_pengajuan,
				concat('[',kode_unit,'] - ',nama_kompetensi) as nama_kompetensi
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
		$this->db->where('ok.status_pengajuan', 1);
		$this->db->where_in('ok.id_instansi', $idx);
		$this->db->where_in('jf.id_jabatan', $ids);
		if(!empty($key) || $this->input->post('key',true)){
			$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(op.nama_pegawai LIKE '%".$wordsAry[$i]."%' OR nkp.kode_unit LIKE '%".$wordsAry[$i]."%' OR nkp.nama_kompetensi LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}	
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_pengajuan ok');
		$this->db->join('ol_status_diusulkan okk', 'okk.id_status_diusulkan=ok.id_status_diusulkan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=ok.kode_unit_pengajuan','left');
		$this->db->join('ol_pegawai op', 'op.barcode_pegawai=ok.barcode_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=op.id_jabatan_fungsional','left');
		$this->db->where('ok.status_pengajuan', 1);
		$this->db->where_in('ok.id_instansi', $idx);
		$this->db->where_in('jf.id_jabatan', $ids);
		if(!empty($key) || $this->input->post('key',true)){
			$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(op.nama_pegawai LIKE '%".$wordsAry[$i]."%' OR nkp.kode_unit LIKE '%".$wordsAry[$i]."%' OR nkp.nama_kompetensi LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
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
		$this->db->where('ok.status_pengajuan', 1);
		$this->db->where_in('ok.id_instansi', $idx);
		$this->db->where_in('jf.id_jabatan', $ids);
		if(!empty($key) || $this->input->post('key',true)){
			$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(op.nama_pegawai LIKE '%".$wordsAry[$i]."%' OR nkp.kode_unit LIKE '%".$wordsAry[$i]."%' OR nkp.nama_kompetensi LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
			}
		  }
		}

		$this->db->from('ol_pengajuan ok');
		$this->db->join('ol_status_diusulkan okk', 'okk.id_status_diusulkan=ok.id_status_diusulkan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=ok.kode_unit_pengajuan','left');
		$this->db->join('ol_pegawai op', 'op.barcode_pegawai=ok.barcode_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=op.id_jabatan_fungsional','left');
		$this->db->where('ok.status_pengajuan', 1);
		$this->db->where_in('ok.id_instansi', $idx);
		$this->db->where_in('jf.id_jabatan', $ids);
		if(!empty($key) || $this->input->post('key',true)){
			$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(op.nama_pegawai LIKE '%".$wordsAry[$i]."%' OR nkp.kode_unit LIKE '%".$wordsAry[$i]."%' OR nkp.nama_kompetensi LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
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
	function ambil_data_daftar_no_null($id)
	{
		$this->db->select("concat(nama_pegawai,' - <b>[Profesi : ',nama_jabatan,']</b> - ',nama_unit) as nama_pegawai,ol_pegawai.id_pegawai,barcode_pegawai");
	//	$this->db->join('ol_pegawai','ol_pegawai.id_pegawai=ol_pegawai_instansi.id_pegawai','left');
		$this->db->join('ol_user','ol_user.id_pegawai=ol_pegawai.id_pegawai','left');
	//	$this->db->join('kol_kode_kewenangan','kol_kode_kewenangan.id_kode_kewenangan=ol_pegawai.id_kode_kewenangan','left');
		$this->db->join('ol_unit','ol_unit.id_unit=ol_user.unit','left');
		$this->db->join('kol_working','kol_working.id_working=ol_unit.id_instansi','left');
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
		$this->db->join('jabatan', 'jabatan.id_jabatan=jabatan_fungsional.id_jabatan','left');
  $this->db->where_in('jabatan_fungsional.id_jabatan', $ids);
		$this->db->order_by('nama_pegawai', 'asc');
	$q = $this->db->get_where('ol_pegawai',array('status_pegawai'=>1,'visible'=>1,'status_asesor >'=>0));
		return $q->result_array();
	}
 function ambil_data_asesor_no_null()
 {
  $this->db->select("concat(nama_pegawai,' - <b>[Profesi : ',nama_jabatan,']</b> - ',nama_unit) as nama_pegawai,ol_pegawai.id_pegawai,barcode_pegawai");
  $this->db->join('ol_pegawai','ol_pegawai.id_pegawai=ol_user.id_pegawai','left');
  $this->db->join('ol_unit','ol_unit.id_unit=ol_user.unit','left');
  $this->db->join('kol_working','kol_working.id_working=ol_unit.id_instansi','left');
  $this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
  $this->db->join('jabatan', 'jabatan.id_jabatan=jabatan_fungsional.id_jabatan','left');
//  $this->db->where_in('jabatan_fungsional.id_jabatan', $this->session->mas_asesor);
  $this->db->order_by('nama_pegawai', 'asc');
 $q = $this->db->get_where('ol_user',array('status_pegawai'=>1,'visible'=>1,'status_asesor >'=>0,'refer'=>$this->session->refer));
  return $q->result_array();
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
	}
	function nkr_pengajuan_validator_tabel($id)
	{
		$ids = explode(',', $id);
		$idx = explode(',', $this->session->mas_ins);
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
		$this->db->where_in('op.id_instansi', $idx);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('nkr_pengajuan_validator npvl');
		$this->db->join('ol_pengajuan op', 'op.barcode_pengajuan=npvl.barcode_pengajuan','left');
		$this->db->join('ol_pegawai ol', 'ol.id_pegawai=npvl.id_asesor','left');
		$this->db->where('npvl.barcode_pengajuan',$id);
		$this->db->where_in('op.id_instansi', $idx);

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
		$this->db->where_in('op.id_instansi', $idx);
			}
		  }
		}

		$this->db->from('nkr_pengajuan_validator npvl');
		$this->db->join('ol_pengajuan op', 'op.barcode_pengajuan=npvl.barcode_pengajuan','left');
		$this->db->join('ol_pegawai ol', 'ol.id_pegawai=npvl.id_asesor','left');
		$this->db->where('npvl.barcode_pengajuan',$id);
		$this->db->where_in('op.id_instansi', $idx);

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
	function ambil_data_nkr_form($id,$idi)
	{
		$this->db->select("concat(nama_form,' -  <b>',nama_jenis_form,' - [Kompetensi : ',nama_kompetensi,']</b> - Instansi : ',nama_working) as nama_form,nf.id_jenis_form");
		$this->db->join('kol_jenis_form kjf','kjf.id_jenis_form=nf.id_jenis_form','left');
		$this->db->join('nkr_kompetensi nkp','nkp.id_kompetensi=nf.id_kompetensi','left');
		$this->db->join('kol_working kw','kw.id_working=nf.id_instansi','left');
		$this->db->order_by('nf.id_jenis_form', 'asc');
		$q = $this->db->get_where('nkr_form nf',array('nf.id_kompetensi'=>$id,'nf.id_instansi'=>$idi));
		return $q->result_array();
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
	function seting_status_pengajuan($bp,$st){	
		$data_pendaftaran = array(
			'status_pengajuan' => $st
		);
		$this->db->where('barcode_pengajuan',$bp);
		$this->db->update('ol_pengajuan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function pengajuan_rkk_all()
	{
		$ids = explode(',', $this->session->mas_asesor);
		$idx = explode(',', $this->session->mas_ins);
		$fields = "*,DATE_FORMAT(tgl_pengajuan,'%d-%m-%Y') as tgl_pengajuan
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
		$this->db->where('ok.status_pengajuan >', 1);
	//	$this->db->where_in('ok.id_instansi', $idx);
		$this->db->where_in('jf.id_jabatan', $ids);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_pengajuan_signature oks');
		$this->db->join('ol_pengajuan ok', 'ok.barcode_pengajuan=oks.barcode_pengajuan','left');
  $this->db->join('ol_status_diusulkan okk', 'okk.id_status_diusulkan=ok.id_status_diusulkan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=ok.kode_unit_pengajuan','left');
		$this->db->join('ol_pegawai op', 'op.barcode_pegawai=ok.barcode_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=op.id_jabatan_fungsional','left');
		$this->db->where('ok.status_pengajuan >', 1);
	//	$this->db->where_in('ok.id_instansi', $idx);
		$this->db->where_in('jf.id_jabatan', $ids);

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
		$this->db->where('ok.status_pengajuan >', 1);
//		$this->db->where_in('ok.id_instansi', $idx);
		$this->db->where_in('jf.id_jabatan', $ids);
			}
		  }
		}

  $this->db->from('ol_pengajuan_signature oks');
  $this->db->join('ol_pengajuan ok', 'ok.barcode_pengajuan=oks.barcode_pengajuan','left');
  $this->db->join('ol_status_diusulkan okk', 'okk.id_status_diusulkan=ok.id_status_diusulkan','left');
  $this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=ok.kode_unit_pengajuan','left');
  $this->db->join('ol_pegawai op', 'op.barcode_pegawai=ok.barcode_pegawai','left');
  $this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=op.id_jabatan_fungsional','left');
		$this->db->where('ok.status_pengajuan >', 1);
//		$this->db->where_in('ok.id_instansi', $idx);
		$this->db->where_in('jf.id_jabatan', $ids);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
//		if($id == 0){
	 	//	$kondisi=array('id_jabatan'=>$this->session->id_jabatan);
		//	$jml = $this->jumlah_akses_pengurus($id,$eimplo);
/*		}else{*/
			$jml = $this->m_umum->jumlah_record_tabel('ol_pengajuan');	
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
 function simpan_signature(){
  $kewenangan = $this->input->post('kewenangan');
  $barcode_pengajuan = $this->input->post('barcode_pengajuan');
  $id_gambar = $this->input->post('id_gambar');
  if($id_gambar){
   $id_gambar = $this->input->post('id_gambar');
  }else{
   $id_gambar = 0;
  }
  $kiri_nama = $this->input->post('kiri_nama');
  if(empty($kiri_nama) || $kiri_nama = "0"){
   $kiri_nama = "";
  }else{
   $kiri_nama = $this->input->post('kiri_nama');
  }
  $tengah_nama = $this->input->post('tengah_nama');
  if(empty($tengah_nama) || $tengah_nama = "0"){
   $tengah_nama = "";
  }else{
   $tengah_nama = $this->input->post('tengah_nama');
  }
  $kanan_nama = $this->input->post('kanan_nama');
  if(empty($kanan_nama) || $kanan_nama = "0"){
   $kanan_nama = "";
  }else{
   $kanan_nama = $this->input->post('kanan_nama');
  }
  $tanggal = $this->input->post('tanggal');
  $tanggal = date('Y-m-d', strtotime($tanggal));
  $kode = $this->m_rancak->kode_generator_urut(15,'RK');
  $data_pendaftaran = array(
   'id_signature' => $kode,
   'barcode_pengajuan' => $barcode_pengajuan,
   'kewenangan' => $kewenangan,
   'id_gambar' => $id_gambar,
   'tanggal' => $this->input->post('tanggal'),
   'kop_signature' => $this->input->post('kop_signature'),
   'lampiran' => $this->input->post('lampiran'),
   'no' => $this->input->post('no'),
   'header' => $this->input->post('header'),
   'sub_header' => $this->input->post('sub_header'),
   'sub_sub_header' => $this->input->post('sub_sub_header'),
   'sebelum' => $this->input->post('sebelum'),
   'sesudah' => $this->input->post('sesudah'),
   'kanan_tgl' => $this->input->post('kanan_tgl'),
   'tengah_tgl' => $this->input->post('tengah_tgl'),
   'kiri_tgl' => $this->input->post('kiri_tgl'),
   'kiri_top' => $this->input->post('kiri_top'),
   'tengah_top' => $this->input->post('tengah_top'),
   'kanan_top' => $this->input->post('kanan_top'),
   'kiri_middle' => $this->input->post('kiri_middle'),
   'tengah_middle' => $this->input->post('tengah_middle'),
   'kanan_middle' => $this->input->post('kanan_middle'),
   'kiri_signature' => $this->input->post('kiri_signature'),
   'tengah_signature' => $this->input->post('tengah_signature'),
   'kanan_signature' => $this->input->post('kanan_signature'),
   'kiri_nama' => $kiri_nama,
   'tengah_nama' => $tengah_nama,
   'kanan_nama' => $kanan_nama,
   'kiri_nip' => $this->input->post('kiri_nip'),
   'tengah_nip' => $this->input->post('tengah_nip'),
   'kanan_nip' => $this->input->post('kanan_nip')
  );
  return $this->db->insert('ol_pengajuan_signature', $data_pendaftaran);
 }
 function edit_pegajuan_signature(){
  $id_signature = $this->input->post('id_signature');
  $chk = $this->input->post('chk[]');
  $eimplo = implode(",",$chk);  
  $data_pendaftaran = array(
   'tambahan' => $eimplo
  );
  $this->db->where('id_signature',$id_signature);
  $this->db->update('ol_pengajuan_signature', $data_pendaftaran);
  //echo $this->db->last_query();
  $this->db->trans_complete(); // untuk cek sukses update tidak
  if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
  // if (!$this->db->affected_rows()) 
   return(FALSE);
  else 
   return(TRUE);     
 }
 function edit_signature(){
  $id_signature = $this->input->post('id_signature');
  $id_gambar = $this->input->post('id_gambar');
  if($id_gambar){
   $id_gambar = $this->input->post('id_gambar');
  }else{
   $id_gambar = 0;
  }
  $kiri_nama = $this->input->post('kiri_nama');
  if(empty($kiri_nama) || $kiri_nama = "0"){
   $kiri_nama = "";
  }else{
   $kiri_nama = $this->input->post('kiri_nama');
  }
  $tengah_nama = $this->input->post('tengah_nama');
  if(empty($tengah_nama) || $tengah_nama = "0"){
   $tengah_nama = "";
  }else{
   $tengah_nama = $this->input->post('tengah_nama');
  }
  $kanan_nama = $this->input->post('kanan_nama');
  if(empty($kanan_nama) || $kanan_nama = "0"){
   $kanan_nama = "";
  }else{
   $kanan_nama = $this->input->post('kanan_nama');
  }
  $data_pendaftaran = array(
   'id_gambar' => $id_gambar,
   'tanggal' => $this->input->post('tanggal'),
   'kop_signature' => $this->input->post('kop_signature'),
   'lampiran' => $this->input->post('lampiran'),
   'no' => $this->input->post('no'),
   'header' => $this->input->post('header'),
   'sub_header' => $this->input->post('sub_header'),
   'sub_sub_header' => $this->input->post('sub_sub_header'),
   'sebelum' => $this->input->post('sebelum'),
   'sesudah' => $this->input->post('sesudah'),
   'kanan_tgl' => $this->input->post('kanan_tgl'),
   'tengah_tgl' => $this->input->post('tengah_tgl'),
   'kiri_tgl' => $this->input->post('kiri_tgl'),
   'kiri_top' => $this->input->post('kiri_top'),
   'tengah_top' => $this->input->post('tengah_top'),
   'kanan_top' => $this->input->post('kanan_top'),
   'kiri_middle' => $this->input->post('kiri_middle'),
   'tengah_middle' => $this->input->post('tengah_middle'),
   'kanan_middle' => $this->input->post('kanan_middle'),
   'kiri_signature' => $this->input->post('kiri_signature'),
   'tengah_signature' => $this->input->post('tengah_signature'),
   'kanan_signature' => $this->input->post('kanan_signature'),
   'kiri_nama' => $kiri_nama,
   'tengah_nama' => $tengah_nama,
   'kanan_nama' => $kanan_nama,
   'kiri_nip' => $this->input->post('kiri_nip'),
   'tengah_nip' => $this->input->post('tengah_nip'),
   'kanan_nip' => $this->input->post('kanan_nip')
  );
  $this->db->where('id_signature',$id_signature);
  $this->db->update('ol_pengajuan_signature', $data_pendaftaran);
  //echo $this->db->last_query();
  $this->db->trans_complete(); // untuk cek sukses update tidak
  if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
  // if (!$this->db->affected_rows())
   return(FALSE);
  else
   return(TRUE);
 }
//============================================================================
}