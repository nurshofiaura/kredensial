<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');
class Ol_laporan extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
          $this->load->model('m_ol_rancak');
          $this->load->model('m_ol_laporan');
          $this->load->model('m_auth');
          $this->m_auth->hak_member();
          //$this->m_auth->hak_member();
  }
  function index(){
    $data['page']="home";
    $data['header'] = "BERANDA";
    $data['title'] = "BERANDA";
    $data['link_kembali'] = base_url('member');
    $data['link_awal'] = base_url('ol_logbook/logbook');
    $pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
//    $program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
    $instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
/*    $data['multi_level'] = $this->m_ol_rancak->ambil_data_link_pengurus($this->session->id_pegawai);
    $data['ol_akses'] = $this->m_ol_rancak->ol_akses($this->session->id_pegawai);*/
    $data['ambil_data_a_online'] = $this->m_ol_rancak->ambil_data_a_online();
    $data['ambil_data_instansi'] = $this->m_ol_rancak->ambil_data_instansi();
    $data['ambil_data_instansi_null'] = $this->m_ol_rancak->ambil_data_instansi_null();
    $data['instance_id'] = $instansi["id_instansi"];
    $data['instance_name'] = $instansi["nama_instansi"];
    $data['idescription'] = $instansi["description"];
    $data['ikeywords'] = $instansi["keywords"];
    $data['iheader'] = $instansi["header"];
    $data['iheader_mini'] = $instansi["header_mini"];
    $data['ifooter'] = $instansi["footer"];
    $data['ilicensed'] = $instansi["licensed"];
    $data['member_id'] = $pegawai["id_pegawai"];
    $data['member_name'] = $pegawai["nama_pegawai"];
    $data['level_name'] = $pegawai["nama_level"];
    $data['photo'] = $pegawai["foto"];    
    //======================= IMPORTANT =========================================
    $this->laporan();
  }
  function laporan($mode='view'){
    $data['page']="laporan"; 
    $data['header'] = "DATA LAPORAN";
    $data['title'] = "DATA LAPORAN";
    $data['link_awal'] = base_url('ol_laporan/laporan');
    $data['link_item'] = base_url('member/item_mutu');
    $pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
    $instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
    $data['instance_id'] = $instansi["id_instansi"];
    $data['instance_name'] = $instansi["nama_instansi"];
    $data['idescription'] = $instansi["description"];
    $data['ikeywords'] = $instansi["keywords"];
    $data['iheader'] = $instansi["header"];
    $data['iheader_mini'] = $instansi["header_mini"];
    $data['ifooter'] = $instansi["footer"];
    $data['ilicensed'] = $instansi["licensed"];
    $data['member_id'] = $pegawai["id_pegawai"];
    $data['member_name'] = $pegawai["nama_pegawai"];
    $data['level_name'] = $pegawai["nama_level"];
    $data['photo'] = $pegawai["foto"];      
    //======================= IMPORTANT =========================================
    $data['all_kah'] = array('0'=>'Range Tanggal','1'=>'Semua');
    $data['ambil_punit_nonull'] = $this->m_ol_rancak->ambil_punit_nonull2();
    $data['id'] = $this->uri->segment(4, 0);
    $data['id2'] = $this->uri->segment(5, 0);
    $data['id3'] = $this->uri->segment(6, 0);
    if($mode=='view'){
    if(empty($data['id'])){
      if($this->session->has_userdata('laporan1')){
        $data['id'] = $this->session->laporan1;
      }else{
        $data['id'] = '01-'.date('m-Y');
      }
    }
    if(empty($data['id2'])){
      if($this->session->has_userdata('laporan2')){
        $data['id2'] = $this->session->laporan2;
      }else{
        $data['id2'] = date('d-m-Y');
      }
    }
    if(empty($data['id3'])){
      if($this->session->has_userdata('laporan3')){
        $data['id3'] = $this->session->laporan3;
      }
    }
      $this->tampil_top($data);
      $action = $this->input->post('action');
      if($action == 'BtnProses') {
        $first_date = $this->input->post("id");
        $last_date = $this->input->post("id2");
        $tgl = $this->input->post("id3");
      $data_user_level = array(
        'laporan1'     => $first_date,
        'laporan2'     => $last_date,
        'laporan3'     => $tgl
      );
      $this->session->set_userdata($data_user_level); 
        redirect(base_url('ol_laporan/laporan/view/'.$first_date.'/'.$last_date.'/'.$tgl));
      }
    }
    else if($mode=='data'){
      echo json_encode($this->m_ol_laporan->logbook_laporan_all($data['id'],$data['id2'],$data['id3']));
    }
    else{
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
        $data['tgl_laporan']  = set_value('tgl_laporan',date('d-m-Y'));
        $data['tgl_awal']  = set_value('tgl_awal',date('d-m-Y'));
        $data['tgl_akhir']  = set_value('tgl_akhir',date('d-m-Y'));
        $data['id_working']  = set_value('id_working',$this->input->post("id_working"));        
        $data['header_laporan']  = set_value('header_laporan',$this->input->post("header_laporan"));        
        $data['sub_header_laporan']  = set_value('sub_header_laporan',$this->input->post("sub_header_laporan"));        
        $data['sub_sub_header_laporan']  = set_value('sub_sub_header_laporan',$this->input->post("sub_sub_header_laporan"));        
        $data['judul_laporan']  = set_value('judul_laporan',$this->input->post("judul_laporan"));       
        $data['tujuan_laporan']  = set_value('tujuan_laporan',$this->input->post("tujuan_laporan"));        
        $data['sumber_laporan']  = set_value('sumber_laporan',$this->input->post("sumber_laporan"));              
        $data['periode_laporan']  = set_value('periode_laporan',$this->input->post("periode_laporan"));       
        $this->load->view("ol_laporan/isi",$data);
      }
      if($mode=='simpan_tambah'){
          if($this->m_ol_laporan->simpan_analisis()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
            redirect(base_url('ol_laporan/laporan'));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
            redirect(base_url('ol_laporan/laporan'));
          }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
        $keuangan = $this->m_umum->ambil_data('ol_logbook_laporan','id_laporan',$data['id']);   
        $data['tgl_laporan']  = set_value('tgl_laporan',date('d-m-Y', strtotime($keuangan["tgl_laporan"])));
        $data['tgl_awal']  = set_value('tgl_awal',date('d-m-Y', strtotime($keuangan["tgl_awal"])));
        $data['tgl_akhir']  = set_value('tgl_akhir',date('d-m-Y', strtotime($keuangan["tgl_akhir"])));
        $data['id_working']  = set_value('id_working',$keuangan["id_unit"]);
        $data['barcode_pegawai']  = set_value('barcode_pegawai',$keuangan["barcode_pegawai"]);
        $data['header_laporan']  = set_value('header_laporan',$keuangan["header_laporan"]);
        $data['sub_header_laporan']  = set_value('sub_header_laporan',$keuangan["sub_header_laporan"]);
        $data['sub_sub_header_laporan']  = set_value('sub_sub_header_laporan',$keuangan["sub_sub_header_laporan"]);
        $data['judul_laporan']  = set_value('judul_laporan',$keuangan["judul_laporan"]);
        $data['tujuan_laporan']  = set_value('tujuan_laporan',$keuangan["tujuan_laporan"]);
        $data['sumber_laporan']  = set_value('sumber_laporan',$keuangan["sumber_laporan"]);
        $data['periode_laporan']  = set_value('periode_laporan',$keuangan["periode_laporan"]);
        $this->load->view("ol_laporan/isi",$data);
      }
      if($mode=='simpan_edit'){
        $barcode_pegawai = $this->input->post("barcode_pegawai");
        if($barcode_pegawai == $this->session->barcode_pegawai){
          if($this->m_ol_laporan->rubah_analisis()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
            redirect(base_url('ol_laporan/laporan'));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
            redirect(base_url('ol_laporan/laporan'));
          }
        }else{
            $this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
            redirect(base_url('ol_laporan/laporan'));         
        }
      }
    }
  }
  function baru($mode='view'){
    $data['page']="baru"; 
    $data['header'] = "CREATE DAN EDIT LAPORAN";
    $data['title'] = "CREATE DAN EDIT LAPORAN";
    $data['link_awal'] = base_url('ol_laporan/laporan');
    $data['link_item'] = base_url('member/item_mutu');
    $pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
    $instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
    $data['instance_id'] = $instansi["id_instansi"];
    $data['instance_name'] = $instansi["nama_instansi"];
    $data['idescription'] = $instansi["description"];
    $data['ikeywords'] = $instansi["keywords"];
    $data['iheader'] = $instansi["header"];
    $data['iheader_mini'] = $instansi["header_mini"];
    $data['ifooter'] = $instansi["footer"];
    $data['ilicensed'] = $instansi["licensed"];
    $data['member_id'] = $pegawai["id_pegawai"];
    $data['member_name'] = $pegawai["nama_pegawai"];
    $data['level_name'] = $pegawai["nama_level"];
    $data['photo'] = $pegawai["foto"];      
    //======================= IMPORTANT =========================================
    $data['idlap'] = $this->uri->segment(4, 0);
    $data['idtab'] = $this->uri->segment(5, 0);
    //======================= LINK =========================================
    $data['link_awal'] = base_url('ol_laporan/tabel/view/'.$data['idlap']);
    $data['link_item'] = base_url('member/item_mutu');
  //===================================================== AMBIL ======================
    $data['cmd_ya_tidak'] = $this->m_rancak->cmd_ya_tidak();
    $data['ambil_tabel'] = $this->m_rancak->ambil_sn_tabel(); 
    $data['cmd_lhu_personal'] = $this->m_rancak->cmd_lhu_personal();
    $data['cmd_qcim'] = $this->m_rancak->cmd_qcim();
    $data['cmd_judul_laporan'] = $this->m_rancak->cmd_ol_logbook_judul_laporan();
    //======================= AMBIL DATA =========================================
    $lp = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($data['idtab']); // id_laporan_tabel
    $worke = $this->m_umum->ambil_data('ol_unit','id_unit',$lp['id_unit']);
    $peg = $this->m_umum->ambil_data('ol_pegawai','barcode_pegawai',$lp['barcode_pegawai']);
    $kondisi_cek = array('id_laporan_tabel'=>$data['idtab'],'barcode_pegawai'=>$this->session->barcode_pegawai);
    $data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('ol_logbook_laporan_tabel',$kondisi_cek,'ol_logbook_laporan','id_laporan');
    $data['nama_unit']  = set_value('nama_unit',$worke["nama_unit"]);
    $data['id_laporan']  = set_value('id_laporan',$lp["id_laporan"]);
    $data['header_laporan']  = set_value('header_laporan',$lp["header_laporan"]);
    $data['judul_laporan']  = set_value('judul_laporan',$lp["judul_laporan"]);
    $data['urutan_laporan_tabel']  = set_value('urutan_laporan_tabel',$lp["urutan_laporan_tabel"]);
    $data['id_laporan_tabel']  = set_value('id_laporan_tabel',$lp["id_laporan_tabel"]);
    $data['id_instansi']  = set_value('id_instansi',$lp["id_instansi"]);
    $data['id_pegawai']  = set_value('id_pegawai',$lp["id_pegawai"]);
    $data['judul_laporan_tabel']  = set_value('judul_laporan_tabel',$lp["judul_laporan_tabel"]);
    $data['analisa_laporan_tabel']  = set_value('analisa_laporan_tabel',$lp["analisa_laporan_tabel"]);
    $data['rekomendasi_laporan_tabel']  = set_value('rekomendasi_laporan_tabel',$lp["rekomendasi_laporan_tabel"]);
    $data['barcode_pegawai']  = set_value('barcode_pegawai',$lp["barcode_pegawai"]);
    $data['idpeg']  = set_value('idpeg',$lp["id_pegawai"]);
    $data['share_it']  = set_value('share_it',$lp["share_it"]);
    $data['tgl_awal']  = set_value('tgl_awal',date('d-m-Y', strtotime($lp["tgl_awal"])));
    $data['tgl_akhir']  = set_value('tgl_akhir',date('d-m-Y', strtotime($lp["tgl_akhir"])));
    $data['tabel']  = set_value('tabel',$lp["tabel"]);
    $data['lhu']  = set_value('lhu',$lp["lhu"]);
    $data['qc_self']  = set_value('qc_self',$lp["qc_self"]);
    $data['isi_kompetensi']  = set_value('isi_kompetensi',$lp["isi_kompetensi"]);
    $data['kompetensi']  = set_value('kompetensi',$lp["kompetensi"]);
    $data['kewenangan']  = set_value('kewenangan',$lp["kewenangan"]);
    $data['show_pdf']  = set_value('show_pdf',$lp["show_pdf"]);
    $data['sub']  = set_value('sub',$lp["sub"]);
    if($lp["min_laporan_tabel"]){
      $data['min_laporan_tabel'] = $lp["min_laporan_tabel"];
    }else{
      $data['min_laporan_tabel'] = '0';
    }
    if($lp["max_laporan_tabel"]){
      $data['max_laporan_tabel'] = $lp["max_laporan_tabel"];
    }else{
      $data['max_laporan_tabel'] = '0';
    }
    if($mode=='view'){
      $this->tampil_top($data);
    }
    else{
      if($mode=='tambah_tabel'){
        $data['page'] =  $data['page']."_tambah_tabel";    
        $data['id_laporan']  = $data['idlap'];        
        $data['judul_laporan_tabel']  = set_value('judul_laporan_tabel',$this->input->post("judul_laporan_tabel"));       
        $data['analisa_laporan_tabel']  = set_value('analisa_laporan_tabel',$this->input->post("analisa_laporan_tabel"));       
        $data['rekomendasi_laporan_tabel']  = set_value('rekomendasi_laporan_tabel',$this->input->post("rekomendasi_laporan_tabel")); 
        $this->load->view("ol_laporan/isi",$data);
      }
      if($mode=='simpan_tambah_tabel'){
        $id_laporan = $this->input->post("id_laporan");
        $id_laporan_tabel = $this->input->post("id_laporan_tabel");
        if($this->m_ol_laporan->tambah_tabel()){
          $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
          redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
        }else{
          $this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
          redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
        }
      }
      if($mode=='rubah_tabel'){
        $data['page'] =  $data['page']."_rubah_tabel"; 
        $this->load->view("ol_laporan/isi",$data);
      }
      if($mode=='simpan_rubah_tabel'){
        $id_laporan = $this->input->post("id_laporan");
        $id_laporan_tabel = $this->input->post("id_laporan_tabel");
        $barcode_pegawai = $this->input->post("barcode_pegawai");
        if($barcode_pegawai == $this->session->barcode_pegawai){
          if($this->m_ol_laporan->rubah_tabel()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
          }
        }else{
            $this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));         
        }
      }
      if($mode=='rubah_urutan'){
        $data['page'] =  $data['page']."_rubah_urutan";
        $this->load->view("ol_laporan/isi",$data);
      }
      if($mode=='simpan_rubah_urutan'){
        $id_laporan = $this->input->post("id_laporan");
        $id_laporan_tabel = $this->input->post("id_laporan_tabel");
        $barcode_pegawai = $this->input->post("barcode_pegawai");
        if($barcode_pegawai == $this->session->barcode_pegawai){
          if($this->m_ol_laporan->rubah_urutan()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
          }
        }else{
            $this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));         
        }
      }
      if($mode=='modif'){
        $data['page'] =  $data['page']."_modif";
        $this->load->view("ol_laporan/isi",$data);
      }
      if($mode=='simpan_modif'){
        $id_laporan = $this->input->post("id_laporan");
        $id_laporan_tabel = $this->input->post("id_laporan_tabel");
        $barcode_pegawai = $this->input->post("barcode_pegawai");
        if($barcode_pegawai == $this->session->barcode_pegawai){
          if($this->m_ol_laporan->modif_tabel()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
          }
        }else{
            $this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));         
        }
      }
      if($mode=='seting_range'){
        $data['page'] =  $data['page']."_seting_range";
        $this->load->view("ol_laporan/isi",$data);
      }
      if($mode=='simpan_seting_range'){
        $id_laporan = $this->input->post("id_laporan");
        $id_laporan_tabel = $this->input->post("id_laporan_tabel");
        $barcode_pegawai = $this->input->post("barcode_pegawai");
        if($barcode_pegawai == $this->session->barcode_pegawai){
          if($this->m_ol_laporan->seting_range()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
              redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
          }
        }else{
            $this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));         
        }
      }
      if($mode=='rubah_lhu'){
        $data['page'] =  $data['page']."_rubah_lhu";
        $this->load->view("ol_laporan/isi",$data);
      }
      if($mode=='simpan_rubah_lhu'){
        $id_laporan = $this->input->post("id_laporan");
        $id_laporan_tabel = $this->input->post("id_laporan_tabel");
        $barcode_pegawai = $this->input->post("barcode_pegawai");
        if($barcode_pegawai == $this->session->barcode_pegawai){
          if($this->m_ol_laporan->rubah_lhu()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
              redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
              redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
          }
        }else{
            $this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));         
        }
      }
      if($mode=='rubah_qc'){
        $data['page'] =  $data['page']."_rubah_qc";
        $this->load->view("ol_laporan/isi",$data);
      }
      if($mode=='simpan_rubah_qc'){
        $id_laporan = $this->input->post("id_laporan");
        $id_laporan_tabel = $this->input->post("id_laporan_tabel");
        $barcode_pegawai = $this->input->post("barcode_pegawai");
        if($barcode_pegawai == $this->session->barcode_pegawai){
          if($this->m_ol_laporan->rubah_qc()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
              redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
              redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
          }
        }else{
            $this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));         
        }
      }
      if($mode=='seting_kewenangan'){
        $data['page'] =  $data['page']."_seting_kewenangan";
        $data['cmd_komporke'] = $this->m_rancak->cmd_komporke();  
        $this->load->view("ol_laporan/isi",$data);
      }
      if($mode=='simpan_seting_kewenangan'){
        $id_laporan = $this->input->post("id_laporan");
        $id_laporan_tabel = $this->input->post("id_laporan_tabel");
        $barcode_pegawai = $this->input->post("barcode_pegawai");
        if($barcode_pegawai == $this->session->barcode_pegawai){
          if($this->m_ol_laporan->seting_kewenangan()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
              redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
          }
        }else{
            $this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));         
        }
      }
      if($mode=='seting_berkas'){
        $data['page'] =  $data['page']."_seting_berkas";
        $select = ('*');
        $kondisi = array('barcode_pegawai'=>$lp["barcode_pegawai"],'status_berkas'=>1);
        $data['explo'] = $lp["berkas"];
        $data['field'] = 'berkas';
        $data['id_item'] = 'id_berkas';
        $data['chk_item'] = $this->m_ol_laporan->ambil_berkas_laporan($data['idtab'],$select,$kondisi);
        $this->load->view("ol_laporan/isi",$data);
      }
      if($mode=='simpan_seting_berkas'){
        $id_laporan = $this->input->post("id_laporan");
        $id_laporan_tabel = $this->input->post("id_laporan_tabel");
        $barcode_pegawai = $this->input->post("barcode_pegawai");
        if($barcode_pegawai == $this->session->barcode_pegawai){
          if($this->m_ol_laporan->seting_kompetensi()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
              redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
          }
        }else{
            $this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));         
        }
      }
      if($mode=='seting_sub'){
        $data['page'] =  $data['page']."_seting_sub";
        $this->load->view("ol_laporan/isi",$data);
      }
      if($mode=='simpan_seting_sub'){
        $id_laporan = $this->input->post("id_laporan");
        $id_laporan_tabel = $this->input->post("id_laporan_tabel");
        $barcode_pegawai = $this->input->post("barcode_pegawai");
        if($barcode_pegawai == $this->session->barcode_pegawai){
          if($this->m_ol_laporan->rubah_sub()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
          }
        }else{
            $this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));         
        }
      }
      if($mode=='clone'){
        $data['page'] =  $data['page']."_clone";
        $this->load->view("ol_laporan/isi",$data);
      }
      if($mode=='simpan_clone'){
        $id_laporan = $this->input->post("id_laporan");
        $id_laporan_tabel = $this->input->post("id_laporan_tabel");
        $barcode_pegawai = $this->input->post("barcode_pegawai");
        if($barcode_pegawai == $this->session->barcode_pegawai){
          if($this->m_ol_laporan->tambah_tabel_clone()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
              redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
              redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
          }
        }else{
            $this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));         
        }
      }
    }
  }
function tabel($mode='view'){
//========================= START
  $data['page']="tabel"; 
  $data['header'] = "SETING DATA LAPORAN";
  $data['title'] = "SETING DATA LAPORAN";
  $data['text'] = "SETING DATA LAPORAN";

  $pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
  $instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
  $data['instance_id'] = $instansi["id_instansi"];
  $data['instance_name'] = $instansi["nama_instansi"];
  $data['idescription'] = $instansi["description"];
  $data['ikeywords'] = $instansi["keywords"];
  $data['iheader'] = $instansi["header"];
  $data['iheader_mini'] = $instansi["header_mini"];
  $data['ifooter'] = $instansi["footer"];
  $data['ilicensed'] = $instansi["licensed"];
  $data['member_id'] = $pegawai["id_pegawai"];
  $data['member_name'] = $pegawai["nama_pegawai"];
  $data['level_name'] = $pegawai["nama_level"];
  $data['photo'] = $pegawai["foto"];      
  //======================= URI =========================================
  $data['idlap'] = $this->uri->segment(4, 0);
  $data['idtab'] = $this->uri->segment(5, 0);
  //======================= LINK =========================================
  $data['link_awal'] = base_url('ol_laporan');
  $data['link_item'] = base_url('member/item_mutu');
  //======================= AMBIL DATA =========================================
  $lp = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($data['idtab']); // id_laporan_tabel
  $worke = $this->m_umum->ambil_data('ol_unit','id_unit',$lp['id_unit']);
  $peg = $this->m_umum->ambil_data('ol_pegawai','barcode_pegawai',$lp['barcode_pegawai']);
  $kondisi_cek = array('id_laporan_tabel'=>$data['idtab'],'barcode_pegawai'=>$this->session->barcode_pegawai);
  $data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('ol_logbook_laporan_tabel',$kondisi_cek,'ol_logbook_laporan','id_laporan');

  $data['nama_unit']  = set_value('nama_unit',$worke["nama_unit"]);
  $data['id_laporan']  = set_value('id_laporan',$lp["id_laporan"]);
  $data['header_laporan']  = set_value('header_laporan',$lp["header_laporan"]);
  $data['judul_laporan']  = set_value('judul_laporan',$lp["judul_laporan"]);
  $data['urutan_laporan_tabel']  = set_value('urutan_laporan_tabel',$lp["urutan_laporan_tabel"]);
  $data['id_laporan_tabel']  = set_value('id_laporan_tabel',$lp["id_laporan_tabel"]);
  $data['id_instansi']  = set_value('id_instansi',$lp["id_instansi"]);
  $data['id_pegawai']  = set_value('id_pegawai',$lp["id_pegawai"]);
  $data['judul_laporan_tabel']  = set_value('judul_laporan_tabel',$lp["judul_laporan_tabel"]);
  $data['analisa_laporan_tabel']  = set_value('analisa_laporan_tabel',$lp["analisa_laporan_tabel"]);
  $data['rekomendasi_laporan_tabel']  = set_value('rekomendasi_laporan_tabel',$lp["rekomendasi_laporan_tabel"]);
  $data['barcode_pegawai']  = set_value('barcode_pegawai',$lp["barcode_pegawai"]);
  $data['idpeg']  = set_value('idpeg',$lp["id_pegawai"]);
  $data['share_it']  = set_value('share_it',$lp["share_it"]);
  $data['tgl_awal']  = set_value('tgl_awal',date('d-m-Y', strtotime($lp["tgl_awal"])));
  $data['tgl_akhir']  = set_value('tgl_akhir',date('d-m-Y', strtotime($lp["tgl_akhir"])));
  $data['tabel']  = set_value('tabel',$lp["tabel"]);
  $data['lhu']  = set_value('lhu',$lp["lhu"]);
  $data['qc_self']  = set_value('qc_self',$lp["qc_self"]);
  $data['isi_kompetensi']  = set_value('isi_kompetensi',$lp["isi_kompetensi"]);
  $data['kompetensi']  = set_value('kompetensi',$lp["kompetensi"]);
  $data['kewenangan']  = set_value('kewenangan',$lp["kewenangan"]);
  $data['show_pdf']  = set_value('show_pdf',$lp["show_pdf"]);
  if($lp["min_laporan_tabel"]){
    $data['min_laporan_tabel'] = $lp["min_laporan_tabel"];
  }else{
    $data['min_laporan_tabel'] = '0';
  }
  if($lp["max_laporan_tabel"]){
    $data['max_laporan_tabel'] = $lp["max_laporan_tabel"];
  }else{
    $data['max_laporan_tabel'] = '0';
  }
  //===================================================== AMBIL ======================
  $data['cmd_ya_tidak'] = $this->m_rancak->cmd_ya_tidak();
  //===========================================================================
  if($mode=='data'){
    echo json_encode($this->m_ol_laporan->logbook_laporan_tabel_all($data['idlap']));
  }
  if($mode=='view'){
    $this->tampil_top($data);
  }else{
    //=================================================== ELSE ========================
    if($data['idtab']){
  $data['js_thn'] = 'js_thn';
  $data['js_bln'] = 'js_bln';
  $data['js_hr'] = 'js_hr';
  $data['tgl_bln'] = 'tgl_bln';
  $data['tgl_hr'] = 'tgl_hr';
  $data['tgl_thn'] = 'tgl_thn';
  //===================================================== KET ======================
  $data['nama_pegawai'] = 'nama_pegawai';
  $data['ket_seting'] = 'seting';
  $data['ket_isi'] = 'isi';
  //===================================================== LHU ======================
  if($lp["lhu"] == 1){
    $data['text'] = 'SUMBER DATA : KOMPETENSI / KEWENANGAN';
    if($lp["kewenangan"] == 1){
      $data['grup_item'] = 'ol_logbook.id_kewenangan';
      $data['id_item'] = 'id_kewenangan';
      $data['coun_item'] = 'id_kewenangan';
      $data['nama_item'] = 'nama_kewenangan';
      $data['order'] = 'nkr_kewenangan.id_kompetensi';
      $data['tbllegend'] = 'nkr_kewenangan';
    }else{
      $data['grup_item'] = 'nkr_kewenangan.id_kompetensi';
      $data['id_item'] = 'id_kompetensi';
      $data['coun_item'] = 'id_kompetensi';
      $data['nama_item'] = 'nama_kompetensi';
      $data['order'] = 'nkr_kewenangan.id_kompetensi';
      $data['tbllegend'] = 'nkr_kompetensi';
    }
    $data['ins_item'] = 'id_kompetensi';
    $data['kat_item'] = 'nkr_kewenangan.id_kompetensi';
    $data['nama_kat'] = 'nama_kompetensi';
    $data['tabel_item'] = 'ol_logbook';
    $data['tgl_item'] = 'tgl_logbook';
    $data['jml_item'] = 'jml_logbook';
    $data['sume'] = 'jml_logbook';
    $data['sumeas'] = 'jml_logbook';
    $data['id_peg'] = 'id_logbooker';
    $data['pegawai'] = $lp['id_pegawai'];
    $data['ins'] = 'id_instansi';
    $data['idinst'] = $lp["id_instansi"];
    $data['nama_item1'] = 'nama_kompetensi';
    $data['nama_item2'] = 'nama_kewenangan';
    //=======================
    $data['tabel_seting'] = 'nkr_kewenangan';
    $data['nama_seting'] = 'id_kewenangan';
    $data['tabel_isi'] = 'ol_logbook';
    $data['nama_isi'] = 'id_logbook';
  }
  if($lp["lhu"] == 4){
    $data['text'] = 'SUMBER DATA : QUALITY CONTROL / INDIKATOR MUTU';
    $data['tabel_item'] = 'ol_logbook_lhu_detil';
    $data['grup_item'] = 'ol_logbook_lhu_detil.id_item_lhu';
    $data['ins_item'] = 'id_equipment';
    $data['kat_item'] = 'ol_logbook_item_lhu.id_equipment';
    $data['nama_kat'] = 'nama_equipment';
    $data['nama_item1'] = 'nama_item_lhu';
    $data['nama_item2'] = 'nama_equipment';
    $data['id_item'] = 'id_item_lhu';
    $data['nama_item'] = 'nama_item_lhu';
    $data['order'] = 'ol_logbook_lhu_detil.id_item_lhu';
    $data['tgl_item'] = 'tgl_lhu';
    $data['jml_item'] = 'hasil_lhu_detil';
    $data['sume'] = 'hasil_lhu_detil';
    $data['sumeas'] = 'hasil_lhu_detil';
    $data['id_peg'] = 'ol_logbook_lhu.barcode_pegawai';
    $data['pegawai'] = $lp['barcode_pegawai'];
    $data['ins'] = 'id_instansi';
    $data['idinst'] = $lp["id_instansi"];
    //=======================
    $data['tabel_seting'] = 'ol_logbook_lhu_detil';
    $data['nama_seting'] = 'id_lhu_detil';
    $data['ket_seting'] = 'seting';
    $data['tabel_isi'] = 'ol_logbook_item_lhu';
    $data['nama_isi'] = 'id_item_lhu';
    $data['ket_isi'] = 'isi';   
  }
  if($lp["lhu"] == 5){
    $data['text'] = 'SUMBER DATA : PENDAFTARAN PASIEN';
    $data['tabel_item'] = 'tindakan_daftar';
    $data['grup_item'] = 'tindakan_daftar.id_tindakan';
    $data['ins_item'] = 'id_golongan_pemeriksaan';
    $data['kat_item'] = 'tindakan.id_golongan_pemeriksaan';
    $data['nama_kat'] = 'nama_golongan_pemeriksaan';
    $data['nama_item1'] = 'nama_tindakan';
    $data['nama_item2'] = 'nama_golongan_pemeriksaan';
    $data['id_item'] = 'id_tindakan';
    $data['coun_item'] = 'coun_tindakan_daftar';
    $data['nama_item'] = 'nama_tindakan';
    $data['order'] = 'tindakan_daftar.id_tindakan';
    $data['tgl_item'] = 'tgl_daftar';
    $data['sume'] = 'tindakan_daftar.id_tindakan';
    $data['sumeas'] = 'jml_tindakan';
    $data['jml_item'] = 'jml_tindakan';
    $data['id_peg'] = 'tindakan_daftar.pendaftar';
    $data['pegawai'] = $lp['id_pegawai'];
    $data['ins'] = 'unit_tindakan';
    $data['idinst'] = $lp["id_unit"];
        //=======================
    $data['tabel_seting'] = 'tindakan';
    $data['nama_seting'] = 'id_tindakan';
    $data['ket_seting'] = 'seting';
    $data['tabel_isi'] = 'tindakan_daftar';
    $data['nama_isi'] = 'id_daftar';
    $data['ket_isi'] = 'isi';  
  }
  if($lp["lhu"] == 7){
    $data['text'] = 'SUMBER DATA : BERKAS';
    $data['tabel_item'] = 'ol_berkas';
    $data['grup_item'] = 'ol_berkas.id_kategori_berkas';
    $data['ins_item'] = 'id_kategori_berkas';
    $data['kat_item'] = 'ol_berkas.id_kategori_berkas';
    $data['nama_kat'] = 'nama_berkas_kategori';
    $data['nama_item1'] = 'nama_berkas_kategori';
    $data['nama_item2'] = 'nama_berkas_kategori';
    $data['id_item'] = 'id_berkas';
    $data['coun_item'] = 'id_berkas';
    $data['nama_item'] = 'nama_berkas';
    $data['order'] = 'ol_berkas.tgl_b_berkas';
    $data['tgl_item'] = 'tgl_b_berkas';
    $data['sume'] = 'ol_berkas.kredit';
    $data['sumeas'] = 'coun_berkas';
    $data['jml_item'] = 'coun_berkas';
    $data['id_peg'] = 'ol_berkas.id_pegawai';
    $data['pegawai'] = $lp['id_pegawai'];
    $data['ins'] = 'ol_berkas.id_pegawai';
    $data['idinst'] = $lp["id_pegawai"];
    $data['nama_berkas'] = 'nama_berkas';
    $data['penyelenggara'] = 'penyelenggara';
    $data['kredit'] = 'kredit';
    //=======================
    $data['tabel_seting'] = 'ol_berkas_kategori';
    $data['nama_seting'] = 'id_berkas_kategori';
    $data['ket_seting'] = 'seting';
    $data['tabel_isi'] = 'ol_berkas';
    $data['nama_isi'] = 'id_berkas';
    $data['ket_isi'] = 'isi'; 
  }
  if($lp["lhu"] == 8){
    $data['text'] = 'SUMBER DATA : EVEN DENGAN ABSENSI LOKASI';
    $data['tabel_item'] = 'abs_even';
    $data['grup_item'] = 'tgl_even';
    $data['ins_item'] = 'tgl_even';
    $data['kat_item'] = 'tgl_even';
    $data['nama_kat'] = 'nama_even';
    $data['nama_item1'] = 'nama_even';
    $data['nama_item2'] = 'alamat_even';
    $data['id_item'] = 'id_even';
    $data['coun_item'] = 'coun_even';
    $data['nama_item'] = 'nama_even';
    $data['order'] = 'tgl_even';
    $data['tgl_item'] = 'tgl_even';
    $data['sume'] = 'id_even';
    $data['sumeas'] = 'coun_even';
    $data['jml_item'] = 'coun_even';
    $data['id_peg'] = 'abs_even.barcode_pegawai';
    $data['pegawai'] = $lp['barcode_pegawai'];
    $data['ins'] = 'unit';
    $data['idinst'] = $lp["id_unit"];
    //=======================
    $data['tabel_seting'] = 'abs_even';
    $data['nama_seting'] = 'id_even';
    $data['ket_seting'] = 'seting';
    $data['tabel_isi'] = 'abs_even';
    $data['nama_isi'] = 'id_even';
    $data['ket_isi'] = 'isi'; 
  }
  //===================================================== ARRAY ======================
  $kondisi_seting = array('id_laporan_tabel'=>$data['idtab'],'nama_source'=>$data['nama_seting'],'tabel_source'=>$data['tabel_seting'],'ket_source'=>$data['ket_seting'],'status_laporan_tabel_detil'=>1,'pembuat_source'=>$this->session->barcode_pegawai);
  $kondisi_isi = array('id_laporan_tabel'=>$data['idtab'],'nama_source'=>$data['nama_isi'],'tabel_source'=>$data['tabel_isi'],'ket_source'=>$data['ket_isi'],'status_laporan_tabel_detil'=>1,'pembuat_source'=>$this->session->barcode_pegawai);

  $data['jml_isi'] = $this->m_umum->jumlah_record_filter('ol_logbook_laporan_tabel_detil',$kondisi_isi);
  $data['jml_seting'] = $this->m_umum->jumlah_record_filter('ol_logbook_laporan_tabel_detil',$kondisi_seting);
  $data['arr_seting'] = $this->m_umum->ambil_data_kondisi_result('ol_logbook_laporan_tabel_detil',$kondisi_seting);
  $data['arr_isi'] = $this->m_umum->ambil_data_kondisi_result('ol_logbook_laporan_tabel_detil',$kondisi_isi);
//=====================================
  $data['select_all'] = ("*");
  $data['selectgrup'] = ("sum(".$data['sume'].") as ".$data['sumeas'].",".$data['nama_item1'].",".$data['nama_item2'].",".$data['nama_item']."");
  $data['kondisi1'] = array(''.$data['tgl_item'].' >='=>$lp["tgl_awal"],''.$data['tgl_item'].' <='=>$lp["tgl_akhir"],$data['id_peg']=>$data['pegawai'],$data['ins']=>$data['idinst'],''.$data['jml_item'].' >'=>0);
  if($lp["lhu"] == 4 && $lp["qc_self"] == 0){
    $data['kondisi1'] = array(''.$data['tgl_item'].' >='=>$lp["tgl_awal"],''.$data['tgl_item'].' <='=>$lp["tgl_akhir"],$data['ins']=>$data['idinst'],''.$data['jml_item'].' >'=>0);
  }

  $data['ambil_lhu'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select_all'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']);
  
  $data['grup_lhu'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrup'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],$data['grup_item']);
  
  $data['ambil_bulan'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select_all'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],'MONTH('.$data['tgl_item'].')');
        //============================================================================= BERKAS
      if($lp["lhu"] == 7){
        $data['kondisi_berkas'] = array('id_kategori_berkas >'=>13,'link_berkas !='=>'','status_berkas'=>1,$data['ins']=>$data['idinst']);
        $data['kondisi_imut'] = array('id_kategori_berkas'=>12,'link_berkas !='=>'','status_berkas'=>1,$data['ins']=>$data['idinst']);
        $data['kondisi_ijasah'] = array('id_kategori_berkas'=>7,'link_berkas !='=>'','status_berkas'=>1,$data['ins']=>$data['idinst']);
        $data['kondisi_pelatihan'] = array('kunci'=>1,'link_berkas !='=>'','status_berkas'=>1,$data['ins']=>$data['idinst']);
        $data['kondisi_str'] = array('kunci'=>0,'link_berkas !='=>'','status_berkas'=>1,$data['ins']=>$data['idinst']);
        $data['jml_berkas'] = $this->m_ol_laporan->jumlah_sumber_data($data['idtab'],$data['tabel_item'],$data['kondisi_berkas'],$lp["lhu"],$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']);
        $data['jml_imut'] = $this->m_ol_laporan->jumlah_sumber_data($data['idtab'],$data['tabel_item'],$data['kondisi_imut'],$lp["lhu"],$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']);
        $data['jml_ijasah'] = $this->m_ol_laporan->jumlah_sumber_data($data['idtab'],$data['tabel_item'],$data['kondisi_ijasah'],$lp["lhu"],$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']);
        $data['jml_pelatihan'] = $this->m_ol_laporan->jumlah_sumber_data($data['idtab'],$data['tabel_item'],$data['kondisi_pelatihan'],$lp["lhu"],$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']);
        $data['jml_str'] = $this->m_ol_laporan->jumlah_sumber_data($data['idtab'],$data['tabel_item'],$data['kondisi_str'],$lp["lhu"],$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']);
        $data['ambil_berkas'] = $this->m_ol_laporan->set_isi_sumber_data($data['idtab'],$data['tabel_item'],$data['select_all'],$data['kondisi_berkas'],$lp["lhu"],$data['order'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']);
        $data['ambil_imut'] = $this->m_ol_laporan->set_isi_sumber_data($data['idtab'],$data['tabel_item'],$data['select_all'],$data['kondisi_imut'],$lp["lhu"],$data['order'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']);
        $data['ambil_ijasah'] = $this->m_ol_laporan->set_isi_sumber_data($data['idtab'],$data['tabel_item'],$data['select_all'],$data['kondisi_ijasah'],$lp["lhu"],$data['order'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']);
        $data['ambil_pelatihan'] = $this->m_ol_laporan->set_isi_sumber_data($data['idtab'],$data['tabel_item'],$data['select_all'],$data['kondisi_pelatihan'],$lp["lhu"],$data['order'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']);
        $data['ambil_str'] = $this->m_ol_laporan->set_isi_sumber_data($data['idtab'],$data['tabel_item'],$data['select_all'],$data['kondisi_str'],$lp["lhu"],$data['order'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']);
      }
        //============================================================================= GRAFIK


  //===========================================================================
  $data['chk_seting']=$this->m_ol_laporan->set_sumber_data($data['tabel_item'],$data['select_all'],$data['kondisi1'],$lp["lhu"],$data['grup_item']);
  $data['chk_isi'] = $this->m_ol_laporan->set_isi_sumber_data($data['idtab'],$data['tabel_item'],$data['select_all'],$data['kondisi1'],$lp["lhu"],$data['grup_item'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']);
  //===========================================================================    
    //===========================================================================
    if($mode=='seting_kompetensi'){
      $data['page'] =  $data['page']."_seting_kompetensi";
      $this->load->view("ol_laporan/isi",$data);
    }
    if($mode=='simpan_seting_kompetensi'){
      $id_laporan = $this->input->post("id_laporan");
      $id_laporan_tabel = $this->input->post("id_laporan_tabel");
      $barcode_pegawai = $this->input->post("barcode_pegawai");
      if($barcode_pegawai == $this->session->barcode_pegawai){
         $this->m_ol_laporan->seting_tabel_detil();
          $this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
          redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
      }else{
          $this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
          redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));         
      }
    }
    if($mode=='seting_isi_kompetensi'){
      $data['page'] =  $data['page']."_seting_isi_kompetensi";
      $this->load->view("ol_laporan/isi",$data);
    }
    if($mode=='simpan_seting_isi_kompetensi'){
      $id_laporan = $this->input->post("id_laporan");
      $id_laporan_tabel = $this->input->post("id_laporan_tabel");
      $barcode_pegawai = $this->input->post("barcode_pegawai");
      if($barcode_pegawai == $this->session->barcode_pegawai){
           $this->m_ol_laporan->seting_tabel_detil();
          $this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
          redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
      }else{
          $this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
          redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));         
      }
    }
    if($mode=='cek'){
      $data['page'] =  $data['page']."_cek";
  $data['selectgrafik5'] = ("sum(".$data['jml_item'].") as ".$data['jml_item'].",".$data['grup_item']." as ".$data['id_item'].",DATE_FORMAT(".$data['tgl_item'].",'%d-%m-%Y') as ".$data['tgl_hr'].",DATE_FORMAT(".$data['tgl_item'].",'%m-%Y') as ".$data['tgl_bln'].",DATE_FORMAT(".$data['tgl_item'].",'%Y') as ".$data['tgl_thn'].",".$data['tgl_item']." as ".$data['tgl_item'].",MONTH(".$data['tgl_item'].") as ".$data['js_bln'].",YEAR(".$data['tgl_item'].") as ".$data['js_thn'].",DATE_FORMAT(".$data['tgl_item'].",'%d') as ".$data['js_hr'].",concat(".$data['nama_item1'].",' - ',".$data['nama_item2'].") as ".$data['nama_item']."  ");

  $data['selectgrafikhr'] = (" ".$data['grup_item']." as ".$data['id_item'].",DATE_FORMAT(".$data['tgl_item'].",'%d-%m-%Y') as ".$data['tgl_hr'].",DATE_FORMAT(".$data['tgl_item'].",'%m-%Y') as ".$data['tgl_bln'].",DATE_FORMAT(".$data['tgl_item'].",'%Y') as ".$data['tgl_thn'].",".$data['tgl_item']." as ".$data['tgl_item'].",MONTH(".$data['tgl_item'].") as ".$data['js_bln'].",YEAR(".$data['tgl_item'].") as ".$data['js_thn'].",DATE_FORMAT(".$data['tgl_item'].",'%d') as ".$data['js_hr'].",  ");

  $data['grafik5'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafik5'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],'MONTH('.$data['tgl_item'].')');

  $data['grafikhr'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafikhr'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],$data['tgl_item']);

  $data['legendgrafik5'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select_all'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],$data['grup_item']);

  $data['ambil_data_min'] = $this->m_ol_laporan->get_min($data['idtab'],$data['tabel_item'],$data['jml_item'],$data['kondisi1'],$lp["lhu"],$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']);
  $data['ambil_data_max'] = $this->m_ol_laporan->get_max($data['idtab'],$data['tabel_item'],$data['jml_item'],$data['kondisi1'],$lp["lhu"],$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']);

  $data['grafikpie'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafik5'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],$data['id_item']);
      $this->tampil_top($data);
    }
    if($mode=='pdf_logbook'){
      $report = $this->load->view('cetak/ol_laporan_logbook', $data, TRUE);
      $namaku = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$this->session->id_pegawai);
      $filename = date('dmYHis').'laporan-'.$namaku['nama_pegawai']."-laporan-logbook-detil.pdf";
      $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-L']);
      // Define a default page size/format by array - page will be 190mm wide x 236mm height
      $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [190, 236]]);
      // Define a default page using all default values except "L" for Landscape orientation
      $mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);
      $mpdf->SetTitle($data['header']);
      $mpdf->SetAuthor($data['instance_name']);
      $mpdf->AddPage('L', '', '', '', 2, 5, 5, 5, 0, 0, 0);
      $mpdf->SetDisplayMode('fullpage');
      $mpdf->SetHTMLFooter('<div style="text-align: center">{PAGENO}</div>');
    //  $mpdf->SetFooter('Page : {PAGENO}');
  //    $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
      for ($i = 1; $i > 2; $i++) {
      $mpdf->SetHTMLFooter('');
      }     
      ini_set("pcre.backtrack_limit", "5000000");
      $mpdf->WriteHTML($report);
      $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
    }
  }
    //========================= !ELSE
  }
//========================= END
}
  function tabels($mode='view'){
    $data['page']="tabels"; 
    $data['header'] = "DATA TABEL / GRAFIK LAPORAN";
    $data['title'] = "DATA TABEL / GRAFIK LAPORAN";
    $data['text'] = 'DATA TABEL / GRAFIK LAPORAN';
    $data['link_awal'] = base_url('ol_laporan/laporan');
    $data['link_item'] = base_url('member/item_mutu');
    $pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
    $instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
    $data['instance_id'] = $instansi["id_instansi"];
    $data['instance_name'] = $instansi["nama_instansi"];
    $data['idescription'] = $instansi["description"];
    $data['ikeywords'] = $instansi["keywords"];
    $data['iheader'] = $instansi["header"];
    $data['iheader_mini'] = $instansi["header_mini"];
    $data['ifooter'] = $instansi["footer"];
    $data['ilicensed'] = $instansi["licensed"];
    $data['member_id'] = $pegawai["id_pegawai"];
    $data['member_name'] = $pegawai["nama_pegawai"];
    $data['level_name'] = $pegawai["nama_level"];
    $data['photo'] = $pegawai["foto"];  
    //======================= IMPORTANT =========================================
    $data['hal'] = $this->uri->segment(3, 0);
    $data['idlap'] = $this->uri->segment(4, 0);
    $data['idtab'] = $this->uri->segment(5, 0);
    $data['idp'] = $this->uri->segment(6, 0);
    $data['cmd_ya_tidak'] = $this->m_rancak->cmd_ya_tidak();
    //============================================================================= MODE = VIEW
      $lp = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($data['idtab']); // id_laporan_tabel
      $worke = $this->m_umum->ambil_data('ol_unit','id_unit',$lp['id_unit']);
      $peg = $this->m_umum->ambil_data('ol_pegawai','barcode_pegawai',$lp['barcode_pegawai']);
      $kondisi_cek = array('id_laporan_tabel'=>$data['idtab'],'barcode_pegawai'=>$this->session->barcode_pegawai);
      $data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('ol_logbook_laporan_tabel',$kondisi_cek,'ol_logbook_laporan','id_laporan'); 
      $data['nama_unit']  = set_value('nama_unit',$worke["nama_unit"]);
      $data['id_laporan']  = set_value('id_laporan',$lp["id_laporan"]);
      $data['judul_laporan']  = set_value('judul_laporan',$lp["judul_laporan"]);
      $data['urutan_laporan_tabel']  = set_value('urutan_laporan_tabel',$lp["urutan_laporan_tabel"]);
      $data['id_laporan_tabel']  = set_value('id_laporan_tabel',$lp["id_laporan_tabel"]);
      $data['id_instansi']  = set_value('id_instansi',$lp["id_instansi"]);
      $data['id_pegawai']  = set_value('id_pegawai',$lp["id_pegawai"]);
      $data['judul_laporan_tabel']  = set_value('judul_laporan_tabel',$lp["judul_laporan_tabel"]);
      $data['analisa_laporan_tabel']  = set_value('analisa_laporan_tabel',$lp["analisa_laporan_tabel"]);
      $data['rekomendasi_laporan_tabel']  = set_value('rekomendasi_laporan_tabel',$lp["rekomendasi_laporan_tabel"]);
      $data['barcode_pegawai']  = set_value('barcode_pegawai',$lp["barcode_pegawai"]);
      $data['idpeg']  = set_value('idpeg',$lp["id_pegawai"]);
      $data['share_it']  = set_value('share_it',$lp["share_it"]);
      $data['tgl_awal']  = set_value('tgl_awal',date('d-m-Y', strtotime($lp["tgl_awal"])));
      $data['tgl_akhir']  = set_value('tgl_akhir',date('d-m-Y', strtotime($lp["tgl_akhir"])));
      $data['tabel']  = set_value('tabel',$lp["tabel"]);
      $data['lhu']  = set_value('lhu',$lp["lhu"]);
      $data['qc_self']  = set_value('qc_self',$lp["qc_self"]);
      $data['isi_kompetensi']  = set_value('isi_kompetensi',$lp["isi_kompetensi"]);
      $data['kompetensi']  = set_value('kompetensi',$lp["kompetensi"]);
      $data['kewenangan']  = set_value('kewenangan',$lp["kewenangan"]);
      $data['show_pdf']  = set_value('show_pdf',$lp["show_pdf"]);
      if($lp["min_laporan_tabel"]){
        $data['min_laporan_tabel'] = $lp["min_laporan_tabel"];
      }else{
        $data['min_laporan_tabel'] = '0';
      }
      if($lp["max_laporan_tabel"]){
        $data['max_laporan_tabel'] = $lp["max_laporan_tabel"];
      }else{
        $data['max_laporan_tabel'] = '0';
      }
      //=========================================================================== LHU 1
      //'1'=>'Kompetensi','4'=>'QC / IM','5'=>'Pendaftaran Pasien','6'=>'Time Respon','7'=>'Berkas','8'=>'Even'
      /*
        1  ;Tabel Detail                ;1;1
        14 ;Tabel Logbook Total         ;1;2
        9  ;Grafik Garis                ;1;3
        5  ;Grafik Garis Combine        ;1;4
        8  ;Grafik Garis separate       ;1;5
        7  ;Grafik Garis Range Combine  ;1;6
        6  ;Grafik Garis Range separate ;1;7
        3  ;Grafik Pie                  ;1;8
        10 ;Grafik Batang               ;1;11
        11 ;Grafik Batang Persentase    ;1;12
        12 ;Grafik Batang Lokasi        ;0;13
        13 ;Grafik Batang Kelola Limbah ;0;14
        15 ;Tabel Berkas                ;0;16
        2  ;Grafik Pie Single %         ;0;17
        4  ;Grafik Garis Combine + Total;0;18
      */
      //============================================================================= lhu 1
      if($lp["lhu"] == 1){
        $data['tabel_item'] = 'ol_logbook';
        if($lp["kewenangan"] == 1){
          $data['grup_item'] = 'ol_logbook.id_kewenangan';
          $data['id_item'] = 'id_kewenangan';
          $data['coun_item'] = 'id_kewenangan';
          $data['nama_item'] = 'nama_kewenangan';
          $data['order'] = 'nkr_kewenangan.id_kompetensi';
          $data['tbllegend'] = 'nkr_kewenangan';
        }else{
          $data['grup_item'] = 'nkr_kewenangan.id_kompetensi';
          $data['id_item'] = 'id_kompetensi';
          $data['coun_item'] = 'id_kompetensi';
          $data['nama_item'] = 'nama_kompetensi';
          $data['order'] = 'nkr_kewenangan.id_kompetensi';
          $data['tbllegend'] = 'nkr_kompetensi';
        }
        $data['text'] = 'SUMBER DATA : KOMPETENSI / KEWENANGAN';
        $data['tgl_item'] = 'tgl_logbook';
        $data['jml_item'] = 'jml_logbook';
        $data['sume'] = 'jml_logbook';
        $data['sumeas'] = 'jml_logbook';
        $data['id_peg'] = 'id_logbooker';
        $data['nama_item1'] = 'nama_kompetensi';
        $data['nama_item2'] = 'nama_kewenangan';
        $data['pegawai'] = $lp['id_pegawai'];
        $data['ins'] = 'id_instansi';
        $data['idinst'] = $lp["id_instansi"];
        //=======================
        $data['tabel_seting'] = 'nkr_kewenangan';
        $data['nama_seting'] = 'id_kewenangan';
        $data['ket_seting'] = 'seting';
        $data['tabel_isi'] = 'ol_logbook';
        $data['nama_isi'] = 'id_logbook';
        $data['ket_isi'] = 'isi';
//=======================
$kondisi_seting = array('id_laporan_tabel'=>$data['idtab'],'nama_source'=>$data['nama_seting'],'tabel_source'=>$data['tabel_seting'],'ket_source'=>$data['ket_seting'],'status_laporan_tabel_detil'=>1,'pembuat_source'=>$this->session->barcode_pegawai);
$kondisi_isi = array('id_laporan_tabel'=>$data['idtab'],'nama_source'=>$data['nama_isi'],'tabel_source'=>$data['tabel_isi'],'ket_source'=>$data['ket_isi'],'status_laporan_tabel_detil'=>1,'pembuat_source'=>$this->session->barcode_pegawai);
        $data['jml_isi'] = $this->m_umum->jumlah_record_filter('ol_logbook_laporan_tabel_detil',$kondisi_isi);
        $data['jml_seting'] = $this->m_umum->jumlah_record_filter('ol_logbook_laporan_tabel_detil',$kondisi_seting);
        $data['arr_seting'] = $this->m_umum->ambil_data_kondisi_result('ol_logbook_laporan_tabel_detil',$kondisi_seting);
        $data['arr_isi'] = $this->m_umum->ambil_data_kondisi_result('ol_logbook_laporan_tabel_detil',$kondisi_isi);
        // ,$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']
//=====================================
        $data['select1'] = ("*");
        $data['selectgrup'] = ("sum(".$data['sume'].") as ".$data['sumeas'].",nama_kewenangan,nama_kompetensi");
        $data['kondisi1'] = array('tgl_logbook >='=>$lp["tgl_awal"],'tgl_logbook <='=>$lp["tgl_akhir"],$data['id_peg']=>$data['pegawai'],$data['ins']=>$lp["id_instansi"],'jml_logbook >'=>0);
        $data['ambil_lhu'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']);
        $data['grup_lhu'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrup'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],$data['grup_item']);
        $data['ambil_bulan'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],'MONTH('.$data['tgl_item'].')');

        $data['kondisi_berkas'] = array('id_kategori_berkas >'=>13,'link_berkas !='=>'','status_berkas'=>1,$data['ins']=>$data['idinst']);
        $data['kondisi_imut'] = array('id_kategori_berkas'=>12,'link_berkas !='=>'','status_berkas'=>1,$data['ins']=>$data['idinst']);
        $data['kondisi_ijasah'] = array('id_kategori_berkas'=>7,'link_berkas !='=>'','status_berkas'=>1,$data['ins']=>$data['idinst']);
        $data['kondisi_pelatihan'] = array('kunci'=>1,'link_berkas !='=>'','status_berkas'=>1,$data['ins']=>$data['idinst']);
        $data['kondisi_str'] = array('kunci'=>0,'link_berkas !='=>'','status_berkas'=>1,$data['ins']=>$data['idinst']);
        $data['jml_berkas'] = $this->m_ol_laporan->jumlah_sumber_data($data['idtab'],$data['tabel_item'],$data['kondisi_berkas'],$lp["lhu"]);
        $data['jml_imut'] = $this->m_ol_laporan->jumlah_sumber_data($data['idtab'],$data['tabel_item'],$data['kondisi_imut'],$lp["lhu"]);
        $data['jml_ijasah'] = $this->m_ol_laporan->jumlah_sumber_data($data['idtab'],$data['tabel_item'],$data['kondisi_ijasah'],$lp["lhu"]);
        $data['jml_pelatihan'] = $this->m_ol_laporan->jumlah_sumber_data($data['idtab'],$data['tabel_item'],$data['kondisi_pelatihan'],$lp["lhu"]);
        $data['jml_str'] = $this->m_ol_laporan->jumlah_sumber_data($data['idtab'],$data['tabel_item'],$data['kondisi_str'],$lp["lhu"]);
        $data['ambil_berkas'] = $this->m_ol_laporan->set_isi_sumber_data($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi_berkas'],$lp["lhu"],$data['order'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']);
        $data['ambil_imut'] = $this->m_ol_laporan->set_isi_sumber_data($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi_imut'],$lp["lhu"],$data['order'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']);
        $data['ambil_ijasah'] = $this->m_ol_laporan->set_isi_sumber_data($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi_ijasah'],$lp["lhu"],$data['order'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']);
        $data['ambil_pelatihan'] = $this->m_ol_laporan->set_isi_sumber_data($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi_pelatihan'],$lp["lhu"],$data['order'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']);
        $data['ambil_str'] = $this->m_ol_laporan->set_isi_sumber_data($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi_str'],$lp["lhu"],$data['order'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']);
        //============================================================================= GRAFIK
        $data['js_thn'] = 'js_thn';
        $data['js_bln'] = 'js_bln';
        $data['js_hr'] = 'js_hr';
        $data['tgl_bln'] = 'tgl_bln';
        $data['tgl_hr'] = 'tgl_hr';
        $data['tgl_thn'] = 'tgl_thn';
        $data['selectgrafik5'] = ("sum(".$data['jml_item'].") as ".$data['jml_item'].",".$data['grup_item']." as ".$data['id_item'].",DATE_FORMAT(".$data['tgl_item'].",'%d-%m-%Y') as ".$data['tgl_hr'].",DATE_FORMAT(".$data['tgl_item'].",'%m-%Y') as ".$data['tgl_bln'].",DATE_FORMAT(".$data['tgl_item'].",'%Y') as ".$data['tgl_thn'].",".$data['tgl_item']." as ".$data['tgl_item'].",MONTH(".$data['tgl_item'].") as ".$data['js_bln'].",YEAR(".$data['tgl_item'].") as ".$data['js_thn'].",DATE_FORMAT(".$data['tgl_item'].",'%d') as ".$data['js_hr'].",concat(".$data['nama_item1'].",' - ',".$data['nama_item2'].") as ".$data['nama_item']."  ");
        $data['selectgrafikhr'] = (" ".$data['grup_item']." as ".$data['id_item'].",DATE_FORMAT(".$data['tgl_item'].",'%d-%m-%Y') as ".$data['tgl_hr'].",DATE_FORMAT(".$data['tgl_item'].",'%m-%Y') as ".$data['tgl_bln'].",DATE_FORMAT(".$data['tgl_item'].",'%Y') as ".$data['tgl_thn'].",".$data['tgl_item']." as ".$data['tgl_item'].",MONTH(".$data['tgl_item'].") as ".$data['js_bln'].",YEAR(".$data['tgl_item'].") as ".$data['js_thn'].",DATE_FORMAT(".$data['tgl_item'].",'%d') as ".$data['js_hr'].",  ");
        $data['grafik5'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafik5'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],'MONTH('.$data['tgl_item'].')');
        $data['grafikhr'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafikhr'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],$data['tgl_item']);
        $data['legendgrafik5'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],$data['grup_item']);
        $data['ambil_data_min'] = $this->m_ol_laporan->get_min($data['idtab'],$data['tabel_item'],$data['jml_item'],$data['kondisi1'],$lp["lhu"]);
        $data['ambil_data_max'] = $this->m_ol_laporan->get_max($data['idtab'],$data['tabel_item'],$data['jml_item'],$data['kondisi1'],$lp["lhu"]);
        $data['grafikpie'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafik5'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],$data['id_item']);
      }
      //============================================================================= lhu 4
      if($lp["lhu"] == 4){
        $data['text'] = 'SUMBER DATA : QUALITY CONTROL / INDIKATOR MUTU';
        $data['tabel_item'] = 'ol_logbook_lhu_detil';
        $data['grup_item'] = 'ol_logbook_lhu_detil.id_item_lhu';
        $data['nama_item1'] = 'nama_item_lhu';
        $data['nama_item2'] = 'nama_equipment';
        $data['id_item'] = 'id_item_lhu';
        $data['coun_item'] = 'coun_lhu_detil';
        $data['nama_item'] = 'nama_item_lhu';
        $data['order'] = 'ol_logbook_lhu_detil.id_item_lhu';
        $data['tgl_item'] = 'tgl_lhu';
        $data['jml_item'] = 'hasil_lhu_detil';
        $data['sume'] = 'hasil_lhu_detil';
        $data['sumeas'] = 'hasil_lhu_detil';
        $data['id_peg'] = 'ol_logbook_lhu.barcode_pegawai';
        $data['pegawai'] = $lp['barcode_pegawai'];
        $data['ins'] = 'id_instansi';
        $data['idinst'] = $lp["id_instansi"];
        //=======================
$data['tabel_seting'] = 'ol_logbook_lhu_detil';
$data['nama_seting'] = 'id_lhu_detil';
$data['ket_seting'] = 'seting';
$data['tabel_isi'] = 'ol_logbook_item_lhu';
$data['nama_isi'] = 'id_item_lhu';
$data['ket_isi'] = 'isi';   
//=======================
$kondisi_seting = array('id_laporan_tabel'=>$data['idtab'],'nama_source'=>$data['nama_seting'],'tabel_source'=>$data['tabel_seting'],'ket_source'=>$data['ket_seting'],'status_laporan_tabel_detil'=>1,'pembuat_source'=>$this->session->barcode_pegawai);
$kondisi_isi = array('id_laporan_tabel'=>$data['idtab'],'nama_source'=>$data['nama_isi'],'tabel_source'=>$data['tabel_isi'],'ket_source'=>$data['ket_isi'],'status_laporan_tabel_detil'=>1,'pembuat_source'=>$this->session->barcode_pegawai);
        $data['jml_isi'] = $this->m_umum->jumlah_record_filter('ol_logbook_laporan_tabel_detil',$kondisi_isi);
        $data['jml_seting'] = $this->m_umum->jumlah_record_filter('ol_logbook_laporan_tabel_detil',$kondisi_seting);
        $data['arr_seting'] = $this->m_umum->ambil_data_kondisi_result('ol_logbook_laporan_tabel_detil',$kondisi_seting);
        $data['arr_isi'] = $this->m_umum->ambil_data_kondisi_result('ol_logbook_laporan_tabel_detil',$kondisi_isi);
        // ,$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']
//=====================================
        $data['select1'] = ("*");
        $data['selectgrup'] = ("sum(".$data['sume'].") as ".$data['sumeas'].",nama_equipment,nama_item_lhu");
        if($lp["qc_self"] == 1){
          $data['kondisi1'] = array('tgl_lhu >='=>$lp["tgl_awal"],'tgl_lhu <='=>$lp["tgl_akhir"],$data['id_peg']=>$data['pegawai'],$data['ins']=>$data['idinst']);
        }else{
        //  $data['kondisi1'] = array('tgl_lhu >='=>$lp["tgl_awal"],'tgl_lhu <='=>$lp["tgl_akhir"],'ol_equipment.id_unit'=>$this->session->unit);
          $data['kondisi1'] = array('tgl_lhu >='=>$lp["tgl_awal"],'tgl_lhu <='=>$lp["tgl_akhir"],$data['ins']=>$lp["id_instansi"]);
        }
        $data['ambil_lhu'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']);
        $data['grup_lhu'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrup'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],$data['grup_item']);
        $data['ambil_bulan'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],'MONTH('.$data['tgl_item'].')');
        //============================================================================= GRAFIK
        $data['js_thn'] = 'js_thn';
        $data['js_bln'] = 'js_bln';
        $data['js_hr'] = 'js_hr';
        $data['tgl_bln'] = 'tgl_bln';
        $data['tgl_hr'] = 'tgl_hr';
        $data['tgl_thn'] = 'tgl_thn';
        $data['selectgrafik5'] = ("sum(".$data['jml_item'].") as ".$data['jml_item'].",".$data['grup_item']." as ".$data['id_item'].",DATE_FORMAT(".$data['tgl_item'].",'%d-%m-%Y') as ".$data['tgl_hr'].",DATE_FORMAT(".$data['tgl_item'].",'%m-%Y') as ".$data['tgl_bln'].",DATE_FORMAT(".$data['tgl_item'].",'%Y') as ".$data['tgl_thn'].",".$data['tgl_item']." as ".$data['tgl_item'].",MONTH(".$data['tgl_item'].") as ".$data['js_bln'].",YEAR(".$data['tgl_item'].") as ".$data['js_thn'].",DATE_FORMAT(".$data['tgl_item'].",'%d') as ".$data['js_hr'].",concat(".$data['nama_item1'].",' - ',".$data['nama_item2'].") as ".$data['nama_item']."  ");
        $data['selectgrafikhr'] = (" ".$data['grup_item']." as ".$data['id_item'].",DATE_FORMAT(".$data['tgl_item'].",'%d-%m-%Y') as ".$data['tgl_hr'].",DATE_FORMAT(".$data['tgl_item'].",'%m-%Y') as ".$data['tgl_bln'].",DATE_FORMAT(".$data['tgl_item'].",'%Y') as ".$data['tgl_thn'].",".$data['tgl_item']." as ".$data['tgl_item'].",MONTH(".$data['tgl_item'].") as ".$data['js_bln'].",YEAR(".$data['tgl_item'].") as ".$data['js_thn'].",DATE_FORMAT(".$data['tgl_item'].",'%d') as ".$data['js_hr'].",  ");
        $data['grafik5'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafik5'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],'MONTH('.$data['tgl_item'].')');
        $data['grafikhr'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafikhr'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],$data['tgl_item']);
        $data['legendgrafik5'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],$data['grup_item']);
        $data['ambil_data_min'] = $this->m_ol_laporan->get_min($data['idtab'],$data['tabel_item'],$data['jml_item'],$data['kondisi1'],$lp["lhu"]);
        $data['ambil_data_max'] = $this->m_ol_laporan->get_max($data['idtab'],$data['tabel_item'],$data['jml_item'],$data['kondisi1'],$lp["lhu"]);
        $data['grafikpie'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafik5'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],$data['id_item']);
      }
      //============================================================================= lhu 5
      if($lp["lhu"] == 5){
        $data['text'] = 'SUMBER DATA : PENDAFTARAN PASIEN';
        $data['tabel_item'] = 'tindakan_daftar';
        $data['grup_item'] = 'tindakan_daftar.id_tindakan';
        $data['nama_item1'] = 'nama_tindakan';
        $data['nama_item2'] = 'nama_golongan_pemeriksaan';
        $data['id_item'] = 'id_tindakan';
        $data['coun_item'] = 'coun_tindakan_daftar';
        $data['nama_item'] = 'nama_tindakan';
        $data['order'] = 'tindakan_daftar.id_tindakan';
        $data['tgl_item'] = 'tgl_daftar';
        $data['sume'] = 'tindakan_daftar.id_tindakan';
        $data['sumeas'] = 'jml_tindakan';
        $data['jml_item'] = 'jml_tindakan';
        $data['id_peg'] = 'tindakan_daftar.pendaftar';
        $data['pegawai'] = $lp['id_pegawai'];
        $data['ins'] = 'unit_tindakan';
        $data['idinst'] = $lp["id_unit"];
        //=======================
$data['tabel_seting'] = 'tindakan';
$data['nama_seting'] = 'id_tindakan';
$data['ket_seting'] = 'seting';
$data['tabel_isi'] = 'tindakan_daftar';
$data['nama_isi'] = 'id_daftar';
$data['ket_isi'] = 'isi';   
//=======================
$kondisi_seting = array('id_laporan_tabel'=>$data['idtab'],'nama_source'=>$data['nama_seting'],'tabel_source'=>$data['tabel_seting'],'ket_source'=>$data['ket_seting'],'status_laporan_tabel_detil'=>1,'pembuat_source'=>$this->session->barcode_pegawai);
$kondisi_isi = array('id_laporan_tabel'=>$data['idtab'],'nama_source'=>$data['nama_isi'],'tabel_source'=>$data['tabel_isi'],'ket_source'=>$data['ket_isi'],'status_laporan_tabel_detil'=>1,'pembuat_source'=>$this->session->barcode_pegawai);
        $data['jml_isi'] = $this->m_umum->jumlah_record_filter('ol_logbook_laporan_tabel_detil',$kondisi_isi);
        $data['jml_seting'] = $this->m_umum->jumlah_record_filter('ol_logbook_laporan_tabel_detil',$kondisi_seting);
        $data['arr_seting'] = $this->m_umum->ambil_data_kondisi_result('ol_logbook_laporan_tabel_detil',$kondisi_seting);
        $data['arr_isi'] = $this->m_umum->ambil_data_kondisi_result('ol_logbook_laporan_tabel_detil',$kondisi_isi);
        // ,$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']
//=====================================
        $data['select1'] = ("*");
        $data['selectgrup'] = ("count(".$data['sume'].") as ".$data['sumeas'].",nama_tindakan,nama_golongan_pemeriksaan");
        $data['kondisi1'] = array('tgl_daftar >='=>$lp["tgl_awal"],'tgl_daftar <='=>$lp["tgl_akhir"],$data['ins']=>$data['idinst']);
        $data['ambil_lhu'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']);
        $data['grup_lhu'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrup'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],$data['grup_item']);
        $data['ambil_bulan'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],'MONTH('.$data['tgl_item'].')');
        //============================================================================= GRAFIK
        $data['js_thn'] = 'js_thn';
        $data['js_bln'] = 'js_bln';
        $data['js_hr'] = 'js_hr';
        $data['tgl_bln'] = 'tgl_bln';
        $data['tgl_hr'] = 'tgl_hr';
        $data['tgl_thn'] = 'tgl_thn';
        $data['selectgrafik5'] = ("count(".$data['sume'].") as ".$data['sumeas'].",".$data['grup_item']." as ".$data['id_item'].",DATE_FORMAT(".$data['tgl_item'].",'%d-%m-%Y') as ".$data['tgl_hr'].",DATE_FORMAT(".$data['tgl_item'].",'%m-%Y') as ".$data['tgl_bln'].",DATE_FORMAT(".$data['tgl_item'].",'%Y') as ".$data['tgl_thn'].",".$data['tgl_item']." as ".$data['tgl_item'].",MONTH(".$data['tgl_item'].") as ".$data['js_bln'].",YEAR(".$data['tgl_item'].") as ".$data['js_thn'].",DATE_FORMAT(".$data['tgl_item'].",'%d') as ".$data['js_hr'].",concat(".$data['nama_item1'].",' - ',".$data['nama_item2'].") as ".$data['nama_item']."  ");
        $data['selectgrafikhr'] = (" ".$data['grup_item']." as ".$data['id_item'].",DATE_FORMAT(".$data['tgl_item'].",'%d-%m-%Y') as ".$data['tgl_hr'].",DATE_FORMAT(".$data['tgl_item'].",'%m-%Y') as ".$data['tgl_bln'].",DATE_FORMAT(".$data['tgl_item'].",'%Y') as ".$data['tgl_thn'].",".$data['tgl_item']." as ".$data['tgl_item'].",MONTH(".$data['tgl_item'].") as ".$data['js_bln'].",YEAR(".$data['tgl_item'].") as ".$data['js_thn'].",DATE_FORMAT(".$data['tgl_item'].",'%d') as ".$data['js_hr'].",  ");
        $data['grafik5'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafik5'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],'MONTH('.$data['tgl_item'].')');
        $data['grafikhr'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafikhr'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],$data['tgl_item']);
        $data['legendgrafik5'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],$data['grup_item']);
        $data['ambil_data_min'] = $lp["min_laporan_tabel"];
        $data['ambil_data_max'] = $lp["max_laporan_tabel"];
        $data['grafikpie'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafik5'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],$data['id_item']);
      }
      //============================================================================= lhu 7
      if($lp["lhu"] == 7){
        $data['text'] = 'SUMBER DATA : BERKAS';
        $data['tabel_item'] = 'ol_berkas';
        $data['grup_item'] = 'ol_berkas.id_kategori_berkas';
        $data['nama_item1'] = 'nama_berkas_kategori';
        $data['nama_item2'] = 'nama_berkas_kategori';
        $data['id_item'] = 'id_berkas';
        $data['coun_item'] = 'id_berkas';
        $data['nama_item'] = 'nama_berkas';
        $data['order'] = 'ol_berkas.tgl_b_berkas';
        $data['tgl_item'] = 'tgl_b_berkas';
        $data['sume'] = 'ol_berkas.kredit';
        $data['sumeas'] = 'coun_berkas';
        $data['jml_item'] = 'coun_berkas';
        $data['id_peg'] = 'ol_berkas.id_pegawai';
        $data['pegawai'] = $lp['id_pegawai'];
        $data['ins'] = 'ol_berkas.id_pegawai';
        $data['idinst'] = $lp["id_pegawai"];
        //=======================
$data['tabel_seting'] = 'ol_berkas_kategori';
$data['nama_seting'] = 'id_berkas_kategori';
$data['ket_seting'] = 'seting';
$data['tabel_isi'] = 'ol_berkas';
$data['nama_isi'] = 'id_berkas';
$data['ket_isi'] = 'isi'; 
//=======================
$kondisi_seting = array('id_laporan_tabel'=>$data['idtab'],'nama_source'=>$data['nama_seting'],'tabel_source'=>$data['tabel_seting'],'ket_source'=>$data['ket_seting'],'status_laporan_tabel_detil'=>1,'pembuat_source'=>$this->session->barcode_pegawai);
$kondisi_isi = array('id_laporan_tabel'=>$data['idtab'],'nama_source'=>$data['nama_isi'],'tabel_source'=>$data['tabel_isi'],'ket_source'=>$data['ket_isi'],'status_laporan_tabel_detil'=>1,'pembuat_source'=>$this->session->barcode_pegawai);
        $data['jml_isi'] = $this->m_umum->jumlah_record_filter('ol_logbook_laporan_tabel_detil',$kondisi_isi);
        $data['jml_seting'] = $this->m_umum->jumlah_record_filter('ol_logbook_laporan_tabel_detil',$kondisi_seting);
        $data['arr_seting'] = $this->m_umum->ambil_data_kondisi_result('ol_logbook_laporan_tabel_detil',$kondisi_seting);
        $data['arr_isi'] = $this->m_umum->ambil_data_kondisi_result('ol_logbook_laporan_tabel_detil',$kondisi_isi);
        // ,$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']
//=====================================
        $data['select1'] = ("*");
        $data['selectgrup'] = ("sum(".$data['sume'].") as ".$data['sumeas'].",nama_berkas,nama_berkas_kategori");
        $data['kondisi1'] = array('tgl_b_berkas >='=>$lp["tgl_awal"],'tgl_b_berkas <='=>$lp["tgl_akhir"],$data['ins']=>$data['idinst'],'link_berkas !='=>'','status_berkas'=>1);
        $data['ambil_lhu'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']);
        $data['grup_lhu'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrup'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],$data['grup_item']);
        $data['ambil_bulan'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],'MONTH('.$data['tgl_item'].')');
        $data['kondisi_berkas'] = array('id_kategori_berkas >'=>13,'link_berkas !='=>'','status_berkas'=>1,$data['ins']=>$data['idinst']);
        $data['kondisi_imut'] = array('id_kategori_berkas'=>12,'link_berkas !='=>'','status_berkas'=>1,$data['ins']=>$data['idinst']);
        $data['kondisi_ijasah'] = array('id_kategori_berkas'=>7,'link_berkas !='=>'','status_berkas'=>1,$data['ins']=>$data['idinst']);
        $data['kondisi_pelatihan'] = array('kunci'=>1,'link_berkas !='=>'','status_berkas'=>1,$data['ins']=>$data['idinst']);
        $data['kondisi_str'] = array('kunci'=>0,'link_berkas !='=>'','status_berkas'=>1,$data['ins']=>$data['idinst']);
        $data['jml_berkas'] = $this->m_ol_laporan->jumlah_sumber_data($data['idtab'],$data['tabel_item'],$data['kondisi_berkas'],$lp["lhu"]);
        $data['jml_imut'] = $this->m_ol_laporan->jumlah_sumber_data($data['idtab'],$data['tabel_item'],$data['kondisi_imut'],$lp["lhu"]);
        $data['jml_ijasah'] = $this->m_ol_laporan->jumlah_sumber_data($data['idtab'],$data['tabel_item'],$data['kondisi_ijasah'],$lp["lhu"]);
        $data['jml_pelatihan'] = $this->m_ol_laporan->jumlah_sumber_data($data['idtab'],$data['tabel_item'],$data['kondisi_pelatihan'],$lp["lhu"]);
        $data['jml_str'] = $this->m_ol_laporan->jumlah_sumber_data($data['idtab'],$data['tabel_item'],$data['kondisi_str'],$lp["lhu"]);
        $data['ambil_berkas'] = $this->m_ol_laporan->set_isi_sumber_data($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi_berkas'],$lp["lhu"],$data['order'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']);
        $data['ambil_imut'] = $this->m_ol_laporan->set_isi_sumber_data($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi_imut'],$lp["lhu"],$data['order'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']);
        $data['ambil_ijasah'] = $this->m_ol_laporan->set_isi_sumber_data($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi_ijasah'],$lp["lhu"],$data['order'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']);
        $data['ambil_pelatihan'] = $this->m_ol_laporan->set_isi_sumber_data($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi_pelatihan'],$lp["lhu"],$data['order'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']);
        $data['ambil_str'] = $this->m_ol_laporan->set_isi_sumber_data($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi_str'],$lp["lhu"],$data['order'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']);
        //============================================================================= GRAFIK
        $data['js_thn'] = 'js_thn';
        $data['js_bln'] = 'js_bln';
        $data['js_hr'] = 'js_hr';
        $data['tgl_bln'] = 'tgl_bln';
        $data['tgl_hr'] = 'tgl_hr';
        $data['tgl_thn'] = 'tgl_thn';
        $data['selectgrafik5'] = ("count(".$data['sume'].") as ".$data['sumeas'].",".$data['grup_item']." as ".$data['id_item'].",DATE_FORMAT(".$data['tgl_item'].",'%d-%m-%Y') as ".$data['tgl_hr'].",DATE_FORMAT(".$data['tgl_item'].",'%m-%Y') as ".$data['tgl_bln'].",DATE_FORMAT(".$data['tgl_item'].",'%Y') as ".$data['tgl_thn'].",".$data['tgl_item']." as ".$data['tgl_item'].",MONTH(".$data['tgl_item'].") as ".$data['js_bln'].",YEAR(".$data['tgl_item'].") as ".$data['js_thn'].",DATE_FORMAT(".$data['tgl_item'].",'%d') as ".$data['js_hr'].",concat(".$data['nama_item1'].",' - ',".$data['nama_item2'].") as ".$data['nama_item']."  ");
        $data['selectgrafikhr'] = (" ".$data['grup_item']." as ".$data['id_item'].",DATE_FORMAT(".$data['tgl_item'].",'%d-%m-%Y') as ".$data['tgl_hr'].",DATE_FORMAT(".$data['tgl_item'].",'%m-%Y') as ".$data['tgl_bln'].",DATE_FORMAT(".$data['tgl_item'].",'%Y') as ".$data['tgl_thn'].",".$data['tgl_item']." as ".$data['tgl_item'].",MONTH(".$data['tgl_item'].") as ".$data['js_bln'].",YEAR(".$data['tgl_item'].") as ".$data['js_thn'].",DATE_FORMAT(".$data['tgl_item'].",'%d') as ".$data['js_hr'].",  ");
        $data['grafik5'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafik5'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],'MONTH('.$data['tgl_item'].')');
        $data['grafikhr'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafikhr'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],$data['tgl_item']);
        $data['legendgrafik5'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],$data['grup_item']);
        $data['ambil_data_min'] = $lp["min_laporan_tabel"];
        $data['ambil_data_max'] = $lp["max_laporan_tabel"];
        $data['grafikpie'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafik5'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],$data['id_item']);
        //============================================================================= GRAFIK
        $data['js_thn'] = 'js_thn';
        $data['js_bln'] = 'js_bln';
        $data['js_hr'] = 'js_hr';
        $data['tgl_bln'] = 'tgl_bln';
        $data['tgl_hr'] = 'tgl_hr';
        $data['tgl_thn'] = 'tgl_thn';
        $data['selectgrafik5'] = ("sum(".$data['jml_item'].") as ".$data['jml_item'].",".$data['grup_item']." as ".$data['id_item'].",DATE_FORMAT(".$data['tgl_item'].",'%d-%m-%Y') as ".$data['tgl_hr'].",DATE_FORMAT(".$data['tgl_item'].",'%m-%Y') as ".$data['tgl_bln'].",DATE_FORMAT(".$data['tgl_item'].",'%Y') as ".$data['tgl_thn'].",".$data['tgl_item']." as ".$data['tgl_item'].",MONTH(".$data['tgl_item'].") as ".$data['js_bln'].",YEAR(".$data['tgl_item'].") as ".$data['js_thn'].",DATE_FORMAT(".$data['tgl_item'].",'%d') as ".$data['js_hr'].",concat(".$data['nama_item1'].",' - ',".$data['nama_item2'].") as ".$data['nama_item']."  ");
        $data['selectgrafikhr'] = (" ".$data['grup_item']." as ".$data['id_item'].",DATE_FORMAT(".$data['tgl_item'].",'%d-%m-%Y') as ".$data['tgl_hr'].",DATE_FORMAT(".$data['tgl_item'].",'%m-%Y') as ".$data['tgl_bln'].",DATE_FORMAT(".$data['tgl_item'].",'%Y') as ".$data['tgl_thn'].",".$data['tgl_item']." as ".$data['tgl_item'].",MONTH(".$data['tgl_item'].") as ".$data['js_bln'].",YEAR(".$data['tgl_item'].") as ".$data['js_thn'].",DATE_FORMAT(".$data['tgl_item'].",'%d') as ".$data['js_hr'].",  ");
        $data['grafik5'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafik5'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],'MONTH('.$data['tgl_item'].')');
        $data['grafikhr'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafikhr'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],$data['tgl_item']);
        $data['legendgrafik5'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],$data['grup_item']);
        $data['ambil_data_min'] = $this->m_ol_laporan->get_min($data['idtab'],$data['tabel_item'],$data['jml_item'],$data['kondisi1'],$lp["lhu"]);
        $data['ambil_data_max'] = $this->m_ol_laporan->get_max($data['idtab'],$data['tabel_item'],$data['jml_item'],$data['kondisi1'],$lp["lhu"]);
        $data['grafikpie'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafik5'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],$data['id_item']);
      }
      //============================================================================= lhu 8
      if($lp["lhu"] == 8){
        $data['text'] = 'SUMBER DATA : EVEN DENGAN ABSENSI LOKASI';
        $data['tabel_item'] = 'abs_even';
        $data['grup_item'] = 'tgl_even';
        $data['nama_item1'] = 'nama_even';
        $data['nama_item2'] = 'alamat_even';
        $data['id_item'] = 'id_even';
        $data['coun_item'] = 'coun_even';
        $data['nama_item'] = 'nama_even';
        $data['order'] = 'tgl_even';
        $data['tgl_item'] = 'tgl_even';
        $data['sume'] = 'id_even';
        $data['sumeas'] = 'coun_even';
        $data['jml_item'] = 'coun_even';
        $data['id_peg'] = 'abs_even.barcode_pegawai';
        $data['pegawai'] = $lp['barcode_pegawai'];
        $data['ins'] = 'unit';
        $data['idinst'] = $lp["id_unit"];
        //=======================
$data['tabel_seting'] = 'abs_even';
$data['nama_seting'] = 'id_even';
$data['ket_seting'] = 'seting';
$data['tabel_isi'] = 'abs_even';
$data['nama_isi'] = 'id_even';
$data['ket_isi'] = 'isi'; 
//=======================
$kondisi_seting = array('id_laporan_tabel'=>$data['idtab'],'nama_source'=>$data['nama_seting'],'tabel_source'=>$data['tabel_seting'],'ket_source'=>$data['ket_seting'],'status_laporan_tabel_detil'=>1,'pembuat_source'=>$this->session->barcode_pegawai);
$kondisi_isi = array('id_laporan_tabel'=>$data['idtab'],'nama_source'=>$data['nama_isi'],'tabel_source'=>$data['tabel_isi'],'ket_source'=>$data['ket_isi'],'status_laporan_tabel_detil'=>1,'pembuat_source'=>$this->session->barcode_pegawai);
        $data['jml_isi'] = $this->m_umum->jumlah_record_filter('ol_logbook_laporan_tabel_detil',$kondisi_isi);
        $data['jml_seting'] = $this->m_umum->jumlah_record_filter('ol_logbook_laporan_tabel_detil',$kondisi_seting);
        $data['arr_seting'] = $this->m_umum->ambil_data_kondisi_result('ol_logbook_laporan_tabel_detil',$kondisi_seting);
        $data['arr_isi'] = $this->m_umum->ambil_data_kondisi_result('ol_logbook_laporan_tabel_detil',$kondisi_isi);
        // ,$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']
//=====================================
        $data['select1'] = ("*");
        $data['selectgrup'] = ("sum(".$data['jml_item'].") as ".$data['jml_item'].",nama_even,alamat_even");
        $data['kondisi1'] = array('tgl_even >='=>$lp["tgl_awal"],'tgl_even <='=>$lp["tgl_akhir"],$data['ins']=>$data['idinst']);
        $data['ambil_lhu'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']);
        $data['grup_lhu'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrup'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],$data['grup_item']);
        $data['ambil_bulan'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],'MONTH('.$data['tgl_item'].')');
        //============================================================================= GRAFIK
        $data['js_thn'] = 'js_thn';
        $data['js_bln'] = 'js_bln';
        $data['js_hr'] = 'js_hr';
        $data['tgl_bln'] = 'tgl_bln';
        $data['tgl_hr'] = 'tgl_hr';
        $data['tgl_thn'] = 'tgl_thn';
        $data['selectgrafik5'] = ("sum(".$data['jml_item'].") as ".$data['jml_item'].",".$data['grup_item']." as ".$data['id_item'].",DATE_FORMAT(".$data['tgl_item'].",'%d-%m-%Y') as ".$data['tgl_hr'].",DATE_FORMAT(".$data['tgl_item'].",'%m-%Y') as ".$data['tgl_bln'].",DATE_FORMAT(".$data['tgl_item'].",'%Y') as ".$data['tgl_thn'].",".$data['tgl_item']." as ".$data['tgl_item'].",MONTH(".$data['tgl_item'].") as ".$data['js_bln'].",YEAR(".$data['tgl_item'].") as ".$data['js_thn'].",DATE_FORMAT(".$data['tgl_item'].",'%d') as ".$data['js_hr'].",concat(".$data['nama_item1'].",' - ',".$data['nama_item2'].") as ".$data['nama_item']."  ");
        $data['selectgrafikhr'] = (" ".$data['grup_item']." as ".$data['id_item'].",DATE_FORMAT(".$data['tgl_item'].",'%d-%m-%Y') as ".$data['tgl_hr'].",DATE_FORMAT(".$data['tgl_item'].",'%m-%Y') as ".$data['tgl_bln'].",DATE_FORMAT(".$data['tgl_item'].",'%Y') as ".$data['tgl_thn'].",".$data['tgl_item']." as ".$data['tgl_item'].",MONTH(".$data['tgl_item'].") as ".$data['js_bln'].",YEAR(".$data['tgl_item'].") as ".$data['js_thn'].",DATE_FORMAT(".$data['tgl_item'].",'%d') as ".$data['js_hr'].",  ");
        $data['grafik5'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafik5'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],'MONTH('.$data['tgl_item'].')');
        $data['grafikhr'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafikhr'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],$data['tgl_item']);
        $data['legendgrafik5'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],$data['grup_item']);
        $data['ambil_data_min'] = $lp["min_laporan_tabel"];
        $data['ambil_data_max'] = $lp["max_laporan_tabel"];
        $data['grafikpie'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafik5'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],$data['id_item']);
      }
      //============================================================================= !LHU
    if($mode=='view'){
      $this->tampil_top($data);
    }
    //============================================================================= !MODE = VIEW
    else if($mode=='data'){
      echo json_encode($this->m_ol_laporan->logbook_laporan_tabel_all($data['idlap']));
    }
    else{
      if($mode=='seting_kompetensi'){
        $data['page'] =  $data['page']."_seting_kompetensi";
        $kondisi_cek = array('id_laporan_tabel'=>$data['idtab'],'barcode_pegawai'=>$this->session->barcode_pegawai);
        $data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('ol_logbook_laporan_tabel',$kondisi_cek,'ol_logbook_laporan','id_laporan'); 
        $kondisi_row = array('id_laporan_tabel'=>$data['idtab']);
        $lp = $this->m_umum->ambil_data_kondisi_2tabel_row('ol_logbook_laporan_tabel',$kondisi_row,'ol_logbook_laporan','id_laporan');  
        $data['barcode_pegawai']  = set_value('barcode_pegawai',$lp["barcode_pegawai"]);
        $worke = $this->m_umum->ambil_data('ol_unit','id_unit',$lp['id_unit']);
        $peg = $this->m_umum->ambil_data('ol_pegawai','barcode_pegawai',$lp['barcode_pegawai']);
        $data['id_laporan']  = set_value('id_laporan',$lp["id_laporan"]);
        $data['id_laporan_tabel']  = set_value('id_laporan_tabel',$lp["id_laporan_tabel"]);
//========================================= lhu 1
        if($lp["lhu"] == 1){
          $select = ("*");
          $kondisi = array('tgl_logbook >='=>$lp["tgl_awal"],'tgl_logbook <='=>$lp["tgl_akhir"],'id_logbooker'=>$peg['id_pegawai'],'id_instansi'=>$worke['id_instansi']);
          $data['tabel_source'] = 'nkr_kewenangan';
          $data['nama_source'] = 'id_kompetensi';
          $data['tabel_item'] = 'ol_logbook';
          $data['grup_item'] = 'nkr_kewenangan.id_kompetensi';
          $data['explo'] = $lp["kompetensi"];
          $data['field'] = 'kompetensi';
          $data['id_item'] = 'id_kompetensi';
       //   $data['id_item'] = 'coun_kompetensi';
          $data['nama_item1'] = 'nama_kompetensi';
          $data['nama_item2'] = 'nama_kewenangan';        
        }
//========================================= lhu 4
        if($lp["lhu"] == 4){
          $select = ("*");
          $kondisi = array('tgl_lhu >='=>$lp["tgl_awal"],'tgl_lhu <='=>$lp["tgl_akhir"],'ol_logbook_lhu.barcode_pegawai'=>$peg['barcode_pegawai'],'ol_unit.id_instansi'=>$worke['id_instansi']);
          $data['tabel_source'] = 'ol_logbook_item_lhu';
          $data['nama_source'] = 'id_item_lhu';
          $data['tabel_item'] = 'ol_logbook_lhu_detil';
          $data['grup_item'] = 'ol_logbook_lhu_detil.id_item_lhu';
          $data['explo'] = $lp["item_lhu"];
          $data['field'] = 'item_lhu';
          $data['id_item'] = 'id_item_lhu';
     //     $data['id_item'] = 'in_item_lhu';
          $data['nama_item1'] = 'nama_item_lhu';
          $data['nama_item2'] = 'nama_equipment';       
        }
        if($lp["lhu"] == 5){
          $select = ("*");
          $kondisi = array('tgl_daftar >='=>$lp["tgl_awal"],'tgl_daftar <='=>$lp["tgl_akhir"],'unit_tindakan'=>$worke['id_unit']);
          $data['tabel_source'] = 'tindakan';
          $data['nama_source'] = 'id_tindakan';
          $data['tabel_item'] = 'tindakan_daftar';
          $data['grup_item'] = 'tindakan_daftar.id_tindakan';
          $data['explo'] = $lp["tindakan"];
          $data['field'] = 'tindakan';
          $data['id_item'] = 'id_tindakan';
       //   $data['id_item'] = 'in_tindakan';
          $data['nama_item1'] = 'nama_tindakan';
          $data['nama_item2'] = 'nama_golongan_pemeriksaan';        
        }
        if($lp["lhu"] == 7){
          $select = ("*");
          $kondisi = array('ol_berkas.id_pegawai'=>0,'status_berkas'=>1);
          $data['tabel_source'] = 'ol_berkas';
          $data['nama_source'] = 'id_berkas';
          $data['tabel_item'] = 'ol_berkas';
          $data['grup_item'] = 'ol_berkas.id_kategori_berkas';
          $data['explo'] = $lp["berkas"];
          $data['field'] = 'berkas';
          $data['id_item'] = 'id_berkas';
          $data['nama_item1'] = 'nama_berkas_kategori';
          $data['nama_item2'] = 'nama_berkas_kategori';       
        }
        if($lp["lhu"] == 8){
          $data['tabel_source'] = 'abs_even';
          $data['nama_source'] = 'id_even';
          $data['tabel_item'] = 'abs_even';
          $data['grup_item'] = 'tgl_even';
          $data['nama_item1'] = 'nama_even';
          $data['nama_item2'] = 'alamat_even';
          $data['id_item'] = 'id_even';
        //  $data['id_item'] = 'coun_even';
          $select = ("*");
          $kondisi = array('abs_even.barcode_pegawai'=>0);
          $data['explo'] = $lp["even"];
          $data['field'] = 'even';      
        }
        $data['chk_item']=$this->m_ol_laporan->set_sumber_data($data['tabel_item'],$select,$kondisi,$lp["lhu"],$data['grup_item']); 
        $this->load->view("ol_laporan/isi",$data);
      }
      if($mode=='simpan_seting_kompetensi'){
        $id_laporan = $this->input->post("id_laporan");
        $id_laporan_tabel = $this->input->post("id_laporan_tabel");
        $barcode_pegawai = $this->input->post("barcode_pegawai");
        if($barcode_pegawai == $this->session->barcode_pegawai){
           $this->m_ol_laporan->seting_tabel_detil();
            $this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
        }else{
            $this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));         
        }
      }
      if($mode=='seting_isi_kompetensi'){
        $data['page'] =  $data['page']."_seting_isi_kompetensi";
        $kondisi_cek = array('id_laporan_tabel'=>$data['idtab'],'barcode_pegawai'=>$this->session->barcode_pegawai);
        $data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('ol_logbook_laporan_tabel',$kondisi_cek,'ol_logbook_laporan','id_laporan');
        $kondisi_row = array('id_laporan_tabel'=>$data['idtab']);
        $lp = $this->m_umum->ambil_data_kondisi_2tabel_row('ol_logbook_laporan_tabel',$kondisi_row,'ol_logbook_laporan','id_laporan');
        $worke = $this->m_umum->ambil_data('ol_unit','id_unit',$lp['id_unit']);
        $peg = $this->m_umum->ambil_data('ol_pegawai','barcode_pegawai',$lp['barcode_pegawai']);  
        $data['barcode_pegawai']  = set_value('barcode_pegawai',$lp["barcode_pegawai"]);
        $data['id_laporan']  = set_value('id_laporan',$lp["id_laporan"]);
        $data['id_laporan_tabel']  = set_value('id_laporan_tabel',$lp["id_laporan_tabel"]);
        $data['lhu']  = set_value('lhu',$lp["lhu"]);
        $data['ket_source']  = 'isi';
//========================================= lhu 1       
        if($lp["lhu"] == 1){
$select = ("*");
$kondisi = array('tgl_logbook >='=>$lp["tgl_awal"],'tgl_logbook <='=>$lp["tgl_akhir"],'id_logbooker'=>$peg['id_pegawai'],'id_instansi'=>$worke['id_instansi'],'jml_logbook >'=>0);
$data['tabel_source'] = 'nkr_kewenangan';
$data['nama_source'] = 'id_kewenangan';
$data['tabel_item'] = 'ol_logbook';
$data['grup_item'] = 'nkr_kewenangan.id_kompetensi';
$data['explo'] = $lp["isi_kompetensi"];
$data['field'] = 'isi_kompetensi';
//$data['id_item'] = 'coun_logbook';
$data['id_item'] = 'id_kewenangan';
$data['nama_item1'] = 'nama_kompetensi';
$data['nama_item2'] = 'nama_kewenangan';
$data['tgl_item'] = 'tgl_logbook';
$data['jml_item'] = 'jml_logbook';
$data['nama_pegawai'] = 'nama_pegawai'; 
$data['tabel_seting'] = 'nkr_kewenangan';
$data['nama_seting'] = 'id_kewenangan';
$data['ket_seting'] = 'seting';
$data['tabel_isi'] = 'ol_logbook';
$data['nama_isi'] = 'id_logbook';
$data['ket_isi'] = 'isi';
        }
        if($lp["lhu"] == 4){
$select = ("*");
if($lp["qc_self"] == 1){
  $kondisi = array('tgl_lhu >='=>$lp["tgl_awal"],'tgl_lhu <='=>$lp["tgl_akhir"],'ol_logbook_lhu.barcode_pegawai'=>$peg['barcode_pegawai'],'ol_unit.id_instansi'=>$worke['id_instansi']);
}else{
  $kondisi = array('tgl_lhu >='=>$lp["tgl_awal"],'tgl_lhu <='=>$lp["tgl_akhir"],'ol_unit.id_instansi'=>$worke['id_instansi']);
}
$data['tabel_source'] = 'ol_logbook_lhu_detil';
$data['nama_source'] = 'id_lhu_detil';
$data['tabel_item'] = 'ol_logbook_lhu_detil';
$data['grup_item'] = 'ol_logbook_lhu_detil.id_item_lhu';
$data['explo'] = $lp["i_mutu"];
$data['field'] = 'i_mutu';
//$data['id_item'] = 'coun_lhu_detil';
$data['id_item'] = 'id_lhu_detil';
$data['nama_item1'] = 'nama_item_lhu';
$data['nama_item2'] = 'nama_equipment';
$data['tgl_item'] = 'tgl_lhu';
$data['jml_item'] = 'hasil_lhu_detil';
$data['nama_pegawai'] = 'nama_pegawai';
$data['tabel_seting'] = 'ol_logbook_lhu_detil';
$data['nama_seting'] = 'id_lhu_detil';
$data['ket_seting'] = 'seting';
$data['tabel_isi'] = 'ol_logbook_item_lhu';
$data['nama_isi'] = 'id_item_lhu';
$data['ket_isi'] = 'isi';     
        }
        if($lp["lhu"] == 5){
$select = ("*");
$kondisi = array('tgl_daftar >='=>$lp["tgl_awal"],'tgl_daftar <='=>$lp["tgl_akhir"],'unit_tindakan'=>$lp["id_unit"]);
$data['tabel_source'] = 'tindakan_daftar';
$data['nama_source'] = 'id_daftar';
$data['tabel_item'] = 'tindakan_daftar';
$data['grup_item'] = 'tindakan_daftar.id_tindakan';
$data['explo'] = $lp["tindakan"];
$data['field'] = 'tindakan';
//$data['id_item'] = 'in_tindakan';
$data['id_item'] = 'id_tindakan';
$data['nama_item1'] = 'nama_tindakan';
$data['nama_item2'] = 'nama_golongan_pemeriksaan';
$data['tgl_item'] = 'tgl_daftar';
$data['jml_item'] = 'status_tindakan';
$data['nama_pegawai'] = 'nama_pegawai';
$data['tabel_seting'] = 'tindakan';
$data['nama_seting'] = 'id_tindakan';
$data['ket_seting'] = 'seting';
$data['tabel_isi'] = 'tindakan_daftar';
$data['nama_isi'] = 'id_daftar';
$data['ket_isi'] = 'isi';         
        }
        if($lp["lhu"] == 7){
$select = ("*");
$kondisi = array('ol_berkas.id_pegawai'=>$peg['id_pegawai'],'status_berkas'=>1);
$data['tabel_source'] = 'ol_berkas';
$data['nama_source'] = 'id_berkas';
$data['tabel_item'] = 'ol_berkas';
$data['grup_item'] = 'ol_berkas.id_kategori_berkas';
$data['explo'] = $lp["berkas"];
$data['field'] = 'berkas';
$data['id_item'] = 'id_berkas';
$data['nama_item1'] = 'nama_berkas';
$data['nama_item2'] = 'nama_berkas_kategori';
$data['tgl_item'] = 'tgl_b_berkas';
$data['jml_item'] = 'status_berkas';
$data['nama_pegawai'] = 'nama_pegawai';
$data['tabel_seting'] = 'ol_berkas_kategori';
$data['nama_seting'] = 'id_berkas_kategori';
$data['ket_seting'] = 'seting';
$data['tabel_isi'] = 'ol_berkas';
$data['nama_isi'] = 'id_berkas';
$data['ket_isi'] = 'isi';         
        }
        if($lp["lhu"] == 8){
$data['tabel_source'] = 'abs_even';
$data['nama_source'] = 'id_even';
          $data['tabel_item'] = 'abs_even';
          $data['grup_item'] = 'tgl_even';
          $data['nama_item1'] = 'nama_even';
          $data['nama_item2'] = 'alamat_even';
          $data['id_item'] = 'id_even';
        //  $data['id_item'] = 'coun_even';
$data['tgl_item'] = 'tgl_even';
$data['jml_item'] = 'status_even';
$data['nama_pegawai'] = 'nama_pegawai';     
          $select = ("*");
          $kondisi = array('abs_even.barcode_pegawai'=>0);
          $data['explo'] = $lp["even"];
          $data['field'] = 'even';
$data['tabel_seting'] = 'abs_even';
$data['nama_seting'] = 'id_even';
$data['ket_seting'] = 'seting';
$data['tabel_isi'] = 'abs_even';
$data['nama_isi'] = 'id_even';
$data['ket_isi'] = 'isi';     
        }
$kondisi_implode = array('id_laporan_tabel'=>$data['idtab'],'nama_source'=>$data['nama_source'],'tabel_source'=>$data['tabel_source'],'ket_source'=>$data['ket_source'],'status_laporan_tabel_detil'=>1);
$data['arr_implode']=$this->m_umum->ambil_data_kondisi_2tabel_result('ol_logbook_laporan_tabel_detil',$kondisi_implode,$data['tabel_source'],'nama_source',$data['nama_source']); 
//=======================
$kondisi_seting = array('id_laporan_tabel'=>$data['idtab'],'nama_source'=>$data['nama_seting'],'tabel_source'=>$data['tabel_seting'],'ket_source'=>$data['ket_seting'],'status_laporan_tabel_detil'=>1,'pembuat_source'=>$this->session->barcode_pegawai);
$kondisi_isi = array('id_laporan_tabel'=>$data['idtab'],'nama_source'=>$data['nama_isi'],'tabel_source'=>$data['tabel_isi'],'ket_source'=>$data['ket_isi'],'status_laporan_tabel_detil'=>1,'pembuat_source'=>$this->session->barcode_pegawai);
$data['jml_isi'] = $this->m_umum->jumlah_record_filter('ol_logbook_laporan_tabel_detil',$kondisi_isi);
$data['jml_seting'] = $this->m_umum->jumlah_record_filter('ol_logbook_laporan_tabel_detil',$kondisi_seting);
$data['arr_seting'] = $this->m_umum->ambil_data_kondisi_result('ol_logbook_laporan_tabel_detil',$kondisi_seting);
$data['arr_isi'] = $this->m_umum->ambil_data_kondisi_result('ol_logbook_laporan_tabel_detil',$kondisi_isi);
//=====================================
$data['chk_item'] = $this->m_ol_laporan->set_isi_sumber_data($data['idtab'],$data['tabel_item'],$select,$kondisi,$lp["lhu"],$data['grup_item'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']);
        $this->load->view("ol_laporan/isi",$data);
      }
      if($mode=='simpan_seting_isi_kompetensi'){
        $id_laporan = $this->input->post("id_laporan");
        $id_laporan_tabel = $this->input->post("id_laporan_tabel");
        $barcode_pegawai = $this->input->post("barcode_pegawai");
        if($barcode_pegawai == $this->session->barcode_pegawai){
             $this->m_ol_laporan->seting_tabel_detil();
            $this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
        }else{
            $this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));         
        }
      }
      if($mode=='tambah_tabel'){
        $data['page'] =  $data['page']."_tambah_tabel";
        $kondisi_cek = array('id_laporan'=>$data['idlap'],'barcode_pegawai'=>$this->session->barcode_pegawai);
        $data['cek'] = $this->m_umum->jumlah_record_filter('ol_logbook_laporan',$kondisi_cek);    
        $data['id_laporan']  = $data['idlap'];        
        $data['judul_laporan_tabel']  = set_value('judul_laporan_tabel',$this->input->post("judul_laporan_tabel"));       
        $data['analisa_laporan_tabel']  = set_value('analisa_laporan_tabel',$this->input->post("analisa_laporan_tabel"));       
        $data['rekomendasi_laporan_tabel']  = set_value('rekomendasi_laporan_tabel',$this->input->post("rekomendasi_laporan_tabel")); 
        $this->load->view("ol_laporan/isi",$data);
      }
      if($mode=='simpan_tambah_tabel'){
        $id_laporan = $this->input->post("id_laporan");
        $id_laporan_tabel = $this->input->post("id_laporan_tabel");
        if($this->m_ol_laporan->tambah_tabel()){
          $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
          redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
        }else{
          $this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
          redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
        }
      }
      if($mode=='rubah_tabel'){
        $data['page'] =  $data['page']."_rubah_tabel";
        $kondisi_tabel = array('id_tabel <'=>10);
        $kondisi_cek = array('id_laporan_tabel'=>$data['idtab'],'barcode_pegawai'=>$this->session->barcode_pegawai);
        $data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('ol_logbook_laporan_tabel',$kondisi_cek,'ol_logbook_laporan','id_laporan'); 
        $data['ambil_tabel'] = $this->m_rancak->ambil_sn_tabel(); 
        $kondisi_row = array('id_laporan_tabel'=>$data['idtab']);
        $lp = $this->m_umum->ambil_data_kondisi_2tabel_row('ol_logbook_laporan_tabel',$kondisi_row,'ol_logbook_laporan','id_laporan');  
        $data['barcode_pegawai']  = set_value('barcode_pegawai',$lp["barcode_pegawai"]);
        $data['id_laporan']  = set_value('id_laporan',$lp["id_laporan"]);
        $data['id_laporan_tabel']  = set_value('id_laporan_tabel',$lp["id_laporan_tabel"]);
        $data['judul_laporan_tabel']  = set_value('judul_laporan_tabel',$lp["judul_laporan_tabel"]);
        $data['analisa_laporan_tabel']  = set_value('analisa_laporan_tabel',$lp["analisa_laporan_tabel"]);
        $data['rekomendasi_laporan_tabel']  = set_value('rekomendasi_laporan_tabel',$lp["rekomendasi_laporan_tabel"]);
        $this->load->view("ol_laporan/isi",$data);
      }
      if($mode=='simpan_rubah_tabel'){
        $id_laporan = $this->input->post("id_laporan");
        $id_laporan_tabel = $this->input->post("id_laporan_tabel");
        $barcode_pegawai = $this->input->post("barcode_pegawai");
        if($barcode_pegawai == $this->session->barcode_pegawai){
          if($this->m_ol_laporan->rubah_tabel()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
          }
        }else{
            $this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));         
        }
      }
      if($mode=='rubah_urutan'){
        $data['page'] =  $data['page']."_rubah_urutan";
        $kondisi_cek = array('id_laporan_tabel'=>$data['idtab'],'barcode_pegawai'=>$this->session->barcode_pegawai);
        $data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('ol_logbook_laporan_tabel',$kondisi_cek,'ol_logbook_laporan','id_laporan'); 
        $kondisi_row = array('id_laporan_tabel'=>$data['idtab']);
        $lp = $this->m_umum->ambil_data_kondisi_2tabel_row('ol_logbook_laporan_tabel',$kondisi_row,'ol_logbook_laporan','id_laporan');  
        $data['barcode_pegawai']  = set_value('barcode_pegawai',$lp["barcode_pegawai"]);
        $data['urutan_laporan_tabel']  = set_value('urutan_laporan_tabel',$lp["urutan_laporan_tabel"]);
        $data['id_laporan']  = set_value('id_laporan',$lp["id_laporan"]);
        $data['id_laporan_tabel']  = set_value('id_laporan_tabel',$lp["id_laporan_tabel"]);
        $this->load->view("ol_laporan/isi",$data);
      }
      if($mode=='simpan_rubah_urutan'){
        $id_laporan = $this->input->post("id_laporan");
        $id_laporan_tabel = $this->input->post("id_laporan_tabel");
        $barcode_pegawai = $this->input->post("barcode_pegawai");
        if($barcode_pegawai == $this->session->barcode_pegawai){
          if($this->m_ol_laporan->rubah_urutan()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
          }
        }else{
            $this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));         
        }
      }
      if($mode=='modif'){
        $data['page'] =  $data['page']."_modif";
        $kondisi_tabel = array('id_tabel <'=>10);
        $kondisi_cek = array('id_laporan_tabel'=>$data['idtab'],'barcode_pegawai'=>$this->session->barcode_pegawai);
        $data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('ol_logbook_laporan_tabel',$kondisi_cek,'ol_logbook_laporan','id_laporan'); 
        $data['ambil_tabel'] = $this->m_rancak->ambil_sn_tabel(); 
        $kondisi_row = array('id_laporan_tabel'=>$data['idtab']);
        $lp = $this->m_umum->ambil_data_kondisi_2tabel_row('ol_logbook_laporan_tabel',$kondisi_row,'ol_logbook_laporan','id_laporan');  
        $data['id_laporan_tabel']  = set_value('id_laporan_tabel',$lp["id_laporan_tabel"]);
        $data['tabel']  = set_value('tabel',$lp["tabel"]);
        $data['id_laporan']  = set_value('id_laporan',$lp["id_laporan"]);
        $data['id_laporan_tabel']  = set_value('id_laporan_tabel',$lp["id_laporan_tabel"]);
        $data['barcode_pegawai']  = set_value('barcode_pegawai',$lp["barcode_pegawai"]);
        $this->load->view("ol_laporan/isi",$data);
      }
      if($mode=='simpan_modif'){
        $id_laporan = $this->input->post("id_laporan");
        $id_laporan_tabel = $this->input->post("id_laporan_tabel");
        $barcode_pegawai = $this->input->post("barcode_pegawai");
        if($barcode_pegawai == $this->session->barcode_pegawai){
          if($this->m_ol_laporan->modif_tabel()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
          }
        }else{
            $this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));         
        }
      }
      if($mode=='seting_range'){
        $data['page'] =  $data['page']."_seting_range";
        $kondisi_cek = array('id_laporan_tabel'=>$data['idtab'],'barcode_pegawai'=>$this->session->barcode_pegawai);
        $data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('ol_logbook_laporan_tabel',$kondisi_cek,'ol_logbook_laporan','id_laporan'); 
        $kondisi_row = array('id_laporan_tabel'=>$data['idtab']);
        $lp = $this->m_umum->ambil_data_kondisi_2tabel_row('ol_logbook_laporan_tabel',$kondisi_row,'ol_logbook_laporan','id_laporan');  
        $data['barcode_pegawai']  = set_value('barcode_pegawai',$lp["barcode_pegawai"]);
        $data['id_laporan']  = set_value('id_laporan',$lp["id_laporan"]);
        $data['id_laporan_tabel']  = set_value('id_laporan_tabel',$lp["id_laporan_tabel"]);
        $data['min_laporan_tabel']  = set_value('min_laporan_tabel',$lp["min_laporan_tabel"]);
        $data['max_laporan_tabel']  = set_value('max_laporan_tabel',$lp["max_laporan_tabel"]);
        $this->load->view("ol_laporan/isi",$data);
      }
      if($mode=='simpan_seting_range'){
        $id_laporan = $this->input->post("id_laporan");
        $id_laporan_tabel = $this->input->post("id_laporan_tabel");
        $barcode_pegawai = $this->input->post("barcode_pegawai");
        if($barcode_pegawai == $this->session->barcode_pegawai){
          if($this->m_ol_laporan->seting_range()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
              redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
          }
        }else{
            $this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));         
        }
      }
      if($mode=='rubah_lhu'){
        $data['page'] =  $data['page']."_rubah_lhu";
        $data['cmd_lhu_personal'] = $this->m_rancak->cmd_lhu_personal();
        $kondisi_cek = array('id_laporan_tabel'=>$data['idtab'],'barcode_pegawai'=>$this->session->barcode_pegawai);
        $data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('ol_logbook_laporan_tabel',$kondisi_cek,'ol_logbook_laporan','id_laporan'); 
        $kondisi_row = array('id_laporan_tabel'=>$data['idtab']);
        $lp = $this->m_umum->ambil_data_kondisi_2tabel_row('ol_logbook_laporan_tabel',$kondisi_row,'ol_logbook_laporan','id_laporan');  
        $data['barcode_pegawai']  = set_value('barcode_pegawai',$lp["barcode_pegawai"]);
        $data['lhu']  = set_value('lhu',$lp["lhu"]);
        $data['id_laporan']  = set_value('id_laporan',$lp["id_laporan"]);
        $data['id_laporan_tabel']  = set_value('id_laporan_tabel',$lp["id_laporan_tabel"]);
        $this->load->view("ol_laporan/isi",$data);
      }
      if($mode=='simpan_rubah_lhu'){
        $id_laporan = $this->input->post("id_laporan");
        $id_laporan_tabel = $this->input->post("id_laporan_tabel");
        $barcode_pegawai = $this->input->post("barcode_pegawai");
        if($barcode_pegawai == $this->session->barcode_pegawai){
          if($this->m_ol_laporan->rubah_lhu()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
              redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
              redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
          }
        }else{
            $this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));         
        }
      }
      if($mode=='rubah_qc'){
        $data['page'] =  $data['page']."_rubah_qc";
        $data['cmd_qcim'] = $this->m_rancak->cmd_qcim();
        $kondisi_cek = array('id_laporan_tabel'=>$data['idtab'],'barcode_pegawai'=>$this->session->barcode_pegawai);
        $data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('ol_logbook_laporan_tabel',$kondisi_cek,'ol_logbook_laporan','id_laporan'); 
        $kondisi_row = array('id_laporan_tabel'=>$data['idtab']);
        $lp = $this->m_umum->ambil_data_kondisi_2tabel_row('ol_logbook_laporan_tabel',$kondisi_row,'ol_logbook_laporan','id_laporan');  
        $data['barcode_pegawai']  = set_value('barcode_pegawai',$lp["barcode_pegawai"]);
        $data['qc_self']  = set_value('qc_self',$lp["qc_self"]);
        $data['id_laporan']  = set_value('id_laporan',$lp["id_laporan"]);
        $data['id_laporan_tabel']  = set_value('id_laporan_tabel',$lp["id_laporan_tabel"]);
        $this->load->view("ol_laporan/isi",$data);
      }
      if($mode=='simpan_rubah_qc'){
        $id_laporan = $this->input->post("id_laporan");
        $id_laporan_tabel = $this->input->post("id_laporan_tabel");
        $barcode_pegawai = $this->input->post("barcode_pegawai");
        if($barcode_pegawai == $this->session->barcode_pegawai){
          if($this->m_ol_laporan->rubah_qc()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
              redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
              redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
          }
        }else{
            $this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));         
        }
      }
      if($mode=='seting_kewenangan'){
        $data['page'] =  $data['page']."_seting_kewenangan";
        $kondisi_cek = array('id_laporan_tabel'=>$data['idtab'],'barcode_pegawai'=>$this->session->barcode_pegawai);
        $data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('ol_logbook_laporan_tabel',$kondisi_cek,'ol_logbook_laporan','id_laporan');
        $data['cmd_komporke'] = $this->m_rancak->cmd_komporke();  
        $kondisi_row = array('id_laporan_tabel'=>$data['idtab']);
        $lp = $this->m_umum->ambil_data_kondisi_2tabel_row('ol_logbook_laporan_tabel',$kondisi_row,'ol_logbook_laporan','id_laporan');  
        $data['barcode_pegawai']  = set_value('barcode_pegawai',$lp["barcode_pegawai"]);
        $data['id_laporan']  = set_value('id_laporan',$lp["id_laporan"]);
        $data['id_laporan_tabel']  = set_value('id_laporan_tabel',$lp["id_laporan_tabel"]);
        $data['kewenangan']  = set_value('kewenangan',$lp["kewenangan"]);
        $this->load->view("ol_laporan/isi",$data);
      }
      if($mode=='simpan_seting_kewenangan'){
        $id_laporan = $this->input->post("id_laporan");
        $id_laporan_tabel = $this->input->post("id_laporan_tabel");
        $barcode_pegawai = $this->input->post("barcode_pegawai");
        if($barcode_pegawai == $this->session->barcode_pegawai){
          if($this->m_ol_laporan->seting_kewenangan()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
              redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
          }
        }else{
            $this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));         
        }
      }
      if($mode=='seting_berkas'){
        $data['page'] =  $data['page']."_seting_berkas";
        $kondisi_cek = array('id_laporan_tabel'=>$data['idtab'],'barcode_pegawai'=>$this->session->barcode_pegawai);
        $data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('ol_logbook_laporan_tabel',$kondisi_cek,'ol_logbook_laporan','id_laporan'); 
        $kondisi_row = array('id_laporan_tabel'=>$data['idtab']);
        $lp = $this->m_umum->ambil_data_kondisi_2tabel_row('ol_logbook_laporan_tabel',$kondisi_row,'ol_logbook_laporan','id_laporan');  
        $data['barcode_pegawai']  = set_value('barcode_pegawai',$lp["barcode_pegawai"]);  
        $data['id_laporan']  = set_value('id_laporan',$lp["id_laporan"]);
        $data['id_laporan_tabel']  = set_value('id_laporan_tabel',$lp["id_laporan_tabel"]);
        $data['i_mutu']  = set_value('i_mutu',$lp["i_mutu"]);
        $data['lhu']  = set_value('lhu',$lp["lhu"]);
        $select = ('*');
        $kondisi = array('barcode_pegawai'=>$lp["barcode_pegawai"],'status_berkas'=>1);
        $data['explo'] = $lp["berkas"];
        $data['field'] = 'berkas';
        $data['id_item'] = 'id_berkas';
        $data['chk_item'] = $this->m_ol_laporan->ambil_berkas_laporan($data['idtab'],$select,$kondisi);
        $this->load->view("ol_laporan/isi",$data);
      }
      if($mode=='simpan_seting_berkas'){
        $id_laporan = $this->input->post("id_laporan");
        $id_laporan_tabel = $this->input->post("id_laporan_tabel");
        $barcode_pegawai = $this->input->post("barcode_pegawai");
        if($barcode_pegawai == $this->session->barcode_pegawai){
          if($this->m_ol_laporan->seting_kompetensi()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
              redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
          }
        }else{
            $this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));         
        }
      }
      if($mode=='seting_print'){
        $data['page'] =  $data['page']."_seting_print";
        $kondisi_cek = array('id_laporan_tabel'=>$data['idtab'],'barcode_pegawai'=>$this->session->barcode_pegawai);
        $data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('ol_logbook_laporan_tabel',$kondisi_cek,'ol_logbook_laporan','id_laporan'); 
        $kondisi_row = array('id_laporan_tabel'=>$data['idtab']);
        $lp = $this->m_umum->ambil_data_kondisi_2tabel_row('ol_logbook_laporan_tabel',$kondisi_row,'ol_logbook_laporan','id_laporan');  
        $data['barcode_pegawai']  = set_value('barcode_pegawai',$lp["barcode_pegawai"]);
        $data['urutan_laporan_tabel']  = set_value('urutan_laporan_tabel',$lp["urutan_laporan_tabel"]);
        $data['id_laporan']  = set_value('id_laporan',$lp["id_laporan"]);
        $data['id_laporan_tabel']  = set_value('id_laporan_tabel',$lp["id_laporan_tabel"]);
        $data['show_pdf']  = set_value('show_pdf',$lp["show_pdf"]);
        $this->load->view("ol_laporan/isi",$data);
      }
      if($mode=='simpan_seting_print'){
        $id_laporan = $this->input->post("id_laporan");
        $id_laporan_tabel = $this->input->post("id_laporan_tabel");
        $barcode_pegawai = $this->input->post("barcode_pegawai");
        if($barcode_pegawai == $this->session->barcode_pegawai){
          if($this->m_ol_laporan->rubah_show_pdf()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
          }
        }else{
            $this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));         
        }
      }
      if($mode=='seting_sub'){
        $data['page'] =  $data['page']."_seting_sub";
        $kondisi_cek = array('id_laporan_tabel'=>$data['idtab'],'barcode_pegawai'=>$this->session->barcode_pegawai);
        $data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('ol_logbook_laporan_tabel',$kondisi_cek,'ol_logbook_laporan','id_laporan'); 
        $kondisi_row = array('id_laporan_tabel'=>$data['idtab']);
        $lp = $this->m_umum->ambil_data_kondisi_2tabel_row('ol_logbook_laporan_tabel',$kondisi_row,'ol_logbook_laporan','id_laporan');  
        $data['barcode_pegawai']  = set_value('barcode_pegawai',$lp["barcode_pegawai"]);
        $data['urutan_laporan_tabel']  = set_value('urutan_laporan_tabel',$lp["urutan_laporan_tabel"]);
        $data['id_laporan']  = set_value('id_laporan',$lp["id_laporan"]);
        $data['id_laporan_tabel']  = set_value('id_laporan_tabel',$lp["id_laporan_tabel"]);
        $data['sub']  = set_value('sub',$lp["sub"]);
        $this->load->view("ol_laporan/isi",$data);
      }
      if($mode=='simpan_seting_sub'){
        $id_laporan = $this->input->post("id_laporan");
        $id_laporan_tabel = $this->input->post("id_laporan_tabel");
        $barcode_pegawai = $this->input->post("barcode_pegawai");
        if($barcode_pegawai == $this->session->barcode_pegawai){
          if($this->m_ol_laporan->rubah_sub()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
          }
        }else{
            $this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));         
        }
      }
      if($mode=='disabel'){
        $data['page'] =  $data['page']."_disabel";
        $kondisi_cek = array('id_laporan_tabel'=>$data['idtab'],'barcode_pegawai'=>$this->session->barcode_pegawai);
        $data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('ol_logbook_laporan_tabel',$kondisi_cek,'ol_logbook_laporan','id_laporan'); 
        $kondisi_row = array('id_laporan_tabel'=>$data['idtab']);
        $lp = $this->m_umum->ambil_data_kondisi_2tabel_row('ol_logbook_laporan_tabel',$kondisi_row,'ol_logbook_laporan','id_laporan');  
        $data['barcode_pegawai']  = set_value('barcode_pegawai',$lp["barcode_pegawai"]);
        $data['lhu']  = set_value('lhu',$lp["lhu"]);
        $data['id_laporan_tabel']  = set_value('id_laporan_tabel',$lp["id_laporan_tabel"]);
        $data['id_laporan']  = set_value('id_laporan',$lp["id_laporan"]);
        $data['status_urutan_tabel']  = set_value('status_urutan_tabel',$lp["status_urutan_tabel"]);
        $this->load->view("ol_laporan/isi",$data);
      }
      if($mode=='simpan_disabel'){
        $id_laporan = $this->input->post("id_laporan");
        $id_laporan_tabel = $this->input->post("id_laporan_tabel");
        $barcode_pegawai = $this->input->post("barcode_pegawai");
        if($barcode_pegawai == $this->session->barcode_pegawai){
          if($this->m_ol_laporan->edit_tabel_status()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
              redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
              redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
          }
        }else{
            $this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));         
        }
      }
      if($mode=='clone'){
        $data['page'] =  $data['page']."_clone";
        $data['cmd_judul_laporan'] = $this->m_rancak->cmd_ol_logbook_judul_laporan();
        $kondisi_cek = array('id_laporan_tabel'=>$data['idtab'],'barcode_pegawai'=>$this->session->barcode_pegawai);
        $data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('ol_logbook_laporan_tabel',$kondisi_cek,'ol_logbook_laporan','id_laporan'); 
        $kondisi_row = array('id_laporan_tabel'=>$data['idtab']);
        $lp = $this->m_umum->ambil_data_kondisi_2tabel_row('ol_logbook_laporan_tabel',$kondisi_row,'ol_logbook_laporan','id_laporan');  
        $data['barcode_pegawai']  = set_value('barcode_pegawai',$lp["barcode_pegawai"]);
        $data['lhu']  = set_value('lhu',$lp["lhu"]);
        $data['id_laporan_tabel']  = set_value('id_laporan_tabel',$lp["id_laporan_tabel"]);
        $data['id_laporan']  = set_value('id_laporan',$lp["id_laporan"]);
        $this->load->view("ol_laporan/isi",$data);
      }
      if($mode=='simpan_clone'){
        $id_laporan = $this->input->post("id_laporan");
        $id_laporan_tabel = $this->input->post("id_laporan_tabel");
        $barcode_pegawai = $this->input->post("barcode_pegawai");
        if($barcode_pegawai == $this->session->barcode_pegawai){
          if($this->m_ol_laporan->tambah_tabel_clone()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
              redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
              redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));
          }
        }else{
            $this->session->set_flashdata('danger', 'Tidak Bisa Merubah Laporan User Lain');
            redirect(base_url('ol_laporan/tabel/view/'.$id_laporan.'/'.$id_laporan_tabel));         
        }
      }
    }
  }
  function cek($mode='view'){
    $data['page']="cek"; 
    $data['header'] = "CEK DATA LAPORAN";
    $data['title'] = "CEK DATA LAPORAN";
    $pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
    $instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
    $data['instance_id'] = $instansi["id_instansi"];
    $data['instance_name'] = $instansi["nama_instansi"];
    $data['idescription'] = $instansi["description"];
    $data['ikeywords'] = $instansi["keywords"];
    $data['iheader'] = $instansi["header"];
    $data['iheader_mini'] = $instansi["header_mini"];
    $data['ifooter'] = $instansi["footer"];
    $data['ilicensed'] = $instansi["licensed"];
    $data['member_id'] = $pegawai["id_pegawai"];
    $data['member_name'] = $pegawai["nama_pegawai"];
    $data['level_name'] = $pegawai["nama_level"];
    $data['photo'] = $pegawai["foto"];      
    //======================= IMPORTANT =========================================
    $data['idlap'] = $this->uri->segment(4, 0);
    $data['idtab'] = $this->uri->segment(5, 0);
    $data['link_awal'] = base_url('ol_laporan/tabel/view/'.$data['idlap']);
    $data['link_item'] = base_url('member/item_mutu');
      $lp = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($data['idtab']); // id_laporan_tabel
      $worke = $this->m_umum->ambil_data('ol_unit','id_unit',$lp['id_unit']);
      $peg = $this->m_umum->ambil_data('ol_pegawai','barcode_pegawai',$lp['barcode_pegawai']);
      $kondisi_cek = array('id_laporan_tabel'=>$data['idtab'],'barcode_pegawai'=>$this->session->barcode_pegawai);
      $data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('ol_logbook_laporan_tabel',$kondisi_cek,'ol_logbook_laporan','id_laporan'); 
      $data['nama_unit']  = set_value('nama_unit',$worke["nama_unit"]);
      $data['id_laporan']  = set_value('id_laporan',$lp["id_laporan"]);
      $data['header_laporan']  = set_value('header_laporan',$lp["header_laporan"]);
      $data['judul_laporan']  = set_value('judul_laporan',$lp["judul_laporan"]);
      $data['urutan_laporan_tabel']  = set_value('urutan_laporan_tabel',$lp["urutan_laporan_tabel"]);
      $data['id_laporan_tabel']  = set_value('id_laporan_tabel',$lp["id_laporan_tabel"]);
      $data['id_instansi']  = set_value('id_instansi',$lp["id_instansi"]);
      $data['id_pegawai']  = set_value('id_pegawai',$lp["id_pegawai"]);
      $data['judul_laporan_tabel']  = set_value('judul_laporan_tabel',$lp["judul_laporan_tabel"]);
      $data['analisa_laporan_tabel']  = set_value('analisa_laporan_tabel',$lp["analisa_laporan_tabel"]);
      $data['rekomendasi_laporan_tabel']  = set_value('rekomendasi_laporan_tabel',$lp["rekomendasi_laporan_tabel"]);
      $data['barcode_pegawai']  = set_value('barcode_pegawai',$lp["barcode_pegawai"]);
      $data['idpeg']  = set_value('idpeg',$lp["id_pegawai"]);
      $data['share_it']  = set_value('share_it',$lp["share_it"]);
      $data['tgl_awal']  = set_value('tgl_awal',date('d-m-Y', strtotime($lp["tgl_awal"])));
      $data['tgl_akhir']  = set_value('tgl_akhir',date('d-m-Y', strtotime($lp["tgl_akhir"])));
      $data['tabel']  = set_value('tabel',$lp["tabel"]);
      $data['lhu']  = set_value('lhu',$lp["lhu"]);
      $data['qc_self']  = set_value('qc_self',$lp["qc_self"]);
      $data['isi_kompetensi']  = set_value('isi_kompetensi',$lp["isi_kompetensi"]);
      $data['kompetensi']  = set_value('kompetensi',$lp["kompetensi"]);
      $data['kewenangan']  = set_value('kewenangan',$lp["kewenangan"]);
      $data['show_pdf']  = set_value('show_pdf',$lp["show_pdf"]);
      if($lp["min_laporan_tabel"]){
        $data['min_laporan_tabel'] = $lp["min_laporan_tabel"];
      }else{
        $data['min_laporan_tabel'] = '0';
      }
      if($lp["max_laporan_tabel"]){
        $data['max_laporan_tabel'] = $lp["max_laporan_tabel"];
      }else{
        $data['max_laporan_tabel'] = '0';
      }
      //=========================================================================== LHU 1
      //'1'=>'Kompetensi','4'=>'QC / IM','5'=>'Pendaftaran Pasien','6'=>'Time Respon','7'=>'Berkas','8'=>'Even'
      /*
        1  ;Tabel Detail                ;1;1
        14 ;Tabel Logbook Total         ;1;2
        9  ;Grafik Garis                ;1;3
        5  ;Grafik Garis Combine        ;1;4
        8  ;Grafik Garis separate       ;1;5
        7  ;Grafik Garis Range Combine  ;1;6
        6  ;Grafik Garis Range separate ;1;7
        3  ;Grafik Pie                  ;1;8
        10 ;Grafik Batang               ;1;11
        11 ;Grafik Batang Persentase    ;1;12
        12 ;Grafik Batang Lokasi        ;0;13
        13 ;Grafik Batang Kelola Limbah ;0;14
        15 ;Tabel Berkas                ;0;16
        2  ;Grafik Pie Single %         ;0;17
        4  ;Grafik Garis Combine + Total;0;18
      */
      //============================================================================= lhu 1
      if($lp["lhu"] == 1){
        $data['tabel_item'] = 'ol_logbook';
        if($lp["kewenangan"] == 1){
          $data['grup_item'] = 'ol_logbook.id_kewenangan';
          $data['id_item'] = 'id_kewenangan';
          $data['coun_item'] = 'id_kewenangan';
          $data['nama_item'] = 'nama_kewenangan';
          $data['order'] = 'nkr_kewenangan.id_kompetensi';
          $data['tbllegend'] = 'nkr_kewenangan';
        }else{
          $data['grup_item'] = 'nkr_kewenangan.id_kompetensi';
          $data['id_item'] = 'id_kompetensi';
          $data['coun_item'] = 'id_kompetensi';
          $data['nama_item'] = 'nama_kompetensi';
          $data['order'] = 'nkr_kewenangan.id_kompetensi';
          $data['tbllegend'] = 'nkr_kompetensi';
        }
        $data['text'] = 'SUMBER DATA : KOMPETENSI / KEWENANGAN';
        $data['ins_item'] = 'id_kompetensi';
        $data['kat_item'] = 'nkr_kewenangan.id_kompetensi';
        $data['nama_kat'] = 'nama_kompetensi';
        $data['tgl_item'] = 'tgl_logbook';
        $data['jml_item'] = 'jml_logbook';
        $data['sume'] = 'jml_logbook';
        $data['sumeas'] = 'jml_logbook';
        $data['id_peg'] = 'id_logbooker';
        $data['nama_item1'] = 'nama_kompetensi';
        $data['nama_item2'] = 'nama_kewenangan';
        $data['pegawai'] = $lp['id_pegawai'];
        $data['ins'] = 'id_instansi';
        $data['idinst'] = $lp["id_instansi"];
        $data['select1'] = ("*"); //
        $data['selectgrup'] = ("sum(".$data['sume'].") as ".$data['sumeas'].",nama_kewenangan,nama_kompetensi");
        $data['kondisi1'] = array('tgl_logbook >='=>$lp["tgl_awal"],'tgl_logbook <='=>$lp["tgl_akhir"],$data['id_peg']=>$data['pegawai'],$data['ins']=>$lp["id_instansi"],'jml_logbook >'=>0);
        $data['ambil_lhu'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc');
        $data['grup_lhu'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrup'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc',$data['grup_item']);
        $data['ambil_bulan'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc','MONTH('.$data['tgl_item'].')');
        //============================================================================= GRAFIK
        $data['js_thn'] = 'js_thn'; //
        $data['js_bln'] = 'js_bln'; //
        $data['js_hr'] = 'js_hr'; //
        $data['tgl_bln'] = 'tgl_bln'; //
        $data['tgl_hr'] = 'tgl_hr'; //
        $data['tgl_thn'] = 'tgl_thn'; //
        $data['selectgrafik5'] = ("sum(".$data['jml_item'].") as ".$data['jml_item'].",".$data['grup_item']." as ".$data['id_item'].",DATE_FORMAT(".$data['tgl_item'].",'%d-%m-%Y') as ".$data['tgl_hr'].",DATE_FORMAT(".$data['tgl_item'].",'%m-%Y') as ".$data['tgl_bln'].",DATE_FORMAT(".$data['tgl_item'].",'%Y') as ".$data['tgl_thn'].",".$data['tgl_item']." as ".$data['tgl_item'].",MONTH(".$data['tgl_item'].") as ".$data['js_bln'].",YEAR(".$data['tgl_item'].") as ".$data['js_thn'].",DATE_FORMAT(".$data['tgl_item'].",'%d') as ".$data['js_hr'].",concat(".$data['nama_item1'].",' - ',".$data['nama_item2'].") as ".$data['nama_item']."  ");
        $data['selectgrafikhr'] = (" ".$data['grup_item']." as ".$data['id_item'].",DATE_FORMAT(".$data['tgl_item'].",'%d-%m-%Y') as ".$data['tgl_hr'].",DATE_FORMAT(".$data['tgl_item'].",'%m-%Y') as ".$data['tgl_bln'].",DATE_FORMAT(".$data['tgl_item'].",'%Y') as ".$data['tgl_thn'].",".$data['tgl_item']." as ".$data['tgl_item'].",MONTH(".$data['tgl_item'].") as ".$data['js_bln'].",YEAR(".$data['tgl_item'].") as ".$data['js_thn'].",DATE_FORMAT(".$data['tgl_item'].",'%d') as ".$data['js_hr'].",  ");
        $data['grafik5'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafik5'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc','MONTH('.$data['tgl_item'].')');
        $data['grafikhr'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafikhr'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['tgl_item']);
        $data['legendgrafik5'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['grup_item']);
        $data['ambil_data_min'] = $this->m_ol_laporan->get_min($data['idtab'],$data['tabel_item'],$data['jml_item'],$data['kondisi1'],$lp["lhu"]);
        $data['ambil_data_max'] = $this->m_ol_laporan->get_max($data['idtab'],$data['tabel_item'],$data['jml_item'],$data['kondisi1'],$lp["lhu"]);
        $data['grafikpie'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafik5'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['id_item']);
      }
      //============================================================================= lhu 4
      if($lp["lhu"] == 4){
        $data['text'] = 'SUMBER DATA : QUALITY CONTROL / INDIKATOR MUTU';
        $data['tabel_item'] = 'ol_logbook_lhu_detil';
        $data['ins_item'] = 'id_equipment';
        $data['grup_item'] = 'ol_logbook_lhu_detil.id_item_lhu';
        $data['kat_item'] = 'ol_logbook_item_lhu.id_equipment';
        $data['nama_kat'] = 'nama_equipment';
        $data['nama_item1'] = 'nama_item_lhu';
        $data['nama_item2'] = 'nama_equipment';
        $data['id_item'] = 'id_item_lhu';
        $data['coun_item'] = 'coun_lhu_detil';
        $data['nama_item'] = 'nama_item_lhu';
        $data['order'] = 'ol_logbook_lhu_detil.id_item_lhu';
        $data['tgl_item'] = 'tgl_lhu';
        $data['jml_item'] = 'hasil_lhu_detil';
        $data['sume'] = 'hasil_lhu_detil';
        $data['sumeas'] = 'hasil_lhu_detil';
        $data['id_peg'] = 'ol_logbook_lhu.barcode_pegawai';
        $data['pegawai'] = $lp['barcode_pegawai'];
        $data['ins'] = 'id_instansi';
        $data['idinst'] = $lp["id_instansi"];
        $data['select1'] = ("*"); //
        $data['selectgrup'] = ("sum(".$data['sume'].") as ".$data['sumeas'].",nama_equipment,nama_item_lhu");
        if($lp["qc_self"] == 1){
          $data['kondisi1'] = array('tgl_lhu >='=>$lp["tgl_awal"],'tgl_lhu <='=>$lp["tgl_akhir"],$data['id_peg']=>$data['pegawai'],$data['ins']=>$data['idinst']);
        }else{
        //  $data['kondisi1'] = array('tgl_lhu >='=>$lp["tgl_awal"],'tgl_lhu <='=>$lp["tgl_akhir"],'ol_equipment.id_unit'=>$this->session->unit);
          $data['kondisi1'] = array('tgl_lhu >='=>$lp["tgl_awal"],'tgl_lhu <='=>$lp["tgl_akhir"],$data['ins']=>$lp["id_instansi"]);
        }
        $data['ambil_lhu'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc');
        $data['grup_lhu'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrup'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc',$data['grup_item']);
        $data['ambil_bulan'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc','MONTH('.$data['tgl_item'].')');
        //============================================================================= GRAFIK
        $data['js_thn'] = 'js_thn'; //
        $data['js_bln'] = 'js_bln'; //
        $data['js_hr'] = 'js_hr'; //
        $data['tgl_bln'] = 'tgl_bln'; //
        $data['tgl_hr'] = 'tgl_hr'; //
        $data['tgl_thn'] = 'tgl_thn'; //
        $data['selectgrafik5'] = ("sum(".$data['jml_item'].") as ".$data['jml_item'].",".$data['grup_item']." as ".$data['id_item'].",DATE_FORMAT(".$data['tgl_item'].",'%d-%m-%Y') as ".$data['tgl_hr'].",DATE_FORMAT(".$data['tgl_item'].",'%m-%Y') as ".$data['tgl_bln'].",DATE_FORMAT(".$data['tgl_item'].",'%Y') as ".$data['tgl_thn'].",".$data['tgl_item']." as ".$data['tgl_item'].",MONTH(".$data['tgl_item'].") as ".$data['js_bln'].",YEAR(".$data['tgl_item'].") as ".$data['js_thn'].",DATE_FORMAT(".$data['tgl_item'].",'%d') as ".$data['js_hr'].",concat(".$data['nama_item1'].",' - ',".$data['nama_item2'].") as ".$data['nama_item']."  ");
        $data['selectgrafikhr'] = (" ".$data['grup_item']." as ".$data['id_item'].",DATE_FORMAT(".$data['tgl_item'].",'%d-%m-%Y') as ".$data['tgl_hr'].",DATE_FORMAT(".$data['tgl_item'].",'%m-%Y') as ".$data['tgl_bln'].",DATE_FORMAT(".$data['tgl_item'].",'%Y') as ".$data['tgl_thn'].",".$data['tgl_item']." as ".$data['tgl_item'].",MONTH(".$data['tgl_item'].") as ".$data['js_bln'].",YEAR(".$data['tgl_item'].") as ".$data['js_thn'].",DATE_FORMAT(".$data['tgl_item'].",'%d') as ".$data['js_hr'].",  ");
        $data['grafik5'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafik5'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc','MONTH('.$data['tgl_item'].')');
        $data['grafikhr'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafikhr'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['tgl_item']);
        $data['legendgrafik5'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['grup_item']);
        $data['ambil_data_min'] = $this->m_ol_laporan->get_min($data['idtab'],$data['tabel_item'],$data['jml_item'],$data['kondisi1'],$lp["lhu"]);
        $data['ambil_data_max'] = $this->m_ol_laporan->get_max($data['idtab'],$data['tabel_item'],$data['jml_item'],$data['kondisi1'],$lp["lhu"]);
        $data['grafikpie'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafik5'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['id_item']);
      }
      //============================================================================= lhu 5
      if($lp["lhu"] == 5){
        $data['text'] = 'SUMBER DATA : PENDAFTARAN PASIEN';
        $data['tabel_item'] = 'tindakan_daftar';
        $data['grup_item'] = 'tindakan_daftar.id_tindakan';
        $data['ins_item'] = 'id_golongan_pemeriksaan';
        $data['kat_item'] = 'tindakan.id_golongan_pemeriksaan';
        $data['nama_kat'] = 'nama_golongan_pemeriksaan';
        $data['nama_item1'] = 'nama_tindakan';
        $data['nama_item2'] = 'nama_golongan_pemeriksaan';
        $data['id_item'] = 'id_tindakan';
        $data['coun_item'] = 'coun_tindakan_daftar';
        $data['nama_item'] = 'nama_tindakan';
        $data['order'] = 'tindakan_daftar.id_tindakan';
        $data['tgl_item'] = 'tgl_daftar';
        $data['sume'] = 'tindakan_daftar.id_tindakan';
        $data['sumeas'] = 'jml_tindakan';
        $data['jml_item'] = 'jml_tindakan';
        $data['id_peg'] = 'tindakan_daftar.pendaftar';
        $data['pegawai'] = $lp['id_pegawai'];
        $data['ins'] = 'unit_tindakan';
        $data['idinst'] = $lp["id_unit"];
        $data['select1'] = ("*"); //
        $data['selectgrup'] = ("count(".$data['sume'].") as ".$data['sumeas'].",nama_tindakan,nama_golongan_pemeriksaan");
        $data['kondisi1'] = array('tgl_daftar >='=>$lp["tgl_awal"],'tgl_daftar <='=>$lp["tgl_akhir"],$data['ins']=>$data['idinst']);
        $data['ambil_lhu'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc');
        $data['grup_lhu'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrup'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc',$data['grup_item']);
        $data['ambil_bulan'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc','MONTH('.$data['tgl_item'].')');
        //============================================================================= GRAFIK
        $data['js_thn'] = 'js_thn'; //
        $data['js_bln'] = 'js_bln'; //
        $data['js_hr'] = 'js_hr'; //
        $data['tgl_bln'] = 'tgl_bln'; //
        $data['tgl_hr'] = 'tgl_hr'; //
        $data['tgl_thn'] = 'tgl_thn'; //
        $data['selectgrafik5'] = ("count(".$data['sume'].") as ".$data['sumeas'].",".$data['grup_item']." as ".$data['id_item'].",DATE_FORMAT(".$data['tgl_item'].",'%d-%m-%Y') as ".$data['tgl_hr'].",DATE_FORMAT(".$data['tgl_item'].",'%m-%Y') as ".$data['tgl_bln'].",DATE_FORMAT(".$data['tgl_item'].",'%Y') as ".$data['tgl_thn'].",".$data['tgl_item']." as ".$data['tgl_item'].",MONTH(".$data['tgl_item'].") as ".$data['js_bln'].",YEAR(".$data['tgl_item'].") as ".$data['js_thn'].",DATE_FORMAT(".$data['tgl_item'].",'%d') as ".$data['js_hr'].",concat(".$data['nama_item1'].",' - ',".$data['nama_item2'].") as ".$data['nama_item']."  ");
        $data['selectgrafikhr'] = (" ".$data['grup_item']." as ".$data['id_item'].",DATE_FORMAT(".$data['tgl_item'].",'%d-%m-%Y') as ".$data['tgl_hr'].",DATE_FORMAT(".$data['tgl_item'].",'%m-%Y') as ".$data['tgl_bln'].",DATE_FORMAT(".$data['tgl_item'].",'%Y') as ".$data['tgl_thn'].",".$data['tgl_item']." as ".$data['tgl_item'].",MONTH(".$data['tgl_item'].") as ".$data['js_bln'].",YEAR(".$data['tgl_item'].") as ".$data['js_thn'].",DATE_FORMAT(".$data['tgl_item'].",'%d') as ".$data['js_hr'].",  ");
        $data['grafik5'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafik5'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc','MONTH('.$data['tgl_item'].')');
        $data['grafikhr'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafikhr'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['tgl_item']);
        $data['legendgrafik5'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['grup_item']);
        $data['ambil_data_min'] = $lp["min_laporan_tabel"];
        $data['ambil_data_max'] = $lp["max_laporan_tabel"];
        $data['grafikpie'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafik5'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['id_item']);
      }
      //============================================================================= lhu 7
      if($lp["lhu"] == 7){
        $data['text'] = 'SUMBER DATA : BERKAS';
        $data['tabel_item'] = 'ol_berkas';
        $data['grup_item'] = 'ol_berkas.id_kategori_berkas';
        $data['ins_item'] = 'id_kategori_berkas';
        $data['kat_item'] = 'ol_berkas.id_kategori_berkas';
        $data['nama_kat'] = 'nama_berkas_kategori';
        $data['nama_item1'] = 'nama_berkas_kategori';
        $data['nama_item2'] = 'nama_berkas_kategori';
        $data['id_item'] = 'id_berkas';
        $data['coun_item'] = 'id_berkas';
        $data['nama_item'] = 'nama_berkas';
        $data['order'] = 'ol_berkas.tgl_b_berkas';
        $data['tgl_item'] = 'tgl_b_berkas';
        $data['sume'] = 'ol_berkas.kredit';
        $data['sumeas'] = 'coun_berkas';
        $data['jml_item'] = 'coun_berkas';
        $data['id_peg'] = 'ol_berkas.id_pegawai';
        $data['pegawai'] = $lp['id_pegawai'];
        $data['ins'] = 'ol_berkas.id_pegawai';
        $data['idinst'] = $lp["id_pegawai"];
        $data['select1'] = ("*"); //
        $data['selectgrup'] = ("sum(".$data['sume'].") as ".$data['sumeas'].",nama_berkas,nama_berkas_kategori");
        $data['kondisi1'] = array('tgl_b_berkas >='=>$lp["tgl_awal"],'tgl_b_berkas <='=>$lp["tgl_akhir"],$data['ins']=>$data['idinst'],'link_berkas !='=>'','status_berkas'=>1);
        $data['ambil_lhu'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc');
        $data['grup_lhu'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrup'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc',$data['grup_item']);
        $data['ambil_bulan'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc','MONTH('.$data['tgl_item'].')');
        $data['kondisi_berkas'] = array('id_kategori_berkas >'=>13,'link_berkas !='=>'','status_berkas'=>1,$data['ins']=>$data['idinst']);
        $data['kondisi_imut'] = array('id_kategori_berkas'=>12,'link_berkas !='=>'','status_berkas'=>1,$data['ins']=>$data['idinst']);
        $data['kondisi_ijasah'] = array('id_kategori_berkas'=>7,'link_berkas !='=>'','status_berkas'=>1,$data['ins']=>$data['idinst']);
        $data['kondisi_pelatihan'] = array('kunci'=>1,'link_berkas !='=>'','status_berkas'=>1,$data['ins']=>$data['idinst']);
        $data['kondisi_str'] = array('kunci'=>0,'link_berkas !='=>'','status_berkas'=>1,$data['ins']=>$data['idinst']);
        $data['jml_berkas'] = $this->m_ol_laporan->jumlah_sumber_data($data['idtab'],$data['tabel_item'],$data['kondisi_berkas'],$lp["lhu"]);
        $data['jml_imut'] = $this->m_ol_laporan->jumlah_sumber_data($data['idtab'],$data['tabel_item'],$data['kondisi_imut'],$lp["lhu"]);
        $data['jml_ijasah'] = $this->m_ol_laporan->jumlah_sumber_data($data['idtab'],$data['tabel_item'],$data['kondisi_ijasah'],$lp["lhu"]);
        $data['jml_pelatihan'] = $this->m_ol_laporan->jumlah_sumber_data($data['idtab'],$data['tabel_item'],$data['kondisi_pelatihan'],$lp["lhu"]);
        $data['jml_str'] = $this->m_ol_laporan->jumlah_sumber_data($data['idtab'],$data['tabel_item'],$data['kondisi_str'],$lp["lhu"]);
        $data['ambil_berkas'] = $this->m_ol_laporan->set_isi_sumber_data($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi_berkas'],$lp["lhu"],$data['order'],'asc');
        $data['ambil_imut'] = $this->m_ol_laporan->set_isi_sumber_data($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi_imut'],$lp["lhu"],$data['order'],'asc');
        $data['ambil_ijasah'] = $this->m_ol_laporan->set_isi_sumber_data($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi_ijasah'],$lp["lhu"],$data['order'],'asc');
        $data['ambil_pelatihan'] = $this->m_ol_laporan->set_isi_sumber_data($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi_pelatihan'],$lp["lhu"],$data['order'],'asc');
        $data['ambil_str'] = $this->m_ol_laporan->set_isi_sumber_data($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi_str'],$lp["lhu"],$data['order'],'asc');
        //============================================================================= GRAFIK
        $data['js_thn'] = 'js_thn'; //
        $data['js_bln'] = 'js_bln'; //
        $data['js_hr'] = 'js_hr'; //
        $data['tgl_bln'] = 'tgl_bln'; //
        $data['tgl_hr'] = 'tgl_hr'; //
        $data['tgl_thn'] = 'tgl_thn'; //
        $data['selectgrafik5'] = ("count(".$data['sume'].") as ".$data['sumeas'].",".$data['grup_item']." as ".$data['id_item'].",DATE_FORMAT(".$data['tgl_item'].",'%d-%m-%Y') as ".$data['tgl_hr'].",DATE_FORMAT(".$data['tgl_item'].",'%m-%Y') as ".$data['tgl_bln'].",DATE_FORMAT(".$data['tgl_item'].",'%Y') as ".$data['tgl_thn'].",".$data['tgl_item']." as ".$data['tgl_item'].",MONTH(".$data['tgl_item'].") as ".$data['js_bln'].",YEAR(".$data['tgl_item'].") as ".$data['js_thn'].",DATE_FORMAT(".$data['tgl_item'].",'%d') as ".$data['js_hr'].",concat(".$data['nama_item1'].",' - ',".$data['nama_item2'].") as ".$data['nama_item']."  ");
        $data['selectgrafikhr'] = (" ".$data['grup_item']." as ".$data['id_item'].",DATE_FORMAT(".$data['tgl_item'].",'%d-%m-%Y') as ".$data['tgl_hr'].",DATE_FORMAT(".$data['tgl_item'].",'%m-%Y') as ".$data['tgl_bln'].",DATE_FORMAT(".$data['tgl_item'].",'%Y') as ".$data['tgl_thn'].",".$data['tgl_item']." as ".$data['tgl_item'].",MONTH(".$data['tgl_item'].") as ".$data['js_bln'].",YEAR(".$data['tgl_item'].") as ".$data['js_thn'].",DATE_FORMAT(".$data['tgl_item'].",'%d') as ".$data['js_hr'].",  ");
        $data['grafik5'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafik5'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc','MONTH('.$data['tgl_item'].')');
        $data['grafikhr'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafikhr'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['tgl_item']);
        $data['legendgrafik5'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['grup_item']);
        $data['ambil_data_min'] = $lp["min_laporan_tabel"];
        $data['ambil_data_max'] = $lp["max_laporan_tabel"];
        $data['grafikpie'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafik5'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['id_item']);
        //============================================================================= GRAFIK
        $data['js_thn'] = 'js_thn'; //
        $data['js_bln'] = 'js_bln'; //
        $data['js_hr'] = 'js_hr'; //
        $data['tgl_bln'] = 'tgl_bln'; //
        $data['tgl_hr'] = 'tgl_hr'; //
        $data['tgl_thn'] = 'tgl_thn'; //
        $data['selectgrafik5'] = ("sum(".$data['jml_item'].") as ".$data['jml_item'].",".$data['grup_item']." as ".$data['id_item'].",DATE_FORMAT(".$data['tgl_item'].",'%d-%m-%Y') as ".$data['tgl_hr'].",DATE_FORMAT(".$data['tgl_item'].",'%m-%Y') as ".$data['tgl_bln'].",DATE_FORMAT(".$data['tgl_item'].",'%Y') as ".$data['tgl_thn'].",".$data['tgl_item']." as ".$data['tgl_item'].",MONTH(".$data['tgl_item'].") as ".$data['js_bln'].",YEAR(".$data['tgl_item'].") as ".$data['js_thn'].",DATE_FORMAT(".$data['tgl_item'].",'%d') as ".$data['js_hr'].",concat(".$data['nama_item1'].",' - ',".$data['nama_item2'].") as ".$data['nama_item']."  ");
        $data['selectgrafikhr'] = (" ".$data['grup_item']." as ".$data['id_item'].",DATE_FORMAT(".$data['tgl_item'].",'%d-%m-%Y') as ".$data['tgl_hr'].",DATE_FORMAT(".$data['tgl_item'].",'%m-%Y') as ".$data['tgl_bln'].",DATE_FORMAT(".$data['tgl_item'].",'%Y') as ".$data['tgl_thn'].",".$data['tgl_item']." as ".$data['tgl_item'].",MONTH(".$data['tgl_item'].") as ".$data['js_bln'].",YEAR(".$data['tgl_item'].") as ".$data['js_thn'].",DATE_FORMAT(".$data['tgl_item'].",'%d') as ".$data['js_hr'].",  ");
        $data['grafik5'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafik5'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc','MONTH('.$data['tgl_item'].')');
        $data['grafikhr'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafikhr'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['tgl_item']);
        $data['legendgrafik5'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['grup_item']);
        $data['ambil_data_min'] = $this->m_ol_laporan->get_min($data['idtab'],$data['tabel_item'],$data['jml_item'],$data['kondisi1'],$lp["lhu"]);
        $data['ambil_data_max'] = $this->m_ol_laporan->get_max($data['idtab'],$data['tabel_item'],$data['jml_item'],$data['kondisi1'],$lp["lhu"]);
        $data['grafikpie'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafik5'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['id_item']);
      }
      //============================================================================= lhu 8
      if($lp["lhu"] == 8){
        $data['text'] = 'SUMBER DATA : EVEN DENGAN ABSENSI LOKASI';
        $data['tabel_item'] = 'abs_even';
        $data['grup_item'] = 'tgl_even';
        $data['ins_item'] = 'tgl_even';
        $data['kat_item'] = 'tgl_even';
        $data['nama_kat'] = 'nama_even';
        $data['nama_item1'] = 'nama_even';
        $data['nama_item2'] = 'alamat_even';
        $data['id_item'] = 'id_even';
        $data['coun_item'] = 'coun_even';
        $data['nama_item'] = 'nama_even';
        $data['order'] = 'tgl_even';
        $data['tgl_item'] = 'tgl_even';
        $data['sume'] = 'id_even';
        $data['sumeas'] = 'coun_even';
        $data['jml_item'] = 'coun_even';
        $data['id_peg'] = 'abs_even.barcode_pegawai';
        $data['pegawai'] = $lp['barcode_pegawai'];
        $data['ins'] = 'unit';
        $data['idinst'] = $lp["id_unit"];
        $data['select1'] = ("*"); //
        $data['selectgrup'] = ("sum(".$data['jml_item'].") as ".$data['jml_item'].",nama_even,alamat_even");
        $data['kondisi1'] = array('tgl_even >='=>$lp["tgl_awal"],'tgl_even <='=>$lp["tgl_akhir"],$data['ins']=>$data['idinst']);
        $data['ambil_lhu'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc');
        $data['grup_lhu'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrup'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc',$data['grup_item']);
        $data['ambil_bulan'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc','MONTH('.$data['tgl_item'].')');
        //============================================================================= GRAFIK
        $data['js_thn'] = 'js_thn'; //
        $data['js_bln'] = 'js_bln'; //
        $data['js_hr'] = 'js_hr'; //
        $data['tgl_bln'] = 'tgl_bln'; //
        $data['tgl_hr'] = 'tgl_hr'; //
        $data['tgl_thn'] = 'tgl_thn'; //
        $data['selectgrafik5'] = ("sum(".$data['jml_item'].") as ".$data['jml_item'].",".$data['grup_item']." as ".$data['id_item'].",DATE_FORMAT(".$data['tgl_item'].",'%d-%m-%Y') as ".$data['tgl_hr'].",DATE_FORMAT(".$data['tgl_item'].",'%m-%Y') as ".$data['tgl_bln'].",DATE_FORMAT(".$data['tgl_item'].",'%Y') as ".$data['tgl_thn'].",".$data['tgl_item']." as ".$data['tgl_item'].",MONTH(".$data['tgl_item'].") as ".$data['js_bln'].",YEAR(".$data['tgl_item'].") as ".$data['js_thn'].",DATE_FORMAT(".$data['tgl_item'].",'%d') as ".$data['js_hr'].",concat(".$data['nama_item1'].",' - ',".$data['nama_item2'].") as ".$data['nama_item']."  ");
        $data['selectgrafikhr'] = (" ".$data['grup_item']." as ".$data['id_item'].",DATE_FORMAT(".$data['tgl_item'].",'%d-%m-%Y') as ".$data['tgl_hr'].",DATE_FORMAT(".$data['tgl_item'].",'%m-%Y') as ".$data['tgl_bln'].",DATE_FORMAT(".$data['tgl_item'].",'%Y') as ".$data['tgl_thn'].",".$data['tgl_item']." as ".$data['tgl_item'].",MONTH(".$data['tgl_item'].") as ".$data['js_bln'].",YEAR(".$data['tgl_item'].") as ".$data['js_thn'].",DATE_FORMAT(".$data['tgl_item'].",'%d') as ".$data['js_hr'].",  ");
        $data['grafik5'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafik5'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc','MONTH('.$data['tgl_item'].')');
        $data['grafikhr'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafikhr'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['tgl_item']);
        $data['legendgrafik5'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['grup_item']);
        $data['ambil_data_min'] = $lp["min_laporan_tabel"];
        $data['ambil_data_max'] = $lp["max_laporan_tabel"];
        $data['grafikpie'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafik5'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['id_item']);
      }
      //============================================================================= !LHU
    if($mode=='view'){
      $this->tampil_top($data);
    }
    if($mode=='pdf_logbook'){
      $report = $this->load->view('cetak/ol_laporan_logbook', $data, TRUE);
      $namaku = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$this->session->id_pegawai);
      $filename = date('dmYHis').'laporan-'.$namaku['nama_pegawai']."-laporan-logbook-detil.pdf";
      $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-L']);
      // Define a default page size/format by array - page will be 190mm wide x 236mm height
      $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [190, 236]]);
      // Define a default page using all default values except "L" for Landscape orientation
      $mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);
      $mpdf->SetTitle($data['header']);
      $mpdf->SetAuthor($data['instance_name']);
      $mpdf->AddPage('L', '', '', '', 2, 5, 5, 5, 0, 0, 0);
      $mpdf->SetDisplayMode('fullpage');
      $mpdf->SetHTMLFooter('<div style="text-align: center">{PAGENO}</div>');
    //  $mpdf->SetFooter('Page : {PAGENO}');
  //    $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
      for ($i = 1; $i > 2; $i++) {
      $mpdf->SetHTMLFooter('');
      }     
      ini_set("pcre.backtrack_limit", "5000000");
      $mpdf->WriteHTML($report);
      $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
    }
  }
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
  $this->load->view("ol_laporan/header",$data);
  $this->load->view("ol_laporan/isi");
  $this->load->view("footer");
  $this->load->view("ol_laporan/jsload");
  $this->load->view("ol_laporan/jscode");
}
function tampil_top($data)
{
  $this->load->view("header_topol",$data);
  $this->load->view("ol_laporan/isi");
  $this->load->view("footer");
  $this->load->view("ol_laporan/jsload");
  $this->load->view("ol_laporan/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
