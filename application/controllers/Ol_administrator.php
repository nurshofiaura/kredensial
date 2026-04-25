<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Ol_administrator extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
          $this->load->model('m_ol_rancak');
          $this->load->model('m_ol_administrator');
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
      elseif ( $this->session->has_userdata('id_ms_pengurus-1') )
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
		$ole = $this->m_ol_rancak->ambil_data_dropdown_pengurus_pengcab($this->session->id_pegawai);
		$arr = array();
		foreach($ole as $val){
				$arr[] = $val['id_pengcab'];
		}
		$eimplo = implode(",", $arr);
		$data['ambil_pengumuman'] = $this->m_ol_rancak->ambil_pengumuman($this->session->list_pengcab);
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
	function cabang($mode='view'){
		$data['page']="cabang"; 
		$data['header'] = "DATA CABANG / WILAYAH";
		$data['title'] = "DATA CABANG / WILAYAH";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
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
		$data['urlnya']   = $this->uri->segment(2, 0);
		$data['pagenya']   = $this->uri->segment(3, 0);
		$data['id']   = $this->uri->segment(4, 0);
		$pengcabmana = $this->m_umum->ambil_data('ol_pengcab','barcode_pengcab',$data['id']);
		$data['id2']   = $this->uri->segment(5, 0);
		$data['pengcab_id'] = $pengcabmana['id_pengcab'];
		$data['pengcab_name'] = $pengcabmana['nama_pengcab'];
		$data['ambil_data_pengcab'] = $this->m_ol_rancak->ambil_data_dropdown_pengurus_pengcab($this->session->id_pegawai);
/*		$ole = $this->m_ol_rancak->ambil_data_dropdown_pengurus_pengcab($this->session->id_pegawai);
		$arr = array();
		foreach($ole as $val){
				$arr[] = $val['id_pengcab'];
		}
		$eimplo = implode(",", $arr);*/
		if($mode=='view'){
			$this->tampil($data);
		}
		else if($mode=='data'){
			echo json_encode($this->m_ol_administrator->pengurus_all($this->session->list_pengcab));
		}
		else{
			  $data['kol_provinsi'] = $this->m_rancak->cmd_kol_provinsi();
			if($mode=='edit'){
				$data['page'] =  $data['page']."_edit";
					$take = $this->m_umum->ambil_data('ol_pengcab','barcode_pengcab',$data['id']);		
					$data['id_pengcab']  = set_value('id_pengcab',$take['id_pengcab']);
					$data['id_cabang']  = set_value('id_cabang',$take['id_cabang']);
					$data['nama_pengcab']  = set_value('nama_pengcab',$take['nama_pengcab']);
					$data['alamat_pengcab']  = set_value('alamat_pengcab',$take['alamat_pengcab']);
					$data['email_pengcab']  = set_value('email_pengcab',$take['email_pengcab']);
					$data['kontak_pengcab']  = set_value('kontak_pengcab',$take['kontak_pengcab']);
					$data['id_prov']  = set_value('id_prov',$take['id_prov']);		
					$data['id_kab']  = set_value('id_kab',$take['id_kab']);			
					$data['kab'] = $this->m_ol_rancak->ambil_data_dropdown_kab($take['id_prov']);
					$this->form_validation->set_rules('nama_pengcab','nama_pengcab','required');
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
							$this->m_ol_administrator->edit_ol_pengcab($fileData['file_name']);
							$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
							redirect(base_url('ol_administrator/cabang'));
						}else{
							$nole = '';
							$this->m_ol_administrator->edit_ol_pengcab($nole);
							$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
							redirect(base_url('ol_administrator/cabang'));
						}
					}
				}
			}
			if($mode=='stempel'){
				$data['page'] =  $data['page']."_stempel";
					$take = $this->m_umum->ambil_data('ol_pengcab','barcode_pengcab',$data['id']);		
					$data['id_pengcab']  = set_value('id_pengcab',$take['id_pengcab']);
					$data['id_cabang']  = set_value('id_cabang',$take['id_cabang']);
					$data['nama_pengcab']  = set_value('nama_pengcab',$take['nama_pengcab']);
					$data['alamat_pengcab']  = set_value('alamat_pengcab',$take['alamat_pengcab']);
					$data['email_pengcab']  = set_value('email_pengcab',$take['email_pengcab']);
					$data['kontak_pengcab']  = set_value('kontak_pengcab',$take['kontak_pengcab']);
					$data['id_prov']  = set_value('id_prov',$take['id_prov']);		
					$data['id_kab']  = set_value('id_kab',$take['id_kab']);			
					$data['kab'] = $this->m_ol_rancak->ambil_data_dropdown_kab($take['id_prov']);
					$this->form_validation->set_rules('nama_pengcab','nama_pengcab','required');
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
							$this->m_ol_administrator->edit_stempel_pengcab($fileData['file_name']);
							$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
							redirect(base_url('ol_administrator/cabang'));
						}else{
							$nole = '';
							$this->m_ol_administrator->edit_stempel_pengcab($nole);
							$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
							redirect(base_url('ol_administrator/cabang'));
						}
					}
				}
			}
		}
	}
	function pengurus($mode='view'){
		$data['page']="pengurus"; 
		$data['header'] = "DATA PENGURUS";
		$data['title'] = "DATA PENGURUS";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
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
		$data['ambil_data_pengcab'] = $this->m_ol_rancak->list_pengcab_from_session_no_null();
		if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$id = $this->input->post("id_pengcab");
				redirect(base_url('ol_administrator/pengurus/view/'.$id));
			}
		}
		else if($mode=='data'){
			echo json_encode($this->m_ol_administrator->pengurusan_all($this->session->list_pengcab));
		}
		else{
			$data['ambil_data_ms_pengurus'] = $this->m_ol_rancak->ambil_data_ms_pengurus_no_admin($this->session->id_jabatan,$data['prov_id']);
			$data['ambil_data_ms_pengurus_no_null'] = $this->m_ol_rancak->ambil_data_ms_pengurus_no_null_no_admin($this->session->id_jabatan,$data['prov_id']);
			$data['cmd_status'] = $this->m_rancak->cmd_status();
		  if($mode=='tambah'){
				$data['page'] =  $data['page']."_tambah";
				$data['id_pengcab']  = set_value('id_pengcab',$this->input->post("id_pengcab"));
				$this->form_validation->set_rules('id_pengcab','id_pengcab','required');
				if ($this->form_validation->run() === FALSE){
						   $this->tampil($data);
				}else{
						$this->m_ol_administrator->simpan_ol_pengurus();
						$this->session->set_flashdata('sukses', 'Data Sudah Di Tambah & Data Dobel Tidak Di Tambah');						
						redirect(base_url('ol_administrator/pengurus'));
				}
			}
			if($mode=='edit'){
			  $data['page'] =  $data['page']."_edit";
				$take = $this->m_umum->ambil_data('ol_pengurus','id_pengurus',$data['id']);		
				$data['id_pengcab']  = set_value('id_pengcab',$take['id_pengcab']);
				$data['id_ms_pengurus']  = set_value('id_ms_pengurus',$take['id_ms_pengurus']);
				$data['status_pengurus']  = set_value('status_pengurus',$take['status_pengurus']);
				$this->load->view("ol_administrator/isi",$data);
			}
			if($mode=='simpan_edit'){
			$id_pengurus = $this->input->post('id_pengurus');
			$id_pengcab = $this->input->post('id_pengcab');
			$id_ms_pengurus = $this->input->post('id_ms_pengurus');
			$kondisi=array('id_pengcab'=>$id_pengcab,'id_ms_pengurus'=>$id_ms_pengurus);
			$jml = $this->m_umum->jumlah_record_filter('ol_pengurus',$kondisi);
	 		$kondisi_peg=array('id_pengurus'=>$id_pengurus);
			$jml_peg = $this->m_umum->jumlah_record_filter('ol_pegawai_pengurus',$kondisi_peg);
			if($jml == 0){
				if($jml_peg == 0){
					  if($this->m_ol_administrator->edit_ol_pengurus()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
							redirect(base_url('ol_administrator/pengurus'));
						}else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
							redirect(base_url('ol_administrator/pengurus'));
						}
					}else{
						$this->session->set_flashdata('danger', 'Data Sudah Masuk Struktur Pengurus');
						redirect(base_url('ol_administrator/pengurus'));				
					}
				}else{
						$this->session->set_flashdata('danger', 'Data Sudah Ada');
						redirect(base_url('ol_administrator/pengurus'));					
				}
			}
		}
	}
	function pegawai_pengurus($mode='view'){
		$data['page']="pegawai_pengurus"; 
		$data['header'] = "DATA PENGURUS";
		$data['title'] = "DATA PENGURUS";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
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
		if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$id = $this->input->post("id_pengcab");
				redirect(base_url('ol_administrator/pegawai_pengurus/view/'.$id));
			}
		}
		else if($mode=='data'){
			echo json_encode($this->m_ol_administrator->pegawai_pengurus_all($this->session->list_pengcab));
		}
		else{
$data['ambil_data_pengurus_master_no_null'] = $this->m_ol_rancak->ambil_data_pengurus_master_pengcab($this->session->list_pengcab);
			$data['ambil_data_dropdown_pegawai'] = $this->m_ol_rancak->ambil_data_dropdown_pegawai_no_null_pengcab($this->session->list_pengcab);
			$data['cmd_status'] = $this->m_rancak->cmd_status();
		  if($mode=='tambah'){
				$data['page'] =  $data['page']."_tambah";
				$data['id_pegawai']  = set_value('id_pegawai',$this->input->post("id_pegawai"));
				$data['id_pengurus']  = set_value('id_pengurus',$this->input->post("id_pengurus"));
				$this->form_validation->set_rules('id_pengurus','id_pengurus','required');
				if ($this->form_validation->run() === FALSE){
						   $this->tampil($data);
				}else{
					$id_pengurus = $this->input->post('id_pengurus');
					$id_pegawai = $this->input->post('id_pegawai');
			 		$kondisi=array('id_pengurus'=>$id_pengurus,'id_pegawai'=>$id_pegawai);
					$jml = $this->m_umum->jumlah_record_filter('ol_pegawai_pengurus',$kondisi);					
						if($jml == 0){					
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
									$this->m_ol_administrator->simpan_ol_pegawai_pengurus();
									$this->m_ol_administrator->edit_ol_pegawai($fileData['file_name'],$id_pegawai);
									$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
									redirect(base_url('ol_administrator/pegawai_pengurus'));
								}else{
									$this->m_ol_administrator->simpan_ol_pegawai_pengurus();
									$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
									redirect(base_url('ol_administrator/pegawai_pengurus'));
								}
							}
						}else{
							$this->session->set_flashdata('danger', 'Data Sudah Ada Mungkin Non AKtif, Hubungi Admin');
							redirect(base_url('ol_administrator/pegawai_pengurus'));	
						}					
				}
			}
			if($mode=='edit'){
				$data['page'] =  $data['page']."_edit";
					$take = $this->m_umum->ambil_data('ol_pegawai_pengurus','barcode_pegawai_pengurus',$data['id']);		
					$data['id_pegawai_pengurus']  = set_value('id_pegawai_pengurus',$take['id_pegawai_pengurus']);
					$data['id_pengurus']  = set_value('id_pengurus',$take['id_pengurus']);
					$data['id_pegawai']  = set_value('id_pegawai',$take['id_pegawai']);
					$data['status_pegawai_pengurus']  = set_value('status_pegawai_pengurus',$take['status_pegawai_pengurus']);
					$this->form_validation->set_rules('id_pegawai','id_pegawai','required');
				if ($this->form_validation->run() === FALSE){
					$this->tampil($data);
				}else{
					$id_pegawai_pengurus = $this->input->post('id_pegawai_pengurus');
					$id_pengurus = $this->input->post('id_pengurus');
					$id_pegawai = $this->input->post('id_pegawai');
					$id_pegawai_lama = $this->input->post('id_pegawai_lama');
					$id_pengurus_lama = $this->input->post('id_pengurus_lama');
					$barcode_pegawai_pengurus = $this->input->post('barcode_pegawai_pengurus');
			 		$kondisi=array('barcode_pegawai_pengurus'=>$barcode_pegawai_pengurus);
					$jml = $this->m_umum->jumlah_record_filter('ol_pegawai_pengurus',$kondisi);
			 		$kondisi_gajuval=array('id_pegawai_pengurus'=>$id_pegawai_pengurus);
					$jml_gajuval = $this->m_umum->jumlah_record_filter('ol_kprint_detil',$kondisi_gajuval);
			 		$kondisi_peg=array('id_pegawai_pengurus'=>$id_pegawai_pengurus);
					$jml_peg = $this->m_umum->jumlah_record_filter('ol_kor_detil',$kondisi_peg);
					$kondisi_cek=array('id_pengurus'=>$id_pengurus,'id_pegawai'=>$id_pegawai,'id_pengurus !='=>$id_pengurus_lama,'id_pegawai !='=>$id_pegawai_lama);
					$jml_cek = $this->m_umum->jumlah_record_filter('ol_pegawai_pengurus',$kondisi_cek);
					if($jml == 0){							
							$this->session->set_flashdata('danger', 'Data Tidak Valid');
							redirect(base_url('ol_administrator/pegawai_pengurus'));
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
											$this->m_ol_administrator->edit_pegawai_pengurus();
											$this->m_ol_administrator->edit_ol_pegawai($fileData['file_name'],$id_pegawai);
											$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
											redirect(base_url('ol_administrator/pegawai_pengurus'));
										}else{
											$this->m_ol_administrator->edit_pegawai_pengurus();
											$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
											redirect(base_url('ol_administrator/pegawai_pengurus'));
										}
									}
								}else{
									$this->session->set_flashdata('danger', 'Data Sudah Ada');
									redirect(base_url('ol_administrator/pegawai_pengurus'));
								}
							}else{
								$this->session->set_flashdata('danger', 'Data Sudah Masuk Validasi Print');
								redirect(base_url('ol_administrator/pegawai_pengurus'));								
							}
						}else{
							$this->session->set_flashdata('danger', 'Data Sudah Masuk Validasi E Surat');
							redirect(base_url('ol_administrator/pegawai_pengurus'));
						}						
					}	
				}
			}
		}
	}
	function pengajuan_korespodensi($mode='view'){
		$data['page']="pengajuan_korespodensi"; 
		$data['header'] = "DATA PENGAJUAN SURAT";
		$data['title'] = "DATA PENGAJUAN SURAT";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
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
		$data['id3']   = $this->uri->segment(6, 0);
		$data['ambil_data_dropdown_pegawai'] = $this->m_ol_rancak->ambil_data_dropdown_pegawai_comma($this->session->id_jabatan,$this->session->list_pengcab);
		if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$id = $this->input->post("id_pegawai");
				redirect(base_url('ol_administrator/pengajuan_korespodensi/view/'.$id));
			}
		}
		else if($mode=='data'){
			echo json_encode($this->m_ol_administrator->kor_detil_all($data['id'],$this->session->list_pengcab));
		}
			else if($mode=='dataprint'){
			echo json_encode($this->m_ol_rancak->kor_print_all($data['id']));
		}
		else{
			  $data['cmd_status'] = $this->m_rancak->cmd_status();
			  $data['cmd_status_korespodensi'] = $this->m_rancak->status_korespodensi();
			  $data['ambil_data_pengcabnonull'] = $this->m_ol_rancak->ambil_data_pengcabnonull($this->session->id_jabatan);
			  $data['ambil_data_surat_kategori'] = $this->m_ol_rancak->ambil_data_surat_kategori($this->session->id_jabatan);
			  $data['cmd_sifat_surat'] = $this->m_rancak->sifat_surat();
      if($mode=='validasi'){
        $data['page'] =  $data['page']."_validasi";
				$d	= $this->m_ol_rancak->ambil_data_korespodensi($data['id']);
				$dx	= $this->m_ol_rancak->ambil_data_okk_and_osk_4_pengajuan($d['id_korespodensi']);
				$data['ambil_berkas_data']=$this->m_ol_rancak->ambil_id_berkas_data($d['id_pengirim']);
				$data['foto_pengaju']  = set_value('foto_pengaju',$d["foto"]);
				$data['nama_pengaju']  = set_value('nama_pengaju',$d["nama_pegawai"]);
				$data['id_kategori']  = set_value('id_kategori',$dx["id_kategori"]);
				$data['nama_kategori']  = set_value('nama_kategori',$dx["nama_kategori"]);
				$data['syarat_kategori']  = set_value('syarat_kategori',$dx["syarat_kategori"]);
				$data['id_korespodensi']  = set_value('id_korespodensi',$d["id_korespodensi"]);
				$data['barcode_korespodensi']  = set_value('barcode_korespodensi',$d["barcode_korespodensi"]);
				$data['wkt_korespodensi']  = date('d-m-Y H:i:s', strtotime($d["wkt_korespodensi"]));
				$data['no_korespodensi']  = set_value('no_korespodensi',$d["no_korespodensi"]);
				$data['sifat_surat']  = set_value('sifat_surat',$d["sifat_surat"]);
				$data['status_korespodensi']  = set_value('status_korespodensi',$d["status_korespodensi"]);
				$data['id_berkas']  = explode(",", $d["id_berkas"]);
				$data['berkas']  = $d["id_berkas"];
				$data['id_ijasah']  = explode(",", $d["id_ijasah"]);
				$data['ijasah']  = $d["id_ijasah"];
				$data['id_str']  = explode(",", $d["id_str"]);
				$data['str']  = $d["id_str"];
				$data['id_sertifikat']  = explode(",", $d["id_sertifikat"]);
				$data['sertifikat']  = $d["id_sertifikat"];
				$data['nama_pengaju']  = set_value('nama_pengaju',$d["nama_pegawai"]);
				$data['tempat_kerja']  = set_value('tempat_kerja',$d["nama_working"]);
				$data['umur']  = set_value('umur',$d["umur"]);
				$data['jk']  = set_value('jk',$d["jk"]);
				$this->form_validation->set_rules('no_korespodensi','no_korespodensi','required');
				if ($this->form_validation->run() === FALSE){
						   $this->tampil($data);
				}else{
		  	$id_korespodensi = $this->input->post('id_korespodensi');
		  	$kores	= $this->m_umum->ambil_data('ol_korespodensi','id_korespodensi',$id_korespodensi);
		  		 if($kores['status_korespodensi'] < 3){
						$this->m_ol_administrator->rubah_data_surat_korespodensi();
						$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
					}else{
							$this->session->set_flashdata('danger', 'Status Sudah Selesai');				
					}
						redirect(base_url('ol_administrator/pengajuan_korespodensi/validasi/'.$data['id']));
				}
	  	}
      if($mode=='tambah_kategori'){
        $data['page'] =  $data['page']."_tambah_kategori";
	//			$d = $this->m_ol_rancak->ambil_data_pengcab_for_tambah($data['id']);
				$data['ambil_data_surat_kategori'] = $this->m_ol_rancak->ambil_data_surat_kategori($this->session->id_jabatan);
	  $data['ambil_data_pengcabnonull']=$this->m_ol_rancak->ambil_data_pengcabnonull($this->session->id_jabatan);
	  $data['ambil_data_instansi']=$this->m_ol_rancak->ambil_data_instansi();
				$data['id_kategori']  = set_value('id_kategori',$this->input->post('id_kategori'));
				$data['pengcab_asal']  = set_value('pengcab_asal',$this->input->post('pengcab_asal'));
				$data['pengcab_tujuan']  = set_value('pengcab_tujuan',$this->input->post('pengcab_tujuan'));
				$this->load->view("ol_administrator/isi",$data);
      }
      if($mode=='simpan_tambah_kategori'){
		  	$barcode_korespodensi = $this->input->post('barcode_korespodensi');
		  	$kores	= $this->m_umum->ambil_data('ol_korespodensi','barcode_korespodensi',$barcode_korespodensi);
		  		 if($kores['status_korespodensi'] < 3){
					  if($this->m_ol_rancak->simpan_kor_tambah()){
							$this->session->set_flashdata('sukses', 'Data Sudah Di Tambah');
							redirect(base_url('ol_administrator/pengajuan_korespodensi/validasi/'.$barcode_korespodensi));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Masalah Tambah Data. Hubungi Admin');
							redirect(base_url('ol_administrator/pengajuan_korespodensi/validasi/'.$barcode_korespodensi));
					  }
					}else{
							$this->session->set_flashdata('danger', 'Status Sudah Selesai');
							redirect(base_url('ol_administrator/pengajuan_korespodensi/validasi/'.$barcode_korespodensi));						
					}
      }
      if($mode=='pengurus'){// ini rubah
        $data['page'] =  $data['page']."_pengurus";
				$id_pengcabb = $this->m_umum->ambil_data('ol_kor_kategori','id_kor_kategori',$data['id']);
				$data['ambil_data_pengcab'] = $this->m_ol_rancak->ambil_data_pengcab_dari_pegawai_pengurusno_grup_perpengcab($id_pengcabb['pengcab_asal']);
				$this->load->view("ol_administrator/isi",$data);
      }
      if($mode=='simpan_pengurus'){
		  	$barcode_korespodensi = $this->input->post('barcode_korespodensi');
		  	$kores	= $this->m_umum->ambil_data('ol_korespodensi','barcode_korespodensi',$barcode_korespodensi);
		  		 if($kores['status_korespodensi'] < 3){
							if($this->input->post('chk')){
							  $this->m_ol_rancak->simpan_kor_detil_pegawai();
								redirect(base_url('ol_administrator/pengajuan_korespodensi/validasi/'.$barcode_korespodensi));
							}else{
								redirect(base_url('ol_administrator/pengajuan_korespodensi/validasi/'.$barcode_korespodensi));
							}
					}else{
							$this->session->set_flashdata('danger', 'Status Sudah Selesai');
							redirect(base_url('ol_administrator/pengajuan_korespodensi/validasi/'.$barcode_korespodensi));						
					}
      }
      if($mode=='edit_korprint'){ // ini rubah
        $data['page'] =  $data['page']."_edit_korprint";
				$id_pengcabbb = $this->m_umum->ambil_data('ol_kor_print','id_kor_print',$data['id2']);
				$data['title_kor_print'] = $id_pengcabbb['title_kor_print'];
				$data['modul'] = $id_pengcabbb['modul'];
				$data['tmp_modul'] = $id_pengcabbb['tmp_modul'];
				$data['no_kor_print'] = $id_pengcabbb['no_kor_print'];
				$data['tmp_kor_print'] = $id_pengcabbb['tmp_kor_print'];
				$data['font_size'] = $id_pengcabbb['font_size'];
				if(!empty($id_pengcabbb['tgl_awal']) || $id_pengcabbb['tgl_awal'] !== NULL){
				$data['tgl_awal'] = date('d-m-Y', strtotime($id_pengcabbb['tgl_awal']));}else{ $data['tgl_awal'] = date('d-m-Y');}
				if(!empty($id_pengcabbb['tgl_akhir']) || $id_pengcabbb['tgl_akhir'] !== NULL){
				$data['tgl_akhir'] = date('d-m-Y', strtotime($id_pengcabbb['tgl_akhir']));}else{ $data['tgl_akhir'] = date('d-m-Y');}
				if(!empty($id_pengcabbb['tgl_kor_print']) || $id_pengcabbb['tgl_kor_print'] !== NULL){
				$data['tgl_kor_print'] = date('d-m-Y', strtotime($id_pengcabbb['tgl_kor_print']));}else{ $data['tgl_kor_print'] = date('d-m-Y');}
		//		$data['ambil_data_pengcab'] = $this->m_ol_rancak->ambil_data_kor_print_4_print($id_pengcabbb['id_kor_print']);
				$this->load->view("ol_administrator/isi",$data);
      }
      if($mode=='simpan_edit_korprint'){
		  	$barcode_korespodensi = $this->input->post('barcode_korespodensi');
		  	$kores	= $this->m_umum->ambil_data('ol_korespodensi','barcode_korespodensi',$barcode_korespodensi);
		  		 if($kores['status_korespodensi'] < 3){
					  if($this->m_ol_administrator->rubah_kor_print()){
							redirect(base_url('ol_administrator/pengajuan_korespodensi/validasi/'.$barcode_korespodensi));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
							redirect(base_url('ol_administrator/pengajuan_korespodensi/validasi/'.$barcode_korespodensi));
					  }
					}else{
							$this->session->set_flashdata('danger', 'Status Sudah Selesai');
							redirect(base_url('ol_administrator/pengajuan_korespodensi/validasi/'.$barcode_korespodensi));						
					}
      }
      if($mode=='kirim'){
		  	$kores	= $this->m_umum->ambil_data('ol_korespodensi','id_korespodensi',$data['id2']);
		  		 if($kores['status_korespodensi'] < 3){
					  if($this->m_ol_administrator->rubah_status_korespodensi($data['id2'],$data['id'])){
							redirect(base_url('ol_administrator/pengajuan_korespodensi'));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
							redirect(base_url('ol_administrator/pengajuan_korespodensi'));
					  }
					}else{
							$this->session->set_flashdata('danger', 'Status Sudah Selesai');
							redirect(base_url('ol_administrator/pengajuan_korespodensi'));						
					}
      }
      if($mode=='hapus_ttd'){
      	$d	= $this->m_umum->ambil_data('ol_kor_detil','id_kor_detil',$data['id']);
      	$dx	= $this->m_umum->ambil_data('ol_korespodensi','barcode_korespodensi',$data['id2']);
      	$barcode_korespodensi = $dx['barcode_korespodensi'];
      	$status_korespodensi = $dx['status_korespodensi'];
      	$acc = $d['acc'];
		  	$kores	= $this->m_umum->ambil_data('ol_korespodensi','barcode_korespodensi',$barcode_korespodensi);
		  		 if($kores['status_korespodensi'] < 3){
		      	if($status_korespodensi == 1 && $acc == 0){
						  if($this->m_umum->hapus_data('ol_kor_detil','id_kor_detil',$data['id'])){
								$this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
								redirect(base_url('ol_administrator/pengajuan_korespodensi/validasi/'.$barcode_korespodensi));
						  }else{
								$this->session->set_flashdata('danger', 'Ada Masalah Hapus Data. Hubungi Admin');
								redirect(base_url('ol_administrator/pengajuan_korespodensi/validasi/'.$barcode_korespodensi));
						  }
						}else{
							$this->session->set_flashdata('danger', 'Status Data Bukan Proses / Sudah Validasi');
							redirect(base_url('ol_administrator/pengajuan_korespodensi/validasi/'.$barcode_korespodensi));
						}
					}else{
							$this->session->set_flashdata('danger', 'Status Sudah Selesai');
							redirect(base_url('ol_administrator/pengajuan_korespodensi/validasi/'.$barcode_korespodensi));						
					}
      }
			if($mode=='print'){
					$data['page'] =  $data['page']."_print";
	//      	$dp	= $this->m_umum->ambil_data('ol_pengcab','barcode_pengcab',$data['id3']);
	      	$d	= $this->m_umum->ambil_data('ol_kor_kategori','barcode_kor_kategori',$data['id2']);
	      	$dx	= $this->m_umum->ambil_data('ol_korespodensi','barcode_korespodensi',$data['id']);
	      	$data['ambil_kor_detil_signature']	= $this->m_ol_rancak->ambil_kor_detil_pengcab($d['id_kor_kategori']);
	      	$data['id_korespodensi'] = $dx['id_korespodensi'];
	      	$data['id_kor_kategori'] = $d['id_kor_kategori'];
			 		$kondisi=array('id_kor_kategori'=>$d['id_kor_kategori']);
			 		$jml = $this->m_umum->jumlah_record_filter('ol_kor_detil',$kondisi);
			 		$kondisi2=array('acc !='=>1,'id_kor_kategori'=>$d['id_kor_kategori']);
			 		$jml2 = $this->m_umum->jumlah_record_filter('ol_kor_detil',$kondisi2);
			 		$kondisi3=array('id_kor_kategori'=>$d['id_kor_kategori']);
			 		$jml3 = $this->m_umum->jumlah_record_filter('ol_kor_print',$kondisi3);
			 		if($jml == 0){
			 			$this->session->set_flashdata('danger', 'Tambah Validator Dulu dan Validasi');
			 			redirect(base_url('ol_administrator/pengajuan_korespodensi/validasi/'.$data['id']));
			 		}
			 		if($jml2 > 0){
			 			$this->session->set_flashdata('danger', 'Masih Ada Yang Belum ACC');
			 			redirect(base_url('ol_administrator/pengajuan_korespodensi/validasi/'.$data['id']));
			 		}
			 		if($jml3 > 0){
			 			$this->session->set_flashdata('danger', 'Data Print Sudah Ada');
			 			redirect(base_url('ol_administrator/pengajuan_korespodensi/validasi/'.$data['id']));
			 		}
	      	$data['no_kor_print']  = set_value('no_kor_print',$dx['no_korespodensi']);
	      	$data['title_kor_print']  = set_value('title_kor_print','SURAT PENGANTAR');
	      	$data['tmp_kor_print']  = set_value('tmp_kor_print',$this->input->post('tmp_kor_print'));
	      	$data['tmp_modul']  = set_value('tmp_modul',$this->input->post('tmp_modul'));
	      	$data['font_size']  = set_value('font_size','12');
	      	$data['tgl_awal']  = set_value('tgl_awal',date('d-m-Y'));
	      	$data['tgl_akhir']  = set_value('tgl_akhir',date('d-m-Y'));
	      	$data['tgl_kor_print']  = set_value('tgl_kor_print',date('d-m-Y'));
	      	$data['modul']  = set_value('modul',$this->input->post('modul'));
					$this->form_validation->set_rules('title_kor_print','title_kor_print','required');
				if ($this->form_validation->run() === FALSE){
					$this->tampil($data);
				}else{
					$barcode_korespodensi = $this->input->post("barcode_korespodensi");
		  	$kores	= $this->m_umum->ambil_data('ol_korespodensi','barcode_korespodensi',$barcode_korespodensi);
		  		 if($kores['status_korespodensi'] < 3){
						if($this->input->post('chk')){
							$id_kor_kategori = $this->input->post("id_kor_kategori");
					 		$kondisi=array('id_kor_kategori'=>$id_kor_kategori);
					 		$jml = $this->m_umum->jumlah_record_filter('ol_kor_print',$kondisi);
					 		if($jml > 0){
					 			$this->m_ol_rancak->rubah_status_kor_print($id_kor_kategori);
					 		}
						  if($last = $this->m_ol_rancak->simpan_kor_print()){
						  	$this->m_ol_rancak->simpan_kor_print_detil($last);
								$this->session->set_flashdata('sukses', 'Data Sudah Di Rubah');
								redirect(base_url('ol_administrator/pengajuan_korespodensi/validasi/'.$barcode_korespodensi));
						  }else{
								$this->session->set_flashdata('danger', 'Ada Masalah Rubah Data. Hubungi Admin');
								redirect(base_url('ol_administrator/pengajuan_korespodensi/validasi/'.$barcode_korespodensi));
						  }
						}else{
								$this->session->set_flashdata('danger', 'Belum Pilih Data Validator');
								redirect(base_url('ol_administrator/pengajuan_korespodensi/validasi/'.$barcode_korespodensi));						
						}
					}else{
							$this->session->set_flashdata('danger', 'Status Sudah Selesai');
							redirect(base_url('ol_administrator/pengajuan_korespodensi/validasi/'.$barcode_korespodensi));						
					}
				}
			}
			if($mode=='pdf_surat'){
				$d	= $this->m_ol_rancak->ambil_data_kor_print_4_print($data['id']);
				$report = $this->load->view($d['link_print'], $data, TRUE);
			  $filename = $d["nama_kategori"]."-".$d["nama_pegawai"]."-print-date-".date('d-m-Y').".pdf";
			  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
			  $mpdf->AddPage('P', '', '', '', 2, 5, 5, 5, 10, 3, 3);
			  $mpdf->SetDisplayMode('fullpage');
			  $mpdf->SetTitle($data['header']);
			  $mpdf->SetAuthor($data['instance_name']);
			  $mpdf->defaultheaderline = 0;
		      $mpdf->defaultfooterline = 0;
	//		  $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
				for ($i = 1; $i > 2; $i++) {
			  $mpdf->SetHTMLFooter('');
				}
			  ini_set("pcre.backtrack_limit", "5000000");
			  $mpdf->WriteHTML($report);
			  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		//    $mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'P','margin_left' => '5','margin_right' => '5','margin_top' => '5','margin_bottom' => '5']);
		//	  $mpdf = new \Mpdf\Mpdf(['format' => 'Legal']);
			// Define a default page size/format by array - page will be 190mm wide x 236mm height
			//  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [190, 236]]);
			// Define a default Landscape page size/format by name
	/* 		$mpdf->WriteHTML('Your Foreword and Introduction');
			$mpdf->setFooter('<div>Relatório emitido SiGeCentro  <br> {PAGENO}/{nb}</div>');
			$mpdf->WriteHTML('<pagebreak type="NEXT-ODD" pagenumstyle="1" />');
			$mpdf->WriteHTML('Your Book text');
			  $mpdf->SetFooter('Halaman : {PAGENO}');
	 $pdf->SetHTMLHeader('<img src="' . base_url() . 'custom/Hederinvoice.jpg"/>');

	    $pdf->SetHTMLFooter('<img src="' . base_url() . 'custom/footarinvoice.jpg"/>');
	    $wm = base_url() . 'custom/Watermark.png';

	      $data['main_content'] = 'dwnld';
	    //$this->load->view('template', $data);
	    $html = $this->load->view('template_pdf', $data, true);
	    $this->load->view('template_pdf', $data, true);
	    $pdf->AddPage('', // L - landscape, P - portrait
	        '', '', '', '',
	        5, // margin_left
	        5, // margin right
	       60, // margin top
	       30, // margin bottom
	        0, // margin header
	        0); // margin footer
	    $pdf->WriteHTML($html);
			  $mpdf->SetHTMLHeader('
			  <div style="text-align: right; font-weight: bold;">
			 	My document
			  </div>');
			$mpdf->SetHTMLFooter('
			<table width="100%">
				<tr>
					<td width="33%">{DATE j-m-Y}</td>
					<td width="33%" align="center">{PAGENO}/{nbpg}</td>
					<td width="33%" style="text-align: right;">My document</td>
				</tr>
			</table>');    */
			}
      if($mode=='hapus_kor_kategori'){
      	$d	= $this->m_umum->ambil_data('ol_kor_kategori','id_kor_kategori',$data['id']);
      	$dx	= $this->m_umum->ambil_data('ol_korespodensi','barcode_korespodensi',$data['id2']);
      	$barcode_korespodensi = $dx['barcode_korespodensi'];
		  	$kores	= $this->m_umum->ambil_data('ol_korespodensi','barcode_korespodensi',$barcode_korespodensi);
		  		 if($kores['status_korespodensi'] < 3){
			 		$kondisi=array('id_kor_kategori'=>$data['id']);
					$jml = $this->m_umum->jumlah_record_filter('ol_kor_detil',$kondisi);
					$kondisi2=array('id_korespodensi'=>$dx['id_korespodensi']);
					$jml2 = $this->m_umum->jumlah_record_filter('ol_kor_kategori',$kondisi2);
		      	if($jml == 0){
		      		if($jml2 == 0){
							  if($this->m_umum->hapus_data('ol_kor_kategori','id_kor_kategori',$data['id'])){
									$this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
									redirect(base_url('ol_administrator/pengajuan_korespodensi/validasi/'.$barcode_korespodensi));
							  }else{
									$this->session->set_flashdata('danger', 'Ada Masalah Hapus Data. Hubungi Admin');
									redirect(base_url('ol_administrator/pengajuan_korespodensi/validasi/'.$barcode_korespodensi));
							  }
							}else{
								$this->session->set_flashdata('danger', 'Minimal 1 kategori');
								redirect(base_url('ol_administrator/pengajuan_korespodensi/validasi/'.$barcode_korespodensi));						
							}
						}else{
							$this->session->set_flashdata('danger', 'Hapus Dulu Data Validator');
							redirect(base_url('ol_administrator/pengajuan_korespodensi/validasi/'.$barcode_korespodensi));
						}
					}else{
							$this->session->set_flashdata('danger', 'Status Sudah Selesai');
							redirect(base_url('ol_administrator/pengajuan_korespodensi/validasi/'.$barcode_korespodensi));						
					}
      }
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
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
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
				redirect(base_url('ol_administrator/registrasi/view/'.$key));
			}
		}
  else if($mode=='hapus'){
  		$this->m_umum->hapus_data('ol_registrasi','barcode_registrasi',$data['id']);
    	redirect(base_url('ol_administrator/registrasi'));
  }
		else if($mode=='data'){
			echo json_encode($this->m_ol_administrator->registrasi_all($data['id']));
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
								if($Q = $this->m_ol_administrator->simpan_aktifasi()){
									$this->m_ol_administrator->simpan_user($Q);
									if($id_instansi > 0){
									$this->m_ol_administrator->simpan_instansi($Q);
									}
									$this->m_umum->hapus_data('ol_registrasi','barcode_registrasi',$barcode_registrasi);
									$this->session->set_flashdata('sukses', 'Data berhasil Di Tambah');
									redirect(base_url('ol_administrator/registrasi'));
								}else{
									$this->session->set_flashdata('danger', 'Ada Masalah Edit Data');
									redirect(base_url('ol_administrator/registrasi'));
								}
							}else{
							  $this->session->set_flashdata('danger', 'No KTP Sudah Ada');
							  redirect(base_url('ol_administrator/registrasi'));
							}
						}
						else{
							$this->session->set_flashdata('danger', 'Username Sudah Ada');
							redirect(base_url('ol_administrator/registrasi'));
						}
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
				redirect(base_url('ol_administrator/user/view/'.$key));
			}
		}
		else if($mode=='data'){
			echo json_encode($this->m_ol_administrator->member_all($this->session->list_pengcab,$data['id']));
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
						if($this->m_ol_administrator->edit_pegawai()){
							$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
							redirect(base_url('ol_administrator/user'));
						}else{
							$this->session->set_flashdata('danger', 'Ada Masalah Edit Data');
							redirect(base_url('ol_administrator/user'));
						}
					}
					else{
						$this->session->set_flashdata('danger', 'Nomor KTP Sudah Ada');
						redirect(base_url('ol_administrator/user'));
					}
				}
			}
			if($mode=='reset'){
			  if($this->m_ol_administrator->reset_password($data['id'])){
  				$this->session->set_flashdata('sukses', 'Password di Reset menjadi 7654321');
  				redirect(base_url('ol_administrator/user'));
			  }else{
					$this->session->set_flashdata('danger', 'Masalah Edit Data');
					redirect(base_url('ol_administrator/user'));
			  }
			}
		}
	}
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("ol_administrator/header",$data);
	$this->load->view("ol_administrator/isi");
	$this->load->view("footer");
	$this->load->view("ol_administrator/jsload");
	$this->load->view("ol_administrator/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_top",$data);
	$this->load->view("ol_administrator/isi");
	$this->load->view("footer");
	$this->load->view("ol_administrator/jsload");
	$this->load->view("ol_administrator/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
