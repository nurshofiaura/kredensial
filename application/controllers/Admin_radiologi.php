<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Admin_radiologi extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();	  
          $this->load->model('m_ol_rancak');
          $this->load->model('m_radiologi');$this->login_kah();
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
  function reject($mode='view')
  {
	$data['page']  = "reject";
  $data['header'] = "REJECT";
  $data['title'] = "REJECT";
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
	$data['id'] = $this->uri->segment(4, 0);
    if($mode=='view'){
		$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_radiologi->reject_all());
	}
/*    else if($mode=='hapus'){
		$kondisi=array('id_kompetensi'=>$data['id']);
		$jml = $this->m_umum->jumlah_record_filter('kr_kewenangan',$kondisi);
		if($jml == 0){
		  if($this->m_umum->hapus_data('kr_kompetensi','id_kompetensi',$data['id'])){
			$this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
			redirect(base_url('admin_perawat/kategori_kompetensi'));
		  }else{
			$this->session->set_flashdata('danger', 'Masalah Hapus Data');
			redirect(base_url('admin_perawat/kategori_kompetensi'));
		  }
		}else{
			$this->session->set_flashdata('danger', 'Data Sudah Masuk Alur');
			redirect(base_url('admin_perawat/kategori_kompetensi'));
		}
  } */
    else{
  		$data['cmd_status'] = $this->m_rancak->cmd_status();
        if($mode=='tambah'){
          $data['page'] =  $data['page']."_tambah";
      		$data['nama_reject']  = set_value('nama_reject',$this->input->post('nama_reject'));
      		$data['status_reject']  = set_value('status_reject',$this->input->post('status_reject'));
  		    $this->load->view("adminradiologi/isi",$data);
        }
        if($mode=='simpan_tambah'){
    		  if($this->m_radiologi->simpan_reject()){
      			$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
      			redirect(base_url('admin_radiologi/reject'));
    		  }else{
      			$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
      			redirect(base_url('admin_radiologi/reject'));
    		  }
        }
        if($mode=='edit'){
          $data['page'] =  $data['page']."_edit";
      		$keuangan    = $this->m_umum->ambil_data('kol_reject','id_reject',$data['id']);
      		$data['nama_reject']  = set_value('nama_reject',$keuangan["nama_reject"]);
          $data['pembuat_reject']  = set_value('pembuat_reject',$keuangan["pembuat_reject"]);
      		$data['status_reject']  = set_value('status_reject',$keuangan["status_reject"]);
      		$this->load->view("adminradiologi/isi",$data);
        }
        if($mode=='simpan_edit'){
          $pembuat_reject = $this->input->post('pembuat_reject');
          if($this->session->refer == $pembuat_reject){
            if($this->m_radiologi->edit_reject()){
              $this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
              redirect(base_url('admin_radiologi/reject'));
            }else{
              $this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
              redirect(base_url('admin_radiologi/reject'));
            }
          }else{
            $this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
            redirect(base_url('admin_radiologi/reject'));
          }
        }
  	}
  }
/*  function fokus($mode='view')
  {
	$data['page']  = "fokus";
  $data['header'] = "FOKUS ALAT RADIOLOGI";
  $data['title'] = "FOKUS ALAT RADIOLOGI";
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
	$data['id'] = $this->uri->segment(4, 0);
    if($mode=='view'){
		$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_radiologi->fokus_all());
	}
    else if($mode=='hapus'){
		$kondisi=array('id_kompetensi'=>$data['id']);
		$jml = $this->m_umum->jumlah_record_filter('kr_kewenangan',$kondisi);
		if($jml == 0){
		  if($this->m_umum->hapus_data('kr_kompetensi','id_kompetensi',$data['id'])){
			$this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
			redirect(base_url('admin_perawat/kategori_kompetensi'));
		  }else{
			$this->session->set_flashdata('danger', 'Masalah Hapus Data');
			redirect(base_url('admin_perawat/kategori_kompetensi'));
		  }
		}else{
			$this->session->set_flashdata('danger', 'Data Sudah Masuk Alur');
			redirect(base_url('admin_perawat/kategori_kompetensi'));
		}
  } 
    else{
        if($mode=='tambah'){
          $data['page'] =  $data['page']."_tambah";
      		$data['nama_field_size']  = set_value('nama_field_size',$this->input->post('nama_field_size'));
  		    $this->load->view("adminradiologi/isi",$data);
        }
        if($mode=='simpan_tambah'){
  		  if($this->m_radiologi->simpan_field_size()){
  			$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
  			redirect(base_url('admin_radiologi/fokus'));
  		  }else{
  			$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
  			redirect(base_url('admin_radiologi/fokus'));
  		  }
        }
        if($mode=='edit'){
          $data['page'] =  $data['page']."_edit";
      		$keuangan    = $this->m_umum->ambil_data('radiologi_field_size','id_field_size',$data['id']);
      		$data['nama_field_size']  = set_value('nama_field_size',$keuangan["nama_field_size"]);
      		$this->load->view("adminradiologi/isi",$data);
        }
        if($mode=='simpan_edit'){
  		  if($this->m_radiologi->edit_field_size()){
  			$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
  			redirect(base_url('admin_radiologi/fokus'));
  		  }else{
  			$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
  			redirect(base_url('admin_radiologi/fokus'));
  		  }
        }
  	}
  }
  function thickness($mode='view')
  {
	$data['page']  = "thickness";
  $data['header'] = "KETEBALAN OBYEK";
  $data['title'] = "KETEBALAN OBYEK";
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
	$data['id'] = $this->uri->segment(4, 0);
    if($mode=='view'){
		$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_radiologi->thickness_all());
	}
    else if($mode=='hapus'){
		$kondisi=array('id_kompetensi'=>$data['id']);
		$jml = $this->m_umum->jumlah_record_filter('kr_kewenangan',$kondisi);
		if($jml == 0){
		  if($this->m_umum->hapus_data('kr_kompetensi','id_kompetensi',$data['id'])){
			$this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
			redirect(base_url('admin_perawat/kategori_kompetensi'));
		  }else{
			$this->session->set_flashdata('danger', 'Masalah Hapus Data');
			redirect(base_url('admin_perawat/kategori_kompetensi'));
		  }
		}else{
			$this->session->set_flashdata('danger', 'Data Sudah Masuk Alur');
			redirect(base_url('admin_perawat/kategori_kompetensi'));
		}
  } 
    else{
        $data['cmd_fat']=$this->m_rancak->cmd_fat();
        if($mode=='tambah'){
          $data['page'] =  $data['page']."_tambah";
      		$data['nama_thickness']  = set_value('nama_thickness',$this->input->post('nama_thickness'));
      		$data['fat']  = set_value('fat',$this->input->post('fat'));
      		$data['thickness']  = set_value('thickness',$this->input->post('thickness'));
      		$data['deskripsi_thickness']  = set_value('deskripsi_thickness',$this->input->post('deskripsi_thickness'));
  		    $this->load->view("adminradiologi/isi",$data);
        }
        if($mode=='simpan_tambah'){
  		  if($this->m_radiologi->simpan_thickness()){
  			$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
  			redirect(base_url('admin_radiologi/thickness'));
  		  }else{
  			$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
  			redirect(base_url('admin_radiologi/thickness'));
  		  }
        }
        if($mode=='edit'){
          $data['page'] =  $data['page']."_edit";
      		$keuangan    = $this->m_umum->ambil_data('radiologi_thickness','id_thickness',$data['id']);
      		$data['nama_thickness']  = set_value('nama_thickness',$keuangan["nama_thickness"]);
      		$data['fat']  = set_value('fat',$keuangan["fat"]);
      		$data['thickness']  = set_value('thickness',$keuangan["thickness"]);
      		$data['deskripsi_thickness']  = set_value('deskripsi_thickness',$keuangan["deskripsi_thickness"]);
      		$this->load->view("adminradiologi/isi",$data);
        }
        if($mode=='simpan_edit'){
  		  if($this->m_radiologi->edit_thickness()){
  			$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
  			redirect(base_url('admin_radiologi/thickness'));
  		  }else{
  			$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
  			redirect(base_url('admin_radiologi/thickness'));
  		  }
        }
  	}
  }*/
  function fe($mode='view')
  {
	$data['page']  = "fe";
  $data['header'] = "FAKTOR EKSPOSI";
  $data['title'] = "FAKTOR EKSPOSI";
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
	$data['id'] = $this->uri->segment(4, 0);
    if($mode=='view'){
		$this->tampil($data);
	}
  if($mode=='bakhp'){
    $data['page']  = "bakhp";
  $this->tampil($data);
}
    else if($mode=='data'){
		echo json_encode($this->m_radiologi->fe_all());
	}
  else if($mode=='tindakan'){
  echo json_encode($this->m_radiologi->tindakan_all());
  }
/*    else if($mode=='hapus'){
		$kondisi=array('id_kompetensi'=>$data['id']);
		$jml = $this->m_umum->jumlah_record_filter('kr_kewenangan',$kondisi);
		if($jml == 0){
		  if($this->m_umum->hapus_data('kr_kompetensi','id_kompetensi',$data['id'])){
			$this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
			redirect(base_url('admin_perawat/kategori_kompetensi'));
		  }else{
			$this->session->set_flashdata('danger', 'Masalah Hapus Data');
			redirect(base_url('admin_perawat/kategori_kompetensi'));
		  }
		}else{
			$this->session->set_flashdata('danger', 'Data Sudah Masuk Alur');
			redirect(base_url('admin_perawat/kategori_kompetensi'));
		}
  } */
    else{
      $data['fat']=$this->m_rancak->fat();
      $data['cmd_grid']=$this->m_rancak->cmd_grid();
      $data['field_size']=$this->m_rancak->field_size();
      $data['proyeksi_nonull']=$this->m_rancak->proyeksi_nonull();
        if($mode=='tambah'){
          $data['page'] =  $data['page']."_tambah";
  			  $this->tampil($data);
        }
        if($mode=='tambah_fe'){
          $data['page'] =  $data['page']."_tambah_fe";
      		$this->load->view("adminradiologi/isi",$data);
        }
        if($mode=='simpan_tambah_fe'){
    		  $this->m_radiologi->simpan_radiologi_fe();
      		$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
      		redirect(base_url('admin_radiologi/fe'));
        }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
        $keuangan    = $this->m_umum->ambil_data('radiologi_fe','id_fe',$data['id']);
        $data['id_tindakan']  = set_value('id_tindakan',$keuangan["id_tindakan"]);
        $data['id_fe']  = set_value('id_fe',$keuangan["id_fe"]);
        $data['kv']  = set_value('kv',$keuangan["kv"]);
        $data['mas']  = set_value('mas',$keuangan["mas"]);
        $data['fpd']  = set_value('fpd',$keuangan["fpd"]);
        $data['thickness']  = set_value('thickness',$keuangan["thickness"]);
        $data['id_field_size']  = set_value('id_field_size',$keuangan["id_field_size"]);
        $data['id_proyeksi']  = set_value('id_proyeksi',$keuangan["id_proyeksi"]);
        $data['grid']  = set_value('grid',$keuangan["grid"]);
        $this->load->view("adminradiologi/isi",$data);
      }
      if($mode=='simpan_edit'){
/*        $id_proyeksi = $this->input->post('id_proyeksi');
        $id_tindakan = $this->input->post('id_tindakan');
        $id_proyeksi_lama = $this->input->post('id_proyeksi_lama');
        $kondisi=array('id_tindakan'=>$id_tindakan,'id_proyeksi'=>$id_proyeksi,'id_proyeksi !='=>$id_proyeksi_lama);
        $jml = $this->m_umum->jumlah_record_filter('radiologi_fe',$kondisi);
        if($this->session->id_pegawai == $pembuat_tindakan){*/
          if($this->m_radiologi->edit_radiologife()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
            redirect(base_url('admin_radiologi/fe'));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
            redirect(base_url('admin_radiologi/fe'));
          }
/*        }else{
            $this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
            redirect(base_url('admin_pelayanan/tindakan'));       
          }*/
      }
  	}
  }
  function bakhp($mode='view')
  {
	$data['page']  = "bakhp";
  $data['header'] = "BAKHP";
  $data['title'] = "BAKHP";
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
	$data['id'] = $this->uri->segment(4, 0);
    if($mode=='view'){
		$this->tampil($data);
	}
  if($mode=='bakhp'){
    $data['page']  = "bakhp";
  $this->tampil($data);
  }
  else if($mode=='data'){
  echo json_encode($this->m_radiologi->bakhp_all());
  }
  else if($mode=='tindakan'){
  echo json_encode($this->m_radiologi->tindakan_all());
  }
/*    else if($mode=='hapus'){
		$kondisi=array('id_kompetensi'=>$data['id']);
		$jml = $this->m_umum->jumlah_record_filter('kr_kewenangan',$kondisi);
		if($jml == 0){
		  if($this->m_umum->hapus_data('kr_kompetensi','id_kompetensi',$data['id'])){
			$this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
			redirect(base_url('admin_perawat/kategori_kompetensi'));
		  }else{
			$this->session->set_flashdata('danger', 'Masalah Hapus Data');
			redirect(base_url('admin_perawat/kategori_kompetensi'));
		  }
		}else{
			$this->session->set_flashdata('danger', 'Data Sudah Masuk Alur');
			redirect(base_url('admin_perawat/kategori_kompetensi'));
		}
  } */
    else{
        $data['cmd_satuan_barang']=$this->m_rancak->cmd_satuan_barang();
        $data['bakhp']=$this->m_rancak->bakhp($program['unit']);
        $data['bakhp_tindakan']=$this->m_rancak->bakhp_tindakan($data['id']);
        $data['cmd_status']=$this->m_rancak->cmd_status();
        if($mode=='tambah'){
          $data['page'] =  $data['page']."_tambah";
  			  $this->tampil($data);
        }
        if($mode=='tambah_bakhp'){
          $data['page'] =  $data['page']."_tambah_bakhp";
          $data['jml_pemeriksaan_bakhp']  = set_value('jml_pemeriksaan_bakhp','0');
          $data['id_satuan']  = set_value('id_satuan',$this->input->post("id_satuan"));
          $data['status_pemeriksaan_bakhp']  = set_value('status_pemeriksaan_bakhp',$this->input->post("status_pemeriksaan_bakhp"));
      		$this->load->view("adminradiologi/isi",$data);
        }
        if($mode=='simpan_tambah_bakhp'){
    		  $this->m_radiologi->simpan_pemeriksaan_bakhp();
      		$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
      		redirect(base_url('admin_radiologi/bakhp'));
        }
  	}
  }
  function program_tr($mode='view')
  {
    $data['page']  = "program_tr";
  	$data['header'] = "SETTING TIME RESPON";
  	$data['title'] = "SETTING TIME RESPON";
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
    $data['id']   = $this->uri->segment(4, 0);
  	$tr = $this->m_umum->ambil_data('a_program_tr','id_program_tr',$data["id"]);
  	$data['id_program_tr'] = $tr["id_program_tr"];
  	$data['struktur_jabatan'] = explode(",", $tr['struktur_jabatan']);
  	$data['tindakan'] = explode(",", $tr['tindakan']);
  	$data['id_dayofweek'] = $tr["dayofweek"];
  	$data['time'] = $tr["time"];
  	$data['begin_time'] = $tr["begin_time"];
  	$data['end_time'] = $tr["end_time"];
    if($mode=='view'){
  	     $this->tampil($data);
  	}
      else if($mode=='data'){
  		echo json_encode($this->m_radiologi->basic_program_tr($pegawai["id_ruangan"]));
  	}
    else{
        if($mode=='unit'){
          $data['page'] =  $data['page']."_unit";
    		$data['title'] = "TAMBAH LIST UNIT";
    		$data['unit_4programtr']   = $this->m_rancak->struktur_jabatan();
  		  $this->form_validation->set_rules('id_program_tr','id_program_tr','required');
        if ($this->form_validation->run() === FALSE){
  			     $this->tampil($data);
        }else{
  			  if($this->m_radiologi->simpan_programtr_unit()){
  				      $this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
  				          redirect(base_url('Admin_radiologi/program_tr'));
  			  }else{
  			       $this->session->set_flashdata('danger', 'Ada Masalah Edit Data');
  				         redirect(base_url('Admin_radiologi/program_tr'));
  			  }
        }
        }
        if($mode=='tindakan'){
          $data['page'] =  $data['page']."_tindakan";
      		$data['title'] = "TAMBAH LIST TINDAKAN";
      		$data['tindakan_4programtr']   = $this->m_rancak->cmd_tindakan($pegawai["id_struktur_jabatan"]);
      		$this->form_validation->set_rules('id_program_tr','id_program_tr','required');
          if ($this->form_validation->run() === FALSE){
  			       $this->tampil($data);
          }else{
    			  if($this->m_radiologi->simpan_programtr_tindakan()){
    				      $this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
    		          redirect(base_url('Admin_radiologi/program_tr'));
    			  }else{
    				      $this->session->set_flashdata('danger', 'Ada Masalah Edit Data');
    		          redirect(base_url('Admin_radiologi/program_tr'));
    			  }
          }
        }
        if($mode=='waktu'){
          $data['page'] =  $data['page']."_waktu";
      		$data['title'] = "SETTING WAKTU EFEKTIF DAN TIME RESPON";
      		$this->load->view("adminradiologi/isi",$data);
        }
          if($mode=='aksi_waktu'){
    			$this->m_radiologi->edit_program_tr_waktu();
    			$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
    			redirect(base_url('Admin_radiologi/program_tr'));
        }
        if($mode=='dayofweek'){
          $data['page'] =  $data['page']."_dayofweek";
      		$data['title'] = "SETTING HARI EFEKTIF";
      		$data['kol_dayofweek']   = $this->m_rancak->kol_dayofweek();
      		$this->load->view("adminradiologi/isi",$data);
        }
        if($mode=='aksi_dayofweek'){
    			$this->m_radiologi->edit_program_dayofweek();
    			$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
    			redirect(base_url('Admin_radiologi/program_tr'));
        }
  	}
  }
  function pie($mode='view'){
   $data['page'] = "pie";
   $data['header'] = "GRAFIK PIE";
   $data['title'] = "GRAFIK PIE";
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
   $first_date   = $this->uri->segment(4, 0);
   $last_date   = $this->uri->segment(5, 0);
   if(empty($first_date)){
     $first_date = '01-'.date('m-Y');
   }
   if(empty($last_date)){
     $last_date = date('d-m-Y');
   }
 if($mode=='view'){
   $data['first_date'] = set_value('first_date',$first_date);
   $data['last_date'] = set_value('last_date',$last_date);
   $this->tampil($data);
   $action = $this->input->post('action');
   if($action == 'BtnProses') {
     $first_date = $this->input->post("first_date");
     $last_date = $this->input->post("last_date");
     redirect(base_url('admin_radiologi/pie/view/'.$first_date.'/'.$last_date));
   }
 }
 else if($mode=='tabel'){
 echo json_encode($this->m_radiologi->grafik_pie($first_date,$last_date,$pegawai["id_ruangan"]));
 }
 }
 function lt($mode='view')
 {
   $data['page']  = "lt";
   $data['header'] = "GRAFIK TAHUNAN";
   $data['title'] = "GRAFIK TAHUNAN";
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
 $data['bln']   = $this->uri->segment(4, 0);
 $data['thn']   = $this->uri->segment(5, 0);
 $data['array_month'] = $this->m_rancak->cmd_bulan();
 $data['array_page'] = $this->m_rancak->cmd_grafik_laporan();
 $data['year_logbook']=$this->m_rancak->cmd_tahun_logbook();
 $data['ambil_kol_golongan_pemeriksaan_graph'] = $this->m_rancak->golongan_pemeriksaan($program['struktur_jabatan']);
  $data['json'] = $this->m_radiologi->grafik_range1($data['page'],$data);
 if($mode=='view'){
   $this->tampil($data);
   $action = $this->input->post('action');
   if($action == 'BtnProses') {
     $page = $this->input->post("page");
     $bln = $this->input->post("bln");
     $thn = $this->input->post("thn");
     redirect(base_url('admin_radiologi/'.$page.'/view/'.$bln.'/'.$thn));
   }
 }
 }
 function lb($mode='view')
 {
   $data['page']  = "lb";
   $data['header'] = "GRAFIK BULANAN";
   $data['title'] = "GRAFIK BULANAN";
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
 $data['bln']   = $this->uri->segment(4, 0);
 $data['thn']   = $this->uri->segment(5, 0);
 $data['array_month'] = $this->m_rancak->cmd_bulan();
 $data['array_page'] = $this->m_rancak->cmd_grafik_laporan();
 $data['year_logbook']=$this->m_rancak->cmd_tahun_logbook();
 $data['ambil_kol_golongan_pemeriksaan_graph'] = $this->m_rancak->golongan_pemeriksaan($program['struktur_jabatan']);
  $data['json'] = $this->m_radiologi->grafik_range1($data['page'],$data);
 if($mode=='view'){
   $this->tampil($data);
   $action = $this->input->post('action');
   if($action == 'BtnProses') {
     $page = $this->input->post("page");
     $bln = $this->input->post("bln");
     $thn = $this->input->post("thn");
     redirect(base_url('admin_radiologi/'.$page.'/view/'.$bln.'/'.$thn));
   }
 }
 }
 function lh($mode='view')
 {
   $data['page']  = "lh";
   $data['header'] = "LAPORAN HARIAN";
   $data['title'] = "LAPORAN HARIAN";
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
 $data['bln']   = $this->uri->segment(4, 0);
 $data['thn']   = $this->uri->segment(5, 0);
 $data['array_month'] = $this->m_rancak->cmd_bulan();
 $data['array_page'] = $this->m_rancak->cmd_grafik_laporan();
 $data['year_logbook']=$this->m_rancak->cmd_tahun_pemeriksaan();
 $data['ambil_kol_golongan_pemeriksaan_graph'] = $this->m_rancak->golongan_pemeriksaan($program['struktur_jabatan']);
  $data['json'] = $this->m_radiologi->grafik_range1($data['page'],$data);
 if($mode=='view'){
   $this->tampil($data);
   $action = $this->input->post('action');
   if($action == 'BtnProses') {
     $page = $this->input->post("page");
     $bln = $this->input->post("bln");
     $thn = $this->input->post("thn");
     redirect(base_url('admin_radiologi/'.$page.'/view/'.$bln.'/'.$thn));
   }
 }
 }
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("adminradiologi/header",$data);
	$this->load->view("adminradiologi/isi");
	$this->load->view("footer");
	$this->load->view("adminradiologi/jsload");
	$this->load->view("adminradiologi/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_top",$data);
	$this->load->view("adminradiologi/isi");
	$this->load->view("footer");
	$this->load->view("adminradiologi/jsload");
	$this->load->view("adminradiologi/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
