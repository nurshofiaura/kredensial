<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Ms_etik extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
          $this->load->model('m_ol_rancak');
          $this->load->model('m_ms_etik');
          $this->load->model('m_auth');
          $this->m_auth->login_kah();
  }
	function index(){
/*		$data['page']="home";
		$data['header'] = "BERANDA";
		$data['title'] = "BERANDA";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
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
		//======================= IMPORTANT =========================================
		$whats = $this->m_umum->ambil_data('ol_whatsnew','id_whatsnew',1);
		$data['isi_whatsnew']   = $whats['isi_whatsnew'];*/
		$this->etika_profesi();
	}
  function etika_profesi($mode='view')
  {
		$data['page']  = "etika_profesi";
		$data['header'] = "DATA ETIKA PROFESI";
		$data['title'] = "DATA ETIKA PROFESI";
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
		$data['first_date'] = $this->uri->segment(4, 0);
		$data['last_date'] = $this->uri->segment(5, 0);
		$data['id_pegawai'] = $this->uri->segment(6, 0);
	  $data['cmd_pegawai'] = $this->m_ms_etik->cmd_pegawai_etik();
    if($mode=='view'){
		if(empty($data['first_date'])){
			if($this->session->has_userdata('first_date_etik')){
				$data['first_date'] = $this->session->first_date_etik;
			}else{
				$data['first_date'] = '01-01-'.date('Y');
			}
		}
		if(empty($data['last_date'])){
			if($this->session->has_userdata('last_date_etik')){
				$data['last_date'] = $this->session->last_date_etik;
			}else{
				$data['last_date'] = date('d-m-Y');
			}
		}
		if(empty($data['id_pegawai'])){
			if($this->session->has_userdata('id_pegawai_etik')){
				$data['id_pegawai'] = $this->session->id_pegawai_etik;
			}
		}
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$first_date = $this->input->post("first_date");
				$last_date = $this->input->post("last_date");
				$id_pegawai = $this->input->post("id_pegawai");
			$data_user_level = array(
				'id_pegawai_etik'     => $id_pegawai,
				'first_date_etik'     => $first_date,
				'last_date_etik'     => $last_date
			);	
			$this->session->set_userdata($data_user_level);
				redirect(base_url('ms_etik/etika_profesi/view/'.$first_date.'/'.$last_date.'/'.$id_pegawai));
			}			
		}
    else if($mode=='data'){
			echo json_encode($this->m_ms_etik->ms_etik_all($data['first_date'],$data['last_date'],$data['id_pegawai']));
		}
  	else{
	      if($mode=='tambah'){
	        $data['page'] =  $data['page']."_tambah";
					$data['id_pegawai']  = set_value('id_pegawai',$this->input->post('id_pegawai'));
					$this->load->view("ms_etik/isi",$data);
	      }
	      if($mode=='simpan_tambah'){
	      	$id_pegawai = $this->input->post('id_pegawai');
							if($this->input->post('id_pegawai')){ 
								redirect(base_url('ms_etik/etika_profesi/input/'.$id_pegawai));
							}else{
								$this->session->set_flashdata('danger', 'Pegawai Belum Di pilih');
								redirect(base_url('ms_etik/etika_profesi'));									
							}
	      }
	    if($mode=='input'){
	      $data['page'] =  $data['page']."_input";
				if(empty($data['first_date'])){
					$this->session->set_flashdata('danger', 'Pilih Pegawai Dahulu');
					redirect(base_url('ms_etik/etika_profesi'));
				}
				$pegawaier   = $this->m_umum->ambil_data('ol_pegawai','barcode_pegawai',$data['first_date']);
				$data['id_pegawai']  = set_value('id_pegawai',$pegawaier["id_pegawai"]);
				$data['kol_etik_all']   = $this->m_ms_etik->kol_etik_all();
				$data['num_kol_etik_all']   = $this->m_ms_etik->num_kol_etik_all();
	      $this->form_validation->set_rules('id_pegawai','id_pegawai','required');
	      if ($this->form_validation->run() === FALSE){
	        $this->tampil($data);
	      }else{
				  if($last_ide = $this->m_ms_etik->simpan_etik_pegawai()){
						$this->m_ms_etik->simpan_etik_pegawai_detil($last_ide);
						$this->session->set_flashdata('sukses', 'Barang berhasil Di Simpan');
						redirect(base_url('ms_etik/etika_profesi'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data');
						redirect(base_url('ms_etik/etika_profesi'));
				  }
	      }
	    }
      if($mode=='lihat'){
        $data['page'] =  $data['page']."_lihat";
				$keuangan = $this->m_umum->ambil_data('ol_etik_pegawai','id_etik_pegawai',$data['first_date']);
				$data['ambil_etik_detil'] = $this->m_umum->ambil_data_result('ol_etik_detil','id_etik_pegawai',$keuangan["id_etik_pegawai"]);
				$data['id_etik_pegawai']  = set_value('id_etik_pegawai',$keuangan["id_etik_pegawai"]);
				$data['total_etik']  = set_value('total_etik',$keuangan["total_etik"]);
				$data['jumlah_etik']  = set_value('jumlah_etik',$keuangan["jumlah_etik"]);
				$data['hasil_etik']  = set_value('hasil_etik',$keuangan["hasil_etik"]);
				$this->tampil($data);
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan = $this->m_umum->ambil_data('ol_etik_pegawai','id_etik_pegawai',$data['first_date']);
				$data['ambil_etik_detil'] = $this->m_umum->ambil_data_result('ol_etik_detil','id_etik_pegawai',$keuangan["id_etik_pegawai"]);
				$data['id_etik_pegawai']  = set_value('id_etik_pegawai',$keuangan["id_etik_pegawai"]);
				$data['total_etik']  = set_value('total_etik',$keuangan["total_etik"]);
				$data['jumlah_etik']  = set_value('jumlah_etik',$keuangan["jumlah_etik"]);
				$data['hasil_etik']  = set_value('hasil_etik',$keuangan["hasil_etik"]);
				$this->load->view("ms_etik/isi",$data);
      }
      if($mode=='simpan_edit'){
      	$barcode_lhu = $this->input->post('barcode_lhu');
      	$id_lhu = $this->input->post('id_lhu');
      	$id_limbah = $this->input->post('id_limbah');
		 		$kondisi_peg=array('id_limbah'=>$id_limbah,'id_lhu'=>$id_lhu);
				$jml = $this->m_umum->jumlah_record_filter('sn_lhu_detil',$kondisi_peg);
				if($jml == 0){      	
				  if($this->m_im->simpan_sn_lhu_detil()){
						$this->session->set_flashdata('sukses', 'Barang berhasil Di Simpan');
						redirect(base_url('i_mutu/lhu/input/'.$barcode_lhu));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data');
						redirect(base_url('i_mutu/lhu/input/'.$barcode_lhu));
				  }
				}else{
						$this->session->set_flashdata('danger', 'Data Sudah Ada, Silahkan Edit Data');
						redirect(base_url('i_mutu/lhu/input/'.$barcode_lhu));					
				}
      }
		}
  }
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("ms_etik/header",$data);
	$this->load->view("ms_etik/isi");
	$this->load->view("footer");
	$this->load->view("ms_etik/jsload");
	$this->load->view("ms_etik/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_top",$data);
	$this->load->view("ms_etik/isi");
	$this->load->view("footer");
	$this->load->view("ms_etik/jsload");
	$this->load->view("ms_etik/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
