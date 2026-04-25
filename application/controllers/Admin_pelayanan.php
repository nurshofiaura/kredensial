<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Admin_pelayanan extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
		  		$this->load->model('m_ol_rancak');
          $this->load->model('m_pendaftaran');
          $this->login_kah();
  }
/*  function cek_login_kah(){
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
  }*/
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
  function tindakan($mode='view')
  {
	$data['page']  = "tindakan";
	$data['header'] = "TINDAKAN / PEMERIKSAAN";
	$data['title'] = "TINDAKAN / PEMERIKSAAN";
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
	$data['id']   = $this->uri->segment(4, 0);
	//======================= IMPORTANT ======================================
    if($mode=='view'){
			$this->tampil($data);
		}
    else if($mode=='data'){
		echo json_encode($this->m_pendaftaran->tindakan_all());
		}
		else{
			$data['cmd_status'] = $this->m_rancak->cmd_status();
			$data['cmd_golongan_pemeriksaan'] = $this->m_rancak->cmd_golongan_pemeriksaan();
	    if($mode=='tambah'){
	      $data['page'] =  $data['page']."_tambah";
					$data['nama_tindakan']  = set_value('nama_tindakan',$this->input->post('nama_tindakan'));
					$data['id_golongan_pemeriksaan']  = set_value('id_golongan_pemeriksaan',$this->input->post('id_golongan_pemeriksaan'));
					$data['status_tindakan']  = set_value('status_tindakan',$this->input->post('status_tindakan'));
					$this->load->view("pelayanan/isi",$data);
	    }
	    if($mode=='simpan_tambah'){
			  if($this->m_pendaftaran->simpan_tindakan()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('admin_pelayanan/tindakan'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('admin_pelayanan/tindakan'));
			  }
	    }
	    if($mode=='edit'){
	      $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('tindakan','id_tindakan',$data['id']);
				$data['pembuat_tindakan']  = set_value('pembuat_tindakan',$keuangan["pembuat_tindakan"]);
				$data['nama_tindakan']  = set_value('nama_tindakan',$keuangan["nama_tindakan"]);
				$data['id_golongan_pemeriksaan']  = set_value('id_golongan_pemeriksaan',$keuangan["id_golongan_pemeriksaan"]);
				$data['status_tindakan']  = set_value('status_tindakan',$keuangan["status_tindakan"]);
				$this->load->view("pelayanan/isi",$data);
	    }
	    if($mode=='simpan_edit'){
	    	$pembuat_tindakan = $this->input->post('pembuat_tindakan');
	    	if($this->session->id_pegawai == $pembuat_tindakan){
				  if($this->m_pendaftaran->edit_tindakan()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
						redirect(base_url('admin_pelayanan/tindakan'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
						redirect(base_url('admin_pelayanan/tindakan'));
				  }
	    	}else{
						$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Yang Di Buat Sendiri');
						redirect(base_url('admin_pelayanan/tindakan'));    		
					}
	    }
	    if($mode=='paket'){
	      $data['page'] =  $data['page']."_paket";
		 		$kondisi_peg=array('id_tindakan'=>$data['id'],'id_instansi'=>$this->session->refer);
				$data['jml'] = $this->m_umum->jumlah_record_filter('tindakan_paket',$kondisi_peg);
				if($data['jml'] == 0){
					$take = $this->m_umum->ambil_data('tindakan','id_tindakan',$data['id']);		
				}else{
					$take = $this->m_umum->ambil_data('tindakan_paket','id_tindakan',$data['id']);
					$data['paket']  = set_value('paket',explode(",", $take['paket']));	
				}
	      $data['tindakan'] = $this->m_rancak->cmd_tindakan_paket();
				$data['id_tindakan']  = set_value('id_tindakan',$take['id_tindakan']);	      
	  		$this->load->view("pelayanan/isi",$data);
	    }
	    if($mode=='simpan_paket'){
	    	$id_tindakan = $this->input->post('id_tindakan');
		 		$kondisi_peg=array('id_tindakan'=>$id_tindakan,'id_instansi'=>$this->session->refer);
				$jml = $this->m_umum->jumlah_record_filter('tindakan_paket',$kondisi_peg);
				if($jml == 0){     
			  	$this->m_pendaftaran->simpan_paket_tindakan();
				}else{
					$this->m_pendaftaran->edit_paket_tindakan();
				}
				$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
				redirect(base_url('admin_pelayanan/tindakan'));
	    } 
		}
  }
    function golongan($mode='view')
  {
	$data['page']  = "golongan";
	$data['header'] = "GOLONGAN TINDAKAN / PEMERIKSAAN";
	$data['title'] = "GOLONGAN TINDAKAN / PEMERIKSAAN";
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
	$data['id']   = $this->uri->segment(4, 0);
	//======================= IMPORTANT ======================================
    if($mode=='view'){
	$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_pelayanan->golongan_all());
	}
	else{
		$data['cmd_status'] = $this->m_rancak->cmd_status();
		$data['cmd_struktur_jabatan'] = $this->m_rancak->cmd_struktur_jabatan();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		$data['nama_golongan_pemeriksaan']  = set_value('nama_golongan_pemeriksaan',$this->input->post('nama_golongan_pemeriksaan'));
		$data['id_struktur_jabatan']  = set_value('id_struktur_jabatan',$this->input->post('id_struktur_jabatan'));
		$data['status_golongan_pemeriksaan']  = set_value('status_golongan_pemeriksaan',$this->input->post('status_golongan_pemeriksaan'));
		$this->load->view("pelayanan/isi",$data);
      }
      if($mode=='simpan_tambah'){
		  if($this->m_pelayanan->simpan_golongan()){
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
			redirect(base_url('admin_pelayanan/golongan'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
			redirect(base_url('admin_pelayanan/golongan'));
		  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
		$keuangan    = $this->m_umum->ambil_data('kol_golongan_pemeriksaan','id_golongan_pemeriksaan',$data['id']);
		$data['nama_golongan_pemeriksaan']  = set_value('nama_golongan_pemeriksaan',$keuangan["nama_golongan_pemeriksaan"]);
		$data['id_struktur_jabatan']  = set_value('id_struktur_jabatan',$keuangan["id_struktur_jabatan"]);
		$data['status_golongan_pemeriksaan']  = set_value('status_golongan_pemeriksaan',$keuangan["status_golongan_pemeriksaan"]);
		$this->load->view("pelayanan/isi",$data);
      }
      if($mode=='simpan_edit'){
		  if($this->m_pelayanan->edit_golongan()){
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
			redirect(base_url('admin_pelayanan/golongan'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
			redirect(base_url('admin_pelayanan/golongan'));
		  }
      }
	}
  }
  function tindakan_tarif($mode='view')
  {
	$data['page']  = "tindakan_tarif";
	$data['header'] = "TARIF TINDAKAN / PEMERIKSAAN";
	$data['title'] = "TARIF TINDAKAN / PEMERIKSAAN";
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
	//======================= IMPORTANT ======================================
	$data['id_tindakan']   = $this->uri->segment(4, 0);
	$data['id_kelas']   = $this->uri->segment(5, 0);
	if(empty($data['id_tindakan'])){
		$data['id_tindakan']   = "0";
	}
	if(empty($data['id_kelas'])){
		$data['id_kelas']   = "0";
	}
		$data['cmd_kelas'] = $this->m_rancak->cmd_kelas();
		$data['cmd_tindakan_no_null'] = $this->m_rancak->cmd_tindakan_no_null($pegawai['id_jabatan']);
		$data['cmd_tindakan'] = $this->m_rancak->cmd_tindakan($pegawai['id_jabatan']);
    if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$id_tindakan = $this->input->post("id_tindakan");
			$id_kelas = $this->input->post("id_kelas");
			redirect(base_url('admin_pelayanan/tindakan_tarif/view/'.$id_tindakan.'/'.$id_kelas));
		}
	}
    else if($mode=='data'){
		echo json_encode($this->m_pendaftaran->tarif_tindakan_all($data['id_tindakan'],$data['id_kelas']));
	}
	else{
			$data['pelayanan']=$this->m_pendaftaran->ambil_data_pelayanan_no_null();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['id_pelayanan']  = set_value('id_pelayanan',$this->input->post('id_pelayanan'));
				$data['id_tindakan']  = set_value('id_tindakan',$this->input->post('id_tindakan'));
				$data['tgl_berlaku']  = set_value('tgl_berlaku',date('d-m-Y'));
				$data['harga_tindakan']  = set_value('harga_tindakan',$this->input->post('harga_tindakan'));
				$this->load->view("pelayanan/isi",$data);
      }
      if($mode=='simpan_tambah'){
				$this->m_pendaftaran->simpan_tindakan_tarif();
				$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
				redirect(base_url('admin_pelayanan/tindakan_tarif'));
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('tindakan_tarif','id_tindakan_tarif',$data['id_tindakan']);
				$data['id_pelayanan']  = set_value('id_pelayanan',$keuangan["id_pelayanan"]);
				$data['id_tindakan']  = set_value('id_tindakan',$keuangan["id_tindakan"]);
				$data['id_tindakan_tarif']  = set_value('id_tindakan_tarif',$keuangan["id_tindakan_tarif"]);
				$data['id_kelas']  = set_value('id_kelas',$keuangan["id_kelas"]);
				$data['barcode_tindakan_tarif']  = set_value('barcode_tindakan_tarif',$keuangan["barcode_tindakan_tarif"]);
				$data['tgl_berlaku']  = set_value('tgl_berlaku',date('d-m-Y', strtotime($keuangan["tgl_berlaku"])));
				$data['harga_tindakan']  = set_value('harga_tindakan',number_format($keuangan["harga_tindakan"]));
				$this->load->view("pelayanan/isi",$data);
      }
      if($mode=='simpan_edit'){
				$id_kelas = $this->input->post('id_kelas');
				$id_tindakan = $this->input->post('id_tindakan');
				$barcode_tindakan_tarif = $this->input->post('barcode_tindakan_tarif');
				$harga_tindakan = $this->input->post('harga_tindakan');
				$harga_tindakan	= str_replace("'","&acute;",$harga_tindakan);
				$harga_tindakan	= str_replace(".","",$harga_tindakan);
				$harga_tindakan	= str_replace(" ","",$harga_tindakan);
				$harga_tindakan	= str_replace(",","",$harga_tindakan);
				$tgl_berlaku = $this->input->post('tgl_berlaku');
				$tgl_berlaku = date('Y-m-d', strtotime($tgl_berlaku));
		  if($this->m_pendaftaran->edit_tindakan_tarif($tgl_berlaku,$harga_tindakan)){
		  	$this->m_pendaftaran->tindakan_tarif_log($id_kelas,$id_tindakan,$barcode_tindakan_tarif,$tgl_berlaku,$harga_tindakan,1,'Edit');
				$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
				redirect(base_url('admin_pelayanan/tindakan_tarif'));
		  }else{
				$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
				redirect(base_url('admin_pelayanan/tindakan_tarif'));
		  }
      }
	}
  }
    function asuransi($mode='view')
  {
	$data['page']  = "asuransi";
	$data['header'] = "CARA BAYAR";
	$data['title'] = "CARA BAYAR";
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
	$data['id']   = $this->uri->segment(4, 0);
	//======================= IMPORTANT ======================================
    if($mode=='view'){
	$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_pendaftaran->asuransi_all());
	}
	else{
		$data['cmd_cara_bayar'] = $this->m_rancak->cmd_input_cara_bayar();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		$data['nama_detil_cara_bayar']  = set_value('nama_detil_cara_bayar',$this->input->post('nama_detil_cara_bayar'));
		$data['id_cara_bayar']  = set_value('id_cara_bayar',$this->input->post('id_cara_bayar'));
		$this->load->view("pelayanan/isi",$data);
      }
      if($mode=='simpan_tambah'){
		  if($this->m_pendaftaran->simpan_detil_cara_bayar()){
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
			redirect(base_url('admin_pelayanan/asuransi'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
			redirect(base_url('admin_pelayanan/asuransi'));
		  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
		$keuangan    = $this->m_umum->ambil_data('kol_detil_cara_bayar','id_detil_cara_bayar',$data['id']);
		$data['nama_detil_cara_bayar']  = set_value('nama_detil_cara_bayar',$keuangan["nama_detil_cara_bayar"]);
		$data['id_cara_bayar']  = set_value('id_cara_bayar',$keuangan["id_cara_bayar"]);
		$this->load->view("pelayanan/isi",$data);
      }
      if($mode=='simpan_edit'){
		  if($this->m_pendaftaran->edit_detil_cara_bayar()){
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
			redirect(base_url('admin_pelayanan/asuransi'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
			redirect(base_url('admin_pelayanan/asuransi'));
		  }
      }
	}
  }
    function rujukan($mode='view')
  {
	$data['page']  = "rujukan";
	$data['header'] = "RUJUKAN DOKTER";
	$data['title'] = "RUJUKAN DOKTER";
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
	$data['id']   = $this->uri->segment(4, 0);
	//======================= IMPORTANT ======================================
    if($mode=='view'){
	$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_pendaftaran->rujukan_all());
	}
	else{
			$data['cmd_jenis_rujukan'] = $this->m_rancak->cmd_jenis_rujukan();
		 	$data['kol_provinsi'] = $this->m_rancak->cmd_kol_provinsi();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		    $data['kab']=array("");
		    $data['kec']=array("");
		    $data['kel']=array("");
				$data['nama_rujukan_dokter']  = set_value('nama_rujukan_dokter',$this->input->post('nama_rujukan_dokter'));
				$data['id_kategori_dokter']  = set_value('id_kategori_dokter',$this->input->post('id_kategori_dokter'));
				$data['alamat_rujukan_dokter']  = set_value('alamat_rujukan_dokter',$this->input->post('alamat_rujukan_dokter'));
				$data['email_rujukan_dokter']  = set_value('email_rujukan_dokter',$this->input->post('email_rujukan_dokter'));
				$data['kontak_rujukan_dokter']  = set_value('kontak_rujukan_dokter',$this->input->post('kontak_rujukan_dokter'));
				$data['id_prov']  = set_value('id_prov',$this->input->post('id_prov'));
	  		$data['id_kab']  = set_value('id_kab',$this->input->post('id_kab'));
	  		$data['id_kel']  = set_value('id_kel',$this->input->post('id_kel'));
	  		$data['id_kec']  = set_value('id_kec',$this->input->post('id_kec'));
				$this->load->view("pelayanan/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($this->m_pendaftaran->simpan_rujukan_dokter()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('admin_pelayanan/rujukan'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('admin_pelayanan/rujukan'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('kol_rujukan_dokter','id_rujukan_dokter',$data['id']);
    		$data['kab'] = $this->m_rancak->ambil_data_dropdown_kabs($keuangan['id_prov']);
    		$data['kec'] = $this->m_rancak->ambil_data_dropdown_kecs($keuangan['id_kab']);
    		$data['kel'] = $this->m_rancak->ambil_data_dropdown_kels($keuangan['id_kec']);
				$data['nama_rujukan_dokter']  = set_value('nama_rujukan_dokter',$keuangan["nama_rujukan_dokter"]);
				$data['id_kategori_dokter']  = set_value('id_kategori_dokter',$keuangan["id_kategori_dokter"]);
				$data['alamat_rujukan_dokter']  = set_value('alamat_rujukan_dokter',$keuangan["alamat_rujukan_dokter"]);
				$data['email_rujukan_dokter']  = set_value('email_rujukan_dokter',$keuangan["email_rujukan_dokter"]);
				$data['kontak_rujukan_dokter']  = set_value('kontak_rujukan_dokter',$keuangan["kontak_rujukan_dokter"]);
				$data['id_prov']  = set_value('id_prov',$keuangan["id_prov"]);
				$data['id_kab']  = set_value('id_kab',$keuangan["id_kab"]);
				$data['id_kel']  = set_value('id_kel',$keuangan["id_kel"]);
				$data['id_kec']  = set_value('id_kec',$keuangan["id_kec"]);
				$this->load->view("pelayanan/isi",$data);
      }
      if($mode=='simpan_edit'){
			  if($this->m_pendaftaran->edit_rujukan_dokter()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
					redirect(base_url('admin_pelayanan/rujukan'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
					redirect(base_url('admin_pelayanan/rujukan'));
			  }
      }
	}
  }
  function faskes($mode='view')
  {
	$data['page']  = "faskes";
	$data['header'] = "RUJUKAN FASILITAS KESEHATAN";
	$data['title'] = "RUJUKAN FASILITAS KESEHATAN";
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
	$data['id']   = $this->uri->segment(4, 0);
	//======================= IMPORTANT ======================================
    if($mode=='view'){
	$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_pendaftaran->faskes_all());
	}
	else{
		$data['cmd_cara_masuk'] = $this->m_rancak->cmd_input_cara_masuk();
		$data['kol_provinsi'] = $this->m_rancak->cmd_kol_provinsi();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['nama_rujukan_instansi']  = set_value('nama_rujukan_instansi',$this->input->post('nama_rujukan_instansi'));
				$data['id_cara_masuk']  = set_value('id_cara_masuk',$this->input->post('id_cara_masuk'));
				$data['alamat_rujukan_instansi']  = set_value('alamat_rujukan_instansi',$this->input->post('alamat_rujukan_instansi'));
				$data['email_rujukan_instansi']  = set_value('email_rujukan_instansi',$this->input->post('email_rujukan_instansi'));
				$data['kontak_rujukan_instansi']  = set_value('kontak_rujukan_instansi',$this->input->post('kontak_rujukan_instansi'));
				$data['id_prov']  = set_value('id_prov',$this->input->post('id_prov'));
	  		$data['id_kab']  = set_value('id_kab',$this->input->post('id_kab'));
	  		$data['id_kel']  = set_value('id_kel',$this->input->post('id_kel'));
	  		$data['id_kec']  = set_value('id_kec',$this->input->post('id_kec'));
		    $data['kab']=array("");
		    $data['kec']=array("");
		    $data['kel']=array("");
				$this->load->view("pelayanan/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($this->m_pendaftaran->simpan_rujukan_faskes()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('admin_pelayanan/faskes'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('admin_pelayanan/faskes'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('kol_rujukan_instansi','id_rujukan_instansi',$data['id']);
    		$data['kab'] = $this->m_rancak->ambil_data_dropdown_kabs($keuangan['id_prov']);
    		$data['kec'] = $this->m_rancak->ambil_data_dropdown_kecs($keuangan['id_kab']);
    		$data['kel'] = $this->m_rancak->ambil_data_dropdown_kels($keuangan['id_kec']);
				$data['nama_rujukan_instansi']  = set_value('nama_rujukan_instansi',$keuangan["nama_rujukan_instansi"]);
				$data['id_cara_masuk']  = set_value('id_cara_masuk',$keuangan["id_cara_masuk"]);
				$data['alamat_rujukan_instansi']  = set_value('alamat_rujukan_instansi',$keuangan["alamat_rujukan_instansi"]);
				$data['email_rujukan_instansi']  = set_value('email_rujukan_instansi',$keuangan["email_rujukan_instansi"]);
				$data['kontak_rujukan_instansi']  = set_value('kontak_rujukan_instansi',$keuangan["kontak_rujukan_instansi"]);
				$data['id_prov']  = set_value('id_prov',$keuangan["id_prov"]);
				$data['id_kab']  = set_value('id_kab',$keuangan["id_kab"]);
				$data['id_kel']  = set_value('id_kel',$keuangan["id_kel"]);
				$data['id_kec']  = set_value('id_kec',$keuangan["id_kec"]);
				$this->load->view("pelayanan/isi",$data);
      }
      if($mode=='simpan_edit'){
			  if($this->m_pendaftaran->edit_rujukan_faskes()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
					redirect(base_url('admin_pelayanan/faskes'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
					redirect(base_url('admin_pelayanan/faskes'));
			  }
      }
	}
}
/*  function ruangan($mode='view')
  {
	$data['page']  = "ruangan";
	$data['header'] = "RUANGAN";
	$data['title'] = "RUANGAN";
	$data['link_kembali'] = base_url();
	$data['link_awal'] = base_url('ruangan');
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
		echo json_encode($this->m_pendaftaran->ruangan_all());
	}
     else if($mode=='hapus'){
		$kondisi=array('id_kategori_sub'=>$id);
		$jml = $this->m_umum->jumlah_record_filter('produk',$kondisi);
			if($jml == 0){
			  if($this->m_umum->hapus_data('kategori_sub','id_kategori_sub',$data['id'])){
				$this->session->set_flashdata('sukses', 'Data berhasil Di Hapus');
				redirect(base_url('administrator/sub_kategori'));
			  }else{
				$this->session->set_flashdata('danger', 'Ada Masalah Hapus Data');
				redirect(base_url('administrator/sub_kategori'));
			  }
			}else{
				$this->session->set_flashdata('danger', 'Nama Sudah Di pakai di Produk');
				redirect(base_url('administrator/sub_kategori'));
			}
    } 
  else{
 		$data['cmd_status']=$this->m_rancak->cmd_status();
		$data['status']=$this->m_rancak->cmd_status();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		$data['nama_unit']  = set_value('nama_unit',$this->input->post("nama_unit"));
		$data['status_unit']  = set_value('status_unit',$this->input->post("status_unit"));
		$this->load->view("pelayanan/isi",$data);
      }
      if($mode=='simpan_tambah'){
		  if($this->m_pendaftaran->simpan_ruangan()){
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
			redirect(base_url('admin_pelayanan/ruangan'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
			redirect(base_url('admin_pelayanan/ruangan'));
		  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
		$keuangan    = $this->m_umum->ambil_data('ol_unit','id_unit',$data['id']);
		$data['nama_unit']  = set_value('nama_unit',$keuangan["nama_unit"]);
		$data['status_unit']  = set_value('status_unit',$keuangan["status_unit"]);
		$this->load->view("pelayanan/isi",$data);
      }
      if($mode=='simpan_edit'){
		  if($this->m_pendaftaran->edit_ruangan()){
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
			redirect(base_url('admin_pelayanan/ruangan'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
			redirect(base_url('admin_pelayanan/ruangan'));
		  }
      }
	}
  }*/
	function check_nik(){
		$nik=$this->input->post('nik');
		$kondisi=array('nik'=>$nik);
		$jml = $this->m_umum->jumlah_record_filter('ol_pegawai',$kondisi);
		if($jml == 0){
			echo "<span style='color:green'> NIK Tersedia.</span>";
		}else{
			echo "<span style='color:red'> NIK Sudah Ada</span>";
		}
	}
	function check_availability(){
		$username=$this->input->post('username');
		$username = strtolower($username);
		$username = str_replace(' ', '-', $username);
		$username = preg_replace('/[^A-Za-z0-9\-]/', '', $username);
		$kondisi=array('username'=>$username);
		$jml = $this->m_umum->jumlah_record_filter('ol_pegawai',$kondisi);
		if($jml == 0){
			echo "<span style='color:green'> Username Tersedia.</span>";
		}else{
			echo "<span style='color:red'> Username Sudah Ada</span>";
		}
	}
  function kab_data($id)
  {
    $dt=$this->m_rancak->ambil_data_dropdown_kab($id);
    echo json_encode($dt);
  }
  function kec_data($id)
  {
    $dt=$this->m_rancak->ambil_data_dropdown_kec($id);
    echo json_encode($dt);
  }
  function kel_data($id)
  {
    $dt=$this->m_rancak->ambil_data_dropdown_kel($id);
    echo json_encode($dt);
  }
  function jabfung_data($id)
  {
    if($id < 3){
      $ids = '1';
    }else{
      $ids = '3';
    }
    $dt=$this->m_rancak->ambil_data_dropdown_jabfung_status($ids);
    echo json_encode($dt);
  }
	function user($mode='view'){
		$data['page']="user"; 
		$data['header'] = "DATA USER";
		$data['title'] = "DATA USER";
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
		if($data['id'] == NULL OR empty($data['id'])){
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
				redirect(base_url('admin_pelayanan/user/view/'.$key));
			}
		}
		else if($mode=='data'){
			echo json_encode($this->m_pelayanan->member_all($data['id']));
		}
		else{
			$data['cmd_instansi'] = $this->m_ol_rancak->ambil_instansi_no_null();
			$data['opsi_status_perawat'] = $this->m_ol_rancak->status_perawat();
			$data['kol_kode_kewenangan_null'] = $this->m_ol_rancak->kol_kode_kewenangan_null();
			$data['cmd_tipe_pegawai'] = $this->m_ol_rancak->cmd_tipe_pegawai();
			$data['cmd_jabfung'] = $this->m_rancak->cmd_jabfung();
			$data['status'] = $this->m_rancak->cmd_status();
			$data['gender'] = $this->m_rancak->cmd_jk();
			$data['ambil_data_rujukan_instansi'] = $this->m_ol_rancak->ambil_data_rujukan_working();
			$data['cmd_unit_null'] = $this->m_rancak->struktur_jabatan_as_unit();
			$data['cmd_agama'] = $this->m_rancak->cmd_agama();
			$data['cmd_status_kawin'] = $this->m_rancak->cmd_status_kawin();
			$data['cmd_pendidikan'] = $this->m_rancak->cmd_pendidikan();
  		$data['cmd_level'] = $this->m_ol_rancak->cmd_level($program['user_level']);
  		$data['cmd_status'] = $this->m_rancak->cmd_status();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
    		$data['title'] = "TAMBAH USER";
    		$data['nama_pegawai']  = set_value('nama_pegawai',$this->input->post("nama_pegawai"));
    		$data['jk']  = set_value('jk',$this->input->post("jk"));    		
    		$data['tmp_lahir']  = set_value('tmp_lahir',$this->input->post("tmp_lahir"));    		
    		$data['tgl_lahir']  = set_value('tgl_lahir',date('d-m-Y'));    		
    		$data['email']  = set_value('email',$this->input->post("email"));
    		$data['no_hp']  = set_value('no_hp',$this->input->post("no_hp"));
    		$data['nik']  = set_value('nik',$this->input->post("nik"));
    		$data['nip']  = set_value('nip',$this->input->post("nip"));
    		$data['no_profesi']  = set_value('no_profesi',$this->input->post("no_profesi"));
    		$data['id_status_kawin']  = set_value('id_status_kawin',$this->input->post("id_status_kawin"));
    		$data['id_agama']  = set_value('id_agama',$this->input->post("id_agama"));
    		$data['id_pendidikan']  = set_value('id_pendidikan',$this->input->post("id_pendidikan"));
    		$data['id_jabatan_fungsional']  = set_value('id_jabatan_fungsional',$this->input->post("id_jabatan_fungsional"));
    		$data['alamat']  = set_value('alamat',$this->input->post("alamat"));
    		$data['foto']  = set_value('foto',$this->input->post("foto"));
    		$data['tipe_pegawai']  = set_value('tipe_pegawai',$this->input->post("tipe_pegawai"));
    		$data['status_perawat']  = set_value('status_perawat',$this->input->post("status_perawat"));
    		$data['id_kode_kewenangan']  = set_value('id_kode_kewenangan',$this->input->post("id_kode_kewenangan"));
    		$data['id_level']  = set_value('id_level',$this->input->post("id_level"));
    		$data['username']  = set_value('username',$this->input->post("username"));
    		$data['id_instansi']  = set_value('id_instansi',$this->input->post("id_instansi"));
    		$this->form_validation->set_rules('nama_pegawai','nama_pegawai','required');
        if ($this->form_validation->run() === FALSE){
			       $this->tampil($data);
        }else{
					$ptn = "/^0/";  // Regex
					$str = $this->input->post('no_hp'); 
					$nik = $this->input->post('nik');
					$rpltxt = "62";  // Replacement string
					$no_hp = preg_replace($ptn, $rpltxt, $str);
					$username= $this->input->post('username');
					$username = strtolower($username);
					$username = str_replace(' ', '-', $username);
					$username = preg_replace('/[^A-Za-z0-9\-]/', '', $username);
					$kondisi=array('username'=>$username);
					$jml = $this->m_umum->jumlah_record_filter('ol_pegawai',$kondisi);
					$kondisi2=array('nik'=>$nik);
					$jml2 = $this->m_umum->jumlah_record_filter('ol_pegawai',$kondisi2);
					if($jml == 0){
						if($jml2 == 0){
							if($Q = $this->m_pelayanan->simpan_aktifasi()){
								$this->m_pelayanan->simpan_user($Q);
								$this->session->set_flashdata('sukses', 'Data berhasil Di Tambah');
								redirect(base_url('admin_pelayanan/user'));
							}else{
								$this->session->set_flashdata('danger', 'Ada Masalah Edit Data');
								redirect(base_url('admin_pelayanan/user'));
							}
						}else{
						  $this->session->set_flashdata('danger', 'No KTP Sudah Ada');
						  redirect(base_url('admin_pelayanan/user'));
						}
					}
					else{
						$this->session->set_flashdata('danger', 'Username Sudah Ada');
						redirect(base_url('admin_pelayanan/user'));
					}
        }
      }
			if($mode=='edit'){
				$data['page'] =  $data['page']."_edit";
					$take = $this->m_umum->ambil_data('ol_pegawai','barcode_pegawai',$data['id']);		
					$data['nama_pegawai']  = set_value('nama_pegawai',$take['nama_pegawai']);
					$data['jk']  = set_value('jk',$take['jk']);
					$data['tmp_lahir']  = set_value('tmp_lahir',$take['tmp_lahir']);
					$data['tgl_lahir']  = set_value('tgl_lahir',date('d-m-Y', strtotime($take['tgl_lahir'])));
					$data['email']  = set_value('email',$take['email']);
					$data['no_hp']  = set_value('no_hp',$take['no_hp']);		
					$data['nik']  = set_value('nik',$take['nik']);			
					$data['tipe_pegawai']  = set_value('tipe_pegawai',$take['tipe_pegawai']);
					$data['nip']  = set_value('nip',$take['nip']);
					$data['no_profesi']  = set_value('no_profesi',$take['no_profesi']);
					$data['id_status_kawin']  = set_value('id_status_kawin',$take['id_status_kawin']);
					$data['id_agama']  = set_value('id_agama',$take['id_agama']);
					$data['id_pendidikan']  = set_value('id_pendidikan',$take['id_pendidikan']);
					$data['id_jabatan_fungsional']  = set_value('id_jabatan_fungsional',$take['id_jabatan_fungsional']);
					$data['alamat']  = set_value('alamat',$take['alamat']);
					$data['status_perawat']  = set_value('status_perawat',$take['status_perawat']);
					$data['id_kode_kewenangan']  = set_value('id_kode_kewenangan',$take['id_kode_kewenangan']);
					$data['status_pegawai']  = set_value('status_pegawai',$take['status_pegawai']);
					$data['id_pengcab']  = set_value('id_pengcab',$take['id_pengcab']);
					$data['username']  = set_value('username',$take['username']);
					$data['password_lama']  = set_value('password_lama',$take['password']);
					$datapc = $this->m_umum->ambil_data('jabatan_fungsional','id_jabatan_fungsional',$take['id_jabatan_fungsional']);
					$data['null_pengcab'] = $this->m_ol_rancak->ambil_data_pengcab($datapc['id_jabatan']);
					$data['password']  = set_value('password',$this->input->post("password"));
					$this->form_validation->set_rules('nama_pegawai','nama_pegawai','required');
				if ($this->form_validation->run() === FALSE){
					$this->tampil($data);
				}else{
					$nik = $this->input->post('nik');
					$nik_lama = $this->input->post('nik_lama');
					$kondisi=array('nik'=>$nik,'nik !='=>$nik_lama);
					$jml = $this->m_umum->jumlah_record_filter('ol_pegawai',$kondisi);
					if($jml == 0){
						if($this->m_pelayanan->edit_pegawai()){
							$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
							redirect(base_url('admin_pelayanan/user'));
						}else{
							$this->session->set_flashdata('danger', 'Ada Masalah Edit Data');
							redirect(base_url('admin_pelayanan/user'));
						}
					}
					else{
						$this->session->set_flashdata('danger', 'Nomor KTP Sudah Ada');
						redirect(base_url('admin_pelayanan/user'));
					}
				}
			}
			if($mode=='reset'){
			  if($this->m_pelayanan->reset_password($data['id'])){
  				$this->session->set_flashdata('sukses', 'Password di Reset menjadi 7654321');
  				redirect(base_url('admin_pelayanan/user'));
			  }else{
					$this->session->set_flashdata('danger', 'Masalah Edit Data');
					redirect(base_url('admin_pelayanan/user'));
			  }
			}
		}
	}
	function akses($mode='view'){
		$data['page']="akses"; 
		$data['header'] = "DATA MULTI AKSES PEGAWAI / MEMBER";
		$data['title'] = "DATA MULTI AKSES PEGAWAI / MEMBER";
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
		$data['int']   = $this->uri->segment(5, 0);
		if($mode=='view'){
			$this->tampil($data);
		}
		else if($mode=='data'){
			echo json_encode($this->m_pelayanan->hak_akses_all($data['id']));
		}
		else{
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
        $data['hak_akses'] = $this->m_ol_rancak->multi_akses_pelayanan($program['akses']);
        $pegawaiw = $this->m_umum->ambil_data('ol_pegawai','barcode_pegawai',$data['id']);
        $data['id_pegawai'] = $pegawaiw["id_pegawai"];
    		$this->load->view("pelayanan/isi",$data);
      }
      if($mode=='simpan_tambah'){
    		$id_pegawai= $this->input->post('barcode_pegawai');
			  $this->m_pelayanan->simpan_pegawai_akses();
				$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
				redirect(base_url('admin_pelayanan/akses/view/'.$id_pegawai));
      }
			if($mode=='status'){
					$pegakses = $this->m_umum->ambil_data('ol_akses','id_ol_akses',$data['int']);
					$peg = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$pegakses['id_pegawai']);
				  if($this->m_pelayanan->status_pegawai_akses($data['id'],$data['int'])){
						$this->session->set_flashdata('sukses', 'Sukses Rubah Status');
						redirect(base_url('admin_pelayanan/akses/view/'.$peg['barcode_pegawai']));	  	
				  }else{
						$this->session->set_flashdata('danger', 'Masalah Edit Data');
						redirect(base_url('admin_pelayanan/akses/view/'.$peg['barcode_pegawai']));
				  }
			}
		}
	}
  function pelayanan($mode='view')
  {
	$data['page']  = "pelayanan";
	$data['header'] = "SETING PELAYANAN / UNIT YANG DITUJU";
	$data['title'] = "SETING PELAYANAN / UNIT YANG DITUJU";
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
	$data['id']   = $this->uri->segment(4, 0);
	//======================= IMPORTANT ======================================
    if($mode=='view'){
			$this->tampil($data);
		}
    else if($mode=='data'){
		echo json_encode($this->m_pendaftaran->pelayanan_all());
		}
		else{
			$data['cmd_ruangan'] = $this->m_ol_rancak->ambil_data_unit_pelayanan();
	    if($mode=='seting'){
	      $data['page'] =  $data['page']."_seting";
				$take = $this->m_umum->ambil_data('kol_working','id_working',$this->session->refer);
				$data['pelayanan']  = set_value('pelayanan',explode(",", $take['pelayanan']));	      
	  		$this->load->view("pelayanan/isi",$data);
	    }
	    if($mode=='simpan_seting'){  
			  $this->m_pendaftaran->simpan_pelayanan_working();
				$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
				redirect(base_url('admin_pelayanan/pelayanan'));
	    } 
		}
  }
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("pelayanan/header",$data);
	$this->load->view("pelayanan/isi");
	$this->load->view("footer");
	$this->load->view("pelayanan/jsload");
	$this->load->view("pelayanan/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_top",$data);
	$this->load->view("pelayanan/isi");
	$this->load->view("footer");
	$this->load->view("pelayanan/jsload");
	$this->load->view("pelayanan/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
