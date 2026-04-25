<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Ol_admin_rs extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
          $this->load->model('m_ol_rancak');
          $this->load->model('m_ol_admin_rs');
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
/*      elseif ( $this->session->has_userdata('id_ms_struktur-1') )
          return TRUE;*/
      else
          redirect(base_url('logout'));
         // redirect(base_url('member'));
    //  $this->cek_online_kah();
  }
	function index(){
		$data['page']="home";
		$data['header'] = "BERANDA";
		$data['title'] = "BERANDA";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$data['forpengurus_pengcab'] = $this->m_ol_rancak->ambil_data_dropdown_struktur($this->session->id_pegawai);
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
		$data['urlnya']   = $this->uri->segment(2, 0);
		$data['pagenya']   = $this->uri->segment(3, 0);
		$data['id']   = $this->uri->segment(4, 0);
		$pengcabmana = $this->m_umum->ambil_data('ol_pengcab','barcode_pengcab',$data['id']);
		$whats = $this->m_umum->ambil_data('ol_whatsnew','id_whatsnew',1);
		$data['isi_whatsnew']   = $whats['isi_whatsnew'];
		$data['id2']   = $this->uri->segment(5, 0);
		$data['pengcab_id'] = $pengcabmana['id_pengcab'];
		$data['pengcab_name'] = $pengcabmana['nama_pengcab'];
		$data['ambil_data_pengurus_4_pengumuman'] = $this->m_ol_rancak->ambil_data_pengurus_4_pengumuman($this->session->id_pegawai);
		$data['id_pegawai_pengurus']  = set_value('id_pegawai_pengurus',$this->input->post("id_pegawai_pengurus"));
/*		$ole = $this->m_ol_rancak->ambil_data_dropdown_struktur($this->session->id_pegawai);
		$arr = array();
		foreach($ole as $val){
				$arr[] = $val['id_instansi'];
		}
		$eimplo = implode(",", $arr);*/
		$data['ambil_pengumuman'] = $this->m_ol_rancak->ambil_pengumuman($this->session->list_instansi);
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
		  if($this->m_ol_administrator->simpan_pengumuman($program['jabatan'],$pegawai['id_level'])){
			redirect(base_url('ol_administrator'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Input Data. Hubungi Admin');
			redirect(base_url('ol_administrator'));
		  }
		}
	}
  function kab_data($id)
  {
    $dt=$this->m_rancak->ambil_data_dropdown_kab($id);
    echo json_encode($dt);
  }
  function kec_data($id)
  {
    $dt=$this->m_rancak->ambil_data_dropdown_kec($id);
    echo json_encode($dt);
  }
  function kel_data($id)
  {
    $dt=$this->m_rancak->ambil_data_dropdown_kel($id);
    echo json_encode($dt);
  }
	function instansi($mode='view'){
		$data['page']="instansi"; 
		$data['header'] = "DATA INSTANSI";
		$data['title'] = "DATA INSTANSI";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
		$data['forpengurus_pengcab'] = $this->m_ol_rancak->ambil_data_dropdown_struktur($this->session->id_pegawai);
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
		$data['ambil_data_pengcab'] = $this->m_ol_rancak->ambil_data_dropdown_pengurus_pengcab($this->session->id_pegawai);
		if($mode=='view'){
			$this->tampil($data);
		}
		else if($mode=='data'){
			echo json_encode($this->m_ol_admin_rs->instansi_all($this->session->list_instansi));
		}
		else{
			  $data['kol_provinsi'] = $this->m_rancak->cmd_kol_provinsi();
			if($mode=='edit'){
				$data['page'] =  $data['page']."_edit";
					$take = $this->m_umum->ambil_data('kol_working','barcode_working',$data['id']);		
					$data['id_working']  = set_value('id_working',$take['id_working']);
					$data['nama_working']  = set_value('nama_working',$take['nama_working']);
					$data['alamat_working']  = set_value('alamat_working',$take['alamat_working']);
					$data['email_working']  = set_value('email_working',$take['email_working']);
					$data['kontak_working']  = set_value('kontak_working',$take['kontak_working']);
					$data['id_prov']  = set_value('id_prov',$take['id_prov']);		
					$data['id_kab']  = set_value('id_kab',$take['id_kab']);			
					$data['id_kec']  = set_value('id_kec',$take['id_kec']);			
					$data['id_kel']  = set_value('id_kel',$take['id_kel']);			
					$data['kab'] = $this->m_ol_rancak->ambil_data_dropdown_kab($take['id_prov']);
					$data['kec'] = $this->m_ol_rancak->ambil_data_dropdown_kec($take['id_kab']);
					$data['kel'] = $this->m_ol_rancak->ambil_data_dropdown_kel($take['id_kec']);
					$this->form_validation->set_rules('nama_working','nama_working','required');
				if ($this->form_validation->run() === FALSE){
					$this->tampil($data);
				}else{
				$data = array();
				$filesCount = count($_FILES['upload_Files']['name']);
				$wa = $this->input->post('wa');
					for($i = 0; $i < $filesCount; $i++){
						$_FILES['upload_File']['name'] = $_FILES['upload_Files']['name'][$i];
						$_FILES['upload_File']['type'] = $_FILES['upload_Files']['type'][$i];
						$_FILES['upload_File']['tmp_name'] = $_FILES['upload_Files']['tmp_name'][$i];
						$_FILES['upload_File']['error'] = $_FILES['upload_Files']['error'][$i];
						$_FILES['upload_File']['size'] = $_FILES['upload_Files']['size'][$i];
						$uploadPath = 'assets/berkas/kop/';
						$config['upload_path'] = $uploadPath;
						$config['allowed_types'] = 'gif|jpg|jpeg|png';
						$config['encrypt_name'] = TRUE;
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if($this->upload->do_upload('upload_File')){
							$fileData = $this->upload->data();
							$this->m_ol_admin_rs->edit_kol_working($fileData['file_name']);
							$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
							redirect(base_url('ol_admin_rs/instansi'));
						}else{
							$nole = '';
							$this->m_ol_admin_rs->edit_kol_working($nole);
							$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
							redirect(base_url('ol_admin_rs/instansi'));
						}
					}
				}
			}
			if($mode=='edit_stempel'){
				$data['page'] =  $data['page']."_edit_stempel";
					$take = $this->m_umum->ambil_data('kol_working','barcode_working',$data['id']);		
					$data['id_working']  = set_value('id_working',$take['id_working']);
					$data['nama_working']  = set_value('nama_working',$take['nama_working']);
					$data['alamat_working']  = set_value('alamat_working',$take['alamat_working']);
					$data['email_working']  = set_value('email_working',$take['email_working']);
					$data['kontak_working']  = set_value('kontak_working',$take['kontak_working']);
					$data['id_prov']  = set_value('id_prov',$take['id_prov']);		
					$data['id_kab']  = set_value('id_kab',$take['id_kab']);			
					$data['id_kec']  = set_value('id_kec',$take['id_kec']);			
					$data['id_kel']  = set_value('id_kel',$take['id_kel']);			
					$data['kab'] = $this->m_ol_rancak->ambil_data_dropdown_kab($take['id_prov']);
					$data['kec'] = $this->m_ol_rancak->ambil_data_dropdown_kec($take['id_kab']);
					$data['kel'] = $this->m_ol_rancak->ambil_data_dropdown_kel($take['id_kec']);
					$this->form_validation->set_rules('nama_working','nama_working','required');
				if ($this->form_validation->run() === FALSE){
					$this->tampil($data);
				}else{
				$data = array();
				$filesCount = count($_FILES['upload_Files']['name']);
				$wa = $this->input->post('wa');
					for($i = 0; $i < $filesCount; $i++){
						$_FILES['upload_File']['name'] = $_FILES['upload_Files']['name'][$i];
						$_FILES['upload_File']['type'] = $_FILES['upload_Files']['type'][$i];
						$_FILES['upload_File']['tmp_name'] = $_FILES['upload_Files']['tmp_name'][$i];
						$_FILES['upload_File']['error'] = $_FILES['upload_Files']['error'][$i];
						$_FILES['upload_File']['size'] = $_FILES['upload_Files']['size'][$i];
						$uploadPath = 'assets/berkas/kop/';
						$config['upload_path'] = $uploadPath;
						$config['allowed_types'] = 'gif|jpg|jpeg|png';
						$config['encrypt_name'] = TRUE;
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if($this->upload->do_upload('upload_File')){
							$fileData = $this->upload->data();
							$this->m_ol_admin_rs->edit_stkol_working($fileData['file_name']);
							$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
							redirect(base_url('ol_admin_rs/instansi'));
						}else{
							$nole = '';
							$this->m_ol_admin_rs->edit_stkol_working($nole);
							$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
							redirect(base_url('ol_admin_rs/instansi'));
						}
					}
				}
			}
		}
	}
  function format_validator($mode='view')
  {
		$data['page']  = "format_validator";
		$data['header'] = "FORMAT VALIDATOR KREDENSIAL PERINSTANSI";
		$data['title'] = "FORMAT VALIDATOR KREDENSIAL PERINSTANSI";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
		$data['forpengurus_pengcab'] = $this->m_ol_rancak->ambil_data_dropdown_struktur($this->session->id_pegawai);
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
		$data['int']   = $this->uri->segment(5, 0);
		$data['id']   = $this->uri->segment(4, 0);
		$data['ambil_data_rujukan_working_null']=$this->m_ol_rancak->ambil_data_rujukan_working($this->session->list_instansi);
		$data['ambil_data_ms_struktur_no_syarat']=$this->m_ol_rancak->ambil_data_ms_struktur_no_syarat();
		$data['ambil_data_rujukan_working']=$this->m_ol_rancak->ambil_data_rujukan_working();
		$data['status_diusulkan_all']=$this->m_rancak->status_diusulkan_all();
		$data['cmd_jabatan_null']=$this->m_rancak->cmd_jabatan_null();
		$data['cmd_status']=$this->m_rancak->cmd_status();
		$data['cmd_ya_tidak']=$this->m_rancak->cmd_ya_tidak();
	  if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$id = $this->input->post("id");
				redirect(base_url('ol_admin_rs/format_validator/view/'.$id));
			}
		}
    else if($mode=='data'){
			echo json_encode($this->m_ol_admin_rs->pengajuan_format_rs($data['id']));
		}
		else{
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		$data['status_pengajuan_format_rs']  = set_value('status_pengajuan_format_rs',$this->input->post('status_pengajuan_format_rs'));
		$data['id_status_diusulkan']  = set_value('id_status_diusulkan',$this->input->post('id_status_diusulkan'));
		$data['id_instansi']  = set_value('id_instansi',$this->input->post('id_instansi'));
		$data['id_jabatan']  = set_value('id_jabatan',$this->input->post('id_jabatan'));
		$data['kunci']  = set_value('kunci',$this->input->post('kunci'));
			$this->load->view("ol_admin_rs/isi",$data);
      }
      if($mode=='simpan_tambah'){
				$id_instansi = $this->input->post('id_instansi');
				$id_jabatan = $this->input->post('id_jabatan');
				$id_status_diusulkan = $this->input->post('id_status_diusulkan');
				$kondisi=array('id_instansi'=>$id_instansi,'id_jabatan'=>$id_jabatan,'id_status_diusulkan'=>$id_status_diusulkan);
				$jml = $this->m_umum->jumlah_record_filter('ol_pengajuan_format_rs',$kondisi);
				if($jml == 0){
				 		 $this->m_ol_admin_rs->simpan_ol_pengajuan_format_rs();
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('ol_admin_rs/format_validator'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('ol_pengajuan_format_rs','id_pengajuan_format_rs',$data['id']);
				$data['id_pengajuan_format_rs']  = set_value('id_pengajuan_format_rs',$keuangan["id_pengajuan_format_rs"]);
				$data['id_instansi']  = set_value('id_instansi',$keuangan["id_instansi"]);
				$data['ms_struktur']  = $keuangan["ms_struktur"];
				$data['id_status_diusulkan']  = set_value('id_status_diusulkan',$keuangan["id_status_diusulkan"]);
				$data['id_jabatan']  = set_value('id_jabatan',$keuangan["id_jabatan"]);
				$data['kunci']  = set_value('kunci',$keuangan["kunci"]);
				$data['status_pengajuan_format_rs']  = set_value('status_pengajuan_format_rs',$keuangan["status_pengajuan_format_rs"]);
    		$this->load->view("ol_admin_rs/isi",$data);
      }
      if($mode=='simpan_edit'){
				$id_instansi = $this->input->post('id_instansi');
				$id_status_diusulkan = $this->input->post('id_status_diusulkan');
				$id_jabatan = $this->input->post('id_jabatan');
				$id_instansi_lama = $this->input->post('id_instansi_lama');
				$id_status_diusulkan_lama = $this->input->post('id_status_diusulkan_lama');
				$id_jabatan_lama = $this->input->post('id_jabatan_lama');
				$kondisi=array('id_instansi'=>$id_instansi,'id_status_diusulkan'=>$id_status_diusulkan,'id_instansi !='=>$id_instansi_lama,'id_status_diusulkan !='=>$id_status_diusulkan_lama,'id_jabatan'=>$id_jabatan,'id_jabatan !='=>$id_jabatan_lama);
				$jml = $this->m_umum->jumlah_record_filter('ol_pengajuan_format_rs',$kondisi);
				if($jml == 0){
				 		 $this->m_ol_admin_rs->edit_ol_pengajuan_format_rs();
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('ol_admin_rs/format_validator'));
			  }
      }
		}
  }
	function struktur($mode='view'){
		$data['page']="struktur"; 
		$data['header'] = "DATA STRUKTUR INSTANSI";
		$data['title'] = "DATA STRUKTUR INSTANSI";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
		$data['forpengurus_pengcab'] = $this->m_ol_rancak->ambil_data_dropdown_struktur($this->session->id_pegawai);
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
			echo json_encode($this->m_ol_admin_rs->struktur_all($this->session->list_instansi));
		}
		else{
			$data['ambil_data_rujukan_kab_working'] = $this->m_ol_rancak->ambil_data_rujukan_working($this->session->list_instansi);
			$data['ambil_data_ms_struktur_no_syarat'] = $this->m_ol_rancak->ambil_data_ms_struktur_no_admin_syarat();
			$data['ambil_data_ms_struktur_no_syarat_no_null'] = $this->m_ol_rancak->ambil_data_ms_struktur_no_admin_syarat_no_null();
			$data['cmd_status'] = $this->m_rancak->cmd_status();
		  if($mode=='tambah'){
				$data['page'] =  $data['page']."_tambah";
				$data['id_working']  = set_value('id_working',$this->input->post("id_working"));
				$this->form_validation->set_rules('id_working','id_working','required');
				if ($this->form_validation->run() === FALSE){
						   $this->tampil($data);
				}else{
					$this->m_ol_admin_rs->simpan_ol_struktur();
					$this->session->set_flashdata('sukses', 'Data Sudah Di Tambah & Data Dobel Tidak Di Tambah');						
					redirect(base_url('ol_admin_rs/struktur'));
				}
			}
			if($mode=='edit'){
			  $data['page'] =  $data['page']."_edit";
				$take = $this->m_umum->ambil_data('ol_struktur','id_struktur',$data['id']);		
				$data['id_struktur']  = set_value('id_struktur',$take['id_struktur']);
				$data['id_working']  = set_value('id_working',$take['id_instansi']);
				$data['id_ms_struktur']  = set_value('id_ms_struktur',$take['id_ms_struktur']);
				$data['status_struktur']  = set_value('status_struktur',$take['status_struktur']);
				$this->load->view("ol_admin_rs/isi",$data);
			}
			if($mode=='simpan_edit'){
				$id_struktur = $this->input->post('id_struktur');
				$id_instansi = $this->input->post('id_working');
				$id_instansi_lama = $this->input->post('id_working_lama');
				$id_ms_struktur_lama = $this->input->post('id_ms_struktur_lama');
				$id_ms_struktur = $this->input->post('id_ms_struktur');
				$kondisi=array('id_instansi'=>$id_instansi,'id_ms_struktur'=>$id_ms_struktur);
				$jml = $this->m_umum->jumlah_record_filter('ol_struktur',$kondisi);
		 		$kondisi_peg=array('id_struktur'=>$id_struktur);
				$jml_peg = $this->m_umum->jumlah_record_filter('ol_pegawai_struktur',$kondisi_peg);
				if($jml == 0){
					if($jml_peg == 0){
						  if($this->m_ol_admin_rs->edit_ol_struktur()){
								$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
								redirect(base_url('ol_admin_rs/struktur'));
							}else{
								$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
								redirect(base_url('ol_admin_rs/struktur'));
							}
						}else{
							$this->session->set_flashdata('danger', 'Data Sudah Masuk Struktur Pegawai');
							redirect(base_url('ol_admin_rs/struktur'));					
						}
					}else{
							$this->session->set_flashdata('danger', 'Data Sudah Ada');
							redirect(base_url('ol_admin_rs/struktur'));					
					}
			}
		}
	}
	function pegawai_struktur($mode='view'){
		$data['page']="pegawai_struktur"; 
		$data['header'] = "DATA STRUKTUR INSTANSI / VALIDATOR";
		$data['title'] = "DATA STRUKTUR INSTANSI / VALIDATOR";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
		$data['forpengurus_pengcab'] = $this->m_ol_rancak->ambil_data_dropdown_struktur($this->session->id_pegawai);
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
		if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$id = $this->input->post("id_pengcab");
				redirect(base_url('ol_admin_rs/pegawai_pengurus/view/'.$id));
			}
		}
		else if($mode=='data'){
			echo json_encode($this->m_ol_admin_rs->pegawai_struktur_all($this->session->list_instansi));
		}
		else{
			$data['ambil_data_struktur'] = $this->m_ol_rancak->ambil_data_struktur_master_no_null($this->session->list_instansi);
			$data['ambil_data_dropdown_pegawai_instansi_no_nulls'] = $this->m_ol_rancak->ambil_data_dropdown_pegawai_instansi_no_nulls($this->session->list_instansi);
//			$data['ambil_data_dropdown_pengcab'] = $this->m_ol_rancak->ambil_data_dropdown_pengcab($this->session->id_jabatan);
			$data['ambil_data_dropdown_pegawai_no_null_instansi'] = $this->m_ol_rancak->ambil_data_dropdown_pegawai_no_null_instansi_all($this->session->list_instansi);
			$data['cmd_status'] = $this->m_rancak->cmd_status();
			if($mode=='tambah'){
				$data['page'] =  $data['page']."_tambah";
				$data['id_pegawai']  = set_value('id_pegawai',$this->input->post("id_pegawai"));
				$data['id_struktur']  = set_value('id_struktur',$this->input->post("id_struktur"));
				$this->form_validation->set_rules('id_struktur','id_struktur','required');
				if ($this->form_validation->run() === FALSE){
						   $this->tampil($data);
				}else{
					if($this->input->post('chk')){
					  $this->m_ol_admin_rs->simpan_struktur_instansi();
					  $this->session->set_flashdata('sukses', 'Data Sudah Tersimpan');
						redirect(base_url('ol_admin_rs/pegawai_struktur'));	
					}else{
						redirect(base_url('ol_admin_rs/pegawai_struktur'));	
					}										
				}
			}
      if($mode=='jabatan'){
        $data['page'] =  $data['page']."_jabatan";
        $data['cmd_jabatan_null'] = $this->m_rancak->cmd_jabatan_null();
        $data['cmd_ya_tidak'] = $this->m_rancak->cmd_ya_tidak();
				$take = $this->m_umum->ambil_data('ol_pegawai_struktur','id_pegawai_struktur',$data['id']);		
				$data['id_pegawai_struktur']  = set_value('id_pegawai_struktur',$take['id_pegawai_struktur']);
				$data['id_jabatan']  = set_value('id_jabatan',explode(",", $take['id_jabatan']));
				$data['kunci']  = set_value('kunci',$take['kunci']);
    		$this->load->view("ol_admin_rs/isi",$data);
      }
      if($mode=='simpan_jabatan'){
			  $this->m_ol_admin_rs->simpan_pegawai_struktur_jabatan();
				$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
				redirect(base_url('ol_admin_rs/pegawai_struktur'));
      }
			if($mode=='edit'){
				$data['page'] =  $data['page']."_edit";
				$take = $this->m_umum->ambil_data('ol_pegawai_struktur','barcode_pegawai_struktur',$data['id']);		
				$data['id_pegawai_struktur']  = set_value('id_pegawai_struktur',$take['id_pegawai_struktur']);
				$data['id_pegawai']  = set_value('id_pegawai',$take['id_pegawai']);
				$data['id_struktur']  = set_value('id_struktur',$take['id_struktur']);
				$data['status_pegawai_struktur']  = set_value('status_pegawai_struktur',$take['status_pegawai_struktur']);
				$this->form_validation->set_rules('barcode_pegawai_struktur','barcode_pegawai_struktur','required');
				if ($this->form_validation->run() === FALSE){
					$this->tampil($data);
				}else{				
					$id_pegawai_struktur = $this->input->post('id_pegawai_struktur');
					$id_struktur = $this->input->post('id_struktur');
					$id_pegawai = $this->input->post('id_pegawai');
					$id_pegawai_lama = $this->input->post('id_pegawai_lama');
					$id_struktur_lama = $this->input->post('id_struktur_lama');
					$barcode_pegawai_struktur = $this->input->post('barcode_pegawai_struktur');
			 		$kondisi=array('barcode_pegawai_struktur'=>$barcode_pegawai_struktur);
					$jml = $this->m_umum->jumlah_record_filter('ol_pegawai_struktur',$kondisi);
			 		$kondisi_gajuval=array('id_pegawai_struktur'=>$id_pegawai_struktur);
					$jml_gajuval = $this->m_umum->jumlah_record_filter('ol_pengajuan_validasi',$kondisi_gajuval);
			 		$kondisi_peg=array('id_pegawai_struktur'=>$id_pegawai_struktur);
					$jml_peg = $this->m_umum->jumlah_record_filter('ol_logbook_validasi',$kondisi_peg);
					$kondisi_cek=array('id_struktur'=>$id_struktur,'id_pegawai'=>$id_pegawai,'id_struktur !='=>$id_struktur_lama,'id_pegawai !='=>$id_pegawai_lama);
					$jml_cek = $this->m_umum->jumlah_record_filter('ol_pegawai_struktur',$kondisi_cek);
					if($jml == 0){							
							$this->session->set_flashdata('danger', 'Data Tidak Valid');
							redirect(base_url('ol_admin_rs/pegawai_struktur'));
					}else{
						if($jml_peg == 0){
							if($jml_gajuval == 0){
								if($jml_cek == 0){
									$data = array();
									$filesCount = count($_FILES['upload_Files']['name']);
									for($i = 0; $i < $filesCount; $i++){
										$_FILES['upload_File']['name'] = $_FILES['upload_Files']['name'][$i];
										$_FILES['upload_File']['type'] = $_FILES['upload_Files']['type'][$i];
										$_FILES['upload_File']['tmp_name'] = $_FILES['upload_Files']['tmp_name'][$i];
										$_FILES['upload_File']['error'] = $_FILES['upload_Files']['error'][$i];
										$_FILES['upload_File']['size'] = $_FILES['upload_Files']['size'][$i];
										$uploadPath = 'assets/berkas/kop/';
										$config['upload_path'] = $uploadPath;
										$config['allowed_types'] = 'gif|jpg|jpeg|png';
										$config['encrypt_name'] = TRUE;
										$this->load->library('upload', $config);
										$this->upload->initialize($config);
										if($this->upload->do_upload('upload_File')){
											$fileData = $this->upload->data();
											$this->m_ol_admin_rs->edit_pegawai_struktur();
											$this->m_ol_admin_rs->edit_ol_pegawai($fileData['file_name'],$id_pegawai);
											$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
											redirect(base_url('ol_admin_rs/pegawai_struktur'));
										}else{
											$this->m_ol_admin_rs->edit_pegawai_struktur();
											$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
											redirect(base_url('ol_admin_rs/pegawai_struktur'));
										}
									}
								}else{
									$this->session->set_flashdata('danger', 'Data Sudah Ada');
									redirect(base_url('ol_admin_rs/pegawai_struktur'));
								}
							}else{
								$this->session->set_flashdata('danger', 'Data Sudah Masuk Validasi Pengajuan');
								redirect(base_url('ol_admin_rs/pegawai_struktur'));								
							}
						}else{
							$this->session->set_flashdata('danger', 'Data Sudah Masuk Validasi Logbook');
							redirect(base_url('ol_admin_rs/pegawai_struktur'));
						}						
					}					
				}
			}
		}
	}
	function pengajuan_kompetensi($mode='view'){
		$data['page']="pengajuan_kompetensi"; 
		$data['header'] = "DATA PENGAJUAN KOMPETENSI";
		$data['title'] = "DATA PENGAJUAN KOMPETENSI";
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
		$data['id2']   = $this->uri->segment(5, 0);
		$data['id3']   = $this->uri->segment(6, 0);
		$data['isi']   = $this->uri->segment(7, 0);
		$data['tolak']   = $this->uri->segment(8, 0);
		$data['ik']   = $this->uri->segment(9, 0);
		$data['il']   = $this->uri->segment(10, 0);
		$data['ip']   = $this->uri->segment(11, 0);
		$ajfp = $this->m_ol_rancak->ambil_jabatan_from_pegstr($this->session->list_pegawai_struktur,$this->session->id_pegawai,1);
//		echo 'List jabatan : '.$ajfp['id_jabatan'];
		if(empty($data['id2'])){
			$data['id2'] = "";
		}
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
				redirect(base_url('ol_admin_rs/pengajuan_kompetensi/view/'.$key));
			}
		}
		else if($mode=='data'){
			echo json_encode($this->m_ol_admin_rs->pengajuan_kompetensi_all($this->session->list_instansi,$ajfp['id_jabatan'],$data['id']));
		}
		else if($mode=='validator'){
			echo json_encode($this->m_ol_admin_rs->seting_validator_kompetensi($data['id']));
		}
		else if($mode=='log_null'){
			echo json_encode($this->m_ol_admin_rs->logbook_null($data['id'],$data['id3']));
		}
		else if($mode=='pskompetensi'){
			echo json_encode($this->m_ol_admin_rs->pegawai_struktur_kompetensi($data['id'],$data['id2']));
		}
		else if($mode=='nkr_validator'){
			echo json_encode($this->m_ol_admin_rs->nkr_pengajuan_validator_tabel($data['id']));
		}
		else{
			if($mode=='pilih'){
			  $data['page'] =  $data['page']."_pilih";	
				$data['struktur'] = $this->m_ol_rancak->ambil_data_daftar_no_null();		
				$take = $this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$data['id']);		
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$take['barcode_pengajuan']);
				$data['id_pengajuan']  = set_value('id_pengajuan',$take['id_pengajuan']);
				$this->load->view("ol_admin_rs/isi",$data);
			}
			if($mode=='simpan_pilih'){
			  	$this->m_ol_admin_rs->simpan_pegawai_pengajuan();
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('ol_admin_rs/pengajuan_kompetensi'));
			}
			if($mode=='form'){
				$data['page'] =  $data['page']."_form";
					if(empty($data['id'])){
						redirect(base_url('ol_admin_rs/pengajuan_kompetensi'));	
					}else{
						$this->tampil($data);	
					}										
			}
			if($mode=='pilih_form'){
			  $data['page'] =  $data['page']."_pilih_form";	
				$kondisi=array('barcode_pengajuan_validator'=>$data['id']);	
				$take = $this->m_umum->ambil_data_kondisi_2tabel_row('nkr_pengajuan_validator',$kondisi,'ol_pengajuan','barcode_pengajuan');		
				$data['form'] = $this->m_ol_rancak->ambil_data_nkr_form($take['kode_unit_pengajuan'],$take['id_instansi']);	
				$data['barcode_pengajuan_validator']  = set_value('barcode_pengajuan_validator',$take['barcode_pengajuan_validator']);
				$data['id_pengajuan_validator']  = set_value('id_pengajuan_validator',$take['id_pengajuan_validator']);
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$take['barcode_pengajuan']);
				$data['status_pengajuan']  = set_value('status_pengajuan',$take['status_pengajuan']);
				$data['nkr_form']  = set_value('nkr_form',$take['nkr_form']);
				$this->load->view("ol_admin_rs/isi",$data);
			}
			if($mode=='simpan_pilih_form'){
				$status_pengajuan = $this->input->post('status_pengajuan');
				$barcode_pengajuan = $this->input->post('barcode_pengajuan');
				if($status_pengajuan == 1){
			  	$this->m_ol_admin_rs->simpan_form_pengajuan_validator();
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('ol_admin_rs/pengajuan_kompetensi/form/'.$barcode_pengajuan));					
				}else{
					$this->session->set_flashdata('danger', 'Kompetensi Sudah Selesai');
					redirect(base_url('ol_admin_rs/pengajuan_kompetensi/form/'.$barcode_pengajuan));	
				}
			}
			if($mode=='seting'){
				$data['page'] =  $data['page']."_seting";
					if(empty($data['id'])){
						redirect(base_url('ol_admin_rs/pengajuan_kompetensi'));	
					}else{
						$this->tampil($data);	
					}										
			}
      if($mode=='isi_validator'){
        $data['page'] =  $data['page']."_isi_validator";
				$data['ambil_data_working'] = $this->m_ol_rancak->ambil_data_rujukan_working_prov(); 
				$pengval = $this->m_umum->ambil_data('ol_pengajuan_validasi','barcode_pengajuan_validasi',$data['id']);
				$peng = $this->m_umum->ambil_data('ol_pengajuan','id_pengajuan',$pengval['id_pengajuan']);
				$data['barcode_pengajuan']  = $peng['barcode_pengajuan'];
				$this->tampil($data);
				$action = $this->input->post('action');
				if($action == 'BtnProses') {
					$barcode_pengajuan_validasi = $this->input->post("barcode_pengajuan_validasi");
					$barcode_working = $this->input->post("barcode_working");
					redirect(base_url('ol_admin_rs/pengajuan_kompetensi/isi_validator/'.$barcode_pengajuan_validasi.'/'.$barcode_working));
				}
      }
	    if($mode=='pelatihan_validator'){
	      $data['page'] =  $data['page']."_pelatihan_validator";
	      $data['ambil_struktur_lihat_pelatihan']  = $this->m_ol_rancak->ambil_struktur_lihat_pelatihan($data['id']);
	      $pengval = $this->m_umum->ambil_data('ol_pengajuan_validasi','barcode_pengajuan_validasi',$data['id']);
	      $peng = $this->m_umum->ambil_data('ol_pengajuan','id_pengajuan',$pengval['id_pengajuan']);
	      $data['barcode_pengajuan']  = $peng['barcode_pengajuan'];
	      $this->load->view("ol_admin_rs/isi",$data);
	    }
      if($mode=='simpan_validator'){
		  	$barcode_pengajuan_validasi = $data['id'];
		  	$barcode_pengajuan = $data['id2'];
		  	$id_pegawai_struktur = $data['id3'];
				$kondisi_pengval=array('barcode_pengajuan_validasi'=>$barcode_pengajuan_validasi);
				$jml_pengval = $this->m_umum->jumlah_record_filter('ol_pengajuan_validasi',$kondisi_pengval);
		  	if($jml_pengval == 0){
		  		$this->session->set_flashdata('danger', 'Data Tidak Valid');
		  		redirect(base_url('ol_admin_rs/pengajuan_kompetensi/seting/'.$barcode_pengajuan));
		  	}else{
		  		$peng = $this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$barcode_pengajuan);
		  		$pengval = $this->m_umum->ambil_data('ol_pengajuan_validasi','barcode_pengajuan_validasi',$barcode_pengajuan_validasi);
		  		if($peng['id_pegawai'] == $pengval['id_pegawai']){
						$this->session->set_flashdata('danger', 'Tidak Dapat Memvalidasi Diri Sendiri');
						redirect(base_url('ol_admin_rs/pengajuan_kompetensi'));
		  		}else{
$kondisi=array('barcode_pengajuan'=>$barcode_pengajuan,'id_pengajuan_validasi'=>$pengval['id_pengajuan_validasi'],'status_pengajuan'=>1,'validasi'=>0);
$jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_pengajuan_validasi',$kondisi,'ol_pengajuan','id_pengajuan');
$kondisi=array('id_pegawai_struktur'=>$id_pegawai_struktur);
$valedasi = $this->m_umum->ambil_data_kondisi('ol_pengajuan_validasi',$kondisi);
					if($jml == 0){
			  		$this->session->set_flashdata('danger', 'Cek Validasi, Mungkin Bukan Proses');
			  		redirect(base_url('ol_admin_rs/pengajuan_kompetensi'));							
					}else{
						if($valedasi == 0){
							$this->m_ol_admin_rs->rubah_plan_pengajuan_validasi($barcode_pengajuan_validasi,$id_pegawai_struktur);
							$this->session->set_flashdata('sukses', 'Data Sudah Di Simpan');
							redirect(base_url('ol_admin_rs/pengajuan_kompetensi/seting/'.$barcode_pengajuan));
						}else{
			  		$this->session->set_flashdata('danger', 'Sudah Tercatat Validasinya');
			  		redirect(base_url('ol_admin_rs/pengajuan_kompetensi'));								
						}
					}
		  		}
		  	}
      }
      if($mode=='lihat'){
        $data['page'] =  $data['page']."_lihat";
if(empty($data['id']) || empty($data['id2']) || empty($data['id3'])){
		$this->session->set_flashdata('danger', 'Data Tidak Valid');
		redirect(base_url('ol_admin_rs/pengajuan_kompetensi'));
}else{
	$data['link_kembali'] = base_url('ol_admin_rs/pengajuan_kompetensi/seting/'.$data['id']);
	$cek_status = $this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$data['id']);
  $struktur = $this->m_umum->ambil_data('ol_pegawai_struktur','barcode_pegawai_struktur',$data['id3']);
  $pangvalid = $this->m_umum->ambil_data('ol_pengajuan_validasi','barcode_pengajuan_validasi',$data['id2']);
				$data['ambil_berkas_data']=$this->m_ol_rancak->ambil_id_berkas_data($cek_status['id_pegawai']);
				$pengajuane=$this->m_ol_rancak->ambil_pengajuan_validasi($data['id2']);
				$data['foto']  = set_value('foto_pengaju',$pengajuane["foto"]);
				$data['nama_pegawai']  = set_value('nama_pegawai',$pengajuane["nama_pegawai"]);
				$data['id_pegawai']  = set_value('id_pegawai',$pengajuane["id_pegawai"]);
				$data['id_instansi']  = set_value('id_instansi',$pengajuane["id_instansi"]);
				$data['jk']  = set_value('jk',$pengajuane["jk"]);
				$data['tgl_lahir']  = set_value('tgl_lahir', date('d-m-Y',strtotime($pengajuane["tgl_lahir"])));
				$data['tmp_lahir']  = set_value('tmp_lahir',$pengajuane["tmp_lahir"]);
				$data['umur']  = set_value('umur',$pengajuane["umur"]);
				$data['nama_status_kawin']  = set_value('nama_status_kawin',$pengajuane["nama_status_kawin"]);
				$data['nama_agama']  = set_value('nama_agama',$pengajuane["nama_agama"]);
				$data['nama_jabatan_fungsional']  = set_value('nama_jabatan_fungsional',$pengajuane["nama_jabatan_fungsional"]);
				$data['nama_status_pegawai']  = set_value('nama_status_pegawai',$pengajuane["nama_status_pegawai"]);
				$data['nip']  = set_value('nip',$pengajuane["nip"]);
				$data['nama_pendidikan']  = set_value('nama_pendidikan',$pengajuane["nama_pendidikan"]);
				$data['no_profesi']  = set_value('no_profesi',$pengajuane["no_profesi"]);
				$data['no_hp']  = set_value('no_hp',$pengajuane["no_hp"]);
				$data['email']  = set_value('email',$pengajuane["email"]);
				$data['alamat']  = set_value('alamat',$pengajuane["alamat"]);
				$data['nama_status_diusulkan']  = set_value('nama_status_diusulkan',$pengajuane["nama_status_diusulkan"]);
				$data['id_berkas']  = explode(",", $pengajuane["id_berkas"]);
				$data['berkas']  = $pengajuane["id_berkas"];
				$data['id_ijasah']  = explode(",", $pengajuane["id_ijasah"]);
				$data['ijasah']  = $pengajuane["id_ijasah"];
				$data['id_str']  = explode(",", $pengajuane["id_str"]);
				$data['str']  = $pengajuane["id_str"];
				$data['id_sertifikat']  = explode(",", $pengajuane["id_sertifikat"]);
				$data['sertifikat']  = $pengajuane["id_sertifikat"];
				$data['kesesuaian_bukti']  = explode(",", $pengajuane["kesesuaian_bukti_validasi"]);
				$data['id_etik_pegawai']  = explode(",", $pengajuane["id_etik_pegawai"]);
				$data['ambil_data_etik_pegawai_oppe'] = $this->m_ol_rancak->ambil_data_etik_pegawai_oppe($pengajuane["id_pegawai"],date('Y'));
				$data['ambil_lobook_kompetensi_group_pengajuan']=$this->m_ol_rancak->ambil_lobook_kompetensi_group_pengajuan($pengajuane["id_pengajuan"]);
				$data['ambil_lobook_validasi_group_pengajuan']=$this->m_ol_rancak->ambil_lobook_validasi_group_pengajuan($pengajuane["id_pengajuan"]);
				$this->tampil($data); 				
}
	  	}
		}
	}
	function user($mode='view'){
		$data['page']="user"; 
		$data['header'] = "DATA USER";
		$data['title'] = "DATA USER";
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
				redirect(base_url('ol_admin_rs/user/view/'.$key));
			}
		}
		else if($mode=='data'){
			echo json_encode($this->m_ol_admin_rs->member_all($this->session->list_instansi,$data['id']));
		}
		else if($mode=='tabel'){
			echo json_encode($this->m_ol_admin_rs->member_all($this->session->list_instansi,$data['id']));
		}
		else{
			$data['cmd_instansi'] = $this->m_ol_rancak->ambil_instansi_no_null();
			$data['opsi_status_perawat'] = $this->m_ol_rancak->status_perawat();
			$data['kol_kode_kewenangan_null'] = $this->m_ol_rancak->kol_kode_kewenangan_null();
			$data['cmd_tipe_pegawai'] = $this->m_ol_rancak->cmd_tipe_pegawai();
			$data['cmd_jabfung'] = $this->m_rancak->cmd_jabfung();
			$data['status'] = $this->m_rancak->cmd_status();
			$data['gender'] = $this->m_rancak->cmd_jk();
			$data['ambil_data_rujukan_instansi'] = $this->m_ol_rancak->ambil_data_rujukan_working();
			$data['cmd_unit_null'] = $this->m_rancak->struktur_jabatan_as_unit();
			$data['cmd_agama'] = $this->m_rancak->cmd_agama();
			$data['cmd_status_kawin'] = $this->m_rancak->cmd_status_kawin();
			$data['cmd_pendidikan'] = $this->m_rancak->cmd_pendidikan();
  		$data['cmd_level'] = $this->m_ol_rancak->cmd_level($program['user_level']);
  		$data['cmd_status'] = $this->m_rancak->cmd_status();
			if($mode=='edit'){
				$data['page'] =  $data['page']."_edit";
					$take = $this->m_umum->ambil_data('ol_pegawai','barcode_pegawai',$data['id']);		
					$data['nama_pegawai']  = set_value('nama_pegawai',$take['nama_pegawai']);
					$data['jk']  = set_value('jk',$take['jk']);
					$data['tmp_lahir']  = set_value('tmp_lahir',$take['tmp_lahir']);
					$data['tgl_lahir']  = set_value('tgl_lahir',date('d-m-Y', strtotime($take['tgl_lahir'])));
					$data['email']  = set_value('email',$take['email']);
					$data['no_hp']  = set_value('no_hp',$take['no_hp']);		
					$data['nik']  = set_value('nik',$take['nik']);			
					$data['tipe_pegawai']  = set_value('tipe_pegawai',$take['tipe_pegawai']);
					$data['nip']  = set_value('nip',$take['nip']);
					$data['no_profesi']  = set_value('no_profesi',$take['no_profesi']);
					$data['id_status_kawin']  = set_value('id_status_kawin',$take['id_status_kawin']);
					$data['id_agama']  = set_value('id_agama',$take['id_agama']);
					$data['id_pendidikan']  = set_value('id_pendidikan',$take['id_pendidikan']);
					$data['id_jabatan_fungsional']  = set_value('id_jabatan_fungsional',$take['id_jabatan_fungsional']);
					$data['alamat']  = set_value('alamat',$take['alamat']);
					$data['status_perawat']  = set_value('status_perawat',$take['status_perawat']);
					$data['id_kode_kewenangan']  = set_value('id_kode_kewenangan',$take['id_kode_kewenangan']);
					$data['status_pegawai']  = set_value('status_pegawai',$take['status_pegawai']);
					$data['id_pengcab']  = set_value('id_pengcab',$take['id_pengcab']);
					$data['username']  = set_value('username',$take['username']);
					$data['password_lama']  = set_value('password_lama',$take['password']);
					$datapc = $this->m_umum->ambil_data('jabatan_fungsional','id_jabatan_fungsional',$take['id_jabatan_fungsional']);
					$data['null_pengcab'] = $this->m_ol_rancak->ambil_data_pengcab($datapc['id_jabatan']);
					$data['password']  = set_value('password',$this->input->post("password"));
					$this->form_validation->set_rules('nama_pegawai','nama_pegawai','required');
				if ($this->form_validation->run() === FALSE){
					$this->tampil($data);
				}else{
					$nik = $this->input->post('nik');
					$nik_lama = $this->input->post('nik_lama');
					$kondisi=array('nik'=>$nik,'nik !='=>$nik_lama);
					$jml = $this->m_umum->jumlah_record_filter('ol_pegawai',$kondisi);
					if($jml == 0){
						if($this->m_ol_admin_rs->edit_pegawai()){
							$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
							redirect(base_url('ol_admin_rs/user'));
						}else{
							$this->session->set_flashdata('danger', 'Ada Masalah Edit Data');
							redirect(base_url('ol_admin_rs/user'));
						}
					}
					else{
						$this->session->set_flashdata('danger', 'Nomor KTP Sudah Ada');
						redirect(base_url('ol_admin_rs/user'));
					}
				}
			}
			if($mode=='reset'){
			  if($this->m_ol_admin_rs->reset_password($data['id'])){
  				$this->session->set_flashdata('sukses', 'Password di Reset menjadi 7654321');
  				redirect(base_url('ol_admin_rs/user'));
			  }else{
					$this->session->set_flashdata('danger', 'Masalah Edit Data');
					redirect(base_url('ol_admin_rs/user'));
			  }
			}
		}
	}
  function ol_akses($mode='view')
  {
		$data['page']  = "ol_akses";
		$data['header'] = "HAK AKSES TAMBAHAN";
		$data['title'] = "HAK AKSES TAMBAHAN";
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
		$data['int']   = $this->uri->segment(5, 0);
		$data['id']   = $this->uri->segment(4, 0);
	  if($mode=='view'){
			$this->tampil($data);
		}
    else if($mode=='data'){
		echo json_encode($this->m_ol_admin_rs->ol_hak_akses_all($data['id']));
		}
		else{
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
        $data['hak_akses'] = $this->m_rancak->hak_akses($data['id'],$program['akses']);
        $peg = $this->m_umum->ambil_data('ol_pegawai','barcode_pegawai',$data['id']);
        $data['id_pegawai']  = set_value('id_pegawai',$peg["id_pegawai"]);
        $data['barcode_pegawai']  = set_value('barcode_pegawai',$peg["barcode_pegawai"]);
    		$this->load->view("ol_admin_rs/isi",$data);
      }
      if($mode=='simpan_tambah'){
    		$barcode_pegawai= $this->input->post('barcode_pegawai');
			  $this->m_ol_admin_rs->ol_simpan_pegawai_akses();
				$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
				redirect(base_url('ol_admin_rs/ol_akses/view/'.$barcode_pegawai));
      }
			if($mode=='status'){
					$pegakses = $this->m_umum->ambil_data('ol_akses','id_ol_akses',$data['int']);
					$peg = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$pegakses['id_pegawai']);
				  if($this->m_ol_admin_rs->ol_status_pegawai_akses($data['id'],$data['int'])){
						$this->session->set_flashdata('sukses', 'Sukses Rubah Status');
						redirect(base_url('ol_admin_rs/ol_akses/view/'.$peg['barcode_pegawai']));	  	
				  }else{
						$this->session->set_flashdata('danger', 'Masalah Edit Data');
						redirect(base_url('ol_akses/ol_akses/view/'.$peg['barcode_pegawai']));
				  }
			}
		}
  }
  function unit($mode='view')
  {
		$data['page']  = "unit";
		$data['header'] = "DATA RUANGAN / UNIT";
		$data['title'] = "DATA RUANGAN / UNIT";
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
		$data['ambil_data_rujukan_working_null'] = $this->m_ol_rancak->ambil_data_rujukan_working_kab_null($this->session->list_instansi);
		$data['ambil_data_rujukan_working'] = $this->m_ol_rancak->ambil_data_rujukan_kab_working($this->session->list_instansi);
    if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$id = $this->input->post("id_working");
				redirect(base_url('ol_admin_rs/unit/view/'.$id));
			}
		}
    else if($mode=='data'){
			echo json_encode($this->m_ol_admin_rs->unit_all($data['id'],$this->session->list_instansi));
		}
  	else{
  		$data['cmd_status']  = $this->m_rancak->cmd_status();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['id_instansi']  = set_value('id_instansi',$this->input->post('id_instansi'));
				$data['nama_unit']  = set_value('nama_unit',$this->input->post('nama_unit'));
				$data['status_unit']  = set_value('status_unit',$this->input->post('status_unit'));
				$this->load->view("ol_admin_rs/isi",$data);
      }
      if($mode=='simpan_tambah'){
      	$id_instansi = $this->input->post('id_instansi');
      	$nama_unit = $this->input->post('nama_unit');
				$kondisi=array('id_instansi'=>$id_instansi,'nama_unit'=>$nama_unit);
				$jml = $this->m_umum->jumlah_record_filter('ol_unit',$kondisi);
				if($jml == 0){
				  if($this->m_ol_admin_rs->simpan_ol_unit()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('ol_admin_rs/unit'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
						redirect(base_url('ol_admin_rs/unit'));
				  }
				}else{
						$this->session->set_flashdata('danger', 'Data Sudah Ada');
						redirect(base_url('ol_admin_rs/unit'));					
				}
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('ol_unit','id_unit',$data['id']);
				$data['nama_unit']  = set_value('nama_unit',$keuangan["nama_unit"]);
				$data['id_unit']  = set_value('id_unit',$keuangan["id_unit"]);
				$data['id_instansi']  = set_value('id_instansi',$keuangan["id_instansi"]);
				$data['status_unit']  = set_value('status_unit',$keuangan["status_unit"]);
				$this->load->view("ol_admin_rs/isi",$data);
      }
      if($mode=='simpan_edit'){
      	$id_instansi = $this->input->post('id_instansi');
      	$nama_unit = $this->input->post('nama_unit');
      	$nama_unit_lama = $this->input->post('nama_unit_lama');
				$kondisi=array('id_instansi'=>$id_instansi,'nama_unit'=>$nama_unit,'nama_unit !='=>$nama_unit_lama);
				$jml = $this->m_umum->jumlah_record_filter('ol_unit',$kondisi);
				if($jml == 0){
				  if($this->m_ol_admin_rs->edit_ol_unit()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
						redirect(base_url('ol_admin_rs/unit'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
						redirect(base_url('ol_admin_rs/unit'));
				  }
				}else{
						$this->session->set_flashdata('danger', 'Data Sudah Ada');
						redirect(base_url('ol_admin_rs/unit'));					
				}					  
      }
		}
  }
  function pengcab($id)
  {
  	$jabfung = $this->m_umum->ambil_data('jabatan_fungsional','id_jabatan_fungsional',$id);
    $dt=$this->m_ol_rancak->ambil_data_pengcab($jabfung['id_jabatan']);
    echo json_encode($dt);
  }
  function jabfung_data($id)
  {
    if($id < 3){
      $ids = '1';
    }else{
      $ids = '3';
    }
    $dt=$this->m_rancak->ambil_data_dropdown_jabfung_status($ids);
    echo json_encode($dt);
  }
	function check_availability(){
		$username=$this->input->post('username');
		$username = strtolower($username);
		$username = str_replace(' ', '-', $username);
		$username = preg_replace('/[^A-Za-z0-9\-]/', '', $username);
		$kondisi=array('username'=>$username);
		$jml = $this->m_umum->jumlah_record_filter('ol_pegawai',$kondisi);
		if($jml == 0){
			echo "<span style='color:green'> Username Tersedia.</span>";
		}else{
			echo "<span style='color:red'> Username Sudah Ada</span>";
		}
	}
	function registrasi($mode='view'){
		$data['page']="registrasi"; 
		$data['header'] = "DATA REGISTRASI USER";
		$onlinekah = $this->m_umum->ambil_data('a_online','kode_online','ol_registrasi');
		if($onlinekah['status_online'] == 1){
			$data['title'] = "STATUS DAFTAR ONLINE FREE";
		}else{
			$data['title'] = "STATUS DAFTAR ONLINE MENGGUNAKAN BARCODE REGISTRASI";
		}		
		$data['status_online'] = $onlinekah["status_online"];
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
		$data['id']   = $this->uri->segment(4, 0);
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
				redirect(base_url('ol_admin_rs/registrasi/view/'.$key));
			}
		}
  else if($mode=='hapus'){
  		$this->m_umum->hapus_data('ol_registrasi','barcode_registrasi',$data['id']);
    	redirect(base_url('ol_admin_rs/registrasi'));
  }
		else if($mode=='data'){
			echo json_encode($this->m_ol_admin_rs->registrasi_all($data['id']));
		}
		else{
			$data['cmd_instansi'] = $this->m_ol_rancak->ambil_instansi_no_null();
			$data['opsi_status_perawat'] = $this->m_ol_rancak->status_perawat();
			$data['kol_kode_kewenangan_null'] = $this->m_ol_rancak->kol_kode_kewenangan_null();
			$data['cmd_tipe_pegawai'] = $this->m_ol_rancak->cmd_tipe_pegawai();
			$data['cmd_jabfung'] = $this->m_rancak->cmd_jabfung();
			$data['status'] = $this->m_rancak->cmd_status();
			$data['gender'] = $this->m_rancak->cmd_jk();
			$data['ambil_data_rujukan_instansi'] = $this->m_ol_rancak->ambil_data_rujukan_working();
			$data['ambil_data_rujukan_working_null'] = $this->m_ol_rancak->ambil_data_rujukan_working_null();
			$data['cmd_unit_null'] = $this->m_rancak->struktur_jabatan_as_unit();
			$data['cmd_agama'] = $this->m_rancak->cmd_agama();
			$data['cmd_status_kawin'] = $this->m_rancak->cmd_status_kawin();
			$data['cmd_pendidikan'] = $this->m_rancak->cmd_pendidikan();
			$data['cmd_level'] = $this->m_ol_rancak->cmd_level($program['user_level']);
			$data['kol_provinsi'] = $this->m_rancak->cmd_kol_provinsi();
			if($mode=='aktifasi'){
				$data['page'] =  $data['page']."_aktifasi";
					$take = $this->m_ol_rancak->ambil_registrasi($data['id']);
					$data['id_instansi']  = set_value('id_instansi',$take['id_instansi']);					
					$data['status_registrasi']  = set_value('status_registrasi',$take['status_registrasi']);
					$data['nama_pegawai']  = set_value('nama_pegawai',$take['nama_pegawai']);
					$data['jk']  = set_value('jk',$take['jk']);
					$data['tmp_lahir']  = set_value('tmp_lahir',$take['tmp_lahir']);
					$data['tgl_lahir']  = set_value('tgl_lahir',date('d-m-Y', strtotime($take['tgl_lahir'])));
					$data['email']  = set_value('email',$take['email']);
					$data['no_hp']  = set_value('no_hp',$take['no_hp']);		
					$data['nik']  = set_value('nik',$take['nik']);			
					$data['id_status_kawin']  = set_value('id_status_kawin',$take['id_status_kawin']);
					$data['id_agama']  = set_value('id_agama',$take['id_agama']);
					$data['id_pendidikan']  = set_value('id_pendidikan',$take['id_pendidikan']);
					$data['id_jabatan_fungsional']  = set_value('id_jabatan_fungsional',$take['id_jabatan_fungsional']);
					$data['alamat']  = set_value('alamat',$take['alamat']);
					$data['status_perawat']  = set_value('status_perawat',$take['status_perawat']);
					$data['id_kode_kewenangan']  = set_value('id_kode_kewenangan',$take['id_kode_kewenangan']);
					$data['tipe_pegawai']  = set_value('tipe_pegawai',$take['tipe_pegawai']);
					$data['nip']  = set_value('nip',$take['nip']);
					$data['no_profesi']  = set_value('no_profesi',$take['no_profesi']);
					$data['username']  = set_value('username',$take['username']);
					$data['id_prov']  = set_value('id_prov',$take['id_prov']);
					$data['id_kab']  = set_value('id_kab',$take['id_kab']);
					$data['id_kel']  = set_value('id_kel',$take['id_kel']);
					$data['id_kec']  = set_value('id_kec',$take['id_kec']);
					$tjabatan = $this->m_umum->ambil_data('jabatan_fungsional','id_jabatan_fungsional',$take['id_jabatan_fungsional']);
					$data['id_pengcab']  = set_value('id_pengcab',$take['id_pengcab']);
					$data['kab'] = $this->m_ol_rancak->ambil_data_dropdown_kab($take['id_prov']);
    			$data['kec'] = $this->m_ol_rancak->ambil_data_dropdown_kec($take['id_kab']);
    			$data['kel'] = $this->m_ol_rancak->ambil_data_dropdown_kel($take['id_kec']);
    			$data['null_pengcab'] = $this->m_ol_rancak->ambil_data_pengcabnonull($tjabatan['id_jabatan']);
					$data['id_level']  = set_value('id_level',$this->input->post("id_level"));
					$this->form_validation->set_rules('nama_pegawai','nama_pegawai','required');
				if ($this->form_validation->run() === FALSE){
					$this->tampil($data);
				}else{
					$ptn = "/^0/";  // Regex
					$str = $this->input->post('no_hp'); 
					$nik = $this->input->post('nik');
					$id_instansi = $this->input->post('id_instansi');
					$rpltxt = "62";  // Replacement string
					$no_hp = preg_replace($ptn, $rpltxt, $str);
					$barcode_registrasi= $this->input->post('barcode_registrasi');
					$username= $this->input->post('username');
					$username = strtolower($username);
					$username = str_replace(' ', '-', $username);
					$username = preg_replace('/[^A-Za-z0-9\-]/', '', $username);
					$kondisi=array('username'=>$username);
					$jml = $this->m_umum->jumlah_record_filter('ol_pegawai',$kondisi);
					$kondisi2=array('nik'=>$nik);
					$jml2 = $this->m_umum->jumlah_record_filter('ol_pegawai',$kondisi2);
						if($jml == 0){
							if($jml2 == 0){
								if($Q = $this->m_ol_admin_rs->simpan_aktifasi()){
									$this->m_ol_admin_rs->simpan_user($Q);
									if($id_instansi > 0){
									$this->m_ol_admin_rs->simpan_instansi($Q);
									}
									$this->m_umum->hapus_data('ol_registrasi','barcode_registrasi',$barcode_registrasi);
									$this->session->set_flashdata('sukses', 'Data berhasil Di Tambah');
									redirect(base_url('ol_admin_rs/registrasi'));
								}else{
									$this->session->set_flashdata('danger', 'Ada Masalah Edit Data');
									redirect(base_url('ol_admin_rs/registrasi'));
								}
							}else{
							  $this->session->set_flashdata('danger', 'No KTP Sudah Ada');
							  redirect(base_url('ol_admin_rs/registrasi'));
							}
						}
						else{
							$this->session->set_flashdata('danger', 'Username Sudah Ada');
							redirect(base_url('ol_admin_rs/registrasi'));
						}
				}
			}
		}
	}
	function direktur($mode='view'){
		$data['page']="direktur"; 
		$data['header'] = "DATA DIREKTUR UNTUK KELENGKAPAN SPK/RKK";
		$data['title'] = "DATA DIREKTUR UNTUK KELENGKAPAN SPK/RKK";
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
				redirect(base_url('ol_admin_rs/direktur/view/'.$key));
			}
		}
		else if($mode=='data'){
			echo json_encode($this->m_ol_admin_rs->direktur_all($this->session->list_instansi,$data['id']));
		}
		else{
  		$data['cmd_tipe_pegawai'] = $this->m_ol_rancak->cmd_tipe_pegawai();
  		$data['ambil_data_instansi'] = $this->m_ol_rancak->ambil_data_rujukan_working($this->session->list_instansi);
  		$data['gender'] = $this->m_rancak->cmd_jk();
  		$data['cmd_status'] = $this->m_rancak->cmd_status();
	    if($mode=='tambah'){
	      $data['page'] =  $data['page']."_tambah";
	  		$data['nama_direktur']  = set_value('nama_direktur',$this->input->post("nama_direktur"));
	  		$data['nip']  = set_value('nip',$this->input->post("nip"));
	  		$data['jk']  = set_value('jk',$this->input->post("jk"));
	  		$data['id_status_pegawai']  = set_value('id_status_pegawai',$this->input->post("id_status_pegawai"));
	  		$data['status_direktur']  = set_value('status_direktur',$this->input->post("status_direktur"));
	  		$data['id_instansi']  = set_value('id_instansi',$this->input->post("id_instansi"));
				$this->load->view("ol_admin_rs/isi",$data);
	    }
	    if($mode=='simpan_tambah'){
			  if($this->m_ol_admin_rs->simpan_direktur()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('ol_admin_rs/direktur'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('ol_admin_rs/direktur'));
			  }
	    }
	    if($mode=='edit'){
	      $data['page'] =  $data['page']."_edit";
					$take = $this->m_umum->ambil_data('ol_direktur','id_direktur',$data['id']);		
					$data['id_direktur']  = set_value('id_direktur',$take['id_direktur']);
					$data['nama_direktur']  = set_value('nama_direktur',$take['nama_direktur']);
					$data['jk']  = set_value('jk',$take['jk']);		
					$data['id_status_pegawai']  = set_value('id_status_pegawai',$take['id_status_pegawai']);
					$data['nip']  = set_value('nip',$take['nip']);
					$data['status_direktur']  = set_value('status_direktur',$take['status_direktur']);
					$data['id_instansi']  = set_value('id_instansi',$take['id_instansi']);
				$this->load->view("ol_admin_rs/isi",$data);
	    }
	    if($mode=='simpan_edit'){
			  if($this->m_ol_admin_rs->edit_direktur()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Edit');
					redirect(base_url('ol_admin_rs/direktur'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
					redirect(base_url('ol_admin_rs/direktur'));
			  }
	    }
    }
	}
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("ol_admin_rs/header",$data);
	$this->load->view("ol_admin_rs/isi");
	$this->load->view("footer");
	$this->load->view("ol_admin_rs/jsload");
	$this->load->view("ol_admin_rs/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_top",$data);
	$this->load->view("ol_admin_rs/isi");
	$this->load->view("footer");
	$this->load->view("ol_admin_rs/jsload");
	$this->load->view("ol_admin_rs/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
