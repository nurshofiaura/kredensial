<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Dokter extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
          $this->load->model('m_ol_rancak');
          $this->load->model('m_dokter');
          $this->login_kah();
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
  function data_pemeriksaan_radiologi($id)
  {
    $idt = array(2);
    $dt=$this->m_rancak->ambil_tindakan_radiologi($id,$idt);
    $data = array();
    foreach($dt as $row){
      $data[] = array("id"=>$row['barcode_tindakan_tarif'], "text"=>$row['nama_tindakan'].' - ( '.$row['nama_golongan_pemeriksaan'].' - Tarif/Biaya Tindakan : Rp.'.number_format($row['harga_tindakan']));
    }
    echo json_encode($data);
  }
  function data_pemeriksaan_lab($id)
  {
    $idt = array(3);
    $dt=$this->m_rancak->ambil_tindakan_radiologi($id,$idt);
    $data = array();
    foreach($dt as $row){
      $data[] = array("id"=>$row['barcode_tindakan_tarif'], "text"=>$row['nama_tindakan'].' - ( '.$row['nama_golongan_pemeriksaan'].' - Tarif/Biaya Tindakan : Rp.'.number_format($row['harga_tindakan']));
    }
    echo json_encode($data);
  }
  function data_pemeriksaan_dokter($id)
  {
    $idt = array(0,6);
    $dt=$this->m_rancak->ambil_tindakan_radiologi($id,$idt);
		$data = array();
		foreach($dt as $row){
			$data[] = array("id"=>$row['barcode_tindakan_tarif'], "text"=>$row['nama_tindakan'].' - ( '.$row['nama_golongan_pemeriksaan'].' - Tarif/Biaya Tindakan : Rp.'.number_format($row['harga_tindakan']));
		}
		echo json_encode($data);
  }
  function data_pemeriksaan_edit($id)
  {
    $dt=$this->m_ol_rancak->ambil_data_edit_pemeriksaan_clicked($id,1);
    echo json_encode($dt);
  }
  function cari_icd10(){
    $id=$this->input->get('query');
    $hasil=array();
    $data=$this->m_ol_rancak->a_icd10($id);
    $hasil['suggestions']=$data;
    echo json_encode($hasil);
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
		$data['first_date']   = $this->uri->segment(4, 0);
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
				redirect(base_url('dokter/daftar/view/'.$first_date.'/'.$last_date.'/'.$key));
			}
		}
    else if($mode=='data'){
		  echo json_encode($this->m_dokter->pendaftaran_all($data['first_date'],$data['last_date'],$data['key']));
	  }
    else if($mode=='bil_dokter'){
		echo json_encode($this->m_dokter->ambil_pemeriksaan_dokter($data['first_date']));
	}
    else if($mode=='bil_radiologi'){
    echo json_encode($this->m_dokter->ambil_pemeriksaan_radiologi($data['first_date']));
  }
    else if($mode=='bil_lab'){
    echo json_encode($this->m_dokter->ambil_pemeriksaan_labe($data['first_date']));
  }
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
  else if($mode=='pmr'){
    if($data['first_date'] == NULL OR empty($data['first_date'])){
      $data['first_date'] = '0';
    }
  echo json_encode($this->m_ugd->pemeriksaan_penunjang_all($data['first_date']));
  }
	else{
		$data['hamile']  = $this->m_rancak->cmd_hamil();
    $data['cmd_fat'] = $this->m_rancak->cmd_fat();
    $data['cmd_kelas'] = $this->m_rancak->cmd_kelas();
    if($mode=='data_dokter'){
      $data['page'] =  $data['page']."_data_dokter";
      $data['kembali'] = base_url('dokter/daftar');
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
      $data['kembali'] = base_url('dokter/daftar');
      $pd = $this->m_ol_rancak->ambil_data_pasien($data['first_date']);
      $data['barcode_pendaftaran_unit'] = $pd['barcode_pendaftaran_unit'];
      $data['barcode_pendaftaran'] = $pd['barcode_pendaftaran'];
      $data['wkt_daftar'] = $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($pd['wkt_daftar'])));
      $data['vital'] = $this->m_ol_rancak->ambil_data_vital($pd['barcode_pendaftaran']);
      // ==================================================== POKOK
      $this->tampil_top($data);
    }
    if($mode=='data_radiologi'){
      $data['page'] =  $data['page']."_data_radiologi";
      $data['kembali'] = base_url('dokter/daftar');
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
      $this->load->view("dokter/isi",$data);
    }
    if($mode=='grafik_vital'){
      $data['page'] =  $data['page']."_grafik_vital";
      $data['kembali'] = base_url('dokter/daftar');
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
      $data['kembali'] = base_url('dokter/daftar');
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
      $data['kembali'] = base_url('dokter/daftar');
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
      $data['kembali'] = base_url('dokter/daftar');
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
    if($mode=='tambah'){
      $data['page'] =  $data['page']."_tambah";
      $data['kembali'] = base_url('dokter/daftar');
      $pd = $this->m_ol_rancak->ambil_data_pasien($data['first_date']);
      $data['barcode_pendaftaran_unit'] = $pd['barcode_pendaftaran_unit'];
      $data['barcode_pendaftaran'] = $pd['barcode_pendaftaran'];
      $data['wkt_daftar'] = $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($pd['wkt_daftar'])));
    //  $data['vital'] = $this->m_ol_rancak->ambil_data_vital($pd['barcode_pendaftaran']);
      // ==================================================== POKOK
      $this->tampil_top($data);
    }
    if($mode=='pemeriksaane'){
      $data['page'] =  $data['page']."_pemeriksaane";
//      $data['ambil_pemeriksaan_billing'] = $this->m_rancak->ambil_pemeriksaan_billing($data['first_date']);
      $pdu = $this->m_umum->ambil_data('pendaftaran_unit','barcode_pendaftaran_unit',$data['first_date']);
      $pd = $this->m_umum->ambil_data('pendaftaran','barcode_pendaftaran',$pdu['barcode_pendaftaran']);
 //     $data['data_pemeriksaan'] = $this->data_pemeriksaan('0');
      $data['sum_billing'] = $this->m_rancak->sum_billing($data['first_date']);
      $pmrs = $this->m_umum->ambil_data('pemeriksaan','barcode_pendaftaran_unit',$data['first_date']);
      $data['barcode_pendaftaran_unit']  = set_value('barcode_pendaftaran_unit',$pdu['barcode_pendaftaran_unit']);
      $data['id_status_pasien']  = set_value('id_status_pasien',$pdu['id_status_pasien']);
      $kondisi=array('barcode_pendaftaran_unit'=>$pdu['barcode_pendaftaran_unit']); //id_pendaftaran
      $data['jml'] = $this->m_umum->jumlah_record_filter('pemeriksaan',$kondisi);
      if($data['jml'] == 0){
        $data['tgl_pemeriksaan'] = set_value('tgl_pemeriksaan',date('d-m-Y'));
      }else{
	      $data['tgl_pemeriksaan'] = set_value('tgl_pemeriksaan',date('d-m-Y', strtotime($pmrs['tgl_pemeriksaan'])));
      }
      $px  = $this->m_ol_rancak->ambil_data_pasien($data['first_date']);
      $data['tgl_lahir']  = set_value('tgl_lahir',$px['tgl_lahir']);
      $data['id_cara_bayar']  = set_value('id_cara_bayar',$pd['id_cara_bayar']);
      $data['id_detil_cara_bayar']  = set_value('id_detil_cara_bayar',$pd['id_detil_cara_bayar']);
      $data['id_fat']  = set_value('id_fat',$this->input->post("id_fat"));
      $data['id_kelas']  = set_value('id_kelas',$this->input->post("id_kelas"));
      $data['jml_billing']  = set_value('jml_billing','1');
      $data['no_pemeriksaan']  = set_value('no_pemeriksaan',$this->input->post('no_pemeriksaan'));
      $data['ket_pemeriksaan']  = set_value('ket_pemeriksaan',$this->input->post('ket_pemeriksaan'));
      $this->load->view("dokter/isi",$data);
    }
    if($mode=='simpan_tambah_pemeriksaan_billing'){
    	$id_status_pasien = $this->input->post('st');
      $barcode_pendaftaran_unit = $this->input->post('daftar');
    	$barcode_tindakan_tarif = $this->input->post('id');
      $tgl_lahir = $this->input->post('tgl_lahir');
    	$jml = $this->input->post('jml');
    	$no = $this->input->post('no');
			$tgl = $this->input->post('tgl');
			$tgl = date('Y-m-d', strtotime($tgl));
			$d = $this->m_umum->ambil_data('tindakan_tarif','barcode_tindakan_tarif',$barcode_tindakan_tarif);
			$kondisi_bil=array('tt.id_tindakan'=>$d['id_tindakan'],'barcode_pendaftaran_unit'=>$barcode_pendaftaran_unit,'tgl_pemeriksaan'=>$tgl);
	//		$jml_bil=$this->m_umum->jumlah_record_tabel_pengajuan('billing',$kondisi_bil,'pemeriksaan','id_pemeriksaan');
			  $jml_bil=$this->m_ol_rancak->jumlah_record_tabel_bil_pmr($kondisi_bil);
  			if($jml_bil == 0){
        	if(!empty($barcode_pendaftaran_unit) AND !empty($barcode_tindakan_tarif) AND !empty($jml) AND $jml > 0){
            if((0 < $id_status_pasien) && ($id_status_pasien < 3)){
      	    	$id_kelas = $d["id_kelas"];
      	    	$harga_tindakan = $d["harga_tindakan"];
              $barcode_tindakan_tarif = $d["barcode_tindakan_tarif"];
      	      $last_ide = $this->m_ol_rancak->simpan_tambah_pemeriksaan_billing($id_kelas);
      	      $this->m_ol_rancak->simpan_tambah_p_billing($last_ide,$harga_tindakan,$barcode_tindakan_tarif,$jml);
            }
    	    }
  	    }
    }
    if($mode=='hapus_pemeriksaan'){
      $data['page'] =  $data['page']."_hapus_pemeriksaan";
      if($data['first_date'] == NULL OR empty($data['first_date'])){
  			$data['first_date'] = '0';
  		}
      $pmr_pen = $this->m_umum->ambil_data('pemeriksaan','barcode_pemeriksaan',$data['first_date']);
  		$data['barcode_pemeriksaan'] = set_value('barcode_pemeriksaan',$pmr_pen["barcode_pemeriksaan"]);
  		$data['id_status_pemeriksaan'] = set_value('id_status_pemeriksaan',$pmr_pen["id_status_pemeriksaan"]);
      $this->load->view("dokter/isi",$data);
    }
    if($mode=='simpan_hapus_pemeriksaan'){
      $barcode_pemeriksaan = $this->input->post("id");
      $id_status_pemeriksaan = $this->input->post("status");
			$kondisi_radiologi=array('barcode_pemeriksaan'=>$barcode_pemeriksaan,'id_status_pemeriksaan >'=>0);
			$jml_radiologi = $this->m_umum->jumlah_record_filter('pemeriksaan',$kondisi_radiologi);
			if($jml_radiologi == 0){
	      $this->m_umum->hapus_data('pemeriksaan','barcode_pemeriksaan',$barcode_pemeriksaan);
	      $this->m_umum->hapus_data('billing','barcode_pemeriksaan',$barcode_pemeriksaan);	
        $this->m_umum->hapus_data('radiologi_dosis','barcode_pemeriksaan',$barcode_pemeriksaan); 			      
			}
    }
    if($mode=='tambah_lab2'){
      $data['page'] =  $data['page']."_tambah_lab2";
      $data['kembali'] = base_url('dokter/daftar');
      $pd = $this->m_ol_rancak->ambil_data_pasien($data['first_date']);
      $data['barcode_pendaftaran_unit'] = $pd['barcode_pendaftaran_unit'];
      $data['barcode_pendaftaran'] = $pd['barcode_pendaftaran'];
      $data['wkt_daftar'] = $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($pd['wkt_daftar'])));
    //  $data['vital'] = $this->m_ol_rancak->ambil_data_vital($pd['barcode_pendaftaran']);
      // ==================================================== POKOK
      $this->tampil_top($data);
    }
    if($mode=='tambah_lab'){
      $data['page'] =  $data['page']."_tambah_lab";
      $data['kembali'] = base_url('dokter/daftar');
      $pd = $this->m_ol_rancak->ambil_data_pasien($data['first_date']);
      $data['barcode_pendaftaran_unit'] = $pd['barcode_pendaftaran_unit'];
      $data['barcode_pendaftaran'] = $pd['barcode_pendaftaran'];
      $data['id_status_pasien'] = $pd['id_status_pasien'];
      $data['wkt_daftar'] = $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($pd['wkt_daftar'])));
      $data['kgp'] = $this->m_ol_rancak->ambil_pemeriksaan_plus_kgp(3);
      $kondisi=array('barcode_pendaftaran_unit'=>$pd['barcode_pendaftaran_unit'],'unit_ke_lobby'=>3);
      $pl = $this->m_umum->ambil_data_kondisi('pendaftaran_lobby',$kondisi);
      $data['tindakan']  = set_value('tindakan',$pl['tindakan']);
      $data['ket_lobby']  = set_value('ket_lobby',$pl['ket_lobby']);
      // ==================================================== POKOK
      $this->form_validation->set_rules('barcode_pendaftaran','barcode_pendaftaran','required');
      if ($this->form_validation->run() === FALSE){
           $this->tampil_top($data);
      }else{
          $id_status_pasien = $this->input->post('id_status_pasien');
          $barcode_pendaftaran_unit = $this->input->post('barcode_pendaftaran_unit');
          $unit_ke_lobby = $this->input->post('unit_ke_lobby');
          if((0 < $id_status_pasien) && ($id_status_pasien < 3)){
            $kondisi=array('barcode_pendaftaran_unit'=>$barcode_pendaftaran_unit,'unit_ke_lobby'=>$unit_ke_lobby);
            $jml = $this->m_umum->jumlah_record_filter('pendaftaran_lobby',$kondisi);
            if($jml == 0){
              $this->m_dokter->simpan_permintaan_lobby();
            }else{
              $this->m_dokter->edit_permintaan_lobby();
            }        
            $this->session->set_flashdata('sukses', 'Data Sudah Tersimpan');
            redirect(base_url('dokter/daftar/tambah_lab/'.$barcode_pendaftaran_unit));            
          }else{
            $this->session->set_flashdata('danger', 'Data Sudah Tidak Dapat Di edit');
            redirect(base_url('dokter/daftar/tambah_lab/'.$barcode_pendaftaran_unit));
          }
      }
    }
    if($mode=='tambah_ugd'){
      $data['page'] =  $data['page']."_tambah_ugd";
      $data['kembali'] = base_url('dokter/daftar');
      $pd = $this->m_ol_rancak->ambil_data_pasien($data['first_date']);
      $data['barcode_pendaftaran_unit'] = $pd['barcode_pendaftaran_unit'];
      $data['barcode_pendaftaran'] = $pd['barcode_pendaftaran'];
      $data['id_status_pasien'] = $pd['id_status_pasien'];
      $data['wkt_daftar'] = $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($pd['wkt_daftar'])));
      $data['kgp'] = $this->m_ol_rancak->ambil_pemeriksaan_plus_kgp(6);
      $kondisi=array('barcode_pendaftaran_unit'=>$pd['barcode_pendaftaran_unit'],'unit_ke_lobby'=>6);
      $pl = $this->m_umum->ambil_data_kondisi('pendaftaran_lobby',$kondisi);
      $data['tindakan']  = set_value('tindakan',$pl['tindakan']);
      $data['ket_lobby']  = set_value('ket_lobby',$pl['ket_lobby']);
      // ==================================================== POKOK
      $this->form_validation->set_rules('barcode_pendaftaran','barcode_pendaftaran','required');
      if ($this->form_validation->run() === FALSE){
           $this->tampil_top($data);
      }else{
          $id_status_pasien = $this->input->post('id_status_pasien');
          $barcode_pendaftaran_unit = $this->input->post('barcode_pendaftaran_unit');
          $unit_ke_lobby = $this->input->post('unit_ke_lobby');
          if((0 < $id_status_pasien) && ($id_status_pasien < 3)){
            $kondisi=array('barcode_pendaftaran_unit'=>$barcode_pendaftaran_unit,'unit_ke_lobby'=>$unit_ke_lobby);
            $jml = $this->m_umum->jumlah_record_filter('pendaftaran_lobby',$kondisi);
            if($jml == 0){
              $this->m_dokter->simpan_permintaan_lobby();
            }else{
              $this->m_dokter->edit_permintaan_lobby();
            }        
            $this->session->set_flashdata('sukses', 'Data Sudah Tersimpan');
            redirect(base_url('dokter/daftar/tambah_ugd/'.$barcode_pendaftaran_unit));            
          }else{
            $this->session->set_flashdata('danger', 'Data Sudah Tidak Dapat Di edit');
            redirect(base_url('dokter/daftar/tambah_ugd/'.$barcode_pendaftaran_unit));
          }
      }
    }
    if($mode=='labore'){
      $data['page'] =  $data['page']."_labore";
      $pdu = $this->m_umum->ambil_data('pendaftaran_unit','barcode_pendaftaran_unit',$data['first_date']);
      $pd = $this->m_umum->ambil_data('pendaftaran','barcode_pendaftaran',$pdu['barcode_pendaftaran']);
      $data['sum_billing'] = $this->m_rancak->sum_billing($data['first_date']);
      $pmrs = $this->m_umum->ambil_data('pemeriksaan','barcode_pendaftaran_unit',$data['first_date']);
      $data['barcode_pendaftaran_unit']  = set_value('barcode_pendaftaran_unit',$pdu['barcode_pendaftaran_unit']);
      $data['barcode_pendaftaran']  = set_value('barcode_pendaftaran',$pdu['barcode_pendaftaran']);
      $data['id_status_pasien']  = set_value('id_status_pasien',$pdu['id_status_pasien']);
      $kondisi=array('barcode_pendaftaran_unit'=>$pdu['barcode_pendaftaran_unit']); //id_pendaftaran
      $data['jml'] = $this->m_umum->jumlah_record_filter('pemeriksaan',$kondisi);
      if($data['jml'] == 0){
        $data['tgl_pemeriksaan'] = set_value('tgl_pemeriksaan',date('d-m-Y'));
      }else{
        $data['tgl_pemeriksaan'] = set_value('tgl_pemeriksaan',date('d-m-Y', strtotime($pmrs['tgl_pemeriksaan'])));
      }
      $px  = $this->m_ol_rancak->ambil_data_pasien($data['first_date']);
      $data['tgl_lahir']  = set_value('tgl_lahir',$px['tgl_lahir']);
      $data['id_cara_bayar']  = set_value('id_cara_bayar',$pd['id_cara_bayar']);
      $data['id_detil_cara_bayar']  = set_value('id_detil_cara_bayar',$pd['id_detil_cara_bayar']);
      $data['id_fat']  = set_value('id_fat',$this->input->post("id_fat"));
      $data['id_kelas']  = set_value('id_kelas',$this->input->post("id_kelas"));
      $data['jml_billing']  = set_value('jml_billing','1');
      $data['no_pemeriksaan']  = set_value('no_pemeriksaan',$this->input->post('no_pemeriksaan'));
      $data['ket_pemeriksaan']  = set_value('ket_pemeriksaan',$this->input->post('ket_pemeriksaan'));
      $this->load->view("dokter/isi",$data);
    }
    if($mode=='simpan_tambah_pemeriksaan_lab'){
      $id_status_pasien = $this->input->post('st');
      $barcode_pendaftaran_unit = $this->input->post('daftar');
      $barcode_tindakan_tarif = $this->input->post('id');
      $tgl_lahir = $this->input->post('tgl_lahir');
      $jml = $this->input->post('jml');
      $no = $this->input->post('no');
      $tgl = $this->input->post('tgl');
      $tgl = date('Y-m-d', strtotime($tgl));
      $d = $this->m_umum->ambil_data('tindakan_tarif','barcode_tindakan_tarif',$barcode_tindakan_tarif);
      $kondisi_bil=array('tt.id_tindakan'=>$d['id_tindakan'],'barcode_pendaftaran_unit'=>$barcode_pendaftaran_unit,'tgl_pemeriksaan'=>$tgl);
  //    $jml_bil=$this->m_umum->jumlah_record_tabel_pengajuan('billing',$kondisi_bil,'pemeriksaan','id_pemeriksaan');
        $jml_bil=$this->m_ol_rancak->jumlah_record_tabel_bil_pmr($kondisi_bil);
        if($jml_bil == 0){
          if(!empty($barcode_pendaftaran_unit) AND !empty($barcode_tindakan_tarif) AND !empty($jml) AND $jml > 0){
            if((0 < $id_status_pasien) && ($id_status_pasien < 3)){
              $id_kelas = $d["id_kelas"];
              $harga_tindakan = $d["harga_tindakan"];
              $barcode_tindakan_tarif = $d["barcode_tindakan_tarif"];
              $last_pu = $this->m_ol_rancak->tambah_pendaftaran_unit();
              $last_ide = $this->m_ol_rancak->simpan_tambah_pemeriksaan_billing2($id_kelas,$last_pu);
              $kondisi=array('barcode_tindakan_tarif'=>$barcode_tindakan_tarif,'tindakan_paket.id_instansi'=>$this->session->refer,'status_paket'=>1);
              $jml_paket = $this->m_umum->jumlah_record_tabel_pengajuan('tindakan_paket',$kondisi,'tindakan_tarif','id_tindakan');
              $this->m_ol_rancak->simpan_tambah_p_billing($last_ide,$harga_tindakan,$barcode_tindakan_tarif,$jml);
              if($jml_paket == 0){
                $this->m_ol_rancak->simpan_lab_result($last_ide,$barcode_tindakan_tarif);
              }else{
                $pkt = $this->m_umum->ambil_data_kondisi_2tabel_row('tindakan_paket',$kondisi,'tindakan_tarif','id_tindakan');
                $paket = $pkt['paket'];
                $this->m_ol_rancak->simpan_lab_result_array($last_ide,$paket);
              }                        
            }
          }
        }
    }
    if($mode=='tambah_radiologi'){
      $data['page'] =  $data['page']."_tambah_radiologi";
      $data['kembali'] = base_url('dokter/daftar');
      $pd = $this->m_ol_rancak->ambil_data_pasien($data['first_date']);
      $data['barcode_pendaftaran_unit'] = $pd['barcode_pendaftaran_unit'];
      $data['barcode_pendaftaran'] = $pd['barcode_pendaftaran'];
      $data['id_status_pasien'] = $pd['id_status_pasien'];
      $data['wkt_daftar'] = $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($pd['wkt_daftar'])));
      $data['kgp'] = $this->m_ol_rancak->ambil_pemeriksaan_plus_kgp(2);
      $kondisi=array('barcode_pendaftaran_unit'=>$pd['barcode_pendaftaran_unit'],'unit_ke_lobby'=>2);
      $pl = $this->m_umum->ambil_data_kondisi('pendaftaran_lobby',$kondisi);
      $data['tindakan']  = set_value('tindakan',$pl['tindakan']);
      $data['ket_lobby']  = set_value('ket_lobby',$pl['ket_lobby']);
      // ==================================================== POKOK
      $this->form_validation->set_rules('barcode_pendaftaran','barcode_pendaftaran','required');
      if ($this->form_validation->run() === FALSE){
           $this->tampil_top($data);
      }else{
          $id_status_pasien = $this->input->post('id_status_pasien');
          $barcode_pendaftaran_unit = $this->input->post('barcode_pendaftaran_unit');
          $unit_ke_lobby = $this->input->post('unit_ke_lobby');
          if((0 < $id_status_pasien) && ($id_status_pasien < 3)){
            $kondisi=array('barcode_pendaftaran_unit'=>$barcode_pendaftaran_unit,'unit_ke_lobby'=>$unit_ke_lobby);
            $jml = $this->m_umum->jumlah_record_filter('pendaftaran_lobby',$kondisi);
            if($jml == 0){
              $this->m_dokter->simpan_permintaan_lobby();
            }else{
              $this->m_dokter->edit_permintaan_lobby();
            }        
            $this->session->set_flashdata('sukses', 'Data Sudah Tersimpan');
            redirect(base_url('dokter/daftar/tambah_radiologi/'.$barcode_pendaftaran_unit));            
          }else{
            $this->session->set_flashdata('danger', 'Data Sudah Tidak Dapat Di edit');
            redirect(base_url('dokter/daftar/tambah_radiologi/'.$barcode_pendaftaran_unit));
          }
      }
    }
    if($mode=='pemeriksaan_radiologi'){
      $data['page'] =  $data['page']."_pemeriksaan_radiologi";
//      $data['ambil_pemeriksaan_billing'] = $this->m_rancak->ambil_pemeriksaan_billing($data['first_date']);
      $pdu = $this->m_umum->ambil_data('pendaftaran_unit','barcode_pendaftaran_unit',$data['first_date']);
      $pd = $this->m_umum->ambil_data('pendaftaran','barcode_pendaftaran',$pdu['barcode_pendaftaran']);
 //     $data['data_pemeriksaan'] = $this->data_pemeriksaan('0');
      $data['sum_billing'] = $this->m_rancak->sum_billing($data['first_date']);
      $pmrs = $this->m_umum->ambil_data('pemeriksaan','barcode_pendaftaran_unit',$data['first_date']);
      $data['barcode_pendaftaran_unit']  = set_value('barcode_pendaftaran_unit',$pdu['barcode_pendaftaran_unit']);
      $data['barcode_pendaftaran']  = set_value('barcode_pendaftaran',$pdu['barcode_pendaftaran']);
      $data['id_status_pasien']  = set_value('id_status_pasien',$pdu['id_status_pasien']);
      $kondisi=array('barcode_pendaftaran_unit'=>$pdu['barcode_pendaftaran_unit']); //id_pendaftaran
      $data['jml'] = $this->m_umum->jumlah_record_filter('pemeriksaan',$kondisi);
      if($data['jml'] == 0){
        $data['tgl_pemeriksaan'] = set_value('tgl_pemeriksaan',date('d-m-Y'));
      }else{
        $data['tgl_pemeriksaan'] = set_value('tgl_pemeriksaan',date('d-m-Y', strtotime($pmrs['tgl_pemeriksaan'])));
      }
      $px  = $this->m_ol_rancak->ambil_data_pasien($data['first_date']);
      $data['tgl_lahir']  = set_value('tgl_lahir',$px['tgl_lahir']);
      $data['id_cara_bayar']  = set_value('id_cara_bayar',$pd['id_cara_bayar']);
      $data['id_detil_cara_bayar']  = set_value('id_detil_cara_bayar',$pd['id_detil_cara_bayar']);
      $data['id_fat']  = set_value('id_fat',$this->input->post("id_fat"));
      $data['id_kelas']  = set_value('id_kelas',$this->input->post("id_kelas"));
      $data['jml_billing']  = set_value('jml_billing','1');
      $data['no_pemeriksaan']  = set_value('no_pemeriksaan',$this->input->post('no_pemeriksaan'));
      $data['ket_pemeriksaan']  = set_value('ket_pemeriksaan',$this->input->post('ket_pemeriksaan'));
      $this->load->view("dokter/isi",$data);
    }
    if($mode=='simpan_tambah_pemeriksaan_radiologi'){
      $id_status_pasien = $this->input->post('st');
      $barcode_pendaftaran_unit = $this->input->post('daftar');
      $barcode_tindakan_tarif = $this->input->post('id');
      $tgl_lahir = $this->input->post('tgl_lahir');
      $jml = $this->input->post('jml');
      $no = $this->input->post('no');
      $tgl = $this->input->post('tgl');
      $tgl = date('Y-m-d', strtotime($tgl));
      $d = $this->m_umum->ambil_data('tindakan_tarif','barcode_tindakan_tarif',$barcode_tindakan_tarif);
      $kondisi_bil=array('tt.id_tindakan'=>$d['id_tindakan'],'barcode_pendaftaran_unit'=>$barcode_pendaftaran_unit,'tgl_pemeriksaan'=>$tgl);
  //    $jml_bil=$this->m_umum->jumlah_record_tabel_pengajuan('billing',$kondisi_bil,'pemeriksaan','id_pemeriksaan');
        $jml_bil=$this->m_ol_rancak->jumlah_record_tabel_bil_pmr($kondisi_bil);
        if($jml_bil == 0){
          if(!empty($barcode_pendaftaran_unit) AND !empty($barcode_tindakan_tarif) AND !empty($jml) AND $jml > 0){
            if((0 < $id_status_pasien) && ($id_status_pasien < 3)){
              $id_kelas = $d["id_kelas"];
              $harga_tindakan = $d["harga_tindakan"];
              $barcode_tindakan_tarif = $d["barcode_tindakan_tarif"];
              $last_pu = $this->m_ol_rancak->tambah_pendaftaran_unit();
              $this->update_pendaftaran_unit(2,$last_pu);
              $last_ide = $this->m_ol_rancak->simpan_tambah_pemeriksaan_billing2($id_kelas,$last_pu);
              $this->m_ol_rancak->simpan_tambah_p_billing($last_ide,$harga_tindakan,$barcode_tindakan_tarif,$jml);
              $kondisi=array('id_tindakan'=>$d['id_tindakan']);
              $jmlfe = $this->m_umum->jumlah_record_filter('radiologi_fe',$kondisi);
              if($jmlfe > 0){
                $umur  = $this->m_rancak->anakordewasa($tgl_lahir);
                $this->m_ol_rancak->simpan_radiologi_dosis($last_ide,$d['id_tindakan'],$umur);
              }
            }
          }
        }
    }
    if($mode=='asesment'){
      $data['page'] =  $data['page']."_asesment";
      $data['kembali'] = base_url('dokter/daftar');
      $pdu = $this->m_umum->ambil_data('pendaftaran_unit','barcode_pendaftaran_unit',$data['first_date']);
      $pd = $this->m_umum->ambil_data('pendaftaran','barcode_pendaftaran',$pdu['barcode_pendaftaran']);
      $pmrs = $this->m_umum->ambil_data('pemeriksaan','barcode_pendaftaran_unit',$data['first_date']);
      $data['nilai_kritis'] = array('0'=>'Tidak Kritis','1'=>'Kritis');
      $data['wkt_daftar'] = $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($pd['wkt_daftar'])));
      $data['id_nilai_kritis']  = set_value('id_nilai_kritis',0);
      $data['barcode_pendaftaran_unit']  = set_value('barcode_pendaftaran_unit',$pdu['barcode_pendaftaran_unit']);
      $data['barcode_pendaftaran']  = set_value('barcode_pendaftaran',$pdu['barcode_pendaftaran']);
      $data['id_status_pasien']  = set_value('id_status_pasien',$pdu['id_status_pasien']);
      $data['subjective']  = set_value('subjective',$this->input->post('subjective'));
      $data['objective']  = set_value('objective',$this->input->post('objective'));
      $data['asesment']  = set_value('asesment',$this->input->post('asesment'));
      $data['planning']  = set_value('planning',$this->input->post('planning'));
      $data['implementasi']  = set_value('implementasi',$this->input->post('implementasi'));
      $data['id_icd101']  = set_value('id_icd101',$this->input->post('id_icd101'));
      $data['nama_icd101']  = set_value('nama_icd101',$this->input->post('nama_icd101'));
      $data['id_icd102']  = set_value('id_icd102',$this->input->post('id_icd102'));
      $data['nama_icd102']  = set_value('nama_icd102',$this->input->post('nama_icd102'));
      $data['id_icd103']  = set_value('id_icd103',$this->input->post('id_icd103'));
      $data['nama_icd103']  = set_value('nama_icd103',$this->input->post('nama_icd103'));
      $this->form_validation->set_rules('id_nilai_kritis','id_nilai_kritis','required');
      if ($this->form_validation->run() === FALSE){
           $this->tampil_top($data);
      }else{
          $id_status_pasien = $this->input->post('id_status_pasien');
          $barcode_pendaftaran_unit = $this->input->post('barcode_pendaftaran_unit');
          if((0 < $id_status_pasien) && ($id_status_pasien < 3)){
            $this->m_dokter->simpan_pemeriksaan_dokter();
            $this->session->set_flashdata('sukses', 'Data Sudah Tersimpan');
            redirect(base_url('dokter/daftar/data_dokter/'.$barcode_pendaftaran_unit));            
          }else{
            $this->session->set_flashdata('danger', 'Data Sudah Tidak Dapat Di edit');
            redirect(base_url('dokter/daftar/data_dokter/'.$barcode_pendaftaran_unit));
          }
      }
    }
    if($mode=='pemeriksaan_asesment'){
      $data['page'] =  $data['page']."_pemeriksaan_asesment";
//      $data['ambil_pemeriksaan_billing'] = $this->m_rancak->ambil_pemeriksaan_billing($data['first_date']);
      $pdu = $this->m_umum->ambil_data('pendaftaran_unit','barcode_pendaftaran_unit',$data['first_date']);
      $pd = $this->m_umum->ambil_data('pendaftaran','barcode_pendaftaran',$pdu['barcode_pendaftaran']);
      $pmrs = $this->m_umum->ambil_data('pemeriksaan','barcode_pendaftaran_unit',$data['first_date']);
      $data['nilai_kritis'] = array('0'=>'Tidak Kritis','1'=>'Kritis');
      $data['id_nilai_kritis']  = set_value('id_nilai_kritis',0);
      $data['barcode_pendaftaran_unit']  = set_value('barcode_pendaftaran_unit',$pdu['barcode_pendaftaran_unit']);
      $data['barcode_pendaftaran']  = set_value('barcode_pendaftaran',$pdu['barcode_pendaftaran']);
      $data['id_status_pasien']  = set_value('id_status_pasien',$pdu['id_status_pasien']);
      $data['subjective']  = set_value('subjective',$this->input->post('subjective'));
      $data['objective']  = set_value('objective',$this->input->post('objective'));
      $data['asesment']  = set_value('asesment',$this->input->post('asesment'));
      $data['planning']  = set_value('planning',$this->input->post('planning'));
      $data['implementasi']  = set_value('implementasi',$this->input->post('implementasi'));
      $data['id_icd101']  = set_value('id_icd101',$this->input->post('id_icd101'));
      $data['nama_icd101']  = set_value('nama_icd101',$this->input->post('nama_icd101'));
      $data['id_icd102']  = set_value('id_icd102',$this->input->post('id_icd102'));
      $data['nama_icd102']  = set_value('nama_icd102',$this->input->post('nama_icd102'));
      $data['id_icd103']  = set_value('id_icd103',$this->input->post('id_icd103'));
      $data['nama_icd103']  = set_value('nama_icd103',$this->input->post('nama_icd103'));
      $this->form_validation->set_rules('id_nilai_kritis','id_nilai_kritis','required');
      if ($this->form_validation->run() === FALSE){
           $this->tampil_top($data);
      }else{
        $id_status_pasien = $this->input->post('st');
          if((0 < $id_status_pasien) && ($id_status_pasien < 3)){
            $this->m_dokter->simpan_pemeriksaan_dokter();
            $this->session->set_flashdata('sukses', 'Data Sudah Tersimpan');
            redirect(base_url('dokter/daftar/pemeriksaan_asesment/'.$barcode_pendaftaran_unit));            
          }else{
            $this->session->set_flashdata('danger', 'Data Sudah Tidak Dapat Di edit');
            redirect(base_url('dokter/daftar/pemeriksaan_asesment/'.$barcode_pendaftaran_unit));
          }
      }
    }
    if($mode=='simpan_tambah_pemeriksaan_dokter'){
      $id_status_pasien = $this->input->post('st');
        if((0 < $id_status_pasien) && ($id_status_pasien < 3)){
          $this->m_dokter->simpan_pemeriksaan_dokter();
        }
    }
	 }
	}
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("dokter/header",$data);
	$this->load->view("dokter/isi");
	$this->load->view("footer");
	$this->load->view("dokter/jsload");
	$this->load->view("dokter/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_topol",$data);
	$this->load->view("dokter/isi");
	$this->load->view("footer");
	$this->load->view("dokter/jsload");
	$this->load->view("dokter/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
