<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Administrator extends CI_controller
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
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==1 ) //administrator
          return TRUE;
     else
          redirect(base_url('logout'));
  }
  function index(){
    $data['page']="home";
	$data['header'] = "BERANDA";
	$data['title'] = "BERANDA";

	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
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
    $this->tampil($data);
  }
  // ================================================ CODE ==================================
  function kurs($mode='view')
  {
	$data['page']  = "kurs";
	$data['header'] = "MATA UANG";
	$data['title'] = "MATA UANG";

	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
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
	$data['id']   = $this->uri->segment(4, 0);
	//======================= IMPORTANT ======================================
    if($mode=='view'){
	$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_administrator->kurs_all());
	}
	else{
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		$data['nama_mata_uang']  = set_value('nama_mata_uang',$this->input->post("nama_mata_uang"));
		$data['kode_mata_uang']  = set_value('kode_mata_uang',$this->input->post("kode_mata_uang"));
		$data['simbol_mata_uang']  = set_value('simbol_mata_uang',$this->input->post("simbol_mata_uang"));
		$this->load->view("administrator/isi",$data);
      }
      if($mode=='simpan_tambah'){
		  if($this->m_administrator->simpan_mata_uang()){
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
			redirect(base_url('administrator/kurs'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
			redirect(base_url('administrator/kurs'));
		  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
		$keuangan    = $this->m_umum->ambil_data('keu_mata_uang','id_mata_uang',$data['id']);
		$data['nama_mata_uang']  = set_value('nama_mata_uang',$keuangan["nama_mata_uang"]);
		$data['kode_mata_uang']  = set_value('kode_mata_uang',$keuangan["kode_mata_uang"]);
		$data['simbol_mata_uang']  = set_value('simbol_mata_uang',$keuangan["simbol_mata_uang"]);
		$this->load->view("administrator/isi",$data);
      }
      if($mode=='simpan_edit'){
		  if($this->m_administrator->edit_mata_uang()){
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
			redirect(base_url('administrator/kurs'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
			redirect(base_url('administrator/kurs'));
		  }
      }
	}
  }
 // ================================================ CODE ==================================
  function code($mode='view')
  {
	$data['page']  = "code";
	$data['header'] = "TIPE AKUN";
	$data['title'] = "TIPE AKUN";

	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
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
	$data['id']   = $this->uri->segment(4, 0);
	//======================= IMPORTANT ======================================
    if($mode=='view'){
	$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_administrator->code_all());
	}
	else{
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		$data['nama_code']  = set_value('nama_code',$this->input->post("nama_code"));
		$this->load->view("administrator/isi",$data);
      }
      if($mode=='simpan_tambah'){
		  if($this->m_administrator->simpan_keu_code()){
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
			redirect(base_url('administrator/code'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
			redirect(base_url('administrator/code'));
		  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
		$keuangan    = $this->m_umum->ambil_data('keu_code','id_code',$data['id']);
		$data['nama_code']  = set_value('nama_code',$keuangan["nama_code"]);
		$data['proteksi']  = set_value('proteksi',$keuangan["proteksi"]);
		$this->load->view("administrator/isi",$data);
      }
      if($mode=='simpan_edit'){
		  $proteksi = $this->input->post("proteksi");
		  if($proteksi == '0'){
			  if($this->m_administrator->edit_keu_code()){
				$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
				redirect(base_url('administrator/code'));
			  }else{
				$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
				redirect(base_url('administrator/code'));
			  }
		  }else{
			$this->session->set_flashdata('danger', 'Akun Core, diproteksi');
			redirect(base_url('administrator/code'));
		  }
      }
	}
  }
  // ================================================ CODE ==================================
  function data_coa()
  {
	$dt=$this->m_rancak->ambil_coa();
	$data = array();
	foreach($dt as $row){
		$data[] = array("id"=>$row['id_coa'], "text"=>$row['kode_coa'].' - '.$row['nama_coa']);
	}
	echo json_encode($data);
  }
  function coa($mode='view')
  {
	$data['page']  = "coa";
	$data['header'] = "KODE REKENING";
	$data['title'] = "KODE REKENING";
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
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
	$data['id']   = $this->uri->segment(4, 0);
	//======================= IMPORTANT ======================================
    if($mode=='view'){
	$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_administrator->coa_all());
	}
	else{
		$data['cmd_status']=$this->m_rancak->cmd_status();
		$data['cmd_code']=$this->m_rancak->cmd_code();
		$data['cmd_opsi_keu_coa']=$this->m_rancak->cmd_opsi_keu_coa();
		$data['cmd_mata_uang']=$this->m_rancak->cmd_mata_uang();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		$data['nama_coa']  = set_value('nama_coa',$this->input->post("nama_coa"));
		$data['kode_coa']  = set_value('kode_coa',$this->input->post("kode_coa"));
		$data['id_code']  = set_value('id_code',$this->input->post("id_code"));
		$data['parent']  = set_value('parent',$this->input->post("parent"));
		$data['status_coa']  = set_value('status_coa',$this->input->post("status_coa"));
		$this->load->view("administrator/isi",$data);
      }
      if($mode=='simpan_tambah'){
		  if($this->m_administrator->simpan_keu_coa()){
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
			redirect(base_url('administrator/coa'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
			redirect(base_url('administrator/coa'));
		  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
		$keuangan    = $this->m_umum->ambil_data('keu_coa','id_coa',$data['id']);
		$data['nama_coa']  = set_value('nama_coa',$keuangan["nama_coa"]);
		$data['kode_coa']  = set_value('kode_coa',$keuangan["kode_coa"]);
		$data['id_code']  = set_value('id_code',$keuangan["id_code"]);
		$data['parent']  = set_value('parent',$keuangan["parent"]);
		$data['protect']  = set_value('protect',$keuangan["protect"]);
		$data['status_coa']  = set_value('status_coa',$keuangan["status_coa"]);
		$this->load->view("administrator/isi",$data);
      }
      if($mode=='simpan_edit'){
		  $protect = $this->input->post("protect");
		  if($protect == "0"){
			  if($this->m_administrator->edit_keu_coa()){
				$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
				redirect(base_url('administrator/coa'));
			  }else{
				$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
				redirect(base_url('administrator/coa'));
			  }
		  }else{
				$this->session->set_flashdata('danger', 'Akun COA Inti Tidak Bisa Di Rubah');
				redirect(base_url('administrator/coa'));
		  }
      }
	}
  }
 // ================================================ D/K ==================================
  function dk($mode='view')
  {
	$data['page']  = "dk";
	$data['header'] = "Kreditur / Debitur";
	$data['title'] = "DATA Kreditur / Debitur";
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
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
	$data['id']   = $this->uri->segment(4, 0);
	//======================= IMPORTANT ======================================
    if($mode=='view'){
	$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_administrator->dk_all());
	}
/*     else if($mode=='hapus'){
		$kondisi=array('id_jenis_obat'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('apt_obat',$kondisi);
		if($jml == 0){
		  if($this->m_umum->hapus_data('apt_jenis_obat','id_jenis_obat',$id)){
			$this->session->set_flashdata('sukses', 'Data berhasil Di Hapus');
			redirect(base_url('admin_keuangan/code'));
		  }else{
			 $this->session->set_flashdata('danger', 'Ada Masalah Hapus Data');
			 redirect(base_url('admin_keuangan/code'));
		  }
		}else{
			$this->session->set_flashdata('danger', 'Nama jenis sudah di pakai di Obat');
			redirect(base_url('admin_keuangan/code'));
		}
    } */
	else{
		$data['cmd_ms_dk']=$this->m_rancak->cmd_ms_dk();
		$data['status'] = $this->m_rancak->cmd_status();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		$data['nama_dk']  = set_value('nama_dk',$this->input->post("nama_dk"));
		$data['dk']  = set_value('dk',$this->input->post("dk"));
		$data['kode_rekening']  = set_value('kode_rekening',$this->input->post("kode_rekening"));
		$data['no_dk']  = set_value('no_dk',$this->input->post("no_dk"));
		$data['alamat_dk']  = set_value('alamat_dk',$this->input->post("alamat_dk"));
		$data['status_dk']  = set_value('status_dk',$this->input->post("status_dk"));
		$this->load->view("administrator/isi",$data);
      }
      if($mode=='simpan_tambah'){
		$kode_rekening=$this->input->post('kode_rekening');
		$kondisi=array('kode_rekening'=>$kode_rekening);
		$jml = $this->m_umum->jumlah_record_filter('keu_dk',$kondisi);
		if($jml == 0){
			$this->m_administrator->simpan_keu_dk();
			$this->session->set_flashdata('sukses', 'Data berhasil Di Tambah');
		}else{
			$this->session->set_flashdata('danger', 'Kode Sudah Ada');
		}
			redirect(base_url('administrator/dk'));
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
		$keuangan    = $this->m_umum->ambil_data('keu_dk','id_dk',$data['id']);
		$data['id_dk']  = set_value('id_dk',$keuangan["id_dk"]);
		$data['nama_dk']  = set_value('nama_dk',$keuangan["nama_dk"]);
		$data['dk']  = set_value('dk',$keuangan["dk"]);
		$data['kode_rekening']  = set_value('kode_rekening',$keuangan["kode_rekening"]);
		$data['no_dk']  = set_value('no_dk',$keuangan["no_dk"]);
		$data['alamat_dk']  = set_value('alamat_dk',$keuangan["alamat_dk"]);
		$data['status_dk']  = set_value('status_dk',$keuangan["status_dk"]);
		$this->load->view("administrator/isi",$data);
      }
      if($mode=='simpan_edit'){
		$kode_rekening_lama = $this->input->post('kode_rekening_lama');
		$kode_rekening=$this->input->post('kode_rekening');
		$kondisi=array('kode_rekening'=>$kode_rekening,'kode_rekening !='=>$kode_rekening_lama);
		$jml = $this->m_umum->jumlah_record_filter('keu_dk',$kondisi);
		if($jml == 0){
			$this->m_administrator->edit_keu_dk();
			$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
		}else{
			$this->session->set_flashdata('danger', 'Nama Kode Ada');
		}
			redirect(base_url('administrator/dk'));
      }
	}
  }
  // ================================================ KATEGORI BARANG ==================================
  function kategori_barang($mode='view')
  {
	$data['page']  = "kategori_barang";
	$data['header'] = "KATEGORI BARANG";
	$data['title'] = "KATEGORI BARANG";
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
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
	$data['id']   = $this->uri->segment(4, 0);
	//======================= IMPORTANT ======================================
    if($mode=='view'){
	$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_administrator->kategori_item_all());
	}
	else{
		$data['status'] = $this->m_rancak->cmd_status();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		$data['nama_item_kategori']  = set_value('nama_item_kategori',$this->input->post("nama_item_kategori"));
		$data['kode_item_kategori']  = set_value('kode_item_kategori',$this->input->post("kode_item_kategori"));
		$data['status_item_kategori']  = set_value('status_item_kategori',$this->input->post("status_item_kategori"));
		$this->load->view("administrator/isi",$data);
      }
      if($mode=='simpan_tambah'){
		  if($this->m_administrator->simpan_item_kategori()){
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
			redirect(base_url('administrator/kategori_barang'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
			redirect(base_url('administrator/kategori_barang'));
		  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
		$keuangan    = $this->m_umum->ambil_data('keu_item_kategori','id_item_kategori',$data['id']);
		$data['nama_item_kategori']  = set_value('nama_item_kategori',$keuangan["nama_item_kategori"]);
		$data['kode_item_kategori']  = set_value('kode_item_kategori',$keuangan["kode_item_kategori"]);
		$data['status_item_kategori']  = set_value('status_item_kategori',$keuangan["status_item_kategori"]);
		$this->load->view("administrator/isi",$data);
      }
      if($mode=='simpan_edit'){
		  if($this->m_administrator->edit_item_kategori()){
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
			redirect(base_url('administrator/kategori_barang'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
			redirect(base_url('administrator/kategori_barang'));
		  }
      }
	}
  }
  // ================================================ BARANG ==================================
  function barang($mode='view')
  {
	$data['page']  = "barang";
	$data['header'] = "BARANG";
	$data['title'] = "BARANG";
	$data['link_kembali'] = base_url('administrator/barang');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
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
	$data['id']   = $this->uri->segment(4, 0);
	//======================= IMPORTANT ======================================
    if($mode=='view'){
	$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_administrator->item_all());
	}
	else{
		$data['cmd_jenis_barang'] = $this->m_rancak->cmd_jenis_barang();
		$data['cmd_item_kategori'] = $this->m_rancak->cmd_item_kategori();
		$data['cmd_satuan_barang'] = $this->m_rancak->cmd_satuan_barang();
		$data['cmd_unit_null'] = $this->m_rancak->cmd_unit_null();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		$data['jenis_barang']  = set_value('jenis_barang',$this->input->post('jenis_barang'));
		$data['kode_barang']  = set_value('kode_barang',$this->input->post('kode_barang'));
		$data['barcode_barang']  = set_value('barcode_barang',$this->input->post('barcode_barang'));
		$data['nama_barang']  = set_value('nama_barang',$this->input->post('nama_barang'));
		$data['id_unit']  = set_value('id_unit',$this->input->post('id_unit'));
		$data['id_item_kategori']  = set_value('id_item_kategori',$this->input->post('id_item_kategori'));
		$this->load->view("administrator/isi",$data);
      }
      if($mode=='simpan_tambah'){
		  if($this->m_administrator->simpan_barang()){
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
			redirect(base_url('administrator/barang'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
			redirect(base_url('administrator/barang'));
		  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
		$keuangan    = $this->m_umum->ambil_data('keu_barang','id_barang',$data['id']);
		$data['jenis_barang']  = set_value('jenis_barang',$keuangan["jenis_barang"]);
		$data['kode_barang']  = set_value('kode_barang',$keuangan["kode_barang"]);
		$data['barcode_barang']  = set_value('barcode_barang',$keuangan["barcode_barang"]);
		$data['nama_barang']  = set_value('nama_barang',$keuangan["nama_barang"]);
		$data['id_unit']  = set_value('id_unit',$keuangan["id_unit"]);
		$data['id_item_kategori']  = set_value('id_item_kategori',$keuangan["id_item_kategori"]);
		$this->load->view("administrator/isi",$data);
      }
      if($mode=='simpan_edit'){
		  if($this->m_administrator->edit_barang()){
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
			redirect(base_url('administrator/barang'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
			redirect(base_url('administrator/barang'));
		  }
      }
	}
  }
  // ================================================ ORDER BELI ==================================
  function termin($mode='view')
  {
	$data['page']  = "termin";
	$data['header'] = "TERMIN";
	$data['title'] = "TERMIN";
	$data['link_kembali'] = base_url('administrator/termin');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
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
	$data['id']   = $this->uri->segment(4, 0);
	//======================= IMPORTANT ======================================
    if($mode=='view'){
	$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_administrator->termin_all());
	}
	else{
		$data['cmd_status'] = $this->m_rancak->cmd_status();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		$data['nama_termin']  = set_value('nama_termin',$this->input->post('nama_termin'));
		$data['tempo_termin']  = set_value('tempo_termin',$this->input->post('tempo_termin'));
		$data['ket_termin']  = set_value('ket_termin',$this->input->post('ket_termin'));
		$data['status_termin']  = set_value('status_termin',$this->input->post('status_termin'));
		$this->load->view("administrator/isi",$data);
      }
      if($mode=='simpan_tambah'){
		  if($this->m_administrator->simpan_termin()){
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
			redirect(base_url('administrator/termin'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
			redirect(base_url('administrator/termin'));
		  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
		$keuangan    = $this->m_umum->ambil_data('kol_termin','id_termin',$data['id']);
		$data['nama_termin']  = set_value('nama_termin',$keuangan["nama_termin"]);
		$data['tempo_termin']  = set_value('tempo_termin',$keuangan["tempo_termin"]);
		$data['ket_termin']  = set_value('ket_termin',$keuangan["ket_termin"]);
		$data['status_termin']  = set_value('status_termin',$keuangan["status_termin"]);
		$this->load->view("administrator/isi",$data);
      }
      if($mode=='simpan_edit'){
		  if($this->m_administrator->edit_termin()){
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
			redirect(base_url('administrator/termin'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
			redirect(base_url('administrator/termin'));
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
