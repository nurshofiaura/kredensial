<?php
class M_admin_pelayanan extends CI_model{
	function ambil_barcode_user_pegawai($id){
		$this->db->join('pegawai p', 'p.id_pegawai=u.id_pegawai','left');
		$this->db->join('user_level ul', 'ul.id_level=u.id_level','left');
		$q = $this->db->get_where('user u',array('u.barcode_user'=>$id));
		return $q->row_array();
	}
// ================================================= TINDAKAN ==============================
	function golongan_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,if (status_golongan_pemeriksaan = '1' ,'AKTIF','NON AKTIF') as status_golongan_pemeriksaan";
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

	    $this->db->from('kol_golongan_pemeriksaan kgp');
		$this->db->join('struktur_jabatan sj', 'sj.id_struktur_jabatan=kgp.id_struktur_jabatan','left');
		$this->db->where_in('kgp.id_struktur_jabatan', ['8']);

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
	    $this->db->from('kol_golongan_pemeriksaan kgp');
		$this->db->join('struktur_jabatan sj', 'sj.id_struktur_jabatan=kgp.id_struktur_jabatan','left');
		$this->db->where_in('kgp.id_struktur_jabatan', ['8']);

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
	function simpan_golongan(){
		$data_pendaftaran = array(
			'nama_golongan_pemeriksaan' => $this->input->post('nama_golongan_pemeriksaan'),
			'id_struktur_jabatan' => $this->input->post('id_struktur_jabatan'),
			'status_golongan_pemeriksaan' => $this->input->post('status_golongan_pemeriksaan')
		);
		$this->db->insert('kol_golongan_pemeriksaan', $data_pendaftaran);
		return $this->db->insert_id();
	}
	function edit_golongan(){
		$id_golongan_pemeriksaan = $this->input->post('id_golongan_pemeriksaan');
		$data_pendaftaran = array(
			'nama_golongan_pemeriksaan' => $this->input->post('nama_golongan_pemeriksaan'),
			'id_struktur_jabatan' => $this->input->post('id_struktur_jabatan'),
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
// ================================================= TINDAKAN ==============================
	function tarif_tindakan_all($id_tindakan,$id_kelas,$jabatan)
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,FORMAT(harga_tindakan,'#,###,##0') as harga_tindakan,
				if (status_tarif = '1' ,'AKTIF','NON AKTIF') as status_tarif,DATE_FORMAT(tgl_berlaku,'%d-%m-%Y') as tgl_berlaku";
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

	    $this->db->from('tindakan_tarif tt');
		$this->db->join('tindakan t', 't.id_tindakan=tt.id_tindakan','left');
	$this->db->join('kol_golongan_pemeriksaan kko', 'kko.id_golongan_pemeriksaan=t.id_golongan_pemeriksaan','left');
		$this->db->join('kol_kelas kk', 'kk.id_kelas=tt.id_kelas','left');
//		$this->db->where('kko.id_struktur_jabatan', $jabatan);
		if($id_tindakan > 0){
			$this->db->where('tt.id_tindakan', $id_tindakan);
		}
		if($id_kelas > 0){
			$this->db->where('tt.id_kelas', $id_kelas);
		}
		$this->db->where('status_tarif', '1');

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
	    $this->db->from('tindakan_tarif tt');
		$this->db->join('tindakan t', 't.id_tindakan=tt.id_tindakan','left');
	$this->db->join('kol_golongan_pemeriksaan kko', 'kko.id_golongan_pemeriksaan=t.id_golongan_pemeriksaan','left');
		$this->db->join('kol_kelas kk', 'kk.id_kelas=tt.id_kelas','left');
//		$this->db->where('kko.id_struktur_jabatan', $jabatan);
		if($id_tindakan > 0){
			$this->db->where('tt.id_tindakan', $id_tindakan);
		}
		if($id_kelas > 0){
			$this->db->where('tt.id_kelas', $id_kelas);
		}
		$this->db->where('status_tarif', '1');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
			$jml = $this->jumlah_record_tt($id_tindakan,$id_kelas,$jabatan);

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
    function jumlah_record_tt($id_tindakan,$id_kelas,$jabatan)    //igd.php untuk menampilkan jumlah antrian di igd saja
    {
		$this->db->join('tindakan t', 't.id_tindakan=tt.id_tindakan','left');
			$this->db->join('kol_golongan_pemeriksaan kko', 'kko.id_golongan_pemeriksaan=t.id_golongan_pemeriksaan','left');
		$this->db->join('kol_kelas kk', 'kk.id_kelas=tt.id_kelas','left');
	//	$this->db->where('kko.id_struktur_jabatan', $jabatan);
		if($id_tindakan > 0){
			$this->db->where('tt.id_tindakan', $id_tindakan);
		}
		if($id_kelas > 0){
			$this->db->where('tt.id_kelas', $id_kelas);
		}
		$this->db->where('status_tarif', '1');
        $query = $this->db->select("COUNT(*) as num")->get_where('tindakan_tarif tt');
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
    }
	function simpan_tindakan_tarif(){
		$harga_tindakan = $this->input->post('harga_tindakan[]');
		$harga_tindakan	= str_replace("'","&acute;",$harga_tindakan);
		$harga_tindakan	= str_replace(".","",$harga_tindakan);
		$harga_tindakan	= str_replace(" ","",$harga_tindakan);
		$harga_tindakan	= str_replace(",","",$harga_tindakan);
		$tgl_berlaku = $this->input->post('tgl_berlaku');
		$tgl_berlaku = date('Y-m-d', strtotime($tgl_berlaku));
		$id_tindakan = $this->input->post('id_tindakan');
		$chk = $this->input->post('id_kelas[]');
		$jml_kode = count($chk);
		for ($i=0;$i<$jml_kode;$i++){
		$this->db->select("COUNT(*) as num");
		$this->db->where('id_kelas',$chk[$i]);
		$this->db->where('id_tindakan',$id_tindakan);
		$this->db->where('tgl_berlaku',$tgl_berlaku);
		$q = $this->db->get('tindakan_tarif')->row();
		$jml = $q->num;
			if($jml == 0){
				if($harga_tindakan[$i] > 0){
					$data_pendaftaran = array(
						'id_kelas' => $chk[$i],
						'id_tindakan' => $id_tindakan,
						'harga_tindakan' => $harga_tindakan[$i],
						'tgl_berlaku' => $tgl_berlaku,
						'status_tarif' => 1
					);
					$this->db->insert('tindakan_tarif', $data_pendaftaran);
					$this->non_aktifkan_tindakan_tarif($chk[$i],$id_tindakan,$tgl_berlaku);
				}
			}
		}
	}
	function non_aktifkan_tindakan_tarif($id_kelas,$id_tindakan,$tgl_berlaku){
		$this->db->select("COUNT(*) as num");
		$this->db->where('id_kelas',$id_kelas);
		$this->db->where('id_tindakan',$id_tindakan);
		$this->db->where('tgl_berlaku !=',$tgl_berlaku);
		$q = $this->db->get('tindakan_tarif')->row();
		$jml = $q->num;
		if($jml > 0){
			$data_pendaftaran = array(
				'status_tarif' => 0
			);
			$this->db->where('tgl_berlaku !=',$tgl_berlaku);
			$this->db->where('id_tindakan',$id_tindakan);
			$this->db->where('id_kelas',$id_kelas);
			$this->db->update('tindakan_tarif', $data_pendaftaran);
			//echo $this->db->last_query();
			$this->db->trans_complete();	// untuk cek sukses update tidak
			if ($this->db->trans_status() === FALSE) // untuk cek sukses update tidak
			// if (!$this->db->affected_rows())
				return(FALSE);
			else
				return(TRUE);

		}
	}
	function edit_tindakan_tarif(){
		$id_tindakan_tarif = $this->input->post('id_tindakan_tarif');
		$harga_tindakan = $this->input->post('harga_tindakan');
		$harga_tindakan	= str_replace("'","&acute;",$harga_tindakan);
		$harga_tindakan	= str_replace(".","",$harga_tindakan);
		$harga_tindakan	= str_replace(" ","",$harga_tindakan);
		$harga_tindakan	= str_replace(",","",$harga_tindakan);
		$tgl_berlaku = $this->input->post('tgl_berlaku');
		$tgl_berlaku = date('Y-m-d', strtotime($tgl_berlaku));
		$data_pendaftaran = array(
			'harga_tindakan' => $harga_tindakan,
			'tgl_berlaku' => $tgl_berlaku
		);
		$this->db->where('id_tindakan_tarif',$id_tindakan_tarif);
		$this->db->update('tindakan_tarif', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
// ================================================= TINDAKAN ==============================
	function asuransi_all()
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

	    $this->db->from('kol_detil_cara_bayar dcb');
		$this->db->join('kol_cara_bayar cb', 'cb.id_cara_bayar=dcb.id_cara_bayar','left');
		$array_check = array(2,5);
		$this->db->where_in('dcb.id_cara_bayar', $array_check);

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
	    $this->db->from('kol_detil_cara_bayar dcb');
		$this->db->join('kol_cara_bayar cb', 'cb.id_cara_bayar=dcb.id_cara_bayar','left');
		$array_check = array(2,5);
		$this->db->where_in('dcb.id_cara_bayar', $array_check);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('kol_detil_cara_bayar');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_detil_cara_bayar(){
		$data_pendaftaran = array(
			'nama_detil_cara_bayar' => $this->input->post('nama_detil_cara_bayar'),
			'id_cara_bayar' => $this->input->post('id_cara_bayar')
		);
		return $this->db->insert('kol_detil_cara_bayar', $data_pendaftaran);
	}
	function edit_detil_cara_bayar(){
		$id_detil_cara_bayar = $this->input->post('id_detil_cara_bayar');
		$data_pendaftaran = array(
			'nama_detil_cara_bayar' => $this->input->post('nama_detil_cara_bayar'),
			'id_cara_bayar' => $this->input->post('id_cara_bayar')
		);
		$this->db->where('id_detil_cara_bayar',$id_detil_cara_bayar);
		$this->db->update('kol_detil_cara_bayar', $data_pendaftaran);
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
		$fields = "*,if (id_kategori_dokter = '1' ,'Dokter','Bidan / Mantri') as id_kategori_dokter";
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

	    $this->db->from('kol_rujukan_dokter');

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
	    $this->db->from('kol_rujukan_dokter');

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
		$data_pendaftaran = array(
			'nama_rujukan_dokter' => $this->input->post('nama_rujukan_dokter'),
			'id_kategori_dokter' => $this->input->post('id_kategori_dokter')
		);
		return $this->db->insert('kol_rujukan_dokter', $data_pendaftaran);
	}
	function edit_rujukan_dokter(){
		$id_rujukan_dokter = $this->input->post('id_rujukan_dokter');
		$data_pendaftaran = array(
			'nama_rujukan_dokter' => $this->input->post('nama_rujukan_dokter'),
			'id_kategori_dokter' => $this->input->post('id_kategori_dokter')
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
	function faskes_all()
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

	    $this->db->from('kol_rujukan_instansi kri');
		$this->db->join('kol_cara_masuk cm', 'cm.id_cara_masuk=kri.id_cara_masuk','left');

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
	    $this->db->from('kol_rujukan_instansi kri');
		$this->db->join('kol_cara_masuk cm', 'cm.id_cara_masuk=kri.id_cara_masuk','left');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('kol_rujukan_instansi');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_rujukan_faskes(){
		$data_pendaftaran = array(
			'nama_rujukan_instansi' => $this->input->post('nama_rujukan_instansi'),
			'id_cara_masuk' => $this->input->post('id_cara_masuk')
		);
		return $this->db->insert('kol_rujukan_instansi', $data_pendaftaran);
	}
	function edit_rujukan_faskes(){
		$id_rujukan_instansi = $this->input->post('id_rujukan_instansi');
		$data_pendaftaran = array(
			'nama_rujukan_instansi' => $this->input->post('nama_rujukan_instansi'),
			'id_cara_masuk' => $this->input->post('id_cara_masuk')
		);
		$this->db->where('id_rujukan_instansi',$id_rujukan_instansi);
		$this->db->update('kol_rujukan_instansi', $data_pendaftaran);
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
					// case 'id_ms_code'   : $nmf="kc.id_ms_code";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ruangan r');
	//	$this->db->join('struktur_jabatan sj', 'sj.id_struktur_jabatan=r.id_struktur_jabatan','left');

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
	    $this->db->from('ruangan r');
	//	$this->db->join('struktur_jabatan sj', 'sj.id_struktur_jabatan=r.id_struktur_jabatan','left');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('ruangan');		//[coding here] ganti tabel utamanya

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
		$data_pendaftaran = array(
			'nama_ruangan' => $this->input->post('nama_ruangan'),
			'status_ruangan' => $this->input->post('status_ruangan')
		);
		return $this->db->insert('ruangan', $data_pendaftaran);
	}
	function edit_ruangan(){
		$id_ruangan = $this->input->post('id_ruangan');
		$data_pendaftaran = array(
			'nama_ruangan' => $this->input->post('nama_ruangan'),
			'status_ruangan' => $this->input->post('status_ruangan')
		);
		$this->db->where('id_ruangan',$id_ruangan);
		$this->db->update('ruangan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function member_all($id)
	{
	$wordsAry = explode("-", $id);
	$wordsCount = count($wordsAry);
		$fields = "*,if(status_perawat = 0,'Non Keperawatan',nama_kode_kewenangan) as nama_kode_kewenangan,
					if (jk = '1' ,'Laki-laki','Perempuan') as jk,
					if (status_pegawai = '1' ,'AKTIF','NON AKTIF') as status_pegawai,
					CONCAT(tmp_lahir,' - ',DATE_FORMAT(tgl_lahir,'%d-%m-%Y'),' / ',(TIMESTAMPDIFF( YEAR, tgl_lahir, now() )), ' Tahun ',
					TIMESTAMPDIFF( MONTH, tgl_lahir, now() ) % 12, ' Bulan ',
					FLOOR( TIMESTAMPDIFF( DAY, tgl_lahir, now() ) % 30.4375 ), ' Hari') as umur
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
				$this->db->where('visible', '1');
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(op.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(op.nip LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(op.no_profesi LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_pegawai op');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=op.id_status_kawin','left');
		$this->db->join('kol_agama kag', 'kag.id_agama=op.id_agama','left');
		$this->db->join('kol_pendidikan kp', 'kp.id_pendidikan=op.id_pendidikan','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=op.id_jabatan_fungsional','left');
		$this->db->join('ol_status_pegawai osp', 'osp.id_status_pegawai=op.tipe_pegawai','left');
		$this->db->join('kol_kode_kewenangan kkk', 'kkk.id_kode_kewenangan=op.id_kode_kewenangan','left');
		$this->db->where('visible', '1');
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(op.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(op.nip LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(op.no_profesi LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
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
				$this->db->where('visible', '1');
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(op.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(op.nip LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(op.no_profesi LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}
			}
		  }
		}

		$this->db->from('ol_pegawai op');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=op.id_status_kawin','left');
		$this->db->join('kol_agama kag', 'kag.id_agama=op.id_agama','left');
		$this->db->join('kol_pendidikan kp', 'kp.id_pendidikan=op.id_pendidikan','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=op.id_jabatan_fungsional','left');
		$this->db->join('ol_status_pegawai osp', 'osp.id_status_pegawai=op.tipe_pegawai','left');
		$this->db->join('kol_kode_kewenangan kkk', 'kkk.id_kode_kewenangan=op.id_kode_kewenangan','left');
		$this->db->where('visible', '1');
		if(!empty($id) || $this->input->post('id',true)){
		$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(op.nama_pegawai LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(op.nip LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
				$this->db->or_where("(op.no_profesi LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('ol_pegawai');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_aktifasi(){
		$tgl_lahir = $this->input->post('tgl_lahir');
		$tgl_lahir = date('Y-m-d', strtotime($tgl_lahir));
		$username= $this->input->post('username');
		$username = strtolower($username);
		$username = str_replace(' ', '-', $username);
		$username = preg_replace('/[^A-Za-z0-9\-]/', '', $username);
		$password = hash("sha512", md5('7654321'));		
		$kode = $this->m_rancak->kode_generator(15,'');
		$data_pendaftaran = array(
			'barcode_pegawai' => $kode,
			'username' => $username,
			'password' => $password,			
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
			'id_jabatan_fungsional' => $this->input->post('id_jabatan_fungsional'),
			'alamat' => $this->input->post('alamat')
		);
		$this->db->insert('ol_pegawai', $data_pendaftaran);
		return $this->db->insert_id();
	}
	function simpan_user($id){
		$kode = $this->m_rancak->kode_generator(15,'');
		$data_pendaftaran = array(
			'id_pegawai' => $id,
			'barcode_user' => $kode,
			'id_level' => $this->input->post('id_level')
		);
		return $this->db->insert('ol_user', $data_pendaftaran);
	}
	function edit_pegawai(){
		$barcode_pegawai = $this->input->post('barcode_pegawai');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$tgl_lahir = date('Y-m-d', strtotime($tgl_lahir));
		$data_pendaftaran = array(
			'nama_pegawai' => $this->input->post('nama_pegawai'),
			'jk' => $this->input->post('jk'),
			'tmp_lahir' => $this->input->post('tmp_lahir'),
			'tgl_lahir' => $tgl_lahir,
			'email' => $this->input->post('email'),
			'no_hp' => $this->input->post('no_hp'),
			'nik' => $this->input->post('nik'),
			'id_status_kawin' => $this->input->post('id_status_kawin'),
			'id_agama' => $this->input->post('id_agama'),
			'id_pendidikan' => $this->input->post('id_pendidikan'),
			'id_jabatan_fungsional' => $this->input->post('id_jabatan_fungsional'),
			'alamat' => $this->input->post('alamat'),
			'status_pegawai' =>$this->input->post('status_pegawai')
		);
		$this->db->where('barcode_pegawai',$barcode_pegawai);
		$this->db->update('ol_pegawai', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function reset_password($id){
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
	function hak_akses_all($id)
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
				$this->db->where('barcode_pegawai',$id);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	$this->db->from('ol_akses pak');
	$this->db->join('akses ak','ak.id_akses=pak.id_akses','left');
	$this->db->join('ol_pegawai peg','peg.id_pegawai=pak.id_pegawai','left');
	$this->db->where('barcode_pegawai',$id);

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
				$this->db->where('barcode_pegawai',$id);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	$this->db->from('ol_akses pak');
	$this->db->join('akses ak','ak.id_akses=pak.id_akses','left');
	$this->db->join('ol_pegawai peg','peg.id_pegawai=pak.id_pegawai','left');
	$this->db->where('barcode_pegawai',$id);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----

	 		$kondisi=array('barcode_pegawai'=>$id);
			$jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_akses',$kondisi,'ol_pegawai','id_pegawai');

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
	function status_pegawai_akses($int,$id){
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
}
