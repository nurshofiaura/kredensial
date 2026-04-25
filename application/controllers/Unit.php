<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Unit extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
		  $this->login_kah();
          $this->load->model('m_administrator');
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
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==3 )
          return TRUE;
     else
          redirect(base_url('logout'));
  }
  function index(){
    $this->unit();
  }
  function unit($mode='view')
  {
	$data['page']  = "unit";
	$data['header'] = "UNIT";
	$data['title'] = "UNIT";
	$data['link_kembali'] = base_url();
	$data['link_awal'] = base_url('unit');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','1');
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
		$this->tampil_top($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_administrator->unit_all());
	}
/*     else if($mode=='hapus'){
		$kondisi=array('id_kategori_sub'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('produk',$kondisi);
			if($jml == 0){
			  if($this->m_umum->hapus_data('kategori_sub','id_kategori_sub',$data['id'])){
				$this->session->set_flashdata('sukses', 'Data berhasil Di Hapus');
				redirect(base_url('administrator/sub_kategori'));
			  }else{
				$this->session->set_flashdata('danger', 'Ada Masalah Hapus Data');
				redirect(base_url('administrator/sub_kategori'));
			  }
			}else{
				$this->session->set_flashdata('danger', 'Nama Sudah Di pakai di Produk');
				redirect(base_url('administrator/sub_kategori'));
			}
    } */
  else{
 		$data['cmd_struktur_jabatan']=$this->m_rancak->cmd_struktur_jabatan();
		$data['status']=$this->m_rancak->cmd_status();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		$data['nama_unit']  = set_value('nama_unit',$this->input->post("nama_unit"));
		$data['id_struktur_jabatan']  = set_value('id_struktur_jabatan',$this->input->post("id_struktur_jabatan"));
		$data['status_unit']  = set_value('status_unit',$this->input->post("status_unit"));
		$this->load->view("administrator/isi",$data);
      }
      if($mode=='simpan_tambah'){
		  if($this->m_administrator->simpan_unit()){
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
			redirect(base_url('unit/unit'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
			redirect(base_url('unit/unit'));
		  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
		$keuangan    = $this->m_umum->ambil_data('unit','id_unit',$data['id']);
		$data['nama_unit']  = set_value('nama_unit',$keuangan["nama_unit"]);
		$data['id_struktur_jabatan']  = set_value('id_struktur_jabatan',$keuangan["id_struktur_jabatan"]);
		$data['status_unit']  = set_value('status_unit',$keuangan["status_unit"]);
		$this->load->view("administrator/isi",$data);
      }
      if($mode=='simpan_edit'){
		  if($this->m_administrator->edit_unit()){
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
			redirect(base_url('unit/unit'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
			redirect(base_url('unit/unit'));
		  }
      }
	}
  }
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("administrator/header",$data);
	$this->load->view("administrator/isi");
	$this->load->view("footer");
	$this->load->view("administrator/jsload");
	$this->load->view("administrator/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_top",$data);
	$this->load->view("administrator/isi");
	$this->load->view("footer");
	$this->load->view("administrator/jsload");
	$this->load->view("administrator/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
