<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Sa extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
		  $this->login_kah();
          $this->load->model('m_sa');
          $this->load->model('m_ol_rancak');
  }
  function login_kah()
  {
      if ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==99 )
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
	//======================= IMPORTANT =========================================
    $this->tampil($data);
  }
 // ================================================ INSTANSI ==================================
function clone_proses_buku_putih($mode='view')   
   {
     $data['page']  = "clone_proses_buku_putih";
     $data['header'] = "CLONNING DATA LOGBOOK";
     $data['title'] = "CLONNING DATA LOGBOOK";
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
     $data['id']   = $this->uri->segment(4, 0);
     if($mode=='view'){
      $this->tampil($data);
     }
     else if($mode=='data'){
    echo json_encode($this->m_sa->clone_proses_buku_putih());
    }
    else{
       if($mode=='tambah'){
        $this->m_sa->get_proses_buku_putih();
        $this->session->set_flashdata('sukses', 'Data berhasil Di Proses');
        redirect(base_url('sa/clone_proses_buku_putih'));
       }
    }
   }
/*  
function clone_proses_logbook($mode='view')   
   {
     $data['page']  = "clone_proses_logbook";
     $data['header'] = "CLONNING DATA LOGBOOK";
     $data['title'] = "CLONNING DATA LOGBOOK";
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
     $data['id']   = $this->uri->segment(4, 0);
     if($mode=='view'){
      $this->tampil($data);
     }
     else if($mode=='data'){
    echo json_encode($this->m_sa->clone_proses_logbook_all());
    }
    else{
       if($mode=='tambah'){
        $this->m_sa->clone_proses_logbook();
        $this->session->set_flashdata('sukses', 'Data berhasil Di Proses');
        redirect(base_url('sa/clone_proses_logbook'));
       }
    }
   }
   */
/*    function clone_proses_pasien($mode='view')   
   {
     $data['page']  = "clone_proses_pasien";
     $data['header'] = "CLONNING DATA PASIEN";
     $data['title'] = "CLONNING DATA PASIEN";
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
     $data['id']   = $this->uri->segment(4, 0);
     if($mode=='view'){
      $this->tampil($data);
     }
     else if($mode=='data'){
    echo json_encode($this->m_sa->clone_proses_pasien_all());
    }
    else{
       if($mode=='tambah'){
        $this->m_sa->clone_proses_pasien();
        $this->session->set_flashdata('sukses', 'Data berhasil Di Proses');
        redirect(base_url('sa/clone_proses_pasien'));
       }
    }
   }*/
/*   function clone_proses_lhu($mode='view')   
   {
     $data['page']  = "clone_proses_lhu";
     $data['header'] = "CLONNING DATA LHU";
     $data['title'] = "CLONNING DATA LHU";
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
     $data['id']   = $this->uri->segment(4, 0);
     if($mode=='view'){
      $this->tampil($data);
     }
     else if($mode=='data'){
    echo json_encode($this->m_sa->clone_proses_lhu_all());
    }
    else{
       if($mode=='tambah'){
        $this->m_sa->get_proses_logbook_lhu();
        $this->session->set_flashdata('sukses', 'Data berhasil Di Proses');
        redirect(base_url('sa/clone_proses_lhu'));
       }
    }
   }*/
/*      function clone_proses_umum($mode='view')   
   {
     $data['page']  = "clone_proses_umum";
     $data['header'] = "CLONNING DATA UMUM";
     $data['title'] = "CLONNING DATA UMUM";
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
     $data['id']   = $this->uri->segment(4, 0);
     if($mode=='view'){
      $this->tampil($data);
     }
     else if($mode=='data'){
    echo json_encode($this->m_sa->clone_proses_umum_all());
    }
    else{
       if($mode=='tambah'){
        $this->m_sa->get_proses_logbook_lhu_umum();
        $this->session->set_flashdata('sukses', 'Data berhasil Di Proses');
        redirect(base_url('sa/clone_proses_umum'));
       }
    }
   }*/
   // ================================================ TRANSAKSI ==================================
  function dk($mode='view')
  {
	$data['page']  = "dk";
	$data['header'] = "KOMITE";
	$data['title'] = "DATA KOMITE";
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
	$data['id']   = $this->uri->segment(4, 0);
	//======================= IMPORTANT ======================================
    if($mode=='view'){
	$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_sa->dk_all());
	}
	else{
		$data['working']=$this->m_sa->cmd_working();
		$data['status'] = $this->m_rancak->cmd_status();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['nama_dk']  = set_value('nama_dk',$this->input->post("nama_dk"));
				$data['kode_rekening']  = set_value('kode_rekening',$this->input->post("kode_rekening"));
				$data['id_instansi']  = set_value('id_instansi',$this->input->post("id_instansi"));
				$data['status_dk']  = set_value('status_dk',$this->input->post("status_dk"));
				$this->load->view("sa/isi",$data);
      }
      if($mode=='simpan_tambah'){
		$kode_rekening=$this->input->post('kode_rekening');
		$kondisi=array('kode_rekening'=>$kode_rekening);
		$jml = $this->m_umum->jumlah_record_filter('keu_dk',$kondisi);
		if($jml == 0){
			$this->m_sa->simpan_keu_dk();
			$this->session->set_flashdata('sukses', 'Data berhasil Di Tambah');
		}else{
			$this->session->set_flashdata('danger', 'Kode Sudah Ada');
		}
			redirect(base_url('sa/dk'));
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
		$keuangan    = $this->m_umum->ambil_data('akeu_dk','id_dk',$data['id']);
		$data['id_dk']  = set_value('id_dk',$keuangan["id_dk"]);
		$data['nama_dk']  = set_value('nama_dk',$keuangan["nama_dk"]);
		$data['kode_rekening']  = set_value('kode_rekening',$keuangan["kode_rekening"]);
		$data['id_instansi']  = set_value('id_instansi',$keuangan["id_instansi"]);
		$data['status_dk']  = set_value('status_dk',$keuangan["status_dk"]);
		$this->load->view("sa/isi",$data);
      }
      if($mode=='simpan_edit'){
		$kode_rekening_lama = $this->input->post('kode_rekening_lama');
		$kode_rekening=$this->input->post('kode_rekening');
		$kondisi=array('kode_rekening'=>$kode_rekening,'kode_rekening !='=>$kode_rekening_lama);
		$jml = $this->m_umum->jumlah_record_filter('akeu_dk',$kondisi);
		if($jml == 0){
			$this->m_sa->edit_keu_dk();
			$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
		}else{
			$this->session->set_flashdata('danger', 'Nama Kode Ada');
		}
			redirect(base_url('sa/dk'));
      }
	}
  }
    function data_coa()
  {
		$dt=$this->m_rancak->ambil_coa();
		$data = array();
		foreach($dt as $row){
			$data[] = array("id"=>$row['id_coa'], "text"=>$row['kode_coa'].' - '.$row['nama_coa']);
		}
		echo json_encode($data);
  }
    function data_mata_uang()  //Untuk Cascading Pulldown Wilayah
  {
		$dt=$this->m_rancak->ambil_kurs();
		$data = array();
		foreach($dt as $row){
			$data[] = array("id"=>$row['id_mata_uang'], "text"=>$row['kode_mata_uang']);
		}
		echo json_encode($data);
  }
  function transaksi($mode='view')
  {
		$data['page']  = "transaksi";
		$data['header'] = "TRANSAKSI";
		$data['title'] = "TRANSAKSI";
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
		$data['first_date']   = $this->uri->segment(4, 0);
		$data['last_date']   = $this->uri->segment(5, 0);
		$data['kode']   = $this->uri->segment(6, 0);
    if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$first_date = $this->input->post("first_date");
				$last_date = $this->input->post("last_date");
				redirect(base_url('sa/transaksi/view/'.$first_date.'/'.$last_date));
			}
		}
    else if($mode=='data'){
			echo json_encode($this->m_sa->transaksi_all($data['first_date'],$data['last_date']));
		}
		else{
			$data['cmd_jenis_jurnal']=$this->m_rancak->cmd_jenis_jurnal();
			$data['cmd_pegawai']=$this->m_sa->cmd_pegawai();
			$data['cmd_dk']=$this->m_sa->cmd_dk();
			$data['cmd_keu_coa']=$this->m_sa->cmd_keu_coa();
			$data['cmd_mata_uang']=$this->m_rancak->cmd_mata_uang();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['id_jenis_jurnal']  = set_value('id_jenis_jurnal',$this->input->post('id_jenis_jurnal'));
				$data['no_transaksi']  = set_value('no_transaksi',$this->input->post('no_transaksi'));
				$data['tgl_transaksi']  = set_value('tgl_transaksi',date('d-m-Y'));
				$data['id_dk']  = set_value('id_dk',$this->input->post('id_dk'));
				$data['id_pegawai']  = set_value('id_pegawai',$this->input->post('id_pegawai'));
				$data['ket_transaksi']  = set_value('ket_transaksi',$this->input->post('ket_transaksi'));
				$data['id_coa']  = set_value('id_coa',$this->input->post('id_coa'));
				$data['td_debet']  = set_value('td_debet','0');
				$data['td_kredit']  = set_value('td_kredit','0');
				$data['ket_transaksi_detil']  = set_value('ket_transaksi_detil',$this->input->post('ket_transaksi_detil'));
				$data['totaldebet']  = set_value('totaldebet',$this->input->post('totaldebet'));
				$data['totalkredit']  = set_value('totalkredit',$this->input->post('totalkredit'));
				$this->form_validation->set_rules('id_jenis_jurnal','id_jenis_jurnal','required');
        if ($this->form_validation->run() === FALSE){
					$this->tampil($data);
        }else{ 			
					$totaldebet = $this->input->post('totaldebet');
					$totalkredit = $this->input->post('totalkredit');
					if($totaldebet == $totalkredit){
		        $data = array();
		  			$filesCount = count($_FILES['upload_Files']['name']);
		  			for($i = 0; $i < $filesCount; $i++){
		  				$_FILES['upload_File']['name'] = $_FILES['upload_Files']['name'][$i];
		  				$_FILES['upload_File']['type'] = $_FILES['upload_Files']['type'][$i];
		  				$_FILES['upload_File']['tmp_name'] = $_FILES['upload_Files']['tmp_name'][$i];
		  				$_FILES['upload_File']['error'] = $_FILES['upload_Files']['error'][$i];
		  				$_FILES['upload_File']['size'] = $_FILES['upload_Files']['size'][$i];
		  				$uploadPath = 'assets/berkas/struk/';
		  				$config['upload_path'] = $uploadPath;
		  				$config['allowed_types'] = 'pdf';
		  				$config['encrypt_name'] = TRUE;
		  				$this->load->library('upload', $config);
		  				$this->upload->initialize($config);
		  				if($this->upload->do_upload('upload_File')){
		  					$fileData = $this->upload->data();
							  if($last_ide = $this->m_sa->simpan_transaksi_keuangan($fileData['file_name'])){
									$this->m_sa->simpan_transaksi_detil($last_ide);
									$this->session->set_flashdata('sukses', 'Data berhasil Di Tambah');
									redirect(base_url('sa/transaksi'));
							  }else{
									$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data');
									redirect(base_url('sa/transaksi'));
							  }
		  				}else{
		  					$nole = '';
							  if($last_ide = $this->m_sa->simpan_transaksi_keuangan($nole)){
									$this->m_sa->simpan_transaksi_detil($last_ide);
									$this->session->set_flashdata('sukses', 'Data berhasil Di Tambah');
									redirect(base_url('sa/transaksi'));
							  }else{
									$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data');
									redirect(base_url('sa/transaksi'));
							  }
		  				}
		  				$this->m_member->edit_user();
		  				$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
		  				redirect(base_url('sa/transaksi'));
		  			}
					}else{
							$this->session->set_flashdata('danger', 'Total Kredit dan Debet Tidak Sama');
							redirect(base_url('sa/transaksi'));
					}
        }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$ob = $this->m_umum->ambil_data('akeu_transaksi','kode_transaksi',$data['first_date']);
				$data['id_transaksi'] = $ob["id_transaksi"];
				$data['kode_transaksi'] = $ob["kode_transaksi"];
				$data['id_jenis_jurnal'] = $ob["id_jenis_jurnal"];
				$data['no_transaksi'] = $ob["no_transaksi"];
				$data['tgl_transaksi'] = date('d-m-Y', strtotime($ob["tgl_transaksi"]));
				$data['id_dk'] = $ob["id_dk"];
				$data['id_pegawai'] = $ob["id_pegawai"];
				$data['ket_transaksi'] = $ob["ket_transaksi"];
				$data['total_transaksi'] = $ob["total_transaksi"];
				$data['akeu_tr_detil'] = $this->m_umum->ambil_data_result('akeu_transaksi_detil','kode_transaksi',$ob['kode_transaksi']);
				$data['id_coa']  = set_value('id_coa',$this->input->post('id_coa'));
				$data['td_debet']  = set_value('td_debet','0');
				$data['td_kredit']  = set_value('td_kredit','0');
				$data['ket_transaksi_detil']  = set_value('ket_transaksi_detil',$this->input->post('ket_transaksi_detil'));
				$data['totaldebet']  = set_value('totaldebet',$this->input->post('totaldebet'));
				$data['totalkredit']  = set_value('totalkredit',$this->input->post('totalkredit'));
				$this->form_validation->set_rules('id_jenis_jurnal','id_jenis_jurnal','required');
        if ($this->form_validation->run() === FALSE){
					$this->tampil($data);
        }else{
					$totaldebet = $this->input->post('totaldebet');
					$totalkredit = $this->input->post('totalkredit');
					if($totaldebet == $totalkredit){
		        $data = array();
		  			$filesCount = count($_FILES['upload_Files']['name']);
		  			for($i = 0; $i < $filesCount; $i++){
		  				$_FILES['upload_File']['name'] = $_FILES['upload_Files']['name'][$i];
		  				$_FILES['upload_File']['type'] = $_FILES['upload_Files']['type'][$i];
		  				$_FILES['upload_File']['tmp_name'] = $_FILES['upload_Files']['tmp_name'][$i];
		  				$_FILES['upload_File']['error'] = $_FILES['upload_Files']['error'][$i];
		  				$_FILES['upload_File']['size'] = $_FILES['upload_Files']['size'][$i];
		  				$uploadPath = 'assets/berkas/struk/';
		  				$config['upload_path'] = $uploadPath;
		  				$config['allowed_types'] = 'pdf';
		  				$config['encrypt_name'] = TRUE;
		  				$this->load->library('upload', $config);
		  				$this->upload->initialize($config);
		  				if($this->upload->do_upload('upload_File')){
		  					$id_transaksi = $this->input->post('id_transaksi');
		  					$user_pic=$this->m_umum->ambil_data('akeu_transaksi','id_transaksi',$id_transaksi);
		  					$cek_file=FCPATH.'assets/berkas/struk/'.$user_pic['struk_transaksi'];
		  					if(file_exists($cek_file)){
		  						unlink(FCPATH."assets/berkas/struk/".$user_pic['struk_transaksi']);
		  					}
		  					$fileData = $this->upload->data();
		  					$this->m_sa->keep_semua_transaksi($fileData['file_name']);
		  				}else{
	  						$nole = '';
						  	$this->m_sa->keep_semua_transaksi($nole);
		  				}
		  				$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
		  				redirect(base_url('sa/transaksi'));
		  			}
					}else{
							$this->session->set_flashdata('danger', 'Total Kredit dan Debet Tidak Sama');
							redirect(base_url('sa/transaksi'));
					}
        }
      }
      if($mode=='jurnal'){
        $data['page'] =  $data['page']."_jurnal";
				$data['ambil_akeu_transaksi'] = $this->m_sa->ambil_akeu_transaksi($data['first_date'],$data['last_date'],$data['kode']);
				$this->load->view("sa/isi",$data);
      }
      if($mode=='buku_besar'){
        $data['page'] =  $data['page']."_buku_besar";
				$data['ambil_coa_periode'] = $this->m_sa->ambil_coa_periode($data['first_date'],$data['last_date'],$data['kode']);
				$this->load->view("sa/isi",$data);
      }
      if($mode=='neraca'){
        $data['page'] =  $data['page']."_neraca";
				$data['ambil_aktiva']   = $this->m_sa->ambil_aktiva($data['first_date'],$data['last_date'],$data['kode']);
				$data['ambil_passiva']   = $this->m_sa->ambil_passiva($data['first_date'],$data['last_date'],$data['kode']);
				$this->load->view("sa/isi",$data);
      }
      if($mode=='rl'){
        $data['page'] =  $data['page']."_rl";

				$data['ambil_pendapatan']   = $this->m_sa->ambil_code('14',$data['first_date'],$data['last_date'],$data['kode']);
				$data['count_pendapatan_debet']   = $this->m_sa->count_row_code_debet('14',$data['first_date'],$data['last_date']);
				$data['count_pendapatan_kredit']   = $this->m_sa->count_row_code_kredit('14',$data['first_date'],$data['last_date']);
				$data['count_pendapatan']   = $data['count_pendapatan_debet'] - $data['count_pendapatan_kredit'];

				$data['ambil_hpp']   = $this->m_sa->ambil_code('16',$data['first_date'],$data['last_date'],$data['kode']);
				$data['count_hpp_debet']   = $this->m_sa->count_row_code_debet('16',$data['first_date'],$data['last_date']);
				$data['count_hpp_kredit']   = $this->m_sa->count_row_code_kredit('16',$data['first_date'],$data['last_date']);
				$data['count_hpp']   = $data['count_hpp_debet'] - $data['count_hpp_kredit'];

				$data['ambil_biaya']   = $this->m_sa->ambil_code('17',$data['first_date'],$data['last_date'],$data['kode']);
				$data['count_biaya_debet']   = $this->m_sa->count_row_code_debet('17',$data['first_date'],$data['last_date']);
				$data['count_biaya_kredit']   = $this->m_sa->count_row_code_kredit('17',$data['first_date'],$data['last_date']);
				$data['count_biaya']   = $data['count_biaya_debet'] - $data['count_biaya_kredit'];

				$data['ambil_pendapatan_lain']   = $this->m_sa->ambil_code('15',$data['first_date'],$data['last_date'],$data['kode']);
				$data['count_pendapatan_lain_debet']   = $this->m_sa->count_row_code_debet('15',$data['first_date'],$data['last_date']);
				$data['count_pendapatan_lain_kredit']   = $this->m_sa->count_row_code_kredit('15',$data['first_date'],$data['last_date']);
				$data['count_pendapatan_lain']   = $data['count_pendapatan_lain_debet'] - $data['count_pendapatan_lain_kredit'];

				$data['ambil_biaya_lainnya']   = $this->m_sa->ambil_code('18',$data['first_date'],$data['last_date'],$data['kode']);
				$data['count_baiaya_lainnya_debet']   = $this->m_sa->count_row_code_debet('18',$data['first_date'],$data['last_date']);
				$data['count_baiaya_lainnya_kredit']   = $this->m_sa->count_row_code_kredit('18',$data['first_date'],$data['last_date']);
				$data['count_baiaya_lainnya']   = $data['count_baiaya_lainnya_debet'] - $data['count_baiaya_lainnya_kredit'];
				$this->load->view("sa/isi",$data);
      }
		}
  }
 // ================================================ INSTANSI ==================================
	function cl_pmr($mode='view'){
		$data['page']="cl_pmr"; 
		$data['header'] = "CLONNING PEMERIKSAAN";
		$data['title'] = "CLONNING PEMERIKSAAN";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
	//	$program = $this->m_umum->ambil_data('a_program','id_program','30');
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
		$data['first_date'] = $this->uri->segment(4, 0);
		$data['last_date'] = $this->uri->segment(5, 0);
		if(empty($data['first_date'])){
			if($this->session->has_userdata('first_date_prem')){
				$data['first_date'] = $this->session->first_date_prem;
			}else{
				$data['first_date'] = '01-'.date('m-Y');
			}
		}
		if(empty($data['last_date'])){
			if($this->session->has_userdata('last_date_prem')){
				$data['last_date'] = $this->session->last_date_prem;
			}else{
				$data['last_date'] = date('d-m-Y');
			}
		}
    if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$first_date = $this->input->post("first_date");
			$last_date = $this->input->post("last_date");
			$id_instansi = $this->input->post("id_instansi");
			$pxe = $this->input->post("id_kompetensi");
			$data_user_level = array(
				'first_date_prem'     => $first_date,
				'last_date_prem'     => $last_date
			);	
			$this->session->set_userdata($data_user_level);						
//			$this->session->set_tempdata('otp', $your_value, 1000);
			redirect(base_url('sa/cl_pmr/view/'.$first_date.'/'.$last_date));
		}
	}
		else if($mode=='data'){
			echo json_encode($this->m_sa->clone_pemeriksaan($data['first_date'],$data['last_date']));
		}
		else{
			  $data['cmd_pmr'] = array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','11'=>'11','12'=>'12');
			  $data['cmd_pasien'] = array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5');
			if($mode=='tambah'){
			  $data['page'] =  $data['page']."_tambah";
				if($this->session->has_userdata('last_date_prem')){
					$first_date = $this->session->last_date_prem;
				}else{
					$first_date = date('d-m-Y');
				}
			if($this->session->has_userdata('last_date_prem')){
					$last_date = $this->session->last_date_prem;
				}else{
					$last_date = date('d-m-Y');
				}
    		$data['tgl_awal']  = set_value('tgl_awal',$first_date);
    		$data['tgl_akhir']  = set_value('tgl_akhir',$last_date);
    		$data['jml_pemeriksaan']  = set_value('jml_pemeriksaan',$this->input->post("jml_pemeriksaan"));    		
    		$data['kewenangan']  = set_value('kewenangan',$this->input->post("kewenangan"));    			
    		$data['jml_pasien']  = set_value('jml_pasien',$this->input->post("jml_pasien"));
    		$data['id_pegawai']  = set_value('id_pegawai',$this->input->post("id_pegawai"));
    		$data['id_instansi']  = set_value('id_instansi',$this->input->post("id_instansi"));  		
    		$data['id_sifat_kewenangan']  = set_value('id_sifat_kewenangan',$this->input->post("id_sifat_kewenangan"));  		     
				$this->load->view("sa/isi",$data);
			}
			if($mode=='simpan_tambah'){
				  if($this->m_sa->simpan_pcare()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('sa/pcare'));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
						redirect(base_url('sa/pcare'));
					}
			}
			if($mode=='edit'){
			  $data['page'] =  $data['page']."_edit";
					$take = $this->m_umum->ambil_data('a_pcare','id_pcare',$data['id']);		
					$data['id_pcare']  = set_value('id_pcare',$take['id_pcare']);
					$data['id_instansi']  = set_value('id_instansi',$take['id_instansi']);
					$data['cons_id']  = set_value('cons_id',$take['cons_id']);
					$data['secret_key']  = set_value('secret_key',$take['secret_key']);
					$data['base_url']  = set_value('base_url',$take['base_url']);
					$data['service_name']  = set_value('service_name',$take['service_name']);
					$data['pcare_user']  = set_value('pcare_user',$take['pcare_user']);
					$data['pcare_pass']  = set_value('pcare_pass',$take['pcare_pass']);
					$data['user_key']  = set_value('user_key',$take['user_key']);
					$data['kd_aplikasi']  = set_value('kd_aplikasi',$take['kd_aplikasi']);
					$data['status_pcare']  = set_value('status_pcare',$take['status_pcare']);
				$this->load->view("sa/isi",$data);
			}
			if($mode=='simpan_edit'){
				  if($this->m_sa->edit_pcare()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('sa/pcare'));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
						redirect(base_url('sa/pcare'));
					}
			}
		}
	}
  function instansi($mode='view')
  {
		$data['page']  = "instansi";
		$data['header'] = "WEB";
		$data['title'] = "WEB";
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
		$data['id']   = $this->uri->segment(4, 0);
	  if($mode=='view'){
			$this->tampil($data);
		}
	  else if($mode=='data'){
			echo json_encode($this->m_sa->instansi_all());
		}
		else{
			$data['cmd_status'] = array('0'=>'Free','1'=>'Berbayar');
	    if($mode=='edit'){
	      $data['page'] =  $data['page']."_edit";
				$inst = $this->m_umum->ambil_data('a_instansi','id_instansi',$data['id']);
				$data['nama_instansi']  = set_value('nama_instansi',$inst['nama_instansi']);
				$data['alamat_instansi']  = set_value('alamat_instansi',$inst['alamat_instansi']);
				$data['email_instansi']  = set_value('email_instansi',$inst['email_instansi']);
				$data['kontak_instansi']  = set_value('kontak_instansi',$inst['kontak_instansi']);
				$data['description']  = set_value('description',$inst['description']);
				$data['keywords']  = set_value('keywords',$inst['keywords']);
				$data['licensed']  = set_value('licensed',$inst['licensed']);
				$data['header']  = set_value('header',$inst['header']);
				$data['header_mini']  = set_value('header_mini',$inst['header_mini']);
				$data['licensed']  = set_value('licensed',$inst['licensed']);
				$data['footer']  = set_value('footer',$inst['footer']);
				$this->load->view("sa/isi",$data);
	    }
	    if($mode=='simpan_edit'){
			  if($this->m_sa->edit_instansi()){
					$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
					redirect(base_url('sa/instansi'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Masalah Edit Data');
					redirect(base_url('sa/instansi'));
			  }
	    }
	    if($mode=='edit_wa'){
	      $data['page'] =  $data['page']."_edit_wa";
				$inst = $this->m_umum->ambil_data('a_wageblast','id_instansi',$data['id']);
				$data['url_api']  = set_value('url_api',$inst['url_api']);
				$data['api']  = set_value('api',$inst['api']);
				$data['user_api']  = set_value('user_api',$inst['user_api']);
				$data['sender']  = set_value('sender',$inst['sender']);
				$this->load->view("sa/isi",$data);
	    }
	    if($mode=='simpan_edit_wa'){
			  if($this->m_sa->edit_wageblast()){
					$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
					redirect(base_url('sa/instansi'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Masalah Edit Data');
					redirect(base_url('sa/instansi'));
			  }
	    }
	    if($mode=='edit_email'){
	      $data['page'] =  $data['page']."_edit_email";
				$inst = $this->m_umum->ambil_data('a_email','id_instansi',$data['id']);
				$data['server']  = set_value('server',$inst['server']);
				$data['user']  = set_value('user',$inst['user']);
				$data['pass']  = set_value('pass',$inst['pass']);
				$data['port']  = set_value('port',$inst['port']);
				$this->load->view("sa/isi",$data);
	    }
	    if($mode=='simpan_edit_email'){
			  if($this->m_sa->edit_email()){
					$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
					redirect(base_url('sa/instansi'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Masalah Edit Data');
					redirect(base_url('sa/instansi'));
			  }
	    }
			if($mode=='hapus_logo'){
				$tansi = $this->m_umum->ambil_data('a_instansi','id_instansi',$data['id']);
				$logo = $tansi["logo"];
				$cek_file=FCPATH.'assets/foto/'.$logo;
				if(file_exists($cek_file)){
					unlink(FCPATH."assets/foto/".$logo);
				}
				if($this->m_sa->hapus_logo($data['id'])){
					$this->session->set_flashdata('sukses', 'Logo berhasil Di Hapus');
					redirect(base_url('sa/instansi'));
				}else{
					$this->session->set_flashdata('danger', 'Ada Masalah Hapus Data');
					redirect(base_url('sa/instansi'));
				}
			}
	    if($mode=='bayar'){
	      $data['page'] =  $data['page']."_bayar";
				$inst = $this->m_umum->ambil_data('a_instansi','id_instansi',$data['id']);
				$data['status_bayar']  = set_value('status_bayar',$inst['status_bayar']);
				$this->load->view("sa/isi",$data);
	    }
	    if($mode=='simpan_bayar'){
			  if($this->m_sa->edit_bayar()){
					$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
					redirect(base_url('sa/instansi'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Masalah Edit Data');
					redirect(base_url('sa/instansi'));
			  }
	    }
	    if($mode=='logo'){
	      $data['page'] =  $data['page']."_logo";
				$data['title'] = "LOGO";
				$inst = $this->m_umum->ambil_data('a_instansi','id_instansi',$data['id']);
				$data['logo']  = set_value('logo',$inst['logo']);
				$this->form_validation->set_rules('id_instansi','id_instansi','required');
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
						$uploadPath = 'assets/foto/';
						$config['upload_path'] = $uploadPath;
						$config['allowed_types'] = 'gif|jpg|jpeg|png';
						$config['encrypt_name'] = TRUE;
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if($this->upload->do_upload('upload_File')){
							$id_instansi= $this->input->post('id_instansi');
							$akses = $this->m_umum->ambil_data('a_instansi','id_instansi',$id_instansi);
							$logo= $akses['logo'];
							$cek_file=FCPATH.'assets/foto/'.$logo;
							if(file_exists($cek_file)){
								unlink(FCPATH."assets/foto/".$logo);
							}
							$fileData = $this->upload->data();
							$this->m_sa->edit_logo($fileData['file_name']);
						}
						$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
						redirect(base_url('sa/instansi'));
					}
	      }
	    }
		}
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
	function komunitas($mode='view'){
		$data['page']="komunitas"; 
		$data['header'] = "DATA KOMUNITAS";
		$data['title'] = "DATA KOMUNITAS";
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
		$data['id']   = $this->uri->segment(4, 0);
		//======================= IMPORTANT =========================================
		if($mode=='view'){
			$this->tampil($data);
		}
		else if($mode=='data'){
			echo json_encode($this->m_sa->pengurus_all());
		}
		else{
			  $data['ambil_data_pengcab'] = $this->m_sa->ambil_pengcab();
			  $data['kol_provinsi'] = $this->m_rancak->cmd_kol_provinsi();
			  $data['cmd_jabatan'] = $this->m_rancak->cmd_jabatan();
			  $data['status'] = $this->m_rancak->cmd_status();
		  if($mode=='tambah'){
				$data['page'] =  $data['page']."_tambah";
				$data['kab']=array("");
				$data['id_jabatan']  = set_value('id_jabatan',$this->input->post("id_jabatan"));
				$data['id_cabang']  = set_value('id_cabang',$this->input->post("id_cabang"));
				$data['nama_dpk']  = set_value('nama_dpk',$this->input->post("nama_dpk"));
				$data['alamat_dpk']  = set_value('alamat_dpk',$this->input->post("alamat_dpk"));    		
				$data['email_dpk']  = set_value('email_dpk',$this->input->post("email_dpk"));    			
				$data['kontak_dpk']  = set_value('kontak_dpk',$this->input->post("kontak_dpk"));
				$data['id_prov']  = set_value('id_prov',$this->input->post("id_prov"));
				$data['id_kab']  = set_value('id_kab',$this->input->post("id_kab"));
				$data['status_dpk']  = set_value('status_dpk',$this->input->post("status_dpk"));
				$this->form_validation->set_rules('nama_dpk','nama_dpk','required');
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
							$uploadPath = 'assets/berkas/kop/';
							$config['upload_path'] = $uploadPath;
							$config['allowed_types'] = 'gif|jpg|jpeg|png';
							$config['encrypt_name'] = TRUE;
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							if($this->upload->do_upload('upload_File')){
								$fileData = $this->upload->data();
								$this->m_sa->simpan_ol_pengcab($fileData['file_name']);
								$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
								redirect(base_url('sa/komunitas'));
							}else{
								$nole = '';
								$this->m_sa->simpan_ol_pengcab($nole);
								$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
								redirect(base_url('sa/komunitas'));
							}
						}
				}
			}
			if($mode=='edit'){
				$data['page'] =  $data['page']."_edit";
					$take = $this->m_umum->ambil_data('srt_dpk','id_dpk',$data['id']);		
					$data['id_dpk']  = set_value('id_dpk',$take['id_dpk']);
					$data['id_cabang']  = set_value('id_cabang',$take['id_cabang']);
					$data['nama_dpk']  = set_value('nama_dpk',$take['nama_dpk']);
					$data['alamat_dpk']  = set_value('alamat_dpk',$take['alamat_dpk']);
					$data['email_dpk']  = set_value('email_dpk',$take['email_dpk']);
					$data['kontak_dpk']  = set_value('kontak_dpk',$take['kontak_dpk']);
					$data['status_dpk']  = set_value('status_dpk',$take['status_dpk']);
					$data['id_prov']  = set_value('id_prov',$take['id_prov']);		
					$data['id_kab']  = set_value('id_kab',$take['id_kab']);			
					$data['kab'] = $this->m_ol_rancak->ambil_data_dropdown_kab($take['id_prov']);
					$this->form_validation->set_rules('nama_dpk','nama_dpk','required');
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
						$uploadPath = 'assets/berkas/kop/';
						$config['upload_path'] = $uploadPath;
						$config['allowed_types'] = 'gif|jpg|jpeg|png';
						$config['encrypt_name'] = TRUE;
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if($this->upload->do_upload('upload_File')){
							$fileData = $this->upload->data();
							$this->m_sa->edit_ol_pengcab($fileData['file_name']);
							$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
							redirect(base_url('sa/komunitas'));
						}else{
							$nole = '';
							$this->m_sa->edit_ol_pengcab($nole);
							$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
							redirect(base_url('sa/komunitas'));
						}
					}
				}
			}
			if($mode=='stempel'){
				$data['page'] =  $data['page']."_stempel";
					$take = $this->m_umum->ambil_data('srt_dpk','id_dpk',$data['id']);		
					$data['id_dpk']  = set_value('id_dpk',$take['id_dpk']);
					$data['id_cabang']  = set_value('id_cabang',$take['id_cabang']);
					$data['nama_dpk']  = set_value('nama_dpk',$take['nama_dpk']);
					$data['alamat_dpk']  = set_value('alamat_dpk',$take['alamat_dpk']);
					$data['email_dpk']  = set_value('email_dpk',$take['email_dpk']);
					$data['kontak_dpk']  = set_value('kontak_dpk',$take['kontak_dpk']);
					$data['status_dpk']  = set_value('status_dpk',$take['status_dpk']);
					$data['id_prov']  = set_value('id_prov',$take['id_prov']);		
					$data['id_kab']  = set_value('id_kab',$take['id_kab']);			
					$data['kab'] = $this->m_ol_rancak->ambil_data_dropdown_kab($take['id_prov']);
					$this->form_validation->set_rules('nama_dpk','nama_dpk','required');
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
						$uploadPath = 'assets/berkas/kop/';
						$config['upload_path'] = $uploadPath;
						$config['allowed_types'] = 'gif|jpg|jpeg|png';
						$config['encrypt_name'] = TRUE;
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if($this->upload->do_upload('upload_File')){
							$fileData = $this->upload->data();
							$this->m_sa->edit_stempel_pengcab($fileData['file_name']);
							$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
							redirect(base_url('sa/komunitas'));
						}else{
							$nole = '';
							$this->m_sa->edit_stempel_pengcab($nole);
							$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
							redirect(base_url('sa/komunitas'));
						}
					}
				}
			}
		}
	}
  function struktur_jabatan($mode='view')
  {
		$data['page']  = "struktur_jabatan";
		$data['header'] = "DATA STRUKTUR JABATAN KORESPONDENSI / SURAT MENYURAT";
		$data['title'] = "DATA STRUKTUR JABATAN KORESPONDENSI / SURAT MENYURAT";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
//		$program = $this->m_umum->ambil_data('a_program','id_program','30');
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
		$data['id']   = $this->uri->segment(4, 0);
	//======================= IMPORTANT ======================================
    if($mode=='view'){
	$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_sa->srt_struktur_jabatan_all());
	}
	else{
		$data['cmd_status']=$this->m_rancak->cmd_status();
		$data['ambil_data_working'] = $this->m_ol_rancak->ambil_data_rujukan_working();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['nama_struktur_jabatan']  = set_value('nama_struktur_jabatan',$this->input->post('nama_struktur_jabatan'));
				$data['id_instansi']  = set_value('id_instansi',$this->input->post('id_instansi'));
				$data['status_struktur_jabatan']  = set_value('status_struktur_jabatan',$this->input->post('status_struktur_jabatan'));
				$this->load->view("sa/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($this->m_sa->simpan_srt_struktur_jabatan()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('sa/struktur_jabatan'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('sa/struktur_jabatan'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('srt_struktur_jabatan','id_struktur_jabatan',$data['id']);
				$data['id_struktur_jabatan']  = set_value('id_struktur_jabatan',$keuangan["id_struktur_jabatan"]);
				$data['nama_struktur_jabatan']  = set_value('nama_struktur_jabatan',$keuangan["nama_struktur_jabatan"]);
				$data['id_instansi']  = set_value('id_instansi',$keuangan["id_instansi"]);
				$data['status_struktur_jabatan']  = set_value('status_struktur_jabatan',$keuangan["status_struktur_jabatan"]);
				$this->load->view("sa/isi",$data);
      }
      if($mode=='simpan_edit'){
				  if($this->m_sa->edit_srt_struktur_jabatan()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
						redirect(base_url('sa/struktur_jabatan'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
						redirect(base_url('sa/struktur_jabatan'));
				  }
      }
		}
  }
  function kategori_absen($mode='view')
  {
		$data['page']  = "kategori_absen";
		$data['header'] = "DATA KATEGORI ABSEN";
		$data['title'] = "DATA KATEGORI ABSEN";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
//		$program = $this->m_umum->ambil_data('a_program','id_program','30');
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
		$data['id']   = $this->uri->segment(4, 0);
	//======================= IMPORTANT ======================================
    if($mode=='view'){
	$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_sa->abs_kategori_absen_all());
	}
	else{
		$data['cmd_status']=$this->m_rancak->cmd_status();
		$data['ambil_data_working'] = $this->m_ol_rancak->ambil_data_rujukan_working();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['nama_kategori_absen']  = set_value('nama_kategori_absen',$this->input->post('nama_kategori_absen'));
				$data['id_instansi']  = set_value('id_instansi',$this->input->post('id_instansi'));
				$data['status_kategori_absen']  = set_value('status_kategori_absen',$this->input->post('status_kategori_absen'));
				$this->load->view("sa/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($this->m_sa->simpan_abs_kategori_absen()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('sa/kategori_absen'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('sa/kategori_absen'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('abs_kategori_absen','id_kategori_absen',$data['id']);
				$data['id_kategori_absen']  = set_value('id_kategori_absen',$keuangan["id_kategori_absen"]);
				$data['nama_kategori_absen']  = set_value('nama_kategori_absen',$keuangan["nama_kategori_absen"]);
				$data['id_instansi']  = set_value('id_instansi',$keuangan["id_instansi"]);
				$data['status_kategori_absen']  = set_value('status_kategori_absen',$keuangan["status_kategori_absen"]);
				$this->load->view("sa/isi",$data);
      }
      if($mode=='simpan_edit'){
				  if($this->m_sa->edit_abs_kategori_absen()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
						redirect(base_url('sa/kategori_absen'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
						redirect(base_url('sa/kategori_absen'));
				  }
      }
		}
  }
  function seting_absen($mode='view')
  {
		$data['page']  = "seting_absen";
		$data['header'] = "DATA SETING ABSEN";
		$data['title'] = "DATA SETING ABSEN";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
//		$program = $this->m_umum->ambil_data('a_program','id_program','30');
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
		$data['id']   = $this->uri->segment(4, 0);
	//======================= IMPORTANT ======================================
    if($mode=='view'){
	$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_sa->abs_seting_all());
	}
	else{
		$data['cmd_status']=$this->m_rancak->cmd_status();
		$data['ambil_unit'] = $this->m_rancak->ambil_unit_instansi();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['nama_seting']  = set_value('nama_seting',$this->input->post('nama_seting'));
				$data['id_unit']  = set_value('id_unit',$this->input->post('id_unit'));
				$data['location']  = set_value('location',$this->input->post('location'));
				$data['radius']  = set_value('radius',$this->input->post('radius'));
				$data['zoom']  = set_value('zoom',18);
				$data['clock_in']  = set_value('clock_in',date('H:i'));
				$data['clock_out']  = set_value('clock_out',date('H:i'));
				$data['status_seting']  = set_value('status_seting',$this->input->post('status_seting'));
				$this->load->view("sa/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($this->m_sa->simpan_abs_seting()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('sa/seting_absen'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('sa/seting_absen'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('abs_seting','id_seting',$data['id']);
				$data['id_seting']  = set_value('id_seting',$keuangan["id_seting"]);
				$data['nama_seting']  = set_value('nama_seting',$keuangan["nama_seting"]);
				$data['id_unit']  = set_value('id_unit',$keuangan["id_unit"]);
				$data['location']  = set_value('location',$keuangan["location"]);
				$data['radius']  = set_value('radius',$keuangan["radius"]);
				$data['zoom']  = set_value('zoom',$keuangan["zoom"]);
				$data['clock_in']  = set_value('clock_in',date('H:i',strtotime($keuangan["clock_in"])));
				$data['clock_out']  = set_value('clock_out',date('H:i',strtotime($keuangan["clock_out"])));
				$data['status_seting']  = set_value('status_seting',$keuangan["status_seting"]);
				$this->load->view("sa/isi",$data);
      }
      if($mode=='simpan_edit'){
				  if($this->m_sa->edit_abs_seting()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
						redirect(base_url('sa/seting_absen'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
						redirect(base_url('sa/seting_absen'));
				  }
      }
		}
  }
  function mitra($mode='view')
  {
	$data['page']  = "mitra";
		$data['header'] = "DATA PEMBAYARAN INSTANSI";
		$data['title'] = "DATA PEMBAYARAN INSTANSI";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','5');
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
		//======================= IMPORTANT =========================================
		$data['id']   = $this->uri->segment(4, 0);
    $data['id2']   = $this->uri->segment(5, 0);
    if($mode=='view'){
			$this->tampil($data);
		}
    else if($mode=='data'){
			echo json_encode($this->m_sa->mitra_all($data['id']));
		}
/*  	else if($mode=='hapus'){
			$this->db->select("COUNT(*) as num");
			$this->db->where('find_in_set("'.$data['id'].'", id_berkas) != 0');
			$this->db->or_where('find_in_set("'.$data['id'].'", id_ijasah) != 0');
			$this->db->or_where('find_in_set("'.$data['id'].'", id_str) != 0');
			$this->db->or_where('find_in_set("'.$data['id'].'", id_sertifikat) != 0');
			$q = $this->db->get('kr_pengajuan')->row();
			$jml = $q->num;
			if($jml == 0){
				$berkase=$this->m_umum->ambil_data('berkas','id_berkas',$data['id']);
				$cek_file=FCPATH.'assets/berkas/ol/'.$berkase['link_berkas'];
				if(file_exists($cek_file)){
					unlink(FCPATH."assets/berkas/ol/".$berkase['link_berkas']);
				}
				$this->m_umum->hapus_data('berkas','id_berkas',$data['id']);
				$this->session->set_flashdata('sukses', 'Berkas Sudah Di Hapus');
				redirect(base_url('pegawai/berkas'));
			}else{
				$this->session->set_flashdata('danger', 'Berkas Sudah Di Pakai Pengajuan');
				redirect(base_url('pegawai/berkas'));
			}
    }*/
  	else{
			  $data['cmd_status'] = array('0'=>'Unset','1'=>'Premium','2'=>'Free');
			  $data['kol_mitra'] = $this->m_sa->cmd_kol_mitra($data['id']);
			  $data['kol_srt_sjab'] = $this->m_sa->cmd_srt_sjab($data['id']);
        $data['pegawe'] = $this->m_sa->ambil_data_pegawai($data['id']);
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
    		$data['barcode_pegawai']  = set_value('barcode_pegawai',$this->input->post("barcode_pegawai"));
        $data['id_struktur_jabatan']  = set_value('id_struktur_jabatan',$this->input->post("id_struktur_jabatan"));
    		$data['ket_working_mitra']  = set_value('ket_working_mitra',$this->input->post("ket_working_mitra"));
    		$data['status_working_mitra']  = set_value('status_working_mitra',$this->input->post("status_working_mitra"));
    		$data['nominal_working_mitra']  = set_value('nominal_working_mitra',0);
    		$data['struk_working_mitra']  = set_value('struk_working_mitra',$this->input->post("struk_working_mitra"));
    		$data['tgl_awal_working_mitra']  = set_value('tgl_awal_working_mitra',date('d-m-Y'));
    		$data['tgl_akhir_working_mitra']  = set_value('tgl_akhir_working_mitra',date('d-m-Y'));
    		$this->form_validation->set_rules('id_working','id_working','required');
        if ($this->form_validation->run() === FALSE){
			     $this->tampil($data);
        }else{
        	$id_struktur_jabatan = $this->input->post('id_struktur_jabatan');
        	$ambil_ide_mitra = $this->m_umum->ambil_data('kol_mitra','id_struktur_jabatan',$id_struktur_jabatan);
					$kondisi = array('id_struktur_jabatan'=>$id_struktur_jabatan);
					$jml = $this->m_umum->jumlah_record_filter('kol_mitra',$kondisi);
    			$data = array();
    			$filesCount = count($_FILES['upload_Files']['name']);
					for($i = 0; $i < $filesCount; $i++){
						$_FILES['upload_File']['name'] = $_FILES['upload_Files']['name'][$i];
						$_FILES['upload_File']['type'] = $_FILES['upload_Files']['type'][$i];
						$_FILES['upload_File']['tmp_name'] = $_FILES['upload_Files']['tmp_name'][$i];
						$_FILES['upload_File']['error'] = $_FILES['upload_Files']['error'][$i];
						$_FILES['upload_File']['size'] = $_FILES['upload_Files']['size'][$i];
  					$uploadPath = 'assets/berkas/struk/';
  					$config['upload_path'] = $uploadPath;
  					$config['allowed_types'] = 'pdf';
						$config['encrypt_name'] = TRUE;
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if($this->upload->do_upload('upload_File')){
							$fileData = $this->upload->data();
							if($jml == 0){
								$Q = $this->m_sa->simpan_mitra($fileData['file_name']);
							}else{
								$Q = $ambil_ide_mitra['id_mitra'];
								$this->m_sa->edit_mitra($fileData['file_name']);
							}
							$this->m_sa->simpan_kol_working_mitra($fileData['file_name'],$Q);
						}else{
    					$nole = '';
							if($jml == 0){
								$Q = $this->m_sa->simpan_mitra($nole);
							}else{
								$Q = $ambil_ide_mitra['id_mitra'];
								$this->m_sa->edit_mitra($nole);
							}
    					$this->m_sa->simpan_kol_working_mitra($nole,$Q);
						}
					}
              $this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
              redirect(base_url('sa/work'));
				}
	  	}
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
        $knds = array('id_working_mitra'=>$data['id2']);
        $berkase = $this->m_umum->ambil_data_kondisi_2tabel_row('kol_working_mitra',$knds,'kol_mitra','id_mitra');  
    		$data['id_working_mitra']  = set_value('id_working_mitra',$berkase['id_working_mitra']);
    		$data['id_mitra']  = set_value('id_mitra',$berkase['id_mitra']);
    		$data['ket_working_mitra']  = set_value('ket_working_mitra',$berkase['ket_working_mitra']);
    		$data['status_working_mitra']  = set_value('status_working_mitra',$berkase['status_working_mitra']);
        $data['id_struktur_jabatan']  = set_value('id_struktur_jabatan',$berkase['id_struktur_jabatan']);
        $data['barcode_pegawai']  = set_value('barcode_pegawai',$berkase['barcode_pegawai']);
    		$data['struk_working_mitra']  = set_value('struk_working_mitra',$berkase['struk_working_mitra']);
    		$data['nominal_working_mitra']  = set_value('nominal_working_mitra',number_format($berkase['nominal_working_mitra'], 0, ',', '.'));
    		$data['tgl_awal_working_mitra']  = set_value('tgl_awal_working_mitra',date('d-m-Y', strtotime($berkase["tgl_awal_working_mitra"])));
        $data['tgl_akhir_working_mitra']  = set_value('tgl_akhir_working_mitra',date('d-m-Y', strtotime($berkase["tgl_akhir_working_mitra"])));
    		$this->form_validation->set_rules('id_working_mitra','id_working_mitra','required');
        if ($this->form_validation->run() === FALSE){
			       $this->tampil($data);
        }else{
          $id_struktur_jabatan = $this->input->post('id_struktur_jabatan');
          $ambil_ide_mitra = $this->m_umum->ambil_data('kol_mitra','id_struktur_jabatan',$id_struktur_jabatan);
          $kondisi = array('id_struktur_jabatan'=>$id_struktur_jabatan);
          $jml = $this->m_umum->jumlah_record_filter('kol_mitra',$kondisi);
    			$data = array();
    			$filesCount = count($_FILES['upload_Files']['name']);
			    for($i = 0; $i < $filesCount; $i++){
    				$_FILES['upload_File']['name'] = $_FILES['upload_Files']['name'][$i];
    				$_FILES['upload_File']['type'] = $_FILES['upload_Files']['type'][$i];
    				$_FILES['upload_File']['tmp_name'] = $_FILES['upload_Files']['tmp_name'][$i];
    				$_FILES['upload_File']['error'] = $_FILES['upload_Files']['error'][$i];
    				$_FILES['upload_File']['size'] = $_FILES['upload_Files']['size'][$i];
    				$uploadPath = 'assets/berkas/struk/';
    				$config['upload_path'] = $uploadPath;
    				$config['allowed_types'] = 'pdf';
    				$config['encrypt_name'] = TRUE;
    				$this->load->library('upload', $config);
    				$this->upload->initialize($config);
            if($this->upload->do_upload('upload_File')){
            $id_mitra = $this->input->post('id_mitra');
            $user_pic=$this->m_umum->ambil_data('kol_mitra','id_mitra',$id_mitra);
            $cek_file=FCPATH.'assets/berkas/struk/'.$user_pic['struk_mitra'];
            if(file_exists($cek_file)){
              unlink(FCPATH."assets/berkas/struk/".$user_pic['struk_mitra']);
            }
              $fileData = $this->upload->data();
              if($jml == 0){
                $Q = $this->m_sa->simpan_mitra($fileData['file_name']);
              }else{
                $Q = $ambil_ide_mitra['id_mitra'];
                $this->m_sa->edit_mitra($fileData['file_name']);
              }
              $this->m_sa->edit_kol_working_mitra($fileData['file_name'],$Q);
            }else{
              $nole = '';
              if($jml == 0){
                $Q = $this->m_sa->simpan_mitra($nole);
              }else{
                $Q = $ambil_ide_mitra['id_mitra'];
                $this->m_sa->edit_mitra($nole);
              }
              $this->m_sa->edit_kol_working_mitra($nole,$Q);
            }
			    }
              $this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
              redirect(base_url('sa/work'));
		    }	
	    }
		}
  }
	function mitras($mode='view'){
		$data['page']="mitras"; 
		$data['header'] = "DATA PEMBAYARAN INSTANSI";
		$data['title'] = "DATA PEMBAYARAN INSTANSI";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','5');
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
		//======================= IMPORTANT =========================================
		$data['id']   = $this->uri->segment(4, 0);
		if($mode=='view'){
			$this->tampil($data);
		}
		else if($mode=='data'){
			echo json_encode($this->m_sa->mitra_all($data['id']));
		}
		else{
			  $data['cmd_status'] = array('0'=>'Unset','1'=>'Premium','2'=>'Free');
			  $data['kol_mitra'] = $this->m_sa->cmd_kol_mitra($data['id']);
    if($mode=='bayar'){
    		$data['page'] =  $data['page']."_bayar";
    		$data['id_mitra']  = set_value('id_mitra',$this->input->post("id_mitra"));
    		$data['ket_working_mitra']  = set_value('ket_working_mitra',$this->input->post("ket_working_mitra"));
    		$data['status_bayar_working_mitra']  = set_value('status_bayar_working_mitra',$this->input->post("status_bayar_working_mitra"));
    		$data['struk_working_mitra']  = set_value('struk_working_mitra',$this->input->post("struk_working_mitra"));
    		$data['expired_working_mitra']  = set_value('expired_working_mitra',date('d-m-Y'));
/*				$take = $this->m_umum->ambil_data('kol_working_mitra','id_working',$data['id']);		
				$data['id_mitra']  = set_value('id_mitra',$take['id_mitra']);
				$data['ket_working_mitra']  = set_value('ket_working_mitra',$take['ket_working_mitra']);
				$data['status_bayar_working_mitra']  = set_value('status_bayar_working_mitra',$take['status_bayar_working_mitra']);
				$data['struk_working_mitra']  = set_value('struk_working_mitra',$take['struk_working_mitra']);
				$data['expired_working_mitra']  = set_value('expired_working_mitra',date('d-m-Y', strtotime($take['expired_working_mitra'])));*/
  		$this->form_validation->set_rules('id_working','id_working','required');
      if ($this->form_validation->run() === FALSE){
			     $this->tampil($data);
      }else{
    			$id_working = $this->input->post('id_working');
  				$data = array();
  				$filesCount = count($_FILES['upload_Files']['name']);
				  for($i = 0; $i < $filesCount; $i++){
  					$_FILES['upload_File']['name'] = $_FILES['upload_Files']['name'][$i];
  					$_FILES['upload_File']['type'] = $_FILES['upload_Files']['type'][$i];
  					$_FILES['upload_File']['tmp_name'] = $_FILES['upload_Files']['tmp_name'][$i];
  					$_FILES['upload_File']['error'] = $_FILES['upload_Files']['error'][$i];
  					$_FILES['upload_File']['size'] = $_FILES['upload_Files']['size'][$i];
  					$uploadPath = 'assets/berkas/struk/';
  					$config['upload_path'] = $uploadPath;
  					$config['allowed_types'] = 'pdf';
  					$config['encrypt_name'] = TRUE;
  					$this->load->library('upload', $config);
  					$this->upload->initialize($config);

              if($this->upload->do_upload('upload_File')){
            $id_mitra = $this->input->post('id_mitra');
            $user_pic=$this->m_umum->ambil_data('kol_mitra','id_mitra',$id_mitra);
            $cek_file=FCPATH.'assets/berkas/struk/'.$user_pic['struk_mitra'];
            if(file_exists($cek_file)){
              unlink(FCPATH."assets/berkas/struk/".$user_pic['struk_mitra']);
            }
                $fileData = $this->upload->data();
                $this->m_member->edit_berkas_imut_file($fileData['file_name']);
                $this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
                redirect(base_url('member/blaporan'));
              }else{
                $nole = '';
                $this->m_member->edit_berkas_file($nole);
                $this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
                redirect(base_url('member/blaporan'));
              }




					  if($this->upload->do_upload('upload_File')){
            $id_pegawai = $this->input->post('id_pegawai');
            $user_pic=$this->m_umum->ambil_data('pegawai','id_pegawai',$id_pegawai);
            $cek_file=FCPATH.'assets/foto/ol/'.$user_pic['foto'];
            if(file_exists($cek_file)){
              unlink(FCPATH."assets/foto/ol/".$user_pic['foto']);
            }
  						$fileData = $this->upload->data();
              $this->m_member->edit_pegawai($fileData['file_name']);
  						$this->m_sa->simpan_kol_working_mitra($fileData['file_name']);
  						$this->session->set_flashdata('sukses', 'Data berhasil Di Tambah');
          }else{
            $this->m_member->edit_pegawai_no_pic();
          }
  					redirect(base_url('sa/mitra/bayar/',$id_working));
					}
     		}
    	}
		}
	}
	function work($mode='view'){
		$data['page']="work"; 
		$data['header'] = "DATA INSTANSI";
		$data['title'] = "DATA INSTANSI";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
//		$program = $this->m_umum->ambil_data('a_program','id_program','30');
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
		if($mode=='view'){
			$this->tampil($data);
		}
		else if($mode=='data'){
			echo json_encode($this->m_sa->work_all());
		}
		else{
	//		  $data['cmd_kategori_working'] = $this->m_ol_rancak->cmd_kategori_working();
	//		  $data['cmd_status'] = array('0'=>'Free','1'=>'Premium');
			if($mode=='tambah'){
			  $data['page'] =  $data['page']."_tambah";
    		$data['nama_working']  = set_value('nama_working',$this->input->post("nama_working"));
    		$data['alamat_working']  = set_value('alamat_working',$this->input->post("alamat_working"));    		
    		$data['email_working']  = set_value('email_working',$this->input->post("email_working"));    			
    		$data['kontak_working']  = set_value('kontak_working',$this->input->post("kontak_working"));
    		$data['status_bayar_working']  = set_value('status_bayar_working',$this->input->post("status_bayar_working"));
    		$data['expired_working']  = set_value('expired_working',date('d-m-Y'));
    		$data['id_cara_masuk']  = set_value('id_cara_masuk',$this->input->post("id_cara_masuk"));  		
    		$data['nominal_working']  = set_value('nominal_working',$this->input->post("nominal_working"));  		
				$this->load->view("sa/isi",$data);
			}
			if($mode=='simpan_tambah'){
				  if($this->m_sa->simpan_ol_instansi()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('sa/work'));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
						redirect(base_url('sa/work'));
					}
			}
			if($mode=='edit'){
			  $data['page'] =  $data['page']."_edit";
					$take = $this->m_umum->ambil_data('kol_working','id_working',$data['id']);		
					$data['id_working']  = set_value('id_working',$take['id_working']);
					$data['nama_working']  = set_value('nama_working',$take['nama_working']);
					$data['alamat_working']  = set_value('alamat_working',$take['alamat_working']);
					$data['email_working']  = set_value('email_working',$take['email_working']);
					$data['kontak_working']  = set_value('kontak_working',$take['kontak_working']);
				$this->load->view("sa/isi",$data);
			}
			if($mode=='simpan_edit'){
				  if($this->m_sa->edit_ol_instansi()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('sa/work'));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
						redirect(base_url('sa/work'));
					}
			}
			if($mode=='kop'){
				$data['page'] =  $data['page']."_kop";
					$take = $this->m_umum->ambil_data('kol_working','id_working',$data['id']);		
					$data['id_working']  = set_value('id_working',$take['id_working']);
					$this->form_validation->set_rules('id_working','id_working','required');
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
						$uploadPath = 'assets/berkas/kop/';
						$config['upload_path'] = $uploadPath;
						$config['allowed_types'] = 'gif|jpg|jpeg|png';
						$config['encrypt_name'] = TRUE;
						$id_working = $this->input->post('id_working');
						$user_pic=$this->m_umum->ambil_data('kol_working','id_working',$id_working);
						$cek_file=FCPATH.'assets/berkas/kop/'.$user_pic['kop_working'];
						if(file_exists($cek_file)){
							unlink(FCPATH."assets/berkas/kop/".$user_pic['kop_working']);
						}
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if($this->upload->do_upload('upload_File')){
							$fileData = $this->upload->data();
							$this->m_sa->edit_kop($fileData['file_name']);
							$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
							redirect(base_url('sa/work'));
						}else{
							$this->session->set_flashdata('danger', 'Data Gagal Upload');
							redirect(base_url('sa/work'));
						}
					}
				}
			}
			if($mode=='kop_sm'){
				$data['page'] =  $data['page']."_kop_sm";
					$take = $this->m_umum->ambil_data('kol_working','id_working',$data['id']);		
					$data['id_working']  = set_value('id_working',$take['id_working']);
					$this->form_validation->set_rules('id_working','id_working','required');
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
						$uploadPath = 'assets/berkas/kop/';
						$config['upload_path'] = $uploadPath;
						$config['allowed_types'] = 'gif|jpg|jpeg|png';
						$config['encrypt_name'] = TRUE;
						$id_working = $this->input->post('id_working');
						$user_pic=$this->m_umum->ambil_data('kol_working','id_working',$id_working);
						$cek_file=FCPATH.'assets/berkas/kop/'.$user_pic['kop_sm_working'];
						if(file_exists($cek_file)){
							unlink(FCPATH."assets/berkas/kop/".$user_pic['kop_sm_working']);
						}
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if($this->upload->do_upload('upload_File')){
							$fileData = $this->upload->data();
							$this->m_sa->edit_kop_sm($fileData['file_name']);
							$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
							redirect(base_url('sa/work'));
						}else{
							$this->session->set_flashdata('danger', 'Data Gagal Upload');
							redirect(base_url('sa/work'));
						}
					}
				}
			}
		}
	}
	function pcare($mode='view'){
		$data['page']="pcare"; 
		$data['header'] = "DATA BRIDGING PCARE";
		$data['title'] = "DATA BRIDGING PCARE";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
	//	$program = $this->m_umum->ambil_data('a_program','id_program','30');
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
		if($mode=='view'){
			$this->tampil($data);
		}
		else if($mode=='data'){
			echo json_encode($this->m_sa->pcare_all());
		}
		else{
			  $data['cmd_kategori_working'] = $this->m_ol_rancak->ambil_rujukan_working_null_data();
			  $data['cmd_status'] = $this->m_rancak->cmd_status();
			if($mode=='tambah'){
			  $data['page'] =  $data['page']."_tambah";
    		$data['id_instansi']  = set_value('id_instansi',$this->input->post("id_instansi"));
    		$data['cons_id']  = set_value('cons_id',$this->input->post("cons_id"));    		
    		$data['secret_key']  = set_value('secret_key',$this->input->post("secret_key"));    			
    		$data['base_url']  = set_value('base_url',$this->input->post("base_url"));
    		$data['service_name']  = set_value('service_name',$this->input->post("service_name"));
    		$data['pcare_user']  = set_value('pcare_user',$this->input->post("pcare_user"));  		
    		$data['pcare_pass']  = set_value('pcare_pass',$this->input->post("pcare_pass"));  		
    		$data['user_key']  = set_value('user_key',$this->input->post("user_key"));
    		$data['kd_aplikasi']  = set_value('kd_aplikasi',$this->input->post("kd_aplikasi")); 
    		$data['status_pcare']  = set_value('status_pcare',$this->input->post("status_pcare"));     
				$this->load->view("sa/isi",$data);
			}
			if($mode=='simpan_tambah'){
				  if($this->m_sa->simpan_pcare()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('sa/pcare'));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
						redirect(base_url('sa/pcare'));
					}
			}
			if($mode=='edit'){
			  $data['page'] =  $data['page']."_edit";
					$take = $this->m_umum->ambil_data('a_pcare','id_pcare',$data['id']);		
					$data['id_pcare']  = set_value('id_pcare',$take['id_pcare']);
					$data['id_instansi']  = set_value('id_instansi',$take['id_instansi']);
					$data['cons_id']  = set_value('cons_id',$take['cons_id']);
					$data['secret_key']  = set_value('secret_key',$take['secret_key']);
					$data['base_url']  = set_value('base_url',$take['base_url']);
					$data['service_name']  = set_value('service_name',$take['service_name']);
					$data['pcare_user']  = set_value('pcare_user',$take['pcare_user']);
					$data['pcare_pass']  = set_value('pcare_pass',$take['pcare_pass']);
					$data['user_key']  = set_value('user_key',$take['user_key']);
					$data['kd_aplikasi']  = set_value('kd_aplikasi',$take['kd_aplikasi']);
					$data['status_pcare']  = set_value('status_pcare',$take['status_pcare']);
				$this->load->view("sa/isi",$data);
			}
			if($mode=='simpan_edit'){
				  if($this->m_sa->edit_pcare()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('sa/pcare'));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
						redirect(base_url('sa/pcare'));
					}
			}
		}
	}
  function kompetensi($mode='view')
  {
		$data['page']  = "kompetensi";
		$data['header'] = "MASTER KOMPETENSI";
		$data['title'] = "MASTER KOMPETENSI";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
	//	$program = $this->m_umum->ambil_data('a_program','id_program','30');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','5');
/*		$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
		$data['aran_jabatan'] = $jabatanekuh["nama_jabatan"];*/
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
			echo json_encode($this->m_sa->kompetensi_all());
		}
		else{
			$data['cmd_status'] = $this->m_rancak->cmd_status();
				$data['cmd_jabatan'] = $this->m_rancak->cmd_jabatan();
				$data['cmd_instansi'] = $this->m_umum->ambil_data('kol_working');
				$data['cmd_pluske'] = array('0'=>'Hanya kompetensi','1'=>'Dengan Kewenangan');
	    if($mode=='tambah'){
	      $data['page'] =  $data['page']."_tambah";
					$data['nama_kompetensi']  = set_value('nama_kompetensi',$this->input->post('nama_kompetensi'));
					$data['kode_unit']  = set_value('kode_unit',$this->input->post('kode_unit'));
					$data['id_jabatan']  = set_value('id_jabatan',$this->input->post('id_jabatan'));
					$data['id_instansi']  = set_value('id_instansi',$this->input->post('id_instansi'));
					$data['deskripsi_kompetensi']  = set_value('deskripsi_kompetensi',$this->input->post('deskripsi_kompetensi'));
					$data['pluske']  = set_value('pluske',$this->input->post('pluske'));
					$this->load->view("sa/isi",$data);
	    }
	    if($mode=='simpan_tambah'){
	    	$kode_unit = $this->input->post('kode_unit');
	    	$id_jabatan = $this->input->post('id_jabatan');
	    	$pluske = $this->input->post('pluske');
/*				$kondisi=array('kode_unit'=>$kode_unit);
				$jml = $this->m_umum->jumlah_record_tabel('nkr_kompetensi',$kondisi);
				if($jml == 0){*/
				  if($Q = $this->m_sa->simpan_nkr_kompetensi()){
				  	if($pluske == 1){
				  		$this->m_sa->simpan_plus_nkr_kewenangan($Q);
				  	}
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('sa/kompetensi'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
						redirect(base_url('sa/kompetensi'));
				  }
/*				}else{
            $this->session->set_flashdata('danger', 'Data Sudah Ada');
            redirect(base_url('master_kredensial/kompetensi'));
				}*/
	    }
	    if($mode=='edit'){
	      $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('nkr_kompetensi','id_kompetensi',$data['id']);
				$data['id_kompetensi']  = set_value('id_kompetensi',$keuangan["id_kompetensi"]);
				$data['nama_kompetensi']  = set_value('nama_kompetensi',$keuangan["nama_kompetensi"]);
				$data['kode_unit']  = set_value('kode_unit',$keuangan["kode_unit"]);
				$data['id_jabatan']  = set_value('id_jabatan',$keuangan["id_jabatan"]);
				$data['id_instansi']  = set_value('id_instansi',$keuangan["instansi_kompetensi"]);
				$data['deskripsi_kompetensi']  = set_value('deskripsi_kompetensi',$keuangan["deskripsi_kompetensi"]);
				$data['status_kompetensi']  = set_value('status_kompetensi',$keuangan["status_kompetensi"]);
				$data['creator_kompetensi']  = set_value('creator_kompetensi',$keuangan["creator_kompetensi"]);
				$this->load->view("sa/isi",$data);
	    }
	    if($mode=='simpan_edit'){
						  if($this->m_sa->edit_nkr_kompetensi()){
								$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
								redirect(base_url('sa/kompetensi'));
						  }else{
								$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
								redirect(base_url('sa/kompetensi'));
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
	//	$program = $this->m_umum->ambil_data('a_program','id_program','30');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','5');
/*		$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
		$data['aran_jabatan'] = $jabatanekuh["nama_jabatan"];*/
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
		$data['id']   = $this->uri->segment(4, 0);
    if($mode=='view'){
			$this->tampil($data);
		}
    else if($mode=='data'){
			echo json_encode($this->m_sa->kewenangane_all());
		}
		else{
			$data['cmd_kompetensi']=$this->m_sa->cmd_kompetensi_in();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['id_kompetensi']  = set_value('id_kompetensi',$this->input->post('id_kompetensi'));
				$data['nama_kewenangan']  = set_value('nama_kewenangan',$this->input->post('nama_kewenangan'));
				$this->load->view("sa/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($this->m_sa->simpan_nkr_kewenangan()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('sa/kewenangan'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('sa/kewenangan'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('nkr_kewenangan','id_kewenangan',$data['id']);
				$data['id_kompetensi']  = set_value('id_kompetensi',$keuangan["id_kompetensi"]);
				$data['nama_kewenangan']  = set_value('nama_kewenangan',$keuangan["nama_kewenangan"]);
				$data['id_kewenangan']  = set_value('id_kewenangan',$keuangan["id_kewenangan"]);
				$data['creator_kewenangan']  = set_value('creator_kewenangan',$keuangan["creator_kewenangan"]);
				$this->load->view("sa/isi",$data);
      }
      if($mode=='simpan_edit'){
					  if($this->m_sa->edit_nkr_kewenangan()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('sa/kewenangan'));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('sa/kewenangan'));
					  }
      }
		}
  }
	function skewenangan($mode='view'){
		$data['page']="skewenangan"; 
		$data['header'] = "DATA KEWENANGAN";
		$data['title'] = "DATA KEWENANGAN";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
	//	$program = $this->m_umum->ambil_data('a_program','id_program','30');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','5');
/*		$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
		$data['aran_jabatan'] = $jabatanekuh["nama_jabatan"];*/
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
		if($mode=='view'){
			$this->tampil($data);
		}
		else if($mode=='data'){
			echo json_encode($this->m_sa->kewenangan_all());
		}
		else{
			  $data['cmd_kategori_working'] = $this->m_ol_rancak->ambil_rujukan_working_null_data();
			  $data['cmd_status'] = $this->m_rancak->cmd_status();
			if($mode=='tambah'){
			  $data['page'] =  $data['page']."_tambah";
    		$data['id_instansi']  = set_value('id_instansi',$this->input->post("id_instansi"));
    		$data['cons_id']  = set_value('cons_id',$this->input->post("cons_id"));    		
    		$data['secret_key']  = set_value('secret_key',$this->input->post("secret_key"));    			
    		$data['base_url']  = set_value('base_url',$this->input->post("base_url"));
    		$data['service_name']  = set_value('service_name',$this->input->post("service_name"));
    		$data['pcare_user']  = set_value('pcare_user',$this->input->post("pcare_user"));  		
    		$data['pcare_pass']  = set_value('pcare_pass',$this->input->post("pcare_pass"));  		
    		$data['user_key']  = set_value('user_key',$this->input->post("user_key"));
    		$data['kd_aplikasi']  = set_value('kd_aplikasi',$this->input->post("kd_aplikasi")); 
    		$data['status_pcare']  = set_value('status_pcare',$this->input->post("status_pcare"));     
				$this->load->view("sa/isi",$data);
			}
			if($mode=='simpan_tambah'){
				  if($this->m_sa->simpan_pcare()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('sa/pcare'));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
						redirect(base_url('sa/pcare'));
					}
			}
			if($mode=='edit'){
			  $data['page'] =  $data['page']."_edit";
					$take = $this->m_umum->ambil_data('a_pcare','id_pcare',$data['id']);		
					$data['id_pcare']  = set_value('id_pcare',$take['id_pcare']);
					$data['id_instansi']  = set_value('id_instansi',$take['id_instansi']);
					$data['cons_id']  = set_value('cons_id',$take['cons_id']);
					$data['secret_key']  = set_value('secret_key',$take['secret_key']);
					$data['base_url']  = set_value('base_url',$take['base_url']);
					$data['service_name']  = set_value('service_name',$take['service_name']);
					$data['pcare_user']  = set_value('pcare_user',$take['pcare_user']);
					$data['pcare_pass']  = set_value('pcare_pass',$take['pcare_pass']);
					$data['user_key']  = set_value('user_key',$take['user_key']);
					$data['kd_aplikasi']  = set_value('kd_aplikasi',$take['kd_aplikasi']);
					$data['status_pcare']  = set_value('status_pcare',$take['status_pcare']);
				$this->load->view("sa/isi",$data);
			}
			if($mode=='simpan_edit'){
				  if($this->m_sa->edit_pcare()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('sa/pcare'));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
						redirect(base_url('sa/pcare'));
					}
			}
		}
	}
	function working($mode='view'){
		$data['page']="working"; 
		$data['header'] = "DATA BEKERJA";
		$data['title'] = "DATA BEKERJA";
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
		//======================= IMPORTANT =========================================
		$data['id']   = $this->uri->segment(4, 0);
		if($mode=='view'){
			$this->tampil($data);
		}
		else if($mode=='data'){
			echo json_encode($this->m_sa->working_all());
		}
		else{
			  $data['cmd_status'] = $this->m_rancak->cmd_status();
			  $data['ambil_data_rujukan_working'] = $this->m_ol_rancak->ambil_data_rujukan_working();
			  $data['ambil_data_pegawai_4_sa'] = $this->m_ol_rancak->ambil_data_pegawai_4_sa_no_null();
			if($mode=='tambah'){
			  $data['page'] =  $data['page']."_tambah";
    		$data['id_pegawai']  = set_value('id_pegawai',$this->input->post("id_pegawai"));
    		$data['id_instansi']  = set_value('id_instansi',$this->input->post("id_instansi"));
    		$data['status_pegawai_instansi']  = set_value('status_pegawai_instansi',$this->input->post("status_pegawai_instansi"));    		
				$this->load->view("sa/isi",$data);
			}
			if($mode=='simpan_tambah'){
			$id_instansi = $this->input->post('id_instansi');
			$id_pegawai = $this->input->post('id_pegawai');
			$kondisi=array('id_instansi'=>$id_instansi,'id_pegawai'=>$id_pegawai);
			$jml = $this->m_umum->jumlah_record_filter('ol_pegawai_instansi',$kondisi);
			if($jml == 0){
				  if($this->m_sa->simpan_pegawai_instansi()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('sa/working'));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
						redirect(base_url('sa/working'));
					}
				}else{
						$this->session->set_flashdata('danger', 'Data Sudah Ada');
						redirect(base_url('sa/working'));					
				}
			}
			if($mode=='edit'){
			  $data['page'] =  $data['page']."_edit";
				$take = $this->m_umum->ambil_data('ol_pegawai_instansi','id_pegawai_instansi',$data['id']);		
				$data['id_instansi']  = set_value('id_instansi',$take['id_instansi']);
				$data['id_pegawai']  = set_value('id_pegawai',$take['id_pegawai']);
				$data['status_pegawai_instansi']  = set_value('status_pegawai_instansi',$take['status_pegawai_instansi']);
				$this->load->view("sa/isi",$data);
			}
			if($mode=='simpan_edit'){
				$id_instansi = $this->input->post('id_instansi');
				$id_pegawai = $this->input->post('id_pegawai');
				$id_instansi_lama = $this->input->post('id_instansi_lama');
				$kondisi=array('id_instansi'=>$id_instansi,'id_instansi !='=>$id_instansi_lama,'id_pegawai'=>$id_pegawai);
				$jml = $this->m_umum->jumlah_record_filter('ol_pegawai_instansi',$kondisi);
				if($jml == 0){
				  if($this->m_sa->edit_pegawai_instansi()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('sa/working'));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
						redirect(base_url('sa/working'));
					}
				}else{
							$this->session->set_flashdata('danger', 'Data Sudah Ada');
							redirect(base_url('sa/working'));					
				}
			}
		}
	}
	function grade($mode='view'){
		$data['page']="grade"; 
		$data['header'] = "DATA GRADE";
		$data['title'] = "DATA GRADE";
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
		//======================= IMPORTANT =========================================
		$data['id']   = $this->uri->segment(4, 0);
		if($mode=='view'){
			$this->tampil($data);
		}
		else if($mode=='data'){
			echo json_encode($this->m_sa->grade_all());
		}
		else{
			  $data['jabatan'] = $this->m_rancak->cmd_jabatan();
			if($mode=='tambah'){
			  $data['page'] =  $data['page']."_tambah";
    		$data['nama_grade']  = set_value('nama_grade',$this->input->post("nama_grade"));
    		$data['id_jabatan']  = set_value('id_jabatan',$this->input->post("id_jabatan"));
    		$data['sifat_tugas_grade']  = set_value('sifat_tugas_grade',$this->input->post("sifat_tugas_grade"));    		
    		$data['syarat_grade']  = set_value('syarat_grade',$this->input->post("syarat_grade"));    		
				$this->load->view("sa/isi",$data);
			}
			if($mode=='simpan_tambah'){
				  if($this->m_sa->simpan_grade()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('sa/grade'));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
						redirect(base_url('sa/grade'));
					}
			}
			if($mode=='edit'){
			  $data['page'] =  $data['page']."_edit";
				$take = $this->m_umum->ambil_data('ol_pegawai_grade','id_grade',$data['id']);		
				$data['id_grade']  = set_value('id_grade',$take['id_grade']);
				$data['id_jabatan']  = set_value('id_jabatan',$take['id_jabatan']);
				$data['nama_grade']  = set_value('nama_grade',$take['nama_grade']);
				$data['syarat_grade']  = set_value('syarat_grade',$take['syarat_grade']);
				$data['sifat_tugas_grade']  = set_value('sifat_tugas_grade',$take['sifat_tugas_grade']);
				$this->load->view("sa/isi",$data);
			}
			if($mode=='simpan_edit'){
				  if($this->m_sa->edit_grade()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('sa/grade'));
					}else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Buat Data');
						redirect(base_url('sa/grade'));
					}
			}
		}
	}
  function aplikasi_bayar($mode='view')
  {
		$data['page']  = "aplikasi_bayar";
		$data['header'] = "DATA KERJASAMA";
		$data['title'] = "DATA KERJASAMA";
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
		$data['id']   = $this->uri->segment(4, 0);
    if($mode=='view'){
			$this->tampil($data);
		}
    else if($mode=='data'){
			echo json_encode($this->m_sa->aplikasi_bayar_all());
		}
		else{
			$data['cmd_tipe'] = array('1'=>'Instansi','2'=>'Komite','3'=>'Pribadi');
			$data['cmd_status'] = array('0'=>'Free','1'=>'Berbayar');
			$data['ambil_data_pegawai'] = $this->m_ol_rancak->ambil_data_pegawai_4_sa_no_null();
			$data['ambil_data_working'] = $this->m_ol_rancak->ambil_rujukan_working_null_data();
	    if($mode=='tambah'){
	      $data['page'] =  $data['page']."_tambah";
				$data['id_konsumen']  = set_value('id_konsumen',$this->input->post("id_konsumen"));
				$data['id_instansi']  = set_value('id_instansi',$this->input->post("id_instansi"));
				$data['tipe_konsumen']  = set_value('tipe_konsumen',$this->input->post("tipe_konsumen"));
				$data['status_aplikasi_bayar']  = set_value('status_aplikasi_bayar',$this->input->post("status_aplikasi_bayar"));
				$data['nominal_aplikasi_bayar']  = set_value('nominal_aplikasi_bayar',$this->input->post("nominal_aplikasi_bayar"));
				$data['tgl_expired']  = set_value('tgl_expired',date('d-m-Y'));
				$this->load->view("sa/isi",$data);
	    }
	    if($mode=='simpan_tambah'){
	    	$id_konsumen = $this->input->post('id_konsumen'); 
				$kondisi=array('id_konsumen'=>$id_konsumen);
				$jml = $this->m_umum->jumlah_record_filter('aplikasi_bayar',$kondisi);
				if($jml == 0){
				  if($idl = $this->m_sa->simpan_aplikasi_bayar()){
				  	$this->m_sa->simpan_aplikasi_bayar_log($idl);
						$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
						redirect(base_url('sa/aplikasi_bayar'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Masalah Edit Data');
						redirect(base_url('sa/aplikasi_bayar'));
					}
				}else{
						$this->session->set_flashdata('danger', 'Data Sudah Ada, Edit Data Saja');
						redirect(base_url('sa/aplikasi_bayar'));
				}
	    }
	    if($mode=='edit'){
	      $data['page'] =  $data['page']."_edit";
				$inst = $this->m_umum->ambil_data('aplikasi_bayar','id_aplikasi_bayar',$data['id']);
				$data['id_konsumen']  = set_value('id_konsumen',$inst['id_konsumen']);
				$data['id_instansi']  = set_value('id_instansi',$inst['id_instansi']);
				$data['tipe_konsumen']  = set_value('tipe_konsumen',$inst['tipe_konsumen']);
				$data['status_aplikasi_bayar']  = set_value('status_aplikasi_bayar',$inst['status_aplikasi_bayar']);
				$data['nominal_aplikasi_bayar']  = set_value('nominal_aplikasi_bayar',number_format($inst['nominal_aplikasi_bayar'],0));
				$data['tgl_expired']  = set_value('tgl_expired',date('d-m-Y',strtotime($inst['tgl_expired'])));
				$data['id_aplikasi_bayar']  = set_value('id_aplikasi_bayar',$inst['id_aplikasi_bayar']);
				$this->load->view("sa/isi",$data);
	    }
	    if($mode=='simpan_edit'){
			  if($this->m_sa->edit_aplikasi_bayar()){
			  	$id_aplikasi_bayar = $this->input->post('id_aplikasi_bayar');
			  	$this->m_sa->simpan_aplikasi_bayar_log($id_aplikasi_bayar);
					$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
					redirect(base_url('sa/aplikasi_bayar'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Masalah Edit Data');
					redirect(base_url('sa/aplikasi_bayar'));
			  }
	    }
		}
  }
  function pelayanan($mode='view')
  {
		$data['page']  = "pelayanan";
		$data['header'] = "DATA JENIS PELAYANAN INSTANSI";
		$data['title'] = "DATA JENIS PELAYANAN INSTANSI";
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
		$data['id']   = $this->uri->segment(4, 0);
    if($mode=='view'){
			$this->tampil($data);
		}
    else if($mode=='data'){
			echo json_encode($this->m_sa->pelayanan_all());
		}
		else{
			$data['ambil_data_working'] = $this->m_ol_rancak->ambil_data_rujukan_working();
			$data['cmd_status'] = $this->m_rancak->cmd_status();
	    if($mode=='tambah'){
	      $data['page'] =  $data['page']."_tambah";
				$data['id_instansi']  = set_value('id_instansi',$this->input->post("id_instansi"));
				$data['nama_pelayanan']  = set_value('nama_pelayanan',$this->input->post("nama_pelayanan"));
				$data['status_pelayanan']  = set_value('status_pelayanan',$this->input->post("status_pelayanan"));
				$this->load->view("sa/isi",$data);
	    }
	    if($mode=='simpan_tambah'){
	    	$nama_pelayanan = $this->input->post('nama_pelayanan'); 
	    	$id_instansi = $this->input->post('id_instansi'); 
				$kondisi=array('nama_pelayanan'=>$nama_pelayanan,'id_instansi'=>$id_instansi);
				$jml = $this->m_umum->jumlah_record_filter('ol_pelayanan',$kondisi);
				if($jml == 0){
				  if($this->m_sa->simpan_pelayanan()){
						$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
						redirect(base_url('sa/pelayanan'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Masalah Simpan Data');
						redirect(base_url('sa/pelayanan'));
					}
				}else{
						$this->session->set_flashdata('danger', 'Data Sudah Ada, Edit Data Saja');
						redirect(base_url('sa/pelayanan'));
				}
	    }
	    if($mode=='edit'){
	      $data['page'] =  $data['page']."_edit";
				$inst = $this->m_umum->ambil_data('ol_pelayanan','id_pelayanan',$data['id']);
				$data['id_pelayanan']  = set_value('id_pelayanan',$inst['id_pelayanan']);
				$data['id_instansi']  = set_value('id_instansi',$inst['id_instansi']);
				$data['nama_pelayanan']  = set_value('nama_pelayanan',$inst['nama_pelayanan']);
				$data['status_pelayanan']  = set_value('status_pelayanan',$inst['status_pelayanan']);
				$this->load->view("sa/isi",$data);
	    }
	    if($mode=='simpan_edit'){
			  if($this->m_sa->edit_pelayanan()){
					$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
					redirect(base_url('sa/pelayanan'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Masalah Edit Data');
					redirect(base_url('sa/pelayanan'));
			  }
	    }
		}
  }
  function ruangan($mode='view')
  {
		$data['page']  = "ruangan";
		$data['header'] = "UNTUK KATEGORI KOMPETENSI LOGBOOK";
		$data['title'] = "UNTUK KATEGORI KOMPETENSI LOGBOOK";
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
		$data['id']   = $this->uri->segment(4, 0);
    if($mode=='view'){
			$this->tampil($data);
		}
    else if($mode=='data'){
			echo json_encode($this->m_sa->ruangan_all());
		}
		else{
			$data['cmd_struktur_jabatan'] = $this->m_rancak->cmd_struktur_jabatan();
			$data['cmd_status'] = $this->m_rancak->cmd_status();
	    if($mode=='tambah'){
	      $data['page'] =  $data['page']."_tambah";
				$data['id_struktur_jabatan']  = set_value('id_struktur_jabatan',$this->input->post("id_struktur_jabatan"));
				$data['nama_unit']  = set_value('nama_unit',$this->input->post("nama_unit"));
				$data['status_unit']  = set_value('status_unit',$this->input->post("status_unit"));
				$this->load->view("sa/isi",$data);
	    }
	    if($mode=='simpan_tambah'){
	    	$nama_unit = $this->input->post('nama_unit'); 
	    	$id_struktur_jabatan = $this->input->post('id_struktur_jabatan'); 
				$kondisi=array('nama_unit'=>$nama_ruangan,'id_struktur_jabatan'=>$id_struktur_jabatan);
				$jml = $this->m_umum->jumlah_record_filter('ol_unit',$kondisi);
				if($jml == 0){
				  if($this->m_sa->simpan_ruangan()){
						$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
						redirect(base_url('sa/ruangan'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Masalah Simpan Data');
						redirect(base_url('sa/ruangan'));
					}
				}else{
						$this->session->set_flashdata('danger', 'Data Sudah Ada, Edit Data Saja');
						redirect(base_url('sa/ruangan'));
				}
	    }
	    if($mode=='edit'){
	      $data['page'] =  $data['page']."_edit";
				$inst = $this->m_umum->ambil_data('ol_unit','id_unit',$data['id']);
				$data['id_unit']  = set_value('id_unit',$inst['id_unit']);
				$data['id_struktur_jabatan']  = set_value('id_struktur_jabatan',$inst['id_struktur_jabatan']);
				$data['nama_unit']  = set_value('nama_unit',$inst['nama_unit']);
				$data['status_unit']  = set_value('status_unit',$inst['status_unit']);
				$this->load->view("sa/isi",$data);
	    }
	    if($mode=='simpan_edit'){
			  if($this->m_sa->edit_ruangan()){
					$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
					redirect(base_url('sa/ruangan'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Masalah Edit Data');
					redirect(base_url('sa/ruangan'));
			  }
	    }
		}
  }
  function program($mode='view')
  {
	$data['page']  = "program";
	$data['header'] = "SINKRONISASI PROGRAM";
	$data['title'] = "SINKRONISASI PROGRAM";
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
	$data['id']   = $this->uri->segment(4, 0);
	$data['table']   = $this->uri->segment(5, 0);
	$data['field']   = $this->uri->segment(6, 0);
	$data['id_field']   = $this->uri->segment(7, 0);
	$data['nama_field']   = $this->uri->segment(8, 0);
    if($mode=='view'){
	$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_sa->basic_program_all());
	}
	else{
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		$data['nama_program']  = set_value('nama_program',$this->input->post("nama_program"));
		$this->load->view("sa/isi",$data);
      }
      if($mode=='simpan_tambah'){
		  if($this->m_sa->simpan_program()){
			$this->session->set_flashdata('sukses', 'Data berhasil Di Tambah');
			redirect(base_url('sa/program'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Edit Data');
			redirect(base_url('sa/program'));
		  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
		$programe = $this->m_umum->ambil_data('a_program','id_program',$data['id']);
		$data['nama_program']  = set_value('nama_program',$programe['nama_program']);
		$this->load->view("sa/isi",$data);
      }
      if($mode=='simpan_edit'){
		  if($this->m_sa->edit_program()){
			$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
			redirect(base_url('sa/program'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Edit Data');
			redirect(base_url('sa/program'));
		  }
      }
      if($mode=='isi'){
		$data['kirik']=$this->m_sa->ambil_isi_program($data['table']);
        $data['page'] =  $data['page']."_isi";
		$programe = $this->m_umum->ambil_data('a_program','id_program',$data['id']);
		$data['isine']  = $programe[$data['table']];
		$this->load->view("sa/isi",$data);
      }
      if($mode=='simpan_isi'){
		  $table=$this->input->post('table');
		  if($this->m_sa->rubah_isi_program($table)){
			$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
			redirect(base_url('sa/program'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Edit Data');
			redirect(base_url('sa/program'));
		  }
      }
	}
  }
  function lakon($mode='view')
  {
		$data['page']  = "lakon";
		$data['header'] = "SEMUA USER";
		$data['title'] = "SEMUA USER";
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
		$data['intstatus']   = $this->uri->segment(4, 0);
		$data['id']   = $this->uri->segment(5, 0);
	  if($mode=='view'){
			$this->tampil($data);
		}
	  else if($mode=='data'){
			echo json_encode($this->m_sa->whole_user());
		}
		else{
			if($mode=='status_user'){
				$d = $this->m_rancak->ambil_user_pegawai($data['id']);
				if($d['id_level'] == '99'){
					$this->session->set_flashdata('danger', 'Tidak dapat Merubah Superadmin');
					redirect(base_url('sa/lakon'));
				}else{
				  if($this->m_sa->status_user($data['intstatus'],$data['id'])){
						$this->session->set_flashdata('sukses', 'Sukses Rubah User');
						redirect(base_url('sa/lakon'));			  	
				  }else{
						$this->session->set_flashdata('danger', 'Masalah Edit Data');
						redirect(base_url('sa/lakon'));
				  }
				}
			}
			if($mode=='reset_password'){
				$d = $this->m_rancak->ambil_user_pegawai($data['id']);
				if($d['id_level'] == '99'){
					$this->session->set_flashdata('danger', 'Tidak dapat mereset Superadmin');
					redirect(base_url('sa/lakon'));
				}else{
				  if($this->m_sa->reset_password($data['id'])){
						$this->session->set_flashdata('sukses', 'Sukses Reset Password');
						redirect(base_url('sa/lakon'));			  	
				  }else{
						$this->session->set_flashdata('danger', 'Masalah Edit Data');
						redirect(base_url('sa/lakon'));
				  }
				}
			}
			if($mode=='status_pegawai'){
				$d = $this->m_rancak->ambil_user_pegawai($data['id']);
				if($d['id_level'] == '99'){
					$this->session->set_flashdata('danger', 'Tidak dapat Merubah Superadmin');
					redirect(base_url('sa/lakon'));
				}else{
				  if($this->m_sa->status_pegawai($data['intstatus'],$data['id'])){
						$this->session->set_flashdata('sukses', 'Sukses Rubah Pegawai');
						redirect(base_url('sa/lakon'));			  	
				  }else{
						$this->session->set_flashdata('danger', 'Masalah Edit Data');
						redirect(base_url('sa/lakon'));
				  }
				}
			}
		}
  }
  function ol_lakon($mode='view')
  {
		$data['page']  = "ol_lakon";
		$data['header'] = "SEMUA USER";
		$data['title'] = "SEMUA USER";
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
		$data['ambil_sn_working']=$this->m_ol_rancak->ambil_rujukan_working_null_data();
		$data['intstatus']   = $this->uri->segment(4, 0);
		$data['id']   = $this->uri->segment(5, 0);
	  if($mode=='view'){
			$this->tampil($data);
		}
	  else if($mode=='data'){
			echo json_encode($this->m_sa->ol_whole_user());
		}
		else{
			if($mode=='status_user'){
				$d = $this->m_ol_rancak->ambil_user_pegawai($data['id']);
				if($d['id_level'] == '99'){
					$this->session->set_flashdata('danger', 'Tidak dapat Merubah Superadmin');
					redirect(base_url('sa/ol_lakon'));
				}else{
				  if($this->m_sa->ol_status_user($data['intstatus'],$data['id'])){
						$this->session->set_flashdata('sukses', 'Sukses Rubah User');
						redirect(base_url('sa/ol_lakon'));			  	
				  }else{
						$this->session->set_flashdata('danger', 'Masalah Edit Data');
						redirect(base_url('sa/ol_lakon'));
				  }
				}
			}
			if($mode=='reset_password'){
				$d = $this->m_ol_rancak->ambil_user_pegawai($data['id']);
				if($d['id_level'] == 99){
					$this->session->set_flashdata('danger', 'Tidak dapat mereset Superadmin');
					redirect(base_url('sa/ol_lakon'));
				}else{
				  if($this->m_sa->ol_reset_password($data['id'])){
						$this->session->set_flashdata('sukses', 'Sukses Reset Password');
						redirect(base_url('sa/ol_lakon'));			  	
				  }else{
						$this->session->set_flashdata('danger', 'Masalah Edit Data');
						redirect(base_url('sa/ol_lakon'));
				  }
				}
			}
			if($mode=='status_pegawai'){
				$d = $this->m_ol_rancak->ambil_user_pegawai($data['id']);
				if($d['id_level'] == 99){
					$this->session->set_flashdata('danger', 'Tidak dapat Merubah Superadmin');
					redirect(base_url('sa/ol_lakon'));
				}else{
				  if($this->m_sa->ol_status_pegawai($data['intstatus'],$data['id'])){
						$this->session->set_flashdata('sukses', 'Sukses Rubah Pegawai');
						redirect(base_url('sa/ol_lakon'));			  	
				  }else{
						$this->session->set_flashdata('danger', 'Masalah Edit Data');
						redirect(base_url('sa/ol_lakon'));
				  }
				}
			}
			if($mode=='give_level'){
				$d = $this->m_ol_rancak->ambil_user_pegawai($data['id']);
				if($d['id_level'] == 99){
					$this->session->set_flashdata('danger', 'Tidak dapat Merubah Superadmin');
					redirect(base_url('sa/ol_lakon'));
				}else{
				  if($this->m_sa->beri_level($data['intstatus'],$data['id'])){
						$this->session->set_flashdata('sukses', 'Sukses Rubah Level');
						redirect(base_url('sa/ol_lakon'));			  	
				  }else{
						$this->session->set_flashdata('danger', 'Masalah Edit Data');
						redirect(base_url('sa/ol_lakon'));
				  }
				}
			}
			if($mode=='visible'){
				$d = $this->m_ol_rancak->ambil_user_pegawai($data['id']);
				if($d['id_level'] == 99){
					$this->session->set_flashdata('danger', 'Tidak dapat Merubah Superadmin');
					redirect(base_url('sa/ol_lakon'));
				}else{
				  if($this->m_sa->visible($data['intstatus'],$data['id'])){
						$this->session->set_flashdata('sukses', 'Sukses Rubah Level');
						redirect(base_url('sa/ol_lakon'));			  	
				  }else{
						$this->session->set_flashdata('danger', 'Masalah Edit Data');
						redirect(base_url('sa/ol_lakon'));
				  }
				}
			}		
      if($mode=='rubah'){
        $data['page'] =  $data['page']."_rubah";
				$keuangan = $this->m_umum->ambil_data('ol_user','id_user',$data['intstatus']);
				$data['id_user']  = set_value('id_user',$keuangan["id_user"]);
				$data['id_pegawai']  = set_value('id_pegawai',$keuangan["id_pegawai"]);
				$data['id_working']  = set_value('id_working',$keuangan["refer"]);
				$this->load->view("sa/isi",$data);
      }
      if($mode=='simpan_rubah'){    	
			  if($this->m_sa->refer()){
					$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
					redirect(base_url('sa/ol_lakon'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data');
					redirect(base_url('sa/ol_lakon'));
			  }
      }
			if($mode=='unit'){
			  $data['page'] =  $data['page']."_unit";	
				$data['unit'] = $this->m_sa->ambil_data_unit();
				$peg = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$data['intstatus']);	
				$kondisi_unit = array('id_pegawai'=>$data['intstatus']);
				$jml = $this->m_umum->jumlah_record_filter('ol_pegawai_unit',$kondisi_unit);
				$data['barcode_pegawai']  = set_value('barcode_pegawai',$peg['barcode_pegawai']);				
				if($jml == 0){
					$data['id_pegawai']  = set_value('id_pegawai',$this->input->post('id_pegawai'));
					$data['id_unit']  = set_value('id_unit',$this->input->post('id_unit'));
				}else{
					$take = $this->m_umum->ambil_data('ol_pegawai_unit','id_pegawai',$data['intstatus']);		
					$data['id_pegawai']  = set_value('id_pegawai',$take['id_pegawai']);
					$data['id_unit']  = set_value('id_unit',$take['id_unit']);
				}
				$this->load->view("sa/isi",$data);
			}
			if($mode=='simpan_unit'){
				$id_pegawai = $this->input->post('id_pegawai');
				$kondisi_unit = array('id_pegawai'=>$id_pegawai);
				$peg = $this->m_umum->ambil_data('ol_user','id_pegawai',$id_pegawai);
				$id_level = $peg['id_level'];
				$jml = $this->m_umum->jumlah_record_filter('ol_pegawai_unit',$kondisi_unit);
				if($id_level == 53){
					$this->m_sa->nonaktif_mhs_unit();
					$this->m_sa->simpan_mhs_unit();
				}
				if($jml == 0){
					if($this->m_sa->simpan_pegawai_unit()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('sa/ol_lakon'));
					}else{
						$this->session->set_flashdata('danger', 'Ada Masalah');
						redirect(base_url('sa/ol_lakon'));
					}
				}else{
					if($this->m_sa->edit_pegawai_unit()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('sa/ol_lakon'));
					}else{
						$this->session->set_flashdata('danger', 'Ada Masalah');
						redirect(base_url('sa/ol_lakon'));
					}
				}
			}
/*      if($mode=='unit'){
        $data['page'] =  $data['page']."_unit";
				$keuangan = $this->m_umum->ambil_data('ol_user','id_user',$data['intstatus']);
				$data['ambil_data_dropdown_unit']=$this->m_ol_rancak->ambil_data_dropdown_unit($keuangan["refer"]);
				$data['id_user']  = set_value('id_user',$keuangan["id_user"]);
				$data['id_pegawai']  = set_value('id_pegawai',$keuangan["id_pegawai"]);
				$data['id_unit']  = set_value('id_unit',$keuangan["unit"]);
				$this->load->view("sa/isi",$data);
      }
      if($mode=='simpan_unit'){    	
			  if($this->m_sa->unite()){
					$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
					redirect(base_url('sa/ol_lakon'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data');
					redirect(base_url('sa/ol_lakon'));
			  }
      }*/
      if($mode=='ms_kredensial'){
        $data['page'] =  $data['page']."_ms_kredensial";
				$keuangan = $this->m_umum->ambil_data('ol_user','id_user',$data['intstatus']);
				$data['cmd_jabatan']=$this->m_rancak->cmd_jabatan_null();
				$data['id_user']  = set_value('id_user',$keuangan["id_user"]);
				$data['id_pegawai']  = set_value('id_pegawai',$keuangan["id_pegawai"]);
				$data['mas_kred']  = set_value('mas_kred',$keuangan["mas_kred"]);
				$this->load->view("sa/isi",$data);
      }
      if($mode=='simpan_ms_kredensial'){    	
			  if($this->m_sa->simpan_ms_kred()){
					$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
					redirect(base_url('sa/ol_lakon'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data');
					redirect(base_url('sa/ol_lakon'));
			  }
      }
      if($mode=='ms_instansi'){
        $data['page'] =  $data['page']."_ms_instansi";
				$keuangan = $this->m_umum->ambil_data('ol_user','id_user',$data['intstatus']);
				$data['cmd_instansi']=$this->m_ol_rancak->ambil_rujukan_working_null_data();
				$data['id_user']  = set_value('id_user',$keuangan["id_user"]);
				$data['id_pegawai']  = set_value('id_pegawai',$keuangan["id_pegawai"]);
				$data['mas_ins']  = set_value('mas_ins',$keuangan["mas_ins"]);
				$this->load->view("sa/isi",$data);
      }
      if($mode=='simpan_ms_instansi'){    	
			  if($this->m_sa->simpan_ms_ins()){
					$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
					redirect(base_url('sa/ol_lakon'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data');
					redirect(base_url('sa/ol_lakon'));
			  }
      }
      if($mode=='ms_asesor'){
        $data['page'] =  $data['page']."_ms_asesor";
				$keuangan = $this->m_umum->ambil_data('ol_user','id_user',$data['intstatus']);
				$data['cmd_jabatan']=$this->m_rancak->cmd_jabatan_null();
				$data['id_user']  = set_value('id_user',$keuangan["id_user"]);
				$data['id_pegawai']  = set_value('id_pegawai',$keuangan["id_pegawai"]);
				$data['mas_asesor']  = set_value('mas_asesor',$keuangan["mas_asesor"]);
				$this->load->view("sa/isi",$data);
      }
      if($mode=='simpan_ms_asesor'){    	
			  if($this->m_sa->simpan_ms_asesor()){
					$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
					redirect(base_url('sa/ol_lakon'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data');
					redirect(base_url('sa/ol_lakon'));
			  }
      }
      if($mode=='ms_unit'){
        $data['page'] =  $data['page']."_ms_unit";
        $keuangan = $this->m_umum->ambil_data('ol_user','id_user',$data['intstatus']);
        $data['cmd_jabatan']=$this->m_rancak->ambil_unit_instansi();
        $data['id_user']  = set_value('id_user',$keuangan["id_user"]);
        $data['id_pegawai']  = set_value('id_pegawai',$keuangan["id_pegawai"]);
        $data['mas_unit']  = set_value('mas_unit',$keuangan["mas_unit"]);
        $this->load->view("sa/isi",$data);
      }
      if($mode=='simpan_ms_unit'){      
        if($this->m_sa->simpan_ms_unit()){
          $this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
          redirect(base_url('sa/ol_lakon'));
        }else{
          $this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data');
          redirect(base_url('sa/ol_lakon'));
        }
      }
		}
  }
  function whatsnew($mode='view')
  {
		$data['page']  = "whatsnew";
		$data['header'] = "WHATS NEW";
		$data['title'] = "WHATS NEW";
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
		$data['id']   = $this->uri->segment(4, 0);
	  if($mode=='view'){
			$this->tampil($data);
		}
	  else if($mode=='data'){
			echo json_encode($this->m_sa->whats());
		}
		else{
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$d = $this->m_umum->ambil_data('ol_whatsnew','id_whatsnew',$data['id']);
				$data['isi_whatsnew']  = set_value('isi_whatsnew',$d["isi_whatsnew"]);
				$this->form_validation->set_rules('isi_whatsnew','isi_whatsnew','required');
				if ($this->form_validation->run() === FALSE){
						   $this->tampil($data);
				}else{
					$this->m_sa->edit_whatsnew();
					$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
					redirect(base_url('sa/whatsnew'));
				}
	  	}
		}
  }
  function akses($mode='view')
  {
		$data['page']  = "akses";
		$data['header'] = "HAK AKSES TAMBAHAN";
		$data['title'] = "HAK AKSES TAMBAHAN";
		$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
		$program    = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
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
		$data['int']   = $this->uri->segment(5, 0);
		$data['id']   = $this->uri->segment(4, 0);
	  if($mode=='view'){
			$this->tampil($data);
		}
    else if($mode=='data'){
		echo json_encode($this->m_sa->hak_akses_all($data['id']));
	}
		else{
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
        $data['hak_akses'] = $this->m_rancak->hak_akses($data['id'],$program['akses']);
    		$this->load->view("sa/isi",$data);
      }
      if($mode=='simpan_tambah'){
    		$id_pegawai= $this->input->post('id_pegawai');
			  $this->m_sa->simpan_pegawai_akses();
				$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
				redirect(base_url('sa/akses/view/'.$id_pegawai));
      }
			if($mode=='status'){
					$pegakses = $this->m_umum->ambil_data('pegawai_akses','id_pegawai_akses',$data['int']);
				  if($this->m_sa->status_pegawai_akses($data['id'],$data['int'])){
						$this->session->set_flashdata('sukses', 'Sukses Rubah Status');
						redirect(base_url('sa/akses/view/'.$pegakses['id_pegawai']));	  	
				  }else{
						$this->session->set_flashdata('danger', 'Masalah Edit Data');
						redirect(base_url('sa/akses/view/'.$pegakses['id_pegawai']));
				  }
			}
		}
  }
  function ol_akses($mode='view')
  {
		$data['page']  = "ol_akses";
		$data['header'] = "HAK AKSES TAMBAHAN";
		$data['title'] = "HAK AKSES TAMBAHAN";
		$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
		$program    = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
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
		$data['int']   = $this->uri->segment(5, 0);
		$data['id']   = $this->uri->segment(4, 0);
	  if($mode=='view'){
			$this->tampil($data);
		}
    else if($mode=='data'){
		echo json_encode($this->m_sa->ol_hak_akses_all($data['id']));
		}
		else{
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
        $data['hak_akses'] = $this->m_rancak->hak_akses($data['id'],$program['akses']);
    		$this->load->view("sa/isi",$data);
      }
      if($mode=='simpan_tambah'){
    		$id_pegawai= $this->input->post('id_pegawai');
			  $this->m_sa->ol_simpan_pegawai_akses();
				$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
				redirect(base_url('sa/ol_akses/view/'.$id_pegawai));
      }
			if($mode=='status'){
					$pegakses = $this->m_umum->ambil_data('ol_akses','id_ol_akses',$data['int']);
				  if($this->m_sa->ol_status_pegawai_akses($data['id'],$data['int'])){
						$this->session->set_flashdata('sukses', 'Sukses Rubah Status');
						redirect(base_url('sa/ol_akses/view/'.$pegakses['id_pegawai']));	  	
				  }else{
						$this->session->set_flashdata('danger', 'Masalah Edit Data');
						redirect(base_url('sa/ol_akses/view/'.$pegakses['id_pegawai']));
				  }
			}
		}
  }
	function a_online($mode='view'){
		$data['page']="a_online"; 
		$data['header'] = "DATA ONLINE WEB";
		$data['title'] = "DATA ONLINE WEB";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
//		$program = $this->m_umum->ambil_data('a_program','id_program','30');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
/*		$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
		$propinsie = $this->m_umum->ambil_data('ol_pengcab','id_pengcab',$pegawai['id_pengcab']);
		$data['prov_id'] = $propinsie["id_prov"];
		$data['aran_jabatan'] = $jabatanekuh["nama_jabatan"];*/
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
		$data['cmd_status'] = $this->m_rancak->cmd_status();
//		$data['ambil_data_pengcab'] = $this->m_ol_rancak->ambil_data_pengcab($this->session->id_jabatan);
	  if($mode=='view'){
			$this->tampil($data);
		}
    else if($mode=='data'){
		echo json_encode($this->m_sa->a_online_all());
		}
		else{
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
        $data['kode_online']  = set_value('kode_online',$this->input->post('kode_online'));
        $data['nama_menu']  = set_value('nama_menu',$this->input->post('nama_menu'));
        $data['status_online']  = set_value('status_online',$this->input->post('status_online'));
        $data['menu']  = set_value('menu',$this->input->post('menu'));
        $data['kunci']  = set_value('kunci',$this->input->post('kunci'));
    		$this->load->view("sa/isi",$data);
      }
      if($mode=='simpan_tambah'){
    		$kode_online= $this->input->post('kode_online');
  			$kondisi=array('kode_online'=>$kode_online);
  			$jml = $this->m_umum->jumlah_record_filter('a_online',$kondisi);
  			if($jml == 0){
				  $this->m_sa->simpan_a_online();
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('sa/a_online'));
  			}else{
					$this->session->set_flashdata('danger', 'Data Sudah Ada');
					redirect(base_url('sa/a_online'));
  			}
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$inst = $this->m_umum->ambil_data('a_online','id_kode_online',$data['id']);
        $data['kode_online']  = set_value('kode_online',$inst['kode_online']);
        $data['nama_menu']  = set_value('nama_menu',$inst['nama_menu']);
        $data['status_online']  = set_value('status_online',$inst['status_online']);
        $data['menu']  = set_value('menu',$inst['menu']);
        $data['kunci']  = set_value('kunci',$inst['kunci']);
    		$this->load->view("sa/isi",$data);
      }
      if($mode=='simpan_edit'){
    		$kode_online= $this->input->post('kode_online');
    		$kode_online_lama= $this->input->post('kode_online_lama');
  			$kondisi=array('kode_online'=>$kode_online,'kode_online !='=>$kode_online_lama);
  			$jml = $this->m_umum->jumlah_record_filter('a_online',$kondisi);
  			if($jml == 0){
				  $this->m_sa->edit_a_online();
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('sa/a_online'));
  			}else{
					$this->session->set_flashdata('danger', 'Data Sudah Ada');
					redirect(base_url('sa/a_online'));
  			}
      }
		}
	}
	function enabled($mode='view'){
		$data['page']="enabled"; 
		$data['header'] = "DATA ENABLE / DISABLE WEB";
		$data['title'] = "DATA ENABLE / DISABLE WEB";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
//		$program = $this->m_umum->ambil_data('a_program','id_program','30');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
/*		$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
		$propinsie = $this->m_umum->ambil_data('ol_pengcab','id_pengcab',$pegawai['id_pengcab']);
		$data['prov_id'] = $propinsie["id_prov"];
		$data['aran_jabatan'] = $jabatanekuh["nama_jabatan"];*/
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
		$data['id_kode_online']   = $this->uri->segment(4, 0);
		$data['id_jabatan']   = $this->uri->segment(5, 0);
		$data['id_instansi']   = $this->uri->segment(6, 0);
		$data['id']   = $this->uri->segment(7, 0);		
		$data['ambil_data_a_online_null'] = $this->m_rancak->ambil_data_a_online_null();
		$data['ambil_data_a_online_no_null'] = $this->m_rancak->ambil_data_a_online_no_null();
		$data['cmd_jabatan_null'] = $this->m_rancak->cmd_jabatan_null();
		$data['ambil_instansi'] = $this->m_umum->ambil_data('kol_working');
		$data['cmd_status'] = $this->m_rancak->cmd_status();
			if($data['id'] == NULL OR empty($data['id'])){
				$data['id'] = "";
			}
	  if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$id_kode_online = $this->input->post('id_kode_online');
				$id_jabatan = $this->input->post('id_jabatan');
				$id_instansi = $this->input->post('id_instansi');
	      $trim_keyword   = urldecode(trim($this->input->post("id")));
				$replace_keyword   = preg_replace('/\s+/', ' ', $trim_keyword);
				$key = str_replace(' ', '-', $replace_keyword);
				redirect(base_url('sa/enabled/view/'.$id_kode_online.'/'.$id_jabatan.'/'.$id_instansi.'/'.$key));
			}
		}
    else if($mode=='data'){
			echo json_encode($this->m_sa->a_enabled_all($data['id_kode_online'],$data['id_jabatan'],$data['id_instansi'],$data['id']));
		}
		else{
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$inst = $this->m_umum->ambil_data('a_ol_enabled','id_ol_enabled',$data['id_kode_online']);
        $data['id_kode_onlines']  = set_value('id_kode_onlines',$inst['id_kode_online']);
        $data['enabled']  = set_value('enabled',$inst['enabled']);
        $data['id_pegawai']  = set_value('id_pegawai',$inst['id_pegawai']);
        $data['status_ol_enabled']  = set_value('status_ol_enabled',$inst['status_ol_enabled']);
    		$this->load->view("sa/isi",$data);
      }
      if($mode=='simpan_edit'){
    		$id_kode_online_lama= $this->input->post('id_kode_online_lama');
    		$id_kode_online= $this->input->post('id_kode_online');
    		$id_pegawai= $this->input->post('id_pegawai');
  			$kondisi=array('id_kode_online'=>$id_kode_online,'id_kode_online !='=>$id_kode_online_lama,'id_pegawai'=>$id_pegawai);
  			$jml = $this->m_umum->jumlah_record_filter('a_ol_enabled',$kondisi);
  			if($jml == 0){
				  $this->m_sa->edit_a_ol_enabled();
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
					redirect(base_url('sa/enabled'));
  			}else{
					$this->session->set_flashdata('danger', 'Data Sudah Ada');
					redirect(base_url('sa/enabled'));
  			}
      }
		}
	}
	function pengurus_enabled($mode='view'){
		$data['page']="pengurus_enabled"; 
		$data['header'] = "DATA ENABLE / DISABLE PENGURUS";
		$data['title'] = "DATA ENABLE / DISABLE PENGURUS";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','5');
		$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
/*		$propinsie = $this->m_umum->ambil_data('ol_pengcab','id_pengcab',$pegawai['id_pengcab']);
		$data['prov_id'] = $propinsie["id_prov"];*/
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
		$data['id_kode_online']   = $this->uri->segment(4, 0);
		$data['id_pengcab']   = $this->uri->segment(5, 0);
		$data['id_ms_pengurus']   = $this->uri->segment(6, 0);
		$data['ambil_data_a_online_no_null'] = $this->m_rancak->ambil_data_a_online_no_null();
		$data['ambil_pengurus'] = $this->m_ol_rancak->ambil_data_ms_pengurus_untuk_sa($data['id_pengcab'],$data['id_ms_pengurus']);
		$data['ambil_pengcab'] = $this->m_umum->ambil_data('ol_pengcab');
		$data['ambil_ms_pengurus'] = $this->m_umum->ambil_data('kol_ms_pengurus');
	  if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			$id_kode_online = $this->input->post('id_kode_online');
			$id_pengcab = $this->input->post('id_pengcab');
			$id_ms_pengurus = $this->input->post('id_ms_pengurus');			
			if($action == 'BtnProses') {
				redirect(base_url('sa/pengurus_enabled/view/'.$id_kode_online.'/'.$id_pengcab.'/'.$id_ms_pengurus));
			}
			if($action == 'BtnSimpan') {
				$this->m_sa->simpan_a_ol_enabled();
				$this->session->set_flashdata('sukses', 'Data Sudah Di Tambah & Data Dobel Tidak Di Tambah');
				redirect(base_url('sa/enabled'));
			}
		}
		else{
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
        $data['kode_online']  = set_value('kode_online',$this->input->post('kode_online'));
        $data['nama_menu']  = set_value('nama_menu',$this->input->post('nama_menu'));
        $data['status_online']  = set_value('status_online',$this->input->post('status_online'));
        $data['menu']  = set_value('menu',$this->input->post('menu'));
        $data['kunci']  = set_value('kunci',$this->input->post('kunci'));
    		$this->load->view("sa/isi",$data);
      }
      if($mode=='simpan_tambah'){
    		$kode_online= $this->input->post('kode_online');
  			$kondisi=array('kode_online'=>$kode_online);
  			$jml = $this->m_umum->jumlah_record_filter('a_online',$kondisi);
  			if($jml == 0){
				  $this->m_sa->simpan_a_online();
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('sa/a_online'));
  			}else{
					$this->session->set_flashdata('danger', 'Data Sudah Ada');
					redirect(base_url('sa/a_online'));
  			}
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$inst = $this->m_umum->ambil_data('a_online','kode_online',$data['id']);
        $data['kode_online']  = set_value('kode_online',$inst['kode_online']);
        $data['nama_menu']  = set_value('nama_menu',$inst['nama_menu']);
        $data['status_online']  = set_value('status_online',$inst['status_online']);
        $data['menu']  = set_value('menu',$inst['menu']);
        $data['kunci']  = set_value('kunci',$inst['kunci']);
    		$this->load->view("sa/isi",$data);
      }
      if($mode=='simpan_edit'){
    		$kode_online= $this->input->post('kode_online');
    		$kode_online_lama= $this->input->post('kode_online_lama');
  			$kondisi=array('kode_online'=>$kode_online,'kode_online !='=>$kode_online_lama);
  			$jml = $this->m_umum->jumlah_record_filter('a_online',$kondisi);
  			if($jml == 0){
				  $this->m_sa->edit_a_online();
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('sa/a_online'));
  			}else{
					$this->session->set_flashdata('danger', 'Data Sudah Ada');
					redirect(base_url('sa/a_online'));
  			}
      }
		}
	}
	function instansi_enabled($mode='view'){
		$data['page']="instansi_enabled"; 
		$data['header'] = "DATA ENABLE / DISABLE INSTANSI";
		$data['title'] = "DATA ENABLE / DISABLE INSTANSI";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
//		$program = $this->m_umum->ambil_data('a_program','id_program','30');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','5');
/*		$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
		$propinsie = $this->m_umum->ambil_data('ol_pengcab','id_pengcab',$pegawai['id_pengcab']);
		$data['prov_id'] = $propinsie["id_prov"];
		$data['aran_jabatan'] = $jabatanekuh["nama_jabatan"];*/
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
		$data['id_kode_online']   = $this->uri->segment(4, 0);
		$data['id_instansi']   = $this->uri->segment(5, 0);
		$data['id_jabatan']   = $this->uri->segment(6, 0);
		$data['ambil_data_a_online_no_null'] = $this->m_rancak->ambil_data_a_online_no_null();
		$data['cmd_jabatan_null'] = $this->m_rancak->cmd_jabatan_null();
		$data['ambil_pengurus'] = $this->m_ol_rancak->ambil_data_instansi_untuk_sa($data['id_instansi'],$data['id_jabatan']);
		$data['ambil_instansi'] = $this->m_umum->ambil_data('kol_working');
	  if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			$id_kode_online = $this->input->post('id_kode_online');
			$id_instansi = $this->input->post('id_instansi');			
			$id_jabatan = $this->input->post('id_jabatan');			
			if($action == 'BtnProses') {
				redirect(base_url('sa/instansi_enabled/view/'.$id_kode_online.'/'.$id_instansi.'/'.$id_jabatan));
			}
			if($action == 'BtnSimpan') {
				$this->m_sa->simpan_a_ol_enabled();
				$this->session->set_flashdata('sukses', 'Data Sudah Di Tambah & Data Dobel Tidak Di Tambah');
				redirect(base_url('sa/enabled'));
			}
		}
	}
  function status_bayar($mode='view')
  {
		$data['page']  = "status_bayar";
		$data['header'] = "STATUS PEMBAYARAN PENGAJUAN KOMPETENSI";
		$data['title'] = "STATUS PEMBAYARAN PENGAJUAN KOMPETENSI";
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
		$data['id']   = $this->uri->segment(4, 0);
		if($data['id'] == NULL OR empty($data['id'])){
			$data['id'] = "";
		}		
		if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
	      $id   = $this->input->post("id");
	      $trim_keyword   = urldecode(trim($this->input->post("id")));
				$replace_keyword   = preg_replace('/\s+/', ' ', $trim_keyword);
				$key = str_replace(' ', '-', $replace_keyword);
				redirect(base_url('sa/status_bayar/view/'.$key));
			}
		}
	  else if($mode=='data'){
			echo json_encode($this->m_sa->pengajuan_kompetensi_all($data['id']));
		}
		else{
      if($mode=='bayar'){
  				$this->m_sa->edit_status_bayar($data['id']);
  				$this->m_umum->hapus_data('ol_pengajuan_temp','barcode_pengajuan',$data['id']);
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('sa/status_bayar'));
      }
		}
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
  function jabfung_data($id)
  {
    if($id < 3){
      $ids = '1';
    }else{
      $ids = '3';
    }
    $dt=$this->m_ol_rancak->ambil_data_dropdown_jabfung_aktifasi($ids);
    echo json_encode($dt);
  }
  function unite_data($id)
  {
    $dt=$this->m_ol_rancak->ambil_data_dropdown_unit_null($id);
    echo json_encode($dt);
  }
	function aktifasi($mode='view'){
		$data['page']="aktifasi"; 
		$data['header'] = "DATA REGISTRASI USER NAKES LAINNYA";
		$data['title'] = "DATA REGISTRASI USER NAKES LAINNYA";
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
		//======================= IMPORTANT =========================================
		$data['id']   = $this->uri->segment(4, 0);
		if($data['id'] == NULL OR empty($data['id'])){
			$data['id'] = "";
		}
		if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
	      $id   = $this->input->post("id");
	      $trim_keyword   = urldecode(trim($this->input->post("id")));
				$replace_keyword   = preg_replace('/\s+/', ' ', $trim_keyword);
				$key = str_replace(' ', '-', $replace_keyword);
				redirect(base_url('sa/aktifasi/view/'.$key));
			}
		}
		else if($mode=='data'){
			echo json_encode($this->m_sa->registrasi_all($data['id']));
		}
  else if($mode=='hapus'){
  		$this->m_umum->hapus_data('ol_registrasi','barcode_registrasi',$data['id']);
    	redirect(base_url('sa/aktifasi'));
  }
		else{
			$data['cmd_instansi'] = $this->m_ol_rancak->ambil_instansi_no_null();
			$data['opsi_status_perawat'] = $this->m_ol_rancak->status_perawat();
		//	$data['kol_kode_kewenangan_null'] = $this->m_ol_rancak->kol_kode_kewenangan_null();
			$data['cmd_tipe_pegawai'] = $this->m_ol_rancak->cmd_tipe_pegawai();
			$data['cmd_jabfung'] = $this->m_ol_rancak->cmd_jabfung();
			$data['status'] = $this->m_rancak->cmd_status();
			$data['gender'] = $this->m_rancak->cmd_jk();
			$data['ambil_data_rujukan_instansi'] = $this->m_ol_rancak->ambil_data_rujukan_working();
			$data['ambil_data_rujukan_working_null'] = $this->m_ol_rancak->ambil_data_rujukan_no_null();
			$data['cmd_unit_null'] = $this->m_rancak->struktur_jabatan_as_unit();
			$data['cmd_agama'] = $this->m_rancak->cmd_agama();
			$data['cmd_status_kawin'] = $this->m_rancak->cmd_status_kawin();
			$data['cmd_pendidikan'] = $this->m_rancak->cmd_pendidikan();
			$data['cmd_level'] = $this->m_sa->cmd_level();
			$data['kol_provinsi'] = $this->m_rancak->cmd_kol_provinsi();
			if($mode=='tambah'){
				$data['page'] =  $data['page']."_tambah";
					$take = $this->m_sa->ambil_registrasi($data['id']);
					$data['id_instansi']  = set_value('id_instansi',$take['id_instansi']);
					$data['ambil_data_dropdown_unit']=$this->m_ol_rancak->ambil_data_dropdown_unit_no_null($take['id_instansi']);					
					$data['status_registrasi']  = set_value('status_registrasi',$take['status_registrasi']);
					$data['nama_pegawai']  = set_value('nama_pegawai',$take['nama_pegawai']);
					$data['jk']  = set_value('jk',$take['jk']);
					$data['tmp_lahir']  = set_value('tmp_lahir',$take['tmp_lahir']);
					$data['tgl_lahir']  = set_value('tgl_lahir',date('d-m-Y', strtotime($take['tgl_lahir'])));
					$data['email']  = set_value('email',$take['email']);
					$data['no_hp']  = set_value('no_hp',$take['no_hp']);		
					$data['nik']  = set_value('nik',$take['nik']);			
					$data['id_status_kawin']  = set_value('id_status_kawin',$take['id_status_kawin']);
					$data['id_agama']  = set_value('id_agama',$take['id_agama']);
					$data['id_pendidikan']  = set_value('id_pendidikan',$take['id_pendidikan']);
					$data['id_jabatan_fungsional']  = set_value('id_jabatan_fungsional',$take['id_jabatan_fungsional']);
					$data['alamat']  = set_value('alamat',$take['alamat']);
					$data['tipe_pegawai']  = set_value('tipe_pegawai',$take['tipe_pegawai']);
					$data['nip']  = set_value('nip',$take['nip']);
					$data['username']  = set_value('username',$take['username']);
					$data['nama_instansi']  = set_value('nama_instansi',$take['nama_instansi']);
					$data['alamat_instansi']  = set_value('alamat_instansi',$take['alamat_instansi']);
					$data['nama_unit']  = set_value('nama_unit',$take['nama_unit']);
					$data['atasan_unit']  = set_value('atasan_unit',$take['atasan_unit']);
					$tjabatan = $this->m_umum->ambil_data('jabatan_fungsional','id_jabatan_fungsional',$take['id_jabatan_fungsional']);
					$data['id_level']  = set_value('id_level',$this->input->post("id_level"));
					$data['id_unit']  = set_value('id_unit',$this->input->post("id_unit"));
					$this->form_validation->set_rules('nama_pegawai','nama_pegawai','required');
				if ($this->form_validation->run() === FALSE){
					$this->tampil($data);
				}else{
					$ptn = "/^0/";  // Regex
					$str = $this->input->post('no_hp'); 
					$nik = $this->input->post('nik');
					$id_level = $this->input->post('id_level');
					$id_instansi = $this->input->post('id_instansi');
					$rpltxt = "62";  // Replacement string
					$no_hp = preg_replace($ptn, $rpltxt, $str);
					$barcode_registrasi = $this->input->post('barcode_registrasi');
					$username= $this->input->post('username');
					$username = strtolower($username);
					$username = str_replace(' ', '-', $username);
					$username = preg_replace('/[^A-Za-z0-9\-]/', '', $username);
					$kondisi=array('username'=>$username);
					$jml = $this->m_umum->jumlah_record_filter('ol_user',$kondisi);
					$kondisi2=array('nik'=>$nik);
					$jml2 = $this->m_umum->jumlah_record_filter('ol_pegawai',$kondisi2);
						if($jml == 0){
							if($jml2 == 0){
								if($Q = $this->m_sa->simpan_aktifasi()){
									$this->m_sa->simpan_user($Q);
									$this->m_sa->simpan_pegawai_unit_user($Q);
									if($id_instansi > 0){
										$this->m_sa->simpan_instansi($Q);
									}
									if($id_level == 53){
										$this->m_sa->simpan_mhs_unit_user($Q);
									}
									$this->m_umum->hapus_data('ol_registrasi','barcode_registrasi',$barcode_registrasi);

									$wagw = $this->m_umum->ambil_data('a_wageblast','id_wageblast',1);
									$d = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$Q);
									$us = $this->m_umum->ambil_data('ol_user','id_pegawai',$Q);
									$logine = base_url('masuk');
									$token = $wagw['token'];
									$target = $d['no_hp'];
									$nama_pegawai = $d['nama_pegawai'];
				  				$tansi = $this->m_umum->ambil_data('a_instansi','id_instansi',$temp['id_instansi']);
				  				$instance_name = $tansi["nama_instansi"];
									$tgl_lahir = $this->m_rancak->fullBulan(date('d-m-Y', strtotime($d['tgl_lahir'])));
									$br = "\n";
									$message = "*".$instance_name."*";
									$message .= $br. $br."*AKUN KREDENSIAL.COM TELAH AKTIF*";
									$message .= $br."📜 *INI ADALAH KONFIRMASI SATU ARAH MOHON JANGAN BALAS DISINI*";
									$message .= $br. "Nama : " . $d['nama_pegawai'];
									$message .= $br. "TTL : " . $d['tmp_lahir'] .", ". $tgl_lahir;
									$message .= $br. "No KTP : " . $d['nik'];
									$message .= $br. "NIP : " . $d['nip'];
									$message .= $br. "No HP : " . $d['no_hp'];
									$message .= $br. "E-mail : " . $d['email'];
									$message .= $br. "Username : " . $us['username'];
									$message .= $br. "Password : 7654321";
									$message .= $br. $br."KREDENSIAL LOGIN : ";
									$message .= $br. $logine;
									$this->m_umum->kirim_fonte_text($token,$target,$message);

									$this->session->set_flashdata('sukses', 'Data berhasil Di Tambah');
									redirect(base_url('sa/aktifasi'));
								}else{
									$this->session->set_flashdata('danger', 'Ada Masalah Edit Data');
									redirect(base_url('sa/aktifasi'));
								}
							}else{
							  $this->session->set_flashdata('danger', 'No KTP Sudah Ada');
							  redirect(base_url('sa/aktifasi'));
							}
						}
						else{
							$this->session->set_flashdata('danger', 'Username Sudah Ada');
							redirect(base_url('sa/aktifasi'));
						}
				}
			}
		}
	}
	function pengajuan($mode='view'){
		$data['page']="pengajuan"; 
		$data['header'] = "DATA PENGAJUAN KOMPETENSI TEMP";
		$data['title'] = "DATA PENGAJUAN KOMPETENSI TEMP";
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
		//======================= IMPORTANT =========================================
		$data['id']   = $this->uri->segment(4, 0);
		if($data['id'] == NULL OR empty($data['id'])){
			$data['id'] = "";
		}
		if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
	      $id   = $this->input->post("id");
	      $trim_keyword   = urldecode(trim($this->input->post("id")));
				$replace_keyword   = preg_replace('/\s+/', ' ', $trim_keyword);
				$key = str_replace(' ', '-', $replace_keyword);
				redirect(base_url('sa/pengajuan/view/'.$key));
			}
		}
		else if($mode=='data'){
			echo json_encode($this->m_sa->pengajuan_kompetensi_aktif($data['id']));
		}
		else{
			$data['cmd_instansi'] = $this->m_ol_rancak->ambil_data_rujukan_working();
			$data['status_diusulkan_all']  = $this->m_ol_rancak->status_diusulkan_all();
			if($mode=='aktifasi'){
				$data['page'] =  $data['page']."_aktifasi";
					$take = $this->m_sa->ambil_pengajuan_temp($data['id']);
					$data['ambil_data_dropdown_unit']=$this->m_ol_rancak->ambil_data_dropdown_unit_no_null($take['id_instansi']);	
					$data['barcode_pegawai']  = set_value('barcode_pegawai',$take['barcode_pegawai']);			
					$data['barcode_pengajuan_temp']  = set_value('barcode_pengajuan_temp',$take['barcode_pengajuan_temp']);			
					$data['status_pengajuan_temp']  = set_value('status_pengajuan_temp',$take['status_pengajuan_temp']);
					$data['nama_pegawai']  = set_value('nama_pegawai',$take['nama_pegawai']);
					$data['id_unit']  = set_value('id_unit',$take['unit']);
					$data['tgl_pengajuan']  = set_value('tgl_pengajuan',date('d-m-Y', strtotime($take['tgl_pengajuan'])));
					$data['email']  = set_value('email',$take['email']);
					$data['no_hp']  = set_value('no_hp',$take['no_hp']);		
					$data['nik']  = set_value('nik',$take['nik']);			
					$data['nip']  = set_value('nip',$take['nip']);			
					$data['alamat']  = set_value('alamat',$take['alamat']);			
					$data['id_instansi']  = set_value('id_instansi',$take['id_instansi']);
					$data['id_status_diusulkan']  = set_value('id_status_diusulkan',$take['id_status_diusulkan']);
					$data['nominal_pengajuan']  = set_value('nominal_pengajuan',$this->input->post("nominal_pengajuan"));
					$data['struk_pengajuan_temp']  = set_value('struk_pengajuan_temp',$this->input->post("struk_pengajuan_temp"));
					$this->form_validation->set_rules('barcode_pengajuan_temp','barcode_pengajuan_temp','required');
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
								$uploadPath = 'assets/berkas/struk/';
								$config['upload_path'] = $uploadPath;
								$config['allowed_types'] = 'gif|jpg|jpeg|png';
								$config['encrypt_name'] = TRUE;
								$this->load->library('upload', $config);
								$this->upload->initialize($config);
		    				if($this->upload->do_upload('upload_File')){
									$barcode_pengajuan_temp = $this->input->post('barcode_pengajuan_temp');
									$user_pic=$this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan_temp',$barcode_pengajuan_temp);
									$cek_file=FCPATH.'assets/berkas/struk/'.$user_pic['struk_pengajuan'];
									if(file_exists($cek_file)){
										unlink(FCPATH."assets/berkas/struk/".$user_pic['struk_pengajuan']);
									}
		    					$fileData = $this->upload->data();
									$this->m_sa->simpan_pengajuan_kompetensi($fileData['file_name']);
									$this->m_sa->edit_pengajuan_temp($fileData['file_name']);
		    					$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
		    					redirect(base_url('sa/pengajuan'));
		    				}else{
		    					$nole = '';
									$this->m_sa->simpan_pengajuan_kompetensi($nole);
									$this->m_sa->edit_pengajuan_temp($nole);
		    					$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
		    					redirect(base_url('sa/pengajuan'));
		    				}
							}
					}
			}
		}
	}
	function struk($mode='view'){
		$data['page']="struk"; 
		$data['header'] = "DATA PENGAJUAN KOMPETENSI";
		$data['title'] = "DATA PENGAJUAN KOMPETENSI";
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
		//======================= IMPORTANT =========================================
		$data['id']   = $this->uri->segment(4, 0);
		if($data['id'] == NULL OR empty($data['id'])){
			$data['id'] = "";
		}
		if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
	      $id   = $this->input->post("id");
	      $trim_keyword   = urldecode(trim($this->input->post("id")));
				$replace_keyword   = preg_replace('/\s+/', ' ', $trim_keyword);
				$key = str_replace(' ', '-', $replace_keyword);
				redirect(base_url('sa/struk/view/'.$key));
			}
		}
		else if($mode=='data'){
			echo json_encode($this->m_sa->pengajuan_kompetensi_asli($data['id']));
		}
		else{
			$data['cmd_instansi'] = $this->m_ol_rancak->ambil_data_rujukan_working();
			$data['status_diusulkan_all']  = $this->m_ol_rancak->status_diusulkan_all();
			if($mode=='upload'){
				$data['page'] =  $data['page']."_upload";
					$take = $this->m_sa->ambil_pengajuan_asli($data['id']);
					$data['ambil_data_dropdown_unit']=$this->m_ol_rancak->ambil_data_dropdown_unit_no_null($take['id_instansi']);	
					$data['barcode_pegawai']  = set_value('barcode_pegawai',$take['barcode_pegawai']);			
					$data['id_pengajuan']  = set_value('id_pengajuan',$take['id_pengajuan']);			
					$data['barcode_pengajuan_temp']  = set_value('barcode_pengajuan_temp',$take['barcode_pengajuan_temp']);			
					$data['nama_pegawai']  = set_value('nama_pegawai',$take['nama_pegawai']);
					$data['nominal_pengajuan']  = set_value('nominal_pengajuan',number_format($take['nominal_pengajuan']));
					$data['id_unit']  = set_value('id_unit',$take['unit']);
					$data['tgl_pengajuan']  = set_value('tgl_pengajuan',date('d-m-Y', strtotime($take['tgl_pengajuan'])));
					$data['email']  = set_value('email',$take['email']);
					$data['no_hp']  = set_value('no_hp',$take['no_hp']);		
					$data['nik']  = set_value('nik',$take['nik']);			
					$data['nip']  = set_value('nip',$take['nip']);			
					$data['alamat']  = set_value('alamat',$take['alamat']);			
					$data['id_instansi']  = set_value('id_instansi',$take['id_instansi']);
					$data['id_status_diusulkan']  = set_value('id_status_diusulkan',$take['id_status_diusulkan']);
					$data['struk_pengajuan']  = set_value('struk_pengajuan_temp',$this->input->post("struk_pengajuan"));
					$this->form_validation->set_rules('id_pengajuan','id_pengajuan','required');
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
								$uploadPath = 'assets/berkas/struk/';
								$config['upload_path'] = $uploadPath;
								$config['allowed_types'] = 'gif|jpg|jpeg|png';
								$config['encrypt_name'] = TRUE;
								$this->load->library('upload', $config);
								$this->upload->initialize($config);
		    				if($this->upload->do_upload('upload_File')){
									$id_pengajuan = $this->input->post('id_pengajuan');
									$user_pic=$this->m_umum->ambil_data('ol_pengajuan','id_pengajuan',$id_pengajuan);
									$cek_file=FCPATH.'assets/berkas/struk/'.$user_pic['struk_pengajuan'];
									if(file_exists($cek_file)){
										unlink(FCPATH."assets/berkas/struk/".$user_pic['struk_pengajuan']);
									}
		    					$fileData = $this->upload->data();
									$this->m_sa->edit_pengajuan_kompetensi($fileData['file_name']);
									$this->m_sa->edit_pengajuan_temp($fileData['file_name']);
		    					$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
		    					redirect(base_url('sa/struk'));
		    				}else{
		    					$nole = '';
									$this->m_sa->edit_pengajuan_kompetensi($nole);
									$this->m_sa->edit_pengajuan_temp($nole);
		    					$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
		    					redirect(base_url('sa/struk'));
		    				}
							}
					}
			}
		}
	}
 function kop($mode='view'){
  $data['page']="kop"; 
  $data['header'] = "DATA GAMBAR KOP";
  $data['title'] = "DATA GAMBAR KOP";
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
  //======================= IMPORTANT =========================================
  $data['id']   = $this->uri->segment(4, 0);
  $data['id2']   = $this->uri->segment(5, 0);
  if($mode=='view'){
   $this->tampil($data);
  }
  else if($mode=='data'){
   echo json_encode($this->m_sa->kop_all());
  }
  else if($mode=='hapus'){
   if($this->m_umum->hapus_data('kol_gambar','id_gambar',$data['id'])){
     $cek_file=FCPATH.'assets/berkas/kop/'.$data['id2'];
     if(file_exists($cek_file)){
      unlink(FCPATH."assets/berkas/kop/".$data['id2']);
     }
    $this->session->set_flashdata('sukses', 'Data berhasil Di Hapus');
    redirect(base_url('sa/kop'));
   }else{
    $this->session->set_flashdata('danger', 'Ada Masalah Hapus Data');
    redirect(base_url('sa/kop'));
   }
  }
  else{
   $data['cmd_instansi'] = $this->m_ol_rancak->ambil_data_rujukan_no_null();
   $data['cmd_kategori_gambar']  = $this->m_ol_rancak->ambil_kategori_gambar();
   $data['cmd_status']  = $this->m_rancak->cmd_status();
   if($mode=='tambah'){
    $data['page'] =  $data['page']."_tambah";
     $data['nama_gambar']  = set_value('nama_gambar',$this->input->post("nama_gambar"));
     $data['id_kategori_gambar']  = set_value('id_kategori_gambar',$this->input->post("id_kategori_gambar"));
     $data['id_instansi']  = set_value('id_instansi',$this->input->post("id_instansi"));
     $data['status_gambar']  = set_value('status_gambar',$this->input->post("status_gambar"));
     $this->form_validation->set_rules('nama_gambar','nama_gambar','required');
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
        $uploadPath = 'assets/berkas/kop/';
        $config['upload_path'] = $uploadPath;
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if($this->upload->do_upload('upload_File')){
         $fileData = $this->upload->data();
         $this->m_sa->simpan_kol_gambar($fileData['file_name']);
        }
        $this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
        redirect(base_url('sa/kop'));
/*          if($this->upload->do_upload('upload_File')){
         $id_pengajuan = $this->input->post('id_pengajuan');
         $user_pic=$this->m_umum->ambil_data('ol_pengajuan','id_pengajuan',$id_pengajuan);
         $cek_file=FCPATH.'assets/berkas/struk/'.$user_pic['struk_pengajuan'];
         if(file_exists($cek_file)){
          unlink(FCPATH."assets/berkas/struk/".$user_pic['struk_pengajuan']);
         }
           $fileData = $this->upload->data();
         $this->m_sa->edit_pengajuan_kompetensi($fileData['file_name']);
         $this->m_sa->edit_pengajuan_temp($fileData['file_name']);
           $this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
           redirect(base_url('sa/struk'));
          }else{
           $nole = '';
         $this->m_sa->edit_pengajuan_kompetensi($nole);
         $this->m_sa->edit_pengajuan_temp($nole);
           $this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
           redirect(base_url('sa/struk'));
          }*/
       }
     }
   }
  }
 }
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("sa/header",$data);
	$this->load->view("sa/isi");
	$this->load->view("footer");
	$this->load->view("sa/jsload");
	$this->load->view("sa/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_top",$data);
	$this->load->view("sa/isi");
	$this->load->view("footer");
	$this->load->view("sa/jsload");
	$this->load->view("sa/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
