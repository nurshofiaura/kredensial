<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Isi_etik extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
		  $this->login_kah();
          $this->load->model('m_rperawat');
          $this->load->model('m_berkas');
          $this->load->model('m_karu');
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
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==15 ) //karu
          return TRUE;
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==19 ) //karu
          return TRUE;
     else
          redirect(base_url('logout'));
  }
	function index(){
		$this->etik();
	}
  function etik($mode='view')
  {
	$data['page']  = "etik";
	$data['header'] = "ETIK PEGAWAI";
	$data['title'] = "ETIK PEGAWAI";
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
	$data['level_name'] = $pegawai["nama_level"];
	$data['photo'] = $pegawai["foto"];
	$data['notifikasi']=$this->m_rancak->jumlah_record_notification($pegawai["id_pegawai"],$pegawai["id_unit"],$pegawai["id_level"]);
	$data['link_notification']=$this->m_rancak->link_notification($pegawai["id_unit"],$pegawai["id_level"]);
	$data['ambil_birthday']   = $this->m_rancak->ambil_birthday();
	$datea = date("Y-m-d", strtotime("-10 years"));
	$dateb = date("Y-m-d", strtotime("+6 month"));
	$data['ambil_berkas_expired']=$this->m_rancak->ambil_berkas_expired($this->session->id_user);
	$kondisi_str=array('tgl_b_berkas >='=>$datea,'tgl_b_berkas <='=>$dateb,'status_berkas'=>1,
		'id_kategori_berkas'=>1,'id_pegawai'=>$this->session->id_pegawai);
	$data['jml_str']=$this->m_umum->jumlah_record_filter('berkas',$kondisi_str);
	$kondisi_sip=array('tgl_b_berkas >='=>$datea,'tgl_b_berkas <='=>$dateb,'status_berkas'=>1,
		'id_kategori_berkas'=>2,'id_pegawai'=>$this->session->id_pegawai);
	$data['jml_sip']=$this->m_umum->jumlah_record_filter('berkas',$kondisi_sip);
	$kondisi_sik=array('tgl_b_berkas >='=>$datea,'tgl_b_berkas <='=>$dateb,'status_berkas'=>1,
		'id_kategori_berkas'=>3,'id_pegawai'=>$this->session->id_pegawai);
	$data['jml_sik']=$this->m_umum->jumlah_record_filter('berkas',$kondisi_sik);
	$data['id'] = $this->uri->segment(4, 0);
	if(empty($data['id'])){
		$data['id'] = '0';
	}
  $leveleku = $this->session->id_level;
  if($leveleku == 99){
     $data['cmd_pegawai_null'] = $this->m_rancak->cmd_pegawai_null_pemulihan2();
  }elseif ($leveleku == 98) {
	   $data['cmd_pegawai_null'] = $this->m_rancak->cmd_pegawai_null_pemulihan3();
  }
  else{
	   $data['cmd_pegawai_null'] = $this->m_karu->cmd_pegawai_null($pegawai['id_ruangan'],$data['level_id']);
  }
    if($mode=='view'){
		$this->tampil_top($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$id = $this->input->post("id");
			redirect(base_url('isi_etik/etik/view/'.$id));
		}
	}
    else if($mode=='data'){
		echo json_encode($this->m_karu->etik_pegawai_all($pegawai['id_ruangan'],$data['id'],$pegawai['id_level']));
	}
  else{
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		if(empty($data['id'])){
			$this->session->set_flashdata('danger', 'Pilih Pegawai Dahulu');
			redirect(base_url('isi_etik/etik'));
		}
		$cek_pegawai=$this->m_rancak->ambil_pegawai($data['id']);
		$data['kol_etik_all']   = $this->m_karu->kol_etik_all($cek_pegawai['id_jabatan']);
		$data['num_kol_etik_all']   = $this->m_karu->num_kol_etik_all($cek_pegawai['id_jabatan']);
		$this->form_validation->set_rules('id_pegawai','id_pegawai','required');
        if ($this->form_validation->run() === FALSE){
			$this->tampil_top($data);
        }else{
			$last_ide = $this->m_karu->simpan_etik_pegawai();
			$this->m_karu->simpan_etik_pegawai_detil($last_ide);
			redirect(base_url('isi_etik/etik'));

        }
      }
      if($mode=='lihat'){
        $data['page'] =  $data['page']."_lihat";
				$cek_pegawai=$this->m_rancak->ambil_pegawai($data['id']);
				$data['kol_etik_detil_all']   = $this->m_karu->kol_etik_detil_all($data['id']);
				$data['etik_pegawairow_all']   = $this->m_karu->etik_pegawairow_all($data['id']);
				$data['num_kol_etik_all']   = $this->m_karu->num_kol_etik_all($cek_pegawai['id_jabatan']);
		$this->tampil_top($data);
      }
	}
  }
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("karu/header",$data);
	$this->load->view("karu/isi");
	$this->load->view("footer");
	$this->load->view("karu/jsload");
	$this->load->view("karu/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_top",$data);
	$this->load->view("isi_etik/isi");
	$this->load->view("footer");
	$this->load->view("isi_etik/jsload");
	$this->load->view("isi_etik/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
