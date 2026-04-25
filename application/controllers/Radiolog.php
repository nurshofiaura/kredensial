<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Radiolog extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
          $this->load->model('m_ol_rancak');
          $this->load->model('m_radiolog');$this->login_kah();
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
		$this->daftar();
	}
  function format_hasil($mode='view')   
  {
    $data['page']  = "format_hasil";  
    $data['header'] = "FORMAT HASIL RADIOLOGI";
    $data['title'] = "FORMAT HASIL RADIOLOGI";
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
    $data['id2']   = $this->uri->segment(5, 0);
    if($mode=='view'){
      $this->tampil($data);
    }    
    else if($mode=='data'){
      echo json_encode($this->m_radiolog->normal_all()); 
    }
  else{
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
        $data['cmd_tindakan'] = $this->m_rancak->ambil_tindakan_no_null(2);
        $data['nama_pemeriksaan_format']  = set_value('nama_pemeriksaan_format',$this->input->post("nama_pemeriksaan_format"));
        $data['id_tindakan']  = set_value('id_tindakan',$this->input->post("id_tindakan"));
        $data['hasil_pemeriksaan_format']  = set_value('hasil_pemeriksaan_format',$this->input->post("hasil_pemeriksaan_format"));
        $data['kesimpulan_pemeriksaan_format']  = set_value('kesimpulan_pemeriksaan_format',$this->input->post("kesimpulan_pemeriksaan_format"));
        $this->load->view("radiolog/isi",$data);
      }
      if($mode=='simpan_tambah'){     
          if($this->m_radiolog->simpan_normal()){ 
          $this->session->set_flashdata('sukses', 'Data berhasil Di Tambah');
          redirect(base_url('radiolog/format_hasil'));
          }else{
            $this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data');
          redirect(base_url('radiolog/format_hasil'));
          }
      } 
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
          $d = $this->m_umum->ambil_data('pemeriksaan_format','id_pemeriksaan_format',$data['id']);
          $data['id_pemeriksaan_format'] = set_value('id_pemeriksaan_format',$d["id_pemeriksaan_format"]);
          $data['nama_pemeriksaan_format'] = set_value('nama_pemeriksaan_format',$d["nama_pemeriksaan_format"]);
          $data['hasil_pemeriksaan_format'] = set_value('hasil_pemeriksaan_format',$d["hasil_pemeriksaan_format"]);
          $data['kesimpulan_pemeriksaan_format'] = set_value('kesimpulan_pemeriksaan_format',$d["kesimpulan_pemeriksaan_format"]);
        $this->load->view("radiolog/isi",$data);
      }
      if($mode=='simpan_edit'){
        if($this->m_radiolog->edit_normal()){ 
          $this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
          redirect(base_url('radiolog/format_hasil'));
        }else{
          $this->session->set_flashdata('danger', 'Ada Masalah Edit Data');
        redirect(base_url('radiolog/format_hasil'));
        }
      }       
      if($mode=='status'){
        if($this->m_radiolog->non_normal($data['id'],$data['id2'])){ 
          $this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
          redirect(base_url('radiolog/format_hasil'));
        }else{
          $this->session->set_flashdata('danger', 'Ada Masalah Edit Data');
        redirect(base_url('radiolog/format_hasil'));
        }
      }
    }
  }
	function daftar($mode='view'){
	$data['page']="daftar";
	$data['header'] = "E REKAM MEDIS";
	$data['title'] = "E REKAM MEDIS";
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
  $data['first_date'] = $this->uri->segment(4, 0);
	$data['last_date']   = $this->uri->segment(5, 0);
  $trim_keyword   = urldecode(trim($this->uri->segment(6, 0)));
	$replace_keyword   = preg_replace('/\s+/', ' ', $trim_keyword);
	$data['key'] = str_replace(' ', '-', $replace_keyword);
	if($data['key'] == NULL OR empty($data['key'])){
		$data['key'] = "";
	}
	if($mode=='view'){
    if($data['first_date'] == NULL OR empty($data['first_date'])){
			$data['first_date'] = "01-".date('m-Y');
		}
    if($data['last_date'] == NULL OR empty($data['last_date'])){
			$data['last_date'] = date('d-m-Y');
		}
	  $this->tampil($data);
    $action = $this->input->post('action');
		if($action == 'BtnProses') {
      $first_date = $this->input->post("first_date");
			$last_date = $this->input->post("last_date");
      $trim_keyword   = urldecode(trim($this->input->post("key")));
			$replace_keyword   = preg_replace('/\s+/', ' ', $trim_keyword);
			$key = str_replace(' ', '-', $replace_keyword);
			redirect(base_url('radiolog/daftar/view/'.$first_date.'/'.$last_date.'/'.$key));
		}
	}
  else if($mode=='data'){
		echo json_encode($this->m_radiolog->pendaftaran_all($data['first_date'],$data['last_date'],$data['key']));
	}
/*  else if($mode=='baca'){
    echo json_encode($this->m_radiolog->baca_all($data['first_date']));
  }*/
    else if($mode=='histori'){
    echo json_encode($this->m_ol_rancak->histori_px($data['first_date']));
  }
    else if($mode=='penunjang'){
    echo json_encode($this->m_ol_rancak->penunjang_luar($data['first_date']));
  }
    else if($mode=='hasil_lab_all'){
    echo json_encode($this->m_ol_rancak->hasil_lab_all($data['first_date']));
  }
    else if($mode=='sparkling'){
    echo json_encode($this->m_ol_rancak->tabel_sparkling_line($data['first_date']));
  }
    else if($mode=='radiolog'){
    echo json_encode($this->m_ol_rancak->tabel_radiologi_result($data['first_date']));
  }
	else{
    if($mode=='data_radiologi'){
      $data['page'] =  $data['page']."_data_radiologi";
      $data['kembali'] = base_url('radiolog/daftar');
      $pd = $this->m_ol_rancak->ambil_data_pasien($data['first_date']);
      $data['barcode_pendaftaran_unit'] = $pd['barcode_pendaftaran_unit'];
      $data['barcode_pendaftaran'] = $pd['barcode_pendaftaran'];
      $data['wkt_daftar'] = $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($pd['wkt_daftar'])));
      // ==================================================== POKOK
      $this->tampil_top($data);
    }
    if($mode=='data_lab'){
      $data['page'] =  $data['page']."_data_lab";
      $data['kembali'] = base_url('laboratorium/daftar');
      $pd = $this->m_ol_rancak->ambil_data_pasien($data['first_date']);
      $data['barcode_pendaftaran_unit'] = $pd['barcode_pendaftaran_unit'];
      $data['barcode_pendaftaran'] = $pd['barcode_pendaftaran'];
      $data['wkt_daftar'] = $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($pd['wkt_daftar'])));
      // ==================================================== POKOK
      $this->tampil_top($data);
    }
    if($mode=='lab_view'){
      $data['page'] =  $data['page']."_lab_view";
      $pd = $this->m_ol_rancak->ambil_data_pasien($data['first_date']);
      $data['barcode_pendaftaran_unit'] = $pd['barcode_pendaftaran_unit'];
      $data['barcode_pendaftaran'] = $pd['barcode_pendaftaran'];
      $data['wkt_daftar'] = $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($pd['wkt_daftar'])));
      $data['lab'] = $this->m_ol_rancak->ambil_pemeriksaan_laboratorium_pd($data['first_date']);
      $this->load->view("radiolog/isi",$data);
    }
    if($mode=='data_dokter'){
      $data['page'] =  $data['page']."_data_dokter";
      $data['kembali'] = base_url('radiolog/daftar');
      $pd = $this->m_ol_rancak->ambil_data_pasien($data['first_date']);
      $data['barcode_pendaftaran_unit'] = $pd['barcode_pendaftaran_unit'];
      $data['barcode_pendaftaran'] = $pd['barcode_pendaftaran'];
      $data['wkt_daftar'] = $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($pd['wkt_daftar'])));
      $data['dokter'] = $this->m_ol_rancak->ambil_pemeriksaan_dokter($data['first_date']);
      // ==================================================== POKOK
      $this->tampil_top($data);
    }
    if($mode=='data_vital'){
      $data['page'] =  $data['page']."_data_vital";
      $data['kembali'] = base_url('radiolog/daftar');
      $pd = $this->m_ol_rancak->ambil_data_pasien($data['first_date']);
      $data['barcode_pendaftaran_unit'] = $pd['barcode_pendaftaran_unit'];
      $data['barcode_pendaftaran'] = $pd['barcode_pendaftaran'];
      $data['wkt_daftar'] = $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($pd['wkt_daftar'])));
      $data['vital'] = $this->m_ol_rancak->ambil_data_vital($pd['barcode_pendaftaran']);
      // ==================================================== POKOK
      $this->tampil_top($data);
    }
    if($mode=='grafik_vital'){
      $data['page'] =  $data['page']."_grafik_vital";
      $data['kembali'] = base_url('radiolog/daftar');
      $data['grafik'] = $this->m_ol_rancak->grafik_sparkling_line($data['first_date']);
      $pd = $this->m_ol_rancak->ambil_data_pasien($data['first_date']);
      $data['barcode_pendaftaran_unit'] = $pd['barcode_pendaftaran_unit'];
      $data['barcode_pendaftaran'] = $pd['barcode_pendaftaran'];
      $data['wkt_daftar'] = $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($pd['wkt_daftar'])));
      $data['vital'] = $this->m_ol_rancak->ambil_data_vital($pd['barcode_pendaftaran']);
      // ==================================================== POKOK
      $this->tampil_top($data);
    }
    if($mode=='data_asuhan'){
      $data['page'] =  $data['page']."_data_asuhan";
      $data['kembali'] = base_url('radiolog/daftar');
      $pd = $this->m_ol_rancak->ambil_data_pasien($data['first_date']);
      $data['barcode_pendaftaran_unit'] = $pd['barcode_pendaftaran_unit'];
      $data['barcode_pendaftaran'] = $pd['barcode_pendaftaran'];
      $data['wkt_daftar'] = $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($pd['wkt_daftar'])));
      $data['vital'] = $this->m_ol_rancak->ambil_data_vital($pd['barcode_pendaftaran']);
      $data['ambil_data_asuhan'] = $this->m_ol_rancak->ambil_data_asuhan($data['first_date']);
      // ==================================================== POKOK
      $data['array_rr_ritme']  = array('1'=>'Terartur','0'=>'Tidak Teratur');  
      $data['kol_gcs_eye']  = $this->m_umum->ambil_data_dropdown('kol_gcs_eye');   
      $data['kol_gcs_motorik']  = $this->m_umum->ambil_data_dropdown('kol_gcs_motorik');   
      $data['kol_gcs_verb']  = $this->m_umum->ambil_data_dropdown('kol_gcs_verb');      
      $data['asuhan_pengkajian_1']=$this->m_ol_rancak->asuhan_pengkajian(1);    
      $data['asuhan_pengkajian_2']=$this->m_ol_rancak->asuhan_pengkajian(2);    
      $data['asuhan_pengkajian_3']=$this->m_ol_rancak->asuhan_pengkajian(3);    
      $data['asuhan_pengkajian_4']=$this->m_ol_rancak->asuhan_pengkajian(4);    
      $data['asuhan_pengkajian_5']=$this->m_ol_rancak->asuhan_pengkajian(5);    
      $data['asuhan_pengkajian_6']=$this->m_ol_rancak->asuhan_pengkajian(6);    
      $data['asuhan_pengkajian_7']=$this->m_ol_rancak->asuhan_pengkajian(7);    
      $data['asuhan_pengkajian_8']=$this->m_ol_rancak->asuhan_pengkajian(8);    
      $data['asuhan_pengkajian_9']=$this->m_ol_rancak->asuhan_pengkajian(9);    
      $data['asuhan_pengkajian_10']=$this->m_ol_rancak->asuhan_pengkajian(10);    
      $data['asuhan_pengkajian_11']=$this->m_ol_rancak->asuhan_pengkajian(11);    
      $data['asuhan_pengkajian_12']=$this->m_ol_rancak->asuhan_pengkajian(12);    
      $data['asuhan_pengkajian_13']=$this->m_ol_rancak->asuhan_pengkajian(13);    
      $data['asuhan_pengkajian_14']=$this->m_ol_rancak->asuhan_pengkajian(14);    
      $data['asuhan_pengkajian_15']=$this->m_ol_rancak->asuhan_pengkajian(15);    
      $data['asuhan_masalah_1']=$this->m_ol_rancak->asuhan_masalah(1);    
      $data['asuhan_masalah_2']=$this->m_ol_rancak->asuhan_masalah(2);    
      $data['asuhan_masalah_3']=$this->m_ol_rancak->asuhan_masalah(3);    
      $data['asuhan_masalah_4']=$this->m_ol_rancak->asuhan_masalah(4);    
      $data['asuhan_masalah_5']=$this->m_ol_rancak->asuhan_masalah(5);    
      $data['asuhan_masalah_6']=$this->m_ol_rancak->asuhan_masalah(6);    
      $data['asuhan_masalah_7']=$this->m_ol_rancak->asuhan_masalah(7);    
      $data['asuhan_masalah_8']=$this->m_ol_rancak->asuhan_masalah(8);    
      $data['asuhan_implementasi_1']=$this->m_ol_rancak->asuhan_implementasi(1);    
      $data['asuhan_implementasi_2']=$this->m_ol_rancak->asuhan_implementasi(2);    
      $data['asuhan_implementasi_3']=$this->m_ol_rancak->asuhan_implementasi(3);    
      $data['asuhan_implementasi_4']=$this->m_ol_rancak->asuhan_implementasi(4);    
      $data['asuhan_implementasi_5']=$this->m_ol_rancak->asuhan_implementasi(5);    
      $data['asuhan_implementasi_6']=$this->m_ol_rancak->asuhan_implementasi(6);    
      $data['asuhan_implementasi_7']=$this->m_ol_rancak->asuhan_implementasi(7);    
      $data['asuhan_implementasi_8']=$this->m_ol_rancak->asuhan_implementasi(8);    
      $data['asuhan_implementasi_9']=$this->m_ol_rancak->asuhan_implementasi(9);    
      $data['asuhan_implementasi_10']=$this->m_ol_rancak->asuhan_implementasi(10);
      $this->tampil_top($data);
    }
    if($mode=='data_ps'){
      $data['page'] =  $data['page']."_data_ps";
      $data['kembali'] = base_url('radiolog/daftar');
      $pd = $this->m_ol_rancak->ambil_data_pasien($data['first_date']);
      $data['barcode_pendaftaran_unit'] = $pd['barcode_pendaftaran_unit'];
      $data['barcode_pendaftaran'] = $pd['barcode_pendaftaran'];
      $data['wkt_daftar'] = $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($pd['wkt_daftar'])));
      $data['vital'] = $this->m_ol_rancak->ambil_data_vital($pd['barcode_pendaftaran']);
      $data['rm'] = $pd['rm'];
      $data['nama_pasien'] = $pd['nama_pasien'];
      $data['umur'] = $pd['umur'];
      $data['nama_status_kawin'] = $pd['nama_status_kawin'];
      $data['nama_pasien'] = $pd['nama_pasien'];
      $data['nik'] = $pd['nik'];
      $data['wkt_daftar'] = $this->m_rancak->fullBulan(date('d-m-Y', strtotime($pd['wkt_daftar'])));
      $data['ttl'] = $pd['tmp_lahir'].", ".date('d-m-Y', strtotime($pd['tgl_lahir']));
      $data['alamat'] = $pd['alamat'].", ".$pd['nama_kec'].", ".$pd['nama_kel'].", ".
      $pd['nama_kab'].", ".$pd['nama_prov'];
      $data['nama_golongan_darah'] = $pd['nama_golongan_darah'];
      $data['nama_pasangan'] = $pd['nama_pasangan'];
      $data['nama_ayah'] = $pd['nama_ayah'];
      $data['nama_ibu'] = $pd['nama_ibu'];
      $data['nama_agama'] = $pd['nama_agama'];
      $data['nama_pekerjaan'] = $pd['nama_pekerjaan'];
      $data['nama_pendidikan'] = $pd['nama_pendidikan'];
      // ==================================================== POKOK
      $this->tampil_top($data);
    }
    if($mode=='data_penunjang'){
      $data['page'] =  $data['page']."_data_penunjang";
      $data['kembali'] = base_url('radiolog/daftar');
      $pd = $this->m_ol_rancak->ambil_data_pasien($data['first_date']);
      $data['barcode_pendaftaran_unit'] = $pd['barcode_pendaftaran_unit'];
      $data['barcode_pendaftaran'] = $pd['barcode_pendaftaran'];
      $data['wkt_daftar'] = $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($pd['wkt_daftar'])));
      $data['vital'] = $this->m_ol_rancak->ambil_data_vital($pd['barcode_pendaftaran']);
      $data['rm'] = $pd['rm'];
      $data['nama_pasien'] = $pd['nama_pasien'];
      $data['umur'] = $pd['umur'];
      $data['nama_status_kawin'] = $pd['nama_status_kawin'];
      $data['nama_pasien'] = $pd['nama_pasien'];
      $data['nik'] = $pd['nik'];
      $data['wkt_daftar'] = $this->m_rancak->fullBulan(date('d-m-Y', strtotime($pd['wkt_daftar'])));
      $data['ttl'] = $pd['tmp_lahir'].", ".date('d-m-Y', strtotime($pd['tgl_lahir']));
      $data['alamat'] = $pd['alamat'].", ".$pd['nama_kec'].", ".$pd['nama_kel'].", ".
      $pd['nama_kab'].", ".$pd['nama_prov'];
      $data['nama_golongan_darah'] = $pd['nama_golongan_darah'];
      $data['nama_pasangan'] = $pd['nama_pasangan'];
      $data['nama_ayah'] = $pd['nama_ayah'];
      $data['nama_ibu'] = $pd['nama_ibu'];
      $data['nama_agama'] = $pd['nama_agama'];
      $data['nama_pekerjaan'] = $pd['nama_pekerjaan'];
      $data['nama_pendidikan'] = $pd['nama_pendidikan'];
      // ==================================================== POKOK
      $this->tampil_top($data);
    }
    if($mode=='read'){
      $data['page'] =  $data['page']."_read";
      $data['kembali'] = base_url('radiolog/daftar');
      $pd = $this->m_ol_rancak->ambil_data_redres_to_punit($data['first_date']);
      $data['format'] = $this->m_ol_rancak->ambil_data_pemeriksaan_format($pd['id_tindakan'],$pd['id_radiolog']);
      $data['nilai_kritis'] = array('0'=>'Tidak Kritis','1'=>'Kritis');
      $data['id_pemeriksaan_format']  = set_value('id_pemeriksaan_format',$this->input->post("id_pemeriksaan_format"));
      $data['id_nilai_kritis']  = set_value('id_nilai_kritis',0);
      $data['barcode_radiologi_result'] = $pd['barcode_radiologi_result'];
      $data['barcode_pemeriksaan'] = $pd['barcode_pemeriksaan'];
      $data['id_tindakan'] = $pd['id_tindakan'];
      $data['id_radiolog'] = $pd['id_radiolog'];
      $data['id_nilai_kritis'] = $pd['id_nilai_kritis'];
      $data['kesimpulan_radiologi_result'] = $pd['kesimpulan_radiologi_result'];
      $data['hasil_radiologi_result'] = $pd['hasil_radiologi_result'];
      $this->load->view("radiolog/isi",$data);
    }
    if($mode=='simpan_read'){
      $this->m_radiolog->simpan_bacaan();
      $this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
      redirect(base_url('radiolog/daftar'));
    }
    if($mode=='format_hasil_awal_clicked'){
      $data['page'] =  $data['page']."_format_hasil_awal_clicked"; 
      $hasnor = $this->m_umum->ambil_data('pemeriksaan_format','id_pemeriksaan_format',$data['first_date']);
      $data['hasil_radiologi_result'] = set_value('hasil_radiologi_result',$hasnor["hasil_pemeriksaan_format"]);
      $data['kesimpulan_radiologi_result'] = set_value('kesimpulan_radiologi_result',$hasnor["kesimpulan_pemeriksaan_format"]);
      $this->load->view("radiolog/isi",$data);
    } 
    if($mode=='format_hasil_awal'){
      $data['page'] =  $data['page']."_format_hasil_awal"; 
      $hasnor = $this->m_umum->ambil_data('radiologi_result','barcode_radiologi_result',$data['first_date']);
      $data['hasil_radiologi_result'] = set_value('hasil_radiologi_result',$hasnor["hasil_radiologi_result"]);
      $data['kesimpulan_radiologi_result'] = set_value('kesimpulan_radiologi_result',$hasnor["kesimpulan_radiologi_result"]);
      $this->load->view("radiolog/isi",$data);
    }   
    if($mode=='pdf_hasil'){
      $report = $this->load->view('cetak/kl_hasil_ro', $data, TRUE);
      $apk  =$this->m_ol_rancak->ambil_data_redres_to_punit($data['first_date']);
      $filename = "hasil-radiologi-"."-".$apk['no_pendaftaran']."-".$apk['rm']."-".$apk['nama_pasien'].".pdf";
      $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
      $mpdf->AddPage('P', '', '', '', 2, 15, 15, 5, 10, 3, 3);
      $mpdf->SetDisplayMode('fullpage');
      $mpdf->SetTitle($data['header']);
      $mpdf->SetAuthor($data['title']);
      $mpdf->defaultheaderline = 0;
        $mpdf->defaultfooterline = 0;
      $mpdf->shrink_tables_to_fit = 1;
  //    $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
      for ($i = 1; $i > 2; $i++) {
      $mpdf->SetHTMLFooter('');
      }
      ini_set("pcre.backtrack_limit", "5000000");
      $mpdf->WriteHTML($report);
      $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
  //    $mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'P','margin_left' => '5','margin_right' => '5','margin_top' => '5','margin_bottom' => '5']);
  //    $mpdf = new \Mpdf\Mpdf(['format' => 'Legal']);
    // Define a default page size/format by array - page will be 190mm wide x 236mm height
    //  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [190, 236]]);
    // Define a default Landscape page size/format by name
/*    $mpdf->WriteHTML('Your Foreword and Introduction');
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
	$this->load->view("radiolog/header",$data);
	$this->load->view("radiolog/isi");
	$this->load->view("footer");
	$this->load->view("radiolog/jsload");
	$this->load->view("radiolog/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_topol",$data);
	$this->load->view("radiolog/isi");
	$this->load->view("footer");
	$this->load->view("radiolog/jsload");
	$this->load->view("radiolog/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
