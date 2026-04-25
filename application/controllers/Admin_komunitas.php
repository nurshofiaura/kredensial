<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');
// ALTER TABLE `ol_user` ADD `status_asesor` TINYINT UNSIGNED NOT NULL DEFAULT '0' AFTER `status_user`;
class Admin_komunitas extends CI_controller
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
		$data['link_awal'] = base_url('admin_komunitas');
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
				redirect(base_url('admin_komunitas/data_user/view/'.$key));
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
		if($mode=='reset'){
			$kondisi = array('id_user'=>$data['key']);
			$d = $this->m_umum->ambil_data_kondisi_2tabel_row('ol_user',$kondisi,'ol_pegawai','id_pegawai');
			$no_hp = $d['no_hp'];
			$id_pegawai = $d['id_pegawai'];
			$nama_pegawai = $d['nama_pegawai'];
			if($id_pegawai == 1){
				$this->session->set_flashdata('danger', 'Tidak dapat mereset Superadmin');
				redirect(base_url('admin_komunitas/data_user'));
			}else{
			  if($this->m_admin_user->reset_password($data['key'])){
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
					$message .= $br. "Status Akun : " . $expired;
					$message .= $br. "Username : " . $d['username'];
					$message .= $br. "Password : 7654321";
					$message .= $br. $br."SILAHKAN LOGIN : ";
					$message .= $br. $logine;
					$this->m_umum->kirim_fonte_text($token,$target,$message);
  				$this->session->set_flashdata('sukses', 'Password di Reset menjadi 7654321');
  				redirect(base_url('admin_komunitas/data_user'));
			  }else{
					$this->session->set_flashdata('danger', 'Masalah Edit Data');
					redirect(base_url('admin_komunitas/data_user'));
			  }
			}
		}
			if($mode=='asesor'){
			  $data['page'] =  $data['page']."_asesor";	
				$data['komite'] = $this->m_rancak->ambil_kol_komite_null();		
				$take = $this->m_umum->ambil_data('ol_user','id_user',$data['key']);		
				$data['id_user']  = set_value('id_user',$take['id_user']);
				$data['status_asesor']  = set_value('status_asesor',$take['status_asesor']);
				$this->load->view("admin_komunitas/isi",$data);
			}
			if($mode=='simpan_asesor'){
				if($this->m_admin_user->simpan_status_asesor()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('admin_komunitas/data_user'));
				}else{
					$this->session->set_flashdata('danger', 'Ada masalah simpan data');
					redirect(base_url('admin_komunitas/data_user'));
				}
			}
			if($mode=='grade'){
			  $data['page'] =  $data['page']."_grade";		
				$take = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$data['key']);	
				$jab = $this->m_umum->ambil_data('jabatan_fungsional','id_jabatan_fungsional',$take['id_jabatan_fungsional']);	
				$data['grade'] = $this->m_admin_kredensial->cmd_grade($jab['id_jabatan']);		
				$data['id_pegawai']  = set_value('id_pegawai',$take['id_pegawai']);
				$data['id_grade']  = set_value('id_grade',$take['id_grade']);
				$this->load->view("admin_komunitas/isi",$data);
			}
			if($mode=='simpan_grade'){
				if($this->m_admin_user->simpan_grade()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('admin_komunitas/data_user'));
				}else{
					$this->session->set_flashdata('danger', 'Kompetensi Sudah Selesai');
					redirect(base_url('admin_komunitas/data_user'));
				}
			}
			if($mode=='pengcab'){
			  $data['page'] =  $data['page']."_pengcab";	
				$data['pengcab'] = $this->m_rancak->ambil_srt_dpk_null();		
				$take = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$data['key']);		
				$data['id_pegawai']  = set_value('id_pegawai',$take['id_pegawai']);
				$data['id_pengcab']  = set_value('id_pengcab',$take['id_pengcab']);
				$this->load->view("admin_komunitas/isi",$data);
			}
			if($mode=='simpan_pengcab'){
				if($this->m_admin_user->simpan_status_pengcab()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('admin_komunitas/data_user'));
				}else{
					$this->session->set_flashdata('danger', 'Ada masalah simpan data');
					redirect(base_url('admin_komunitas/data_user'));
				}
			}
			if($mode=='pengurus'){
			  $data['page'] =  $data['page']."_pengurus";	
				$data['pengurus'] = $this->m_admin_user->ambil_data_ms_pengurus();		
				$take = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$data['key']);		
				$data['id_pegawai']  = set_value('id_pegawai',$take['id_pegawai']);
				$data['pengurus_pengcab']  = set_value('pengurus_pengcab',$take['pengurus_pengcab']);
				$this->load->view("admin_komunitas/isi",$data);
			}
			if($mode=='simpan_pengurus'){
				if($this->m_admin_user->simpan_pengurus_pengcab()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('admin_komunitas/data_user'));
				}else{
					$this->session->set_flashdata('danger', 'Ada masalah simpan data');
					redirect(base_url('admin_komunitas/data_user'));
				}
			}
			if($mode=='wa_asesor'){
					$kondisi = array('id_user'=>$data['key']);
					$d = $this->m_umum->ambil_data_kondisi_2tabel_row('ol_user',$kondisi,'ol_pegawai','id_pegawai');
					$pengurus = $this->m_umum->ambil_data('kol_ms_pengurus','id_ms_pengurus',$d['pengurus_pengcab']);
					$wagw = $this->m_umum->ambil_data('a_wageblast','id_wageblast',1);
					$bayar = $this->m_umum->ambil_data('aplikasi_bayar','id_konsumen',$d['id_pegawai']);
					$pengcab = $this->m_umum->ambil_data('ol_pengcab','id_pengcab',$d['id_pengcab']);
					if( $pengurus['id_ms_pengurus'] == 0){ $nama_ms_pengurus = 'Anggota'; }else{ $nama_ms_pengurus = $pengurus['nama_ms_pengurus']; }
					if( $pengcab['id_pengcab'] == 0){ $nama_pengcab = 'Belum Ada Komunitas'; }else{ $nama_pengcab = $pengcab['nama_pengcab']; }
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
					$message .= $br. "Pengurus : " . $nama_ms_pengurus;
					$message .= $br. "Komunitas : " . $nama_pengcab;
					$message .= $br. "Status Akun : " . $expired;
					$message .= $br. "Username : " . $d['username'];
					$message .= $br. $br."SILAHKAN LOGIN : ";
					$message .= $br. $logine;
					$this->m_umum->kirim_fonte_text($token,$target,$message);
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Kirim');
					redirect(base_url('admin_komunitas/data_user'));
			}
		}
	}
  function kategori_surat($mode='view')
  {
		$data['page']  = "kategori_surat";
		$data['header'] = "KATEGORI KORESPONDENSI / SURAT MENYURAT";
		$data['title'] = "KATEGORI KORESPONDENSI / SURAT MENYURAT";
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
		$data['level_name'] = $pegawai["nama_level"];			
		$data['photo'] = $pegawai["foto"];
		$data['id']   = $this->uri->segment(4, 0);
	//======================= IMPORTANT ======================================
    if($mode=='view'){
	$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_admin_user->srt_kategori_surat_all());
	}
	else{
		$data['cmd_status']=$this->m_rancak->cmd_status();
		$data['ambil_data_working'] = $this->m_ol_rancak->ambil_data_rujukan_kab_working($this->session->mas_ins);
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['nama_kategori_surat']  = set_value('nama_kategori_surat',$this->input->post('nama_kategori_surat'));
				$data['id_instansi']  = set_value('id_instansi',$this->input->post('id_instansi'));
				$data['status_kategori_surat']  = set_value('status_kategori_surat',$this->input->post('status_kategori_surat'));
				$this->load->view("admin_komunitas/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($this->m_admin_user->simpan_srt_kategori_surat()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('admin_komunitas/kategori_surat'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('admin_komunitas/kategori_surat'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('srt_kategori_surat','id_kategori_surat',$data['id']);
				$data['id_kategori_surat']  = set_value('id_kategori_surat',$keuangan["id_kategori_surat"]);
				$data['nama_kategori_surat']  = set_value('nama_kategori_surat',$keuangan["nama_kategori_surat"]);
				$data['id_instansi']  = set_value('id_instansi',$keuangan["id_instansi"]);
				$data['status_kategori_surat']  = set_value('status_kategori_surat',$keuangan["status_kategori_surat"]);
				$this->load->view("admin_komunitas/isi",$data);
      }
      if($mode=='simpan_edit'){
				  if($this->m_admin_user->edit_srt_kategori_surat()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
						redirect(base_url('admin_komunitas/kategori_surat'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
						redirect(base_url('admin_komunitas/kategori_surat'));
				  }
      }
		}
  }
	function demografi($mode='view'){
		$data['page']="demografi"; 
		$data['header'] = "DATA DEMOGRAFI PROFESI DI INSTANSI";
		$data['title'] = "DATA DEMOGRAFI PROFESI DI INSTANSI";
		$data['link_awal'] = base_url('admin_komunitas');
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
			$data['working']=$this->m_admin_user->ambil_data_pengcab();
	  if($mode=='view'){
			if(empty($data['id'])){
				$data['id'] = 0;
			}
			if(empty($data['id2'])){
				$data['id2'] = 0;
			}
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$id = $this->input->post("id");
				redirect(base_url('admin_komunitas/demografi/view/'.$id));
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
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("admin_komunitas/header",$data);
	$this->load->view("admin_komunitas/isi");
	$this->load->view("footer");
	$this->load->view("admin_komunitas/jsload");
	$this->load->view("admin_komunitas/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_topol",$data);
	$this->load->view("admin_komunitas/isi");
	$this->load->view("footer");
	$this->load->view("admin_komunitas/jsload");
	$this->load->view("admin_komunitas/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
