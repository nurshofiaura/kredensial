<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Direktur extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
		  $this->login_kah();
          $this->load->model('m_rperawat');
          $this->load->model('m_berkas');
          $this->load->model('m_direktur');
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
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==50 )
          return TRUE;
     else
          redirect(base_url('logout'));
  }
	function index(){
		$data['page']="home";
		$data['header'] = "BERANDA";
		$data['title'] = "BERANDA";
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
		$data['jlm_pegawai']=$this->m_umum->jumlah_record_tabel('pegawai');
		$data['jml_logbook']=$this->m_umum->jumlah_record_tabel('logbook');
		$this->tampil($data);
	}
  function logbook($mode='view')
  {
	$data['page']  = "logbook";
	$data['header'] = "LOGBOOK KEPALA RUANGAN";
	$data['title'] = "LOGBOOK KEPALA RUANGAN";
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$direktur=$this->m_rancak->ambil_direktur();
	$data['nama_direktur'] = $direktur["nama_pegawai"];
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
	$data['cmd_pegawai_null'] = $this->m_direktur->cmd_pegawai_null($pegawai['id_ruangan'],$data['level_id']);
    if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$first_date = $this->input->post("first_date");
			$last_date = $this->input->post("last_date");
			$id = $this->input->post("id");
			redirect(base_url('direktur/logbook/view/'.$first_date.'/'.$last_date.'/'.$id));
		}
	}
    else if($mode=='data'){
		echo json_encode($this->m_direktur->logbook_all($data['first_date'],$data['last_date'],$data['id'],$pegawai['id_ruangan'],$pegawai['id_level']));
	}
  }
    function v_kabid_logbook(){
	$isi   = $this->uri->segment(3, 0);
	$first_date   = $this->uri->segment(4, 0);
	$last_date   = $this->uri->segment(5, 0);
	$idp   = $this->uri->segment(6, 0);
	$kondisi_str=array('id_level >='=>'50','status_user'=>'1');
	$jml= $this->m_umum->jumlah_record_filter('user',$kondisi_str);
	if($jml == 0){
		$this->session->set_flashdata('danger', 'Tidak Ada Data Direktur');
	}else{
		$direktur=$this->m_rancak->ambil_direktur();
		$id_direktur = $direktur["id_pegawai"];
    if($id_direktur == NULL OR empty($id_direktur)){
      $this->session->set_flashdata('danger', 'Tidak Ada Data Direktur');
    }else{
      $this->m_direktur->update_v_kabid_logbook($isi,$first_date,$last_date,$idp,$id_direktur);
  		$this->session->set_flashdata('sukses', 'Data Sudah di Simpan');
    }
	}
	redirect(base_url('direktur/logbook/view/'.$first_date.'/'.$last_date.'/'.$idp));
	}
  function pengajuan_kompetensi($mode='view')
  {
	$data['page']  = "pengajuan_kompetensi";
	$data['header'] = "VALIDASI PENGAJUAN KOMPETENSI";
	$data['title'] = "VALIDASI PENGAJUAN KOMPETENSI";
	$data['link_kembali'] = base_url('direktur');
	$data['link_awal'] = base_url('direktur/pengajuan_kompetensi');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$direktur=$this->m_rancak->ambil_direktur();
	$data['nama_direktur'] = $direktur["nama_pegawai"];
	$data['id_direktur'] = $direktur["id_pegawai"];
	$program    = $this->m_umum->ambil_data('a_program','id_program',$pegawai["id_program"]);
	$program_ppni    = $this->m_umum->ambil_data('a_program','id_program','1');
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
	$data['idp'] = $this->uri->segment(5, 0);
	if(empty($data['id'])){
		$data['id'] = '0';
	}
    if($mode=='view'){
		$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_direktur->pengajuan_kompetensi_all($program['jabatan'],$pegawai['id_level'],$pegawai['id_pegawai']));
	}
    else if($mode=='data2'){
		echo json_encode($this->m_direktur->logbook_all_a_b($data['id']));
	}
    else if($mode=='pemulihan'){
		echo json_encode($this->m_direktur->tabel_pemulihan($data['id']));
	}
  else{
      if($mode=='isi'){
        $data['page'] =  $data['page']."_isi";
				$data['ambil_lobook_kompetensi_group_pengajuan']=$this->m_rancak->ambil_lobook_kompetensi_group_pengajuan($data['id']);
				$data['jml_direktur_0']=$this->m_rancak->jumlah_record_logbook_pengajuan($data['id'],'v_direktur','0');
				$data['jml_direktur']=$this->m_rancak->jumlah_record_logbook_pengajuan($data['id'],'v_direktur >','0');
				$data['jml_karu']=$this->m_rancak->jumlah_record_logbook_pengajuan($data['id'],'v_karu','2');
				$data['jml_kabid']=$this->m_rancak->jumlah_record_logbook_pengajuan($data['id'],'v_kabid','2');
				$data['jml_asesor']=$this->m_rancak->jumlah_record_logbook_pengajuan($data['id'],'v_asesor','2');
				$data['jml_komite']=$this->m_rancak->jumlah_record_logbook_pengajuan($data['id'],'v_komite','2');
				$data['jumlah_record_logbook_pengajuan']=$data['jml_direktur']+$data['jml_karu']+$data['jml_kabid']+$data['jml_asesor']+$data['jml_komite'];
				$kondisi_logbook_pengajuan=array('id_pengajuan'=>$data['id']);
				$data['jml_all_logbook_pengajuan']=$this->m_umum->jumlah_record_filter('logbook',$kondisi_logbook_pengajuan); //all
				if($data['jml_all_logbook_pengajuan'] == $data['jumlah_record_logbook_pengajuan']){
					$data['tampilkan_button'] = 'sama';
				}else{
					$data['tampilkan_button'] = 'taksama';
				}
		$data['ambil_berkas_data']=$this->m_rancak->ambil_all_id_berkas_data();
		$d	=$this->m_rancak->ambil_pengajuan_kompetensi($data['id']);
		$data['id_pengajuan']  = set_value('id_pengajuan',$d["id_pengajuan"]);
		$data['id_status_diusulkan']  = set_value('id_status_diusulkan',$d["id_status_diusulkan"]);
		$data['id_berkas']  = explode(",", $d["id_berkas"]);
		$data['berkas']  = $d["id_berkas"];
		$data['tahun']  = date('Y', strtotime($d["tgl_pengajuan"]));
		$data['id_ijasah']  = explode(",", $d["id_ijasah"]);
		$data['id_str']  = explode(",", $d["id_str"]);
		$data['id_sertifikat']  = explode(",", $d["id_sertifikat"]);
		$data['kesesuaian_bukti']  = set_value('kesesuaian_bukti',explode(",", $d["kesesuaian_bukti"]));
		$data['id_etik_pegawai']  = set_value('id_etik_pegawai',explode(",", $d["id_etik_pegawai"]));
		$data['id_logbook_a']  = set_value('id_logbook_a',$d["id_logbook_a"]);
		$data['id_logbook_b']  = set_value('id_logbook_b',$d["id_logbook_b"]);
		$data['status_pengajuan']  = set_value('status_pengajuan',$d["status_pengajuan"]);
		$data['acc_kabid']  = set_value('acc_kabid',$d["acc_kabid"]);
		$data['acc_asesor']  = set_value('acc_asesor',$d["acc_asesor"]);
		$data['acc_komite']  = set_value('acc_komite',$d["acc_komite"]);
		$data['acc_direktur']  = set_value('acc_direktur',$d["acc_direktur"]);
		$data['acc_logbook_direktur']  = set_value('acc_logbook_direktur',$d["acc_logbook_direktur"]);
		$data['id_pegawai']  = set_value('id_pegawai',$d["id_pegawai"]);
		$data['foto']  = set_value('foto',$d["foto"]);
		$data['nama_pegawai']  = set_value('nama_pegawai',$d["nama_pegawai"]);
		$data['tmp_lahir']  = set_value('tmp_lahir',$d["tmp_lahir"]);
		$data['tgl_lahir']  = set_value('tgl_lahir',$d["tgl_lahir"]);
		$data['nama_agama']  = set_value('nama_agama',$d["nama_agama"]);
		$data['nama_status_kawin']  = set_value('nama_status_kawin',$d["nama_status_kawin"]);
		$data['no_profesi']  = set_value('no_profesi',$d["no_profesi"]);
		$data['nip']  = set_value('nip',$d["nip"]);
		$data['nama_status_diusulkan'] = $d['nama_status_diusulkan'];
		$data['nama_pendidikan'] = $d['nama_pendidikan'];
		$data['no_hp'] = $d['no_hp'];
		$data['email'] = $d['email'];
		$data['nama_status_pegawai'] = $d['nama_status_pegawai'];
		$data['nama_ruangan'] = $d['nama_ruangan'];
		$data['nama_jabatan_fungsional'] = $d['nama_jabatan_fungsional'];
		$data['alamat'] = $d['alamat'];
		$data['ambil_data_etik_pegawai_oppe'] = $this->m_rancak->ambil_data_etik_pegawai_oppe($d['id_pegawai'],date('Y'));
		$this->tampil_top($data);
		$action = $this->input->post('action');
		$id_pengajuan = $this->input->post('id_pengajuan');
		$kondisi_direk=array('id_level >='=>'50','status_user'=>'1');
		$jml_direk= $this->m_umum->jumlah_record_filter('user',$kondisi_direk);
		if($action == 'BtnOke') {
			if($jml_direk == 0){
				$this->session->set_flashdata('danger', 'Tidak Ada Data Direktur');
			}else{
				$this->m_direktur->Kabid_Acc($data['id'],$data['id_direktur']);
				$this->session->set_flashdata('sukses', 'Data Sudah di Simpan');
			}
			redirect(base_url('direktur/pengajuan_kompetensi'));
		}
		if($action == 'BtnTolak') {
			if($jml_direk == 0){
				$this->session->set_flashdata('danger', 'Tidak Ada Data Direktur');
			}else{
				$this->m_direktur->Kabid_Tolak($data['id'],$data['id_direktur']);
				$this->session->set_flashdata('sukses', 'Data Sudah di Simpan');
			}
			redirect(base_url('direktur/pengajuan_kompetensi'));
		}
		if($action == 'BtnProses') {
/* 			$jumlah_logbook_pengajuan = $this->m_direktur->jumlah_logbook_pengajuan($data['id']);
			if($jumlah_logbook_pengajuan == 0){ */
				$this->m_direktur->update_acc_kompetensi_kabid($data['id']);
				$this->session->set_flashdata('sukses', 'Data Sudah di Simpan');
				redirect(base_url('direktur/pengajuan_kompetensi/isi/'.$data['id']));
/* 			}else{
				$this->session->set_flashdata('danger', 'Mohon Validasi Semua Logbook');
				redirect(base_url('direktur/pengajuan_kompetensi/isi/'.$data['id']));
			} */
		}
	  }
      if($mode=='proses_kabid'){
		$this->m_direktur->update_proses_kabid($data['id']);
		$this->session->set_flashdata('sukses', 'Data Pengajuan Sekarang Proses');
		redirect(base_url('direktur/pengajuan_kompetensi'));
      }
      if($mode=='terbitkan'){
		$this->m_direktur->update_terbitkan($data['id'],$data['idp']);
		$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
		redirect(base_url('direktur/pengajuan_kompetensi'));
      }
      if($mode=='kelengkapan'){
        $data['page'] =  $data['page']."_kelengkapan";
		$data['cmd_ambil_direktur'] = $this->m_rancak->cmd_ambil_direktur();
		$kondisi_lampiran=array('id_pengajuan'=>$data['id']);
		$jml_lampiran = $this->m_umum->jumlah_record_filter('kr_pengajuan_report',$kondisi_lampiran);
		if($jml_lampiran == 0){
			$data['lampiran']  = set_value('lampiran',$this->input->post("lampiran"));
			$data['nomor']  = set_value('nomor',$this->input->post("nomor"));
			$data['tgl_nomor']  = set_value('tgl_nomor',date('d-m-Y'));
			$data['tentang']  = set_value('tentang',$this->input->post("tentang"));
			$data['kategori_kewenangan']  = set_value('kategori_kewenangan',$this->input->post("kategori_kewenangan"));
			$data['kewenangan_klinis']  = set_value('kewenangan_klinis',$this->input->post("kewenangan_klinis"));
			$data['ditetapkan']  = set_value('ditetapkan',$this->input->post("ditetapkan"));
			$data['id_direktur']  = set_value('id_direktur',$this->input->post("id_direktur"));
			$data['pangkat']  = set_value('pangkat',$this->input->post("pangkat"));
			$data['tgl_ditetapkan']  = set_value('tgl_ditetapkan',date('d-m-Y'));
		}else{
			$kr_pengajuan_report = $this->m_umum->ambil_data('kr_pengajuan_report','id_pengajuan',$data['id']);
			$data['lampiran'] = $kr_pengajuan_report['lampiran'];
			$data['nomor'] = $kr_pengajuan_report['nomor'];
			$data['tentang'] = $kr_pengajuan_report['tentang'];
			$data['kategori_kewenangan'] = $kr_pengajuan_report['kategori_kewenangan'];
			$data['kewenangan_klinis'] = $kr_pengajuan_report['kewenangan_klinis'];
			$data['ditetapkan'] = $kr_pengajuan_report['ditetapkan'];
			$data['id_direktur'] = $kr_pengajuan_report['id_direktur'];
			$data['pangkat'] = $kr_pengajuan_report['pangkat'];
			$data['tgl_nomor'] = date('d-m-Y', strtotime($kr_pengajuan_report['tgl_nomor']));
			$data['tgl_ditetapkan'] = date('d-m-Y', strtotime($kr_pengajuan_report['tgl_ditetapkan']));
		}
		$this->form_validation->set_rules('id_pengajuan','id_pengajuan','required');
        if ($this->form_validation->run() === FALSE){
			$this->tampil($data);
        }else{
			$id_pengajuan= $this->input->post('id_pengajuan');
			$kondisi_lampir=array('id_pengajuan'=>$id_pengajuan);
			$jml_lampir = $this->m_umum->jumlah_record_filter('kr_pengajuan_report',$kondisi_lampir);
			if($jml_lampiran == 0){
				$this->m_direktur->simpan_kr_pengajuan_report();
			}else{
				$this->m_direktur->edit_kr_pengajuan_report();
			}
			$this->session->set_flashdata('sukses', 'Data Sudah Dilengkapi Silahkan Print Penugasan Klinis');
			redirect(base_url('direktur/pengajuan_kompetensi'));
        }
      }
    if($mode=='lihat_pemulihan'){
      $data['page'] =  $data['page']."_lihat_pemulihan";
      $data['ambil_lobook_pemulihan_detil']=$this->m_rancak->ambil_kewenangan_lobook_pemulihan_detil2($data['id']);
      $this->load->view("direktur/isi",$data);
    }
    if($mode=='lihat_kegiatan'){
      $data['page'] =  $data['page']."_lihat_kegiatan";
      $data['ambil_lobook_pemulihan_detil']=$this->m_rancak->ambil_kewenangan_lobook_kegiatan_pemulihan_detil($data['id']);
      $this->load->view("direktur/isi",$data);
    }
		if($mode=='pdf'){
		  $report = $this->load->view('cetak/penugasan_klinis', $data, TRUE);
		  $apk	=$this->m_rancak->ambil_pengajuan_kompetensi($data['id']);
		  $filename = "Penugasan_klinis-".$apk['nama_pegawai'].".pdf";
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
		  $mpdf->AddPage('P', '', '', '', 2, 25, 5, 5, 10, 3, 3);
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
   function v_kabid_kompetensi(){
		$isi   = $this->uri->segment(3, 0);
		$tolak   = $this->uri->segment(4, 0);
		$id   = $this->uri->segment(5, 0); // id_kewenangan_detil
		$id_pengajuan   = $this->uri->segment(6, 0);
		$idlb   = $this->uri->segment(7, 0); // id_logbook
		$d    = $this->m_umum->ambil_data('kr_pengajuan','id_pengajuan',$id_pengajuan);
		$kondisi_str=array('id_level >='=>'50','status_user'=>'1');
		$jml= $this->m_umum->jumlah_record_filter('user',$kondisi_str);
		if($jml == 0){
			$this->session->set_flashdata('danger', 'Tidak Ada Data Direktur');
		}else{
			if($d['acc_logbook_direktur']=='0'){
					$direktur=$this->m_rancak->ambil_direktur();
					$id_direktur = $direktur["id_pegawai"];
					$this->m_direktur->update_v_kabid_kompetensi($isi,$id,$id_pegawai,$id_direktur,$id_pengajuan,$d['id_status_diusulkan']);
			}
		}
		redirect(base_url('direktur/pengajuan_kompetensi/isi/'.$id_pengajuan));
   }
   function v_kabid_kompetensi_all(){
	$isi   = $this->uri->segment(3, 0);
	$id_pengajuan   = $this->uri->segment(4, 0);
	$d    = $this->m_umum->ambil_data('kr_pengajuan','id_pengajuan',$id_pengajuan);
	$data['acc_logbook_direktur'] = $d['acc_logbook_direktur'];
	$id_pegawai = $d['id_pegawai'];
	$kondisi_str=array('id_level >='=>'50','status_user'=>'1');
	$jml= $this->m_umum->jumlah_record_filter('user',$kondisi_str);
	if($jml == 0){
		$this->session->set_flashdata('danger', 'Tidak Ada Data Direktur');
	}else{
		$direktur=$this->m_rancak->ambil_direktur();
		$id_direktur = $direktur["id_pegawai"];
		$this->m_direktur->update_v_kabid_kompetensi_all($isi,$id_pegawai,$id_direktur,$id_pengajuan,$d['id_status_diusulkan']);
		$this->session->set_flashdata('sukses', 'Data Sudah di Simpan');
	}
	redirect(base_url('direktur/pengajuan_kompetensi/isi/'.$id_pengajuan));
   }
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("direktur/header",$data);
	$this->load->view("direktur/isi");
	$this->load->view("footer");
	$this->load->view("direktur/jsload");
	$this->load->view("direktur/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_top",$data);
	$this->load->view("direktur/isi");
	$this->load->view("footer");
	$this->load->view("direktur/jsload");
	$this->load->view("direktur/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
