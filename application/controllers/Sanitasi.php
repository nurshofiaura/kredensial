<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Sanitasi extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
          $this->load->model('m_ol_rancak');
          $this->load->model('m_sanitasi');
          $this->login_kah();
  }
  function cek_login_kah(){
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
/*  function cek_level()
  {
  	$cek_level=$this->m_ol_rancak->cek_online_level();
      if ( $cek_level['id_level'] ==96 )
          return TRUE;
      else
        //  redirect(base_url('logout'));
         // redirect(base_url('member'));
      $this->cek_online_kah();
  }*/
  function login_kah()
  {
      if ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==99 )
          return TRUE;
      else
        //  redirect(base_url('logout'));
         // redirect(base_url('member'));
      $this->cek_online_kah();
  }
	function index(){
		$data['page']="home";
		$data['header'] = "BERANDA";
		$data['title'] = "BERANDA";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',8);
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
		$whats = $this->m_umum->ambil_data('ol_whatsnew','id_whatsnew',1);
		$data['isi_whatsnew']   = $whats['isi_whatsnew'];
		$this->tampil($data);
	}
	function ambil_analisa($id)
	{
		$data=$this->m_sanitasi->ambil_analisa($id);
		echo json_encode($data);
	}
	function ambil_rekomendasi($id)
	{
		$data=$this->m_sanitasi->ambil_rekomendasi($id);
		echo json_encode($data);
	}
  function lhu($mode='view')
  {
		$data['page']  = "lhu";
		$data['header'] = "CAPAIAN MUTU";
		$data['title'] = "CAPAIAN MUTU";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',8);
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
		$data['id'] = $this->uri->segment(4, 0);
		$data['id2'] = $this->uri->segment(5, 0);
		$data['id3'] = $this->uri->segment(6, 0);
		$data['id4'] = $this->uri->segment(7, 0);
	  $data['ambil_data_working'] = $this->m_sanitasi->ambil_data_rujukan_kab_working($this->session->list_working);
	  $data['ambil_data_unit'] = $this->m_sanitasi->ambil_data_rujukan_ol_unit($this->session->list_unit);
	  $data['all_kah'] = array('0'=>'Range Tanggal','1'=>'Semua');
    if($mode=='view'){
		if(empty($data['id'])){
			$data['id'] = '01-01-'.date('Y');
		}
		if(empty($data['id2'])){
			$data['id2'] = date('d-m-Y');
		}
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$first_date = $this->input->post("id");
				$last_date = $this->input->post("id2");
				$id_instansi = $this->input->post("id3");
				$id4 = $this->input->post("id4");
				redirect(base_url('sanitasi/lhu/view/'.$first_date.'/'.$last_date.'/'.$id_instansi.'/'.$id4));
			}			
		}
    else if($mode=='data'){
			if(empty($data['id'])){
				$data['id'] = '01-'.date('m-Y');
			}
			if(empty($data['id2'])){
				$data['id2'] = date('d-m-Y');
			}
			echo json_encode($this->m_sanitasi->lhu_all($data['id'],$data['id2'],$data['id3'],$data['id4']));
		}
    else if($mode=='data2'){
			echo json_encode($this->m_sanitasi->lhu_detil_all($data['id']));
		}
/*	  else if($mode=='hapus'){
	  		$look = $this->m_umum->ambil_data('sn_lhu','id_lhu',$data['id'])
	  		$kondisi=array(''.$look['tgl_lhu'].' >= '=>'tgl_laporan',''.$look['tgl_lhu'].' <= '=>'tgl_laporan');
	  		$jml = $this->m_umum->jumlah_record_filter('sn_laporan',$kondisi);
	  		if($jml == 0){
				$user_pic=$this->m_umum->ambil_data('sn_lhu','id_lhu',$data['id']);
				$cek_file=FCPATH.'assets/berkas/sanitasi/'.$user_pic['link_lhu'];
				if(file_exists($cek_file)){
					unlink(FCPATH."assets/berkas/sanitasi/".$user_pic['link_lhu']);
				}

	  		  if($this->m_umum->hapus_data('sn_lhu','id_lhu',$data['id'])){
	    			$this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
	    			redirect(base_url('sanitasi/lhu'));
	  		  }else{
	    			$this->session->set_flashdata('danger', 'Masalah Hapus Data');
	    			redirect(base_url('sanitasi/lhu'));
	  		  }*/
/*	  		 }else{
	    			$this->session->set_flashdata('danger', 'Data Sudah Masuk Laporan');
	    			redirect(base_url('sanitasi/lhu/edit/'.$data['idpeg']));
	  		 }
	  }*/
  	else{
  			$id_in =  array(1,3);
  			$data['ambil_sn_standar_mutu'] = $this->m_sanitasi->ambil_sn_standar_mutu($id_in);
	      if($mode=='tambah'){
	        $data['page'] =  $data['page']."_tambah";
					$data['id_standar_mutu']  = set_value('id_standar_mutu',$this->input->post('id_standar_mutu'));
					$data['no_lhu']  = set_value('no_lhu',$this->input->post('no_lhu'));
					$data['deskripsi_lhu']  = set_value('deskripsi_lhu',$this->input->post('deskripsi_lhu'));
					$data['id_unit']  = set_value('id_unit',$this->input->post('id_unit'));
					$data['tgl_lhu']  = set_value('tgl_lhu',date('d-m-Y'));
					$this->load->view("sanitasi/isi",$data);
	      }
	      if($mode=='simpan_tambah'){
					if($this->input->post('id_unit')){ 
							if($this->input->post('id_standar_mutu')){ 
							  if($this->m_sanitasi->simpan_sn_lhu()){
									$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
									redirect(base_url('sanitasi/lhu'));
							  }else{
									$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
									redirect(base_url('sanitasi/lhu'));
							  }
							}else{
								$this->session->set_flashdata('danger', 'Data Belum Lengkap');
								redirect(base_url('sanitasi/lhu'));									
							}
					}else{
							$this->session->set_flashdata('danger', 'Data Belum Lengkap');
							redirect(base_url('sanitasi/lhu'));						
					}
	      }
      if($mode=='upload'){
        $data['page'] =  $data['page']."_upload";
        $data['title'] = "UPLOAD BERKAS";
				$data['halaman'] = 'upload_spk';
				$pg = $this->m_umum->ambil_data('sn_lhu','barcode_lhu',$data['id']);
				$data['barcode_lhu']  = $pg['barcode_lhu'];
				$data['id_lhu']  = $pg['id_lhu'];
				$this->form_validation->set_rules('barcode_lhu','barcode_lhu','required');
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
							$uploadPath = 'assets/berkas/sanitasi/';
							$config['upload_path'] = $uploadPath;
							$config['allowed_types'] = 'pdf';
							$config['encrypt_name'] = TRUE;
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
		  				if($this->upload->do_upload('upload_File')){
								$barcode_lhu = $this->input->post('barcode_lhu');
								$user_pic=$this->m_umum->ambil_data('sn_lhu','barcode_lhu',$barcode_lhu);
								$cek_file=FCPATH.'assets/berkas/sanitasi/'.$user_pic['link_lhu'];
								if(file_exists($cek_file)){
									unlink(FCPATH."assets/berkas/sanitasi/".$user_pic['link_lhu']);
								}
		  					$fileData = $this->upload->data();
		  					$this->session->set_flashdata('sukses', 'Data berhasil Di Upload');
		  					$this->m_sanitasi->upload_sn_lhu($fileData['file_name']);
		  					redirect(base_url('sanitasi/lhu'));
		  				}else{
				        $this->session->set_flashdata('danger', 'Data Gagal Di Upload');
								redirect(base_url('sanitasi/lhu'));
		  				}
						}
				}
      }
	    if($mode=='input'){
	      $data['page'] =  $data['page']."_input";
					$keuangan = $this->m_umum->ambil_data('sn_lhu','barcode_lhu',$data['id']);
					$data['id_lhu']  = set_value('id_lhu',$keuangan["id_lhu"]);
					$data['barcode_lhu']  = set_value('barcode_lhu',$keuangan["barcode_lhu"]);
					$data['no_lhu']  = set_value('no_lhu',$keuangan["no_lhu"]);
					$data['id_unit']  = set_value('id_unit',$keuangan["id_unit"]);
					$data['id_standar_mutu']  = set_value('id_standar_mutu',$keuangan["id_standar_mutu"]);
					$data['deskripsi_lhu']  = set_value('deskripsi_lhu',$keuangan["deskripsi_lhu"]);
					$data['tgl_lhu']  = set_value('tgl_lhu',date('d-m-Y', strtotime($keuangan["tgl_lhu"])));
	      $this->form_validation->set_rules('id_standar_mutu','id_standar_mutu','required');
	      if ($this->form_validation->run() === FALSE){
	        $this->tampil($data);
	      }else{
						$barcode_lhu = $this->input->post('barcode_lhu');
						$action = $this->input->post('action');	      	
					if($action == 'BtnSave') {
					  if($this->m_sanitasi->edit_sn_lhu()){
							$this->session->set_flashdata('sukses', 'Barang berhasil Di Simpan');
							redirect(base_url('sanitasi/lhu/input/'.$barcode_lhu));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data');
							redirect(base_url('sanitasi/lhu/input/'.$barcode_lhu));
					  }
					}
	      }
	    }
      if($mode=='isi'){
        $data['page'] =  $data['page']."_isi";
				$keuangan = $this->m_umum->ambil_data('sn_lhu','barcode_lhu',$data['id']);
				$data['ambil_limbah']=$this->m_sanitasi->ambil_limbah_no_null($keuangan['id_standar_mutu']);
				$data['ambil_sn_sumber_emisi']=$this->m_sanitasi->ambil_sn_sumber_emisi($keuangan['id_standar_mutu']);
				$data['ambil_sn_tps'] = $this->m_sanitasi->ambil_sn_tps();
				$data['id_lhu']  = set_value('id_lhu',$keuangan["id_lhu"]);
				$data['barcode_lhu']  = set_value('barcode_lhu',$keuangan["barcode_lhu"]);
					$data['id_limbah']  = set_value('id_limbah',$this->input->post("id_limbah"));
					$data['id_sumber_emisi']  = set_value('id_sumber_emisi',$this->input->post("id_sumber_emisi"));
					$data['id_tps']  = set_value('id_tps',$this->input->post("id_tps"));
					$data['hasil_lhu_detil']  = set_value('hasil_lhu_detil',$this->input->post("hasil_lhu_detil"));
					$data['output_lhu_detil']  = set_value('output_lhu_detil',$this->input->post("output_lhu_detil"));
					$data['ket_lhu_detil']  = set_value('ket_lhu_detil',$this->input->post("ket_lhu_detil"));
				$this->load->view("sanitasi/isi",$data);
      }
      if($mode=='simpan_isi'){
      	$barcode_lhu = $this->input->post('barcode_lhu');
      	$id_lhu = $this->input->post('id_lhu');
      	$id_limbah = $this->input->post('id_limbah');
      	$id_sumber_emisi = $this->input->post('id_sumber_emisi');
		 		$kondisi_peg=array('id_limbah'=>$id_limbah,'id_lhu'=>$id_lhu,'id_sumber_emisi'=>$id_sumber_emisi);
				$jml = $this->m_umum->jumlah_record_filter('sn_lhu_detil',$kondisi_peg);
				if($jml == 0){      	
				  if($this->m_sanitasi->simpan_sn_lhu_detil()){
						$this->session->set_flashdata('sukses', 'Barang berhasil Di Simpan');
						redirect(base_url('sanitasi/lhu/input/'.$barcode_lhu));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data');
						redirect(base_url('sanitasi/lhu/input/'.$barcode_lhu));
				  }
				}else{
						$this->session->set_flashdata('danger', 'Data Sudah Ada, Silahkan Edit Data');
						redirect(base_url('sanitasi/lhu/input/'.$barcode_lhu));					
				}
      }
      if($mode=='rubah'){
        $data['page'] =  $data['page']."_rubah";
				$keuangan = $this->m_umum->ambil_data('sn_lhu','barcode_lhu',$data['id']);
				$lhud = $this->m_umum->ambil_data('sn_lhu_detil','id_lhu_detil',$data['id2']);
				$data['ambil_limbah']=$this->m_sanitasi->ambil_limbah_no_null($keuangan['id_standar_mutu']);
				  			$data['ambil_sn_tps'] = $this->m_sanitasi->ambil_sn_tps();
								$data['ambil_sn_sumber_emisi']=$this->m_sanitasi->ambil_sn_sumber_emisi($keuangan['id_standar_mutu']);
				$data['id_lhu']  = set_value('id_lhu',$keuangan["id_lhu"]);
				$data['barcode_lhu']  = set_value('barcode_lhu',$keuangan["barcode_lhu"]);
					$data['id_lhu_detil']  = set_value('id_lhu_detil',$lhud["id_lhu_detil"]);
					$data['id_limbah']  = set_value('id_limbah',$lhud["id_limbah"]);
					$data['id_tps']  = set_value('id_tps',$lhud["id_tps"]);
					$data['id_sumber_emisi']  = set_value('id_sumber_emisi',$lhud["id_sumber_emisi"]);
					$data['hasil_lhu_detil']  = set_value('hasil_lhu_detil',round($lhud["hasil_lhu_detil"],3));
					$data['output_lhu_detil']  = set_value('output_lhu_detil',round($lhud["output_lhu_detil"],3));
					$data['ket_lhu_detil']  = set_value('ket_lhu_detil',$lhud["ket_lhu_detil"]);
				$this->load->view("sanitasi/isi",$data);
      }
      if($mode=='simpan_rubah'){
      	$barcode_lhu = $this->input->post('barcode_lhu');
/*      	$id_lhu = $this->input->post('id_lhu');
      	$id_limbah = $this->input->post('id_limbah');
		 		$kondisi_peg=array('id_limbah'=>$id_limbah,'id_lhu'=>$id_lhu);
				$jml = $this->m_umum->jumlah_record_filter('sn_lhu_detil',$kondisi_peg);
				if($jml == 0){ */     	
				  if($this->m_sanitasi->edit_sn_lhu_detil()){
						$this->session->set_flashdata('sukses', 'Barang berhasil Di Simpan');
						redirect(base_url('sanitasi/lhu/input/'.$barcode_lhu));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data');
						redirect(base_url('sanitasi/lhu/input/'.$barcode_lhu));
				  }
/*				}else{
						$this->session->set_flashdata('danger', 'Data Sudah Ada, Silahkan Edit Data');
						redirect(base_url('sanitasi/lhu/input/'.$barcode_lhu));					
				}*/
      }
	    if($mode=='set'){
	      $data['page'] =  $data['page']."_set";
					$keuangan = $this->m_umum->ambil_data('sn_lhu','barcode_lhu',$data['id']);
				$data['id_lhu']  = set_value('id_lhu',$keuangan["id_lhu"]);
				$data['barcode_lhu']  = set_value('barcode_lhu',$keuangan["barcode_lhu"]);
				$data['ambil_limbah']=$this->m_sanitasi->ambil_limbah($keuangan['id_standar_mutu']);
				$data['terpilih'] = set_value('terpilih',explode("-", $data['id2']));
					$data['hasil_lhu_detil']  = set_value('hasil_lhu_detil',$this->input->post("hasil_lhu_detil"));
					$data['max_lhu_detil']  = set_value('max_lhu_detil',$this->input->post("max_lhu_detil"));
					$data['ket_lhu_detil']  = set_value('ket_lhu_detil',$this->input->post("ket_lhu_detil"));
	      $this->form_validation->set_rules('id_lhu','id_lhu','required');
	      if ($this->form_validation->run() === FALSE){
	        $this->tampil($data);
	      }else{
	      		$barcode_lhu = $this->input->post('barcode_lhu');
			  		$this->m_sanitasi->extract_sn_lhu_detil();
						$this->session->set_flashdata('sukses', 'Barang berhasil Di Simpan');
						redirect(base_url('sanitasi/lhu/input/'.$barcode_lhu));
	      }
	    }
		}
  }
  function laporan($mode='view')
  {
		$data['page']  = "laporan";
		$data['header'] = "LAPORAN CAPAIAN INDIKATOR MUTU";
		$data['title'] = "LAPORAN CAPAIAN INDIKATOR MUTU";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',8);
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
		$data['id'] = $this->uri->segment(4, 0);
		$data['id2'] = $this->uri->segment(5, 0);
		$data['id3'] = $this->uri->segment(6, 0);
		$data['id4'] = $this->uri->segment(7, 0);
		$data['id5'] = $this->uri->segment(8, 0);
		$data['id6'] = $this->uri->segment(9, 0);
		$data['ambil_data_working'] = $this->m_sanitasi->ambil_data_rujukan_kab_working($this->session->list_working);
		$data['ambil_data_unit'] = $this->m_sanitasi->ambil_data_rujukan_ol_unit($this->session->list_unit);
		$id_in =  array(1,3);
		$data['ambil_sn_standar_mutu'] = $this->m_sanitasi->ambil_sn_standar_mutu($id_in);
		$data['cmd_jabatan'] = $this->m_rancak->cmd_jabatan();
	  $data['all_kah'] = array('0'=>'Range Tanggal','1'=>'Semua');
	  $data['kategori_kah'] = array('0'=>'Semua','1'=>'Sesuai Kategori');
    if($mode=='view'){
			if(empty($data['id'])){
				$data['id'] = '01-01-'.date('Y');
			}
			if(empty($data['id2'])){
				$data['id2'] = date('d-m-Y');
			} 
			$this->tampil($data);  
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$first_date = $this->input->post("id");
				$last_date = $this->input->post("id2");
				$id_instansi = $this->input->post("id3");
				$id_standar_mutu = $this->input->post("id4");
				$id5 = $this->input->post("id5");  // tanggal
				$id6 = $this->input->post("id6");  // kategori
				redirect(base_url('sanitasi/laporan/view/'.$first_date.'/'.$last_date.'/'.$id_instansi.'/'.$id_standar_mutu.'/'.$id5.'/'.$id6));
			}
		}
    else if($mode=='data'){
			if(empty($data['id'])){
				$data['id'] = '01-'.date('m-Y');
			}
			if(empty($data['id2'])){
				$data['id2'] = date('d-m-Y');
			}    	
			echo json_encode($this->m_sanitasi->laporan_all($data['id'],$data['id2'],$data['id3'],$data['id4'],$data['id5'],$data['id6']));
		}
    else if($mode=='data2'){  	
			echo json_encode($this->m_sanitasi->laporan_tabel_all($data['id']));
		}
    else if($mode=='pie'){
    	$ambil_semua_reoord_kondisi = $this->m_sanitasi->ambil_semua_reoord_kondisi($data['id2']);
			echo json_encode($this->m_sanitasi->grafik_pie($data['id2'],$ambil_semua_reoord_kondisi));
		}
    else if($mode=='batang_persen'){
    	$ambil_semua_reoord_kondisi = $this->m_sanitasi->ambil_semua_reoord_kondisi($data['id2']);
			echo json_encode($this->m_sanitasi->grafik_batang_persen($data['id2'],$ambil_semua_reoord_kondisi));
		}
    else if($mode=='batang_range'){
			echo json_encode($this->m_sanitasi->grafik_batang_range($data['id2']));
		}
  	else{
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
					$data['tgl_laporan']  = set_value('tgl_laporan',date('d-m-Y'));
					$data['tgl_awal']  = set_value('tgl_awal',date('d-m-Y'));
					$data['tgl_akhir']  = set_value('tgl_akhir',date('d-m-Y'));
					$data['id_standar_mutu']  = set_value('id_standar_mutu',$this->input->post("id_standar_mutu"));
					$data['id_unit']  = set_value('id_unit',$this->input->post("id_unit"));

					$data['header_profil']  = set_value('header_profil',$this->input->post("header_profil"));
					$data['sub_header_profil']  = set_value('sub_header_profil',$this->input->post("sub_header_profil"));
					$data['sejarah']  = set_value('sejarah',$this->input->post("sejarah"));
					$data['visi_misi']  = set_value('visi_misi',$this->input->post("visi_misi"));
					$data['tujuan_fungsi']  = set_value('tujuan_fungsi',$this->input->post("tujuan_fungsi"));
					$data['informasi_layanan']  = set_value('informasi_layanan',$this->input->post("informasi_layanan"));

					$data['header_laporan']  = set_value('header_laporan',$this->input->post("header_laporan"));
					$data['sub_header_laporan']  = set_value('sub_header_laporan',$this->input->post("sub_header_laporan"));
					$data['sub_sub_header_laporan']  = set_value('sub_sub_header_laporan',$this->input->post("sub_sub_header_laporan"));
					$data['judul_laporan']  = set_value('judul_laporan',$this->input->post("judul_laporan"));
					$data['dimensi_laporan']  = set_value('dimensi_laporan',$this->input->post("dimensi_laporan"));
					$data['tujuan_laporan']  = set_value('tujuan_laporan',$this->input->post("tujuan_laporan"));
					$data['definisi_laporan']  = set_value('definisi_laporan',$this->input->post("definisi_laporan"));
					$data['dasar_laporan']  = set_value('dasar_laporan',$this->input->post("dasar_laporan"));
					$data['frekuensi_laporan']  = set_value('frekuensi_laporan',$this->input->post("frekuensi_laporan"));
					$data['periode_laporan']  = set_value('periode_laporan',$this->input->post("periode_laporan"));
					$data['numerator_laporan']  = set_value('numerator_laporan',$this->input->post("numerator_laporan"));
					$data['denominator_laporan']  = set_value('denominator_laporan',$this->input->post("denominator_laporan"));
					$data['sumber_laporan']  = set_value('sumber_laporan',$this->input->post("sumber_laporan"));
					$data['standar_laporan']  = set_value('standar_laporan',$this->input->post("standar_laporan"));
					$data['teknis_laporan']  = set_value('teknis_laporan',$this->input->post("teknis_laporan"));
					$data['tgjawab_laporan']  = set_value('tgjawab_laporan',$this->input->post("tgjawab_laporan"));
					$data['pengumpul_data']  = set_value('pengumpul_data',$this->input->post("pengumpul_data"));
					$this->form_validation->set_rules('id_standar_mutu','id_standar_mutu','required');
        if ($this->form_validation->run() === FALSE){
					$this->tampil($data);
        }else{
					$this->m_sanitasi->simpan_sn_laporan();
					$this->session->set_flashdata('sukses', 'Data Sudah Di Tambah');
					redirect(base_url('sanitasi/laporan'));
        }
      }
     if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
					$keuangan = $this->m_umum->ambil_data('sn_laporan','barcode_laporan',$data['id']);
					$data['tgl_laporan']  = set_value('tgl_laporan',date('d-m-Y', strtotime($keuangan["tgl_laporan"])));
					$data['tgl_awal']  = set_value('tgl_awal',date('d-m-Y', strtotime($keuangan["tgl_awal"])));
					$data['tgl_akhir']  = set_value('tgl_akhir',date('d-m-Y', strtotime($keuangan["tgl_akhir"])));
					$data['id_laporan']  = set_value('id_laporan',$keuangan["id_laporan"]);
					$data['barcode_laporan']  = set_value('barcode_laporan',$keuangan["barcode_laporan"]);
					$data['id_standar_mutu']  = set_value('id_standar_mutu',$keuangan["id_standar_mutu"]);
					$data['id_unit']  = set_value('id_unit',$keuangan["id_unit"]);
					$data['header_profil']  = set_value('header_profil',$keuangan["header_profil"]);
					$data['sub_header_profil']  = set_value('sub_header_profil',$keuangan["sub_header_profil"]);
					$data['sejarah']  = set_value('sejarah',$keuangan["sejarah"]);
					$data['visi_misi']  = set_value('visi_misi',$keuangan["visi_misi"]);
					$data['tujuan_fungsi']  = set_value('tujuan_fungsi',$keuangan["tujuan_fungsi"]);
					$data['informasi_layanan']  = set_value('informasi_layanan',$keuangan["informasi_layanan"]);

					$data['header_laporan']  = set_value('header_laporan',$keuangan["header_laporan"]);
					$data['sub_header_laporan']  = set_value('sub_header_laporan',$keuangan["sub_header_laporan"]);
					$data['sub_sub_header_laporan']  = set_value('sub_sub_header_laporan',$keuangan["sub_sub_header_laporan"]);
					$data['judul_laporan']  = set_value('judul_laporan',$keuangan["judul_laporan"]);
					$data['dimensi_laporan']  = set_value('dimensi_laporan',$keuangan["dimensi_laporan"]);
					$data['tujuan_laporan']  = set_value('tujuan_laporan',$keuangan["tujuan_laporan"]);
					$data['definisi_laporan']  = set_value('definisi_laporan',$keuangan["definisi_laporan"]);
					$data['dasar_laporan']  = set_value('dasar_laporan',$keuangan["dasar_laporan"]);
					$data['frekuensi_laporan']  = set_value('frekuensi_laporan',$keuangan["frekuensi_laporan"]);
					$data['periode_laporan']  = set_value('periode_laporan',$keuangan["periode_laporan"]);
					$data['numerator_laporan']  = set_value('numerator_laporan',$keuangan["numerator_laporan"]);
					$data['denominator_laporan']  = set_value('denominator_laporan',$keuangan["denominator_laporan"]);
					$data['sumber_laporan']  = set_value('sumber_laporan',$keuangan["sumber_laporan"]);
					$data['standar_laporan']  = set_value('standar_laporan',$keuangan["standar_laporan"]);
					$data['teknis_laporan']  = set_value('teknis_laporan',$keuangan["teknis_laporan"]);
					$data['tgjawab_laporan']  = set_value('tgjawab_laporan',$keuangan["tgjawab_laporan"]);
					$data['pengumpul_data']  = set_value('pengumpul_data',$keuangan["pengumpul_data"]);
					$this->form_validation->set_rules('id_standar_mutu','id_standar_mutu','required');
        if ($this->form_validation->run() === FALSE){
					$this->tampil($data);
        }else{
					$this->m_sanitasi->edit_sn_laporan();
					$this->session->set_flashdata('sukses', 'Data Sudah Di Rubah');
					redirect(base_url('sanitasi/laporan'));
        }
      }
      if($mode=='urutan'){
        $data['page'] =  $data['page']."_urutan";
				$keuangan = $this->m_umum->ambil_data('sn_laporan_tabel','id_laporan_tabel',$data['id2']);
				$data['id_laporan_tabel']  = set_value('id_laporan_tabel',$keuangan["id_laporan_tabel"]);
				$data['urutan_laporan_tabel']  = set_value('urutan_laporan_tabel',$keuangan["urutan_laporan_tabel"]);
				$this->load->view("sanitasi/isi",$data);
      }
      if($mode=='simpan_urutan'){
				$barcode_laporan = $this->input->post("barcode_laporan");
				if($this->input->post("urutan_laporan_tabel")){  	
				  if($this->m_sanitasi->edit_urutan_laporan_tabel()){
						$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
						redirect(base_url('sanitasi/laporan/edit/'.$barcode_laporan));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data');
						redirect(base_url('sanitasi/laporan/edit/'.$barcode_laporan));
				  }
				}else{
						$this->session->set_flashdata('danger', 'Data Belum Lengkap');
						redirect(base_url('sanitasi/laporan/edit/'.$barcode_laporan));					
				}
      }
      if($mode=='regulasi'){
        $data['page'] =  $data['page']."_regulasi";
        $data['title'] = "UPLOAD REGULASI / BERKAS TERKAIT";
				$pg = $this->m_umum->ambil_data('sn_laporan','barcode_laporan',$data['id']);
				$data['ol_berkas']  = $this->m_sanitasi->ol_berkas_not_in($pg['regulasi'],'50');
				$data['ol_berkas_in']  = $this->m_sanitasi->ol_berkas_in($pg['regulasi'],'50');
				$data['barcode_laporan']  = $pg['barcode_laporan'];
				$data['judul_laporan']  = $pg['judul_laporan'];
				$data['regulasi']  = $pg['regulasi'];
				$data['id_laporan']  = $pg['id_laporan'];
				$data['link_awal'] = base_url('sanitasi/laporan');
				$data['no_berkas']  = set_value('no_berkas',$this->input->post('no_berkas'));
				$data['nama_berkas']  = set_value('nama_berkas',$this->input->post('nama_berkas'));
				$this->tampil($data);
				$action = $this->input->post('action');
				if($action == 'BtnUpload') {
		  		$barcode_laporan = $this->input->post("barcode_laporan");
						$data = array();
						$filesCount = count($_FILES['upload_Files']['name']);
						for($i = 0; $i < $filesCount; $i++){
							$_FILES['upload_File']['name'] = $_FILES['upload_Files']['name'][$i];
							$_FILES['upload_File']['type'] = $_FILES['upload_Files']['type'][$i];
							$_FILES['upload_File']['tmp_name'] = $_FILES['upload_Files']['tmp_name'][$i];
							$_FILES['upload_File']['error'] = $_FILES['upload_Files']['error'][$i];
							$_FILES['upload_File']['size'] = $_FILES['upload_Files']['size'][$i];
							$uploadPath = 'assets/berkas/im/';
							$config['upload_path'] = $uploadPath;
							$config['allowed_types'] = 'pdf';
							$config['encrypt_name'] = TRUE;
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
		  				if($this->upload->do_upload('upload_File')){
		  					$fileData = $this->upload->data();
		  					$last_id = $this->m_sanitasi->simpan_berkas_file($fileData['file_name'],'50');
		  					$this->m_sanitasi->edit_laporan_regulasi($barcode_laporan,$last_id);
		  					$this->session->set_flashdata('sukses', 'Data berhasil Di Upload');
								redirect(base_url('sanitasi/laporan/regulasi/'.$barcode_laporan));
		  				}else{
				        $this->session->set_flashdata('danger', 'Data Gagal Di Upload');
								redirect(base_url('sanitasi/laporan/regulasi/'.$barcode_laporan));
		  				}
						}
				}
				if($action == 'BtnSimpan') {
					$barcode_laporan = $this->input->post("barcode_laporan");
//					if($this->input->post('chk')){
						$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
						$this->m_sanitasi->edit_chk_regulasi();
/*					}else{
						$this->session->set_flashdata('danger', 'Belum Ada Berkas Terpilih');
					}*/
					redirect(base_url('sanitasi/laporan/regulasi/'.$barcode_laporan));
				}
      }
      if($mode=='berkas'){
        $data['page'] =  $data['page']."_berkas";
        $data['title'] = "UPLOAD BERKAS";
				$pg = $this->m_umum->ambil_data('sn_laporan','barcode_laporan',$data['id']);
				$data['ol_berkas']  = $this->m_sanitasi->ol_berkas_not_in($pg['berkas_laporan'],'50');
				$data['ol_berkas_in']  = $this->m_sanitasi->ol_berkas_in($pg['berkas_laporan'],'50');
				$data['barcode_laporan']  = $pg['barcode_laporan'];
				$data['judul_laporan']  = $pg['judul_laporan'];
				$data['berkas_laporan']  = $pg['berkas_laporan'];
				$data['id_laporan']  = $pg['id_laporan'];
				$data['link_awal'] = base_url('sanitasi/laporan');
				$data['no_berkas']  = set_value('no_berkas',$this->input->post('no_berkas'));
				$data['nama_berkas']  = set_value('nama_berkas',$this->input->post('nama_berkas'));
				$this->tampil($data);
				$action = $this->input->post('action');
				if($action == 'BtnUpload') {
		  		$barcode_laporan = $this->input->post("barcode_laporan");
						$data = array();
						$filesCount = count($_FILES['upload_Files']['name']);
						for($i = 0; $i < $filesCount; $i++){
							$_FILES['upload_File']['name'] = $_FILES['upload_Files']['name'][$i];
							$_FILES['upload_File']['type'] = $_FILES['upload_Files']['type'][$i];
							$_FILES['upload_File']['tmp_name'] = $_FILES['upload_Files']['tmp_name'][$i];
							$_FILES['upload_File']['error'] = $_FILES['upload_Files']['error'][$i];
							$_FILES['upload_File']['size'] = $_FILES['upload_Files']['size'][$i];
							$uploadPath = 'assets/berkas/im/';
							$config['upload_path'] = $uploadPath;
							$config['allowed_types'] = 'pdf';
							$config['encrypt_name'] = TRUE;
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
		  				if($this->upload->do_upload('upload_File')){
		  					$fileData = $this->upload->data();
		  					$last_id = $this->m_sanitasi->simpan_berkas_file($fileData['file_name'],'50');
		  					$this->m_sanitasi->edit_laporan_berkas_laporan($barcode_laporan,$last_id);
		  					$this->session->set_flashdata('sukses', 'Data berhasil Di Upload');
								redirect(base_url('sanitasi/laporan/berkas/'.$barcode_laporan));
		  				}else{
				        $this->session->set_flashdata('danger', 'Data Gagal Di Upload');
								redirect(base_url('sanitasi/laporan/berkas/'.$barcode_laporan));
		  				}
						}
				}
				if($action == 'BtnSimpan') {
					$barcode_laporan = $this->input->post("barcode_laporan");
//					if($this->input->post('chk')){
						$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
						$this->m_sanitasi->edit_chk_berkas();
/*					}else{
						$this->session->set_flashdata('danger', 'Belum Ada Berkas Terpilih');
					}*/
					redirect(base_url('sanitasi/laporan/berkas/'.$barcode_laporan));
				}
      }
      if($mode=='struktur'){
        $data['page'] =  $data['page']."_struktur";
        $data['title'] = "UPLOAD STRUKTUR ORGANISASI";
				$pg = $this->m_umum->ambil_data('sn_laporan','barcode_laporan',$data['id']);
				$data['ol_berkas']  = $this->m_sanitasi->ol_berkas_not_in($pg['struktur_organisasi'],'60');
				$data['ol_berkas_in']  = $this->m_sanitasi->ol_berkas_in($pg['struktur_organisasi'],'60');
				$data['barcode_laporan']  = $pg['barcode_laporan'];
				$data['judul_laporan']  = $pg['judul_laporan'];
				$data['struktur_organisasi']  = $pg['struktur_organisasi'];
				$data['id_laporan']  = $pg['id_laporan'];
				$data['link_awal'] = base_url('sanitasi/laporan');
				$data['no_berkas']  = set_value('no_berkas',$this->input->post('no_berkas'));
				$data['nama_berkas']  = set_value('nama_berkas',$this->input->post('nama_berkas'));
				$this->tampil($data);
				$action = $this->input->post('action');
				if($action == 'BtnUpload') {
		  		$barcode_laporan = $this->input->post("barcode_laporan");
						$data = array();
						$filesCount = count($_FILES['upload_Files']['name']);
						for($i = 0; $i < $filesCount; $i++){
							$_FILES['upload_File']['name'] = $_FILES['upload_Files']['name'][$i];
							$_FILES['upload_File']['type'] = $_FILES['upload_Files']['type'][$i];
							$_FILES['upload_File']['tmp_name'] = $_FILES['upload_Files']['tmp_name'][$i];
							$_FILES['upload_File']['error'] = $_FILES['upload_Files']['error'][$i];
							$_FILES['upload_File']['size'] = $_FILES['upload_Files']['size'][$i];
							$uploadPath = 'assets/berkas/im/';
							$sourcePath = 'assets/berkas/resize/';
							$config['upload_path'] = $uploadPath;
							$config['allowed_types'] = 'jpg|jpeg|png';
							$config['encrypt_name'] = TRUE;
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
		  				if($this->upload->do_upload('upload_File')){
		  					$fileData = $this->upload->data();
		  		//			$this->resizeImage($fileData['file_name']);
		  		//			$this->do_resize($fileData['file_name']);
						    $resize_conf = array( 
						        'source_image' => $fileData['full_path'],  
						        'new_image'    => $sourcePath.$fileData['file_name'], 
						        'maintain_ratio' => TRUE,
						        'width'        => 150, 
						        'height'       => 150
						    );						     
						    $this->load->library('image_lib');  
						    $this->image_lib->initialize($resize_conf); 
						     
						    // do it! 
						    if ( ! $this->image_lib->resize()){ 
						        // if got fail. 
						        $this->image_lib->display_errors();	
						    }
		  					$last_id = $this->m_sanitasi->simpan_berkas_file($fileData['file_name'],'60');
		  					$this->m_sanitasi->edit_laporan_struktur($barcode_laporan,$last_id);
		  					$this->session->set_flashdata('sukses', 'Data berhasil Di Upload');
								redirect(base_url('sanitasi/laporan/struktur/'.$barcode_laporan));
		  				}else{
				        $this->session->set_flashdata('danger', 'Data Gagal Di Upload');
								redirect(base_url('sanitasi/laporan/struktur/'.$barcode_laporan));
		  				}
						}
				}
				if($action == 'BtnSimpan') {
					$barcode_laporan = $this->input->post("barcode_laporan");
//					if($this->input->post('chk')){
						$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
						$this->m_sanitasi->edit_chk_struktur();
/*					}else{
						$this->session->set_flashdata('danger', 'Belum Ada Berkas Terpilih');
					}*/
					redirect(base_url('sanitasi/laporan/struktur/'.$barcode_laporan));
				}
      }
      if($mode=='galeri'){
        $data['page'] =  $data['page']."_galeri";
        $data['title'] = "UPLOAD GAMBAR";
				$pg = $this->m_umum->ambil_data('sn_laporan','barcode_laporan',$data['id']);
				$data['ol_berkas']  = $this->m_sanitasi->ol_berkas_not_in($pg['galeri_laporan'],'60');
				$data['ol_berkas_in']  = $this->m_sanitasi->ol_berkas_in($pg['galeri_laporan'],'60');
				$data['barcode_laporan']  = $pg['barcode_laporan'];
				$data['judul_laporan']  = $pg['judul_laporan'];
				$data['galeri_laporan']  = $pg['galeri_laporan'];
				$data['id_laporan']  = $pg['id_laporan'];
				$data['link_awal'] = base_url('sanitasi/laporan');
				$data['no_berkas']  = set_value('no_berkas',$this->input->post('no_berkas'));
				$data['nama_berkas']  = set_value('nama_berkas',$this->input->post('nama_berkas'));
				$this->tampil($data);
				$action = $this->input->post('action');
				if($action == 'BtnUpload') {
		  		$barcode_laporan = $this->input->post("barcode_laporan");
						$data = array();
						$filesCount = count($_FILES['upload_Files']['name']);
						for($i = 0; $i < $filesCount; $i++){
							$_FILES['upload_File']['name'] = $_FILES['upload_Files']['name'][$i];
							$_FILES['upload_File']['type'] = $_FILES['upload_Files']['type'][$i];
							$_FILES['upload_File']['tmp_name'] = $_FILES['upload_Files']['tmp_name'][$i];
							$_FILES['upload_File']['error'] = $_FILES['upload_Files']['error'][$i];
							$_FILES['upload_File']['size'] = $_FILES['upload_Files']['size'][$i];
							$uploadPath = 'assets/berkas/im/';
							$sourcePath = 'assets/berkas/resize/';
							$config['upload_path'] = $uploadPath;
							$config['allowed_types'] = 'jpg|jpeg|png';
							$config['encrypt_name'] = TRUE;
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
		  				if($this->upload->do_upload('upload_File')){
		  					$fileData = $this->upload->data();
		  		//			$this->resizeImage($fileData['file_name']);
		  		//			$this->do_resize($fileData['file_name']);
						    $resize_conf = array( 
						        'source_image' => $fileData['full_path'],  
						        'new_image'    => $sourcePath.$fileData['file_name'], 
						        'maintain_ratio' => TRUE,
						        'width'        => 150, 
						        'height'       => 150
						    );						     
						    $this->load->library('image_lib');  
						    $this->image_lib->initialize($resize_conf); 
						     
						    // do it! 
						    if ( ! $this->image_lib->resize()){ 
						        // if got fail. 
						        $this->image_lib->display_errors();	
						    }
		  					$last_id = $this->m_sanitasi->simpan_berkas_file($fileData['file_name'],'60');
		  					$this->m_sanitasi->edit_laporan_gambar($barcode_laporan,$last_id);
		  					$this->session->set_flashdata('sukses', 'Data berhasil Di Upload');
								redirect(base_url('sanitasi/laporan/galeri/'.$barcode_laporan));
		  				}else{
				        $this->session->set_flashdata('danger', 'Data Gagal Di Upload');
								redirect(base_url('sanitasi/laporan/galeri/'.$barcode_laporan));
		  				}
						}
				}
				if($action == 'BtnSimpan') {
					$barcode_laporan = $this->input->post("barcode_laporan");
//					if($this->input->post('chk')){
						$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
						$this->m_sanitasi->edit_chk_image();
/*					}else{
						$this->session->set_flashdata('danger', 'Belum Ada Berkas Terpilih');
					}*/
					redirect(base_url('sanitasi/laporan/galeri/'.$barcode_laporan));
				}
      }
      if($mode=='print_laporan'){
        $data['page'] =  $data['page']."_print_laporan";
        $lptab = $this->m_sanitasi->ambil_sn_laporan_detil($data['id2']);
				$data['analisa_laporan_tabel']  = set_value('analisa_laporan_tabel',$lptab["analisa_laporan_tabel"]);
				$data['barcode_laporan']  = set_value('barcode_laporan',$lptab["barcode_laporan"]);		
				$data['id_laporan_tabel']  = set_value('id_laporan_tabel',$lptab["id_laporan_tabel"]);		
				$data['barcode_laporan_tabel']  = set_value('barcode_laporan_tabel',$lptab["barcode_laporan_tabel"]);		
				$data['judul_laporan_tabel']  = set_value('judul_laporan_tabel',$lptab["judul_laporan_tabel"]);		
        $this->load->view("cetak/im_laporan",$data);
      }
     if($mode=='clone'){
        $data['page'] =  $data['page']."_clone";
					$keuangan = $this->m_umum->ambil_data('sn_laporan','barcode_laporan',$data['id']);
					$data['tgl_laporan']  = set_value('tgl_laporan',date('d-m-Y', strtotime($keuangan["tgl_laporan"])));
					$data['tgl_awal']  = set_value('tgl_awal',date('d-m-Y', strtotime($keuangan["tgl_awal"])));
					$data['tgl_akhir']  = set_value('tgl_akhir',date('d-m-Y', strtotime($keuangan["tgl_akhir"])));
					$data['id_standar_mutu']  = set_value('id_standar_mutu',$keuangan["id_standar_mutu"]);
					$data['id_unit']  = set_value('id_unit',$keuangan["id_unit"]);
					$data['header_profil']  = set_value('header_profil',$keuangan["header_profil"]);
					$data['sub_header_profil']  = set_value('sub_header_profil',$keuangan["sub_header_profil"]);
					$data['sejarah']  = set_value('sejarah',$keuangan["sejarah"]);
					$data['visi_misi']  = set_value('visi_misi',$keuangan["visi_misi"]);
					$data['tujuan_fungsi']  = set_value('tujuan_fungsi',$keuangan["tujuan_fungsi"]);
					$data['informasi_layanan']  = set_value('informasi_layanan',$keuangan["informasi_layanan"]);
					$data['header_laporan']  = set_value('header_laporan',$keuangan["header_laporan"]);
					$data['sub_header_laporan']  = set_value('sub_header_laporan',$keuangan["sub_header_laporan"]);
					$data['sub_sub_header_laporan']  = set_value('sub_sub_header_laporan',$keuangan["sub_sub_header_laporan"]);
					$data['judul_laporan']  = set_value('judul_laporan',$keuangan["judul_laporan"]);
					$data['dimensi_laporan']  = set_value('dimensi_laporan',$keuangan["dimensi_laporan"]);
					$data['tujuan_laporan']  = set_value('tujuan_laporan',$keuangan["tujuan_laporan"]);
					$data['definisi_laporan']  = set_value('definisi_laporan',$keuangan["definisi_laporan"]);
					$data['dasar_laporan']  = set_value('dasar_laporan',$keuangan["dasar_laporan"]);
					$data['frekuensi_laporan']  = set_value('frekuensi_laporan',$keuangan["frekuensi_laporan"]);
					$data['periode_laporan']  = set_value('periode_laporan',$keuangan["periode_laporan"]);
					$data['numerator_laporan']  = set_value('numerator_laporan',$keuangan["numerator_laporan"]);
					$data['denominator_laporan']  = set_value('denominator_laporan',$keuangan["denominator_laporan"]);
					$data['sumber_laporan']  = set_value('sumber_laporan',$keuangan["sumber_laporan"]);
					$data['standar_laporan']  = set_value('standar_laporan',$keuangan["standar_laporan"]);
					$data['teknis_laporan']  = set_value('teknis_laporan',$keuangan["teknis_laporan"]);
					$data['tgjawab_laporan']  = set_value('tgjawab_laporan',$keuangan["tgjawab_laporan"]);
					$data['pengumpul_data']  = set_value('pengumpul_data',$keuangan["pengumpul_data"]);
					$this->form_validation->set_rules('id_standar_mutu','id_standar_mutu','required');
        if ($this->form_validation->run() === FALSE){
					$this->tampil($data);
        }else{
					$this->m_sanitasi->simpan_sn_laporan();
					$this->session->set_flashdata('sukses', 'Data Sudah Di Tambah');
					redirect(base_url('sanitasi/laporan'));
        }
      }
     if($mode=='tambah_tabel'){
        $data['page'] =  $data['page']."_tambah_tabel";
        $lptab = $this->m_umum->ambil_data('sn_laporan','barcode_laporan',$data['id']);
				$data['id_laporan']  = set_value('id_laporan',$lptab["id_laporan"]);
				$data['barcode_laporan']  = set_value('barcode_laporan',$lptab["barcode_laporan"]);						
				$data['judul_laporan_tabel']  = set_value('judul_laporan_tabel',$this->input->post("judul_laporan_tabel"));
				$data['analisa_laporan_tabel']  = set_value('analisa_laporan_tabel',$this->input->post("analisa_laporan_tabel"));
				$data['rekomendasi_laporan_tabel']  = set_value('rekomendasi_laporan_tabel',$this->input->post("rekomendasi_laporan_tabel"));
				$this->form_validation->set_rules('barcode_laporan','barcode_laporan','required');
        if ($this->form_validation->run() === FALSE){
					$this->tampil($data);
        }else{
        	$barcode_laporan = $this->input->post("barcode_laporan");
				  if($this->m_sanitasi->tambah_sn_laporan_tabel()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
						redirect(base_url('sanitasi/laporan/edit/'.$barcode_laporan));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
						redirect(base_url('sanitasi/laporan/edit/'.$barcode_laporan));
				  }
        }
      }
     if($mode=='edit_tabel'){
        $data['page'] =  $data['page']."_edit_tabel";
				$lp = $this->m_umum->ambil_data('sn_laporan','barcode_laporan',$data['id']);
				$data['max_tanggal'] = $this->m_sanitasi->max_tanggal_lhu($data['id2']);
				$data['min_tanggal'] = $this->m_sanitasi->min_tanggal_lhu($data['id2']);
				$data['ambil_semua_reoord_kondisi'] = $this->m_sanitasi->ambil_semua_reoord_kondisi($data['id2']);
				$data['jumlah_record_tabel_limbah_detil'] = $this->m_sanitasi->jumlah_record_tabel_limbah_detil($data['id2']);
				$data['jumlah_record_tabel_limbah_detil_kelola'] = $this->m_sanitasi->jumlah_record_tabel_limbah_detil_kelola($data['id2']);
				$data['jumlah_record_tabel_output'] = $this->m_sanitasi->jumlah_record_tabel_output($data['id2']);
				$data['max_standar'] = round($this->m_sanitasi->max_standar_mutu($data['id2'],3));
				$min_standar = round($this->m_sanitasi->min_standar_mutu($data['id2'],3));
				$min_range = round($this->m_sanitasi->min_range_mutu($data['id2'],3));
				$min_hasil = round($this->m_sanitasi->min_hasil($data['id2'],3));
				if($min_range == 0){
					$data['min_standar'] = $min_hasil - 10;
				}else{
					$data['min_standar'] = $min_range;
				}
        $data['jumlah_bulan'] = $this->m_rancak->hitung_jumlah_bulan($data['min_tanggal'],$data['max_tanggal']);
        $data['jumlah_record_sumber_emisi'] = $this->m_sanitasi->jumlah_record_sumber_emisi($data['id2']);
        $data['jumlah_record_tps'] = $this->m_sanitasi->jumlah_record_tps($data['id2']);
        $data['jumlah_bulan'] = $data['jumlah_bulan'] + 1;
				$data['id_laporan']  = set_value('id_laporan',$lp["id_laporan"]);
				$data['barcode_laporan']  = set_value('barcode_laporan',$lp["barcode_laporan"]);
				$lptab = $this->m_umum->ambil_data('sn_laporan_tabel','barcode_laporan_tabel',$data['id2']);
					$data['only_blnyear_lhu'] = $this->m_sanitasi->only_blnyear_lhu($data['id2'],$data['min_tanggal'],$data['max_tanggal']);
					$data['tabel_limbah_detil'] = $this->m_sanitasi->tabel_limbah_detil($data['id2']);

					$data['grafik_batang_kelola'] = $this->m_sanitasi->grafik_batang_kelola($data['id2']);

					$data['grafik_batang_range'] = $this->m_sanitasi->tabel_limbah_detil($data['id2']);
					$data['grafik_batang_range2'] = $this->m_sanitasi->grafik_only_limbah($data['id2']);
					$data['grafik_batang_range_jejer'] = $this->m_sanitasi->grafik_batang_range_jejer($data['id2']);

					$data['only_blnyear_lhu'] = $this->m_sanitasi->only_blnyear_lhu($data['id2'],$data['min_tanggal'],$data['max_tanggal']);

					$data['ambil_limbah_grafik'] = $this->m_sanitasi->ambil_limbah_grafik_aza($data['id2']);
					$data['grafik_garis_opsi'] = $this->m_sanitasi->grafik_garis_opsi($data['id2']);

					$data['ambil_dt_limbah_grafik'] = $this->m_sanitasi->ambil_dt_limbah_grafik($data['id2']);

				$data['id_laporan_tabel']  = set_value('id_laporan_tabel',$lptab["id_laporan_tabel"]);
				$data['barcode_laporan_tabel']  = set_value('barcode_laporan_tabel',$lptab["barcode_laporan_tabel"]);
				$data['judul_laporan_tabel']  = set_value('judul_laporan_tabel',$lptab["judul_laporan_tabel"]);
				$data['analisa_laporan_tabel']  = set_value('analisa_laporan_tabel',$lptab["analisa_laporan_tabel"]);
				$data['rekomendasi_laporan_tabel']  = set_value('rekomendasi_laporan_tabel',$lptab["rekomendasi_laporan_tabel"]);
				$data['tabel']  = set_value('tabel',$lptab["tabel"]);
				$this->form_validation->set_rules('barcode_laporan_tabel','barcode_laporan_tabel','required');
        if ($this->form_validation->run() === FALSE){
					$this->tampil($data);
        }else{
        	$barcode_laporan = $this->input->post("barcode_laporan");
					if($this->m_sanitasi->edit_sn_laporan_tabel()){
					  $this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
						redirect(base_url('sanitasi/laporan/edit/'.$barcode_laporan));
					}else{
						$this->session->set_flashdata('danger', 'Ada Masalah Edit Data');
						redirect(base_url('sanitasi/laporan/edit/'.$barcode_laporan));
					}
        }
      }
      if($mode=='print_tabel'){
        $data['page'] =  $data['page']."_print_tabel";
        $lptab = $this->m_sanitasi->ambil_sn_laporan_detil($data['id2']);
				$data['analisa_laporan_tabel']  = set_value('analisa_laporan_tabel',$lptab["analisa_laporan_tabel"]);
				$data['barcode_laporan']  = set_value('barcode_laporan',$lptab["barcode_laporan"]);		
				$data['id_laporan_tabel']  = set_value('id_laporan_tabel',$lptab["id_laporan_tabel"]);		
				$data['barcode_laporan_tabel']  = set_value('barcode_laporan_tabel',$lptab["barcode_laporan_tabel"]);		
				$data['judul_laporan_tabel']  = set_value('judul_laporan_tabel',$lptab["judul_laporan_tabel"]);		
        $this->tampil($data);
      }
      if($mode=='rubah_data'){
        $data['page'] =  $data['page']."_rubah_data";
				$lp = $this->m_umum->ambil_data('sn_laporan','barcode_laporan',$data['id']);
				$data['id_laporan']  = set_value('id_laporan',$lp["id_laporan"]);
				$data['barcode_laporan']  = set_value('barcode_laporan',$lp["barcode_laporan"]);
				$lptab = $this->m_umum->ambil_data('sn_laporan_tabel','barcode_laporan_tabel',$data['id2']);
				$data['id_laporan_tabel']  = set_value('id_laporan_tabel',$lptab["id_laporan_tabel"]);
				$data['barcode_laporan_tabel']  = set_value('barcode_laporan_tabel',$lptab["barcode_laporan_tabel"]);
				$data['id_lhu']  = set_value('id_lhu',$lptab["id_lhu"]);
				$data['id_limbah']  = set_value('id_limbah',$lptab["id_limbah"]);
        $data['semuakah'] = array('0'=>'Semua Data','1'=>'Sesuai Check List');
        $data['ambil_data_sn_lhu'] = $this->m_sanitasi->ambil_data_sn_lhu($lp['tgl_awal'],$lp['tgl_akhir'],$lp['id_standar_mutu']);
        $data['ambil_limbah'] = $this->m_sanitasi->ambil_limbah($lp['id_standar_mutu']);
        $data['tabelkah'] = $this->m_sanitasi->ambil_sn_tabel();
        $data['tabel']  = set_value('tabel',$lptab["tabel"]);
        if($lptab["id_lhu"] == 0){
        	$data['semua']  = 0;
        }else{
        	$data['semua']  = 1;
        }
				$this->load->view("sanitasi/isi",$data);
      }
      if($mode=='simpan_rubah_data'){
		  	$id_laporan = $this->input->post('id_laporan');
		  	$id_laporan_tabel = $this->input->post('id_laporan_tabel');
		  	$barcode_laporan = $this->input->post('barcode_laporan');
		  	$barcode_laporan_tabel = $this->input->post('barcode_laporan_tabel');
				if($this->m_sanitasi->edit_input_tabel()){
				  $this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
					redirect(base_url('sanitasi/laporan/edit_tabel/'.$barcode_laporan.'/'.$barcode_laporan_tabel));
				}else{
					$this->session->set_flashdata('danger', 'Ada Masalah Edit Data');
					redirect(base_url('sanitasi/laporan/edit_tabel/'.$barcode_laporan.'/'.$barcode_laporan_tabel));
				}
      }
      if($mode=='rubah_limbah'){
        $data['page'] =  $data['page']."_rubah_limbah";
				$lp = $this->m_umum->ambil_data('sn_laporan','barcode_laporan',$data['id']);
				$data['id_laporan']  = set_value('id_laporan',$lp["id_laporan"]);
				$data['barcode_laporan']  = set_value('barcode_laporan',$lp["barcode_laporan"]);
				$lptab = $this->m_umum->ambil_data('sn_laporan_tabel','barcode_laporan_tabel',$data['id2']);
				$data['id_laporan_tabel']  = set_value('id_laporan_tabel',$lptab["id_laporan_tabel"]);
				$data['barcode_laporan_tabel']  = set_value('barcode_laporan_tabel',$lptab["barcode_laporan_tabel"]);
				$data['id_limbah']  = set_value('id_limbah',$lptab["id_limbah"]);
        $data['semuakah'] = array('0'=>'Semua Data','1'=>'Sesuai Check List');
        $data['ambil_data_sn_lhu_detil'] = $this->m_sanitasi->ambil_data_sn_lhu_detil($lp['tgl_awal'],$lp['tgl_akhir'],$lp['id_standar_mutu']);
        if($lptab["id_limbah"] == 0){
        	$data['semua']  = 0;
        }else{
        	$data['semua']  = 1;
        }
				$this->load->view("sanitasi/isi",$data);
      }
      if($mode=='simpan_rubah_limbah'){
		  	$id_laporan = $this->input->post('id_laporan');
		  	$id_laporan_tabel = $this->input->post('id_laporan_tabel');
		  	$barcode_laporan = $this->input->post('barcode_laporan');
		  	$barcode_laporan_tabel = $this->input->post('barcode_laporan_tabel');
				if($this->m_sanitasi->edit_input_limbah()){
				  $this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
					redirect(base_url('sanitasi/laporan/edit_tabel/'.$barcode_laporan.'/'.$barcode_laporan_tabel));
				}else{
					$this->session->set_flashdata('danger', 'Ada Masalah Edit Data');
					redirect(base_url('sanitasi/laporan/edit_tabel/'.$barcode_laporan.'/'.$barcode_laporan_tabel));
				}
      }
      if($mode=='rubah_ukur'){
        $data['page'] =  $data['page']."_rubah_ukur";
				$lp = $this->m_umum->ambil_data('sn_laporan','barcode_laporan',$data['id']);
				$data['id_laporan']  = set_value('id_laporan',$lp["id_laporan"]);
				$data['barcode_laporan']  = set_value('barcode_laporan',$lp["barcode_laporan"]);
				$lptab = $this->m_umum->ambil_data('sn_laporan_tabel','barcode_laporan_tabel',$data['id2']);
				$data['id_laporan_tabel']  = set_value('id_laporan_tabel',$lptab["id_laporan_tabel"]);
				$data['barcode_laporan_tabel']  = set_value('barcode_laporan_tabel',$lptab["barcode_laporan_tabel"]);
				$data['id_sumber_emisi']  = set_value('id_sumber_emisi',$lptab["id_sumber_emisi"]);
        $data['semuakah'] = array('0'=>'Semua Data','1'=>'Sesuai Check List');
        $data['ambil_data_sn_lhu_detil'] = $this->m_sanitasi->ambil_data_sn_lhu_detil_sumber($lp['tgl_awal'],$lp['tgl_akhir'],$lp['id_standar_mutu']);
        if($lptab["id_sumber_emisi"] == 0){
        	$data['semua']  = 0;
        }else{
        	$data['semua']  = 1;
        }
				$this->load->view("sanitasi/isi",$data);
      }
      if($mode=='simpan_rubah_ukur'){
		  	$id_laporan = $this->input->post('id_laporan');
		  	$id_laporan_tabel = $this->input->post('id_laporan_tabel');
		  	$barcode_laporan = $this->input->post('barcode_laporan');
		  	$barcode_laporan_tabel = $this->input->post('barcode_laporan_tabel');
				if($this->m_sanitasi->edit_input_ukur()){
				  $this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
					redirect(base_url('sanitasi/laporan/edit_tabel/'.$barcode_laporan.'/'.$barcode_laporan_tabel));
				}else{
					$this->session->set_flashdata('danger', 'Ada Masalah Edit Data');
					redirect(base_url('sanitasi/laporan/edit_tabel/'.$barcode_laporan.'/'.$barcode_laporan_tabel));
				}
      }
			if($mode=='pdf_intro'){
				$d	= $this->m_sanitasi->ambil_sn_laporan_4_print($data['id']);
				$report = $this->load->view('sanitasi/z_intro', $data, TRUE);
			  $filename = $d["nama_standar_mutu"]."-".$d["judul_laporan"]."-print-date-".date('d-m-Y H:i:s').".pdf";
			  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
			  $mpdf->AddPage('P', '', '', '', 2, 5, 5, 5, 10, 3, 3);
			  $mpdf->SetDisplayMode('fullpage');
			  $mpdf->SetTitle($data['header']);
			  $mpdf->SetAuthor($data['instance_name']);
			  $mpdf->defaultheaderline = 0;
		      $mpdf->defaultfooterline = 0;
		//	  $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
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
			if($mode=='pdf_table'){
				$d	= $this->m_sanitasi->ambil_sn_laporan_4_print($data['id']);
				$report = $this->load->view('sanitasi/z_tabel', $data, TRUE);
			  $filename = $d["nama_standar_mutu"]."-".$d["judul_laporan"]."-table-print-date-".date('d-m-Y H:i:s').".pdf";
			  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
			  $mpdf->AddPage('P', '', '', '', 2, 5, 5, 5, 10, 3, 3);
			  $mpdf->SetDisplayMode('fullpage');
			  $mpdf->SetTitle($data['header']);
			  $mpdf->SetAuthor($data['instance_name']);
			  $mpdf->defaultheaderline = 0;
		      $mpdf->defaultfooterline = 0;
		//	  $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
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
  function lihat($mode='view')
  {
		$data['page']  = "lihat";
		$data['header'] = "TINJAU LAPORAN INDIKATOR MUTU";
		$data['title'] = "TINJAU LAPORAN INDIKATOR MUTU";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',8);
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
		$data['id'] = $this->uri->segment(4, 0);
		$data['id2'] = $this->uri->segment(5, 0);
		$data['id3'] = $this->uri->segment(6, 0);
		$data['id4'] = $this->uri->segment(7, 0);
		$data['id5'] = $this->uri->segment(8, 0);
		$data['id6'] = $this->uri->segment(9, 0);
		$data['ambil_data_working'] = $this->m_sanitasi->ambil_data_rujukan_kab_working($this->session->list_working);
		$data['ambil_data_unit'] = $this->m_sanitasi->ambil_data_rujukan_ol_unit($this->session->list_unit);
		$id_in =  array(1,3);
		$data['ambil_sn_standar_mutu'] = $this->m_sanitasi->ambil_sn_standar_mutu($id_in);
		$data['cmd_jabatan'] = $this->m_rancak->cmd_jabatan();
	  $data['all_kah'] = array('0'=>'Range Tanggal','1'=>'Semua');
	  $data['kategori_kah'] = array('0'=>'Semua','1'=>'Sesuai Kategori');
    if($mode=='view'){
			if(empty($data['id'])){
				$data['id'] = '01-01'.date('Y');
			}
			if(empty($data['id2'])){
				$data['id2'] = date('d-m-Y');
			} 
			$this->tampil($data);  
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$first_date = $this->input->post("id");
				$last_date = $this->input->post("id2");
				$id_instansi = $this->input->post("id3");
				$id_standar_mutu = $this->input->post("id4");
				$id5 = $this->input->post("id5");  // tanggal
				$id6 = $this->input->post("id6");  // kategori
				redirect(base_url('sanitasi/lihat/view/'.$first_date.'/'.$last_date.'/'.$id_instansi.'/'.$id_standar_mutu.'/'.$id5.'/'.$id6));
			}
		}
    else if($mode=='data'){
			if(empty($data['id'])){
				$data['id'] = '01-'.date('m-Y');
			}
			if(empty($data['id2'])){
				$data['id2'] = date('d-m-Y');
			}    	
			echo json_encode($this->m_sanitasi->laporan_all($data['id'],$data['id2'],$data['id3'],$data['id4'],$data['id5'],$data['id6']));
		}
    else if($mode=='batang_range'){
			echo json_encode($this->m_sanitasi->grafik_batang_range($data['id2']));
		}
  	else{
      if($mode=='profil'){
        $data['page'] =  $data['page']."_profil";
        $lptab = $this->m_umum->ambil_data('sn_laporan','barcode_laporan',$data['id']);
        $data['ambil_sn_laporan_tabel'] = $this->m_sanitasi->ambil_sn_laporan_tabel($data['id']);
				$data['header_profil']  = set_value('header_profil',$lptab["header_profil"]);
				$data['sub_header_profil']  = set_value('sub_header_profil',$lptab["sub_header_profil"]);
				$data['sejarah']  = set_value('sejarah',$lptab["sejarah"]);
				$data['visi_misi']  = set_value('visi_misi',$lptab["visi_misi"]);		
				$data['tujuan_fungsi']  = set_value('tujuan_fungsi',$lptab["tujuan_fungsi"]);		
				$data['struktur_organisasi']  = set_value('struktur_organisasi',$lptab["struktur_organisasi"]);		
				$data['informasi_layanan']  = set_value('informasi_layanan',$lptab["informasi_layanan"]);		
				$data['regulasi']  = set_value('regulasi',$lptab["regulasi"]);			
        $this->tampil($data);
      }
      if($mode=='galeri'){
        $data['page'] =  $data['page']."_galeri";
        $lptab = $this->m_umum->ambil_data('sn_laporan','barcode_laporan',$data['id']);
        $data['ambil_sn_laporan_tabel'] = $this->m_sanitasi->ambil_sn_laporan_tabel($data['id']);	
				$data['galeri_laporan']  = set_value('galeri_laporan',$lptab["galeri_laporan"]);		
        $this->tampil($data);
      }
      if($mode=='laporan'){
        $data['page'] =  $data['page']."_laporan";
        $lptab = $this->m_umum->ambil_data('sn_laporan','barcode_laporan',$data['id']);
        $data['ambil_sn_laporan_tabel'] = $this->m_sanitasi->ambil_sn_laporan_tabel($data['id']);
				$data['header_laporan']  = set_value('header_laporan',$lptab["header_laporan"]);
				$data['header_laporan']  = set_value('header_laporan',$lptab["header_laporan"]);
				$data['sub_header_laporan']  = set_value('sub_header_laporan',$lptab["sub_header_laporan"]);
				$data['sub_sub_header_laporan']  = set_value('sub_sub_header_laporan',$lptab["sub_sub_header_laporan"]);
				$data['judul_laporan']  = set_value('judul_laporan',$lptab["judul_laporan"]);
				$data['dimensi_laporan']  = set_value('dimensi_laporan',$lptab["dimensi_laporan"]);		
				$data['tujuan_laporan']  = set_value('tujuan_laporan',$lptab["tujuan_laporan"]);		
				$data['definisi_laporan']  = set_value('definisi_laporan',$lptab["definisi_laporan"]);		
				$data['dasar_laporan']  = set_value('dasar_laporan',$lptab["dasar_laporan"]);		
				$data['frekuensi_laporan']  = set_value('frekuensi_laporan',$lptab["frekuensi_laporan"]);		
				$data['periode_laporan']  = set_value('periode_laporan',$lptab["periode_laporan"]);		
				$data['numerator_laporan']  = set_value('numerator_laporan',$lptab["numerator_laporan"]);		
				$data['denominator_laporan']  = set_value('denominator_laporan',$lptab["denominator_laporan"]);		
				$data['sumber_laporan']  = set_value('sumber_laporan',$lptab["sumber_laporan"]);		
				$data['standar_laporan']  = set_value('standar_laporan',$lptab["standar_laporan"]);		
				$data['teknis_laporan']  = set_value('teknis_laporan',$lptab["teknis_laporan"]);		
				$data['tgjawab_laporan']  = set_value('tgjawab_laporan',$lptab["tgjawab_laporan"]);		
				$data['jenis_laporan']  = set_value('jenis_laporan',$lptab["jenis_laporan"]);		
				$data['satuan_laporan']  = set_value('satuan_laporan',$lptab["satuan_laporan"]);		
				$data['kriteria_laporan']  = set_value('kriteria_laporan',$lptab["kriteria_laporan"]);		
				$data['formula_laporan']  = set_value('formula_laporan',$lptab["formula_laporan"]);		
				$data['metode_laporan']  = set_value('metode_laporan',$lptab["metode_laporan"]);		
				$data['instrumen_laporan']  = set_value('instrumen_laporan',$lptab["instrumen_laporan"]);		
				$data['sampel_laporan']  = set_value('sampel_laporan',$lptab["sampel_laporan"]);		
				$data['penyajian_laporan']  = set_value('penyajian_laporan',$lptab["penyajian_laporan"]);		
        $this->tampil($data);
      }
      if($mode=='tabel'){
        $data['page'] =  $data['page']."_tabel";
        $lptab = $this->m_sanitasi->ambil_sn_laporan_detil($data['id2']);
				$data['max_tanggal'] = $this->m_sanitasi->max_tanggal_lhu($data['id2']);
				$data['min_tanggal'] = $this->m_sanitasi->min_tanggal_lhu($data['id2']);
        $data['jumlah_bulan'] = $this->m_rancak->hitung_jumlah_bulan($data['min_tanggal'],$data['max_tanggal']);
				$data['max_standar'] = round($this->m_sanitasi->max_standar_mutu($data['id2'],3));
				$min_standar = round($this->m_sanitasi->min_standar_mutu($data['id2'],3));
				$min_range = round($this->m_sanitasi->min_range_mutu($data['id2'],3));
				$min_hasil = round($this->m_sanitasi->min_hasil($data['id2'],3));
				if($min_range == 0){
					$data['min_standar'] = $min_hasil - 10;
				}else{
					$data['min_standar'] = $min_range;
				}
				$data['jumlah_record_tabel_limbah_detil'] = $this->m_sanitasi->jumlah_record_tabel_limbah_detil($data['id2']);
				$data['jumlah_record_tps'] = $this->m_sanitasi->jumlah_record_tps($data['id2']);
				$data['only_blnyear_lhu'] = $this->m_sanitasi->only_blnyear_lhu($data['id2'],$data['min_tanggal'],$data['max_tanggal']);
				$data['tabel_limbah_detil'] = $this->m_sanitasi->tabel_limbah_detil($data['id2']);
        $data['ambil_sn_laporan_tabel'] = $this->m_sanitasi->ambil_sn_laporan_tabel($data['id']);
        $data['ambil_berkas_lhu'] = $this->m_sanitasi->ambil_berkas_lhu($lptab["id_lhu"],$lptab["id_standar_mutu"],$lptab["tgl_awal"],$lptab["tgl_akhir"]);
        $data['count_berkas_lhu'] = $this->m_sanitasi->count_berkas_lhu($lptab["id_lhu"],$lptab["id_standar_mutu"],$lptab["tgl_awal"],$lptab["tgl_akhir"]);
				$data['barcode_laporan_tabel']  = set_value('barcode_laporan_tabel',$lptab["barcode_laporan_tabel"]);
				$data['id_laporan_tabel']  = set_value('id_laporan_tabel',$lptab["id_laporan_tabel"]);
				$data['barcode_laporan']  = set_value('barcode_laporan',$lptab["barcode_laporan"]);
				$data['id_laporan']  = set_value('id_laporan',$lptab["id_laporan"]);		
				$data['judul_laporan_tabel']  = set_value('judul_laporan_tabel',$lptab["judul_laporan_tabel"]);		
				$data['analisa_laporan_tabel']  = set_value('analisa_laporan_tabel',$lptab["analisa_laporan_tabel"]);		
				$data['rekomendasi_laporan_tabel']  = set_value('rekomendasi_laporan_tabel',$lptab["rekomendasi_laporan_tabel"]);		
				$data['id_lhu']  = set_value('id_lhu',$lptab["id_lhu"]);		
				$data['id_sumber_emisi']  = set_value('id_sumber_emisi',$lptab["id_sumber_emisi"]);		
				$data['id_limbah']  = set_value('id_limbah',$lptab["id_limbah"]);		
				$data['urutan_laporan_tabel']  = set_value('urutan_laporan_tabel',$lptab["urutan_laporan_tabel"]);	
				$data['grafik']  = set_value('grafik',$lptab["tabel"]);	
				//-----------------------------------
				$data['grafik_garis_opsi'] = $this->m_sanitasi->grafik_garis_opsi($data['id2']);
				$data['ambil_limbah_grafik'] = $this->m_sanitasi->ambil_limbah_grafik_aza($data['id2']);
				$data['ambil_dt_limbah_grafik'] = $this->m_sanitasi->ambil_dt_limbah_grafik($data['id2']);
				$data['grafik_batang_range'] = $this->m_sanitasi->tabel_limbah_detil($data['id2']);
				$data['grafik_batang_range2'] = $this->m_sanitasi->grafik_only_limbah($data['id2']);
				$data['grafik_batang_kelola'] = $this->m_sanitasi->grafik_batang_kelola($data['id2']);
				$data['grafik_batang_range_jejer'] = $this->m_sanitasi->grafik_batang_range_jejer($data['id2']);
        $this->tampil($data);
      }
		}
  }
  function berkas($mode='view')
  {
		$data['page']  = "berkas";
		$data['header'] = "MANAJEMEN BERKAS";
		$data['title'] = "MANAJEMEN BERKAS";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',8);
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
		$data['id'] = $this->uri->segment(4, 0);
		$data['id2'] = $this->uri->segment(5, 0);
    if($mode=='view'){
			$this->tampil($data);  
		}
    else if($mode=='data'){ 	
			echo json_encode($this->m_sanitasi->berkas_all());
		}
	  else if($mode=='hapus'){ 
			$this->m_umum->hapus_data('ol_berkas','id_berkas',$data['id']);

				$this->session->set_flashdata('sukses', 'Data berhasil Di Hapus');
				redirect(base_url('sanitasi/berkas'));
	  }
/*    else if($mode=='hapus'){
			$this->db->select("COUNT(*) as num");
			$this->db->where("FIND_IN_SET('".$data['id']."',struktur_organisasi) !=", 0);
			$this->db->where("FIND_IN_SET('".$data['id']."',regulasi) !=", 0);
			$this->db->where("FIND_IN_SET('".$data['id']."',galeri_laporan) !=", 0);
			$this->db->where("FIND_IN_SET('".$data['id']."',berkas_laporan) !=", 0);
			$q = $this->db->get('sn_laporan')->row();
			$jml = $q->num;
			if($jml == 0){
				$cek_mi=FCPATH.'assets/berkas/im/'.$data['id2'];
				if(file_exists($cek_mi)){
					unlink(FCPATH."assets/berkas/im/".$data['id2']);
				}
				$cek_res=FCPATH.'assets/berkas/resize/'.$data['id2'];
				if(file_exists($cek_res)){
					unlink(FCPATH."assets/berkas/resize/".$data['id2']);
				}
				$this->m_umum->hapus_data('ol_berkas','id_berkas',$data['id']);
				$this->session->set_flashdata('sukses', 'Berkas Sudah Di Hapus');
				redirect(base_url('sanitasi/berkas'));
			}else{
				$this->session->set_flashdata('danger', 'Berkas Masih Di pakai di Laporan, Unselect Dulu');
				redirect(base_url('sanitasi/berkas'));
			}
    }*/
  	else{
      if($mode=='rubah'){
        $data['page'] =  $data['page']."_rubah";
				$keuangan = $this->m_umum->ambil_data('ol_berkas','id_berkas',$data['id']);
				$data['id_berkas']  = set_value('id_berkas',$keuangan["id_berkas"]);
				$data['nama_berkas']  = set_value('nama_berkas',$keuangan["nama_berkas"]);
				$data['no_berkas']  = set_value('no_berkas',$keuangan["no_berkas"]);
				$this->load->view("sanitasi/isi",$data);
      }
      if($mode=='simpan_rubah'){
			  if($this->m_sanitasi->edit_berkas_file()){
					$this->session->set_flashdata('sukses', 'Barang berhasil Di Rubah');
					redirect(base_url('sanitasi/berkas'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Masalah Rubah Data');
					redirect(base_url('sanitasi/berkas'));
			  }
      }
		}
  }
   public function resizeImage($filename)
   {
    $source_path = $_SERVER['DOCUMENT_ROOT'] . '/assets/berkas/sanitasi/' . $filename;
    $target_path = $_SERVER['DOCUMENT_ROOT'] . '/assets/berkas/im/';
    $config_manip = array(
        'image_library' => 'gd2',
        'source_image' => $source_path,
        'new_image' => $target_path,
        'maintain_ratio' => TRUE,
        'create_thumb' => TRUE,
        'thumb_marker' => '_thumb',
        'width' => 500
    );
    $this->load->library('image_lib', $config_manip);
    if (!$this->image_lib->resize()) {
        echo $this->image_lib->display_errors();
    }
    // clear //
    $this->image_lib->clear();
//    $this->image_lib->resize();
   }
public function do_resize($filename)
{
    $source_path = $_SERVER['DOCUMENT_ROOT'] . '/assets/berkas/sanitasi/' . $filename;
    $target_path = $_SERVER['DOCUMENT_ROOT'] . '/assets/berkas/resize/';
    $config_manip = array(
        'image_library' => 'gd2',
        'source_image' => $source_path,
        'new_image' => $target_path,
        'maintain_ratio' => TRUE,
        'create_thumb' => TRUE,
        'thumb_marker' => '_thumb',
        'width' => 150,
        'height' => 150
    );
    $this->load->library('image_lib', $config_manip);
    if (!$this->image_lib->resize()) {
        echo $this->image_lib->display_errors();
    }
    // clear //
    $this->image_lib->clear();
//    $this->image_lib->resize();
}
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("sanitasi/header",$data);
	$this->load->view("sanitasi/isi");
	$this->load->view("footer");
	$this->load->view("sanitasi/jsload");
	$this->load->view("sanitasi/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_top",$data);
	$this->load->view("sanitasi/isi");
	$this->load->view("footer");
	$this->load->view("sanitasi/jsload");
	$this->load->view("sanitasi/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
