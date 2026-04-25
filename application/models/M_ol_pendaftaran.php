<?php
class M_ol_pendaftaran extends CI_model{
  function golongan_pemeriksaan_all()
  {
    $ids = explode(',', $this->session->mas_unit);
    $fields = "*,concat(nama_golongan_pemeriksaan,' - [ ',nama_unit,' ]') as nama_golongan_pemeriksaan";
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
        default: $nmf=$k['data'];
        }
        $this->db->or_like($nmf, $cari['value'],'both',false);
        $this->db->where_in('ou.coun_unit',$ids);
      }
      }
    }
    $this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

    $this->db->from('kol_golongan_pemeriksaan kg');
    $this->db->join('ol_unit ou', 'ou.id_unit=kg.id_unit','left');
    $this->db->where_in('ou.coun_unit',$ids);

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
        $this->db->where_in('ou.coun_unit',$ids);
      }
      }
    }

    $this->db->from('kol_golongan_pemeriksaan kg');
    $this->db->join('ol_unit ou', 'ou.id_unit=kg.id_unit','left');
    $this->db->where_in('ou.coun_unit',$ids);

    $q = $this->db->get_where(); //04 Execute
    $jml_filter = $q->row()->num; //05 Hasil

  //--------- Query jumlah All data paling banyak -----
  //  $kondisi=array('id_unit'=>$this->session->unit);
 //   $jml = $this->m_umum->jumlah_record_filter('kol_dinas_jaga',$kondisi);    
    $jml = $this->m_umum->jumlah_record_tabel('kol_golongan_pemeriksaan');

    $output = array(
      "draw" => $draw,
        "recordsTotal" => $jml,
        "recordsFiltered" => $jml_filter,
        "data" => $list
    );
    // print_r($output);die();
    return $output;
  }
  function simpan_kategori(){
    $kode = $this->m_rancak->kode_generator_urut(15,'TN');
    $data_pendaftaran = array(
      'nama_golongan_pemeriksaan' => $this->input->post('nama_golongan_pemeriksaan'),
      'id_unit' => $this->input->post('id_unit'),
      'status_golongan_pemeriksaan' => $this->input->post('status_golongan_pemeriksaan')
    );
    $this->db->insert('kol_golongan_pemeriksaan', $data_pendaftaran);
    return $kode;
  }
  function edit_kategori(){
    $id_golongan_pemeriksaan = $this->input->post('id_golongan_pemeriksaan');
    $data_pendaftaran = array(
      'nama_golongan_pemeriksaan' => $this->input->post('nama_golongan_pemeriksaan'),
      'id_unit' => $this->input->post('id_unit'),
      'status_golongan_pemeriksaan' => $this->input->post('status_golongan_pemeriksaan')
    );
    $this->db->where('id_golongan_pemeriksaan',$id_golongan_pemeriksaan);
    $this->db->update('kol_golongan_pemeriksaan', $data_pendaftaran);
    //echo $this->db->last_query();
    $this->db->trans_complete();  // untuk cek sukses update tidak
    if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
    // if (!$this->db->affected_rows()) 
      return(FALSE);
    else 
      return(TRUE); 
  }
  function tindakan_all()
  {
    $ids = explode(',', $this->session->mas_unit);
    $fields = "*,concat(nama_kewenangan,' - [ ',nama_kompetensi,' ]') as nama_kewenangan,FORMAT(tarif,'#,###,##0') as tarif";
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
        default: $nmf=$k['data'];
        }
        $this->db->or_like($nmf, $cari['value'],'both',false);
        $this->db->where_in('ou.coun_unit',$ids);
      }
      }
    }
    $this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

    $this->db->from('tindakan t');
    $this->db->join('kol_golongan_pemeriksaan kg', 'kg.id_golongan_pemeriksaan=t.id_golongan_pemeriksaan','left');
    $this->db->join('nkr_kewenangan nkw', 'nkw.id_kewenangan=t.id_kewenangan','left');
    $this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkw.id_kompetensi','left');
    $this->db->join('tindakan_tarif tt', 'tt.id_tindakan=t.id_tindakan','left');
    $this->db->join('ol_unit ou', 'ou.id_unit=kg.id_unit','left');
    $this->db->where_in('ou.coun_unit',$ids);

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
        $this->db->where_in('ou.coun_unit',$ids);
      }
      }
    }

  //  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
    $this->db->from('tindakan t');
    $this->db->join('kol_golongan_pemeriksaan kg', 'kg.id_golongan_pemeriksaan=t.id_golongan_pemeriksaan','left');
    $this->db->join('nkr_kewenangan nkw', 'nkw.id_kewenangan=t.id_kewenangan','left');
    $this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkw.id_kompetensi','left');
    $this->db->join('tindakan_tarif tt', 'tt.id_tindakan=t.id_tindakan','left');
    $this->db->join('ol_unit ou', 'ou.id_unit=kg.id_unit','left');
    $this->db->where_in('ou.coun_unit',$ids);

    $q = $this->db->get_where(); //04 Execute
    $jml_filter = $q->row()->num; //05 Hasil

  //--------- Query jumlah All data paling banyak -----
  //  $kondisi=array('id_unit'=>$this->session->unit);
 //   $jml = $this->m_umum->jumlah_record_filter('kol_dinas_jaga',$kondisi);    
    $jml = $this->m_umum->jumlah_record_tabel('tindakan');

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
    $kode = $this->m_rancak->kode_generator_urut(15,'TN');
    $data_pendaftaran = array(
      'id_tindakan' => $kode,
      'pembuat_tindakan' => $this->session->id_pegawai,
      'nama_tindakan' => $this->input->post('nama_tindakan'),
      'id_golongan_pemeriksaan' => $this->input->post('id_golongan_pemeriksaan'),
      'status_tindakan' => $this->input->post('status_tindakan')
    );
    $this->db->insert('tindakan', $data_pendaftaran);
    return $kode;
  }
  function cek_tarif($id){
    $tarif = $this->input->post('tarif');
    $tarif  = str_replace("'","&acute;",$tarif);
    $tarif  = str_replace(".","",$tarif);
    $tarif  = str_replace(" ","",$tarif);
    $tarif  = str_replace(",","",$tarif);
    $kondisi = array('id_tindakan'=>$id);
    $jml = $this->m_umum->jumlah_record_filter('tindakan_tarif',$kondisi);
    if($jml == 0){
      $this->simpan_tt($id,$tarif);
    }else{
      $this->edit_tt($id,$tarif);
    }
  }
  function simpan_tt($id,$tarif){
    $kode = $this->m_rancak->kode_generator_urut(15,'TT');
    $data_pendaftaran = array(
      'tarif' => $tarif,
      'id_tindakan' => $id,
      'id_tarif' => $kode     );
    $this->db->insert('tindakan_tarif', $data_pendaftaran); 
  }
  function edit_tt($id,$tarif){
      $data_pendaftaran = array(
        'tarif' => $tarif
      );
      $this->db->where('id_tindakan',$id);
      $this->db->update('tindakan_tarif', $data_pendaftaran);
    //echo $this->db->last_query();
    $this->db->trans_complete();  // untuk cek sukses update tidak
    if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
    // if (!$this->db->affected_rows()) 
      return(FALSE);
    else 
      return(TRUE); 
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
    $this->db->trans_complete();  // untuk cek sukses update tidak
    if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
    // if (!$this->db->affected_rows()) 
      return(FALSE);
    else 
      return(TRUE); 
  }
  function pendaftaran_all($first_date,$last_date,$key)
  {
    $mas_unit = explode(",", $this->session->mas_unit);
    $wordsAry = explode("-", $key);
    $wordsCount = count($wordsAry);
    $fields = "*,if (op.jk = '1' ,'Laki-laki','Perempuan') as jk,
CONCAT((TIMESTAMPDIFF( YEAR, op.tgl_lahir, tgl_transaksi )), ' Tahun ', 
TIMESTAMPDIFF( MONTH, op.tgl_lahir, tgl_transaksi ) % 12, ' Bulan ',
FLOOR( TIMESTAMPDIFF( DAY, op.tgl_lahir, tgl_transaksi ) % 30.4375 ), ' Hari') as umur,op.alamat as alamat,
ou2.nama_unit as unit_tindakan,ou.nama_unit as nama_unit,
if(status_transaksi = 0,'Pendaftaran','Selesai') as status_transaksi,
concat('[RM : ',rm,'] - Nama : ',nama_pasien) as nama_pasien,
DATE_FORMAT(tgl_transaksi,'%d-%m-%Y') as tgl_transaksi,tgl_transaksi as tgl_sortir,
DATE_FORMAT(wkt_transaksi,'%d-%m-%Y %H:%i:%s') as wkt_transaksi,FORMAT(harga_transaksi,'#,###,##0') as harga_transaksi,
nama_tindakan,id_transaksi
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
    $this->db->where('tgl_transaksi BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
    $this->db->where('find_in_set(ou2.coun_unit, "'.$this->session->mas_unit.'") != 0');
  //  $this->db->where_in('ou2.coun_unit',$mas_unit);
    if(!empty($key) || $this->input->post('key',true)){
      $this->db->group_start();
      for($i=0;$i<$wordsCount;$i++) {
        $this->db->or_where("(nama_pasien LIKE '%".$wordsAry[$i]."%' OR rm LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
      }
      $this->db->group_end();
    }
      }
      }
    }
    $this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

      $this->db->from('tindakan_transaksi td');
      $this->db->join('tindakan t', 't.id_tindakan=td.id_tindakan','left');
      $this->db->join('ol_pasien op', 'op.id_pasien=td.id_pasien','left');
    $this->db->join('ol_unit ou', 'ou.id_unit=td.id_unit','left');
    $this->db->join('ol_unit ou2', 'ou2.id_unit=td.unit_tindakan','left');
    $this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=td.admin_transaksi','left');
    $this->db->where('tgl_transaksi BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
    $this->db->where('find_in_set(ou2.coun_unit, "'.$this->session->mas_unit.'") != 0');
  //  $this->db->where_in('ou2.coun_unit',$mas_unit);
    if(!empty($key) || $this->input->post('key',true)){
      $this->db->group_start();
      for($i=0;$i<$wordsCount;$i++) {
        $this->db->or_where("(nama_pasien LIKE '%".$wordsAry[$i]."%' OR rm LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
      }
      $this->db->group_end();
    }
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
    $this->db->where('tgl_transaksi BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
    $this->db->where('find_in_set(ou2.coun_unit, "'.$this->session->mas_unit.'") != 0');
  //  $this->db->where_in('ou2.coun_unit',$mas_unit);
    if(!empty($key) || $this->input->post('key',true)){
      $this->db->group_start();
      for($i=0;$i<$wordsCount;$i++) {
        $this->db->or_where("(nama_pasien LIKE '%".$wordsAry[$i]."%' OR rm LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
      }
      $this->db->group_end();
    }
      }
      }
    }

      $this->db->from('tindakan_transaksi td');
      $this->db->join('tindakan t', 't.id_tindakan=td.id_tindakan','left');
    $this->db->join('ol_pasien op', 'op.id_pasien=td.id_pasien','left');
    $this->db->join('ol_unit ou', 'ou.id_unit=td.id_unit','left');
    $this->db->join('ol_unit ou2', 'ou2.id_unit=td.unit_tindakan','left');
    $this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=td.admin_transaksi','left');
    $this->db->where('tgl_transaksi BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
    $this->db->where('find_in_set(ou2.coun_unit, "'.$this->session->mas_unit.'") != 0');
  //  $this->db->where_in('ou2.coun_unit',$mas_unit);
    if(!empty($key) || $this->input->post('key',true)){
      $this->db->group_start();
      for($i=0;$i<$wordsCount;$i++) {
        $this->db->or_where("(nama_pasien LIKE '%".$wordsAry[$i]."%' OR rm LIKE '%".$wordsAry[$i]."%')", NULL, FALSE);
      }
      $this->db->group_end();
    }

    $q = $this->db->get_where(); //04 Execute
  //  echo $this->db->last_query();
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
  function simpan_pendaftaran(){
    $kode = $this->m_rancak->kode_generator_urut(15,'TP');
    $id_tindakan = $this->input->post('id_tindakan');
    $rm = $this->input->post('rm');
    $tin = $this->m_umum->ambil_data('tindakan','id_tindakan',$id_tindakan);
    $px = $this->m_umum->ambil_data('ol_pasien','rm',$rm);
    $kondisi = array('rm'=>$rm);
    $kondisi_trf = array('id_tindakan'=>$id_tindakan,'status_tarif'=>1);
    $jml_trf = $this->m_umum->jumlah_record_filter('tindakan_tarif',$kondisi_trf);
    $tt = $this->m_umum->ambil_data_kondisi('tindakan_tarif',$kondisi_trf);
    $jml = $this->m_umum->jumlah_record_filter('ol_pasien',$kondisi);
    if($jml_trf == 0){
      $harga_transaksi = 0;
    }else{
      $harga_transaksi = $tt['tarif'];
    }
    if($jml == 0){
     $Q = $this->simpan_ol_pasien();
    }else{
      $this->rubah_ol_pasien();
    }
    if(empty($px)){
      $px = $Q;
    }else{
      $px = $px['id_pasien'];
    }
  //  $data_transaksi = '<b>Data Pengirim</b><br>Dokter Pengirim :<br><br><b>Data Penunjang</b><br>Ureum :<br>Creatinin :<br>';
    $tgl_transaksi = $this->input->post('tgl_transaksi');
    $tgl_transaksi = date('Y-m-d', strtotime($tgl_transaksi));
    $tgl_lahir = $this->input->post('tgl_lahir');
    $tgl_lahir = date('Y-m-d', strtotime($tgl_lahir));
    $data_kewenangan = array(
      'id_transaksi' => $kode,
      'id_pasien' => $px,
      'tgl_transaksi' => $tgl_transaksi,
      'id_tindakan' => $id_tindakan,
      'harga_transaksi' => $harga_transaksi,
 //     'data_transaksi' => $data_transaksi,
      'nama_transaksi' => $tin['nama_tindakan'],
      'no_transaksi'  => $this->input->post('no_transaksi'),
      'data_transaksi'  => $this->input->post('data_transaksi'),
      'id_unit' => $this->session->unit,
      'unit_tindakan' => $this->input->post('unit_tindakan'),
      'admin_transaksi' => $this->session->barcode_pegawai
    );
    $this->db->insert('tindakan_transaksi', $data_kewenangan);
    return $kode;
  }
  function edit_pendaftaran(){
    $id_transaksi = $this->input->post('id_transaksi');
    $id_tindakan = $this->input->post('id_tindakan');
    $rm = $this->input->post('rm');
    $px = $this->m_umum->ambil_data('ol_pasien','rm',$rm);
    $kondisi = array('rm'=>$rm);
    $jml = $this->m_umum->jumlah_record_filter('ol_pasien',$kondisi);
    if($jml == 0){
     $Q = $this->simpan_ol_pasien();
    }else{
      $this->rubah_ol_pasien();
    }
    if(empty($px)){
      $px = $Q;
    }else{
      $px = $px['id_pasien'];
    }
    $harga_transaksi = $this->input->post('harga_transaksi');
    $harga_transaksi  = str_replace("'","&acute;",$harga_transaksi);
    $harga_transaksi  = str_replace(".","",$harga_transaksi);
    $harga_transaksi  = str_replace(" ","",$harga_transaksi);
    $harga_transaksi  = str_replace(",","",$harga_transaksi);
    $tgl_transaksi = $this->input->post('tgl_transaksi');
    $tgl_transaksi = date('Y-m-d', strtotime($tgl_transaksi));
    $data_pendaftaran = array(
      'harga_transaksi' => $harga_transaksi,
      'tgl_transaksi' => $tgl_transaksi,
      'id_tindakan' => $id_tindakan,
      'id_pasien' => $px,
      'no_transaksi'  => $this->input->post('no_transaksi'),
      'unit_tindakan' => $this->input->post('unit_tindakan'),
      'data_transaksi' => $this->input->post('data_transaksi')
    );
    $this->db->where('id_transaksi',$id_transaksi);
    $this->db->update('tindakan_transaksi', $data_pendaftaran);
    //echo $this->db->last_query();
    $this->db->trans_complete();  // untuk cek sukses update tidak
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
      'alamat'  => $this->input->post('alamat'),
      'tgl_lahir'  => $tgl_lahir,
      'jk'  => $this->input->post('jk')
    );
    $this->db->insert('ol_pasien', $data_pendaftaran);
    return $kode;
  }
  function rubah_ol_pasien(){
    $id_pasien = $this->input->post('id_pasien');
    $tgl_lahir = $this->input->post('tgl_lahir');
    $tgl_lahir = date('Y-m-d', strtotime($tgl_lahir));
    $data_pendaftaran = array(
      'rm'  => $this->input->post('rm'),
      'nama_pasien'  => $this->input->post('nama_pasien'),
      'alamat'  => $this->input->post('alamat'),
      'tgl_lahir'  => $tgl_lahir,
      'jk'  => $this->input->post('jk')
    );
    $this->db->where('id_pasien',$id_pasien);
    $this->db->update('ol_pasien', $data_pendaftaran);
    //echo $this->db->last_query();
    $this->db->trans_complete();  // untuk cek sukses update tidak
    if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
    // if (!$this->db->affected_rows())
      return(FALSE);
    else
      return(TRUE);
  }
  function ambil_data_transaksi_pendaftaran($id)
  {
    $this->db->join('ol_pasien', 'ol_pasien.id_pasien=tindakan_transaksi.id_pasien','left');
    $this->db->join('tindakan', 'tindakan.id_tindakan=tindakan_transaksi.id_tindakan','left');
    $this->db->join('kol_golongan_pemeriksaan', 'kol_golongan_pemeriksaan.id_golongan_pemeriksaan=tindakan.id_golongan_pemeriksaan','left');
    $this->db->join('ol_unit', 'ol_unit.id_unit=tindakan_transaksi.unit_tindakan','left');
    $this->db->join('kol_working', 'kol_working.id_working=ol_unit.id_instansi','left');
    $q = $this->db->get_where('tindakan_transaksi',array('tindakan_transaksi.id_transaksi'=>$id));
    return $q->row_array();
  }
  function ambil_data_transaksi_logbook_operator($id)
  {
    $this->db->join('ol_pasien', 'ol_pasien.id_pasien=tindakan_transaksi.id_pasien','left');
    $this->db->join('tindakan', 'tindakan.id_tindakan=tindakan_transaksi.id_tindakan','left');
    $this->db->join('kol_golongan_pemeriksaan', 'kol_golongan_pemeriksaan.id_golongan_pemeriksaan=tindakan.id_golongan_pemeriksaan','left');
    $this->db->join('ol_unit', 'ol_unit.id_unit=tindakan_transaksi.unit_tindakan','left');
    $this->db->join('kol_working', 'kol_working.id_working=ol_unit.id_instansi','left');
    $q = $this->db->get_where('tindakan_transaksi',array('tindakan_transaksi.id_transaksi'=>$id));
    return $q->row_array();
  }
  function simpan_kategori_barang(){
    $kode = $this->m_rancak->kode_generator_urut(15,'KB');
    $data_pendaftaran = array(
      'nama_kategori_barang' => $this->input->post('nama_kategori_barang'),
      'id_unit' => $this->input->post('id_unit'),
      'id_kategori_barang' => $kode,
      'pembuat_kategori_barang' => $this->session->barcode_pegawai,
      'status_kategori_barang' => $this->input->post('status_kategori_barang')
    );
    return $this->db->insert('tindakan_kategori_barang', $data_pendaftaran);
  }
  function rubah_kategori_barang(){
    $id_kategori_barang = $this->input->post('id_kategori_barang');
    $data_pendaftaran = array(
      'nama_kategori_barang' => $this->input->post('nama_kategori_barang'),
      'id_unit' => $this->input->post('id_unit'),
      'status_kategori_barang' => $this->input->post('status_kategori_barang')
    );
    $this->db->where('id_kategori_barang',$id_kategori_barang);
    $this->db->update('tindakan_kategori_barang', $data_pendaftaran);
    //echo $this->db->last_query();
    $this->db->trans_complete();  // untuk cek sukses update tidak
    if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
    // if (!$this->db->affected_rows())
      return(FALSE);
    else
      return(TRUE);
  }
  function simpan_barang(){
    $kode = $this->m_rancak->kode_generator_urut(15,'BR');
    $data_pendaftaran = array(
      'nama_barang' => $this->input->post('nama_barang'),
      'id_kategori_barang' => $this->input->post('id_kategori_barang'),
      'satuan_barang' => $this->input->post('satuan_barang'),
      'id_barang' => $kode,
      'pembuat_barang' => $this->session->barcode_pegawai,
      'status_barang' => $this->input->post('status_barang')
    );
    return $this->db->insert('tindakan_barang', $data_pendaftaran);
  }
  function rubah_barang(){
    $id_barang = $this->input->post('id_barang');
    $data_pendaftaran = array(
      'nama_barang' => $this->input->post('nama_barang'),
      'id_kategori_barang' => $this->input->post('id_kategori_barang'),
      'satuan_barang' => $this->input->post('satuan_barang'),
      'status_barang' => $this->input->post('status_barang')
    );
    $this->db->where('id_barang',$id_barang);
    $this->db->update('tindakan_barang', $data_pendaftaran);
    //echo $this->db->last_query();
    $this->db->trans_complete();  // untuk cek sukses update tidak
    if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
    // if (!$this->db->affected_rows())
      return(FALSE);
    else
      return(TRUE);
  }
  function input_stok($x=false){
    $id_barang = $this->input->post('id_barang');
    $kondisi_jml = array('id_barang'=>$id_barang);
    $jml = $this->m_umum->jumlah_record_filter('tindakan_stok',$kondisi_jml);
    if($jml == 0){
      $this->simpan_stok($x=false);
    }else{
   //   if($x !=='0'){
        $this->rubahtb_stok();        
  //    }
    }
  }
  function simpan_stok($x=false){
    $kode = $this->m_rancak->kode_generator_urut(15,'ST');
    if($x == '0'){
      $jml_stok = 0;
    }else{
      $jml_stok = $this->input->post('jml_stok');
    }
    $data_pendaftaran = array(
      'id_stok' => $kode,
      'id_barang' => $this->input->post('id_barang'),
      'jml_stok' => $this->input->post('jml_stok')
    );
    return $this->db->insert('tindakan_stok', $data_pendaftaran);
  }
  function rubahtb_stok(){
    $id_barang = $this->input->post('id_barang');
    $jml_stok = $this->input->post('jml_stok');
    $br = $this->m_umum->ambil_data('tindakan_stok','id_barang',$id_barang);
    $data_pendaftaran = array(
      'jml_stok' => $jml_stok + $br['jml_stok']
    );
    $this->db->where('id_barang',$id_barang);
    $this->db->update('tindakan_stok', $data_pendaftaran);
    //echo $this->db->last_query();
    $this->db->trans_complete();  // untuk cek sukses update tidak
    if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
    // if (!$this->db->affected_rows())
      return(FALSE);
    else
      return(TRUE);
  }
  function simpan_masuk(){
    $kode = $this->m_rancak->kode_generator_urut(15,'BM');
    $id_barang = $this->input->post('id_barang');
    $brg = $this->m_umum->ambil_data('tindakan_barang','id_barang',$id_barang);
    $data_pendaftaran = array(
      'id_masuk' => $kode,
      'id_barang' => $id_barang,
      'pembuat_masuk' => $this->session->barcode_pegawai,
      'nama_barang' => $brg['nama_barang'],
      'satuan_masuk' => $brg['satuan_barang'],
      'jml_masuk' => $this->input->post('jml_stok')
    );
    return $this->db->insert('tindakan_masuk', $data_pendaftaran);
  }
  function simpan_keluar(){
    $kode = $this->m_rancak->kode_generator_urut(15,'BK');
    $id_barang = $this->input->post('id_barang');
    $id_transaksi = $this->input->post('id_transaksi');
    $brg = $this->m_umum->ambil_data('tindakan_barang','id_barang',$id_barang);
    $data_pendaftaran = array(
      'id_keluar' => $kode,
      'id_barang' => $id_barang,
      'id_transaksi' => $id_transaksi,
      'admin_keluar' => $this->session->barcode_pegawai,
      'nama_barang' => $brg['nama_barang'],
      'satuan_keluar' => $brg['satuan_barang'],
      'jml_keluar' => $this->input->post('jml_stok')
    );
    return $this->db->insert('tindakan_keluar', $data_pendaftaran);
  }
  function simpan_hasil(){
    $kode = $this->m_rancak->kode_generator_urut(15,'TH');
    $data_pendaftaran = array(
      'id_hasil' => $kode,
      'pembuat_hasil' => $this->session->barcode_pegawai,
      'nama_hasil' => $this->input->post('nama_hasil'),
      'id_unit' => $this->input->post('id_unit'),
      'status_hasil' => $this->input->post('status_hasil')
    );
    return $this->db->insert('tindakan_hasil', $data_pendaftaran);
  }
  function rubah_hasil(){
    $id_hasil = $this->input->post('id_hasil');
    $data_pendaftaran = array(
      'nama_hasil' => $this->input->post('nama_hasil'),
      'id_unit' => $this->input->post('id_unit'),
      'status_hasil' => $this->input->post('status_hasil')
    );
    $this->db->where('id_hasil',$id_hasil);
    $this->db->update('tindakan_hasil', $data_pendaftaran);
    //echo $this->db->last_query();
    $this->db->trans_complete();  // untuk cek sukses update tidak
    if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
    // if (!$this->db->affected_rows())
      return(FALSE);
    else
      return(TRUE);
  }
  function simpan_fhasil(){
    $kode = $this->m_rancak->kode_generator_urut(15,'FH');
    $data_pendaftaran = array(
      'id_fhasil' => $kode,
      'pembuat_fhasil' => $this->session->barcode_pegawai,
      'id_hasil' => $this->input->post('id_hasil'),
      'nama_fhasil' => $this->input->post('nama_fhasil'),
      'format_fhasil' => $this->input->post('format_fhasil'),
      'status_fhasil' => $this->input->post('status_fhasil')
    );
    return $this->db->insert('tindakan_fhasil', $data_pendaftaran);
  }
  function rubah_fhasil(){
    $id_fhasil = $this->input->post('id_fhasil');
    $data_pendaftaran = array(
      'nama_fhasil' => $this->input->post('nama_fhasil'),
      'format_fhasil' => $this->input->post('format_fhasil'),
      'status_fhasil' => $this->input->post('status_fhasil')
    );
    $this->db->where('id_fhasil',$id_fhasil);
    $this->db->update('tindakan_fhasil', $data_pendaftaran);
    //echo $this->db->last_query();
    $this->db->trans_complete();  // untuk cek sukses update tidak
    if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
    // if (!$this->db->affected_rows())
      return(FALSE);
    else
      return(TRUE);
  }
  function simpan_operator(){
    $id_transaksi = $this->input->post('id_transaksi');
    $chk = $this->input->post('chk[]');
    if($chk){
      $jml_kode = count($chk);
      for ($i=0;$i<$jml_kode;$i++){
        $kondisi=array('admin_operator'=>$chk[$i],'id_transaksi'=>$id_transaksi);
        $jml = $this->m_umum->jumlah_record_filter('tindakan_operator',$kondisi);
          if($jml == 0){
            $kode = $this->m_rancak->kode_generator_urut(15,'TO');
            $data_pendaftaran2 = array(
              'id_operator' => $kode,
              'id_transaksi' => $id_transaksi,
              'admin_operator' => $chk[$i]
            );
            $this->db->insert('tindakan_operator', $data_pendaftaran2);
          }
      }
    }
  }
  function rubah_operator(){
    $id_operator = $this->input->post('id_operator');
    $data_pendaftaran = array(
      'admin_operator' => $this->input->post('admin_operator')
    );
    $this->db->where('id_operator',$id_operator);
    $this->db->update('tindakan_operator', $data_pendaftaran);
    //echo $this->db->last_query();
    $this->db->trans_complete();  // untuk cek sukses update tidak
    if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
    // if (!$this->db->affected_rows())
      return(FALSE);
    else
      return(TRUE);
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
        'id_logbooker' => $this->input->post('admin_operator')   
      );
    $this->db->insert('ol_logbook', $data_pendaftaran);
    return $kode;
  }
  function nyimpen_ol_logbook_pasien($id){
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
  function kewenangan_all($id)
  {
    $this->db->join('nkr_kompetensi okm', 'okm.id_kompetensi=ok.id_kompetensi','left');
    $this->db->join('jabatan', 'jabatan.id_jabatan=okm.id_jabatan','left');
    $this->db->where('okm.id_jabatan', $id);
  //  $this->db->where('okm.instansi_kompetensi', $this->session->refer);
    $q = $this->db->get_where('nkr_kewenangan ok');
    //print_r($q->row_array());
    return $q->result_array();
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
  function simpan_tindakan_keluar(){
    $kode = $this->m_rancak->kode_generator_urut(15,'TK');
    $jml_keluar = $this->input->post('jml_keluar');
    $id_barang = $this->input->post('id_barang');
    $kondisi = array('tindakan_stok.id_barang'=>$id_barang);
    $brg = $this->m_umum->ambil_data_kondisi_2tabel_row('tindakan_stok',$kondisi,'tindakan_barang','id_barang');
    $stoke = $brg['jml_stok'];
    if($stoke > $jml_keluar){
      $setoke = $stoke - $jml_keluar;
      $this->change_stok($setoke,$id_barang);
      $data_pendaftaran = array(
        'id_keluar' => $kode,
        'admin_keluar' => $this->session->barcode_pegawai,
        'id_barang' => $id_barang,
        'nama_keluar' => $brg['nama_barang'],
        'satuan_keluar' => $brg['satuan_barang'],
        'id_transaksi' => $this->input->post('id_transaksi'),
        'jml_keluar' => $jml_keluar
      );
      return $this->db->insert('tindakan_keluar', $data_pendaftaran);
    }
  }
  function change_stok($id,$id_barang){
    $data_pendaftaran = array(
        'jml_stok' => $id
    );
    $this->db->where('id_barang',$id_barang);
    $this->db->update('tindakan_stok', $data_pendaftaran);
    //echo $this->db->last_query();
    $this->db->trans_complete();  // untuk cek sukses update tidak
    if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
    // if (!$this->db->affected_rows())
      return(FALSE);
    else
      return(TRUE);
  }
  function rubah_tindakan_keluar(){
    $id_keluar = $this->input->post('id_keluar');
    //=================== barang lama
    $id_barang_lama = $this->input->post('id_barang_lama');
    $jml_keluar_lama = $this->input->post('jml_keluar_lama');
    $kondisip = array('tindakan_stok.id_barang'=>$id_barang_lama);
    $brgp = $this->m_umum->ambil_data_kondisi_2tabel_row('tindakan_stok',$kondisip,'tindakan_barang','id_barang');
    $stokp = $brgp['jml_stok'];
    //=================== barang baru
    $jml_keluar = $this->input->post('jml_keluar');
    $id_barang = $this->input->post('id_barang');
    $kondisi = array('tindakan_stok.id_barang'=>$id_barang);
    $brg = $this->m_umum->ambil_data_kondisi_2tabel_row('tindakan_stok',$kondisi,'tindakan_barang','id_barang');
    $stoke = $brg['jml_stok'];
    $stoktotal = $stokp + $jml_keluar_lama;
    $setoke = $stoke - $jml_keluar;
    if($id_barang_lama == $id_barang){
      if($stoktotal > $jml_keluar){
        $stoktotal = $stokp + $jml_keluar_lama - $jml_keluar;
        $this->change_stok($stoktotal,$id_barang_lama);
        $this->rubah_tkeluar($brg['nama_barang'],$brg['satuan_barang']);        
      }
    }else{
      if($stoke > $jml_keluar){
        $this->change_stok($setoke,$id_barang);
        $this->change_stok($stoktotal,$id_barang_lama);
        $this->rubah_tkeluar($brg['nama_barang'],$brg['satuan_barang']);
      }
    }
  }
  function rubah_tkeluar($nama_barang,$satuan_barang){
    $id_barang = $this->input->post('id_barang');
    $jml_keluar = $this->input->post('jml_keluar');
    $id_keluar = $this->input->post('id_keluar');
    $data_pendaftaran = array(
          'id_barang' => $id_barang,
          'nama_keluar' => $nama_barang,
          'satuan_keluar' => $satuan_barang,
          'jml_keluar' => $jml_keluar
    );
      $this->db->where('id_keluar',$id_keluar);
      $this->db->update('tindakan_keluar', $data_pendaftaran);
    //echo $this->db->last_query();
    $this->db->trans_complete();  // untuk cek sukses update tidak
    if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
    // if (!$this->db->affected_rows())
      return(FALSE);
    else
      return(TRUE);
  }
  function ambil_data_dropdown_fhasil($id)
  {
    return $this->db->get_where('tindakan_fhasil',array('id_hasil' => $id))->result_array();
  }
  function simpan_tindakan_kelengkapan(){
    $kode = $this->m_rancak->kode_generator_urut(15,'TK');
    $id_hasil = $this->input->post('id_hasil');
    $brg = $this->m_umum->ambil_data('tindakan_hasil','id_hasil',$id_hasil);
      $data_pendaftaran = array(
        'id_kelengkapan' => $kode,
        'admin_kelengkapan' => $this->session->barcode_pegawai,
        'id_transaksi' => $this->input->post('id_transaksi'),
        'hasil_kelengkapan' => $this->input->post('hasil_kelengkapan'),
        'id_hasil' => $id_hasil,
        'nama_hasil' => $brg['nama_hasil']
      );
      return $this->db->insert('tindakan_kelengkapan', $data_pendaftaran);
  }
  function edit_tindakan_kelengkapan(){
    $id_kelengkapan = $this->input->post('id_kelengkapan');
    $id_hasil = $this->input->post('id_hasil');
    $brg = $this->m_umum->ambil_data('tindakan_hasil','id_hasil',$id_hasil);
    $data_pendaftaran = array(
        'hasil_kelengkapan' => $this->input->post('hasil_kelengkapan'),
        'id_hasil' => $id_hasil,
        'nama_hasil' => $brg['nama_hasil']
    );
      $this->db->where('id_kelengkapan',$id_kelengkapan);
      $this->db->update('tindakan_kelengkapan', $data_pendaftaran);
    //echo $this->db->last_query();
    $this->db->trans_complete();  // untuk cek sukses update tidak
    if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
    // if (!$this->db->affected_rows())
      return(FALSE);
    else
      return(TRUE);
  }
  function rubah_status_transaksi($id_transaksi,$id){
    $data_pendaftaran = array(
      'status_transaksi'  => $id,
    );
    $this->db->where('id_transaksi',$id_transaksi);
    $this->db->update('tindakan_transaksi', $data_pendaftaran);
    //echo $this->db->last_query();
    $this->db->trans_complete();  // untuk cek sukses update tidak
    if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
    // if (!$this->db->affected_rows())
      return(FALSE);
    else
      return(TRUE);
  }
}