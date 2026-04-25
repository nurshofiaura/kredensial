<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Radiologi extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
		  		$this->login_kah();
          $this->load->model('m_radiologi');
  }
  function login_kah()
  {
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
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==14 ) //admin radiologi
          return TRUE;
          elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==22 ) // radiologi
              return TRUE;
      else
          redirect(base_url('logout'));
  }
	function index(){
		$data['page']="home";
		$data['header'] = "BERANDA";
		$data['title'] = "BERANDA";
		$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$program_no_array = $this->m_umum->ambil_data('a_program','id_program','6'); //radiologi no array
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','3');
		$data['ruangan_id'] = $this->session->id_ruangan;
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
		$this->tampil($data);
	}
  function data_pemeriksaan($id)
  {
		$dt=$this->m_rancak->ambil_tindakan_radiologi($id);
		$data = array();
		foreach($dt as $row){
			$data[] = array("id"=>$row['id_tindakan_tarif'], "text"=>$row['nama_tindakan'].' - ( '.$row['nama_golongan_pemeriksaan'].' - '.$row['nama_struktur_jabatan'].' ) - [ Kelas : '.$row['nama_kelas'].' ] - Tarif/Biaya Tindakan : Rp.'.number_format($row['harga_tindakan']));
		}
		echo json_encode($data);
  }
	function daftar($mode='view'){
		$data['page']="daftar";
		$data['header'] = "DATA PENDAFTARAN PASIEN";
		$data['title'] = "DATA PENDAFTARAN PASIEN";
		$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','6');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','3');
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
		$data['first_date']   = $this->uri->segment(4, 0);
		$data['last_date']   = $this->uri->segment(5, 0);
    $trim_keyword   = urldecode(trim($this->uri->segment(6, 0)));
		$replace_keyword   = preg_replace('/\s+/', ' ', $trim_keyword);
		$data['key'] = str_replace(' ', '-', $replace_keyword);
		if($data['key'] == NULL OR empty($data['key'])){
			$data['key'] = "";
		}
		if($mode=='view'){
      if($data['first_date'] == NULL OR empty($data['first_date'])){
  			$data['first_date'] = "01-".date('m-Y');
  		}
      if($data['last_date'] == NULL OR empty($data['last_date'])){
  			$data['last_date'] = date('d-m-Y');
  		}
		  $this->tampil($data);
      $action = $this->input->post('action');
			if($action == 'BtnProses') {
        $first_date = $this->input->post("first_date");
  			$last_date = $this->input->post("last_date");
        $trim_keyword   = urldecode(trim($this->input->post("key")));
  			$replace_keyword   = preg_replace('/\s+/', ' ', $trim_keyword);
  			$key = str_replace(' ', '-', $replace_keyword);
				redirect(base_url('radiologi/daftar/view/'.$first_date.'/'.$last_date.'/'.$key));
			}
		}
    else if($mode=='data'){
		echo json_encode($this->m_radiologi->pendaftaran_all($data['first_date'],$data['last_date'],$data['key'],$program['ruangan']));
	}
    else if($mode=='billing'){
		echo json_encode($this->m_radiologi->ambil_pemeriksaan_billing($data['first_date']));
	}
  else if($mode=='pmr'){
    if($data['first_date'] == NULL OR empty($data['first_date'])){
      $data['first_date'] = '0';
    }
  echo json_encode($this->m_radiologi->pemeriksaan_penunjang_all($data['first_date']));
  }
	else{
		$data['hamile']  = $this->m_rancak->cmd_hamil();
    $data['cmd_fat'] = $this->m_rancak->cmd_fat();
    $data['cmd_kelas'] = $this->m_rancak->cmd_kelas();
    if($mode=='penunjang'){
      $data['page'] =  $data['page']."_penunjang";
      $data['title'] = "ISI DATA PENUNJANG PASIEN";
      $kondisi=array('id_pendaftaran_unit'=>$data['first_date']); //id_pendaftaran
      $data['jml'] = $this->m_umum->jumlah_record_filter('pemeriksaan_ku',$kondisi);
      if($data['jml'] == 0){
        $data['hamil']  = set_value('hamil',$this->input->post("hamil"));
        $data['bb']  = set_value('bb',$this->input->post("bb"));
        $data['tb']  = set_value('tb',$this->input->post("tb"));
      }else{
        $d = $this->m_umum->ambil_data('pemeriksaan_ku','id_pendaftaran_unit',$data['first_date']);
        $data['id_pemeriksaan_ku'] = set_value('id_pemeriksaan_ku',$d["id_pemeriksaan_ku"]);
        $data['hamil'] = set_value('hamil',$d["hamil"]);
        $data['bb'] = set_value('bb',$d["bb"]);
        $data['tb'] = set_value('tb',$d["tb"]);
      }
      $this->load->view("radiologi/isi",$data);
    }
    if($mode=='aksi_penunjang'){
      $id_pendaftaran = $this->input->post("id_pendaftaran");
      $kondisi=array('id_pendaftaran'=>$id_pendaftaran);
      $jmle = $this->m_umum->jumlah_record_filter('pemeriksaan_ku',$kondisi);
      if($jmle == 0){
        $this->m_radiologi->simpan_pasien_ku_umum();
      }else{
        $this->m_radiologi->edit_pasien_ku_umum();
      }
      $this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
      redirect(base_url('radiologi/daftar'));
    }
    if($mode=='tambah_penunjang'){
      $data['page'] =  $data['page']."_tambah_penunjang";
      if($data['first_date'] == NULL OR empty($data['first_date'])){
  			$data['first_date'] = '0';
  		}
  		$barpendug = $this->m_umum->ambil_data('pendaftaran_unit','barcode_pendaftaran_unit',$data['first_date']);
  		$data['id_pendaftaran']  = set_value('id_pendaftaran',$barpendug['id_pendaftaran']);
      $data['cmd_tindakan_no_null']  = $this->m_rancak->cmd_tindakan_no_null($pegawai['id_ruangan']);
      $data['id_tindakan']  = set_value('id_tindakan',$this->input->post("id_tindakan"));
      $data['hasil_pemeriksaan_penunjang']  = set_value('hasil_pemeriksaan_penunjang',$this->input->post("hasil_pemeriksaan_penunjang"));
      $data['tgl_pemeriksaan_penunjang']  = set_value('tgl_pemeriksaan_penunjang',date('d-m-Y'));
      $this->load->view("radiologi/isi",$data);
    }
    if($mode=='edit_penunjang'){
      $data['page'] =  $data['page']."_edit_penunjang";
      if($data['first_date'] == NULL OR empty($data['first_date'])){
  			$data['first_date'] = '0';
  		}
      $data['cmd_tindakan_no_null']  = $this->m_rancak->cmd_tindakan_no_null($pegawai['id_ruangan']);
      $pmr_pen = $this->m_umum->ambil_data('pemeriksaan_penunjang','id_pemeriksaan_penunjang',$data['first_date']);
  		$data['id_pemeriksaan_penunjang'] = set_value('id_pemeriksaan_penunjang',$pmr_pen["id_pemeriksaan_penunjang"]);
  		$data['id_tindakan'] = set_value('id_tindakan',$pmr_pen["id_tindakan"]);
  		$data['hasil_pemeriksaan_penunjang'] = set_value('hasil_pemeriksaan_penunjang',$pmr_pen["hasil_pemeriksaan_penunjang"]);
  		$data['tgl_pemeriksaan_penunjang'] = set_value('tgl_pemeriksaan_penunjang',date('d-m-Y', strtotime($pmr_pen["tgl_pemeriksaan_penunjang"])));
      $this->load->view("radiologi/isi",$data);
    }
    if($mode=='hapus_penunjang'){
      $data['page'] =  $data['page']."_hapus_penunjang";
      if($data['first_date'] == NULL OR empty($data['first_date'])){
  			$data['first_date'] = '0';
  		}
      $pmr_pen = $this->m_umum->ambil_data('pemeriksaan_penunjang','id_pemeriksaan_penunjang',$data['first_date']);
  		$data['id_pemeriksaan_penunjang'] = set_value('id_pemeriksaan_penunjang',$pmr_pen["id_pemeriksaan_penunjang"]);
      $this->load->view("radiologi/isi",$data);
    }
    if($mode=='simpan_tambah_penunjang'){
      $this->m_radiologi->simpan_pemeriksaan_penunjang();
    }
    if($mode=='simpan_edit_penunjang'){
      $this->m_radiologi->edit_pemeriksaan_penunjang();
    }
    if($mode=='simpan_hapus_penunjang'){
      $id_pemeriksaan_penunjang = $this->input->post("daftar");
      $this->m_umum->hapus_data('pemeriksaan_penunjang','id_pemeriksaan_penunjang',$id_pemeriksaan_penunjang);
    }
    if($mode=='tabelpenunjang'){
      $data['page'] =  $data['page']."_tabelpenunjang";
      if($data['first_date'] == NULL OR empty($data['first_date'])){
  			$data['first_date'] = '0';
  		}
      $this->load->view("radiologi/isi",$data);
    }
    if($mode=='pemeriksaane'){
      $data['page'] =  $data['page']."_pemeriksaane";
//      $data['ambil_pemeriksaan_billing'] = $this->m_rancak->ambil_pemeriksaan_billing($data['first_date']);
      $pdu = $this->m_umum->ambil_data('pendaftaran_unit','barcode_pendaftaran_unit',$data['first_date']);
 //     $data['data_pemeriksaan'] = $this->data_pemeriksaan('0');
      $data['sum_billing'] = $this->m_rancak->sum_billing($data['first_date']);
      $pmrs = $this->m_umum->ambil_data('pemeriksaan','id_pendaftaran_unit',$pdu['id_pendaftaran_unit']);
      $d = $this->m_umum->ambil_data('pemeriksaan_ku','id_pendaftaran_unit',$pdu['id_pendaftaran']);
      $data['id_pemeriksaan_ku'] = set_value('id_pemeriksaan_ku',$d["id_pemeriksaan_ku"]);
      $data['hamil'] = set_value('hamil',$d["hamil"]);
      $data['bb'] = set_value('bb',$d["bb"]);
      $data['tb'] = set_value('tb',$d["tb"]);
      $data['id_pendaftaran_unit']  = set_value('id_pendaftaran_unit',$pdu['id_pendaftaran_unit']);
      $kondisi=array('id_pendaftaran_unit'=>$pdu['id_pendaftaran_unit']); //id_pendaftaran
      $data['jml'] = $this->m_umum->jumlah_record_filter('pemeriksaan',$kondisi);
      if($data['jml'] == 0){
        $data['tgl_pemeriksaan'] = set_value('tgl_pemeriksaan',date('d-m-Y'));
      }else{
	      $data['tgl_pemeriksaan'] = set_value('tgl_pemeriksaan',date('d-m-Y', strtotime($pmrs['tgl_pemeriksaan'])));
      }
      $data['id_fat']  = set_value('id_fat',$this->input->post("id_fat"));
      $data['id_kelas']  = set_value('id_kelas',$this->input->post("id_kelas"));
      $data['jml_billing']  = set_value('jml_billing','1');
      $data['no_pemeriksaan']  = set_value('no_pemeriksaan',$this->input->post('no_pemeriksaan'));
      $this->load->view("radiologi/isi",$data);
    }
    if($mode=='simpan_tambah_pemeriksaan_billing'){
    	$id_pendaftaran_unit = $this->input->post('daftar');
    	$id_tindakan_tarif = $this->input->post('id');
    	$jml = $this->input->post('jml');
    	$no = $this->input->post('no');
			$tgl = $this->input->post('tgl');
			$tgl = date('Y-m-d', strtotime($tgl));
			$d = $this->m_umum->ambil_data('tindakan_tarif','id_tindakan_tarif',$id_tindakan_tarif);
			$kondisi_bil=array('tt.id_tindakan'=>$d['id_tindakan'],'id_pendaftaran_unit'=>$id_pendaftaran_unit,'tgl_pemeriksaan'=>$tgl);
	//		$jml_bil=$this->m_umum->jumlah_record_tabel_pengajuan('billing',$kondisi_bil,'pemeriksaan','id_pemeriksaan');
			$jml_bil=$this->m_radiologi->jumlah_record_tabel_bil_pmr($kondisi_bil);
			if($jml_bil == 0){
    	if(!empty($id_pendaftaran_unit) AND !empty($id_tindakan_tarif) AND !empty($jml) AND $jml > 0){
	    	$id_kelas = $d["id_kelas"];
	    	$harga_tindakan = $d["harga_tindakan"];
	      $last_ide = $this->m_radiologi->simpan_tambah_pemeriksaan_billing($id_kelas);
	      $this->m_radiologi->simpan_tambah_p_billing($last_ide,$harga_tindakan,$id_tindakan_tarif,$jml);
	    }
	  }
    }
    if($mode=='hapus_pemeriksaan'){
      $data['page'] =  $data['page']."_hapus_pemeriksaan";
      if($data['first_date'] == NULL OR empty($data['first_date'])){
  			$data['first_date'] = '0';
  		}
      $pmr_pen = $this->m_umum->ambil_data('pemeriksaan','id_pemeriksaan',$data['first_date']);
  		$data['id_pemeriksaan'] = set_value('id_pemeriksaan',$pmr_pen["id_pemeriksaan"]);
  		$data['id_status_pemeriksaan'] = set_value('id_status_pemeriksaan',$pmr_pen["id_status_pemeriksaan"]);
      $this->load->view("radiologi/isi",$data);
    }
    if($mode=='simpan_hapus_pemeriksaan'){
      $id_pemeriksaan = $this->input->post("id");
      $id_status_pemeriksaan = $this->input->post("status");
			$kondisi_radiologi=array('id_pemeriksaan >='=>$id_pemeriksaan);
			$jml_radiologi = $this->m_umum->jumlah_record_filter('radiologi',$kondisi_radiologi);
			if($jml_radiologi == 0){
	      $this->m_umum->hapus_data('pemeriksaan','id_pemeriksaan',$id_pemeriksaan);
	      $this->m_umum->hapus_data('billing','id_pemeriksaan',$id_pemeriksaan);				
			}
    }
    if($mode=='tambah'){
      $data['page'] =  $data['page']."_tambah";
      $this->tampil($data);
    }
	 }
	}
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("radiologi/header",$data);
	$this->load->view("radiologi/isi");
	$this->load->view("footer");
	$this->load->view("radiologi/jsload");
	$this->load->view("radiologi/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_top",$data);
	$this->load->view("radiologi/isi");
	$this->load->view("footer");
	$this->load->view("radiologi/jsload");
	$this->load->view("radiologi/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
