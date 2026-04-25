<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Kepegawaian extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
		  $this->login_kah();
          $this->load->model('m_kepegawaian');
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
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==15 ) // keperawatan
          return TRUE;
          elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==3 ) // kepegawaian
              return TRUE;
     else
          redirect(base_url('logout'));
  }
  function index(){
    $data['page']="home";
	$data['header'] = "BERANDA";
	$data['title'] = "BERANDA";
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
    $this->tampil($data);
  }
  function pendidikan($mode='view')
  {
	$data['page']  = "pendidikan";
	$data['header'] = "PENDIDIKAN";
	$data['title'] = "PENDIDIKAN";
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
	//======================= IMPORTANT ======================================
    if($mode=='view'){
	$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_kepegawaian->pendidikan_all());
	}
	else{
		$data['cmd_status']=$this->m_rancak->cmd_status();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		$data['nama_pendidikan']  = set_value('nama_pendidikan',$this->input->post('nama_pendidikan'));
		$data['status_pendidikan']  = set_value('status_pendidikan',$this->input->post('status_pendidikan'));
		$this->load->view("kepegawaian/isi",$data);
      }
      if($mode=='simpan_tambah'){
		  if($this->m_kepegawaian->simpan_pendidikan()){
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
			redirect(base_url('kepegawaian/pendidikan'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
			redirect(base_url('kepegawaian/pendidikan'));
		  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
		$keuangan    = $this->m_umum->ambil_data('kol_pendidikan','id_pendidikan',$data['id']);
		$data['nama_pendidikan']  = set_value('nama_pendidikan',$keuangan["nama_pendidikan"]);
		$data['status_pendidikan']  = set_value('status_pendidikan',$keuangan["status_pendidikan"]);
		$this->load->view("kepegawaian/isi",$data);
      }
      if($mode=='simpan_edit'){
		  if($this->m_kepegawaian->edit_pendidikan()){
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
			redirect(base_url('kepegawaian/pendidikan'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
			redirect(base_url('kepegawaian/pendidikan'));
		  }
      }
	}
  }
  function kategori_berkas($mode='view')
  {
	$data['page']  = "kategori_berkas";
	$data['header'] = "KATEGORI BERKAS";
	$data['title'] = "KATEGORI BERKAS";
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
	$data['ruangan_id'] = $pegawai["id_ruangan"];
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
	//======================= IMPORTANT ======================================
    if($mode=='view'){
	$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_kepegawaian->kategori_berkas_all());
	}
  else if($mode=='hapus'){
  $kondisi=array('id_kategori_berkas'=>$data['id']);
  $jml = $this->m_umum->jumlah_record_filter('berkas',$kondisi);
  if($jml == 0){
    $di = $this->m_umum->ambil_data('kol_kategori_berkas','id_kategori_berkas',$data['id']);
    $kunci = $di['kunci'];
    $unit_berkas = $di['unit'];
    if($unit_berkas !== 255 AND $kunci==25 AND $unit_berkas==$data['ruangan_id']){
      if($this->m_umum->hapus_data('kol_kategori_berkas','id_kategori_berkas',$data['id'])){
      $this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
      redirect(base_url('kepegawaian/kategori_berkas'));
      }else{
      $this->session->set_flashdata('danger', 'Masalah Hapus Data');
      redirect(base_url('kepegawaian/kategori_berkas'));
      }
    }else{
      $this->session->set_flashdata('danger', 'Beda Permission');
      redirect(base_url('kepegawaian/kategori_berkas'));
    }
  }else{
      $this->session->set_flashdata('danger', 'Data Sudah Masuk Alur');
      redirect(base_url('kepegawaian/kategori_berkas'));
  }
  }
	else{
		$data['cmd_status']=$this->m_rancak->cmd_status();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		$data['nama_kategori_berkas']  = set_value('nama_kategori_berkas',$this->input->post('nama_kategori_berkas'));
		$data['status_kategori_berkas']  = set_value('status_kategori_berkas',$this->input->post('status_kategori_berkas'));
		$this->load->view("kepegawaian/isi",$data);
      }
      if($mode=='simpan_tambah'){
		  if($this->m_kepegawaian->simpan_kategori_berkas($data['ruangan_id'])){
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
			redirect(base_url('kepegawaian/kategori_berkas'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
			redirect(base_url('kepegawaian/kategori_berkas'));
		  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
		$keuangan    = $this->m_umum->ambil_data('kol_kategori_berkas','id_kategori_berkas',$data['id']);
		$data['nama_kategori_berkas']  = set_value('nama_kategori_berkas',$keuangan["nama_kategori_berkas"]);
		$data['status_kategori_berkas']  = set_value('status_kategori_berkas',$keuangan["status_kategori_berkas"]);
		$this->load->view("kepegawaian/isi",$data);
      }
      if($mode=='simpan_edit'){
		$id_kategori_berkas = $this->input->post('id_kategori_berkas');
		$di = $this->m_umum->ambil_data('kol_kategori_berkas','id_kategori_berkas',$id_kategori_berkas);
		$kunci = $di['kunci']; // kategori berkas yang boleh dihapus = 25 dan untuk penggolongan
		$unit_berkas = $di['unit'];
		if($unit_berkas !== '255' && $kunci=='25' && $unit_berkas==$data['ruangan_id']){
		  if($this->m_kepegawaian->edit_kategori_berkas()){
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
			redirect(base_url('kepegawaian/kategori_berkas'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
			redirect(base_url('kepegawaian/kategori_berkas'));
		  }
		}
		else{
				$this->session->set_flashdata('danger', 'Beda Permission');
				redirect(base_url('kepegawaian/kategori_berkas'));
			}
      }
	}
  }
  function kategori_pelatihan($mode='view')
  {
	$data['page']  = "kategori_pelatihan";
	$data['header'] = "KATEGORI PELATIHAN";
	$data['title'] = "KATEGORI PELATIHAN";
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
	$data['ruangan_id'] = $pegawai["id_ruangan"];
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
	//======================= IMPORTANT ======================================
    if($mode=='view'){
	$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_kepegawaian->kategori_pelatihan_all());
	}
	else{
		$data['cmd_status']=$this->m_rancak->cmd_status();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		$data['nama_kategori_pelatihan']  = set_value('nama_kategori_pelatihan',$this->input->post('nama_kategori_pelatihan'));
		$data['status_kategori_pelatihan']  = set_value('status_kategori_pelatihan',$this->input->post('status_kategori_pelatihan'));
		$this->load->view("kepegawaian/isi",$data);
      }
      if($mode=='simpan_tambah'){
		  if($this->m_kepegawaian->simpan_kategori_pelatihan()){
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
			redirect(base_url('kepegawaian/kategori_pelatihan'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
			redirect(base_url('kepegawaian/kategori_pelatihan'));
		  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
		$keuangan    = $this->m_umum->ambil_data('kol_kategori_pelatihan','id_kategori_pelatihan',$data['id']);
		$data['nama_kategori_pelatihan']  = set_value('nama_kategori_pelatihan',$keuangan["nama_kategori_pelatihan"]);
		$data['status_kategori_pelatihan']  = set_value('status_kategori_pelatihan',$keuangan["status_kategori_pelatihan"]);
		$this->load->view("kepegawaian/isi",$data);
      }
      if($mode=='simpan_edit'){
		$nama_kategori_pelatihan = $this->input->post('nama_kategori_pelatihan');
		$nama_kategori_pelatihan_lama = $this->input->post('nama_kategori_pelatihan_lama');
		$kondisi=array('nama_kategori_pelatihan'=>$nama_kategori_pelatihan,'nama_kategori_pelatihan !='=>$nama_kategori_pelatihan_lama);
		$jml = $this->m_umum->jumlah_record_filter('kol_kategori_pelatihan',$kondisi);
		if($jml == 0){
		  if($this->m_kepegawaian->edit_kategori_pelatihan()){
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
			redirect(base_url('kepegawaian/kategori_pelatihan'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
			redirect(base_url('kepegawaian/kategori_pelatihan'));
		  }
		}
		else{
				$this->session->set_flashdata('danger', 'Nama Sudah Ada');
				redirect(base_url('kepegawaian/kategori_pelatihan'));
			}
      }
	}
  }
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("kepegawaian/header",$data);
	$this->load->view("kepegawaian/isi");
	$this->load->view("footer");
	$this->load->view("kepegawaian/jsload");
	$this->load->view("kepegawaian/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_top",$data);
	$this->load->view("kepegawaian/isi");
	$this->load->view("footer");
	$this->load->view("kepegawaian/jsload");
	$this->load->view("kepegawaian/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
