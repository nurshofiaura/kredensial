<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');
// ALTER TABLE `ol_user` ADD `status_asesor` TINYINT UNSIGNED NOT NULL DEFAULT '0' AFTER `status_user`;
class Admin_mhs extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
          $this->load->model('m_ol_rancak');
          $this->load->model('m_admin_kredensial');
          $this->load->model('m_admin_user');
          $this->load->model('m_auth');
          $this->m_auth->ol_enabled();
  }
	function index(){
		$this->data_user();
	}
	function data_user($mode='view'){
		$data['page']="data_user"; 
		$data['header'] = "DATA USER";
		$data['title'] = "DATA USER";
		$data['link_awal'] = base_url('admin_mhs');
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
				redirect(base_url('admin_mhs/data_user/view/'.$key));
			}
		}
    else if($mode=='data'){
			$key = urldecode(trim($this->uri->segment(4, 0)));
			$key = strtolower($key);
			$key = preg_replace('/[^A-Za-z0-9\-]/', '', $key);
			$key = str_replace(' ', '-', $key);
			echo json_encode($this->m_admin_user->mhs_all($key));
		}
		else{
		if($mode=='reset'){
			$kondisi = array('id_user'=>$data['key']);
			$d = $this->m_umum->ambil_data_kondisi_2tabel_row('ol_user',$kondisi,'ol_pegawai','id_pegawai');
			$no_hp = $d['no_hp'];
			$id_pegawai = $d['id_pegawai'];
			$nama_pegawai = $d['nama_pegawai'];
			if($id_pegawai == 1){
				$this->session->set_flashdata('danger', 'Tidak dapat mereset Superadmin');
				redirect(base_url('admin_mhs/data_user'));
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
  				redirect(base_url('admin_mhs/data_user'));
			  }else{
					$this->session->set_flashdata('danger', 'Masalah Edit Data');
					redirect(base_url('admin_mhs/data_user'));
			  }
			}
		}
			if($mode=='unit'){
			  $data['page'] =  $data['page']."_unit";	
				$data['unit'] = $this->m_admin_user->ambil_data_unit();
				$peg = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$data['idas']);	
				$kondisi_unit = array('barcode_pegawai'=>$data['id']);
				$jml = $this->m_umum->jumlah_record_filter('mhs_pegawai_unit',$kondisi_unit);
				$data['barcode_pegawai']  = set_value('barcode_pegawai',$peg['barcode_pegawai']);				
				if($jml == 0){
					$data['id_pegawai']  = set_value('id_pegawai',$this->input->post('id_pegawai'));
					$data['barcode_pegawai']  = set_value('barcode_pegawai',$this->input->post('barcode_pegawai'));
					$data['id_unit']  = set_value('id_unit',$this->input->post('id_unit'));
				}else{
					$take = $this->m_umum->ambil_data('mhs_pegawai_unit','barcode_pegawai',$data['id']);		
					$data['id_pegawai']  = set_value('id_pegawai',$data['idas']);
					$data['barcode_pegawai']  = set_value('barcode_pegawai',$data['id']);
					$data['id_unit']  = set_value('id_unit',$take['id_unit']);
				}
				$this->load->view("admin_mhs/isi",$data);
			}
			if($mode=='simpan_unit'){
				if($this->m_admin_user->nonaktif_mhs_unit()){
						$this->m_admin_user->simpan_mhs_unit();
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('admin_mhs/data_user'));
				}else{
						$this->session->set_flashdata('danger', 'Ada Masalah');
						redirect(base_url('admin_mhs/data_user'));
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
					redirect(base_url('admin_mhs/data_user'));
		}
		}
	}
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("admin_mhs/header",$data);
	$this->load->view("admin_mhs/isi");
	$this->load->view("footer");
	$this->load->view("admin_mhs/jsload");
	$this->load->view("admin_mhs/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_topol",$data);
	$this->load->view("admin_mhs/isi");
	$this->load->view("footer");
	$this->load->view("admin_mhs/jsload");
	$this->load->view("admin_mhs/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
