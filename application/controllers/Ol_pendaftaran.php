<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');
// ALTER TABLE `ol_user` ADD `status_asesor` TINYINT UNSIGNED NOT NULL DEFAULT '0' AFTER `status_user`;
class Ol_pendaftaran extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
          $this->load->model('m_ol_rancak');
          $this->load->model('m_ol_pendaftaran');
          $this->load->model('m_auth');
          $this->m_auth->ol_enabled();
  }
	function index(){
		$this->pendaftaran();
	}
  function kategori($mode='view'){
    $data['page']="kategori"; 
    $data['header'] = "DATA KATEGORI TINDAKAN / PEMERIKSAAN";
    $data['title'] = "DATA KATEGORI TINDAKAN / PEMERIKSAAN";
    $data['link_awal'] = base_url('instansi_user');
    $data['link_kembali'] = base_url('ol_pendaftaran/pendaftaran');
    $data['link_1'] = base_url('ol_pendaftaran/kategori');
    $data['link_2'] = base_url('ol_pendaftaran/tindakan');
    $data['link_3'] = base_url('ol_pendaftaran/pendaftaran/master');
    $pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
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
    $data['id']   = $this->uri->segment(4, 0);
    //======================= IMPORTANT =========================================
    if($mode=='view'){
      $this->tampil_top($data);
    }
    else if($mode=='data'){
      echo json_encode($this->m_ol_pendaftaran->golongan_pemeriksaan_all());
    }
    else{
      $data['cmd_status']=$this->m_rancak->cmd_status();
      $data['cmd_unit'] = $this->m_ol_rancak->ambil_data_unit_no_null();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
        $data['id_unit']  = set_value('id_unit',$this->input->post('id_unit'));
        $data['id_golongan_pemeriksaan']  = set_value('id_golongan_pemeriksaan',$this->input->post('id_golongan_pemeriksaan'));
        $data['nama_golongan_pemeriksaan']  = set_value('nama_golongan_pemeriksaan',$this->input->post('nama_golongan_pemeriksaan'));
        $data['status_golongan_pemeriksaan']  = set_value('status_golongan_pemeriksaan',$this->input->post('status_golongan_pemeriksaan'));
        $data['tarif']  = set_value('tarif',$this->input->post('tarif'));
        $this->load->view("ol_pendaftaran/isi",$data);
      }
      if($mode=='simpan_tambah'){
        if($Q = $this->m_ol_pendaftaran->simpan_kategori()){
          $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
          redirect(base_url('ol_pendaftaran/kategori'));
        }else{
          $this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
          redirect(base_url('ol_pendaftaran/kategori'));
        }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
        $keuangan    = $this->m_umum->ambil_data('kol_golongan_pemeriksaan','id_golongan_pemeriksaan',$data['id']);
        $data['id_golongan_pemeriksaan']  = set_value('id_golongan_pemeriksaan',$keuangan["id_golongan_pemeriksaan"]);
        $data['id_unit']  = set_value('id_unit',$keuangan["id_unit"]);
        $data['nama_golongan_pemeriksaan']  = set_value('nama_golongan_pemeriksaan',$keuangan["nama_golongan_pemeriksaan"]);
        $data['status_golongan_pemeriksaan']  = set_value('status_golongan_pemeriksaan',$keuangan["status_golongan_pemeriksaan"]);
        $this->load->view("ol_pendaftaran/isi",$data);
      }
      if($mode=='simpan_edit'){
          $id_tindakan = $this->input->post("id_tindakan");
          if($this->m_ol_pendaftaran->edit_kategori()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
            redirect(base_url('ol_pendaftaran/kategori'));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
            redirect(base_url('ol_pendaftaran/kategori'));
          }
      }
    }
  }
	function tindakan($mode='view'){
		$data['page']="tindakan"; 
    $data['header'] = "DATA TINDAKAN / PEMERIKSAAN";
    $data['title'] = "DATA TINDAKAN / PEMERIKSAAN";
		$data['link_awal'] = base_url('instansi_user');
    $data['link_kembali'] = base_url('ol_pendaftaran/pendaftaran');
    $data['link_1'] = base_url('ol_pendaftaran/kategori');
    $data['link_2'] = base_url('ol_pendaftaran/tindakan');
    $data['link_3'] = base_url('ol_pendaftaran/pendaftaran/master');
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
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
		$data['id']   = $this->uri->segment(4, 0);
		//======================= IMPORTANT =========================================
		if($mode=='view'){
		  $this->tampil_top($data);
		}
    else if($mode=='data'){
			echo json_encode($this->m_ol_pendaftaran->tindakan_all());
		}
		else{
      $data['cmd_status']=$this->m_rancak->cmd_status();
      $data['cmd_golongan'] = $this->m_ol_rancak->ambil_golongan_pemeriksaan();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
        $data['id_kewenangan']  = set_value('id_kewenangan',$this->input->post('id_kewenangan'));
        $data['id_golongan_pemeriksaan']  = set_value('id_golongan_pemeriksaan',$this->input->post('id_golongan_pemeriksaan'));
        $data['nama_tindakan']  = set_value('nama_tindakan',$this->input->post('nama_tindakan'));
        $data['status_tindakan']  = set_value('status_tindakan',$this->input->post('status_tindakan'));
        $data['tarif']  = set_value('tarif',$this->input->post('tarif'));
        $this->load->view("ol_pendaftaran/isi",$data);
      }
      if($mode=='simpan_tambah'){
        if($Q = $this->m_ol_pendaftaran->simpan_tindakan()){
          $this->m_ol_pendaftaran->cek_tarif($Q);
          $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
          redirect(base_url('ol_pendaftaran/tindakan'));
        }else{
          $this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
          redirect(base_url('ol_pendaftaran/tindakan'));
        }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
        $keuangan    = $this->m_umum->ambil_data('tindakan','id_tindakan',$data['id']);
        $data['id_tindakan']  = set_value('id_tindakan',$keuangan["id_tindakan"]);
        $data['id_kewenangan']  = set_value('id_kewenangan',$keuangan["id_kewenangan"]);
        $data['id_golongan_pemeriksaan']  = set_value('id_golongan_pemeriksaan',$keuangan["id_golongan_pemeriksaan"]);
        $data['nama_tindakan']  = set_value('nama_tindakan',$keuangan["nama_tindakan"]);
        $data['status_tindakan']  = set_value('status_tindakan',$keuangan["status_tindakan"]);
        $kondisi = array('id_tindakan'=>$data['id']);
        $jml = $this->m_umum->jumlah_record_filter('tindakan_tarif',$kondisi);
        if($jml == 0){
          $data['tarif']  = set_value('tarif','0');
        }else{
          $tarf = $this->m_umum->ambil_data('tindakan_tarif','id_tindakan',$data['id']);
          $data['tarif']  = set_value('tarif',number_format($tarf["tarif"]));
        }
        $this->load->view("ol_pendaftaran/isi",$data);
      }
      if($mode=='simpan_edit'){
          if($this->m_ol_pendaftaran->edit_tindakan()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
            redirect(base_url('ol_pendaftaran/tindakan'));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
            redirect(base_url('ol_pendaftaran/tindakan'));
          }
      }
		}
	}
  function pasien_cari_data(){
    $id=$this->input->get('query');
    $hasil=array();
    $data=$this->m_ol_rancak->cmd_pasien($id);
    $hasil['suggestions']=$data;
    echo json_encode($hasil);
  }
  function rm_cari_data(){
    $id=$this->input->get('query');
    $hasil=array();
    $data=$this->m_ol_rancak->cmd_rm($id);
    $hasil['suggestions']=$data;
    echo json_encode($hasil);
  }
  function fhasil_data($id)
  {
    $dt=$this->m_ol_pendaftaran->ambil_data_dropdown_fhasil($id);
    echo json_encode($dt);
  }
  function pendaftaran($mode='view'){
    $data['page']="pendaftaran"; 
    $data['header'] = "SISTEM INFORMASI PENDAFTARAN TINDAKAN / PEMERIKSAAN";
    $data['title'] = "DATA PENDAFTARAN TINDAKAN / PEMERIKSAAN";
    $data['link_kembali'] = base_url('ol_pendaftaran/pendaftaran');
    $data['link_1'] = base_url('ol_pendaftaran/kategori');
    $data['link_2'] = base_url('ol_pendaftaran/tindakan');
    $data['link_3'] = base_url('ol_pendaftaran/pendaftaran/master');
    $pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
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
    $data['id'] = $this->uri->segment(4, 0);
    $data['last_date'] = $this->uri->segment(5, 0);
    $trim_keyword   = urldecode(trim($this->uri->segment(6, 0)));
    if($mode=='view'){
    $replace_keyword   = preg_replace('/\s+/', ' ', $trim_keyword);
    $data['key'] = str_replace(' ', '-', $replace_keyword);
    if($data['key'] == NULL OR empty($data['key'])){
      $data['key'] = "";
    }
    if(empty($data['id'])){
      if($this->session->has_userdata('first_date_daftar_tindakan')){
        $data['id'] = $this->session->first_date_daftar_tindakan;
      }else{
        $data['id'] = date('d-m-Y');
      }
    }
    if(empty($data['last_date'])){
      if($this->session->has_userdata('last_date_daftar_tindakan')){
        $data['last_date'] = $this->session->last_date_daftar_tindakan;
      }else{
        $data['last_date'] = date('d-m-Y');
      }
    }
      $this->tampil_top($data);
      $action = $this->input->post('action');
      if($action == 'BtnProses') {
        $id = $this->input->post("id");
        $last_date = $this->input->post("last_date");
     //   $id = $this->input->post("id_tindakan");
        $data_user_level = array(
          'first_date_daftar_tindakan'     => $id,
          'last_date_daftar_tindakan'     => $last_date
        );  
        $this->session->set_userdata($data_user_level);
        $trim_keyword   = urldecode(trim($this->input->post("key")));
        $replace_keyword   = preg_replace('/\s+/', ' ', $trim_keyword);
        $key = str_replace(' ', '-', $replace_keyword);
        redirect(base_url('ol_pendaftaran/pendaftaran/view/'.$id.'/'.$last_date.'/'.$key));
      }
    }
    else if($mode=='data'){
      $key = urldecode(trim($this->uri->segment(6, 0)));
      $key = strtolower($key);
      $key = preg_replace('/[^A-Za-z0-9\-]/', '', $key);
      $key = str_replace(' ', '-', $key);
    echo json_encode($this->m_ol_pendaftaran->pendaftaran_all($data['id'],$data['last_date'],$key));
    }
    else{
      $data['cmd_status']=$this->m_rancak->cmd_status();
      $data['ambil_pemeriksaan'] = $this->m_ol_rancak->ambil_pemeriksaan();
      $data['ambil_unit_transaksi'] = $this->m_ol_rancak->ambil_unit_transaksi();
      $data['ambil_all_unit_ins'] = $this->m_ol_rancak->ambil_unit_nonull();
      $data['ambil_katbang'] = $this->m_ol_rancak->ambil_kategori_barang();
      $data['ambil_tinbang'] = $this->m_ol_rancak->ambil_tindakan_barang();
      $data['ambil_stok'] = $this->m_ol_rancak->ambil_stok_barang();
      $data['cmd_jk']    = $this->m_rancak->cmd_jk();
      $data['ope'] = $this->m_ol_rancak->ambil_data_tindakan_operator($data['id']);
      $data['tkeluar'] = $this->m_ol_rancak->ambil_data_barang_keluar($data['id']);
      $data['tkelengkapan'] = $this->m_ol_rancak->ambil_data_tindakan_kelengkapan($data['id']);
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
        $data['tgl_transaksi']  = set_value('tgl_transaksi',date('d-m-Y'));
        $data['tgl_lahir']  = set_value('tgl_lahir',date('d-m-Y'));
        $data['rm']  = set_value('rm',$this->input->post("rm"));
        $data['nama_pasien']  = set_value('nama_pasien',$this->input->post("nama_pasien"));
        $data['alamat']  = set_value('alamat',$this->input->post("alamat"));
        $data['jk']  = set_value('jk',$this->input->post("jk"));
        $data['no_transaksi']  = set_value('no_transaksi',$this->input->post("no_transaksi"));
        $data['unit_tindakan']  = set_value('unit_tindakan',$this->input->post("unit_tindakan"));
        $data['id_tindakan']  = set_value('id_tindakan',$this->input->post("id_tindakan"));
        $data['data_transaksi']  = set_value('data_transaksi',$this->input->post("data_transaksi"));
        $this->load->view("ol_pendaftaran/isi",$data);
      }
      if($mode=='simpan_tambah'){
        if($Q = $this->m_ol_pendaftaran->simpan_pendaftaran()){
          $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
          redirect(base_url('ol_pendaftaran/pendaftaran/isi/'.$Q));
        }else{
          $this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
          redirect(base_url('ol_pendaftaran/pendaftaran'));
        }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
        $d = $this->m_ol_pendaftaran->ambil_data_transaksi_pendaftaran($data['id']);
        $kondisi_cek = array('id_transaksi'=>$data['id'],'admin_transaksi'=>$this->session->barcode_pegawai);
        $data['cek'] = $this->m_umum->jumlah_record_filter('tindakan_transaksi',$kondisi_cek);
        $data['id_transaksi']  = set_value('id_transaksi',$d["id_transaksi"]);
        $data['tgl_transaksi']  = set_value('tgl_transaksi',date('d-m-Y', strtotime($d['tgl_transaksi'])));
        $data['no_transaksi']  = set_value('no_transaksi',$d["no_transaksi"]);
        $data['id_pasien']  = set_value('id_pasien',$d["id_pasien"]);
        $data['nama_pasien']  = set_value('nama_pasien',$d["nama_pasien"]);
        $data['rm']  = set_value('rm',$d["rm"]);
        $data['jk']  = set_value('jk',$d["jk"]);
        $data['tgl_lahir']  = set_value('tgl_lahir',date('d-m-Y', strtotime($d["tgl_lahir"])));
        $data['alamat']  = set_value('alamat',$d["alamat"]);
        $data['id_tindakan']  = set_value('id_tindakan',$d["id_tindakan"]);
        $data['nama_tindakan']  = set_value('nama_tindakan',$d["nama_tindakan"]);
        $data['nama_golongan_pemeriksaan']  = set_value('nama_golongan_pemeriksaan',$d["nama_golongan_pemeriksaan"]);
        $data['unit_tindakan']  = set_value('unit_tindakan',$d["unit_tindakan"]);
        $data['nama_unit']  = set_value('nama_unit',$d["nama_unit"]);
        $data['nama_working']  = set_value('nama_working',$d["nama_working"]);
        $data['data_transaksi']  = set_value('data_transaksi',$d["data_transaksi"]);
        $data['status_transaksi']  = set_value('status_transaksi',$d["status_transaksi"]);
        $data['harga_transaksi']  = set_value('harga_transaksi',number_format($d["harga_transaksi"]));
        $this->load->view("ol_pendaftaran/isi",$data);
      }
      if($mode=='simpan_edit'){
          if($this->m_ol_pendaftaran->edit_pendaftaran()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
            redirect(base_url('ol_pendaftaran/pendaftaran'));
          }else{
            $this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
            redirect(base_url('ol_pendaftaran/pendaftaran'));
          }
      }
      if($mode=='isi'){
        $data['page'] =  $data['page']."_isi";
        $d = $this->m_ol_pendaftaran->ambil_data_transaksi_pendaftaran($data['id']);
        $kondisi_jml = array('id_transaksi'=>$data['id']);
        $kondisi_cek = array('id_transaksi'=>$data['id'],'admin_transaksi'=>$this->session->barcode_pegawai);
        $data['jml'] = $this->m_umum->jumlah_record_filter('tindakan_transaksi',$kondisi_jml);
        $data['cek'] = $this->m_umum->jumlah_record_filter('tindakan_transaksi',$kondisi_cek);
        $ambil_row_pemeriksaan = $this->m_ol_rancak->ambil_row_pemeriksaan($d['id_tindakan']);
        $data['katbarang'] = $this->m_ol_rancak->ambil_data_tindakan_katbarang();
        $data['barang'] = $this->m_ol_rancak->ambil_data_tindakan_barang();
        $data['hasil'] = $this->m_ol_rancak->ambil_data_tindakan_hasil();
        if(empty($data['id'])){
          redirect(base_url('ol_pendaftaran/pendaftaran'));
        }
         if($data['jml'] == 0){
          redirect(base_url('ol_pendaftaran/pendaftaran'));
        }
        $data['id_transaksi']  = set_value('id_transaksi',$d["id_transaksi"]);
        $data['tgl_transaksi']  = set_value('tgl_transaksi',date('d-m-Y', strtotime($d['tgl_transaksi'])));
        $data['no_transaksi']  = set_value('no_transaksi',$d["no_transaksi"]);
        $data['id_pasien']  = set_value('id_pasien',$d["id_pasien"]);
        $data['nama_pasien']  = set_value('nama_pasien',$d["nama_pasien"]);
        $data['nama_unit']  = $d["nama_unit"].' - '.$d["nama_working"];
        $data['nama_tindakan']  = $ambil_row_pemeriksaan["nama_tindakan"];
        $data['rm']  = set_value('rm',$d["rm"]);
        if($d["jk"] == 0){
          $data["jk"] = "Perempuan";
        }else{
          $data["jk"] = "Laki-laki";
        }
        $data['tgl_lahir']  = set_value('tgl_lahir',date('d-m-Y', strtotime($d["tgl_lahir"])));
        $data['alamat']  = set_value('alamat',$d["alamat"]);
        $data['id_tindakan']  = set_value('id_tindakan',$d["id_tindakan"]);
     //   $data['nama_tindakan']  = set_value('nama_tindakan',$d["nama_tindakan"]);
        $data['nama_golongan_pemeriksaan']  = set_value('nama_golongan_pemeriksaan',$d["nama_golongan_pemeriksaan"]);
        $data['unit_tindakan']  = set_value('unit_tindakan',$d["unit_tindakan"]);
        $data['nama_unit']  = set_value('nama_unit',$d["nama_unit"]);
        $data['nama_working']  = set_value('nama_working',$d["nama_working"]);
    //    $data['data_transaksi']  = set_value('data_transaksi',$d["data_transaksi"]);
        $data_transaksi = strip_tags($d['data_transaksi']); 
        $data['data_transaksi'] = html_entity_decode($data_transaksi);
        $data['status_transaksi']  = set_value('status_transaksi',$d["status_transaksi"]);
        $data['harga_transaksi']  = set_value('harga_transaksi',number_format($d["harga_transaksi"]));
        $this->tampil_top($data);
        $action = $this->input->post('action');
        $id_transaksi = $this->input->post('id_transaksi');
        if($action == 'Btnsimpan') {
      //    $this->m_ol_pendaftaran->edit_pendaftaran();
          $this->session->set_flashdata('sukses', 'Data Sudah Di Simpan');
          redirect(base_url('ol_pendaftaran/pendaftaran/isi/'.$id_transaksi));
        }
      }
      if($mode=='master'){
        $data['page'] =  $data['page']."_master";
        $d = $this->m_ol_pendaftaran->ambil_data_transaksi_pendaftaran($data['id']);
        $kondisi_jml = array('id_transaksi'=>$data['id']);
        $kondisi_cek = array('id_transaksi'=>$data['id'],'admin_transaksi'=>$this->session->barcode_pegawai);
        $data['jml'] = $this->m_umum->jumlah_record_filter('tindakan_transaksi',$kondisi_jml);
        $data['cek'] = $this->m_umum->jumlah_record_filter('tindakan_transaksi',$kondisi_cek);
        $ambil_row_pemeriksaan = $this->m_ol_rancak->ambil_row_pemeriksaan($d['id_tindakan']);
        $data['katbarang'] = $this->m_ol_rancak->ambil_data_tindakan_katbarang();
        $data['barang'] = $this->m_ol_rancak->ambil_data_tindakan_barang();
        $data['hasil'] = $this->m_ol_rancak->ambil_data_tindakan_hasil();
        $this->tampil_top($data);
      }
      if($mode=='tambah_katbang'){
        $data['page'] =  $data['page']."_tambah_katbang";
        $data['title'] = "TAMBAH KATEGORI BARANG";
        $data['nama_kategori_barang']  = set_value('nama_kategori_barang',$this->input->post("nama_kategori_barang"));
        $data['id_unit']  = set_value('id_unit',$this->input->post("id_unit"));
        $data['status_kategori_barang']  = set_value('status_kategori_barang',$this->input->post("status_kategori_barang"));
        $this->load->view("ol_pendaftaran/isi",$data);
      }
      if($mode=='simpan_tambah_katbang'){
        $id_transaksi = $this->input->post('id_transaksi');
        if($this->m_ol_pendaftaran->simpan_kategori_barang()){
          $this->session->set_flashdata('sukses', 'Data Sudah Di Tambah');
          redirect(base_url('ol_pendaftaran/pendaftaran/master'));
        }else{
          $this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
          redirect(base_url('ol_pendaftaran/pendaftaran/master'));
        }
      }
      if($mode=='edit_katbang'){
        $data['page'] =  $data['page']."_edit_katbang";
        $data['title'] = "EDIT KATEGORI BARANG";
        $keuangan = $this->m_umum->ambil_data('tindakan_kategori_barang','id_kategori_barang',$data['last_date']);
        $data['id_kategori_barang']  = set_value('id_kategori_barang',$keuangan["id_kategori_barang"]);
        $data['nama_kategori_barang']  = set_value('nama_kategori_barang',$keuangan["nama_kategori_barang"]);
        $data['id_unit']  = set_value('id_unit',$keuangan["id_unit"]);
        $data['status_kategori_barang']  = set_value('status_kategori_barang',$keuangan["status_kategori_barang"]);
        $this->load->view("ol_pendaftaran/isi",$data);
      }
      if($mode=='simpan_edit_katbang'){
        $id_transaksi = $this->input->post('id_transaksi');
        if($this->m_ol_pendaftaran->rubah_kategori_barang()){
          $this->session->set_flashdata('sukses', 'Data Sudah Di Rubah');
          redirect(base_url('ol_pendaftaran/pendaftaran/master'));
        }else{
          $this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
          redirect(base_url('ol_pendaftaran/pendaftaran/master'));
        }
      }
      if($mode=='hapuskatbang'){
        $kondisi_jml = array('id_kategori_barang'=>$data['last_date']);
        $jml = $this->m_umum->jumlah_record_filter('tindakan_barang',$kondisi_jml);
        if($jml ==0){
          $brg = $this->m_umum->ambil_data('tindakan_kategori_barang','id_kategori_barang',$data['last_date']);
          if($brg['pembuat_kategori_barang'] == $this->session->barcode_pegawai){
            if($this->m_umum->hapus_data('tindakan_kategori_barang','id_kategori_barang',$data['last_date'])){
              $this->session->set_flashdata('sukses', 'Data Sudah Dihapus');
              redirect(base_url('ol_pendaftaran/pendaftaran/master'));
            }else{
              $this->session->set_flashdata('danger', 'Ada Masalah Hapus Data. Hubungi Admin');
              redirect(base_url('ol_pendaftaran/pendaftaran/master'));
            }
          }else{
            $this->session->set_flashdata('danger', 'Maaf Harus Dihapus oleh Pembuatnya');
            redirect(base_url('ol_pendaftaran/pendaftaran/master'));             
          }
        }else{
          $this->session->set_flashdata('danger', 'Data Sudah Masuk Data Barang');
          redirect(base_url('ol_pendaftaran/pendaftaran/master'));          
        }
      }
      if($mode=='tambah_bang'){
        $data['page'] =  $data['page']."_tambah_bang";
        $data['title'] = "TAMBAH BARANG";
        $data['nama_barang']  = set_value('nama_barang',$this->input->post("nama_barang"));
        $data['id_kategori_barang']  = set_value('id_kategori_barang',$this->input->post("id_kategori_barang"));
        $data['satuan_barang']  = set_value('satuan_barang',$this->input->post("satuan_barang"));
        $data['status_barang']  = set_value('status_barang',$this->input->post("status_barang"));
        $this->load->view("ol_pendaftaran/isi",$data);
      }
      if($mode=='simpan_tambah_bang'){
        $id_transaksi = $this->input->post('id_transaksi');
        if($this->m_ol_pendaftaran->simpan_barang()){
          $this->session->set_flashdata('sukses', 'Data Sudah Di Tambah');
          redirect(base_url('ol_pendaftaran/pendaftaran/master'));
        }else{
          $this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
          redirect(base_url('ol_pendaftaran/pendaftaran/master'));
        }
      }
      if($mode=='edit_bang'){
        $data['page'] =  $data['page']."_edit_bang";
        $data['title'] = "EDIT BARANG";
        $keuangan = $this->m_umum->ambil_data('tindakan_barang','id_barang',$data['last_date']);
        $data['id_barang']  = set_value('id_barang',$keuangan["id_barang"]);
        $data['nama_barang']  = set_value('nama_barang',$keuangan["nama_barang"]);
        $data['id_kategori_barang']  = set_value('id_kategori_barang',$keuangan["id_kategori_barang"]);
        $data['satuan_barang']  = set_value('satuan_barang',$keuangan["satuan_barang"]);
        $data['status_barang']  = set_value('status_barang',$keuangan["status_barang"]);
        $this->load->view("ol_pendaftaran/isi",$data);
      }
      if($mode=='simpan_edit_bang'){
        $id_transaksi = $this->input->post('id_transaksi');
        if($this->m_ol_pendaftaran->rubah_barang()){
          $this->session->set_flashdata('sukses', 'Data Sudah Di Rubah');
          redirect(base_url('ol_pendaftaran/pendaftaran/master'));
        }else{
          $this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
          redirect(base_url('ol_pendaftaran/pendaftaran/master'));
        }
      }
      if($mode=='hapusbang'){
        $kondisi_jml = array('id_barang'=>$data['last_date']);
        $jml = $this->m_umum->jumlah_record_filter('tindakan_stok',$kondisi_jml);
        if($jml ==0){
          $brg = $this->m_umum->ambil_data('tindakan_barang','id_barang',$data['last_date']);
          if($brg['pembuat_barang'] == $this->session->barcode_pegawai){
            if($this->m_umum->hapus_data('tindakan_barang','id_barang',$data['last_date'])){
              $this->session->set_flashdata('sukses', 'Data Sudah Dihapus');
              redirect(base_url('ol_pendaftaran/pendaftaran/master'));
            }else{
              $this->session->set_flashdata('danger', 'Ada Masalah Hapus Data. Hubungi Admin');
              redirect(base_url('ol_pendaftaran/pendaftaran/master'));
            }
          }else{
            $this->session->set_flashdata('danger', 'Maaf Harus Dihapus oleh Pembuatnya');
            redirect(base_url('ol_pendaftaran/pendaftaran/master'));             
          }
        }else{
          $this->session->set_flashdata('danger', 'Data Sudah Masuk Stok Barang');
          redirect(base_url('ol_pendaftaran/pendaftaran/master'));          
        }
      }
      if($mode=='tambah_stok'){
        $data['page'] =  $data['page']."_tambah_stok";
        $data['title'] = "TAMBAH STOK BARANG";
        $data['id_barang']  = set_value('id_barang',$this->input->post("id_barang"));
        $data['jml_stok']  = set_value('jml_stok',$this->input->post("jml_stok"));
        $this->load->view("ol_pendaftaran/isi",$data);
      }
      if($mode=='simpan_tambah_stok'){
        $id_transaksi = $this->input->post('id_transaksi');
        $chkpakai = $this->input->post('chkpakai');
        if($this->m_ol_pendaftaran->simpan_masuk()){
/*          if($chkpakai && !empty($chkpakai)){
            $this->m_ol_pendaftaran->simpan_keluar();
            $this->m_ol_pendaftaran->input_stok('0');
          }else{*/
            $this->m_ol_pendaftaran->input_stok();
       //   }
          $this->session->set_flashdata('sukses', 'Data Sudah Di Tambah');
          redirect(base_url('ol_pendaftaran/pendaftaran/master'));
        }else{
          $this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
          redirect(base_url('ol_pendaftaran/pendaftaran/master'));
        }
      }
      if($mode=='edit_stok'){
        $data['page'] =  $data['page']."_edit_stok";
        $data['title'] = "EDIT STOK BARANG";
        $keuangan = $this->m_umum->ambil_data('tindakan_stok','id_stok',$data['last_date']);
        $data['id_barang']  = set_value('id_barang',$keuangan["id_barang"]);
        $data['id_stok']  = set_value('id_stok',$keuangan["id_stok"]);
        $data['jml_stok']  = set_value('jml_stok',$keuangan["jml_stok"]);
        $this->load->view("ol_pendaftaran/isi",$data);
      }
      if($mode=='simpan_edit_stok'){
        $id_transaksi = $this->input->post('id_transaksi');
        if($this->m_ol_pendaftaran->rubah_barang()){
          $this->session->set_flashdata('sukses', 'Data Sudah Di Rubah');
          redirect(base_url('ol_pendaftaran/pendaftaran/master'));
        }else{
          $this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
          redirect(base_url('ol_pendaftaran/pendaftaran/master'));
        }
      }
      if($mode=='hapusstok'){
        $kondisi_jml = array('id_barang'=>$data['last_date']);
        $jml = $this->m_umum->jumlah_record_filter('tindakan_stok',$kondisi_jml);
        if($jml ==0){
          $brg = $this->m_umum->ambil_data('tindakan_barang','id_barang',$data['last_date']);
          if($brg['pembuat_barang'] == $this->session->barcode_pegawai){
            if($this->m_umum->hapus_data('tindakan_barang','id_barang',$data['last_date'])){
              $this->session->set_flashdata('sukses', 'Data Sudah Dihapus');
              redirect(base_url('ol_pendaftaran/pendaftaran/master'));
            }else{
              $this->session->set_flashdata('danger', 'Ada Masalah Hapus Data. Hubungi Admin');
              redirect(base_url('ol_pendaftaran/pendaftaran/master'));
            }
          }else{
            $this->session->set_flashdata('danger', 'Maaf Harus Dihapus oleh Pembuatnya');
            redirect(base_url('ol_pendaftaran/pendaftaran/master'));             
          }
        }else{
          $this->session->set_flashdata('danger', 'Data Sudah Masuk Data Barang');
          redirect(base_url('ol_pendaftaran/pendaftaran/master'));          
        }
      }
      if($mode=='tambah_hasil'){
        $data['page'] =  $data['page']."_tambah_hasil";
        $data['title'] = "TAMBAH KELENGKAPAN PEMERIKSAAN";
        $data['nama_hasil']  = set_value('nama_hasil',$this->input->post("nama_hasil"));
        $data['id_unit']  = set_value('id_unit',$this->input->post("id_unit"));
        $data['status_hasil']  = set_value('status_hasil',$this->input->post("status_hasil"));
        $this->load->view("ol_pendaftaran/isi",$data);
      }
      if($mode=='simpan_tambah_hasil'){
        $id_transaksi = $this->input->post('id_transaksi');
        if($this->m_ol_pendaftaran->simpan_hasil()){
          $this->session->set_flashdata('sukses', 'Data Sudah Di Tambah');
          redirect(base_url('ol_pendaftaran/pendaftaran/master'));
        }else{
          $this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
          redirect(base_url('ol_pendaftaran/pendaftaran/master'));
        }
      }
      if($mode=='edit_hasil'){
        $data['page'] =  $data['page']."_edit_hasil";
        $data['title'] = "EDIT KELENGKAPAN PEMERIKSAAN";
        $keuangan = $this->m_umum->ambil_data('tindakan_hasil','id_hasil',$data['last_date']);
        $data['id_hasil']  = set_value('id_hasil',$keuangan["id_hasil"]);
        $data['nama_hasil']  = set_value('nama_hasil',$keuangan["nama_hasil"]);
        $data['id_unit']  = set_value('id_unit',$keuangan["id_unit"]);
        $data['status_hasil']  = set_value('status_hasil',$keuangan["status_hasil"]);
        $this->load->view("ol_pendaftaran/isi",$data);
      }
      if($mode=='simpan_edit_hasil'){
        $id_transaksi = $this->input->post('id_transaksi');
        if($this->m_ol_pendaftaran->rubah_hasil()){
          $this->session->set_flashdata('sukses', 'Data Sudah Di Rubah');
          redirect(base_url('ol_pendaftaran/pendaftaran/master'));
        }else{
          $this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
          redirect(base_url('ol_pendaftaran/pendaftaran/master'));
        }
      }
      if($mode=='hapushasil'){
        $kondisi_jml = array('id_hasil'=>$data['last_date']);
        $jml = $this->m_umum->jumlah_record_filter('tindakan_kelengkapan',$kondisi_jml);
        $jml2 = $this->m_umum->jumlah_record_filter('tindakan_fhasil',$kondisi_jml);
        if($jml == 0){
          if($jml2 == 0){
            $brg = $this->m_umum->ambil_data('tindakan_hasil','id_hasil',$data['last_date']);
            if($brg['pembuat_hasil'] == $this->session->barcode_pegawai){
              if($this->m_umum->hapus_data('tindakan_hasil','id_hasil',$data['last_date'])){
                $this->session->set_flashdata('sukses', 'Data Sudah Dihapus');
                redirect(base_url('ol_pendaftaran/pendaftaran/master'));
              }else{
                $this->session->set_flashdata('danger', 'Ada Masalah Hapus Data. Hubungi Admin');
                redirect(base_url('ol_pendaftaran/pendaftaran/master'));
              }
            }else{
              $this->session->set_flashdata('danger', 'Maaf Harus Dihapus oleh Pembuatnya');
              redirect(base_url('ol_pendaftaran/pendaftaran/master'));             
            }
          }else{
               $this->session->set_flashdata('danger', 'Masih Ada Data Formatnya');
              redirect(base_url('ol_pendaftaran/pendaftaran/master'));            
          }
        }else{
          $this->session->set_flashdata('danger', 'Data Sudah Masuk Data Kelengkapan');
          redirect(base_url('ol_pendaftaran/pendaftaran/master'));          
        }
      }
      if($mode=='tambah_fhasil'){
        $data['page'] =  $data['page']."_tambah_fhasil";
        $data['title'] = "TAMBAH FORMAT HASIL";
        $data['nama_fhasil']  = set_value('nama_fhasil',$this->input->post("nama_fhasil"));
        $data['format_fhasil']  = set_value('format_fhasil',$this->input->post("format_fhasil"));
        $data['status_fhasil']  = set_value('status_fhasil',$this->input->post("status_fhasil"));
        $this->load->view("ol_pendaftaran/isi",$data);
      }
      if($mode=='simpan_tambah_fhasil'){
        if($this->m_ol_pendaftaran->simpan_fhasil()){
          $this->session->set_flashdata('sukses', 'Data Sudah Di Tambah');
          redirect(base_url('ol_pendaftaran/pendaftaran/master'));
        }else{
          $this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
          redirect(base_url('ol_pendaftaran/pendaftaran/master'));
        }
      }
      if($mode=='edit_fhasil'){
        $data['page'] =  $data['page']."_edit_fhasil";
        $data['title'] = "EDIT FORMAT HASIL";
        $keuangan = $this->m_umum->ambil_data('tindakan_fhasil','id_fhasil',$data['id']);
        $data['id_fhasil']  = set_value('id_fhasil',$keuangan['id_fhasil']);
        $data['nama_fhasil']  = set_value('nama_fhasil',$keuangan['nama_fhasil']);
        $data['format_fhasil']  = set_value('format_fhasil',$keuangan['format_fhasil']);
        $data['status_fhasil']  = set_value('status_fhasil',$keuangan['status_fhasil']);
        $this->load->view("ol_pendaftaran/isi",$data);
      }
      if($mode=='simpan_edit_fhasil'){
        if($this->m_ol_pendaftaran->rubah_fhasil()){
          $this->session->set_flashdata('sukses', 'Data Sudah Di Rubah');
          redirect(base_url('ol_pendaftaran/pendaftaran/master'));
        }else{
          $this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
          redirect(base_url('ol_pendaftaran/pendaftaran/master'));
        }
      }
      if($mode=='hapusFhasil'){
        if($this->m_umum->hapus_data('tindakan_fhasil','id_fhasil',$data['id'])){
          $this->session->set_flashdata('sukses', 'Data Sudah Dihapus');
          redirect(base_url('ol_pendaftaran/pendaftaran/master'));
        }else{
          $this->session->set_flashdata('danger', 'Ada Masalah Hapus Data. Hubungi Admin');
          redirect(base_url('ol_pendaftaran/pendaftaran/master'));
        }
      }
      if($mode=='tambah_operator'){
        $data['page'] =  $data['page']."_tambah_operator";
        $data['title'] = "TAMBAH DATA PETUGAS";
        $kondisi = array('id_transaksi'=>$data['id']);
        $tran = $this->m_umum->ambil_data_kondisi_2tabel_row('tindakan_transaksi',$kondisi,'ol_unit','unit_tindakan','id_unit');
        $data['data_operator'] = $this->m_ol_rancak->ambil_data_pegawai_operator_null($tran["coun_unit"]);
        $data['status_transaksi']  = set_value('status_transaksi',$tran['status_transaksi']);
        $this->load->view("ol_pendaftaran/isi",$data);
      }
      if($mode=='simpan_tambah_operator'){
        $status_transaksi = $this->input->post('status_transaksi');
        $id_transaksi = $this->input->post('id_transaksi');
        $chk = $this->input->post('chk');
        if($chk){
          if($status_transaksi == 0){
            $this->m_ol_pendaftaran->simpan_operator();
            $this->session->set_flashdata('sukses', 'Data Sudah Di Tambah');
          }else{
            $this->session->set_flashdata('danger', 'Pendaftaran Sudah Close');
          }          
        }
          redirect(base_url('ol_pendaftaran/pendaftaran/isi/'.$id_transaksi));
      }
      if($mode=='edit_operator'){
        $data['page'] =  $data['page']."_edit_operator";
        $data['title'] = "EDIT KATEGORI BARANG";
        $kondisi = array('id_transaksi'=>$data['id']);
        $keuangan = $this->m_umum->ambil_data('tindakan_operator','id_operator',$data['last_date']);
        $tran = $this->m_umum->ambil_data_kondisi_2tabel_row('tindakan_transaksi',$kondisi,'ol_unit','id_unit');
        $data['status_transaksi']  = set_value('status_transaksi',$tran['status_transaksi']);
        $data['ope_nonull']    = $this->m_ol_rancak->ambil_data_pegawai_operator($tran["coun_unit"]);
        $data['id_operator']  = set_value('id_operator',$keuangan["id_operator"]);
        $data['admin_operator']  = set_value('admin_operator',$keuangan["admin_operator"]);
        $this->load->view("ol_pendaftaran/isi",$data);
      }
      if($mode=='simpan_edit_operator'){
        $status_transaksi = $this->input->post('status_transaksi');
        $id_transaksi = $this->input->post('id_transaksi');
        if($status_transaksi == 0){
          $id_operator = $this->input->post('id_operator');
          $kondisi=array('id_operator'=>$id_operator);
          $jml = $this->m_umum->jumlah_record_filter('tindakan_kewenangan',$kondisi);
          if($jml == 0){
            if($this->m_ol_pendaftaran->rubah_operator()){
              $this->session->set_flashdata('sukses', 'Data Sudah Di Rubah');
            }else{
              $this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
            }
          }else{
               $this->session->set_flashdata('danger', 'Hapus Data kewenangannya Dulu');        
          }
        }else{
          $this->session->set_flashdata('danger', 'Pendaftaran Sudah Close');
        }
          redirect(base_url('ol_pendaftaran/pendaftaran/isi/'.$id_transaksi));
      }
      if($mode=='hapusoperator'){
        $cek_status = $this->m_umum->ambil_data('tindakan_transaksi','id_transaksi',$data['id']);
        if($cek_status['status_transaksi'] == 0){
          $kondisi_jml = array('id_operator'=>$data['last_date']);
          $jml = $this->m_umum->jumlah_record_filter('tindakan_kewenangan',$kondisi_jml);
          if($jml ==0){
            $brg = $this->m_umum->ambil_data('tindakan_operator','id_operator',$data['last_date']);
              if($this->m_umum->hapus_data('tindakan_operator','id_operator',$data['last_date'])){
                $this->session->set_flashdata('sukses', 'Data Sudah Dihapus');
              }else{
                $this->session->set_flashdata('danger', 'Ada Masalah Hapus Data. Hubungi Admin');
              }
          }else{
            $this->session->set_flashdata('danger', 'Data Sudah Masuk Data Kewenangan');        
          }
        }else{
          $this->session->set_flashdata('danger', 'Pendaftaran Sudah Close');
        }
          redirect(base_url('ol_pendaftaran/pendaftaran/isi/'.$data['id'])); 
      }
      if($mode=='tambah_kewenangan'){
        $data['page'] =  $data['page']."_tambah_kewenangan";
        $data['title'] = "TAMBAH LOGBOOK PEMERIKSAAN";
        $d = $this->m_ol_pendaftaran->ambil_data_transaksi_pendaftaran($data['id']);
        $brg = $this->m_ol_rancak->ambil_data_operator_kw($data['last_date']);
        $data['sifat']=$this->m_ol_rancak->cmd_sifat_kewenangan();
        $data['rm']  = set_value('rm',$d['rm']);
        $data['status_transaksi']  = set_value('status_transaksi',$d['status_transaksi']);
        $data['admin_operator']  = set_value('admin_operator',$brg['id_pegawai']);
        $data['id_pasien']  = set_value('id_pasien',$d['id_pasien']);
        $data['tgl_transaksi']  = set_value('tgl_transaksi',$d['tgl_transaksi']);
        $data['id_kewenangan']  = set_value('id_kewenangan',$this->input->post("id_kewenangan"));
        $data['id_sifat_kewenangan']  = set_value('id_sifat_kewenangan',$this->input->post("id_sifat_kewenangan"));
        $data['jml_logbook']  = set_value('jml_logbook',1);
        $data['kewenangan'] = $this->m_ol_pendaftaran->kewenangan_all_no_null($brg['id_jabatan']);
        $this->load->view("ol_pendaftaran/isi",$data);
      }
      if($mode=='simpan_tambah_kewenangan'){
        $status_transaksi = $this->input->post('status_transaksi');
        $id_transaksi = $this->input->post('id_transaksi');
        if($status_transaksi == 0){
          if($Q = $this->m_ol_pendaftaran->simpan_logboook()){
            $this->m_ol_pendaftaran->simpan_tindakan_kewenangan($Q);
            $this->m_ol_pendaftaran->nyimpen_ol_logbook_pasien($Q);
            $this->session->set_flashdata('sukses', 'Data Sudah Di Tambah');
          }else{
            $this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
          }
        }else{
          $this->session->set_flashdata('danger', 'Pendaftaran Sudah Close');
        }
          redirect(base_url('ol_pendaftaran/pendaftaran/isi/'.$id_transaksi));
      }
      if($mode=='edit_kewenangan'){
        $data['page'] =  $data['page']."_edit_kewenangan";
        $data['title'] = "EDIT LOGBOOK PEMERIKSAAN";
        $keuangan = $this->m_umum->ambil_data('tindakan_transaksi','id_transaksi',$data['id']);
        $data['status_transaksi']  = set_value('status_transaksi',$keuangan['status_transaksi']);
        $kondisi = array('id_tindakan_kewenangan'=>$data['last_date']);
        $d = $this->m_umum->ambil_data_kondisi_2tabel_row('tindakan_kewenangan',$kondisi,'ol_logbook','id_logbook');
        $brg = $this->m_ol_rancak->ambil_data_operator_kw($d['id_operator']);
        $data['sifat']=$this->m_ol_rancak->cmd_sifat_kewenangan();
        $data['id_logbook']  = set_value('id_logbook',$d['id_logbook']);
        $data['id_kewenangan']  = set_value('id_kewenangan',$d['id_kewenangan']);
        $data['id_sifat_kewenangan']  = set_value('id_sifat_kewenangan',$d['id_sifat_kewenangan']);
        $data['jml_logbook']  = set_value('jml_logbook',$d['jml_logbook']);
        $data['kewenangan'] = $this->m_ol_pendaftaran->kewenangan_all_no_null($brg['id_jabatan']);
        $this->load->view("ol_pendaftaran/isi",$data);
      }
      if($mode=='simpan_edit_kewenangan'){
        $status_transaksi = $this->input->post('status_transaksi');
        $id_transaksi = $this->input->post('id_transaksi');
        if($status_transaksi == 0){
          if($this->m_ol_pendaftaran->rubah_kewenangan()){
            $this->session->set_flashdata('sukses', 'Data Sudah Di Rubah');
          }else{
            $this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
          }
        }else{
          $this->session->set_flashdata('danger', 'Pendaftaran Sudah Close');
        }
          redirect(base_url('ol_pendaftaran/pendaftaran/isi/'.$id_transaksi));
      }
      if($mode=='hapuskw'){
        $cek_status = $this->m_umum->ambil_data('tindakan_transaksi','id_transaksi',$data['id']);
        if($cek_status['status_transaksi'] == 0){
          $brg = $this->m_umum->ambil_data('tindakan_kewenangan','id_tindakan_kewenangan',$data['last_date']);
          if($this->m_umum->hapus_data('tindakan_kewenangan','id_tindakan_kewenangan',$data['last_date'])){
            $this->m_umum->hapus_data('ol_logbook','id_logbook',$brg['id_logbook']);
            $this->m_umum->hapus_data('ol_logbook_pasien','id_logbook',$brg['id_logbook']);
            $this->session->set_flashdata('sukses', 'Data Sudah Dihapus');
          }else{
            $this->session->set_flashdata('danger', 'Ada Masalah Hapus Data. Hubungi Admin');
          }
        }else{
          $this->session->set_flashdata('danger', 'Pendaftaran Sudah Close');
        }
          redirect(base_url('ol_pendaftaran/pendaftaran/isi/'.$data['id']));
      }
      if($mode=='tambah_keluar'){
        $data['page'] =  $data['page']."_tambah_keluar";
        $data['title'] = "TAMBAH DATA PEMAKAIAN BAKHP";
        $keuangan = $this->m_umum->ambil_data('tindakan_transaksi','id_transaksi',$data['id']);
        $data['status_transaksi']  = set_value('status_transaksi',$keuangan['status_transaksi']);
        $data['id_barang']  = set_value('id_barang',$this->input->post("id_barang"));
        $data['jml_keluar']  = set_value('jml_keluar',1);
      //  $tran = $this->m_umum->ambil_data('tindakan_keluar','id_transaksi',$data['id']);
        $data['data_barang'] = $this->m_ol_rancak->ambil_data_stok_barang($this->session->unit);
        $this->load->view("ol_pendaftaran/isi",$data);
      }
      if($mode=='simpan_tambah_keluar'){
        $id_barang = $this->input->post('id_barang');
        $id_transaksi = $this->input->post('id_transaksi');
        if($id_barang){
          $status_transaksi = $this->input->post('status_transaksi');
          if($status_transaksi == 0){
            $jml_keluar = $this->input->post('jml_keluar');
            $kondisi = array('tindakan_stok.id_barang'=>$id_barang);
            $brg = $this->m_umum->ambil_data_kondisi_2tabel_row('tindakan_stok',$kondisi,'tindakan_barang','id_barang');
            $stoke = $brg['jml_stok'];
            if($stoke > $jml_keluar){
              $this->m_ol_pendaftaran->simpan_tindakan_keluar();
              $this->session->set_flashdata('sukses', 'Data Sudah Di Tambah');
            }else{
              $this->session->set_flashdata('danger', 'Stok Kurang');
            }
          }else{
            $this->session->set_flashdata('danger', 'Pendaftaran Sudah Close');
          }
        }
          redirect(base_url('ol_pendaftaran/pendaftaran/isi/'.$id_transaksi));
      }
      if($mode=='edit_keluar'){
        $data['page'] =  $data['page']."_edit_keluar";
        $data['title'] = "EDIT PEMAKAIAN BAKHP";
        $keuangan = $this->m_umum->ambil_data('tindakan_transaksi','id_transaksi',$data['id']);
        $data['status_transaksi']  = set_value('status_transaksi',$keuangan['status_transaksi']);
        $kondisi = array('id_keluar'=>$data['last_date']);
        $d = $this->m_umum->ambil_data_kondisi_2tabel_row('tindakan_keluar',$kondisi,'tindakan_barang','id_barang');
        $data['data_barang'] = $this->m_ol_rancak->ambil_data_stok_barang($this->session->unit);
        $data['id_keluar']  = set_value('id_keluar',$d['id_keluar']);
        $data['id_barang']  = set_value('id_barang',$d['id_barang']);
        $data['jml_keluar']  = set_value('jml_keluar',$d['jml_keluar']);
        $this->load->view("ol_pendaftaran/isi",$data);
      }
      if($mode=='simpan_edit_keluar'){
        $status_transaksi = $this->input->post('status_transaksi');
        $id_transaksi = $this->input->post('id_transaksi');
        if($status_transaksi == 0){
          $id_transaksi = $this->input->post('id_transaksi');
          $id_barang_lama = $this->input->post('id_barang_lama');
          $jml_keluar_lama = $this->input->post('jml_keluar_lama');
          $kondisip = array('tindakan_stok.id_barang'=>$id_barang_lama);
          $brgp = $this->m_umum->ambil_data_kondisi_2tabel_row('tindakan_stok',$kondisip,'tindakan_barang','id_barang');
          $stokp = $brgp['jml_stok'];
          //=================== barang baru
          $jml_keluar = $this->input->post('jml_keluar');
          $id_barang = $this->input->post('id_barang');
          $kondisi = array('tindakan_stok.id_barang'=>$id_barang);
          $brg = $this->m_umum->ambil_data_kondisi_2tabel_row('tindakan_stok',$kondisi,'tindakan_barang','id_barang');
          $stoke = $brg['jml_stok'];
          $stoktotal = $stokp + $jml_keluar_lama;
          $setoke = $stoke - $jml_keluar;
          if($id_barang_lama == $id_barang){
            if($stoktotal > $jml_keluar){
              $this->m_ol_pendaftaran->rubah_tindakan_keluar();
              $this->session->set_flashdata('sukses', 'Data Sudah Di Tambah');
            }
          }else{
            if($stoke > $jml_keluar){
              $this->m_ol_pendaftaran->rubah_tindakan_keluar();
              $this->session->set_flashdata('sukses', 'Data Sudah Di Tambah');
            }else{
              $this->session->set_flashdata('danger', 'Stok Kurang');           
            }
          }
        }else{
          $this->session->set_flashdata('danger', 'Pendaftaran Sudah Close');
        }
          redirect(base_url('ol_pendaftaran/pendaftaran/isi/'.$id_transaksi));
      }
      if($mode=='hapuskeluar'){
        $cek_status = $this->m_umum->ambil_data('tindakan_transaksi','id_transaksi',$data['id']);
        if($cek_status['status_transaksi'] == 0){
          $a = $this->m_umum->ambil_data('tindakan_keluar','id_keluar',$data['last_date']);
          $id_barang = $a['id_barang'];
          $kondisi = array('tindakan_stok.id_barang'=>$id_barang);
          $brg = $this->m_umum->ambil_data_kondisi_2tabel_row('tindakan_stok',$kondisi,'tindakan_barang','id_barang');
          $stoke = $brg['jml_stok'] + $a['jml_keluar'];
          if($this->m_umum->hapus_data('tindakan_keluar','id_keluar',$data['last_date'])){
            $this->m_ol_pendaftaran->change_stok($stoke,$id_barang);
            $this->session->set_flashdata('sukses', 'Data Sudah Dihapus');
          }else{
            $this->session->set_flashdata('danger', 'Ada Masalah Hapus Data. Hubungi Admin');
          }
        }else{
          $this->session->set_flashdata('danger', 'Pendaftaran Sudah Close');
        }
          redirect(base_url('ol_pendaftaran/pendaftaran/isi/'.$data['id']));
      }
      if($mode=='clicked'){
        $data['page'] =  $data['page']."_clicked"; 
        $hasnor = $this->m_umum->ambil_data('tindakan_fhasil','id_fhasil',$data['id']);
        $data['hasil_kelengkapan'] = set_value('hasil_kelengkapan',$hasnor["format_fhasil"]);
        $this->load->view("ol_pendaftaran/isi",$data);
      } 
      if($mode=='awal'){
        $data['page'] =  $data['page']."_awal"; 
        $data['hasil_kelengkapan'] = set_value('hasil_kelengkapan',$this->input->post("hasil_kelengkapan"));
        $this->load->view("ol_pendaftaran/isi",$data);
      }
      if($mode=='tambah_kelengkapan'){
        $data['page'] =  $data['page']."_tambah_kelengkapan";
        $data['title'] = "TAMBAH DATA PEMAKAIAN BAKHP";
        $keuangan = $this->m_umum->ambil_data('tindakan_transaksi','id_transaksi',$data['id']);
        $data['status_transaksi']  = set_value('status_transaksi',$keuangan['status_transaksi']);
        $data['id_hasil']  = set_value('id_hasil',$this->input->post("id_hasil"));
        $data['id_fhasil']  = set_value('id_fhasil',$this->input->post("id_fhasil"));
        $data['hasil_kelengkapan']  = set_value('hasil_kelengkapan',$this->input->post("hasil_kelengkapan"));
        $data['data_hasil'] = $this->m_ol_rancak->ambil_tindakan_kelengkapan($this->session->unit);
        $data['data_fhasil'] = array("");
        $this->load->view("ol_pendaftaran/isi",$data);
      }
      if($mode=='simpan_tambah_kelengkapan'){
        $id_hasil = $this->input->post('id_hasil');
        $id_transaksi = $this->input->post('id_transaksi');
        if($id_hasil){
          $status_transaksi = $this->input->post('status_transaksi');
          if($status_transaksi == 0){
            if($this->m_ol_pendaftaran->simpan_tindakan_kelengkapan()){
              $this->session->set_flashdata('sukses', 'Data Sudah Di Tambah');
            }else{
              $this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
            }
          }else{
            $this->session->set_flashdata('danger', 'Pendaftaran Sudah Close');
          }
        }
          redirect(base_url('ol_pendaftaran/pendaftaran/isi/'.$id_transaksi));
      }
      if($mode=='edit_kelengkapan'){
        $data['page'] =  $data['page']."_edit_kelengkapan";
        $data['title'] = "EDIT DATA HASIL";
        $keuangan = $this->m_umum->ambil_data('tindakan_transaksi','id_transaksi',$data['id']);
        $data['status_transaksi']  = set_value('status_transaksi',$keuangan['status_transaksi']);
        $kondisi = array('id_kelengkapan'=>$data['last_date']);
        $d = $this->m_umum->ambil_data_kondisi_2tabel_row('tindakan_kelengkapan',$kondisi,'tindakan_hasil','id_hasil');
        $data['id_kelengkapan']  = set_value('id_kelengkapan',$d['id_kelengkapan']);
        $data['id_hasil']  = set_value('id_hasil',$d['id_hasil']);
        $data['id_fhasil']  = set_value('id_fhasil',$this->input->post("id_fhasil"));
        $data['hasil_kelengkapan']  = set_value('hasil_kelengkapan',$d['hasil_kelengkapan']);
        $data['data_hasil'] = $this->m_ol_rancak->ambil_tindakan_kelengkapan($this->session->unit);
        $data['data_fhasil'] = array("");
        $this->load->view("ol_pendaftaran/isi",$data);
      }
      if($mode=='simpan_edit_kelengkapan'){
        $status_transaksi = $this->input->post('status_transaksi');
        $id_transaksi = $this->input->post('id_transaksi');
        if($status_transaksi == 0){
          if($this->m_ol_pendaftaran->edit_tindakan_kelengkapan()){
            $this->session->set_flashdata('sukses', 'Data Sudah Di Rubah');
          }else{
            $this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
          }
        }else{
          $this->session->set_flashdata('danger', 'Pendaftaran Sudah Close');
        }
          redirect(base_url('ol_pendaftaran/pendaftaran/isi/'.$id_transaksi));
      }
      if($mode=='hapuskelengkapan'){
        $cek_status = $this->m_umum->ambil_data('tindakan_transaksi','id_transaksi',$data['id']);
        if($cek_status['status_transaksi'] == 0){
          if($this->m_umum->hapus_data('tindakan_kelengkapan','id_kelengkapan',$data['last_date'])){
            $this->session->set_flashdata('sukses', 'Data Sudah Dihapus');
          }else{
            $this->session->set_flashdata('danger', 'Ada Masalah Hapus Data. Hubungi Admin');
          }
        }else{
          $this->session->set_flashdata('danger', 'Pendaftaran Sudah Close');
        }
          redirect(base_url('ol_pendaftaran/pendaftaran/isi/'.$data['id']));
      }
      if($mode=='status'){
          $this->m_ol_pendaftaran->rubah_status_transaksi($data['id'],$data['last_date']);
          $this->session->set_flashdata('sukses', 'Data Sudah DiRubah');
          redirect(base_url('ol_pendaftaran/pendaftaran'));
      }
    }
  }
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("ol_pendaftaran/header",$data);
	$this->load->view("ol_pendaftaran/isi");
	$this->load->view("footer");
	$this->load->view("ol_pendaftaran/jsload");
	$this->load->view("ol_pendaftaran/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_topol",$data);
	$this->load->view("ol_pendaftaran/isi");
	$this->load->view("footer");
	$this->load->view("ol_pendaftaran/jsload");
	$this->load->view("ol_pendaftaran/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
