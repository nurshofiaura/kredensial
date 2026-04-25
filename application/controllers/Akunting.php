<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Akunting extends CI_controller
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
  function data_coa()
  {
	$dt=$this->m_rancak->ambil_coa();
	$data = array();
	foreach($dt as $row){
		$data[] = array("id"=>$row['id_coa'], "text"=>$row['kode_coa'].' - '.$row['nama_coa']);
	}
	echo json_encode($data);
  }
  function data_coa_kas()
  {
	$dt=$this->m_rancak->ambil_coa_kas();
	$data = array();
	foreach($dt as $row){
		$data[] = array("id"=>$row['id_coa'], "text"=>$row['kode_coa'].' - '.$row['nama_coa']);
	}
	echo json_encode($data);
  }
   function data_coa_bank()
  {
	$dt=$this->m_rancak->ambil_coa_bank();
	$data = array();
	foreach($dt as $row){
		$data[] = array("id"=>$row['id_coa'], "text"=>$row['kode_coa'].' - '.$row['nama_coa']);
	}
	echo json_encode($data);
  }
  function data_coa_nokas()
  {
	$dt=$this->m_rancak->ambil_coa_nokas();
	$data = array();
	foreach($dt as $row){
		$data[] = array("id"=>$row['id_coa'], "text"=>$row['kode_coa'].' - '.$row['nama_coa']);
	}
	echo json_encode($data);
  }
  function data_coa_saldo_awal()
  {
	$dt=$this->m_rancak->ambil_coa_saldo_awal();
	$data = array();
	foreach($dt as $row){
		$data[] = array("id"=>$row['id_coa'], "text"=>$row['kode_coa'].' - '.$row['nama_coa']);
	}
	echo json_encode($data);
  }
  function data_mata_uang()  //Untuk Cascading Pulldown Wilayah
  {
	$dt=$this->m_rancak->ambil_kurs();
	$data = array();
	foreach($dt as $row){
		$data[] = array("id"=>$row['id_mata_uang'], "text"=>$row['kode_mata_uang']);
	}
	echo json_encode($data);
  }
  function data_barang()
  {
	$dt=$this->m_rancak->ambil_barang();
	$data = array();
	foreach($dt as $row){
		$data[] = array("id"=>$row['id_barang'], "text"=>$row['nama_barang']);
	}
	echo json_encode($data);
  }
  function data_satuan()
  {
	$dt=$this->m_rancak->ambil_satuan();
	$data = array();
	foreach($dt as $row){
		$data[] = array("id"=>$row['id_satuan'], "text"=>$row['nama_satuan']);
	}
	echo json_encode($data);
  }
  function index(){
    $data['page']="home";
	$data['header'] = "BERANDA";
	$data['title'] = "BERANDA";
	$data['link_kembali'] = base_url();
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
	$data['status'] = $this->m_rancak->cmd_status();
	$data['id_status']  = set_value('id_status',$this->input->post("id_status"));
    $this->tampil($data);
  }
 // ================================================ FINA ==================================
  function transaksi($mode='view')
  {
	$data['page']  = "transaksi";
	$data['header'] = "TRANSAKSI";
	$data['title'] = "TRANSAKSI";
	$data['link_kembali'] = base_url('akunting/transaksi');
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
	$date   = $this->uri->segment(4, 0);
	$first_date   = $this->uri->segment(5, 0);
	$last_date   = $this->uri->segment(6, 0);
	if(empty($date)){
		$data['date']   = "0";
	}else{
		$data['date']   = $this->uri->segment(4, 0);
	}
	if(empty($first_date)){
		$data['first_date']   = "01-".date('m-Y');
	}else{
		$data['first_date']   = $this->uri->segment(5, 0);
	}
	if(empty($last_date)){
		$data['last_date']   = date('d-m-Y');
	}else{
		$data['last_date']   = $this->uri->segment(6, 0);
	}
	$data['dates']= array('0'=>'SEMUA DATA','1'=>'DATA PADA RANGE TANGGAL');
    if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$date = $this->input->post("date");
			$first_date = $this->input->post("first_date");
			$last_date = $this->input->post("last_date");
			redirect(base_url('akunting/transaksi/view/'.$date.'/'.$first_date.'/'.$last_date));
		}
	}
    else if($mode=='data'){
		echo json_encode($this->m_akunting->transaksi_all($date,$first_date,$last_date));
	}
	else{
		$data['cmd_jenis_jurnal']=$this->m_rancak->cmd_jenis_jurnal();
		$data['cmd_unit']=$this->m_rancak->cmd_unit_null();
		$data['cmd_keu_dk']=$this->m_rancak->cmd_keu_dk();
      if($mode=='lihat'){
        $data['page'] =  $data['page']."_lihat";
		$keuangan=$this->m_akunting->ambil_keuangan($first_date);
		$data['ambil_keuangan_detil'] = $this->m_akunting->ambil_keuangan_detil($first_date);
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
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
		$keuangan    = $this->m_umum->ambil_data('keu_transaksi','id_transaksi',$first_date);
		$data['id_transaksi']  = set_value('id_transaksi',$keuangan["id_transaksi"]);
		$data['id_jenis_jurnal']  = set_value('id_jenis_jurnal',$keuangan["id_jenis_jurnal"]);
		$data['no_transaksi']  = set_value('no_transaksi',$keuangan["no_transaksi"]);
		$data['tgl_transaksi']  = set_value('tgl_transaksi',date('d-m-Y', strtotime($keuangan["tgl_transaksi"])));
		$data['id_unit']  = set_value('id_unit',$keuangan["id_unit"]);
		$data['id_dk']  = set_value('id_dk',$keuangan["id_dk"]);
		$data['ket_transaksi']  = set_value('ket_transaksi',$keuangan["ket_transaksi"]);
		$this->load->view("akunting/isi",$data);
      }
      if($mode=='simpan_edit'){
		  if($this->m_akunting->edit_transaksi()){
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
			redirect(base_url('akunting/transaksi'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
			redirect(base_url('akunting/transaksi'));
		  }
      }
	}
  }
  function jurnal($mode='view')
  {
	$data['page']  = "jurnal";
	$data['header'] = "JURNAL";
	$data['title'] = "JURNAL";
	$data['link_kembali'] = base_url('akunting/transaksi');
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
	$data['id']   = $this->uri->segment(4, 0);
    if($mode=='view'){
	$this->tampil($data);
	}
	else{
		$data['cmd_jenis_jurnal']=$this->m_rancak->cmd_jenis_jurnal();
		$data['cmd_unit']=$this->m_rancak->cmd_unit_null();
		$data['cmd_keu_dk']=$this->m_rancak->cmd_keu_dk();
		$data['cmd_mata_uang']=$this->m_rancak->cmd_mata_uang();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		$data['id_jenis_jurnal']  = set_value('id_jenis_jurnal',$this->input->post('id_jenis_jurnal'));
		$data['no_transaksi']  = set_value('no_transaksi',$this->input->post('no_transaksi'));
		$data['tgl_transaksi']  = set_value('tgl_transaksi',date('d-m-Y'));
		$data['id_unit']  = set_value('id_unit',$this->input->post('id_unit'));
		$data['id_dk']  = set_value('id_dk',$this->input->post('id_dk'));
		$data['ket_transaksi']  = set_value('ket_transaksi',$this->input->post('ket_transaksi'));
		$data['id_coa']  = set_value('id_coa',$this->input->post('id_coa'));
		$data['td_debet']  = set_value('td_debet','0');
		$data['td_kredit']  = set_value('td_kredit','0');
		$data['kurs_mata_uang']  = set_value('kurs_mata_uang','1');
		$data['id_mata_uang']  = set_value('id_mata_uang',$this->input->post('id_mata_uang'));
		$data['ket_transaksi_detil']  = set_value('ket_transaksi_detil',$this->input->post('ket_transaksi_detil'));
		$data['totaldebet']  = set_value('totaldebet',$this->input->post('totaldebet'));
		$data['totalkredit']  = set_value('totalkredit',$this->input->post('totalkredit'));
		$data['uraian_detil']  = set_value('uraian_detil','JURNAL');
		$this->form_validation->set_rules('id_jenis_jurnal','id_jenis_jurnal','required');
        if ($this->form_validation->run() === FALSE){
			$this->tampil_top($data);
        }else{
/* 			$tgl_transaksi = $this->input->post('tgl_transaksi');
			$cek_date = $this->m_rancak->cek_date($tgl_transaksi);
			if($cek_date == "1"){ */
				$totaldebet = $this->input->post('totaldebet');
				$totalkredit = $this->input->post('totalkredit');
				if($totaldebet == $totalkredit){
				  if($last_ide = $this->m_akunting->simpan_transaksi_keuangan()){
					$this->m_akunting->simpan_transaksi_detil($last_ide,'TAMBAH JURNAL');
					$this->session->set_flashdata('sukses', 'Data berhasil Di Tambah');
					redirect(base_url('akunting/transaksi'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data');
						redirect(base_url('akunting/transaksi'));
				  }
				}else{
					$this->session->set_flashdata('danger', 'Total Kredit dan Debet Tidak Sama');
					redirect(base_url('akunting/transaksi'));
				}
/* 			}else{
				$this->session->set_flashdata('danger', 'Format Tanggal Tidak Valid');
				redirect(base_url('akunting/transaksi'));
			} */
        }
      }
	}
  }
  function kas_masuk($mode='view')
  {
	$data['page']  = "kas_masuk";
	$data['header'] = "KAS MASUK";
	$data['title'] = "KAS MASUK";
	$data['link_kembali'] = base_url('akunting/transaksi');
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
	$data['id']   = $this->uri->segment(4, 0);
    if($mode=='view'){
	$this->tampil($data);
	}
	else{
		$data['cmd_jenis_jurnal']=$this->m_rancak->cmd_jenis_jurnal();
		$data['cmd_unit']=$this->m_rancak->cmd_unit_null();
		$data['cmd_keu_dk']=$this->m_rancak->cmd_keu_dk();
		$data['cmd_mata_uang']=$this->m_rancak->cmd_mata_uang();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		$data['id_jenis_jurnal']  = set_value('id_jenis_jurnal',$this->input->post('id_jenis_jurnal'));
		$data['no_transaksi']  = set_value('no_transaksi',$this->input->post('no_transaksi'));
		$data['tgl_transaksi']  = set_value('tgl_transaksi',date('d-m-Y'));
		$data['id_unit']  = set_value('id_unit',$this->input->post('id_unit'));
		$data['id_dk']  = set_value('id_dk',$this->input->post('id_dk'));
		$data['ket_transaksi']  = set_value('ket_transaksi',$this->input->post('ket_transaksi'));
		$data['id_coa']  = set_value('id_coa',$this->input->post('id_coa'));
		$data['td_debet']  = set_value('td_debet',$this->input->post('td_debet'));
		$data['td_kredit']  = set_value('td_kredit',$this->input->post('td_kredit'));
		$data['kurs_mata_uang']  = set_value('kurs_mata_uang','1');
		$data['id_mata_uang']  = set_value('id_mata_uang',$this->input->post('id_mata_uang'));
		$data['ket_transaksi_detil']  = set_value('ket_transaksi_detil',$this->input->post('ket_transaksi_detil'));
		$data['uraian_detil']  = set_value('uraian_detil','KAS MASUK');
		$this->form_validation->set_rules('id_jenis_jurnal','id_jenis_jurnal','required');
        if ($this->form_validation->run() === FALSE){
			$this->tampil_top($data);
        }else{
			  if($last_ide = $this->m_akunting->simpan_transaksi_kas()){
				$this->m_akunting->simpan_transaksi_detil($last_ide,'TAMBAH KAS MASUK');
				$this->session->set_flashdata('sukses', 'Data berhasil Di Tambah');
				redirect(base_url('akunting/transaksi'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data');
					redirect(base_url('akunting/transaksi'));
			  }
        }
      }
	}
  }
  function kas_keluar($mode='view')
  {
	$data['page']  = "kas_keluar";
	$data['header'] = "KAS KELUAR";
	$data['title'] = "KAS KELUAR";
	$data['link_kembali'] = base_url('akunting/transaksi');
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
	$data['id']   = $this->uri->segment(4, 0);
    if($mode=='view'){
	$this->tampil($data);
	}
	else{
		$data['cmd_jenis_jurnal']=$this->m_rancak->cmd_jenis_jurnal();
		$data['cmd_unit']=$this->m_rancak->cmd_unit_null();
		$data['cmd_keu_dk']=$this->m_rancak->cmd_keu_dk();
		$data['cmd_mata_uang']=$this->m_rancak->cmd_mata_uang();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		$data['id_jenis_jurnal']  = set_value('id_jenis_jurnal',$this->input->post('id_jenis_jurnal'));
		$data['no_transaksi']  = set_value('no_transaksi',$this->input->post('no_transaksi'));
		$data['tgl_transaksi']  = set_value('tgl_transaksi',date('d-m-Y'));
		$data['id_unit']  = set_value('id_unit',$this->input->post('id_unit'));
		$data['id_dk']  = set_value('id_dk',$this->input->post('id_dk'));
		$data['ket_transaksi']  = set_value('ket_transaksi',$this->input->post('ket_transaksi'));
		$data['id_coa']  = set_value('id_coa',$this->input->post('id_coa'));
		$data['td_debet']  = set_value('td_debet',$this->input->post('td_debet'));
		$data['td_kredit']  = set_value('td_kredit',$this->input->post('td_kredit'));
		$data['kurs_mata_uang']  = set_value('kurs_mata_uang','1');
		$data['id_mata_uang']  = set_value('id_mata_uang',$this->input->post('id_mata_uang'));
		$data['ket_transaksi_detil']  = set_value('ket_transaksi_detil',$this->input->post('ket_transaksi_detil'));
		$data['uraian_detil']  = set_value('uraian_detil','KAS KELUAR');
		$this->form_validation->set_rules('id_jenis_jurnal','id_jenis_jurnal','required');
        if ($this->form_validation->run() === FALSE){
			$this->tampil_top($data);
        }else{
			  if($last_ide = $this->m_akunting->simpan_transaksi_kas()){
				$this->m_akunting->simpan_transaksi_detil_keluar($last_ide,'TAMBAH KAS KELUAR');
				$this->session->set_flashdata('sukses', 'Data berhasil Di Tambah');
				redirect(base_url('akunting/transaksi'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data');
					redirect(base_url('akunting/transaksi'));
			  }
        }
      }
	}
  }
   function bank_masuk($mode='view')
  {
	$data['page']  = "bank_masuk";
	$data['header'] = "BANK MASUK";
	$data['title'] = "BANK MASUK";
	$data['link_kembali'] = base_url('akunting/transaksi');
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
	$data['id']   = $this->uri->segment(4, 0);
    if($mode=='view'){
	$this->tampil($data);
	}
	else{
		$data['cmd_jenis_jurnal']=$this->m_rancak->cmd_jenis_jurnal();
		$data['cmd_unit']=$this->m_rancak->cmd_unit_null();
		$data['cmd_keu_dk']=$this->m_rancak->cmd_keu_dk();
		$data['cmd_mata_uang']=$this->m_rancak->cmd_mata_uang();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		$data['id_jenis_jurnal']  = set_value('id_jenis_jurnal',$this->input->post('id_jenis_jurnal'));
		$data['no_transaksi']  = set_value('no_transaksi',$this->input->post('no_transaksi'));
		$data['tgl_transaksi']  = set_value('tgl_transaksi',date('d-m-Y'));
		$data['id_unit']  = set_value('id_unit',$this->input->post('id_unit'));
		$data['id_dk']  = set_value('id_dk',$this->input->post('id_dk'));
		$data['ket_transaksi']  = set_value('ket_transaksi',$this->input->post('ket_transaksi'));
		$data['id_coa']  = set_value('id_coa',$this->input->post('id_coa'));
		$data['td_debet']  = set_value('td_debet',$this->input->post('td_debet'));
		$data['td_kredit']  = set_value('td_kredit',$this->input->post('td_kredit'));
		$data['kurs_mata_uang']  = set_value('kurs_mata_uang','1');
		$data['id_mata_uang']  = set_value('id_mata_uang',$this->input->post('id_mata_uang'));
		$data['ket_transaksi_detil']  = set_value('ket_transaksi_detil',$this->input->post('ket_transaksi_detil'));
		$data['uraian_detil']  = set_value('uraian_detil','BANK MASUK');
		$this->form_validation->set_rules('id_jenis_jurnal','id_jenis_jurnal','required');
        if ($this->form_validation->run() === FALSE){
			$this->tampil_top($data);
        }else{
			  if($last_ide = $this->m_akunting->simpan_transaksi_kas()){
				$this->m_akunting->simpan_transaksi_detil($last_ide,'TAMBAH BANK MASUK');
				$this->session->set_flashdata('sukses', 'Data berhasil Di Tambah');
				redirect(base_url('akunting/transaksi'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data');
					redirect(base_url('akunting/transaksi'));
			  }
        }
      }
	}
  }
  function bank_keluar($mode='view')
  {
	$data['page']  = "bank_keluar";
	$data['header'] = "BANK KELUAR";
	$data['title'] = "BANK KELUAR";
	$data['link_kembali'] = base_url('akunting/transaksi');
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
	$data['id']   = $this->uri->segment(4, 0);
    if($mode=='view'){
	$this->tampil($data);
	}
	else{
		$data['cmd_jenis_jurnal']=$this->m_rancak->cmd_jenis_jurnal();
		$data['cmd_unit']=$this->m_rancak->cmd_unit_null();
		$data['cmd_keu_dk']=$this->m_rancak->cmd_keu_dk();
		$data['cmd_mata_uang']=$this->m_rancak->cmd_mata_uang();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		$data['id_jenis_jurnal']  = set_value('id_jenis_jurnal',$this->input->post('id_jenis_jurnal'));
		$data['no_transaksi']  = set_value('no_transaksi',$this->input->post('no_transaksi'));
		$data['tgl_transaksi']  = set_value('tgl_transaksi',date('d-m-Y'));
		$data['id_unit']  = set_value('id_unit',$this->input->post('id_unit'));
		$data['id_dk']  = set_value('id_dk',$this->input->post('id_dk'));
		$data['ket_transaksi']  = set_value('ket_transaksi',$this->input->post('ket_transaksi'));
		$data['id_coa']  = set_value('id_coa',$this->input->post('id_coa'));
		$data['td_debet']  = set_value('td_debet',$this->input->post('td_debet'));
		$data['td_kredit']  = set_value('td_kredit',$this->input->post('td_kredit'));
		$data['kurs_mata_uang']  = set_value('kurs_mata_uang','1');
		$data['id_mata_uang']  = set_value('id_mata_uang',$this->input->post('id_mata_uang'));
		$data['ket_transaksi_detil']  = set_value('ket_transaksi_detil',$this->input->post('ket_transaksi_detil'));
		$data['uraian_detil']  = set_value('uraian_detil','BANK KELUAR');
		$this->form_validation->set_rules('id_jenis_jurnal','id_jenis_jurnal','required');
        if ($this->form_validation->run() === FALSE){
			$this->tampil_top($data);
        }else{
			  if($last_ide = $this->m_akunting->simpan_transaksi_kas()){
				$this->m_akunting->simpan_transaksi_detil_keluar($last_ide,'TAMBAH BANK KELUAR');
				$this->session->set_flashdata('sukses', 'Data berhasil Di Tambah');
				redirect(base_url('akunting/transaksi'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data');
					redirect(base_url('akunting/transaksi'));
			  }
        }
      }
	}
  }
   function saldo_awal($mode='view')
  {
	$data['page']  = "saldo_awal";
	$data['header'] = "SALDO AWAL";
	$data['title'] = "SALDO AWAL";
	$data['link_kembali'] = base_url('akunting/transaksi');
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
	$data['id']   = $this->uri->segment(4, 0);
    if($mode=='view'){
	$this->tampil($data);
	}
	else{
		$data['cmd_jenis_jurnal']=$this->m_rancak->cmd_jenis_jurnal();
		$data['cmd_unit']=$this->m_rancak->cmd_unit_null();
		$data['cmd_keu_dk']=$this->m_rancak->cmd_keu_dk();
		$data['cmd_mata_uang']=$this->m_rancak->cmd_mata_uang();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		$data['id_jenis_jurnal']  = set_value('id_jenis_jurnal','0');
		$data['no_transaksi']  = set_value('no_transaksi',"");
		$data['tgl_transaksi']  = set_value('tgl_transaksi',date('d-m-Y'));
		$data['id_unit']  = set_value('id_unit',$this->input->post('id_unit'));
		$data['id_dk']  = set_value('id_dk',$this->input->post('id_dk'));
		$data['ket_transaksi']  = set_value('ket_transaksi','SALDO AWAL');
		$data['id_coa']  = set_value('id_coa',$this->input->post('id_coa'));
		$data['td_debet']  = "0";
		$data['td_kredit']  = "0";
		$data['total']  = "0";
		$data['kurs_mata_uang']  = set_value('kurs_mata_uang','1');
		$data['id_mata_uang']  = set_value('id_mata_uang',$this->input->post('id_mata_uang'));
		$data['ket_transaksi_detil']  = set_value('ket_transaksi_detil','SALDO AWAL');
		$data['uraian_detil']  = set_value('uraian_detil','SALDO AWAL');
		$this->form_validation->set_rules('id_jenis_jurnal','id_jenis_jurnal','required');
        if ($this->form_validation->run() === FALSE){
			$this->tampil($data);
        }else{
			$total = $this->input->post('total');
			if($total > 0){
			  if($last_ide = $this->m_akunting->simpan_transaksi_kas()){
				$this->m_akunting->simpan_transaksi_detil_saldo_awal($last_ide,'SALDO AWAL');
				$this->session->set_flashdata('sukses', 'Saldo Awal berhasil Di Tambah');
				redirect(base_url('akunting/transaksi'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data');
					redirect(base_url('akunting/transaksi'));
			  }
			}else{
					$this->session->set_flashdata('danger', 'Saldo Masih nol');
					redirect(base_url('akunting/transaksi'));
			}
        }
      }
	}
  }
 // ================================================ XXXX ==================================
  function order_belix($mode='view')
  {
	$data['page']  = "order_belix";
	$data['header'] = "ORDER PEMBELIAN";
	$data['title'] = "ORDER PEMBELIAN";
	$data['link_kembali'] = base_url('akunting/order_beli');
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
	$date   = $this->uri->segment(4, 0);
	$first_date   = $this->uri->segment(5, 0);
	$last_date   = $this->uri->segment(6, 0);
	if(empty($date)){
		$data['date']   = "0";
	}else{
		$data['date']   = $this->uri->segment(4, 0);
	}
	if(empty($first_date)){
		$data['first_date']   = "01-".date('m-Y');
	}else{
		$data['first_date']   = $this->uri->segment(5, 0);
	}
	if(empty($last_date)){
		$data['last_date']   = date('d-m-Y');
	}else{
		$data['last_date']   = $this->uri->segment(6, 0);
	}
	$data['dates']= array('0'=>'SEMUA DATA','1'=>'DATA PADA RANGE TANGGAL');
    if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$date = $this->input->post("date");
			$first_date = $this->input->post("first_date");
			$last_date = $this->input->post("last_date");
			redirect(base_url('akunting/transaksi/view/'.$date.'/'.$first_date.'/'.$last_date));
		}
	}
    else if($mode=='data'){
		echo json_encode($this->m_akunting->order_beli_all($date,$first_date,$last_date,'All'));
	}
	else{
		$data['cmd_unit']=$this->m_rancak->cmd_unit_null();
		$data['cmd_keu_dk']=$this->m_rancak->cmd_keu_dk();
		$data['cmd_termin']=$this->m_rancak->cmd_termin();
		$data['cmd_pajak']=$this->m_rancak->cmd_pajak();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		$data['tgl_order_beli']  = set_value('tgl_order_beli',date('d-m-Y'));
		$data['no_order_beli']  = set_value('no_order_beli',$this->input->post("no_order_beli"));
		$data['id_unit']  = set_value('id_unit',$this->input->post("id_unit"));
		$data['id_dk']  = set_value('id_dk',$this->input->post("id_dk"));
		$data['ket_order_beli']  = set_value('ket_order_beli',$this->input->post("ket_order_beli"));
		$data['kontak']  = set_value('kontak',$this->input->post("kontak"));
		$data['alamat']  = set_value('alamat',$this->input->post("alamat"));
		$data['id_termin']  = set_value('id_termin',$this->input->post("id_termin"));
		$data['pajak']  = set_value('pajak',$this->input->post("pajak"));
		$data['alias_ob_detil']  = set_value('alias_ob_detil',$this->input->post("alias_ob_detil"));
		$data['merk_ob_detil']  = set_value('merk_ob_detil',$this->input->post("merk_ob_detil"));
		$data['ket_ob_detil']  = set_value('ket_ob_detil',$this->input->post("ket_ob_detil"));
		$data['diskon_order_beli']  = set_value('diskon_order_beli','0');
		$data['persen_order_beli']  = set_value('persen_order_beli','0');
		$data['subtotal_order_beli']  = set_value('subtotal_order_beli','0');
		$data['ppn_order_beli']  = set_value('ppn_order_beli','0');
		$data['total_order_beli']  = set_value('total_order_beli','0');
		$data['jml_ob_detil']  = set_value('jml_ob_detil','0');
		$data['harga_ob_detil']  = set_value('harga_ob_detil','0');
		$data['diskon_ob_detil']  = set_value('diskon_ob_detil','0');
		$data['persen_ob_detil']  = set_value('persen_ob_detil','0');
		$data['total_ob_detil']  = set_value('total_ob_detil','0');
		$this->form_validation->set_rules('no_order_beli','no_order_beli','required');
        if ($this->form_validation->run() === FALSE){
			$this->tampil_top($data);
        }else{

        }
      }
	}
  }
 // ================================================ ORDER BELI ==================================
  function order_beli($mode='view')
  {
	$data['page']  = "order_beli";
	$data['header'] = "ORDER PEMBELIAN";
	$data['title'] = "ORDER PEMBELIAN";
	$data['link_kembali'] = base_url('akunting/order_beli');
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
	$kode_generator   = $this->m_rancak->kode_generator('5','');
	if(empty($date)){
		$data['date']   = "0";
	}else{
		$data['date']   = $this->uri->segment(4, 0);
	}
	if(empty($first_date)){
		$data['first_date']   = "01-".date('m-Y');
	}else{
		$data['first_date']   = $this->uri->segment(5, 0);
	}
	if(empty($last_date)){
		$data['last_date']   = date('d-m-Y');
	}else{
		$data['last_date']   = $this->uri->segment(6, 0);
	}
	$data['dates']= array('0'=>'SEMUA DATA','1'=>'DATA PADA RANGE TANGGAL');
    if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$date = $this->input->post("date");
			$first_date = $this->input->post("first_date");
			$last_date = $this->input->post("last_date");
			redirect(base_url('akunting/transaksi/view/'.$date.'/'.$first_date.'/'.$last_date));
		}
	}
    else if($mode=='data'){
		echo json_encode($this->m_akunting->order_beli_all($date,$first_date,$last_date,'All'));
	}
    else if($mode=='hapus'){
	  if($this->m_umum->hapus_data('temp_ob_detil','id_temp_ob_detil',$date)){
		$this->session->set_flashdata('sukses', 'Data berhasil Di Hapus');
		redirect(base_url('akunting/order_beli/tambah'));
	  }else{
		$this->session->set_flashdata('danger', 'Ada Masalah Hapus Data');
		redirect(base_url('akunting/order_beli/tambah'));
	  }
    }
    else if($mode=='hapus_ob_detil'){
		$obd = $this->m_umum->ambil_data('keu_ob_detil','id_ob_detil',$date);
		if($obd['status_ob_detil'] > 0){
			$this->session->set_flashdata('danger', 'Tidak Bisa Hapus Data Yang Sudah Diproses');
			redirect(base_url('akunting/order_beli/edit/'.$date));
		}else{
			$this->m_akunting->simpan_hapus_keu_log_ob($date,'Hapus Order Beli Detil via order_beli_edit');
			$this->m_umum->hapus_data('keu_ob_detil','id_ob_detil',$date);
			$this->session->set_flashdata('sukses', 'Data berhasil Di Hapus');
			redirect(base_url('akunting/order_beli/edit/'.$first_date));
		}
    }
	else if($mode=='pdf'){
		$detil = $this->m_umum->ambil_data('keu_order_beli','id_order_beli',$date);
		$data['tgl_order_beli'] = $detil['tgl_order_beli'];
		$data['id_order_beli'] = $detil['id_order_beli'];
		$report = $this->load->view('cetak/order_pembelian', $data, TRUE);
		$filename = $data['id_order_beli'].$data['tgl_order_beli'].$kode_generator.".pdf";
		$mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'P','margin_left' => '10','margin_top' => '10']);
		$mpdf->SetTitle($data['title']);
		$mpdf->SetAuthor($data['instance_name']);
		//$mpdf->SetFooter('Page : {PAGENO}');
		ini_set("pcre.backtrack_limit", "5000000");
		$mpdf->WriteHTML($report);
		$mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
	}else if($mode=='xls'){
		$detil = $this->m_umum->ambil_data('keu_order_beli','id_order_beli',$date);
		$data['tgl_order_beli'] = $detil['tgl_order_beli'];
		$data['id_order_beli'] = $detil['id_order_beli'];
		header("Content-Type: application/vnd.ms-excel; charset=utf-8");
		header("Content-Disposition: attachment; filename=".$data['id_order_beli'].$data['tgl_order_beli'].$kode_generator.".xls");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: private",false);
		echo $this->load->view('cetak/order_pembelian', $data, TRUE);
	}
	else{
		$data['cmd_unit']=$this->m_rancak->cmd_unit_null();
		$data['cmd_keu_dk']=$this->m_rancak->cmd_keu_dk();
		$data['cmd_termin']=$this->m_rancak->cmd_termin();
		$data['cmd_pajak']=$this->m_rancak->cmd_pajak();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		$data['ambil_temp_ob_detil']=$this->m_akunting->ambil_temp_ob_detil();
		$kondisi=array('id_user'=>$this->session->id_user,'temp !='=>$this->session->temp);
		$kondisi2=array('id_user'=>$this->session->id_user,'temp='=>$this->session->temp);
		$this->m_umum->hapus_data_kondisi('temp_ob_detil',$kondisi);
		$jml = $this->m_umum->jumlah_record_filter('temp_ob_detil',$kondisi2);
		if($jml == 0){
			$data['tgl_order_beli']  = set_value('tgl_order_beli',date('d-m-Y'));
			$data['no_order_beli']  = set_value('no_order_beli',$this->input->post("no_order_beli"));
			$data['id_unit']  = set_value('id_unit',$this->input->post("id_unit"));
			$data['id_dk']  = set_value('id_dk',$this->input->post("id_dk"));
			$data['ket_order_beli']  = set_value('ket_order_beli',$this->input->post("ket_order_beli"));
			$data['kontak']  = set_value('kontak',$this->input->post("kontak"));
			$data['alamat']  = set_value('alamat',$this->input->post("alamat"));
			$data['id_termin']  = set_value('id_termin',$this->input->post("id_termin"));
			$data['pajak']  = set_value('pajak',$this->input->post("pajak"));
		}else{
			$ob = $this->m_umum->ambil_data_kondisi('temp_ob_detil',$kondisi2);
			$data['tgl_order_beli'] = date('d-m-Y', strtotime($ob["tgl_order_beli"]));
			$data['no_order_beli'] = $ob["no_order_beli"];
			$data['id_unit'] = $ob["id_unit"];
			$data['id_dk'] = $ob["id_dk"];
			$data['ket_order_beli'] = $ob["ket_order_beli"];
			$data['kontak'] = $ob["kontak"];
			$data['alamat'] = $ob["alamat"];
			$data['id_termin'] = $ob["id_termin"];
			$data['pajak'] = $ob["pajak"];
		}
			$data['merk_ob_detil']  = set_value('merk_ob_detil',$this->input->post("merk_ob_detil"));
			$data['ket_ob_detil']  = set_value('ket_ob_detil',$this->input->post("ket_ob_detil"));
			$data['diskon_order_beli']  = set_value('diskon_order_beli','0');
			$data['persen_order_beli']  = set_value('persen_order_beli','0');
			$data['subtotal_order_beli']  = set_value('subtotal_order_beli','0');
			$data['ppn_order_beli']  = set_value('ppn_order_beli','0');
			$data['total_order_beli']  = set_value('total_order_beli','0');
			$data['jml_ob_detil']  = set_value('jml_ob_detil','0');
			$data['konversi']  = set_value('konversi','0');
			$data['harga_ob_detil']  = set_value('harga_ob_detil','0');
			$data['diskon_ob_detil']  = set_value('diskon_ob_detil','0');
			$data['persen_ob_detil']  = set_value('persen_ob_detil','0');
			$data['total_ob_detil']  = set_value('total_ob_detil','0');
		$this->form_validation->set_rules('no_order_beli','no_order_beli','required');
        if ($this->form_validation->run() === FALSE){
			$this->tampil_top($data);
        }else{
			$action = $this->input->post('action');
			if($action == 'BtnTambah') {
			$id_barang = $this->input->post("id_barang");
			$satuan_besar = $this->input->post("satuan_besar");
			$satuan_kecil = $this->input->post("satuan_kecil");
			$jml_ob_detil = $this->input->post("jml_ob_detil");
			$harga_ob_detil = $this->input->post("harga_ob_detil");
			if(empty($id_barang) || empty($satuan_besar) || empty($satuan_kecil) || $jml_ob_detil == 0 ||  $harga_ob_detil == 0){
				$this->session->set_flashdata('danger', 'Mohon Lengkapi Data Barang, Satuan, Qty dan Harga');
				redirect(base_url('akunting/order_beli/tambah'));
			}else{
			  if($this->m_akunting->simpan_tmp_order_beli()){
				$this->session->set_flashdata('sukses', 'Barang berhasil Di Tambah');
				redirect(base_url('akunting/order_beli/tambah'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data');
					redirect(base_url('akunting/order_beli/tambah'));
			  }
			}
			}
			if($action == 'BtnSave') {
			  if($last_ide = $this->m_akunting->simpan_keu_order_beli()){
				$this->m_akunting->simpan_ob_detil($last_ide);
				$this->m_akunting->simpan_keu_log_ob($last_ide,'TAMBAH ORDER PEMBELIAN VIA order_beli');
				$kondisi=array('id_user'=>$this->session->id_user,'temp='=>$this->session->temp);
				$this->m_umum->hapus_data_kondisi('temp_ob_detil',$kondisi);
				$this->session->set_flashdata('sukses', 'Barang berhasil Di Simpan');
				redirect(base_url('akunting/order_beli'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data');
					redirect(base_url('akunting/order_beli/tambah'));
			  }
			}
        }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
		$data['ambil_keu_ob_detil']=$this->m_akunting->ambil_keu_ob_detil($date);
		$kondisi=array('id_order_beli'=>$date);
		$jml = $this->m_umum->jumlah_record_filter('keu_order_beli',$kondisi);
		if(empty($date) || $jml == 0){
			$this->session->set_flashdata('danger', 'Data Tidak Ada');
			redirect(base_url('akunting/order_beli'));
		}
		$ob = $this->m_umum->ambil_data('keu_order_beli','id_order_beli',$date);
		$data['id_order_beli'] = $ob["id_order_beli"];
		$data['status_order_beli'] = $ob["status_order_beli"];
		$data['no_order_beli'] = $ob["no_order_beli"];
		$data['tgl_order_beli'] = date('d-m-Y', strtotime($ob["tgl_order_beli"]));
		$data['id_unit'] = $ob["id_unit"];
		$data['id_dk'] = $ob["id_dk"];
		$data['ket_order_beli'] = $ob["ket_order_beli"];
		$data['kontak'] = $ob["kontak"];
		$data['alamat'] = $ob["alamat"];
		$data['id_termin'] = $ob["id_termin"];
		$data['pajak'] = $ob["pajak"];
		$data['merk_ob_detil']  = set_value('merk_ob_detil',$this->input->post("merk_ob_detil"));
		$data['ket_ob_detil']  = set_value('ket_ob_detil',$this->input->post("ket_ob_detil"));
		$data['diskon_order_beli']  = set_value('diskon_order_beli','0');
		$data['persen_order_beli']  = set_value('persen_order_beli','0');
		$data['subtotal_order_beli']  = set_value('subtotal_order_beli','0');
		$data['ppn_order_beli']  = set_value('ppn_order_beli','0');
		$data['total_order_beli']  = set_value('total_order_beli','0');
		$data['jml_ob_detil']  = set_value('jml_ob_detil','0');
		$data['konversi']  = set_value('konversi','0');
		$data['harga_ob_detil']  = set_value('harga_ob_detil','0');
		$data['diskon_ob_detil']  = set_value('diskon_ob_detil','0');
		$data['persen_ob_detil']  = set_value('persen_ob_detil','0');
		$data['total_ob_detil']  = set_value('total_ob_detil','0');
		$this->form_validation->set_rules('no_order_beli','no_order_beli','required');
        if ($this->form_validation->run() === FALSE){
			$this->tampil_top($data);
        }else{
			$action = $this->input->post('action');
			if($action == 'BtnTambah') {
			$id_barang = $this->input->post("id_barang");
			$satuan_besar = $this->input->post("satuan_besar");
			$satuan_kecil = $this->input->post("satuan_kecil");
			$jml_ob_detil = $this->input->post("jml_ob_detil");
			$harga_ob_detil = $this->input->post("harga_ob_detil");
			if(empty($id_barang) || empty($satuan_besar) || empty($satuan_kecil) || $jml_ob_detil == 0 ||  $harga_ob_detil == 0){
				$this->session->set_flashdata('danger', 'Mohon Lengkapi Data Barang, Satuan, Qty dan Harga');
				redirect(base_url('akunting/order_beli/edit/'.$date));
			}else{
				$status_order_beli = $this->input->post("status_order_beli");
				$id_order_beli = $this->input->post("id_order_beli");
			  if($status_order_beli == '0'){
				$this->m_akunting->simpan_keu_ob_detil();
				$this->m_akunting->simpan_tambah_keu_log_ob($id_order_beli,'Tambah OB Detil Via order_beli_edit');
				$this->session->set_flashdata('sukses', 'Barang berhasil Di Tambah');
				redirect(base_url('akunting/order_beli/edit/'.$date));
			  }else{
				$this->session->set_flashdata('danger', 'Data Sudah Tidak Dapat Di Tambah');
				redirect(base_url('akunting/order_beli/edit/'.$date));
			  }
			}
			}
			if($action == 'BtnSave') {
				$status_order_beli = $this->input->post("status_order_beli");
				if($status_order_beli == '0'){
				  if($this->m_akunting->edit_keu_order_beli()){
					$id_order_beli = $this->input->post("id_order_beli");
					$this->m_akunting->simpan_keu_log_ob2($id_order_beli,'Edit Order Pembelian Via order_beli_edit');
					$kondisi=array('id_user'=>$this->session->id_user,'temp='=>$this->session->temp);
					$this->m_umum->hapus_data_kondisi('temp_ob_detil',$kondisi);
					$this->session->set_flashdata('sukses', 'Barang berhasil Di Simpan');
					redirect(base_url('akunting/order_beli'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data');
						redirect(base_url('akunting/order_beli/edit/'.$date));
				  }
			  }else{
				$this->session->set_flashdata('danger', 'Data Sudah Tidak Dapat Disimpan');
				redirect(base_url('akunting/order_beli/edit/'.$date));
			  }
			}
        }
      }
	}
  }
  // ================================================ PROSES ORDER BELI ==================================
  function proses_order_beli($mode='view')
  {
	$data['page']  = "proses_order_beli";
	$data['header'] = "PROSES ORDER PEMBELIAN";
	$data['title'] = "PROSES ORDER PEMBELIAN";
	$data['link_kembali'] = base_url('akunting/proses_order_beli');
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
	$kode_generator   = $this->m_rancak->kode_generator('5','');
	if(empty($date)){
		$data['date']   = "0";
	}else{
		$data['date']   = $this->uri->segment(4, 0);
	}
	if(empty($first_date)){
		$data['first_date']   = "01-".date('m-Y');
	}else{
		$data['first_date']   = $this->uri->segment(5, 0);
	}
	if(empty($last_date)){
		$data['last_date']   = date('d-m-Y');
	}else{
		$data['last_date']   = $this->uri->segment(6, 0);
	}
	$data['dates']= array('0'=>'SEMUA DATA','1'=>'DATA PADA RANGE TANGGAL');
    if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$date = $this->input->post("date");
			$first_date = $this->input->post("first_date");
			$last_date = $this->input->post("last_date");
			redirect(base_url('akunting/transaksi/view/'.$date.'/'.$first_date.'/'.$last_date));
		}
	}
    else if($mode=='data'){
		echo json_encode($this->m_akunting->order_beli_all($date,$first_date,$last_date,'0'));
	}
    else if($mode=='deal'){
		$obd = $this->m_umum->ambil_data('keu_order_beli','id_order_beli',$first_date);
		if($obd['status_order_beli'] > 0){
			$this->session->set_flashdata('danger', 'Tidak Bisa Konfirm Data Yang Sudah Diproses');
			redirect(base_url('akunting/proses_order_beli/proses/'.$first_date));
		}else{
			$this->m_akunting->deal_ob_detil($date,$last_date);
			$this->session->set_flashdata('sukses', 'Data berhasil Di Proses');
			redirect(base_url('akunting/proses_order_beli/proses/'.$first_date));
		}
    }
	else{
      if($mode=='proses'){
        $data['page'] =  $data['page']."_proses";
		$data['ambil_keu_ob_detil']=$this->m_akunting->ambil_keu_ob_detil($date);
		$kondisi=array('id_order_beli'=>$date);
		$jml = $this->m_umum->jumlah_record_filter('keu_order_beli',$kondisi);
		if(empty($date) || $jml == 0){
			$this->session->set_flashdata('danger', 'Data Tidak Ada');
			redirect(base_url('akunting/order_beli'));
		}
		$ob = $this->m_umum->ambil_data('keu_order_beli','id_order_beli',$date);
		$data['id_order_beli'] = $ob["id_order_beli"];
		$data['status_order_beli'] = $ob["status_order_beli"];
		$data['no_order_beli'] = $ob["no_order_beli"];
		$data['tgl_order_beli'] = date('d-m-Y', strtotime($ob["tgl_order_beli"]));
		$unit = $this->m_umum->ambil_data('unit','id_unit',$ob["id_unit"]);
		$data['nama_unit'] = $unit["nama_unit"];
		$data['id_dk'] = $ob["id_dk"];
		$dk = $this->m_umum->ambil_data('keu_dk','id_dk',$ob["id_dk"]);
		$data['nama_dk'] = $dk["nama_dk"];
		$data['ket_order_beli'] = $ob["ket_order_beli"];
		$data['kontak'] = $ob["kontak"];
		$data['alamat'] = $ob["alamat"];
		$termin = $this->m_umum->ambil_data('kol_termin','id_termin',$ob["id_termin"]);
		if($termin["id_termin"] == 0){
			$data['nama_termin'] = 'Tunai';
		}else{
			$data['nama_termin'] = $termin["nama_termin"];
		}
		if($ob["pajak"] == 0){
			$data['pajak'] = 'Tanpa Pajak';
		}elseif($ob["pajak"] == 1){
			$data['pajak'] = 'Sudah Termasuk Pajak';
		}else{
			$data['pajak'] = 'Belum Termasuk Pajak';
		}
		$data['subtotal_order_beli'] = $ob["subtotal_order_beli"];
		$data['diskon_order_beli'] = $ob["diskon_order_beli"];
		$data['persen_order_beli'] = $ob["persen_order_beli"];
		$data['ppn_order_beli'] = $ob["ppn_order_beli"];
		$data['total_order_beli'] = $ob["total_order_beli"];
		$this->form_validation->set_rules('id_order_beli','id_order_beli','required');
        if ($this->form_validation->run() === FALSE){
			$this->tampil_top($data);
        }else{
			$id_order_beli = $this->input->post("id_order_beli");
			$status_order_beli = $this->input->post("status_order_beli");
			if($status_order_beli == '0'){
				$kondisi=array('id_order_beli'=>$id_order_beli,'status_ob_detil'=>'0');
				$jml = $this->m_umum->jumlah_record_filter('keu_ob_detil',$kondisi);
				if($jml == 0){
					$this->m_akunting->deal_order_beli($id_order_beli);
					$this->session->set_flashdata('sukses', 'Barang berhasil Di Proses');
					redirect(base_url('akunting/proses_order_beli'));
				}else{
					$this->session->set_flashdata('danger', 'Mohon Konfirmasi Semua Data');
					redirect(base_url('akunting/proses_order_beli/proses/'.$id_order_beli));
				}
		  }else{
					$this->session->set_flashdata('danger', 'Tidak Bisa Konfirm Data Yang Sudah Diproses');
					redirect(base_url('akunting/proses_order_beli/proses/'.$id_order_beli));
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
	$this->load->view("akunting/header",$data);
	$this->load->view("akunting/isi");
	$this->load->view("footer");
	$this->load->view("akunting/jsload");
	$this->load->view("akunting/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_top",$data);
	$this->load->view("akunting/isi");
	$this->load->view("footer");
	$this->load->view("akunting/jsload");
	$this->load->view("akunting/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
