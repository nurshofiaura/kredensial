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
class Landing extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
    
  }
  function index(){
    $data['page']="home";
	$data['header'] = "SELAMAT DATANG DI LANDING PAGE KREDENSIAL";
	$data['title'] = "SELAMAT DATANG DI LANDING PAGE KREDENSIAL";
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
	$ologin = $this->m_umum->ambil_data('a_online','kode_online','masuk');
	$text = $this->m_umum->ambil_data('a_instansi_text','id_instansi_text',1);
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
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("landing/header",$data);
	$this->load->view("landing/isi");
	$this->load->view("landing/footer");
	$this->load->view("landing/jsload");
	$this->load->view("landing/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
