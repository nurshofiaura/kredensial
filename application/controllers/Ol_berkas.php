<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Ol_berkas extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
          $this->load->model('m_ol_rancak');
          $this->load->model('m_ol_berkas');
          $this->login_kah();
  }
  function cek_login_kah(){
  	$link_akses = $this->uri->segment(1, 0);
		$kondisi_hak=array('id_pegawai'=>$this->session->id_pegawai,'link_akses'=>$link_akses);
		$jumlah_hak_akses_pegawai=$this->m_rancak->jumlah_hak_akses_pegawai($kondisi_hak);
 		$kondisi_pegawaie=array('barcode_pegawai'=>$this->session->barcode_pegawai);
		$jml_pegawaie = $this->m_umum->jumlah_record_filter('ol_pegawai',$kondisi_pegawaie);
		if($jml_pegawaie == 0 && $jumlah_hak_akses_pegawai == 0){
			redirect(base_url('logout'));
		}else{
			return TRUE;
		}
  }
  function login_kah()
  {
      if ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==99 )
          return TRUE;
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==98 )
          return TRUE;
      else
          $this->cek_login_kah();
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
		$this->tampil($data);
	}
	function validasi($mode='view'){
		$data['page']="validasi"; 
		$data['header'] = "DATA PENGAJUAN SURAT";
		$data['title'] = "DATA PENGAJUAN SURAT";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','10');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
		$data['forpengurus_pengcab'] = $this->m_ol_rancak->ambil_data_dropdown_pengurus_pengcab($this->session->id_pegawai);
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
		$data['id2']   = $this->uri->segment(5, 0);
		if($mode=='view'){
			$this->tampil($data);
		}
		else if($mode=='data'){
			echo json_encode($this->m_ol_validasi->kor_detil_pegawai());
		}
		else{
      if($mode=='validasi'){
        $data['page'] =  $data['page']."_validasi";
				$data['ambil_berkas_data']=$this->m_ol_rancak->ambil_id_berkas_data($this->session->id_pegawai);
				$d	= $this->m_umum->ambil_data('ol_korespodensi','barcode_korespodensi',$data['id']);
				$dx	= $this->m_umum->ambil_data('ol_surat_kategori','id_kategori',$d['id_kategori']);
				$asal	= $this->m_umum->ambil_data('ol_pengcab','id_pengcab',$d['pengcab_asal']);
				$tujuan	= $this->m_umum->ambil_data('ol_pengcab','id_pengcab',$d['pengcab_tujuan']);
				$pengirime	= $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$d['id_pengirim']);
				$data['cmd_validasi']  = array('0'=>'Pilih Validasi','1'=>'ACC','2'=>'Tolak');
				$data['foto_pengaju']  = set_value('foto_pengaju',$pengirime["foto"]);
				$data['nama_pengaju']  = set_value('nama_pengaju',$pengirime["nama_pegawai"]);
				$data['nama_asal']  = set_value('nama_asal',$asal["nama_pengcab"]);
				$data['nama_tujuan']  = set_value('nama_tujuan',$tujuan["nama_pengcab"]);
				$data['nama_kategori']  = set_value('nama_kategori',$dx["nama_kategori"]);
				$data['syarat_kategori']  = set_value('syarat_kategori',$dx["syarat_kategori"]);
				$data['id_korespodensi']  = set_value('id_korespodensi',$d["id_korespodensi"]);
				$data['id_kategori']  = set_value('id_kategori',$d["id_kategori"]);
				$data['barcode_korespodensi']  = set_value('barcode_korespodensi',$d["barcode_korespodensi"]);
				$data['wkt_korespodensi']  = date('d-m-Y H:i:s', strtotime($d["wkt_korespodensi"]));
				$data['no_korespodensi']  = set_value('no_korespodensi',$d["no_korespodensi"]);
				$data['sifat_surat']  = set_value('sifat_surat',$d["sifat_surat"]);
				$data['status_korespodensi']  = set_value('status_korespodensi',$d["status_korespodensi"]);
				$data['id_kategori']  = set_value('id_kategori',$d["id_kategori"]);
				$data['id_berkas']  = explode(",", $d["id_berkas"]);
				$data['berkas']  = $d["id_berkas"];
				$data['id_ijasah']  = explode(",", $d["id_ijasah"]);
				$data['ijasah']  = $d["id_ijasah"];
				$data['id_str']  = explode(",", $d["id_str"]);
				$data['str']  = $d["id_str"];
				$data['id_sertifikat']  = explode(",", $d["id_sertifikat"]);
				$data['sertifikat']  = $d["id_sertifikat"];
				$explodettd = $this->m_umum->ambil_data('ol_surat_kategori','id_kategori',$d["id_kategori"]);
				$data['ttd_kategori']  = $explodettd["ttd_kategori"];
				$this->form_validation->set_rules('no_korespodensi','no_korespodensi','required');
				if ($this->form_validation->run() === FALSE){
						   $this->tampil($data);
				}else{
					$this->m_ol_administrator->rubah_data_surat_korespodensi();
					$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
					redirect(base_url('ol_administrator/pengajuan_korespodensi/validasi/'.$data['id']));
				}
	  	}
 			if($mode=='acctolak'){
      	$d	= $this->m_umum->ambil_data('ol_kor_detil','id_kor_detil',$data['id2']);
      	$dx	= $this->m_umum->ambil_data('ol_korespodensi','id_korespodensi',$d['id_korespodensi']);
      	$barcode_korespodensi = $dx['barcode_korespodensi'];
      	$status_korespodensi = $dx['status_korespodensi'];
      	if($status_korespodensi == 2){
				  if($this->m_ol_validasi->rubah_acc_kor_detil($data['id'],$d['id_kor_detil'])){
						$this->session->set_flashdata('sukses', 'Data Sudah Di Rubah');
						redirect(base_url('ol_validasi/validasi/validasi/'.$barcode_korespodensi));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Masalah Rubah Data. Hubungi Admin');
						redirect(base_url('ol_validasi/validasi/validasi/'.$barcode_korespodensi));
				  }
				}else{
					$this->session->set_flashdata('danger', 'Status Data Bukan Validasi');
					redirect(base_url('ol_validasi/validasi/validasi/'.$barcode_korespodensi));
				}
			}
		}
	}
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("ol_validasi/header",$data);
	$this->load->view("ol_validasi/isi");
	$this->load->view("footer");
	$this->load->view("ol_validasi/jsload");
	$this->load->view("ol_validasi/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_top",$data);
	$this->load->view("ol_validasi/isi");
	$this->load->view("footer");
	$this->load->view("ol_validasi/jsload");
	$this->load->view("ol_validasi/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
