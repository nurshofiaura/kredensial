<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Analisa extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
		  $this->login_kah();
          $this->load->model('m_analisa');
          $this->load->model('m_direktur');
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
		$data['member_id'] = $pegawai["id_pegawai"];
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
			'id_kategori_berkas'=>1,'id_pegawai'=>$this->session->id_pegawai);
		$data['jml_str']=$this->m_umum->jumlah_record_filter('berkas',$kondisi_str);
		$kondisi_sip=array('tgl_b_berkas >='=>$datea,'tgl_b_berkas <='=>$dateb,'status_berkas'=>1,
			'id_kategori_berkas'=>2,'id_pegawai'=>$this->session->id_pegawai);
		$data['jml_sip']=$this->m_umum->jumlah_record_filter('berkas',$kondisi_sip);
		$kondisi_sik=array('tgl_b_berkas >='=>$datea,'tgl_b_berkas <='=>$dateb,'status_berkas'=>1,
			'id_kategori_berkas'=>3,'id_pegawai'=>$this->session->id_pegawai);
		$data['jml_sik']=$this->m_umum->jumlah_record_filter('berkas',$kondisi_sik);
		//======================= IMPORTANT =========================================
		$searchValues  = [4,19,20];
		$data['ambil_pengumuman']   = $this->m_rancak->ambil_pengumuman($pegawai['id_jabatan'],$pegawai['id_level'],$program['jabatan']);
		$data['ambil_berkas_expired_all']=$this->m_rancak->ambil_berkas_expired_all();
		$data['jml_pengajuan']=$this->m_umum->jumlah_record_tabel('kr_pengajuan');
		$data['jml_user_kredensial']=$this->m_umum->jumlah_record_tabel('user');
		$data['jlm_pegawai']=$this->m_umum->jumlah_record_tabel('pegawai');
		$data['jml_logbook']=$this->m_umum->jumlah_record_tabel('logbook');
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
		  if($this->m_admin_perawat->simpan_pengumuman($program['jabatan'],$pegawai['id_level'])){
			redirect(base_url('admin_perawat'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Input Data. Hubungi Admin');
			redirect(base_url('admin_perawat'));
		  }
		}
	}
	function pengajuan_kompetensi($mode='view')
  {
	$data['page']  = "pengajuan_kompetensi";
	$data['header'] = "KOMPETENSI";
	$data['title'] = "KOMPETENSI";
	$data['link_kembali'] = base_url('analisa');
	$data['link_awal'] = base_url('analisa/pengajuan_kompetensi');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$program    = $this->m_umum->ambil_data('a_program','id_program',$pegawai["id_program"]);
	$data['program_jabatan'] = $program["jabatan"];
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
	$data['id'] = $this->uri->segment(4, 0);
	$data['all'] = $this->uri->segment(5, 0);
	$data['first_date'] = $this->uri->segment(6, 0);
	$data['last_date'] = $this->uri->segment(7, 0);
	if($data['first_date'] == NULL OR empty($data['first_date'])){
		$data['first_date'] = date('d-m-Y');
	}
	if($data['last_date'] == NULL OR empty($data['last_date'])){
		$data['last_date'] = date('d-m-Y');
	}
  if($mode=='view'){
	if($data['id'] == NULL OR empty($data['id'])){
		$data['id'] = "";
	}
	if($data['all'] == NULL OR empty($data['all'])){
		$data['all'] = "";
	}
		$this->tampil_top($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
      $trim_keyword   = urldecode(trim($this->input->post("id")));
			$replace_keyword   = preg_replace('/\s+/', ' ', $trim_keyword);
			$key = str_replace(' ', '-', $replace_keyword);
			redirect(base_url('analisa/pengajuan_kompetensi/view/'.$key));
		}
	}
  else if($mode=='data_pengajuan'){
		echo json_encode($this->m_analisa->pengajuan_kompetensi_all($data['id']));
	}
  else if($mode=='data_logbook'){
		echo json_encode($this->m_analisa->logbook_all($data['id']));
	}
    else if($mode=='pemulihan'){
		echo json_encode($this->m_analisa->tabel_pemulihan($data['id']));
	}
    else if($mode=='tabel_logbook'){
		if($data['id'] == NULL OR empty($data['id'])){
			$data['id'] = "0";
		}
		if($data['all'] == NULL OR empty($data['all'])){
			$data['all'] = "0";
		}
		echo json_encode($this->m_analisa->tabel_logbook($data['id'],$data['all'],$data['first_date'],$data['last_date']));
	}
  else{
    if($mode=='logbook'){
      $data['page'] =  $data['page']."_logbook";
				$data['ambil_lobook_kompetensi_group_pengajuan']=$this->m_rancak->ambil_lobook_kompetensi_group_pengajuan($data['id']);
				$data['jml_komite_0']=$this->m_rancak->jumlah_record_logbook_pengajuan($data['id'],'v_komite','0');
				$data['jml_komite']=$this->m_rancak->jumlah_record_logbook_pengajuan($data['id'],'v_komite >','0');
				$data['jml_karu']=$this->m_rancak->jumlah_record_logbook_pengajuan($data['id'],'v_karu','2');
				$data['jml_kabid']=$this->m_rancak->jumlah_record_logbook_pengajuan($data['id'],'v_kabid','2');
				$data['jml_asesor']=$this->m_rancak->jumlah_record_logbook_pengajuan($data['id'],'v_asesor','2');
				$data['jumlah_record_logbook_pengajuan']=$data['jml_komite']+$data['jml_karu']+$data['jml_kabid']+$data['jml_asesor'];
				$kondisi_logbook_pengajuan=array('id_pengajuan'=>$data['id']);
				$data['jml_all_logbook_pengajuan']=$this->m_umum->jumlah_record_filter('logbook',$kondisi_logbook_pengajuan);
				if($data['jml_all_logbook_pengajuan'] == $data['jumlah_record_logbook_pengajuan']){
					$data['tampilkan_button'] = 'sama';
				}else{
					$data['tampilkan_button'] = 'taksama';
				}
				$data['ambil_berkas_data']=$this->m_rancak->ambil_all_id_berkas_data();
				$d	=$this->m_rancak->ambil_pengajuan_kompetensi($data['id']);
				$data['ambil_lobook_pemulihan']=$this->m_rancak->ambil_lobook_pemulihan($d['id_pegawai']);
				$data['id_pengajuan']  = set_value('id_pengajuan',$d["id_pengajuan"]);
				$data['id_status_diusulkan']  = set_value('id_status_diusulkan',$d["id_status_diusulkan"]);
				$data['id_berkas']  = explode(",", $d["id_berkas"]);
				$data['berkas']  = $d["id_berkas"];
				$data['tahun']  = date('Y', strtotime($d["tgl_pengajuan"]));
				$data['id_ijasah']  = explode(",", $d["id_ijasah"]);
				$data['id_str']  = explode(",", $d["id_str"]);
				$data['id_sertifikat']  = explode(",", $d["id_sertifikat"]);
				$data['kesesuaian_bukti']  = set_value('kesesuaian_bukti',explode(",", $d["kesesuaian_bukti"]));
				$data['id_etik_pegawai']  = set_value('id_etik_pegawai',explode(",", $d["id_etik_pegawai"]));
				$data['id_logbook_a']  = set_value('id_logbook_a',$d["id_logbook_a"]);
				$data['id_logbook_b']  = set_value('id_logbook_b',$d["id_logbook_b"]);
				$data['status_pengajuan']  = set_value('status_pengajuan',$d["status_pengajuan"]);
				$data['acc_kabid']  = set_value('acc_kabid',$d["acc_kabid"]);
				$data['acc_asesor']  = set_value('acc_asesor',$d["acc_asesor"]);
				$data['acc_komite']  = set_value('acc_komite',$d["acc_komite"]);
				$data['acc_direktur']  = set_value('acc_direktur',$d["acc_direktur"]);
				$data['acc_logbook_komite']  = set_value('acc_logbook_komite',$d["acc_logbook_komite"]);
				$data['id_pegawai']  = set_value('id_pegawai',$d["id_pegawai"]);
				$data['foto']  = set_value('foto',$d["foto"]);
				$data['nama_pegawai']  = set_value('nama_pegawai',$d["nama_pegawai"]);
				$data['tmp_lahir']  = set_value('tmp_lahir',$d["tmp_lahir"]);
				$data['tgl_lahir']  = set_value('tgl_lahir',$d["tgl_lahir"]);
				$data['nama_agama']  = set_value('nama_agama',$d["nama_agama"]);
				$data['nama_status_kawin']  = set_value('nama_status_kawin',$d["nama_status_kawin"]);
				$data['no_profesi']  = set_value('no_profesi',$d["no_profesi"]);
				$data['nip']  = set_value('nip',$d["nip"]);
				$data['nama_status_diusulkan'] = $d['nama_status_diusulkan'];
				$data['nama_pendidikan'] = $d['nama_pendidikan'];
				$data['no_hp'] = $d['no_hp'];
				$data['email'] = $d['email'];
				$data['nama_status_pegawai'] = $d['nama_status_pegawai'];
				$data['nama_ruangan'] = $d['nama_ruangan'];
				$data['nama_jabatan_fungsional'] = $d['nama_jabatan_fungsional'];
				$data['alamat'] = $d['alamat'];
				$data['ambil_data_etik_pegawai_oppe'] = $this->m_rancak->ambil_data_etik_pegawai_oppe($d['id_pegawai'],date('Y'));
				$this->tampil_top($data);
		}
    if($mode=='bcp'){
			if($data['id'] == NULL OR empty($data['id'])){
				$data['id'] = "0";
			}
			if($data['all'] == NULL OR empty($data['all'])){
				$data['all'] = "0";
			}
      $data['page'] =  $data['page']."_bcp";
      $data['cmd_pegawai'] = $this->m_rancak->cmd_pegawai_null_analisa();
      $data['cmd_sekarepe_dewe'] = $this->m_rancak->cmd_analisa();
      $this->tampil_top($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
	      $id   = $this->input->post("id");
	      $all   = $this->input->post("all");
	      $first_date   = $this->input->post("first_date");
	      $last_date   = $this->input->post("last_date");
				redirect(base_url('analisa/pengajuan_kompetensi/bcp/'.$id.'/'.$all.'/'.$first_date.'/'.$last_date));
			}
		}
		if($mode=='pdf'){
		  $report = $this->load->view('cetak/penugasan_klinis', $data, TRUE);
		  $apk	=$this->m_rancak->ambil_pengajuan_kompetensi($data['id']);
		  $filename = "Penugasan_klinis-".$apk['nama_pegawai'].".pdf";
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
		  $mpdf->AddPage('P', '', '', '', 2, 25, 5, 5, 10, 3, 3);
		  $mpdf->SetDisplayMode('fullpage');
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->defaultheaderline = 0;
	      $mpdf->defaultfooterline = 0;
		  $mpdf->shrink_tables_to_fit = 1;
		  $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
		  for ($i = 1; $i > 2; $i++) {
			$mpdf->SetHTMLFooter('');
		  }
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
  }
}
	function multi_akses($mode='view')
  {
	$data['page']  = "multi_akses";
	$data['header'] = "DATA MULTI AKSES PEGAWAI";
	$data['title'] = "DATA MULTI AKSES PEGAWAI";
	$data['link_kembali'] = base_url('analisa');
	$data['link_awal'] = base_url('analisa');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$program    = $this->m_umum->ambil_data('a_program','id_program',$pegawai["id_program"]);
	$data['program_jabatan'] = $program["jabatan"];
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
	$data['id'] = $this->uri->segment(4, 0);
  if($mode=='view'){
	if($data['id'] == NULL OR empty($data['id'])){
		$data['id'] = "";
	}
		$this->tampil_top($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
      $id   = $this->input->post("id");
      $trim_keyword   = urldecode(trim($this->input->post("id")));
			$replace_keyword   = preg_replace('/\s+/', ' ', $trim_keyword);
			$key = str_replace(' ', '-', $replace_keyword);
			redirect(base_url('analisa/multi_akses/view/'.$key));
		}
	}
  else if($mode=='data'){
		echo json_encode($this->m_analisa->multi_akses_all($data['id']));
	}
}
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("analisa/header",$data);
	$this->load->view("analisa/isi");
	$this->load->view("footer");
	$this->load->view("analisa/jsload");
	$this->load->view("analisa/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_top",$data);
	$this->load->view("analisa/isi");
	$this->load->view("footer");
	$this->load->view("analisa/jsload");
	$this->load->view("analisa/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
