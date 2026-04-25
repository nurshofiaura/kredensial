<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');
/* 	SEARCHING WITH HIGHLIGHT
	$keyword = "";
	$queryCondition = "";
	if(!empty($_POST["keyword"])) {
		$keyword = $_POST["keyword"];
		$wordsAry = explode(" ", $keyword);
		$wordsCount = count($wordsAry);
		$queryCondition = " WHERE ";
		for($i=0;$i<$wordsCount;$i++) {
			$queryCondition .= "title LIKE '%" . $wordsAry[$i] . "%' OR description LIKE '%" . $wordsAry[$i] . "%'";
			if($i!=$wordsCount-1) {
				$queryCondition .= " OR ";
			}
		}
	}
	$orderby = " ORDER BY id desc";
	$sql = "SELECT * FROM links " . $queryCondition;
	$result = mysqli_query($conn,$sql);
	function highlightKeywords($text, $keyword) {
		$wordsAry = explode(" ", $keyword);
		$wordsCount = count($wordsAry);

		for($i=0;$i<$wordsCount;$i++) {
			$highlighted_text = "<span style='font-weight:bold;'>$wordsAry[$i]</span>";
			$text = str_ireplace($wordsAry[$i], $highlighted_text, $text);
		}

		return $text;
	} */
class Web extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
          $this->load->model('m_administrator');
          $this->load->model('m_berkas');
  }
  function index(){
	if($this->session->userdata('id_pegawai')){
		redirect(base_url('login'));
	}
    $data['page']="home";
	$data['header'] = "BERANDA";
	$data['title'] = "BERANDA";
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','2');
	$ologin = $this->m_umum->ambil_data('a_online','kode_online','masuk');
	$data['opsi_login'] = $ologin["status_online"];
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
	$data['welcome'] = $instansi["welcome"];
	$data['web_header'] = $instansi["web_header"];
	$data['web_intro'] = $instansi["web_intro"];
	$data['web_slider'] = $instansi["web_slider"];
	// assets\admin\style-login.css
	//======================= IMPORTANT =========================================
    $this->tampil($data);
  }
  function faq(){
    $data['page']="faq";
  	$data['header'] = "BERANDA";
  	$data['title'] = "BERANDA";
  	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','2');
		$ologin = $this->m_umum->ambil_data('a_online','kode_online','masuk');
		$data['opsi_login'] = $ologin["status_online"];
  	$data['instance_id'] = $instansi["id_instansi"];
  	$data['instance_name'] = $instansi["nama_instansi"];
  	$data['idescription'] = $instansi["description"];
  	$data['ikeywords'] = $instansi["keywords"];
  	$data['iheader'] = $instansi["header"];
  	$data['iheader_mini'] = $instansi["header_mini"];
  	$data['ifooter'] = $instansi["footer"];
  	$data['ilicensed'] = $instansi["licensed"];
  	$data['welcome'] = $instansi["welcome"];
  	$data['web_header'] = $instansi["web_header"];
  	$data['web_intro'] = $instansi["web_intro"];
  	$data['web_slider'] = $instansi["web_slider"];
	// assets\admin\style-login.css
	//======================= IMPORTANT =========================================
	   $data['ambil_faq']=$this->m_administrator->ambil_faq();
     $this->tampil($data);
  }
  function logbook()
  {
    $data['page']  = "logbook";
		$data['header'] = "GRAFIK LOGBOOK";
		$data['title'] = "GRAFIK LOGBOOK";
    $instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','2');
		$ologin = $this->m_umum->ambil_data('a_online','kode_online','masuk');
		$data['opsi_login'] = $ologin["status_online"];
  	$data['instance_id'] = $instansi["id_instansi"];
  	$data['instance_name'] = $instansi["nama_instansi"];
  	$data['idescription'] = $instansi["description"];
  	$data['ikeywords'] = $instansi["keywords"];
  	$data['iheader'] = $instansi["header"];
  	$data['iheader_mini'] = $instansi["header_mini"];
  	$data['ifooter'] = $instansi["footer"];
  	$data['ilicensed'] = $instansi["licensed"];
  	$data['welcome'] = $instansi["welcome"];
  	$data['web_header'] = $instansi["web_header"];
  	$data['web_intro'] = $instansi["web_intro"];
  	$data['web_slider'] = $instansi["web_slider"];
//  	$data['ambil_kol_golongan_pemeriksaan_graph'] = $this->m_rancak->ambil_kompetensi_all();
 	  $data['tbl_kompetensi'] = $this->m_administrator->tbl_kompetensi(date('Y'));
//  	$data['json'] = $this->m_administrator->logbook();
    $this->tampil($data);
  }
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("web/header",$data);
	$this->load->view("web/isi");
	$this->load->view("web/footer");
	$this->load->view("web/jsload");
	$this->load->view("web/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
