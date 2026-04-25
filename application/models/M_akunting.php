<?php
class M_akunting extends CI_model{
// ================================================= transaksi ==============================
	function transaksi_all($date,$first_date,$last_date)
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,DATE_FORMAT(kt.tgl_transaksi,'%d-%m-%Y') as tgl_transaksi";
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
		
	    $this->db->from('keu_transaksi kt');
		$this->db->join('keu_jenis_jurnal kjj', 'kjj.id_jenis_jurnal=kt.id_jenis_jurnal','left');
		$this->db->join('unit u', 'u.id_unit=kt.id_unit','left');
		$this->db->join('keu_dk kdk', 'kdk.id_dk=kt.id_dk','left');
		$this->db->where('ket_transaksi !=', 'SALDO AWAL');
		if($date > 0){
		$this->db->where('tgl_transaksi BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
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
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('keu_transaksi kt');
		$this->db->join('keu_jenis_jurnal kjj', 'kjj.id_jenis_jurnal=kt.id_jenis_jurnal','left');
		$this->db->join('unit u', 'u.id_unit=kt.id_unit','left');
		$this->db->join('keu_dk kdk', 'kdk.id_dk=kt.id_dk','left');
		$this->db->where('ket_transaksi !=', 'SALDO AWAL');
		if($date > 0){
		$this->db->where('tgl_transaksi BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		}
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		if($date > 0){
			$kondisi=('tgl_transaksi BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
			$jml = $this->m_umum->jumlah_record_filter('keu_transaksi',$kondisi);
		}else{
			$jml = $this->m_umum->jumlah_record_tabel('keu_transaksi');
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
	function simpan_transaksi_keuangan(){
		$tgl_transaksi = $this->input->post('tgl_transaksi');
		$tgl_transaksi = date('Y-m-d', strtotime($tgl_transaksi));	
		$totaldebet = $this->input->post('totaldebet');
		$totaldebet	= str_replace("'","&acute;",$totaldebet);
		$totaldebet	= str_replace(".","",$totaldebet);
		$totaldebet	= str_replace(" ","",$totaldebet);
		$totaldebet	= str_replace(",","",$totaldebet);
		$data_pendaftaran = array(
			'tgl_transaksi' => $tgl_transaksi,
			'no_transaksi' => $this->input->post('no_transaksi'),
			'id_jenis_jurnal' => $this->input->post('id_jenis_jurnal'),
			'id_unit' => $this->input->post('id_unit'),
			'id_dk' => $this->input->post('id_dk'),
			'ket_transaksi' => $this->input->post('ket_transaksi'),
			'total_transaksi' => $totaldebet,
			'id_user' => $_SESSION['id_user']
		);
		$this->db->insert('keu_transaksi', $data_pendaftaran);
		return $this->db->insert_id();
	}
	function edit_transaksi(){
		$id_transaksi = $this->input->post('id_transaksi');
		$log = 'EDIT TRANSAKSI';
		$tgl_transaksi = $this->input->post('tgl_transaksi');
		$tgl_transaksi = date('Y-m-d', strtotime($tgl_transaksi));
		$ket_transaksi = $this->input->post('ket_transaksi');
		$ket_transaksi = $ket_transaksi." [EDIT TRANSAKSI]";
$this->simpan_log_transaksi_keuangan($id_transaksi,$log,'0','0','0','0','0','0','0',$ket_transaksi);
		$data_pendaftaran = array(
			'tgl_transaksi' => $tgl_transaksi,
			'no_transaksi' => $this->input->post('no_transaksi'),
			'id_jenis_jurnal' => $this->input->post('id_jenis_jurnal'),
			'id_unit' => $this->input->post('id_unit'),
			'id_dk' => $this->input->post('id_dk'),
			'ket_transaksi' => $this->input->post('ket_transaksi')
		);
		$this->db->where('id_transaksi',$id_transaksi);
		$this->db->update('keu_transaksi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}
	function simpan_transaksi_kas(){
		$tgl_transaksi = $this->input->post('tgl_transaksi');
		$tgl_transaksi = date('Y-m-d', strtotime($tgl_transaksi));	
		$total = $this->input->post('total');
		$total	= str_replace("'","&acute;",$total);
		$total	= str_replace(".","",$total);
		$total	= str_replace(" ","",$total);
		$total	= str_replace(",","",$total);
		$data_pendaftaran = array(
			'tgl_transaksi' => $tgl_transaksi,
			'no_transaksi' => $this->input->post('no_transaksi'),
			'id_jenis_jurnal' => $this->input->post('id_jenis_jurnal'),
			'id_unit' => $this->input->post('id_unit'),
			'id_dk' => $this->input->post('id_dk'),
			'ket_transaksi' => $this->input->post('ket_transaksi'),
			'total_transaksi' => $total,
			'id_user' => $_SESSION['id_user']
		);
		$this->db->insert('keu_transaksi', $data_pendaftaran);
		return $this->db->insert_id();
	}
	function simpan_transaksi_detil($id,$log){
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
		$kurs_mata_uang = $this->input->post('kurs_mata_uang[]');
		$kurs_mata_uang	= str_replace("'","&acute;",$kurs_mata_uang);
		$kurs_mata_uang	= str_replace(".","",$kurs_mata_uang);
		$kurs_mata_uang	= str_replace(" ","",$kurs_mata_uang);
		$kurs_mata_uang	= str_replace(",","",$kurs_mata_uang);
		$id_mata_uang = $this->input->post('id_mata_uang[]');	
		$ket_transaksi_detil = $this->input->post('ket_transaksi_detil[]');	
		$uraian_detil = $this->input->post('uraian_detil');	
		$ket_transaksi = $this->input->post('ket_transaksi');
		$id_coa = $this->input->post('id_coa[]');		
		$jml_kode = count($id_coa);
		for ($i=0;$i<$jml_kode;$i++){ 	
$this->simpan_log_transaksi_keuangan($id,$log,$id_coa[$i],$td_debet[$i],$td_kredit[$i],$kurs_mata_uang[$i],$id_mata_uang[$i],$ket_transaksi_detil[$i],$uraian_detil,$ket_transaksi);
			$data_pendaftaran = array(
				'id_transaksi' => $id,					
				'id_coa' => $id_coa[$i],					
				'td_debet' => $td_debet[$i],					
				'td_kredit' => $td_kredit[$i],					
				'kurs_mata_uang' => $kurs_mata_uang[$i],					
				'id_mata_uang' => $id_mata_uang[$i],					
				'uraian_detil' => $uraian_detil,					
				'saldo_awal' => 0,					
				'ket_transaksi_detil' => $ket_transaksi_detil[$i]
			);
			$this->db->insert('keu_transaksi_detil', $data_pendaftaran);				
		}		
	}
	function simpan_transaksi_detil_saldo_awal($id,$log){
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
		$kurs_mata_uang = $this->input->post('kurs_mata_uang[]');
		$kurs_mata_uang	= str_replace("'","&acute;",$kurs_mata_uang);
		$kurs_mata_uang	= str_replace(".","",$kurs_mata_uang);
		$kurs_mata_uang	= str_replace(" ","",$kurs_mata_uang);
		$kurs_mata_uang	= str_replace(",","",$kurs_mata_uang);
		$id_mata_uang = $this->input->post('id_mata_uang[]');	
		$ket_transaksi_detil = $this->input->post('ket_transaksi_detil[]');	
		$uraian_detil = $this->input->post('uraian_detil');	
		$ket_transaksi = $this->input->post('ket_transaksi');
		$id_coa = $this->input->post('id_coa[]');		
		$jml_kode = count($id_coa);
		for ($i=0;$i<$jml_kode;$i++){ 	
$this->simpan_log_transaksi_keuangan($id,$log,$id_coa[$i],$td_debet[$i],$td_kredit[$i],$kurs_mata_uang[$i],$id_mata_uang[$i],$ket_transaksi_detil[$i],$uraian_detil,$ket_transaksi);
			$data_pendaftaran = array(
				'id_transaksi' => $id,					
				'id_coa' => $id_coa[$i],					
				'td_debet' => $td_debet[$i],					
				'td_kredit' => $td_kredit[$i],					
				'kurs_mata_uang' => $kurs_mata_uang[$i],					
				'id_mata_uang' => $id_mata_uang[$i],					
				'uraian_detil' => $uraian_detil,					
				'saldo_awal' => 1,					
				'ket_transaksi_detil' => $ket_transaksi_detil[$i]
			);
			$this->db->insert('keu_transaksi_detil', $data_pendaftaran);				
		}		
	}
	function simpan_log_transaksi_keuangan($id,$log,$id_coa,$td_debet,$td_kredit,$kurs_mata_uang,$id_mata_uang,$ket_transaksi_detil,$uraian_detil,$ket_transaksi){
		$tgl_transaksi = $this->input->post('tgl_transaksi');
		$tgl_transaksi = date('Y-m-d', strtotime($tgl_transaksi));	
		$no_transaksi = $this->input->post('no_transaksi');
		$id_jenis_jurnal = $this->input->post('id_jenis_jurnal');
		$id_unit = $this->input->post('id_unit');
		$id_dk = $this->input->post('id_dk');
		$data_pendaftaran = array(
			'tgl_transaksi' => $tgl_transaksi,
			'id_transaksi' => $id,
			'nama_log_transaksi' => $log,
			'no_transaksi' => $no_transaksi,
			'id_jenis_jurnal' => $id_jenis_jurnal,
			'id_unit' => $id_unit,
			'id_dk' => $id_dk,
			'ket_transaksi' => $ket_transaksi,
			'id_coa' => $id_coa,					
			'debet' => $td_debet,					
			'kredit' => $td_kredit,					
			'kurs_mata_uang' => $kurs_mata_uang,					
			'uraian_detil' => $uraian_detil,					
			'id_mata_uang' => $id_mata_uang,					
			'ket_transaksi_detil' => $ket_transaksi_detil,	
			'id_user' => $_SESSION['id_user']
		);
		return $this->db->insert('keu_log_transaksi', $data_pendaftaran);
	}
	function simpan_transaksi_detil_keluar($id,$log){
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
		$kurs_mata_uang = $this->input->post('kurs_mata_uang[]');
		$kurs_mata_uang	= str_replace("'","&acute;",$kurs_mata_uang);
		$kurs_mata_uang	= str_replace(".","",$kurs_mata_uang);
		$kurs_mata_uang	= str_replace(" ","",$kurs_mata_uang);
		$kurs_mata_uang	= str_replace(",","",$kurs_mata_uang);
		$id_mata_uang = $this->input->post('id_mata_uang[]');	
		$ket_transaksi_detil = $this->input->post('ket_transaksi_detil[]');	
		$uraian_detil = $this->input->post('uraian_detil');	
		$ket_transaksi = $this->input->post('ket_transaksi');
		$id_coa = $this->input->post('id_coa[]');		
		$jml_kode = count($id_coa);
		for ($i=0;$i<$jml_kode;$i++){ 	
$this->simpan_log_transaksi_keuangan($id,$log,$id_coa[$i],$td_kredit[$i],$td_debet[$i],$kurs_mata_uang[$i],$id_mata_uang[$i],$ket_transaksi_detil[$i],$uraian_detil,$ket_transaksi);
			$data_pendaftaran = array(
				'id_transaksi' => $id,					
				'id_coa' => $id_coa[$i],					
				'td_kredit' => $td_debet[$i],					
				'td_debet' => $td_kredit[$i],					
				'kurs_mata_uang' => $kurs_mata_uang[$i],					
				'id_mata_uang' => $id_mata_uang[$i],					
				'uraian_detil' => $uraian_detil,
				'saldo_awal' => 0,	
				'ket_transaksi_detil' => $ket_transaksi_detil[$i]
			);
			$this->db->insert('keu_transaksi_detil', $data_pendaftaran);				
		}		
	}
	function cmd_jenis_jurnal(){
		$status = array('0'=>'SEMUA JURNAL','1'=>'UMUM','2'=>'ADJUSTMENT');
		return $status;
	}
	function cmd_uraian_detil(){
		$this->db->group_by('uraian_detil'); 
		$q = $this->db->get_where('keu_transaksi_detil');
		return $q->result_array();		
	}
	function ambil_keuangan($id){
		$this->db->select("*,DATE_FORMAT(kt.tgl_transaksi,'%d-%m-%Y') as tgl_transaksi");
		$this->db->join('keu_jenis_jurnal kjj', 'kjj.id_jenis_jurnal=kt.id_jenis_jurnal','left');
		$this->db->join('user u', 'u.id_user=kt.id_user','left');
		$this->db->join('pegawai p', 'p.id_pegawai=u.id_pegawai','left');
		$this->db->join('unit un', 'un.id_unit=kt.id_unit','left');
		$this->db->join('keu_dk kdk', 'kdk.id_dk=kt.id_dk','left');
		$q = $this->db->get_where('keu_transaksi kt',array('kt.id_transaksi'=>$id));
		return $q->row_array();
	}
	function ambil_keuangan_detil($id){
		$this->db->join('keu_coa kc', 'kc.id_coa=ktd.id_coa','left');
		$this->db->join('keu_mata_uang kmu', 'kmu.id_mata_uang=ktd.id_mata_uang','left');
		$q = $this->db->get_where('keu_transaksi_detil ktd',array('ktd.id_transaksi'=>$id));
		return $q->result_array();
	}
	function ambil_transaksi_periode_jurnal($first_date,$last_date,$id,$id_jenis_jurnal){
		$id = str_replace('-', ' ', $id);
		$this->db->join('keu_transaksi kt', 'kt.id_transaksi=ktd.id_transaksi','left');
		if(!empty($id) || $id > 0){
			$this->db->where('uraian_detil', $id);
		}
		if(!empty($id_jenis_jurnal) || $id_jenis_jurnal > 0){
			$this->db->where('kt.id_jenis_jurnal', $id_jenis_jurnal);
		}
		$this->db->where('tgl_transaksi BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"'); 
		$this->db->group_by('kt.id_transaksi'); 
		$q = $this->db->get('keu_transaksi_detil ktd');
		return $q->result_array();		
	}
	function ambil_transaksi_periode_jurnal_detil($first_date,$last_date,$id,$id_jenis_jurnal,$id_transaksi){
		$id = str_replace('-', ' ', $id);
		$this->db->join('keu_transaksi kt', 'kt.id_transaksi=ktd.id_transaksi','left');
		$this->db->join('keu_coa kc', 'kc.id_coa=ktd.id_coa','left');
		if(!empty($id) || $id > 0){
			$this->db->where('uraian_detil', $id);
		}
		if(!empty($id_jenis_jurnal) || $id_jenis_jurnal > 0){
			$this->db->where('kt.id_jenis_jurnal', $id_jenis_jurnal);
		}
		$this->db->where('tgl_transaksi BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"'); 
		$this->db->where('ktd.id_transaksi', $id_transaksi);
		$q = $this->db->get('keu_transaksi_detil ktd');
		return $q->result_array();		
	}
	function ambil_coa_periode_jurnal($first_date,$last_date,$id,$transaksi,$id_jenis_jurnal){
		if($transaksi=='1'){
			$this->db->join('keu_transaksi kt', 'kt.id_transaksi=ktd.id_transaksi','left');
			$this->db->join('keu_coa kc', 'kc.id_coa=ktd.id_coa','left');
			if(!empty($id)){
				$this->db->where('ktd.id_coa', $id);
			}
			if(!empty($id_jenis_jurnal) || $id_jenis_jurnal > 0){
				$this->db->where('kt.id_jenis_jurnal', $id);
			}
			$this->db->where('tgl_transaksi BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
			$this->db->group_by('ktd.id_coa'); 
			$this->db->order_by('kode_coa', 'asc');
			$q = $this->db->get('keu_transaksi_detil ktd');
		}else{
			if(!empty($id)){
				$this->db->where('id_coa', $id);
			}
			if(!empty($id_jenis_jurnal) || $id_jenis_jurnal > 0){
				$this->db->where('kt.id_jenis_jurnal', $id);
			}
		//		$this->db->where('status_coa', '1');
				$this->db->order_by('kode_coa', 'asc');
			$q = $this->db->get('keu_coa');			
		}
		return $q->result_array();		
	}
	function ambil_coa_periode($first_date,$last_date,$id,$transaksi){
		if($transaksi=='1'){
			$this->db->join('keu_transaksi kt', 'kt.id_transaksi=ktd.id_transaksi','left');
			$this->db->join('keu_coa kc', 'kc.id_coa=ktd.id_coa','left');
			if(!empty($id)){
				$this->db->where('ktd.id_coa', $id);
			}
			$this->db->where('tgl_transaksi BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
			$this->db->group_by('ktd.id_coa'); 
			$this->db->order_by('kode_coa', 'asc');
			$q = $this->db->get('keu_transaksi_detil ktd');
		}else{
			if(!empty($id)){
				$this->db->where('id_coa', $id);
			}
			//	$this->db->where('status_coa', '1');
				$this->db->order_by('kode_coa', 'asc');
			$q = $this->db->get('keu_coa');			
		}
		return $q->result_array();		
	}
	function ambil_detil_periode($first_date,$last_date,$id){
		$this->db->join('keu_transaksi kt', 'kt.id_transaksi=ktd.id_transaksi','left');
		$this->db->join('keu_coa kc', 'kc.id_coa=ktd.id_coa','left');
		if(!empty($id)){
			$this->db->where('ktd.id_coa', $id);
		}
		$this->db->where('tgl_transaksi BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$q = $this->db->get('keu_transaksi_detil ktd');
		return $q->result_array();		
	}
	function ambil_sum_detil_periode($first_date,$last_date,$id){
		$this->db->select('SUM(td_debet) + SUM(td_kredit) as total,SUM(td_debet) as debet,SUM(td_kredit) as kredit', FALSE);
		$this->db->join('keu_transaksi kt', 'kt.id_transaksi=ktd.id_transaksi','left');
		$this->db->join('keu_coa kc', 'kc.id_coa=ktd.id_coa','left');
		if(!empty($id)){
			$this->db->where('ktd.id_coa', $id);
		}
		$this->db->where('tgl_transaksi <', date('Y-m-d', strtotime($first_date)));
		$q = $this->db->get('keu_transaksi_detil ktd');
		return $q->row_array();		
	}
	function ambil_aktiva(){	
//		if($nol =='0'){
			$this->db->where_in('id_code', ['1','2','3','4','5','6','7','8']);
			$q = $this->db->get('keu_code');
/* 		}else{
			$this->db->join('keu_transaksi kt', 'kt.id_transaksi=ktd.id_transaksi','left');
			$this->db->join('keu_coa kc', 'kc.id_coa=ktd.id_coa','left');
			$this->db->join('keu_code kcd', 'kcd.id_code=kc.id_code','left');
			$this->db->where_in('kc.id_code', ['1','2','3','4','5','6','7','8']);
			$this->db->where('tgl_transaksi', date('Y-m-d', strtotime($first_date)));
			$q = $this->db->get('keu_transaksi_detil ktd');
		}	 */		
		return $q->result_array();	
	}
	function ambil_passiva(){
	//	if($nol =='0'){
			$this->db->where_in('id_code', ['9','10','11','12','13','14','15','16','17','18']);
			$q = $this->db->get('keu_code');	
/* 		}else{
			$this->db->join('keu_transaksi kt', 'kt.id_transaksi=ktd.id_transaksi','left');
			$this->db->join('keu_coa kc', 'kc.id_coa=ktd.id_coa','left');
			$this->db->join('keu_code kcd', 'kcd.id_code=kc.id_code','left');
			$this->db->where_in('kc.id_code', ['9','10','11','12','13','14','15','16','17','18']);
			$this->db->where('tgl_transaksi', date('Y-m-d', strtotime($first_date)));
			$q = $this->db->get('keu_transaksi_detil ktd');
		} */			
		return $q->result_array();	
	}
	function ambil_code($id,$first_date){
/* 		if($nol =='0'){
			$q = $this->db->get_where('keu_coa ktd',array('id_code'=>$id));	
		}else{ */
			$this->db->join('keu_transaksi kt', 'kt.id_transaksi=ktd.id_transaksi','left');
			$this->db->join('keu_coa kc', 'kc.id_coa=ktd.id_coa','left');
			$this->db->where('kc.id_code', $id);
			$this->db->where('tgl_transaksi', date('Y-m-d', strtotime($first_date)));
			$q = $this->db->get('keu_transaksi_detil ktd');
	//	}	
		return $q->result_array();	
	}
	function ambil_transaksi_aktiva_periode($first_date,$id){
		$this->db->select('*,ABS(SUM(ktd.td_debet)-SUM(ktd.td_kredit)) as selisih', FALSE);
		$this->db->join('keu_transaksi kt', 'kt.id_transaksi=ktd.id_transaksi','left');
		$this->db->join('keu_coa kc', 'kc.id_coa=ktd.id_coa','left');
		$this->db->where('kc.id_code', $id);
	//	$this->db->where('saldo_awal','0');
	//	$this->db->group_by('ktd.id_transaksi'); 
		$this->db->where('tgl_transaksi', date('Y-m-d', strtotime($first_date)));
		$q = $this->db->get('keu_transaksi_detil ktd');
		return $q->result_array();		
	}
	function ambil_transaksi_passiva_periode($first_date,$id){
		$this->db->select('*,ABS(SUM(ktd.td_debet)-SUM(ktd.td_kredit)) as selisih', FALSE);
		$this->db->join('keu_transaksi kt', 'kt.id_transaksi=ktd.id_transaksi','left');
		$this->db->join('keu_coa kc', 'kc.id_coa=ktd.id_coa','left');
		$this->db->where('kc.id_code', $id);
	//	$this->db->where('saldo_awal','0');
	//	$this->db->group_by('ktd.id_transaksi'); 
		$this->db->where('tgl_transaksi', date('Y-m-d', strtotime($first_date)));
		$q = $this->db->get('keu_transaksi_detil ktd');
		return $q->result_array();		
	}
	function jumlah_code($first_date,$last_date,$id)	//sa.php
	{
		$this->db->select('COUNT(*) as num');
		$this->db->join('keu_transaksi kt', 'kt.id_transaksi=ktd.id_transaksi','left');
		$this->db->join('keu_coa kc', 'kc.id_coa=ktd.id_coa','left');
		$this->db->where('ktd.id_coa', $id);
		$this->db->where('tgl_transaksi BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$query = $this->db->get('keu_transaksi_detil ktd');
	    $result = $query->row();
	    if(isset($result)) 
	    	return $result->num;
	    return 0;
	}
	function ambil_transaksi_periode($first_date,$id){
		$this->db->select('*,ABS(SUM(ktd.td_debet)-SUM(ktd.td_kredit)) as selisih', FALSE);
		$this->db->join('keu_transaksi kt', 'kt.id_transaksi=ktd.id_transaksi','left');
		$this->db->join('keu_coa kc', 'kc.id_coa=ktd.id_coa','left');
		$this->db->where('kc.id_code', $id);
	//	$this->db->where('saldo_awal','0');
	//	$this->db->group_by('ktd.id_transaksi'); 
		$this->db->where('tgl_transaksi', date('Y-m-d', strtotime($first_date)));
		$q = $this->db->get('keu_transaksi_detil ktd');
		return $q->result_array();		
	}
	function ambil_range_code($id,$first_date,$last_date){
		$this->db->select('*,ABS(SUM(ktd.td_debet)-SUM(ktd.td_kredit)) as selisih', FALSE);
		$this->db->join('keu_transaksi kt', 'kt.id_transaksi=ktd.id_transaksi','left');
		$this->db->join('keu_coa kc', 'kc.id_coa=ktd.id_coa','left');
		$this->db->where('kc.id_code', $id);
		$this->db->where('tgl_transaksi BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$q = $this->db->get('keu_transaksi_detil ktd');
		return $q->result_array();	
	}
	function ambil_pendapatan(){	
		$this->db->where_in('id_code', ['14']);
		$q = $this->db->get('keu_code');	
		return $q->result_array();	
	}
	function ambil_pendapatan_lain(){	
		$this->db->where_in('id_code', ['15']);
		$q = $this->db->get('keu_code');	
		return $q->result_array();	
	}	
	function ambil_hpp(){	
		$this->db->where_in('id_code', ['16']);
		$q = $this->db->get('keu_code');	
		return $q->result_array();	
	}
	function ambil_biaya(){	
		$this->db->where_in('id_code', ['17']);
		$q = $this->db->get('keu_code');	
		return $q->result_array();	
	}
	function ambil_biaya_lainnya(){	
		$this->db->where_in('id_code', ['18']);
		$q = $this->db->get('keu_code');	
		return $q->result_array();	
	}
	function ambil_transaksi($id){
		$this->db->join('unit u', 'u.id_unit=kt.id_unit','left');
		$this->db->join('keu_dk kdk', 'kdk.id_dk=kt.id_dk','left');
		$this->db->join('keu_jenis_jurnal kjj', 'kjj.id_jenis_jurnal=kt.id_jenis_jurnal','left');
		$q = $this->db->get_where('keu_transaksi kt',array('kt.id_transaksi'=>$id));
		return $q->row_array();
	}
	function ambil_only_transaksi_detil($id){	
		$this->db->join('keu_coa kc', 'kc.id_coa=ktd.id_coa','left');
		$q = $this->db->get_where('keu_transaksi_detil ktd',array('id_transaksi'=>$id));	
		return $q->result_array();	
	}
	function ambil_keu_order_beli($id){
		$this->db->select("*,DATE_FORMAT(tgl_order_beli,'%d-%m-%Y') as tgl_order_beli,if (kob.id_termin = '0' ,'Tunai',nama_termin) as nama_termin,
					if (pajak = '0' ,'Tanpa Pajak',if (pajak = '1' ,'Sudah Termasuk Pajak','Belum Termasuk Pajak')) as pajak");
		$this->db->join('unit u', 'u.id_unit=kob.id_unit','left');
		$this->db->join('keu_dk kdk', 'kdk.id_dk=kob.id_dk','left');
		$this->db->join('kol_termin kter', 'kter.id_termin=kob.id_termin','left');
		$q = $this->db->get_where('keu_order_beli kob',array('kob.id_order_beli'=>$id));
		return $q->row_array();
	}
	function ambil_only_ob_detil($id){	
		$this->db->join('keu_barang kb', 'kb.id_barang=kod.id_barang','left');
		$this->db->join('kol_satuan kbsr', 'kbsr.id_satuan=kod.satuan_besar','left');
		$q = $this->db->get_where('keu_ob_detil kod',array('id_order_beli'=>$id));	
		return $q->result_array();	
	}
// ================================================= transaksi ==============================
	function order_beli_all($date,$first_date,$last_date,$all)
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,DATE_FORMAT(tgl_order_beli,'%d-%m-%Y') as tgl_order_beli,if (status_order_beli = '1' ,'Done','Proses') as status_order_beli,
					if (pajak = '0' ,'Tanpa Pajak',if (pajak = '1' ,'Belum Pajak','Pajak')) as pajak,FORMAT(diskon_order_beli,'#,###,##0') as diskon_order_beli,
					FORMAT(subtotal_order_beli,'#,###,##0') as subtotal_order_beli,FORMAT(ppn_order_beli,'#,###,##0') as ppn_order_beli,
					FORMAT(total_order_beli,'#,###,##0') as total_order_beli,kob.alamat as address";
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
		
	    $this->db->from('keu_order_beli kob');
		$this->db->join('unit u', 'u.id_unit=kob.id_unit','left');
		$this->db->join('keu_dk kdk', 'kdk.id_dk=kob.id_dk','left');
		$this->db->join('kol_termin kt', 'kt.id_termin=kob.id_termin','left');
		$this->db->join('user us', 'us.id_user=kob.id_user','left');
		$this->db->join('pegawai peg', 'peg.id_pegawai=us.id_pegawai','left');
		if($date > 0){
		$this->db->where('tgl_order_beli BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		}
		if($all !== 'All'){
		$this->db->where('status_order_beli', $all);
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
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('keu_order_beli kob');
		$this->db->join('unit u', 'u.id_unit=kob.id_unit','left');
		$this->db->join('keu_dk kdk', 'kdk.id_dk=kob.id_dk','left');
		$this->db->join('kol_termin kt', 'kt.id_termin=kob.id_termin','left');
		$this->db->join('user us', 'us.id_user=kob.id_user','left');
		$this->db->join('pegawai peg', 'peg.id_pegawai=us.id_pegawai','left');
		if($date > 0){
		$this->db->where('tgl_order_beli BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		}
		if($all !== 'All'){
		$this->db->where('status_order_beli', $all);
		}		
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		if($date > 0){
			$kondisi=('tgl_order_beli BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
			$jml = $this->m_umum->jumlah_record_filter('keu_order_beli',$kondisi);
		}else{
			$jml = $this->m_umum->jumlah_record_tabel('keu_order_beli');
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
	function get_last_temp_ob(){
		$this->db->order_by('id_temp_ob_detil', 'desc');
		$q = $this->db->get_where('temp_ob_detil');
		return $q->row_array();
	}
	function num_last_temp_ob()	//sa.php
	{
        //Cari id terakhir dengan unit dan tanggal yang sama
        $this->db->select("id_temp_ob_detil");
        $this->db->order_by('id_temp_ob_detil', 'DESC');     
        $query=$this->db->get_where("temp_ob_detil");
        $result = $query->row();
        // echo $this->db->last_query();
        // echo "No Antri = ".$result->no_antri;die();
        if(isset($result)) 
            return $result->id_temp_ob_detil;
        return 0;
	}
	function simpan_tmp_order_beli(){
		$tgl_order_beli = $this->input->post('tgl_order_beli');
		$tgl_order_beli = date('Y-m-d', strtotime($tgl_order_beli));	
		$harga_ob_detil = $this->input->post('harga_ob_detil');
		$harga_ob_detil	= str_replace("'","&acute;",$harga_ob_detil);
		$harga_ob_detil	= str_replace(".","",$harga_ob_detil);
		$harga_ob_detil	= str_replace(" ","",$harga_ob_detil);
		$harga_ob_detil	= str_replace(",","",$harga_ob_detil);
		$persen_ob_detil = $this->input->post('persen_ob_detil');
		$diskon_ob_detil = $this->input->post('diskon_ob_detil');
		$diskon_ob_detil	= str_replace("'","&acute;",$diskon_ob_detil);
		$diskon_ob_detil	= str_replace(".","",$diskon_ob_detil);
		$diskon_ob_detil	= str_replace(" ","",$diskon_ob_detil);
		$diskon_ob_detil	= str_replace(",","",$diskon_ob_detil);	
		$total_ob_detil = $this->input->post('total_ob_detil');
		$total_ob_detil	= str_replace("'","&acute;",$total_ob_detil);
		$total_ob_detil	= str_replace(".","",$total_ob_detil);
		$total_ob_detil	= str_replace(" ","",$total_ob_detil);
		$total_ob_detil	= str_replace(",","",$total_ob_detil);	
		$jml_last_id = $this->num_last_temp_ob();
		if($jml_last_id == 0){
			$ide = 1;
		}else{
			$last_id = $this->get_last_temp_ob();
			$ide = $last_id['id_temp_ob_detil'] + 1;			
		}
		if ($diskon_ob_detil > 0 && $persen_ob_detil > 0 ) {
			$diskon_ob_detil = 0;
		}
		$data_pendaftaran = array(
			'id_temp_ob_detil' => $ide,
			'tgl_order_beli' => $tgl_order_beli,
			'no_order_beli' => $this->input->post('no_order_beli'),
			'id_dk' => $this->input->post('id_dk'),
			'id_unit' => $this->input->post('id_unit'),
			'id_termin' => $this->input->post('id_termin'),
			'ket_order_beli' => $this->input->post('ket_order_beli'),
			'pajak' => $this->input->post('pajak'),
			'kontak' => $this->input->post('kontak'),
			'alamat' => $this->input->post('alamat'),
			'id_barang' => $this->input->post('id_barang'),
			'merk_ob_detil' => $this->input->post('merk_ob_detil'),
			'jml_ob_detil' => $this->input->post('jml_ob_detil'),
			'persen_ob_detil' => $persen_ob_detil,
			'satuan_besar' => $this->input->post('satuan_besar'),
			'konversi' => $this->input->post('konversi'),
			'satuan_kecil' => $this->input->post('satuan_kecil'),
			'ket_ob_detil' => $this->input->post('ket_ob_detil'),
			'harga_ob_detil' => $harga_ob_detil,
			'diskon_ob_detil' => $diskon_ob_detil,
			'total_ob_detil' => $total_ob_detil,
			'id_user' => $this->session->id_user,
			'temp' => $this->session->temp
		);
		return $this->db->insert('temp_ob_detil', $data_pendaftaran);
	}
	function ambil_temp_ob_detil(){	
		$this->db->join('keu_barang kb', 'kb.id_barang=tod.id_barang','left');
		$q = $this->db->get_where('temp_ob_detil tod',array('id_user'=>$this->session->id_user,'temp'=>$this->session->temp));	
		return $q->result_array();	
	}
	function simpan_keu_order_beli(){
		$tgl_order_beli = $this->input->post('tgl_order_beli');
		$tgl_order_beli = date('Y-m-d', strtotime($tgl_order_beli));	
		$diskon_order_beli = $this->input->post('diskon_order_beli');
		$diskon_order_beli	= str_replace("'","&acute;",$diskon_order_beli);
		$diskon_order_beli	= str_replace(".","",$diskon_order_beli);
		$diskon_order_beli	= str_replace(" ","",$diskon_order_beli);
		$diskon_order_beli	= str_replace(",","",$diskon_order_beli);		
		$subtotal_order_beli = $this->input->post('subtotal_order_beli');
		$subtotal_order_beli	= str_replace("'","&acute;",$subtotal_order_beli);
		$subtotal_order_beli	= str_replace(".","",$subtotal_order_beli);
		$subtotal_order_beli	= str_replace(" ","",$subtotal_order_beli);
		$subtotal_order_beli	= str_replace(",","",$subtotal_order_beli);		
		$ppn_order_beli = $this->input->post('ppn_order_beli');
		$ppn_order_beli	= str_replace("'","&acute;",$ppn_order_beli);
		$ppn_order_beli	= str_replace(".","",$ppn_order_beli);
		$ppn_order_beli	= str_replace(" ","",$ppn_order_beli);
		$ppn_order_beli	= str_replace(",","",$ppn_order_beli);			
		$total_order_beli = $this->input->post('total_order_beli');
		$total_order_beli	= str_replace("'","&acute;",$total_order_beli);
		$total_order_beli	= str_replace(".","",$total_order_beli);
		$total_order_beli	= str_replace(" ","",$total_order_beli);
		$total_order_beli	= str_replace(",","",$total_order_beli);
		$data_pendaftaran = array(
			'tgl_order_beli' => $tgl_order_beli,
			'no_order_beli' => $this->input->post('no_order_beli'),
			'id_dk' => $this->input->post('id_dk'),
			'id_unit' => $this->input->post('id_unit'),
			'id_termin' => $this->input->post('id_termin'),
			'ket_order_beli' => $this->input->post('ket_order_beli'),
			'pajak' => $this->input->post('pajak'),
			'kontak' => $this->input->post('kontak'),
			'alamat' => $this->input->post('alamat'),
			'diskon_order_beli' => $diskon_order_beli,
			'persen_order_beli' => $this->input->post('persen_order_beli'),
			'subtotal_order_beli' => $subtotal_order_beli,
			'ppn_order_beli' => $ppn_order_beli,
			'total_order_beli' => $total_order_beli,
			'status_order_beli' => 0,
			'id_user' => $this->session->id_user
		);
		$this->db->insert('keu_order_beli', $data_pendaftaran);
		return $this->db->insert_id();
	}
	function simpan_ob_detil($id){
		$temp = $this->ambil_temp_ob_detil();
		foreach($temp as $rowtemp){
			$id_barang = $rowtemp['id_barang'];
			$merk_ob_detil = $rowtemp['merk_ob_detil'];
			$jml_ob_detil = $rowtemp['jml_ob_detil'];
			$satuan_besar = $rowtemp['satuan_besar'];
			$konversi = $rowtemp['konversi'];
			$satuan_kecil = $rowtemp['satuan_kecil'];
			$harga_ob_detil = $rowtemp['harga_ob_detil'];
			$diskon_ob_detil = $rowtemp['diskon_ob_detil'];
			$persen_ob_detil = $rowtemp['persen_ob_detil'];
			$total_ob_detil = $rowtemp['total_ob_detil'];
			$data_pendaftaran = array(
				'id_order_beli' => $id,
				'id_barang' => $id_barang,
				'merk_ob_detil' => $merk_ob_detil,
				'jml_ob_detil' => $jml_ob_detil,
				'satuan_besar' => $satuan_besar,
				'konversi' => $konversi,
				'satuan_kecil' => $satuan_kecil,
				'ket_ob_detil' => $this->input->post('ket_ob_detil'),
				'harga_ob_detil' => $harga_ob_detil,
				'diskon_ob_detil' => $diskon_ob_detil,
				'persen_ob_detil' => $persen_ob_detil,
				'total_ob_detil' => $total_ob_detil,
				'status_ob_detil' => 0
			);
			$this->db->insert('keu_ob_detil', $data_pendaftaran);			
		}
	}
	function simpan_keu_log_ob($id,$log){
		$tgl_order_beli = $this->input->post('tgl_order_beli');
		$tgl_order_beli = date('Y-m-d', strtotime($tgl_order_beli));	
		$diskon_order_beli = $this->input->post('diskon_order_beli');
		$diskon_order_beli	= str_replace("'","&acute;",$diskon_order_beli);
		$diskon_order_beli	= str_replace(".","",$diskon_order_beli);
		$diskon_order_beli	= str_replace(" ","",$diskon_order_beli);
		$diskon_order_beli	= str_replace(",","",$diskon_order_beli);		
		$subtotal_order_beli = $this->input->post('subtotal_order_beli');
		$subtotal_order_beli	= str_replace("'","&acute;",$subtotal_order_beli);
		$subtotal_order_beli	= str_replace(".","",$subtotal_order_beli);
		$subtotal_order_beli	= str_replace(" ","",$subtotal_order_beli);
		$subtotal_order_beli	= str_replace(",","",$subtotal_order_beli);		
		$ppn_order_beli = $this->input->post('ppn_order_beli');
		$ppn_order_beli	= str_replace("'","&acute;",$ppn_order_beli);
		$ppn_order_beli	= str_replace(".","",$ppn_order_beli);
		$ppn_order_beli	= str_replace(" ","",$ppn_order_beli);
		$ppn_order_beli	= str_replace(",","",$ppn_order_beli);			
		$total_order_beli = $this->input->post('total_order_beli');
		$total_order_beli	= str_replace("'","&acute;",$total_order_beli);
		$total_order_beli	= str_replace(".","",$total_order_beli);
		$total_order_beli	= str_replace(" ","",$total_order_beli);
		$total_order_beli	= str_replace(",","",$total_order_beli);
		$temp = $this->ambil_temp_ob_detil();
		foreach($temp as $rowtemp){
			$id_barang = $rowtemp['id_barang'];
			$merk_ob_detil = $rowtemp['merk_ob_detil'];
			$jml_ob_detil = $rowtemp['jml_ob_detil'];
			$satuan_besar = $rowtemp['satuan_besar'];
			$konversi = $rowtemp['konversi'];
			$satuan_kecil = $rowtemp['satuan_kecil'];
			$harga_ob_detil = $rowtemp['harga_ob_detil'];
			$diskon_ob_detil = $rowtemp['diskon_ob_detil'];
			$persen_ob_detil = $rowtemp['persen_ob_detil'];
			$total_ob_detil = $rowtemp['total_ob_detil'];
			$ket_ob_detil = $rowtemp['ket_ob_detil'];
			$data_pendaftaran = array(
				'tgl_order_beli' => $tgl_order_beli,
				'no_order_beli' => $this->input->post('no_order_beli'),
				'id_dk' => $this->input->post('id_dk'),
				'id_unit' => $this->input->post('id_unit'),
				'id_termin' => $this->input->post('id_termin'),
				'ket_order_beli' => $this->input->post('ket_order_beli'),
				'pajak' => $this->input->post('pajak'),
				'kontak' => $this->input->post('kontak'),
				'alamat' => $this->input->post('alamat'),
				'diskon_order_beli' => $diskon_order_beli,
				'persen_order_beli' => $this->input->post('persen_order_beli'),
				'subtotal_order_beli' => $subtotal_order_beli,
				'ppn_order_beli' => $ppn_order_beli,
				'total_order_beli' => $total_order_beli,
				'status_order_beli' => 0,
				'id_order_beli' => $id,
				'id_ob_detil' => 0,
				'id_barang' => $id_barang,
				'merk_ob_detil' => $merk_ob_detil,
				'jml_ob_detil' => $jml_ob_detil,
				'satuan_besar' => $satuan_besar,
				'konversi' => $konversi,
				'satuan_kecil' => $satuan_kecil,
				'ket_ob_detil' => $ket_ob_detil,
				'harga_ob_detil' => $harga_ob_detil,
				'diskon_ob_detil' => $diskon_ob_detil,
				'persen_ob_detil' => $persen_ob_detil,
				'total_ob_detil' => $total_ob_detil,
				'status_ob_detil' => 0,
				'ket_log_ob' => $log,
				'id_user' => $this->session->id_user
			);
			$this->db->insert('keu_log_ob', $data_pendaftaran);			
		}
	}
	function ambil_keu_ob_detil($id){
		$this->db->select('*,kbsr.nama_satuan as satuan_besar, kkcl.nama_satuan as satuan_kecil');
		$this->db->join('keu_barang kb', 'kb.id_barang=tod.id_barang','left');
		$this->db->join('kol_satuan kbsr', 'kbsr.id_satuan=tod.satuan_besar','left');
		$this->db->join('kol_satuan kkcl', 'kkcl.id_satuan=tod.satuan_kecil','left');
		$q = $this->db->get_where('keu_ob_detil tod',array('id_order_beli'=>$id));	
		return $q->result_array();	
	}
	function simpan_tambah_keu_log_ob($id,$log){
		$ob = $this->m_umum->ambil_data('keu_order_beli','id_order_beli',$id);		
		$tgl_order_beli = $ob['tgl_order_beli'];
		$no_order_beli = $ob['no_order_beli'];
		$id_dk = $ob['id_dk'];
		$id_unit = $ob['id_unit'];
		$id_termin = $ob['id_termin'];
		$ket_order_beli = $ob['ket_order_beli'];
		$pajak = $ob['pajak'];
		$kontak = $ob['kontak'];
		$alamat = $ob['alamat'];
		$diskon_order_beli = $ob['diskon_order_beli'];
		$persen_order_beli = $ob['persen_order_beli'];
		$subtotal_order_beli = $ob['subtotal_order_beli'];
		$ppn_order_beli = $ob['ppn_order_beli'];
		$total_order_beli = $ob['total_order_beli'];
		$status_order_beli = $ob['status_order_beli'];
		$harga_ob_detil = $this->input->post('harga_ob_detil');
		$harga_ob_detil	= str_replace("'","&acute;",$harga_ob_detil);
		$harga_ob_detil	= str_replace(".","",$harga_ob_detil);
		$harga_ob_detil	= str_replace(" ","",$harga_ob_detil);
		$harga_ob_detil	= str_replace(",","",$harga_ob_detil);		
		$diskon_ob_detil = $this->input->post('diskon_ob_detil');
		$diskon_ob_detil = str_replace("'","&acute;",$diskon_ob_detil);
		$diskon_ob_detil = str_replace(".","",$diskon_ob_detil);
		$diskon_ob_detil = str_replace(" ","",$diskon_ob_detil);
		$diskon_ob_detil = str_replace(",","",$diskon_ob_detil);		
		$total_ob_detil = $this->input->post('total_ob_detil');
		$total_ob_detil = str_replace("'","&acute;",$total_ob_detil);
		$total_ob_detil = str_replace(".","",$total_ob_detil);
		$total_ob_detil = str_replace(" ","",$total_ob_detil);
		$total_ob_detil = str_replace(",","",$total_ob_detil);
		$data_pendaftaran = array(
			'tgl_order_beli' => $tgl_order_beli,
			'no_order_beli' => $no_order_beli,
			'id_dk' => $id_dk,
			'id_unit' => $id_unit,
			'id_termin' => $id_termin,
			'ket_order_beli' => $ket_order_beli,
			'pajak' => $pajak,
			'kontak' => $kontak,
			'alamat' => $alamat,
			'diskon_order_beli' => $diskon_order_beli,
			'persen_order_beli' => $persen_order_beli,
			'subtotal_order_beli' => $subtotal_order_beli,
			'ppn_order_beli' => $ppn_order_beli,
			'total_order_beli' => $total_order_beli,
			'status_order_beli' => $status_order_beli,
			'id_ob_detil' => 0,
			'id_order_beli' => $id,
			'id_barang' => $this->input->post('id_barang'),
			'merk_ob_detil' => $this->input->post('merk_ob_detil'),
			'jml_ob_detil' => $this->input->post('jml_ob_detil'),
			'satuan_besar' => $this->input->post('satuan_besar'),
			'konversi' => $this->input->post('konversi'),
			'satuan_kecil' => $this->input->post('satuan_kecil'),
			'ket_ob_detil' => $this->input->post('ket_ob_detil'),
			'harga_ob_detil' => $harga_ob_detil,
			'diskon_ob_detil' => $diskon_ob_detil,
			'persen_ob_detil' => $this->input->post('persen_ob_detil'),
			'total_ob_detil' => $total_ob_detil,
			'status_ob_detil' => 0,
			'ket_log_ob' => $log,
			'id_user' => $this->session->id_user
		);
		$this->db->insert('keu_log_ob', $data_pendaftaran);			
	}
	function simpan_hapus_keu_log_ob($id,$log){
		$obd = $this->m_umum->ambil_data('keu_ob_detil','id_ob_detil',$id);
		$ob = $this->m_umum->ambil_data('keu_order_beli','id_order_beli',$obd['id_order_beli']);		
		$tgl_order_beli = $ob['tgl_order_beli'];
		$no_order_beli = $ob['no_order_beli'];
		$id_dk = $ob['id_dk'];
		$id_unit = $ob['id_unit'];
		$id_termin = $ob['id_termin'];
		$ket_order_beli = $ob['ket_order_beli'];
		$pajak = $ob['pajak'];
		$kontak = $ob['kontak'];
		$alamat = $ob['alamat'];
		$diskon_order_beli = $ob['diskon_order_beli'];
		$persen_order_beli = $ob['persen_order_beli'];
		$subtotal_order_beli = $ob['subtotal_order_beli'];
		$ppn_order_beli = $ob['ppn_order_beli'];
		$total_order_beli = $ob['total_order_beli'];
		$status_order_beli = $ob['status_order_beli'];
		$id_order_beli = $obd['id_order_beli'];
		$id_barang = $obd['id_barang'];
		$merk_ob_detil = $obd['merk_ob_detil'];
		$jml_ob_detil = $obd['jml_ob_detil'];
		$satuan_besar = $obd['satuan_besar'];
		$konversi = $obd['konversi'];
		$satuan_kecil = $obd['satuan_kecil'];
		$harga_ob_detil = $obd['harga_ob_detil'];
		$diskon_ob_detil = $obd['diskon_ob_detil'];
		$persen_ob_detil = $obd['persen_ob_detil'];
		$total_ob_detil = $obd['total_ob_detil'];
		$ket_ob_detil = $obd['ket_ob_detil'];
		$status_ob_detil = $obd['status_ob_detil'];
		$data_pendaftaran = array(
			'tgl_order_beli' => $tgl_order_beli,
			'no_order_beli' => $no_order_beli,
			'id_dk' => $id_dk,
			'id_unit' => $id_unit,
			'id_termin' => $id_termin,
			'ket_order_beli' => $ket_order_beli,
			'pajak' => $pajak,
			'kontak' => $kontak,
			'alamat' => $alamat,
			'diskon_order_beli' => $diskon_order_beli,
			'persen_order_beli' => $persen_order_beli,
			'subtotal_order_beli' => $subtotal_order_beli,
			'ppn_order_beli' => $ppn_order_beli,
			'total_order_beli' => $total_order_beli,
			'status_order_beli' => $status_order_beli,
			'id_ob_detil' => $id,
			'id_order_beli' => $id_order_beli,
			'id_barang' => $id_barang,
			'merk_ob_detil' => $merk_ob_detil,
			'jml_ob_detil' => $jml_ob_detil,
			'satuan_besar' => $satuan_besar,
			'konversi' => $konversi,
			'satuan_kecil' => $satuan_kecil,
			'ket_ob_detil' => $ket_ob_detil,
			'harga_ob_detil' => $harga_ob_detil,
			'diskon_ob_detil' => $diskon_ob_detil,
			'persen_ob_detil' => $persen_ob_detil,
			'total_ob_detil' => $total_ob_detil,
			'status_ob_detil' => $status_ob_detil,
			'ket_log_ob' => $log,
			'id_user' => $this->session->id_user
		);
		$this->db->insert('keu_log_ob', $data_pendaftaran);			
	}
	function simpan_keu_ob_detil(){
		$tgl_order_beli = $this->input->post('tgl_order_beli');
		$tgl_order_beli = date('Y-m-d', strtotime($tgl_order_beli));	
		$harga_ob_detil = $this->input->post('harga_ob_detil');
		$harga_ob_detil	= str_replace("'","&acute;",$harga_ob_detil);
		$harga_ob_detil	= str_replace(".","",$harga_ob_detil);
		$harga_ob_detil	= str_replace(" ","",$harga_ob_detil);
		$harga_ob_detil	= str_replace(",","",$harga_ob_detil);
		$persen_ob_detil = $this->input->post('persen_ob_detil');
		$diskon_ob_detil = $this->input->post('diskon_ob_detil');
		$diskon_ob_detil	= str_replace("'","&acute;",$diskon_ob_detil);
		$diskon_ob_detil	= str_replace(".","",$diskon_ob_detil);
		$diskon_ob_detil	= str_replace(" ","",$diskon_ob_detil);
		$diskon_ob_detil	= str_replace(",","",$diskon_ob_detil);	
		$total_ob_detil = $this->input->post('total_ob_detil');
		$total_ob_detil	= str_replace("'","&acute;",$total_ob_detil);
		$total_ob_detil	= str_replace(".","",$total_ob_detil);
		$total_ob_detil	= str_replace(" ","",$total_ob_detil);
		$total_ob_detil	= str_replace(",","",$total_ob_detil);	
		$data_pendaftaran = array(
			'id_order_beli' => $this->input->post('id_order_beli'),
			'id_barang' => $this->input->post('id_barang'),
			'merk_ob_detil' => $this->input->post('merk_ob_detil'),
			'jml_ob_detil' => $this->input->post('jml_ob_detil'),
			'satuan_besar' => $this->input->post('satuan_besar'),
			'konversi' => $this->input->post('konversi'),
			'satuan_kecil' => $this->input->post('satuan_kecil'),
			'ket_ob_detil' => $this->input->post('ket_ob_detil'),
			'harga_ob_detil' => $harga_ob_detil,
			'diskon_ob_detil' => $diskon_ob_detil,
			'persen_ob_detil' => $persen_ob_detil,
			'status_ob_detil' => 0,
			'total_ob_detil' => $total_ob_detil
		);
		return $this->db->insert('keu_ob_detil', $data_pendaftaran);
	}
	function edit_keu_order_beli(){
		$id_order_beli = $this->input->post('id_order_beli');
		$tgl_order_beli = $this->input->post('tgl_order_beli');
		$tgl_order_beli = date('Y-m-d', strtotime($tgl_order_beli));	
		$diskon_order_beli = $this->input->post('diskon_order_beli');
		$diskon_order_beli	= str_replace("'","&acute;",$diskon_order_beli);
		$diskon_order_beli	= str_replace(".","",$diskon_order_beli);
		$diskon_order_beli	= str_replace(" ","",$diskon_order_beli);
		$diskon_order_beli	= str_replace(",","",$diskon_order_beli);		
		$subtotal_order_beli = $this->input->post('subtotal_order_beli');
		$subtotal_order_beli	= str_replace("'","&acute;",$subtotal_order_beli);
		$subtotal_order_beli	= str_replace(".","",$subtotal_order_beli);
		$subtotal_order_beli	= str_replace(" ","",$subtotal_order_beli);
		$subtotal_order_beli	= str_replace(",","",$subtotal_order_beli);		
		$ppn_order_beli = $this->input->post('ppn_order_beli');
		$ppn_order_beli	= str_replace("'","&acute;",$ppn_order_beli);
		$ppn_order_beli	= str_replace(".","",$ppn_order_beli);
		$ppn_order_beli	= str_replace(" ","",$ppn_order_beli);
		$ppn_order_beli	= str_replace(",","",$ppn_order_beli);			
		$total_order_beli = $this->input->post('total_order_beli');
		$total_order_beli	= str_replace("'","&acute;",$total_order_beli);
		$total_order_beli	= str_replace(".","",$total_order_beli);
		$total_order_beli	= str_replace(" ","",$total_order_beli);
		$total_order_beli	= str_replace(",","",$total_order_beli);
		$data_pendaftaran = array(
			'tgl_order_beli' => $tgl_order_beli,
			'no_order_beli' => $this->input->post('no_order_beli'),
			'id_dk' => $this->input->post('id_dk'),
			'id_unit' => $this->input->post('id_unit'),
			'id_termin' => $this->input->post('id_termin'),
			'ket_order_beli' => $this->input->post('ket_order_beli'),
			'pajak' => $this->input->post('pajak'),
			'kontak' => $this->input->post('kontak'),
			'alamat' => $this->input->post('alamat'),
			'diskon_order_beli' => $diskon_order_beli,
			'persen_order_beli' => $this->input->post('persen_order_beli'),
			'subtotal_order_beli' => $subtotal_order_beli,
			'ppn_order_beli' => $ppn_order_beli,
			'total_order_beli' => $total_order_beli
		);
		$this->db->where('id_order_beli',$id_order_beli);
		$this->db->update('keu_order_beli', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}
	function simpan_keu_log_ob2($id,$log){
		$tgl_order_beli = $this->input->post('tgl_order_beli');
		$tgl_order_beli = date('Y-m-d', strtotime($tgl_order_beli));	
		$diskon_order_beli = $this->input->post('diskon_order_beli');
		$diskon_order_beli	= str_replace("'","&acute;",$diskon_order_beli);
		$diskon_order_beli	= str_replace(".","",$diskon_order_beli);
		$diskon_order_beli	= str_replace(" ","",$diskon_order_beli);
		$diskon_order_beli	= str_replace(",","",$diskon_order_beli);		
		$subtotal_order_beli = $this->input->post('subtotal_order_beli');
		$subtotal_order_beli	= str_replace("'","&acute;",$subtotal_order_beli);
		$subtotal_order_beli	= str_replace(".","",$subtotal_order_beli);
		$subtotal_order_beli	= str_replace(" ","",$subtotal_order_beli);
		$subtotal_order_beli	= str_replace(",","",$subtotal_order_beli);		
		$ppn_order_beli = $this->input->post('ppn_order_beli');
		$ppn_order_beli	= str_replace("'","&acute;",$ppn_order_beli);
		$ppn_order_beli	= str_replace(".","",$ppn_order_beli);
		$ppn_order_beli	= str_replace(" ","",$ppn_order_beli);
		$ppn_order_beli	= str_replace(",","",$ppn_order_beli);			
		$total_order_beli = $this->input->post('total_order_beli');
		$total_order_beli	= str_replace("'","&acute;",$total_order_beli);
		$total_order_beli	= str_replace(".","",$total_order_beli);
		$total_order_beli	= str_replace(" ","",$total_order_beli);
		$total_order_beli	= str_replace(",","",$total_order_beli);
			$data_pendaftaran = array(
				'tgl_order_beli' => $tgl_order_beli,
				'no_order_beli' => $this->input->post('no_order_beli'),
				'id_dk' => $this->input->post('id_dk'),
				'id_unit' => $this->input->post('id_unit'),
				'id_termin' => $this->input->post('id_termin'),
				'ket_order_beli' => $this->input->post('ket_order_beli'),
				'pajak' => $this->input->post('pajak'),
				'kontak' => $this->input->post('kontak'),
				'alamat' => $this->input->post('alamat'),
				'diskon_order_beli' => $diskon_order_beli,
				'persen_order_beli' => $this->input->post('persen_order_beli'),
				'subtotal_order_beli' => $subtotal_order_beli,
				'ppn_order_beli' => $ppn_order_beli,
				'total_order_beli' => $total_order_beli,
				'status_order_beli' => 0,
				'id_order_beli' => $id,
				'id_ob_detil' => 0,
				'id_barang' => 0,
				'merk_ob_detil' => 0,
				'jml_ob_detil' => 0,
				'satuan_besar' => 0,
				'konversi' => 0,
				'satuan_kecil' => 0,
				'ket_ob_detil' => 0,
				'harga_ob_detil' => 0,
				'diskon_ob_detil' => 0,
				'persen_ob_detil' => 0,
				'total_ob_detil' => 0,
				'status_ob_detil' => 0,
				'ket_log_ob' => $log,
				'id_user' => $this->session->id_user
			);
			$this->db->insert('keu_log_ob', $data_pendaftaran);			
	}
	function deal_ob_detil($id,$deal){
		$data_pendaftaran = array(
			'status_ob_detil' => $deal
		);
		$this->db->where('id_ob_detil',$id);
		$this->db->update('keu_ob_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}
	function deal_order_beli($id){
		$data_pendaftaran = array(
			'status_order_beli' => 1
		);
		$this->db->where('id_order_beli',$id);
		$this->db->update('keu_order_beli', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}
}