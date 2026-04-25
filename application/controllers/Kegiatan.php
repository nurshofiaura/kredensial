<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Kegiatan extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
		  $this->login_kah();
		  $this->load->model('m_kegiatan');
  }
  function login_kah(){
    $link_akses = $this->uri->segment(1, 0);
    $kondisi_hak=array('id_pegawai'=>$this->session->id_pegawai,'link_akses'=>$link_akses);
    $jumlah_hak_akses_pegawai=$this->m_rancak->jumlah_hak_akses_pegawai($kondisi_hak);
    if($jumlah_hak_akses_pegawai == 0){
      $this->cek_login_kah();
    }else{
      return TRUE;
    }
  }
  function cek_login_kah()
  {
      if ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==99 )
          return TRUE;
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==98 )
          return TRUE;
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==12 )
          return TRUE;
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==15 )
          return TRUE;
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==16 ) // komite
          return TRUE;
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==17 ) // asesor
          return TRUE;
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==18 ) // kabid
          return TRUE;
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==19 ) // karu
          return TRUE;
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==50 ) // direktur
          return TRUE;
     else
          redirect(base_url('logout'));
  }
	function index(){
		$data['page']="home";
		$data['header'] = "BERANDA";
		$data['title'] = "BERANDA";
		$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
		$program    = $this->m_umum->ambil_data('a_program','id_program','1');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$data['instance_id'] = $instansi["id_instansi"];
		$data['instance_name'] = $instansi["nama_instansi"];
		$data['idescription'] = $instansi["description"];
		$data['ikeywords'] = $instansi["keywords"];
		$data['iheader'] = $instansi["header"];
		$data['iheader_mini'] = $instansi["header_mini"];
		$data['ifooter'] = $instansi["footer"];
		$data['ilicensed'] = $instansi["licensed"];
		$data['member_name'] = $pegawai["nama_pegawai"];
		$data['level_name'] = $pegawai["nama_level"];
		$data['photo'] = $pegawai["foto"];
		$data['notifikasi']=$this->m_rancak->jumlah_record_notification($pegawai["id_pegawai"],$pegawai["id_unit"],$pegawai["id_level"]);
		$data['link_notification']=$this->m_rancak->link_notification($pegawai["id_unit"],$pegawai["id_level"]);
		$data['ambil_birthday']   = $this->m_rancak->ambil_birthday();
		$datea = date("Y-m-d", strtotime("-10 years"));
		$dateb = date("Y-m-d", strtotime("+6 month"));
		$data['ambil_berkas_expired']=$this->m_rancak->ambil_berkas_expired($this->session->id_user);
    $kondisi_str=array('tgl_b_berkas >='=>$datea,'tgl_b_berkas <='=>$dateb,'status_berkas'=>1,
  		'id_kategori_berkas'=>1,'id_pegawai'=>$pegawai['id_pegawai']);
  	$data['jml_str']=$this->m_umum->jumlah_record_filter('berkas',$kondisi_str);
  	$kondisi_sip=array('tgl_b_berkas >='=>$datea,'tgl_b_berkas <='=>$dateb,'status_berkas'=>1,
  		'id_kategori_berkas'=>2,'id_pegawai'=>$pegawai['id_pegawai']);
  	$data['jml_sip']=$this->m_umum->jumlah_record_filter('berkas',$kondisi_sip);
  	$kondisi_sik=array('tgl_b_berkas >='=>$datea,'tgl_b_berkas <='=>$dateb,'status_berkas'=>1,
  		'id_kategori_berkas'=>3,'id_pegawai'=>$pegawai['id_pegawai']);
  	$data['jml_sik']=$this->m_umum->jumlah_record_filter('berkas',$kondisi_sik);
		//======================= IMPORTANT =========================================
		$this->tampil($data);
	}
  function pemulihan($mode='view')
  {
	$data['page']  = "pemulihan";
	$data['header'] = "DAFTAR KEGIATAN PEMULIHAN KEWENANGAN";
	$data['title'] = "DAFTAR KEGIATAN PEMULIHAN KEWENANGAN";
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$program    = $this->m_umum->ambil_data('a_program','id_program',$pegawai["id_program"]);
	$data['program_unit'] = $program["unit"];
	$data['program_user_level'] = $program["user_level"];
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
	$data['pake_wa'] = $instansi["wa"];
	$data['member_name'] = $pegawai["nama_pegawai"];
	$data['member_id'] = $pegawai["id_pegawai"];
	$data['level_id'] = $pegawai["id_level"];
	$data['room_id'] = $pegawai["id_ruangan"];
	$data['level_name'] = $pegawai["nama_level"];
	$data['photo'] = $pegawai["foto"];
	$data['notifikasi']=$this->m_rancak->jumlah_record_notification($pegawai["id_pegawai"],$pegawai["id_unit"],$pegawai["id_level"]);
	$data['link_notification']=$this->m_rancak->link_notification($pegawai["id_unit"],$pegawai["id_level"]);
	$data['ambil_birthday']   = $this->m_rancak->ambil_birthday();
	$datea = date("Y-m-d", strtotime("-10 years"));
	$dateb = date("Y-m-d", strtotime("+6 month"));
	$data['ambil_berkas_expired']=$this->m_rancak->ambil_berkas_expired($this->session->id_user);
	$kondisi_str=array('tgl_b_berkas >='=>$datea,'tgl_b_berkas <='=>$dateb,'status_berkas'=>1,
		'id_kategori_berkas'=>1,'id_pegawai'=>$pegawai['id_pegawai']);
	$data['jml_str']=$this->m_umum->jumlah_record_filter('berkas',$kondisi_str);
	$kondisi_sip=array('tgl_b_berkas >='=>$datea,'tgl_b_berkas <='=>$dateb,'status_berkas'=>1,
		'id_kategori_berkas'=>2,'id_pegawai'=>$pegawai['id_pegawai']);
	$data['jml_sip']=$this->m_umum->jumlah_record_filter('berkas',$kondisi_sip);
	$kondisi_sik=array('tgl_b_berkas >='=>$datea,'tgl_b_berkas <='=>$dateb,'status_berkas'=>1,
		'id_kategori_berkas'=>3,'id_pegawai'=>$pegawai['id_pegawai']);
	$data['jml_sik']=$this->m_umum->jumlah_record_filter('berkas',$kondisi_sik);
	$data['id'] = $this->uri->segment(4, 0);
	$data['idhp'] = $this->uri->segment(5, 0);
  if($mode=='view'){
		$this->tampil($data);
	}
  else if($mode=='data'){
		echo json_encode($this->m_kegiatan->logbook_pemulihan_penanggungjawab($pegawai['id_pegawai']));
	}
  else if($mode=='data2'){
		echo json_encode($this->m_kegiatan->logbook_kegiatan_pemulihan_personal($data['id']));
	}
	else{
    $data['cmd_pegawai']=$this->m_rancak->cmd_pegawai($program['jabatan'],$pegawai['id_level']);
    $data['cmd_kompeten']=$this->m_rancak->cmd_kompeten();
    if($mode=='tambah'){
      if(empty($data['id']) OR $data['id'] == 0){
        $this->session->set_flashdata('danger', 'Tidak Ada ID');
        redirect(base_url('kegiatan/pemulihan'));
    	}
      $data['page'] =  $data['page']."_tambah";
      $data['ambil_lobook_pemulihan_detil']=$this->m_rancak->ambil_kewenangan_lobook_pemulihan_detil2($data['id']);
      $this->tampil($data);
    }
    if($mode=='isi'){
      $data['page'] =  $data['page']."_isi";
      $data['ambil_kewenangan_lobook_pemulihan_detil']=$this->m_rancak->ambil_kewenangan_lobook_pemulihan_detil($data['id']);
      $lpd = $this->m_umum->ambil_data('logbook_pemulihan','id_logbook_pemulihan',$data['id']);
      $data['result_pemulihan']  = set_value('result_pemulihan',$lpd['result_pemulihan']);
      $data['id_penguji']  = set_value('id_penguji',$lpd['id_pemulihan']);
      $data['result_kegiatan_pemulihan']  = set_value('result_kegiatan_pemulihan',$this->input->post('result_kegiatan_pemulihan'));
      $data['rm_kegiatan_pemulihan']  = set_value('rm_kegiatan_pemulihan',$this->input->post('rm_kegiatan_pemulihan'));
      $data['catatan_kegiatan_pemulihan']  = set_value('catatan_kegiatan_pemulihan',$this->input->post('catatan_kegiatan_pemulihan'));
      $data['tgl_kegiatan_pemulihan']  = set_value('tgl_kegiatan_pemulihan',date('d-m-Y'));
      $this->load->view("kegiatan/isi",$data);
    }
    if($mode=='simpan_isi'){
      $id_logbook_pemulihan= $this->input->post('id_logbook_pemulihan');
      $result_pemulihan = $this->input->post('result_pemulihan');
      if($result_pemulihan == 0){
        if($this->input->post('chk')){
    		  if(empty($id_logbook_pemulihan)){
            $this->session->set_flashdata('danger', 'Data ID Kosong');
      			redirect(base_url('kegiatan/pemulihan/tambah/'.$id_logbook_pemulihan));
    		  }else{
              $this->m_kegiatan->simpan_logbook_kegiatan_pemulihan();
              $this->session->set_flashdata('sukses', 'Data berhasil Di Tambah');
    					redirect(base_url('kegiatan/pemulihan/tambah/'.$id_logbook_pemulihan));
    		  }
        }
        else{
          $this->session->set_flashdata('danger', 'Tidak Ada Yang Terpilih');
          redirect(base_url('kegiatan/pemulihan/tambah/'.$id_logbook_pemulihan));
        }
      }else{
        $this->session->set_flashdata('danger', 'Data Sudah Dilakukan Validasi');
        redirect(base_url('kegiatan/pemulihan/tambah/'.$id_logbook_pemulihan));
      }
    }
    if($mode=='edit'){
      $data['page'] =  $data['page']."_edit";
      $lpd = $this->m_umum->ambil_data('logbook_kegiatan_pemulihan','id_kegiatan_pemulihan',$data['idhp']);
      $aktivitas = $this->m_umum->ambil_data('logbook_pemulihan','id_logbook_pemulihan',$data['id']);
      $data['result_pemulihan']  = set_value('result_pemulihan',$aktivitas['result_pemulihan']);
      $data['id_penguji']  = set_value('id_penguji',$lpd['id_penguji']);
      $data['id_kewenangan']  = set_value('id_kewenangan',$lpd['id_kewenangan']);
      $data['result_kegiatan_pemulihan']  = set_value('result_kegiatan_pemulihan',$lpd['result_kegiatan_pemulihan']);
      $data['rm_kegiatan_pemulihan']  = set_value('rm_kegiatan_pemulihan',$lpd['rm_kegiatan_pemulihan']);
      $data['catatan_kegiatan_pemulihan']  = set_value('catatan_kegiatan_pemulihan',$lpd['catatan_kegiatan_pemulihan']);
      $data['tgl_kegiatan_pemulihan']  = set_value('tgl_kegiatan_pemulihan',date('d-m-Y', strtotime($lpd['tgl_kegiatan_pemulihan'])));
      $this->load->view("kegiatan/isi",$data);
    }
    if($mode=='simpan_edit'){
      $id_logbook_pemulihan= $this->input->post('id_logbook_pemulihan');
      $result_pemulihan = $this->input->post('result_pemulihan');
      if($result_pemulihan == 0){
        $id_kewenangan= $this->input->post('id_kewenangan');
        $tgl_kegiatan_pemulihan= $this->input->post('tgl_kegiatan_pemulihan');
  		  $tgl_kegiatan_pemulihan = date('Y-m-d', strtotime($tgl_kegiatan_pemulihan));
        $tgl_kegiatan_pemulihan_lama= $this->input->post('tgl_kegiatan_pemulihan_lama');
  		  $tgl_kegiatan_pemulihan_lama = date('Y-m-d', strtotime($tgl_kegiatan_pemulihan_lama));
        $id_kegiatan_pemulihan= $this->input->post('id_kegiatan_pemulihan');
        $this->db->select("COUNT(*) as num");
        $this->db->where('id_kewenangan',$id_kewenangan);
        $this->db->where('tgl_kegiatan_pemulihan',$tgl_kegiatan_pemulihan);
        $this->db->where('tgl_kegiatan_pemulihan !=',$tgl_kegiatan_pemulihan_lama);
        $this->db->where('id_logbook_pemulihan',$id_logbook_pemulihan);
        $q = $this->db->get('logbook_kegiatan_pemulihan')->row();
        $jml = $q->num;
        if($jml == 0){
          if($this->m_kegiatan->edit_logbook_kegiatan_pemulihan()){
            $this->session->set_flashdata('sukses', 'Hasil Sudah Terupdate');
            redirect(base_url('kegiatan/pemulihan/tambah/'.$id_logbook_pemulihan));
          }else{
            $this->session->set_flashdata('danger', 'Masalah Penambahan Data');
            redirect(base_url('kegiatan/pemulihan/tambah/'.$id_logbook_pemulihan));
          }
        }else{
          $this->session->set_flashdata('danger', 'Kewenangan Sudah Ada');
          redirect(base_url('kegiatan/pemulihan/tambah/'.$id_logbook_pemulihan));
        }
      }else{
        $this->session->set_flashdata('danger', 'Data Sudah Dilakukan Validasi');
        redirect(base_url('kegiatan/pemulihan/tambah/'.$id_logbook_pemulihan));
      }
    }
	 }
  }
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("kegiatan/header",$data);
	$this->load->view("kegiatan/isi");
	$this->load->view("footer");
	$this->load->view("kegiatan/jsload");
	$this->load->view("kegiatan/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_top",$data);
	$this->load->view("kegiatan/isi");
	$this->load->view("footer");
	$this->load->view("kegiatan/jsload");
	$this->load->view("kegiatan/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
