<?php
class M_ms_etik extends CI_model{
  	function cmd_pegawai_etik(){
  		$ids = explode(',', $this->session->id_jabatan);
  		$idu = explode(',', $this->session->mas_ins);
  		$this->db->select("barcode_pegawai,nama_pegawai");
  		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
	    $this->db->join('ol_pegawai_unit opu', 'opu.id_pegawai=peg.id_pegawai','left');
	    $this->db->join('ol_unit ou', 'ou.id_unit=opu.id_unit','left');
		$this->db->where_in('jf.id_jabatan',$ids);
		$this->db->where_in('ou.id_instansi',$idu);
		$q = $this->db->get_where('ol_pegawai peg',array('status_pegawai'=>1))->result_array();
		$hasil= array_column($q,'nama_pegawai','barcode_pegawai');
		return $hasil;
	}
	function ms_etik_all($first_date,$last_date,$id)
	{
		$idx = explode(',', $this->session->mas_kred);
		$idu = explode(',', $this->session->mas_ins);
		$fields = "*,DATE_FORMAT(tgl_etik_pegawai,'%d-%m-%Y') as tgl_etik_pegawai";
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
$this->db->where('tgl_etik_pegawai BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
	    $this->db->where("oep.id_penguji",$this->session->id_pegawai);
	    $this->db->where_in("ou.id_instansi",$idu);
	    $this->db->where_in("jf.id_jabatan",$idx);
	    if(!empty($id)){
	    	$this->db->where("peg.barcode_pegawai",$id);
	    }	
	      
			
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_etik_pegawai oep');
	    $this->db->join('ol_pegawai peg', 'peg.id_pegawai=oep.id_pegawai','left');
	    $this->db->join('ol_pegawai_unit opu', 'opu.id_pegawai=peg.id_pegawai','left');
	    $this->db->join('ol_unit ou', 'ou.id_unit=opu.id_unit','left');
	    $this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
$this->db->where('tgl_etik_pegawai BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
	    $this->db->where("oep.id_penguji",$this->session->id_pegawai);
	    $this->db->where_in("ou.id_instansi",$idu);
	    $this->db->where_in("jf.id_jabatan",$idx);
	    if(!empty($id)){
	    	$this->db->where("peg.barcode_pegawai",$id);
	    }	
	    
		
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
$this->db->where('tgl_etik_pegawai BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
	    $this->db->where("oep.id_penguji",$this->session->id_pegawai);
	    $this->db->where_in("ou.id_instansi",$idu);
	    $this->db->where_in("jf.id_jabatan",$idx);
	    if(!empty($id)){
	    	$this->db->where("peg.barcode_pegawai",$id);
	    }	
	    
			}
		  }
		}

	    $this->db->from('ol_etik_pegawai oep');
	    $this->db->join('ol_pegawai peg', 'peg.id_pegawai=oep.id_pegawai','left');
	    $this->db->join('ol_pegawai_unit opu', 'opu.id_pegawai=peg.id_pegawai','left');
	    $this->db->join('ol_unit ou', 'ou.id_unit=opu.id_unit','left');
	    $this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
$this->db->where('tgl_etik_pegawai BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
	    $this->db->where("oep.id_penguji",$this->session->id_pegawai);
	    $this->db->where_in("ou.id_instansi",$idu);
	    $this->db->where_in("jf.id_jabatan",$idx);
	    if(!empty($id)){
	    	$this->db->where("peg.barcode_pegawai",$id);
	    }	
	    
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
	function kol_etik_all(){
		$q = $this->db->get_where('nkr_etik',array('status_etik'=>1,'id_jabatan'=>$this->session->id_jabatan,'id_instansi'=>$this->session->refer));
		return $q->result_array();
	}
	function num_kol_etik_all(){
		$this->db->select('COUNT(id_etik) as count_koletik');
		$q = $this->db->get_where('nkr_etik',array('status_etik'=>1,'id_jabatan'=>$this->session->id_jabatan,'id_instansi'=>$this->session->refer));
		return $q->row_array();
	}
	function simpan_etik_pegawai(){
		$id_pegawai = $this->input->post('id_pegawai');
		$sub_total = $this->input->post('sub_total');
		$total = $this->input->post('total');
		$hasilGR = $sub_total / $total * 100;
	    if ($hasilGR <= 49) {
	        $hasilbulat = "D : Buruk";
	    }elseif ($hasilGR > 50 && $hasilGR <= 70) {
	        $hasilbulat = "C : Cukup";
	    }elseif ($hasilGR > 70 && $hasilGR <= 89) {
	        $hasilbulat = "B : Baik";
	    }else{
	        $hasilbulat = "A : Prima";
	    }
		$kode = $this->m_rancak->kode_generator_urut(15,'EP');
		$data_pendaftaran = array(
				'id_pegawai' => $id_pegawai,
				'id_etik_pegawai' => $kode,
				'tgl_etik_pegawai' => date('Y-m-d'),
				'id_penguji' => $this->session->id_pegawai,
				'total_etik' => $sub_total,
				'hasil_etik' => $hasilbulat,
				'jumlah_etik' => $total
			);
		$this->db->insert('ol_etik_pegawai', $data_pendaftaran);
		return $kode;
	}
	function simpan_etik_pegawai_detil($last_ide){
		$id_etik = $this->input->post('id_etik[]');
		$jml_kode = count($id_etik);
		for ($i=0;$i<$jml_kode;$i++){
		$ms = $this->m_umum->ambil_data('nkr_etik','id_etik',$id_etik[$i]);
		$alle = "skor_etik".$id_etik[$i];
		$choose = $this->input->post($alle);
		$kode = $this->m_rancak->kode_generator_urut(15,'ED');
				$data_pendaftaran = array(
					'id_etik_pegawai' => $last_ide,
					'id_etik_detil' => $kode,
					'nama_etik' => $ms['nama_etik'],
					'answer' => $ms['answer'],
					'choose' => $choose
				);
				$this->db->insert('ol_etik_detil', $data_pendaftaran);
		}
	}
}