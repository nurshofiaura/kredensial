<?php
class M_penguji extends CI_model{
	function pengajuan_kompetensi_all($jabatan,$level,$id)
	{
		$ids = explode(',', $jabatan);
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,peg.nama_pegawai as nama_pegawai,
					if(b.acc_direktur = '0' ,'Proses',if(b.acc_direktur = '1' ,'Kompeten','Ditolak')) as acc_direktur,
					if(b.acc_komite = '0' ,'Proses',if(b.acc_komite = '1' ,'Kompeten','Ditolak')) as acc_komite,
					if(b.acc_asesor = '0' ,'Proses',if(b.acc_asesor = '1' ,'Kompeten','Ditolak')) as acc_asesor,
					if(b.acc_kabid = '0' ,'Proses',if(b.acc_kabid = '1' ,'Kompeten','Ditolak')) as acc_kabid,
					if(b.status_terbitkan= '0' ,'Belum Diterbitkan',if(b.status_terbitkan = '1' ,'Terbitkan','Tidak diterbitkan')) as status_terbitkan,
					if(b.status_terbitkan= '0' ,'0',if(b.status_terbitkan = '1' ,'1','2')) as no_terbitkan,
					if(b.tgl_acc_direktur = '0000-00-00' ,'Proses',DATE_FORMAT(b.tgl_acc_direktur,'%d-%m-%Y')) as tgl_acc_direktur,
					if(b.tgl_acc_komite = '0000-00-00' ,'Proses',DATE_FORMAT(b.tgl_acc_komite,'%d-%m-%Y')) as tgl_acc_komite,
					if(b.tgl_acc_asesor = '0000-00-00' ,'Proses',DATE_FORMAT(b.tgl_acc_asesor,'%d-%m-%Y')) as tgl_acc_asesor,
					if(b.tgl_acc_kabid = '0000-00-00' ,'Proses',DATE_FORMAT(b.tgl_acc_kabid,'%d-%m-%Y')) as tgl_acc_kabid,
					if(b.tgl_kredensial = '0000-00-00' ,'Proses',DATE_FORMAT(b.tgl_kredensial,'%d-%m-%Y')) as tgl_kredensial,
					if(b.tgl_mutu = '0000-00-00' ,'Proses',DATE_FORMAT(b.tgl_mutu,'%d-%m-%Y')) as tgl_mutu,
					if(b.tgl_etika = '0000-00-00' ,'Proses',DATE_FORMAT(b.tgl_etika,'%d-%m-%Y')) as tgl_etika,
					if(b.id_direktur = '' ,'Proses',peg8.nama_pegawai) as id_direktur,
					if(b.id_komite = '' ,'Proses',peg7.nama_pegawai) as id_komite,
					if(b.id_kabid = '' ,'Proses',peg6.nama_pegawai) as id_kabid,
					if(b.id_etika = '' ,'Proses',peg5.nama_pegawai) as id_etika,
					if(b.id_mutu = '' ,'Proses',peg4.nama_pegawai) as id_mutu,
					if(b.id_kredensial = '' ,'Proses',peg3.nama_pegawai) as id_kredensial,
					if(b.id_asesor = '' ,'Proses',peg2.nama_pegawai) as id_asesor,
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
					 case 'nama_pegawai' : $nmf="peg.nama_pegawai";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);

		$this->db->where('b.status_pengajuan', '1');
		$this->db->where('acc_asesor', '1');
		$this->db->where('acc_kabid', '1');
		$this->db->where_not_in('jf.id_jabatan',$ids);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by
		$this->db->order_by('peg.nama_pegawai', $dir);

	    $this->db->from('kr_pengajuan b');
		$this->db->join('kol_status_diusulkan su', 'su.id_status_diusulkan=b.id_status_diusulkan','left');
		$this->db->join('pegawai peg', 'peg.id_pegawai=b.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
		$this->db->join('pegawai peg2', 'peg2.id_pegawai=b.id_asesor','left');
		$this->db->join('pegawai peg3', 'peg3.id_pegawai=b.id_kredensial','left');
		$this->db->join('pegawai peg4', 'peg4.id_pegawai=b.id_mutu','left');
		$this->db->join('pegawai peg5', 'peg5.id_pegawai=b.id_etika','left');
		$this->db->join('pegawai peg6', 'peg6.id_pegawai=b.id_kabid','left');
		$this->db->join('pegawai peg7', 'peg7.id_pegawai=b.id_komite','left');
		$this->db->join('pegawai peg8', 'peg8.id_pegawai=b.id_direktur','left');
		$this->db->where('b.status_pengajuan', '1');
		$this->db->where('acc_asesor', '1');
		$this->db->where('acc_kabid', '1');
		$this->db->where_not_in('jf.id_jabatan',$ids);

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
					case 'nama_pegawai' : $nmf="peg.nama_pegawai";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);

		$this->db->where("b.status_pengajuan", "1");
		$this->db->where('acc_asesor', '1');
		$this->db->where('acc_kabid', '1');
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('kr_pengajuan b');
		$this->db->join('kol_status_diusulkan su', 'su.id_status_diusulkan=b.id_status_diusulkan','left');
		$this->db->join('pegawai peg', 'peg.id_pegawai=b.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
		$this->db->join('pegawai peg2', 'peg2.id_pegawai=b.id_asesor','left');
		$this->db->join('pegawai peg3', 'peg3.id_pegawai=b.id_kredensial','left');
		$this->db->join('pegawai peg4', 'peg4.id_pegawai=b.id_mutu','left');
		$this->db->join('pegawai peg5', 'peg5.id_pegawai=b.id_etika','left');
		$this->db->join('pegawai peg6', 'peg6.id_pegawai=b.id_kabid','left');
		$this->db->join('pegawai peg7', 'peg7.id_pegawai=b.id_komite','left');
		$this->db->join('pegawai peg8', 'peg8.id_pegawai=b.id_direktur','left');
		$this->db->where('b.status_pengajuan', '1');
		$this->db->where('acc_asesor', '1');
		$this->db->where('acc_kabid', '1');
		$this->db->where_not_in('jf.id_jabatan',$ids);

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
	function logbook_all_a_b($id)
	{
		$apk	=$this->m_rancak->ambil_pengajuan_kompetensi($id);
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,
					DATE_FORMAT(lp.tgl_logbook,'%d-%m-%Y') as tgl_logbook,DATE_FORMAT(lp.jam_logbook,'%H:%i:%s') as jam_logbook,
					DATE_FORMAT(lp.tgl_v_karu,'%d-%m-%Y') as tgl_v_karu,DATE_FORMAT(lp.tgl_v_kabid,'%d-%m-%Y') as tgl_v_kabid,
					DATE_FORMAT(lp.tgl_v_asesor,'%d-%m-%Y') as tgl_v_asesor,DATE_FORMAT(lp.tgl_v_komite,'%d-%m-%Y') as tgl_v_komite,
					DATE_FORMAT(lp.tgl_v_direktur,'%d-%m-%Y') as tgl_v_direktur,lp.id_logbook,
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
		$this->db->where('v_kabid','1');
		$this->db->where('v_asesor','1');
		$this->db->where('v_karu', '1');
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
		$this->db->where('v_kabid','1');
		$this->db->where('v_asesor','1');
		$this->db->where('v_karu', '1');

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
		$this->db->where('v_kabid','1');
		$this->db->where('v_asesor','1');
		$this->db->where('v_karu', '1');
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
		$this->db->where('v_kabid','1');
		$this->db->where('v_asesor','1');
		$this->db->where('v_karu', '1');

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
	function update_v_kabid_kompetensi($isi,$tolak,$id,$id_karu,$id_pengajuan){
		$d = $this->m_umum->ambil_data('kr_pengajuan','id_pengajuan',$id_pengajuan);
		if($d['id_status_diusulkan'] == 4){
			$data_v_karu = array(
				'v_karu' => $isi,
				'id_karu' => $id_karu,
				'tgl_v_karu' => date('Y-m-d'),
				'v_kabid' => $isi,
				'id_kabid' => $id_karu,
				'tgl_v_kabid' => date('Y-m-d'),
				'v_asesor' => $isi,
				'id_asesor' => $id_karu,
				'tgl_v_asesor' => date('Y-m-d'),
				'v_komite' => $isi,
				'id_komite' => $id_karu,
				'tgl_v_komite' => date('Y-m-d'),
				'result_tolak' => $tolak
			);
			$this->db->where("logbook.id_pengajuan", $id_pengajuan);
			$this->db->where('id_pegawai',$d['id_pegawai']);
			$this->db->where('id_kewenangan_detil',$id);			
		}else{
			$data_v_karu = array(
				'v_komite' => $isi,
				'id_komite' => $id_karu,
				'result_tolak' => $tolak,
				'tgl_v_komite' => date('Y-m-d')
			);
			$this->db->where("logbook.id_pengajuan", $id_pengajuan);
		//	$this->db->where('id_logbook BETWEEN "'.$a. '" and "'.$b.'"');
			$this->db->where('id_pegawai',$d['id_pegawai']);
			$this->db->where('id_kewenangan_detil',$id);
			$this->db->where('v_direktur','0');
			if($isi > 0){
			$this->db->where('v_komite','0');
			}
			$this->db->where('v_asesor','1');
			$this->db->where('v_karu','1');
			$this->db->where('v_kabid','1');
		}
		$this->db->update('logbook', $data_v_karu);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
    function update_berkaspengajuan($data = array()){
		$insert = $this->db->update_batch('kr_pengajuan',$data,'id_pengajuan');
        return $insert?true:false;
    }
	function update_terbitkan($id,$isi){
		$data_v_karu = array(
			'status_terbitkan' => $isi
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
