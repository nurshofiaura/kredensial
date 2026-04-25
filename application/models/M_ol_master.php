<?php
class M_ol_master extends CI_model{
	function kewenangan_all($id)
	{
	//	$ids = explode(',', $unit);
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*, kk.id_kewenangan as kk_id,if(kk.creator_kewenangan = 0,'Administrator',nama_pegawai) as nama_pegawai";
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
		$this->db->where("ok.id_jabatan", $this->session->id_jabatan);
		if($id > 0){
			$this->db->where("kd.id_ruangan", $id);
		}	

			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_kewenangan kk');
		$this->db->join('kol_kode_kewenangan kkw', 'kkw.id_kode_kewenangan=kk.id_kode_kewenangan','left');
		$this->db->join('kol_sifat_kewenangan ksk', 'ksk.id_sifat_kewenangan=kk.id_sifat_kewenangan','left');
		$this->db->join('ol_kompetensi ok', 'ok.id_kompetensi=kk.id_kompetensi','left');
		$this->db->join('ol_kewenangan_detil kd', 'kd.id_kewenangan=kk.id_kewenangan','left');	
		$this->db->join('jabatan j', 'j.id_jabatan=ok.id_jabatan','left');
		$this->db->join('ol_ruangan r', 'r.id_ruangan=kd.id_ruangan','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=kk.creator_kewenangan','left');
		$this->db->where("ok.id_jabatan", $this->session->id_jabatan);
		if($id > 0){
			$this->db->where("kd.id_ruangan", $id);
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
		$this->db->where("ok.id_jabatan", $this->session->id_jabatan);
		if($id > 0){
			$this->db->where("kd.id_ruangan", $id);
		}	

			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('ol_kewenangan kk');
		$this->db->join('kol_kode_kewenangan kkw', 'kkw.id_kode_kewenangan=kk.id_kode_kewenangan','left');
		$this->db->join('kol_sifat_kewenangan ksk', 'ksk.id_sifat_kewenangan=kk.id_sifat_kewenangan','left');
		$this->db->join('ol_kompetensi ok', 'ok.id_kompetensi=kk.id_kompetensi','left');
		$this->db->join('ol_kewenangan_detil kd', 'kd.id_kewenangan=kk.id_kewenangan','left');		
		$this->db->join('jabatan j', 'j.id_jabatan=ok.id_jabatan','left');
		$this->db->join('ol_ruangan r', 'r.id_ruangan=kd.id_ruangan','left');
		$this->db->where("ok.id_jabatan", $this->session->id_jabatan);
		if($id > 0){
			$this->db->where("kd.id_ruangan", $id);
		}								

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('ol_kewenangan');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_kewenangan(){
		$id_pegawai = $this->session->id_pegawai;
		$data_pendaftaran = array(
			'nama_kewenangan' => $this->input->post('nama_kewenangan'),
			'id_kompetensi' => $this->input->post('id_kompetensi'),
			'id_kode_kewenangan' => $this->input->post('id_kode_kewenangan'),
			'id_sifat_kewenangan' => $this->input->post('id_sifat_kewenangan'),
			'wkt_kewenangan' => $this->input->post('wkt_kewenangan'),
			'creator_kewenangan' => $id_pegawai
		);
		$this->db->insert('ol_kewenangan', $data_pendaftaran);
		return $this->db->insert_id();
	}
	function edit_kewenangan(){
		$id_kewenangan = $this->input->post('id_kewenangan');
		$data_pendaftaran = array(
			'nama_kewenangan' => $this->input->post('nama_kewenangan'),
			'id_kompetensi' => $this->input->post('id_kompetensi'),
			'id_kode_kewenangan' => $this->input->post('id_kode_kewenangan'),
			'id_sifat_kewenangan' => $this->input->post('id_sifat_kewenangan'),
			'wkt_kewenangan' => $this->input->post('wkt_kewenangan')
		);
		$this->db->where('id_kewenangan',$id_kewenangan);
		$this->db->update('ol_kewenangan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function simpan_kewenangan_detil($id){
		$kode = $this->m_rancak->kode_generator(15,'');
		$data_pendaftaran = array(
			'id_kewenangan' => $id,
			'barcode_kewenangan_detil' => $kode,
			'id_ruangan' => $this->input->post('id_ruangan')
		);
		return $this->db->insert('ol_kewenangan_detil', $data_pendaftaran);
	}
	function edit_kewenangan_detil(){
		$id_kewenangan = $this->input->post('id_kewenangan');
		$data_kewenangan_detil = array(
			'id_ruangan' =>$this->input->post('id_ruangan')
		);
		$this->db->where('id_kewenangan',$id_kewenangan);
		$this->db->update('ol_kewenangan_detil', $data_kewenangan_detil);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function ambil_kewenangan($id){
	//	$this->db->select("*,kk.id_kewenangan as id_kewenangan");
		$this->db->join('ol_kewenangan_detil kd', 'kd.id_kewenangan=kk.id_kewenangan','left');		
		$q = $this->db->get_where('ol_kewenangan kk',array('kk.id_kewenangan'=>$id));
		return $q->row_array();
	}
	function kewenangan_bk($id)
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
		$this->db->where("bk.id_jabatan_fungsional", $id);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_kewenangan_bk kbk');
		$this->db->join('ol_kewenangan k', 'k.id_kewenangan=kbk.id_kewenangan','left');
		$this->db->join('butir_kegiatan bk', 'bk.id_butir_kegiatan=kbk.id_butir_kegiatan','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=bk.id_jabatan_fungsional','left');
			$this->db->where("bk.id_jabatan_fungsional", $id);

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
		$this->db->where("bk.id_jabatan_fungsional", $id);
			}
		  }
		}

	    $this->db->from('ol_kewenangan_bk kbk');
		$this->db->join('ol_kewenangan k', 'k.id_kewenangan=kbk.id_kewenangan','left');
		$this->db->join('butir_kegiatan bk', 'bk.id_butir_kegiatan=kbk.id_butir_kegiatan','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=bk.id_jabatan_fungsional','left');
		$this->db->where("bk.id_jabatan_fungsional", $id);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$kondisi=array('id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('ol_kewenangan_lulus',$kondisi);		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_ol_kewenangan_bk(){
		$chk = $this->input->post('chk[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				$this->db->select("COUNT(*) as num");
				$this->db->where('id_kewenangan', $chk[$i]);
				$this->db->where('id_butir_kegiatan',$this->input->post('id_butir_kegiatan'));
			//	$this->db->where('status_pengurus',1);
				$q = $this->db->get('ol_kewenangan_bk')->row();
			//	$this->edit_olk($chk[$i]);
				$jml = $q->num;
				if($jml == 0){
					$data_pendaftaran = array(
						'id_kewenangan' => $chk[$i],
						'id_butir_kegiatan' =>  $this->input->post('id_butir_kegiatan')
					);
					$this->db->insert('ol_kewenangan_bk', $data_pendaftaran);
				}
			}
		}
	}
	function edit_ol_kewenangan_bk(){
		$id_kewenangan_bk = $this->input->post('id_kewenangan_bk');
		$data_pendaftaran = array(
			'id_kewenangan' => $this->input->post('id_kewenangan'),
			'id_butir_kegiatan' =>  $this->input->post('id_butir_kegiatan'),
			'status_kewenangan_bk' =>  $this->input->post('status_kewenangan_bk')
		);
		$this->db->where('id_kewenangan_bk',$id_kewenangan_bk);
		$this->db->update('ol_kewenangan_bk', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function butir_kegiatan_kabeh($id)
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,round(angka_kredit, 4)
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
		$this->db->where("bk.id_jabatan_fungsional", $id);
		
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('butir_kegiatan bk');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=bk.id_jabatan_fungsional','left');
		$this->db->where("bk.id_jabatan_fungsional", $id);
			
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
		$this->db->where("bk.id_jabatan_fungsional", $id);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('butir_kegiatan bk');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=bk.id_jabatan_fungsional','left');
		$this->db->where("bk.id_jabatan_fungsional", $id);
		
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('butir_kegiatan');		//[coding here] ganti tabel utamanya
				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;	
	}
	function tambah_butir_kegiatan_kw(){
		$id_kewenangan = $this->tambah_kewenangan_bk();
		$id_butir_kegiatan = $this->tambah_butir_kegiatan();
		$data_pendaftaran = array(
			'id_kewenangan' => $id_kewenangan,
			'id_butir_kegiatan' => $id_butir_kegiatan
		);
		return $this->db->insert('ol_kewenangan_bk', $data_pendaftaran);
	}
	function tambah_butir_kegiatan(){
		$data_pendaftaran = array(
			'id_jabatan_fungsional' => $this->input->post('id_jabatan_fungsional'),
			'nama_butir_kegiatan' => $this->input->post('nama_butir_kegiatan'),						
			'angka_kredit' => $this->input->post('angka_kredit'),
			'satuan_hasil' => $this->input->post('satuan_hasil'),
			'status_butir_kegiatan' => $this->input->post('status_butir_kegiatan')
		);
		$this->db->insert('butir_kegiatan', $data_pendaftaran);
		return $this->db->insert_id();
	}
	function tambah_kewenangan_bk(){
		$data_pendaftaran = array(
			'nama_kewenangan' => $this->input->post('nama_butir_kegiatan'),
			'bk' => 1
		);
		$this->db->insert('ol_kewenangan', $data_pendaftaran);
		return $this->db->insert_id();
	}
	function rubah_butir_kegiatan(){
		$id_butir_kegiatan = $this->input->post('id_butir_kegiatan');	
		$data_pendaftaran = array(
			'id_jabatan_fungsional' => $this->input->post('id_jabatan_fungsional'),
			'nama_butir_kegiatan' => $this->input->post('nama_butir_kegiatan'),						
			'angka_kredit' => $this->input->post('angka_kredit'),
			'satuan_hasil' => $this->input->post('satuan_hasil'),
			'status_butir_kegiatan' => $this->input->post('status_butir_kegiatan')
		);
		$this->db->where('id_butir_kegiatan',$id_butir_kegiatan);
		$this->db->update('butir_kegiatan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function rubah_kewenangan_bk(){
		$id_kewenangan = $this->input->post('id_kewenangan');	
		$data_pendaftaran = array(
			'nama_kewenangan' => $this->input->post('nama_butir_kegiatan')
		);
		$this->db->where('id_kewenangan',$id_kewenangan);
		$this->db->update('ol_kewenangan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
}