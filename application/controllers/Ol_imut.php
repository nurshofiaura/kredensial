<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//date_default_timezone_set('Asia/Kolkata');
date_default_timezone_set('Asia/Makassar');
class Ol_imut extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
      //    $this->m_umum->set_timezone();
          $this->load->model('m_ol_rancak');
          $this->load->model('m_report');
           $this->load->model('m_auth');
          $this->m_auth->login_kah();
  }
  function index(){
    $data['page']="home";
    $data['title'] = "BERANDA";
    $data['link_kembali'] = base_url('member');
    $data['link_awal'] = base_url('ol_imut');
    $pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
    $instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
    $data['instance_id'] = $instansi["id_instansi"];
    $data['header'] = $instansi["nama_instansi"];
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
    //$this->tampil($data);
    $this->report();
  }
  function indikator($mode='view'){
    $data['page']="indikator";
    $data['title'] = "INDIKATOR MUTU";
    $data['link_kembali'] = base_url('member');
    $data['link_awal'] = base_url('ol_imut');
    $pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
    $instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
    $data['instance_id'] = $instansi["id_instansi"];
    $data['header'] = $instansi["nama_instansi"];
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
    $data['id'] = $this->uri->segment(4, 0);
    if($mode=='view'){
      $this->tampil($data);
    }
    else if($mode=='data'){
      echo json_encode($this->m_report->equipment_all(1));
    }
    else{
      $data['cmd_status'] = $this->m_rancak->cmd_status();
      $data['cmd_unit'] = $this->m_ol_rancak->ambil_unit_transaksi();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
        $data['nama_equipment']  = set_value('nama_equipment',$this->input->post('nama_equipment'));
        $data['id_unit']  = set_value('id_unit',$this->input->post('id_unit'));
        $data['status_equipment']  = set_value('status_equipment',$this->input->post('status_equipment'));
        $this->load->view("ol_imut/isi",$data);
      }
      if($mode=='simpan_tambah'){
        if($this->m_report->simpan_equipment(1)){
          $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
          redirect(base_url('ol_imut/indikator'));
        }else{
          $this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
          redirect(base_url('ol_imut/indikator'));
        }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
        $keuangan    = $this->m_umum->ambil_data('ol_equipment','id_equipment',$data['id']);
        $data['id_equipment']  = set_value('id_equipment',$keuangan["id_equipment"]);
        $data['nama_equipment']  = set_value('nama_equipment',$keuangan["nama_equipment"]);
        $data['id_unit']  = set_value('id_unit',$keuangan["id_unit"]);
        $data['status_equipment']  = set_value('status_equipment',$keuangan["status_equipment"]);
        $data['pembuat_equipment']  = set_value('pembuat_equipment',$keuangan["pembuat_equipment"]);
        $this->load->view("ol_imut/isi",$data);
      }
      if($mode=='simpan_edit'){
      $id_equipment = $this->input->post('id_equipment');
      $kondisi=array('pembuat_equipment'=>$this->session->barcode_pegawai,'id_equipment'=>$id_equipment);
      $jml = $this->m_umum->jumlah_record_filter('ol_equipment',$kondisi);
      if($jml == 0){
          $this->session->set_flashdata('danger', 'Hanya Dapat Menghapus Data Sendiri');
          redirect(base_url('ol_imut/indikator'));
      }else{
          if($this->m_report->edit_equipment()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
            redirect(base_url('ol_imut/indikator'));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
            redirect(base_url('ol_imut/indikator'));
          }
        }

      }
    }
  }
  function mutu($mode='view'){
    $data['page']="mutu";
    $data['title'] = "INPUT MUTU";
    $data['link_kembali'] = base_url('member');
    $data['link_awal'] = base_url('ol_imut');
    $pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
    $instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
    $data['instance_id'] = $instansi["id_instansi"];
    $data['header'] = $instansi["nama_instansi"];
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
    $data['id'] = $this->uri->segment(4, 0);
    if($mode=='view'){
      $this->tampil($data);
    }
    else if($mode=='data'){
      echo json_encode($this->m_report->mutu_all(1));
    }
    else{
        $data['cmd_status'] = $this->m_rancak->cmd_status();
        $data['equipment'] = $this->m_ol_rancak->ambil_equipment_in(1);
        if($mode=='tambah'){
          $data['page'] =  $data['page']."_tambah";
          $data['id_equipment']  = set_value('id_equipment',$this->input->post('id_equipment'));
          $data['nama_eq_detil']  = set_value('nama_eq_detil',$this->input->post('nama_eq_detil'));
          $data['status_eq_detil']  = set_value('status_eq_detil',$this->input->post('status_eq_detil'));
          $this->load->view("ol_imut/isi",$data);
        }
        if($mode=='simpan_tambah'){
        $id_equipment = $this->input->post('id_equipment');
        if($id_equipment){
            if($this->m_report->simpan_equipment_detil()){
              $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
              redirect(base_url('ol_imut/mutu'));
            }else{
              $this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
              redirect(base_url('ol_imut/mutu'));
            }
          }else{
               $this->session->set_flashdata('danger', 'Belum Ada Data');
              redirect(base_url('ol_imut/mutu'));           
          }
        }
        if($mode=='edit'){
          $data['page'] =  $data['page']."_edit";
          $keuangan    = $this->m_umum->ambil_data('ol_eq_detil','id_eq_detil',$data['id']);
          $data['id_eq_detil']  = set_value('id_eq_detil',$keuangan["id_eq_detil"]);
          $data['id_equipment']  = set_value('id_equipment',$keuangan["id_equipment"]);
          $data['nama_eq_detil']  = set_value('nama_eq_detil',$keuangan["nama_eq_detil"]);
          $data['status_eq_detil']  = set_value('status_eq_detil',$keuangan["status_eq_detil"]);
          $this->load->view("ol_imut/isi",$data);
        }
        if($mode=='simpan_edit'){
        $id_eq_detil = $this->input->post('id_eq_detil');
        $kondisi=array('pembuat_eq_detil'=>$this->session->barcode_pegawai,'id_eq_detil'=>$id_eq_detil);
        $jml = $this->m_umum->jumlah_record_filter('ol_eq_detil',$kondisi);
        if($jml == 0){
            $this->session->set_flashdata('danger', 'Hanya Dapat Menghapus Data Sendiri');
            redirect(base_url('ol_imut/mutu'));
        }else{
          if($this->m_report->edit_equipment_detil()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
            redirect(base_url('ol_imut/mutu'));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
            redirect(base_url('ol_imut/mutu'));
          }
        }
      }
    }
  }
  function i_mutu($mode='view'){
    $data['page']="i_mutu";
    $data['title'] = "INPUT MUTU";
    $data['link_kembali'] = base_url('member');
    $data['link_awal'] = base_url('ol_imut');
    $pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
    $instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
    $data['instance_id'] = $instansi["id_instansi"];
    $data['header'] = $instansi["nama_instansi"];
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
    $data['id'] = $this->uri->segment(4, 0);
    $data['id2'] = $this->uri->segment(5, 0);
    $data['id3'] = $this->uri->segment(6, 0);
    $data['id4'] = $this->uri->segment(7, 0);
    $kon = array('status_equipment'=>1,'id_unit'=>$this->session->unit,'jenis_equipment'=>1);
    $data['opsi'] = $this->m_ol_rancak->ambil_equipment_mutu_null($kon);
    $data['all_kah'] = array('0'=>'Range Tanggal','1'=>'Semua');
    if($mode=='view'){
      if(empty($data['id'])){
        if($this->session->has_userdata('tgl_imut1')){
          $data['id'] = $this->session->tgl_imut1;
        }else{
          $data['id'] = '01-'.date('m-Y');
        }
      }
      if(empty($data['id2'])){
        if($this->session->has_userdata('tgl_imut2')){
          $data['id2'] = $this->session->tgl_imut2;
        }else{
          $data['id2'] = date('d-m-Y');
        }
      }
      if(empty($data['id3'])){
        if($this->session->has_userdata('opsi_imut')){
          $data['id3'] = $this->session->opsi_imut;
        }else{
          $data['id3'] = 0;
        }
      }
      if(empty($data['id4'])){
        if($this->session->has_userdata('range_imut')){
          $data['id4'] = $this->session->range_imut;
        }else{
          $data['id4'] = 1;
        }
      }
      $this->tampil($data);
      $action = $this->input->post('action');
      if($action == 'BtnProses') {
        $first_date = $this->input->post("id");
        $last_date = $this->input->post("id2");
        $opsi_imut = $this->input->post("id3");
        $range_imut = $this->input->post("id4");
        $data_user_level = array(
          'tgl_imut1'     => $first_date,
          'tgl_imut2'     => $last_date,
          'opsi_imut'     => $opsi_imut,
          'range_imut'     => $range_imut
        );
        $this->session->set_userdata($data_user_level); 
        redirect(base_url('ol_imut/'.$data['page'].'/view/'.$first_date.'/'.$last_date.'/'.$opsi_imut.'/'.$range_imut));
      }
    }
    else if($mode=='data'){
      echo json_encode($this->m_report->i_mutu_all($data['id'],$data['id2'],$data['id3'],$data['id4'],1));
    }
    else if($mode=='hapus'){
      $kondisi=array('barcode_pegawai'=>$this->session->barcode_pegawai,'id_eq_imut'=>$data['id']);
      $jml = $this->m_umum->jumlah_record_filter('ol_eq_imut',$kondisi);
      if($jml == 0){
          $this->session->set_flashdata('danger', 'Hanya Dapat Menghapus Data Sendiri');
          redirect(base_url('ol_imut/i_mutu'));
      }else{
        if($this->m_umum->hapus_data('ol_eq_imut','id_eq_imut',$data['id'])){
          $this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
          redirect(base_url('ol_imut/i_mutu'));
        }else{
          $this->session->set_flashdata('danger', 'Masalah Hapus Data');
          redirect(base_url('ol_imut/i_mutu'));
        }
      }
    }
    else{
      $data['cmd_status'] = $this->m_rancak->cmd_status();
      $data['cmd_ya_tidak'] = $this->m_rancak->cmd_ya_tidak();
      $kone = array('status_eq_detil'=>1,'status_equipment'=>1,'id_unit'=>$this->session->unit,'jenis_equipment'=>1);
      $data['equipment'] = $this->m_ol_rancak->ambil_equipment_imut($kone);
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
        $data['tgl_eq_imut']  = set_value('tgl_eq_imut',date('d-m-Y'));     
        $data['id_eq_detil']  = set_value('id_eq_detil',$this->input->post("id_eq_detil"));        
        $data['yn_eq_imut']  = set_value('yn_eq_imut',0);        
        $data['ket_eq_imut']  = set_value('ket_eq_imut',$this->input->post("ket_eq_imut"));        
        $data['hasil_eq_imut']  = set_value('hasil_eq_imut',0);        
        $data['status_eq_imut']  = set_value('status_eq_imut',$this->input->post("status_eq_imut"));             
        $this->load->view("ol_imut/isi",$data);
      }
      if($mode=='simpan_tambah'){
        $id_eq_detil = $this->input->post('id_eq_detil');
        if($id_eq_detil){
          if($this->m_report->simpan_indikator_mutu()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
            redirect(base_url('ol_imut/i_mutu'));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Simpan Data');
            redirect(base_url('ol_imut/i_mutu'));
          }
        }else{
            $this->session->set_flashdata('danger', 'Belum Ada Data');
            redirect(base_url('ol_imut/i_mutu'));          
        }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
        $keuangan    = $this->m_umum->ambil_data('ol_eq_imut','id_eq_imut',$data['id']);
        $data['tgl_eq_imut']  = set_value('tgl_eq_imut',date('d-m-Y', strtotime($keuangan["tgl_eq_imut"])));
        $data['id_eq_imut']  = set_value('id_eq_imut',$keuangan["id_eq_imut"]);
        $data['id_eq_detil']  = set_value('id_eq_detil',$keuangan["id_eq_detil"]);
        $data['yn_eq_imut']  = set_value('yn_eq_imut',$keuangan["yn_eq_imut"]);
        $data['ket_eq_imut']  = set_value('ket_eq_imut',$keuangan["ket_eq_imut"]);
        $data['hasil_eq_imut']  = set_value('hasil_eq_imut',$keuangan["hasil_eq_imut"]);
        $data['status_eq_imut']  = set_value('status_eq_imut',$keuangan["status_eq_imut"]);
        $this->load->view("ol_imut/isi",$data);
      }
      if($mode=='simpan_edit'){
      $id_eq_imut = $this->input->post('id_eq_imut');
      $kondisi=array('barcode_pegawai'=>$this->session->barcode_pegawai,'id_eq_imut'=>$id_eq_imut);
      $jml = $this->m_umum->jumlah_record_filter('ol_eq_imut',$kondisi);
      if($jml == 0){
          $this->session->set_flashdata('danger', 'Hanya Dapat Menghapus Data Sendiri');
          redirect(base_url('ol_imut/i_mutu'));
      }else{
          if($this->m_report->rubah_indikator_mutu()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
            redirect(base_url('ol_imut/i_mutu'));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
            redirect(base_url('ol_imut/i_mutu'));
          }
        }
      }
      if($mode=='clone'){
        $data['page'] =  $data['page']."_clone";
        $keuangan    = $this->m_umum->ambil_data('ol_eq_imut','id_eq_imut',$data['id']);
        $data['tgl_eq_imut']  = set_value('tgl_eq_imut',date('d-m-Y', strtotime($keuangan["tgl_eq_imut"])));
        $data['id_eq_imut']  = set_value('id_eq_imut',$keuangan["id_eq_imut"]);
        $data['id_eq_detil']  = set_value('id_eq_detil',$keuangan["id_eq_detil"]);
        $data['yn_eq_imut']  = set_value('yn_eq_imut',$keuangan["yn_eq_imut"]);
        $data['ket_eq_imut']  = set_value('ket_eq_imut',$keuangan["ket_eq_imut"]);
        $data['hasil_eq_imut']  = set_value('hasil_eq_imut',$keuangan["hasil_eq_imut"]);
        $data['status_eq_imut']  = set_value('status_eq_imut',$keuangan["status_eq_imut"]);
        $this->load->view("ol_imut/isi",$data);
      }
      if($mode=='simpan_clone'){
        if($this->m_report->simpan_indikator_mutu()){
          $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
          redirect(base_url('ol_imut/i_mutu'));
        }else{
          $this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
          redirect(base_url('ol_imut/i_mutu'));
        }
      }
    }
  }
//=================================================== QC
  function quality($mode='view'){
    $data['page']="quality";
    $data['title'] = "QUALITY CONTROL";
    $data['link_kembali'] = base_url('member');
    $data['link_awal'] = base_url('ol_imut');
    $pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
    $instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
    $data['instance_id'] = $instansi["id_instansi"];
    $data['header'] = $instansi["nama_instansi"];
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
    $data['id'] = $this->uri->segment(4, 0);
    if($mode=='view'){
      $this->tampil($data);
    }
    else if($mode=='data'){
      echo json_encode($this->m_report->equipment_all(2));
    }
    else{
      $data['cmd_status'] = $this->m_rancak->cmd_status();
      $data['cmd_unit'] = $this->m_ol_rancak->ambil_unit_transaksi();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
        $data['nama_equipment']  = set_value('nama_equipment',$this->input->post('nama_equipment'));
        $data['id_unit']  = set_value('id_unit',$this->input->post('id_unit'));
        $data['status_equipment']  = set_value('status_equipment',$this->input->post('status_equipment'));
        $this->load->view("ol_imut/isi",$data);
      }
      if($mode=='simpan_tambah'){
        if($this->m_report->simpan_equipment(2)){
          $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
          redirect(base_url('ol_imut/quality'));
        }else{
          $this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
          redirect(base_url('ol_imut/quality'));
        }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
        $keuangan    = $this->m_umum->ambil_data('ol_equipment','id_equipment',$data['id']);
        $data['id_equipment']  = set_value('id_equipment',$keuangan["id_equipment"]);
        $data['nama_equipment']  = set_value('nama_equipment',$keuangan["nama_equipment"]);
        $data['id_unit']  = set_value('id_unit',$keuangan["id_unit"]);
        $data['status_equipment']  = set_value('status_equipment',$keuangan["status_equipment"]);
        $data['pembuat_equipment']  = set_value('pembuat_equipment',$keuangan["pembuat_equipment"]);
        $this->load->view("ol_imut/isi",$data);
      }
      if($mode=='simpan_edit'){
      $id_equipment = $this->input->post('id_equipment');
      $kondisi=array('pembuat_equipment'=>$this->session->barcode_pegawai,'id_equipment'=>$id_equipment);
      $jml = $this->m_umum->jumlah_record_filter('ol_equipment',$kondisi);
      if($jml == 0){
          $this->session->set_flashdata('danger', 'Hanya Dapat Menghapus Data Sendiri');
          redirect(base_url('ol_imut/quality'));
      }else{
          if($this->m_report->edit_equipment()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
            redirect(base_url('ol_imut/quality'));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
            redirect(base_url('ol_imut/quality'));
          }
        }

      }
    }
  }
  function control($mode='view'){
    $data['page']="control";
    $data['title'] = "INPUT POIN CONTROL";
    $data['link_kembali'] = base_url('member');
    $data['link_awal'] = base_url('ol_imut');
    $pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
    $instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
    $data['instance_id'] = $instansi["id_instansi"];
    $data['header'] = $instansi["nama_instansi"];
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
    $data['id'] = $this->uri->segment(4, 0);
    if($mode=='view'){
      $this->tampil($data);
    }
    else if($mode=='data'){
      echo json_encode($this->m_report->mutu_all(2));
    }
    else{
        $data['cmd_status'] = $this->m_rancak->cmd_status();
        $data['equipment'] = $this->m_ol_rancak->ambil_equipment_in(2);
        if($mode=='tambah'){
          $data['page'] =  $data['page']."_tambah";
          $data['id_equipment']  = set_value('id_equipment',$this->input->post('id_equipment'));
          $data['nama_eq_detil']  = set_value('nama_eq_detil',$this->input->post('nama_eq_detil'));
          $data['status_eq_detil']  = set_value('status_eq_detil',$this->input->post('status_eq_detil'));
          $this->load->view("ol_imut/isi",$data);
        }
        if($mode=='simpan_tambah'){
        $id_equipment = $this->input->post('id_equipment');
        if($id_equipment){
            if($this->m_report->simpan_equipment_detil()){
              $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
              redirect(base_url('ol_imut/control'));
            }else{
              $this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
              redirect(base_url('ol_imut/control'));
            }
          }else{
               $this->session->set_flashdata('danger', 'Belum Ada Data');
              redirect(base_url('ol_imut/control'));           
          }
        }
        if($mode=='edit'){
          $data['page'] =  $data['page']."_edit";
          $keuangan    = $this->m_umum->ambil_data('ol_eq_detil','id_eq_detil',$data['id']);
          $data['id_eq_detil']  = set_value('id_eq_detil',$keuangan["id_eq_detil"]);
          $data['id_equipment']  = set_value('id_equipment',$keuangan["id_equipment"]);
          $data['nama_eq_detil']  = set_value('nama_eq_detil',$keuangan["nama_eq_detil"]);
          $data['status_eq_detil']  = set_value('status_eq_detil',$keuangan["status_eq_detil"]);
          $this->load->view("ol_imut/isi",$data);
        }
        if($mode=='simpan_edit'){
        $id_eq_detil = $this->input->post('id_eq_detil');
        $kondisi=array('pembuat_eq_detil'=>$this->session->barcode_pegawai,'id_eq_detil'=>$id_eq_detil);
        $jml = $this->m_umum->jumlah_record_filter('ol_eq_detil',$kondisi);
        if($jml == 0){
            $this->session->set_flashdata('danger', 'Hanya Dapat Menghapus Data Sendiri');
            redirect(base_url('ol_imut/control'));
        }else{
          if($this->m_report->edit_equipment_detil()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
            redirect(base_url('ol_imut/control'));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
            redirect(base_url('ol_imut/control'));
          }
        }
      }
    }
  }
  function q_control($mode='view'){
    $data['page']="q_control";
    $data['title'] = "INPUT QUALITY CONTROL";
    $data['link_kembali'] = base_url('member');
    $data['link_awal'] = base_url('ol_imut');
    $pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
    $instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
    $data['instance_id'] = $instansi["id_instansi"];
    $data['header'] = $instansi["nama_instansi"];
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
    $data['id'] = $this->uri->segment(4, 0);
    $data['id2'] = $this->uri->segment(5, 0);
    $data['id3'] = $this->uri->segment(6, 0);
    $data['id4'] = $this->uri->segment(7, 0);
    $kon = array('status_equipment'=>1,'id_unit'=>$this->session->unit,'jenis_equipment'=>2);
    $data['opsi'] = $this->m_ol_rancak->ambil_equipment_mutu_null($kon);
    $data['all_kah'] = array('0'=>'Range Tanggal','1'=>'Semua');
    if($mode=='view'){
      if(empty($data['id'])){
        if($this->session->has_userdata('tgl_imut1')){
          $data['id'] = $this->session->tgl_imut1;
        }else{
          $data['id'] = '01-'.date('m-Y');
        }
      }
      if(empty($data['id2'])){
        if($this->session->has_userdata('tgl_imut2')){
          $data['id2'] = $this->session->tgl_imut2;
        }else{
          $data['id2'] = date('d-m-Y');
        }
      }
      if(empty($data['id3'])){
        if($this->session->has_userdata('opsi_imut')){
          $data['id3'] = $this->session->opsi_imut;
        }else{
          $data['id3'] = 0;
        }
      }
      if(empty($data['id4'])){
        if($this->session->has_userdata('range_imut')){
          $data['id4'] = $this->session->range_imut;
        }else{
          $data['id4'] = 1;
        }
      }
      $this->tampil($data);
      $action = $this->input->post('action');
      if($action == 'BtnProses') {
        $first_date = $this->input->post("id");
        $last_date = $this->input->post("id2");
        $opsi_imut = $this->input->post("id3");
        $range_imut = $this->input->post("id4");
        $data_user_level = array(
          'tgl_imut1'     => $first_date,
          'tgl_imut2'     => $last_date,
          'opsi_imut'     => $opsi_imut,
          'range_imut'     => $range_imut
        );
        $this->session->set_userdata($data_user_level); 
        redirect(base_url('ol_imut/'.$data['page'].'/view/'.$first_date.'/'.$last_date.'/'.$opsi_imut.'/'.$range_imut));
      }
    }
    else if($mode=='data'){
      echo json_encode($this->m_report->i_mutu_all($data['id'],$data['id2'],$data['id3'],$data['id4'],2));
    }
    else if($mode=='hapus'){
      $kondisi=array('barcode_pegawai'=>$this->session->barcode_pegawai,'id_eq_imut'=>$data['id']);
      $jml = $this->m_umum->jumlah_record_filter('ol_eq_imut',$kondisi);
      if($jml == 0){
          $this->session->set_flashdata('danger', 'Hanya Dapat Menghapus Data Sendiri');
          redirect(base_url('ol_imut/q_control'));
      }else{
        if($this->m_umum->hapus_data('ol_eq_imut','id_eq_imut',$data['id'])){
          $this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
          redirect(base_url('ol_imut/q_control'));
        }else{
          $this->session->set_flashdata('danger', 'Masalah Hapus Data');
          redirect(base_url('ol_imut/q_control'));
        }
      }
    }
    else{
      $data['cmd_status'] = $this->m_rancak->cmd_status();
      $data['cmd_ya_tidak'] = $this->m_rancak->cmd_ya_tidak();
      $data['equipment'] = $this->m_ol_rancak->ambil_equipment_in(2);
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
        $data['tgl_eq_imut']  = set_value('tgl_eq_imut',date('d-m-Y'));     
        $data['id_eq_detil']  = set_value('id_eq_detil',$this->input->post("id_eq_detil"));        
        $data['yn_eq_imut']  = set_value('yn_eq_imut',0);        
        $data['ket_eq_imut']  = set_value('ket_eq_imut',$this->input->post("ket_eq_imut"));        
        $data['hasil_eq_imut']  = set_value('hasil_eq_imut',0);        
        $data['status_eq_imut']  = set_value('status_eq_imut',$this->input->post("status_eq_imut"));             
        $this->load->view("ol_imut/isi",$data);
      }
      if($mode=='simpan_tambah'){
        $id_eq_detil = $this->input->post('id_eq_detil');
        if($id_eq_detil){
          if($this->m_report->simpan_indikator_mutu()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
            redirect(base_url('ol_imut/q_control'));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Simpan Data');
            redirect(base_url('ol_imut/q_control'));
          }
        }else{
            $this->session->set_flashdata('danger', 'Belum Ada Data');
            redirect(base_url('ol_imut/q_control'));          
        }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
        $keuangan    = $this->m_umum->ambil_data('ol_eq_imut','id_eq_imut',$data['id']);
        $data['tgl_eq_imut']  = set_value('tgl_eq_imut',date('d-m-Y', strtotime($keuangan["tgl_eq_imut"])));
        $data['id_eq_imut']  = set_value('id_eq_imut',$keuangan["id_eq_imut"]);
        $data['id_eq_detil']  = set_value('id_eq_detil',$keuangan["id_eq_detil"]);
        $data['yn_eq_imut']  = set_value('yn_eq_imut',$keuangan["yn_eq_imut"]);
        $data['ket_eq_imut']  = set_value('ket_eq_imut',$keuangan["ket_eq_imut"]);
        $data['hasil_eq_imut']  = set_value('hasil_eq_imut',$keuangan["hasil_eq_imut"]);
        $data['status_eq_imut']  = set_value('status_eq_imut',$keuangan["status_eq_imut"]);
        $this->load->view("ol_imut/isi",$data);
      }
      if($mode=='simpan_edit'){
      $id_eq_imut = $this->input->post('id_eq_imut');
      $kondisi=array('barcode_pegawai'=>$this->session->barcode_pegawai,'id_eq_imut'=>$id_eq_imut);
      $jml = $this->m_umum->jumlah_record_filter('ol_eq_imut',$kondisi);
      if($jml == 0){
          $this->session->set_flashdata('danger', 'Hanya Dapat Menghapus Data Sendiri');
          redirect(base_url('ol_imut/q_control'));
      }else{
          if($this->m_report->rubah_indikator_mutu()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
            redirect(base_url('ol_imut/q_control'));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
            redirect(base_url('ol_imut/q_control'));
          }
        }
      }
      if($mode=='clone'){
        $data['page'] =  $data['page']."_clone";
        $keuangan    = $this->m_umum->ambil_data('ol_eq_imut','id_eq_imut',$data['id']);
        $data['tgl_eq_imut']  = set_value('tgl_eq_imut',date('d-m-Y', strtotime($keuangan["tgl_eq_imut"])));
        $data['id_eq_imut']  = set_value('id_eq_imut',$keuangan["id_eq_imut"]);
        $data['id_eq_detil']  = set_value('id_eq_detil',$keuangan["id_eq_detil"]);
        $data['yn_eq_imut']  = set_value('yn_eq_imut',$keuangan["yn_eq_imut"]);
        $data['ket_eq_imut']  = set_value('ket_eq_imut',$keuangan["ket_eq_imut"]);
        $data['hasil_eq_imut']  = set_value('hasil_eq_imut',$keuangan["hasil_eq_imut"]);
        $data['status_eq_imut']  = set_value('status_eq_imut',$keuangan["status_eq_imut"]);
        $this->load->view("ol_imut/isi",$data);
      }
      if($mode=='simpan_clone'){
        if($this->m_report->simpan_indikator_mutu()){
          $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
          redirect(base_url('ol_imut/q_control'));
        }else{
          $this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
          redirect(base_url('ol_imut/q_control'));
        }
      }
    }
  }
  function equipment_data($id)
  {
    $dt=$this->m_report->ambil_data_eq_detil($id);
    echo json_encode($dt);
  }
  function persen($mode='view'){
    $data['page']="persen";
    $data['title'] = "SETING PERSEN DAN TARGET - RUMUS = X / Y * 100";
    $data['link_kembali'] = base_url('member');
    $data['link_awal'] = base_url('ol_imut');
    $pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
    $instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
    $data['instance_id'] = $instansi["id_instansi"];
    $data['header'] = $instansi["nama_instansi"];
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
    $data['id'] = $this->uri->segment(4, 0);
    if($mode=='view'){
      $this->tampil($data);
    }
    else if($mode=='data'){
      echo json_encode($this->m_report->persen_all());
    }
    else{
      $data['cmd_status'] = $this->m_rancak->cmd_status();
      $knds_eq = array('id_unit'=>$this->session->unit);
      $data['kol_equipment'] = $this->m_umum->ambil_data_kondisi_result('ol_equipment',$knds_eq);
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
        $data['id_equipment']  = set_value('id_equipment',$this->input->post('id_equipment'));
        $data['num_eq_denum']  = set_value('num_eq_denum',$this->input->post('num_eq_denum'));
        $data['denum_eq_denum']  = set_value('denum_eq_denum',$this->input->post('denum_eq_denum'));
        $data['target_eq_denum']  = set_value('target_eq_denum',$this->input->post('target_eq_denum'));
        $data['status_eq_denum']  = set_value('status_eq_denum',$this->input->post('status_eq_denum'));
        $data['num'] = array("");
        $data['denum'] = array("");
        $this->load->view("ol_imut/isi",$data);
      }
      if($mode=='simpan_tambah'){
        $id_equipment = $this->input->post('id_equipment');
        $num_eq_denum = $this->input->post('num_eq_denum');
        $denum_eq_denum = $this->input->post('denum_eq_denum');
        if(empty($id_equipment) || empty($num_eq_denum) || empty($denum_eq_denum)){
            $this->session->set_flashdata('danger', 'Data Harus Terisi');
            redirect(base_url('ol_imut/persen'));
        }else{
          if($this->m_report->simpan_ol_eq_denum()){
              $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
              redirect(base_url('ol_imut/persen'));
            }else{
              $this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
              redirect(base_url('ol_imut/persen'));
            }
        }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
        $keuangan    = $this->m_umum->ambil_data('ol_eq_denum','id_eq_denum',$data['id']);
        $data['id_eq_denum']  = set_value('id_eq_denum',$keuangan["id_eq_denum"]);
        $data['id_equipment']  = set_value('id_equipment',$keuangan["id_equipment"]);
        $data['num_eq_denum']  = set_value('num_eq_denum',$keuangan["num_eq_denum"]);
        $data['denum_eq_denum']  = set_value('denum_eq_denum',$keuangan["denum_eq_denum"]);
        $data['target_eq_denum']  = set_value('target_eq_denum',$keuangan["target_eq_denum"]);
        $data['status_eq_denum']  = set_value('status_eq_denum',$keuangan["status_eq_denum"]);
        $data['num'] = $this->m_report->ambil_data_eq_detil_edit($keuangan['num_eq_denum']);
        $data['denum'] = $this->m_report->ambil_data_eq_detil_edit($keuangan['denum_eq_denum']);
        $this->load->view("ol_imut/isi",$data);
      }
      if($mode=='simpan_edit'){
        $id_equipment = $this->input->post('id_equipment');
        $num_eq_denum = $this->input->post('num_eq_denum');
        $denum_eq_denum = $this->input->post('denum_eq_denum');
        if(empty($id_equipment) || empty($num_eq_denum) || empty($denum_eq_denum)){
            $this->session->set_flashdata('danger', 'Data Harus Terisi');
            redirect(base_url('ol_imut/persen'));
        }else{
          if($this->m_report->edit_ol_eq_denum()){
              $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
              redirect(base_url('ol_imut/persen'));
            }else{
              $this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
              redirect(base_url('ol_imut/persen'));
            }
        }
      }
    }
  }
//=================================================== QC
  function report($mode='view'){
    $data['page']="report";
    $data['title'] = "LAPORAN";
    $data['link_kembali'] = base_url('member');
    $data['link_awal'] = base_url('ol_imut');
    $pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
    $instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
    $data['instance_id'] = $instansi["id_instansi"];
    $data['header'] = $instansi["nama_instansi"];
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
    $data['id'] = $this->uri->segment(4, 0);
    $data['id2'] = $this->uri->segment(5, 0);
    $data['id3'] = $this->uri->segment(6, 0);
    $data['id4'] = $this->uri->segment(7, 0);
    $kon = array('status_equipment'=>1,'id_unit'=>$this->session->unit);
    $data['opsi'] = $this->m_ol_rancak->ambil_equipment_mutu_null($kon);
    $data['all_kah'] = array('0'=>'Range Tanggal','1'=>'Semua');
    if($mode=='view'){
      if(empty($data['id'])){
        if($this->session->has_userdata('tgl_report_imutu1')){
          $data['id'] = $this->session->tgl_report_imutu1;
        }else{
          $data['id'] = '01-'.date('m-Y');
        }
      }
      if(empty($data['id2'])){
        if($this->session->has_userdata('tgl_report_imutu2')){
          $data['id2'] = $this->session->tgl_report_imutu2;
        }else{
          $data['id2'] = date('d-m-Y');
        }
      }
      if(empty($data['id3'])){
        if($this->session->has_userdata('opsi_report_imutu')){
          $data['id3'] = $this->session->opsi_report_imutu;
        }else{
          $data['id3'] = 0;
        }
      }
      if(empty($data['id4'])){
        if($this->session->has_userdata('range_report_imutu')){
          $data['id4'] = $this->session->range_report_imutu;
        }else{
          $data['id4'] = 1;
        }
      }
      $this->tampil($data);
      $action = $this->input->post('action');
      if($action == 'BtnProses') {
        $first_date = $this->input->post("id");
        $last_date = $this->input->post("id2");
        $opsi_report_imutu = $this->input->post("id3");
        $range_report_imutu = $this->input->post("id4");
        $data_user_level = array(
          'tgl_report_imutu1'     => $first_date,
          'tgl_report_imutu2'     => $last_date,
          'opsi_report_imutu'     => $opsi_report_imutu,
          'range_report_imutu'     => $range_report_imutu
        );
        $this->session->set_userdata($data_user_level); 
        redirect(base_url('ol_imut/'.$data['page'].'/view/'.$first_date.'/'.$last_date.'/'.$opsi_report_imutu.'/'.$range_report_imutu));
      }
    }
    else if($mode=='data'){
      echo json_encode($this->m_report->laporan_all($data['id'],$data['id2'],$data['id3'],$data['id4'],1));
    }
    else{
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
        $data['tgl_laporan']  = set_value('tgl_laporan',date('d-m-Y'));
        $data['tgl_awal']  = set_value('tgl_awal',date('d-m-Y'));
        $data['tgl_akhir']  = set_value('tgl_akhir',date('d-m-Y'));           
        $data['header_laporan']  = set_value('header_laporan',$this->input->post("header_laporan"));        
        $data['sub_header_laporan']  = set_value('sub_header_laporan',$this->input->post("sub_header_laporan"));        
        $data['sub_sub_header_laporan']  = set_value('sub_sub_header_laporan',$this->input->post("sub_sub_header_laporan"));        
        $data['judul_laporan']  = set_value('judul_laporan',$this->input->post("judul_laporan"));       
        $data['tujuan_laporan']  = set_value('tujuan_laporan',$this->input->post("tujuan_laporan"));        
        $data['sumber_laporan']  = set_value('sumber_laporan',$this->input->post("sumber_laporan"));              
        $data['periode_laporan']  = set_value('periode_laporan',$this->input->post("periode_laporan"));       
        $this->load->view("ol_imut/isi",$data);
      }
      if($mode=='simpan_tambah'){
            if($this->m_report->simpan_report()){
              $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
              redirect(base_url('ol_imut/report'));
            }else{
              $this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
              redirect(base_url('ol_imut/report'));
            }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
        $keuangan = $this->m_umum->ambil_data('ol_laporan','id_laporan',$data['id']);   
        $data['tgl_laporan']  = set_value('tgl_laporan',date('d-m-Y', strtotime($keuangan["tgl_laporan"])));
        $data['tgl_awal']  = set_value('tgl_awal',date('d-m-Y', strtotime($keuangan["tgl_awal"])));
        $data['tgl_akhir']  = set_value('tgl_akhir',date('d-m-Y', strtotime($keuangan["tgl_akhir"])));
        $data['id_laporan']  = set_value('id_laporan',$keuangan["id_laporan"]);
        $data['header_laporan']  = set_value('header_laporan',$keuangan["header_laporan"]);
        $data['sub_header_laporan']  = set_value('sub_header_laporan',$keuangan["sub_header_laporan"]);
        $data['sub_sub_header_laporan']  = set_value('sub_sub_header_laporan',$keuangan["sub_sub_header_laporan"]);
        $data['judul_laporan']  = set_value('judul_laporan',$keuangan["judul_laporan"]);
        $data['tujuan_laporan']  = set_value('tujuan_laporan',$keuangan["tujuan_laporan"]);
        $data['sumber_laporan']  = set_value('sumber_laporan',$keuangan["sumber_laporan"]);
        $data['periode_laporan']  = set_value('periode_laporan',$keuangan["periode_laporan"]);
        $this->load->view("ol_imut/isi",$data);
      }
      if($mode=='simpan_edit'){
      $id_laporan = $this->input->post('id_laporan');
      $kondisi=array('pembuat_laporan'=>$this->session->barcode_pegawai,'id_laporan'=>$id_laporan);
      $jml = $this->m_umum->jumlah_record_filter('ol_laporan',$kondisi);
      if($jml == 0){
          $this->session->set_flashdata('danger', 'Hanya Dapat Menghapus Data Sendiri');
          redirect(base_url('ol_imut/report'));
      }else{
          if($this->m_report->rubah_report()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
            redirect(base_url('ol_imut/report'));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
            redirect(base_url('ol_imut/report'));
          }
        }
      }
      if($mode=='jump'){
        $id_laporan = $data['id'];
        $data_user_level = array(
          'id_laporan_report'     => $id_laporan
        );
        $this->session->set_userdata($data_user_level); 
        redirect(base_url('ol_imut/sheet/view/'.$id_laporan));
      }
    }
  }
  function sheet($mode='view'){
    $data['page']="sheet";
    $data['title'] = "LAPORAN";
    $data['link_kembali'] = base_url('member');
    $data['link_awal'] = base_url('ol_imut');
    $pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
    $instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
    $data['instance_id'] = $instansi["id_instansi"];
    $data['header'] = $instansi["nama_instansi"];
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
    $data['iddet'] = $this->uri->segment(5, 0);
/*    if(empty($data['idlap'])){
      if($this->session->has_userdata('id_laporan_report')){
        $data['idlap'] = $this->session->id_laporan_report;
      }else{
        $data['idlap'] = $this->uri->segment(4, 0);
      }
    }
    if(empty($data['iddet'])){
      if($this->session->has_userdata('id_laporan_detil_report')){
        $data['iddet'] = $this->session->id_laporan_detil_report;
      }else{
        $data['iddet'] = $this->uri->segment(5, 0);
      }
    }*/
    //======================= LINK =========================================
    $lp = $this->m_ol_rancak->ambil_data_laporan_detil($data['iddet']); // id_laporan_detil
    $data['id_laporan']  = set_value('id_laporan',$lp["id_laporan"]);
    $data['nama_pegawai']  = set_value('nama_pegawai',$lp["nama_pegawai"]);
    $data['id_equipment']  = set_value('id_equipment',$lp["id_equipment"]);
    $data['nama_unit']  = set_value('nama_unit',$lp["nama_unit"]);
    $data['tgl_laporan']  = set_value('tgl_laporan',date('d-m-Y', strtotime($lp["tgl_laporan"])));
    $data['tgl_awal']  = set_value('tgl_awal',date('d-m-Y', strtotime($lp["tgl_awal"])));
    $data['tgl_akhir']  = set_value('tgl_akhir',date('d-m-Y', strtotime($lp["tgl_akhir"])));
    $data['id_pegawai']  = set_value('id_pegawai',$lp["id_pegawai"]);
    $data['barcode_pegawai']  = set_value('barcode_pegawai',$lp["barcode_pegawai"]);
    $data['header_laporan']  = set_value('header_laporan',$lp["header_laporan"]);
    $data['sub_header_laporan']  = set_value('sub_header_laporan',$lp["sub_header_laporan"]);
    $data['sub_sub_header_laporan']  = set_value('sub_sub_header_laporan',$lp["sub_sub_header_laporan"]);
    $data['judul_laporan']  = set_value('judul_laporan',$lp["judul_laporan"]);
    $data['tujuan_laporan']  = set_value('tujuan_laporan',$lp["tujuan_laporan"]);
    $data['periode_laporan']  = set_value('periode_laporan',$lp["periode_laporan"]);
    $data['sumber_laporan']  = set_value('sumber_laporan',$lp["sumber_laporan"]);
    $data['id_laporan_detil']  = set_value('id_laporan_detil',$lp["id_laporan_detil"]);
    $data['judul_laporan_detil']  = set_value('judul_laporan_detil',$lp["judul_laporan_detil"]);
    $data['analisa_laporan_detil']  = set_value('analisa_laporan_detil',$lp["analisa_laporan_detil"]);
    $data['rekomendasi_laporan_detil']  = set_value('rekomendasi_laporan_detil',$lp["rekomendasi_laporan_detil"]);
    $data['min_laporan_detil']  = set_value('min_laporan_detil',$lp["min_laporan_detil"]);
    $data['max_laporan_detil']  = set_value('max_laporan_detil',$lp["max_laporan_detil"]);
    $data['periode_laporan_detil']  = set_value('periode_laporan_detil',$lp["periode_laporan_detil"]);
    $data['numerator_laporan_detil']  = set_value('numerator_laporan_detil',$lp["numerator_laporan_detil"]);
    $data['denumerator_laporan_detil']  = set_value('denumerator_laporan_detil',$lp["denumerator_laporan_detil"]);
    $data['nudenum']  = set_value('nudenum',$lp["nudenum"]);
    $data['urutan_laporan_detil']  = set_value('urutan_laporan_detil',$lp["urutan_laporan_detil"]);
    $data['equipment_detil']  = set_value('equipment_detil',$lp["equipment_detil"]);
    $data['show_pdf']  = set_value('show_pdf',$lp["show_pdf"]);
    $data['tabel']  = set_value('tabel',$lp["tabel"]);
    $data['button']  = set_value('button',$lp["button"]);
    //========================================================
    $data['jns_eq'] = array('1','2');
    //========================================================
    $kondisi_cek = array('id_laporan_detil'=>$data['iddet'],'pembuat_laporan'=>$this->session->barcode_pegawai);
    $data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('ol_laporan_detil',$kondisi_cek,'ol_laporan','id_laporan');
    $data['ambil_tabel'] = $this->m_rancak->ambil_sn_tabel();
    $data['cmd_ya_tidak'] = $this->m_rancak->cmd_ya_tidak();
    $data['periode'] = $this->m_rancak->cmd_periode_laporan_detil();
    //========================================================
    if($mode=='view'){
      $this->tampil_top($data);
    }
    else if($mode=='data'){
      echo json_encode($this->m_report->laporan_detil_all($data['idlap'],1));
    }
    else{
      $kon = array('status_equipment'=>1,'id_unit'=>$this->session->unit);
      $data['equipment'] = $this->m_ol_rancak->ambil_equipment_mutu($kon);
      if($mode=='tambah_tabel'){
        $data['page'] =  $data['page']."_tambah_tabel";   
        $data['min_laporan_detil']  = set_value('min_laporan_detil',0);       
        $data['max_laporan_detil']  = set_value('max_laporan_detil',0);             
        $data['periode_laporan_detil']  = set_value('periode_laporan_detil',2);             
        $data['analisa_laporan_detil']  = set_value('analisa_laporan_detil','Analisa : ');             
        $data['rekomendasi_laporan_detil']  = set_value('rekomendasi_laporan_detil','Hasil / Rekomendasi : ');
        $kondisi_cek = array('id_laporan'=>$data['idlap'],'pembuat_laporan'=>$this->session->barcode_pegawai);
        $data['cek'] = $this->m_umum->jumlah_record_filter('ol_laporan',$kondisi_cek);
        $this->load->view("ol_imut/isi",$data);
      }
      if($mode=='simpan_tambah_tabel'){
        $id_laporan = $this->input->post("id_laporan");
        $tabel = $this->input->post("tabel");
        $id_equipment = $this->input->post("id_equipment");
        $kondisi=array('pembuat_laporan'=>$this->session->barcode_pegawai,'id_laporan'=>$id_laporan);
        $jml = $this->m_umum->jumlah_record_filter('ol_laporan',$kondisi);
        if($jml == 0){
            $this->session->set_flashdata('danger', 'Hanya Dapat Mengakses Data Sendiri');
            redirect(base_url('ol_imut/report'));
        }else{
          if($tabel){
      //      if($id_equipment){
              if($Q = $this->m_report->tambah_tabel()){
                $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
                redirect(base_url('ol_imut/sheet/view/'.$id_laporan.'/'.$Q));
              }else{
                $this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
                redirect(base_url('ol_imut/sheet/view/'.$id_laporan.'/'.$Q));
              }
/*            }else{
               $this->session->set_flashdata('danger', 'Belum Ada Data');
              redirect(base_url('ol_imut/report'));              
            }*/
          }else{
             $this->session->set_flashdata('danger', 'Data Tabel Kosong');
            redirect(base_url('ol_imut/report'));           
          }
        }
      }
      if($mode=='rubah_tabel'){
        $data['page'] =  $data['page']."_rubah_tabel"; 
        $this->load->view("ol_imut/isi",$data);
      }
      if($mode=='simpan_rubah_tabel'){
      $id_laporan = $this->input->post('id_laporan');
      $id_laporan_detil = $this->input->post('id_laporan_detil');
      $tabel = $this->input->post('tabel');
      $id_equipment = $this->input->post('id_equipment');
      $kondisi=array('pembuat_laporan'=>$this->session->barcode_pegawai,'ol_laporan_detil.id_laporan'=>$id_laporan);
      $jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_laporan_detil',$kondisi,'ol_laporan','id_laporan');
      if($jml == 0){
          $this->session->set_flashdata('danger', 'Hanya Dapat Mengakses Data Sendiri');
          redirect(base_url('ol_imut/sheet/view/'.$id_laporan.'/'.$id_laporan_detil));
      }else{
        if($tabel){
  //        if($id_equipment){
              if($this->m_report->rubah_tabel()){
                $this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
                redirect(base_url('ol_imut/sheet/view/'.$id_laporan.'/'.$id_laporan_detil));
              }else{
                $this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
                redirect(base_url('ol_imut/sheet/view/'.$id_laporan.'/'.$id_laporan_detil));
              }
/*            }else{
              $this->session->set_flashdata('danger', 'Belum Ada Data');
              redirect(base_url('ol_imut/sheet/view/'.$id_laporan.'/'.$id_laporan_detil));               
            }*/
          }else{
            $this->session->set_flashdata('danger', 'Data Tabel Kosong');
            redirect(base_url('ol_imut/sheet/view/'.$id_laporan.'/'.$id_laporan_detil));           
          }
        }
      }
      if($mode=='clone'){
        $data['page'] =  $data['page']."_clone"; 
        $this->load->view("ol_imut/isi",$data);
      }
      if($mode=='simpan_clone'){
      $id_laporan = $this->input->post('id_laporan');
      $id_laporan_detil = $this->input->post('id_laporan_detil');
      $tabel = $this->input->post('tabel');
      $kondisi=array('pembuat_laporan'=>$this->session->barcode_pegawai,'ol_laporan_detil.id_laporan'=>$id_laporan);
      $jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_laporan_detil',$kondisi,'ol_laporan','id_laporan');
      if($jml == 0){
          $this->session->set_flashdata('danger', 'Hanya Dapat Mengakses Data Sendiri');
          redirect(base_url('ol_imut/sheet/view/'.$id_laporan.'/'.$id_laporan_detil));
      }else{
        if($tabel){
            if($this->m_report->tambah_tabel()){
              $this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
              redirect(base_url('ol_imut/sheet/view/'.$id_laporan.'/'.$id_laporan_detil));
            }else{
              $this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
              redirect(base_url('ol_imut/sheet/view/'.$id_laporan.'/'.$id_laporan_detil));
            }
          }else{
            $this->session->set_flashdata('danger', 'Data Tabel Kosong');
            redirect(base_url('ol_imut/sheet/view/'.$id_laporan.'/'.$id_laporan_detil));           
          }
        }
      }
    if($mode=='seting_im'){
      $data['page'] =  $data['page']."_seting_im";
      $data['chk_eq_detil'] = $this->m_report->ambil_equipment_lap($data['jns_eq']);
      $this->load->view("ol_imut/isi",$data);
    }
    if($mode=='simpan_seting_im'){
      $id_laporan = $this->input->post("id_laporan");
      $id_laporan_detil = $this->input->post("id_laporan_detil");
      $kondisi=array('pembuat_laporan'=>$this->session->barcode_pegawai,'ol_laporan_detil.id_laporan'=>$id_laporan);
      $jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_laporan_detil',$kondisi,'ol_laporan','id_laporan');
        if($jml == 0){
            $this->session->set_flashdata('danger', 'Hanya Dapat Mengakses Data Sendiri');
            redirect(base_url('ol_imut/sheet/view/'.$id_laporan.'/'.$id_laporan_detil));
        }else{
            $this->m_report->simpan_eq_lap();
            $this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
            redirect(base_url('ol_imut/sheet/view/'.$id_laporan.'/'.$id_laporan_detil));
        }
      }
    if($mode=='seting'){
      $data['page'] =  $data['page']."_seting";
      $data['chk_eq_detil'] = $this->m_report->ambil_eq_detil($data['iddet'],$data['jns_eq']);
      $this->load->view("ol_imut/isi",$data);
    }
    if($mode=='simpan_seting'){
      $id_laporan = $this->input->post("id_laporan");
      $id_laporan_detil = $this->input->post("id_laporan_detil");
      $kondisi=array('pembuat_laporan'=>$this->session->barcode_pegawai,'ol_laporan_detil.id_laporan'=>$id_laporan);
      $jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_laporan_detil',$kondisi,'ol_laporan','id_laporan');
        if($jml == 0){
            $this->session->set_flashdata('danger', 'Hanya Dapat Mengakses Data Sendiri');
            redirect(base_url('ol_imut/sheet/view/'.$id_laporan.'/'.$id_laporan_detil));
        }else{
            $this->m_report->simpan_eq_detil();
            $this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
            redirect(base_url('ol_imut/sheet/view/'.$id_laporan.'/'.$id_laporan_detil));
        }
      }
    if($mode=='persen'){
      $data['page'] =  $data['page']."_persen";
      $data['chk_eq_detil'] = $this->m_report->ambil_equipment_lap($data['jns_eq']);
      $this->load->view("ol_imut/isi",$data);
    }
    if($mode=='simpan_persen'){
      $id_laporan = $this->input->post("id_laporan");
      $id_laporan_detil = $this->input->post("id_laporan_detil");
      $kondisi=array('pembuat_laporan'=>$this->session->barcode_pegawai,'ol_laporan_detil.id_laporan'=>$id_laporan);
      $jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_laporan_detil',$kondisi,'ol_laporan','id_laporan');
        if($jml == 0){
            $this->session->set_flashdata('danger', 'Hanya Dapat Mengakses Data Sendiri');
            redirect(base_url('ol_imut/sheet/view/'.$id_laporan.'/'.$id_laporan_detil));
        }else{
            $this->m_report->simpan_nudenum();
            $this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
            redirect(base_url('ol_imut/sheet/view/'.$id_laporan.'/'.$id_laporan_detil));
        }
      }
    if($mode=='xy'){
      $data['page'] =  $data['page']."_xy";
      $data['chk_eq_detil'] = $this->m_report->ambil_kat_persen($lp["nudenum"]);
      $this->load->view("ol_imut/isi",$data);
    }
    if($mode=='simpan_xy'){
      $id_laporan = $this->input->post("id_laporan");
      $id_laporan_detil = $this->input->post("id_laporan_detil");
      $kondisi=array('pembuat_laporan'=>$this->session->barcode_pegawai,'ol_laporan_detil.id_laporan'=>$id_laporan);
      $jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_laporan_detil',$kondisi,'ol_laporan','id_laporan');
        if($jml == 0){
            $this->session->set_flashdata('danger', 'Hanya Dapat Mengakses Data Sendiri');
            redirect(base_url('ol_imut/sheet/view/'.$id_laporan.'/'.$id_laporan_detil));
        }else{
            $this->m_report->simpan_xy();
            $this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
            redirect(base_url('ol_imut/sheet/view/'.$id_laporan.'/'.$id_laporan_detil));
        }
      }
    }
  }
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
  $this->load->view("ol_imut/header",$data);
  $this->load->view("ol_imut/isi");
  $this->load->view("footer");
  $this->load->view("ol_imut/jsload");
  $this->load->view("ol_imut/jscode");
}
function tampil_top($data)
{
  $this->load->view("header_topol",$data);
  $this->load->view("ol_imut/isi");
  $this->load->view("footer");
  $this->load->view("ol_imut/jsload");
  $this->load->view("ol_imut/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
