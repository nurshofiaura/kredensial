<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Aktifasi extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
		  $this->login_kah();
          $this->load->model('m_administrator');
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
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==16 )
          return TRUE;
     else
          redirect(base_url('logout'));
  }
  function index(){
    $this->aktifasi();
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
  function aktifasi($mode='view')
  {
	$data['page']  = "aktifasi";
	$data['header'] = "AKTIFASI";
	$data['title'] = "AKTIFASI";
	$data['link_kembali'] = base_url();
	$data['link_awal'] = base_url('aktifasi');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$program    = $this->m_umum->ambil_data('a_program','id_program',$pegawai["id_program"]);
	$data['program_unit'] = $program["unit"];
	$data['program_user_level'] = $program["user_level"];
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
	$data['member_name'] = $pegawai["nama_pegawai"];
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
    if($mode=='view'){
		$this->tampil_top($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_administrator->registrasi_all());
	}
  else{
	$data['cmd_tipe_pegawai'] = $this->m_rancak->cmd_tipe_pegawai();
	$data['cmd_jabfung'] = $this->m_rancak->cmd_jabfung();
	$data['status'] = $this->m_rancak->cmd_status();
	$data['gender'] = $this->m_rancak->cmd_jk();
	$data['cmd_ruangan'] = $this->m_rancak->cmd_ruangan();
	$data['cmd_unit_null'] = $this->m_rancak->struktur_jabatan_as_unit();
	$data['cmd_agama'] = $this->m_rancak->cmd_agama();
	$data['cmd_status_kawin'] = $this->m_rancak->cmd_status_kawin();
	$data['cmd_pendidikan'] = $this->m_rancak->cmd_pendidikan();
		$data['level'] = $this->m_rancak->cmd_level_program($data['program_user_level'],$data['level_id']);
      if($mode=='proses'){
        $data['page'] =  $data['page']."_proses";
    		$take = $this->m_administrator->ambil_registrasi($data['id']);
    		$data['nama_pegawai']  = set_value('nama_pegawai',$take['nama_pegawai']);
    		$data['email']  = set_value('email',$take['email']);
    		$data['username']  = set_value('username',$take['username']);
    		$data['id_level']  = set_value('id_level',$this->input->post("id_level"));
    		$data['no_hp']  = set_value('no_hp',$take['no_hp']);
    		$data['id_ruangan']  = set_value('id_ruangan',$take['id_ruangan']);
    		$data['jk']  = set_value('jk',$take['jk']);
    		$data['tmp_lahir']  = set_value('tmp_lahir',$take['tmp_lahir']);
    		$data['tgl_lahir']  = set_value('tgl_lahir',date('d-m-Y', strtotime($take['tgl_lahir'])));
    		$data['id_status_kawin']  = set_value('id_status_kawin',$take['id_status_kawin']);
    		$data['id_agama']  = set_value('id_agama',$take['id_agama']);
    		$data['id_pendidikan']  = set_value('id_pendidikan',$take['id_pendidikan']);
    		$data['id_jabatan_fungsional']  = set_value('id_jabatan_fungsional',$take['id_jabatan_fungsional']);
    		$data['alamat']  = set_value('alamat',$take['alamat']);
    		$data['nip']  = set_value('nip',$take['nip']);
    		$data['tipe_pegawai']  = set_value('tipe_pegawai',$take['tipe_pegawai']);
    		$this->form_validation->set_rules('nama_pegawai','nama_pegawai','required');
        if ($this->form_validation->run() === FALSE){
			$this->tampil_top($data);
        }else{
			$ptn = "/^0/";  // Regex
			$str = $this->input->post('no_hp'); //Your input, perhaps $_POST['textbox'] or whatever
			$rpltxt = "62";  // Replacement string
			$no_hp = preg_replace($ptn, $rpltxt, $str);
			$id_user= $this->session->id_user;
			$id_level= $this->input->post('id_level');
			$id_ruangan= $this->input->post('id_ruangan');
			$wa= $this->input->post('wa');
			$akses = $this->m_umum->ambil_data('user_level','id_level',$id_level);
			$unit = $this->m_umum->ambil_data('ruangan','id_ruangan',$id_ruangan);
			$nama_level= $akses['nama_level'];
			$nama_unit= $unit['nama_ruangan'];
			$nama_pegawai= $this->input->post('nama_pegawai');
			$instance_name= $this->input->post('instance_name');
			$nip= $this->input->post('nip');
      $nip = str_replace(' ', '', $nip);
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
        redirect(base_url('aktifasi'));
      }
      else{
			if($jml == 0){
  			if($jml2 == 0){
          if($Q = $this->m_administrator->simpan_aktifasi()){
  				$pesan = "TAMBAH AKUN NAMA : ".$nama_pegawai." , LEVEL : ".$nama_level." , PASSWORD : 7654321, USERNAME :
  				".$username." , UNIT : ".$nama_unit." , HP : ".$str;
  				$kode = $this->m_rancak->kode_generator(15,'');
  				$this->m_administrator->simpan_user($Q,$kode);
  				$this->m_umum->hapus_data('registrasi','id_registrasi',$data['id']);
  				if($wa =='1'){
  					$br = "\n";
  					$message = "*".$instance_name."*";
  					$message .= $br. $br."SELAMAT AKUN ANDA BERHASIL DI BUAT";
  					$message .= $br."📜 Data Anda";
  					$message .= $br. "Nama : " . $nama_pegawai;
  					$message .= $br. "No HP : " . $str;
  					$message .= $br. "Hak Akses : " . $nama_level;
  					$message .= $br. "Ruangan : " . $nama_unit;
  					$message .= $br. "username (terisi jika ganti username): " . $username;
  					$message .= $br. "Password (terisi jika ganti password): 7654321";
  					$this->m_umum->kirim_wageblast($message,$no_hp);
  				}
//  				$this->m_rancak->simpan_log_wa($no_hp,$id_user,$pesan);
  				$this->session->set_flashdata('sukses', 'Data berhasil Di Tambah');
  				redirect(base_url('aktifasi'));
  			  }else{
  				$this->session->set_flashdata('danger', 'Ada Masalah Edit Data');
  				redirect(base_url('aktifasi'));
  			  };
        }else{
          $this->session->set_flashdata('danger', 'NIP Sudah Ada');
          redirect(base_url('aktifasi'));
        }
			}
			else{
					$this->session->set_flashdata('danger', 'Username Sudah Ada');
					redirect(base_url('aktifasi'));
			}
    }
        }
      }
    else if($mode=='hapus'){
		  if($this->m_umum->hapus_data('registrasi','id_registrasi',$data['id'])){
			$this->session->set_flashdata('sukses', 'Data berhasil Di Hapus');
			redirect(base_url('aktifasi'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Hapus Data');
			redirect(base_url('aktifasi'));
		  }
    }
	}
  }
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("administrator/header",$data);
	$this->load->view("administrator/isi");
	$this->load->view("footer");
	$this->load->view("administrator/jsload");
	$this->load->view("administrator/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_top",$data);
	$this->load->view("administrator/isi");
	$this->load->view("footer");
	$this->load->view("administrator/jsload");
	$this->load->view("administrator/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
