<?php
class M_berkas extends CI_model{
    function jumlah_berkas_ruangan($id,$id_ruangan)    //igd.php untuk menampilkan jumlah antrian di igd saja
    {
		$this->db->join('pegawai', 'pegawai.id_pegawai=berkas.id_pegawai','left');
        $this->db->where('pegawai.id_ruangan', $id_ruangan);
		$array_check = array(1,2,3);
		$this->db->where_in('berkas.id_kategori_berkas', $array_check);
		$this->db->where('status_berkas', '1');
		if($id == '0'){
			$this->db->where('tgl_b_berkas >', date('Y-m-d'));
		}else{
			$this->db->where('tgl_b_berkas <=', date('Y-m-d'));
		}
        $query = $this->db->select("COUNT(*) as num")->get_where('berkas');
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
    }
    function jumlah_berkasumum_ruangan($id_ruangan,$id)    //igd.php untuk menampilkan jumlah antrian di igd saja
    {
		$this->db->join('pegawai', 'pegawai.id_pegawai=b.id_pegawai','left');
		$this->db->join('kol_kategori_berkas kb', 'kb.id_kategori_berkas=b.id_kategori_berkas','left');
        $this->db->where('pegawai.id_ruangan', $id_ruangan);
		$this->db->where("b.id_kategori_berkas >", 9);
		if($id > 0){
			$this->db->where("b.id_kategori_berkas", $id);
		}
		$this->db->where('status_berkas', '1');
        $query = $this->db->select("COUNT(*) as num")->get_where('berkas b');
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
    }
	function berkas_pribadi_all($id,$level,$ruangan)
	{
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,
					if (b.tgl_kelulusan = '0000-00-00' ,'TIDAK ADA',DATE_FORMAT(b.tgl_kelulusan,'%d-%m-%Y')) as tgl_kelulusan,
					if (b.tgl_a_berkas = '0000-00-00' ,'TIDAK ADA',DATE_FORMAT(b.tgl_a_berkas,'%d-%m-%Y')) as tgl_a_berkas,
					if (b.tgl_b_berkas = '0000-00-00' ,'TIDAK ADA',DATE_FORMAT(b.tgl_b_berkas,'%d-%m-%Y')) as tgl_b_berkas
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
		$this->db->where("b.id_kategori_berkas >", 9);
		if($id > 0){
		$this->db->where("b.id_kategori_berkas", $id);
		}
		if($level == '19'){
		$this->db->where("peg.id_ruangan", $ruangan);
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('berkas b');
		$this->db->join('pegawai peg', 'peg.id_pegawai=b.id_pegawai','left');
		$this->db->join('kol_kategori_berkas kb', 'kb.id_kategori_berkas=b.id_kategori_berkas','left');
		$this->db->where("b.id_kategori_berkas >", 9);
		if($id > 0){
		$this->db->where("b.id_kategori_berkas", $id);
		}
		if($level == '19'){
		$this->db->where("peg.id_ruangan", $ruangan);
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
		$this->db->where("b.id_kategori_berkas >", 9);
		if($id > 0){
		$this->db->where("b.id_kategori_berkas", $id);
		}
		if($level == '19'){
		$this->db->where("peg.id_ruangan", $ruangan);
		}
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('berkas b');
		$this->db->join('pegawai peg', 'peg.id_pegawai=b.id_pegawai','left');
		$this->db->join('kol_kategori_berkas kb', 'kb.id_kategori_berkas=b.id_kategori_berkas','left');
		$this->db->where("b.id_kategori_berkas >", 9);
		if($id > 0){
		$this->db->where("b.id_kategori_berkas", $id);
		}
		if($level == '19'){
		$this->db->where("peg.id_ruangan", $ruangan);
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99');
		$jml = $this->m_umum->jumlah_record_filter('pegawai',$kondisi);	 */
		$jml = $this->m_umum->jumlah_record_tabel('berkas');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function str_all($id,$level,$ruangan)
	{
	//	$ids = explode(',', $unit);
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,if (b.tgl_b_berkas = '0000-00-00' ,'TIDAK ADA',DATE_FORMAT(b.tgl_b_berkas,'%d-%m-%Y')) as tgl_b_berkas,
					if (status_berkas = '1' ,'AKTIF','NON AKTIF') as status_berkas";
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
		$array_check = array(1,2,3);
		$this->db->where_in('b.id_kategori_berkas', $array_check);
		$this->db->where('status_berkas', 1);
		if($level == '19'){
		$this->db->where("peg.id_ruangan", $ruangan);
		}
		if($id == '0'){
			$this->db->where('tgl_b_berkas >', date('Y-m-d'));
		}else{
			$this->db->where('tgl_b_berkas <=', date('Y-m-d'));
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('berkas b');
		$this->db->join('pegawai peg', 'peg.id_pegawai=b.id_pegawai','left');
		$this->db->join('kol_kategori_berkas kb', 'kb.id_kategori_berkas=b.id_kategori_berkas','left');
		$array_check = array(1,2,3);
		$this->db->where_in('b.id_kategori_berkas', $array_check);
		$this->db->where('status_berkas', 1);
		if($level == '19'){
		$this->db->where("peg.id_ruangan", $ruangan);
		}
		if($id == '0'){
			$this->db->where('tgl_b_berkas >', date('Y-m-d'));
		}else{
			$this->db->where('tgl_b_berkas <=', date('Y-m-d'));
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
		$array_check = array(1,2,3);
		$this->db->where_in('b.id_kategori_berkas', $array_check);
		$this->db->where('status_berkas', 1);
		if($level == '19'){
		$this->db->where("peg.id_ruangan", $ruangan);
		}
		if($id == '0'){
			$this->db->where('tgl_b_berkas >', date('Y-m-d'));
		}else{
			$this->db->where('tgl_b_berkas <=', date('Y-m-d'));
		}
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('berkas b');
		$this->db->join('pegawai peg', 'peg.id_pegawai=b.id_pegawai','left');
		$this->db->join('kol_kategori_berkas kb', 'kb.id_kategori_berkas=b.id_kategori_berkas','left');
		$array_check = array(1,2,3);
		$this->db->where_in('b.id_kategori_berkas', $array_check);
		$this->db->where('status_berkas', 1);
		if($level == '19'){
		$this->db->where("peg.id_ruangan", $ruangan);
		}
		if($id == '0'){
			$this->db->where('tgl_b_berkas >', date('Y-m-d'));
		}else{
			$this->db->where('tgl_b_berkas <=', date('Y-m-d'));
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('berkas');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function ijasah_all($id,$level,$ruangan)
	{
	//	$ids = explode(',', $unit);
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,if (b.tgl_b_berkas = '0000-00-00' ,'TIDAK ADA',DATE_FORMAT(b.tgl_b_berkas,'%d-%m-%Y')) as tgl_b_berkas,
					if (status_berkas = '1' ,'AKTIF','NON AKTIF') as status_berkas";
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
		$array_check = array(7);
		$this->db->where_in('b.id_kategori_berkas', $array_check);
		$this->db->where('status_berkas =', '1');
		if($level == '19'){
		$this->db->where("peg.id_ruangan", $ruangan);
		}
		if($id > '0'){
			$this->db->where('peg.barcode_pegawai', $id);
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('berkas b');
		$this->db->join('pegawai peg', 'peg.id_pegawai=b.id_pegawai','left');
		$this->db->join('ruangan r', 'r.id_ruangan=peg.id_ruangan','left');
		$this->db->join('kol_kategori_berkas kb', 'kb.id_kategori_berkas=b.id_kategori_berkas','left');
		$this->db->join('kol_pendidikan kp', 'kp.id_pendidikan=b.id_pendidikan','left');
		$array_check = array(7);
		$this->db->where_in('b.id_kategori_berkas', $array_check);
		$this->db->where('status_berkas =', '1');
		if($level == '19'){
		$this->db->where("peg.id_ruangan", $ruangan);
		}
		if($id > '0'){
			$this->db->where('peg.barcode_pegawai', $id);
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
		$array_check = array(7);
		$this->db->where_in('b.id_kategori_berkas', $array_check);
		$this->db->where('status_berkas =', '1');
		if($level == '19'){
		$this->db->where("peg.id_ruangan", $ruangan);
		}
		if($id > '0'){
			$this->db->where('peg.barcode_pegawai', $id);
		}
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('berkas b');
		$this->db->join('pegawai peg', 'peg.id_pegawai=b.id_pegawai','left');
		$this->db->join('ruangan r', 'r.id_ruangan=peg.id_ruangan','left');
		$this->db->join('kol_kategori_berkas kb', 'kb.id_kategori_berkas=b.id_kategori_berkas','left');
		$this->db->join('kol_pendidikan kp', 'kp.id_pendidikan=b.id_pendidikan','left');
		$array_check = array(7);
		$this->db->where_in('b.id_kategori_berkas', $array_check);
		$this->db->where('status_berkas =', '1');
		if($level == '19'){
		$this->db->where("peg.id_ruangan", $ruangan);
		}
		if($id > '0'){
			$this->db->where('peg.barcode_pegawai', $id);
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('berkas');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function ambil_data_surat_ijin($id,$ruangan,$grup)
	{
		$this->db->join('pegawai peg', 'peg.id_pegawai=berkas.id_pegawai','left');
		$this->db->join('ruangan r', 'r.id_ruangan=peg.id_ruangan','left');
		$this->db->join('kol_kategori_berkas kb', 'kb.id_kategori_berkas=berkas.id_kategori_berkas','left');
		$array_check = array(1,2,3);
		$this->db->where_in('berkas.id_kategori_berkas', $array_check);
		$this->db->where('status_berkas', '1');
		if($id == '0'){
			$this->db->where('tgl_b_berkas >', date('Y-m-d'));
		}else{
			$this->db->where('tgl_b_berkas <=', date('Y-m-d'));
		}
		if($grup == '0'){
			$this->db->where('peg.id_ruangan', $ruangan);
			$this->db->order_by('nama_pegawai','asc');
		}else{
			$this->db->group_by('peg.id_ruangan');
		}
		$q = $this->db->get_where('berkas')->result_array();
		return $q;
    }
	function ambil_data_berkas_umum($ruangan,$id)
	{
		$this->db->join('pegawai peg', 'peg.id_pegawai=b.id_pegawai','left');
		$this->db->join('ruangan r', 'r.id_ruangan=peg.id_ruangan','left');
		$this->db->join('kol_kategori_berkas kb', 'kb.id_kategori_berkas=b.id_kategori_berkas','left');
		$this->db->join('kol_pendidikan kp', 'kp.id_pendidikan=b.id_pendidikan','left');
		$this->db->where('peg.id_ruangan', $ruangan);
		$this->db->where('b.id_kategori_berkas >', 9);
		$this->db->where('status_berkas =', '1');
		if($id > 0){
			$this->db->where('b.id_kategori_berkas', $id);
		}
		$this->db->order_by('nama_pegawai','asc');
		$q = $this->db->get_where('berkas b')->result_array();
		return $q;
    }
	function ambil_data_ijasah($ruangan,$grup)
	{
		$this->db->join('pegawai peg', 'peg.id_pegawai=b.id_pegawai','left');
		$this->db->join('ruangan r', 'r.id_ruangan=peg.id_ruangan','left');
		$this->db->join('kol_kategori_berkas kb', 'kb.id_kategori_berkas=b.id_kategori_berkas','left');
		$this->db->join('kol_pendidikan kp', 'kp.id_pendidikan=b.id_pendidikan','left');
		$array_check = array(7);
		$this->db->where_in('b.id_kategori_berkas', $array_check);
		$this->db->where('status_berkas =', '1');
		if($grup == '0'){
			$this->db->where('peg.id_ruangan', $ruangan);
		}else{
			$this->db->group_by('peg.id_ruangan');
		}
		$this->db->order_by('nama_pegawai','asc');
		$q = $this->db->get_where('berkas b')->result_array();
		return $q;
    }
	function cmd_ruangan_with_berkas($id_kategori_pelatihan,$first_date,$last_date){
		$this->db->join('pegawai', 'pegawai.id_pegawai=berkas.id_pegawai','left');
		$this->db->join('ruangan', 'ruangan.id_ruangan=pegawai.id_ruangan','left');
		if($id_kategori_pelatihan > '0'){
		$this->db->where("berkas.id_kategori_pelatihan =", $id_kategori_pelatihan);
		}
		$array_check = array(4);
		$this->db->where_in('berkas.id_kategori_berkas', $array_check);
		$this->db->where('berkas.tgl_a_berkas BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$this->db->group_by('pegawai.id_ruangan');
		$q = $this->db->get_where('berkas');
		return $q->result_array();
	}
	function ambil_data_pelatihan($id_kategori_pelatihan,$id_unit,$first_date,$last_date,$grup)
	{
		$this->db->join('kol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=b.id_kategori_pelatihan','left');
		$this->db->join('kol_kategori_berkas kb', 'kb.id_kategori_berkas=b.id_kategori_berkas','left');
		$this->db->join('pegawai peg', 'peg.id_pegawai=b.id_pegawai','left');
		$this->db->join('ruangan u', 'u.id_ruangan=peg.id_ruangan','left');
		if($id_kategori_pelatihan > '0'){
		$this->db->where("b.id_kategori_pelatihan =", $id_kategori_pelatihan);
		}
		if($id_unit > '0'){
		$this->db->where("peg.id_ruangan", $id_unit);
		}
		$array_check = array(4);
		$this->db->where_in('b.id_kategori_berkas', $array_check);
		$this->db->where('b.tgl_a_berkas BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		if($grup == '0'){
		//	$this->db->where('peg.id_ruangan', $ruangan);
			$this->db->order_by('tgl_a_berkas','asc');
		}else{
			$this->db->group_by('peg.id_ruangan');
		}
		$q = $this->db->get_where('berkas b')->result_array();
	//	print_r($q);die();
		return $q;
    }
	function ambil_data_pelatihan_pegawai($id_kategori_pelatihan,$id_pegawai,$first_date,$last_date,$grup)
	{
		$this->db->join('kol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=b.id_kategori_pelatihan','left');
		$this->db->join('kol_kategori_berkas kb', 'kb.id_kategori_berkas=b.id_kategori_berkas','left');
		$this->db->join('pegawai peg', 'peg.id_pegawai=b.id_pegawai','left');
		$this->db->join('ruangan u', 'u.id_ruangan=peg.id_ruangan','left');
		if($id_kategori_pelatihan > '0'){
		$this->db->where("b.id_kategori_pelatihan", $id_kategori_pelatihan);
		}
		$this->db->where("peg.barcode_pegawai", $id_pegawai);
		$array_check = array(4);
		$this->db->where_in('b.id_kategori_berkas', $array_check);
		$this->db->where('b.tgl_a_berkas BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		if($grup == '0'){
		//	$this->db->where('peg.id_ruangan', $ruangan);
			$this->db->order_by('tgl_a_berkas','asc');
		}else{
			$this->db->group_by('peg.id_ruangan');
		}
		$q = $this->db->get_where('berkas b')->result_array();
	//	print_r($q);die();
		return $q;
    }
	function ambil_data_kompetensi_pegawai_oppe($id_pegawai,$tahun)
	{
		$this->db->select('SUM(jml_logbook) as jml_logbook,kp.nama_kompetensi');
		$this->db->join('kr_kewenangan_detil kd', 'kd.id_kewenangan_detil=lp.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan kk', 'kk.id_kewenangan=kd.id_kewenangan','left');
		$this->db->join('kr_kompetensi kp', 'kp.id_kompetensi=kk.id_kompetensi','left');
		$this->db->join('pegawai peg', 'peg.id_pegawai=lp.id_pegawai','left');
		$this->db->where("peg.barcode_pegawai", $id_pegawai);
		$this->db->where('year(tgl_logbook)', $tahun);
		$this->db->group_by('kk.id_kompetensi');
		$q = $this->db->get_where('logbook lp')->result_array();
	//	print_r($q);die();
		return $q;
    }
	function ambil_data_pelatihan_pegawai_oppe($id_pegawai,$tahun)
	{
	//	$this->db->select('*,SUM(kredit) as jml_kredit');
		$this->db->join('kol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=b.id_kategori_pelatihan','left');
		$this->db->join('pegawai peg', 'peg.id_pegawai=b.id_pegawai','left');
		$this->db->where("peg.barcode_pegawai", $id_pegawai);
		$this->db->where('year(tgl_a_berkas)', $tahun);
		$array_check = array(4,5,6);
		$this->db->where_in('b.id_kategori_berkas', $array_check);
		$q = $this->db->get_where('berkas b')->result_array();
	//	print_r($q);die();
		return $q;
    }
	function ambil_data_etik_pegawai_oppe($id_pegawai,$tahun)
	{
	//	$this->db->select('*,COUNT(id_etik_pegawai) as jml_etik');
		$this->db->join('pegawai peg2', 'peg2.id_pegawai=kep.id_pegawai','left');
		$this->db->join('pegawai peg', 'peg.id_pegawai=kep.id_penguji','left');
		$this->db->where("peg2.barcode_pegawai", $id_pegawai);
		$this->db->where('year(tgl_etik_pegawai)', $tahun);
		$q = $this->db->get_where('kr_etik_pegawai kep')->result_array();
	//	print_r($q);die();
		return $q;
    }
	function ambil_kol_kategori_pelatihan_graph()
	{
		$this->db->join('kol_kategori_pelatihan', 'kol_kategori_pelatihan.id_kategori_pelatihan=berkas.id_kategori_pelatihan','left');
		$this->db->where('berkas.id_kategori_pelatihan >', 0);
		$this->db->group_by('berkas.id_kategori_pelatihan');
		$q = $this->db->get_where('berkas')->result_array();
		return $q;
    }
	function lt_pengembangan($data){
		$this->db->select("DATE_FORMAT(tgl_a_berkas,'%Y') as tgl_logbook");
		$this->db->join('kol_kategori_pelatihan', 'kol_kategori_pelatihan.id_kategori_pelatihan=berkas.id_kategori_pelatihan','left');
		$this->db->join('pegawai', 'pegawai.id_pegawai=berkas.id_pegawai','left');
		$this->db->where('pegawai.barcode_pegawai', $data['id_pegawai']);
		if($data['id_kategori_pelatihan'] > '0'){
		$this->db->where("berkas.id_kategori_pelatihan =", $data['id_kategori_pelatihan']);
		}
		$this->db->where('berkas.id_kategori_pelatihan >', 0);
		$this->db->group_by("year(tgl_a_berkas)");
		$q = $this->db->get('berkas')->result_array();
	//	echo $this->db->last_query();die();
		return $q;
	}
	function lt2_pengembangan($thn,$id_pegawai,$id_kategori_pelatihan){
		$this->db->select("COUNT(berkas.id_kategori_pelatihan) as jml_logbook,berkas.id_kategori_pelatihan");
		$this->db->join('kol_kategori_pelatihan', 'kol_kategori_pelatihan.id_kategori_pelatihan=berkas.id_kategori_pelatihan','left');
		$this->db->join('pegawai', 'pegawai.id_pegawai=berkas.id_pegawai','left');
		$this->db->where('pegawai.barcode_pegawai', $id_pegawai);
		if($id_kategori_pelatihan > '0'){
		$this->db->where("berkas.id_kategori_pelatihan =", $id_kategori_pelatihan);
		}
		$this->db->where('berkas.id_kategori_pelatihan >', 0);
		$this->db->where('year(tgl_a_berkas)', $thn);
		$this->db->group_by("berkas.id_kategori_pelatihan");
		$q = $this->db->get('berkas')->result_array();
	//	echo $this->db->last_query();die();
		return $q;
	}
	function lt($data){
		$this->db->select("DATE_FORMAT(tgl_a_berkas,'%Y') as tgl_logbook");
		$this->db->join('kol_kategori_pelatihan', 'kol_kategori_pelatihan.id_kategori_pelatihan=berkas.id_kategori_pelatihan','left');
		$this->db->join('pegawai', 'pegawai.id_pegawai=berkas.id_pegawai','left');
		if($data['level_id'] == '19'){
			$this->db->where('pegawai.id_ruangan', $data['room_id']);
		}elseif($data['id_unit'] > '0'){
			$$this->db->where('pegawai.id_ruangan', $data['id_unit']);
		}
		if($data['id_kategori_pelatihan'] > '0'){
		$this->db->where("berkas.id_kategori_pelatihan =", $data['id_kategori_pelatihan']);
		}

		$this->db->where('berkas.id_kategori_pelatihan >', 0);
		$this->db->group_by("year(tgl_a_berkas)");
		$q = $this->db->get('berkas')->result_array();
	//	echo $this->db->last_query();die();
		return $q;
	}
	function lt2($thn,$id_unit,$id_kategori_pelatihan,$level_id,$room_id){
		$this->db->select("COUNT(berkas.id_kategori_pelatihan) as jml_logbook,berkas.id_kategori_pelatihan");
		$this->db->join('kol_kategori_pelatihan', 'kol_kategori_pelatihan.id_kategori_pelatihan=berkas.id_kategori_pelatihan','left');
		$this->db->join('pegawai', 'pegawai.id_pegawai=berkas.id_pegawai','left');
		if($level_id == '19'){
			$this->db->where('pegawai.id_ruangan', $room_id);
		}elseif($id_unit > '0'){
		$this->db->where('pegawai.id_ruangan', $id_unit);
		}
		if($id_kategori_pelatihan > '0'){
		$this->db->where("berkas.id_kategori_pelatihan =", $id_kategori_pelatihan);
		}
		$this->db->where('berkas.id_kategori_pelatihan >', 0);
		$this->db->where('year(tgl_a_berkas)', $thn);
		$this->db->group_by("berkas.id_kategori_pelatihan");
		$q = $this->db->get('berkas')->result_array();
	//	echo $this->db->last_query();die();
		return $q;
	}
	function pengajuan_kompetensi_all($id,$thn,$level)
	{
	//	$ids = explode(',', $jabatan);
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
		if($id > 0){
			$this->db->where("b.id_pegawai", $id);
		}
		if($id > 0){
			$this->db->where('year(tgl_pengajuan)', $thn);
		}
		$this->db->where("b.status_pengajuan", "1");
		$this->db->where("(acc_kabid ='2'
						   OR acc_asesor='2'
						   OR acc_komite='2'
						   OR acc_direktur='2')", NULL, FALSE);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by
		$this->db->order_by('peg.nama_pegawai', $dir);

	    $this->db->from('kr_pengajuan b');
		$this->db->join('kol_status_diusulkan su', 'su.id_status_diusulkan=b.id_status_diusulkan','left');
		$this->db->join('pegawai peg', 'peg.id_pegawai=b.id_pegawai','left');
		$this->db->join('pegawai peg2', 'peg2.id_pegawai=b.id_asesor','left');
		$this->db->join('pegawai peg3', 'peg3.id_pegawai=b.id_kredensial','left');
		$this->db->join('pegawai peg4', 'peg4.id_pegawai=b.id_mutu','left');
		$this->db->join('pegawai peg5', 'peg5.id_pegawai=b.id_etika','left');
		$this->db->join('pegawai peg6', 'peg6.id_pegawai=b.id_kabid','left');
		$this->db->join('pegawai peg7', 'peg7.id_pegawai=b.id_komite','left');
		$this->db->join('pegawai peg8', 'peg8.id_pegawai=b.id_direktur','left');
		if($id > 0){
			$this->db->where("b.id_pegawai", $id);
		}
		if($id > 0){
			$this->db->where('year(tgl_pengajuan)', $thn);
		}
		$this->db->where("b.status_pengajuan", "1");
		$this->db->where("(acc_kabid ='2'
						   OR acc_asesor='2'
						   OR acc_komite='2'
						   OR acc_direktur='2')", NULL, FALSE);

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
		if($id > 0){
			$this->db->where("b.id_pegawai", $id);
		}
		if($id > 0){
			$this->db->where('year(tgl_pengajuan)', $thn);
		}
		$this->db->where("b.status_pengajuan", "1");
		$this->db->where("(acc_kabid ='2'
						   OR acc_asesor='2'
						   OR acc_komite='2'
						   OR acc_direktur='2')", NULL, FALSE);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('kr_pengajuan b');
		$this->db->join('kol_status_diusulkan su', 'su.id_status_diusulkan=b.id_status_diusulkan','left');
		$this->db->join('pegawai peg', 'peg.id_pegawai=b.id_pegawai','left');
		$this->db->join('pegawai peg2', 'peg2.id_pegawai=b.id_asesor','left');
		$this->db->join('pegawai peg3', 'peg3.id_pegawai=b.id_kredensial','left');
		$this->db->join('pegawai peg4', 'peg4.id_pegawai=b.id_mutu','left');
		$this->db->join('pegawai peg5', 'peg5.id_pegawai=b.id_etika','left');
		$this->db->join('pegawai peg6', 'peg6.id_pegawai=b.id_kabid','left');
		$this->db->join('pegawai peg7', 'peg7.id_pegawai=b.id_komite','left');
		$this->db->join('pegawai peg8', 'peg8.id_pegawai=b.id_direktur','left');
		if($id > 0){
			$this->db->where("b.id_pegawai", $id);
		}
		if($id > 0){
			$this->db->where('year(tgl_pengajuan)', $thn);
		}
		$this->db->where("b.status_pengajuan", "1");
		$this->db->where("(acc_kabid ='2'
						   OR acc_asesor='2'
						   OR acc_komite='2'
						   OR acc_direktur='2')", NULL, FALSE);

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
	function pelatihan_all($first_date,$last_date,$id_kategori_pelatihan,$id_unit,$level,$ruangan)
	{
	//	$ids = explode(',', $unit);
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,
					if (b.tgl_a_berkas = '0000-00-00' ,'TIDAK ADA',DATE_FORMAT(b.tgl_a_berkas,'%d-%m-%Y')) as tgl_a_berkas,
					if (b.tgl_b_berkas = '0000-00-00' ,'TIDAK ADA',DATE_FORMAT(b.tgl_b_berkas,'%d-%m-%Y')) as tgl_b_berkas,
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
//		$array_check = array(4);
//		$this->db->where_in('b.id_kategori_berkas', $array_check);
		$this->db->where('b.tgl_a_berkas BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
    $this->db->where("kunci", "1");
		if($id_kategori_pelatihan > '0'){
		$this->db->where("b.id_kategori_pelatihan", $id_kategori_pelatihan);
		}
		if($level == '19'){
			$this->db->where("peg.id_ruangan", $ruangan);
		}elseif($id_unit > '0'){
			$this->db->where("peg.id_ruangan", $id_unit);
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('berkas b');
		$this->db->join('kol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=b.id_kategori_pelatihan','left');
		$this->db->join('kol_kategori_berkas kb', 'kb.id_kategori_berkas=b.id_kategori_berkas','left');
		$this->db->join('pegawai peg', 'peg.id_pegawai=b.id_pegawai','left');
		$this->db->join('perawat_detil pd', 'pd.id_pegawai=peg.id_pegawai','left');
		$this->db->join('ruangan u', 'u.id_ruangan=peg.id_ruangan','left');
		$this->db->join('kol_kode_kewenangan kkw', 'kkw.id_kode_kewenangan=pd.id_kode_kewenangan','left');
//		$array_check = array(4);
//		$this->db->where_in('b.id_kategori_berkas', $array_check);
		$this->db->where('b.tgl_a_berkas BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
    $this->db->where("kunci", "1");
		if($id_kategori_pelatihan > '0'){
		$this->db->where("b.id_kategori_pelatihan =", $id_kategori_pelatihan);
		}
		if($level == '19'){
			$this->db->where("peg.id_ruangan", $ruangan);
		}elseif($id_unit > '0'){
			$this->db->where("peg.id_ruangan", $id_unit);
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
//		$array_check = array(4);
//		$this->db->where_in('b.id_kategori_berkas', $array_check);
		$this->db->where('b.tgl_a_berkas BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
    $this->db->where("kunci", "1");
		if($id_kategori_pelatihan > '0'){
		$this->db->where("b.id_kategori_pelatihan =", $id_kategori_pelatihan);
		}
		if($level == '19'){
			$this->db->where("peg.id_ruangan", $ruangan);
		}elseif($id_unit > '0'){
			$this->db->where("peg.id_ruangan", $id_unit);
		}
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('berkas b');
		$this->db->join('kol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=b.id_kategori_pelatihan','left');
		$this->db->join('kol_kategori_berkas kb', 'kb.id_kategori_berkas=b.id_kategori_berkas','left');
		$this->db->join('pegawai peg', 'peg.id_pegawai=b.id_pegawai','left');
		$this->db->join('perawat_detil pd', 'pd.id_pegawai=peg.id_pegawai','left');
		$this->db->join('ruangan u', 'u.id_ruangan=peg.id_ruangan','left');
		$this->db->join('kol_kode_kewenangan kkw', 'kkw.id_kode_kewenangan=pd.id_kode_kewenangan','left');
//		$array_check = array(4);
//		$this->db->where_in('b.id_kategori_berkas', $array_check);
		$this->db->where('b.tgl_a_berkas BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
    $this->db->where("kunci", "1");
		if($id_kategori_pelatihan > '0'){
		$this->db->where("b.id_kategori_pelatihan =", $id_kategori_pelatihan);
		}
		if($level == '19'){
			$this->db->where("peg.id_ruangan", $ruangan);
		}elseif($id_unit > '0'){
			$this->db->where("peg.id_ruangan", $id_unit);
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('berkas');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function cmd_pegawai_null_with_unit_source_jabatan_for_karu($id,$level,$ruangan){
		$ids = explode(',', $id);
	//	$this->db->select("concat(nama_pegawai,'  [',nama_ruangan,']') as nama_pegawai,id_pegawai,barcode_pegawai");
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=pegawai.id_jabatan_fungsional','left');
	//	$this->db->join('ruangan', 'ruangan.id_ruangan=pegawai.id_ruangan','left');
		if($level == '19'){
		$this->db->where('pegawai.id_ruangan',$ruangan);
		}
/*		elseif($level !== '99'){
		$this->db->where_in('id_jabatan',$ids);
		}*/
		$q = $this->db->get_where('pegawai');
		return $q->result_array();
	}
	function pengembangan_all($first_date,$last_date,$id_kategori_pelatihan,$id_pegawai)
	{
	//	$ids = explode(',', $unit);
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,
					if (b.tgl_a_berkas = '0000-00-00' ,'TIDAK ADA',DATE_FORMAT(b.tgl_a_berkas,'%d-%m-%Y')) as tgl_a_berkas,
					if (b.tgl_b_berkas = '0000-00-00' ,'TIDAK ADA',DATE_FORMAT(b.tgl_b_berkas,'%d-%m-%Y')) as tgl_b_berkas,
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
		$array_check = array(4);
		$this->db->where_in('b.id_kategori_berkas', $array_check);
		if($id_kategori_pelatihan > '0'){
		$this->db->where("b.id_kategori_pelatihan =", $id_kategori_pelatihan);
		}
		$this->db->where("peg.barcode_pegawai", $id_pegawai);
		$this->db->where('b.tgl_a_berkas BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('berkas b');
		$this->db->join('kol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=b.id_kategori_pelatihan','left');
		$this->db->join('kol_kategori_berkas kb', 'kb.id_kategori_berkas=b.id_kategori_berkas','left');
		$this->db->join('pegawai peg', 'peg.id_pegawai=b.id_pegawai','left');
		$this->db->join('perawat_detil pd', 'pd.id_pegawai=peg.id_pegawai','left');
		$this->db->join('ruangan u', 'u.id_ruangan=peg.id_ruangan','left');
		$this->db->join('kol_kode_kewenangan kkw', 'kkw.id_kode_kewenangan=pd.id_kode_kewenangan','left');
		$array_check = array(4);
		$this->db->where_in('b.id_kategori_berkas', $array_check);
		if($id_kategori_pelatihan > '0'){
		$this->db->where("b.id_kategori_pelatihan =", $id_kategori_pelatihan);
		}
		$this->db->where("peg.barcode_pegawai", $id_pegawai);
		$this->db->where('b.tgl_a_berkas BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');

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
		$array_check = array(4);
		$this->db->where_in('b.id_kategori_berkas', $array_check);
		if($id_kategori_pelatihan > '0'){
		$this->db->where("b.id_kategori_pelatihan =", $id_kategori_pelatihan);
		}
		$this->db->where("peg.barcode_pegawai", $id_pegawai);
		$this->db->where('b.tgl_a_berkas BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('berkas b');
		$this->db->join('kol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=b.id_kategori_pelatihan','left');
		$this->db->join('kol_kategori_berkas kb', 'kb.id_kategori_berkas=b.id_kategori_berkas','left');
		$this->db->join('pegawai peg', 'peg.id_pegawai=b.id_pegawai','left');
		$this->db->join('perawat_detil pd', 'pd.id_pegawai=peg.id_pegawai','left');
		$this->db->join('ruangan u', 'u.id_ruangan=peg.id_ruangan','left');
		$this->db->join('kol_kode_kewenangan kkw', 'kkw.id_kode_kewenangan=pd.id_kode_kewenangan','left');
		$array_check = array(4);
		$this->db->where_in('b.id_kategori_berkas', $array_check);
		if($id_kategori_pelatihan > '0'){
		$this->db->where("b.id_kategori_pelatihan =", $id_kategori_pelatihan);
		}
		$this->db->where("peg.barcode_pegawai", $id_pegawai);
		$this->db->where('b.tgl_a_berkas BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('berkas');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function print_logbook_bulanane($month,$year,$id)
	{
		$bulan = $year."-".$month;
		$awal	= $year.'-'.$month.'-01';
		$tglakhir = date('t', strtotime($awal));
		$akhir	= $year.'-'.$month.'-'.$tglakhir;

		$this->db->select('SUM(lp.jml_logbook) as jumlaha,kd.id_kewenangan,krw.nama_kewenangan,kw.nama_kode_kewenangan,kp.nama_kompetensi');
		$this->db->join('kr_kewenangan_detil kd', 'kd.id_kewenangan_detil=lp.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan krw', 'krw.id_kewenangan=kd.id_kewenangan','left');
		$this->db->join('kol_kode_kewenangan kw', 'kw.id_kode_kewenangan=kd.id_kode_kewenangan','left');
		$this->db->join('kr_kompetensi kp', 'kp.id_kompetensi=krw.id_kompetensi','left');
		$this->db->where("lp.id_pegawai", $id);
		$this->db->where("month(lp.tgl_logbook)", $month);
		$this->db->where("year(lp.tgl_logbook)", $year);
	//	$this->db->where("DATE_FORMAT(lp.tgl_logbook,'%Y-%m')", $bulan);
		$this->db->group_by('kd.id_kewenangan');
		$q = $this->db->get('logbook lp');
		return $q->result_array();
	}
	function print_logbook_bulanane_beda_ruangan($month,$year,$id)
	{
		$bulan = $year."-".$month;
		$awal	= $year.'-'.$month.'-01';
		$tglakhir = date('t', strtotime($awal));
		$akhir	= $year.'-'.$month.'-'.$tglakhir;

		$this->db->select('SUM(lp.jml_logbook) as jumlaha,lp.id_kewenangan_detil,krw.nama_kewenangan,kw.nama_kode_kewenangan,u.nama_ruangan,kp.nama_kompetensi');
		$this->db->join('kr_kewenangan_detil kd', 'kd.id_kewenangan_detil=lp.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan krw', 'krw.id_kewenangan=kd.id_kewenangan','left');
		$this->db->join('kol_kode_kewenangan kw', 'kw.id_kode_kewenangan=kd.id_kode_kewenangan','left');
		$this->db->join('kr_kompetensi kp', 'kp.id_kompetensi=krw.id_kompetensi','left');
		$this->db->join('ruangan u', 'u.id_ruangan=kd.id_unit','left');
		$this->db->where("lp.id_pegawai", $id);
		$this->db->where("DATE_FORMAT(lp.tgl_logbook,'%Y-%m')", $bulan);
		$this->db->group_by('lp.id_kewenangan_detil');
		$q = $this->db->get('logbook lp');
		return $q->result_array();
	}
	function ambil_range_logbook_bulanane($first_date,$last_date,$id){
		$this->db->select("DATE_FORMAT(tgl_logbook,'%m') as bulan,DATE_FORMAT(tgl_logbook,'%Y') as tahun");
		$this->db->join('pegawai peg', 'peg.id_pegawai=lp.id_pegawai','left');
		$this->db->where("peg.barcode_pegawai", $id);
		$this->db->where('DATE(tgl_logbook) BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$this->db->group_by(array("MONTH(tgl_logbook)", "YEAR(tgl_logbook)"));
		$this->db->order_by('tgl_logbook','ASC');
		$q = $this->db->get('logbook lp')->result_array();
	//	echo $this->db->last_query();die();
		return $q;
	}
	function ambil_range_logbook_bulanane_detil($bln,$thn,$id){
		$this->db->select("sum(jml_logbook) as jumlah,nama_kewenangan");
		$this->db->join('kr_kewenangan_detil kd', 'kd.id_kewenangan_detil=lp.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan krw', 'krw.id_kewenangan=kd.id_kewenangan','left');
		$this->db->join('pegawai peg', 'peg.id_pegawai=lp.id_pegawai','left');
		$this->db->where("peg.barcode_pegawai", $id);
		$this->db->where('YEAR(tgl_logbook)', $thn);
		$this->db->where('MONTH(tgl_logbook)', $bln);
		$this->db->group_by('kd.id_kewenangan');
		$q = $this->db->get('logbook lp')->result_array();
		//echo $this->db->last_query();die();
		return $q;
	}
	function ambil_range_logbook_tahunan($id){
		$this->db->select("DATE_FORMAT(tgl_logbook,'%Y') as tahun");
		$this->db->join('pegawai peg', 'peg.id_pegawai=lp.id_pegawai','left');
		$this->db->where("peg.barcode_pegawai", $id);
		$this->db->group_by("year(tgl_logbook)");
		$this->db->order_by('tgl_logbook','ASC');
		$q = $this->db->get('logbook lp')->result_array();
	//	echo $this->db->last_query();die();
		return $q;
	}
	function ambil_range_logbook_tahunan_detil($thn,$id){
		$this->db->select("sum(jml_logbook) as jumlah,nama_kewenangan");
		$this->db->join('kr_kewenangan_detil kd', 'kd.id_kewenangan_detil=lp.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan krw', 'krw.id_kewenangan=kd.id_kewenangan','left');
		$this->db->join('pegawai peg', 'peg.id_pegawai=lp.id_pegawai','left');
		$this->db->where("peg.barcode_pegawai", $id);
		$this->db->where('YEAR(tgl_logbook)', $thn);
		$this->db->group_by('kd.id_kewenangan');
		$q = $this->db->get('logbook lp')->result_array();
		//echo $this->db->last_query();die();
		return $q;
	}
	function etik_pegawai_all($id,$ruangan,$level)
	{
	//	$ids = explode(',', $unit);
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,p2.nama_pegawai as penguji,pegawai.nama_pegawai,
					if (tgl_etik_pegawai = '0000-00-00' ,'TIDAK ADA',DATE_FORMAT(tgl_etik_pegawai,'%d-%m-%Y')) as tgl_etik_pegawai
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
					 case 'nama_pegawai' : $nmf="pegawai.nama_pegawai";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		if($id > '0'){
			$this->db->where("pegawai.barcode_pegawai", $id);
		}elseif($level == '19'){
			$this->db->where("pegawai.id_ruangan", $ruangan);
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('kr_etik_pegawai');
		$this->db->join('pegawai', 'pegawai.id_pegawai=kr_etik_pegawai.id_pegawai','left');
		$this->db->join('pegawai p2', 'p2.id_pegawai=kr_etik_pegawai.id_penguji','left');
		if($id > '0'){
			$this->db->where("pegawai.barcode_pegawai", $id);
		}elseif($level == '19'){
			$this->db->where("pegawai.id_ruangan", $ruangan);
		}

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				case 'nama_pegawai' : $nmf="pegawai.nama_pegawai";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		if($id > '0'){
			$this->db->where("pegawai.barcode_pegawai", $id);
		}elseif($level == '19'){
			$this->db->where("pegawai.id_ruangan", $ruangan);
		}
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('kr_etik_pegawai');
		$this->db->join('pegawai', 'pegawai.id_pegawai=kr_etik_pegawai.id_pegawai','left');
		$this->db->join('pegawai p2', 'p2.id_pegawai=kr_etik_pegawai.id_penguji','left');
		if($id > '0'){
			$this->db->where("pegawai.barcode_pegawai", $id);
		}elseif($level == '19'){
			$this->db->where("pegawai.id_ruangan", $ruangan);
		}

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('kr_etik_pegawai');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function kol_etik_detil_all($id){
		$this->db->select('*');
		$this->db->join('kol_etik', 'kol_etik.id_etik=kr_etik_detil.id_etik','left');
		$this->db->join('kr_etik_pegawai', 'kr_etik_pegawai.id_etik_pegawai=kr_etik_detil.id_etik_pegawai','left');
		$this->db->where('kr_etik_detil.id_etik_pegawai =', $id);
		$q = $this->db->get_where('kr_etik_detil');
		return $q->result_array();
	}
	function etik_pegawairow_all($id){
		$this->db->select('*');
		$this->db->where('kr_etik_pegawai.id_etik_pegawai', $id);
		$q = $this->db->get_where('kr_etik_pegawai');
		return $q->row_array();
	}
	function ambil_data_kewenangan_pegawai($id)	//daftar.php pasien
	{
		$this->db->join('logbook', 'logbook.id_kewenangan_detil=kr_kewenangan_detil.id_kewenangan_detil','left');
		$this->db->join('pegawai', 'pegawai.id_pegawai=logbook.id_pegawai','left');
		$this->db->join('kr_kewenangan', 'kr_kewenangan.id_kewenangan=kr_kewenangan_detil.id_kewenangan','left');
		$this->db->group_by('kr_kewenangan_detil.id_kewenangan');
		$query = $this->db->get_where('kr_kewenangan_detil',array('barcode_pegawai' => $id));
		return $query->result_array();
	}
	function logbook_kewenangan_all($id_pegawai,$id_kewenangan)
	{
	//	$ids = explode(',', $unit);
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,
					DATE_FORMAT(lp.tgl_logbook,'%d-%m-%Y') as tgl_logbook,lp.id_logbook,DATE_FORMAT(lp.jam_logbook,'%H:%i:%s') as jam_logbook,
					DATE_FORMAT(lp.tgl_v_karu,'%d-%m-%Y') as tgl_v_karu,DATE_FORMAT(lp.tgl_v_kabid,'%d-%m-%Y') as tgl_v_kabid,
					DATE_FORMAT(lp.tgl_v_asesor,'%d-%m-%Y') as tgl_v_asesor,DATE_FORMAT(lp.tgl_v_komite,'%d-%m-%Y') as tgl_v_komite,
					DATE_FORMAT(lp.tgl_v_direktur,'%d-%m-%Y') as tgl_v_direktur,krw.id_kewenangan,
					if(lp.v_karu = '0' ,'Proses',if(lp.v_karu = '1' ,'Kompeten','Ditolak')) as v_karu,
					if(lp.v_kabid = '0' ,'Proses',if(lp.v_kabid = '1' ,'Kompeten','Ditolak')) as v_kabid,
					if(lp.v_asesor = '0' ,'Proses',if(lp.v_asesor = '1' ,'Kompeten','Ditolak')) as v_asesor,
					if(lp.v_direktur = '0' ,'Proses',if(lp.v_direktur = '1' ,'Kompeten','Ditolak')) as v_direktur,
					if(lp.v_komite = '0' ,'Proses',if(lp.v_komite = '1' ,'Kompeten','Ditolak')) as v_komite
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
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where("peg.barcode_pegawai =", $id_pegawai);
		$this->db->where("kd.id_kewenangan =", $id_kewenangan);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('logbook lp');
		$this->db->join('kr_kewenangan_detil kd', 'kd.id_kewenangan_detil=lp.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan krw', 'krw.id_kewenangan=kd.id_kewenangan','left');
		$this->db->join('kol_kode_kewenangan kw', 'kw.id_kode_kewenangan=kd.id_kode_kewenangan','left');
		$this->db->join('pegawai peg', 'peg.id_pegawai=lp.id_pegawai','left');
		$this->db->where("peg.barcode_pegawai =", $id_pegawai);
		$this->db->where("kd.id_kewenangan =", $id_kewenangan);

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
		$this->db->where("peg.barcode_pegawai =", $id_pegawai);
		$this->db->where("kd.id_kewenangan =", $id_kewenangan);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('logbook lp');
		$this->db->join('kr_kewenangan_detil kd', 'kd.id_kewenangan_detil=lp.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan krw', 'krw.id_kewenangan=kd.id_kewenangan','left');
		$this->db->join('kol_kode_kewenangan kw', 'kw.id_kode_kewenangan=kd.id_kode_kewenangan','left');
		$this->db->join('pegawai peg', 'peg.id_pegawai=lp.id_pegawai','left');
		$this->db->where("peg.barcode_pegawai =", $id_pegawai);
		$this->db->where("kd.id_kewenangan =", $id_kewenangan);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
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
	function ambil_data_kewenangan($id_pegawai,$id_kewenangan){
		$this->db->select("*,
					DATE_FORMAT(lp.tgl_logbook,'%d-%m-%Y') as tgl_logbook,lp.id_logbook,DATE_FORMAT(lp.jam_logbook,'%H:%i:%s') as jam_logbook,
					DATE_FORMAT(lp.tgl_v_karu,'%d-%m-%Y') as tgl_v_karu,DATE_FORMAT(lp.tgl_v_kabid,'%d-%m-%Y') as tgl_v_kabid,
					DATE_FORMAT(lp.tgl_v_asesor,'%d-%m-%Y') as tgl_v_asesor,DATE_FORMAT(lp.tgl_v_komite,'%d-%m-%Y') as tgl_v_komite,
					DATE_FORMAT(lp.tgl_v_direktur,'%d-%m-%Y') as tgl_v_direktur,krw.id_kewenangan,
					if(lp.v_karu = '0' ,'Proses',if(lp.v_karu = '1' ,'Kompeten','Ditolak')) as v_karu,
					if(lp.v_kabid = '0' ,'Proses',if(lp.v_kabid = '1' ,'Kompeten','Ditolak')) as v_kabid,
					if(lp.v_asesor = '0' ,'Proses',if(lp.v_asesor = '1' ,'Kompeten','Ditolak')) as v_asesor,
					if(lp.v_direktur = '0' ,'Proses',if(lp.v_direktur = '1' ,'Kompeten','Ditolak')) as v_direktur,
					if(lp.v_komite = '0' ,'Proses',if(lp.v_komite = '1' ,'Kompeten','Ditolak')) as v_komite");
		$this->db->join('kr_kewenangan_detil kd', 'kd.id_kewenangan_detil=lp.id_kewenangan_detil','left');
		$this->db->join('kr_kewenangan krw', 'krw.id_kewenangan=kd.id_kewenangan','left');
		$this->db->join('kol_kode_kewenangan kw', 'kw.id_kode_kewenangan=kd.id_kode_kewenangan','left');
		$this->db->join('pegawai peg', 'peg.id_pegawai=lp.id_pegawai','left');
		$this->db->where("peg.barcode_pegawai =", $id_pegawai);
		$this->db->where("kd.id_kewenangan =", $id_kewenangan);
		$q = $this->db->get_where('logbook lp');
		return $q->result_array();
	}
	function grafik_pegawai($id_ruangan,$d)	//Laporan Harian
	{
		if($d =='jk'){
			$this->db->select("if ($d = '1' ,SUM(case when $d = '1' then 1 else 0 end),SUM(case when $d = '0' then 1 else 0 end)) as total,
			if (pegawai.jk = '1' ,'Pria','Perempuan') as jk");
		}
		if($d =='id_pendidikan'){
			$this->db->select("COUNT(pegawai.id_pendidikan) as total,if (pegawai.id_pendidikan = '0' ,'Kosong',nama_pendidikan) as nama_pendidikan");
		}
		if($d =='id_agama'){
			$this->db->select("COUNT(pegawai.id_agama) as total,if (pegawai.id_agama = '0' ,'Kosong',nama_agama) as nama_agama");
		}
		if($d =='id_status_kawin'){
			$this->db->select("COUNT(pegawai.id_status_kawin) as total,if (pegawai.id_status_kawin = '0' ,'Kosong',nama_status_kawin) as nama_status_kawin");
		}
		if($d =='tipe_pegawai'){
			$this->db->select("COUNT(pegawai.tipe_pegawai) as total,if (pegawai.tipe_pegawai = '0' ,'Kosong',nama_status_pegawai) as nama_status_pegawai");
		}
		if($d =='id_ruangan'){
			$this->db->select("COUNT(pegawai.id_ruangan) as total,if (pegawai.id_ruangan = '0' ,'Kosong',nama_ruangan) as nama_ruangan");
		}
		if($d =='id_kode_kewenangan'){
			$this->db->select("COUNT(perawat_detil.id_kode_kewenangan) as total,if (perawat_detil.id_kode_kewenangan = '0' ,'PK 0',nama_kode_kewenangan) as nama_kode_kewenangan");
		}
		if($d =='id_jabatan_fungsional'){
			$this->db->select("COUNT(pegawai.id_jabatan_fungsional) as total,if (pegawai.id_jabatan_fungsional = '0' ,'Kosong',nama_jabatan_fungsional) as nama_jabatan_fungsional");
		}
		if($id_ruangan > 0){
			$this->db->where("pegawai.id_ruangan", $id_ruangan);
		}
		$this->db->join('ruangan', 'ruangan.id_ruangan=pegawai.id_ruangan','left');
		$this->db->join('kol_pendidikan', 'kol_pendidikan.id_pendidikan=pegawai.id_pendidikan','left');
		$this->db->join('kol_agama', 'kol_agama.id_agama=pegawai.id_agama','left');
		$this->db->join('kol_status_kawin', 'kol_status_kawin.id_status_kawin=pegawai.id_status_kawin','left');
		$this->db->join('kol_status_pegawai', 'kol_status_pegawai.id_status_pegawai=pegawai.tipe_pegawai','left');
		$this->db->join('perawat_detil', 'perawat_detil.id_pegawai=pegawai.id_pegawai','left');
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=pegawai.id_jabatan_fungsional','left');
		$this->db->join('kol_kode_kewenangan', 'kol_kode_kewenangan.id_kode_kewenangan=perawat_detil.id_kode_kewenangan','left');
		if($d =='id_kode_kewenangan'){
			$this->db->group_by('perawat_detil.'.$d);
		}else{
			$this->db->group_by('pegawai.'.$d);
		}
		$q = $this->db->get('pegawai');
		return $q->result_array();
	}
	function lt_oppe($thn,$ruangan){
		$this->db->select("SUM(jml_logbook) as jml_logbook,logbook.id_pegawai,nama_pegawai,DATE_FORMAT(tgl_logbook,'%Y') as tgl_logbook");
		$this->db->join('pegawai', 'pegawai.id_pegawai=logbook.id_pegawai','left');
		$this->db->where('year(tgl_logbook)', $thn);
		$this->db->where('pegawai.id_ruangan', $ruangan);
		$this->db->group_by("logbook.id_pegawai");
		$this->db->order_by("nama_pegawai", "asc");
		$q = $this->db->get('logbook')->result_array();
	//	echo $this->db->last_query();die();
		return $q;
	}
	function cmd_ruangan($level){
		$this->db->select('nama_ruangan,id_ruangan');
		$this->db->join('struktur_jabatan', 'struktur_jabatan.id_struktur_jabatan=ruangan.id_struktur_jabatan','left');
	//	if($level !== '99'){
		$this->db->where_in('ruangan.id_struktur_jabatan', ['3','4','6','7']);
	//	}
		$q = $this->db->get_where('ruangan');
		return $q->result_array();
	}
	function tabel_grafik($id)
	{
	//	$ids = explode(',', $unit);
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,if (peg.jk = '1' ,'Laki-laki','Perempuan') as jk
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
					case 'id_pegawai' : $nmf="pegawai.id_pegawai";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where("peg.id_ruangan", $id);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('pegawai peg');
		$this->db->join('ruangan r', 'r.id_ruangan=peg.id_ruangan','left');
		$this->db->join('kol_agama ag', 'ag.id_agama=peg.id_agama','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=peg.id_status_kawin','left');
		$this->db->join('kol_status_pegawai ksp', 'ksp.id_status_pegawai=peg.tipe_pegawai','left');
		$this->db->join('perawat_detil pd', 'pd.id_pegawai=peg.id_pegawai','left');
		$this->db->join('kol_kode_kewenangan kw', 'kw.id_kode_kewenangan=pd.id_kode_kewenangan','left');
		$this->db->join('jabatan_fungsional prop', 'prop.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
		$this->db->where("peg.id_ruangan", $id);

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				case 'id_pegawai' : $nmf="pegawai.id_pegawai";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where("peg.id_ruangan", $id);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('pegawai peg');
		$this->db->join('ruangan r', 'r.id_ruangan=peg.id_ruangan','left');
		$this->db->join('kol_agama ag', 'ag.id_agama=peg.id_agama','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=peg.id_status_kawin','left');
		$this->db->join('kol_status_pegawai ksp', 'ksp.id_status_pegawai=peg.tipe_pegawai','left');
		$this->db->join('perawat_detil pd', 'pd.id_pegawai=peg.id_pegawai','left');
		$this->db->join('kol_kode_kewenangan kw', 'kw.id_kode_kewenangan=pd.id_kode_kewenangan','left');
		$this->db->join('jabatan_fungsional prop', 'prop.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
		$this->db->where("peg.id_ruangan", $id);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('pegawai');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function tabel_pendidikan($id)
	{
	//	$ids = explode(',', $unit);
	//--------- Ambil nama kolom --------- [coding here] .jpg
		$fields = "*,if (peg.jk = '1' ,'Laki-laki','Perempuan') as jk,
					if (b.tgl_a_berkas = '0000-00-00' ,'TIDAK ADA',DATE_FORMAT(b.tgl_a_berkas,'%d-%m-%Y')) as tgl_a_berkas,
					if (b.tgl_b_berkas = '0000-00-00' ,'TIDAK ADA',DATE_FORMAT(b.tgl_b_berkas,'%d-%m-%Y')) as tgl_b_berkas,
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
					case 'id_pegawai' : $nmf="peg.id_pegawai";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$array_check = array(7);
		$this->db->where_in('b.id_kategori_berkas', $array_check);
		$this->db->where("peg.id_ruangan", $id);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('pegawai peg');
		$this->db->join('ruangan r', 'r.id_ruangan=peg.id_ruangan','left');
		$this->db->join('berkas b', 'b.id_pegawai=peg.id_pegawai','left');
		$this->db->join('kol_pendidikan kp', 'kp.id_pendidikan=b.id_pendidikan','left');
		$array_check = array(7);
		$this->db->where_in('b.id_kategori_berkas', $array_check);
		$this->db->where("peg.id_ruangan", $id);

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				case 'id_pegawai' : $nmf="peg.id_pegawai";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$array_check = array(7);
		$this->db->where_in('b.id_kategori_berkas', $array_check);
		$this->db->where("peg.id_ruangan", $id);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('pegawai peg');
		$this->db->join('ruangan r', 'r.id_ruangan=peg.id_ruangan','left');
		$this->db->join('berkas b', 'b.id_pegawai=peg.id_pegawai','left');
		$this->db->join('kol_pendidikan kp', 'kp.id_pendidikan=b.id_pendidikan','left');
		$array_check = array(7);
		$this->db->where_in('b.id_kategori_berkas', $array_check);
		$this->db->where("peg.id_ruangan", $id);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi); */
		$jml = $this->m_umum->jumlah_record_tabel('pegawai');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
  function peta_count($id_ruangan,$d)	//Laporan Harian
	{
//    $jabatan = array(1,4,6,19,20);
		if($d =='jk'){
			$this->db->select("SUM(CASE WHEN $d = '1' THEN 1 END) as MALE_COUNT,SUM(CASE WHEN $d = '0' THEN 1 END) as FEMALE_COUNT");
		}
		if($d =='id_pendidikan'){
			$this->db->select("COUNT(pegawai.id_pendidikan) as total_pendidikan,pegawai.id_pendidikan");
		}
		if($d =='id_agama'){
			$this->db->select("COUNT(pegawai.id_agama) as total_agama,id_agama");
		}
		if($d =='id_status_kawin'){
			$this->db->select("COUNT(pegawai.id_status_kawin) as total_kawin,id_status_kawin");
		}
		if($d =='tipe_pegawai'){
			$this->db->select("COUNT(pegawai.tipe_pegawai) as total_pegawai,tipe_pegawai");
		}
		if($d =='id_kode_kewenangan'){
			$this->db->select("COUNT(perawat_detil.id_kode_kewenangan) as total_kode_kewenangan, id_kode_kewenangan");
		}
		if($d =='id_jabatan_fungsional'){
			$this->db->select("COUNT(pegawai.id_jabatan_fungsional) as total_jf,pegawai.id_jabatan_fungsional");
		}
    $this->db->join('user', 'user.id_pegawai=pegawai.id_pegawai','left');
		 $this->db->join('perawat_detil', 'perawat_detil.id_pegawai=pegawai.id_pegawai','left');
		 $this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=pegawai.id_jabatan_fungsional','left');
//     $this->db->where_in("id_jabatan", $jabatan);
      $this->db->where("id_level !=", '99');
      $this->db->where("id_level !=", '98');
     if($id_ruangan !== 'ALL'){
 		 $this->db->where("pegawai.id_ruangan", $id_ruangan);
     }
    if($d =='id_kode_kewenangan'){
			$this->db->group_by('perawat_detil.'.$d);
      $q = $this->db->get('pegawai');
    	return $q->result_array();
		}elseif($d == 'jk'){
      $q = $this->db->get('pegawai');
    	return $q->row_array();
		}
    else{
			$this->db->group_by('pegawai.'.$d);
      $q = $this->db->get('pegawai');
    	return $q->result_array();
		}

	}
  function ambil_berkas_pelatihan($ruangan){
    $array_check = array(4);
    $this->db->select("COUNT(b.id_kategori_pelatihan) as total_pelatihan,b.id_kategori_pelatihan");
		$this->db->join('pegawai peg', 'peg.id_pegawai=b.id_pegawai','left');
    $this->db->where_in('b.id_kategori_berkas', $array_check);
    $this->db->where("b.id_kategori_pelatihan >", '0');
    if($ruangan !== 'ALL'){
    $this->db->where("peg.id_ruangan", $ruangan);
    }
    $this->db->group_by('b.id_kategori_pelatihan');
		$q = $this->db->get_where('berkas b');
		return $q->result_array();
	}
  function ambil_all_abk_pola($id,$unit){
		$this->db->select("*,ijd.id_abk,ijd.id_abk_detil,ij.id_unit");
		$this->db->join('p_abk ij', 'ij.id_abk=ijd.id_abk','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=ijd.id_jabatan_fungsional','left');
		$q = $this->db->get_where('p_abk_detil ijd',array('year(periode)'=>$id,'id_unit'=>$unit));
		return $q->result_array();
	}
	function ambil_thn_pemenuhan($id,$periode){
		$q = $this->db->get_where('p_abk_pemenuhan',array('year(periode_pemenuhan)'=>$periode,'id_unit'=>$id));
		return $q->row_array();
	}
	function grafik_working_region($idr,$id)
	{
		$this->db->join('kol_provinsi kpr', 'kpr.id_prov=kol_working.id_prov','left');
		$this->db->join('kol_kabupaten kpk', 'kpk.id_kab=kol_working.id_kab','left');
		$this->db->join('kol_kelurahan kk', 'kk.id_kel=kol_working.id_kel','left');
		$this->db->join('kol_kecamatan kkec', 'kkec.id_kec=kol_working.id_kec','left');
		$this->db->where('kol_working.'.$idr, $id);
		$q = $this->db->get_where('kol_working');
		return $q->result_array();
	}
  	function ambil_tempat_bekerja_for_person(){
		$this->db->join('perawat_detil pd', 'pd.id_pegawai=peg.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
		$this->db->join('ruangan rg', 'rg.id_ruangan=peg.id_ruangan','left');
	//    $this->db->where($idr, $ruangan);
		$q = $this->db->get_where('pegawai peg');
			return $q->result_array();
	}
	function ambil_berkas_from_kab($id,$idk,$idp){
		$this->db->join('pegawai', 'pegawai.id_pegawai=berkas.id_pegawai','left');
		$this->db->join('kol_kategori_berkas', 'kol_kategori_berkas.id_kategori_berkas=berkas.id_kategori_berkas','left');
		$this->db->where("status_berkas", 1);
		$this->db->where("pegawai.id_kab", $id);
		$this->db->where("berkas.id_pegawai", $idp);
		$this->db->where("berkas.id_kategori_berkas", $idk);
		$q = $this->db->get_where('berkas');
		return $q->result_array();
	}
  	function ambil_berkas_pelatihan_person($idr,$ruangan){
	    $array_check = array(4,5,6,8,9,27,28);
		$this->db->join('kol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=b.id_kategori_pelatihan','left');
		$this->db->join('pegawai peg', 'peg.id_pegawai=b.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
	    $this->db->where_in('b.id_kategori_berkas', $array_check);
	    $this->db->where("b.id_kategori_pelatihan >", '0');
	    $this->db->where("b.status_berkas", 1);
	    $this->db->where($idr, $ruangan);
		$q = $this->db->get_where('berkas b');
			return $q->result_array();
	}
	function grafik_all_pengcab_pegawai_instansi($select,$kondisi)
	{
		$this->db->select($select);
		$this->db->join('perawat_detil pd', 'pd.id_pegawai=ope.id_pegawai','left');
		$this->db->join('kol_pendidikan kpen', 'kpen.id_pendidikan=ope.id_pendidikan','left');
		$this->db->join('kol_agama kag', 'kag.id_agama=ope.id_agama','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=ope.id_status_kawin','left');
		$this->db->join('kol_status_pegawai osp', 'osp.id_status_pegawai=ope.tipe_pegawai','left');
		$this->db->join('kol_kode_kewenangan kkk', 'kkk.id_kode_kewenangan=pd.id_kode_kewenangan','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=ope.id_jabatan_fungsional','left');		
	//	$this->db->where($idr, $id);
		$q = $this->db->get_where('pegawai ope',$kondisi);
		return $q->row_array();
	}
  	function ambil_berkas_pelatihan_instansi($grup){
	    $array_check = array(4,5,6,8,9,27,28);
	    $this->db->select("COUNT(peg.id_pegawai) as total_pelatihan,nama_kategori_pelatihan");
		$this->db->join('kol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=b.id_kategori_pelatihan','left');
		$this->db->join('pegawai peg', 'peg.id_pegawai=b.id_pegawai','left');	
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
	    $this->db->where_in('b.id_kategori_berkas', $array_check);
	    $this->db->where("b.id_kategori_pelatihan >", '0');
	    $this->db->where("b.status_berkas", 1);
	//    $this->db->where($idr, $ruangan);
	    $this->db->group_by($grup);
		$q = $this->db->get_where('berkas b');
			return $q->result_array();
	}
	function grafik_pengcab_pegawai_instansi($select,$kondisi,$grup = FALSE)
	{
		$this->db->select($select);
		$this->db->join('perawat_detil pd', 'pd.id_pegawai=ope.id_pegawai','left');
		$this->db->join('kol_pendidikan kpen', 'kpen.id_pendidikan=ope.id_pendidikan','left');
		$this->db->join('kol_agama kag', 'kag.id_agama=ope.id_agama','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=ope.id_status_kawin','left');
		$this->db->join('kol_status_pegawai osp', 'osp.id_status_pegawai=ope.tipe_pegawai','left');
		$this->db->join('kol_kode_kewenangan kkk', 'kkk.id_kode_kewenangan=pd.id_kode_kewenangan','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=ope.id_jabatan_fungsional','left');
		$this->db->join('kol_provinsi prov', 'prov.id_prov=ope.id_prov','left');
		$this->db->join('kol_kabupaten kab', 'kab.id_kab=ope.id_kab','left');
		$this->db->join('kol_kecamatan kec', 'kec.id_kec=ope.id_kec','left');
		$this->db->join('kol_kelurahan kel', 'kel.id_kel=ope.id_kel','left');		
		if($grup === FALSE)
		{ 
		$q = $this->db->get_where('pegawai ope',$kondisi);
		return $q->result_array();
		}else{
		$this->db->group_by($grup); 
		$q = $this->db->get_where('pegawai ope',$kondisi);
		return $q->result_array();		
		}
	}
	function ambil_berkas_expired_ijin_instansi($idk){
		$this->db->select("COUNT(pegawai.id_pegawai) as total_str");
		$this->db->join('pegawai', 'pegawai.id_pegawai=berkas.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=pegawai.id_jabatan_fungsional','left');
		$this->db->join('kol_kategori_berkas', 'kol_kategori_berkas.id_kategori_berkas=berkas.id_kategori_berkas','left');
		$this->db->where('tgl_b_berkas <=', date('Y-m-d'));		
		$this->db->where("status_berkas", 1);
	//	$this->db->where($idr, $id);
		$this->db->where("berkas.id_kategori_berkas", $idk);
	//	$this->db->group_by('ol_pegawai.id_pengcab');
		$q = $this->db->get_where('berkas');
		return $q->result_array();
	}
}
