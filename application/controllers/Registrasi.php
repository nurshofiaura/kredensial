<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Registrasi extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
          $this->load->model('m_administrator');
  }
 // ================================================ USER ==================================
	function check_availability(){
		$username=$this->input->post('username');
		$username = strtolower($username);
		$username = str_replace(' ', '-', $username);
		$username = preg_replace('/[^A-Za-z0-9\-]/', '', $username);
		$kondisi=array('username'=>$username);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi);
		if($jml == 0){
			echo "<span style='color:green'> Username Tersedia.</span>";
		}else{
			echo "<span style='color:red'> Username Sudah Ada</span>";
		}
	}
  function check_nip(){
		$nip=$this->input->post('nip');
		$kondisi=array('nip'=>$nip);
		$jml = $this->m_umum->jumlah_record_filter('pegawai',$kondisi);
		if($jml == 0){
			echo "<span style='color:green'> NIP Tersedia.</span>";
		}else{
			echo "<span style='color:red'> NIP Sudah Ada</span>";
		}
	}
  function jabfung_data($id)
  {
    if($id == 3){
      $ids = '3';
    }else{
      $ids = '1';
    }
    $dt=$this->m_rancak->ambil_data_dropdown_jabfung_registrasi($ids);
    echo json_encode($dt);
  }
  function index($mode='view')
  {
	$data['page']  = "registrasi";
	$data['header'] = "REGISTRASI";
	$data['title'] = "REGISTRASI";
	$data['link_kembali'] = base_url();
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','1');
	$ologin = $this->m_umum->ambil_data('a_online','kode_online','sikas_registrasi');
	if($ologin['status_online'] == 0){
		redirect(base_url());
	}		
	$data['status_online'] = $ologin["status_online"];
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
	$data['pake_wa'] = $instansi["wa"];
	$data['cmd_tipe_pegawai'] = $this->m_rancak->cmd_tipe_pegawai();
	$data['cmd_jabfung'] = $this->m_rancak->cmd_jabfung();
	$data['status'] = $this->m_rancak->cmd_status();
	$data['gender'] = $this->m_rancak->cmd_jk();
	$data['cmd_ruangan'] = $this->m_rancak->cmd_ruangan();
	$data['cmd_unit_null'] = $this->m_rancak->struktur_jabatan_as_unit();
	$data['cmd_agama'] = $this->m_rancak->cmd_agama();
	$data['cmd_status_kawin'] = $this->m_rancak->cmd_status_kawin();
	$data['cmd_pendidikan'] = $this->m_rancak->cmd_pendidikan();
		$data['nama_pegawai']  = set_value('nama_pegawai',$this->input->post("nama_pegawai"));
		$data['tmp_lahir']  = set_value('tmp_lahir',$this->input->post("tmp_lahir"));
		$data['tgl_lahir']  = set_value('tgl_lahir',date('d-m-Y'));
		$data['id_status_kawin']  = set_value('id_status_kawin',$this->input->post("id_status_kawin"));
		$data['id_agama']  = set_value('id_agama',$this->input->post("id_agama"));
		$data['nip']  = set_value('nip',$this->input->post("nip"));
		$data['email']  = set_value('email',$this->input->post("email"));
		$data['username']  = set_value('username',$this->input->post("username"));
		$data['no_hp']  = set_value('no_hp',$this->input->post("no_hp"));
		$data['id_jabatan_fungsional']  = set_value('id_jabatan_fungsional',$this->input->post("id_jabatan_fungsional"));
		$data['id_ruangan']  = set_value('id_ruangan',$this->input->post("id_ruangan"));
		$data['jk']  = set_value('jk',$this->input->post("jk"));
		$data['id_pendidikan']  = set_value('id_pendidikan',$this->input->post("id_pendidikan"));
		$data['alamat']  = set_value('alamat',$this->input->post("alamat"));
		$data['tipe_pegawai']  = set_value('tipe_pegawai',$this->input->post("tipe_pegawai"));
		$this->form_validation->set_rules('nama_pegawai','nama_pegawai','required');
        if ($this->form_validation->run() === FALSE){
			$this->tampil($data);
        }else{
			$ptn = "/^0/";  // Regex
			$str = $this->input->post('no_hp'); //Your input, perhaps $_POST['textbox'] or whatever
			$rpltxt = "62";  // Replacement string
			$no_hp = preg_replace($ptn, $rpltxt, $str);
			$instance_name= $this->input->post('instance_name');
			$nip= trim($this->input->post('nip'));
			$id_jabatan_fungsional= $this->input->post('id_jabatan_fungsional');
			$username= $this->input->post('username');
			$username = strtolower($username);
			$username = str_replace(' ', '-', $username);
			$username = preg_replace('/[^A-Za-z0-9\-]/', '', $username);
			$kondisi=array('username'=>$username);
			$jml = $this->m_umum->jumlah_record_filter('user',$kondisi);
      $kondisi2=array('nip'=>$nip);
			$jml2 = $this->m_umum->jumlah_record_filter('pegawai',$kondisi2);
			if(empty($id_jabatan_fungsional) OR $id_jabatan_fungsional == 0){
        $this->session->set_flashdata('danger', 'Jabatan Fungsional Harus Diisi');
        redirect(base_url('registrasi'));
      }
      else{
      	$status_online = $this->input->post('status_online');
		    if($status_online == 0){
		    	$this->session->set_flashdata('sukses', 'Status Tidak Online');
		    	redirect(base_url());
	    	}else{      	
					if($jml == 0){
		  			if($jml2 == 0){
		          if($this->m_administrator->simpan_registrasi()){
		  				if($wa =='1'){
		  					$nip= $this->input->post('nip');
		  					$nik= $this->input->post('nik');
		  					$no_profesi= $this->input->post('no_profesi');
		  					$tmp_lahir= $this->input->post('tmp_lahir');
		  					$tgl_lahir= $this->input->post('tgl_lahir');
		  					$email= $this->input->post('email');
		  					$email= $this->input->post('email');
		  					$alamat= $this->input->post('alamat');
		  					$br = "\n";
		  					$message = "*".$instance_name."*";
		  					$message .= $br. $br."SELAMAT AKUN ANDA BERHASIL DI RUBAH";
		  					$message .= $br."📜 Data Anda";
		  					$message .= $br. "Nama : " . $nama_pegawai;
		  					$message .= $br. "TTL : " . $tmp_lahir. '/'.$tgl_lahir;
		  					$message .= $br. "No HP : " . $str;
		  					$message .= $br. "No Induk Pegawai : " . $nip;
		  					$message .= $br. "No KTP : " . $nik;
		  					$message .= $br. "No Profesi : " . $no_profesi;
		  					$message .= $br. "Pendidikan : " . $nama_pendidikan;
		  					$message .= $br. "Jabfung : " . $nama_jabatan_fungsional;
		  					$message .= $br. "Email : " . $email;
		  					$message .= $br. "Unit : " . $nama_unit;
		  					$message .= $br. "Ruangan : " . $nama_ruangan;
		  					$message .= $br. "Alamat : " . $alamat;
		  					$message .= $br. "Username : " . $username;
		  					$message .= $br. "Password (terisi jika ganti Password): " . $password;
		  					$this->m_umum->kirim_wageblast($message,$no_hp);
		  				//	$this->m_umum->kirim_wageblast($message,$no_hp);	// no kontak administrator
		  				}
		  		//		$this->session->set_flashdata('sukses', 'Registrasi Berhasil Silahkan Hubungi Administrator');
		  				redirect(base_url('data/sukses'));	
		  			  }else{
		  				$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
		  				redirect(base_url('registrasi'));
		  			  }
		        }else{
		          $this->session->set_flashdata('danger', 'NIP Sudah Ada');
							redirect(base_url('registrasi'));
		        }
					}
					else{
							$this->session->set_flashdata('danger', 'Username Sudah Ada');
							redirect(base_url('registrasi'));
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
	$this->load->view("registrasi/registrasi",$data);
}
// -----------------------------------------------------------END-----------------------------------------
}
