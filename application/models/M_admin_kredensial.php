<?php
class M_admin_kredensial extends CI_model{
	function cmd_kompetensi_in(){
		$jabatan = explode(',', $this->session->mas_kred);
	//	$instansi = explode(',', $this->session->mas_ins);
		$instansi = $this->session->refer;
		$this->db->select("id_kompetensi, CONCAT('[',kode_unit,'] ',nama_kompetensi,' -> [',nama_jabatan,']') as nama_kompetensi");
		$this->db->join('jabatan j', 'j.id_jabatan=nkr_kompetensi.id_jabatan','left');
	//	$this->db->join('kol_working kwe', 'kwe.id_working=nkr_kompetensi.instansi_kompetensi','left');
		$this->db->where_in('nkr_kompetensi.id_jabatan',$jabatan);
//  $this->db->where("nkr_kompetensi.instansi_kompetensi = 0 OR nkr_kompetensi.instansi_kompetensi = '$instansi'");
// $this->db->where_in('nkr_kompetensi.instansi_kompetensi',$instansi);
		$this->db->order_by('nkr_kompetensi.id_jabatan','asc');
		$q= $this->db->get_where('nkr_kompetensi',array('status_kompetensi'=>1))->result_array();
		$hasil= array_column($q,'nama_kompetensi','id_kompetensi');
		return $hasil;
	}
	function cr_question_lain(){
		$this->db->select("id_question,concat('Asesmen : ',nama_asesmen,' : ',nama_question) as nama_question");
		$this->db->join('nkr_asesmen', 'nkr_asesmen.id_asesmen=nkr_question_f2.id_asesmen','left');
		$q = $this->db->get_where('nkr_question_f2',array('id_jabatan'=>$this->session->id_jabatan))->result_array();
		$hasil= array_column($q,'nama_question','id_question');
		return $hasil;
	}
	function ambil_data_rujukan_working()
	{
		$instansi = explode(',', $this->session->mas_ins);
		$this->db->select("nama_working,id_working");
		$this->db->where_in('kol_working.id_working', $instansi);
        $query = $this->db->get_where('kol_working')->result_array();
		$q= array_column($query,'nama_working','id_working');
		return $q;
	}
	function cmd_jabatan(){
		$jabatan = explode(',', $this->session->mas_kred);
		$this->db->select("id_jabatan,nama_jabatan");
		$this->db->where_in('id_jabatan', $jabatan);
		$q = $this->db->get_where('jabatan')->result_array();
		$hasil= array_column($q,'nama_jabatan','id_jabatan');
		return $hasil;
	}
	function ambil_working_null()
	{
		$instansi = explode(',', $this->session->mas_ins);
		$this->db->select("nama_working,id_working");
		$this->db->where_in('kol_working.id_working', $instansi);
        $q = $this->db->get_where('kol_working')->result_array();
		return $q;
	}
	function jumlah_record_tabel_ol_user($id)
	{
		$this->db->select('COUNT(*) as num');
		$this->db->where("FIND_IN_SET(".$id.",mas_ins)!=",0);
		$query = $this->db->get_where('ol_user',array('status_user'=>1));
	    $result = $query->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
	}
	function elemen_all()
	{
		$jabatan = explode(',', $this->session->mas_kred);
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
//		$this->db->where_in('kp.instansi_elemen', $instansi);
		$this->db->where_in('kp.jabatan_elemen', $jabatan);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('nkr_elemen kp');
	    $this->db->join('jabatan j', 'j.id_jabatan=kp.jabatan_elemen','left');
	    $this->db->join('ol_pegawai op', 'op.barcode_pegawai=kp.pembuat_elemen','left');
		$this->db->join('kol_working kw', 'kw.id_working=kp.instansi_elemen','left');
//		$this->db->where_in('kp.instansi_elemen', $instansi);
		$this->db->where_in('kp.jabatan_elemen', $jabatan);

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
//		$this->db->where_in('kp.instansi_elemen', $instansi);
		$this->db->where_in('kp.jabatan_elemen', $jabatan);
			}
		  }
		}

	    $this->db->from('nkr_elemen kp');
	    $this->db->join('jabatan j', 'j.id_jabatan=kp.jabatan_elemen','left');
	    $this->db->join('ol_pegawai op', 'op.barcode_pegawai=kp.pembuat_elemen','left');
		$this->db->join('kol_working kw', 'kw.id_working=kp.instansi_elemen','left');
//		$this->db->where_in('kp.instansi_elemen', $instansi);
		$this->db->where_in('kp.jabatan_elemen', $jabatan);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('nkr_elemen');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_nkr_elemen(){
		$kode = $this->m_rancak->kode_generator_urut(15,'EL');
    $nama_elemen = $this->input->post('nama_elemen');
    $nama_elemen = trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $nama_elemen)));
		$data_pendaftaran = array(
			'instansi_elemen' => $this->input->post('instansi_elemen'),
			'id_elemen' => $kode,
			'pembuat_elemen' => $this->session->barcode_pegawai,
			'jabatan_elemen' => $this->input->post('jabatan_elemen'),
			'nama_elemen' => $nama_elemen
		);
		// print_r($data_pendaftaran);die();
		return $this->db->insert('nkr_elemen', $data_pendaftaran);		
		// $this->db->insert_id();			
	}
	function edit_nkr_elemen(){
		$id_elemen = $this->input->post('id_elemen');
    $nama_elemen = $this->input->post('nama_elemen');
    $nama_elemen = trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $nama_elemen)));
		$data_pendaftaran = array(
			'nama_elemen' => $nama_elemen,
			'instansi_elemen' => $this->input->post('instansi_elemen'),
			'jabatan_elemen' => $this->input->post('jabatan_elemen')
		);
		$this->db->where('id_elemen',$id_elemen);
		$this->db->update('nkr_elemen', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function cmd_elemen(){
		$instansi = explode(',', $this->session->mas_ins);
		$this->db->select("id_elemen, concat(nama_elemen,' - ',nama_working) as nama_elemen");
		$this->db->join('kol_working', 'kol_working.id_working=nkr_elemen.instansi_elemen','left');
		$this->db->where_in('instansi_elemen', $instansi);
		$this->db->order_by('id_elemen','desc');
		$q= $this->db->get_where('nkr_elemen')->result_array();
		$hasil= array_column($q,'nama_elemen','id_elemen');
		return $hasil;
	}
 function cmd_elemen_jabatan(){
  $instansi = explode(',', $this->session->mas_ins);
  $this->db->select("id_elemen, concat(nama_elemen,' - ',nama_working) as nama_elemen");
  $this->db->join('kol_working', 'kol_working.id_working=nkr_elemen.instansi_elemen','left');
  $this->db->where('jabatan_elemen', $this->session->id_jabatan);
  $this->db->order_by('id_elemen','desc');
  $q= $this->db->get_where('nkr_elemen')->result_array();
  $hasil= array_column($q,'nama_elemen','id_elemen');
  return $hasil;
 }
	function cmd_asesmen(){
		$instansi = explode(',', $this->session->mas_ins);
		$this->db->select("id_asesmen, concat(nama_asesmen,' <b>[',nama_elemen,']</b> ',nama_jabatan) as nama_asesmen");
		$this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
		$this->db->join('jabatan j', 'j.id_jabatan=nas.id_jabatan','left');
		$this->db->join('kol_working kw', 'kw.id_working=nas.instansi_asesmen','left');
//		$this->db->where_in('instansi_asesmen', $instansi);
  $this->db->where('jabatan_elemen', $this->session->id_jabatan);
		$this->db->order_by('nas.id_asesmen','desc');
		$q= $this->db->get_where('nkr_asesmen nas')->result_array();
		$hasil= array_column($q,'nama_asesmen','id_asesmen');
		return $hasil;
	}
	function cmd_asesmen_aktif(){
		$instansi = explode(',', $this->session->mas_ins);
		$jabatan = explode(',', $this->session->mas_kred);
		$this->db->select("id_asesmen, concat(nama_asesmen,' <b>[',nama_elemen,' - ',nama_working,']</b> ',nama_jabatan) as nama_asesmen");
		$this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
		$this->db->join('jabatan j', 'j.id_jabatan=nas.id_jabatan','left');
		$this->db->join('kol_working kw', 'kw.id_working=nas.instansi_asesmen','left');
		$this->db->where_in('instansi_asesmen', $instansi);
		$this->db->where_in('nas.id_jabatan', $jabatan);
		$this->db->order_by('nas.id_asesmen','desc');
		$q= $this->db->get_where('nkr_asesmen nas',array('status_asesmen'=>1))->result_array();
		$hasil= array_column($q,'nama_asesmen','id_asesmen');
		return $hasil;
	}
	function asesmen_all()
	{
		$jabatan = explode(',', $this->session->mas_kred);
		$instansi = explode(',', $this->session->mas_ins);
		$fields = "*,nkr_asesmen.id_elemen as ide";
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
					 case 'id_elemen' : $nmf="nkr_asesmen.id_elemen";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
//		$this->db->where_in('nkr_asesmen.instansi_asesmen', $instansi);
		$this->db->where_in('nkr_asesmen.id_jabatan', $jabatan);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

   	    $this->db->from('nkr_asesmen');
		$this->db->join('nkr_elemen', 'nkr_elemen.id_elemen=nkr_asesmen.id_elemen','left');
		$this->db->join('jabatan', 'jabatan.id_jabatan=nkr_asesmen.id_jabatan','left');
	    $this->db->join('ol_pegawai op', 'op.id_pegawai=nkr_asesmen.pembuat_asesmen','left');
		$this->db->join('kol_working kw', 'kw.id_working=nkr_asesmen.instansi_asesmen','left');
//		$this->db->where_in('nkr_asesmen.instansi_asesmen', $instansi);
		$this->db->where_in('nkr_asesmen.id_jabatan', $jabatan);


		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
					case 'id_elemen' : $nmf="nkr_asesmen.id_elemen";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
//		$this->db->where_in('nkr_asesmen.instansi_asesmen', $instansi);
		$this->db->where_in('nkr_asesmen.id_jabatan', $jabatan);
			}
		  }
		}

   	    $this->db->from('nkr_asesmen');
		$this->db->join('nkr_elemen', 'nkr_elemen.id_elemen=nkr_asesmen.id_elemen','left');
		$this->db->join('jabatan', 'jabatan.id_jabatan=nkr_asesmen.id_jabatan','left');
	    $this->db->join('ol_pegawai op', 'op.id_pegawai=nkr_asesmen.pembuat_asesmen','left');
		$this->db->join('kol_working kw', 'kw.id_working=nkr_asesmen.instansi_asesmen','left');
//		$this->db->where_in('nkr_asesmen.instansi_asesmen', $instansi);
		$this->db->where_in('nkr_asesmen.id_jabatan', $jabatan);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
	//	$kondisi=array('id_level !='=>'99');
	//	$jml = $this->m_umum->jumlah_record_filter('user',$kondisi);		//[coding here] ganti tabel utamanya
		$jml = $this->m_umum->jumlah_record_tabel('nkr_asesmen');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_nkr_asesmen(){
		$kode = $this->m_rancak->kode_generator_urut(15,'AS');
    $nama_asesmen = $this->input->post('nama_asesmen');
    $nama_asesmen = trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $nama_asesmen)));
		$data_pendaftaran = array(
			'id_elemen' => $this->input->post('id_elemen'),
			'id_jabatan' => $this->input->post('id_jabatan'),
			'pembuat_asesmen' => $this->session->id_pegawai,
			'id_asesmen' => $kode,
			'instansi_asesmen' => $this->input->post('instansi_asesmen'),
			'nama_asesmen' => $nama_asesmen
		);
		// print_r($data_pendaftaran);die();
		return $this->db->insert('nkr_asesmen', $data_pendaftaran);		
		// $this->db->insert_id();			
	}
	function edit_nkr_asesmen(){
		$id_asesmen = $this->input->post('id_asesmen');
    $nama_asesmen = $this->input->post('nama_asesmen');
    $nama_asesmen = trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $nama_asesmen)));
		$data_pendaftaran = array(
			'id_elemen' => $this->input->post('id_elemen'),
			'id_jabatan' => $this->input->post('id_jabatan'),
			'instansi_asesmen' => $this->input->post('instansi_asesmen'),
			'nama_asesmen' => $nama_asesmen
		);
		$this->db->where('id_asesmen',$id_asesmen);
		$this->db->update('nkr_asesmen', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function form_all($id)
	{
		$jabatan = explode(',', $this->session->mas_kred);
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
				//	 case 'no_hp' : $nmf="peg.no_hp";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('nf.id_jenis_form',$id);
		$this->db->where_in('nf.id_instansi', $instansi);
		$this->db->where_in('kp.id_jabatan', $jabatan);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

   	    $this->db->from('nkr_form nf');
		$this->db->join('nkr_kompetensi kp', 'kp.id_kompetensi=nf.id_kompetensi','left');
		$this->db->join('kol_jenis_form kjf', 'kjf.id_jenis_form=nf.id_jenis_form','left');
		$this->db->join('kol_working kw', 'kw.id_working=nf.id_instansi','left');
		$this->db->join('jabatan j', 'j.id_jabatan=kp.id_jabatan','left');
		$this->db->join('ol_pegawai op', 'op.id_pegawai=nf.pembuat_form','left');
		$this->db->where('nf.id_jenis_form',$id);
		$this->db->where_in('nf.id_instansi', $instansi);
		$this->db->where_in('kp.id_jabatan', $jabatan);

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
		$this->db->where('nf.id_jenis_form',$id);
		$this->db->where_in('nf.id_instansi', $instansi);
		$this->db->where_in('kp.id_jabatan', $jabatan);
			}
		  }
		}

   	    $this->db->from('nkr_form nf');
		$this->db->join('nkr_kompetensi kp', 'kp.id_kompetensi=nf.id_kompetensi','left');
		$this->db->join('kol_jenis_form kjf', 'kjf.id_jenis_form=nf.id_jenis_form','left');
		$this->db->join('kol_working kw', 'kw.id_working=nf.id_instansi','left');
		$this->db->join('jabatan j', 'j.id_jabatan=kp.id_jabatan','left');
		$this->db->join('ol_pegawai op', 'op.id_pegawai=nf.pembuat_form','left');
		$this->db->where('nf.id_jenis_form',$id);
		$this->db->where_in('nf.id_instansi', $instansi);
		$this->db->where_in('kp.id_jabatan', $jabatan);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$kondisi=array('id_jenis_form'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);		//[coding here] ganti tabel utamanya
	//	$jml = $this->m_umum->jumlah_record_tabel('nkr_form');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_nkr_form(){
		$kode = $this->m_rancak->kode_generator(15,'UF');
		$kodes = $this->m_rancak->kode_generator_urut(15,'FR');
		$data_pendaftaran = array(
			'id_jenis_form' => $this->input->post('id_jenis_form'),
			'id_kompetensi' => $this->input->post('id_kompetensi'),
			'pembuat_form' => $this->session->id_pegawai,
			'barcode_form' => $kode,
			'id_form' => $kodes,
			'id_instansi' => $this->input->post('id_instansi'),
			'nama_form' => $this->input->post('nama_form')
		);
		// print_r($data_pendaftaran);die();
		return $this->db->insert('nkr_form', $data_pendaftaran);		
		// $this->db->insert_id();			
	}
	function edit_nkr_form(){
		$id_form = $this->input->post('id_form');
		$data_pendaftaran = array(
			'id_kompetensi' => $this->input->post('id_kompetensi'),
			'id_instansi' => $this->input->post('id_instansi'),
			'status_form' => $this->input->post('status_form'),
			'nama_form' => $this->input->post('nama_form')
		);
		$this->db->where('id_form',$id_form);
		$this->db->update('nkr_form', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function form_indikator_detil($id)
	{
		$jabatan = explode(',', $this->session->mas_kred);
		$instansi = explode(',', $this->session->mas_ins);
		$fields = "*,
		if(jenis_soal = 1,'Pilihan',if(jenis_soal = 2,'Berganda','Isian')) as jenis_soal
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
		$this->db->where_in('nf.id_instansi', $instansi);
		$this->db->where_in('kp.id_jabatan', $jabatan);
		$this->db->where('nfd.barcode_form',$id);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

   	    $this->db->from('nkr_form_detil nfd');
		$this->db->join('nkr_form nf', 'nf.barcode_form=nfd.barcode_form','left');
		$this->db->join('nkr_kompetensi kp', 'kp.id_kompetensi=nf.id_kompetensi','left');
		$this->db->join('nkr_kaji_ulang nku', 'nku.id_kaji_ulang=nfd.id_kaji_ulang','left');
		$this->db->join('nkr_indikator nin', 'nin.id_indikator=nfd.id_indikator','left');
		$this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nin.id_asesmen','left');
		$this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
		$this->db->join('nkr_pra_detil npd', 'npd.id_pra_detil=nfd.id_pra_detil','left');
		$this->db->join('nkr_pra_asesmen npa', 'npa.barcode_pra_asesmen=npd.barcode_pra_asesmen','left');
		$this->db->where_in('nf.id_instansi', $instansi);
		$this->db->where_in('kp.id_jabatan', $jabatan);
		$this->db->where('nfd.barcode_form',$id);

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
		$this->db->where_in('nf.id_instansi', $instansi);
		$this->db->where_in('kp.id_jabatan', $jabatan);
		$this->db->where('nfd.barcode_form',$id);
			}
		  }
		}

   	    $this->db->from('nkr_form_detil nfd');
		$this->db->join('nkr_form nf', 'nf.barcode_form=nfd.barcode_form','left');
		$this->db->join('nkr_kompetensi kp', 'kp.id_kompetensi=nf.id_kompetensi','left');
		$this->db->join('nkr_kaji_ulang nku', 'nku.id_kaji_ulang=nfd.id_kaji_ulang','left');
		$this->db->join('nkr_indikator nin', 'nin.id_indikator=nfd.id_indikator','left');
		$this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nin.id_asesmen','left');
		$this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
		$this->db->join('nkr_pra_detil npd', 'npd.id_pra_detil=nfd.id_pra_detil','left');
		$this->db->join('nkr_pra_asesmen npa', 'npa.barcode_pra_asesmen=npd.barcode_pra_asesmen','left');
		$this->db->where_in('nf.id_instansi', $instansi);
		$this->db->where_in('kp.id_jabatan', $jabatan);
		$this->db->where('nfd.barcode_form',$id);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$kondisi=array('barcode_form'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('nkr_form_detil',$kondisi);		//[coding here] ganti tabel utamanya
	//	$jml = $this->m_umum->jumlah_record_tabel('nkr_form_detil');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function qf_2_all()
	{
		$jabatan = explode(',', $this->session->mas_kred);
		$instansi = explode(',', $this->session->mas_ins);
		$fields = "*,kw.nama_working,nf2.id_question";
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
//  $this->db->where_in('nas.instansi_asesmen', $instansi);
//  $this->db->where_in('nas.id_jabatan', $jabatan);
  $this->db->where('pembuat_question', $this->session->id_pegawai);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

   	    $this->db->from('nkr_question_f2 nf2');
		$this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nf2.id_asesmen','left');
		$this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
		$this->db->join('jabatan j', 'j.id_jabatan=nas.id_jabatan','left');
	    $this->db->join('ol_pegawai op', 'op.id_pegawai=nf2.pembuat_question','left');
		$this->db->join('kol_working kw', 'kw.barcode_working=nf2.instansi_question','left');
//		$this->db->where_in('nas.instansi_asesmen', $instansi);
//		$this->db->where_in('nas.id_jabatan', $jabatan);
  $this->db->where('pembuat_question', $this->session->id_pegawai);

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
//  $this->db->where_in('nas.instansi_asesmen', $instansi);
//  $this->db->where_in('nas.id_jabatan', $jabatan);
  $this->db->where('pembuat_question', $this->session->id_pegawai);
			}
		  }
		}

   	    $this->db->from('nkr_question_f2 nf2');
		$this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nf2.id_asesmen','left');
		$this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
		$this->db->join('jabatan j', 'j.id_jabatan=nas.id_jabatan','left');
	    $this->db->join('ol_pegawai op', 'op.id_pegawai=nf2.pembuat_question','left');
		$this->db->join('kol_working kw', 'kw.barcode_working=nf2.instansi_question','left');
//  $this->db->where_in('nas.instansi_asesmen', $instansi);
//  $this->db->where_in('nas.id_jabatan', $jabatan);
  $this->db->where('pembuat_question', $this->session->id_pegawai);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
	//	$kondisi=array('id_level !='=>'99');
	//	$jml = $this->m_umum->jumlah_record_filter('user',$kondisi);		//[coding here] ganti tabel utamanya
		$jml = $this->m_umum->jumlah_record_tabel('nkr_question_f2');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_nkr_question(){
		$kode = $this->m_rancak->kode_generator_urut(15,'QS');
    $nama_question = $this->input->post('nama_question');
    $nama_question = trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $nama_question)));
		$data_pendaftaran = array(
			'id_asesmen' => $this->input->post('id_asesmen'),
			'pembuat_question' => $this->session->id_pegawai,
   'instansi_question' => $this->session->barcode_working,
			'id_question' => $kode,
			'nama_question' => $nama_question
		);
		// print_r($data_pendaftaran);die();
		return $this->db->insert('nkr_question_f2', $data_pendaftaran);		
		// $this->db->insert_id();			
	}
	function simpan_nkr_question_lainnya(){
		$kode = $this->m_rancak->kode_generator_urut(15,'QS');
		$id_question = $this->input->post('id_question');
    $ambil_asesmen = $this->m_umum->ambil_data('nkr_question_f2','id_question',$id_question);
		$data_pendaftaran = array(
			'id_asesmen' => $ambil_asesmen['id_asesmen'],
			'pembuat_question' => $this->session->id_pegawai,
   		'instansi_question' => $this->session->barcode_working,
			'id_question' => $kode,
			'nama_question' => $ambil_asesmen['nama_question']
		);
		// print_r($data_pendaftaran);die();
		return $this->db->insert('nkr_question_f2', $data_pendaftaran);		
		// $this->db->insert_id();			
	}
	function edit_nkr_question(){
		$id_question = $this->input->post('id_question');
    $nama_question = $this->input->post('nama_question');
    $nama_question = trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $nama_question)));
		$data_pendaftaran = array(
			'id_asesmen' => $this->input->post('id_asesmen'),
   'instansi_question' => $this->session->barcode_working,
			'nama_question' => $nama_question
		);
		$this->db->where('id_question',$id_question);
		$this->db->update('nkr_question_f2', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function ambil_nkr_form($id){
	  $this->db->join('nkr_kompetensi kp', 'kp.id_kompetensi=nf2.id_kompetensi','left');
	  $this->db->join('jabatan j', 'j.id_jabatan=kp.id_jabatan','left');
	  $this->db->join('kol_working kw', 'kw.id_working=nf2.id_instansi','left');
	  $q = $this->db->get_where('nkr_form nf2',array('nf2.barcode_form'=>$id));
	  return $q->row_array();
	}
	function ambil_nkr_asesmen_tuk_form($id,$idj){
	  $this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nf2.id_asesmen','left');
	  $this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
	  $this->db->join('jabatan j', 'j.id_jabatan=nas.id_jabatan','left');
   $this->db->join('ol_pegawai op', 'op.id_pegawai=nf2.pembuat_question','left');
	//  $this->db->where('nas.id_jabatan', $idj);
   $this->db->where('pembuat_question', $this->session->id_pegawai);
	  $this->db->order_by('nas.id_jabatan','asc');
	  $q = $this->db->get_where('nkr_question_f2 nf2',array('nas.id_elemen'=>$id));
	  return $q->result_array();
	}
	function form_question_detil($id)
	{
		$jabatan = explode(',', $this->session->mas_kred);
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
				//	 case 'no_hp' : $nmf="peg.no_hp";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
/*		$this->db->where_in('nas.instansi_asesmen', $instansi);
		$this->db->where_in('nas.id_jabatan', $jabatan);*/
		$this->db->where('nfd.barcode_form',$id);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

   	    $this->db->from('nkr_form_detil nfd');
		$this->db->join('nkr_form nf', 'nf.barcode_form=nfd.barcode_form','left');
		$this->db->join('nkr_question_f2 nq2', 'nq2.id_question=nfd.id_question','left');
		$this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nq2.id_asesmen','left');
		$this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
/*		$this->db->where_in('nas.instansi_asesmen', $instansi);
		$this->db->where_in('nas.id_jabatan', $jabatan);*/
		$this->db->where('nfd.barcode_form',$id);

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
/*		$this->db->where_in('nas.instansi_asesmen', $instansi);
		$this->db->where_in('nas.id_jabatan', $jabatan);*/
		$this->db->where('nfd.barcode_form',$id);
			}
		  }
		}

   	    $this->db->from('nkr_form_detil nfd');
		$this->db->join('nkr_form nf', 'nf.barcode_form=nfd.barcode_form','left');
		$this->db->join('nkr_question_f2 nq2', 'nq2.id_question=nfd.id_question','left');
		$this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nq2.id_asesmen','left');
		$this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
/*		$this->db->where_in('nas.instansi_asesmen', $instansi);
		$this->db->where_in('nas.id_jabatan', $jabatan);*/
		$this->db->where('nfd.barcode_form',$id);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$kondisi=array('barcode_form'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('nkr_form_detil',$kondisi);		//[coding here] ganti tabel utamanya
	//	$jml = $this->m_umum->jumlah_record_tabel('nkr_form_detil');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_nkr_question_form_detil(){
		$barcode_form = $this->input->post('barcode_form');
		$chk = $this->input->post('chk[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				$this->db->select("COUNT(*) as num");
				$this->db->where('barcode_form',$barcode_form);
				$this->db->where('id_question',$chk[$i]);
				$q = $this->db->get('nkr_form_detil')->row();
				$jml = $q->num;
				if($jml == 0){
					$kode = $this->m_rancak->kode_generator_urut(15,'QF');
					$urut_form_detil = $this->urut_form_detil($barcode_form);
					$urut_form_detil++;
					$data_pendaftaran = array(
						'no_urut_detil' => $urut_form_detil,
						'id_question' => $chk[$i],
						'barcode_form_detil' => $kode,
						'barcode_form' => $barcode_form
					);
					$this->db->insert('nkr_form_detil', $data_pendaftaran);
				}
			}
		}
	}
	function edit_urutan_detil(){
		$id_form_detil = $this->input->post('id_form_detil');
		$data_pendaftaran = array(
			'no_urut_detil' => $this->input->post('no_urut_detil')
		);
		$this->db->where('id_form_detil',$id_form_detil);
		$this->db->update('nkr_form_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function metode_all()
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

	    $this->db->from('nkr_metode');

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

	    $this->db->from('nkr_metode');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('nkr_metode');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_nkr_metode(){
		$data_pendaftaran = array(
			'pembuat_metode' => $this->session->id_pegawai,
			'nama_metode' => $this->input->post('nama_metode')
		);
		// print_r($data_pendaftaran);die();
		return $this->db->insert('nkr_metode', $data_pendaftaran);		
		// $this->db->insert_id();			
	}
	function jumlah_record_tabel_metode($id)
	{
		$this->db->select('COUNT(*) as num');
		$this->db->where("FIND_IN_SET(".$id.",metode_indikator)!=",0);
		$query = $this->db->get_where('nkr_validasi_detil');
	    $result = $query->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
	}
	function edit_nkr_metode(){
		$id_metode = $this->input->post('id_metode');
		$data_pendaftaran = array(
			'nama_metode' => $this->input->post('nama_metode')
		);
		$this->db->where('id_metode',$id_metode);
		$this->db->update('nkr_metode', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function perangkat_all()
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

	    $this->db->from('nkr_perangkat');

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

	    $this->db->from('nkr_perangkat');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('nkr_perangkat');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_nkr_perangkat(){
		$data_pendaftaran = array(
			'pembuat_perangkat' => $this->session->id_pegawai,
			'nama_perangkat' => $this->input->post('nama_perangkat')
		);
		// print_r($data_pendaftaran);die();
		return $this->db->insert('nkr_perangkat', $data_pendaftaran);		
		// $this->db->insert_id();			
	}
	function jumlah_record_tabel_perangkat($id)
	{
		$this->db->select('COUNT(*) as num');
		$this->db->where("FIND_IN_SET(".$id.",perangkat_indikator)!=",0);
		$query = $this->db->get_where('nkr_validasi_detil');
	    $result = $query->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
	}
	function edit_nkr_perangkat(){
		$id_perangkat = $this->input->post('id_perangkat');
		$data_pendaftaran = array(
			'nama_perangkat' => $this->input->post('nama_perangkat')
		);
		$this->db->where('id_perangkat',$id_perangkat);
		$this->db->update('nkr_perangkat', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function alat_all()
	{
	$jabatan = explode(',', $this->session->mas_kred);
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
        $this->db->where_in('nkr_alat.id_jabatan', $jabatan);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('nkr_alat');
      $this->db->where_in('nkr_alat.id_jabatan', $jabatan);

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
        $this->db->where_in('nkr_alat.id_jabatan', $jabatan);
			}
		  }
		}

	    $this->db->from('nkr_alat');
      $this->db->where_in('nkr_alat.id_jabatan', $jabatan);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('nkr_alat');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_nkr_alat(){
		$data_pendaftaran = array(
			'pembuat_alat' => $this->session->id_pegawai,
      'id_jabatan' => $this->session->id_jabatan,
			'nama_alat' => $this->input->post('nama_alat')
		);
		// print_r($data_pendaftaran);die();
		return $this->db->insert('nkr_alat', $data_pendaftaran);		
		// $this->db->insert_id();			
	}
	function cmd_grade($id)
	{
	  	$instansi = explode(',', $id);
		$this->db->select("id_grade,concat(nama_grade,' - ',nama_jabatan) as nama_grade");
		$this->db->join('jabatan', 'jabatan.id_jabatan=ol_pegawai_grade.id_jabatan','left');
		$this->db->where('ol_pegawai_grade.id_jabatan', $id);
		$q= $this->db->get_where('ol_pegawai_grade')->result_array();
		$hasil= array_column($q,'nama_grade','id_grade');
		return $hasil;
	}
	function jumlah_record_tabel_alat($id)
	{
		$this->db->select('COUNT(*) as num');
		$this->db->where("FIND_IN_SET(".$id.",alat)!=",0);
		$query = $this->db->get_where('nkr_alat_bahan');
	    $result = $query->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
	}
	function edit_nkr_alat(){
		$id_alat = $this->input->post('id_alat');
		$data_pendaftaran = array(
			'nama_alat' => $this->input->post('nama_alat')
		);
		$this->db->where('id_alat',$id_alat);
		$this->db->update('nkr_alat', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function ambil_kompetensi_dari_nkr_alat($grup,$order,$sort,$kondisi){
	  $instansi = explode(',', $this->session->mas_ins);
	  $jabatan = explode(',', $this->session->mas_kred);
	  $this->db->join('nkr_kompetensi nk', 'nk.id_kompetensi=nab.id_kompetensi','left');
	  $this->db->join('nkr_elemen ne', 'ne.id_elemen=nab.id_elemen','left');
	  $this->db->join('jabatan j', 'j.id_jabatan=ne.jabatan_elemen','left');
	  $this->db->where_in('nab.id_instansi', $instansi);
	  $this->db->where_in('ne.jabatan_elemen', $jabatan);
	  $this->db->group_by($grup);
	  $this->db->order_by($order,$sort);
	  $q = $this->db->get_where('nkr_alat_bahan nab',$kondisi);
	  return $q->result_array();
	}
	function alat_bahan_all()
	{
		$jabatan = explode(',', $this->session->mas_kred);
		$instansi = explode(',', $this->session->mas_ins);
		$fields = "*,concat(nama_kompetensi,' - <b>[',nama_jabatan,']</b>') as nama_kompetensi";
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
	  $this->db->where_in('nab.id_instansi', $instansi);
		$this->db->where_in('kp.id_jabatan', $jabatan);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('nkr_alat_bahan nab');
	    $this->db->join('nkr_elemen nel', 'nel.id_elemen=nab.id_elemen','left');
	    $this->db->join('nkr_kompetensi kp', 'kp.id_kompetensi=nab.id_kompetensi','left');
	    $this->db->join('kol_working kw', 'kw.id_working=nab.id_instansi','left');
	    $this->db->join('jabatan j', 'j.id_jabatan=kp.id_jabatan','left');
	  $this->db->where_in('nab.id_instansi', $instansi);
		$this->db->where_in('kp.id_jabatan', $jabatan);

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
	  $this->db->where_in('nab.id_instansi', $instansi);
		$this->db->where_in('kp.id_jabatan', $jabatan);
			}
		  }
		}

	    $this->db->from('nkr_alat_bahan nab');
	    $this->db->join('nkr_elemen nel', 'nel.id_elemen=nab.id_elemen','left');
	    $this->db->join('nkr_kompetensi kp', 'kp.id_kompetensi=nab.id_kompetensi','left');
	    $this->db->join('kol_working kw', 'kw.id_working=nab.id_instansi','left');
	    $this->db->join('jabatan j', 'j.id_jabatan=kp.id_jabatan','left');
	  $this->db->where_in('nab.id_instansi', $instansi);
		$this->db->where_in('kp.id_jabatan', $jabatan);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('nkr_alat_bahan');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_alat_bahan(){
		$chk = $this->input->post('chk[]');
		$eimplo = implode(",",$chk);
		$kode = $this->m_rancak->kode_generator_urut(15,'AB');
		if($chk){
			$data_pendaftaran = array(
				'alat' => $eimplo,
				'id_instansi' =>  $this->input->post('id_instansi'),
				'id_elemen' =>  $this->input->post('id_elemen'),
				'id_kompetensi' =>  $this->input->post('id_kompetensi'),
				'id_alat_bahan' =>  $kode,
				'pembuat_alat_bahan' =>  $this->session->id_pegawai
			);
			$this->db->insert('nkr_alat_bahan', $data_pendaftaran);
		}
	}
	function edit_alat_bahan(){
		$chk = $this->input->post('chk[]');
		$id_alat_bahan = $this->input->post('id_alat_bahan');	
		$eimplo = implode(",",$chk);
		if($chk){
			$data_pendaftaran = array(
				'alat' => $eimplo
			);
			$this->db->where('id_alat_bahan',$id_alat_bahan);
			$this->db->update('nkr_alat_bahan', $data_pendaftaran);
			//echo $this->db->last_query();
			$this->db->trans_complete();	// untuk cek sukses update tidak
			if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
			// if (!$this->db->affected_rows()) 
				return(FALSE);
			else 
				return(TRUE);
		}
	}
	function edit_status_indikator($id,$isi){
		$data_pendaftaran = array(
			'status_indikator' => $isi
		);
		$this->db->where('id_indikator',$id);
		$this->db->update('nkr_indikator', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);
	}
	function indikator_all()
	{
		$jabatan = explode(',', $this->session->mas_kred);
		$instansi = explode(',', $this->session->mas_ins);
		$fields = "*,concat(nama_asesmen,' : <br><b>[',nama_elemen,']</b> - [',nama_jabatan,']') as nama_asesmen,
				if(jenis_soal = 1,'Pilihan',if(jenis_soal = 2,'Berganda','Isian')) as jenis_soal,
		if(metode_indikator IS NULL OR metode_indikator = '','Tidak Ada Metode','Ada Metode') as metode_indikator,
		if(perangkat_indikator IS NULL OR perangkat_indikator = '','Tidak Ada Perangkat','Ada Perangkat') as perangkat_indikator
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
/*        if($kosong){ 
			$this->db->where('nin.'.$kosong.' !="" ', NULL, FALSE);
        }*/
		$this->db->where('nid.pembuat_indikator', $this->session->id_pegawai);
		$this->db->where('nas.id_jabatan', $this->session->id_jabatan);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

   	    $this->db->from('nkr_indikator nid');
		$this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nid.id_asesmen','left');
		$this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
		$this->db->join('jabatan j', 'j.id_jabatan=nas.id_jabatan','left');
		$this->db->join('ol_pegawai op', 'op.id_pegawai=nid.pembuat_indikator','left');
/*        if($kosong){ 
			$this->db->where('nin.'.$kosong.' !="" ', NULL, FALSE);
        }
		$this->db->where_in('nas.instansi_asesmen', $instansi);
		$this->db->where_in('nas.id_jabatan', $jabatan);*/
		$this->db->where('nid.pembuat_indikator', $this->session->id_pegawai);
		$this->db->where('nas.id_jabatan', $this->session->id_jabatan);
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
/*        if($kosong){ 
			$this->db->where('nin.'.$kosong.' !="" ', NULL, FALSE);
        }*/
		$this->db->where('nid.pembuat_indikator', $this->session->id_pegawai);
		$this->db->where('nas.id_jabatan', $this->session->id_jabatan);
			}
		  }
		}

   	    $this->db->from('nkr_indikator nid');
		$this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nid.id_asesmen','left');
		$this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
		$this->db->join('jabatan j', 'j.id_jabatan=nas.id_jabatan','left');
		$this->db->join('ol_pegawai op', 'op.id_pegawai=nid.pembuat_indikator','left');
/*        if($kosong){ 
			$this->db->where('nin.'.$kosong.' !="" ', NULL, FALSE);
        }*/
		$this->db->where('nid.pembuat_indikator', $this->session->id_pegawai);
		$this->db->where('nas.id_jabatan', $this->session->id_jabatan);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
	//	$kondisi=array('id_level !='=>'99');
	//	$jml = $this->m_umum->jumlah_record_filter('user',$kondisi);		//[coding here] ganti tabel utamanya
		$jml = $this->m_umum->jumlah_record_tabel('nkr_indikator');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_nkr_indikator(){
		$kode = $this->m_rancak->kode_generator_urut(15,'IN');
    $nama_indikator = $this->input->post('nama_indikator');
    $nama_indikator = trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $nama_indikator)));
		$data_pendaftaran = array(
			'id_asesmen' => $this->input->post('id_asesmen'),
			'pembuat_indikator' => $this->session->id_pegawai,
			'instansi_indikator' => $this->session->barcode_working,
			'id_indikator' => $kode,
			'nama_indikator' => $nama_indikator
		);
		// print_r($data_pendaftaran);die();
		return $this->db->insert('nkr_indikator', $data_pendaftaran);		
		// $this->db->insert_id();			
	}
	function edit_nkr_indikator(){
		$id_indikator = $this->input->post('id_indikator');
    $nama_indikator = $this->input->post('nama_indikator');
    $nama_indikator = trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $nama_indikator)));
		$data_pendaftaran = array(
			'id_asesmen' => $this->input->post('id_asesmen'),
			'status_indikator' => $this->input->post('status_indikator'),
			'nama_indikator' => $nama_indikator
		);
		$this->db->where('id_indikator',$id_indikator);
		$this->db->update('nkr_indikator', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function ambil_nkr_indikator_form4($id,$idj,$tgrt){
	  $this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nin.id_asesmen','left');
	  $this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
	  $this->db->where($tgrt.' !="" ', NULL, FALSE);
	  $q = $this->db->get_where('nkr_indikator nin',array('nas.id_elemen'=>$id,'nas.id_jabatan'=>$idj,'nin.status_indikator'=>1,'pembuat_indikator'=>$this->session->id_pegawai));
	  return $q->result_array();
	}
	function ambil_soal_opsi($id){
	  $this->db->order_by('no_urut_soal_opsi','ASC');
	  $q = $this->db->get_where('nkr_soal_opsi',array('id_indikator'=>$id));
	  return $q->result_array();
	}
	function ambil_soal_opsie($id){
	  $this->db->order_by('no_urut_soal_opsi','ASC');
	  $q = $this->db->get_where('nkr_soal_opsi',array('id_indikator'=>$id,'status_soal_opsi'=>1));
	  return $q->result_array();
	}
	function simpan_opsi_soal(){
		$id_soal_opsi = $this->input->post('id_soal_opsi[]');
		$chk = $this->input->post('chk[]');
		if($chk){
			$this->tambah_opsi_soal();
		}
		$id_soal_opsi_edit = $this->input->post('id_soal_opsi_edit[]');
		if($id_soal_opsi_edit){
			$id_soal_opsi_edit = $this->input->post('id_soal_opsi_edit[]');		
			$nama_soal_opsi_edit = $this->input->post('nama_soal_opsi_edit[]');		
			$status_soal_opsi_edit = $this->input->post('status_soal_opsi_edit[]');			
			$answer = $this->input->post('answer[]');			
			$no_urut_soal_opsi_edit = $this->input->post('no_urut_soal_opsi_edit[]');			
			$jml_kode = count($id_soal_opsi_edit);
			for ($i=0;$i<$jml_kode;$i++){ 	
				$this->edit_opsi_soal($id_soal_opsi_edit[$i],$no_urut_soal_opsi_edit[$i],$nama_soal_opsi_edit[$i],$status_soal_opsi_edit[$i],$answer[$i]);				
			}
		}
	}
	function tambah_opsi_soal(){
		$chk = $this->input->post('chk[]');		
		$nama_soal_opsi = $this->input->post('nama_soal_opsi[]');		
		$status_soal_opsi = $this->input->post('status_soal_opsi[]');		
		$answer = $this->input->post('answer[]');		
		$id_indikator = $this->input->post('id_indikator');		
		$jml_kode = count($chk);
		$no_urut_soal_opsi = $this->no_urutan_opsi_soal($id_indikator);
		for ($i=0;$i<$jml_kode;$i++){
			if(!empty($nama_soal_opsi[$i])){
				$kode = $this->m_rancak->kode_generator_urut(15,'OS');
				$data_pendaftaran = array(
					'id_soal_opsi' => $kode,					
					'id_indikator' => $id_indikator,					
					'no_urut_soal_opsi' => $no_urut_soal_opsi++,					
					'nama_soal_opsi' => $nama_soal_opsi[$i],					
					'answer' => $answer[$i],					
					'status_soal_opsi' => $status_soal_opsi[$i]
				);
				$this->db->insert('nkr_soal_opsi', $data_pendaftaran);
			}				
		}		
	}
	function no_urutan_opsi_soal($id){
        //Cari id terakhir dengan unit dan tanggal yang sama
        $this->db->select("id_soal_opsi, no_urut_soal_opsi");
        $this->db->where("id_indikator", $id);
        $this->db->order_by('no_urut_soal_opsi', 'DESC');
        $query=$this->db->get_where("nkr_soal_opsi");
        $result = $query->row();
        if(isset($result))
            return $result->no_urut_soal_opsi;
        return 0;
	}
	function edit_opsi_soal($id_soal_opsi,$no_urut_soal_opsi,$nama_soal_opsi,$status_soal_opsi,$answer){
		$data_pendaftaran = array(
			'answer' => $answer,					
			'no_urut_soal_opsi' => $no_urut_soal_opsi,					
			'nama_soal_opsi' => $nama_soal_opsi,					
			'status_soal_opsi' => $status_soal_opsi
		);
		$this->db->where('id_soal_opsi',$id_soal_opsi);
		$this->db->update('nkr_soal_opsi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function edit_poin(){
		$id_indikator = $this->input->post('id_indikator');
    $poin_indikator = $this->input->post('poin_indikator');
    $poin_indikator = trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $poin_indikator)));
		$data_pendaftaran = array(
			'poin_indikator' => $poin_indikator
		);
		$this->db->where('id_indikator',$id_indikator);
		$this->db->update('nkr_indikator', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function edit_ketercapaian(){
		$id_indikator = $this->input->post('id_indikator');
		$data_pendaftaran = array(
			'ketercapaian_indikator' => $this->input->post('ketercapaian_indikator')
		);
		$this->db->where('id_indikator',$id_indikator);
		$this->db->update('nkr_indikator', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function edit_pertanyaan(){
		$id_indikator = $this->input->post('id_indikator');
		$data_pendaftaran = array(
			'pertanyaan_indikator' => $this->input->post('pertanyaan_indikator')
		);
		$this->db->where('id_indikator',$id_indikator);
		$this->db->update('nkr_indikator', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
 function edit_dokumen(){
  $id_indikator = $this->input->post('id_indikator');
  $data_pendaftaran = array(
   'dokumen_indikator' => $this->input->post('dokumen_indikator')
  );
  $this->db->where('id_indikator',$id_indikator);
  $this->db->update('nkr_indikator', $data_pendaftaran);
  //echo $this->db->last_query();
  $this->db->trans_complete(); // untuk cek sukses update tidak
  if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
  // if (!$this->db->affected_rows())
   return(FALSE);
  else
   return(TRUE);
 }
	function edit_jawaban(){
		$id_indikator = $this->input->post('id_indikator');
		$data_pendaftaran = array(
			'jawaban_indikator' => $this->input->post('jawaban_indikator')
		);
		$this->db->where('id_indikator',$id_indikator);
		$this->db->update('nkr_indikator', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function edit_jenis_soal_nkr_indikator(){
		$id_indikator = $this->input->post('id_indikator');
		$data_pendaftaran = array(
			'jenis_soal' => $this->input->post('jenis_soal')
		);
		$this->db->where('id_indikator',$id_indikator);
		$this->db->update('nkr_indikator', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function ambil_asesmen_dari_indikator($grup,$order,$sort,$kondisi,$nojoin=FALSE){
      $jabatan = explode(',', $this->session->mas_kred);
	  $instansi = explode(',', $this->session->mas_ins);
		if($nojoin === FALSE)
		{
		  $this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nin.id_asesmen','left');
		  $this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
		  $this->db->where('pembuat_indikator', $this->session->id_pegawai);
		  $this->db->where('nas.id_jabatan', $this->session->id_jabatan);
		  $this->db->group_by($grup);
		}else{
		  $this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nin.id_asesmen','left');
		  $this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
		  $this->db->where('pembuat_indikator', $this->session->id_pegawai);
		  $this->db->where('nas.id_jabatan', $this->session->id_jabatan);
		}
	  $this->db->order_by($order,$sort);
	  $q = $this->db->get_where('nkr_indikator nin',$kondisi);
	  return $q->result_array();
	}
	function ambil_asesmen_dari_form_detil($grup,$order,$sort,$kondisi,$nojoin=FALSE){
      $jabatan = explode(',', $this->session->mas_kred);
	  $instansi = explode(',', $this->session->mas_ins);
	  $this->db->join('nkr_form nf', 'nf.barcode_form=nfd.barcode_form','left');
	  $this->db->join('nkr_indikator nin', 'nin.id_indikator=nfd.id_indikator','left');
		if($nojoin === FALSE)
		{
		  $this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nin.id_asesmen','left');
		  $this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
		  $this->db->group_by($grup);
		}else{
		  $this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nin.id_asesmen','left');
		  $this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
		}
	  $this->db->order_by($order,$sort);
	  $q = $this->db->get_where('nkr_form_detil nfd',$kondisi);
	  return $q->result_array();
	}
	function simpan_nkr_metode_indikator(){
		$chk = $this->input->post('chk[]');
		$id_indikator = $this->input->post('id_indikator');	
		if($chk){
			$eimplo = implode(",",$chk);
		}else{
			$eimplo = "";
		}
			$data_pendaftaran = array(
				'metode_indikator' => $eimplo
			);
			$this->db->where('id_indikator',$id_indikator);
			$this->db->update('nkr_indikator', $data_pendaftaran);
			//echo $this->db->last_query();
			$this->db->trans_complete();	// untuk cek sukses update tidak
			if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
			// if (!$this->db->affected_rows()) 
				return(FALSE);
			else 
				return(TRUE);
	}
	function simpan_nkr_perangkat_indikator(){
		$chk = $this->input->post('chk[]');
		$id_indikator = $this->input->post('id_indikator');	
		if($chk){
			$eimplo = implode(",",$chk);
		}else{
			$eimplo = "";
		}
			$data_pendaftaran = array(
				'perangkat_indikator' => $eimplo
			);
			$this->db->where('id_indikator',$id_indikator);
			$this->db->update('nkr_indikator', $data_pendaftaran);
			//echo $this->db->last_query();
			$this->db->trans_complete();	// untuk cek sukses update tidak
			if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
			// if (!$this->db->affected_rows()) 
				return(FALSE);
			else 
				return(TRUE);
	}
	function simpan_nkr_formmetper_detil(){
		$barcode_form = $this->input->post('barcode_form');
		$chk = $this->input->post('chk[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				$this->db->select("COUNT(*) as num");
				$this->db->where('barcode_form',$barcode_form);
				$this->db->where('id_indikator',$chk[$i]);
				$q = $this->db->get('nkr_form_detil')->row();
				$jml = $q->num;
				if($jml == 0){
					$kode = $this->m_rancak->kode_generator_urut(15,'3F');
					$take_indikator = $this->m_umum->ambil_data('nkr_indikator','id_indikator',$chk[$i]);
					$urut_form_detil = $this->urut_form_detil($barcode_form);
					$urut_form_detil++;
					$data_pendaftaran = array(
						'no_urut_detil' => $urut_form_detil,
						'id_indikator' => $chk[$i],
						'barcode_form_detil' => $kode,
						'barcode_form' => $barcode_form
					);
					$this->db->insert('nkr_form_detil', $data_pendaftaran);
				}
			}
		}
	}
    function urut_form_detil($id)
    {
        $this->db->where("barcode_form", $id);
        $this->db->order_by('no_urut_detil', 'DESC');
        $query=$this->db->get_where("nkr_form_detil");
        $result = $query->row();
        // echo $this->db->last_query();
        // echo "No Antri = ".$result->no_antri;die();
        if(isset($result))
            return $result->no_urut_detil;
        return 0;
    }
	function simpan_nkr_metode_form_detil(){
		$chk = $this->input->post('chk[]');
		$id_form_detil = $this->input->post('id_form_detil');	
		$eimplo = implode(",",$chk);
		if($chk){
			$data_pendaftaran = array(
				'metode_form_detil' => $eimplo
			);
			$this->db->where('id_form_detil',$id_form_detil);
			$this->db->update('nkr_form_detil', $data_pendaftaran);
			//echo $this->db->last_query();
			$this->db->trans_complete();	// untuk cek sukses update tidak
			if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
			// if (!$this->db->affected_rows()) 
				return(FALSE);
			else 
				return(TRUE);
		}
	}
	function simpan_nkr_perangkat_form_detil(){
		$chk = $this->input->post('chk[]');
		$id_form_detil = $this->input->post('id_form_detil');	
		$eimplo = implode(",",$chk);
		if($chk){
			$data_pendaftaran = array(
				'perangkat_form_detil' => $eimplo
			);
			$this->db->where('id_form_detil',$id_form_detil);
			$this->db->update('nkr_form_detil', $data_pendaftaran);
			//echo $this->db->last_query();
			$this->db->trans_complete();	// untuk cek sukses update tidak
			if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
			// if (!$this->db->affected_rows()) 
				return(FALSE);
			else 
				return(TRUE);
		}
	}
	function langkah_all()
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

	    $this->db->from('nkr_pra_asesmen npa');
	    $this->db->join('ol_pegawai op', 'op.id_pegawai=npa.pembuat_pra_asesmen','left');

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

	    $this->db->from('nkr_pra_asesmen npa');
		$this->db->join('ol_pegawai op', 'op.id_pegawai=npa.pembuat_pra_asesmen','left');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('nkr_pra_asesmen');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_nkr_pra_asesmen(){
		$kode = $this->m_rancak->kode_generator_urut(15,'PA');
		$data_pendaftaran = array(
			'pembuat_pra_asesmen' => $this->session->id_pegawai,
			'barcode_pra_asesmen' => $kode,
			'nama_pra_asesmen' => $this->input->post('nama_pra_asesmen')
		);
		// print_r($data_pendaftaran);die();
		return $this->db->insert('nkr_pra_asesmen', $data_pendaftaran);		
		// $this->db->insert_id();			
	}
	function edit_nkr_pra_asesmen(){
		$id_pra_asesmen = $this->input->post('id_pra_asesmen');
		$data_pendaftaran = array(
			'nama_pra_asesmen' => $this->input->post('nama_pra_asesmen')
		);
		$this->db->where('id_pra_asesmen',$id_pra_asesmen);
		$this->db->update('nkr_pra_asesmen', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function kegiatan_all()
	{
		$jabatan = explode(',', $this->session->mas_kred);
		$fields = "*,if(npd.id_jabatan = 0,'Semua Profesi',nama_jabatan) as nama_jabatan";
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
		$this->db->where_in('npd.id_jabatan', $jabatan);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('nkr_pra_detil npd');
	    $this->db->join('nkr_pra_asesmen npa', 'npa.barcode_pra_asesmen=npd.barcode_pra_asesmen','left');
	    $this->db->join('jabatan j', 'j.id_jabatan=npd.id_jabatan','left');
	    $this->db->join('ol_pegawai op', 'op.id_pegawai=npd.pembuat_pra_detil','left');
		$this->db->where_in('npd.id_jabatan', $jabatan);

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
		$this->db->where_in('npd.id_jabatan', $jabatan);
			}
		  }
		}

	    $this->db->from('nkr_pra_detil npd');
	    $this->db->join('nkr_pra_asesmen npa', 'npa.barcode_pra_asesmen=npd.barcode_pra_asesmen','left');
	    $this->db->join('jabatan j', 'j.id_jabatan=npd.id_jabatan','left');
	    $this->db->join('ol_pegawai op', 'op.id_pegawai=npd.pembuat_pra_detil','left');
	    $this->db->where_in('npd.id_jabatan', $jabatan);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('nkr_pra_detil');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_nkr_pra_detil(){
		$kode = $this->m_rancak->kode_generator_urut(15,'PD');
		$data_pendaftaran = array(
			'pembuat_pra_detil' => $this->session->id_pegawai,
			'barcode_pra_detil' => $kode,
			'id_jabatan' => $this->input->post('id_jabatan'),
			'barcode_pra_asesmen' => $this->input->post('barcode_pra_asesmen'),
			'nama_pra_detil' => $this->input->post('nama_pra_detil')
		);
		// print_r($data_pendaftaran);die();
		return $this->db->insert('nkr_pra_detil', $data_pendaftaran);		
		// $this->db->insert_id();			
	}
	function edit_nkr_pra_detil(){
		$id_pra_detil = $this->input->post('id_pra_detil');
		$data_pendaftaran = array(
			'nama_pra_detil' => $this->input->post('nama_pra_detil'),
			'id_jabatan' => $this->input->post('id_jabatan'),
			'barcode_pra_asesmen' => $this->input->post('barcode_pra_asesmen')
		);
		$this->db->where('id_pra_detil',$id_pra_detil);
		$this->db->update('nkr_pra_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function cmd_pra_asesmen(){
		$this->db->select("barcode_pra_asesmen, nama_pra_asesmen");
		$q= $this->db->get_where('nkr_pra_asesmen')->result_array();
		$hasil= array_column($q,'nama_pra_asesmen','barcode_pra_asesmen');
		return $hasil;
	}
	function ambil_nkr_pra_detil($id,$idj){
	  $jabatan = explode(',', $this->session->mas_kred);
	  $this->db->join('nkr_pra_asesmen npa', 'npa.barcode_pra_asesmen=npd.barcode_pra_asesmen','left');
	  $this->db->join('jabatan j', 'j.id_jabatan=npd.id_jabatan','left');
	  if($idj == 0){
		$array_check = array(0);
	  }else{
		$array_check = array(0,$idj);
	  }
	  $this->db->where_in('npd.id_jabatan', $array_check);
	//  $q = $this->db->get_where('nkr_pra_detil npd',array('npd.barcode_pra_asesmen'=>$id,'npd.id_jabatan'=>$idj));
   $q = $this->db->get_where('nkr_pra_detil npd',array('npd.barcode_pra_asesmen'=>$id));
	  return $q->result_array();
	}
	function simpan_form_pra_detil(){
		$barcode_form = $this->input->post('barcode_form');
		$chk = $this->input->post('chk[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				$this->db->select("COUNT(*) as num");
				$this->db->where('barcode_form',$barcode_form);
				$this->db->where('id_pra_detil',$chk[$i]);
				$q = $this->db->get('nkr_form_detil')->row();
				$jml = $q->num;
				if($jml == 0){
					$kode = $this->m_rancak->kode_generator_urut(15,'3F');
					$urut_form_detil = $this->urut_form_detil($barcode_form);
					$urut_form_detil++;
					$data_pendaftaran = array(
						'no_urut_detil' => $urut_form_detil,
						'id_pra_detil' => $chk[$i],
						'barcode_form_detil' => $kode,
						'barcode_form' => $barcode_form
					);
					$this->db->insert('nkr_form_detil', $data_pendaftaran);
				}
			}
		}
	}
	function kat_kaji_ulang_all()
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

	    $this->db->from('nkr_kat_kaji');

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

	    $this->db->from('nkr_kat_kaji');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('nkr_kat_kaji');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_nkr_kat_kaji(){
		$kode = $this->m_rancak->kode_generator_urut(15,'KU');
		$data_pendaftaran = array(
			'pembuat_kat_kaji' => $this->session->id_pegawai,
			'nama_kat_kaji' => $this->input->post('nama_kat_kaji')
		);
		// print_r($data_pendaftaran);die();
		return $this->db->insert('nkr_kat_kaji', $data_pendaftaran);		
		// $this->db->insert_id();			
	}
	function edit_nkr_kat_kaji(){
		$id_kat_kaji = $this->input->post('id_kat_kaji');
		$data_pendaftaran = array(
			'id_kat_kaji' => $this->input->post('id_kat_kaji'),
			'nama_kat_kaji' => $this->input->post('nama_kat_kaji')
		);
		$this->db->where('id_kat_kaji',$id_kat_kaji);
		$this->db->update('nkr_kat_kaji', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function kaji_ulang_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,if(nku.id_kat_kaji = 0,'-',nama_kat_kaji) as nama_kat_kaji";
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

	    $this->db->from('nkr_kaji_ulang nku');
	    $this->db->join('kol_jenis_form kjf', 'kjf.id_jenis_form=nku.id_jenis_form','left');
	    $this->db->join('nkr_kat_kaji nkk', 'nkk.id_kat_kaji=nku.id_kat_kaji','left');

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

	    $this->db->from('nkr_kaji_ulang nku');
	    $this->db->join('kol_jenis_form kjf', 'kjf.id_jenis_form=nku.id_jenis_form','left');
	    $this->db->join('nkr_kat_kaji nkk', 'nkk.id_kat_kaji=nku.id_kat_kaji','left');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('nkr_kaji_ulang');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_nkr_kaji_ulang(){
		$kode = $this->m_rancak->kode_generator_urut(15,'KU');
		$data_pendaftaran = array(
			'pembuat_kaji_ulang' => $this->session->id_pegawai,
			'id_jenis_form' => $this->input->post('id_jenis_form'),
			'id_kat_kaji' => $this->input->post('id_kat_kaji'),
			'nama_kaji_ulang' => $this->input->post('nama_kaji_ulang')
		);
		// print_r($data_pendaftaran);die();
		return $this->db->insert('nkr_kaji_ulang', $data_pendaftaran);		
		// $this->db->insert_id();			
	}
	function edit_nkr_kaji_ulang(){
		$id_kaji_ulang = $this->input->post('id_kaji_ulang');
		$data_pendaftaran = array(
			'id_kat_kaji' => $this->input->post('id_kat_kaji'),
			'id_jenis_form' => $this->input->post('id_jenis_form'),
			'nama_kaji_ulang' => $this->input->post('nama_kaji_ulang')
		);
		$this->db->where('id_kaji_ulang',$id_kaji_ulang);
		$this->db->update('nkr_kaji_ulang', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function cmd_form($array_check){
		$this->db->select("id_jenis_form, nama_jenis_form");
	//	$array_check = array(0,6);
	  	$this->db->where_in('id_jenis_form', $array_check);
		$q= $this->db->get_where('kol_jenis_form')->result_array();
		$hasil= array_column($q,'nama_jenis_form','id_jenis_form');
		return $hasil;
	}
	function ambil_nkr_kaji_ulang($id){
		$this->db->select("*,if(nku.id_kat_kaji = 0,'-',nama_kat_kaji) as nama_kat_kaji");
		$this->db->join('nkr_kat_kaji nkk', 'nkk.id_kat_kaji=nku.id_kat_kaji','left');
	  $q = $this->db->get_where('nkr_kaji_ulang nku',array('nku.id_jenis_form'=>$id));
	  return $q->result_array();
	}
	function simpan_form_kaji_ulang(){
		$barcode_form = $this->input->post('barcode_form');
		$chk = $this->input->post('chk[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				$this->db->select("COUNT(*) as num");
				$this->db->where('barcode_form',$barcode_form);
				$this->db->where('id_kaji_ulang',$chk[$i]);
				$q = $this->db->get('nkr_form_detil')->row();
				$jml = $q->num;
				if($jml == 0){
					$kode = $this->m_rancak->kode_generator_urut(15,'3F');
					$urut_form_detil = $this->urut_form_detil($barcode_form);
					$urut_form_detil++;
					$data_pendaftaran = array(
						'no_urut_detil' => $urut_form_detil,
						'id_kaji_ulang' => $chk[$i],
						'barcode_form_detil' => $kode,
						'barcode_form' => $barcode_form
					);
					$this->db->insert('nkr_form_detil', $data_pendaftaran);
				}
			}
		}
	}
	function kompetensi_all()
	{
		$jabatan = explode(',', $this->session->mas_kred);
		$instansi = explode(',', '0,'.$this->session->mas_ins);
	//	$instansi = $this->session->refer;
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,if(instansi_kompetensi IS NULL or instansi_kompetensi = 0,'Semua Instansi', nama_working) as nama_working";
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
	//	$this->db->where("kp.instansi_kompetensi = 0 OR kp.instansi_kompetensi = '$instansi'");
				$this->db->where_in('kp.abk', 0);
		$this->db->where('kp.instansi_kompetensi', $instansi);
		$this->db->where_in('kp.id_jabatan', $jabatan);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('nkr_kompetensi kp');
		$this->db->join('jabatan j', 'j.id_jabatan=kp.id_jabatan','left');
		$this->db->join('ol_pegawai_grade opg', 'opg.id_grade=kp.id_grade','left');
		$this->db->join('kol_working kw', 'kw.id_working=kp.instansi_kompetensi','left');
	//	$this->db->where("kp.instansi_kompetensi = 0 OR kp.instansi_kompetensi = '$instansi'");
		$this->db->where('kp.abk', 0);
		$this->db->where_in('kp.instansi_kompetensi', $instansi);
		$this->db->where_in('kp.id_jabatan', $jabatan);

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
	//	$this->db->where("kp.instansi_kompetensi = 0 OR kp.instansi_kompetensi = '$instansi'");
		$this->db->where('kp.abk', 0);
		$this->db->where_in('kp.instansi_kompetensi', $instansi);
		$this->db->where_in('kp.id_jabatan', $jabatan);
			}
		  }
		}

	    $this->db->from('nkr_kompetensi kp');
		$this->db->join('jabatan j', 'j.id_jabatan=kp.id_jabatan','left');
		$this->db->join('ol_pegawai_grade opg', 'opg.id_grade=kp.id_grade','left');
		$this->db->join('kol_working kw', 'kw.id_working=kp.instansi_kompetensi','left');
	//	$this->db->where("kp.instansi_kompetensi = 0 OR kp.instansi_kompetensi = '$instansi'");
		$this->db->where('kp.abk', 0);
		$this->db->where_in('kp.instansi_kompetensi', $instansi);
		$this->db->where_in('kp.id_jabatan', $jabatan);;

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('nkr_kompetensi');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_nkr_kompetensi(){
		$kode = strtoupper($this->input->post('kode_unit'));
		$idkode = $this->m_rancak->kode_generator_urut(15,'KM');
		$data_pendaftaran = array(
			'id_jabatan' => $this->input->post('id_jabatan'),
			'id_grade' => $this->input->post('id_grade'),
			'kode_unit' => $kode,
		//	'id_kompetensi' => $idkode,
			'creator_kompetensi' => $this->session->id_pegawai,
			'nama_kompetensi' => $this->input->post('nama_kompetensi'),
			'instansi_kompetensi' => $this->input->post('instansi_kompetensi'),
			'deskripsi_kompetensi' => $this->input->post('deskripsi_kompetensi')
		);
		// print_r($data_pendaftaran);die();
		return $this->db->insert('nkr_kompetensi', $data_pendaftaran);		
		// $this->db->insert_id();			
	}
	function edit_nkr_kompetensi(){
		$id_kompetensi = $this->input->post('id_kompetensi');
		$kode = strtoupper($this->input->post('kode_unit'));
		$data_pendaftaran = array(
			'id_jabatan' => $this->input->post('id_jabatan'),
			'id_grade' => $this->input->post('id_grade'),
			'kode_unit' => $kode,
			'instansi_kompetensi' => $this->input->post('instansi_kompetensi'),
			'nama_kompetensi' => $this->input->post('nama_kompetensi'),
			'deskripsi_kompetensi' => $this->input->post('deskripsi_kompetensi')
		);
		$this->db->where('id_kompetensi',$id_kompetensi);
		$this->db->update('nkr_kompetensi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function edit_syarat_kompetensi(){
		$chk = $this->input->post('chk[]');
		$id_kompetensi = $this->input->post('id_kompetensi');	
		$eimplo = implode(",",$chk);
		if($chk){
			$data_pendaftaran = array(
				'syarat_kompetensi' => $eimplo
			);
			$this->db->where('id_kompetensi',$id_kompetensi);
			$this->db->update('nkr_kompetensi', $data_pendaftaran);
			//echo $this->db->last_query();
			$this->db->trans_complete();	// untuk cek sukses update tidak
			if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
			// if (!$this->db->affected_rows()) 
				return(FALSE);
			else 
				return(TRUE);
		}
	}
	function kewenangan_all($key)
	{
		$wordsAry = explode("-", $key);
		$wordsCount = count($wordsAry);
		$jabatan = explode(',', $this->session->mas_kred);
		$instansi = explode(',', '0,'.$this->session->mas_ins);
	//	$instansi = $this->session->refer;
		$fields = "*,if(instansi_kompetensi IS NULL or instansi_kompetensi = 0,'Semua Instansi', nama_working) as nama_working";
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
				$this->db->where('kp.abk', 0);
		$this->db->where_in('kp.instansi_kompetensi', $instansi);
		$this->db->where_in('kp.id_jabatan', $jabatan);
		if(!empty($key) || $this->input->post('key',true)){
			$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(kw.nama_kewenangan LIKE '%".$wordsAry[$i]."%' OR kp.nama_kompetensi LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

   	    $this->db->from('nkr_kewenangan kw');
		$this->db->join('nkr_kompetensi kp', 'kp.id_kompetensi=kw.id_kompetensi','left');
		$this->db->join('jabatan j', 'j.id_jabatan=kp.id_jabatan','left');
		$this->db->join('kol_working kwe', 'kwe.id_working=kp.instansi_kompetensi','left');
		$this->db->where('kp.abk', 0);
		$this->db->where_in('kp.instansi_kompetensi', $instansi);
		$this->db->where_in('kp.id_jabatan', $jabatan);
		if(!empty($key) || $this->input->post('key',true)){
			$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(kw.nama_kewenangan LIKE '%".$wordsAry[$i]."%' OR kp.nama_kompetensi LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
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
				$this->db->where('kp.abk', 0);
		$this->db->where_in('kp.instansi_kompetensi', $instansi);
		$this->db->where_in('kp.id_jabatan', $jabatan);
		if(!empty($key) || $this->input->post('key',true)){
			$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(kw.nama_kewenangan LIKE '%".$wordsAry[$i]."%' OR kp.nama_kompetensi LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
			}
		  }
		}

   	    $this->db->from('nkr_kewenangan kw');
		$this->db->join('nkr_kompetensi kp', 'kp.id_kompetensi=kw.id_kompetensi','left');
		$this->db->join('jabatan j', 'j.id_jabatan=kp.id_jabatan','left');
		$this->db->join('kol_working kwe', 'kwe.id_working=kp.instansi_kompetensi','left');
		$this->db->where('kp.abk', 0);
		$this->db->where_in('kp.instansi_kompetensi', $instansi);
		$this->db->where_in('kp.id_jabatan', $jabatan);
		if(!empty($key) || $this->input->post('key',true)){
			$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(kw.nama_kewenangan LIKE '%".$wordsAry[$i]."%' OR kp.nama_kompetensi LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
	//	$kondisi=array('id_level !='=>'99');
	//	$jml = $this->m_umum->jumlah_record_filter('user',$kondisi);		//[coding here] ganti tabel utamanya
		$jml = $this->m_umum->jumlah_record_tabel('nkr_kewenangan');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function kode_generator_kewenangan($length,$no)
	{
		// jumlah char = 30
		$thn = date('Y');
		$bln = date('m');
		$tgl = date('d');
		$jam = date('H');
		$mnt = date('i');
		$sec = date('s');
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		$kode =  $thn . $bln. $tgl . $jam . $mnt . $sec ."KW". $no . $randomString;
		return $kode;
	}
	function simpan_nkr_kewenangan(){
		$idkode = $this->kode_generator_kewenangan(15,'KW');
		$data_pendaftaran = array(
			'id_kompetensi' => $this->input->post('id_kompetensi'),
			'creator_kewenangan' => $this->session->id_pegawai,
	//		'id_kewenangan' => $idkode,
			'nama_kewenangan' => $this->input->post('nama_kewenangan')
		);
		// print_r($data_pendaftaran);die();
		return $this->db->insert('nkr_kewenangan', $data_pendaftaran);		
		// $this->db->insert_id();			
	}
	function edit_nkr_kewenangan(){
		$id_kewenangan = $this->input->post('id_kewenangan');
		$data_pendaftaran = array(
			'id_kompetensi' => $this->input->post('id_kompetensi'),
			'nama_kewenangan' => $this->input->post('nama_kewenangan')
		);
		$this->db->where('id_kewenangan',$id_kewenangan);
		$this->db->update('nkr_kewenangan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function ambil_berkas_from_list($idp,$idk){
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=ob.id_pegawai','left');
		$this->db->join('ol_pegawai_instansi opi', 'opi.id_pegawai=peg.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
		$this->db->join('ol_berkas_kategori obk', 'obk.id_berkas_kategori=ob.id_kategori_berkas','left');
		$this->db->where("status_berkas", 1);
		$this->db->where("ob.id_pegawai", $idp);
		$this->db->where("ob.id_kategori_berkas", $idk);
		$q = $this->db->get_where('ol_berkas ob');
		return $q->result_array();
	}
  function ambil_berkas_surat_ijin_list($idp){
    $this->db->join('ol_pegawai peg', 'peg.id_pegawai=ob.id_pegawai','left');
    $this->db->join('ol_pegawai_instansi opi', 'opi.id_pegawai=peg.id_pegawai','left');
    $this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
    $this->db->join('ol_berkas_kategori obk', 'obk.id_berkas_kategori=ob.id_kategori_berkas','left');
    $this->db->where("status_berkas", 1);
    $this->db->where("ob.id_pegawai", $idp);
    $this->db->where("obk.kunci", 0);
    $q = $this->db->get_where('ol_berkas ob');
    return $q->result_array();
  }
  	function ambil_berkas_pelatihan_biasa($idr,$ruangan,$grup=FALSE,$select=FALSE){
	    $array_check = array(4,5,6,8,9,10,11);
	    if($select){
	    	$this->db->select($select);
	    }
		$this->db->join('ol_berkas_kategori obk', 'obk.id_berkas_kategori=ob.id_kategori_berkas','left');
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
		$q = $this->db->get_where('ol_berkas ob');
		return $q->result_array();
	}
  	function ambil_berkas_pelatihan_person($idr,$ruangan,$grup=FALSE,$select=FALSE){
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
	    $q = $this->db->get_where('ol_berkas ob');
		return $q->result_array();
	}
	function grafik_all_pegawai($select,$kondisi)
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
	function grafik_all_pegawai_result($select,$kondisi,$grup = FALSE)
	{
		$this->db->select($select);
		$this->db->join('ol_pegawai ope', 'ope.id_pegawai=opu.id_pegawai','left');
		$this->db->join('kol_pendidikan kpen', 'kpen.id_pendidikan=ope.id_pendidikan','left');
		$this->db->join('kol_agama kag', 'kag.id_agama=ope.id_agama','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=ope.id_status_kawin','left');
		$this->db->join('ol_status_pegawai osp', 'osp.id_status_pegawai=ope.tipe_pegawai','left');
		$this->db->join('ol_pegawai_grade opg', 'opg.id_grade=ope.id_grade','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=ope.id_jabatan_fungsional','left');
		$this->db->join('jabatan j', 'j.id_jabatan=jf.id_jabatan','left');
		$this->db->join('ol_unit ou', 'ou.id_unit=opu.id_unit','left');
		$this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
		$this->db->join('kol_provinsi prov', 'prov.id_prov=ope.id_prov','left');
		$this->db->join('kol_kabupaten kab', 'kab.id_kab=ope.id_kab','left');
		$this->db->join('kol_kecamatan kec', 'kec.id_kec=ope.id_kec','left');
		$this->db->join('kol_kelurahan kel', 'kel.id_kel=ope.id_kel','left');		
		if($grup)
		{ 
			$this->db->group_by($grup);	
			$this->db->order_by($grup,'ASC');	
		}
		$q = $this->db->get_where('ol_pegawai_unit opu',$kondisi);
		return $q->result_array();	
	}
	function grafik_all_pegawai_minat($select,$kondisi,$grup = FALSE)
	{
		$this->db->select($select);	
		$this->db->join('ol_pegawai ope', 'ope.id_pegawai=opm.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=ope.id_jabatan_fungsional','left');
		$this->db->join('ol_pegawai_unit opu', 'opu.id_pegawai=ope.id_pegawai','left');		
		$this->db->join('ol_peminatan op', 'op.id_peminatan=opm.id_peminatan','left');			
		if($grup)
		{ 
		$this->db->group_by($grup);	
		$this->db->order_by($grup,'ASC');	
		}
		$q = $this->db->get_where('ol_pegawai_minat opm',$kondisi);
		return $q->result_array();	
	}
  	function ambil_berkas_pelatihan_profesi($idr,$ruangan,$grup=FALSE,$select=FALSE){
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
	//    $this->db->where("ob.id_kategori_pelatihan >", 0);
		$this->db->where("obk.kunci", 1);
	    $this->db->where("ob.status_berkas", 1);
	    $this->db->where($idr, $ruangan);
	    if($grup){
	    	$this->db->group_by($grup);
	    }
	    $q = $this->db->get_where('ol_berkas ob');
		return $q->result_array();
	}
    function ambil_berkas_pelatihan_data($kondisi,$grup=FALSE,$select=FALSE){
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
      $this->db->where("ob.id_kategori_pelatihan >", 0);
      $this->db->where("ob.status_berkas", 1);
      if($grup){
        $this->db->group_by($grup);
      }
      $q = $this->db->get_where('ol_berkas ob',$kondisi);
    return $q->result_array();
  }
	function ambil_berkas_ijin($kondisi){
		$this->db->select("COUNT(ob.id_pegawai) as total_str");
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=ob.id_pegawai','left');
		$this->db->join('ol_pegawai_unit opu', 'opu.id_pegawai=peg.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
		$this->db->join('ol_berkas_kategori okb', 'okb.id_berkas_kategori=ob.id_kategori_berkas','left');
		$this->db->where($kondisi);		
		$q = $this->db->get_where('ol_berkas ob');
		return $q->result_array();
	}
  function ambil_berkas_ijin_comma($kondisi){
    $ins = explode(',', $this->session->mas_unit);
    $this->db->select("COUNT(ob.id_pegawai) as total_str");
    $this->db->join('ol_pegawai peg', 'peg.id_pegawai=ob.id_pegawai','left');
    $this->db->join('ol_pegawai_unit opu', 'opu.id_pegawai=peg.id_pegawai','left');
    $this->db->join('ol_unit ou', 'ou.id_unit=opu.id_unit','left');
    $this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
    $this->db->join('ol_berkas_kategori okb', 'okb.id_berkas_kategori=ob.id_kategori_berkas','left');
    $this->db->where_in("ou.coun_unit",$ins);
    $this->db->where($kondisi);
    $q = $this->db->get_where('ol_berkas ob');
    //echo $this->db->last_query();die();
    return $q->result_array();
  }
  function ambil_data_berkas_ijin($kondisi){
    $this->db->join('ol_pegawai peg', 'peg.id_pegawai=ob.id_pegawai','left');
    $this->db->join('ol_pegawai_unit opu', 'opu.id_pegawai=peg.id_pegawai','left');
    $this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
    $this->db->join('ol_berkas_kategori okb', 'okb.id_berkas_kategori=ob.id_kategori_berkas','left');
    $this->db->where($kondisi);   
    $q = $this->db->get_where('ol_berkas ob');
    return $q->result_array();
  }
  function ambil_data_berkas_ijin_comma($kondisi){
    $ins = explode(',', $this->session->mas_unit);
    $this->db->join('ol_pegawai peg', 'peg.id_pegawai=ob.id_pegawai','left');
    $this->db->join('ol_pegawai_unit opu', 'opu.id_pegawai=peg.id_pegawai','left');
    $this->db->join('ol_unit ou', 'ou.id_unit=opu.id_unit','left');
    $this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
    $this->db->join('ol_berkas_kategori okb', 'okb.id_berkas_kategori=ob.id_kategori_berkas','left');
    $this->db->where_in("ou.coun_unit",$ins);
    $this->db->where($kondisi);   
    $q = $this->db->get_where('ol_berkas ob');
    //echo $this->db->last_query();die();
    return $q->result_array();
  }
  function ambil_data_dropdown_pegawai_no_null_unit()
  {
    $ins = explode(',', $this->session->mas_unit);
    $this->db->select("ol_pegawai_unit.id_pegawai,barcode_pegawai,concat(nama_pegawai,' - Unit : ',nama_unit) as nama_pegawai");
    $this->db->join('ol_pegawai','ol_pegawai.id_pegawai=ol_pegawai_unit.id_pegawai','left');
    $this->db->join('ol_unit','ol_unit.id_unit=ol_pegawai_unit.id_unit','left');
  //  $this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
    $this->db->where_in("ol_unit.coun_unit",$ins);
  //  $this->db->where_in("jabatan_fungsional.id_jabatan",$jab);
    $this->db->order_by('nama_pegawai', 'asc');
    $q = $this->db->get_where('ol_pegawai_unit',array('status_pegawai'=>1,'visible'=>1));
    return $q->result_array();
  }
    function ambil_list_unit_kinerja(){
      $ins = explode(',', $this->session->mas_unit);
      $this->db->join('ol_unit opi', 'opi.id_unit=opu.id_unit','left');
      $this->db->where_in("opi.coun_unit",$ins);
      $this->db->group_by('opu.id_unit');
      $q = $this->db->get_where('ol_pegawai_unit opu');
      //echo $this->db->last_query();
      return $q->result_array();
  }
  function ambil_equipment_mutu_null($kondisi)
  {
    $ins = explode(',', $this->session->mas_unit);
    $this->db->select("id_equipment,concat(nama_equipment,' - Unit : ',nama_unit) as nama_equipment");
    $this->db->join('ol_unit', 'ol_unit.id_unit=ol_equipment.id_unit','left');
    $this->db->where_in("ol_unit.coun_unit",$ins);
    $q= $this->db->get_where('ol_equipment',$kondisi);
    return $q->result_array();
  }
  function laporan_all($first_date,$last_date,$opsi,$tgl,$jns)
  {
    $ins = explode(',', $this->session->mas_unit);
    $fields = "*,
    DATE_FORMAT(tgl_laporan,'%d-%m-%Y') as tgl_laporan,tgl_laporan as tgl_sort,DATE_FORMAT(tgl_awal,'%d-%m-%Y') as tgl_awal,DATE_FORMAT(tgl_akhir,'%d-%m-%Y') as tgl_akhir
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
        switch($k['data']){   //beberapa field ambigius, so sesuaikan [coding here]
        //   case 'no_hp' : $nmf="peg.no_hp";break;
          // case 'id_level'   : $nmf="u.id_level";break;
        default: $nmf=$k['data'];
        }
        $this->db->or_like($nmf, $cari['value'],'both',false);  
      $this->db->where_in("ou.coun_unit",$ins);
      if($tgl == 0){
        $this->db->where('tgl_laporan BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
      }
      if($opsi){
        $this->db->where('lap.id_equipment',$opsi);
      }
      }
      }
    }
    $this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

      $this->db->from('ol_laporan lap');  
      $this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=lap.pembuat_laporan','left');
      $this->db->join('ol_unit ou', 'ou.id_unit=lap.laporan_unit','left');
      $this->db->where_in("ou.coun_unit",$ins);
      if($tgl == 0){
        $this->db->where('tgl_laporan BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
      }
      if($opsi){
        $this->db->where('lap.id_equipment',$opsi);
      }

    $q = $this->db->limit($length,$start)->get_where(); //05 Execute

    $list=$q->result_array(); //06 Hasil
// echo $this->db->last_query();
  //--------- Query jumlah filter untuk paging -----
    $this->db->select("COUNT(*) as num"); //01 Select

    if(!empty($cari['value'])) {    //02 Where
      foreach($dt_kolom as $k){
      if($k['searchable']=='true'){ //cek kalo searchable
        switch($k['data']){   //beberapa field ambigius, so sesuaikan  [coding here]
        //  case 'no_hp' : $nmf="peg.no_hp";break;
          default: $nmf=$k['data'];
        }
        $this->db->or_like($nmf, $cari['value'],'both',false);
      $this->db->where_in("ou.coun_unit",$ins);
      if($tgl == 0){
        $this->db->where('tgl_laporan BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
      }
      if($opsi){
        $this->db->where('lap.id_equipment',$opsi);
      }
      }
      }
    }

      $this->db->from('ol_laporan lap');  
      $this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=lap.pembuat_laporan','left');
      $this->db->join('ol_unit ou', 'ou.id_unit=lap.laporan_unit','left'); 
      $this->db->where_in("ou.coun_unit",$ins);
      if($tgl == 0){
        $this->db->where('tgl_laporan BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
      }
      if($opsi){
        $this->db->where('lap.id_equipment',$opsi);
      }

    $q = $this->db->get_where(); //04 Execute
    $jml_filter = $q->row()->num; //05 Hasil

  //--------- Query jumlah All data paling banyak -----
/*    $kondisi=array('id_unit='=>$this->session->unit);
    $jml = $this->m_umum->jumlah_record_filter('ol_eq_imut',$kondisi); */
/*    $kondisi=array('id_unit='=>$this->session->unit,'jenis_equipment'=>1);
    $jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_eq_imut',$kondisi,'ol_equipment','id_equipment'); */
    $jml = $this->m_umum->jumlah_record_tabel('ol_laporan');

    $output = array(
      "draw" => $draw,
        "recordsTotal" => $jml,
        "recordsFiltered" => $jml_filter,
        "data" => $list
    );
    // print_r($output);die();
    return $output;
  }
  function laporan_detil_all($id,$jns)
  {
    $ins = explode(',', $this->session->mas_unit);
    $fields = "*,
    DATE_FORMAT(tgl_laporan,'%d-%m-%Y') as tgl_laporan,tgl_laporan as tgl_sort,DATE_FORMAT(tgl_awal,'%d-%m-%Y') as tgl_awal,DATE_FORMAT(tgl_akhir,'%d-%m-%Y') as tgl_akhir,concat(format(COALESCE(min_laporan_detil, 0),0),' - ',format(COALESCE(max_laporan_detil, 0),0)) as minimax,if(periode_laporan_detil=1,'HARIAN',if(periode_laporan_detil=2,'BULANAN','TAHUNAN')) as periode_laporan_detil
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
        switch($k['data']){   //beberapa field ambigius, so sesuaikan [coding here]
        //   case 'no_hp' : $nmf="peg.no_hp";break;
          // case 'id_level'   : $nmf="u.id_level";break;
        default: $nmf=$k['data'];
        }
        $this->db->or_like($nmf, $cari['value'],'both',false);
        $this->db->where_in('ou.coun_unit',$ins);
        $this->db->where('old.id_laporan',$id);
      }
      }
    }
    $this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

      $this->db->from('ol_laporan_detil old');  
      $this->db->join('ol_laporan lap', 'lap.id_laporan=old.id_laporan','left');
      $this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=lap.pembuat_laporan','left');
      $this->db->join('ol_unit ou', 'ou.id_unit=lap.laporan_unit','left');
      $this->db->join('sn_tabel st', 'st.id_tabel=old.tabel','left');
        $this->db->where_in('ou.coun_unit',$ins);
        $this->db->where('old.id_laporan',$id);

    $q = $this->db->limit($length,$start)->get_where(); //05 Execute

    $list=$q->result_array(); //06 Hasil
// echo $this->db->last_query();
  //--------- Query jumlah filter untuk paging -----
    $this->db->select("COUNT(*) as num"); //01 Select

    if(!empty($cari['value'])) {    //02 Where
      foreach($dt_kolom as $k){
      if($k['searchable']=='true'){ //cek kalo searchable
        switch($k['data']){   //beberapa field ambigius, so sesuaikan  [coding here]
        //  case 'no_hp' : $nmf="peg.no_hp";break;
          default: $nmf=$k['data'];
        }
        $this->db->or_like($nmf, $cari['value'],'both',false);
        $this->db->where_in('ou.coun_unit',$ins);
        $this->db->where('old.id_laporan',$id);
      }
      }
    }

      $this->db->from('ol_laporan_detil old');  
      $this->db->join('ol_laporan lap', 'lap.id_laporan=old.id_laporan','left');
      $this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=lap.pembuat_laporan','left');
      $this->db->join('ol_unit ou', 'ou.id_unit=lap.laporan_unit','left');
      $this->db->join('sn_tabel st', 'st.id_tabel=old.tabel','left');
        $this->db->where_in('ou.coun_unit',$ins);
        $this->db->where('old.id_laporan',$id);

    $q = $this->db->get_where(); //04 Execute
    $jml_filter = $q->row()->num; //05 Hasil

  //--------- Query jumlah All data paling banyak -----
/*    $kondisi=array('id_unit='=>$this->session->unit);
    $jml = $this->m_umum->jumlah_record_filter('ol_eq_imut',$kondisi); */
/*    $kondisi=array('id_unit='=>$this->session->unit,'jenis_equipment'=>1);
    $jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_eq_imut',$kondisi,'ol_equipment','id_equipment'); */
    $jml = $this->m_umum->jumlah_record_tabel('ol_laporan_detil');

    $output = array(
      "draw" => $draw,
        "recordsTotal" => $jml,
        "recordsFiltered" => $jml_filter,
        "data" => $list
    );
    // print_r($output);die();
    return $output;
  }
//==================================================================================
/*	function edit_urutan_nkr_asesmen(){
		$id_asesmen = $this->input->post('id_asesmen');
		$data_pendaftaran = array(
			'no_urut_asesmen' => $this->input->post('no_urut_asesmen')
		);
		$this->db->where('id_asesmen',$id_asesmen);
		$this->db->update('nkr_asesmen', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function simpan_nkr_form3_detil(){
		$barcode_form = $this->input->post('barcode_form');
		$chk = $this->input->post('chk[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				$this->db->select("COUNT(*) as num");
				$this->db->where('barcode_form',$barcode_form);
				$this->db->where('id_indikator',$chk[$i]);
				$q = $this->db->get('nkr_form_detil')->row();
				$jml = $q->num;
				if($jml == 0){
					$kode = $this->m_rancak->kode_generator_urut(15,'3F');
					$urut_form_detil = $this->urut_form_detil($barcode_form);
					$urut_form_detil++;
					$data_pendaftaran = array(
						'no_urut_detil' => $urut_form_detil,
						'id_indikator' => $chk[$i],
						'barcode_form_detil' => $kode,
						'barcode_form' => $barcode_form
					);
					$this->db->insert('nkr_form_detil', $data_pendaftaran);
				}
			}
		}
	}
	function edit_nkr_indikator_pertanyaan(){
		$id_indikator = $this->input->post('id_indikator');
		$data_pendaftaran = array(
			'poin_indikator' => $this->input->post('poin_indikator'),
			'pertanyaan_indikator' => $this->input->post('pertanyaan_indikator'),
			'jawaban_indikator' => $this->input->post('jawaban_indikator'),
			'ketercapaian_indikator' => $this->input->post('ketercapaian_indikator')
		);
		$this->db->where('id_indikator',$id_indikator);
		$this->db->update('nkr_indikator', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function simpan_nkr_indikator_form_detil(){
		$barcode_form = $this->input->post('barcode_form');
		$chk = $this->input->post('chk[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				$this->db->select("COUNT(*) as num");
				$this->db->where('barcode_form',$barcode_form);
				$this->db->where('id_indikator',$chk[$i]);
				$q = $this->db->get('nkr_form_detil')->row();
				$jml = $q->num;
				if($jml == 0){
					$kode = $this->m_rancak->kode_generator_urut(15,'QF');
					$urut_form_detil = $this->urut_form_detil($barcode_form);
					$urut_form_detil++;
					$data_pendaftaran = array(
						'no_urut_detil' => $urut_form_detil,
						'id_indikator' => $chk[$i],
						'barcode_form2_detil' => $kode,
						'barcode_form' => $barcode_form
					);
					$this->db->insert('nkr_form_detil', $data_pendaftaran);
				}
			}
		}
	}*/
}