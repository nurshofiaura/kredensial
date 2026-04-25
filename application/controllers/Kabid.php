<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Kabid extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
		  $this->login_kah();
          $this->load->model('m_rperawat');
          $this->load->model('m_berkas');
          $this->load->model('m_kabid');
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
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==15 ) //karu
          return TRUE;
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==18 ) //karu
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
		$data['ambil_pengumuman']   = $this->m_rancak->ambil_pengumuman($pegawai['id_jabatan'],$pegawai['id_level'],$program['jabatan']);
		$data['ambil_berkas_expired_all']=$this->m_rancak->ambil_berkas_expired_all();
		$this->tampil($data);
	}
  function logbook($mode='view')
  {
	$data['page']  = "logbook";
	$data['header'] = "LOGBOOK KEPALA RUANGAN";
	$data['title'] = "LOGBOOK KEPALA RUANGAN";
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
	$data['cmd_pegawai_null'] = $this->m_kabid->cmd_pegawai_null($pegawai['id_ruangan'],$data['level_id']);
    if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$first_date = $this->input->post("first_date");
			$last_date = $this->input->post("last_date");
			$id = $this->input->post("id");
			redirect(base_url('kabid/logbook/view/'.$first_date.'/'.$last_date.'/'.$id));
		}
	}
    else if($mode=='data'){
		echo json_encode($this->m_kabid->logbook_all($data['first_date'],$data['last_date'],$data['id'],$pegawai['id_ruangan'],$pegawai['id_level']));
	}
  else{
      if($mode=='v_karu'){
			$unit_karu = $pegawai['id_ruangan'];
			$id_karu = $pegawai['id_pegawai'];
			$perawate=$this->m_umum->ambil_data('pegawai','id_pegawai',$data['id']);
			$unit_perawat = $perawate['id_ruangan'];
			$id_perawat = $perawate['id_pegawai'];
		//	if($unit_karu == $unit_perawat){
				if($id_karu !== $id_perawat){
				//	$kondisi=array('id_logbook'=>$data['id'],'v_asesor'=>'0','v_komite'=>'0','v_direktur'=>'0');
				//	$jml = $this->m_umum->jumlah_record_filter('logbook',$kondisi);
				//	if($jml >= 1){
						$this->m_kabid->update_v_karu($isi,$data['first_date'],$data['last_date'],$data['id'],$id_logbook,$pegawai['id_pegawai']);
				//	}
				}
		//	}
			redirect(base_url('kabid/logbook/view/'.$data['first_date'].'/'.$data['last_date'].'/'.$data['id']));
      }
      if($mode=='v_karu_all'){
			$unit_karu = $pegawai['id_ruangan'];
			$id_karu = $pegawai['id_pegawai'];
			$perawate=$this->m_umum->ambil_data('pegawai','id_pegawai',$data['id']);
			$unit_perawat = $perawate['id_ruangan'];
			$id_perawat = $perawate['id_pegawai'];
		//	if($unit_karu == $unit_perawat){
				if($id_karu !== $id_perawat){
				//	$kondisi=array('id_logbook'=>$data['id'],'v_kabid'=>'0','v_asesor'=>'0','v_komite'=>'0','v_direktur'=>'0');
				//	$jml = $this->m_umum->jumlah_record_filter('logbook',$kondisi);
				//	if($jml >= 1){
						$this->m_kabid->update_v_karu_all($isi,$data['first_date'],$data['last_date'],$data['id'],$pegawai['id_pegawai']);
				//	}
				}
		//	}
			redirect(base_url('kabid/logbook/view/'.$data['first_date'].'/'.$data['last_date'].'/'.$data['id']));
      }
      if($mode=='v_kabid'){
			$unit_karu = $pegawai['id_ruangan'];
			$id_karu = $pegawai['id_pegawai'];
			$perawate=$this->m_umum->ambil_data('pegawai','id_pegawai',$data['id']);
			$unit_perawat = $perawate['id_ruangan'];
			$id_perawat = $perawate['id_pegawai'];
		//	if($unit_karu == $unit_perawat){
				if($id_karu !== $id_perawat){
				//	$kondisi=array('id_logbook'=>$data['id'],'v_asesor'=>'0','v_komite'=>'0','v_direktur'=>'0');
				//	$jml = $this->m_umum->jumlah_record_filter('logbook',$kondisi);
				//	if($jml >= 1){
						$this->m_kabid->update_v_kabid($isi,$data['first_date'],$data['last_date'],$data['id'],$id_logbook,$pegawai['id_pegawai']);
				//	}
				}
		//	}
			redirect(base_url('kabid/logbook/view/'.$data['first_date'].'/'.$data['last_date'].'/'.$data['id']));
      }
      if($mode=='v_kabid_all'){
			$unit_karu = $pegawai['id_ruangan'];
			$id_karu = $pegawai['id_pegawai'];
			$perawate=$this->m_umum->ambil_data('pegawai','id_pegawai',$data['id']);
			$unit_perawat = $perawate['id_ruangan'];
			$id_perawat = $perawate['id_pegawai'];
		//	if($unit_karu == $unit_perawat){
				if($id_karu !== $id_perawat){
				//	$kondisi=array('id_logbook'=>$data['id'],'v_kabid'=>'0','v_asesor'=>'0','v_komite'=>'0','v_direktur'=>'0');
				//	$jml = $this->m_umum->jumlah_record_filter('logbook',$kondisi);
				//	if($jml >= 1){
						$this->m_kabid->update_v_kabid_all($isi,$data['first_date'],$data['last_date'],$data['id'],$pegawai['id_pegawai']);
				//	}
				}
		//	}
			redirect(base_url('kabid/logbook/view/'.$data['first_date'].'/'.$data['last_date'].'/'.$data['id']));
      }
	}
  }
  function etik($mode='view')
  {
	$data['page']  = "etik";
	$data['header'] = "ETIK KEPALA RUANGAN";
	$data['title'] = "ETIK KEPALA RUANGAN";
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
	$data['cmd_pegawai_null'] = $this->m_kabid->cmd_pegawai_null($pegawai['id_ruangan'],$data['level_id']);
    if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$id = $this->input->post("id");
			redirect(base_url('kabid/etik/view/'.$id));
		}
	}
    else if($mode=='data'){
		echo json_encode($this->m_kabid->etik_pegawai_all($pegawai['id_ruangan'],$data['id'],$pegawai['id_level']));
	}
  else{
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		if(empty($data['id'])){
			$this->session->set_flashdata('danger', 'Pilih Pegawai Dahulu');
			redirect(base_url('kabid/etik'));
		}
		$cek_pegawai=$this->m_rancak->ambil_pegawai($data['id']);
		$data['kol_etik_all']   = $this->m_kabid->kol_etik_all($cek_pegawai['id_jabatan']);
		$data['num_kol_etik_all']   = $this->m_kabid->num_kol_etik_all($cek_pegawai['id_jabatan']);
		$this->form_validation->set_rules('id_pegawai','id_pegawai','required');
        if ($this->form_validation->run() === FALSE){
			$this->tampil($data);
        }else{
			$last_ide = $this->m_kabid->simpan_etik_pegawai();
			$this->m_kabid->simpan_etik_pegawai_detil($last_ide);
			redirect(base_url('kabid/etik'));

        }
      }
      if($mode=='lihat'){
        $data['page'] =  $data['page']."_lihat";
		$cek_pegawai=$this->m_rancak->ambil_pegawai($data['id']);
		$data['kol_etik_detil_all']   = $this->m_kabid->kol_etik_detil_all($data['id']);
		$data['etik_pegawairow_all']   = $this->m_kabid->etik_pegawairow_all($data['id']);
		$data['num_kol_etik_all']   = $this->m_kabid->num_kol_etik_all($cek_pegawai['id_jabatan']);
		$this->tampil($data);
      }
	}
  }
  function pengajuan_kompetensi($mode='view')
  {
	$data['page']  = "pengajuan_kompetensi";
	$data['header'] = "VALIDASI PENGAJUAN KOMPETENSI";
	$data['title'] = "VALIDASI PENGAJUAN KOMPETENSI";
	$data['link_kembali'] = base_url('kabid');
	$data['link_awal'] = base_url('kabid/pengajuan_kompetensi');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
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
	$data['cmd_pegawai_null'] = $this->m_rancak->cmd_pegawai_null($program['jabatan'],$data['level_id']);
    if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$id = $this->input->post("id");
			redirect(base_url('kabid/pengajuan_kompetensi/view/'.$id));
		}
	}
    else if($mode=='data'){
		echo json_encode($this->m_kabid->pengajuan_kompetensi_all($program['jabatan'],$pegawai['id_level']));
	}
    else if($mode=='data2'){
		echo json_encode($this->m_kabid->logbook_all_a_b($data['id']));
	}
    else if($mode=='data3'){
		echo json_encode($this->m_kabid->pegawai_asesor());
	}
    else if($mode=='tabel'){
		echo json_encode($this->m_kabid->grafik_logbook($data['id']));
	}
  else{
      if($mode=='isi'){
        $data['page'] =  $data['page']."_isi";
				$data['ambil_berkas_data']=$this->m_rancak->ambil_all_id_berkas_data();
				$data['ambil_lobook_kompetensi_group_pengajuan']=$this->m_rancak->ambil_lobook_kompetensi_group_pengajuan($data['id']);
				$data['jml_kabid_0']=$this->m_rancak->jumlah_record_logbook_pengajuan($data['id'],'v_kabid','0');
				$data['jml_kabid']=$this->m_rancak->jumlah_record_logbook_pengajuan($data['id'],'v_kabid >','0');
				$data['jml_karu']=$this->m_rancak->jumlah_record_logbook_pengajuan($data['id'],'v_karu','2');
				$data['jumlah_record_logbook_pengajuan']=$data['jml_kabid']+$data['jml_karu'];
				$kondisi_logbook_pengajuan=array('id_pengajuan'=>$data['id']);
				$data['jml_all_logbook_pengajuan']=$this->m_umum->jumlah_record_filter('logbook',$kondisi_logbook_pengajuan);
				if($data['jml_all_logbook_pengajuan'] == $data['jumlah_record_logbook_pengajuan']){
					$data['tampilkan_button'] = 'sama';
				}else{
					$data['tampilkan_button'] = 'taksama';
				}
				$d	=$this->m_rancak->ambil_pengajuan_kompetensi($data['id']);
				$jabfungnyae=$this->m_rancak->ambil_pegawai($d['id_pegawai']);
				$kondisi_jml_jabfunge=array('id_pegawai'=>$jabfungnyae['id_pegawai']);
				if($this->session->id_level !== '99'){
				$jml_jabfunge=$this->m_umum->jumlah_record_filter_array('pegawai',$kondisi_jml_jabfunge,'id_jabatan_fungsional',$program_ppni['jabatan_fungsional']);
				if($jml_jabfunge == 0){
					$this->session->set_flashdata('danger', 'Beda Jabatan Fungsional');
					redirect(base_url('kabid/pengajuan_kompetensi'));
				}
			  }
				$data['id_pengajuan']  = set_value('id_pengajuan',$d["id_pengajuan"]);
				$data['id_status_diusulkan']  = set_value('id_status_diusulkan',$d["id_status_diusulkan"]);
				$data['id_berkas']  = explode(",", $d["id_berkas"]);
				$data['berkas']  = $d["id_berkas"];
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
				$data['acc_logbook_kabid']  = set_value('acc_logbook_kabid',$d["acc_logbook_kabid"]);
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
				if($action == 'BtnOke') {
					$this->m_kabid->Kabid_Acc($data['id'],$pegawai['id_pegawai']);
					$this->session->set_flashdata('sukses', 'Data Sudah di Simpan');
					redirect(base_url('kabid/pengajuan_kompetensi'));
				}
				if($action == 'BtnTolak') {
					$this->m_kabid->Kabid_Tolak($data['id'],$pegawai['id_pegawai']);
					$this->session->set_flashdata('sukses', 'Data Sudah di Simpan');
					redirect(base_url('kabid/pengajuan_kompetensi'));
				}
				if($action == 'BtnProses') {
		/* 			$jumlah_logbook_pengajuan = $this->m_kabid->jumlah_logbook_pengajuan($data['id']);
					if($jumlah_logbook_pengajuan == 0){ */
						$this->m_kabid->update_acc_kompetensi_kabid($data['id']);
						$this->session->set_flashdata('sukses', 'Data Sudah di Simpan');
						redirect(base_url('kabid/pengajuan_kompetensi/isi/'.$data['id']));
		/* 			}else{
						$this->session->set_flashdata('danger', 'Mohon Validasi Semua Logbook');
						redirect(base_url('kabid/pengajuan_kompetensi/isi/'.$data['id']));
					} */
				}
	  }
      if($mode=='histori'){
        $data['page'] =  $data['page']."_histori";
		$apk	=$this->m_rancak->ambil_pengajuan_kompetensi($data['id']);
		$data['ambil_asesor'] = $this->m_rancak->ambil_asesor($apk['id_pegawai']);
		$this->load->view("kabid/isi",$data);
      }
      if($mode=='asesor'){
        $data['page'] =  $data['page']."_asesor";
		$this->tampil($data);
      }
      if($mode=='simpan_asesor'){
		$this->m_kabid->update_pengajuan_asesor($data['idp'],$data['id']);
		$this->session->set_flashdata('sukses', 'Data Sudah di Simpan');
		redirect(base_url('kabid/pengajuan_kompetensi'));
      }
      if($mode=='perbaiki'){
		$this->m_kabid->perbaiki_proses_kabid($data['id']);
		$this->session->set_flashdata('sukses', 'Data Pengajuan Sekarang Proses');
		redirect(base_url('kabid/pengajuan_kompetensi'));
      }
      if($mode=='proses_kabid'){
		$this->m_kabid->update_proses_kabid($data['id']);
		$this->session->set_flashdata('sukses', 'Data Pengajuan Sekarang Proses');
		redirect(base_url('kabid/pengajuan_kompetensi'));
      }
	}
  }
   function v_kabid_kompetensi(){
	$isi   = $this->uri->segment(3, 0);
	$tolak   = $this->uri->segment(4, 0);
	$id   = $this->uri->segment(5, 0);
	$id_pengajuan   = $this->uri->segment(6, 0);
	$d    = $this->m_umum->ambil_data('kr_pengajuan','id_pengajuan',$id_pengajuan);
	$kondisi_cek=array('id_pegawai'=>$d['id_pegawai'],'id_level'=>'19');
	$ceklevel =$this->m_umum->jumlah_record_filter('user',$kondisi_cek);
	if($ceklevel > 0){
		$level= '19';
	}else{
		$level= '0';
	}
	$data['acc_logbook_kabid'] = $d['acc_logbook_kabid'];
	$a = $d['id_logbook_a'];
	$b = $d['id_logbook_b'];
	$id_pegawai = $d['id_pegawai'];
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$id_karu = $pegawai['id_pegawai'];
	$perawate=$this->m_umum->ambil_data('pegawai','id_pegawai',$id_pegawai);
	$id_perawat = $perawate['id_pegawai'];
	if($data['acc_logbook_kabid']=='0'){
		if($id_karu != $id_perawat){
			$this->m_kabid->update_v_kabid_kompetensi($isi,$tolak,$id,$a,$b,$id_pegawai,$id_karu,$id_pengajuan);
		}
	}
	redirect(base_url('kabid/pengajuan_kompetensi/isi/'.$id_pengajuan));
   }
   function v_kabid_kompetensi_all(){
	$isi   = $this->uri->segment(3, 0);
	$id_pengajuan   = $this->uri->segment(4, 0);
	$d    = $this->m_umum->ambil_data('kr_pengajuan','id_pengajuan',$id_pengajuan);
	$a = $d['id_logbook_a'];
	$b = $d['id_logbook_b'];
	$id_pegawai = $d['id_pegawai'];
	$kondisi_cek=array('id_pegawai'=>$d['id_pegawai'],'id_level'=>'19');
	$ceklevel =$this->m_umum->jumlah_record_filter('user',$kondisi_cek);
	if($ceklevel > 0){
		$level= '19';
	}else{
		$level= '0';
	}
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$id_karu = $pegawai['id_pegawai'];
	$perawate=$this->m_umum->ambil_data('pegawai','id_pegawai',$id_pegawai);
	$id_perawat = $perawate['id_pegawai'];
	$data['acc_logbook_kabid'] = $d['acc_logbook_kabid'];
	if ($data['acc_logbook_kabid']=='0'){
		if($id_karu !== $id_perawat){
			$this->m_kabid->update_v_kabid_all_kompetensi($isi,$a,$b,$id_pegawai,$id_karu,$id_pengajuan);
		}
	}
	redirect(base_url('kabid/pengajuan_kompetensi/isi/'.$id_pengajuan));
   }
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("kabid/header",$data);
	$this->load->view("kabid/isi");
	$this->load->view("footer");
	$this->load->view("kabid/jsload");
	$this->load->view("kabid/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_top",$data);
	$this->load->view("kabid/isi");
	$this->load->view("footer");
	$this->load->view("kabid/jsload");
	$this->load->view("kabid/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
