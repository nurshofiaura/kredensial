<?php
class M_ol_laporan extends CI_model{
  function logbook_laporan_all($first_date,$last_date,$tgl)
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
        switch($k['data']){   //beberapa field ambigius, so sesuaikan [coding here]
        //   case 'no_hp' : $nmf="peg.no_hp";break;
          // case 'id_level'   : $nmf="u.id_level";break;
        default: $nmf=$k['data'];
        }
        $this->db->or_like($nmf, $cari['value'],'both',false);  
      $this->db->where('oll.barcode_pegawai',$this->session->barcode_pegawai);    
      if($tgl == 0){
      $this->db->where('tgl_laporan BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
    } 
      }
      }
    }
    $this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

      $this->db->from('ol_logbook_laporan oll');  
      $this->db->join('ol_unit ou', 'ou.id_unit=oll.id_unit','left');
      $this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
      $this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=oll.barcode_pegawai','left');
      $this->db->where('oll.barcode_pegawai',$this->session->barcode_pegawai);    
      if($tgl == 0){
      $this->db->where('tgl_laporan BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
    } 
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
      $this->db->where('oll.barcode_pegawai',$this->session->barcode_pegawai);    
      if($tgl == 0){
      $this->db->where('tgl_laporan BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
    } 
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

    $q = $this->db->get_where(); //04 Execute
    $jml_filter = $q->row()->num; //05 Hasil

  //--------- Query jumlah All data paling banyak -----
  /*  $kondisi=array('id_level !='=>'99','id_pegawai'=>$id);
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
    $this->db->trans_complete();  // untuk cek sukses update tidak
    if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
    // if (!$this->db->affected_rows())
      return(FALSE);
    else
      return(TRUE);
  }
  function logbook_laporan_tabel_all($id)
  {
    $fields = "*,concat(nama_unit,' - [<b>',nama_working,'</b>]') as nama_working,if(tabel = 0,'Tanpa Tabel dan Grafik',nama_tabel) as nama_tabel,
    if(lhu=1,'Kompetensi',if(lhu=2,'BAKHP',if(lhu=3,'Reject',if(lhu=4,'QC / IM',if(lhu=5,'Pendaftaran Pasien',if(lhu=7,'Berkas',if(lhu=8,'Even','Belum di set'))))))) as lhu,concat(format(COALESCE(min_laporan_tabel, 0),0),' - ',format(COALESCE(max_laporan_tabel, 0),0)) as minimax";
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
      $this->db->where('ollt.id_laporan',$id);  
    $this->db->group_start();
    $this->db->where('oll.barcode_pegawai',$this->session->barcode_pegawai);
  //  $this->db->or_where("(oll.id_unit = '".$this->session->unit."' AND oll.share_it = 1)", NULL, FALSE);
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
  //  $this->db->or_where("(oll.id_unit = '".$this->session->unit."' AND oll.share_it = 1)", NULL, FALSE);
    $this->db->group_end(); 

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
      $this->db->where('ollt.id_laporan',$id);  
    $this->db->group_start();
    $this->db->where('oll.barcode_pegawai',$this->session->barcode_pegawai);
  //  $this->db->or_where("(oll.id_unit = '".$this->session->unit."' AND oll.share_it = 1)", NULL, FALSE);
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
  //  $this->db->or_where("(oll.id_unit = '".$this->session->unit."' AND oll.share_it = 1)", NULL, FALSE);
    $this->db->group_end();

    $q = $this->db->get_where(); //04 Execute
    $jml_filter = $q->row()->num; //05 Hasil

  //--------- Query jumlah All data paling banyak -----
    $kondisi=array('id_laporan'=>$id);
    $jml = $this->m_umum->jumlah_record_filter('ol_logbook_laporan_tabel',$kondisi); 
//    $jml = $this->m_umum->jumlah_record_tabel('ol_logbook_laporan_tabel');

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
  function rubah_tabel(){
    $id_laporan_tabel = $this->input->post('id_laporan_tabel');
    $data_pendaftaran = array(
      'judul_laporan_tabel'  => $this->input->post('judul_laporan_tabel'),
      'analisa_laporan_tabel'  => $this->input->post('analisa_laporan_tabel'),
      'rekomendasi_laporan_tabel'  => $this->input->post('rekomendasi_laporan_tabel')
    );
    $this->db->where('id_laporan_tabel',$id_laporan_tabel);
    $this->db->update('ol_logbook_laporan_tabel', $data_pendaftaran);
    //echo $this->db->last_query();
    $this->db->trans_complete();  // untuk cek sukses update tidak
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
    $this->db->trans_complete();  // untuk cek sukses update tidak
    if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
    // if (!$this->db->affected_rows())
      return(FALSE);
    else
      return(TRUE);
  }
  function modif_tabel(){
    $id_laporan_tabel = $this->input->post('id_laporan_tabel');
    $data_pendaftaran = array(
      'tabel' => $this->input->post('tabel')
    );
    $this->db->where('id_laporan_tabel',$id_laporan_tabel);
    $this->db->update('ol_logbook_laporan_tabel', $data_pendaftaran);
    //echo $this->db->last_query();
    $this->db->trans_complete();  // untuk cek sukses update tidak
    if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
    // if (!$this->db->affected_rows())
      return(FALSE);
    else
      return(TRUE);
  }
  function seting_range(){
    $id_laporan_tabel = $this->input->post('id_laporan_tabel');
    $data_pendaftaran = array(
      'min_laporan_tabel' => $this->input->post('min_laporan_tabel'),
      'max_laporan_tabel' =>$this->input->post('max_laporan_tabel')
    );
    $this->db->where('id_laporan_tabel',$id_laporan_tabel);
    $this->db->update('ol_logbook_laporan_tabel', $data_pendaftaran);
    //echo $this->db->last_query();
    $this->db->trans_complete();  // untuk cek sukses update tidak
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
    $this->db->trans_complete();  // untuk cek sukses update tidak
    if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
    // if (!$this->db->affected_rows())
      return(FALSE);
    else
      return(TRUE);
  }
  function rubah_qc(){
    $id_laporan_tabel = $this->input->post('id_laporan_tabel');
    $data_pendaftaran = array(
      'qc_self' => $this->input->post('qc_self')
    );
    $this->db->where('id_laporan_tabel',$id_laporan_tabel);
    $this->db->update('ol_logbook_laporan_tabel', $data_pendaftaran);
    //echo $this->db->last_query();
    $this->db->trans_complete();  // untuk cek sukses update tidak
    if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
    // if (!$this->db->affected_rows())
      return(FALSE);
    else
      return(TRUE);
  }
  function seting_kompetensi(){
    $id_laporan_tabel = $this->input->post('id_laporan_tabel');
    $field = $this->input->post('field');
    $chk = $this->input->post('chk[]');
    if (empty($chk)) {
       $id = "";
    }else{
      $id = implode(",",$chk);
    }
    $data_pendaftaran = array(
      $field => $id
    );
    $this->db->where('id_laporan_tabel',$id_laporan_tabel);
    $this->db->update('ol_logbook_laporan_tabel', $data_pendaftaran);
    //echo $this->db->last_query();
    $this->db->trans_complete();  // untuk cek sukses update tidak
    if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
    // if (!$this->db->affected_rows())
      return(FALSE);
    else
      return(TRUE);
  }
  function seting_tabel_detil(){
    $id_laporan_tabel = $this->input->post('id_laporan_tabel');
    $nama_source = $this->input->post('nama_source');
    $ket_source = $this->input->post('ket_source');
    $tabel_source = $this->input->post('tabel_source');
    $chk = $this->input->post('chk[]');
    $this->nonaktikan_status_tabel_detil($id_laporan_tabel,$nama_source,$ket_source,$tabel_source);
    if($chk){
      $jml_kode = count($chk);
      for ($i=0;$i<$jml_kode;$i++){
        $this->db->select("COUNT(*) as num");
        $this->db->where('id_laporan_tabel',$id_laporan_tabel);
        $this->db->where('nama_source',$nama_source);
        $this->db->where('ket_source',$ket_source);
        $this->db->where('tabel_source',$tabel_source);
        $this->db->where('pembuat_source',$this->session->barcode_pegawai);
        $this->db->where('id_source',$chk[$i]);
        $q = $this->db->get('ol_logbook_laporan_tabel_detil')->row();
        $jml = $q->num;
        if($jml == 0){
          $this->simpan_laporan_tabel_detil($id_laporan_tabel,$nama_source,$ket_source,$tabel_source,$chk[$i]);
        }else{
          $this->rubah_status_tabel_detil($id_laporan_tabel,$nama_source,$ket_source,$tabel_source,$chk[$i]);
        }
      }
    }
  }
  function nonaktikan_status_tabel_detil($id_laporan_tabel,$nama_source,$ket_source,$tabel_source){
    $data_pendaftaran = array(
      'status_laporan_tabel_detil' => 0
    );
    $this->db->where('id_laporan_tabel',$id_laporan_tabel);
    $this->db->where('nama_source',$nama_source);
    $this->db->where('ket_source',$ket_source);
    $this->db->where('tabel_source',$tabel_source);
    $this->db->where('pembuat_source',$this->session->barcode_pegawai);
    $this->db->update('ol_logbook_laporan_tabel_detil', $data_pendaftaran);
    //echo $this->db->last_query();
    $this->db->trans_complete();  // untuk cek sukses update tidak
    if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
    // if (!$this->db->affected_rows())
      return(FALSE);
    else
      return(TRUE);
  }
  function simpan_laporan_tabel_detil($id_laporan_tabel,$nama_source,$ket_source,$tabel_source,$chk){
      $kode = $this->m_rancak->kode_generator_urut(15,'TD');
      $data_pendaftaran = array(
        'id_laporan_tabel_detil' => $kode,
        'id_laporan_tabel' => $id_laporan_tabel,
        'nama_source' => $nama_source,
        'tabel_source' => $tabel_source,
        'ket_source' => $ket_source,
        'id_source' => $chk,
        'pembuat_source' => $this->session->barcode_pegawai
      );
      $this->db->insert('ol_logbook_laporan_tabel_detil', $data_pendaftaran);
  }
  function rubah_status_tabel_detil($id_laporan_tabel,$nama_source,$ket_source,$tabel_source,$chk){
    $data_pendaftaran = array(
      'status_laporan_tabel_detil' => 1
    );
    $this->db->where('id_laporan_tabel',$id_laporan_tabel);
    $this->db->where('nama_source',$nama_source);
    $this->db->where('id_source',$chk);
    $this->db->where('ket_source',$ket_source);
    $this->db->where('tabel_source',$tabel_source);
    $this->db->where('pembuat_source',$this->session->barcode_pegawai);
    $this->db->update('ol_logbook_laporan_tabel_detil', $data_pendaftaran);
    //echo $this->db->last_query();
    $this->db->trans_complete();  // untuk cek sukses update tidak
    if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
    // if (!$this->db->affected_rows())
      return(FALSE);
    else
      return(TRUE);
  }
  function set_sumber_data($tabel,$select,$kondisi,$lhu,$grup=FALSE)
  {
    $this->db->select($select);
    if($lhu == 1){
      $this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
      $this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_logbook.id_logbooker','left');
    }
    if($lhu == 4){
      $this->db->join('ol_logbook_lhu', 'ol_logbook_lhu.id_lhu=ol_logbook_lhu_detil.id_lhu','left');
      $this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=ol_logbook_lhu.barcode_pegawai','left');
      $this->db->join('ol_logbook_item_lhu', 'ol_logbook_item_lhu.id_item_lhu=ol_logbook_lhu_detil.id_item_lhu','left');
      $this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_logbook_item_lhu.id_equipment','left');
      $this->db->join('ol_unit', 'ol_unit.id_unit=ol_equipment.id_unit','left');
      $this->db->join('kol_working', 'kol_working.id_working=ol_unit.id_instansi','left');
    }
    if($lhu == 5){
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=tindakan_daftar.pendaftar','left');
      $this->db->join('tindakan', 'tindakan.id_tindakan=tindakan_daftar.id_tindakan','left');
      $this->db->join('kol_golongan_pemeriksaan', 'kol_golongan_pemeriksaan.id_golongan_pemeriksaan=tindakan.id_golongan_pemeriksaan','left');
      $this->db->join('ol_unit', 'ol_unit.id_unit=tindakan_daftar.unit_pengirim','left');
      $this->db->join('kol_working', 'kol_working.id_working=ol_unit.id_instansi','left');
    }
    if($lhu == 7){
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_berkas.id_pegawai','left');
      $this->db->join('ol_berkas_kategori', 'ol_berkas_kategori.id_berkas_kategori=ol_berkas.id_kategori_berkas','left');
      $this->db->join('ol_kategori_pelatihan', 'ol_kategori_pelatihan.id_kategori_pelatihan=ol_berkas.id_kategori_pelatihan','left');
      $this->db->join('kol_pendidikan', 'kol_pendidikan.id_pendidikan=ol_berkas.id_pendidikan','left');
    }
    if($lhu == 8){
      $this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=abs_even.barcode_pegawai','left');
      $this->db->join('ol_user', 'ol_user.id_pegawai=ol_pegawai.id_pegawai','left');
    }
    if($grup){
      $this->db->group_by($grup);
    }
    $q = $this->db->get_where($tabel,$kondisi)->result_array(); 
    //  echo $this->db->last_query();die();
    //print_r($q);die();
    return $q;
    }
  function set_isi_sumber_data($id,$tabel,$select,$kondisi,$lhu,$order,$asc,$jml_isi,$arr_isi,$jml_seting,$arr_seting,$grup=FALSE)
  {
    $lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
    $this->db->select($select);
    if($lhu == 1){
      $this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
      $this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_logbook.id_logbooker','left');
      if($jml_isi > 0){
        $array_isi = array();
        foreach($arr_isi as $val){
            $array_isi[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_isi);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("ol_logbook.id_kewenangan",$idx);
      }elseif($jml_seting > 0){
        $array_seting = array();
        foreach($arr_seting as $val){
            $array_seting[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_seting);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("ol_logbook.id_logbook",$idx);
      }
    }
    if($lhu == 4){
      $this->db->join('ol_logbook_lhu', 'ol_logbook_lhu.id_lhu=ol_logbook_lhu_detil.id_lhu','left');
      $this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=ol_logbook_lhu.barcode_pegawai','left');
      $this->db->join('ol_logbook_item_lhu', 'ol_logbook_item_lhu.id_item_lhu=ol_logbook_lhu_detil.id_item_lhu','left');
      $this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_logbook_item_lhu.id_equipment','left');
      $this->db->join('ol_unit', 'ol_unit.id_unit=ol_equipment.id_unit','left');
      $this->db->join('kol_working', 'kol_working.id_working=ol_unit.id_instansi','left');
      if($jml_isi > 0){
        $array_isi = array();
        foreach($arr_isi as $val){
            $array_isi[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_isi);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("ol_logbook_item_lhu.id_item_lhu",$idx);
      }elseif($jml_seting > 0){
        $array_seting = array();
        foreach($arr_seting as $val){
            $array_seting[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_seting);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("ol_logbook_lhu_detil.id_lhu_detil",$idx);
      }
    }
    if($lhu == 5){
      $this->db->join('tindakan', 'tindakan.id_tindakan=tindakan_daftar.id_tindakan','left');
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=tindakan_daftar.pendaftar','left');
      $this->db->join('kol_golongan_pemeriksaan', 'kol_golongan_pemeriksaan.id_golongan_pemeriksaan=tindakan.id_golongan_pemeriksaan','left');
      $this->db->join('ol_unit', 'ol_unit.id_unit=tindakan_daftar.unit_pengirim','left');
      $this->db->join('kol_working', 'kol_working.id_working=ol_unit.id_instansi','left');
      if($jml_isi > 0){
        $array_isi = array();
        foreach($arr_isi as $val){
            $array_isi[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_isi);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("tindakan_daftar.id_daftar",$idx);
      }elseif($jml_seting > 0){
        $array_seting = array();
        foreach($arr_seting as $val){
            $array_seting[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_seting);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("tindakan_daftar.id_tindakan",$idx);
      }
    }
    if($lhu == 7){
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_berkas.id_pegawai','left');
      $this->db->join('ol_berkas_kategori', 'ol_berkas_kategori.id_berkas_kategori=ol_berkas.id_kategori_berkas','left');
      $this->db->join('ol_kategori_pelatihan', 'ol_kategori_pelatihan.id_kategori_pelatihan=ol_berkas.id_kategori_pelatihan','left');
      $this->db->join('kol_pendidikan', 'kol_pendidikan.id_pendidikan=ol_berkas.id_pendidikan','left');
      if($jml_isi > 0){
        $array_isi = array();
        foreach($arr_isi as $val){
            $array_isi[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_isi);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("ol_berkas.id_berkas",$idx);
      }elseif($jml_seting > 0){
        $array_seting = array();
        foreach($arr_seting as $val){
            $array_seting[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_seting);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("ol_berkas_kategori.id_berkas_kategori",$idx);
      }
    }
    if($lhu == 8){
      $this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=abs_even.barcode_pegawai','left');
      $this->db->join('ol_user', 'ol_user.id_pegawai=ol_pegawai.id_pegawai','left');
      if($jml_isi > 0){
        $array_isi = array();
        foreach($arr_isi as $val){
            $array_isi[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_isi);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("id_even",$idx);
      }elseif($jml_seting > 0){
        $array_seting = array();
        foreach($arr_seting as $val){
            $array_seting[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_seting);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("id_even",$idx);
      }
    }
    if($grup){
      $this->db->group_by($grup);
    }
    $this->db->order_by($order,$asc);
    $q = $this->db->get_where($tabel,$kondisi)->result_array(); 
    //echo $this->db->last_query();die();
    //print_r($q);die();
    return $q;
    }
  function ambil_isi($id,$tabel,$select,$kondisi,$lhu,$order,$asc,$jml_isi,$arr_isi,$jml_seting,$arr_seting,$grup=FALSE)
  {
    $lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
    $this->db->select($select);
    if($lhu == 1){
      $this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
      $this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_logbook.id_logbooker','left');
      if($jml_isi > 0){
        $array_isi = array();
        foreach($arr_isi as $val){
            $array_isi[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_isi);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("ol_logbook.id_kewenangan",$idx);
      }elseif($jml_seting > 0){
        $array_seting = array();
        foreach($arr_seting as $val){
            $array_seting[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_seting);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("ol_logbook.id_logbook",$idx);
      }
    }
    if($lhu == 4){
      $this->db->join('ol_logbook_lhu', 'ol_logbook_lhu.id_lhu=ol_logbook_lhu_detil.id_lhu','left');
      $this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=ol_logbook_lhu.barcode_pegawai','left');
      $this->db->join('ol_logbook_item_lhu', 'ol_logbook_item_lhu.id_item_lhu=ol_logbook_lhu_detil.id_item_lhu','left');
      $this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_logbook_item_lhu.id_equipment','left');
      $this->db->join('ol_unit', 'ol_unit.id_unit=ol_equipment.id_unit','left');
      $this->db->join('kol_working', 'kol_working.id_working=ol_unit.id_instansi','left');
      if($jml_isi > 0){
        $array_isi = array();
        foreach($arr_isi as $val){
            $array_isi[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_isi);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("ol_logbook_item_lhu.id_item_lhu",$idx);
      }elseif($jml_seting > 0){
        $array_seting = array();
        foreach($arr_seting as $val){
            $array_seting[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_seting);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("ol_logbook_lhu_detil.id_lhu_detil",$idx);
      }
    }
    if($lhu == 5){
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=tindakan_daftar.pendaftar','left');
      $this->db->join('tindakan', 'tindakan.id_tindakan=tindakan_daftar.id_tindakan','left');
      $this->db->join('kol_golongan_pemeriksaan', 'kol_golongan_pemeriksaan.id_golongan_pemeriksaan=tindakan.id_golongan_pemeriksaan','left');
      $this->db->join('ol_unit', 'ol_unit.id_unit=tindakan_daftar.unit_pengirim','left');
      $this->db->join('kol_working', 'kol_working.id_working=ol_unit.id_instansi','left');
      if($jml_isi > 0){
        $array_isi = array();
        foreach($arr_isi as $val){
            $array_isi[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_isi);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("tindakan_daftar.id_daftar",$idx);
      }elseif($jml_seting > 0){
        $array_seting = array();
        foreach($arr_seting as $val){
            $array_seting[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_seting);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("tindakan_daftar.id_tindakan",$idx);
      }
    }
    if($lhu == 7){
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_berkas.id_pegawai','left');
      $this->db->join('ol_berkas_kategori', 'ol_berkas_kategori.id_berkas_kategori=ol_berkas.id_kategori_berkas','left');
      $this->db->join('ol_kategori_pelatihan', 'ol_kategori_pelatihan.id_kategori_pelatihan=ol_berkas.id_kategori_pelatihan','left');
      $this->db->join('kol_pendidikan', 'kol_pendidikan.id_pendidikan=ol_berkas.id_pendidikan','left');
      if($jml_isi > 0){
        $array_isi = array();
        foreach($arr_isi as $val){
            $array_isi[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_isi);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("ol_berkas.id_berkas",$idx);
      }elseif($jml_seting > 0){
        $array_seting = array();
        foreach($arr_seting as $val){
            $array_seting[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_seting);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("ol_berkas_kategori.id_berkas_kategori",$idx);
      }
    }
    if($lhu == 8){
      $this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=abs_even.barcode_pegawai','left');
      $this->db->join('ol_user', 'ol_user.id_pegawai=ol_pegawai.id_pegawai','left');
      if($jml_isi > 0){
        $array_isi = array();
        foreach($arr_isi as $val){
            $array_isi[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_isi);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("id_even",$idx);
      }elseif($jml_seting > 0){
        $array_seting = array();
        foreach($arr_seting as $val){
            $array_seting[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_seting);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("id_even",$idx);
      }
    }
    if($grup){
      $this->db->group_by($grup);
    }
    $this->db->order_by($order,$asc);
    $q = $this->db->get_where($tabel,$kondisi)->result_array(); 
    //echo $this->db->last_query();die();
    //print_r($q);die();
    return $q;
    }
    function jumlah_sumber_data($id,$tabel,$kondisi,$lhu,$jml_isi,$arr_isi,$jml_seting,$arr_seting)
    {
      $lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
    if($lhu == 1){
      $this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
      $this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_logbook.id_logbooker','left');
      if($jml_isi > 0){
        $array_isi = array();
        foreach($arr_isi as $val){
            $array_isi[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_isi);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("ol_logbook.id_kewenangan",$idx);
      }elseif($jml_seting > 0){
        $array_seting = array();
        foreach($arr_seting as $val){
            $array_seting[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_seting);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("ol_logbook.id_logbook",$idx);
      }
    }
    if($lhu == 4){
      $this->db->join('ol_logbook_lhu', 'ol_logbook_lhu.id_lhu=ol_logbook_lhu_detil.id_lhu','left');
      $this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=ol_logbook_lhu.barcode_pegawai','left');
      $this->db->join('ol_logbook_item_lhu', 'ol_logbook_item_lhu.id_item_lhu=ol_logbook_lhu_detil.id_item_lhu','left');
      $this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_logbook_item_lhu.id_equipment','left');
      $this->db->join('ol_unit', 'ol_unit.id_unit=ol_equipment.id_unit','left');
      $this->db->join('kol_working', 'kol_working.id_working=ol_unit.id_instansi','left');
      if($jml_isi > 0){
        $array_isi = array();
        foreach($arr_isi as $val){
            $array_isi[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_isi);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("ol_logbook_item_lhu.id_item_lhu",$idx);
      }elseif($jml_seting > 0){
        $array_seting = array();
        foreach($arr_seting as $val){
            $array_seting[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_seting);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("ol_logbook_lhu_detil.id_lhu_detil",$idx);
      }
    }
    if($lhu == 5){
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=tindakan_daftar.pendaftar','left');
      $this->db->join('tindakan', 'tindakan.id_tindakan=tindakan_daftar.id_tindakan','left');
      $this->db->join('kol_golongan_pemeriksaan', 'kol_golongan_pemeriksaan.id_golongan_pemeriksaan=tindakan.id_golongan_pemeriksaan','left');
      $this->db->join('ol_unit', 'ol_unit.id_unit=tindakan_daftar.unit_pengirim','left');
      $this->db->join('kol_working', 'kol_working.id_working=ol_unit.id_instansi','left');
      if($jml_isi > 0){
        $array_isi = array();
        foreach($arr_isi as $val){
            $array_isi[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_isi);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("tindakan_daftar.id_daftar",$idx);
      }elseif($jml_seting > 0){
        $array_seting = array();
        foreach($arr_seting as $val){
            $array_seting[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_seting);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("tindakan_daftar.id_tindakan",$idx);
      }
    }
    if($lhu == 7){
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_berkas.id_pegawai','left');
      $this->db->join('ol_berkas_kategori', 'ol_berkas_kategori.id_berkas_kategori=ol_berkas.id_kategori_berkas','left');
      $this->db->join('ol_kategori_pelatihan', 'ol_kategori_pelatihan.id_kategori_pelatihan=ol_berkas.id_kategori_pelatihan','left');
      $this->db->join('kol_pendidikan', 'kol_pendidikan.id_pendidikan=ol_berkas.id_pendidikan','left');
      if($jml_isi > 0){
        $array_isi = array();
        foreach($arr_isi as $val){
            $array_isi[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_isi);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("ol_berkas.id_berkas",$idx);
      }elseif($jml_seting > 0){
        $array_seting = array();
        foreach($arr_seting as $val){
            $array_seting[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_seting);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("ol_berkas_kategori.id_berkas_kategori",$idx);
      }
    }
    if($lhu == 8){
      $this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=abs_even.barcode_pegawai','left');
      $this->db->join('ol_user', 'ol_user.id_pegawai=ol_pegawai.id_pegawai','left');
      if($jml_isi > 0){
        $array_isi = array();
        foreach($arr_isi as $val){
            $array_isi[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_isi);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("id_even",$idx);
      }elseif($jml_seting > 0){
        $array_seting = array();
        foreach($arr_seting as $val){
            $array_seting[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_seting);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("id_even",$idx);
      }
    }
        $query = $this->db->select("COUNT(*) as num")->get_where($tabel,$kondisi);
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
    }
  function total_sumber_data($id,$tabel,$select,$kondisi,$lhu,$jml_isi,$arr_isi,$jml_seting,$arr_seting){
    $lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
    $this->db->select($select);
    if($lhu == 1){
      $this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
      $this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_logbook.id_logbooker','left');
      if($jml_isi > 0){
        $array_isi = array();
        foreach($arr_isi as $val){
            $array_isi[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_isi);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("ol_logbook.id_kewenangan",$idx);
      }elseif($jml_seting > 0){
        $array_seting = array();
        foreach($arr_seting as $val){
            $array_seting[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_seting);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("ol_logbook.id_logbook",$idx);
      }
    }
    if($lhu == 4){
      $this->db->join('ol_logbook_lhu', 'ol_logbook_lhu.id_lhu=ol_logbook_lhu_detil.id_lhu','left');
      $this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=ol_logbook_lhu.barcode_pegawai','left');
      $this->db->join('ol_logbook_item_lhu', 'ol_logbook_item_lhu.id_item_lhu=ol_logbook_lhu_detil.id_item_lhu','left');
      $this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_logbook_item_lhu.id_equipment','left');
      $this->db->join('ol_unit', 'ol_unit.id_unit=ol_equipment.id_unit','left');
      $this->db->join('kol_working', 'kol_working.id_working=ol_unit.id_instansi','left');
      if($jml_isi > 0){
        $array_isi = array();
        foreach($arr_isi as $val){
            $array_isi[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_isi);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("ol_logbook_item_lhu.id_item_lhu",$idx);
      }elseif($jml_seting > 0){
        $array_seting = array();
        foreach($arr_seting as $val){
            $array_seting[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_seting);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("ol_logbook_lhu_detil.id_lhu_detil",$idx);
      }
    }
    if($lhu == 5){
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=tindakan_daftar.pendaftar','left');
      $this->db->join('tindakan', 'tindakan.id_tindakan=tindakan_daftar.id_tindakan','left');
      $this->db->join('kol_golongan_pemeriksaan', 'kol_golongan_pemeriksaan.id_golongan_pemeriksaan=tindakan.id_golongan_pemeriksaan','left');
      $this->db->join('ol_unit', 'ol_unit.id_unit=tindakan_daftar.unit_pengirim','left');
      $this->db->join('kol_working', 'kol_working.id_working=ol_unit.id_instansi','left');
      if($jml_isi > 0){
        $array_isi = array();
        foreach($arr_isi as $val){
            $array_isi[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_isi);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("tindakan_daftar.id_daftar",$idx);
      }elseif($jml_seting > 0){
        $array_seting = array();
        foreach($arr_seting as $val){
            $array_seting[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_seting);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("tindakan_daftar.id_tindakan",$idx);
      }
    }
    if($lhu == 7){
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_berkas.id_pegawai','left');
      $this->db->join('ol_berkas_kategori', 'ol_berkas_kategori.id_berkas_kategori=ol_berkas.id_kategori_berkas','left');
      $this->db->join('ol_kategori_pelatihan', 'ol_kategori_pelatihan.id_kategori_pelatihan=ol_berkas.id_kategori_pelatihan','left');
      $this->db->join('kol_pendidikan', 'kol_pendidikan.id_pendidikan=ol_berkas.id_pendidikan','left');
      if($jml_isi > 0){
        $array_isi = array();
        foreach($arr_isi as $val){
            $array_isi[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_isi);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("ol_berkas.id_berkas",$idx);
      }elseif($jml_seting > 0){
        $array_seting = array();
        foreach($arr_seting as $val){
            $array_seting[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_seting);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("ol_berkas_kategori.id_berkas_kategori",$idx);
      }
    }
    if($lhu == 8){
      $this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=abs_even.barcode_pegawai','left');
      $this->db->join('ol_user', 'ol_user.id_pegawai=ol_pegawai.id_pegawai','left');
      if($jml_isi > 0){
        $array_isi = array();
        foreach($arr_isi as $val){
            $array_isi[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_isi);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("id_even",$idx);
      }elseif($jml_seting > 0){
        $array_seting = array();
        foreach($arr_seting as $val){
            $array_seting[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_seting);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("id_even",$idx);
      }
    }
    $q = $this->db->get_where($tabel,$kondisi);
    return $q->result_array();
  }
  function get_min($id,$tabel,$field,$kondisi,$lhu,$jml_isi,$arr_isi,$jml_seting,$arr_seting){
    $lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
    if($lhu == 1){
      $this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
      $this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_logbook.id_logbooker','left');
      if($jml_isi > 0){
        $array_isi = array();
        foreach($arr_isi as $val){
            $array_isi[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_isi);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("ol_logbook.id_kewenangan",$idx);
      }elseif($jml_seting > 0){
        $array_seting = array();
        foreach($arr_seting as $val){
            $array_seting[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_seting);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("ol_logbook.id_logbook",$idx);
      }
    }
    if($lhu == 4){
      $this->db->join('ol_logbook_lhu', 'ol_logbook_lhu.id_lhu=ol_logbook_lhu_detil.id_lhu','left');
      $this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=ol_logbook_lhu.barcode_pegawai','left');
      $this->db->join('ol_logbook_item_lhu', 'ol_logbook_item_lhu.id_item_lhu=ol_logbook_lhu_detil.id_item_lhu','left');
      $this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_logbook_item_lhu.id_equipment','left');
      $this->db->join('ol_unit', 'ol_unit.id_unit=ol_equipment.id_unit','left');
      $this->db->join('kol_working', 'kol_working.id_working=ol_unit.id_instansi','left');
      if($jml_isi > 0){
        $array_isi = array();
        foreach($arr_isi as $val){
            $array_isi[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_isi);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("ol_logbook_item_lhu.id_item_lhu",$idx);
      }elseif($jml_seting > 0){
        $array_seting = array();
        foreach($arr_seting as $val){
            $array_seting[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_seting);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("ol_logbook_lhu_detil.id_lhu_detil",$idx);
      }
    }
    if($lhu == 5){
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=tindakan_daftar.pendaftar','left');
      $this->db->join('tindakan', 'tindakan.id_tindakan=tindakan_daftar.id_tindakan','left');
      $this->db->join('kol_golongan_pemeriksaan', 'kol_golongan_pemeriksaan.id_golongan_pemeriksaan=tindakan.id_golongan_pemeriksaan','left');
      $this->db->join('ol_unit', 'ol_unit.id_unit=tindakan_daftar.unit_pengirim','left');
      $this->db->join('kol_working', 'kol_working.id_working=ol_unit.id_instansi','left');
      if($jml_isi > 0){
        $array_isi = array();
        foreach($arr_isi as $val){
            $array_isi[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_isi);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("tindakan_daftar.id_daftar",$idx);
      }elseif($jml_seting > 0){
        $array_seting = array();
        foreach($arr_seting as $val){
            $array_seting[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_seting);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("tindakan_daftar.id_tindakan",$idx);
      }
    }
    if($lhu == 7){
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_berkas.id_pegawai','left');
      $this->db->join('ol_berkas_kategori', 'ol_berkas_kategori.id_berkas_kategori=ol_berkas.id_kategori_berkas','left');
      $this->db->join('ol_kategori_pelatihan', 'ol_kategori_pelatihan.id_kategori_pelatihan=ol_berkas.id_kategori_pelatihan','left');
      $this->db->join('kol_pendidikan', 'kol_pendidikan.id_pendidikan=ol_berkas.id_pendidikan','left');
      if($jml_isi > 0){
        $array_isi = array();
        foreach($arr_isi as $val){
            $array_isi[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_isi);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("ol_berkas.id_berkas",$idx);
      }elseif($jml_seting > 0){
        $array_seting = array();
        foreach($arr_seting as $val){
            $array_seting[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_seting);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("ol_berkas_kategori.id_berkas_kategori",$idx);
      }
    }
    if($lhu == 8){
      $this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=abs_even.barcode_pegawai','left');
      $this->db->join('ol_user', 'ol_user.id_pegawai=ol_pegawai.id_pegawai','left');
      if($jml_isi > 0){
        $array_isi = array();
        foreach($arr_isi as $val){
            $array_isi[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_isi);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("id_even",$idx);
      }elseif($jml_seting > 0){
        $array_seting = array();
        foreach($arr_seting as $val){
            $array_seting[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_seting);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("id_even",$idx);
      }
    }
    $query = $this->db->select("MIN(".$field.") as num")->get_where($tabel,$kondisi);
      $result = $query->row();
      if(isset($result))
        return $result->num;
      return 0;
  }
  function get_max($id,$tabel,$field,$kondisi,$lhu,$jml_isi,$arr_isi,$jml_seting,$arr_seting){
    $lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
    if($lhu == 1){
      $this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
      $this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_logbook.id_logbooker','left');
      if($jml_isi > 0){
        $array_isi = array();
        foreach($arr_isi as $val){
            $array_isi[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_isi);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("ol_logbook.id_kewenangan",$idx);
      }elseif($jml_seting > 0){
        $array_seting = array();
        foreach($arr_seting as $val){
            $array_seting[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_seting);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("ol_logbook.id_logbook",$idx);
      }
    }
    if($lhu == 4){
      $this->db->join('ol_logbook_lhu', 'ol_logbook_lhu.id_lhu=ol_logbook_lhu_detil.id_lhu','left');
      $this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=ol_logbook_lhu.barcode_pegawai','left');
      $this->db->join('ol_logbook_item_lhu', 'ol_logbook_item_lhu.id_item_lhu=ol_logbook_lhu_detil.id_item_lhu','left');
      $this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_logbook_item_lhu.id_equipment','left');
      $this->db->join('ol_unit', 'ol_unit.id_unit=ol_equipment.id_unit','left');
      $this->db->join('kol_working', 'kol_working.id_working=ol_unit.id_instansi','left');
      if($jml_isi > 0){
        $array_isi = array();
        foreach($arr_isi as $val){
            $array_isi[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_isi);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("ol_logbook_item_lhu.id_item_lhu",$idx);
      }elseif($jml_seting > 0){
        $array_seting = array();
        foreach($arr_seting as $val){
            $array_seting[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_seting);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("ol_logbook_lhu_detil.id_lhu_detil",$idx);
      }
    }
    if($lhu == 5){
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=tindakan_daftar.pendaftar','left');
      $this->db->join('tindakan', 'tindakan.id_tindakan=tindakan_daftar.id_tindakan','left');
      $this->db->join('kol_golongan_pemeriksaan', 'kol_golongan_pemeriksaan.id_golongan_pemeriksaan=tindakan.id_golongan_pemeriksaan','left');
      $this->db->join('ol_unit', 'ol_unit.id_unit=tindakan_daftar.unit_pengirim','left');
      $this->db->join('kol_working', 'kol_working.id_working=ol_unit.id_instansi','left');
      if($jml_isi > 0){
        $array_isi = array();
        foreach($arr_isi as $val){
            $array_isi[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_isi);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("tindakan_daftar.id_daftar",$idx);
      }elseif($jml_seting > 0){
        $array_seting = array();
        foreach($arr_seting as $val){
            $array_seting[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_seting);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("tindakan_daftar.id_tindakan",$idx);
      }
    }
    if($lhu == 7){
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_berkas.id_pegawai','left');
      $this->db->join('ol_berkas_kategori', 'ol_berkas_kategori.id_berkas_kategori=ol_berkas.id_kategori_berkas','left');
      $this->db->join('ol_kategori_pelatihan', 'ol_kategori_pelatihan.id_kategori_pelatihan=ol_berkas.id_kategori_pelatihan','left');
      $this->db->join('kol_pendidikan', 'kol_pendidikan.id_pendidikan=ol_berkas.id_pendidikan','left');
      if($jml_isi > 0){
        $array_isi = array();
        foreach($arr_isi as $val){
            $array_isi[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_isi);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("ol_berkas.id_berkas",$idx);
      }elseif($jml_seting > 0){
        $array_seting = array();
        foreach($arr_seting as $val){
            $array_seting[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_seting);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("ol_berkas_kategori.id_berkas_kategori",$idx);
      }
    }
    if($lhu == 8){
      $this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=abs_even.barcode_pegawai','left');
      $this->db->join('ol_user', 'ol_user.id_pegawai=ol_pegawai.id_pegawai','left');
      if($jml_isi > 0){
        $array_isi = array();
        foreach($arr_isi as $val){
            $array_isi[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_isi);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("id_even",$idx);
      }elseif($jml_seting > 0){
        $array_seting = array();
        foreach($arr_seting as $val){
            $array_seting[] = $val['id_source'];
        }
        $eimplo_isi = implode(",", $array_seting);    
        $idx = explode(',', $eimplo_isi);    
        $this->db->where_in("id_even",$idx);
      }
    }
    $query = $this->db->select("MAX(".$field.") as num")->get_where($tabel,$kondisi);
      $result = $query->row();
      if(isset($result))
        return $result->num;
      return 0;
  }
  function seting_kewenangan(){
    $id_laporan_tabel = $this->input->post('id_laporan_tabel');
    $data_pendaftaran = array(
      'kewenangan' => $this->input->post('kewenangan')
    );
    $this->db->where('id_laporan_tabel',$id_laporan_tabel);
    $this->db->update('ol_logbook_laporan_tabel', $data_pendaftaran);
    //echo $this->db->last_query();
    $this->db->trans_complete();  // untuk cek sukses update tidak
    if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
    // if (!$this->db->affected_rows())
      return(FALSE);
    else
      return(TRUE);
  }
  function ambil_berkas_laporan($id,$select,$kondisi,$grup=FALSE)
  {
    $lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id); //id_laporan_tabel
    $this->db->select($select);
    $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_berkas.id_pegawai','left');
    $this->db->join('ol_berkas_kategori', 'ol_berkas_kategori.id_berkas_kategori=ol_berkas.id_kategori_berkas','left');
    $this->db->join('ol_kategori_pelatihan', 'ol_kategori_pelatihan.id_kategori_pelatihan=ol_berkas.id_kategori_pelatihan','left');
    $this->db->join('kol_pendidikan', 'kol_pendidikan.id_pendidikan=ol_berkas.id_pendidikan','left');
    if($grup){
      $this->db->group_by($grup);
    }
  //  $this->db->group_by("MONTH(tgl_lhu)");
    $this->db->order_by('tgl_b_berkas','asc');
    $q = $this->db->get_where('ol_berkas',$kondisi)->result_array();
//  echo $this->db->last_query();die();
  //print_r($q);die();
    return $q;
    }
  function rubah_show_pdf(){
    $id_laporan_tabel = $this->input->post('id_laporan_tabel');
    $data_pendaftaran = array(
      'show_pdf' => $this->input->post('show_pdf')
    );
    $this->db->where('id_laporan_tabel',$id_laporan_tabel);
    $this->db->update('ol_logbook_laporan_tabel', $data_pendaftaran);
    //echo $this->db->last_query();
    $this->db->trans_complete();  // untuk cek sukses update tidak
    if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
    // if (!$this->db->affected_rows())
      return(FALSE);
    else
      return(TRUE);
  }
  function rubah_sub(){
    $id_laporan_tabel = $this->input->post('id_laporan_tabel');
    $data_pendaftaran = array(
      'sub' => $this->input->post('sub')
    );
    $this->db->where('id_laporan_tabel',$id_laporan_tabel);
    $this->db->update('ol_logbook_laporan_tabel', $data_pendaftaran);
    //echo $this->db->last_query();
    $this->db->trans_complete();  // untuk cek sukses update tidak
    if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
    // if (!$this->db->affected_rows())
      return(FALSE);
    else
      return(TRUE);
  }
  function edit_tabel_status(){
    $id_laporan_tabel = $this->input->post('id_laporan_tabel');
    $data_pendaftaran = array(
      'status_urutan_tabel' => $this->input->post('status_urutan_tabel')
    );
    $this->db->where('id_laporan_tabel',$id_laporan_tabel);
    $this->db->update('ol_logbook_laporan_tabel', $data_pendaftaran);
    //echo $this->db->last_query();
    $this->db->trans_complete();  // untuk cek sukses update tidak
    if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
    // if (!$this->db->affected_rows())
      return(FALSE);
    else
      return(TRUE);
  }
  function tambah_tabel_clone(){
    $kode = $this->m_rancak->kode_generator(15,'LT');
    $id_laporan = $this->input->post('id_laporan');
    $id_laporan_tabel = $this->input->post('id_laporan_tabel');
    $kondisi = array('id_laporan_tabel'=>$id_laporan_tabel);
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
}

/*
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
//=====================================================
  function ambil_isi($id,$tabel,$select,$kondisi,$lhu,$order,$asc,$grup=FALSE)
  {
    $lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
    $this->db->select($select);
    if($lhu == 1){
      $this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
      $this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_logbook.id_logbooker','left');
      if($lpd['kompetensi']){
        $idk = explode(',', $lpd['kompetensi']);
        $this->db->where_in("nkr_kompetensi.coun_kompetensi",$idk);
      }
      if($lpd['isi_kompetensi']){
        $idlb = explode(',', $lpd['isi_kompetensi']);
        $this->db->where_in("ol_logbook.coun_logbook",$idlb);
      }
    }
    if($lhu == 4){
      $this->db->join('ol_logbook_lhu', 'ol_logbook_lhu.id_lhu=ol_logbook_lhu_detil.id_lhu','left');
      $this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=ol_logbook_lhu.barcode_pegawai','left');
      $this->db->join('ol_logbook_item_lhu', 'ol_logbook_item_lhu.id_item_lhu=ol_logbook_lhu_detil.id_item_lhu','left');
      $this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_logbook_item_lhu.id_equipment','left');
      $this->db->join('ol_unit', 'ol_unit.id_unit=ol_equipment.id_unit','left');
      $this->db->join('kol_working', 'kol_working.id_working=ol_unit.id_instansi','left');
      if($lpd['item_lhu'] || $lpd['qc_self'] == 0){
        $idx = explode(',', $lpd['item_lhu']);
        $this->db->where_in("ol_logbook_item_lhu.in_item_lhu",$idx);
      }
      if($lpd['i_mutu'] || $lpd['qc_self'] == 0){
        $idlb = explode(',', $lpd['i_mutu']);
        $this->db->where_in("ol_logbook_lhu_detil.coun_lhu_detil",$idlb);
      }
    }
    if($lhu == 5){
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=tindakan_daftar.pendaftar','left');
      $this->db->join('tindakan', 'tindakan.id_tindakan=tindakan_daftar.id_tindakan','left');
      $this->db->join('kol_golongan_pemeriksaan', 'kol_golongan_pemeriksaan.id_golongan_pemeriksaan=tindakan.id_golongan_pemeriksaan','left');
      $this->db->join('ol_unit', 'ol_unit.id_unit=tindakan_daftar.unit_pengirim','left');
      $this->db->join('kol_working', 'kol_working.id_working=ol_unit.id_instansi','left');
      if($lpd['tindakan']){
        $idtn = explode(',', $lpd['tindakan']);
        $this->db->where_in("tindakan.in_tindakan",$idtn);
      }
    }
    if($lhu == 7){
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_berkas.id_pegawai','left');
      $this->db->join('ol_berkas_kategori', 'ol_berkas_kategori.id_berkas_kategori=ol_berkas.id_kategori_berkas','left');
      $this->db->join('ol_kategori_pelatihan', 'ol_kategori_pelatihan.id_kategori_pelatihan=ol_berkas.id_kategori_pelatihan','left');
      $this->db->join('kol_pendidikan', 'kol_pendidikan.id_pendidikan=ol_berkas.id_pendidikan','left');
      if($lpd['berkas']){
        $idtn = explode(',', $lpd['berkas']);
        $this->db->where_in("id_berkas",$idtn);
      }
    }
    if($lhu == 8){
      $this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=abs_even.barcode_pegawai','left');
      $this->db->join('ol_user', 'ol_user.id_pegawai=ol_pegawai.id_pegawai','left');
      if($lpd['even']){
        $idtn = explode(',', $lpd['even']);
        $this->db->where_in("coun_even",$idtn);
      }
    }
    if($grup){
      $this->db->group_by($grup);
    }
    $this->db->order_by($order,$asc);
    $q = $this->db->get_where($tabel,$kondisi)->result_array(); 
    //echo $this->db->last_query();die();
    //print_r($q);die();
    return $q;
    }
  function set_sumber_data($tabel,$select,$kondisi,$lhu,$grup=FALSE)
  {
    $this->db->select($select);
    if($lhu == 1){
      $this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
      $this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_logbook.id_logbooker','left');
    }
    if($lhu == 4){
      $this->db->join('ol_logbook_lhu', 'ol_logbook_lhu.id_lhu=ol_logbook_lhu_detil.id_lhu','left');
      $this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=ol_logbook_lhu.barcode_pegawai','left');
      $this->db->join('ol_logbook_item_lhu', 'ol_logbook_item_lhu.id_item_lhu=ol_logbook_lhu_detil.id_item_lhu','left');
      $this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_logbook_item_lhu.id_equipment','left');
      $this->db->join('ol_unit', 'ol_unit.id_unit=ol_equipment.id_unit','left');
      $this->db->join('kol_working', 'kol_working.id_working=ol_unit.id_instansi','left');
    }
    if($lhu == 5){
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=tindakan_daftar.pendaftar','left');
      $this->db->join('tindakan', 'tindakan.id_tindakan=tindakan_daftar.id_tindakan','left');
      $this->db->join('kol_golongan_pemeriksaan', 'kol_golongan_pemeriksaan.id_golongan_pemeriksaan=tindakan.id_golongan_pemeriksaan','left');
      $this->db->join('ol_unit', 'ol_unit.id_unit=tindakan_daftar.unit_pengirim','left');
      $this->db->join('kol_working', 'kol_working.id_working=ol_unit.id_instansi','left');
    }
    if($lhu == 7){
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_berkas.id_pegawai','left');
      $this->db->join('ol_berkas_kategori', 'ol_berkas_kategori.id_berkas_kategori=ol_berkas.id_kategori_berkas','left');
      $this->db->join('ol_kategori_pelatihan', 'ol_kategori_pelatihan.id_kategori_pelatihan=ol_berkas.id_kategori_pelatihan','left');
      $this->db->join('kol_pendidikan', 'kol_pendidikan.id_pendidikan=ol_berkas.id_pendidikan','left');
    }
    if($lhu == 8){
      $this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=abs_even.barcode_pegawai','left');
      $this->db->join('ol_user', 'ol_user.id_pegawai=ol_pegawai.id_pegawai','left');
    }
    if($grup){
      $this->db->group_by($grup);
    }
    $q = $this->db->get_where($tabel,$kondisi)->result_array(); 
    //  echo $this->db->last_query();die();
    //print_r($q);die();
    return $q;
    }
  function set_isi_sumber_data($id,$tabel,$select,$kondisi,$lhu,$order,$asc,$grup=FALSE)
  {
    $lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
    $this->db->select($select);
    if($lhu == 1){
      $this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
      $this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_logbook.id_logbooker','left');
      if($lpd['kompetensi']){
        $idx = explode(',', $lpd['kompetensi']);
        $this->db->where_in("nkr_kompetensi.coun_kompetensi",$idx);
      }
    }
    if($lhu == 4){
      $this->db->join('ol_logbook_lhu', 'ol_logbook_lhu.id_lhu=ol_logbook_lhu_detil.id_lhu','left');
      $this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=ol_logbook_lhu.barcode_pegawai','left');
      $this->db->join('ol_logbook_item_lhu', 'ol_logbook_item_lhu.id_item_lhu=ol_logbook_lhu_detil.id_item_lhu','left');
      $this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_logbook_item_lhu.id_equipment','left');
      $this->db->join('ol_unit', 'ol_unit.id_unit=ol_equipment.id_unit','left');
      $this->db->join('kol_working', 'kol_working.id_working=ol_unit.id_instansi','left');
      if($lpd['item_lhu']){
        $idx = explode(',', $lpd['item_lhu']);
        $this->db->where_in("ol_logbook_item_lhu.in_item_lhu",$idx);
      }
    }
    if($lhu == 5){
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=tindakan_daftar.pendaftar','left');
      $this->db->join('tindakan', 'tindakan.id_tindakan=tindakan_daftar.id_tindakan','left');
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=tindakan_daftar.pendaftar','left');
      $this->db->join('kol_golongan_pemeriksaan', 'kol_golongan_pemeriksaan.id_golongan_pemeriksaan=tindakan.id_golongan_pemeriksaan','left');
      $this->db->join('ol_unit', 'ol_unit.id_unit=tindakan_daftar.unit_pengirim','left');
      $this->db->join('kol_working', 'kol_working.id_working=ol_unit.id_instansi','left');
      if($lpd['tindakan']){
        $idtn = explode(',', $lpd['tindakan']);
        $this->db->where_in("tindakan.in_tindakan",$idtn);
      }
    }
    if($lhu == 7){
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_berkas.id_pegawai','left');
      $this->db->join('ol_berkas_kategori', 'ol_berkas_kategori.id_berkas_kategori=ol_berkas.id_kategori_berkas','left');
      $this->db->join('ol_kategori_pelatihan', 'ol_kategori_pelatihan.id_kategori_pelatihan=ol_berkas.id_kategori_pelatihan','left');
      $this->db->join('kol_pendidikan', 'kol_pendidikan.id_pendidikan=ol_berkas.id_pendidikan','left');
    //  if($lpd['berkas']){
        $idtn = explode(',', $lpd['berkas']);
        $this->db->where_in("id_berkas",$idtn);
    //  }
    }
    if($lhu == 8){
      $this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=abs_even.barcode_pegawai','left');
      $this->db->join('ol_user', 'ol_user.id_pegawai=ol_pegawai.id_pegawai','left');
      if($lpd['even']){
        $idtn = explode(',', $lpd['even']);
        $this->db->where_in("coun_even",$idtn);
      }
    }
    if($grup){
      $this->db->group_by($grup);
    }
    $this->db->order_by($order,$asc);
    $q = $this->db->get_where($tabel,$kondisi)->result_array(); 
    //echo $this->db->last_query();die();
    //print_r($q);die();
    return $q;
    }
    function jumlah_sumber_data($id,$tabel,$kondisi,$lhu)
    {
      $lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
    if($lhu == 1){
      $this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
      $this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_logbook.id_logbooker','left');
      if($lpd['kompetensi']){
        $idk = explode(',', $lpd['kompetensi']);
        $this->db->where_in("nkr_kompetensi.coun_kompetensi",$idk);
      }
      if($lpd['isi_kompetensi']){
        $idlb = explode(',', $lpd['isi_kompetensi']);
        $this->db->where_in("ol_logbook.coun_logbook",$idlb);
      }
    }
    if($lhu == 4){
      $this->db->join('ol_logbook_lhu', 'ol_logbook_lhu.id_lhu=ol_logbook_lhu_detil.id_lhu','left');
      $this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=ol_logbook_lhu.barcode_pegawai','left');
      $this->db->join('ol_logbook_item_lhu', 'ol_logbook_item_lhu.id_item_lhu=ol_logbook_lhu_detil.id_item_lhu','left');
      $this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_logbook_item_lhu.id_equipment','left');
      $this->db->join('ol_unit', 'ol_unit.id_unit=ol_equipment.id_unit','left');
      $this->db->join('kol_working', 'kol_working.id_working=ol_unit.id_instansi','left');
      if($lpd['item_lhu'] || $lpd['qc_self'] == 0){
        $idx = explode(',', $lpd['item_lhu']);
        $this->db->where_in("ol_logbook_item_lhu.in_item_lhu",$idx);
      }
      if($lpd['i_mutu'] || $lpd['qc_self'] == 0){
        $idlb = explode(',', $lpd['i_mutu']);
        $this->db->where_in("ol_logbook_lhu_detil.coun_lhu_detil",$idlb);
      }
    }
    if($lhu == 5){
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=tindakan_daftar.pendaftar','left');
      $this->db->join('tindakan', 'tindakan.id_tindakan=tindakan_daftar.id_tindakan','left');
      $this->db->join('kol_golongan_pemeriksaan', 'kol_golongan_pemeriksaan.id_golongan_pemeriksaan=tindakan.id_golongan_pemeriksaan','left');
      $this->db->join('ol_unit', 'ol_unit.id_unit=tindakan_daftar.unit_pengirim','left');
      $this->db->join('kol_working', 'kol_working.id_working=ol_unit.id_instansi','left');
      if($lpd['tindakan']){
        $idtn = explode(',', $lpd['tindakan']);
        $this->db->where_in("tindakan.in_tindakan",$idtn);
      }
    }
    if($lhu == 7){
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_berkas.id_pegawai','left');
      $this->db->join('ol_berkas_kategori', 'ol_berkas_kategori.id_berkas_kategori=ol_berkas.id_kategori_berkas','left');
      $this->db->join('ol_kategori_pelatihan', 'ol_kategori_pelatihan.id_kategori_pelatihan=ol_berkas.id_kategori_pelatihan','left');
      $this->db->join('kol_pendidikan', 'kol_pendidikan.id_pendidikan=ol_berkas.id_pendidikan','left');
      if($lpd['berkas']){
        $idtn = explode(',', $lpd['berkas']);
        $this->db->where_in("id_berkas",$idtn);
      }
    }
    if($lhu == 8){
      $this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=abs_even.barcode_pegawai','left');
      $this->db->join('ol_user', 'ol_user.id_pegawai=ol_pegawai.id_pegawai','left');
      if($lpd['even']){
        $idtn = explode(',', $lpd['even']);
        $this->db->where_in("coun_even",$idtn);
      }
    }
        $query = $this->db->select("COUNT(*) as num")->get_where($tabel,$kondisi);
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
    }
  function total_sumber_data($id,$tabel,$select,$kondisi,$lhu){
    $lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
    $this->db->select($select);
    if($lhu == 1){
      $this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
      $this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_logbook.id_logbooker','left');
      if($lpd['kompetensi']){
        $idx = explode(',', $lpd['kompetensi']);
        $this->db->where_in("nkr_kompetensi.coun_kompetensi",$idx);
      }
    }
    if($lhu == 4){
      $this->db->join('ol_logbook_lhu', 'ol_logbook_lhu.id_lhu=ol_logbook_lhu_detil.id_lhu','left');
      $this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=ol_logbook_lhu.barcode_pegawai','left');
      $this->db->join('ol_logbook_item_lhu', 'ol_logbook_item_lhu.id_item_lhu=ol_logbook_lhu_detil.id_item_lhu','left');
      $this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_logbook_item_lhu.id_equipment','left');
      $this->db->join('ol_unit', 'ol_unit.id_unit=ol_equipment.id_unit','left');
      $this->db->join('kol_working', 'kol_working.id_working=ol_unit.id_instansi','left');
      if($lpd['item_lhu'] || $lpd['qc_self'] == 0){
        $idx = explode(',', $lpd['item_lhu']);
        $this->db->where_in("ol_logbook_item_lhu.in_item_lhu",$idx);
      }
    }
    if($lhu == 5){
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=tindakan_daftar.pendaftar','left');
      $this->db->join('tindakan', 'tindakan.id_tindakan=tindakan_daftar.id_tindakan','left');
      $this->db->join('kol_golongan_pemeriksaan', 'kol_golongan_pemeriksaan.id_golongan_pemeriksaan=tindakan.id_golongan_pemeriksaan','left');
      $this->db->join('ol_unit', 'ol_unit.id_unit=tindakan_daftar.unit_pengirim','left');
      $this->db->join('kol_working', 'kol_working.id_working=ol_unit.id_instansi','left');
      if(!empty($lpd['tindakan'])){
        $idtn = explode(',', $lpd['tindakan']);
        $this->db->where_in("tindakan.in_tindakan",$idtn);
      }
    }
    if($lhu == 7){
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_berkas.id_pegawai','left');
      $this->db->join('ol_berkas_kategori', 'ol_berkas_kategori.id_berkas_kategori=ol_berkas.id_kategori_berkas','left');
      $this->db->join('ol_kategori_pelatihan', 'ol_kategori_pelatihan.id_kategori_pelatihan=ol_berkas.id_kategori_pelatihan','left');
      $this->db->join('kol_pendidikan', 'kol_pendidikan.id_pendidikan=ol_berkas.id_pendidikan','left');
      if($lpd['berkas']){
        $idtn = explode(',', $lpd['berkas']);
        $this->db->where_in("id_berkas",$idtn);
      }
    }
    if($lhu == 8){
      $this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=abs_even.barcode_pegawai','left');
      $this->db->join('ol_user', 'ol_user.id_pegawai=ol_pegawai.id_pegawai','left');
      if($lpd['even']){
        $idtn = explode(',', $lpd['even']);
        $this->db->where_in("coun_even",$idtn);
      }
    }
    $q = $this->db->get_where($tabel,$kondisi);
    return $q->result_array();
  }
  function get_min($id,$tabel,$field,$kondisi,$lhu){
    $lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
    if($lhu == 1){
      $this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
      $this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_logbook.id_logbooker','left');
      if($lpd['kompetensi']){
        $idx = explode(',', $lpd['kompetensi']);
        $this->db->where_in("nkr_kompetensi.coun_kompetensi",$idx);
      }
    }
    if($lhu == 4){
      $this->db->join('ol_logbook_lhu', 'ol_logbook_lhu.id_lhu=ol_logbook_lhu_detil.id_lhu','left');
      $this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=ol_logbook_lhu.barcode_pegawai','left');
      $this->db->join('ol_logbook_item_lhu', 'ol_logbook_item_lhu.id_item_lhu=ol_logbook_lhu_detil.id_item_lhu','left');
      $this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_logbook_item_lhu.id_equipment','left');
      $this->db->join('ol_unit', 'ol_unit.id_unit=ol_equipment.id_unit','left');
      $this->db->join('kol_working', 'kol_working.id_working=ol_unit.id_instansi','left');
      if($lpd['item_lhu'] || $lpd['qc_self'] == 0){
        $idx = explode(',', $lpd['item_lhu']);
        $this->db->where_in("ol_logbook_item_lhu.in_item_lhu",$idx);
      }
    }
    if($lhu == 5){
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=tindakan_daftar.pendaftar','left');
      $this->db->join('tindakan', 'tindakan.id_tindakan=tindakan_daftar.id_tindakan','left');
      $this->db->join('kol_golongan_pemeriksaan', 'kol_golongan_pemeriksaan.id_golongan_pemeriksaan=tindakan.id_golongan_pemeriksaan','left');
      $this->db->join('ol_unit', 'ol_unit.id_unit=tindakan_daftar.unit_pengirim','left');
      $this->db->join('kol_working', 'kol_working.id_working=ol_unit.id_instansi','left');
      if(!empty($lpd['tindakan'])){
        $idtn = explode(',', $lpd['tindakan']);
        $this->db->where_in("tindakan.in_tindakan",$idtn);
      }
    }
    if($lhu == 7){
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_berkas.id_pegawai','left');
      $this->db->join('ol_berkas_kategori', 'ol_berkas_kategori.id_berkas_kategori=ol_berkas.id_kategori_berkas','left');
      $this->db->join('ol_kategori_pelatihan', 'ol_kategori_pelatihan.id_kategori_pelatihan=ol_berkas.id_kategori_pelatihan','left');
      $this->db->join('kol_pendidikan', 'kol_pendidikan.id_pendidikan=ol_berkas.id_pendidikan','left');
      if($lpd['berkas']){
        $idtn = explode(',', $lpd['berkas']);
        $this->db->where_in("id_berkas",$idtn);
      }
    }
    if($lhu == 8){
      $this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=abs_even.barcode_pegawai','left');
      $this->db->join('ol_user', 'ol_user.id_pegawai=ol_pegawai.id_pegawai','left');
      if($lpd['even']){
        $idtn = explode(',', $lpd['even']);
        $this->db->where_in("coun_even",$idtn);
      }
    }
    $query = $this->db->select("MIN(".$field.") as num")->get_where($tabel,$kondisi);
      $result = $query->row();
      if(isset($result))
        return $result->num;
      return 0;
  }
  function get_max($id,$tabel,$field,$kondisi,$lhu){
    $lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
    if($lhu == 1){
      $this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
      $this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_logbook.id_logbooker','left');
      if($lpd['kompetensi']){
        $idx = explode(',', $lpd['kompetensi']);
        $this->db->where_in("nkr_kompetensi.coun_kompetensi",$idx);
      }
    }
    if($lhu == 4){
      $this->db->join('ol_logbook_lhu', 'ol_logbook_lhu.id_lhu=ol_logbook_lhu_detil.id_lhu','left');
      $this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=ol_logbook_lhu.barcode_pegawai','left');
      $this->db->join('ol_logbook_item_lhu', 'ol_logbook_item_lhu.id_item_lhu=ol_logbook_lhu_detil.id_item_lhu','left');
      $this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_logbook_item_lhu.id_equipment','left');
      $this->db->join('ol_unit', 'ol_unit.id_unit=ol_equipment.id_unit','left');
      $this->db->join('kol_working', 'kol_working.id_working=ol_unit.id_instansi','left');
      if($lpd['item_lhu'] || $lpd['qc_self'] == 0){
        $idx = explode(',', $lpd['item_lhu']);
        $this->db->where_in("ol_logbook_item_lhu.in_item_lhu",$idx);
      }
    }
    if($lhu == 5){
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=tindakan_daftar.pendaftar','left');
      $this->db->join('tindakan', 'tindakan.id_tindakan=tindakan_daftar.id_tindakan','left');
      $this->db->join('kol_golongan_pemeriksaan', 'kol_golongan_pemeriksaan.id_golongan_pemeriksaan=tindakan.id_golongan_pemeriksaan','left');
      $this->db->join('ol_unit', 'ol_unit.id_unit=tindakan_daftar.unit_pengirim','left');
      $this->db->join('kol_working', 'kol_working.id_working=ol_unit.id_instansi','left');
      if(!empty($lpd['tindakan'])){
        $idtn = explode(',', $lpd['tindakan']);
        $this->db->where_in("tindakan.in_tindakan",$idtn);
      }
    }
    if($lhu == 7){
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_berkas.id_pegawai','left');
      $this->db->join('ol_berkas_kategori', 'ol_berkas_kategori.id_berkas_kategori=ol_berkas.id_kategori_berkas','left');
      $this->db->join('ol_kategori_pelatihan', 'ol_kategori_pelatihan.id_kategori_pelatihan=ol_berkas.id_kategori_pelatihan','left');
      $this->db->join('kol_pendidikan', 'kol_pendidikan.id_pendidikan=ol_berkas.id_pendidikan','left');
      if($lpd['berkas']){
        $idtn = explode(',', $lpd['berkas']);
        $this->db->where_in("id_berkas",$idtn);
      }
    }
    if($lhu == 8){
      $this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=abs_even.barcode_pegawai','left');
      $this->db->join('ol_user', 'ol_user.id_pegawai=ol_pegawai.id_pegawai','left');
      if($lpd['even']){
        $idtn = explode(',', $lpd['even']);
        $this->db->where_in("coun_even",$idtn);
      }
    }
    $query = $this->db->select("MAX(".$field.") as num")->get_where($tabel,$kondisi);
      $result = $query->row();
      if(isset($result))
        return $result->num;
      return 0;
  }
*/