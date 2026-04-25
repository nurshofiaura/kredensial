<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Ol_pemulihan extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
          $this->load->model('m_ol_rancak');
          $this->load->model('m_ol_pemulihan');
          $this->login_kah();
  }
  function cek_login_kah(){
  	$link_akses = $this->uri->segment(1, 0);
		$kondisi_hak=array('id_pegawai'=>$this->session->id_pegawai,'link_akses'=>$link_akses);
		$jumlah_hak_akses_pegawai=$this->m_ol_rancak->jumlah_hak_akses_pegawai($kondisi_hak);
		if($jumlah_hak_akses_pegawai == 0){
			$this->session->set_flashdata('danger', 'Hubungi Admin Untuk Aktifasi');
			redirect(base_url('member'));
		}else{
			return TRUE;
		}
  }
  function cek_online_kah(){
  	  $kode_online = $this->uri->segment(1, 0);
	 		$kondisi_cek_online=array('id_pegawai'=>$this->session->id_pegawai,'kode_online'=>$kode_online,'enabled'=>1,'status_ol_enabled'=>1);
			$jml_cek_online = $this->m_umum->jumlah_record_tabel_pengajuan('a_ol_enabled',$kondisi_cek_online,'a_online','id_kode_online');
			if($jml_cek_online == 0){
				$this->cek_login_kah();
			}else{
				if ( $this->session->has_userdata('id_pegawai')){
					return TRUE;
				}else{
					redirect(base_url());
				}
			}
  }
  function login_kah()
  {
      if ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==99 )
          return TRUE;
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==98 )
          return TRUE;
      elseif ( $this->session->has_userdata('has_struktur') && $this->session->userdata('has_struktur')==1 )
          return TRUE;
      else
        //  redirect(base_url('logout'));
         // redirect(base_url('member'));
      $this->cek_online_kah();
  }
	function index(){
		$data['page']="home";
		$data['header'] = "BERANDA";
		$data['title'] = "BERANDA";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$data['forpengurus_pengcab'] = $this->m_ol_rancak->ambil_data_dropdown_pengurus_pengcab($this->session->id_pegawai);
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
		$this->penolakan();
	}
  function unit_data_perinstansi($id)
  {
    $dt=$this->m_ol_rancak->ambil_data_dropdown_unit($id);
    echo json_encode($dt);
  }
  function unit_data_opi_pegawai($id)
  {
    $dt=$this->m_ol_rancak->ambil_data_dropdown_pegawai_untuk_pemulihan($id);
    echo json_encode($dt);
  }
	function penolakan($mode='view'){
		$data['page']="penolakan"; 
		$data['header'] = "DATA PENOLAKAN KEWENANGAN";
		$data['title'] = "DATA PENOLAKAN KEWENANGAN";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
		$propinsie = $this->m_umum->ambil_data('ol_pengcab','id_pengcab',$pegawai['id_pengcab']);
		$data['prov_id'] = $propinsie["id_prov"];
		$data['aran_jabatan'] = $jabatanekuh["nama_jabatan"];
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
		$data['cmd_pegawai_null'] = $this->m_ol_rancak->ambil_data_etik_instansi($this->session->list_instansi); 
		if($data['id'] == NULL OR empty($data['id'])){
			$data['id'] = "";
		}
		if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
	      $id   = $this->input->post("id");
	      $trim_keyword   = urldecode(trim($this->input->post("id")));
				$replace_keyword   = preg_replace('/\s+/', ' ', $trim_keyword);
				$key = str_replace(' ', '-', $replace_keyword);
				redirect(base_url('ol_pemulihan/penolakan/view/'.$key));
			}
		}
		else if($mode=='data'){
			echo json_encode($this->m_ol_pemulihan->kewenangan_tolak($data['id']));
		}
		else{
			$data['ambil_data_rujukan_working'] = $this->m_ol_rancak->ambil_data_rujukan_working(); 
			$data['ambil_data_etik_instansi_no_null_all'] = $this->m_ol_rancak->ambil_data_etik_instansi_no_null_all(); 
	    if($mode=='pendaftaran'){
	      $data['page'] =  $data['page']."_pendaftaran";
	      $peg = $this->m_umum->ambil_data('ol_pegawai','barcode_pegawai',$data['id']);
	      $ole = $this->m_ol_rancak->ambil_data_instansi_untuk_session($peg['id_pegawai']); 
				$arr = array();
				foreach($ole as $val){
						$arr[] = $val['id_instansi'];
				}
				$eimplo = implode(",", $arr);
				$data['ambil_id_instansi_pegawai'] = $this->m_ol_rancak->ambil_data_rujukan_working_kab_null($eimplo); 
	      $data['cmd_data_ruangan']  = array("");
	      $data['cmd_id_unit_pegawai']  = array("");
	      $data['id_instansi_pegawai']  = set_value('id_instansi_pegawai',$this->input->post('id_instansi_pegawai'));
	      $data['id_unit_pegawai']  = set_value('id_unit_pegawai',$this->input->post('id_unit_pegawai'));
	      $data['id_instansi']  = set_value('id_instansi',$this->input->post('id_instansi'));
	      $data['id_unit_pemulihan']  = set_value('id_unit_pemulihan',$this->input->post('id_unit_pemulihan'));
	      $data['id_pemulihan']  = set_value('id_pemulihan',$this->input->post('id_pemulihan'));
	      $data['id_unit']  = set_value('id_unit',$this->input->post('id_unit'));
	      $data['tgl_awal']  = set_value('tgl_awal',date('d-m-Y'));
	      $data['tgl_akhir']  = set_value('tgl_akhir',date('d-m-Y'));
	      $this->form_validation->set_rules('barcode_pegawai','barcode_pegawai','required');
	      if ($this->form_validation->run() === FALSE){
	        $this->tampil($data);
	      }else{
	      	$barcode_pegawai= $this->input->post('barcode_pegawai');
					$kondisi_peg=array('barcode_pegawai'=>$barcode_pegawai);
					$jml_peg = $this->m_umum->jumlah_record_filter('ol_pegawai',$kondisi_peg);
	  		  if($jml_peg == 0){
	          $this->session->set_flashdata('danger', 'Data Pegawai Kosong');
	    			redirect(base_url('ol_pemulihan/penolakan'));
	  		  }else{
	  		  	$peg = $this->m_umum->ambil_data('ol_pegawai','barcode_pegawai',$barcode_pegawai);
	          if($last_ide = $this->m_ol_pemulihan->simpan_pemulihan($peg['id_pegawai'])){
	  					$this->session->set_flashdata('sukses', 'Data berhasil Di Tambah');
	  					redirect(base_url('ol_pemulihan/kegiatan'));
					  }else{
	  					$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data');
	  					redirect(base_url('ol_pemulihan/penolakan'));
					  }
	  			}
	      }
	    }
		}
	}
  function kegiatan($mode='view')
  {
	$data['page']  = "kegiatan";
	$data['header'] = "DAFTAR PILIHAN KEWENANGAN PEGAWAI TERTOLAK";
	$data['title'] = "DAFTAR PILIHAN KEWENANGAN PEGAWAI TERTOLAK";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
		$propinsie = $this->m_umum->ambil_data('ol_pengcab','id_pengcab',$pegawai['id_pengcab']);
		$data['prov_id'] = $propinsie["id_prov"];
		$data['aran_jabatan'] = $jabatanekuh["nama_jabatan"];
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
  $data['cmd_pegawai_null']=$this->m_ol_rancak->ambil_data_etik_instansi($this->session->list_instansi); 
  $data['cmd_pegawai']=$this->m_ol_rancak->ambil_data_rujukan_kab_working($this->session->list_instansi);
		if($data['id'] == NULL OR empty($data['id'])){
			$data['id'] = "";
		}
		if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
	      $id   = $this->input->post("id");
	      $trim_keyword   = urldecode(trim($this->input->post("id")));
				$replace_keyword   = preg_replace('/\s+/', ' ', $trim_keyword);
				$key = str_replace(' ', '-', $replace_keyword);
				redirect(base_url('ol_pemulihan/kegiatan/view/'.$key));
			}
		}
  else if($mode=='data'){
		echo json_encode($this->m_ol_pemulihan->logbook_pemulihan_all($data['id']));
	}
  else if($mode=='data2'){
		echo json_encode($this->m_ol_pemulihan->logbook_pemulihan_detil_pegawai($data['id']));
	}
  else if($mode=='data3'){
		echo json_encode($this->m_ol_pemulihan->logbook_kegiatan_pemulihan_personal($data['id']));
	}
	else{
    if($mode=='edit'){
      $data['page'] =  $data['page']."_edit";
      $aktivitas = $this->m_umum->ambil_data('ol_logbook_pemulihan','barcode_logbook_pemulihan',$data['id']);
      $data['ambil_lobook_pemulihan_detil']=$this->m_ol_rancak->ambil_lobook_pemulihan_detil($aktivitas['id_logbook_pemulihan']);
      $data['ambil_data_rujukan_working'] = $this->m_ol_rancak->ambil_data_rujukan_working(); 
      $data['ambil_data_etik_instansi_no_null_all'] = $this->m_ol_rancak->ambil_data_etik_instansi_no_null_all(); 
	      $ole = $this->m_ol_rancak->ambil_data_instansi_untuk_session($aktivitas['id_pegawai']);
	      $data['cmd_id_unit_pegawai'] = $this->m_ol_rancak->ambil_data_dropdown_unit_no_null($aktivitas['id_instansi_pegawai']); 
	      $data['cmd_data_ruangan'] = $this->m_ol_rancak->ambil_data_dropdown_unit_no_null($aktivitas['id_instansi_pemulihan']); 
				$arr = array();
				foreach($ole as $val){
						$arr[] = $val['id_instansi'];
				}
				$eimplo = implode(",", $arr);
				$data['ambil_id_instansi_pegawai'] = $this->m_ol_rancak->ambil_data_rujukan_working_kab_null($eimplo); 
      $data['tgl_awal']  = date('d-m-Y', strtotime($aktivitas["tgl_awal"]));
      $data['tgl_akhir']  = date('d-m-Y', strtotime($aktivitas["tgl_akhir"]));
      $data['id_logbook_pemulihan']  = set_value('id_logbook_pemulihan',$aktivitas["id_logbook_pemulihan"]);
      $data['id_instansi_pegawai']  = set_value('id_instansi_pegawai',$aktivitas["id_instansi_pegawai"]);
      $data['id_unit_pegawai']  = set_value('id_unit_pegawai',$aktivitas["id_unit_pegawai"]);
      $data['id_pemulihan']  = set_value('id_pemulihan',$aktivitas["id_pemulihan"]);
      $data['id_instansi']  = set_value('id_instansi',$aktivitas["id_instansi_pemulihan"]);
      $data['id_unit_pemulihan']  = set_value('id_unit_pemulihan',$aktivitas["id_unit_pemulihan"]);
      $data['result_pemulihan']  = set_value('result_pemulihan',$aktivitas["result_pemulihan"]);
      $this->form_validation->set_rules('id_logbook_pemulihan','id_logbook_pemulihan','required');
      if ($this->form_validation->run() === FALSE){
        $this->tampil($data);
      }else{
        $result_pemulihan = $this->input->post('result_pemulihan');
        if($result_pemulihan == 0){
          $this->m_ol_pemulihan->edit_pemulihan();
          $this->session->set_flashdata('sukses', 'Data Sudah Di Rubah');
        }else{
          $this->session->set_flashdata('danger', 'Data Sudah Dilakukan Validasi');
        }
        redirect(base_url('ol_pemulihan/kegiatan'));
      }
    }
    if($mode=='tambah'){
      $data['page'] =  $data['page']."_tambah";
      $aktivitas = $this->m_umum->ambil_data('ol_logbook_pemulihan','barcode_logbook_pemulihan',$data['id']);
      $data['ambil_lobook_perorang']=$this->m_ol_rancak->ambil_lobook_perorang($aktivitas['id_pegawai']);
      $data['id_logbook_pemulihan']  = set_value('id_logbook_pemulihan',$aktivitas['id_logbook_pemulihan']);
      $data['result_pemulihan']  = set_value('result_pemulihan',$aktivitas['result_pemulihan']);
      $this->form_validation->set_rules('id_logbook_pemulihan','id_logbook_pemulihan','required');
      if ($this->form_validation->run() === FALSE){
        $this->tampil($data);
      }else{
        $barcode_logbook_pemulihan = $this->input->post('barcode_logbook_pemulihan');
        $result_pemulihan = $this->input->post('result_pemulihan');
        if($result_pemulihan == 0){
          $this->m_ol_pemulihan->simpan_logbook_pemulihan_detil();
    			$this->session->set_flashdata('sukses', 'Data Sudah Di Tambah & Data Dobel Tidak Di Tambah');
          redirect(base_url('ol_pemulihan/kegiatan/edit/'.$barcode_logbook_pemulihan));
        }else{
          $this->session->set_flashdata('danger', 'Data Sudah Dilakukan Validasi');
          redirect(base_url('ol_pemulihan/kegiatan/edit/'.$barcode_logbook_pemulihan));
        }
      }
    }
    if($mode=='hasil'){
      if(empty($data['id'])){
        $this->session->set_flashdata('danger', 'Tidak Ada ID');
        redirect(base_url('ol_pemulihan/kegiatan'));
    	}
      $data['page'] =  $data['page']."_hasil";
      $aktivitas    = $this->m_umum->ambil_data('ol_logbook_pemulihan','barcode_logbook_pemulihan',$data['id']);
      $data['cmd_result'] = array('0'=>'Registrasi','1'=>'Proses','2'=>'Selesai'); 
			$kondisi_hasil_kegiatan=array('id_logbook_pemulihan'=>$aktivitas['id_logbook_pemulihan']);
			$data['jml_hasil_kegiatan']=$this->m_umum->jumlah_record_filter('ol_logbook_kegiatan_pemulihan',$kondisi_hasil_kegiatan);
      $data['cmd_kompeten']=$this->m_rancak->cmd_kompeten();
      $data['ambil_lobook_pemulihan_detile']=$this->m_ol_rancak->ambil_kewenangan_lobook_pemulihan_detil($aktivitas['id_logbook_pemulihan']);
      $data['id_logbook_pemulihan']  = set_value('id_logbook_pemulihan',$aktivitas['id_logbook_pemulihan']);
      $data['result_pemulihan']  = set_value('result_pemulihan',$aktivitas['result_pemulihan']);
      $data['status_pemulihan']  = set_value('status_pemulihan',$aktivitas['status_pemulihan']);
      $data['catatan_pemulihan']  = set_value('catatan_pemulihan',$aktivitas['catatan_pemulihan']);
      $this->form_validation->set_rules('id_logbook_pemulihan','id_logbook_pemulihan','required');
      if ($this->form_validation->run() === FALSE){
        $this->tampil($data);
      }else{
      	$jml_hasil_kegiatan = $this->input->post('jml_hasil_kegiatan');
      	if($jml_hasil_kegiatan > 0){
	        if($this->m_ol_pemulihan->edit_logbook_pemulihan()){
	          $this->session->set_flashdata('sukses', 'Hasil Sudah Terupdate');
	          redirect(base_url('ol_pemulihan/kegiatan'));
	        }else{
	          $this->session->set_flashdata('danger', 'Masalah Penambahan Data');
	          redirect(base_url('ol_pemulihan/kegiatan'));
	        }
	      }else{
          $this->session->set_flashdata('danger', 'Belum Ada Data Kegiatan Pemulihan');
          redirect(base_url('ol_pemulihan/kegiatan'));	      	
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
	$this->load->view("ol_pemulihan/header",$data);
	$this->load->view("ol_pemulihan/isi");
	$this->load->view("footer");
	$this->load->view("ol_pemulihan/jsload");
	$this->load->view("ol_pemulihan/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_top",$data);
	$this->load->view("ol_pemulihan/isi");
	$this->load->view("footer");
	$this->load->view("ol_pemulihan/jsload");
	$this->load->view("ol_pemulihan/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
