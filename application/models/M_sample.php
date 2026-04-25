<?php
class M_sample extends CI_model{
	function ambil_data_dropdown_jabfung_status($id)
	{
		$query = $this->db->get_where('jabatan_fungsional',array('id_jabatan'=>$id));
		return $query->result_array();
	}
	function s_logbook_all()
	{
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_logbook
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
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('s_logbook lp');
		$this->db->join('s_pegawai peg', 'peg.id_pegawai=lp.id_logbooker','left');
		$this->db->join('ol_kewenangan krw', 'krw.id_kewenangan=lp.id_kewenangan','left');
		$this->db->join('kol_kode_kewenangan kw', 'kw.id_kode_kewenangan=krw.id_kode_kewenangan','left');
		$this->db->join('kol_sifat_kewenangan kf', 'kf.id_sifat_kewenangan=krw.id_sifat_kewenangan','left');

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
	    $this->db->from('s_logbook lp');
		$this->db->join('s_pegawai peg', 'peg.id_pegawai=lp.id_logbooker','left');
		$this->db->join('ol_kewenangan krw', 'krw.id_kewenangan=lp.id_kewenangan','left');
		$this->db->join('kol_kode_kewenangan kw', 'kw.id_kode_kewenangan=krw.id_kode_kewenangan','left');
		$this->db->join('kol_sifat_kewenangan kf', 'kf.id_sifat_kewenangan=krw.id_sifat_kewenangan','left');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
 /*		$kondisi=array('id_logbooker'=>$this->session->id_pegawai);
		$jml = $this->m_umum->jumlah_record_filter('s_logbook',$kondisi);	 */
		$jml = $this->m_umum->jumlah_record_tabel('s_logbook');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function opsi_logbook($ruangan,$jabatan_fungsional,$opsi,$idkw){
			if($opsi == 1){
				$this->db->join('ol_kewenangan_bk okbk', 'okbk.id_kewenangan=ok.id_kewenangan','left');
				$this->db->join('butir_kegiatan bk', 'bk.id_butir_kegiatan=okbk.id_butir_kegiatan','left');
				$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=bk.id_jabatan_fungsional','left');
				$this->db->where('bk.id_jabatan_fungsional', $jabatan_fungsional);
			//	$this->db->where('jf.id_jabatan', $this->session->id_jabatan);
				$q = $this->db->get_where('ol_kewenangan ok');
			}else{
				if($ruangan == 0){
						$this->db->join('ol_kewenangan ok', 'ok.id_kewenangan=okd.id_kewenangan','left');
					$this->db->join('ol_kompetensi okm', 'okm.id_kompetensi=ok.id_kompetensi','left');
					$this->db->join('jabatan', 'jabatan.id_jabatan=okm.id_jabatan','left');
					$this->db->join('kol_kode_kewenangan kkw', 'kkw.id_kode_kewenangan=ok.id_kode_kewenangan','left');
					$this->db->join('kol_sifat_kewenangan ksk', 'ksk.id_sifat_kewenangan=ok.id_sifat_kewenangan','left');
					$this->db->where('ok.id_kode_kewenangan', $idkw);
				//	$this->db->where('okd.id_ruangan', $ruangan);
				//	$this->db->where('okm.id_jabatan', $this->session->id_jabatan);
					$q = $this->db->get_where('ol_kewenangan_detil okd');			
				}else{
					$this->db->join('ol_kewenangan ok', 'ok.id_kewenangan=okd.id_kewenangan','left');
					$this->db->join('ol_kompetensi okm', 'okm.id_kompetensi=ok.id_kompetensi','left');
					$this->db->join('jabatan', 'jabatan.id_jabatan=okm.id_jabatan','left');
					$this->db->join('kol_kode_kewenangan kkw', 'kkw.id_kode_kewenangan=ok.id_kode_kewenangan','left');
					$this->db->join('kol_sifat_kewenangan ksk', 'ksk.id_sifat_kewenangan=ok.id_sifat_kewenangan','left');
					$this->db->where('ok.id_kode_kewenangan', $idkw);
					$this->db->where('okd.id_ruangan', $ruangan);
				//	$this->db->where('okm.id_jabatan', $this->session->id_jabatan);
					$q = $this->db->get_where('ol_kewenangan_detil okd');	
				}	
			}				
			return $q->result_array();
	}
	function kewenangan_all()
	{
		$q = $this->db->get('ol_kewenangan');
		//print_r($q->row_array());
		return $q->result_array();
	}
	function cmd_ruangan(){
		$this->db->select('nama_ruangan,id_ruangan');
		$q = $this->db->get_where('ol_ruangan',array('status_ruangan'=>'1'));
		return $q->result_array();
	}
	function ambil_data_dropdown_jabfung_all(){
		$this->db->select("id_jabatan_fungsional,nama_jabatan_fungsional");
		$q = $this->db->get_where('jabatan_fungsional',array('id_jabatan'=>1))->result_array();
		$hasil= array_column($q,'nama_jabatan_fungsional','id_jabatan_fungsional');
		return $hasil;
	}
	function kol_kode_kewenangan_null_pk(){
		$this->db->select("id_kode_kewenangan, concat(nama_kode_kewenangan,' - ',jenjang_karir) as nama_kode_kewenangan");
		$q = $this->db->get_where('kol_kode_kewenangan',array('status_kode_kewenangan'=>'1'))->result_array();
		$hasil= array_column($q,'nama_kode_kewenangan','id_kode_kewenangan');
		return $hasil;
	}
	function jumlah_record_logbook($id_kewenangan)
    {
    		$this->db->join('s_logbook', 's_logbook.id_logbook=s_logbook_validasi.id_logbook','left');
			$this->db->where('id_logbooker', $this->session->id_pegawai);
			$this->db->where('validasi', '2');
			$this->db->where('id_kewenangan', $id_kewenangan);
/*			$this->db->group_start();
			$this->db->where('v_karu', '2');
			$this->db->or_where('v_kabid', '2');
			$this->db->or_where('v_asesor', '2');
			$this->db->or_where('v_komite', '2');
			$this->db->or_where('v_direktur', '2');
			$this->db->group_end();*/
        $query = $this->db->select("COUNT(*) as num")->get_where('s_logbook_validasi');
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
    }
	function pengajuan_kompetensi_all()
	{
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
	//	$this->db->where("b.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('s_pengajuan b');
		$this->db->join('ol_status_diusulkan su', 'su.id_status_diusulkan=b.id_status_diusulkan','left');
		$this->db->join('s_pegawai peg', 'peg.id_pegawai=b.id_pegawai','left');
		$this->db->join('s_working kw', 'kw.id_working=b.id_instansi','left');
	//	$this->db->where("b.id_pegawai", $this->session->id_pegawai);

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
	//	$this->db->where("b.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('s_pengajuan b');
		$this->db->join('ol_status_diusulkan su', 'su.id_status_diusulkan=b.id_status_diusulkan','left');
		$this->db->join('s_pegawai peg', 'peg.id_pegawai=b.id_pegawai','left');
		$this->db->join('s_working kw', 'kw.id_working=b.id_instansi','left');
/*		$names = array('0', $this->session->id_jabatan);
		$this->db->where_in('su.id_jabatan', $names);*/
	//	$this->db->where("b.id_pegawai", $this->session->id_pegawai);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99');
		$jml = $this->m_umum->jumlah_record_filter('pegawai',$kondisi);	 */
		$jml = $this->m_umum->jumlah_record_tabel('s_pengajuan');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function ambil_id_berkas_data(){
		$q = $this->db->get_where('s_berkas');
		return $q->result_array();
	}
	function ambil_id_berkas_data_idp($id){
		$q = $this->db->get_where('s_berkas',array('id_pegawai'=>$id));
		return $q->result_array();
	}
	function ambil_pengajuan_kompetensi($id){
		$this->db->select("*,if (jk = '1' ,'Laki-laki','Perempuan') as jk,
							CONCAT((TIMESTAMPDIFF( YEAR, tgl_lahir, now() )), ' Tahun ', 
							TIMESTAMPDIFF( MONTH, tgl_lahir, now() ) % 12, ' Bulan ',
							FLOOR( TIMESTAMPDIFF( DAY, tgl_lahir, now() ) % 30.4375 ), ' Hari') as umur
		");
		$this->db->join('ol_status_diusulkan', 'ol_status_diusulkan.id_status_diusulkan=s_pengajuan.id_status_diusulkan','left');
		$this->db->join('s_pegawai p', 'p.id_pegawai=s_pengajuan.id_pegawai','left');
		$this->db->join('kol_agama ag', 'ag.id_agama=p.id_agama','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=p.id_status_kawin','left');
		$this->db->join('kol_pendidikan pend', 'pend.id_pendidikan=p.id_pendidikan','left');
		$this->db->join('ol_status_pegawai ksp', 'ksp.id_status_pegawai=p.tipe_pegawai','left');
		$this->db->join('s_working u', 'u.id_working=s_pengajuan.id_instansi','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=p.id_jabatan_fungsional','left');
		$q = $this->db->get_where('s_pengajuan',array('barcode_pengajuan'=>$id));
		return $q->row_array();
	}
	function ambil_data_etik_pegawai_oppe()
	{
		$this->db->join('s_pegawai peg', 'peg.id_pegawai=kep.id_penguji','left');
	//	$this->db->where("kep.id_pegawai", $id_pegawai);
	//	$this->db->where('year(tgl_etik_pegawai)', $tahun);
		$q = $this->db->get_where('s_etik_pegawai kep')->result_array();
	//	print_r($q);die();
		return $q;
    }
	function ambil_data_etik_pegawai_oppe_idp($id_pegawai,$tahun)
	{
		$this->db->join('s_pegawai peg', 'peg.id_pegawai=kep.id_penguji','left');
		$this->db->where("kep.id_pegawai", $id_pegawai);
	//	$this->db->where('year(tgl_etik_pegawai)', $tahun);
		$q = $this->db->get_where('s_etik_pegawai kep')->result_array();
	//	print_r($q);die();
		return $q;
    }
	function ambil_lobook_validasi_group_pengajuan($id){
	//  $this->db->select("COUNT(*) as num, nama_kewenangan,validasi,result_tolak,ol.id_kewenangan,nama_pegawai,nama_ms_struktur");
	  $this->db->join('s_logbook ol', 'ol.id_logbook=olv.id_logbook','left');
	  $this->db->join('ol_kewenangan kk', 'kk.id_kewenangan=ol.id_kewenangan','left');
	  $this->db->join('s_pegawai_struktur ops', 'ops.id_pegawai_struktur=olv.id_pegawai_struktur','left');
	  $this->db->join('s_pegawai peg', 'peg.id_pegawai=ops.id_pegawai','left');
	  $this->db->join('s_struktur os', 'os.id_struktur=ops.id_struktur','left');
	  $this->db->join('s_ms_struktur kms', 'kms.id_ms_struktur=os.id_ms_struktur','left');
	//  $this->db->group_by('ol.id_kewenangan');
	//  $this->db->group_by('olv.id_pegawai_struktur');
	  $this->db->order_by('olv.id_logbook_validasi','asc');
	  $q = $this->db->get_where('s_logbook_validasi olv',array('id_pengajuan'=>$id));
	  return $q->result_array();
	}
	function tabel_logbook($id)
	{
		$apk = $this->m_umum->ambil_data('s_pengajuan','barcode_pengajuan',$id); //barcode
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
	//	$this->db->where("b.id_logbooker", $this->session->id_pegawai);
		$this->db->where("b.id_pengajuan", $apk['id_pengajuan']);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('s_logbook b');
		$this->db->join('s_working kow', 'kow.id_working=b.id_instansi','left');
		$this->db->join('s_pegawai p', 'p.id_pegawai=b.id_logbooker','left');
		$this->db->join('ol_kewenangan ok', 'ok.id_kewenangan=b.id_kewenangan','left');
		$this->db->join('ol_kompetensi okm', 'okm.id_kompetensi=ok.id_kompetensi','left');
		$this->db->join('kol_kode_kewenangan', 'kol_kode_kewenangan.id_kode_kewenangan=ok.id_kode_kewenangan','left');
	//	$this->db->where("b.id_logbooker", $this->session->id_pegawai);
		$this->db->where("b.id_pengajuan", $apk['id_pengajuan']);

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
	//	$this->db->where("b.id_logbooker", $this->session->id_pegawai);
			$this->db->where("b.id_pengajuan", $apk['id_pengajuan']);
			}
		  }
		}

		$this->db->from('s_logbook b');
		$this->db->join('s_working kow', 'kow.id_working=b.id_instansi','left');
		$this->db->join('s_pegawai p', 'p.id_pegawai=b.id_logbooker','left');
		$this->db->join('ol_kewenangan ok', 'ok.id_kewenangan=b.id_kewenangan','left');
		$this->db->join('ol_kompetensi okm', 'okm.id_kompetensi=ok.id_kompetensi','left');
		$this->db->join('kol_kode_kewenangan', 'kol_kode_kewenangan.id_kode_kewenangan=ok.id_kode_kewenangan','left');
	//	$this->db->where("b.id_logbooker", $this->session->id_pegawai);
		$this->db->where("b.id_pengajuan", $apk['id_pengajuan']);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99');
		$jml = $this->m_umum->jumlah_record_filter('pegawai',$kondisi);	 */
		$jml = $this->m_umum->jumlah_record_tabel('s_logbook');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function logbook_pengajuan()
	{
		$this->db->select("*,DATE_FORMAT(lp.tgl_logbook,'%d-%m-%Y') as tgl_logbook");
		$this->db->join('ol_kewenangan krw', 'krw.id_kewenangan=lp.id_kewenangan','left');
		$this->db->join('kol_kode_kewenangan kw', 'kw.id_kode_kewenangan=krw.id_kode_kewenangan','left');
	//	$this->db->where("lp.id_logbooker", $this->session->id_pegawai);
	//	$this->db->where("lp.id_pengajuan", 0);
		$this->db->where("lp.mandiri", 1);
	//	$this->db->where('lp.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$q = $this->db->get('s_logbook lp');
		return $q->result_array();
	}
	function berkas_ijasah_all()
	{
		$fields = "*
		";
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));
		$order = $this->input->post('order');
		$cari = $this->input->post('search');
		$col =$order[0]['column'];
		$dir= $order[0]['dir'];
		$dt_kolom=$this->input->post('columns');
		$this->db->select($fields);  
		if(!empty($cari['value'])) {    
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ 
				switch($k['data']){		
				//	 case 'no_hp' : $nmf="peg.no_hp";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where("b.id_kategori_berkas", 7);
	//	$this->db->where("b.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir); 
	    $this->db->from('s_berkas b');
		$this->db->join('kol_pendidikan kp', 'kp.id_pendidikan=b.id_pendidikan','left');
		$this->db->where("b.id_kategori_berkas", 7);//	$this->db->where("b.id_pegawai", $this->session->id_pegawai);
		$q = $this->db->limit($length,$start)->get_where(); 
		$list=$q->result_array(); //06 Hasil
		$this->db->select("COUNT(*) as num");	
		if(!empty($cari['value'])) {    
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ 
				switch($k['data']){		
				//	case 'no_hp' : $nmf="peg.no_hp";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where("b.id_kategori_berkas", 7);
	//	$this->db->where("b.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}
	    $this->db->from('s_berkas b');
		$this->db->join('kol_pendidikan kp', 'kp.id_pendidikan=b.id_pendidikan','left');
		$this->db->where("b.id_kategori_berkas", 7);//	$this->db->where("b.id_pegawai", $this->session->id_pegawai);
		$q = $this->db->get_where();
		$jml_filter = $q->row()->num;
 		$kondisi=array('s_berkas_kategori.id_kategori_berkas'=>7, 's_berkas.id_pegawai'=>$this->session->id_pegawai);
		$jml = $this->m_umum->jumlah_record_tabel_pengajuan('s_berkas',$kondisi,'s_berkas_kategori','id_kategori_berkas');	
	//	$jml = $this->m_umum->jumlah_record_tabel('berkas');
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function berkas_pelatihan_all()
	{
		$fields = "*,
					if (b.tgl_a_berkas = '0000-00-00' ,'TIDAK ADA',if (b.tgl_a_berkas = NULL ,'TIDAK ADA',DATE_FORMAT(b.tgl_a_berkas,'%d-%m-%Y'))) as tgl_a_berkas,
					if (b.tgl_b_berkas = '0000-00-00' ,'TIDAK ADA',if (b.tgl_b_berkas = NULL ,'TIDAK ADA',DATE_FORMAT(b.tgl_b_berkas,'%d-%m-%Y'))) as tgl_b_berkas
		";
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));
		$order = $this->input->post('order');
		$cari = $this->input->post('search');
		$col =$order[0]['column'];
		$dir= $order[0]['dir'];
		$dt_kolom=$this->input->post('columns');
		$this->db->select($fields);  
		if(!empty($cari['value'])) {    
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ 
				switch($k['data']){		
				//	 case 'no_hp' : $nmf="peg.no_hp";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where("kunci", 1);
	//	$this->db->where("b.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir); 
	    $this->db->from('s_berkas b');
		$this->db->join('s_berkas_kategori kb', 'kb.id_kategori_berkas=b.id_kategori_berkas','left');
		$this->db->join('ol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=b.id_kategori_pelatihan','left');
		$this->db->where("kunci", 1);//	$this->db->where("b.id_pegawai", $this->session->id_pegawai);
		$q = $this->db->limit($length,$start)->get_where(); 
		$list=$q->result_array(); //06 Hasil
		$this->db->select("COUNT(*) as num");	
		if(!empty($cari['value'])) {    
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ 
				switch($k['data']){		
				//	case 'no_hp' : $nmf="peg.no_hp";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where("kunci", 1);
	//	$this->db->where("b.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}
	    $this->db->from('s_berkas b');
		$this->db->join('s_berkas_kategori kb', 'kb.id_kategori_berkas=b.id_kategori_berkas','left');
		$this->db->join('ol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=b.id_kategori_pelatihan','left');
		$this->db->where("kunci", 1);//	$this->db->where("b.id_pegawai", $this->session->id_pegawai);
		$q = $this->db->get_where();
		$jml_filter = $q->row()->num;
 		$kondisi=array('s_berkas_kategori.kunci'=>1, 's_berkas.id_pegawai'=>$this->session->id_pegawai);
		$jml = $this->m_umum->jumlah_record_tabel_pengajuan('s_berkas',$kondisi,'s_berkas_kategori','id_kategori_berkas');	
	//	$jml = $this->m_umum->jumlah_record_tabel('berkas');
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function berkas_str_all()
	{
		$fields = "*,
					if (b.tgl_a_berkas = '0000-00-00' ,'TIDAK ADA',if (b.tgl_a_berkas = NULL ,'TIDAK ADA',DATE_FORMAT(b.tgl_a_berkas,'%d-%m-%Y'))) as tgl_a_berkas,
					if (b.tgl_b_berkas = '0000-00-00' ,'TIDAK ADA',if (b.tgl_b_berkas = NULL ,'TIDAK ADA',DATE_FORMAT(b.tgl_b_berkas,'%d-%m-%Y'))) as tgl_b_berkas
		";
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));
		$order = $this->input->post('order');
		$cari = $this->input->post('search');
		$col =$order[0]['column'];
		$dir= $order[0]['dir'];
		$dt_kolom=$this->input->post('columns');
		$this->db->select($fields);  
		if(!empty($cari['value'])) {    
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ 
				switch($k['data']){		
				//	 case 'no_hp' : $nmf="peg.no_hp";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where("kunci", 0);
				$this->db->where("status_berkas", 1);
	//	$this->db->where("b.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir); 
	    $this->db->from('s_berkas b');
		$this->db->join('s_berkas_kategori kb', 'kb.id_kategori_berkas=b.id_kategori_berkas','left');
		$this->db->join('ol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=b.id_kategori_pelatihan','left');
		$this->db->where("kunci", 0);
		$this->db->where("status_berkas", 1);//	$this->db->where("b.id_pegawai", $this->session->id_pegawai);
		$q = $this->db->limit($length,$start)->get_where(); 
		$list=$q->result_array(); //06 Hasil
		$this->db->select("COUNT(*) as num");	
		if(!empty($cari['value'])) {    
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ 
				switch($k['data']){		
				//	case 'no_hp' : $nmf="peg.no_hp";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where("kunci", 0);
				$this->db->where("status_berkas", 1);
	//	$this->db->where("b.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}
	    $this->db->from('s_berkas b');
		$this->db->join('s_berkas_kategori kb', 'kb.id_kategori_berkas=b.id_kategori_berkas','left');
		$this->db->join('ol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=b.id_kategori_pelatihan','left');
		$this->db->where("kunci", 0);
		$this->db->where("status_berkas", 1);//	$this->db->where("b.id_pegawai", $this->session->id_pegawai);
		$q = $this->db->get_where();
		$jml_filter = $q->row()->num;
 		$kondisi=array('s_berkas_kategori.kunci'=>0, 's_berkas.id_pegawai'=>$this->session->id_pegawai);
		$jml = $this->m_umum->jumlah_record_tabel_pengajuan('s_berkas',$kondisi,'s_berkas_kategori','id_kategori_berkas');	
	//	$jml = $this->m_umum->jumlah_record_tabel('berkas');
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function berkas_pribadi_all()
	{
		$fields = "*";
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));
		$order = $this->input->post('order');
		$cari = $this->input->post('search');
		$col =$order[0]['column'];
		$dir= $order[0]['dir'];
		$dt_kolom=$this->input->post('columns');
		$this->db->select($fields);  
		if(!empty($cari['value'])) {    
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ 
				switch($k['data']){		
				//	 case 'no_hp' : $nmf="peg.no_hp";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where("b.id_kategori_berkas >", 11);
	//	$this->db->where("b.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir); 
	    $this->db->from('s_berkas b');
		$this->db->join('s_berkas_kategori kb', 'kb.id_kategori_berkas=b.id_kategori_berkas','left');
		$this->db->where("b.id_kategori_berkas >", 11);//	$this->db->where("b.id_pegawai", $this->session->id_pegawai);
		$q = $this->db->limit($length,$start)->get_where(); 
		$list=$q->result_array(); //06 Hasil
		$this->db->select("COUNT(*) as num");	
		if(!empty($cari['value'])) {    
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ 
				switch($k['data']){		
				//	case 'no_hp' : $nmf="peg.no_hp";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where("b.id_kategori_berkas >", 11);
	//	$this->db->where("b.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}
	    $this->db->from('s_berkas b');
		$this->db->join('s_berkas_kategori kb', 'kb.id_kategori_berkas=b.id_kategori_berkas','left');
		$this->db->where("b.id_kategori_berkas >", 11);//	$this->db->where("b.id_pegawai", $this->session->id_pegawai);
		$q = $this->db->get_where();
		$jml_filter = $q->row()->num;
 		$kondisi=array('s_berkas_kategori.id_kategori_berkas >'=>11, 's_berkas.id_pegawai'=>$this->session->id_pegawai);
		$jml = $this->m_umum->jumlah_record_tabel_pengajuan('s_berkas',$kondisi,'s_berkas_kategori','id_kategori_berkas');	
	//	$jml = $this->m_umum->jumlah_record_tabel('berkas');
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function etik_pegawai_all()
	{
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,
					DATE_FORMAT(tgl_etik_pegawai,'%d-%m-%Y') as tgl_etik_pegawai
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
		$this->db->where("s_etik_pegawai.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('s_etik_pegawai');
		$this->db->join('s_pegawai peg', 'peg.id_pegawai=s_etik_pegawai.id_penguji','left');
		$this->db->where("s_etik_pegawai.id_pegawai", $this->session->id_pegawai);

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
		$this->db->where("s_etik_pegawai.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('s_etik_pegawai');
		$this->db->join('s_pegawai peg', 'peg.id_pegawai=s_etik_pegawai.id_penguji','left');
		$this->db->where("s_etik_pegawai.id_pegawai", $this->session->id_pegawai);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
 		$kondisi=array('id_pegawai'=> $this->session->id_pegawai);
		$jml = $this->m_umum->jumlah_record_filter('s_etik_pegawai',$kondisi);	
//		$jml = $this->m_umum->jumlah_record_tabel('kr_etik_pegawai');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function kpengajuan_kompetensi_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,if(tgl_pengajuan = '' ,'Belum Ada Tanggal',DATE_FORMAT(tgl_pengajuan,'%d-%m-%Y')) as tgl_pengajuan
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
				//	 case 'nama_pengcab' : $nmf="op.nama_pengcab";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
//		$this->db->where_in('ok.id_instansi',$ids);
		$this->db->where('ok.status_pengajuan >', 0);				
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('s_pengajuan ok');
		$this->db->join('kol_status_diusulkan okk', 'okk.id_status_diusulkan=ok.id_status_diusulkan','left');
		$this->db->join('s_pegawai op', 'op.id_pegawai=ok.id_pegawai','left');
		$this->db->join('s_working kw', 'kw.id_working=ok.id_instansi','left');
//		$this->db->where_in('ok.id_instansi',$ids);
		$this->db->where('ok.status_pengajuan >', 0);

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'nama_pengcab' : $nmf="op.nama_pengcab";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
	//	$this->db->where_in('ok.id_instansi',$ids);
		$this->db->where('ok.status_pengajuan >', 0);
			}
		  }
		}

		$this->db->from('s_pengajuan ok');
		$this->db->join('kol_status_diusulkan okk', 'okk.id_status_diusulkan=ok.id_status_diusulkan','left');
		$this->db->join('s_pegawai op', 'op.id_pegawai=ok.id_pegawai','left');
		$this->db->join('s_working kw', 'kw.id_working=ok.id_instansi','left');
	//	$this->db->where_in('ok.id_instansi',$ids);
		$this->db->where('ok.status_pengajuan >', 0);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/*		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){*/
/*		 		$kondisi=array('id_pengirim'=>$this->session->id_pegawai);
				$jml = $this->m_umum->jumlah_record_filter('ol_korespodensi',$kondisi);*/
/*			}else{
				$jml = $this->m_umum->jumlah_record_tabel('ol_surat');
			}
		}else{
			$jml = $this->m_umum->jumlah_record_tabel('ol_surat');
		}*/		
		$jml = $this->m_umum->jumlah_record_tabel('s_pengajuan');
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function seting_validator_kompetensi($pengajuan)
	{
		$dtpengajuan = $this->m_umum->ambil_data('s_pengajuan','barcode_pengajuan',$pengajuan);
		$fields = "*,kms.nama_ms_struktur as nama_ms_struktur,kms2.nama_ms_struktur as nms
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
				default: $nmf=$k['data'];
				}
		$this->db->where('opv.id_pengajuan', $dtpengajuan['id_pengajuan']);			
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('s_pengajuan_validasi opv');
		$this->db->join('s_pengajuan opg', 'opg.id_pengajuan=opv.id_pengajuan','left');
		$this->db->join('s_ms_struktur kms', 'kms.id_ms_struktur=opv.plan_pengajuan_validasi','left');
		$this->db->join('s_pegawai_struktur ops', 'ops.id_pegawai_struktur=opv.id_pegawai_struktur','left');
		$this->db->join('s_pegawai op', 'op.id_pegawai=ops.id_pegawai','left');
		$this->db->join('s_struktur os', 'os.id_struktur=ops.id_struktur','left');
		$this->db->join('s_ms_struktur kms2', 'kms2.id_ms_struktur=os.id_ms_struktur','left');
		$this->db->join('s_working kw', 'kw.id_working=os.id_instansi','left');
		$this->db->where('opv.id_pengajuan', $dtpengajuan['id_pengajuan']);

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'nama_pengcab' : $nmf="op.nama_pengcab";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('opv.id_pengajuan', $dtpengajuan['id_pengajuan']);
			}
		  }
		}

		$this->db->from('s_pengajuan_validasi opv');
		$this->db->join('s_pengajuan opg', 'opg.id_pengajuan=opv.id_pengajuan','left');
		$this->db->join('s_ms_struktur kms', 'kms.id_ms_struktur=opv.plan_pengajuan_validasi','left');
		$this->db->join('s_pegawai_struktur ops', 'ops.id_pegawai_struktur=opv.id_pegawai_struktur','left');
		$this->db->join('s_pegawai op', 'op.id_pegawai=ops.id_pegawai','left');
		$this->db->join('s_struktur os', 'os.id_struktur=ops.id_struktur','left');
		$this->db->join('s_ms_struktur kms2', 'kms2.id_ms_struktur=os.id_ms_struktur','left');
		$this->db->join('s_working kw', 'kw.id_working=os.id_instansi','left');
		$this->db->where('opv.id_pengajuan', $dtpengajuan['id_pengajuan']);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/*		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){*/
/*		 		$kondisi=array('id_pengirim'=>$this->session->id_pegawai);
				$jml = $this->m_umum->jumlah_record_filter('s_pengajuan_validasi',$kondisi);*/
/*			}else{
				$jml = $this->m_umum->jumlah_record_tabel('ol_surat');
			}
		}else{
			$jml = $this->m_umum->jumlah_record_tabel('ol_surat');
		}*/		
		$kondisi=array('id_pengajuan'=>$dtpengajuan['id_pengajuan']);
		$jml = $this->m_umum->jumlah_record_filter('s_pengajuan_validasi',$kondisi);
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function pegawai_struktur_kompetensi($id,$id2)
	{
		$ids = explode(',', $this->session->list_instansi);
		$pengval = $this->m_umum->ambil_data('s_pengajuan_validasi','barcode_pengajuan_validasi',$id);
		$fields = "*,if(s_pegawai.id_kode_kewenangan = '0','NON PERAWAT',nama_kode_kewenangan) as nama_kode_kewenangan
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
				//	 case 'nama_pengcab' : $nmf="op.nama_pengcab";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		if(empty($id2)){
	//		$this->db->where_in('id_working',$ids);
		}else{
			$this->db->where('barcode_working',$id2);
		}			
		$this->db->where('s_struktur.id_ms_struktur',$pengval['plan_pengajuan_validasi']);
		$this->db->where("s_struktur.id_ms_struktur >", 1);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('s_pegawai_struktur');
		$this->db->join('s_struktur', 's_struktur.id_struktur=s_pegawai_struktur.id_struktur','left');
		$this->db->join('s_pegawai', 's_pegawai.id_pegawai=s_pegawai_struktur.id_pegawai','left');
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=s_pegawai.id_jabatan_fungsional','left');
		$this->db->join('kol_kode_kewenangan', 'kol_kode_kewenangan.id_kode_kewenangan=s_pegawai.id_kode_kewenangan','left');
		$this->db->join('s_ms_struktur', 's_ms_struktur.id_ms_struktur=s_struktur.id_ms_struktur','left');
		$this->db->join('s_working', 's_working.id_working=s_struktur.id_instansi','left');
		if(empty($id2)){
	//		$this->db->where_in('id_working',$ids);
		}else{
			$this->db->where('barcode_working',$id2);
		}			
		$this->db->where('s_struktur.id_ms_struktur',$pengval['plan_pengajuan_validasi']);
		$this->db->where("s_struktur.id_ms_struktur >", 1);

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
//case 'nama_pengcab' : $nmf="op.nama_pengcab";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		if(empty($id2)){
	//		$this->db->where_in('id_working',$ids);
		}else{
			$this->db->where('barcode_working',$id2);
		}			
		$this->db->where('s_struktur.id_ms_struktur',$pengval['plan_pengajuan_validasi']);
		$this->db->where("s_struktur.id_ms_struktur >", 1);
			}
		  }
		}

		$this->db->from('s_pegawai_struktur');
		$this->db->join('s_struktur', 's_struktur.id_struktur=s_pegawai_struktur.id_struktur','left');
		$this->db->join('s_pegawai', 's_pegawai.id_pegawai=s_pegawai_struktur.id_pegawai','left');
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=s_pegawai.id_jabatan_fungsional','left');
		$this->db->join('kol_kode_kewenangan', 'kol_kode_kewenangan.id_kode_kewenangan=s_pegawai.id_kode_kewenangan','left');
		$this->db->join('s_ms_struktur', 's_ms_struktur.id_ms_struktur=s_struktur.id_ms_struktur','left');
		$this->db->join('s_working', 's_working.id_working=s_struktur.id_instansi','left');
		if(empty($id2)){
	//		$this->db->where_in('id_working',$ids);
		}else{
			$this->db->where('barcode_working',$id2);
		}			
		$this->db->where('s_struktur.id_ms_struktur',$pengval['plan_pengajuan_validasi']);
		$this->db->where("s_struktur.id_ms_struktur >", 1);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
//		if($id == 0){
	 	//	$kondisi=array('id_jabatan'=>$this->session->id_jabatan);
		//	$jml = $this->jumlah_akses_pengurus($id,$eimplo);
/*		}else{*/
			$jml = $this->m_umum->jumlah_record_tabel('s_pegawai_struktur');	
//		}
		

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function ambil_data_instansi_all()
	{
		$this->db->select("nama_working,barcode_working");
		$this->db->join('s_working kw', 'kw.id_working=pi.id_instansi','left');
	    $this->db->group_by('pi.id_instansi'); 
		$q = $this->db->get_where('s_pegawai_instansi pi');
			return $q->result_array();
	}
	function ambil_struktur_lihat_pelatihan($id){
		$this->db->join('s_pegawai', 's_pegawai.id_pegawai=b.id_pegawai','left');
		$this->db->join('s_berkas_kategori kb', 'kb.id_kategori_berkas=b.id_kategori_berkas','left');
		$this->db->join('ol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=b.id_kategori_pelatihan','left');
		$this->db->where("kunci", 1);
		$this->db->where("b.id_pegawai", $id);
		$q = $this->db->get_where('s_berkas b');
		return $q->result_array();
	}
	function ambil_pengajuan_validasi($id){
		$this->db->select("*,if (jk = '1' ,'Laki-laki','Perempuan') as jk,
							CONCAT((TIMESTAMPDIFF( YEAR, tgl_lahir, now() )), ' Tahun ', 
							TIMESTAMPDIFF( MONTH, tgl_lahir, now() ) % 12, ' Bulan ',
							FLOOR( TIMESTAMPDIFF( DAY, tgl_lahir, now() ) % 30.4375 ), ' Hari') as umur
		");
		$this->db->join('s_pengajuan', 's_pengajuan.id_pengajuan=s_pengajuan_validasi.id_pengajuan','left');
		$this->db->join('ol_status_diusulkan', 'ol_status_diusulkan.id_status_diusulkan=s_pengajuan.id_status_diusulkan','left');
		$this->db->join('s_pegawai p', 'p.id_pegawai=s_pengajuan.id_pegawai','left');
		$this->db->join('kol_agama ag', 'ag.id_agama=p.id_agama','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=p.id_status_kawin','left');
		$this->db->join('kol_pendidikan pend', 'pend.id_pendidikan=p.id_pendidikan','left');
		$this->db->join('ol_status_pegawai ksp', 'ksp.id_status_pegawai=p.tipe_pegawai','left');
		$this->db->join('s_working u', 'u.id_working=s_pengajuan.id_instansi','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=p.id_jabatan_fungsional','left');
		$q = $this->db->get_where('s_pengajuan_validasi',array('barcode_pengajuan_validasi'=>$id));
		return $q->row_array();
	}
	function ambil_lobook_kompetensi_group_pengajuan($id){
	  $this->db->select("COUNT(*) as num, nama_kewenangan");
	  $this->db->join('ol_kewenangan kk', 'kk.id_kewenangan=ol.id_kewenangan','left');
	  $this->db->group_by('ol.id_kewenangan');
	  $q = $this->db->get_where('s_logbook ol',array('id_pengajuan'=>$id));
	  return $q->result_array();
	}
	function logbook_null($pengajuan,$pegstr)
	{
		$dtpengajuan = $this->m_umum->ambil_data('s_pengajuan','barcode_pengajuan',$pengajuan);
		$dtpegstr = $this->m_umum->ambil_data('s_pegawai_struktur','barcode_pegawai_struktur',$pegstr);
		$fields = "*,ol.id_logbook
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
	// $this->db->query('SELECT column_name(s) FROM table_name1 UNION SELECT column_name(s) FROM table_name2');
	// $query = 'select * from etudiant where NOT EXISTS (select * from etudiant where matricule ='.$new_matricule.') ';
	//	$this->db->query($fields);
		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan [coding here]
				default: $nmf=$k['data'];
				}
	//	$this->db->where('olv.id_pegawai_struktur IS NULL', null, false);
		$this->db->where("not exists (select null from ol_logbook_validasi  olv where olv.id_logbook = ol.id_logbook AND olv.id_pegawai_struktur = ('". $dtpegstr['id_pegawai_struktur']. "'))",null,false);
		$this->db->where('ol.id_pengajuan', $dtpengajuan['id_pengajuan']);
		$this->db->where('ol.tolak',0);
	//	$this->db->where_not_in('olv.id_pegawai_struktur', $dtpegstr['id_ms_struktur']);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

/*
SELECT * FROM ol_logbook ol
WHERE NOT EXISTS (SELECT * FROM ol_logbook_validasi olv WHERE olv.`id_logbook`=ol.`id_logbook`)
*/
		$this->db->from('s_logbook ol');
	//	$this->db->join('ol_logbook_validasi olv', 'ol.id_logbook = olv.id_logbook', 'left outer');
		$this->db->join('ol_kewenangan ok', 'ok.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('s_working kw', 'kw.id_working=ol.id_instansi','left');
		$this->db->join('s_pegawai op', 'op.id_pegawai=ol.id_logbooker','left');
	//	$this->db->where('olv.id_pegawai_struktur IS NULL', null, false);
		$this->db->where("not exists (select 1 from s_logbook_validasi  olv where olv.id_logbook = ol.id_logbook AND olv.id_pegawai_struktur = '". $dtpegstr['id_pegawai_struktur']. "')",null,false);
		$this->db->where('ol.id_pengajuan', $dtpengajuan['id_pengajuan']);
		$this->db->where('ol.tolak',0);
	//	$this->db->where_not_in('olv.id_pegawai_struktur', $dtpegstr['id_ms_struktur']);

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'nama_pengcab' : $nmf="op.nama_pengcab";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
	//	$this->db->where('olv.id_pegawai_struktur IS NULL', null, false);
		$this->db->where("not exists (select 1 from ol_logbook_validasi  olv where olv.id_logbook = ol.id_logbook AND olv.id_pegawai_struktur = '". $dtpegstr['id_pegawai_struktur']. "')",null,false);
		$this->db->where('ol.id_pengajuan', $dtpengajuan['id_pengajuan']);
		$this->db->where('ol.tolak',0);
	//	$this->db->where_not_in('olv.id_pegawai_struktur', $dtpegstr['id_ms_struktur']);
			}
		  }
		}

		$this->db->from('s_logbook ol');
	//	$this->db->join('ol_logbook_validasi olv', 'ol.id_logbook = olv.id_logbook', 'left outer');
		$this->db->join('ol_kewenangan ok', 'ok.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('s_working kw', 'kw.id_working=ol.id_instansi','left');
		$this->db->join('s_pegawai op', 'op.id_pegawai=ol.id_logbooker','left');
	//	$this->db->where('olv.id_pegawai_struktur IS NULL', null, false);
		$this->db->where("not exists (select 1 from s_logbook_validasi  olv where olv.id_logbook = ol.id_logbook AND olv.id_pegawai_struktur = '". $dtpegstr['id_pegawai_struktur']. "')",null,false);
		$this->db->where('ol.id_pengajuan', $dtpengajuan['id_pengajuan']);
		$this->db->where('ol.tolak',0);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/*		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){*/
/*		 		$kondisi=array('id_pengirim'=>$this->session->id_pegawai);
				$jml = $this->m_umum->jumlah_record_filter('s_pengajuan_validasi',$kondisi);*/
/*			}else{
				$jml = $this->m_umum->jumlah_record_tabel('ol_surat');
			}
		}else{
			$jml = $this->m_umum->jumlah_record_tabel('ol_surat');
		}*/		
		$kondisi=array('id_pengajuan'=>$dtpengajuan['id_pengajuan']);
		$jml = $this->m_umum->jumlah_record_filter('s_logbook',$kondisi);
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function ambil_logbook_pegawai($id){
		$q = $this->db->get_where('s_logbook lp',array('lp.id_logbook'=>$id));
		return $q->row_array();
	}
	function pengajuan_kompetensi_spk_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,if(tgl_pengajuan = '' ,'Belum Ada Tanggal',DATE_FORMAT(tgl_pengajuan,'%d-%m-%Y')) as tgl_pengajuan
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
				//	 case 'nama_pengcab' : $nmf="op.nama_pengcab";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
	//	$this->db->where_in('ok.id_instansi',$ids);
		$this->db->where('ok.status_pengajuan >=', 2);
	//	$this->db->where('ops.id_pegawai', $this->session->id_pegawai);				
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('s_pengajuan_validasi opv');
		$this->db->join('s_pengajuan ok', 'ok.id_pengajuan=opv.id_pengajuan','left');
		$this->db->join('s_pegawai_struktur ops', 'ops.id_pegawai_struktur=opv.id_pegawai_struktur','left');
		$this->db->join('ol_status_diusulkan okk', 'okk.id_status_diusulkan=ok.id_status_diusulkan','left');
		$this->db->join('s_pegawai op', 'op.id_pegawai=ok.id_pegawai','left');
	//	$this->db->where_in('ok.id_instansi',$ids);
		$this->db->where('ok.status_pengajuan >=', 2);
	//	$this->db->where('ops.id_pegawai', $this->session->id_pegawai);
		$this->db->group_by('opv.id_pengajuan');

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'nama_pengcab' : $nmf="op.nama_pengcab";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
	//	$this->db->where_in('ok.id_instansi',$ids);
		$this->db->where('ok.status_pengajuan >=', 2);
	//	$this->db->where('ops.id_pegawai', $this->session->id_pegawai);
			}
		  }
		}

		$this->db->from('s_pengajuan_validasi opv');
		$this->db->join('s_pengajuan ok', 'ok.id_pengajuan=opv.id_pengajuan','left');
		$this->db->join('s_pegawai_struktur ops', 'ops.id_pegawai_struktur=opv.id_pegawai_struktur','left');
		$this->db->join('ol_status_diusulkan okk', 'okk.id_status_diusulkan=ok.id_status_diusulkan','left');
		$this->db->join('s_pegawai op', 'op.id_pegawai=ok.id_pegawai','left');
	//	$this->db->where_in('ok.id_instansi',$ids);
		$this->db->where('ok.status_pengajuan >=', 2);
	//	$this->db->where('ops.id_pegawai', $this->session->id_pegawai);
	//	$this->db->group_by('opv.id_pengajuan');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil
		if(empty($jml_filter)){
			$jml_filter = 0;
		}

	//--------- Query jumlah All data paling banyak -----
/*		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){*/
/*		 		$kondisi=array('id_pengirim'=>$this->session->id_pegawai);
				$jml = $this->m_umum->jumlah_record_filter('ol_korespodensi',$kondisi);*/
/*			}else{
				$jml = $this->m_umum->jumlah_record_tabel('ol_surat');
			}
		}else{
			$jml = $this->m_umum->jumlah_record_tabel('ol_surat');
		}*/		
		$jml = $this->m_umum->jumlah_record_tabel('s_pengajuan');
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function cmd_ambil_direktur($id){
		$ids = explode(',', $id);
		$this->db->select("id_direktur,nama_direktur");
	//	$this->db->where_in('id_instansi',$ids);
		$q = $this->db->get_where('s_direktur',array('status_direktur'=>'1'))->result_array();
		$hasil= array_column($q,'nama_direktur','id_direktur');
		return $hasil;
	}
	function ambil_pengajuan_kompetensi_spk($id){
		$this->db->join('ol_status_diusulkan', 'ol_status_diusulkan.id_status_diusulkan=s_pengajuan.id_status_diusulkan','left');
		$this->db->join('s_pegawai p', 'p.id_pegawai=s_pengajuan.id_pegawai','left');
		$this->db->join('kol_agama ag', 'ag.id_agama=p.id_agama','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=p.id_status_kawin','left');
		$this->db->join('kol_pendidikan pend', 'pend.id_pendidikan=p.id_pendidikan','left');
		$this->db->join('kol_status_pegawai ksp', 'ksp.id_status_pegawai=p.tipe_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=p.id_jabatan_fungsional','left');
		$this->db->join('s_working kw', 'kw.id_working=s_pengajuan.id_instansi','left');
		$q = $this->db->get_where('s_pengajuan',array('barcode_pengajuan'=>$id));
		return $q->row_array();
	}
	function ambil_kompetensi_spk($id){
		$this->db->join('s_logbook', 's_logbook.id_logbook=s_logbook_validasi.id_logbook','left');		
		$this->db->join('ol_kewenangan', 'ol_kewenangan.id_kewenangan=s_logbook.id_kewenangan','left');		
		$this->db->join('ol_kompetensi', 'ol_kompetensi.id_kompetensi=ol_kewenangan.id_kompetensi','left');		
		$this->db->where('id_logbooker',$id);
		$this->db->where('validasi', 1);
		$this->db->group_by('ol_kewenangan.id_kompetensi');
		$this->db->order_by('ol_kompetensi.nama_kompetensi','asc');
		$q = $this->db->get_where('s_logbook_validasi');
		return $q->result_array();		
	}
	function ambil_kewenangan_spk($id,$idk){
		$this->db->join('s_logbook', 's_logbook.id_logbook=s_logbook_validasi.id_logbook','left');
		$this->db->join('ol_kewenangan', 'ol_kewenangan.id_kewenangan=s_logbook.id_kewenangan','left');		
		$this->db->where('id_logbooker',$id);
		$this->db->where('ol_kewenangan.id_kompetensi',$idk);
		$this->db->where('validasi', 1);
		$this->db->group_by('s_logbook.id_kewenangan');
		$this->db->order_by('ol_kewenangan.nama_kewenangan','asc');
		$q = $this->db->get_where('s_logbook_validasi');
		return $q->result_array();		
	}
}