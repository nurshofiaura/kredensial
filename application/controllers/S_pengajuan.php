<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class S_pengajuan extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
          $this->load->model('m_sample');
  }
	function index(){
		$data['page']="home";
		$data['header'] = "BERANDA";
		$data['title'] = "BERANDA";
		$data['link_kembali'] = base_url('logbook');
		$data['link_awal'] = base_url('');
		$data['nama_pk'] = "PK";
		$data['nama'] = "NAMA NAKES";
		$data['level'] = "Perawat Madya";
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','5');
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
		//======================= IMPORTANT =========================================
		$this->pengajuan_kompetensi();
	}
	function pengajuan_kompetensi($mode='view'){
		$data['page']="pengajuan_kompetensi"; 
		$data['header'] = "DATA PENGAJUAN KOMPETENSI";
		$data['title'] = "DATA PENGAJUAN KOMPETENSI";
		$data['link_kembali'] = base_url('logbook');
		$data['link_awal'] = base_url('');
		$data['nama_pk'] = "PK";
		$data['nama'] = "NAMA NAKES";
		$data['level'] = "Perawat Madya";
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','5');
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
		//======================= IMPORTANT =========================================
		$data['id'] = $this->uri->segment(4, 0);
		$data['id2'] = $this->uri->segment(5, 0);
				$data['status_diusulkan_all'] = $this->m_rancak->status_diusulkan_all();
		if($mode=='view'){
			$this->tampil_top($data);
		}
    else if($mode=='data'){
		echo json_encode($this->m_sample->pengajuan_kompetensi_all());
	}
    else if($mode=='tabel'){
		echo json_encode($this->m_sample->tabel_logbook($data['id']));
	}
    else if($mode=='pemulihan'){
		echo json_encode($this->m_pengajuan->tabel_pemulihan($data['id']));
	}
		else{
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
	      $data['id_status_diusulkan']  = set_value('id_status_diusulkan',$this->input->post("id_status_diusulkan"));
	      $data['id_instansi']  = set_value('id_instansi',$this->input->post("id_instansi"));
	      $this->load->view("s_pengajuan/isi",$data);
      }
      if($mode=='simpan_tambah'){
				//	$this->session->set_flashdata('danger', 'Versi Sample Tidak Dapat Tambah Data');
					redirect(base_url('s_pengajuan/pengajuan_kompetensi'));
      }
      if($mode=='isi'){
        $data['page'] =  $data['page']."_isi";
				$data['ambil_berkas_data']=$this->m_sample->ambil_id_berkas_data();
				$d	=$this->m_sample->ambil_pengajuan_kompetensi($data['id']); //barcode_pengajuan
				$data['ambil_data_etik_pegawai_oppe'] = $this->m_sample->ambil_data_etik_pegawai_oppe();
				$data['id_pengajuan']  = set_value('id_pengajuan',$d["id_pengajuan"]);
				$kondisi_logbooke=array('id_pengajuan'=>$d["id_pengajuan"]);
				$data['jml_logbooke']=$this->m_umum->jumlah_record_filter('s_logbook',$kondisi_logbooke);
				$data['id_status_diusulkan']  = set_value('id_status_diusulkan',$d["id_status_diusulkan"]);
				$data['nama_status_diusulkan']  = set_value('nama_status_diusulkan',$d["nama_status_diusulkan"]);
				$data['id_berkas']  = explode(",", $d["id_berkas"]);
				$data['berkas']  = $d["id_berkas"];
				$data['id_ijasah']  = explode(",", $d["id_ijasah"]);
				$data['ijasah']  = $d["id_ijasah"];
				$data['id_str']  = explode(",", $d["id_str"]);
				$data['str']  = $d["id_str"];
				$data['id_sertifikat']  = explode(",", $d["id_sertifikat"]);
				$data['etike']  = explode(",", $d["id_etik_pegawai"]);
				$data['sertifikat']  = $d["id_sertifikat"];
			//	$data['kesesuaian_bukti']  = set_value('kesesuaian_bukti',explode(",", $d["kesesuaian_bukti"]));
				$data['status_pengajuan']  = set_value('status_pengajuan',$d["status_pengajuan"]);
				$data['id_etik_pegawai']  = set_value('id_etik_pegawai',$d["id_etik_pegawai"]);
				$data['ambil_lobook_validasi_group_pengajuan']=$this->m_sample->ambil_lobook_validasi_group_pengajuan($d["id_pengajuan"]);
				$this->tampil_top($data);
				$action = $this->input->post('action');
				$id_pengajuan = $this->input->post('id_pengajuan');
				if($action == 'Btnsimpan') {
					redirect(base_url('ol_pengajuan/pengajuan_kompetensi'));
				}
				if($action == 'BtnKirim') {
					redirect(base_url('ol_pengajuan/pengajuan_kompetensi'));
				}
	  }
      if($mode=='kirim'){
					redirect(base_url('ol_pengajuan/pengajuan_kompetensi'));
      }
		if($mode=='reset_logbook'){
				  	redirect(base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$data['id']));
		}    
		}
	}
  function berkas_logbook($mode='view')
  {
		$data['page']  = "berkas_logbook";
		$data['header'] = "PEMILIHAN ID LOGBOOK AWAL DAN AKHIR";
		$data['title'] = "PEMILIHAN ID LOGBOOK AWAL DAN AKHIR";
		$data['link_kembali'] = base_url('logbook');
		$data['link_awal'] = base_url('');
		$data['nama_pk'] = "PK";
		$data['nama'] = "NAMA NAKES";
		$data['level'] = "Perawat Madya";
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','5');
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
		// ===============================================================
		$data['id']   = $this->uri->segment(4, 0); //id pengajuan
		$data['link_kembali'] = base_url('s_pengajuan/pengajuan_kompetensi/isi/'.$data['id']);
		$pengajuan = $this->m_umum->ambil_data('s_pengajuan','barcode_pengajuan',$data['id']);
		$data['id_pengajuan'] = $pengajuan["id_pengajuan"];
		$data['id_status_diusulkan'] = $pengajuan["id_status_diusulkan"];
		if(empty($data['first_date'])){
			$data['first_date'] =  '01-'.date('m-Y');
		}
		if(empty($data['last_date'])){
			$data['last_date'] = date('d-m-Y');
		}
		if($pengajuan["id_status_diusulkan"] == 4){
			$data['logbook_pengajuan'] = $this->m_sample->logbook_ditolak();
		}else{
			$data['logbook_pengajuan'] = $this->m_sample->logbook_pengajuan();
		}	
	    if($mode=='view'){
			$this->tampil_top($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$id = $this->input->post("barcode_pengajuan");
				redirect(base_url('pengajuan/berkas_logbook/view/'.$id));
			}
			if($action == 'BtnSimpan') {
				$id = $this->input->post("barcode_pengajuan");
				redirect(base_url('pengajuan/pengajuan_kompetensi/isi/'.$id));
			}
		}
  }
  function berkas_ijasah($mode='view')
  {
	$data['page']  = "berkas_ijasah";
	$data['header'] = "AMBIL BERKAS IJASAH";
	$data['title'] = "AMBIL BERKAS IJASAH";
		$data['link_kembali'] = base_url('logbook');
		$data['link_awal'] = base_url('');
		$data['nama_pk'] = "PK";
		$data['nama'] = "NAMA NAKES";
		$data['level'] = "Perawat Madya";
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','5');
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
		$data['id']  = $this->uri->segment(4, 0);
		$data['idb']  = $this->uri->segment(5, 0);
		$data['link_kembali'] = base_url('s_pengajuan/pengajuan_kompetensi/isi/'.$data['id']);
		$pengajuan = $this->m_umum->ambil_data('s_pengajuan','barcode_pengajuan',$data['id']);
		$data['id_pengajuan'] = $pengajuan["id_pengajuan"];
    if($mode=='view'){
		$this->tampil_top($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_sample->berkas_ijasah_all());
	}
  else{
      if($mode=='simpan'){
				$status_pengajuan=$this->m_umum->ambil_data('s_pengajuan','barcode_pengajuan',$data['id']);
				$id_ijasahe = $status_pengajuan['id_ijasah'];
				$id_pengajuan = $status_pengajuan['id_pengajuan'];
			//	$this->m_ol_pengajuan->simpan_berkas_ijasah($id_pengajuan,$data['idb'],$id_ijasahe);
				redirect(base_url('pengajuan/pengajuan_kompetensi/isi/'.$data['id']));
      }
	}
  }
  function berkas_sertifikat($mode='view')
  {
	$data['page']  = "berkas_sertifikat";
	$data['header'] = "AMBIL BERKAS PELATIHAN / SERTIFIKAT";
	$data['title'] = "AMBIL BERKAS PELATIHAN / SERTIFIKAT";
		$data['link_kembali'] = base_url('logbook');
		$data['link_awal'] = base_url('');
		$data['nama_pk'] = "PK";
		$data['nama'] = "NAMA NAKES";
		$data['level'] = "Perawat Madya";
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','5');
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
		$data['id']  = $this->uri->segment(4, 0);
		$data['idb']  = $this->uri->segment(5, 0);
		$data['link_kembali'] = base_url('s_pengajuan/pengajuan_kompetensi/isi/'.$data['id']);
		$pengajuan = $this->m_umum->ambil_data('s_pengajuan','barcode_pengajuan',$data['id']);
		$data['id_pengajuan'] = $pengajuan["id_pengajuan"];
    if($mode=='view'){
		$this->tampil_top($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_sample->berkas_pelatihan_all());
	}
  else{
      if($mode=='simpan'){
				$status_pengajuan=$this->m_umum->ambil_data('s_pengajuan','barcode_pengajuan',$data['id']);
				$id_ijasahe = $status_pengajuan['id_sertifikat'];
				$id_pengajuan = $status_pengajuan['id_pengajuan'];
			//	$this->m_ol_pengajuan->simpan_berkas_sertifikat($id_pengajuan,$data['idb'],$id_ijasahe);
				redirect(base_url('s_pengajuan/pengajuan_kompetensi/isi/'.$data['id']));
      }
	}
  }
  function berkas_str($mode='view')
  {
	$data['page']  = "berkas_str";
	$data['header'] = "AMBIL BERKAS SURAT IJIN";
	$data['title'] = "AMBIL BERKAS SURAT IJIN";
		$data['link_kembali'] = base_url('logbook');
		$data['link_awal'] = base_url('');
		$data['nama_pk'] = "PK";
		$data['nama'] = "NAMA NAKES";
		$data['level'] = "Perawat Madya";
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','5');
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
		$data['id']  = $this->uri->segment(4, 0);
		$data['idb']  = $this->uri->segment(5, 0);
		$data['link_kembali'] = base_url('s_pengajuan/pengajuan_kompetensi/isi/'.$data['id']);
		$pengajuan = $this->m_umum->ambil_data('s_pengajuan','barcode_pengajuan',$data['id']);
		$data['id_pengajuan'] = $pengajuan["id_pengajuan"];
    if($mode=='view'){
		$this->tampil_top($data);
	}
  else if($mode=='data'){
		echo json_encode($this->m_sample->berkas_str_all());
	}
  else{
      if($mode=='simpan'){
				$status_pengajuan=$this->m_umum->ambil_data('s_pengajuan','barcode_pengajuan',$data['id']);
				$id_ijasahe = $status_pengajuan['id_str'];
				$id_pengajuan = $status_pengajuan['id_pengajuan'];
		//		$this->m_ol_pengajuan->simpan_berkas_str($id_pengajuan,$data['idb'],$id_ijasahe);
				redirect(base_url('s_pengajuan/pengajuan_kompetensi/isi/'.$data['id']));
			}
  	}
	}
  function berkaslain_berkas($mode='view')
  {
	$data['page']  = "berkaslain_berkas";
	$data['header'] = "AMBIL BERKAS UMUM";
	$data['title'] = "AMBIL BERKAS UMUM";
		$data['link_kembali'] = base_url('logbook');
		$data['link_awal'] = base_url('');
		$data['nama_pk'] = "PK";
		$data['nama'] = "NAMA NAKES";
		$data['level'] = "Perawat Madya";
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','5');
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
		$data['id']  = $this->uri->segment(4, 0);
		$data['idb']  = $this->uri->segment(5, 0);
		$data['link_kembali'] = base_url('s_pengajuan/pengajuan_kompetensi/isi/'.$data['id']);
		$pengajuan = $this->m_umum->ambil_data('s_pengajuan','barcode_pengajuan',$data['id']);
		$data['id_pengajuan'] = $pengajuan["id_pengajuan"];
    if($mode=='view'){
		$this->tampil_top($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_sample->berkas_pribadi_all());
	}
  else{
      if($mode=='simpan'){
				$status_pengajuan=$this->m_umum->ambil_data('s_pengajuan','barcode_pengajuan',$data['id']);
				$id_ijasahe = $status_pengajuan['id_berkas'];
				$id_pengajuan = $status_pengajuan['id_pengajuan'];
			//	$this->m_ol_pengajuan->simpan_berkaslain_berkas($id_pengajuan,$data['idb'],$id_ijasahe);
				redirect(base_url('s_pengajuan/pengajuan_kompetensi/isi/'.$data['id']));
      }
	}
  }
  function berkas_etik($mode='view')
  {
	$data['page']  = "berkas_etik";
	$data['header'] = "AMBIL BERKAS ETIK PEGAWAI";
	$data['title'] = "AMBIL BERKAS ETIK PEGAWAI";
		$data['link_kembali'] = base_url('logbook');
		$data['link_awal'] = base_url('');
		$data['nama_pk'] = "PK";
		$data['nama'] = "NAMA NAKES";
		$data['level'] = "Perawat Madya";
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','5');
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
		$data['id']  = $this->uri->segment(4, 0);
		$data['idb']  = $this->uri->segment(5, 0);
		$data['link_kembali'] = base_url('s_pengajuan/pengajuan_kompetensi/isi/'.$data['id']);
		$pengajuan = $this->m_umum->ambil_data('s_pengajuan','barcode_pengajuan',$data['id']);
		$data['id_pengajuan'] = $pengajuan["id_pengajuan"];
    if($mode=='view'){
		$this->tampil_top($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_sample->etik_pegawai_all());
	}
  else{
      if($mode=='simpan'){
				$status_pengajuan=$this->m_umum->ambil_data('s_pengajuan','barcode_pengajuan',$data['id']);
				$id_ijasahe = $status_pengajuan['id_etik_pegawai'];
				$id_pengajuan = $status_pengajuan['id_pengajuan'];
		//		$this->m_ol_pengajuan->simpan_berkas_etik($id_pengajuan,$data['idb'],$id_ijasahe);
				redirect(base_url('s_pengajuan/pengajuan_kompetensi/isi/'.$data['id']));
      }
	}
  }
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("s_pengajuan/header",$data);
	$this->load->view("s_pengajuan/isi");
	$this->load->view("footer");
	$this->load->view("s_pengajuan/jsload");
	$this->load->view("s_pengajuan/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_landing",$data);
	$this->load->view("s_pengajuan/isi");
	$this->load->view("footer");
	$this->load->view("s_pengajuan/jsload");
	$this->load->view("s_pengajuan/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
