<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Admin_sanitasi extends CI_controller
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
		//======================= IMPORTANT =========================================
		$whats = $this->m_umum->ambil_data('ol_whatsnew','id_whatsnew',1);
		$data['isi_whatsnew']   = $whats['isi_whatsnew'];
		$this->tampil($data);
	}
  function jenis_limbah($mode='view')
  {
		$data['page']  = "jenis_limbah";
		$data['header'] = "KATEGORI INDIKATOR MUTU";
		$data['title'] = "KATEGORI INDIKATOR MUTU";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
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
		$data['id'] = $this->uri->segment(4, 0);
    if($mode=='view'){
			$this->tampil($data);
		}
    else if($mode=='data'){
			echo json_encode($this->m_sanitasi->standar_mutu_all());
		}
  	else{
  			$data['cmd_status'] = $this->m_rancak->cmd_status();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['nama_standar_mutu']  = set_value('nama_standar_mutu',$this->input->post('nama_standar_mutu'));
				$data['status_standar_mutu']  = set_value('status_standar_mutu',$this->input->post('status_standar_mutu'));
				$this->load->view("admin_sanitasi/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($this->m_sanitasi->simpan_sn_standar_mutu()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Sdimpan');
					redirect(base_url('admin_sanitasi/jenis_limbah'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('admin_sanitasi/jenis_limbah'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan = $this->m_umum->ambil_data('sn_standar_mutu','id_standar_mutu',$data['id']);
				$data['nama_standar_mutu']  = set_value('nama_standar_mutu',$keuangan["nama_standar_mutu"]);
				$data['status_standar_mutu']  = set_value('status_standar_mutu',$keuangan["status_standar_mutu"]);
				$this->load->view("admin_sanitasi/isi",$data);
      }
      if($mode=='simpan_edit'){
			  if($this->m_sanitasi->edit_sn_standar_mutu()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
					redirect(base_url('admin_sanitasi/jenis_limbah'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
					redirect(base_url('admin_sanitasi/jenis_limbah'));
			  }
      }
		}
  }
  function perlakuan_limbah($mode='view')
  {
		$data['page']  = "perlakuan_limbah";
		$data['header'] = "PERLAKUAN OUTPUT INDIKATOR MUTU";
		$data['title'] = "PERLAKUAN OUTPUT INDIKATOR MUTU";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
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
		$data['id'] = $this->uri->segment(4, 0);
    if($mode=='view'){
			$this->tampil($data);
		}
    else if($mode=='data'){
			echo json_encode($this->m_sanitasi->perlakuan_emisi_all());
		}
  	else{
  			$data['cmd_status'] = $this->m_rancak->cmd_status();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['nama_perlakuan_emisi']  = set_value('nama_perlakuan_emisi',$this->input->post('nama_perlakuan_emisi'));
				$data['status_perlakuan_emisi']  = set_value('status_perlakuan_emisi',$this->input->post('status_perlakuan_emisi'));
				$this->load->view("admin_sanitasi/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($this->m_sanitasi->simpan_sn_perlakuan_emisi()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Sdimpan');
					redirect(base_url('admin_sanitasi/perlakuan_limbah'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('admin_sanitasi/perlakuan_limbah'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan = $this->m_umum->ambil_data('sn_perlakuan_emisi','id_perlakuan_emisi',$data['id']);
				$data['nama_perlakuan_emisi']  = set_value('nama_perlakuan_emisi',$keuangan["nama_perlakuan_emisi"]);
				$data['status_perlakuan_emisi']  = set_value('status_perlakuan_emisi',$keuangan["status_perlakuan_emisi"]);
				$this->load->view("admin_sanitasi/isi",$data);
      }
      if($mode=='simpan_edit'){
			  if($this->m_sanitasi->edit_sn_perlakuan_emisi()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
					redirect(base_url('admin_sanitasi/perlakuan_limbah'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
					redirect(base_url('admin_sanitasi/perlakuan_limbah'));
			  }
      }
		}
  }
  function sumber_emisi($mode='view')
  {
		$data['page']  = "sumber_emisi";
		$data['header'] = "SUMBER PENGUKURAN";
		$data['title'] = "SUMBER PENGUKURAN";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
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
		$data['id'] = $this->uri->segment(4, 0);
    if($mode=='view'){
			$this->tampil($data);
		}
    else if($mode=='data'){
			echo json_encode($this->m_sanitasi->sumber_emisi_all());
		}
  	else{
  			$data['cmd_status'] = $this->m_rancak->cmd_status();
  			$id_in =  array(1,2,3,4);
  			$data['ambil_sn_standar_mutu'] = $this->m_sanitasi->ambil_sn_standar_mutu($id_in);
  			$data['opsi_sumes'] = $this->m_sanitasi->opsi_sumes();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['nama_sumber_emisi']  = set_value('nama_sumber_emisi',$this->input->post('nama_sumber_emisi'));
				$data['deskripsi_sumber_emisi']  = set_value('deskripsi_sumber_emisi',$this->input->post('deskripsi_sumber_emisi'));
				$data['id_standar_mutu']  = set_value('id_standar_mutu',$this->input->post('id_standar_mutu'));
				$data['id_opsi_pengukuran']  = set_value('id_opsi_pengukuran',$this->input->post('id_opsi_pengukuran'));
				$data['status_sumber_emisi']  = set_value('status_sumber_emisi',$this->input->post('status_sumber_emisi'));
				$this->load->view("admin_sanitasi/isi",$data);
      }
      if($mode=='simpan_tambah'){
      	if($this->input->post('id_standar_mutu')){
				  if($this->m_sanitasi->simpan_sn_sumber_emisi()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Sdimpan');
						redirect(base_url('admin_sanitasi/sumber_emisi'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
						redirect(base_url('admin_sanitasi/sumber_emisi'));
				  }
				}else{
						$this->session->set_flashdata('danger', 'Data Belum Lengkap');
						redirect(base_url('admin_sanitasi/sumber_emisi'));					
				}
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan = $this->m_umum->ambil_data('sn_sumber_emisi','id_sumber_emisi',$data['id']);
				$data['nama_sumber_emisi']  = set_value('nama_sumber_emisi',$keuangan["nama_sumber_emisi"]);
				$data['deskripsi_sumber_emisi']  = set_value('deskripsi_sumber_emisi',$keuangan["deskripsi_sumber_emisi"]);
				$data['id_standar_mutu']  = set_value('id_standar_mutu',$keuangan["id_standar_mutu"]);
				$data['id_opsi_pengukuran']  = set_value('id_opsi_pengukuran',$keuangan["id_opsi_pengukuran"]);
				$data['status_sumber_emisi']  = set_value('status_sumber_emisi',$keuangan["status_sumber_emisi"]);
				$this->load->view("admin_sanitasi/isi",$data);
      }
      if($mode=='simpan_edit'){
      	if($this->input->post('id_standar_mutu')){
				  if($this->m_sanitasi->edit_sn_sumber_emisi()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
						redirect(base_url('admin_sanitasi/sumber_emisi'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
						redirect(base_url('admin_sanitasi/sumber_emisi'));
				  }
				}else{
						$this->session->set_flashdata('danger', 'Data Belum Lengkap');
						redirect(base_url('admin_sanitasi/sumber_emisi'));					
				}				  
      }
		}
  }
  function pengolah_limbah($mode='view')
  {
		$data['page']  = "pengolah_limbah";
		$data['header'] = "PENGOLAH INDIKATOR MUTU";
		$data['title'] = "PENGOLAH INDIKATOR MUTU";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
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
		$data['id'] = $this->uri->segment(4, 0);
    if($mode=='view'){
			$this->tampil($data);
		}
    else if($mode=='data'){
			echo json_encode($this->m_sanitasi->pengolah_limbah_all());
		}
  	else{
  			$data['cmd_status'] = $this->m_rancak->cmd_status();
  			$id_in =  array(1,2,3,4);
  			$data['ambil_sn_standar_mutu'] = $this->m_sanitasi->ambil_sn_standar_mutu($id_in);
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['nama_pengolah_limbah']  = set_value('nama_pengolah_limbah',$this->input->post('nama_pengolah_limbah'));
				$data['deskripsi_pengolah_limbah']  = set_value('deskripsi_pengolah_limbah',$this->input->post('deskripsi_pengolah_limbah'));
				$data['id_standar_mutu']  = set_value('id_standar_mutu',$this->input->post('id_standar_mutu'));
				$data['status_pengolah_limbah']  = set_value('status_pengolah_limbah',$this->input->post('status_pengolah_limbah'));
				$this->load->view("admin_sanitasi/isi",$data);
      }
      if($mode=='simpan_tambah'){
				if($this->input->post('id_standar_mutu')){
				  if($this->m_sanitasi->simpan_sn_pengolah_limbah()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Sdimpan');
						redirect(base_url('admin_sanitasi/pengolah_limbah'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
						redirect(base_url('admin_sanitasi/pengolah_limbah'));
				  }
				}else{
						$this->session->set_flashdata('danger', 'Data Belum Lengkap');
						redirect(base_url('admin_sanitasi/pengolah_limbah'));					
				}
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan = $this->m_umum->ambil_data('sn_pengolah_limbah','id_pengolah_limbah',$data['id']);
				$data['nama_pengolah_limbah']  = set_value('nama_pengolah_limbah',$keuangan["nama_pengolah_limbah"]);
				$data['deskripsi_pengolah_limbah']  = set_value('deskripsi_pengolah_limbah',$keuangan["deskripsi_pengolah_limbah"]);
				$data['id_standar_mutu']  = set_value('id_standar_mutu',$keuangan["id_standar_mutu"]);
				$data['status_pengolah_limbah']  = set_value('status_pengolah_limbah',$keuangan["status_pengolah_limbah"]);
				$this->load->view("admin_sanitasi/isi",$data);
      }
      if($mode=='simpan_edit'){
				if($this->input->post('id_standar_mutu')){
				  if($this->m_sanitasi->edit_sn_pengolah_limbah()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
						redirect(base_url('admin_sanitasi/pengolah_limbah'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
						redirect(base_url('admin_sanitasi/pengolah_limbah'));
				  }
				}else{
						$this->session->set_flashdata('danger', 'Data Belum Lengkap');
						redirect(base_url('admin_sanitasi/pengolah_limbah'));					
				}				  
      }
		}
  }
  function limbah($mode='view')
  {
		$data['page']  = "limbah";
		$data['header'] = "INDIKATOR MUTU";
		$data['title'] = "INDIKATOR MUTU";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
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
		$data['id'] = $this->uri->segment(4, 0);
    if($mode=='view'){
			$this->tampil($data);
		}
    else if($mode=='data'){
			echo json_encode($this->m_sanitasi->limbah_all());
		}
  	else{
  			$data['cmd_status'] = $this->m_rancak->cmd_status();
  			$id_in =  array(1,2,3,4);
  			$data['ambil_sn_standar_mutu'] = $this->m_sanitasi->ambil_sn_standar_mutu($id_in);
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['nama_limbah']  = set_value('nama_limbah',$this->input->post('nama_limbah'));
				$data['id_standar_mutu']  = set_value('id_standar_mutu',$this->input->post('id_standar_mutu'));
				$data['status_limbah']  = set_value('status_limbah',$this->input->post('status_limbah'));
				$data['standar_mutu']  = set_value('standar_mutu',$this->input->post('standar_mutu'));
				$data['range_mutu']  = set_value('range_mutu',$this->input->post('range_mutu'));
				$data['satuan_limbah']  = set_value('satuan_limbah',$this->input->post('satuan_limbah'));
				$this->load->view("admin_sanitasi/isi",$data);
      }
      if($mode=='simpan_tambah'){
				if($this->input->post('id_standar_mutu')){      	
				  if($this->m_sanitasi->simpan_sn_limbah()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Sdimpan');
						redirect(base_url('admin_sanitasi/limbah'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
						redirect(base_url('admin_sanitasi/limbah'));
				  }
				}else{
						$this->session->set_flashdata('danger', 'Data Belum Lengkap');
						redirect(base_url('admin_sanitasi/limbah'));					
				}
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan = $this->m_umum->ambil_data('sn_limbah','id_limbah',$data['id']);
				$data['nama_limbah']  = set_value('nama_limbah',$keuangan["nama_limbah"]);
				$data['id_standar_mutu']  = set_value('id_standar_mutu',$keuangan["id_standar_mutu"]);
				$data['status_limbah']  = set_value('status_limbah',$keuangan["status_limbah"]);
				$data['standar_mutu']  = set_value('standar_mutu',$keuangan["standar_mutu"]);
				$data['range_mutu']  = set_value('range_mutu',$keuangan["range_mutu"]);
				$data['satuan_limbah']  = set_value('satuan_limbah',$keuangan["satuan_limbah"]);
				$this->load->view("admin_sanitasi/isi",$data);
      }
      if($mode=='simpan_edit'){
				if($this->input->post('id_standar_mutu')){   
				  if($this->m_sanitasi->edit_sn_limbah()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
						redirect(base_url('admin_sanitasi/limbah'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
						redirect(base_url('admin_sanitasi/limbah'));
				  }
				}else{
						$this->session->set_flashdata('danger', 'Data Belum Lengkap');
						redirect(base_url('admin_sanitasi/limbah'));					
				}
      }
		}
  }
 function tps($mode='view')
  {
		$data['page']  = "tps";
		$data['header'] = "LOKASI TEMPAT PEMBUANGAN LIMBAH";
		$data['title'] = "LOKASI TEMPAT PEMBUANGAN LIMBAH";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
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
		$data['id'] = $this->uri->segment(4, 0);
    if($mode=='view'){
			$this->tampil($data);
		}
    else if($mode=='data'){
			echo json_encode($this->m_sanitasi->lokasi_all());
		}
  	else{
  			$data['ambil_data_instansi'] = $this->m_ol_rancak->ambil_data_instansi();
  			$data['cmd_status'] = $this->m_rancak->cmd_status();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['nama_tps']  = set_value('nama_tps',$this->input->post('nama_tps'));
				$data['id_instansi']  = set_value('id_instansi',$this->input->post('id_instansi'));
				$data['status_tps']  = set_value('status_tps',$this->input->post('status_tps'));
				$this->load->view("admin_sanitasi/isi",$data);
      }
      if($mode=='simpan_tambah'){
				if($this->input->post('id_instansi')){   
				  if($this->m_sanitasi->simpan_sn_tps()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Sdimpan');
						redirect(base_url('admin_sanitasi/tps'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
						redirect(base_url('admin_sanitasi/tps'));
				  }
				}else{
						$this->session->set_flashdata('danger', 'Data Belum Lengkap');
						redirect(base_url('admin_sanitasi/tps'));					
				}
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan = $this->m_umum->ambil_data('sn_tps','id_tps',$data['id']);
				$data['id_instansi']  = set_value('id_instansi',$keuangan["id_instansi"]);
				$data['nama_tps']  = set_value('nama_tps',$keuangan["nama_tps"]);
				$data['status_tps']  = set_value('status_tps',$keuangan["status_tps"]);
				$this->load->view("admin_sanitasi/isi",$data);
      }
      if($mode=='simpan_edit'){
				if($this->input->post('id_instansi')){         	
				  if($this->m_sanitasi->edit_sn_tps()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
						redirect(base_url('admin_sanitasi/tps'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
						redirect(base_url('admin_sanitasi/tps'));
				  }
				}else{
						$this->session->set_flashdata('danger', 'Data Belum Lengkap');
						redirect(base_url('admin_sanitasi/tps'));					
				}
      }
		}
  }
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("admin_sanitasi/header",$data);
	$this->load->view("admin_sanitasi/isi");
	$this->load->view("footer");
	$this->load->view("admin_sanitasi/jsload");
	$this->load->view("admin_sanitasi/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_top",$data);
	$this->load->view("admin_sanitasi/isi");
	$this->load->view("footer");
	$this->load->view("admin_sanitasi/jsload");
	$this->load->view("admin_sanitasi/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
