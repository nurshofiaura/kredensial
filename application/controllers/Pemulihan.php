<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Pemulihan extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
		  $this->login_kah();
		  $this->load->model('m_pemulihan');
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
     else
          redirect(base_url('logout'));
  }
	function index(){
		$data['page']="home";
		$data['header'] = "BERANDA";
		$data['title'] = "BERANDA";
		$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
		$program    = $this->m_umum->ambil_data('a_program','id_program','1');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','2');
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
  function daftar($mode='view')
  {
	$data['page']  = "daftar";
	$data['header'] = "DAFTAR PENOLAKAN KEWENANGAN PEGAWAI";
	$data['title'] = "DAFTAR PENOLAKAN KEWENANGAN PEGAWAI";
	$data['link_kembali'] = base_url();
	$data['link_awal'] = base_url('berkas/berkas');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$program    = $this->m_umum->ambil_data('a_program','id_program',$pegawai["id_program"]);
	$data['program_unit'] = $program["unit"];
	$data['program_user_level'] = $program["user_level"];
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','2');
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
	if(empty($data['id'])){
		$data['id'] = '0';
	}
  $data['cmd_pegawai_null']=$this->m_rancak->cmd_pegawai_null_pemulihan();
  $data['cmd_pegawai']=$this->m_rancak->cmd_pegawai($program['jabatan'],$pegawai['id_level']);
  $data['cmd_data_ruangan']=$this->m_rancak->cmd_data_ruangan();
  if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$id = $this->input->post("id");
			redirect(base_url('pemulihan/daftar/view/'.$id));
		}
	}
  else if($mode=='data'){
		echo json_encode($this->m_pemulihan->kewenangan_tolak($data['id']));
	}
	else{
    if($mode=='pendaftaran'){
      $data['page'] =  $data['page']."_pendaftaran";
      $barcode_pegawai = $this->m_umum->ambil_data('pegawai','id_pegawai',$data['id']);
      $data['id_unit_pegawai']  = $barcode_pegawai['id_ruangan'];
      $data['id_pemulihan']  = set_value('id_pemulihan',$this->input->post('id_pemulihan'));
      $data['id_unit_pemulihan']  = set_value('id_unit_pemulihan',$this->input->post('id_unit_pemulihan'));
      $data['tgl_awal']  = set_value('tgl_awal',date('d-m-Y'));
      $data['tgl_akhir']  = set_value('tgl_akhir',date('d-m-Y'));
      $this->load->view("pemulihan/isi",$data);
    }
    if($mode=='simpan_pendaftaran'){
      $id_pegawai= $this->input->post('id_pegawai');
  		  if(empty($id_pegawai)){
          $this->session->set_flashdata('danger', 'Data Pegawai Kosong');
    			redirect(base_url('pemulihan/daftar'));
  		  }else{
          if($last_ide = $this->m_pemulihan->simpan_pemulihan()){
  					$this->session->set_flashdata('sukses', 'Data berhasil Di Tambah');
  					redirect(base_url('pemulihan/kegiatan/edit/'.$last_ide));
				  }else{
  					$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data');
  					redirect(base_url('pemulihan/daftar'));
				  }
  		}
    }
	 }
  }
  function kegiatan($mode='view')
  {
	$data['page']  = "kegiatan";
	$data['header'] = "DAFTAR PILIHAN KEWENANGAN PEGAWAI TERTOLAK";
	$data['title'] = "DAFTAR PILIHAN KEWENANGAN PEGAWAI TERTOLAK";
	$data['link_kembali'] = base_url();
	$data['link_awal'] = base_url('berkas/berkas');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$program    = $this->m_umum->ambil_data('a_program','id_program',$pegawai["id_program"]);
	$data['program_unit'] = $program["unit"];
	$data['program_user_level'] = $program["user_level"];
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','2');
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
	if(empty($data['id'])){
		$data['id'] = '0';
	}
  $data['cmd_pegawai_null']=$this->m_rancak->cmd_pegawai_null_pemulihan();
  $data['cmd_pegawai']=$this->m_rancak->cmd_pegawai($program['jabatan'],$pegawai['id_level']);
  $data['cmd_data_ruangan']=$this->m_rancak->cmd_data_ruangan();
  if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$id = $this->input->post("id");
			redirect(base_url('pemulihan/kegiatan/view/'.$id));
		}
	}
  else if($mode=='data'){
		echo json_encode($this->m_pemulihan->logbook_pemulihan_all($data['id']));
	}
  else if($mode=='data2'){
		echo json_encode($this->m_pemulihan->logbook_pemulihan_detil_pegawai($data['id']));
	}
  else if($mode=='data3'){
		echo json_encode($this->m_pemulihan->logbook_kegiatan_pemulihan_personal($data['id']));
	}
	else{
    if($mode=='edit'){
      if(empty($data['id']) OR $data['id'] == 0){
        $this->session->set_flashdata('danger', 'Tidak Ada ID');
        redirect(base_url('pemulihan/kegiatan'));
    	}
      $data['page'] =  $data['page']."_edit";
      $data['ambil_lobook_pemulihan_detil']=$this->m_rancak->ambil_lobook_pemulihan_detil($data['id']);
      $aktivitas    = $this->m_umum->ambil_data('logbook_pemulihan','id_logbook_pemulihan',$data['id']);
      $data['tgl_awal']  = date('d-m-Y', strtotime($aktivitas["tgl_awal"]));
      $data['tgl_akhir']  = date('d-m-Y', strtotime($aktivitas["tgl_akhir"]));
      $data['result_pemulihan']  = set_value('result_pemulihan',$aktivitas["result_pemulihan"]);
      $data['id_pemulihan']  = set_value('id_pemulihan',$aktivitas["id_pemulihan"]);
      $data['id_unit_pemulihan']  = set_value('id_unit_pemulihan',$aktivitas["id_unit_pemulihan"]);
      $this->form_validation->set_rules('id_logbook_pemulihan','id_logbook_pemulihan','required');
      if ($this->form_validation->run() === FALSE){
        $this->tampil($data);
      }else{
        $result_pemulihan = $this->input->post('result_pemulihan');
        if($result_pemulihan == 0){
          $this->m_pemulihan->edit_pemulihan();
          $this->session->set_flashdata('sukses', 'Data Sudah Di Rubah');
        }else{
          $this->session->set_flashdata('danger', 'Data Sudah Dilakukan Validasi');
        }
        redirect(base_url('pemulihan/kegiatan'));
      }
    }
    if($mode=='tambah'){
      if(empty($data['id']) OR $data['id'] == 0){
        $this->session->set_flashdata('danger', 'Tidak Ada ID');
        redirect(base_url('pemulihan/kegiatan'));
    	}
      $data['page'] =  $data['page']."_tambah";
      $aktivitas    = $this->m_umum->ambil_data('logbook_pemulihan','id_logbook_pemulihan',$data['id']);
      $data['ambil_lobook_perorang']=$this->m_rancak->ambil_lobook_perorang($aktivitas['id_pegawai']);
      $data['result_pemulihan']  = set_value('result_pemulihan',$aktivitas['result_pemulihan']);
      $this->form_validation->set_rules('id_logbook_pemulihan','id_logbook_pemulihan','required');
      if ($this->form_validation->run() === FALSE){
        $this->tampil($data);
      }else{
        $result_pemulihan = $this->input->post('result_pemulihan');
        if($result_pemulihan == 0){
          $this->m_pemulihan->simpan_logbook_pemulihan_detil();
    			$this->session->set_flashdata('sukses', 'Data Sudah Di Tambah & Data Dobel Tidak Di Tambah');
          redirect(base_url('pemulihan/kegiatan/edit/'.$data['id']));
        }else{
          $this->session->set_flashdata('danger', 'Data Sudah Dilakukan Validasi');
          redirect(base_url('pemulihan/kegiatan/edit/'.$data['id']));
        }
      }
    }
    if($mode=='hasil'){
      if(empty($data['id']) OR $data['id'] == 0){
        $this->session->set_flashdata('danger', 'Tidak Ada ID');
        redirect(base_url('pemulihan/kegiatan'));
    	}
      $data['page'] =  $data['page']."_hasil";
			$kondisi_hasil_kegiatan=array('id_logbook_pemulihan'=>$data['id']);
			$data['jml_hasil_kegiatan']=$this->m_umum->jumlah_record_filter('logbook_kegiatan_pemulihan',$kondisi_hasil_kegiatan);
      $data['cmd_kompeten']=$this->m_rancak->cmd_kompeten();
      $data['ambil_lobook_pemulihan_detil']=$this->m_rancak->ambil_kewenangan_lobook_pemulihan_detil2($data['id']);
      $aktivitas    = $this->m_umum->ambil_data('logbook_pemulihan','id_logbook_pemulihan',$data['id']);
      $data['result_pemulihan']  = set_value('result_pemulihan',$aktivitas['result_pemulihan']);
      $data['catatan_pemulihan']  = set_value('catatan_pemulihan',$aktivitas['catatan_pemulihan']);
      $this->form_validation->set_rules('id_logbook_pemulihan','id_logbook_pemulihan','required');
      if ($this->form_validation->run() === FALSE){
        $this->tampil($data);
      }else{
      	$jml_hasil_kegiatan = $this->input->post('jml_hasil_kegiatan');
      	if($jml_hasil_kegiatan > 0){
	        if($this->m_pemulihan->edit_logbook_pemulihan()){
	          $this->session->set_flashdata('sukses', 'Hasil Sudah Terupdate');
	          redirect(base_url('pemulihan/kegiatan'));
	        }else{
	          $this->session->set_flashdata('danger', 'Masalah Penambahan Data');
	          redirect(base_url('pemulihan/kegiatan'));
	        }
	      }else{
          $this->session->set_flashdata('danger', 'Belum Ada Data Kegiatan Pemulihan');
          redirect(base_url('pemulihan/kegiatan'));	      	
	      }
      }
    }
	 }
  }
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("pemulihan/header",$data);
	$this->load->view("pemulihan/isi");
	$this->load->view("footer");
	$this->load->view("pemulihan/jsload");
	$this->load->view("pemulihan/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_top",$data);
	$this->load->view("berkas/isi");
	$this->load->view("footer");
	$this->load->view("berkas/jsload");
	$this->load->view("berkas/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
