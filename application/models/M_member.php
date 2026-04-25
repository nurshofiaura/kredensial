<?php
class M_member extends CI_model{
// ==============================================

// ==============================================
	function logbook_mingguan($id){
	    $this->db->select("
	        DATE(ol.tgl_logbook) as tanggal,
	        SUM(ol.jml_logbook) as total_jam
	    ");
	    $this->db->from('ol_logbook ol');
	    $this->db->join('nkr_kewenangan ok', 'ok.id_kewenangan=ol.id_kewenangan','left');
	    $this->db->join('nkr_kompetensi okm', 'okm.id_kompetensi=ok.id_kompetensi','left');
	    $this->db->where('ol.id_logbooker', $id);
	    $this->db->where('ol.tgl_logbook >=', date('Y-m-d', strtotime('-6 days')));
	    $this->db->group_by('DATE(ol.tgl_logbook)');
	    $this->db->order_by('tanggal', 'ASC');

	    return $this->db->get()->result_array();
	}
	function total_logbook_bulanan($id){
	    $this->db->select("SUM(jml_logbook) as total_bulan");
	    $this->db->from('ol_logbook');
	    $this->db->where('id_logbooker', $id);
	    $this->db->where('MONTH(tgl_logbook)', date('m'));
	    $this->db->where('YEAR(tgl_logbook)', date('Y'));

	    return (int)$this->db->get()->row()->total_bulan;
	}
	function logbook_pie_bulanan($id){
	    $this->db->select("
	        okm.nama_kompetensi,
	        SUM(ol.jml_logbook) as total_jam
	    ");
	    $this->db->from('ol_logbook ol');
	    $this->db->join('nkr_kewenangan ok', 'ok.id_kewenangan = ol.id_kewenangan','left');
	    $this->db->join('nkr_kompetensi okm', 'okm.id_kompetensi = ok.id_kompetensi','left');
	    $this->db->where('ol.id_logbooker', $id);
	    $this->db->where('MONTH(ol.tgl_logbook)', date('m'));
	    $this->db->where('YEAR(ol.tgl_logbook)', date('Y'));
	    $this->db->group_by('ok.id_kompetensi');

	    return $this->db->get()->result_array();
	}
	function edit_pic_pegawai($pic,$id){
		$data_pendaftaran = array(
			'foto' =>$pic
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
// ============================================== TES
	function grafik_pie_berkas($id,$grup=FALSE)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
		$this->db->select("id_berkas as id_lhu,count(id_berkas) as hasil_lhu_detil,
				if (nama_kategori_pelatihan IS NULL or nama_kategori_pelatihan = '' ,SUM(case when nama_kategori_pelatihan IS NULL or nama_kategori_pelatihan = '' then 1 else 0 end),SUM(case when nama_kategori_pelatihan IS NOT NULL or nama_kategori_pelatihan <> '' then 1 else 0 end)) as total,
				if(nama_kategori_pelatihan IS NULL or nama_kategori_pelatihan = '','Bukan Kategori Pelatihan',nama_kategori_pelatihan) as nama_lhu,
				DATE_FORMAT(tgl_b_berkas,'%d-%m-%Y') as tgl_lhu,
				DATE_FORMAT(tgl_b_berkas,'%Y') as thn,
				DATE_FORMAT(tgl_b_berkas,'%m') as bln,
				DATE_FORMAT(tgl_b_berkas,'%d') as hr
			");
		$this->db->join('ol_kategori_pelatihan', 'ol_kategori_pelatihan.id_kategori_pelatihan=ol_berkas.id_kategori_pelatihan','left');
		$this->db->join('ol_berkas_kategori', 'ol_berkas_kategori.id_berkas_kategori=ol_berkas.id_kategori_berkas','left');
		if(!empty($lpd['berkas'])){
			$idlb = explode(',', $lpd['berkas']);
			$this->db->where_in("id_berkas",$idlb);
		}
		$q = $this->db->get_where('ol_berkas')->result_array();
		return $q;
    }
public function dashboard_berkas($id){
    $data['berkas'] = $this->grafik_pie_berkas($id);
    
    // Hitung total untuk persentase
    $total = array_sum(array_column($data['berkas'], 'hasil_lhu_detil'));
    foreach($data['berkas'] as &$b){
        $b['persentase'] = round(($b['hasil_lhu_detil'] / $total) * 100, 1);
    }

    $this->load->view('dashboard_berkas', $data);
}
public function lt_trend($id_pegawai, $limit_kompetensi = 10)
{
    // ambil range 4 tahun terakhir dari data
    $range = $this->get_range_tahun_line($id_pegawai);
    if(empty($range)) return ['categories'=>[], 'series'=>[]];

    // Ambil top kompetensi
    $this->db->select('okm.id_kompetensi, okm.nama_kompetensi, SUM(ol.jml_logbook) as total_logbook');
    $this->db->from('ol_logbook ol');
    $this->db->join('nkr_kewenangan ok', 'ok.id_kewenangan=ol.id_kewenangan','left');
    $this->db->join('nkr_kompetensi okm', 'okm.id_kompetensi=ok.id_kompetensi','left');
    $this->db->where('ol.id_logbooker', $id_pegawai);
    $this->db->group_by('okm.id_kompetensi');
    $this->db->order_by('total_logbook', 'DESC');
    $this->db->limit($limit_kompetensi);
    $kompetensi = $this->db->get()->result_array();

    // Ambil tahun (HANYA 4 tahun terakhir)
    $years = $this->db->select('DISTINCT YEAR(tgl_logbook) as tahun')
                      ->from('ol_logbook')
                      ->where('id_logbooker', $id_pegawai)
                      ->where('YEAR(tgl_logbook) >=', $range['min'])
                      ->where('YEAR(tgl_logbook) <=', $range['max'])
                      ->order_by('tahun','ASC')
                      ->get()->result_array();

    $categories = array_column($years, 'tahun');

    // Siapkan series
    $series = [];
    foreach($kompetensi as $k){
        $data = [];
        foreach($categories as $thn){
            $res = $this->db->select('SUM(ol.jml_logbook) as jml')
                            ->from('ol_logbook ol')
                            ->join('nkr_kewenangan ok', 'ok.id_kewenangan=ol.id_kewenangan','left')
                            ->join('nkr_kompetensi okm', 'okm.id_kompetensi=ok.id_kompetensi','left')
                            ->where('ol.id_logbooker', $id_pegawai)
                            ->where('okm.id_kompetensi', $k['id_kompetensi'])
                            ->where('YEAR(ol.tgl_logbook)', $thn)
                            ->get()->row_array();

            $data[] = (int) ($res['jml'] ?? 0);
        }

        $series[] = [
            'name' => $k['nama_kompetensi'],
            'data' => $data
        ];
    }

    return [
        'categories' => $categories,
        'series' => $series
    ];
}

	public function get_range_tahun_line($id_pegawai)
	{
	    // ambil tahun maksimum
	    $this->db->select('MAX(YEAR(tgl_logbook)) AS max_tahun');
	    $this->db->from('ol_logbook');
	    $this->db->where('id_logbooker', $id_pegawai);
	    $max = $this->db->get()->row()->max_tahun;

	    if(!$max) return [];

	    $min = $max - 3; // 4 tahun ke belakang (inklusif)

	    return [
	        'min' => $min,
	        'max' => $max
	    ];
	}
    // Ambil total logbook per kompetensi untuk satu tahun
    public function get_logbook_pie($id_pegawai, $tahun) {
        $this->db->select("
            okm.id_kompetensi,
            okm.nama_kompetensi,
            SUM(ol.jml_logbook) as jml_logbook
        ");
        $this->db->from('ol_logbook ol');
        $this->db->join('nkr_kewenangan ok','ok.id_kewenangan=ol.id_kewenangan','left');
        $this->db->join('nkr_kompetensi okm','okm.id_kompetensi=ok.id_kompetensi','left');
        $this->db->where('ol.id_logbooker', $id_pegawai);
        $this->db->where('YEAR(ol.tgl_logbook)', $tahun);
        $this->db->group_by('okm.id_kompetensi');
        return $this->db->get()->result_array();
    }
    public function get_pelatihan_pie($id_pegawai, $tahun) {
		$this->db->select(" ol.id_kategori_pelatihan, COALESCE(kkp.nama_kategori_pelatihan, 'Tanpa Kategori Pelatihan') as nama_kategori_pelatihan, COUNT(ol.id_berkas) as num ");
        $this->db->from('ol_berkas ol');
        $this->db->join('ol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=ol.id_kategori_pelatihan','left');
    //    $this->db->join('ol_berkas_kategori ob', 'ob.id_berkas_kategori=ol.id_kategori_berkas','left');
        $this->db->where('ol.status_berkas', 1);
        $this->db->where('ol.id_pegawai', $id_pegawai);
        $this->db->where('YEAR(ol.tgl_b_berkas)', $tahun);
    //    $this->db->group_by('ol.id_kategori_pelatihan');
        $this->db->group_by("COALESCE(kkp.nama_kategori_pelatihan, 'Tanpa Kategori')", false);
        return $this->db->get()->result_array();
    }
    // Ambil semua tahun logbook user, untuk dropdown
    public function get_tahun_logbook($id_pegawai){
	    $this->db->select("DISTINCT YEAR(tgl_logbook) as tahun");
	    $this->db->from('ol_logbook');
	    $this->db->where('id_logbooker', $id_pegawai);
	    $this->db->order_by('tahun','ASC');
	    $q = $this->db->get()->result_array();

	    // ubah menjadi [value => label]
	    $tahun = [];
	    foreach($q as $row) $tahun[$row['tahun']] = $row['tahun'];
	    return $tahun;
    }
	function print_jadwal($tgl,$id)
	{
	    return $this->db
	        ->select('
	            peg.nama_pegawai,
	            peg.no_hp,
	            kdj.nama_dinas_jaga,
	            kw.kode_warna,
	            kw2.kode_warna AS text_warna
	        ')
	        ->from('pegawai_jadwal pj')
	        ->join('ol_pegawai peg', 'peg.id_pegawai = pj.id_pegawai', 'left')
	        ->join('kol_dinas_jaga kdj', 'kdj.id_dinas_jaga = pj.id_dinas_jaga', 'left')
	        ->join('kol_warna kw', 'kw.id_warna = kdj.id_warna', 'left')
	        ->join('kol_warna kw2', 'kw2.id_warna = kdj.id_text', 'left')
	        ->where('pj.id_pegawai', $id)
	        ->where('pj.tgl_jadwal', $tgl)
	        ->get()
	        ->result_array();
	}
	public function jadwal_dashboard_pegawai($id_pegawai, $baseDate)
	{
	    $start = date('Y-m-d', strtotime('-1 day', strtotime($baseDate)));
	    $end   = date('Y-m-d', strtotime('+3 day', strtotime($baseDate)));

	    $rows = $this->db
	        ->select('pj.tgl_jadwal, kdj.nama_dinas_jaga')
	        ->from('pegawai_jadwal pj')
	        ->join('kol_dinas_jaga kdj', 'kdj.id_dinas_jaga = pj.id_dinas_jaga', 'left')
	        ->where('pj.id_pegawai', $id_pegawai)
	        ->where('pj.tgl_jadwal >=', $start)
	        ->where('pj.tgl_jadwal <=', $end)
	        ->get()
	        ->result_array();

	    $data = [];
	    foreach ($rows as $r) {
	        $data[$r['tgl_jadwal']] = $r['nama_dinas_jaga'];
	    }

	    return $data;
	}
    public function get_logbook_bulan_ini() {
        $bulan = date('m');
        $tahun = date('Y');

        $this->db->select('nkr_kompetensi.nama_kompetensi, SUM(ol_logbook.jml_logbook) as total_logbook');
        $this->db->from('ol_logbook');
        $this->db->join('nkr_kewenangan', 'ol_logbook.id_kewenangan = nkr_kewenangan.id_kewenangan');
        $this->db->join('nkr_kompetensi', 'nkr_kewenangan.id_kompetensi = nkr_kompetensi.id_kompetensi');
        $this->db->where('MONTH(ol_logbook.tgl_logbook)', $bulan);
        $this->db->where('YEAR(ol_logbook.tgl_logbook)', $tahun);
        $this->db->group_by('nkr_kompetensi.nama_kompetensi');
        return $this->db->get()->result_array();
    }
//================================
	function tes_pengajuan_kompetensi_all()
	{
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,DATE_FORMAT(b.tgl_pengajuan,'%d-%m-%Y') as tgl_pengajuan,if(mas_bayar = 0,'free',if(status_lunas = 0,'blm','free')) as status_lunas
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
			$this->db->where("ou.id_user", $this->session->id_user);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_pengajuan_tes b');
		$this->db->join('ol_status_diusulkan su', 'su.id_status_diusulkan=b.id_status_diusulkan','left');
		$this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=b.barcode_pegawai','left');
		$this->db->join('ol_user ou', 'ou.id_pegawai=peg.id_pegawai','left');
		$this->db->join('kol_working kw', 'kw.id_working=b.id_instansi','left');
		$this->db->where("ou.id_user", $this->session->id_user);

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
			$this->db->where("ou.id_user", $this->session->id_user);
			}
		  }
		}

	    $this->db->from('ol_pengajuan_tes b');
		$this->db->join('ol_status_diusulkan su', 'su.id_status_diusulkan=b.id_status_diusulkan','left');
		$this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=b.barcode_pegawai','left');
		$this->db->join('ol_user ou', 'ou.id_pegawai=peg.id_pegawai','left');
		$this->db->join('kol_working kw', 'kw.id_working=b.id_instansi','left');
		$this->db->where("ou.id_user", $this->session->id_user);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
 		$kondisi=array('barcode_pegawai'=>$this->session->barcode_pegawai);
		$jml = $this->m_umum->jumlah_record_filter('ol_pengajuan_tes',$kondisi);	 
//		$jml = $this->m_umum->jumlah_record_tabel('ol_pengajuan');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_signature(){
		$kode = $this->m_rancak->kode_generator(15,'');
		$data_pendaftaran = array(
			'id_signature' => $kode,
			'id_unit' => $this->session->unit,
			'barcode_pegawai' => $this->session->barcode_pegawai,
			'header' => $this->input->post('header'),
			'sub_header' => $this->input->post('sub_header'),
			'sub_sub_header' => $this->input->post('sub_sub_header'),
			'sebelum' => $this->input->post('sebelum'),
			'sesudah' => $this->input->post('sesudah'),
			'kanan_tgl' => $this->input->post('kanan_tgl'),
			'tengah_tgl' => $this->input->post('tengah_tgl'),
			'kiri_tgl' => $this->input->post('kiri_tgl'),
			'kiri_top' => $this->input->post('kiri_top'),
			'tengah_top' => $this->input->post('tengah_top'),
			'kanan_top' => $this->input->post('kanan_top'),
			'kiri_middle' => $this->input->post('kiri_middle'),
			'tengah_middle' => $this->input->post('tengah_middle'),
			'kanan_middle' => $this->input->post('kanan_middle'),
			'kiri_nama' => $this->input->post('kiri_nama'),
			'tengah_nama' => $this->input->post('tengah_nama'),
			'kanan_nama' => $this->input->post('kanan_nama'),
			'kiri_nip' => $this->input->post('kiri_nip'),
			'tengah_nip' => $this->input->post('tengah_nip'),
			'kanan_nip' => $this->input->post('kanan_nip')
		);
		return $this->db->insert('ol_logbook_signature', $data_pendaftaran);
	}
	function edit_signature(){
		$data_pendaftaran = array(
			'kiri_top' => $this->input->post('kiri_top'),
			'tengah_top' => $this->input->post('tengah_top'),
			'header' => $this->input->post('header'),
			'sub_header' => $this->input->post('sub_header'),
			'sub_sub_header' => $this->input->post('sub_sub_header'),
			'sebelum' => $this->input->post('sebelum'),
			'sesudah' => $this->input->post('sesudah'),
			'kanan_tgl' => $this->input->post('kanan_tgl'),
			'tengah_tgl' => $this->input->post('tengah_tgl'),
			'kiri_tgl' => $this->input->post('kiri_tgl'),
			'kanan_top' => $this->input->post('kanan_top'),
			'kiri_middle' => $this->input->post('kiri_middle'),
			'tengah_middle' => $this->input->post('tengah_middle'),
			'kanan_middle' => $this->input->post('kanan_middle'),
			'kiri_nama' => $this->input->post('kiri_nama'),
			'tengah_nama' => $this->input->post('tengah_nama'),
			'kanan_nama' => $this->input->post('kanan_nama'),
			'kiri_nip' => $this->input->post('kiri_nip'),
			'tengah_nip' => $this->input->post('tengah_nip'),
			'kanan_nip' => $this->input->post('kanan_nip')
		);
		$this->db->where('barcode_pegawai',$this->session->barcode_pegawai);
		$this->db->where('id_unit',$this->session->unit);
		$this->db->update('ol_logbook_signature', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function simpan_pengajuan_kompetensi_tes(){
		$id_status_diusulkan = $this->input->post('id_status_diusulkan');
		$id_instansi = $this->input->post('id_instansi');
		$kode = $this->m_rancak->kode_generator(15,'PT');
		$data_kewenangan = array(
			'id_status_diusulkan' =>$id_status_diusulkan,
			'id_instansi' =>$id_instansi,
			'id_pengajuan' => $kode,
			'tgl_pengajuan' => date('Y-m-d'),
			'barcode_pegawai' => $this->session->barcode_pegawai
		);
		$this->db->insert('ol_pengajuan_tes', $data_kewenangan);
		return $kode;
	}
	function ambil_pengajuan_kompetensi($id){
		$this->db->select("*,if (jk = '1' ,'Laki-laki','Perempuan') as jk,
							CONCAT((TIMESTAMPDIFF( YEAR, tgl_lahir, now() )), ' Tahun ', 
							TIMESTAMPDIFF( MONTH, tgl_lahir, now() ) % 12, ' Bulan ',
							FLOOR( TIMESTAMPDIFF( DAY, tgl_lahir, now() ) % 30.4375 ), ' Hari') as umur
		");
	//	$this->db->join('ol_status_diusulkan', 'ol_status_diusulkan.id_status_diusulkan=ol_pengajuan.id_status_diusulkan','left');
		$this->db->join('ol_status_diusulkan', 'ol_status_diusulkan.id_status_diusulkan=ol_pengajuan_tes.id_status_diusulkan','left');
		$this->db->join('ol_pegawai p', 'p.barcode_pegawai=ol_pengajuan_tes.barcode_pegawai','left');
		$this->db->join('kol_agama ag', 'ag.id_agama=p.id_agama','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=p.id_status_kawin','left');
		$this->db->join('kol_pendidikan pend', 'pend.id_pendidikan=p.id_pendidikan','left');
		$this->db->join('ol_status_pegawai ksp', 'ksp.id_status_pegawai=p.tipe_pegawai','left');
		$this->db->join('kol_working u', 'u.id_working=ol_pengajuan_tes.id_instansi','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=p.id_jabatan_fungsional','left');
		$q = $this->db->get_where('ol_pengajuan_tes',array('id_pengajuan'=>$id));
		return $q->row_array();
	}
	function ambil_link_asesi($id){
	  $this->db->join('nkr_form nf', 'nf.barcode_form=npv.barcode_form','left');
	  $this->db->join('kol_jenis_form kjf', 'kjf.id_jenis_form=nf.id_jenis_form','left');
	  $this->db->join('ol_pegawai op', 'op.id_pegawai=npv.id_asesor','left');
	  $this->db->order_by('nf.id_jenis_form','ASC');
	  $q = $this->db->get_where('nkr_pengajuan_validasi npv',array('status_jenis_form'=>1,'display_asesi'=>1,'npv.barcode_pengajuan'=>$id));
	  return $q->result_array();
	}
	function tabel_logbook($id)
	{
		$apk = $this->m_umum->ambil_data('ol_pengajuan_tes','id_pengajuan',$id); //barcode
		$ids = explode(',', $apk['logbook']);
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_logbook,b.barcode_logbook,
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
		$this->db->where("b.id_logbooker", $this->session->id_pegawai);
		$this->db->where_in('b.id_logbook',$ids);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_logbook b');
		//$this->db->join('ol_logbook_validasi olv', 'olv.barcode_logbook=b.barcode_logbook','left');
		$this->db->join('kol_working kow', 'kow.id_working=b.id_instansi','left');
		$this->db->join('ol_pegawai p', 'p.id_pegawai=b.id_logbooker','left');
		$this->db->join('nkr_kewenangan ok', 'ok.id_kewenangan=b.id_kewenangan','left');
		$this->db->join('nkr_kompetensi okm', 'okm.id_kompetensi=ok.id_kompetensi','left');
		$this->db->where("b.id_logbooker", $this->session->id_pegawai);
		$this->db->where_in('b.id_logbook',$ids);

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
			$this->db->where("b.id_logbooker", $this->session->id_pegawai);
			$this->db->where_in('b.id_logbook',$ids);
			}
		  }
		}

		$this->db->from('ol_logbook b');
		//$this->db->join('ol_logbook_validasi olv', 'olv.barcode_logbook=b.barcode_logbook','left');
		$this->db->join('kol_working kow', 'kow.id_working=b.id_instansi','left');
		$this->db->join('ol_pegawai p', 'p.id_pegawai=b.id_logbooker','left');
		$this->db->join('nkr_kewenangan ok', 'ok.id_kewenangan=b.id_kewenangan','left');
		$this->db->join('nkr_kompetensi okm', 'okm.id_kompetensi=ok.id_kompetensi','left');
		$this->db->where("b.id_logbooker", $this->session->id_pegawai);
		$this->db->where_in('b.id_logbook',$ids);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
 		$kondisi=array('id_pengajuan'=>$apk['id_pengajuan']);
		$jml = $this->m_umum->jumlah_record_filter('ol_logbook',$kondisi);	
	//	$jml = $this->m_umum->jumlah_record_tabel('ol_logbook');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_kode_unit_pengajuan(){
		$chk = $this->input->post('chk[]');
		$eimplo = implode(",",$chk);
		if($chk){
			$id_pengajuan = $this->input->post('id_pengajuan');
				$data_kewenangan_detil = array(
					'kode_unit_pengajuan' =>$eimplo
				);
			$this->db->where('id_pengajuan',$id_pengajuan);
			$this->db->update('ol_pengajuan_tes', $data_kewenangan_detil);
			//echo $this->db->last_query();
			$this->db->trans_complete();	// untuk cek sukses update tidak
			if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
			// if (!$this->db->affected_rows())
				return(FALSE);
			else
				return(TRUE);
		}
	}
	function simpan_laporan_berkas(){
		$chk = $this->input->post('chk[]');
		
		if($chk){
			$eimplo = implode(",",$chk);
		}else{
			$eimplo = "";
		}
			$id_laporan_tabel = $this->input->post('id_laporan_tabel');
				$data_kewenangan_detil = array(
					'berkas' =>$eimplo
				);
			$this->db->where('id_laporan_tabel',$id_laporan_tabel);
			$this->db->update('ol_logbook_laporan_tabel', $data_kewenangan_detil);
			//echo $this->db->last_query();
			$this->db->trans_complete();	// untuk cek sukses update tidak
			if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
			// if (!$this->db->affected_rows())
				return(FALSE);
			else
				return(TRUE);
	}
	function ambil_berkas_logbookku($id,$ins){
		$ids = explode(',', $id);
		$this->db->join('nkr_kewenangan krw', 'krw.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nk', 'nk.id_kompetensi=krw.id_kompetensi','left');
		$this->db->join('kol_sifat_kewenangan ksk', 'ksk.id_sifat_kewenangan=ol.id_sifat_kewenangan','left');
		$this->db->where_in('krw.id_kompetensi',$ids);
		$this->db->order_by('ol.tgl_logbook','desc');
	  $q = $this->db->get_where('ol_logbook ol',array('ol.id_instansi'=>$ins,'ol.id_logbooker'=>$this->session->id_pegawai));
	  return $q->result_array();
	}
	function simpan_logbook_pengajuan(){
		$chk = $this->input->post('chk[]');
		$eimplo = implode(",",$chk);
		if($chk){
			$id_pengajuan = $this->input->post('id_pengajuan');
				$data_kewenangan_detil = array(
					'logbook' =>$eimplo
				);
			$this->db->where('id_pengajuan',$id_pengajuan);
			$this->db->update('ol_pengajuan_tes', $data_kewenangan_detil);
			//echo $this->db->last_query();
			$this->db->trans_complete();	// untuk cek sukses update tidak
			if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
			// if (!$this->db->affected_rows())
				return(FALSE);
			else
				return(TRUE);
		}
	}
	function simpan_berkas_modal($id,$eimplo){
			$chk = $this->input->post('chk[]');
			$id_pengajuan = $this->input->post('id_pengajuan');
			if($chk){
				$data_kewenangan_detil = array(
					$id =>$eimplo
				);
			}else{
				$data_kewenangan_detil = array(
					$id =>''
				);
			}
			$this->db->where('id_pengajuan',$id_pengajuan);
			$this->db->update('ol_pengajuan_tes', $data_kewenangan_detil);
			//echo $this->db->last_query();
			$this->db->trans_complete();	// untuk cek sukses update tidak
			if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
			// if (!$this->db->affected_rows())
				return(FALSE);
			else
				return(TRUE);
	}
	function kol_etik_detil_all($id){
		$this->db->join('ol_etik_pegawai oep', 'oep.id_etik_pegawai=oed.id_etik_pegawai','left');
		$this->db->where('oep.id_etik_pegawai =', $id);
		$q = $this->db->get_where('ol_etik_detil oed');
		return $q->result_array();
	}
	function etik_pegawairow_all($id){
		$this->db->where('oep.id_etik_pegawai', $id);
		$q = $this->db->get_where('ol_etik_pegawai oep');
		return $q->row_array();
	}
	function ambil_data_instansi_row($id)
	{
		$this->db->join('kol_working kw', 'kw.id_working=pi.id_instansi','left');
		$q = $this->db->get_where('ol_pegawai_instansi pi',array('id_pegawai'=>$id));
			return $q->row_array();
	}
	function edit_pengajuan(){
		$id_pengajuan = $this->input->post('id_pengajuan');
		$id_etik_pegawai = $this->input->post('id_etik_pegawai');
		$id_4_berkas = $this->input->post('id_4_berkas');
		$id_4_ijasah = $this->input->post('id_4_ijasah');
		$id_4_str = $this->input->post('id_4_str');
		$id_4_sertifikat = $this->input->post('id_4_sertifikat');
		$kesesuaian_bukti = $this->input->post('kesesuaian_bukti');
		if (empty($kesesuaian_bukti)) {
		   $chkkesesuaian_bukti = "";
		}else{
			$chkkesesuaian_bukti = implode(",",$kesesuaian_bukti);
		}
		if (empty($id_etik_pegawai)) {
		   $chk_etik_pegawai = "";
		}else{
			$chk_etik_pegawai = implode(",",$id_etik_pegawai);
		}
		if (empty($id_4_berkas)) {
		   $id_berkas = "";
		}else{
			$id_berkas = implode(",",$id_4_berkas);
		}
		if (empty($id_4_ijasah)) {
		   $id_ijasah = "";
		}else{
			$id_ijasah = implode(",",$id_4_ijasah);
		}
		if (empty($id_4_str)) {
		   $id_str = "";
		}else{
			$id_str = implode(",",$id_4_str);
		}
		if (empty($id_4_sertifikat)) {
		   $id_sertifikat = "";
		}else{
			$id_sertifikat = implode(",",$id_4_sertifikat);
		}
	//	$this->simpan_pengajuan_logbook_pegawai($id_pengajuan,$level);
		$data_pendaftaran = array(
			'id_etik_pegawai' => $chk_etik_pegawai,
			'id_berkas' => $id_berkas,
			'id_str' => $id_str,
			'id_sertifikat' => $id_sertifikat,
			'id_ijasah' => $id_ijasah
		);
		$this->db->where('id_pengajuan',$id_pengajuan);
		$this->db->update('ol_pengajuan_tes', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function rubah_status_kompetensi($isi,$id){
		$data_pendaftaran = array(
			'status_pengajuan' => $isi
		);
		$this->db->where('id_pengajuan',$id);
		$this->db->update('ol_pengajuan_tes', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}
// ============================================== MAHASISWA
	function mhs_logbook_all($first_date,$last_date,$idkw,$pxe)
	{
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_logbook,concat(nama_kompetensi,' - <b>[',nama_kewenangan,']</b>') as nama_kompetensi, peg2.nama_pegawai as penguji
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
		$this->db->where("lp.id_logbooker", $this->session->id_pegawai);
		$this->db->where('lp.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		if($idkw > 0){
			$this->db->where("lp.id_instansi", $idkw);
		}
		if($pxe > 0){
			$this->db->where("krw.id_kompetensi", $pxe);
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('mhs_logbook lp');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=lp.id_logbooker','left');
		$this->db->join('nkr_kewenangan krw', 'krw.id_kewenangan=lp.id_kewenangan','left');
		$this->db->join('nkr_kompetensi kr', 'kr.id_kompetensi=krw.id_kompetensi','left');
	//	$this->db->join('ol_pegawai_grade opg', 'opg.id_grade=peg.id_grade','left');
		$this->db->join('kol_working kwr', 'kwr.id_working=lp.id_instansi','left');
		$this->db->join('kol_sifat_kewenangan ksk', 'ksk.id_sifat_kewenangan=lp.id_sifat_kewenangan','left');
		$this->db->join('ol_pegawai peg2', 'peg2.barcode_pegawai=lp.barcode_pegawai','left');
		$this->db->where("lp.id_logbooker", $this->session->id_pegawai);
		$this->db->where('lp.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		if($idkw > 0){
			$this->db->where("lp.id_instansi", $idkw);
		}
		if($pxe > 0){
			$this->db->where("krw.id_kompetensi", $pxe);
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
		$this->db->where("lp.id_logbooker", $this->session->id_pegawai);
		$this->db->where('lp.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		if($idkw > 0){
			$this->db->where("lp.id_instansi", $idkw);
		}
		if($pxe > 0){
			$this->db->where("krw.id_kompetensi", $pxe);
		}
			}
		  }
		}

	    $this->db->from('mhs_logbook lp');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=lp.id_logbooker','left');
		$this->db->join('nkr_kewenangan krw', 'krw.id_kewenangan=lp.id_kewenangan','left');
		$this->db->join('nkr_kompetensi kr', 'kr.id_kompetensi=krw.id_kompetensi','left');
	//	$this->db->join('ol_pegawai_grade opg', 'opg.id_grade=peg.id_grade','left');
		$this->db->join('kol_working kwr', 'kwr.id_working=lp.id_instansi','left');
		$this->db->join('kol_sifat_kewenangan ksk', 'ksk.id_sifat_kewenangan=lp.id_sifat_kewenangan','left');
		$this->db->join('ol_pegawai peg2', 'peg2.barcode_pegawai=lp.barcode_pegawai','left');
		$this->db->where("lp.id_logbooker", $this->session->id_pegawai);
		$this->db->where('lp.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		if($idkw > 0){
			$this->db->where("lp.id_instansi", $idkw);
		}
		if($pxe > 0){
			$this->db->where("krw.id_kompetensi", $pxe);
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
 		$kondisi=array('id_logbooker'=>$this->session->id_pegawai);
		$jml = $this->m_umum->jumlah_record_filter('mhs_logbook',$kondisi);	 
/*		$jml = $this->m_umum->jumlah_record_tabel('logbook');*/

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function ambil_data_instansi_null()
	{
		$this->db->join('ol_unit ou', 'ou.id_unit=pi.id_unit','left');
		$this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
		$this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=pi.barcode_pegawai','left');
	    $this->db->group_by('ou.id_instansi'); 
		$q = $this->db->get_where('mhs_pegawai_unit pi',array('pi.barcode_pegawai'=>$this->session->barcode_pegawai));
			return $q->result_array();
	}
	function ambil_data_instansi()
	{
		$this->db->join('ol_unit ou', 'ou.id_unit=pi.id_unit','left');
		$this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
		$this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=pi.barcode_pegawai','left');
	    $this->db->group_by('ou.id_instansi'); 
		$q = $this->db->get_where('mhs_pegawai_unit pi',array('pi.barcode_pegawai'=>$this->session->barcode_pegawai))->result_array();
		$hasil= array_column($q,'nama_working','id_working');
		return $hasil;
	}
	function ambil_data_penguji()
	{
	$this->db->select("barcode_pegawai,concat(nama_pegawai,' { ',nama_jabatan_fungsional,' } - [ ',nama_unit,' : ',nama_working,' ]') as nama_pegawai");
	$this->db->join('ol_unit ou', 'ou.id_unit=os.unit','left');
	$this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
	$this->db->join('ol_pegawai peg', 'peg.id_pegawai=os.id_pegawai','left');
	$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
	$q = $this->db->get_where('ol_user os',array('os.unit'=>$this->session->unit,'status_pegawai'=>1,'status_user'=>1,'id_level'=>51))->result_array();
	$hasil= array_column($q,'nama_pegawai','barcode_pegawai');
	return $hasil;
	}
	function ambil_data_kompetensi_null($first_date,$last_date,$idr)
	{
		$work = $this->m_umum->ambil_data('kol_working','barcode_working',$idr);
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=lp.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
		$this->db->where("lp.id_logbooker", $this->session->id_pegawai);
		$this->db->where('lp.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		if($idr > 0){
			$this->db->where("lp.id_instansi", $work['id_working']);
		}
	    $this->db->group_by('nkk.id_kompetensi'); 
		$q = $this->db->get_where('mhs_logbook lp',array('lp.id_logbooker'=>$this->session->id_pegawai));
			return $q->result_array();
	}
	function edit_mhs_logbook(){
		$id_logbook = $this->input->post('id_logbook');
		$tgl_logbook = $this->input->post('tgl_logbook');
		$tgl_logbook = date('Y-m-d', strtotime($tgl_logbook));
		$data_pendaftaran = array(
			'jml_logbook' =>$this->input->post('jml_logbook'),
			'id_instansi' => $this->input->post('id_instansi'),
			'barcode_pegawai' => $this->input->post('id_penguji'),
			'rm' => $this->input->post('rm'),
			'tgl_logbook' =>$tgl_logbook
		);
		$this->db->where('id_logbook',$id_logbook);
		$this->db->update('mhs_logbook', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function simpan_mhs_logbook0(){
		$id_kewenangan = $this->input->post('id_kewenangan[]');
		$jml_logbook = $this->input->post('jml_logbook[]');
		$id_sifat_kewenangan = $this->input->post('id_sifat_kewenangan[]');
		$rm = $this->input->post('rm[]');
		$id_instansi = $this->input->post('id_instansi');
		$tgl_logbook = $this->input->post('tgl_logbook');
		$tgl_logbook = date('Y-m-d', strtotime($tgl_logbook));
		$jml_kode = count($id_kewenangan);
		for ($i=0;$i<$jml_kode;$i++){
			$this->db->select("COUNT(*) as num");
			$this->db->where('id_logbooker',$id_pegawai);
			$this->db->where('tgl_logbook',$tgl_logbook);
			$this->db->where('id_kewenangan',$id_kewenangan[$i]);
			$q = $this->db->get('mhs_logbook')->row();
			$jml = $q->num;
			if($jml == 0){
				$kode = $this->m_rancak->kode_generator(15,'LB');
				$Q = $this->cek_mhs_logbook_tolak($jml_logbook[$i],$rm[$i],$id_kewenangan[$i],$tgl_logbook,$kode,$id_instansi,$id_sifat_kewenangan[$i]);
			}
		}
	}
	function simpan_mhs_logbook(){
		$jml_logbook = $this->input->post('jml_logbook[]');
		$id_kewenangan = $this->input->post('id_kewenangan[]');
	//	$jml_logbook = $this->db->escape_str($this->input->post('jml_logbook'));
		$id_sifat_kewenangan = $this->input->post('id_sifat_kewenangan[]');
		$rm = $this->input->post('rm[]');
	//	$rm = $this->db->escape_str($this->input->post('rm'));
		$id_instansi = $this->input->post('id_instansi');
		$tgl_logbook = $this->input->post('tgl_logbook');
		$tgl_logbook = date('Y-m-d', strtotime($tgl_logbook));
		$jml_kode = count($id_kewenangan);
		for ($i=0;$i<$jml_kode;$i++){
			$kode = $this->m_rancak->kode_generator(15,'LB');
				$this->cek_mhs_logbook_tolak($jml_logbook[$i],$rm[$i],$id_kewenangan[$i],$tgl_logbook,$kode,$id_instansi,$id_sifat_kewenangan[$i]);
			}
	}
	function cek_mhs_logbook_tolak($jml_logbook,$rm,$id_kewenangan,$tgl_logbook,$kode,$id_instansi,$id_sifat_kewenangan){
		$id_pegawai=$this->session->id_pegawai;
		$this->db->select("COUNT(*) as num");
		$this->db->where('id_logbooker',$id_pegawai);
		$this->db->where('id_kewenangan',$id_kewenangan);
		$this->db->where('tolak >',0);
		$q = $this->db->get('mhs_logbook')->row();
		$jml = $q->num;
		if($jml == 0){
			$this->simpan_mhs_logbook_final($jml_logbook,$rm,$id_kewenangan,$tgl_logbook,$kode,$id_instansi,$id_sifat_kewenangan);
		}
	}
	function simpan_mhs_logbook_final($jml_logbook,$rm,$id_kewenangan,$tgl_logbook,$kode,$id_instansi,$id_sifat_kewenangan){
	//	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
		$id_penguji = $this->input->post('id_penguji');
		$barcode_pegawai=$this->session->barcode_pegawai;
		if($jml_logbook == '0' OR empty($jml_logbook)){
			$jml_logbook = '1';
		}
		$this->db->select("COUNT(*) as num");
		$this->db->where('barcode_pegawai',$barcode_pegawai);
		$this->db->where('id_kewenangan',$id_kewenangan);
		$q = $this->db->get('mhs_kewenangan_lulus')->row();
		$jml = $q->num;
		$kodeid = $this->m_rancak->kode_generator_urut(15,'LB');
		if($jml == 0){
			$data_pendaftaran = array(
				'id_logbook' => $kodeid,
				'id_kewenangan' => $id_kewenangan,
				'id_instansi' => $id_instansi,
				'id_unit' => $this->session->unit,
				'jml_logbook' => $jml_logbook,
				'barcode_pegawai' => $id_penguji,
				'id_sifat_kewenangan' => 5,
				'rm' => $rm,
				'barcode_logbook' => $kode,
				'tgl_logbook' => $tgl_logbook,
				'id_logbooker' => $this->session->id_pegawai
			);
			$this->db->insert('mhs_logbook', $data_pendaftaran);
		}else{
			$data_pendaftaran = array(
				'id_logbook' => $kodeid,
				'id_kewenangan' => $id_kewenangan,
				'id_instansi' => $id_instansi,
				'id_unit' => $this->session->unit,
				'jml_logbook' => $jml_logbook,
				'barcode_pegawai' => $id_penguji,
				'id_sifat_kewenangan' => 5,
				'tgl_logbook' => $tgl_logbook,
				'rm' => $rm,
				'barcode_logbook' => $kode,
				'id_logbooker' => $this->session->id_pegawai,
				'lulus' => 1
			);
			$this->db->insert('mhs_logbook', $data_pendaftaran);
		}
		return $this->db->insert_id();
	}
	function simpan_mhs_pasien(){
		$nama_pasien = $this->input->post('nama_pasien[]');
	//	$chk = $this->input->post('chk[]');
		if($nama_pasien){
			$this->tambah_mhs_pasien();
		}
		$id_pasien_edit = $this->input->post('id_pasien_edit[]');
		if($id_pasien_edit){
			$id_pasien_edit = $this->input->post('id_pasien_edit[]');		
			$nama_pasien_edit = $this->input->post('nama_pasien_edit[]');		
			$rm_edit = $this->input->post('rm_edit[]');			
			$umur_pasien_edit = $this->input->post('umur_pasien_edit[]');			
			$satuan_pasien_edit = $this->input->post('satuan_pasien_edit[]');			
			$gender_pasien_edit = $this->input->post('gender_pasien_edit[]');			
			$jml_bahan_edit = $this->input->post('jml_bahan_edit[]');			
			$id_bahan_edit = $this->input->post('id_bahan_edit[]');			
			$jml_reject_edit = $this->input->post('jml_reject_edit[]');			
			$id_reject_edit = $this->input->post('id_reject_edit[]');			
			$jml_kode = count($id_pasien_edit);
			for ($i=0;$i<$jml_kode;$i++){ 	
				$this->edit_mhs_pasien($id_pasien_edit[$i],$nama_pasien_edit[$i],$rm_edit[$i],$umur_pasien_edit[$i],$satuan_pasien_edit[$i],$gender_pasien_edit[$i],$jml_bahan_edit[$i],$id_bahan_edit[$i],$jml_reject_edit[$i],$id_reject_edit[$i]);				
			}
		}
	}
	function tambah_mhs_pasien(){
		$nama_pasien = $this->input->post('nama_pasien[]');		
		$id_logbook = $this->input->post('id_logbook');			
		$rm = $this->input->post('rm[]');		
		$umur_pasien = $this->input->post('umur_pasien[]');				
		$satuan_pasien = $this->input->post('satuan_pasien[]');				
		$gender_pasien = $this->input->post('gender_pasien[]');				
		$jml_bahan = $this->input->post('jml_bahan[]');				
		$id_bahan = $this->input->post('id_bahan[]');				
		$jml_reject = $this->input->post('jml_reject[]');				
		$id_reject = $this->input->post('id_reject[]');				
		$jml_kode = count($nama_pasien);
		for ($i=0;$i<$jml_kode;$i++){
			if(!empty($nama_pasien[$i])){
				$kode = $this->m_rancak->kode_generator_urut(15,'PS');
				$data_pendaftaran = array(
					'id_pasien' => $kode,					
					'id_logbook' => $id_logbook,								
					'nama_pasien' => $nama_pasien[$i],					
					'umur_pasien' => $umur_pasien[$i],					
					'satuan_pasien' => $satuan_pasien[$i],					
					'gender_pasien' => $gender_pasien[$i],					
					'jml_bahan' => $jml_bahan[$i],					
					'id_bahan' => $id_bahan[$i],					
					'jml_reject' => $jml_reject[$i],					
					'id_reject' => $id_reject[$i],					
					'rm' => $rm[$i]
				);
				$this->db->insert('mhs_logbook_pasien', $data_pendaftaran);
			}				
		}		
	}
	function edit_mhs_pasien($id_pasien,$nama_pasien,$rm,$umur_pasien,$satuan_pasien,$gender_pasien,$jml_bahan_edit,$id_bahan_edit,$jml_reject_edit,$id_reject_edit){
		if($jml_bahan_edit == 0){
			$id_bahan_edit = '0';
		}
		if($jml_reject_edit == 0){
			$id_reject_edit = '0';
		}
		$data_pendaftaran = array(
			'nama_pasien' => $nama_pasien,					
			'rm' => $rm,					
			'umur_pasien' => $umur_pasien,					
			'satuan_pasien' => $satuan_pasien,					
			'gender_pasien' => $gender_pasien,
			'jml_bahan' => $jml_bahan_edit,
			'id_bahan' => $id_bahan_edit,
			'jml_reject' => $jml_reject_edit,
			'id_reject' => $id_reject_edit
		);
		$this->db->where('id_pasien',$id_pasien);
		$this->db->update('mhs_logbook_pasien', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function mhs_logbook_pasien($id)
	{
	//	$lpd = $this->m_umum->ambil_data('ol_logbook','id_logbook',$id);
		$fields = "*,DATE_FORMAT(tgl_lahir,'%d-%m-%Y') as tgl_lahir,if(jk = 1,'Laki-laki','Perempuan') as jk
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
				$this->db->where('olp.id_logbook',$id);		
				$this->db->where('ol.id_logbooker',$this->session->id_pegawai);		
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('mhs_logbook_pasien olp');	
	    $this->db->join('mhs_logbook ol', 'ol.id_logbook=olp.id_logbook','left');
	    $this->db->join('ol_pasien ops', 'ops.id_pasien=olp.id_pasien','left');
	    $this->db->join('kol_working kw', 'kw.id_working=ops.pasien_instansi','left');
	    $this->db->where('olp.id_logbook',$id);	
	    $this->db->where('ol.id_logbooker',$this->session->id_pegawai);	

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
				$this->db->where('olp.id_logbook',$id);			
				$this->db->where('ol.id_logbooker',$this->session->id_pegawai);	
			}
		  }
		}

	    $this->db->from('mhs_logbook_pasien olp');	
	    $this->db->join('mhs_logbook ol', 'ol.id_logbook=olp.id_logbook','left');
	    $this->db->join('ol_pasien ops', 'ops.id_pasien=olp.id_pasien','left');
	    $this->db->join('kol_working kw', 'kw.id_working=ops.pasien_instansi','left');
	    $this->db->where('olp.id_logbook',$id);	
	    $this->db->where('ol.id_logbooker',$this->session->id_pegawai);	

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
 		$kondisi=array('id_logbook'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('mhs_logbook_pasien',$kondisi);
//		$jml = $this->m_umum->jumlah_record_tabel('ol_logbook_lhu'); 
//$jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_logbook_pasien',$kondisi,'ol_pasien','id_pasien');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function ambil_logbook_pasien($id)	//daftar.php pasien
	{
		$this->db->join('mhs_logbook ol', 'ol.id_logbook=olp.id_logbook','left');
		$this->db->join('ol_pasien ops', 'ops.id_pasien=olp.id_pasien','left');
		$query = $this->db->get_where('mhs_logbook_pasien olp',array('olp.id_logbook_pasien'=>$id));
		return $query->row_array();
	}
	function simpan_mhs_lpasien(){
		$id_logbook = $this->input->post('id_logbook');
		$jml_logbook = $this->input->post('jml_logbook');
		$rm = $this->input->post('rm');
		$kondisi=array('rm'=>$rm);
		$jml = $this->m_umum->jumlah_record_filter('ol_pasien',$kondisi);
		if($jml == 0){
			$psx = $this->simpan_ol_pasien();
		}else{
			$this->rubah_ol_pasien();
			$pasiyen = $this->m_umum->ambil_data('ol_pasien','rm',$rm);
			$psx = $pasiyen['id_pasien'];
		}
		$this->nyimpen_mhss_logbook_pasien($psx);
		$this->change_jml_mhss_logbook($id_logbook,$jml_logbook);
	}
	function nyimpen_mhss_logbook_pasien($id){
		$kode = $this->m_rancak->kode_generator_urut(15,'PS');
		$jml_bahan = $this->input->post('jml_bahan');			
		$jml_reject = $this->input->post('jml_reject');	
		if($jml_bahan == 0){
			$id_bahan = '0';
		}else{
			$id_bahan = $this->input->post('id_bahan');
		}
		if($jml_reject == 0){
			$id_reject = '0';
		}else{
			$id_reject = $this->input->post('id_reject');
		}
		$data_pendaftaran = array(
			'id_logbook_pasien' => $kode,					
			'id_pasien' => $id,								
			'id_logbook' => $this->input->post('id_logbook'),
			'jml_bahan' => $this->input->post('jml_bahan'),
			'id_bahan' => $id_bahan,
			'jml_reject' => $this->input->post('jml_reject'),
			'id_reject' => $id_reject
		);
		return $this->db->insert('mhs_logbook_pasien', $data_pendaftaran);
	}
	function rubah_mhss_lpasien(){
		$id_logbook = $this->input->post('id_logbook');
		$jml_logbook = $this->input->post('jml_logbook');
		$rm = $this->input->post('rm');
		$kondisi=array('rm'=>$rm);
		$jml = $this->m_umum->jumlah_record_filter('ol_pasien',$kondisi);
		if($jml == 0){
			$psx = $this->simpan_ol_pasien();
		}else{
			$this->rubah_ol_pasien();
			$pasiyen = $this->m_umum->ambil_data('ol_pasien','rm',$rm);
			$psx = $pasiyen['id_pasien'];
		}
		$this->ngerubah_mhss_logbook_pasien($psx);
		$this->change_jml_mhss_logbook($id_logbook,$jml_logbook);
	}
	function ngerubah_mhss_logbook_pasien($id){
		$id_logbook_pasien = $this->input->post('id_logbook_pasien');			
		$jml_bahan = $this->input->post('jml_bahan');			
		$jml_reject = $this->input->post('jml_reject');	
		if($jml_bahan == 0){
			$id_bahan = '0';
		}else{
			$id_bahan = $this->input->post('id_bahan');
		}
		if($jml_reject == 0){
			$id_reject = '0';
		}else{
			$id_reject = $this->input->post('id_reject');
		}
		$data_pendaftaran = array(	
			'id_pasien' => $id,				
			'jml_bahan' => $this->input->post('jml_bahan'),
			'id_bahan' => $id_bahan,
			'jml_reject' => $this->input->post('jml_reject'),
			'id_reject' => $id_reject
		);
		$this->db->where('id_logbook_pasien',$id_logbook_pasien);
		$this->db->update('mhs_logbook_pasien', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function change_jml_mhss_logbook($id,$jml_logbook,$equ=FALSE){
		$kondisi=array('id_logbook'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('mhs_logbook_pasien',$kondisi);
		if($equ){
			if($jml == $jml_logbook){
				$data_pendaftaran = array(	
					'jml_logbook' => $jml
				);
				$this->db->where('id_logbook',$id);
				$this->db->update('mhs_logbook', $data_pendaftaran);
				//echo $this->db->last_query();
				$this->db->trans_complete();	// untuk cek sukses update tidak
				if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
				// if (!$this->db->affected_rows())
					return(FALSE);
				else
					return(TRUE);
			}
		}else{
		//	if($jml > $jml_logbook){
				$data_pendaftaran = array(	
					'jml_logbook' => $jml
				);
				$this->db->where('id_logbook',$id);
				$this->db->update('mhs_logbook', $data_pendaftaran);
				//echo $this->db->last_query();
				$this->db->trans_complete();	// untuk cek sukses update tidak
				if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
				// if (!$this->db->affected_rows())
					return(FALSE);
				else
					return(TRUE);
		//	}
		}
	}
	function hapus_dan_hitung($id,$idp){
		$this->m_umum->hapus_data('mhs_logbook_pasien','id_logbook_pasien',$idp);
		$kondisi=array('id_logbook'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('mhs_logbook_pasien',$kondisi);
		$data_pendaftaran = array(	
			'jml_logbook' => $jml
		);
		$this->db->where('id_logbook',$id);
		$this->db->update('mhs_logbook', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
					return(TRUE);
	}
	function change_jml_mhxx_logbook($id,$jml_logbook){
				$data_pendaftaran = array(	
					'jml_logbook' => $jml_logbook
				);
				$this->db->where('id_logbook',$id);
				$this->db->update('mhs_logbook', $data_pendaftaran);
				//echo $this->db->last_query();
				$this->db->trans_complete();	// untuk cek sukses update tidak
				if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
				// if (!$this->db->affected_rows())
					return(FALSE);
				else
					return(TRUE);
	}
	function print_mhs_logbook_per_pasien($first_date,$last_date,$idr,$id,$pxe)
	{
		$this->db->select("DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_logbook,ol.id_logbook,rm,
		concat(nama_kompetensi,' - <b>[',nama_kewenangan,']</b>') as nama_kompetensi
			");
		$this->db->join('nkr_kewenangan ok', 'ok.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi okm', 'okm.id_kompetensi=ok.id_kompetensi','left');
		$this->db->where('ol.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		if($pxe > 0){
		$this->db->where("ok.id_kompetensi", $pxe);
		}
		$this->db->order_by('ol.tgl_logbook','ASC');
		if($idr > 0){
			$q = $this->db->get_where('mhs_logbook ol',array('ol.id_logbooker'=>$id,'ol.id_instansi'=>$idr))->result_array();
		}else{
			$q = $this->db->get_where('mhs_logbook ol',array('ol.id_logbooker'=>$id))->result_array();
		}
		return $q;
    }
	function print_mhs_per_pasien($id)
	{
		$this->db->select("*,if(jk = 1,'Laki-laki','Perempuan') as jk,
			CONCAT((TIMESTAMPDIFF( YEAR, ops.tgl_lahir, tgl_logbook )), ' Tahun ',
			TIMESTAMPDIFF( MONTH, ops.tgl_lahir, tgl_logbook ) % 12, ' Bulan ',
			FLOOR( TIMESTAMPDIFF( DAY, ops.tgl_lahir, tgl_logbook ) % 30.4375 ), ' Hari') as umur
			");
		$this->db->join('mhs_logbook ol', 'ol.id_logbook=olp.id_logbook','left');
		$this->db->join('ol_pasien ops', 'ops.id_pasien=olp.id_pasien','left');
		$this->db->join('kol_reject krj', 'krj.id_reject=olp.id_reject','left');
		$this->db->join('ol_bahan obh', 'obh.id_bahan=olp.id_bahan','left');
		$q = $this->db->get_where('mhs_logbook_pasien olp',array('olp.id_logbook'=>$id))->result_array();
		return $q;
    }
	function count_all_mhs_bakhp($first_date,$last_date,$idkw,$pxe,$kondisi)
	{
		$this->db->select('COUNT(*) as num');
		$this->db->join('mhs_logbook lp', 'lp.id_logbook=ol_logbook_pasien.id_logbook','left');
		$this->db->where('lp.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		if($idkw > 0){
			$this->db->where("lp.id_instansi", $idkw);
		}
		if($pxe > 0){
			$this->db->where("krw.id_kompetensi", $pxe);
		}
		$query = $this->db->get_where('mhs_logbook_pasien',$kondisi);
	    $result = $query->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
	}
// ================================================================ END MAHASISWA
	function lh($bln,$thn,$id){
		$first_date = '01-'.$bln.'-'.$thn;
		$akhir = date('t', strtotime($first_date));
		$last_date = $akhir.'-'.$bln.'-'.$thn;
		$this->db->select("DATE_FORMAT(ol.tgl_logbook,'%d-%m-%Y') as tgl_logbook");
		$this->db->join('nkr_kewenangan ok', 'ok.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi okm', 'okm.id_kompetensi=ok.id_kompetensi','left');
		$this->db->where('ol.id_logbooker', $id);
/*		$this->db->where('okm.id_jabatan', $this->session->id_jabatan);
		$this->db->where('okm.id_jabatan', $this->session->id_jabatan);*/
		$this->db->where('ol.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$this->db->group_by("ol.tgl_logbook");
		$q = $this->db->get('ol_logbook ol')->result_array();
		//echo $this->db->last_query();die();
		return $q;
	}
	function lh2($tgl,$id){
		$this->db->select("ok.id_kompetensi,SUM(ol.jml_logbook) as jml_logbook");
		$this->db->join('nkr_kewenangan ok', 'ok.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi okm', 'okm.id_kompetensi=ok.id_kompetensi','left');
		$this->db->where('ol.id_logbooker', $id);
	//	$this->db->where('okm.id_jabatan', $this->session->id_jabatan);
		$this->db->where('ol.tgl_logbook', date('Y-m-d', strtotime($tgl)));
		$this->db->group_by("ok.id_kompetensi");
		$q = $this->db->get('ol_logbook ol')->result_array();
		//echo $this->db->last_query();die();
		return $q;
	}
	function lb($thn,$id){
		$first_date = '01-01-'.$thn;
		$last_date = '31-12-'.$thn;
		$this->db->select("DATE_FORMAT(ol.tgl_logbook,'%d-%m-%Y') as tgl_logbook,DATE_FORMAT(ol.tgl_logbook,'%m-%Y') as tgl_logbooke");
		$this->db->join('nkr_kewenangan ok', 'ok.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi okm', 'okm.id_kompetensi=ok.id_kompetensi','left');
		$this->db->where('ol.id_logbooker', $id);
	//	$this->db->where('okm.id_jabatan', $this->session->id_jabatan);
		$this->db->where('ol.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$this->db->group_by("MONTH(ol.tgl_logbook)");
		$q = $this->db->get('ol_logbook ol')->result_array();
		//echo $this->db->last_query();die();
		return $q;
	}
	function lb2($tgl,$id){
		$this->db->select("ok.id_kompetensi,SUM(ol.jml_logbook) as jml_logbook");
		$this->db->join('nkr_kewenangan ok', 'ok.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi okm', 'okm.id_kompetensi=ok.id_kompetensi','left');
		$this->db->where('ol.id_logbooker', $id);
	//	$this->db->where('okm.id_jabatan', $this->session->id_jabatan);
		$this->db->where('YEAR(ol.tgl_logbook)', date('Y', strtotime($tgl)));
		$this->db->where('MONTH(ol.tgl_logbook)', date('m', strtotime($tgl)));
		$this->db->group_by("ok.id_kompetensi");
		$q = $this->db->get('ol_logbook ol')->result_array();
	//	echo $this->db->last_query();die();
		return $q;
	}
	function lt($id){
		$this->db->select("DATE_FORMAT(ol.tgl_logbook,'%Y') as tgl_logbook");
		$this->db->join('nkr_kewenangan ok', 'ok.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi okm', 'okm.id_kompetensi=ok.id_kompetensi','left');
		$this->db->where('ol.id_logbooker', $id);
	//	$this->db->where('okm.id_jabatan', $this->session->id_jabatan);
		$this->db->group_by("year(ol.tgl_logbook)");
		$q = $this->db->get('ol_logbook ol')->result_array();
	//	echo $this->db->last_query();die();
		return $q;
	}
	function lt2($thn,$id){
		$this->db->select("okm.id_kompetensi,SUM(ol.jml_logbook) as jml_logbook");
		$this->db->join('nkr_kewenangan ok', 'ok.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi okm', 'okm.id_kompetensi=ok.id_kompetensi','left');
		$this->db->where('ol.id_logbooker', $id);
	//	$this->db->where('okm.id_jabatan', $this->session->id_jabatan);
		$this->db->where('year(ol.tgl_logbook)', $thn);
		$this->db->group_by("okm.id_kompetensi");
		$q = $this->db->get('ol_logbook ol')->result_array();
	//	echo $this->db->last_query();die();
		return $q;
	}
	function ambil_kol_golongan_pemeriksaan_graph($page,$bln,$thn,$id)
	{
		if($page == 'lh'){
			$first_date = '01-'.$bln.'-'.$thn;
			$akhir = date('t', strtotime($first_date));
			$last_date = $akhir.'-'.$bln.'-'.$thn;

		}
		else{
			$first_date = '01-01-'.$thn;
			$last_date = '31-12-'.$thn;
		}
		$this->db->select("ok.id_kompetensi,nama_kompetensi");
		$this->db->join('nkr_kewenangan ok', 'ok.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi okm', 'okm.id_kompetensi=ok.id_kompetensi','left');
		$this->db->where('ol.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$this->db->group_by('ok.id_kompetensi');
		$q = $this->db->get_where('ol_logbook ol',array('ol.id_logbooker'=>$id))->result_array();
		return $q;
    }
	function ambil_range_logbook_bulanane_detil($tgl){
		$this->db->join('nkr_kewenangan krw', 'krw.id_kewenangan=lp.id_kewenangan','left');
		$this->db->join('nkr_kompetensi okm', 'okm.id_kompetensi=krw.id_kompetensi','left');
	//	$this->db->join('ol_kewenangan_bk okbk', 'okbk.id_kewenangan=krw.id_kewenangan','left');
	//	$this->db->join('butir_kegiatan bk', 'bk.id_butir_kegiatan=okbk.id_butir_kegiatan','left');
		$this->db->where('id_logbooker', $this->session->id_pegawai);
		$this->db->where('DATE(tgl_logbook)', $tgl);
	//	$this->db->group_by("t.id_golongan_pemeriksaan");
		$q = $this->db->get('ol_logbook lp')->result_array();
		//echo $this->db->last_query();die();
		return $q;
	}
	function ambil_range_bukan_logbook_bulanane_detil($tgl){
		$this->db->join('nkr_kewenangan krw', 'krw.id_kewenangan=lp.id_kewenangan','left');
		$this->db->join('nkr_kompetensi okm', 'okm.id_kompetensi=krw.id_kompetensi','left');
	//	$this->db->join('ol_kewenangan_bk okbk', 'okbk.id_kewenangan=krw.id_kewenangan','left');
	//	$this->db->join('butir_kegiatan bk', 'bk.id_butir_kegiatan=okbk.id_butir_kegiatan','left');
		$this->db->where('id_logbooker', $this->session->id_pegawai);
		$this->db->where('DATE(tgl_logbook)', $tgl);
	//	$this->db->group_by("t.id_golongan_pemeriksaan");
		$q = $this->db->get('ol_logbook lp')->result_array();
		//echo $this->db->last_query();die();
		return $q;
	}
	function print_logbook_bulanane($first_date,$ir,$pxe)
	{
		//kompetensi
		$year = date('Y', strtotime($first_date));
		$month = date('m', strtotime($first_date));
		$bulan = $year."-".$month;
		$awal	= $year.'-'.$month.'-01';
		$tglakhir = date('t', strtotime($awal));
		$akhir	= $year.'-'.$month.'-'.$tglakhir;
		$this->db->select('*,SUM(lp.jml_logbook) as jumlaha,lp.id_kewenangan,krw.id_kompetensi');
		$this->db->join('nkr_kewenangan krw', 'krw.id_kewenangan=lp.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nk', 'nk.id_kompetensi=krw.id_kompetensi','left');
		if($ir > 0){
		$this->db->where("lp.id_instansi", $ir);
		}
		if($pxe > 0){
		$this->db->where("krw.id_kompetensi", $pxe);
		}
		$this->db->where("lp.id_logbooker", $this->session->id_pegawai);
		$this->db->where("DATE_FORMAT(lp.tgl_logbook,'%Y-%m')", $bulan);
		$this->db->group_by('krw.id_kompetensi');
		$q = $this->db->get('ol_logbook lp')->result_array();
	//	print_r($q);die();
		return $q;
	}
	function laporan_tiap_bulan_logbook($select,$kondisi,$first_date,$last_date,$ir,$pxe,$grup=FALSE)
	{
		//kompetensi
		$this->db->select($select);
		$this->db->join('nkr_kewenangan','nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
		$this->db->join('nkr_kompetensi','nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
		$this->db->where('tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		if($ir > 0){
		$this->db->where("id_instansi", $ir);
		}
		if($pxe > 0){
		$this->db->where("nkr_kewenangan.id_kompetensi", $pxe);
		}
		if($grup){
			$this->db->group_by($grup);
		}
		$q = $this->db->get_where('ol_logbook',$kondisi)->result_array();
	//	$this->db->where("DATE_FORMAT(lp.tgl_logbook,'%Y-%m')", $bulan);
	//	print_r($q);die();
		return $q;
	}
	function laporan_tiap_bulan_logbook_order($select,$kondisi,$first_date,$last_date,$ir,$pxe,$order,$asc,$grup=FALSE)
	{
		//kompetensi
		$this->db->select($select);
		$this->db->join('nkr_kewenangan','nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
		$this->db->join('nkr_kompetensi','nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
		$this->db->where('tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		if($ir > 0){
		$this->db->where("id_instansi", $ir);
		}
		if($pxe > 0){
		$this->db->where("nkr_kewenangan.id_kompetensi", $pxe);
		}
		if($grup){
			$this->db->group_by($grup);
		}
		$this->db->order_by($order,$asc);
		$q = $this->db->get_where('ol_logbook',$kondisi)->result_array();
	//	$this->db->where("DATE_FORMAT(lp.tgl_logbook,'%Y-%m')", $bulan);
	//	print_r($q);die();
		return $q;
	}
	function total_laporan_tiap_bulan_logbook($select,$kondisi,$ir,$pxe){
		$this->db->select($select);
		$this->db->join('nkr_kewenangan','nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
		$this->db->join('nkr_kompetensi','nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
		if($ir > 0){
		$this->db->where("id_instansi", $ir);
		}
		if($pxe > 0){
		$this->db->where("nkr_kewenangan.id_kompetensi", $pxe);
		}
		$q = $this->db->get_where('ol_logbook',$kondisi);
		return $q->result_array();
	}
    function jumlah_record_laporan_tiap_bulan_logbook($select,$kondisi,$ir,$pxe)
    {
		$this->db->join('nkr_kewenangan','nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
		$this->db->join('nkr_kompetensi','nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
		if($ir > 0){
		$this->db->where("id_instansi", $ir);
		}
		if($pxe > 0){
		$this->db->where("nkr_kewenangan.id_kompetensi", $pxe);
		}
        $query = $this->db->select($select)->get_where('ol_logbook',$kondisi);
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
    }
	function ambil_bulan_print_logbook_perbulanane($select,$kondisi,$first_date,$last_date,$grup=FALSE)
	{
		$this->db->select($select);
		$this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
		$this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
		$this->db->where('tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		if($grup){
			$this->db->group_by($grup);
		}
		$q = $this->db->get_where('ol_logbook',$kondisi)->result_array();
		return $q;
    }
	function ambil_bulan_total_logbook_perbulanane($select,$kondisi,$first_date,$last_date,$grup=FALSE)
	{
		$this->db->select($select);
		$this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
		$this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
		$this->db->where('tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		if($grup){
			$this->db->group_by($grup);
		}
		$this->db->order_by('nkr_kewenangan.id_kompetensi','ASC');
		$q = $this->db->get_where('ol_logbook',$kondisi)->result_array();
		return $q;
    }
	function print_logbook_kwkp_perbulanane($id,$bulan,$ir,$pxe,$grup=FALSE)
	{
		//kompetensi
		$this->db->select('*,SUM(lp.jml_logbook) as jumlaha,lp.id_kewenangan,krw.id_kompetensi');
		$this->db->join('nkr_kewenangan krw', 'krw.id_kewenangan=lp.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nk', 'nk.id_kompetensi=krw.id_kompetensi','left');
		if($ir > 0){
		$this->db->where("lp.id_instansi", $ir);
		}
		if($pxe > 0){
		$this->db->where("krw.id_kompetensi", $pxe);
		}
		$this->db->where("lp.id_logbooker", $id);
		$this->db->where("DATE_FORMAT(lp.tgl_logbook,'%Y-%m')", $bulan);
		if($grup){
			$this->db->group_by($grup);
		}
		
		$q = $this->db->get('ol_logbook lp')->result_array();
	//	print_r($q);die();
		return $q;
	}
    function jumlah_record_kwkp_logbook_kompetensi($id_pegawai,$tglenya,$id_kewenangan,$ir,$pxe,$kpkw)
    {
    	$this->db->join('nkr_kewenangan krw', 'krw.id_kewenangan=lp.id_kewenangan','left');
    //	$this->db->join('nkr_kompetensi krp', 'krp.id_kompetensi=krw.id_kompetensi','left');
		$this->db->where('tgl_logbook',$tglenya);
		$this->db->where("id_logbooker", $id_pegawai);
		$this->db->where($kpkw, $id_kewenangan);
		if($ir > 0){
		$this->db->where("lp.id_instansi", $ir);
		}
		if($pxe > 0){
		$this->db->where("krw.id_kompetensi", $pxe);
		}
        $query = $this->db->select("COUNT(*) as num")->get_where('ol_logbook lp');
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
    }
	function total_record_kwkp_logbook_kompetensi($id_pegawai,$tglenya,$id_kewenangan,$ir,$pxe,$kpkw){
		$this->db->select('SUM(jml_logbook) as jumlahe');
		$this->db->join('nkr_kewenangan krw', 'krw.id_kewenangan=lp.id_kewenangan','left');
		$this->db->where('tgl_logbook',$tglenya);
		$this->db->where("id_logbooker", $id_pegawai);
		$this->db->where($kpkw, $id_kewenangan);
		if($ir > 0){
		$this->db->where("lp.id_instansi", $ir);
		}
		if($pxe > 0){
		$this->db->where("krw.id_kompetensi", $pxe);
		}
		$q = $this->db->get_where('ol_logbook lp');
		return $q->result_array();
	}
	function print_logbook_perbulanane($id,$bulan,$ir,$pxe)
	{
		//kompetensi
		$this->db->select('*,SUM(lp.jml_logbook) as jumlaha,lp.id_kewenangan,krw.id_kompetensi');
		$this->db->join('nkr_kewenangan krw', 'krw.id_kewenangan=lp.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nk', 'nk.id_kompetensi=krw.id_kompetensi','left');
		if($ir > 0){
		$this->db->where("lp.id_instansi", $ir);
		}
		if($pxe > 0){
		$this->db->where("krw.id_kompetensi", $pxe);
		}
		$this->db->where("lp.id_logbooker", $id);
		$this->db->where("DATE_FORMAT(lp.tgl_logbook,'%Y-%m')", $bulan);
		$this->db->group_by('krw.id_kompetensi');
		$q = $this->db->get('ol_logbook lp')->result_array();
	//	print_r($q);die();
		return $q;
	}
	function print_eukom_perbulanane($id,$bulan,$ir,$pxe)
	{
		//kewenangan
		$this->db->select('*,SUM(lp.jml_logbook) as jumlaha,lp.id_kewenangan,krw.id_kompetensi');
		$this->db->join('nkr_kewenangan krw', 'krw.id_kewenangan=lp.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nk', 'nk.id_kompetensi=krw.id_kompetensi','left');
		if($ir > 0){
		$this->db->where("lp.id_instansi", $ir);
		}
		if($pxe > 0){
		$this->db->where("krw.id_kompetensi", $pxe);
		}
		$this->db->where("lp.id_logbooker", $id);
		$this->db->where("DATE_FORMAT(lp.tgl_logbook,'%Y-%m')", $bulan);
		$this->db->group_by('lp.id_kewenangan');
		$q = $this->db->get('ol_logbook lp')->result_array();
	//	print_r($q);die();
		return $q;
	}
	function print_eukom_bulanane($first_date,$ir,$pxe)
	{
		//kewenangan
		$year = date('Y', strtotime($first_date));
		$month = date('m', strtotime($first_date));
		$bulan = $year."-".$month;
		$awal	= $year.'-'.$month.'-01';
		$tglakhir = date('t', strtotime($awal));
		$akhir	= $year.'-'.$month.'-'.$tglakhir;
		$this->db->select('*,SUM(lp.jml_logbook) as jumlaha,lp.id_kewenangan,krw.id_kompetensi');
		$this->db->join('nkr_kewenangan krw', 'krw.id_kewenangan=lp.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nk', 'nk.id_kompetensi=krw.id_kompetensi','left');
		if($ir > 0){
		$this->db->where("lp.id_instansi", $ir);
		}
		if($pxe > 0){
		$this->db->where("krw.id_kompetensi", $pxe);
		}
		$this->db->where("lp.id_logbooker", $this->session->id_pegawai);
		$this->db->where("DATE_FORMAT(lp.tgl_logbook,'%Y-%m')", $bulan);
		$this->db->group_by('lp.id_kewenangan');
		$q = $this->db->get('ol_logbook lp')->result_array();
	//	print_r($q);die();
		return $q;
	}
	function print_logbook_per_pasien($first_date,$last_date,$idr,$id,$pxe)
	{
		$this->db->select("DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_logbook,ol.id_logbook,rm,
		concat(nama_kompetensi,' - <b>[',nama_kewenangan,']</b>') as nama_kompetensi
			");
		$this->db->join('nkr_kewenangan ok', 'ok.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi okm', 'okm.id_kompetensi=ok.id_kompetensi','left');
		$this->db->where('ol.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		if($pxe > 0){
		$this->db->where("ok.id_kompetensi", $pxe);
		}
		$this->db->order_by('ol.tgl_logbook','ASC');
		if($idr > 0){
			$q = $this->db->get_where('ol_logbook ol',array('ol.id_logbooker'=>$id,'ol.id_instansi'=>$idr))->result_array();
		}else{
			$q = $this->db->get_where('ol_logbook ol',array('ol.id_logbooker'=>$id))->result_array();
		}
		return $q;
    }
	function print_per_pasien($id)
	{
		$this->db->select("*,if(jk = 1,'Laki-laki','Perempuan') as jk,
			CONCAT((TIMESTAMPDIFF( YEAR, ops.tgl_lahir, tgl_logbook )), ' Tahun ',
			TIMESTAMPDIFF( MONTH, ops.tgl_lahir, tgl_logbook ) % 12, ' Bulan ',
			FLOOR( TIMESTAMPDIFF( DAY, ops.tgl_lahir, tgl_logbook ) % 30.4375 ), ' Hari') as umur
			");
		$this->db->join('ol_logbook ol', 'ol.id_logbook=olp.id_logbook','left');
		$this->db->join('ol_pasien ops', 'ops.id_pasien=olp.id_pasien','left');
/*		$this->db->join('kol_reject krj', 'krj.id_reject=olp.id_reject','left');
		$this->db->join('ol_bahan obh', 'obh.id_bahan=olp.id_bahan','left');*/
		$q = $this->db->get_where('ol_logbook_pasien olp',array('olp.id_logbook'=>$id))->result_array();
		return $q;
    }
	function ambil_data_untuk_tabel_dan_grafik($first_date,$last_date,$idk,$idkw,$idb,$idr,$grup,$select)
	{
		$idl = explode(',', $idk);
		$idc = explode(',', $idb);
		$ids = explode(',', $idr);
		$this->db->select($select);
		$this->db->join('ol_logbook ol', 'ol.id_logbook=olp.id_logbook','left');
		$this->db->join('ol_pasien ops', 'ops.id_pasien=olp.id_pasien','left');
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
		$this->db->join('kol_reject krj', 'krj.id_reject=olp.id_reject','left');
		$this->db->join('ol_bahan obh', 'obh.id_bahan=olp.id_bahan','left');
		$this->db->where('ol.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		if(!empty($idk)){
			$this->db->where_in("nkk.id_kompetensi",$idl);
		}
		if(!empty($idb)){
			$this->db->where_in("olp.id_bahan",$idc);
		}
		if(!empty($idr)){
			$this->db->where_in("olp.id_reject",$ids);
		}
		if(empty($idkw)){
			$this->db->group_by('olp.'.$grup);
		}else{
			$this->db->group_by('nkk.'.$idkw);
		}
		$q = $this->db->get_where('ol_logbook_pasien olp',array('ol.id_logbooker'=>$this->session->id_pegawai))->result_array();
		return $q;
    }
	function ambil_laporan_logbook_tabel14($id)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id); //id_laporan_tabel
		$idl = explode(',', $lpd['kompetensi']);
		$idc = explode(',', $lpd['bahan']);
		$ids = explode(',', $lpd['reject']);
		$this->db->select('*,SUM(jml_logbook) as jml_logbook');
	//	$this->db->join('ol_logbook ol', 'ol.id_logbook=olp.id_logbook','left');
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
		$this->db->where('ol.tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where("ol.id_instansi",$lpd['id_instansi']);
		$this->db->where('jml_logbook >',0);
	//	$this->db->where("(olp.jml_bahan > 0 OR olp.jml_reject > 0)", NULL, FALSE);
		if(!empty($lpd['kompetensi'])){
			$this->db->where_in("nkk.id_kompetensi",$idl);
		}
		if(!empty($lpd['bahan'])){
			$this->db->where_in("olp.id_bahan",$idc);
		}
		if(!empty($lpd['reject'])){
			$this->db->where_in("olp.id_reject",$ids);
		}
		if(!empty($lpd['isi_kompetensi'])){
			$idlb = explode(',', $lpd['isi_kompetensi']);
			$this->db->where_in("ol.id_logbook",$idlb);
		}
		$this->db->group_by('ol.id_kewenangan');
/*		if($lpd['share_it'] == 0){
		$q = $this->db->get_where('ol_logbook_pasien olp',array('ol.id_logbooker'=>$this->session->id_pegawai))->result_array();
		}else{*/
		$q = $this->db->get_where('ol_logbook ol',array('ol.id_logbooker'=>$lpd['id_pegawai']))->result_array();			
//		}		
		return $q;
    }
	function ambil_data_bakhp_tabel14($id)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
		$idl = explode(',', $lpd['kompetensi']);
		$idc = explode(',', $lpd['bahan']);
		$ids = explode(',', $lpd['reject']);
		$this->db->select('*,SUM(jml_bahan) as jml_logbook,nama_bahan as nama_kompetensi');
		$this->db->join('ol_logbook_pasien olp', 'olp.id_logbook_pasien=olpk.id_logbook_pasien','left');
		$this->db->join('ol_logbook ol', 'ol.id_logbook=olp.id_logbook','left');
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
		$this->db->join('ol_bahan obh', 'obh.id_bahan=olpk.id_bahan','left');
		$this->db->where('ol.tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where("ol.id_instansi",$lpd['id_instansi']);
		$this->db->where('jml_bahan >',0);
	//	$this->db->where("(olp.jml_bahan > 0 OR olp.jml_reject > 0)", NULL, FALSE);
		if(!empty($lpd['kompetensi'])){
			$this->db->where_in("nkk.id_kompetensi",$idl);
		}
		if(!empty($lpd['bahan'])){
			$this->db->where_in("olpk.id_bahan",$idc);
		}
		if(!empty($lpd['isi_kompetensi'])){
			$idlb = explode(',', $lpd['isi_kompetensi']);
			$this->db->where_in("ol.id_logbook",$idlb);
		}
		$this->db->group_by('olpk.id_bahan');
		$q = $this->db->get_where('ol_logbook_pakai olpk',array('ol.id_logbooker'=>$lpd['id_pegawai']))->result_array();			
		return $q;
    }
	function ambil_data_reject_tabel14($id)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
		$idl = explode(',', $lpd['kompetensi']);
		$idc = explode(',', $lpd['bahan']);
		$ids = explode(',', $lpd['reject']);
		$this->db->select("*,SUM(jml_reject) as jml_logbook,concat(nama_bahan,' - ',nama_reject) as nama_kompetensi");
		$this->db->join('ol_logbook_pasien olp', 'olp.id_logbook_pasien=olpk.id_logbook_pasien','left');
		$this->db->join('ol_logbook ol', 'ol.id_logbook=olp.id_logbook','left');
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
		$this->db->join('ol_bahan obh', 'obh.id_bahan=olpk.id_bahan','left');
		$this->db->join('kol_reject kre', 'kre.id_reject=olpk.id_reject','left');
		$this->db->where('ol.tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where("ol.id_instansi",$lpd['id_instansi']);
		$this->db->where('jml_reject >',0);
		if(!empty($lpd['kompetensi'])){
			$this->db->where_in("nkk.id_kompetensi",$idl);
		}
		if(!empty($lpd['bahan'])){
			$this->db->where_in("olp.id_bahan",$idc);
		}
		if(!empty($lpd['reject'])){
			$this->db->where_in("olp.id_reject",$ids);
		}
		if(!empty($lpd['isi_kompetensi'])){
			$idlb = explode(',', $lpd['isi_kompetensi']);
			$this->db->where_in("ol.id_logbook",$idlb);
		}
		$this->db->group_by(array("olpk.id_reject", "olpk.id_bahan"));
		$this->db->order_by("nama_bahan", "asc");
		$q = $this->db->get_where('ol_logbook_reject olpk',array('ol.id_logbooker'=>$lpd['id_pegawai']))->result_array();				
		return $q;
    }
	function ambil_laporan_lhu_tabel14($id)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id); //id_laporan_tabel
		$this->db->select("*,SUM(hasil_lhu_detil) as jml_logbook,concat(nama_item_lhu,' [ ',nama_equipment,']') as nama_kompetensi");
		$this->db->join('ol_logbook_lhu oll', 'oll.id_lhu=olp.id_lhu','left');
		$this->db->join('ol_logbook_item_lhu olil', 'olil.id_item_lhu=olp.id_item_lhu','left');
		$this->db->join('ol_equipment oe', 'oe.id_equipment=olil.id_equipment','left');
		$this->db->join('ol_unit ou', 'ou.id_unit=oe.id_unit','left');
		$this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
		$this->db->where("ou.id_instansi",$lpd['id_instansi']);
		if(!empty($lpd['i_mutu'])){
			$idlh = explode(',', $lpd['i_mutu']);
			$this->db->where_in("olp.id_lhu_detil",$idlh); // nama_lhu - tgl_lhu
		}
		if(!empty($lpd['item_lhu'])){
			$idilhu = explode(',', $lpd['item_lhu']);
			$this->db->where_in("olil.id_item_lhu",$idilhu); // nama_item_lhu
		}
		$this->db->group_by('olp.id_item_lhu');
		$this->db->order_by('olil.id_equipment','asc');
		$q = $this->db->get_where('ol_logbook_lhu_detil olp',array('oll.barcode_pegawai'=>$lpd['barcode_pegawai']))->result_array();
//	echo $this->db->last_query();die();
	//print_r($q);die();
		return $q;
    }
	function ambil_lhu_pasien($id,$grup,$jml)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id); //id_laporan_tabel
		$idl = explode(',', $lpd['kompetensi']);
		$idc = explode(',', $lpd['bahan']);
		$ids = explode(',', $lpd['reject']);
		$this->db->select('*,SUM('.$jml.') as '.$jml);
		$this->db->join('ol_logbook ol', 'ol.id_logbook=olp.id_logbook','left');
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
		$this->db->join('kol_reject krj', 'krj.id_reject=olp.id_reject','left');
		$this->db->join('ol_bahan obh', 'obh.id_bahan=olp.id_bahan','left');
		$this->db->where('ol.tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where("ol.id_instansi",$lpd['id_instansi']);
		$this->db->where($jml.' >',0);
	//	$this->db->where("(olp.jml_bahan > 0 OR olp.jml_reject > 0)", NULL, FALSE);
		if(!empty($lpd['kompetensi'])){
			$this->db->where_in("nkk.id_kompetensi",$idl);
		}
		if(!empty($lpd['bahan'])){
			$this->db->where_in("olp.id_bahan",$idc);
		}
		if(!empty($lpd['reject'])){
			$this->db->where_in("olp.id_reject",$ids);
		}
		if(!empty($lpd['isi_kompetensi'])){
			$idlb = explode(',', $lpd['isi_kompetensi']);
			$this->db->where_in("ol.id_logbook",$idlb);
		}
		$this->db->group_by('olp.'.$grup);
/*		if($lpd['share_it'] == 0){
		$q = $this->db->get_where('ol_logbook_pasien olp',array('ol.id_logbooker'=>$this->session->id_pegawai))->result_array();
		}else{*/
		$q = $this->db->get_where('ol_logbook_pasien olp',array('ol.id_logbooker'=>$lpd['id_pegawai']))->result_array();			
//		}		
		return $q;
    }
	function ambil_data_bulan_bakhp($id,$grup,$jml)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
		$idl = explode(',', $lpd['kompetensi']);
		$idc = explode(',', $lpd['bahan']);
		$ids = explode(',', $lpd['reject']);
	//	$this->db->select("CONCAT(MONTH(tgl_logbook)),'-',(YEAR(tgl_logbook)) as year_month");
		$this->db->join('ol_logbook_pasien olp', 'olp.id_logbook_pasien=olpk.id_logbook_pasien','left');
		$this->db->join('ol_logbook ol', 'ol.id_logbook=olp.id_logbook','left');
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
		$this->db->join('ol_bahan obh', 'obh.id_bahan=olpk.id_bahan','left');
		$this->db->where('ol.tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where("ol.id_instansi",$lpd['id_instansi']);
		$this->db->where($jml.' >',0);
	//	$this->db->where("(olp.jml_bahan > 0 OR olp.jml_reject > 0)", NULL, FALSE);
		if(!empty($lpd['kompetensi'])){
			$this->db->where_in("nkk.id_kompetensi",$idl);
		}
		if(!empty($lpd['bahan'])){
			$this->db->where_in("olp.id_bahan",$idc);
		}
		if(!empty($lpd['reject'])){
			$this->db->where_in("olp.id_reject",$ids);
		}
		if(!empty($lpd['isi_kompetensi'])){
			$idlb = explode(',', $lpd['isi_kompetensi']);
			$this->db->where_in("ol.id_logbook",$idlb);
		}
		$this->db->group_by("MONTH(tgl_logbook)");
	//	$this->db->group_by($grup);
/*		if($lpd['share_it'] == 0){
		$q = $this->db->get_where('ol_logbook_pasien olp',array('ol.id_logbooker'=>$this->session->id_pegawai))->result_array();
		}else{*/
		$q = $this->db->get_where('ol_logbook_pakai olpk',array('ol.id_logbooker'=>$lpd['id_pegawai']))->result_array();			
//		}		
		return $q;
    }
	function ambil_data_bakhp($id,$grup,$jml)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
		$idl = explode(',', $lpd['kompetensi']);
		$idc = explode(',', $lpd['bahan']);
		$ids = explode(',', $lpd['reject']);
		$this->db->select('*,SUM('.$jml.') as '.$jml);
		$this->db->join('ol_logbook_pasien olp', 'olp.id_logbook_pasien=olpk.id_logbook_pasien','left');
		$this->db->join('ol_logbook ol', 'ol.id_logbook=olp.id_logbook','left');
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
		$this->db->join('ol_bahan obh', 'obh.id_bahan=olpk.id_bahan','left');
		$this->db->where('ol.tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where("ol.id_instansi",$lpd['id_instansi']);
		$this->db->where($jml.' >',0);
	//	$this->db->where("(olp.jml_bahan > 0 OR olp.jml_reject > 0)", NULL, FALSE);
		if(!empty($lpd['kompetensi'])){
			$this->db->where_in("nkk.id_kompetensi",$idl);
		}
		if(!empty($lpd['bahan'])){
			$this->db->where_in("olp.id_bahan",$idc);
		}
		if(!empty($lpd['reject'])){
			$this->db->where_in("olp.id_reject",$ids);
		}
		if(!empty($lpd['isi_kompetensi'])){
			$idlb = explode(',', $lpd['isi_kompetensi']);
			$this->db->where_in("ol.id_logbook",$idlb);
		}
		$this->db->group_by($grup);
/*		if($lpd['share_it'] == 0){
		$q = $this->db->get_where('ol_logbook_pasien olp',array('ol.id_logbooker'=>$this->session->id_pegawai))->result_array();
		}else{*/
		$q = $this->db->get_where('ol_logbook_pakai olpk',array('ol.id_logbooker'=>$lpd['id_pegawai']))->result_array();			
//		}		
		return $q;
    }
	function ambil_data_bulan_reject($id,$grup,$jml)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
		$idl = explode(',', $lpd['kompetensi']);
		$idc = explode(',', $lpd['bahan']);
		$ids = explode(',', $lpd['reject']);
	//	$this->db->select("CONCAT(MONTH(tgl_logbook)),'-',(YEAR(tgl_logbook)) as year_month");
		$this->db->join('ol_logbook_pasien olp', 'olp.id_logbook_pasien=olpk.id_logbook_pasien','left');
		$this->db->join('ol_logbook ol', 'ol.id_logbook=olp.id_logbook','left');
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
		$this->db->join('ol_bahan obh', 'obh.id_bahan=olpk.id_bahan','left');
		$this->db->join('kol_reject kre', 'kre.id_reject=olpk.id_reject','left');
		$this->db->where('ol.tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where("ol.id_instansi",$lpd['id_instansi']);
		$this->db->where($jml.' >',0);
	//	$this->db->where("(olp.jml_bahan > 0 OR olp.jml_reject > 0)", NULL, FALSE);
		if(!empty($lpd['kompetensi'])){
			$this->db->where_in("nkk.id_kompetensi",$idl);
		}
		if(!empty($lpd['bahan'])){
			$this->db->where_in("olp.id_bahan",$idc);
		}
		if(!empty($lpd['reject'])){
			$this->db->where_in("olp.id_reject",$ids);
		}
		if(!empty($lpd['isi_kompetensi'])){
			$idlb = explode(',', $lpd['isi_kompetensi']);
			$this->db->where_in("ol.id_logbook",$idlb);
		}
		$this->db->group_by("MONTH(tgl_logbook)");
	//	$this->db->group_by($grup);
/*		if($lpd['share_it'] == 0){
		$q = $this->db->get_where('ol_logbook_pasien olp',array('ol.id_logbooker'=>$this->session->id_pegawai))->result_array();
		}else{*/
		$q = $this->db->get_where('ol_logbook_reject olpk',array('ol.id_logbooker'=>$lpd['id_pegawai']))->result_array();			
//		}		
		return $q;
    }
	function ambil_data_reject($id,$grup,$jml)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
		$idl = explode(',', $lpd['kompetensi']);
		$idc = explode(',', $lpd['bahan']);
		$ids = explode(',', $lpd['reject']);
		$this->db->select('*,SUM('.$jml.') as '.$jml);
		$this->db->join('ol_logbook_pasien olp', 'olp.id_logbook_pasien=olpk.id_logbook_pasien','left');
		$this->db->join('ol_logbook ol', 'ol.id_logbook=olp.id_logbook','left');
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
		$this->db->join('ol_bahan obh', 'obh.id_bahan=olpk.id_bahan','left');
		$this->db->join('kol_reject kre', 'kre.id_reject=olpk.id_reject','left');
		$this->db->where('ol.tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where("ol.id_instansi",$lpd['id_instansi']);
		$this->db->where($jml.' >',0);
	//	$this->db->where("(olp.jml_bahan > 0 OR olp.jml_reject > 0)", NULL, FALSE);
		if(!empty($lpd['kompetensi'])){
			$this->db->where_in("nkk.id_kompetensi",$idl);
		}
		if(!empty($lpd['bahan'])){
			$this->db->where_in("olp.id_bahan",$idc);
		}
		if(!empty($lpd['reject'])){
			$this->db->where_in("olp.id_reject",$ids);
		}
		if(!empty($lpd['isi_kompetensi'])){
			$idlb = explode(',', $lpd['isi_kompetensi']);
			$this->db->where_in("ol.id_logbook",$idlb);
		}
		$this->db->group_by($grup);
/*		if($lpd['share_it'] == 0){
		$q = $this->db->get_where('ol_logbook_pasien olp',array('ol.id_logbooker'=>$this->session->id_pegawai))->result_array();
		}else{*/
		$q = $this->db->get_where('ol_logbook_reject olpk',array('ol.id_logbooker'=>$lpd['id_pegawai']))->result_array();			
//		}		
		return $q;
    }
	function ambil_lhu_pasien_wherein($first_date,$last_date,$idk,$grup)
	{
		$idx = explode(',', $idk);
		$this->db->select('*,SUM(jml_bahan) as jml_bahan,SUM(jml_reject) as jml_reject');
		$this->db->join('ol_logbook ol', 'ol.id_logbook=olp.id_logbook','left');
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
		$this->db->join('kol_reject krj', 'krj.id_reject=olp.id_reject','left');
		$this->db->join('ol_bahan obh', 'obh.id_bahan=olpk.id_bahan','left');
		$this->db->where_in("nkk.id_kompetensi",$idx);
		$this->db->where('ol.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$this->db->group_by('olp.'.$grup);
		$q = $this->db->get_where('ol_logbook_pasien olp',array('ol.id_logbooker'=>$this->session->id_pegawai))->result_array();
		return $q;
    }
	function ambil_lhu_wherein($first_date,$last_date,$idk)
	{
		$idx = explode(',', $idk);
		$this->db->join('ol_logbook_lhu ol', 'ol.id_lhu=olp.id_lhu','left');
		$this->db->where_in("olp.id_lhu",$idx);
		$this->db->where('ol.tgl_lhu BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$q = $this->db->get_where('ol_logbook_lhu_detil olp',array('ol.barcode_pegawai'=>$this->session->barcode_pegawai))->result_array();
		return $q;
    }
	function ambil_lhu($first_date,$last_date,$bp,$share,$i_mutu,$item_lhu)
	{
		$this->db->select('*,nama_item_lhu as nama_lhu');
		$this->db->join('ol_logbook_item_lhu olil', 'olil.id_item_lhu=olp.id_item_lhu','left');
		$this->db->join('ol_logbook_lhu ol', 'ol.id_lhu=olp.id_lhu','left');
		$this->db->where('ol.tgl_lhu BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		if($i_mutu == "" OR empty($i_mutu)){
		}else{
			$idlh = explode(',', $i_mutu);
			$this->db->where_in("olp.id_lhu",$idlh);
		}
		if($item_lhu == "" OR empty($item_lhu)){
		}else{
			$idilhu = explode(',', $item_lhu);
			$this->db->where_in("olil.id_item_lhu",$idilhu);
		}
		if($share == 0){
		$q = $this->db->get_where('ol_logbook_lhu_detil olp',array('ol.barcode_pegawai'=>$this->session->barcode_pegawai))->result_array();
		}else{
		$q = $this->db->get_where('ol_logbook_lhu_detil olp',array('ol.barcode_pegawai'=>$bp))->result_array();			
		}
		// echo $this->db->last_query();
		return $q;
    }
	function ambil_item_lhu_detil($id)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
		$this->db->select('*,nama_item_lhu as nama_lhu');
		$this->db->join('ol_logbook_item_lhu olil', 'olil.id_item_lhu=olp.id_item_lhu','left');
		$this->db->join('ol_logbook_lhu ol', 'ol.id_lhu=olp.id_lhu','left');
		$this->db->where('ol.tgl_lhu BETWEEN "'. $lpd['tgl_awal']. '" and "'. $lpd['tgl_akhir'].'"');
		if(!empty($lpd['i_mutu'])){
			$idlh = explode(',', $lpd['i_mutu']);
			$this->db->where_in("olp.id_lhu",$idlh);
		}
		if(!empty($lpd['item_lhu'])){
			$idilhu = explode(',', $lpd['item_lhu']);
			$this->db->where_in("olil.id_item_lhu",$idilhu);
		}
		if(!empty($lpd['id_lhu'])){
			$idlb = explode(',', $lpd['id_lhu']);
			$this->db->where_in("ol.id_logbook",$idlb);
		}
/*		if($share == 0){
		$q = $this->db->get_where('ol_logbook_lhu_detil olp',array('ol.barcode_pegawai'=>$this->session->barcode_pegawai))->result_array();
		}else{*/
		$q = $this->db->get_where('ol_logbook_lhu_detil olp',array('ol.barcode_pegawai'=>$bp))->result_array();			
	//	}
		// echo $this->db->last_query();
		return $q;
    }
	function ambil_lhu_logebook_wherein($first_date,$last_date,$idk)
	{
		$idx = explode(',', $idk);
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
		$this->db->where_in("nkk.id_kompetensi",$idx);
		$this->db->where('ol.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$q = $this->db->get_where('ol_logbook ol',array('ol.id_logbooker'=>$this->session->id_pegawai))->result_array();
		return $q;
    }
	function ambil_lhu_logebook($first_date,$last_date,$idk)
	{
		$idx = explode(',', $idk);
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
		$this->db->where('ol.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$q = $this->db->get_where('ol_logbook ol',array('ol.id_logbooker'=>$this->session->id_pegawai))->result_array();
		return $q;
    }
	function ambil_bulan_laporan_logbook($id)
	{		
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id); //id_laporan_tabel
		$idl = explode(',', $lpd['kompetensi']);
		$idlb = explode(',', $lpd['isi_kompetensi']);
	//	$this->db->select("CONCAT(MONTH(tgl_logbook)),'-',(YEAR(tgl_logbook)) as tgl_logbook");
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
		$this->db->where('ol.tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where("ol.id_instansi",$lpd['id_instansi']);
		$this->db->where("ol.jml_logbook >",0);
		if(!empty($lpd['kompetensi'])){
			$this->db->where_in("nkk.id_kompetensi",$idl);
		}
		if(!empty($lpd['isi_kompetensi'])){
			$idlb = explode(',', $lpd['isi_kompetensi']);
			$this->db->where_in("ol.id_logbook",$idlb);
		}
//	if($lpd['share_it'] == 0){
//	$q = $this->db->get_where('ol_logbook ol',array('ol.id_logbooker'=>$this->session->id_pegawai,'ol.id_instansi'=>$lpd['id_instansi']))->result_array();
//	}else{
	//	$this->db->group_by('tgl_logbook');
		$this->db->group_by("MONTH(tgl_logbook)");
	$q = $this->db->get_where('ol_logbook ol',array('ol.id_logbooker'=>$lpd['id_pegawai']))->result_array();	
//	}echo $this->db->last_query();
	
		return $q;
    }
	function print_logbook_laporan_bulanane($first_date,$id,$peg)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
		$idl = explode(',', $lpd['kompetensi']);
		$idlb = explode(',', $lpd['isi_kompetensi']);
		$this->db->select('*,SUM(lp.jml_logbook) as jumlaha,lp.id_kewenangan,krw.id_kompetensi');
		$this->db->join('nkr_kewenangan krw', 'krw.id_kewenangan=lp.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nk', 'nk.id_kompetensi=krw.id_kompetensi','left');
		$this->db->where("lp.id_instansi",$lpd['id_instansi']);
	//	$this->db->where("ol.jml_logbook >",0);
		if(!empty($lpd['kompetensi'])){
			$this->db->where_in("nk.id_kompetensi",$idl);
		}
		if(!empty($lpd['isi_kompetensi'])){
			$idlb = explode(',', $lpd['isi_kompetensi']);
			$this->db->where_in("lp.id_logbook",$idlb);
		}
		$this->db->where("DATE_FORMAT(lp.tgl_logbook,'%Y-%m')", $first_date);
		$this->db->group_by('krw.id_kompetensi');
		$q = $this->db->get_where('ol_logbook lp',array('lp.id_logbooker'=>$peg))->result_array();	
	//	print_r($q);die();
		return $q;
	}
    function jumlah_record_logbook_laporan_kompetensi($id_pegawai,$tglenya,$id_kewenangan,$ir)
    {
    	$this->db->join('nkr_kewenangan krw', 'krw.id_kewenangan=lp.id_kewenangan','left');
    //	$this->db->join('nkr_kompetensi krp', 'krp.id_kompetensi=krw.id_kompetensi','left');
		$this->db->where('tgl_logbook',$tglenya);
		$this->db->where("id_logbooker", $id_pegawai);
		$this->db->where("krw.id_kompetensi", $id_kewenangan);
		if($ir > 0){
		$this->db->where("lp.id_instansi", $ir);
		}
        $query = $this->db->select("COUNT(*) as num")->get_where('ol_logbook lp');
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
    }
	function total_record_logbook_laporan_kompetensi($id_pegawai,$tglenya,$id_kewenangan,$ir){
		$this->db->select('SUM(jml_logbook) as jumlahe');
		$this->db->join('nkr_kewenangan krw', 'krw.id_kewenangan=lp.id_kewenangan','left');
		$this->db->where('tgl_logbook',$tglenya);
		$this->db->where("id_logbooker", $id_pegawai);
		$this->db->where("krw.id_kompetensi", $id_kewenangan);
		if($ir > 0){
		$this->db->where("lp.id_instansi", $ir);
		}
		$q = $this->db->get_where('ol_logbook lp');
		return $q->result_array();
	}
	function ambil_lhu_logbook($id)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id); //id_laporan_tabel
		$idl = explode(',', $lpd['kompetensi']);
		$idlb = explode(',', $lpd['isi_kompetensi']);
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
		$this->db->where('ol.tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where("ol.id_instansi",$lpd['id_instansi']);
		$this->db->where("ol.jml_logbook >",0);
		if(!empty($lpd['kompetensi'])){
			$this->db->where_in("nkk.id_kompetensi",$idl);
		}
		if(!empty($lpd['isi_kompetensi'])){
			$idlb = explode(',', $lpd['isi_kompetensi']);
			$this->db->where_in("ol.id_logbook",$idlb);
		}
//	if($lpd['share_it'] == 0){
//	$q = $this->db->get_where('ol_logbook ol',array('ol.id_logbooker'=>$this->session->id_pegawai,'ol.id_instansi'=>$lpd['id_instansi']))->result_array();
//	}else{
	$q = $this->db->get_where('ol_logbook ol',array('ol.id_logbooker'=>$lpd['id_pegawai']))->result_array();	
//	}echo $this->db->last_query();
	
		return $q;
    }
	function ambil_lhu_logbook_wherein($first_date,$last_date,$idk)
	{
		$idx = explode(',', $idk);
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
		$this->db->where_in("nkk.id_kompetensi",$idx);
		$this->db->where('ol.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$q = $this->db->get_where('ol_logbook ol',array('ol.id_logbooker'=>$this->session->id_pegawai))->result_array();
		return $q;
    }
    function jumlah_record_logbook_kewenangan($id_pegawai,$tglenya,$id_kewenangan,$ir,$pxe)    //igd.php untuk menampilkan jumlah antrian di igd saja
    {
    	$this->db->join('nkr_kewenangan krw', 'krw.id_kewenangan=lp.id_kewenangan','left');
		$this->db->where('tgl_logbook',$tglenya);
		$this->db->where("id_logbooker", $id_pegawai);
		$this->db->where("lp.id_kewenangan", $id_kewenangan);
		if($ir > 0){
		$this->db->where("lp.id_instansi", $ir);
		}
		if($pxe > 0){
		$this->db->where("krw.id_kompetensi", $pxe);
		}
        $query = $this->db->select("COUNT(*) as num")->get_where('ol_logbook lp');
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
    }
	function total_record_logbook_kewenangan($id_pegawai,$tglenya,$id_kewenangan,$ir,$pxe){
		$this->db->select('SUM(jml_logbook) as jumlahe');
		$this->db->join('nkr_kewenangan krw', 'krw.id_kewenangan=lp.id_kewenangan','left');
		$this->db->where('tgl_logbook',$tglenya);
		$this->db->where("id_logbooker", $id_pegawai);
		$this->db->where("lp.id_kewenangan", $id_kewenangan);
		if($ir > 0){
		$this->db->where("lp.id_instansi", $ir);
		}
		if($pxe > 0){
		$this->db->where("krw.id_kompetensi", $pxe);
		}
		$q = $this->db->get_where('ol_logbook lp');
		return $q->result_array();
	}
    function jumlah_record_logbook_kompetensi($id_pegawai,$tglenya,$id_kewenangan,$ir,$pxe)
    {
    	$this->db->join('nkr_kewenangan krw', 'krw.id_kewenangan=lp.id_kewenangan','left');
    //	$this->db->join('nkr_kompetensi krp', 'krp.id_kompetensi=krw.id_kompetensi','left');
		$this->db->where('tgl_logbook',$tglenya);
		$this->db->where("id_logbooker", $id_pegawai);
		$this->db->where("krw.id_kompetensi", $id_kewenangan);
		if($ir > 0){
		$this->db->where("lp.id_instansi", $ir);
		}
		if($pxe > 0){
		$this->db->where("krw.id_kompetensi", $pxe);
		}
        $query = $this->db->select("COUNT(*) as num")->get_where('ol_logbook lp');
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
    }
	function total_record_logbook_kompetensi($id_pegawai,$tglenya,$id_kewenangan,$ir,$pxe){
		$this->db->select('SUM(jml_logbook) as jumlahe');
		$this->db->join('nkr_kewenangan krw', 'krw.id_kewenangan=lp.id_kewenangan','left');
		$this->db->where('tgl_logbook',$tglenya);
		$this->db->where("id_logbooker", $id_pegawai);
		$this->db->where("krw.id_kompetensi", $id_kewenangan);
		if($ir > 0){
		$this->db->where("lp.id_instansi", $ir);
		}
		if($pxe > 0){
		$this->db->where("krw.id_kompetensi", $pxe);
		}
		$q = $this->db->get_where('ol_logbook lp');
		return $q->result_array();
	}
	function edit_user(){
		$id_user = $this->session->id_user;
		$username = $this->input->post('username');
		$username_lama = $this->input->post('username_lama');
		if($username==""){
			$username = $username_lama;
		}else{
			$username = strtolower($username);
			$username = str_replace(' ', '-', $username);
			$username = preg_replace('/[^A-Za-z0-9\-]/', '', $username);
		}
		$password = $this->input->post('password');
		$passlama = $this->input->post('password_lama');
		if($password==""){
			$passworde = $passlama;
		}else{
			$passworde = hash("sha512", md5($password));
		}
		$data_pendaftaran = array(
			'username' => $username,
			'password' => $passworde,
		);
		$this->db->where('id_user',$id_user);
		$this->db->update('ol_user', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function edit_pegawai($pic){
		$id_pegawai = $this->input->post('id_pegawai');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$tgl_lahir = date('Y-m-d', strtotime($tgl_lahir));
		$data_pendaftaran = array(
			'email' =>$this->input->post('email'),
			'nama_pegawai' => $this->input->post('nama_pegawai'),
			'tipe_pegawai' =>$this->input->post('tipe_pegawai'),
			'no_hp' =>$this->input->post('no_hp'),
			'jk' =>$this->input->post('jk'),
			'nik' => $this->input->post('nik'),
			'nip' => $this->input->post('nip'),
			'no_profesi' => $this->input->post('no_profesi'),
			'tmp_lahir' => $this->input->post('tmp_lahir'),
			'id_prov' => $this->input->post('id_prov'),
			'id_kab' => $this->input->post('id_kab'),
			'id_kel' => $this->input->post('id_kel'),
			'id_kec' => $this->input->post('id_kec'),
			'tgl_lahir' => $tgl_lahir,
			'id_status_kawin' => $this->input->post('id_status_kawin'),
			'id_pendidikan' => $this->input->post('id_pendidikan'),
			'id_jabatan_fungsional' => $this->input->post('id_jabatan_fungsional'),
			'id_agama' => $this->input->post('id_agama'),
			'alamat' => $this->input->post('alamat'),
			'foto' =>$pic
		);
		$this->db->where('id_pegawai',$id_pegawai);
		$this->db->update('ol_pegawai', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function edit_signature_pegawai($pic){
		$id_pegawai = $this->input->post('id_pegawai');
		$data_pendaftaran = array(
			'ttd_pegawai' =>$pic
		);
		$this->db->where('id_pegawai',$id_pegawai);
		$this->db->update('ol_pegawai', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function edit_pegawai_no_pic(){
		$id_pegawai = $this->input->post('id_pegawai');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$tgl_lahir = date('Y-m-d', strtotime($tgl_lahir));
		$data_pendaftaran = array(
			'email' =>$this->input->post('email'),
			'nama_pegawai' => $this->input->post('nama_pegawai'),
			'tipe_pegawai' =>$this->input->post('tipe_pegawai'),
			'no_hp' =>$this->input->post('no_hp'),
			'jk' =>$this->input->post('jk'),
			'nik' => $this->input->post('nik'),
			'nip' => $this->input->post('nip'),
			'no_profesi' => $this->input->post('no_profesi'),
			'tmp_lahir' => $this->input->post('tmp_lahir'),
			'id_prov' => $this->input->post('id_prov'),
			'id_kab' => $this->input->post('id_kab'),
			'id_kel' => $this->input->post('id_kel'),
			'id_kec' => $this->input->post('id_kec'),
			'tgl_lahir' => $tgl_lahir,
			'id_status_kawin' => $this->input->post('id_status_kawin'),
			'id_pendidikan' => $this->input->post('id_pendidikan'),
			'id_jabatan_fungsional' => $this->input->post('id_jabatan_fungsional'),
			'id_agama' => $this->input->post('id_agama'),
			'alamat' => $this->input->post('alamat'),
		);
		$this->db->where('id_pegawai',$id_pegawai);
		$this->db->update('ol_pegawai', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function berkas_pribadi_all()
	{
    $ignore = array(15);
		$fields = "*,
		if (b.tgl_a_berkas = '0000-00-00' ,'TIDAK ADA',if (b.tgl_a_berkas = NULL ,'TIDAK ADA',DATE_FORMAT(b.tgl_a_berkas,'%d-%m-%Y'))) as tgl_a_berkas,
		if (b.tgl_b_berkas = '0000-00-00' ,'TIDAK ADA',if (b.tgl_b_berkas = NULL ,'TIDAK ADA',DATE_FORMAT(b.tgl_b_berkas,'%d-%m-%Y'))) as tgl_b_berkas,
		tgl_a_berkas as tgl_sort
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
				$this->db->where("b.id_kategori_berkas >", 13);
        $this->db->where_not_in('b.id_kategori_berkas', $ignore);
				$this->db->where("b.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir); 
	    $this->db->from('ol_berkas b');
		$this->db->join('ol_berkas_kategori kb', 'kb.id_berkas_kategori=b.id_kategori_berkas','left');
		$this->db->where("b.id_kategori_berkas >", 13);
    $this->db->where_not_in('b.id_kategori_berkas', $ignore);
		$this->db->where("b.id_pegawai", $this->session->id_pegawai);
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
				$this->db->where("b.id_kategori_berkas >", 13);
        $this->db->where_not_in('b.id_kategori_berkas', $ignore);
				$this->db->where("b.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}
	    $this->db->from('ol_berkas b');
		$this->db->join('ol_berkas_kategori kb', 'kb.id_berkas_kategori=b.id_kategori_berkas','left');
		$this->db->where("b.id_kategori_berkas >", 13);
    $this->db->where_not_in('b.id_kategori_berkas', $ignore);
		$this->db->where("b.id_pegawai", $this->session->id_pegawai);
		$q = $this->db->get_where();
		$jml_filter = $q->row()->num;
/* 		$kondisi=array('ol_berkas_kategori.id_berkas_kategori >'=>11, 'ol_berkas.id_pegawai'=>$this->session->id_pegawai);
		$jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_berkas',$kondisi,'ol_berkas_kategori','id_kategori_berkas');*/	
		$jml = $this->m_umum->jumlah_record_tabel('ol_berkas');
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_berkas_file($id){
		$kode = $this->m_rancak->kode_generator(15,'');
		if(empty($id)){
			$data_kewenangan = array(
				'id_pegawai' => $this->input->post('id_pegawai'),
				'nama_berkas' => $this->input->post('nama_berkas'),
				'id_kategori_berkas' => $this->input->post('id_kategori_berkas'),
				'no_berkas' => $this->input->post('no_berkas'),
				'barcode_berkas' => $kode
			);			
		}else{
			$data_kewenangan = array(
				'id_pegawai' => $this->input->post('id_pegawai'),
				'nama_berkas' => $this->input->post('nama_berkas'),
				'id_kategori_berkas' => $this->input->post('id_kategori_berkas'),
				'no_berkas' => $this->input->post('no_berkas'),
				'barcode_berkas' => $kode,
				'link_berkas' => $id
			);
		}
		return $this->db->insert('ol_berkas', $data_kewenangan);
	}
	function edit_berkas_file($id){
		$id_berkas = $this->input->post('id_berkas');
		if(empty($id)){
			$data_pendaftaran = array(
				'nama_berkas' => $this->input->post('nama_berkas'),
				'id_kategori_berkas' => $this->input->post('id_kategori_berkas'),
				'no_berkas' => $this->input->post('no_berkas')
			);
		}else{
			$user_pic=$this->m_umum->ambil_data('ol_berkas','id_berkas',$id_berkas);
			if(!empty($user_pic['link_berkas'])){
				$cek_file=FCPATH.'assets/berkas/ol/'.$user_pic['link_berkas'];
				if(file_exists($cek_file)){
					unlink(FCPATH."assets/berkas/ol/".$user_pic['link_berkas']);
				}
			}
			$data_pendaftaran = array(
				'nama_berkas' => $this->input->post('nama_berkas'),
				'id_kategori_berkas' => $this->input->post('id_kategori_berkas'),
				'no_berkas' => $this->input->post('no_berkas'),
				'link_berkas' => $id
			);
		}
		$this->db->where('id_berkas',$id_berkas);
		$this->db->update('ol_berkas', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function berkas_imut_all()
	{
		$fields = "*,
		if (b.tgl_a_berkas = '0000-00-00' ,'TIDAK ADA',if (b.tgl_a_berkas = NULL ,'TIDAK ADA',DATE_FORMAT(b.tgl_a_berkas,'%d-%m-%Y'))) as tgl_a_berkas,
		if (b.tgl_b_berkas = '0000-00-00' ,'TIDAK ADA',if (b.tgl_b_berkas = NULL ,'TIDAK ADA',DATE_FORMAT(b.tgl_b_berkas,'%d-%m-%Y'))) as tgl_b_berkas,
		tgl_a_berkas as tgl_sort
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
		$this->db->where("b.id_kategori_berkas", 12);
		$this->db->where("b.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir); 
	    $this->db->from('ol_berkas b');
		$this->db->join('ol_berkas_kategori kb', 'kb.id_berkas_kategori=b.id_kategori_berkas','left');
		$this->db->where("b.id_kategori_berkas", 12);
		$this->db->where("b.id_pegawai", $this->session->id_pegawai);
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
		$this->db->where("b.id_kategori_berkas", 12);
		$this->db->where("b.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}
	    $this->db->from('ol_berkas b');
		$this->db->join('ol_berkas_kategori kb', 'kb.id_berkas_kategori=b.id_kategori_berkas','left');
		$this->db->where("b.id_kategori_berkas", 12);
		$this->db->where("b.id_pegawai", $this->session->id_pegawai);
		$q = $this->db->get_where();
		$jml_filter = $q->row()->num;
/* 		$kondisi=array('ol_berkas_kategori.id_berkas_kategori >'=>11, 'ol_berkas.id_pegawai'=>$this->session->id_pegawai);
		$jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_berkas',$kondisi,'ol_berkas_kategori','id_kategori_berkas');*/	
		$jml = $this->m_umum->jumlah_record_tabel('ol_berkas');
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_berkas_imut_file($id){
		$kode = $this->m_rancak->kode_generator(15,'');
		if(empty($id)){
			$data_kewenangan = array(
				'id_pegawai' => $this->input->post('id_pegawai'),
				'nama_berkas' => $this->input->post('nama_berkas'),
				'id_kategori_berkas' => 12,
				'no_berkas' => $this->input->post('no_berkas'),
				'barcode_berkas' => $kode
			);			
		}else{
			$data_kewenangan = array(
				'id_pegawai' => $this->input->post('id_pegawai'),
				'nama_berkas' => $this->input->post('nama_berkas'),
				'id_kategori_berkas' => 12,
				'no_berkas' => $this->input->post('no_berkas'),
				'barcode_berkas' => $kode,
				'link_berkas' => $id
			);
		}
		return $this->db->insert('ol_berkas', $data_kewenangan);
	}
	function edit_berkas_imut_file($id){
		$id_berkas = $this->input->post('id_berkas');
		if(empty($id)){
			$data_pendaftaran = array(
				'nama_berkas' => $this->input->post('nama_berkas'),
				'no_berkas' => $this->input->post('no_berkas')
			);
		}else{
			$user_pic=$this->m_umum->ambil_data('ol_berkas','id_berkas',$id_berkas);
			if(!empty($user_pic['link_berkas'])){
				$cek_file=FCPATH.'assets/berkas/ol/'.$user_pic['link_berkas'];
				if(file_exists($cek_file)){
					unlink(FCPATH."assets/berkas/ol/".$user_pic['link_berkas']);
				}
			}
			$data_pendaftaran = array(
				'nama_berkas' => $this->input->post('nama_berkas'),
				'no_berkas' => $this->input->post('no_berkas'),
				'link_berkas' => $id
			);
		}
		$this->db->where('id_berkas',$id_berkas);
		$this->db->update('ol_berkas', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function berkas_ijasah_all()
	{
		$fields = "*,
		if (b.tgl_a_berkas = '0000-00-00' ,'TIDAK ADA',if (b.tgl_a_berkas = NULL ,'TIDAK ADA',DATE_FORMAT(b.tgl_a_berkas,'%d-%m-%Y'))) as tgl_a_berkas,
		if (b.tgl_b_berkas = '0000-00-00' ,'TIDAK ADA',if (b.tgl_b_berkas = NULL ,'TIDAK ADA',DATE_FORMAT(b.tgl_b_berkas,'%d-%m-%Y'))) as tgl_b_berkas,
		tgl_a_berkas as tgl_sort
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
				$this->db->where("b.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir); 
	    $this->db->from('ol_berkas b');
		$this->db->join('kol_pendidikan kp', 'kp.id_pendidikan=b.id_pendidikan','left');
		$this->db->where("b.id_kategori_berkas", 7);
		$this->db->where("b.id_pegawai", $this->session->id_pegawai);
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
				$this->db->where("b.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}
	    $this->db->from('ol_berkas b');
		$this->db->join('kol_pendidikan kp', 'kp.id_pendidikan=b.id_pendidikan','left');
		$this->db->where("b.id_kategori_berkas", 7);
		$this->db->where("b.id_pegawai", $this->session->id_pegawai);
		$q = $this->db->get_where();
		$jml_filter = $q->row()->num;
/* 		$kondisi=array('ol_berkas_kategori.id_berkas_kategori'=>7, 'ol_berkas.id_pegawai'=>$this->session->id_pegawai);
		$jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_berkas',$kondisi,'ol_berkas_kategori','id_kategori_berkas');	*/
		$jml = $this->m_umum->jumlah_record_tabel('ol_berkas');
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_berkas_file_ijasah($id){
		$tgl_b_berkas = $this->input->post('tgl_b_berkas');
		$tgl_b_berkas = date('Y-m-d', strtotime($tgl_b_berkas));
		$kode = $this->m_rancak->kode_generator(15,'');
		if(empty($id)){
			$data_kewenangan = array(
				'id_pegawai' => $this->input->post('id_pegawai'),
				'nama_berkas' => $this->input->post('nama_berkas'),
				'id_kategori_berkas' => 7,
				'tgl_b_berkas' => $tgl_b_berkas,
				'barcode_berkas' => $kode,
				'no_berkas' => $this->input->post('no_berkas'),
				'id_pendidikan' =>$this->input->post('id_pendidikan')

			);
		}else{
			$data_kewenangan = array(
				'id_pegawai' => $this->input->post('id_pegawai'),
				'nama_berkas' => $this->input->post('nama_berkas'),
				'id_kategori_berkas' => 7,
				'tgl_b_berkas' => $tgl_b_berkas,
				'barcode_berkas' => $kode,
				'no_berkas' => $this->input->post('no_berkas'),
				'link_berkas' => $id,
				'id_pendidikan' =>$this->input->post('id_pendidikan')

			);
		}
		return $this->db->insert('ol_berkas', $data_kewenangan);
	}
	function edit_berkas_file_ijasah($id){
		$id_berkas = $this->input->post('id_berkas');
		$tgl_b_berkas = $this->input->post('tgl_b_berkas');
		$tgl_b_berkas = date('Y-m-d', strtotime($tgl_b_berkas));
		if(empty($id)){
			$data_pendaftaran = array(
				'nama_berkas' => $this->input->post('nama_berkas'),
				'tgl_b_berkas' => $tgl_b_berkas,
				'no_berkas' => $this->input->post('no_berkas'),
				'id_pendidikan' =>$this->input->post('id_pendidikan')
			);
		}else{
			$user_pic=$this->m_umum->ambil_data('ol_berkas','id_berkas',$id_berkas);
			if(!empty($user_pic['link_berkas'])){
				$cek_file=FCPATH.'assets/berkas/ol/'.$user_pic['link_berkas'];
				if(file_exists($cek_file)){
					unlink(FCPATH."assets/berkas/ol/".$user_pic['link_berkas']);
				}
			}			
			$data_pendaftaran = array(
				'nama_berkas' => $this->input->post('nama_berkas'),
				'tgl_b_berkas' => $tgl_b_berkas,
				'no_berkas' => $this->input->post('no_berkas'),
				'id_pendidikan' =>$this->input->post('id_pendidikan'),
				'link_berkas' => $id
			);
		}
		$this->db->where('id_berkas',$id_berkas);
		$this->db->update('ol_berkas', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function berkas_pelatihan_all()
	{
		$fields = "*,
		if (b.tgl_a_berkas = '0000-00-00' ,'TIDAK ADA',if (b.tgl_a_berkas = NULL ,'TIDAK ADA',DATE_FORMAT(b.tgl_a_berkas,'%d-%m-%Y'))) as tgl_a_berkas,
		if (b.tgl_b_berkas = '0000-00-00' ,'TIDAK ADA',if (b.tgl_b_berkas = NULL ,'TIDAK ADA',DATE_FORMAT(b.tgl_b_berkas,'%d-%m-%Y'))) as tgl_b_berkas, 
		tgl_a_berkas as tgl_sort
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
				$this->db->where("b.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir); 
	    $this->db->from('ol_berkas b');
		$this->db->join('ol_berkas_kategori kb', 'kb.id_berkas_kategori=b.id_kategori_berkas','left');
		$this->db->join('ol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=b.id_kategori_pelatihan','left');
		$this->db->where("kunci", 1);
		$this->db->where("b.id_pegawai", $this->session->id_pegawai);
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
				$this->db->where("b.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}
	    $this->db->from('ol_berkas b');
		$this->db->join('ol_berkas_kategori kb', 'kb.id_berkas_kategori=b.id_kategori_berkas','left');
		$this->db->join('ol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=b.id_kategori_pelatihan','left');
		$this->db->where("kunci", 1);
		$this->db->where("b.id_pegawai", $this->session->id_pegawai);
		$q = $this->db->get_where();
		$jml_filter = $q->row()->num;
/* 		$kondisi=array('ol_berkas_kategori.kunci'=>1, 'ol_berkas.id_pegawai'=>$this->session->id_pegawai);
		$jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_berkas',$kondisi,'ol_berkas_kategori','id_kategori_berkas');	*/
		$jml = $this->m_umum->jumlah_record_tabel('ol_berkas');
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_berkas_file_pelatihan($id){
		$tgl_a_berkas = $this->input->post('tgl_a_berkas');
		$tgl_a_berkas = date('Y-m-d', strtotime($tgl_a_berkas));
		$tgl_b_berkas = $this->input->post('tgl_b_berkas');
		$tgl_b_berkas = date('Y-m-d', strtotime($tgl_b_berkas));
		$kode = $this->m_rancak->kode_generator(15,'');
		if(empty($id)){
			$data_kewenangan = array(
				'id_pegawai' => $this->input->post('id_pegawai'),
				'nama_berkas' => $this->input->post('nama_berkas'),
				'id_kategori_berkas' => $this->input->post('id_kategori_berkas'),
				'tgl_a_berkas' => $tgl_a_berkas,
				'tgl_b_berkas' => $tgl_b_berkas,
				'barcode_berkas' => $kode,
				'penyelenggara' => $this->input->post('penyelenggara'),
				'kredit' => $this->input->post('kredit'),
				'no_sertifikat' => $this->input->post('no_sertifikat'),
				'id_kategori_pelatihan' =>$this->input->post('id_kategori_pelatihan')

			);
		}else{
			$data_kewenangan = array(
				'id_pegawai' => $this->input->post('id_pegawai'),
				'nama_berkas' => $this->input->post('nama_berkas'),
				'id_kategori_berkas' => $this->input->post('id_kategori_berkas'),
				'tgl_a_berkas' => $tgl_a_berkas,
				'tgl_b_berkas' => $tgl_b_berkas,
				'barcode_berkas' => $kode,
				'penyelenggara' => $this->input->post('penyelenggara'),
				'kredit' => $this->input->post('kredit'),
				'no_sertifikat' => $this->input->post('no_sertifikat'),
				'link_berkas' => $id,
				'id_kategori_pelatihan' =>$this->input->post('id_kategori_pelatihan')

			);
		}
		return $this->db->insert('ol_berkas', $data_kewenangan);
	}
	function edit_berkas_file_pelatihan($id){
		$id_berkas = $this->input->post('id_berkas');
		$tgl_a_berkas = $this->input->post('tgl_a_berkas');
		$tgl_a_berkas = date('Y-m-d', strtotime($tgl_a_berkas));
		$tgl_b_berkas = $this->input->post('tgl_b_berkas');
		$tgl_b_berkas = date('Y-m-d', strtotime($tgl_b_berkas));
		if(empty($id)){
			$data_pendaftaran = array(
				'nama_berkas' => $this->input->post('nama_berkas'),
				'id_kategori_berkas' => $this->input->post('id_kategori_berkas'),
				'tgl_a_berkas' => $tgl_a_berkas,
				'tgl_b_berkas' => $tgl_b_berkas,
				'penyelenggara' => $this->input->post('penyelenggara'),
				'kredit' => $this->input->post('kredit'),
				'no_sertifikat' => $this->input->post('no_sertifikat'),
				'id_kategori_pelatihan' =>$this->input->post('id_kategori_pelatihan')
			);
		}else{
		$user_pic=$this->m_umum->ambil_data('ol_berkas','id_berkas',$id_berkas);			
			if(!empty($user_pic['link_berkas'])){
				$cek_file=FCPATH.'assets/berkas/ol/'.$user_pic['link_berkas'];
				if(file_exists($cek_file)){
					unlink(FCPATH."assets/berkas/ol/".$user_pic['link_berkas']);
				}
			}
			$data_pendaftaran = array(
				'nama_berkas' => $this->input->post('nama_berkas'),
				'id_kategori_berkas' => $this->input->post('id_kategori_berkas'),
				'tgl_a_berkas' => $tgl_a_berkas,
				'tgl_b_berkas' => $tgl_b_berkas,
				'penyelenggara' => $this->input->post('penyelenggara'),
				'kredit' => $this->input->post('kredit'),
				'no_sertifikat' => $this->input->post('no_sertifikat'),
				'id_kategori_pelatihan' =>$this->input->post('id_kategori_pelatihan'),
				'link_berkas' => $id
			);
		}
		$this->db->where('id_berkas',$id_berkas);
		$this->db->update('ol_berkas', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function berkas_str_all()
	{
		$fields = "*,
		if (b.tgl_a_berkas = '0000-00-00' ,'TIDAK ADA',if (b.tgl_a_berkas = NULL ,'TIDAK ADA',DATE_FORMAT(b.tgl_a_berkas,'%d-%m-%Y'))) as tgl_a_berkas,
		if (b.tgl_b_berkas = '0000-00-00' ,'TIDAK ADA',if (b.tgl_b_berkas = NULL ,'TIDAK ADA',DATE_FORMAT(b.tgl_b_berkas,'%d-%m-%Y'))) as tgl_b_berkas,
		tgl_a_berkas as tgl_sort
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
				$this->db->where("b.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir); 
	    $this->db->from('ol_berkas b');
		$this->db->join('ol_berkas_kategori kb', 'kb.id_berkas_kategori=b.id_kategori_berkas','left');
		$this->db->join('ol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=b.id_kategori_pelatihan','left');
		$this->db->where("kunci", 0);
		$this->db->where("b.id_pegawai", $this->session->id_pegawai);
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
				$this->db->where("b.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}
	    $this->db->from('ol_berkas b');
		$this->db->join('ol_berkas_kategori kb', 'kb.id_berkas_kategori=b.id_kategori_berkas','left');
		$this->db->join('ol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=b.id_kategori_pelatihan','left');
		$this->db->where("kunci", 0);
		$this->db->where("b.id_pegawai", $this->session->id_pegawai);
		$q = $this->db->get_where();
		$jml_filter = $q->row()->num;
/* 		$kondisi=array('ol_berkas_kategori.kunci'=>0, 'ol_berkas.id_pegawai'=>$this->session->id_pegawai);
		$jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_berkas',$kondisi,'ol_berkas_kategori','id_kategori_berkas');	*/
		$jml = $this->m_umum->jumlah_record_tabel('ol_berkas');
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_berkas_file_surat_ijin($id){
		$tgl_a_berkas = $this->input->post('tgl_a_berkas');
		$tgl_a_berkas = date('Y-m-d', strtotime($tgl_a_berkas));
		$tgl_b_berkas = $this->input->post('tgl_b_berkas');
		$tgl_b_berkas = date('Y-m-d', strtotime($tgl_b_berkas));
		$kode = $this->m_rancak->kode_generator(15,'');
		if(empty($id)){
			$data_kewenangan = array(
				'id_pegawai' => $this->input->post('id_pegawai'),
				'nama_berkas' => $this->input->post('nama_berkas'),
				'id_kategori_berkas' => $this->input->post('id_kategori_berkas'),
				'lifetime_berkas' => $this->input->post('lifetime_berkas'),
				'tgl_a_berkas' => $tgl_a_berkas,
				'tgl_b_berkas' => $tgl_b_berkas,
				'barcode_berkas' => $kode,
				'no_berkas' => $this->input->post('no_berkas')

			);
		}else{
			$data_kewenangan = array(
				'id_pegawai' => $this->input->post('id_pegawai'),
				'nama_berkas' => $this->input->post('nama_berkas'),
				'id_kategori_berkas' => $this->input->post('id_kategori_berkas'),
				'lifetime_berkas' => $this->input->post('lifetime_berkas'),
				'tgl_a_berkas' => $tgl_a_berkas,
				'tgl_b_berkas' => $tgl_b_berkas,
				'barcode_berkas' => $kode,
				'no_berkas' => $this->input->post('no_berkas'),
				'link_berkas' => $id

			);
		}
		return $this->db->insert('ol_berkas', $data_kewenangan);
	}
	function edit_berkas_file_surat_ijin($id){
		$id_berkas = $this->input->post('id_berkas');
		$tgl_a_berkas = $this->input->post('tgl_a_berkas');
		$tgl_a_berkas = date('Y-m-d', strtotime($tgl_a_berkas));
		$tgl_b_berkas = $this->input->post('tgl_b_berkas');
		$tgl_b_berkas = date('Y-m-d', strtotime($tgl_b_berkas));
		if(empty($id)){
			$data_pendaftaran = array(
				'nama_berkas' => $this->input->post('nama_berkas'),
				'lifetime_berkas' => $this->input->post('lifetime_berkas'),
				'tgl_a_berkas' => $tgl_a_berkas,
				'tgl_b_berkas' => $tgl_b_berkas,
				'no_berkas' => $this->input->post('no_berkas')
			);
		}else{
			$user_pic=$this->m_umum->ambil_data('ol_berkas','id_berkas',$id_berkas);
			if(!empty($user_pic['link_berkas'])){
				$cek_file=FCPATH.'assets/berkas/ol/'.$user_pic['link_berkas'];
				if(file_exists($cek_file)){
					unlink(FCPATH."assets/berkas/ol/".$user_pic['link_berkas']);
				}
			}
			$data_pendaftaran = array(
				'nama_berkas' => $this->input->post('nama_berkas'),
				'lifetime_berkas' => $this->input->post('lifetime_berkas'),
				'tgl_a_berkas' => $tgl_a_berkas,
				'tgl_b_berkas' => $tgl_b_berkas,
				'no_berkas' => $this->input->post('no_berkas'),
				'link_berkas' => $id
			);
		}
		$this->db->where('id_berkas',$id_berkas);
		$this->db->update('ol_berkas', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function simpan_perpanjangan_berkas_file_surat_ijin($id){
		$id_berkas = $this->input->post('id_berkas');
		$tgl_a_berkas = $this->input->post('tgl_a_berkas');
		$tgl_a_berkas = date('Y-m-d', strtotime($tgl_a_berkas));
		$tgl_b_berkas = $this->input->post('tgl_b_berkas');
		$tgl_b_berkas = date('Y-m-d', strtotime($tgl_b_berkas));
		$kode = $this->m_rancak->kode_generator(15,'');
		$this->perpanjangan_str($id_berkas);
		if(empty($id)){
			$data_kewenangan = array(
				'id_pegawai' => $this->input->post('id_pegawai'),
				'nama_berkas' => $this->input->post('nama_berkas'),
				'id_kategori_berkas' => $this->input->post('id_kategori_berkas'),
				'lifetime_berkas' => $this->input->post('lifetime_berkas'),
				'tgl_a_berkas' => $tgl_a_berkas,
				'tgl_b_berkas' => $tgl_b_berkas,
				'barcode_berkas' => $kode,
				'no_berkas' => $this->input->post('no_berkas')

			);
		}else{
			$data_kewenangan = array(
				'id_pegawai' => $this->input->post('id_pegawai'),
				'nama_berkas' => $this->input->post('nama_berkas'),
				'id_kategori_berkas' => $this->input->post('id_kategori_berkas'),
				'lifetime_berkas' => $this->input->post('lifetime_berkas'),
				'tgl_a_berkas' => $tgl_a_berkas,
				'tgl_b_berkas' => $tgl_b_berkas,
				'barcode_berkas' => $kode,
				'no_berkas' => $this->input->post('no_berkas'),
				'link_berkas' => $id

			);
		}
		return $this->db->insert('ol_berkas', $data_kewenangan);
	}
	function perpanjangan_str($id){
		$data_pendaftaran = array(
			'status_berkas' => 0
		);
		$this->db->where('id_berkas',$id);
		$this->db->update('ol_berkas', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function working_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*
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
				$this->db->where('ol_pegawai_instansi.id_pegawai',$this->session->id_pegawai);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_pegawai_instansi');
		$this->db->join('kol_working', 'kol_working.id_working=ol_pegawai_instansi.id_instansi','left');
		$this->db->join('kol_kategori_work', 'kol_kategori_work.id_kategori_work=kol_working.id_cara_masuk','left');
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_pegawai_instansi.id_pegawai','left');
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
		$this->db->where('ol_pegawai_instansi.id_pegawai',$this->session->id_pegawai);

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
				$this->db->where('ol_pegawai_instansi.id_pegawai',$this->session->id_pegawai);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
		$this->db->from('ol_pegawai_instansi');
		$this->db->join('kol_working', 'kol_working.id_working=ol_pegawai_instansi.id_instansi','left');
		$this->db->join('kol_kategori_work', 'kol_kategori_work.id_kategori_work=kol_working.id_cara_masuk','left');
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_pegawai_instansi.id_pegawai','left');
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
		$this->db->where('ol_pegawai_instansi.id_pegawai',$this->session->id_pegawai);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
//		if($id == 0){
	 		$kondisi=array('id_pegawai'=>$this->session->id_pegawai);
			$jml = $this->m_umum->jumlah_record_filter('ol_pegawai_instansi',$kondisi);
/*		}else{
			$jml = $this->m_umum->jumlah_record_tabel('ol_status_pegawai');	
		}*/	//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_pegawai_instansi(){
		$data_pendaftaran = array(
			'id_instansi' => $this->input->post('id_instansi'),
			'id_pegawai' => $this->session->id_pegawai,
			'status_pegawai_instansi' => $this->input->post('status_pegawai_instansi')
		);
		return $this->db->insert('ol_pegawai_instansi', $data_pendaftaran);
	}
	function edit_pegawai_instansi(){
		$id_pegawai_instansi = $this->input->post('id_pegawai_instansi');
		$data_pendaftaran = array(
			'id_instansi' => $this->input->post('id_instansi'),
			'status_pegawai_instansi' => $this->input->post('status_pegawai_instansi')
		);
		$this->db->where('id_pegawai_instansi',$id_pegawai_instansi);
		$this->db->update('ol_pegawai_instansi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function pegawai_unit_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*
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
				$this->db->where('id_pegawai',$this->session->id_pegawai);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_pegawai_unit opu');
		$this->db->join('ol_unit ou', 'ou.id_unit=opu.id_unit','left');
		$this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
		$this->db->where('id_pegawai',$this->session->id_pegawai);

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
				$this->db->where('id_pegawai',$this->session->id_pegawai);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
		$this->db->from('ol_pegawai_unit opu');
		$this->db->join('ol_unit ou', 'ou.id_unit=opu.id_unit','left');
		$this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
		$this->db->where('id_pegawai',$this->session->id_pegawai);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('ol_pegawai_unit');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_ol_pegawai_unit(){
		$data_pendaftaran = array(	
			'id_pegawai' => $this->session->id_pegawai,
			'id_unit' => $this->input->post('id_unit'),
			'status_pegawai_unit' => $this->input->post('status_pegawai_unit')
		);
		return $this->db->insert('ol_pegawai_unit', $data_pendaftaran);
	}
	function edit_ol_pegawai_unit(){
		$id_pegawai_unit = $this->input->post('id_pegawai_unit');
		$data_pendaftaran = array(
			'id_unit' => $this->input->post('id_unit'),
			'status_pegawai_unit' => $this->input->post('status_pegawai_unit')
		);
		$this->db->where('id_pegawai_unit',$id_pegawai_unit);
		$this->db->update('ol_pegawai_unit', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function peminatan_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*
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

			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_pegawai_minat');
		$this->db->join('ol_peminatan', 'ol_peminatan.id_peminatan=ol_pegawai_minat.id_peminatan','left');
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_pegawai_minat.id_pegawai','left');
		$this->db->where('ol_pegawai_minat.id_pegawai',$this->session->id_pegawai);

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

			}
		  }
		}

		$this->db->from('ol_pegawai_minat');
		$this->db->join('ol_peminatan', 'ol_peminatan.id_peminatan=ol_pegawai_minat.id_peminatan','left');
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_pegawai_minat.id_pegawai','left');
		$this->db->where('ol_pegawai_minat.id_pegawai',$this->session->id_pegawai);

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
		$jml = $this->m_umum->jumlah_record_tabel('ol_pegawai_minat');
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_peminatan(){
		$data_pendaftaran2 = array(
			'id_peminatan' => $this->input->post('id_peminatan'),
			'status_minat' => $this->input->post('status_minat'),
			'id_pegawai' =>  $this->session->id_pegawai
		);
		return $this->db->insert('ol_pegawai_minat', $data_pendaftaran2);
	}
	function rubah_peminatan(){
		$id_minat = $this->input->post('id_minat');		
		$data_pendaftaran = array(
			'id_peminatan' => $this->input->post('id_peminatan'),
			'status_minat' => $this->input->post('status_minat')
		);
		$this->db->where('id_minat',$id_minat);
		$this->db->update('ol_pegawai_minat', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function my_pengcab_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*
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
$this->db->where('id_pegawai',$this->session->id_pegawai);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_pegawai');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pegawai.id_pengcab','left');
		$this->db->where('id_pegawai',$this->session->id_pegawai);

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
$this->db->where('id_pegawai',$this->session->id_pegawai);
			}
		  }
		}

		$this->db->from('ol_pegawai');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pegawai.id_pengcab','left');
		$this->db->where('id_pegawai',$this->session->id_pegawai);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/*		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){*/
		 		$kondisi=array('id_pegawai'=>$this->session->id_pegawai);
				$jml = $this->m_umum->jumlah_record_filter('ol_pegawai',$kondisi);
/*			}else{
				$jml = $this->m_umum->jumlah_record_tabel('ol_surat');
			}
		}else{
			$jml = $this->m_umum->jumlah_record_tabel('ol_surat');
		}*/		
//		$jml = $this->m_umum->jumlah_record_tabel('ol_pegawai');
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function rubah_pengcab(){
		$id_pegawai = $this->session->id_pegawai;		
		$data_pendaftaran = array(
			'id_pengcab' => $this->input->post('id_pengcab')
		);
		$this->db->where('id_pegawai',$id_pegawai);
		$this->db->update('ol_pegawai', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function logbook_all($first_date,$last_date,$idkw,$pxe)
	{
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_logbook,concat(nama_kompetensi,' - <b>[',nama_kewenangan,']</b>') as nama_kompetensi
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
		$this->db->where("lp.id_logbooker", $this->session->id_pegawai);
		$this->db->where('lp.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		if($idkw > 0){
			$this->db->where("lp.id_instansi", $idkw);
		}
		if($pxe > 0){
			$this->db->where("krw.id_kompetensi", $pxe);
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_logbook lp');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=lp.id_logbooker','left');
		$this->db->join('nkr_kewenangan krw', 'krw.id_kewenangan=lp.id_kewenangan','left');
		$this->db->join('nkr_kompetensi kr', 'kr.id_kompetensi=krw.id_kompetensi','left');
	//	$this->db->join('ol_pegawai_grade opg', 'opg.id_grade=peg.id_grade','left');
		$this->db->join('kol_working kwr', 'kwr.id_working=lp.id_instansi','left');
		$this->db->join('kol_sifat_kewenangan ksk', 'ksk.id_sifat_kewenangan=lp.id_sifat_kewenangan','left');
		$this->db->where("lp.id_logbooker", $this->session->id_pegawai);
		$this->db->where('lp.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		if($idkw > 0){
			$this->db->where("lp.id_instansi", $idkw);
		}
		if($pxe > 0){
			$this->db->where("krw.id_kompetensi", $pxe);
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
		$this->db->where("lp.id_logbooker", $this->session->id_pegawai);
		$this->db->where('lp.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		if($idkw > 0){
			$this->db->where("lp.id_instansi", $idkw);
		}
		if($pxe > 0){
			$this->db->where("krw.id_kompetensi", $pxe);
		}
			}
		  }
		}

	    $this->db->from('ol_logbook lp');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=lp.id_logbooker','left');
		$this->db->join('nkr_kewenangan krw', 'krw.id_kewenangan=lp.id_kewenangan','left');
		$this->db->join('nkr_kompetensi kr', 'kr.id_kompetensi=krw.id_kompetensi','left');
	//	$this->db->join('ol_pegawai_grade opg', 'opg.id_grade=peg.id_grade','left');
		$this->db->join('kol_working kwr', 'kwr.id_working=lp.id_instansi','left');
		$this->db->join('kol_sifat_kewenangan ksk', 'ksk.id_sifat_kewenangan=lp.id_sifat_kewenangan','left');
		$this->db->where("lp.id_logbooker", $this->session->id_pegawai);
		$this->db->where('lp.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		if($idkw > 0){
			$this->db->where("lp.id_instansi", $idkw);
		}
		if($pxe > 0){
			$this->db->where("krw.id_kompetensi", $pxe);
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
 		$kondisi=array('id_logbooker'=>$this->session->id_pegawai);
		$jml = $this->m_umum->jumlah_record_filter('ol_logbook',$kondisi);	 
/*		$jml = $this->m_umum->jumlah_record_tabel('logbook');*/

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_logbook0(){
		$id_kewenangan = $this->input->post('id_kewenangan[]');
		$jml_logbook = $this->input->post('jml_logbook[]');
		$id_sifat_kewenangan = $this->input->post('id_sifat_kewenangan[]');
		$rm = $this->input->post('rm[]');
		$id_instansi = $this->input->post('id_instansi');
		$tgl_logbook = $this->input->post('tgl_logbook');
		$tgl_logbook = date('Y-m-d', strtotime($tgl_logbook));
		$jml_kode = count($id_kewenangan);
		for ($i=0;$i<$jml_kode;$i++){
			$this->db->select("COUNT(*) as num");
			$this->db->where('id_logbooker',$id_pegawai);
			$this->db->where('tgl_logbook',$tgl_logbook);
			$this->db->where('id_kewenangan',$id_kewenangan[$i]);
			$q = $this->db->get('ol_logbook')->row();
			$jml = $q->num;
			if($jml == 0){
				$kode = $this->m_rancak->kode_generator(15,'LB');
				$Q = $this->cek_logbook_tolak($jml_logbook[$i],$rm[$i],$id_kewenangan[$i],$tgl_logbook,$kode,$id_instansi,$id_sifat_kewenangan[$i]);
			}
		}
	}
	function simpan_logbook(){
		$jml_logbook = $this->input->post('jml_logbook[]');
		$id_kewenangan = $this->input->post('id_kewenangan[]');
	//	$jml_logbook = $this->db->escape_str($this->input->post('jml_logbook'));
		$id_sifat_kewenangan = $this->input->post('id_sifat_kewenangan[]');
		$rm = $this->input->post('rm[]');
	//	$rm = $this->db->escape_str($this->input->post('rm'));
		$id_instansi = $this->input->post('id_instansi');
		$tgl_logbook = $this->input->post('tgl_logbook');
		$tgl_logbook = date('Y-m-d', strtotime($tgl_logbook));
		$jml_kode = count($id_kewenangan);
		for ($i=0;$i<$jml_kode;$i++){
			$kode = $this->m_rancak->kode_generator(15,'LB');
				$this->cek_logbook_tolak($jml_logbook[$i],$rm[$i],$id_kewenangan[$i],$tgl_logbook,$kode,$id_instansi,$id_sifat_kewenangan[$i]);
			}
	}
	function cek_jabatan_untuk_simpan_logbook($id){
		$q = $this->db->get_where('jabatan',array('id_jabatan'=>$id));
		return $q->row_array();
	}
	function cek_logbook_tolak($jml_logbook,$rm,$id_kewenangan,$tgl_logbook,$kode,$id_instansi,$id_sifat_kewenangan){
		$id_pegawai=$this->session->id_pegawai;
		$this->db->select("COUNT(*) as num");
		$this->db->where('id_logbooker',$id_pegawai);
		$this->db->where('id_kewenangan',$id_kewenangan);
		$this->db->where('tolak >',0);
		$q = $this->db->get('ol_logbook')->row();
		$jml = $q->num;
		if($jml == 0){
			$this->simpan_logbook_final($jml_logbook,$rm,$id_kewenangan,$tgl_logbook,$kode,$id_instansi,$id_sifat_kewenangan);
		}
	}
	function simpan_logbook_final($jml_logbook,$rm,$id_kewenangan,$tgl_logbook,$kode,$id_instansi,$id_sifat_kewenangan){
	//	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
		if($this->session->level == 53){
			$id_sifat_kewenangan = '5';
		}
		$barcode_pegawai=$this->session->barcode_pegawai;
		if($jml_logbook == '0' OR empty($jml_logbook)){
			$jml_logbook = '1';
		}
		$this->db->select("COUNT(*) as num");
		$this->db->where('barcode_pegawai',$barcode_pegawai);
		$this->db->where('id_kewenangan',$id_kewenangan);
		$q = $this->db->get('ol_kewenangan_lulus')->row();
		$jml = $q->num;
		$kodeid = $this->m_rancak->kode_generator_urut(15,'LB');
		if($jml == 0){
			$data_pendaftaran = array(
				'id_logbook' => $kodeid,
				'id_kewenangan' => $id_kewenangan,
				'id_instansi' => $id_instansi,
				'id_unit' => $this->session->unit,
				'jml_logbook' => $jml_logbook,
				'id_sifat_kewenangan' => $id_sifat_kewenangan,
				'rm' => $rm,
				'barcode_logbook' => $kode,
				'tgl_logbook' => $tgl_logbook,
				'id_logbooker' => $this->session->id_pegawai
			);
			$this->db->insert('ol_logbook', $data_pendaftaran);
		}else{
			$data_pendaftaran = array(
				'id_logbook' => $kodeid,
				'id_kewenangan' => $id_kewenangan,
				'id_instansi' => $id_instansi,
				'id_unit' => $this->session->unit,
				'jml_logbook' => $jml_logbook,
				'id_sifat_kewenangan' => $id_sifat_kewenangan,
				'tgl_logbook' => $tgl_logbook,
				'rm' => $rm,
				'barcode_logbook' => $kode,
				'id_logbooker' => $this->session->id_pegawai,
				'lulus' => 1
			);
			$this->db->insert('ol_logbook', $data_pendaftaran);
		}
		return $this->db->insert_id();
	}
	function edit_logbook(){
		$id_logbook = $this->input->post('id_logbook');
		$tgl_logbook = $this->input->post('tgl_logbook');
		$tgl_logbook = date('Y-m-d', strtotime($tgl_logbook));
		$data_pendaftaran = array(
			'jml_logbook' =>$this->input->post('jml_logbook'),
			'id_instansi' => $this->input->post('id_instansi'),
			'id_sifat_kewenangan' => $this->input->post('id_sifat_kewenangan'),
			'rm' => $this->input->post('rm'),
			'tgl_logbook' =>$tgl_logbook
		);
		$this->db->where('id_logbook',$id_logbook);
		$this->db->update('ol_logbook', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function jml_reject($kondisi)
	{
		$this->db->select('SUM(jml_reject) as num');
		$this->db->where($kondisi);
		$this->db->join('ol_logbook_pasien', 'ol_logbook_pasien.id_logbook_pasien=ol_logbook_reject.id_logbook_pasien','left');
		$query = $this->db->get_where('ol_logbook_reject');
	    $result = $query->row();
	    if($result->num > 0)
	    	return $result->num;
	    return 0;
	}
	function jml_bakhp($kondisi)
	{
		$this->db->select('SUM(jml_bahan) as num');
		$this->db->where($kondisi);
		$this->db->join('ol_logbook_pasien', 'ol_logbook_pasien.id_logbook_pasien=ol_logbook_pakai.id_logbook_pasien','left');
		$query = $this->db->get_where('ol_logbook_pakai');
	    $result = $query->row();
	    if($result->num > 0)
	    	return $result->num;
	    return 0;
	}
	function count_bakhp($kondisi)
	{
		$this->db->select('COUNT(*) as num');
		$this->db->where($kondisi);
		$this->db->join('ol_logbook_pasien', 'ol_logbook_pasien.id_logbook_pasien=ol_logbook_pakai.id_logbook_pasien','left');
		$query = $this->db->get_where('ol_logbook_pakai');
	    $result = $query->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
	}
	function count_reject($kondisi)
	{
		$this->db->select('COUNT(*) as num');
		$this->db->where($kondisi);
		$this->db->join('ol_logbook_pasien', 'ol_logbook_pasien.id_logbook_pasien=ol_logbook_reject.id_logbook_pasien','left');
		$query = $this->db->get_where('ol_logbook_reject');
	    $result = $query->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
	}
	function jml_all_bakhp($first_date,$last_date,$idkw,$pxe,$kondisi)
	{
		$this->db->select('SUM(jml_bahan) as num');
		$this->db->join('ol_logbook_pasien', 'ol_logbook_pasien.id_logbook_pasien=ol_logbook_pakai.id_logbook_pasien','left');
		$this->db->join('ol_logbook lp', 'lp.id_logbook=ol_logbook_pasien.id_logbook','left');
		$this->db->where('lp.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		if($idkw > 0){
			$this->db->where("lp.id_instansi", $idkw);
		}
		if($pxe > 0){
			$this->db->where("krw.id_kompetensi", $pxe);
		}
		$query = $this->db->get_where('ol_logbook_pakai',$kondisi);
	    $result = $query->row();
	    if($result->num > 0)
	    	return $result->num;
	    return 0;
	}
	function jml_all_reject($first_date,$last_date,$idkw,$pxe,$kondisi)
	{
		$this->db->select('SUM(jml_reject) as num');
		$this->db->join('ol_logbook_pasien', 'ol_logbook_pasien.id_logbook_pasien=ol_logbook_reject.id_logbook_pasien','left');
		$this->db->join('ol_logbook lp', 'lp.id_logbook=ol_logbook_pasien.id_logbook','left');
		$this->db->where('lp.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		if($idkw > 0){
			$this->db->where("lp.id_instansi", $idkw);
		}
		if($pxe > 0){
			$this->db->where("krw.id_kompetensi", $pxe);
		}
		$query = $this->db->get_where('ol_logbook_reject',$kondisi);
	    $result = $query->row();
	    if($result->num > 0)
	    	return $result->num;
	    return 0;
	}
	function count_all_bakhp($first_date,$last_date,$idkw,$pxe,$kondisi)
	{
		$this->db->select('COUNT(*) as num');
		$this->db->join('ol_logbook_pasien', 'ol_logbook_pasien.id_logbook_pasien=ol_logbook_pakai.id_logbook_pasien','left');
		$this->db->join('ol_logbook lp', 'lp.id_logbook=ol_logbook_pasien.id_logbook','left');
		$this->db->where('lp.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		if($idkw > 0){
			$this->db->where("lp.id_instansi", $idkw);
		}
		if($pxe > 0){
			$this->db->where("krw.id_kompetensi", $pxe);
		}
		$query = $this->db->get_where('ol_logbook_pakai',$kondisi);
	    $result = $query->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
	}
	function count_all_reject($first_date,$last_date,$idkw,$pxe,$kondisi)
	{
		$this->db->select('COUNT(*) as num');
		$this->db->join('ol_logbook_pasien', 'ol_logbook_pasien.id_logbook_pasien=ol_logbook_reject.id_logbook_pasien','left');
		$this->db->join('ol_logbook lp', 'lp.id_logbook=ol_logbook_pasien.id_logbook','left');
		$this->db->where('lp.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		if($idkw > 0){
			$this->db->where("lp.id_instansi", $idkw);
		}
		if($pxe > 0){
			$this->db->where("krw.id_kompetensi", $pxe);
		}
		$query = $this->db->get_where('ol_logbook_reject',$kondisi);
	    $result = $query->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
	}
	function logbook_laporan_all($first_date,$last_date,$tgl,$kat)
	{
		$fields = "*,DATE_FORMAT(tgl_laporan,'%d-%m-%Y') as tgl_laporan,concat(nama_unit,' - [<b>',nama_working,'</b>]') as nama_working,
			DATE_FORMAT(tgl_awal,'%d-%m-%Y') as tgl_awal,DATE_FORMAT(tgl_akhir,'%d-%m-%Y') as tgl_akhir,if(share_it = 1,'Share','Unshare') as share_it
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
	    $this->db->where('oll.barcode_pegawai',$this->session->barcode_pegawai);		
	    if($tgl == 0){
	    $this->db->where('tgl_laporan BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		}	
		if($kat > 0){
			$this->db->where_in("oll.id_kompetensi", $kat);
		}
		$this->db->group_start();
		$this->db->where('oll.barcode_pegawai',$this->session->barcode_pegawai);
/*		$this->db->or_where('find_in_set("'.$this->session->barcode_pegawai.'", share_peg) <> 0');
		$this->db->or_where('find_in_set("'.$this->session->unit.'", share_it) <> 0');
		$this->db->or_where('find_in_set("'.$this->session->refer.'", share_ins) <> 0');*/
	//	$this->db->or_where("(oll.id_unit = '".$this->session->unit."' AND oll.share_it = 1)", NULL, FALSE);
		$this->db->group_end();
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_logbook_laporan oll');	
	    $this->db->join('ol_unit ou', 'ou.id_unit=oll.id_unit','left');
	    $this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
	    $this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=oll.barcode_pegawai','left');
	//    $this->db->where('oll.barcode_pegawai',$this->session->barcode_pegawai);		
	    if($tgl == 0){
	    $this->db->where('tgl_laporan BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		}	
		if($kat > 0){
			$this->db->where_in("oll.id_kompetensi", $kat);
		}
		$this->db->group_start();
		$this->db->where('oll.barcode_pegawai',$this->session->barcode_pegawai);
/*		$this->db->or_where('find_in_set("'.$this->session->barcode_pegawai.'", share_peg) <> 0');
		$this->db->or_where('find_in_set("'.$this->session->unit.'", share_it) <> 0');
		$this->db->or_where('find_in_set("'.$this->session->refer.'", share_ins) <> 0');*/
	//	$this->db->or_where("(oll.id_unit = '".$this->session->unit."' AND oll.share_it = 1)", NULL, FALSE);
		$this->db->group_end();
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
	    $this->db->where('oll.barcode_pegawai',$this->session->barcode_pegawai);		
	    if($tgl == 0){
	    $this->db->where('tgl_laporan BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		}	
		if($kat > 0){
			$this->db->where_in("oll.id_kompetensi", $kat);
		}
		$this->db->group_start();
		$this->db->where('oll.barcode_pegawai',$this->session->barcode_pegawai);
/*		$this->db->or_where('find_in_set("'.$this->session->barcode_pegawai.'", share_peg) <> 0');
		$this->db->or_where('find_in_set("'.$this->session->unit.'", share_it) <> 0');
		$this->db->or_where('find_in_set("'.$this->session->refer.'", share_ins) <> 0');*/
	//	$this->db->or_where("(oll.id_unit = '".$this->session->unit."' AND oll.share_it = 1)", NULL, FALSE);
		$this->db->group_end();
			}
		  }
		}

	    $this->db->from('ol_logbook_laporan oll');	
	    $this->db->join('ol_unit ou', 'ou.id_unit=oll.id_unit','left');
	    $this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
	    $this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=oll.barcode_pegawai','left');
	    $this->db->where('oll.barcode_pegawai',$this->session->barcode_pegawai);		
	    if($tgl == 0){
	    $this->db->where('tgl_laporan BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		}	
		if($kat > 0){
			$this->db->where_in("oll.id_kompetensi", $kat);
		}
		$this->db->group_start();
		$this->db->where('oll.barcode_pegawai',$this->session->barcode_pegawai);
/*		$this->db->or_where('find_in_set("'.$this->session->barcode_pegawai.'", share_peg) <> 0');
		$this->db->or_where('find_in_set("'.$this->session->unit.'", share_it) <> 0');
		$this->db->or_where('find_in_set("'.$this->session->refer.'", share_ins) <> 0');*/
	//	$this->db->or_where("(oll.id_unit = '".$this->session->unit."' AND oll.share_it = 1)", NULL, FALSE);
		$this->db->group_end();

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('ol_logbook_laporan');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function cmd_pasien($id)
	{   
		$this->db->select("rm as data, CONCAT('[',rm,'] [',YEAR(CURDATE()) - YEAR(tgl_lahir),'] ',nama_pasien) as value, 
			nama_pasien, DATE_FORMAT(tgl_lahir,'%d-%m-%Y') as tgl_lahir, rm, jk, alamat");
        $this->db->like("nama_pasien", $id);
    //    $this->db->or_like("nama_pasien", $id);
        $this->db->limit('5,0');
        return $this->db->get_where('ol_pasien')->result_array();
	}
	function cmd_rm($id)
	{   
		$this->db->select("rm as data, CONCAT('[',rm,'] [',YEAR(CURDATE()) - YEAR(tgl_lahir),'] ',nama_pasien) as value, 
			nama_pasien, DATE_FORMAT(tgl_lahir,'%d-%m-%Y') as tgl_lahir, rm, jk, alamat");
        $this->db->like("rm", $id);
    //    $this->db->or_like("nama_pasien", $id);
        $this->db->limit('5,0');
        return $this->db->get_where('ol_pasien')->result_array();
	}
	function absensi($first_date,$last_date)
	{
		$fields = "*,DATE_FORMAT(tgl_absen,'%d-%m-%Y') as tgl_absen,tgl_absen as tgl_sort
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
	    $this->db->where('tgl_absen BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
	    $this->db->where('aa.barcode_pegawai',$this->session->barcode_pegawai);	
	    $this->db->where('os.unit',$this->session->unit);
/*		$this->db->group_start();
		$this->db->where('id_instansi',0);	
		$this->db->or_where('id_instansi',$this->session->refer);	
		$this->db->group_end();*/
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('abs_absen aa');	
	    $this->db->join('abs_kategori_absen aka', 'aka.id_kategori_absen=aa.id_kategori_absen','left');
	    $this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=aa.barcode_pegawai','left');	
	    $this->db->join('ol_user os', 'os.id_pegawai=peg.id_pegawai','left');	
	    $this->db->join('ol_unit ou', 'ou.id_unit=os.unit','left');	
	    $this->db->where('tgl_absen BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
	    $this->db->where('aa.barcode_pegawai',$this->session->barcode_pegawai);	
	    $this->db->where('os.unit',$this->session->unit);
/*		$this->db->group_start();
		$this->db->where('id_instansi',0);	
		$this->db->or_where('id_instansi',$this->session->refer);	
		$this->db->group_end();*/

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
	    $this->db->where('tgl_absen BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
	    $this->db->where('aa.barcode_pegawai',$this->session->barcode_pegawai);	
	    $this->db->where('os.unit',$this->session->unit);
/*		$this->db->group_start();
		$this->db->where('id_instansi',0);	
		$this->db->or_where('id_instansi',$this->session->refer);	
		$this->db->group_end();*/
			}
		  }
		}

	    $this->db->from('abs_absen aa');	
	    $this->db->join('abs_kategori_absen aka', 'aka.id_kategori_absen=aa.id_kategori_absen','left');
	    $this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=aa.barcode_pegawai','left');	
	    $this->db->join('ol_user os', 'os.id_pegawai=peg.id_pegawai','left');	
	    $this->db->join('ol_unit ou', 'ou.id_unit=os.unit','left');	
	    $this->db->where('tgl_absen BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
	    $this->db->where('aa.barcode_pegawai',$this->session->barcode_pegawai);	
	    $this->db->where('os.unit',$this->session->unit);	
/*		$this->db->group_start();
		$this->db->where('id_instansi',0);	
		$this->db->or_where('id_instansi',$this->session->refer);	
		$this->db->group_end();*/

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
 		$kondisi=array('barcode_pegawai'=>$this->session->barcode_pegawai);
		$jml = $this->m_umum->jumlah_record_filter('abs_absen',$kondisi); 
//		$jml = $this->m_umum->jumlah_record_tabel('ol_logbook_lhu');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function absen_masuk(){
		$id_kategori_absen = $this->input->post('id_kategori_absen');
		$ambil_kate = $this->m_umum->ambil_data('abs_kategori_absen','id_kategori_absen',$id_kategori_absen);
		$kode = $this->m_rancak->kode_generator_urut(15,'MP');
		if($ambil_kate['offday'] == 0){
			$data_kewenangan = array(
				'barcode_pegawai' => $this->session->barcode_pegawai,
				'id_seting' => $this->input->post('id_seting'),
				'nama_seting' => $this->input->post('nama_seting'),
				'id_kategori_absen' => $this->input->post('id_kategori_absen'),
				'location_in' => $this->input->post('location'),
				'clock_in' => date('H:i:s'),
				'base_location' => $this->input->post('base_location'),
				'tgl_absen' => date('Y-m-d'),
				'id_absen' => $kode
			);			
		}else{
			$data_kewenangan = array(
				'barcode_pegawai' => $this->session->barcode_pegawai,
				'id_seting' => $this->input->post('id_seting'),
				'nama_seting' => $this->input->post('nama_seting'),
				'id_kategori_absen' => $this->input->post('id_kategori_absen'),
				'location_in' => $this->input->post('location'),
				'location_out' => $this->input->post('location'),
				'clock_in' => date('H:i:s'),
				'clock_out' => date('H:i:s'),
				'base_location' => $this->input->post('base_location'),
				'tgl_absen' => date('Y-m-d'),
				'id_absen' => $kode
				);			
		}
			return $this->db->insert('abs_absen', $data_kewenangan);
	}
	function absen_keluar(){
		$id_absen = $this->input->post('id_absen');
		$data_pendaftaran = array(
			'clock_out' => date('H:i:s'),
			'location_out' => $this->input->post('location')
		);
		$this->db->where('id_absen',$id_absen);
		$this->db->update('abs_absen', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function logbook_pasien_pakai($id)
	{
	//	$lpd = $this->m_umum->ambil_data('ol_logbook','id_logbook',$id);
		$fields = "*,olpk.jml_bahan as jml_bahan
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
	    $this->db->where('olp.id_logbook_pasien',$id);	
	    $this->db->where('ol.id_logbooker',$this->session->id_pegawai);		
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_logbook_pakai olpk');	
	    $this->db->join('ol_logbook_pasien olp', 'olp.id_logbook_pasien=olpk.id_logbook_pasien','left');
	    $this->db->join('ol_logbook ol', 'ol.id_logbook=olp.id_logbook','left');
	    $this->db->join('ol_bahan ob', 'ob.id_bahan=olpk.id_bahan','left');
	    $this->db->where('olp.id_logbook_pasien',$id);	
	    $this->db->where('ol.id_logbooker',$this->session->id_pegawai);	

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
	    $this->db->where('olp.id_logbook_pasien',$id);	
	    $this->db->where('ol.id_logbooker',$this->session->id_pegawai);		
			}
		  }
		}

	    $this->db->from('ol_logbook_pakai olpk');	
	    $this->db->join('ol_logbook_pasien olp', 'olp.id_logbook_pasien=olpk.id_logbook_pasien','left');
	    $this->db->join('ol_logbook ol', 'ol.id_logbook=olp.id_logbook','left');
	    $this->db->join('ol_bahan ob', 'ob.id_bahan=olpk.id_bahan','left');
	    $this->db->where('olp.id_logbook_pasien',$id);	
	    $this->db->where('ol.id_logbooker',$this->session->id_pegawai);	

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
 		$kondisi=array('id_logbook_pasien'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('ol_logbook_pakai',$kondisi);
//		$jml = $this->m_umum->jumlah_record_tabel('ol_logbook_lhu'); 
//$jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_logbook_pasien',$kondisi,'ol_pasien','id_pasien');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_bakhp(){
		$jml_bahan = $this->input->post('jml_bahan[]');
		$id_bahan = $this->input->post('id_bahan[]');
	//	$chk = $this->input->post('chk[]');
		if(!empty($id_bahan) OR $id_bahan > 0){
			$this->tambah_bakhp();
		}
		$id_logbook_pakai_edit = $this->input->post('id_logbook_pakai_edit[]');
		if($id_logbook_pakai_edit){
			$id_logbook_pakai_edit = $this->input->post('id_logbook_pakai_edit[]');		
			$id_bahan_edit = $this->input->post('id_bahan_edit[]');		
			$jml_bahan_edit = $this->input->post('jml_bahan_edit[]');						
			$jml_kode = count($id_logbook_pakai_edit);
			for ($i=0;$i<$jml_kode;$i++){ 	
				$this->edit_bakhp($id_logbook_pakai_edit[$i],$id_bahan_edit[$i],$jml_bahan_edit[$i]);				
			}
		}
	}
	function tambah_bakhp(){
		$id_bahan = $this->input->post('id_bahan[]');		
		$jml_bahan = $this->input->post('jml_bahan[]');		
		$id_logbook_pasien = $this->input->post('id_logbook_pasien');						
		$jml_kode = count($jml_bahan);
		for ($i=0;$i<$jml_kode;$i++){
			if($jml_bahan[$i] > 0){
				$kondisi = array('id_logbook_pasien'=>$id_logbook_pasien,'id_bahan'=>$id_bahan[$i]);
				$jml = $this->m_umum->jumlah_record_filter('ol_logbook_pakai',$kondisi);
				if($jml == 0){
					$kode = $this->m_rancak->kode_generator_urut(15,'BA');
					$data_pendaftaran = array(
						'id_logbook_pakai' => $kode,					
						'id_logbook_pasien' => $id_logbook_pasien,								
						'jml_bahan' => $jml_bahan[$i],					
						'id_bahan' => $id_bahan[$i]
					);
					$this->db->insert('ol_logbook_pakai', $data_pendaftaran);
				}
			}				
		}		
	}
	function edit_bakhp($id_logbook_pakai,$id_bahan,$jml_bahan){
		$data_pendaftaran = array(
			'id_bahan' => $id_bahan,					
			'jml_bahan' => $jml_bahan
		);
		$this->db->where('id_logbook_pakai',$id_logbook_pakai);
		$this->db->update('ol_logbook_pakai', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function edit_log_bakhp(){
		$id_logbook_pakai = $this->input->post('id_logbook_pakai');
		$data_pendaftaran = array(					
			'id_bahan' => $this->input->post('id_bahan'),
			'jml_bahan' => $this->input->post('jml_bahan')
		);
		$this->db->where('id_logbook_pakai',$id_logbook_pakai);
		$this->db->update('ol_logbook_pakai', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function ambil_logbook_pakai($id){
		$this->db->join('ol_logbook_pasien olp', 'olp.id_logbook_pasien=olpk.id_logbook_pasien','left');
		$q = $this->db->get_where('ol_logbook_pakai olpk',array('olpk.id_logbook_pasien'=>$id));
		return $q->result_array();
	}
	function logbook_pasien_reject($id)
	{
	//	$lpd = $this->m_umum->ambil_data('ol_logbook','id_logbook',$id);
		$fields = "*,olpk.jml_reject as jml_reject
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
	    $this->db->where('olp.id_logbook_pasien',$id);	
	    $this->db->where('ol.id_logbooker',$this->session->id_pegawai);		
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_logbook_reject olpk');	
	    $this->db->join('ol_logbook_pasien olp', 'olp.id_logbook_pasien=olpk.id_logbook_pasien','left');
	    $this->db->join('ol_logbook ol', 'ol.id_logbook=olp.id_logbook','left');
	    $this->db->join('ol_bahan ob', 'ob.id_bahan=olpk.id_bahan','left');
	    $this->db->join('kol_reject kr', 'kr.id_reject=olpk.id_reject','left');
	    $this->db->where('olp.id_logbook_pasien',$id);	
	    $this->db->where('ol.id_logbooker',$this->session->id_pegawai);	

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
	    $this->db->where('olp.id_logbook_pasien',$id);	
	    $this->db->where('ol.id_logbooker',$this->session->id_pegawai);		
			}
		  }
		}

	    $this->db->from('ol_logbook_reject olpk');	
	    $this->db->join('ol_logbook_pasien olp', 'olp.id_logbook_pasien=olpk.id_logbook_pasien','left');
	    $this->db->join('ol_logbook ol', 'ol.id_logbook=olp.id_logbook','left');
	    $this->db->join('ol_bahan ob', 'ob.id_bahan=olpk.id_bahan','left');
	    $this->db->join('kol_reject kr', 'kr.id_reject=olpk.id_reject','left');
	    $this->db->where('olp.id_logbook_pasien',$id);	
	    $this->db->where('ol.id_logbooker',$this->session->id_pegawai);	

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
 		$kondisi=array('id_logbook_pasien'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('ol_logbook_pakai',$kondisi);
//		$jml = $this->m_umum->jumlah_record_tabel('ol_logbook_lhu'); 
//$jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_logbook_pasien',$kondisi,'ol_pasien','id_pasien');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function ambil_logbook_reject($id){
		$this->db->join('ol_logbook_pasien olp', 'olp.id_logbook_pasien=olpk.id_logbook_pasien','left');
		$q = $this->db->get_where('ol_logbook_reject olpk',array('olpk.id_logbook_pasien'=>$id));
		return $q->result_array();
	}
	function simpan_reject(){
		$jml_bahan = $this->input->post('jml_bahan[]');
		$id_bahan = $this->input->post('id_bahan[]');
		$id_reject = $this->input->post('id_reject[]');
	//	$chk = $this->input->post('chk[]');
		if(!empty($id_reject) OR $id_reject > 0){
			$this->tambah_reject();
		}
		$id_logbook_pakai_edit = $this->input->post('id_logbook_pakai_edit[]');
		if($id_logbook_pakai_edit){
			$id_logbook_pakai_edit = $this->input->post('id_logbook_pakai_edit[]');		
			$id_bahan_edit = $this->input->post('id_bahan_edit[]');		
			$jml_bahan_edit = $this->input->post('jml_bahan_edit[]');						
			$jml_kode = count($id_logbook_pakai_edit);
			for ($i=0;$i<$jml_kode;$i++){ 	
				$this->edit_bakhp($id_logbook_pakai_edit[$i],$id_bahan_edit[$i],$jml_bahan_edit[$i]);				
			}
		}
	}
	function tambah_reject(){
		$id_bahan = $this->input->post('id_bahan[]');		
		$id_reject = $this->input->post('id_reject[]');		
		$jml_bahan = $this->input->post('jml_bahan[]');		
		$id_logbook_pasien = $this->input->post('id_logbook_pasien');						
		$jml_kode = count($jml_bahan);
		for ($i=0;$i<$jml_kode;$i++){
			if($jml_bahan[$i] > 0){
				$kondisi = array('id_logbook_pasien'=>$id_logbook_pasien,'id_bahan'=>$id_bahan[$i],'id_reject'=>$id_reject[$i]);
				$jml = $this->m_umum->jumlah_record_filter('ol_logbook_reject',$kondisi);
				if($jml == 0){
					$kode = $this->m_rancak->kode_generator_urut(15,'RE');
					$data_pendaftaran = array(
						'id_logbook_reject' => $kode,					
						'id_logbook_pasien' => $id_logbook_pasien,								
						'id_reject' => $id_reject[$i],					
						'jml_reject' => $jml_bahan[$i],					
						'id_bahan' => $id_bahan[$i]
					);
					$this->db->insert('ol_logbook_reject', $data_pendaftaran);
				}
			}				
		}		
	}
	function edit_log_reject(){
		$id_logbook_reject = $this->input->post('id_logbook_reject');
		$data_pendaftaran = array(					
			'id_bahan' => $this->input->post('id_bahan'),
			'id_reject' => $this->input->post('id_reject'),
			'jml_reject' => $this->input->post('jml_bahan')
		);
		$this->db->where('id_logbook_reject',$id_logbook_reject);
		$this->db->update('ol_logbook_reject', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);					
	}
	function logbook_pasien($id)
	{
	//	$lpd = $this->m_umum->ambil_data('ol_logbook','id_logbook',$id);
		$fields = "*,DATE_FORMAT(tgl_lahir,'%d-%m-%Y') as tgl_lahir,if(jk = 1,'Laki-laki','Perempuan') as jk
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
				$this->db->where('olp.id_logbook',$id);		
				$this->db->where('ol.id_logbooker',$this->session->id_pegawai);		
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_logbook_pasien olp');	
	    $this->db->join('ol_logbook ol', 'ol.id_logbook=olp.id_logbook','left');
	    $this->db->join('ol_pasien ops', 'ops.id_pasien=olp.id_pasien','left');
	    $this->db->join('kol_working kw', 'kw.id_working=ops.pasien_instansi','left');
	    $this->db->where('olp.id_logbook',$id);	
	    $this->db->where('ol.id_logbooker',$this->session->id_pegawai);	

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
				$this->db->where('olp.id_logbook',$id);			
				$this->db->where('ol.id_logbooker',$this->session->id_pegawai);	
			}
		  }
		}

	    $this->db->from('ol_logbook_pasien olp');
	    $this->db->join('ol_logbook ol', 'ol.id_logbook=olp.id_logbook','left');	
	    $this->db->join('ol_pasien ops', 'ops.id_pasien=olp.id_pasien','left');
	    $this->db->join('kol_working kw', 'kw.id_working=ops.pasien_instansi','left');	
	    $this->db->where('olp.id_logbook',$id);	
	    $this->db->where('ol.id_logbooker',$this->session->id_pegawai);	

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
 		$kondisi=array('id_logbook'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('ol_logbook_pasien',$kondisi);
//		$jml = $this->m_umum->jumlah_record_tabel('ol_logbook_lhu'); 
//$jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_logbook_pasien',$kondisi,'ol_pasien','id_pasien');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function change_jml_logbook($id,$jml_logbook,$equ=FALSE){
		$kondisi=array('id_logbook'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('ol_logbook_pasien',$kondisi);
		if($equ){
			if($jml == $jml_logbook){
				$data_pendaftaran = array(	
					'jml_logbook' => $jml
				);
				$this->db->where('id_logbook',$id);
				$this->db->update('ol_logbook', $data_pendaftaran);
				//echo $this->db->last_query();
				$this->db->trans_complete();	// untuk cek sukses update tidak
				if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
				// if (!$this->db->affected_rows())
					return(FALSE);
				else
					return(TRUE);
			}
		}else{
			if($jml > $jml_logbook){
				$data_pendaftaran = array(	
					'jml_logbook' => $jml
				);
				$this->db->where('id_logbook',$id);
				$this->db->update('ol_logbook', $data_pendaftaran);
				//echo $this->db->last_query();
				$this->db->trans_complete();	// untuk cek sukses update tidak
				if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
				// if (!$this->db->affected_rows())
					return(FALSE);
				else
					return(TRUE);
			}
		}
	}
	function hapus_dan_hitung_px($id,$idp){
		$this->m_umum->hapus_data('ol_logbook_pasien','id_logbook_pasien',$idp);
		$kondisi=array('id_logbook'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('ol_logbook_pasien',$kondisi);
		$data_pendaftaran = array(	
			'jml_logbook' => $jml
		);
		$this->db->where('id_logbook',$id);
		$this->db->update('ol_logbook', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
					return(TRUE);
	}
	function simpan_ol_lpasien(){
		$id_logbook = $this->input->post('id_logbook');
		$jml_logbook = $this->input->post('jml_logbook');
		$jml_bahan = $this->input->post('jml_bahan');			
		$jml_reject = $this->input->post('jml_reject');	
		if($jml_bahan == 0){
			$id_bahan = '0';
		}else{
			$id_bahan = $this->input->post('id_bahan');
		}
		if($jml_reject == 0){
			$id_reject = '0';
		}else{
			$id_reject = $this->input->post('id_reject');
		}
		$rm = $this->input->post('rm');
		$kondisi=array('rm'=>$rm);
		$jml = $this->m_umum->jumlah_record_filter('ol_pasien',$kondisi);
		if($jml == 0){
			$psx = $this->simpan_ol_pasien();
		}else{
			$this->rubah_ol_pasien();
			$pasiyen = $this->m_umum->ambil_data('ol_pasien','rm',$rm);
			$psx = $pasiyen['id_pasien'];
		}
		$Q = $this->nyimpen_ol_logbook_pasien($psx);
		$this->change_jml_logbook($id_logbook,$jml_logbook);
		if($jml_bahan > 0 && $id_bahan > 0){
			$this->simpan_ol_log_pakai($jml_bahan,$id_bahan,$Q);
		}
		if($jml_reject > 0 && $id_bahan > 0 && $id_reject > 0){
			$this->simpan_ol_log_reject($jml_reject,$id_bahan,$id_reject,$Q);
		}
	}
	function nyimpen_ol_logbook_pasien($id){
		$kode = $this->m_rancak->kode_generator_urut(15,'PS');
		$jml_bahan = $this->input->post('jml_bahan');			
		$jml_reject = $this->input->post('jml_reject');	
		if($jml_bahan == 0){
			$id_bahan = '0';
		}else{
			$id_bahan = $this->input->post('id_bahan');
		}
		if($jml_reject == 0){
			$id_reject = '0';
		}else{
			$id_reject = $this->input->post('id_reject');
		}
		$data_pendaftaran = array(
			'id_logbook_pasien' => $kode,					
			'id_pasien' => $id,								
			'id_logbook' => $this->input->post('id_logbook')
/*			'jml_bahan' => $this->input->post('jml_bahan'),
			'id_bahan' => $id_bahan,
			'jml_reject' => $this->input->post('jml_reject'),
			'id_reject' => $id_reject*/
		);
		$this->db->insert('ol_logbook_pasien', $data_pendaftaran);
		return $kode;
	}
	function simpan_ol_log_pakai($jml_bahan,$id_bahan,$id){
		$kode = $this->m_rancak->kode_generator_urut(15,'BA');
		$data_pendaftaran = array(
			'id_logbook_pakai' => $kode,
			'id_logbook_pasien' => $id,
			'jml_bahan'  => $jml_bahan,
			'id_bahan'  => $id_bahan
		);
		$this->db->insert('ol_logbook_pakai', $data_pendaftaran);
		return $kode;
	}
	function simpan_ol_log_reject($jml_reject,$id_bahan,$id_reject,$id){
		$kode = $this->m_rancak->kode_generator_urut(15,'RE');
		$data_pendaftaran = array(
			'id_logbook_reject' => $kode,
			'id_logbook_pasien' => $id,
			'id_reject'  => $id_reject,
			'jml_reject'  => $jml_reject,
			'id_bahan'  => $id_bahan
		);
		$this->db->insert('ol_logbook_reject', $data_pendaftaran);
		return $kode;
	}
	function rubah_ol_lpasien(){
		$id_logbook = $this->input->post('id_logbook');
		$jml_logbook = $this->input->post('jml_logbook');
		$rm = $this->input->post('rm');
		$kondisi=array('rm'=>$rm);
		$jml = $this->m_umum->jumlah_record_filter('ol_pasien',$kondisi);
		if($jml == 0){
			$psx = $this->simpan_ol_pasien();
		}else{
			$this->rubah_ol_pasien();
			$pasiyen = $this->m_umum->ambil_data('ol_pasien','rm',$rm);
			$psx = $pasiyen['id_pasien'];
		}
		$this->ngerubah_ol_logbook_pasien($psx);
		$this->change_jml_logbook($id_logbook,$jml_logbook);
	}
	function ngerubah_ol_logbook_pasien($id){
		$id_logbook_pasien = $this->input->post('id_logbook_pasien');			
		$jml_bahan = $this->input->post('jml_bahan');			
		$jml_reject = $this->input->post('jml_reject');	
		if($jml_bahan == 0){
			$id_bahan = '0';
		}else{
			$id_bahan = $this->input->post('id_bahan');
		}
		if($jml_reject == 0){
			$id_reject = '0';
		}else{
			$id_reject = $this->input->post('id_reject');
		}
		$data_pendaftaran = array(	
			'id_pasien' => $id
/*			'jml_bahan' => $this->input->post('jml_bahan'),
			'id_bahan' => $id_bahan,
			'jml_reject' => $this->input->post('jml_reject'),
			'id_reject' => $id_reject*/
		);
		$this->db->where('id_logbook_pasien',$id_logbook_pasien);
		$this->db->update('ol_logbook_pasien', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function simpan_ol_pasien(){
		$kode = $this->m_rancak->kode_generator(15,'PS');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$tgl_lahir = date('Y-m-d', strtotime($tgl_lahir));
		$data_pendaftaran = array(
			'pasien_instansi' => $this->session->refer,
			'id_pasien' => $kode,
			'rm'  => $this->input->post('rm'),
			'nama_pasien'  => $this->input->post('nama_pasien'),
			'tgl_lahir'  => $tgl_lahir,
			'jk'  => $this->input->post('jk'),
			'alamat'  => $this->input->post('alamat')
		);
		$this->db->insert('ol_pasien', $data_pendaftaran);
		return $kode;
	}
	function rubah_ol_pasien(){
		$rm = $this->input->post('rm');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$tgl_lahir = date('Y-m-d', strtotime($tgl_lahir));
		$data_pendaftaran = array(
			'nama_pasien'  => $this->input->post('nama_pasien'),
			'tgl_lahir'  => $tgl_lahir,
			'jk'  => $this->input->post('jk'),
			'alamat'  => $this->input->post('alamat')
		);
		$this->db->where('rm',$rm);
		$this->db->update('ol_pasien', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function share_un_laporan($id,$share){
		$data_pendaftaran = array(
			'share_it'  => $share
		);
		$this->db->where('id_laporan',$id);
		$this->db->update('ol_logbook_laporan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function simpan_analisis(){
		$kode = $this->m_rancak->kode_generator_urut(15,'AN');
		$tgl_laporan = $this->input->post('tgl_laporan');
		$tgl_laporan = date('Y-m-d', strtotime($tgl_laporan));
		$tgl_awal = $this->input->post('tgl_awal');
		$tgl_awal = date('Y-m-d', strtotime($tgl_awal));
		$tgl_akhir = $this->input->post('tgl_akhir');
		$tgl_akhir = date('Y-m-d', strtotime($tgl_akhir));
		$data_pendaftaran = array(
			'barcode_pegawai' => $this->session->barcode_pegawai,
			'id_laporan' => $kode,
			'tgl_laporan' => $tgl_laporan,
			'tgl_awal' => $tgl_awal,
			'tgl_akhir' => $tgl_akhir,
			'header_laporan'  => $this->input->post('header_laporan'),
			'id_unit'  => $this->input->post('id_working'),
			'sub_header_laporan'  => $this->input->post('sub_header_laporan'),
			'sub_sub_header_laporan'  => $this->input->post('sub_sub_header_laporan'),
			'judul_laporan'  => $this->input->post('judul_laporan'),
			'tujuan_laporan'  => $this->input->post('tujuan_laporan'),
			'sumber_laporan'  => $this->input->post('sumber_laporan'),
			'periode_laporan'  => $this->input->post('periode_laporan')
		);
		return $this->db->insert('ol_logbook_laporan', $data_pendaftaran);
		// $this->db->insert_id();
	}
	function rubah_analisis(){
		$id_laporan = $this->input->post('id_laporan');
		$tgl_laporan = $this->input->post('tgl_laporan');
		$tgl_laporan = date('Y-m-d', strtotime($tgl_laporan));
		$tgl_awal = $this->input->post('tgl_awal');
		$tgl_awal = date('Y-m-d', strtotime($tgl_awal));
		$tgl_akhir = $this->input->post('tgl_akhir');
		$tgl_akhir = date('Y-m-d', strtotime($tgl_akhir));
		$data_pendaftaran = array(
			'tgl_laporan' => $tgl_laporan,
			'tgl_awal' => $tgl_awal,
			'tgl_akhir' => $tgl_akhir,
			'header_laporan'  => $this->input->post('header_laporan'),
			'id_unit'  => $this->input->post('id_working'),
			'sub_header_laporan'  => $this->input->post('sub_header_laporan'),
			'sub_sub_header_laporan'  => $this->input->post('sub_sub_header_laporan'),
			'judul_laporan'  => $this->input->post('judul_laporan'),
			'tujuan_laporan'  => $this->input->post('tujuan_laporan'),
			'sumber_laporan'  => $this->input->post('sumber_laporan'),
			'periode_laporan'  => $this->input->post('periode_laporan')
		);
		$this->db->where('id_laporan',$id_laporan);
		$this->db->update('ol_logbook_laporan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function seting_kompetensi($rec){
		$id_laporan_tabel = $this->input->post('id_laporan_tabel');
		$chk = $this->input->post('chk[]');
		if (empty($chk)) {
		   $id_kompetensi = "";
		}else{
			$id_kompetensi = implode(",",$chk);
		}
		$data_pendaftaran = array(
			$rec => $id_kompetensi
		);
		$this->db->where('id_laporan_tabel',$id_laporan_tabel);
		$this->db->update('ol_logbook_laporan_tabel', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function seting_kewenangan(){
		$id_laporan_tabel = $this->input->post('id_laporan_tabel');
		$data_pendaftaran = array(
			'kewenangan' => $this->input->post('kewenangan')
		);
		$this->db->where('id_laporan_tabel',$id_laporan_tabel);
		$this->db->update('ol_logbook_laporan_tabel', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function seting_range(){
		$id_laporan_tabel = $this->input->post('id_laporan_tabel');
/*		$data_pendaftaran = array(
			'min_laporan_tabel' => (!empty($this->input->post('min_laporan_tabel'))) ? $this->input->post('min_laporan_tabel') : NULL,
			'max_laporan_tabel' => (!empty($this->input->post('max_laporan_tabel'))) ? $this->input->post('max_laporan_tabel') : NULL
		);*/
		$data_pendaftaran = array(
			'min_laporan_tabel' => $this->input->post('min_laporan_tabel'),
			'max_laporan_tabel' =>$this->input->post('max_laporan_tabel')
		);
		$this->db->where('id_laporan_tabel',$id_laporan_tabel);
		$this->db->update('ol_logbook_laporan_tabel', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function logbook_laporan_tabel_all($id)
	{
		$fields = "*,concat(nama_unit,' - [<b>',nama_working,'</b>]') as nama_working,
		if(lhu=1,'Kompetensi',if(lhu=2,'BAKHP',if(lhu=3,'Reject',if(lhu=4,'QC / IM',if(lhu=5,'Pendaftaran Pasien',if(lhu=7,'Berkas','Belum di set')))))) as lhu";
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
	    $this->db->where('ollt.id_laporan',$id);	
		$this->db->group_start();
		$this->db->where('oll.barcode_pegawai',$this->session->barcode_pegawai);
		$this->db->or_where("(oll.id_unit = '".$this->session->unit."' AND oll.share_it = 1)", NULL, FALSE);
		$this->db->group_end();
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_logbook_laporan_tabel ollt');	
	    $this->db->join('ol_logbook_laporan oll', 'oll.id_laporan=ollt.id_laporan','left');
	    $this->db->join('ol_unit ou', 'ou.id_unit=oll.id_unit','left');
	    $this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
	    $this->db->join('sn_tabel st', 'st.id_tabel=ollt.tabel','left');		
	    $this->db->where('ollt.id_laporan',$id);	
		$this->db->group_start();
		$this->db->where('oll.barcode_pegawai',$this->session->barcode_pegawai);
		$this->db->or_where("(oll.id_unit = '".$this->session->unit."' AND oll.share_it = 1)", NULL, FALSE);
		$this->db->group_end();	

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
	    $this->db->where('ollt.id_laporan',$id);	
		$this->db->group_start();
		$this->db->where('oll.barcode_pegawai',$this->session->barcode_pegawai);
		$this->db->or_where("(oll.id_unit = '".$this->session->unit."' AND oll.share_it = 1)", NULL, FALSE);
		$this->db->group_end();
			}
		  }
		}

	    $this->db->from('ol_logbook_laporan_tabel ollt');	
	    $this->db->join('ol_logbook_laporan oll', 'oll.id_laporan=ollt.id_laporan','left');
	    $this->db->join('ol_unit ou', 'ou.id_unit=oll.id_unit','left');
	    $this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
	    $this->db->join('sn_tabel st', 'st.id_tabel=ollt.tabel','left');		
	    $this->db->where('ollt.id_laporan',$id);	
		$this->db->group_start();
		$this->db->where('oll.barcode_pegawai',$this->session->barcode_pegawai);
		$this->db->or_where("(oll.id_unit = '".$this->session->unit."' AND oll.share_it = 1)", NULL, FALSE);
		$this->db->group_end();

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
 		$kondisi=array('id_laporan'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('ol_logbook_laporan_tabel',$kondisi); 
//		$jml = $this->m_umum->jumlah_record_tabel('ol_logbook_laporan_tabel');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function tambah_tabel_clone($id){
		$kode = $this->m_rancak->kode_generator(15,'LT');
		$id_laporan = $this->input->post('id_laporan');
		$kondisi = array('id_laporan_tabel'=>$id);
		$ol_lap = $this->m_umum->ambil_data_kondisi('ol_logbook_laporan_tabel',$kondisi);
		if($id_laporan == $ol_lap['id_laporan']){
			$idl = $ol_lap['isi_kompetensi'];
		}else{
			$idl = '';
		}
		$data_pendaftaran = array(
			'id_laporan_tabel' => $kode,
			'id_laporan'  => $id_laporan,
			'judul_laporan_tabel'  => $ol_lap['judul_laporan_tabel'],
			'isi_kompetensi'  => $idl,
			'analisa_laporan_tabel'  => $ol_lap['analisa_laporan_tabel'],
			'rekomendasi_laporan_tabel'  => $ol_lap['rekomendasi_laporan_tabel'],
			'min_laporan_tabel'  => $ol_lap['min_laporan_tabel'],
			'max_laporan_tabel'  => $ol_lap['max_laporan_tabel'],
			'kompetensi'  => $ol_lap['kompetensi'],
			'kewenangan'  => $ol_lap['kewenangan'],
			'bahan'  => $ol_lap['bahan'],
			'reject'  => $ol_lap['reject'],
			'i_mutu'  => $ol_lap['i_mutu'],
			'item_lhu'  => $ol_lap['item_lhu'],
			'id_lhu'  => $ol_lap['id_lhu'],
			'lhu'  => $ol_lap['lhu'],
			'tabel'  => $ol_lap['tabel'],
			'show_pdf'  => $ol_lap['show_pdf'],
			'berkas_laporan_tabel'  => $ol_lap['berkas_laporan_tabel'],
			'urutan_laporan_tabel'  => $ol_lap['urutan_laporan_tabel']
		);
		return $this->db->insert('ol_logbook_laporan_tabel', $data_pendaftaran);
		// $this->db->insert_id();
	}
	function tambah_tabel(){
		$kode = $this->m_rancak->kode_generator(15,'LT');
		$data_pendaftaran = array(
			'id_laporan_tabel' => $kode,
			'id_laporan'  => $this->input->post('id_laporan'),
			'judul_laporan_tabel'  => $this->input->post('judul_laporan_tabel'),
			'analisa_laporan_tabel'  => $this->input->post('analisa_laporan_tabel'),
			'rekomendasi_laporan_tabel'  => $this->input->post('rekomendasi_laporan_tabel')
		);
		return $this->db->insert('ol_logbook_laporan_tabel', $data_pendaftaran);
		// $this->db->insert_id();
	}
	function edit_tabel_status(){
		$id_laporan_tabel = $this->input->post('id_laporan_tabel');
		$data_pendaftaran = array(
			'status_urutan_tabel' => $this->input->post('status_urutan_tabel')
		);
		$this->db->where('id_laporan_tabel',$id_laporan_tabel);
		$this->db->update('ol_logbook_laporan_tabel', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function rubah_tabel(){
		$id_laporan_tabel = $this->input->post('id_laporan_tabel');
		$data_pendaftaran = array(
			'tabel' => $this->input->post('tabel')
		);
		$this->db->where('id_laporan_tabel',$id_laporan_tabel);
		$this->db->update('ol_logbook_laporan_tabel', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function rubah_show_pdf(){
		$id_laporan_tabel = $this->input->post('id_laporan_tabel');
		$data_pendaftaran = array(
			'show_pdf' => $this->input->post('show_pdf')
		);
		$this->db->where('id_laporan_tabel',$id_laporan_tabel);
		$this->db->update('ol_logbook_laporan_tabel', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function rubah_urutan(){
		$id_laporan_tabel = $this->input->post('id_laporan_tabel');
		$data_pendaftaran = array(
			'urutan_laporan_tabel' => $this->input->post('urutan_laporan_tabel')
		);
		$this->db->where('id_laporan_tabel',$id_laporan_tabel);
		$this->db->update('ol_logbook_laporan_tabel', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function rubah_lhu(){
		$id_laporan_tabel = $this->input->post('id_laporan_tabel');
		$data_pendaftaran = array(
			'lhu' => $this->input->post('lhu')
		);
		$this->db->where('id_laporan_tabel',$id_laporan_tabel);
		$this->db->update('ol_logbook_laporan_tabel', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function logbook_laporan_tabel_sesuaikan_all($id)
	{
		$ollt = $this->m_umum->ambil_data('ol_logbook_laporan_tabel','id_laporan_tabel',$id);
		$fields = "*,concat(nama_unit,' - [<b>',nama_working,'</b>]') as nama_working,
		if(lhu=1,'Kompetensi',if(lhu=2,'BAKHP',if(lhu=3,'Reject',if(lhu=4,'QC / IM',if(lhu=5,'Pendaftaran Pasien',if(lhu=7,'Berkas','Belum di set')))))) as lhu";
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
	    $this->db->where('ollt.id_laporan',$ollt['id_laporan']);	
		$this->db->group_start();
		$this->db->where('oll.barcode_pegawai',$this->session->barcode_pegawai);
		$this->db->or_where("(oll.id_unit = '".$this->session->unit."' AND oll.share_it = 1)", NULL, FALSE);
		$this->db->group_end();
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_logbook_laporan_tabel ollt');	
	    $this->db->join('ol_logbook_laporan oll', 'oll.id_laporan=ollt.id_laporan','left');
	    $this->db->join('ol_unit ou', 'ou.id_unit=oll.id_unit','left');
	    $this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
	    $this->db->join('sn_tabel st', 'st.id_tabel=ollt.tabel','left');		
	    $this->db->where('ollt.id_laporan',$ollt['id_laporan']);	
		$this->db->group_start();
		$this->db->where('oll.barcode_pegawai',$this->session->barcode_pegawai);
		$this->db->or_where("(oll.id_unit = '".$this->session->unit."' AND oll.share_it = 1)", NULL, FALSE);
		$this->db->group_end();	

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
	    $this->db->where('ollt.id_laporan',$ollt['id_laporan']);	
		$this->db->group_start();
		$this->db->where('oll.barcode_pegawai',$this->session->barcode_pegawai);
		$this->db->or_where("(oll.id_unit = '".$this->session->unit."' AND oll.share_it = 1)", NULL, FALSE);
		$this->db->group_end();
			}
		  }
		}

	    $this->db->from('ol_logbook_laporan_tabel ollt');	
	    $this->db->join('ol_logbook_laporan oll', 'oll.id_laporan=ollt.id_laporan','left');
	    $this->db->join('ol_unit ou', 'ou.id_unit=oll.id_unit','left');
	    $this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
	    $this->db->join('sn_tabel st', 'st.id_tabel=ollt.tabel','left');		
	    $this->db->where('ollt.id_laporan',$ollt['id_laporan']);	
		$this->db->group_start();
		$this->db->where('oll.barcode_pegawai',$this->session->barcode_pegawai);
		$this->db->or_where("(oll.id_unit = '".$this->session->unit."' AND oll.share_it = 1)", NULL, FALSE);
		$this->db->group_end();

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
 		$kondisi=array('id_laporan'=>$ollt['id_laporan']);
		$jml = $this->m_umum->jumlah_record_filter('ol_logbook_laporan_tabel',$kondisi); 
//		$jml = $this->m_umum->jumlah_record_tabel('ol_logbook_laporan_tabel');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function edit_logbook_laporan_tabel(){
		$id_laporan_tabel = $this->input->post('id_laporan_tabel');
		$data_pendaftaran = array(
			'judul_laporan_tabel'  => $this->input->post('judul_laporan_tabel'),
			'analisa_laporan_tabel'  => $this->input->post('analisa_laporan_tabel'),
			'rekomendasi_laporan_tabel'  => $this->input->post('rekomendasi_laporan_tabel')
		);
		$this->db->where('id_laporan_tabel',$id_laporan_tabel);
		$this->db->update('ol_logbook_laporan_tabel', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function logbook_lhu_user_lain($first_date,$last_date)
	{
		$fields = "*,DATE_FORMAT(tgl_lhu,'%d-%m-%Y') as tgl_lhu,tgl_lhu as tgl_sort,
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
	    $this->db->where('tgl_lhu BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$this->db->group_start();
		$this->db->where('find_in_set("'.$this->session->barcode_pegawai.'", share_peg_lhu) <> 0');
		$this->db->or_where('find_in_set("'.$this->session->unit.'", share_lhu) <> 0');
		$this->db->or_where('find_in_set("'.$this->session->refer.'", share_ins_lhu) <> 0');
		$this->db->group_end();
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_logbook_lhu oll');	
	    $this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=oll.barcode_pegawai','left');
	    $this->db->join('ol_user us', 'us.id_pegawai=peg.id_pegawai','left');	
	    $this->db->where('tgl_lhu BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$this->db->group_start();
		$this->db->where('find_in_set("'.$this->session->barcode_pegawai.'", share_peg_lhu) <> 0');
		$this->db->or_where('find_in_set("'.$this->session->unit.'", share_lhu) <> 0');
		$this->db->or_where('find_in_set("'.$this->session->refer.'", share_ins_lhu) <> 0');
		$this->db->group_end();

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
	    $this->db->where('tgl_lhu BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$this->db->group_start();
		$this->db->where('find_in_set("'.$this->session->barcode_pegawai.'", share_peg_lhu) <> 0');
		$this->db->or_where('find_in_set("'.$this->session->unit.'", share_lhu) <> 0');
		$this->db->or_where('find_in_set("'.$this->session->refer.'", share_ins_lhu) <> 0');
		$this->db->group_end();
			}
		  }
		}

	    $this->db->from('ol_logbook_lhu oll');	
	    $this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=oll.barcode_pegawai','left');
	    $this->db->join('ol_user us', 'us.id_pegawai=peg.id_pegawai','left');	
	    $this->db->where('tgl_lhu BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$this->db->group_start();
		$this->db->where('find_in_set("'.$this->session->barcode_pegawai.'", share_peg_lhu) <> 0');
		$this->db->or_where('find_in_set("'.$this->session->unit.'", share_lhu) <> 0');
		$this->db->or_where('find_in_set("'.$this->session->refer.'", share_ins_lhu) <> 0');
		$this->db->group_end();

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('ol_logbook_lhu');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function logbook_time_respon_all($first_date,$last_date)
	{
		$fields = "*,DATE_FORMAT(tgl_tr,'%d-%m-%Y') as tgl_tr,tgl_tr as tgl_sort
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
	    $this->db->where('tgl_tr BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$this->db->group_start();
		$this->db->where('tr.id_unit',$this->session->unit);
//		$this->db->or_where("(us.unit = '".$this->session->unit."' AND oll.share_lhu = 1)", NULL, FALSE);
		$this->db->group_end();
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('time_respon tr');	
	    $this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=tr.barcode_pegawai','left');
	    $this->db->join('ol_user us', 'us.id_pegawai=peg.id_pegawai','left');	
	    $this->db->join('nkr_kewenangan nk', 'nk.id_kewenangan=tr.id_kewenangan','left');	
	    $this->db->join('ol_unit ou', 'ou.id_unit=tr.id_unit','left');	
	    $this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');	
	    $this->db->where('tgl_tr BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$this->db->group_start();
		$this->db->where('tr.id_unit',$this->session->unit);
//		$this->db->or_where("(us.unit = '".$this->session->unit."' AND oll.share_lhu = 1)", NULL, FALSE);
		$this->db->group_end();

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
	    $this->db->where('tgl_tr BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$this->db->group_start();
		$this->db->where('tr.id_unit',$this->session->unit);
//		$this->db->or_where("(us.unit = '".$this->session->unit."' AND oll.share_lhu = 1)", NULL, FALSE);
		$this->db->group_end();
			}
		  }
		}

	    $this->db->from('time_respon tr');	
	    $this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=tr.barcode_pegawai','left');
	    $this->db->join('ol_user us', 'us.id_pegawai=peg.id_pegawai','left');	
	    $this->db->join('nkr_kewenangan nk', 'nk.id_kewenangan=tr.id_kewenangan','left');	
	    $this->db->join('ol_unit ou', 'ou.id_unit=tr.id_unit','left');	
	    $this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');	
	    $this->db->where('tgl_tr BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$this->db->group_start();
		$this->db->where('tr.id_unit',$this->session->unit);
//		$this->db->or_where("(us.unit = '".$this->session->unit."' AND oll.share_lhu = 1)", NULL, FALSE);
		$this->db->group_end();

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
 		$kondisi=array('id_unit'=>$this->session->unit);
		$jml = $this->m_umum->jumlah_record_filter('time_respon',$kondisi); 
	//	$jml = $this->m_umum->jumlah_record_tabel('ol_logbook_lhu');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_time_respon(){
		$kode = $this->m_rancak->kode_generator_urut(15,'TR');
		$waktu_tunggu = $this->input->post('waktu_tunggu');
		$waktu_tunggu = date('H:i:s', strtotime($waktu_tunggu));
		$tgl_tr = $this->input->post('tgl_tr');
		$tgl_tr = date('Y-m-d', strtotime($tgl_tr));
		$data_pendaftaran = array(
			'barcode_pegawai' => $this->session->barcode_pegawai,
			'id_unit' => $this->session->unit,
			'id_tr' => $kode,
			'tgl_tr' => $tgl_tr,
			'waktu_tunggu' => $waktu_tunggu,
			'id_kewenangan'  => $this->input->post('id_kewenangan'),
			'nama_time_respon'  => $this->input->post('nama_time_respon')
		);
		return $this->db->insert('time_respon', $data_pendaftaran);
		// $this->db->insert_id();
	}
	function rubah_time_respon(){
		$id_tr = $this->input->post('id_tr');
		$waktu_tunggu = $this->input->post('waktu_tunggu');
		$waktu_tunggu = date('H:i:s', strtotime($waktu_tunggu));
		$tgl_tr = $this->input->post('tgl_tr');
		$tgl_tr = date('Y-m-d', strtotime($tgl_tr));
		$data_pendaftaran = array(
			'tgl_tr' => $tgl_tr,
			'waktu_tunggu' => $waktu_tunggu,
			'id_kewenangan'  => $this->input->post('id_kewenangan'),
			'nama_time_respon'  => $this->input->post('nama_time_respon')
		);
		$this->db->where('id_tr',$id_tr);
		$this->db->update('time_respon', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function logbook_lhu_all($first_date,$last_date)
	{
		$fields = "*,DATE_FORMAT(tgl_lhu,'%d-%m-%Y') as tgl_lhu,tgl_lhu as tgl_sort
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
	    $this->db->where('tgl_lhu BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$this->db->group_start();
		$this->db->where('oll.barcode_pegawai',$this->session->barcode_pegawai);
//		$this->db->or_where("(us.unit = '".$this->session->unit."' AND oll.share_lhu = 1)", NULL, FALSE);
		$this->db->group_end();
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_logbook_lhu oll');	
	    $this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=oll.barcode_pegawai','left');
	    $this->db->join('ol_user us', 'us.id_pegawai=peg.id_pegawai','left');	
	    $this->db->where('tgl_lhu BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$this->db->group_start();
		$this->db->where('oll.barcode_pegawai',$this->session->barcode_pegawai);
//		$this->db->or_where("(us.unit = '".$this->session->unit."' AND oll.share_lhu = 1)", NULL, FALSE);
		$this->db->group_end();

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
	    $this->db->where('tgl_lhu BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$this->db->group_start();
		$this->db->where('oll.barcode_pegawai',$this->session->barcode_pegawai);
//		$this->db->or_where("(us.unit = '".$this->session->unit."' AND oll.share_lhu = 1)", NULL, FALSE);
		$this->db->group_end();
			}
		  }
		}

	    $this->db->from('ol_logbook_lhu oll');	
	    $this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=oll.barcode_pegawai','left');
	    $this->db->join('ol_user us', 'us.id_pegawai=peg.id_pegawai','left');	
	    $this->db->where('tgl_lhu BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$this->db->group_start();
		$this->db->where('oll.barcode_pegawai',$this->session->barcode_pegawai);
//		$this->db->or_where("(us.unit = '".$this->session->unit."' AND oll.share_lhu = 1)", NULL, FALSE);
		$this->db->group_end();

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('ol_logbook_lhu');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function logbook_lhu_detil_all($id)
	{
		$fields = "*,concat('IM / QC : ',nama_item_lhu,' - <b>[',nama_equipment,']</b>') as nama_item_lhu,
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
					 case 'id_equipment' : $nmf="olil.id_equipment";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);	
	    $this->db->where('olld.id_lhu',$id);		
		$this->db->group_start();
		$this->db->where('oll.barcode_pegawai',$this->session->barcode_pegawai);
		$this->db->or_where("(us.unit = '".$this->session->unit."' AND oll.share_lhu = 1)", NULL, FALSE);
		$this->db->group_end();	;
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_logbook_lhu_detil olld');
	    $this->db->join('ol_logbook_lhu oll', 'oll.id_lhu=olld.id_lhu','left');
	    $this->db->join('ol_logbook_item_lhu olil', 'olil.id_item_lhu=olld.id_item_lhu','left');
	    $this->db->join('ol_equipment oe', 'oe.id_equipment=olil.id_equipment','left');
	    $this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=oll.barcode_pegawai','left');
	    $this->db->join('ol_user us', 'us.id_pegawai=peg.id_pegawai','left');
	    $this->db->where('olld.id_lhu',$id);		
		$this->db->group_start();
		$this->db->where('oll.barcode_pegawai',$this->session->barcode_pegawai);
		$this->db->or_where("(us.unit = '".$this->session->unit."' AND oll.share_lhu = 1)", NULL, FALSE);
		$this->db->group_end();

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				case 'id_equipment' : $nmf="olil.id_equipment";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
	    $this->db->where('olld.id_lhu',$id);		
		$this->db->group_start();
		$this->db->where('oll.barcode_pegawai',$this->session->barcode_pegawai);
		$this->db->or_where("(us.unit = '".$this->session->unit."' AND oll.share_lhu = 1)", NULL, FALSE);
		$this->db->group_end();	
			}
		  }
		}

	    $this->db->from('ol_logbook_lhu_detil olld');
	    $this->db->join('ol_logbook_lhu oll', 'oll.id_lhu=olld.id_lhu','left');
	    $this->db->join('ol_logbook_item_lhu olil', 'olil.id_item_lhu=olld.id_item_lhu','left');
	    $this->db->join('ol_equipment oe', 'oe.id_equipment=olil.id_equipment','left');
	    $this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=oll.barcode_pegawai','left');
	    $this->db->join('ol_user us', 'us.id_pegawai=peg.id_pegawai','left');
	    $this->db->where('olld.id_lhu',$id);		
		$this->db->group_start();
		$this->db->where('oll.barcode_pegawai',$this->session->barcode_pegawai);
		$this->db->or_where("(us.unit = '".$this->session->unit."' AND oll.share_lhu = 1)", NULL, FALSE);
		$this->db->group_end();		

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
 		$kondisi=array('id_lhu'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('ol_logbook_lhu_detil',$kondisi);
//		$jml = $this->m_umum->jumlah_record_tabel('ol_logbook_lhu');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_indikator_mutu(){
		$kode = $this->m_rancak->kode_generator_urut(15,'XN');
		$tgl_lhu = $this->input->post('tgl_lhu');
		$tgl_lhu = date('Y-m-d', strtotime($tgl_lhu));
		$data_pendaftaran = array(
			'barcode_pegawai' => $this->session->barcode_pegawai,
			'id_lhu' => $kode,
			'tgl_lhu' => $tgl_lhu,
			'nama_lhu'  => $this->input->post('nama_lhu')
		);
		return $this->db->insert('ol_logbook_lhu', $data_pendaftaran);
		// $this->db->insert_id();
	}
	function rubah_indikator_mutu(){
		$id_lhu = $this->input->post('id_lhu');
		$tgl_lhu = $this->input->post('tgl_lhu');
		$tgl_lhu = date('Y-m-d', strtotime($tgl_lhu));
		$data_pendaftaran = array(
			'tgl_lhu' => $tgl_lhu,
			'nama_lhu'  => $this->input->post('nama_lhu')
		);
		$this->db->where('id_lhu',$id_lhu);
		$this->db->update('ol_logbook_lhu', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function simpan_indikator_mutu_detil(){
		$kode = $this->m_rancak->kode_generator_urut(15,'XD');
		$hasil_lhu_detil = $this->input->post('hasil_lhu_detil');
		$hasil_lhu_detil = str_replace(',', '.', $hasil_lhu_detil);
		$data_pendaftaran = array(
			'id_lhu' => $this->input->post('id_lhu'),
			'id_lhu_detil' => $kode,
			'hasil_lhu_detil' => $hasil_lhu_detil,
			'id_item_lhu'  => $this->input->post('id_item_lhu'),
			'ket_lhu_detil'  => $this->input->post('ket_lhu_detil')
		);
		return $this->db->insert('ol_logbook_lhu_detil', $data_pendaftaran);
		// $this->db->insert_id();
	}
	function rubah_indikator_mutu_detil(){
		$id_lhu_detil = $this->input->post('id_lhu_detil');
		$hasil_lhu_detil = $this->input->post('hasil_lhu_detil');
		$hasil_lhu_detil = str_replace(',', '.', $hasil_lhu_detil);
		$data_pendaftaran = array(
			'hasil_lhu_detil' => $hasil_lhu_detil,
			'id_item_lhu'  => $this->input->post('id_item_lhu'),
			'ket_lhu_detil'  => $this->input->post('ket_lhu_detil')
		);
		$this->db->where('id_lhu_detil',$id_lhu_detil);
		$this->db->update('ol_logbook_lhu_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function clone_indikator_mutu($id_lhu,$tgl_lhu,$nama_lhu,$share_lhu){
		$kode = $this->m_rancak->kode_generator_urut(15,'XN');
		$data_pendaftaran = array(
			'barcode_pegawai' => $this->session->barcode_pegawai,
			'id_lhu' => $kode,
			'share_lhu' => $share_lhu,
			'tgl_lhu' => $tgl_lhu,
			'nama_lhu'  => $nama_lhu
		);
		$this->db->insert('ol_logbook_lhu', $data_pendaftaran);
		return $kode;
	}
	function clone_indikator_mutu_detil_each($id){
		$id_item_lhu = $this->input->post('id_item_lhu[]');
		$ket_lhu_detil = $this->input->post('ket_lhu_detil[]');
		$hasil_lhu_detil = $this->input->post('hasil_lhu_detil[]');
		$hasil_lhu_detil = str_replace(',', '.', $hasil_lhu_detil);
		$jml_kode = count($id_item_lhu);
		for ($i=0;$i<$jml_kode;$i++){
				$this->simpan_clone_indikator_mutu_detil($id,$hasil_lhu_detil[$i],$id_item_lhu[$i],$ket_lhu_detil[$i]);
			}
	}
	function clone_indikator_mutu_detil($id,$newid){
		$kondisi_source = array('id_lhu'=>$id);
		$source = $this->m_umum->ambil_data_kondisi_result('ol_logbook_lhu_detil',$kondisi_source);
		foreach($source as $rowsource){
			$hasil_lhu_detil = $rowsource['hasil_lhu_detil'];
			$id_item_lhu = $rowsource['id_item_lhu'];
			$ket_lhu_detil = $rowsource['ket_lhu_detil'];
			$this->simpan_clone_indikator_mutu_detil($newid,$hasil_lhu_detil,$id_item_lhu,$ket_lhu_detil);
		}
	}
	function simpan_clone_indikator_mutu_detil($id,$hasil_lhu_detil,$id_item_lhu,$ket_lhu_detil){
		$kode = $this->m_rancak->kode_generator_urut(15,'XD');
		$data_pendaftaran = array(
			'id_lhu' => $id,
			'id_lhu_detil' => $kode,
			'hasil_lhu_detil' => $hasil_lhu_detil,
			'id_item_lhu'  => $id_item_lhu,
			'ket_lhu_detil'  => $ket_lhu_detil
		);
		return $this->db->insert('ol_logbook_lhu_detil', $data_pendaftaran);
		// $this->db->insert_id();
	}
	function seting_share_lhu(){
		$id_lhu = $this->input->post('id_lhu');
		$share_lhu = $this->input->post('share_lhu');
		$data_pendaftaran = array(
			'share_lhu' => $share_lhu
		);
		$this->db->where('id_lhu',$id_lhu);
		$this->db->update('ol_logbook_lhu', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function logbook_lhu_item_lhu_all()
	{
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
	    $this->db->where('olil.pembuat_item_lhu',$this->session->barcode_pegawai);	
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_logbook_item_lhu olil');
	    $this->db->join('ol_equipment oe', 'oe.id_equipment=olil.id_equipment','left');		
	    $this->db->where('olil.pembuat_item_lhu',$this->session->barcode_pegawai);

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
	    $this->db->where('olil.pembuat_item_lhu',$this->session->barcode_pegawai);	
			}
		  }
		}

	    $this->db->from('ol_logbook_item_lhu olil');
	    $this->db->join('ol_equipment oe', 'oe.id_equipment=olil.id_equipment','left');			
	    $this->db->where('olil.pembuat_item_lhu',$this->session->barcode_pegawai);		

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
 		$kondisi=array('pembuat_item_lhu'=>$this->session->barcode_pegawai);
		$jml = $this->m_umum->jumlah_record_filter('ol_logbook_item_lhu',$kondisi);
//		$jml = $this->m_umum->jumlah_record_tabel('ol_logbook_lhu');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_indikator_item_mutu(){
		$kode = $this->m_rancak->kode_generator_urut(15,'IM');
		$data_pendaftaran = array(
			'id_item_lhu' => $kode,
			'pembuat_item_lhu' => $this->session->barcode_pegawai,
			'id_equipment'  => $this->input->post('id_equipment'),
			'nama_item_lhu'  => $this->input->post('nama_item_lhu'),
			'status_item_lhu'  => $this->input->post('status_item_lhu')
		);
		return $this->db->insert('ol_logbook_item_lhu', $data_pendaftaran);
		// $this->db->insert_id();
	}
	function rubah_indikator_item_mutu(){
		$id_item_lhu = $this->input->post('id_item_lhu');
		$data_pendaftaran = array(
			'nama_item_lhu'  => $this->input->post('nama_item_lhu'),
			'id_equipment'  => $this->input->post('id_equipment'),
			'status_item_lhu'  => $this->input->post('status_item_lhu')
		);
		$this->db->where('id_item_lhu',$id_item_lhu);
		$this->db->update('ol_logbook_item_lhu', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function ambil_isi_kompetensi($id)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
		if($lpd['kompetensi'] == "" OR empty($lpd['kompetensi'])){
			$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		}else{
			$idx = explode(',', $lpd['kompetensi']);
			$this->db->where_in("nkk.id_kompetensi",$idx);
			$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		}
		$this->db->where('jml_logbook >',0);
		$q = $this->db->get_where('ol_logbook ol',array('id_logbooker'=>$lpd['id_pegawai']))->result_array();
//	echo $this->db->last_query();die();
	//print_r($q);die();
		return $q;
    }
	function logbook_pasien_instansi($id)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
		$fields = "*,DATE_FORMAT(tgl_lahir,'%d-%m-%Y') as tgl_lahir,if(jk = 1,'Laki-laki','Perempuan') as jk
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
	    $this->db->where('ops.pasien_instansi',$lpd['id_working']);		
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('ol_pasien ops');	
	    $this->db->join('kol_working kw', 'kw.id_working=ops.pasien_instansi','left');
	    $this->db->where('ops.pasien_instansi',$lpd['id_working']);

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
	    $this->db->where('ops.pasien_instansi',$lpd['id_working']);		
			}
		  }
		}

	    $this->db->from('ol_pasien ops');	
	    $this->db->join('kol_working kw', 'kw.id_working=ops.pasien_instansi','left');
	    $this->db->where('ops.pasien_instansi',$lpd['id_working']);		

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
 		$kondisi=array('pasien_instansi'=>$lpd['id_working']);
		$jml = $this->m_umum->jumlah_record_filter('ol_pasien',$kondisi);
//		$jml = $this->m_umum->jumlah_record_tabel('ol_logbook_lhu');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	//======================= PIE
	function grafik_pie_tr($id,$grup=FALSE)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
/*		$this->db->select("
		if (max_laporan_tabel ISNULL or max_laporan_tabel = 0 ,SUM(case when waktu_tunggu > ".$lpd["min_laporan_tabel"]." then 1 else 0 end),
		if(min_laporan_tabel ISNULL or min_laporan_tabel = 0,SUM(case when waktu_tunggu < ".$lpd["max_laporan_tabel"]." then 1 else 0 end),
		SUM(CASE WHEN waktu_tunggu BETWEEN ".$lpd["min_laporan_tabel"]." and ".$lpd["max_laporan_tabel"]." THEN 1 ELSE 0 END)) as total,
				DATE_FORMAT(tgl_tr,'%d-%m-%Y') as tgl_tr,nama_time_respon as nama_lhu,
				DATE_FORMAT(tgl_tr,'%Y') as thn,
				DATE_FORMAT(tgl_tr,'%m') as bln,
				DATE_FORMAT(tgl_tr,'%d') as hr
(case when (".$lpd["max_laporan_tabel"]." is not null or ".$lpd["max_laporan_tabel"]." <> '') then sum(waktu_tunggu > ".$lpd["min_laporan_tabel"].")
when (".$lpd["min_laporan_tabel"]." is not null or ".$lpd["min_laporan_tabel"]." <> '') then sum(waktu_tunggu < ".$lpd["max_laporan_tabel"].")
else sum(waktu_tunggu BETWEEN ".$lpd["min_laporan_tabel"]." and ".$lpd["max_laporan_tabel"].")
end) as total

CASE
WHEN (p.product_sale_price_status = 'Y')
THEN <-- add this
    CASE
    WHEN (po.option_upcharge IS NOT NULL)
        THEN (sc.product_qty * (p.product_sale_price + po.option_upcharge)) 
        ELSE (sc.product_qty * p.product_sale_price)    
    END
ELSE
    CASE
    WHEN (po.option_upchage IS NOT NULL)
        THEN (sc.product_qty * (p.product_price + po.option_upcharge))
        ELSE (sc.product_qty * p.product_price)
    END
END AS total
			");
		$this->db->select("
				DATE_FORMAT(tgl_tr,'%d-%m-%Y') as tgl_tr,nama_time_respon as nama_lhu,
				DATE_FORMAT(tgl_tr,'%Y') as thn,
				DATE_FORMAT(tgl_tr,'%m') as bln,
				DATE_FORMAT(tgl_tr,'%d') as hr, 
CASE
WHEN (".$lpd["max_laporan_tabel"]." is not null or ".$lpd["max_laporan_tabel"]." <> '')
THEN SUM(case when waktu_tunggu > ".$lpd["min_laporan_tabel"]." then 1 else 0 end)
ELSE
CASE
WHEN (".$lpd["min_laporan_tabel"]." is not null or ".$lpd["min_laporan_tabel"]." <> '')
THEN SUM(case when waktu_tunggu < ".$lpd["max_laporan_tabel"]." then 1 else 0 end)
ELSE SUM(case when waktu_tunggu BETWEEN ".$lpd["min_laporan_tabel"]." and ".$lpd["max_laporan_tabel"]." then 1 else 0 end)
AS total
			");*/
		if(!empty($lpd["min_laporan_tabel"] && !empty($lpd["max_laporan_tabel"]))){
		$this->db->select("
if (waktu_tunggu BETWEEN ".$lpd["min_laporan_tabel"]." and ".$lpd["max_laporan_tabel"]." ,SUM(case when waktu_tunggu BETWEEN ".$lpd["min_laporan_tabel"]." and ".$lpd["max_laporan_tabel"]." then 1 else 0 end),SUM(case when waktu_tunggu < ".$lpd["min_laporan_tabel"]." or waktu_tunggu > ".$lpd["max_laporan_tabel"]." then 1 else 0 end)) as total,
			if(waktu_tunggu BETWEEN ".$lpd["min_laporan_tabel"]." and ".$lpd["max_laporan_tabel"].",'Standar','Non Standar') as nama_lhu,
				DATE_FORMAT(tgl_tr,'%d-%m-%Y') as tgl_tr,
				DATE_FORMAT(tgl_tr,'%Y') as thn,
				DATE_FORMAT(tgl_tr,'%m') as bln,
				DATE_FORMAT(tgl_tr,'%d') as hr

			");
		}elseif(!empty($lpd["max_laporan_tabel"])){
		$this->db->select("
if (waktu_tunggu < ".$lpd["max_laporan_tabel"]." ,SUM(case when waktu_tunggu < ".$lpd["max_laporan_tabel"]." then 1 else 0 end),SUM(case when waktu_tunggu >= ".$lpd["max_laporan_tabel"]." then 1 else 0 end)) as total,
			if(waktu_tunggu < ".$lpd["max_laporan_tabel"].",'Standar','Non Standar') as nama_lhu,
				DATE_FORMAT(tgl_tr,'%d-%m-%Y') as tgl_tr,
				DATE_FORMAT(tgl_tr,'%Y') as thn,
				DATE_FORMAT(tgl_tr,'%m') as bln,
				DATE_FORMAT(tgl_tr,'%d') as hr

			");
		}else{
		$this->db->select("
if (waktu_tunggu > ".$lpd["min_laporan_tabel"]." ,SUM(case when waktu_tunggu > ".$lpd["min_laporan_tabel"]." then 1 else 0 end),SUM(case when waktu_tunggu <= ".$lpd["min_laporan_tabel"]." then 1 else 0 end)) as total,
			if(waktu_tunggu > ".$lpd["min_laporan_tabel"].",'Standar','Non Standar') as nama_lhu,
				DATE_FORMAT(tgl_tr,'%d-%m-%Y') as tgl_tr,
				DATE_FORMAT(tgl_tr,'%Y') as thn,
				DATE_FORMAT(tgl_tr,'%m') as bln,
				DATE_FORMAT(tgl_tr,'%d') as hr

			");			
		}
		$this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=time_respon.id_kewenangan','left');
		$this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
		$this->db->where('tgl_tr BETWEEN "'. $lpd['tgl_awal']. '" and "'. $lpd['tgl_akhir'].'"');
		if(!empty($lpd['time'])){
			$idlh = explode(',', $lpd['time']);
			$this->db->where_in("id_tr",$idlh); // nama_lhu - tgl_lhu
		}else{
			$this->db->where("barcode_pegawai",$lpd['barcode_pegawai']);
		}
		$this->db->group_by('time_respon.id_kewenangan');
		$q = $this->db->get_where('time_respon')->result_array();
		return $q;
    }
	function grafik_pie_opsi_logbook($id,$grup=FALSE)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
		$this->db->select("nkk.id_kompetensi  as id_lhu,jml_logbook as hasil_lhu_detil,SUM(jml_logbook) as total,
				DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_lhu,nama_kewenangan as nama_lhu,
				DATE_FORMAT(tgl_logbook,'%Y') as thn,
				DATE_FORMAT(tgl_logbook,'%m') as bln,
				DATE_FORMAT(tgl_logbook,'%d') as hr
			");
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
		if($lpd['kompetensi'] == "" OR empty($lpd['kompetensi'])){
			$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		}else{
			$idx = explode(',', $lpd['kompetensi']);
			$this->db->where_in("nkk.id_kompetensi",$idx);
			$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		}
		if(!empty($lpd['isi_kompetensi'])){
			$idlb = explode(',', $lpd['isi_kompetensi']);
			$this->db->where_in("ol.id_logbook",$idlb);
		}
		if($lpd['kewenangan'] == "0" OR empty($lpd['kewenangan'])){
			$this->db->group_by('nkk.id_kewenangan');
		}else{
			if($lpd['kewenangan'] == 1){
				$this->db->group_by('nkk.id_kewenangan');
			}else{
				$this->db->group_by('nkk.id_kompetensi');
			}
		}
		$this->db->where('jml_logbook >',0);
		$q = $this->db->get_where('ol_logbook ol')->result_array();
		return $q;
    }
	function grafik_pie_opsi_pasien($id,$bhn,$jml,$nama,$grup=FALSE)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
		$this->db->select("olp.".$bhn."  as id_lhu,".$jml." as hasil_lhu_detil,SUM(".$jml.") as total,
				DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_lhu,".$nama." as nama_lhu,
				DATE_FORMAT(tgl_logbook,'%Y') as thn,
				DATE_FORMAT(tgl_logbook,'%m') as bln,
				DATE_FORMAT(tgl_logbook,'%d') as hr
			");
		$this->db->join('ol_logbook ol', 'ol.id_logbook=olp.id_logbook','left');
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
/*		$this->db->join('kol_reject krj', 'krj.id_reject=olp.id_reject','left');
		$this->db->join('ol_bahan obh', 'obh.id_bahan=olp.id_bahan','left');*/
		if($lpd['kompetensi'] == "" OR empty($lpd['kompetensi'])){
			$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		}else{
			$idx = explode(',', $lpd['kompetensi']);
			$this->db->where_in("nkk.id_kompetensi",$idx);
			$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		}
		$this->db->where($jml.' >',0);
		if($grup){
			$this->db->group_by('olp.'.$grup);
		}
		if(!empty($lpd['isi_kompetensi'])){
			$idlb = explode(',', $lpd['isi_kompetensi']);
			$this->db->where_in("ol.id_logbook",$idlb);
		}
		$q = $this->db->get_where('ol_logbook_pasien olp')->result_array();
		return $q;
    }
	function grafik_pie_pakai_opsi_pasien($id,$bhn,$jml,$nama,$grup=FALSE)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
		$this->db->select("olpk.".$bhn."  as id_lhu,".$jml." as hasil_lhu_detil,SUM(".$jml.") as total,
				DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_lhu,".$nama." as nama_lhu,
				DATE_FORMAT(tgl_logbook,'%Y') as thn,
				DATE_FORMAT(tgl_logbook,'%m') as bln,
				DATE_FORMAT(tgl_logbook,'%d') as hr
			");
		$this->db->join('ol_logbook_pasien olp', 'olp.id_logbook_pasien=olpk.id_logbook_pasien','left');
		$this->db->join('ol_logbook ol', 'ol.id_logbook=olp.id_logbook','left');
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
	//	$this->db->join('kol_reject krj', 'krj.id_reject=olp.id_reject','left');
		$this->db->join('ol_bahan obh', 'obh.id_bahan=olp.id_bahan','left');
		if($lpd['kompetensi'] == "" OR empty($lpd['kompetensi'])){
			$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		}else{
			$idx = explode(',', $lpd['kompetensi']);
			$this->db->where_in("nkk.id_kompetensi",$idx);
			$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		}
		$this->db->where($jml.' >',0);
		if($grup){
			$this->db->group_by('olpk.'.$grup);
		}
		if(!empty($lpd['isi_kompetensi'])){
			$idlb = explode(',', $lpd['isi_kompetensi']);
			$this->db->where_in("ol.id_logbook",$idlb);
		}
		$q = $this->db->get_where('ol_logbook_pakai olpk')->result_array();
		return $q;
    }
	function grafik_pie_reject_opsi_pasien($id,$bhn,$jml,$nama,$grup=FALSE)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
		$this->db->select("olpk.".$bhn."  as id_lhu,".$jml." as hasil_lhu_detil,SUM(".$jml.") as total,
				DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_lhu,".$nama." as nama_lhu,
				DATE_FORMAT(tgl_logbook,'%Y') as thn,
				DATE_FORMAT(tgl_logbook,'%m') as bln,
				DATE_FORMAT(tgl_logbook,'%d') as hr
			");
		$this->db->join('ol_logbook_pasien olp', 'olp.id_logbook_pasien=olpk.id_logbook_pasien','left');
		$this->db->join('ol_logbook ol', 'ol.id_logbook=olp.id_logbook','left');
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
		$this->db->join('kol_reject krj', 'krj.id_reject=olp.id_reject','left');
		$this->db->join('ol_bahan obh', 'obh.id_bahan=olp.id_bahan','left');
		if($lpd['kompetensi'] == "" OR empty($lpd['kompetensi'])){
			$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		}else{
			$idx = explode(',', $lpd['kompetensi']);
			$this->db->where_in("nkk.id_kompetensi",$idx);
			$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		}
		$this->db->where($jml.' >',0);
		if($grup){
			$this->db->group_by('olpk.'.$grup);
		}
		if(!empty($lpd['isi_kompetensi'])){
			$idlb = explode(',', $lpd['isi_kompetensi']);
			$this->db->where_in("ol.id_logbook",$idlb);
		}
		$q = $this->db->get_where('ol_logbook_reject olpk')->result_array();
		return $q;
    }
	function grafik_pie_opsi_lhu($id,$grup=FALSE)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
		$this->db->select("olp.id_lhu as id_lhu,SUM(hasil_lhu_detil) as total,olil.nama_item_lhu as nama_lhu,
				DATE_FORMAT(tgl_lhu,'%d-%m-%Y') as tgl_lhu,hasil_lhu_detil,
				DATE_FORMAT(tgl_lhu,'%Y') as thn,
				DATE_FORMAT(tgl_lhu,'%m') as bln,
				DATE_FORMAT(tgl_lhu,'%d') as hr
			");
		$this->db->join('ol_logbook_item_lhu olil', 'olil.id_item_lhu=olp.id_item_lhu','left');
		$this->db->join('ol_logbook_lhu ol', 'ol.id_lhu=olp.id_lhu','left');
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		if($lpd['i_mutu'] == "" OR empty($lpd['i_mutu'])){
		}else{
			$idlh = explode(',', $lpd['i_mutu']);
			$this->db->where_in("olp.id_lhu",$idlh);
		}
		if($lpd['item_lhu'] == "" OR empty($lpd['item_lhu'])){
		}else{
			$idilhu = explode(',', $lpd['item_lhu']);
			$this->db->where_in("olil.id_item_lhu",$idilhu);
		}
		if($grup){
			$this->db->group_by('olp.'.$grup);
		}
		$q = $this->db->get_where('ol_logbook_lhu_detil olp')->result_array();
		return $q;
    }
	function grafik_pie_tindakan_daftar($id,$grup=FALSE)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
		$this->db->select("td.id_tindakan as id_lhu,count(id_daftar) as total,t.nama_tindakan as nama_lhu,
				DATE_FORMAT(tgl_daftar,'%d-%m-%Y') as tgl_lhu,count(id_daftar) as hasil_lhu_detil,
				DATE_FORMAT(tgl_daftar,'%Y') as thn,
				DATE_FORMAT(tgl_daftar,'%m') as bln,
				DATE_FORMAT(tgl_daftar,'%d') as hr
			");
		$this->db->join('tindakan t', 't.id_tindakan=td.id_tindakan','left');
		$this->db->join('kol_golongan_pemeriksaan kgp', 'kgp.id_golongan_pemeriksaan=t.id_golongan_pemeriksaan','left');
		$this->db->join('ol_unit ou', 'ou.id_unit=kgp.id_unit','left');
		$this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
		$this->db->where("ou.id_instansi",$lpd['id_instansi']);
		if(!empty($lpd['tindakan'])){
			$idlh = explode(',', $lpd['tindakan']);
			$this->db->where_in("td.id_tindakan",$idl); // nama_lhu - tgl_lhu
		}
		if($grup){
			$this->db->group_by($grup);
		}
		$this->db->order_by('t.id_golongan_pemeriksaan','asc');
		$q = $this->db->get_where('tindakan_daftar td',array('kgp.id_unit'=>$lpd['id_unit']))->result_array();
		return $q;
    }
	function ambil_imutu_range($id)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
	//	$this->db->select("id_lhu,nama_lhu_detil,tgl_lhu");
		$this->db->join('ol_logbook_lhu oll', 'oll.id_lhu=olp.id_lhu','left');
		$this->db->join('ol_logbook_item_lhu olil', 'olil.id_item_lhu=olp.id_item_lhu','left');
		$this->db->join('ol_equipment oe', 'oe.id_equipment=olil.id_equipment','left');
		$this->db->where('oll.tgl_lhu BETWEEN "'. $lpd['tgl_awal']. '" and "'. $lpd['tgl_akhir'].'"');
		if(!empty($lpd['i_mutu'])){
			$idlh = explode(',', $lpd['i_mutu']);
			$this->db->where_in("olp.id_lhu",$idlh); // nama_lhu - tgl_lhu
		}
		if(!empty($lpd['item_lhu'])){
			$idilhu = explode(',', $lpd['item_lhu']);
			$this->db->where_in("olil.id_item_lhu",$idilhu); // nama_item_lhu
		}
		if(!empty($lpd['id_lhu'])){
			$idlb = explode(',', $lpd['id_lhu']);
			$this->db->where_in("olil.id_equipment",$idlb); //nama_equipment
		}
		$this->db->order_by('oe.id_equipment','asc');
		$query = $this->db->get_where('ol_logbook_lhu_detil olp',array('barcode_pegawai'=>$lpd['barcode_pegawai']));
		return $query->result_array();
	}
	function ambil_item_lhu($id)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
		$this->db->join('ol_logbook_lhu oll', 'oll.id_lhu=olp.id_lhu','left');
		$this->db->join('ol_logbook_item_lhu olil', 'olil.id_item_lhu=olp.id_item_lhu','left');
		$this->db->join('ol_equipment oe', 'oe.id_equipment=olil.id_equipment','left');
		if(!empty($lpd['i_mutu'])){
			$idlh = explode(',', $lpd['i_mutu']);
			$this->db->where_in("olp.id_lhu",$idlh); // nama_lhu - tgl_lhu
		}
		if(!empty($lpd['item_lhu'])){
			$idilhu = explode(',', $lpd['item_lhu']);
			$this->db->where_in("olil.id_item_lhu",$idilhu); // nama_item_lhu
		}
		if(!empty($lpd['id_lhu'])){
			$idlb = explode(',', $lpd['id_lhu']);
			$this->db->where_in("olil.id_equipment",$idlb); //nama_equipment
		}
		$this->db->group_by('olp.id_item_lhu');
		$q = $this->db->get_where('ol_logbook_lhu_detil olp',array('oll.barcode_pegawai'=>$lpd['barcode_pegawai']))->result_array();
		return $q;
    }
	function ambil_time_laporan($id,$select,$kondisi,$grup=FALSE)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id); //id_laporan_tabel
		$this->db->select($select);
		$this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=time_respon.id_kewenangan','left');
		$this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
		$this->db->where('tgl_tr BETWEEN "'. $lpd['tgl_awal']. '" and "'. $lpd['tgl_akhir'].'"');
		if(!empty($lpd['time'])){
			$idlh = explode(',', $lpd['time']);
			$this->db->where_in("id_tr",$idlh); // nama_lhu - tgl_lhu
		}else{
			$this->db->where("barcode_pegawai",$lpd['barcode_pegawai']);
		}
		if($grup){
			$this->db->group_by($grup);
		}
	//	$this->db->group_by("MONTH(tgl_lhu)");
	//	$this->db->order_by('olil.id_equipment','asc');
		$q = $this->db->get_where('time_respon',$kondisi)->result_array();
//	echo $this->db->last_query();die();
	//print_r($q);die();
		return $q;
    }
	function ambil_all_berkas_laporan($id,$select,$kondisi,$grup=FALSE)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id); //id_laporan_tabel
		$this->db->select($select);
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_berkas.id_pegawai','left');
		$this->db->join('ol_berkas_kategori', 'ol_berkas_kategori.id_berkas_kategori=ol_berkas.id_kategori_berkas','left');
		$this->db->join('ol_kategori_pelatihan', 'ol_kategori_pelatihan.id_kategori_pelatihan=ol_berkas.id_kategori_pelatihan','left');
		$this->db->join('kol_pendidikan', 'kol_pendidikan.id_pendidikan=ol_berkas.id_pendidikan','left');
	//	$this->db->where('tgl_b_berkas BETWEEN "'. $lpd['tgl_awal']. '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where("barcode_pegawai",$lpd['barcode_pegawai']);
		if($grup){
			$this->db->group_by($grup);
		}
	//	$this->db->group_by("MONTH(tgl_lhu)");
	//	$this->db->order_by('olil.id_equipment','asc');
		$q = $this->db->get_where('ol_berkas',$kondisi)->result_array();
//	echo $this->db->last_query();die();
	//print_r($q);die();
		return $q;
    }
	function ambil_berkas_laporan($id,$select,$kondisi,$grup=FALSE)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id); //id_laporan_tabel
		$this->db->select($select);
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_berkas.id_pegawai','left');
		$this->db->join('ol_berkas_kategori', 'ol_berkas_kategori.id_berkas_kategori=ol_berkas.id_kategori_berkas','left');
		$this->db->join('ol_kategori_pelatihan', 'ol_kategori_pelatihan.id_kategori_pelatihan=ol_berkas.id_kategori_pelatihan','left');
		$this->db->join('kol_pendidikan', 'kol_pendidikan.id_pendidikan=ol_berkas.id_pendidikan','left');
		$this->db->where('tgl_b_berkas BETWEEN "'. $lpd['tgl_awal']. '" and "'. $lpd['tgl_akhir'].'"');
		$idlh = explode(',', $lpd['berkas']);
		$this->db->where_in("id_berkas",$idlh); // nama_lhu - tgl_lhu
		$this->db->where("barcode_pegawai",$lpd['barcode_pegawai']);
		if($grup){
			$this->db->group_by($grup);
		}
	//	$this->db->group_by("MONTH(tgl_lhu)");
	//	$this->db->order_by('olil.id_equipment','asc');
		$q = $this->db->get_where('ol_berkas',$kondisi)->result_array();
//	echo $this->db->last_query();die();
	//print_r($q);die();
		return $q;
    }
	function ambil_universal_bulan_lhu($id,$select,$grup=FALSE)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id); //id_laporan_tabel
	//	$this->db->select("CONCAT(MONTH(tgl_lhu)),'-',(YEAR(tgl_lhu)) as year_month");
		$this->db->join('ol_logbook_lhu oll', 'oll.id_lhu=olp.id_lhu','left');
		$this->db->join('ol_logbook_item_lhu olil', 'olil.id_item_lhu=olp.id_item_lhu','left');
		$this->db->join('ol_equipment oe', 'oe.id_equipment=olil.id_equipment','left');
		$this->db->where('oll.tgl_lhu BETWEEN "'. $lpd['tgl_awal']. '" and "'. $lpd['tgl_akhir'].'"');
		if(!empty($lpd['i_mutu'])){
			$idlh = explode(',', $lpd['i_mutu']);
			$this->db->where_in("olp.id_lhu_detil",$idlh); // nama_lhu - tgl_lhu
		}else{
			$this->db->where("oll.barcode_pegawai",$lpd['barcode_pegawai']);
		}
		if(!empty($lpd['item_lhu'])){
			$idilhu = explode(',', $lpd['item_lhu']);
			$this->db->where_in("olil.id_item_lhu",$idilhu); // nama_item_lhu
		}
/*		if(!empty($lpd['id_lhu'])){
			$idlb = explode(',', $lpd['id_lhu']);
			$this->db->where_in("olil.id_equipment",$idlb); //nama_equipment
		}*/
		$this->db->group_by("MONTH(tgl_lhu)");
		$this->db->order_by('olil.id_equipment','asc');
		$q = $this->db->get_where('ol_logbook_lhu_detil olp')->result_array();
//	echo $this->db->last_query();die();
	//print_r($q);die();
		return $q;
    }
	function print_laporan_universal_lhu($first_date,$id,$id_pegawai,$select)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id); //id_laporan_tabel
		$this->db->select($select);
		$this->db->join('ol_logbook_lhu oll', 'oll.id_lhu=olp.id_lhu','left');
		$this->db->join('ol_logbook_item_lhu olil', 'olil.id_item_lhu=olp.id_item_lhu','left');
		$this->db->join('ol_equipment oe', 'oe.id_equipment=olil.id_equipment','left');
		$this->db->join('ol_unit ou', 'ou.id_unit=oe.id_unit','left');
		$this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
		$this->db->where("oe.id_unit",$lpd['id_unit']);
	//	$this->db->where("barcode_pegawai", $id_pegawai);
		if(!empty($lpd['i_mutu'])){
			$idlh = explode(',', $lpd['i_mutu']);
			$this->db->where_in("olp.id_lhu_detil",$idlh); // nama_lhu - tgl_lhu
		}else{
			$this->db->where("oll.barcode_pegawai",$id_pegawai);
		}
		if(!empty($lpd['item_lhu'])){
			$idilhu = explode(',', $lpd['item_lhu']);
			$this->db->where_in("olil.id_item_lhu",$idilhu); // nama_item_lhu
		}
/*		if(!empty($lpd['id_lhu'])){
			$idlb = explode(',', $lpd['id_lhu']);
			$this->db->where_in("olil.id_equipment",$idlb); //nama_equipment
		}*/
		$this->db->where("DATE_FORMAT(tgl_lhu,'%Y-%m')", $first_date);
		$this->db->group_by('olp.id_item_lhu');
		$q = $this->db->get_where('ol_logbook_lhu_detil olp')->result_array();
//	echo $this->db->last_query();die();
	//print_r($q);die();
		return $q;
	}
    function jumlah_record_logbook_laporan_lhu($id_pegawai,$tglenya,$id_kewenangan,$ir)
    {
		$this->db->join('ol_logbook_lhu oll', 'oll.id_lhu=olp.id_lhu','left');
		$this->db->join('ol_logbook_item_lhu olil', 'olil.id_item_lhu=olp.id_item_lhu','left');
		$this->db->join('ol_equipment oe', 'oe.id_equipment=olil.id_equipment','left');
		$this->db->join('ol_unit ou', 'ou.id_unit=oe.id_unit','left');
		$this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
		$this->db->where('tgl_lhu',$tglenya);
		$this->db->where("barcode_pegawai", $id_pegawai);
		$this->db->where("olil.id_item_lhu", $id_kewenangan);
		$this->db->where("ou.id_instansi", $ir);
        $query = $this->db->select("COUNT(*) as num")->get_where('ol_logbook_lhu_detil olp');
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
    }
	function total_record_logbook_laporan_lhu($id_pegawai,$tglenya,$id_kewenangan,$ir){
		$this->db->select('SUM(hasil_lhu_detil) as jumlahe');
		$this->db->join('ol_logbook_lhu oll', 'oll.id_lhu=olp.id_lhu','left');
		$this->db->join('ol_logbook_item_lhu olil', 'olil.id_item_lhu=olp.id_item_lhu','left');
		$this->db->join('ol_equipment oe', 'oe.id_equipment=olil.id_equipment','left');
		$this->db->join('ol_unit ou', 'ou.id_unit=oe.id_unit','left');
		$this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
		$this->db->where('tgl_lhu',$tglenya);
		$this->db->where("barcode_pegawai", $id_pegawai);
		$this->db->where("olil.id_item_lhu", $id_kewenangan);
		if($ir > 0){
		$this->db->where("ou.id_instansi", $ir);
		}
		$q = $this->db->get_where('ol_logbook_lhu_detil olp');
		return $q->result_array();
	}
	function ambil_universal_lhu($id,$select,$grup=FALSE)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id); //id_laporan_tabel
		$this->db->select($select);
		$this->db->join('ol_logbook_lhu oll', 'oll.id_lhu=olp.id_lhu','left');
		$this->db->join('ol_logbook_item_lhu olil', 'olil.id_item_lhu=olp.id_item_lhu','left');
		$this->db->join('ol_equipment oe', 'oe.id_equipment=olil.id_equipment','left');
		$this->db->join('ol_unit ou', 'ou.id_unit=oe.id_unit','left');
		$this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
		$this->db->where("ou.id_instansi",$lpd['id_instansi']);
		if(!empty($lpd['i_mutu'])){
			$idlh = explode(',', $lpd['i_mutu']);
			$this->db->where_in("olp.id_lhu_detil",$idlh); // nama_lhu - tgl_lhu
		}else{
			$this->db->where("oll.barcode_pegawai",$lpd['barcode_pegawai']);
		}
		if(!empty($lpd['item_lhu'])){
			$idilhu = explode(',', $lpd['item_lhu']);
			$this->db->where_in("olil.id_item_lhu",$idilhu); // nama_item_lhu
		}
/*		if(!empty($lpd['id_lhu'])){
			$idlb = explode(',', $lpd['id_lhu']);
			$this->db->where_in("olil.id_equipment",$idlb); //nama_equipment
		}*/
		if($grup){
			$this->db->group_by($grup);
		}
		$this->db->order_by('olil.id_equipment','asc');
		$q = $this->db->get_where('ol_logbook_lhu_detil olp')->result_array();
//	echo $this->db->last_query();die();
	//print_r($q);die();
		return $q;
    }
	function ambil_daftar_tindakan_lhu($id,$select,$grup=FALSE)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id); //id_laporan_tabel
		$this->db->select($select);
		$this->db->join('tindakan t', 't.id_tindakan=td.id_tindakan','left');
		$this->db->join('kol_golongan_pemeriksaan kgp', 'kgp.id_golongan_pemeriksaan=t.id_golongan_pemeriksaan','left');
		$this->db->join('ol_unit ou', 'ou.id_unit=td.unit_pengirim','left');
		$this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
		$this->db->where("ou.id_instansi",$lpd['id_instansi']);
		if(!empty($lpd['tindakan'])){
			$idlh = explode(',', $lpd['tindakan']);
			$this->db->where_in("td.id_tindakan",$idlh); // nama_lhu - tgl_lhu
		}
		if($grup){
			$this->db->group_by($grup);
		}
		$this->db->order_by('t.id_golongan_pemeriksaan','asc');
		$q = $this->db->get_where('tindakan_daftar td',array('kgp.id_unit'=>$lpd['id_unit']))->result_array();
//	echo $this->db->last_query();die();
	//print_r($q);die();
		return $q;
    }
	function ambil_logbook_berkas($id,$kondisi,$order,$asc,$select=FALSE,$grup=FALSE)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id); //id_laporan_tabel
		if($select){
			$this->db->select($select);
		}
	//	$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_berkas.id_pegawai','left');
		$this->db->join('ol_berkas_kategori', 'ol_berkas_kategori.id_berkas_kategori=ol_berkas.id_kategori_berkas','left');
		$this->db->join('ol_kategori_pelatihan', 'ol_kategori_pelatihan.id_kategori_pelatihan=ol_berkas.id_kategori_pelatihan','left');
		$this->db->join('kol_pendidikan', 'kol_pendidikan.id_pendidikan=ol_berkas.id_pendidikan','left');
		$this->db->where($kondisi);
		//if(!empty($lpd['berkas'])){
			$idlh = explode(',', $lpd['berkas']);
			$this->db->where_in("id_berkas",$idlh);
		//}
		if($grup){
			$this->db->group_by($grup);
		}
		$this->db->order_by($order,$asc);
		$q = $this->db->get_where('ol_berkas',array('id_pegawai'=>$lpd['id_pegawai']))->result_array();
		//echo $this->db->last_query();die();
		//print_r($q);die();
		return $q;
    }
	function jumlah_record_filter_berkas($id,$kondisi)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id); //id_laporan_tabel
	//	$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_berkas.id_pegawai','left');
		$this->db->join('ol_berkas_kategori', 'ol_berkas_kategori.id_berkas_kategori=ol_berkas.id_kategori_berkas','left');
		$this->db->join('ol_kategori_pelatihan', 'ol_kategori_pelatihan.id_kategori_pelatihan=ol_berkas.id_kategori_pelatihan','left');
		$this->db->join('kol_pendidikan', 'kol_pendidikan.id_pendidikan=ol_berkas.id_pendidikan','left');
		$this->db->where($kondisi);
	//	if(!empty($lpd['berkas'])){
			$idlh = explode(',', $lpd['berkas']);
			$this->db->where_in("id_berkas",$idlh);
	//	}
        $query = $this->db->select("COUNT(*) as num")->get_where('ol_berkas',array('id_pegawai'=>$lpd['id_pegawai']));
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
    }
	function ambil_tindakan_daftar_bulan_lhu($id,$select,$grup=FALSE)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id); //id_laporan_tabel
	//	$this->db->select("CONCAT(MONTH(tgl_lhu)),'-',(YEAR(tgl_lhu)) as year_month");
		$this->db->join('tindakan t', 't.id_tindakan=td.id_tindakan','left');
		$this->db->join('kol_golongan_pemeriksaan kgp', 'kgp.id_golongan_pemeriksaan=t.id_golongan_pemeriksaan','left');
		$this->db->join('ol_unit ou', 'ou.id_unit=kgp.id_unit','left');
		$this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
		$this->db->where('td.tgl_daftar BETWEEN "'. $lpd['tgl_awal']. '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where("ou.id_instansi",$lpd['id_instansi']);
		if(!empty($lpd['tindakan'])){
			$idlh = explode(',', $lpd['tindakan']);
			$this->db->where_in("td.id_tindakan",$idlh); // nama_lhu - tgl_lhu
		}
		$this->db->group_by("MONTH(tgl_daftar)");
		$this->db->order_by('t.id_golongan_pemeriksaan','asc');
		$q = $this->db->get_where('tindakan_daftar td',array('kgp.id_unit'=>$lpd['id_unit']))->result_array();
//	echo $this->db->last_query();die();
	//print_r($q);die();
		return $q;
    }
	function grafik_garis_tindakan_daftar_lhu($id,$select,$grup=FALSE)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
		$this->db->select($select);
		$this->db->join('tindakan t', 't.id_tindakan=td.id_tindakan','left');
		$this->db->join('kol_golongan_pemeriksaan kgp', 'kgp.id_golongan_pemeriksaan=t.id_golongan_pemeriksaan','left');
		$this->db->join('ol_unit ou', 'ou.id_unit=kgp.id_unit','left');
		$this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
		$this->db->where("ou.id_instansi",$lpd['id_instansi']);
		if(!empty($lpd['tindakan'])){
			$idlh = explode(',', $lpd['tindakan']);
			$this->db->where_in("td.id_tindakan",$idlh); // nama_lhu - tgl_lhu
		}
		if($grup){
			$this->db->group_by($grup);
		}
		$q = $this->db->get_where('tindakan_daftar td',array('kgp.id_unit'=>$lpd['id_unit']))->result_array();
	//	echo $this->db->last_query();die();
		return $q;
    }
	function print_logbook_laporan_daftar_tindakan_bulanane($first_date,$id,$peg)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
		$idl = explode(',', $lpd['tindakan']);
		$this->db->select('*,count(id_daftar) as jumlaha,td.id_tindakan,nama_tindakan as nama_kompetensi');
		$this->db->join('tindakan t', 't.id_tindakan=td.id_tindakan','left');
		$this->db->join('kol_golongan_pemeriksaan kgp', 'kgp.id_golongan_pemeriksaan=t.id_golongan_pemeriksaan','left');
		$this->db->join('ol_unit ou', 'ou.id_unit=kgp.id_unit','left');
		$this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
		$this->db->where("ou.id_instansi",$lpd['id_instansi']);
		if(!empty($lpd['tindakan'])){
			$idlh = explode(',', $lpd['tindakan']);
			$this->db->where_in("td.id_tindakan",$idl); // nama_lhu - tgl_lhu
		}
		$this->db->where("DATE_FORMAT(td.tgl_daftar,'%Y-%m')", $first_date);
		$this->db->group_by('td.id_tindakan');
		$q = $this->db->get_where('tindakan_daftar td',array('td.unit_tindakan'=>$lpd['id_unit']))->result_array();	
	//	$q = $this->db->get_where('tindakan_daftar td')->result_array();	
	//	print_r($q);die();
		return $q;
	}
    function jumlah_record_logbook_laporan_tindakan_daftar($id_pegawai,$tglenya,$id_kewenangan,$ir)
    {
    	$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id_pegawai);
		$this->db->join('tindakan t', 't.id_tindakan=td.id_tindakan','left');
		$this->db->join('kol_golongan_pemeriksaan kgp', 'kgp.id_golongan_pemeriksaan=t.id_golongan_pemeriksaan','left');
		$this->db->join('ol_unit ou', 'ou.id_unit=kgp.id_unit','left');
		$this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
/*		$this->db->where("ou.id_instansi",$lpd['id_instansi']);
		if(!empty($lpd['tindakan'])){
			$idlh = explode(',', $lpd['tindakan']);
			$this->db->where_in("td.id_tindakan",$idl); // nama_lhu - tgl_lhu
		}*/
		$this->db->where('tgl_daftar',$tglenya);
		$this->db->where("kgp.id_unit", $lpd['id_unit']);
		$this->db->where("td.id_tindakan", $id_kewenangan);
        $query = $this->db->select("COUNT(*) as num")->get_where('tindakan_daftar td');
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
    }
	function total_record_logbook_laporan_daftar_tindakan($id_pegawai,$tglenya,$id_kewenangan,$ir){
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id_pegawai);
		$this->db->select('count(id_daftar) as jumlahe');
		$this->db->join('tindakan t', 't.id_tindakan=td.id_tindakan','left');
		$this->db->join('kol_golongan_pemeriksaan kgp', 'kgp.id_golongan_pemeriksaan=t.id_golongan_pemeriksaan','left');
		$this->db->join('ol_unit ou', 'ou.id_unit=kgp.id_unit','left');
		$this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
		$this->db->where('tgl_daftar',$tglenya);
		$this->db->where("kgp.id_unit", $lpd['id_unit']);
		$this->db->where("td.id_tindakan", $id_kewenangan);
		$q = $this->db->get_where('tindakan_daftar td');
		return $q->result_array();
	}
	function ambil_laporan_tindakan_daftar_tabel14($id)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id); //id_laporan_tabel
		$this->db->select("*,count(td.id_tindakan) as jml_logbook,concat(nama_tindakan,' [ ',nama_golongan_pemeriksaan,']') as nama_kompetensi");
		$this->db->join('tindakan t', 't.id_tindakan=td.id_tindakan','left');
		$this->db->join('kol_golongan_pemeriksaan kgp', 'kgp.id_golongan_pemeriksaan=t.id_golongan_pemeriksaan','left');
		$this->db->join('ol_unit ou', 'ou.id_unit=kgp.id_unit','left');
		$this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
		$this->db->where("ou.id_instansi",$lpd['id_instansi']);
		if(!empty($lpd['tindakan'])){
			$idlh = explode(',', $lpd['tindakan']);
			$this->db->where_in("td.id_tindakan",$idl); // nama_lhu - tgl_lhu
		}
		$this->db->group_by('td.id_tindakan');
		$this->db->order_by('t.id_golongan_pemeriksaan','asc');
		$q = $this->db->get_where('tindakan_daftar td',array('kgp.id_unit'=>$lpd['id_unit']))->result_array();
//	echo $this->db->last_query();die();
	//print_r($q);die();
		return $q;
    }
	//======================= GRAFIK NEW
//	$query = $this->db->query("select * from tbl_user");
	function ambil_grafik_range_new($lhu,$tabel,$select,$kondisi,$id,$grup=FALSE,$limit=FALSE)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id); //id_laporan_tabel
		$this->db->select($select);
		if($lhu == 1){
			$this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
			$this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
			$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
			$idl = explode(',', $lpd['kompetensi']);
			$idlb = explode(',', $lpd['isi_kompetensi']);
			if(!empty($lpd['isi_kompetensi'])){
				$this->db->where_in("ol_logbook.id_logbook",$idlb);
			}
			if(!empty($lpd['kompetensi'])){
				$this->db->where_in("nkr_kewenangan.id_kompetensi",$idl);
			}
		}
		if($lhu == 2){
			$this->db->join('ol_logbook_pasien', 'ol_logbook_pasien.id_logbook_pasien=ol_logbook_pakai.id_logbook_pasien','left');
			$this->db->join('ol_logbook', 'ol_logbook.id_logbook=ol_logbook_pasien.id_logbook','left');
			$this->db->join('ol_bahan', 'ol_bahan.id_bahan=ol_logbook_pakai.id_bahan','left');
			$this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
			$this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
			$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
			if(!empty($lpd['kompetensi'])){
				$idl = explode(',', $lpd['kompetensi']);
				$this->db->where_in("nkr_kewenangan.id_kompetensi",$idl);
			}
			if(!empty($lpd['bahan'])){
				$idc = explode(',', $lpd['bahan']);
				$this->db->where_in("ol_logbook_pakai.id_bahan",$idc);
			}
			if(!empty($lpd['isi_kompetensi'])){
				$idlb = explode(',', $lpd['isi_kompetensi']);
				$this->db->where_in("ol_logbook_pasien.id_logbook",$idlb);
			}
		}
		if($lhu == 3){
			$this->db->join('ol_logbook_pasien', 'ol_logbook_pasien.id_logbook_pasien=ol_logbook_reject.id_logbook_pasien','left');
			$this->db->join('ol_logbook', 'ol_logbook.id_logbook=ol_logbook_pasien.id_logbook','left');
			$this->db->join('ol_bahan', 'ol_bahan.id_bahan=ol_logbook_reject.id_bahan','left');
			$this->db->join('kol_reject', 'kol_reject.id_reject=ol_logbook_reject.id_reject','left');
			$this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
			$this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
			$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
			if(!empty($lpd['kompetensi'])){
				$idl = explode(',', $lpd['kompetensi']);
				$this->db->where_in("nkr_kewenangan.id_kompetensi",$idl);
			}
			if(!empty($lpd['bahan'])){
				$idc = explode(',', $lpd['bahan']);
				$this->db->where_in("ol_logbook_reject.id_bahan",$idc);
			}
			if(!empty($lpd['reject'])){
				$ids = explode(',', $lpd['reject']);
				$this->db->where_in("olp.id_reject",$ids);
			}
			if(!empty($lpd['isi_kompetensi'])){
				$idlb = explode(',', $lpd['isi_kompetensi']);
				$this->db->where_in("ol_logbook_pasien.id_logbook",$idlb);
			}
		}
		if($lhu == 4){
			$this->db->join('ol_logbook_lhu', 'ol_logbook_lhu.id_lhu=ol_logbook_lhu_detil.id_lhu','left');
			$this->db->join('ol_logbook_item_lhu', 'ol_logbook_item_lhu.id_item_lhu=ol_logbook_lhu_detil.id_item_lhu','left');
			$this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_logbook_item_lhu.id_equipment','left');
			$this->db->join('ol_unit', 'ol_unit.id_unit=ol_equipment.id_unit','left');
			$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal']. '" and "'. $lpd['tgl_akhir'].'"');
			if(!empty($lpd['i_mutu'])){
				$idlh = explode(',', $lpd['i_mutu']);
				$this->db->where_in("ol_logbook_lhu_detil.id_lhu_detil",$idlh); // nama_lhu - tgl_lhu
			}else{
				$this->db->where("ol_logbook_lhu.barcode_pegawai",$lpd['barcode_pegawai']);
			}
			if(!empty($lpd['item_lhu'])){
				$idilhu = explode(',', $lpd['item_lhu']);
				$this->db->where_in("ol_logbook_lhu_detil.id_item_lhu",$idilhu); // nama_item_lhu
			}	
		}
		if($lhu == 5){
			$this->db->join('tindakan', 'tindakan.id_tindakan=tindakan_daftar.id_tindakan','left');
			$this->db->join('kol_golongan_pemeriksaan', 'kol_golongan_pemeriksaan.id_golongan_pemeriksaan=tindakan.id_golongan_pemeriksaan','left');
			$this->db->join('ol_unit', 'ol_unit.id_unit=kol_golongan_pemeriksaan.id_unit','left');
			$this->db->where('tgl_daftar BETWEEN "'. $lpd['tgl_awal']. '" and "'. $lpd['tgl_akhir'].'"');
			if(!empty($lpd['tindakan'])){
				$idlh = explode(',', $lpd['tindakan']);
				$this->db->where_in("tindakan_daftar.id_tindakan",$idlh); // nama_lhu - tgl_lhu
			}
		}
		if($grup){
			$this->db->group_by($grup);
		}
		if($limit){
			$this->db->limit($limit);
		}
		$q = $this->db->get_where($tabel,$kondisi)->result_array();
		//	print_r($q);die();
			// echo $this->db->last_query();die();
		return $q;
	}
	function grafik_garis_opsi_new($lhu,$tabel,$select,$kondisi,$id,$grup=FALSE,$limit=FALSE)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id); //id_laporan_tabel
		$this->db->select($select);
		if($lhu == 1){
			$this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
			$this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
			$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
			$idl = explode(',', $lpd['kompetensi']);
			$idlb = explode(',', $lpd['isi_kompetensi']);
			if(!empty($lpd['isi_kompetensi'])){
				$this->db->where_in("ol_logbook.id_logbook",$idlb);
			}
			if(!empty($lpd['kompetensi'])){
				$this->db->where_in("nkr_kewenangan.id_kompetensi",$idl);
			}
		}
		if($grup){
			$this->db->group_by($grup);
		}
		if($limit){
			$this->db->limit($limit);
		}
		$q = $this->db->get_where($tabel,$kondisi)->result_array();	
		return $q;
    }
	function ambil_grafik_range_row($lhu,$tabel,$select,$kondisi,$id)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id); //id_laporan_tabel
		$this->db->select($select);
		if($lhu == 1){
			$this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
			$this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
			$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
			$idl = explode(',', $lpd['kompetensi']);
			$idlb = explode(',', $lpd['isi_kompetensi']);
			if(!empty($lpd['isi_kompetensi'])){
				$this->db->where_in("ol_logbook.id_logbook",$idlb);
			}
			if(!empty($lpd['kompetensi'])){
				$this->db->where_in("nkr_kewenangan.id_kompetensi",$idl);
			}
		}
/*		if($grup){
			$this->db->group_by($grup);
		}*/
	//	$this->db->order_by($order,$asc);
	//	$this->db->limit($limit);
		$q = $this->db->get_where($tabel,$kondisi)->row_array();
	//	print_r($q);die();
		return $q;
	}
	function grafik_garis_opsi_order_limit($lhu,$tabel,$select,$kondisi,$id,$order,$asc,$limit=FALSE,$grup=FALSE)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id); //id_laporan_tabel
		$this->db->select($select);
		if($lhu == 1){
			$this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
			$this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
			$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
			$idl = explode(',', $lpd['kompetensi']);
			$idlb = explode(',', $lpd['isi_kompetensi']);
			if(!empty($lpd['isi_kompetensi'])){
				$this->db->where_in("ol_logbook.id_logbook",$idlb);
			}
			if(!empty($lpd['kompetensi'])){
				$this->db->where_in("nkr_kewenangan.id_kompetensi",$idl);
			}
		}
		if($grup){
			$this->db->group_by($grup);
		}
		$this->db->order_by($order,$asc);
		if($limit){
			if($limit > 0){
				$this->db->limit($limit);
			}
		}		
		$q = $this->db->get_where($tabel,$kondisi)->result_array();	
		return $q;
    }
	function ambil_grafik_range_limit($lhu,$tabel,$select,$kondisi,$id,$limit=FALSE,$grup=FALSE)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id); //id_laporan_tabel
		$this->db->select($select);
		if($lhu == 1){
			$this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
			$this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
			$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
			$idl = explode(',', $lpd['kompetensi']);
			$idlb = explode(',', $lpd['isi_kompetensi']);
			if(!empty($lpd['isi_kompetensi'])){
				$this->db->where_in("ol_logbook.id_logbook",$idlb);
			}
			if(!empty($lpd['kompetensi'])){
				$this->db->where_in("nkr_kewenangan.id_kompetensi",$idl);
			}
		}
		if($grup){
			$this->db->group_by($grup);
		}
		$this->db->limit($limit);
		$q = $this->db->get_where($tabel,$kondisi)->result_array();
	//	print_r($q);die();
		return $q;
	}
	function grafik_garis_opsi_limit($lhu,$tabel,$select,$kondisi,$id,$limit=FALSE,$grup=FALSE)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id); //id_laporan_tabel
		$this->db->select($select);
		if($lhu == 1){
			$this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
			$this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
			$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
			$idl = explode(',', $lpd['kompetensi']);
			$idlb = explode(',', $lpd['isi_kompetensi']);
			if(!empty($lpd['isi_kompetensi'])){
				$this->db->where_in("ol_logbook.id_logbook",$idlb);
			}
			if(!empty($lpd['kompetensi'])){
				$this->db->where_in("nkr_kewenangan.id_kompetensi",$idl);
			}
		}
		if($grup){
			$this->db->group_by($grup);
		}
		$this->db->limit($limit);
		$q = $this->db->get_where($tabel,$kondisi)->result_array();	
		return $q;
    }
	function grafik_garis_opsi($tabel,$select,$kondisi,$id,$lhu,$grup=FALSE)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
		$this->db->select($select);
		if($lhu == 1){
			$this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
			$this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
/*			$idl = explode(',', $lpd['kompetensi']);
			$idlb = explode(',', $lpd['isi_kompetensi']);
			if(!empty($lpd['kompetensi'])){
				$this->db->where_in("nkr_kewenangan.id_kompetensi",$idl);
			}
			if(!empty($lpd['isi_kompetensi'])){
				$idlb = explode(',', $lpd['isi_kompetensi']);
				$this->db->where_in("ol_logbook.id_logbook",$idlb);
			}*/
		}
		if($grup){
			$this->db->group_by($grup);
		}
		$q = $this->db->get_where($tabel,$kondisi)->result_array();	
//	echo $this->db->last_query();die();
	//print_r($q);die();
		return $q;
    }
	function ambil_grafik_range($tabel,$select,$kondisi,$id,$lhu,$grup=FALSE){
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id); //id_laporan_tabel
		$this->db->select($select);
		if($lhu == 1){
			$this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
			$this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
			$idl = explode(',', $lpd['kompetensi']);
			$idlb = explode(',', $lpd['isi_kompetensi']);
			if(!empty($lpd['kompetensi'])){
				$this->db->where_in("nkr_kewenangan.id_kompetensi",$idl);
			}
			if(!empty($lpd['isi_kompetensi'])){
				$idlb = explode(',', $lpd['isi_kompetensi']);
				$this->db->where_in("ol_logbook.id_logbook",$idlb);
			}
		}
		if($grup){
			$this->db->group_by($grup);
		}
		$q = $this->db->get_where($tabel,$kondisi)->result_array();
	//	$q = $this->db->get_where('ol_logbook ol',array('ol.id_logbooker'=>$lpd['id_pegawai']))->result_array();
		//echo $this->db->last_query();die();
	//	print_r($q);die();
		return $q;
	}
	//======================= END GRAFIK NEW
	function ambil_all_universal_lhu($id,$select,$grup=FALSE)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id); //id_laporan_tabel
		$this->db->select($select);
		$this->db->join('ol_logbook_lhu oll', 'oll.id_lhu=olp.id_lhu','left');
		$this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=oll.barcode_pegawai','left');
		$this->db->join('ol_logbook_item_lhu olil', 'olil.id_item_lhu=olp.id_item_lhu','left');
		$this->db->join('ol_equipment oe', 'oe.id_equipment=olil.id_equipment','left');
		$this->db->join('ol_unit ou', 'ou.id_unit=oe.id_unit','left');
		$this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where("oe.id_unit",$lpd['id_unit']);
/*			if(!empty($lpd['i_mutu'])){
				$idlh = explode(',', $lpd['i_mutu']);
				$this->db->where_in("olp.id_lhu_detil",$idlh); // nama_lhu - tgl_lhu
			}*/
			if(!empty($lpd['item_lhu'])){
				$idilhu = explode(',', $lpd['item_lhu']);
				$this->db->where_in("olp.id_item_lhu",$idilhu); // nama_item_lhu
			}
		if($grup){
			$this->db->group_by($grup);
		}
		$this->db->order_by('oll.tgl_lhu','asc');
		$q = $this->db->get_where('ol_logbook_lhu_detil olp')->result_array();
//	echo $this->db->last_query();die();
	//print_r($q);die();
		return $q;
    }
	function ambil_lhu_detil($id,$grup=FALSE)
	{
		$this->db->join('ol_logbook_lhu ol', 'ol.id_lhu=olp.id_lhu','left');
		$this->db->join('ol_logbook_item_lhu olil', 'olil.id_item_lhu=olp.id_item_lhu','left');
		$this->db->join('ol_equipment oe', 'oe.id_equipment=olil.id_equipment','left');
		$this->db->join('ol_unit ou', 'ou.id_unit=oe.id_unit','left');
		$this->db->order_by('olil.id_equipment','asc');
		$this->db->order_by('olp.id_item_lhu','asc');
		$q = $this->db->get_where('ol_logbook_lhu_detil olp',array('olp.id_lhu'=>$id))->result_array();
		return $q;
    }
	//======================= GARIS
	function grafik_garis_opsi_logbook($id,$grup=FALSE)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
	
		if($lpd['kewenangan'] == "" OR empty($lpd['kewenangan'])){
				$this->db->select("nkk.id_kompetensi  as id_lhu,jml_logbook as hasil_lhu_detil,
							DATE_FORMAT(tgl_logbook,'%Y') as thn,DATE_FORMAT(tgl_logbook,'%m') as bln,DATE_FORMAT(tgl_logbook,'%d') as hr,
							DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_lhu,nama_kompetensi as nama_lhu
						");	
		}else{
			if($lpd['kewenangan'] == 1){
				$this->db->select("ol.id_kewenangan  as id_lhu,jml_logbook as hasil_lhu_detil,
						DATE_FORMAT(tgl_logbook,'%Y') as thn,DATE_FORMAT(tgl_logbook,'%m') as bln,DATE_FORMAT(tgl_logbook,'%d') as hr,
						DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_lhu,nama_kewenangan as nama_lhu
					");
			}else{
				$this->db->select("nkk.id_kompetensi  as id_lhu,jml_logbook as hasil_lhu_detil,
							DATE_FORMAT(tgl_logbook,'%Y') as thn,DATE_FORMAT(tgl_logbook,'%m') as bln,DATE_FORMAT(tgl_logbook,'%d') as hr,
							DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_lhu,nama_kompetensi as nama_lhu
						");
			}			
		}

		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
		$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		if($lpd['kompetensi'] == "" OR empty($lpd['kompetensi'])){
			
		}else{
			$idx = explode(',', $lpd['kompetensi']);
			$this->db->where_in("nkk.id_kompetensi",$idx);
		}
		if(!empty($lpd['isi_kompetensi'])){
			$idlb = explode(',', $lpd['isi_kompetensi']);
			$this->db->where_in("ol.id_logbook",$idlb);
		}
		$this->db->where('jml_logbook >',0);
		$this->db->order_by('tgl_logbook',"asc");
/*		if($grup){
			if($lpd['kewenangan'] == "" OR empty($lpd['kewenangan'])){
				$this->db->group_by('nkk.id_kompetensi');
			}else{
				if($lpd['kewenangan'] == 1){
					$this->db->group_by('nkk.id_kewenangan');
				}else{
					$this->db->group_by('nkk.id_kompetensi');
				}			
			}
		}
	if($lpd['share_it'] == 0){
	$q = $this->db->get_where('ol_logbook ol',array('ol.id_logbooker'=>$this->session->id_pegawai,'ol.id_instansi'=>$lpd['id_instansi']))->result_array();
	}else{*/
	$q = $this->db->get_where('ol_logbook ol',array('ol.id_logbooker'=>$lpd['id_pegawai'],'ol.id_instansi'=>$lpd['id_instansi']))->result_array();	
//	echo $this->db->last_query();die();
//	print_r($q);die();
//	}
		return $q;
    }
	function grafik_garis_opsi_logbook2($id,$grup=FALSE)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
	
		if($lpd['kewenangan'] == "" OR empty($lpd['kewenangan'])){
				$this->db->select("nkk.id_kompetensi  as id_lhu,jml_logbook as hasil_lhu_detil,
							DATE_FORMAT(tgl_logbook,'%Y') as thn,DATE_FORMAT(tgl_logbook,'%m') as bln,DATE_FORMAT(tgl_logbook,'%d') as hr,
							DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_lhu,nama_kompetensi as nama_lhu
						");	
		}else{
			if($lpd['kewenangan'] == 1){
				$this->db->select("ol.id_kewenangan  as id_lhu,jml_logbook as hasil_lhu_detil,
						DATE_FORMAT(tgl_logbook,'%Y') as thn,DATE_FORMAT(tgl_logbook,'%m') as bln,DATE_FORMAT(tgl_logbook,'%d') as hr,
						DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_lhu,nama_kewenangan as nama_lhu
					");
			}else{
				$this->db->select("nkk.id_kompetensi  as id_lhu,jml_logbook as hasil_lhu_detil,
							DATE_FORMAT(tgl_logbook,'%Y') as thn,DATE_FORMAT(tgl_logbook,'%m') as bln,DATE_FORMAT(tgl_logbook,'%d') as hr,
							DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_lhu,nama_kompetensi as nama_lhu
						");
			}			
		}

		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
		$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		if($lpd['kompetensi'] == "" OR empty($lpd['kompetensi'])){
			
		}else{
			$idx = explode(',', $lpd['kompetensi']);
			$this->db->where_in("nkk.id_kompetensi",$idx);
		}
		if(!empty($lpd['isi_kompetensi'])){
			$idlb = explode(',', $lpd['isi_kompetensi']);
			$this->db->where_in("ol.id_logbook",$idlb);
		}
		$this->db->where('jml_logbook >',0);
	//	if($grup){
			if($lpd['kewenangan'] == "" OR empty($lpd['kewenangan'])){
				$this->db->group_by('nkk.id_kompetensi');
			}else{
				if($lpd['kewenangan'] == 1){
					$this->db->group_by('nkk.id_kewenangan');
				}else{
					$this->db->group_by('nkk.id_kompetensi');
				}			
			}
	//	}
/*	if($lpd['share_it'] == 0){
	$q = $this->db->get_where('ol_logbook ol',array('ol.id_logbooker'=>$this->session->id_pegawai,'ol.id_instansi'=>$lpd['id_instansi']))->result_array();
	}else{*/
	$q = $this->db->get_where('ol_logbook ol',array('ol.id_logbooker'=>$lpd['id_pegawai'],'ol.id_instansi'=>$lpd['id_instansi']))->result_array();	
//	echo $this->db->last_query();die();
	//print_r($q);die();
//	}
		return $q;
    }
	function garis_trend($id)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
				$this->db->select("sum(jml_logbook) as hasil_lhu_detil,
							tgl_logbook as tgl_lhu
						");	
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
		$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		if($lpd['kompetensi'] == "" OR empty($lpd['kompetensi'])){
			
		}else{
			$idx = explode(',', $lpd['kompetensi']);
			$this->db->where_in("nkk.id_kompetensi",$idx);
		}
		if(!empty($lpd['isi_kompetensi'])){
			$idlb = explode(',', $lpd['isi_kompetensi']);
			$this->db->where_in("ol.id_logbook",$idlb);
		}
		$this->db->where('jml_logbook >',0);
	//	if($grup){
		$this->db->group_by('ol.tgl_logbook');
	//	}
/*	if($lpd['share_it'] == 0){
	$q = $this->db->get_where('ol_logbook ol',array('ol.id_logbooker'=>$this->session->id_pegawai,'ol.id_instansi'=>$lpd['id_instansi']))->result_array();
	}else{*/
	$q = $this->db->get_where('ol_logbook ol',array('ol.id_logbooker'=>$lpd['id_pegawai'],'ol.id_instansi'=>$lpd['id_instansi']))->result_array();	
//	echo $this->db->last_query();die();
	//print_r($q);die();
//	}
		return $q;
    }
	function grafik_garis_hasil_logbook($tgl,$id,$hasil,$share,$id_pegawai)
	{
		if(empty($hasil)){
			$this->db->select("nkk.id_kompetensi as id_lhu,sum(jml_logbook) as hasil_lhu_detil");
		}else{
			if($hasil == 1){
				$this->db->select("ol.id_kewenangan as id_lhu,sum(jml_logbook) as hasil_lhu_detil");
			}else{
				$this->db->select("nkk.id_kompetensi as id_lhu,sum(jml_logbook) as hasil_lhu_detil");
			}
		}
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
		if(empty($hasil)){
			$this->db->where('nkk.id_kompetensi', $id);
		}else{
			if($hasil == 1){
				$this->db->where('ol.id_kewenangan', $id);
			}else{
				$this->db->where('nkk.id_kompetensi', $id);
			}
		}		
		$this->db->where('tgl_logbook', date('Y-m-d', strtotime($tgl)));
	//	$this->db->where('jml_logbook >',0);
	//	if($share == 0){
	//	$q = $this->db->get_where('ol_logbook ol',array('ol.id_logbooker'=>$this->session->id_pegawai))->result_array();
	//	}else{
		$q = $this->db->get_where('ol_logbook ol',array('ol.id_logbooker'=>$id_pegawai))->result_array();			
	//	}
		return $q;
    }
	function grafik_garis_minmax_logbook($id,$mimax)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
				$this->db->select($mimax."(jml_logbook) as num");		
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
		if($lpd['kompetensi'] == "" OR empty($lpd['kompetensi'])){
			$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		}else{
			$idx = explode(',', $lpd['kompetensi']);
			$this->db->where_in("nkk.id_kompetensi",$idx);
			$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		}
		$this->db->where('jml_logbook >',0);
		$q = $this->db->get_where('ol_logbook ol',array('ol.id_logbooker'=>$this->session->id_pegawai,'ol.id_instansi'=>$lpd['id_working']));
		    $result = $q->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
    }
	function grafik_garis_opsi_pasien($id,$bhn,$jml,$nama,$grup=FALSE)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
		$this->db->select("olp.".$bhn."  as id_lhu,".$jml." as hasil_lhu_detil,
				DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_lhu,".$nama." as nama_lhu,
				DATE_FORMAT(tgl_logbook,'%Y') as thn,
				DATE_FORMAT(tgl_logbook,'%m') as bln,
				DATE_FORMAT(tgl_logbook,'%d') as hr
			");
		$this->db->join('ol_logbook ol', 'ol.id_logbook=olp.id_logbook','left');
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
/*		$this->db->join('kol_reject krj', 'krj.id_reject=olp.id_reject','left');
		$this->db->join('ol_bahan obh', 'obh.id_bahan=olp.id_bahan','left');*/
		if($lpd['kompetensi'] == "" OR empty($lpd['kompetensi'])){
			$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		}else{
			$idx = explode(',', $lpd['kompetensi']);
			$this->db->where_in("nkk.id_kompetensi",$idx);
			$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		}
		if(!empty($lpd['isi_kompetensi'])){
			$idlb = explode(',', $lpd['isi_kompetensi']);
			$this->db->where_in("ol.id_logbook",$idlb);
		}
		$this->db->where($jml.' >',0);
		if($grup){
			$this->db->group_by('olp.'.$grup);
		}
		$q = $this->db->get_where('ol_logbook_pasien olp',array('ol.id_logbooker'=>$lpd['id_pegawai'],'ol.id_instansi'=>$lpd['id_working']))->result_array();			
		return $q;
    }
	function grafik_garis_opsi_pakai($id,$bhn,$jml,$nama,$grup=FALSE)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
		$this->db->select($bhn."  as id_lhu,".$jml." as hasil_lhu_detil,
				DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_lhu,".$nama." as nama_lhu,
				DATE_FORMAT(tgl_logbook,'%Y') as thn,
				DATE_FORMAT(tgl_logbook,'%m') as bln,
				DATE_FORMAT(tgl_logbook,'%d') as hr
			");
		$this->db->join('ol_logbook_pasien olp', 'olp.id_logbook_pasien=olpk.id_logbook_pasien','left');
		$this->db->join('ol_logbook ol', 'ol.id_logbook=olp.id_logbook','left');
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
		$this->db->join('ol_bahan obh', 'obh.id_bahan=olpk.id_bahan','left');
		if($lpd['kompetensi'] == "" OR empty($lpd['kompetensi'])){
			$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		}else{
			$idx = explode(',', $lpd['kompetensi']);
			$this->db->where_in("nkk.id_kompetensi",$idx);
			$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		}
		if(!empty($lpd['isi_kompetensi'])){
			$idlb = explode(',', $lpd['isi_kompetensi']);
			$this->db->where_in("ol.id_logbook",$idlb);
		}
		$this->db->where($jml.' >',0);
		if($grup){
			$this->db->group_by($grup);
		}
		$q = $this->db->get_where('ol_logbook_pakai olpk',array('ol.id_logbooker'=>$lpd['id_pegawai'],'ol.id_instansi'=>$lpd['id_working']))->result_array();			
		return $q;
    }
	function grafik_garis_opsi_reject($id,$bhn,$jml,$nama,$grup=FALSE)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
		$this->db->select($bhn."  as id_lhu,".$jml." as hasil_lhu_detil,
				DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_lhu,".$nama." as nama_lhu,
				DATE_FORMAT(tgl_logbook,'%Y') as thn,
				DATE_FORMAT(tgl_logbook,'%m') as bln,
				DATE_FORMAT(tgl_logbook,'%d') as hr
			");
		$this->db->join('ol_logbook_pasien olp', 'olp.id_logbook_pasien=olpk.id_logbook_pasien','left');
		$this->db->join('ol_logbook ol', 'ol.id_logbook=olp.id_logbook','left');
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
		$this->db->join('ol_bahan obh', 'obh.id_bahan=olpk.id_bahan','left');
		$this->db->join('kol_reject kre', 'kre.id_reject=olpk.id_reject','left');
		if($lpd['kompetensi'] == "" OR empty($lpd['kompetensi'])){
			$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		}else{
			$idx = explode(',', $lpd['kompetensi']);
			$this->db->where_in("nkk.id_kompetensi",$idx);
			$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		}
		if(!empty($lpd['isi_kompetensi'])){
			$idlb = explode(',', $lpd['isi_kompetensi']);
			$this->db->where_in("ol.id_logbook",$idlb);
		}
		$this->db->where($jml.' >',0);
		if($grup){
			$this->db->group_by($grup);
		}
		$q = $this->db->get_where('ol_logbook_reject olpk',array('ol.id_logbooker'=>$lpd['id_pegawai'],'ol.id_instansi'=>$lpd['id_working']))->result_array();			
		return $q;
    }
	function grafik_garis_minmax_pasien($id,$jml,$mimax)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
		$this->db->select($mimax."(jml_logbook) as num");
		$this->db->join('ol_logbook ol', 'ol.id_logbook=olp.id_logbook','left');
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
		$this->db->join('kol_reject krj', 'krj.id_reject=olp.id_reject','left');
		$this->db->join('ol_bahan obh', 'obh.id_bahan=olp.id_bahan','left');
		if($lpd['kompetensi'] == "" OR empty($lpd['kompetensi'])){
			$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		}else{
			$idx = explode(',', $lpd['kompetensi']);
			$this->db->where_in("nkk.id_kompetensi",$idx);
			$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		}
		$this->db->where($jml.' >',0);
		$q = $this->db->get_where('ol_logbook_pasien olp',array('ol.id_logbooker'=>$this->session->id_pegawai,'ol.id_instansi'=>$lpd['id_working']));
		    $result = $q->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
    }
	function grafik_garis_opsi_lhu($id,$select,$grup=FALSE)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
		$this->db->select($select);
		$this->db->join('ol_logbook_lhu oll', 'oll.id_lhu=olp.id_lhu','left');
		$this->db->join('ol_logbook_item_lhu olil', 'olil.id_item_lhu=olp.id_item_lhu','left');
		$this->db->join('ol_equipment oe', 'oe.id_equipment=olil.id_equipment','left');
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		if(!empty($lpd['i_mutu'])){
			$idlh = explode(',', $lpd['i_mutu']);
			$this->db->where_in("olp.id_lhu_detil",$idlh); // nama_lhu - tgl_lhu
		}else{
			$this->db->where("oll.barcode_pegawai",$lpd['barcode_pegawai']);
		}
		if(!empty($lpd['item_lhu'])){
			$idilhu = explode(',', $lpd['item_lhu']);
			$this->db->where_in("olil.id_item_lhu",$idilhu); // nama_item_lhu
		}
/*		if(!empty($lpd['id_lhu'])){
			$idlb = explode(',', $lpd['id_lhu']);
			$this->db->where_in("olil.id_equipment",$idlb); //nama_equipment
		}*/
		if($grup){
			$this->db->group_by($grup);
		}
		$q = $this->db->get_where('ol_logbook_lhu_detil olp')->result_array();
	//	echo $this->db->last_query();die();
		return $q;
    }
	function grafik_garis_hasil_lhu($tgl,$id,$select,$idk)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($idk);
		$this->db->select($select);
		$this->db->join('ol_logbook_lhu oll', 'oll.id_lhu=olp.id_lhu','left');
		$this->db->join('ol_logbook_item_lhu olil', 'olil.id_item_lhu=olp.id_item_lhu','left');
		$this->db->join('ol_equipment oe', 'oe.id_equipment=olil.id_equipment','left');
		$this->db->where('olp.id_item_lhu', $id);
		if(!empty($lpd['i_mutu'])){
			$idlh = explode(',', $lpd['i_mutu']);
			$this->db->where_in("olp.id_lhu_detil",$idlh); // nama_lhu - tgl_lhu
		}
		if(!empty($lpd['item_lhu'])){
			$idilhu = explode(',', $lpd['item_lhu']);
			$this->db->where_in("olp.id_item_lhu",$idilhu); // nama_item_lhu
		}
		$this->db->where('tgl_lhu', date('Y-m-d', strtotime($tgl)));
//		$q = $this->db->get_where('ol_logbook_lhu_detil olp')->result_array();
		$q = $this->db->get_where('ol_logbook_lhu_detil olp',array('oll.barcode_pegawai'=>$lpd['barcode_pegawai']))->result_array();
//		echo $this->db->last_query();die();
		return $q;
    }
	function grafik_garis_hasil_pasien($tgl,$id,$bhn,$jml,$share,$id_pegawai)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
		$this->db->select("olp.".$bhn."  as id_lhu,SUM(".$jml.") as hasil_lhu_detil");
		$this->db->join('ol_logbook ol', 'ol.id_logbook=olp.id_logbook','left');
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
		$this->db->join('kol_reject krj', 'krj.id_reject=olp.id_reject','left');
		$this->db->join('ol_bahan obh', 'obh.id_bahan=olp.id_bahan','left');
		$this->db->where('olp.'.$bhn, $id);
		$this->db->where('tgl_logbook', date('Y-m-d', strtotime($tgl)));
		$this->db->where($jml.' >',0);
		if($share == 0){
		$q = $this->db->get_where('ol_logbook_pasien olp',array('ol.id_logbooker'=>$this->session->id_pegawai))->result_array();
		}else{
		$q = $this->db->get_where('ol_logbook_pasien olp',array('ol.id_logbooker'=>$id_pegawai))->result_array();			
		}
		return $q;
    }
	function ambil_all_limbah_grafik($id,$idl){
		$lpd = $this->ambil_sn_laporan_detil($id);
		$this->db->select("count(*) as cemua");
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where('sld.id_limbah', $idl);
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);		
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}
		if($lpd['id_sumber_emisi'] == NULL OR $lpd['id_sumber_emisi'] == 0 OR empty($lpd['id_sumber_emisi'])){ 
			
		}else{
			$ids = explode(',', $lpd['id_sumber_emisi']);
			$this->db->where_in('sld.id_sumber_emisi', $ids);
		}
		$this->db->group_by('sld.id_limbah');
		$q = $this->db->get_where('sn_lhu_detil sld')->result_array();
		//echo $this->db->last_query();die();
		return $q;
	}
	function ambil_sesuai_limbah_grafik($id,$idl){
		$lpd = $this->ambil_sn_laporan_detil($id);
		$this->db->select("
			IF(range_mutu = 0 ,SUM(CASE WHEN hasil_lhu_detil < standar_mutu THEN 1 ELSE 0 END),SUM(CASE WHEN hasil_lhu_detil BETWEEN standar_mutu and range_mutu THEN 1 ELSE 0 END)) as cesuai
			");
		$this->db->join('sn_lhu sl', 'sl.id_lhu=sld.id_lhu','left');
		$this->db->join('sn_limbah slm', 'slm.id_limbah=sld.id_limbah','left');
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where('sld.id_limbah', $idl);
		$this->db->where('sl.id_standar_mutu', $lpd['id_standar_mutu']);		
		if($lpd['id_lhu'] == NULL OR $lpd['id_lhu'] == 0 OR empty($lpd['id_lhu'])){ 
			
		}else{
			$idx = explode(',', $lpd['id_lhu']);
			$this->db->where_in('sld.id_lhu', $idx);
		}
/*		if($lpd['id_limbah'] == NULL OR $lpd['id_limbah'] == 0 OR empty($lpd['id_limbah'])){ 
			
		}else{
			$idl = explode(',', $lpd['id_limbah']);
			$this->db->where_in('sld.id_limbah', $idl);
		}*/
		if($lpd['id_sumber_emisi'] == NULL OR $lpd['id_sumber_emisi'] == 0 OR empty($lpd['id_sumber_emisi'])){ 
			
		}else{
			$ids = explode(',', $lpd['id_sumber_emisi']);
			$this->db->where_in('sld.id_sumber_emisi', $ids);
		}
	//	$this->db->where("IF(range_mutu = 0 ,hasil_lhu_detil < standar_mutu, hasil_lhu_detil BETWEEN standar_mutu and range_mutu)", NULL, FALSE);
		$this->db->group_by('sld.id_limbah');
		$q = $this->db->get_where('sn_lhu_detil sld')->result_array();
		//echo $this->db->last_query();die();
		return $q;
	}
	function abs_even_all()
	{
	//	$idx = explode(',', $this->session->mas_ins);
		$fields = "*,concat(DATE_FORMAT(tgl_even,'%d-%m-%Y'),'  ',DATE_FORMAT(time_even,'%H:%i')) as tgl_even,
		tgl_even as tgl_sort,if(include_radius = '0','Tidak','Ya') as include_radius,
		if(status_even = '0','Proses',if(status_even = '1','Pendaftaran',if(status_even = '2','Mulai Acara','Selesai'))) as status_even,
		if(seen_even = '0','Unshare',if(seen_even = '1','Unit',if(seen_even = '2','Instansi',if(seen_even = '3','Komuintas','Profesi')))) as seen_even
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
				$this->db->where('find_in_set("'.$this->session->barcode_pegawai.'", peserta_even) <> 0');
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('abs_even ae');
	    $this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=ae.barcode_pegawai','left');
	    $this->db->join('ol_pegawai_unit opu', 'opu.id_pegawai=peg.id_pegawai','left');
	    $this->db->join('ol_unit ou', 'ou.id_unit=opu.id_unit','left');
	    $this->db->where('find_in_set("'.$this->session->barcode_pegawai.'", peserta_even) <> 0');
//$this->db->where('if(seen_even = 0,ae.barcode_pegawai="'.$this->session->barcode_pegawai.'",if(seen_even = 1,opu.id_unit="'.$this->session->unit.'",ou.id_instansi="'.$this->session->refer.'"))', NULL, FALSE);
		
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
				$this->db->where('find_in_set("'.$this->session->barcode_pegawai.'", peserta_even) <> 0');
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('abs_even ae');
	    $this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=ae.barcode_pegawai','left');
	    $this->db->where('find_in_set("'.$this->session->barcode_pegawai.'", peserta_even) <> 0');
		
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('barcode_pegawai'=>$this->session->barcode_pegawai);
		$jml = $this->m_umum->jumlah_record_filter('abs_even',$kondisi);	*/ 
		$jml = $this->m_umum->jumlah_record_tabel('abs_even');		//[coding here] ganti tabel utamanya
				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;	
	}
	function abs_even_detil_all()
	{
	//	$idx = explode(',', $this->session->mas_ins);
		$fields = "*,concat(DATE_FORMAT(tgl_even_detil,'%d-%m-%Y'),'  ',DATE_FORMAT(time_even_detil,'%H:%i')) as tgl_even_detil,
		tgl_even_detil as tgl_sort,if(include_radius = '0','Tidak','Ya') as include_radius,
		concat(DATE_FORMAT(tgl_even,'%d-%m-%Y'),'  ',DATE_FORMAT(time_even,'%H:%i')) as tgl_even,
		if(status_even = '0','Proses',if(status_even = '1','Pendaftaran',if(status_even = '2','Mulai Acara','Selesai'))) as status_even,
		if(seen_even = '0','Unshare',if(seen_even = '1','Unit',if(seen_even = '2','Instansi',if(seen_even = '3','Komuintas','Profesi')))) as seen_even
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
	    $this->db->where('find_in_set("'.$this->session->barcode_pegawai.'", peserta_even) <> 0');
	    $this->db->where("aed.id_even",$this->session->even_acara);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('abs_even_detil aed');
	    $this->db->join('abs_even ae', 'ae.id_even=aed.id_even','left');
	//    $this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=ae.barcode_pegawai','left');
	    $this->db->where('find_in_set("'.$this->session->barcode_pegawai.'", peserta_even) <> 0');
	    $this->db->where("aed.id_even",$this->session->even_acara);
		
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
	    $this->db->where('find_in_set("'.$this->session->barcode_pegawai.'", peserta_even) <> 0');
	    $this->db->where("aed.id_even",$this->session->even_acara);
			}
		  }
		}

	    $this->db->from('abs_even_detil aed');
	    $this->db->join('abs_even ae', 'ae.id_even=aed.id_even','left');
	//    $this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=ae.barcode_pegawai','left');
	    $this->db->where('find_in_set("'.$this->session->barcode_pegawai.'", peserta_even) <> 0');
	    $this->db->where("aed.id_even",$this->session->even_acara);
		
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
 		$kondisi=array('id_even'=>$this->session->even_acara);
		$jml = $this->m_umum->jumlah_record_filter('abs_even_detil',$kondisi);	 
	//	$jml = $this->m_umum->jumlah_record_tabel('ol_unit');		//[coding here] ganti tabel utamanya
				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;	
	}
	function simpan_absensi_even(){
		$kode = $this->m_rancak->kode_generator_urut(15,'PE');
		$id_even_detil = $this->input->post('id_even_detil');
		$data_pendaftaran = array(
			'id_even_attendance' => $kode,
			'id_even_detil' => $id_even_detil,
			'tgl_even_attendance' => date('Y-m-d'),
			'clock_in_even_attendance' => date('H:i:s'),
			'id_even_peserta' => $this->session->barcode_pegawai,
			'location_even_attendance' => $this->input->post('location')
		);
		return $this->db->insert('abs_even_attendance', $data_pendaftaran);
	}
// ================================================= IM / QC
  function ol_per_imqc_all($jns)
  {
    $idx = explode(',', $this->session->mas_ins);
  //  $ids = explode(',', $unit);
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
        switch($k['data']){   //beberapa field ambigius, so sesuaikan [coding here]
        //   case 'no_hp' : $nmf="peg.no_hp";break;
          // case 'id_level'   : $nmf="u.id_level";break;
        default: $nmf=$k['data'];
        }
        $this->db->or_like($nmf, $cari['value'],'both',false);  
      $this->db->where('ol_per_imqc.id_unit',$this->session->unit); 
      $this->db->where('ol_per_imqc.pembuat_per_imqc',$this->session->barcode_pegawai); 
      $this->db->where('ol_per_imqc.jenis_per_imqc',$jns);
      }
      }
    }
    $this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

      $this->db->from('ol_per_imqc');
      $this->db->join('ol_unit', 'ol_unit.id_unit=ol_per_imqc.id_unit','left');
      $this->db->where('ol_per_imqc.id_unit',$this->session->unit); 
      $this->db->where('ol_per_imqc.pembuat_per_imqc',$this->session->barcode_pegawai); 
      $this->db->where('ol_per_imqc.jenis_per_imqc',$jns); 

    $q = $this->db->limit($length,$start)->get_where(); //05 Execute

    $list=$q->result_array(); //06 Hasil

  //--------- Query jumlah filter untuk paging -----
    $this->db->select("COUNT(*) as num"); //01 Select

    if(!empty($cari['value'])) {    //02 Where
      foreach($dt_kolom as $k){
      if($k['searchable']=='true'){ //cek kalo searchable
        switch($k['data']){   //beberapa field ambigius, so sesuaikan  [coding here]
        //  case 'no_hp' : $nmf="peg.no_hp";break;
          default: $nmf=$k['data'];
        }
        $this->db->or_like($nmf, $cari['value'],'both',false);
      $this->db->where('ol_per_imqc.id_unit',$this->session->unit); 
      $this->db->where('ol_per_imqc.pembuat_per_imqc',$this->session->barcode_pegawai); 
      $this->db->where('ol_per_imqc.jenis_per_imqc',$jns);  
      }
      }
    }

      $this->db->from('ol_per_imqc');
      $this->db->join('ol_unit', 'ol_unit.id_unit=ol_per_imqc.id_unit','left');
      $this->db->where('ol_per_imqc.id_unit',$this->session->unit); 
      $this->db->where('ol_per_imqc.pembuat_per_imqc',$this->session->barcode_pegawai); 
      $this->db->where('ol_per_imqc.jenis_per_imqc',$jns);        

    $q = $this->db->get_where(); //04 Execute
    $jml_filter = $q->row()->num; //05 Hasil

  //--------- Query jumlah All data paling banyak -----
    $kondisi=array('id_unit'=>$this->session->unit,'pembuat_per_imqc'=>$this->session->barcode_pegawai,'jenis_per_imqc'=>$jns);
    $jml = $this->m_umum->jumlah_record_filter('ol_per_imqc',$kondisi);
  //  $jml = $this->m_umum->jumlah_record_tabel('sn_standar_mutu');

    $output = array(
      "draw" => $draw,
        "recordsTotal" => $jml,
        "recordsFiltered" => $jml_filter,
        "data" => $list
    );
    // print_r($output);die();
    return $output;
  }
  function simpan_per_imqc($js){
    $kode = $this->m_rancak->kode_generator_urut(15,'EQ');
    $data_pendaftaran = array(
      'id_per_imqc' => $kode,
      'id_unit' => $this->session->unit,
      'jenis_per_imqc' => $js,
      'pembuat_per_imqc' => $this->session->barcode_pegawai,
      'nama_per_imqc' => $this->input->post('nama_per_imqc'),
      'status_per_imqc' => $this->input->post('status_per_imqc')
    );
    return $this->db->insert('ol_per_imqc', $data_pendaftaran);
  }
  function edit_per_imqc(){
    $id_per_imqc = $this->input->post('id_per_imqc'); 
    $data_pendaftaran = array(
      'nama_per_imqc' => $this->input->post('nama_per_imqc'),
      'status_per_imqc' => $this->input->post('status_per_imqc')
    );
    $this->db->where('id_per_imqc',$id_per_imqc);
    $this->db->update('ol_per_imqc', $data_pendaftaran);
    //echo $this->db->last_query();
    $this->db->trans_complete();  // untuk cek sukses update tidak
    if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
    // if (!$this->db->affected_rows()) 
      return(FALSE);
    else 
      return(TRUE);         
  }
function ol_per_imqc_detil_all($jns)
  {
    $idx = explode(',', $this->session->mas_ins);
  //  $ids = explode(',', $unit);
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
        switch($k['data']){   //beberapa field ambigius, so sesuaikan [coding here]
        //   case 'no_hp' : $nmf="peg.no_hp";break;
          // case 'id_level'   : $nmf="u.id_level";break;
        default: $nmf=$k['data'];
        }
        $this->db->or_like($nmf, $cari['value'],'both',false);  
      $this->db->where('se.id_unit',$this->session->unit); 
      $this->db->where('oed.pembuat_per_imqc_detil',$this->session->barcode_pegawai); 
      $this->db->where('se.jenis_per_imqc',$jns);  
      }
      }
    }
    $this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

      $this->db->from('ol_per_imqc_detil oed');
      $this->db->join('ol_per_imqc se', 'se.id_per_imqc=oed.id_per_imqc','left');
      $this->db->join('ol_unit ou', 'ou.id_unit=se.id_unit','left');
      $this->db->where('se.id_unit',$this->session->unit); 
      $this->db->where('oed.pembuat_per_imqc_detil',$this->session->barcode_pegawai); 
      $this->db->where('se.jenis_per_imqc',$jns); 

    $q = $this->db->limit($length,$start)->get_where(); //05 Execute

    $list=$q->result_array(); //06 Hasil

  //--------- Query jumlah filter untuk paging -----
    $this->db->select("COUNT(*) as num"); //01 Select

    if(!empty($cari['value'])) {    //02 Where
      foreach($dt_kolom as $k){
      if($k['searchable']=='true'){ //cek kalo searchable
        switch($k['data']){   //beberapa field ambigius, so sesuaikan  [coding here]
        //  case 'no_hp' : $nmf="peg.no_hp";break;
          default: $nmf=$k['data'];
        }
        $this->db->or_like($nmf, $cari['value'],'both',false);
      $this->db->where('se.id_unit',$this->session->unit); 
      $this->db->where('oed.pembuat_per_imqc_detil',$this->session->barcode_pegawai); 
      $this->db->where('se.jenis_per_imqc',$jns);   
      }
      }
    }

      $this->db->from('ol_per_imqc_detil oed');
      $this->db->join('ol_per_imqc se', 'se.id_per_imqc=oed.id_per_imqc','left');
      $this->db->join('ol_unit ou', 'ou.id_unit=se.id_unit','left');
      $this->db->where('se.id_unit',$this->session->unit); 
      $this->db->where('oed.pembuat_per_imqc_detil',$this->session->barcode_pegawai); 
      $this->db->where('se.jenis_per_imqc',$jns); 

    $q = $this->db->get_where(); //04 Execute
    $jml_filter = $q->row()->num; //05 Hasil

  //--------- Query jumlah All data paling banyak -----
/*    $kondisi=array('id_unit='=>$this->session->unit);
    $jml = $this->m_umum->jumlah_record_filter('ol_eq_detil',$kondisi); */
    $kondisi=array('id_unit='=>$this->session->unit,'pembuat_per_imqc_detil='=>$this->session->barcode_pegawai,'jenis_per_imqc'=>$jns);
    $jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_per_imqc_detil',$kondisi,'ol_per_imqc','id_per_imqc'); 
  //  $jml = $this->m_umum->jumlah_record_tabel('ol_eq_detil');

    $output = array(
      "draw" => $draw,
        "recordsTotal" => $jml,
        "recordsFiltered" => $jml_filter,
        "data" => $list
    );
    // print_r($output);die();
    return $output;
  }
  function simpan_per_imqc_detil(){
    $kode = $this->m_rancak->kode_generator_urut(15,'QD');
    $data_pendaftaran = array(
      'id_per_imqc_detil' => $kode,
      'id_per_imqc' => $this->input->post('id_per_imqc'),
      'pembuat_per_imqc_detil' => $this->session->barcode_pegawai,
      'nama_per_imqc_detil' => $this->input->post('nama_per_imqc_detil'),
      'status_per_imqc_detil' => $this->input->post('status_per_imqc_detil')
    );
    return $this->db->insert('ol_per_imqc_detil', $data_pendaftaran);
  }
  function edit_per_imqc_detil(){
    $id_per_imqc_detil = $this->input->post('id_per_imqc_detil'); 
    $data_pendaftaran = array(
      'id_per_imqc' => $this->input->post('id_per_imqc'),
      'nama_per_imqc_detil' => $this->input->post('nama_per_imqc_detil'),
      'status_per_imqc_detil' => $this->input->post('status_per_imqc_detil')
    );
    $this->db->where('id_per_imqc_detil',$id_per_imqc_detil);
    $this->db->update('ol_per_imqc_detil', $data_pendaftaran);
    //echo $this->db->last_query();
    $this->db->trans_complete();  // untuk cek sukses update tidak
    if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
    // if (!$this->db->affected_rows()) 
      return(FALSE);
    else 
      return(TRUE);         
  }
  function ol_per_imqc_hasil_all($first_date,$last_date,$opsi,$tgl,$jns)
  {
    $fields = "*,
    DATE_FORMAT(tgl_per_imqc_hasil,'%d-%m-%Y') as tgl_per_imqc_hasil,if(yn_per_imqc_hasil=1,if(hasil_per_imqc_hasil=1,'YA','TIDAK'),hasil_per_imqc_hasil) as hasil_per_imqc_hasil,
    concat(nama_per_imqc_detil,' - <b> Poin : [',nama_per_imqc,']</b>') as nama_per_imqc,tgl_per_imqc_hasil as tgl_sort
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
        switch($k['data']){   //beberapa field ambigius, so sesuaikan [coding here]
        //   case 'no_hp' : $nmf="peg.no_hp";break;
          // case 'id_level'   : $nmf="u.id_level";break;
        default: $nmf=$k['data'];
        }
        $this->db->or_like($nmf, $cari['value'],'both',false);  
      if($tgl == 0){
        $this->db->where('tgl_per_imqc_hasil BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
      }
      $this->db->where('oe.jenis_per_imqc',$jns);
      $this->db->where('oei.barcode_pegawai',$this->session->barcode_pegawai);
      $this->db->where('oe.id_unit',$this->session->unit);
      if($opsi){
        $this->db->where('oed.id_per_imqc',$opsi);
      }
      }
      }
    }
    $this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

      $this->db->from('ol_per_imqc_hasil oei');  
      $this->db->join('ol_per_imqc_detil oed', 'oed.id_per_imqc_detil=oei.id_per_imqc_detil','left');
      $this->db->join('ol_per_imqc oe', 'oe.id_per_imqc=oed.id_per_imqc','left');
      $this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=oei.barcode_pegawai','left');
      $this->db->join('ol_user us', 'us.id_pegawai=peg.id_pegawai','left'); 
      if($tgl == 0){
        $this->db->where('tgl_per_imqc_hasil BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
      }
      $this->db->where('oe.jenis_per_imqc',$jns);
      $this->db->where('oei.barcode_pegawai',$this->session->barcode_pegawai);
      $this->db->where('oe.id_unit',$this->session->unit);
      if($opsi){
        $this->db->where('oed.id_per_imqc',$opsi);
      }

    $q = $this->db->limit($length,$start)->get_where(); //05 Execute

    $list=$q->result_array(); //06 Hasil
// echo $this->db->last_query();
  //--------- Query jumlah filter untuk paging -----
    $this->db->select("COUNT(*) as num"); //01 Select

    if(!empty($cari['value'])) {    //02 Where
      foreach($dt_kolom as $k){
      if($k['searchable']=='true'){ //cek kalo searchable
        switch($k['data']){   //beberapa field ambigius, so sesuaikan  [coding here]
        //  case 'no_hp' : $nmf="peg.no_hp";break;
          default: $nmf=$k['data'];
        }
        $this->db->or_like($nmf, $cari['value'],'both',false);
      if($tgl == 0){
        $this->db->where('tgl_per_imqc_hasil BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
      }
      $this->db->where('oe.jenis_per_imqc',$jns);
      $this->db->where('oei.barcode_pegawai',$this->session->barcode_pegawai);
      $this->db->where('oe.id_unit',$this->session->unit);
      if($opsi){
        $this->db->where('oed.id_per_imqc',$opsi);
      }
      }
      }
    }

      $this->db->from('ol_per_imqc_hasil oei');  
      $this->db->join('ol_per_imqc_detil oed', 'oed.id_per_imqc_detil=oei.id_per_imqc_detil','left');
      $this->db->join('ol_per_imqc oe', 'oe.id_per_imqc=oed.id_per_imqc','left');
      $this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=oei.barcode_pegawai','left');
      $this->db->join('ol_user us', 'us.id_pegawai=peg.id_pegawai','left'); 
      if($tgl == 0){
        $this->db->where('tgl_per_imqc_hasil BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
      }
      $this->db->where('oe.jenis_per_imqc',$jns);
      $this->db->where('oei.barcode_pegawai',$this->session->barcode_pegawai);
      $this->db->where('oe.id_unit',$this->session->unit);
      if($opsi){
        $this->db->where('oed.id_per_imqc',$opsi);
      }


    $q = $this->db->get_where(); //04 Execute
    $jml_filter = $q->row()->num; //05 Hasil

  //--------- Query jumlah All data paling banyak -----
/*    $kondisi=array('id_unit='=>$this->session->unit);
    $jml = $this->m_umum->jumlah_record_filter('ol_eq_imut',$kondisi); */
/*    $kondisi=array('id_unit='=>$this->session->unit,'jenis_equipment'=>1);
    $jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_eq_imut',$kondisi,'ol_equipment','id_equipment'); */
    $jml = $this->m_umum->jumlah_record_tabel('ol_per_imqc_hasil');

    $output = array(
      "draw" => $draw,
        "recordsTotal" => $jml,
        "recordsFiltered" => $jml_filter,
        "data" => $list
    );
    // print_r($output);die();
    return $output;
  }
  function simpan_per_imqc_hasil(){
    $kode = $this->m_rancak->kode_generator_urut(15,'XN');
    $tgl_per_imqc_hasil = $this->input->post('tgl_per_imqc_hasil');
    $tgl_per_imqc_hasil = date('Y-m-d', strtotime($tgl_per_imqc_hasil));
    $hasil_per_imqc_hasil = $this->input->post('hasil_per_imqc_hasil');
    $hasil_per_imqc_hasil = str_replace(',', '.', $hasil_per_imqc_hasil);
    $data_pendaftaran = array(
      'barcode_pegawai' => $this->session->barcode_pegawai,
      'id_per_imqc_hasil' => $kode,
      'tgl_per_imqc_hasil' => $tgl_per_imqc_hasil,
      'id_per_imqc_detil'  => $this->input->post('id_per_imqc_detil'),
      'yn_per_imqc_hasil'  => $this->input->post('yn_per_imqc_hasil'),
      'ket_per_imqc_hasil'  => $this->input->post('ket_per_imqc_hasil'),
      'status_per_imqc_hasil'  => $this->input->post('status_per_imqc_hasil'),
      'hasil_per_imqc_hasil'  => $hasil_per_imqc_hasil
    );
    return $this->db->insert('ol_per_imqc_hasil', $data_pendaftaran);
    // $this->db->insert_id();
  }
  function rubah_per_imqc_hasil(){
    $id_per_imqc_hasil = $this->input->post('id_per_imqc_hasil');
    $tgl_per_imqc_hasil = $this->input->post('tgl_per_imqc_hasil');
    $tgl_per_imqc_hasil = date('Y-m-d', strtotime($tgl_per_imqc_hasil));
    $hasil_per_imqc_hasil = $this->input->post('hasil_per_imqc_hasil');
    $hasil_per_imqc_hasil = str_replace(',', '.', $hasil_per_imqc_hasil);
    $data_pendaftaran = array(
      'tgl_per_imqc_hasil' => $tgl_per_imqc_hasil,
      'id_per_imqc_detil'  => $this->input->post('id_per_imqc_detil'),
      'yn_per_imqc_hasil'  => $this->input->post('yn_per_imqc_hasil'),
      'ket_per_imqc_hasil'  => $this->input->post('ket_per_imqc_hasil'),
      'status_per_imqc_hasil'  => $this->input->post('status_per_imqc_hasil'),
      'hasil_per_imqc_hasil'  => $hasil_per_imqc_hasil
    );
    $this->db->where('id_per_imqc_hasil',$id_per_imqc_hasil);
    $this->db->update('ol_per_imqc_hasil', $data_pendaftaran);
    //echo $this->db->last_query();
    $this->db->trans_complete();  // untuk cek sukses update tidak
    if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
    // if (!$this->db->affected_rows())
      return(FALSE);
    else
      return(TRUE);
  }
// ================================================= IM / QC
  function laporan_all($first_date,$last_date,$opsi,$tgl,$jns)
  {
    $fields = "*,
    DATE_FORMAT(tgl_laporan,'%d-%m-%Y') as tgl_laporan,tgl_laporan as tgl_sort,DATE_FORMAT(tgl_awal,'%d-%m-%Y') as tgl_awal,DATE_FORMAT(tgl_akhir,'%d-%m-%Y') as tgl_akhir
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
        switch($k['data']){   //beberapa field ambigius, so sesuaikan [coding here]
        //   case 'no_hp' : $nmf="peg.no_hp";break;
          // case 'id_level'   : $nmf="u.id_level";break;
        default: $nmf=$k['data'];
        }
        $this->db->or_like($nmf, $cari['value'],'both',false);  
      $this->db->where('lap.laporan_unit',$this->session->unit);
      $this->db->where('lap.pembuat_laporan',$this->session->barcode_pegawai);
      if($tgl == 0){
        $this->db->where('tgl_laporan BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
      }
      if($opsi){
        $this->db->where('lap.id_equipment',$opsi);
      }
      }
      }
    }
    $this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

      $this->db->from('ol_per_laporan lap');  
      $this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=lap.pembuat_laporan','left');
      $this->db->join('ol_unit ou', 'ou.id_unit=lap.laporan_unit','left'); 
      $this->db->where('lap.laporan_unit',$this->session->unit);
      $this->db->where('lap.pembuat_laporan',$this->session->barcode_pegawai);
      if($tgl == 0){
        $this->db->where('tgl_laporan BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
      }
      if($opsi){
        $this->db->where('lap.id_equipment',$opsi);
      }

    $q = $this->db->limit($length,$start)->get_where(); //05 Execute

    $list=$q->result_array(); //06 Hasil
// echo $this->db->last_query();
  //--------- Query jumlah filter untuk paging -----
    $this->db->select("COUNT(*) as num"); //01 Select

    if(!empty($cari['value'])) {    //02 Where
      foreach($dt_kolom as $k){
      if($k['searchable']=='true'){ //cek kalo searchable
        switch($k['data']){   //beberapa field ambigius, so sesuaikan  [coding here]
        //  case 'no_hp' : $nmf="peg.no_hp";break;
          default: $nmf=$k['data'];
        }
        $this->db->or_like($nmf, $cari['value'],'both',false);
      $this->db->where('lap.laporan_unit',$this->session->unit);
      $this->db->where('lap.pembuat_laporan',$this->session->barcode_pegawai);
      if($tgl == 0){
        $this->db->where('tgl_laporan BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
      }
      if($opsi){
        $this->db->where('lap.id_equipment',$opsi);
      }
      }
      }
    }

      $this->db->from('ol_per_laporan lap');  
      $this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=lap.pembuat_laporan','left');
      $this->db->join('ol_unit ou', 'ou.id_unit=lap.laporan_unit','left'); 
      $this->db->where('lap.laporan_unit',$this->session->unit);
      $this->db->where('lap.pembuat_laporan',$this->session->barcode_pegawai);
      if($tgl == 0){
        $this->db->where('tgl_laporan BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
      }
      if($opsi){
        $this->db->where('lap.id_equipment',$opsi);
      }

    $q = $this->db->get_where(); //04 Execute
    $jml_filter = $q->row()->num; //05 Hasil

  //--------- Query jumlah All data paling banyak -----
/*    $kondisi=array('id_unit='=>$this->session->unit);
    $jml = $this->m_umum->jumlah_record_filter('ol_eq_imut',$kondisi); */
/*    $kondisi=array('id_unit='=>$this->session->unit,'jenis_equipment'=>1);
    $jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_eq_imut',$kondisi,'ol_equipment','id_equipment'); */
    $jml = $this->m_umum->jumlah_record_tabel('ol_per_laporan');

    $output = array(
      "draw" => $draw,
        "recordsTotal" => $jml,
        "recordsFiltered" => $jml_filter,
        "data" => $list
    );
    // print_r($output);die();
    return $output;
  }
  function simpan_report(){
    $kode = $this->m_rancak->kode_generator_urut(15,'RP');
    $tgl_laporan = $this->input->post('tgl_laporan');
    $tgl_laporan = date('Y-m-d', strtotime($tgl_laporan));
    $tgl_awal = $this->input->post('tgl_awal');
    $tgl_awal = date('Y-m-d', strtotime($tgl_awal));
    $tgl_akhir = $this->input->post('tgl_akhir');
    $tgl_akhir = date('Y-m-d', strtotime($tgl_akhir));
    $data_pendaftaran = array(
      'pembuat_laporan' => $this->session->barcode_pegawai,
      'id_laporan' => $kode,
      'tgl_laporan' => $tgl_laporan,
      'tgl_awal' => $tgl_awal,
      'tgl_akhir' => $tgl_akhir,
      'header_laporan'  => $this->input->post('header_laporan'),
      'laporan_unit'  => $this->session->unit,
      'sub_header_laporan'  => $this->input->post('sub_header_laporan'),
      'sub_sub_header_laporan'  => $this->input->post('sub_sub_header_laporan'),
      'judul_laporan'  => $this->input->post('judul_laporan'),
      'tujuan_laporan'  => $this->input->post('tujuan_laporan'),
      'sumber_laporan'  => $this->input->post('sumber_laporan'),
      'periode_laporan'  => $this->input->post('periode_laporan')
    );
    return $this->db->insert('ol_per_laporan', $data_pendaftaran);
    // $this->db->insert_id();
  }
  function rubah_report(){
    $id_laporan = $this->input->post('id_laporan');
    $tgl_laporan = $this->input->post('tgl_laporan');
    $tgl_laporan = date('Y-m-d', strtotime($tgl_laporan));
    $tgl_awal = $this->input->post('tgl_awal');
    $tgl_awal = date('Y-m-d', strtotime($tgl_awal));
    $tgl_akhir = $this->input->post('tgl_akhir');
    $tgl_akhir = date('Y-m-d', strtotime($tgl_akhir));
    $data_pendaftaran = array(
      'tgl_laporan' => $tgl_laporan,
      'tgl_awal' => $tgl_awal,
      'tgl_akhir' => $tgl_akhir,
      'header_laporan'  => $this->input->post('header_laporan'),
      'sub_header_laporan'  => $this->input->post('sub_header_laporan'),
      'sub_sub_header_laporan'  => $this->input->post('sub_sub_header_laporan'),
      'judul_laporan'  => $this->input->post('judul_laporan'),
      'tujuan_laporan'  => $this->input->post('tujuan_laporan'),
      'sumber_laporan'  => $this->input->post('sumber_laporan'),
      'periode_laporan'  => $this->input->post('periode_laporan')
    );
    $this->db->where('id_laporan',$id_laporan);
    $this->db->update('ol_per_laporan', $data_pendaftaran);
    //echo $this->db->last_query();
    $this->db->trans_complete();  // untuk cek sukses update tidak
    if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
    // if (!$this->db->affected_rows())
      return(FALSE);
    else
      return(TRUE);
  }
  function laporan_detil_all($id,$jns)
  {
    $fields = "*,
    DATE_FORMAT(tgl_laporan,'%d-%m-%Y') as tgl_laporan,tgl_laporan as tgl_sort,DATE_FORMAT(tgl_awal,'%d-%m-%Y') as tgl_awal,DATE_FORMAT(tgl_akhir,'%d-%m-%Y') as tgl_akhir,concat(format(COALESCE(min_laporan_detil, 0),0),' - ',format(COALESCE(max_laporan_detil, 0),0)) as minimax,if(periode_laporan_detil=1,'HARIAN',if(periode_laporan_detil=2,'BULANAN','TAHUNAN')) as periode_laporan_detil,if(jenis_per_laporan_detil = 2,'Quality Control','Logbook') as jenis_per_laporan_detil
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
        switch($k['data']){   //beberapa field ambigius, so sesuaikan [coding here]
        //   case 'no_hp' : $nmf="peg.no_hp";break;
          // case 'id_level'   : $nmf="u.id_level";break;
        default: $nmf=$k['data'];
        }
        $this->db->or_like($nmf, $cari['value'],'both',false);  
      $this->db->where('old.id_laporan',$id);
      $this->db->where('lap.laporan_unit',$this->session->unit);
      $this->db->where('lap.pembuat_laporan',$this->session->barcode_pegawai);
      }
      }
    }
    $this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

      $this->db->from('ol_per_laporan_detil old');  
      $this->db->join('ol_per_laporan lap', 'lap.id_laporan=old.id_laporan','left');
      $this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=lap.pembuat_laporan','left');
      $this->db->join('ol_unit ou', 'ou.id_unit=lap.laporan_unit','left');
      $this->db->join('sn_tabel st', 'st.id_tabel=old.tabel','left');
      $this->db->where('old.id_laporan',$id);
      $this->db->where('lap.laporan_unit',$this->session->unit);
      $this->db->where('lap.pembuat_laporan',$this->session->barcode_pegawai);

    $q = $this->db->limit($length,$start)->get_where(); //05 Execute

    $list=$q->result_array(); //06 Hasil
// echo $this->db->last_query();
  //--------- Query jumlah filter untuk paging -----
    $this->db->select("COUNT(*) as num"); //01 Select

    if(!empty($cari['value'])) {    //02 Where
      foreach($dt_kolom as $k){
      if($k['searchable']=='true'){ //cek kalo searchable
        switch($k['data']){   //beberapa field ambigius, so sesuaikan  [coding here]
        //  case 'no_hp' : $nmf="peg.no_hp";break;
          default: $nmf=$k['data'];
        }
        $this->db->or_like($nmf, $cari['value'],'both',false);
      $this->db->where('old.id_laporan',$id);
      $this->db->where('lap.laporan_unit',$this->session->unit);
      $this->db->where('lap.pembuat_laporan',$this->session->barcode_pegawai);
      }
      }
    }

      $this->db->from('ol_per_laporan_detil old');  
      $this->db->join('ol_per_laporan lap', 'lap.id_laporan=old.id_laporan','left');
      $this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=lap.pembuat_laporan','left');
      $this->db->join('ol_unit ou', 'ou.id_unit=lap.laporan_unit','left');
      $this->db->join('sn_tabel st', 'st.id_tabel=old.tabel','left');
      $this->db->where('old.id_laporan',$id);
      $this->db->where('lap.laporan_unit',$this->session->unit);
      $this->db->where('lap.pembuat_laporan',$this->session->barcode_pegawai);

    $q = $this->db->get_where(); //04 Execute
    $jml_filter = $q->row()->num; //05 Hasil

  //--------- Query jumlah All data paling banyak -----
/*    $kondisi=array('id_unit='=>$this->session->unit);
    $jml = $this->m_umum->jumlah_record_filter('ol_eq_imut',$kondisi); */
/*    $kondisi=array('id_unit='=>$this->session->unit,'jenis_equipment'=>1);
    $jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_eq_imut',$kondisi,'ol_equipment','id_equipment'); */
    $jml = $this->m_umum->jumlah_record_tabel('ol_per_laporan_detil');

    $output = array(
      "draw" => $draw,
        "recordsTotal" => $jml,
        "recordsFiltered" => $jml_filter,
        "data" => $list
    );
    // print_r($output);die();
    return $output;
  }
  function tambah_tabel_per_laporan(){
    $kode = $this->m_rancak->kode_generator(15,'LT');
    $data_pendaftaran = array(
      'id_laporan_detil' => $kode,
      'id_laporan'  => $this->input->post('id_laporan'),
      'judul_laporan_detil'  => $this->input->post('judul_laporan_detil'),
      'tabel'  => $this->input->post('tabel'),
      'urutan_laporan_detil'  => $this->input->post('urutan_laporan_detil'),
      'periode_laporan_detil'  => $this->input->post('periode_laporan_detil'),
      'min_laporan_detil'  => $this->input->post('min_laporan_detil'),
      'max_laporan_detil'  => $this->input->post('max_laporan_detil'),
      'jenis_per_laporan_detil'  => $this->input->post('jenis_per_laporan_detil'),
      'id_equipment'  => $this->input->post('id_equipment'),
      'equipment_detil'  => $this->input->post('equipment_detil'),
      'button'  => $this->input->post('button'),
      'analisa_laporan_detil'  => $this->input->post('analisa_laporan_detil'),
      'rekomendasi_laporan_detil'  => $this->input->post('rekomendasi_laporan_detil')
    );
    $this->db->insert('ol_per_laporan_detil', $data_pendaftaran);
    return $kode;
    // $this->db->insert_id();
  }
  function rubah_tabel_per_laporan(){
    $id_laporan_detil = $this->input->post('id_laporan_detil');
    $jenis_per_laporan_lama = $this->input->post('jenis_per_laporan_lama');
    $jenis_per_laporan_detil = $this->input->post('jenis_per_laporan_detil');
    if($jenis_per_laporan_lama == $jenis_per_laporan_detil){
		$id_equipment = $this->input->post('id_equipment');
		$equipment_detil = $this->input->post('equipment_detil');   	
    }else{
		$id_equipment = "";
		$equipment_detil = "";  
    }
    $data_pendaftaran = array(
      'judul_laporan_detil'  => $this->input->post('judul_laporan_detil'),
      'tabel'  => $this->input->post('tabel'),
      'urutan_laporan_detil'  => $this->input->post('urutan_laporan_detil'),
      'id_equipment'  => $id_equipment,
      'equipment_detil'  => $equipment_detil,
      'periode_laporan_detil'  => $this->input->post('periode_laporan_detil'),
      'min_laporan_detil'  => $this->input->post('min_laporan_detil'),
      'max_laporan_detil'  => $this->input->post('max_laporan_detil'),
      'jenis_per_laporan_detil'  => $this->input->post('jenis_per_laporan_detil'),
      'button'  => $this->input->post('button'),
      'analisa_laporan_detil'  => $this->input->post('analisa_laporan_detil'),
      'rekomendasi_laporan_detil'  => $this->input->post('rekomendasi_laporan_detil')
    );
    $this->db->where('id_laporan_detil',$id_laporan_detil);
    $this->db->update('ol_per_laporan_detil', $data_pendaftaran);
    //echo $this->db->last_query();
    $this->db->trans_complete();  // untuk cek sukses update tidak
    if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
    // if (!$this->db->affected_rows())
      return(FALSE);
    else
      return(TRUE);
  }
  function simpan_eq_lap(){
    $id_laporan_detil = $this->input->post('id_laporan_detil');
    $chk = $this->input->post('chk[]');
    if($chk) {
      $id_equipment = implode(",", $chk);
      $equipment_detil = "";
    }else{
      $id_equipment = "";
      $equipment_detil = "";
    }
    $data_pendaftaran = array(
      'id_equipment'  => $id_equipment,
      'equipment_detil'  => $equipment_detil
    );
    $this->db->where('id_laporan_detil',$id_laporan_detil);
    $this->db->update('ol_per_laporan_detil', $data_pendaftaran);
    //echo $this->db->last_query();
    $this->db->trans_complete();  // untuk cek sukses update tidak
    if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
    // if (!$this->db->affected_rows())
      return(FALSE);
    else
      return(TRUE);
  }
  function simpan_eq_detil(){
    $id_laporan_detil = $this->input->post('id_laporan_detil');
    $chk = $this->input->post('chk[]');
    if($chk) {
        $terpilih = implode(",", $chk);
    }else{
      $terpilih = "";
    }
    $data_pendaftaran = array(
      'equipment_detil'  => $terpilih
    );
    $this->db->where('id_laporan_detil',$id_laporan_detil);
    $this->db->update('ol_per_laporan_detil', $data_pendaftaran);
    //echo $this->db->last_query();
    $this->db->trans_complete();  // untuk cek sukses update tidak
    if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
    // if (!$this->db->affected_rows())
      return(FALSE);
    else
      return(TRUE);
  }
//===============================================
  function ambil_equipment_ruangan($id,$grup,$jns)
  {
      $lpd = $this->m_ol_rancak->ambil_data_per_laporan_detil($id);
		$this->db->join('ol_eq_detil', 'ol_eq_detil.id_eq_detil=ol_eq_imut.id_eq_detil','left');
		$this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_eq_detil.id_equipment','left');
      $this->db->where('tgl_eq_imut BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'] .'"');
      $this->db->group_by($grup);
      $q= $this->db->get_where('ol_eq_imut',array('status_eq_imut'=>1,'id_unit'=>$this->session->unit,'jenis_equipment'=>$jns))->result_array();
/*    //  $ids = explode(',', $jns);
      $this->db->where_in('jenis_per_imqc',$jns);
      $q= $this->db->get_where('ol_per_imqc',array())->result_array();*/
      //$q = $this->db->get_where($tabel,$kondisi)->result_array(); 
      //echo $this->db->last_query();die();
      //print_r($q);die();
      return $q;
  }
  function ambil_logbook_laporan($id,$grup)
  {
      $lpd = $this->m_ol_rancak->ambil_data_per_laporan_detil($id);
      $this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');     
      $this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
      $this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'] .'"');
      $this->db->group_by($grup);
      $q= $this->db->get_where('ol_logbook',array('status_logbook'=>1,'id_unit'=>$this->session->unit,'id_logbooker'=>$this->session->id_pegawai))->result_array();
      //echo $this->db->last_query();die();
      //print_r($q);die();
      return $q;
  }
  function ambil_equipment_lap($id,$grup,$jns)
  {
      $lpd = $this->m_ol_rancak->ambil_data_per_laporan_detil($id);
      $this->db->join('ol_per_imqc_detil','ol_per_imqc_detil.id_per_imqc_detil=ol_per_imqc_hasil.id_per_imqc_detil','left');
      $this->db->join('ol_per_imqc','ol_per_imqc.id_per_imqc=ol_per_imqc_detil.id_per_imqc','left');
      $this->db->where('tgl_per_imqc_hasil BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'] .'"');
      $this->db->group_by($grup);
      $q= $this->db->get_where('ol_per_imqc_hasil',array('status_per_imqc_hasil'=>1,'id_unit'=>$this->session->unit,'jenis_per_imqc'=>$jns))->result_array();
/*    //  $ids = explode(',', $jns);
      $this->db->where_in('jenis_per_imqc',$jns);
      $q= $this->db->get_where('ol_per_imqc',array())->result_array();*/
      //$q = $this->db->get_where($tabel,$kondisi)->result_array(); 
      //echo $this->db->last_query();die();
      //print_r($q);die();
      return $q;

  }
  function ambil_berkas_personal($grup=FALSE)
  {
      $this->db->join('ol_berkas_kategori', 'ol_berkas_kategori.id_berkas_kategori=ol_berkas.id_kategori_berkas','left');
      if($grup){	
      	$this->db->group_by($grup);
      }
      $q= $this->db->get_where('ol_berkas',array('status_berkas_kategori'=>1,'status_berkas'=>1,'id_pegawai'=>$this->session->id_pegawai))->result_array();
      //echo $this->db->last_query();die();
      //print_r($q);die();
      return $q;
  }
  function ambil_eq_detil($id,$grup,$jns)
  {
    $lpd = $this->m_ol_rancak->ambil_data_per_laporan_detil($id);
    if($lpd['id_equipment']){
      $this->db->join('ol_per_imqc_detil', 'ol_per_imqc_detil.id_per_imqc_detil=ol_per_imqc_hasil.id_per_imqc_detil','left');     
      $this->db->join('ol_per_imqc', 'ol_per_imqc.id_per_imqc=ol_per_imqc_detil.id_per_imqc','left');
      $this->db->where('tgl_per_imqc_hasil BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'] .'"');
      $idx = explode(',', $lpd['id_equipment']);    
      $this->db->where_in("ol_per_imqc.coun_per_imqc",$idx);
      $this->db->group_by($grup);
      $q= $this->db->get_where('ol_per_imqc_hasil',array('status_per_imqc_hasil'=>1,'id_unit'=>$this->session->unit,'jenis_per_imqc'=>$jns))->result_array();
      //$q = $this->db->get_where($tabel,$kondisi)->result_array(); 
      //echo $this->db->last_query();die();
      //print_r($q);die();
      return $q;
    }
  }
  function ambil_eq_unit_detil($id,$grup,$jns)
  {
    $lpd = $this->m_ol_rancak->ambil_data_per_laporan_detil($id);
    if($lpd['id_equipment']){
    $this->db->join('ol_eq_detil', 'ol_eq_detil.id_eq_detil=ol_eq_imut.id_eq_detil','left');
    $this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_eq_detil.id_equipment','left');
      $this->db->where('tgl_eq_imut BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'] .'"');
      $idx = explode(',', $lpd['id_equipment']);    
      $this->db->where_in("ol_equipment.coun_equipment",$idx);
      $this->db->group_by($grup);
      $q= $this->db->get_where('ol_eq_imut',array('status_eq_detil'=>1,'id_unit'=>$this->session->unit,'jenis_equipment'=>$jns))->result_array();
      //$q = $this->db->get_where($tabel,$kondisi)->result_array(); 
      //echo $this->db->last_query();die();
      //print_r($q);die();
      return $q;
    }
  }
  function ambil_logbook_detil($id,$grup)
  {
    $lpd = $this->m_ol_rancak->ambil_data_per_laporan_detil($id);
    if($lpd['id_equipment']){
      $this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');     
      $this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
      $this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'] .'"');
      $idx = explode(',', $lpd['id_equipment']);    
      $this->db->where_in('nkr_kompetensi.coun_kompetensi',$idx);
      $this->db->group_by($grup);
      $q= $this->db->get_where('ol_logbook',array('status_logbook'=>1,'id_unit'=>$this->session->unit,'id_logbooker'=>$this->session->id_pegawai))->result_array();
      //$q = $this->db->get_where($tabel,$kondisi)->result_array(); 
      //echo $this->db->last_query();die();
      //print_r($q);die();
      return $q;
    }
  }
  function pendaftaran_all()
  {
    $fields = "*,if (op.jk = '1' ,'Laki-laki','Perempuan') as jk,
CONCAT((TIMESTAMPDIFF( YEAR, op.tgl_lahir, tgl_transaksi )), ' Tahun ', 
TIMESTAMPDIFF( MONTH, op.tgl_lahir, tgl_transaksi ) % 12, ' Bulan ',
FLOOR( TIMESTAMPDIFF( DAY, op.tgl_lahir, tgl_transaksi ) % 30.4375 ), ' Hari') as umur,op.alamat as alamat,
if(status_transaksi = 0,'Pendaftaran','Selesai') as status_transaksi,
concat('[RM : ',rm,'] - Nama : ',nama_pasien) as nama_pasien,
DATE_FORMAT(tgl_transaksi,'%d-%m-%Y') as tgl_transaksi,tgl_transaksi as tgl_sortir,
DATE_FORMAT(wkt_transaksi,'%d-%m-%Y %H:%i:%s') as wkt_transaksi,FORMAT(harga_transaksi,'#,###,##0') as harga_transaksi
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
        switch($k['data']){   //beberapa field ambigius, so sesuaikan [coding here]
          // case 'telp' : $nmf="peg.telp";break;
          // case 'id_level'   : $nmf="u.id_level";break;
        default: $nmf=$k['data'];
        }
        $this->db->or_like($nmf, $cari['value'],'both',false);
  		$this->db->where('admin_operator',$this->session->barcode_pegawai);
  //		$this->db->where('status_transaksi',0);
      }
      }
    }
    $this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('tindakan_transaksi td');
		$this->db->join('tindakan_operator to', 'to.id_transaksi=td.id_transaksi','left');
		$this->db->join('tindakan t', 't.id_tindakan=td.id_tindakan','left');
		$this->db->join('ol_pasien op', 'op.id_pasien=td.id_pasien','left');
		$this->db->join('ol_unit ou', 'ou.id_unit=td.unit_tindakan','left');
		$this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=td.admin_transaksi','left');
	//	$this->db->where('find_in_set(ou.coun_unit, "'.$this->session->mas_unit.'") != 0');
  		$this->db->where('admin_operator',$this->session->barcode_pegawai);
  //		$this->db->where('status_transaksi',0);
    $q = $this->db->limit($length,$start)->get_where(); //05 Execute

    $list=$q->result_array(); //06 Hasil
    //echo $this->db->last_query();
  //--------- Query jumlah filter untuk paging -----
    $this->db->select("COUNT(*) as num"); //01 Select

    if(!empty($cari['value'])) {    //02 Where
      foreach($dt_kolom as $k){
      if($k['searchable']=='true'){ //cek kalo searchable
        switch($k['data']){   //beberapa field ambigius, so sesuaikan  [coding here]
        //  case 'telp' : $nmf="peg.telp";break;
          default: $nmf=$k['data'];
        }
        $this->db->or_like($nmf, $cari['value'],'both',false);
  		$this->db->where('admin_operator',$this->session->barcode_pegawai);
  //		$this->db->where('status_transaksi',0);
      }
      }
    }

		$this->db->from('tindakan_transaksi td');
		$this->db->join('tindakan_operator to', 'to.id_transaksi=td.id_transaksi','left');
		$this->db->join('tindakan t', 't.id_tindakan=td.id_tindakan','left');
		$this->db->join('ol_pasien op', 'op.id_pasien=td.id_pasien','left');
		$this->db->join('ol_unit ou', 'ou.id_unit=td.unit_tindakan','left');
		$this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=td.admin_transaksi','left');
	//	$this->db->where('find_in_set(ou.coun_unit, "'.$this->session->mas_unit.'") != 0');
  		$this->db->where('admin_operator',$this->session->barcode_pegawai);
  //		$this->db->where('status_transaksi',0);

    $q = $this->db->get_where(); //04 Execute
   //echo $this->db->last_query();
    $jml_filter = $q->row()->num; //05 Hasil

  //--------- Query jumlah All data paling banyak -----
  //  $kondisi=array('unit_tindakan'=>$this->session->unit);
    $jml = $this->m_umum->jumlah_record_tabel('tindakan_transaksi');

    $output = array(
      "draw" => $draw,
        "recordsTotal" => $jml,
        "recordsFiltered" => $jml_filter,
        "data" => $list
    );
    //echo $this->db->last_query();
    // print_r($output);die();
    return $output;
  }
  function ambil_datatable_transaksi_pendaftaran()
  {
    $this->db->select("*,if (ol_pasien.jk = '1' ,'Laki-laki','Perempuan') as jk,
        CONCAT((TIMESTAMPDIFF( YEAR, ol_pasien.tgl_lahir, tgl_transaksi )), ' Tahun ', 
        TIMESTAMPDIFF( MONTH, ol_pasien.tgl_lahir, tgl_transaksi ) % 12, ' Bulan ',
        FLOOR( TIMESTAMPDIFF( DAY, ol_pasien.tgl_lahir, tgl_transaksi ) % 30.4375 ), ' Hari') as umur,ol_pasien.alamat as alamat,
        if(status_transaksi = 0,'Pendaftaran','Selesai') as status_transaksi,
        concat('[RM : ',rm,'] - Nama : ',nama_pasien) as nama_pasien,
        DATE_FORMAT(tgl_transaksi,'%d-%m-%Y') as tgl_transaksi,tgl_transaksi as tgl_sortir,
        DATE_FORMAT(wkt_transaksi,'%d-%m-%Y %H:%i:%s') as wkt_transaksi,FORMAT(harga_transaksi,'#,###,##0') as harga_transaksi
      ");
    $this->db->join('tindakan_transaksi', 'tindakan_transaksi.id_transaksi=tindakan_operator.id_transaksi','left');
    $this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=tindakan_operator.admin_operator','left');
    $this->db->join('ol_pasien', 'ol_pasien.id_pasien=tindakan_transaksi.id_pasien','left');
    $this->db->join('tindakan', 'tindakan.id_tindakan=tindakan_transaksi.id_tindakan','left');
    $this->db->join('kol_golongan_pemeriksaan', 'kol_golongan_pemeriksaan.id_golongan_pemeriksaan=tindakan.id_golongan_pemeriksaan','left');
    $this->db->join('ol_unit', 'ol_unit.id_unit=tindakan_transaksi.unit_tindakan','left');
    $this->db->join('kol_working', 'kol_working.id_working=ol_unit.id_instansi','left');
    $q = $this->db->get_where('tindakan_operator',array('status_transaksi'=>0,'status_operator'=>1,'admin_operator'=>$this->session->barcode_pegawai));
    return $q->result_array();
  }
  function ambil_data_transaksi_pendaftaran($id)
  {
    $this->db->join('tindakan_transaksi', 'tindakan_transaksi.id_transaksi=tindakan_operator.id_transaksi','left');
    $this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=tindakan_operator.admin_operator','left');
    $this->db->join('ol_pasien', 'ol_pasien.id_pasien=tindakan_transaksi.id_pasien','left');
    $this->db->join('tindakan', 'tindakan.id_tindakan=tindakan_transaksi.id_tindakan','left');
    $this->db->join('kol_golongan_pemeriksaan', 'kol_golongan_pemeriksaan.id_golongan_pemeriksaan=tindakan.id_golongan_pemeriksaan','left');
    $this->db->join('ol_unit', 'ol_unit.id_unit=tindakan_transaksi.unit_tindakan','left');
    $this->db->join('kol_working', 'kol_working.id_working=ol_unit.id_instansi','left');
    $q = $this->db->get_where('tindakan_operator',array('id_operator'=>$id,'status_transaksi'=>0,'status_operator'=>1,'admin_operator'=>$this->session->barcode_pegawai));
    return $q->row_array();
  }
  function kewenangan_all_no_null($id)
  {
    $this->db->select("id_kewenangan,concat(nama_kewenangan,' [ ',nama_kompetensi,' ]') as nama_kewenangan");
    $this->db->join('nkr_kompetensi okm', 'okm.id_kompetensi=ok.id_kompetensi','left');
    $this->db->join('jabatan', 'jabatan.id_jabatan=okm.id_jabatan','left');
    $this->db->where('okm.id_jabatan', $id);
    $q= $this->db->get_where('nkr_kewenangan ok')->result_array();
    $hasil= array_column($q,'nama_kewenangan','id_kewenangan');
    return $hasil;
  }
  function simpan_logboook(){
    $kode = $this->m_rancak->kode_generator_urut(15,'LB');
    $kode2 = $this->m_rancak->kode_generator(15,'LB');
    $data_pendaftaran = array(
        'id_logbook' => $kode,
        'id_kewenangan' => $this->input->post('id_kewenangan'),
        'id_instansi' => $this->session->refer,
        'id_unit' => $this->session->unit,
        'jml_logbook' => $this->input->post('jml_logbook'),
        'id_sifat_kewenangan' => $this->input->post('id_sifat_kewenangan'),
        'rm' => $this->input->post('rm'),
        'barcode_logbook' => $kode2,
        'tgl_logbook' => $this->input->post('tgl_transaksi'),
        'id_logbooker' => $this->session->id_pegawai  
      );
    $this->db->insert('ol_logbook', $data_pendaftaran);
    return $kode;
  }
  function simpan_tindakan_kewenangan($id){
    $kode = $this->m_rancak->kode_generator_urut(15,'TK');
    $data_pendaftaran = array(
      'id_tindakan_kewenangan' => $kode,
      'id_logbook' => $id,
      'id_operator' => $this->input->post('id_operator')
    );
    return $this->db->insert('tindakan_kewenangan', $data_pendaftaran);
  }
  function simpen_ol_logbook_pasien($id){
    $kode = $this->m_rancak->kode_generator_urut(15,'PS');
    $data_pendaftaran = array(
      'id_logbook_pasien' => $kode,         
      'id_pasien' => $this->input->post('id_pasien'),               
      'id_logbook' => $id
    );
    $this->db->insert('ol_logbook_pasien', $data_pendaftaran);
    return $kode;
  }
  function rubah_kewenangan(){
    $id_logbook = $this->input->post('id_logbook');
    $data_pendaftaran = array(
        'jml_logbook' => $this->input->post('jml_logbook'),
        'id_sifat_kewenangan' => $this->input->post('id_sifat_kewenangan'),
        'id_kewenangan' => $this->input->post('id_kewenangan')
    );
    $this->db->where('id_logbook',$id_logbook);
    $this->db->update('ol_logbook', $data_pendaftaran);
    //echo $this->db->last_query();
    $this->db->trans_complete();  // untuk cek sukses update tidak
    if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
    // if (!$this->db->affected_rows())
      return(FALSE);
    else
      return(TRUE);
  }
//===============================================
// ================================================= LAPORAN
}
/*	$this->db->select('*')->from('users')
        ->group_start()
                ->where('a', $firstname)
                ->where('b', $lastname)
                ->where('c', '1')
                ->or_group_start()
                        ->where('d', $customer_mobile)
                        ->where('e', '1')
                ->group_end()
        ->group_end()
->get();*/