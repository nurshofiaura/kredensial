<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Upload extends CI_controller
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
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==98 )  // mega admin
          return TRUE;
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==15 )  // administrator perawat
          return TRUE;
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==3 )  // administrator kepegawaian
          return TRUE;
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==2 )  // administrator pelayanan
          return TRUE;
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==1 )  // administrator keuangan
          return TRUE;
     else
          redirect(base_url('logout'));
  }
	function index(){
		$this->download();
	}
  function download($mode='view')
  {
	$data['page']  = "download";
	$data['header'] = "UPLOAD BERKAS DI MENU DOWNLOAD";
	$data['title'] = "UPLOAD BERKAS di MENU DOWNLOAD";
	$data['link_kembali'] = base_url('');
	$data['link_awal'] = base_url('upload/download');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$program    = $this->m_umum->ambil_data('a_program','id_program',$pegawai["id_program"]);
	$data['program_unit'] = $program["unit"];
	$data['program_user_level'] = $program["user_level"];
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','2');
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
	$data['member_id'] = $pegawai["id_pegawai"];
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
		$this->tampil_top($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_administrator->download_all());
	}
    else if($mode=='hapus'){
			$user_pic=$this->m_umum->ambil_data('download','id_download',$data['id']);
			if($user_pic['id_level'] == $pegawai['id_level']){
				$cek_file=FCPATH.'assets/download/'.$user_pic['link_download'];
				if(file_exists($cek_file)){
					unlink(FCPATH."assets/download/".$user_pic['link_download']);
				}
				$this->m_umum->hapus_data('download','id_download',$data['id']);
				$this->session->set_flashdata('sukses', 'Download Sudah Di Hapus');
			}else{
				$this->session->set_flashdata('danger', 'Beda Permission');
			}
			redirect(base_url('upload/download'));
    }
  else{
		$data['cmd_jabatan_null']=$this->m_rancak->cmd_jabatan_null();
		$data['cmd_status']=$this->m_rancak->cmd_status();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		$data['nama_download']  = set_value('nama_download',$this->input->post("nama_download"));
		$data['id_jabatan']  = set_value('id_jabatan',$this->input->post("id_jabatan"));
		$data['status_download']  = set_value('status_download',$this->input->post("status_download"));
		$this->form_validation->set_rules('nama_download','nama_download','required');
        if ($this->form_validation->run() === FALSE){
			$this->tampil_top($data);
        }else{
			$data = array();
			$filesCount = count($_FILES['upload_Files']['name']);
			for($i = 0; $i < $filesCount; $i++){
				$_FILES['upload_File']['name'] = $_FILES['upload_Files']['name'][$i];
				$_FILES['upload_File']['type'] = $_FILES['upload_Files']['type'][$i];
				$_FILES['upload_File']['tmp_name'] = $_FILES['upload_Files']['tmp_name'][$i];
				$_FILES['upload_File']['error'] = $_FILES['upload_Files']['error'][$i];
				$_FILES['upload_File']['size'] = $_FILES['upload_Files']['size'][$i];
				$uploadPath = 'assets/download/';
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'pdf|doc|docx|xls|xlsx|ppt|pptx';
				$config['encrypt_name'] = TRUE;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if($this->upload->do_upload('upload_File')){
					$fileData = $this->upload->data();
					$this->m_administrator->simpan_download($fileData['file_name'],$pegawai['id_level']);
					$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
					redirect(base_url('upload/download'));
				}else{
					$this->session->set_flashdata('danger', 'Data Gagal Di Simpan');
					redirect(base_url('upload/download'));
				}
			}
		}
	  }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
		$berkas = $this->m_umum->ambil_data('download','id_download',$data['id']);
		$data['nama_download']  = set_value('nama_download',$berkas["nama_download"]);
		$data['id_jabatan']  = set_value('id_jabatan',explode(',', $berkas["id_jabatan"]));
		$data['status_download']  = set_value('status_download',$berkas["status_download"]);
		$this->form_validation->set_rules('nama_download','nama_download','required');
        if ($this->form_validation->run() === FALSE){
			$this->tampil_top($data);
        }else{
			$data = array();
			$filesCount = count($_FILES['upload_Files']['name']);
			for($i = 0; $i < $filesCount; $i++){
				$_FILES['upload_File']['name'] = $_FILES['upload_Files']['name'][$i];
				$_FILES['upload_File']['type'] = $_FILES['upload_Files']['type'][$i];
				$_FILES['upload_File']['tmp_name'] = $_FILES['upload_Files']['tmp_name'][$i];
				$_FILES['upload_File']['error'] = $_FILES['upload_Files']['error'][$i];
				$_FILES['upload_File']['size'] = $_FILES['upload_Files']['size'][$i];
				$uploadPath = 'assets/download/';
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'pdf|doc|docx|xls|xlsx|ppt|pptx';
				$config['encrypt_name'] = TRUE;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if($this->upload->do_upload('upload_File')){
					$id_download = $this->input->post('id_download');
					$user_pic=$this->m_umum->ambil_data('download','id_download',$id_download);
					$cek_file=FCPATH.'assets/download/'.$user_pic['link_download'];
					if(file_exists($cek_file)){
						unlink(FCPATH."assets/download/".$user_pic['link_download']);
					}
					$fileData = $this->upload->data();
					$this->m_administrator->edit_download($fileData['file_name'],$pegawai['id_level']);
					$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
					redirect(base_url('upload/download'));
				}else{
					$this->session->set_flashdata('danger', 'Data Gagal Di Simpan');
					redirect(base_url('upload/download'));
				}
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
