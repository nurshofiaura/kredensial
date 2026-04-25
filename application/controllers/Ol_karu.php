<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Ol_karu extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
          $this->load->model('m_ol_rancak');
          $this->load->model('m_ol_karu');
          $this->load->model('m_auth');
          $this->m_auth->login_kah();
  }
	function index(){
		$data['page']="home";
		$data['header'] = "BERANDA";
		$data['title'] = "BERANDA";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$data['forpengurus_pengcab'] = $this->m_ol_rancak->ambil_data_dropdown_pengurus_pengcab($this->session->id_pegawai);
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
		$this->tampil($data);
	}
  function etik($mode='view')
  {
	$data['page']  = "etik";
	$data['header'] = "ETIK PEGAWAI";
	$data['title'] = "ETIK PEGAWAI";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$data['forpengurus_pengcab'] = $this->m_ol_rancak->ambil_data_dropdown_pengurus_pengcab($this->session->id_pegawai);
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
		$data['id'] = $this->uri->segment(4, 0);
		if(empty($data['id'])){
			$data['id'] = '0';
		}
		if($this->session->has_userdata('karu')){
			$unit_karu = $this->session->karu;
		}else{
			$unit_karu = 0;
		}
		$ole = $this->m_ol_rancak->ambil_pegawai_for_karu($unit_karu);
		$arr = array();
		foreach($ole as $val){
				$arr[] = $val['id_pegawai'];
		}
		$eimplo = implode(",", $arr);
	  $data['cmd_pegawai_null'] = $this->m_ol_rancak->cmd_pegawai_for_karu_null($eimplo);
    if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$id = $this->input->post('barcode_pegawai');
			redirect(base_url('ol_karu/etik/view/'.$id));
		}
	}
    else if($mode=='data'){
		echo json_encode($this->m_ol_karu->etik_pegawai_all($data['id'],$eimplo));
	}
  else{
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		if(empty($data['id'])){
			$this->session->set_flashdata('danger', 'Pilih Pegawai Dahulu');
			redirect(base_url('ol_karu/etik'));
		}
		$cek_pegawai=$this->m_rancak->ambil_pegawai($data['id']);
		$data['kol_etik_all']   = $this->m_karu->kol_etik_all($cek_pegawai['id_jabatan']);
		$data['num_kol_etik_all']   = $this->m_karu->num_kol_etik_all($cek_pegawai['id_jabatan']);
		$this->form_validation->set_rules('id_pegawai','id_pegawai','required');
        if ($this->form_validation->run() === FALSE){
			$this->tampil($data);
        }else{
			$last_ide = $this->m_karu->simpan_etik_pegawai();
			$this->m_karu->simpan_etik_pegawai_detil($last_ide);
			redirect(base_url('karu/etik'));

        }
      }
      if($mode=='lihat'){
        $data['page'] =  $data['page']."_lihat";
		$cek_pegawai=$this->m_rancak->ambil_pegawai($data['id']);
		$data['kol_etik_detil_all']   = $this->m_karu->kol_etik_detil_all($data['id']);
		$data['etik_pegawairow_all']   = $this->m_karu->etik_pegawairow_all($data['id']);
		$data['num_kol_etik_all']   = $this->m_karu->num_kol_etik_all($cek_pegawai['id_jabatan']);
		$this->tampil($data);
      }
	}
  }
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("ol_karu/header",$data);
	$this->load->view("ol_karu/isi");
	$this->load->view("footer");
	$this->load->view("ol_karu/jsload");
	$this->load->view("ol_karu/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_topol",$data);
	$this->load->view("ol_karu/isi");
	$this->load->view("footer");
	$this->load->view("ol_karu/jsload");
	$this->load->view("ol_karu/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
