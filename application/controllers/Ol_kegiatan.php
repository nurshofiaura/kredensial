<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Ol_kegiatan extends CI_controller
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
		$this->list_kegiatan();
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
  function list_kegiatan($mode='view')
  {
	$data['page']  = "list_kegiatan";
	$data['header'] = "DAFTAR PILIHAN KEWENANGAN PEGAWAI TERTOLAK";
	$data['title'] = "DAFTAR PILIHAN KEWENANGAN PEGAWAI TERTOLAK";
		$data['multi_level'] = $this->m_ol_rancak->ambil_data_link_pengurus($this->session->id_pegawai);
		$data['multi_struktur'] = $this->m_ol_rancak->ambil_data_link_struktur($this->session->id_pegawai);
		$data['ol_akses'] = $this->m_ol_rancak->ol_akses($this->session->id_pegawai);
		$data['ambil_data_a_online'] = $this->m_ol_rancak->ambil_data_a_online();
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
	$data['id2'] = $this->uri->segment(5, 0);
  if($mode=='view'){
		$this->tampil($data);
	}
  else if($mode=='data'){
		echo json_encode($this->m_ol_pemulihan->logbook_pemulihan_validasi());
	}
  else if($mode=='data2'){
		echo json_encode($this->m_ol_pemulihan->logbook_kegiatan_pemulihan($data['id']));
	}
	else{
    if($mode=='isi'){
      $data['page'] =  $data['page']."_isi";
      $aktivitas = $this->m_umum->ambil_data('ol_logbook_pemulihan','barcode_logbook_pemulihan',$data['id']);
      $data['ambil_lobook_pemulihan_detile']=$this->m_ol_rancak->ambil_lobook_pemulihan_detile($aktivitas['id_logbook_pemulihan']);
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
				$data['cmd_result'] = array('0'=>'Registrasi','1'=>'Proses','2'=>'Selesai'); 
				$data['cmd_kompeten'] = $this->m_rancak->cmd_kompeten(); 
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
      $data['status_pemulihan']  = set_value('status_pemulihan',$aktivitas["status_pemulihan"]);
      $data['catatan_pemulihan']  = set_value('catatan_pemulihan',$aktivitas["catatan_pemulihan"]);
      $this->form_validation->set_rules('id_logbook_pemulihan','id_logbook_pemulihan','required');
      if ($this->form_validation->run() === FALSE){
        $this->tampil($data);
      }else{
        $barcode_logbook_pemulihan = $this->input->post('barcode_logbook_pemulihan');
          $this->m_ol_pemulihan->edit_status_pemulihan();
          $this->session->set_flashdata('sukses', 'Status Sudah Di Rubah');
        	redirect(base_url('ol_kegiatan/list_kegiatan/isi/'.$barcode_logbook_pemulihan));
      }
    }
    if($mode=='input'){
      $data['page'] =  $data['page']."_input";
      $aktivitas = $this->m_umum->ambil_data('ol_logbook_pemulihan','barcode_logbook_pemulihan',$data['id']);
      $data['id_logbook_pemulihan']  = set_value('id_logbook_pemulihan',$aktivitas["id_logbook_pemulihan"]);
      $data['id_instansi_pemulihan']  = set_value('id_instansi_pemulihan',$aktivitas["id_instansi_pemulihan"]);
      $data['id_pegawai']  = set_value('id_pegawai',$aktivitas["id_pegawai"]);
      $data['ambil_kewenangan_lobook_pemulihan_detil']=$this->m_ol_rancak->ambil_kewenangan_lobook_pemulihan_detil($aktivitas['id_pemulihan']);
      $data['cmd_pegawai']=$this->m_ol_rancak->ambil_data_etik_instansi_no_null($aktivitas["id_instansi_pemulihan"]);
      $data['result_pemulihan']  = set_value('result_pemulihan',$aktivitas['result_pemulihan']);
      $data['id_penguji']  = set_value('id_penguji',$aktivitas['id_pemulihan']);
      $data['result_kegiatan_pemulihan']  = set_value('result_kegiatan_pemulihan',$this->input->post('result_kegiatan_pemulihan'));
      $data['rm_kegiatan_pemulihan']  = set_value('rm_kegiatan_pemulihan',$this->input->post('rm_kegiatan_pemulihan'));
      $data['catatan_kegiatan_pemulihan']  = set_value('catatan_kegiatan_pemulihan',$this->input->post('catatan_kegiatan_pemulihan'));
      $data['tgl_kegiatan_pemulihan']  = set_value('tgl_kegiatan_pemulihan',date('d-m-Y'));
      $this->load->view("ol_pemulihan/isi",$data);
    }
    if($mode=='simpan_input'){
      $barcode_logbook_pemulihan= $this->input->post('barcode_logbook_pemulihan');
      $id_logbook_pemulihan= $this->input->post('id_logbook_pemulihan');
      $result_pemulihan = $this->input->post('result_pemulihan');
      if($result_pemulihan == 0){
        if($this->input->post('chk')){
    		  if(empty($id_logbook_pemulihan)){
            $this->session->set_flashdata('danger', 'Data ID Kosong');
      			redirect(base_url('ol_kegiatan/list_kegiatan/isi/'.$barcode_logbook_pemulihan));
    		  }else{
              $this->m_ol_pemulihan->simpan_logbook_kegiatan_pemulihan();
              $this->m_ol_pemulihan->edit_status_logbook_pemulihan($id_logbook_pemulihan);
              $this->session->set_flashdata('sukses', 'Data berhasil Di Tambah');
    					redirect(base_url('ol_kegiatan/list_kegiatan/isi/'.$barcode_logbook_pemulihan));
    		  }
        }
        else{
          $this->session->set_flashdata('danger', 'Tidak Ada Yang Terpilih');
          redirect(base_url('ol_kegiatan/list_kegiatan/isi/'.$barcode_logbook_pemulihan));
        }
      }else{
        $this->session->set_flashdata('danger', 'Data Sudah Dilakukan Validasi');
        redirect(base_url('ol_kegiatan/list_kegiatan/isi/'.$barcode_logbook_pemulihan));
      }
    }
    if($mode=='edit'){
      $data['page'] =  $data['page']."_edit";
      $aktivitas = $this->m_umum->ambil_data('ol_logbook_pemulihan','barcode_logbook_pemulihan',$data['id']);
      $lpd = $this->m_umum->ambil_data('ol_logbook_kegiatan_pemulihan','id_kegiatan_pemulihan',$data['id2']);
      $data['id_logbook_pemulihan']  = set_value('id_logbook_pemulihan',$aktivitas['id_logbook_pemulihan']);
      $data['result_pemulihan']  = set_value('result_pemulihan',$aktivitas['result_pemulihan']);
      $data['ambil_kewenangan_lobook_pemulihan_detil']=$this->m_ol_rancak->ambil_kewenangan_lobook_pemulihan_detil($aktivitas['id_pemulihan']);
      $data['cmd_pegawai']=$this->m_ol_rancak->ambil_data_etik_instansi_no_null($aktivitas["id_instansi_pemulihan"]);
      $data['cmd_kompeten']=$this->m_rancak->cmd_kompeten();
      $data['id_penguji']  = set_value('id_penguji',$lpd['id_penguji']);
      $data['id_kewenangan']  = set_value('id_kewenangan',$lpd['id_kewenangan']);
      $data['result_kegiatan_pemulihan']  = set_value('result_kegiatan_pemulihan',$lpd['result_kegiatan_pemulihan']);
      $data['rm_kegiatan_pemulihan']  = set_value('rm_kegiatan_pemulihan',$lpd['rm_kegiatan_pemulihan']);
      $data['catatan_kegiatan_pemulihan']  = set_value('catatan_kegiatan_pemulihan',$lpd['catatan_kegiatan_pemulihan']);
      $data['tgl_kegiatan_pemulihan']  = set_value('tgl_kegiatan_pemulihan',date('d-m-Y', strtotime($lpd['tgl_kegiatan_pemulihan'])));
      $this->load->view("ol_pemulihan/isi",$data);
    }
    if($mode=='simpan_edit'){
      $barcode_logbook_pemulihan= $this->input->post('barcode_logbook_pemulihan');
      $id_logbook_pemulihan= $this->input->post('id_logbook_pemulihan');
      $result_pemulihan = $this->input->post('result_pemulihan');
      if($result_pemulihan == 0){
        $id_kewenangan= $this->input->post('id_kewenangan');
        $tgl_kegiatan_pemulihan= $this->input->post('tgl_kegiatan_pemulihan');
  		  $tgl_kegiatan_pemulihan = date('Y-m-d', strtotime($tgl_kegiatan_pemulihan));
        $tgl_kegiatan_pemulihan_lama= $this->input->post('tgl_kegiatan_pemulihan_lama');
  		  $tgl_kegiatan_pemulihan_lama = date('Y-m-d', strtotime($tgl_kegiatan_pemulihan_lama));
        $id_kegiatan_pemulihan= $this->input->post('id_kegiatan_pemulihan');
        $this->db->select("COUNT(*) as num");
        $this->db->where('id_kewenangan',$id_kewenangan);
        $this->db->where('tgl_kegiatan_pemulihan',$tgl_kegiatan_pemulihan);
        $this->db->where('tgl_kegiatan_pemulihan !=',$tgl_kegiatan_pemulihan_lama);
        $this->db->where('id_logbook_pemulihan',$id_logbook_pemulihan);
        $q = $this->db->get('logbook_kegiatan_pemulihan')->row();
        $jml = $q->num;
        if($jml == 0){
          if($this->m_ol_pemulihan->edit_logbook_kegiatan_pemulihan()){
            $this->session->set_flashdata('sukses', 'Hasil Sudah Terupdate');
            redirect(base_url('ol_kegiatan/list_kegiatan/isi/'.$barcode_logbook_pemulihan));
          }else{
            $this->session->set_flashdata('danger', 'Masalah Penambahan Data');
            redirect(base_url('ol_kegiatan/list_kegiatan/isi/'.$barcode_logbook_pemulihan));
          }
        }else{
          $this->session->set_flashdata('danger', 'Kewenangan Sudah Ada');
          redirect(base_url('ol_kegiatan/list_kegiatan/isi/'.$barcode_logbook_pemulihan));
        }
      }else{
        $this->session->set_flashdata('danger', 'Data Sudah Dilakukan Validasi');
        redirect(base_url('ol_kegiatan/list_kegiatan/isi/'.$barcode_logbook_pemulihan));
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
