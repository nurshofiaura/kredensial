<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Etik extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
		  $this->login_kah();
		  $this->load->model('m_admin_perawat');
          $this->load->model('m_rperawat');
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
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==15 )
          return TRUE;
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==19 )
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
	$data['header'] = "ETIK";
	$data['title'] = "ETIK";
	$data['link_kembali'] = base_url();
	$data['link_awal'] = base_url('etik/etik');
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
		'id_kategori_berkas'=>1,'id_pegawai'=>$this->session->id_pegawai);
	$data['jml_str']=$this->m_umum->jumlah_record_filter('berkas',$kondisi_str);
	$kondisi_sip=array('tgl_b_berkas >='=>$datea,'tgl_b_berkas <='=>$dateb,'status_berkas'=>1,
		'id_kategori_berkas'=>2,'id_pegawai'=>$this->session->id_pegawai);
	$data['jml_sip']=$this->m_umum->jumlah_record_filter('berkas',$kondisi_sip);
	$kondisi_sik=array('tgl_b_berkas >='=>$datea,'tgl_b_berkas <='=>$dateb,'status_berkas'=>1,
		'id_kategori_berkas'=>3,'id_pegawai'=>$this->session->id_pegawai);
	$data['jml_sik']=$this->m_umum->jumlah_record_filter('berkas',$kondisi_sik);
	$data['id_jabatan'] = $this->uri->segment(4, 0);
	if(empty($data['id_jabatan'])){
		$data['id_jabatan'] = '0';
	}
	$data['cmd_jabatan_null'] = $this->m_rperawat->cmd_jabatan_null_with_permission($program['jabatan'],$data['level_id']);
    if($mode=='view'){
		$this->tampil_top($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$id_jabatan = $this->input->post("id_jabatan");
			redirect(base_url('etik/etik/view/'.$id_jabatan));
		}
	}
    else if($mode=='data'){
		echo json_encode($this->m_admin_perawat->etik_all($data['id_jabatan'],$program['jabatan'],$data['level_id']));
	}
/*     else if($mode=='hapus'){
		$kondisi=array('id_kewenangan'=>$data['id_jabatan']);
		$jml = $this->m_umum->jumlah_record_filter('kr_kewenangan_detil',$kondisi);
		if($jml == 0){
		  if($this->m_umum->hapus_data('kr_kewenangan','id_kewenangan',$data['id_jabatan'])){
			$this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
			redirect(base_url('admin_perawat/kategori_kewenangan'));
		  }else{
			$this->session->set_flashdata('danger', 'Masalah Hapus Data');
			redirect(base_url('admin_perawat/kategori_kewenangan'));
		  }
		}else{
			$this->session->set_flashdata('danger', 'Data Sudah Masuk Alur');
			redirect(base_url('admin_perawat/kategori_kewenangan'));
		}
    } */
  else{
		$data['cmd_ya_tidak'] = $this->m_rancak->cmd_ya_tidak();
		$data['cmd_status'] = $this->m_rancak->cmd_status();
	//	$data['cmd_jabatan_null'] = $this->m_rperawat->cmd_jabatan_null();
      if($mode=='tambah'){
		$data['page'] =  $data['page']."_tambah";
		$data['nama_etik']  = set_value('nama_etik',$this->input->post('nama_etik'));
		$data['answer']  = set_value('answer',$this->input->post('answer'));
		$data['status_etik']  = set_value('status_etik',$this->input->post('status_etik'));
		$this->form_validation->set_rules('nama_etik','nama_etik','required');
        if ($this->form_validation->run() === FALSE){
			$this->tampil_top($data);
        }else{
			$this->m_admin_perawat->simpan_etik();
			$this->session->set_flashdata('sukses', 'Data Sudah Di Tambah');
			redirect(base_url('etik'));
        }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
		$d    = $this->m_umum->ambil_data('kol_etik','id_etik',$data['id_jabatan']);
		$data['id_etik'] = set_value('id_etik',$d["id_etik"]);
		$data['nama_etik'] = set_value('nama_etik',$d["nama_etik"]);
		$data['answer'] = set_value('answer',$d["answer"]);
		$data['status_etik'] = set_value('status_etik',$d["status_etik"]);
		$this->form_validation->set_rules('nama_etik','nama_etik','required');
        if ($this->form_validation->run() === FALSE){
			$this->tampil_top($data);
        }else{
			  if($this->m_admin_perawat->edit_etik()){
				$this->session->set_flashdata('sukses', 'Data Sudah Di Rubah');
				redirect(base_url('etik'));
			  }else{
				$this->session->set_flashdata('danger', 'Masalah Edit Data');
				redirect(base_url('etik'));
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
	$this->load->view("adminperawat/header",$data);
	$this->load->view("adminperawat/isi");
	$this->load->view("footer");
	$this->load->view("adminperawat/jsload");
	$this->load->view("adminperawat/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_top",$data);
	$this->load->view("adminperawat/isi");
	$this->load->view("footer");
	$this->load->view("adminperawat/jsload");
	$this->load->view("adminperawat/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
