<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');
// ALTER TABLE `ol_user` ADD `status_asesor` TINYINT UNSIGNED NOT NULL DEFAULT '0' AFTER `status_user`;
class Instansi_user extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
          $this->load->model('m_ol_rancak');
          $this->load->model('m_admin_kredensial');
          $this->load->model('m_instansi_user');
          $this->load->model('m_admin_user');
          $this->load->model('m_anjababk');
          $this->load->model('m_auth');
          $this->m_auth->login_kah();
  }
	function index(){
		$this->data_user();
	}
	function data_user($mode='view'){
		$data['page']="data_user"; 
		$data['header'] = "DATA USER";
		$data['title'] = "DATA USER";
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
				redirect(base_url('instansi_user/data_user/view/'.$key));
			}
		}
    else if($mode=='data'){
			$key = urldecode(trim($this->uri->segment(4, 0)));
			$key = strtolower($key);
			$key = preg_replace('/[^A-Za-z0-9\-]/', '', $key);
			$key = str_replace(' ', '-', $key);
			echo json_encode($this->m_instansi_user->user_all($key));
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
				redirect(base_url('instansi_user/data_user'));
			}else{
			  if($this->m_instansi_user->reset_password($data['key'])){
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
					$ambil_peg = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$this->session->id_pegawai);
					if(!empty($ambil_peg['token_pegawai'])){
						$token = $ambil_peg['token_pegawai'];
					}else{
						$token = $wagw['token'];
					}
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
  				redirect(base_url('instansi_user/data_user'));
			  }else{
					$this->session->set_flashdata('danger', 'Masalah Edit Data');
					redirect(base_url('instansi_user/data_user'));
			  }
			}
		}
			if($mode=='asesor'){
			  $data['page'] =  $data['page']."_asesor";	
				$data['komite'] = $this->m_rancak->ambil_kol_komite_null();		
				$take = $this->m_umum->ambil_data('ol_user','id_user',$data['key']);		
				$data['id_user']  = set_value('id_user',$take['id_user']);
				$data['status_asesor']  = set_value('status_asesor',$take['status_asesor']);
				$this->load->view("instansi_user/isi",$data);
			}
			if($mode=='simpan_asesor'){
				if($this->m_instansi_user->simpan_status_asesor()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('instansi_user/data_user'));
				}else{
					$this->session->set_flashdata('danger', 'Kompetensi Sudah Selesai');
					redirect(base_url('instansi_user/data_user'));
				}
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
				$this->load->view("instansi_user/isi",$data);
			}
			if($mode=='simpan_unit'){
				$id_pegawai = $this->input->post('id_pegawai');
				$kondisi_unit = array('id_pegawai'=>$id_pegawai);
				$jml = $this->m_umum->jumlah_record_filter('ol_pegawai_unit',$kondisi_unit);
				if($jml == 0){
					if($this->m_instansi_user->simpan_pegawai_unit()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('instansi_user/data_user'));
					}else{
						$this->session->set_flashdata('danger', 'Kompetensi Sudah Selesai');
						redirect(base_url('instansi_user/data_user'));
					}
				}else{
					if($this->m_instansi_user->edit_pegawai_unit()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('instansi_user/data_user'));
					}else{
						$this->session->set_flashdata('danger', 'Kompetensi Sudah Selesai');
						redirect(base_url('instansi_user/data_user'));
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
				$this->load->view("instansi_user/isi",$data);
			}
			if($mode=='simpan_grade'){
				if($this->m_instansi_user->simpan_grade()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('instansi_user/data_user'));
				}else{
					$this->session->set_flashdata('danger', 'Kompetensi Sudah Selesai');
					redirect(base_url('instansi_user/data_user'));
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
					$ambil_peg = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$this->session->id_pegawai);
					if(!empty($ambil_peg['token_pegawai'])){
						$token = $ambil_peg['token_pegawai'];
					}else{
						$token = $wagw['token'];
					}
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
					redirect(base_url('instansi_user/data_user'));
		}
		}
	}
  function other($mode='view')
  {
	$data['page']  = "other";
	$data['header'] = "DATA PENGIRIM LUAR";
	$data['title'] = "DATA PENGIRIM LUAR";
		$data['link_awal'] = base_url('instansi_user');
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
//		$program = $this->m_umum->ambil_data('a_program','id_program',10);
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
    if($mode=='view'){
		$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_instansi_user->srt_other_all());
	}
  else if($mode=='hapus_pegawai'){
  		$kondisi=array('id_pegawai'=>$data['id']);
  		$kondisi2=array('id_petugas'=>$data['id']);
  		$jml_berkas = $this->m_umum->jumlah_record_filter('berkas',$kondisi);
  		$jml_buket_pegawai = $this->m_umum->jumlah_record_filter('kr_buket_pegawai',$kondisi);
  		$jml_etik_pegawai = $this->m_umum->jumlah_record_filter('kr_etik_pegawai',$kondisi);
  		$jml_kewenangan_lulus = $this->m_umum->jumlah_record_filter('kr_kewenangan_lulus',$kondisi);
  		$jml_pengajuan = $this->m_umum->jumlah_record_filter('kr_pengajuan',$kondisi);
  		$jml_logbook = $this->m_umum->jumlah_record_filter('logbook',$kondisi);
  		$jml_abk = $this->m_umum->jumlah_record_filter('p_abk',$kondisi);
  		$jml_jadwal = $this->m_umum->jumlah_record_filter('pegawai_jadwal',$kondisi);
  		$jml_pemeriksaan = $this->m_umum->jumlah_record_filter('pemeriksaan',$kondisi);
  		$jml_pu = $this->m_umum->jumlah_record_filter('pendaftaran_unit',$kondisi2);
  		if($jml_berkas == 0){
        if($jml_buket_pegawai == 0){
          if($jml_etik_pegawai == 0){
            if($jml_kewenangan_lulus == 0){
              if($jml_pengajuan == 0){
                if($jml_logbook == 0){
                  if($jml_abk == 0){
                    if($jml_jadwal == 0){
                      if($jml_pemeriksaan == 0){
                        if($jml_pu == 0){
                            $this->m_admin_perawat->simpan_pegawai_del($data['id']);
                            $this->m_umum->hapus_data('user','id_pegawai',$data['id']);
                        		$this->m_umum->hapus_data('pegawai','id_pegawai',$data['id']);
                        		$this->m_umum->hapus_data('perawat_detil','id_pegawai',$data['id']);
                    		 }else{
                      			$this->session->set_flashdata('danger', 'Masih Ada Data di Pendaftaran');
                    		 }
                  		 }else{
                    			$this->session->set_flashdata('danger', 'Masih Ada Data di Pemeriksaan');
                  		 }
                		 }else{
                  			$this->session->set_flashdata('danger', 'Masih Ada Data di Jadwal');
                		 }
              		 }else{
                			$this->session->set_flashdata('danger', 'Masih Ada Data di ABK');
              		 }
            		 }else{
              			$this->session->set_flashdata('danger', 'Masih Ada Data di Logbook');
            		 }
          		 }else{
            			$this->session->set_flashdata('danger', 'Masih Ada Data di Pengajuan');
          		 }
        		 }else{
          			$this->session->set_flashdata('danger', 'Masih Ada Data di Kewenangan Lulus Pegawai');
        		 }
      		 }else{
        			$this->session->set_flashdata('danger', 'Masih Ada Data di Etik Pegawai');
      		 }
    		 }else{
      			$this->session->set_flashdata('danger', 'Masih Ada Data di Butir Kegiatan Pegawai');
    		 }
  		 }else{
    			$this->session->set_flashdata('danger', 'Masih Ada Data di Berkas');
  		 }
    	redirect(base_url('admin_perawat/user'));
  }
  else{
  		$data['cmd_status'] = $this->m_rancak->cmd_status();
  		$data['kol_provinsi'] = $this->m_instansi_user->cmd_kol_provinsi();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['nama_other']  = set_value('nama_other',$this->input->post('nama_other'));
				$data['email_other']  = set_value('email_other',$this->input->post('email_other'));
				$data['kontak_other']  = set_value('kontak_other',$this->input->post('kontak_other'));
				$data['alamat_other']  = set_value('alamat_other',$this->input->post('alamat_other'));
				$data['status_other']  = set_value('status_other',$this->input->post('status_other'));
				$data['id_prov']  = set_value('id_prov',$this->input->post('id_prov'));
				$data['id_kab']  = set_value('id_kab',$this->input->post('id_kab'));
				$data['kab']  = array('');
				$this->load->view("instansi_user/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($this->m_instansi_user->simpan_srt_other()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('instansi_user/other'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('instansi_user/other'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('srt_other','id_other',$data['id']);
				$data['kab'] = $this->m_rancak->ambil_data_dropdown_kabs($keuangan['id_prov']);
				$data['id_prov']  = set_value('id_prov',$keuangan['id_prov']);
				$data['id_kab']  = set_value('id_kab',$keuangan['id_kab']);
				$data['nama_other']  = set_value('nama_other',$keuangan["nama_other"]);
				$data['email_other']  = set_value('email_other',$keuangan["email_other"]);
				$data['kontak_other']  = set_value('kontak_other',$keuangan["kontak_other"]);
				$data['alamat_other']  = set_value('alamat_other',$keuangan["alamat_other"]);
				$data['status_other']  = set_value('status_other',$keuangan["status_other"]);
				$this->load->view("instansi_user/isi",$data);
      }
      if($mode=='simpan_edit'){
				  if($this->m_instansi_user->edit_srt_other()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
						redirect(base_url('instansi_user/other'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
						redirect(base_url('instansi_user/other'));
				  }
      }
		}
  }
  function equipment($mode='view')
  {
		$data['page']  = "equipment";
		$data['header'] = "DATA PERALATAN RUMAH SAKIT";
		$data['title'] = "DATA PERALATAN RUMAH SAKIT";
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
		echo json_encode($this->m_instansi_user->equipment_all());
	}
	else{
		$data['cmd_status']=$this->m_rancak->cmd_status();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['nama_equipment']  = set_value('nama_equipment',$this->input->post('nama_equipment'));
				$data['status_equipment']  = set_value('status_equipment',$this->input->post('status_equipment'));
				$this->load->view("instansi_user/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($this->m_instansi_user->simpan_equipment()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('instansi_user/equipment'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('instansi_user/equipment'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('ol_equipment','id_equipment',$data['id']);
				$data['nama_equipment']  = set_value('nama_equipment',$keuangan["nama_equipment"]);
				$data['status_equipment']  = set_value('status_equipment',$keuangan["status_equipment"]);
				$this->load->view("instansi_user/isi",$data);
      }
      if($mode=='simpan_edit'){
			  if($this->m_instansi_user->edit_equipment()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
					redirect(base_url('instansi_user/equipment'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
					redirect(base_url('instansi_user/equipment'));
			  }

      }
		}
  }
  function pendidikan($mode='view')
  {
		$data['page']  = "pendidikan";
		$data['header'] = "PENDIDIKAN";
		$data['title'] = "PENDIDIKAN";
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
		echo json_encode($this->m_instansi_user->pendidikan_all());
	}
	else{
		$data['cmd_status']=$this->m_rancak->cmd_status();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['nama_pendidikan']  = set_value('nama_pendidikan',$this->input->post('nama_pendidikan'));
				$data['status_pendidikan']  = set_value('status_pendidikan',$this->input->post('status_pendidikan'));
				$this->load->view("instansi_user/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($this->m_instansi_user->simpan_pendidikan()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('instansi_user/pendidikan'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('instansi_user/pendidikan'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('kol_pendidikan','id_pendidikan',$data['id']);
				$data['nama_pendidikan']  = set_value('nama_pendidikan',$keuangan["nama_pendidikan"]);
				$data['status_pendidikan']  = set_value('status_pendidikan',$keuangan["status_pendidikan"]);
				$this->load->view("instansi_user/isi",$data);
      }
      if($mode=='simpan_edit'){
      	$id_pendidikan = $this->input->post('id_pendidikan');
		 		$kondisi=array('id_pendidikan'=>$id_pendidikan);
				$jml = $this->m_umum->jumlah_record_filter('ol_pegawai',$kondisi);
				if($jml == 0){
				  if($this->m_instansi_user->edit_pendidikan()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
						redirect(base_url('instansi_user/pendidikan'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
						redirect(base_url('instansi_user/pendidikan'));
				  }
				}else{
					$this->session->set_flashdata('danger', 'Data Sudah Masuk Profil');
					redirect(base_url('instansi_user/pendidikan'));					
				}

      }
		}
  }
  function unit($mode='view')
  {
		$data['page']  = "unit";
		$data['header'] = "DATA RUANGAN / UNIT";
		$data['title'] = "DATA RUANGAN / UNIT";
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
		echo json_encode($this->m_instansi_user->ol_unit_all());
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
				$this->load->view("instansi_user/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($this->m_instansi_user->simpan_ol_unit()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('instansi_user/unit'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('instansi_user/unit'));
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
				$this->load->view("instansi_user/isi",$data);
      }
      if($mode=='simpan_edit'){
				  if($this->m_instansi_user->edit_ol_unit()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
						redirect(base_url('instansi_user/unit'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
						redirect(base_url('instansi_user/unit'));
				  }
      }
		}
  }
  function bahan($mode='view')
  {
		$data['page']  = "bahan";
		$data['header'] = "DATA BAHAN HABIS PAKAI";
		$data['title'] = "DATA BAHAN HABIS PAKAI";
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
		echo json_encode($this->m_instansi_user->ol_bahan_all());
	}
	else{
		$data['cmd_status']=$this->m_rancak->cmd_status();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['nama_bahan']  = set_value('nama_bahan',$this->input->post('nama_bahan'));
				$data['status_bahan']  = set_value('status_bahan',$this->input->post('status_bahan'));
				$this->load->view("instansi_user/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($this->m_instansi_user->simpan_ol_bahan()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('instansi_user/bahan'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('instansi_user/bahan'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('ol_bahan','id_bahan',$data['id']);
				$data['id_bahan']  = set_value('id_bahan',$keuangan["id_bahan"]);
				$data['nama_bahan']  = set_value('nama_bahan',$keuangan["nama_bahan"]);
				$data['status_bahan']  = set_value('status_bahan',$keuangan["status_bahan"]);
				$this->load->view("instansi_user/isi",$data);
      }
      if($mode=='simpan_edit'){
				  if($this->m_instansi_user->edit_ol_bahan()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
						redirect(base_url('instansi_user/bahan'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
						redirect(base_url('instansi_user/bahan'));
				  }
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
		echo json_encode($this->m_instansi_user->berkas_kategori_all());
	}
  else if($mode=='hapus'){
  $kondisi=array('id_berkas_kategori'=>$data['id']);
  $jml = $this->m_umum->jumlah_record_filter('ol_berkas',$kondisi);
  if($jml == 0){
    $di = $this->m_umum->ambil_data('ol_berkas_kategori','id_berkas_kategori',$data['id']);
    $kunci = $di['kunci'];
    $unit_berkas = $di['unit'];
    if($unit_berkas !== 255 AND $kunci==25){
      if($this->m_umum->hapus_data('ol_berkas_kategori','id_berkas_kategori',$data['id'])){
      $this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
      redirect(base_url('instansi_user/berkas_kategori'));
      }else{
      $this->session->set_flashdata('danger', 'Masalah Hapus Data');
      redirect(base_url('instansi_user/berkas_kategori'));
      }
    }else{
      $this->session->set_flashdata('danger', 'Beda Permission');
      redirect(base_url('instansi_user/berkas_kategori'));
    }
  }else{
      $this->session->set_flashdata('danger', 'Data Sudah Masuk Alur');
      redirect(base_url('instansi_user/berkas_kategori'));
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
				$this->load->view("instansi_user/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($this->m_instansi_user->simpan_berkas_kategori($data['ruangan_id'])){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('instansi_user/berkas_kategori'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('instansi_user/berkas_kategori'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('ol_berkas_kategori','id_berkas_kategori',$data['id']);
				$data['nama_berkas_kategori']  = set_value('nama_berkas_kategori',$keuangan["nama_berkas_kategori"]);
				$data['status_berkas_kategori']  = set_value('status_berkas_kategori',$keuangan["status_berkas_kategori"]);
				$data['instansi_berkas_kategori']  = set_value('instansi_berkas_kategori',$keuangan["instansi_berkas_kategori"]);
				$this->load->view("instansi_user/isi",$data);
      }
      if($mode=='simpan_edit'){
				$id_berkas_kategori = $this->input->post('id_berkas_kategori');
		 		$kondisi=array('id_berkas_kategori'=>$id_berkas_kategori);
				$jml = $this->m_umum->jumlah_record_filter('ol_berkas',$kondisi);
				if($jml == 0){
					$di = $this->m_umum->ambil_data('ol_berkas_kategori','id_berkas_kategori',$id_berkas_kategori);
					$kunci = $di['kunci']; // kategori berkas yang boleh dihapus = 25 dan untuk penggolongan
					$unit_berkas = $di['unit'];
					if($unit_berkas !== 255 && $kunci == 25){
						  if($this->m_instansi_user->edit_berkas_kategori()){
								$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
								redirect(base_url('instansi_user/berkas_kategori'));
						  }else{
								$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
								redirect(base_url('instansi_user/berkas_kategori'));
						  }
					}
					else{
							$this->session->set_flashdata('danger', 'Beda Permission');
							redirect(base_url('instansi_user/berkas_kategori'));
					}
				}else{
						$this->session->set_flashdata('danger', 'Data Sudah masuk berkas');
						redirect(base_url('instansi_user/berkas_kategori'));
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
		echo json_encode($this->m_instansi_user->kategori_pelatihan_all());
	}
	else{
			$data['cmd_status']=$this->m_rancak->cmd_status();
			$data['working']=$this->m_admin_kredensial->ambil_data_rujukan_working();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['nama_kategori_pelatihan']  = set_value('nama_kategori_pelatihan',$this->input->post('nama_kategori_pelatihan'));
				$data['instansi_kategori_pelatihan']  = set_value('instansi_kategori_pelatihan',$this->input->post('instansi_kategori_pelatihan'));
				$data['status_kategori_pelatihan']  = set_value('status_kategori_pelatihan',$this->input->post('status_kategori_pelatihan'));
				$this->load->view("instansi_user/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($this->m_instansi_user->simpan_kategori_pelatihan()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('instansi_user/kategori_pelatihan'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('instansi_user/kategori_pelatihan'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('ol_kategori_pelatihan','id_kategori_pelatihan',$data['id']);
				$data['nama_kategori_pelatihan']  = set_value('nama_kategori_pelatihan',$keuangan["nama_kategori_pelatihan"]);
				$data['status_kategori_pelatihan']  = set_value('status_kategori_pelatihan',$keuangan["status_kategori_pelatihan"]);
				$data['instansi_kategori_pelatihan']  = set_value('instansi_kategori_pelatihan',$keuangan["instansi_kategori_pelatihan"]);
				$data['pembuat_kategori_pelatihan']  = set_value('pembuat_kategori_pelatihan',$keuangan["pembuat_kategori_pelatihan"]);
				$this->load->view("instansi_user/isi",$data);
      }
      if($mode=='simpan_edit'){
				$id_kategori_pelatihan = $this->input->post('id_kategori_pelatihan');
				$pembuat_kategori_pelatihan = $this->input->post('pembuat_kategori_pelatihan');
				$kondisi=array('id_kategori_pelatihan'=>$id_kategori_pelatihan);
				$jml = $this->m_umum->jumlah_record_filter('ol_berkas',$kondisi);
				if($jml == 0){
					if($pembuat_kategori_pelatihan == $this->session->id_pegawai){
					  if($this->m_instansi_user->edit_kategori_pelatihan()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('instansi_user/kategori_pelatihan'));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('instansi_user/kategori_pelatihan'));
					  }
					}else{
						$this->session->set_flashdata('danger', 'Bukan Pembuat Data');
						redirect(base_url('instansi_user/kategori_pelatihan'));
					}
				}
				else{
						$this->session->set_flashdata('danger', 'Data Sudah Dipakai profil');
						redirect(base_url('instansi_user/kategori_pelatihan'));
				}
      }
		}
  }
  function struktur_jabatan($mode='view')
  {
		$data['page']  = "struktur_jabatan";
		$data['header'] = "DATA STRUKTUR JABATAN KORESPONDENSI / SURAT MENYURAT";
		$data['title'] = "DATA STRUKTUR JABATAN KORESPONDENSI / SURAT MENYURAT";
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
		echo json_encode($this->m_instansi_user->srt_struktur_jabatan_all());
	}
	else{
		$data['cmd_status']=$this->m_rancak->cmd_status();
		$data['ambil_data_working'] = $this->m_ol_rancak->ambil_data_rujukan_kab_working($this->session->mas_ins);
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['nama_struktur_jabatan']  = set_value('nama_struktur_jabatan',$this->input->post('nama_struktur_jabatan'));
				$data['id_instansi']  = set_value('id_instansi',$this->input->post('id_instansi'));
				$data['status_struktur_jabatan']  = set_value('status_struktur_jabatan',$this->input->post('status_struktur_jabatan'));
				$this->load->view("instansi_user/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($this->m_instansi_user->simpan_srt_struktur_jabatan()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('instansi_user/struktur_jabatan'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('instansi_user/struktur_jabatan'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('srt_struktur_jabatan','id_struktur_jabatan',$data['id']);
				$data['id_struktur_jabatan']  = set_value('id_struktur_jabatan',$keuangan["id_struktur_jabatan"]);
				$data['nama_struktur_jabatan']  = set_value('nama_struktur_jabatan',$keuangan["nama_struktur_jabatan"]);
				$data['id_instansi']  = set_value('id_instansi',$keuangan["id_instansi"]);
				$data['status_struktur_jabatan']  = set_value('status_struktur_jabatan',$keuangan["status_struktur_jabatan"]);
				$this->load->view("instansi_user/isi",$data);
      }
      if($mode=='simpan_edit'){
				  if($this->m_instansi_user->edit_srt_struktur_jabatan()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
						redirect(base_url('instansi_user/struktur_jabatan'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
						redirect(base_url('instansi_user/struktur_jabatan'));
				  }
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
		$data['photo'] = $pegawai["foto"];
		$data['id']   = $this->uri->segment(4, 0);
	//======================= IMPORTANT ======================================
    if($mode=='view'){
	$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_instansi_user->srt_kategori_surat_all());
	}
	else{
		$data['cmd_status']=$this->m_rancak->cmd_status();
		$data['ambil_data_working'] = $this->m_ol_rancak->ambil_data_rujukan_kab_working($this->session->mas_ins);
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['nama_kategori_surat']  = set_value('nama_kategori_surat',$this->input->post('nama_kategori_surat'));
				$data['id_instansi']  = set_value('id_instansi',$this->input->post('id_instansi'));
				$data['status_kategori_surat']  = set_value('status_kategori_surat',$this->input->post('status_kategori_surat'));
				$this->load->view("instansi_user/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($this->m_instansi_user->simpan_srt_kategori_surat()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('instansi_user/kategori_surat'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('instansi_user/kategori_surat'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('srt_kategori_surat','id_kategori_surat',$data['id']);
				$data['id_kategori_surat']  = set_value('id_kategori_surat',$keuangan["id_kategori_surat"]);
				$data['nama_kategori_surat']  = set_value('nama_kategori_surat',$keuangan["nama_kategori_surat"]);
				$data['id_instansi']  = set_value('id_instansi',$keuangan["id_instansi"]);
				$data['status_kategori_surat']  = set_value('status_kategori_surat',$keuangan["status_kategori_surat"]);
				$this->load->view("instansi_user/isi",$data);
      }
      if($mode=='simpan_edit'){
				  if($this->m_instansi_user->edit_srt_kategori_surat()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
						redirect(base_url('instansi_user/kategori_surat'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
						redirect(base_url('instansi_user/kategori_surat'));
				  }
      }
		}
  }
  function kategori($mode='view')
  {
		$data['page']  = "kategori";
		$data['header'] = "KATEGORI GOLONGAN PEMERIKSAAN";
		$data['title'] = "KATEGORI GOLONGAN PEMERIKSAAN";
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
		echo json_encode($this->m_instansi_user->golongan_pemeriksaan_all());
	}
	else{
		$data['cmd_status']=$this->m_rancak->cmd_status();
		$data['ambil_unit'] = $this->m_ol_rancak->ambil_data_unit_instansi_member();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['id_unit']  = set_value('id_unit',$this->input->post('id_unit'));
				$data['nama_golongan_pemeriksaan']  = set_value('nama_golongan_pemeriksaan',$this->input->post('nama_golongan_pemeriksaan'));
				$data['status_golongan_pemeriksaan']  = set_value('status_golongan_pemeriksaan',$this->input->post('status_golongan_pemeriksaan'));
				$this->load->view("instansi_user/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($this->m_instansi_user->simpan_kol_golongan_pemeriksaan()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('instansi_user/kategori'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('instansi_user/kategori'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('kol_golongan_pemeriksaan','id_golongan_pemeriksaan',$data['id']);
				$data['id_golongan_pemeriksaan']  = set_value('id_golongan_pemeriksaan',$keuangan["id_golongan_pemeriksaan"]);
				$data['id_unit']  = set_value('id_unit',$keuangan["id_unit"]);
				$data['nama_golongan_pemeriksaan']  = set_value('nama_golongan_pemeriksaan',$keuangan["nama_golongan_pemeriksaan"]);
				$data['status_golongan_pemeriksaan']  = set_value('status_golongan_pemeriksaan',$keuangan["status_golongan_pemeriksaan"]);
				$this->load->view("instansi_user/isi",$data);
      }
      if($mode=='simpan_edit'){
				  if($this->m_instansi_user->edit_kol_golongan_pemeriksaan()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
						redirect(base_url('instansi_user/kategori'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
						redirect(base_url('instansi_user/kategori'));
				  }
      }
		}
  }
  function tindakan($mode='view')
  {
		$data['page']  = "tindakan";
		$data['header'] = "DATA TINDAKAN / PEMERIKSAAN";
		$data['title'] = "DATA TINDAKAN / PEMERIKSAAN";
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
		echo json_encode($this->m_instansi_user->tindakan_all());
	}
	else{
		$data['cmd_status']=$this->m_rancak->cmd_status();
		$data['ambil_golongan'] = $this->m_ol_rancak->cmd_golongan_pemeriksaan();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['id_golongan_pemeriksaan']  = set_value('id_golongan_pemeriksaan',$this->input->post('id_golongan_pemeriksaan'));
				$data['nama_tindakan']  = set_value('nama_tindakan',$this->input->post('nama_tindakan'));
				$data['status_tindakan']  = set_value('status_tindakan',$this->input->post('status_tindakan'));
				$this->load->view("instansi_user/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($this->m_instansi_user->simpan_tindakan()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('instansi_user/tindakan'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('instansi_user/tindakan'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('tindakan','id_tindakan',$data['id']);
				$data['id_tindakan']  = set_value('id_tindakan',$keuangan["id_tindakan"]);
				$data['id_golongan_pemeriksaan']  = set_value('id_golongan_pemeriksaan',$keuangan["id_golongan_pemeriksaan"]);
				$data['nama_tindakan']  = set_value('nama_tindakan',$keuangan["nama_tindakan"]);
				$data['status_tindakan']  = set_value('status_tindakan',$keuangan["status_tindakan"]);
				$this->load->view("instansi_user/isi",$data);
      }
      if($mode=='simpan_edit'){
				  if($this->m_instansi_user->edit_tindakan()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
						redirect(base_url('instansi_user/tindakan'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
						redirect(base_url('instansi_user/tindakan'));
				  }
      }
		}
  }
  function kab_data($id)
  {
    $dt=$this->m_instansi_user->ambil_data_dropdown_kab($id);
    echo json_encode($dt);
  }
/*  function kab_data($id)
  {
    $dt=$this->m_rancak->ambil_data_dropdown_kab($id);
    echo json_encode($dt);
  }*/
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
  function pengirim($mode='view')
  {
	$data['page']  = "pengirim";
	$data['header'] = "DATA DOKTER";
	$data['title'] = "DATA DOKTER";
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
		echo json_encode($this->m_instansi_user->rujukan_all());
	}
	else{
		 	$data['kol_provinsi'] = $this->m_rancak->cmd_kol_provinsi();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		    $data['kab']=array("");
		    $data['kec']=array("");
		    $data['kel']=array("");
				$data['nama_rujukan_dokter']  = set_value('nama_rujukan_dokter',$this->input->post('nama_rujukan_dokter'));
				$data['alamat_rujukan_dokter']  = set_value('alamat_rujukan_dokter',$this->input->post('alamat_rujukan_dokter'));
				$data['email_rujukan_dokter']  = set_value('email_rujukan_dokter',$this->input->post('email_rujukan_dokter'));
				$data['kontak_rujukan_dokter']  = set_value('kontak_rujukan_dokter',$this->input->post('kontak_rujukan_dokter'));
				$data['id_prov']  = set_value('id_prov',$this->input->post('id_prov'));
	  		$data['id_kab']  = set_value('id_kab',$this->input->post('id_kab'));
	  		$data['id_kel']  = set_value('id_kel',$this->input->post('id_kel'));
	  		$data['id_kec']  = set_value('id_kec',$this->input->post('id_kec'));
				$this->load->view("instansi_user/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($this->m_instansi_user->simpan_rujukan_dokter()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('instansi_user/pengirim'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('instansi_user/pengirim'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('kol_rujukan_dokter','id_rujukan_dokter',$data['id']);
    		$data['kab'] = $this->m_ol_rancak->ambil_data_dropdown_kab($keuangan['id_prov']);
    		$data['kec'] = $this->m_ol_rancak->ambil_data_dropdown_kec($keuangan['id_kab']);
    		$data['kel'] = $this->m_ol_rancak->ambil_data_dropdown_kel($keuangan['id_kec']);
				$data['nama_rujukan_dokter']  = set_value('nama_rujukan_dokter',$keuangan["nama_rujukan_dokter"]);
				$data['id_rujukan_dokter']  = set_value('id_rujukan_dokter',$keuangan["id_rujukan_dokter"]);
				$data['alamat_rujukan_dokter']  = set_value('alamat_rujukan_dokter',$keuangan["alamat_rujukan_dokter"]);
				$data['email_rujukan_dokter']  = set_value('email_rujukan_dokter',$keuangan["email_rujukan_dokter"]);
				$data['kontak_rujukan_dokter']  = set_value('kontak_rujukan_dokter',$keuangan["kontak_rujukan_dokter"]);
				$data['id_prov']  = set_value('id_prov',$keuangan["id_prov"]);
				$data['id_kab']  = set_value('id_kab',$keuangan["id_kab"]);
				$data['id_kel']  = set_value('id_kel',$keuangan["id_kel"]);
				$data['id_kec']  = set_value('id_kec',$keuangan["id_kec"]);
				$this->load->view("instansi_user/isi",$data);
      }
      if($mode=='simpan_edit'){
			  if($this->m_instansi_user->edit_rujukan_dokter()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
					redirect(base_url('instansi_user/pengirim'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
					redirect(base_url('instansi_user/pengirim'));
			  }
      }
	}
  }
	function demografi($mode='view'){
		$data['page']="demografi"; 
		$data['header'] = "DATA DEMOGRAFI PROFESI DI INSTANSI";
		$data['title'] = "DATA DEMOGRAFI PROFESI DI INSTANSI";
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
		$data['id2']   = $this->uri->segment(5, 0);
		//======================= IMPORTANT =========================================
			$data['working']=$this->m_admin_kredensial->ambil_data_rujukan_working();
			$data['jabatan']=$this->m_instansi_user->ambil_jabatan_from_pegawai();
	  if($mode=='view'){
			if(empty($data['id'])){
				$data['id'] = $this->session->refer;
			}
/*			if(empty($data['id2'])){
				$data['id2'] = $this->session->id_jabatan;
			}*/
			$kerjae = $this->m_umum->ambil_data('kol_working','id_working',$data['id']);
			$data['gawe_sekien'] = $kerjae['nama_working'];
			$fungsie = $this->m_umum->ambil_data('jabatan','id_jabatan',$data['id2']);
			if(empty($data['id2'])){
				$data['jab_sekien'] = 'Semua Profesi / Jabatan Fungsional';
			}else{
				$data['jab_sekien'] = $fungsie['nama_jabatan'];				
			}
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$id = $this->input->post("id");
				$id2 = $this->input->post("id2");
				redirect(base_url('instansi_user/demografi/view/'.$id.'/'.$id2));
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
		if($mode=='pdf_pelatihankhusus'){
	    $report = $this->load->view('cetak/kred_pelatihankhusus', $data, TRUE);
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
	function rs($mode='view'){
		$data['page']="rs"; 
		$data['header'] = "DEMOGRAFI RUANGAN DI INSTANSI";
		$data['title'] = "DEMOGRAFI RUANGAN DI INSTANSI";
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
		$data['id2']   = $this->uri->segment(5, 0);
		//======================= IMPORTANT =========================================
			$data['working']=$this->m_admin_kredensial->ambil_data_rujukan_working();
			$data['jabatan']=$this->m_instansi_user->ambil_jabatan_from_pegawai();
	  if($mode=='view'){
			if(empty($data['id'])){
				$data['id'] = $this->session->refer;
			}
/*			if(empty($data['id2'])){
				$data['id2'] = $this->session->id_jabatan;
			}*/
			$kerjae = $this->m_umum->ambil_data('kol_working','id_working',$data['id']);
			$data['gawe_sekien'] = $kerjae['nama_working'];
			$fungsie = $this->m_umum->ambil_data('jabatan','id_jabatan',$data['id2']);
			if(empty($data['id2'])){
				$data['jab_sekien'] = 'Semua Profesi / Jabatan Fungsional';
			}else{
				$data['jab_sekien'] = $fungsie['nama_jabatan'];				
			}
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$id = $this->input->post("id");
				$id2 = $this->input->post("id2");
				redirect(base_url('instansi_user/rs/view/'.$id.'/'.$id2));
			}
			$this->tampil_top($data);
		}
	}
   function kinerja_klinis($mode='lbulanan')
  {
	$data['page']  = "kinerja_klinis";
	$data['header'] = "KINERJA KLINIS";
	$data['title'] = "KINERJA KLINIS";
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
	$data['bulan'] = $this->uri->segment(4, 0);
	$data['tahun'] = $this->uri->segment(5, 0);
	$data['id_pegawai'] = $this->uri->segment(6, 0);
	$data['cmd_bentuk_laporan'] = $this->m_rancak->cmd_bentuk_laporan();
	$data['cmd_bulan'] = $this->m_rancak->cmd_bulan();
	$data['cmd_pegawai'] = $this->m_ol_rancak->ambil_data_dropdown_pegawai_no_null_instansi($this->session->mas_ins);
	if(empty($data['id_pegawai'])){
		$data['id_pegawai'] = '0';
	}
	$data['cmd_tahun_logbook'] = $this->m_instansi_user->cmd_tahun_logbook($data['id_pegawai']);
	$action = $this->input->post('action');
	if($action == 'BtnProses') {
		$bulan = $this->input->post("bulan");
		$tahun = $this->input->post("tahun");
		$id_pegawai = $this->input->post("id_pegawai");
		redirect(base_url('instansi_user/kinerja_klinis/lbulanan/'.$bulan.'/'.$tahun.'/'.$id_pegawai));
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
		$data['ambil_range']   = $this->m_instansi_user->ambil_range_logbook_bulanane($data['bulan'],$data['tahun'],$data['id_pegawai']);
		$this->tampil($data);
	}
  }
   function pengembangan_profesi($mode='view')
  {
	$data['page']  = "pengembangan_profesi";
	$data['title'] = "PENGEMBANGAN PROFESI";
	$data['header'] = "PENGEMBANGAN PROFESI";
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
	$data['cmd_pegawai'] = $this->m_ol_rancak->ambil_data_dropdown_pegawai_no_null_instansi($this->session->mas_ins);
	$data['ambil_range'] = $this->m_instansi_user->ambil_kategori_pelatihan($data['first_date'],$data['last_date'],$data['id_pegawai']);
    if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$first_date = $this->input->post("first_date");
			$last_date = $this->input->post("last_date");
			$id_pegawai = $this->input->post("id_pegawai");
			$range = $this->input->post("range");
			redirect(base_url('instansi_user/pengembangan_profesi/view/'.$first_date.'/'.$last_date.'/'.$id_pegawai));
		}
	}
  }
   function etik($mode='view')
  {
	$data['page']  = "etik";
	$data['title'] = "ETIKA PROFESI";
	$data['header'] = "ETIKA PROFESI";
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
	$data['cmd_pegawai'] = $this->m_ol_rancak->ambil_data_dropdown_pegawai_no_null_instansi($this->session->mas_ins);
	$data['ambil_range'] = $this->m_instansi_user->ambil_etik($data['first_date'],$data['last_date'],$data['id_pegawai']);
    if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$first_date = $this->input->post("first_date");
			$last_date = $this->input->post("last_date");
			$id_pegawai = $this->input->post("id_pegawai");
			$range = $this->input->post("range");
			redirect(base_url('instansi_user/etik/view/'.$first_date.'/'.$last_date.'/'.$id_pegawai));
		}
	}
  }
   function oppe($mode='view')
  {
	$data['page']  = "oppe";
	$data['title'] = "On going Professional Practise Evaluation";
	$data['header'] = "On going Professional Practise Evaluation";
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
	$data['cmd_pegawai'] = $this->m_ol_rancak->ambil_data_dropdown_pegawai_no_null_instansi($this->session->mas_ins);
	$data['pelatihan'] = $this->m_instansi_user->ambil_kategori_pelatihan($data['first_date'],$data['last_date'],$data['id_pegawai']);
	$data['etika'] = $this->m_instansi_user->ambil_etik($data['first_date'],$data['last_date'],$data['id_pegawai']);
	$data['logbook']   = $this->m_instansi_user->ambil_range_logbook_bulanane($data['first_date'],$data['last_date'],$data['id_pegawai']);
    if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$first_date = $this->input->post("first_date");
			$last_date = $this->input->post("last_date");
			$id_pegawai = $this->input->post("id_pegawai");
			$range = $this->input->post("range");
			redirect(base_url('instansi_user/oppe/view/'.$first_date.'/'.$last_date.'/'.$id_pegawai));
		}
	}
  }
   function kinerja_unit($mode='view')
  {
	$data['page']  = "kinerja_unit";
	$data['header'] = "KINERJA KLINIS RUANGAN / UNIT";
	$data['title'] = "KINERJA KLINIS RUANGAN / UNIT";
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
	$data['first_date'] = $this->uri->segment(4, 0);
	$data['last_date'] = $this->uri->segment(5, 0);
	$action = $this->input->post('action');
	if($action == 'BtnProses') {
		$first_date = $this->input->post("first_date");
		$last_date = $this->input->post("last_date");
		redirect(base_url('instansi_user/kinerja_unit/view/'.$first_date.'/'.$last_date.'/'.$id_pegawai));
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
		$data['ambil_range']   = $this->m_instansi_user->ambil_list_unit_kinerja();
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
		$data['ambil_sn_standar_mutu'] = $this->m_ol_rancak->ambil_user_instansi_user();
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
				redirect(base_url('instansi_user/lihat/view/'.$first_date.'/'.$last_date.'/'.$id3));
			}
		}
    else if($mode=='data'){
			echo json_encode($this->m_instansi_user->laporan_all($data['id'],$data['id2'],$data['id3']));
		}
    else if($mode=='tabels'){  	
			echo json_encode($this->m_instansi_user->laporan_tabel_all($data['id'])); //barcode_laporan
		}
  	else{
      if($mode=='tabel'){
        $data['page'] =  $data['page']."_tabel";		
        $this->tampil($data);
      }
		}
  }
  function informasi_jabatan($mode='view')
  {
		$data['page']  = "informasi_jabatan";
	$data['header'] = "ANALISA JABATAN DAN BEBAN KERJA";
	$data['title'] = "ANALISA JABATAN DAN BEBAN KERJA";
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
	$data['id2'] = $this->uri->segment(5, 0);
	if(empty($data['id'])){
		$data['id'] = date('Y');
	}
	$data['cmd_unit']=$this->m_ol_rancak->ambil_data_dropdown_unit_null($this->session->refer);
	$data['year_periode']=$this->m_rancak->year_periode_abk($this->session->unit);
    if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$id = $this->input->post("id");
			$id2 = $this->input->post("id2");
			redirect(base_url('instansi_user/informasi_jabatan/view/'.$id.'/'.$id2));
		}
	}
    else if($mode=='data'){
		echo json_encode($this->m_instansi_user->abk_all($data['id'],$data['id2']));
	}
	else{
		if($mode=='pdf_uraian'){
		  $report = $this->load->view('cetak/uraian_jabatan', $data, TRUE);
		  $filename = $data['header'].'-uraian-'.$data['id'].".pdf";
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
		  $mpdf->AddPage('P', '', '', '', 2, 5, 5, 5, 10, 3, 3);
		  $mpdf->SetDisplayMode('fullpage');
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->defaultheaderline = 0;
	      $mpdf->defaultfooterline = 0;
		  $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
			for ($i = 1; $i > 2; $i++) {
		  $mpdf->SetHTMLFooter('');
			}
		  //$mpdf->SetFooter('Page : {PAGENO}');
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
		if($mode=='pdf_abk'){
		  $report = $this->load->view('cetak/abk', $data, TRUE);
		  $filename = $data['header'].'-abk-'.$data['id'].".pdf";
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
		  $mpdf->AddPage('P', '', '', '', 2, 5, 5, 5, 10, 3, 3);
		  $mpdf->SetDisplayMode('fullpage');
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->defaultheaderline = 0;
	      $mpdf->defaultfooterline = 0;
		  $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
			for ($i = 1; $i > 2; $i++) {
		  $mpdf->SetHTMLFooter('');
			}
		  //$mpdf->SetFooter('Page : {PAGENO}');
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
		if($mode=='pdf_ketenagaan'){
			if(empty($data['id'])){ $data['id'] = date('Y'); }
		  $report = $this->load->view('cetak/pola_ketenagaan', $data, TRUE);
		  $filename = $data['header'].'-pola-ketenagaan-'.$data['id'].".pdf";
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-L']);
		  $mpdf->AddPage('L', '', '', '', 2, 5, 5, 5, 10, 3, 3);
		  $mpdf->SetDisplayMode('fullpage');
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->defaultheaderline = 0;
	      $mpdf->defaultfooterline = 0;
		  $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
			for ($i = 1; $i > 2; $i++) {
		  $mpdf->SetHTMLFooter('');
			}
		  //$mpdf->SetFooter('Page : {PAGENO}');
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
		if($mode=='pdf_evaluasi'){
			if(empty($data['id'])){ $data['id'] = date('Y'); }
		  $report = $this->load->view('cetak/evaluasi_perencanaan', $data, TRUE);
		  $filename = $data['header'].'-evaluasi-perencanaan-'.$data['id'].".pdf";
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-L']);
		  $mpdf->AddPage('L', '', '', '', 2, 5, 5, 5, 10, 3, 3);
		  $mpdf->SetDisplayMode('fullpage');
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->defaultheaderline = 0;
	      $mpdf->defaultfooterline = 0;
		  $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
			for ($i = 1; $i > 2; $i++) {
		  $mpdf->SetHTMLFooter('');
			}
		  //$mpdf->SetFooter('Page : {PAGENO}');
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
		}
  }
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("instansi_user/header",$data);
	$this->load->view("instansi_user/isi");
	$this->load->view("footer");
	$this->load->view("instansi_user/jsload");
	$this->load->view("instansi_user/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_topol",$data);
	$this->load->view("instansi_user/isi");
	$this->load->view("footer");
	$this->load->view("instansi_user/jsload");
	$this->load->view("instansi_user/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
