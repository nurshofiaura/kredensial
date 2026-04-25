<?php
class M_sa extends CI_model{
// ================================================= KEUANGAN ==============================
	function dk_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,if (status_dk = '1' ,'AKTIF','NON AKTIF') as status_dk";
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

	    $this->db->from('akeu_dk');
	    $this->db->join('kol_working', 'kol_working.id_working=akeu_dk.id_instansi','left');


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
	    $this->db->from('akeu_dk');
	    $this->db->join('kol_working', 'kol_working.id_working=akeu_dk.id_instansi','left');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('akeu_dk');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_keu_dk(){
		$data_pendaftaran = array(
			'nama_dk' => $this->input->post('nama_dk'),
			'status_dk' => $this->input->post('status_dk'),
			'id_instansi' => $this->input->post('id_instansi'),
			'kode_rekening' => $this->input->post('kode_rekening')
		);
		return $this->db->insert('akeu_dk', $data_pendaftaran);
	}
	function edit_keu_dk(){
		$id_dk = $this->input->post('id_dk');
		$data_pendaftaran = array(
			'nama_dk' => $this->input->post('nama_dk'),
			'status_dk' => $this->input->post('status_dk'),
			'id_instansi' => $this->input->post('id_instansi'),
			'kode_rekening' => $this->input->post('kode_rekening')
		);
		$this->db->where('id_dk',$id_dk);
		$this->db->update('akeu_dk', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function transaksi_all($first_date,$last_date)
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,DATE_FORMAT(kt.tgl_transaksi,'%d-%m-%Y') as tgl_transaksi,FORMAT(total_transaksi,'#,###,##0') as total_transaksi,
			if(kt.id_pegawai = 0,'Komite',nama_pegawai) as nama_pegawai,if(kt.id_dk = 0,'Pembayaran Tahunan',nama_dk) as nama_dk
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
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		if(!empty($first_date) AND !empty($last_date)){
		$this->db->where('tgl_transaksi BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by
		
	    $this->db->from('akeu_transaksi kt');
		$this->db->join('keu_jenis_jurnal kjj', 'kjj.id_jenis_jurnal=kt.id_jenis_jurnal','left');
		$this->db->join('akeu_dk kd', 'kd.id_dk=kt.id_dk','left');
		$this->db->join('ol_pegawai op', 'op.id_pegawai=kt.id_pegawai','left');
		$this->db->where('ket_transaksi !=', 'SALDO AWAL');
		if(!empty($first_date) AND !empty($last_date)){
		$this->db->where('tgl_transaksi BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');}
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
		if(!empty($first_date) AND !empty($last_date)){
		$this->db->where('tgl_transaksi BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');}
			}
		  }
		}

	    $this->db->from('akeu_transaksi kt');
		$this->db->join('keu_jenis_jurnal kjj', 'kjj.id_jenis_jurnal=kt.id_jenis_jurnal','left');
		$this->db->join('akeu_dk kd', 'kd.id_dk=kt.id_dk','left');
		$this->db->join('ol_pegawai op', 'op.id_pegawai=kt.id_pegawai','left');
		$this->db->where('ket_transaksi !=', 'SALDO AWAL');
		if(!empty($first_date) AND !empty($last_date)){
		$this->db->where('tgl_transaksi BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');}
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		if(!empty($first_date) AND !empty($last_date)){
			$kondisi=('tgl_transaksi BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
			$jml = $this->m_umum->jumlah_record_filter('akeu_transaksi',$kondisi);
		}else{
			$jml = $this->m_umum->jumlah_record_tabel('akeu_transaksi');
		}

				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;	
	}
  	function cmd_pegawai(){
  		$this->db->select("concat(nama_pegawai,' ==[',if(status_aplikasi_bayar = 0,'Premium',DATE_FORMAT(tgl_expired,'%d-%m-%Y')),']== Instansi : ',nama_working) as nama_pegawai, opi.id_pegawai");
  		$this->db->join('kol_working kw', 'kw.id_working=opi.id_instansi','left');
  		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=opi.id_pegawai','left');
  		$this->db->join('aplikasi_bayar ab', 'ab.id_konsumen=opi.id_pegawai','left');
		$q = $this->db->get_where('ol_pegawai_instansi opi');
		return $q->result_array();
	}
  	function cmd_dk(){
  		$this->db->select("concat(nama_dk,' Instansi : ',nama_working) as nama_dk, id_dk");
  		$this->db->join('kol_working', 'kol_working.id_working=akeu_dk.id_instansi','left');
		$q = $this->db->get_where('akeu_dk')->result_array();
		return $q;
	}
  	function cmd_working(){
  		$this->db->select("id_working,nama_working");
		$q = $this->db->get_where('kol_working')->result_array();
		$hasil= array_column($q,'nama_working','id_working');
		return $hasil;
	}
  	function cmd_kol_mitra($id){
  		$this->db->select("id_mitra,nama_struktur_jabatan");
  		$this->db->join('srt_struktur_jabatan', 'srt_struktur_jabatan.id_struktur_jabatan=kol_mitra.id_struktur_jabatan','left');
		$q = $this->db->get_where('kol_mitra',array('id_instansi'=>$id))->result_array();
		$hasil= array_column($q,'nama_struktur_jabatan','id_mitra');
		return $hasil;
	}
  	function cmd_srt_sjab($id){
  		$this->db->select("id_struktur_jabatan,nama_struktur_jabatan");
		$q = $this->db->get_where('srt_struktur_jabatan',array('id_instansi'=>$id))->result_array();
		$hasil= array_column($q,'nama_struktur_jabatan','id_struktur_jabatan');
		return $hasil;
	}
  	function cmd_keu_coa(){
		$q = $this->db->get_where('keu_coa')->result_array();
		return $q;
	}
	function simpan_transaksi_keuangan($id){
		$tgl_transaksi = $this->input->post('tgl_transaksi');
		$tgl_transaksi = date('Y-m-d', strtotime($tgl_transaksi));	
		$totaldebet = $this->input->post('totaldebet');
		$totaldebet	= str_replace("'","&acute;",$totaldebet);
		$totaldebet	= str_replace(".","",$totaldebet);
		$totaldebet	= str_replace(" ","",$totaldebet);
		$totaldebet	= str_replace(",","",$totaldebet);
		$kode = $this->m_rancak->kode_generator_urut(15,'TR');
		if(empty($id)){
			$data_pendaftaran = array(
				'tgl_transaksi' => $tgl_transaksi,
				'kode_transaksi' => $kode,
				'no_transaksi' => $this->input->post('no_transaksi'),
				'id_jenis_jurnal' => $this->input->post('id_jenis_jurnal'),
				'id_dk' => $this->input->post('id_dk'),
				'id_pegawai' => $this->input->post('id_pegawai'),
				'ket_transaksi' => $this->input->post('ket_transaksi'),
				'total_transaksi' => $totaldebet,
				'id_user' => $this->session->id_pegawai
			);			
		}else{
			$data_pendaftaran = array(
				'tgl_transaksi' => $tgl_transaksi,
				'kode_transaksi' => $kode,
				'no_transaksi' => $this->input->post('no_transaksi'),
				'id_jenis_jurnal' => $this->input->post('id_jenis_jurnal'),
				'id_dk' => $this->input->post('id_dk'),
				'id_pegawai' => $this->input->post('id_pegawai'),
				'ket_transaksi' => $this->input->post('ket_transaksi'),
				'total_transaksi' => $totaldebet,
				'struk_transaksi' => $id,
				'id_user' => $this->session->id_pegawai
			);
		}
		$this->db->insert('akeu_transaksi', $data_pendaftaran);
		return $kode;
	}
	function simpan_transaksi_detil($id){
		$td_debet = $this->input->post('td_debet[]');
		$td_debet	= str_replace("'","&acute;",$td_debet);
		$td_debet	= str_replace(".","",$td_debet);
		$td_debet	= str_replace(" ","",$td_debet);
		$td_debet	= str_replace(",","",$td_debet);
		$td_kredit = $this->input->post('td_kredit[]');
		$td_kredit	= str_replace("'","&acute;",$td_kredit);
		$td_kredit	= str_replace(".","",$td_kredit);
		$td_kredit	= str_replace(" ","",$td_kredit);
		$td_kredit	= str_replace(",","",$td_kredit);
		$id_mata_uang = $this->input->post('id_mata_uang[]');	
		$ket_transaksi_detil = $this->input->post('ket_transaksi_detil[]');	
		$uraian_detil = $this->input->post('uraian_detil');	
		$ket_transaksi = $this->input->post('ket_transaksi');
		$id_coa = $this->input->post('id_coa[]');		
		$jml_kode = count($id_coa);
		$kode = $this->m_rancak->kode_generator_urut(15,'TR');
		for ($i=0;$i<$jml_kode;$i++){ 	
			$data_pendaftaran = array(
				'kode_transaksi_detil' => $kode,					
				'kode_transaksi' => $id,					
				'id_coa' => $id_coa[$i],					
				'td_debet' => $td_debet[$i],					
				'td_kredit' => $td_kredit[$i],																							
				'ket_transaksi_detil' => $ket_transaksi_detil[$i]
			);
			$this->db->insert('akeu_transaksi_detil', $data_pendaftaran);				
		}		
	}
	function edit_transaksi($id){
		$id_transaksi = $this->input->post('id_transaksi');
		$tgl_transaksi = $this->input->post('tgl_transaksi');
		$tgl_transaksi = date('Y-m-d', strtotime($tgl_transaksi));	
		$totaldebet = $this->input->post('totaldebet');
		$totaldebet	= str_replace("'","&acute;",$totaldebet);
		$totaldebet	= str_replace(".","",$totaldebet);
		$totaldebet	= str_replace(" ","",$totaldebet);
		$totaldebet	= str_replace(",","",$totaldebet);
		if(empty($id)){
			$data_pendaftaran = array(
				'tgl_transaksi' => $tgl_transaksi,
				'no_transaksi' => $this->input->post('no_transaksi'),
				'id_jenis_jurnal' => $this->input->post('id_jenis_jurnal'),
				'id_dk' => $this->input->post('id_dk'),
				'id_pegawai' => $this->input->post('id_pegawai'),
				'ket_transaksi' => $this->input->post('ket_transaksi'),
				'total_transaksi' => $totaldebet
			);		
		}else{
			$data_pendaftaran = array(
				'tgl_transaksi' => $tgl_transaksi,
				'no_transaksi' => $this->input->post('no_transaksi'),
				'id_jenis_jurnal' => $this->input->post('id_jenis_jurnal'),
				'id_dk' => $this->input->post('id_dk'),
				'id_pegawai' => $this->input->post('id_pegawai'),
				'ket_transaksi' => $this->input->post('ket_transaksi'),
				'total_transaksi' => $totaldebet,
				'struk_transaksi' => $id
			);	
		}
		$this->db->where('id_transaksi',$id_transaksi);
		$this->db->update('akeu_transaksi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function keep_semua_transaksi($pic){
		$kode_transaksi = $this->input->post('kode_transaksi');
		$this->edit_transaksi($pic);
		$id_soal_opsi = $this->input->post('id_soal_opsi[]');
		$id_coa = $this->input->post('id_coa[]');
		if($id_coa){
			$this->simpan_transaksi_detil($kode_transaksi);
		}
		$id_transaksi_detil_edit = $this->input->post('id_transaksi_detil_edit[]');
		if($id_transaksi_detil_edit){
			$id_transaksi_detil_edit = $this->input->post('id_transaksi_detil_edit[]');		
			$id_coa_edit = $this->input->post('id_coa_edit[]');		
			$td_debet_edit = $this->input->post('td_debet_edit[]');			
			$td_kredit_edit = $this->input->post('td_kredit_edit[]');			
			$ket_transaksi_detil_edit = $this->input->post('ket_transaksi_detil_edit[]');			
			$jml_kode = count($id_transaksi_detil_edit);
			for ($i=0;$i<$jml_kode;$i++){ 	
		$td_debet_edit[$i]	= str_replace("'","&acute;",$td_debet_edit[$i]);
		$td_debet_edit[$i]	= str_replace(".","",$td_debet_edit[$i]);
		$td_debet_edit[$i]	= str_replace(" ","",$td_debet_edit[$i]);
		$td_debet_edit[$i]	= str_replace(",","",$td_debet_edit[$i]);
		$td_kredit_edit[$i]	= str_replace("'","&acute;",$td_kredit_edit[$i]);
		$td_kredit_edit[$i]	= str_replace(".","",$td_kredit_edit[$i]);
		$td_kredit_edit[$i]	= str_replace(" ","",$td_kredit_edit[$i]);
		$td_kredit_edit[$i]	= str_replace(",","",$td_kredit_edit[$i]);
$this->edit_akeu_transaksi_detil($id_transaksi_detil_edit[$i],$id_coa_edit[$i],$td_debet_edit[$i],$td_kredit_edit[$i],$ket_transaksi_detil_edit[$i]);
			}
		}
	}
	function edit_akeu_transaksi_detil($id_transaksi_detil,$id_coa,$td_debet,$td_kredit,$ket_transaksi_detil){
		$data_pendaftaran = array(
				'id_coa' => $id_coa,					
				'td_debet' => $td_debet,					
				'td_kredit' => $td_kredit,																							
				'ket_transaksi_detil' => $ket_transaksi_detil
		);
		$this->db->where('id_transaksi_detil',$id_transaksi_detil);
		$this->db->update('akeu_transaksi_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function ambil_akeu_transaksi($first_date,$last_date,$id){
		$this->db->join('akeu_dk adk', 'adk.id_dk=kt.id_dk','left');
		$this->db->join('ol_pegawai op', 'op.id_pegawai=kt.id_pegawai','left');
		$this->db->join('keu_jenis_jurnal kjk', 'kjk.id_jenis_jurnal=kt.id_jenis_jurnal','left');
		if(!empty($first_date) AND !empty($last_date)){
			$this->db->where('tgl_transaksi BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		}else{
			$this->db->where('kt.kode_transaksi',$id);
		}
		$q = $this->db->get_where('akeu_transaksi kt');
		return $q->result_array();		
	}
	function ambil_akeu_transaksi_detil($id){
		$this->db->join('keu_coa', 'keu_coa.id_coa=akeu_transaksi_detil.id_coa','left');
		$q = $this->db->get_where('akeu_transaksi_detil',array('kode_transaksi'=>$id));
		return $q->result_array();		
	}
	function ambil_coa_periode($first_date,$last_date,$id){
		$this->db->join('akeu_transaksi kt', 'kt.kode_transaksi=ktd.kode_transaksi','left');
		$this->db->join('keu_coa kc', 'kc.id_coa=ktd.id_coa','left');
		if(!empty($first_date) AND !empty($last_date)){
			$this->db->where('tgl_transaksi BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		}else{
			$this->db->where('kt.kode_transaksi',$id);
		}
		$this->db->group_by('ktd.id_coa'); 
		$this->db->order_by('kode_coa', 'asc');
		$q = $this->db->get('akeu_transaksi_detil ktd');
		return $q->result_array();		
	}
	function ambil_sum_detil_periode($first_date,$id){
		$this->db->select('SUM(td_debet) + SUM(td_kredit) as total,SUM(td_debet) as debet,SUM(td_kredit) as kredit', FALSE);
		$this->db->join('akeu_transaksi kt', 'kt.kode_transaksi=ktd.kode_transaksi','left');
		$this->db->join('keu_coa kc', 'kc.id_coa=ktd.id_coa','left');
			$this->db->where('tgl_transaksi <', $first_date);
			$this->db->where('ktd.id_coa',$id);
		$q = $this->db->get('akeu_transaksi_detil ktd');
		return $q->row_array();		
	}
	function ambil_detil_periode($first_date,$last_date,$id){
		$this->db->join('akeu_transaksi kt', 'kt.kode_transaksi=ktd.kode_transaksi','left');
		$this->db->join('keu_coa kc', 'kc.id_coa=ktd.id_coa','left');
		if(!empty($first_date) AND !empty($last_date)){
			$this->db->where('tgl_transaksi BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		}else{
			$this->db->where('ktd.id_coa',$id);
		}
		$q = $this->db->get('akeu_transaksi_detil ktd');
		return $q->result_array();		
	}
	function ambil_aktiva($first_date,$last_date,$id){	
		$this->db->join('akeu_transaksi kt', 'kt.kode_transaksi=ktd.kode_transaksi','left');
		$this->db->join('keu_coa kc', 'kc.id_coa=ktd.id_coa','left');
		$this->db->join('keu_code kcd', 'kcd.id_code=kc.id_code','left');
		$this->db->where('kc.id_code <', 9);
		if(!empty($first_date) AND !empty($last_date)){
		$this->db->where('tgl_transaksi BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		}else{
			$this->db->where('kt.kode_transaksi',$id);
		}
		$this->db->group_by('ktd.id_coa');
		$q = $this->db->get('akeu_transaksi_detil ktd');	
		return $q->result_array();	
	}
	function ambil_passiva($first_date,$last_date,$id){
		$this->db->join('akeu_transaksi kt', 'kt.kode_transaksi=ktd.kode_transaksi','left');
		$this->db->join('keu_coa kc', 'kc.id_coa=ktd.id_coa','left');
		$this->db->join('keu_code kcd', 'kcd.id_code=kc.id_code','left');
		$this->db->where('kc.id_code >', 8);
		if(!empty($first_date) AND !empty($last_date)){
		$this->db->where('tgl_transaksi BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		}else{
			$this->db->where('kt.kode_transaksi',$id);
		}
		$this->db->group_by('ktd.id_coa');
		$q = $this->db->get('akeu_transaksi_detil ktd');	
		return $q->result_array();	
	}
	function ambil_transaksi_aktiva_periode($first_date,$last_date,$id){
		$this->db->select('*,ABS(SUM(ktd.td_debet)-SUM(ktd.td_kredit)) as selisih', FALSE);
		$this->db->join('akeu_transaksi kt', 'kt.kode_transaksi=ktd.kode_transaksi','left');
		$this->db->join('keu_coa kc', 'kc.id_coa=ktd.id_coa','left');
		if(!empty($first_date) AND !empty($last_date)){
		$this->db->where('tgl_transaksi BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		}else{
			$this->db->where('kc.id_code', $id);
		}
		$q = $this->db->get('akeu_transaksi_detil ktd');
		return $q->result_array();		
	}
	function ambil_transaksi_passiva_periode($first_date,$last_date,$id){
		$this->db->select('*,ABS(SUM(ktd.td_debet)-SUM(ktd.td_kredit)) as selisih', FALSE);
		$this->db->join('akeu_transaksi kt', 'kt.kode_transaksi=ktd.kode_transaksi','left');
		$this->db->join('keu_coa kc', 'kc.id_coa=ktd.id_coa','left');
		if(!empty($first_date) AND !empty($last_date)){
		$this->db->where('tgl_transaksi BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		}else{
			$this->db->where('kc.id_code', $id);
		}
		$q = $this->db->get('akeu_transaksi_detil ktd');
		return $q->result_array();		
	}
	function ambil_range_code($id,$first_date,$last_date){
		$this->db->select('*,ABS(SUM(ktd.td_debet)-SUM(ktd.td_kredit)) as selisih', FALSE);
		$this->db->join('akeu_transaksi kt', 'kt.kode_transaksi=ktd.kode_transaksi','left');
		$this->db->join('keu_coa kc', 'kc.id_coa=ktd.id_coa','left');
		if(!empty($first_date) AND !empty($last_date)){
		$this->db->where('tgl_transaksi BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		}else{
			$this->db->where('kc.id_code', $id);
		}
		$q = $this->db->get('akeu_transaksi_detil ktd');
		return $q->result_array();	
	}
	function count_row_code_debet($id,$first_date,$last_date){
		$this->db->join('akeu_transaksi kt', 'kt.kode_transaksi=ktd.kode_transaksi','left');
		$this->db->join('keu_coa kc', 'kc.id_coa=ktd.id_coa','left');
		if(!empty($first_date) AND !empty($last_date)){
		$this->db->where('tgl_transaksi BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		}else{
			$this->db->where('kc.id_code', $id);
		}
        $query = $this->db->select("COUNT(td_debet) as num")->get_where('akeu_transaksi_detil ktd');
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
	}
	function count_row_code_kredit($id,$first_date,$last_date){
		$this->db->join('akeu_transaksi kt', 'kt.kode_transaksi=ktd.kode_transaksi','left');
		$this->db->join('keu_coa kc', 'kc.id_coa=ktd.id_coa','left');
		if(!empty($first_date) AND !empty($last_date)){
		$this->db->where('tgl_transaksi BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		}else{
			$this->db->where('kc.id_code', $id);
		}
        $query = $this->db->select("COUNT(td_kredit) as num")->get_where('akeu_transaksi_detil ktd');
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
	}
	function ambil_code($kd,$first_date,$last_date,$id){	
		$this->db->join('akeu_transaksi kt', 'kt.kode_transaksi=ktd.kode_transaksi','left');
		$this->db->join('keu_coa kc', 'kc.id_coa=ktd.id_coa','left');
		$this->db->join('keu_code kcd', 'kcd.id_code=kc.id_code','left');
		$this->db->where('kc.id_code', $kd);
		if(!empty($first_date) AND !empty($last_date)){
		$this->db->where('tgl_transaksi BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		}else{
			$this->db->where('kt.kode_transaksi',$id);
		}
		$this->db->group_by('ktd.id_coa');
		$q = $this->db->get('akeu_transaksi_detil ktd');		
		return $q->result_array();	
	}
	function ambil_pendapatan(){	
		$this->db->where('id_code', 14);
		$q = $this->db->get('keu_code');	
		return $q->result_array();	
	}
	function ambil_pendapatan_lain(){	
		$this->db->where('id_code', 15);
		$q = $this->db->get('keu_code');	
		return $q->result_array();	
	}	
	function ambil_hpp(){	
		$this->db->where('id_code', 16);
		$q = $this->db->get('keu_code');	
		return $q->result_array();	
	}
	function ambil_biaya(){	
		$this->db->where('id_code', 17);
		$q = $this->db->get('keu_code');	
		return $q->result_array();	
	}
	function ambil_biaya_lainnya(){	
		$this->db->where('id_code', 18);
		$q = $this->db->get('keu_code');	
		return $q->result_array();	
	}
	function clone_pemeriksaan($first_date,$last_date)
	{
		$were = array('id_logbooker'=>1,'DATE_FORMAT(tgl_logbook,"%Y-%m")'=>'2024-12');
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_logbook,concat(nama_kewenangan,' - ',nama_kompetensi) as nama_kewenangan";
	//	$fields = "*";
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
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
//$this->db->where('id_logbooker', 1);
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
$this->db->where('ol_logbook.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_logbook_pasien');
	    $this->db->join('ol_pasien', 'ol_pasien.id_pasien=ol_logbook_pasien.id_pasien','left');
	    $this->db->join('ol_logbook', 'ol_logbook.id_logbook=ol_logbook_pasien.id_logbook','left');
	    $this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
	    $this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
	//	$this->db->where("lp.id_logbooker", $this->session->id_pegawai);
$this->db->where('ol_logbook.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
	 //   $this->db->from('ol_pasien');
	//    $this->db->where('id_logbooker', 1);

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
//$this->db->where('id_logbooker', 1);
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
$this->db->where('ol_logbook.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
			}
		  }
		}

	    $this->db->from('ol_logbook_pasien');
	    $this->db->join('ol_pasien', 'ol_pasien.id_pasien=ol_logbook_pasien.id_pasien','left');
	    $this->db->join('ol_logbook', 'ol_logbook.id_logbook=ol_logbook_pasien.id_logbook','left');
	    $this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
	    $this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
$this->db->where('ol_logbook.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
	//    $this->db->from('ol_pasien');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
	//	$jml = $this->m_umum->jumlah_record_tabel('ol_pasien');		//[coding here] ganti tabel utamanya
		$jml = $this->m_umum->jumlah_record_tabel('ol_logbook_pasien');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	// ====================================== END KEUANGAN
	// ====================================== CLONE PROSES BUKU PUTIH
	function clone_proses_buku_putih()
	{
    $were = array('nkr_kompetensi.id_jabatan'=>19);
	//--------- Ambil nama kolom --------- [coding here]
	//	$fields = "*,DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_logbook,concat(nama_kewenangan,' - ',nama_kompetensi) as nama_kewenangan";
		$fields = "*,nkr_kompetensi.nama_kompetensi,nkr_kewenangan.nama_kewenangan,nkr_kewenangan.id_kewenangan,nkr_kewenangan.id_kompetensi,nkr_kewenangan.id_sifat_kewenangan,nkr_kewenangan.id_kode_kewenangan,nkr_kewenangan.creator_kewenangan,nkr_kewenangan.coun_kewenangan";
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
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
//$this->db->where('id_logbooker', 1);
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where($were);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

      $this->db->from('nkr_kewenangan');
      $this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
	    $this->db->where($were);

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
//$this->db->where('id_logbooker', 1);
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where($were);
			}
		  }
		}

      $this->db->from('nkr_kewenangan');
      $this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
	    $this->db->where($were);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('nkr_kewenangan');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
function source_buku_putih()
{
    $this->db->select('
        kkd.id_kewenangan,
        nk.nama_kompetensi,
        kw.id_kompetensi,
        kkd.id_sifat_kewenangan,
        kkd.id_kode_kewenangan,
        kw.nama_kewenangan
    ');
    $this->db->from('kr_kewenangan kw');
    $this->db->join('kr_kewenangan_detil kkd', 'kkd.id_kewenangan = kw.id_kewenangan', 'inner');
    $this->db->join('kr_kompetensi kk', 'kk.id_kompetensi = kw.id_kompetensi', 'inner');
    $this->db->join('nkr_kompetensi nk', 'nk.nama_kompetensi = kk.nama_kompetensi', 'inner');
    $this->db->where('kk.id_jabatan', 19);
    $this->db->group_by('kkd.id_kewenangan');
    $this->db->order_by('nk.nama_kompetensi', 'ASC');

    return $this->db->get()->result_array();
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
/*function get_proses_buku_putih(){   // main
	$sources = $this->source_buku_putih();
	foreach($sources as $rowsources){
		$kode = $this->kode_generator_kewenangan(15,'KW');
		$id_kewenangan = $kode;
		$creator_kewenangan = 1;
		$wkt_kewenangan = 15;
		$id_kompetensi = $rowsources['id_kompetensi'];
		$id_sifat_kewenangan = $rowsources['id_sifat_kewenangan'];
		$id_kode_kewenangan = $rowsources['id_kode_kewenangan'];
		$nama_kewenangan = $rowsources['nama_kewenangan'];
		$this->simpan_buku_putih($id_kewenangan,$id_kompetensi,$id_sifat_kewenangan,$id_kode_kewenangan,$nama_kewenangan);
	}
}*/
function get_proses_buku_putih()
{
    $sources = $this->source_buku_putih();
    if (empty($sources)) return false;

    $this->db->trans_start();

    foreach ($sources as $row) {
        $this->simpan_buku_putih(
            $this->kode_generator_kewenangan(15,'KW'),
            $row['id_kompetensi'],
            $row['id_sifat_kewenangan'],
            $row['id_kode_kewenangan'],
            $row['nama_kewenangan']
        );
    }

    $this->db->trans_complete();
    return true;
}
function simpan_buku_putih(
    $id_kewenangan,
    $id_kompetensi,
    $id_sifat_kewenangan,
    $id_kode_kewenangan,
    $nama_kewenangan
){
    $data = array(
        'id_kewenangan'       => $id_kewenangan,
        'creator_kewenangan'  => 1,
        'id_kompetensi'       => $id_kompetensi,
        'id_kode_kewenangan'  => $id_kode_kewenangan,
        'nama_kewenangan'     => $nama_kewenangan,
        'id_sifat_kewenangan' => $id_sifat_kewenangan,
        'wkt_kewenangan'      => 15
    );

    return $this->db->insert('nkr_kewenangan', $data);
}

/*  function simpan_buku_putih($id_kewenangan,$id_kompetensi,$id_sifat_kewenangan,$id_kode_kewenangan,$nama_kewenangan){
    $data_pendaftaran = array(
      'id_kewenangan' => $id_kewenangan,
      'creator_kewenangan' => 1,
      'id_kompetensi' => $id_kompetensi,
      'id_kode_kewenangan' => $id_kode_kewenangan,
      'nama_kewenangan' => $nama_kewenangan,
      'id_sifat_kewenangan'  => $id_sifat_kewenangan
    );
    $this->db->insert('nkr_kewenangan', $data_pendaftaran);
  }*/
	// ====================================== CLONE PROSES BUKU PUTIH
	// ====================================== CLONE PROSES UMUM
	function clone_proses_umum_all()
	{
    $were = array('DATE_FORMAT(tgl_per_imqc_hasil,"%Y-%m")'=>'2025-06');
	//--------- Ambil nama kolom --------- [coding here]
	//	$fields = "*,DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_logbook,concat(nama_kewenangan,' - ',nama_kompetensi) as nama_kewenangan";
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
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
//$this->db->where('id_logbooker', 1);
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where($were);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

      $this->db->from('ol_per_imqc_hasil');
      $this->db->join('ol_per_imqc_detil', 'ol_per_imqc_detil.id_per_imqc_detil=ol_per_imqc_hasil.id_per_imqc_detil','left');
      $this->db->join('ol_per_imqc', 'ol_per_imqc.id_per_imqc=ol_per_imqc_detil.id_per_imqc','left');
      $this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=ol_per_imqc_hasil.barcode_pegawai','left');
	    $this->db->where($were);

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
//$this->db->where('id_logbooker', 1);
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where($were);
			}
		  }
		}

      $this->db->from('ol_per_imqc_hasil');
      $this->db->join('ol_per_imqc_detil', 'ol_per_imqc_detil.id_per_imqc_detil=ol_per_imqc_hasil.id_per_imqc_detil','left');
      $this->db->join('ol_per_imqc', 'ol_per_imqc.id_per_imqc=ol_per_imqc_detil.id_per_imqc','left');
      $this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=ol_per_imqc_hasil.barcode_pegawai','left');
	    $this->db->where($were);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('ol_per_imqc_hasil');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
function source_lhu_umum(){
  $this->db->join('ol_logbook_lhu', 'ol_logbook_lhu.id_lhu=ol_logbook_lhu_detil.id_lhu','left');
  $this->db->join('ol_logbook_item_lhu', 'ol_logbook_item_lhu.id_item_lhu=ol_logbook_lhu_detil.id_item_lhu','left');
  $q = $this->db->get_where('ol_logbook_lhu_detil');
//  echo $this->db->last_query();die();
  return $q->result_array();
}
function cari_lhu_umum($kondisi){
//	$this->db->select("*,ol_per_imqc_detil.id_per_imqc_detil as id_per_imqc_detil");
  $this->db->join('ol_per_imqc', 'ol_per_imqc.id_per_imqc=ol_per_imqc_detil.id_per_imqc','left');
  $q = $this->db->get_where('ol_per_imqc_detil',$kondisi);
 // echo $this->db->last_query();die();
  return $q->row_array();
}
function get_proses_logbook_lhu_umum(){   // main
	$sources = $this->source_lhu_umum();
	foreach($sources as $rowsources){
		$kode = $this->m_rancak->kode_generator_urut(15,'IQ');
		$id_per_imqc_hasil = $kode;
		$knds = array('nama_per_imqc_detil'=>$rowsources['nama_item_lhu'],'ol_per_imqc_detil.id_per_imqc'=>$rowsources['id_equipment']);
		$look = $this->cari_lhu_umum($knds);
		$barcode_pegawai = $rowsources['barcode_pegawai'];
		$id_per_imqc_detil = $look['id_per_imqc_detil'];
		$tgl_per_imqc_hasil = $rowsources['tgl_lhu'];
		$hasil_per_imqc_hasil = $rowsources['hasil_lhu_detil'];
		$this->simpan_imqc_hasil($id_per_imqc_hasil,$barcode_pegawai,$id_per_imqc_detil,$tgl_per_imqc_hasil,$hasil_per_imqc_hasil);
	}
}
  function simpan_imqc_hasil($id_per_imqc_hasil,$barcode_pegawai,$id_per_imqc_detil,$tgl_per_imqc_hasil,$hasil_per_imqc_hasil){
    $data_pendaftaran = array(
      'id_per_imqc_hasil' => $id_per_imqc_hasil,
      'barcode_pegawai' => $barcode_pegawai,
      'id_per_imqc_detil' => $id_per_imqc_detil,
      'tgl_per_imqc_hasil' => $tgl_per_imqc_hasil,
      'hasil_per_imqc_hasil'  => $hasil_per_imqc_hasil
    );
    $this->db->insert('ol_per_imqc_hasil', $data_pendaftaran);
  }
	// ====================================== !CLONE PROSES UMUM
	function kode_generator($length,$no)
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
		$kode = $no . $randomString ."-". $thn . $bln. $tgl . $jam . $mnt . $sec;
		return $kode;
	}
  function clone_proses_logbook_all()
  {
    $were = array('id_logbooker'=>1,'DATE_FORMAT(tgl_logbook,"%Y-%m")'=>'2025-10');
  //  $were = array('id_logbooker'=>11,'YEAR(tgl_logbook)'=>'2025');
  //  $were = array('YEAR(tgl_lhu)'=>'2025');
  //  $were = array('id_logbooker'=>6);
  //--------- Ambil nama kolom --------- [coding here]
  //  $fields = "*,DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_logbook,concat(nama_kewenangan,' - ',nama_kompetensi) as nama_kewenangan";
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
        switch($k['data']){   //beberapa field ambigius, so sesuaikan [coding here]
          // case 'id_level'   : $nmf="u.id_level";break;
        default: $nmf=$k['data'];
//$this->db->where('id_logbooker', 1);
        }
        $this->db->or_like($nmf, $cari['value'],'both',false);
        $this->db->where($were);
      }
      }
    }
    $this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

      $this->db->from('ol_logbook_pasien');
 //     $this->db->from('ol_pasien');
  //    $this->db->from('ol_logbook');
      $this->db->join('ol_pasien', 'ol_pasien.id_pasien=ol_logbook_pasien.id_pasien','left');
      $this->db->join('ol_logbook', 'ol_logbook.id_logbook=ol_logbook_pasien.id_logbook','left');
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_logbook.id_logbooker','left');      
      $this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
      $this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
      $this->db->join('kol_working', 'kol_working.id_working=ol_logbook.id_instansi','left');
      $this->db->where($were);

/*      $this->db->from('ol_logbook_lhu_detil');
      $this->db->join('ol_logbook_lhu', 'ol_logbook_lhu.id_lhu=ol_logbook_lhu_detil.id_lhu','left');
      $this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=ol_logbook_lhu.barcode_pegawai','left');
      $this->db->join('ol_logbook_item_lhu', 'ol_logbook_item_lhu.id_item_lhu=ol_logbook_lhu_detil.id_item_lhu','left');
      $this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_logbook_item_lhu.id_equipment','left');
      $this->db->where($were);*/

    $q = $this->db->limit($length,$start)->get_where(); //05 Execute

    $list=$q->result_array(); //06 Hasil

  //--------- Query jumlah filter untuk paging -----
    $this->db->select("COUNT(*) as num"); //01 Select

    if(!empty($cari['value'])) {    //02 Where
      foreach($dt_kolom as $k){
      if($k['searchable']=='true'){ //cek kalo searchable
        switch($k['data']){   //beberapa field ambigius, so sesuaikan  [coding here]
        //  case 'no_hp' : $nmf="peg.no_hp";break;
          default: $nmf=$k['data'];
//$this->db->where('id_logbooker', 1);
        }
        $this->db->or_like($nmf, $cari['value'],'both',false);
        $this->db->where($were);
      }
      }
    }

      $this->db->from('ol_logbook_pasien');
 //     $this->db->from('ol_pasien');
  //    $this->db->from('ol_logbook');
      $this->db->join('ol_pasien', 'ol_pasien.id_pasien=ol_logbook_pasien.id_pasien','left');
      $this->db->join('ol_logbook', 'ol_logbook.id_logbook=ol_logbook_pasien.id_logbook','left');
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_logbook.id_logbooker','left');      
      $this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
      $this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
      $this->db->join('kol_working', 'kol_working.id_working=ol_logbook.id_instansi','left');
      $this->db->where($were);

/*      $this->db->from('ol_logbook_lhu_detil');
      $this->db->join('ol_logbook_lhu', 'ol_logbook_lhu.id_lhu=ol_logbook_lhu_detil.id_lhu','left');
      $this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=ol_logbook_lhu.barcode_pegawai','left');
      $this->db->join('ol_logbook_item_lhu', 'ol_logbook_item_lhu.id_item_lhu=ol_logbook_lhu_detil.id_item_lhu','left');
      $this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_logbook_item_lhu.id_equipment','left');
      $this->db->where($were);*/

    $q = $this->db->get_where(); //04 Execute
    $jml_filter = $q->row()->num; //05 Hasil

  //--------- Query jumlah All data paling banyak -----
  //  $jml = $this->m_umum->jumlah_record_tabel('ol_logbook_lhu_detil');    //[coding here] ganti tabel utamanya
  //  $jml = $this->m_umum->jumlah_record_tabel('ol_pasien');   //[coding here] ganti tabel utamanya
    $jml = $this->m_umum->jumlah_record_tabel('ol_logbook_pasien');   //[coding here] ganti tabel utamanya

    $output = array(
      "draw" => $draw,
        "recordsTotal" => $jml,
        "recordsFiltered" => $jml_filter,
        "data" => $list
    );
    // print_r($output);die();
    return $output;
  }
  function clone_proses_pasien_all()
  {
  //  $were = array('id_logbooker'=>1,'DATE_FORMAT(tgl_logbook,"%Y-%m")'=>'2025-06');
  //  $were = array('id_logbooker'=>11,'YEAR(tgl_logbook)'=>'2025');
  //  $were = array('YEAR(tgl_lhu)'=>'2025');
  //  $were = array('id_logbooker'=>6);
  //--------- Ambil nama kolom --------- [coding here]
  //  $fields = "*,DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_logbook,concat(nama_kewenangan,' - ',nama_kompetensi) as nama_kewenangan";
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
        switch($k['data']){   //beberapa field ambigius, so sesuaikan [coding here]
          // case 'id_level'   : $nmf="u.id_level";break;
        default: $nmf=$k['data'];
//$this->db->where('id_logbooker', 1);
        }
        $this->db->or_like($nmf, $cari['value'],'both',false);
     //   $this->db->where($were);
      }
      }
    }
    $this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

 //     $this->db->from('ol_logbook_pasien');
      $this->db->from('ol_pasien');
  //    $this->db->from('ol_logbook');
/*      $this->db->join('ol_pasien', 'ol_pasien.id_pasien=ol_logbook_pasien.id_pasien','left');
      $this->db->join('ol_logbook', 'ol_logbook.id_logbook=ol_logbook_pasien.id_logbook','left');
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_logbook.id_logbooker','left');      
      $this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
      $this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
      $this->db->join('kol_working', 'kol_working.id_working=ol_logbook.id_instansi','left');
      $this->db->where($were);*/

/*      $this->db->from('ol_logbook_lhu_detil');
      $this->db->join('ol_logbook_lhu', 'ol_logbook_lhu.id_lhu=ol_logbook_lhu_detil.id_lhu','left');
      $this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=ol_logbook_lhu.barcode_pegawai','left');
      $this->db->join('ol_logbook_item_lhu', 'ol_logbook_item_lhu.id_item_lhu=ol_logbook_lhu_detil.id_item_lhu','left');
      $this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_logbook_item_lhu.id_equipment','left');
      $this->db->where($were);*/

    $q = $this->db->limit($length,$start)->get_where(); //05 Execute

    $list=$q->result_array(); //06 Hasil

  //--------- Query jumlah filter untuk paging -----
    $this->db->select("COUNT(*) as num"); //01 Select

    if(!empty($cari['value'])) {    //02 Where
      foreach($dt_kolom as $k){
      if($k['searchable']=='true'){ //cek kalo searchable
        switch($k['data']){   //beberapa field ambigius, so sesuaikan  [coding here]
        //  case 'no_hp' : $nmf="peg.no_hp";break;
          default: $nmf=$k['data'];
//$this->db->where('id_logbooker', 1);
        }
        $this->db->or_like($nmf, $cari['value'],'both',false);
   //     $this->db->where($were);
      }
      }
    }

 //     $this->db->from('ol_logbook_pasien');
      $this->db->from('ol_pasien');
  //    $this->db->from('ol_logbook');
/*      $this->db->join('ol_pasien', 'ol_pasien.id_pasien=ol_logbook_pasien.id_pasien','left');
      $this->db->join('ol_logbook', 'ol_logbook.id_logbook=ol_logbook_pasien.id_logbook','left');
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_logbook.id_logbooker','left');      
      $this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
      $this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
      $this->db->join('kol_working', 'kol_working.id_working=ol_logbook.id_instansi','left');
      $this->db->where($were);*/

/*      $this->db->from('ol_logbook_lhu_detil');
      $this->db->join('ol_logbook_lhu', 'ol_logbook_lhu.id_lhu=ol_logbook_lhu_detil.id_lhu','left');
      $this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=ol_logbook_lhu.barcode_pegawai','left');
      $this->db->join('ol_logbook_item_lhu', 'ol_logbook_item_lhu.id_item_lhu=ol_logbook_lhu_detil.id_item_lhu','left');
      $this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_logbook_item_lhu.id_equipment','left');
      $this->db->where($were);*/

    $q = $this->db->get_where(); //04 Execute
    $jml_filter = $q->row()->num; //05 Hasil

  //--------- Query jumlah All data paling banyak -----
  //  $jml = $this->m_umum->jumlah_record_tabel('ol_logbook_lhu_detil');    //[coding here] ganti tabel utamanya
    $jml = $this->m_umum->jumlah_record_tabel('ol_pasien');   //[coding here] ganti tabel utamanya
  //  $jml = $this->m_umum->jumlah_record_tabel('ol_logbook_pasien');   //[coding here] ganti tabel utamanya

    $output = array(
      "draw" => $draw,
        "recordsTotal" => $jml,
        "recordsFiltered" => $jml_filter,
        "data" => $list
    );
    // print_r($output);die();
    return $output;
  }
	function clone_proses_lhu_all()
	{
    $were = array('DATE_FORMAT(tgl_eq_imut,"%Y-%m")'=>'2025-12','id_pegawai'=>2);
	//--------- Ambil nama kolom --------- [coding here]
	//	$fields = "*,DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_logbook,concat(nama_kewenangan,' - ',nama_kompetensi) as nama_kewenangan";
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
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
//$this->db->where('id_logbooker', 1);
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where($were);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

      $this->db->from('ol_eq_imut');
      $this->db->join('ol_eq_detil', 'ol_eq_detil.id_eq_detil=ol_eq_imut.id_eq_detil','left');
      $this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_eq_detil.id_equipment','left');
      $this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=ol_eq_imut.barcode_pegawai','left');
	    $this->db->where($were);

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
//$this->db->where('id_logbooker', 1);
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where($were);
			}
		  }
		}

      $this->db->from('ol_eq_imut');
      $this->db->join('ol_eq_detil', 'ol_eq_detil.id_eq_detil=ol_eq_imut.id_eq_detil','left');
      $this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_eq_detil.id_equipment','left');
      $this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=ol_eq_imut.barcode_pegawai','left');
      $this->db->where($were);
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('ol_eq_imut');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
//========================= Quality Control
function get_proses_logbook_lhu(){   // main
  $awal = '2025-12-01';
  $akhir = '2026-01-01';
  $idpeg = '2';
  $peg = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$idpeg);
  $begin = new DateTime($awal);
  $end = new DateTime($akhir);
  $interval = DateInterval::createFromDateString('1 day');
  $period = new DatePeriod($begin, $interval, $end);
  foreach ($period as $dt) {    
      $tgl_eq_imut = $dt->format("Y-m-d");
      $values = range(40, 92);
      foreach($values as $rs){
      $lhue = $this->m_umum->ambil_data('ol_eq_detil','coun_eq_detil',$rs);
        $this->simpan_indikator_mutu_detil($peg['barcode_pegawai'],$lhue['id_eq_detil'],$tgl_eq_imut,$rs);
      }
      
  }
}
  function simpan_indikator_mutu_detil($barcode_pegawai,$id_eq_detil,$tgl_eq_imut,$rs){
    $kode = $this->m_rancak->kode_generator_urut(15,'XN');
    if($rs >= 40 && $rs <= 47){
      $min_suhu=17;
      $max_suhu=23;
      $yn_eq_imut=0;
      $hasil_eq_imut = rand($min_suhu,$max_suhu);
    }else if($rs >= 48 && $rs <= 55){
      $min_kelembaban=50;
      $max_kelembaban=70;
       $yn_eq_imut=0;
      $hasil_eq_imut = rand($min_kelembaban,$max_kelembaban);
    }
    else{
       $yn_eq_imut=1;
      $hasil_eq_imut = 1;
    }
    $data_pendaftaran = array(
      'barcode_pegawai' => $barcode_pegawai,
      'id_eq_imut' => $kode,
      'id_eq_detil' => $id_eq_detil,
      'tgl_eq_imut' => $tgl_eq_imut,
      'yn_eq_imut' => $yn_eq_imut,
      'hasil_eq_imut' => $hasil_eq_imut
    );
    return $this->db->insert('ol_eq_imut', $data_pendaftaran);
    // $this->db->insert_id();
  }
/*  function clone_proses(){
    $this->get_proses_logbook_lhu();
  }*/
//========================= OL_PASIEN BARU
	function source_pasien2(){
 	//	$this->db->group_by('rm');
 	//	$this->db->where('rm IS NULL', null, false);
		$q = $this->db->get_where('ol_pasien2');
		return $q->result_array();
	}
function clone_proses_pasien(){   // main
$sources = $this->source_pasien2();
	foreach($sources as $rowsources){
	//	$jml = $this->m_umum->ambil_data('ol_pasien2');
		$kondis = array('rm'=>$rowsources['rm']);
		$countint = $this->m_umum->jumlah_record_filter('ol_pasien',$kondis);
		if($countint == 0){
$this->simpen_pasien($rowsources['nama_pasien'],$rowsources['tgl_lahir'],$rowsources['jk'],$rowsources['alamat'],$rowsources['rm']);			
		}else{
$this->edit_pasien($rowsources['nama_pasien'],$rowsources['tgl_lahir'],$rowsources['jk'],$rowsources['alamat'],$rowsources['rm']);	
		}
	}
}
	function simpen_pasien($nama_pasien,$tgl_lahir,$jk,$alamat,$rm){
		$kode = $this->m_rancak->kode_generator_urut(15,'PS');
		$data_pendaftaran = array(
			'id_pasien' => $kode,					
			'nama_pasien' => $nama_pasien,								
			'jk' => $jk,								
			'alamat' => $alamat,								
			'rm' => $rm,								
			'tgl_lahir' => $tgl_lahir
		);
		return $this->db->insert('ol_pasien', $data_pendaftaran);
	}
	function edit_pasien($nama_pasien,$tgl_lahir,$jk,$alamat,$rm){
		$data_pendaftaran = array(
			'nama_pasien' =>$nama_pasien,
			'tgl_lahir' =>$tgl_lahir,
			'jk' =>$jk,
			'alamat' =>$alamat
		);
		$this->db->where('rm',$rm);
		$this->db->update('ol_pasien', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
//=========================
function clone_proses_logbook(){    // main 
//========================= (1) LAB
/*  $pmr_array = ['20241218090912KWDaxEbCRpmpfqryC','20241218090445KWCJDlIOmIahAcYim','20241218090532KWSI3bOmX7a6aBhwu','20241218090654KWJ2WSQudcr48qQeb'];
  $jml_array = array('1'); // jml pasien
  $jml_pmr = '10';
  $idp = '1';
  $id_instansi = '3';*/
//========================= (1)
	$pmr_array = ['1','2','8','9','10','16','21','22','24','25','26','27','28','29','30','34','35','36','37','38','39','47','70','73','78','87','99','100','101'];
	$jml_array = array('1'); // jml pasien
	$jml_pmr = '10';
	$idp = '1';
  $id_instansi = '1';
//========================= NUNUNG (11)
/*	$pmr_array = ['1','2','8','9','10','16','21','22','24','25','26','27','28','29','30','34','35','36','37','38','39','47','70','73','78','87','99','100','101','131','175','176','177'];
	$jml_array = array('1'); // jml pasien
	$jml_pmr = '10';
	$idp = '11';
  $id_instansi = '1';*/
//========================= YUDI (6) ISNA (3)
//	$pmr_array = ['70','73','78','87','99','100','101','131','175','176','177']; // canggih
//	$jml_array = array('1'); // jml pasien
//	$jml_pmr = '7';
//	$idp = '11';
//	$pmr_array = ['1','2','8','9','10','16','21','22','24','25','26','27','28','29','30','34','35','36','37','38','39','47']; // konvensional
//	$jml_array = array('1'); // jml pasien
//	$jml_pmr = '10';
//	$idp = '11';
//  $id_instansi = '1';
//========================= YUDI (6) ISNA (3) NUNUNG (11)
//$pmr_array = ['1','2','8','9','10','20','21','24','25','26','27','28','29','33','34','35','36','37','38','39','47'];
//$pmr_array = array("1","8","9","10","16","21","22","24","25","26","27","28","29","30","34","35","36","37","38","39","47","70","73","78","87","99","100","101");
//$pmr_array = array("16","70","73","78","87","99","100","101");
//$jml_array = array("1","2","3");
//$jml_array = ['1','2','3','4','5'];
//========================= OPSI
// JAN1 = 31, FEB2 = 28, MAR3 = 31, APR4 = 30, MEI5 = 31, JUN6 = 30, JUL7 = 31, AGS8 = 31, SEP9 = 30, OKT10 = 31, NOP11 = 30, DES12 = 31
$awal = '2025-12-01';
$akhir = '2026-01-01';
$id_unit = '20240617214154OU7Sej9gxRT1iLmQr';
$id_sifat_kewenangan = '1';
$this->manipulate($jml_pmr,$awal,$akhir,$pmr_array,$jml_array,$idp,$id_instansi,$id_sifat_kewenangan,$id_unit);
}
function manipulate($jml_pmr,$awal,$akhir,$pmr_array,$jml_array,$idp,$id_instansi,$id_sifat_kewenangan,$id_unit){
	//$end = new DateTime('2023-12-31');
	$begin = new DateTime($awal);
	$end = new DateTime($akhir);
	$interval = DateInterval::createFromDateString('1 day');
	$period = new DatePeriod($begin, $interval, $end);
	// Mon (Senin), Tue (Selasa), Wed (Rabu), Thu (Kamis), Fri (Jumat), Sat (Sabtu), Sun (Minggu)
	foreach ($period as $dt) {		
		$tmp_date = $dt->format("Y-m-d");
		$weekday = date('D', strtotime($tmp_date)); 
		// ============================= YUDI KONVENSIONAL
//	if (strcasecmp($weekday, 'Sun') != 0 && strcasecmp($weekday, 'Mon') != 0 && strcasecmp($weekday, 'Tue') != 0 && strcasecmp($weekday, 'Wed') != 0 && strcasecmp($weekday, 'Thu') != 0){
		// ============================= YUDI KONTRAS
//	if (strcasecmp($weekday, 'Sun') != 0 && strcasecmp($weekday, 'Mon') != 0 && strcasecmp($weekday, 'Fri') != 0 && strcasecmp($weekday, 'Sat') != 0 ){
		// =============================
		if (strcasecmp($weekday, 'Sun') != 0){	
//		if (strcasecmp($weekday, 'Sun') != 0 && strcasecmp($weekday, 'Sat') != 0){
	//	if (strcasecmp($weekday, 'Mon') != 0 && strcasecmp($weekday, 'Tue') != 0 && strcasecmp($weekday, 'Wed') != 0){
		   $cr_date = $dt->format("Y-m-d"); // echo $dt->format("l Y-m-d H:i:s\n");//16 = thx
			for ($i=0; $i<$jml_pmr; $i++) {
			   $hur_ite = array_rand($pmr_array, 1);
			   $hur_it = $pmr_array[$hur_ite];
			   $ang_ite = array_rand($jml_array, 1);
			   $ang_it = $jml_array[$ang_ite];
			   $Q = $this->simpen_logbuk($cr_date,$hur_it,$ang_it,$idp,$id_instansi,$id_sifat_kewenangan,$id_unit);
			   for ($j=0; $j<$ang_it; $j++) {
			   	$id_px = $this->cari_pasien();
			//	$this->simpen_px($id_px['id_pasien'],$Q);
			   }
			}
		}
	}
}
 	function simpen_logbuk($tgl_logbook,$id_kewenangan,$jml_logbook,$id_pegawai,$id_instansi,$id_sifat_kewenangan,$id_unit){
 		$kodeid = $this->m_rancak->kode_generator_urut(15,'LB');
 		$kode = $this->m_rancak->kode_generator(15,'LB');
		$data_pendaftaran = array(
			'id_logbook' => $kodeid,
			'id_kewenangan' => $id_kewenangan,
			'id_instansi' => $id_instansi,
			'id_unit' => $id_unit,
			'jml_logbook' => $jml_logbook,
			'id_sifat_kewenangan' => $id_sifat_kewenangan,
			'barcode_logbook' => $kode,
			'tgl_logbook' => $tgl_logbook,
			'id_logbooker' => $id_pegawai
		);
		$this->db->insert('ol_logbook', $data_pendaftaran);
		return $kodeid;
	}
 	function cari_pasien(){
 	//	$this->db->group_by('rm');
 		$this->db->order_by("id_pasien", "random");
		$q = $this->db->get_where('ol_pasien');
		return $q->row_array();
	}
	function simpen_px($id,$id_logbook){
		$kode = $this->m_rancak->kode_generator_urut(15,'PS');
		$data_pendaftaran = array(
			'id_logbook_pasien' => $kode,					
			'id_pasien' => $id,								
			'id_logbook' => $id_logbook
		);
		return $this->db->insert('ol_logbook_pasien', $data_pendaftaran);
	}
/*	
// ===========================================
 	function source(){
 	//	$this->db->group_by('rm');
 		$this->db->where('rm IS NULL', null, false);
		$q = $this->db->get_where('ol_pasien');
		return $q->result_array();
	}
	function clone_proses_pengajuan(){
	$sources = $this->source();
		foreach($sources as $rowsources){
			$kondis = array('nama_pasien'=>$rowsources['nama_pasien'],'tgl_lahir'=>$rowsources['tgl_lahir'],'alamat'=>$rowsources['alamat'],'jk'=>$rowsources['jk']);
			$jml = $this->m_umum->ambil_data_kondisi('ol_pasien3',$kondis);
			$nama_pasien = $rowsources['nama_pasien'];
			$this->edit_kewenangan($jml['nama_pasien'],$jml['tgl_lahir'],$jml['jk'],$jml['alamat'],$jml['rm']);				
		}
	}
	function edit_kewenangan($nama_pasien,$tgl_lahir,$jk,$alamat,$rm){
		$data_pendaftaran = array(
			'rm' =>$rm
		);
		$this->db->where('nama_pasien',$nama_pasien);
		$this->db->where('tgl_lahir',$tgl_lahir);
		$this->db->where('jk',$jk);
		$this->db->where('alamat',$alamat);
		$this->db->update('ol_pasien', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}	
	function clone_proses(){
		$this->clone_proses_pengajuan();
	}

	function source(){
		$q = $this->db->get_where('ol_logbook',array('id_logbooker'=>1));
		return $q->result_array();
	}
	function clone_proses(){
		$this->clone_proses_pengajuan();
	}
	function clone_proses_pengajuan(){
	$sources = $this->source();
		foreach($sources as $rowsources){
			$id_kewenangan = $rowsources['id_kewenangan'];
			$jml_logbook = $rowsources['jml_logbook'];
			$tgl_logbook = $rowsources['tgl_logbook'];
			$kodeid = $this->m_rancak->kode_generator_urut(15,'LB');
			$kode = $this->m_rancak->kode_generator(15,'LB');
			$this->simpan_kewenangan_bk($kodeid,$kode,$id_kewenangan,$tgl_logbook,$jml_logbook);
		}
	}
	function simpan_kewenangan_bk($nama_pasien,$rm,$tgl_lahir,$jk,$alamat){
		$kode = $this->m_rancak->kode_generator(15,'PS');
			$data_pendaftaran = array(
				'id_pasien' => $kode,
				'nama_pasien' => $nama_pasien,
				'rm' => $rm,
				'tgl_lahir' => $tgl_lahir,
				'jk' => $jk,
				'alamat' => $alamat
			);
			$this->db->insert('ol_pasien', $data_pendaftaran);
			$this->m_umum->hapus_data('ol_pasien2','rm',$rm);
	}
	function simpan_kewenangan_bk($kodeid,$kode,$id_kewenangan,$tgl,$jml_logbook){
			$data_pendaftaran = array(
				'id_logbook' => $kodeid,
				'barcode_logbook' => $kode,
				'id_logbooker' => 11,
				'id_instansi' => 1,
				'id_kewenangan' => $id_kewenangan,
				'tgl_logbook' => $tgl,
				'jml_logbook' => $jml_logbook
			);
			return $this->db->insert('ol_logbook', $data_pendaftaran);
	}
	function clone_proses_pengajuan(){
	$sources = $this->source();
		foreach($sources as $rowsources){
			$kondis = array('rm'=>$rowsources['rm']);
			$jml = $this->m_umum->jumlah_record_filter('ol_pasien',$kondis);
			if($jml == 0){
			$nama_pasien = $rowsources['nama_pasien'];
			$rm = $rowsources['rm'];
			$tgl_lahir = $rowsources['tgl_lahir'];
			$jk = $rowsources['jk'];
			$alamat = $rowsources['alamat'];
			$this->simpan_kewenangan_bk($nama_pasien,$rm,$tgl_lahir,$jk,$alamat);				
			}else{
				$this->m_umum->hapus_data('ol_pasien2','rm',$rowsources['rm']);
			}
		}
	}
	function edit_kewenangan($id_pegawai,$username,$password){
		$data_pendaftaran = array(
			'username' =>$username,
			'password' =>$password
		);
		$this->db->where('id_pegawai',$id_pegawai);
		$this->db->update('ol_user', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
 	function source(){
		$q = $this->db->get_where('butir_kegiatan');
		return $q->result_array();
	}
	function clone_proses_pengajuan(){
	$sources = $this->source();
		foreach($sources as $rowsources){
			$nama_butir_kegiatan = $rowsources['nama_butir_kegiatan'];
			$id_butir_kegiatan = $rowsources['id_butir_kegiatan'];
			$last = $this->simpan_kewenangan($nama_butir_kegiatan);
			$this->simpan_kewenangan_bk($last,$id_butir_kegiatan);
		}
	}
	function simpan_kewenangan($id){
			$data_pendaftaran = array(
				'nama_kewenangan' => $id
			);
			$this->db->insert('ol_kewenangan', $data_pendaftaran);
			return $this->db->insert_id();
	}
	function simpan_kewenangan_bk($id,$id2){
			$data_pendaftaran = array(
				'id_kewenangan' => $id,
				'id_butir_kegiatan' => $id2
			);
			$this->db->insert('ol_kewenangan_bk', $data_pendaftaran);
			return $this->db->insert_id();
	}		
	function edit_kewenangan($id_kewenangan,$id_sifat_kewenangan,$id_kode_kewenangan){
		$data_pendaftaran = array(
			'id_sifat_kewenangan' =>$id_sifat_kewenangan,
			'id_kode_kewenangan' =>$id_kode_kewenangan
		);
		$this->db->where('id_kewenangan',$id_kewenangan);
		$this->db->update('kr_kewenangan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}

	function clone_proses(){
		$this->clone_proses_pengajuan();
	}
 	function source(){
		$q = $this->db->get_where('ol_kewenangan_detil');
		return $q->result_array();
	}
	function clone_proses_pengajuan(){
	$sources = $this->source();
		foreach($sources as $rowsources){
			$id_kewenangan = $rowsources['id_kewenangan'];
			$id_sifat_kewenangan = $rowsources['id_sifat_kewenangan'];
			$id_kode_kewenangan = $rowsources['id_sifat_kewenangan'];
			$this->edit_kewenangan($id_kewenangan,$id_sifat_kewenangan,$id_kode_kewenangan);
		}
	}
	function edit_kewenangan($id_kewenangan,$id_sifat_kewenangan,$id_kode_kewenangan){
		$data_pendaftaran = array(
			'id_sifat_kewenangan' =>$id_sifat_kewenangan,
			'id_kode_kewenangan' =>$id_kode_kewenangan
		);
		$this->db->where('id_kewenangan',$id_kewenangan);
		$this->db->update('ol_kewenangan2', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
		
 	function source(){
		$q = $this->db->get_where('pegawai');
		return $q->result_array();
	}
 	function sourceb($id){
	//	$this->db->order_by('id_user', 'asc');
	//	$this->db->group_by('id_pegawai');
		$q = $this->db->get_where('user',array('id_pegawai'=>$id));
		return $q->row_array();
	}
	function clone_proses(){
		$this->clone_proses_pengajuan();
	}
	function clone_proses_pengajuan(){
	$sources = $this->source();
		foreach($sources as $rowsources){
			$sourcesb = $this->sourceb($rowsources['id_pegawai']);
			$id_pegawai = $sourcesb['id_pegawai'];
			$username = $sourcesb['username'];
			$password = $sourcesb['password'];
			$id_level = $sourcesb['id_level'];
			$this->edit_pengajuan_logbook($id_pegawai,$username,$password,$id_level);
		}
	}
	function edit_pengajuan_logbook($id_pegawai,$username,$password,$id_level){
		$data_pendaftaran = array(
			'username' =>$username,
			'password' =>$password,
			'id_level' =>$id_level
		);
		$this->db->where('id_pegawai',$id_pegawai);
		$this->db->update('pegawaib', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}

 	function sourceb(){
		$q = $this->db->get_where('logbook');
		return $q->result_array();
	}
	function clone_proses_pengajuan(){
	$sources = $this->source();
		foreach($sources as $rowsources){
			$id_pengajuan = $rowsources['id_pengajuan'];
			$id_pegawai = $rowsources['id_pegawai'];
			$id_logbook_a = $rowsources['id_logbook_a'];
			$id_logbook_b = $rowsources['id_logbook_b'];
			if(!empty($id_logbook_a) AND !empty($id_logbook_b)){
				$this->edit_pengajuan_logbook($id_pegawai,$id_pengajuan,$id_logbook_a,$id_logbook_b);
			}
		}
	}
	function edit_pengajuan_logbook($id_pegawai,$id_pengajuan,$id_logbook_a,$id_logbook_b){
		$data_pendaftaran = array(
			'id_pengajuan' =>$id_pengajuan
		);
		$this->db->where('id_logbook BETWEEN "'.$id_logbook_a. '" and "'.$id_logbook_b.'"');
		$this->db->where('id_pegawai',$id_pegawai);
		$this->db->where('id_pengajuan','0');
		$this->db->update('Logbook', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	
	function clone_proses(){
		$this->clone_proses_tindakan();
	}

	function clone_proses_tindakan(){
	$sources = $this->source();
		foreach($sources as $rowsources){
			$id_tindakan = $rowsources['id_tindakan'];
			$nama_tindakan = $rowsources['nama_tindakan'];
			$status_tindakan = $rowsources['status_tindakan'];
			$id_golongan_pemeriksaan = $this->swic($rowsources['id_kompetensi']);
			$data_pendaftaran = array(
				'id_tindakan' => $id_tindakan,
				'nama_tindakan' => $nama_tindakan,
				'status_tindakan' => $status_tindakan,
				'id_golongan_pemeriksaan' =>$id_golongan_pemeriksaan
			);
			$this->db->insert('tindakanb', $data_pendaftaran);
		}
	}
	function swic($id){
			switch ($id){
					case 30:
						return 1;
						break;
					case 2:
						return 5;
						break;
					case 31:
						return 2;
						break;
					case 32:
						return 3;
						break;
					case 33:
						return 7;
						break;
					case 34:
						return 10;
						break;
			}
	}

	function clone_proses_pengajuan(){
	$sources = $this->source();
		foreach($sources as $rowsources){
			$kode = $this->m_rancak->kode_generator(15,'PK');
			$id_pengajuan = $rowsources['id_pengajuan'];
			$tgl_pengajuan = $rowsources['tgl_pengajuan'];
			$id_pegawai = $rowsources['id_pegawai'];
			$id_status_diusulkan = $rowsources['id_status_diusulkan'];
			$id_berkas = $rowsources['id_berkas'];
			$id_ijasah = $rowsources['id_ijasah'];
			$id_str = $rowsources['id_str'];
			$id_logbook_a = $rowsources['id_logbook_a'];
			$id_logbook_b = $rowsources['id_logbook_b'];
			$id_sertifikat = $rowsources['id_sertifikat'];
			$id_etik_pegawai = $rowsources['id_etik_pegawai'];
			$status_pengajuan = $rowsources['status_pengajuan'];
			$kesesuaian_bukti = $rowsources['kesesuaian_bukti'];
			$acc_kabid = $rowsources['acc_kabid'];
			$acc_asesor = $rowsources['acc_asesor'];
			$acc_komite = $rowsources['acc_komite'];
			$acc_direktur = $rowsources['acc_direktur'];
			$id_kabid = $rowsources['id_kabid'];
			$id_asesor = $rowsources['id_asesor'];
			$id_komite = $rowsources['id_komite'];
			$id_direktur = $rowsources['id_direktur'];
			$tgl_acc_kabid = $rowsources['tgl_acc_kabid'];
			$tgl_acc_asesor = $rowsources['tgl_acc_asesor'];
			$tgl_acc_komite = $rowsources['tgl_acc_komite'];
			$tgl_acc_direktur = $rowsources['tgl_acc_direktur'];
			$acc_logbook_kabid = $rowsources['acc_logbook_kabid'];
			$acc_logbook_asesor = $rowsources['acc_logbook_asesor'];
			$acc_logbook_komite = $rowsources['acc_logbook_komite'];
			$acc_logbook_direktur = $rowsources['acc_logbook_direktur'];
			$kredensial = $rowsources['kredensial'];
			$mutu = $rowsources['mutu'];
			$etika = $rowsources['etika'];
			$tgl_kredensial = $rowsources['tgl_kredensial'];
			$tgl_mutu = $rowsources['tgl_mutu'];
			$tgl_etika = $rowsources['tgl_etika'];
			$id_kredensial = $rowsources['id_kredensial'];
			$id_mutu = $rowsources['id_mutu'];
			$id_etika = $rowsources['id_etika'];
			$id_level = $rowsources['id_level'];
			$status_terbitkan = $rowsources['status_terbitkan'];
			$data_pendaftaran = array(
				'id_pengajuan' => $id_pengajuan,
				'tgl_pengajuan' => $tgl_pengajuan,
				'id_pegawai' => $id_pegawai,
				'barcode_pengajuan' => $kode,
				'id_status_diusulkan' =>$id_status_diusulkan,
				'id_berkas' => $id_berkas,
				'id_ijasah' =>$id_ijasah,
				'id_str' => $id_str,
				'id_logbook_a' => $id_logbook_a,
				'id_logbook_b' =>$id_logbook_b,
				'id_sertifikat' => $id_sertifikat,
				'id_etik_pegawai' =>$id_etik_pegawai,
				'status_pengajuan' => $status_pengajuan,
				'kesesuaian_bukti' => $kesesuaian_bukti,
				'acc_kabid' => $acc_kabid,
				'acc_asesor' =>$acc_asesor,
				'acc_komite' => $acc_komite,
				'acc_direktur' =>$acc_direktur,
				'id_kabid' =>$id_kabid,
				'id_asesor' =>$id_asesor,
				'id_komite' =>$id_komite,
				'id_direktur' =>$id_direktur,
				'tgl_acc_kabid' =>$tgl_acc_kabid,
				'tgl_acc_asesor' =>$tgl_acc_asesor,
				'tgl_acc_komite' =>$tgl_acc_komite,
				'tgl_acc_direktur' =>$tgl_acc_direktur,
				'acc_logbook_kabid' =>$acc_logbook_kabid,
				'acc_logbook_asesor' =>$acc_logbook_asesor,
				'acc_logbook_komite' =>$acc_logbook_komite,
				'acc_logbook_direktur' =>$acc_logbook_direktur,
				'kredensial' =>$kredensial,
				'mutu' =>$mutu,
				'etika' =>$etika,
				'tgl_kredensial' =>$tgl_kredensial,
				'tgl_mutu' =>$tgl_mutu,
				'tgl_etika' =>$tgl_etika,
				'id_kredensial' =>$id_kredensial,
				'id_mutu' =>$id_mutu,
				'id_etika' =>$id_etika,
				'id_level' =>$id_level,
				'status_terbitkan' =>$status_terbitkan
			);
			$this->db->insert('kr_pengajuanb', $data_pendaftaran);
		}
	}

 	function source(){
		$a = '104';
		$b = '104';
		$this->db->where('id_pengajuan BETWEEN "'.$a. '" and "'.$b.'"');
		$q = $this->db->get_where('kr_pengajuan');
		return $q->result_array();
	}
	function clone_proses(){
		$this->clone_proses_pengajuan();
	}
	function clone_proses_pengajuan(){
	$sources = $this->source();
		foreach($sources as $rowsources){
			$id_pengajuan = $rowsources['id_pengajuan'];
			$logbook_pegawai = $rowsources['logbook_pegawai'];
			if(!empty($logbook_pegawai)){
			$erik = explode(",", $logbook_pegawai);
			foreach($erik as $src){
			$kondisi_surat=array('id_pengajuan'=>$id_pengajuan,'id_logbook'=>$src);
			$jml=$this->m_umum->jumlah_record_filter('kr_pengajuan_logbook',$kondisi_surat);
			if($jml == 0){
			$data_pendaftaran = array(
				'id_pengajuan' => $id_pengajuan,
				'id_logbook' => $src
			);
			$this->db->insert('kr_pengajuan_logbook', $data_pendaftaran);
			}
			}
			}
		}
	}
	function clone_proses_pengajuan(){
	$sources = $this->source();
		foreach($sources as $rowsources){
			$id_pengajuan = $rowsources['id_pengajuan'];
			$tgl_pengajuan = $rowsources['tgl_pengajuan'];
			$id_pegawai = $rowsources['id_pegawai'];
			$id_status_diusulkan = $rowsources['id_status_diusulkan'];
			$id_berkas = $rowsources['id_berkas'];
			$id_ijasah = $rowsources['id_ijasah'];
			$id_str = $rowsources['id_str'];
			$logbook_pegawai = $rowsources['logbook_pegawai'];
			$id_logbook_a = $rowsources['id_logbook_a'];
			$id_logbook_b = $rowsources['id_logbook_b'];
			$id_sertifikat = $rowsources['id_sertifikat'];
			$id_etik_pegawai = $rowsources['id_etik_pegawai'];
			$status_pengajuan = $rowsources['status_pengajuan'];
			$kesesuaian_bukti = $rowsources['kesesuaian_bukti'];
			$acc_kabid = $rowsources['acc_kabid'];
			$acc_asesor = $rowsources['acc_asesor'];
			$acc_komite = $rowsources['acc_komite'];
			$acc_direktur = $rowsources['acc_direktur'];
			$id_kabid = $rowsources['id_kabid'];
			$id_asesor = $rowsources['id_asesor'];
			$id_komite = $rowsources['id_komite'];
			$id_direktur = $rowsources['id_direktur'];
			$tgl_acc_kabid = $rowsources['tgl_acc_kabid'];
			$tgl_acc_asesor = $rowsources['tgl_acc_asesor'];
			$tgl_acc_komite = $rowsources['tgl_acc_komite'];
			$tgl_acc_direktur = $rowsources['tgl_acc_direktur'];
			$acc_logbook_kabid = $rowsources['acc_logbook_kabid'];
			$acc_logbook_asesor = $rowsources['acc_logbook_asesor'];
			$acc_logbook_komite = $rowsources['acc_logbook_komite'];
			$acc_logbook_direktur = $rowsources['acc_logbook_direktur'];
			$kredensial = $rowsources['kredensial'];
			$mutu = $rowsources['mutu'];
			$etika = $rowsources['etika'];
			$tgl_kredensial = $rowsources['tgl_kredensial'];
			$tgl_mutu = $rowsources['tgl_mutu'];
			$tgl_etika = $rowsources['tgl_etika'];
			$id_kredensial = $rowsources['id_kredensial'];
			$id_mutu = $rowsources['id_mutu'];
			$id_etika = $rowsources['id_etika'];
			$kondisi=array('id_pegawai'=>$rowsources['id_pegawai']);
			$jml=$this->m_umum->jumlah_record_filter('user',$kondisi);
			if($jml == 0){
				$level = '0';
			}else{
				$abc = $this->swap($rowsources['id_pegawai']);
				$level = $abc['id_level'];
			}
			$data_pendaftaran = array(
				'id_pengajuan' => $id_pengajuan,
				'tgl_pengajuan' => $tgl_pengajuan,
				'id_pegawai' => $id_pegawai,
				'id_status_diusulkan' =>$id_status_diusulkan,
				'id_berkas' => $id_berkas,
				'id_ijasah' =>$id_ijasah,
				'id_str' => $id_str,
				'logbook_pegawai' => $logbook_pegawai,
				'id_logbook_a' => $id_logbook_a,
				'id_logbook_b' =>$id_logbook_b,
				'id_sertifikat' => $id_sertifikat,
				'id_etik_pegawai' =>$id_etik_pegawai,
				'status_pengajuan' => $status_pengajuan,
				'kesesuaian_bukti' => $kesesuaian_bukti,
				'acc_kabid' => $acc_kabid,
				'acc_asesor' =>$acc_asesor,
				'acc_komite' => $acc_komite,
				'acc_direktur' =>$acc_direktur,
				'id_kabid' =>$id_kabid,
				'id_asesor' =>$id_asesor,
				'id_komite' =>$id_komite,
				'id_direktur' =>$id_direktur,
				'tgl_acc_kabid' =>$tgl_acc_kabid,
				'tgl_acc_asesor' =>$tgl_acc_asesor,
				'tgl_acc_komite' =>$tgl_acc_komite,
				'tgl_acc_direktur' =>$tgl_acc_direktur,
				'acc_logbook_kabid' =>$acc_logbook_kabid,
				'acc_logbook_asesor' =>$acc_logbook_asesor,
				'acc_logbook_komite' =>$acc_logbook_komite,
				'acc_logbook_direktur' =>$acc_logbook_direktur,
				'kredensial' =>$kredensial,
				'mutu' =>$mutu,
				'etika' =>$etika,
				'tgl_kredensial' =>$tgl_kredensial,
				'tgl_mutu' =>$tgl_mutu,
				'tgl_etika' =>$tgl_etika,
				'id_kredensial' =>$id_kredensial,
				'id_mutu' =>$id_mutu,
				'id_etika' =>$id_etika,
				'id_level' =>$level,
				'status_terbitkan' =>0
			);
			$this->db->insert('kr_pengajuanb', $data_pendaftaran);
		}
	}
 	function swap($id){
		$q = $this->db->get_where('user',array('id_pegawai'=>$id));
		return $q->row_array();
	}
 	function clone_proses_berkas(){
	$sources = $this->source();
		foreach($sources as $rowsources){
			$id_berkas = $rowsources['id_berkas'];
			$id_pegawai = $rowsources['id_pegawai'];
			$nama_berkas = $rowsources['nama_berkas'];
			$id_kategori_berkas = $rowsources['id_kategori_berkas'];
			$tgl_a_berkas = $rowsources['tgl_a_berkas'];
			$tgl_b_berkas = $rowsources['tgl_b_berkas'];
			$tgl_kelulusan = $rowsources['tgl_kelulusan'];
			$penyelenggara = $rowsources['penyelenggara'];
			$kredit = $rowsources['kredit'];
			$no_berkas = $rowsources['no_berkas'];
			$no_sertifikat = $rowsources['no_sertifikat'];
			$status_berkas = $rowsources['status_berkas'];
			$kondisi=array('id_berkas'=>$rowsources['id_berkas']);
			$jml=$this->m_umum->jumlah_record_filter('berkas_pelatihan',$kondisi);
			$jml2=$this->m_umum->jumlah_record_filter('berkas_pendidikan',$kondisi);
			$jml3=$this->m_umum->jumlah_record_filter('berkas_data',$kondisi);
			if($jml == 0){
				$id_kategori_pelatihan = '0';
			}else{
				$abc = $this->swap($rowsources['id_berkas']);
				$id_kategori_pelatihan = $abc['id_kategori_pelatihan'];
			}
			if($jml2 == 0){
				$id_pendidikan = '0';
			}else{
				$bcd = $this->swap2($rowsources['id_berkas']);
				$id_pendidikan = $bcd['id_pendidikan'];
			}
			if($jml3 == 0){
				$link_berkas = '0';
			}else{
				$efg = $this->swap3($rowsources['id_berkas']);
				$link_berkas = $efg['link_berkas_data'];
			}
			$data_pendaftaran = array(
				'id_berkas' => $id_berkas,
				'id_pegawai' => $id_pegawai,
				'nama_berkas' => $nama_berkas,
				'id_kategori_berkas' => $id_kategori_berkas,
				'tgl_a_berkas' => $tgl_a_berkas,
				'tgl_b_berkas' => $tgl_b_berkas,
				'tgl_kelulusan' => $tgl_kelulusan,
				'penyelenggara' => $penyelenggara,
				'kredit' => $kredit,
				'no_berkas' => $no_berkas,
				'no_sertifikat' => $no_sertifikat,
				'link_berkas' => $link_berkas,
				'id_pendidikan' => $id_pendidikan,
				'id_kategori_pelatihan' => $id_kategori_pelatihan,
				'status_berkas' => $status_berkas
			);
			$this->db->insert('berkas', $data_pendaftaran);

		}
	}
 	function swap($id){
		$q = $this->db->get_where('berkas_pelatihan',array('id_berkas'=>$id));
		return $q->row_array();
	}
 	function swap2($id){
		$q = $this->db->get_where('berkas_pendidikan',array('id_berkas'=>$id));
		return $q->row_array();
	}
 	function swap3($id){
		$q = $this->db->get_where('berkas_data',array('id_berkas'=>$id));
		return $q->row_array();
	}
	function swic($id){
			switch ($id){
					case 1:
						return 21;
						break;
					case 2:
						return 15;
						break;
					case 3:
						return 16;
						break;
					case 4:
						return 17;
						break;
					case 5:
						return 18;
						break;
					case 6:
						return 19;
						break;
					case 10:
						return 21;
						break;
					case 18:
						return 14;
						break;
					case 19:
						return 14;
						break;
					case 20:
						return 22;
						break;
					case 21:
						return 22;
						break;
					case 22:
						return 22;
						break;
					case 23:
						return 22;
						break;
					case 30:
						return 0;
						break;
					case 32:
						return 0;
						break;
					case 33:
						return 3;
						break;
					case 99:
						return 99;
						break;
			}
	}
 	function clone_proses(){
	$sources = $this->source();
		foreach($sources as $rowsources){
			$kondisi=array('id_kewenangan'=>$rowsources['id_kewenangan']);
			$jml=$this->m_umum->jumlah_record_filter('kr_kewenangan_detil',$kondisi);
			if($jml == 0){
				$id_kompetensi = '0';
			}else{
				$abc = $this->swap($rowsources['id_kewenangan']);
				$id_kompetensi = $abc['id_kompetensi'];
			}
			$id_kewenangan = $rowsources['id_kewenangan'];
			$id_jabatan = $rowsources['id_jabatan'];
			$nama_kewenangan = $rowsources['nama_kewenangan'];
			$wkt_kewenangan = $rowsources['wkt_kewenangan'];
			$this->simpan_clone_proses($id_kewenangan,$id_jabatan,$nama_kewenangan,$wkt_kewenangan,$id_kompetensi);
		}
	}
 	function clone_proses_pegawai(){
	$sources = $this->source();
		foreach($sources as $rowsources){
			$kode = $this->m_rancak->kode_generator(15,'');
			$nik = $rowsources['nik'];
			$nip = $rowsources['nip'];
			$email = $rowsources['email'];
			$id_pegawai = $rowsources['id_pegawai'];
			$nama_pegawai = $rowsources['nama_pegawai'];
			$id_status_pegawai = $rowsources['id_status_pegawai'];
			$id_unit = $rowsources['id_unit'];
			$no_hp = $rowsources['no_hp'];
			$no_profesi = $rowsources['no_profesi'];
			$tmp_lahir = $rowsources['tmp_lahir'];
			$tgl_lahir = $rowsources['tgl_lahir'];
			$jk = $rowsources['jk'];
			$id_status_kawin = $rowsources['id_status_kawin'];
			$id_pendidikan = $rowsources['id_pendidikan'];
			$id_jabatan_fungsional = $rowsources['id_jabatan_fungsional'];
			$id_agama = $rowsources['id_agama'];
			$alamat = $rowsources['alamat'];
			$foto = $rowsources['foto'];
			$kosong = "";
			$nol = "0";
			$tglkosong = "0000-00-00";
			$data_pendaftaran = array(
				'id_pegawai' => $id_pegawai,
				'nik' => $nik,
				'nip' => $nip,
				'email' =>$email,
				'nama_pegawai' => $nama_pegawai,
				'id_unit' =>$id_unit,
				'id_ruangan' =>$id_unit,
				'tipe_pegawai' =>$id_status_pegawai,
				'no_hp' =>$no_hp,
				'no_profesi' => $no_profesi,
				'tmp_lahir' => $tmp_lahir,
				'tgl_lahir' => $tgl_lahir,
				'jk' =>$jk,
				'kode_pegawai' =>$kode,
				'id_status_kawin' =>$id_status_kawin,
				'id_pendidikan' =>$id_pendidikan,
				'id_jabatan_fungsional' =>$id_jabatan_fungsional,
				'id_agama' =>$id_agama,
				'alamat' => $alamat,
				'foto' => $foto
			);
			$this->db->insert('pegawai', $data_pendaftaran);
		}
	}
	function clone_proses_user(){
	$sources = $this->source();
		foreach($sources as $rowsources){
			$kode = $this->m_rancak->kode_generator(15,'');
			$id_user = $rowsources['id_user'];
			$id_pegawai = $rowsources['id_pegawai'];
			$username = $rowsources['username'];
			$password = $rowsources['password'];
			$status_user = $rowsources['status_user'];
			$id_level = $rowsources['id_level'];
			$level = $this->swic($id_level);
			$data_pendaftaran = array(
				'barcode_user' => $kode,
				'id_user' => $id_user,
				'id_pegawai' => $id_pegawai,
				'username' =>$username,
				'password' => $password,
				'id_level' =>$level,
				'status_user' =>$status_user
			);
			$this->db->insert('user', $data_pendaftaran);
		}
	}
	*/
// ================================================= INSTANSI ==============================
	function kewenangan_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = '*';
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
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('nkr_kewenangan');
	    $this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');

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

	    $this->db->from('nkr_kewenangan');
	    $this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('nkr_kewenangan');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function whats()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = '*';
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
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_whatsnew');

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
	    $this->db->from('ol_whatsnew');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('ol_whatsnew');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function edit_whatsnew(){
		$id_whatsnew = $this->input->post('id_whatsnew');
		$data_pendaftaran = array(
			'isi_whatsnew' => $this->input->post('isi_whatsnew')
		);
		$this->db->where('id_whatsnew',$id_whatsnew);
		$this->db->update('ol_whatsnew', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function instansi_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = '*';
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
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('a_instansi');

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
	    $this->db->from('a_instansi');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('a_instansi');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function edit_instansi(){
		$id_instansi = $this->input->post('id_instansi');
		$data_pendaftaran = array(
			'nama_instansi' => $this->input->post('nama_instansi'),
			'alamat_instansi' => $this->input->post('alamat_instansi'),
			'email_instansi' => $this->input->post('email_instansi'),
			'kontak_instansi' => $this->input->post('kontak_instansi'),
			'description' => $this->input->post('description'),
			'keywords' => $this->input->post('keywords'),
			'header' => $this->input->post('header'),
			'header_mini' => $this->input->post('header_mini'),
			'licensed' => $this->input->post('licensed'),
			'footer' => $this->input->post('footer')
		);
		$this->db->where('id_instansi',$id_instansi);
		$this->db->update('a_instansi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function edit_logo($id){
		$id_instansi = $this->input->post('id_instansi');
		$data_pendaftaran = array(
			'logo' => $id
		);
		$this->db->where('id_instansi',$id_instansi);
		$this->db->update('a_instansi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function hapus_logo($id){
		$data_pendaftaran = array(
			'logo' => ''
		);
		$this->db->where('id_instansi',$id);
		$this->db->update('a_instansi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function edit_wageblast(){
		$id_instansi = $this->input->post('id_instansi');
		$ptn = "/^0/";  // Regex
		$str = $this->input->post('sender'); //Your input, perhaps $_POST['textbox'] or whatever
		$rpltxt = "+62";  // Replacement string
		$receiver = preg_replace($ptn, $rpltxt, $str);
		$data_pendaftaran = array(
			'sender' => $receiver,
			'user_api' => $this->input->post('user_api'),
			'api' => $this->input->post('api'),
			'url_api' => $this->input->post('url_api')
		);
		$this->db->where('id_instansi',$id_instansi);
		$this->db->update('a_wageblast', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function edit_email(){
		$id_instansi = $this->input->post('id_instansi');
		$data_pendaftaran = array(
			'user' => $this->input->post('user'),
			'pass' => $this->input->post('pass'),
			'port' => $this->input->post('port'),
			'server' => $this->input->post('server')
		);
		$this->db->where('id_instansi',$id_instansi);
		$this->db->update('a_email', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function edit_bayar(){
		$id_instansi = $this->input->post('id_instansi');
		$data_pendaftaran = array(
			'status_bayar' => $this->input->post('status_bayar')
		);
		$this->db->where('id_instansi',$id_instansi);
		$this->db->update('a_instansi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function pengurus_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "if(op.id_cabang = '','',ope.nama_dpk) as cabang,op.id_dpk,op.nama_dpk,op.status_dpk as state,
		kk.nama_kab,op.alamat_dpk,op.kontak_dpk,op.email_dpk,op.kop_dpk,op.stempel_dpk,op.id_dpk,concat(op.alamat_dpk,' ',op.kontak_dpk,' ',nama_kab,' ',nama_prov,' ',op.email_dpk) as alamat_dpk
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
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('srt_dpk op');
		$this->db->join('kol_provinsi kp', 'kp.id_prov=op.id_prov','left');
		$this->db->join('kol_kabupaten kk', 'kk.id_kab=op.id_kab','left');
		$this->db->join('srt_dpk ope', 'ope.id_dpk=op.id_cabang','left');

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
			}
		  }
		}

		$this->db->from('srt_dpk op');
		$this->db->join('kol_provinsi kp', 'kp.id_prov=op.id_prov','left');
		$this->db->join('kol_kabupaten kk', 'kk.id_kab=op.id_kab','left');
		$this->db->join('srt_dpk ope', 'ope.id_dpk=op.id_cabang','left');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
//		if($id == 0){
/*	 		$kondisi=array('id_jabatan'=>$this->session->id_jabatan);
			$jml = $this->m_umum->jumlah_record_filter('ol_pengcab',$kondisi);
		}else{*/
			$jml = $this->m_umum->jumlah_record_tabel('srt_dpk');	
	//	}
		

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function ambil_pengcab(){
		$this->db->select("concat(nama_dpk,' - ',nama_jabatan) as nama_dpk,id_dpk");
		$this->db->join('jabatan', 'jabatan.id_jabatan=srt_dpk.id_jabatan','left');
		return $q = $this->db->get_where('srt_dpk',array('status_dpk'=>1))->result_array();
	//	$hasil= array_column($q,'nama_pengcab','id_pengcab');
	//	 $hasil;
	}
	function simpan_ol_pengcab($id){
		$kode = $this->m_rancak->kode_generator_urut(15,'DP');
		if(empty($id)){
			$data_kewenangan = array(
			'id_cabang' => $this->input->post('id_cabang'),
			'nama_dpk' => $this->input->post('nama_dpk'),
			'email_dpk' => $this->input->post('email_dpk'),
			'kontak_dpk' => $this->input->post('kontak_dpk'),
			'alamat_dpk' => $this->input->post('alamat_dpk'),
			'status_dpk' => $this->input->post('status_dpk'),
			'id_prov' => $this->input->post('id_prov'),
			'id_kab' => $this->input->post('id_kab'),
			'id_jabatan' => $this->input->post('id_jabatan'),
			'id_dpk' => $kode

			);
		}else{
			$data_kewenangan = array(
			'id_cabang' => $this->input->post('id_cabang'),
			'nama_dpk' => $this->input->post('nama_dpk'),
			'email_dpk' => $this->input->post('email_dpk'),
			'kontak_dpk' => $this->input->post('kontak_dpk'),
			'alamat_dpk' => $this->input->post('alamat_dpk'),
			'status_dpk' => $this->input->post('status_dpk'),
			'id_prov' => $this->input->post('id_prov'),
			'id_kab' => $this->input->post('id_kab'),
			'id_jabatan' => $this->input->post('id_jabatan'),
			'id_dpk' => $kode,
			'kop_dpk' => $id

			);
		}
		return $this->db->insert('srt_dpk', $data_kewenangan);
	}
	function edit_ol_pengcab($id){
		$id_dpk = $this->input->post('id_dpk');
		if(empty($id)){
			$data_pendaftaran = array(
			'id_cabang' => $this->input->post('id_cabang'),
			'nama_dpk' => $this->input->post('nama_dpk'),
			'email_dpk' => $this->input->post('email_dpk'),
			'kontak_dpk' => $this->input->post('kontak_dpk'),
			'status_dpk' => $this->input->post('status_dpk'),
			'alamat_dpk' => $this->input->post('alamat_dpk'),
			'id_prov' => $this->input->post('id_prov'),
			'id_kab' => $this->input->post('id_kab')
			);
		}else{
			$user_pic=$this->m_umum->ambil_data('srt_dpk','id_dpk',$id_dpk);
			if(!empty($user_pic['kop_dpk'])){
				$cek_file=FCPATH.'assets/berkas/kop/'.$user_pic['kop_dpk'];
				if(file_exists($cek_file)){
					unlink(FCPATH."assets/berkas/kop/".$user_pic['kop_dpk']);
				}
			}
			$data_pendaftaran = array(
			'id_cabang' => $this->input->post('id_cabang'),
			'nama_dpk' => $this->input->post('nama_dpk'),
			'email_dpk' => $this->input->post('email_dpk'),
			'status_dpk' => $this->input->post('status_dpk'),
			'kontak_dpk' => $this->input->post('kontak_dpk'),
			'alamat_dpk' => $this->input->post('alamat_dpk'),
			'id_prov' => $this->input->post('id_prov'),
			'id_kab' => $this->input->post('id_kab'),
			'kop_dpk' => $id
			);
		}
		$this->db->where('id_dpk',$id_dpk);
		$this->db->update('srt_dpk', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function edit_stempel_pengcab($id){
		$id_dpk = $this->input->post('id_dpk');
		if(empty($id)){
			$data_pendaftaran = array(
			'id_cabang' => $this->input->post('id_cabang'),
			'nama_dpk' => $this->input->post('nama_dpk'),
			'email_dpk' => $this->input->post('email_dpk'),
			'status_dpk' => $this->input->post('status_dpk'),
			'kontak_dpk' => $this->input->post('kontak_dpk'),
			'alamat_dpk' => $this->input->post('alamat_dpk'),
			'id_prov' => $this->input->post('id_prov'),
			'id_kab' => $this->input->post('id_kab')
			);
		}else{
			$user_pic=$this->m_umum->ambil_data('srt_dpk','id_dpk',$id_dpk);
			if(!empty($user_pic['stempel_dpk'])){
				$cek_file=FCPATH.'assets/berkas/kop/'.$user_pic['stempel_dpk'];
				if(file_exists($cek_file)){
					unlink(FCPATH."assets/berkas/kop/".$user_pic['stempel_dpk']);
				}
			}
			$data_pendaftaran = array(
			'id_cabang' => $this->input->post('id_cabang'),
			'nama_dpk' => $this->input->post('nama_dpk'),
			'email_dpk' => $this->input->post('email_dpk'),
			'status_dpk' => $this->input->post('status_dpk'),
			'kontak_dpk' => $this->input->post('kontak_dpk'),
			'alamat_dpk' => $this->input->post('alamat_dpk'),
			'id_prov' => $this->input->post('id_prov'),
			'id_kab' => $this->input->post('id_kab'),
			'stempel_dpk' => $id
			);
		}
		$this->db->where('id_dpk',$id_dpk);
		$this->db->update('srt_dpk', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function pcare_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*";
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
			//		 case 'no_hp' : $nmf="peg.no_hp";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('a_pcare');
	    $this->db->join('kol_working', 'kol_working.id_working=a_pcare.id_instansi','left');

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
			//		case 'no_hp' : $nmf="peg.no_hp";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('a_pcare');
	    $this->db->join('kol_working', 'kol_working.id_working=a_pcare.id_instansi','left');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('a_pcare');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function read_pasien_csv(){
		$id_instansi = $this->input->post('id_instansi');
		$file = $_FILES['upload_Files']['name'];
		$file_open = fopen($file,"r");

//echo $file_open;
/*$fileatt = fopen($_FILES["file"]["name"],'r');
$file = fopen($fileatt,'r');
$data = fread($file,filesize($fileatt));*/

		 while(($csv = fgetcsv($file_open, 1000, ",")) !== false)
		 {
		  $rm = $csv[0];
		  $nama = $csv[1];
		  $jk = $csv[2];
		  $ttl = $csv[3];
		  $alamat = $csv[4];
		  $this->simpan_pasien_csv($rm,$nama,$jk,$ttl,$alamat,$id_instansi);
		 }
	}
	function simpan_pasien_csv($rm,$nama,$jk,$ttl,$alamat,$id_instansi){
		if($rm){
			$kondisi = array('rm'=>$rm);
			$cek_file = $this->m_umum->jumlah_record_filter('ol_pasien',$kondisi);
			if($cek_file == 0){
				$kode = $this->m_rancak->kode_generator_urut(15,'PS');
				$data_pendaftaran = array(
					'pasien_instansi' => $id_instansi,
					'rm' => $rm,
					'id_pasien' => $kode,
					'nama_pasien' => $nama,
					'jk' => $jk,
					'tgl_lahir' => $ttl,
					'alamat' => $alamat
				);
				return $this->db->insert('ol_pasien2', $data_pendaftaran);	
			}		
		}

	}
	function simpan_pcare(){
		$data_pendaftaran = array(
			'id_instansi' => $this->input->post('id_instansi'),
			'cons_id' => $this->input->post('cons_id'),
			'secret_key' => $this->input->post('secret_key'),
			'base_url' => $this->input->post('base_url'),
			'service_name' => $this->input->post('service_name'),
			'pcare_user' => $this->input->post('pcare_user'),
			'pcare_pass' => $this->input->post('pcare_pass'),
			'user_key' => $this->input->post('user_key'),
			'kd_aplikasi' => $this->input->post('kd_aplikasi'),
			'status_pcare' => $this->input->post('status_pcare')
		);
		return $this->db->insert('a_pcare', $data_pendaftaran);
	}
	function edit_pcare(){
		$id_pcare = $this->input->post('id_pcare');
		$data_pendaftaran = array(
			'id_instansi' => $this->input->post('id_instansi'),
			'cons_id' => $this->input->post('cons_id'),
			'secret_key' => $this->input->post('secret_key'),
			'base_url' => $this->input->post('base_url'),
			'service_name' => $this->input->post('service_name'),
			'pcare_user' => $this->input->post('pcare_user'),
			'pcare_pass' => $this->input->post('pcare_pass'),
			'user_key' => $this->input->post('user_key'),
			'kd_aplikasi' => $this->input->post('kd_aplikasi'),
			'status_pcare' => $this->input->post('status_pcare')
		);
		$this->db->where('id_pcare',$id_pcare);
		$this->db->update('a_pcare', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function kompetensi_all()
	{
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
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('nkr_kompetensi kp');
		$this->db->join('jabatan j', 'j.id_jabatan=kp.id_jabatan','left');
		$this->db->join('kol_working kwr', 'kwr.id_working=kp.instansi_kompetensi','left');

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

	    $this->db->from('nkr_kompetensi kp');
		$this->db->join('jabatan j', 'j.id_jabatan=kp.id_jabatan','left');
		$this->db->join('kol_working kwr', 'kwr.id_working=kp.instansi_kompetensi','left');

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
		$instansi_kompetensi = $this->input->post('id_instansi');
	//	if(empty($instansi_kompetensi)){$instansi_kompetensi = 0; }
		$data_pendaftaran = array(
			'id_jabatan' => $this->input->post('id_jabatan'),
			'id_kompetensi' => $idkode,
			'kode_unit' => $kode,
			'creator_kompetensi' => $this->session->id_pegawai,
			'instansi_kompetensi' => $instansi_kompetensi,
			'nama_kompetensi' => $this->input->post('nama_kompetensi'),
			'deskripsi_kompetensi' => $this->input->post('deskripsi_kompetensi')
		);
		// print_r($data_pendaftaran);die();
		$this->db->insert('nkr_kompetensi', $data_pendaftaran);	
		return $idkode;
		// $this->db->insert_id();			
	}
	function simpan_plus_nkr_kewenangan($idnya){
		$idkode = $this->m_rancak->kode_generator_urut(15,'KW');
		$data_pendaftaran = array(
			'id_kompetensi' => $idnya,
			'id_kewenangan' => $idkode,
			'creator_kewenangan' => $this->session->id_pegawai,
			'nama_kewenangan' => $this->input->post('nama_kompetensi')
		);
		// print_r($data_pendaftaran);die();
		return $this->db->insert('nkr_kewenangan', $data_pendaftaran);		
		// $this->db->insert_id();			
	}
	function edit_nkr_kompetensi(){
		$id_kompetensi = $this->input->post('id_kompetensi');
		$kode = strtoupper($this->input->post('kode_unit'));
		$instansi_kompetensi = $this->input->post('id_instansi');
	//	if(empty($instansi_kompetensi)){$instansi_kompetensi = 0; }
		$data_pendaftaran = array(
			'id_jabatan' => $this->input->post('id_jabatan'),
			'kode_unit' => $kode,
			'instansi_kompetensi' => $instansi_kompetensi,
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
	function kewenangane_all()
	{
		$fields = "*,,if(instansi_kompetensi IS NULL or instansi_kompetensi = 0,'Semua Instansi', nama_working) as nama_working";
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

   	    $this->db->from('nkr_kewenangan kw');
		$this->db->join('nkr_kompetensi kp', 'kp.id_kompetensi=kw.id_kompetensi','left');
		$this->db->join('jabatan j', 'j.id_jabatan=kp.id_jabatan','left');
		$this->db->join('kol_working kwr', 'kwr.id_working=kp.instansi_kompetensi','left');

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

   	    $this->db->from('nkr_kewenangan kw');
		$this->db->join('nkr_kompetensi kp', 'kp.id_kompetensi=kw.id_kompetensi','left');
		$this->db->join('jabatan j', 'j.id_jabatan=kp.id_jabatan','left');
		$this->db->join('kol_working kwr', 'kwr.id_working=kp.instansi_kompetensi','left');

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
	function cmd_kompetensi_in(){
		$this->db->select("id_kompetensi, CONCAT('[',kode_unit,'] ',nama_kompetensi,' - { ',if(instansi_kompetensi=0,'Semua Instansi',nama_working),' } - ',nama_jabatan) as nama_kompetensi");
		$this->db->join('jabatan j', 'j.id_jabatan=nkr_kompetensi.id_jabatan','left');
		$this->db->join('kol_working kw', 'kw.id_working=nkr_kompetensi.instansi_kompetensi','left');
		$q= $this->db->get_where('nkr_kompetensi',array('status_kompetensi'=>1))->result_array();
		$hasil= array_column($q,'nama_kompetensi','id_kompetensi');
		return $hasil;
	}
	function simpan_nkr_kewenangan(){
		$idkode = $this->m_rancak->kode_generator_urut(15,'KW');
		$data_pendaftaran = array(
			'id_kompetensi' => $this->input->post('id_kompetensi'),
			'id_kewenangan' => $idkode,
			'creator_kewenangan' => $this->session->id_pegawai,
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
	function basic_program_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,if (jabatan = '' ,'KOSONG','ADA') as tjabatan,
					if (jabatan_fungsional = '' ,'KOSONG','ADA') as tjabatan_fungsional,
					if (struktur_jabatan = '' ,'KOSONG','ADA') as tstruktur_jabatan,
					if (unit = '' ,'KOSONG','ADA') as tunit,
					if (ruangan = '' ,'KOSONG','ADA') as truangan,
					if (akses = '' ,'KOSONG','ADA') as takses,
					if (user_level = '' ,'KOSONG','ADA') as tuser_level";
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
			//		 case 'no_hp' : $nmf="peg.no_hp";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('a_program');

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
			//		case 'no_hp' : $nmf="peg.no_hp";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('a_program');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('a_program');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_program(){
		$data_pendaftaran = array(
			'nama_program' => $this->input->post('nama_program'),
			'jabatan' => '',
			'jabatan_fungsional' => '',
			'struktur_jabatan' => '',
			'ruangan' => '',
			'unit' => '',
			'akses' => '',
			'user_level' => ''
		);
		return $this->db->insert('a_program', $data_pendaftaran);
	}
	function edit_program(){
		$id_program = $this->input->post('id_program');
		$data_pendaftaran = array(
			'nama_program' => $this->input->post('nama_program')
		);
		$this->db->where('id_program',$id_program);
		$this->db->update('a_program', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function ambil_isi_program($table){
		$q = $this->db->get_where($table);
		return $q->result_array();
	}
	function rubah_isi_program($field){
		$id_program = $this->input->post('id_program');
		$chk = $this->input->post('chk[]');
		if(!empty($chk)) {
				$terpilih = implode(",", $chk);
		}else{
			$terpilih = "";
		}
		$data_mirm = array(
			$field => $terpilih
			);
		$this->db->where('id_program',$id_program);
			$this->db->update('a_program', $data_mirm);
			//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
			if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
			// if (!$this->db->affected_rows())
				return(FALSE);
			else
				return(TRUE);
	}
	function ol_whole_user()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,
			DATE_FORMAT(tgl_lahir,'%d-%m-%Y') as tgl_lahir,ol_user.id_pegawai
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
					 case 'id_pegawai' : $nmf="user.id_pegawai";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_user');
	    $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_user.id_pegawai','left');
	    $this->db->join('ol_pegawai_unit', 'ol_pegawai_unit.id_pegawai=ol_pegawai.id_pegawai','left');
	    $this->db->join('user_level', 'user_level.id_level=ol_user.id_level','left');
	    $this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
	    $this->db->join('ol_unit', 'ol_unit.id_unit=ol_pegawai_unit.id_unit','left');
	    $this->db->join('kol_working', 'kol_working.id_working=ol_user.refer','left');

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
					case 'id_pegawai' : $nmf="user.id_pegawai";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}

	    $this->db->from('ol_user');
	    $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_user.id_pegawai','left');
	    $this->db->join('user_level', 'user_level.id_level=ol_user.id_level','left');
	    $this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
	    $this->db->join('ol_pegawai_unit', 'ol_pegawai_unit.id_pegawai=ol_pegawai.id_pegawai','left');
	    $this->db->join('ol_unit', 'ol_unit.id_unit=ol_pegawai_unit.id_unit','left');
	   	$this->db->join('kol_working', 'kol_working.id_working=ol_user.refer','left');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
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
	function whole_user()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,user.id_pegawai,
				if(status_pegawai = '0' ,'NON AKTIF','AKTIF') as status_pegawai,
				if(status_user = '0' ,'NON AKTIF','AKTIF') as status_user
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
					 case 'id_pegawai' : $nmf="user.id_pegawai";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('user');
	    $this->db->join('pegawai','pegawai.id_pegawai=user.id_pegawai','left');
	    $this->db->join('user_level','user_level.id_level=user.id_level','left');

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
					case 'id_pegawai' : $nmf="user.id_pegawai";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('user');
	    $this->db->join('pegawai','pegawai.id_pegawai=user.id_pegawai','left');
	    $this->db->join('user_level','user_level.id_level=user.id_level','left');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('user');		//[coding here] ganti tabel utamanya

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
		$this->db->where('id_user',$id);
		$this->db->update('user', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function ol_reset_password($id){
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
	function simpan_pegawai_unit(){
		$data_pendaftaran = array(
			'id_unit' => $this->input->post('id_unit'),
			'id_pegawai' => $this->input->post('id_pegawai')
		);
		return $this->db->insert('ol_pegawai_unit', $data_pendaftaran);
	}
	function simpan_mhs_unit(){
		$kode = $this->m_rancak->kode_generator_urut(15,'MH');
		$data_pendaftaran = array(
			'id_pegawai_unit' => $kode,
			'id_unit' => $this->input->post('id_unit'),
			'barcode_pegawai' => $this->input->post('barcode_pegawai')
		);
		return $this->db->insert('mhs_pegawai_unit', $data_pendaftaran);
	}
	function nonaktif_mhs_unit(){
		$barcode_pegawai = $this->input->post('barcode_pegawai');	
		$id_unit_lama = $this->input->post('id_unit_lama');	
		$data_pendaftaran = array(
			'status_pegawai_unit' => 0
		);
		$this->db->where('barcode_pegawai',$barcode_pegawai);
		$this->db->where('id_unit',$id_unit_lama);
		$this->db->update('mhs_pegawai_unit', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
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
	function status_user($int,$id){
		$data_pendaftaran = array(
			'status_user' => $int
		);
		$this->db->where('id_user',$id);
		$this->db->update('user', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function ol_status_user($int,$id){
		$data_pendaftaran = array(
			'status_user' => $int
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
	function status_pegawai($int,$id){
		$data_pendaftaran = array(
			'status_pegawai' => $int
		);
		$this->db->where('id_pegawai',$id);
		$this->db->update('pegawai', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function ol_status_pegawai($int,$id){
		$data_pendaftaran = array(
			'status_pegawai' => $int
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
	function beri_level($int,$id){
		$data_pendaftaran = array(
			'give_level' => $int
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
	function visible($int,$id){
		$data_pendaftaran = array(
			'visible' => $int
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
	function refer(){
		$id_user = $this->input->post('id_user');
		$data_pendaftaran = array(
			'refer' => $this->input->post('id_working'),
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
	function unite(){
		$id_user = $this->input->post('id_user');
		$data_pendaftaran = array(
			'unit' => $this->input->post('id_unit'),
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
	function simpan_ms_kred(){
		$id_user = $this->input->post('id_user');
		$chk = $this->input->post('chk[]');
		if(!empty($chk)) {
				$terpilih = implode(",", $chk);
		}else{
			$terpilih = "";
		}
		$data_mirm = array(
			'mas_kred' => $terpilih
			);
		$this->db->where('id_user',$id_user);
			$this->db->update('ol_user', $data_mirm);
			//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
			if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
			// if (!$this->db->affected_rows())
				return(FALSE);
			else
				return(TRUE);
	}
	function simpan_ms_ins(){
		$id_user = $this->input->post('id_user');
		$chk = $this->input->post('chk[]');
		if(!empty($chk)) {
				$terpilih = implode(",", $chk);
		}else{
			$terpilih = "";
		}
		$data_mirm = array(
			'mas_ins' => $terpilih
			);
		$this->db->where('id_user',$id_user);
			$this->db->update('ol_user', $data_mirm);
			//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
			if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
			// if (!$this->db->affected_rows())
				return(FALSE);
			else
				return(TRUE);
	}
	function simpan_ms_asesor(){
		$id_user = $this->input->post('id_user');
		$chk = $this->input->post('chk[]');
		if(!empty($chk)) {
				$terpilih = implode(",", $chk);
		}else{
			$terpilih = "";
		}
		$data_mirm = array(
			'mas_asesor' => $terpilih
			);
		$this->db->where('id_user',$id_user);
			$this->db->update('ol_user', $data_mirm);
			//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
			if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
			// if (!$this->db->affected_rows())
				return(FALSE);
			else
				return(TRUE);
	}
  function simpan_ms_unit(){
    $id_user = $this->input->post('id_user');
    $chk = $this->input->post('chk[]');
    if(!empty($chk)) {
        $terpilih = implode(",", $chk);
    }else{
      $terpilih = "";
    }
    $data_mirm = array(
      'mas_unit' => $terpilih
      );
    $this->db->where('id_user',$id_user);
      $this->db->update('ol_user', $data_mirm);
      //echo $this->db->last_query();
    $this->db->trans_complete();  // untuk cek sukses update tidak
      if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
      // if (!$this->db->affected_rows())
        return(FALSE);
      else
        return(TRUE);
  }
	function hak_akses_all($id)
	{
	//	$ids = explode(',', $akses);
	//--------- Ambil nama kolom --------- [coding here] .jpg
	$fields = "*,if(status_pegawai_akses = '0' ,'NON AKTIF','AKTIF') as status_pegawai_akses
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
				$this->db->where('pak.id_pegawai',$id);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	$this->db->from('pegawai_akses pak');
	$this->db->join('akses ak','ak.id_akses=pak.id_akses','left');
	$this->db->join('pegawai peg','peg.id_pegawai=pak.id_pegawai','left');
	$this->db->where('pak.id_pegawai',$id);

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
				$this->db->where('pak.id_pegawai',$id);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	$this->db->from('pegawai_akses pak');
	$this->db->join('akses ak','ak.id_akses=pak.id_akses','left');
	$this->db->join('pegawai peg','peg.id_pegawai=pak.id_pegawai','left');
	$this->db->where('pak.id_pegawai',$id);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----

		$jml = $this->m_umum->jumlah_record_tabel('pegawai_akses');			//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
	//	 print_r($output);die();
		return $output;
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
				$q = $this->db->get('pegawai_akses')->row();
				$jml = $q->num;
				if($jml == 0){
					$data_pendaftaran = array(
						'id_akses' => $chk[$i],
						'id_pegawai' => $id_pegawai,
						'status_pegawai_akses' => 1
					);
					$this->db->insert('pegawai_akses', $data_pendaftaran);
				}
			}
		}
	}
	function ambil_data_dropdown_unit($id)	//daftar.php pasien
	{
		$query = $this->db->get_where('ol_unit',array('status_unit'=>1));
		return $query->result_array();
	}
	function ambil_data_unit()	//daftar.php pasien
	{
		$this->db->select("id_unit,concat(nama_unit,' = ',nama_working) as nama_unit");
		$this->db->join('kol_working','kol_working.id_working=ol_unit.id_instansi','left');
		$q = $this->db->get_where('ol_unit',array('status_unit'=>1))->result_array();
		$hasil= array_column($q,'nama_unit','id_unit');
		return $hasil;
	}
	function status_pegawai_akses($int,$id){
		$data_pendaftaran = array(
			'status_pegawai_akses' => $int
		);
		$this->db->where('id_pegawai_akses',$id);
		$this->db->update('pegawai_akses', $data_pendaftaran);
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
				$this->db->where('pak.id_pegawai',$id);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	$this->db->from('ol_akses pak');
	$this->db->join('akses ak','ak.id_akses=pak.id_akses','left');
	$this->db->join('ol_pegawai peg','peg.id_pegawai=pak.id_pegawai','left');
	$this->db->where('pak.id_pegawai',$id);

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
				$this->db->where('pak.id_pegawai',$id);
			}
		  }
		}

	$this->db->from('ol_akses pak');
	$this->db->join('akses ak','ak.id_akses=pak.id_akses','left');
	$this->db->join('ol_pegawai peg','peg.id_pegawai=pak.id_pegawai','left');
	$this->db->where('pak.id_pegawai',$id);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----

		$jml = $this->m_umum->jumlah_record_tabel('pegawai_akses');			//[coding here] ganti tabel utamanya

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
	function a_online_all()
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
				$this->db->where('pak.id_pegawai',$id);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('a_online');
/*		$this->db->join('akses ak','ak.id_akses=pak.id_akses','left');
		$this->db->join('ol_pegawai peg','peg.id_pegawai=pak.id_pegawai','left');
		$this->db->where('pak.id_pegawai',$id);*/

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

	$this->db->from('a_online');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----

		$jml = $this->m_umum->jumlah_record_tabel('a_online');			//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
	//	 print_r($output);die();
		return $output;
	}
	function simpan_a_online(){
		$data_pendaftaran = array(
			'kode_online' => $this->input->post('kode_online'),
			'nama_menu' => $this->input->post('nama_menu'),
			'status_online' => $this->input->post('status_online'),
			'menu' => $this->input->post('menu'),
			'kunci' => $this->input->post('kunci')
		);
		return $this->db->insert('a_online', $data_pendaftaran);
	}
	function edit_a_online(){
		$id_kode_online = $this->input->post('id_kode_online');
		$data_pendaftaran = array(
			'kode_online' => $this->input->post('kode_online'),
			'nama_menu' => $this->input->post('nama_menu'),
			'status_online' => $this->input->post('status_online'),
			'menu' => $this->input->post('menu'),
			'kunci' => $this->input->post('kunci')
		);
		$this->db->where('id_kode_online',$id_kode_online);
		$this->db->update('a_online', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function a_enabled_all($id_kode_online,$id_jabatan,$id_instansi,$id)
	{
		$wordsAry = explode("-", $id);
		$wordsCount = count($wordsAry);
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
		if(!empty($id_kode_online)){
		$this->db->where('aoe.id_kode_online',$id_kode_online); }
		if(!empty($id_jabatan)){
		$this->db->where('jf.id_jabatan',$id_jabatan); }
		if(!empty($id_instansi)){
		$this->db->where('opi.id_instansi',$id_instansi); }
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->where("(peg.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(peg.no_profesi LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(peg.nip LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('a_ol_enabled aoe');
		$this->db->join('a_online ak','ak.id_kode_online=aoe.id_kode_online','left');
		$this->db->join('ol_pegawai peg','peg.id_pegawai=aoe.id_pegawai','left');
		$this->db->join('ol_pegawai_instansi opi','opi.id_pegawai=peg.id_pegawai','left');
		$this->db->join('kol_working kw','kw.id_working=opi.id_instansi','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
		$this->db->join('jabatan jb', 'jb.id_jabatan=jf.id_jabatan','left');
		if(!empty($id_kode_online)){
		$this->db->where('aoe.id_kode_online',$id_kode_online); }
		if(!empty($id_jabatan)){
		$this->db->where('jf.id_jabatan',$id_jabatan); }
		if(!empty($id_instansi)){
		$this->db->where('opi.id_instansi',$id_instansi); }
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->where("(peg.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(peg.no_profesi LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(peg.nip LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
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
		if(!empty($id_kode_online)){
		$this->db->where('aoe.id_kode_online',$id_kode_online); }
		if(!empty($id_jabatan)){
		$this->db->where('jf.id_jabatan',$id_jabatan); }
		if(!empty($id_instansi)){
		$this->db->where('opi.id_instansi',$id_instansi); }
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->where("(peg.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(peg.no_profesi LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(peg.nip LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
			}
		  }
		}

		$this->db->from('a_ol_enabled aoe');
		$this->db->join('a_online ak','ak.id_kode_online=aoe.id_kode_online','left');
		$this->db->join('ol_pegawai peg','peg.id_pegawai=aoe.id_pegawai','left');
		$this->db->join('ol_pegawai_instansi opi','opi.id_pegawai=peg.id_pegawai','left');
		$this->db->join('kol_working kw','kw.id_working=opi.id_instansi','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
		$this->db->join('jabatan jb', 'jb.id_jabatan=jf.id_jabatan','left');
		if(!empty($id_kode_online)){
		$this->db->where('aoe.id_kode_online',$id_kode_online); }
		if(!empty($id_jabatan)){
		$this->db->where('jf.id_jabatan',$id_jabatan); }
		if(!empty($id_instansi)){
		$this->db->where('opi.id_instansi',$id_instansi); }
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->where("(peg.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(peg.no_profesi LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(peg.nip LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----

		$jml = $this->m_umum->jumlah_record_tabel('a_ol_enabled');			//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
	//	 print_r($output);die();
		return $output;
	}
	function simpan_a_ol_enabled(){
		$chk = $this->input->post('chk[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				$this->db->select("COUNT(*) as num");
				$this->db->where('id_pegawai', $chk[$i]);
				$this->db->where('id_kode_online',$this->input->post('id_kode_online'));
				$q = $this->db->get('a_ol_enabled')->row();
				$jml = $q->num;
				if($jml == 0){
					$data_pendaftaran = array(
						'id_kode_online' =>  $this->input->post('id_kode_online'),
						'id_pegawai' => $chk[$i],
						'enabled' =>  1,
						'status_ol_enabled' =>  1
					);
					$this->db->insert('a_ol_enabled', $data_pendaftaran);
				}
			}
		}
	}
	function edit_a_ol_enabled(){
		$id_ol_enabled = $this->input->post('id_ol_enabled');
		$data_pendaftaran = array(
			'id_kode_online' => $this->input->post('id_kode_online'),
			'enabled' => $this->input->post('enabled'),
			'status_ol_enabled' => $this->input->post('status_ol_enabled')
		);
		$this->db->where('id_ol_enabled',$id_ol_enabled);
		$this->db->update('a_ol_enabled', $data_pendaftaran);
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
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,DATE_FORMAT(b.tgl_pengajuan,'%d-%m-%Y') as tgl_pengajuan
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
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(peg.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(peg.nip LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(peg.nik LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_pengajuan_temp b');
		$this->db->join('ol_status_diusulkan su', 'su.id_status_diusulkan=b.id_status_diusulkan','left');
		$this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=b.barcode_pegawai','left');
		$this->db->join('ol_user ou', 'ou.id_pegawai=peg.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
		$this->db->join('kol_working kw', 'kw.id_working=b.id_instansi','left');
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(peg.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(peg.nip LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(peg.nik LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
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
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(peg.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(peg.nip LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(peg.nik LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
			}
		  }
		}

	    $this->db->from('ol_pengajuan_temp b');
		$this->db->join('ol_status_diusulkan su', 'su.id_status_diusulkan=b.id_status_diusulkan','left');
		$this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=b.barcode_pegawai','left');
		$this->db->join('ol_user ou', 'ou.id_pegawai=peg.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
		$this->db->join('kol_working kw', 'kw.id_working=b.id_instansi','left');
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(peg.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(peg.nip LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(peg.nik LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
/*		$names = array('0', $this->session->id_jabatan);
		$this->db->where_in('su.id_jabatan', $names);*/


		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99');
		$jml = $this->m_umum->jumlah_record_filter('pegawai',$kondisi);	 */
		$jml = $this->m_umum->jumlah_record_tabel('ol_pengajuan_temp');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function edit_status_bayar($kode){
		$temp = $this->m_umum->ambil_data('ol_pengajuan_temp','barcode_pengajuan',$kode);	
		$id = $this->m_rancak->kode_generator_urut(15,'PK');
		$data_kewenangan = array(
			'id_status_diusulkan' =>$temp['id_status_diusulkan'],
			'id_instansi' =>$temp['id_instansi'],
			'tgl_pengajuan' =>$temp['tgl_pengajuan'],
			'id_pengajuan' => $id,
			'status_lunas' => 1,
			'barcode_pengajuan' => $kode,
			'barcode_pegawai' => $temp['barcode_pegawai']
		);
		$this->db->insert('ol_pengajuan', $data_kewenangan);
	}
	function pengajuan_kompetensi_aktif($id)
	{
	$wordsAry = explode("-", $id);
	$wordsCount = count($wordsAry);
		$fields = "*,DATE_FORMAT(tgl_pengajuan,'%d-%m-%Y') as tgl_pengajuan,DATE_FORMAT(wkt_pengajuan,'%d-%m-%Y %H:%i:%s') as wkt_pengajuan,if(status_pengajuan_temp = 0,'BAYAR','PENDING') as status_pengajuan_temp,
			concat('<strong>Nama Pegawai : </strong>',nama_pegawai,' - <strong>[ Barcode Pengajuan Temp : </strong>',barcode_pengajuan_temp,' ] - <br>{ <strong>Tempat Bekerja : </strong>',nama_working,' } - <strong>No Hp : </strong>',no_hp) as nama_pegawai
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
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(or.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(or.nik LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_pengajuan_temp opt');
		$this->db->join('ol_pegawai or', 'or.barcode_pegawai=opt.barcode_pegawai','left');
		$this->db->join('ol_status_diusulkan osd', 'osd.id_status_diusulkan=opt.id_status_diusulkan','left');
		$this->db->join('kol_working ol', 'ol.id_working=opt.id_instansi','left');
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(or.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(or.nik LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
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
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(or.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(or.nik LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
			}
		  }
		}

		$this->db->from('ol_pengajuan_temp opt');
		$this->db->join('ol_pegawai or', 'or.barcode_pegawai=opt.barcode_pegawai','left');
		$this->db->join('ol_status_diusulkan osd', 'osd.id_status_diusulkan=opt.id_status_diusulkan','left');
		$this->db->join('kol_working ol', 'ol.id_working=opt.id_instansi','left');
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(or.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(or.nik LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('ol_pengajuan_temp');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function ambil_pengajuan_temp($id){
		$this->db->join('ol_pegawai or', 'or.barcode_pegawai=opt.barcode_pegawai','left');
		$this->db->join('ol_user ou', 'ou.id_pegawai=or.id_pegawai','left');
		$q = $this->db->get_where('ol_pengajuan_temp opt',array('barcode_pengajuan_temp'=>$id));
		return $q->row_array();
	}
	function simpan_pengajuan_kompetensi($idx){
		$barcode_pegawai = $this->input->post('barcode_pegawai');
		$tgl_pengajuan = $this->input->post('tgl_pengajuan');
		$tgl_pengajuan = date('Y-m-d', strtotime($tgl_pengajuan));
		$id = $this->m_rancak->kode_generator_urut(15,'PK');
		$kode = $this->m_rancak->kode_generator(15,'PK');
		$id_status_diusulkan = $this->input->post('id_status_diusulkan');
		$id_instansi = $this->input->post('id_instansi');
		$barcode_pengajuan_temp = $this->input->post('barcode_pengajuan_temp');
		$nominal_pengajuan = $this->input->post('nominal_pengajuan');
		$nominal_pengajuan	= str_replace("'","&acute;",$nominal_pengajuan);
		$nominal_pengajuan	= str_replace(".","",$nominal_pengajuan);
		$nominal_pengajuan	= str_replace(" ","",$nominal_pengajuan);
		$nominal_pengajuan	= str_replace(",","",$nominal_pengajuan);
		if(empty($idx)){
			$data_kewenangan = array(
				'barcode_pegawai' =>$barcode_pegawai,
				'id_status_diusulkan' =>$id_status_diusulkan,
				'barcode_pengajuan_temp' =>$barcode_pengajuan_temp,
				'nominal_pengajuan' =>$nominal_pengajuan,
				'id_instansi' =>$id_instansi,
				'tgl_pengajuan' => $tgl_pengajuan,
				'status_lunas' => 1,
				'id_pengajuan' => $id,
				'barcode_pengajuan' => $kode
			);			
		}else{
			$data_kewenangan = array(
				'barcode_pegawai' =>$barcode_pegawai,
				'id_status_diusulkan' =>$id_status_diusulkan,
				'barcode_pengajuan_temp' =>$barcode_pengajuan_temp,
				'nominal_pengajuan' =>$nominal_pengajuan,
				'id_instansi' =>$id_instansi,
				'tgl_pengajuan' => $tgl_pengajuan,
				'status_lunas' => 1,
				'id_pengajuan' => $id,
				'struk_pengajuan' => $idx,
				'barcode_pengajuan' => $kode
			);
		}
		return $this->db->insert('ol_pengajuan', $data_kewenangan);
	}
	function edit_pengajuan_temp($id){
		$barcode_pengajuan_temp = $this->input->post('barcode_pengajuan_temp');
		$nominal_pengajuan = $this->input->post('nominal_pengajuan');
		$nominal_pengajuan	= str_replace("'","&acute;",$nominal_pengajuan);
		$nominal_pengajuan	= str_replace(".","",$nominal_pengajuan);
		$nominal_pengajuan	= str_replace(" ","",$nominal_pengajuan);
		$nominal_pengajuan	= str_replace(",","",$nominal_pengajuan);
		if(empty($id)){
			$data_pendaftaran = array(
				'status_pengajuan_temp' => 0
			);			
		}else{
			$data_pendaftaran = array(
				'status_pengajuan_temp' => 0,
				'struk_pengajuan_temp' => $id
			);
		}
		$this->db->where('barcode_pengajuan_temp',$barcode_pengajuan_temp);
		$this->db->update('ol_pengajuan_temp', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function pengajuan_kompetensi_asli($id)
	{
	$wordsAry = explode("-", $id);
	$wordsCount = count($wordsAry);
		$fields = "*,DATE_FORMAT(tgl_pengajuan,'%d-%m-%Y') as tgl_pengajuan,DATE_FORMAT(create_pengajuan,'%d-%m-%Y %H:%i:%s') as create_pengajuan,
		FORMAT(nominal_pengajuan,'#,###,##0') as nominal_pengajuan
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
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(or.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(or.nik LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_pengajuan opt');
		$this->db->join('ol_pegawai or', 'or.barcode_pegawai=opt.barcode_pegawai','left');
		$this->db->join('ol_status_diusulkan osd', 'osd.id_status_diusulkan=opt.id_status_diusulkan','left');
		$this->db->join('kol_working ol', 'ol.id_working=opt.id_instansi','left');
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(or.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(or.nik LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
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
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(or.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(or.nik LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
			}
		  }
		}

		$this->db->from('ol_pengajuan opt');
		$this->db->join('ol_pegawai or', 'or.barcode_pegawai=opt.barcode_pegawai','left');
		$this->db->join('ol_status_diusulkan osd', 'osd.id_status_diusulkan=opt.id_status_diusulkan','left');
		$this->db->join('kol_working ol', 'ol.id_working=opt.id_instansi','left');
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(or.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(or.nik LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('ol_pengajuan');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function ambil_pengajuan_asli($id){
		$this->db->join('ol_pegawai or', 'or.barcode_pegawai=opt.barcode_pegawai','left');
		$this->db->join('ol_user ou', 'ou.id_pegawai=or.id_pegawai','left');
		$q = $this->db->get_where('ol_pengajuan opt',array('id_pengajuan'=>$id));
		return $q->row_array();
	}
	function edit_pengajuan_kompetensi($id){
		$id_pengajuan = $this->input->post('id_pengajuan');
		$id_status_diusulkan = $this->input->post('id_status_diusulkan');
		$tgl_pengajuan = $this->input->post('tgl_pengajuan');
		$tgl_pengajuan = date('Y-m-d', strtotime($tgl_pengajuan));
		$nominal_pengajuan = $this->input->post('nominal_pengajuan');
		$nominal_pengajuan	= str_replace("'","&acute;",$nominal_pengajuan);
		$nominal_pengajuan	= str_replace(".","",$nominal_pengajuan);
		$nominal_pengajuan	= str_replace(" ","",$nominal_pengajuan);
		$nominal_pengajuan	= str_replace(",","",$nominal_pengajuan);
		if(empty($id)){
			$data_pendaftaran = array(
				'id_status_diusulkan' =>$id_status_diusulkan,
				'tgl_pengajuan' => $tgl_pengajuan,
				'nominal_pengajuan' => $nominal_pengajuan
			);			
		}else{
			$data_pendaftaran = array(
				'struk_pengajuan' => $id,
				'id_status_diusulkan' =>$id_status_diusulkan,
				'tgl_pengajuan' => $tgl_pengajuan,
				'nominal_pengajuan' => $nominal_pengajuan
			);
		}
		$this->db->where('id_pengajuan',$id_pengajuan);
		$this->db->update('ol_pengajuan', $data_pendaftaran);
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
		$fields = "*,DATE_FORMAT(wkt_registrasi,'%d-%m-%Y') as wkt_registrasi,DATE_FORMAT(expired_working,'%d-%m-%Y') as expired_working,if(status_bayar_working = 1,'Premium','Free') as status_bayar_working
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
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(or.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(or.nik LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_registrasi or');
		$this->db->join('kol_working ol', 'ol.id_working=or.id_instansi','left');
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(or.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(or.nik LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
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
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(or.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(or.nik LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
			}
		  }
		}

		$this->db->from('ol_registrasi or');
		$this->db->join('kol_working ol', 'ol.id_working=or.id_instansi','left');
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(or.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(or.nik LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
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
	function ambil_registrasi($id){
		$q = $this->db->get_where('ol_registrasi reg',array('barcode_registrasi'=>$id));
		return $q->row_array();
	}
	function cmd_level(){
		$idl = array(51,53);
	//	$idl = explode(',', $idk);
		$this->db->select("id_level,nama_level");
		$this->db->where_in("id_level",$idl);
		$q= $this->db->get_where('user_level')->result_array();
		$hasil= array_column($q,'nama_level','id_level');
		return $hasil;
	}
	function simpan_aktifasi(){
		$barcode_registrasi = $this->input->post('barcode_registrasi');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$tgl_lahir = date('Y-m-d', strtotime($tgl_lahir));
		$kode = $this->m_rancak->kode_generator_urut(15,'PG');
		$data_pendaftaran = array(
			'barcode_pegawai' => $kode,		
			'nama_pegawai' => $this->input->post('nama_pegawai'),
			'jk' => $this->input->post('jk'),
			'tmp_lahir' => $this->input->post('tmp_lahir'),
			'tgl_lahir' => $tgl_lahir,
			'email' => $this->input->post('email'),
			'no_hp' => $this->input->post('no_hp'),
			'nik' => $this->input->post('nik'),
			'nip' => $this->input->post('nip'),
			'id_status_kawin' => $this->input->post('id_status_kawin'),
			'id_agama' => $this->input->post('id_agama'),
			'id_pendidikan' => $this->input->post('id_pendidikan'),
			'tipe_pegawai' => $this->input->post('tipe_pegawai'),
			'id_jabatan_fungsional' => $this->input->post('id_jabatan_fungsional'),
			'alamat' => $this->input->post('alamat')
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
		$kode = $this->m_rancak->kode_generator_urut(15,'US');
		$id_unit= $this->input->post('id_unit');
    $username= $this->input->post('username');
		$id_jabatan_fungsional= $this->input->post('id_jabatan_fungsional');
		$jabatane = $this->m_umum->ambil_data('jabatan_fungsional','id_jabatan_fungsional',$id_jabatan_fungsional);
    $unitee = $this->m_umum->ambil_data('ol_unit','id_unit',$id_unit);
		$username = strtolower($username);
		$username = str_replace(' ', '-', $username);
		$username = preg_replace('/[^A-Za-z0-9\-]/', '', $username);
		$password = hash("sha512", md5('7654321'));		
		$data_pendaftaran = array(
			'refer' => $this->input->post('id_instansi'),
			'unit' => $id_unit,
      'mas_unit' => $unitee['coun_unit'],
			'mas_ins' => $this->input->post('id_instansi'),
			'mas_kred' => $jabatane['id_jabatan'],
			'mas_asesor' => $jabatane['id_jabatan'],
			'username' => $username,
			'password' => $password,	
			'id_pegawai' => $id,
			'barcode_user' => $kode,
			'id_level' => $this->input->post('id_level')
		);
		return $this->db->insert('ol_user', $data_pendaftaran);
	}
	function simpan_pegawai_unit_user($id){
		$data_pendaftaran = array(
			'id_unit' => $this->input->post('id_unit'),
			'id_pegawai' => $id
		);
		return $this->db->insert('ol_pegawai_unit', $data_pendaftaran);
	}
	function simpan_mhs_unit_user($id){
		$peg = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$id);
		$kode = $this->m_rancak->kode_generator_urut(15,'MH');
		$data_pendaftaran = array(
			'id_pegawai_unit' => $kode,
			'id_unit' => $this->input->post('id_unit'),
			'barcode_pegawai' => $peg['barcode_pegawai']
		);
		return $this->db->insert('mhs_pegawai_unit', $data_pendaftaran);
	}
	function working_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,concat(nik,' - ',nama_pegawai) as nama_pegawai
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
//				$this->db->where('jabatan_fungsional.id_jabatan',$this->session->id_jabatan);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('kol_working');
		$this->db->join('kol_working', 'kol_working.id_working=ol_pegawai_instansi.id_instansi','left');
		$this->db->join('kol_kategori_work', 'kol_kategori_work.id_kategori_work=kol_working.id_cara_masuk','left');
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_pegawai_instansi.id_pegawai','left');
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pegawai.id_pengcab','left');
//		$this->db->where('jabatan_fungsional.id_jabatan',$this->session->id_jabatan);

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
//				$this->db->where('jabatan_fungsional.id_jabatan',$this->session->id_jabatan);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
		$this->db->from('ol_pegawai_instansi');
		$this->db->join('kol_working', 'kol_working.id_working=ol_pegawai_instansi.id_instansi','left');
		$this->db->join('kol_kategori_work', 'kol_kategori_work.id_kategori_work=kol_working.id_cara_masuk','left');
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_pegawai_instansi.id_pegawai','left');
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
//		$this->db->where('id_jabatan',$this->session->id_jabatan);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('ol_pegawai_instansi');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_pegawai_instansi(){
		$data_pendaftaran = array(
			'id_instansi' => $this->input->post('id_instansi'),
			'id_pegawai' => $this->input->post('id_pegawai'),
			'status_pegawai_instansi' => $this->input->post('status_pegawai_instansi')
		);
		return $this->db->insert('ol_pegawai_instansi', $data_pendaftaran);
	}
	function edit_pegawai_instansi(){
		$id_pegawai_instansi = $this->input->post('id_pegawai_instansi');
		$data_pendaftaran = array(
			'id_instansi' => $this->input->post('id_instansi'),
			'status_pegawai_instansi' => $this->input->post('status_pegawai_instansi')
		);
		$this->db->where('id_pegawai_instansi',$id_pegawai_instansi);
		$this->db->update('ol_pegawai_instansi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function grade_all()
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
					// case 'telp' : $nmf="peg.telp";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
//				$this->db->where('jabatan_fungsional.id_jabatan',$this->session->id_jabatan);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_pegawai_grade');
		$this->db->join('jabatan', 'jabatan.id_jabatan=ol_pegawai_grade.id_jabatan','left');

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
//				$this->db->where('jabatan_fungsional.id_jabatan',$this->session->id_jabatan);
			}
		  }
		}

		$this->db->from('ol_pegawai_grade');
		$this->db->join('jabatan', 'jabatan.id_jabatan=ol_pegawai_grade.id_jabatan','left');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('ol_pegawai_grade');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_grade(){
		$data_pendaftaran = array(
			'id_jabatan' => $this->input->post('id_jabatan'),
			'nama_grade' => $this->input->post('nama_grade'),
			'syarat_grade' => $this->input->post('syarat_grade'),
			'sifat_tugas_grade' => $this->input->post('sifat_tugas_grade')
		);
		return $this->db->insert('ol_pegawai_grade', $data_pendaftaran);
	}
	function edit_grade(){
		$id_grade = $this->input->post('id_grade');
		$data_pendaftaran = array(
			'id_jabatan' => $this->input->post('id_jabatan'),
			'nama_grade' => $this->input->post('nama_grade'),
			'syarat_grade' => $this->input->post('syarat_grade'),
			'sifat_tugas_grade' => $this->input->post('sifat_tugas_grade')
		);
		$this->db->where('id_grade',$id_grade);
		$this->db->update('ol_pegawai_grade', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function work_all()
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
					// case 'telp' : $nmf="peg.telp";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);

			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('kol_working');
	//	$this->db->join('kol_kategori_work', 'kol_kategori_work.id_kategori_work=kol_working.id_cara_masuk','left');

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
		$this->db->from('kol_working');
	//	$this->db->join('kol_kategori_work', 'kol_kategori_work.id_kategori_work=kol_working.id_cara_masuk','left');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('kol_working');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function edit_kop($id){
		$id_working = $this->input->post('id_working');
		$data_pendaftaran = array(
			'kop_working' => $id
		);
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
	function edit_kop_sm($id){
		$id_working = $this->input->post('id_working');
		$data_pendaftaran = array(
			'kop_sm_working' => $id
		);
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
	function simpan_ol_instansi(){
		$kode = $this->m_rancak->kode_generator(15,'');
		$data_pendaftaran = array(	
			'barcode_working' => $kode,
			'nama_working' => $this->input->post('nama_working'),
			'alamat_working' => $this->input->post('alamat_working'),
			'email_working' => $this->input->post('email_working'),
			'kontak_working' => $this->input->post('kontak_working')
		);
		$this->db->insert('kol_working', $data_pendaftaran);
		return $this->db->insert_id();
	}
	function edit_ol_instansi(){
		$id_working = $this->input->post('id_working');
		$data_pendaftaran = array(
			'nama_working' => $this->input->post('nama_working'),
			'alamat_working' => $this->input->post('alamat_working'),
			'email_working' => $this->input->post('email_working'),
			'kontak_working' => $this->input->post('kontak_working')
		);
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
	function aplikasi_bayar_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,FORMAT(nominal_aplikasi_bayar,'#,###,##0') as nominal_aplikasi_bayar,DATE_FORMAT(tgl_expired,'%d-%m-%Y') as tgl_expired,DATE_FORMAT(tgl_aplikasi_bayar,'%d-%m-%Y %H:%i:%s') as tgl_aplikasi_bayar,
			if(tipe_konsumen = 1,if(expired_working < CURDATE(),'Instansi Expired','Instansi AKTIF'),if(tgl_expired < CURDATE(),'Expired','AKTIF')) as tipe_konsumen,DATE_FORMAT(tgl_lahir,'%d-%m-%Y') as tgl_lahir,DATE_FORMAT(expired_working,'%d-%m-%Y') as expired_working,
			if(tipe_konsumen = 1,DATE_FORMAT(expired_working,'%d-%m-%Y'),DATE_FORMAT(tgl_expired,'%d-%m-%Y')) as expired,if(status_aplikasi_bayar =0,'Free','Premium') as status_aplikasi_bayar,if(tipe_konsumen = 1,nama_working,if(tipe_konsumen = 2,'Komite','Pribadi')) as nama_working
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
//				$this->db->where('jabatan_fungsional.id_jabatan',$this->session->id_jabatan);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('aplikasi_bayar ab');
		$this->db->join('kol_working kw', 'kw.id_working=ab.id_instansi','left');
		$this->db->join('ol_pegawai op', 'op.id_pegawai=ab.id_konsumen','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=op.id_jabatan_fungsional','left');

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
//				$this->db->where('jabatan_fungsional.id_jabatan',$this->session->id_jabatan);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
		$this->db->from('aplikasi_bayar ab');
		$this->db->join('kol_working kw', 'kw.id_working=ab.id_instansi','left');
		$this->db->join('ol_pegawai op', 'op.id_pegawai=ab.id_konsumen','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=op.id_jabatan_fungsional','left');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('aplikasi_bayar');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_aplikasi_bayar(){
		$tipe_konsumen = $this->input->post('tipe_konsumen');
		$id_instansi = $this->input->post('id_instansi');
		$tgl_expired = $this->input->post('tgl_expired');
		$tgl_expired = date('Y-m-d', strtotime($tgl_expired));
		if($tipe_konsumen == 1){
			$jml = $this->m_ol_rancak->rec_rujukan_working_null_data($id_instansi);
			if($jml == 0){
				$expired = $tgl_expired;
			}else{
				$ambil_ins = $this->m_umum->ambil_data('kol_working','id_working',$id_instansi);
				$expired = $ambil_ins['expired_working'];
			}
		}else{
			$expired = $tgl_expired;
		}
		$nominal_aplikasi_bayar = $this->input->post('nominal_aplikasi_bayar');
		$nominal_aplikasi_bayar	= str_replace("'","&acute;",$nominal_aplikasi_bayar);
		$nominal_aplikasi_bayar	= str_replace(".","",$nominal_aplikasi_bayar);
		$nominal_aplikasi_bayar	= str_replace(" ","",$nominal_aplikasi_bayar);
		$nominal_aplikasi_bayar	= str_replace(",","",$nominal_aplikasi_bayar);
		$data_pendaftaran = array(
			'id_instansi' => $this->input->post('id_instansi'),
			'id_konsumen' => $this->input->post('id_konsumen'),
			'nominal_aplikasi_bayar' => $nominal_aplikasi_bayar,
			'status_aplikasi_bayar' => $this->input->post('status_aplikasi_bayar'),
			'tgl_expired' => $expired,
			'tipe_konsumen' => $tipe_konsumen
		);
		$this->db->insert('aplikasi_bayar', $data_pendaftaran);
		return $this->db->insert_id();
	}
	function simpan_aplikasi_bayar_log($id){
		$tipe_konsumen = $this->input->post('tipe_konsumen');
		$id_instansi = $this->input->post('id_instansi');
		$tgl_expired = $this->input->post('tgl_expired');
		$tgl_expired = date('Y-m-d', strtotime($tgl_expired));
		if($tipe_konsumen == 1){
			$jml = $this->m_ol_rancak->rec_rujukan_working_null_data($id_instansi);
			if($jml == 0){
				$expired = $tgl_expired;
			}else{
				$ambil_ins = $this->m_umum->ambil_data('kol_working','id_working',$id_instansi);
				$expired = $ambil_ins['expired_working'];
			}
		}else{
			$expired = $tgl_expired;
		}
		$nominal_aplikasi_bayar = $this->input->post('nominal_aplikasi_bayar');
		$nominal_aplikasi_bayar	= str_replace("'","&acute;",$nominal_aplikasi_bayar);
		$nominal_aplikasi_bayar	= str_replace(".","",$nominal_aplikasi_bayar);
		$nominal_aplikasi_bayar	= str_replace(" ","",$nominal_aplikasi_bayar);
		$nominal_aplikasi_bayar	= str_replace(",","",$nominal_aplikasi_bayar);
		$data_pendaftaran = array(
			'id_aplikasi_bayar' => $id,
			'id_instansi' => $this->input->post('id_instansi'),
			'id_konsumen' => $this->input->post('id_konsumen'),
			'nominal_aplikasi_bayar' => $nominal_aplikasi_bayar,
			'status_aplikasi_bayar' => $this->input->post('status_aplikasi_bayar'),
			'tgl_expired' => $expired,
			'tipe_konsumen' => $tipe_konsumen
		);
		$this->db->insert('aplikasi_bayar_log', $data_pendaftaran);
		return $this->db->insert_id();
	}
	function edit_aplikasi_bayar(){
		$id_aplikasi_bayar = $this->input->post('id_aplikasi_bayar');
		$tipe_konsumen = $this->input->post('tipe_konsumen');
		$id_instansi = $this->input->post('id_instansi');
		$tgl_expired = $this->input->post('tgl_expired');
		$tgl_expired = date('Y-m-d', strtotime($tgl_expired));
		if($tipe_konsumen == 1){
			$jml = $this->m_ol_rancak->rec_rujukan_working_null_data($id_instansi);
			if($jml == 0){
				$expired = $tgl_expired;
			}else{
				$ambil_ins = $this->m_umum->ambil_data('kol_working','id_working',$id_instansi);
				$expired = $ambil_ins['expired_working'];
			}
		}else{
			$expired = $tgl_expired;
		}
		$nominal_aplikasi_bayar = $this->input->post('nominal_aplikasi_bayar');
		$nominal_aplikasi_bayar	= str_replace("'","&acute;",$nominal_aplikasi_bayar);
		$nominal_aplikasi_bayar	= str_replace(".","",$nominal_aplikasi_bayar);
		$nominal_aplikasi_bayar	= str_replace(" ","",$nominal_aplikasi_bayar);
		$nominal_aplikasi_bayar	= str_replace(",","",$nominal_aplikasi_bayar);
		$data_pendaftaran = array(
			'id_instansi' => $this->input->post('id_instansi'),
			'id_konsumen' => $this->input->post('id_konsumen'),
			'nominal_aplikasi_bayar' => $nominal_aplikasi_bayar,
			'status_aplikasi_bayar' => $this->input->post('status_aplikasi_bayar'),
			'tgl_expired' => $expired,
			'tipe_konsumen' => $tipe_konsumen
		);
		$this->db->where('id_aplikasi_bayar',$id_aplikasi_bayar);
		$this->db->update('aplikasi_bayar', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
  function ambil_data_pegawai($id)
  {
    $this->db->select("concat('Nama User : ',nama_pegawai,' Unit/Ruangan : ',nama_unit,'</strong>, Nama Instansi : ',nama_working) as nama_pegawai,barcode_pegawai");
    $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_pegawai_unit.id_pegawai','left');
    $this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
    $this->db->join('ol_unit', 'ol_unit.id_unit=ol_pegawai_unit.id_unit','left');
    $this->db->join('kol_working', 'kol_working.id_working=ol_unit.id_instansi','left');
    $q = $this->db->get_where('ol_pegawai_unit',array('status_pegawai'=>'1','visible'=>'1','ol_unit.id_instansi'=>$id))->result_array();
    $hasil= array_column($q,'nama_pegawai','barcode_pegawai');
    return $hasil;
  }
	function mitra_all($id)
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,DATE_FORMAT(tgl_awal_working_mitra,'%d-%m-%Y') as tgl_awal_working_mitra,DATE_FORMAT(tgl_akhir_working_mitra,'%d-%m-%Y') as tgl_akhir_working_mitra,
					FORMAT(nominal_working_mitra,'#,###,##0') as nominal_working_mitra,if(status_working_mitra = 1,'Premium',if(status_working_mitra = 1,'Premium',if(status_working_mitra = 2,'Free','Unset'))) as status_working_mitra
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
	//			$this->db->where("srt_struktur_jabatan.id_instansi",$id);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('kol_working_mitra');
		$this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=kol_working_mitra.barcode_pegawai','left');
    $this->db->join('kol_mitra', 'kol_mitra.id_mitra=kol_working_mitra.id_mitra','left');
    $this->db->join('srt_struktur_jabatan', 'srt_struktur_jabatan.id_struktur_jabatan=kol_mitra.id_struktur_jabatan','left');
    $this->db->join('kol_working', 'kol_working.id_working=srt_struktur_jabatan.id_instansi','left');
//		$this->db->where("srt_struktur_jabatan.id_instansi",$id);

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
	//			$this->db->where("srt_struktur_jabatan.id_instansi",$id);
			}
		  }
		}

    $this->db->from('kol_working_mitra');
    $this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=kol_working_mitra.barcode_pegawai','left');
    $this->db->join('kol_mitra', 'kol_mitra.id_mitra=kol_working_mitra.id_mitra','left');
    $this->db->join('srt_struktur_jabatan', 'srt_struktur_jabatan.id_struktur_jabatan=kol_mitra.id_struktur_jabatan','left');
    $this->db->join('kol_working', 'kol_working.id_working=srt_struktur_jabatan.id_instansi','left');
 //   $this->db->where("srt_struktur_jabatan.id_instansi",$id);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('kol_working_mitra');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_kol_working_mitra($id,$id_mitra){
		$kode = $this->m_rancak->kode_generator(15,'WM');
		$nominal_working_mitra = $this->input->post('nominal_working_mitra');
    $id_struktur_jabatan = $this->input->post('id_struktur_jabatan');
		$tgl_akhir_working_mitra = $this->input->post('tgl_akhir_working_mitra');
		$tgl_akhir_working_mitra = date('Y-m-d', strtotime($tgl_akhir_working_mitra));
		$tgl_awal_working_mitra = $this->input->post('tgl_awal_working_mitra');
		$tgl_awal_working_mitra = date('Y-m-d', strtotime($tgl_awal_working_mitra));
		$nominal_working_mitra	= str_replace("'","&acute;",$nominal_working_mitra);
		$nominal_working_mitra	= str_replace(".","",$nominal_working_mitra);
		$nominal_working_mitra	= str_replace(" ","",$nominal_working_mitra);
		$nominal_working_mitra	= str_replace(",","",$nominal_working_mitra);
		if(empty($id)){
			$data_kewenangan = array(
				'barcode_working_mitra' => $kode,
				'nominal_working_mitra' => $nominal_working_mitra,
				'id_mitra' => $id_mitra,
				'barcode_pegawai' => $this->input->post('barcode_pegawai'),
        'ket_working_mitra' => $this->input->post('ket_working_mitra'),
				'status_working_mitra' => $this->input->post('status_working_mitra'),
        'barcode_pegawai' => $this->input->post('barcode_pegawai'),
				'tgl_awal_working_mitra' => $tgl_awal_working_mitra,
				'tgl_akhir_working_mitra' => $tgl_akhir_working_mitra
			);
		}else{
			$data_kewenangan = array(
				'barcode_working_mitra' => $kode,
				'nominal_working_mitra' => $nominal_working_mitra,
				'id_mitra' => $id_mitra,
				'barcode_pegawai' => $this->input->post('barcode_pegawai'),
        'ket_working_mitra' => $this->input->post('ket_working_mitra'),
				'struk_working_mitra' => $id,
				'status_working_mitra' => $this->input->post('status_working_mitra'),
        'barcode_pegawai' => $this->input->post('barcode_pegawai'),
				'tgl_awal_working_mitra' => $tgl_awal_working_mitra,
				'tgl_akhir_working_mitra' => $tgl_akhir_working_mitra
			);
		}
		return $this->db->insert('kol_working_mitra', $data_kewenangan);
	}
	function simpan_mitra($id){
		$kode = $this->m_rancak->kode_generator(15,'KM');
		$nominal_working_mitra = $this->input->post('nominal_working_mitra');
    $tgl_akhir_working_mitra = $this->input->post('tgl_akhir_working_mitra');
		$tgl_akhir_working_mitra = date('Y-m-d', strtotime($tgl_akhir_working_mitra));
		$nominal_working_mitra	= str_replace("'","&acute;",$nominal_working_mitra);
		$nominal_working_mitra	= str_replace(".","",$nominal_working_mitra);
		$nominal_working_mitra	= str_replace(" ","",$nominal_working_mitra);
		$nominal_working_mitra	= str_replace(",","",$nominal_working_mitra);
		if(empty($id)){
			$data_kewenangan = array(
				'id_mitra' => $kode,
				'id_struktur_jabatan' => $this->input->post('id_struktur_jabatan'),
				'ket_mitra' => $this->input->post('ket_working_mitra'),
				'expired_mitra' => $tgl_akhir_working_mitra,
				'nominal_mitra' => $nominal_working_mitra
			);
		}else{
			$data_kewenangan = array(
				'id_mitra' => $kode,
				'nominal_mitra' => $nominal_working_mitra,
				'id_struktur_jabatan' => $this->input->post('id_struktur_jabatan'),
				'ket_mitra' => $this->input->post('ket_working_mitra'),
				'struk_mitra' => $id,
				'expired_mitra' => $tgl_akhir_working_mitra
			);
		}
		$this->db->insert('kol_mitra', $data_kewenangan);
		return $kode;
	}
	function edit_mitra($id){
		$nominal_working_mitra = $this->input->post('nominal_working_mitra');
    $id_struktur_jabatan = $this->input->post('id_struktur_jabatan');
		$tgl_akhir_working_mitra = $this->input->post('tgl_akhir_working_mitra');
		$tgl_akhir_working_mitra = date('Y-m-d', strtotime($tgl_akhir_working_mitra));
		$nominal_working_mitra	= str_replace("'","&acute;",$nominal_working_mitra);
		$nominal_working_mitra	= str_replace(".","",$nominal_working_mitra);
		$nominal_working_mitra	= str_replace(" ","",$nominal_working_mitra);
		$nominal_working_mitra	= str_replace(",","",$nominal_working_mitra);
		if(empty($id)){
			$data_pendaftaran = array(
				'nominal_mitra' => $nominal_working_mitra,
				'ket_mitra' => $this->input->post('ket_working_mitra'),
				'expired_mitra' => $tgl_akhir_working_mitra
			);
		}else{
			$user_pic=$this->m_umum->ambil_data('kol_mitra','id_struktur_jabatan',$id_struktur_jabatan);
			if(!empty($user_pic['struk_mitra'])){
				$cek_file=FCPATH.'assets/berkas/struk/'.$user_pic['struk_mitra'];
				if(file_exists($cek_file)){
					unlink(FCPATH."assets/berkas/struk/".$user_pic['struk_mitra']);
				}
			}			
			$data_pendaftaran = array(
				'nominal_mitra' => $nominal_working_mitra,
				'ket_mitra' => $this->input->post('ket_working_mitra'),
				'struk_mitra' => $id,
				'expired_mitra' => $tgl_akhir_working_mitra
			);
		}
		$this->db->where('id_struktur_jabatan',$id_struktur_jabatan);
		$this->db->update('kol_mitra', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function edit_kol_working_mitra($id){
		$nominal_working_mitra = $this->input->post('nominal_working_mitra');
    $id_working_mitra = $this->input->post('id_working_mitra');
    $tgl_akhir_working_mitra = $this->input->post('tgl_akhir_working_mitra');
    $tgl_akhir_working_mitra = date('Y-m-d', strtotime($tgl_akhir_working_mitra));
    $tgl_awal_working_mitra = $this->input->post('tgl_awal_working_mitra');
    $tgl_awal_working_mitra = date('Y-m-d', strtotime($tgl_awal_working_mitra));
		$nominal_working_mitra	= str_replace("'","&acute;",$nominal_working_mitra);
		$nominal_working_mitra	= str_replace(".","",$nominal_working_mitra);
		$nominal_working_mitra	= str_replace(" ","",$nominal_working_mitra);
		$nominal_working_mitra	= str_replace(",","",$nominal_working_mitra);
		if(empty($id)){
			$data_pendaftaran = array(
			'barcode_pegawai' => $this->input->post('barcode_pegawai'),
      'id_mitra' => $this->input->post('id_mitra'),
			'ket_working_mitra' => $this->input->post('ket_working_mitra'),
			'nominal_working_mitra' => $nominal_working_mitra,
			'status_working_mitra' => $this->input->post('status_working_mitra'),
        'tgl_awal_working_mitra' => $tgl_awal_working_mitra,
        'tgl_akhir_working_mitra' => $tgl_akhir_working_mitra
			);
		}else{
			$user_pic=$this->m_umum->ambil_data('kol_working_mitra','id_working_mitra',$id_working_mitra);
			if(!empty($user_pic['struk_working_mitra'])){
				$cek_file=FCPATH.'assets/berkas/struk/'.$user_pic['struk_working_mitra'];
				if(file_exists($cek_file)){
					unlink(FCPATH."assets/berkas/struk/".$user_pic['struk_working_mitra']);
				}
			}			
			$data_pendaftaran = array(
			'barcode_pegawai' => $this->input->post('barcode_pegawai'),
      'id_mitra' => $this->input->post('id_mitra'),
			'ket_working_mitra' => $this->input->post('ket_working_mitra'),
			'nominal_working_mitra' => $nominal_working_mitra,
			'struk_working_mitra' => $id,
			'status_working_mitra' => $this->input->post('status_working_mitra'),
        'tgl_awal_working_mitra' => $tgl_awal_working_mitra,
        'tgl_akhir_working_mitra' => $tgl_akhir_working_mitra
			);
		}
		$this->db->where('id_working_mitra',$id_working_mitra);
		$this->db->update('kol_working_mitra', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function pelayanan_all()
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
					// case 'telp' : $nmf="peg.telp";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
//				$this->db->where('jabatan_fungsional.id_jabatan',$this->session->id_jabatan);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_pelayanan');
		$this->db->join('kol_working', 'kol_working.id_working=ol_pelayanan.id_instansi','left');

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
//				$this->db->where('jabatan_fungsional.id_jabatan',$this->session->id_jabatan);
			}
		  }
		}

		$this->db->from('ol_pelayanan');
		$this->db->join('kol_working', 'kol_working.id_working=ol_pelayanan.id_instansi','left');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('ol_pelayanan');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_pelayanan(){
		$kode = $this->m_rancak->kode_generator(15,'PL');
		$data_pendaftaran = array(
			'kode_pelayanan' => $kode,
			'id_instansi' => $this->input->post('id_instansi'),
			'nama_pelayanan' => $this->input->post('nama_pelayanan'),
			'status_pelayanan' => $this->input->post('status_pelayanan')
		);
		return $this->db->insert('ol_pelayanan', $data_pendaftaran);
	//	return $this->db->insert_id();
	}
	function edit_pelayanan(){
		$id_pelayanan = $this->input->post('id_pelayanan');
		$data_pendaftaran = array(
			'id_instansi' => $this->input->post('id_instansi'),
			'nama_pelayanan' => $this->input->post('nama_pelayanan'),
			'status_pelayanan' => $this->input->post('status_pelayanan')
		);
		$this->db->where('id_pelayanan',$id_pelayanan);
		$this->db->update('ol_pelayanan', $data_pendaftaran);
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
		//		$this->db->where_in("ou.id_instansi",$idx);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('srt_struktur_jabatan ou');
	    $this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
	 //   $this->db->where_in("ou.id_instansi",$idx);
		
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
		//		$this->db->where_in("ou.id_instansi",$idx);
			}
		  }
		}

	    $this->db->from('srt_struktur_jabatan ou');
	    $this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
	//    $this->db->where_in("ou.id_instansi",$idx);
		
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
	function abs_kategori_absen_all()
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
		//		$this->db->where_in("ou.id_instansi",$idx);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('abs_kategori_absen ou');
	    $this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
	 //   $this->db->where_in("ou.id_instansi",$idx);
		
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
		//		$this->db->where_in("ou.id_instansi",$idx);
			}
		  }
		}

	    $this->db->from('abs_kategori_absen ou');
	    $this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
	//    $this->db->where_in("ou.id_instansi",$idx);
		
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('abs_kategori_absen');		//[coding here] ganti tabel utamanya
				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;	
	}
	function simpan_abs_kategori_absen(){
		$kode = $this->m_rancak->kode_generator_urut(15,'KA');
		$data_pendaftaran = array(
			'id_kategori_absen' => $kode,
			'nama_kategori_absen' => $this->input->post('nama_kategori_absen'),
			'id_instansi' => $this->input->post('id_instansi'),
			'status_kategori_absen' => $this->input->post('status_kategori_absen')
		);
		return $this->db->insert('abs_kategori_absen', $data_pendaftaran);
	}
	function edit_abs_kategori_absen(){
		$id_kategori_absen = $this->input->post('id_kategori_absen');
		$data_pendaftaran = array(
			'nama_kategori_absen' => $this->input->post('nama_kategori_absen'),
			'id_instansi' => $this->input->post('id_instansi'),
			'status_kategori_absen' => $this->input->post('status_kategori_absen')
		);
		$this->db->where('id_kategori_absen',$id_kategori_absen);
		$this->db->update('abs_kategori_absen', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}
	function abs_seting_all()
	{
	//	$idx = explode(',', $this->session->mas_ins);
		$fields = "*,DATE_FORMAT(clock_in,'%H:%i') as clock_in,DATE_FORMAT(clock_out,'%H:%i') as clock_out,concat(nama_unit,' - ',nama_working) as nama_unit";
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
		//		$this->db->where_in("ou.id_instansi",$idx);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('abs_seting as');
	    $this->db->join('ol_unit ou', 'ou.id_unit=as.id_unit','left');
	    $this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
		
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
		//		$this->db->where_in("ou.id_instansi",$idx);
			}
		  }
		}

	    $this->db->from('abs_seting as');
	    $this->db->join('ol_unit ou', 'ou.id_unit=as.id_unit','left');
	    $this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
	//    $this->db->where_in("ou.id_instansi",$idx);
		
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('abs_seting');		//[coding here] ganti tabel utamanya
				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;	
	}
	function simpan_abs_seting(){
		$kode = $this->m_rancak->kode_generator_urut(15,'SA');
		$clock_in = $this->input->post('clock_in');
		$clock_in = $clock_in.':00';
		$clock_out = $this->input->post('clock_out');
		$clock_out = $clock_out.':00';
		$data_pendaftaran = array(
			'id_seting' => $kode,
			'clock_in' => $clock_in,
			'clock_out' => $clock_out,
			'nama_seting' => $this->input->post('nama_seting'),
			'id_unit' => $this->input->post('id_unit'),
			'location' => $this->input->post('location'),
			'zoom' => $this->input->post('zoom'),
			'radius' => $this->input->post('radius'),
			'status_seting' => $this->input->post('status_seting')
		);
		return $this->db->insert('abs_seting', $data_pendaftaran);
	}
	function edit_abs_seting(){
		$id_seting = $this->input->post('id_seting');
		$clock_in = $this->input->post('clock_in');
		$clock_in = $clock_in.':00';
		$clock_out = $this->input->post('clock_out');
		$clock_out = $clock_out.':00';
		$data_pendaftaran = array(
			'clock_in' => $clock_in,
			'clock_out' => $clock_out,
			'nama_seting' => $this->input->post('nama_seting'),
			'id_unit' => $this->input->post('id_unit'),
			'location' => $this->input->post('location'),
			'zoom' => $this->input->post('zoom'),
			'radius' => $this->input->post('radius'),
			'status_seting' => $this->input->post('status_seting')
		);
		$this->db->where('id_seting',$id_seting);
		$this->db->update('abs_seting', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}
	function ruangan_all()
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
					// case 'telp' : $nmf="peg.telp";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
//				$this->db->where('jabatan_fungsional.id_jabatan',$this->session->id_jabatan);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_unit');
		$this->db->join('srt_struktur_jabatan', 'srt_struktur_jabatan.id_struktur_jabatan=ol_unit.id_struktur_jabatan','left');
		$this->db->join('kol_working', 'kol_working.id_working=ol_unit.id_instansi','left');

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
//				$this->db->where('jabatan_fungsional.id_jabatan',$this->session->id_jabatan);
			}
		  }
		}

		$this->db->from('ol_unit');
		$this->db->join('srt_struktur_jabatan', 'srt_struktur_jabatan.id_struktur_jabatan=ol_unit.id_struktur_jabatan','left');
		$this->db->join('kol_working', 'kol_working.id_working=ol_unit.id_instansi','left');

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
	function simpan_ruangan(){
		$kode = $this->m_rancak->kode_generator_urut(15,'OU');
		$id_struktur_jabatan = $this->input->post('id_struktur_jabatan');
		$strjab = $this->m_umum->ambil_data('srt_struktur_jabatan','id_struktur_jabatan',$id_struktur_jabatan);
		$data_pendaftaran = array(
			'id_unit' => $kode,
			'id_instansi' => $strjab['id_instansi'],
			'id_struktur_jabatan' => $this->input->post('id_struktur_jabatan'),
			'nama_unit' => $this->input->post('nama_unit'),
			'status_unit' => $this->input->post('status_unit')
		);
		return $this->db->insert('ol_unit', $data_pendaftaran);
	//	return $this->db->insert_id();
	}
	function edit_ruangan(){
		$id_unit = $this->input->post('id_unit');
		$data_pendaftaran = array(
			'id_struktur_jabatan' => $this->input->post('id_struktur_jabatan'),
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
 function kop_all()
 {
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
    switch($k['data']){  //beberapa field ambigius, so sesuaikan [coding here]
     // case 'telp' : $nmf="peg.telp";break;
     // case 'id_level'   : $nmf="u.id_level";break;
    default: $nmf=$k['data'];
    }
    $this->db->or_like($nmf, $cari['value'],'both',false);

   }
    }
  }
  $this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

  $this->db->from('kol_gambar');
  $this->db->join('kol_kategori_gambar', 'kol_kategori_gambar.id_kategori_gambar=kol_gambar.id_kategori_gambar','left');
  $this->db->join('kol_working', 'kol_working.id_working=kol_gambar.id_instansi','left');

  $q = $this->db->limit($length,$start)->get_where(); //05 Execute

  $list=$q->result_array(); //06 Hasil

 //--------- Query jumlah filter untuk paging -----
  $this->db->select("COUNT(*) as num"); //01 Select

  if(!empty($cari['value'])) {    //02 Where
    foreach($dt_kolom as $k){
   if($k['searchable']=='true'){ //cek kalo searchable
    switch($k['data']){  //beberapa field ambigius, so sesuaikan  [coding here]
    // case 'telp' : $nmf="peg.telp";break;
     default: $nmf=$k['data'];
    }
    $this->db->or_like($nmf, $cari['value'],'both',false);

   }
    }
  }

  $this->db->from('kol_gambar');
  $this->db->join('kol_kategori_gambar', 'kol_kategori_gambar.id_kategori_gambar=kol_gambar.id_kategori_gambar','left');
  $this->db->join('kol_working', 'kol_working.id_working=kol_gambar.id_instansi','left');

  $q = $this->db->get_where(); //04 Execute
  $jml_filter = $q->row()->num; //05 Hasil

 //--------- Query jumlah All data paling banyak -----
  $jml = $this->m_umum->jumlah_record_tabel('kol_gambar');  //[coding here] ganti tabel utamanya

  $output = array(
   "draw" => $draw,
    "recordsTotal" => $jml,
    "recordsFiltered" => $jml_filter,
    "data" => $list
  );
  // print_r($output);die();
  return $output;
 }
 function simpan_kol_gambar($id){
  $data_pendaftaran = array(
   'link_gambar' => $id,
   'nama_gambar' => $this->input->post('nama_gambar'),
   'id_kategori_gambar' => $this->input->post('id_kategori_gambar'),
   'id_instansi' => $this->input->post('id_instansi'),
   'status_gambar' => $this->input->post('status_gambar')
  );
  return $this->db->insert('kol_gambar', $data_pendaftaran);
 // return $this->db->insert_id();
 }
}