<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Karu extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
          $this->load->model('m_ol_rancak');
          $this->load->model('m_karu');
           $this->load->model('m_auth');
          $this->m_auth->login_kah();
  }
	function index(){
		$data['page']="home";
		$data['header'] = "BERANDA";
		$data['title'] = "BERANDA";
    $pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
  //  $program = $this->m_umum->ambil_data('a_program','id_program',32);
    $instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
    $stpeg = $this->m_umum->ambil_data('a_online','kode_online','ol_status_pegawai');
    $jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
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
		$this->tampil($data);
	}
	function grafik(){
		$data['page']="grafik";
		$data['header'] = "GRAFIK POIN PEGAWAI";
		$data['title'] = "GRAFIK POIN PEGAWAI";
		$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
		$program    = $this->m_umum->ambil_data('a_program','id_program','1');
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
		$data['room_id'] = $pegawai["id_ruangan"];
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
		$data['array_month'] = $this->m_rancak->cmd_bulan();
		$data['year_logbook']=$this->m_rancak->cmd_tahun_logbook();
		$data['cmd_pegawai_karu_null']=$this->m_rancak->cmd_pegawai_karu_null($pegawai['id_ruangan'],$pegawai['id_level']);
		$data['bln']   = $this->uri->segment(4, 0);
		$data['thn']   = $this->uri->segment(5, 0);
		if(empty($data['bln'])){
			$data['bln'] = date('m');
		}
		if(empty($data['thn'])){
			$data['thn'] = date('Y');
		}
		$data['json'] = $this->m_karu->lb($data);
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$page = $this->input->post("page");
			$bln = date('m');
			$thn = $this->input->post("thn");
			redirect(base_url('karu/grafik/view/'.$bln.'/'.$thn));
		}
	}
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
  function user($mode='view')
  {
	$data['page']  = "user";
	$data['header'] = "USER";
	$data['title'] = "USER";
	$data['link_kembali'] = base_url();
	$data['link_awal'] = base_url('karu');
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
		echo json_encode($this->m_karu->user_all($pegawai['id_ruangan'],$data['level_id']));
	}
  else{
		$data['cmd_tipe_pegawai'] = $this->m_rancak->cmd_tipe_pegawai();
		$data['status'] = $this->m_rancak->cmd_status();
		$data['gender'] = $this->m_rancak->cmd_jk();
		$data['level'] = $this->m_rancak->cmd_level_program($data['program_user_level'],$data['level_id']);
		$data['unit'] = $this->m_rancak->cmd_unit();
		$data['cmd_ruangan'] = $this->m_rancak->cmd_ruangan();
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
		$data['title'] = "EDIT USER";
		$take = $this->m_rancak->ambil_barcode_user_pegawai($data['id']);
		$data['id_user']  = set_value('id_user',$take['id_user']);
		$data['id_pegawai']  = set_value('id_pegawai',$take['id_pegawai']);
		$data['nama_pegawai']  = set_value('nama_pegawai',$take['nama_pegawai']);
		$data['email']  = set_value('email',$take['email']);
		$data['username']  = set_value('username',$this->input->post("username"));
		$data['username_lama']  = set_value('username_lama',$take['username']);
		$data['password']  = set_value('password',$take['password']);
		$data['password_lama']  = set_value('password_lama',$take['password']);
		$data['id_level']  = set_value('id_level',$take['id_level']);
		$data['no_hp']  = set_value('no_hp',$take['no_hp']);
		$data['id_unit']  = set_value('id_unit',$take['id_unit']);
		$data['id_ruangan']  = set_value('id_ruangan',$take['id_ruangan']);
		$data['jk']  = set_value('jk',$take['jk']);
		$data['status_user']  = set_value('status_user',$take['status_user']);
		$data['foto']  = set_value('foto',$take['foto']);
		$data['tipe_pegawai']  = set_value('tipe_pegawai',$take['tipe_pegawai']);
		$this->form_validation->set_rules('nama_pegawai','nama_pegawai','required');
        if ($this->form_validation->run() === FALSE){
			$this->tampil_top($data);
        }else{
		  if($this->m_karu->edit_pegawai_no_pic()){
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
			redirect(base_url('karu/user'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
			redirect(base_url('karu/user'));
		  }
        }
      }
		if($mode=='reset'){
			$d = $this->m_rancak->ambil_user_pegawai($data['id']);
			$no_hp = $d['no_hp'];
			$nama_pegawai = $d['nama_pegawai'];
			$nama_level = $d['nama_level'];
			$id_user = $this->session->id_user;
			if($d['id_level'] == '99'){
				$this->session->set_flashdata('danger', 'Tidak dapat mereset Superadmin');
				redirect(base_url('karu/user'));
			}else{
			  if($this->m_karu->reset_password($data['id'])){
				$tansi = $this->m_umum->ambil_data('a_instansi','id_instansi','1');
				$instance_name = $tansi["nama_instansi"];
				$wa = $tansi["wa"];
				if($wa =='1'){
				$ptn = "/^0/";
				$rpltxt = "62";  // Replacement string
				$no_hp = preg_replace($ptn, $rpltxt, $no_hp);
					$br = "\n";
					$message = "*".$instance_name."*";
					$message .= $br. $br."SELAMAT AKUN ANDA BERHASIL DI RESET";
					$message .= $br."📜 Data Anda";
					$message .= $br. "Nama : " . $nama_pegawai;
					$message .= $br. "No HP : " . $no_hp;
					$message .= $br. "Hak Akses : " . $nama_level;
					$message .= $br. "Password : 7654321";
					$this->m_umum->kirim_wageblast($message,$no_hp);
				}
				$pesan = "RESET AKUN ADMIN ID/NAMA : ".$data['id']." - ".$nama_pegawai;
//				$this->m_rancak->simpan_log_wa($no_hp,$id_user,$pesan);
				$this->session->set_flashdata('sukses', 'Password di Reset menjadi 7654321');
				redirect(base_url('karu/user'));
			  }else{
					$this->session->set_flashdata('danger', 'Masalah Edit Data');
					redirect(base_url('karu/user'));
			  }
			}
		}
	}
  }
  function etik($mode='view')
  {
	$data['page']  = "etik";
	$data['header'] = "ETIK PEGAWAI";
	$data['title'] = "ETIK PEGAWAI";
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
	if(empty($data['id'])){
		$data['id'] = '0';
	}
  $leveleku = $this->session->id_level;
  if($leveleku == 99){
     $data['cmd_pegawai_null'] = $this->m_rancak->cmd_pegawai_null_pemulihan2();
  }elseif ($leveleku == 98) {
	   $data['cmd_pegawai_null'] = $this->m_rancak->cmd_pegawai_null_pemulihan3();
  }
  else{
	   $data['cmd_pegawai_null'] = $this->m_karu->cmd_pegawai_null($pegawai['id_ruangan'],$data['level_id']);
  }
    if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$id = $this->input->post("id");
			redirect(base_url('karu/etik/view/'.$id));
		}
	}
    else if($mode=='data'){
		echo json_encode($this->m_karu->etik_pegawai_all($pegawai['id_ruangan'],$data['id'],$pegawai['id_level']));
	}
  else{
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		if(empty($data['id'])){
			$this->session->set_flashdata('danger', 'Pilih Pegawai Dahulu');
			redirect(base_url('karu/etik'));
		}
		$cek_pegawai=$this->m_rancak->ambil_pegawai($data['id']);
		$data['kol_etik_all']   = $this->m_karu->kol_etik_all($cek_pegawai['id_jabatan']);
		$data['num_kol_etik_all']   = $this->m_karu->num_kol_etik_all($cek_pegawai['id_jabatan']);
		$this->form_validation->set_rules('id_pegawai','id_pegawai','required');
        if ($this->form_validation->run() === FALSE){
			$this->tampil($data);
        }else{
			$last_ide = $this->m_karu->simpan_etik_pegawai();
			$this->m_karu->simpan_etik_pegawai_detil($last_ide);
			redirect(base_url('karu/etik'));

        }
      }
      if($mode=='lihat'){
        $data['page'] =  $data['page']."_lihat";
		$cek_pegawai=$this->m_rancak->ambil_pegawai($data['id']);
		$data['kol_etik_detil_all']   = $this->m_karu->kol_etik_detil_all($data['id']);
		$data['etik_pegawairow_all']   = $this->m_karu->etik_pegawairow_all($data['id']);
		$data['num_kol_etik_all']   = $this->m_karu->num_kol_etik_all($cek_pegawai['id_jabatan']);
		$this->tampil($data);
      }
	}
  }
  function logbook($mode='view')
  {
	$data['page']  = "logbook";
	$data['header'] = "LOGBOOK PEGAWAI";
	$data['title'] = "LOGBOOK PEGAWAI";
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
	$data['first_date'] = $this->uri->segment(4, 0);
	$data['last_date'] = $this->uri->segment(5, 0);
	$data['id'] = $this->uri->segment(6, 0);
	$isi = $this->uri->segment(7, 0);
	$id_logbook = $this->uri->segment(8, 0);
	if(empty($data['first_date'])){
		$data['first_date'] = '01-'.date('m-Y');
	}
	if(empty($data['last_date'])){
		$data['last_date'] = date('d-m-Y');
	}
	if(empty($data['id'])){
		$data['id'] = '0';
	}
	$data['cmd_pegawai_null'] = $this->m_karu->cmd_pegawai_null($pegawai['id_ruangan'],$data['level_id']);
    if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$first_date = $this->input->post("first_date");
			$last_date = $this->input->post("last_date");
			$id = $this->input->post("id");
			redirect(base_url('karu/logbook/view/'.$first_date.'/'.$last_date.'/'.$id));
		}
	}
    else if($mode=='data'){
		echo json_encode($this->m_karu->logbook_all($data['first_date'],$data['last_date'],$data['id'],$pegawai['id_ruangan'],$pegawai['id_level']));
	}
  else{
      if($mode=='v_karu'){
			$unit_karu = $pegawai['id_ruangan'];
			$id_karu = $pegawai['id_pegawai'];
			$perawate=$this->m_umum->ambil_data('pegawai','id_pegawai',$data['id']);
			$unit_perawat = $perawate['id_ruangan'];
			$id_perawat = $perawate['id_pegawai'];
			if($unit_karu == $unit_perawat){
				if($id_karu !== $id_perawat){
					$kondisi=array('id_logbook'=>$id_logbook,'v_kabid'=>'0','v_asesor'=>'0','v_komite'=>'0','v_direktur'=>'0','id_pengajuan'=>'0');
					$jml = $this->m_umum->jumlah_record_filter('logbook',$kondisi);
		//			if($jml > 0){
		//				$this->session->set_flashdata('danger', 'Data Sudah Di Validasi / Dalam Tahap Pengajuan');
		//			}
		//			else{
						$this->m_karu->update_v_karu($isi,$id_logbook,$pegawai['id_pegawai']);
		//			}
				}
			}
			redirect(base_url('karu/logbook/view/'.$data['first_date'].'/'.$data['last_date'].'/'.$data['id']));
      }
      if($mode=='v_karu_all'){
			$unit_karu = $pegawai['id_ruangan'];
			$id_karu = $pegawai['id_pegawai'];
			$perawate=$this->m_umum->ambil_data('pegawai','id_pegawai',$data['id']);
			$unit_perawat = $perawate['id_ruangan'];
			$id_perawat = $perawate['id_pegawai'];
			if($unit_karu == $unit_perawat){
				if($id_karu !== $id_perawat){
					$kondisi=array('id_logbook'=>$data['id'],'v_kabid'=>'0','v_asesor'=>'0','v_komite'=>'0','v_direktur'=>'0');
					$jml = $this->m_umum->jumlah_record_filter('logbook',$kondisi);
	//				if($jml >= 1){
						$this->m_karu->update_v_karu_all($isi,$data['first_date'],$data['last_date'],$data['id'],$pegawai['id_pegawai']);
	//				}
				}
			}
			redirect(base_url('karu/logbook/view/'.$data['first_date'].'/'.$data['last_date'].'/'.$data['id']));
      }
	}
  }
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("karu/header",$data);
	$this->load->view("karu/isi");
	$this->load->view("footer");
	$this->load->view("karu/jsload");
	$this->load->view("karu/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_top",$data);
	$this->load->view("karu/isi");
	$this->load->view("footer");
	$this->load->view("karu/jsload");
	$this->load->view("karu/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
