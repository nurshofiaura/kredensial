<?php
class M_normal extends CI_model{
	function normal_all($id)
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
	$this->db->where("id_struktur_jabatan", $id);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('kol_normal kn');
		$this->db->join('tindakan t', 't.id_tindakan=kn.id_tindakan','left');
		$this->db->join('pegawai peg', 'peg.id_pegawai=kn.id_pegawai','left');
		$this->db->where("id_struktur_jabatan", $id);

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
	$this->db->where("id_struktur_jabatan", $id);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	$this->db->from('kol_normal kn');
	$this->db->join('tindakan t', 't.id_tindakan=kn.id_tindakan','left');
	$this->db->join('pegawai peg', 'peg.id_pegawai=kn.id_pegawai','left');
	$this->db->where("id_struktur_jabatan", $id);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99');
		$jml = $this->m_umum->jumlah_record_filter('pegawai',$kondisi);	 */
		$jml = $this->m_umum->jumlah_record_tabel('kol_normal');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_normal(){
		$data_pendaftaran = array(
			'nama_normal' => $this->input->post('nama_normal'),
			'id_struktur_jabatan' => $this->input->post('id_struktur_jabatan'),
			'id_tindakan' => $this->input->post('id_tindakan'),
			'id_pegawai' => $this->input->post('id_pegawai'),
			'hasil_normal' => $this->input->post('hasil_normal'),
			'kesimpulan_normal' => $this->input->post('kesimpulan_normal')
		);
		return $this->db->insert('kol_normal', $data_pendaftaran);
	}
	function edit_normal(){
		$id_normal = $this->input->post('id_normal');
		$data_pendaftaran = array(
			'nama_normal' => $this->input->post('nama_normal'),
			'id_tindakan' => $this->input->post('id_tindakan'),
			'id_pegawai' => $this->input->post('id_pegawai'),
			'hasil_normal' => $this->input->post('hasil_normal'),
			'kesimpulan_normal' => $this->input->post('kesimpulan_normal')
		);
		$this->db->where('id_normal',$id_normal);
		$this->db->update('kol_normal', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
}
