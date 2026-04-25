<?php
class M_asesor extends CI_model{
	function pengajuan_kompetensi_all($jabatan,$level,$id)
	{
		$ids = explode(',', $jabatan);
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,
					if(b.acc_direktur = '0' ,'Proses',if(b.acc_direktur = '1' ,'Kompeten','Ditolak')) as acc_direktur,
					if(b.acc_komite = '0' ,'Proses',if(b.acc_komite = '1' ,'Kompeten','Ditolak')) as acc_komite,
					if(b.acc_asesor = '0' ,'Proses',if(b.acc_asesor = '1' ,'Kompeten','Ditolak')) as acc_asesor,
					if(b.acc_kabid = '0' ,'Proses',if(b.acc_kabid = '1' ,'Kompeten','Ditolak')) as acc_kabid,
					if(b.tgl_acc_direktur = '0000-00-00' ,'Proses',DATE_FORMAT(b.tgl_acc_direktur,'%d-%m-%Y')) as tgl_acc_direktur,
					if(b.tgl_acc_komite = '0000-00-00' ,'Proses',DATE_FORMAT(b.tgl_acc_komite,'%d-%m-%Y')) as tgl_acc_komite,
					if(b.tgl_acc_asesor = '0000-00-00' ,'Proses',DATE_FORMAT(b.tgl_acc_asesor,'%d-%m-%Y')) as tgl_acc_asesor,
					if(b.tgl_acc_kabid = '0000-00-00' ,'Proses',DATE_FORMAT(b.tgl_acc_kabid,'%d-%m-%Y')) as tgl_acc_kabid,
					if(b.status_pengajuan = '0' ,'Belum Terkirim','Terkirim') as status_pengajuan,
					DATE_FORMAT(b.tgl_pengajuan,'%d-%m-%Y') as tgl_pengajuan
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
				//	 case 'nama_pegawai' : $nmf="peg.nama_pegawai";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);

		if($this->session->id_level !== '99'){
		$this->db->where_in('jf.id_jabatan',$ids);
		}
		$this->db->where('b.status_pengajuan', '1');
		$this->db->where('b.id_asesor', $id);
		$this->db->where('acc_kabid', '1');
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('kr_pengajuan b');
		$this->db->join('kol_status_diusulkan su', 'su.id_status_diusulkan=b.id_status_diusulkan','left');
		$this->db->join('pegawai peg', 'peg.id_pegawai=b.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
		if($this->session->id_level !== '99'){
		$this->db->where_in('jf.id_jabatan',$ids);
		}
		$this->db->where('b.status_pengajuan', '1');
		$this->db->where('b.id_asesor', $id);
		$this->db->where('acc_kabid', '1');

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'nama_pegawai' : $nmf="peg.nama_pegawai";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);

		if($this->session->id_level !== '99'){
		$this->db->where_in('jf.id_jabatan',$ids);
		}
		$this->db->where('b.status_pengajuan', '1');
		$this->db->where('b.id_asesor', $id);
		$this->db->where('acc_kabid', '1');
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('kr_pengajuan b');
		$this->db->join('kol_status_diusulkan su', 'su.id_status_diusulkan=b.id_status_diusulkan','left');
		$this->db->join('pegawai peg', 'peg.id_pegawai=b.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
		if($this->session->id_level !== '99'){
		$this->db->where_in('jf.id_jabatan',$ids);
		}
		$this->db->where('b.status_pengajuan', '1');
		$this->db->where('b.id_asesor', $id);
		$this->db->where('acc_kabid', '1');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('kr_pengajuan');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
	//	 print_r($output);die();
		return $output;
	}
	function logbook_all_a_b($id,$idp)
	{
		$apk	=$this->m_rancak->ambil_pengajuan_kompetensi($id);
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,
					DATE_FORMAT(lp.tgl_logbook,'%d-%m-%Y') as tgl_logbook,DATE_FORMAT(lp.jam_logbook,'%H:%i:%s') as jam_logbook,
					DATE_FORMAT(lp.tgl_v_karu,'%d-%m-%Y') as tgl_v_karu,DATE_FORMAT(lp.tgl_v_kabid,'%d-%m-%Y') as tgl_v_kabid,
					DATE_FORMAT(lp.tgl_v_asesor,'%d-%m-%Y') as tgl_v_asesor,DATE_FORMAT(lp.tgl_v_komite,'%d-%m-%Y') as tgl_v_komite,
					DATE_FORMAT(lp.tgl_v_direktur,'%d-%m-%Y') as tgl_v_direktur,
					if(lp.v_karu = '0' ,'Proses',if(lp.v_karu = '1' ,'Kompeten','Ditolak')) as v_karu,
					if(lp.v_kabid = '0' ,'Proses',if(lp.v_kabid = '1' ,'Kompeten','Ditolak')) as v_kabid,
					if(lp.v_asesor = '0' ,'Proses',if(lp.v_asesor = '1' ,'Kompeten','Ditolak')) as v_asesor,
					if(lp.v_direktur = '0' ,'Proses',if(lp.v_direktur = '1' ,'Kompeten','Ditolak')) as v_direktur,
					if(lp.v_komite = '0' ,'Proses',if(lp.v_komite = '1' ,'Kompeten','Ditolak')) as v_komite,
					if(lp.result_tolak = '0' ,'',if(lp.result_tolak = '1' ,'Supervisi','Tidak Kompeten')) as result_tolak
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
					// case 'nama_pegawai' : $nmf="peg.nama_pegawai";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			$this->db->where("lp.id_pegawai", $apk['id_pegawai']);
			$this->db->where("lp.id_pengajuan", $apk['id_pengajuan']);
			$this->db->where('v_karu', '1');
			$this->db->where('v_kabid', '1');
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('logbook lp');
		$this->db->join('pegawai peg', 'peg.id_pegawai=lp.id_pegawai','left');
		$this->db->join('kr_kewenangan_detil kd', 'kd.id_kewenangan_detil=lp.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan krw', 'krw.id_kewenangan=kd.id_kewenangan','left');
		$this->db->join('kol_kode_kewenangan kw', 'kw.id_kode_kewenangan=kd.id_kode_kewenangan','left');
		$this->db->join('ruangan u', 'u.id_ruangan=kd.id_unit','left');
		$this->db->where("lp.id_pegawai", $apk['id_pegawai']);
		$this->db->where("lp.id_pengajuan", $apk['id_pengajuan']);
		$this->db->where('v_karu', '1');
		$this->db->where('v_kabid', '1');

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
			$this->db->where("lp.id_pegawai", $apk['id_pegawai']);
			$this->db->where("lp.id_pengajuan", $apk['id_pengajuan']);
			$this->db->where('v_karu', '1');
			$this->db->where('v_kabid', '1');
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('logbook lp');
		$this->db->join('pegawai peg', 'peg.id_pegawai=lp.id_pegawai','left');
		$this->db->join('kr_kewenangan_detil kd', 'kd.id_kewenangan_detil=lp.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan krw', 'krw.id_kewenangan=kd.id_kewenangan','left');
		$this->db->join('kol_kode_kewenangan kw', 'kw.id_kode_kewenangan=kd.id_kode_kewenangan','left');
		$this->db->join('ruangan u', 'u.id_ruangan=kd.id_unit','left');
		$this->db->where("lp.id_pegawai", $apk['id_pegawai']);
		$this->db->where("lp.id_pengajuan", $apk['id_pengajuan']);
		$this->db->where('v_karu', '1');
		$this->db->where('v_kabid', '1');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('logbook');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function grafik_logbook($id)	//Laporan Harian
	{
		$apk	=$this->m_rancak->ambil_pengajuan_kompetensi($id);
		$this->db->select("SUM(jml_logbook) as total,kr_kompetensi.nama_kompetensi");
		$this->db->join('kr_kewenangan_detil', 'kr_kewenangan_detil.id_kewenangan_detil=logbook.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan', 'kr_kewenangan.id_kewenangan=kr_kewenangan_detil.id_kewenangan','left');
		$this->db->join('kr_kompetensi', 'kr_kompetensi.id_kompetensi=kr_kewenangan.id_kompetensi','left');
		$this->db->where("lp.id_pegawai", $apk['id_pegawai']);
		if($apk['acc_asesor'] == '0'){
			$this->db->where('v_kabid', '1');
			$this->db->where('v_karu', '1');
		}
		if ($apk['tgl_pengajuan'] < '2022-04-25') {
			$this->db->where('lp.id_logbook BETWEEN "'.$apk['id_logbook_a']. '" and "'.$apk['id_logbook_b'].'"');
		}else{
			$this->db->where("lp.id_pengajuan", $apk['id_pengajuan']);
		}
		$this->db->group_by('kr_kewenangan.id_kompetensi');
		$q = $this->db->get('logbook');
		return $q->result_array();
	}
	function update_v_kabid_kompetensi($isi,$tolak,$id,$id_pegawai,$id_pengajuan){
		$d = $this->m_umum->ambil_data('kr_pengajuan','id_pengajuan',$id_pengajuan);
		$id_karu = $this->session->id_user;
			$data_v_karu = array(
				'v_asesor' => $isi,
				'result_tolak' => $tolak,
				'tgl_v_asesor' => date('Y-m-d')
			);
		$this->db->where("logbook.id_pengajuan", $id_pengajuan);
	//	$this->db->where('id_pegawai',$id_pegawai);
		$this->db->where('id_kewenangan_detil',$id);
		$this->db->where('v_direktur','0');
		$this->db->where('v_komite','0');
		if($isi!=='0'){
			$this->db->where('v_asesor','0');
		}
		$this->db->where('v_karu','1');
		$this->db->where('v_kabid','1');
		$this->db->update('logbook', $data_v_karu);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function update_v_kabid_all_kompetensi($isi,$a,$b,$id_pegawai,$level){
		$id_karu = $this->session->id_user;
		$data_v_karu = array(
			'id_kabid' => $id_karu,
			'tgl_v_kabid' => date('Y-m-d'),
			'v_kabid' => $isi
		);
		$this->db->where('id_logbook BETWEEN "'.$a. '" and "'.$b.'"');
		$this->db->where('id_pegawai',$id_pegawai);
		$this->db->where('v_karu =', '1');
		$this->db->where('v_kabid', '0');
		$this->db->where('v_asesor', '0');
		$this->db->where('v_komite', '0');
		$this->db->where('v_direktur', '0');
		$this->db->update('logbook', $data_v_karu);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function Kabid_Acc($id){
		$id_kabid = $this->session->id_user;
		$data_pendaftaran = array(
			'acc_asesor' => '1',
			'tgl_acc_asesor' => date("Y-m-d"),
		);
		$this->db->where('id_pengajuan',$id);
		$this->db->update('kr_pengajuan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function Kabid_Tolak($id){
		$id_kabid = $this->session->id_user;
		$data_pendaftaran = array(
			'acc_asesor' => '2',
			'tgl_acc_asesor' => date("Y-m-d"),
		);
		$this->db->where('id_pengajuan',$id);
		$this->db->update('kr_pengajuan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
    function jumlah_logbook_pengajuan($id)    //igd.php untuk menampilkan jumlah antrian di igd saja
    {
		$apk = $this->m_rancak->ambil_pengajuan_kompetensi($id);
		// $ids = explode(',', $apk['logbook_pegawai']);
		// $this->db->where_in('id_logbook',$ids);
		$this->db->where('id_logbook BETWEEN "'.$apk['id_logbook_a']. '" and "'.$apk['id_logbook_b'].'"');
		$this->db->where('id_pegawai',$apk['id_pegawai']);
		$this->db->where('v_karu =', '1');
		$this->db->where('v_kabid', '1');
		$this->db->where('v_asesor', '0');
		$this->db->where('v_komite', '0');
		$this->db->where('v_direktur', '0');
        $query = $this->db->select("COUNT(*) as num")->get_where('logbook');
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
    }
	function update_acc_kompetensi_kabid($id){
		$data_v_karu = array(
			'acc_logbook_asesor' => 1
		);
		$this->db->where('id_pengajuan',$id);
		$this->db->update('kr_pengajuan', $data_v_karu);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function perbaiki_proses_kabid($id){
		$data_v_karu = array(
			'acc_asesor' => 0,
			'status_pengajuan' => 0,
			'acc_logbook_asesor' => 0
		);
		$this->db->where('id_pengajuan',$id);
		$this->db->update('kr_pengajuan', $data_v_karu);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function update_proses_kabid($id){
		$data_v_karu = array(
			'acc_asesor' => 0,
			'acc_logbook_asesor' => 0
		);
		$this->db->where('id_pengajuan',$id);
		$this->db->update('kr_pengajuan', $data_v_karu);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
}
