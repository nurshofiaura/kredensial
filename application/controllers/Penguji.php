<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Penguji extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
		  $this->login_kah();
          $this->load->model('m_berkas');
          $this->load->model('m_penguji');
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
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==98 )
              return TRUE;
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==15 )
          return TRUE;
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==12 )
          return TRUE;
     	else
          redirect(base_url('logout'));
  }
	function index(){
		$data['page']="home";
		$data['header'] = "BERANDA";
		$data['title'] = "BERANDA";
		$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
		$program    = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','2');
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
		$data['ambil_pengumuman']   = $this->m_rancak->ambil_pengumuman($pegawai['id_jabatan'],$pegawai['id_level'],$program['jabatan']);
		$data['ambil_berkas_expired_all']=$this->m_rancak->ambil_berkas_expired_all();
		$this->tampil($data);
	}
  function pengajuan_kompetensi($mode='view')
  {
	$data['page']  = "pengajuan_kompetensi";
	$data['header'] = "VALIDASI PENGAJUAN KOMPETENSI";
	$data['title'] = "VALIDASI PENGAJUAN KOMPETENSI";
	$data['link_kembali'] = base_url('penguji');
	$data['link_awal'] = base_url('penguji/pengajuan_kompetensi');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$program    = $this->m_umum->ambil_data('a_program','id_program',$pegawai["id_program"]);
	$program_ppni    = $this->m_umum->ambil_data('a_program','id_program','1');
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
	$data['member_id'] = $pegawai["id_pegawai"];
	$data['level_id'] = $pegawai["id_level"];
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
	$data['idp'] = $this->uri->segment(5, 0);
	if(empty($data['id'])){
		$data['id'] = '0';
	}
    if($mode=='view'){
		$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_penguji->pengajuan_kompetensi_all($program_ppni['jabatan'],$pegawai['id_level'],$pegawai['id_pegawai']));
	}
    else if($mode=='data2'){
		echo json_encode($this->m_penguji->logbook_all_a_b($data['id']));
	}
    else if($mode=='pemulihan'){
		echo json_encode($this->m_penguji->tabel_pemulihan($data['id']));
	}
  else{
      if($mode=='isi'){
        $data['page'] =  $data['page']."_isi";
				$data['ambil_lobook_kompetensi_group_pengajuan']=$this->m_rancak->ambil_lobook_kompetensi_group_pengajuan($data['id']);
				$data['jml_komite_0']=$this->m_rancak->jumlah_record_logbook_pengajuan($data['id'],'v_komite','0');
				$data['jml_komite']=$this->m_rancak->jumlah_record_logbook_pengajuan($data['id'],'v_komite >','0');
				$data['jml_kabid']=$this->m_rancak->jumlah_record_logbook_pengajuan($data['id'],'v_kabid','2');
				$data['jml_asesor']=$this->m_rancak->jumlah_record_logbook_pengajuan($data['id'],'v_asesor','2');
				$data['jumlah_record_logbook_pengajuan']=$data['jml_komite']+$data['jml_kabid']+$data['jml_asesor'];
				$kondisi_logbook_pengajuan=array('id_pengajuan'=>$data['id']);
				$data['jml_all_logbook_pengajuan']=$this->m_umum->jumlah_record_filter('logbook',$kondisi_logbook_pengajuan);
				if($data['jml_all_logbook_pengajuan'] == $data['jumlah_record_logbook_pengajuan']){
					$data['tampilkan_button'] = 'sama';
				}else{
					$data['tampilkan_button'] = 'taksama';
				}
				$data['ambil_berkas_data']=$this->m_rancak->ambil_all_id_berkas_data();
				$d	=$this->m_rancak->ambil_pengajuan_kompetensi($data['id']);
				$jabfungnyae=$this->m_rancak->ambil_pegawai($d['id_pegawai']);
				$kondisi_jml_jabfunge=array('id_pegawai'=>$jabfungnyae['id_pegawai']);
				if($this->session->id_level !== '99'){
				$jml_jabfunge=$this->m_umum->jumlah_record_filter_array('pegawai',$kondisi_jml_jabfunge,'id_jabatan_fungsional',$program_ppni['jabatan_fungsional']);
				if($jml_jabfunge > 0){
					$this->session->set_flashdata('danger', 'Beda Jabatan Fungsional');
					redirect(base_url('penguji/pengajuan_kompetensi'));
				}
			  }
				$data['ambil_lobook_pemulihan']=$this->m_rancak->ambil_lobook_pemulihan($d['id_pegawai']);
				$data['id_pengajuan']  = set_value('id_pengajuan',$d["id_pengajuan"]);
				$data['id_status_diusulkan']  = set_value('id_status_diusulkan',$d["id_status_diusulkan"]);
				$data['id_berkas']  = explode(",", $d["id_berkas"]);
				$data['berkas']  = $d["id_berkas"];
				$data['tahun']  = date('Y', strtotime($d["tgl_pengajuan"]));
				$data['id_ijasah']  = explode(",", $d["id_ijasah"]);
				$data['id_str']  = explode(",", $d["id_str"]);
				$data['id_sertifikat']  = explode(",", $d["id_sertifikat"]);
				$data['kesesuaian_bukti']  = set_value('kesesuaian_bukti',explode(",", $d["kesesuaian_bukti"]));
				$data['id_etik_pegawai']  = set_value('id_etik_pegawai',explode(",", $d["id_etik_pegawai"]));
				$data['id_logbook_a']  = set_value('id_logbook_a',$d["id_logbook_a"]);
				$data['id_logbook_b']  = set_value('id_logbook_b',$d["id_logbook_b"]);
				$data['status_pengajuan']  = set_value('status_pengajuan',$d["status_pengajuan"]);
				$data['acc_kabid']  = set_value('acc_kabid',$d["acc_kabid"]);
				$data['acc_asesor']  = set_value('acc_asesor',$d["acc_asesor"]);
				$data['acc_komite']  = set_value('acc_komite',$d["acc_komite"]);
				$data['acc_direktur']  = set_value('acc_direktur',$d["acc_direktur"]);
				$data['acc_logbook_komite']  = set_value('acc_logbook_komite',$d["acc_logbook_komite"]);
				$data['id_pegawai']  = set_value('id_pegawai',$d["id_pegawai"]);
				$data['foto']  = set_value('foto',$d["foto"]);
				$data['nama_pegawai']  = set_value('nama_pegawai',$d["nama_pegawai"]);
				$data['tmp_lahir']  = set_value('tmp_lahir',$d["tmp_lahir"]);
				$data['tgl_lahir']  = set_value('tgl_lahir',$d["tgl_lahir"]);
				$data['nama_agama']  = set_value('nama_agama',$d["nama_agama"]);
				$data['nama_status_kawin']  = set_value('nama_status_kawin',$d["nama_status_kawin"]);
				$data['no_profesi']  = set_value('no_profesi',$d["no_profesi"]);
				$data['nip']  = set_value('nip',$d["nip"]);
				$data['nama_status_diusulkan'] = $d['nama_status_diusulkan'];
				$data['nama_pendidikan'] = $d['nama_pendidikan'];
				$data['no_hp'] = $d['no_hp'];
				$data['email'] = $d['email'];
				$data['nama_status_pegawai'] = $d['nama_status_pegawai'];
				$data['nama_ruangan'] = $d['nama_ruangan'];
				$data['nama_jabatan_fungsional'] = $d['nama_jabatan_fungsional'];
				$data['alamat'] = $d['alamat'];
				$data['ambil_data_etik_pegawai_oppe'] = $this->m_rancak->ambil_data_etik_pegawai_oppe($d['id_pegawai'],date('Y'));
		$this->tampil_top($data);
		$action = $this->input->post('action');
		$id_pengajuan = $this->input->post('id_pengajuan');
		if($action == 'BtnOke') {
			$this->m_penguji->Kabid_Acc($data['id'],$pegawai['id_pegawai']);
			redirect(base_url('penguji/pengajuan_kompetensi'));
		}
		if($action == 'BtnSimpan') {
			$this->m_penguji->Kabid_Simpan($data['id']);
			redirect(base_url('penguji/pengajuan_kompetensi'));
		}
		if($action == 'BtnTolak') {
			$this->m_penguji->Kabid_Tolak($data['id'],$pegawai['id_pegawai']);
			redirect(base_url('penguji/pengajuan_kompetensi'));
		}
		if($action == 'BtnProses') {
/* 			$jumlah_logbook_pengajuan = $this->m_penguji->jumlah_logbook_pengajuan($data['id']);
			if($jumlah_logbook_pengajuan == 0){ */
				$this->m_penguji->update_acc_kompetensi_kabid($data['id']);
				$this->session->set_flashdata('sukses', 'Data Sudah di Simpan');
				redirect(base_url('penguji/pengajuan_kompetensi/isi/'.$data['id']));
/* 			}else{
				$this->session->set_flashdata('danger', 'Mohon Validasi Semua Logbook');
				redirect(base_url('penguji/pengajuan_kompetensi/isi/'.$data['id']));
			} */
		}
	  }
      if($mode=='perbaiki'){
		$this->m_penguji->perbaiki_proses_kabid($data['id']);
		$this->session->set_flashdata('sukses', 'Data Pengajuan Sekarang Proses');
		redirect(base_url('penguji/pengajuan_kompetensi'));
      }
      if($mode=='proses_kabid'){
		$this->m_penguji->update_proses_kabid($data['id']);
		$this->session->set_flashdata('sukses', 'Data Pengajuan Sekarang Proses');
		redirect(base_url('penguji/pengajuan_kompetensi'));
      }
    if($mode=='lihat_pemulihan'){
      $data['page'] =  $data['page']."_lihat_pemulihan";
      $data['ambil_lobook_pemulihan_detil']=$this->m_rancak->ambil_kewenangan_lobook_pemulihan_detil2($data['id']);
      $this->load->view("penguji/isi",$data);
    }
    if($mode=='lihat_kegiatan'){
      $data['page'] =  $data['page']."_lihat_kegiatan";
      $data['ambil_lobook_pemulihan_detil']=$this->m_rancak->ambil_kewenangan_lobook_kegiatan_pemulihan_detil($data['id']);
      $this->load->view("penguji/isi",$data);
    }
      if($mode=='terbitkan'){
		$this->m_penguji->update_terbitkan($data['id'],$data['idp']);
		$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
		redirect(base_url('penguji/pengajuan_kompetensi'));
      }
      if($mode=='upload_kredensial'){
        $data['page'] =  $data['page']."_upload_kredensial";
		$data['halaman'] = 'upload_kredensial';
		$data['id_pengajuan']  = set_value('id_pengajuan',$data['id']);
		$this->form_validation->set_rules('id_pengajuan','id_pengajuan','required');
        if ($this->form_validation->run() === FALSE){
			$this->tampil($data);
        }else{
			$data = array();
			$filesCount = count($_FILES['upload_Files']['name']);
			for($i = 0; $i < $filesCount; $i++){
				$_FILES['upload_File']['name'] = $_FILES['upload_Files']['name'][$i];
				$_FILES['upload_File']['type'] = $_FILES['upload_Files']['type'][$i];
				$_FILES['upload_File']['tmp_name'] = $_FILES['upload_Files']['tmp_name'][$i];
				$_FILES['upload_File']['error'] = $_FILES['upload_Files']['error'][$i];
				$_FILES['upload_File']['size'] = $_FILES['upload_Files']['size'][$i];
				$uploadPath = 'assets/berkas/';
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'pdf';
				$config['encrypt_name'] = TRUE;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if($this->upload->do_upload('upload_File')){
					$id_pengajuan = $this->input->post('id_pengajuan');
					$user_pic=$this->m_umum->ambil_data('kr_pengajuan','id_pengajuan',$id_pengajuan);
					$cek_file=FCPATH.'assets/berkas/'.$user_pic['kredensial'];
					if(file_exists($cek_file)){
						unlink(FCPATH."assets/berkas/".$user_pic['kredensial']);
					}
					$fileData = $this->upload->data();
					$uploadData[$i]['kredensial'] = $fileData['file_name'];
					$uploadData[$i]['id_pengajuan'] =$this->input->post('id_pengajuan');
					$uploadData[$i]['tgl_kredensial'] = date('Y-m-d');
					$uploadData[$i]['id_kredensial'] =$pegawai['id_pegawai'];
				}
			}
			if(!empty($uploadData)){
				//Insert file information into the database
				$insert = $this->m_penguji->update_berkaspengajuan($uploadData);
				$statusMsg = $insert?'Files uploaded successfully.':'Some problem occurred, please try again.';
				$this->session->set_flashdata('statusMsg',$statusMsg);
			}
			redirect(base_url('penguji/pengajuan_kompetensi'));
		}
      }
      if($mode=='upload_mutu'){
        $data['page'] =  $data['page']."_upload_mutu";
        $data['halaman'] = 'upload_mutu';
		$data['id_pengajuan']  = set_value('id_pengajuan',$data['id']);
		$this->form_validation->set_rules('id_pengajuan','id_pengajuan','required');
        if ($this->form_validation->run() === FALSE){
			$this->tampil($data);
        }else{
			$data = array();
			$filesCount = count($_FILES['upload_Files']['name']);
			for($i = 0; $i < $filesCount; $i++){
				$_FILES['upload_File']['name'] = $_FILES['upload_Files']['name'][$i];
				$_FILES['upload_File']['type'] = $_FILES['upload_Files']['type'][$i];
				$_FILES['upload_File']['tmp_name'] = $_FILES['upload_Files']['tmp_name'][$i];
				$_FILES['upload_File']['error'] = $_FILES['upload_Files']['error'][$i];
				$_FILES['upload_File']['size'] = $_FILES['upload_Files']['size'][$i];
				$uploadPath = 'assets/berkas/';
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'pdf';
				$config['encrypt_name'] = TRUE;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if($this->upload->do_upload('upload_File')){
					$id_pengajuan = $this->input->post('id_pengajuan');
					$user_pic=$this->m_umum->ambil_data('kr_pengajuan','id_pengajuan',$id_pengajuan);
					$cek_file=FCPATH.'assets/berkas/'.$user_pic['mutu'];
					if(file_exists($cek_file)){
						unlink(FCPATH."assets/berkas/".$user_pic['mutu']);
					}
					$fileData = $this->upload->data();
					$uploadData[$i]['mutu'] = $fileData['file_name'];
					$uploadData[$i]['id_pengajuan'] =$this->input->post('id_pengajuan');
					$uploadData[$i]['tgl_mutu'] = date('Y-m-d');
					$uploadData[$i]['id_mutu'] =$pegawai['id_pegawai'];
				}
			}
			if(!empty($uploadData)){
				//Insert file information into the database
				$insert = $this->m_penguji->update_berkaspengajuan($uploadData);
				$statusMsg = $insert?'Files uploaded successfully.':'Some problem occurred, please try again.';
				$this->session->set_flashdata('statusMsg',$statusMsg);
			}
			redirect(base_url('penguji/pengajuan_kompetensi'));
		}
      }
      if($mode=='upload_etika'){
        $data['page'] =  $data['page']."_upload_etika";
		$data['halaman'] = 'upload_etika';
		$data['id_pengajuan']  = set_value('id_pengajuan',$data['id']);
		$this->form_validation->set_rules('id_pengajuan','id_pengajuan','required');
        if ($this->form_validation->run() === FALSE){
			$this->tampil($data);
        }else{
			$data = array();
			$filesCount = count($_FILES['upload_Files']['name']);
			for($i = 0; $i < $filesCount; $i++){
				$_FILES['upload_File']['name'] = $_FILES['upload_Files']['name'][$i];
				$_FILES['upload_File']['type'] = $_FILES['upload_Files']['type'][$i];
				$_FILES['upload_File']['tmp_name'] = $_FILES['upload_Files']['tmp_name'][$i];
				$_FILES['upload_File']['error'] = $_FILES['upload_Files']['error'][$i];
				$_FILES['upload_File']['size'] = $_FILES['upload_Files']['size'][$i];
				$uploadPath = 'assets/berkas/';
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'pdf';
				$config['encrypt_name'] = TRUE;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if($this->upload->do_upload('upload_File')){
					$id_pengajuan = $this->input->post('id_pengajuan');
					$user_pic=$this->m_umum->ambil_data('kr_pengajuan','id_pengajuan',$id_pengajuan);
					$cek_file=FCPATH.'assets/berkas/'.$user_pic['etika'];
					if(file_exists($cek_file)){
						unlink(FCPATH."assets/berkas/".$user_pic['etika']);
					}
					$fileData = $this->upload->data();
					$uploadData[$i]['etika'] = $fileData['file_name'];
					$uploadData[$i]['id_pengajuan'] =$this->input->post('id_pengajuan');
					$uploadData[$i]['tgl_etika'] = date('Y-m-d');
					$uploadData[$i]['id_etika'] =$pegawai['id_pegawai'];
				}
			}
			if(!empty($uploadData)){
				//Insert file information into the database
				$insert = $this->m_penguji->update_berkaspengajuan($uploadData);
				$statusMsg = $insert?'Files uploaded successfully.':'Some problem occurred, please try again.';
				$this->session->set_flashdata('statusMsg',$statusMsg);
			}
			redirect(base_url('penguji/pengajuan_kompetensi'));
		}
      }
      if($mode=='upload_spk'){
        $data['page'] =  $data['page']."_upload_spk";
		$data['halaman'] = 'upload_spk';
		$data['id_pengajuan']  = set_value('id_pengajuan',$data['id']);
		$this->form_validation->set_rules('id_pengajuan','id_pengajuan','required');
        if ($this->form_validation->run() === FALSE){
			$this->tampil($data);
        }else{
			$data = array();
			$filesCount = count($_FILES['upload_Files']['name']);
			for($i = 0; $i < $filesCount; $i++){
				$_FILES['upload_File']['name'] = $_FILES['upload_Files']['name'][$i];
				$_FILES['upload_File']['type'] = $_FILES['upload_Files']['type'][$i];
				$_FILES['upload_File']['tmp_name'] = $_FILES['upload_Files']['tmp_name'][$i];
				$_FILES['upload_File']['error'] = $_FILES['upload_Files']['error'][$i];
				$_FILES['upload_File']['size'] = $_FILES['upload_Files']['size'][$i];
				$uploadPath = 'assets/berkas/';
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'pdf';
				$config['encrypt_name'] = TRUE;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if($this->upload->do_upload('upload_File')){
					$id_pengajuan = $this->input->post('id_pengajuan');
					$user_pic=$this->m_umum->ambil_data('kr_pengajuan','id_pengajuan',$id_pengajuan);
					$cek_file=FCPATH.'assets/berkas/'.$user_pic['spk'];
					if(file_exists($cek_file)){
						unlink(FCPATH."assets/berkas/".$user_pic['spk']);
					}
					$fileData = $this->upload->data();
					$uploadData[$i]['spk'] = $fileData['file_name'];
					$uploadData[$i]['id_pengajuan'] =$this->input->post('id_pengajuan');
					$uploadData[$i]['tgl_spk'] = date('Y-m-d');
					$uploadData[$i]['id_spk'] =$pegawai['id_pegawai'];
				}
			}
			if(!empty($uploadData)){
				//Insert file information into the database
				$insert = $this->m_penguji->update_berkaspengajuan($uploadData);
				$statusMsg = $insert?'Files uploaded successfully.':'Some problem occurred, please try again.';
				$this->session->set_flashdata('statusMsg',$statusMsg);
			}
			redirect(base_url('penguji/pengajuan_kompetensi'));
		}
      }
	}
  }
	function cek_jabatan_untuk_simpan_logbook($id){
		$q = $this->db->get_where('jabatan',array('id_jabatan'=>$id));
		return $q->row_array();
	}
   function v_kabid_kompetensi(){
	$isi   = $this->uri->segment(3, 0);
	$tolak   = $this->uri->segment(4, 0);
	$id   = $this->uri->segment(5, 0);
	$id_pengajuan   = $this->uri->segment(6, 0);
	$idlb   = $this->uri->segment(7, 0);
	$d    = $this->m_rancak->ambil_pegawai_dari_pengajuan($id_pengajuan); //asesi
	$d2	=$this->m_rancak->ambil_logbook_pegawai($idlb); //logbook
	$data['v_asesor'] = $d2['v_asesor'];
	$data['id_kewenangan'] = $d2['id_kewenangan'];
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user); //admin
	if($pegawai['id_pegawai'] !== $d['id_pegawai']){
		if($d['acc_logbook_komite']=='0'){
	//		if($d2['v_asesor']==1 AND $d['id_status_diusulkan'] !== 4){
				$this->m_penguji->update_v_kabid_kompetensi($isi,$tolak,$id,$pegawai['id_pegawai'],$id_pengajuan);
		$krkd = $this->cek_jabatan_untuk_simpan_logbook($d['id_jabatan']);
		if($krkd['validate'] == 1){				
				$kondisi=array('id_pegawai'=>$pegawai['id_pegawai'],'id_kewenangan'=>$data['id_kewenangan']);
				$jml = $this->m_umum->jumlah_record_filter('kr_kewenangan_lulus',$kondisi);
				if($isi=='1'){
					if($jml == 0){
						$this->m_penguji->simpan_kewenangan_lulus($data['id_kewenangan'],$pegawai['id_pegawai']);
					}
				}else{
					if($jml > 0){
						$this->m_penguji->hapus_kewenangan_lulus($data['id_kewenangan'],$pegawai['id_pegawai']);
					}
				}
		}
	//		}
		}
	}
	redirect(base_url('penguji/pengajuan_kompetensi/isi/'.$id_pengajuan));
   }
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("penguji/header",$data);
	$this->load->view("penguji/isi");
	$this->load->view("footer");
	$this->load->view("penguji/jsload");
	$this->load->view("penguji/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_top",$data);
	$this->load->view("penguji/isi");
	$this->load->view("footer");
	$this->load->view("penguji/jsload");
	$this->load->view("penguji/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
