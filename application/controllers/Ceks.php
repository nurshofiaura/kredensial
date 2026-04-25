<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Ceks extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
          $this->load->model('m_ol_rancak');
          $this->load->model('m_member');
      $this->load->model('m_auth');
		  $this->m_auth->hak_member();
  }
	function index(){
		$data['page']="home";
		$data['header'] = "MEMBER";
		$data['title'] = "BERANDA";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$data['instance_id'] = $instansi["id_instansi"];
		$data['instance_name'] = $instansi["nama_instansi"];
		$data['idescription'] = $instansi["description"];
		$data['ikeywords'] = $instansi["keywords"];
		$data['iheader'] = $instansi["header"];
		$data['iheader_mini'] = $instansi["header_mini"];
		$data['ifooter'] = $instansi["footer"];
		$data['ilicensed'] = $instansi["licensed"];
		$data['iconik'] = $instansi["icon"];
		$data['logonik'] = $instansi["logo"];
		$data['member_id'] = $pegawai["id_pegawai"];
		$data['member_name'] = $pegawai["nama_pegawai"];
		$data['level_name'] = $pegawai["nama_level"];
		$data['photo'] = $pegawai["foto"];	
		//======================= IMPORTANT =========================================
		$this->tampil_top($data);
	}
 // ================================================ USER ==================================
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("member/header",$data);
	$this->load->view("member/isi");
	$this->load->view("footer");
	$this->load->view("member/jsload");
	$this->load->view("member/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_topol",$data);
	$this->load->view("member/isi_cek");
	$this->load->view("footer");
	$this->load->view("member/jsload");
	$this->load->view("member/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
