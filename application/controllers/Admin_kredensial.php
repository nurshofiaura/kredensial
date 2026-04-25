<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Admin_kredensial extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
    parent::__construct();
		$this->load->model('m_ol_rancak');
		$this->load->model('m_admin_kredensial');
    $this->load->model('m_auth');
    $this->m_auth->login_kah();
  }
  function index(){
    $data['page']="home";
		$data['header'] = "BERANDA";
		$data['title'] = "BERANDA";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
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
	//======================= IMPORTANT =========================================
    $this->tampil($data);
  }
  function form1($mode='view')
  {
		$data['page']  = "form1";
		$data['header'] = "INPUT FORM 1 UNTUK MENGAKTIFKAN SAAT PENGUJIAN KOMPETENSI";
		$data['title'] = "INPUT FORM 1 UNTUK MENGAKTIFKAN SAAT PENGUJIAN KOMPETENSI - FORM PERMOHONAN";
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
		$data['id']   = $this->uri->segment(4, 0);
  $data['id2']   = $this->uri->segment(5, 0);
		if($mode=='view'){
			$this->tampil($data);
		}
  else if($mode=='hapus_form'){
    $kondisi=array('pembuat_form'=>$this->session->id_pegawai,'id_form'=>$data['id']);
    $jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
    $kondisi2=array('barcode_form'=>$data['id2']);
    $jml2 = $this->m_umum->jumlah_record_filter('nkr_form_detil',$kondisi2);
    if($jml == 0){
        $this->session->set_flashdata('danger', 'Hanya Dapat Menghapus Data Sendiri');
        redirect(base_url('admin_kredensial/'.$data['page']));
    }else{
//      if($jml2 == 0){
        if($this->m_umum->hapus_data('nkr_form','id_form',$data['id'])){
            $this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
            redirect(base_url('admin_kredensial/'.$data['page']));
          }else{
            $this->session->set_flashdata('danger', 'Masalah Hapus Data');
            redirect(base_url('admin_kredensial/'.$data['page']));
          }
/*      }else{
        $this->session->set_flashdata('danger', 'Hapus Dahulu Data Di Dalamnya');
        redirect(base_url('admin_kredensial/'.$data['page']));        
      }*/
    }
  }
    else if($mode=='data'){
			echo json_encode($this->m_admin_kredensial->form_all(1));
		}
		else{
			$data['working']=$this->m_admin_kredensial->ambil_data_rujukan_working();
			$data['status']=$this->m_rancak->cmd_status();
			$data['cmd_kompetensi_in']=$this->m_admin_kredensial->cmd_kompetensi_in($this->session->mas_kred);
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['id_kompetensi']  = set_value('id_kompetensi',$this->input->post('id_kompetensi'));
				$data['id_instansi']  = set_value('id_instansi',$this->input->post('id_instansi'));
				$data['nama_form']  = set_value('nama_form',$this->input->post('nama_form'));
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_tambah'){
      	$id_jenis_form = $this->input->post('id_jenis_form');
      	$id_kompetensi = $this->input->post('id_kompetensi');
      	$id_instansi = $this->input->post('id_instansi');
		 		$kondisi=array('id_instansi'=>$id_instansi,'id_kompetensi'=>$id_kompetensi,'id_jenis_form'=>$id_jenis_form,'status_form'=>1,'pembuat_form'=>$this->session->id_pegawai);
				$jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
//				if($jml == 0){
				  if($this->m_admin_kredensial->simpan_nkr_form()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('admin_kredensial/form1'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
						redirect(base_url('admin_kredensial/form1'));
				  }
/*				}else{
					$this->session->set_flashdata('danger', 'Data Sudah Ada');
					redirect(base_url('admin_kredensial/form1'));				
				}*/
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('nkr_form','id_form',$data['id']);
				$data['id_form']  = set_value('id_form',$keuangan["id_form"]);
				$data['barcode_form']  = set_value('barcode_form',$keuangan["barcode_form"]);
				$data['id_kompetensi']  = set_value('id_kompetensi',$keuangan["id_kompetensi"]);
				$data['id_instansi']  = set_value('id_instansi',$keuangan["id_instansi"]);
				$data['id_jenis_form']  = set_value('id_jenis_form',$keuangan["id_jenis_form"]);
				$data['pembuat_form']  = set_value('pembuat_form',$keuangan["pembuat_form"]);
				$data['nama_form']  = set_value('nama_form',$keuangan["nama_form"]);
				$data['status_form']  = set_value('status_form',$keuangan["status_form"]);
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_edit'){
	    	$pembuat_form = $this->input->post('pembuat_form');
	    	$id_jenis_form = $this->input->post('id_jenis_form');
      	$id_kompetensi = $this->input->post('id_kompetensi');
      	$id_instansi = $this->input->post('id_instansi');
		 		$kondisi=array('id_instansi'=>$id_instansi,'id_kompetensi'=>$id_kompetensi,'id_jenis_form'=>$id_jenis_form,'status_form'=>1,'pembuat_form'=>$this->session->id_pegawai);
				$jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
//				if($jml == 0){
		    	if($this->session->id_pegawai == $pembuat_form){
					  if($this->m_admin_kredensial->edit_nkr_form()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('admin_kredensial/form1'));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('admin_kredensial/form1'));
					  }
		    	}else{
							$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
							redirect(base_url('admin_kredensial/form1'));    		
					}
/*				}else{
					$this->session->set_flashdata('danger', 'Data Sudah Ada');
					redirect(base_url('admin_kredensial/form1')); 					
				}*/
      }
		}
  }
  function elemen($mode='view')
  {
		$data['page']  = "elemen";
		$data['header'] = "ELEMEN KOMPETENSI";
		$data['title'] = "ELEMEN KOMPETENSI";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',32);
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
		$data['id']   = $this->uri->segment(4, 0);
		if($mode=='view'){
			$this->tampil($data);
		}
    else if($mode=='hapus'){
      $kondisi=array('pembuat_elemen'=>$this->session->barcode_pegawai,'id_elemen'=>$data['id']);
      $jml = $this->m_umum->jumlah_record_filter('nkr_elemen',$kondisi);
      $kondisi2=array('id_elemen'=>$data['id']);
      $jml2 = $this->m_umum->jumlah_record_filter('nkr_asesmen',$kondisi2);
      if($jml == 0){
          $this->session->set_flashdata('danger', 'Hanya Dapat Menghapus Data Sendiri');
          redirect(base_url('admin_kredensial/elemen'));
      }else{
        if($jml2 == 0){
          if($this->m_umum->hapus_data('nkr_elemen','id_elemen',$data['id'])){
              $this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
              redirect(base_url('admin_kredensial/elemen'));
            }else{
              $this->session->set_flashdata('danger', 'Masalah Hapus Data');
              redirect(base_url('admin_kredensial/elemen'));
            }
        }else{
          $this->session->set_flashdata('danger', 'Data Sudah Masuk Asesmen');
          redirect(base_url('admin_kredensial/elemen'));          
        }
      }
    }
    else if($mode=='data'){
			echo json_encode($this->m_admin_kredensial->elemen_all());
		}
		else{
			$data['cmd_jabatan']=$this->m_admin_kredensial->cmd_jabatan();
			$data['working']=$this->m_admin_kredensial->ambil_data_rujukan_working();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['nama_elemen']  = set_value('nama_elemen',$this->input->post('nama_elemen'));
				$data['jabatan_elemen']  = set_value('jabatan_elemen',$this->input->post('jabatan_elemen'));
				$data['instansi_elemen']  = set_value('instansi_elemen',$this->input->post('instansi_elemen'));
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($this->m_admin_kredensial->simpan_nkr_elemen()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('admin_kredensial/elemen'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('admin_kredensial/elemen'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('nkr_elemen','id_elemen',$data['id']);
				$data['id_elemen']  = set_value('id_elemen',$keuangan["id_elemen"]);
				$data['nama_elemen']  = set_value('nama_elemen',$keuangan["nama_elemen"]);
				$data['jabatan_elemen']  = set_value('jabatan_elemen',$keuangan["jabatan_elemen"]);
				$data['instansi_elemen']  = set_value('instansi_elemen',$keuangan["instansi_elemen"]);
				$data['pembuat_elemen']  = set_value('pembuat_elemen',$keuangan["pembuat_elemen"]);
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_edit'){
	    	$pembuat_elemen = $this->input->post('pembuat_elemen');
	    	$id_elemen = $this->input->post('id_elemen');
		 		$kondisi=array('id_elemen'=>$id_elemen);
				$jml = $this->m_umum->jumlah_record_filter('nkr_asesmen',$kondisi);
		//		if($jml == 0){
		    	if($this->session->barcode_pegawai == $pembuat_elemen){
					  if($this->m_admin_kredensial->edit_nkr_elemen()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('admin_kredensial/elemen'));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('admin_kredensial/elemen'));
					  }
		    	}else{
							$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
							redirect(base_url('admin_kredensial/elemen'));    		
					}
/*				}else{
						$this->session->set_flashdata('danger', 'Data Sudah Di pakai');
						redirect(base_url('admin_kredensial/elemen'));					
				}*/
      }
		}
  }
  function asesmen($mode='view')
  {
  	$data['page']  = "asesmen";
  	$data['header'] = "KOMPONEN ASESMEN";
  	$data['title'] = "KOMPONEN ASESMEN";
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
  	$data['id']   = $this->uri->segment(4, 0);
		if($mode=='view'){
			$this->tampil($data);
		}
    else if($mode=='hapus'){
      $kondisi=array('pembuat_asesmen'=>$this->session->id_pegawai,'id_asesmen'=>$data['id']);
      $jml = $this->m_umum->jumlah_record_filter('nkr_asesmen',$kondisi);
      $kondisi2=array('id_asesmen'=>$data['id']);
      $jml2 = $this->m_umum->jumlah_record_filter('nkr_question_f2',$kondisi2);
      if($jml == 0){
          $this->session->set_flashdata('danger', 'Hanya Dapat Menghapus Data Sendiri');
          redirect(base_url('admin_kredensial/asesmen'));
      }else{
        if($jml2 == 0){
          if($this->m_umum->hapus_data('nkr_asesmen','id_asesmen',$data['id'])){
              $this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
              redirect(base_url('admin_kredensial/asesmen'));
            }else{
              $this->session->set_flashdata('danger', 'Masalah Hapus Data');
              redirect(base_url('admin_kredensial/asesmen'));
            }
        }else{
          $this->session->set_flashdata('danger', 'Data Sudah Masuk Question');
          redirect(base_url('admin_kredensial/asesmen'));          
        }
      }
    }
    else if($mode=='data'){
			echo json_encode($this->m_admin_kredensial->asesmen_all());
		}
		else{
			$data['cmd_elemen']=$this->m_admin_kredensial->cmd_elemen();
			$data['cmd_jabatan']=$this->m_admin_kredensial->cmd_jabatan();
			$data['working']=$this->m_admin_kredensial->ambil_data_rujukan_working();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['id_elemen']  = set_value('id_elemen',$this->input->post('id_elemen'));
				$data['id_jabatan']  = set_value('id_jabatan',$this->session->id_jabatan);
				$data['instansi_asesmen']  = set_value('instansi_asesmen',$this->input->post('instansi_asesmen'));
				$data['nama_asesmen']  = set_value('nama_asesmen',$this->input->post('nama_asesmen'));
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($this->m_admin_kredensial->simpan_nkr_asesmen()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('admin_kredensial/asesmen'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('admin_kredensial/asesmen'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('nkr_asesmen','id_asesmen',$data['id']);
				$data['id_elemen']  = set_value('id_elemen',$keuangan["id_elemen"]);
				$data['nama_asesmen']  = set_value('nama_asesmen',$keuangan["nama_asesmen"]);
				$data['id_asesmen']  = set_value('id_asesmen',$keuangan["id_asesmen"]);
				$data['instansi_asesmen']  = set_value('instansi_asesmen',$keuangan["instansi_asesmen"]);
				$data['id_jabatan']  = set_value('id_jabatan',$keuangan["id_jabatan"]);
				$data['pembuat_asesmen']  = set_value('pembuat_asesmen',$keuangan["pembuat_asesmen"]);
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_edit'){
	    	$pembuat_asesmen = $this->input->post('pembuat_asesmen');
	    	$id_asesmen = $this->input->post('id_asesmen');
		 		$kondisi=array('id_asesmen'=>$id_asesmen);
				$jml = $this->m_umum->jumlah_record_filter('nkr_validasi_detil',$kondisi);
				$jml2 = $this->m_umum->jumlah_record_filter('nkr_indikator_validasi',$kondisi);
				if($jml == 0){
		    	if($this->session->id_pegawai == $pembuat_asesmen){
					  if($this->m_admin_kredensial->edit_nkr_asesmen()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('admin_kredensial/asesmen'));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('admin_kredensial/asesmen'));
					  }
		    	}else{
							$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
							redirect(base_url('admin_kredensial/asesmen'));    		
					}
				}else{
					$this->session->set_flashdata('danger', 'Data Masuk Validasi');
					redirect(base_url('admin_kredensial/asesmen')); 					
				}
      }
		}
  }
  function qf_2($mode='view')
  {
	$data['page']  = "qf_2";
	$data['header'] = "SETING PERTANYAAN FORM 2 ASESMEN MANDIRI";
	$data['title'] = "SETING PERTANYAAN FORM 2 ASESMEN MANDIRI";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',32);
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
		$data['id']   = $this->uri->segment(4, 0);
		if($mode=='view'){
			$this->tampil($data);
		}
    else if($mode=='data'){
			echo json_encode($this->m_admin_kredensial->qf_2_all());
		}
		else{
			$data['cmd_asesmen']=$this->m_admin_kredensial->cmd_asesmen();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['id_asesmen']  = set_value('id_asesmen',$this->input->post('id_asesmen'));
				$data['nama_question']  = set_value('nama_question',$this->input->post('nama_question'));
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($this->m_admin_kredensial->simpan_nkr_question()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('admin_kredensial/qf_2'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('admin_kredensial/qf_2'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('nkr_question_f2','id_question',$data['id']);
				$data['id_question']  = set_value('id_question',$keuangan["id_question"]);
				$data['id_asesmen']  = set_value('id_asesmen',$keuangan["id_asesmen"]);
				$data['nama_question']  = set_value('nama_question',$keuangan["nama_question"]);
				$data['pembuat_question']  = set_value('pembuat_question',$keuangan["pembuat_question"]);
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_edit'){
	    	$pembuat_question = $this->input->post('pembuat_question');
	    	$id_question = $this->input->post('id_question');
		 		$kondisi=array('id_question'=>$id_question);
				$jml = $this->m_umum->jumlah_record_filter('nkr_form_detil',$kondisi);
      	$id_instansi = $this->input->post('id_instansi');
		 		$kondisi=array('id_instansi'=>$id_instansi,'id_kompetensi'=>$id_kompetensi,'id_jenis_form'=>$id_jenis_form);
				$jml2 = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
//				if($jml == 0){
		    	if($this->session->id_pegawai == $pembuat_question){
					  if($this->m_admin_kredensial->edit_nkr_question()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('admin_kredensial/qf_2'));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('admin_kredensial/qf_2'));
					  }
		    	}else{
							$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
							redirect(base_url('admin_kredensial/qf_2'));    		
					}
/*				}else{
					$this->session->set_flashdata('danger', 'Data Sudah Masuk Kompetensi');
					redirect(base_url('admin_kredensial/qf_2'));  					
				}*/
      }
      if($mode=='hasil'){
        $data['page'] =  $data['page']."_hasil";
        $data['id_question']  = set_value('id_question',$this->input->post('id_question'));
        $data['hasil']=$this->m_admin_kredensial->cr_question_lain();
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_hasil'){
			  if($this->m_admin_kredensial->simpan_nkr_question_lainnya()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('admin_kredensial/qf_2'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('admin_kredensial/qf_2'));
			  }
      }
    if($mode=='pdf_question'){
        $report = $this->load->view('cetak/question', $data, TRUE);
        $filename = date('YmdHis')."-question.pdf";
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
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
  function format_question($mode='view')
  {
	$data['page']  = "format_question";
	$data['header'] = "SETING PERTANYAAN FORM 2 PER INSTANSI DAN PER JABATAN";
	$data['title'] = "SETING PERTANYAAN FORM 2 PER INSTANSI DAN PER JABATAN";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',32);
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
		$data['id']   = $this->uri->segment(4, 0);
		$data['id2']   = $this->uri->segment(5, 0);
		$data['id3']   = $this->uri->segment(6, 0);
		if($mode=='view'){
			$this->tampil($data);
		}
    else if($mode=='data'){
			echo json_encode($this->m_admin_kredensial->form_all(2));
		}
    else if($mode=='detil'){
			echo json_encode($this->m_admin_kredensial->form_question_detil($data['id']));
		}
  else if($mode=='hapus_form'){
    $kondisi=array('pembuat_form'=>$this->session->id_pegawai,'id_form'=>$data['id']);
    $jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
    $kondisi2=array('barcode_form'=>$data['id2']);
    $jml2 = $this->m_umum->jumlah_record_filter('nkr_form_detil',$kondisi2);
    if($jml == 0){
        $this->session->set_flashdata('danger', 'Hanya Dapat Menghapus Data Sendiri');
        redirect(base_url('admin_kredensial/'.$data['page']));
    }else{
      if($jml2 == 0){
        if($this->m_umum->hapus_data('nkr_form','id_form',$data['id'])){
            $this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
            redirect(base_url('admin_kredensial/'.$data['page']));
          }else{
            $this->session->set_flashdata('danger', 'Masalah Hapus Data');
            redirect(base_url('admin_kredensial/'.$data['page']));
          }
      }else{
        $this->session->set_flashdata('danger', 'Hapus Dahulu Data Di Dalamnya');
        redirect(base_url('admin_kredensial/'.$data['page']));        
      }
    }
  }
    else if($mode=='hapus'){
      $kondisi=array('pembuat_form'=>$this->session->id_pegawai,'id_form_detil'=>$data['id2']);
      $jml = $this->m_umum->jumlah_record_tabel_pengajuan('nkr_form_detil',$kondisi,'nkr_form','barcode_form');
 /*     $kondisi2=array('id_asesmen'=>$data['id']);
      $jml2 = $this->m_umum->jumlah_record_filter('nkr_question_f2',$kondisi2);
      if($jml == 0){
          $this->session->set_flashdata('danger', 'Hanya Dapat Menghapus Data Sendiri');
          redirect(base_url('admin_kredensial/asesmen'));
      }else{*/
        if($jml2 == 0){
          if($this->m_umum->hapus_data('nkr_form_detil','id_form_detil',$data['id2'])){
              $this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
              redirect(base_url('admin_kredensial/format_question/seting/'.$data['id']));
            }else{
              $this->session->set_flashdata('danger', 'Masalah Hapus Data');
              redirect(base_url('admin_kredensial/format_question/seting/'.$data['id']));
            }
        }else{
          $this->session->set_flashdata('danger', 'Data Sudah Masuk Question');
          redirect(base_url('admin_kredensial/format_question/seting/'.$data['id']));          
        }
  /*    }*/
    }
		else{
			$data['working']=$this->m_admin_kredensial->ambil_data_rujukan_working();
			$data['status']=$this->m_rancak->cmd_status();
			$data['cmd_kompetensi_in']=$this->m_admin_kredensial->cmd_kompetensi_in($this->session->mas_kred);
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['id_kompetensi']  = set_value('id_kompetensi',$this->input->post('id_kompetensi'));
				$data['id_instansi']  = set_value('id_instansi',$this->input->post('id_instansi'));
				$data['nama_form']  = set_value('nama_form',$this->input->post('nama_form'));
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_tambah'){
      	$id_jenis_form = $this->input->post('id_jenis_form');
      	$id_kompetensi = $this->input->post('id_kompetensi');
      	$id_instansi = $this->input->post('id_instansi');
		 		$kondisi=array('id_instansi'=>$id_instansi,'id_kompetensi'=>$id_kompetensi,'id_jenis_form'=>$id_jenis_form);
				$jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
//				if($jml == 0){
				  if($this->m_admin_kredensial->simpan_nkr_form()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('admin_kredensial/format_question'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
						redirect(base_url('admin_kredensial/format_question'));
				  }
/*				}else{
					$this->session->set_flashdata('danger', 'Data Sudah Ada');
					redirect(base_url('admin_kredensial/format_question'));				
				}*/
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('nkr_form','id_form',$data['id']);
				$data['id_form']  = set_value('id_form',$keuangan["id_form"]);
				$data['id_jenis_form']  = set_value('id_jenis_form',$keuangan["id_jenis_form"]);
				$data['barcode_form']  = set_value('barcode_form',$keuangan["barcode_form"]);
				$data['id_kompetensi']  = set_value('id_kompetensi',$keuangan["id_kompetensi"]);
				$data['id_instansi']  = set_value('id_instansi',$keuangan["id_instansi"]);
				$data['pembuat_form']  = set_value('pembuat_form',$keuangan["pembuat_form"]);
				$data['nama_form']  = set_value('nama_form',$keuangan["nama_form"]);
				$data['status_form']  = set_value('status_form',$keuangan["status_form"]);
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_edit'){
	    	$pembuat_form = $this->input->post('pembuat_form');
	    	$id_jenis_form = $this->input->post('id_jenis_form');
      	$id_kompetensi = $this->input->post('id_kompetensi');
      	$id_instansi = $this->input->post('id_instansi');
		 		$kondisi=array('id_instansi'=>$id_instansi,'id_kompetensi'=>$id_kompetensi,'id_jenis_form'=>$id_jenis_form);
				$jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
//				if($jml == 0){
		    	if($this->session->id_pegawai == $pembuat_form){
					  if($this->m_admin_kredensial->edit_nkr_form()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('admin_kredensial/format_question'));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('admin_kredensial/format_question'));
					  }
		    	}else{
							$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
							redirect(base_url('admin_kredensial/format_question'));    		
					}
/*				}else{
					$this->session->set_flashdata('danger', 'Data Sudah Dipakai');
					redirect(base_url('admin_kredensial/format_question')); 					
				}*/
      }
      if($mode=='seting'){
        $data['page'] =  $data['page']."_seting";
		 		$kondisi=array('barcode_form'=>$data['id']);
				$jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
				if($jml == 0){
						$this->session->set_flashdata('danger', 'Data Tidak Valid');
						redirect(base_url('admin_kredensial/format_question'));
				}
				$data['nkr_asesmen']	= $this->m_admin_kredensial->ambil_nkr_asesmen_tuk_form($data['id2'],$data['id3']);
				$data['cmd_elemen']	= $this->m_admin_kredensial->cmd_elemen_jabatan();
				$data['cmd_jabatan']	= $this->m_admin_kredensial->cmd_jabatan();
				$data['ambil_working']	= $this->m_admin_kredensial->ambil_working_null();
				$d	= $this->m_admin_kredensial->ambil_nkr_form($data['id']);
				$jml_inst	= $this->m_admin_kredensial->jumlah_record_tabel_ol_user($d['id_instansi']);
				if($jml_inst == 0){
						$this->session->set_flashdata('danger', 'Tidak Ada Hak Akses');
						redirect(base_url('admin_kredensial/format_question'));
				}
				$data['id_form']  = set_value('id_form',$d["id_form"]);
				$data['barcode_form']  = set_value('barcode_form',$d["barcode_form"]);
				$data['nama_kompetensi']  = set_value('nama_kompetensi',$d["nama_kompetensi"]);
				$data['kode_unit']  = set_value('kode_unit',$d["kode_unit"]);
				$data['nama_jabatan']  = set_value('nama_jabatan',$d["nama_jabatan"]);
				$this->tampil($data);
				$action = $this->input->post('action');
				if($action == 'BtnProses') {
		      $id   = $this->input->post('id');
		      $id2   = $this->input->post('id2');
		      $id3   = $this->input->post('id3');
					redirect(base_url('admin_kredensial/format_question/seting/'.$data['id'].'/'.$id2.'/'.$id3));
				}
				if($action == 'BtnSimpan') {
		      $id   = $this->input->post('id');
		      $id2   = $this->input->post('id2');
		      $id3   = $this->input->post('id3');
					$this->m_admin_kredensial->simpan_nkr_question_form_detil();
					$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
					redirect(base_url('admin_kredensial/format_question/seting/'.$data['id'].'/'.$id2.'/'.$id3));
				} 
	  	}
      if($mode=='urutan'){
        $data['page'] =  $data['page']."_urutan";
				$kondisi=array('id_form_detil'=>$data['id']);
				$keuangan    = $this->m_umum->ambil_data_kondisi_2tabel_row('nkr_form_detil',$kondisi,'nkr_form','barcode_form');
				$data['no_urut_detil']  = set_value('no_urut_detil',$keuangan["no_urut_detil"]);
				$data['id_form_detil']  = set_value('id_form_detil',$keuangan["id_form_detil"]);
				$data['id_jenis_form']  = set_value('id_jenis_form',$keuangan["id_jenis_form"]);
				$data['barcode_form']  = set_value('barcode_form',$keuangan["barcode_form"]);
				$data['id_kompetensi']  = set_value('id_kompetensi',$keuangan["id_kompetensi"]);
				$data['id_instansi']  = set_value('id_instansi',$keuangan["id_instansi"]);
				$data['pembuat_form']  = set_value('pembuat_form',$keuangan["pembuat_form"]);
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_urutan'){
	    	$pembuat_form = $this->input->post('pembuat_form');
	    	$barcode_form = $this->input->post('barcode_form');
		    	if($this->session->id_pegawai == $pembuat_form){
					  if($this->m_admin_kredensial->edit_urutan_detil()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('admin_kredensial/format_question/seting/'.$barcode_form));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('admin_kredensial/format_question/seting/'.$barcode_form));
					  }
		    	}else{
							$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
							redirect(base_url('admin_kredensial/format_question/seting/'.$barcode_form));    		
					}
      }
		}
  }
  function metode($mode='view')
  {
	$data['page']  = "metode";
	$data['header'] = "METODE ASESMEN";
	$data['title'] = "METODE ASESMEN";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',32);
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
		$data['id']   = $this->uri->segment(4, 0);
		if($mode=='view'){
			$this->tampil($data);
		}
    else if($mode=='data'){
			echo json_encode($this->m_admin_kredensial->metode_all());
		}
		else{
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['nama_metode']  = set_value('nama_metode',$this->input->post('nama_metode'));
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($this->m_admin_kredensial->simpan_nkr_metode()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('admin_kredensial/metode'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('admin_kredensial/metode'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('nkr_metode','id_metode',$data['id']);
				$data['id_metode']  = set_value('id_metode',$keuangan["id_metode"]);
				$data['nama_metode']  = set_value('nama_metode',$keuangan["nama_metode"]);
				$data['pembuat_metode']  = set_value('pembuat_metode',$keuangan["pembuat_metode"]);
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_edit'){
	    	$pembuat_metode = $this->input->post('pembuat_metode');
	    	$id_metode = $this->input->post('id_metode');
				$jml = $this->m_admin_kredensial->jumlah_record_tabel_metode($id_metode);
				if($jml == 0){
		    	if($this->session->id_pegawai == $pembuat_metode){
					  if($this->m_admin_kredensial->edit_nkr_metode()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('admin_kredensial/metode'));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('admin_kredensial/metode'));
					  }
		    	}else{
							$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
							redirect(base_url('admin_kredensial/metode'));    		
					}
				}else{
						$this->session->set_flashdata('danger', 'Data Sudah Di pakai');
						redirect(base_url('admin_kredensial/metode'));					
				}
      }
		}
  }
  function perangkat($mode='view')
  {
	$data['page']  = "perangkat";
	$data['header'] = "PERANGKAT ASESMEN";
	$data['title'] = "PERANGKAT ASESMEN";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',32);
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
		$data['id']   = $this->uri->segment(4, 0);
		if($mode=='view'){
			$this->tampil($data);
		}
    else if($mode=='data'){
			echo json_encode($this->m_admin_kredensial->perangkat_all());
		}
		else{
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['nama_perangkat']  = set_value('nama_perangkat',$this->input->post('nama_perangkat'));
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($this->m_admin_kredensial->simpan_nkr_perangkat()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('admin_kredensial/perangkat'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('admin_kredensial/perangkat'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('nkr_perangkat','id_perangkat',$data['id']);
				$data['id_perangkat']  = set_value('id_perangkat',$keuangan["id_perangkat"]);
				$data['nama_perangkat']  = set_value('nama_perangkat',$keuangan["nama_perangkat"]);
				$data['pembuat_perangkat']  = set_value('pembuat_perangkat',$keuangan["pembuat_perangkat"]);
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_edit'){
	    	$pembuat_perangkat = $this->input->post('pembuat_perangkat');
	    	$id_perangkat = $this->input->post('id_perangkat');
				$jml = $this->m_admin_kredensial->jumlah_record_tabel_perangkat($id_perangkat);
				if($jml == 0){
		    	if($this->session->id_pegawai == $pembuat_perangkat){
					  if($this->m_admin_kredensial->edit_nkr_perangkat()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('admin_kredensial/perangkat'));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('admin_kredensial/perangkat'));
					  }
		    	}else{
							$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
							redirect(base_url('admin_kredensial/perangkat'));    		
					}
				}else{
						$this->session->set_flashdata('danger', 'Data Sudah Di pakai');
						redirect(base_url('admin_kredensial/perangkat'));					
				}
      }
		}
  }
  function alat($mode='view')
  {
	$data['page']  = "alat";
	$data['header'] = "SETING ALAT DAN BAHAN";
	$data['title'] = "SETING ALAT DAN BAHAN";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',32);
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
		$data['id']   = $this->uri->segment(4, 0);
		if($mode=='view'){
			$this->tampil($data);
		}
    else if($mode=='data'){
			echo json_encode($this->m_admin_kredensial->alat_all());
		}
		else{
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['nama_alat']  = set_value('nama_alat',$this->input->post('nama_alat'));
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($this->m_admin_kredensial->simpan_nkr_alat()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('admin_kredensial/alat'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('admin_kredensial/alat'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('nkr_alat','id_alat',$data['id']);
				$data['id_alat']  = set_value('id_alat',$keuangan["id_alat"]);
				$data['nama_alat']  = set_value('nama_alat',$keuangan["nama_alat"]);
				$data['pembuat_alat']  = set_value('pembuat_alat',$keuangan["pembuat_alat"]);
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_edit'){
	    	$pembuat_alat = $this->input->post('pembuat_alat');
	    	$id_alat = $this->input->post('id_alat');
				$jml = $this->m_admin_kredensial->jumlah_record_tabel_alat($id_alat);
				if($jml == 0){
		    	if($this->session->id_pegawai == $pembuat_alat){
					  if($this->m_admin_kredensial->edit_nkr_alat()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('admin_kredensial/alat'));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('admin_kredensial/alat'));
					  }
		    	}else{
							$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
							redirect(base_url('admin_kredensial/alat'));    		
					}
				}else{
						$this->session->set_flashdata('danger', 'Data Sudah Di pakai');
						redirect(base_url('admin_kredensial/metode'));					
				}
      }
		}
  }
  function alatbahan($mode='view')
  {
	$data['page']  = "alatbahan";
	$data['header'] = "ALAT DAN BAHAN ELEMEN KOMPETENSI";
	$data['title'] = "ALAT DAN BAHAN ELEMEN KOMPETENSI";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',32);
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
		$data['id']   = $this->uri->segment(4, 0);
		if($mode=='view'){
			$data['instansi']	= $this->m_umum->ambil_data_explode('kol_working','id_working',$this->session->mas_ins);
			$data['alat']	= $this->m_umum->ambil_data('nkr_alat');
			$this->tampil($data);
		}
    else if($mode=='data'){
			echo json_encode($this->m_admin_kredensial->alat_bahan_all());
		}
		else{
				
				$data['ambil_working']=$this->m_admin_kredensial->ambil_data_rujukan_working();
        $kondisi_alat = array('id_jabatan'=>$this->session->id_jabatan);
			$data['ambil_nkr_alat']=$this->m_umum->ambil_data_kondisi_result('nkr_alat',$kondisi_alat);
			$data['ambil_kompetensi']=$this->m_admin_kredensial->cmd_kompetensi_in($this->session->mas_kred);
			$data['cmd_elemen']=$this->m_admin_kredensial->cmd_elemen_jabatan();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['id_elemen']  = set_value('id_elemen',$this->input->post('id_elemen'));
				$data['id_kompetensi']  = set_value('id_kompetensi',$this->input->post('id_kompetensi'));
				$data['id_instansi']  = set_value('id_instansi',$this->input->post('id_instansi'));
				$data['alat']  = set_value('alat',$this->input->post('alat'));
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_tambah'){
	    	$id_elemen = $this->input->post('id_elemen');
	    	$id_instansi = $this->input->post('id_instansi');
	    	$id_kompetensi = $this->input->post('id_kompetensi');
		 		$kondisi=array('id_elemen'=>$id_elemen,'id_kompetensi'=>$id_kompetensi,'id_instansi'=>$id_instansi);
				$jml = $this->m_umum->jumlah_record_filter('nkr_alat_bahan',$kondisi);
				if($jml == 0){
				  	$this->m_admin_kredensial->simpan_alat_bahan();
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('admin_kredensial/alatbahan'));
				}else{
						$this->session->set_flashdata('danger', 'Data Sudah Ada');
						redirect(base_url('admin_kredensial/metode'));					
				}
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('nkr_alat_bahan','id_alat_bahan',$data['id']);
				$data['id_alat_bahan']  = set_value('id_alat_bahan',$keuangan["id_alat_bahan"]);
				$data['id_elemen']  = set_value('id_elemen',$keuangan["id_elemen"]);
				$data['id_instansi']  = set_value('id_instansi',$keuangan["id_instansi"]);
				$data['id_kompetensi']  = set_value('id_kompetensi',$keuangan["id_kompetensi"]);
				$data['pembuat_alat_bahan']  = set_value('pembuat_alat_bahan',$keuangan["pembuat_alat_bahan"]);
				$data['alat']  = set_value('alat',$keuangan["alat"]);
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_edit'){
	    	$pembuat_alat_bahan = $this->input->post('pembuat_alat_bahan');
	    	$id_alat_bahan = $this->input->post('id_alat_bahan');
	    	$elemen = $this->input->post('elemen');
		    	if($this->session->id_pegawai == $pembuat_alat_bahan){
					  if($this->m_admin_kredensial->edit_alat_bahan()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('admin_kredensial/alatbahan'));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('admin_kredensial/alatbahan'));
					  }
		    	}else{
							$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
							redirect(base_url('admin_kredensial/alatbahan'));    		
					}
      }
		}
  }
  function indikator($mode='view')
  {
	$data['page']  = "indikator";
	$data['header'] = "INDIKATOR UNJUK KERJA";
	$data['title'] = "INDIKATOR UNJUK KERJA";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',32);
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
		$data['id']   = $this->uri->segment(4, 0);
		if($mode=='view'){
			$data['instansi']	= $this->m_umum->ambil_data_explode('kol_working','id_working',$this->session->mas_ins);
			$data['jabatan']	= $this->m_umum->ambil_data_explode('jabatan','id_jabatan',$this->session->mas_kred);
			$data['metode']	= $this->m_umum->ambil_data('nkr_metode');
			$data['perangkat']	= $this->m_umum->ambil_data('nkr_perangkat');
			$this->tampil($data);
		}
    else if($mode=='data'){
			echo json_encode($this->m_admin_kredensial->indikator_all());
		}
		else{
			$data['cmd_asesmen']=$this->m_admin_kredensial->cmd_asesmen();
			$data['status']=$this->m_rancak->cmd_status();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['id_asesmen']  = set_value('id_asesmen',$this->input->post('id_asesmen'));
				$data['nama_indikator']  = set_value('nama_indikator',$this->input->post('nama_indikator'));
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($this->m_admin_kredensial->simpan_nkr_indikator()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('admin_kredensial/indikator'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('admin_kredensial/indikator'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('nkr_indikator','id_indikator',$data['id']);
				$data['id_indikator']  = set_value('id_indikator',$keuangan["id_indikator"]);
				$data['nama_indikator']  = set_value('nama_indikator',$keuangan["nama_indikator"]);
				$data['id_asesmen']  = set_value('id_asesmen',$keuangan["id_asesmen"]);
				$data['pembuat_indikator']  = set_value('pembuat_indikator',$keuangan["pembuat_indikator"]);
				$data['status_indikator']  = set_value('status_indikator',$keuangan["status_indikator"]);
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_edit'){
	    	$pembuat_indikator = $this->input->post('pembuat_indikator');
	    	$id_indikator = $this->input->post('id_indikator');
		 		$kondisi=array('id_indikator'=>$id_indikator);
				$jml = $this->m_umum->jumlah_record_filter('nkr_form_detil',$kondisi);
//				if($jml == 0){
		    	if($this->session->id_pegawai == $pembuat_indikator){
					  if($this->m_admin_kredensial->edit_nkr_indikator()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('admin_kredensial/indikator'));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('admin_kredensial/indikator'));
					  }
		    	}else{
							$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
							redirect(base_url('admin_kredensial/indikator'));    		
					}
/*				}else{
					$this->session->set_flashdata('danger', 'Data Sudah Dipakai');
					redirect(base_url('admin_kredensial/indikator')); 					
				}*/
      }
      if($mode=='metode'){
        $data['page'] =  $data['page']."_metode";
				$data['metode']	= $this->m_umum->ambil_data('nkr_metode');
				$keuangan    = $this->m_umum->ambil_data('nkr_indikator','id_indikator',$data['id']);
				$data['id_indikator']  = set_value('id_indikator',$keuangan["id_indikator"]);
				$data['nama_indikator']  = set_value('nama_indikator',$keuangan["nama_indikator"]);
				$data['metode_indikator']  = set_value('metode_indikator',$keuangan["metode_indikator"]);
				$data['pembuat_indikator']  = set_value('pembuat_indikator',$keuangan["pembuat_indikator"]);
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_metode'){
				$this->m_admin_kredensial->simpan_nkr_metode_indikator();
				$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
				redirect(base_url('admin_kredensial/indikator'));
      }
      if($mode=='perangkat'){
        $data['page'] =  $data['page']."_perangkat";
				$data['perangkat']	= $this->m_umum->ambil_data('nkr_perangkat');
				$keuangan    = $this->m_umum->ambil_data('nkr_indikator','id_indikator',$data['id']);
				$data['id_indikator']  = set_value('id_indikator',$keuangan["id_indikator"]);
				$data['nama_indikator']  = set_value('nama_indikator',$keuangan["nama_indikator"]);
				$data['perangkat_indikator']  = set_value('perangkat_indikator',$keuangan["perangkat_indikator"]);
				$data['pembuat_indikator']  = set_value('pembuat_indikator',$keuangan["pembuat_indikator"]);
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_perangkat'){
				$this->m_admin_kredensial->simpan_nkr_perangkat_indikator();
				$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
				redirect(base_url('admin_kredensial/indikator'));
      }
      if($mode=='status'){
      	$data['page'] =  $data['page']."_status";
			  if($this->m_admin_kredensial->edit_status_indikator($id,$isi)){
					$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
					redirect(base_url('admin_kredensial/indikator'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Masalah Rubah Status');
					redirect(base_url('admin_kredensial/indikator'));
			  }
      }
      if($mode=='seting_jawaban'){
        $data['page'] =  $data['page']."_seting_jawaban";
				$keuangan    = $this->m_umum->ambil_data('nkr_indikator','id_indikator',$data['id']);
				$data['cmd_status']    = array('0'=>'Non Aktif','1'=>'Aktif');
				$data['cmd_answer']    = array('0'=>'NOT','1'=>'ANSWER');
				$data['soal']    = $this->m_admin_kredensial->ambil_soal_opsi($data['id']);
				$data['id_indikator']  = set_value('id_indikator',$keuangan["id_indikator"]);
				$data['nama_indikator']  = set_value('nama_indikator',$keuangan["nama_indikator"]);
				$data['id_asesmen']  = set_value('id_asesmen',$keuangan["id_asesmen"]);
				$data['jenis_soal']  = set_value('jenis_soal',$keuangan["jenis_soal"]);
				$data['pembuat_indikator']  = set_value('pembuat_indikator',$keuangan["pembuat_indikator"]);
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_seting_jawaban'){
	    	$pembuat_indikator = $this->input->post('pembuat_indikator');
	    	$id_indikator = $this->input->post('id_indikator');
		 		$kondisi=array('id_indikator'=>$id_indikator);
				$jml = $this->m_umum->jumlah_record_filter('nkr_validasi_detil',$kondisi);
	//			if($jml == 0){
		    	if($this->session->id_pegawai == $pembuat_indikator){
					  	$this->m_admin_kredensial->simpan_opsi_soal();
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('admin_kredensial/indikator'));
		    	}else{
							$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
							redirect(base_url('admin_kredensial/indikator'));    		
					}
/*				}else{
					$this->session->set_flashdata('danger', 'Data Sudah Masuk Validasi');
					redirect(base_url('admin_kredensial/indikator')); 					
				}*/
      }
      if($mode=='rubah_opsi'){
        $data['page'] =  $data['page']."_rubah_opsi";
				$keuangan    = $this->m_umum->ambil_data('nkr_indikator','id_indikator',$data['id']);
				$data['opsi_soal']  = array('0'=>'Isian','1'=>'Pilihan','2'=>'Pilihan Berganda');
				$data['id_indikator']  = set_value('id_indikator',$keuangan["id_indikator"]);
				$data['nama_indikator']  = set_value('nama_indikator',$keuangan["nama_indikator"]);
				$data['id_asesmen']  = set_value('id_asesmen',$keuangan["id_asesmen"]);
				$data['jenis_soal']  = set_value('jenis_soal',$keuangan["jenis_soal"]);
				$data['pembuat_indikator']  = set_value('pembuat_indikator',$keuangan["pembuat_indikator"]);
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_rubah_opsi'){
	    	$pembuat_indikator = $this->input->post('pembuat_indikator');
	    	$id_indikator = $this->input->post('id_indikator');
		 		$kondisi=array('id_indikator'=>$id_indikator);
				$jml = $this->m_umum->jumlah_record_filter('nkr_validasi_detil',$kondisi);
	//			if($jml == 0){
		    	if($this->session->id_pegawai == $pembuat_indikator){
					  if($this->m_admin_kredensial->edit_jenis_soal_nkr_indikator()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('admin_kredensial/indikator'));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('admin_kredensial/indikator'));
					  }
		    	}else{
							$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
							redirect(base_url('admin_kredensial/indikator'));    		
					}
/*				}else{
					$this->session->set_flashdata('danger', 'Data Sudah Masuk Validasi');
					redirect(base_url('admin_kredensial/indikator')); 					
				}*/
      }
    if($mode=='pdf_indikator'){
        $report = $this->load->view('cetak/indikator', $data, TRUE);
        $filename = date('YmdHis')."-indikator.pdf";
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
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
  function form3($mode='view')
  {
	$data['page']  = "form3";
	$data['header'] = "SETING FORM 3 PER INSTANSI DAN PER JABATAN";
	$data['title'] = "SETING FORM 3 PER INSTANSI DAN PER JABATAN";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',32);
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
		$data['id']   = $this->uri->segment(4, 0);
		$data['id2']   = $this->uri->segment(5, 0);
		$data['id3']   = $this->uri->segment(6, 0);
		$data['id4']   = $this->uri->segment(7, 0);
		if($mode=='view'){
			$this->tampil($data);
		}
    else if($mode=='data'){
			echo json_encode($this->m_admin_kredensial->form_all(3));
		}
    else if($mode=='detil'){
			echo json_encode($this->m_admin_kredensial->form_indikator_detil($data['id']));
		}
  else if($mode=='hapus_form'){
    $kondisi=array('pembuat_form'=>$this->session->id_pegawai,'id_form'=>$data['id']);
    $jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
    $kondisi2=array('barcode_form'=>$data['id2']);
    $jml2 = $this->m_umum->jumlah_record_filter('nkr_form_detil',$kondisi2);
    if($jml == 0){
        $this->session->set_flashdata('danger', 'Hanya Dapat Menghapus Data Sendiri');
        redirect(base_url('admin_kredensial/'.$data['page']));
    }else{
      if($jml2 == 0){
        if($this->m_umum->hapus_data('nkr_form','id_form',$data['id'])){
            $this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
            redirect(base_url('admin_kredensial/'.$data['page']));
          }else{
            $this->session->set_flashdata('danger', 'Masalah Hapus Data');
            redirect(base_url('admin_kredensial/'.$data['page']));
          }
      }else{
        $this->session->set_flashdata('danger', 'Hapus Dahulu Data Di Dalamnya');
        redirect(base_url('admin_kredensial/'.$data['page']));        
      }
    }
  }
  else if($mode=='hapus'){
    $kondisi=array('pembuat_form'=>$this->session->id_pegawai,'id_form_detil'=>$data['id2']);
    $jml = $this->m_umum->jumlah_record_tabel_pengajuan('nkr_form_detil',$kondisi,'nkr_form','barcode_form');
/*     $kondisi2=array('id_asesmen'=>$data['id']);
    $jml2 = $this->m_umum->jumlah_record_filter('nkr_question_f2',$kondisi2);
    if($jml == 0){
        $this->session->set_flashdata('danger', 'Hanya Dapat Menghapus Data Sendiri');
        redirect(base_url('admin_kredensial/asesmen'));
    }else{*/
      if($jml2 == 0){
        if($this->m_umum->hapus_data('nkr_form_detil','id_form_detil',$data['id2'])){
            $this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
            redirect(base_url('admin_kredensial/form3/seting/'.$data['id']));
          }else{
            $this->session->set_flashdata('danger', 'Masalah Hapus Data');
            redirect(base_url('admin_kredensial/form3/seting/'.$data['id']));
          }
      }else{
        $this->session->set_flashdata('danger', 'Data Sudah Masuk Question');
        redirect(base_url('admin_kredensial/form3/seting/'.$data['id']));        
      }
/*    }*/
  }
		else{
			$data['working']=$this->m_admin_kredensial->ambil_data_rujukan_working();
			$data['status']=$this->m_rancak->cmd_status();
			$data['cmd_kompetensi_in']=$this->m_admin_kredensial->cmd_kompetensi_in($this->session->mas_kred);
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['id_kompetensi']  = set_value('id_kompetensi',$this->input->post('id_kompetensi'));
				$data['id_instansi']  = set_value('id_instansi',$this->input->post('id_instansi'));
				$data['nama_form']  = set_value('nama_form',$this->input->post('nama_form'));
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_tambah'){
      	$id_jenis_form = $this->input->post('id_jenis_form');
      	$id_kompetensi = $this->input->post('id_kompetensi');
      	$id_instansi = $this->input->post('id_instansi');
		 		$kondisi=array('id_instansi'=>$id_instansi,'id_kompetensi'=>$id_kompetensi,'id_jenis_form'=>$id_jenis_form);
				$jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
//				if($jml == 0){
				  if($this->m_admin_kredensial->simpan_nkr_form()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('admin_kredensial/form3'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
						redirect(base_url('admin_kredensial/form3'));
				  }
/*				}else{
					$this->session->set_flashdata('danger', 'Data Sudah Ada');
					redirect(base_url('admin_kredensial/form3'));				
				}*/
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('nkr_form','id_form',$data['id']);
				$data['id_form']  = set_value('id_form',$keuangan["id_form"]);
				$data['barcode_form']  = set_value('barcode_form',$keuangan["barcode_form"]);
				$data['id_kompetensi']  = set_value('id_kompetensi',$keuangan["id_kompetensi"]);
				$data['id_instansi']  = set_value('id_instansi',$keuangan["id_instansi"]);
				$data['id_jenis_form']  = set_value('id_jenis_form',$keuangan["id_jenis_form"]);
				$data['pembuat_form']  = set_value('pembuat_form',$keuangan["pembuat_form"]);
				$data['nama_form']  = set_value('nama_form',$keuangan["nama_form"]);
				$data['status_form']  = set_value('status_form',$keuangan["status_form"]);
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_edit'){
	    	$pembuat_form = $this->input->post('pembuat_form');
	    	$id_jenis_form = $this->input->post('id_jenis_form');
      	$id_kompetensi = $this->input->post('id_kompetensi');
      	$id_instansi = $this->input->post('id_instansi');
		 		$kondisi=array('id_instansi'=>$id_instansi,'id_kompetensi'=>$id_kompetensi,'id_jenis_form'=>$id_jenis_form);
				$jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
//				if($jml == 0){
		    	if($this->session->id_pegawai == $pembuat_form){
					  if($this->m_admin_kredensial->edit_nkr_form()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('admin_kredensial/form3'));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('admin_kredensial/form3'));
					  }
		    	}else{
							$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
							redirect(base_url('admin_kredensial/form3'));    		
					}
/*				}else{
					$this->session->set_flashdata('danger', 'Data Sudah Ada');
					redirect(base_url('admin_kredensial/form3')); 					
				}*/
      }
      if($mode=='seting'){
        $data['page'] =  $data['page']."_seting";
		 		$kondisi=array('barcode_form'=>$data['id']);
				$jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
				if($jml == 0){
						$this->session->set_flashdata('danger', 'Data Tidak Valid');
						redirect(base_url('admin_kredensial/form3'));
				}
/*				$el	= $this->m_umum->ambil_data('nkr_elemen','id_elemen',$data['id2']);
				$data['instansi']	= $this->m_umum->ambil_data_result('kol_working','id_working',$el['instansi_elemen']);*/
				$data['perangkat']	= $this->m_umum->ambil_data('nkr_perangkat');
				$data['metode']	= $this->m_umum->ambil_data('nkr_metode');
				$data['alat']	= $this->m_umum->ambil_data('nkr_alat');
				$data['cmd_elemen']	= $this->m_admin_kredensial->cmd_elemen_jabatan();
				$data['cmd_jabatan']	= $this->m_admin_kredensial->cmd_jabatan();
				$d	= $this->m_admin_kredensial->ambil_nkr_form($data['id']);
				$data['id_form']  = set_value('id_form',$d["id_form"]);
				$data['barcode_form']  = set_value('barcode_form',$d["barcode_form"]);
				$data['id_instansi']  = set_value('id_instansi',$d["id_instansi"]);
				$data['id_kompetensi']  = set_value('id_kompetensi',$d["id_kompetensi"]);
				$data['nama_kompetensi']  = set_value('nama_kompetensi',$d["nama_kompetensi"]);
				$data['kode_unit']  = set_value('kode_unit',$d["kode_unit"]);
				$data['nama_jabatan']  = set_value('nama_jabatan',$d["nama_jabatan"]);
				$data['instansi_3']	= $this->m_umum->ambil_data_result('kol_working','id_working',$d['id_instansi']);
				$this->tampil($data);
				$action = $this->input->post('action');
				if($action == 'BtnProses') {
		      $id   = $this->input->post('id');
		      $id2   = $this->input->post('id2');
					redirect(base_url('admin_kredensial/form3/seting/'.$data['id'].'/'.$id2));
				}
				if($action == 'BtnSimpan') {
		      $id   = $this->input->post('id');
		      $id2   = $this->input->post('id2');
					$this->m_admin_kredensial->simpan_nkr_formmetper_detil();
					$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
					redirect(base_url('admin_kredensial/form3/seting/'.$data['id'].'/'.$id2));
				} 
	  	}
      if($mode=='urutan'){
        $data['page'] =  $data['page']."_urutan";
				$kondisi=array('id_form_detil'=>$data['id']);
				$keuangan    = $this->m_umum->ambil_data_kondisi_2tabel_row('nkr_form_detil',$kondisi,'nkr_form','barcode_form');
				$data['no_urut_detil']  = set_value('no_urut_detil',$keuangan["no_urut_detil"]);
				$data['id_form_detil']  = set_value('id_form_detil',$keuangan["id_form_detil"]);
				$data['id_jenis_form']  = set_value('id_jenis_form',$keuangan["id_jenis_form"]);
				$data['barcode_form']  = set_value('barcode_form',$keuangan["barcode_form"]);
				$data['id_kompetensi']  = set_value('id_kompetensi',$keuangan["id_kompetensi"]);
				$data['id_instansi']  = set_value('id_instansi',$keuangan["id_instansi"]);
				$data['pembuat_form']  = set_value('pembuat_form',$keuangan["pembuat_form"]);
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_urutan'){
	    	$pembuat_form = $this->input->post('pembuat_form');
	    	$barcode_form = $this->input->post('barcode_form');
		    	if($this->session->id_pegawai == $pembuat_form){
					  if($this->m_admin_kredensial->edit_urutan_detil()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('admin_kredensial/form3/seting/'.$barcode_form));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('admin_kredensial/form3/seting/'.$barcode_form));
					  }
		    	}else{
							$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
							redirect(base_url('admin_kredensial/form3/seting/'.$barcode_form));    		
					}
      }
      if($mode=='metode'){
        $data['page'] =  $data['page']."_metode";
				$data['metode']	= $this->m_umum->ambil_data('nkr_metode');
				$d	= $this->m_umum->ambil_data('nkr_form_detil','id_form_detil',$data['id']);
				$data['id_form_detil']  = set_value('id_form_detil',$d["id_form_detil"]);
				$data['barcode_form_detil']  = set_value('barcode_form_detil',$d["barcode_form_detil"]);
				$data['metode_form_detil']  = set_value('metode_form_detil',$d["metode_form_detil"]);
				$data['perangkat_form_detil']  = set_value('perangkat_form_detil',$d["perangkat_form_detil"]);
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_metode'){
	      $id   = $this->input->post('id');
	      $id2   = $this->input->post('id2');
	      $id3   = $this->input->post('id3');
	      $id4   = $this->input->post('id4');
				$this->m_admin_kredensial->simpan_nkr_metode_form_detil();
				$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
				redirect(base_url('admin_kredensial/form3/seting/'.$id2.'/'.$id3.'/'.$id4));
      }
      if($mode=='perangkat'){
        $data['page'] =  $data['page']."_perangkat";
				$data['perangkat']	= $this->m_umum->ambil_data('nkr_perangkat');
				$d	= $this->m_umum->ambil_data('nkr_form_detil','id_form_detil',$data['id']);
				$data['id_form_detil']  = set_value('id_form_detil',$d["id_form_detil"]);
				$data['barcode_form_detil']  = set_value('barcode_form_detil',$d["barcode_form_detil"]);
				$data['metode_form_detil']  = set_value('metode_form_detil',$d["metode_form_detil"]);
				$data['perangkat_form_detil']  = set_value('perangkat_form_detil',$d["perangkat_form_detil"]);
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_perangkat'){
	      $id   = $this->input->post('id');
	      $id2   = $this->input->post('id2');
	      $id3   = $this->input->post('id3');
	      $id4   = $this->input->post('id4');
				$this->m_admin_kredensial->simpan_nkr_perangkat_form_detil();
				$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
				redirect(base_url('admin_kredensial/form3/seting/'.$id2.'/'.$id3.'/'.$id4));
      }
		}
  }
  function form4_addition($mode='view')
  {
	$data['page']  = "form4_addition";
	$data['header'] = "INDIKATOR UNJUK KERJA";
	$data['title'] = "INDIKATOR UNJUK KERJA";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',32);
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
		$data['id']   = $this->uri->segment(4, 0);
		if($mode=='view'){
			$data['instansi']	= $this->m_umum->ambil_data_explode('kol_working','id_working',$this->session->mas_ins);
			$data['jabatan']	= $this->m_umum->ambil_data_explode('jabatan','id_jabatan',$this->session->mas_kred);
			$data['metode']	= $this->m_umum->ambil_data('nkr_metode');
			$data['perangkat']	= $this->m_umum->ambil_data('nkr_perangkat');
			$this->tampil($data);
		}
    else if($mode=='data'){
			echo json_encode($this->m_admin_kredensial->indikator_all());
		}
		else{
			$data['cmd_asesmen']=$this->m_admin_kredensial->cmd_asesmen_aktif();
			$data['status']=$this->m_rancak->cmd_status();
			$keuangan    = $this->m_umum->ambil_data('nkr_indikator','id_indikator',$data['id']);
			$data['id_indikator']  = set_value('id_indikator',$keuangan["id_indikator"]);
			$data['poin_indikator']  = set_value('poin_indikator',$keuangan["poin_indikator"]);
			$data['pertanyaan_indikator']  = set_value('pertanyaan_indikator',$keuangan["pertanyaan_indikator"]);
			$data['ketercapaian_indikator']  = set_value('ketercapaian_indikator',$keuangan["ketercapaian_indikator"]);
   $data['dokumen_indikator']  = set_value('dokumen_indikator',$keuangan["dokumen_indikator"]);
			$data['jawaban_indikator']  = set_value('jawaban_indikator',$keuangan["jawaban_indikator"]);
			$data['pembuat_indikator']  = set_value('pembuat_indikator',$keuangan["pembuat_indikator"]);
			$data['jenis_soal']  = set_value('jenis_soal',$keuangan["jenis_soal"]);
      if($mode=='seting_jawaban'){
        $data['page'] =  $data['page']."_seting_jawaban";
				$data['cmd_status']    = array('0'=>'Non Aktif','1'=>'Aktif');
				$data['cmd_answer']    = array('0'=>'NOT','1'=>'ANSWER');
				$data['soal']    = $this->m_admin_kredensial->ambil_soal_opsi($data['id']);
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_seting_jawaban'){
	    	$pembuat_indikator = $this->input->post('pembuat_indikator');
	    	$id_indikator = $this->input->post('id_indikator');
		 		$kondisi=array('id_indikator'=>$id_indikator);
				$jml = $this->m_umum->jumlah_record_filter('nkr_validasi_detil',$kondisi);
//				if($jml == 0){
		    	if($this->session->id_pegawai == $pembuat_indikator){
					  	$this->m_admin_kredensial->simpan_opsi_soal();
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('admin_kredensial/form4_addition'));
		    	}else{
							$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
							redirect(base_url('admin_kredensial/form4_addition'));    		
					}
/*				}else{
					$this->session->set_flashdata('danger', 'Data Sudah Masuk Validasi');
					redirect(base_url('admin_kredensial/form4_addition')); 					
				}*/
      }
      if($mode=='rubah_opsi'){
        $data['page'] =  $data['page']."_rubah_opsi";
				$keuangan    = $this->m_umum->ambil_data('nkr_indikator','id_indikator',$data['id']);
				$data['opsi_soal']  = array('0'=>'Isian','1'=>'Pilihan','2'=>'Pilihan Berganda');
				$data['id_indikator']  = set_value('id_indikator',$keuangan["id_indikator"]);
				$data['nama_indikator']  = set_value('nama_indikator',$keuangan["nama_indikator"]);
				$data['id_asesmen']  = set_value('id_asesmen',$keuangan["id_asesmen"]);
				$data['jenis_soal']  = set_value('jenis_soal',$keuangan["jenis_soal"]);
				$data['pembuat_indikator']  = set_value('pembuat_indikator',$keuangan["pembuat_indikator"]);
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_rubah_opsi'){
	    	$pembuat_indikator = $this->input->post('pembuat_indikator');
	    	$id_indikator = $this->input->post('id_indikator');
		 		$kondisi=array('id_indikator'=>$id_indikator);
				$jml = $this->m_umum->jumlah_record_filter('nkr_validasi_detil',$kondisi);
//				if($jml == 0){
		    	if($this->session->id_pegawai == $pembuat_indikator){
					  if($this->m_admin_kredensial->edit_jenis_soal_nkr_indikator()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('admin_kredensial/form4_addition'));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('admin_kredensial/form4_addition'));
					  }
		    	}else{
							$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
							redirect(base_url('admin_kredensial/form4_addition'));    		
					}
/*				}else{
					$this->session->set_flashdata('danger', 'Data Sudah Masuk Validasi');
					redirect(base_url('admin_kredensial/form4_addition')); 					
				}*/
      }
      if($mode=='poin'){
        $data['page'] =  $data['page']."_poin";
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_poin'){
	    	$pembuat_indikator = $this->input->post('pembuat_indikator');
	    	$id_indikator = $this->input->post('id_indikator');
		 		$kondisi=array('id_indikator'=>$id_indikator);
				$jml = $this->m_umum->jumlah_record_filter('nkr_validasi_detil',$kondisi);
//				if($jml == 0){
		    	if($this->session->id_pegawai == $pembuat_indikator){
					  	$this->m_admin_kredensial->edit_poin();
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('admin_kredensial/form4_addition'));
		    	}else{
							$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
							redirect(base_url('admin_kredensial/form4_addition'));    		
					}
/*				}else{
					$this->session->set_flashdata('danger', 'Data Sudah Masuk Validasi');
					redirect(base_url('admin_kredensial/form4_addition')); 					
				}*/
      }
      if($mode=='ketercapaian'){
        $data['page'] =  $data['page']."_ketercapaian";
				    $this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_ketercapaian'){
	    	$pembuat_indikator = $this->input->post('pembuat_indikator');
	    	$id_indikator = $this->input->post('id_indikator');
		 		$kondisi=array('id_indikator'=>$id_indikator);
				$jml = $this->m_umum->jumlah_record_filter('nkr_validasi_detil',$kondisi);
//				if($jml == 0){
		    	if($this->session->id_pegawai == $pembuat_indikator){
					  	$this->m_admin_kredensial->edit_ketercapaian();
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('admin_kredensial/form4_addition'));
		    	}else{
							$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
							redirect(base_url('admin_kredensial/form4_addition'));    		
					}
/*				}else{
					$this->session->set_flashdata('danger', 'Data Sudah Masuk Validasi');
					redirect(base_url('admin_kredensial/form4_addition')); 					
				}*/
      }
      if($mode=='pertanyaan'){
        $data['page'] =  $data['page']."_pertanyaan";
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_pertanyaan'){
	    	$pembuat_indikator = $this->input->post('pembuat_indikator');
	    	$id_indikator = $this->input->post('id_indikator');
		 		$kondisi=array('id_indikator'=>$id_indikator);
				$jml = $this->m_umum->jumlah_record_filter('nkr_validasi_detil',$kondisi);
//				if($jml == 0){
		    	if($this->session->id_pegawai == $pembuat_indikator){
					  	$this->m_admin_kredensial->edit_pertanyaan();
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('admin_kredensial/form4_addition'));
		    	}else{
							$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
							redirect(base_url('admin_kredensial/form4_addition'));    		
					}
/*				}else{
					$this->session->set_flashdata('danger', 'Data Sudah Masuk Validasi');
					redirect(base_url('admin_kredensial/form4_addition')); 					
				}*/
      }
      if($mode=='dokumen'){
        $data['page'] =  $data['page']."_dokumen";
    $this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_dokumen'){
      $pembuat_indikator = $this->input->post('pembuat_indikator');
      $id_indikator = $this->input->post('id_indikator');
     $kondisi=array('id_indikator'=>$id_indikator);
    $jml = $this->m_umum->jumlah_record_filter('nkr_validasi_detil',$kondisi);
//    if($jml == 0){
       if($this->session->id_pegawai == $pembuat_indikator){
        $this->m_admin_kredensial->edit_dokumen();
       $this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
       redirect(base_url('admin_kredensial/form4_addition'));
       }else{
       $this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
       redirect(base_url('admin_kredensial/form4_addition'));      
     }
/*    }else{
     $this->session->set_flashdata('danger', 'Data Sudah Masuk Validasi');
     redirect(base_url('admin_kredensial/form4_addition'));      
    }*/
      }
      if($mode=='jawaban'){
        $data['page'] =  $data['page']."_jawaban";
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_jawaban'){
	    	$pembuat_indikator = $this->input->post('pembuat_indikator');
	    	$id_indikator = $this->input->post('id_indikator');
		 		$kondisi=array('id_indikator'=>$id_indikator);
				$jml = $this->m_umum->jumlah_record_filter('nkr_validasi_detil',$kondisi);
//				if($jml == 0){
		    	if($this->session->id_pegawai == $pembuat_indikator){
					  	$this->m_admin_kredensial->edit_jawaban();
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('admin_kredensial/form4_addition'));
		    	}else{
							$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
							redirect(base_url('admin_kredensial/form4_addition'));    		
					}
/*				}else{
					$this->session->set_flashdata('danger', 'Data Sudah Masuk Validasi');
					redirect(base_url('admin_kredensial/form4_addition')); 					
				}*/
      }
    if($mode=='pdf_iuk'){
        $report = $this->load->view('cetak/iuk', $data, TRUE);
        $filename = date('YmdHis')."-iuk.pdf";
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
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
  function form4($mode='view')
  {
	$data['page']  = "form4";
	$data['header'] = "SETING FORM 4A CEKLIS OBSERVASI PER INSTANSI DAN PER JABATAN";
	$data['title'] = "SETING FORM 4A CEKLIS OBSERVASI PER INSTANSI DAN PER JABATAN";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',32);
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
		$data['id']   = $this->uri->segment(4, 0);
		$data['id2']   = $this->uri->segment(5, 0);
		$data['id3']   = $this->uri->segment(6, 0);
		$data['id4']   = $this->uri->segment(7, 0);
		if($mode=='view'){
			$this->tampil($data);
		}
    else if($mode=='data'){
			echo json_encode($this->m_admin_kredensial->form_all(4));
		}
    else if($mode=='detil'){
			echo json_encode($this->m_admin_kredensial->form_indikator_detil($data['id']));
		}
  else if($mode=='hapus_form'){
    $kondisi=array('pembuat_form'=>$this->session->id_pegawai,'id_form'=>$data['id']);
    $jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
    $kondisi2=array('barcode_form'=>$data['id2']);
    $jml2 = $this->m_umum->jumlah_record_filter('nkr_form_detil',$kondisi2);
    if($jml == 0){
        $this->session->set_flashdata('danger', 'Hanya Dapat Menghapus Data Sendiri');
        redirect(base_url('admin_kredensial/'.$data['page']));
    }else{
      if($jml2 == 0){
        if($this->m_umum->hapus_data('nkr_form','id_form',$data['id'])){
            $this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
            redirect(base_url('admin_kredensial/'.$data['page']));
          }else{
            $this->session->set_flashdata('danger', 'Masalah Hapus Data');
            redirect(base_url('admin_kredensial/'.$data['page']));
          }
      }else{
        $this->session->set_flashdata('danger', 'Hapus Dahulu Data Di Dalamnya');
        redirect(base_url('admin_kredensial/'.$data['page']));        
      }
    }
  }
    else if($mode=='hapus'){
      $kondisi=array('pembuat_form'=>$this->session->id_pegawai,'id_form_detil'=>$data['id2']);
      $jml = $this->m_umum->jumlah_record_tabel_pengajuan('nkr_form_detil',$kondisi,'nkr_form','barcode_form');
 /*     $kondisi2=array('id_asesmen'=>$data['id']);
      $jml2 = $this->m_umum->jumlah_record_filter('nkr_question_f2',$kondisi2);
      if($jml == 0){
          $this->session->set_flashdata('danger', 'Hanya Dapat Menghapus Data Sendiri');
          redirect(base_url('admin_kredensial/asesmen'));
      }else{*/
        if($jml2 == 0){
          if($this->m_umum->hapus_data('nkr_form_detil','id_form_detil',$data['id2'])){
              $this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
              redirect(base_url('admin_kredensial/form4/seting/'.$data['id']));
            }else{
              $this->session->set_flashdata('danger', 'Masalah Hapus Data');
              redirect(base_url('admin_kredensial/form4/seting/'.$data['id']));
            }
        }else{
          $this->session->set_flashdata('danger', 'Data Sudah Masuk Question');
          redirect(base_url('admin_kredensial/form4/seting/'.$data['id']));        
        }
  /*    }*/
    }
		else{
			$data['working']=$this->m_admin_kredensial->ambil_data_rujukan_working();
			$data['status']=$this->m_rancak->cmd_status();
			$data['cmd_kompetensi_in']=$this->m_admin_kredensial->cmd_kompetensi_in($this->session->mas_kred);
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['id_kompetensi']  = set_value('id_kompetensi',$this->input->post('id_kompetensi'));
				$data['id_instansi']  = set_value('id_instansi',$this->input->post('id_instansi'));
				$data['nama_form']  = set_value('nama_form',$this->input->post('nama_form'));
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_tambah'){
      	$id_jenis_form = $this->input->post('id_jenis_form');
      	$id_kompetensi = $this->input->post('id_kompetensi');
      	$id_instansi = $this->input->post('id_instansi');
		 		$kondisi=array('id_instansi'=>$id_instansi,'id_kompetensi'=>$id_kompetensi,'id_jenis_form'=>$id_jenis_form);
				$jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
//				if($jml == 0){
				  if($this->m_admin_kredensial->simpan_nkr_form()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('admin_kredensial/form4'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
						redirect(base_url('admin_kredensial/form4'));
				  }
/*				}else{
					$this->session->set_flashdata('danger', 'Data Sudah Ada');
					redirect(base_url('admin_kredensial/form4'));				
				}*/
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('nkr_form','id_form',$data['id']);
				$data['id_form']  = set_value('id_form',$keuangan["id_form"]);
				$data['id_jenis_form']  = set_value('id_jenis_form',$keuangan["id_jenis_form"]);
				$data['barcode_form']  = set_value('barcode_form',$keuangan["barcode_form"]);
				$data['id_kompetensi']  = set_value('id_kompetensi',$keuangan["id_kompetensi"]);
				$data['id_instansi']  = set_value('id_instansi',$keuangan["id_instansi"]);
				$data['pembuat_form']  = set_value('pembuat_form',$keuangan["pembuat_form"]);
				$data['nama_form']  = set_value('nama_form',$keuangan["nama_form"]);
				$data['status_form']  = set_value('status_form',$keuangan["status_form"]);
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_edit'){
	    	$pembuat_form = $this->input->post('pembuat_form');
	    	$id_jenis_form = $this->input->post('id_jenis_form');
      	$id_kompetensi = $this->input->post('id_kompetensi');
      	$id_instansi = $this->input->post('id_instansi');
		 		$kondisi=array('id_instansi'=>$id_instansi,'id_kompetensi'=>$id_kompetensi,'id_jenis_form'=>$id_jenis_form);
				$jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
//				if($jml == 0){
		    	if($this->session->id_pegawai == $pembuat_form){
					  if($this->m_admin_kredensial->edit_nkr_form()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('admin_kredensial/form4'));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('admin_kredensial/form4'));
					  }
		    	}else{
							$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
							redirect(base_url('admin_kredensial/form4'));    		
					}
/*				}else{
					$this->session->set_flashdata('danger', 'Data Sudah Ada');
					redirect(base_url('admin_kredensial/form4')); 					
				}*/
      }
      if($mode=='seting'){
        $data['page'] =  $data['page']."_seting";
		 		$kondisi=array('barcode_form'=>$data['id']);
				$jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
				if($jml == 0){
						$this->session->set_flashdata('danger', 'Data Tidak Valid');
						redirect(base_url('admin_kredensial/form4'));
				}
				$data['nkr_asesmen']	= $this->m_admin_kredensial->ambil_nkr_indikator_form4($data['id2'],$data['id3'],'nin.poin_indikator');
				$data['cmd_elemen']	= $this->m_admin_kredensial->cmd_elemen_jabatan();
				$data['cmd_jabatan']	= $this->m_admin_kredensial->cmd_jabatan();
				$d	= $this->m_admin_kredensial->ambil_nkr_form($data['id']);
				$data['id_form']  = set_value('id_form',$d["id_form"]);
				$data['barcode_form']  = set_value('barcode_form',$d["barcode_form"]);
				$data['nama_kompetensi']  = set_value('nama_kompetensi',$d["nama_kompetensi"]);
				$data['kode_unit']  = set_value('kode_unit',$d["kode_unit"]);
				$data['nama_jabatan']  = set_value('nama_jabatan',$d["nama_jabatan"]);
				$this->tampil($data);
				$action = $this->input->post('action');
				if($action == 'BtnProses') {
		      $id   = $this->input->post('id');
		      $id2   = $this->input->post('id2');
		      $id3   = $this->input->post('id3');
					redirect(base_url('admin_kredensial/form4/seting/'.$data['id'].'/'.$id2.'/'.$id3));
				}
				if($action == 'BtnSimpan') {
		      $id   = $this->input->post('id');
		      $id2   = $this->input->post('id2');
		      $id3   = $this->input->post('id3');
		      $id4   = $this->input->post('id4');
					$this->m_admin_kredensial->simpan_nkr_formmetper_detil();
					$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
					redirect(base_url('admin_kredensial/form4/seting/'.$data['id'].'/'.$id2.'/'.$id3));
				} 
	  	}
      if($mode=='urutan'){
        $data['page'] =  $data['page']."_urutan";
				$kondisi=array('id_form_detil'=>$data['id']);
				$keuangan    = $this->m_umum->ambil_data_kondisi_2tabel_row('nkr_form_detil',$kondisi,'nkr_form','barcode_form');
				$data['no_urut_detil']  = set_value('no_urut_detil',$keuangan["no_urut_detil"]);
				$data['id_form_detil']  = set_value('id_form_detil',$keuangan["id_form_detil"]);
				$data['id_jenis_form']  = set_value('id_jenis_form',$keuangan["id_jenis_form"]);
				$data['barcode_form']  = set_value('barcode_form',$keuangan["barcode_form"]);
				$data['id_kompetensi']  = set_value('id_kompetensi',$keuangan["id_kompetensi"]);
				$data['id_instansi']  = set_value('id_instansi',$keuangan["id_instansi"]);
				$data['pembuat_form']  = set_value('pembuat_form',$keuangan["pembuat_form"]);
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_urutan'){
	    	$pembuat_form = $this->input->post('pembuat_form');
	    	$barcode_form = $this->input->post('barcode_form');
		    	if($this->session->id_pegawai == $pembuat_form){
					  if($this->m_admin_kredensial->edit_urutan_detil()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('admin_kredensial/form4/seting/'.$barcode_form));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('admin_kredensial/form4/seting/'.$barcode_form));
					  }
		    	}else{
							$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
							redirect(base_url('admin_kredensial/form4/seting/'.$barcode_form));    		
					}
      }
		}
  }
  function form4b($mode='view')
  {
	$data['page']  = "form4b";
	$data['header'] = "SETING FORM 4B CEKLIS LISAN PER INSTANSI DAN PER JABATAN";
	$data['title'] = "SETING FORM 4B CEKLIS LISAN PER INSTANSI DAN PER JABATAN";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',32);
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
		$data['id']   = $this->uri->segment(4, 0);
		$data['id2']   = $this->uri->segment(5, 0);
		$data['id3']   = $this->uri->segment(6, 0);
		$data['id4']   = $this->uri->segment(7, 0);
		if($mode=='view'){
			$this->tampil($data);
		}
    else if($mode=='data'){
			echo json_encode($this->m_admin_kredensial->form_all(5));
		}
    else if($mode=='detil'){
			echo json_encode($this->m_admin_kredensial->form_indikator_detil($data['id']));
		}
  else if($mode=='hapus_form'){
    $kondisi=array('pembuat_form'=>$this->session->id_pegawai,'id_form'=>$data['id']);
    $jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
    $kondisi2=array('barcode_form'=>$data['id2']);
    $jml2 = $this->m_umum->jumlah_record_filter('nkr_form_detil',$kondisi2);
    if($jml == 0){
        $this->session->set_flashdata('danger', 'Hanya Dapat Menghapus Data Sendiri');
        redirect(base_url('admin_kredensial/'.$data['page']));
    }else{
      if($jml2 == 0){
        if($this->m_umum->hapus_data('nkr_form','id_form',$data['id'])){
            $this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
            redirect(base_url('admin_kredensial/'.$data['page']));
          }else{
            $this->session->set_flashdata('danger', 'Masalah Hapus Data');
            redirect(base_url('admin_kredensial/'.$data['page']));
          }
      }else{
        $this->session->set_flashdata('danger', 'Hapus Dahulu Data Di Dalamnya');
        redirect(base_url('admin_kredensial/'.$data['page']));        
      }
    }
  }
    else if($mode=='hapus'){
      $kondisi=array('pembuat_form'=>$this->session->id_pegawai,'id_form_detil'=>$data['id2']);
      $jml = $this->m_umum->jumlah_record_tabel_pengajuan('nkr_form_detil',$kondisi,'nkr_form','barcode_form');
 /*     $kondisi2=array('id_asesmen'=>$data['id']);
      $jml2 = $this->m_umum->jumlah_record_filter('nkr_question_f2',$kondisi2);
      if($jml == 0){
          $this->session->set_flashdata('danger', 'Hanya Dapat Menghapus Data Sendiri');
          redirect(base_url('admin_kredensial/asesmen'));
      }else{*/
        if($jml2 == 0){
          if($this->m_umum->hapus_data('nkr_form_detil','id_form_detil',$data['id2'])){
              $this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
              redirect(base_url('admin_kredensial/form4b/seting/'.$data['id']));
            }else{
              $this->session->set_flashdata('danger', 'Masalah Hapus Data');
              redirect(base_url('admin_kredensial/form4b/seting/'.$data['id']));
            }
        }else{
          $this->session->set_flashdata('danger', 'Data Sudah Masuk Question');
          redirect(base_url('admin_kredensial/form4b/seting/'.$data['id']));        
        }
  /*    }*/
    }
		else{
			$data['working']=$this->m_admin_kredensial->ambil_data_rujukan_working();
			$data['status']=$this->m_rancak->cmd_status();
			$data['cmd_kompetensi_in']=$this->m_admin_kredensial->cmd_kompetensi_in($this->session->mas_kred);
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['id_kompetensi']  = set_value('id_kompetensi',$this->input->post('id_kompetensi'));
				$data['id_instansi']  = set_value('id_instansi',$this->input->post('id_instansi'));
				$data['nama_form']  = set_value('nama_form',$this->input->post('nama_form'));
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_tambah'){
      	$id_jenis_form = $this->input->post('id_jenis_form');
      	$id_kompetensi = $this->input->post('id_kompetensi');
      	$id_instansi = $this->input->post('id_instansi');
		 		$kondisi=array('id_instansi'=>$id_instansi,'id_kompetensi'=>$id_kompetensi,'id_jenis_form'=>$id_jenis_form);
				$jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
//				if($jml == 0){
				  if($this->m_admin_kredensial->simpan_nkr_form()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('admin_kredensial/form4b'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
						redirect(base_url('admin_kredensial/form4b'));
				  }
/*				}else{
					$this->session->set_flashdata('danger', 'Data Sudah Ada');
					redirect(base_url('admin_kredensial/form4b'));				
				}*/
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('nkr_form','id_form',$data['id']);
				$data['id_form']  = set_value('id_form',$keuangan["id_form"]);
				$data['id_jenis_form']  = set_value('id_jenis_form',$keuangan["id_jenis_form"]);
				$data['barcode_form']  = set_value('barcode_form',$keuangan["barcode_form"]);
				$data['id_kompetensi']  = set_value('id_kompetensi',$keuangan["id_kompetensi"]);
				$data['id_instansi']  = set_value('id_instansi',$keuangan["id_instansi"]);
				$data['pembuat_form']  = set_value('pembuat_form',$keuangan["pembuat_form"]);
				$data['nama_form']  = set_value('nama_form',$keuangan["nama_form"]);
				$data['status_form']  = set_value('status_form',$keuangan["status_form"]);
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_edit'){
	    	$pembuat_form = $this->input->post('pembuat_form');
	    	$id_jenis_form = $this->input->post('id_jenis_form');
      	$id_kompetensi = $this->input->post('id_kompetensi');
      	$id_instansi = $this->input->post('id_instansi');
		 		$kondisi=array('id_instansi'=>$id_instansi,'id_kompetensi'=>$id_kompetensi,'id_jenis_form'=>$id_jenis_form);
				$jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
//				if($jml == 0){
		    	if($this->session->id_pegawai == $pembuat_form){
					  if($this->m_admin_kredensial->edit_nkr_form()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('admin_kredensial/form4b'));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('admin_kredensial/form4b'));
					  }
		    	}else{
							$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
							redirect(base_url('admin_kredensial/form4b'));    		
					}
/*				}else{
					$this->session->set_flashdata('danger', 'Data Sudah Ada');
					redirect(base_url('admin_kredensial/form4b')); 					
				}*/
      }
      if($mode=='seting'){
        $data['page'] =  $data['page']."_seting";
		 		$kondisi=array('barcode_form'=>$data['id']);
				$jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
				if($jml == 0){
						$this->session->set_flashdata('danger', 'Data Tidak Valid');
						redirect(base_url('admin_kredensial/form4b'));
				}
				$data['nkr_asesmen']	= $this->m_admin_kredensial->ambil_nkr_indikator_form4($data['id2'],$data['id3'],'nin.ketercapaian_indikator');
				$data['cmd_elemen']	= $this->m_admin_kredensial->cmd_elemen_jabatan();
				$data['cmd_jabatan']	= $this->m_admin_kredensial->cmd_jabatan();
				$d	= $this->m_admin_kredensial->ambil_nkr_form($data['id']);
				$data['id_form']  = set_value('id_form',$d["id_form"]);
				$data['barcode_form']  = set_value('barcode_form',$d["barcode_form"]);
				$data['nama_kompetensi']  = set_value('nama_kompetensi',$d["nama_kompetensi"]);
				$data['kode_unit']  = set_value('kode_unit',$d["kode_unit"]);
				$data['nama_jabatan']  = set_value('nama_jabatan',$d["nama_jabatan"]);
				$this->tampil($data);
				$action = $this->input->post('action');
				if($action == 'BtnProses') {
		      $id   = $this->input->post('id');
		      $id2   = $this->input->post('id2');
		      $id3   = $this->input->post('id3');
					redirect(base_url('admin_kredensial/form4b/seting/'.$data['id'].'/'.$id2.'/'.$id3));
				}
				if($action == 'BtnSimpan') {
		      $id   = $this->input->post('id');
		      $id2   = $this->input->post('id2');
		      $id3   = $this->input->post('id3');
		      $id4   = $this->input->post('id4');
					$this->m_admin_kredensial->simpan_nkr_formmetper_detil();
					$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
					redirect(base_url('admin_kredensial/form4b/seting/'.$data['id'].'/'.$id2.'/'.$id3));
				} 
	  	}
      if($mode=='urutan'){
        $data['page'] =  $data['page']."_urutan";
				$kondisi=array('id_form_detil'=>$data['id']);
				$keuangan    = $this->m_umum->ambil_data_kondisi_2tabel_row('nkr_form_detil',$kondisi,'nkr_form','barcode_form');
				$data['no_urut_detil']  = set_value('no_urut_detil',$keuangan["no_urut_detil"]);
				$data['id_form_detil']  = set_value('id_form_detil',$keuangan["id_form_detil"]);
				$data['id_jenis_form']  = set_value('id_jenis_form',$keuangan["id_jenis_form"]);
				$data['barcode_form']  = set_value('barcode_form',$keuangan["barcode_form"]);
				$data['id_kompetensi']  = set_value('id_kompetensi',$keuangan["id_kompetensi"]);
				$data['id_instansi']  = set_value('id_instansi',$keuangan["id_instansi"]);
				$data['pembuat_form']  = set_value('pembuat_form',$keuangan["pembuat_form"]);
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_urutan'){
	    	$pembuat_form = $this->input->post('pembuat_form');
	    	$barcode_form = $this->input->post('barcode_form');
		    	if($this->session->id_pegawai == $pembuat_form){
					  if($this->m_admin_kredensial->edit_urutan_detil()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('admin_kredensial/form4b/seting/'.$barcode_form));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('admin_kredensial/form4b/seting/'.$barcode_form));
					  }
		    	}else{
							$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
							redirect(base_url('admin_kredensial/form4b/seting/'.$barcode_form));    		
					}
      }
		}
  }
  function form4c($mode='view')
  {
	$data['page']  = "form4c";
	$data['header'] = "SETING FORM 4C CEKLIS TULIS PER INSTANSI DAN PER JABATAN";
	$data['title'] = "SETING FORM 4C CEKLIS TULIS PER INSTANSI DAN PER JABATAN";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',10);
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
		$data['id']   = $this->uri->segment(4, 0);
		$data['id2']   = $this->uri->segment(5, 0);
		$data['id3']   = $this->uri->segment(6, 0);
		$data['id4']   = $this->uri->segment(7, 0);
		if($mode=='view'){
			$this->tampil($data);
		}
    else if($mode=='data'){
			echo json_encode($this->m_admin_kredensial->form_all(6));
		}
    else if($mode=='detil'){
			echo json_encode($this->m_admin_kredensial->form_indikator_detil($data['id']));
		}
  else if($mode=='hapus_form'){
    $kondisi=array('pembuat_form'=>$this->session->id_pegawai,'id_form'=>$data['id']);
    $jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
    $kondisi2=array('barcode_form'=>$data['id2']);
    $jml2 = $this->m_umum->jumlah_record_filter('nkr_form_detil',$kondisi2);
    if($jml == 0){
        $this->session->set_flashdata('danger', 'Hanya Dapat Menghapus Data Sendiri');
        redirect(base_url('admin_kredensial/'.$data['page']));
    }else{
      if($jml2 == 0){
        if($this->m_umum->hapus_data('nkr_form','id_form',$data['id'])){
            $this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
            redirect(base_url('admin_kredensial/'.$data['page']));
          }else{
            $this->session->set_flashdata('danger', 'Masalah Hapus Data');
            redirect(base_url('admin_kredensial/'.$data['page']));
          }
      }else{
        $this->session->set_flashdata('danger', 'Hapus Dahulu Data Di Dalamnya');
        redirect(base_url('admin_kredensial/'.$data['page']));        
      }
    }
  }
  else if($mode=='hapus'){
    $kondisi=array('pembuat_form'=>$this->session->id_pegawai,'id_form_detil'=>$data['id2']);
    $jml = $this->m_umum->jumlah_record_tabel_pengajuan('nkr_form_detil',$kondisi,'nkr_form','barcode_form');
/*     $kondisi2=array('id_asesmen'=>$data['id']);
    $jml2 = $this->m_umum->jumlah_record_filter('nkr_question_f2',$kondisi2);
    if($jml == 0){
        $this->session->set_flashdata('danger', 'Hanya Dapat Menghapus Data Sendiri');
        redirect(base_url('admin_kredensial/asesmen'));
    }else{*/
      if($jml2 == 0){
        if($this->m_umum->hapus_data('nkr_form_detil','id_form_detil',$data['id2'])){
            $this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
            redirect(base_url('admin_kredensial/form4c/seting/'.$data['id']));
          }else{
            $this->session->set_flashdata('danger', 'Masalah Hapus Data');
            redirect(base_url('admin_kredensial/form4c/seting/'.$data['id']));
          }
      }else{
        $this->session->set_flashdata('danger', 'Data Sudah Masuk Question');
        redirect(base_url('admin_kredensial/form4c/seting/'.$data['id']));        
      }
/*    }*/
  }
		else{
			$data['working']=$this->m_admin_kredensial->ambil_data_rujukan_working();
			$data['status']=$this->m_rancak->cmd_status();
			$data['cmd_kompetensi_in']=$this->m_admin_kredensial->cmd_kompetensi_in($this->session->mas_kred);
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['id_kompetensi']  = set_value('id_kompetensi',$this->input->post('id_kompetensi'));
				$data['id_instansi']  = set_value('id_instansi',$this->input->post('id_instansi'));
				$data['nama_form']  = set_value('nama_form',$this->input->post('nama_form'));
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_tambah'){
      	$id_jenis_form = $this->input->post('id_jenis_form');
      	$id_kompetensi = $this->input->post('id_kompetensi');
      	$id_instansi = $this->input->post('id_instansi');
		 		$kondisi=array('id_instansi'=>$id_instansi,'id_kompetensi'=>$id_kompetensi,'id_jenis_form'=>$id_jenis_form);
				$jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
//				if($jml == 0){
				  if($this->m_admin_kredensial->simpan_nkr_form()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('admin_kredensial/form4c'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
						redirect(base_url('admin_kredensial/form4c'));
				  }
/*				}else{
					$this->session->set_flashdata('danger', 'Data Sudah Ada');
					redirect(base_url('admin_kredensial/form4c'));				
				}*/
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('nkr_form','id_form',$data['id']);
				$data['id_form']  = set_value('id_form',$keuangan["id_form"]);
				$data['id_jenis_form']  = set_value('id_jenis_form',$keuangan["id_jenis_form"]);
				$data['barcode_form']  = set_value('barcode_form',$keuangan["barcode_form"]);
				$data['id_kompetensi']  = set_value('id_kompetensi',$keuangan["id_kompetensi"]);
				$data['id_instansi']  = set_value('id_instansi',$keuangan["id_instansi"]);
				$data['pembuat_form']  = set_value('pembuat_form',$keuangan["pembuat_form"]);
				$data['nama_form']  = set_value('nama_form',$keuangan["nama_form"]);
				$data['status_form']  = set_value('status_form',$keuangan["status_form"]);
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_edit'){
	    	$pembuat_form = $this->input->post('pembuat_form');
	    	$id_jenis_form = $this->input->post('id_jenis_form');
      	$id_kompetensi = $this->input->post('id_kompetensi');
      	$id_instansi = $this->input->post('id_instansi');
		 		$kondisi=array('id_instansi'=>$id_instansi,'id_kompetensi'=>$id_kompetensi,'id_jenis_form'=>$id_jenis_form);
				$jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
//				if($jml == 0){
		    	if($this->session->id_pegawai == $pembuat_form){
					  if($this->m_admin_kredensial->edit_nkr_form()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('admin_kredensial/form4c'));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('admin_kredensial/form4c'));
					  }
		    	}else{
							$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
							redirect(base_url('admin_kredensial/form4c'));    		
					}
/*				}else{
					$this->session->set_flashdata('danger', 'Data Sudah Ada');
					redirect(base_url('admin_kredensial/form4c')); 					
				}*/
      }
      if($mode=='seting'){
        $data['page'] =  $data['page']."_seting";
		 		$kondisi=array('barcode_form'=>$data['id']);
				$jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
				if($jml == 0){
						$this->session->set_flashdata('danger', 'Data Tidak Valid');
						redirect(base_url('admin_kredensial/form4c'));
				}
				$data['nkr_asesmen']	= $this->m_admin_kredensial->ambil_nkr_indikator_form4($data['id2'],$data['id3'],'nin.jawaban_indikator');
				$data['cmd_elemen']	= $this->m_admin_kredensial->cmd_elemen_jabatan();
				$data['cmd_jabatan']	= $this->m_admin_kredensial->cmd_jabatan();
				$d	= $this->m_admin_kredensial->ambil_nkr_form($data['id']);
				$data['id_form']  = set_value('id_form',$d["id_form"]);
				$data['barcode_form']  = set_value('barcode_form',$d["barcode_form"]);
				$data['nama_kompetensi']  = set_value('nama_kompetensi',$d["nama_kompetensi"]);
				$data['kode_unit']  = set_value('kode_unit',$d["kode_unit"]);
				$data['nama_jabatan']  = set_value('nama_jabatan',$d["nama_jabatan"]);
				$this->tampil($data);
				$action = $this->input->post('action');
				if($action == 'BtnProses') {
		      $id   = $this->input->post('id');
		      $id2   = $this->input->post('id2');
		      $id3   = $this->input->post('id3');
					redirect(base_url('admin_kredensial/form4c/seting/'.$data['id'].'/'.$id2.'/'.$id3));
				}
				if($action == 'BtnSimpan') {
		      $id   = $this->input->post('id');
		      $id2   = $this->input->post('id2');
		      $id3   = $this->input->post('id3');
		      $id4   = $this->input->post('id4');
					$this->m_admin_kredensial->simpan_nkr_formmetper_detil();
					$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
					redirect(base_url('admin_kredensial/form4c/seting/'.$data['id'].'/'.$id2.'/'.$id3));
				} 
	  	}
      if($mode=='urutan'){
        $data['page'] =  $data['page']."_urutan";
				$kondisi=array('id_form_detil'=>$data['id']);
				$keuangan    = $this->m_umum->ambil_data_kondisi_2tabel_row('nkr_form_detil',$kondisi,'nkr_form','barcode_form');
				$data['no_urut_detil']  = set_value('no_urut_detil',$keuangan["no_urut_detil"]);
				$data['id_form_detil']  = set_value('id_form_detil',$keuangan["id_form_detil"]);
				$data['id_jenis_form']  = set_value('id_jenis_form',$keuangan["id_jenis_form"]);
				$data['barcode_form']  = set_value('barcode_form',$keuangan["barcode_form"]);
				$data['id_kompetensi']  = set_value('id_kompetensi',$keuangan["id_kompetensi"]);
				$data['id_instansi']  = set_value('id_instansi',$keuangan["id_instansi"]);
				$data['pembuat_form']  = set_value('pembuat_form',$keuangan["pembuat_form"]);
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_urutan'){
	    	$pembuat_form = $this->input->post('pembuat_form');
	    	$barcode_form = $this->input->post('barcode_form');
		    	if($this->session->id_pegawai == $pembuat_form){
					  if($this->m_admin_kredensial->edit_urutan_detil()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('admin_kredensial/form4c/seting/'.$barcode_form));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('admin_kredensial/form4c/seting/'.$barcode_form));
					  }
		    	}else{
							$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
							redirect(base_url('admin_kredensial/form4c/seting/'.$barcode_form));    		
					}
      }
		}
  }
  function form4d($mode='view')
  {
	$data['page']  = "form4d";
	$data['header'] = "INPUT FORM 4D UNTUK MENGAKTIFKAN SAAT PENGUJIAN KOMPETENSI";
	$data['title'] = "INPUT FORM 4D UNTUK MENGAKTIFKAN SAAT PENGUJIAN KOMPETENSI - CEKLIS PORTOFOLIO";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',32);
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
		$data['id']   = $this->uri->segment(4, 0);
  $data['id2']   = $this->uri->segment(5, 0);
  $data['id3']   = $this->uri->segment(6, 0);
  $data['id4']   = $this->uri->segment(7, 0);
		if($mode=='view'){
			$this->tampil($data);
		}
    else if($mode=='data'){
			echo json_encode($this->m_admin_kredensial->form_all(7));
		}
    else if($mode=='detil'){
   echo json_encode($this->m_admin_kredensial->form_indikator_detil($data['id']));
  }
  else if($mode=='hapus_form'){
    $kondisi=array('pembuat_form'=>$this->session->id_pegawai,'id_form'=>$data['id']);
    $jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
    $kondisi2=array('barcode_form'=>$data['id2']);
    $jml2 = $this->m_umum->jumlah_record_filter('nkr_form_detil',$kondisi2);
    if($jml == 0){
        $this->session->set_flashdata('danger', 'Hanya Dapat Menghapus Data Sendiri');
        redirect(base_url('admin_kredensial/'.$data['page']));
    }else{
  //    if($jml2 == 0){
        if($this->m_umum->hapus_data('nkr_form','id_form',$data['id'])){
            $this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
            redirect(base_url('admin_kredensial/'.$data['page']));
          }else{
            $this->session->set_flashdata('danger', 'Masalah Hapus Data');
            redirect(base_url('admin_kredensial/'.$data['page']));
          }
/*      }else{
        $this->session->set_flashdata('danger', 'Hapus Dahulu Data Di Dalamnya');
        redirect(base_url('admin_kredensial/'.$data['page']));        
      }*/
    }
  }
		else{
			$data['working']=$this->m_admin_kredensial->ambil_data_rujukan_working();
			$data['status']=$this->m_rancak->cmd_status();
			$data['cmd_kompetensi_in']=$this->m_admin_kredensial->cmd_kompetensi_in($this->session->mas_kred);
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['id_kompetensi']  = set_value('id_kompetensi',$this->input->post('id_kompetensi'));
				$data['id_instansi']  = set_value('id_instansi',$this->input->post('id_instansi'));
				$data['nama_form']  = set_value('nama_form',$this->input->post('nama_form'));
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_tambah'){
      	$id_jenis_form = $this->input->post('id_jenis_form');
      	$id_kompetensi = $this->input->post('id_kompetensi');
      	$id_instansi = $this->input->post('id_instansi');
		 		$kondisi=array('id_instansi'=>$id_instansi,'id_kompetensi'=>$id_kompetensi,'id_jenis_form'=>$id_jenis_form);
				$jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
	//			if($jml == 0){
				  if($this->m_admin_kredensial->simpan_nkr_form()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('admin_kredensial/form4d'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
						redirect(base_url('admin_kredensial/form4d'));
				  }
/*				}else{
					$this->session->set_flashdata('danger', 'Data Sudah Ada');
					redirect(base_url('admin_kredensial/form4d'));				
				}*/
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('nkr_form','id_form',$data['id']);
				$data['id_form']  = set_value('id_form',$keuangan["id_form"]);
				$data['barcode_form']  = set_value('barcode_form',$keuangan["barcode_form"]);
				$data['id_kompetensi']  = set_value('id_kompetensi',$keuangan["id_kompetensi"]);
				$data['id_instansi']  = set_value('id_instansi',$keuangan["id_instansi"]);
				$data['id_jenis_form']  = set_value('id_jenis_form',$keuangan["id_jenis_form"]);
				$data['pembuat_form']  = set_value('pembuat_form',$keuangan["pembuat_form"]);
				$data['nama_form']  = set_value('nama_form',$keuangan["nama_form"]);
				$data['status_form']  = set_value('status_form',$keuangan["status_form"]);
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_edit'){
	    	$pembuat_form = $this->input->post('pembuat_form');
	    	$id_jenis_form = $this->input->post('id_jenis_form');
      	$id_kompetensi = $this->input->post('id_kompetensi');
      	$id_instansi = $this->input->post('id_instansi');
		 		$kondisi=array('id_instansi'=>$id_instansi,'id_kompetensi'=>$id_kompetensi,'id_jenis_form'=>$id_jenis_form);
				$jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
//				if($jml == 0){
		    	if($this->session->id_pegawai == $pembuat_form){
					  if($this->m_admin_kredensial->edit_nkr_form()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('admin_kredensial/form4d'));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('admin_kredensial/form4d'));
					  }
		    	}else{
							$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
							redirect(base_url('admin_kredensial/form4d'));    		
					}
/*				}else{
					$this->session->set_flashdata('danger', 'Data Sudah Ada');
					redirect(base_url('admin_kredensial/form4d')); 					
				}*/
      }
      if($mode=='seting'){
        $data['page'] =  $data['page']."_seting";
     $kondisi=array('barcode_form'=>$data['id']);
    $jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
    if($jml == 0){
      $this->session->set_flashdata('danger', 'Data Tidak Valid');
      redirect(base_url('admin_kredensial/form4d'));
    }
    $data['nkr_asesmen'] = $this->m_admin_kredensial->ambil_nkr_indikator_form4($data['id2'],$data['id3'],'nin.dokumen_indikator');
    $data['cmd_elemen'] = $this->m_admin_kredensial->cmd_elemen_jabatan();
    $data['cmd_jabatan'] = $this->m_admin_kredensial->cmd_jabatan();
    $d = $this->m_admin_kredensial->ambil_nkr_form($data['id']);
    $data['id_form']  = set_value('id_form',$d["id_form"]);
    $data['barcode_form']  = set_value('barcode_form',$d["barcode_form"]);
    $data['nama_kompetensi']  = set_value('nama_kompetensi',$d["nama_kompetensi"]);
    $data['kode_unit']  = set_value('kode_unit',$d["kode_unit"]);
    $data['nama_jabatan']  = set_value('nama_jabatan',$d["nama_jabatan"]);
    $this->tampil($data);
    $action = $this->input->post('action');
    if($action == 'BtnProses') {
        $id   = $this->input->post('id');
        $id2   = $this->input->post('id2');
        $id3   = $this->input->post('id3');
     redirect(base_url('admin_kredensial/form4d/seting/'.$data['id'].'/'.$id2.'/'.$id3));
    }
    if($action == 'BtnSimpan') {
        $id   = $this->input->post('id');
        $id2   = $this->input->post('id2');
        $id3   = $this->input->post('id3');
        $id4   = $this->input->post('id4');
     $this->m_admin_kredensial->simpan_nkr_formmetper_detil();
     $this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
     redirect(base_url('admin_kredensial/form4d/seting/'.$data['id'].'/'.$id2.'/'.$id3));
    } 
    }
		}
  }
  function langkah($mode='view')
  {
	$data['page']  = "langkah";
	$data['header'] = "KOMPONEN LANGKAH FORM 5 DAN 6";
	$data['title'] = "KOMPONEN LANGKAH FORM 5 DAN 6";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',32);
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
		$data['id']   = $this->uri->segment(4, 0);
		if($mode=='view'){
			$this->tampil($data);
		}
    else if($mode=='data'){
			echo json_encode($this->m_admin_kredensial->langkah_all());
		}
		else{
			$data['cmd_elemen']=$this->m_admin_kredensial->cmd_elemen_jabatan();
			$data['cmd_jabatan']=$this->m_admin_kredensial->cmd_jabatan();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['nama_pra_asesmen']  = set_value('nama_pra_asesmen',$this->input->post('nama_pra_asesmen'));
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($this->m_admin_kredensial->simpan_nkr_pra_asesmen()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('admin_kredensial/langkah'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('admin_kredensial/langkah'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('nkr_pra_asesmen','id_pra_asesmen',$data['id']);
				$data['nama_pra_asesmen']  = set_value('nama_pra_asesmen',$keuangan["nama_pra_asesmen"]);
				$data['id_pra_asesmen']  = set_value('id_pra_asesmen',$keuangan["id_pra_asesmen"]);
				$data['barcode_pra_asesmen']  = set_value('barcode_pra_asesmen',$keuangan["barcode_pra_asesmen"]);
				$data['pembuat_pra_asesmen']  = set_value('pembuat_pra_asesmen',$keuangan["pembuat_pra_asesmen"]);
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_edit'){
	    	$pembuat_pra_asesmen = $this->input->post('pembuat_pra_asesmen');
	    	$barcode_pra_asesmen = $this->input->post('barcode_pra_asesmen');
		 		$kondisi=array('barcode_pra_asesmen'=>$barcode_pra_asesmen);
				$jml = $this->m_umum->jumlah_record_filter('nkr_pra_detil',$kondisi);
				if($jml == 0){
		    	if($this->session->id_pegawai == $pembuat_pra_asesmen){
					  if($this->m_admin_kredensial->edit_nkr_pra_asesmen()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('admin_kredensial/langkah'));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('admin_kredensial/langkah'));
					  }
		    	}else{
							$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
							redirect(base_url('admin_kredensial/langkah'));    		
					}
				}else{
					$this->session->set_flashdata('danger', 'Data Sudah Dipakai');
					redirect(base_url('admin_kredensial/langkah')); 					
				}
      }
		}
  }
  function kegiatan($mode='view')
  {
	$data['page']  = "kegiatan";
	$data['header'] = "KOMPONEN KEGIATAN FORM 5 DAN 6";
	$data['title'] = "KOMPONEN KEGIATAN FORM 5 DAN 6";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',32);
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
		$data['id']   = $this->uri->segment(4, 0);
		if($mode=='view'){
			$this->tampil($data);
		}
    else if($mode=='data'){
			echo json_encode($this->m_admin_kredensial->kegiatan_all());
		}
		else{
			$data['cmd_pra_asesmen']=$this->m_admin_kredensial->cmd_pra_asesmen();
			$data['cmd_jabatan']=$this->m_admin_kredensial->cmd_jabatan();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['id_jabatan']  = set_value('id_jabatan',$this->input->post('id_jabatan'));
				$data['nama_pra_detil']  = set_value('nama_pra_detil',$this->input->post('nama_pra_detil'));
				$data['barcode_pra_asesmen']  = set_value('barcode_pra_asesmen',$this->input->post('barcode_pra_asesmen'));
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($this->m_admin_kredensial->simpan_nkr_pra_detil()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('admin_kredensial/kegiatan'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('admin_kredensial/kegiatan'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('nkr_pra_detil','id_pra_detil',$data['id']);
				$data['id_jabatan']  = set_value('id_jabatan',$keuangan["id_jabatan"]);
				$data['nama_pra_detil']  = set_value('nama_pra_detil',$keuangan["nama_pra_detil"]);
				$data['id_pra_detil']  = set_value('id_pra_detil',$keuangan["id_pra_detil"]);
				$data['barcode_pra_detil']  = set_value('barcode_pra_detil',$keuangan["barcode_pra_detil"]);
				$data['barcode_pra_asesmen']  = set_value('barcode_pra_asesmen',$keuangan["barcode_pra_asesmen"]);
				$data['pembuat_pra_detil']  = set_value('pembuat_pra_detil',$keuangan["pembuat_pra_detil"]);
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_edit'){
	    	$pembuat_pra_detil = $this->input->post('pembuat_pra_detil');
	    	$id_pra_detil = $this->input->post('id_pra_detil');
		 		$kondisi=array('id_pra_detil'=>$id_pra_detil);
				$jml = $this->m_umum->jumlah_record_filter('nkr_form_detil',$kondisi);
//				if($jml == 0){
		    	if($this->session->id_pegawai == $pembuat_pra_detil){
					  if($this->m_admin_kredensial->edit_nkr_pra_detil()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('admin_kredensial/kegiatan'));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('admin_kredensial/kegiatan'));
					  }
		    	}else{
							$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
							redirect(base_url('admin_kredensial/kegiatan'));    		
					}
/*				}else{
					$this->session->set_flashdata('danger', 'Data Sudah Dipakai');
					redirect(base_url('admin_kredensial/kegiatan')); 					
				}*/
      }
		}
  }
  function form5($mode='view')
  {
	$data['page']  = "form5";
	$data['header'] = "INPUT FORM 5 UNTUK MENGAKTIFKAN SAAT PENGUJIAN KOMPETENSI";
	$data['title'] = "INPUT FORM 5 UNTUK MENGAKTIFKAN SAAT PENGUJIAN KOMPETENSI";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',32);
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
		$data['id']   = $this->uri->segment(4, 0);
		$data['id2']   = $this->uri->segment(5, 0);
		$data['id3']   = $this->uri->segment(6, 0);
		$data['id4']   = $this->uri->segment(7, 0);
		if($mode=='view'){
			$this->tampil($data);
		}
    else if($mode=='data'){
			echo json_encode($this->m_admin_kredensial->form_all(8));
		}
    else if($mode=='detil'){
			echo json_encode($this->m_admin_kredensial->form_indikator_detil($data['id']));
		}
  else if($mode=='hapus_form'){
    $kondisi=array('pembuat_form'=>$this->session->id_pegawai,'id_form'=>$data['id']);
    $jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
    $kondisi2=array('barcode_form'=>$data['id2']);
    $jml2 = $this->m_umum->jumlah_record_filter('nkr_form_detil',$kondisi2);
    if($jml == 0){
        $this->session->set_flashdata('danger', 'Hanya Dapat Menghapus Data Sendiri');
        redirect(base_url('admin_kredensial/'.$data['page']));
    }else{
      if($jml2 == 0){
        if($this->m_umum->hapus_data('nkr_form','id_form',$data['id'])){
            $this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
            redirect(base_url('admin_kredensial/'.$data['page']));
          }else{
            $this->session->set_flashdata('danger', 'Masalah Hapus Data');
            redirect(base_url('admin_kredensial/'.$data['page']));
          }
      }else{
        $this->session->set_flashdata('danger', 'Hapus Dahulu Data Di Dalamnya');
        redirect(base_url('admin_kredensial/'.$data['page']));        
      }
    }
  }
  else if($mode=='hapus'){
    $kondisi=array('pembuat_form'=>$this->session->id_pegawai,'id_form_detil'=>$data['id2']);
    $jml = $this->m_umum->jumlah_record_tabel_pengajuan('nkr_form_detil',$kondisi,'nkr_form','barcode_form');
/*     $kondisi2=array('id_asesmen'=>$data['id']);
    $jml2 = $this->m_umum->jumlah_record_filter('nkr_question_f2',$kondisi2);
    if($jml == 0){
        $this->session->set_flashdata('danger', 'Hanya Dapat Menghapus Data Sendiri');
        redirect(base_url('admin_kredensial/asesmen'));
    }else{*/
      if($jml2 == 0){
        if($this->m_umum->hapus_data('nkr_form_detil','id_form_detil',$data['id2'])){
            $this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
            redirect(base_url('admin_kredensial/form5/seting/'.$data['id']));
          }else{
            $this->session->set_flashdata('danger', 'Masalah Hapus Data');
            redirect(base_url('admin_kredensial/form5/seting/'.$data['id']));
          }
      }else{
        $this->session->set_flashdata('danger', 'Data Sudah Masuk Question');
        redirect(base_url('admin_kredensial/form5/seting/'.$data['id']));        
      }
/*    }*/
  }
		else{
			$data['working']=$this->m_admin_kredensial->ambil_data_rujukan_working();
			$data['status']=$this->m_rancak->cmd_status();
			$data['cmd_kompetensi_in']=$this->m_admin_kredensial->cmd_kompetensi_in($this->session->mas_kred);
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['id_kompetensi']  = set_value('id_kompetensi',$this->input->post('id_kompetensi'));
				$data['id_instansi']  = set_value('id_instansi',$this->input->post('id_instansi'));
				$data['nama_form']  = set_value('nama_form',$this->input->post('nama_form'));
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_tambah'){
      	$id_jenis_form = $this->input->post('id_jenis_form');
      	$id_kompetensi = $this->input->post('id_kompetensi');
      	$id_instansi = $this->input->post('id_instansi');
		 		$kondisi=array('id_instansi'=>$id_instansi,'id_kompetensi'=>$id_kompetensi,'id_jenis_form'=>$id_jenis_form);
				$jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
//				if($jml == 0){
				  if($this->m_admin_kredensial->simpan_nkr_form()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('admin_kredensial/form5'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
						redirect(base_url('admin_kredensial/form5'));
				  }
/*				}else{
					$this->session->set_flashdata('danger', 'Data Sudah Ada');
					redirect(base_url('admin_kredensial/form5'));				
				}*/
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('nkr_form','id_form',$data['id']);
				$data['id_form']  = set_value('id_form',$keuangan["id_form"]);
				$data['barcode_form']  = set_value('barcode_form',$keuangan["barcode_form"]);
				$data['id_kompetensi']  = set_value('id_kompetensi',$keuangan["id_kompetensi"]);
				$data['id_instansi']  = set_value('id_instansi',$keuangan["id_instansi"]);
				$data['id_jenis_form']  = set_value('id_jenis_form',$keuangan["id_jenis_form"]);
				$data['pembuat_form']  = set_value('pembuat_form',$keuangan["pembuat_form"]);
				$data['nama_form']  = set_value('nama_form',$keuangan["nama_form"]);
				$data['status_form']  = set_value('status_form',$keuangan["status_form"]);
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_edit'){
	    	$pembuat_form = $this->input->post('pembuat_form');
	    	$id_jenis_form = $this->input->post('id_jenis_form');
      	$id_kompetensi = $this->input->post('id_kompetensi');
      	$id_instansi = $this->input->post('id_instansi');
		 		$kondisi=array('id_instansi'=>$id_instansi,'id_kompetensi'=>$id_kompetensi,'id_jenis_form'=>$id_jenis_form);
				$jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
//				if($jml == 0){
		    	if($this->session->id_pegawai == $pembuat_form){
					  if($this->m_admin_kredensial->edit_nkr_form()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('admin_kredensial/form5'));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('admin_kredensial/form5'));
					  }
		    	}else{
							$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
							redirect(base_url('admin_kredensial/form5'));    		
					}
/*				}else{
					$this->session->set_flashdata('danger', 'Data Sudah Ada');
					redirect(base_url('admin_kredensial/form5')); 					
				}*/
      }
      if($mode=='seting'){
        $data['page'] =  $data['page']."_seting";
		 		$kondisi=array('barcode_form'=>$data['id']);
				$jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
				if($jml == 0){
						$this->session->set_flashdata('danger', 'Data Tidak Valid');
						redirect(base_url('admin_kredensial/form3'));
				}
				$data['nkr_asesmen']	= $this->m_admin_kredensial->ambil_nkr_pra_detil($data['id2'],$data['id3']);
				$data['cmd_elemen']	= $this->m_admin_kredensial->cmd_pra_asesmen();
		//		$data['cmd_elemen']	= $this->m_admin_kredensial->cmd_elemen();
				$data['cmd_jabatan']	= $this->m_admin_kredensial->cmd_jabatan();
		//		$data['ambil_working']	= $this->m_admin_kredensial->ambil_working_null();
				$d	= $this->m_admin_kredensial->ambil_nkr_form($data['id']);
				$data['id_form']  = set_value('id_form',$d["id_form"]);
				$data['barcode_form']  = set_value('barcode_form',$d["barcode_form"]);
				$data['nama_kompetensi']  = set_value('nama_kompetensi',$d["nama_kompetensi"]);
				$data['kode_unit']  = set_value('kode_unit',$d["kode_unit"]);
				$data['nama_jabatan']  = set_value('nama_jabatan',$d["nama_jabatan"]);
				$this->tampil($data);
				$action = $this->input->post('action');
				if($action == 'BtnProses') {
		      $id   = $this->input->post('id');
		      $id2   = $this->input->post('id2');
		      $id3   = $this->input->post('id3');
					redirect(base_url('admin_kredensial/form5/seting/'.$data['id'].'/'.$id2.'/'.$id3));
				}
				if($action == 'BtnSimpan') {
		      $id   = $this->input->post('id');
		      $id2   = $this->input->post('id2');
		      $id3   = $this->input->post('id3');
		      $id4   = $this->input->post('id4');
					$this->m_admin_kredensial->simpan_form_pra_detil();
					$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
					redirect(base_url('admin_kredensial/form5/seting/'.$data['id'].'/'.$id2.'/'.$id3));
				} 
	  	}
      if($mode=='urutan'){
        $data['page'] =  $data['page']."_urutan";
				$kondisi=array('id_form_detil'=>$data['id']);
				$keuangan    = $this->m_umum->ambil_data_kondisi_2tabel_row('nkr_form_detil',$kondisi,'nkr_form','barcode_form');
				$data['no_urut_detil']  = set_value('no_urut_detil',$keuangan["no_urut_detil"]);
				$data['id_form_detil']  = set_value('id_form_detil',$keuangan["id_form_detil"]);
				$data['id_jenis_form']  = set_value('id_jenis_form',$keuangan["id_jenis_form"]);
				$data['barcode_form']  = set_value('barcode_form',$keuangan["barcode_form"]);
				$data['id_kompetensi']  = set_value('id_kompetensi',$keuangan["id_kompetensi"]);
				$data['id_instansi']  = set_value('id_instansi',$keuangan["id_instansi"]);
				$data['pembuat_form']  = set_value('pembuat_form',$keuangan["pembuat_form"]);
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_urutan'){
	    	$pembuat_form = $this->input->post('pembuat_form');
	    	$barcode_form = $this->input->post('barcode_form');
		    	if($this->session->id_pegawai == $pembuat_form){
					  if($this->m_admin_kredensial->edit_urutan_detil()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('admin_kredensial/form5/seting/'.$barcode_form));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('admin_kredensial/form5/seting/'.$barcode_form));
					  }
		    	}else{
							$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
							redirect(base_url('admin_kredensial/form5/seting/'.$barcode_form));    		
					}
      }
		}
  }
  function form6($mode='view')
  {
	$data['page']  = "form6";
	$data['header'] = "INPUT FORM 6 UNTUK MENGAKTIFKAN SAAT PENGUJIAN KOMPETENSI";
	$data['title'] = "INPUT FORM 6 UNTUK MENGAKTIFKAN SAAT PENGUJIAN KOMPETENSI";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',32);
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
		$data['id']   = $this->uri->segment(4, 0);
		$data['id2']   = $this->uri->segment(5, 0);
		$data['id3']   = $this->uri->segment(6, 0);
		$data['id4']   = $this->uri->segment(7, 0);
		if($mode=='view'){
			$this->tampil($data);
		}
    else if($mode=='data'){
			echo json_encode($this->m_admin_kredensial->form_all(9));
		}
    else if($mode=='detil'){
			echo json_encode($this->m_admin_kredensial->form_indikator_detil($data['id']));
		}
  else if($mode=='hapus_form'){
    $kondisi=array('pembuat_form'=>$this->session->id_pegawai,'id_form'=>$data['id']);
    $jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
    $kondisi2=array('barcode_form'=>$data['id2']);
    $jml2 = $this->m_umum->jumlah_record_filter('nkr_form_detil',$kondisi2);
    if($jml == 0){
        $this->session->set_flashdata('danger', 'Hanya Dapat Menghapus Data Sendiri');
        redirect(base_url('admin_kredensial/'.$data['page']));
    }else{
      if($jml2 == 0){
        if($this->m_umum->hapus_data('nkr_form','id_form',$data['id'])){
            $this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
            redirect(base_url('admin_kredensial/'.$data['page']));
          }else{
            $this->session->set_flashdata('danger', 'Masalah Hapus Data');
            redirect(base_url('admin_kredensial/'.$data['page']));
          }
      }else{
        $this->session->set_flashdata('danger', 'Hapus Dahulu Data Di Dalamnya');
        redirect(base_url('admin_kredensial/'.$data['page']));        
      }
    }
  }
  else if($mode=='hapus'){
    $kondisi=array('pembuat_form'=>$this->session->id_pegawai,'id_form_detil'=>$data['id2']);
    $jml = $this->m_umum->jumlah_record_tabel_pengajuan('nkr_form_detil',$kondisi,'nkr_form','barcode_form');
/*     $kondisi2=array('id_asesmen'=>$data['id']);
    $jml2 = $this->m_umum->jumlah_record_filter('nkr_question_f2',$kondisi2);
    if($jml == 0){
        $this->session->set_flashdata('danger', 'Hanya Dapat Menghapus Data Sendiri');
        redirect(base_url('admin_kredensial/asesmen'));
    }else{*/
      if($jml2 == 0){
        if($this->m_umum->hapus_data('nkr_form_detil','id_form_detil',$data['id2'])){
            $this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
            redirect(base_url('admin_kredensial/form6/seting/'.$data['id']));
          }else{
            $this->session->set_flashdata('danger', 'Masalah Hapus Data');
            redirect(base_url('admin_kredensial/form6/seting/'.$data['id']));
          }
      }else{
        $this->session->set_flashdata('danger', 'Data Sudah Masuk Question');
        redirect(base_url('admin_kredensial/form6/seting/'.$data['id']));        
      }
/*    }*/
  }
		else{
			$data['working']=$this->m_admin_kredensial->ambil_data_rujukan_working();
			$data['status']=$this->m_rancak->cmd_status();
			$data['cmd_kompetensi_in']=$this->m_admin_kredensial->cmd_kompetensi_in($this->session->mas_kred);
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['id_kompetensi']  = set_value('id_kompetensi',$this->input->post('id_kompetensi'));
				$data['id_instansi']  = set_value('id_instansi',$this->input->post('id_instansi'));
				$data['nama_form']  = set_value('nama_form',$this->input->post('nama_form'));
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_tambah'){
      	$id_jenis_form = $this->input->post('id_jenis_form');
      	$id_kompetensi = $this->input->post('id_kompetensi');
      	$id_instansi = $this->input->post('id_instansi');
		 		$kondisi=array('id_instansi'=>$id_instansi,'id_kompetensi'=>$id_kompetensi,'id_jenis_form'=>$id_jenis_form);
				$jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
	//			if($jml == 0){
				  if($this->m_admin_kredensial->simpan_nkr_form()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('admin_kredensial/form6'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
						redirect(base_url('admin_kredensial/form6'));
				  }
/*				}else{
					$this->session->set_flashdata('danger', 'Data Sudah Ada');
					redirect(base_url('admin_kredensial/form6'));				
				}*/
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('nkr_form','id_form',$data['id']);
				$data['id_form']  = set_value('id_form',$keuangan["id_form"]);
				$data['barcode_form']  = set_value('barcode_form',$keuangan["barcode_form"]);
				$data['id_kompetensi']  = set_value('id_kompetensi',$keuangan["id_kompetensi"]);
				$data['id_instansi']  = set_value('id_instansi',$keuangan["id_instansi"]);
				$data['id_jenis_form']  = set_value('id_jenis_form',$keuangan["id_jenis_form"]);
				$data['pembuat_form']  = set_value('pembuat_form',$keuangan["pembuat_form"]);
				$data['nama_form']  = set_value('nama_form',$keuangan["nama_form"]);
				$data['status_form']  = set_value('status_form',$keuangan["status_form"]);
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_edit'){
	    	$pembuat_form = $this->input->post('pembuat_form');
	    	$id_jenis_form = $this->input->post('id_jenis_form');
      	$id_kompetensi = $this->input->post('id_kompetensi');
      	$id_instansi = $this->input->post('id_instansi');
		 		$kondisi=array('id_instansi'=>$id_instansi,'id_kompetensi'=>$id_kompetensi,'id_jenis_form'=>$id_jenis_form);
				$jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
//				if($jml == 0){
		    	if($this->session->id_pegawai == $pembuat_form){
					  if($this->m_admin_kredensial->edit_nkr_form()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('admin_kredensial/form6'));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('admin_kredensial/form6'));
					  }
		    	}else{
							$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
							redirect(base_url('admin_kredensial/form6'));    		
					}
/*				}else{
					$this->session->set_flashdata('danger', 'Data Sudah Ada');
					redirect(base_url('admin_kredensial/form6')); 					
				}*/
      }
      if($mode=='seting'){
        $data['page'] =  $data['page']."_seting";
		 		$kondisi=array('barcode_form'=>$data['id']);
				$jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
				if($jml == 0){
						$this->session->set_flashdata('danger', 'Data Tidak Valid');
						redirect(base_url('admin_kredensial/form3'));
				}
				$data['nkr_asesmen']	= $this->m_admin_kredensial->ambil_nkr_pra_detil($data['id2'],$data['id3']);
				$data['cmd_elemen']	= $this->m_admin_kredensial->cmd_pra_asesmen();
				$data['cmd_jabatan']	= $this->m_admin_kredensial->cmd_jabatan();
				$d	= $this->m_admin_kredensial->ambil_nkr_form($data['id']);
				$data['id_form']  = set_value('id_form',$d["id_form"]);
				$data['barcode_form']  = set_value('barcode_form',$d["barcode_form"]);
				$data['nama_kompetensi']  = set_value('nama_kompetensi',$d["nama_kompetensi"]);
				$data['kode_unit']  = set_value('kode_unit',$d["kode_unit"]);
				$data['nama_jabatan']  = set_value('nama_jabatan',$d["nama_jabatan"]);
				$this->tampil($data);
				$action = $this->input->post('action');
				if($action == 'BtnProses') {
		      $id   = $this->input->post('id');
		      $id2   = $this->input->post('id2');
		      $id3   = $this->input->post('id3');
					redirect(base_url('admin_kredensial/form6/seting/'.$data['id'].'/'.$id2.'/'.$id3));
				}
				if($action == 'BtnSimpan') {
		      $id   = $this->input->post('id');
		      $id2   = $this->input->post('id2');
		      $id3   = $this->input->post('id3');
		      $id4   = $this->input->post('id4');
					$this->m_admin_kredensial->simpan_form_pra_detil();
					$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
					redirect(base_url('admin_kredensial/form6/seting/'.$data['id'].'/'.$id2.'/'.$id3));
				} 
	  	}
      if($mode=='urutan'){
        $data['page'] =  $data['page']."_urutan";
				$kondisi=array('id_form_detil'=>$data['id']);
				$keuangan    = $this->m_umum->ambil_data_kondisi_2tabel_row('nkr_form_detil',$kondisi,'nkr_form','barcode_form');
				$data['no_urut_detil']  = set_value('no_urut_detil',$keuangan["no_urut_detil"]);
				$data['id_form_detil']  = set_value('id_form_detil',$keuangan["id_form_detil"]);
				$data['id_jenis_form']  = set_value('id_jenis_form',$keuangan["id_jenis_form"]);
				$data['barcode_form']  = set_value('barcode_form',$keuangan["barcode_form"]);
				$data['id_kompetensi']  = set_value('id_kompetensi',$keuangan["id_kompetensi"]);
				$data['id_instansi']  = set_value('id_instansi',$keuangan["id_instansi"]);
				$data['pembuat_form']  = set_value('pembuat_form',$keuangan["pembuat_form"]);
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_urutan'){
	    	$pembuat_form = $this->input->post('pembuat_form');
	    	$barcode_form = $this->input->post('barcode_form');
		    	if($this->session->id_pegawai == $pembuat_form){
					  if($this->m_admin_kredensial->edit_urutan_detil()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('admin_kredensial/form6/seting/'.$barcode_form));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('admin_kredensial/form6/seting/'.$barcode_form));
					  }
		    	}else{
							$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
							redirect(base_url('admin_kredensial/form6/seting/'.$barcode_form));    		
					}
      }
		}
  }
  function form7($mode='view')
  {
	$data['page']  = "form7";
	$data['header'] = "INPUT FORM 7 UNTUK MENGAKTIFKAN SAAT PENGUJIAN KOMPETENSI";
	$data['title'] = "INPUT FORM 7 UNTUK MENGAKTIFKAN SAAT PENGUJIAN KOMPETENSI";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',32);
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
		$data['id']   = $this->uri->segment(4, 0);
		if($mode=='view'){
			$this->tampil($data);
		}
    else if($mode=='data'){
			echo json_encode($this->m_admin_kredensial->form_all(10));
		}
  else if($mode=='hapus_form'){
    $kondisi=array('pembuat_form'=>$this->session->id_pegawai,'id_form'=>$data['id']);
    $jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
    $kondisi2=array('barcode_form'=>$data['id2']);
    $jml2 = $this->m_umum->jumlah_record_filter('nkr_form_detil',$kondisi2);
    if($jml == 0){
        $this->session->set_flashdata('danger', 'Hanya Dapat Menghapus Data Sendiri');
        redirect(base_url('admin_kredensial/'.$data['page']));
    }else{
 //     if($jml2 == 0){
        if($this->m_umum->hapus_data('nkr_form','id_form',$data['id'])){
            $this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
            redirect(base_url('admin_kredensial/'.$data['page']));
          }else{
            $this->session->set_flashdata('danger', 'Masalah Hapus Data');
            redirect(base_url('admin_kredensial/'.$data['page']));
          }
/*      }else{
        $this->session->set_flashdata('danger', 'Hapus Dahulu Data Di Dalamnya');
        redirect(base_url('admin_kredensial/'.$data['page']));        
      }*/
    }
  }
		else{
			$data['working']=$this->m_admin_kredensial->ambil_data_rujukan_working();
			$data['status']=$this->m_rancak->cmd_status();
			$data['cmd_kompetensi_in']=$this->m_admin_kredensial->cmd_kompetensi_in($this->session->mas_kred);
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['id_kompetensi']  = set_value('id_kompetensi',$this->input->post('id_kompetensi'));
				$data['id_instansi']  = set_value('id_instansi',$this->input->post('id_instansi'));
				$data['nama_form']  = set_value('nama_form',$this->input->post('nama_form'));
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_tambah'){
      	$id_jenis_form = $this->input->post('id_jenis_form');
      	$id_kompetensi = $this->input->post('id_kompetensi');
      	$id_instansi = $this->input->post('id_instansi');
		 		$kondisi=array('id_instansi'=>$id_instansi,'id_kompetensi'=>$id_kompetensi,'id_jenis_form'=>$id_jenis_form);
				$jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
//				if($jml == 0){
				  if($this->m_admin_kredensial->simpan_nkr_form()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('admin_kredensial/form7'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
						redirect(base_url('admin_kredensial/form7'));
				  }
/*				}else{
					$this->session->set_flashdata('danger', 'Data Sudah Ada');
					redirect(base_url('admin_kredensial/form7'));				
				}*/
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('nkr_form','id_form',$data['id']);
				$data['id_form']  = set_value('id_form',$keuangan["id_form"]);
				$data['barcode_form']  = set_value('barcode_form',$keuangan["barcode_form"]);
				$data['id_kompetensi']  = set_value('id_kompetensi',$keuangan["id_kompetensi"]);
				$data['id_instansi']  = set_value('id_instansi',$keuangan["id_instansi"]);
				$data['id_jenis_form']  = set_value('id_jenis_form',$keuangan["id_jenis_form"]);
				$data['pembuat_form']  = set_value('pembuat_form',$keuangan["pembuat_form"]);
				$data['nama_form']  = set_value('nama_form',$keuangan["nama_form"]);
				$data['status_form']  = set_value('status_form',$keuangan["status_form"]);
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_edit'){
	    	$pembuat_form = $this->input->post('pembuat_form');
	    	$id_jenis_form = $this->input->post('id_jenis_form');
      	$id_kompetensi = $this->input->post('id_kompetensi');
      	$id_instansi = $this->input->post('id_instansi');
		 		$kondisi=array('id_instansi'=>$id_instansi,'id_kompetensi'=>$id_kompetensi,'id_jenis_form'=>$id_jenis_form);
				$jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
		 		$kondisi2=array('barcode_form'=>$barcode_form,'id_kompetensi'=>$id_kompetensi,'id_jenis_form'=>$id_jenis_form);
				$jml2 = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi2);
//				if($jml == 0){
		    	if($this->session->id_pegawai == $pembuat_form){
					  if($this->m_admin_kredensial->edit_nkr_form()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('admin_kredensial/form7'));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('admin_kredensial/form7'));
					  }
		    	}else{
							$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
							redirect(base_url('admin_kredensial/form7'));    		
					}
/*				}else{
					$this->session->set_flashdata('danger', 'Data Sudah Ada');
					redirect(base_url('admin_kredensial/form7')); 					
				}*/
      }
		}
  }
  function form8($mode='view')
  {
	$data['page']  = "form8";
	$data['header'] = "AKTIFKAN FORMULIR BANDING ASESMEN";
	$data['title'] = "AKTIFKAN FORMULIR BANDING ASESMEN";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',32);
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
		$data['id']   = $this->uri->segment(4, 0);
		if($mode=='view'){
			$this->tampil($data);
		}
    else if($mode=='data'){
			echo json_encode($this->m_admin_kredensial->form_all(11));
		}
  else if($mode=='hapus_form'){
    $kondisi=array('pembuat_form'=>$this->session->id_pegawai,'id_form'=>$data['id']);
    $jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
    $kondisi2=array('barcode_form'=>$data['id2']);
    $jml2 = $this->m_umum->jumlah_record_filter('nkr_form_detil',$kondisi2);
    if($jml == 0){
        $this->session->set_flashdata('danger', 'Hanya Dapat Menghapus Data Sendiri');
        redirect(base_url('admin_kredensial/'.$data['page']));
    }else{
      if($jml2 == 0){
        if($this->m_umum->hapus_data('nkr_form','id_form',$data['id'])){
            $this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
            redirect(base_url('admin_kredensial/'.$data['page']));
          }else{
            $this->session->set_flashdata('danger', 'Masalah Hapus Data');
            redirect(base_url('admin_kredensial/'.$data['page']));
          }
      }else{
        $this->session->set_flashdata('danger', 'Hapus Dahulu Data Di Dalamnya');
        redirect(base_url('admin_kredensial/'.$data['page']));        
      }
    }
  }
		else{
			$data['working']=$this->m_admin_kredensial->ambil_data_rujukan_working();
			$data['status']=$this->m_rancak->cmd_status();
			$data['cmd_kompetensi_in']=$this->m_admin_kredensial->cmd_kompetensi_in($this->session->mas_kred);
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['id_kompetensi']  = set_value('id_kompetensi',$this->input->post('id_kompetensi'));
				$data['id_instansi']  = set_value('id_instansi',$this->input->post('id_instansi'));
				$data['nama_form']  = set_value('nama_form',$this->input->post('nama_form'));
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_tambah'){
      	$id_jenis_form = $this->input->post('id_jenis_form');
      	$id_kompetensi = $this->input->post('id_kompetensi');
      	$id_instansi = $this->input->post('id_instansi');
		 		$kondisi=array('id_instansi'=>$id_instansi,'id_kompetensi'=>$id_kompetensi,'id_jenis_form'=>$id_jenis_form);
				$jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
//			if($jml == 0){
				  if($this->m_admin_kredensial->simpan_nkr_form()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('admin_kredensial/form8'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
						redirect(base_url('admin_kredensial/form8'));
				  }
/*				}else{
					$this->session->set_flashdata('danger', 'Data Sudah Ada');
					redirect(base_url('admin_kredensial/form8'));				
				}*/
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('nkr_form','id_form',$data['id']);
				$data['id_form']  = set_value('id_form',$keuangan["id_form"]);
				$data['barcode_form']  = set_value('barcode_form',$keuangan["barcode_form"]);
				$data['id_kompetensi']  = set_value('id_kompetensi',$keuangan["id_kompetensi"]);
				$data['id_instansi']  = set_value('id_instansi',$keuangan["id_instansi"]);
				$data['id_jenis_form']  = set_value('id_jenis_form',$keuangan["id_jenis_form"]);
				$data['pembuat_form']  = set_value('pembuat_form',$keuangan["pembuat_form"]);
				$data['nama_form']  = set_value('nama_form',$keuangan["nama_form"]);
				$data['status_form']  = set_value('status_form',$keuangan["status_form"]);
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_edit'){
	    	$pembuat_form = $this->input->post('pembuat_form');
	    	$id_jenis_form = $this->input->post('id_jenis_form');
      	$id_kompetensi = $this->input->post('id_kompetensi');
      	$id_instansi = $this->input->post('id_instansi');
		 		$kondisi=array('id_instansi'=>$id_instansi,'id_kompetensi'=>$id_kompetensi,'id_jenis_form'=>$id_jenis_form);
				$jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
		 		$kondisi2=array('barcode_form'=>$barcode_form,'id_kompetensi'=>$id_kompetensi,'id_jenis_form'=>$id_jenis_form);
				$jml2 = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi2);
//				if($jml == 0){
		    	if($this->session->id_pegawai == $pembuat_form){
					  if($this->m_admin_kredensial->edit_nkr_form()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('admin_kredensial/form8'));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('admin_kredensial/form8'));
					  }
		    	}else{
							$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
							redirect(base_url('admin_kredensial/form8'));    		
					}
/*				}else{
					$this->session->set_flashdata('danger', 'Data Sudah Ada');
					redirect(base_url('admin_kredensial/form8')); 					
				}*/
      }
		}
  }
  function kat_kaji_ulang($mode='view')
  {
	$data['page']  = "kat_kaji_ulang";
	$data['header'] = "KATEGORI KOMPONEN DAN ASPEK UMPAN BALIK DAN KAJI ULANG ASESMEN";
	$data['title'] = "KATEGORI KOMPONEN DAN ASPEK UMPAN BALIK DAN KAJI ULANG ASESMEN";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',32);
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
		$data['id']   = $this->uri->segment(4, 0);
		if($mode=='view'){
			$this->tampil($data);
		}
    else if($mode=='data'){
			echo json_encode($this->m_admin_kredensial->kat_kaji_ulang_all());
		}
		else{
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['nama_kat_kaji']  = set_value('nama_kat_kaji',$this->input->post('nama_kat_kaji'));
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($this->m_admin_kredensial->simpan_nkr_kat_kaji()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('admin_kredensial/kat_kaji_ulang'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('admin_kredensial/kat_kaji_ulang'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('nkr_kat_kaji','id_kat_kaji',$data['id']);
				$data['nama_kat_kaji']  = set_value('nama_kat_kaji',$keuangan["nama_kat_kaji"]);
				$data['id_kat_kaji']  = set_value('id_kat_kaji',$keuangan["id_kat_kaji"]);
				$data['pembuat_kat_kaji']  = set_value('pembuat_kat_kaji',$keuangan["pembuat_kat_kaji"]);
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_edit'){
	    	$pembuat_kat_kaji = $this->input->post('pembuat_kat_kaji');
	    	$id_kat_kaji = $this->input->post('id_kat_kaji');
		 		$kondisi=array('id_kat_kaji'=>$id_kat_kaji);
				$jml = $this->m_umum->jumlah_record_filter('nkr_kaji_ulang',$kondisi);
				if($jml == 0){
		    	if($this->session->id_pegawai == $pembuat_kat_kaji){
					  if($this->m_admin_kredensial->edit_nkr_kat_kaji()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('admin_kredensial/kat_kaji_ulang'));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('admin_kredensial/kat_kaji_ulang'));
					  }
		    	}else{
							$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
							redirect(base_url('admin_kredensial/kat_kaji_ulang'));    		
					}
				}else{
					$this->session->set_flashdata('danger', 'Data Sudah Dipakai');
					redirect(base_url('admin_kredensial/kat_kaji_ulang')); 					
				}
      }
		}
  }
  function kaji_ulang($mode='view')
  {
	$data['page']  = "kaji_ulang";
	$data['header'] = "KOMPONEN DAN ASPEK UMPAN BALIK DAN KAJI ULANG ASESMEN";
	$data['title'] = "KOMPONEN DAN ASPEK UMPAN BALIK DAN KAJI ULANG ASESMEN";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',32);
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
		$data['id']   = $this->uri->segment(4, 0);
		if($mode=='view'){
			$this->tampil($data);
		}
    else if($mode=='data'){
			echo json_encode($this->m_admin_kredensial->kaji_ulang_all());
		}
		else{
			$array_check = array(12,13);
			$data['cmd_form']=$this->m_admin_kredensial->cmd_form($array_check);
			$data['cmd_kat_kaji']=$this->m_umum->ambil_data_result('nkr_kat_kaji');
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['id_jenis_form']  = set_value('id_jenis_form',$this->input->post('id_jenis_form'));
				$data['id_kat_kaji']  = set_value('id_kat_kaji',$this->input->post('id_kat_kaji'));
				$data['nama_kaji_ulang']  = set_value('nama_kaji_ulang',$this->input->post('nama_kaji_ulang'));
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($this->m_admin_kredensial->simpan_nkr_kaji_ulang()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('admin_kredensial/kaji_ulang'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('admin_kredensial/kaji_ulang'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('nkr_kaji_ulang','id_kaji_ulang',$data['id']);
				$data['id_kat_kaji']  = set_value('id_kat_kaji',$keuangan["id_kat_kaji"]);
				$data['id_jenis_form']  = set_value('id_jenis_form',$keuangan["id_jenis_form"]);
				$data['nama_kaji_ulang']  = set_value('nama_kaji_ulang',$keuangan["nama_kaji_ulang"]);
				$data['id_kaji_ulang']  = set_value('id_kaji_ulang',$keuangan["id_kaji_ulang"]);
				$data['pembuat_kaji_ulang']  = set_value('pembuat_kaji_ulang',$keuangan["pembuat_kaji_ulang"]);
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_edit'){
	    	$pembuat_kaji_ulang = $this->input->post('pembuat_kaji_ulang');
	    	$id_kaji_ulang = $this->input->post('id_kaji_ulang');
		 		$kondisi=array('id_kaji_ulang'=>$id_kaji_ulang);
				$jml = $this->m_umum->jumlah_record_filter('nkr_form_detil',$kondisi);
//				if($jml == 0){
		    	if($this->session->id_pegawai == $pembuat_kaji_ulang){
					  if($this->m_admin_kredensial->edit_nkr_kaji_ulang()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('admin_kredensial/kaji_ulang'));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('admin_kredensial/kaji_ulang'));
					  }
		    	}else{
							$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
							redirect(base_url('admin_kredensial/kaji_ulang'));    		
					}
/*				}else{
					$this->session->set_flashdata('danger', 'Data Sudah Dipakai');
					redirect(base_url('admin_kredensial/kaji_ulang')); 					
				}*/
      }
		}
  }
  function form9a($mode='view')
  {
	$data['page']  = "form9a";
	$data['header'] = "INPUT FORM 9A UMPAN BALIK DAN KAJI ULANG ASESMEN";
	$data['title'] = "INPUT FORM 9A UMPAN BALIK DAN KAJI ULANG ASESMEN";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',32);
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
		$data['id']   = $this->uri->segment(4, 0);
		$data['id2']   = $this->uri->segment(5, 0);
		$data['id3']   = $this->uri->segment(6, 0);
		$data['id4']   = $this->uri->segment(7, 0);
		if($mode=='view'){
			$this->tampil($data);
		}
    else if($mode=='data'){
			echo json_encode($this->m_admin_kredensial->form_all(12));
		}
    else if($mode=='detil'){
			echo json_encode($this->m_admin_kredensial->form_indikator_detil($data['id']));
		}
  else if($mode=='hapus_form'){
    $kondisi=array('pembuat_form'=>$this->session->id_pegawai,'id_form'=>$data['id']);
    $jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
    $kondisi2=array('barcode_form'=>$data['id2']);
    $jml2 = $this->m_umum->jumlah_record_filter('nkr_form_detil',$kondisi2);
    if($jml == 0){
        $this->session->set_flashdata('danger', 'Hanya Dapat Menghapus Data Sendiri');
        redirect(base_url('admin_kredensial/'.$data['page']));
    }else{
      if($jml2 == 0){
        if($this->m_umum->hapus_data('nkr_form','id_form',$data['id'])){
            $this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
            redirect(base_url('admin_kredensial/'.$data['page']));
          }else{
            $this->session->set_flashdata('danger', 'Masalah Hapus Data');
            redirect(base_url('admin_kredensial/'.$data['page']));
          }
      }else{
        $this->session->set_flashdata('danger', 'Hapus Dahulu Data Di Dalamnya');
        redirect(base_url('admin_kredensial/'.$data['page']));        
      }
    }
  }
  else if($mode=='hapus'){
    $kondisi=array('pembuat_form'=>$this->session->id_pegawai,'id_form_detil'=>$data['id2']);
    $jml = $this->m_umum->jumlah_record_tabel_pengajuan('nkr_form_detil',$kondisi,'nkr_form','barcode_form');
/*     $kondisi2=array('id_asesmen'=>$data['id']);
    $jml2 = $this->m_umum->jumlah_record_filter('nkr_question_f2',$kondisi2);
    if($jml == 0){
        $this->session->set_flashdata('danger', 'Hanya Dapat Menghapus Data Sendiri');
        redirect(base_url('admin_kredensial/asesmen'));
    }else{*/
      if($jml2 == 0){
        if($this->m_umum->hapus_data('nkr_form_detil','id_form_detil',$data['id2'])){
            $this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
            redirect(base_url('admin_kredensial/form9a/seting/'.$data['id']));
          }else{
            $this->session->set_flashdata('danger', 'Masalah Hapus Data');
            redirect(base_url('admin_kredensial/form9a/seting/'.$data['id']));
          }
      }else{
        $this->session->set_flashdata('danger', 'Data Sudah Masuk Question');
        redirect(base_url('admin_kredensial/form9a/seting/'.$data['id']));        
      }
/*    }*/
  }
		else{
			$data['working']=$this->m_admin_kredensial->ambil_data_rujukan_working();
			$data['status']=$this->m_rancak->cmd_status();
			$data['cmd_kompetensi_in']=$this->m_admin_kredensial->cmd_kompetensi_in($this->session->mas_kred);
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['id_kompetensi']  = set_value('id_kompetensi',$this->input->post('id_kompetensi'));
				$data['id_instansi']  = set_value('id_instansi',$this->input->post('id_instansi'));
				$data['nama_form']  = set_value('nama_form',$this->input->post('nama_form'));
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_tambah'){
      	$id_jenis_form = $this->input->post('id_jenis_form');
      	$id_kompetensi = $this->input->post('id_kompetensi');
      	$id_instansi = $this->input->post('id_instansi');
		 		$kondisi=array('id_instansi'=>$id_instansi,'id_kompetensi'=>$id_kompetensi,'id_jenis_form'=>$id_jenis_form);
				$jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
//				if($jml == 0){
				  if($this->m_admin_kredensial->simpan_nkr_form()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('admin_kredensial/form9a'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
						redirect(base_url('admin_kredensial/form9a'));
				  }
/*				}else{
					$this->session->set_flashdata('danger', 'Data Sudah Ada');
					redirect(base_url('admin_kredensial/form9a'));				
				}*/
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('nkr_form','id_form',$data['id']);
				$data['id_form']  = set_value('id_form',$keuangan["id_form"]);
				$data['barcode_form']  = set_value('barcode_form',$keuangan["barcode_form"]);
				$data['id_kompetensi']  = set_value('id_kompetensi',$keuangan["id_kompetensi"]);
				$data['id_instansi']  = set_value('id_instansi',$keuangan["id_instansi"]);
				$data['id_jenis_form']  = set_value('id_jenis_form',$keuangan["id_jenis_form"]);
				$data['pembuat_form']  = set_value('pembuat_form',$keuangan["pembuat_form"]);
				$data['nama_form']  = set_value('nama_form',$keuangan["nama_form"]);
				$data['status_form']  = set_value('status_form',$keuangan["status_form"]);
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_edit'){
	    	$pembuat_form = $this->input->post('pembuat_form');
	    	$id_jenis_form = $this->input->post('id_jenis_form');
      	$id_kompetensi = $this->input->post('id_kompetensi');
      	$id_instansi = $this->input->post('id_instansi');
		 		$kondisi=array('id_instansi'=>$id_instansi,'id_kompetensi'=>$id_kompetensi,'id_jenis_form'=>$id_jenis_form);
				$jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
//				if($jml == 0){
		    	if($this->session->id_pegawai == $pembuat_form){
					  if($this->m_admin_kredensial->edit_nkr_form()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('admin_kredensial/form9a'));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('admin_kredensial/form9a'));
					  }
		    	}else{
							$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
							redirect(base_url('admin_kredensial/form9a'));    		
					}
/*				}else{
					$this->session->set_flashdata('danger', 'Data Sudah Ada');
					redirect(base_url('admin_kredensial/form9a')); 					
				}*/
      }
      if($mode=='seting'){
        $data['page'] =  $data['page']."_seting";
		 		$kondisi=array('barcode_form'=>$data['id']);
				$jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
				if($jml == 0){
						$this->session->set_flashdata('danger', 'Data Tidak Valid');
						redirect(base_url('admin_kredensial/form3'));
				}
				$data['nkr_asesmen']	= $this->m_admin_kredensial->ambil_nkr_kaji_ulang(12);
				$d	= $this->m_admin_kredensial->ambil_nkr_form($data['id']);
				$data['id_form']  = set_value('id_form',$d["id_form"]);
				$data['barcode_form']  = set_value('barcode_form',$d["barcode_form"]);
				$data['nama_kompetensi']  = set_value('nama_kompetensi',$d["nama_kompetensi"]);
				$data['kode_unit']  = set_value('kode_unit',$d["kode_unit"]);
				$data['nama_jabatan']  = set_value('nama_jabatan',$d["nama_jabatan"]);
				$this->tampil($data);
				$action = $this->input->post('action');
				if($action == 'BtnProses') {
		      $id   = $this->input->post('id');
		      $id2   = $this->input->post('id2');
		      $id3   = $this->input->post('id3');
					redirect(base_url('admin_kredensial/form9a/seting/'.$data['id'].'/'.$id2.'/'.$id3));
				}
				if($action == 'BtnSimpan') {
		      $id   = $this->input->post('id');
		      $id2   = $this->input->post('id2');
		      $id3   = $this->input->post('id3');
		      $id4   = $this->input->post('id4');
					$this->m_admin_kredensial->simpan_form_kaji_ulang();
					$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
					redirect(base_url('admin_kredensial/form9a/seting/'.$data['id'].'/'.$id2.'/'.$id3));
				} 
	  	}
      if($mode=='urutan'){
        $data['page'] =  $data['page']."_urutan";
				$kondisi=array('id_form_detil'=>$data['id']);
				$keuangan    = $this->m_umum->ambil_data_kondisi_2tabel_row('nkr_form_detil',$kondisi,'nkr_form','barcode_form');
				$data['no_urut_detil']  = set_value('no_urut_detil',$keuangan["no_urut_detil"]);
				$data['id_form_detil']  = set_value('id_form_detil',$keuangan["id_form_detil"]);
				$data['id_jenis_form']  = set_value('id_jenis_form',$keuangan["id_jenis_form"]);
				$data['barcode_form']  = set_value('barcode_form',$keuangan["barcode_form"]);
				$data['id_kompetensi']  = set_value('id_kompetensi',$keuangan["id_kompetensi"]);
				$data['id_instansi']  = set_value('id_instansi',$keuangan["id_instansi"]);
				$data['pembuat_form']  = set_value('pembuat_form',$keuangan["pembuat_form"]);
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_urutan'){
	    	$pembuat_form = $this->input->post('pembuat_form');
	    	$barcode_form = $this->input->post('barcode_form');
		    	if($this->session->id_pegawai == $pembuat_form){
					  if($this->m_admin_kredensial->edit_urutan_detil()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('admin_kredensial/form9a/seting/'.$barcode_form));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('admin_kredensial/form9a/seting/'.$barcode_form));
					  }
		    	}else{
							$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
							redirect(base_url('admin_kredensial/form9a/seting/'.$barcode_form));    		
					}
      }
		}
  }
  function form9b($mode='view')
  {
	$data['page']  = "form9b";
	$data['header'] = "INPUT FORM 9B UMPAN BALIK DAN KAJI ULANG ASESMEN (KESENJANGAN)";
	$data['title'] = "INPUT FORM 9B UMPAN BALIK DAN KAJI ULANG ASESMEN (KESENJANGAN)";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',32);
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
		$data['id']   = $this->uri->segment(4, 0);
		$data['id2']   = $this->uri->segment(5, 0);
		$data['id3']   = $this->uri->segment(6, 0);
		$data['id4']   = $this->uri->segment(7, 0);
		if($mode=='view'){
			$this->tampil($data);
		}
    else if($mode=='data'){
			echo json_encode($this->m_admin_kredensial->form_all(13));
		}
    else if($mode=='detil'){
			echo json_encode($this->m_admin_kredensial->form_indikator_detil($data['id']));
		}
  else if($mode=='hapus_form'){
    $kondisi=array('pembuat_form'=>$this->session->id_pegawai,'id_form'=>$data['id']);
    $jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
    $kondisi2=array('barcode_form'=>$data['id2']);
    $jml2 = $this->m_umum->jumlah_record_filter('nkr_form_detil',$kondisi2);
    if($jml == 0){
        $this->session->set_flashdata('danger', 'Hanya Dapat Menghapus Data Sendiri');
        redirect(base_url('admin_kredensial/'.$data['page']));
    }else{
      if($jml2 == 0){
        if($this->m_umum->hapus_data('nkr_form','id_form',$data['id'])){
            $this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
            redirect(base_url('admin_kredensial/'.$data['page']));
          }else{
            $this->session->set_flashdata('danger', 'Masalah Hapus Data');
            redirect(base_url('admin_kredensial/'.$data['page']));
          }
      }else{
        $this->session->set_flashdata('danger', 'Hapus Dahulu Data Di Dalamnya');
        redirect(base_url('admin_kredensial/'.$data['page']));        
      }
    }
  }
  else if($mode=='hapus'){
    $kondisi=array('pembuat_form'=>$this->session->id_pegawai,'id_form_detil'=>$data['id2']);
    $jml = $this->m_umum->jumlah_record_tabel_pengajuan('nkr_form_detil',$kondisi,'nkr_form','barcode_form');
/*     $kondisi2=array('id_asesmen'=>$data['id']);
    $jml2 = $this->m_umum->jumlah_record_filter('nkr_question_f2',$kondisi2);
    if($jml == 0){
        $this->session->set_flashdata('danger', 'Hanya Dapat Menghapus Data Sendiri');
        redirect(base_url('admin_kredensial/asesmen'));
    }else{*/
      if($jml2 == 0){
        if($this->m_umum->hapus_data('nkr_form_detil','id_form_detil',$data['id2'])){
            $this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
            redirect(base_url('admin_kredensial/form9b/seting/'.$data['id']));
          }else{
            $this->session->set_flashdata('danger', 'Masalah Hapus Data');
            redirect(base_url('admin_kredensial/form9b/seting/'.$data['id']));
          }
      }else{
        $this->session->set_flashdata('danger', 'Data Sudah Masuk Question');
        redirect(base_url('admin_kredensial/form9b/seting/'.$data['id']));        
      }
/*    }*/
  }
		else{
			$data['working']=$this->m_admin_kredensial->ambil_data_rujukan_working();
			$data['status']=$this->m_rancak->cmd_status();
			$data['cmd_kompetensi_in']=$this->m_admin_kredensial->cmd_kompetensi_in($this->session->mas_kred);
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['id_kompetensi']  = set_value('id_kompetensi',$this->input->post('id_kompetensi'));
				$data['id_instansi']  = set_value('id_instansi',$this->input->post('id_instansi'));
				$data['nama_form']  = set_value('nama_form',$this->input->post('nama_form'));
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_tambah'){
      	$id_jenis_form = $this->input->post('id_jenis_form');
      	$id_kompetensi = $this->input->post('id_kompetensi');
      	$id_instansi = $this->input->post('id_instansi');
		 		$kondisi=array('id_instansi'=>$id_instansi,'id_kompetensi'=>$id_kompetensi,'id_jenis_form'=>$id_jenis_form);
				$jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
//				if($jml == 0){
				  if($this->m_admin_kredensial->simpan_nkr_form()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('admin_kredensial/form9b'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
						redirect(base_url('admin_kredensial/form9b'));
				  }
/*				}else{
					$this->session->set_flashdata('danger', 'Data Sudah Ada');
					redirect(base_url('admin_kredensial/form9b'));				
				}*/
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('nkr_form','id_form',$data['id']);
				$data['id_form']  = set_value('id_form',$keuangan["id_form"]);
				$data['barcode_form']  = set_value('barcode_form',$keuangan["barcode_form"]);
				$data['id_kompetensi']  = set_value('id_kompetensi',$keuangan["id_kompetensi"]);
				$data['id_instansi']  = set_value('id_instansi',$keuangan["id_instansi"]);
				$data['id_jenis_form']  = set_value('id_jenis_form',$keuangan["id_jenis_form"]);
				$data['pembuat_form']  = set_value('pembuat_form',$keuangan["pembuat_form"]);
				$data['nama_form']  = set_value('nama_form',$keuangan["nama_form"]);
				$data['status_form']  = set_value('status_form',$keuangan["status_form"]);
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_edit'){
	    	$pembuat_form = $this->input->post('pembuat_form');
	    	$id_jenis_form = $this->input->post('id_jenis_form');
      	$id_kompetensi = $this->input->post('id_kompetensi');
      	$id_instansi = $this->input->post('id_instansi');
		 		$kondisi=array('id_instansi'=>$id_instansi,'id_kompetensi'=>$id_kompetensi,'id_jenis_form'=>$id_jenis_form);
				$jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
	//			if($jml == 0){
		    	if($this->session->id_pegawai == $pembuat_form){
					  if($this->m_admin_kredensial->edit_nkr_form()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('admin_kredensial/form9b'));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('admin_kredensial/form9b'));
					  }
		    	}else{
							$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
							redirect(base_url('admin_kredensial/form9b'));    		
					}
/*				}else{
					$this->session->set_flashdata('danger', 'Data Sudah Ada');
					redirect(base_url('admin_kredensial/form9b')); 					
				}*/
      }
      if($mode=='seting'){
        $data['page'] =  $data['page']."_seting";
		 		$kondisi=array('barcode_form'=>$data['id']);
				$jml = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi);
				if($jml == 0){
						$this->session->set_flashdata('danger', 'Data Tidak Valid');
						redirect(base_url('admin_kredensial/form3'));
				}
				$data['nkr_asesmen']	= $this->m_admin_kredensial->ambil_nkr_kaji_ulang(13);
				$d	= $this->m_admin_kredensial->ambil_nkr_form($data['id']);
				$data['id_form']  = set_value('id_form',$d["id_form"]);
				$data['barcode_form']  = set_value('barcode_form',$d["barcode_form"]);
				$data['nama_kompetensi']  = set_value('nama_kompetensi',$d["nama_kompetensi"]);
				$data['kode_unit']  = set_value('kode_unit',$d["kode_unit"]);
				$data['nama_jabatan']  = set_value('nama_jabatan',$d["nama_jabatan"]);
				$this->tampil($data);
				$action = $this->input->post('action');
				if($action == 'BtnProses') {
		      $id   = $this->input->post('id');
		      $id2   = $this->input->post('id2');
		      $id3   = $this->input->post('id3');
					redirect(base_url('admin_kredensial/form9b/seting/'.$data['id'].'/'.$id2.'/'.$id3));
				}
				if($action == 'BtnSimpan') {
		      $id   = $this->input->post('id');
		      $id2   = $this->input->post('id2');
		      $id3   = $this->input->post('id3');
		      $id4   = $this->input->post('id4');
					$this->m_admin_kredensial->simpan_form_kaji_ulang();
					$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
					redirect(base_url('admin_kredensial/form9b/seting/'.$data['id'].'/'.$id2.'/'.$id3));
				} 
	  	}
      if($mode=='urutan'){
        $data['page'] =  $data['page']."_urutan";
				$kondisi=array('id_form_detil'=>$data['id']);
				$keuangan    = $this->m_umum->ambil_data_kondisi_2tabel_row('nkr_form_detil',$kondisi,'nkr_form','barcode_form');
				$data['no_urut_detil']  = set_value('no_urut_detil',$keuangan["no_urut_detil"]);
				$data['id_form_detil']  = set_value('id_form_detil',$keuangan["id_form_detil"]);
				$data['id_jenis_form']  = set_value('id_jenis_form',$keuangan["id_jenis_form"]);
				$data['barcode_form']  = set_value('barcode_form',$keuangan["barcode_form"]);
				$data['id_kompetensi']  = set_value('id_kompetensi',$keuangan["id_kompetensi"]);
				$data['id_instansi']  = set_value('id_instansi',$keuangan["id_instansi"]);
				$data['pembuat_form']  = set_value('pembuat_form',$keuangan["pembuat_form"]);
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_urutan'){
	    	$pembuat_form = $this->input->post('pembuat_form');
	    	$barcode_form = $this->input->post('barcode_form');
		    	if($this->session->id_pegawai == $pembuat_form){
					  if($this->m_admin_kredensial->edit_urutan_detil()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('admin_kredensial/form9b/seting/'.$barcode_form));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('admin_kredensial/form9b/seting/'.$barcode_form));
					  }
		    	}else{
							$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
							redirect(base_url('admin_kredensial/form9b/seting/'.$barcode_form));    		
					}
      }
		}
  }
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("admin_kredensial/header",$data);
	$this->load->view("admin_kredensial/isi");
	$this->load->view("footer");
	$this->load->view("admin_kredensial/jsload");
	$this->load->view("admin_kredensial/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_topol",$data);
	$this->load->view("admin_kredensial/isi");
	$this->load->view("footer");
	$this->load->view("admin_kredensial/jsload");
	$this->load->view("admin_kredensial/jscode");
}
//======================= EXCLUDE ===================================
/*  function kompetensi($mode='view')
  {
		$data['page']  = "kompetensi";
		$data['header'] = "MASTER KOMPETENSI";
		$data['title'] = "MASTER KOMPETENSI";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program',32);
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
			echo json_encode($this->m_admin_kredensial->kompetensi_all($this->session->mas_kred));
		}
		else{
			$data['cmd_status'] = $this->m_rancak->cmd_status();
			if ( $this->session->has_userdata('id_level') && $this->session->userdata('id_level')==99 ){
				$data['cmd_jabatan'] = $this->m_rancak->cmd_jabatan();
			}else{
				$data['cmd_jabatan'] = $this->m_rancak->ambil_data_jabatan_in($this->session->mas_kred);				
			}

	    if($mode=='tambah'){
	      $data['page'] =  $data['page']."_tambah";
					$data['nama_kompetensi']  = set_value('nama_kompetensi',$this->input->post('nama_kompetensi'));
					$data['kode_unit']  = set_value('kode_unit',$this->input->post('kode_unit'));
					$data['id_jabatan']  = set_value('id_jabatan',$this->input->post('id_jabatan'));
					$data['deskripsi_kompetensi']  = set_value('deskripsi_kompetensi',$this->input->post('deskripsi_kompetensi'));
					$this->load->view("admin_kredensial/isi",$data);
	    }
	    if($mode=='simpan_tambah'){
				  if($this->m_admin_kredensial->simpan_nkr_kompetensi()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('admin_kredensial/kompetensi'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
						redirect(base_url('admin_kredensial/kompetensi'));
				  }
	    }
	    if($mode=='edit'){
	      $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('nkr_kompetensi','id_kompetensi',$data['id']);
				$data['id_kompetensi']  = set_value('id_kompetensi',$keuangan["id_kompetensi"]);
				$data['nama_kompetensi']  = set_value('nama_kompetensi',$keuangan["nama_kompetensi"]);
				$data['kode_unit']  = set_value('kode_unit',$keuangan["kode_unit"]);
				$data['id_jabatan']  = set_value('id_jabatan',$keuangan["id_jabatan"]);
				$data['deskripsi_kompetensi']  = set_value('deskripsi_kompetensi',$keuangan["deskripsi_kompetensi"]);
				$data['status_kompetensi']  = set_value('status_kompetensi',$keuangan["status_kompetensi"]);
				$data['creator_kompetensi']  = set_value('creator_kompetensi',$keuangan["creator_kompetensi"]);
				$this->load->view("admin_kredensial/isi",$data);
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
								redirect(base_url('admin_kredensial/kompetensi'));
						  }else{
								$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
								redirect(base_url('admin_kredensial/kompetensi'));
						  }
			    	}else{
								$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
								redirect(base_url('admin_kredensial/kompetensi'));    		
						}
		    	}else{
							$this->session->set_flashdata('danger', 'Data Sudah Dipakai Validasi');
							redirect(base_url('admin_kredensial/kompetensi'));    		
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
				$this->load->view("admin_kredensial/isi",$data);
	    }
	    if($mode=='simpan_syarat'){
						  if($this->m_admin_kredensial->edit_syarat_kompetensi()){
								$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
								redirect(base_url('admin_kredensial/kompetensi'));
						  }else{
								$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
								redirect(base_url('admin_kredensial/kompetensi'));
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
		$program = $this->m_umum->ambil_data('a_program','id_program',32);
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
				redirect(base_url('admin_kredensial/kewenangan/view/'.$key));
			}
		}
    else if($mode=='data'){
			$key = urldecode(trim($this->uri->segment(4, 0)));
			$key = strtolower($key);
			$key = preg_replace('/[^A-Za-z0-9\-]/', '', $key);
			$key = str_replace(' ', '-', $key);
			echo json_encode($this->m_admin_kredensial->kewenangan_all($key,$this->session->mas_kred));
		}
		else{
			$data['cmd_kompetensi']=$this->m_kredensial->cmd_kompetensi_in($this->session->mas_kred);
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['id_kompetensi']  = set_value('id_kompetensi',$this->input->post('id_kompetensi'));
				$data['nama_kewenangan']  = set_value('nama_kewenangan',$this->input->post('nama_kewenangan'));
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($this->m_admin_kredensial->simpan_nkr_kewenangan()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('admin_kredensial/kewenangan'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('admin_kredensial/kewenangan'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('nkr_kewenangan','id_kewenangan',$data['key']);
				$data['id_kompetensi']  = set_value('id_kompetensi',$keuangan["id_kompetensi"]);
				$data['nama_kewenangan']  = set_value('nama_kewenangan',$keuangan["nama_kewenangan"]);
				$data['id_kewenangan']  = set_value('id_kewenangan',$keuangan["id_kewenangan"]);
				$data['creator_kewenangan']  = set_value('creator_kewenangan',$keuangan["creator_kewenangan"]);
				$this->load->view("admin_kredensial/isi",$data);
      }
      if($mode=='simpan_edit'){
		 		$kondisi=array('id_kewenangan'=>$id_kewenangan);
				$jml = $this->m_umum->jumlah_record_filter('ol_logbook',$kondisi);
				if($jml == 0){
	    	$creator_kewenangan = $this->input->post('creator_kewenangan');
		    	if($this->session->id_pegawai == $creator_kewenangan){
					  if($this->m_admin_kredensial->edit_nkr_kewenangan()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('admin_kredensial/kewenangan'));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('admin_kredensial/kewenangan'));
					  }
		    	}else{
							$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
							redirect(base_url('admin_kredensial/kewenangan'));    		
					}
	    	}else{
						$this->session->set_flashdata('danger', 'Data Sudah Dipakai Logbook');
						redirect(base_url('admin_kredensial/kewenangan'));    		
				}
      }
		}
  }*/
// -----------------------------------------------------------END-----------------------------------------
}
