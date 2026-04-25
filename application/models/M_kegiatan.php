<?php
class M_kegiatan extends CI_model{
  function logbook_pemulihan_penanggungjawab($id)
	{
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,
					if (tgl_awal = '0000-00-00' ,'TIDAK ADA',DATE_FORMAT(tgl_awal,'%d-%m-%Y')) as tgl_awal,
					if (tgl_akhir = '0000-00-00' ,'TIDAK ADA',DATE_FORMAT(tgl_akhir,'%d-%m-%Y')) as tgl_akhir,
    			if(result_pemulihan = '0' ,'Proses',if(result_pemulihan = '1' ,'Kompeten','Tidak Kompeten')) as result_pemulihan
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
        $this->db->where("id_pemulihan", $id);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	  $this->db->from('logbook_pemulihan l');
		$this->db->join('pegawai peg', 'peg.id_pegawai=l.id_pegawai','left');
		$this->db->join('ruangan r', 'r.id_ruangan=l.id_unit_pemulihan','left');
    $this->db->where("id_pemulihan", $id);

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
        $this->db->where("id_pemulihan", $id);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
  $this->db->from('logbook_pemulihan l');
  $this->db->join('pegawai peg', 'peg.id_pegawai=l.id_pegawai','left');
  $this->db->join('ruangan r', 'r.id_ruangan=l.id_unit_pemulihan','left');
  $this->db->where("id_pemulihan", $id);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99');
		$jml = $this->m_umum->jumlah_record_filter('pegawai',$kondisi);	 */
		$jml = $this->m_umum->jumlah_record_tabel('logbook');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
  function logbook_kegiatan_pemulihan_personal($id)
	{
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,
					if (tgl_kegiatan_pemulihan = '0000-00-00' ,'TIDAK ADA',DATE_FORMAT(tgl_kegiatan_pemulihan,'%d-%m-%Y')) as tgl_kegiatan_pemulihan,
    			if(result_kegiatan_pemulihan = '0' ,'Proses',if(result_kegiatan_pemulihan = '1' ,'Kompeten','Tidak Kompeten')) as result_kegiatan_pemulihan
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
        $this->db->where("id_logbook_pemulihan", $id);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

    $this->db->from('logbook_kegiatan_pemulihan lkp');
    $this->db->join('kr_kewenangan kk', 'kk.id_kewenangan=lkp.id_kewenangan','left');
    $this->db->join('pegawai peg', 'peg.id_pegawai=lkp.id_penguji','left');
    $this->db->where("id_logbook_pemulihan", $id);

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
        $this->db->where("id_logbook_pemulihan", $id);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
  $this->db->from('logbook_kegiatan_pemulihan lkp');
  $this->db->join('kr_kewenangan kk', 'kk.id_kewenangan=lkp.id_kewenangan','left');
  $this->db->join('pegawai peg', 'peg.id_pegawai=lkp.id_penguji','left');
  $this->db->where("id_logbook_pemulihan", $id);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99');
		$jml = $this->m_umum->jumlah_record_filter('pegawai',$kondisi);	 */
		$jml = $this->m_umum->jumlah_record_tabel('logbook');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
  function simpan_logbook_kegiatan_pemulihan(){
    $id_logbook_pemulihan = $this->input->post('id_logbook_pemulihan');
    $tgl_kegiatan_pemulihan = $this->input->post('tgl_kegiatan_pemulihan');
		$tgl_kegiatan_pemulihan = date('Y-m-d', strtotime($tgl_kegiatan_pemulihan));
		$chk = $this->input->post('chk[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				$this->db->select("COUNT(*) as num");
				$this->db->where('id_kewenangan',$chk[$i]);
				$this->db->where('tgl_kegiatan_pemulihan',$tgl_kegiatan_pemulihan);
				$this->db->where('id_logbook_pemulihan',$id_logbook_pemulihan);
				$q = $this->db->get('logbook_kegiatan_pemulihan')->row();
				$jml = $q->num;
				if($jml == 0){
					$lb = $this->m_umum->ambil_data('logbook','id_logbook',$chk[$i]);
					$data_pendaftaran = array(
						'id_kewenangan' => $chk[$i],
						'id_logbook_pemulihan' => $id_logbook_pemulihan,
						'tgl_kegiatan_pemulihan' => $tgl_kegiatan_pemulihan,
            'rm_kegiatan_pemulihan' => $this->input->post('rm_kegiatan_pemulihan'),
            'catatan_kegiatan_pemulihan' => '',
            'result_kegiatan_pemulihan' => 0,
            'id_penguji' => $this->input->post('id_penguji')
					);
					$this->db->insert('logbook_kegiatan_pemulihan', $data_pendaftaran);
				}
			}
		}
	}
	function edit_logbook_kegiatan_pemulihan(){
		$id_kegiatan_pemulihan = $this->input->post('id_kegiatan_pemulihan');
		$tgl_kegiatan_pemulihan = $this->input->post('tgl_kegiatan_pemulihan');
		$tgl_kegiatan_pemulihan = date('Y-m-d', strtotime($tgl_kegiatan_pemulihan));
		$data_pendaftaran = array(
      'tgl_kegiatan_pemulihan' => $tgl_kegiatan_pemulihan,
      'rm_kegiatan_pemulihan' => $this->input->post('rm_kegiatan_pemulihan'),
      'catatan_kegiatan_pemulihan' => $this->input->post('catatan_kegiatan_pemulihan'),
      'result_kegiatan_pemulihan' => $this->input->post('result_kegiatan_pemulihan'),
      'id_penguji' => $this->input->post('id_penguji')
		);
		$this->db->where('id_kegiatan_pemulihan',$id_kegiatan_pemulihan);
		$this->db->update('logbook_kegiatan_pemulihan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
}
