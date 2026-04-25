<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Ol_daftar extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
          $this->load->model('m_ol_rancak');
          $this->load->model('m_ol_daftar');
          $this->login_kah();
  }
/*  function login_kah(){
  	$link_akses = $this->uri->segment(1, 0);
		$kondisi_hak=array('id_pegawai'=>$this->session->id_pegawai,'link_akses'=>$link_akses);
		$jumlah_hak_akses_pegawai=$this->m_rancak->jumlah_hak_akses_pegawai($kondisi_hak);
		$jumlah_hak_akses_pegawai_ol=$this->m_ol_rancak->jumlah_hak_akses_pegawai($kondisi_hak);
		if($jumlah_hak_akses_pegawai == 0){
			if($jumlah_hak_akses_pegawai_ol == 0){
				$this->cek_login_kah();
			}else{
				return TRUE;
			}
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
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==52 )
          return TRUE;
      else
          redirect(base_url('logout'));
  }*/
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
/*  function cek_level()
  {
  	$cek_level=$this->m_ol_rancak->cek_online_level();
      if ( $cek_level['id_level'] ==96 )
          return TRUE;
      else
        //  redirect(base_url('logout'));
         // redirect(base_url('member'));
      $this->cek_online_kah();
  }*/
  function login_kah()
  {
      if ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==99 )
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
	function check_nik(){
		$nik=$this->input->post('nik');
		$kondisi=array('nik'=>$nik);
		$jml = $this->m_umum->jumlah_record_filter('ol_pegawai',$kondisi);
		if($jml == 0){
			echo "<span style='color:green'> NIK Tersedia.</span>";
		}else{
			echo "<span style='color:red'> NIK Sudah Ada</span>";
		}
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
	function daftar_registrasi($mode='view'){
		$data['page']="daftar_registrasi"; 
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
				redirect(base_url('ol_daftar/daftar_registrasi/view/'.$key));
			}
		}
		else if($mode=='data'){
			echo json_encode($this->m_ol_daftar->registrasi_all($data['id']));
		}
  else if($mode=='hapus'){
  		$this->m_umum->hapus_data('ol_registrasi','barcode_registrasi',$data['id']);
    	redirect(base_url('ol_daftar/daftar_registrasi'));
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
			if($mode=='buat_barcode'){
			  $data['page'] =  $data['page']."_buat_barcode";
				$data['id_instansi']  = set_value('id_instansi',$this->input->post('id_instansi'));
				$data['no_hp']  = set_value('no_hp',$this->input->post('no_hp'));
				$this->load->view("ol_daftar/isi",$data);
			}
			if($mode=='simpan_buat_barcode'){
				$kode = $this->m_rancak->kode_generator(15,'RG');
				  if($this->m_ol_daftar->simpan_barcode_registrasi($kode)){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Buat');
						redirect(base_url('ol_daftar/daftar_registrasi'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
						redirect(base_url('ol_daftar/daftar_registrasi'));
				  }
			}
			if($mode=='edit_barcode'){
			  $data['page'] =  $data['page']."_edit_barcode";
				$bres = $this->m_umum->ambil_data('ol_registrasi','barcode_registrasi',$data['id']);
				$data['barcode_registrasi']  = $bres['barcode_registrasi'];
				$data['id_instansi']  = $bres['id_instansi'];
				$data['cp']  = $bres['cp'];
				$this->load->view("ol_daftar/isi",$data);
			}
			if($mode=='simpan_edit_barcode'){
				  if($this->m_ol_daftar->edit_barcode_registrasi()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
						redirect(base_url('ol_daftar/daftar_registrasi'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
						redirect(base_url('ol_daftar/daftar_registrasi'));
				  }
			}
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
					$barcode_registrasi = $this->input->post('barcode_registrasi');
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
								if($Q = $this->m_ol_daftar->simpan_aktifasi()){
									$this->m_ol_daftar->simpan_user($Q);
									if($id_instansi > 0){
									$this->m_ol_daftar->simpan_instansi($Q);
									}
									$this->m_umum->hapus_data('ol_registrasi','barcode_registrasi',$barcode_registrasi);
									$this->session->set_flashdata('sukses', 'Data berhasil Di Tambah');
									redirect(base_url('ol_daftar/daftar_registrasi'));
								}else{
									$this->session->set_flashdata('danger', 'Ada Masalah Edit Data');
									redirect(base_url('ol_daftar/daftar_registrasi'));
								}
							}else{
							  $this->session->set_flashdata('danger', 'No KTP Sudah Ada');
							  redirect(base_url('ol_daftar/daftar_registrasi'));
							}
						}
						else{
							$this->session->set_flashdata('danger', 'Username Sudah Ada');
							redirect(base_url('ol_daftar/daftar_registrasi'));
						}
				}
			}
		}
	}
  function change_online(){
		$id   = $this->uri->segment(3, 0);
		$this->m_ol_daftar->edit_online_registrasi($id);
		redirect(base_url('ol_daftar/registrasi'));
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
	function user($mode='view'){
		$data['page']="user"; 
		$data['header'] = "DATA USER";
		$data['title'] = "DATA USER";
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
				redirect(base_url('ol_daftar/user/view/'.$key));
			}
		}
		else if($mode=='data'){
			echo json_encode($this->m_ol_daftar->member_all($data['id']));
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
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
    		$data['title'] = "TAMBAH USER";
    		$data['nama_pegawai']  = set_value('nama_pegawai',$this->input->post("nama_pegawai"));
    		$data['jk']  = set_value('jk',$this->input->post("jk"));    		
    		$data['tmp_lahir']  = set_value('tmp_lahir',$this->input->post("tmp_lahir"));    		
    		$data['tgl_lahir']  = set_value('tgl_lahir',date('d-m-Y'));    		
    		$data['email']  = set_value('email',$this->input->post("email"));
    		$data['no_hp']  = set_value('no_hp',$this->input->post("no_hp"));
    		$data['nik']  = set_value('nik',$this->input->post("nik"));
    		$data['nip']  = set_value('nip',$this->input->post("nip"));
    		$data['no_profesi']  = set_value('no_profesi',$this->input->post("no_profesi"));
    		$data['id_status_kawin']  = set_value('id_status_kawin',$this->input->post("id_status_kawin"));
    		$data['id_agama']  = set_value('id_agama',$this->input->post("id_agama"));
    		$data['id_pendidikan']  = set_value('id_pendidikan',$this->input->post("id_pendidikan"));
    		$data['id_jabatan_fungsional']  = set_value('id_jabatan_fungsional',$this->input->post("id_jabatan_fungsional"));
    		$data['alamat']  = set_value('alamat',$this->input->post("alamat"));
    		$data['foto']  = set_value('foto',$this->input->post("foto"));
    		$data['tipe_pegawai']  = set_value('tipe_pegawai',$this->input->post("tipe_pegawai"));
    		$data['status_perawat']  = set_value('status_perawat',$this->input->post("status_perawat"));
    		$data['id_kode_kewenangan']  = set_value('id_kode_kewenangan',$this->input->post("id_kode_kewenangan"));
    		$data['id_level']  = set_value('id_level',$this->input->post("id_level"));
    		$data['username']  = set_value('username',$this->input->post("username"));
    		$data['id_instansi']  = set_value('id_instansi',$this->input->post("id_instansi"));
    		$this->form_validation->set_rules('nama_pegawai','nama_pegawai','required');
        if ($this->form_validation->run() === FALSE){
			       $this->tampil($data);
        }else{
					$ptn = "/^0/";  // Regex
					$str = $this->input->post('no_hp'); 
					$nik = $this->input->post('nik');
					$rpltxt = "62";  // Replacement string
					$no_hp = preg_replace($ptn, $rpltxt, $str);
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
							if($Q = $this->m_ol_daftar->simpan_aktifasi()){
								$this->m_ol_daftar->simpan_user($Q);
								$this->m_ol_daftar->simpan_instansi($Q);
								$this->m_ol_daftar->edit_status_registrasi();
								$this->session->set_flashdata('sukses', 'Data berhasil Di Tambah');
								redirect(base_url('ol_daftar/user'));
							}else{
								$this->session->set_flashdata('danger', 'Ada Masalah Edit Data');
								redirect(base_url('ol_daftar/user'));
							}
						}else{
						  $this->session->set_flashdata('danger', 'No KTP Sudah Ada');
						  redirect(base_url('ol_daftar/user'));
						}
					}
					else{
						$this->session->set_flashdata('danger', 'Username Sudah Ada');
						redirect(base_url('ol_daftar/user'));
					}
        }
      }
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
						if($this->m_ol_daftar->edit_pegawai()){
							$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
							redirect(base_url('ol_daftar/user'));
						}else{
							$this->session->set_flashdata('danger', 'Ada Masalah Edit Data');
							redirect(base_url('ol_daftar/user'));
						}
					}
					else{
						$this->session->set_flashdata('danger', 'Nomor KTP Sudah Ada');
						redirect(base_url('ol_daftar/user'));
					}
				}
			}
			if($mode=='login'){
			  $data['page'] =  $data['page']."_login";
			  $data['cmd_level_no_member'] = $this->m_ol_rancak->cmd_level_no_member($program['user_level']);
			  $data['ambil_user_level_member']=$this->m_ol_rancak->ambil_user_level_member($data['id']);
				$data['id_level']  = set_value('id_level',$this->input->post("id_level"));
				$this->load->view("ol_daftar/isi",$data);
			}
			if($mode=='simpan_login'){
				$id_pegawai = $this->input->post('id_pegawai');
				$id_level = $this->input->post('id_level');
				if(!empty($id_level)){
					$kondisi=array('id_level'=>$id_level,'id_pegawai'=>$id_pegawai);
					$kondisi2=array('id_level'=>'51','id_pegawai'=>$id_pegawai);
					$cek_exist = $this->m_umum->jumlah_record_filter('ol_user',$kondisi);
					$cek_member = $this->m_umum->jumlah_record_filter('ol_user',$kondisi2);
					if($cek_exist == 0){
						if($cek_member == 0){
						  if($this->m_ol_daftar->simpan_login()){
								$this->session->set_flashdata('sukses', 'Data Berhasil Di Tambah');
								redirect(base_url('ol_daftar/user'));
						  }else{
								$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
								redirect(base_url('ol_daftar/user'));
						  }
						}else{
						  if($this->m_ol_daftar->edit_member()){
								$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
								redirect(base_url('ol_daftar/user'));
							}else{
								$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
								redirect(base_url('ol_daftar/user'));
							}
						}
					}else{
							$this->session->set_flashdata('danger', 'Level Sudah Ada');
							redirect(base_url('ol_daftar/user'));						
					}
				}else{
						$this->session->set_flashdata('danger', 'Data Level Kosong');
						redirect(base_url('ol_daftar/user'));						
				}
			}
			if($mode=='reset'){
			  if($this->m_ol_daftar->reset_password($data['id'])){
  				$this->session->set_flashdata('sukses', 'Password di Reset menjadi 7654321');
  				redirect(base_url('ol_daftar/user'));
			  }else{
					$this->session->set_flashdata('danger', 'Masalah Edit Data');
					redirect(base_url('ol_daftar/user'));
			  }
			}
		}
	}
	function level($mode='view'){
		$data['page']="level"; 
		$data['header'] = "DATA LEVEL";
		$data['title'] = "DATA LEVEL";
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
		if($mode=='view'){
			$this->tampil($data);
		}
		else if($mode=='data'){
			echo json_encode($this->m_ol_daftar->user_all());
		}
		else{
			$data['ambil_user_level_member']=$this->m_ol_rancak->cmd_level($program['user_level']);
  		$data['cmd_status'] = $this->m_rancak->cmd_status();
			if($mode=='edit'){
			  $data['page'] =  $data['page']."_edit";
				$take = $this->m_umum->ambil_data('ol_user','id_user',$data['id']);		
				$data['id_level']  = set_value('id_level',$take['id_level']);
				$data['status_user']  = set_value('status_user',$take['status_user']);
				$this->load->view("ol_daftar/isi",$data);
			}
			if($mode=='simpan_edit'){
				$id_pegawai = $this->input->post('id_pegawai');
				$id_level = $this->input->post('id_level');
				$id_level_lama = $this->input->post('id_level_lama');
				if(!empty($id_level)){
					$kondisi=array('id_level'=>$id_level,'id_level !='=>$id_level_lama,'id_pegawai'=>$id_pegawai);
					$kondisi2=array('id_level'=>'51','id_level !='=>$id_level_lama,'id_pegawai'=>$id_pegawai);
					$cek_exist = $this->m_umum->jumlah_record_filter('ol_user',$kondisi);
					$cek_member = $this->m_umum->jumlah_record_filter('ol_user',$kondisi2);
					if($cek_exist == 0){
						  if($this->m_ol_daftar->edit_level()){
								$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
								redirect(base_url('ol_daftar/level'));
							}else{
								$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
								redirect(base_url('ol_daftar/level'));
							}
					}else{
							$this->session->set_flashdata('danger', 'Level Sudah Ada');
							redirect(base_url('ol_daftar/level'));						
					}
				}else{
						$this->session->set_flashdata('danger', 'Data Level Kosong');
						redirect(base_url('ol_daftar/level'));						
				}
			}
		}
	}
	function akses($mode='view'){
		$data['page']="akses"; 
		$data['header'] = "DATA MULTI AKSES PEGAWAI / MEMBER";
		$data['title'] = "DATA MULTI AKSES PEGAWAI / MEMBER";
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
		$data['int']   = $this->uri->segment(5, 0);
		if($mode=='view'){
			$this->tampil($data);
		}
		else if($mode=='data'){
			echo json_encode($this->m_ol_daftar->hak_akses_all($data['id']));
		}
		else{
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
        $data['hak_akses'] = $this->m_ol_rancak->multi_akses($program['akses']);
        $pegawaiw = $this->m_umum->ambil_data('ol_pegawai','barcode_pegawai',$data['id']);
        $data['id_pegawai'] = $pegawaiw["id_pegawai"];
    		$this->load->view("ol_daftar/isi",$data);
      }
      if($mode=='simpan_tambah'){
    		$id_pegawai= $this->input->post('barcode_pegawai');
			  $this->m_ol_daftar->simpan_pegawai_akses();
				$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
				redirect(base_url('ol_daftar/akses/view/'.$id_pegawai));
      }
			if($mode=='status'){
					$pegakses = $this->m_umum->ambil_data('ol_akses','id_ol_akses',$data['int']);
				  if($this->m_ol_daftar->status_pegawai_akses($data['id'],$data['int'])){
						$this->session->set_flashdata('sukses', 'Sukses Rubah Status');
						redirect(base_url('ol_daftar/akses/view/'.$pegakses['id_pegawai']));	  	
				  }else{
						$this->session->set_flashdata('danger', 'Masalah Edit Data');
						redirect(base_url('ol_daftar/akses/view/'.$pegakses['id_pegawai']));
				  }
			}
		}
	}
	function work($mode='view'){
		$data['page']="work"; 
		$data['header'] = "DATA INSTANSI";
		$data['title'] = "DATA INSTANSI";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
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
		}
		else if($mode=='data'){
			echo json_encode($this->m_ol_daftar->work_all());
		}
		else{
			  $data['kol_provinsi'] = $this->m_rancak->cmd_kol_provinsi();
			  $data['cmd_kategori_working'] = $this->m_ol_rancak->cmd_kategori_working();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		    $data['kab']=array("");
		    $data['kec']=array("");
		    $data['kel']=array("");
    		$data['nama_working']  = set_value('nama_working',$this->input->post("nama_working"));
    		$data['alamat_working']  = set_value('alamat_working',$this->input->post("alamat_working"));    		
    		$data['email_working']  = set_value('email_working',$this->input->post("email_working"));    			
    		$data['kontak_working']  = set_value('kontak_working',$this->input->post("kontak_working"));
    		$data['id_cara_masuk']  = set_value('id_cara_masuk',$this->input->post("id_cara_masuk"));
    		$data['id_prov']  = set_value('id_prov',$this->input->post("id_prov"));
    		$data['id_kab']  = set_value('id_kab',$this->input->post("id_kab"));
    		$data['id_kel']  = set_value('id_kel',$this->input->post("id_kel"));
    		$data['id_kec']  = set_value('id_kec',$this->input->post("id_kec"));
    		$this->form_validation->set_rules('nama_working','nama_working','required');
        if ($this->form_validation->run() === FALSE){
			       $this->tampil($data);
        }else{
					if($this->m_ol_daftar->simpan_ol_instansi()){
						$this->session->set_flashdata('sukses', 'Data berhasil Di Tambah');
						redirect(base_url('ol_daftar/work'));
					}else{
						$this->session->set_flashdata('danger', 'Ada Masalah Akses Data');
						redirect(base_url('ol_daftar/work'));
					}
        }
      }
			if($mode=='edit'){
				$data['page'] =  $data['page']."_edit";
					$take = $this->m_umum->ambil_data('kol_working','id_working',$data['id']);		
					$data['id_working']  = set_value('id_working',$take['id_working']);
					$data['id_cara_masuk']  = set_value('id_cara_masuk',$take['id_cara_masuk']);
					$data['nama_working']  = set_value('nama_working',$take['nama_working']);
					$data['alamat_working']  = set_value('alamat_working',$take['alamat_working']);
					$data['email_working']  = set_value('email_working',$take['email_working']);
					$data['kontak_working']  = set_value('kontak_working',$take['kontak_working']);
					$data['id_prov']  = set_value('id_prov',$take['id_prov']);		
					$data['id_kab']  = set_value('id_kab',$take['id_kab']);			
					$data['id_kel']  = set_value('id_kel',$take['id_kel']);
					$data['id_kec']  = set_value('id_kec',$take['id_kec']);
					$data['kab'] = $this->m_ol_rancak->ambil_data_dropdown_kab($take['id_prov']);
    			$data['kec'] = $this->m_ol_rancak->ambil_data_dropdown_kec($take['id_kab']);
    			$data['kel'] = $this->m_ol_rancak->ambil_data_dropdown_kel($take['id_kec']);
					$this->form_validation->set_rules('nama_working','nama_working','required');
				if ($this->form_validation->run() === FALSE){
					$this->tampil($data);
				}else{
					if($this->m_ol_daftar->edit_ol_instansi()){
						$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
						redirect(base_url('ol_daftar/work'));
					}else{
						$this->session->set_flashdata('danger', 'Ada Masalah Akses Data');
						redirect(base_url('ol_daftar/work'));
					}
				}
			}
		}
	}
	function working($mode='view'){
		$data['page']="working"; 
		$data['header'] = "DATA TEMPAT BEKERJA";
		$data['title'] = "DATA TEMPAT BEKERJA";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$stpeg = $this->m_umum->ambil_data('a_online','kode_online','ol_status_pegawai');
		$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
		$propinsie = $this->m_umum->ambil_data('ol_pengcab','id_pengcab',$pegawai['id_pengcab']);
		$data['prov_id'] = $propinsie["id_prov"];
		$data['pengcab_id'] = $pegawai["id_pengcab"];
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
		}
		else if($mode=='data'){
			echo json_encode($this->m_ol_daftar->working_all());
		}
		else{
			  $data['cmd_status'] = $this->m_rancak->cmd_bekerja();
			  $data['ambil_data_rujukan_working'] = $this->m_ol_rancak->ambil_data_rujukan_working();
			if($mode=='edit'){
			  $data['page'] =  $data['page']."_edit";
				$take = $this->m_umum->ambil_data('ol_pegawai_instansi','id_pegawai_instansi',$data['id']);		
				$data['id_instansi']  = set_value('id_instansi',$take['id_instansi']);
				$data['id_pegawai']  = set_value('id_pegawai',$take['id_pegawai']);
				$data['status_pegawai_instansi']  = set_value('status_pegawai_instansi',$take['status_pegawai_instansi']);
				$this->load->view("ol_daftar/isi",$data);
			}
			if($mode=='simpan_edit'){
				$id_instansi = $this->input->post('id_instansi');
				$id_pegawai = $this->input->post('id_pegawai');
				$id_instansi_lama = $this->input->post('id_instansi_lama');
				$kondisi=array('id_instansi'=>$id_instansi,'id_instansi !='=>$id_instansi_lama,'id_pegawai'=>$id_pegawai);
				$jml = $this->m_umum->jumlah_record_filter('ol_pegawai_instansi',$kondisi);
				if($jml == 0){
				  if($this->m_ol_daftar->edit_pegawai_instansi()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('ol_daftar/working'));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
						redirect(base_url('ol_daftar/working'));
					}
				}else{
							$this->session->set_flashdata('danger', 'Data Sudah Ada');
							redirect(base_url('member/working'));					
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
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$stpeg = $this->m_umum->ambil_data('a_online','kode_online','ol_status_pegawai');
		$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
		$propinsie = $this->m_umum->ambil_data('ol_pengcab','id_pengcab',$pegawai['id_pengcab']);
		$data['prov_id'] = $propinsie["id_prov"];
		$data['pengcab_id'] = $pegawai["id_pengcab"];
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
		$data['cmd_status'] = $this->m_rancak->cmd_status();
		$data['ambil_data_rujukan_working_null'] = $this->m_ol_rancak->ambil_data_rujukan_working_null();
		$data['ambil_data_rujukan_working'] = $this->m_ol_rancak->ambil_data_rujukan_working();
		$data['id_working']  = set_value('id_working',$this->input->post('id_working'));
    if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$id = $this->input->post("id_working");
				redirect(base_url('ol_daftar/unit/view/'.$id));
			}
		}
    else if($mode=='data'){
			echo json_encode($this->m_ol_daftar->unit_all($data['id']));
		}
  	else{
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['id_instansi']  = set_value('id_instansi',$this->input->post('id_instansi'));
				$data['nama_unit']  = set_value('nama_unit',$this->input->post('nama_unit'));
				$data['status_unit']  = set_value('status_unit',$this->input->post('status_unit'));
				$this->load->view("ol_daftar/isi",$data);
      }
      if($mode=='simpan_tambah'){
      	$id_instansi = $this->input->post('id_instansi');
      	$nama_unit = $this->input->post('nama_unit');
				$kondisi=array('id_instansi'=>$id_instansi,'nama_unit'=>$nama_unit);
				$jml = $this->m_umum->jumlah_record_filter('ol_unit',$kondisi);
				if($jml == 0){
				  if($this->m_ol_daftar->simpan_ol_unit()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('ol_daftar/unit'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
						redirect(base_url('ol_daftar/unit'));
				  }
				}else{
						$this->session->set_flashdata('danger', 'Data Sudah Ada');
						redirect(base_url('ol_daftar/unit'));					
				}
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('ol_unit','id_unit',$data['id']);
				$data['nama_unit']  = set_value('nama_unit',$keuangan["nama_unit"]);
				$data['id_unit']  = set_value('id_unit',$keuangan["id_unit"]);
				$data['id_instansi']  = set_value('id_instansi',$keuangan["id_instansi"]);
				$data['status_unit']  = set_value('status_unit',$keuangan["status_unit"]);
				$this->load->view("ol_daftar/isi",$data);
      }
      if($mode=='simpan_edit'){
      	$id_instansi = $this->input->post('id_instansi');
      	$nama_unit = $this->input->post('nama_unit');
      	$nama_unit_lama = $this->input->post('nama_unit_lama');
				$kondisi=array('id_instansi'=>$id_instansi,'nama_unit'=>$nama_unit,'nama_unit !='=>$nama_unit_lama);
				$jml = $this->m_umum->jumlah_record_filter('ol_unit',$kondisi);
				if($jml == 0){
				  if($this->m_ol_daftar->edit_ol_unit()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
						redirect(base_url('ol_daftar/unit'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
						redirect(base_url('ol_daftar/unit'));
				  }
				}else{
						$this->session->set_flashdata('danger', 'Data Sudah Ada');
						redirect(base_url('ol_daftar/unit'));					
				}					  
      }
		}
  }
	function status_pegawai($mode='view'){
		$data['page']="status_pegawai"; 
		$data['header'] = "DATA STATUS PEGAWAI";
		$data['title'] = "DATA STATUS PEGAWAI";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$stpeg = $this->m_umum->ambil_data('a_online','kode_online','ol_status_pegawai');
		$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
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
		}
		else if($mode=='data'){
			echo json_encode($this->m_ol_daftar->status_pegawai_all($stpeg['status_online']));
		}
		else{
			  $data['cmd_status'] = $this->m_rancak->cmd_status();
			if($mode=='tambah'){
			  $data['page'] =  $data['page']."_tambah";
    		$data['nama_status_pegawai']  = set_value('nama_status_pegawai',$this->input->post("nama_status_pegawai"));
    		$data['status']  = set_value('status',$this->input->post("status"));    		
				$this->load->view("ol_daftar/isi",$data);
			}
			if($mode=='simpan_tambah'){
			  if($this->m_ol_daftar->simpan_status_pegawai()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('ol_daftar/status_pegawai'));
				}else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
					redirect(base_url('ol_daftar/status_pegawai'));
				}
			}
			if($mode=='edit'){
			  $data['page'] =  $data['page']."_edit";
				$take = $this->m_umum->ambil_data('ol_status_pegawai','id_status_pegawai',$data['id']);		
				$data['kunci']  = set_value('kunci',$take['kunci']);
				$data['nama_status_pegawai']  = set_value('nama_status_pegawai',$take['nama_status_pegawai']);
				$data['status']  = set_value('status',$take['status']);
				$this->load->view("ol_daftar/isi",$data);
			}
			if($mode=='simpan_edit'){
				$kunci = $this->input->post('kunci');
				if($kunci == 0){
				  if($this->m_ol_daftar->edit_status_pegawai()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('ol_daftar/status_pegawai'));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
						redirect(base_url('ol_daftar/status_pegawai'));
					}
				}else{
						$this->session->set_flashdata('danger', 'Tidak Dapat Merubah Data Ini');
						redirect(base_url('ol_daftar/status_pegawai'));					
				}
			}
		}
	}
  function jabfung_data_dropdown_pegawai_clicked($id)
  {
    $dt=$this->m_ol_rancak->ambil_data_dropdown_pegawai_clicked($this->session->id_jabatan,$id);
    echo json_encode($dt);
  }
	function kat_work($mode='view'){
		$data['page']="kat_work"; 
		$data['header'] = "DATA KATEGORI TEMPAT BEKERJA";
		$data['title'] = "DATA KATEGORI TEMPAT BEKERJA";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$stpeg = $this->m_umum->ambil_data('a_online','kode_online','ol_status_pegawai');
		$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
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
		}
		else if($mode=='data'){
			echo json_encode($this->m_ol_daftar->kat_work_all());
		}
		else{
			  $data['cmd_status'] = $this->m_rancak->cmd_status();
			if($mode=='tambah'){
			  $data['page'] =  $data['page']."_tambah";
    		$data['nama_kategori_work']  = set_value('nama_kategori_work',$this->input->post("nama_kategori_work"));  		
    		$data['status_kategori_work']  = set_value('status_kategori_work',$this->input->post("status_kategori_work"));  		
				$this->load->view("ol_daftar/isi",$data);
			}
			if($mode=='simpan_tambah'){
			  if($this->m_ol_daftar->simpan_kategori_work()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('ol_daftar/kat_work'));
				}else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
					redirect(base_url('ol_daftar/kat_work'));
				}
			}
			if($mode=='edit'){
			  $data['page'] =  $data['page']."_edit";
				$take = $this->m_umum->ambil_data('kol_kategori_work','id_kategori_work',$data['id']);		
				$data['nama_kategori_work']  = set_value('nama_kategori_work',$take['nama_kategori_work']);
				$data['status_kategori_work']  = set_value('status_kategori_work',$take['status_kategori_work']);
				$this->load->view("ol_daftar/isi",$data);
			}
			if($mode=='simpan_edit'){
			  if($this->m_ol_daftar->edit_kategori_work()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('ol_daftar/kat_work'));
				}else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
					redirect(base_url('ol_daftar/kat_work'));
				}
			}
		}
	}
	function jabatan_pengurus($mode='view'){
		$data['page']="jabatan_pengurus"; 
		$data['header'] = "DATA JABATAN PENGURUS";
		$data['title'] = "DATA JABATAN PENGURUS";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$stpeg = $this->m_umum->ambil_data('a_online','kode_online','ol_status_pegawai');
		$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
		$propinsie = $this->m_umum->ambil_data('ol_pengcab','id_pengcab',$pegawai['id_pengcab']);
		$data['prov_id'] = $propinsie["id_prov"];
		$data['pengcab_id'] = $pegawai["id_pengcab"];
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
		}
		else if($mode=='data'){
			echo json_encode($this->m_ol_daftar->jabatan_pengurus_all($stpeg['status_online']));
		}
		else{
			  $data['cmd_status'] = $this->m_rancak->cmd_status();
			if($mode=='tambah'){
			  $data['page'] =  $data['page']."_tambah";
    		$data['nama_ms_pengurus']  = set_value('nama_ms_pengurus',$this->input->post("nama_ms_pengurus"));
    		$data['status_ms_pengurus']  = set_value('status_ms_pengurus',$this->input->post("status_ms_pengurus"));    		
				$this->load->view("ol_daftar/isi",$data);
			}
			if($mode=='simpan_tambah'){
			  if($this->m_ol_daftar->simpan_ms_pengurus()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('ol_daftar/jabatan_pengurus'));
				}else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
					redirect(base_url('ol_daftar/jabatan_pengurus'));
				}
			}
			if($mode=='edit'){
			  $data['page'] =  $data['page']."_edit";
				$take = $this->m_umum->ambil_data('kol_ms_pengurus','id_ms_pengurus',$data['id']);		
				$data['nama_ms_pengurus']  = set_value('nama_ms_pengurus',$take['nama_ms_pengurus']);
				$data['kunci']  = set_value('kunci',$take['kunci']);
				$data['status_ms_pengurus']  = set_value('status_ms_pengurus',$take['status_ms_pengurus']);
				$this->load->view("ol_daftar/isi",$data);
			}
			if($mode=='simpan_edit'){
				$kunci = $this->input->post('kunci');
				if($kunci == 0){
				  if($this->m_ol_daftar->edit_ms_pengurus()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('ol_daftar/jabatan_pengurus'));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
						redirect(base_url('ol_daftar/jabatan_pengurus'));
					}
				}else{
						$this->session->set_flashdata('danger', 'Tidak Dapat Merubah Data Ini');
						redirect(base_url('ol_daftar/jabatan_pengurus'));					
				}
			}
		}
	}
	function cabang($mode='view'){
		$data['page']="cabang"; 
		$data['header'] = "DATA CABANG / WILAYAH";
		$data['title'] = "DATA CABANG / WILAYAH";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
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
		}
		else if($mode=='data'){
			echo json_encode($this->m_ol_daftar->pengurus_all());
		}
		else{
			  $data['ambil_data_pengcab'] = $this->m_ol_rancak->ambil_data_pengcab($this->session->id_jabatan);
			  $data['kol_provinsi'] = $this->m_rancak->cmd_kol_provinsi();
			  $data['cmd_jabatan'] = $this->m_rancak->cmd_jabatan();
		  if($mode=='tambah'){
				$data['page'] =  $data['page']."_tambah";
				$data['kab']=array("");
				$data['id_jabatan']  = set_value('id_jabatan',$this->input->post("id_jabatan"));
				$data['id_cabang']  = set_value('id_cabang',$this->input->post("id_cabang"));
				$data['nama_pengcab']  = set_value('nama_pengcab',$this->input->post("nama_pengcab"));
				$data['alamat_pengcab']  = set_value('alamat_pengcab',$this->input->post("alamat_pengcab"));    		
				$data['email_pengcab']  = set_value('email_pengcab',$this->input->post("email_pengcab"));    			
				$data['kontak_pengcab']  = set_value('kontak_pengcab',$this->input->post("kontak_pengcab"));
				$data['id_prov']  = set_value('id_prov',$this->input->post("id_prov"));
				$data['id_kab']  = set_value('id_kab',$this->input->post("id_kab"));
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
								$this->m_ol_daftar->simpan_ol_pengcab($fileData['file_name']);
								$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
								redirect(base_url('ol_daftar/cabang'));
							}else{
								$nole = '';
								$this->m_ol_daftar->simpan_ol_pengcab($nole);
								$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
								redirect(base_url('ol_daftar/cabang'));
							}
						}
				}
			}
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
							$this->m_ol_daftar->edit_ol_pengcab($fileData['file_name']);
							$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
							redirect(base_url('ol_daftar/cabang'));
						}else{
							$nole = '';
							$this->m_ol_daftar->edit_ol_pengcab($nole);
							$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
							redirect(base_url('ol_daftar/cabang'));
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
							$this->m_ol_daftar->edit_stempel_pengcab($fileData['file_name']);
							$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
							redirect(base_url('ol_daftar/cabang'));
						}else{
							$nole = '';
							$this->m_ol_daftar->edit_stempel_pengcab($nole);
							$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
							redirect(base_url('ol_daftar/cabang'));
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
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
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
		$data['ambil_data_pengcab'] = $this->m_ol_rancak->ambil_data_pengcab($this->session->id_jabatan);
		if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$id = $this->input->post("id_pengcab");
				redirect(base_url('ol_daftar/pengurus/view/'.$id));
			}
		}
		else if($mode=='data'){
			echo json_encode($this->m_ol_daftar->pengurusan_all($data['id']));
		}
		else{
			$data['ambil_data_ms_pengurus_no_null'] = $this->m_ol_rancak->ambil_data_ms_pengurus_no_null($this->session->id_jabatan,$data['prov_id']);
			$data['ambil_data_dropdown_pengcab'] = $this->m_ol_rancak->ambil_data_dropdown_pengcab($this->session->id_jabatan);
			$data['ambil_data_dropdown_pegawai'] = $this->m_ol_rancak->ambil_data_dropdown_pegawai_no_null($this->session->id_jabatan,$data['prov_id']);
			$data['cmd_status'] = $this->m_rancak->cmd_status();
		  if($mode=='tambah'){
				$data['page'] =  $data['page']."_tambah";
				$data['id_ms_pengurus']  = set_value('id_ms_pengurus',$this->input->post("id_ms_pengurus"));
				$this->form_validation->set_rules('id_ms_pengurus','id_ms_pengurus','required');
				if ($this->form_validation->run() === FALSE){
						   $this->tampil($data);
				}else{
					$this->m_ol_daftar->simpan_ol_pengurus();
					$this->session->set_flashdata('sukses', 'Data Sudah Di Tambah & Data Dobel Tidak Di Tambah');
					redirect(base_url('ol_daftar/pengurus'));
				}
			}
			if($mode=='edit'){
			  $data['page'] =  $data['page']."_edit";
				$take = $this->m_umum->ambil_data('ol_pengurus','id_pengurus',$data['id']);		
				$data['id_pengcab']  = set_value('id_pengcab',$take['id_pengcab']);
				$data['id_ms_pengurus']  = set_value('id_ms_pengurus',$take['id_ms_pengurus']);
				$data['status_pengurus']  = set_value('status_pengurus',$take['status_pengurus']);
				$this->load->view("ol_daftar/isi",$data);
			}
			if($mode=='simpan_edit'){
			$id_pengcab = $this->input->post('id_pengcab');
			$id_ms_pengurus_lama = $this->input->post('id_ms_pengurus_lama');
			$kondisi=array('ol_pengurus.id_pengcab'=>$id_pengcab,'id_ms_pengurus !='=>$id_ms_pengurus_lama,'id_jabatan'=>$this->session->id_jabatan);
			$jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_pengurus',$kondisi,'ol_pengcab','id_pengcab');
			if($jml == 0){
				  if($this->m_ol_daftar->edit_ol_pengurus()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('ol_daftar/pengurus'));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
						redirect(base_url('ol_daftar/pengurus'));
					}
				}else{
						$this->session->set_flashdata('danger', 'Data Sudah Ada');
						redirect(base_url('ol_daftar/pengurus'));					
				}
			}
		  if($mode=='tambah_pengurus'){
				$data['page'] =  $data['page']."_tambah_pengurus";
				$data['id_pegawai']  = set_value('id_pegawai',$this->input->post("id_pegawai"));
				$olp = $this->m_umum->ambil_data('ol_pengurus','barcode_pengurus',$data['id']);
				$data['id_pengurus']  = $olp['id_pengurus'];
				$this->form_validation->set_rules('id_pegawai','id_pegawai','required');
				if ($this->form_validation->run() === FALSE){
						   $this->tampil($data);
				}else{
			 		$kondisi=array('barcode_pengurus'=>$this->input->post('barcode_pengurus'));
					$jml = $this->m_umum->jumlah_record_filter('ol_pengurus',$kondisi);
					if($jml > 0){					
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
								$this->m_ol_daftar->simpan_ol_pegawai_pengurus($fileData['file_name']);
								$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
								redirect(base_url('ol_daftar/pegawai_pengurus'));
							}else{
								$nole = '';
								$this->m_ol_daftar->simpan_ol_pegawai_pengurus($nole);
								$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
								redirect(base_url('ol_daftar/pegawai_pengurus'));
							}
						}
					}else{
						$this->session->set_flashdata('danger', 'Data Tidak Ada');
						redirect(base_url('ol_daftar/pengurus'));	
					}
				}
			}
		}
	}
	function pegawai_pengurus($mode='view'){
		$data['page']="pegawai_pengurus"; 
		$data['header'] = "DATA KEPENGURUSAN";
		$data['title'] = "DATA KEPENGURUSAN";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
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
		//======================= IMPORTANT =========================================031891
		$data['id']   = $this->uri->segment(4, 0);
		$data['ambil_data_pengcab'] = $this->m_ol_rancak->ambil_data_pengcab($this->session->id_jabatan);
		if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$id = $this->input->post("id_pengcab");
				redirect(base_url('ol_daftar/pegawai_pengurus/view/'.$id));
			}
		}
		else if($mode=='data'){
			echo json_encode($this->m_ol_daftar->pegawai_pengurus_all($data['id']));
		}
		else{
			$data['ambil_data_ms_pengurus_no_null'] = $this->m_ol_rancak->ambil_data_ms_pengurus_no_null($this->session->id_jabatan,$data['prov_id']);
			$data['ambil_data_pengurus_master_no_null'] = $this->m_ol_rancak->ambil_data_pengurus_master_no_null($this->session->id_jabatan,$data['prov_id']);
			$data['ambil_data_dropdown_pengcab'] = $this->m_ol_rancak->ambil_data_dropdown_pengcab($this->session->id_jabatan);
			$data['cmd_status'] = $this->m_rancak->cmd_status();
			$data['ambil_data_dropdown_pegawai'] = $this->m_ol_rancak->ambil_data_dropdown_pegawai_no_nulls($this->session->id_jabatan);
			$data['ambil_data_pengcabnonull'] = $this->m_ol_rancak->ambil_data_pengcabnonull($this->session->id_jabatan);	
			$data['cmd_status'] = $this->m_rancak->cmd_status();	
			if($mode=='tambah'){
				$data['page'] =  $data['page']."_tambah";		
					$data['id_ms_pengurus']  = set_value('id_ms_pengurus',$this->input->post("id_ms_pengurus"));
					$data['id_pengurus']  = set_value('id_pengurus',$this->input->post("id_pengurus"));
					$data['id_pegawai']  = set_value('id_pegawai',$this->input->post("id_pegawai"));
					$this->form_validation->set_rules('id_pegawai','id_pegawai','required');
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
								$this->m_ol_daftar->simpan_ol_pegawai_pengurus($fileData['file_name']);
								$this->m_ol_daftar->edit_ol_pegawai($fileData['file_name'],$id_pegawai);
								$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
								redirect(base_url('ol_daftar/pegawai_pengurus'));
							}else{
								$nole = '';
								$this->m_ol_daftar->simpan_ol_pegawai_pengurus($nole);
								$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
								redirect(base_url('ol_daftar/pegawai_pengurus'));
							}
						}
					}else{
							$this->session->set_flashdata('danger', 'Data Sudah Ada, Mungkin Status Non Aktif');
							redirect(base_url('ol_daftar/pegawai_pengurus'));						
					}
				}
			}		
			if($mode=='edit'){
				$data['page'] =  $data['page']."_edit";
					$take = $this->m_umum->ambil_data('ol_pegawai_pengurus','barcode_pegawai_pengurus',$data['id']);		
					$data['id_pegawai_pengurus']  = set_value('id_pegawai_pengurus',$take['id_pegawai_pengurus']);
					$data['id_pegawai']  = set_value('id_pegawai',$take['id_pegawai']);
					$data['status_pegawai_pengurus']  = set_value('status_pegawai_pengurus',$take['status_pegawai_pengurus']);
					$this->form_validation->set_rules('id_pegawai','id_pegawai','required');
				if ($this->form_validation->run() === FALSE){
					$this->tampil($data);
				}else{
					$barcode_pegawai_pengurus = $this->input->post('barcode_pegawai_pengurus');
			 		$kondisi=array('barcode_pegawai_pengurus'=>$barcode_pegawai_pengurus);
					$jml = $this->m_umum->jumlah_record_filter('ol_pegawai_pengurus',$kondisi);
					if($jml == 0){							
							$this->session->set_flashdata('danger', 'Data Tidak Valid');
							redirect(base_url('ol_daftar/pegawai_pengurus'));
					}else{
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
								$this->m_ol_daftar->edit_pegawai_pengurus();
								$this->m_ol_daftar->edit_ol_pegawai($fileData['file_name'],$id_pegawai);
								$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
								redirect(base_url('ol_daftar/pegawai_pengurus'));
							}else{
								$this->m_ol_daftar->edit_pegawai_pengurus();
								$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
								redirect(base_url('ol_daftar/pegawai_pengurus'));
							}
						}						
					}
				}
			}
		}
	}
	function kategori_surat($mode='view'){
		$data['page']="kategori_surat"; 
		$data['header'] = "DATA KATEGORI SURAT";
		$data['title'] = "DATA KATEGORI SURAT";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$stpeg = $this->m_umum->ambil_data('a_online','kode_online','ol_status_pegawai');
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
		if($mode=='view'){
			$this->tampil($data);
		}
		else if($mode=='data'){
			echo json_encode($this->m_ol_daftar->kategori_surat_all($this->session->id_jabatan));
		}
		else{
			  $data['cmd_status'] = $this->m_rancak->cmd_status();
			if($mode=='tambah'){
			  $data['page'] =  $data['page']."_tambah";
    		$data['nama_kategori']  = set_value('nama_kategori',$this->input->post("nama_kategori"));
    		$data['status_kategori']  = set_value('status_kategori',$this->input->post("status_kategori"));    		
				$this->load->view("ol_daftar/isi",$data);
			}
			if($mode=='simpan_tambah'){
			  if($this->m_ol_daftar->simpan_kategori_surat()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('ol_daftar/kategori_surat'));
				}else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
					redirect(base_url('ol_daftar/kategori_surat'));
				}
			}
			if($mode=='edit'){
					$data['page'] =  $data['page']."_edit";
					$take = $this->m_umum->ambil_data('ol_surat_kategori','barcode_kategori',$data['id']);		
				//	$stake = $this->m_umum->ambil_data('ol_surat_format','id_kategori',$take['id_kategori']);		
					$data['id_kategori']  = set_value('id_kategori',$take['id_kategori']);
					$data['nama_kategori']  = set_value('nama_kategori',$take['nama_kategori']);
					$data['status_kategori']  = set_value('status_kategori',$take['status_kategori']);
					$data['kunci']  = set_value('kunci',$take['kunci']);
			//		$data['isi_format']  = set_value('isi_format',$stake['isi_format']);
					$data['syarat_kategori']  = set_value('syarat_kategori',$take['syarat_kategori']);
					$this->form_validation->set_rules('nama_kategori','nama_kategori','required');
				if ($this->form_validation->run() === FALSE){
					$this->tampil($data);
				}else{
					$kunci = $this->input->post('kunci');
					$id_kategori = $this->input->post('id_kategori');
			// 		$kondisi=array('id_kategori'=>$id_kategori);
		//			$jml = $this->m_umum->jumlah_record_filter('ol_surat_format',$kondisi);
					if($kunci == 0){
						$this->m_ol_daftar->edit_kategori_surat_kunci();
					}else{
						$this->m_ol_daftar->edit_kategori_surat();
					}
/*					if($jml == 0){
						$this->m_ol_daftar->simpan_surat_format();
					}else{
						$this->m_ol_daftar->edit_surat_format();
					}	*/					
						$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
						redirect(base_url('ol_daftar/kategori_surat'));
				}
			}
      if($mode=='ms_pengurus'){
        $data['page'] =  $data['page']."_ms_pengurus";
        $take = $this->m_umum->ambil_data('ol_surat_kategori','id_kategori',$data['id']);	
        $data['ttd_kategori']  = set_value('ttd_kategori',$take['ttd_kategori']);
				$data['ambil_data_ms_pengurus_no_admin'] = $this->m_ol_rancak->ambil_data_ms_pengurus_no_admin($this->session->id_jabatan,$data['prov_id']);
				$this->load->view("ol_daftar/isi",$data);
      }
      if($mode=='simpan_ms_pengurus'){
				if($this->input->post('chk')){
				  $this->m_ol_daftar->rubah_ttd_surat_kategori();
					redirect(base_url('ol_daftar/kategori_surat'));
				}else{
					redirect(base_url('ol_daftar/kategori_surat'));
				}
      }
		}
	}
	function pengajuan_korespodensi($mode='view'){
		$data['page']="pengajuan_korespodensi"; 
		$data['header'] = "DATA PENGAJUAN SURAT";
		$data['title'] = "DATA PENGAJUAN SURAT";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$stpeg = $this->m_umum->ambil_data('a_online','kode_online','ol_status_pegawai');
		$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
		$propinsie = $this->m_umum->ambil_data('ol_pengcab','id_pengcab',$pegawai['id_pengcab']);
		$data['prov_id'] = $propinsie["id_prov"];
		$data['pengcab_id'] = $pegawai["id_pengcab"];
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
		$data['ambil_data_dropdown_pegawai'] = $this->m_ol_rancak->ambil_data_dropdown_pegawai($this->session->id_jabatan);
		if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$id = $this->input->post("id_pegawai");
				redirect(base_url('ol_daftar/pengajuan_korespodensi/view/'.$id));
			}
		}
		else if($mode=='data'){
			echo json_encode($this->m_ol_daftar->kor_detil_all($data['id']));
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
//				$data['ambil_berkas_data']=$this->m_ol_rancak->ambil_id_berkas_data($this->session->id_pegawai);
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
				$data['tempat_kerja']  = set_value('tempat_kerja',$d["nama_working"]);
				$data['umur']  = set_value('umur',$d["umur"]);
				$data['jk']  = set_value('jk',$d["jk"]);
				$this->form_validation->set_rules('no_korespodensi','no_korespodensi','required');
				if ($this->form_validation->run() === FALSE){
						   $this->tampil($data);
				}else{
					$this->m_ol_daftar->rubah_data_surat_korespodensi();
					$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
					redirect(base_url('ol_daftar/pengajuan_korespodensi/validasi/'.$data['id']));
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
				$this->load->view("ol_daftar/isi",$data);
      }
      if($mode=='simpan_tambah_kategori'){
		  	$barcode_korespodensi = $this->input->post('barcode_korespodensi');
				  if($this->m_ol_rancak->simpan_kor_tambah()){
						$this->session->set_flashdata('sukses', 'Data Sudah Di Tambah');
						redirect(base_url('ol_daftar/pengajuan_korespodensi/validasi/'.$barcode_korespodensi));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Masalah Tambah Data. Hubungi Admin');
						redirect(base_url('ol_daftar/pengajuan_korespodensi/validasi/'.$barcode_korespodensi));
				  }
      }
      if($mode=='pengurus'){ // ini rubah
        $data['page'] =  $data['page']."_pengurus";
				$id_pengcabb = $this->m_umum->ambil_data('ol_kor_kategori','id_kor_kategori',$data['id']);
				$data['ambil_data_pengcab'] = $this->m_ol_rancak->ambil_data_pengcab_dari_pegawai_pengurusno_grup_perpengcab($id_pengcabb['pengcab_asal']);
				$this->load->view("ol_daftar/isi",$data);
      }
      if($mode=='simpan_pengurus'){
		  	$barcode_korespodensi = $this->input->post('barcode_korespodensi');
				if($this->input->post('chk')){
				  $this->m_ol_rancak->simpan_kor_detil_pegawai();
					redirect(base_url('ol_daftar/pengajuan_korespodensi/validasi/'.$barcode_korespodensi));
				}else{
					redirect(base_url('ol_daftar/pengajuan_korespodensi/validasi/'.$barcode_korespodensi));
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
				$this->load->view("ol_daftar/isi",$data);
      }
      if($mode=='simpan_edit_korprint'){
		  	$barcode_korespodensi = $this->input->post('barcode_korespodensi');
			  if($this->m_ol_daftar->rubah_kor_print()){
					redirect(base_url('ol_daftar/pengajuan_korespodensi/validasi/'.$barcode_korespodensi));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
					redirect(base_url('ol_daftar/pengajuan_korespodensi/validasi/'.$barcode_korespodensi));
			  }
      }
      if($mode=='kirim'){
			  if($this->m_ol_daftar->rubah_status_korespodensi($data['id2'],$data['id'])){
					redirect(base_url('ol_daftar/pengajuan_korespodensi'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
					redirect(base_url('ol_daftar/pengajuan_korespodensi'));
			  }
      }
      if($mode=='hapus_ttd'){
      	$d	= $this->m_umum->ambil_data('ol_kor_detil','id_kor_detil',$data['id']);
      	$dx	= $this->m_umum->ambil_data('ol_korespodensi','barcode_korespodensi',$data['id2']);
      	$barcode_korespodensi = $dx['barcode_korespodensi'];
      	$status_korespodensi = $dx['status_korespodensi'];
      	$acc = $d['acc'];
      	if($status_korespodensi == 1 && $acc == 0){
				  if($this->m_umum->hapus_data('ol_kor_detil','id_kor_detil',$data['id'])){
						$this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
						redirect(base_url('ol_daftar/pengajuan_korespodensi/validasi/'.$barcode_korespodensi));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Masalah Hapus Data. Hubungi Admin');
						redirect(base_url('ol_daftar/pengajuan_korespodensi/validasi/'.$barcode_korespodensi));
				  }
				}else{
					$this->session->set_flashdata('danger', 'Status Data Bukan Proses / Sudah Validasi');
					redirect(base_url('ol_daftar/pengajuan_korespodensi/validasi/'.$barcode_korespodensi));
				}
      }
      if($mode=='hapus_kor_kategori'){
      	$d	= $this->m_umum->ambil_data('ol_kor_kategori','id_kor_kategori',$data['id']);
      	$dx	= $this->m_umum->ambil_data('ol_korespodensi','barcode_korespodensi',$data['id2']);
      	$barcode_korespodensi = $dx['barcode_korespodensi'];
			 		$kondisi=array('id_kor_kategori'=>$data['id']);
					$jml = $this->m_umum->jumlah_record_filter('ol_kor_detil',$kondisi);
					$kondisi2=array('id_korespodensi'=>$dx['id_korespodensi']);
					$jml2 = $this->m_umum->jumlah_record_filter('ol_kor_kategori',$kondisi2);
      	if($jml == 0){
      		if($jml2 == 0){
					  if($this->m_umum->hapus_data('ol_kor_kategori','id_kor_kategori',$data['id'])){
							$this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
							redirect(base_url('ol_daftar/pengajuan_korespodensi/validasi/'.$barcode_korespodensi));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Masalah Hapus Data. Hubungi Admin');
							redirect(base_url('ol_daftar/pengajuan_korespodensi/validasi/'.$barcode_korespodensi));
					  }
					}else{
						$this->session->set_flashdata('danger', 'Minimal 1 kategori');
						redirect(base_url('ol_daftar/pengajuan_korespodensi/validasi/'.$barcode_korespodensi));						
					}
				}else{
					$this->session->set_flashdata('danger', 'Hapus Dulu Data Validator');
					redirect(base_url('ol_daftar/pengajuan_korespodensi/validasi/'.$barcode_korespodensi));
				}
      }
			if($mode=='acctolak'){
      	$dx	= $this->m_umum->ambil_data('ol_korespodensi','barcode_korespodensi',$data['id3']);
      	$barcode_korespodensi = $dx['barcode_korespodensi'];
      	$status_korespodensi = $dx['status_korespodensi'];
      	if($status_korespodensi == 1){
				  if($this->m_ol_rancak->rubah_acc_kor_detil($data['id'],$data['id2'])){
						$this->session->set_flashdata('sukses', 'Data Sudah Di Rubah');
						redirect(base_url('ol_daftar/pengajuan_korespodensi/validasi/'.$barcode_korespodensi));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Masalah Rubah Data. Hubungi Admin');
						redirect(base_url('ol_daftar/pengajuan_korespodensi/validasi/'.$barcode_korespodensi));
				  }
				}else{
					$this->session->set_flashdata('danger', 'Status Data Bukan Proses');
					redirect(base_url('ol_daftar/pengajuan_korespodensi/validasi/'.$barcode_korespodensi));
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
			 			redirect(base_url('ol_daftar/pengajuan_korespodensi/validasi/'.$data['id']));
			 		}
			 		if($jml2 > 0){
			 			$this->session->set_flashdata('danger', 'Masih Ada Yang Belum ACC');
			 			redirect(base_url('ol_daftar/pengajuan_korespodensi/validasi/'.$data['id']));
			 		}
			 		if($jml3 > 0){
			 			$this->session->set_flashdata('danger', 'Data Print Sudah Ada');
			 			redirect(base_url('ol_daftar/pengajuan_korespodensi/validasi/'.$data['id']));
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
							redirect(base_url('ol_daftar/pengajuan_korespodensi/validasi/'.$barcode_korespodensi));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Masalah Rubah Data. Hubungi Admin');
							redirect(base_url('ol_daftar/pengajuan_korespodensi/validasi/'.$barcode_korespodensi));
					  }
					}else{
							$this->session->set_flashdata('danger', 'Belum Pilih Data Validator');
							redirect(base_url('ol_daftar/pengajuan_korespodensi/validasi/'.$barcode_korespodensi));						
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
		//	  $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
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
		}
	}
  function kategori_berkas($mode='view')
  {
		$data['page']  = "kategori_berkas";
		$data['header'] = "KATEGORI BERKAS";
		$data['title'] = "KATEGORI BERKAS";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$stpeg = $this->m_umum->ambil_data('a_online','kode_online','ol_status_pegawai');
		$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
		$propinsie = $this->m_umum->ambil_data('ol_pengcab','id_pengcab',$pegawai['id_pengcab']);
		$data['prov_id'] = $propinsie["id_prov"];
		$data['pengcab_id'] = $pegawai["id_pengcab"];
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
		$data['id']   = $this->uri->segment(4, 0);
		//======================= IMPORTANT ======================================
    if($mode=='view'){
			$this->tampil($data);
		}
    else if($mode=='data'){
			echo json_encode($this->m_ol_daftar->kategori_berkas_all());
		}
  	else if($mode=='hapus'){
		  $kondisi=array('id_kategori_berkas'=>$data['id']);
		  $jml = $this->m_umum->jumlah_record_filter('berkas',$kondisi);
		  if($jml == 0){
		    $di = $this->m_umum->ambil_data('kol_kategori_berkas','id_kategori_berkas',$data['id']);
		    $kunci = $di['kunci'];
		    $unit_berkas = $di['unit'];
		    if($unit_berkas !== 255 AND $kunci==25 AND $unit_berkas==$data['ruangan_id']){
		      if($this->m_umum->hapus_data('kol_kategori_berkas','id_kategori_berkas',$data['id'])){
		      $this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
		      redirect(base_url('kepegawaian/kategori_berkas'));
		      }else{
		      $this->session->set_flashdata('danger', 'Masalah Hapus Data');
		      redirect(base_url('kepegawaian/kategori_berkas'));
		      }
		    }else{
		      $this->session->set_flashdata('danger', 'Beda Permission');
		      redirect(base_url('kepegawaian/kategori_berkas'));
		    }
		  }else{
		      $this->session->set_flashdata('danger', 'Data Sudah Masuk Alur');
		      redirect(base_url('kepegawaian/kategori_berkas'));
		  }
  	}
		else{
			$data['cmd_status']=$this->m_rancak->cmd_status();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['nama_kategori_berkas']  = set_value('nama_kategori_berkas',$this->input->post('nama_kategori_berkas'));
				$data['status_kategori_berkas']  = set_value('status_kategori_berkas',$this->input->post('status_kategori_berkas'));
				$this->load->view("ol_daftar/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($this->m_ol_daftar->simpan_kategori_berkas($this->session->id_jabatan)){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('ol_daftar/kategori_berkas'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('ol_daftar/kategori_berkas'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('ol_berkas_kategori','id_kategori_berkas',$data['id']);
				$data['nama_kategori_berkas']  = set_value('nama_kategori_berkas',$keuangan["nama_kategori_berkas"]);
				$data['status_kategori_berkas']  = set_value('status_kategori_berkas',$keuangan["status_kategori_berkas"]);
				$this->load->view("ol_daftar/isi",$data);
      }
      if($mode=='simpan_edit'){
				$id_kategori_berkas = $this->input->post('id_kategori_berkas');
				$di = $this->m_umum->ambil_data('ol_berkas_kategori','id_kategori_berkas',$id_kategori_berkas);
				$kunci = $di['kunci']; // kategori berkas yang boleh dihapus = 25 dan untuk penggolongan
				$unit_berkas = $di['id_jabatan'];
				if($unit_berkas !== '255' && $kunci=='25' && $unit_berkas==$this->session->id_jabatan){
				  if($this->m_ol_daftar->edit_kategori_berkas()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
						redirect(base_url('ol_daftar/kategori_berkas'));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
						redirect(base_url('ol_daftar/kategori_berkas'));
					}
				}
				else{
					$this->session->set_flashdata('danger', 'Beda Permission');
					redirect(base_url('ol_daftar/kategori_berkas'));
				}
      }
		}
  }
  function kategori_pelatihan($mode='view')
  {
	$data['page']  = "kategori_pelatihan";
	$data['header'] = "KATEGORI PELATIHAN";
	$data['title'] = "KATEGORI PELATIHAN";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$stpeg = $this->m_umum->ambil_data('a_online','kode_online','ol_status_pegawai');
		$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
		$propinsie = $this->m_umum->ambil_data('ol_pengcab','id_pengcab',$pegawai['id_pengcab']);
		$data['prov_id'] = $propinsie["id_prov"];
		$data['pengcab_id'] = $pegawai["id_pengcab"];
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
	$data['id']   = $this->uri->segment(4, 0);
	//======================= IMPORTANT ======================================
    if($mode=='view'){
	$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_ol_daftar->kategori_pelatihan_all());
	}
	else{
		$data['cmd_status']=$this->m_rancak->cmd_status();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		$data['nama_kategori_pelatihan']  = set_value('nama_kategori_pelatihan',$this->input->post('nama_kategori_pelatihan'));
		$data['status_kategori_pelatihan']  = set_value('status_kategori_pelatihan',$this->input->post('status_kategori_pelatihan'));
		$this->load->view("ol_daftar/isi",$data);
      }
      if($mode=='simpan_tambah'){
		  if($this->m_ol_daftar->simpan_kategori_pelatihan()){
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
			redirect(base_url('ol_daftar/kategori_pelatihan'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
			redirect(base_url('ol_daftar/kategori_pelatihan'));
		  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
		$keuangan    = $this->m_umum->ambil_data('ol_kategori_pelatihan','id_kategori_pelatihan',$data['id']);
		$data['nama_kategori_pelatihan']  = set_value('nama_kategori_pelatihan',$keuangan["nama_kategori_pelatihan"]);
		$data['status_kategori_pelatihan']  = set_value('status_kategori_pelatihan',$keuangan["status_kategori_pelatihan"]);
		$this->load->view("ol_daftar/isi",$data);
      }
      if($mode=='simpan_edit'){
		$nama_kategori_pelatihan = $this->input->post('nama_kategori_pelatihan');
		$nama_kategori_pelatihan_lama = $this->input->post('nama_kategori_pelatihan_lama');
		$kondisi=array('nama_kategori_pelatihan'=>$nama_kategori_pelatihan,'nama_kategori_pelatihan !='=>$nama_kategori_pelatihan_lama);
		$jml = $this->m_umum->jumlah_record_filter('kol_kategori_pelatihan',$kondisi);
		if($jml == 0){
		  if($this->m_ol_daftar->edit_kategori_pelatihan()){
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
			redirect(base_url('ol_daftar/kategori_pelatihan'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
			redirect(base_url('ol_daftar/kategori_pelatihan'));
		  }
		}
		else{
				$this->session->set_flashdata('danger', 'Nama Sudah Ada');
				redirect(base_url('ol_daftar/kategori_pelatihan'));
			}
      }
	}
  }
  function validasi($mode='view')
  {
		$data['page']  = "validasi";
		$data['header'] = "SETING VALIDASI";
		$data['title'] = "SETING VALIDASI";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$stpeg = $this->m_umum->ambil_data('a_online','kode_online','ol_status_pegawai');
		$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
		$propinsie = $this->m_umum->ambil_data('ol_pengcab','id_pengcab',$pegawai['id_pengcab']);
		$data['prov_id'] = $propinsie["id_prov"];
		$data['pengcab_id'] = $pegawai["id_pengcab"];
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
		$data['id']   = $this->uri->segment(4, 0);
		//======================= IMPORTANT ======================================
    if($mode=='view'){
			$this->tampil($data);
		}
    else if($mode=='data'){
			echo json_encode($this->m_ol_daftar->kategori_berkas_all());
		}
		else{
			$data['cmd_status']=$this->m_rancak->cmd_status();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['nama_kategori_berkas']  = set_value('nama_kategori_berkas',$this->input->post('nama_kategori_berkas'));
				$data['status_kategori_berkas']  = set_value('status_kategori_berkas',$this->input->post('status_kategori_berkas'));
				$this->load->view("ol_daftar/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($this->m_ol_daftar->simpan_kategori_berkas($this->session->id_jabatan)){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('ol_daftar/kategori_berkas'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('ol_daftar/kategori_berkas'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('ol_berkas_kategori','id_kategori_berkas',$data['id']);
				$data['nama_kategori_berkas']  = set_value('nama_kategori_berkas',$keuangan["nama_kategori_berkas"]);
				$data['status_kategori_berkas']  = set_value('status_kategori_berkas',$keuangan["status_kategori_berkas"]);
				$this->load->view("ol_daftar/isi",$data);
      }
      if($mode=='simpan_edit'){
				$id_kategori_berkas = $this->input->post('id_kategori_berkas');
				$di = $this->m_umum->ambil_data('ol_berkas_kategori','id_kategori_berkas',$id_kategori_berkas);
				$kunci = $di['kunci']; // kategori berkas yang boleh dihapus = 25 dan untuk penggolongan
				$unit_berkas = $di['id_jabatan'];
				if($unit_berkas !== '255' && $kunci=='25' && $unit_berkas==$this->session->id_jabatan){
				  if($this->m_ol_daftar->edit_kategori_berkas()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
						redirect(base_url('ol_daftar/kategori_berkas'));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
						redirect(base_url('ol_daftar/kategori_berkas'));
					}
				}
				else{
					$this->session->set_flashdata('danger', 'Beda Permission');
					redirect(base_url('ol_daftar/kategori_berkas'));
				}
      }
		}
  }
	function ms_peminatan($mode='view'){
		$data['page']="ms_peminatan"; 
		$data['header'] = "DATA PEMINATAN";
		$data['title'] = "DATA PEMINATAN";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$data['multi_level'] = $this->m_ol_rancak->ambil_data_link_pengurus($this->session->id_pegawai);
		$data['ambil_data_a_online'] = $this->m_ol_rancak->ambil_data_a_online();
		$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
		$data['instance_id'] = $instansi["id_instansi"];
		$data['instance_name'] = $instansi["nama_instansi"];
		$data['aran_jabatan'] = $jabatanekuh["nama_jabatan"];
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
		}
		else if($mode=='data'){
			echo json_encode($this->m_ol_daftar->peminatan_all());
		}
		else{
			  $data['cmd_status'] = $this->m_rancak->cmd_status();
			  $data['cmd_jabatan'] = $this->m_rancak->cmd_jabatan();
			if($mode=='tambah'){
			  $data['page'] =  $data['page']."_tambah";
    		$data['id_jabatan']  = set_value('id_jabatan',$this->input->post("id_jabatan"));
    		$data['nama_peminatan']  = set_value('nama_peminatan',$this->input->post("nama_peminatan"));
    		$data['status_peminatan']  = set_value('status_peminatan',$this->input->post("status_peminatan"));    		
				$this->load->view("ol_daftar/isi",$data);
			}
			if($mode=='simpan_tambah'){
			  if($this->m_ol_daftar->simpan_ms_peminatan()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('ol_daftar/ms_peminatan'));
				}else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
					redirect(base_url('ol_daftar/ms_peminatan'));
				}
			}
			if($mode=='edit'){
			  $data['page'] =  $data['page']."_edit";
				$take = $this->m_umum->ambil_data('ol_peminatan','id_peminatan',$data['id']);		
				$data['nama_peminatan']  = set_value('nama_peminatan',$take['nama_peminatan']);
				$data['status_peminatan']  = set_value('status_peminatan',$take['status_peminatan']);
				$this->load->view("ol_daftar/isi",$data);
			}
			if($mode=='simpan_edit'){
			  if($this->m_ol_daftar->rubah_ms_peminatan()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('ol_daftar/ms_peminatan'));
				}else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
					redirect(base_url('ol_daftar/ms_peminatan'));
				}
			}
		}
	}
  function kategori_kompetensi($mode='view')
  {
	$data['page']  = "kategori_kompetensi";
	$data['header'] = "KATEGORI KOMPETENSI";
	$data['title'] = "KATEGORI KOMPETENSI";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$stpeg = $this->m_umum->ambil_data('a_online','kode_online','ol_status_pegawai');
		$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
		$propinsie = $this->m_umum->ambil_data('ol_pengcab','id_pengcab',$pegawai['id_pengcab']);
		$data['prov_id'] = $propinsie["id_prov"];
		$data['pengcab_id'] = $pegawai["id_pengcab"];
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
    if($mode=='view'){
		$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_ol_daftar->kompetensi_all());
	}
    else if($mode=='hapus'){
		$kondisi=array('id_kompetensi'=>$data['id']);
		$jml = $this->m_umum->jumlah_record_filter('ol_kewenangan',$kondisi);
		if($jml == 0){
		  if($this->m_umum->hapus_data('ol_kompetensi','id_kompetensi',$data['id'])){
			$this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
			redirect(base_url('ol_daftar/kategori_kompetensi'));
		  }else{
			$this->session->set_flashdata('danger', 'Masalah Hapus Data');
			redirect(base_url('ol_daftar/kategori_kompetensi'));
		  }
		}else{
			$this->session->set_flashdata('danger', 'Data Sudah Masuk Alur');
			redirect(base_url('ol_daftar/kategori_kompetensi'));
		}
    }
  else{
		$data['cmd_status'] = $this->m_rancak->cmd_status();
		$data['cmd_jabatan'] = $this->m_rancak->cmd_jabatan();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		$data['nama_kompetensi']  = set_value('nama_kompetensi',$this->input->post('nama_kompetensi'));
		$data['id_jabatan']  = set_value('id_jabatan',$this->input->post('id_jabatan'));
		$data['status_kompetensi']  = set_value('status_kompetensi',$this->input->post('status_kompetensi'));
		$this->load->view("ol_daftar/isi",$data);
    }
    if($mode=='simpan_tambah'){
		  if($this->m_ol_daftar->simpan_kompetensi()){
				$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
				redirect(base_url('ol_daftar/kategori_kompetensi'));
		  }else{
				$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
				redirect(base_url('ol_daftar/kategori_kompetensi'));
		  }
    }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
		$keuangan    = $this->m_umum->ambil_data('ol_kompetensi','id_kompetensi',$data['id']);
		$data['nama_kompetensi']  = set_value('nama_kompetensi',$keuangan["nama_kompetensi"]);
		$data['id_jabatan']  = set_value('id_jabatan',$keuangan["id_jabatan"]);
		$data['status_kompetensi']  = set_value('status_kompetensi',$keuangan["status_kompetensi"]);
		$this->load->view("ol_daftar/isi",$data);
      }
      if($mode=='simpan_edit'){
		  if($this->m_ol_daftar->edit_kompetensi()){
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
			redirect(base_url('ol_daftar/kategori_kompetensi'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
			redirect(base_url('ol_daftar/kategori_kompetensi'));
		  }
      }
	}
  }
  function kategori_kewenangan($mode='view')
  {
		$data['page']  = "kategori_kewenangan";
		$data['header'] = "KATEGORI KEWENANGAN";
		$data['title'] = "KATEGORI KEWENANGAN";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$stpeg = $this->m_umum->ambil_data('a_online','kode_online','ol_status_pegawai');
		$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
		$propinsie = $this->m_umum->ambil_data('ol_pengcab','id_pengcab',$pegawai['id_pengcab']);
		$data['prov_id'] = $propinsie["id_prov"];
		$data['pengcab_id'] = $pegawai["id_pengcab"];
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
		$data['id_jabatan'] = $this->uri->segment(4, 0);
		$data['opsi_kewenangan'] = $this->uri->segment(5, 0);
		$data['cmd_jabatan_null'] = $this->m_rancak->cmd_jabatan_null();
		$data['cmd_opsi'] = array('0'=>'Buku Putih Keperawatan','1'=>'Butir Kegiatan');
		$data['ambil_data_rujukan_working_null'] = $this->m_ol_rancak->ambil_data_rujukan_working_null();
    if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$id_jabatan = $this->input->post("id_jabatan");
				$opsi_kewenangan = $this->input->post("opsi_kewenangan");
				redirect(base_url('ol_daftar/kategori_kewenangan/view/'.$id_jabatan.'/'.$opsi_kewenangan));
			}
		}
    else if($mode=='data'){
			echo json_encode($this->m_ol_daftar->kewenangan_all($data['id_jabatan'],$data['opsi_kewenangan']));
		}
    else if($mode=='hapus'){
			$kondisi=array('id_kewenangan'=>$data['id']);
			$jml = $this->m_umum->jumlah_record_filter('ol_kewenangan_detil',$kondisi);
			if($jml == 0){
			  if($this->m_umum->hapus_data('ol_kewenangan','id_kewenangan',$data['id'])){
					$this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
					redirect(base_url('ol_daftar/kategori_kewenangan'));
			  }else{
					$this->session->set_flashdata('danger', 'Masalah Hapus Data');
					redirect(base_url('ol_daftar/kategori_kewenangan'));
			  }
			}else{
				$this->session->set_flashdata('danger', 'Data Sudah Masuk Alur');
				redirect(base_url('ol_daftar/kategori_kewenangan'));
			}
    }
  	else{
			$data['cmd_kompetensi'] = $this->m_ol_rancak->cmd_kompetensi();
			$data['cmd_kode_kewenangan_null'] = $this->m_ol_rancak->cmd_kode_kewenangan_null();
			$data['cmd_sifat_kewenangan_null'] = $this->m_ol_rancak->cmd_sifat_kewenangan_null();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['nama_kewenangan']  = set_value('nama_kewenangan',$this->input->post('nama_kewenangan'));
				$data['id_kompetensi']  = set_value('id_kompetensi',$this->input->post('id_kompetensi'));
				$data['id_kode_kewenangan']  = set_value('id_kode_kewenangan',$this->input->post('id_kode_kewenangan'));
				$data['id_sifat_kewenangan']  = set_value('id_sifat_kewenangan',$this->input->post('id_sifat_kewenangan'));
				$data['id_working']  = set_value('id_working',$this->input->post('id_working'));
				$data['wkt_kewenangan']  = set_value('wkt_kewenangan',$this->input->post('wkt_kewenangan'));
				$this->load->view("ol_daftar/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($this->m_ol_daftar->simpan_kewenangan()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('ol_daftar/kategori_kewenangan'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('ol_daftar/kategori_kewenangan'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('ol_kewenangan','id_kewenangan',$data['id_jabatan']);
				$data['nama_kewenangan']  = set_value('nama_kewenangan',$keuangan["nama_kewenangan"]);
				$data['id_kompetensi']  = set_value('id_kompetensi',$keuangan["id_kompetensi"]);
				$data['id_kode_kewenangan']  = set_value('id_kode_kewenangan',$keuangan["id_kode_kewenangan"]);
				$data['id_sifat_kewenangan']  = set_value('id_sifat_kewenangan',$keuangan["id_sifat_kewenangan"]);
				$data['id_working']  = set_value('id_working',$keuangan["id_instansi"]);
				$data['wkt_kewenangan']  = set_value('wkt_kewenangan',$keuangan["wkt_kewenangan"]);
				$this->load->view("ol_daftar/isi",$data);
      }
      if($mode=='simpan_edit'){
			  if($this->m_ol_daftar->edit_kewenangan()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
					redirect(base_url('ol_daftar/kategori_kewenangan'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
					redirect(base_url('ol_daftar/kategori_kewenangan'));
			  }
      }
		}
  }
  function kompetensi($mode='view')
  {
	$data['page']  = "kompetensi";
	$data['header'] = "KOMPETENSI";
	$data['title'] = "KOMPETENSI";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$stpeg = $this->m_umum->ambil_data('a_online','kode_online','ol_status_pegawai');
		$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
		$propinsie = $this->m_umum->ambil_data('ol_pengcab','id_pengcab',$pegawai['id_pengcab']);
		$data['prov_id'] = $propinsie["id_prov"];
		$data['pengcab_id'] = $pegawai["id_pengcab"];
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
	$data['cmd_ruangan'] = $this->m_ol_rancak->cmd_ruangan();
    if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$id = $this->input->post("id");
			redirect(base_url('ol_daftar/kompetensi/view/'.$id));
		}
	}
    else if($mode=='data'){
		echo json_encode($this->m_ol_daftar->kewenangan_detil_all($data['id']));
	}
  else{
		$data['cmd_ruangan_no_null'] = $this->m_ol_rancak->cmd_ruangan_no_null();
		$data['cmd_kewenangan'] = $this->m_ol_rancak->cmd_kewenangan($data['id']);
		$data['cmd_jabatan_null'] = $this->m_rancak->cmd_jabatan_null();
		$data['cmd_kewenangan_no_null'] = $this->m_ol_rancak->cmd_kewenangan_no_null();
      if($mode=='tambah_unit'){
        $data['page'] =  $data['page']."_tambah_unit";
				$data['id_ruangan']  = set_value('id_ruangan',$this->input->post("id_ruangan"));
				$data['id_kewenangan']  = set_value('id_kewenangan',$this->input->post("id_kewenangan"));
		$this->form_validation->set_rules('id_ruangan','id_ruangan','required');
        if ($this->form_validation->run() === FALSE){
					$this->tampil($data);
				}else{
					$action = $this->input->post('action');
					if($action == 'BtnProses') {
						$id_jabatan = $this->input->post("id_jabatan");
						redirect(base_url('ol_daftar/kompetensi/tambah_unit/'.$id_jabatan));
					}
					if($action == 'BtnSimpan') {
						$this->m_ol_daftar->simpan_kewenangan_detil_unit();
						$this->session->set_flashdata('sukses', 'Data Sudah Di Tambah & Data Dobel Tidak Di Tambah');
						redirect(base_url('ol_daftar/kompetensi'));
					}
        }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
    		$keuangan    = $this->m_umum->ambil_data('ol_kewenangan_detil','id_kewenangan_detil',$data['id']);
    		$data['id_kewenangan']  = set_value('id_kewenangan',$keuangan["id_kewenangan"]);
    		$data['id_ruangan']  = set_value('id_ruangan',$keuangan["id_ruangan"]);
    		$this->load->view("ol_daftar/isi",$data);
      }
      if($mode=='simpan_edit'){
			$id_kewenangan = $this->input->post('id_kewenangan');
			$id_ruangan = $this->input->post('id_ruangan');
			$id_kewenangan_lama = $this->input->post('id_kewenangan_lama');
			$id_ruangan_lama = $this->input->post('id_ruangan_lama');
			$kondisi=array('id_kewenangan'=>$id_kewenangan,'id_kewenangan !='=>$id_kewenangan_lama,
				'id_ruangan'=>$id_ruangan,'id_ruangan !='=>$id_ruangan_lama);
			$jml = $this->m_umum->jumlah_record_filter('ol_kewenangan_detil',$kondisi);
			if($jml == 0){
			  if($this->m_ol_daftar->edit_kewenangan_detil()){
				$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
				redirect(base_url('ol_daftar/kompetensi'));
			  }else{
				$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
				redirect(base_url('ol_daftar/kompetensi'));
			  }
			}else{
				$this->session->set_flashdata('danger', 'Data Sudah Ada');
				redirect(base_url('ol_daftar/kompetensi'));
			}
      }
	}
  }
  function lulus($mode='view')
  {
	$data['page']  = "lulus";
	$data['header'] = "DATA KELULUSAN KEWENANGAN";
	$data['title'] = "DATA KELULUSAN KEWENANGAN";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$stpeg = $this->m_umum->ambil_data('a_online','kode_online','ol_status_pegawai');
		$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
		$propinsie = $this->m_umum->ambil_data('ol_pengcab','id_pengcab',$pegawai['id_pengcab']);
		$data['prov_id'] = $propinsie["id_prov"];
		$data['pengcab_id'] = $pegawai["id_pengcab"];
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
	$data['cmd_pegawai']=$this->m_ol_rancak->cmd_pegawai_null_with_unit_source_jabatan($program['jabatan']);
	$data['id'] = $this->uri->segment(4, 0);
	$data['id_kompetensi'] = $this->uri->segment(5, 0);
	if(empty($data['id'])){
		$data['id'] = '0';
	}
	if(empty($data['id_kompetensi'])){
		$data['id_kompetensi'] = '0';
	}
    if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$id = $this->input->post('id');
			redirect(base_url('ol_daftar/lulus/view/'.$id));
		}
	}
    else if($mode=='data'){
		echo json_encode($this->m_ol_daftar->lulus_all($data['id']));
	}
    else if($mode=='hapus'){
    $kondisi=array('id_pegawai'=>$data['id'],'id_kewenangan_lulus'=>$data['id_kompetensi']);
		$this->m_umum->hapus_data_kondisi('ol_kewenangan_lulus',$kondisi);
		$this->session->set_flashdata('sukses', 'Berkas Sudah Di Hapus');
		redirect(base_url('ol_daftar/lulus/view/'.$data['id']));
    }
  else{
		$data['ambil_kr_kewenangan']=$this->m_rancak->ambil_kompetensi_all();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		if(empty($data['id']) || $data['id'] == '0'){
			$this->session->set_flashdata('danger', 'Silahkan Pilih Pegawai Dulu');
			redirect(base_url('ol_daftar/lulus/view/'.$data['id']));
		}
		$ambil_pegawai=$this->m_ol_rancak->ambil_pegawai($data['id']);
		$data['ambil_kr_kewenangan_per_kompetensi']=$this->m_ol_rancak->ambil_kr_kewenangan_per_kompetensi($data['id_kompetensi'],$ambil_pegawai['id_jabatan']);
		$data['kewenangan_lulus_pegawai']=$this->m_ol_rancak->kewenangan_lulus_pegawai($data['id']);
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$id = $this->input->post('id');
			$id_kompetensi = $this->input->post('id_kompetensi');
			redirect(base_url('ol_daftar/lulus/tambah/'.$id.'/'.$id_kompetensi));
		}
		if($action == 'BtnSimpan') {
			$id = $this->input->post('id');
			$this->m_ol_daftar->simpan_lulus_kewenangan();
			$this->session->set_flashdata('sukses', 'Data Sudah Di Tambah');
			redirect(base_url('ol_daftar/lulus/view/'.$id));
		}
	  }
	}
  }
  function cat_oppe($mode='view')
  {
		$data['page']  = "cat_oppe";
		$data['header'] = "CATATAN REKOMENDASI OPPE";
		$data['title'] = "CATATAN REKOMENDASI OPPE";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$stpeg = $this->m_umum->ambil_data('a_online','kode_online','ol_status_pegawai');
		$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
		$propinsie = $this->m_umum->ambil_data('ol_pengcab','id_pengcab',$pegawai['id_pengcab']);
		$data['prov_id'] = $propinsie["id_prov"];
		$data['pengcab_id'] = $pegawai["id_pengcab"];
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
		$data['ambil_data_catatan_oppe']=$this->m_ol_rancak->ambil_data_catatan_oppe();
	  if($mode=='view'){
			$this->tampil($data);
		}
    else if($mode=='data'){
		echo json_encode($this->m_ol_daftar->kol_catatan_oppe());
	}
		else{
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		$data['kode_catatan']  = set_value('kode_catatan',$this->input->post('kode_catatan'));
		$data['isi_catatan']  = set_value('isi_catatan',$this->input->post('isi_catatan'));
			$this->load->view("ol_daftar/isi",$data);
      }
      if($mode=='simpan_tambah'){
			$kode_catatan = $this->input->post('kode_catatan');
			$kondisi=array('kode_catatan'=>$kode_catatan,'id_jabatan'=>$this->session->id_jabatan);
			$jml = $this->m_umum->jumlah_record_filter('ol_catatan',$kondisi);
			if($jml == 0){
			  if($this->m_ol_daftar->simpan_ol_catatan()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('ol_daftar/cat_oppe'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('ol_daftar/cat_oppe'));
			  }
		  }else{
			$kondisi=array('kode_catatan'=>$kode_catatan,'id_jabatan'=>$this->session->id_jabatan);
			$ambil_data_catatan = $this->m_umum->ambil_data_kondisi('ol_catatan',$kondisi);
			  if($this->m_ol_daftar->edit_ol_catatan($ambil_data_catatan['id_catatan'])){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('ol_daftar/cat_oppe'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('ol_daftar/cat_oppe'));
			  }
		  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('ol_catatan','id_catatan',$data['id']);
				$data['isi_catatan']  = set_value('isi_catatan',$keuangan["isi_catatan"]);
				$data['id_catatan']  = set_value('id_catatan',$keuangan["id_catatan"]);
				$data['kode_catatan']  = set_value('kode_catatan',$keuangan["kode_catatan"]);
    		$this->load->view("ol_daftar/isi",$data);
      }
      if($mode=='simpan_edit'){
    		$id_catatan = $this->input->post('id_catatan');
			  $this->m_ol_daftar->edit_ol_catatan($id_catatan);
				$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
				redirect(base_url('ol_daftar/cat_oppe'));
      }
		}
  }
	function bcp($mode='view')
  {
	$data['page']  = "bcp";
	$data['header'] = "BUKU CATATAN PRIBADI / LOGBOOK";
	$data['title'] = "BUKU CATATAN PRIBADI / LOGBOOK";
	$data['link_kembali'] = base_url('ol_daftar');
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$stpeg = $this->m_umum->ambil_data('a_online','kode_online','ol_status_pegawai');
		$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
		$propinsie = $this->m_umum->ambil_data('ol_pengcab','id_pengcab',$pegawai['id_pengcab']);
		$data['prov_id'] = $propinsie["id_prov"];
		$data['pengcab_id'] = $pegawai["id_pengcab"];
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
	$data['all'] = $this->uri->segment(5, 0);
	$data['first_date'] = $this->uri->segment(6, 0);
	$data['last_date'] = $this->uri->segment(7, 0);
      $data['cmd_pegawai'] = $this->m_ol_rancak->cmd_pegawai_null_analisa();
      $data['cmd_sekarepe_dewe'] = $this->m_rancak->cmd_analisa();
	if($data['first_date'] == NULL OR empty($data['first_date'])){
		$data['first_date'] = date('d-m-Y');
	}
	if($data['last_date'] == NULL OR empty($data['last_date'])){
		$data['last_date'] = date('d-m-Y');
	}
  if($mode=='view'){
	if($data['id'] == NULL OR empty($data['id'])){
		$data['id'] = "0";
	}
	if($data['all'] == NULL OR empty($data['all'])){
		$data['all'] = "0";
	}
		$this->tampil_top($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
      $id   = $this->input->post("id");
      $all   = $this->input->post("all");
      $first_date   = $this->input->post("first_date");
      $last_date   = $this->input->post("last_date");
			redirect(base_url('ol_daftar/bcp/view/'.$id.'/'.$all.'/'.$first_date.'/'.$last_date));
		}
	}
  else if($mode=='data_logbook'){
		echo json_encode($this->m_ol_daftar->tabel_logbook($data['id'],$data['all'],$data['first_date'],$data['last_date']));
	}
}
// PARI AZA
  function slide_title()   
  {
	$data['page']  = "slide_title";  
		$data['header'] = "SLIDE DAN TEXT HALAMAN UTAMA";
		$data['title'] = "SLIDE DAN TEXT HALAMAN UTAMA";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$stpeg = $this->m_umum->ambil_data('a_online','kode_online','ol_status_pegawai');
		$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
		$propinsie = $this->m_umum->ambil_data('ol_pengcab','id_pengcab',$pegawai['id_pengcab']);
		$data['prov_id'] = $propinsie["id_prov"];
		$data['pengcab_id'] = $pegawai["id_pengcab"];
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
		$d = $this->m_umum->ambil_data('a_instansi_text','id_instansi_text','1');
		$data['id_instansi_text'] = set_value('id_instansi_text',$d["id_instansi_text"]);
		$data['title1'] = set_value('title1',$d["title1"]);
		$data['title2'] = set_value('title2',$d["title2"]);
		$data['title3'] = set_value('title3',$d["title3"]);
		$data['title4'] = set_value('title4',$d["title4"]);
		$data['desc1'] = set_value('desc1',$d["desc1"]);
		$data['desc2'] = set_value('desc2',$d["desc2"]);
		$data['desc3'] = set_value('desc3',$d["desc3"]);
		$data['desc4'] = set_value('desc4',$d["desc4"]);		
		$data['slide1a'] = set_value('slide1a',$d["slide1a"]);
		$data['slide1b'] = set_value('slide1b',$d["slide1b"]);
		$data['slide2a'] = set_value('slide2a',$d["slide2a"]);
		$data['slide2b'] = set_value('slide2b',$d["slide2b"]);
		$data['slide3a'] = set_value('slide3a',$d["slide3a"]);
		$data['slide3b'] = set_value('slide3b',$d["slide3b"]);
		$data['slide4a'] = set_value('slide4a',$d["slide4a"]);
		$data['slide4b'] = set_value('slide4b',$d["slide4b"]);	
		$data['welcome'] = set_value('welcome',$d["welcome"]);	
		$this->form_validation->set_rules('id_instansi_text','id_instansi_text','required');
		if ($this->form_validation->run() === FALSE){
			$this->tampil($data);
		}else{	
			  if($this->m_ol_daftar->edit_instansi_text()){ 			  
				redirect(base_url('ol_daftar/slide_title'));
			  }else{
				echo "<script> alert('Ada Masalah Edit Data. Hubungi Admin'); </script>";
			  }
		}
  }
  function etik($mode='view')
  {
	$data['page']  = "etik";
	$data['header'] = "ETIK";
	$data['title'] = "ETIK";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$stpeg = $this->m_umum->ambil_data('a_online','kode_online','ol_status_pegawai');
		$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
		$propinsie = $this->m_umum->ambil_data('ol_pengcab','id_pengcab',$pegawai['id_pengcab']);
		$data['prov_id'] = $propinsie["id_prov"];
		$data['pengcab_id'] = $pegawai["id_pengcab"];
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
	$data['id_jabatan'] = $this->uri->segment(4, 0);
	if(empty($data['id_jabatan'])){
		$data['id_jabatan'] = '0';
	}
	$data['cmd_jabatan_null'] = $this->m_rancak->cmd_jabatan_null();
    if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$id_jabatan = $this->input->post("id_jabatan");
			redirect(base_url('ol_daftar/etik/view/'.$id_jabatan));
		}
	}
    else if($mode=='data'){
		echo json_encode($this->m_ol_daftar->etik_all($data['id_jabatan']));
	}
  else{
		$data['cmd_ya_tidak'] = $this->m_rancak->cmd_ya_tidak();
		$data['cmd_status'] = $this->m_rancak->cmd_status();
	//	$data['cmd_jabatan_null'] = $this->m_rperawat->cmd_jabatan_null();
      if($mode=='tambah'){
				$data['page'] =  $data['page']."_tambah";
				$data['nama_etik']  = set_value('nama_etik',$this->input->post('nama_etik'));
				$data['answer']  = set_value('answer',$this->input->post('answer'));
				$data['status_etik']  = set_value('status_etik',$this->input->post('status_etik'));
				$this->form_validation->set_rules('nama_etik','nama_etik','required');
	      if ($this->form_validation->run() === FALSE){
					$this->tampil($data);
	      }else{
					$this->m_ol_daftar->simpan_etik();
					$this->session->set_flashdata('sukses', 'Data Sudah Di Tambah');
					redirect(base_url('ol_daftar/etik'));
	      }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
		$d    = $this->m_umum->ambil_data('kol_etik','id_etik',$data['id_jabatan']);
		$data['id_etik'] = set_value('id_etik',$d["id_etik"]);
		$data['nama_etik'] = set_value('nama_etik',$d["nama_etik"]);
		$data['answer'] = set_value('answer',$d["answer"]);
		$data['status_etik'] = set_value('status_etik',$d["status_etik"]);
		$this->form_validation->set_rules('nama_etik','nama_etik','required');
        if ($this->form_validation->run() === FALSE){
			$this->tampil_top($data);
        }else{
			  if($this->m_ol_daftar->edit_etik()){
				$this->session->set_flashdata('sukses', 'Data Sudah Di Rubah');
				redirect(base_url('ol_daftar/etik'));
			  }else{
				$this->session->set_flashdata('danger', 'Masalah Edit Data');
				redirect(base_url('ol_daftar/etik'));
			  }
        }
      }
	}
  }
  function ms_etik($mode='view')
  {
		$data['page']  = "ms_etik";
		$data['header'] = "PILIH MASTER ETIK";
		$data['title'] = "PILIH MASTER ETIK";
		$data['link_kembali'] = base_url();
		$data['link_awal'] = base_url('etik/etik');
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
		$data['id'] = $this->uri->segment(4, 0);
		$data['cmd_jabatan_null'] = $this->m_rancak->cmd_jabatan_null();
    if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$id = $this->input->post("id_jabatan");
				redirect(base_url('ol_daftar/ms_etik/view/'.$id));
			}
		}
    else if($mode=='data'){
			echo json_encode($this->m_ol_daftar->ms_etik_all($data['id']));
		}
  	else{
			$data['cmd_jabatan'] = $this->m_rancak->cmd_jabatan();
			$data['cmd_status'] = $this->m_rancak->cmd_status();
			$data['ambil_data_rujukan_working_kab_null'] = $this->m_ol_rancak->ambil_data_rujukan_working();
			$data['ambil_pilih_ms_etik'] = $this->m_ol_rancak->ambil_pilih_ms_etik('0');
		  if($mode=='tambah'){
				$data['page'] =  $data['page']."_tambah";
				$data['id_instansi']  = set_value('id_instansi',$this->input->post("id_instansi"));
				$data['id_jabatan']  = set_value('id_jabatan',$this->input->post("id_jabatan"));
				$this->tampil($data);
				$action = $this->input->post('action');
				if($action == 'BtnProses') {
					$id = $this->input->post("id_jabatan");
					redirect(base_url('ol_daftar/ms_etik/tambah/'.$id));
				}
				if($action == 'BtnSimpan') {
					if($this->input->post('chk')){
						$this->m_ol_daftar->simpan_ms_etik();
						$this->session->set_flashdata('sukses', 'Data Sudah Di Tambah');
						redirect(base_url('ol_daftar/ms_etik'));
					}else{
						$this->session->set_flashdata('danger', 'Belum Pilih Etik');
						redirect(base_url('ol_daftar/ms_etik'));
					}
				}
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$d = $this->m_umum->ambil_data('ol_etik_instansi','id_etik_instansi',$data['id']);
				$data['id_etik_instansi'] = set_value('id_etik_instansi',$d["id_etik_instansi"]);
				$data['id_jabatan'] = set_value('id_jabatan',$d["id_jabatan"]);
				$data['id_instansi'] = set_value('id_instansi',$d["id_instansi"]);
				$data['etik'] = set_value('etik',$d["etik"]);
				$data['status_etik_instansi'] = set_value('status_etik_instansi',$d["status_etik_instansi"]);
				$this->tampil($data);
				$action = $this->input->post('action');
				if($action == 'BtnProses') {
					$id = $this->input->post("id_jabatan");
					redirect(base_url('ol_daftar/ms_etik/tambah/'.$id));
				}
				if($action == 'BtnSimpan') {
					$this->m_ol_daftar->edit_ms_etik();
					$this->session->set_flashdata('sukses', 'Data Sudah Di Tambah');
					redirect(base_url('ol_daftar/ms_etik'));
				}
      }
		}
  }
  function etik_pegawai($mode='view')
  {
		$data['page']  = "etik_pegawai";
		$data['header'] = "INPUT ETIK USER";
		$data['title'] = "INPUT ETIK USER";
		$data['link_kembali'] = base_url();
		$data['link_awal'] = base_url('etik/etik');
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
		$data['id'] = $this->uri->segment(4, 0);
//		$data['cmd_pegawai_null'] = $this->m_ol_rancak->ambil_data_dropdown_pegawai_no_null_instansi_all();
    if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$id = $this->input->post("barcode_pegawai");
				redirect(base_url('ol_daftar/etik_pegawai/view/'.$id));
			}
		}
    else if($mode=='data'){
			echo json_encode($this->m_ol_daftar->etik_pegawai_all($data['id']));
		}
  	else{
			$data['ambil_etik_instansi'] = $this->m_ol_rancak->ambil_etik_instansi_all();
			$data['cmd_ya_tidak'] = $this->m_rancak->cmd_ya_tidak();
			$data['ambil_pilih_ms_etik'] = $this->m_ol_rancak->ambil_pilih_ms_etik('0');
			$data['ambil_data_etik_instansi_no_null'] = $this->m_ol_rancak->ambil_data_etik_instansi_no_null_all();
			$data['cmd_status'] = $this->m_rancak->cmd_status();
			$data['ambil_working'] = $this->m_ol_rancak->ambil_data_rujukan_working();
		  if($mode=='tambah'){
				$data['page'] =  $data['page']."_tambah";
				$etikpeg  = $this->m_umum->ambil_data('ol_etik_instansi','id_etik_instansi',$data['id']);
				$data['etik'] = $etikpeg['etik'];
				$data['nama_etik']  = set_value('nama_etik',$this->input->post('nama_etik'));
				$data['answer']  = set_value('answer',$this->input->post('answer'));
				$data['status_etik']  = set_value('status_etik',$this->input->post('status_etik'));
				$data['id_instansi']  = set_value('id_instansi',$this->input->post('id_instansi'));
				$data['id_pegawai']  = set_value('id_pegawai',$this->input->post('id_pegawai'));
				$this->tampil($data);
				$action = $this->input->post('action');
				if($action == 'BtnProses') {
					$id = $this->input->post("id");
					redirect(base_url('ol_daftar/etik_pegawai/tambah/'.$id));
				}
				if($action == 'BtnSimpan') {
					$last_ide = $this->m_ol_daftar->simpan_etik_pegawai();
					$this->m_ol_daftar->simpan_etik_pegawai_detil($last_ide);
					$this->session->set_flashdata('sukses', 'Data Sudah Di Tambah');
					redirect(base_url('ol_daftar/etik_pegawai'));
				}
      }
      if($mode=='lihat'){
        $data['page'] =  $data['page']."_lihat";
				$d = $this->m_umum->ambil_data('ol_etik_pegawai','barcode_etik_pegawai',$data['id']);
				$data['ambil_data_etik_pegawai'] = $this->m_ol_rancak->ambil_data_etik_pegawai($d['id_etik_pegawai']);
				$data['id_instansi'] = set_value('id_instansi',$d["id_instansi"]);
				$data['tgl_etik_pegawai'] = set_value('tgl_etik_pegawai',date('d-m-Y',strtotime($d["tgl_etik_pegawai"])));
				$data['total_etik'] = set_value('total_etik',$d["total_etik"]);
				$data['jumlah_etik'] = set_value('jumlah_etik',$d["jumlah_etik"]);
				$data['hasil_etik'] = set_value('hasil_etik',$d["hasil_etik"]);
				$data['id_penguji'] = set_value('id_penguji',$d["id_penguji"]);
				$this->tampil($data);
      }
		}
  }
	function jabatan_struktur($mode='view'){
		$data['page']="jabatan_struktur"; 
		$data['header'] = "DATA JABATAN STRUKTUR INSTANSI";
		$data['title'] = "DATA JABATAN STRUKTUR INSTANSI";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$stpeg = $this->m_umum->ambil_data('a_online','kode_online','ol_status_pegawai');
		$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
		$propinsie = $this->m_umum->ambil_data('ol_pengcab','id_pengcab',$pegawai['id_pengcab']);
		$data['prov_id'] = $propinsie["id_prov"];
		$data['pengcab_id'] = $pegawai["id_pengcab"];
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
		}
		else if($mode=='data'){
			echo json_encode($this->m_ol_daftar->jabatan_struktur_all($stpeg['status_online']));
		}
		else{
			  $data['cmd_status'] = $this->m_rancak->cmd_status();
			  $data['ambil_data_rujukan_working_null'] = $this->m_ol_rancak->ambil_data_rujukan_working_null();
			if($mode=='tambah'){
			  $data['page'] =  $data['page']."_tambah";
    		$data['nama_ms_struktur']  = set_value('nama_ms_struktur',$this->input->post("nama_ms_struktur"));
    		$data['status_ms_struktur']  = set_value('status_ms_struktur',$this->input->post("status_ms_struktur"));    		
    		$data['id_instansi']  = set_value('id_instansi',$this->input->post("id_instansi"));    		
				$this->load->view("ol_daftar/isi",$data);
			}
			if($mode=='simpan_tambah'){
			  if($this->m_ol_daftar->simpan_ms_struktur()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('ol_daftar/jabatan_struktur'));
				}else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
					redirect(base_url('ol_daftar/jabatan_struktur'));
				}
			}
			if($mode=='edit'){
			  $data['page'] =  $data['page']."_edit";
				$take = $this->m_umum->ambil_data('kol_ms_struktur','id_ms_struktur',$data['id']);		
				$data['nama_ms_struktur']  = set_value('nama_ms_struktur',$take['nama_ms_struktur']);
				$data['kunci']  = set_value('kunci',$take['kunci']);
				$data['status_ms_struktur']  = set_value('status_ms_struktur',$take['status_ms_struktur']);
				$data['id_instansi']  = set_value('id_instansi',$take['instansi_struktur']);
				$this->load->view("ol_daftar/isi",$data);
			}
			if($mode=='simpan_edit'){
				$kunci = $this->input->post('kunci');
				if($kunci == 0){
				  if($this->m_ol_daftar->edit_ms_struktur()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('ol_daftar/jabatan_struktur'));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
						redirect(base_url('ol_daftar/jabatan_struktur'));
					}
				}else{
						$this->session->set_flashdata('danger', 'Tidak Dapat Merubah Data Ini');
						redirect(base_url('ol_daftar/jabatan_struktur'));					
				}
			}
		}
	}
	function struktur($mode='view'){
		$data['page']="struktur"; 
		$data['header'] = "DATA STRUKTUR INSTANSI";
		$data['title'] = "DATA STRUKTUR INSTANSI";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
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
		$data['ambil_data_rujukan_working'] = $this->m_ol_rancak->ambil_data_rujukan_working();
		$data['ambil_data_rujukan_working_null'] = $this->m_ol_rancak->ambil_data_rujukan_working_null();
		$ole = $this->m_ol_rancak->ambil_data_instansi_4_print($this->session->id_pegawai);
		$arr = array();
		foreach($ole as $val){
				$arr[] = $val['id_working'];
		}
		$eimplo = implode(",", $arr);
		if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$id = $this->input->post("id_working");
				redirect(base_url('ol_daftar/struktur/view/'.$id));
			}
		}
		else if($mode=='data'){
			echo json_encode($this->m_ol_daftar->struktur_all($data['id'],$eimplo));
		}
		else{
			$data['ambil_data_ms_struktur'] = $this->m_ol_rancak->ambil_data_ms_struktur_no_null($eimplo);
			$data['ambil_data_ms_struktur_null'] = $this->m_ol_rancak->ambil_data_ms_struktur_null($eimplo);
			$data['cmd_status'] = $this->m_rancak->cmd_status();
		  if($mode=='tambah'){
				$data['page'] =  $data['page']."_tambah";
				$data['id_instansi']  = set_value('id_instansi',$this->input->post("id_instansi"));
				$this->form_validation->set_rules('id_instansi','id_instansi','required');
				if ($this->form_validation->run() === FALSE){
						   $this->tampil($data);
				}else{
					$this->m_ol_daftar->simpan_ol_struktur();
					$this->session->set_flashdata('sukses', 'Data Sudah Di Tambah & Data Dobel Tidak Di Tambah');
					redirect(base_url('ol_daftar/struktur'));
				}
			}
			if($mode=='edit'){
			  $data['page'] =  $data['page']."_edit";
				$take = $this->m_umum->ambil_data('ol_struktur','id_struktur',$data['id']);		
				$data['id_instansi']  = set_value('id_instansi',$take['id_instansi']);
				$data['id_ms_struktur']  = set_value('id_ms_struktur',$take['id_ms_struktur']);
				$data['status_struktur']  = set_value('status_struktur',$take['status_struktur']);
				$this->load->view("ol_daftar/isi",$data);
			}
			if($mode=='simpan_edit'){
			$id_instansi = $this->input->post('id_instansi');
			$id_ms_struktur = $this->input->post('id_ms_struktur');
			$id_ms_struktur_lama = $this->input->post('id_ms_struktur_lama');
			$kondisi=array('id_instansi'=>$id_instansi,'id_ms_struktur'=>$id_ms_struktur,'id_ms_struktur !='=>$id_ms_struktur_lama);
			$jml = $this->m_umum->jumlah_record_filter('ol_struktur',$kondisi);
			if($jml == 0){
				  if($this->m_ol_daftar->edit_ol_struktur()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('ol_daftar/struktur'));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
						redirect(base_url('ol_daftar/struktur'));
					}
				}else{
						$this->session->set_flashdata('danger', 'Data Sudah Ada');
						redirect(base_url('ol_daftar/struktur'));					
				}
			}
		}
	}
	function pegawai_struktur($mode='view'){
		$data['page']="pegawai_struktur"; 
		$data['header'] = "DATA ANGGOTA STRUKTUR INSTANSI";
		$data['title'] = "DATA ANGGOTA STRUKTUR INSTANSI";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
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
		//======================= IMPORTANT =========================================031891
		$data['id']   = $this->uri->segment(4, 0);
		$data['ambil_data_rujukan_working'] = $this->m_ol_rancak->ambil_data_rujukan_working();
		$data['ambil_data_rujukan_working_null'] = $this->m_ol_rancak->ambil_data_rujukan_working_null();
		$ole = $this->m_ol_rancak->ambil_data_instansi_4_print($this->session->id_pegawai);
		$arr = array();
		foreach($ole as $val){
				$arr[] = $val['id_working'];
		}
		$eimplo = implode(",", $arr);
		if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$id = $this->input->post("id_working");
				redirect(base_url('ol_daftar/pegawai_struktur/view/'.$id));
			}
		}
		else if($mode=='data'){
			echo json_encode($this->m_ol_daftar->pegawai_struktur_all($data['id']));
		}
		else{
			$data['ambil_data_struktur_master_no_null'] = $this->m_ol_rancak->ambil_data_struktur_master_no_null();
			$data['ambil_data_dropdown_pegawai_instansi_no_nulls'] = $this->m_ol_rancak->ambil_data_dropdown_pegawai_instansi_no_nulls('0');	
			$data['cmd_status'] = $this->m_rancak->cmd_status();
      if($mode=='jabatan'){
        $data['page'] =  $data['page']."_jabatan";
        $data['cmd_jabatan_null'] = $this->m_rancak->cmd_jabatan_null();
        $data['cmd_ya_tidak'] = $this->m_rancak->cmd_ya_tidak();
				$take = $this->m_umum->ambil_data('ol_pegawai_struktur','id_pegawai_struktur',$data['id']);		
				$data['id_pegawai_struktur']  = set_value('id_pegawai_struktur',$take['id_pegawai_struktur']);
				$data['id_jabatan']  = set_value('id_jabatan',explode(",", $take['id_jabatan']));
				$data['kunci']  = set_value('kunci',$take['kunci']);
    		$this->load->view("ol_daftar/isi",$data);
      }
      if($mode=='simpan_jabatan'){
			  $this->m_ol_daftar->simpan_pegawai_struktur_jabatan();
				$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
				redirect(base_url('ol_daftar/pegawai_struktur'));
      }	
			if($mode=='tambah'){
				$data['page'] =  $data['page']."_tambah";		
					$data['id_ms_struktur']  = set_value('id_ms_struktur',$this->input->post("id_ms_struktur"));
					$data['id_struktur']  = set_value('id_struktur',$this->input->post("id_struktur"));
					$data['id_pegawai']  = set_value('id_pegawai',$this->input->post("id_pegawai"));
					$this->form_validation->set_rules('id_pegawai','id_pegawai','required');
				if ($this->form_validation->run() === FALSE){
					$this->tampil($data);
				}else{
					$id_struktur = $this->input->post('id_struktur');
					$id_pegawai = $this->input->post('id_pegawai');
			 		$kondisi=array('id_struktur'=>$id_struktur,'id_pegawai'=>$id_pegawai);
					$jml = $this->m_umum->jumlah_record_filter('ol_pegawai_struktur',$kondisi);
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
								$this->m_ol_daftar->simpan_ol_pegawai_struktur($fileData['file_name']);
								$this->m_ol_daftar->edit_ol_pegawai($fileData['file_name'],$id_pegawai);
								$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
								redirect(base_url('ol_daftar/pegawai_struktur'));
							}else{
								$nole = '';
								$this->m_ol_daftar->simpan_ol_pegawai_struktur($nole);
								$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
								redirect(base_url('ol_daftar/pegawai_struktur'));
							}
						}
					}else{
							$this->session->set_flashdata('danger', 'Data Sudah Ada, Mungkin Status Non Aktif');
							redirect(base_url('ol_daftar/pegawai_struktur'));						
					}
				}
			}		
			if($mode=='edit'){
				$data['page'] =  $data['page']."_edit";
					$take = $this->m_umum->ambil_data('ol_pegawai_struktur','barcode_pegawai_struktur',$data['id']);		
				$data['id_pegawai_struktur']  = set_value('id_pegawai_struktur',$take['id_pegawai_struktur']);
				$data['id_pegawai']  = set_value('id_pegawai',$take['id_pegawai']);
				$data['id_struktur']  = set_value('id_struktur',$take['id_struktur']);
				$data['status_pegawai_struktur']  = set_value('status_pegawai_struktur',$take['status_pegawai_struktur']);
					$this->form_validation->set_rules('id_pegawai','id_pegawai','required');
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
							redirect(base_url('ol_daftar/pegawai_struktur'));
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
											$this->m_ol_daftar->edit_pegawai_struktur();
											$this->m_ol_daftar->edit_ol_pegawai($fileData['file_name'],$id_pegawai);
											$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
											redirect(base_url('ol_daftar/pegawai_struktur'));
										}else{
											$this->m_ol_daftar->edit_pegawai_struktur();
											$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
											redirect(base_url('ol_daftar/pegawai_struktur'));
										}
									}
								}else{
									$this->session->set_flashdata('danger', 'Data Sudah Ada');
									redirect(base_url('ol_daftar/pegawai_struktur'));
								}
							}else{
								$this->session->set_flashdata('danger', 'Data Sudah Masuk Validasi Pengajuan');
								redirect(base_url('ol_daftar/pegawai_struktur'));								
							}
						}else{
							$this->session->set_flashdata('danger', 'Data Sudah Masuk Validasi Logbook');
							redirect(base_url('ol_daftar/pegawai_struktur'));
						}						
					}	
				}
			}
		}
	}
	function relasi($mode='view'){
		$data['page']="relasi"; 
		$data['header'] = "DATA RELASI BUKU PUTIH KEPERAWATAN DENGAN BUTIR KEGIATAN => DUPAK / EUKOM";
		$data['title'] = "DATA RELASI BUKU PUTIH KEPERAWATAN DENGAN BUTIR KEGIATAN => DUPAK / EUKOM";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
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
		//======================= IMPORTANT =========================================031891
		$data['id_jabatan_fungsional']   = $this->uri->segment(4, 0);
		$data['id_ruangan']   = $this->uri->segment(5, 0);
		$data['id_kode_kewenangan']   = $this->uri->segment(6, 0);
		$data['id_jabatan']   = $this->uri->segment(7, 0);
		$data['id_butir_kegiatan']   = $this->uri->segment(8, 0);
		$data['pat'] = $this->uri->segment(3, 0);
/*		if($data['pat'] == NULL OR empty($data['pat'])){
			$data['id_jabatan_fungsional'] = 10;
			$data['id_ruangan'] = 0;
			$data['id_kode_kewenangan'] = 0;
			$data['id_jabatan'] = 12;
			$data['id_butir_kegiatan'] = 1;
		}*/
		$data['cmd_jabfung'] = $this->m_rancak->cmd_jabfung();
		$data['cmd_jabfung_no_null'] = $this->m_rancak->cmd_jabfung_no_null();
		$data['cmd_ruangan']=$this->m_ol_rancak->cmd_ruangan();
		$data['cmd_jabfung_buket']=$this->m_rancak->cmd_jabatan_fungsional_dg_id($data['id_jabatan']);
		$data['butir_kegiatan_no_null']=$this->m_rancak->butir_kegiatan_no_null($data['id_jabatan_fungsional']);
		$data['kol_kode_kewenangan_null_pk']=$this->m_ol_rancak->kol_kode_kewenangan_null();
		$data['cmd_jabatan']=$this->m_rancak->cmd_jabatan();
		$data['cmd_status']=$this->m_rancak->cmd_status();
		if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			$id_jabatan_fungsional = $this->input->post('id_jabatan_fungsional');
			if($action == 'BtnProses') {
				$id = $this->input->post("id_jabatan_fungsional");
				redirect(base_url('ol_daftar/relasi/view/'.$id_jabatan_fungsional));
			}
		}
		else if($mode=='data'){
			echo json_encode($this->m_ol_daftar->kewenangan_bk($data['id_jabatan_fungsional']));
		}
		else{
			if($mode=='tambah'){
				$data['page'] =  $data['page']."_tambah";		
				$data['kewenangan_look'] = $this->m_ol_rancak->kewenangan_look($data['id_jabatan'],$data['id_ruangan'],$data['id_kode_kewenangan']);
				$this->form_validation->set_rules('id_jabatan_fungsional','id_jabatan_fungsional','required');
				if ($this->form_validation->run() === FALSE){
						$this->tampil($data);
				}else{
					$action = $this->input->post('action');
					$id_jabatan_fungsional = $this->input->post('id_jabatan_fungsional');
					$id_ruangan = $this->input->post('id_ruangan');
					$id_kode_kewenangan = $this->input->post('id_kode_kewenangan');
					$id_jabatan = $this->input->post('id_jabatan');
					$id_butir_kegiatan = $this->input->post('id_butir_kegiatan');
					if($action == 'BtnProses') {
						$id = $this->input->post("id_jabatan_fungsional");
						redirect(base_url('ol_daftar/relasi/tambah/'.$id_jabatan_fungsional.'/'.$id_ruangan.'/'.$id_kode_kewenangan.'/'.$id_jabatan.'/'.$id_butir_kegiatan));
					}
					if($action == 'BtnSimpan') {
						$id_jabatan_fungsional = $this->input->post('id_jabatan_fungsional');
						if($this->input->post('chk') && $this->input->post('id_butir_kegiatan')){
								$this->m_ol_master->simpan_ol_kewenangan_bk();
								$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
						}else{
							$this->session->set_flashdata('danger', 'Data Belum Lengkap');
						}
							redirect(base_url('ol_daftar/relasi/view/'.$id_jabatan_fungsional));
					}
				}
			}		
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('ol_kewenangan_bk','id_kewenangan_bk',$data['id_jabatan_fungsional']);
				$kw    = $this->m_ol_rancak->cmd_kewenangan_id_kewenangan($keuangan['id_kewenangan']);
				$data['cmd_kewenangan']=$this->m_ol_rancak->cmd_kewenangan_idj_no_null($kw['id_jabatan']);
				$data['butir_kegiatane']=$this->m_rancak->buket_no_null($kw['id_jabatan']);
				$data['id_kewenangan_bk']  = set_value('id_kewenangan_bk',$keuangan["id_kewenangan_bk"]);
				$data['id_kewenangan']  = set_value('id_kewenangan',$keuangan["id_kewenangan"]);
				$data['id_butir_kegiatan']  = set_value('id_butir_kegiatan',$keuangan["id_butir_kegiatan"]);
				$data['status_kewenangan_bk']  = set_value('status_kewenangan_bk',$keuangan["status_kewenangan_bk"]);
				$this->load->view("ol_daftar/isi",$data);
      }
      if($mode=='simpan_edit'){
      	$id_jabatan_fungsional = $this->input->post('id_jabatan_fungsional');
      	$id_kewenangan = $this->input->post('id_kewenangan');
      	$id_kewenangan_lama = $this->input->post('id_kewenangan_lama');
      	$id_butir_kegiatan = $this->input->post('id_butir_kegiatan');
      	$id_butir_kegiatan_lama = $this->input->post('id_butir_kegiatan_lama');
				$kondisi=array('id_kewenangan'=>$id_kewenangan,'id_butir_kegiatan'=>$id_butir_kegiatan);
				$jml = $this->m_umum->jumlah_record_filter('ol_kewenangan_bk',$kondisi);
					if($jml == 0){
					  if($this->m_ol_daftar->edit_ol_kewenangan_bk()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('ol_daftar/relasi/view/'.$id_jabatan_fungsional));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('ol_daftar/relasi/view/'.$id_jabatan_fungsional));
					  }
					}else{
							$this->session->set_flashdata('danger', 'Data Sudah Ada');
							redirect(base_url('ol_daftar/relasi/view/'.$id_jabatan_fungsional));
					}
      }
		}
	}
  function butir_kegiatan($mode='view')
  {
	$data['page']  = "butir_kegiatan";
		$data['header'] = "DATA BUTIR KEGIATAN";
		$data['title'] = "DATA BUTIR KEGIATAN";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
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
		//======================= IMPORTANT =========================================031891
		$data['id']   = $this->uri->segment(4, 0);
	$data['id_butir_kegiatan'] = $this->uri->segment(5, 0); // id_butir_kegiatan
	if(empty($data['id'])){
		$data['id'] ='0';
	}
//	$data['cmd_jabfung_buket'] = $this->m_rancak->cmd_jabfung_buket($pegawai['id_jabatan']);
//	$data['cmd_jabatan_fungsional_id'] = $this->m_rancak->cmd_jabatan_fungsional_id($pegawai['id_jabatan']);
	$data['cmd_jabfung_buket'] = $this->m_ol_rancak->cmd_jabfung_buket($pegawai['id_jabatan']);
	$data['cmd_jabatan_fungsional_id'] = $this->m_ol_rancak->cmd_jabatan_fungsional_id($pegawai['id_jabatan']);
    if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$id = $this->input->post("id");
			redirect(base_url('ol_daftar/butir_kegiatan/view/'.$id));
		}
	}
    else if($mode=='data'){
		echo json_encode($this->m_ol_daftar->butir_kegiatan_kabeh($data['id']));
	}
  else{
	  $data['cmd_status'] = $this->m_rancak->cmd_status();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['id_jabatan_fungsional'] = set_value('id_jabatan_fungsional',$data['id']);
				$data['status_butir_kegiatan'] = set_value('status_butir_kegiatan',$this->input->post("status_butir_kegiatan"));
				$data['nama_butir_kegiatan'] = set_value('nama_butir_kegiatan',$this->input->post("nama_butir_kegiatan"));
				$data['angka_kredit'] = set_value('angka_kredit','0');
				$data['satuan_hasil'] = set_value('satuan_hasil',$this->input->post("satuan_hasil"));
		$this->load->view("ol_daftar/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  $id = $this->input->post('id');
			  if($this->m_ol_daftar->tambah_butir_kegiatan_kw()){
					$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
					redirect(base_url('ol_daftar/butir_kegiatan/view/'.$id));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Masalah Simpan Data. Hubungi Admin');
					redirect(base_url('ol_daftar/butir_kegiatan/view/'.$id));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$ded = $this->m_umum->ambil_data('butir_kegiatan','id_butir_kegiatan',$data['id_butir_kegiatan']);
				$bke = $this->m_umum->ambil_data('ol_kewenangan_bk','id_butir_kegiatan',$data['id_butir_kegiatan']);
				$data['id_kewenangan'] = set_value('id_kewenangan',$bke["id_kewenangan"]);
				$data['id_jabatan_fungsional'] = set_value('id_jabatan_fungsional',$ded["id_jabatan_fungsional"]);
				$data['status_butir_kegiatan'] = set_value('status_butir_kegiatan',$ded["status_butir_kegiatan"]);
				$data['nama_butir_kegiatan'] = set_value('nama_butir_kegiatan',$ded["nama_butir_kegiatan"]);
				$data['angka_kredit'] = set_value('angka_kredit',round($ded["angka_kredit"],4));
				$data['satuan_hasil'] = set_value('satuan_hasil',$ded["satuan_hasil"]);
				$this->load->view("ol_daftar/isi",$data);
      }
      if($mode=='simpan_edit'){
			 		$id = $this->input->post('id');
				  if($this->m_ol_daftar->rubah_butir_kegiatan()){
				  $this->m_ol_daftar->rubah_kewenangan_bk();
					$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
					redirect(base_url('ol_daftar/butir_kegiatan/view/'.$id));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Masalah Rubah Data. Hubungi Admin');
					redirect(base_url('ol_daftar/butir_kegiatan/view/'.$id));
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
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$stpeg = $this->m_umum->ambil_data('a_online','kode_online','ol_status_pegawai');
		$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
		$propinsie = $this->m_umum->ambil_data('ol_pengcab','id_pengcab',$pegawai['id_pengcab']);
		$data['prov_id'] = $propinsie["id_prov"];
		$data['pengcab_id'] = $pegawai["id_pengcab"];
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
		$data['ambil_data_rujukan_working_null']=$this->m_ol_rancak->ambil_data_rujukan_working_null();
		$data['ambil_data_ms_struktur_no_syarat']=$this->m_ol_rancak->ambil_data_ms_struktur_no_syarat();
		$data['ambil_data_rujukan_working']=$this->m_ol_rancak->ambil_data_rujukan_working();
		$data['status_diusulkan_all']=$this->m_rancak->status_diusulkan_all();
		$data['cmd_jabatan_null']=$this->m_rancak->cmd_jabatan_null();
		$data['cmd_status']=$this->m_rancak->cmd_status();
	  if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$id = $this->input->post("id");
				redirect(base_url('ol_daftar/format_validator/view/'.$id));
			}
		}
    else if($mode=='data'){
			echo json_encode($this->m_ol_daftar->pengajuan_format_rs($data['id']));
		}
		else{
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		$data['status_pengajuan_format_rs']  = set_value('status_pengajuan_format_rs',$this->input->post('status_pengajuan_format_rs'));
		$data['id_status_diusulkan']  = set_value('id_status_diusulkan',$this->input->post('id_status_diusulkan'));
		$data['id_instansi']  = set_value('id_instansi',$this->input->post('id_instansi'));
		$data['id_jabatan']  = set_value('id_jabatan',$this->input->post('id_jabatan'));
			$this->load->view("ol_daftar/isi",$data);
      }
      if($mode=='simpan_tambah'){
				$id_instansi = $this->input->post('id_instansi');
				$id_jabatan = $this->input->post('id_jabatan');
				$id_status_diusulkan = $this->input->post('id_status_diusulkan');
				$kondisi=array('id_instansi'=>$id_instansi,'id_jabatan'=>$id_jabatan,'id_status_diusulkan'=>$id_status_diusulkan);
				$jml = $this->m_umum->jumlah_record_filter('ol_pengajuan_format_rs',$kondisi);
				if($jml == 0){
				 		 $this->m_ol_daftar->simpan_ol_pengajuan_format_rs();
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('ol_daftar/format_validator'));
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
				$data['status_pengajuan_format_rs']  = set_value('status_pengajuan_format_rs',$keuangan["status_pengajuan_format_rs"]);
    		$this->load->view("ol_daftar/isi",$data);
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
				 		 $this->m_ol_daftar->edit_ol_pengajuan_format_rs();
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('ol_daftar/format_validator'));
			  }
      }
		}
  }
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("ol_daftar/header",$data);
	$this->load->view("ol_daftar/isi");
	$this->load->view("footer");
	$this->load->view("ol_daftar/jsload");
	$this->load->view("ol_daftar/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_topol",$data);
	$this->load->view("ol_daftar/isi");
	$this->load->view("footer");
	$this->load->view("ol_daftar/jsload");
	$this->load->view("ol_daftar/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
