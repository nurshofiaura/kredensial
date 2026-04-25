<?php
class M_pendaftaran extends CI_model{
// ================================================= TINDAKAN ==============================
	function tindakan_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,t.id_tindakan as id_tindakan";
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

	    $this->db->from('tindakan t');
		$this->db->join('kol_golongan_pemeriksaan kk', 'kk.id_golongan_pemeriksaan=t.id_golongan_pemeriksaan','left');
		$this->db->join('ol_unit ou', 'ou.id_unit=kk.id_unit','left');
	//	$this->db->where('kk.id_jabatan', ['8']);

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
	    $this->db->from('tindakan t');
		$this->db->join('kol_golongan_pemeriksaan kk', 'kk.id_golongan_pemeriksaan=t.id_golongan_pemeriksaan','left');
		$this->db->join('ol_unit ou', 'ou.id_unit=kk.id_unit','left');
	//	$this->db->where('kk.id_jabatan', ['8']);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('tindakan');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_tindakan(){
		$data_pendaftaran = array(
			'nama_tindakan' => $this->input->post('nama_tindakan'),
			'id_golongan_pemeriksaan' => $this->input->post('id_golongan_pemeriksaan'),
			'status_tindakan' => $this->input->post('status_tindakan'),
			'pembuat_tindakan' => $this->session->id_pegawai
		);
		$this->db->insert('tindakan', $data_pendaftaran);
		return $this->db->insert_id();
	}
	function edit_tindakan(){
		$id_tindakan = $this->input->post('id_tindakan');
		$data_pendaftaran = array(
			'nama_tindakan' => $this->input->post('nama_tindakan'),
			'id_golongan_pemeriksaan' => $this->input->post('id_golongan_pemeriksaan'),
			'status_tindakan' => $this->input->post('status_tindakan')
		);
		$this->db->where('id_tindakan',$id_tindakan);
		$this->db->update('tindakan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function simpan_paket_tindakan(){
		$chk = $this->input->post('chk[]');
		if(empty($chk)){
			$eimplo = "";
		}else{
			$eimplo = implode(",",$chk);
		}
		$data_pendaftaran = array(
			'id_tindakan' => $this->input->post('id_tindakan'),
			'id_instansi' => $this->session->refer,
			'paket' => $eimplo
		);
		return $this->db->insert('tindakan_paket', $data_pendaftaran);
	}
	function edit_paket_tindakan(){
		$id_tindakan = $this->input->post('id_tindakan');
		$chk = $this->input->post('chk[]');
		if(empty($chk)){
			$eimplo = "";
		}else{
			$eimplo = implode(",",$chk);
		}
		$data_pendaftaran = array(
			'paket' => $eimplo
		);
		$this->db->where('id_tindakan',$id_tindakan);
		$this->db->where('id_instansi',$this->session->refer);
		$this->db->update('tindakan_paket', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
// ================================================= TINDAKAN ==============================
	function tarif_tindakan_all($id_tindakan,$id_kelas)
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
		if($id_tindakan > 0){
			$this->db->where('tt.id_tindakan', $id_tindakan);
		}
		if($id_kelas > 0){
			$this->db->where('tt.id_kelas', $id_kelas);
		}
		$this->db->where('status_tarif', 1);
		$this->db->where('id_instansi', $this->session->refer);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('tindakan_tarif tt');
		$this->db->join('tindakan t', 't.id_tindakan=tt.id_tindakan','left');
	$this->db->join('kol_golongan_pemeriksaan kko', 'kko.id_golongan_pemeriksaan=t.id_golongan_pemeriksaan','left');
		$this->db->join('kol_kelas kk', 'kk.id_kelas=tt.id_kelas','left');
//		$this->db->where('kko.id_jabatan', $jabatan);
		if($id_tindakan > 0){
			$this->db->where('tt.id_tindakan', $id_tindakan);
		}
		if($id_kelas > 0){
			$this->db->where('tt.id_kelas', $id_kelas);
		}
		$this->db->where('status_tarif', 1);
		$this->db->where('id_instansi', $this->session->refer);

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
		if($id_tindakan > 0){
			$this->db->where('tt.id_tindakan', $id_tindakan);
		}
		if($id_kelas > 0){
			$this->db->where('tt.id_kelas', $id_kelas);
		}
		$this->db->where('status_tarif', 1);
		$this->db->where('id_instansi', $this->session->refer);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('tindakan_tarif tt');
		$this->db->join('tindakan t', 't.id_tindakan=tt.id_tindakan','left');
	$this->db->join('kol_golongan_pemeriksaan kko', 'kko.id_golongan_pemeriksaan=t.id_golongan_pemeriksaan','left');
		$this->db->join('kol_kelas kk', 'kk.id_kelas=tt.id_kelas','left');
//		$this->db->where('kko.id_jabatan', $jabatan);
		if($id_tindakan > 0){
			$this->db->where('tt.id_tindakan', $id_tindakan);
		}
		if($id_kelas > 0){
			$this->db->where('tt.id_kelas', $id_kelas);
		}
		$this->db->where('status_tarif', 1);
		$this->db->where('id_instansi', $this->session->refer);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
			$jml = $this->jumlah_record_tt($id_tindakan,$id_kelas);

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
    function jumlah_record_tt($id_tindakan,$id_kelas)    //igd.php untuk menampilkan jumlah antrian di igd saja
    {
		$this->db->join('tindakan t', 't.id_tindakan=tt.id_tindakan','left');
			$this->db->join('kol_golongan_pemeriksaan kko', 'kko.id_golongan_pemeriksaan=t.id_golongan_pemeriksaan','left');
		$this->db->join('kol_kelas kk', 'kk.id_kelas=tt.id_kelas','left');
	//	$this->db->where('kko.id_jabatan', $jabatan);
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
//		$id_pelayanan = $this->input->post('id_pelayanan');
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
		$this->db->where('status_tarif',1);
		$this->db->where('id_instansi',$this->session->refer);
		$q = $this->db->get('tindakan_tarif')->row();
		$jml = $q->num;
			if($jml == 0){
				if($harga_tindakan[$i] > 0){
					$kode = $this->m_rancak->kode_generator(15,'TT');
					$data_pendaftaran = array(
						'id_kelas' => $chk[$i],
						'id_tindakan' => $id_tindakan,
						'id_instansi' => $this->session->refer,
						'barcode_tindakan_tarif' => $kode,
						'harga_tindakan' => $harga_tindakan[$i],
						'tgl_berlaku' => $tgl_berlaku,
						'status_tarif' => 1
					);
					$this->db->insert('tindakan_tarif', $data_pendaftaran);
					$this->non_aktifkan_tindakan_tarif($chk[$i],$id_tindakan,$tgl_berlaku);
					$this->tindakan_tarif_log($chk[$i],$id_tindakan,$kode,$tgl_berlaku,$harga_tindakan[$i],1,'tambah');
				}
			}
		}
	}
	function tindakan_tarif_log($id_kelas,$id_tindakan,$kode,$tgl_berlaku,$harga_tindakan,$status,$ket){
		$kls = $this->m_umum->ambil_data('kol_kelas','id_kelas',$id_kelas);
		$tind = $this->m_umum->ambil_data('tindakan','id_tindakan',$id_tindakan);
		$pkt = $this->m_umum->ambil_data('tindakan_paket','id_tindakan',$id_tindakan);
		$data_pendaftaran = array(
			'id_kelas' => $id_kelas,
			'nama_kelas' => $kls['nama_kelas'],
			'id_tindakan' => $id_tindakan,
			'nama_tindakan' => $tind['nama_tindakan'],
			'barcode_tindakan_tarif' => $kode,
			'harga_tindakan' => $harga_tindakan,
			'tgl_berlaku' => $tgl_berlaku,
			'paket' => $pkt['paket'],
			'id_instansi' => $this->session->refer,
			'status_tarif' => $status,
			'editor' => $this->session->id_pegawai,
			'ket_tindakan_tarif_log' => $ket
		);
		$this->db->insert('tindakan_tarif_log', $data_pendaftaran);
	}
	function non_aktifkan_tindakan_tarif($id_kelas,$id_tindakan,$tgl_berlaku){
		$id_tindakan_tarif = $this->input->post('id_tindakan_tarif');
		$this->db->select("COUNT(*) as num");
		$this->db->where('id_instansi',$this->session->refer);
		$this->db->where('id_kelas',$id_kelas);
		$this->db->where('id_tindakan',$id_tindakan);
		$this->db->where('tgl_berlaku !=',$tgl_berlaku);
		$this->db->where('status_tarif',1);
		$q = $this->db->get('tindakan_tarif')->row();
		$jml = $q->num;
		if($jml > 0){
			$tt = $this->m_umum->ambil_data('tindakan_tarif','id_tindakan_tarif',$id_tindakan_tarif);
			$data_pendaftaran = array(
				'status_tarif' => 0
			);
			$this->db->where('id_instansi',$this->session->refer);
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
				$this->tindakan_tarif_log($id_kelas,$id_tindakan,$tt['barcode_tindakan_tarif'],$tt['tgl_berlaku'],$harga_tindakan,0,'non aktif');

		}
	}
	function edit_tindakan_tarif($tgl_berlaku,$harga_tindakan){
		$id_tindakan_tarif = $this->input->post('id_tindakan_tarif');
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
		$fields = "*,if (id_kategori_dokter = '1' ,'Dokter','Bidan / Mantri') as id_kategori_dokter,
		concat(alamat_rujukan_dokter,', Prop : ',nama_prov,', Kota/Kab : ',nama_kab,', Kec : ',nama_kec,', Kel : ',nama_kel) as alamat_rujukan_dokter
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
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('kol_rujukan_dokter p');
		$this->db->join('kol_provinsi provi', 'provi.id_prov=p.id_prov','left');
		$this->db->join('kol_kabupaten kabu', 'kabu.id_kab=p.id_kab','left');
		$this->db->join('kol_kecamatan keca', 'keca.id_kec=p.id_kec','left');
		$this->db->join('kol_kelurahan kelu', 'kelu.id_kel=p.id_kel','left');

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
	    $this->db->from('kol_rujukan_dokter p');
		$this->db->join('kol_provinsi provi', 'provi.id_prov=p.id_prov','left');
		$this->db->join('kol_kabupaten kabu', 'kabu.id_kab=p.id_kab','left');
		$this->db->join('kol_kecamatan keca', 'keca.id_kec=p.id_kec','left');
		$this->db->join('kol_kelurahan kelu', 'kelu.id_kel=p.id_kel','left');

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
			'alamat_rujukan_dokter' => $this->input->post('alamat_rujukan_dokter'),
			'email_rujukan_dokter' => $this->input->post('email_rujukan_dokter'),
			'kontak_rujukan_dokter' => $this->input->post('kontak_rujukan_dokter'),
			'id_prov' => $this->input->post('id_prov'),
			'id_kel' => $this->input->post('id_kel'),
			'id_kab' => $this->input->post('id_kab'),
			'id_kec' => $this->input->post('id_kec'),
			'id_kategori_dokter' => $this->input->post('id_kategori_dokter')
		);
		return $this->db->insert('kol_rujukan_dokter', $data_pendaftaran);
	}
	function edit_rujukan_dokter(){
		$id_rujukan_dokter = $this->input->post('id_rujukan_dokter');
		$data_pendaftaran = array(
			'nama_rujukan_dokter' => $this->input->post('nama_rujukan_dokter'),
			'alamat_rujukan_dokter' => $this->input->post('alamat_rujukan_dokter'),
			'email_rujukan_dokter' => $this->input->post('email_rujukan_dokter'),
			'kontak_rujukan_dokter' => $this->input->post('kontak_rujukan_dokter'),
			'id_prov' => $this->input->post('id_prov'),
			'id_kel' => $this->input->post('id_kel'),
			'id_kab' => $this->input->post('id_kab'),
			'id_kec' => $this->input->post('id_kec'),
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
		$fields = "*,concat(alamat_rujukan_instansi,', Prop : ',nama_prov,', Kota/Kab : ',nama_kab,', Kec : ',nama_kec,', Kel : ',nama_kel) as alamat_rujukan_instansi";
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
		$this->db->join('kol_provinsi provi', 'provi.id_prov=kri.id_prov','left');
		$this->db->join('kol_kabupaten kabu', 'kabu.id_kab=kri.id_kab','left');
		$this->db->join('kol_kecamatan keca', 'keca.id_kec=kri.id_kec','left');
		$this->db->join('kol_kelurahan kelu', 'kelu.id_kel=kri.id_kel','left');

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
		$this->db->join('kol_provinsi provi', 'provi.id_prov=kri.id_prov','left');
		$this->db->join('kol_kabupaten kabu', 'kabu.id_kab=kri.id_kab','left');
		$this->db->join('kol_kecamatan keca', 'keca.id_kec=kri.id_kec','left');
		$this->db->join('kol_kelurahan kelu', 'kelu.id_kel=kri.id_kel','left');

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
			'alamat_rujukan_instansi' => $this->input->post('alamat_rujukan_instansi'),
			'email_rujukan_instansi' => $this->input->post('email_rujukan_instansi'),
			'kontak_rujukan_instansi' => $this->input->post('kontak_rujukan_instansi'),
			'id_prov' => $this->input->post('id_prov'),
			'id_kel' => $this->input->post('id_kel'),
			'id_kab' => $this->input->post('id_kab'),
			'id_kec' => $this->input->post('id_kec'),
			'id_cara_masuk' => $this->input->post('id_cara_masuk')
		);
		return $this->db->insert('kol_rujukan_instansi', $data_pendaftaran);
	}
	function edit_rujukan_faskes(){
		$id_rujukan_instansi = $this->input->post('id_rujukan_instansi');
		$data_pendaftaran = array(
			'nama_rujukan_instansi' => $this->input->post('nama_rujukan_instansi'),
			'alamat_rujukan_instansi' => $this->input->post('alamat_rujukan_instansi'),
			'email_rujukan_instansi' => $this->input->post('email_rujukan_instansi'),
			'kontak_rujukan_instansi' => $this->input->post('kontak_rujukan_instansi'),
			'id_prov' => $this->input->post('id_prov'),
			'id_kel' => $this->input->post('id_kel'),
			'id_kab' => $this->input->post('id_kab'),
			'id_kec' => $this->input->post('id_kec'),
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
				$this->db->where('id_instansi', $this->session->refer);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_unit r');
	    $this->db->where('id_instansi', $this->session->refer);
	//	$this->db->join('jabatan sj', 'sj.id_jabatan=r.id_jabatan','left');

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
				$this->db->where('id_instansi', $this->session->refer);
			}
		  }
		}

	    $this->db->from('ol_unit r');
	    $this->db->where('id_instansi', $this->session->refer);

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
		$data_pendaftaran = array(
			'id_unit' => $kode,
			'nama_unit' => $this->input->post('nama_unit'),
			'id_instansi' => $this->session->refer,
			'status_unit' => $this->input->post('status_unit')
		);
		return $this->db->insert('ol_unit', $data_pendaftaran);
	}
	function edit_ruangan(){
		$id_unit = $this->input->post('id_unit');
		$data_pendaftaran = array(
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
// =================================================================================================================
	function ambil_tindakan_radiologi($id,$idt)
	{
	//	$idjd = $this->m_umum->ambil_data('ruangan','id_ruangan',$this->session->id_ruangan);
		$this->db->join('kol_kelas', 'kol_kelas.id_kelas=tindakan_tarif.id_kelas','left');
		$this->db->join('tindakan', 'tindakan.id_tindakan=tindakan_tarif.id_tindakan','left');
		$this->db->join('kol_golongan_pemeriksaan kgp', 'kgp.id_golongan_pemeriksaan=tindakan.id_golongan_pemeriksaan','left');
		if(isset($_POST['searchTerm']) && !empty($_POST['searchTerm'])){
			$search = $this->input->post('searchTerm');
			$this->db->group_start();
			$this->db->like('nama_tindakan', $search);
			$this->db->or_like('nama_golongan_pemeriksaan', $search);
			$this->db->or_like('nama_kelas', $search);
			$this->db->or_like('nama_struktur_jabatan', $search);
			$this->db->group_end();
		}
/*		if($id > 0){$this->db->where('tindakan_tarif.id_kelas', $id);}		
		if($this->session->id_level !== '99'){$this->db->where('kgp.id_struktur_jabatan', $idjd['id_jabatan_jabatan']);}	*/	
		$this->db->where('tindakan_tarif.id_kelas', $id);
	//	$this->db->where_in('kgp.id_unit', $idt);
		$this->db->where('status_tarif', 1);
		$this->db->where('status_tindakan', 1);
		$this->db->where('status_golongan_pemeriksaan', 1);
		$this->db->where('status_kelas', 1);
		$this->db->order_by("nama_tindakan", "asc");
	//	$this->db->limit(5);
		$r = $this->db->get('tindakan_tarif')->result_array();
		return $r;
	}
	function ambil_data_dropdown_unit($sj)
	{
		$this->db->select("id_unit as id_ruangan, concat(nama_unit,' _ ',nama_working) as nama_ruangan");
/*		if($this->session->has_userdata('id_level') && $this->session->userdata('id_level')==99){

    	}else{
    		if(!empty($sj)){
				$idu = explode(',', $sj);$this->db->where_in('ol_unit.id_unit',$ids);
			}
			$idi = explode(',', $this->session->list_working);$this->db->where_in('ol_unit.id_instansi',$idi);
    	}*/	
		$this->db->where('ol_unit.id_instansi',$this->session->refer);
    	$this->db->join('kol_working', 'kol_working.id_working=ol_unit.id_instansi','left');
		$query = $this->db->get_where('ol_unit',array('status_unit'=>1))->result_array();
		$q= array_column($query,'nama_ruangan','id_ruangan');
		return $q;
	}
	function ambil_data_pelayanan_no_null()
	{
		$kw = $this->m_umum->ambil_data('kol_working','id_working',$this->session->refer);
		$ids = explode(',', $kw['pelayanan']);
		$this->db->select("id_unit, nama_unit");
		$this->db->where_in("id_unit",$ids);
		$query = $this->db->get_where('ol_unit',array('status_unit'=>1))->result_array();
		$q= array_column($query,'nama_unit','id_unit');
		return $q;
	}
	function ambil_data_pelayanan_no_null2()
	{
		$this->db->select("id_pelayanan, nama_pelayanan");
		$query = $this->db->get_where('ol_pelayanan',array('status_pelayanan'=>1,'id_instansi'=>$this->session->refer))->result_array();
		$q= array_column($query,'nama_pelayanan','id_pelayanan');
		return $q;
	}
	function ambil_data_dropdown_radiologi_unit($id)
	{
		$kw = $this->m_umum->ambil_data('kol_working','id_working',$this->session->refer);
		$ids = explode(',', $kw['pelayanan']);
		$this->db->where_in("id_unit",$ids);
		$query = $this->db->get_where('ol_unit',array('status_unit'=>1));
		return $query->result_array();
	}
	function ambil_data_radiologi_unit()
	{
		$this->db->select("nama_unit,id_unit");
        $query = $this->db->get_where('ol_unit',array('status_unit' => '1','daftar'=>1,'id_instansi'=>$this->session->refer))->result_array();
		$q= array_column($query,'nama_unit','id_unit');
		return $q;
	}
	function cmd_pegawai_null($id){
/*		if($this->session->has_userdata('id_level') && $this->session->userdata('id_level')==99){
			$this->db->select("concat(nama_pegawai,'  [',nama_unit,' - ',nama_working,']') as nama_pegawai,id_pegawai");
			$this->db->join('ol_pegawai op', 'op.id_pegawai=opi.id_pegawai','left');
			$this->db->join('ol_unit ou', 'ou.id_unit=opi.id_unit','left');
			$this->db->join('kol_working kw', 'kw.id_working=opi.id_instansi','left');
			$q = $this->db->get_where('ol_pegawai_unit opi');
		}else{*/
		//	if(empty($id)){
		//		$idi = explode(',', $this->session->list_working);$this->db->where_in('opi.id_instansi',$idi);
				$this->db->select("nama_pegawai,id_pegawai");
				$this->db->join('ol_user ou', 'ou.id_pegawai=op.id_pegawai','left');
				$q = $this->db->get_where('ol_pegawai op',array('refer'=>$this->session->refer));						
/*			}else{
				$this->db->select("concat(nama_pegawai,'  [',nama_unit,']') as nama_pegawai,id_pegawai");
				$this->db->where('ou.id_unit',$id);
				$idi = explode(',', $this->session->list_working);$this->db->where_in('ou.id_instansi',$idi);
				$this->db->join('ol_pegawai op', 'op.id_pegawai=opi.id_pegawai','left');
				$this->db->join('ol_unit ou', 'ou.id_unit=opi.id_unit','left');
				$q = $this->db->get_where('ol_pegawai_unit opi');
			}*/
	//	}	
		return $q->result_array();
	}
	function pasien_baru_all($key)
	{
		$wordsAry = explode("-", $key);
		$wordsCount = count($wordsAry);
		$fields = "*,if (p.jk = '1' ,'Laki-laki','Perempuan') as jk,p.nik,p.tmp_lahir,p.tgl_lahir,p.alamat,
concat(nama_pasangan,' (Nama Pasangan) - Data Ayah : ',nama_ayah,' NIK Ayah : ',nik_ayah,' - Data Ibu : ',nama_ibu,' NIK Ibu : ',nik_ibu) as data_lain,
			if (p.id_golongan_darah = '0' ,'Belum Ada Data',nama_golongan_darah) as nama_golongan_darah,
			if (p.id_agama = '0' ,'Belum Ada Data',nama_agama) as nama_agama,
			if (p.id_pekerjaan = '0' ,'Belum Ada Data',nama_pekerjaan) as nama_pekerjaan,
			if (p.id_status_kawin = '0' ,'Belum Ada Data',nama_status_kawin) as nama_status_kawin,
			if (p.id_pendidikan = '0' ,'Belum Ada Data',nama_pendidikan) as nama_pendidikan,
			if (p.id_prov = '0' ,'Belum Ada Data',nama_prov) as nama_prov,
			if (p.id_kab = '0' ,'Belum Ada Data',nama_kab) as nama_kab,
			if (p.id_kec = '0' ,'Belum Ada Data',nama_kec) as nama_kec,
			if (p.id_kel = '0' ,'Belum Ada Data',nama_kel) as nama_kel,
			CONCAT((TIMESTAMPDIFF( YEAR, p.tgl_lahir, now() )), ' Tahun ',
			TIMESTAMPDIFF( MONTH, p.tgl_lahir, now() ) % 12, ' Bulan ',
			FLOOR( TIMESTAMPDIFF( DAY, p.tgl_lahir, now() ) % 30.4375 ), ' Hari') as umur,
			DATE_FORMAT(p.tgl_lahir,'%d-%m-%Y') as tgl_lahir,
			DATE_FORMAT(p.dibuat,'%d-%m-%Y %H:%i:%s') as dibuat";
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
		if(!empty($key) || $this->input->post('key',true)){
			$this->db->group_start();
		for($i=0;$i<$wordsCount;$i++) {
$this->db->or_where("(p.rm LIKE '%".$wordsAry[$i]."%' OR p.nama_pasien LIKE '%".$wordsAry[$i]."%' OR p.nama_ayah LIKE '%".$wordsAry[$i]."%' OR p.nama_ibu LIKE '%".$wordsAry[$i]."%' OR p.nik LIKE '%".$wordsAry[$i]."%' OR p.nik_ayah LIKE '%".$wordsAry[$i]."%' OR p.nik_ibu LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
		}
			$this->db->group_end();
		}
			$this->db->where("pasien_instansi", $this->session->refer);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

   	    $this->db->from('pasien p');
		$this->db->join('kol_agama a', 'a.id_agama=p.id_agama','left');
		$this->db->join('kol_golongan_darah kgd', 'kgd.id_golongan_darah=p.id_golongan_darah','left');
		$this->db->join('kol_pendidikan pend', 'pend.id_pendidikan=p.id_pendidikan','left');
		$this->db->join('kol_pekerjaan kp', 'kp.id_pekerjaan=p.id_pekerjaan','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=p.id_status_kawin','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=p.id_pegawai','left');
		$this->db->join('kol_provinsi provi', 'provi.id_prov=p.id_prov','left');
		$this->db->join('kol_kabupaten kabu', 'kabu.id_kab=p.id_kab','left');
		$this->db->join('kol_kecamatan keca', 'keca.id_kec=p.id_kec','left');
		$this->db->join('kol_kelurahan kelu', 'kelu.id_kel=p.id_kel','left');
		$this->db->join('kol_working kw', 'kw.id_working=pasien_instansi','left');
		if(!empty($key) || $this->input->post('key',true)){
		$this->db->group_start();
		for($i=0;$i<$wordsCount;$i++) {
$this->db->or_where("(p.rm LIKE '%".$wordsAry[$i]."%' OR p.nama_pasien LIKE '%".$wordsAry[$i]."%' OR p.nama_ayah LIKE '%".$wordsAry[$i]."%' OR p.nama_ibu LIKE '%".$wordsAry[$i]."%' OR p.nik LIKE '%".$wordsAry[$i]."%' OR p.nik_ayah LIKE '%".$wordsAry[$i]."%' OR p.nik_ibu LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
		}
		$this->db->group_end();
		}
			$this->db->where("pasien_instansi", $this->session->refer);

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
		if(!empty($key) || $this->input->post('key',true)){
			$this->db->group_start();
		for($i=0;$i<$wordsCount;$i++) {
$this->db->or_where("(p.rm LIKE '%".$wordsAry[$i]."%' OR p.nama_pasien LIKE '%".$wordsAry[$i]."%' OR p.nama_ayah LIKE '%".$wordsAry[$i]."%' OR p.nama_ibu LIKE '%".$wordsAry[$i]."%' OR p.nik LIKE '%".$wordsAry[$i]."%' OR p.nik_ayah LIKE '%".$wordsAry[$i]."%' OR p.nik_ibu LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
		}
			$this->db->group_end();
		}
			$this->db->where("pasien_instansi", $this->session->refer);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
   	    $this->db->from('pasien p');
		$this->db->join('kol_agama a', 'a.id_agama=p.id_agama','left');
		$this->db->join('kol_golongan_darah kgd', 'kgd.id_golongan_darah=p.id_golongan_darah','left');
		$this->db->join('kol_pendidikan pend', 'pend.id_pendidikan=p.id_pendidikan','left');
		$this->db->join('kol_pekerjaan kp', 'kp.id_pekerjaan=p.id_pekerjaan','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=p.id_status_kawin','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=p.id_pegawai','left');
		$this->db->join('kol_provinsi provi', 'provi.id_prov=p.id_prov','left');
		$this->db->join('kol_kabupaten kabu', 'kabu.id_kab=p.id_kab','left');
		$this->db->join('kol_kecamatan keca', 'keca.id_kec=p.id_kec','left');
		$this->db->join('kol_kelurahan kelu', 'kelu.id_kel=p.id_kel','left');
		$this->db->join('kol_working kw', 'kw.id_working=pasien_instansi','left');
		if(!empty($key) || $this->input->post('key',true)){
			$this->db->group_start();
		for($i=0;$i<$wordsCount;$i++) {
$this->db->or_where("(p.rm LIKE '%".$wordsAry[$i]."%' OR p.nama_pasien LIKE '%".$wordsAry[$i]."%' OR p.nama_ayah LIKE '%".$wordsAry[$i]."%' OR p.nama_ibu LIKE '%".$wordsAry[$i]."%' OR p.nik LIKE '%".$wordsAry[$i]."%' OR p.nik_ayah LIKE '%".$wordsAry[$i]."%' OR p.nik_ibu LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
		}
			$this->db->group_end();
		}
			$this->db->where("pasien_instansi", $this->session->refer);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
	//	$kondisi=array('id_level !='=>'99');
	//	$jml = $this->m_umum->jumlah_record_filter('user',$kondisi);		//[coding here] ganti tabel utamanya
		$jml = $this->m_umum->jumlah_record_tabel('pasien');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_pasien($id){
		$tgl_lahir = $this->input->post('tgl_lahir');
		$tgl_lahir = date('Y-m-d', strtotime($tgl_lahir));
		$rm = $this->input->post('rm');
		$rm = strtoupper($rm);
		$kode = $this->m_rancak->kode_generator(15,'');
		$data_pendaftaran = array(
			'barcode_pasien' => $kode,
			'rm' => $rm,
			'nik' => $this->input->post('nik'),
			'nama_pasien' => $this->input->post('nama_pasien'),
			'tgl_lahir' => $tgl_lahir,
			'tmp_lahir' => $this->input->post('tmp_lahir'),
			'id_golongan_darah' => $this->input->post('id_golongan_darah'),
			'id_agama' => $this->input->post('id_agama'),
			'jk' => $this->input->post('jk'),
			'alamat' => $this->input->post('alamat'),
			'id_kab' => $this->input->post('id_kab'),
			'id_kel' => $this->input->post('id_kel'),
			'id_kec' => $this->input->post('id_kec'),
			'id_prov' => $this->input->post('id_prov'),
			'telepon' => $this->input->post('telepon'),
			'id_pendidikan' => $this->input->post('id_pendidikan'),
			'id_pekerjaan' => $this->input->post('id_pekerjaan'),
			'id_status_kawin' => $this->input->post('id_status_kawin'),
			'nama_pasangan' => $this->input->post('nama_pasangan'),
			'nama_ayah' => $this->input->post('nama_ayah'),
			'nik_ayah' => $this->input->post('nik_ayah'),
			'nik_ibu' => $this->input->post('nik_ibu'),
			'nama_ibu' => $this->input->post('nama_ibu'),
			'dibuat' => date('Y-m-d H:i:s'),
			'id_pegawai' => $this->session->id_pegawai,
			'pasien_instansi' => $this->session->refer
		);
		$this->db->insert('pasien', $data_pendaftaran);
	//	return $this->db->insert_id();
		return $kode;
	}
	function edit_pasien(){
		$tgl_lahir = $this->input->post('tgl_lahir');
		$tgl_lahir = date('Y-m-d', strtotime($tgl_lahir));
		$id_pasien = $this->input->post('id_pasien');
		$rm = $this->input->post('rm');
		$rm = strtoupper($rm);
		$id_kab = $this->input->post('id_kab');
		if($id_kab == NULL OR empty($id_kab)){
			$id_kab = 0;
		}
		$id_kel = $this->input->post('id_kel');
		if($id_kel == NULL OR empty($id_kel)){
			$id_kel = 0;
		}
		$id_kec = $this->input->post('id_kec');
		if($id_kec == NULL OR empty($id_kec)){
			$id_kec = 0;
		}
		$id_prov = $this->input->post('id_prov');
		if($id_prov == NULL OR empty($id_prov)){
			$id_prov = 0;
		}
		$data_pendaftaran = array(
			'nama_pasien' => $this->input->post('nama_pasien'),
			'tgl_lahir' => $tgl_lahir,
			'tmp_lahir' => $this->input->post('tmp_lahir'),
			'id_golongan_darah' => $this->input->post('id_golongan_darah'),
			'id_agama' => $this->input->post('id_agama'),
			'jk' => $this->input->post('jk'),
			'alamat' => $this->input->post('alamat'),
			'id_kab' => $id_kab,
			'id_kel' => $id_kel,
			'id_kec' => $id_kec,
			'id_prov' => $id_prov,
			'telepon' => $this->input->post('telepon'),
			'id_pendidikan' => $this->input->post('id_pendidikan'),
			'nik_ayah' => $this->input->post('nik_ayah'),
			'nik_ibu' => $this->input->post('nik_ibu'),
			'id_pekerjaan' => $this->input->post('id_pekerjaan'),
			'id_status_kawin' => $this->input->post('id_status_kawin'),
			'nama_pasangan' => $this->input->post('nama_pasangan'),
			'nama_ayah' => $this->input->post('nama_ayah'),
			'nama_ibu' => $this->input->post('nama_ibu')
		);
		$this->db->where('id_pasien',$id_pasien);
		$this->db->update('pasien', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function simpan_pendaftaran(){
		$rm = $this->input->post('rm');
		$diagnosa_awal = $this->input->post('id_icd10');
		$barcode_pasien = $this->input->post('barcode_pasien');
		$id_cara_bayar = $this->input->post('id_cara_bayar');
		$id_cara_masuk = $this->input->post('id_cara_masuk');
				$id_dokter_rujukan = 0;
				$id_rujukan_instansi = 0;
		switch($id_cara_masuk){
			case "1": // datang sendiri
				$id_dokter_rujukan = 0;
				$id_rujukan_instansi = 0;
				break;
			case "2": // dokter praktek
				$id_dokter_rujukan = $this->input->post('id_rujukan_dokter');
				$id_rujukan_instansi = 0;
				break;
			case "3": // rs pemerintah
				$id_dokter_rujukan = $this->input->post('id_rujukan_dokter');
				$id_rujukan_instansi = $this->input->post('id_rujukan_instansi');
				break;
			case "4": // rs swasta
				$id_dokter_rujukan = $this->input->post('id_rujukan_dokter');
				$id_rujukan_instansi = $this->input->post('id_rujukan_instansi');
				break;
			case "5": // klinik
				$id_dokter_rujukan = $this->input->post('id_rujukan_dokter');
				$id_rujukan_instansi = $this->input->post('id_rujukan_instansi');
				break;
			case "6": // bidan
				$id_dokter_rujukan = $this->input->post('id_rujukan_dokter');
				$id_rujukan_instansi = 0;
				break;
			case "7": // internal
				$id_dokter_rujukan = $this->input->post('pengirim');
				$id_rujukan_instansi = $this->input->post('ruangan');
				break;
		}
		if($id_cara_bayar=='6'){
			$id_detil_cara_bayar = $this->input->post('id_petugas');
		}else{
			$id_detil_cara_bayar = $this->input->post('id_detil_cara_bayar');
		}
		$no_pendaftaran = $this->input->post('no_pendaftaran');
		$keluhan = $this->input->post('keluhan');
		if(!empty($diagnosa_awal)){
			$diagnosa_awal = $diagnosa_awal;
		}else{
			$diagnosa_awal = 0;
		}
		$kode = $this->m_rancak->kode_generator(15,'PN');
		$data_pendaftaran = array(
			'id_cara_bayar' => $id_cara_bayar,
			'barcode_pendaftaran' => $kode,
			'barcode_pasien' => $barcode_pasien,
			'diagnosa_awal' => $diagnosa_awal,
			'no_pendaftaran' => $no_pendaftaran,
			'id_detil_cara_bayar' => $id_detil_cara_bayar,
			'id_cara_masuk' => $id_cara_masuk,
			'id_dokter_rujukan' => $id_dokter_rujukan,
			'id_instansi_cara_masuk' => $id_rujukan_instansi,
			'penunjang' => 0,
			'pendaftaran_instansi' => $this->session->refer,				
			'keluhan' => $keluhan
		);
		// print_r($data_pendaftaran);die();
		//	echo $i;
		$this->db->insert('pendaftaran', $data_pendaftaran);
		return $kode;
	}
	function simpan_log($log){
		$kode = $this->m_rancak->kode_generator(15,'');
		$data_pendaftaran = array(
			'barcode_pendaftaran_log' => $kode,
			'id_pegawai' => $this->session->id_pegawai,
			'log' => $log
		);
		// print_r($data_pendaftaran);die();
		$this->db->insert('pendaftaran_log', $data_pendaftaran);
		return $kode;
	}
	function simpan_pendaftaran_unit4($last_ide){
		$ket_pendaftaran_unit = $this->input->post('ket_pendaftaran_unit');
		$waktu_daftar = $this->input->post('waktu_daftar');
		$tgl_pendaftaran_unit = date('Y-m-d', strtotime($waktu_daftar));
		$id_pegawai = $this->session->id_pegawai;
		$antri = $this->m_umum->total_antri($id_unit,$waktu_daftar);
		$antri = $antri+1;
		$kode = $this->m_rancak->kode_generator(15,'PU');
		$data_pendaftaran = array(
			'barcode_pendaftaran' => $last_ide,
			'barcode_pendaftaran_unit' => $kode,
			'tgl_pendaftaran_unit' => $tgl_pendaftaran_unit,
			'ket_pendaftaran_unit' => $ket_pendaftaran_unit,
			'id_unit' => 4,
			'daftar_ke' => 1,
			'id_kelas' => 1,
			'dr_petugas' => $id_pegawai,
			'dr_pengirim' => $id_pegawai,
			'unit_ke' => 4,
			'no_antri' => 200,
			'id_status_pasien' => 1,
			'pembuat_pendaftaran_unit' => $id_pegawai
		);
		// print_r($data_pendaftaran);die();
		$this->db->insert('pendaftaran_unit', $data_pendaftaran);
		return $kode;
	}
	function simpan_icd10($last_id){
		$kode = $this->m_rancak->kode_generator(15,'10');
		$data_pendaftaran = array(
			'barcode_pendaftaran_unit' => $last_id,
			'barcode_pemeriksaan_icdten' => $kode,
			'id_icdten' => $this->input->post('id_icd10')
		);
		// print_r($data_pendaftaran);die();
		return $this->db->insert('pemeriksaan_icdten', $data_pendaftaran);		
		// $this->db->insert_id();			
	}
	function simpan_pemeriksaan($last_ide){
		$kode = $this->m_rancak->kode_generator(15,'PU');
		$log ='
			simpan pemeriksaan dengan data :<br>
			barcode_pendaftaran_unit = '.$last_ide.'<br>
			barcode_pemeriksaan = '.$kode.'<br>
			tgl_pemeriksaan = '.date('Y-m-d').'<br>
			id_pegawai = '.$this->input->post('id_pegawai').'
		';
		$this->simpan_log($log);
		$data_pendaftaran = array(
			'barcode_pendaftaran_unit' => $last_ide,
			'barcode_pemeriksaan' => $kode,
			'tgl_pemeriksaan' => date('Y-m-d'),
			'id_pegawai' => $this->input->post('id_pegawai')
		);
		// print_r($data_pendaftaran);die();
		return $this->db->insert('pemeriksaan', $data_pendaftaran);
	}
	function tambah_pendaftaran_unit(){
		$id_pegawai = $this->input->post('id_pegawai');
				$kode = $this->m_rancak->kode_generator(15,'PU');
		$ket_pendaftaran_unit = $this->input->post('ket_pendaftaran_unit');
		$tgl_pendaftaran_unit = $this->input->post('tgl_pendaftaran_unit');
		$tgl_pendaftaran_unit = date('Y-m-d H:i:s', strtotime($tgl_pendaftaran_unit));
		$id_unit_user = $this->session->unit;
		$id_unit = $this->input->post('id_unit');
		$antri = $this->m_umum->total_antri($id_unit,$tgl_pendaftaran_unit);
		$antri = $antri+1;
		$log ='
			tambah pendaftaran unit dengan data :<br>
			barcode_pendaftaran = '.$this->input->post('barcode_pendaftaran').'<br>
			barcode_pendaftaran_unit = '.$kode.'<br>
			tgl_pendaftaran_unit = '.$tgl_pendaftaran_unit.'<br>
			ket_pendaftaran_unit = '.$ket_pendaftaran_unit.'<br>
			id_unit = '.$id_unit_user.'<br>
			id_kelas = '.$this->input->post('id_kelas').'<br>
			dr_petugas = '.$id_pegawai.'<br>
			dr_pengirim = 0<br>
			unit_ke = '.$id_unit.'<br>
			no_antri = '.$antri.'<br>
			id_petugas = '.$this->session->id_pegawai.'<br>daftar_ke = 1<br>id_status_pasien = 1<br>dr_pengirim = 0
		';
		$this->simpan_log($log);
		$data_pendaftaran = array(
			'barcode_pendaftaran' => $this->input->post('barcode_pendaftaran'),
			'barcode_pendaftaran_unit' => $kode,
			'tgl_pendaftaran_unit' => $tgl_pendaftaran_unit,
			'ket_pendaftaran_unit' => $ket_pendaftaran_unit,
			'dr_petugas' => $id_pegawai,
			'id_unit' => $id_unit_user,
			'daftar_ke' => 1,
			'id_kelas' => $this->input->post('id_kelas'),
			'dr_pengirim' => 0,
			'unit_ke' => $id_unit,
			'no_antri' => $antri,
			'id_status_pasien' => 1,
			'pembuat_pendaftaran_unit' => $this->session->id_pegawai
		);
		// print_r($data_pendaftaran);die();
		$this->db->insert('pendaftaran_unit', $data_pendaftaran);
		return $kode;
	}
	function edit_pendaftaran(){
		$id_pendaftaran = $this->input->post('id_pendaftaran');
		$id_cara_bayar = $this->input->post('id_cara_bayar');
		$id_cara_masuk = $this->input->post('id_cara_masuk');
		switch($id_cara_masuk){
			case "1": // datang sendiri
				$id_dokter_rujukan = 0;
				$id_rujukan_instansi = 0;
				break;
			case "2": // dokter praktek
				$id_dokter_rujukan = $this->input->post('id_dokter_rujukan');
				$id_rujukan_instansi = 0;
				break;
			case "3": // rs pemerintah
				$id_dokter_rujukan = $this->input->post('id_dokter_rujukan');
				$id_rujukan_instansi = $this->input->post('id_rujukan_instansi');
				break;
			case "4": // rs swasta
				$id_dokter_rujukan = $this->input->post('id_dokter_rujukan');
				$id_rujukan_instansi = $this->input->post('id_rujukan_instansi');
				break;
			case "5": // klinik
				$id_dokter_rujukan = $this->input->post('id_dokter_rujukan');
				$id_rujukan_instansi = $this->input->post('id_rujukan_instansi');
				break;
			case "6": // bidan
				$id_dokter_rujukan = $this->input->post('id_dokter_rujukan');
				$id_rujukan_instansi = 0;
				break;
			case "7": // internal
				$id_dokter_rujukan = $this->input->post('pengirim');
				$id_rujukan_instansi = $this->input->post('ruangan');
				break;
		}
		if($id_cara_bayar=='6'){
			$id_detil_cara_bayar = $this->input->post('id_petugas');
		}else{
			$id_detil_cara_bayar = $this->input->post('id_detil_cara_bayar');
		}
		$keluhan = $this->input->post('keluhan');
		$data_pendaftaran = array(
				'id_cara_bayar' => $id_cara_bayar,
				'id_detil_cara_bayar' => $id_detil_cara_bayar,
				'id_cara_masuk' => $id_cara_masuk,
				'id_dokter_rujukan' => $id_dokter_rujukan,
				'id_instansi_cara_masuk' => $id_rujukan_instansi,
				'keluhan' => $keluhan
		);
		$this->db->where('id_pendaftaran',$id_pendaftaran);
		$this->db->update('pendaftaran', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function edit_pendaftaran_unit(){
		$barcode_pendaftaran_unit = $this->input->post('barcode_pendaftaran_unit');
		$tgl_pendaftaran_unit = $this->input->post('tgl_pendaftaran_unit');
		$tgl_pendaftaran_unit = date('Y-m-d H:i:s', strtotime($tgl_pendaftaran_unit));
		$log ='
			edit pendaftaran unit dengan data :<br>
			barcode_pendaftaran_unit = '.$barcode_pendaftaran_unit.'<br>
			tgl_pendaftaran_unit = '.$tgl_pendaftaran_unit.'<br>
			dr_petugas = '.$this->input->post('id_pegawai').'<br>
			ket_pendaftaran_unit = '.$this->input->post('ket_pendaftaran_unit').'<br>
			id_kelas = '.$this->input->post('id_kelas').'<br>
			unit_ke = '.$this->input->post('unit_ke').'
		';
		$this->simpan_log($log);
		$data_pendaftaran = array(
			'tgl_pendaftaran_unit' => $tgl_pendaftaran_unit,
			'id_kelas' => $this->input->post('id_kelas'),
			'dr_petugas' => $this->input->post('id_pegawai'),
			'unit_ke' => $this->input->post('unit_ke'),
			'ket_pendaftaran_unit' => $this->input->post('ket_pendaftaran_unit')
		);
		$this->db->where('barcode_pendaftaran_unit',$barcode_pendaftaran_unit);
		$this->db->update('pendaftaran_unit', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function edit_pemeriksaan(){
		$barcode_pendaftaran_unit = $this->input->post('barcode_pendaftaran_unit');
		$log ='
			edit pemeriksaan dengan data :<br>
			id_pegawai = '.$this->input->post('id_pegawai').'<br>
			barcode_pendaftaran_unit = '.$this->input->post('barcode_pendaftaran_unit').'
		';
		$this->simpan_log($log);
		$data_pendaftaran = array(
			'id_pegawai' => $this->input->post('id_pegawai')
		);
		$this->db->where('barcode_pendaftaran_unit',$barcode_pendaftaran_unit);
		$this->db->update('pemeriksaan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function batal($id){
		$log ='
			batal pendaftaran unit dengan data :<br>
			id_status_pasien = 0<br>
			barcode_pendaftaran_unit = '.$id.'
		';
		$this->simpan_log($log);
		$data_pendaftaran = array(
			'id_status_pasien' => 0,
			'id_batal' => $this->session->id_pegawai
		);
		$this->db->where('barcode_pendaftaran_unit',$id);
		$this->db->update('pendaftaran_unit', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function pendaftaran_pasien_all($first_date,$last_date,$key)
	{
	//	$ids = explode(',', $unit);
		$wordsAry = explode("-", $key);
		$wordsCount = count($wordsAry);
		$fields = "*,
			if (p.jk = '1' ,'Laki-laki','Perempuan') as jk,p.nik,p.tmp_lahir,p.alamat,
			if (p.id_golongan_darah = '0' ,'Belum Ada Data',nama_golongan_darah) as nama_golongan_darah,
			if (p.id_agama = '0' ,'Belum Ada Data',nama_agama) as nama_agama,
			if (p.id_pekerjaan = '0' ,'Belum Ada Data',nama_pekerjaan) as nama_pekerjaan,
			if (p.id_status_kawin = '0' ,'Belum Ada Data',nama_status_kawin) as nama_status_kawin,
			if (p.id_pendidikan = '0' ,'Belum Ada Data',nama_pendidikan) as nama_pendidikan,
			if (p.id_prov = '0' ,'Belum Ada Data',nama_prov) as nama_prov,
			if (p.id_kab = '0' ,'Belum Ada Data',nama_kab) as nama_kab,
			if (p.id_kec = '0' ,'Belum Ada Data',nama_kec) as nama_kec,
			if (p.id_kel = '0' ,'Belum Ada Data',nama_kel) as nama_kel,
			CONCAT((TIMESTAMPDIFF( YEAR, p.tgl_lahir, wkt_daftar )), ' Tahun ',
			TIMESTAMPDIFF( MONTH, p.tgl_lahir, wkt_daftar ) % 12, ' Bulan ',
			FLOOR( TIMESTAMPDIFF( DAY, p.tgl_lahir, wkt_daftar ) % 30.4375 ), ' Hari') as umur,
			DATE_FORMAT(p.tgl_lahir,'%d-%m-%Y') as tgl_lahir,
			DATE_FORMAT(wkt_daftar,'%d-%m-%Y') as wkt_daftar,
			if(pd.id_cara_bayar = '6',peg1.nama_pegawai,ka.nama_detil_cara_bayar) as detil_cara_bayar,
			if(pd.id_cara_masuk = '7',u2.nama_unit,if(pd.id_instansi_cara_masuk = '0','-',nama_rujukan_instansi)) as id_instansi_cara_masuk,
			if(pd.id_cara_masuk = '7',rapen.nama_pegawai,if(pd.id_dokter_rujukan = '0','-',nama_rujukan_dokter)) as id_dokter_rujukan
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
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where("pendaftaran_instansi", $this->session->refer);
		if(!empty($key) || $this->input->post('key',true)){
			$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(p.rm LIKE '%".$wordsAry[$i]."%' OR pd.no_pendaftaran LIKE '%".$wordsAry[$i]."%' OR p.nama_pasien LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}else{
$this->db->where('DATE(wkt_daftar) BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	//	$this->db->from('pendaftaran pd');                   //04 Form.. left join
		$this->db->from('pendaftaran_unit pu');                   //04 Form.. left join
		$this->db->join('pendaftaran pd', 'pd.barcode_pendaftaran=pu.barcode_pendaftaran','left');
		$this->db->join('kol_icd10', 'kol_icd10.id_icd10=pd.diagnosa_awal','left');
		$this->db->join('pasien p', 'p.barcode_pasien=pd.barcode_pasien','left');
		$this->db->join('kol_cara_bayar cb','cb.id_cara_bayar=pd.id_cara_bayar','left');
		$this->db->join('kol_detil_cara_bayar ka','ka.id_detil_cara_bayar=pd.id_detil_cara_bayar','left');
		$this->db->join('kol_cara_masuk cm',  'cm.id_cara_masuk=pd.id_cara_masuk','left');
		$this->db->join('kol_rujukan_dokter dr','dr.id_rujukan_dokter=pd.id_dokter_rujukan','left');
		$this->db->join('kol_rujukan_instansi ir','ir.id_rujukan_instansi=pd.id_instansi_cara_masuk','left');
		$this->db->join('ol_pegawai rapen',     'rapen.id_pegawai=pd.id_dokter_rujukan','left');
		$this->db->join('ol_pegawai peg1','peg1.id_pegawai=pd.id_detil_cara_bayar','left');
		$this->db->join('ol_unit u2','u2.id_unit=pd.id_instansi_cara_masuk','left');
		$this->db->join('kol_agama a', 'a.id_agama=p.id_agama','left');
		$this->db->join('kol_golongan_darah kgd', 'kgd.id_golongan_darah=p.id_golongan_darah','left');
		$this->db->join('kol_pendidikan pend', 'pend.id_pendidikan=p.id_pendidikan','left');
		$this->db->join('kol_pekerjaan kp', 'kp.id_pekerjaan=p.id_pekerjaan','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=p.id_status_kawin','left');
		$this->db->join('kol_provinsi provi', 'provi.id_prov=p.id_prov','left');
		$this->db->join('kol_kabupaten kabu', 'kabu.id_kab=p.id_kab','left');
		$this->db->join('kol_kecamatan keca', 'keca.id_kec=p.id_kec','left');
		$this->db->join('kol_kelurahan kelu', 'kelu.id_kel=p.id_kel','left');
		$this->db->where("pendaftaran_instansi", $this->session->refer);
		if(!empty($key) || $this->input->post('key',true)){
			$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(p.rm LIKE '%".$wordsAry[$i]."%' OR pd.no_pendaftaran LIKE '%".$wordsAry[$i]."%' OR p.nama_pasien LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}else{
$this->db->where('DATE(wkt_daftar) BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		}

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]

					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where("pendaftaran_instansi", $this->session->refer);
		if(!empty($key) || $this->input->post('key',true)){
			$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(p.rm LIKE '%".$wordsAry[$i]."%' OR pd.no_pendaftaran LIKE '%".$wordsAry[$i]."%' OR p.nama_pasien LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}else{
$this->db->where('DATE(wkt_daftar) BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		}
			}
		  }
		}

	//	$this->db->from('pendaftaran pd');                   //04 Form.. left join
		$this->db->from('pendaftaran_unit pu');                   //04 Form.. left join
		$this->db->join('pendaftaran pd', 'pd.barcode_pendaftaran=pu.barcode_pendaftaran','left');
		$this->db->join('kol_icd10', 'kol_icd10.id_icd10=pd.diagnosa_awal','left');
		$this->db->join('pasien p', 'p.barcode_pasien=pd.barcode_pasien','left');
		$this->db->join('kol_cara_bayar cb','cb.id_cara_bayar=pd.id_cara_bayar','left');
		$this->db->join('kol_detil_cara_bayar ka','ka.id_detil_cara_bayar=pd.id_detil_cara_bayar','left');
		$this->db->join('kol_cara_masuk cm',  'cm.id_cara_masuk=pd.id_cara_masuk','left');
		$this->db->join('kol_rujukan_dokter dr','dr.id_rujukan_dokter=pd.id_dokter_rujukan','left');
		$this->db->join('kol_rujukan_instansi ir','ir.id_rujukan_instansi=pd.id_instansi_cara_masuk','left');
		$this->db->join('ol_pegawai rapen',     'rapen.id_pegawai=pd.id_dokter_rujukan','left');
		$this->db->join('ol_pegawai peg1','peg1.id_pegawai=pd.id_detil_cara_bayar','left');
		$this->db->join('ol_unit u2','u2.id_unit=pd.id_instansi_cara_masuk','left');
		$this->db->join('kol_agama a', 'a.id_agama=p.id_agama','left');
		$this->db->join('kol_golongan_darah kgd', 'kgd.id_golongan_darah=p.id_golongan_darah','left');
		$this->db->join('kol_pendidikan pend', 'pend.id_pendidikan=p.id_pendidikan','left');
		$this->db->join('kol_pekerjaan kp', 'kp.id_pekerjaan=p.id_pekerjaan','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=p.id_status_kawin','left');
		$this->db->join('kol_provinsi provi', 'provi.id_prov=p.id_prov','left');
		$this->db->join('kol_kabupaten kabu', 'kabu.id_kab=p.id_kab','left');
		$this->db->join('kol_kecamatan keca', 'keca.id_kec=p.id_kec','left');
		$this->db->join('kol_kelurahan kelu', 'kelu.id_kel=p.id_kel','left');
		$this->db->where("pendaftaran_instansi", $this->session->refer);
		if(!empty($key) || $this->input->post('key',true)){
			$this->db->group_start();
			for($i=0;$i<$wordsCount;$i++) {
				$this->db->or_where("(p.rm LIKE '%".$wordsAry[$i]."%' OR pd.no_pendaftaran LIKE '%".$wordsAry[$i]."%' OR p.nama_pasien LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
			}
			$this->db->group_end();
		}else{
$this->db->where('DATE(wkt_daftar) BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$kondisi=array('pendaftaran_instansi'=>$this->session->refer);
		$jml = $this->m_umum->jumlah_record_filter('pendaftaran',$kondisi);		//[coding here] ganti tabel utamanya
	//	$jml = $this->m_umum->jumlah_record_tabel('pendaftaran');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function pelayanan_all()
	{
		$kw = $this->m_umum->ambil_data('kol_working','id_working',$this->session->refer);
	$ids = explode(',', $kw['pelayanan']);
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

	    $this->db->from('ol_unit');
	    $this->db->where_in('id_unit', $ids);

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
	    $this->db->from('ol_unit');
	    $this->db->where_in('id_unit', $ids);

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
	function simpan_pelayanan_working(){
		$chk = $this->input->post('chk[]');
		if(empty($chk)){
			$eimplo = "";
		}else{
			$eimplo = implode(",",$chk);
		}
		$data_pendaftaran = array(
			'pelayanan' => $eimplo
		);
		$this->db->where('id_working',$this->session->refer);
		$this->db->update('kol_working', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function pendaftaran_billing()
	{
		$fields = "*,
			if (p.jk = '1' ,'Laki-laki','Perempuan') as jk,p.nik,p.tmp_lahir,
			if (p.id_golongan_darah = '0' ,'Belum Ada Data',nama_golongan_darah) as nama_golongan_darah,
			if (p.id_agama = '0' ,'Belum Ada Data',nama_agama) as nama_agama,
			if (p.id_pekerjaan = '0' ,'Belum Ada Data',nama_pekerjaan) as nama_pekerjaan,
			if (p.id_status_kawin = '0' ,'Belum Ada Data',nama_status_kawin) as nama_status_kawin,
			if (p.id_pendidikan = '0' ,'Belum Ada Data',nama_pendidikan) as nama_pendidikan,
			if (p.id_prov = '0' ,'Belum Ada Data',nama_prov) as nama_prov,
			if (p.id_kab = '0' ,'Belum Ada Data',nama_kab) as nama_kab,
			if (p.id_kec = '0' ,'Belum Ada Data',nama_kec) as nama_kec,
			if (p.id_kel = '0' ,'Belum Ada Data',nama_kel) as nama_kel,
			CONCAT((TIMESTAMPDIFF( YEAR, p.tgl_lahir, DATE(wkt_daftar) )), ' Tahun ',
			TIMESTAMPDIFF( MONTH, p.tgl_lahir, DATE(wkt_daftar) ) % 12, ' Bulan ',
			FLOOR( TIMESTAMPDIFF( DAY, p.tgl_lahir, DATE(wkt_daftar) ) % 30.4375 ), ' Hari') as umur,
			DATE_FORMAT(p.tgl_lahir,'%d-%m-%Y') as tgl_lahir,
			DATE_FORMAT(wkt_daftar,'%d-%m-%Y %H:%i:%s') as wkt_daftar,
			if(pd.id_cara_bayar = '6',peg1.nama_pegawai,ka.nama_detil_cara_bayar) as detil_cara_bayar,
			if(pd.id_cara_masuk = '7',u2.nama_unit,if(pd.id_instansi_cara_masuk = '0','-',nama_rujukan_instansi)) as id_instansi_cara_masuk,
			if(pd.id_cara_masuk = '7',rapen.nama_pegawai,if(pd.id_dokter_rujukan = '0','-',nama_rujukan_dokter)) as id_dokter_rujukan
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
	    $this->db->where('status_bayar', 0);
	    $this->db->where("pendaftaran_instansi", $this->session->refer);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('pendaftaran pd');
		$this->db->join('pasien p', 'p.barcode_pasien=pd.barcode_pasien','left');
		$this->db->join('kol_cara_bayar cb','cb.id_cara_bayar=pd.id_cara_bayar','left');
		$this->db->join('kol_detil_cara_bayar ka','ka.id_detil_cara_bayar=pd.id_detil_cara_bayar','left');
		$this->db->join('kol_cara_masuk cm',  'cm.id_cara_masuk=pd.id_cara_masuk','left');
		$this->db->join('kol_rujukan_dokter dr','dr.id_rujukan_dokter=pd.id_dokter_rujukan','left');
		$this->db->join('kol_rujukan_instansi ir','ir.id_rujukan_instansi=pd.id_instansi_cara_masuk','left');
		$this->db->join('ol_pegawai rapen',     'rapen.id_pegawai=pd.id_dokter_rujukan','left');
		$this->db->join('ol_pegawai peg1','peg1.id_pegawai=pd.id_detil_cara_bayar','left');
		$this->db->join('ol_unit u2','u2.id_unit=pd.id_instansi_cara_masuk','left');
		$this->db->join('kol_agama a', 'a.id_agama=p.id_agama','left');
		$this->db->join('kol_golongan_darah kgd', 'kgd.id_golongan_darah=p.id_golongan_darah','left');
		$this->db->join('kol_pendidikan pend', 'pend.id_pendidikan=p.id_pendidikan','left');
		$this->db->join('kol_pekerjaan kp', 'kp.id_pekerjaan=p.id_pekerjaan','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=p.id_status_kawin','left');
		$this->db->join('kol_provinsi provi', 'provi.id_prov=p.id_prov','left');
		$this->db->join('kol_kabupaten kabu', 'kabu.id_kab=p.id_kab','left');
		$this->db->join('kol_kecamatan keca', 'keca.id_kec=p.id_kec','left');
		$this->db->join('kol_kelurahan kelu', 'kelu.id_kel=p.id_kel','left');
		$this->db->join('kol_working kw', 'kw.id_working=pendaftaran_instansi','left');
	    $this->db->where('status_bayar', 0);
	    $this->db->where("pendaftaran_instansi", $this->session->refer);
	//    $this->db->group_by('barcode_pendaftaran');

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
	    $this->db->where('status_bayar', 0);
	    $this->db->where("pendaftaran_instansi", $this->session->refer);				
			}
		  }
		}

	    $this->db->from('pendaftaran pd');
		$this->db->join('pasien p', 'p.barcode_pasien=pd.barcode_pasien','left');
		$this->db->join('kol_cara_bayar cb','cb.id_cara_bayar=pd.id_cara_bayar','left');
		$this->db->join('kol_detil_cara_bayar ka','ka.id_detil_cara_bayar=pd.id_detil_cara_bayar','left');
		$this->db->join('kol_cara_masuk cm',  'cm.id_cara_masuk=pd.id_cara_masuk','left');
		$this->db->join('kol_rujukan_dokter dr','dr.id_rujukan_dokter=pd.id_dokter_rujukan','left');
		$this->db->join('kol_rujukan_instansi ir','ir.id_rujukan_instansi=pd.id_instansi_cara_masuk','left');
		$this->db->join('ol_pegawai rapen',     'rapen.id_pegawai=pd.id_dokter_rujukan','left');
		$this->db->join('ol_pegawai peg1','peg1.id_pegawai=pd.id_detil_cara_bayar','left');
		$this->db->join('ol_unit u2','u2.id_unit=pd.id_instansi_cara_masuk','left');
		$this->db->join('kol_agama a', 'a.id_agama=p.id_agama','left');
		$this->db->join('kol_golongan_darah kgd', 'kgd.id_golongan_darah=p.id_golongan_darah','left');
		$this->db->join('kol_pendidikan pend', 'pend.id_pendidikan=p.id_pendidikan','left');
		$this->db->join('kol_pekerjaan kp', 'kp.id_pekerjaan=p.id_pekerjaan','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=p.id_status_kawin','left');
		$this->db->join('kol_provinsi provi', 'provi.id_prov=p.id_prov','left');
		$this->db->join('kol_kabupaten kabu', 'kabu.id_kab=p.id_kab','left');
		$this->db->join('kol_kecamatan keca', 'keca.id_kec=p.id_kec','left');
		$this->db->join('kol_kelurahan kelu', 'kelu.id_kel=p.id_kel','left');
		$this->db->join('kol_working kw', 'kw.id_working=pendaftaran_instansi','left');
	    $this->db->where('status_bayar', 0);
	    $this->db->where("pendaftaran_instansi", $this->session->refer);
	//    $this->db->group_by('barcode_pendaftaran');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

		$kondisi=array('status_bayar'=>0,'pendaftaran_instansi'=>$this->session->refer);
		$jml = $this->m_umum->jumlah_record_filter('pendaftaran',$kondisi);
	//	$jml = $this->m_umum->jumlah_record_tabel('pendaftaran');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function hitung_billing($id)
	{
		$this->db->join('pemeriksaan pmr', 'pmr.barcode_pemeriksaan=b.barcode_pemeriksaan','left');
		$this->db->join('pendaftaran_unit pu','pu.barcode_pendaftaran_unit=pmr.barcode_pendaftaran_unit','left');
        $this->db->select("FORMAT(sum(nominal_billing * jml_billing),'#,###,##0') as total");
        $query=$this->db->get_where("billing b",array('barcode_pendaftaran'=>$id,'id_status_billing'=>1,'id_status_pasien >'=>0));
        $result = $query->row();
        // echo $this->db->last_query();
        // echo "No Antri = ".$result->no_antri;die();
        if(isset($result))
            return $result->total;
        return 0;
	}
	function detil_billing($id)
	{
		$fields = "*,FORMAT(nominal_billing * jml_billing,'#,###,##0') as total_billing,
			if(b.id_cara_bayar_billing = '6',peg1.nama_pegawai,ka.nama_detil_cara_bayar) as nama_detil_cara_bayar,
			DATE_FORMAT(wkt_pemeriksaan,'%d-%m-%Y %H:%i:%s') as wkt_pemeriksaan,FORMAT(nominal_billing,'#,###,##0') as nominal_billing
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
	    $this->db->where('p.barcode_pendaftaran', $id);
	    $this->db->where("pendaftaran_instansi", $this->session->refer);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('billing b');
		$this->db->join('tindakan_tarif tt', 'tt.barcode_tindakan_tarif=b.barcode_tindakan_tarif','left');
		$this->db->join('tindakan t', 't.id_tindakan=tt.id_tindakan','left');
		$this->db->join('pemeriksaan pmr', 'pmr.barcode_pemeriksaan=b.barcode_pemeriksaan','left');
		$this->db->join('pendaftaran_unit pu','pu.barcode_pendaftaran_unit=pmr.barcode_pendaftaran_unit','left');
		$this->db->join('ol_unit ol','ol.id_unit=pu.unit_ke','left');
		$this->db->join('kol_status_pasien ksp','ksp.id_status_pasien=pu.id_status_pasien','left');
		$this->db->join('pendaftaran p','p.barcode_pendaftaran=pu.barcode_pendaftaran','left');
		$this->db->join('kol_cara_bayar cb','cb.id_cara_bayar=b.id_cara_bayar_billing','left');
		$this->db->join('ol_pegawai peg1','peg1.id_pegawai=b.id_detil_cara_bayar_billing','left');
		$this->db->join('kol_detil_cara_bayar ka','ka.id_detil_cara_bayar=b.id_detil_cara_bayar_billing','left');
	    $this->db->where('p.barcode_pendaftaran', $id);
	    $this->db->where("pendaftaran_instansi", $this->session->refer);
	//    $this->db->group_by('barcode_pendaftaran');

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
	    $this->db->where('p.barcode_pendaftaran', $id);
	    $this->db->where("pendaftaran_instansi", $this->session->refer);				
			}
		  }
		}

	    $this->db->from('billing b');
		$this->db->join('tindakan_tarif tt', 'tt.barcode_tindakan_tarif=b.barcode_tindakan_tarif','left');
		$this->db->join('tindakan t', 't.id_tindakan=tt.id_tindakan','left');
		$this->db->join('pemeriksaan pmr', 'pmr.barcode_pemeriksaan=b.barcode_pemeriksaan','left');
		$this->db->join('pendaftaran_unit pu','pu.barcode_pendaftaran_unit=pmr.barcode_pendaftaran_unit','left');
		$this->db->join('ol_unit ol','ol.id_unit=pu.unit_ke','left');
		$this->db->join('kol_status_pasien ksp','ksp.id_status_pasien=pu.id_status_pasien','left');
		$this->db->join('pendaftaran p','p.barcode_pendaftaran=pu.barcode_pendaftaran','left');
		$this->db->join('kol_cara_bayar cb','cb.id_cara_bayar=b.id_cara_bayar_billing','left');
		$this->db->join('ol_pegawai peg1','peg1.id_pegawai=b.id_detil_cara_bayar_billing','left');
		$this->db->join('kol_detil_cara_bayar ka','ka.id_detil_cara_bayar=b.id_detil_cara_bayar_billing','left');
	    $this->db->where('p.barcode_pendaftaran', $id);
	    $this->db->where("pendaftaran_instansi", $this->session->refer);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//	$kondisi=array('pendaftaran_instansi'=>$this->session->refer);
	//	$jml = $this->m_umum->jumlah_record_filter('billing',$kondisi);
		$jml = $this->m_umum->jumlah_record_tabel('billing');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function edit_cara_bayar_billing(){
		$barcode_billing = $this->input->post('barcode_billing');
		$jml_billing = $this->input->post('jml_billing');
		$id_cara_bayar = $this->input->post('id_cara_bayar');
		if($id_cara_bayar=='6'){
			$id_detil_cara_bayar = $this->input->post('id_pegawai');
		}else{
			$id_detil_cara_bayar = $this->input->post('id_detil_cara_bayar');
		}
		$data_pendaftaran = array(
				'id_cara_bayar_billing' => $id_cara_bayar,
				'id_detil_cara_bayar_billing' => $id_detil_cara_bayar,
				'jml_billing' => $jml_billing
		);
		$this->db->where('barcode_billing',$barcode_billing);
		$this->db->update('billing', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function ambil_pemeriksaan_billing($id)
	{
		$array_check = array(0,6);
		$fields = "*,DATE_FORMAT(pmr.tgl_pemeriksaan,'%d-%m-%Y') as tgl_pemeriksaan,FORMAT(nominal_billing,'#,###,##0') as number_billing";
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
		$this->db->where_in('kgp.id_unit', $array_check);
		$this->db->where('pu.barcode_pendaftaran_unit', $id);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	  	$this->db->from('billing b');
		$this->db->join('pemeriksaan pmr', 'pmr.barcode_pemeriksaan=b.barcode_pemeriksaan','left');
		$this->db->join('pendaftaran_unit pu', 'pu.barcode_pendaftaran_unit=pmr.barcode_pendaftaran_unit','left');
		$this->db->join('kol_kelas kk', 'kk.id_kelas=pu.id_kelas','left');
		$this->db->join('tindakan_tarif tt', 'tt.barcode_tindakan_tarif=b.barcode_tindakan_tarif','left');
		$this->db->join('tindakan t', 't.id_tindakan=tt.id_tindakan','left');
		$this->db->join('kol_golongan_pemeriksaan kgp', 'kgp.id_golongan_pemeriksaan=t.id_golongan_pemeriksaan','left');
	//	$this->db->where_in('kgp.id_unit', $array_check);
		$this->db->where('pu.barcode_pendaftaran_unit', $id);

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
		$this->db->where_in('kgp.id_unit', $array_check);
		$this->db->where('pu.barcode_pendaftaran_unit', $id);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	  	$this->db->from('billing b');
		$this->db->join('pemeriksaan pmr', 'pmr.barcode_pemeriksaan=b.barcode_pemeriksaan','left');
		$this->db->join('pendaftaran_unit pu', 'pu.barcode_pendaftaran_unit=pmr.barcode_pendaftaran_unit','left');
		$this->db->join('kol_kelas kk', 'kk.id_kelas=pu.id_kelas','left');
		$this->db->join('tindakan_tarif tt', 'tt.barcode_tindakan_tarif=b.barcode_tindakan_tarif','left');
		$this->db->join('tindakan t', 't.id_tindakan=tt.id_tindakan','left');
		$this->db->join('kol_golongan_pemeriksaan kgp', 'kgp.id_golongan_pemeriksaan=t.id_golongan_pemeriksaan','left');
	//	$this->db->where_in('kgp.id_unit', $array_check);
		$this->db->where('pu.barcode_pendaftaran_unit', $id);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('billing');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
}
