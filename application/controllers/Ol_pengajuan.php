<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');
class Ol_pengajuan extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
          $this->load->model('m_ol_rancak');
          $this->load->model('m_ol_pengajuan');
          $this->load->model('m_kredensial');
          $this->load->model('m_auth');
          $this->m_auth->bayar_kah();
          //$this->m_auth->hak_member();
  }
	function index(){
		$data['page']="home";
		$data['header'] = "BERANDA";
		$data['title'] = "BERANDA";
		$data['link_kembali'] = base_url('member');
		$data['link_awal'] = base_url('ol_logbook/logbook');
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$data['ambil_data_a_online'] = $this->m_ol_rancak->ambil_data_a_online();
		$data['ambil_data_instansi'] = $this->m_ol_rancak->ambil_data_instansi();
		$data['ambil_data_instansi_null'] = $this->m_ol_rancak->ambil_data_instansi_null();
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
		$this->pengajuan_kompetensi();
	}
	function pengajuan_kompetensi($mode='view'){
		$data['page']="pengajuan_kompetensi"; 
		$data['header'] = "DATA PENGAJUAN KOMPETENSI";
		$data['title'] = "DATA PENGAJUAN KOMPETENSI";
		$data['kembali'] = base_url('ol_pengajuan/pengajuan_kompetensi');	
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
//		$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
/*		$data['multi_level'] = $this->m_ol_rancak->ambil_data_link_pengurus($this->session->id_pegawai);
		$data['ol_akses'] = $this->m_ol_rancak->ol_akses($this->session->id_pegawai);*/
		$data['ambil_data_a_online'] = $this->m_ol_rancak->ambil_data_a_online();
		$data['ambil_data_instansi'] = $this->m_ol_rancak->ambil_data_instansi();
		$data['ambil_data_instansi_null'] = $this->m_ol_rancak->ambil_data_instansi_null();
		$kondisi_blm_lunas = array('barcode_pegawai'=>$this->session->barcode_pegawai,'status_pengajuan_temp'=>1);
		$data['blm_lunas'] = $this->m_umum->jumlah_record_filter('ol_pengajuan_temp',$kondisi_blm_lunas);
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
		$data['mas_bayar'] = $pegawai["mas_bayar"];
		$data['photo'] = $pegawai["foto"];	
		//======================= IMPORTANT =========================================
		$data['id'] = $this->uri->segment(4, 0);
		$data['id2'] = $this->uri->segment(5, 0);
		if($mode=='view'){
			$this->tampil_top($data);
		}
    else if($mode=='data'){
		echo json_encode($this->m_ol_pengajuan->pengajuan_kompetensi_all());
		}
    else if($mode=='tabel'){
		echo json_encode($this->m_ol_pengajuan->tabel_logbook($data['id']));
		}
    else if($mode=='pemulihan'){
		echo json_encode($this->m_ol_pengajuan->tabel_pemulihan($data['id']));
		}
    else if($mode=='logbook'){
		echo json_encode($this->m_ol_pengajuan->tabel_logbook_validasi($data['id']));
		}
		else{
		if($mode=='pdf_logbook'){
			  $report = $this->load->view('cetak/ol_logbook_pengajuan', $data, TRUE);
			  $filename = $data['header'].".pdf";
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
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
	      $data['status_diusulkan_all']  = $this->m_ol_rancak->status_diusulkan_all();
	      $data['id_status_diusulkan']  = set_value('id_status_diusulkan',$this->input->post("id_status_diusulkan"));
	      $data['id_instansi']  = set_value('id_instansi',$this->input->post("id_instansi"));
	      $this->load->view("ol_pengajuan/isi",$data);
      }
      if($mode=='simpan_tambah'){
       if($this->session->refer == 3){
        $status_pengajuan_temp = 0;
       }else{
        $status_pengajuan_temp = 1;
       }
				  $last = $this->m_ol_pengajuan->simpan_3_pengajuan_kompetensi_temp($status_pengajuan_temp);
      if($this->session->refer == 3){
       $this->m_ol_pengajuan->simpan_3_pengajuan_kompetensi($last);
      }
					$wagw = $this->m_umum->ambil_data('a_wageblast','id_wageblast',1);
					$kondisi_temp = array('barcode_pengajuan_temp'=>$last);
					$temp = $this->m_umum->ambil_data_kondisi('ol_pengajuan_temp',$kondisi_temp);
					$d = $this->m_umum->ambil_data('ol_pegawai','barcode_pegawai',$temp['barcode_pegawai']);
					$logine = base_url('masuk');
					$token = $wagw['token'];
					$target = $d['no_hp'];
					$nama_pegawai = $d['nama_pegawai'];
  				$tansi = $this->m_umum->ambil_data('a_instansi','id_instansi',$temp['id_instansi']);
  				$instance_name = $tansi["nama_instansi"];
					$tgl_lahir = $this->m_rancak->fullBulan(date('d-m-Y', strtotime($d['tgl_lahir'])));
					$br = "\n";
					$message = "*".$instance_name."*";
					$message .= $br. $br."*PENGAJUAN KOMPETENSI PENDING*";
					$message .= $br."📜 *INI ADALAH KONFIRMASI SATU ARAH MOHON JANGAN BALAS DISINI*";
					$message .= $br."Silahkan Email ke _aplikasisnars@gmail.com_";
					$message .= $br."dengan konfirmasi no pengajuan";
					$message .= $br. "No Pengajuan : *" . $temp['barcode_pengajuan_temp']."*";
					$message .= $br. "Nama : " . $d['nama_pegawai'];
					$message .= $br. "TTL : " . $d['tmp_lahir'] .", ". $tgl_lahir;
					$message .= $br. "No KTP : " . $d['nik'];
					$message .= $br. "NIP : " . $d['nip'];
					$message .= $br. "No HP : " . $d['no_hp'];
					$message .= $br. "E-mail : " . $d['email'];
					$message .= $br. $br."KREDENSIAL LOGIN : ";
					$message .= $br. $logine;
					$this->m_umum->kirim_fonte_text($token,$target,$message);
						$this->session->set_flashdata('sukses', 'Silahkan Hubungi Administrator untuk Aktifasi');
						redirect(base_url('ol_pengajuan/pengajuan_kompetensi/sukses/'.$last));
		//		  }else{
		//				$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
		//				redirect(base_url('ol_pengajuan/pengajuan_kompetensi'));
		//		  }
/*				$mas_bayar = $this->input->post('mas_bayar');
				$id_instansi = $this->input->post('id_instansi');
				$id_status_diusulkan = $this->input->post('id_status_diusulkan');
				if($mas_bayar == 0){
				  if($last = $this->m_ol_pengajuan->simpan_pengajuan_kompetensi()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('ol_pengajuan/pengajuan_kompetensi'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
						redirect(base_url('ol_pengajuan/pengajuan_kompetensi'));
				  }
				}else{
				  if($last = $this->m_ol_pengajuan->simpan_pengajuan_kompetensi_temp()){
						$this->session->set_flashdata('sukses', 'Silahkan Hubungi Administrator untuk Aktifasi');
						redirect(base_url('ol_pengajuan/pengajuan_kompetensi'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
						redirect(base_url('ol_pengajuan/pengajuan_kompetensi'));
				  }
				}*/
      }
      if($mode=='sukses'){
        $data['page'] =  $data['page']."_sukses";
				$data['title'] = "SUKSES MELAKUKAN PENGAJUAN KOMPETENSI";
				$keuangan = $this->m_umum->ambil_data('ol_pengajuan_temp','barcode_pengajuan_temp',$data['id']);
				$status = $this->m_umum->ambil_data('ol_status_diusulkan','id_status_diusulkan',$keuangan['id_status_diusulkan']);
				$name = $this->m_umum->ambil_data('ol_pegawai','barcode_pegawai',$keuangan['barcode_pegawai']);
/*		    if($keuangan["barcode_pegawai"] !== $this->session->barcode_pegawai){
		      redirect(base_url('ol_pengajuan/pengajuan_kompetensi'));
		    }*/
		    $data['barcode_pengajuan_temp']  = $keuangan["barcode_pengajuan_temp"];
		    $data['tgl_pengajuan']  = date('d-m-Y', strtotime($keuangan["tgl_pengajuan"]));
		    $data['nama_status_diusulkan']  = $status["nama_status_diusulkan"];
		    $data['nama_pegawai']  = $name["nama_pegawai"];
				$this->tampil_top($data);
	  }
      if($mode=='isi'){
        $data['page'] =  $data['page']."_isi";
				$data['ambil_link'] = $this->m_kredensial->ambil_link_asesi($data['id']);
				$data['ambil_berkas_data']=$this->m_ol_rancak->ambil_id_berkas_data($this->session->id_pegawai);
				$d	=$this->m_ol_rancak->ambil_pengajuan_kompetensi($data['id']); //barcode_pengajuan
				$data['ambil_data_etik_pegawai_oppe'] = $this->m_ol_rancak->ambil_data_etik_pegawai_oppe($this->session->id_pegawai,date('Y'));
		    if($d["id_pegawai"] !== $this->session->id_pegawai){
		      redirect(base_url('ol_pengajuan/pengajuan_kompetensi'));
		    }
				$data['id_pengajuan']  = set_value('id_pengajuan',$d["id_pengajuan"]);
				$kondisi_logbooke=array('id_pengajuan'=>$d["id_pengajuan"]);
				$data['jml_logbooke']=$this->m_umum->jumlah_record_filter('ol_logbook',$kondisi_logbooke);
				$data['list_asesor'] = $this->m_ol_rancak->ambil_data_nkr_pengajuan_validator_asesor($d["barcode_pengajuan"]);
				$data['kode_unit_pengajuan']  = set_value('kode_unit_pengajuan',$d["kode_unit_pengajuan"]);
				$data['id_status_diusulkan']  = set_value('id_status_diusulkan',$d["id_status_diusulkan"]);
				$data['nama_status_diusulkan']  = set_value('nama_status_diusulkan',$d["nama_status_diusulkan"]);
				$data['id_berkas']  = explode(",", $d["id_berkas"]);
				$data['berkas']  = $d["id_berkas"];
				$data['id_ijasah']  = explode(",", $d["id_ijasah"]);
				$data['ijasah']  = $d["id_ijasah"];
				$data['id_str']  = explode(",", $d["id_str"]);
				$data['str']  = $d["id_str"];
				$data['id_sertifikat']  = explode(",", $d["id_sertifikat"]);
				$data['etike']  = explode(",", $d["id_etik_pegawai"]);
				$data['sertifikat']  = $d["id_sertifikat"];
				$data['status_pengajuan']  = set_value('status_pengajuan',$d["status_pengajuan"]);
				$data['id_etik_pegawai']  = set_value('id_etik_pegawai',$d["id_etik_pegawai"]);
				$data['ambil_lobook_validasi_group_pengajuan']=$this->m_ol_rancak->ambil_lobook_validasi_group_pengajuan($d["id_pengajuan"]);
				$this->tampil_top($data);
				$action = $this->input->post('action');
				$id_pengajuan = $this->input->post('id_pengajuan');
				if($action == 'Btnsimpan') {
					$this->m_ol_pengajuan->edit_pengajuan();
					$this->session->set_flashdata('sukses', 'Pengajuan Sudah Di Simpan');
					redirect(base_url('ol_pengajuan/pengajuan_kompetensi'));
				}
				if($action == 'BtnKirim') {
				//	$this->m_profil->simpan_pengajuan_logbook_pegawai($id_pengajuan);
					$this->m_ol_pengajuan->terkirim();
					$this->session->set_flashdata('sukses', 'Pengajuan Sudah Diproses Cek Tabel Untuk Kelengkapan Data');
					redirect(base_url('ol_pengajuan/pengajuan_kompetensi'));
				}
	  }
      if($mode=='tambah_kompetensi'){
        $data['page'] =  $data['page']."_tambah_kompetensi";
        $data['kompetensi']=$this->m_ol_rancak->ambil_lobook_nkr_kompetensi_group_pengajuan();
				$keuangan = $this->m_umum->ambil_data('ol_pengajuan','id_pengajuan',$data['id']);
				$data['id_pengajuan']  = set_value('id_pengajuan',$keuangan["id_pengajuan"]);
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$keuangan["barcode_pengajuan"]);
				$data['kode_unit_pengajuan']  = set_value('kode_unit_pengajuan',$keuangan["kode_unit_pengajuan"]);
				$this->load->view("ol_pengajuan/isi",$data);
      }
      if($mode=='simpan_tambah_kompetensi'){
       $chk = $this->input->post('chk[]');
       $jml_kode = count($chk);
   				$kode_unit_pengajuan = $this->input->post('kode_unit_pengajuan');
   				$barcode_pengajuan = $this->input->post('barcode_pengajuan');
   				if($jml_kode == 0){
          $this->m_ol_pengajuan->simpan_kode_unit_pengajuan();
          $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
          redirect(base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$barcode_pengajuan));
   			  }else{
         if($jml_kode == 1){
          $this->m_ol_pengajuan->simpan_kode_unit_pengajuan();
          $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
          redirect(base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$barcode_pengajuan));
         }else{
          $this->session->set_flashdata('danger', 'Maaf 1 pengajuan hanya 1 kompetensi');
          redirect(base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$barcode_pengajuan));      
         }
        }
      }
      if($mode=='tambah_logbook'){
        $data['page'] =  $data['page']."_tambah_logbook";
				$keuangan = $this->m_umum->ambil_data('ol_pengajuan','id_pengajuan',$data['id']);
        $data['kompetensi']=$this->m_ol_rancak->ambil_berkas_logbookku($keuangan["kode_unit_pengajuan"],$keuangan["id_instansi"]);
				$data['id_pengajuan']  = set_value('id_pengajuan',$keuangan["id_pengajuan"]);
				$data['id_status_diusulkan']  = set_value('id_status_diusulkan',$keuangan["id_status_diusulkan"]);
				$this->load->view("ol_pengajuan/isi",$data);
      }
      if($mode=='simpan_tambah_logbook'){
				$barcode_pengajuan = $this->input->post('barcode_pengajuan');
				$this->m_ol_pengajuan->simpan_logbook();
				$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
				redirect(base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$barcode_pengajuan));
      }
      if($mode=='tambah_ijasah'){
        $data['page'] =  $data['page']."_tambah_ijasah";
        $data['kompetensi']=$this->m_ol_rancak->ambil_berkas_ijasahku();
				$keuangan = $this->m_umum->ambil_data('ol_pengajuan','id_pengajuan',$data['id']);
				$data['id_pengajuan']  = set_value('id_pengajuan',$keuangan["id_pengajuan"]);
				$data['berkase']  = $keuangan["id_ijasah"];
				$this->load->view("ol_pengajuan/isi",$data);
      }
      if($mode=='tambah_str'){
        $data['page'] =  $data['page']."_tambah_str";
        $data['kompetensi']=$this->m_ol_rancak->ambil_berkas_strku();
				$keuangan = $this->m_umum->ambil_data('ol_pengajuan','id_pengajuan',$data['id']);
				$data['id_pengajuan']  = set_value('id_pengajuan',$keuangan["id_pengajuan"]);
				$data['berkase']  = $keuangan["id_str"];
				$this->load->view("ol_pengajuan/isi",$data);
      }
      if($mode=='tambah_sertifikat'){
        $data['page'] =  $data['page']."_tambah_sertifikat";
        $data['kompetensi']=$this->m_ol_rancak->ambil_berkas_sertifikatku();
				$keuangan = $this->m_umum->ambil_data('ol_pengajuan','id_pengajuan',$data['id']);
				$data['id_pengajuan']  = set_value('id_pengajuan',$keuangan["id_pengajuan"]);
				$data['berkase']  = $keuangan["id_sertifikat"];
				$this->load->view("ol_pengajuan/isi",$data);
      }
      if($mode=='tambah_berkaslain'){
        $data['page'] =  $data['page']."_tambah_berkaslain";
        $data['kompetensi']=$this->m_ol_rancak->ambil_berkas_berkasku();
				$keuangan = $this->m_umum->ambil_data('ol_pengajuan','id_pengajuan',$data['id']);
				$data['id_pengajuan']  = set_value('id_pengajuan',$keuangan["id_pengajuan"]);
				$data['berkase']  = $keuangan["id_berkas"];
				$this->load->view("ol_pengajuan/isi",$data);
      }
      if($mode=='tambah_etik'){
        $data['page'] =  $data['page']."_tambah_etik";
        $data['kompetensi']=$this->m_ol_rancak->ambil_berkas_etikku();
				$keuangan = $this->m_umum->ambil_data('ol_pengajuan','id_pengajuan',$data['id']);
				$data['id_pengajuan']  = set_value('id_pengajuan',$keuangan["id_pengajuan"]);
				$data['berkase']  = $keuangan["id_etik_pegawai"];
				$this->load->view("ol_pengajuan/isi",$data);
      }
      if($mode=='simpan_berkas'){
				$id = $this->input->post('id');
				$barcode_pengajuan = $this->input->post('barcode_pengajuan');
					$chk = $this->input->post('chk[]');
						$eimplo = implode(",",$chk);
						$this->m_ol_pengajuan->simpan_berkas_modal($id,$eimplo);
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$barcode_pengajuan));
      }
      if($mode=='kirim'){
      	$cek = $this->m_umum->ambil_data('ol_pengajuan','id_pengajuan',$data['id2']);
      	if($cek['status_pengajuan'] > 0){
						$this->session->set_flashdata('danger', 'Status Sudah Terkirim');
						redirect(base_url('ol_pengajuan/pengajuan_kompetensi'));
      	}else{
				  if($this->m_ol_pengajuan->rubah_status_kompetensi($data['id'],$data['id2'])){
						redirect(base_url('ol_pengajuan/pengajuan_kompetensi'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
						redirect(base_url('ol_pengajuan/pengajuan_kompetensi'));
				  }      		
      	}

      }
		if($mode=='reset_logbook'){
			$pengajuan = $this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$data['id']);
			if($pengajuan['status_pengajuan'] == 0){
				  if($this->m_ol_pengajuan->reset_logbook($data['id2'],$pengajuan['id_status_diusulkan'])){
				  	$this->session->set_flashdata('sukses', 'Data Sudah Di Reset');
				  	redirect(base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$data['id']));
				  }else{
						$this->session->set_flashdata('danger', 'Masalah Edit Data');
						redirect(base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$data['id']));
				  }
			}else{
				$this->session->set_flashdata('danger', 'Data Sudah Di Validasi');
				redirect(base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$data['id']));		
			}
		}
      if($mode=='asesmen'){
        $data['page'] =  $data['page']."_asesmen";
				$apv = $this->m_kredensial->ambil_pengajuan_validasi_pengajuan_valiasi($data['id']);
				$apk = $this->m_kredensial->ambil_pengajuan_kompetensi($apv['barcode_pengajuan']);
				// ========================================				
		    if($apk["id_pegawai"] !== $this->session->id_pegawai){
		    	$this->session->set_flashdata('danger', 'Data Tidak Valid');
		      redirect(base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$apk["barcode_pengajuan"]));
		    }
		    $data['kembali'] = base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$apk['barcode_pengajuan']);	
				// ========================================
		    if($apk["id_pegawai"] !== $this->session->id_pegawai){
		      redirect(base_url('ol_pengajuan/pengajuan_kompetensi'));
		    }
		    // ========================================
				$kondisi_form=array('id_jenis_form'=>$apv["id_jenis_form"],'id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi']);
				$nkre_form = $this->m_umum->ambil_data_kondisi('nkr_form',$kondisi_form);
		    // ========================================	
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$apk["barcode_pengajuan"]);
				$data['status_pengajuan']  = set_value('status_pengajuan',$apk["status_pengajuan"]);
				$data['nama_pegawai']  = set_value('nama_pegawai',$apk["nama_pegawai"]);
				$data['nama_working']  = set_value('nama_working',$apk["nama_working"]);
				$data['tgl_pengajuan']  = $this->m_rancak->fullBulan(date('d-m-Y', strtotime($apk['tgl_pengajuan'])));
		    // ========================================	
				$data['nama_asesor']  = set_value('nama_asesor',$apv["nama_pegawai"]);
				$data['kesesuaian_bukti']  = explode(",", $apv["kesesuaian_bukti_validasi"]);
				$data['ket_pengajuan_validasi']  = set_value('ket_pengajuan_validasi',$apv["ket_pengajuan_validasi"]);
				$data['barcode_form']  = set_value('barcode_form',$nkre_form["barcode_form"]);
				$data['tgl_asesi']  = set_value('tgl_asesi',$apv["tgl_asesi"]);	
				$data['tgl_asesor']  = set_value('tgl_asesor',$apv["tgl_asesor"]);	
				$data['validasi']  = set_value('validasi',$apv["validasi"]);	
				$data['id_jenis_form']  = set_value('id_jenis_form',$apv["id_jenis_form"]);
				$data['nama_jenis_form']  = set_value('nama_jenis_form',$apv["nama_jenis_form"]);
				$data['barcode_pengajuan_validasi']  = set_value('barcode_pengajuan_validasi',$apv["barcode_pengajuan_validasi"]);
		    // ========================================				
				$data['kompetensi'] = $this->m_umum->ambil_data_explode('nkr_kompetensi','id_kompetensi',$apk['kode_unit_pengajuan']);
				$data['form2_detil'] = $this->m_kredensial->ambil_nkr_validasi_question_detil($apv['barcode_pengajuan_validasi']);
				$this->tampil_top($data);
				$status_pengajuan = $this->input->post('status_pengajuan');
				$barcode_pengajuan = $this->input->post('barcode_pengajuan');
				$id_form = $this->input->post('id_form');
				$barcode_pengajuan_validasi = $this->input->post('barcode_pengajuan_validasi');				
				$action = $this->input->post('action'); 
				if($action == 'BtnSetuju') {
					if($status_pengajuan == 1){
							$this->m_ol_pengajuan->pengajuan_validasi_berkas_edit_setuju();
							$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
							redirect(base_url('ol_pengajuan/pengajuan_kompetensi/asesmen/'.$barcode_pengajuan_validasi));
					}else{
							$this->session->set_flashdata('danger', 'Data Sudah Selesai');
							redirect(base_url('ol_pengajuan/pengajuan_kompetensi/asesmen/'.$barcode_pengajuan_validasi));						
					}
				}
      }
      if($mode=='permohonan'){
        $data['page'] =  $data['page']."_permohonan";
				$apv = $this->m_kredensial->ambil_pengajuan_validasi_pengajuan_valiasi($data['id']);
				$apk = $this->m_kredensial->ambil_pengajuan_kompetensi($apv['barcode_pengajuan']);				
		    if($apk["id_pegawai"] !== $this->session->id_pegawai){
		    	$this->session->set_flashdata('danger', 'Data Tidak Valid');
		      redirect(base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$apk["barcode_pengajuan"]));
		    }
				$asesor = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$apv["id_asesor"]);
				$data['kesesuaian_bukti']  = explode(",", $apv["kesesuaian_bukti_validasi"]);
				$data['nama_asesor']  = set_value('nama_asesor',$asesor["nama_pegawai"]);
				$data['barcode_pengajuan_validasi']  = set_value('barcode_pengajuan_validasi',$apv["barcode_pengajuan_validasi"]);
				$data['validasi_asesor']  = set_value('validasi_asesor',$apv["validasi"]);
				$data['tgl_asesi_pengajuan']  = set_value('tgl_asesi_pengajuan',$apv["tgl_asesi"]);
				$data['tgl_asesor_pengajuan']  = set_value('tgl_asesor_pengajuan',$apv["tgl_asesor"]);
				$data['ket_pengajuan']  = set_value('ket_pengajuan',$apv["ket_pengajuan_validasi"]);
				$data['id_jenis_form']  = set_value('id_jenis_form',$apv["id_jenis_form"]);
				$data['nama_jenis_form']  = set_value('nama_jenis_form',$apv["nama_jenis_form"]);
				$jml = $this->m_kredensial->cek_num_pengajuan_kompetensi_validator($data['id']);
				$data['kembali'] = base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$apk['barcode_pengajuan']);	
				$data['ambil_berkas_data']=$this->m_ol_rancak->ambil_id_berkas_data($apk['id_pegawai']);
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$apk["barcode_pengajuan"]);
				$data['status_pengajuan']  = set_value('status_pengajuan',$apk["status_pengajuan"]);
				$data['foto']  = set_value('foto',$apk["foto"]);
				$data['nama_pegawai']  = set_value('nama_pegawai',$apk["nama_pegawai"]);
				$data['id_pengajuan']  = set_value('id_pengajuan',$apk["id_pengajuan"]);
				$data['id_pegawai']  = set_value('id_pegawai',$apk["id_pegawai"]);
				$data['id_instansi']  = set_value('id_instansi',$apk["id_instansi"]);
				if($apk["jk"] == 1){ $data['jk'] = 'Laki-laki'; }else{ $data['jk'] = 'Perempuan'; }
				$data['tgl_lahir']  = $this->m_rancak->fullBulan(date('d-m-Y', strtotime($apk['tgl_lahir'])));
				$data['tmp_lahir']  = set_value('tmp_lahir',$apk["tmp_lahir"]);
				$data['umur']  = set_value('umur',$apk["umur"]);
				$data['nama_status_kawin']  = set_value('nama_status_kawin',$apk["nama_status_kawin"]);
				$data['nama_jabatan']  = set_value('nama_jabatan',$apk["nama_jabatan"]);
				$data['nama_status_pegawai']  = set_value('nama_status_pegawai',$apk["nama_status_pegawai"]);
				$data['nama_agama']  = set_value('nama_agama',$apk["nama_agama"]);
				$data['nama_jabatan_fungsional']  = set_value('nama_jabatan_fungsional',$apk["nama_jabatan_fungsional"]);
				$data['nama_status_pegawai']  = set_value('nama_status_pegawai',$apk["nama_status_pegawai"]);
				$data['nip']  = set_value('nip',$apk["nip"]);
				$data['nama_pendidikan']  = set_value('nama_pendidikan',$apk["nama_pendidikan"]);
				$data['no_profesi']  = set_value('no_profesi',$apk["no_profesi"]);
				$data['no_hp']  = set_value('no_hp',$apk["no_hp"]);
				$data['email']  = set_value('email',$apk["email"]);
				$data['alamat']  = set_value('alamat',$apk["alamat"]);
				$data['nama_prov']  = set_value('nama_prov',$apk["nama_prov"]);
				$data['nama_kab']  = set_value('nama_kab',$apk["nama_kab"]);
				$data['nama_kec']  = set_value('nama_kec',$apk["nama_kec"]);
				$data['nama_kel']  = set_value('nama_kel',$apk["nama_kel"]);
				$data['nama_working']  = set_value('nama_working',$apk["nama_working"]);
				$data['nama_status_diusulkan']  = set_value('nama_status_diusulkan',$apk["nama_status_diusulkan"]);
				$data['id_berkas']  = explode(",", $apk["id_berkas"]);
				$data['berkas']  = $apk["id_berkas"];
				$data['id_ijasah']  = explode(",", $apk["id_ijasah"]);
				$data['ijasah']  = $apk["id_ijasah"];
				$data['id_str']  = explode(",", $apk["id_str"]);
				$data['str']  = $apk["id_str"];
				$data['id_sertifikat']  = explode(",", $apk["id_sertifikat"]);
				$data['sertifikat']  = $apk["id_sertifikat"];
				$data['id_etik_pegawai']  = explode(",", $apk["id_etik_pegawai"]);
		// 		$data['jml_validasi'] = $this->m_kredensial->jumlah_pengajuan_validasi($apk['barcode_pengajuan'],$apv["id_jenis_form"]);
				$data['ambil_data_etik_pegawai_oppe'] = $this->m_ol_rancak->ambil_data_etik_pegawai_oppe($apk["id_pegawai"],date('Y'));
				$data['ambil_lobook_kompetensi_group_pengajuan']=$this->m_ol_rancak->ambil_lobook_kompetensi_group_pengajuan($apk["id_pengajuan"]);
				$data['kompetensi'] = $this->m_umum->ambil_data_explode('nkr_kompetensi','id_kompetensi',$apk['kode_unit_pengajuan']);
				$this->tampil_top($data);
				$status_pengajuan = $this->input->post('status_pengajuan');
				$barcode_pengajuan = $this->input->post('barcode_pengajuan');
				$id_form = $this->input->post('id_form');
				$barcode_pengajuan_validasi = $this->input->post('barcode_pengajuan_validasi');				
				$action = $this->input->post('action'); 
				if($action == 'BtnSetuju') {
					if($status_pengajuan == 1){
							$this->m_ol_pengajuan->pengajuan_validasi_berkas_edit_setuju();
							$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
							redirect(base_url('ol_pengajuan/pengajuan_kompetensi/permohonan/'.$barcode_pengajuan_validasi));
					}else{
							$this->session->set_flashdata('danger', 'Data Sudah Selesai');
							redirect(base_url('ol_pengajuan/pengajuan_kompetensi/permohonan/'.$barcode_pengajuan_validasi));						
					}
				}
      }
      if($mode=='rencana'){
        $data['page'] =  $data['page']."_rencana";
				$apv = $this->m_kredensial->ambil_pengajuan_validasi_pengajuan_valiasi($data['id']);
				$apk = $this->m_kredensial->ambil_pengajuan_kompetensi($apv['barcode_pengajuan']);
				// ========================================				
		    if($apk["id_pegawai"] !== $this->session->id_pegawai){
		    	$this->session->set_flashdata('danger', 'Data Tidak Valid');
		      redirect(base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$apk["barcode_pengajuan"]));
		    }
		    $data['kembali'] = base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$apk['barcode_pengajuan']);	
				// ========================================
		    if($apk["id_pegawai"] !== $this->session->id_pegawai){
		      redirect(base_url('ol_pengajuan/pengajuan_kompetensi'));
		    }
		    // ========================================
				$kondisi_form=array('id_jenis_form'=>$apv["id_jenis_form"],'id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi']);
				$nkre_form = $this->m_umum->ambil_data_kondisi('nkr_form',$kondisi_form);
		    // ========================================	
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$apk["barcode_pengajuan"]);
				$data['status_pengajuan']  = set_value('status_pengajuan',$apk["status_pengajuan"]);
				$data['id_pengajuan']  = set_value('id_pengajuan',$apk["id_pengajuan"]);
				$data['nama_pegawai']  = set_value('nama_pegawai',$apk["nama_pegawai"]);
				$data['nama_working']  = set_value('nama_working',$apk["nama_working"]);
				$data['nama_status_diusulkan']  = set_value('nama_status_diusulkan',$apk["nama_status_diusulkan"]);
				$data['nama_jabatan_fungsional']  = set_value('nama_jabatan_fungsional',$apk["nama_jabatan_fungsional"]);
				$data['tgl_pengajuan']  = $this->m_rancak->fullBulan(date('d-m-Y', strtotime($apk['tgl_pengajuan'])));
		    // ========================================	
				$data['nama_asesor']  = set_value('nama_asesor',$apv["nama_pegawai"]);
				$data['kesesuaian_bukti']  = explode(",", $apv["kesesuaian_bukti_validasi"]);
				$data['ket_pengajuan_validasi']  = set_value('ket_pengajuan_validasi',$apv["ket_pengajuan_validasi"]);
				$data['barcode_form']  = set_value('barcode_form',$nkre_form["barcode_form"]);
				$data['tgl_asesi']  = set_value('tgl_asesi',$apv["tgl_asesi"]);	
				$data['tgl_asesor']  = set_value('tgl_asesor',$apv["tgl_asesor"]);	
				$data['validasi']  = set_value('validasi',$apv["validasi"]);
				$data['id_jenis_form']  = set_value('id_jenis_form',$apv["id_jenis_form"]);
				$data['nama_jenis_form']  = set_value('nama_jenis_form',$apv["nama_jenis_form"]);	
				$data['id_kompetensi']  = set_value('id_kompetensi',$apv["id_kompetensi"]);	
				$data['id_instansi']  = set_value('id_instansi',$apv["id_instansi"]);	
				$data['id_pegawai']  = set_value('id_pegawai',$apv["id_pegawai"]);	
				$data['barcode_pengajuan_validasi']  = set_value('barcode_pengajuan_validasi',$apv["barcode_pengajuan_validasi"]);
		    // ========================================	
				$data['kompetensi'] = $this->m_umum->ambil_data_explode('nkr_kompetensi','id_kompetensi',$apk['kode_unit_pengajuan']);
				$data['detil_elemen'] = $this->m_kredensial->ambil_nkr_grup_indikator_validasi($data['barcode_pengajuan_validasi'],'nas.id_elemen','no_urut_detil','asc');
				$data['perangkat'] = $this->m_umum->ambil_data('nkr_perangkat');
				$data['metode'] = $this->m_umum->ambil_data('nkr_metode');
				$data['alat'] = $this->m_umum->ambil_data('nkr_alat');
				$this->tampil_top($data);
				$status_pengajuan = $this->input->post('status_pengajuan');
				$id_form = $this->input->post('id_form');
				$barcode_pengajuan = $this->input->post('barcode_pengajuan');				
				$barcode_pengajuan_validasi = $this->input->post('barcode_pengajuan_validasi');				
				$action = $this->input->post('action'); 
				if($action == 'BtnSetuju') {
					if($status_pengajuan == 1){
							$this->m_ol_pengajuan->pengajuan_validasi_berkas_edit_setuju();
							$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
							redirect(base_url('ol_pengajuan/pengajuan_kompetensi/rencana/'.$barcode_pengajuan_validasi));
					}else{
							$this->session->set_flashdata('danger', 'Data Sudah Selesai');
							redirect(base_url('ol_pengajuan/pengajuan_kompetensi/rencana/'.$barcode_pengajuan_validasi));						
					}
				} 
      }
      if($mode=='observasi'){
        $data['page'] =  $data['page']."_observasi";
				$apv = $this->m_kredensial->ambil_pengajuan_validasi_pengajuan_valiasi($data['id']);
				$apk = $this->m_kredensial->ambil_pengajuan_kompetensi($apv['barcode_pengajuan']);
				// ========================================				
		    if($apk["id_pegawai"] !== $this->session->id_pegawai){
		    	$this->session->set_flashdata('danger', 'Data Tidak Valid');
		      redirect(base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$apk["barcode_pengajuan"]));
		    }
		    $data['kembali'] = base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$apk['barcode_pengajuan']);	
				// ========================================
		    if($apk["id_pegawai"] !== $this->session->id_pegawai){
		      redirect(base_url('ol_pengajuan/pengajuan_kompetensi'));
		    }
		    // ========================================
				$kondisi_form=array('id_jenis_form'=>$apv["id_jenis_form"],'id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi']);
				$nkre_form = $this->m_umum->ambil_data_kondisi('nkr_form',$kondisi_form);
		    // ========================================	
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$apk["barcode_pengajuan"]);
				$data['status_pengajuan']  = set_value('status_pengajuan',$apk["status_pengajuan"]);
				$data['id_pengajuan']  = set_value('id_pengajuan',$apk["id_pengajuan"]);
				$data['nama_pegawai']  = set_value('nama_pegawai',$apk["nama_pegawai"]);
				$data['nama_working']  = set_value('nama_working',$apk["nama_working"]);
				$data['nama_status_diusulkan']  = set_value('nama_status_diusulkan',$apk["nama_status_diusulkan"]);
				$data['nama_jabatan_fungsional']  = set_value('nama_jabatan_fungsional',$apk["nama_jabatan_fungsional"]);
				$data['tgl_pengajuan']  = $this->m_rancak->fullBulan(date('d-m-Y', strtotime($apk['tgl_pengajuan'])));
		    // ========================================	
				$data['nama_asesor']  = set_value('nama_asesor',$apv["nama_pegawai"]);
				$data['kesesuaian_bukti']  = explode(",", $apv["kesesuaian_bukti_validasi"]);
				$data['ket_pengajuan_validasi']  = set_value('ket_pengajuan_validasi',$apv["ket_pengajuan_validasi"]);
				$data['barcode_form']  = set_value('barcode_form',$nkre_form["barcode_form"]);
				$data['tgl_asesi']  = set_value('tgl_asesi',$apv["tgl_asesi"]);	
				$data['tgl_asesor']  = set_value('tgl_asesor',$apv["tgl_asesor"]);	
				$data['validasi']  = set_value('validasi',$apv["validasi"]);	
				$data['id_jenis_form']  = set_value('id_jenis_form',$apv["id_jenis_form"]);
				$data['nama_jenis_form']  = set_value('nama_jenis_form',$apv["nama_jenis_form"]);
				$data['barcode_pengajuan_validasi']  = set_value('barcode_pengajuan_validasi',$apv["barcode_pengajuan_validasi"]);
				$data['kompetensi'] = $this->m_umum->ambil_data_explode('nkr_kompetensi','id_kompetensi',$apk['kode_unit_pengajuan']);
$data['form2_detil'] = $this->m_kredensial->ambil_nkr_validasi_indikator_detil($apv['barcode_pengajuan_validasi']);
				$this->tampil_top($data);
				$status_pengajuan = $this->input->post('status_pengajuan');
				$id_form = $this->input->post('id_form');
				$barcode_pengajuan = $this->input->post('barcode_pengajuan');				
				$barcode_pengajuan_validasi = $this->input->post('barcode_pengajuan_validasi');				
				$action = $this->input->post('action'); 
				if($action == 'BtnSetuju') {
					if($status_pengajuan == 1){
							$this->m_ol_pengajuan->pengajuan_validasi_berkas_edit_setuju();
							$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
							redirect(base_url('ol_pengajuan/pengajuan_kompetensi/observasi/'.$barcode_pengajuan));
					}else{
							$this->session->set_flashdata('danger', 'Data Sudah Selesai');
							redirect(base_url('ol_pengajuan/pengajuan_kompetensi/observasi/'.$barcode_pengajuan));						
					}
				}
      }
      if($mode=='lisan'){
        $data['page'] =  $data['page']."_lisan";
				$apv = $this->m_kredensial->ambil_pengajuan_validasi_pengajuan_valiasi($data['id']);
				$apk = $this->m_kredensial->ambil_pengajuan_kompetensi($apv['barcode_pengajuan']);
				// ========================================				
		    if($apk["id_pegawai"] !== $this->session->id_pegawai){
		    	$this->session->set_flashdata('danger', 'Data Tidak Valid');
		      redirect(base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$apk["barcode_pengajuan"]));
		    }
		    $data['kembali'] = base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$apk['barcode_pengajuan']);	
				// ========================================
		    if($apk["id_pegawai"] !== $this->session->id_pegawai){
		      redirect(base_url('ol_pengajuan/pengajuan_kompetensi'));
		    }
		    // ========================================
				$kondisi_form=array('id_jenis_form'=>$apv["id_jenis_form"],'id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi']);
				$nkre_form = $this->m_umum->ambil_data_kondisi('nkr_form',$kondisi_form);
		    // ========================================	
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$apk["barcode_pengajuan"]);
				$data['status_pengajuan']  = set_value('status_pengajuan',$apk["status_pengajuan"]);
				$data['id_pengajuan']  = set_value('id_pengajuan',$apk["id_pengajuan"]);
				$data['nama_pegawai']  = set_value('nama_pegawai',$apk["nama_pegawai"]);
				$data['nama_working']  = set_value('nama_working',$apk["nama_working"]);
				$data['nama_status_diusulkan']  = set_value('nama_status_diusulkan',$apk["nama_status_diusulkan"]);
				$data['nama_jabatan_fungsional']  = set_value('nama_jabatan_fungsional',$apk["nama_jabatan_fungsional"]);
				$data['tgl_pengajuan']  = $this->m_rancak->fullBulan(date('d-m-Y', strtotime($apk['tgl_pengajuan'])));
		    // ========================================	
				$data['nama_asesor']  = set_value('nama_asesor',$apv["nama_pegawai"]);
				$data['kesesuaian_bukti']  = explode(",", $apv["kesesuaian_bukti_validasi"]);
				$data['ket_pengajuan_validasi']  = set_value('ket_pengajuan_validasi',$apv["ket_pengajuan_validasi"]);
				$data['barcode_form']  = set_value('barcode_form',$nkre_form["barcode_form"]);
				$data['tgl_asesi']  = set_value('tgl_asesi',$apv["tgl_asesi"]);	
				$data['tgl_asesor']  = set_value('tgl_asesor',$apv["tgl_asesor"]);	
				$data['validasi']  = set_value('validasi',$apv["validasi"]);	
				$data['id_jenis_form']  = set_value('id_jenis_form',$apv["id_jenis_form"]);
				$data['nama_jenis_form']  = set_value('nama_jenis_form',$apv["nama_jenis_form"]);
				$data['barcode_pengajuan_validasi']  = set_value('barcode_pengajuan_validasi',$apv["barcode_pengajuan_validasi"]);
		$data['kompetensi'] = $this->m_umum->ambil_data_explode('nkr_kompetensi','id_kompetensi',$apk['kode_unit_pengajuan']);
			$data['form2_detil'] = $this->m_kredensial->ambil_nkr_validasi_indikator_detil($apv['barcode_pengajuan_validasi']);
				$this->tampil_top($data);
				$status_pengajuan = $this->input->post('status_pengajuan');
				$barcode_form = $this->input->post('barcode_form');
				$barcode_pengajuan = $this->input->post('barcode_pengajuan');				
				$barcode_pengajuan_validasi = $this->input->post('barcode_pengajuan_validasi');				
				$action = $this->input->post('action');
				if($action == 'BtnSetuju') {
					if($status_pengajuan == 1){
							$this->m_ol_pengajuan->pengajuan_validasi_berkas_edit_setuju();
							$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
							redirect(base_url('ol_pengajuan/pengajuan_kompetensi/lisan/'.$barcode_pengajuan_validasi));
					}else{
							$this->session->set_flashdata('danger', 'Data Sudah Selesai');
							redirect(base_url('ol_pengajuan/pengajuan_kompetensi/lisan/'.$barcode_pengajuan_validasi));						
					}
				}
      }
      if($mode=='tulis'){
        $data['page'] =  $data['page']."_tulis";
				$apv = $this->m_kredensial->ambil_pengajuan_validasi_pengajuan_valiasi($data['id']);
				$apk = $this->m_kredensial->ambil_pengajuan_kompetensi($apv['barcode_pengajuan']);
				// ========================================				
		    if($apk["id_pegawai"] !== $this->session->id_pegawai){
		    	$this->session->set_flashdata('danger', 'Data Tidak Valid');
		      redirect(base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$apk["barcode_pengajuan"]));
		    }
		    $data['kembali'] = base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$apk['barcode_pengajuan']);	
				// ========================================
		    if($apk["id_pegawai"] !== $this->session->id_pegawai){
		      redirect(base_url('ol_pengajuan/pengajuan_kompetensi'));
		    }
		    // ========================================
				$kondisi_form=array('id_jenis_form'=>$apv["id_jenis_form"],'id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi']);
				$nkre_form = $this->m_umum->ambil_data_kondisi('nkr_form',$kondisi_form);
		    // ========================================	
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$apk["barcode_pengajuan"]);
				$data['status_pengajuan']  = set_value('status_pengajuan',$apk["status_pengajuan"]);
				$data['id_pengajuan']  = set_value('id_pengajuan',$apk["id_pengajuan"]);
				$data['nama_pegawai']  = set_value('nama_pegawai',$apk["nama_pegawai"]);
				$data['nama_working']  = set_value('nama_working',$apk["nama_working"]);
				$data['nama_status_diusulkan']  = set_value('nama_status_diusulkan',$apk["nama_status_diusulkan"]);
				$data['nama_jabatan_fungsional']  = set_value('nama_jabatan_fungsional',$apk["nama_jabatan_fungsional"]);
				$data['tgl_pengajuan']  = $this->m_rancak->fullBulan(date('d-m-Y', strtotime($apk['tgl_pengajuan'])));
		    // ========================================	
				$data['nama_asesor']  = set_value('nama_asesor',$apv["nama_pegawai"]);
				$data['kesesuaian_bukti']  = explode(",", $apv["kesesuaian_bukti_validasi"]);
				$data['ket_pengajuan_validasi']  = set_value('ket_pengajuan_validasi',$apv["ket_pengajuan_validasi"]);
				$data['barcode_form']  = set_value('barcode_form',$nkre_form["barcode_form"]);
				$data['tgl_asesi']  = set_value('tgl_asesi',$apv["tgl_asesi"]);	
				$data['tgl_asesor']  = set_value('tgl_asesor',$apv["tgl_asesor"]);	
				$data['validasi']  = set_value('validasi',$apv["validasi"]);	
				$data['locked']  = set_value('locked',$apv["locked"]);	
				$data['id_jenis_form']  = set_value('id_jenis_form',$apv["id_jenis_form"]);
				$data['nama_jenis_form']  = set_value('nama_jenis_form',$apv["nama_jenis_form"]);
				$data['barcode_pengajuan_validasi']  = set_value('barcode_pengajuan_validasi',$apv["barcode_pengajuan_validasi"]);
		$data['kompetensi'] = $this->m_umum->ambil_data_explode('nkr_kompetensi','id_kompetensi',$apk['kode_unit_pengajuan']);
			$data['form2_detil'] = $this->m_kredensial->ambil_nkr_validasi_indikator_detil($apv['barcode_pengajuan_validasi']);
				$this->tampil_top($data);
				$status_pengajuan = $this->input->post('status_pengajuan');
				$barcode_form = $this->input->post('barcode_form');
				$barcode_pengajuan = $this->input->post('barcode_pengajuan');				
				$barcode_pengajuan_validasi = $this->input->post('barcode_pengajuan_validasi');				
				$action = $this->input->post('action');
				if($action == 'BtnSimpan') {
					if($status_pengajuan == 1){
							$this->m_ol_pengajuan->simpan_indikator_validasi_tulis_locked();
							$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
							redirect(base_url('ol_pengajuan/pengajuan_kompetensi/tulis/'.$barcode_pengajuan_validasi));
					}else{
							$this->session->set_flashdata('danger', 'Data Sudah Selesai');
							redirect(base_url('ol_pengajuan/pengajuan_kompetensi/tulis/'.$barcode_pengajuan_validasi));						
					}
				}
				if($action == 'BtnSetuju') {
					if($status_pengajuan == 1){
							$this->m_ol_pengajuan->pengajuan_validasi_berkas_edit_locked();
							$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
							redirect(base_url('ol_pengajuan/pengajuan_kompetensi/tulis/'.$barcode_pengajuan_validasi));
					}else{
							$this->session->set_flashdata('danger', 'Data Sudah Selesai');
							redirect(base_url('ol_pengajuan/pengajuan_kompetensi/tulis/'.$barcode_pengajuan_validasi));						
					}
				}
				if($action == 'BtnKonfirmasi') {
					if($status_pengajuan == 1){
							$this->m_ol_pengajuan->pengajuan_validasi_berkas_akhir_locked();
							$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
							redirect(base_url('ol_pengajuan/pengajuan_kompetensi/tulis/'.$barcode_pengajuan_validasi));
					}else{
							$this->session->set_flashdata('danger', 'Data Sudah Selesai');
							redirect(base_url('ol_pengajuan/pengajuan_kompetensi/tulis/'.$barcode_pengajuan_validasi));						
					}
				}
      }
      if($mode=='portofolio'){
        $data['page'] =  $data['page']."_portofolio";
				$apv = $this->m_kredensial->ambil_pengajuan_validasi_pengajuan_valiasi($data['id']);
				$apk = $this->m_kredensial->ambil_pengajuan_kompetensi($apv['barcode_pengajuan']);
				// ========================================				
		    if($apk["id_pegawai"] !== $this->session->id_pegawai){
		    	$this->session->set_flashdata('danger', 'Data Tidak Valid');
		      redirect(base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$apk["barcode_pengajuan"]));
		    }
		    $data['kembali'] = base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$apk['barcode_pengajuan']);	
				// ========================================
		    if($apk["id_pegawai"] !== $this->session->id_pegawai){
		      redirect(base_url('ol_pengajuan/pengajuan_kompetensi'));
		    }
		    // ========================================
				$kondisi_form=array('id_jenis_form'=>$apv["id_jenis_form"],'id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi']);
				$nkre_form = $this->m_umum->ambil_data_kondisi('nkr_form',$kondisi_form);
		    // ========================================	
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$apk["barcode_pengajuan"]);
				$data['status_pengajuan']  = set_value('status_pengajuan',$apk["status_pengajuan"]);
				$data['id_pengajuan']  = set_value('id_pengajuan',$apk["id_pengajuan"]);
				$data['nama_pegawai']  = set_value('nama_pegawai',$apk["nama_pegawai"]);
				$data['nama_working']  = set_value('nama_working',$apk["nama_working"]);
				$data['nama_status_diusulkan']  = set_value('nama_status_diusulkan',$apk["nama_status_diusulkan"]);
				$data['nama_jabatan_fungsional']  = set_value('nama_jabatan_fungsional',$apk["nama_jabatan_fungsional"]);
				$data['tgl_pengajuan']  = $this->m_rancak->fullBulan(date('d-m-Y', strtotime($apk['tgl_pengajuan'])));
		    // ========================================	
				$data['nama_asesor']  = set_value('nama_asesor',$apv["nama_pegawai"]);
				$data['kesesuaian_bukti']  = explode(",", $apv["kesesuaian_bukti_validasi"]);
				$data['ket_pengajuan_validasi']  = set_value('ket_pengajuan_validasi',$apv["ket_pengajuan_validasi"]);
				$data['barcode_form']  = set_value('barcode_form',$nkre_form["barcode_form"]);
				$data['tgl_asesi']  = set_value('tgl_asesi',$apv["tgl_asesi"]);	
				$data['tgl_asesor']  = set_value('tgl_asesor',$apv["tgl_asesor"]);	
				$data['validasi']  = set_value('validasi',$apv["validasi"]);	
				$data['id_jenis_form']  = set_value('id_jenis_form',$apv["id_jenis_form"]);
				$data['nama_jenis_form']  = set_value('nama_jenis_form',$apv["nama_jenis_form"]);
				$data['barcode_pengajuan_validasi']  = set_value('barcode_pengajuan_validasi',$apv["barcode_pengajuan_validasi"]);
				$data['kompetensi'] = $this->m_umum->ambil_data_explode('nkr_kompetensi','id_kompetensi',$apk['kode_unit_pengajuan']);
				$data['form2_detil'] = $this->m_kredensial->ambil_nkr_validasi_indikator_detil($apv['barcode_pengajuan_validasi']);
				$data['ambil_lobook_kompetensi_group_pengajuan']=$this->m_ol_rancak->ambil_lobook_kompetensi_group_pengajuan($apk["id_pengajuan"]);
				$this->tampil_top($data);
				$status_pengajuan = $this->input->post('status_pengajuan');
				$barcode_form = $this->input->post('barcode_form');
				$barcode_pengajuan = $this->input->post('barcode_pengajuan');				
				$barcode_pengajuan_validasi = $this->input->post('barcode_pengajuan_validasi');				
				$action = $this->input->post('action');
				if($action == 'BtnSetuju') {
					if($status_pengajuan == 1){
							$this->m_ol_pengajuan->pengajuan_validasi_berkas_edit_setuju();
							$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
							redirect(base_url('ol_pengajuan/pengajuan_kompetensi/portofolio/'.$barcode_pengajuan_validasi));
					}else{
							$this->session->set_flashdata('danger', 'Data Sudah Selesai');
							redirect(base_url('ol_pengajuan/pengajuan_kompetensi/portofolio/'.$barcode_pengajuan_validasi));						
					}
				}
      }
      if($mode=='konsultasi'){
        $data['page'] =  $data['page']."_konsultasi";
				$apv = $this->m_kredensial->ambil_pengajuan_validasi_pengajuan_valiasi($data['id']);
				$apk = $this->m_kredensial->ambil_pengajuan_kompetensi($apv['barcode_pengajuan']);
				// ========================================				
		    if($apk["id_pegawai"] !== $this->session->id_pegawai){
		    	$this->session->set_flashdata('danger', 'Data Tidak Valid');
		      redirect(base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$apk["barcode_pengajuan"]));
		    }
		    $data['kembali'] = base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$apk['barcode_pengajuan']);	
				// ========================================
		    if($apk["id_pegawai"] !== $this->session->id_pegawai){
		      redirect(base_url('ol_pengajuan/pengajuan_kompetensi'));
		    }
		    // ========================================
				$kondisi_form=array('id_jenis_form'=>$apv["id_jenis_form"],'id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi']);
				$nkre_form = $this->m_umum->ambil_data_kondisi('nkr_form',$kondisi_form);
		    // ========================================	
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$apk["barcode_pengajuan"]);
				$data['status_pengajuan']  = set_value('status_pengajuan',$apk["status_pengajuan"]);
				$data['id_pengajuan']  = set_value('id_pengajuan',$apk["id_pengajuan"]);
				$data['nama_pegawai']  = set_value('nama_pegawai',$apk["nama_pegawai"]);
				$data['nama_working']  = set_value('nama_working',$apk["nama_working"]);
				$data['nama_status_diusulkan']  = set_value('nama_status_diusulkan',$apk["nama_status_diusulkan"]);
				$data['nama_jabatan_fungsional']  = set_value('nama_jabatan_fungsional',$apk["nama_jabatan_fungsional"]);
				$data['tgl_pengajuan']  = $this->m_rancak->fullBulan(date('d-m-Y', strtotime($apk['tgl_pengajuan'])));
		    // ========================================	
				$data['nama_asesor']  = set_value('nama_asesor',$apv["nama_pegawai"]);
				$data['kesesuaian_bukti']  = explode(",", $apv["kesesuaian_bukti_validasi"]);
				$data['ket_pengajuan_validasi']  = set_value('ket_pengajuan_validasi',$apv["ket_pengajuan_validasi"]);
				$data['barcode_form']  = set_value('barcode_form',$nkre_form["barcode_form"]);
				$data['tgl_asesi']  = set_value('tgl_asesi',$apv["tgl_asesi"]);	
				$data['tgl_asesor']  = set_value('tgl_asesor',$apv["tgl_asesor"]);	
				$data['validasi']  = set_value('validasi',$apv["validasi"]);	
				$data['id_jenis_form']  = set_value('id_jenis_form',$apv["id_jenis_form"]);
				$data['nama_jenis_form']  = set_value('nama_jenis_form',$apv["nama_jenis_form"]);
				$data['barcode_pengajuan_validasi']  = set_value('barcode_pengajuan_validasi',$apv["barcode_pengajuan_validasi"]);
				$data['kompetensi'] = $this->m_umum->ambil_data_explode('nkr_kompetensi','id_kompetensi',$apk['kode_unit_pengajuan']);
			$data['form2_detil'] = $this->m_kredensial->ambil_validasi_grup_pra_asesmen($apv['barcode_pengajuan_validasi'],'npa.id_pra_asesmen','no_urut_detil','ASC');
				$this->tampil_top($data);
				$status_pengajuan = $this->input->post('status_pengajuan');
				$barcode_form = $this->input->post('barcode_form');
				$barcode_pengajuan = $this->input->post('barcode_pengajuan');				
				$barcode_pengajuan_validasi = $this->input->post('barcode_pengajuan_validasi');				
				$action = $this->input->post('action');
				if($action == 'BtnSetuju') {
					if($status_pengajuan == 1){
							$this->m_ol_pengajuan->pengajuan_validasi_berkas_edit_setuju();
							$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
							redirect(base_url('ol_pengajuan/pengajuan_kompetensi/konsultasi/'.$barcode_pengajuan_validasi));
					}else{
							$this->session->set_flashdata('danger', 'Data Sudah Selesai');
							redirect(base_url('ol_pengajuan/pengajuan_kompetensi/konsultasi/'.$barcode_pengajuan_validasi));						
					}
				}
      }
      if($mode=='cek'){
        $data['page'] =  $data['page']."_cek";
				$apv = $this->m_kredensial->ambil_pengajuan_validasi_pengajuan_valiasi($data['id']);
				$apk = $this->m_kredensial->ambil_pengajuan_kompetensi($apv['barcode_pengajuan']);
				// ========================================				
		    if($apk["id_pegawai"] !== $this->session->id_pegawai){
		    	$this->session->set_flashdata('danger', 'Data Tidak Valid');
		      redirect(base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$apk["barcode_pengajuan"]));
		    }
		    $data['kembali'] = base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$apk['barcode_pengajuan']);	
				// ========================================
		    if($apk["id_pegawai"] !== $this->session->id_pegawai){
		      redirect(base_url('ol_pengajuan/pengajuan_kompetensi'));
		    }
		    // ========================================
				$kondisi_form=array('id_jenis_form'=>$apv["id_jenis_form"],'id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi']);
				$nkre_form = $this->m_umum->ambil_data_kondisi('nkr_form',$kondisi_form);
		    // ========================================	
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$apk["barcode_pengajuan"]);
				$data['status_pengajuan']  = set_value('status_pengajuan',$apk["status_pengajuan"]);
				$data['id_pengajuan']  = set_value('id_pengajuan',$apk["id_pengajuan"]);
				$data['nama_pegawai']  = set_value('nama_pegawai',$apk["nama_pegawai"]);
				$data['nama_working']  = set_value('nama_working',$apk["nama_working"]);
				$data['nama_status_diusulkan']  = set_value('nama_status_diusulkan',$apk["nama_status_diusulkan"]);
				$data['nama_jabatan_fungsional']  = set_value('nama_jabatan_fungsional',$apk["nama_jabatan_fungsional"]);
				$data['tgl_pengajuan']  = $this->m_rancak->fullBulan(date('d-m-Y', strtotime($apk['tgl_pengajuan'])));
		    // ========================================	
				$data['nama_asesor']  = set_value('nama_asesor',$apv["nama_pegawai"]);
				$data['kesesuaian_bukti']  = explode(",", $apv["kesesuaian_bukti_validasi"]);
				$data['ket_pengajuan_validasi']  = set_value('ket_pengajuan_validasi',$apv["ket_pengajuan_validasi"]);
				$data['barcode_form']  = set_value('barcode_form',$nkre_form["barcode_form"]);
				$data['tgl_asesi']  = set_value('tgl_asesi',$apv["tgl_asesi"]);	
				$data['tgl_asesor']  = set_value('tgl_asesor',$apv["tgl_asesor"]);	
				$data['validasi']  = set_value('validasi',$apv["validasi"]);	
				$data['id_jenis_form']  = set_value('id_jenis_form',$apv["id_jenis_form"]);
				$data['nama_jenis_form']  = set_value('nama_jenis_form',$apv["nama_jenis_form"]);
				$data['barcode_pengajuan_validasi']  = set_value('barcode_pengajuan_validasi',$apv["barcode_pengajuan_validasi"]);
				$data['kompetensi'] = $this->m_umum->ambil_data_explode('nkr_kompetensi','id_kompetensi',$apk['kode_unit_pengajuan']);
			$data['form2_detil'] = $this->m_kredensial->ambil_validasi_grup_pra_asesmen($apv['barcode_pengajuan_validasi'],'npa.id_pra_asesmen','no_urut_detil','ASC');
				$this->tampil_top($data);
				$status_pengajuan = $this->input->post('status_pengajuan');
				$barcode_form = $this->input->post('barcode_form');
				$barcode_pengajuan = $this->input->post('barcode_pengajuan');				
				$barcode_pengajuan_validasi = $this->input->post('barcode_pengajuan_validasi');				
				$action = $this->input->post('action');
				if($action == 'BtnSetuju') {
					if($status_pengajuan == 1){
							$this->m_ol_pengajuan->pengajuan_validasi_berkas_edit_setuju();
							$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
							redirect(base_url('ol_pengajuan/pengajuan_kompetensi/cek/'.$barcode_pengajuan_validasi));
					}else{
							$this->session->set_flashdata('danger', 'Data Sudah Selesai');
							redirect(base_url('ol_pengajuan/pengajuan_kompetensi/cek/'.$barcode_pengajuan_validasi));						
					}
				}
      }
      if($mode=='keputusan'){
        $data['page'] =  $data['page']."_keputusan";
				$apv = $this->m_kredensial->ambil_pengajuan_validasi_pengajuan_valiasi($data['id']);
				$apk = $this->m_kredensial->ambil_pengajuan_kompetensi($apv['barcode_pengajuan']);
				// ========================================				
		    if($apk["id_pegawai"] !== $this->session->id_pegawai){
		    	$this->session->set_flashdata('danger', 'Data Tidak Valid');
		      redirect(base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$apk["barcode_pengajuan"]));
		    }
		    $data['kembali'] = base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$apk['barcode_pengajuan']);	
				// ========================================
		    if($apk["id_pegawai"] !== $this->session->id_pegawai){
		      redirect(base_url('ol_pengajuan/pengajuan_kompetensi'));
		    }
		    // ========================================
				$kondisi_form=array('id_jenis_form'=>$apv["id_jenis_form"],'id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi']);
				$nkre_form = $this->m_umum->ambil_data_kondisi('nkr_form',$kondisi_form);
		    // ========================================	
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$apk["barcode_pengajuan"]);
				$data['status_pengajuan']  = set_value('status_pengajuan',$apk["status_pengajuan"]);
				$data['id_pengajuan']  = set_value('id_pengajuan',$apk["id_pengajuan"]);
				$data['nama_pegawai']  = set_value('nama_pegawai',$apk["nama_pegawai"]);
				$data['nama_working']  = set_value('nama_working',$apk["nama_working"]);
				$data['nama_status_diusulkan']  = set_value('nama_status_diusulkan',$apk["nama_status_diusulkan"]);
				$data['nama_jabatan_fungsional']  = set_value('nama_jabatan_fungsional',$apk["nama_jabatan_fungsional"]);
				$data['tgl_pengajuan']  = $this->m_rancak->fullBulan(date('d-m-Y', strtotime($apk['tgl_pengajuan'])));
		    // ========================================	
				$data['nama_asesor']  = set_value('nama_asesor',$apv["nama_pegawai"]);
				$data['kesesuaian_bukti']  = explode(",", $apv["kesesuaian_bukti_validasi"]);
				$data['ket_pengajuan_validasi']  = set_value('ket_pengajuan_validasi',$apv["ket_pengajuan_validasi"]);
				$data['barcode_form']  = set_value('barcode_form',$nkre_form["barcode_form"]);
				$data['tgl_asesi']  = set_value('tgl_asesi',$apv["tgl_asesi"]);	
				$data['tgl_asesor']  = set_value('tgl_asesor',$apv["tgl_asesor"]);	
				$data['validasi']  = set_value('validasi',$apv["validasi"]);	
				$data['id_jenis_form']  = set_value('id_jenis_form',$apv["id_jenis_form"]);
				$data['id_instansi']  = set_value('id_instansi',$apv["id_instansi"]);
				$data['id_kompetensi']  = set_value('id_kompetensi',$apv["id_kompetensi"]);
				$data['nama_jenis_form']  = set_value('nama_jenis_form',$apv["nama_jenis_form"]);
				$data['barcode_pengajuan_validasi']  = set_value('barcode_pengajuan_validasi',$apv["barcode_pengajuan_validasi"]);
				$data['kompetensi'] = $this->m_umum->ambil_data_explode('nkr_kompetensi','id_kompetensi',$apk['kode_unit_pengajuan']);
			$data['form2_detil'] = $this->m_kredensial->ambil_validasi_grup_form7($apv['barcode_pengajuan'],'nas.id_elemen','no_urut_detil','ASC');
				$this->tampil_top($data);
				$status_pengajuan = $this->input->post('status_pengajuan');
				$barcode_form = $this->input->post('barcode_form');
				$barcode_pengajuan = $this->input->post('barcode_pengajuan');				
				$barcode_pengajuan_validasi = $this->input->post('barcode_pengajuan_validasi');				
				$action = $this->input->post('action');
				if($action == 'BtnSetuju') {
					if($status_pengajuan == 1){
							$this->m_ol_pengajuan->pengajuan_validasi_berkas_edit_setuju();
							$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
							redirect(base_url('ol_pengajuan/pengajuan_kompetensi/keputusan/'.$barcode_pengajuan_validasi));
					}else{
							$this->session->set_flashdata('danger', 'Data Sudah Selesai');
							redirect(base_url('ol_pengajuan/pengajuan_kompetensi/keputusan/'.$barcode_pengajuan_validasi));						
					}
				}
      }
      if($mode=='banding'){
        $data['page'] =  $data['page']."_banding";
				$apv = $this->m_kredensial->ambil_pengajuan_validasi_pengajuan_valiasi($data['id']);
				$apk = $this->m_kredensial->ambil_pengajuan_kompetensi($apv['barcode_pengajuan']);
				// ========================================				
		    if($apk["id_pegawai"] !== $this->session->id_pegawai){
		    	$this->session->set_flashdata('danger', 'Data Tidak Valid');
		      redirect(base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$apk["barcode_pengajuan"]));
		    }
		    $data['kembali'] = base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$apk['barcode_pengajuan']);	
				// ========================================
		    if($apk["id_pegawai"] !== $this->session->id_pegawai){
		      redirect(base_url('ol_pengajuan/pengajuan_kompetensi'));
		    }
		    // ========================================
				$kondisi_form=array('id_jenis_form'=>$apv["id_jenis_form"],'id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi']);
				$nkre_form = $this->m_umum->ambil_data_kondisi('nkr_form',$kondisi_form);
		    // ========================================	
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$apk["barcode_pengajuan"]);
				$data['status_pengajuan']  = set_value('status_pengajuan',$apk["status_pengajuan"]);
				$data['id_pengajuan']  = set_value('id_pengajuan',$apk["id_pengajuan"]);
				$data['nama_pegawai']  = set_value('nama_pegawai',$apk["nama_pegawai"]);
				$data['nama_working']  = set_value('nama_working',$apk["nama_working"]);
				$data['nama_status_diusulkan']  = set_value('nama_status_diusulkan',$apk["nama_status_diusulkan"]);
				$data['nama_jabatan_fungsional']  = set_value('nama_jabatan_fungsional',$apk["nama_jabatan_fungsional"]);
				$data['tgl_pengajuan']  = $this->m_rancak->fullBulan(date('d-m-Y', strtotime($apk['tgl_pengajuan'])));
		    // ========================================	
				$data['nama_asesor']  = set_value('nama_asesor',$apv["nama_pegawai"]);
				$data['kesesuaian_bukti']  = explode(",", $apv["kesesuaian_bukti_validasi"]);
				$data['ket_pengajuan_validasi']  = set_value('ket_pengajuan_validasi',$apv["ket_pengajuan_validasi"]);
				$data['barcode_form']  = set_value('barcode_form',$nkre_form["barcode_form"]);
				$data['tgl_asesi']  = set_value('tgl_asesi',$apv["tgl_asesi"]);	
				$data['tgl_asesor']  = set_value('tgl_asesor',$apv["tgl_asesor"]);	
				$data['validasi']  = set_value('validasi',$apv["validasi"]);	
				$data['id_jenis_form']  = set_value('id_jenis_form',$apv["id_jenis_form"]);
				$data['id_instansi']  = set_value('id_instansi',$apv["id_instansi"]);
				$data['id_kompetensi']  = set_value('id_kompetensi',$apv["id_kompetensi"]);
				$data['nama_jenis_form']  = set_value('nama_jenis_form',$apv["nama_jenis_form"]);
				$data['barcode_pengajuan_validasi']  = set_value('barcode_pengajuan_validasi',$apv["barcode_pengajuan_validasi"]);
				$data['banding_asesi']  = set_value('banding_asesi',$apv["banding_asesi"]);
				$data['locked']  = set_value('locked',$apv["locked"]);
		$bpve = $this->m_umum->ambil_data('kol_jenis_form','id_jenis_form',$apv["banding_form"]);
$data['nama_banding_form']  = set_value('nama_banding_form',$bpve["nama_jenis_form"]);
				$data['kompetensi'] = $this->m_umum->ambil_data_explode('nkr_kompetensi','id_kompetensi',$apk['kode_unit_pengajuan']);
			$data['form2_detil'] = $this->m_kredensial->ambil_validasi_grup_form7($apv['barcode_pengajuan'],'nas.id_elemen','no_urut_detil','ASC');
				$this->tampil_top($data);
				$status_pengajuan = $this->input->post('status_pengajuan');
				$barcode_form = $this->input->post('barcode_form');
				$barcode_pengajuan = $this->input->post('barcode_pengajuan');				
				$barcode_pengajuan_validasi = $this->input->post('barcode_pengajuan_validasi');				
				$action = $this->input->post('action');
				if($action == 'BtnSimpan') {
					if($status_pengajuan == 1){
							$this->m_ol_pengajuan->pengajuan_validasi_berkas_banding_simpan();
							$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
							redirect(base_url('ol_pengajuan/pengajuan_kompetensi/banding/'.$barcode_pengajuan_validasi));
					}else{
							$this->session->set_flashdata('danger', 'Data Sudah Selesai');
							redirect(base_url('ol_pengajuan/pengajuan_kompetensi/banding/'.$barcode_pengajuan_validasi));						
					}
				}
				if($action == 'BtnKonfirmasi') {
					if($status_pengajuan == 1){
							$this->m_ol_pengajuan->pengajuan_validasi_berkas_banding_konfirm();
							$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
							redirect(base_url('ol_pengajuan/pengajuan_kompetensi/banding/'.$barcode_pengajuan_validasi));
					}else{
							$this->session->set_flashdata('danger', 'Data Sudah Selesai');
							redirect(base_url('ol_pengajuan/pengajuan_kompetensi/banding/'.$barcode_pengajuan_validasi));						
					}
				}
				if($action == 'BtnSetuju') {
					if($status_pengajuan == 1){
							$this->m_ol_pengajuan->pengajuan_validasi_berkas_banding_setuju();
							$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
							redirect(base_url('ol_pengajuan/pengajuan_kompetensi/banding/'.$barcode_pengajuan_validasi));
					}else{
							$this->session->set_flashdata('danger', 'Data Sudah Selesai');
							redirect(base_url('ol_pengajuan/pengajuan_kompetensi/banding/'.$barcode_pengajuan_validasi));						
					}
				}
      }
      if($mode=='komponen'){
        $data['page'] =  $data['page']."_komponen";
				$apv = $this->m_kredensial->ambil_pengajuan_validasi_pengajuan_valiasi($data['id']);
				$apk = $this->m_kredensial->ambil_pengajuan_kompetensi($apv['barcode_pengajuan']);
				// ========================================				
		    if($apk["id_pegawai"] !== $this->session->id_pegawai){
		    	$this->session->set_flashdata('danger', 'Data Tidak Valid');
		      redirect(base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$apk["barcode_pengajuan"]));
		    }
		    $data['kembali'] = base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$apk['barcode_pengajuan']);	
				// ========================================
		    if($apk["id_pegawai"] !== $this->session->id_pegawai){
		      redirect(base_url('ol_pengajuan/pengajuan_kompetensi'));
		    }
		    // ========================================
				$kondisi_form=array('id_jenis_form'=>$apv["id_jenis_form"],'id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi']);
				$nkre_form = $this->m_umum->ambil_data_kondisi('nkr_form',$kondisi_form);
		    // ========================================	
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$apk["barcode_pengajuan"]);
				$data['status_pengajuan']  = set_value('status_pengajuan',$apk["status_pengajuan"]);
				$data['id_pengajuan']  = set_value('id_pengajuan',$apk["id_pengajuan"]);
				$data['nama_pegawai']  = set_value('nama_pegawai',$apk["nama_pegawai"]);
				$data['nama_working']  = set_value('nama_working',$apk["nama_working"]);
				$data['nama_status_diusulkan']  = set_value('nama_status_diusulkan',$apk["nama_status_diusulkan"]);
				$data['nama_jabatan_fungsional']  = set_value('nama_jabatan_fungsional',$apk["nama_jabatan_fungsional"]);
				$data['tgl_pengajuan']  = $this->m_rancak->fullBulan(date('d-m-Y', strtotime($apk['tgl_pengajuan'])));
		    // ========================================	
				$data['nama_asesor']  = set_value('nama_asesor',$apv["nama_pegawai"]);
				$data['kesesuaian_bukti']  = explode(",", $apv["kesesuaian_bukti_validasi"]);
				$data['ket_pengajuan_validasi']  = set_value('ket_pengajuan_validasi',$apv["ket_pengajuan_validasi"]);
				$data['barcode_form']  = set_value('barcode_form',$nkre_form["barcode_form"]);
				$data['tgl_asesi']  = set_value('tgl_asesi',$apv["tgl_asesi"]);	
				$data['tgl_asesor']  = set_value('tgl_asesor',$apv["tgl_asesor"]);	
				$data['validasi']  = set_value('validasi',$apv["validasi"]);	
				$data['id_jenis_form']  = set_value('id_jenis_form',$apv["id_jenis_form"]);
				$data['id_instansi']  = set_value('id_instansi',$apv["id_instansi"]);
				$data['id_kompetensi']  = set_value('id_kompetensi',$apv["id_kompetensi"]);
				$data['nama_jenis_form']  = set_value('nama_jenis_form',$apv["nama_jenis_form"]);
				$data['barcode_pengajuan_validasi']  = set_value('barcode_pengajuan_validasi',$apv["barcode_pengajuan_validasi"]);
				$data['banding_asesi']  = set_value('banding_asesi',$apv["banding_asesi"]);
				$data['locked']  = set_value('locked',$apv["locked"]);
		$bpve = $this->m_umum->ambil_data('kol_jenis_form','id_jenis_form',$apv["banding_form"]);
$data['nama_banding_form']  = set_value('nama_banding_form',$bpve["nama_jenis_form"]);
				$data['kompetensi'] = $this->m_umum->ambil_data_explode('nkr_kompetensi','id_kompetensi',$apk['kode_unit_pengajuan']);
$data['form'] = $this->m_kredensial->ambil_validasi_kaji_pra_detil($apv['barcode_pengajuan_validasi'],'no_urut_detil','ASC');
				$this->tampil_top($data);
				$status_pengajuan = $this->input->post('status_pengajuan');
				$barcode_form = $this->input->post('barcode_form');
				$barcode_pengajuan = $this->input->post('barcode_pengajuan');				
				$barcode_pengajuan_validasi = $this->input->post('barcode_pengajuan_validasi');				
				$action = $this->input->post('action');
				if($action == 'BtnSimpan') {
					if($status_pengajuan == 1){
							$this->m_ol_pengajuan->pengajuan_validasi_berkas_kaji_ulang_setuju();
							$this->m_ol_pengajuan->simpan_kaji_ulang_setuju();
							$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
							redirect(base_url('ol_pengajuan/pengajuan_kompetensi/komponen/'.$barcode_pengajuan_validasi));
					}else{
							$this->session->set_flashdata('danger', 'Data Sudah Selesai');
							redirect(base_url('ol_pengajuan/pengajuan_kompetensi/komponen/'.$barcode_pengajuan_validasi));						
					}
				}
				if($action == 'BtnKonfirmasi') {
					if($status_pengajuan == 1){
							$this->m_ol_pengajuan->pengajuan_validasi_berkas_komponen_konfirm();
							$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
							redirect(base_url('ol_pengajuan/pengajuan_kompetensi/komponen/'.$barcode_pengajuan_validasi));
					}else{
							$this->session->set_flashdata('danger', 'Data Sudah Selesai');
							redirect(base_url('ol_pengajuan/pengajuan_kompetensi/komponen/'.$barcode_pengajuan_validasi));						
					}
				}
				if($action == 'BtnSetuju') {
					if($status_pengajuan == 1){
							$this->m_ol_pengajuan->pengajuan_validasi_berkas_komponen_setuju();
							$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
							redirect(base_url('ol_pengajuan/pengajuan_kompetensi/komponen/'.$barcode_pengajuan_validasi));
					}else{
							$this->session->set_flashdata('danger', 'Data Sudah Selesai');
							redirect(base_url('ol_pengajuan/pengajuan_kompetensi/komponen/'.$barcode_pengajuan_validasi));						
					}
				}
      }
      if($mode=='kesenjangan'){
        $data['page'] =  $data['page']."_kesenjangan";
				$apv = $this->m_kredensial->ambil_pengajuan_validasi_pengajuan_valiasi($data['id']);
				$apk = $this->m_kredensial->ambil_pengajuan_kompetensi($apv['barcode_pengajuan']);
				// ========================================				
		    if($apk["id_pegawai"] !== $this->session->id_pegawai){
		    	$this->session->set_flashdata('danger', 'Data Tidak Valid');
		      redirect(base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$apk["barcode_pengajuan"]));
		    }
		    $data['kembali'] = base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$apk['barcode_pengajuan']);	
				// ========================================
		    if($apk["id_pegawai"] !== $this->session->id_pegawai){
		      redirect(base_url('ol_pengajuan/pengajuan_kompetensi'));
		    }
		    // ========================================
				$kondisi_form=array('id_jenis_form'=>$apv["id_jenis_form"],'id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi']);
				$nkre_form = $this->m_umum->ambil_data_kondisi('nkr_form',$kondisi_form);
		    // ========================================	
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$apk["barcode_pengajuan"]);
				$data['status_pengajuan']  = set_value('status_pengajuan',$apk["status_pengajuan"]);
				$data['id_pengajuan']  = set_value('id_pengajuan',$apk["id_pengajuan"]);
				$data['nama_pegawai']  = set_value('nama_pegawai',$apk["nama_pegawai"]);
				$data['nama_working']  = set_value('nama_working',$apk["nama_working"]);
				$data['nama_status_diusulkan']  = set_value('nama_status_diusulkan',$apk["nama_status_diusulkan"]);
				$data['nama_jabatan_fungsional']  = set_value('nama_jabatan_fungsional',$apk["nama_jabatan_fungsional"]);
				$data['tgl_pengajuan']  = $this->m_rancak->fullBulan(date('d-m-Y', strtotime($apk['tgl_pengajuan'])));
		    // ========================================	
				$data['nama_asesor']  = set_value('nama_asesor',$apv["nama_pegawai"]);
				$data['kesesuaian_bukti']  = explode(",", $apv["kesesuaian_bukti_validasi"]);
				$data['ket_pengajuan_validasi']  = set_value('ket_pengajuan_validasi',$apv["ket_pengajuan_validasi"]);
				$data['barcode_form']  = set_value('barcode_form',$nkre_form["barcode_form"]);
				$data['tgl_asesi']  = set_value('tgl_asesi',$apv["tgl_asesi"]);	
				$data['tgl_asesor']  = set_value('tgl_asesor',$apv["tgl_asesor"]);	
				$data['validasi']  = set_value('validasi',$apv["validasi"]);	
				$data['id_jenis_form']  = set_value('id_jenis_form',$apv["id_jenis_form"]);
				$data['id_instansi']  = set_value('id_instansi',$apv["id_instansi"]);
				$data['id_kompetensi']  = set_value('id_kompetensi',$apv["id_kompetensi"]);
				$data['nama_jenis_form']  = set_value('nama_jenis_form',$apv["nama_jenis_form"]);
				$data['barcode_pengajuan_validasi']  = set_value('barcode_pengajuan_validasi',$apv["barcode_pengajuan_validasi"]);
				$data['banding_asesi']  = set_value('banding_asesi',$apv["banding_asesi"]);
				$data['locked']  = set_value('locked',$apv["locked"]);
		$bpve = $this->m_umum->ambil_data('kol_jenis_form','id_jenis_form',$apv["banding_form"]);
$data['nama_banding_form']  = set_value('nama_banding_form',$bpve["nama_jenis_form"]);
				$data['kompetensi'] = $this->m_umum->ambil_data_explode('nkr_kompetensi','id_kompetensi',$apk['kode_unit_pengajuan']);
$data['form'] = $this->m_kredensial->ambil_nkr_grup_kaji_ulang($nkre_form['barcode_form'],'npd.id_kat_kaji','no_urut_detil','ASC');
				$this->tampil_top($data);
				$status_pengajuan = $this->input->post('status_pengajuan');
				$barcode_form = $this->input->post('barcode_form');
				$barcode_pengajuan = $this->input->post('barcode_pengajuan');				
				$barcode_pengajuan_validasi = $this->input->post('barcode_pengajuan_validasi');				
				$action = $this->input->post('action');
				if($action == 'BtnSimpan') {
					if($status_pengajuan == 1){
							$this->m_ol_pengajuan->pengajuan_validasi_berkas_kaji_ulang_setuju();
							$this->m_ol_pengajuan->simpan_kaji_ulang_setuju();
							$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
							redirect(base_url('ol_pengajuan/pengajuan_kompetensi/komponen/'.$barcode_pengajuan_validasi));
					}else{
							$this->session->set_flashdata('danger', 'Data Sudah Selesai');
							redirect(base_url('ol_pengajuan/pengajuan_kompetensi/komponen/'.$barcode_pengajuan_validasi));						
					}
				}
				if($action == 'BtnKonfirmasi') {
					if($status_pengajuan == 1){
							$this->m_ol_pengajuan->pengajuan_validasi_berkas_komponen_konfirm();
							$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
							redirect(base_url('ol_pengajuan/pengajuan_kompetensi/komponen/'.$barcode_pengajuan_validasi));
					}else{
							$this->session->set_flashdata('danger', 'Data Sudah Selesai');
							redirect(base_url('ol_pengajuan/pengajuan_kompetensi/komponen/'.$barcode_pengajuan_validasi));						
					}
				}
				if($action == 'BtnSetuju') {
					if($status_pengajuan == 1){
							$this->m_ol_pengajuan->pengajuan_validasi_berkas_komponen_setuju();
							$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
							redirect(base_url('ol_pengajuan/pengajuan_kompetensi/komponen/'.$barcode_pengajuan_validasi));
					}else{
							$this->session->set_flashdata('danger', 'Data Sudah Selesai');
							redirect(base_url('ol_pengajuan/pengajuan_kompetensi/komponen/'.$barcode_pengajuan_validasi));						
					}
				}
				if($action == 'BtnSetujsu') {
					if($status_pengajuan == 1){
							$this->m_ol_pengajuan->pengajuan_validasi_berkas_kaji_ulang_setuju();
							$this->m_ol_pengajuan->simpan_kaji_ulang_setuju();
							$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
							redirect(base_url('ol_pengajuan/pengajuan_kompetensi/kesenjangan/'.$barcode_pengajuan_validasi));
					}else{
							$this->session->set_flashdata('danger', 'Data Sudah Selesai');
							redirect(base_url('ol_pengajuan/pengajuan_kompetensi/kesenjangan/'.$barcode_pengajuan_validasi));						
					}
				}
      }
		if($mode=='pdf'){
		  $report = $this->load->view('cetak/logbook_pengajuan', $data, TRUE);
		  $filename = $data['header'].".pdf";
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-L']);
		  $mpdf->AddPage('P', '', '', '', 2, 5, 5, 5, 5, 3, 3);
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
		}
		if($mode=='pdf_etika'){
		  $report = $this->load->view('cetak/etika_profesi', $data, TRUE);
		  $filename = $data['header'].".pdf";
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-L']);
		  $mpdf->AddPage('P', '', '', '', 2, 5, 5, 5, 10, 3, 3);
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
		  //$mpdf->SetFooter('Page : {PAGENO}');
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
    if($mode=='pdf_rkk'){
        $apk = $this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$data['id']);
        $data['id_pengajuan']  = set_value('id_pengajuan',$apk['id_pengajuan']);
        $report = $this->load->view('cetak/ol_logbook_rkk', $data, TRUE);
        $filename = $data['header'].".pdf";
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
  function berkas_logbook($mode='view')
  {
		$data['page']  = "berkas_logbook";
		$data['header'] = "PEMILIHAN ID LOGBOOK AWAL DAN AKHIR";
		$data['title'] = "PEMILIHAN ID LOGBOOK AWAL DAN AKHIR";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
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
		// ===============================================================
		$data['first_date']  = $this->uri->segment(4, 0);
		$data['last_date']   = $this->uri->segment(5, 0);
		$data['id']   = $this->uri->segment(6, 0); //id pengajuan
		$data['link_kembali'] = base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$data['id']);
		$pengajuan = $this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$data['id']);
		$data['id_pengajuan'] = $pengajuan["id_pengajuan"];
		$data['id_status_diusulkan'] = $pengajuan["id_status_diusulkan"];
		$data['status_pengajuan'] = $pengajuan["status_pengajuan"];
		if(empty($data['first_date'])){
			$data['first_date'] =  '01-'.date('m-Y');
		}
		if(empty($data['last_date'])){
			$data['last_date'] = date('d-m-Y');
		}
		if($pengajuan["id_status_diusulkan"] == 4){
			$data['logbook_pengajuan'] = $this->m_ol_pengajuan->logbook_ditolak($data['first_date'],$data['last_date']);
		}else{
			$data['logbook_pengajuan'] = $this->m_ol_pengajuan->logbook_pengajuan($data['first_date'],$data['last_date'],$data['id']);
		}	
	    if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$first_date = $this->input->post("first_date");
				$last_date = $this->input->post("last_date");
				$id = $this->input->post("barcode_pengajuan");
				redirect(base_url('ol_pengajuan/berkas_logbook/view/'.$first_date.'/'.$last_date.'/'.$id));
			}
			if($action == 'BtnSimpan') {
				$id = $this->input->post("barcode_pengajuan");
				$status_pengajuan = $this->input->post("status_pengajuan");
				if($status_pengajuan == 0){
				$this->m_ol_pengajuan->simpan_logbook();
				}
				redirect(base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$id));
			}
		}
  }
  function berkas_ijasah($mode='view')
  {
	$data['page']  = "berkas_ijasah";
	$data['header'] = "AMBIL BERKAS IJASAH";
	$data['title'] = "AMBIL BERKAS IJASAH";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
//		$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
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
		$data['id']  = $this->uri->segment(4, 0);
		$data['idb']  = $this->uri->segment(5, 0);
		$data['link_kembali'] = base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$data['id']);
		$pengajuan = $this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$data['id']);
		$data['id_pengajuan'] = $pengajuan["id_pengajuan"];
    if($mode=='view'){
		$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_ol_pengajuan->berkas_ijasah_all());
	}
  else{
      if($mode=='simpan'){
				$status_pengajuan=$this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$data['id']);
				$id_ijasahe = $status_pengajuan['id_ijasah'];
				$id_pengajuan = $status_pengajuan['id_pengajuan'];
				$status_pengajuan = $status_pengajuan['status_pengajuan'];
				if($status_pengajuan == 0){
				$this->m_ol_pengajuan->simpan_berkas_ijasah($id_pengajuan,$data['idb'],$id_ijasahe);
				}
				redirect(base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$data['id']));
      }
	}
  }
  function berkas_sertifikat($mode='view')
  {
	$data['page']  = "berkas_sertifikat";
	$data['header'] = "AMBIL BERKAS PELATIHAN / SERTIFIKAT";
	$data['title'] = "AMBIL BERKAS PELATIHAN / SERTIFIKAT";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
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
		$data['id']  = $this->uri->segment(4, 0);
		$data['idb']  = $this->uri->segment(5, 0);
		$data['link_kembali'] = base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$data['id']);
		$pengajuan = $this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$data['id']);
		$data['id_pengajuan'] = $pengajuan["id_pengajuan"];
    if($mode=='view'){
		$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_ol_pengajuan->berkas_pelatihan_all());
	}
  else{
      if($mode=='simpan'){
				$status_pengajuan=$this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$data['id']);
				$id_ijasahe = $status_pengajuan['id_sertifikat'];
				$id_pengajuan = $status_pengajuan['id_pengajuan'];
				$status_pengajuan = $status_pengajuan['status_pengajuan'];
				if($status_pengajuan == 0){
				$this->m_ol_pengajuan->simpan_berkas_sertifikat($id_pengajuan,$data['idb'],$id_ijasahe);
				}
				redirect(base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$data['id']));
      }
	}
  }
  function berkas_str($mode='view')
  {
	$data['page']  = "berkas_str";
	$data['header'] = "AMBIL BERKAS SURAT IJIN";
	$data['title'] = "AMBIL BERKAS SURAT IJIN";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
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
		$data['id']  = $this->uri->segment(4, 0);
		$data['idb']  = $this->uri->segment(5, 0);
		$data['link_kembali'] = base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$data['id']);
		$pengajuan = $this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$data['id']);
		$data['id_pengajuan'] = $pengajuan["id_pengajuan"];
    if($mode=='view'){
		$this->tampil($data);
	}
  else if($mode=='data'){
		echo json_encode($this->m_ol_pengajuan->berkas_str_all());
	}
  else{
      if($mode=='simpan'){
				$status_pengajuan=$this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$data['id']);
				$id_ijasahe = $status_pengajuan['id_str'];
				$id_pengajuan = $status_pengajuan['id_pengajuan'];
				$status_pengajuan = $status_pengajuan['status_pengajuan'];
				if($status_pengajuan == 0){
				$this->m_ol_pengajuan->simpan_berkas_str($id_pengajuan,$data['idb'],$id_ijasahe);
				}
				redirect(base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$data['id']));
			}
  	}
	}
  function berkaslain_berkas($mode='view')
  {
	$data['page']  = "berkaslain_berkas";
	$data['header'] = "AMBIL BERKAS UMUM";
	$data['title'] = "AMBIL BERKAS UMUM";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
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
		$data['id']  = $this->uri->segment(4, 0);
		$data['idb']  = $this->uri->segment(5, 0);
		$data['link_kembali'] = base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$data['id']);
		$pengajuan = $this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$data['id']);
		$data['id_pengajuan'] = $pengajuan["id_pengajuan"];
    if($mode=='view'){
		$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_ol_pengajuan->berkas_pribadi_all());
	}
  else{
      if($mode=='simpan'){
				$status_pengajuan=$this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$data['id']);
				$id_ijasahe = $status_pengajuan['id_berkas'];
				$id_pengajuan = $status_pengajuan['id_pengajuan'];
				$status_pengajuan = $status_pengajuan['status_pengajuan'];
				if($status_pengajuan == 0){
				$this->m_ol_pengajuan->simpan_berkaslain_berkas($id_pengajuan,$data['idb'],$id_ijasahe);
				}
				redirect(base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$data['id']));
      }
	}
  }
  function berkas_etik($mode='view')
  {
	$data['page']  = "berkas_etik";
	$data['header'] = "AMBIL BERKAS ETIK PEGAWAI";
	$data['title'] = "AMBIL BERKAS ETIK PEGAWAI";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
//		$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
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
		$data['id']  = $this->uri->segment(4, 0);
		$data['idb']  = $this->uri->segment(5, 0);
		$data['link_kembali'] = base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$data['id']);
		$pengajuan = $this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$data['id']);
		$data['id_pengajuan'] = $pengajuan["id_pengajuan"];
    if($mode=='view'){
		$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_ol_pengajuan->etik_pegawai_all());
	}
  else{
      if($mode=='simpan'){
				$status_pengajuan=$this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$data['id']);
				$id_ijasahe = $status_pengajuan['id_etik_pegawai'];
				$id_pengajuan = $status_pengajuan['id_pengajuan'];
				$status_pengajuan = $status_pengajuan['status_pengajuan'];
				if($status_pengajuan == 0){
				$this->m_ol_pengajuan->simpan_berkas_etik($id_pengajuan,$data['idb'],$id_ijasahe);
				}
				redirect(base_url('ol_pengajuan/pengajuan_kompetensi/isi/'.$data['id']));
      }
	}
  }
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("ol_pengajuan/header",$data);
	$this->load->view("ol_pengajuan/isi");
	$this->load->view("footer");
	$this->load->view("ol_pengajuan/jsload");
	$this->load->view("ol_pengajuan/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_topol",$data);
	$this->load->view("ol_pengajuan/isi");
	$this->load->view("footer");
	$this->load->view("ol_pengajuan/jsload");
	$this->load->view("ol_pengajuan/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
