<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');
// ALTER TABLE `ol_user` ADD `status_asesor` TINYINT UNSIGNED NOT NULL DEFAULT '0' AFTER `status_user`;
class Admin_user extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
          $this->load->model('m_ol_rancak');
          $this->load->model('m_admin_kredensial');
          $this->load->model('m_admin_user');
          $this->load->model('m_auth');
          $this->m_auth->login_kah();
  }
	function index(){
		$this->data_user();
	}
		function check_availability(){
			$username=$this->input->post('username');
			$username = strtolower($username);
			$username = str_replace(' ', '-', $username);
			$username = preg_replace('/[^A-Za-z0-9\-]/', '', $username);
			$kondisi=array('username'=>$username);
			$jml = $this->m_umum->jumlah_record_filter('ol_user',$kondisi);
			if($jml == 0){
				echo "<span style='color:green'> Username Tersedia.</span>";
			}else{
				echo "<span style='color:red'> Username Sudah Ada</span>";
			}
		}
/*		function jabfung_data($id)
		{
			if($id < 4){
				$ids = '1';
			}else{
				$ids = '3';
			}
			$dt=$this->m_ol_rancak->ambil_data_dropdown_jabfung_aktifasi($ids);
			echo json_encode($dt);
		}*/
		function unite_data($id)
		{
			$dt=$this->m_ol_rancak->ambil_data_dropdown_unit_null($id);
			echo json_encode($dt);
		}
	  function check_nik(){
			$nip=$this->input->post('nip');
			$kondisi=array('nip'=>$nip);
			$jml = $this->m_umum->jumlah_record_filter('ol_pegawai',$kondisi);
			if($jml == 0){
				echo "<span style='color:green'> NIP Tersedia.</span>";
			}else{
				echo "<span style='color:red'> NIP Sudah Ada</span>";
			}
		}
	  function check_nip(){
			$nik=$this->input->post('nik');
			$kondisi=array('nik'=>$nik);
			$jml = $this->m_umum->jumlah_record_filter('ol_pegawai',$kondisi);
			if($jml == 0){
				echo "<span style='color:green'> No KTP Tersedia.</span>";
			}else{
				echo "<span style='color:red'> No KTP Sudah Ada</span>";
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
		function aktifasi($mode='view'){
		$data['page']="aktifasi"; 
		$data['header'] = "DATA REGISTRASI USER";
		$data['title'] = "DATA REGISTRASI USER";
		$data['link_awal'] = base_url('admin_user');
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
		//	$program = $this->m_umum->ambil_data('a_program','id_program',10);
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
			echo json_encode($this->m_admin_user->registrasi_all($data['id']));
		}
	  else if($mode=='hapus'){
	  		$this->m_umum->hapus_data('ol_registrasi','barcode_registrasi',$data['id']);
	    	redirect(base_url('admin_user/aktifasi'));
	  }
		else{
			$data['cmd_instansi'] = $this->m_ol_rancak->ambil_instansi_no_null();
			$data['opsi_status_perawat'] = $this->m_ol_rancak->status_perawat();
		//	$data['kol_kode_kewenangan_null'] = $this->m_ol_rancak->kol_kode_kewenangan_null();
			$data['cmd_tipe_pegawai'] = $this->m_ol_rancak->cmd_tipe_pegawai();
			$data['cmd_jabfung'] = $this->m_ol_rancak->cmd_jabfung();
			$data['status'] = $this->m_rancak->cmd_status();
			$data['gender'] = $this->m_rancak->cmd_jk();
			$data['ambil_data_rujukan_instansi'] = $this->m_ol_rancak->ambil_data_rujukan_kab_working($this->session->mas_ins);
			$data['ambil_data_rujukan_working_null'] = $this->m_ol_rancak->ambil_data_rujukan_kab_working($this->session->mas_ins);
			$data['cmd_unit_null'] = $this->m_rancak->struktur_jabatan_as_unit();
			$data['cmd_agama'] = $this->m_rancak->cmd_agama();
			$data['cmd_status_kawin'] = $this->m_rancak->cmd_status_kawin();
			$data['cmd_pendidikan'] = $this->m_rancak->cmd_pendidikan();
			$data['cmd_level'] = $this->m_admin_user->cmd_level();
			$data['kol_provinsi'] = $this->m_rancak->cmd_kol_provinsi();
			if($mode=='tambah'){
				$data['page'] =  $data['page']."_tambah";
					$take = $this->m_umum->ambil_data('ol_registrasi','barcode_registrasi',$data['id']);
					$data['id_instansi']  = set_value('id_instansi',$take['id_instansi']);
					$data['ambil_data_dropdown_unit']=$this->m_ol_rancak->ambil_data_dropdown_unit_no_null($take['id_instansi']);					
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
					$data['tipe_pegawai']  = set_value('tipe_pegawai',$take['tipe_pegawai']);
					$data['nip']  = set_value('nip',$take['nip']);
					$data['username']  = set_value('username',$take['username']);
					$data['nama_instansi']  = set_value('nama_instansi',$take['nama_instansi']);
					$data['alamat_instansi']  = set_value('alamat_instansi',$take['alamat_instansi']);
					$data['nama_unit']  = set_value('nama_unit',$take['nama_unit']);
					$data['atasan_unit']  = set_value('atasan_unit',$take['atasan_unit']);
					$tjabatan = $this->m_umum->ambil_data('jabatan_fungsional','id_jabatan_fungsional',$take['id_jabatan_fungsional']);
					$data['id_level']  = set_value('id_level',$this->input->post("id_level"));
					$data['id_unit']  = set_value('id_unit',$this->input->post("id_unit"));
					$this->form_validation->set_rules('nama_pegawai','nama_pegawai','required');
				if ($this->form_validation->run() === FALSE){
					$this->tampil($data);
				}else{
					$ptn = "/^0/";  // Regex
					$str = $this->input->post('no_hp'); 
					$nik = $this->input->post('nik');
					$nip = $this->input->post('nip');
					$id_level = $this->input->post('id_level');
					$id_instansi = $this->input->post('id_instansi');
					$rpltxt = "62";  // Replacement string
					$no_hp = preg_replace($ptn, $rpltxt, $str);
					$barcode_registrasi = $this->input->post('barcode_registrasi');
					$username= $this->input->post('username');
					$username = strtolower($username);
					$username = str_replace(' ', '-', $username);
					$username = preg_replace('/[^A-Za-z0-9\-]/', '', $username);
					$kondisi=array('username'=>$username);
					$jml = $this->m_umum->jumlah_record_filter('ol_user',$kondisi);
					$kondisi2=array('nik'=>$nik);
					$jml2 = $this->m_umum->jumlah_record_filter('ol_pegawai',$kondisi2);
					$kondisi3=array('nip'=>$nip);
					$jml3 = $this->m_umum->jumlah_record_filter('ol_pegawai',$kondisi3);
						if($jml == 0){
							if($jml2 == 0){
								if($jml3 == 0){
									if($Q = $this->m_admin_user->simpan_aktifasi()){
										$this->m_admin_user->simpan_user($Q);
										$this->m_admin_user->simpan_pegawai_unit_user($Q);
										if($id_instansi > 0){
											$this->m_admin_user->simpan_instansi($Q);
										}
										if($id_level == 53){
											$this->m_sa->simpan_mhs_unit_user($Q);
										}
										$this->m_umum->hapus_data('ol_registrasi','barcode_registrasi',$barcode_registrasi);

										$wagw = $this->m_umum->ambil_data('a_wageblast','id_wageblast',1);
										$d = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$Q);
										$us = $this->m_umum->ambil_data('ol_user','id_pegawai',$Q);
										$logine = base_url('masuk');
										$token = $wagw['token'];
										$target = $d['no_hp'];
										$nama_pegawai = $d['nama_pegawai'];
					  				$tansi = $this->m_umum->ambil_data('a_instansi','id_instansi',$temp['id_instansi']);
					  				$instance_name = $tansi["nama_instansi"];
										$tgl_lahir = $this->m_rancak->fullBulan(date('d-m-Y', strtotime($d['tgl_lahir'])));
										$br = "\n";
										$message = "*".$instance_name."*";
										$message .= $br. $br."*AKUN KREDENSIAL.COM TELAH AKTIF*";
										$message .= $br."📜 *INI ADALAH KONFIRMASI SATU ARAH MOHON JANGAN BALAS DISINI*";
										$message .= $br. "Nama : " . $d['nama_pegawai'];
										$message .= $br. "TTL : " . $d['tmp_lahir'] .", ". $tgl_lahir;
										$message .= $br. "No KTP : " . $d['nik'];
										$message .= $br. "NIP : " . $d['nip'];
										$message .= $br. "No HP : " . $d['no_hp'];
										$message .= $br. "E-mail : " . $d['email'];
										$message .= $br. "Username : " . $us['username'];
										$message .= $br. "Password : 7654321";
										$message .= $br. $br."KREDENSIAL LOGIN : ";
										$message .= $br. $logine;
									//	$this->m_umum->kirim_fonte_text($token,$target,$message);

										$this->session->set_flashdata('sukses', 'Data berhasil Di Tambah');
										redirect(base_url('admin_user/aktifasi'));
									}else{
										$this->session->set_flashdata('danger', 'Ada Masalah Edit Data');
										redirect(base_url('admin_user/aktifasi'));
									}
								}else{
								  $this->session->set_flashdata('danger', 'NIP Sudah Ada');
								  redirect(base_url('admin_user/aktifasi'));
								}
							}else{
							  $this->session->set_flashdata('danger', 'No KTP Sudah Ada');
							  redirect(base_url('admin_user/aktifasi'));
							}
						}else{
							$this->session->set_flashdata('danger', 'Username Sudah Ada');
							redirect(base_url('admin_user/aktifasi'));
						}
				}
			}
		}
	}
	function data_user($mode='view'){
		$data['page']="data_user"; 
		$data['header'] = "DATA USER";
		$data['title'] = "DATA USER";
		$data['link_awal'] = base_url('admin_user');
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
		//	$program = $this->m_umum->ambil_data('a_program','id_program',10);
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
		$data['idas']   = $this->uri->segment(4, 0);
		$data['id']   = $this->uri->segment(5, 0);
		//======================= IMPORTANT =========================================
    	$trim_keyword   = urldecode(trim($this->uri->segment(4, 0)));
		$replace_keyword   = preg_replace('/\s+/', ' ', $trim_keyword);
		$data['key'] = str_replace(' ', '-', $replace_keyword);
		if($data['key'] == NULL OR empty($data['key'])){
			$data['key'] = "";
		}
		if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
			if($action == 'BtnProses') {
        $trim_keyword   = urldecode(trim($this->input->post("key")));
  			$replace_keyword   = preg_replace('/\s+/', ' ', $trim_keyword);
  			$key = str_replace(' ', '-', $replace_keyword);
				redirect(base_url('admin_user/data_user/view/'.$key));
			}
		}
    	else if($mode=='data'){
			$key = urldecode(trim($this->uri->segment(4, 0)));
			$key = strtolower($key);
			$key = preg_replace('/[^A-Za-z0-9\-]/', '', $key);
			$key = str_replace(' ', '-', $key);
			echo json_encode($this->m_admin_user->user_all($key));
		}
		else{
			$data['kol_provinsi'] = $this->m_rancak->cmd_kol_provinsi();
			$data['cmd_tipe_pegawai'] = $this->m_ol_rancak->cmd_tipe_pegawai();
			$data['cmd_jabfung'] = $this->m_ol_rancak->cmd_jabfung_buket();
			$data['status'] = $this->m_rancak->cmd_status();
			$data['gender'] = $this->m_rancak->cmd_jk();
			$data['cmd_agama'] = $this->m_rancak->cmd_agama();
			$data['cmd_status_kawin'] = $this->m_rancak->cmd_status_kawin();
			$data['cmd_pendidikan'] = $this->m_rancak->cmd_pendidikan();
//			$data['opsi_status_perawat'] = $this->m_ol_rancak->status_perawat();
			if($mode=='reset'){
				$kondisi = array('id_user'=>$data['key']);
				$d = $this->m_umum->ambil_data_kondisi_2tabel_row('ol_user',$kondisi,'ol_pegawai','id_pegawai');
				$no_hp = $d['no_hp'];
				$id_pegawai = $d['id_pegawai'];
				$nama_pegawai = $d['nama_pegawai'];
				if($id_pegawai == 1){
					$this->session->set_flashdata('danger', 'Tidak dapat mereset Superadmin');
					redirect(base_url('admin_user/data_user'));
				}else{
			  		if($this->m_admin_user->reset_password($data['key'])){
					$a = $this->m_umum->ambil_data('kol_komite','id_komite',$d['status_asesor']);
					$wagw = $this->m_umum->ambil_data('a_wageblast','id_wageblast',1);
					$bayar = $this->m_umum->ambil_data('aplikasi_bayar','id_konsumen',$d['id_pegawai']);
					$grade = $this->m_umum->ambil_data('ol_pegawai_grade','id_grade',$d['id_grade']);
					if( $a['id_komite'] == 0){ $nama_asesor = 'Anggota'; }else{ $nama_asesor = $a['nama_komite']; }
					if( $bayar['status_aplikasi_bayar'] == 0){ 
						$expired = 'Premium'; 
					}else{ 
						$expired = 'Tanggal Expired s/d '.$this->m_rancak->fullBulan(date('d-m-Y', strtotime($bayar['tgl_expired']))); 
					}
					$token = $wagw['token'];
					$texturl ='Silahkan Login';
					$url ='https://kredensial.com/masuk';
					$logo ='https://kredensial.com/headwa.png';
					$target = $d['no_hp'];
					$id_pegawai = $d['id_pegawai'];
					$nama_pegawai = $d['nama_pegawai'];
					$logine = base_url('masuk');
  					$tansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
  					$instance_name = $tansi["nama_instansi"];
					$tgl_lahir = $this->m_rancak->fullBulan(date('d-m-Y', strtotime($d['tgl_lahir'])));
					$br = "\n";
					$message = "*".$instance_name."*";
					$message .= $br. $br."AKUN ANDA TELAH DI RESET";
					$message .= $br."📜 Data Anda Sekarang";
					$message .= $br. "Nama : " . $d['nama_pegawai'];
					$message .= $br. "TTL : " . $d['tmp_lahir'] .", ". $tgl_lahir;
					$message .= $br. "No KTP : " . $d['nik'];
					$message .= $br. "NIP : " . $d['nip'];
					$message .= $br. "No HP : " . $d['no_hp'];
					$message .= $br. "E-mail : " . $d['email'];
					$message .= $br. "Status : " . $nama_asesor;
					$message .= $br. "Grade : " . $grade['nama_grade'];
					$message .= $br. "Username : " . $d['username'];
					$message .= $br. "Password : 7654321";
					$message .= $br. $br."SILAHKAN LOGIN : ";
					$message .= $br. $logine;
					$this->m_umum->kirim_fonte_text($token,$target,$message);
					$this->session->set_flashdata('sukses', 'Password di Reset menjadi 7654321');
					redirect(base_url('admin_user/data_user'));
					}else{
						$this->session->set_flashdata('danger', 'Masalah Edit Data');
						redirect(base_url('admin_user/data_user'));
					}
			}
			}
			if($mode=='asesor'){
			  $data['page'] =  $data['page']."_asesor";	
				$data['komite'] = $this->m_rancak->ambil_kol_komite_null();		
				$take = $this->m_umum->ambil_data('ol_user','id_user',$data['key']);		
				$data['id_user']  = set_value('id_user',$take['id_user']);
				$data['status_asesor']  = set_value('status_asesor',$take['status_asesor']);
				$this->load->view("admin_user/isi",$data);
			}
			if($mode=='simpan_asesor'){
				if($this->m_admin_user->simpan_status_asesor()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('admin_user/data_user'));
				}else{
					$this->session->set_flashdata('danger', 'Kompetensi Sudah Selesai');
					redirect(base_url('admin_user/data_user'));
				}
			}
			if($mode=='grade'){
			  $data['page'] =  $data['page']."_grade";		
				$take = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$data['key']);	
				$jab = $this->m_umum->ambil_data('jabatan_fungsional','id_jabatan_fungsional',$take['id_jabatan_fungsional']);	
				$data['grade'] = $this->m_admin_kredensial->cmd_grade($jab['id_jabatan']);		
				$data['id_pegawai']  = set_value('id_pegawai',$take['id_pegawai']);
				$data['id_grade']  = set_value('id_grade',$take['id_grade']);
				$this->load->view("admin_user/isi",$data);
			}
			if($mode=='simpan_grade'){
				$id_grade = $this->input->post('id_grade');
				if($id_grade){
					if($this->m_admin_user->simpan_grade()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					}else{
						$this->session->set_flashdata('danger', 'Kompetensi Sudah Selesai');
					}
				}else{
					$this->session->set_flashdata('danger', 'Data Tidak Valid');
				}
				redirect(base_url('admin_user/data_user'));
			}
			if($mode=='unit'){
			  $data['page'] =  $data['page']."_unit";	
				$data['unit'] = $this->m_ol_rancak->ambil_unit_nonull($data['id']);		
				$kondisi_unit = array('id_pegawai'=>$data['idas']);
				$jml = $this->m_umum->jumlah_record_filter('ol_pegawai_unit',$kondisi_unit);
				if($jml == 0){
					$data['id_pegawai']  = set_value('id_pegawai',$this->input->post('id_pegawai'));
					$data['id_unit']  = set_value('id_unit',$this->input->post('id_unit'));
				}else{
					$take = $this->m_umum->ambil_data('ol_pegawai_unit','id_pegawai',$data['idas']);		
					$data['id_pegawai']  = set_value('id_pegawai',$take['id_pegawai']);
					$data['id_unit']  = set_value('id_unit',$take['id_unit']);
				}
				$this->load->view("admin_user/isi",$data);
			}
			if($mode=='simpan_unit'){
				$id_pegawai = $this->input->post('id_pegawai');
				$kondisi_unit = array('id_pegawai'=>$id_pegawai);
				$jml = $this->m_umum->jumlah_record_filter('ol_pegawai_unit',$kondisi_unit);
				if($jml == 0){
					if($this->m_admin_user->simpan_pegawai_unit()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('admin_user/data_user'));
					}else{
						$this->session->set_flashdata('danger', 'Kompetensi Sudah Selesai');
						redirect(base_url('admin_user/data_user'));
					}
				}else{
					if($this->m_admin_user->edit_pegawai_unit()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('admin_user/data_user'));
					}else{
						$this->session->set_flashdata('danger', 'Kompetensi Sudah Selesai');
						redirect(base_url('admin_user/data_user'));
					}
				}
			}
			if($mode=='grade'){
			  $data['page'] =  $data['page']."_grade";		
				$take = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$data['key']);	
				$jab = $this->m_umum->ambil_data('jabatan_fungsional','id_jabatan_fungsional',$take['id_jabatan_fungsional']);	
				$data['grade'] = $this->m_admin_kredensial->cmd_grade($jab['id_jabatan']);		
				$data['id_pegawai']  = set_value('id_pegawai',$take['id_pegawai']);
				$data['id_grade']  = set_value('id_grade',$take['id_grade']);
				$this->load->view("admin_user/isi",$data);
			}
			if($mode=='simpan_grade'){
				if($this->m_admin_user->simpan_grade()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('admin_user/data_user'));
				}else{
					$this->session->set_flashdata('danger', 'Kompetensi Sudah Selesai');
					redirect(base_url('admin_user/data_user'));
				}
			}
			if($mode=='edit'){
			  $data['page'] =  $data['page']."_edit";
				$pegawai = $this->m_ol_rancak->ambil_ol_pegawai($data['idas']);
				$data['id_prov']  = set_value('id_prov',$pegawai['id_prov']);
				$data['id_kab']  = set_value('id_kab',$pegawai['id_kab']);
				$data['id_kel']  = set_value('id_kel',$pegawai['id_kel']);
				$data['id_kec']  = set_value('id_kec',$pegawai['id_kec']);
				$data['kab'] = $this->m_ol_rancak->ambil_data_dropdown_kab($pegawai['id_prov']);
				$data['kec'] = $this->m_ol_rancak->ambil_data_dropdown_kec($pegawai['id_kab']);
				$data['kel'] = $this->m_ol_rancak->ambil_data_dropdown_kel($pegawai['id_kec']);
				$data['grade'] = $this->m_admin_kredensial->cmd_grade($pegawai['id_jabatan']);	
				$data['id_pegawai']  = set_value('id_pegawai',$pegawai['id_pegawai']);
				$data['id_user']  = set_value('id_user',$pegawai['id_user']);
				$data['id_grade']  = set_value('id_grade',$pegawai['id_grade']);
				$data['nama_pegawai']  = set_value('nama_pegawai',$pegawai['nama_pegawai']);
				$data['username']  = set_value('username',$pegawai['username']);
				$data['password']  = set_value('password',$pegawai['password']);
				$data['email']  = set_value('email',$pegawai['email']);
				$data['username']  = set_value('username',$pegawai['username']);
				$data['username_lama']  = set_value('username_lama',$pegawai['username']);
				$data['password_lama']  = set_value('password_lama',$pegawai['password']);
				$data['no_hp']  = set_value('no_hp',$pegawai['no_hp']);
				$data['jk']  = set_value('jk',$pegawai['jk']);
				$data['foto']  = set_value('foto',$pegawai['foto']);
				$data['tipe_pegawai']  = set_value('tipe_pegawai',$pegawai['tipe_pegawai']);
				$data['nik']  = set_value('nik',$pegawai['nik']);
				$data['nip']  = set_value('nip',$pegawai['nip']);
				$data['id_status_kawin']  = set_value('id_status_kawin',$pegawai['id_status_kawin']);
				$data['id_agama']  = set_value('id_agama',$pegawai['id_agama']);
				$data['alamat']  = set_value('alamat',$pegawai['alamat']);
				$data['id_pendidikan']  = set_value('id_pendidikan',$pegawai['id_pendidikan']);
				$data['id_jabatan_fungsional']  = set_value('id_jabatan_fungsional',$pegawai['id_jabatan_fungsional']);
				$data['no_profesi']  = set_value('no_profesi',$pegawai['no_profesi']);
				$data['tmp_lahir']  = set_value('tmp_lahir',$pegawai['tmp_lahir']);
				$data['tgl_lahir']  = set_value('tgl_lahir',date('d/m/Y', strtotime($pegawai['tgl_lahir'])));
				$this->load->view("admin_user/isi",$data);
			}
			if($mode=='simpan_edit'){
				$nik_lama= $this->input->post('nik_lama');
				$nik= $this->input->post('nik');
				$nip_lama= $this->input->post('nip_lama');
				$nip= $this->input->post('nip');
				$username_lama= $this->input->post('username_lama');
				$username= $this->input->post('username');
				$username = strtolower($username);
				$username = str_replace(' ', '-', $username);
				$username = preg_replace('/[^A-Za-z0-9\-]/', '', $username);
				$kondisi=array('username'=>$username,'username !='=>$username_lama);
				$jml = $this->m_umum->jumlah_record_filter('ol_user',$kondisi);
				$kondisi2=array('nik'=>$nik,'nik !='=>$nik_lama);
				$jml2 = $this->m_umum->jumlah_record_filter('ol_pegawai',$kondisi2);
				$kondisi3=array('nip'=>$nip,'nip !='=>$nip_lama);
				$jml3 = $this->m_umum->jumlah_record_filter('ol_pegawai',$kondisi3);
				if($jml == 0){
					if($jml2 == 0){
						if($jml3 == 0){
							if($this->m_admin_user->edit_pegawai()){
								$this->m_admin_user->edit_user();
								$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
								redirect(base_url('admin_user/data_user'));
							}else{
								$this->session->set_flashdata('danger', 'Kompetensi Sudah Selesai');
								redirect(base_url('admin_user/data_user'));
							}		
						}else{
							$this->session->set_flashdata('danger', 'NIP Sudah Ada');
							redirect(base_url('admin_user/data_user'));
						}
					}else{
						$this->session->set_flashdata('danger', 'No KTP Sudah Ada');
						redirect(base_url('admin_user/data_user'));
					}
				}else{
					$this->session->set_flashdata('danger', 'Username Sudah Ada');
					redirect(base_url('admin_user/data_user'));
				}
			}
			if($mode=='wa_asesor'){
				$kondisi = array('id_user'=>$data['key']);
				$d = $this->m_umum->ambil_data_kondisi_2tabel_row('ol_user',$kondisi,'ol_pegawai','id_pegawai');
				$a = $this->m_umum->ambil_data('kol_komite','id_komite',$d['status_asesor']);
				$wagw = $this->m_umum->ambil_data('a_wageblast','id_wageblast',1);
				$bayar = $this->m_umum->ambil_data('aplikasi_bayar','id_konsumen',$d['id_pegawai']);
				$grade = $this->m_umum->ambil_data('ol_pegawai_grade','id_grade',$d['id_grade']);
				if( $a == 0){ $nama_asesor = 'Anggota'; }else{ $nama_asesor = $a['nama_komite']; }
				if( $bayar['status_aplikasi_bayar'] == 0){ 
					$expired = 'Premium'; 
				}else{ 
					$expired = 'Tanggal Expired s/d '.$this->m_rancak->fullBulan(date('d-m-Y', strtotime($bayar['tgl_expired']))); 
				}
				$logine = base_url('masuk');
				$token = $wagw['token'];
				$texturl ='Silahkan Login';
				$url ='https://kredensial.com/masuk';
				$logo ='https://kredensial.com/headwa.png';
				$target = $d['no_hp'];
				$id_pegawai = $d['id_pegawai'];
				$nama_pegawai = $d['nama_pegawai'];
				$tansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
				$instance_name = $tansi["nama_instansi"];
				$tgl_lahir = $this->m_rancak->fullBulan(date('d-m-Y', strtotime($d['tgl_lahir'])));
				$br = "\n";
				$message = "*".$instance_name."*";
				$message .= $br. $br."STATUS USER BERUBAH";
				$message .= $br."📜 Data Anda Sekarang";
				$message .= $br. "Nama : " . $d['nama_pegawai'];
				$message .= $br. "TTL : " . $d['tmp_lahir'] .", ". $tgl_lahir;
				$message .= $br. "No KTP : " . $d['nik'];
				$message .= $br. "NIP : " . $d['nip'];
				$message .= $br. "No HP : " . $d['no_hp'];
				$message .= $br. "E-mail : " . $d['email'];
				$message .= $br. "Status : " . $nama_asesor;
				$message .= $br. "Grade : " . $grade['nama_grade'];
				$message .= $br. "Status Akun : " . $expired;
				$message .= $br. "Username : " . $d['username'];
				$message .= $br. $br."SILAHKAN LOGIN : ";
				$message .= $br. $logine;
				$this->m_umum->kirim_fonte_text($token,$target,$message);
				$this->session->set_flashdata('sukses', 'Data Berhasil Di Kirim');
				redirect(base_url('admin_user/data_user'));
			}
		}
	}
  function berkas_kategori($mode='view')
  {
	$data['page']  = "berkas_kategori";
	$data['header'] = "KATEGORI BERKAS";
	$data['title'] = "KATEGORI BERKAS";
		$data['link_awal'] = base_url('instansi_user');
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',10);
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
		$data['id']   = $this->uri->segment(4, 0);
	//======================= IMPORTANT ======================================
    if($mode=='view'){
	$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_admin_user->berkas_kategori_all());
	}
  else if($mode=='hapus'){
	  $kondisi2=array('pembuat_berkas_kategori'=>$this->session->id_pegawai);
	  $kondisi=array('id_kategori_berkas'=>$data['id']);
	  $jml2 = $this->m_umum->jumlah_record_filter('ol_berkas_kategori',$kondisi2);
	  $jml = $this->m_umum->jumlah_record_filter('ol_berkas',$kondisi);
	  if($jml == 0){
	  	if($jml2 > 0){
		    $di = $this->m_umum->ambil_data('ol_berkas_kategori','id_berkas_kategori',$data['id']);
		    $kunci = $di['kunci'];
		    $unit_berkas = $di['unit'];
		    if($unit_berkas !== 255 AND $kunci==25){
		      if($this->m_umum->hapus_data('ol_berkas_kategori','id_berkas_kategori',$data['id'])){
		      $this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
		      redirect(base_url('admin_user/berkas_kategori'));
		      }else{
		      $this->session->set_flashdata('danger', 'Masalah Hapus Data');
		      redirect(base_url('admin_user/berkas_kategori'));
		      }
		    }else{
		      $this->session->set_flashdata('danger', 'Beda Permission');
		      redirect(base_url('admin_user/berkas_kategori'));
		    }
		  }else{
		      $this->session->set_flashdata('danger', 'Bukan Pembuat Data');
		      redirect(base_url('admin_user/berkas_kategori'));
		  }
	  }else{
	      $this->session->set_flashdata('danger', 'Data Sudah Masuk Alur');
	      redirect(base_url('admin_user/berkas_kategori'));
	  }
  }
	else{
			$data['working']=$this->m_admin_kredensial->ambil_data_rujukan_working();
			$data['cmd_status']=$this->m_rancak->cmd_status();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['nama_berkas_kategori']  = set_value('nama_berkas_kategori',$this->input->post('nama_berkas_kategori'));
				$data['status_berkas_kategori']  = set_value('status_berkas_kategori',$this->input->post('status_berkas_kategori'));
				$data['instansi_berkas_kategori']  = set_value('instansi_berkas_kategori',$this->input->post('instansi_berkas_kategori'));
				$this->load->view("admin_user/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($this->m_admin_user->simpan_berkas_kategori($data['ruangan_id'])){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('admin_user/berkas_kategori'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('admin_user/berkas_kategori'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('ol_berkas_kategori','id_berkas_kategori',$data['id']);
				$data['nama_berkas_kategori']  = set_value('nama_berkas_kategori',$keuangan["nama_berkas_kategori"]);
				$data['status_berkas_kategori']  = set_value('status_berkas_kategori',$keuangan["status_berkas_kategori"]);
				$data['instansi_berkas_kategori']  = set_value('instansi_berkas_kategori',$keuangan["instansi_berkas_kategori"]);
				$this->load->view("admin_user/isi",$data);
      }
      if($mode=='simpan_edit'){
				$id_berkas_kategori = $this->input->post('id_berkas_kategori');
				$kondisi2=array('pembuat_berkas_kategori'=>$this->session->id_pegawai);
		 		$kondisi=array('id_kategori_berkas'=>$id_berkas_kategori);
		 		$jml2 = $this->m_umum->jumlah_record_filter('ol_berkas_kategori',$kondisi2);
				$jml = $this->m_umum->jumlah_record_filter('ol_berkas',$kondisi);
				if($jml == 0){
					if($jml2 > 0){
						$di = $this->m_umum->ambil_data('ol_berkas_kategori','id_berkas_kategori',$id_berkas_kategori);
						$kunci = $di['kunci']; // kategori berkas yang boleh dihapus = 25 dan untuk penggolongan
						$unit_berkas = $di['unit'];
						if($unit_berkas !== 255 && $kunci == 25){
							  if($this->m_admin_user->edit_berkas_kategori()){
									$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
									redirect(base_url('admin_user/berkas_kategori'));
							  }else{
									$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
									redirect(base_url('admin_user/berkas_kategori'));
							  }
						}
						else{
								$this->session->set_flashdata('danger', 'Beda Permission');
								redirect(base_url('admin_user/berkas_kategori'));
						}
				  }else{
				      $this->session->set_flashdata('danger', 'Bukan Pembuat Data');
				      redirect(base_url('admin_user/berkas_kategori'));
			  	}
				}else{
						$this->session->set_flashdata('danger', 'Data Sudah masuk berkas');
						redirect(base_url('admin_user/berkas_kategori'));
				}
      }
	}
  }
  function kategori_pelatihan($mode='view')
  {
	$data['page']  = "kategori_pelatihan";
	$data['header'] = "KATEGORI PELATIHAN";
	$data['title'] = "KATEGORI PELATIHAN";
		$data['link_awal'] = base_url('instansi_user');
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',10);
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
		$data['id']   = $this->uri->segment(4, 0);
	//======================= IMPORTANT ======================================
    if($mode=='view'){
	$this->tampil($data);
	}
  else if($mode=='data'){
		echo json_encode($this->m_admin_user->kategori_pelatihan_all());
	}
  else if($mode=='hapus'){
	  $kondisi2=array('pembuat_kategori_pelatihan'=>$this->session->id_pegawai);
	  $jml2 = $this->m_umum->jumlah_record_filter('ol_kategori_pelatihan',$kondisi2);
		$kondisi=array('id_kategori_pelatihan'=>$data['id']);
		$jml = $this->m_umum->jumlah_record_filter('ol_berkas',$kondisi);
	  if($jml == 0){
	  	if($jml2 > 0){
		      if($this->m_umum->hapus_data('ol_kategori_pelatihan','id_kategori_pelatihan',$data['id'])){
		      $this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
		      redirect(base_url('admin_user/kategori_pelatihan'));
		      }else{
		      $this->session->set_flashdata('danger', 'Masalah Hapus Data');
		      redirect(base_url('admin_user/kategori_pelatihan'));
		      }
		  }else{
		      $this->session->set_flashdata('danger', 'Bukan Pembuat Data');
		      redirect(base_url('admin_user/kategori_pelatihan'));
		  }
	  }else{
	      $this->session->set_flashdata('danger', 'Data Sudah Masuk Alur');
	      redirect(base_url('admin_user/kategori_pelatihan'));
	  }
  }
	else{
			$data['cmd_status']=$this->m_rancak->cmd_status();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['nama_kategori_pelatihan']  = set_value('nama_kategori_pelatihan',$this->input->post('nama_kategori_pelatihan'));
				$data['status_kategori_pelatihan']  = set_value('status_kategori_pelatihan',$this->input->post('status_kategori_pelatihan'));
				$this->load->view("admin_user/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($this->m_admin_user->simpan_kategori_pelatihan()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('admin_user/kategori_pelatihan'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('admin_user/kategori_pelatihan'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('ol_kategori_pelatihan','id_kategori_pelatihan',$data['id']);
				$data['nama_kategori_pelatihan']  = set_value('nama_kategori_pelatihan',$keuangan["nama_kategori_pelatihan"]);
				$data['status_kategori_pelatihan']  = set_value('status_kategori_pelatihan',$keuangan["status_kategori_pelatihan"]);
				$data['pembuat_kategori_pelatihan']  = set_value('pembuat_kategori_pelatihan',$keuangan["pembuat_kategori_pelatihan"]);
				$this->load->view("admin_user/isi",$data);
      }
      if($mode=='simpan_edit'){
				$id_kategori_pelatihan = $this->input->post('id_kategori_pelatihan');
				$pembuat_kategori_pelatihan = $this->input->post('pembuat_kategori_pelatihan');
				$kondisi=array('id_kategori_pelatihan'=>$id_kategori_pelatihan);
				$jml = $this->m_umum->jumlah_record_filter('ol_berkas',$kondisi);
				if($jml == 0){
					if($pembuat_kategori_pelatihan == $this->session->id_pegawai){
					  if($this->m_admin_user->edit_kategori_pelatihan()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('admin_user/kategori_pelatihan'));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('admin_user/kategori_pelatihan'));
					  }
					}else{
						$this->session->set_flashdata('danger', 'Bukan Pembuat Data');
						redirect(base_url('admin_user/kategori_pelatihan'));
					}
				}
				else{
						$this->session->set_flashdata('danger', 'Data Sudah Dipakai Pelatihan');
						redirect(base_url('admin_user/kategori_pelatihan'));
				}
      }
		}
  }
  function peminatan($mode='view')
  {
	$data['page']  = "peminatan";
	$data['header'] = "PEMINATAN";
	$data['title'] = "PEMINATAN";
		$data['link_awal'] = base_url('admin_user');
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',10);
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
		$data['id']   = $this->uri->segment(4, 0);
	//======================= IMPORTANT ======================================
    if($mode=='view'){
	$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_admin_user->peminatan_all());
	}
/*  else if($mode=='hapus'){
  $kondisi=array('id_berkas_kategori'=>$data['id']);
  $jml = $this->m_umum->jumlah_record_filter('ol_berkas',$kondisi);
  if($jml == 0){
    $di = $this->m_umum->ambil_data('ol_berkas_kategori','id_berkas_kategori',$data['id']);
    $kunci = $di['kunci'];
    $unit_berkas = $di['unit'];
    if($unit_berkas !== 255 AND $kunci==25){
      if($this->m_umum->hapus_data('ol_berkas_kategori','id_berkas_kategori',$data['id'])){
      $this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
      redirect(base_url('admin_user/berkas_kategori'));
      }else{
      $this->session->set_flashdata('danger', 'Masalah Hapus Data');
      redirect(base_url('admin_user/berkas_kategori'));
      }
    }else{
      $this->session->set_flashdata('danger', 'Beda Permission');
      redirect(base_url('admin_user/berkas_kategori'));
    }
  }else{
      $this->session->set_flashdata('danger', 'Data Sudah Masuk Alur');
      redirect(base_url('admin_user/berkas_kategori'));
  }
  }*/
	else{
			$data['cmd_status']=$this->m_rancak->cmd_status();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['nama_peminatan']  = set_value('nama_peminatan',$this->input->post('nama_peminatan'));
				$data['status_peminatan']  = set_value('status_peminatan',$this->input->post('status_peminatan'));
				$this->load->view("admin_user/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($this->m_admin_user->simpan_peminatan()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('admin_user/peminatan'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('admin_user/peminatan'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('ol_peminatan','id_peminatan',$data['id']);
				$data['id_peminatan']  = set_value('id_peminatan',$keuangan["id_peminatan"]);
				$data['nama_peminatan']  = set_value('nama_peminatan',$keuangan["nama_peminatan"]);
				$data['status_peminatan']  = set_value('status_peminatan',$keuangan["status_peminatan"]);
				$this->load->view("admin_user/isi",$data);
      }
      if($mode=='simpan_edit'){
				  if($this->m_admin_user->edit_peminatan()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
						redirect(base_url('admin_user/peminatan'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
						redirect(base_url('admin_user/peminatan'));
				  }
      }
	}
  }
  function unit($mode='view')
  {
		$data['page']  = "unit";
		$data['header'] = "DATA RUANGAN / UNIT";
		$data['title'] = "DATA RUANGAN / UNIT";
		$data['link_awal'] = base_url('admin_user');
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',10);
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
		$data['id']   = $this->uri->segment(4, 0);
	//======================= IMPORTANT ======================================
    if($mode=='view'){
	$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_admin_user->ol_unit_all());
	}
	else{
		$data['cmd_status']=$this->m_rancak->cmd_status();
		$data['cmd_struktur_jabatan']=$this->m_rancak->cmd_struktur_jabatan();
		$data['ambil_data_working'] = $this->m_ol_rancak->ambil_data_rujukan_kab_working($this->session->mas_ins);
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['nama_unit']  = set_value('nama_unit',$this->input->post('nama_unit'));
				$data['id_instansi']  = set_value('id_instansi',$this->input->post('id_instansi'));
				$data['id_struktur_jabatan']  = set_value('id_struktur_jabatan',$this->input->post('id_struktur_jabatan'));
				$data['status_unit']  = set_value('status_unit',$this->input->post('status_unit'));
				$this->load->view("admin_user/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($this->m_admin_user->simpan_ol_unit()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('admin_user/unit'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('admin_user/unit'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('ol_unit','id_unit',$data['id']);
				$data['id_unit']  = set_value('id_unit',$keuangan["id_unit"]);
				$data['nama_unit']  = set_value('nama_unit',$keuangan["nama_unit"]);
				$data['id_instansi']  = set_value('id_instansi',$keuangan["id_instansi"]);
				$data['id_struktur_jabatan']  = set_value('id_struktur_jabatan',$keuangan["id_struktur_jabatan"]);
				$data['status_unit']  = set_value('status_unit',$keuangan["status_unit"]);
				$this->load->view("admin_user/isi",$data);
      }
      if($mode=='simpan_edit'){
				  if($this->m_admin_user->edit_ol_unit()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
						redirect(base_url('admin_user/unit'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
						redirect(base_url('admin_user/unit'));
				  }
      }
		}
  }
  function ms_etik($mode='view')
  {
		$data['page']  = "ms_etik";
		$data['header'] = "DATA MASTER SOAL ETIKA PROFESI";
		$data['title'] = "DATA MASTER SOAL ETIKA PROFESI";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',10);
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
		$data['jabataneira'] = $this->m_rancak->cmd_jabatan_wherein();
		$data['id']   = $this->uri->segment(4, 0);
	//======================= IMPORTANT ======================================
    if($mode=='view'){
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$id = $this->input->post("id_jabatan");
				redirect(base_url('admin_user/ms_etik/view/'.$id));
			}
	$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_admin_user->ms_etik_all($data['id']));
	}
	else{
		$data['cmd_answer']=array('1'=>'YA','0'=>'TIDAK');
		$data['cmd_status']=$this->m_rancak->cmd_status();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['nama_etik']  = set_value('nama_etik',$this->input->post('nama_etik'));
				$data['id_jabatan']  = set_value('id_jabatan',$this->input->post('id_jabatan'));
				$data['answer']  = set_value('answer',$this->input->post('answer'));
				$data['status_etik']  = set_value('status_etik',$this->input->post('status_etik'));
				$this->load->view("admin_user/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($this->m_admin_user->simpan_nkr_etik()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('admin_user/ms_etik'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('admin_user/ms_etik'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('nkr_etik','id_etik',$data['id']);
				$data['id_etik']  = set_value('id_etik',$keuangan["id_etik"]);
				$data['nama_etik']  = set_value('nama_etik',$keuangan["nama_etik"]);
				$data['id_jabatan']  = set_value('id_jabatan',$keuangan["id_jabatan"]);
				$data['answer']  = set_value('answer',$keuangan["answer"]);
				$data['pembuat_etik']  = set_value('pembuat_etik',$keuangan["pembuat_etik"]);
				$data['status_etik']  = set_value('status_etik',$keuangan["status_etik"]);
				$this->load->view("admin_user/isi",$data);
      }
      if($mode=='simpan_edit'){
      	$pembuat_etik = $this->input->post('pembuat_etik');
      	if($pembuat_etik == $this->session->id_pegawai){
				  if($this->m_admin_user->edit_nkr_etik()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
						redirect(base_url('admin_user/ms_etik'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
						redirect(base_url('admin_user/ms_etik'));
				  }
      	}else{
						$this->session->set_flashdata('danger', 'Beda Hak Akses');
						redirect(base_url('admin_user/ms_etik'));      		
      	}

      }
		}
  }
	function demografi($mode='view'){
		$data['page']="demografi"; 
		$data['header'] = "DATA DEMOGRAFI";
		$data['title'] = "DATA DEMOGRAFI";
		$data['link_awal'] = base_url('admin_user');
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',10);
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
		$data['id']   = $this->uri->segment(4, 0);
		$data['id2']   = $this->uri->segment(5, 0);
		//======================= IMPORTANT =========================================
			$data['working']=$this->m_admin_kredensial->ambil_data_rujukan_working();
			$data['jabatan']=$this->m_admin_kredensial->cmd_jabatan();
	  if($mode=='view'){
			if(empty($data['id'])){
				$data['id'] = $this->session->refer;
			}
			if(empty($data['id2'])){
				$data['id2'] = $this->session->id_jabatan;
			}
			$kerjae = $this->m_umum->ambil_data('kol_working','id_working',$data['id']);
			$data['gawe_sekien'] = $kerjae['nama_working'];
			$fungsie = $this->m_umum->ambil_data('jabatan','id_jabatan',$data['id2']);
			$data['jab_sekien'] = $fungsie['nama_jabatan'];
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$id = $this->input->post("id");
				$id2 = $this->input->post("id2");
				redirect(base_url('admin_user/demografi/view/'.$id.'/'.$id2));
			}
			$this->tampil_top($data);
		}
		if($mode=='pdf_gender'){
	    $report = $this->load->view('cetak/kred_gender', $data, TRUE);
		  $namaku = $this->m_umum->ambil_data('kol_working','id_working',$data['id']);
		  $arankerja = preg_replace('/[ .]+/', ' ', $namaku['nama_working']);
		  $jabatanku = $this->m_umum->ambil_data('jabatan','id_jabatan',$data['id2']);
		  $filename = 'kredensial-'.$arankerja."-".$jabatanku['nama_jabatan']."-print-date-".date('d-m-Y-H-i-s')."-instansi-jabfung-gender.pdf";
//$mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'L','margin_left' => '5','margin_right' => '5','margin_top' => '5','margin_bottom' => '5']);
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->AddPage('L', '', '', '', 2, 5, 5, 5, 5, 3, 3);
		  $mpdf->SetDisplayMode('fullpage');
		  //$mpdf->SetFooter('Page : {PAGENO}');
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
		if($mode=='pdf_religi'){
	    $report = $this->load->view('cetak/kred_religi', $data, TRUE);
		  $namaku = $this->m_umum->ambil_data('kol_working','id_working',$data['id']);
		  $arankerja = preg_replace('/[ .]+/', ' ', $namaku['nama_working']);
		  $jabatanku = $this->m_umum->ambil_data('jabatan','id_jabatan',$data['id2']);
		  $filename = 'kredensial-'.$arankerja."-".$jabatanku['nama_jabatan']."-print-date-".date('d-m-Y-H-i-s')."-instansi-jabfung-religi.pdf";
//$mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'L','margin_left' => '5','margin_right' => '5','margin_top' => '5','margin_bottom' => '5']);
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->AddPage('L', '', '', '', 2, 5, 5, 5, 5, 3, 3);
		  $mpdf->SetDisplayMode('fullpage');
		  //$mpdf->SetFooter('Page : {PAGENO}');
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
		if($mode=='pdf_marital'){
	    $report = $this->load->view('cetak/kred_marital', $data, TRUE);
		  $namaku = $this->m_umum->ambil_data('kol_working','id_working',$data['id']);
		  $arankerja = preg_replace('/[ .]+/', ' ', $namaku['nama_working']);
		  $jabatanku = $this->m_umum->ambil_data('jabatan','id_jabatan',$data['id2']);
		  $filename = 'kredensial-'.$arankerja."-".$jabatanku['nama_jabatan']."-print-date-".date('d-m-Y-H-i-s')."-instansi-jabfung-marital.pdf";
//$mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'L','margin_left' => '5','margin_right' => '5','margin_top' => '5','margin_bottom' => '5']);
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->AddPage('L', '', '', '', 2, 5, 5, 5, 5, 3, 3);
		  $mpdf->SetDisplayMode('fullpage');
		  //$mpdf->SetFooter('Page : {PAGENO}');
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
		if($mode=='pdf_asn'){
	    $report = $this->load->view('cetak/kred_asn', $data, TRUE);
		  $namaku = $this->m_umum->ambil_data('kol_working','id_working',$data['id']);
		  $arankerja = preg_replace('/[ .]+/', ' ', $namaku['nama_working']);
		  $jabatanku = $this->m_umum->ambil_data('jabatan','id_jabatan',$data['id2']);
		  $filename = 'kredensial-'.$arankerja."-".$jabatanku['nama_jabatan']."-print-date-".date('d-m-Y-H-i-s')."-instansi-jabfung-pegawai.pdf";
//$mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'L','margin_left' => '5','margin_right' => '5','margin_top' => '5','margin_bottom' => '5']);
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->AddPage('L', '', '', '', 2, 5, 5, 5, 5, 3, 3);
		  $mpdf->SetDisplayMode('fullpage');
		  //$mpdf->SetFooter('Page : {PAGENO}');
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
		if($mode=='pdf_grade'){
	    $report = $this->load->view('cetak/kred_grade', $data, TRUE);
		  $namaku = $this->m_umum->ambil_data('kol_working','id_working',$data['id']);
		  $arankerja = preg_replace('/[ .]+/', ' ', $namaku['nama_working']);
		  $jabatanku = $this->m_umum->ambil_data('jabatan','id_jabatan',$data['id2']);
		  $filename = 'kredensial-'.$arankerja."-".$jabatanku['nama_jabatan']."-print-date-".date('d-m-Y-H-i-s')."-instansi-grade.pdf";
//$mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'L','margin_left' => '5','margin_right' => '5','margin_top' => '5','margin_bottom' => '5']);
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->AddPage('L', '', '', '', 2, 5, 5, 5, 5, 3, 3);
		  $mpdf->SetDisplayMode('fullpage');
		  //$mpdf->SetFooter('Page : {PAGENO}');
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
		if($mode=='pdf_pendidikan'){
	    $report = $this->load->view('cetak/kred_pendidikan', $data, TRUE);
		  $namaku = $this->m_umum->ambil_data('kol_working','id_working',$data['id']);
		  $arankerja = preg_replace('/[ .]+/', ' ', $namaku['nama_working']);
		  $jabatanku = $this->m_umum->ambil_data('jabatan','id_jabatan',$data['id2']);
		  $filename = 'kredensial-'.$arankerja."-".$jabatanku['nama_jabatan']."-print-date-".date('d-m-Y-H-i-s')."-instansi-jabfung-pendidikan.pdf";
//$mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'L','margin_left' => '5','margin_right' => '5','margin_top' => '5','margin_bottom' => '5']);
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->AddPage('L', '', '', '', 2, 5, 5, 5, 5, 3, 3);
		  $mpdf->SetDisplayMode('fullpage');
		  //$mpdf->SetFooter('Page : {PAGENO}');
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
		if($mode=='pdf_jabfung'){
	    $report = $this->load->view('cetak/kred_jabfung', $data, TRUE);
		  $namaku = $this->m_umum->ambil_data('kol_working','id_working',$data['id']);
		  $arankerja = preg_replace('/[ .]+/', ' ', $namaku['nama_working']);
		  $jabatanku = $this->m_umum->ambil_data('jabatan','id_jabatan',$data['id2']);
		  $filename = 'kredensial-'.$arankerja."-".$jabatanku['nama_jabatan']."-print-date-".date('d-m-Y-H-i-s')."-instansi-jabfung-fungsional.pdf";
//$mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'L','margin_left' => '5','margin_right' => '5','margin_top' => '5','margin_bottom' => '5']);
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->AddPage('L', '', '', '', 2, 5, 5, 5, 5, 3, 3);
		  $mpdf->SetDisplayMode('fullpage');
		  //$mpdf->SetFooter('Page : {PAGENO}');
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
		if($mode=='pdf_pelatihan'){
	    $report = $this->load->view('cetak/kred_pelatihan', $data, TRUE);
		  $namaku = $this->m_umum->ambil_data('kol_working','id_working',$data['id']);
		  $arankerja = preg_replace('/[ .]+/', ' ', $namaku['nama_working']);
		  $jabatanku = $this->m_umum->ambil_data('jabatan','id_jabatan',$data['id2']);
		  $filename = 'kredensial-'.$arankerja."-".$jabatanku['nama_jabatan']."-print-date-".date('d-m-Y-H-i-s')."-instansi-jabfung-pelatihan.pdf";
//$mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'L','margin_left' => '5','margin_right' => '5','margin_top' => '5','margin_bottom' => '5']);
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->AddPage('L', '', '', '', 2, 5, 5, 5, 5, 3, 3);
		  $mpdf->SetDisplayMode('fullpage');
		  //$mpdf->SetFooter('Page : {PAGENO}');
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
		if($mode=='pdf_alamat'){
	    $report = $this->load->view('cetak/kred_alamat', $data, TRUE);
		  $namaku = $this->m_umum->ambil_data('kol_working','id_working',$data['id']);
		  $arankerja = preg_replace('/[ .]+/', ' ', $namaku['nama_working']);
		  $jabatanku = $this->m_umum->ambil_data('jabatan','id_jabatan',$data['id2']);
		  $filename = 'kredensial-'.$arankerja."-".$jabatanku['nama_jabatan']."-print-date-".date('d-m-Y-H-i-s')."-instansi-jabfung-alamat.pdf";
//$mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'L','margin_left' => '5','margin_right' => '5','margin_top' => '5','margin_bottom' => '5']);
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->AddPage('L', '', '', '', 2, 5, 5, 5, 5, 3, 3);
		  $mpdf->SetDisplayMode('fullpage');
		  //$mpdf->SetFooter('Page : {PAGENO}');
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
		if($mode=='pdf_surat_ijin_aktif'){
	    $report = $this->load->view('cetak/kred_aktif', $data, TRUE);
		  $namaku = $this->m_umum->ambil_data('kol_working','id_working',$data['id']);
		  $arankerja = preg_replace('/[ .]+/', ' ', $namaku['nama_working']);
		  $jabatanku = $this->m_umum->ambil_data('jabatan','id_jabatan',$data['id2']);
		  $filename = 'kredensial-'.$arankerja."-".$jabatanku['nama_jabatan']."-print-date-".date('d-m-Y-H-i-s')."-instansi-jabfung-aktif.pdf";
//$mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'L','margin_left' => '5','margin_right' => '5','margin_top' => '5','margin_bottom' => '5']);
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->AddPage('L', '', '', '', 2, 5, 5, 5, 5, 3, 3);
		  $mpdf->SetDisplayMode('fullpage');
		  //$mpdf->SetFooter('Page : {PAGENO}');
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
		if($mode=='pdf_surat_ijin_tenggang'){
	    $report = $this->load->view('cetak/kred_tenggang', $data, TRUE);
		  $namaku = $this->m_umum->ambil_data('kol_working','id_working',$data['id']);
		  $arankerja = preg_replace('/[ .]+/', ' ', $namaku['nama_working']);
		  $jabatanku = $this->m_umum->ambil_data('jabatan','id_jabatan',$data['id2']);
		  $filename = 'kredensial-'.$arankerja."-".$jabatanku['nama_jabatan']."-print-date-".date('d-m-Y-H-i-s')."-instansi-jabfung-tenggang.pdf";
//$mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'L','margin_left' => '5','margin_right' => '5','margin_top' => '5','margin_bottom' => '5']);
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->AddPage('L', '', '', '', 2, 5, 5, 5, 5, 3, 3);
		  $mpdf->SetDisplayMode('fullpage');
		  //$mpdf->SetFooter('Page : {PAGENO}');
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
		if($mode=='pdf_surat_ijin_expired'){
	    $report = $this->load->view('cetak/kred_expired', $data, TRUE);
		  $namaku = $this->m_umum->ambil_data('kol_working','id_working',$data['id']);
		  $arankerja = preg_replace('/[ .]+/', ' ', $namaku['nama_working']);
		  $jabatanku = $this->m_umum->ambil_data('jabatan','id_jabatan',$data['id2']);
		  $filename = 'kredensial-'.$arankerja."-".$jabatanku['nama_jabatan']."-print-date-".date('d-m-Y-H-i-s')."-instansi-jabfung-expired.pdf";
//$mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'L','margin_left' => '5','margin_right' => '5','margin_top' => '5','margin_bottom' => '5']);
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->AddPage('L', '', '', '', 2, 5, 5, 5, 5, 3, 3);
		  $mpdf->SetDisplayMode('fullpage');
		  //$mpdf->SetFooter('Page : {PAGENO}');
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
	}
   function kinerja_klinis($mode='lbulanan')
  {
	$data['page']  = "kinerja_klinis";
	$data['header'] = "KINERJA KLINIS";
	$data['title'] = "KINERJA KLINIS";
	//	$data['link_awal'] = base_url('admin_user');
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',10);
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
	$data['bulan'] = $this->uri->segment(4, 0);
	$data['tahun'] = $this->uri->segment(5, 0);
	$data['id_pegawai'] = $this->uri->segment(6, 0);
	$data['cmd_bentuk_laporan'] = $this->m_rancak->cmd_bentuk_laporan();
	$data['cmd_bulan'] = $this->m_rancak->cmd_bulan();
	$data['cmd_pegawai'] = $this->m_admin_user->ambil_data_dropdown_pegawai_no_null_instansi();
	if(empty($data['id_pegawai'])){
		$data['id_pegawai'] = '0';
	}
	$data['cmd_tahun_logbook'] = $this->m_admin_user->cmd_tahun_logbook($data['id_pegawai']);
	$action = $this->input->post('action');
	if($action == 'BtnProses') {
		$bulan = $this->input->post("bulan");
		$tahun = $this->input->post("tahun");
		$id_pegawai = $this->input->post("id_pegawai");
		redirect(base_url('admin_user/kinerja_klinis/lbulanan/'.$bulan.'/'.$tahun.'/'.$id_pegawai));
	}
    if($mode=='lbulanan'){
		$data['page'] =  $data['page']."_lbulanan";
		if(empty($data['pages'])){
			$data['pages'] = 'lbulanan';
		}
		$datekah1 = $this->m_rancak->validateDate($data['bulan']);
		$datekah2 = $this->m_rancak->validateDate($data['tahun']);
		if($datekah1 == false){
			$data['bulan'] = '01-'.date('m-Y');
		}
		if($datekah2 == false){
			$data['tahun'] = date('d-m-Y');
		}
		$data['ambil_range']   = $this->m_admin_user->ambil_range_logbook_bulanane($data['bulan'],$data['tahun'],$data['id_pegawai']);
		$this->tampil($data);
	}
  }
   function pengembangan_profesi($mode='view')
  {
	$data['page']  = "pengembangan_profesi";
	$data['title'] = "PENGEMBANGAN PROFESI";
	$data['header'] = "PENGEMBANGAN PROFESI";
		$data['link_awal'] = base_url('admin_user');
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',10);
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
	$data['first_date'] = $this->uri->segment(4, 0);
	$data['last_date'] = $this->uri->segment(5, 0);
	$data['id_pegawai'] = $this->uri->segment(6, 0);
	if(empty($data['first_date'])){
		$data['first_date'] = '01-'.date('m-Y');
	}
	if(empty($data['last_date'])){
		$data['last_date'] = date('d-m-Y');
	}
	if(empty($data['id_pegawai'])){
		$data['id_pegawai'] = '0';
	}
	$data['semuakah'] = array('0'=>'Range Tanggal','1'=>'Semua');
	$data['cmd_pegawai'] = $this->m_admin_user->ambil_data_dropdown_pegawai_no_null_instansi($this->session->mas_ins);
	$data['ambil_range'] = $this->m_admin_user->ambil_kategori_pelatihan($data['first_date'],$data['last_date'],$data['id_pegawai']);
    if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$first_date = $this->input->post("first_date");
			$last_date = $this->input->post("last_date");
			$id_pegawai = $this->input->post("id_pegawai");
			$range = $this->input->post("range");
			redirect(base_url('admin_user/pengembangan_profesi/view/'.$first_date.'/'.$last_date.'/'.$id_pegawai));
		}
	}
  }
   function etik($mode='view')
  {
	$data['page']  = "etik";
	$data['title'] = "ETIKA PROFESI";
	$data['header'] = "ETIKA PROFESI";
		$data['link_awal'] = base_url('admin_user');
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',10);
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
	$data['first_date'] = $this->uri->segment(4, 0);
	$data['last_date'] = $this->uri->segment(5, 0);
	$data['id_pegawai'] = $this->uri->segment(6, 0);
	if(empty($data['first_date'])){
		$data['first_date'] = '01-'.date('m-Y');
	}
	if(empty($data['last_date'])){
		$data['last_date'] = date('d-m-Y');
	}
	if(empty($data['id_pegawai'])){
		$data['id_pegawai'] = '0';
	}
	$data['semuakah'] = array('0'=>'Range Tanggal','1'=>'Semua');
	$data['cmd_pegawai'] = $this->m_admin_user->ambil_data_dropdown_pegawai_no_null_instansi($this->session->mas_ins);
	$data['ambil_range'] = $this->m_admin_user->ambil_etik($data['first_date'],$data['last_date'],$data['id_pegawai']);
    if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$first_date = $this->input->post("first_date");
			$last_date = $this->input->post("last_date");
			$id_pegawai = $this->input->post("id_pegawai");
			$range = $this->input->post("range");
			redirect(base_url('admin_user/etik/view/'.$first_date.'/'.$last_date.'/'.$id_pegawai));
		}
	}
  }
   function oppe($mode='view')
  {
	$data['page']  = "oppe";
	$data['title'] = "On going Professional Practise Evaluation";
	$data['header'] = "On going Professional Practise Evaluation";
		$data['link_awal'] = base_url('admin_user');
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',10);
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
	$data['first_date'] = $this->uri->segment(4, 0);
	$data['last_date'] = $this->uri->segment(5, 0);
	$data['id_pegawai'] = $this->uri->segment(6, 0);
	if(empty($data['first_date'])){
		$data['first_date'] = '01-'.date('m-Y');
	}
	if(empty($data['last_date'])){
		$data['last_date'] = date('d-m-Y');
	}
	if(empty($data['id_pegawai'])){
		$data['id_pegawai'] = '0';
	}
	$data['semuakah'] = array('0'=>'Range Tanggal','1'=>'Semua');
	$data['cmd_pegawai'] = $this->m_admin_user->ambil_data_dropdown_pegawai_no_null_instansi($this->session->mas_ins);
	$data['pelatihan'] = $this->m_admin_user->ambil_kategori_pelatihan($data['first_date'],$data['last_date'],$data['id_pegawai']);
	$data['etika'] = $this->m_admin_user->ambil_etik($data['first_date'],$data['last_date'],$data['id_pegawai']);
	$data['logbook']   = $this->m_admin_user->ambil_range_logbook_bulanane($data['first_date'],$data['last_date'],$data['id_pegawai']);
    if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$first_date = $this->input->post("first_date");
			$last_date = $this->input->post("last_date");
			$id_pegawai = $this->input->post("id_pegawai");
			$range = $this->input->post("range");
			redirect(base_url('admin_user/oppe/view/'.$first_date.'/'.$last_date.'/'.$id_pegawai));
		}
	}
  }
   function kinerja_unit($mode='view')
  {
	$data['page']  = "kinerja_unit";
	$data['header'] = "KINERJA KLINIS RUANGAN / UNIT";
	$data['title'] = "KINERJA KLINIS RUANGAN / UNIT";
		$data['link_awal'] = base_url('admin_user');
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',10);
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
	$data['first_date'] = $this->uri->segment(4, 0);
	$data['last_date'] = $this->uri->segment(5, 0);
	$action = $this->input->post('action');
	if($action == 'BtnProses') {
		$first_date = $this->input->post("first_date");
		$last_date = $this->input->post("last_date");
		redirect(base_url('admin_user/kinerja_unit/view/'.$first_date.'/'.$last_date.'/'.$id_pegawai));
	}
    if($mode=='view'){
		$datekah1 = $this->m_rancak->validateDate($data['first_date']);
		$datekah2 = $this->m_rancak->validateDate($data['last_date']);
		if($datekah1 == false){
			$data['first_date'] = '01-'.date('m-Y');
		}
		if($datekah2 == false){
			$data['last_date'] = date('d-m-Y');
		}
		$data['ambil_range']   = $this->m_admin_user->ambil_list_unit_kinerja();
		$this->tampil($data);
	}
  }
  function lihat($mode='view')
  {
		$data['page']  = "lihat";
		$data['header'] = "LAPORAN INDIKATOR MUTU";
		$data['title'] = "LAPORAN INDIKATOR MUTU";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
	//	$program = $this->m_umum->ambil_data('a_program','id_program','30');
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
		$data['id'] = $this->uri->segment(4, 0);
		$data['id2'] = $this->uri->segment(5, 0);
		$data['id3'] = $this->uri->segment(6, 0);
		$data['ambil_sn_standar_mutu'] = $this->m_admin_user->ambil_sn_standar_mutu();
		$data['cmd_jabatan'] = $this->m_rancak->cmd_jabatan();
	  $data['all_kah'] = array('0'=>'Range Tanggal','1'=>'Semua');
	  $data['kategori_kah'] = array('0'=>'Semua','1'=>'Sesuai Kategori');
    if($mode=='view'){
			if(empty($data['id'])){
				$data['id'] = '01-01'.date('Y');
			}
			if(empty($data['id2'])){
				$data['id2'] = date('d-m-Y');
			} 
			if(empty($data['id3'])){
				$data['id3'] = 0;
			} 
			$this->tampil($data);  
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$first_date = $this->input->post("id");
				$last_date = $this->input->post("id2");
				$id3 = $this->input->post("id3");
				redirect(base_url('admin_user/lihat/view/'.$first_date.'/'.$last_date.'/'.$id3));
			}
		}
    else if($mode=='data'){
/*			if(empty($data['id'])){
				$data['id'] = '01-'.date('m-Y');
			}
			if(empty($data['id2'])){
				$data['id2'] = date('d-m-Y');
			}    	*/
			echo json_encode($this->m_admin_user->laporan_all($data['id'],$data['id2'],$data['id3']));
		}
    else if($mode=='data2'){  	
			echo json_encode($this->m_admin_user->laporan_tabel_all($data['id'])); //barcode_laporan
		}
    else if($mode=='pie'){
			echo json_encode($this->m_admin_user->grafik_pie($data['id2']));
		}
    else if($mode=='pie_all'){
			echo json_encode($this->m_admin_user->grafik_pie_all($data['id2']));
		}
    else if($mode=='batang_range'){
			echo json_encode($this->m_admin_user->grafik_batang_range($data['id2']));
		}
  	else{
      if($mode=='profil'){
        $data['page'] =  $data['page']."_profil";
        $lptab = $this->m_umum->ambil_data('sn_laporan','barcode_laporan',$data['id']);
        $data['ambil_sn_laporan_tabel'] = $this->m_admin_user->ambil_sn_laporan_tabel($data['id']);
				$data['header_profil']  = set_value('header_profil',$lptab["header_profil"]);
				$data['sub_header_profil']  = set_value('sub_header_profil',$lptab["sub_header_profil"]);
				$data['sejarah']  = set_value('sejarah',$lptab["sejarah"]);
				$data['visi_misi']  = set_value('visi_misi',$lptab["visi_misi"]);		
				$data['tujuan_fungsi']  = set_value('tujuan_fungsi',$lptab["tujuan_fungsi"]);		
				$data['struktur_organisasi']  = set_value('struktur_organisasi',$lptab["struktur_organisasi"]);		
				$data['informasi_layanan']  = set_value('informasi_layanan',$lptab["informasi_layanan"]);		
				$data['regulasi']  = set_value('regulasi',$lptab["regulasi"]);			
        $this->tampil($data);
      }
      if($mode=='galeri'){
        $data['page'] =  $data['page']."_galeri";
        $lptab = $this->m_umum->ambil_data('sn_laporan','barcode_laporan',$data['id']);
        $data['ambil_sn_laporan_tabel'] = $this->m_admin_user->ambil_sn_laporan_tabel($data['id']);	
				$data['galeri_laporan']  = set_value('galeri_laporan',$lptab["galeri_laporan"]);		
        $this->tampil($data);
      }
      if($mode=='laporan'){
        $data['page'] =  $data['page']."_laporan";
        $lptab = $this->m_umum->ambil_data('sn_laporan','barcode_laporan',$data['id']);
        $data['ambil_sn_laporan_tabel'] = $this->m_admin_user->ambil_sn_laporan_tabel($data['id']);
				$data['header_laporan']  = set_value('header_laporan',$lptab["header_laporan"]);
				$data['header_laporan']  = set_value('header_laporan',$lptab["header_laporan"]);
				$data['sub_header_laporan']  = set_value('sub_header_laporan',$lptab["sub_header_laporan"]);
				$data['sub_sub_header_laporan']  = set_value('sub_sub_header_laporan',$lptab["sub_sub_header_laporan"]);
				$data['judul_laporan']  = set_value('judul_laporan',$lptab["judul_laporan"]);
				$data['dimensi_laporan']  = set_value('dimensi_laporan',$lptab["dimensi_laporan"]);		
				$data['tujuan_laporan']  = set_value('tujuan_laporan',$lptab["tujuan_laporan"]);		
				$data['definisi_laporan']  = set_value('definisi_laporan',$lptab["definisi_laporan"]);		
				$data['dasar_laporan']  = set_value('dasar_laporan',$lptab["dasar_laporan"]);		
				$data['frekuensi_laporan']  = set_value('frekuensi_laporan',$lptab["frekuensi_laporan"]);		
				$data['periode_laporan']  = set_value('periode_laporan',$lptab["periode_laporan"]);		
				$data['numerator_laporan']  = set_value('numerator_laporan',$lptab["numerator_laporan"]);		
				$data['denominator_laporan']  = set_value('denominator_laporan',$lptab["denominator_laporan"]);		
				$data['sumber_laporan']  = set_value('sumber_laporan',$lptab["sumber_laporan"]);		
				$data['standar_laporan']  = set_value('standar_laporan',$lptab["standar_laporan"]);		
				$data['teknis_laporan']  = set_value('teknis_laporan',$lptab["teknis_laporan"]);		
				$data['tgjawab_laporan']  = set_value('tgjawab_laporan',$lptab["tgjawab_laporan"]);		
				$data['jenis_laporan']  = set_value('jenis_laporan',$lptab["jenis_laporan"]);		
				$data['satuan_laporan']  = set_value('satuan_laporan',$lptab["satuan_laporan"]);		
				$data['kriteria_laporan']  = set_value('kriteria_laporan',$lptab["kriteria_laporan"]);		
				$data['formula_laporan']  = set_value('formula_laporan',$lptab["formula_laporan"]);		
				$data['metode_laporan']  = set_value('metode_laporan',$lptab["metode_laporan"]);		
				$data['instrumen_laporan']  = set_value('instrumen_laporan',$lptab["instrumen_laporan"]);		
				$data['sampel_laporan']  = set_value('sampel_laporan',$lptab["sampel_laporan"]);		
				$data['penyajian_laporan']  = set_value('penyajian_laporan',$lptab["penyajian_laporan"]);		
        $this->tampil($data);
      }
      if($mode=='tabel'){
        $data['page'] =  $data['page']."_tabel";
        $lptab = $this->m_admin_user->ambil_sn_laporan_detil($data['id2']);
				$data['max_tanggal'] = $this->m_admin_user->max_tanggal_lhu($data['id2']);
				$data['min_tanggal'] = $this->m_admin_user->min_tanggal_lhu($data['id2']);
        $data['jumlah_bulan'] = $this->m_rancak->hitung_jumlah_bulan($data['min_tanggal'],$data['max_tanggal']);
				$data['max_standar'] = round($this->m_admin_user->max_standar_mutu($data['id2'],3));
				$min_standar = round($this->m_admin_user->min_standar_mutu($data['id2'],3));
				$min_range = round($this->m_admin_user->min_range_mutu($data['id2'],3));
				$min_hasil = round($this->m_admin_user->min_hasil($data['id2'],3));
				if($min_range == 0){
					$data['min_standar'] = $min_hasil - 10;
				}else{
					$data['min_standar'] = $min_range;
				}
				$data['jumlah_record_tabel_limbah_detil'] = $this->m_admin_user->jumlah_record_tabel_limbah_detil($data['id2']);
				$data['jumlah_record_tps'] = $this->m_admin_user->jumlah_record_tps($data['id2']);
				$data['only_blnyear_lhu'] = $this->m_admin_user->only_blnyear_lhu($data['id2'],$data['min_tanggal'],$data['max_tanggal']);
				$data['tabel_limbah_detil'] = $this->m_admin_user->tabel_limbah_detil($data['id2']);
        $data['ambil_sn_laporan_tabel'] = $this->m_admin_user->ambil_sn_laporan_tabel($data['id']);
        $data['ambil_berkas_lhu'] = $this->m_admin_user->ambil_berkas_lhu($lptab["id_lhu"],$lptab["id_standar_mutu"],$lptab["tgl_awal"],$lptab["tgl_akhir"]);
        $data['count_berkas_lhu'] = $this->m_admin_user->count_berkas_lhu($lptab["id_lhu"],$lptab["id_standar_mutu"],$lptab["tgl_awal"],$lptab["tgl_akhir"]);
				$data['barcode_laporan_tabel']  = set_value('barcode_laporan_tabel',$lptab["barcode_laporan_tabel"]);
				$data['id_laporan_tabel']  = set_value('id_laporan_tabel',$lptab["id_laporan_tabel"]);
				$data['barcode_laporan']  = set_value('barcode_laporan',$lptab["barcode_laporan"]);
				$data['id_laporan']  = set_value('id_laporan',$lptab["id_laporan"]);		
				$data['judul_laporan_tabel']  = set_value('judul_laporan_tabel',$lptab["judul_laporan_tabel"]);		
				$data['analisa_laporan_tabel']  = set_value('analisa_laporan_tabel',$lptab["analisa_laporan_tabel"]);		
				$data['rekomendasi_laporan_tabel']  = set_value('rekomendasi_laporan_tabel',$lptab["rekomendasi_laporan_tabel"]);		
				$data['id_lhu']  = set_value('id_lhu',$lptab["id_lhu"]);		
				$data['id_sumber_emisi']  = set_value('id_sumber_emisi',$lptab["id_sumber_emisi"]);		
				$data['id_limbah']  = set_value('id_limbah',$lptab["id_limbah"]);		
				$data['urutan_laporan_tabel']  = set_value('urutan_laporan_tabel',$lptab["urutan_laporan_tabel"]);	
				$data['grafik']  = set_value('grafik',$lptab["tabel"]);	
				//-----------------------------------
				$data['grafik_garis_opsi'] = $this->m_admin_user->grafik_garis_opsi($data['id2']);
				$data['ambil_limbah_grafik'] = $this->m_admin_user->ambil_limbah_grafik_aza($data['id2']);
				$data['ambil_dt_limbah_grafik'] = $this->m_admin_user->ambil_dt_limbah_grafik($data['id2']);
				$data['grafik_batang_range'] = $this->m_admin_user->tabel_limbah_detil($data['id2']);
				$data['grafik_batang_range2'] = $this->m_admin_user->grafik_only_limbah($data['id2']);
				$data['grafik_batang_kelola'] = $this->m_admin_user->grafik_batang_kelola($data['id2']);
				$data['grafik_batang_range_jejer'] = $this->m_admin_user->grafik_batang_range_jejer($data['id2']);
        $this->tampil($data);
      }
		}
  }
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("admin_user/header",$data);
	$this->load->view("admin_user/isi");
	$this->load->view("footer");
	$this->load->view("admin_user/jsload");
	$this->load->view("admin_user/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_topol",$data);
	$this->load->view("admin_user/isi");
	$this->load->view("footer");
	$this->load->view("admin_user/jsload");
	$this->load->view("admin_user/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
