<?php
class M_report extends CI_model{
  function equipment_all($jns)
  {
    $idx = explode(',', $this->session->mas_unit);
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
      $this->db->where('se.jenis_equipment',$jns);
      $this->db->where_in('ou.coun_unit',$idx); 
      }
      }
    }
    $this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

      
      $this->db->from('ol_equipment se');
      $this->db->join('ol_unit ou', 'ou.id_unit=se.id_unit','left');
      $this->db->where('se.jenis_equipment',$jns);
      $this->db->where_in('ou.coun_unit',$idx); 

    $q = $this->db->limit($length,$start)->get_where(); //05 Execute
  //  $this->db->last_query;
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
      $this->db->where('se.jenis_equipment',$jns);
      $this->db->where_in('ou.coun_unit',$idx);   
      }
      }
    }

  //  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
      $this->db->from('ol_equipment se');  
      $this->db->join('ol_unit ou', 'ou.id_unit=se.id_unit','left');
      $this->db->where('se.jenis_equipment',$jns);
      $this->db->where_in('ou.coun_unit',$idx);      

    $q = $this->db->get_where(); //04 Execute
    $jml_filter = $q->row()->num; //05 Hasil

  //--------- Query jumlah All data paling banyak -----
    $kondisi=array('id_unit'=>$this->session->unit,'jenis_equipment'=>$jns);
    $jml = $this->m_umum->jumlah_record_filter('ol_equipment',$kondisi);
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
  function simpan_equipment($js){
    $kode = $this->m_rancak->kode_generator_urut(15,'EQ');
    $data_pendaftaran = array(
      'id_equipment' => $kode,
      'id_unit' =>$this->input->post('id_unit'),
      'jenis_equipment' => $js,
      'pembuat_equipment' => $this->session->barcode_pegawai,
      'nama_equipment' => $this->input->post('nama_equipment'),
      'status_equipment' => $this->input->post('status_equipment')
    );
    return $this->db->insert('ol_equipment', $data_pendaftaran);
  }
  function edit_equipment(){
    $id_equipment = $this->input->post('id_equipment'); 
    $data_pendaftaran = array(
      'id_unit' =>$this->input->post('id_unit'),
      'nama_equipment' => $this->input->post('nama_equipment'),
      'status_equipment' => $this->input->post('status_equipment')
    );
    $this->db->where('id_equipment',$id_equipment);
    $this->db->update('ol_equipment', $data_pendaftaran);
    //echo $this->db->last_query();
    $this->db->trans_complete();  // untuk cek sukses update tidak
    if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
    // if (!$this->db->affected_rows()) 
      return(FALSE);
    else 
      return(TRUE);         
  }
  function mutu_all($jns)
  {
    $idx = explode(',', $this->session->mas_unit);
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
      $this->db->where('se.jenis_equipment',$jns);
      $this->db->where_in('ou.coun_unit',$idx);
      }
      }
    }
    $this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

      $this->db->from('ol_eq_detil oed');
      $this->db->join('ol_equipment se', 'se.id_equipment=oed.id_equipment','left');
      $this->db->join('ol_unit ou', 'ou.id_unit=se.id_unit','left');
      $this->db->where('se.jenis_equipment',$jns);
      $this->db->where_in('ou.coun_unit',$idx);

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
      $this->db->where('se.jenis_equipment',$jns);
      $this->db->where_in('ou.coun_unit',$idx);  
      }
      }
    }

      $this->db->from('ol_eq_detil oed');
      $this->db->join('ol_equipment se', 'se.id_equipment=oed.id_equipment','left');
      $this->db->join('ol_unit ou', 'ou.id_unit=se.id_unit','left');
      $this->db->where('se.jenis_equipment',$jns);
      $this->db->where_in('ou.coun_unit',$idx);

    $q = $this->db->get_where(); //04 Execute
    $jml_filter = $q->row()->num; //05 Hasil

  //--------- Query jumlah All data paling banyak -----
/*    $kondisi=array('id_unit='=>$this->session->unit);
    $jml = $this->m_umum->jumlah_record_filter('ol_eq_detil',$kondisi); */
    $kondisi=array('id_unit='=>$this->session->unit,'jenis_equipment'=>$jns);
    $jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_eq_detil',$kondisi,'ol_equipment','id_equipment'); 
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
  function simpan_equipment_detil(){
    $kode = $this->m_rancak->kode_generator_urut(15,'QD');
    $data_pendaftaran = array(
      'id_eq_detil' => $kode,
      'id_equipment' => $this->input->post('id_equipment'),
      'pembuat_eq_detil' => $this->session->barcode_pegawai,
      'nama_eq_detil' => $this->input->post('nama_eq_detil'),
      'status_eq_detil' => $this->input->post('status_eq_detil')
    );
    return $this->db->insert('ol_eq_detil', $data_pendaftaran);
  }
  function edit_equipment_detil(){
    $id_eq_detil = $this->input->post('id_eq_detil'); 
    $data_pendaftaran = array(
      'id_equipment' => $this->input->post('id_equipment'),
      'nama_eq_detil' => $this->input->post('nama_eq_detil'),
      'status_eq_detil' => $this->input->post('status_eq_detil')
    );
    $this->db->where('id_eq_detil',$id_eq_detil);
    $this->db->update('ol_eq_detil', $data_pendaftaran);
    //echo $this->db->last_query();
    $this->db->trans_complete();  // untuk cek sukses update tidak
    if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
    // if (!$this->db->affected_rows()) 
      return(FALSE);
    else 
      return(TRUE);         
  }
  function i_mutu_all($first_date,$last_date,$opsi,$tgl,$jns)
  {
    $idx = explode(',', $this->session->mas_unit);
    $fields = "*,
    DATE_FORMAT(tgl_eq_imut,'%d-%m-%Y') as tgl_eq_imut,if(yn_eq_imut=1,if(hasil_eq_imut=1,'YA','TIDAK'),hasil_eq_imut) as hasil_eq_imut,
    concat(nama_eq_detil,' - <b> Poin : [',nama_equipment,']</b>') as nama_equipment,tgl_eq_imut as tgl_sort
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
        $this->db->where('tgl_eq_imut BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
      }
      $this->db->where('oe.jenis_equipment',$jns);
      $this->db->where_in('ou.coun_unit',$idx);
      if($opsi){
        $this->db->where('oed.id_equipment',$opsi);
      }
      }
      }
    }
    $this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

      $this->db->from('ol_eq_imut oei');  
      $this->db->join('ol_eq_detil oed', 'oed.id_eq_detil=oei.id_eq_detil','left');
      $this->db->join('ol_equipment oe', 'oe.id_equipment=oed.id_equipment','left');
      $this->db->join('ol_unit ou', 'ou.id_unit=oe.id_unit','left');
      $this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=oei.barcode_pegawai','left');
      $this->db->join('ol_user us', 'us.id_pegawai=peg.id_pegawai','left'); 
      if($tgl == 0){
        $this->db->where('tgl_eq_imut BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
      }
      $this->db->where('oe.jenis_equipment',$jns);
      $this->db->where_in('ou.coun_unit',$idx);
      if($opsi){
        $this->db->where('oed.id_equipment',$opsi);
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
        $this->db->where('tgl_eq_imut BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
      }
      $this->db->where('oe.jenis_equipment',$jns);
      $this->db->where_in('ou.coun_unit',$idx);
      if($opsi){
        $this->db->where('oed.id_equipment',$opsi);
      }
      }
      }
    }

      $this->db->from('ol_eq_imut oei');  
      $this->db->join('ol_eq_detil oed', 'oed.id_eq_detil=oei.id_eq_detil','left');
      $this->db->join('ol_equipment oe', 'oe.id_equipment=oed.id_equipment','left');
      $this->db->join('ol_unit ou', 'ou.id_unit=oe.id_unit','left');
      $this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=oei.barcode_pegawai','left');
      $this->db->join('ol_user us', 'us.id_pegawai=peg.id_pegawai','left'); 
      if($tgl == 0){
        $this->db->where('tgl_eq_imut BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
      }
      $this->db->where('oe.jenis_equipment',$jns);
      $this->db->where_in('ou.coun_unit',$idx);
      if($opsi){
        $this->db->where('oed.id_equipment',$opsi);
      }

    $q = $this->db->get_where(); //04 Execute
    $jml_filter = $q->row()->num; //05 Hasil

  //--------- Query jumlah All data paling banyak -----
/*    $kondisi=array('id_unit='=>$this->session->unit);
    $jml = $this->m_umum->jumlah_record_filter('ol_eq_imut',$kondisi); */
/*    $kondisi=array('id_unit='=>$this->session->unit,'jenis_equipment'=>1);
    $jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_eq_imut',$kondisi,'ol_equipment','id_equipment'); */
    $jml = $this->m_umum->jumlah_record_tabel('ol_eq_imut');

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
    $tgl_eq_imut = $this->input->post('tgl_eq_imut');
    $tgl_eq_imut = date('Y-m-d', strtotime($tgl_eq_imut));
    $hasil_eq_imut = $this->input->post('hasil_eq_imut');
    $hasil_eq_imut = str_replace(',', '.', $hasil_eq_imut);
    $data_pendaftaran = array(
      'barcode_pegawai' => $this->session->barcode_pegawai,
      'id_eq_imut' => $kode,
      'tgl_eq_imut' => $tgl_eq_imut,
      'id_eq_detil'  => $this->input->post('id_eq_detil'),
      'yn_eq_imut'  => $this->input->post('yn_eq_imut'),
      'ket_eq_imut'  => $this->input->post('ket_eq_imut'),
      'status_eq_imut'  => $this->input->post('status_eq_imut'),
      'hasil_eq_imut'  => $hasil_eq_imut
    );
    return $this->db->insert('ol_eq_imut', $data_pendaftaran);
    // $this->db->insert_id();
  }
  function rubah_indikator_mutu(){
    $id_eq_imut = $this->input->post('id_eq_imut');
    $tgl_eq_imut = $this->input->post('tgl_eq_imut');
    $tgl_eq_imut = date('Y-m-d', strtotime($tgl_eq_imut));
    $hasil_eq_imut = $this->input->post('hasil_eq_imut');
    $hasil_eq_imut = str_replace(',', '.', $hasil_eq_imut);
    $data_pendaftaran = array(
      'tgl_eq_imut' => $tgl_eq_imut,
      'id_eq_detil'  => $this->input->post('id_eq_detil'),
      'yn_eq_imut'  => $this->input->post('yn_eq_imut'),
      'ket_eq_imut'  => $this->input->post('ket_eq_imut'),
      'status_eq_imut'  => $this->input->post('status_eq_imut'),
      'hasil_eq_imut'  => $hasil_eq_imut
    );
    $this->db->where('id_eq_imut',$id_eq_imut);
    $this->db->update('ol_eq_imut', $data_pendaftaran);
    //echo $this->db->last_query();
    $this->db->trans_complete();  // untuk cek sukses update tidak
    if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
    // if (!$this->db->affected_rows())
      return(FALSE);
    else
      return(TRUE);
  }
  function persen_all()
  {
    $idx = explode(',', $this->session->mas_ins);
  //  $ids = explode(',', $unit);
  //--------- Ambil nama kolom --------- [coding here] .jpg
    $fields = "*,oed1.nama_eq_detil as x,oed2.nama_eq_detil as y";
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
      $this->db->where('oe.id_unit',$this->session->unit); 
      }
      }
    }
    $this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

      $this->db->from('ol_eq_denum qd');
      $this->db->join('ol_equipment oe', 'oe.id_equipment=qd.id_equipment','left');
      $this->db->join('ol_eq_detil oed1', 'oed1.id_eq_detil=qd.num_eq_denum','left');
      $this->db->join('ol_eq_detil oed2', 'oed2.id_eq_detil=qd.denum_eq_denum','left');
      $this->db->join('ol_unit ou', 'ou.id_unit=oe.id_unit','left');
      $this->db->where('oe.id_unit',$this->session->unit); 

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
      $this->db->where('oe.id_unit',$this->session->unit); 
      }
      }
    }

      $this->db->from('ol_eq_denum qd');
      $this->db->join('ol_equipment oe', 'oe.id_equipment=qd.id_equipment','left');
      $this->db->join('ol_eq_detil oed1', 'oed1.id_eq_detil=qd.num_eq_denum','left');
      $this->db->join('ol_eq_detil oed2', 'oed2.id_eq_detil=qd.denum_eq_denum','left');
      $this->db->join('ol_unit ou', 'ou.id_unit=oe.id_unit','left');
      $this->db->where('oe.id_unit',$this->session->unit);     

    $q = $this->db->get_where(); //04 Execute
    $jml_filter = $q->row()->num; //05 Hasil

  //--------- Query jumlah All data paling banyak -----
    $kondisi=array('id_unit'=>$this->session->unit);
    $jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_eq_denum',$kondisi,'ol_equipment','id_equipment');
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
  function ambil_data_eq_detil($id)
  {
    $query = $this->db->get_where('ol_eq_detil',array('id_equipment' => $id));
    return $query->result_array();
  }
  function ambil_data_eq_detil_edit($id){
    $this->db->select("id_eq_detil,nama_eq_detil");
    $q= $this->db->get_where('ol_eq_detil',array('id_eq_detil'=>$id))->result_array();
    $hasil= array_column($q,'nama_eq_detil','id_eq_detil');
    return $hasil;
  }
  function simpan_ol_eq_denum(){
    $kode = $this->m_rancak->kode_generator_urut(15,'ED');
    $data_pendaftaran = array(
      'id_eq_denum' => $kode,
      'id_equipment' => $this->input->post('id_equipment'),
      'target_eq_denum' => $this->input->post('target_eq_denum'),
      'num_eq_denum' => $this->input->post('num_eq_denum'),
      'denum_eq_denum' => $this->input->post('denum_eq_denum'),
      'status_eq_denum' => $this->input->post('status_eq_denum')
    );
    return $this->db->insert('ol_eq_denum', $data_pendaftaran);
  }
  function edit_ol_eq_denum(){
    $id_eq_denum = $this->input->post('id_eq_denum'); 
    $data_pendaftaran = array(
      'id_equipment' => $this->input->post('id_equipment'),
      'target_eq_denum' => $this->input->post('target_eq_denum'),
      'num_eq_denum' => $this->input->post('num_eq_denum'),
      'denum_eq_denum' => $this->input->post('denum_eq_denum'),
      'status_eq_denum' => $this->input->post('status_eq_denum')
    );
    $this->db->where('id_eq_denum',$id_eq_denum);
    $this->db->update('ol_eq_denum', $data_pendaftaran);
    //echo $this->db->last_query();
    $this->db->trans_complete();  // untuk cek sukses update tidak
    if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
    // if (!$this->db->affected_rows()) 
      return(FALSE);
    else 
      return(TRUE);         
  }
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
      if($tgl == 0){
        $this->db->where('tgl_laporan BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
      }
      if($opsi){
        $this->db->where('lapd.id_equipment',$opsi);
      }
      }
      }
    }
    $this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

      $this->db->from('ol_laporan_detil lapd');  
      $this->db->join('ol_laporan lap', 'lap.id_laporan=lapd.id_laporan','left');
      $this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=lap.pembuat_laporan','left');
      $this->db->join('ol_unit ou', 'ou.id_unit=lap.laporan_unit','left'); 
      $this->db->where('lap.laporan_unit',$this->session->unit);
      if($tgl == 0){
        $this->db->where('tgl_laporan BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
      }
      if($opsi){
        $this->db->where('lapd.id_equipment',$opsi);
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
      if($tgl == 0){
        $this->db->where('tgl_laporan BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
      }
      if($opsi){
        $this->db->where('lapd.id_equipment',$opsi);
      }
      }
      }
    }

      $this->db->from('ol_laporan_detil lapd');  
      $this->db->join('ol_laporan lap', 'lap.id_laporan=lapd.id_laporan','left');
      $this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=lap.pembuat_laporan','left');
      $this->db->join('ol_unit ou', 'ou.id_unit=lap.laporan_unit','left'); 
      $this->db->where('lap.laporan_unit',$this->session->unit);
      if($tgl == 0){
        $this->db->where('tgl_laporan BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
      }
      if($opsi){
        $this->db->where('lapd.id_equipment',$opsi);
      }

    $q = $this->db->get_where(); //04 Execute
    $jml_filter = $q->row()->num; //05 Hasil

  //--------- Query jumlah All data paling banyak -----
/*    $kondisi=array('id_unit='=>$this->session->unit);
    $jml = $this->m_umum->jumlah_record_filter('ol_eq_imut',$kondisi); */
/*    $kondisi=array('id_unit='=>$this->session->unit,'jenis_equipment'=>1);
    $jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_eq_imut',$kondisi,'ol_equipment','id_equipment'); */
    $jml = $this->m_umum->jumlah_record_tabel('ol_laporan_detil');

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
    return $this->db->insert('ol_laporan', $data_pendaftaran);
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
    $this->db->update('ol_laporan', $data_pendaftaran);
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
    DATE_FORMAT(tgl_laporan,'%d-%m-%Y') as tgl_laporan,tgl_laporan as tgl_sort,DATE_FORMAT(tgl_awal,'%d-%m-%Y') as tgl_awal,DATE_FORMAT(tgl_akhir,'%d-%m-%Y') as tgl_akhir,concat(format(COALESCE(min_laporan_detil, 0),0),' - ',format(COALESCE(max_laporan_detil, 0),0)) as minimax,if(periode_laporan_detil=1,'HARIAN',if(periode_laporan_detil=2,'BULANAN','TAHUNAN')) as periode_laporan_detil
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
      }
      }
    }
    $this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

      $this->db->from('ol_laporan_detil old');  
      $this->db->join('ol_laporan lap', 'lap.id_laporan=old.id_laporan','left');
      $this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=lap.pembuat_laporan','left');
      $this->db->join('ol_unit ou', 'ou.id_unit=lap.laporan_unit','left');
      $this->db->join('sn_tabel st', 'st.id_tabel=old.tabel','left');
      $this->db->where('old.id_laporan',$id);
      $this->db->where('lap.laporan_unit',$this->session->unit);

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
      }
      }
    }

      $this->db->from('ol_laporan_detil old');  
      $this->db->join('ol_laporan lap', 'lap.id_laporan=old.id_laporan','left');
      $this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=lap.pembuat_laporan','left');
      $this->db->join('ol_unit ou', 'ou.id_unit=lap.laporan_unit','left');
      $this->db->join('sn_tabel st', 'st.id_tabel=old.tabel','left');
      $this->db->where('old.id_laporan',$id);
      $this->db->where('lap.laporan_unit',$this->session->unit);

    $q = $this->db->get_where(); //04 Execute
    $jml_filter = $q->row()->num; //05 Hasil

  //--------- Query jumlah All data paling banyak -----
/*    $kondisi=array('id_unit='=>$this->session->unit);
    $jml = $this->m_umum->jumlah_record_filter('ol_eq_imut',$kondisi); */
/*    $kondisi=array('id_unit='=>$this->session->unit,'jenis_equipment'=>1);
    $jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_eq_imut',$kondisi,'ol_equipment','id_equipment'); */
    $jml = $this->m_umum->jumlah_record_tabel('ol_laporan_detil');

    $output = array(
      "draw" => $draw,
        "recordsTotal" => $jml,
        "recordsFiltered" => $jml_filter,
        "data" => $list
    );
    // print_r($output);die();
    return $output;
  }
  function tambah_tabel(){
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
  //    'id_equipment'  => $this->input->post('id_equipment'),
      'button'  => $this->input->post('button'),
      'analisa_laporan_detil'  => $this->input->post('analisa_laporan_detil'),
      'rekomendasi_laporan_detil'  => $this->input->post('rekomendasi_laporan_detil')
    );
    $this->db->insert('ol_laporan_detil', $data_pendaftaran);
    return $kode;
    // $this->db->insert_id();
  }
  function rubah_tabel(){
    $id_laporan_detil = $this->input->post('id_laporan_detil');
    $data_pendaftaran = array(
      'judul_laporan_detil'  => $this->input->post('judul_laporan_detil'),
      'tabel'  => $this->input->post('tabel'),
      'urutan_laporan_detil'  => $this->input->post('urutan_laporan_detil'),
      'periode_laporan_detil'  => $this->input->post('periode_laporan_detil'),
      'min_laporan_detil'  => $this->input->post('min_laporan_detil'),
      'max_laporan_detil'  => $this->input->post('max_laporan_detil'),
  //    'id_equipment'  => $this->input->post('id_equipment'),
      'button'  => $this->input->post('button'),
      'analisa_laporan_detil'  => $this->input->post('analisa_laporan_detil'),
      'rekomendasi_laporan_detil'  => $this->input->post('rekomendasi_laporan_detil')
    );
    $this->db->where('id_laporan_detil',$id_laporan_detil);
    $this->db->update('ol_laporan_detil', $data_pendaftaran);
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
    $this->db->update('ol_laporan_detil', $data_pendaftaran);
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
    $this->db->update('ol_laporan_detil', $data_pendaftaran);
    //echo $this->db->last_query();
    $this->db->trans_complete();  // untuk cek sukses update tidak
    if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
    // if (!$this->db->affected_rows())
      return(FALSE);
    else
      return(TRUE);
  }
  function simpan_nudenum(){
    $id_laporan_detil = $this->input->post('id_laporan_detil');
    $data_pendaftaran = array(
      'nudenum'  => $this->input->post('nudenum'),
      'numerator_laporan_detil'  => '',
      'denumerator_laporan_detil'  => ''
    );
    $this->db->where('id_laporan_detil',$id_laporan_detil);
    $this->db->update('ol_laporan_detil', $data_pendaftaran);
    //echo $this->db->last_query();
    $this->db->trans_complete();  // untuk cek sukses update tidak
    if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
    // if (!$this->db->affected_rows())
      return(FALSE);
    else
      return(TRUE);
  }
  function ambil_kat_persen($nudenum)
  {
      $this->db->select("id_eq_detil, nama_eq_detil");
      $q= $this->db->get_where('ol_eq_detil',array('status_eq_detil'=>1,'id_equipment'=>$nudenum))->result_array();
      $hasil= array_column($q,'nama_eq_detil','id_eq_detil');
      //echo $this->db->last_query();die();
      //print_r($q);die();
      return $hasil;
  }
  function simpan_xy(){
    $id_laporan_detil = $this->input->post('id_laporan_detil');
    $data_pendaftaran = array(
      'numerator_laporan_detil'  => $this->input->post('numerator_laporan_detil'),
      'denumerator_laporan_detil'  => $this->input->post('denumerator_laporan_detil')
    );
    $this->db->where('id_laporan_detil',$id_laporan_detil);
    $this->db->update('ol_laporan_detil', $data_pendaftaran);
    //echo $this->db->last_query();
    $this->db->trans_complete();  // untuk cek sukses update tidak
    if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
    // if (!$this->db->affected_rows())
      return(FALSE);
    else
      return(TRUE);
  }
//===============================================
  function ambil_equipment_lap($jns)
  {
    //  $ids = explode(',', $jns);
      $this->db->where_in('jenis_equipment',$jns);
      $q= $this->db->get_where('ol_equipment',array('status_equipment'=>1,'id_unit'=>$this->session->unit))->result_array();
      //$q = $this->db->get_where($tabel,$kondisi)->result_array(); 
      //echo $this->db->last_query();die();
      //print_r($q);die();
      return $q;
  }
  function ambil_eq_detil($id,$jns)
  {
    $lpd = $this->m_ol_rancak->ambil_data_laporan_detil($id);
    if($lpd['id_equipment']){
      $this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_eq_detil.id_equipment','left');
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_eq_detil.pembuat_eq_detil','left');
      $idx = explode(',', $lpd['id_equipment']);    
      $this->db->where_in("ol_equipment.coun_equipment",$idx);
      $this->db->where_in('jenis_equipment',$jns);
      $q= $this->db->get_where('ol_eq_detil',array('status_equipment'=>1,'status_eq_detil'=>1,'id_unit'=>$this->session->unit))->result_array();
      //$q = $this->db->get_where($tabel,$kondisi)->result_array(); 
      //echo $this->db->last_query();die();
      //print_r($q);die();
      return $q;
    }
  }
//===============================================
}
/*
//===========================================
$dataSet = array(array('id'=>7539, 'os'=>'Android'), array('id'=>7540, 'os'=>'iOS'));

//foreach
$ids = array();
foreach($dataSet as $data) {
    $ids[] = $data['id'];
}
    
echo implode(',', $ids);

echo PHP_EOL;
//array_column
echo implode(',', array_column($dataSet, 'id'));
result = 
7539,7540
7539,7540
//===========================================
$this->db->group_start();
$sale_ids_chunk = array_chunk($sale_ids,25);
foreach($sale_ids_chunk as $sale_ids)
{
    $this->db->or_where_in('sales_payments.sale_id', $sale_ids);
}
$this->db->group_end();
 Merging and Splitting Arrays

You can also cut up and merge arrays when needed. For example, say you have a three-item array of various fruits and want to get a subarray consisting of the last two items. You can do this with the array_slice function, passing it the array you want to get a section of, the offset at which to start, and the length of the array you want to create:

    $fruits["good"] = "tangerine";
    $fruits["better"] = "pineapple";
    $fruits["best"] = "pomegranate";
    $subarray = array_slice($fruits, 1, 2);
    foreach ($subarray as $value) {
        echo "Fruit: $value\n";
    }

Here are the results:

Fruit: pineapple
Fruit: pomegranate
You can also merge two or more arrays with array_merge:

<?php
    $fruits = array("pineapple", "pomegranate", "tangerine");
    $vegetables = array("corn", "broccoli", "zucchini");

    $produce = array_merge($fruits, $vegetables);

    foreach ($produce as $value) {
        echo "Produce item: $value\n";
    }
?>

And here's what you get (see also "Using the Array Operators" in this chapter):

Produce item: pineapple
Produce item: pomegranate
Produce item: tangerine
Produce item: corn
Produce item: broccoli
Produce item: zucchini
//=====================================
array( 'id' => 'post_1',
       'desc' => 'Description 1',
       'type' => 'type1',
       'title' => 'Title'
     );

array( 'id' => 'post_2',
       'desc' => 'Description 2',
       'type' => 'type2',
       'title' => 'Title'
     );

$newArray = array();
foreach ($oldArray as $entry) {
    $newArray[$entry['id']] = $entry['type'];
}
//=================================
$myArray = array('item1', 'item2hidden', 'item3', 'item4', 'item5hidden');
$secondaryArray = array();

foreach ($myArray as $key => $value) {
    if (strpos($value, "hidden") !== false) {
        $secondaryArray[] = $value;
        unset($myArray[$key]);
    }
}
//=============================

$array=[1,2,3,4,5,6,7,8,9,10];

$arr = [3,3,4]; length of chunk
$result_arr = [];
foreach($arr as $k => $v){
    $result_arr[$k] = array_splice($array,0,$v);
}
print_R($result_arr);

Output:

Array
(
    [0] => Array
        (
            [0] => 1
            [1] => 2
            [2] => 3
        )

    [1] => Array
        (
            [0] => 4
            [1] => 5
            [2] => 6
        )

    [2] => Array
        (
            [0] => 7
            [1] => 8
            [2] => 9
            [3] => 10
        )

)
*/