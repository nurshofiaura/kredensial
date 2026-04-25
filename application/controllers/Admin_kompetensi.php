<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Admin_kompetensi extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
		  		$this->load->model('m_ol_rancak');
		  		$this->load->model('m_admin_kredensial');
           $this->load->model('m_auth');
          $this->m_auth->login_kah();
  }
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
					if($this->session->refer > 0){
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
    $this->kompetensi();
  }
  function kompetensi($mode='view')
  {
		$data['page']  = "kompetensi";
		$data['header'] = "MASTER KOMPETENSI";
		$data['title'] = "MASTER KOMPETENSI";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$stpeg = $this->m_umum->ambil_data('a_online','kode_online','ol_status_pegawai');
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
		$data['id']   = $this->uri->segment(4, 0);
	//======================= IMPORTANT ======================================
    if($mode=='view'){
			$this->tampil($data);
		}
    else if($mode=='data'){
			echo json_encode($this->m_admin_kredensial->kompetensi_all());
		}
		else{
			$data['working']=$this->m_admin_kredensial->ambil_data_rujukan_working();
			$data['grade'] = $this->m_admin_kredensial->cmd_grade($this->session->mas_kred);
			$data['status']=$this->m_rancak->cmd_status();
			$data['cmd_jabatan']=$this->m_admin_kredensial->cmd_jabatan();
	    if($mode=='tambah'){
	      $data['page'] =  $data['page']."_tambah";
					$data['nama_kompetensi']  = set_value('nama_kompetensi',$this->input->post('nama_kompetensi'));
					$data['kode_unit']  = set_value('kode_unit',$this->input->post('kode_unit'));
					$data['id_jabatan']  = set_value('id_jabatan',$this->input->post('id_jabatan'));
					$data['id_grade']  = set_value('id_grade',$this->input->post('id_grade'));
					$data['instansi_kompetensi']  = set_value('instansi_kompetensi',$this->input->post('instansi_kompetensi'));
					$data['deskripsi_kompetensi']  = set_value('deskripsi_kompetensi',$this->input->post('deskripsi_kompetensi'));
					$this->load->view("admin_kompetensi/isi",$data);
	    }
	    if($mode=='simpan_tambah'){
				  if($this->m_admin_kredensial->simpan_nkr_kompetensi()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('admin_kompetensi/kompetensi'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
						redirect(base_url('admin_kompetensi/kompetensi'));
				  }
	    }
	    if($mode=='edit'){
	      $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('nkr_kompetensi','id_kompetensi',$data['id']);
				$data['id_kompetensi']  = set_value('id_kompetensi',$keuangan["id_kompetensi"]);
				$data['nama_kompetensi']  = set_value('nama_kompetensi',$keuangan["nama_kompetensi"]);
				$data['kode_unit']  = set_value('kode_unit',$keuangan["kode_unit"]);
				$data['id_jabatan']  = set_value('id_jabatan',$keuangan["id_jabatan"]);
				$data['id_grade']  = set_value('id_grade',$keuangan["id_grade"]);
				$data['deskripsi_kompetensi']  = set_value('deskripsi_kompetensi',$keuangan["deskripsi_kompetensi"]);
				$data['status_kompetensi']  = set_value('status_kompetensi',$keuangan["status_kompetensi"]);
				$data['instansi_kompetensi']  = set_value('instansi_kompetensi',$keuangan["instansi_kompetensi"]);
				$data['creator_kompetensi']  = set_value('creator_kompetensi',$keuangan["creator_kompetensi"]);
				$this->load->view("admin_kompetensi/isi",$data);
	    }
	    if($mode=='simpan_edit'){
	    	$id_kompetensi = $this->input->post('id_kompetensi');
		 		$kondisi=array('id_kompetensi'=>$id_kompetensi);
				$jml = $this->m_umum->jumlah_record_filter('nkr_pengajuan_validasi',$kondisi);
				$jml2 = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
				if($jml == 0){
			    	$creator_kompetensi = $this->input->post('creator_kompetensi');
			    	if($this->session->id_pegawai == $creator_kompetensi){
						  if($this->m_admin_kredensial->edit_nkr_kompetensi()){
								$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
								redirect(base_url('admin_kompetensi/kompetensi'));
						  }else{
								$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
								redirect(base_url('admin_kompetensi/kompetensi'));
						  }
			    	}else{
								$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
								redirect(base_url('admin_kompetensi/kompetensi'));    		
						}
		    	}else{
							$this->session->set_flashdata('danger', 'Data Sudah Dipakai Validasi');
							redirect(base_url('admin_kompetensi/kompetensi'));    		
					}
	    } 
	    if($mode=='syarat'){
	      $data['page'] =  $data['page']."_syarat";
				$keuangan    = $this->m_umum->ambil_data('nkr_kompetensi','id_kompetensi',$data['id']);
				$kondisi=array('id_jabatan'=>$keuangan["id_jabatan"]);
				$data['kompetensi']    = $this->m_umum->ambil_data_kondisi_result('nkr_kompetensi',$kondisi);
				$data['id_kompetensi']  = set_value('id_kompetensi',$keuangan["id_kompetensi"]);
				$data['nama_kompetensi']  = set_value('nama_kompetensi',$keuangan["nama_kompetensi"]);
				$data['kode_unit']  = set_value('kode_unit',$keuangan["kode_unit"]);
				$data['syarat_kompetensi']  = set_value('syarat_kompetensi',$keuangan["syarat_kompetensi"]);
				$data['status_kompetensi']  = set_value('status_kompetensi',$keuangan["status_kompetensi"]);
				$data['creator_kompetensi']  = set_value('creator_kompetensi',$keuangan["creator_kompetensi"]);
				$this->load->view("admin_kompetensi/isi",$data);
	    }
	    if($mode=='simpan_syarat'){
						  if($this->m_admin_kredensial->edit_syarat_kompetensi()){
								$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
								redirect(base_url('admin_kompetensi/kompetensi'));
						  }else{
								$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
								redirect(base_url('admin_kompetensi/kompetensi'));
						  }
	    } 

		}
  }
  function kewenangan($mode='view')
  {
	$data['page']  = "kewenangan";
	$data['header'] = "KEWENANGAN";
	$data['title'] = "KEWENANGAN";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$stpeg = $this->m_umum->ambil_data('a_online','kode_online','ol_status_pegawai');
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
	//======================= IMPORTANT ======================================
	//$data['id']   = $this->uri->segment(4, 0);
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
				redirect(base_url('admin_kompetensi/kewenangan/view/'.$key));
			}
		}
    else if($mode=='data'){
			$key = preg_replace('/\s+/', ' ', $data['key']);
			$key = str_replace(' ', '-', $key);
			echo json_encode($this->m_admin_kredensial->kewenangan_all($key));
		}
		else{
			$data['cmd_kompetensi']=$this->m_admin_kredensial->cmd_kompetensi_in($this->session->mas_kred);
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['id_kompetensi']  = set_value('id_kompetensi',$this->input->post('id_kompetensi'));
				$data['nama_kewenangan']  = set_value('nama_kewenangan',$this->input->post('nama_kewenangan'));
				$this->load->view("admin_kompetensi/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($this->m_admin_kredensial->simpan_nkr_kewenangan()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('admin_kompetensi/kewenangan'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('admin_kompetensi/kewenangan'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('nkr_kewenangan','id_kewenangan',$data['key']);
				$data['id_kompetensi']  = set_value('id_kompetensi',$keuangan["id_kompetensi"]);
				$data['nama_kewenangan']  = set_value('nama_kewenangan',$keuangan["nama_kewenangan"]);
				$data['id_kewenangan']  = set_value('id_kewenangan',$keuangan["id_kewenangan"]);
				$data['creator_kewenangan']  = set_value('creator_kewenangan',$keuangan["creator_kewenangan"]);
				$this->load->view("admin_kompetensi/isi",$data);
      }
      if($mode=='simpan_edit'){
		 		$kondisi=array('id_kewenangan'=>$id_kewenangan);
				$jml = $this->m_umum->jumlah_record_filter('ol_logbook',$kondisi);
				if($jml == 0){
	    	$creator_kewenangan = $this->input->post('creator_kewenangan');
		    	if($this->session->id_pegawai == $creator_kewenangan){
					  if($this->m_admin_kredensial->edit_nkr_kewenangan()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('admin_kompetensi/kewenangan'));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('admin_kompetensi/kewenangan'));
					  }
		    	}else{
							$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
							redirect(base_url('admin_kompetensi/kewenangan'));    		
					}
	    	}else{
						$this->session->set_flashdata('danger', 'Data Sudah Dipakai Logbook');
						redirect(base_url('admin_kompetensi/kewenangan'));    		
				}
      }
		}
  }
//===================================================================
//========================= TOOLS ===================================
//===================================================================
		function tampil($data)
		{
			$this->load->view("admin_kompetensi/header",$data);
			$this->load->view("admin_kompetensi/isi");
			$this->load->view("footer");
			$this->load->view("admin_kompetensi/jsload");
			$this->load->view("admin_kompetensi/jscode");
		}
		function tampil_top($data)
		{
			$this->load->view("header_topol",$data);
			$this->load->view("admin_kompetensi/isi");
			$this->load->view("footer");
			$this->load->view("admin_kompetensi/jsload");
			$this->load->view("admin_kompetensi/jscode");
		}
	}