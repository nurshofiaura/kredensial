<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Ol_master extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
          $this->load->model('m_ol_rancak');
          $this->load->model('m_ol_master');
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
  function cek_level()
  {
  	$cek_level=$this->m_ol_rancak->cek_online_level();
      if ( $cek_level['id_level'] ==96 )
          return TRUE;
      else
        //  redirect(base_url('logout'));
         // redirect(base_url('member'));
      $this->cek_online_kah();
  }
  function login_kah()
  {
      if ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==99 )
          return TRUE;
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==98 )
          return TRUE;
      else
        //  redirect(base_url('logout'));
         // redirect(base_url('member'));
      $this->cek_level();
  }
	function index(){
		$this->kategori_kewenangan();
	}
  function kategori_kewenangan($mode='view')
  {
		$data['page']  = "kategori_kewenangan";
		$data['header'] = "KATEGORI KEWENANGAN";
		$data['title'] = "KATEGORI KEWENANGAN";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
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
		$data['id'] = $this->uri->segment(4, 0);
		$data['pat'] = $this->uri->segment(3, 0);
		if($data['pat'] == NULL OR empty($data['pat'])){
			$data['id'] = 1;
		}
		$data['cmd_ruangan'] = $this->m_ol_rancak->cmd_ruangan();
    if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$id = $this->input->post("id_ruangan");
				redirect(base_url('ol_master/kategori_kewenangan/view/'.$id));
			}
		}
    else if($mode=='data'){
			echo json_encode($this->m_ol_master->kewenangan_all($data['id']));
		}
    else if($mode=='hapus'){
				$kondisi_mine=array('creator_kewenangan'=>$this->session->id_pegawai,'id_kewenangan'=>$data['id']);
				$jml_mine = $this->m_umum->jumlah_record_filter('ol_kewenangan',$kondisi_mine);				
				$kondisi_nol=array('creator_kewenangan'=>0,'id_kewenangan'=>$data['id']);
				$jml_nol = $this->m_umum->jumlah_record_filter('ol_kewenangan',$kondisi_nol);
				$kondisi=array('id_kewenangan'=>$data['id']);
				$jml = $this->m_umum->jumlah_record_filter('ol_kewenangan_detil',$kondisi);
				if($jml_nol == 0){
					if($jml_mine == 0){
							$this->session->set_flashdata('danger', 'Maaf Bukan Data Anda');
							redirect(base_url('ol_master/kategori_kewenangan'));
					}else{
						if($jml == 0){
						  if($this->m_umum->hapus_data('ol_kewenangan','id_kewenangan',$data['id'])){
								$this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
								redirect(base_url('ol_master/kategori_kewenangan'));
						  }else{
								$this->session->set_flashdata('danger', 'Masalah Hapus Data');
								redirect(base_url('ol_master/kategori_kewenangan'));
						  }
						}else{
							$this->session->set_flashdata('danger', 'Data Sudah Masuk Alur');
							redirect(base_url('ol_master/kategori_kewenangan'));
						}
					}
				}else{
							$this->session->set_flashdata('danger', 'Data Administrator');
							redirect(base_url('ol_master/kategori_kewenangan'));
				}
    }
  	else{
			$data['cmd_kompetensi'] = $this->m_ol_rancak->cmd_kompetensi();
			$data['cmd_kode_kewenangan_null'] = $this->m_ol_rancak->cmd_kode_kewenangan_null();
			$data['cmd_sifat_kewenangan_null'] = $this->m_ol_rancak->cmd_sifat_kewenangan_null();
			$data['ambil_data_rujukan_working_null'] = $this->m_ol_rancak->ambil_data_rujukan_working_null();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['nama_kewenangan']  = set_value('nama_kewenangan',$this->input->post('nama_kewenangan'));
				$data['id_kompetensi']  = set_value('id_kompetensi',$this->input->post('id_kompetensi'));
				$data['id_kode_kewenangan']  = set_value('id_kode_kewenangan',$this->input->post('id_kode_kewenangan'));
				$data['id_sifat_kewenangan']  = set_value('id_sifat_kewenangan',$this->input->post('id_sifat_kewenangan'));
				$data['wkt_kewenangan']  = set_value('wkt_kewenangan',$this->input->post('wkt_kewenangan'));
				$data['id_ruangan']  = set_value('id_ruangan',$this->input->post('id_ruangan'));
				$this->load->view("ol_master/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($last = $this->m_ol_master->simpan_kewenangan()){
			  	if($this->input->post('id_ruangan')){ 
			  	$this->m_ol_master->simpan_kewenangan_detil($last); }
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Sdimpan');
					redirect(base_url('ol_master/kategori_kewenangan'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('ol_master/kategori_kewenangan'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_ol_master->ambil_kewenangan($data['id']);
				$data['nama_kewenangan']  = set_value('nama_kewenangan',$keuangan["nama_kewenangan"]);
				$data['id_kompetensi']  = set_value('id_kompetensi',$keuangan["id_kompetensi"]);
				$data['id_kode_kewenangan']  = set_value('id_kode_kewenangan',$keuangan["id_kode_kewenangan"]);
				$data['id_sifat_kewenangan']  = set_value('id_sifat_kewenangan',$keuangan["id_sifat_kewenangan"]);
				$data['wkt_kewenangan']  = set_value('wkt_kewenangan',$keuangan["wkt_kewenangan"]);
				$data['id_ruangan']  = set_value('id_ruangan',$keuangan["id_ruangan"]);
				$this->load->view("ol_master/isi",$data);
      }
      if($mode=='simpan_edit'){
      	$id_kewenangan = $this->input->post('id_kewenangan');
				$kondisi_mine=array('creator_kewenangan'=>$this->session->id_pegawai,'id_kewenangan'=>$id_kewenangan);
				$jml_mine = $this->m_umum->jumlah_record_filter('ol_kewenangan',$kondisi_mine);				
				$kondisi_nol=array('creator_kewenangan'=>0,'id_kewenangan'=>$id_kewenangan);
				$jml_nol = $this->m_umum->jumlah_record_filter('ol_kewenangan',$kondisi_nol);
				$kondisi=array('id_kewenangan'=>$id_kewenangan);
				$jml = $this->m_umum->jumlah_record_filter('ol_kewenangan',$kondisi);
				if($jml_nol == 0){
					if($jml_mine == 0){
							$this->session->set_flashdata('danger', 'Maaf Bukan Data Anda');
							redirect(base_url('ol_master/kategori_kewenangan'));
					}else{
					  if($this->m_ol_master->edit_kewenangan()){
					  	$this->m_ol_master->edit_kewenangan_detil();
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('ol_master/kategori_kewenangan'));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('ol_master/kategori_kewenangan'));
					  }
					}
				}else{
							$this->session->set_flashdata('danger', 'Data Administrator');
							redirect(base_url('ol_master/kategori_kewenangan'));
				}
      }
		}
  }
	function relasi($mode='view'){
		$data['page']="relasi"; 
		$data['header'] = "DATA RELASI BUKU PUTIH KEPERAWATAN DENGAN BUTIR KEGIATAN => DUPAK / EUKOM";
		$data['title'] = "DATA RELASI BUKU PUTIH KEPERAWATAN DENGAN BUTIR KEGIATAN => DUPAK / EUKOM";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
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
		//======================= IMPORTANT =========================================031891
		$data['id_jabatan_fungsional']   = $this->uri->segment(4, 0);
		$data['id_ruangan']   = $this->uri->segment(5, 0);
		$data['id_kode_kewenangan']   = $this->uri->segment(6, 0);
		$data['id_butir_kegiatan']   = $this->uri->segment(7, 0);
		$data['pat'] = $this->uri->segment(3, 0);
/*		if($data['pat'] == NULL OR empty($data['pat'])){
			$data['id_jabatan_fungsional'] = 10;
			$data['id_ruangan'] = 0;
			$data['id_kode_kewenangan'] = 0;
			$data['id_jabatan'] = 12;
			$data['id_butir_kegiatan'] = 1;
		}*/
		$data['cmd_jabfung'] = $this->m_rancak->cmd_jabfung_buket($this->session->id_jabatan);
		$data['cmd_jabfung_no_null'] = $this->m_rancak->cmd_jabfung_no_null();
		$data['cmd_ruangan']=$this->m_ol_rancak->cmd_ruangan();
		$data['cmd_jabfung_buket']=$this->m_rancak->cmd_jabatan_fungsional_dg_id($this->session->id_jabatan);
		$data['butir_kegiatan_no_null']=$this->m_rancak->butir_kegiatan_no_null($data['id_jabatan_fungsional']);
		$data['kol_kode_kewenangan_null_pk']=$this->m_ol_rancak->kol_kode_kewenangan_null();
		$data['cmd_jabatan']=$this->m_rancak->cmd_jabatan();
		$data['cmd_status']=$this->m_rancak->cmd_status();
		if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			$id_jabatan_fungsional = $this->input->post('id_jabatan_fungsional');
			if($action == 'BtnProses') {
				$id = $this->input->post("id_jabatan_fungsional");
				redirect(base_url('ol_master/relasi/view/'.$id_jabatan_fungsional));
			}
		}
		else if($mode=='data'){
			echo json_encode($this->m_ol_master->kewenangan_bk($data['id_jabatan_fungsional']));
		}
		else{
			if($mode=='tambah'){
				$data['page'] =  $data['page']."_tambah";		
				$data['kewenangan_look'] = $this->m_ol_rancak->kewenangan_look($this->session->id_jabatan,$data['id_ruangan'],$data['id_kode_kewenangan']);
				$this->form_validation->set_rules('id_jabatan_fungsional','id_jabatan_fungsional','required');
				if ($this->form_validation->run() === FALSE){
						$this->tampil($data);
				}else{
					$action = $this->input->post('action');
					$id_jabatan_fungsional = $this->input->post('id_jabatan_fungsional');
					$id_ruangan = $this->input->post('id_ruangan');
					$id_kode_kewenangan = $this->input->post('id_kode_kewenangan');
					$id_jabatan = $this->input->post('id_jabatan');
					$id_butir_kegiatan = $this->input->post('id_butir_kegiatan');
					if($action == 'BtnProses') {
						$id = $this->input->post("id_jabatan_fungsional");
						redirect(base_url('ol_master/relasi/tambah/'.$id_jabatan_fungsional.'/'.$id_ruangan.'/'.$id_kode_kewenangan.'/'.$id_butir_kegiatan));
					}
					if($action == 'BtnSimpan') {
						$id_jabatan_fungsional = $this->input->post('id_jabatan_fungsional');
						if($this->input->post('chk') && $this->input->post('id_butir_kegiatan')){
								$this->m_ol_master->simpan_ol_kewenangan_bk();
								$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
						}else{
							$this->session->set_flashdata('danger', 'Data Belum Lengkap');
						}
							redirect(base_url('ol_master/relasi/view/'.$id_jabatan_fungsional));
					}
				}
			}		
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('ol_kewenangan_bk','id_kewenangan_bk',$data['id_jabatan_fungsional']);
				$kw    = $this->m_ol_rancak->cmd_kewenangan_id_kewenangan($keuangan['id_kewenangan']);
				$data['cmd_kewenangan']=$this->m_ol_rancak->cmd_kewenangan_idj_no_null($kw['id_jabatan']);
				$data['butir_kegiatane']=$this->m_rancak->buket_no_null($kw['id_jabatan']);
				$data['id_kewenangan_bk']  = set_value('id_kewenangan_bk',$keuangan["id_kewenangan_bk"]);
				$data['id_kewenangan']  = set_value('id_kewenangan',$keuangan["id_kewenangan"]);
				$data['id_butir_kegiatan']  = set_value('id_butir_kegiatan',$keuangan["id_butir_kegiatan"]);
				$data['status_kewenangan_bk']  = set_value('status_kewenangan_bk',$keuangan["status_kewenangan_bk"]);
				$this->load->view("ol_master/isi",$data);
      }
      if($mode=='simpan_edit'){
      	$id_jabatan_fungsional = $this->input->post('id_jabatan_fungsional');
      	$id_kewenangan = $this->input->post('id_kewenangan');
      	$id_kewenangan_lama = $this->input->post('id_kewenangan_lama');
      	$id_butir_kegiatan = $this->input->post('id_butir_kegiatan');
      	$id_butir_kegiatan_lama = $this->input->post('id_butir_kegiatan_lama');
				$kondisi=array('id_kewenangan'=>$id_kewenangan,'id_butir_kegiatan'=>$id_butir_kegiatan);
				$jml = $this->m_umum->jumlah_record_filter('ol_kewenangan_bk',$kondisi);
					if($jml == 0){
					  if($this->m_ol_daftar->edit_ol_kewenangan_bk()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('ol_master/relasi/view/'.$id_jabatan_fungsional));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('ol_master/relasi/view/'.$id_jabatan_fungsional));
					  }
					}else{
							$this->session->set_flashdata('danger', 'Data Sudah Ada');
							redirect(base_url('ol_master/relasi/view/'.$id_jabatan_fungsional));
					}
      }
		}
	}
/*  function butir_kegiatan($mode='view')
  {
	$data['page']  = "butir_kegiatan";
		$data['header'] = "DATA BUTIR KEGIATAN";
		$data['title'] = "DATA BUTIR KEGIATAN";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
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
		//======================= IMPORTANT =========================================031891
		$data['id']   = $this->uri->segment(4, 0);
	$data['id_butir_kegiatan'] = $this->uri->segment(5, 0); // id_butir_kegiatan
	if(empty($data['id'])){
		$data['id'] ='0';
	}
//	$data['cmd_jabfung_buket'] = $this->m_rancak->cmd_jabfung_buket($pegawai['id_jabatan']);
//	$data['cmd_jabatan_fungsional_id'] = $this->m_rancak->cmd_jabatan_fungsional_id($pegawai['id_jabatan']);
	$data['cmd_jabfung_buket'] = $this->m_ol_rancak->cmd_jabfung_profil();
	$data['cmd_jabatan_fungsional_id'] = $this->m_ol_rancak->cmd_jabatan_fungsional_no_null();
    if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$id = $this->input->post("id");
			redirect(base_url('ol_master/butir_kegiatan/view/'.$id));
		}
	}
    else if($mode=='data'){
		echo json_encode($this->m_ol_master->butir_kegiatan_kabeh($data['id']));
	}
  else{
	  $data['cmd_status'] = $this->m_rancak->cmd_status();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['id_jabatan_fungsional'] = set_value('id_jabatan_fungsional',$data['id']);
				$data['status_butir_kegiatan'] = set_value('status_butir_kegiatan',$this->input->post("status_butir_kegiatan"));
				$data['nama_butir_kegiatan'] = set_value('nama_butir_kegiatan',$this->input->post("nama_butir_kegiatan"));
				$data['angka_kredit'] = set_value('angka_kredit','0');
				$data['satuan_hasil'] = set_value('satuan_hasil',$this->input->post("satuan_hasil"));
		$this->load->view("ol_master/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  $id = $this->input->post('id');
			  if($this->m_ol_master->tambah_butir_kegiatan_kw()){
					$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
					redirect(base_url('ol_master/butir_kegiatan/view/'.$id));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Masalah Simpan Data. Hubungi Admin');
					redirect(base_url('ol_master/butir_kegiatan/view/'.$id));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$ded = $this->m_umum->ambil_data('butir_kegiatan','id_butir_kegiatan',$data['id_butir_kegiatan']);
				$bke = $this->m_umum->ambil_data('ol_kewenangan_bk','id_butir_kegiatan',$data['id_butir_kegiatan']);
				$data['id_kewenangan'] = set_value('id_kewenangan',$bke["id_kewenangan"]);
				$data['id_jabatan_fungsional'] = set_value('id_jabatan_fungsional',$ded["id_jabatan_fungsional"]);
				$data['status_butir_kegiatan'] = set_value('status_butir_kegiatan',$ded["status_butir_kegiatan"]);
				$data['nama_butir_kegiatan'] = set_value('nama_butir_kegiatan',$ded["nama_butir_kegiatan"]);
				$data['angka_kredit'] = set_value('angka_kredit',round($ded["angka_kredit"],4));
				$data['satuan_hasil'] = set_value('satuan_hasil',$ded["satuan_hasil"]);
				$this->load->view("ol_master/isi",$data);
      }
      if($mode=='simpan_edit'){
			 		$id = $this->input->post('id');
				  if($this->m_ol_master->rubah_butir_kegiatan()){
				  $this->m_ol_master->rubah_kewenangan_bk();
					$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
					redirect(base_url('ol_master/butir_kegiatan/view/'.$id));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Masalah Rubah Data. Hubungi Admin');
					redirect(base_url('ol_master/butir_kegiatan/view/'.$id));
			  }
      }
	}
  }*/
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("ol_master/header",$data);
	$this->load->view("ol_master/isi");
	$this->load->view("footer");
	$this->load->view("ol_master/jsload");
	$this->load->view("ol_master/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_top",$data);
	$this->load->view("ol_master/isi");
	$this->load->view("footer");
	$this->load->view("ol_master/jsload");
	$this->load->view("ol_master/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
