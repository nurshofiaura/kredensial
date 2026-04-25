<?php
class M_ol_validasi extends MY_Model{
	//==================================================== ambil data pegawai
    private function pegawai_base()
    {
        $this->db
            ->select("
                ol_user.id_pegawai,ol_pegawai.barcode_pegawai,
                ol_pegawai.nama_pegawai,
                ol_pegawai.nip,
                ol_unit.nama_unit,
                IF(status_asesor=0,'Pegawai',kol_komite.nama_komite) AS nama_komite
            ")
            ->from('ol_user')
            ->join('ol_pegawai','ol_pegawai.id_pegawai=ol_user.id_pegawai','left')
            ->join('ol_pegawai_unit','ol_pegawai_unit.id_pegawai=ol_pegawai.id_pegawai','left')
            ->join('ol_unit','ol_unit.id_unit=ol_pegawai_unit.id_unit','left')
            ->join('kol_komite','kol_komite.id_komite=ol_user.status_asesor','left')
            ->where('ol_user.id_pegawai !=', $this->session->id_pegawai)
            ->group_start()
                ->where('(validator = 2 AND ol_pegawai_unit.id_unit = "'.$this->session->unit.'")', null, false)
                ->or_where('validator', $this->session->id_pegawai)
            ->group_end();
    }
    private $pegawai_columns = [
        null,
        'nama_pegawai',
        'nip',
        'nama_unit',
        'nama_komite'
    ];
    protected function pegawai_count()
    {
        return $this->db
            ->from('ol_user')
            ->join('ol_pegawai','ol_pegawai.id_pegawai=ol_user.id_pegawai','left')
            ->join('ol_pegawai_unit','ol_pegawai_unit.id_pegawai=ol_pegawai.id_pegawai','left')
            ->where('ol_user.id_pegawai !=', $this->session->id_pegawai)
            ->group_start()
                ->where('(validator = 2 AND ol_pegawai_unit.id_unit = "'.$this->session->unit.'")', null, false)
                ->or_where('validator', $this->session->id_pegawai)
            ->group_end()
            ->count_all_results();
    }
    public function datatable_pegawai($dt)
    {
       // ===== DATA =====
       $this->pegawai_base();
       $this->datatable_search($this->pegawai_columns, $dt['search'], $dt['cols']);
       $this->db->limit($dt['length'], $dt['start']);
       $data = $this->db->get()->result_array();

       // ===== FILTERED =====
       $this->pegawai_base();
       $this->datatable_search($this->pegawai_columns, $dt['search'], $dt['cols']);
       $filtered = $this->db->count_all_results();

       // ===== TOTAL (FAST) =====
       $total = $this->pegawai_count();

       return compact('data', 'total', 'filtered');



       $this->pegawai_base();
       $this->datatable_search($this->pegawai_columns, $dt['search'], $dt['cols']);
       $this->db->limit($dt['length'], $dt['start']);

       $data = $this->db->get()->result_array();

       // FILTERED
       $this->pegawai_base();
       $this->datatable_search($this->pegawai_columns, $dt['search'], $dt['cols']);
       $filtered = $this->db->count_all_results();

       // TOTAL
       $this->pegawai_base();
       $total = $this->db->count_all_results();

       return compact('data', 'total', 'filtered');
    }
    public function logbook_pegawai_base($barcode)
    {
        $this->db
            ->select("
              ol_pegawai.barcode_pegawai,
              nkr_kewenangan.nama_kewenangan,
              nkr_kompetensi.nama_kompetensi,
              kol_sifat_kewenangan.nama_sifat_kewenangan
            ")
            ->from('ol_logbook')
            ->join('ol_pegawai','ol_pegawai.id_pegawai=ol_logbook.id_logbooker','left')
            ->join('nkr_kewenangan','nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left')
            ->join('nkr_kompetensi','nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left')
            ->join('kol_sifat_kewenangan','kol_sifat_kewenangan.id_sifat_kewenangan=ol_logbook.id_sifat_kewenangan','left')
            ->join(
                'ol_validasi',
                'ol_validasi.id_kewenangan = ol_logbook.id_kewenangan 
                 AND ol_validasi.barcode_pegawai = ol_pegawai.barcode_pegawai',
                'left'
            )
            ->where('ol_pegawai.barcode_pegawai', $barcode)
            ->where('ol_validasi.id_kewenangan IS NULL', null, false);
    }
    protected $logbook_columns = [
        'nkr_kewenangan.nama_kewenangan',
        'nkr_kompetensi.nama_kompetensi',
        'kol_sifat_kewenangan.nama_sifat_kewenangan'
    ];
    protected function logbook_pegawai_count($barcode)
    {
        return $this->db
            ->from('ol_logbook')
            ->join('ol_pegawai','ol_pegawai.id_pegawai=ol_logbook.id_logbooker','left')
            ->join(
                'ol_validasi',
                'ol_validasi.id_kewenangan = ol_logbook.id_kewenangan 
                 AND ol_validasi.barcode_pegawai = ol_pegawai.barcode_pegawai',
                'left'
            )
            ->where('ol_pegawai.barcode_pegawai', $barcode)
            ->where('ol_validasi.id_kewenangan IS NULL', null, false)
            ->count_all_results();
    }
    public function datatable_logbook_pegawai($barcode, $dt)
    {
      // ===== DATA =====
      $this->logbook_pegawai_base($barcode);
      $this->datatable_search($this->logbook_columns, $dt['search'], $dt['cols']);
      $this->db->limit($dt['length'], $dt['start']);
      $data = $this->db->get()->result_array();

      // ===== FILTERED =====
      $this->logbook_pegawai_base($barcode);
      $this->datatable_search($this->logbook_columns, $dt['search'], $dt['cols']);
      $filtered = $this->db->count_all_results();

      // ===== TOTAL (FAST) =====
      $total = $this->logbook_pegawai_count($barcode);

      return compact('data', 'total', 'filtered');
    }
	function ambil_data_pegawai_dttb()
	{
		$this->db->select("
				*,if(status_asesor = 0,'Pegawai',nama_komite) as nama_komite
			");
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_user.id_pegawai','left');			
		$this->db->join('ol_pegawai_unit', 'ol_pegawai_unit.id_pegawai=ol_pegawai.id_pegawai','left');
		$this->db->join('ol_unit', 'ol_unit.id_unit=ol_pegawai_unit.id_unit','left');
		$this->db->join('kol_komite', 'kol_komite.id_komite=ol_user.status_asesor','left');
		$this->db->where("ol_user.id_pegawai !=",  $this->session->id_pegawai);
		$this->db->group_start();
			$this->db->where('(validator = 2 AND ol_pegawai_unit.id_unit = "'. $this->session->unit . '" )', NULL, FALSE);
			$this->db->or_where("validator",  $this->session->id_pegawai);
		$this->db->group_end();		
		$q = $this->db->get_where('ol_user');
		return $q->result_array();
	}
	function ambil_data_pegawai_asli()
	{
		$columns = [
		    0 => null,
		    1 => 'nama_pegawai',
		    2 => 'nip',
		    3 => 'nama_unit',
		    4 => 'nama_komite'
		];
		$fields = "*,
			if(status_asesor = 0,'Pegawai',nama_komite) as nama_komite
		";
	    $draw   = intval($this->input->post('draw'));
	    $start  = intval($this->input->post('start'));
	    $length = intval($this->input->post('length'));
	    $order  = $this->input->post('order');
	    $search = $this->input->post('search');
	    $dtCols = $this->input->post('columns');
	    $dtCols = is_array($dtCols) ? $dtCols : [];
	    $orderCol = $columns[$order[0]['column']] ?? $columns[0];
	    $orderDir = $order[0]['dir'] ?? 'asc';

		$this->db->select($fields);
		$this->db->from('ol_user');
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_user.id_pegawai','left');			
		$this->db->join('ol_pegawai_unit', 'ol_pegawai_unit.id_pegawai=ol_pegawai.id_pegawai','left');
		$this->db->join('ol_unit', 'ol_unit.id_unit=ol_pegawai_unit.id_unit','left');
		$this->db->join('kol_komite', 'kol_komite.id_komite=ol_user.status_asesor','left');
		$this->db->where("ol_user.id_pegawai !=",  $this->session->id_pegawai);
		$this->db->group_start();
		$this->db->where('(validator = 2 AND ol_pegawai_unit.id_unit = "'. $this->session->unit . '" )', NULL, FALSE);
		$this->db->or_where("validator",  $this->session->id_pegawai);
		$this->db->group_end();	

	    // ===== GLOBAL SEARCH =====
	    if (!empty($search['value'])) {
	        $this->db->group_start();
	        foreach ($columns as $col) {
	            $this->db->or_like($col, $search['value']);
				$this->db->group_start();
				$this->db->where('(validator = 2 AND ol_pegawai_unit.id_unit = "'. $this->session->unit . '" )', NULL, FALSE);
				$this->db->or_where("validator",  $this->session->id_pegawai);
				$this->db->group_end();
	        }
	        $this->db->group_end();
	    }
	    foreach ($dtCols as $i => $col) {
	        if (
	            isset($col['search']['value']) &&
	            $col['search']['value'] !== '' &&
	            isset($columns[$i])
	        ) {
	            $this->db->like($columns[$i], $col['search']['value']);
	        }
	    }
	    $this->db->order_by($orderCol, $orderDir);
	    $this->db->limit($length, $start);
	    // echo $this->db->last_query();
	    $data = $this->db->get()->result_array();

		$this->db->from('ol_user');
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_user.id_pegawai','left');			
		$this->db->join('ol_pegawai_unit', 'ol_pegawai_unit.id_pegawai=ol_pegawai.id_pegawai','left');
		$this->db->join('ol_unit', 'ol_unit.id_unit=ol_pegawai_unit.id_unit','left');
		$this->db->join('kol_komite', 'kol_komite.id_komite=ol_user.status_asesor','left');
		$this->db->where("ol_user.id_pegawai !=",  $this->session->id_pegawai);
		$this->db->group_start();
		$this->db->where('(validator = 2 AND ol_pegawai_unit.id_unit = "'. $this->session->unit . '" )', NULL, FALSE);
		$this->db->or_where("validator",  $this->session->id_pegawai);
		$this->db->group_end();	

	    if (!empty($search['value'])) {
	        $this->db->group_start();
	        foreach ($columns as $col) {
	            $this->db->or_like($col, $search['value']);
				$this->db->group_start();
				$this->db->where('(validator = 2 AND ol_pegawai_unit.id_unit = "'. $this->session->unit . '" )', NULL, FALSE);
				$this->db->or_where("validator",  $this->session->id_pegawai);
				$this->db->group_end();
	        }
	        $this->db->group_end();
	    }
	    foreach ($dtCols as $i => $col) {
	        if (
	            isset($col['search']['value']) &&
	            $col['search']['value'] !== '' &&
	            isset($columns[$i])
	        ) {
	            $this->db->like($columns[$i], $col['search']['value']);
	        }
	    }
	    $recordsFiltered = $this->db->count_all_results();
	    $recordsTotal = $this->db->count_all('ol_pegawai');
  		$output = array(
	        'draw'            => $draw,
	        'recordsTotal'    => $recordsTotal,
	        'recordsFiltered' => $recordsFiltered,
	        'data'            => $data
  		);
  		// print_r($output);die();
  		return $output;
	}
    function cek_pegawai($id)    //igd.php untuk menampilkan jumlah antrian di igd saja
    {
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_user.id_pegawai','left');			
		$this->db->join('ol_pegawai_unit', 'ol_pegawai_unit.id_pegawai=ol_pegawai.id_pegawai','left');
		$this->db->join('ol_unit', 'ol_unit.id_unit=ol_pegawai_unit.id_unit','left');
		$this->db->join('kol_komite', 'kol_komite.id_komite=ol_user.status_asesor','left');
		$this->db->where("ol_pegawai.barcode_pegawai",  $id);
/*		$this->db->group_start();
			$this->db->where('(validator = 2 AND ol_pegawai_unit.id_unit = "'. $this->session->unit . '" )', NULL, FALSE);
			$this->db->or_where("validator",  $this->session->id_pegawai);
		$this->db->group_end();*/
        $query = $this->db->select("COUNT(*) as num")->get_where('ol_user');
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
    }
    function cek_logbook($id)    //igd.php untuk menampilkan jumlah antrian di igd saja
    {
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_logbook.id_logbooker','left');   
      $this->db->where("ol_pegawai.barcode_pegawai",  $id);
      $query = $this->db->select("COUNT(*) as num")->get_where('ol_logbook');
      $result = $query->row();
      if(isset($result))
          return $result->num;
      return 0;
    }
 function logbook_all($id)
 {
  $fields = "*,ol_pegawai.barcode_pegawai,ol_logbook.id_sifat_kewenangan,ol_logbook.id_kewenangan
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
    switch($k['data']){  //beberapa field ambigius, so sesuaikan [coding here]
    //  case 'no_hp' : $nmf="peg.no_hp";break;
     // case 'id_level'   : $nmf="u.id_level";break;
    default: $nmf=$k['data'];
    }
    $this->db->or_like($nmf, $cari['value'],'both',false);

    $this->db->where("ol_pegawai.barcode_pegawai", $id);
    $this->db->where('ol_logbook.id_kewenangan NOT IN (select id_kewenangan from ol_validasi where barcode_pegawai = "'. $id . '")',NULL,FALSE);

   }
    }
  }
  $this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

    $this->db->from('ol_logbook');
    $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_logbook.id_logbooker','left');
    $this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
    $this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
    $this->db->join('kol_sifat_kewenangan', 'kol_sifat_kewenangan.id_sifat_kewenangan=ol_logbook.id_sifat_kewenangan','left');
    $this->db->where("ol_pegawai.barcode_pegawai", $id);
    $this->db->where('ol_logbook.id_kewenangan NOT IN (select id_kewenangan from ol_validasi where barcode_pegawai = "'. $id . '")',NULL,FALSE);

  $q = $this->db->limit($length,$start)->get_where(); //05 Execute
    // echo $this->db->last_query();
  $list=$q->result_array(); //06 Hasil

 //--------- Query jumlah filter untuk paging -----
  $this->db->select("COUNT(*) as num"); //01 Select

  if(!empty($cari['value'])) {    //02 Where
    foreach($dt_kolom as $k){
   if($k['searchable']=='true'){ //cek kalo searchable
    switch($k['data']){  //beberapa field ambigius, so sesuaikan  [coding here]
    // case 'no_hp' : $nmf="peg.no_hp";break;
     default: $nmf=$k['data'];
    }
    $this->db->or_like($nmf, $cari['value'],'both',false);

    $this->db->where("ol_pegawai.barcode_pegawai", $id);
    $this->db->where('ol_logbook.id_kewenangan NOT IN (select id_kewenangan from ol_validasi where barcode_pegawai = "'. $id . '")',NULL,FALSE);

   }
    }
  }

    $this->db->from('ol_logbook');
    $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_logbook.id_logbooker','left');
    $this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
    $this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
    $this->db->join('kol_sifat_kewenangan', 'kol_sifat_kewenangan.id_sifat_kewenangan=ol_logbook.id_sifat_kewenangan','left');
    $this->db->where("ol_pegawai.barcode_pegawai", $id);
    $this->db->where('ol_logbook.id_kewenangan NOT IN (select id_kewenangan from ol_validasi where barcode_pegawai = "'. $id . '")',NULL,FALSE);

  $q = $this->db->get_where(); //04 Execute
  $jml_filter = $q->row()->num; //05 Hasil

  $jml = $this->cek_logbook($id);
//  $jml = $this->m_umum->jumlah_record_tabel('ol_logbook');

  $output = array(
   "draw" => $draw,
    "recordsTotal" => $jml,
    "recordsFiltered" => $jml_filter,
    "data" => $list
  );
  // print_r($output);die();
  return $output;
 }
	function logxbook_all($id)
	{
		$fields = "*,sum(jml_logbook) as jml_logbook,ol_pegawai.barcode_pegawai,ol_logbook.id_sifat_kewenangan,ol_logbook.id_kewenangan
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
    $this->db->where("ol_pegawai.barcode_pegawai", $id);
	//$this->db->group_start();
//    $this->db->where('ol_logbook.id_kewenangan NOT IN (select id_kewenangan from ol_rkk where id_sifat_kewenangan = 1 and barcode_pegawai = "'. $id . '")',NULL,FALSE);
    $this->db->where('ol_logbook.id_kewenangan NOT IN (select id_kewenangan from ol_validasi where barcode_pegawai = "'. $id . '")',NULL,FALSE);
//	$this->db->group_end();
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

    $this->db->from('ol_logbook');
    $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_logbook.id_logbooker','left');
    $this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
    $this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
    $this->db->join('kol_sifat_kewenangan', 'kol_sifat_kewenangan.id_sifat_kewenangan=ol_logbook.id_sifat_kewenangan','left');
//    $this->db->join('ol_validasi', 'ol_validasi.id_kewenangan=ol_logbook.id_kewenangan','left');
    $this->db->where("ol_pegawai.barcode_pegawai", $id);
//	$this->db->group_start();
//    $this->db->where('ol_logbook.id_kewenangan NOT IN (select id_kewenangan from ol_rkk where id_sifat_kewenangan = 1 and barcode_pegawai = "'. $id . '")',NULL,FALSE);
    $this->db->where('ol_logbook.id_kewenangan NOT IN (select id_kewenangan from ol_validasi where barcode_pegawai = "'. $id . '")',NULL,FALSE);
//	$this->db->group_end();
 //   $this->db->group_by(array("ol_logbook.id_kewenangan", "ol_logbook.id_sifat_kewenangan"));

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute
     //echo $this->db->last_query();
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
    $this->db->where("ol_pegawai.barcode_pegawai", $id);
//	$this->db->group_start();
//    $this->db->where('ol_logbook.id_kewenangan NOT IN (select id_kewenangan from ol_rkk where id_sifat_kewenangan = 1 and barcode_pegawai = "'. $id . '")',NULL,FALSE);
    $this->db->where('ol_logbook.id_kewenangan NOT IN (select id_kewenangan from ol_validasi where barcode_pegawai = "'. $id . '")',NULL,FALSE);
//	$this->db->group_end();
			}
		  }
		}

    $this->db->from('ol_logbook');
    $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_logbook.id_logbooker','left');
    $this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
    $this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
    $this->db->join('kol_sifat_kewenangan', 'kol_sifat_kewenangan.id_sifat_kewenangan=ol_logbook.id_sifat_kewenangan','left');
//    $this->db->join('ol_validasi', 'ol_validasi.id_kewenangan=ol_logbook.id_kewenangan','left');
    $this->db->where("ol_pegawai.barcode_pegawai", $id);
	//$this->db->group_start();
//    $this->db->where('ol_logbook.id_kewenangan NOT IN (select id_kewenangan from ol_rkk where id_sifat_kewenangan = 1 and barcode_pegawai = "'. $id . '")',NULL,FALSE);
    $this->db->where('ol_logbook.id_kewenangan NOT IN (select id_kewenangan from ol_validasi where barcode_pegawai = "'. $id . '")',NULL,FALSE);
//	$this->db->group_end();
 //   $this->db->group_by(array("ol_logbook.id_kewenangan", "ol_logbook.id_sifat_kewenangan"));

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/* 		$kondisi=array('id_logbooker'=>$apk['id_pegawai'],'id_kompetensi'=>$apk['kode_unit_pengajuan']);
		$jml = $this->m_umum->jumlah_record_tabel_pengajuan_select('ol_logbook.id_kewenangan','ol_logbook',$kondisi,'nkr_kewenangan','id_kewenangan','ol_logbook.id_kewenangan');*/
   // $jml = $this->m_umum->jumlah_record_filter('ol_logbook',$kondisi,'id_kewenangan');
	//	$jml = $this->m_umum->jumlah_record_tabel('ol_logbook');
  $jml = $this->cek_logbook($id);

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_ol_validasi($id,$bp,$sk){
		$kode = $this->m_rancak->kode_generator_urut(15,'RV');
		$data_pendaftaran = array(
		  'id_validasi' => $kode,
		  'validator_validasi' => $this->session->barcode_pegawai,
		  'barcode_pegawai' => $bp,
		  'id_kewenangan' => $id,
		  'id_sifat_kewenangan' => $sk
		);
		return $this->db->insert('ol_validasi', $data_pendaftaran);
	}
	function rubah_ol_validasi($id,$bp,$sk){
		$id_kewenangan = $id;
		$barcode_pegawai = $this->input->post('barcode_pegawai');
		$data_pendaftaran = array(
		  'id_sifat_kewenangan' => $sk
		);
		$this->db->where('id_kewenangan',$id);
		$this->db->where('barcode_pegawai',$bp);
		$this->db->update('ol_validasi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();  // untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
		  return(FALSE);
		else
		  return(TRUE);
	}
	function slogbook_all($id)
	{
/*		$query = $this->db->query('SELECT id_kewenangan FROM ol_rkk');
		$array=array();
		foreach ($query->result_array() as $row)
		{
		array_push($array,$row['id_kewenangan']);
		}*/

		$fields = "*,sum(jml_logbook) as jml_logbook,
		if(status_validasi = 1,'Kompeten Penuh',if(status_validasi = 2,'Dengan Mentorship',(if(status_validasi = 3,'Tidak Kompeten / Ditolak','Proses / Belum Validasi')))) as status_validasi
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
		$this->db->where('ol_pegawai.barcode_pegawai', $id);
	//	$this->db->where_not_in('id_kewenangan', $array);
		$this->db->group_start();
			$this->db->where('(validator = 2 AND ol_pegawai_unit.id_unit = "'. $this->session->unit . '" )', NULL, FALSE);
			$this->db->or_where("validator",  $this->session->id_pegawai);
		$this->db->group_end();				
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_logbook');
		$this->db->join('ol_validasi', 'ol_validasi.id_kewenangan=ol_logbook.id_kewenangan','left');
		$this->db->join('kol_sifat_kewenangan', 'kol_sifat_kewenangan.id_sifat_kewenangan=ol_logbook.id_sifat_kewenangan','left');
		$this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
		$this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_logbook.id_logbooker','left');
		$this->db->join('ol_pegawai_unit', 'ol_pegawai_unit.id_pegawai=ol_pegawai.id_pegawai','left');
		$this->db->where('ol_pegawai.barcode_pegawai', $id);
	//	$this->db->where_not_in('id_kewenangan', array_column($tablenotin, 'id_kewenangan'));
	//	$this->db->where_not_in('id_kewenangan', $array);
/*		$this->db->group_start();
			$this->db->where('(validator = 2 AND ol_pegawai_unit.id_unit = "'. $this->session->unit . '" )', NULL, FALSE);
			$this->db->or_where("validator",  $this->session->id_pegawai);
		$this->db->group_end();*/
	//	$this->db->group_by("ol_logbook.id_kewenangan");

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
		$this->db->where('ol_pegawai.barcode_pegawai', $id);
	//	$this->db->where_not_in('id_kewenangan', $array);
		$this->db->group_start();
			$this->db->where('(validator = 2 AND ol_pegawai_unit.id_unit = "'. $this->session->unit . '" )', NULL, FALSE);
			$this->db->or_where("validator",  $this->session->id_pegawai);
		$this->db->group_end();
			}
		  }
		}

		$this->db->from('ol_logbook');
		$this->db->join('ol_validasi', 'ol_validasi.id_kewenangan=ol_logbook.id_kewenangan','left');
		$this->db->join('kol_sifat_kewenangan', 'kol_sifat_kewenangan.id_sifat_kewenangan=ol_logbook.id_sifat_kewenangan','left');
		$this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
		$this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_logbook.id_logbooker','left');
		$this->db->join('ol_pegawai_unit', 'ol_pegawai_unit.id_pegawai=ol_pegawai.id_pegawai','left');
		$this->db->where('ol_pegawai.barcode_pegawai', $id);
	//	$this->db->where_not_in('id_kewenangan', $array);
		$this->db->group_start();
			$this->db->where('(validator = 2 AND ol_pegawai_unit.id_unit = "'. $this->session->unit . '" )', NULL, FALSE);
			$this->db->or_where("validator",  $this->session->id_pegawai);
		$this->db->group_end();
	//	$this->db->group_by("ol_logbook.id_kewenangan");

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/*		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){*/
				$peg = $this->m_umum->ambil_data('ol_pegawai','barcode_pegawai',$id);
		 		$kondisi=array('id_logbooker'=>$peg['id_pegawai']);
				$jml = $this->m_umum->jumlah_record_filter('ol_logbook',$kondisi);
/*			}else{
				$jml = $this->m_umum->jumlah_record_tabel('ol_surat');
			}
		}else{
			$jml = $this->m_umum->jumlah_record_tabel('ol_surat');
		}*/		
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
public function get_pegawai_datatable()
{
    $pegawai = $this->db
        ->select('id_pegawai, nama_pegawai')
        ->from('pegawai')
        ->get()
        ->result_array();
        
  $this->db->select('nama_komite,id_komite');
  $q = $this->db->get_where('kol_komite',array('status_komite'=>1));
  return $q->result_array();

    foreach ($pegawai as &$p) {

        $details = $this->db
            ->select('tgl, kegiatan, status')
            ->from('pegawai_kegiatan')
            ->where('id_pegawai', $p['id_pegawai'])
            ->get()
            ->result_array();

        $p['details'] = $details; // ⬅️ INI PENTING
    }

    return $pegawai;
}
}