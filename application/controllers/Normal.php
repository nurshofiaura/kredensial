<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Normal extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
      parent::__construct();
		  $this->login_kah();
      $this->load->model('m_normal');
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
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==14 ) //administrator radiologi
          return TRUE;
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==22 ) //Radiologi
          return TRUE;
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==26 ) //Admin Radiologi
          return TRUE;
     else
          redirect(base_url('logout'));
  }
  function radiologi_kah()
  {
      if ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==99 )
          return TRUE;
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==14 ) //administrator radiologi
          return TRUE;
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==22 ) //Radiologi
          return TRUE;
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==26 ) //Admin Radiologi
          return TRUE;
     else
          redirect(base_url('logout'));
  }
  function index(){
    $data['page']="home";
  	$data['header'] = "BERANDA";
  	$data['title'] = "BERANDA";
    $data['link_kembali'] = base_url();
  	$data['link_awal'] = base_url('normal');
  	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
  	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
    $program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
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
  function format_radiologi($mode='view')
  {
    $data['page']  = "format_radiologi";
    $this->radiologi_kah();
  	$data['header'] = "BACAAN HASIL NORMAL RADIOLOGI";
  	$data['title'] = "BACAAN HASIL NORMAL RADIOLOGI";
    $data['link_kembali'] = base_url();
  	$data['link_awal'] = base_url('normal/format_radiologi');
  	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
  	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
    $program = $this->m_umum->ambil_data('a_program','id_program','6'); //struktur jabatan normal
    $dokter = $this->m_umum->ambil_data('a_program','id_program','7'); // dokter
  	$data['struktur_jabatan_id'] = $program["struktur_jabatan"];
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
    $data['id']   = $this->uri->segment(4, 0);
    if($mode=='view'){
  	     $this->tampil($data);
  	}
    else if($mode=='data'){
  		echo json_encode($this->m_normal->normal_all($program["struktur_jabatan"]));
  	}
    else{
      $data['cmd_tindakan']   = $this->m_rancak->cmd_tindakan($pegawai['id_jabatan']);
  		$data['cmd_spesialis']   = $this->m_rancak->cmd_radiolog($dokter['struktur_jabatan'],$dokter['ruangan']);
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
    		$data['nama_normal']  = set_value('nama_normal',$this->input->post("nama_normal"));
    		$data['id_tindakan']  = set_value('id_tindakan',$this->input->post("id_tindakan"));
    		$data['id_pegawai']  = set_value('id_pegawai',$this->input->post("id_pegawai"));
    		$data['hasil_normal']  = set_value('hasil_normal',$this->input->post("hasil_normal"));
    		$data['kesimpulan_normal']  = set_value('kesimpulan_normal',$this->input->post("kesimpulan_normal"));
    		$this->form_validation->set_rules('nama_normal','nama_normal','required');
        if ($this->form_validation->run() === FALSE){
    			$this->tampil($data);
        }else{
    			$nama_normal = $this->input->post('nama_normal');
    			$id_pegawai = $this->input->post('id_pegawai');
    			$id_tindakan = $this->input->post('id_tindakan');
    			$kondisi=array('nama_normal'=>$nama_normal,'id_pegawai'=>$id_pegawai,'id_tindakan'=>$id_tindakan);
    			$jml = $this->m_umum->jumlah_record_filter('kol_normal',$kondisi);
    			if($jml == 0){
    			  if($this->m_normal->simpan_normal()){
    				$this->session->set_flashdata('sukses', 'Data berhasil Di Tambah');
    				redirect(base_url('normal/format_radiologi'));
    			  }else{
    				  $this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data');
    				redirect(base_url('normal/format_radiologi'));
    			  }
    			}else{
    					$this->session->set_flashdata('danger', 'Nama Format Sudah Ada');
    					redirect(base_url('normal/format_radiologi'));
    			}
        }
  	}
    if($mode=='edit'){
      $data['page'] =  $data['page']."_edit";
      $d = $this->m_umum->ambil_data('kol_normal','id_normal',$data['id']);
      $data['nama_normal'] = set_value('nama_normal',$d["nama_normal"]);
      $data['id_tindakan'] = set_value('id_tindakan',$d["id_tindakan"]);
      $data['id_pegawai'] = set_value('id_pegawai',$d["id_pegawai"]);
      $data['hasil_normal'] = set_value('hasil_normal',$d["hasil_normal"]);
      $data['kesimpulan_normal'] = set_value('kesimpulan_normal',$d["kesimpulan_normal"]);
      $this->form_validation->set_rules('nama_normal','nama_normal','required');
          if ($this->form_validation->run() === FALSE){
        $this->tampil($data);
          }else{
        $nama_normal = $this->input->post('nama_normal');
        $id_pegawai = $this->input->post('id_pegawai');
        $id_tindakan = $this->input->post('id_tindakan');
        $nama_normal_lama = $this->input->post('nama_normal_lama');
        $kondisi=array('nama_normal'=>$nama_normal,'id_pegawai'=>$id_pegawai,'id_tindakan'=>$id_tindakan,'nama_normal !='=>$nama_normal_lama);
        $jml = $this->m_umum->jumlah_record_filter('kol_normal',$kondisi);
        if($jml == 0){
          if($this->m_normal->edit_normal()){
          $this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
          redirect(base_url('normal/format_radiologi'));
          }else{
            $this->session->set_flashdata('danger', 'Ada Masalah Edit Data');
          redirect(base_url('normal/format_radiologi'));
          }
        }else{
          $this->session->set_flashdata('danger', 'Nama Format Sudah Ada');
          redirect(base_url('normal/format_radiologi'));
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
	$this->load->view("header_top",$data);
	$this->load->view("adminradiologi/isi");
	$this->load->view("footer");
	$this->load->view("adminradiologi/jsload");
	$this->load->view("adminradiologi/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
