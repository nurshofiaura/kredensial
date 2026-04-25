<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Ol_surat extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
		  $this->login_kah();
          $this->load->model('m_ol_surat');
          $this->load->model('m_ol_rancak');
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
      if ( $this->session->has_userdata('id_pegawai') )
          return TRUE;
     else
          redirect(base_url('logout'));
  }
	function index(){
		$data['page']="home";
		$data['header'] = "MEMBER";
		$data['title'] = "BERANDA";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$data['multi_level'] = $this->m_ol_rancak->ambil_data_link_pengurus($this->session->id_pegawai);
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
		$data['id']   = $this->uri->segment(4, 0);
		$this->tampil($data);
	}
  function pengajuan_surat($mode='view')
  {
		$data['page']  = "pengajuan_surat";
		$data['header'] = "PENGAJUAN SURAT";
		$data['title'] = "PENGAJUAN SURAT";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$data['multi_level'] = $this->m_ol_rancak->ambil_data_link_pengurus($this->session->id_pegawai);
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
		$data['id']   = $this->uri->segment(4, 0);
		if($mode=='view'){
			$this->tampil($data);
		}
		else if($mode=='data'){
			echo json_encode($this->m_ol_surat->surat_registrasi_all());
		}
		else{
			  $data['ambil_data_pengcabnonull'] = $this->m_ol_rancak->ambil_data_pengcabnonull($this->session->id_jabatan);
			  $data['ambil_data_surat_kategori'] = $this->m_ol_rancak->ambil_data_surat_kategori($this->session->id_jabatan);
			if($mode=='tambah'){
			  $data['page'] =  $data['page']."_tambah";
    		$data['id_pengcab']  = set_value('id_pengcab',$pegawai['id_pengcab']);
    		$data['id_kategori']  = set_value('id_kategori',$this->input->post("id_kategori"));    		
				$this->load->view("ol_daftar/isi",$data);
			}
			if($mode=='simpan_tambah'){
			  if($this->m_ol_daftar->simpan_kategori_surat()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('ol_daftar/kategori_surat'));
				}else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
					redirect(base_url('ol_daftar/kategori_surat'));
				}
			}
			if($mode=='edit'){
					$data['page'] =  $data['page']."_edit";
					$take = $this->m_umum->ambil_data('ol_surat_kategori','barcode_kategori',$data['id']);		
					$stake = $this->m_umum->ambil_data('ol_surat_format','id_kategori',$take['id_kategori']);		
					$data['id_kategori']  = set_value('id_kategori',$take['id_kategori']);
					$data['nama_kategori']  = set_value('nama_kategori',$take['nama_kategori']);
					$data['status_kategori']  = set_value('status_kategori',$take['status_kategori']);
					$data['isi_format']  = set_value('isi_format',$stake['isi_format']);
					$this->form_validation->set_rules('nama_kategori','nama_kategori','required');
				if ($this->form_validation->run() === FALSE){
					$this->tampil($data);
				}else{
					$id_kategori = $this->input->post('id_kategori');
			 		$kondisi=array('id_kategori'=>$id_kategori);
					$jml = $this->m_umum->jumlah_record_filter('ol_surat_format',$kondisi);
					if($this->m_ol_daftar->edit_kategori_surat()){
						if($jml == 0){
							$this->m_ol_daftar->simpan_surat_format();
						}else{
							$this->m_ol_daftar->edit_surat_format();
						}						
						$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
						redirect(base_url('ol_daftar/kategori_surat'));
					}else{
						$this->session->set_flashdata('danger', 'Ada Masalah Akses Data');
						redirect(base_url('ol_daftar/kategori_surat'));
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
	$this->load->view("ol_surat/header",$data);
	$this->load->view("ol_surat/isi");
	$this->load->view("footer");
	$this->load->view("ol_surat/jsload");
	$this->load->view("ol_surat/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_top",$data);
	$this->load->view("ol_surat/isi");
	$this->load->view("footer");
	$this->load->view("ol_surat/jsload");
	$this->load->view("ol_surat/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
