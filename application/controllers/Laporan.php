<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Laporan extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
		  $this->login_kah();
          $this->load->model('m_akunting');
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
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==1 )
          return TRUE;
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==20 )
          return TRUE;
     else
          redirect(base_url('logout'));
  }
  function index(){
    $data['page']="home";
	$data['header'] = "LAPORAN";
	$data['title'] = "LAPORAN";
//	$data['link_kembali'] = base_url();
	$data['link_kembali'] = base_url('laporan');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
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
		'id_kategori_berkas'=>1,'id_pegawai'=>$this->session->id_pegawai);
	$data['jml_str']=$this->m_umum->jumlah_record_filter('berkas',$kondisi_str);
	$kondisi_sip=array('tgl_b_berkas >='=>$datea,'tgl_b_berkas <='=>$dateb,'status_berkas'=>1,
		'id_kategori_berkas'=>2,'id_pegawai'=>$this->session->id_pegawai);
	$data['jml_sip']=$this->m_umum->jumlah_record_filter('berkas',$kondisi_sip);
	$kondisi_sik=array('tgl_b_berkas >='=>$datea,'tgl_b_berkas <='=>$dateb,'status_berkas'=>1,
		'id_kategori_berkas'=>3,'id_pegawai'=>$this->session->id_pegawai);
	$data['jml_sik']=$this->m_umum->jumlah_record_filter('berkas',$kondisi_sik);
	//======================= IMPORTANT =========================================
//	$data['status'] = $this->m_rancak->cmd_status();
	$data['array_laporan'] = $this->m_rancak->array_laporan();
	$data['id_status']  = set_value('id_status',$this->input->post("id_status"));
    $this->tampil_top($data);
  }
 // ================================================ LAPORAN ==================================
  function jurnal($mode='view')
  {
	$data['page']  = "jurnal";
	$data['header'] = "LAPORAN JURNAL";
	$data['title'] = "LAPORAN JURNAL";
	$data['link_kembali'] = base_url('laporan');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
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
		'id_kategori_berkas'=>1,'id_pegawai'=>$this->session->id_pegawai);
	$data['jml_str']=$this->m_umum->jumlah_record_filter('berkas',$kondisi_str);
	$kondisi_sip=array('tgl_b_berkas >='=>$datea,'tgl_b_berkas <='=>$dateb,'status_berkas'=>1,
		'id_kategori_berkas'=>2,'id_pegawai'=>$this->session->id_pegawai);
	$data['jml_sip']=$this->m_umum->jumlah_record_filter('berkas',$kondisi_sip);
	$kondisi_sik=array('tgl_b_berkas >='=>$datea,'tgl_b_berkas <='=>$dateb,'status_berkas'=>1,
		'id_kategori_berkas'=>3,'id_pegawai'=>$this->session->id_pegawai);
	$data['jml_sik']=$this->m_umum->jumlah_record_filter('berkas',$kondisi_sik);
	$first_date   = $this->uri->segment(4, 0);
	$last_date   = $this->uri->segment(5, 0);
	$data['id']   = str_replace('-', ' ', $this->uri->segment(6, 0));
	$id_jenis_jurnal  = $this->uri->segment(7, 0);
	if(empty($first_date)){
		$data['first_date']   = "01-".date('m-Y');
	}else{
		$data['first_date']   = $this->uri->segment(4, 0);
	}
	if(empty($last_date)){
		$data['last_date']   = date('d-m-Y');
	}else{
		$data['last_date']   = $this->uri->segment(5, 0);
	}
	if(empty($id_jenis_jurnal)){
		$data['id_jenis_jurnal']   = '0';
	}else{
		$data['id_jenis_jurnal']   = $this->uri->segment(7, 0);
	}
	$data['cmd_jenis_jurnal']   = $this->m_akunting->cmd_jenis_jurnal();
	$data['cmd_semua_transaksi']   = $this->m_rancak->cmd_semua_transaksi();
	$data['ambil_transaksi_periode_jurnal']   = $this->m_akunting->ambil_transaksi_periode_jurnal($data['first_date'],
		$data['last_date'],$data['id'],$data['id_jenis_jurnal']);
	$data['cmd_uraian_detil']   = $this->m_akunting->cmd_uraian_detil();
    if($mode=='view'){
		$this->tampil_top($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$first_date = $this->input->post("first_date");
			$last_date = $this->input->post("last_date");
			$id = $this->input->post("id");
			$id_jenis_jurnal = $this->input->post("id_jenis_jurnal");
			$id = str_replace(' ', '-', $id);
			redirect(base_url('laporan/jurnal/view/'.$first_date.'/'.$last_date.'/'.$id.'/'.$id_jenis_jurnal));
		}
	}else if($mode=='pdf'){
	  $report = $this->load->view('cetak/jurnal', $data, TRUE);
	  $filename = $data['title'].$first_date.$last_date.".pdf";
	  $mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'P','margin_left' => '10','margin_top' => '10']);
	  $mpdf->SetTitle($data['title']);
	  $mpdf->SetAuthor($data['instance_name']);
	  //$mpdf->SetFooter('Page : {PAGENO}');
	  ini_set("pcre.backtrack_limit", "5000000");
	  $mpdf->WriteHTML($report);
	  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
	}else if($mode=='xls'){
          header("Content-Type: application/vnd.ms-excel; charset=utf-8");
          header("Content-Disposition: attachment; filename=".$data['title'].$first_date.$last_date.".xls");
          header("Expires: 0");
          header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
          header("Cache-Control: private",false);
          echo $this->load->view('cetak/jurnal', $data, TRUE);
	}
  }
  function transaksi($mode='view')
  {
	$data['page']  = "transaksi";
	$data['header'] = "LAPORAN TRANSAKSI";
	$data['title'] = "LAPORAN TRANSAKSI";
	$data['link_kembali'] = base_url('laporan');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['instance_address'] = $instansi["alamat_instansi"];
	$data['instance_contact'] = $instansi["kontak_instansi"];
	$data['instance_email'] = $instansi["email_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['logo'] = $instansi["logo"];
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
		'id_kategori_berkas'=>1,'id_pegawai'=>$this->session->id_pegawai);
	$data['jml_str']=$this->m_umum->jumlah_record_filter('berkas',$kondisi_str);
	$kondisi_sip=array('tgl_b_berkas >='=>$datea,'tgl_b_berkas <='=>$dateb,'status_berkas'=>1,
		'id_kategori_berkas'=>2,'id_pegawai'=>$this->session->id_pegawai);
	$data['jml_sip']=$this->m_umum->jumlah_record_filter('berkas',$kondisi_sip);
	$kondisi_sik=array('tgl_b_berkas >='=>$datea,'tgl_b_berkas <='=>$dateb,'status_berkas'=>1,
		'id_kategori_berkas'=>3,'id_pegawai'=>$this->session->id_pegawai);
	$data['jml_sik']=$this->m_umum->jumlah_record_filter('berkas',$kondisi_sik);
	$date   = $this->uri->segment(4, 0);
	$first_date   = $this->uri->segment(5, 0);
	$last_date   = $this->uri->segment(6, 0);
	$data['dates']= array('0'=>'SEMUA DATA','1'=>'DATA PADA RANGE TANGGAL');
	if(empty($date)){
		$data['date']   = "0";
	}else{
		$data['date']   = $this->uri->segment(4, 0);
	}
	$kode_generator   = $this->m_rancak->kode_generator('5','');
	if(empty($first_date)){
		$data['first_date']   = "01-".date('m-Y');
	}else{
		$data['first_date']   = $this->uri->segment(5, 0);
	}
	if(empty($last_date)){
		$data['last_date']   = date('d-m-Y');
	}else{
		$data['last_date']   = $this->uri->segment(5, 0);
	}
    if($mode=='view'){
		$this->tampil_top($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$date = $this->input->post("date");
			$first_date = $this->input->post("first_date");
			$last_date = $this->input->post("last_date");
			redirect(base_url('laporan/transaksi/view/'.$date.'/'.$first_date.'/'.$last_date));
		}
	}
    else if($mode=='data'){
		echo json_encode($this->m_akunting->transaksi_all($date,$first_date,$last_date));
	}
	else if($mode=='pdf'){
		$detil = $this->m_umum->ambil_data('keu_transaksi_detil','id_transaksi',$date);
		$data['uraian_detil'] = $detil['uraian_detil'];
		$data['id_transaksi'] = $detil['id_transaksi'];
	  $report = $this->load->view('cetak/transaksi', $data, TRUE);
	  $filename = $data['title'].$data['uraian_detil'].$date.$kode_generator.".pdf";
	  $mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'P','margin_left' => '10','margin_top' => '10']);
	  $mpdf->SetTitle($data['title']);
	  $mpdf->SetAuthor($data['instance_name']);
	  //$mpdf->SetFooter('Page : {PAGENO}');
	  ini_set("pcre.backtrack_limit", "5000000");
	  $mpdf->WriteHTML($report);
	  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
	}else if($mode=='xls'){
		$detil = $this->m_umum->ambil_data('keu_transaksi_detil','id_transaksi',$date);
		$data['uraian_detil'] = $detil['uraian_detil'];
		$data['id_transaksi'] = $detil['id_transaksi'];
          header("Content-Type: application/vnd.ms-excel; charset=utf-8");
          header("Content-Disposition: attachment; filename=".$data['title'].$data['uraian_detil'].$date.$kode_generator.".xls");
          header("Expires: 0");
          header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
          header("Cache-Control: private",false);
          echo $this->load->view('cetak/transaksi', $data, TRUE);
	}
	else{
      if($mode=='lihat'){
        $data['page'] =  $data['page']."_lihat";
		$keuangan=$this->m_akunting->ambil_keuangan($date);
		$data['ambil_keuangan_detil'] = $this->m_akunting->ambil_keuangan_detil($date);
		$data['nama_pegawai'] = $keuangan['nama_pegawai'];
		$data['tgl_transaksi'] = $keuangan['tgl_transaksi'];
		$data['no_transaksi'] = $keuangan['no_transaksi'];
		$data['nama_jenis_jurnal'] = $keuangan['nama_jenis_jurnal'];
		$data['nama_unit'] = $keuangan['nama_unit'];
		$data['nama_dk'] = $keuangan['nama_dk'];
		$data['ket_transaksi'] = $keuangan['ket_transaksi'];
		$data['total_transaksi'] = $keuangan['total_transaksi'];
		$this->load->view("akunting/isi",$data);
      }
	}
  }
  function buku_besar($mode='view')
  {
	$data['page']  = "buku_besar";
	$data['header'] = "LAPORAN BUKU BESAR";
	$data['title'] = "LAPORAN BUKU BESAR";
	$data['link_kembali'] = base_url('laporan');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
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
		'id_kategori_berkas'=>1,'id_pegawai'=>$this->session->id_pegawai);
	$data['jml_str']=$this->m_umum->jumlah_record_filter('berkas',$kondisi_str);
	$kondisi_sip=array('tgl_b_berkas >='=>$datea,'tgl_b_berkas <='=>$dateb,'status_berkas'=>1,
		'id_kategori_berkas'=>2,'id_pegawai'=>$this->session->id_pegawai);
	$data['jml_sip']=$this->m_umum->jumlah_record_filter('berkas',$kondisi_sip);
	$kondisi_sik=array('tgl_b_berkas >='=>$datea,'tgl_b_berkas <='=>$dateb,'status_berkas'=>1,
		'id_kategori_berkas'=>3,'id_pegawai'=>$this->session->id_pegawai);
	$data['jml_sik']=$this->m_umum->jumlah_record_filter('berkas',$kondisi_sik);
	$first_date   = $this->uri->segment(4, 0);
	$last_date   = $this->uri->segment(5, 0);
	$data['id']   = $this->uri->segment(6, 0);
	$data['transaksix']  = $this->uri->segment(7, 0);
	if(empty($first_date)){
		$data['first_date']   = "01-".date('m-Y');
	}else{
		$data['first_date']   = $this->uri->segment(4, 0);
	}
	if(empty($last_date)){
		$data['last_date']   = date('d-m-Y');
	}else{
		$data['last_date']   = $this->uri->segment(5, 0);
	}
	$kode_generator   = $this->m_rancak->kode_generator('5','buku_besar');
	$data['cmd_semua_transaksi']   = $this->m_rancak->cmd_semua_transaksi();
	$data['ambil_coa_periode']   = $this->m_akunting->ambil_coa_periode($data['first_date'],$data['last_date'],$data['id'],$data['transaksix']);
	$data['cmd_opsi_keu_coa']   = $this->m_rancak->cmd_opsi_keu_coa();
    if($mode=='view'){
		$this->tampil_top($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$first_date = $this->input->post("first_date");
			$last_date = $this->input->post("last_date");
			$id = $this->input->post("id");
			$transaksix = $this->input->post("transaksix");
			redirect(base_url('laporan/buku_besar/view/'.$first_date.'/'.$last_date.'/'.$id.'/'.$transaksix));
		}
	}else if($mode=='pdf'){
	  $report = $this->load->view('cetak/buku_besar', $data, TRUE);
	  $filename = $data['title'].$first_date.$last_date.$kode_generator.".pdf";
	  $mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'P','margin_left' => '10','margin_top' => '10']);
	  $mpdf->SetTitle($data['title']);
	  $mpdf->SetAuthor($data['instance_name']);
	  //$mpdf->SetFooter('Page : {PAGENO}');
	  ini_set("pcre.backtrack_limit", "5000000");
	  $mpdf->WriteHTML($report);
	  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
	}else if($mode=='xls'){
          header("Content-Type: application/vnd.ms-excel; charset=utf-8");
          header("Content-Disposition: attachment; filename=".$data['title'].$first_date.$last_date.$kode_generator.".xls");
          header("Expires: 0");
          header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
          header("Cache-Control: private",false);
          echo $this->load->view('cetak/buku_besar', $data, TRUE);
	}
  }
  function neraca($mode='view')
  {
	$data['page']  = "neraca";
	$data['header'] = "LAPORAN NERACA";
	$data['title'] = "LAPORAN NERACA";
	$data['link_kembali'] = base_url('laporan');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
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
		'id_kategori_berkas'=>1,'id_pegawai'=>$this->session->id_pegawai);
	$data['jml_str']=$this->m_umum->jumlah_record_filter('berkas',$kondisi_str);
	$kondisi_sip=array('tgl_b_berkas >='=>$datea,'tgl_b_berkas <='=>$dateb,'status_berkas'=>1,
		'id_kategori_berkas'=>2,'id_pegawai'=>$this->session->id_pegawai);
	$data['jml_sip']=$this->m_umum->jumlah_record_filter('berkas',$kondisi_sip);
	$kondisi_sik=array('tgl_b_berkas >='=>$datea,'tgl_b_berkas <='=>$dateb,'status_berkas'=>1,
		'id_kategori_berkas'=>3,'id_pegawai'=>$this->session->id_pegawai);
	$data['jml_sik']=$this->m_umum->jumlah_record_filter('berkas',$kondisi_sik);
	$first_date   = $this->uri->segment(4, 0);
	if(empty($first_date)){
		$data['first_date']   = date('d-m-Y');
	}else{
		$data['first_date']   = $this->uri->segment(4, 0);
	}
	$kode_generator   = $this->m_rancak->kode_generator('5','neraca');
	$data['cmd_nol']   = $this->m_rancak->cmd_nol();
	$data['ambil_aktiva']   = $this->m_akunting->ambil_aktiva();
	$data['ambil_passiva']   = $this->m_akunting->ambil_passiva();
    if($mode=='view'){
		$this->tampil_top($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$first_date = $this->input->post("first_date");
			redirect(base_url('laporan/neraca/view/'.$first_date));
		}
	}else if($mode=='pdf'){
	  $report = $this->load->view('cetak/neraca', $data, TRUE);
	  $filename = $data['title'].$first_date.$kode_generator.".pdf";
	  $mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'P','margin_left' => '10','margin_top' => '10']);
	  $mpdf->SetTitle($data['title']);
	  $mpdf->SetAuthor($data['instance_name']);
	  //$mpdf->SetFooter('Page : {PAGENO}');
	  ini_set("pcre.backtrack_limit", "5000000");
	  $mpdf->WriteHTML($report);
	  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
	}else if($mode=='xls'){
          header("Content-Type: application/vnd.ms-excel; charset=utf-8");
          header("Content-Disposition: attachment; filename=".$data['title'].$first_date.$kode_generator.".xls");
          header("Expires: 0");
          header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
          header("Cache-Control: private",false);
          echo $this->load->view('cetak/neraca', $data, TRUE);
	}
  }
  function rugi_laba($mode='view')
  {
	$data['page']  = "rugi_laba";
	$data['header'] = "LAPORAN RUGI LABA";
	$data['title'] = "LAPORAN RUGI LABA";
	$data['link_kembali'] = base_url('laporan');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
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
		'id_kategori_berkas'=>1,'id_pegawai'=>$this->session->id_pegawai);
	$data['jml_str']=$this->m_umum->jumlah_record_filter('berkas',$kondisi_str);
	$kondisi_sip=array('tgl_b_berkas >='=>$datea,'tgl_b_berkas <='=>$dateb,'status_berkas'=>1,
		'id_kategori_berkas'=>2,'id_pegawai'=>$this->session->id_pegawai);
	$data['jml_sip']=$this->m_umum->jumlah_record_filter('berkas',$kondisi_sip);
	$kondisi_sik=array('tgl_b_berkas >='=>$datea,'tgl_b_berkas <='=>$dateb,'status_berkas'=>1,
		'id_kategori_berkas'=>3,'id_pegawai'=>$this->session->id_pegawai);
	$data['jml_sik']=$this->m_umum->jumlah_record_filter('berkas',$kondisi_sik);
	$first_date   = $this->uri->segment(4, 0);
	$last_date   = $this->uri->segment(5, 0);
	if(empty($first_date)){
		$data['first_date']   = "01-".date('m-Y');
	}else{
		$data['first_date']   = $this->uri->segment(4, 0);
	}
	if(empty($last_date)){
		$data['last_date']   = date('d-m-Y');
	}else{
		$data['last_date']   = $this->uri->segment(5, 0);
	}
	$kode_generator   = $this->m_rancak->kode_generator('5','rugi_laba');
	$data['cmd_nol']   = $this->m_rancak->cmd_nol();
	$data['ambil_pendapatan']   = $this->m_akunting->ambil_pendapatan();
	$data['ambil_hpp']   = $this->m_akunting->ambil_hpp();
	$data['ambil_biaya']   = $this->m_akunting->ambil_biaya();
	$data['ambil_pendapatan_lain']   = $this->m_akunting->ambil_pendapatan_lain();
	$data['ambil_biaya_lainnya']   = $this->m_akunting->ambil_biaya_lainnya();
    if($mode=='view'){
		$this->tampil_top($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$first_date = $this->input->post("first_date");
			$last_date = $this->input->post("last_date");
			redirect(base_url('laporan/rugi_laba/view/'.$first_date.'/'.$last_date));
		}
	}else if($mode=='pdf'){
	  $report = $this->load->view('cetak/rugi_laba', $data, TRUE);
	  $filename = $data['title'].$first_date.$last_date.$kode_generator.".pdf";
	  $mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'P','margin_left' => '10','margin_top' => '10']);
	  $mpdf->SetTitle($data['title']);
	  $mpdf->SetAuthor($data['instance_name']);
	  //$mpdf->SetFooter('Page : {PAGENO}');
	  ini_set("pcre.backtrack_limit", "5000000");
	  $mpdf->WriteHTML($report);
	  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
	}else if($mode=='xls'){
          header("Content-Type: application/vnd.ms-excel; charset=utf-8");
          header("Content-Disposition: attachment; filename=".$data['title'].$first_date.$last_date.$kode_generator.".xls");
          header("Expires: 0");
          header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
          header("Cache-Control: private",false);
          echo $this->load->view('cetak/rugi_laba', $data, TRUE);
	}
  }
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("laporan/header",$data);
	$this->load->view("laporan/isi");
	$this->load->view("footer");
	$this->load->view("laporan/jsload");
	$this->load->view("laporan/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_top",$data);
	$this->load->view("laporan/isi");
	$this->load->view("footer");
	$this->load->view("laporan/jsload");
	$this->load->view("laporan/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
