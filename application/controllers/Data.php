<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Data extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
      parent::__construct();
		  $this->load->model('m_ol_rancak');
		  $this->load->model('m_data');
  }
	function index(){
		$this->gender();
	}
		function check_availability(){
		$username=$this->input->post('username');
		$username = strtolower($username);
		$username = str_replace(' ', '-', $username);
		$username = preg_replace('/[^A-Za-z0-9\-]/', '', $username);
		$kondisi=array('username'=>$username);
		$jml = $this->m_umum->jumlah_record_filter('ol_user',$kondisi);
		if($jml == 0){
			echo "<span style='color:green'> Username Tersedia.</span>";
		}else{
			echo "<span style='color:red'> Username Sudah Ada</span>";
		}
	}
  function check_nik(){
		$nik=$this->input->post('nik');
		$kondisi=array('nik'=>$nik);
		$jml = $this->m_umum->jumlah_record_filter('ol_pegawai',$kondisi);
		if($jml == 0){
			echo "<span style='color:green'> No KTP Tersedia.</span>";
		}else{
			echo "<span style='color:red'> No KTP Sudah Ada</span>";
		}
	}
  function jabfung_data($id)
  {
    if($id < 3){
      $ids = '1';
    }else{
      $ids = '3';
    }
    $dt=$this->m_rancak->ambil_data_dropdown_jabfung_registrasi($ids);
    echo json_encode($dt);
  }
  function pengcab($id)
  {
  	$jabfung = $this->m_umum->ambil_data('jabatan_fungsional','id_jabatan_fungsional',$id);
    $dt=$this->m_ol_rancak->ambil_data_pengcab($jabfung['id_jabatan']);
    echo json_encode($dt);
  }
  function sukses()
  {
		$data['page']  = "sukses";
		$data['header'] = "REGISTRASI BERHASIL";
		$data['title'] = "REGISTRASI BERHASIL";
    $instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$ppni = $this->m_umum->ambil_data('a_online','kode_online','ppni_registrasi');
		$data['ppni_menu'] = $ppni["header"];
		$sikas = $this->m_umum->ambil_data('a_online','kode_online','sikas_registrasi');
		$data['sikas_menu'] = $sikas["header"];
		$ologin = $this->m_umum->ambil_data('a_online','kode_online','data_registrasi');
		$data['nakes_menu'] = $ologin["header"];
		$amasuk = $this->m_umum->ambil_data('a_online','kode_online','masuk');
		$data['masuk_menu'] = $amasuk["header"];
		$blogin = $this->m_umum->ambil_data('a_online','kode_online','login');
		$data['login_menu'] = $blogin["header"];		
		$instansi_text = $this->m_umum->ambil_data('a_instansi_text','id_instansi',$instansi['id_instansi']);	
  	$data['desc1'] = $instansi_text['desc1'];		
		$data['status_online'] = $ologin["status_online"];
  	$data['instance_id'] = $instansi["id_instansi"];
  	$data['instance_name'] = $instansi["nama_instansi"];
  	$data['idescription'] = $instansi["description"];
  	$data['ikeywords'] = $instansi["keywords"];
  	$data['iheader'] = $instansi["header"];
  	$data['iheader_mini'] = $instansi["header_mini"];
  	$data['ifooter'] = $instansi["footer"];
  	$data['ilicensed'] = $instansi["licensed"];
  	$data['welcome'] = $instansi["welcome"];
  	$data['web_header'] = $instansi["web_header"];
  	$data['web_intro'] = $instansi["web_intro"];
  	$data['web_slider'] = $instansi["web_slider"];
  	$this->tampil($data);
  }
  function expired()
  {
		$data['page']  = "expired";
		$data['header'] = "AKUN EXPIRED";
		$data['title'] = "AKUN EXPIRED";
    $instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$ppni = $this->m_umum->ambil_data('a_online','kode_online','ppni_registrasi');
		$data['ppni_menu'] = $ppni["header"];
		$sikas = $this->m_umum->ambil_data('a_online','kode_online','sikas_registrasi');
		$data['sikas_menu'] = $sikas["header"];
		$ologin = $this->m_umum->ambil_data('a_online','kode_online','data_registrasi');
		$data['nakes_menu'] = $ologin["header"];
		$amasuk = $this->m_umum->ambil_data('a_online','kode_online','masuk');
		$data['masuk_menu'] = $amasuk["header"];
		$blogin = $this->m_umum->ambil_data('a_online','kode_online','login');
		$data['login_menu'] = $blogin["header"];		
		$instansi_text = $this->m_umum->ambil_data('a_instansi_text','id_instansi',$instansi['id_instansi']);	
  	$data['desc1'] = $instansi_text['desc1'];		
		$data['status_online'] = $ologin["status_online"];
  	$data['instance_id'] = $instansi["id_instansi"];
  	$data['instance_name'] = $instansi["nama_instansi"];
  	$data['idescription'] = $instansi["description"];
  	$data['ikeywords'] = $instansi["keywords"];
  	$data['iheader'] = $instansi["header"];
  	$data['iheader_mini'] = $instansi["header_mini"];
  	$data['ifooter'] = $instansi["footer"];
  	$data['ilicensed'] = $instansi["licensed"];
  	$data['welcome'] = $instansi["welcome"];
  	$data['web_header'] = $instansi["web_header"];
  	$data['web_intro'] = $instansi["web_intro"];
  	$data['web_slider'] = $instansi["web_slider"];
  	$this->tampil($data);
  }
  function registrasi()
  {
		$data['page']  = "registrasi";
		$data['header'] = "REGISTRASI";
		$data['title'] = "REGISTRASI";
    $instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$ppni = $this->m_umum->ambil_data('a_online','kode_online','ppni_registrasi');
		$data['ppni_menu'] = $ppni["header"];
		$sikas = $this->m_umum->ambil_data('a_online','kode_online','sikas_registrasi');
		$data['sikas_menu'] = $sikas["header"];
		$amasuk = $this->m_umum->ambil_data('a_online','kode_online','masuk');
		$data['masuk_menu'] = $amasuk["header"];
		$blogin = $this->m_umum->ambil_data('a_online','kode_online','login');
	$ologin = $this->m_umum->ambil_data('a_online','kode_online','data_registrasi');

	if(empty($ologin) || $ologin['status_online'] == 0){
	    redirect(base_url());
	}

	$data['nakes_menu']    = $ologin['header'] ?? '';
	$data['login_menu']    = $blogin['header'] ?? '';
	$data['status_online'] = $ologin['status_online'] ?? 0;	
/*		$instansi_text = $this->m_umum->ambil_data('a_instansi_text','id_instansi',$instansi['id_instansi']);	*/
  	$data['desc1'] = "";
  	$data['instance_id'] = $instansi["id_instansi"];
  	$data['instance_name'] = $instansi["nama_instansi"];
  	$data['idescription'] = $instansi["description"];
  	$data['ikeywords'] = $instansi["keywords"];
  	$data['iheader'] = $instansi["header"];
  	$data['iheader_mini'] = $instansi["header_mini"];
  	$data['ifooter'] = $instansi["footer"];
  	$data['ilicensed'] = $instansi["licensed"];
  	$data['welcome'] = $instansi["welcome"];
  	$data['web_header'] = $instansi["web_header"];
  	$data['web_intro'] = $instansi["web_intro"];
  	$data['web_slider'] = $instansi["web_slider"];
//		$onlinekah = $this->m_umum->ambil_data('a_online','kode_online','data_registrasi');
		$data['cmd_tipe_pegawai'] = $this->m_ol_rancak->cmd_tipe_pegawai_null();
		$data['status'] = $this->m_rancak->cmd_status();
		$data['gender'] = $this->m_rancak->cmd_jk();
		$data['ambil_instansi'] = $this->m_ol_rancak->ambil_rujukan_working_null_data();
		$data['cmd_agama'] = $this->m_rancak->cmd_agama_null();
		$data['cmd_status_kawin'] = $this->m_rancak->cmd_status_kawin_null();
		$data['cmd_pendidikan'] = $this->m_rancak->cmd_pendidikan_null();
		$data['jabatan_fungsional'] = $this->m_ol_rancak->cmd_jabfung_buket();
		$data['id']   = $this->uri->segment(3, 0);
			$data['nama_pegawai']  = set_value('nama_pegawai',$this->input->post("nama_pegawai"));
			$data['jk']  = set_value('jk',$this->input->post("jk"));
			$data['tmp_lahir']  = set_value('tmp_lahir',$this->input->post("tmp_lahir"));
			$data['tgl_lahir']  = set_value('tgl_lahir',date('d-m-Y'));
			$data['email']  = set_value('email',$this->input->post("email"));
			$data['no_hp']  = set_value('no_hp',$this->input->post("no_hp"));
			$data['nip']  = set_value('nip',$this->input->post("nip"));
			$data['nik']  = set_value('nik',$this->input->post("nik"));
			$data['id_status_kawin']  = set_value('id_status_kawin',$this->input->post("id_status_kawin"));
			$data['id_agama']  = set_value('id_agama',$this->input->post("id_agama"));
			$data['id_pendidikan']  = set_value('id_pendidikan',$this->input->post("id_pendidikan"));
			$data['alamat']  = set_value('alamat',$this->input->post("alamat"));
			$data['username']  = set_value('username',$this->input->post("username"));
			$data['id_jabatan_fungsional']  = set_value('id_jabatan_fungsional',1);
			$data['id_status_pegawai']  = set_value('id_status_pegawai',$this->input->post("id_status_pegawai"));
			$data['nama_instansi']  = set_value('nama_instansi',$this->input->post("nama_instansi"));
			$data['alamat_instansi']  = set_value('alamat_instansi',$this->input->post("alamat_instansi"));
			$data['nama_unit']  = set_value('nama_unit',$this->input->post("nama_unit"));
			$data['atasan_unit']  = set_value('atasan_unit',$this->input->post("atasan_unit"));
		$this->form_validation->set_rules('nama_pegawai','nama_pegawai','required');
    if ($this->form_validation->run() === FALSE){
			$this->tampil($data);
    }else{
    	$nik = $this->input->post('nik');
    	$username = $this->input->post('username');
    	$status_online = $this->input->post('status_online');
      $kondisi2=array('nik'=>$nik); //id_pendaftaran
      $kondisi=array('username'=>$username); //id_pendaftaran
      $data['jml'] = $this->m_umum->jumlah_record_filter('ol_user',$kondisi);
      $data['jml2'] = $this->m_umum->jumlah_record_filter('ol_pegawai',$kondisi2);
	    if($status_online == 0){
	    	$this->session->set_flashdata('sukses', 'Status Tidak Online');
	    	redirect(base_url());
    	}else{
    		if($data['jml'] == 0){
		      if($data['jml2'] == 0){
	    			$this->m_data->tambah_registrasi();
	    	//		$this->session->set_flashdata('sukses', 'Data Sudah Tersimpan, Silahkan Hubungi Administrator');
	    			redirect(base_url('data/sukses'));	
		      }else{
					  echo "<script type='text/javascript'>
						alert('No KTP Sudah Ada');window.location.href = '" . base_url() . "data/registrasi';
					</script>";      	
		      }	
    		}else{
					  echo "<script type='text/javascript'>
						alert('Username Sudah Ada');window.location.href = '" . base_url() . "data/registrasi';
					</script>";
    		}
    	}    	
    }
  }
	function gender($mode='view')
  {
    $data['page']  = "gender";
		$data['header'] = "GRAFIK GENDER";
		$data['title'] = "GRAFIK GENDER";
    $instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$ppni = $this->m_umum->ambil_data('a_online','kode_online','ppni_registrasi');
		$data['ppni_menu'] = $ppni["header"];
		$sikas = $this->m_umum->ambil_data('a_online','kode_online','sikas_registrasi');
		$data['sikas_menu'] = $sikas["header"];
		$ologin = $this->m_umum->ambil_data('a_online','kode_online','data_registrasi');
		$data['nakes_menu'] = $ologin["header"];
		$amasuk = $this->m_umum->ambil_data('a_online','kode_online','masuk');
		$data['masuk_menu'] = $amasuk["header"];
		$blogin = $this->m_umum->ambil_data('a_online','kode_online','login');
		$data['login_menu'] = $blogin["header"];
		$ologin = $this->m_umum->ambil_data('a_online','kode_online','masuk');
		$instansi_text = $this->m_umum->ambil_data('a_instansi_text','id_instansi',$instansi['id_instansi']);	
  	$data['desc1'] = $instansi_text['desc1'];		
		$data['opsi_login'] = $ologin["status_online"];
  	$data['instance_id'] = $instansi["id_instansi"];
  	$data['instance_name'] = $instansi["nama_instansi"];
  	$data['idescription'] = $instansi["description"];
  	$data['ikeywords'] = $instansi["keywords"];
  	$data['iheader'] = $instansi["header"];
  	$data['iheader_mini'] = $instansi["header_mini"];
  	$data['ifooter'] = $instansi["footer"];
  	$data['ilicensed'] = $instansi["licensed"];
  	$data['welcome'] = $instansi["welcome"];
  	$data['web_header'] = $instansi["web_header"];
  	$data['web_intro'] = $instansi["web_intro"];
  	$data['web_slider'] = $instansi["web_slider"];
 	  $data['datae'] = $this->m_data->ambil_data_dropdown_pegawai_no_null_instansi_all();
 	  $data['id'] = $this->uri->segment(4, 0);
    if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$id = $this->input->post("id");
				redirect(base_url('data/'.$data['page'].'/view/'.$id));
			}
		}
    else if($mode=='data'){
			echo json_encode($this->m_data->grafik_gender($data['id']));
		}
  }
	function pk($mode='view')
  {
    $data['page']  = "pk";
		$data['header'] = "GRAFIK PENUGASAN KLINIS";
		$data['title'] = "GRAFIK PENUGASAN KLINIS";
    $instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$ppni = $this->m_umum->ambil_data('a_online','kode_online','ppni_registrasi');
		$data['ppni_menu'] = $ppni["header"];
		$sikas = $this->m_umum->ambil_data('a_online','kode_online','sikas_registrasi');
		$data['sikas_menu'] = $sikas["header"];
		$ologin = $this->m_umum->ambil_data('a_online','kode_online','data_registrasi');
		$data['nakes_menu'] = $ologin["header"];
		$amasuk = $this->m_umum->ambil_data('a_online','kode_online','masuk');
		$data['masuk_menu'] = $amasuk["header"];
		$blogin = $this->m_umum->ambil_data('a_online','kode_online','login');
		$data['login_menu'] = $blogin["header"];
		$ologin = $this->m_umum->ambil_data('a_online','kode_online','masuk');
		$instansi_text = $this->m_umum->ambil_data('a_instansi_text','id_instansi',$instansi['id_instansi']);	
		$data['opsi_login'] = $ologin["status_online"];
  	$data['instance_id'] = $instansi["id_instansi"];
  	$data['instance_name'] = $instansi["nama_instansi"];
  	$data['idescription'] = $instansi["description"];
  	$data['ikeywords'] = $instansi["keywords"];
  	$data['desc1'] = $instansi_text['desc1'];
  	$data['iheader'] = $instansi["header"];
  	$data['iheader_mini'] = $instansi["header_mini"];
  	$data['ifooter'] = $instansi["footer"];
  	$data['ilicensed'] = $instansi["licensed"];
  	$data['welcome'] = $instansi["welcome"];
  	$data['web_header'] = $instansi["web_header"];
  	$data['web_intro'] = $instansi["web_intro"];
  	$data['web_slider'] = $instansi["web_slider"];
 	  $data['datae'] = $this->m_data->ambil_data_dropdown_pegawai_no_null_instansi_all();
 	  $data['id'] = $this->uri->segment(4, 0);
    if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$id = $this->input->post("id");
				redirect(base_url('data/'.$data['page'].'/view/'.$id));
			}
		}
    else if($mode=='data'){
			echo json_encode($this->m_data->grafik_pk($data['id']));
		}
  }
	function jabfung($mode='view')
  {
    $data['page']  = "jabfung";
		$data['header'] = "GRAFIK JABATAN FUNGSIONAL";
		$data['title'] = "GRAFIK JABATAN FUNGSIONAL";
    $instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$ppni = $this->m_umum->ambil_data('a_online','kode_online','ppni_registrasi');
		$data['ppni_menu'] = $ppni["header"];
		$sikas = $this->m_umum->ambil_data('a_online','kode_online','sikas_registrasi');
		$data['sikas_menu'] = $sikas["header"];
		$ologin = $this->m_umum->ambil_data('a_online','kode_online','data_registrasi');
		$data['nakes_menu'] = $ologin["header"];
		$amasuk = $this->m_umum->ambil_data('a_online','kode_online','masuk');
		$data['masuk_menu'] = $amasuk["header"];
		$blogin = $this->m_umum->ambil_data('a_online','kode_online','login');
		$data['login_menu'] = $blogin["header"];
		$ologin = $this->m_umum->ambil_data('a_online','kode_online','masuk');
		$instansi_text = $this->m_umum->ambil_data('a_instansi_text','id_instansi',$instansi['id_instansi']);	
		$data['opsi_login'] = $ologin["status_online"];
  	$data['instance_id'] = $instansi["id_instansi"];
  	$data['instance_name'] = $instansi["nama_instansi"];
  	$data['idescription'] = $instansi["description"];
  	$data['ikeywords'] = $instansi["keywords"];
  	$data['desc1'] = $instansi_text['desc1'];
  	$data['iheader'] = $instansi["header"];
  	$data['iheader_mini'] = $instansi["header_mini"];
  	$data['ifooter'] = $instansi["footer"];
  	$data['ilicensed'] = $instansi["licensed"];
  	$data['welcome'] = $instansi["welcome"];
  	$data['web_header'] = $instansi["web_header"];
  	$data['web_intro'] = $instansi["web_intro"];
  	$data['web_slider'] = $instansi["web_slider"];
 	  $data['datae'] = $this->m_data->ambil_data_dropdown_pegawai_no_null_instansi_all();
 	  $data['id'] = $this->uri->segment(4, 0);
    if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$id = $this->input->post("id");
				redirect(base_url('data/'.$data['page'].'/view/'.$id));
			}
		}
    else if($mode=='data'){
			echo json_encode($this->m_data->grafik_jb($data['id']));
		}
  }
	function pendidikan($mode='view')
  {
    $data['page']  = "pendidikan";
		$data['header'] = "GRAFIK PENDIDIKAN TERAKHIR";
		$data['title'] = "GRAFIK PENDIDIKAN TERAKHIR";
    $instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$ppni = $this->m_umum->ambil_data('a_online','kode_online','ppni_registrasi');
		$data['ppni_menu'] = $ppni["header"];
		$sikas = $this->m_umum->ambil_data('a_online','kode_online','sikas_registrasi');
		$data['sikas_menu'] = $sikas["header"];
		$ologin = $this->m_umum->ambil_data('a_online','kode_online','data_registrasi');
		$data['nakes_menu'] = $ologin["header"];
		$amasuk = $this->m_umum->ambil_data('a_online','kode_online','masuk');
		$data['masuk_menu'] = $amasuk["header"];
		$blogin = $this->m_umum->ambil_data('a_online','kode_online','login');
		$data['login_menu'] = $blogin["header"];
		$ologin = $this->m_umum->ambil_data('a_online','kode_online','masuk');
		$instansi_text = $this->m_umum->ambil_data('a_instansi_text','id_instansi',$instansi['id_instansi']);	
		$data['opsi_login'] = $ologin["status_online"];
  	$data['instance_id'] = $instansi["id_instansi"];
  	$data['instance_name'] = $instansi["nama_instansi"];
  	$data['idescription'] = $instansi["description"];
  	$data['ikeywords'] = $instansi["keywords"];
  	$data['desc1'] = $instansi_text['desc1'];
  	$data['iheader'] = $instansi["header"];
  	$data['iheader_mini'] = $instansi["header_mini"];
  	$data['ifooter'] = $instansi["footer"];
  	$data['ilicensed'] = $instansi["licensed"];
  	$data['welcome'] = $instansi["welcome"];
  	$data['web_header'] = $instansi["web_header"];
  	$data['web_intro'] = $instansi["web_intro"];
  	$data['web_slider'] = $instansi["web_slider"];
 	  $data['datae'] = $this->m_data->ambil_data_dropdown_pegawai_no_null_instansi_all();
 	  $data['id'] = $this->uri->segment(4, 0);
    if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$id = $this->input->post("id");
				redirect(base_url('data/'.$data['page'].'/view/'.$id));
			}
		}
    else if($mode=='data'){
			echo json_encode($this->m_data->grafik_pendidikan($data['id']));
		}
  }
	function agama($mode='view')
  {
    $data['page']  = "agama";
		$data['header'] = "GRAFIK RELIGION";
		$data['title'] = "GRAFIK RELIGION";
    $instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$ppni = $this->m_umum->ambil_data('a_online','kode_online','ppni_registrasi');
		$data['ppni_menu'] = $ppni["header"];
		$sikas = $this->m_umum->ambil_data('a_online','kode_online','sikas_registrasi');
		$data['sikas_menu'] = $sikas["header"];
		$ologin = $this->m_umum->ambil_data('a_online','kode_online','data_registrasi');
		$data['nakes_menu'] = $ologin["header"];
		$amasuk = $this->m_umum->ambil_data('a_online','kode_online','masuk');
		$data['masuk_menu'] = $amasuk["header"];
		$blogin = $this->m_umum->ambil_data('a_online','kode_online','login');
		$data['login_menu'] = $blogin["header"];
		$ologin = $this->m_umum->ambil_data('a_online','kode_online','masuk');
		$instansi_text = $this->m_umum->ambil_data('a_instansi_text','id_instansi',$instansi['id_instansi']);	
		$data['opsi_login'] = $ologin["status_online"];
  	$data['instance_id'] = $instansi["id_instansi"];
  	$data['instance_name'] = $instansi["nama_instansi"];
  	$data['idescription'] = $instansi["description"];
  	$data['ikeywords'] = $instansi["keywords"];
  	$data['desc1'] = $instansi_text['desc1'];
  	$data['iheader'] = $instansi["header"];
  	$data['iheader_mini'] = $instansi["header_mini"];
  	$data['ifooter'] = $instansi["footer"];
  	$data['ilicensed'] = $instansi["licensed"];
  	$data['welcome'] = $instansi["welcome"];
  	$data['web_header'] = $instansi["web_header"];
  	$data['web_intro'] = $instansi["web_intro"];
  	$data['web_slider'] = $instansi["web_slider"];
 	  $data['datae'] = $this->m_data->ambil_data_dropdown_pegawai_no_null_instansi_all();
 	  $data['id'] = $this->uri->segment(4, 0);
    if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$id = $this->input->post("id");
				redirect(base_url('data/'.$data['page'].'/view/'.$id));
			}
		}
    else if($mode=='data'){
			echo json_encode($this->m_data->grafik_agama($data['id']));
		}
  }
	function status_perkawinan($mode='view')
  {
    $data['page']  = "status_perkawinan";
		$data['header'] = "GRAFIK STATUS PERKAWINAN";
		$data['title'] = "GRAFIK STATUS PERKAWINAN";
    $instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$ppni = $this->m_umum->ambil_data('a_online','kode_online','ppni_registrasi');
		$data['ppni_menu'] = $ppni["header"];
		$sikas = $this->m_umum->ambil_data('a_online','kode_online','sikas_registrasi');
		$data['sikas_menu'] = $sikas["header"];
		$ologin = $this->m_umum->ambil_data('a_online','kode_online','data_registrasi');
		$data['nakes_menu'] = $ologin["header"];
		$amasuk = $this->m_umum->ambil_data('a_online','kode_online','masuk');
		$data['masuk_menu'] = $amasuk["header"];
		$blogin = $this->m_umum->ambil_data('a_online','kode_online','login');
		$data['login_menu'] = $blogin["header"];
		$ologin = $this->m_umum->ambil_data('a_online','kode_online','masuk');
		$instansi_text = $this->m_umum->ambil_data('a_instansi_text','id_instansi',$instansi['id_instansi']);	
		$data['opsi_login'] = $ologin["status_online"];
  	$data['instance_id'] = $instansi["id_instansi"];
  	$data['instance_name'] = $instansi["nama_instansi"];
  	$data['idescription'] = $instansi["description"];
  	$data['ikeywords'] = $instansi["keywords"];
  	$data['desc1'] = $instansi_text['desc1'];
  	$data['iheader'] = $instansi["header"];
  	$data['iheader_mini'] = $instansi["header_mini"];
  	$data['ifooter'] = $instansi["footer"];
  	$data['ilicensed'] = $instansi["licensed"];
  	$data['welcome'] = $instansi["welcome"];
  	$data['web_header'] = $instansi["web_header"];
  	$data['web_intro'] = $instansi["web_intro"];
  	$data['web_slider'] = $instansi["web_slider"];
 	  $data['datae'] = $this->m_data->ambil_data_dropdown_pegawai_no_null_instansi_all();
 	  $data['id'] = $this->uri->segment(4, 0);
    if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$id = $this->input->post("id");
				redirect(base_url('data/'.$data['page'].'/view/'.$id));
			}
		}
    else if($mode=='data'){
			echo json_encode($this->m_data->grafik_status_kawin($data['id']));
		}
  }
	function status_pegawai($mode='view')
  {
    $data['page']  = "status_pegawai";
		$data['header'] = "GRAFIK STATUS KEPEGAWAIAN";
		$data['title'] = "GRAFIK STATUS KEPEGAWAIAN";
    $instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$ppni = $this->m_umum->ambil_data('a_online','kode_online','ppni_registrasi');
		$data['ppni_menu'] = $ppni["header"];
		$sikas = $this->m_umum->ambil_data('a_online','kode_online','sikas_registrasi');
		$data['sikas_menu'] = $sikas["header"];
		$ologin = $this->m_umum->ambil_data('a_online','kode_online','data_registrasi');
		$data['nakes_menu'] = $ologin["header"];
		$amasuk = $this->m_umum->ambil_data('a_online','kode_online','masuk');
		$data['masuk_menu'] = $amasuk["header"];
		$blogin = $this->m_umum->ambil_data('a_online','kode_online','login');
		$data['login_menu'] = $blogin["header"];
		$ologin = $this->m_umum->ambil_data('a_online','kode_online','masuk');
		$instansi_text = $this->m_umum->ambil_data('a_instansi_text','id_instansi',$instansi['id_instansi']);	
		$data['opsi_login'] = $ologin["status_online"];
  	$data['instance_id'] = $instansi["id_instansi"];
  	$data['instance_name'] = $instansi["nama_instansi"];
  	$data['idescription'] = $instansi["description"];
  	$data['ikeywords'] = $instansi["keywords"];
  	$data['desc1'] = $instansi_text['desc1'];
  	$data['iheader'] = $instansi["header"];
  	$data['iheader_mini'] = $instansi["header_mini"];
  	$data['ifooter'] = $instansi["footer"];
  	$data['ilicensed'] = $instansi["licensed"];
  	$data['welcome'] = $instansi["welcome"];
  	$data['web_header'] = $instansi["web_header"];
  	$data['web_intro'] = $instansi["web_intro"];
  	$data['web_slider'] = $instansi["web_slider"];
 	  $data['datae'] = $this->m_data->ambil_data_dropdown_pegawai_no_null_instansi_all();
 	  $data['id'] = $this->uri->segment(4, 0);
    if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$id = $this->input->post("id");
				redirect(base_url('data/'.$data['page'].'/view/'.$id));
			}
		}
    else if($mode=='data'){
			echo json_encode($this->m_data->grafik_status_pegawai($data['id']));
		}
  }
	function pelatihan($mode='view')
  {
    $data['page']  = "pelatihan";
		$data['header'] = "GRAFIK PELATIHAN";
		$data['title'] = "GRAFIK PELATIHAN";
    $instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$ppni = $this->m_umum->ambil_data('a_online','kode_online','ppni_registrasi');
		$data['ppni_menu'] = $ppni["header"];
		$sikas = $this->m_umum->ambil_data('a_online','kode_online','sikas_registrasi');
		$data['sikas_menu'] = $sikas["header"];
		$ologin = $this->m_umum->ambil_data('a_online','kode_online','data_registrasi');
		$data['nakes_menu'] = $ologin["header"];
		$amasuk = $this->m_umum->ambil_data('a_online','kode_online','masuk');
		$data['masuk_menu'] = $amasuk["header"];
		$blogin = $this->m_umum->ambil_data('a_online','kode_online','login');
		$data['login_menu'] = $blogin["header"];
		$ologin = $this->m_umum->ambil_data('a_online','kode_online','masuk');
		$instansi_text = $this->m_umum->ambil_data('a_instansi_text','id_instansi',$instansi['id_instansi']);	
		$data['opsi_login'] = $ologin["status_online"];
  	$data['instance_id'] = $instansi["id_instansi"];
  	$data['instance_name'] = $instansi["nama_instansi"];
  	$data['idescription'] = $instansi["description"];
  	$data['ikeywords'] = $instansi["keywords"];
  	$data['desc1'] = $instansi_text['desc1'];
  	$data['iheader'] = $instansi["header"];
  	$data['iheader_mini'] = $instansi["header_mini"];
  	$data['ifooter'] = $instansi["footer"];
  	$data['ilicensed'] = $instansi["licensed"];
  	$data['welcome'] = $instansi["welcome"];
  	$data['web_header'] = $instansi["web_header"];
  	$data['web_intro'] = $instansi["web_intro"];
  	$data['web_slider'] = $instansi["web_slider"];
 	  $data['datae'] = $this->m_data->ambil_data_dropdown_pegawai_no_null_instansi_all();
 	  $data['id'] = $this->uri->segment(4, 0);
    if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$id = $this->input->post("id");
				redirect(base_url('data/'.$data['page'].'/view/'.$id));
			}
		}
    else if($mode=='data'){
			echo json_encode($this->m_data->grafik_pelatihan($data['id']));
		}
  }
  function kab_data($id)
  {
    $dt=$this->m_data->ambil_data_dropdown_kab($id);
    echo json_encode($dt);
  }
  function kec_data($id)
  {
    $dt=$this->m_data->ambil_data_dropdown_kec($id);
    echo json_encode($dt);
  }
  function kel_data($id)
  {
    $dt=$this->m_data->ambil_data_dropdown_kel($id);
    echo json_encode($dt);
  }
	function demografi($mode='view')
  {
    $data['page']  = "demografi";
		$data['header'] = "GRAFIK DEMOGRAFI";
		$data['title'] = "GRAFIK DEMOGRAFI";
    $instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$ppni = $this->m_umum->ambil_data('a_online','kode_online','ppni_registrasi');
		$data['ppni_menu'] = $ppni["header"];
		$sikas = $this->m_umum->ambil_data('a_online','kode_online','sikas_registrasi');
		$data['sikas_menu'] = $sikas["header"];
		$ologin = $this->m_umum->ambil_data('a_online','kode_online','data_registrasi');
		$data['nakes_menu'] = $ologin["header"];
		$amasuk = $this->m_umum->ambil_data('a_online','kode_online','masuk');
		$data['masuk_menu'] = $amasuk["header"];
		$blogin = $this->m_umum->ambil_data('a_online','kode_online','login');
		$data['login_menu'] = $blogin["header"];
		$ologin = $this->m_umum->ambil_data('a_online','kode_online','masuk');
		$instansi_text = $this->m_umum->ambil_data('a_instansi_text','id_instansi',$instansi['id_instansi']);	
		$data['opsi_login'] = $ologin["status_online"];
  	$data['instance_id'] = $instansi["id_instansi"];
  	$data['instance_name'] = $instansi["nama_instansi"];
  	$data['idescription'] = $instansi["description"];
  	$data['ikeywords'] = $instansi["keywords"];
  	$data['desc1'] = $instansi_text['desc1'];
  	$data['iheader'] = $instansi["header"];
  	$data['iheader_mini'] = $instansi["header_mini"];
  	$data['ifooter'] = $instansi["footer"];
  	$data['ilicensed'] = $instansi["licensed"];
  	$data['welcome'] = $instansi["welcome"];
  	$data['web_header'] = $instansi["web_header"];
  	$data['web_intro'] = $instansi["web_intro"];
  	$data['web_slider'] = $instansi["web_slider"];
 	  $data['datae'] = $this->m_data->ambil_data_dropdown_pegawai_no_null_instansi_all();
 	  $data['id'] = $this->uri->segment(4, 0);
 	  $data['cr'] = $this->uri->segment(5, 0);
 	  $data['id_prov'] = $this->uri->segment(6, 0);
 	  $data['id_kab'] = $this->uri->segment(7, 0);
 	  $data['id_kel'] = $this->uri->segment(8, 0);
 	  $data['id_kec'] = $this->uri->segment(9, 0);
		if($data['id_prov'] == NULL OR empty($data['id_prov'])){
			$data['kab'] = "";
		}else{
			$data['kab'] = $this->m_data->ambil_data_dropdown_kab($data['id_prov']);
		}
		if($data['id_kec'] == NULL OR empty($data['id_kec'])){
			$data['kel'] = "";
		}else{
			$data['kel'] = $this->m_data->ambil_data_dropdown_kel($data['id_kec']);
		}
		if($data['id_kab'] == NULL OR empty($data['id_kab'])){
			$data['kec'] = "";
		}else{
			$data['kec'] = $this->m_data->ambil_data_dropdown_kec($data['id_kab']);
		}
		$data['kol_provinsi'] = $this->m_rancak->cmd_kol_provinsi();
    if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$id = $this->input->post("id");
				$cr = $this->input->post("cr");
				$id_prov = $this->input->post("id_prov");
				$id_kab = $this->input->post("id_kab");
				$id_kel = $this->input->post("id_kel");
				$id_kec = $this->input->post("id_kec");
				redirect(base_url('data/'.$data['page'].'/view/'.$id.'/'.$cr.'/'.$id_prov.'/'.$id_kab.'/'.$id_kel.'/'.$id_kec));
			}
		}
    else if($mode=='data'){
    	if($data['id'] == 1){
    		echo json_encode($this->m_data->grafik_kab($data['id_prov'],$data['cr']));
    	}else if($data['id'] == 2){
    		echo json_encode($this->m_data->grafik_kec($data['id_kab'],$data['cr']));
    	}else if($data['id'] == 3){
    		echo json_encode($this->m_data->grafik_kel($data['id_kec'],$data['cr']));
    	}else{
    		echo json_encode($this->m_data->grafik_provinsi());
    	}
    }
  }
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("data/header",$data);
	$this->load->view("data/isi");
	$this->load->view("data/footer");
	$this->load->view("data/jsload");
	$this->load->view("data/jscode");
}
function tampil_top($data)
{
	$this->load->view("data/registrasi",$data);
}
// -----------------------------------------------------------END-----------------------------------------
}
