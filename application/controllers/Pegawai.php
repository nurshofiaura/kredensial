<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Pegawai extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
		  $this->login_kah();
          $this->load->model('m_profil');
          $this->load->model('m_berkas');
          $this->load->model('m_ol_rancak');
  }
  // ========================================================================
  function login_kah()
  {
      if ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==99 )
          return TRUE;
     else
          redirect(base_url('logout'));
  }
  // ========================================================================
	function index(){
		$data['page']="home";
		$data['header'] = "BERANDA";
		$data['title'] = "BERANDA";
		$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
		$program    = $this->m_umum->ambil_data('a_program','id_program','1');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','2');
		$data['instance_id'] = $instansi["id_instansi"];
		$data['instance_name'] = $instansi["nama_instansi"];
		$data['idescription'] = $instansi["description"];
		$data['ikeywords'] = $instansi["keywords"];
		$data['iheader'] = $instansi["header"];
		$data['iheader_mini'] = $instansi["header_mini"];
		$data['ifooter'] = $instansi["footer"];
		$data['ilicensed'] = $instansi["licensed"];
		$data['level_id'] = $pegawai["id_level"];
		$data['member_id'] = $pegawai["id_pegawai"];
		$data['room_name'] = $pegawai["nama_ruangan"];
		$data['jabatan_id'] = $pegawai["id_jabatan"];
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
		$data['jml_pengajuan']=$this->m_umum->jumlah_record_tabel('kr_pengajuan');
		$data['jml_user_kredensial']=$this->m_umum->jumlah_record_tabel('user');
		$data['jlm_profil']=$this->m_umum->jumlah_record_tabel('pegawai');
		$data['jml_logbook']=$this->m_umum->jumlah_record_tabel('logbook');
		$data['bln']= date('m');
		$data['thn']= date('Y');
		$data['ambil_pengumuman']   = $this->m_rancak->ambil_pengumuman($pegawai['id_jabatan'],$pegawai['id_level'],$program['jabatan']);
		$data['ambil_kol_golongan_pemeriksaan_graph'] = $this->m_rancak->ambil_kol_golongan_pemeriksaan_graph2($pegawai['id_pegawai']);
		$data['json'] = $this->m_profil->lh($data);
		$this->tampil($data);
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
    $jabatan = $this->session->id_jabatan;
    if($id == 3){
      $ids = '3';
    }else{
      $ids = '1';
    }
    $dt=$this->m_rancak->ambil_data_dropdown_jabfung_status_sesi($ids,$jabatan);
    echo json_encode($dt);
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
  function profil($mode='view')
  {
	$data['page']  = "profil";
	$data['header'] = "PROFIL USER";
	$data['title'] = "PROFIL USER";
	$data['link_kembali'] = base_url();
	$data['link_awal'] = base_url('pegawai');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','2');
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['room_name'] = $pegawai["nama_ruangan"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
	$data['pake_wa'] = $instansi["wa"];
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
	// =======================================================
	$data['kol_provinsi'] = $this->m_rancak->cmd_kol_provinsi();
	$data['cmd_tipe_pegawai'] = $this->m_rancak->cmd_tipe_pegawai();
	$data['cmd_jabfung'] = $this->m_profil->cmd_jabfung();
	$data['status'] = $this->m_rancak->cmd_status();
	$data['gender'] = $this->m_rancak->cmd_jk();
	$data['cmd_ruangan'] = $this->m_rancak->cmd_ruangan();
	$data['cmd_unit_null'] = $this->m_rancak->cmd_unit_null();
	$data['cmd_agama'] = $this->m_rancak->cmd_agama();
	$data['cmd_status_kawin'] = $this->m_rancak->cmd_status_kawin();
	$data['cmd_pendidikan'] = $this->m_rancak->cmd_pendidikan();
	$data['id_user']  = set_value('id_user',$pegawai['id_user']);
	$data['id_pegawai']  = set_value('id_pegawai',$pegawai['id_pegawai']);
	$data['nama_pegawai']  = set_value('nama_pegawai',$pegawai['nama_pegawai']);
	$data['email']  = set_value('email',$pegawai['email']);
	$data['username']  = set_value('username',$pegawai['username']);
	$data['username_lama']  = set_value('username_lama',$pegawai['username']);
	$data['password']  = set_value('password',$this->input->post("password"));
	$data['password_lama']  = set_value('password_lama',$pegawai['password']);
	$data['no_hp']  = set_value('no_hp',$pegawai['no_hp']);
	$data['id_unit']  = set_value('id_unit',$pegawai['id_unit']);
	$data['id_ruangan']  = set_value('id_ruangan',$pegawai['id_ruangan']);
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
	$data['id_prov']  = set_value('id_prov',$pegawai['id_prov']);
	$data['id_kab']  = set_value('id_kab',$pegawai['id_kab']);
	$data['id_kel']  = set_value('id_kel',$pegawai['id_kel']);
	$data['id_kec']  = set_value('id_kec',$pegawai['id_kec']);
	$data['id_pengcab']  = set_value('id_pengcab',$pegawai['id_pengcab']);
	$data['kab'] = $this->m_ol_rancak->ambil_data_dropdown_kab($pegawai['id_prov']);
	$data['kec'] = $this->m_ol_rancak->ambil_data_dropdown_kec($pegawai['id_kab']);
	$data['kel'] = $this->m_ol_rancak->ambil_data_dropdown_kel($pegawai['id_kec']);
	$tjabatan = $this->m_umum->ambil_data('jabatan_fungsional','id_jabatan_fungsional',$pegawai['id_jabatan_fungsional']);
	$data['null_pengcab'] = $this->m_ol_rancak->ambil_data_dropdown_pengcab($tjabatan['id_jabatan']);
	$data['tgl_lahir']  = set_value('tgl_lahir',date('d-m-Y', strtotime($pegawai['tgl_lahir'])));
	$this->form_validation->set_rules('nama_pegawai','nama_pegawai','required');
	if ($this->form_validation->run() === FALSE){
		$this->tampil($data);
	}else{
		$ptn = "/^0/";  // Regex
		$str = $this->input->post('no_hp'); //Your input, perhaps $_POST['textbox'] or whatever
		$rpltxt = "62";  // Replacement string
		$no_hp = preg_replace($ptn, $rpltxt, $str);
		$id_user= $this->session->id_user;
		$id_unit= $this->input->post('id_unit');
		$id_ruangan= $this->input->post('id_ruangan');
		$nip_lama= $this->input->post('nip_lama');
		$nip= $this->input->post('nip');
		$id_pendidikan= $this->input->post('id_pendidikan');
		$id_jabatan_fungsional= $this->input->post('id_jabatan_fungsional');
		$wa= $this->input->post('wa');
		$jabfung = $this->m_umum->ambil_data('jabatan_fungsional','id_jabatan_fungsional',$id_jabatan_fungsional);
		$unit = $this->m_umum->ambil_data('unit','id_unit',$id_unit);
		$ruangan = $this->m_umum->ambil_data('ruangan','id_ruangan',$id_ruangan);
		$pendidikan = $this->m_umum->ambil_data('kol_pendidikan','id_pendidikan',$id_pendidikan);
		$nama_pendidikan= $pendidikan['nama_pendidikan'];
		$nama_jabatan_fungsional= $jabfung['nama_jabatan_fungsional'];
		$nama_unit= $unit['nama_unit'];
		$nama_ruangan= $ruangan['nama_ruangan'];
		$nama_pegawai= $this->input->post('nama_pegawai');
		$instance_name= $this->input->post('instance_name');
		$username_lama = $this->input->post('username_lama');
		$password = $this->input->post('password');
		$username= $this->input->post('username');
		$username = strtolower($username);
		$username = str_replace(' ', '-', $username);
		$username = preg_replace('/[^A-Za-z0-9\-]/', '', $username);
		$kondisi=array('username'=>$username,'username !='=>$username_lama);
		$kondisi2=array('nip'=>$nip,'nip !='=>$nip_lama);
		$pesan = "EDIT AKUN NAMA : ".$nama_pegawai." , USERNAME : ".$username." ,
		UNIT : ".$nama_unit." , HP : ".$str;
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi);
		$jml2 = $this->m_umum->jumlah_record_filter('pegawai',$kondisi2);
		if($jml == 0){
  		if($jml2 == 0){
        $data = array();
  			$filesCount = count($_FILES['upload_Files']['name']);
  			$wa = $this->input->post('wa');
  			for($i = 0; $i < $filesCount; $i++){
  				$_FILES['upload_File']['name'] = $_FILES['upload_Files']['name'][$i];
  				$_FILES['upload_File']['type'] = $_FILES['upload_Files']['type'][$i];
  				$_FILES['upload_File']['tmp_name'] = $_FILES['upload_Files']['tmp_name'][$i];
  				$_FILES['upload_File']['error'] = $_FILES['upload_Files']['error'][$i];
  				$_FILES['upload_File']['size'] = $_FILES['upload_Files']['size'][$i];
  				$uploadPath = 'assets/foto/';
  				$config['upload_path'] = $uploadPath;
  				$config['allowed_types'] = 'gif|jpg|jpeg|png';
  				$config['encrypt_name'] = TRUE;
  				$this->load->library('upload', $config);
  				$this->upload->initialize($config);
  				if($this->upload->do_upload('upload_File')){
  					$id_pegawai = $this->input->post('id_pegawai');
  					$user_pic=$this->m_umum->ambil_data('pegawai','id_pegawai',$id_pegawai);
  					$cek_file=FCPATH.'assets/foto/'.$user_pic['foto'];
  					if(file_exists($cek_file)){
  						unlink(FCPATH."assets/foto/".$user_pic['foto']);
  					}
  					$fileData = $this->upload->data();
  					$this->m_profil->edit_pegawai($fileData['file_name']);
  				}else{
  					$this->m_profil->edit_pegawai_no_pic();
  				}
  				$this->m_profil->edit_user();
  				if($wa =='1'){
  					$nip= $this->input->post('nip');
  					$nik= $this->input->post('nik');
  					$no_hp= $this->input->post('no_hp');
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
  					$message .= $br. "No HP : " . $no_hp;
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
  				}
//  				$this->m_rancak->simpan_log_wa($no_hp,$id_user,$pesan);
  				$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
  				redirect(base_url('pegawai/profil'));
  			}
  		}else{
        $this->session->set_flashdata('danger', 'NIP Sudah Ada');
				redirect(base_url('pegawai/profil'));
      }
		}
		else{
				$this->session->set_flashdata('danger', 'Username Sudah Ada');
				redirect(base_url('pegawai/profil'));
		}
	}
  }
  function berkas($mode='view')
  {
	$data['page']  = "berkas";
	$data['header'] = "BERKAS UMUM";
	$data['title'] = "BERKAS UMUM";
	$data['link_kembali'] = base_url('pegawai');
	$data['link_awal'] = base_url('pegawai/berkas');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$program    = $this->m_umum->ambil_data('a_program','id_program',$pegawai["id_program"]);
	$data['program_unit'] = $program["unit"];
	$data['program_user_level'] = $program["user_level"];
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','2');
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['room_name'] = $pegawai["nama_ruangan"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
	$data['pake_wa'] = $instansi["wa"];
	$data['member_name'] = $pegawai["nama_pegawai"];
	$data['level_id'] = $pegawai["id_level"];
	$data['member_id'] = $pegawai["id_pegawai"];
	$data['room_id'] = $pegawai["id_ruangan"];
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
		$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_profil->berkas_pribadi_all($pegawai['id_pegawai']));
	}
    else if($mode=='hapus'){
		$this->db->select("COUNT(*) as num");
		$this->db->where('find_in_set("'.$data['id'].'", id_berkas) != 0');
		$this->db->or_where('find_in_set("'.$data['id'].'", id_ijasah) != 0');
		$this->db->or_where('find_in_set("'.$data['id'].'", id_str) != 0');
		$this->db->or_where('find_in_set("'.$data['id'].'", id_sertifikat) != 0');
		$q = $this->db->get('kr_pengajuan')->row();
		$jml = $q->num;
		if($jml == 0){
			$berkase=$this->m_umum->ambil_data('berkas','id_berkas',$data['id']);
			$cek_file=FCPATH.'assets/berkas/'.$berkase['link_berkas'];
			if(file_exists($cek_file)){
				unlink(FCPATH."assets/berkas/".$berkase['link_berkas']);
			}
			$this->m_umum->hapus_data('berkas','id_berkas',$data['id']);
			$this->session->set_flashdata('sukses', 'Berkas Sudah Di Hapus');
			redirect(base_url('pegawai/berkas'));
		}else{
			$this->session->set_flashdata('danger', 'Berkas Sudah Di Pakai Pengajuan');
			redirect(base_url('pegawai/berkas'));
		}
    }
  else{
		$data['ambil_kategori_berkas']=$this->m_rancak->ambil_kategori_berkas();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
    		$data['nama_berkas']  = set_value('nama_berkas',$this->input->post("nama_berkas"));
    		$data['id_kategori_berkas']  = set_value('id_kategori_berkas',$this->input->post("id_kategori_berkas"));
    		$data['no_berkas']  = set_value('no_berkas',$this->input->post("no_berkas"));
    		$this->form_validation->set_rules('nama_berkas','nama_berkas','required');
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
    					$fileData = $this->upload->data();
    					$this->m_profil->simpan_berkas_file($fileData['file_name']);
    					$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
    					redirect(base_url('pegawai/berkas'));
    				}else{
    					$this->session->set_flashdata('danger', 'Data Gagal Di Simpan');
    					redirect(base_url('pegawai/berkas'));
    				}
			   }
		  }
	  }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
    		$berkas = $this->m_umum->ambil_data('berkas','id_berkas',$data['id']);
    		$data['nama_berkas']  = set_value('nama_berkas',$berkas["nama_berkas"]);
    		$data['no_berkas']  = set_value('no_berkas',$berkas["no_berkas"]);
    		$data['id_kategori_berkas']  = set_value('id_kategori_berkas',$berkas["id_kategori_berkas"]);
    		$this->load->view("profil/isi",$data);
      }
      if($mode=='simpan_edit'){
  		  if($this->m_profil->edit_berkas_file()){
  			     $this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
  			     redirect(base_url('pegawai/berkas'));
  		  }else{
  			     $this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
  			     redirect(base_url('pegawai/berkas'));
  		  }
      }
	}
  }
  function ijasah($mode='view')
  {
	$data['page']  = "ijasah";
	$data['header'] = "BERKAS IJASAH";
	$data['title'] = "BERKAS IJASAH";
	$data['link_kembali'] = base_url('pegawai');
	$data['link_awal'] = base_url('pegawai/ijasah');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$program    = $this->m_umum->ambil_data('a_program','id_program',$pegawai["id_program"]);
	$data['program_unit'] = $program["unit"];
	$data['program_user_level'] = $program["user_level"];
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','2');
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['room_name'] = $pegawai["nama_ruangan"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
	$data['pake_wa'] = $instansi["wa"];
	$data['member_name'] = $pegawai["nama_pegawai"];
	$data['level_id'] = $pegawai["id_level"];
	$data['member_id'] = $pegawai["id_pegawai"];
	$data['room_id'] = $pegawai["id_ruangan"];
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
		$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_profil->ijasah_all($pegawai['id_pegawai']));
	}
    else if($mode=='hapus'){
		$this->db->select("COUNT(*) as num");
		$this->db->where('find_in_set("'.$data['id'].'", id_berkas) != 0');
		$this->db->or_where('find_in_set("'.$data['id'].'", id_ijasah) != 0');
		$this->db->or_where('find_in_set("'.$data['id'].'", id_str) != 0');
		$this->db->or_where('find_in_set("'.$data['id'].'", id_sertifikat) != 0');
		$q = $this->db->get('kr_pengajuan')->row();
		$jml = $q->num;
		if($jml == 0){
			$berkase=$this->m_umum->ambil_data('berkas','id_berkas',$data['id']);
			$cek_file=FCPATH.'assets/berkas/'.$berkase['link_berkas'];
			if(file_exists($cek_file)){
				unlink(FCPATH."assets/berkas/".$berkase['link_berkas']);
			}
			$this->m_umum->hapus_data('berkas','id_berkas',$data['id']);
			$this->session->set_flashdata('sukses', 'Berkas Sudah Di Hapus');
			redirect(base_url('pegawai/ijasah'));
		}else{
			$this->session->set_flashdata('danger', 'Berkas Sudah Di Pakai Pengajuan');
			redirect(base_url('pegawai/ijasah'));
		}
    }
  else{
		$data['cmd_pendidikan']=$this->m_rancak->cmd_pendidikan();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
    		$data['nama_berkas']  = set_value('nama_berkas',$this->input->post("nama_berkas"));
    		$data['id_pendidikan']  = set_value('id_pendidikan',$this->input->post("id_pendidikan"));
    		$data['no_berkas']  = set_value('no_berkas',$this->input->post("no_berkas"));
    		$data['tgl_b_berkas']  = set_value('tgl_b_berkas',date('d-m-Y'));
    		$this->form_validation->set_rules('nama_berkas','nama_berkas','required');
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
					$fileData = $this->upload->data();
					$this->m_profil->simpan_berkas_file_ijasah($fileData['file_name']);
					$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
					redirect(base_url('pegawai/ijasah'));
				}else{
					$this->session->set_flashdata('danger', 'Data Gagal Di Simpan');
					redirect(base_url('pegawai/ijasah'));
				}
			}
		}
	  }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
    		$berkas = $this->m_umum->ambil_data('berkas','id_berkas',$data['id']);
    		$data['nama_berkas']  = set_value('nama_berkas',$berkas["nama_berkas"]);
    		$data['tgl_b_berkas']  = set_value('tgl_b_berkas',date('d-m-Y', strtotime($berkas["tgl_b_berkas"])));
    		$data['no_berkas']  = set_value('no_berkas',$berkas["no_berkas"]);
    		$data['id_pendidikan']  = set_value('id_pendidikan',$berkas["id_pendidikan"]);
    		$this->load->view("profil/isi",$data);
      }
      if($mode=='simpan_edit'){
  		  if($this->m_profil->edit_berkas_ijasah()){
    			$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
    			redirect(base_url('pegawai/ijasah'));
  		  }else{
    			$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
    			redirect(base_url('pegawai/ijasah'));
  		  }
      }
	}
  }
  function pelatihan($mode='view')
  {
	$data['page']  = "pelatihan";
	$data['header'] = "BERKAS PELATIHAN UMUM / KHUSUS BAGI UNIT DAN JENJANG KARIR";
	$data['title'] = "BERKAS PELATIHAN UMUM / KHUSUS BAGI UNIT DAN JENJANG KARIR";
	$data['link_kembali'] = base_url('pegawai');
	$data['link_awal'] = base_url('pegawai/pelatihan');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$program    = $this->m_umum->ambil_data('a_program','id_program',$pegawai["id_program"]);
	$data['program_unit'] = $program["unit"];
	$data['program_user_level'] = $program["user_level"];
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','2');
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['room_name'] = $pegawai["nama_ruangan"];
	$data['iheader'] = $instansi["header"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
	$data['pake_wa'] = $instansi["wa"];
	$data['member_name'] = $pegawai["nama_pegawai"];
	$data['level_id'] = $pegawai["id_level"];
	$data['member_id'] = $pegawai["id_pegawai"];
	$data['room_id'] = $pegawai["id_ruangan"];
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
		$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_profil->pelatihan_all($pegawai['id_pegawai']));
	}
    else if($mode=='hapus'){
		$this->db->select("COUNT(*) as num");
		$this->db->where('find_in_set("'.$data['id'].'", id_berkas) != 0');
		$this->db->or_where('find_in_set("'.$data['id'].'", id_ijasah) != 0');
		$this->db->or_where('find_in_set("'.$data['id'].'", id_str) != 0');
		$this->db->or_where('find_in_set("'.$data['id'].'", id_sertifikat) != 0');
		$q = $this->db->get('kr_pengajuan')->row();
		$jml = $q->num;
		if($jml == 0){
			$berkase=$this->m_umum->ambil_data('berkas','id_berkas',$data['id']);
			$cek_file=FCPATH.'assets/berkas/'.$berkase['link_berkas'];
			if(file_exists($cek_file)){
				unlink(FCPATH."assets/berkas/".$berkase['link_berkas']);
			}
			$this->m_umum->hapus_data('berkas','id_berkas',$data['id']);
			$this->session->set_flashdata('sukses', 'Berkas Sudah Di Hapus');
			redirect(base_url('pegawai/pelatihan'));
		}else{
			$this->session->set_flashdata('danger', 'Berkas Sudah Di Pakai Pengajuan');
			redirect(base_url('pegawai/pelatihan'));
		}
    }
  else{
		$data['kategori_pelatihan']=$this->m_rancak->kategori_pelatihan();
		$data['ambil_kategori_berkas']=$this->m_rancak->ambil_kategori_berkas_pelatihan();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
    		$data['nama_berkas']  = set_value('nama_berkas',$this->input->post("nama_berkas"));
    		$data['id_kategori_pelatihan']  = set_value('id_kategori_pelatihan',$this->input->post("id_kategori_pelatihan"));
    		$data['id_kategori_berkas']  = set_value('id_kategori_berkas',$this->input->post("id_kategori_berkas"));
    		$data['no_sertifikat']  = set_value('no_sertifikat',$this->input->post("no_sertifikat"));
    		$data['kredit']  = set_value('kredit',$this->input->post("kredit"));
    		$data['penyelenggara']  = set_value('penyelenggara',$this->input->post("penyelenggara"));
    		$data['tgl_a_berkas']  = set_value('tgl_a_berkas',date('d-m-Y'));
    		$data['tgl_b_berkas']  = set_value('tgl_b_berkas',date('d-m-Y'));
    		$this->form_validation->set_rules('nama_berkas','nama_berkas','required');
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
    					$fileData = $this->upload->data();
    					$this->m_profil->simpan_berkas_file_pelatihan($fileData['file_name']);
    					$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
    					redirect(base_url('pegawai/pelatihan'));
    				}else{
    					$this->session->set_flashdata('danger', 'Data Gagal Di Simpan');
    					redirect(base_url('pegawai/pelatihan'));
    				}
    			   }
		      }
	  }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
		$berkas = $this->m_umum->ambil_data('berkas','id_berkas',$data['id']);
		$data['nama_berkas']  = set_value('nama_berkas',$berkas["nama_berkas"]);
		$data['tgl_a_berkas']  = set_value('tgl_a_berkas',date('d-m-Y', strtotime($berkas["tgl_a_berkas"])));
		$data['tgl_b_berkas']  = set_value('tgl_b_berkas',date('d-m-Y', strtotime($berkas["tgl_b_berkas"])));
		$data['penyelenggara']  = set_value('penyelenggara',$berkas["penyelenggara"]);
		$data['kredit']  = set_value('kredit',$berkas["kredit"]);
		$data['no_sertifikat']  = set_value('no_sertifikat',$berkas["no_sertifikat"]);
		$data['id_kategori_berkas']  = set_value('id_kategori_berkas',$berkas["id_kategori_berkas"]);
		$data['id_kategori_pelatihan']  = set_value('id_kategori_pelatihan',$berkas["id_kategori_pelatihan"]);
		$this->load->view("profil/isi",$data);
      }
      if($mode=='simpan_edit'){
		  if($this->m_profil->edit_berkas_pelatihan()){
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
			redirect(base_url('pegawai/pelatihan'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
			redirect(base_url('pegawai/pelatihan'));
		  }
      }
	}
  }
  function surat_ijin($mode='view')
  {
	$data['page']  = "surat_ijin";
	$data['header'] = "BERKAS SURAT IJIN";
	$data['title'] = "BERKAS SURAT IJIN";
	$data['link_kembali'] = base_url('pegawai');
	$data['link_awal'] = base_url('pegawai/surat_ijin');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai["id_program"]);
	$data['program_unit'] = $program["unit"];
	$data['program_user_level'] = $program["user_level"];
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','2');
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['room_name'] = $pegawai["nama_ruangan"];
	$data['iheader'] = $instansi["header"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
	$data['pake_wa'] = $instansi["wa"];
	$data['member_name'] = $pegawai["nama_pegawai"];
	$data['level_id'] = $pegawai["id_level"];
	$data['member_id'] = $pegawai["id_pegawai"];
	$data['room_id'] = $pegawai["id_ruangan"];
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
		$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_profil->str_all($pegawai['id_pegawai']));
	}
    else if($mode=='hapus'){
		$this->db->select("COUNT(*) as num");
		$this->db->where('find_in_set("'.$data['id'].'", id_berkas) != 0');
		$this->db->or_where('find_in_set("'.$data['id'].'", id_ijasah) != 0');
		$this->db->or_where('find_in_set("'.$data['id'].'", id_str) != 0');
		$this->db->or_where('find_in_set("'.$data['id'].'", id_sertifikat) != 0');
		$q = $this->db->get('kr_pengajuan')->row();
		$jml = $q->num;
		if($jml == 0){
			$berkase=$this->m_umum->ambil_data('berkas','id_berkas',$data['id']);
			$cek_file=FCPATH.'assets/berkas/'.$berkase['link_berkas'];
			if(file_exists($cek_file)){
				unlink(FCPATH."assets/berkas/".$berkase['link_berkas']);
			}
			$this->m_umum->hapus_data('berkas','id_berkas',$data['id']);
			$this->session->set_flashdata('sukses', 'Berkas Sudah Di Hapus');
			redirect(base_url('pegawai/surat_ijin'));
		}else{
			$this->session->set_flashdata('danger', 'Berkas Sudah Di Pakai Pengajuan');
			redirect(base_url('pegawai/surat_ijin'));
		}
    }
  else{
		$data['kategori_str_all']=$this->m_rancak->kategori_str_all();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
    		$data['nama_berkas']  = set_value('nama_berkas',$this->input->post("nama_berkas"));
    		$data['no_berkas']  = set_value('no_berkas',$this->input->post("no_berkas"));
    		$data['id_kategori_berkas']  = set_value('id_kategori_berkas',$this->input->post("id_kategori_berkas"));
    		$data['tgl_a_berkas']  = set_value('tgl_a_berkas',date('d-m-Y'));
    		$data['tgl_b_berkas']  = set_value('tgl_b_berkas',date('d-m-Y'));
    		$this->form_validation->set_rules('nama_berkas','nama_berkas','required');
        if ($this->form_validation->run() === FALSE){
			       $this->tampil($data);
        }else{
      			$id_kategori_berkas = $this->input->post('id_kategori_berkas');
      			$id_pegawai = $this->input->post('id_pegawai');
      			$kondisi=array('id_kategori_berkas'=>$id_kategori_berkas,'id_pegawai'=>$id_pegawai,'status_berkas'=>'1');
      			$jml = $this->m_umum->jumlah_record_filter('berkas',$kondisi);
      			if($jml == 0){
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
      						$fileData = $this->upload->data();
      						$this->m_profil->simpan_berkas_ijin($fileData['file_name']);
      						$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
      						redirect(base_url('pegawai/surat_ijin'));
      					}else{
      						$this->session->set_flashdata('danger', 'Data Gagal Di Simpan');
      						redirect(base_url('pegawai/surat_ijin'));
      					}
      				}
      			}
      			else{
      				$this->session->set_flashdata('danger', 'Berkas Sudah Di Ada, Silahkan Pilih Perpanjangan');
      				redirect(base_url('pegawai/surat_ijin'));
        		}
		       }
	  }
      if($mode=='perpanjangan'){
        $data['page'] =  $data['page']."_perpanjangan";
		$old = $this->m_umum->ambil_data('berkas','id_berkas',$data['id']);
		$data['id_kategori_berkas'] = set_value('id_kategori_berkas',$old['id_kategori_berkas']);
		$data['tgl_a_berkas'] = set_value('tgl_a_berkas',date('d-m-Y'));
		$data['tgl_b_berkas'] = set_value('tgl_b_berkas',date('d-m-Y'));
		$data['nama_berkas']  = set_value('nama_berkas',$this->input->post("nama_berkas"));
		$data['no_berkas']  = set_value('no_berkas',$this->input->post("no_berkas"));
		$this->form_validation->set_rules('nama_berkas','nama_berkas','required');
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
					$fileData = $this->upload->data();
					$this->m_profil->simpan_berkas_ijin($fileData['file_name']);
					$this->m_profil->perpanjangan_str();
					$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
					redirect(base_url('pegawai/surat_ijin'));
				}else{
					$this->session->set_flashdata('danger', 'Data Gagal Di Simpan');
					redirect(base_url('pegawai/surat_ijin'));
				}
			}
		}
	  }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
		$berkas = $this->m_umum->ambil_data('berkas','id_berkas',$data['id']);
		$data['nama_berkas']  = set_value('nama_berkas',$berkas["nama_berkas"]);
		$data['tgl_a_berkas']  = set_value('tgl_a_berkas',date('d-m-Y', strtotime($berkas["tgl_a_berkas"])));
		$data['tgl_b_berkas']  = set_value('tgl_b_berkas',date('d-m-Y', strtotime($berkas["tgl_b_berkas"])));
		$data['no_berkas']  = set_value('no_berkas',$berkas["no_berkas"]);
		$data['id_kategori_berkas']  = set_value('id_kategori_berkas',$berkas["id_kategori_berkas"]);
		$this->load->view("profil/isi",$data);
      }
      if($mode=='simpan_edit'){
		  if($this->m_profil->edit_berkas_ijin()){
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
			redirect(base_url('pegawai/surat_ijin'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
			redirect(base_url('pegawai/surat_ijin'));
		  }
      }
	}
  }
  function download($mode='view')
  {
	$data['page']  = "download";
	$data['header'] = "BERKAS DOWNLOAD";
	$data['title'] = "BERKAS DOWNLOAD";
	$data['link_kembali'] = base_url('pegawai');
	$data['link_awal'] = base_url('pegawai/download');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$program    = $this->m_umum->ambil_data('a_program','id_program',$pegawai["id_program"]);
	$data['program_unit'] = $program["unit"];
	$data['program_user_level'] = $program["user_level"];
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','2');
	$data['instance_id'] = $instansi["id_instansi"];
	$data['room_name'] = $pegawai["nama_ruangan"];
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
	$data['room_id'] = $pegawai["id_ruangan"];
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
		$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_profil->download_all($pegawai['id_jabatan'],$pegawai['id_level']));
	}
  }
  function logbook($mode='view')
  {
	$data['page']  = "logbook";
	$data['header'] = "LOGBOOK PEGAWAI";
	$data['title'] = "LOGBOOK PEGAWAI";
	$data['link_kembali'] = base_url('pegawai');
	$data['link_awal'] = base_url('pegawai/logbook');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$program    = $this->m_umum->ambil_data('a_program','id_program',$pegawai["id_program"]);
	$data['program_unit'] = $program["unit"];
	$data['program_user_level'] = $program["user_level"];
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','2');
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['room_name'] = $pegawai["nama_ruangan"];
	$data['iheader'] = $instansi["header"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
	$data['pake_wa'] = $instansi["wa"];
	$data['member_name'] = $pegawai["nama_pegawai"];
	$data['level_id'] = $pegawai["id_level"];
	$data['jabatan_id'] = $pegawai["id_jabatan"];
	$data['member_id'] = $pegawai["id_pegawai"];
	$data['room_id'] = $pegawai["id_ruangan"];
	$data['level_name'] = $pegawai["nama_level"];
	$data['photo'] = $pegawai["foto"];
	if($pegawai['id_jabatan'] == 4){
		$data['nama_pk'] = "BK";
	}else{
		$data['nama_pk'] = "PK";
	}
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
	$data['first_date'] = $this->uri->segment(4, 0);
	$data['last_date'] = $this->uri->segment(5, 0);
	$data['id'] = $this->uri->segment(6, 0);
	if(empty($data['first_date'])){
		$data['first_date'] = '01-'.date('m-Y');
	}
	if(empty($data['last_date'])){
		$data['last_date'] = date('d-m-Y');
	}
    if($mode=='view'){
		$this->tampil_top($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$first_date = $this->input->post("first_date");
			$last_date = $this->input->post("last_date");
			redirect(base_url('pegawai/logbook/view/'.$first_date.'/'.$last_date));
		}
	}
    else if($mode=='data'){
		echo json_encode($this->m_profil->logbook_all($data['first_date'],$data['last_date'],$data['member_id']));
	}
  else if($mode=='hapus'){
      $kondisi_mine=array('id_logbook'=>$data['id']);
  		$jml_mine=$this->m_umum->jumlah_record_filter('kr_pengajuan_logbook',$kondisi_mine);
  		if($jml_mine == 0){
        $idnya    = $this->m_umum->ambil_data('logbook','id_logbook',$data['id']);
    	  if($idnya['v_karu'] == 0 AND $idnya['v_kabid'] == 0 AND $idnya['v_asesor'] == 0 AND $idnya['v_komite'] == 0 AND $idnya['v_direktur'] == 0){
    		  if($this->m_umum->hapus_data('logbook','id_logbook',$data['id']) ){
            $this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
      			redirect(base_url('pegawai/logbook/view/'.$data['first_date'].'/'.$data['last_date']));
    		  }else{
      			$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
      			redirect(base_url('pegawai/logbook/view/'.$data['first_date'].'/'.$data['last_date']));
    		  }
      }
      else{
        $this->session->set_flashdata('danger', 'Data Sudah Di Validasi');
        redirect(base_url('pegawai/logbook/view/'.$data['first_date'].'/'.$data['last_date']));
      }
     }
      else{
        $this->session->set_flashdata('danger', 'Data Sudah Ada Di Pengajuan');
  			redirect(base_url('pegawai/logbook/view/'.$data['first_date'].'/'.$data['last_date']));
      }
    }
  else{
//		$data['kr_kewenangan_detil']=$this->m_rancak->kr_kewenangan_detil($data['room_id'],$data['id']);
		$data['kr_kewenangan_detil']=$this->m_rancak->kr_kewenangan_detil_logbook($data['room_id'],$data['id'],$pegawai['id_jabatan']);
      if($mode=='non_keperawatan'){
        $data['page'] =  $data['page']."_non_keperawatan";
		$mine = $this->m_umum->ambil_data('pegawai','id_pegawai',$pegawai["id_pegawai"]);
		$kondisi_mine=array('id_pegawai'=>$mine['id_pegawai']);
		$jml_mine=$this->m_umum->jumlah_record_filter('perawat_detil',$kondisi_mine);
		if($jml_mine > 0){
			$this->session->set_flashdata('danger', 'Data Penugasan Klinis Ada');
			redirect(base_url('pegawai/logbook/view/'.$tgl.'/'.$tgl));
		}
		$this->form_validation->set_rules('id_pegawai','id_pegawai','required');
        if ($this->form_validation->run() === FALSE){
			$this->tampil_top($data);
        }else{
			$first_date = $this->input->post("first_date");
			$last_date = $this->input->post("last_date");
			if($this->input->post('chk')){
				$checkboxes = $this->input->post('chk');
				$chk = implode("-",$checkboxes);
				redirect(base_url('pegawai/logbook/isi/'.$first_date.'/'.$last_date.'/'.$chk));
			}else{
				redirect(base_url('pegawai/logbook/view/01-'.date('m-Y').'/'.date('d-m-Y')));
			}
		}
	  }
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		$mine = $this->m_umum->ambil_data('pegawai','id_pegawai',$pegawai["id_pegawai"]);
		$kondisi_mine=array('id_pegawai'=>$mine['id_pegawai']);
		$jml_mine=$this->m_umum->jumlah_record_filter('perawat_detil',$kondisi_mine);
		if($jml_mine == 0){
			$this->session->set_flashdata('danger', 'Data Penugasan Klinis Tidak Ada');
			redirect(base_url('pegawai/logbook/view/'.$tgl.'/'.$tgl));
		}else{
			$cek_pk = $this->m_umum->ambil_data('perawat_detil','id_pegawai',$pegawai["id_pegawai"]);
			$cek_pke = $cek_pk['id_kode_kewenangan'] + 1;
			if($cek_pke < $data['id']){
				$this->session->set_flashdata('danger', 'Kode Penugasan Klinis Tidak Sesuai');
				redirect(base_url('pegawai/logbook/view/01-'.date('m-Y').'/'.date('d-m-Y')));
			}
		}
		$this->form_validation->set_rules('id_pegawai','id_pegawai','required');
        if ($this->form_validation->run() === FALSE){
			$this->tampil_top($data);
        }else{
			$first_date = $this->input->post("first_date");
			$last_date = $this->input->post("last_date");
			if($this->input->post('chk')){
				$checkboxes = $this->input->post('chk');
				$chk = implode("-",$checkboxes);
				redirect(base_url('pegawai/logbook/isi/'.$first_date.'/'.$last_date.'/'.$chk));
			}else{
				redirect(base_url('pegawai/logbook/view/01-'.date('m-Y').'/'.date('d-m-Y')));
			}
		}
	  }
      if($mode=='isi'){
		$data['page'] =  $data['page']."_isi";
		$data['kr_kewenangan']=$this->m_rancak->kewenangan_all();
		$du = $this->m_umum->ambil_data('jabatan','id_jabatan',$data['jabatan_id']);
		$data['count']  = set_value('count',$du['count']);
		$data['id_unit']  = set_value('id_unit',$pegawai['id_ruangan']);
		$data['terpilih'] = set_value('terpilih',explode("-", $data['id']));
		$data['tgl_logbook'] = set_value('tgl_logbook',date('d-m-Y'));
		$this->form_validation->set_rules('id_pegawai','id_pegawai','required');
		if ($this->form_validation->run() === FALSE)
		{
			  $this->tampil_top($data);
		}
		else
		{
			$counter = $this->input->post('counter');
			if($counter=='0') {
				$this->m_profil->simpan_logbook0();
			}else{
				$this->m_profil->simpan_logbook();
			}
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Tambah');
			redirect(base_url('pegawai/logbook/view/01-'.date('m-Y').'/'.date('d-m-Y')));
		}
      }
		if($mode=='pdf_harian'){
		  $data['print_logbook_bulanane'] = $this->m_profil->print_logbook_bulanane($data['first_date'],$data['id']);
	      $report = $this->load->view('cetak/logbook_harian', $data, TRUE);
		  $filename = $data['header']."-".$data['id'].".pdf";
	//    $mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'L','margin_left' => '5','margin_right' => '5','margin_top' => '5','margin_bottom' => '5']);
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
		if($mode=='pdf_bulanan'){
		  $report = $this->load->view('cetak/logbook_bulanan', $data, TRUE);
		  $filename = $data['id']."-bcp-ukom.pdf";
	//	  $mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'P','margin_left' => '5','margin_right' => '5','margin_top' => '5','margin_bottom' => '5']);
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->AddPage('P', '', '', '', 2, 5, 5, 5, 5, 3, 3);
		  $mpdf->SetDisplayMode('fullpage');
		  //$mpdf->SetFooter('Page : {PAGENO}');
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
		if($mode=='pdf_tahunan'){
		  $report = $this->load->view('cetak/logbook_tahunan', $data, TRUE);
		  $filename = $data['header'].".pdf";
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
  function seting_dupak($mode='view')
  {
	$data['page']  = "seting_dupak";
	$data['header'] = "SETING BUTIR KEGIATAN UNTUK KONVERSI LOGBOOK KE DUPAK";
	$data['title'] = "SETING BUTIR KEGIATAN UNTUK KONVERSI LOGBOOK KE DUPAK";
	$data['link_kembali'] = base_url('pegawai');
	$data['link_awal'] = base_url('pegawai/seting_dupak');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$program    = $this->m_umum->ambil_data('a_program','id_program',$pegawai["id_program"]);
	$data['program_unit'] = $program["unit"];
	$data['program_user_level'] = $program["user_level"];
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','2');
	$data['instance_id'] = $instansi["id_instansi"];
	$data['room_name'] = $pegawai["nama_ruangan"];
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
	$data['member_id'] = $pegawai["id_pegawai"];
	$data['room_id'] = $pegawai["id_ruangan"];
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
	$data['cmd_bulan']=$this->m_rancak->cmd_bulan();
	$data['cmd_range_tahun']=$this->m_rancak->cmd_range_tahun(date('Y')-5,date('Y')+5);
	$data['bulan'] = $this->uri->segment(4, 0);
	$data['tahun'] = $this->uri->segment(5, 0);
	if(empty($data['bulan'])){
		$data['bulan'] = '0';
	}
	if(empty($data['tahun'])){
		$data['tahun'] = date('Y');
	}
    if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$bulan = $this->input->post("bulan");
			$tahun = $this->input->post("tahun");
			redirect(base_url('pegawai/seting_dupak/view/'.$bulan.'/'.$tahun));
		}
	}
    else if($mode=='data'){
		echo json_encode($this->m_profil->buket_pegawai($data['member_id'],$data['bulan'],$data['tahun']));
	}
	else if($mode=='hapus'){
	  if($this->m_umum->hapus_data('kr_buket_pegawai','id_buket_pegawai',$data['bulan']) ){  //// $data['month'] = id_dupak_buket
		redirect(base_url('pegawai/seting_dupak'));
	  }else{
		$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
		redirect(base_url('pegawai/seting_dupak'));
	  }
	}
  else{
	$data['kr_buket_personal']=$this->m_rancak->kr_buket_personal($pegawai['id_pegawai']);
	$data['buket']   = $this->m_rancak->buket($pegawai['id_jabatan']);
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		$this->form_validation->set_rules('id_pegawai','id_pegawai','required');
        if ($this->form_validation->run() === FALSE){
			$this->tampil($data);
        }else{
			$this->m_profil->simpan_buket_pegawai();
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
			redirect(base_url('pegawai/seting_dupak'));
        }
      }
      if($mode=='transfer'){
        $data['page'] =  $data['page']."_transfer";
		$data['ambil_buket']=$this->m_rancak->ambil_buket($pegawai['id_pegawai']);
		$this->form_validation->set_rules('id_pegawai','id_pegawai','required');
        if ($this->form_validation->run() === FALSE){
			$this->tampil($data);
        }else{
			$this->m_profil->simpan_buket_pegawai();
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
			redirect(base_url('pegawai/seting_dupak'));
        }
      }
	}
  }
  function logbook_dupak($mode='view')
  {
	$data['page']  = "logbook_dupak";
	$data['header'] = "PILIH LOGBOOK UNTUK PRINT OUT DUPAK";
	$data['title'] = "PILIH LOGBOOK UNTUK PRINT OUT DUPAK";
	$data['link_kembali'] = base_url('pegawai');
	$data['link_awal'] = base_url('pegawai/logbook_dupak');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$program    = $this->m_umum->ambil_data('a_program','id_program',$pegawai["id_program"]);
	$data['program_unit'] = $program["unit"];
	$data['program_user_level'] = $program["user_level"];
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','2');
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['room_name'] = $pegawai["nama_ruangan"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
	$data['pake_wa'] = $instansi["wa"];
	$data['member_name'] = $pegawai["nama_pegawai"];
	$data['level_id'] = $pegawai["id_level"];
	$data['member_id'] = $pegawai["id_pegawai"];
	$data['room_id'] = $pegawai["id_ruangan"];
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
	$data['cmd_bulan']=$this->m_rancak->cmd_bulan();
	$data['cmd_range_tahun']=$this->m_rancak->cmd_range_tahun(date('Y')-5,date('Y')+5);
	$data['bulan'] = $this->uri->segment(4, 0);
	$data['tahun'] = $this->uri->segment(5, 0);
	if(empty($data['bulan'])){
		$data['bulan'] =  date('m');
	}
	if(empty($data['tahun'])){
		$data['tahun'] = date('Y');
	}
    if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$bulan = $this->input->post("bulan");
			$tahun = $this->input->post("tahun");
			redirect(base_url('pegawai/logbook_dupak/view/'.$bulan.'/'.$tahun));
		}
	}
    else if($mode=='data'){
		echo json_encode($this->m_profil->dupak_personil($data['member_id'],$data['bulan'],$data['tahun']));
	}
  else{
      if($mode=='status'){
		$this->m_profil->edit_status_logbook($data['bulan'],$data['tahun']);
		$this->session->set_flashdata('sukses', 'Data Sudah Dirubah');
		redirect(base_url('pegawai/logbook_dupak'));
      }
	}
  }
  function dupak($mode='view')
  {
	$data['page']  = "dupak";
	$data['header'] = "DUPAK";
	$data['title'] = "DUPAK";
	$data['link_kembali'] = base_url('pegawai');
	$data['link_awal'] = base_url('pegawai/dupak');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$program    = $this->m_umum->ambil_data('a_program','id_program',$pegawai["id_program"]);
	$data['program_unit'] = $program["unit"];
	$data['program_user_level'] = $program["user_level"];
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','2');
	$data['instance_id'] = $instansi["id_instansi"];
	$data['room_name'] = $pegawai["nama_ruangan"];
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
	$data['member_id'] = $pegawai["id_pegawai"];
	$data['room_id'] = $pegawai["id_ruangan"];
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
	$data['cmd_bulan']=$this->m_rancak->cmd_bulan();
	$data['cmd_range_tahun']=$this->m_rancak->cmd_range_tahun(date('Y')-5,date('Y')+5);
	$data['bulan'] = $this->uri->segment(4, 0);
	$data['tahun'] = $this->uri->segment(5, 0);
	if(empty($data['bulan'])){
		$data['bulan'] =  date('m');
	}
	if(empty($data['tahun'])){
		$data['tahun'] = date('Y');
	}
    if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$bulan = $this->input->post("bulan");
			$tahun = $this->input->post("tahun");
			redirect(base_url('pegawai/dupak/view/'.$bulan.'/'.$tahun));
		}
	}
    else if($mode=='data'){
		echo json_encode($this->m_profil->logbook_dupak_personil($data['member_id'],$data['bulan'],$data['tahun']));
	}
	else if($mode=='hapus'){
	  if($this->m_umum->hapus_data('kr_buket_pegawai','id_buket_pegawai',$data['bulan']) ){  //// $data['month'] = id_dupak_buket
		redirect(base_url('pegawai/dupak'));
	  }else{
		$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
		redirect(base_url('pegawai/dupak'));
	  }
	}
  else{
		if($mode=='pdf_tahunan'){
		  $report = $this->load->view('cetak/dupak_tahunan', $data, TRUE);
		  $filename = $data['header'].".pdf";
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-L']);
		  $mpdf->AddPage('L', '', '', '', 2, 5, 5, 5, 5, 3, 3);
		  $mpdf->SetDisplayMode('fullpage');
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->defaultheaderline = 0;
	      $mpdf->defaultfooterline = 0;
		  $mpdf->shrink_tables_to_fit = 1;
		  $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
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
  function pengajuan_kompetensi($mode='view')
  {
	$data['page']  = "pengajuan_kompetensi";
	$data['header'] = "PENGAJUAN KOMPETENSI";
	$data['title'] = "PENGAJUAN KOMPETENSI";
	$data['link_kembali'] = base_url('pegawai');
	$data['link_awal'] = base_url('pegawai/pengajuan_kompetensi');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$program    = $this->m_umum->ambil_data('a_program','id_program',$pegawai["id_program"]);
	$data['program_unit'] = $program["unit"];
	$data['program_user_level'] = $program["user_level"];
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','2');
	$data['instance_id'] = $instansi["id_instansi"];
	$data['room_name'] = $pegawai["nama_ruangan"];
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
	$data['member_id'] = $pegawai["id_pegawai"];
	$data['room_id'] = $pegawai["id_ruangan"];
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
	$data['cmd_bulan']=$this->m_rancak->cmd_bulan();
	$data['cmd_range_tahun']=$this->m_rancak->cmd_range_tahun(date('Y')-5,date('Y')+5);
	$data['ambil_data_etik_pegawai_oppe'] = $this->m_rancak->ambil_data_etik_pegawai_oppe($this->session->id_pegawai,date('Y'));
	$kondisi_etik=array('kr_etik_pegawai.id_pegawai'=>$pegawai['id_pegawai'],'year(tgl_etik_pegawai)'=>date('Y'));
	$data['jml_etik']=$this->m_umum->jumlah_record_filter('kr_etik_pegawai',$kondisi_etik);
	$data['id'] = $this->uri->segment(4, 0);
	$data['a'] = $this->uri->segment(5, 0);
	$data['b'] = $this->uri->segment(6, 0);
  if($mode=='view'){
	 	$kondisi_pegdet=array('id_pegawai'=>$this->session->id_pegawai);
		$data['jml_pegdet']=$this->m_umum->jumlah_record_filter('perawat_detil',$kondisi_pegdet); 
		$data['jml_yang_ditolak']=$this->m_profil->jumlah_record_logbook_tolak();  	
		$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_profil->pengajuan_kompetensi_all($data['member_id']));
	}
    else if($mode=='grafik'){
		echo json_encode($this->m_profil->grafik_logbook($data['id']));
	}
    else if($mode=='tabel'){
		echo json_encode($this->m_profil->tabel_logbook($data['id']));
	}
    else if($mode=='pemulihan'){
		echo json_encode($this->m_profil->tabel_pemulihan($data['id']));
	}
	else if($mode=='hapus'){
	  if($this->m_umum->hapus_data('kr_buket_pegawai','id_buket_pegawai',$data['bulan']) ){  //// $data['month'] = id_dupak_buket
		redirect(base_url('pegawai/dupak'));
	  }else{
		$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
		redirect(base_url('pegawai/dupak'));
	  }
	}
  else{
	//  $data['status_diusulkan_all']=$this->m_rancak->status_diusulkan_all();
	  $data['status_diusulkan_all']=$this->m_rancak->status_diusulkan_1();
      if($mode=='tambah'){
          $data['page'] =  $data['page']."_tambah";
          $status_diusulkan = $this->m_umum->ambil_data('kol_status_diusulkan','id_status_diusulkan',$data['id']);
		      $data['nama_status_diusulkan']  = set_value('nama_status_diusulkan',$status_diusulkan['nama_status_diusulkan']);
		      $this->load->view("profil/isi",$data);
      }
      if($mode=='simpan_tambah'){
		  if($last_ide = $this->m_profil->simpan_pengajuan_kompetensi($pegawai['id_level'])){
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
			redirect(base_url('pegawai/pengajuan_kompetensi'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
			redirect(base_url('pegawai/pengajuan_kompetensi'));
		  }
      }
      if($mode=='isi'){
        $data['page'] =  $data['page']."_isi";
				$data['ambil_berkas_data']=$this->m_rancak->ambil_id_berkas_data($data['member_id']);
				$d	=$this->m_rancak->ambil_pengajuan_kompetensi($data['id']);
		    if($d["id_pegawai"] !== $this->session->id_pegawai){
		      redirect(base_url('pegawai/pengajuan_kompetensi'));
		    }
				$data['id_pengajuan']  = set_value('id_pengajuan',$d["id_pengajuan"]);
				$kondisi_logbooke=array('id_pengajuan'=>$d["id_pengajuan"]);
				$data['jml_logbooke']=$this->m_umum->jumlah_record_filter('logbook',$kondisi_logbooke);
				$data['id_status_diusulkan']  = set_value('id_status_diusulkan',$d["id_status_diusulkan"]);
				$data['nama_status_diusulkan']  = set_value('nama_status_diusulkan',$d["nama_status_diusulkan"]);
				$data['id_berkas']  = explode(",", $d["id_berkas"]);
				$data['berkas']  = $d["id_berkas"];
				$data['id_ijasah']  = explode(",", $d["id_ijasah"]);
				$data['ijasah']  = $d["id_ijasah"];
				$data['id_str']  = explode(",", $d["id_str"]);
				$data['str']  = $d["id_str"];
				$data['id_sertifikat']  = explode(",", $d["id_sertifikat"]);
				$data['etike']  = explode(",", $d["id_etik_pegawai"]);
				$data['sertifikat']  = $d["id_sertifikat"];
				$data['kesesuaian_bukti']  = set_value('kesesuaian_bukti',explode(",", $d["kesesuaian_bukti"]));
				$data['id_logbook_a']  = set_value('id_logbook_a',$d["id_logbook_a"]);
				$data['id_logbook_b']  = set_value('id_logbook_b',$d["id_logbook_b"]);
				$data['status_pengajuan']  = set_value('status_pengajuan',$d["status_pengajuan"]);
				$data['id_etik_pegawai']  = set_value('id_etik_pegawai',$d["id_etik_pegawai"]);
				$data['acc_kabid']  = set_value('acc_kabid',$d["acc_kabid"]);
				$data['acc_komite']  = set_value('acc_komite',$d["acc_komite"]);
				$data['kredensial']  = set_value('kredensial',$d["kredensial"]);
				$data['mutu']  = set_value('mutu',$d["mutu"]);
				$data['etika']  = set_value('etika',$d["etika"]);
				$data['spk']  = set_value('spk',$d["spk"]);
				$this->tampil_top($data);
				$action = $this->input->post('action');
				$id_pengajuan = $this->input->post('id_pengajuan');
				if($action == 'Btnsimpan') {
					$this->m_profil->edit_pengajuan($pegawai['id_level']);
					$this->session->set_flashdata('sukses', 'Pengajuan Sudah Di Simpan');
					redirect(base_url('pegawai/pengajuan_kompetensi'));
				}
				if($action == 'BtnKirim') {
				//	$this->m_profil->simpan_pengajuan_logbook_pegawai($id_pengajuan);
					$this->m_profil->terkirim($pegawai['id_level']);
					$this->session->set_flashdata('sukses', 'Pengajuan Sudah Diproses Cek Tabel Untuk Kelengkapan Data');
					redirect(base_url('pegawai/pengajuan_kompetensi'));
				}
	  }
    if($mode=='lihat_pemulihan'){
      $data['page'] =  $data['page']."_lihat_pemulihan";
      $data['ambil_lobook_pemulihan_detil']=$this->m_rancak->ambil_kewenangan_lobook_pemulihan_detil2($data['id']);
      $this->load->view("profil/isi",$data);
    }
    if($mode=='lihat_kegiatan'){
      $data['page'] =  $data['page']."_lihat_kegiatan";
      $data['ambil_lobook_pemulihan_detil']=$this->m_rancak->ambil_kewenangan_lobook_kegiatan_pemulihan_detil($data['id']);
      $this->load->view("profil/isi",$data);
    }
		if($mode=='reset_logbook'){
			if($data['a'] == 4){
				  if($this->m_profil->reset_logbook($data['id'])){
				  	$this->session->set_flashdata('sukses', 'Data Sudah Di Reset');
				  	redirect(base_url('pegawai/pengajuan_kompetensi'));
				  }else{
						$this->session->set_flashdata('danger', 'Masalah Edit Data');
						redirect(base_url('pegawai/pengajuan_kompetensi'));
				  }
			}else{
				$logbooke = $this->m_umum->ambil_data('logbook','id_logbook',$data['id']);
				if($logbooke['v_kabid'] == 0 AND $logbooke['v_asesor'] == 0 AND $logbooke['v_komite'] == 0 AND $logbooke['v_direktur'] == 0){
				  if($this->m_profil->reset_logbook($data['id'])){
				  	$this->session->set_flashdata('sukses', 'Data Sudah Di Reset');
				  	redirect(base_url('pegawai/pengajuan_kompetensi'));
				  }else{
						$this->session->set_flashdata('danger', 'Masalah Edit Data');
						redirect(base_url('pegawai/pengajuan_kompetensi'));
				  }
				}else{
						$this->session->set_flashdata('danger', 'Data Sudah Di Validasi');
						redirect(base_url('pegawai/pengajuan_kompetensi'));				
				}
			}
		}    
		if($mode=='pdf'){
		  $report = $this->load->view('cetak/logbook_pengajuan', $data, TRUE);
		  $filename = $data['header'].".pdf";
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-L']);
		  $mpdf->AddPage('P', '', '', '', 2, 5, 5, 5, 5, 3, 3);
		  $mpdf->SetDisplayMode('fullpage');
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->defaultheaderline = 0;
	      $mpdf->defaultfooterline = 0;
		  $mpdf->shrink_tables_to_fit = 1;
		  $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
		  for ($i = 1; $i > 2; $i++) {
			$mpdf->SetHTMLFooter('');
		  }
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
		if($mode=='pdf_etika'){
		  $report = $this->load->view('cetak/etika_profesi', $data, TRUE);
		  $filename = $data['header'].".pdf";
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-L']);
		  $mpdf->AddPage('P', '', '', '', 2, 5, 5, 5, 10, 3, 3);
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
		  //$mpdf->SetFooter('Page : {PAGENO}');
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
	}
  }
  function berkas_logbook($mode='view')
  {
		$data['page']  = "berkas_logbook";
		$data['header'] = "PEMILIHAN ID LOGBOOK AWAL DAN AKHIR";
		$data['title'] = "PEMILIHAN ID LOGBOOK AWAL DAN AKHIR";
		$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
		$program    = $this->m_umum->ambil_data('a_program','id_program',$pegawai["id_program"]);
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
		$data['room_name'] = $pegawai["nama_ruangan"];
		$data['pake_wa'] = $instansi["wa"];
		$data['member_name'] = $pegawai["nama_pegawai"];
		$data['level_id'] = $pegawai["id_level"];
		$data['member_id'] = $pegawai["id_pegawai"];
		$data['room_id'] = $pegawai["id_ruangan"];
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
		$data['cmd_bulan']=$this->m_rancak->cmd_bulan();
		$data['cmd_range_tahun']=$this->m_rancak->cmd_range_tahun(date('Y')-5,date('Y')+5);
		$data['first_date']  = $this->uri->segment(4, 0);
		$data['last_date']   = $this->uri->segment(5, 0);
		$data['id']   = $this->uri->segment(6, 0); //id pengajuan
		$pengajuane = $this->m_umum->ambil_data('kr_pengajuan','id_pengajuan',$data['id']);
		$data['id_status_diusulkan'] = $pengajuane['id_status_diusulkan'];
		$data['link_kembali'] = base_url('pegawai/pengajuan_kompetensi/isi/'.$data['id']);
		if(empty($data['first_date'])){
			$data['first_date'] =  '01-'.date('m-Y');
		}
		if(empty($data['last_date'])){
			$data['last_date'] = date('d-m-Y');
		}
		if($data['id_status_diusulkan'] == 1){
			$data['logbook_pengajuan'] = $this->m_profil->logbook_pengajuan_perawat($data['first_date'],$data['last_date']);
		}elseif($data['id_status_diusulkan'] == 4){
			$data['logbook_pengajuan'] = $this->m_profil->logbook_pengajuan_tolak();
		}elseif($data['id_status_diusulkan'] == 3){
			$data['logbook_pengajuan'] = $this->m_profil->logbook_pengajuan_penambahan($data['first_date'],$data['last_date']);
		}else{
			$data['logbook_pengajuan'] = $this->m_profil->logbook_pengajuan_kredensial($data['first_date'],$data['last_date']);
		}
	    if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$first_date = $this->input->post("first_date");
				$last_date = $this->input->post("last_date");
				$id = $this->input->post("id_pengajuan");
				redirect(base_url('pegawai/berkas_logbook/view/'.$first_date.'/'.$last_date.'/'.$id));
			}
			if($action == 'BtnTolak') {
				$this->m_profil->simpan_logbook_tolak();
				$id = $this->input->post("id_pengajuan");
				redirect(base_url('pegawai/pengajuan_kompetensi/isi/'.$id));
			}
		}
	    else if($mode=='data'){
			echo json_encode($this->m_profil->logbook_pengajuan_all($data['first_date'],$data['last_date'],$pegawai['id_pegawai'],$pegawai['id_level'],$data['id']));
		}
	  else{
	      if($mode=='simpana'){
			$status_pengajuan=$this->m_umum->ambil_data('kr_pengajuan','id_pengajuan',$data['first_date']);
			if($status_pengajuan['status_pengajuan']=="0"){
				$this->m_profil->simpan_pengajuan_logbook_a($data['first_date'],$data['last_date']);
				$this->m_profil->simpan_pengajuan_logbook_pegawai($data['first_date'],'0');
			}
			redirect(base_url('pegawai/pengajuan_kompetensi/isi/'.$data['first_date']));
	      }
	      if($mode=='simpanb'){
			$status_pengajuan=$this->m_umum->ambil_data('kr_pengajuan','id_pengajuan',$data['first_date']);
			if($status_pengajuan['status_pengajuan']=="0"){
				$this->m_profil->simpan_pengajuan_logbook_b($data['first_date'],$data['last_date']);
				$this->m_profil->simpan_pengajuan_logbook_pegawai($data['first_date'],'0');
			}
			redirect(base_url('pegawai/pengajuan_kompetensi/isi/'.$data['first_date']));
	      }
		}
  }
  function berkas_ijasah($mode='view')
  {
	$data['page']  = "berkas_ijasah";
	$data['header'] = "AMBIL BERKAS IJASAH";
	$data['title'] = "AMBIL BERKAS IJASAH";
	$data['link_kembali'] = base_url('pegawai');
	$data['link_awal'] = base_url('pegawai/seting_dupak');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$program    = $this->m_umum->ambil_data('a_program','id_program',$pegawai["id_program"]);
	$data['program_unit'] = $program["unit"];
	$data['program_user_level'] = $program["user_level"];
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','2');
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['room_name'] = $pegawai["nama_ruangan"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
	$data['pake_wa'] = $instansi["wa"];
	$data['member_name'] = $pegawai["nama_pegawai"];
	$data['level_id'] = $pegawai["id_level"];
	$data['member_id'] = $pegawai["id_pegawai"];
	$data['room_id'] = $pegawai["id_ruangan"];
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
	$data['id']  = $this->uri->segment(4, 0);
	$data['idb']  = $this->uri->segment(5, 0);
	$data['link_kembali'] = base_url('pegawai/pengajuan_kompetensi/isi/'.$data['id']);
    if($mode=='view'){
		$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_profil->ijasah_all($data['member_id']));
	}
  else{
      if($mode=='simpan'){
		$status_pengajuan=$this->m_umum->ambil_data('kr_pengajuan','id_pengajuan',$data['id']);
		$id_ijasahe = $status_pengajuan['id_ijasah'];
		$this->m_profil->simpan_berkas_ijasah($data['id'],$data['idb'],$id_ijasahe);
		redirect(base_url('pegawai/pengajuan_kompetensi/isi/'.$data['id']));
      }
	}
  }
  function berkas_sertifikat($mode='view')
  {
	$data['page']  = "berkas_sertifikat";
	$data['header'] = "AMBIL BERKAS PELATIHAN / SERTIFIKAT";
	$data['title'] = "AMBIL BERKAS PELATIHAN / SERTIFIKAT";
	$data['link_kembali'] = base_url('pegawai');
	$data['link_awal'] = base_url('pegawai/seting_dupak');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$program    = $this->m_umum->ambil_data('a_program','id_program',$pegawai["id_program"]);
	$data['program_unit'] = $program["unit"];
	$data['program_user_level'] = $program["user_level"];
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','2');
	$data['instance_id'] = $instansi["id_instansi"];
	$data['room_name'] = $pegawai["nama_ruangan"];
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
	$data['member_id'] = $pegawai["id_pegawai"];
	$data['room_id'] = $pegawai["id_ruangan"];
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
	$data['id']  = $this->uri->segment(4, 0);
	$data['idb']  = $this->uri->segment(5, 0);
	$data['link_kembali'] = base_url('pegawai/pengajuan_kompetensi/isi/'.$data['id']);
    if($mode=='view'){
		$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_profil->pelatihan_all($data['member_id']));
	}
  else{
      if($mode=='simpan'){
		$status_pengajuan=$this->m_umum->ambil_data('kr_pengajuan','id_pengajuan',$data['id']);
		$id_ijasahe = $status_pengajuan['id_sertifikat'];
		$this->m_profil->simpan_berkas_sertifikat($data['id'],$data['idb'],$id_ijasahe);
		redirect(base_url('pegawai/pengajuan_kompetensi/isi/'.$data['id']));
      }
	}
  }
  function berkas_str($mode='view')
  {
	$data['page']  = "berkas_str";
	$data['header'] = "AMBIL BERKAS SURAT IJIN";
	$data['title'] = "AMBIL BERKAS SURAT IJIN";
	$data['link_kembali'] = base_url('pegawai');
	$data['link_awal'] = base_url('pegawai/seting_dupak');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$program    = $this->m_umum->ambil_data('a_program','id_program',$pegawai["id_program"]);
	$data['program_unit'] = $program["unit"];
	$data['program_user_level'] = $program["user_level"];
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','2');
	$data['instance_id'] = $instansi["id_instansi"];
	$data['room_name'] = $pegawai["nama_ruangan"];
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
	$data['member_id'] = $pegawai["id_pegawai"];
	$data['room_id'] = $pegawai["id_ruangan"];
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
	$data['id']  = $this->uri->segment(4, 0);
	$data['idb']  = $this->uri->segment(5, 0);
	$data['link_kembali'] = base_url('pegawai/pengajuan_kompetensi/isi/'.$data['id']);
    if($mode=='view'){
		$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_profil->str_all($data['member_id']));
	}
  else{
      if($mode=='simpan'){
		$status_pengajuan=$this->m_umum->ambil_data('kr_pengajuan','id_pengajuan',$data['id']);
		$id_ijasahe = $status_pengajuan['id_str'];
		$this->m_profil->simpan_berkas_str($data['id'],$data['idb'],$id_ijasahe);
		redirect(base_url('pegawai/pengajuan_kompetensi/isi/'.$data['id']));
      }
	}
  }
  function berkaslain_berkas($mode='view')
  {
	$data['page']  = "berkaslain_berkas";
	$data['header'] = "AMBIL BERKAS UMUM";
	$data['title'] = "AMBIL BERKAS UMUM";
	$data['link_kembali'] = base_url('pegawai');
	$data['link_awal'] = base_url('pegawai/seting_dupak');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$program    = $this->m_umum->ambil_data('a_program','id_program',$pegawai["id_program"]);
	$data['program_unit'] = $program["unit"];
	$data['program_user_level'] = $program["user_level"];
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','2');
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['room_name'] = $pegawai["nama_ruangan"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
	$data['pake_wa'] = $instansi["wa"];
	$data['member_name'] = $pegawai["nama_pegawai"];
	$data['level_id'] = $pegawai["id_level"];
	$data['member_id'] = $pegawai["id_pegawai"];
	$data['room_id'] = $pegawai["id_ruangan"];
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
	$data['id']  = $this->uri->segment(4, 0);
	$data['idb']  = $this->uri->segment(5, 0);
	$data['link_kembali'] = base_url('pegawai/pengajuan_kompetensi/isi/'.$data['id']);
    if($mode=='view'){
		$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_profil->berkas_pribadi_all($data['member_id']));
	}
  else{
      if($mode=='simpan'){
		$status_pengajuan=$this->m_umum->ambil_data('kr_pengajuan','id_pengajuan',$data['id']);
		$id_ijasahe = $status_pengajuan['id_berkas'];
		$this->m_profil->simpan_berkaslain_berkas($data['id'],$data['idb'],$id_ijasahe);
		redirect(base_url('pegawai/pengajuan_kompetensi/isi/'.$data['id']));
      }
	}
  }
  function berkas_etik($mode='view')
  {
	$data['page']  = "berkas_etik";
	$data['header'] = "AMBIL BERKAS ETIK PEGAWAI";
	$data['title'] = "AMBIL BERKAS ETIK PEGAWAI";
	$data['link_kembali'] = base_url('pegawai');
	$data['link_awal'] = base_url('pegawai/seting_dupak');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$program    = $this->m_umum->ambil_data('a_program','id_program',$pegawai["id_program"]);
	$data['program_unit'] = $program["unit"];
	$data['program_user_level'] = $program["user_level"];
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','2');
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['room_name'] = $pegawai["nama_ruangan"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
	$data['pake_wa'] = $instansi["wa"];
	$data['member_name'] = $pegawai["nama_pegawai"];
	$data['level_id'] = $pegawai["id_level"];
	$data['member_id'] = $pegawai["id_pegawai"];
	$data['room_id'] = $pegawai["id_ruangan"];
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
	$data['id']  = $this->uri->segment(4, 0);
	$data['idb']  = $this->uri->segment(5, 0);
	$data['link_kembali'] = base_url('pegawai/pengajuan_kompetensi/isi/'.$data['id']);
    if($mode=='view'){
		$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_profil->etik_pegawai_all($data['member_id']));
	}
  else{
      if($mode=='simpan'){
		$status_pengajuan=$this->m_umum->ambil_data('kr_pengajuan','id_pengajuan',$data['id']);
		$id_berkas_etik = $status_pengajuan['id_etik_pegawai'];
		$this->m_profil->simpan_berkas_etik($data['id'],$id_berkas_etik,$data['idb']);
		redirect(base_url('pegawai/pengajuan_kompetensi/isi/'.$data['id']));
      }
	}
  }
   function penilaian_kinerja($mode='view')
  {
	$data['page']  = "penilaian_kinerja";
	$data['title'] = "PENILAIAN KINERJA";
	$data['link_kembali'] = base_url('berkas');
	$data['link_awal'] = base_url('berkas/penilaian_kinerja');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$program    = $this->m_umum->ambil_data('a_program','id_program',$pegawai["id_program"]);
	$data['program_unit'] = $program["unit"];
	$data['program_user_level'] = $program["user_level"];
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','2');
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['header'] = "On going Professional Practice Evaluation";
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['room_name'] = $pegawai["nama_ruangan"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
	$data['pake_wa'] = $instansi["wa"];
	$data['member_name'] = $pegawai["nama_pegawai"];
	$data['member_id'] = $pegawai["id_pegawai"];
	$data['level_id'] = $pegawai["id_level"];
	$data['room_id'] = $pegawai["id_ruangan"];
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
	$data['tahun'] = $this->uri->segment(4, 0);
	$data['cmd_tahun_logbook'] = $this->m_rancak->cmd_tahun_logbook();
	$data['cmd_pegawai'] = $this->m_rancak->cmd_pegawai_null_with_unit_source_jabatan($program['jabatan'],$pegawai['id_level']);
	if(empty($data['tahun'])){
		$data['tahun'] = '0';
	}
	$data['id_pegawai'] = $pegawai['barcode_pegawai'];
	$data['ambil_data_kompetensi_pegawai_oppe'] = $this->m_berkas->ambil_data_kompetensi_pegawai_oppe($pegawai['barcode_pegawai'],$data['tahun']);
	$kondisi_pelatihan=array('id_pegawai'=>$pegawai['id_pegawai'],'year(tgl_a_berkas)'=>$data['tahun']);
	$data['jml_pelatihan']=$this->m_umum->jumlah_record_filter('berkas',$kondisi_pelatihan);
	$data['ambil_data_pelatihan_pegawai_oppe'] = $this->m_berkas->ambil_data_pelatihan_pegawai_oppe($pegawai['barcode_pegawai'],$data['tahun']);
	$kondisi_etik=array('kr_etik_pegawai.id_pegawai'=>$pegawai['id_pegawai'],'year(tgl_etik_pegawai)'=>$data['tahun']);
	$data['jml_etik']=$this->m_umum->jumlah_record_filter('kr_etik_pegawai',$kondisi_etik);
	$data['ambil_data_etik_pegawai_oppe'] = $this->m_berkas->ambil_data_etik_pegawai_oppe($pegawai['barcode_pegawai'],$data['tahun']);
    if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$tahun = $this->input->post("tahun");
			redirect(base_url('pegawai/penilaian_kinerja/view/'.$tahun));
		}
	}
	else{
		if($mode=='pdf'){
		  $report = $this->load->view('cetak/penilaian_kinerja', $data, TRUE);
		  $filename = $data['header'].".pdf";
		  $mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'P','margin_left' => '5','margin_right' => '5','margin_top' => '5','margin_bottom' => '5']);
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  //$mpdf->SetFooter('Page : {PAGENO}');
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
	}
  }
   function fppe($mode='view')
  {
	$data['page']  = "fppe";
	$data['title'] = "FOCUSED PROFESSIONAL PRACTICE EVALUATION";
	$data['link_kembali'] = base_url('pegawai');
	$data['link_awal'] = base_url('pegawai/fppe');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$program    = $this->m_umum->ambil_data('a_program','id_program',$pegawai["id_program"]);
	$data['program_unit'] = $program["unit"];
	$data['program_user_level'] = $program["user_level"];
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','2');
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['header'] = "On going Professional Practice Evaluation";
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['room_name'] = $pegawai["nama_ruangan"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
	$data['pake_wa'] = $instansi["wa"];
	$data['member_name'] = $pegawai["nama_pegawai"];
	$data['member_id'] = $pegawai["id_pegawai"];
	$data['level_id'] = $pegawai["id_level"];
	$data['room_id'] = $pegawai["id_ruangan"];
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
	$data['tahun'] = $this->uri->segment(4, 0);
	$data['cmd_tahun_logbook'] = $this->m_rancak->cmd_tahun_pemulihan();
	$data['cmd_pegawai'] = $this->m_rancak->cmd_pegawai_null_with_unit_source_jabatan($program['jabatan'],$pegawai['id_level']);
	if(empty($data['tahun'])){
		$data['tahun'] = '0';
	}
	$data['id_pegawai'] = $pegawai['id_pegawai'];
	$data['ambil_data_kompetensi_pegawai_oppe'] = $this->m_berkas->ambil_data_kompetensi_pegawai_oppe($pegawai['barcode_pegawai'],$data['tahun']);
	$kondisi_pelatihan=array('id_pegawai'=>$pegawai['id_pegawai'],'year(tgl_a_berkas)'=>$data['tahun']);
	$data['jml_pelatihan']=$this->m_umum->jumlah_record_filter('berkas',$kondisi_pelatihan);
	$data['ambil_data_pelatihan_pegawai_oppe'] = $this->m_berkas->ambil_data_pelatihan_pegawai_oppe($pegawai['barcode_pegawai'],$data['tahun']);
	$kondisi_etik=array('kr_etik_pegawai.id_pegawai'=>$pegawai['id_pegawai'],'year(tgl_etik_pegawai)'=>$data['tahun']);
	$data['jml_etik']=$this->m_umum->jumlah_record_filter('kr_etik_pegawai',$kondisi_etik);
	$data['ambil_data_etik_pegawai_oppe'] = $this->m_berkas->ambil_data_etik_pegawai_oppe($pegawai['barcode_pegawai'],$data['tahun']);
    if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$tahun = $this->input->post("tahun");
			redirect(base_url('pegawai/fppe/view/'.$tahun));
		}
	}
	else{
		if($mode=='pdf'){
		  $report = $this->load->view('cetak/fppe', $data, TRUE);
		  $filename = $data['header'].".pdf";
		  $mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'P','margin_left' => '5','margin_right' => '5','margin_top' => '5','margin_bottom' => '5']);
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  //$mpdf->SetFooter('Page : {PAGENO}');
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
	}
  }
  function lt($mode='view')
  {
    $data['page']  = "lt";
		$data['header'] = "GRAFIK TAHUNAN";
		$data['title'] = "GRAFIK TAHUNAN";
		$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
		$program    = $this->m_umum->ambil_data('a_program','id_program','1');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','2');
		$data['instance_id'] = $instansi["id_instansi"];
		$data['instance_name'] = $instansi["nama_instansi"];
		$data['idescription'] = $instansi["description"];
		$data['ikeywords'] = $instansi["keywords"];
		$data['iheader'] = $instansi["header"];
		$data['iheader_mini'] = $instansi["header_mini"];
		$data['ifooter'] = $instansi["footer"];
		$data['room_name'] = $pegawai["nama_ruangan"];
		$data['ilicensed'] = $instansi["licensed"];
		$data['member_id'] = $pegawai["id_pegawai"];
		$data['jabatan_id'] = $pegawai["id_jabatan"];
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
	$data['bln']   = $this->uri->segment(4, 0);
	$data['thn']   = $this->uri->segment(5, 0);
	if(empty($data['bln'])){
		$data['bln'] = date('m');
	}
	if(empty($data['thn'])){
		$data['thn'] = date('Y');
	}
	$data['array_month'] = $this->m_rancak->cmd_bulan();
	$data['array_page'] = array('lt'=>'Tahunan','lb'=>'Bulanan','lh'=>'Harian');
	$data['year_logbook']=$this->m_rancak->cmd_tahun_logbook();
	$data['ambil_kol_golongan_pemeriksaan_graph'] = $this->m_rancak->ambil_kol_golongan_pemeriksaan_graph($pegawai['id_jabatan']);
	$data['json'] = $this->m_profil->lt($data);
	if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$page = $this->input->post("page");
			$bln = $this->input->post("bln");
			$thn = $this->input->post("thn");
			redirect(base_url('pegawai/'.$page.'/view/'.$bln.'/'.$thn));
		}
	}
  }
  function lb($mode='view')
  {
    $data['page']  = "lb";
		$data['header'] = "GRAFIK BULANAN";
		$data['title'] = "GRAFIK BULANAN";
		$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
		$program    = $this->m_umum->ambil_data('a_program','id_program','1');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','2');
		$data['instance_id'] = $instansi["id_instansi"];
		$data['instance_name'] = $instansi["nama_instansi"];
		$data['room_name'] = $pegawai["nama_ruangan"];
		$data['idescription'] = $instansi["description"];
		$data['ikeywords'] = $instansi["keywords"];
		$data['iheader'] = $instansi["header"];
		$data['iheader_mini'] = $instansi["header_mini"];
		$data['ifooter'] = $instansi["footer"];
		$data['ilicensed'] = $instansi["licensed"];
		$data['member_id'] = $pegawai["id_pegawai"];
		$data['jabatan_id'] = $pegawai["id_jabatan"];
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
	$data['bln']   = $this->uri->segment(4, 0);
	$data['thn']   = $this->uri->segment(5, 0);
	if(empty($data['bln'])){
		$data['bln'] = date('m');
	}
	if(empty($data['thn'])){
		$data['thn'] = date('Y');
	}
	$data['array_month'] = $this->m_rancak->cmd_bulan();
	$data['array_page'] = array('lt'=>'Tahunan','lb'=>'Bulanan','lh'=>'Harian');
	$data['year_logbook']=$this->m_rancak->cmd_tahun_logbook();
	$data['ambil_kol_golongan_pemeriksaan_graph'] = $this->m_rancak->ambil_kol_golongan_pemeriksaan_graph($pegawai['id_jabatan']);
	$data['json'] = $this->m_profil->lb($data);
	if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$page = $this->input->post("page");
			$bln = $this->input->post("bln");
			$thn = $this->input->post("thn");
			redirect(base_url('pegawai/'.$page.'/view/'.$bln.'/'.$thn));
		}
	}
  }
  function lh($mode='view')
  {
    $data['page']  = "lh";
		$data['header'] = "GRAFIK HARIAN";
		$data['title'] = "GRAFIK HARIAN";
		$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
		$program    = $this->m_umum->ambil_data('a_program','id_program','1');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','2');
		$data['instance_id'] = $instansi["id_instansi"];
		$data['instance_name'] = $instansi["nama_instansi"];
		$data['idescription'] = $instansi["description"];
		$data['ikeywords'] = $instansi["keywords"];
		$data['room_name'] = $pegawai["nama_ruangan"];
		$data['iheader'] = $instansi["header"];
		$data['iheader_mini'] = $instansi["header_mini"];
		$data['ifooter'] = $instansi["footer"];
		$data['ilicensed'] = $instansi["licensed"];
		$data['member_id'] = $pegawai["id_pegawai"];
		$data['jabatan_id'] = $pegawai["id_jabatan"];
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
	$data['bln']   = $this->uri->segment(4, 0);
	$data['thn']   = $this->uri->segment(5, 0);
	if(empty($data['bln'])){
		$data['bln'] = date('m');
	}
	if(empty($data['thn'])){
		$data['thn'] = date('Y');
	}
	$data['array_month'] = $this->m_rancak->cmd_bulan();
	$data['array_page'] = array('lt'=>'Tahunan','lb'=>'Bulanan','lh'=>'Harian');
	$data['year_logbook']=$this->m_rancak->cmd_tahun_logbook();
	$data['ambil_kol_golongan_pemeriksaan_graph'] = $this->m_rancak->ambil_kol_golongan_pemeriksaan_graph($pegawai['id_jabatan']);
	$data['json'] = $this->m_profil->lh($data);
	if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$page = $this->input->post("page");
			$bln = $this->input->post("bln");
			$thn = $this->input->post("thn");
			redirect(base_url('pegawai/'.$page.'/view/'.$bln.'/'.$thn));
		}
	}
  }
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("profil/header",$data);
	$this->load->view("profil/isi");
	$this->load->view("footer");
	$this->load->view("profil/jsload");
	$this->load->view("profil/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_top",$data);
	$this->load->view("profil/isi");
	$this->load->view("footer");
	$this->load->view("profil/jsload");
	$this->load->view("profil/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
