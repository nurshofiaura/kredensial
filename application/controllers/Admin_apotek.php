<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Admin_apotek extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
		  		$this->load->model('m_ol_rancak');
          $this->load->model('m_admin_apotek');
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
  function developer_kah(){
      if ( $this->session->has_userdata('bekerja') && $this->session->userdata('bekerja') > 0 )
          $this->cek_online_kah();
      else
				$this->session->set_flashdata('danger', 'Harap Login Dengan Instansi');
				redirect(base_url('member'));      
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
      $this->developer_kah();
  }
  function index(){
    $data['page']="home";
	$data['header'] = "BERANDA";
	$data['title'] = "BERANDA";
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
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
  function pabrik($mode='view')
  {
		$data['page']  = "pabrik";
		$data['header'] = "DATA PABRIK";
		$data['title'] = "DATA PABRIK";
		$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
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
		echo json_encode($this->m_admin_apotek->pabrik_all());
		}
		else{
			$data['cmd_status'] = $this->m_rancak->cmd_status();
	    if($mode=='tambah'){
	      $data['page'] =  $data['page']."_tambah";
				$data['nama_pabrik']  = set_value('nama_pabrik',$this->input->post('nama_pabrik'));
				$data['kontak_pabrik']  = set_value('kontak_pabrik',$this->input->post('kontak_pabrik'));
				$data['alamat_pabrik']  = set_value('alamat_pabrik',$this->input->post('alamat_pabrik'));
				$data['kode_rekening']  = set_value('kode_rekening',$this->input->post('kode_rekening'));
				$data['status_pabrik']  = set_value('status_pabrik',$this->input->post('status_pabrik'));
				$this->load->view("admin_apotek/isi",$data);
	    }
	    if($mode=='simpan_tambah'){
			  if($this->m_admin_apotek->simpan_pabrik()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('admin_apotek/pabrik'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('admin_apotek/pabrik'));
			  }
	    }
	    if($mode=='edit'){
	      $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('apt_pabrik','id_pabrik',$data['id']);
				$data['nama_pabrik']  = set_value('nama_pabrik',$keuangan["nama_pabrik"]);
				$data['kontak_pabrik']  = set_value('kontak_pabrik',$keuangan["kontak_pabrik"]);
				$data['alamat_pabrik']  = set_value('alamat_pabrik',$keuangan["alamat_pabrik"]);
				$data['kode_rekening']  = set_value('kode_rekening',$keuangan["kode_rekening"]);
				$data['status_pabrik']  = set_value('status_pabrik',$keuangan["status_pabrik"]);
				$this->load->view("admin_apotek/isi",$data);
	    }
	    if($mode=='simpan_edit'){
			  if($this->m_admin_apotek->edit_pabrik()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
					redirect(base_url('admin_apotek/pabrik'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
					redirect(base_url('admin_apotek/pabrik'));
		  	}
	    }
		}
  }
  function supplier($mode='view')
  {
		$data['page']  = "supplier";
		$data['header'] = "DATA SUPPLIER";
		$data['title'] = "DATA SUPPLIER";
		$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
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
		echo json_encode($this->m_admin_apotek->supplier_all());
		}
		else{
			$data['cmd_status'] = $this->m_rancak->cmd_status();
	    if($mode=='tambah'){
	      $data['page'] =  $data['page']."_tambah";
				$data['nama_supplier']  = set_value('nama_supplier',$this->input->post('nama_supplier'));
				$data['kontak_supplier']  = set_value('kontak_supplier',$this->input->post('kontak_supplier'));
				$data['alamat_supplier']  = set_value('alamat_supplier',$this->input->post('alamat_supplier'));
				$data['status_supplier']  = set_value('status_supplier',$this->input->post('status_supplier'));
				$this->load->view("admin_apotek/isi",$data);
	    }
	    if($mode=='simpan_tambah'){
			  if($this->m_admin_apotek->simpan_supplier()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('admin_apotek/supplier'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('admin_apotek/supplier'));
			  }
	    }
	    if($mode=='edit'){
	      $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('apt_supplier','id_supplier',$data['id']);
				$data['nama_supplier']  = set_value('nama_supplier',$keuangan["nama_supplier"]);
				$data['kontak_supplier']  = set_value('kontak_supplier',$keuangan["kontak_supplier"]);
				$data['alamat_supplier']  = set_value('alamat_supplier',$keuangan["alamat_supplier"]);
				$data['status_supplier']  = set_value('status_supplier',$keuangan["status_supplier"]);
				$this->load->view("admin_apotek/isi",$data);
	    }
	    if($mode=='simpan_edit'){
			  if($this->m_admin_apotek->edit_supplier()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
					redirect(base_url('admin_apotek/supplier'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
					redirect(base_url('admin_apotek/supplier'));
		  	}
	    }
		}
  }
  function customer($mode='view')
  {
		$data['page']  = "customer";
		$data['header'] = "DATA CUSTOMER";
		$data['title'] = "DATA CUSTOMER";
		$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
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
		echo json_encode($this->m_admin_apotek->customer_all());
		}
		else{
			$data['cmd_status'] = $this->m_rancak->cmd_status();
	    if($mode=='tambah'){
	      $data['page'] =  $data['page']."_tambah";
				$data['nama_customer']  = set_value('nama_customer',$this->input->post('nama_customer'));
				$data['kontak_customer']  = set_value('kontak_customer',$this->input->post('kontak_customer'));
				$data['alamat_customer']  = set_value('alamat_customer',$this->input->post('alamat_customer'));
				$data['status_customer']  = set_value('status_customer',$this->input->post('status_customer'));
				$this->load->view("admin_apotek/isi",$data);
	    }
	    if($mode=='simpan_tambah'){
			  if($this->m_admin_apotek->simpan_customer()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('admin_apotek/customer'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('admin_apotek/customer'));
			  }
	    }
	    if($mode=='edit'){
	      $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('apt_customer','id_customer',$data['id']);
				$data['nama_customer']  = set_value('nama_customer',$keuangan["nama_customer"]);
				$data['kontak_customer']  = set_value('kontak_customer',$keuangan["kontak_customer"]);
				$data['alamat_customer']  = set_value('alamat_customer',$keuangan["alamat_customer"]);
				$data['status_customer']  = set_value('status_customer',$keuangan["status_customer"]);
				$this->load->view("admin_apotek/isi",$data);
	    }
	    if($mode=='simpan_edit'){
			  if($this->m_admin_apotek->edit_customer()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
					redirect(base_url('admin_apotek/customer'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
					redirect(base_url('admin_apotek/customer'));
		  	}
	    }
		}
  }
  function termin($mode='view')
  {
		$data['page']  = "termin";
		$data['header'] = "DATA TERMIN PEMBAYARAN";
		$data['title'] = "DATA TERMIN PEMBAYARAN";
		$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
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
		echo json_encode($this->m_admin_apotek->termin_all());
		}
		else{
			$data['cmd_status'] = $this->m_rancak->cmd_status();
	    if($mode=='tambah'){
	      $data['page'] =  $data['page']."_tambah";
				$data['nama_termin']  = set_value('nama_termin',$this->input->post('nama_termin'));
				$data['tempo_termin']  = set_value('tempo_termin',$this->input->post('tempo_termin'));
				$data['ket_termin']  = set_value('ket_termin',$this->input->post('ket_termin'));
				$data['status_termin']  = set_value('status_termin',$this->input->post('status_termin'));
				$this->load->view("admin_apotek/isi",$data);
	    }
	    if($mode=='simpan_tambah'){
			  if($this->m_admin_apotek->simpan_termin()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('admin_apotek/termin'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('admin_apotek/termin'));
			  }
	    }
	    if($mode=='edit'){
	      $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('kol_termin','id_termin',$data['id']);
				$data['nama_termin']  = set_value('nama_termin',$keuangan["nama_termin"]);
				$data['tempo_termin']  = set_value('tempo_termin',$keuangan["tempo_termin"]);
				$data['ket_termin']  = set_value('ket_termin',$keuangan["ket_termin"]);
				$data['status_termin']  = set_value('status_termin',$keuangan["status_termin"]);
				$this->load->view("admin_apotek/isi",$data);
	    }
	    if($mode=='simpan_edit'){
			  if($this->m_admin_apotek->edit_termin()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
					redirect(base_url('admin_apotek/termin'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
					redirect(base_url('admin_apotek/termin'));
		  	}
	    }
		}
  }
  function barang($mode='view')
  {
		$data['page']  = "barang";
		$data['header'] = "DATA BARANG";
		$data['title'] = "DATA BARANG";
		$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
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
		echo json_encode($this->m_admin_apotek->barang_all());
		}
		else{
			$data['cmd_status'] = $this->m_rancak->cmd_status();
			$data['item_kategori'] = $this->m_ol_rancak->item_kategori();
			$data['apt_supplier'] = $this->m_rancak->apt_supplier();
//			$data['jenis_barang'] = $this->m_ol_rancak->jenis_barang();
	    if($mode=='tambah'){
	      $data['page'] =  $data['page']."_tambah";
				$data['nama_barang']  = set_value('nama_barang',$this->input->post('nama_barang'));
				$data['status_barang']  = set_value('status_barang',$this->input->post('status_barang'));
				$data['id_item_kategori']  = set_value('id_item_kategori',$this->input->post('id_item_kategori'));
				$this->load->view("admin_apotek/isi",$data);
	    }
	    if($mode=='simpan_tambah'){
			  if($this->m_admin_apotek->simpan_barang()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('admin_apotek/barang'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('admin_apotek/barang'));
			  }
	    }
	    if($mode=='edit'){
	      $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('apt_barang','id_barang',$data['id']);
				$data['nama_barang']  = set_value('nama_barang',$keuangan["nama_barang"]);
				$data['status_barang']  = set_value('status_barang',$keuangan["status_barang"]);
				$data['id_item_kategori']  = set_value('id_item_kategori',$keuangan["id_item_kategori"]);
				$this->load->view("admin_apotek/isi",$data);
	    }
	    if($mode=='simpan_edit'){
			  if($this->m_admin_apotek->edit_barang()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
					redirect(base_url('admin_apotek/barang'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
					redirect(base_url('admin_apotek/barang'));
		  	}
	    }
		}
  }
 // ================================================ ORDER BELI ==================================
  function data_barang()
  {
		$dt=$this->m_ol_rancak->ambil_barang(0);
		$data = array();
		foreach($dt as $row){
		$data[] = array("id"=>$row['id_barang'], "text"=>$row['nama_barang']);
		}
		echo json_encode($data);
  }
  function data_satuan()
  {
		$dt=$this->m_ol_rancak->ambil_satuan();
		$data = array();
		foreach($dt as $row){
			$data[] = array("id"=>$row['id_satuan'], "text"=>$row['nama_satuan']);
		}
		echo json_encode($data);
  }
  function data_pabrik()
  {
		$dt=$this->m_ol_rancak->ambil_pabrik();
		$data = array();
		foreach($dt as $row){
			$data[] = array("id"=>$row['id_pabrik'], "text"=>$row['nama_pabrik']);
		}
		echo json_encode($data);
  }
  function pembelian($mode='view')
  {
		$data['page']  = "pembelian";
		$data['header'] = "DATA PEMBELIAN";
		$data['title'] = "DATA PEMBELIAN";
		$data['link_kembali'] = base_url('admin_apotek/pembelian');
		$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
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
		$date   = $this->uri->segment(4, 0);
		$first_date   = $this->uri->segment(5, 0);
		$last_date   = $this->uri->segment(6, 0);
		if(empty($date)){
			$data['date']   = "0";
		}else{
			$data['date']   = $this->uri->segment(4, 0);
		}
		if(empty($first_date)){
			$data['first_date']   = "01-".date('m-Y');
		}else{
			$data['first_date']   = $this->uri->segment(5, 0);
		}
		if(empty($last_date)){
			$data['last_date']   = date('d-m-Y');
		}else{
			$data['last_date']   = $this->uri->segment(6, 0);
		}
		$data['dates']= array('0'=>'SEMUA DATA','1'=>'DATA PADA RANGE TANGGAL');
		$data['persen']= array('0'=>'Rupiah','1'=>'Persen');
    if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$date = $this->input->post("date");
			$first_date = $this->input->post("first_date");
			$last_date = $this->input->post("last_date");
			redirect(base_url('admin_apotek/pembelian/view/'.$date.'/'.$first_date.'/'.$last_date));
		}
	}
    else if($mode=='data'){
		echo json_encode($this->m_admin_apotek->order_beli_all($date,$first_date,$last_date,'All'));
	}
    else if($mode=='data2'){
		echo json_encode($this->m_admin_apotek->pembelian_detil_all($date));
	}
  else if($mode=='hapus'){ //id_pembelian_detil = $date - barcode_pembelian_detil = $first_date - barcode_pembelian = $last_date
		$kondisi=array('id_pembelian_detil'=>$date);
		$pmbdtl = $this->m_umum->ambil_data_kondisi('apt_pembelian_detil',$kondisi);
		$kondisi2=array('barcode_pembelian'=>$last_date);
		$pmb = $this->m_umum->ambil_data_kondisi('apt_pembelian',$kondisi2);
		if($pmb['status_pembelian'] == 0){
		  if($this->m_admin_apotek->edit_apt_stok_hapus($first_date,$date)){
		  	$this->m_admin_apotek->edit_pembelian_dari_detil_hapus($last_date);
		  	$this->m_umum->hapus_data('apt_pembelian_detil','id_pembelian_detil',$date);
				$this->session->set_flashdata('sukses', 'Data berhasil Di Hapus');
				redirect(base_url('admin_apotek/pembelian/edit/'.$last_date));
		  }else{
				$this->session->set_flashdata('danger', 'Ada Masalah Hapus Data');
				redirect(base_url('admin_apotek/pembelian/edit/'.$last_date));
		  }
		}else{
									$this->session->set_flashdata('danger', 'Data Sudah Selesai');
									redirect(base_url('admin_apotek/pembelian'));		
		}
  }
	else{
			$data['cmd_supplier']=$this->m_rancak->apt_supplier();
			$data['cmd_termin']=$this->m_rancak->cmd_termin();
			$data['cmd_pajak']=$this->m_rancak->cmd_pajak();
	    if($mode=='tambah'){
	      $data['page'] =  $data['page']."_tambah";
        $data['tgl_pembelian']  = set_value('tgl_pembelian',date('d-m-Y'));
				$data['id_supplier']  = set_value('id_supplier',$this->input->post('id_supplier'));
				$data['id_termin']  = set_value('id_termin',$this->input->post('id_termin'));
				$data['no_pembelian']  = set_value('no_pembelian',$this->input->post('no_pembelian'));
				$data['cp']  = set_value('cp',$this->input->post('cp'));
				$data['alamat_cp']  = set_value('alamat_cp',$this->input->post('alamat_cp'));
				$data['ket_pembelian']  = set_value('ket_pembelian',$this->input->post('ket_pembelian'));
				$this->load->view("admin_apotek/isi",$data);
	    }
	    if($mode=='simpan_tambah'){
			  if($id = $this->m_admin_apotek->simpan_pembelian()){
			  	$idp = $this->m_umum->ambil_data('apt_pembelian','barcode_pembelian',$id);
			  	$sup = $this->m_umum->ambil_data('apt_supplier','id_supplier',$idp['id_supplier']);
			  	$term = $this->m_umum->ambil_data('kol_termin','id_termin',$idp['id_termin']);
			  	$ket = "Simpan dari admin apotek tambah pembelian no barcode ".$id;
			  	$this->m_admin_apotek->simpan_tmp_simpan_pembelian($idp['id_pembelian'],$sup['nama_supplier'],$term['nama_termin'],$ket);
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('admin_apotek/pembelian/edit/'.$id));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('admin_apotek/pembelian'));
			  }
	    }
	    if($mode=='jual'){
	      $data['page'] =  $data['page']."_jual";
					$kondisi=array('barcode_pembelian_detil'=>$date);
					$ob = $this->m_umum->ambil_data_kondisi('apt_stok',$kondisi);
					$data['harga_jual'] = number_format($ob["harga_jual"],0);
				$this->load->view("admin_apotek/isi",$data);
	    }
	    if($mode=='simpan_jual'){
	    	$barcode_pembelian = $this->input->post('barcode_pembelian');
				$kondisi2=array('barcode_pembelian'=>$barcode_pembelian);
				$pmb = $this->m_umum->ambil_data_kondisi('apt_pembelian',$kondisi2);
				if($pmb['status_pembelian'] == 0){
				  if($this->m_admin_apotek->edit_harga_jual_stok()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('admin_apotek/pembelian/edit/'.$barcode_pembelian));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
						redirect(base_url('admin_apotek/pembelian'));
				  }
				}else{
									$this->session->set_flashdata('danger', 'Data Sudah Selesai');
									redirect(base_url('admin_apotek/pembelian'));			
				}
	    }
	    if($mode=='diskon'){
	      $data['page'] =  $data['page']."_diskon";
				$kondisi=array('barcode_pembelian'=>$date);
				$ob = $this->m_umum->ambil_data_kondisi('apt_pembelian',$kondisi);
				$data['barcode_pembelian'] = $ob["barcode_pembelian"];
				$data['id_pembelian'] = $ob["id_pembelian"];
				$data['diskon_pembelian'] = number_format($ob["diskon_pembelian"],0);
				$data['persen_pembelian'] = $ob["persen_pembelian"];
				$this->load->view("admin_apotek/isi",$data);
	    }
	    if($mode=='simpan_diskon'){
	    	$barcode_pembelian = $this->input->post('barcode_pembelian');
				$kondisi2=array('barcode_pembelian'=>$barcode_pembelian);
				$pmb = $this->m_umum->ambil_data_kondisi('apt_pembelian',$kondisi2);
				if($pmb['status_pembelian'] == 0){
				  if($this->m_admin_apotek->edit_diskon_pembelian()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('admin_apotek/pembelian/edit/'.$barcode_pembelian));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
						redirect(base_url('admin_apotek/pembelian'));
				  }
				}else{
									$this->session->set_flashdata('danger', 'Data Sudah Selesai');
									redirect(base_url('admin_apotek/pembelian'));			
				}
	    }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$kondisi=array('barcode_pembelian'=>$date);
				$jml = $this->m_umum->jumlah_record_filter('apt_pembelian',$kondisi);
				if(empty($date) || $jml == 0){
					$this->session->set_flashdata('danger', 'Data Tidak Ada');
					redirect(base_url('admin_apotek/pembelian'));
				}
				$ob = $this->m_umum->ambil_data_kondisi('apt_pembelian',$kondisi);
				$data['ambil_temp_ob_detil']=$this->m_admin_apotek->ambil_temp_ob_detil($ob["id_pembelian"]);
				if ($ob["persen_pembelian"] == 0) {
					$percentase = $ob["diskon_pembelian"];		
				}else{
					$percentase = $ob["subtotal_pembelian"] * $ob["diskon_pembelian"]/100;
				}
				$sub_total = $ob["subtotal_pembelian"] - $percentase;
				$data['sub_total'] = number_format($sub_total,0);
				if ($ob["pajak"] == 0) { 
					$pajak = 0;
					$data["ppn_pembelian"] = $pajak;
					$data["ttotal"] = number_format($sub_total,0);
					$data["total_pembelian"] = number_format($sub_total,0);
				}else if($ob["pajak"] == 2) {  //$ob["pajak"] tpph22 = Math.floor((tpph22*100)/100);
					$dpp = $sub_total * 100/110;			
					$pajak = 10/100 * $dpp;			
					$data["ppn_pembelian"] = number_format($pajak,0);
					$data["total_pembelian"] = number_format($pajak + $sub_total,0);
					$data["ttotal"] = number_format($pajak + $sub_total,0);
				}else{
					$pajak = $sub_total * 10/100;
					$ttotal = $sub_total + $pajak;
					$data["ppn_pembelian"] = number_format($pajak,0);
					$data["ttotal"] = number_format($ttotal,0);
					$data["total_pembelian"] = number_format($sub_total,0);			
				}
				$data['tgl_pembelian'] = date('d-m-Y', strtotime($ob["tgl_pembelian"]));
				$data['barcode_pembelian'] = $ob["barcode_pembelian"];
				$data['id_pembelian'] = $ob["id_pembelian"];
				$data['no_pembelian'] = $ob["no_pembelian"];
				$data['id_supplier'] = $ob["id_supplier"];
				$data['ket_pembelian'] = $ob["ket_pembelian"];
				$data['cp'] = $ob["cp"];
				$data['alamat_cp'] = $ob["alamat_cp"];
				$data['id_termin'] = $ob["id_termin"];
				$data['pajak'] = $ob["pajak"];
				$data['status_pembelian'] = $ob["status_pembelian"];
				$data['diskon_pembelian'] = number_format($ob["diskon_pembelian"]);
				$data['persen_pembelian'] = number_format($ob["persen_pembelian"]);
				$data['subtotal_pembelian'] = number_format($ob["subtotal_pembelian"]);
				$data['id_pabrik']  = set_value('id_pabrik',$this->input->post("id_pabrik"));
				$data['id_barang']  = set_value('id_barang',$this->input->post("id_barang"));
				$data['jml_pembelian_detil']  = set_value('jml_pembelian_detil','0');
				$data['ket_pembelian_detil']  = set_value('ket_pembelian_detil',$this->input->post("ket_pembelian_detil"));
				$data['satuan_besar']  = set_value('satuan_besar',$this->input->post("satuan_besar"));
				$data['satuan_kecil']  = set_value('satuan_kecil',$this->input->post("satuan_kecil"));
				$data['konversi']  = set_value('konversi','0');
				$data['harga_pembelian_detil']  = set_value('harga_pembelian_detil','0');
				$data['diskon_pembelian_detil']  = set_value('diskon_pembelian_detil','0');
				$data['persen_pembelian_detil']  = set_value('persen_pembelian_detil','0');
				$data['total_pembelian_detil']  = set_value('total_pembelian_detil','0');
				$data['subdiskon']  = set_value('subdiskon','0');
				$data['totpph']  = set_value('totpph','0');
				$data['tgl_expired']  = set_value('tgl_expired',date('d-m-Y'));
				$this->form_validation->set_rules('no_pembelian','no_pembelian','required');
	      if ($this->form_validation->run() === FALSE){
						$this->tampil_top($data);
      	}else{
						$action = $this->input->post('action');
						if($action == 'BtnTambah') {
						$id_barang = $this->input->post("id_barang");
						$id_pabrik = $this->input->post("id_pabrik");
						$satuan_besar = $this->input->post("satuan_besar");
						$satuan_kecil = $this->input->post("satuan_kecil");
						$jml_pembelian_detil = $this->input->post("jml_pembelian_detil");
						$harga_pembelian_detil = $this->input->post("harga_pembelian_detil");
						if(empty($id_barang) || empty($satuan_besar) || empty($satuan_kecil) || empty($id_pabrik) || $jml_pembelian_detil == 0 ||  $harga_pembelian_detil == 0){
							$this->session->set_flashdata('danger', 'Mohon Lengkapi Data Barang, Satuan, Qty dan Harga');
							redirect(base_url('admin_apotek/pembelian/edit/'.$date));
						}else{
							$barcode_pembelian = $this->input->post('barcode_pembelian');
							$kondisi2=array('barcode_pembelian'=>$barcode_pembelian);
							$pmb = $this->m_umum->ambil_data_kondisi('apt_pembelian',$kondisi2);
							if($pmb['status_pembelian'] == 0){
							  if($last = $this->m_admin_apotek->simpan_pembelian_detil($barcode_pembelian)){
							  		$this->m_admin_apotek->edit_pembelian2();
										$kondisi=array('id_pembelian_detil'=>$last);
										$pmb = $this->m_umum->ambil_data_kondisi('apt_pembelian_detil',$kondisi);
										$kondisi_st = array('barcode_pembelian_detil'=>$pmb['barcode_pembelian_detil']);
										$jml = $this->m_umum->jumlah_record_filter('apt_stok',$kondisi_st);
										if($jml == 0){
											$this->m_admin_apotek->simpan_apt_stok($pmb['barcode_pembelian_detil']);
										}else{
											$this->m_admin_apotek->edit_apt_stok($pmb['barcode_pembelian_detil']);
										}
									$this->session->set_flashdata('sukses', 'Barang berhasil Di Tambah');
									redirect(base_url('admin_apotek/pembelian/edit/'.$barcode_pembelian));
							  }else{
									$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data');
									redirect(base_url('admin_apotek/pembelian/edit/'.$barcode_pembelian));
							  }
							}else{
									$this->session->set_flashdata('danger', 'Data Sudah Selesai');
									redirect(base_url('admin_apotek/pembelian'));
							}
						}
					}
					if($action == 'BtnSave') {
							$barcode_pembelian = $this->input->post('barcode_pembelian');
							$kondisi2=array('barcode_pembelian'=>$barcode_pembelian);
							$pmb = $this->m_umum->ambil_data_kondisi('apt_pembelian',$kondisi2);
							if($pmb['status_pembelian'] == 0){
							  if($this->m_admin_apotek->edit_pembelian()){
									$this->session->set_flashdata('sukses', 'Barang berhasil Di Tambah');
									redirect(base_url('admin_apotek/pembelian/edit/'.$barcode_pembelian));
							  }else{
									$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data');
									redirect(base_url('admin_apotek/pembelian/edit/'.$barcode_pembelian));
							  }
							}else{
									$this->session->set_flashdata('danger', 'Data Sudah Selesai');
									redirect(base_url('admin_apotek/pembelian'));
							}
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
	$this->load->view("admin_apotek/header",$data);
	$this->load->view("admin_apotek/isi");
	$this->load->view("footer");
	$this->load->view("admin_apotek/jsload");
	$this->load->view("admin_apotek/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_topol",$data);
	$this->load->view("admin_apotek/isi");
	$this->load->view("footer");
	$this->load->view("admin_apotek/jsload");
	$this->load->view("admin_apotek/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
