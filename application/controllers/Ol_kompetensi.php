<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Ol_kompetensi extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
          $this->load->model('m_ol_rancak');
          $this->load->model('m_ol_validasi');
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
  function login_kah()
  {
      if ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==99 )
          return TRUE;
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==98 )
          return TRUE;
      elseif ( $this->session->has_userdata('has_struktur') && $this->session->userdata('has_struktur')==1 )
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
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$data['forpengurus_pengcab'] = $this->m_ol_rancak->ambil_data_dropdown_pengurus_pengcab($this->session->id_pegawai);
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
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
		$propinsie = $this->m_umum->ambil_data('ol_pengcab','id_pengcab',$pegawai['id_pengcab']);
		$data['prov_id'] = $propinsie["id_prov"];
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
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
	      $id   = $this->input->post("id");
	      $trim_keyword   = urldecode(trim($this->input->post("id")));
				$replace_keyword   = preg_replace('/\s+/', ' ', $trim_keyword);
				$key = str_replace(' ', '-', $replace_keyword);
				redirect(base_url('ol_kompetensi/pengajuan_kompetensi/view/'.$key));
			}
		}
		else if($mode=='data'){
			echo json_encode($this->m_ol_validasi->pengajuan_kompetensi_all($this->session->list_instansi,$data['id']));
		}
		else if($mode=='validator'){
			echo json_encode($this->m_ol_validasi->seting_validator_kompetensi($data['id']));
		}
		else if($mode=='log_null'){
			echo json_encode($this->m_ol_validasi->logbook_null($data['id'],$data['id2']));
		}
		else if($mode=='pskompetensi'){
			echo json_encode($this->m_ol_validasi->pegawai_struktur_kompetensi($data['id'],$data['id2']));
		}
    else if($mode=='pemulihan'){
		echo json_encode($this->m_ol_validasi->tabel_pemulihan($data['id']));
	}
		else{
			if($mode=='seting'){
				$data['page'] =  $data['page']."_seting";
					if(empty($data['id'])){
						redirect(base_url('ol_kompetensi/pengajuan_kompetensi'));	
					}else{
						$this->tampil($data);	
					}										
			}
      if($mode=='isi_validator'){
        $data['page'] =  $data['page']."_isi_validator";
				$data['ambil_data_working'] = $this->m_ol_rancak->ambil_data_instansi_all(); 
				$pengval = $this->m_umum->ambil_data('ol_pengajuan_validasi','barcode_pengajuan_validasi',$data['id']);
				$peng = $this->m_umum->ambil_data('ol_pengajuan','id_pengajuan',$pengval['id_pengajuan']);
				$data['barcode_pengajuan']  = $peng['barcode_pengajuan'];
				$this->tampil($data);
				$action = $this->input->post('action');
				if($action == 'BtnProses') {
					$barcode_pengajuan_validasi = $this->input->post("barcode_pengajuan_validasi");
					$barcode_working = $this->input->post("barcode_working");
					redirect(base_url('ol_kompetensi/pengajuan_kompetensi/isi_validator/'.$barcode_pengajuan_validasi.'/'.$barcode_working));
				}
      }
	    if($mode=='pelatihan_validator'){
	      $data['page'] =  $data['page']."_pelatihan_validator";
	      $data['ambil_struktur_lihat_pelatihan']  = $this->m_ol_rancak->ambil_struktur_lihat_pelatihan($data['id']);
	      $pengval = $this->m_umum->ambil_data('ol_pengajuan_validasi','barcode_pengajuan_validasi',$data['id']);
	      $peng = $this->m_umum->ambil_data('ol_pengajuan','id_pengajuan',$pengval['id_pengajuan']);
	      $data['barcode_pengajuan']  = $peng['barcode_pengajuan'];
	      $this->load->view("ol_validasi/isi",$data);
	    }
      if($mode=='simpan_validator'){
		  	$barcode_pengajuan_validasi = $data['id'];
		  	$barcode_pengajuan = $data['id2'];
		  	$id_pegawai_struktur = $data['id3'];
				$kondisi_pengval=array('barcode_pengajuan_validasi'=>$barcode_pengajuan_validasi);
				$jml_pengval = $this->m_umum->jumlah_record_filter('ol_pengajuan_validasi',$kondisi_pengval);
		  	if($jml_pengval == 0){
		  		$this->session->set_flashdata('danger', 'Data Tidak Valid');
		  		redirect(base_url('ol_kompetensi/pengajuan_kompetensi/seting/'.$barcode_pengajuan));
		  	}else{
		  		$peng = $this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$barcode_pengajuan);
		  		$pengval = $this->m_umum->ambil_data('ol_pengajuan_validasi','barcode_pengajuan_validasi',$barcode_pengajuan_validasi);
		  		if($peng['id_pegawai'] == $pengval['id_pegawai']){
						$this->session->set_flashdata('danger', 'Tidak Dapat Memvalidasi Diri Sendiri');
						redirect(base_url('ol_kompetensi/pengajuan_kompetensi'));
		  		}else{
$pengajuan = $this->m_ol_rancak->ambil_pengajuan_kompetensi($barcode_pengajuan);
$kondisiformatpengajuan=array('id_instansi'=>$pengajuan['id_instansi'],'id_status_diusulkan'=>$pengajuan['id_status_diusulkan'],'status_pengajuan_format_rs'=>1,'id_jabatan'=>$pengajuan['id_jabatan']);
$formatpengajuan = $this->m_umum->ambil_data_kondisi('ol_pengajuan_format_rs',$kondisiformatpengajuan);
						if($formatpengajuan['kunci'] == 0){
$pengajuanvalidasi = $this->m_ol_rancak->ambil_pengajuan_validasi_ms_struktur($barcode_pengajuan_validasi);
/*							if($pengajuanvalidasi['kunci'] == 0){*/
$kondisilogvalidasi=array('id_pegawai_struktur'=>$pengajuanvalidasi['id_pegawai_struktur'],'id_pengajuan'=>$pengajuanvalidasi['id_pengajuan']);
$jmllogvalidasi = $this->m_umum->jumlah_record_tabel_pengajuan('ol_logbook_validasi',$kondisilogvalidasi,'ol_logbook','id_logbook');
							if($jmllogvalidasi == 0){

$kondisi=array('barcode_pengajuan'=>$barcode_pengajuan,'id_pengajuan_validasi'=>$pengval['id_pengajuan_validasi'],'status_pengajuan'=>1,'validasi'=>0);
$jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_pengajuan_validasi',$kondisi,'ol_pengajuan','id_pengajuan');
$kondisi2=array('id_pegawai_struktur'=>$id_pegawai_struktur,'id_pengajuan'=>$pengajuanvalidasi['id_pengajuan']);
$valedasi = $this->m_umum->jumlah_record_filter('ol_pengajuan_validasi',$kondisi2);
								if($jml == 0){
						  		$this->session->set_flashdata('danger', 'Cek Validasi, Mungkin Bukan Proses');
						  		redirect(base_url('ol_kompetensi/pengajuan_kompetensi'));							
								}else{
									if($valedasi == 0){
										$this->m_ol_validasi->rubah_plan_pengajuan_validasi($barcode_pengajuan_validasi,$id_pegawai_struktur);
										$this->session->set_flashdata('sukses', 'Data Sudah Di Simpan');
										redirect(base_url('ol_kompetensi/pengajuan_kompetensi/seting/'.$barcode_pengajuan));
									}else{
							  		$this->session->set_flashdata('danger', 'Sudah Tercatat Validasinya');
							  		redirect(base_url('ol_kompetensi/pengajuan_kompetensi/seting/'.$barcode_pengajuan));							
									}
								}
							}else{
								  	$this->session->set_flashdata('danger', 'Sudah di Validasi');
							  		redirect(base_url('ol_kompetensi/pengajuan_kompetensi/seting/'.$barcode_pengajuan));						
							}



/*							}else{
					  		$this->session->set_flashdata('danger', 'Hanya Admin Yang Bisa Merubah');
					  		redirect(base_url('ol_kompetensi/pengajuan_kompetensi'));										
							}*/
						}else{
				  		$this->session->set_flashdata('danger', 'Hanya Admin Yang Bisa Merubah');
				  		redirect(base_url('ol_kompetensi/pengajuan_kompetensi'));									
						}
		  		}
		  	}
      }
      if($mode=='validasi'){
        $data['page'] =  $data['page']."_validasi";
if(empty($data['id']) || empty($data['id2']) || empty($data['id3'])){
		$this->session->set_flashdata('danger', 'Data Tidak Valid');
		redirect(base_url('ol_kompetensi/pengajuan_kompetensi'));
}else{
  $struktur = $this->m_umum->ambil_data('ol_pegawai_struktur','barcode_pegawai_struktur',$data['id3']);
  $pangvalid = $this->m_ol_rancak->ambil_pengajuan_validasi_ms_struktur($data['id2']);
	if($this->session->id_pegawai !== $pangvalid['id_pegawai']){
  	$this->session->set_flashdata('danger', 'Beda Validator');
		redirect(base_url('ol_kompetensi/pengajuan_kompetensi/seting/'.$data['id'])); 
	}else{
	  	$cek_status = $this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$data['id']);
	  	if($cek_status['status_pengajuan'] == 1){
				$data['ambil_berkas_data']=$this->m_ol_rancak->ambil_id_berkas_data($cek_status['id_pegawai']);
				$pengajuane=$this->m_ol_rancak->ambil_pengajuan_validasi($data['id2']);
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
				$data['ambil_data_etik_pegawai_oppe'] = $this->m_ol_rancak->ambil_data_etik_pegawai_oppe($pengajuane["id_pegawai"],date('Y'));
				$data['ambil_lobook_kompetensi_group_pengajuan']=$this->m_ol_rancak->ambil_lobook_kompetensi_group_pengajuan($pengajuane["id_pengajuan"]);
				$data['ambil_lobook_validasi_group_pengajuan']=$this->m_ol_rancak->ambil_lobook_validasi_group_pengajuan($pengajuane["id_pengajuan"]);
				$this->tampil($data);
				$action = $this->input->post('action');
				if($action == 'BtnSimpan') {
					$this->m_ol_validasi->pengajuan_berkas_Simpan($data['id']);
					$this->m_ol_validasi->pengajuan_validasi_berkas_Simpan($data['id2']);
					redirect(base_url('ol_kompetensi/pengajuan_kompetensi/validasi/'.$data['id'].'/'.$data['id2'].'/'.$data['id3']));
				}  		
	  	}else{
 	  		$this->session->set_flashdata('danger', 'Status Bukan Proses, Silahkan Masuk Menu Lihat Data');
	  		redirect(base_url('ol_kompetensi/pengajuan_kompetensi')); 		
	  	}		
	}
}
	  	} // end validatosi
      if($mode=='tambah_validasi'){
/*if(empty($data['isi']) || empty($data['tolak']) || empty($data['ik']) || empty($data['il']) || empty($data['ip'])){
		$this->session->set_flashdata('danger', 'Data Tidak Valid');
redirect(base_url('ol_kompetensi/pengajuan_kompetensi/validasi/'.$data['id'].'/'.$data['id2'].'/'.$data['id3']));
}else{*/
		$d2	=$this->m_ol_rancak->ambil_logbook_pegawai($data['il']);
//		if($d2['id_logbook'] == $this->session->id_pegawai){
//			$this->session->set_flashdata('danger', 'Tidak Bisa Memvalidasi Diri Sendiri');
//redirect(base_url('ol_kompetensi/pengajuan_kompetensi/validasi/'.$data['id'].'/'.$data['id2'].'/'.$data['id3']));
//		}else{
					$pengajuan = $this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$data['id']);
					$struktur = $this->m_umum->ambil_data('ol_pegawai_struktur','barcode_pegawai_struktur',$data['id3']);
					$kondisi=array('id_pengajuan'=>$pengajuan['id_pengajuan'],'id_kewenangan'=>$data['ik']);
				if($pengajuan['status_pengajuan'] == 1){
					$ole = $this->m_umum->ambil_data_kondisi_result('ol_logbook',$kondisi);
					$arr = array();
					foreach($ole as $val){
							$arr[] = $val['id_logbook'];
					}
					$eimplo = implode(",", $arr);
					$this->m_ol_validasi->simpan_logbook_validasi($data['isi'],$data['tolak'],$struktur['id_pegawai_struktur'],$eimplo);
					$this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
					redirect(base_url('ol_kompetensi/pengajuan_kompetensi/validasi/'.$data['id'].'/'.$data['id2'].'/'.$data['id3']));
				}else{
						$this->session->set_flashdata('danger', 'Status pengajuan Sudah Bukan Proses');
						redirect(base_url('ol_kompetensi/pengajuan_kompetensi/validasi/'.$data['id'].'/'.$data['id2'].'/'.$data['id3']));						
				}
//		}
//}
      } // end tambah validasi
      if($mode=='rubah_validasi'){
      	$pengajuan = $this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$data['id']);
      	$pengval = $this->m_umum->ambil_data('ol_pengajuan_validasi','barcode_pengajuan_validasi',$data['id2']);
      	$struktur = $this->m_umum->ambil_data('ol_pegawai_struktur','barcode_pegawai_struktur',$data['id3']);
					$kondisi=array('id_pengajuan'=>$pengajuan['id_pengajuan'],'id_kewenangan'=>$data['ik']);
					$ole = $this->m_umum->ambil_data_kondisi_result('ol_logbook',$kondisi);
					$arr = array();
					foreach($ole as $val){
							$arr[] = $val['id_logbook'];
					}
					$eimplo = implode(",", $arr);
					if($pengajuan['status_pengajuan'] == 1){
						if($data['il'] == $struktur['id_pegawai_struktur']){
						  if($this->m_ol_validasi->rubah_logbook_validasi($data['isi'],$data['tolak'],$struktur['id_pegawai_struktur'],$eimplo)){
						  	$this->session->set_flashdata('sukses', 'Data Berhasil Disimpan');
								redirect(base_url('ol_kompetensi/pengajuan_kompetensi/validasi/'.$data['id'].'/'.$data['id2'].'/'.$data['id3']));
						  }else{
								$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
								redirect(base_url('ol_kompetensi/pengajuan_kompetensi/validasi/'.$data['id'].'/'.$data['id2'].'/'.$data['id3']));
						  }
						}else{
								$this->session->set_flashdata('danger', 'Beda Validator');
								redirect(base_url('ol_kompetensi/pengajuan_kompetensi/validasi/'.$data['id'].'/'.$data['id2'].'/'.$data['id3']));							
						}
					}else{
							$this->session->set_flashdata('danger', 'Status pengajuan Sudah Bukan Proses');
							redirect(base_url('ol_kompetensi/pengajuan_kompetensi/validasi/'.$data['id'].'/'.$data['id2'].'/'.$data['id3']));						
					}
      }
      if($mode=='rubah_pengajuan'){
      	$pengajuan = $this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$data['id']);
				if($pengajuan['status_pengajuan'] == 1){
				  if($this->m_ol_validasi->rubah_pengajuan_validasi($data['id2'],$data['isi'])){
						redirect(base_url('ol_kompetensi/pengajuan_kompetensi'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
						redirect(base_url('ol_kompetensi/pengajuan_kompetensi'));
				  }
				}else{
						$this->session->set_flashdata('danger', 'Status pengajuan Sudah Bukan Proses');
						redirect(base_url('ol_kompetensi/pengajuan_kompetensi/validasi/'.$data['id'].'/'.$data['id2'].'/'.$data['id3']));						
				}
      }
      if($mode=='kirim'){
      	$pengajuan = $this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$data['id2']);
				if($pengajuan['status_pengajuan'] == 1){
					$kondisi=array('id_pengajuan'=>$pengajuan['id_pengajuan'],'validasi'=> 0);
					$valedasi = $this->m_umum->ambil_data_kondisi('ol_pengajuan_validasi',$kondisi);
					if($valedasi == 0){					
					  if($this->m_ol_validasi->rubah_status_pengajuan($data['id'],$data['id2'])){  // isi dan barcode_pengajuan
							redirect(base_url('ol_kompetensi/pengajuan_kompetensi'));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Masalah Status Data. Hubungi Admin');
							redirect(base_url('ol_kompetensi/pengajuan_kompetensi'));
					  }
					}else{
						$this->session->set_flashdata('danger', 'Masih Ada Yang Belum Validasi');
						redirect(base_url('ol_kompetensi/pengajuan_kompetensi'));	
					}
				}else{
						$this->session->set_flashdata('danger', 'Status pengajuan Sudah Bukan Proses');
						redirect(base_url('ol_kompetensi/pengajuan_kompetensi'));						
				}
      }
      if($mode=='kembali'){
      	$pengajuan = $this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$data['id']);
				if($pengajuan['status_pengajuan'] == 1){				
					  if($this->m_ol_validasi->rubah_status_pengajuan('0',$data['id'])){  // isi dan barcode_pengajuan
							redirect(base_url('ol_kompetensi/pengajuan_kompetensi'));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Masalah Status Data. Hubungi Admin');
							redirect(base_url('ol_kompetensi/pengajuan_kompetensi'));
					  }
				}else{
						$this->session->set_flashdata('danger', 'Status pengajuan Sudah Bukan Proses');
						redirect(base_url('ol_kompetensi/pengajuan_kompetensi'));						
				}
      }
      if($mode=='lihat'){
        $data['page'] =  $data['page']."_lihat";
if(empty($data['id']) || empty($data['id2']) || empty($data['id3'])){
		$this->session->set_flashdata('danger', 'Data Tidak Valid');
		redirect(base_url('ol_kompetensi/pengajuan_kompetensi'));
}else{
	$data['link_kembali'] = base_url('ol_kompetensi/pengajuan_kompetensi/seting/'.$data['id']);
	$cek_status = $this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$data['id']);
  $struktur = $this->m_umum->ambil_data('ol_pegawai_struktur','barcode_pegawai_struktur',$data['id3']);
  $pangvalid = $this->m_umum->ambil_data('ol_pengajuan_validasi','barcode_pengajuan_validasi',$data['id2']);
				$data['ambil_berkas_data']=$this->m_ol_rancak->ambil_id_berkas_data($cek_status['id_pegawai']);
				$pengajuane=$this->m_ol_rancak->ambil_pengajuan_validasi($data['id2']);
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
				$data['ambil_data_etik_pegawai_oppe'] = $this->m_ol_rancak->ambil_data_etik_pegawai_oppe($pengajuane["id_pegawai"],date('Y'));
				$data['ambil_lobook_kompetensi_group_pengajuan']=$this->m_ol_rancak->ambil_lobook_kompetensi_group_pengajuan($pengajuane["id_pengajuan"]);
				$data['ambil_lobook_validasi_group_pengajuan']=$this->m_ol_rancak->ambil_lobook_validasi_group_pengajuan($pengajuane["id_pengajuan"]);
				$this->tampil($data); 				
}
	  	}
		}
	}
	function spk($mode='view'){
		$data['page']="spk"; 
		$data['header'] = "UPLOAD DATA DAN SPK";
		$data['title'] = "UPLOAD DATA DAN SPK";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
		$propinsie = $this->m_umum->ambil_data('ol_pengcab','id_pengcab',$pegawai['id_pengcab']);
		$data['prov_id'] = $propinsie["id_prov"];
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
		$data['id']    = $this->uri->segment(4, 0);
		if(empty($data['id'])){
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
				redirect(base_url('ol_kompetensi/spk/view/'.$key));
			}
		}
		else if($mode=='data'){
			echo json_encode($this->m_ol_validasi->pengajuan_kompetensi_spk_all($this->session->list_instansi,$data['id']));
		}
		else{
      if($mode=='upload_kredensial'){
        $data['page'] =  $data['page']."_upload_kredensial";
        $data['title'] = "UPLOAD DATA KREDENSIAL";
				$data['halaman'] = 'upload_kredensial';
				$pg = $this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$data['id']);
				$data['barcode_pengajuan']  = $pg['barcode_pengajuan'];
				$data['status_pengajuan']  = $pg['status_pengajuan'];
				$this->form_validation->set_rules('barcode_pengajuan','barcode_pengajuan','required');
        if ($this->form_validation->run() === FALSE){
					$this->tampil($data);
        }else{
        	$status_pengajuan= $this->input->post('status_pengajuan');
	        if($status_pengajuan == 2){
						$data = array();
						$filesCount = count($_FILES['upload_Files']['name']);
						for($i = 0; $i < $filesCount; $i++){
							$_FILES['upload_File']['name'] = $_FILES['upload_Files']['name'][$i];
							$_FILES['upload_File']['type'] = $_FILES['upload_Files']['type'][$i];
							$_FILES['upload_File']['tmp_name'] = $_FILES['upload_Files']['tmp_name'][$i];
							$_FILES['upload_File']['error'] = $_FILES['upload_Files']['error'][$i];
							$_FILES['upload_File']['size'] = $_FILES['upload_Files']['size'][$i];
							$uploadPath = 'assets/berkas/ol/';
							$config['upload_path'] = $uploadPath;
							$config['allowed_types'] = 'pdf';
							$config['encrypt_name'] = TRUE;
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
		  				if($this->upload->do_upload('upload_File')){
								$id_pengajuan = $this->input->post('id_pengajuan');
								$user_pic=$this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$data['id']);
								$cek_file=FCPATH.'assets/berkas/ol/'.$user_pic['kredensial'];
								if(file_exists($cek_file)){
									unlink(FCPATH."assets/berkas/ol/".$user_pic['kredensial']);
								}
		  					$fileData = $this->upload->data();
		  					$this->session->set_flashdata('sukses', 'Data berhasil Di Upload');
		  					$this->m_ol_validasi->edit_kredensial($fileData['file_name']);
		  					redirect(base_url('ol_kompetensi/spk'));
		  				}else{
				        $this->session->set_flashdata('danger', 'Data Gagal Di Upload');
								redirect(base_url('ol_kompetensi/spk'));
		  				}
						}
					}else{
			      $this->session->set_flashdata('danger', 'SPK Sudah Diterbitkan');
						redirect(base_url('ol_kompetensi/spk'));				
					}
				}
      }
      if($mode=='upload_mutu'){
        $data['page'] =  $data['page']."_upload_mutu";
        $data['title'] = "UPLOAD DATA MUTU";
        $data['halaman'] = 'upload_mutu';
				$pg = $this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$data['id']);
				$data['barcode_pengajuan']  = $pg['barcode_pengajuan'];
				$data['status_pengajuan']  = $pg['status_pengajuan'];
				$this->form_validation->set_rules('barcode_pengajuan','barcode_pengajuan','required');
        if ($this->form_validation->run() === FALSE){
					$this->tampil($data);
        }else{
        	$status_pengajuan= $this->input->post('status_pengajuan');
	        if($status_pengajuan == 2){
						$data = array();
						$filesCount = count($_FILES['upload_Files']['name']);
						for($i = 0; $i < $filesCount; $i++){
							$_FILES['upload_File']['name'] = $_FILES['upload_Files']['name'][$i];
							$_FILES['upload_File']['type'] = $_FILES['upload_Files']['type'][$i];
							$_FILES['upload_File']['tmp_name'] = $_FILES['upload_Files']['tmp_name'][$i];
							$_FILES['upload_File']['error'] = $_FILES['upload_Files']['error'][$i];
							$_FILES['upload_File']['size'] = $_FILES['upload_Files']['size'][$i];
							$uploadPath = 'assets/berkas/ol/';
							$config['upload_path'] = $uploadPath;
							$config['allowed_types'] = 'pdf';
							$config['encrypt_name'] = TRUE;
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
		  				if($this->upload->do_upload('upload_File')){
								$id_pengajuan = $this->input->post('id_pengajuan');
								$user_pic=$this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$data['id']);
								$cek_file=FCPATH.'assets/berkas/ol/'.$user_pic['mutu'];
								if(file_exists($cek_file)){
									unlink(FCPATH."assets/berkas/ol/".$user_pic['mutu']);
								}
		  					$fileData = $this->upload->data();
		  					$this->session->set_flashdata('sukses', 'Data berhasil Di Upload');
		  					$this->m_ol_validasi->edit_mutu($fileData['file_name']);
		  					redirect(base_url('ol_kompetensi/spk'));
		  				}else{
				        $this->session->set_flashdata('danger', 'Data Gagal Di Upload');
								redirect(base_url('ol_kompetensi/spk'));
		  				}
						}
					}else{
			      $this->session->set_flashdata('danger', 'SPK Sudah Diterbitkan');
						redirect(base_url('ol_kompetensi/spk'));							
					}
				}
      }
      if($mode=='upload_etika'){
        $data['page'] =  $data['page']."_upload_etika";
        $data['title'] = "UPLOAD DATA ETIKA";
				$data['halaman'] = 'upload_etika';
				$pg = $this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$data['id']);
				$data['barcode_pengajuan']  = $pg['barcode_pengajuan'];
				$data['status_pengajuan']  = $pg['status_pengajuan'];
				$this->form_validation->set_rules('barcode_pengajuan','barcode_pengajuan','required');
        if ($this->form_validation->run() === FALSE){
					$this->tampil($data);
        }else{
        	$status_pengajuan= $this->input->post('status_pengajuan');
	        if($status_pengajuan == 2){
						$data = array();
						$filesCount = count($_FILES['upload_Files']['name']);
						for($i = 0; $i < $filesCount; $i++){
							$_FILES['upload_File']['name'] = $_FILES['upload_Files']['name'][$i];
							$_FILES['upload_File']['type'] = $_FILES['upload_Files']['type'][$i];
							$_FILES['upload_File']['tmp_name'] = $_FILES['upload_Files']['tmp_name'][$i];
							$_FILES['upload_File']['error'] = $_FILES['upload_Files']['error'][$i];
							$_FILES['upload_File']['size'] = $_FILES['upload_Files']['size'][$i];
							$uploadPath = 'assets/berkas/ol/';
							$config['upload_path'] = $uploadPath;
							$config['allowed_types'] = 'pdf';
							$config['encrypt_name'] = TRUE;
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
		  				if($this->upload->do_upload('upload_File')){
								$id_pengajuan = $this->input->post('id_pengajuan');
								$user_pic=$this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$data['id']);
								$cek_file=FCPATH.'assets/berkas/ol/'.$user_pic['etika'];
								if(file_exists($cek_file)){
									unlink(FCPATH."assets/berkas/ol/".$user_pic['etika']);
								}
		  					$fileData = $this->upload->data();
		  					$this->session->set_flashdata('sukses', 'Data berhasil Di Upload');
		  					$this->m_ol_validasi->edit_etika($fileData['file_name']);
		  					redirect(base_url('ol_kompetensi/spk'));
		  				}else{
				        $this->session->set_flashdata('danger', 'Data Gagal Di Upload');
								redirect(base_url('ol_kompetensi/spk'));
		  				}
						}
					}else{
			      $this->session->set_flashdata('danger', 'SPK Sudah Diterbitkan');
						redirect(base_url('ol_kompetensi/spk'));							
					}
				}
      }
      if($mode=='upload_spk'){
        $data['page'] =  $data['page']."_upload_spk";
        $data['title'] = "UPLOAD DATA SPK";
				$data['halaman'] = 'upload_spk';
				$pg = $this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$data['id']);
				$data['barcode_pengajuan']  = $pg['barcode_pengajuan'];
				$data['status_pengajuan']  = $pg['status_pengajuan'];
				$this->form_validation->set_rules('barcode_pengajuan','barcode_pengajuan','required');
        if ($this->form_validation->run() === FALSE){
					$this->tampil($data);
        }else{
        	$status_pengajuan= $this->input->post('status_pengajuan');
	        if($status_pengajuan == 2){
						$data = array();
						$filesCount = count($_FILES['upload_Files']['name']);
						for($i = 0; $i < $filesCount; $i++){
							$_FILES['upload_File']['name'] = $_FILES['upload_Files']['name'][$i];
							$_FILES['upload_File']['type'] = $_FILES['upload_Files']['type'][$i];
							$_FILES['upload_File']['tmp_name'] = $_FILES['upload_Files']['tmp_name'][$i];
							$_FILES['upload_File']['error'] = $_FILES['upload_Files']['error'][$i];
							$_FILES['upload_File']['size'] = $_FILES['upload_Files']['size'][$i];
							$uploadPath = 'assets/berkas/ol/';
							$config['upload_path'] = $uploadPath;
							$config['allowed_types'] = 'pdf';
							$config['encrypt_name'] = TRUE;
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
		  				if($this->upload->do_upload('upload_File')){
								$id_pengajuan = $this->input->post('id_pengajuan');
								$user_pic=$this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$data['id']);
								$cek_file=FCPATH.'assets/berkas/ol/'.$user_pic['spk'];
								if(file_exists($cek_file)){
									unlink(FCPATH."assets/berkas/ol/".$user_pic['spk']);
								}
		  					$fileData = $this->upload->data();
		  					$this->session->set_flashdata('sukses', 'Data berhasil Di Upload');
		  					$this->m_ol_validasi->edit_spk($fileData['file_name']);
		  					redirect(base_url('ol_kompetensi/spk'));
		  				}else{
				        $this->session->set_flashdata('danger', 'Data Gagal Di Upload');
								redirect(base_url('ol_kompetensi/spk'));
		  				}
						}
					}else{
			      $this->session->set_flashdata('danger', 'Data Upload Belum Lengkap');
						redirect(base_url('ol_kompetensi/spk'));						
					}
				}
      }
      if($mode=='kelengkapan'){
        $data['page'] =  $data['page']."_kelengkapan";
				$data['cmd_ambil_direktur'] = $this->m_ol_rancak->cmd_ambil_direktur($this->session->list_instansi);
				$kondisi_pengajuan=array('barcode_pengajuan'=>$data['id']);
				$pengajuan = $this->m_umum->ambil_data_kondisi('ol_pengajuan',$kondisi_pengajuan);
				$kondisi_lampiran=array('id_pengajuan'=>$pengajuan['id_pengajuan']);
				$jml_lampiran = $this->m_umum->jumlah_record_filter('ol_pengajuan_report',$kondisi_lampiran);
				$data['id_pengajuan'] = $pengajuan['id_pengajuan'];
				$data['id_status_diusulkan'] = $pengajuan['id_status_diusulkan'];
				if($jml_lampiran == 0){
					$data['lampiran']  = set_value('lampiran',$this->input->post("lampiran"));
					$data['nomor']  = set_value('nomor',$this->input->post("nomor"));
					$data['tgl_nomor']  = set_value('tgl_nomor',date('d-m-Y'));
					$data['tentang']  = set_value('tentang',$this->input->post("tentang"));
					$data['kategori_kewenangan']  = set_value('kategori_kewenangan',$this->input->post("kategori_kewenangan"));
					$data['kewenangan_klinis']  = set_value('kewenangan_klinis',$this->input->post("kewenangan_klinis"));
					$data['ditetapkan']  = set_value('ditetapkan',$this->input->post("ditetapkan"));
					$data['id_direktur']  = set_value('id_direktur',$this->input->post("id_direktur"));
					$data['pangkat']  = set_value('pangkat',$this->input->post("pangkat"));
					$data['tgl_ditetapkan']  = set_value('tgl_ditetapkan',date('d-m-Y'));
				}else{
					$kr_pengajuan_report = $this->m_umum->ambil_data('ol_pengajuan_report','id_pengajuan',$pengajuan['id_pengajuan']);
					$data['lampiran'] = $kr_pengajuan_report['lampiran'];
					$data['nomor'] = $kr_pengajuan_report['nomor'];
					$data['tentang'] = $kr_pengajuan_report['tentang'];
					$data['kategori_kewenangan'] = $kr_pengajuan_report['kategori_kewenangan'];
					$data['kewenangan_klinis'] = $kr_pengajuan_report['kewenangan_klinis'];
					$data['ditetapkan'] = $kr_pengajuan_report['ditetapkan'];
					$data['id_direktur'] = $kr_pengajuan_report['id_direktur'];
					$data['pangkat'] = $kr_pengajuan_report['pangkat'];
					$data['tgl_nomor'] = date('d-m-Y', strtotime($kr_pengajuan_report['tgl_nomor']));
					$data['tgl_ditetapkan'] = date('d-m-Y', strtotime($kr_pengajuan_report['tgl_ditetapkan']));
				}
				$this->form_validation->set_rules('id_pengajuan','id_pengajuan','required');
        if ($this->form_validation->run() === FALSE){
					$this->tampil($data);
        }else{
					$id_pengajuan= $this->input->post('id_pengajuan');
					$id_status_diusulkan= $this->input->post('id_status_diusulkan');
					$kondisi_lampir=array('id_pengajuan'=>$id_pengajuan);
					$jml_lampir = $this->m_umum->jumlah_record_filter('ol_pengajuan_report',$kondisi_lampir);
					$lihat_kw = $this->m_umum->ambil_data_kondisi('ol_pengajuan',$kondisi_lampir);
					if(empty($lihat_kw['kredensial']) || empty($lihat_kw['mutu']) || empty($lihat_kw['etika']) || empty($lihat_kw['spk'])){
			      $this->session->set_flashdata('danger', 'Data Upload Belum Lengkap');
						redirect(base_url('ol_kompetensi/spk'));	
					}else{
						if($jml_lampiran == 0){
							$this->m_ol_validasi->simpan_kr_pengajuan_report();
						}else{
							$this->m_ol_validasi->edit_kr_pengajuan_report();
						}
						if(empty($lihat_kw['kw_terima'])){
							$ambil_kw_terima = $this->m_ol_rancak->ambil_kw_terima($lihat_kw['id_pegawai'],$id_pengajuan);
							$kw_terima = array();
							foreach($ambil_kw_terima as $valambil_kw_terima){
									$kw_terima[] = $valambil_kw_terima['id_kewenangan'];
							}
							$eimplokw_terima = implode(",", $kw_terima);
							$this->m_ol_validasi->simpan_kw_terima($id_pengajuan,$eimplokw_terima);
							$this->m_ol_validasi->simpan_lulus($lihat_kw['id_pegawai'],$eimplokw_terima);
							if($id_status_diusulkan == 4){
								$this->m_ol_validasi->simpan_rubah_tolak($lihat_kw['id_pegawai'],$eimplokw_terima);
							}
							$this->m_ol_validasi->simpan_kewenangan_lulus($lihat_kw['id_pegawai'],$eimplokw_terima);
							$this->m_ol_validasi->rubah_status($id_pengajuan);
						}
						if(empty($lihat_kw['kw_tolak'])){
							$ambil_kw_tolak = $this->m_ol_rancak->ambil_kw_tolak($lihat_kw['id_pegawai'],$id_pengajuan);
							$kw_tolak = array();
							foreach($ambil_kw_tolak as $valambil_kw_tolak){
									$kw_tolak[] = $valambil_kw_tolak['id_kewenangan'];
							}
							$eimplokw_tolak = implode(",", $kw_tolak);
							$this->m_ol_validasi->simpan_kw_tolak($id_pengajuan,$eimplokw_tolak);
						}
						if(empty($lihat_kw['kw_all'])){
							$ambil_kw_all = $this->m_ol_rancak->ambil_kw_all($lihat_kw['id_pegawai']);
							$kw_all = array();
							foreach($ambil_kw_all as $valambil_kw_all){
									$kw_all[] = $valambil_kw_all['id_kewenangan'];
							}
							$eimplokw_all = implode(",", $kw_all);
							$this->m_ol_validasi->simpan_kw_all($id_pengajuan,$eimplokw_all);
						}
						$this->session->set_flashdata('sukses', 'Data Sudah Dilengkapi Silahkan Print Penugasan Klinis');
						redirect(base_url('ol_kompetensi/spk'));
					}
        }
      }
		if($mode=='pdf'){
		  $report = $this->load->view('cetak/ol_penugasan_klinis', $data, TRUE);
		  $apk	=$this->m_ol_rancak->ambil_pengajuan_kompetensi_spk($data['id']);
		  $filename = "Penugasan_klinis-".$apk['nama_pegawai']."-".date('d-m-Y').".pdf";
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
		  $mpdf->AddPage('P', '', '', '', 2, 25, 5, 5, 10, 3, 3);
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
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("ol_validasi/header",$data);
	$this->load->view("ol_validasi/isi");
	$this->load->view("footer");
	$this->load->view("ol_validasi/jsload");
	$this->load->view("ol_validasi/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_top",$data);
	$this->load->view("ol_validasi/isi");
	$this->load->view("footer");
	$this->load->view("ol_validasi/jsload");
	$this->load->view("ol_validasi/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
