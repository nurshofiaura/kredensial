<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Pendaftaran extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
		  
		 			$this->load->model('m_ol_rancak');
          $this->load->model('m_pendaftaran');
          $this->load->model('m_pcare');
          $this->login_kah();
  }
/*  function cek_login_kah(){
  	$link_akses = $this->uri->segment(1, 0);
		$kondisi_hak=array('id_pegawai'=>$this->session->id_pegawai,'link_akses'=>$link_akses);
		$jumlah_hak_akses_pegawai=$this->m_ol_rancak->jumlah_hak_akses_pegawai($kondisi_hak);
		if($jumlah_hak_akses_pegawai == 0){
			$this->session->set_flashdata('danger', 'Hubungi Admin Untuk Aktifasi');
			redirect(base_url('member'));
		}else{
			return TRUE;
		}
  }
  function cek_online_kah(){
  	  $kode_online = $this->uri->segment(1, 0);
	 		$kondisi_cek_online=array('id_pegawai'=>$this->session->id_pegawai,'kode_online'=>$kode_online,'enabled'=>1,'status_ol_enabled'=>1);
			$jml_cek_online = $this->m_umum->jumlah_record_tabel_pengajuan('a_ol_enabled',$kondisi_cek_online,'a_online','id_kode_online');
			if($jml_cek_online == 0){
				$this->cek_login_kah();
			}else{
				if ( $this->session->has_userdata('id_pegawai')){
					return TRUE;
				}else{
					redirect(base_url());
				}
			}
  }
  function developer_kah(){
      if ( $this->session->has_userdata('bekerja') && $this->session->userdata('bekerja') > 0 )
          $this->cek_online_kah();
      else
				$this->session->set_flashdata('danger', 'Harap Login Dengan Instansi');
				redirect(base_url('member'));      
  }*/
  function cek_login_kah(){
  	$link_akses = $this->uri->segment(1, 0);
		$kondisi_hak=array('id_pegawai'=>$this->session->id_pegawai,'link_akses'=>$link_akses);
		$jumlah_hak_akses_pegawai=$this->m_rancak->jumlah_hak_akses_pegawai($kondisi_hak);
		if($jumlah_hak_akses_pegawai == 0){
			$this->ol_login_kah();
		}else{
			return TRUE;
		}
  }
  function ol_login_kah(){
  	  $kode_online = $this->uri->segment(1, 0);
	 		$kondisi_cek_online=array('id_pegawai'=>$this->session->id_pegawai,'kode_online'=>$kode_online,'enabled'=>1,'status_ol_enabled'=>1);
			$jml_cek_online = $this->m_umum->jumlah_record_tabel_pengajuan('a_ol_enabled',$kondisi_cek_online,'a_online','id_kode_online');
			if($jml_cek_online == 0){
				redirect(base_url('member'));
			}else{
				if ( $this->session->has_userdata('id_pegawai')){
					if($this->session->refer > 0 && $this->session->unit > 0){
						return TRUE;
					}else{
						$this->session->set_flashdata('danger', 'Unit dan Instansi Belum di set, Hubungi Admin');
						redirect(base_url('member'));
					}
				}else{
					redirect(base_url('member'));
				}
			}
  }
  function login_kah()
  {
      if ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==99 )
          return TRUE;
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==98 )
          return TRUE;
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==97 )
          return TRUE;
      else
        //  redirect(base_url('logout'));
         // redirect(base_url('member'));
     		// $this->developer_kah();
      $this->cek_login_kah();
  }
	function index(){
		$data['page']="home";
		$data['header'] = "BERANDA";
		$data['title'] = "BERANDA";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program',10);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$stpeg = $this->m_umum->ambil_data('a_online','kode_online','ol_status_pegawai');
		$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
		$propinsie = $this->m_umum->ambil_data('ol_pengcab','id_pengcab',$pegawai['id_pengcab']);
		$data['prov_id'] = $propinsie["id_prov"];
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
		//======================= IMPORTANT =========================================
		$this->tampil($data);
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
	function check_rm(){
		$rm=$this->input->post('rm');
		$kondisi=array('rm'=>$rm);
		$jml = $this->m_umum->jumlah_record_filter('pasien',$kondisi);
		if($jml == 0){
			echo "<span style='color:green'> RM Tersedia.</span>";
		}else{
			echo "<span style='color:red'> RM Sudah Ada</span>";
		}
	}
	function check_nik(){
		$nik=$this->input->post('nik');
		$kondisi=array('nik'=>$nik);
		$jml = $this->m_umum->jumlah_record_filter('pasien',$kondisi);
		if($jml == 0){
			echo "<span style='color:green'> NIK Tersedia.</span>";
		}else{
			echo "<span style='color:red'> NIK Sudah Ada</span>";
		}
	}
	function pasien($mode='view'){
		$data['page']="pasien";
		$data['header'] = "DATA PASIEN";
		$data['title'] = "DATA PASIEN";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program',10);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$stpeg = $this->m_umum->ambil_data('a_online','kode_online','ol_status_pegawai');
		$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
		$propinsie = $this->m_umum->ambil_data('ol_pengcab','id_pengcab',$pegawai['id_pengcab']);
		$data['prov_id'] = $propinsie["id_prov"];
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
				redirect(base_url('pendaftaran/pasien/view/'.$key));
			}
		}
    else if($mode=='data'){
		$key   = urldecode(trim($this->uri->segment(4, 0)));
		$key = strtolower($key);
		$key = preg_replace('/[^A-Za-z0-9\-]/', '', $key);
		$key = str_replace(' ', '-', $key);
		echo json_encode($this->m_pendaftaran->pasien_baru_all($key));
	}
	else{
		$data['kol_golongan_darah'] = $this->m_rancak->cmd_kol_golongan_darah();
		$data['cmd_jk'] = $this->m_rancak->cmd_jk();
		$data['kol_status_kawin'] = $this->m_rancak->cmd_status_kawin_null();
		$data['agama'] = $this->m_rancak->cmd_agama_null();
		$data['kol_provinsi'] = $this->m_rancak->cmd_kol_provinsi();
	//	$data['kol_provinsi']=$this->m_umum->ambil_data_dropdown("kol_provinsi");
		$data['pendidikan'] = $this->m_rancak->cmd_pendidikan_null();
		$data['kol_pekerjaan'] = $this->m_rancak->cmd_kol_pekerjaan();
    $data['kab']=array("");
    $data['kec']=array("");
    $data['kel']=array("");
    if($mode=='tambah'){
      $data['page'] =  $data['page']."_tambah";
  		$get_rm = $this->m_rancak->get_rm();
  		$data['rm']  = set_value('rm',$get_rm);
  		$data['nik']  = set_value('nik',$this->input->post('nik'));
  		$data['nama_pasien']  = set_value('nama_pasien',$this->input->post('nama_pasien'));
  		$data['tmp_lahir']  = set_value('tmp_lahir',$this->input->post('tmp_lahir'));
  		$data['tgl_lahir']  = set_value('tgl_lahir',$this->input->post('tgl_lahir'));
  		$data['id_golongan_darah']  = set_value('id_golongan_darah',$this->input->post('id_golongan_darah'));
  		$data['id_agama']  = set_value('id_agama',$this->input->post('id_agama'));
  		$data['jk']  = set_value('jk',$this->input->post('jk'));
  		$data['alamat']  = set_value('alamat',$this->input->post('alamat'));
  		$data['id_kab']  = set_value('id_kab',$this->input->post('id_kab'));
  		$data['id_kel']  = set_value('id_kel',$this->input->post('id_kel'));
  		$data['id_kec']  = set_value('id_kec',$this->input->post('id_kec'));
  		$data['id_prov']  = set_value('id_prov',$this->input->post('id_prov'));
  		$data['telepon']  = set_value('telepon',$this->input->post('telepon'));
  		$data['id_pendidikan']  = set_value('id_pendidikan',$this->input->post('id_pendidikan'));
  		$data['id_pekerjaan']  = set_value('id_pekerjaan',$this->input->post('id_pekerjaan'));
  		$data['id_status_kawin']  = set_value('id_status_kawin',$this->input->post('id_status_kawin'));
  		$data['nama_pasangan']  = set_value('nama_pasangan',$this->input->post('nama_pasangan'));
  		$data['nama_ayah']  = set_value('nama_ayah',$this->input->post('nama_ayah'));
  		$data['nik_ayah']  = set_value('nik_ayah',$this->input->post('nik_ayah'));
  		$data['nik_ibu']  = set_value('nik_ibu',$this->input->post('nik_ibu'));
  		$data['nama_ibu']  = set_value('nama_ibu',$this->input->post('nama_ibu'));
  		$data['umure']  = set_value('umure',$this->input->post('umure'));
  		$data['harie']  = date('d');
  		$data['bulane']  = date('m');
  		$data['tahune']  = date('Y');
		  $this->form_validation->set_rules('rm','rm','required');
        if ($this->form_validation->run() === FALSE){
			     $this->tampil($data);
        }else{
    			$rm = $this->input->post('rm');
    			$nik = $this->input->post('nik');
    			$tgl_lahir = $this->input->post('tgl_lahir');
    			$datekah = $this->m_rancak->validateDate($tgl_lahir);
    			$tgl_lahir = date('Y-m-d', strtotime($tgl_lahir));
			if(date('Y', strtotime($tgl_lahir)) > '1850'){
				if($datekah == true){
				$px = $this->m_umum->ambil_data('pasien','rm',$rm);
				$id_pasien = $px['id_pasien'];
				$kondisi2=array('nik'=>$nik);
				$kondisi=array('rm'=>$rm);
				$jml2 = $this->m_umum->jumlah_record_filter('pasien',$kondisi2);
				$jml = $this->m_umum->jumlah_record_filter('pasien',$kondisi);
				if($jml == 0 AND $jml2 == 0){
				  if($last_ide = $this->m_pendaftaran->simpan_pasien($pegawai['id_pegawai'])){
						$this->session->set_flashdata('sukses', 'Data berhasil Di Tambah');
						//redirect(base_url('pendaftaran/daftar/tambah/'.$last_ide));
						redirect(base_url('pendaftaran/pasien'));
					}else{
						$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data');
						redirect(base_url('pendaftaran/pasien'));
				  }
				}else{
					$this->session->set_flashdata('danger', 'No NIK / RM Sudah Ada');
					redirect(base_url('pendaftaran/pasien/tambah/'.$id_pasien));
				}
				}else{
					$this->session->set_flashdata('danger', 'Data Tanggal Lahir Tidak Valid');
					redirect(base_url('pendaftaran/pasien/tambah/'.$id_pasien));
				}
			}
			else{
				$this->session->set_flashdata('danger', 'Data Tahun Lahir Tidak Valid');
				redirect(base_url('pendaftaran/pasien/tambah/'.$id_pasien));
				}
        }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
    		$d = $this->m_umum->ambil_data('pasien','barcode_pasien',$data['key']);
    		$data['id_pasien'] = set_value('id_pasien',$d['id_pasien']);
    		$data['rm'] = set_value('rm',$d['rm']);
    		$data['nik'] = set_value('nik',$d['nik']);
    		$data['nama_pasien'] = set_value('nama_pasien',$d['nama_pasien']);
    		$data['tmp_lahir'] = set_value('tmp_lahir',$d['tmp_lahir']);
    		$data['tgl_lahir'] = set_value('tgl_lahir',date('d-m-Y', strtotime($d['tgl_lahir'])));
    		$data['id_golongan_darah'] = set_value('id_golongan_darah',$d['id_golongan_darah']);
    		$data['id_agama'] = set_value('id_agama',$d['id_agama']);
    		$data['jk'] = set_value('jk',$d['jk']);
    		$data['alamat'] = set_value('alamat',$d['alamat']);
    		$data['kab'] = $this->m_rancak->ambil_data_dropdown_kabs($d['id_prov']);
    		$data['kec'] = $this->m_rancak->ambil_data_dropdown_kecs($d['id_kab']);
    		$data['kel'] = $this->m_rancak->ambil_data_dropdown_kels($d['id_kec']);
    		$data['id_kab'] = set_value('id_kab',$d['id_kab']);
    		$data['id_kel'] = set_value('id_kel',$d['id_kel']);
    		$data['id_kec'] = set_value('id_kec',$d['id_kec']);
    		$data['id_prov'] = set_value('id_prov',$d['id_prov']);
    		$data['telepon'] = set_value('telepon',$d['telepon']);
    		$data['id_pendidikan'] = set_value('id_pendidikan',$d['id_pendidikan']);
    		$data['id_pekerjaan'] = set_value('id_pekerjaan',$d['id_pekerjaan']);
    		$data['id_status_kawin'] = set_value('id_status_kawin',$d['id_status_kawin']);
    		$data['nama_pasangan'] = set_value('nama_pasangan',$d['nama_pasangan']);
    		$data['nama_ayah'] = set_value('nama_ayah',$d['nama_ayah']);
  		$data['nik_ayah']  = set_value('nik_ayah',$this->input->post('nik_ayah'));
  		$data['nik_ibu']  = set_value('nik_ibu',$this->input->post('nik_ibu'));
    		$data['nama_ibu'] = set_value('nama_ibu',$d['nama_ibu']);
    		$data['umure']  = set_value('umure',$this->input->post('umure'));
    		$data['harie']  = date('d');
    		$data['bulane']  = date('m');
    		$data['tahune']  = date('Y');
		$this->form_validation->set_rules('rm','rm','required');
        if ($this->form_validation->run() === FALSE){
					$this->tampil($data);
        }else{
/*    			$nik = $this->input->post('nik');
    			$nik_lama = $this->input->post('nik_lama');
				$kondisi=array('nik'=>$nik);
				$kondisi2=array('nik'=>$nik_lama);
				$jml2 = $this->m_umum->jumlah_record_filter('pasien',$kondisi2);
				$jml = $this->m_umum->jumlah_record_filter('pasien',$kondisi);
					if($jml == 0 AND $jml2 > 0){*/
					  if($this->m_pendaftaran->edit_pasien()){
							$rm = $this->input->post('rm');
							$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
							redirect(base_url('pendaftaran/pasien'));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Masalah Edit Data');
							redirect(base_url('pendaftaran/pasien'));
					  }
/*					}else{
							$this->session->set_flashdata('danger', 'NIK Sudah Ada');
							redirect(base_url('pendaftaran/pasien'));
					}*/
        }
      }
	}
	}
  function pegawai_daftar($id)
  {
    $dt=$this->m_ol_rancak->ambil_pegawai_daftar($id);
    echo json_encode($dt);
  }
  function cara_bayar_data($id)
  {
    $dt=$this->m_rancak->ambil_data_dropdown_cara_bayar($id);
    echo json_encode($dt);
  }
  function cara_rujukan_instansi($id)
  {
    $dt=$this->m_rancak->ambil_data_dropdown_rujukan_instansi($id);
    echo json_encode($dt);
  }
  function rujukan_dokter_data($id)
  {
    $dt=$this->m_rancak->ambil_data_dropdown_rujukan_dokter($id);
    echo json_encode($dt);
  }
  function unit_data($id)  //Untuk Cascading Pulldown Wilayah
  {
    $dt=$this->m_pendaftaran->ambil_data_dropdown_radiologi_unit($id);
    echo json_encode($dt);
  }
  function pengirim_data($id)  //Untuk Cascading Pulldown Wilayah
  {
    $dt=$this->m_rancak->ambil_data_dropdown_radiologi_pengirim($id);
    echo json_encode($dt);
  }
  function cari_icd10(){
    $id=$this->input->get('query');
    $hasil=array();
    $data=$this->m_ol_rancak->a_icd10($id);
    $hasil['suggestions']=$data;
    echo json_encode($hasil);
  }
  function data_pemeriksaan($id)
  {
    $idt = array(0,6);
    $dt=$this->m_pendaftaran->ambil_tindakan_radiologi($id,$idt);
		$data = array();
		foreach($dt as $row){
			$data[] = array("id"=>$row['barcode_tindakan_tarif'], "text"=>$row['nama_tindakan'].' => '.$row['nama_golongan_pemeriksaan'].' - Tarif/Biaya Tindakan : Rp.'.number_format($row['harga_tindakan']));
		}
		echo json_encode($data);
  }
	function daftar($mode='view'){
		$data['page']="daftar";
		$data['header'] = "DATA PENDAFTARAN PASIEN";
		$data['title'] = "DATA PENDAFTARAN PASIEN";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program',10);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$stpeg = $this->m_umum->ambil_data('a_online','kode_online','ol_status_pegawai');
		$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
		$propinsie = $this->m_umum->ambil_data('ol_pengcab','id_pengcab',$pegawai['id_pengcab']);
		$data['prov_id'] = $propinsie["id_prov"];
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
		$data['room_id'] = $this->session->unit;
		//======================= IMPORTANT =========================================
		$data['first_date']   = $this->uri->segment(4, 0);
		$data['last_date']   = $this->uri->segment(5, 0);
    $trim_keyword   = urldecode(trim($this->uri->segment(6, 0)));
		$replace_keyword   = preg_replace('/\s+/', ' ', $trim_keyword);
		$data['key'] = str_replace(' ', '-', $replace_keyword);
		if($data['key'] == NULL OR empty($data['key'])){
			$data['key'] = "";
		}
		if($data['first_date'] == NULL OR empty($data['first_date'])){
			$data['first_date'] = "01-".date('m-Y');
		}
		if($data['last_date'] == NULL OR empty($data['last_date'])){
			$data['last_date'] = date('d-m-Y');
		}
		if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
			if($action == 'BtnProses') {
        $trim_keyword   = urldecode(trim($this->input->post("key")));
  			$replace_keyword   = preg_replace('/\s+/', ' ', $trim_keyword);
  			$key = str_replace(' ', '-', $replace_keyword);
			$first_date = $this->input->post("first_date");
			$last_date = $this->input->post("last_date");
				redirect(base_url('pendaftaran/daftar/view/'.$first_date.'/'.$last_date.'/'.$key));
			}
		}
    else if($mode=='data'){
		echo json_encode($this->m_pendaftaran->pendaftaran_pasien_all($data['first_date'],$data['last_date'],$data['key']));
	}
    else if($mode=='billing'){
		echo json_encode($this->m_pendaftaran->ambil_pemeriksaan_billing($data['first_date']));
	}
    else if($mode=='histori'){
    echo json_encode($this->m_ol_rancak->histori_px($data['first_date']));
  }
    else if($mode=='penunjang'){
    echo json_encode($this->m_ol_rancak->penunjang_luar($data['first_date']));
  }
    else if($mode=='sparkling'){
    echo json_encode($this->m_ol_rancak->tabel_sparkling_line($data['first_date']));
  }
    else if($mode=='hasil_lab_all'){
    echo json_encode($this->m_ol_rancak->hasil_lab_all($data['first_date']));
  }
    else if($mode=='radiolog'){
    echo json_encode($this->m_ol_rancak->tabel_radiologi_result($data['first_date']));
  }
	else{
		    $data['cmd_kelas'] = $this->m_rancak->cmd_kelas();
		$data['ambil_data_daftar_no_null'] = $this->m_ol_rancak->ambil_data_daftar_no_null();
		$data['cmd_kelas_tindakan'] = $this->m_rancak->cmd_kelas_tindakan();
		$data['cmd_jk'] = $this->m_rancak->cmd_jk();
		$data['kol_cara_masuk']=$this->m_rancak->pd_cara_masuk();
		$data['kol_cara_bayar']=$this->m_rancak->pd_cara_bayar();
		$data['kol_detil_cara_bayar']=array("");
		$data['rujukanrs']=array("");
		$data['unit']=$this->m_pendaftaran->ambil_data_pelayanan_no_null();
		$data['jabatan']=$this->m_ol_rancak->ambil_jabatan_pendaftaran_pasien();
		$data['icd10']=$this->m_ol_rancak->ambil_a_icd10();
		$data['pegawai']=$this->m_rancak->ambil_pegawai_daftar();
		$data['rujukandokter']=$this->m_rancak->ambil_data_dropdown_rujukan_dokter($program['ol_unit']);
		$get_no_pendaftaran = $this->m_rancak->get_no_urut_pendaftaran();
    if($mode=='tambah'){
      $data['page'] =  $data['page']."_tambah";
			$data['rujukandokter']=array("");
			$data['radiologi_unit']=array("");
			$data['radiologi_pengirim']=array("");
			$data['penanggungjawab']=array("");
			$d = $this->m_umum->ambil_data('pasien','barcode_pasien',$data['first_date']);
			$data['id_pasien'] = set_value('id_pasien',$d['id_pasien']);
			$data['barcode_pasien'] = set_value('barcode_pasien',$d['barcode_pasien']);
			$data['no_pendaftaran']  = set_value('no_pendaftaran',$get_no_pendaftaran);
			$data['rm'] = set_value('rm',$d['rm']);
			$data['nik'] = set_value('nik',$d['nik']);
			$data['nama_pasien'] = set_value('nama_pasien',$d['nama_pasien']);
			if($d['jk'] == '1'){ $jk = 'Laki-laki'; }else{ $jk = 'Perempuan';}
			$data['jk'] = $jk;
			$birthage = $d['tgl_lahir'];
			$interval = date_diff(date_create(), date_create($birthage));
			$umur = $interval->format("%Y Tahun, %M Bulan, %d Hari");
			$data['umur'] = set_value('umur',$umur);
			$data['id_icd10']  = set_value('id_icd10',$this->input->post('id_icd10'));
			$data['nama_icd10']  = set_value('nama_icd10',$this->input->post('nama_icd10'));
			$data['id_pegawai']  = set_value('id_pegawai',$this->input->post('id_pegawai'));
			$data['id_cara_masuk']  = set_value('id_cara_masuk',$this->input->post('id_cara_masuk'));
			$data['id_cara_bayar']  = set_value('id_cara_bayar',$this->input->post('id_cara_bayar'));
			$data['id_detil_cara_bayar']  = set_value('id_detil_cara_bayar',$this->input->post('id_detil_cara_bayar'));
			$data['id_rujukan_dokter']  = set_value('id_rujukan_dokter',$this->input->post('id_rujukan_dokter'));
			$data['id_rujukan_instansi']  = set_value('id_rujukan_instansi',$this->input->post('id_rujukan_instansi'));
			$data['ket_pendaftaran_unit']  = set_value('ket_pendaftaran_unit',$this->input->post('ket_pendaftaran_unit'));
			$data['id_petugas']  = set_value('id_petugas',$this->input->post('id_petugas'));
			$data['id_unit']  = set_value('id_unit',$this->input->post('id_unit'));
			$data['id_kelas']  = set_value('id_kelas',$this->input->post('id_kelas'));
			$data['ruangan']  = set_value('ruangan',$this->input->post('ruangan'));
			$data['pengirim']  = set_value('pengirim',$this->input->post('pengirim'));
			$data['keluhan']  = set_value('keluhan',$this->input->post('keluhan'));
			$data['no_bpjs']  = set_value('no_bpjs',$this->input->post('no_bpjs'));
			$data['id_jabatan']  = set_value('id_jabatan',$this->input->post('id_jabatan'));
			$data['waktu_daftar']  = set_value('waktu_daftar',date('d-m-Y'));
			$this->form_validation->set_rules('rm','rm','required');
      if ($this->form_validation->run() === FALSE){
				$this->tampil($data);
      }else{
  			  if($last_ide = $this->m_pendaftaran->simpan_pendaftaran()){
	  				$this->m_pendaftaran->simpan_pendaftaran_unit4($last_ide);
	  				$this->session->set_flashdata('sukses', 'Data berhasil Di Tambah');
	  				redirect(base_url('pendaftaran/daftar'));
  			  }else{
  					$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data');
  					redirect(base_url('pendaftaran/daftar'));
  			  }
      }
    }
/*        if($mode=='edit'){
          $data['page'] =  $data['page']."_edit";
					$d = $this->m_umum->ambil_data('pendaftaran_unit','barcode_pendaftaran_unit',$data['first_date']);
					$dx = $this->m_umum->ambil_data('pendaftaran','barcode_pendaftaran',$d['barcode_pendaftaran']);
					$data['barcode_pendaftaran_unit'] = set_value('barcode_pendaftaran_unit',$d['barcode_pendaftaran_unit']);
					$data['barcode_pendaftaran'] = set_value('barcode_pendaftaran',$d['barcode_pendaftaran']);
					$data['barcode_pasien'] = set_value('barcode_pasien',$dx['barcode_pasien']);
					$data['id_pegawai'] = set_value('id_pegawai',$d['dr_petugas']);
					$data['unit_ke'] = set_value('unit_ke',$d['unit_ke']);
					$data['id_kelas'] = set_value('id_kelas',$d['id_kelas']);
					$data['ket_pendaftaran_unit'] = set_value('ket_pendaftaran_unit',$d['ket_pendaftaran_unit']);
					$data['no_antri'] = set_value('no_antri',$d['no_antri']);
			//		$data['tgl_pendaftaran_unit'] = set_value('tgl_pendaftaran_unit',$d['tgl_pendaftaran_unit']);
					$data['tgl_pendaftaran_unit'] = set_value('tgl_pendaftaran_unit',date('d-m-Y',strtotime($d['tgl_pendaftaran_unit'])));
					$data['id_jabatan']  = set_value('id_jabatan',$this->input->post('id_jabatan'));
      		$this->load->view("pendaftaran/isi",$data);
        }
        if($mode=='simpan_edit'){

					$tgl_pendaftaran_unit = date('Y-m-d', strtotime($tgl_pendaftaran_unit));
					$kondisi=array('no_antri'=>200);
					$jml = $this->m_umum->jumlah_record_tabel('pendaftaran_unit',$kondisi);
					if($jml == 0){
            if($this->m_pendaftaran->edit_pendaftaran_unit()){
           // 	$this->m_pendaftaran->edit_pemeriksaan();
              $this->session->set_flashdata('sukses', 'Data Berhasil Di Update');
              redirect(base_url('pendaftaran/daftar'));
            }else{
              $this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
              redirect(base_url('pendaftaran/daftar'));
            }
					}else{
              $this->session->set_flashdata('danger', 'Data induk tidak dapat dirubah');
              redirect(base_url('pendaftaran/daftar'));
					}
        }*/
		    if($mode=='edit'){
		      $data['page'] =  $data['page']."_edit";
		      $data['kembali'] = base_url('pendaftaran/daftar');
		      $pd = $this->m_ol_rancak->ambil_data_pasien($data['first_date']);
		      $data['barcode_pendaftaran_unit'] = $pd['barcode_pendaftaran_unit'];
		      $data['barcode_pendaftaran'] = $pd['barcode_pendaftaran'];
		      $data['wkt_daftar'] = $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($pd['wkt_daftar'])));
		      // ==================================================== POKOK
		      $this->tampil_top($data);
		    }
    if($mode=='pemeriksaane'){
      $data['page'] =  $data['page']."_pemeriksaane";
      $pdu = $this->m_umum->ambil_data('pendaftaran_unit','barcode_pendaftaran_unit',$data['first_date']);
      $pd = $this->m_umum->ambil_data('pendaftaran','barcode_pendaftaran',$pdu['barcode_pendaftaran']);
      $data['sum_billing'] = $this->m_rancak->sum_billing($data['first_date']);
      $pmrs = $this->m_umum->ambil_data('pemeriksaan','barcode_pendaftaran_unit',$data['first_date']);
      $data['barcode_pendaftaran_unit']  = set_value('barcode_pendaftaran_unit',$pdu['barcode_pendaftaran_unit']);
      $data['id_status_pasien']  = set_value('id_status_pasien',$pdu['id_status_pasien']);
      $kondisi=array('barcode_pendaftaran_unit'=>$pdu['barcode_pendaftaran_unit']); //id_pendaftaran
      $data['jml'] = $this->m_umum->jumlah_record_filter('pemeriksaan',$kondisi);
      if($data['jml'] == 0){
        $data['tgl_pemeriksaan'] = set_value('tgl_pemeriksaan',date('d-m-Y'));
      }else{
	      $data['tgl_pemeriksaan'] = set_value('tgl_pemeriksaan',date('d-m-Y', strtotime($pmrs['tgl_pemeriksaan'])));
      }
      $px  = $this->m_ol_rancak->ambil_data_pasien($data['first_date']);
      $data['tgl_lahir']  = set_value('tgl_lahir',$px['tgl_lahir']);
      $data['id_cara_bayar']  = set_value('id_cara_bayar',$pd['id_cara_bayar']);
      $data['id_detil_cara_bayar']  = set_value('id_detil_cara_bayar',$pd['id_detil_cara_bayar']);
      $data['id_fat']  = set_value('id_fat',$this->input->post("id_fat"));
      $data['id_kelas']  = set_value('id_kelas',$this->input->post("id_kelas"));
      $data['jml_billing']  = set_value('jml_billing','1');
      $data['no_pemeriksaan']  = set_value('no_pemeriksaan',$this->input->post('no_pemeriksaan'));
      $data['ket_pemeriksaan']  = set_value('ket_pemeriksaan',$this->input->post('ket_pemeriksaan'));
      $this->load->view("pendaftaran/isi",$data);
    }
    if($mode=='simpan_tambah_pemeriksaan_billing'){
    	$id_status_pasien = $this->input->post('st');
      $barcode_pendaftaran_unit = $this->input->post('daftar');
    	$barcode_tindakan_tarif = $this->input->post('id');
      $tgl_lahir = $this->input->post('tgl_lahir');
    	$jml = $this->input->post('jml');
    	$no = $this->input->post('no');
			$tgl = $this->input->post('tgl');
			$tgl = date('Y-m-d', strtotime($tgl));
			$d = $this->m_umum->ambil_data('tindakan_tarif','barcode_tindakan_tarif',$barcode_tindakan_tarif);
			$kondisi_bil=array('tt.id_tindakan'=>$d['id_tindakan'],'barcode_pendaftaran_unit'=>$barcode_pendaftaran_unit,'tgl_pemeriksaan'=>$tgl);
	//		$jml_bil=$this->m_umum->jumlah_record_tabel_pengajuan('billing',$kondisi_bil,'pemeriksaan','id_pemeriksaan');
			  $jml_bil=$this->m_ol_rancak->jumlah_record_tabel_bil_pmr($kondisi_bil);
  			if($jml_bil == 0){
        	if(!empty($barcode_pendaftaran_unit) AND !empty($barcode_tindakan_tarif) AND !empty($jml) AND $jml > 0){
            if((0 < $id_status_pasien) && ($id_status_pasien < 3)){
      	    	$id_kelas = $d["id_kelas"];
      	    	$harga_tindakan = $d["harga_tindakan"];
              $barcode_tindakan_tarif = $d["barcode_tindakan_tarif"];
      	      $last_ide = $this->m_ol_rancak->simpan_tambah_pemeriksaan_billing($id_kelas);
      	      $this->m_ol_rancak->simpan_tambah_p_billing($last_ide,$harga_tindakan,$barcode_tindakan_tarif,$jml);
            }
    	    }
  	    }
    }
    if($mode=='hapus_pemeriksaan'){
      $data['page'] =  $data['page']."_hapus_pemeriksaan";
      if($data['first_date'] == NULL OR empty($data['first_date'])){
  			$data['first_date'] = '0';
  		}
      $pmr_pen = $this->m_umum->ambil_data('pemeriksaan','barcode_pemeriksaan',$data['first_date']);
  		$data['barcode_pemeriksaan'] = set_value('barcode_pemeriksaan',$pmr_pen["barcode_pemeriksaan"]);
  		$data['id_status_pemeriksaan'] = set_value('id_status_pemeriksaan',$pmr_pen["id_status_pemeriksaan"]);
      $this->load->view("ugd/isi",$data);
    }
    if($mode=='simpan_hapus_pemeriksaan'){
      $barcode_pemeriksaan = $this->input->post("id");
      $id_status_pemeriksaan = $this->input->post("status");
			$kondisi_radiologi=array('barcode_pemeriksaan'=>$barcode_pemeriksaan,'id_status_pemeriksaan >'=>0);
			$jml_radiologi = $this->m_umum->jumlah_record_filter('pemeriksaan',$kondisi_radiologi);
			if($jml_radiologi == 0){
	      $this->m_umum->hapus_data('pemeriksaan','barcode_pemeriksaan',$barcode_pemeriksaan);
	      $this->m_umum->hapus_data('billing','barcode_pemeriksaan',$barcode_pemeriksaan);				      
			}
    }
        if($mode=='send'){
          $data['page'] =  $data['page']."_send";
          $data['id_unit']  = set_value('id_unit',$this->input->post('id_unit'));
          $data['id_kelas']  = set_value('id_kelas',$this->input->post('id_kelas'));
          $data['id_jabatan']  = set_value('id_jabatan',$this->input->post('id_jabatan'));
          $data['ket_pendaftaran_unit']  = set_value('ket_pendaftaran_unit',$this->input->post('ket_pendaftaran_unit'));
          $data['tgl_pendaftaran_unit']  = set_value('tgl_pendaftaran_unit',date('d-m-Y'));
          $data['penanggungjawab']=array("");
          $data['ambil_data_daftar_no_null']=$this->m_ol_rancak->ambil_data_daftar_no_null();
      		$keuangan    = $this->m_umum->ambil_data('pendaftaran','barcode_pendaftaran',$data['first_date']);
          $data['barcode_pendaftaran']  = set_value('barcode_pendaftaran',$keuangan["barcode_pendaftaran"]);
          $data['id_pegawai']  = set_value('id_pegawai',$this->input->post('id_pegawai'));
      		$this->load->view("pendaftaran/isi",$data);
        }
        if($mode=='simpan_send'){
        	$id_unit = $this->input->post('id_unit');
        	$barcode_pendaftaran = $this->input->post('barcode_pendaftaran');
        	$id_pegawai = $this->input->post('id_pegawai');
					$kondisi=array('unit_ke'=>$id_unit,'barcode_pendaftaran'=>$barcode_pendaftaran,'dr_petugas'=>$id_pegawai,'id_status_pasien >'=>0);
					$jml = $this->m_umum->jumlah_record_filter('pendaftaran_unit',$kondisi);
					if($jml == 0){
            if($last_pu = $this->m_pendaftaran->tambah_pendaftaran_unit()){
            //	$this->m_pendaftaran->simpan_pemeriksaan($last_pu);
              $this->session->set_flashdata('sukses', 'Data Berhasil Di Update');
              redirect(base_url('pendaftaran/daftar'));
            }else{
              $this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
              redirect(base_url('pendaftaran/daftar'));
            }
					}else{
              $this->session->set_flashdata('danger', 'Sudah Terdaftar');
              redirect(base_url('pendaftaran/daftar'));
					}
        }
				if($mode=='batal'){
					if($data['last_date'] == 1){
					  if($this->m_pendaftaran->batal($data['first_date'])){
							$this->session->set_flashdata('sukses', 'Pembatalan Berhasil');
							redirect(base_url('pendaftaran/daftar'));
					  }else{
							$this->session->set_flashdata('danger', 'Masalah Edit Data');
							redirect(base_url('pendaftaran/daftar'));
					  }
					}else{
							$this->session->set_flashdata('danger', 'Pemeriksaan Sudah Dilakukan');
							redirect(base_url('pendaftaran/daftar'));
					}
				}
    if($mode=='data_dokter'){
      $data['page'] =  $data['page']."_data_dokter";
      $data['kembali'] = base_url('pendaftaran/daftar');
      $pd = $this->m_ol_rancak->ambil_data_pasien($data['first_date']);
      $data['barcode_pendaftaran_unit'] = $pd['barcode_pendaftaran_unit'];
      $data['barcode_pendaftaran'] = $pd['barcode_pendaftaran'];
      $data['wkt_daftar'] = $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($pd['wkt_daftar'])));
      $data['dokter'] = $this->m_ol_rancak->ambil_pemeriksaan_dokter($data['first_date']);
      // ==================================================== POKOK
      $this->tampil_top($data);
    }
    if($mode=='data_vital'){
      $data['page'] =  $data['page']."_data_vital";
      $data['kembali'] = base_url('pendaftaran/daftar');
      $pd = $this->m_ol_rancak->ambil_data_pasien($data['first_date']);
      $data['barcode_pendaftaran_unit'] = $pd['barcode_pendaftaran_unit'];
      $data['barcode_pendaftaran'] = $pd['barcode_pendaftaran'];
      $data['wkt_daftar'] = $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($pd['wkt_daftar'])));
      $data['vital'] = $this->m_ol_rancak->ambil_data_vital($pd['barcode_pendaftaran']);
      // ==================================================== POKOK
      $this->tampil_top($data);
    }
    if($mode=='data_radiologi'){
      $data['page'] =  $data['page']."_data_radiologi";
      $data['kembali'] = base_url('pendaftaran/daftar');
      $pd = $this->m_ol_rancak->ambil_data_pasien($data['first_date']);
      $data['barcode_pendaftaran_unit'] = $pd['barcode_pendaftaran_unit'];
      $data['barcode_pendaftaran'] = $pd['barcode_pendaftaran'];
      $data['wkt_daftar'] = $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($pd['wkt_daftar'])));
      // ==================================================== POKOK
      $this->tampil_top($data);
    }
    if($mode=='data_lab'){
      $data['page'] =  $data['page']."_data_lab";
      $data['kembali'] = base_url('pendaftaran/daftar');
      $pd = $this->m_ol_rancak->ambil_data_pasien($data['first_date']);
      $data['barcode_pendaftaran_unit'] = $pd['barcode_pendaftaran_unit'];
      $data['barcode_pendaftaran'] = $pd['barcode_pendaftaran'];
      $data['wkt_daftar'] = $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($pd['wkt_daftar'])));
      // ==================================================== POKOK
      $this->tampil_top($data);
    }
    if($mode=='lab_view'){
      $data['page'] =  $data['page']."_lab_view";
      $pd = $this->m_ol_rancak->ambil_data_pasien($data['first_date']);
      $data['barcode_pendaftaran_unit'] = $pd['barcode_pendaftaran_unit'];
      $data['barcode_pendaftaran'] = $pd['barcode_pendaftaran'];
      $data['wkt_daftar'] = $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($pd['wkt_daftar'])));
      $data['lab'] = $this->m_ol_rancak->ambil_pemeriksaan_laboratorium_pd($data['first_date']);
      $this->load->view("pendaftaran/isi",$data);
    }
    if($mode=='grafik_vital'){
      $data['page'] =  $data['page']."_grafik_vital";
      $data['kembali'] = base_url('pendaftaran/daftar');
      $data['grafik'] = $this->m_ol_rancak->grafik_sparkling_line($data['first_date']);
      $pd = $this->m_ol_rancak->ambil_data_pasien($data['first_date']);
      $data['barcode_pendaftaran_unit'] = $pd['barcode_pendaftaran_unit'];
      $data['barcode_pendaftaran'] = $pd['barcode_pendaftaran'];
      $data['wkt_daftar'] = $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($pd['wkt_daftar'])));
      $data['vital'] = $this->m_ol_rancak->ambil_data_vital($pd['barcode_pendaftaran']);
      // ==================================================== POKOK
      $this->tampil_top($data);
    }
    if($mode=='data_asuhan'){
      $data['page'] =  $data['page']."_data_asuhan";
      $data['kembali'] = base_url('pendaftaran/daftar');
      $pd = $this->m_ol_rancak->ambil_data_pasien($data['first_date']);
      $data['barcode_pendaftaran_unit'] = $pd['barcode_pendaftaran_unit'];
      $data['barcode_pendaftaran'] = $pd['barcode_pendaftaran'];
      $data['wkt_daftar'] = $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($pd['wkt_daftar'])));
      $data['vital'] = $this->m_ol_rancak->ambil_data_vital($pd['barcode_pendaftaran']);
      $data['ambil_data_asuhan'] = $this->m_ol_rancak->ambil_data_asuhan($data['first_date']);
      // ==================================================== POKOK
      $data['array_rr_ritme']  = array('1'=>'Terartur','0'=>'Tidak Teratur');  
      $data['kol_gcs_eye']  = $this->m_umum->ambil_data_dropdown('kol_gcs_eye');   
      $data['kol_gcs_motorik']  = $this->m_umum->ambil_data_dropdown('kol_gcs_motorik');   
      $data['kol_gcs_verb']  = $this->m_umum->ambil_data_dropdown('kol_gcs_verb');      
      $data['asuhan_pengkajian_1']=$this->m_ol_rancak->asuhan_pengkajian(1);    
      $data['asuhan_pengkajian_2']=$this->m_ol_rancak->asuhan_pengkajian(2);    
      $data['asuhan_pengkajian_3']=$this->m_ol_rancak->asuhan_pengkajian(3);    
      $data['asuhan_pengkajian_4']=$this->m_ol_rancak->asuhan_pengkajian(4);    
      $data['asuhan_pengkajian_5']=$this->m_ol_rancak->asuhan_pengkajian(5);    
      $data['asuhan_pengkajian_6']=$this->m_ol_rancak->asuhan_pengkajian(6);    
      $data['asuhan_pengkajian_7']=$this->m_ol_rancak->asuhan_pengkajian(7);    
      $data['asuhan_pengkajian_8']=$this->m_ol_rancak->asuhan_pengkajian(8);    
      $data['asuhan_pengkajian_9']=$this->m_ol_rancak->asuhan_pengkajian(9);    
      $data['asuhan_pengkajian_10']=$this->m_ol_rancak->asuhan_pengkajian(10);    
      $data['asuhan_pengkajian_11']=$this->m_ol_rancak->asuhan_pengkajian(11);    
      $data['asuhan_pengkajian_12']=$this->m_ol_rancak->asuhan_pengkajian(12);    
      $data['asuhan_pengkajian_13']=$this->m_ol_rancak->asuhan_pengkajian(13);    
      $data['asuhan_pengkajian_14']=$this->m_ol_rancak->asuhan_pengkajian(14);    
      $data['asuhan_pengkajian_15']=$this->m_ol_rancak->asuhan_pengkajian(15);    
      $data['asuhan_masalah_1']=$this->m_ol_rancak->asuhan_masalah(1);    
      $data['asuhan_masalah_2']=$this->m_ol_rancak->asuhan_masalah(2);    
      $data['asuhan_masalah_3']=$this->m_ol_rancak->asuhan_masalah(3);    
      $data['asuhan_masalah_4']=$this->m_ol_rancak->asuhan_masalah(4);    
      $data['asuhan_masalah_5']=$this->m_ol_rancak->asuhan_masalah(5);    
      $data['asuhan_masalah_6']=$this->m_ol_rancak->asuhan_masalah(6);    
      $data['asuhan_masalah_7']=$this->m_ol_rancak->asuhan_masalah(7);    
      $data['asuhan_masalah_8']=$this->m_ol_rancak->asuhan_masalah(8);    
      $data['asuhan_implementasi_1']=$this->m_ol_rancak->asuhan_implementasi(1);    
      $data['asuhan_implementasi_2']=$this->m_ol_rancak->asuhan_implementasi(2);    
      $data['asuhan_implementasi_3']=$this->m_ol_rancak->asuhan_implementasi(3);    
      $data['asuhan_implementasi_4']=$this->m_ol_rancak->asuhan_implementasi(4);    
      $data['asuhan_implementasi_5']=$this->m_ol_rancak->asuhan_implementasi(5);    
      $data['asuhan_implementasi_6']=$this->m_ol_rancak->asuhan_implementasi(6);    
      $data['asuhan_implementasi_7']=$this->m_ol_rancak->asuhan_implementasi(7);    
      $data['asuhan_implementasi_8']=$this->m_ol_rancak->asuhan_implementasi(8);    
      $data['asuhan_implementasi_9']=$this->m_ol_rancak->asuhan_implementasi(9);    
      $data['asuhan_implementasi_10']=$this->m_ol_rancak->asuhan_implementasi(10);
      $this->tampil_top($data);
    }
    if($mode=='data_ps'){
      $data['page'] =  $data['page']."_data_ps";
      $data['kembali'] = base_url('pendaftaran/daftar');
      $pd = $this->m_ol_rancak->ambil_data_pasien($data['first_date']);
      $data['barcode_pendaftaran_unit'] = $pd['barcode_pendaftaran_unit'];
      $data['barcode_pendaftaran'] = $pd['barcode_pendaftaran'];
      $data['wkt_daftar'] = $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($pd['wkt_daftar'])));
      $data['vital'] = $this->m_ol_rancak->ambil_data_vital($pd['barcode_pendaftaran']);
      $data['rm'] = $pd['rm'];
      $data['nama_pasien'] = $pd['nama_pasien'];
      $data['umur'] = $pd['umur'];
      $data['nama_status_kawin'] = $pd['nama_status_kawin'];
      $data['nama_pasien'] = $pd['nama_pasien'];
      $data['nik'] = $pd['nik'];
      $data['wkt_daftar'] = $this->m_rancak->fullBulan(date('d-m-Y', strtotime($pd['wkt_daftar'])));
      $data['ttl'] = $pd['tmp_lahir'].", ".date('d-m-Y', strtotime($pd['tgl_lahir']));
      $data['alamat'] = $pd['alamat'].", ".$pd['nama_kec'].", ".$pd['nama_kel'].", ".
      $pd['nama_kab'].", ".$pd['nama_prov'];
      $data['nama_golongan_darah'] = $pd['nama_golongan_darah'];
      $data['nama_pasangan'] = $pd['nama_pasangan'];
      $data['nama_ayah'] = $pd['nama_ayah'];
      $data['nama_ibu'] = $pd['nama_ibu'];
      $data['nama_agama'] = $pd['nama_agama'];
      $data['nama_pekerjaan'] = $pd['nama_pekerjaan'];
      $data['nama_pendidikan'] = $pd['nama_pendidikan'];
      // ==================================================== POKOK
      $this->tampil_top($data);
    }
    if($mode=='data_penunjang'){
      $data['page'] =  $data['page']."_data_penunjang";
      $data['kembali'] = base_url('pendaftaran/daftar');
      $pd = $this->m_ol_rancak->ambil_data_pasien($data['first_date']);
      $data['barcode_pendaftaran_unit'] = $pd['barcode_pendaftaran_unit'];
      $data['barcode_pendaftaran'] = $pd['barcode_pendaftaran'];
      $data['wkt_daftar'] = $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($pd['wkt_daftar'])));
      $data['vital'] = $this->m_ol_rancak->ambil_data_vital($pd['barcode_pendaftaran']);
      $data['rm'] = $pd['rm'];
      $data['nama_pasien'] = $pd['nama_pasien'];
      $data['umur'] = $pd['umur'];
      $data['nama_status_kawin'] = $pd['nama_status_kawin'];
      $data['nama_pasien'] = $pd['nama_pasien'];
      $data['nik'] = $pd['nik'];
      $data['wkt_daftar'] = $this->m_rancak->fullBulan(date('d-m-Y', strtotime($pd['wkt_daftar'])));
      $data['ttl'] = $pd['tmp_lahir'].", ".date('d-m-Y', strtotime($pd['tgl_lahir']));
      $data['alamat'] = $pd['alamat'].", ".$pd['nama_kec'].", ".$pd['nama_kel'].", ".
      $pd['nama_kab'].", ".$pd['nama_prov'];
      $data['nama_golongan_darah'] = $pd['nama_golongan_darah'];
      $data['nama_pasangan'] = $pd['nama_pasangan'];
      $data['nama_ayah'] = $pd['nama_ayah'];
      $data['nama_ibu'] = $pd['nama_ibu'];
      $data['nama_agama'] = $pd['nama_agama'];
      $data['nama_pekerjaan'] = $pd['nama_pekerjaan'];
      $data['nama_pendidikan'] = $pd['nama_pendidikan'];
      // ==================================================== POKOK
      $this->tampil_top($data);
    }
			}
	}
	function billing($mode='view'){
		$data['page']="billing"; 
		$data['header'] = "DATA BILLING";
		$data['title'] = "DATA BILLING";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','5');
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
		//======================= IMPORTANT =========================================
		$data['id']   = $this->uri->segment(4, 0);
		$data['id2']   = $this->uri->segment(5, 0);
		if($mode=='view'){
			$this->tampil($data);
		}
		else if($mode=='data'){
			echo json_encode($this->m_pendaftaran->pendaftaran_billing());
		}
		else if($mode=='lihat'){
			echo json_encode($this->m_pendaftaran->detil_billing($data['id']));
		}
		else{
			if($mode=='lihats'){
			  $data['page'] =  $data['page']."_lihats";
			  $data['hitung_billing'] = $this->m_pendaftaran->hitung_billing($data['id']);
				$this->tampil($data);
			}
			if($mode=='edit'){
			  $data['page'] =  $data['page']."_edit";
					$take = $this->m_umum->ambil_data('billing','barcode_billing',$data['id']);		
			  	$statuse=$this->m_ol_rancak->ambil_data_pu_from_billing($data['id']);
					$data['id_status_pasien']  = set_value('id_status_pasien',$statuse['id_status_pasien']);
					$data['id_status_billing']  = set_value('id_status_billing',$take['id_status_billing']);
					$data['barcode_billing']  = set_value('barcode_billing',$take['barcode_billing']);
					$data['id_cara_bayar']  = set_value('id_cara_bayar',$take['id_cara_bayar_billing']);
					$data['id_detil_cara_bayar']  = set_value('id_detil_cara_bayar',$take['id_detil_cara_bayar_billing']);
			  	$data['kol_cara_bayar']=$this->m_rancak->pd_cara_bayar();
			  	$data['kol_detil_cara_bayar']=$this->m_rancak->ambil_data_kol_detil_cara_bayar_pd($take['id_cara_bayar_billing']);
			  	$data['pegawai']=$this->m_rancak->ambil_pegawai_daftar();
					if($data['id_cara_bayar'] == 6){
						$data['id_pegawai'] = $take['id_detil_cara_bayar_billing'];
						$data['id_detil_cara_bayar'] = 0;
					}else{
						$data['id_detil_cara_bayar'] = $take['id_detil_cara_bayar_billing'];
						$data['id_pegawai'] = 0;
					}
					$data['jml_billing']  = set_value('jml_billing',$take['jml_billing']);
				$this->load->view("pendaftaran/isi",$data);
			}
			if($mode=='simpan_edit'){
				$id_status_pasien = $this->input->post('id_status_pasien');
				$id_status_billing = $this->input->post('id_status_billing');
				$barcode_pendaftaran = $this->input->post('barcode_pendaftaran');
				if($id_status_pasien == 0){
						$this->session->set_flashdata('danger', 'Pemeriksaan Batal');
						redirect(base_url('pendaftaran/billing/lihats/'.$barcode_pendaftaran));					
				}else if($id_status_pasien == 3){
						$this->session->set_flashdata('danger', 'Pemeriksaan Sudah Selesai');
						redirect(base_url('pendaftaran/billing/lihats/'.$barcode_pendaftaran));		
				}else{
					if($id_status_billing == 0){
						$this->session->set_flashdata('danger', 'Pemeriksaan Dibatalkan Admin');
						redirect(base_url('pendaftaran/billing/lihats/'.$barcode_pendaftaran));		
					}else if($id_status_billing == 1){
					  if($this->m_pendaftaran->edit_cara_bayar_billing()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
							redirect(base_url('pendaftaran/billing/lihats/'.$barcode_pendaftaran));	
						}else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Rubah Data');
							redirect(base_url('pendaftaran/billing/lihats/'.$barcode_pendaftaran));	
						}
					}else{
						$this->session->set_flashdata('danger', 'Transaksi Sudah Selesai');
						redirect(base_url('pendaftaran/billing/lihats/'.$barcode_pendaftaran));								
					}
				}
			}
    if($mode=='pdf_hasil'){
      $report = $this->load->view('cetak/kl_print_billing', $data, TRUE);
      $apk  =$this->m_ol_rancak->ambil_print_pu_from_billing($data['id']);
      $filename = date('Ymd').date('His')."-billing-".$apk['no_pendaftaran']."-".$apk['rm']."-".$apk['nama_pasien'].".pdf";
      $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
      $mpdf->AddPage('P', '', '', '', 2, 15, 15, 5, 10, 3, 3);
      $mpdf->SetDisplayMode('fullpage');
      $mpdf->SetTitle($data['header']);
      $mpdf->SetAuthor($data['title']);
      $mpdf->defaultheaderline = 0;
        $mpdf->defaultfooterline = 0;
      $mpdf->shrink_tables_to_fit = 1;
  //    $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
      for ($i = 1; $i > 2; $i++) {
      $mpdf->SetHTMLFooter('');
      }
      ini_set("pcre.backtrack_limit", "5000000");
      $mpdf->WriteHTML($report);
      $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
  //    $mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'P','margin_left' => '5','margin_right' => '5','margin_top' => '5','margin_bottom' => '5']);
  //    $mpdf = new \Mpdf\Mpdf(['format' => 'Legal']);
    // Define a default page size/format by array - page will be 190mm wide x 236mm height
    //  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [190, 236]]);
    // Define a default Landscape page size/format by name
/*    $mpdf->WriteHTML('Your Foreword and Introduction');
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
// ============================================================================== BRIDGING PCARE
function get_nokartu($id = FALSE){
	$nokartu = $this->input->post('nokartu');
	if($id === FALSE)
	{
		$kondisi=array('status_pcare'=>1,'id_instansi'=>0);
	}else{
		$kondisi=array('status_pcare'=>1,'id_instansi'=>$id);
	}
	$apcare = $this->m_umum->ambil_data_kondisi('a_pcare',$kondisi); 
	$endpoint = $apcare['base_url']."/vclaim-rest-dev/Peserta/nokartu/".$nokartu."/tglSEP/".date('Y-m-d');
	$result = $this->m_pcare->getData($endpoint);
	echo $result;
 }
function get_nik($id = FALSE){
	$nik = $this->input->post('nik');
	if($id === FALSE)
	{
		$kondisi=array('status_pcare'=>1,'id_instansi'=>0);
	}else{
		$kondisi=array('status_pcare'=>1,'id_instansi'=>$id);
	}
	$apcare = $this->m_umum->ambil_data_kondisi('a_pcare',$kondisi); 
	$endpoint = $apcare['base_url']."/vclaim-rest-dev/Peserta/nik/".$nik."/tglSEP/".date('Y-m-d');
	$result = $this->m_pcare->getData($endpoint);
	echo $result;
 }
function diagnosa(){
	$data['page']="diagnosa";
	$data['header'] = "CEK DIAGNOSA";
	$data['title'] = "CEK DIAGNOSA";
	$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
	$program = $this->m_umum->ambil_data('a_program','id_program',10);
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
	$stpeg = $this->m_umum->ambil_data('a_online','kode_online','ol_status_pegawai');
	$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
	$propinsie = $this->m_umum->ambil_data('ol_pengcab','id_pengcab',$pegawai['id_pengcab']);
	$data['prov_id'] = $propinsie["id_prov"];
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
	$data['room_id'] = $this->session->unit;
	$data['diagnosa']  = set_value('diagnosa',$this->input->post('diagnosa'));
	$data['respon']  = set_value('respon',$this->input->post('respon'));
	$this->tampil($data);
}
function get_diagnosa($id = FALSE){
	$diagnosa = $this->input->post('diagnosa');
	if($id === FALSE)
	{
		$kondisi=array('status_pcare'=>1,'id_instansi'=>0);
	}else{
		$kondisi=array('status_pcare'=>1,'id_instansi'=>$id);
	}
	$apcare = $this->m_umum->ambil_data_kondisi('a_pcare',$kondisi); 
	$endpoint = $apcare['base_url']."/vclaim-rest-dev/referensi/diagnosa/".$diagnosa;
	$result = $this->m_pcare->getData($endpoint);
	echo $result;
 }
function poli(){
	$data['page']="poli";
	$data['header'] = "CEK POLI";
	$data['title'] = "CEK POLI";
	$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
	$program = $this->m_umum->ambil_data('a_program','id_program',10);
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
	$stpeg = $this->m_umum->ambil_data('a_online','kode_online','ol_status_pegawai');
	$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
	$propinsie = $this->m_umum->ambil_data('ol_pengcab','id_pengcab',$pegawai['id_pengcab']);
	$data['prov_id'] = $propinsie["id_prov"];
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
	$data['room_id'] = $this->session->unit;
	$data['poli']  = set_value('poli',$this->input->post('poli'));
	$data['respon']  = set_value('respon',$this->input->post('respon'));
	$this->tampil($data);
}
function get_poli($id = FALSE){
	$poli = $this->input->post('poli');
	if($id === FALSE)
	{
		$kondisi=array('status_pcare'=>1,'id_instansi'=>0);
	}else{
		$kondisi=array('status_pcare'=>1,'id_instansi'=>$id);
	}
	$apcare = $this->m_umum->ambil_data_kondisi('a_pcare',$kondisi); 
	$endpoint = $apcare['base_url']."/vclaim-rest-dev/referensi/poli/".$poli;
	$result = $this->m_pcare->getData($endpoint);
	echo $result;
 }
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("pendaftaran/header",$data);
	$this->load->view("pendaftaran/isi");
	$this->load->view("footer");
	$this->load->view("pendaftaran/jsload");
	$this->load->view("pendaftaran/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_topol",$data);
	$this->load->view("pendaftaran/isi");
	$this->load->view("footer");
	$this->load->view("pendaftaran/jsload");
	$this->load->view("pendaftaran/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
