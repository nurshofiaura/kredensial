<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class S_kompetensi extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
          $this->load->model('m_sample');
  }
	function index(){
		$data['page']="home";
		$data['header'] = "BERANDA";
		$data['title'] = "BERANDA";
		$data['link_kembali'] = base_url('kompetensi');
		$data['link_awal'] = base_url('');
		$data['nama'] = "NAMA NAKES";
		$data['level'] = "Perawat Madya";
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','5');
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
		//======================= IMPORTANT =========================================
		$this->pengajuan_kompetensi();
	}
	function pengajuan_kompetensi($mode='view'){
		$data['page']="pengajuan_kompetensi"; 
		$data['header'] = "DATA PENGAJUAN KOMPETENSI";
		$data['title'] = "DATA PENGAJUAN KOMPETENSI";
		$data['link_kembali'] = base_url('kompetensi');
		$data['link_awal'] = base_url('');
		$data['nama'] = "NAMA NAKES";
		$data['level'] = "Perawat Madya";
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','5');
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
		//======================= IMPORTANT =========================================
		$data['id']   = $this->uri->segment(4, 0);
		$data['id2']   = $this->uri->segment(5, 0);
		$data['id3']   = $this->uri->segment(6, 0);
		$data['isi']   = $this->uri->segment(7, 0);
		$data['tolak']   = $this->uri->segment(8, 0);
		$data['ik']   = $this->uri->segment(9, 0);
		$data['il']   = $this->uri->segment(10, 0);
		$data['ip']   = $this->uri->segment(11, 0);
		if(empty($data['id'])){
			$data['id'] = "";
		}
		if(empty($data['id2'])){
			$data['id2'] = "";
		}
		if($mode=='view'){
			$this->tampil_top($data);
		}
		else if($mode=='data'){
			echo json_encode($this->m_sample->kpengajuan_kompetensi_all());
		}
		else if($mode=='validator'){
			echo json_encode($this->m_sample->seting_validator_kompetensi($data['id']));
		}
		else if($mode=='log_null'){
			echo json_encode($this->m_sample->logbook_null($data['id'],$data['id2']));
		}
		else if($mode=='pskompetensi'){
			echo json_encode($this->m_sample->pegawai_struktur_kompetensi($data['id'],$data['id2']));
		}
    else if($mode=='pemulihan'){
		echo json_encode($this->m_sample->tabel_pemulihan($data['id']));
	}
		else{
			if($mode=='seting'){
				$data['page'] =  $data['page']."_seting";
					if(empty($data['id'])){
						redirect(base_url('s_kompetensi/pengajuan_kompetensi'));	
					}else{
						$this->tampil_top($data);	
					}										
			}
      if($mode=='isi_validator'){
        $data['page'] =  $data['page']."_isi_validator";
				$data['ambil_data_working'] = $this->m_sample->ambil_data_instansi_all(); 
				$pengval = $this->m_umum->ambil_data('s_pengajuan_validasi','barcode_pengajuan_validasi',$data['id']);
				$peng = $this->m_umum->ambil_data('s_pengajuan','id_pengajuan',$pengval['id_pengajuan']);
				$data['barcode_pengajuan']  = $peng['barcode_pengajuan'];
				$this->tampil_top($data);
				$action = $this->input->post('action');
				if($action == 'BtnProses') {
					$barcode_pengajuan_validasi = $this->input->post("barcode_pengajuan_validasi");
					$barcode_working = $this->input->post("barcode_working");
					redirect(base_url('s_kompetensi/pengajuan_kompetensi/isi_validator/'.$barcode_pengajuan_validasi.'/'.$barcode_working));
				}
      }
	    if($mode=='pelatihan_validator'){
	      $data['page'] =  $data['page']."_pelatihan_validator";
	      $data['ambil_struktur_lihat_pelatihan']  = $this->m_sample->ambil_struktur_lihat_pelatihan($data['id']);
	      $pengval = $this->m_umum->ambil_data('s_pengajuan_validasi','barcode_pengajuan_validasi',$data['id']);
	      $peng = $this->m_umum->ambil_data('s_pengajuan','id_pengajuan',$pengval['id_pengajuan']);
	      $data['barcode_pengajuan']  = $peng['barcode_pengajuan'];
	      $this->load->view("s_kompetensi/isi",$data);
	    }
      if($mode=='simpan_validator'){
				  //  $this->session->set_flashdata('danger', 'Hanya Admin Yang Bisa Merubah');
				  redirect(base_url('s_kompetensi/pengajuan_kompetensi'));									
      }
      if($mode=='validasi'){
        $data['page'] =  $data['page']."_validasi";
if(empty($data['id']) || empty($data['id2']) || empty($data['id3'])){
	//	$this->session->set_flashdata('danger', 'Data Tidak Valid');
		redirect(base_url('s_kompetensi/pengajuan_kompetensi'));
}else{
	  	$cek_status = $this->m_umum->ambil_data('s_pengajuan','barcode_pengajuan',$data['id']);
	  	if($cek_status['status_pengajuan'] == 1){
				$data['ambil_berkas_data']=$this->m_sample->ambil_id_berkas_data_idp($cek_status['id_pegawai']);
				$pengajuane=$this->m_sample->ambil_pengajuan_validasi($data['id2']);
				$data['foto']  = set_value('foto_pengaju',$pengajuane["foto"]);
				$data['nama_pegawai']  = set_value('nama_pegawai',$pengajuane["nama_pegawai"]);
				$data['id_pegawai']  = set_value('id_pegawai',$pengajuane["id_pegawai"]);
				$data['id_instansi']  = set_value('id_instansi',$pengajuane["id_instansi"]);
				$data['jk']  = set_value('jk',$pengajuane["jk"]);
				$data['tgl_lahir']  = set_value('tgl_lahir', date('d-m-Y',strtotime($pengajuane["tgl_lahir"])));
				$data['tmp_lahir']  = set_value('tmp_lahir',$pengajuane["tmp_lahir"]);
				$data['umur']  = set_value('umur',$pengajuane["umur"]);
				$data['nama_status_kawin']  = set_value('nama_status_kawin',$pengajuane["nama_status_kawin"]);
				$data['nama_agama']  = set_value('nama_agama',$pengajuane["nama_agama"]);
				$data['nama_jabatan_fungsional']  = set_value('nama_jabatan_fungsional',$pengajuane["nama_jabatan_fungsional"]);
				$data['nama_status_pegawai']  = set_value('nama_status_pegawai',$pengajuane["nama_status_pegawai"]);
				$data['nip']  = set_value('nip',$pengajuane["nip"]);
				$data['nama_pendidikan']  = set_value('nama_pendidikan',$pengajuane["nama_pendidikan"]);
				$data['no_profesi']  = set_value('no_profesi',$pengajuane["no_profesi"]);
				$data['no_hp']  = set_value('no_hp',$pengajuane["no_hp"]);
				$data['email']  = set_value('email',$pengajuane["email"]);
				$data['alamat']  = set_value('alamat',$pengajuane["alamat"]);
				$data['nama_status_diusulkan']  = set_value('nama_status_diusulkan',$pengajuane["nama_status_diusulkan"]);
				$data['id_berkas']  = explode(",", $pengajuane["id_berkas"]);
				$data['berkas']  = $pengajuane["id_berkas"];
				$data['id_ijasah']  = explode(",", $pengajuane["id_ijasah"]);
				$data['ijasah']  = $pengajuane["id_ijasah"];
				$data['id_str']  = explode(",", $pengajuane["id_str"]);
				$data['str']  = $pengajuane["id_str"];
				$data['id_sertifikat']  = explode(",", $pengajuane["id_sertifikat"]);
				$data['sertifikat']  = $pengajuane["id_sertifikat"];
				$data['kesesuaian_bukti']  = explode(",", $pengajuane["kesesuaian_bukti_validasi"]);
				$data['id_etik_pegawai']  = explode(",", $pengajuane["id_etik_pegawai"]);
				$data['ambil_data_etik_pegawai_oppe'] = $this->m_sample->ambil_data_etik_pegawai_oppe_idp($pengajuane["id_pegawai"],date('Y'));
				$data['ambil_lobook_kompetensi_group_pengajuan']=$this->m_sample->ambil_lobook_kompetensi_group_pengajuan($pengajuane["id_pengajuan"]);
				$data['ambil_lobook_validasi_group_pengajuan']=$this->m_sample->ambil_lobook_validasi_group_pengajuan($pengajuane["id_pengajuan"]);
				$this->tampil_top($data);
				$action = $this->input->post('action');
				if($action == 'BtnSimpan') {
				//	$this->m_ol_validasi->pengajuan_berkas_Simpan($data['id']);
				//	$this->m_ol_validasi->pengajuan_validasi_berkas_Simpan($data['id2']);
					redirect(base_url('s_kompetensi/pengajuan_kompetensi/validasi/'.$data['id'].'/'.$data['id2'].'/'.$data['id3']));
				}  		
	  	}else{
 	  	//	$this->session->set_flashdata('danger', 'Status Bukan Proses, Silahkan Masuk Menu Lihat Data');
	  		redirect(base_url('s_kompetensi/pengajuan_kompetensi/seting/'.$data['id'])); 		
	  	}		
}
	  	} // end validatosi
      if($mode=='tambah_validasi'){
/*if(empty($data['isi']) || empty($data['tolak']) || empty($data['ik']) || empty($data['il']) || empty($data['ip'])){
		$this->session->set_flashdata('danger', 'Data Tidak Valid');
redirect(base_url('kompetensi/pengajuan_kompetensi/validasi/'.$data['id'].'/'.$data['id2'].'/'.$data['id3']));
}else{*/
		$d2	=$this->m_sample->ambil_logbook_pegawai($data['il']);
//		if($d2['id_logbook'] == $this->session->id_pegawai){
//			$this->session->set_flashdata('danger', 'Tidak Bisa Memvalidasi Diri Sendiri');
//redirect(base_url('kompetensi/pengajuan_kompetensi/validasi/'.$data['id'].'/'.$data['id2'].'/'.$data['id3']));
//		}else{
					$pengajuan = $this->m_umum->ambil_data('s_pengajuan','barcode_pengajuan',$data['id']);
					$struktur = $this->m_umum->ambil_data('s_pegawai_struktur','barcode_pegawai_struktur',$data['id3']);
					$kondisi=array('id_pengajuan'=>$pengajuan['id_pengajuan'],'id_kewenangan'=>$data['ik']);
				if($pengajuan['status_pengajuan'] == 1){
					$ole = $this->m_umum->ambil_data_kondisi_result('s_logbook',$kondisi);
					$arr = array();
					foreach($ole as $val){
							$arr[] = $val['id_logbook'];
					}
					$eimplo = implode(",", $arr);
			//		$this->m_ol_validasi->simpan_logbook_validasi($data['isi'],$data['tolak'],$struktur['id_pegawai_struktur'],$eimplo);
				//	$this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
					redirect(base_url('s_kompetensi/pengajuan_kompetensi/validasi/'.$data['id'].'/'.$data['id2'].'/'.$data['id3']));
				}else{
				//		$this->session->set_flashdata('danger', 'Status pengajuan Sudah Bukan Proses');
						redirect(base_url('s_kompetensi/pengajuan_kompetensi/validasi/'.$data['id'].'/'.$data['id2'].'/'.$data['id3']));						
				}
//		}
//}
      } // end tambah validasi
      if($mode=='rubah_validasi'){
      	$pengajuan = $this->m_umum->ambil_data('s_pengajuan','barcode_pengajuan',$data['id']);
      	$pengval = $this->m_umum->ambil_data('s_pengajuan_validasi','barcode_pengajuan_validasi',$data['id2']);
      	$struktur = $this->m_umum->ambil_data('s_pegawai_struktur','barcode_pegawai_struktur',$data['id3']);
					$kondisi=array('id_pengajuan'=>$pengajuan['id_pengajuan'],'id_kewenangan'=>$data['ik']);
					$ole = $this->m_umum->ambil_data_kondisi_result('s_logbook',$kondisi);
					$arr = array();
					foreach($ole as $val){
							$arr[] = $val['id_logbook'];
					}
					$eimplo = implode(",", $arr);
					if($pengajuan['status_pengajuan'] == 1){
						if($data['il'] == $struktur['id_pegawai_struktur']){
				//				$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
								redirect(base_url('s_kompetensi/pengajuan_kompetensi/validasi/'.$data['id'].'/'.$data['id2'].'/'.$data['id3']));
						}else{
				//				$this->session->set_flashdata('danger', 'Beda Validator');
								redirect(base_url('s_kompetensi/pengajuan_kompetensi/validasi/'.$data['id'].'/'.$data['id2'].'/'.$data['id3']));							
						}
					}else{
				//			$this->session->set_flashdata('danger', 'Status pengajuan Sudah Bukan Proses');
							redirect(base_url('s_kompetensi/pengajuan_kompetensi/validasi/'.$data['id'].'/'.$data['id2'].'/'.$data['id3']));						
					}
      }
      if($mode=='rubah_pengajuan'){
      	$pengajuan = $this->m_umum->ambil_data('s_pengajuan','barcode_pengajuan',$data['id']);
				if($pengajuan['status_pengajuan'] == 1){
						redirect(base_url('s_kompetensi/pengajuan_kompetensi'));
				}else{
				//		$this->session->set_flashdata('danger', 'Status pengajuan Sudah Bukan Proses');
						redirect(base_url('s_kompetensi/pengajuan_kompetensi/validasi/'.$data['id'].'/'.$data['id2'].'/'.$data['id3']));						
				}
      }
      if($mode=='kirim'){
      	$pengajuan = $this->m_umum->ambil_data('s_pengajuan','barcode_pengajuan',$data['id2']);
				if($pengajuan['status_pengajuan'] == 1){
					$kondisi=array('id_pengajuan'=>$pengajuan['id_pengajuan'],'validasi'=> 0);
					$valedasi = $this->m_umum->ambil_data_kondisi('s_pengajuan_validasi',$kondisi);
					if($valedasi == 0){					
							redirect(base_url('s_kompetensi/pengajuan_kompetensi'));
					}else{
				//		$this->session->set_flashdata('danger', 'Masih Ada Yang Belum Validasi');
						redirect(base_url('s_kompetensi/pengajuan_kompetensi'));	
					}
				}else{
			//			$this->session->set_flashdata('danger', 'Status pengajuan Sudah Bukan Proses');
						redirect(base_url('s_kompetensi/pengajuan_kompetensi'));						
				}
      }
      if($mode=='kembali'){
      	$pengajuan = $this->m_umum->ambil_data('s_pengajuan','barcode_pengajuan',$data['id']);
				if($pengajuan['status_pengajuan'] == 1){				
							redirect(base_url('s_kompetensi/pengajuan_kompetensi'));
				}else{
			//			$this->session->set_flashdata('danger', 'Status pengajuan Sudah Bukan Proses');
						redirect(base_url('s_kompetensi/pengajuan_kompetensi'));						
				}
      }
      if($mode=='lihat'){
        $data['page'] =  $data['page']."_lihat";
if(empty($data['id']) || empty($data['id2']) || empty($data['id3'])){
		$this->session->set_flashdata('danger', 'Data Tidak Valid');
		redirect(base_url('s_kompetensi/pengajuan_kompetensi'));
}else{
	$data['link_kembali'] = base_url('s_kompetensi/pengajuan_kompetensi/seting/'.$data['id']);
	$cek_status = $this->m_umum->ambil_data('s_pengajuan','barcode_pengajuan',$data['id']);
  $struktur = $this->m_umum->ambil_data('s_pegawai_struktur','barcode_pegawai_struktur',$data['id3']);
  $pangvalid = $this->m_umum->ambil_data('s_pengajuan_validasi','barcode_pengajuan_validasi',$data['id2']);
				$data['ambil_berkas_data']=$this->m_sample->ambil_id_berkas_data_idp($cek_status['id_pegawai']);
				$pengajuane=$this->m_sample->ambil_pengajuan_validasi($data['id2']);
				$data['foto']  = set_value('foto_pengaju',$pengajuane["foto"]);
				$data['nama_pegawai']  = set_value('nama_pegawai',$pengajuane["nama_pegawai"]);
				$data['id_pegawai']  = set_value('id_pegawai',$pengajuane["id_pegawai"]);
				$data['id_instansi']  = set_value('id_instansi',$pengajuane["id_instansi"]);
				$data['jk']  = set_value('jk',$pengajuane["jk"]);
				$data['tgl_lahir']  = set_value('tgl_lahir', date('d-m-Y',strtotime($pengajuane["tgl_lahir"])));
				$data['tmp_lahir']  = set_value('tmp_lahir',$pengajuane["tmp_lahir"]);
				$data['umur']  = set_value('umur',$pengajuane["umur"]);
				$data['nama_status_kawin']  = set_value('nama_status_kawin',$pengajuane["nama_status_kawin"]);
				$data['nama_agama']  = set_value('nama_agama',$pengajuane["nama_agama"]);
				$data['nama_jabatan_fungsional']  = set_value('nama_jabatan_fungsional',$pengajuane["nama_jabatan_fungsional"]);
				$data['nama_status_pegawai']  = set_value('nama_status_pegawai',$pengajuane["nama_status_pegawai"]);
				$data['nip']  = set_value('nip',$pengajuane["nip"]);
				$data['nama_pendidikan']  = set_value('nama_pendidikan',$pengajuane["nama_pendidikan"]);
				$data['no_profesi']  = set_value('no_profesi',$pengajuane["no_profesi"]);
				$data['no_hp']  = set_value('no_hp',$pengajuane["no_hp"]);
				$data['email']  = set_value('email',$pengajuane["email"]);
				$data['alamat']  = set_value('alamat',$pengajuane["alamat"]);
				$data['nama_status_diusulkan']  = set_value('nama_status_diusulkan',$pengajuane["nama_status_diusulkan"]);
				$data['id_berkas']  = explode(",", $pengajuane["id_berkas"]);
				$data['berkas']  = $pengajuane["id_berkas"];
				$data['id_ijasah']  = explode(",", $pengajuane["id_ijasah"]);
				$data['ijasah']  = $pengajuane["id_ijasah"];
				$data['id_str']  = explode(",", $pengajuane["id_str"]);
				$data['str']  = $pengajuane["id_str"];
				$data['id_sertifikat']  = explode(",", $pengajuane["id_sertifikat"]);
				$data['sertifikat']  = $pengajuane["id_sertifikat"];
				$data['kesesuaian_bukti']  = explode(",", $pengajuane["kesesuaian_bukti_validasi"]);
				$data['id_etik_pegawai']  = explode(",", $pengajuane["id_etik_pegawai"]);
				$data['ambil_data_etik_pegawai_oppe'] = $this->m_sample->ambil_data_etik_pegawai_oppe_idp($pengajuane["id_pegawai"],date('Y'));
				$data['ambil_lobook_kompetensi_group_pengajuan']=$this->m_sample->ambil_lobook_kompetensi_group_pengajuan($pengajuane["id_pengajuan"]);
				$data['ambil_lobook_validasi_group_pengajuan']=$this->m_sample->ambil_lobook_validasi_group_pengajuan($pengajuane["id_pengajuan"]);
				$this->tampil_top($data); 				
}
	  	}
		}
	}
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("s_kompetensi/header",$data);
	$this->load->view("s_kompetensi/isi");
	$this->load->view("footer");$this->load->view("s_kompetensi/jsload");
	$this->load->view("s_kompetensi/jscode");	

}
function tampil_top($data)
{
	$this->load->view("header_landing",$data);
	$this->load->view("s_kompetensi/isi");
	$this->load->view("footer");$this->load->view("s_kompetensi/jsload");
	$this->load->view("s_kompetensi/jscode");	

}
// -----------------------------------------------------------END-----------------------------------------
}
