<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Ol_registrasi extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
          $this->load->model('m_ol_rancak');
          $this->load->model('m_ol_registrasi');
          $this->load->model('m_online');
  }
 // ================================================ USER ==================================
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
  function check_nik(){
		$nik=$this->input->post('nik');
		$kondisi=array('nik'=>$nik);
		$jml = $this->m_umum->jumlah_record_filter('ol_pegawai',$kondisi);
		if($jml == 0){
			echo "<span style='color:green'> No KTP Tersedia.</span>";
		}else{
			echo "<span style='color:red'> No KTP Sudah Ada</span>";
		}
	}
  function jabfung_data($id)
  {
    if($id < 3){
      $ids = '1';
    }else{
      $ids = '3';
    }
    $dt=$this->m_rancak->ambil_data_dropdown_jabfung_registrasi($ids);
    echo json_encode($dt);
  }
  function index()
  {
  	$this->registrasi();
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
  function registrasi()
  {
		$data['page']  = "registrasi";
		$data['header'] = "REGISTRASI KREDENSIAL ONLINE";
		$onlinekah = $this->m_umum->ambil_data('a_online','kode_online','ol_registrasi');
		$ologin = $this->m_umum->ambil_data('a_online','kode_online','ppni_registrasi');
		if($ologin['status_online'] == 0){
			redirect(base_url());
		}		
		if($onlinekah['status_online'] == 1){
			$data['title'] = "DAFTAR ONLINE";
		}else{
			$data['title'] = "DAFTAR ONLINE MENGGUNAKAN BARCODE REGISTRASI";
		}		
		$data['status_online'] = $onlinekah["status_online"];
		$bsloginkah = $this->m_umum->ambil_data('a_online','kode_online','ppni_registrasi');
		$data['ppni_online'] = $bsloginkah["status_online"];
		$data['link_kembali'] = base_url();
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$data['instance_id'] = $instansi["id_instansi"];
		$data['instance_name'] = $instansi["nama_instansi"];
		$data['idescription'] = $instansi["description"];
		$data['ikeywords'] = $instansi["keywords"];
		$data['iheader'] = $instansi["header"];
		$data['iheader_mini'] = $instansi["header_mini"];
		$data['ifooter'] = $instansi["footer"];
		$data['ilicensed'] = $instansi["licensed"];
		$data['pake_wa'] = $instansi["wa"];
		$data['cmd_tipe_pegawai'] = $this->m_ol_rancak->cmd_tipe_pegawai_null();
		$data['status'] = $this->m_rancak->cmd_status();
		$data['gender'] = $this->m_rancak->cmd_jk();
		$data['ambil_data_rujukan_instansi'] = $this->m_ol_rancak->ambil_data_rujukan_working_null();
		$data['cmd_unit_null'] = $this->m_rancak->struktur_jabatan_as_unit();
		$data['cmd_agama'] = $this->m_rancak->cmd_agama();
		$data['cmd_status_kawin'] = $this->m_rancak->cmd_status_kawin();
		$data['cmd_pendidikan'] = $this->m_rancak->cmd_pendidikan();
		$data['opsi_status_perawat'] = $this->m_ol_rancak->status_perawat();
		$data['kol_kode_kewenangan_null'] = $this->m_ol_rancak->kol_kode_kewenangan_null();
		$data['kol_provinsi'] = $this->m_rancak->cmd_kol_provinsi();
		$data['id']   = $this->uri->segment(3, 0);
    $data['kab']=array("");
    $data['kec']=array("");
    $data['kel']=array("");
    $data['cmd_jabfung']=array("");
    $data['null_pengcab']=array("");
		if($onlinekah['status_online'] == 1)	{
			$data['id_instansi']  = set_value('id_instansi',$this->input->post("id_instansi"));
			$data['barcode_registrasi']  = set_value('barcode_registrasi',$this->input->post("barcode_registrasi"));
		}else{
			$kondisi=array('status_registrasi'=>'0','barcode_registrasi',$data['id']);
			$jml = $this->m_umum->jumlah_record_filter('ol_registrasi',$kondisi);
			$reg = $this->m_umum->ambil_data('ol_registrasi','barcode_registrasi',$data['id']);
			$data['status_registrasi']  = set_value('status_registrasi',$reg['status_registrasi']);
			if($reg['status_registrasi'] == 0){
		 		$data['barcode_registrasi']  = set_value('barcode_registrasi',$reg['barcode_registrasi']);
		 		$data['id_instansi']  = set_value('id_instansi',$reg['id_instansi']);
		 	}else{
				$data['barcode_registrasi']  = set_value('barcode_registrasi',$this->input->post("barcode_registrasi"));
				$data['id_instansi']  = set_value('id_instansi',$this->input->post("id_instansi"));		 		
		 	}
			
		}
			$data['nama_pegawai']  = set_value('nama_pegawai',$this->input->post("nama_pegawai"));
			$data['jk']  = set_value('jk',$this->input->post("jk"));
			$data['tmp_lahir']  = set_value('tmp_lahir',$this->input->post("tmp_lahir"));
			$data['tgl_lahir']  = set_value('tgl_lahir',date('d-m-Y'));
			$data['email']  = set_value('email',$this->input->post("email"));
			$data['no_hp']  = set_value('no_hp',$this->input->post("no_hp"));
			$data['nip']  = set_value('nip',$this->input->post("nip"));
			$data['nik']  = set_value('nik',$this->input->post("nik"));
			$data['no_profesi']  = set_value('no_profesi',$this->input->post("no_profesi"));
			$data['id_status_kawin']  = set_value('id_status_kawin',$this->input->post("id_status_kawin"));
			$data['id_agama']  = set_value('id_agama',$this->input->post("id_agama"));
			$data['id_pendidikan']  = set_value('id_pendidikan',$this->input->post("id_pendidikan"));
			$data['alamat']  = set_value('alamat',$this->input->post("alamat"));
			$data['username']  = set_value('username',$this->input->post("username"));
			$data['id_pengcab']  = set_value('id_pengcab',$this->input->post('id_pengcab'));
			$data['id_kab']  = set_value('id_kab',$this->input->post('id_kab'));
			$data['id_kel']  = set_value('id_kel',$this->input->post('id_kel'));
			$data['id_kec']  = set_value('id_kec',$this->input->post('id_kec'));
			$data['id_prov']  = set_value('id_prov',$this->input->post('id_prov'));
			$data['id_jabatan_fungsional']  = set_value('id_jabatan_fungsional',$this->input->post('id_jabatan_fungsional'));
			$data['tipe_pegawai']  = set_value('tipe_pegawai',$this->input->post("tipe_pegawai"));
			$data['id_kode_kewenangan']  = set_value('id_kode_kewenangan',$this->input->post("id_kode_kewenangan"));
			$data['status_perawat']  = set_value('status_perawat',$this->input->post("status_perawat"));
		$this->form_validation->set_rules('nama_pegawai','nama_pegawai','required');
    if ($this->form_validation->run() === FALSE){
			$this->tampil($data);
    }else{
    	$ppni_online = $this->input->post('ppni_online');
    	$id_jabatan_fungsional = $this->input->post('id_jabatan_fungsional');
    	$barcode_registrasi = $this->input->post('barcode_registrasi');
    	$nik = $this->input->post('nik');
    	$status_online = $this->input->post('status_online');
      $kondisi2=array('nik'=>$nik); //id_pendaftaran
      $kondisi=array('barcode_registrasi'=>$barcode_registrasi,'status_registrasi'=>'0'); //id_pendaftaran
      $data['jml'] = $this->m_umum->jumlah_record_filter('ol_registrasi',$kondisi);
      $data['jml2'] = $this->m_umum->jumlah_record_filter('ol_pegawai',$kondisi2);
      $data['jml3'] = $this->m_umum->jumlah_record_filter('ol_registrasi',$kondisi2);
		    if($ppni_online == 0){
		    	$this->session->set_flashdata('sukses', 'Status Tidak Online');
		    	redirect(base_url());
	    	}else{ 
	      if($data['jml2'] == 0){
	      	if($data['jml3'] == 0){
		      	if($status_online == 0){
		      		if($data['jml'] == 0){
					      $this->session->set_flashdata('danger', 'Tidak Ada ID Terdeteksi / Sudah Diregistrasi');
					       redirect(base_url('ol_registrasi/registrasi'));
		      		}else{
					      $this->m_ol_registrasi->rubah_registrasi();
					      $this->session->set_flashdata('sukses', 'Data Sudah Tersimpan, Silahkan Hubungi Administrator');
					      redirect(base_url());
		      		}
		      	}else{
		      			$kode = $this->m_rancak->kode_generator(15,'RG');
		      			$this->m_ol_registrasi->simpan_barcode_registrasi($kode);
		      			$this->session->set_flashdata('sukses', 'Data Sudah Tersimpan, Silahkan Hubungi Administrator');
		      			redirect(base_url('ol_registrasi/registrasi'));	
		      	}
		      }else{
			      $this->session->set_flashdata('danger', 'Nomor KTP Sudah Ada');
			      redirect(base_url('ol_registrasi/registrasi'));	 	      	
		      }
	      }else{
		      $this->session->set_flashdata('danger', 'Nomor KTP Sudah Ada');
		      redirect(base_url('ol_registrasi/registrasi'));	      	
	      }	   
	    } 	
    }
  }
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("ol_registrasi/registrasi",$data);
}
// -----------------------------------------------------------END-----------------------------------------
}
