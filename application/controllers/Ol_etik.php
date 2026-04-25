<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Ol_etik extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
        parent::__construct();	  	
		  	$this->load->model('m_ol_rancak');
        $this->load->model('m_ol_karu');
          $this->load->model('m_auth');
          $this->m_auth->login_kah();
  }
  function index(){
    $this->etik();
  }
  function etik($mode='view')
  {
		$data['page']  = "etik";
		$data['header'] = "MASTER ETIK";
		$data['title'] = "MASTER ETIK";
		$data['link_kembali'] = base_url();
		$data['link_awal'] = base_url('etik/etik');
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
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
		$data['id'] = $this->uri->segment(4, 0);
		$data['cmd_jabatan_null'] = $this->m_rancak->cmd_jabatan_null();
    if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$id = $this->input->post("id_jabatan");
				redirect(base_url('ol_etik/etik/view/'.$id));
			}
		}
    else if($mode=='data'){
			echo json_encode($this->m_ol_karu->etik_all($data['id']));
		}
  	else{
			$data['cmd_jabatan'] = $this->m_rancak->cmd_jabatan();
			$data['cmd_ya_tidak'] = $this->m_rancak->cmd_ya_tidak();
			$data['cmd_status'] = $this->m_rancak->cmd_status();
			$data['ambil_working'] = $this->m_ol_rancak->ambil_data_rujukan_kab_working($this->session->list_instansi);
		  if($mode=='tambah'){
				$data['page'] =  $data['page']."_tambah";
				$data['nama_etik']  = set_value('nama_etik',$this->input->post('nama_etik'));
				$data['answer']  = set_value('answer',$this->input->post('answer'));
				$data['status_etik']  = set_value('status_etik',$this->input->post('status_etik'));
				$this->form_validation->set_rules('nama_etik','nama_etik','required');
	      if ($this->form_validation->run() === FALSE){
					$this->tampil($data);
	      }else{
					$this->m_ol_karu->simpan_etik();
					$this->session->set_flashdata('sukses', 'Data Sudah Di Tambah');
					redirect(base_url('ol_etik/etik'));
	      }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$d = $this->m_umum->ambil_data('ol_etik','id_etik',$data['id']);
				$data['id_jabatan'] = set_value('id_jabatan',$d["id_jabatan"]);
				$data['id_etik'] = set_value('id_etik',$d["id_etik"]);
				$data['nama_etik'] = set_value('nama_etik',$d["nama_etik"]);
				$data['answer'] = set_value('answer',$d["answer"]);
				$data['status_etik'] = set_value('status_etik',$d["status_etik"]);
				$data['pembuat'] = set_value('pembuat',$d["pembuat"]);
				$this->form_validation->set_rules('nama_etik','nama_etik','required');
        if ($this->form_validation->run() === FALSE){
					$this->tampil($data);
        }else{
        	$pembuat = $this->input->post('pembuat');
        	if($pembuat == $this->session->id_pegawai){
					  if($this->m_ol_karu->edit_etik()){
							$this->session->set_flashdata('sukses', 'Data Sudah Di Rubah');
							redirect(base_url('ol_etik/etik'));
					  }else{
							$this->session->set_flashdata('danger', 'Masalah Edit Data');
							redirect(base_url('ol_etik/etik'));
					  }
					}else{
						$this->session->set_flashdata('danger', 'Tidak Dapat Menghapus Etik User Lain');
						redirect(base_url('ol_etik/etik'));						
					}
        }
      }
		}
  }
  function ms_etik($mode='view')
  {
		$data['page']  = "ms_etik";
		$data['header'] = "PILIH MASTER ETIK";
		$data['title'] = "PILIH MASTER ETIK";
		$data['link_kembali'] = base_url();
		$data['link_awal'] = base_url('etik/etik');
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
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
		$data['id'] = $this->uri->segment(4, 0);
		$data['cmd_jabatan_null'] = $this->m_rancak->cmd_jabatan_null();
    if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$id = $this->input->post("id_jabatan");
				redirect(base_url('ol_etik/ms_etik/view/'.$id));
			}
		}
    else if($mode=='data'){
			echo json_encode($this->m_ol_karu->ms_etik_all($data['id']));
		}
  	else{
			$data['cmd_jabatan'] = $this->m_rancak->cmd_jabatan();
			$data['cmd_status'] = $this->m_rancak->cmd_status();
			$data['ambil_data_rujukan_working_kab_null'] = $this->m_ol_rancak->ambil_data_rujukan_kab_working($this->session->list_instansi);
			$data['ambil_pilih_ms_etik'] = $this->m_ol_rancak->ambil_pilih_ms_etik('0');
		  if($mode=='tambah'){
				$data['page'] =  $data['page']."_tambah";
				$data['id_instansi']  = set_value('id_instansi',$this->input->post("id_instansi"));
				$data['id_jabatan']  = set_value('id_jabatan',$this->input->post("id_jabatan"));
				$this->tampil($data);
				$action = $this->input->post('action');
				if($action == 'BtnProses') {
					$id = $this->input->post("id_jabatan");
					redirect(base_url('ol_etik/ms_etik/tambah/'.$id));
				}
				if($action == 'BtnSimpan') {
					if($this->input->post('chk')){
						$this->m_ol_karu->simpan_ms_etik();
						$this->session->set_flashdata('sukses', 'Data Sudah Di Tambah');
						redirect(base_url('ol_etik/ms_etik'));
					}else{
						$this->session->set_flashdata('danger', 'Belum Pilih Etik');
						redirect(base_url('ol_etik/ms_etik'));
					}
				}
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$d = $this->m_umum->ambil_data('ol_etik_instansi','id_etik_instansi',$data['id']);
				$data['id_etik_instansi'] = set_value('id_etik_instansi',$d["id_etik_instansi"]);
				$data['id_jabatan'] = set_value('id_jabatan',$d["id_jabatan"]);
				$data['id_instansi'] = set_value('id_instansi',$d["id_instansi"]);
				$data['etik'] = set_value('etik',$d["etik"]);
				$data['status_etik_instansi'] = set_value('status_etik_instansi',$d["status_etik_instansi"]);
				$this->tampil($data);
				$action = $this->input->post('action');
				if($action == 'BtnProses') {
					$id = $this->input->post("id_jabatan");
					redirect(base_url('ol_etik/ms_etik/tambah/'.$id));
				}
				if($action == 'BtnSimpan') {
					$this->m_ol_karu->edit_ms_etik();
					$this->session->set_flashdata('sukses', 'Data Sudah Di Tambah');
					redirect(base_url('ol_etik/ms_etik'));
				}
      }
		}
  }
  function etik_pegawai($mode='view')
  {
		$data['page']  = "etik_pegawai";
		$data['header'] = "INPUT ETIK USER";
		$data['title'] = "INPUT ETIK USER";
		$data['link_kembali'] = base_url();
		$data['link_awal'] = base_url('etik/etik');
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
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
		$data['id'] = $this->uri->segment(4, 0);
		$data['cmd_pegawai_null'] = $this->m_ol_rancak->ambil_data_etik_instansi($this->session->list_instansi);
    if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$id = $this->input->post("barcode_pegawai");
				redirect(base_url('ol_etik/etik_pegawai/view/'.$id));
			}
		}
    else if($mode=='data'){
			echo json_encode($this->m_ol_karu->etik_pegawai_all($data['id']));
		}
  	else{
			$data['ambil_etik_instansi'] = $this->m_ol_rancak->ambil_etik_instansi();
			$data['cmd_ya_tidak'] = $this->m_rancak->cmd_ya_tidak();
			$data['ambil_pilih_ms_etik'] = $this->m_ol_rancak->ambil_pilih_ms_etik('0');
			$data['ambil_data_etik_instansi_no_null'] = $this->m_ol_rancak->ambil_data_etik_instansi_no_null($this->session->list_instansi);
			$data['cmd_status'] = $this->m_rancak->cmd_status();
			$data['ambil_working'] = $this->m_ol_rancak->ambil_data_rujukan_kab_working($this->session->list_instansi);
		  if($mode=='tambah'){
				$data['page'] =  $data['page']."_tambah";
				$etikpeg  = $this->m_umum->ambil_data('ol_etik_instansi','id_etik_instansi',$data['id']);
				$data['etik'] = $etikpeg['etik'];
				$data['nama_etik']  = set_value('nama_etik',$this->input->post('nama_etik'));
				$data['answer']  = set_value('answer',$this->input->post('answer'));
				$data['status_etik']  = set_value('status_etik',$this->input->post('status_etik'));
				$data['id_instansi']  = set_value('id_instansi',$this->input->post('id_instansi'));
				$data['id_pegawai']  = set_value('id_pegawai',$this->input->post('id_pegawai'));
				$this->tampil($data);
				$action = $this->input->post('action');
				if($action == 'BtnProses') {
					$id = $this->input->post("id");
					redirect(base_url('ol_etik/etik_pegawai/tambah/'.$id));
				}
				if($action == 'BtnSimpan') {
					$last_ide = $this->m_ol_karu->simpan_etik_pegawai();
					$this->m_ol_karu->simpan_etik_pegawai_detil($last_ide);
					$this->session->set_flashdata('sukses', 'Data Sudah Di Tambah');
					redirect(base_url('ol_etik/etik_pegawai'));
				}
      }
      if($mode=='lihat'){
        $data['page'] =  $data['page']."_lihat";
				$d = $this->m_umum->ambil_data('ol_etik_pegawai','barcode_etik_pegawai',$data['id']);
				$data['ambil_data_etik_pegawai'] = $this->m_ol_rancak->ambil_data_etik_pegawai($d['id_etik_pegawai']);
				$data['id_instansi'] = set_value('id_instansi',$d["id_instansi"]);
				$data['tgl_etik_pegawai'] = set_value('tgl_etik_pegawai',date('d-m-Y',strtotime($d["tgl_etik_pegawai"])));
				$data['total_etik'] = set_value('total_etik',$d["total_etik"]);
				$data['jumlah_etik'] = set_value('jumlah_etik',$d["jumlah_etik"]);
				$data['hasil_etik'] = set_value('hasil_etik',$d["hasil_etik"]);
				$data['id_penguji'] = set_value('id_penguji',$d["id_penguji"]);
				$this->tampil($data);
      }
		}
  }
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("ol_karu/header",$data);
	$this->load->view("ol_karu/isi");
	$this->load->view("footer");
	$this->load->view("ol_karu/jsload");
	$this->load->view("ol_karu/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_topol",$data);
	$this->load->view("ol_karu/isi");
	$this->load->view("footer");
	$this->load->view("ol_karu/jsload");
	$this->load->view("ol_karu/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
