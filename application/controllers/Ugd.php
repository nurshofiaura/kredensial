<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Ugd extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
          $this->load->model('m_ol_rancak');
          $this->load->model('m_ugd');$this->login_kah();
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
  function data_pemeriksaan($id)
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
  function ambil_data_rm($id) 
  {
    $dt=$this->m_ol_rancak->timeline_pd($id);
    echo json_encode($dt);
  } 
  function lobby($mode='view')   
  {
    $data['page']  = "lobby";  
    $data['header'] = "PERMINTAAN RUJUKAN";
    $data['title'] = "PERMINTAAN RUJUKAN";
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
    if($mode=='view'){
      $this->tampil($data);
    }    
    else if($mode=='data'){
      echo json_encode($this->m_ol_rancak->tabel_lobby_perunit(6)); 
    }
  else{
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
          $data['kgp'] = $this->m_ol_rancak->ambil_pemeriksaan_plus_kgp(6);
          $d = $this->m_umum->ambil_data('pendaftaran_lobby','barcode_lobby',$data['id']);
          $pu = $this->m_umum->ambil_data('pendaftaran_unit','barcode_pendaftaran_unit',$d["barcode_pendaftaran_unit"]);
          $p = $this->m_umum->ambil_data('pendaftaran','barcode_pendaftaran',$pu["barcode_pendaftaran"]);
          $data['barcode_lobby'] = set_value('barcode_lobby',$d["barcode_lobby"]);
          $data['tindakan'] = set_value('tindakan',$d["tindakan"]);
          $data['id_dokter'] = set_value('id_dokter',$d["id_dokter"]);
          $data['unit_ke_lobby'] = set_value('unit_ke_lobby',$d["unit_ke_lobby"]);
          $data['barcode_pendaftaran_unit'] = set_value('barcode_pendaftaran_unit',$d["barcode_pendaftaran_unit"]);
          $data['barcode_pendaftaran'] = set_value('barcode_pendaftaran',$pu["barcode_pendaftaran"]);
          $data['id_cara_bayar'] = set_value('id_cara_bayar',$p["id_cara_bayar"]);
          $data['id_detil_cara_bayar'] = set_value('id_detil_cara_bayar',$p["id_detil_cara_bayar"]);
          $data['ket_lobby'] = set_value('ket_lobby',$d["ket_lobby"]);
          $data['id_unit_lobby'] = set_value('id_unit_lobby',$d["id_unit_lobby"]);
        $this->load->view("ugd/isi",$data);
      }
      if($mode=='simpan_edit'){
          $barcode_lobby = $this->input->post('barcode_lobby');
          $barcode_pendaftaran_unit = $this->input->post('barcode_pendaftaran_unit');
          $last_pu = $this->m_ol_rancak->tambah_pendaftaran_unit();
          $bpunit = $this->m_umum->ambil_data('pendaftaran_unit','barcode_pendaftaran_unit',$last_pu);
          if($bpunit['id_status_pasien'] < 2){
            $this->m_ol_rancak->update_pendaftaran_unit(2,$last_pu);
          }
          $this->m_ol_rancak->update_pendaftaran_lobby(2,$barcode_lobby);
          $this->m_ol_rancak->simpan_billing_lobby($last_pu); 
          $this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
          redirect(base_url('ugd/lobby'));
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
				redirect(base_url('ugd/daftar/view/'.$first_date.'/'.$last_date.'/'.$key));
			}
		}
    else if($mode=='data'){
		echo json_encode($this->m_ugd->pendaftaran_all($data['first_date'],$data['last_date'],$data['key']));
	}
    else if($mode=='billing'){
		echo json_encode($this->m_ugd->ambil_pemeriksaan_billing($data['first_date']));
	}
    else if($mode=='histori'){
    echo json_encode($this->m_ol_rancak->histori_px($data['first_date']));
  }
    else if($mode=='penunjang'){
    echo json_encode($this->m_ol_rancak->penunjang_luar($data['first_date']));
  }
    else if($mode=='sparkling'){
    echo json_encode($this->m_ol_rancak->tabel_sparkling_line($data['first_date']));
  }
    else if($mode=='hasil_lab_all'){
    echo json_encode($this->m_ol_rancak->hasil_lab_all($data['first_date']));
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
      $data['kembali'] = base_url('ugd/daftar');
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
      $data['kembali'] = base_url('ugd/daftar');
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
      $data['kembali'] = base_url('ugd/daftar');
      $pd = $this->m_ol_rancak->ambil_data_pasien($data['first_date']);
      $data['barcode_pendaftaran_unit'] = $pd['barcode_pendaftaran_unit'];
      $data['barcode_pendaftaran'] = $pd['barcode_pendaftaran'];
      $data['wkt_daftar'] = $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($pd['wkt_daftar'])));
      // ==================================================== POKOK
      $this->tampil_top($data);
    }
    if($mode=='data_lab'){
      $data['page'] =  $data['page']."_data_lab";
      $data['kembali'] = base_url('ugd/daftar');
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
      $this->load->view("ugd/isi",$data);
    }
    if($mode=='grafik_vital'){
      $data['page'] =  $data['page']."_grafik_vital";
      $data['kembali'] = base_url('ugd/daftar');
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
      $data['kembali'] = base_url('ugd/daftar');
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
      $data['kembali'] = base_url('ugd/daftar');
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
      $data['kembali'] = base_url('ugd/daftar');
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
    if($mode=='penunjang_luar'){
      $data['page'] =  $data['page']."_penunjang_luar";
      $data['kembali'] = base_url('ugd/daftar');
      $pd = $this->m_ol_rancak->ambil_data_pasien($data['first_date']);
      $data['barcode_pendaftaran_unit'] = $pd['barcode_pendaftaran_unit'];
      $data['barcode_pendaftaran'] = $pd['barcode_pendaftaran'];
      $data['wkt_daftar'] = $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($pd['wkt_daftar'])));
      $data['vital'] = $this->m_ol_rancak->ambil_data_vital($pd['barcode_pendaftaran']);
      // ==================================================== POKOK
      $this->tampil_top($data);
    }
    if($mode=='vital_sign'){
      $data['page'] =  $data['page']."_vital_sign";
      $data['kembali'] = base_url('ugd/daftar');
      $pd = $this->m_ol_rancak->ambil_data_pasien($data['first_date']);
      $data['nama_pegawai'] = $pd['nama_pegawai'];
      $data['tgl_pendaftaran_unit'] = $pd['tgl_pendaftaran_unit'];
      $data['barcode_pendaftaran_unit'] = $pd['barcode_pendaftaran_unit'];
      $data['barcode_pendaftaran'] = $pd['barcode_pendaftaran'];
      $data['keluhan'] = $pd['keluhan'];
      $data['nama_bayar'] = $pd['nama_bayar'];
      $data['no_pendaftaran'] = $pd['no_pendaftaran'];
      $data['nama_instansi'] = $pd['nama_instansi'];
      $data['nama_dokter'] = $pd['nama_dokter'];
      $data['ket_pendaftaran_unit'] = $pd['ket_pendaftaran_unit'];
      $data['wkt_daftar'] = $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($pd['wkt_daftar'])));
      $data['vital'] = $this->m_ol_rancak->ambil_data_vital($pd['barcode_pendaftaran']);
      // ==================================================== POKOK
      $data['gcs_eye']  = $this->m_umum->ambil_data_dropdown('kol_gcs_eye');
      $data['gcs_motorik']  = $this->m_umum->ambil_data_dropdown('kol_gcs_motorik');
      $data['gcs_verb']  = $this->m_umum->ambil_data_dropdown('kol_gcs_verb');
      $data['jalan_napas']  = $this->m_umum->ambil_data_dropdown('kol_jalan_napas');
      $data['pernapasan']  = $this->m_umum->ambil_data_dropdown('kol_pernapasan');
      $data['nutrisi']  = $this->m_umum->ambil_data_dropdown('kol_nutrisi');
      $data['geriatri']  = $this->m_umum->ambil_data_dropdown('kol_geriatri');
      $data['edmonson']  = $this->m_umum->ambil_data_dropdown('kol_edmonson');
      $data['morse']  = $this->m_umum->ambil_data_dropdown('kol_morse');
      $data['hd']  = $this->m_umum->ambil_data_dropdown('kol_hd');
      $data['nyeri']  = $this->m_umum->ambil_data_dropdown('kol_nyeri');
      $data['kol_kasus']  = $this->m_umum->ambil_data_result('kol_kasus');
      $data['kol_sirkulasi']  = $this->m_umum->ambil_data_result('kol_sirkulasi');
      $data['kol_respon']  = $this->m_umum->ambil_data_result('kol_respon');
      $data['kol_triase']  = $this->m_umum->ambil_data('kol_triase');
      $data['hamil']  = set_value('hamil',$this->input->post("hamil"));
      $data['riwayat_alergi']  = set_value('riwayat_alergi','Tidak Ada');
      $data['nyeri_lokasi']  = set_value('nyeri_lokasi',$this->input->post("nyeri_lokasi"));
      $data['nyeri_hilang']  = set_value('nyeri_hilang',$this->input->post("nyeri_hilang"));
      $data['id_triase']  = set_value('id_triase',$this->input->post("id_triase"));
      $data['sirkulasi']  = set_value('sirkulasi',1);
      $data['kasus']  = set_value('kasus',1);
      $data['respon']  = set_value('respon',1);
      $data['talk_problem']  = set_value('talk_problem','Tidak Ada');
      $data['habit']  = set_value('habit',$this->input->post("habit"));
      $data['hereditary']  = set_value('hereditary',$this->input->post("hereditary"));
      $data['komplikasi']  = set_value('komplikasi',$this->input->post("komplikasi"));
      $data['ket_pemeriksaan_vital_sign']  = set_value('ket_pemeriksaan_vital_sign',$this->input->post("ket_pemeriksaan_vital_sign"));
      $data['tb']  = set_value('tb',0);
      $data['bb']  = set_value('bb',0);
      $data['sistole']  = set_value('sistole',0);
      $data['diastole']  = set_value('diastole',0);
      $data['rr']  = set_value('rr',18);
      $data['nadi']  = set_value('nadi',85);
      $data['suhu']  = set_value('suhu',35);
      $data['spo2']  = set_value('spo2',100);
      $data['id_gcs_eye']  = set_value('id_gcs_eye',1);
      $data['id_gcs_motorik']  = set_value('id_gcs_motorik',1);
      $data['id_gcs_verb']  = set_value('id_gcs_verb',1);
      $data['id_jalan_napas']  = set_value('id_jalan_napas',1);
      $data['id_pernapasan']  = set_value('id_pernapasan',1);
      $data['id_nyeri']  = set_value('id_nyeri',1);
      $data['id_nutrisi']  = set_value('id_nutrisi',1);
      $data['id_geriatri']  = set_value('id_geriatri',$this->input->post("id_geriatri"));
      $data['id_edmonson']  = set_value('id_edmonson',$this->input->post("id_edmonson"));
      $data['id_morse']  = set_value('id_morse',$this->input->post("id_morse"));
      $data['id_hd']  = set_value('id_hd',$this->input->post("id_hd"));
      $data['id_kasus']  = set_value('id_kasus',explode(",",1));
      $this->form_validation->set_rules('barcode_pendaftaran_unit','barcode_pendaftaran_unit','required');
      if ($this->form_validation->run() === FALSE){
        $this->tampil_top($data);
      }else{
        $barcode_pendaftaran_unit = $this->input->post("barcode_pendaftaran_unit");
        $kondisi=array('barcode_pendaftaran_unit'=>$barcode_pendaftaran_unit);
        $jml = $this->m_umum->jumlah_record_filter('pemeriksaan_vital_sign',$kondisi);
        if($jml == 0){  
        $this->m_ol_rancak->simpan_pemeriksaan_vital_sign();
        $this->session->set_flashdata('sukses', 'Data Sudah Tersimpan');
        redirect(base_url('ugd/daftar/data_vital/'.$barcode_pendaftaran_unit));
        }else{
           $this->session->set_flashdata('danger', 'Data Sudah Ada, Buat Tambahan Pemeriksaan di Admin');
          redirect(base_url('ugd/daftar/data_vital/'.$barcode_pendaftaran_unit));         
        }
      }
    }
    if($mode=='asuhan'){
      $data['page'] =  $data['page']."_asuhan";
      $data['kembali'] = base_url('ugd/daftar');
      $pd = $this->m_ol_rancak->ambil_data_pasien($data['first_date']);
      $data['nama_pegawai'] = $pd['nama_pegawai'];
      $data['tgl_pendaftaran_unit'] = $pd['tgl_pendaftaran_unit'];
      $data['barcode_pendaftaran_unit'] = $pd['barcode_pendaftaran_unit'];
      $data['barcode_pendaftaran'] = $pd['barcode_pendaftaran'];
      $data['keluhan'] = $pd['keluhan'];
      $data['nama_bayar'] = $pd['nama_bayar'];
      $data['no_pendaftaran'] = $pd['no_pendaftaran'];
      $data['nama_instansi'] = $pd['nama_instansi'];
      $data['nama_dokter'] = $pd['nama_dokter'];
      $data['ket_pendaftaran_unit'] = $pd['ket_pendaftaran_unit'];
      $data['wkt_daftar'] = $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($pd['wkt_daftar'])));
      $data['vital'] = $this->m_ol_rancak->ambil_data_vital($pd['barcode_pendaftaran']);
      $ambil_data_igd = $this->m_ol_rancak->ambil_data_vital_row($pd['barcode_pendaftaran']);
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
      $data['id_kaji_detil']  = set_value('id_kaji_detil',$this->input->post("id_kaji_detil"));
      $data['id_mas_detil']  = set_value('id_mas_detil',$this->input->post("id_mas_detil"));
      $data['id_imp_detil']  = set_value('id_imp_detil',$this->input->post("id_imp_detil"));
      $data['rr_asuhan']  = set_value('rr_asuhan',$ambil_data_igd['rr']);
      $data['rr_ritme']  = set_value('rr_ritme',$this->input->post("rr_ritme"));
      $data['gcs_asuhan']  = set_value('gcs_asuhan',15);
      $data['sistole_asuhan']  = set_value('sistole_asuhan',$ambil_data_igd['sistole']);
      $data['diastole_asuhan']  = set_value('diastole_asuhan',$ambil_data_igd['diastole']);
      $data['eye_asuhan']  = set_value('eye_asuhan',$ambil_data_igd['id_gcs_eye']);
      $data['motorik_asuhan']  = set_value('motorik_asuhan',$ambil_data_igd['id_gcs_motorik']);
      $data['verbal_asuhan']  = set_value('verbal_asuhan',$ambil_data_igd['id_gcs_verb']);
      $data['diameter_pupil']  = set_value('diameter_pupil',3);
      $data['ext_atas']  = set_value('ext_atas',$this->input->post("ext_atas"));
      $data['ext_bawah']  = set_value('ext_bawah',$this->input->post("ext_bawah"));
      $data['breathingo2']  = set_value('breathingo2',$this->input->post("breathingo2"));
      $data['disabilitygcs']  = set_value('disabilitygcs',$this->input->post("disabilitygcs"));
      $data['disabilityo2']  = set_value('disabilityo2',$this->input->post("disabilityo2"));
      $this->form_validation->set_rules('barcode_pendaftaran_unit','barcode_pendaftaran_unit','required');
      if ($this->form_validation->run() === FALSE){
        $this->tampil_top($data);
      }else{
        $barcode_pendaftaran_unit = $this->input->post("barcode_pendaftaran_unit");
        $kondisi=array('barcode_pendaftaran_unit'=>$barcode_pendaftaran_unit);
        $jml = $this->m_umum->jumlah_record_filter('pemeriksaan_asuhan',$kondisi);
        if($jml == 0){  
          $this->m_ol_rancak->simpan_asuhan();
          $this->session->set_flashdata('sukses', 'Data Sudah Tersimpan');
          redirect(base_url('ugd/daftar/data_asuhan/'.$barcode_pendaftaran_unit));
        }else{
           $this->session->set_flashdata('danger', 'Data Sudah Ada, Buat Tambahan Pemeriksaan di Admin');
          redirect(base_url('ugd/daftar/data_asuhan/'.$barcode_pendaftaran_unit));         
        }
      }
    }
    if($mode=='tambah'){
      $data['page'] =  $data['page']."_tambah";
      $data['kembali'] = base_url('ugd/daftar');
      $pd = $this->m_ol_rancak->ambil_data_pasien($data['first_date']);
      $data['barcode_pendaftaran_unit'] = $pd['barcode_pendaftaran_unit'];
      $data['barcode_pendaftaran'] = $pd['barcode_pendaftaran'];
      $data['wkt_daftar'] = $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($pd['wkt_daftar'])));
      $data['vital'] = $this->m_ol_rancak->ambil_data_vital($pd['barcode_pendaftaran']);
      // ==================================================== POKOK
      $this->tampil_top($data);
    }
    if($mode=='tambah_penunjang'){
      $data['page'] =  $data['page']."_tambah_penunjang";
      if($data['first_date'] == NULL OR empty($data['first_date'])){
  			$data['first_date'] = '0';
  		}
      $pendun  = $this->m_umum->ambil_data('pendaftaran_unit','barcode_pendaftaran_unit',$data['first_date']);
      $data['barcode_pendaftaran']  = set_value('barcode_pendaftaran',$pendun['barcode_pendaftaran']);
      $data['cmd_tindakan_no_null']  = $this->m_rancak->cmd_tindakan_no_null($this->session->id_jabatan);
      $data['id_tindakan']  = set_value('id_tindakan',$this->input->post("id_tindakan"));
      $data['hasil_pemeriksaan_penunjang']  = set_value('hasil_pemeriksaan_penunjang',$this->input->post("hasil_pemeriksaan_penunjang"));
      $data['dokter_pemeriksaan_penunjang']  = set_value('dokter_pemeriksaan_penunjang',$this->input->post("dokter_pemeriksaan_penunjang"));
      $data['tgl_pemeriksaan_penunjang']  = set_value('tgl_pemeriksaan_penunjang',date('d-m-Y'));
      $this->load->view("ugd/isi",$data);
    }
    if($mode=='simpan_tambah_penunjang'){
      $this->m_ol_rancak->simpan_pemeriksaan_penunjang();
    }
    if($mode=='edit_penunjang'){
      $data['page'] =  $data['page']."_edit_penunjang";
      if($data['first_date'] == NULL OR empty($data['first_date'])){
  			$data['first_date'] = '0';
  		}
      $data['cmd_tindakan_no_null']  = $this->m_rancak->cmd_tindakan_no_null($this->session->id_jabatan);
      $pmr_pen = $this->m_umum->ambil_data('pemeriksaan_penunjang','id_pemeriksaan_penunjang',$data['first_date']);
  		$data['id_pemeriksaan_penunjang'] = set_value('id_pemeriksaan_penunjang',$pmr_pen["id_pemeriksaan_penunjang"]);
  		$data['id_tindakan'] = set_value('id_tindakan',$pmr_pen["id_tindakan"]);
  		$data['hasil_pemeriksaan_penunjang'] = set_value('hasil_pemeriksaan_penunjang',$pmr_pen["hasil_pemeriksaan_penunjang"]);
      $data['dokter_pemeriksaan_penunjang'] = set_value('dokter_pemeriksaan_penunjang',$pmr_pen["dokter_pemeriksaan_penunjang"]);
  		$data['tgl_pemeriksaan_penunjang'] = set_value('tgl_pemeriksaan_penunjang',date('d-m-Y', strtotime($pmr_pen["tgl_pemeriksaan_penunjang"])));
      $this->load->view("ugd/isi",$data);
    }
    if($mode=='hapus_penunjang'){
      $data['page'] =  $data['page']."_hapus_penunjang";
      if($data['first_date'] == NULL OR empty($data['first_date'])){
  			$data['first_date'] = '0';
  		}
      $pmr_pen = $this->m_umum->ambil_data('pemeriksaan_penunjang','id_pemeriksaan_penunjang',$data['first_date']);
  		$data['id_pemeriksaan_penunjang'] = set_value('id_pemeriksaan_penunjang',$pmr_pen["id_pemeriksaan_penunjang"]);
      $data['pembuat_pemeriksaan_penunjang'] = set_value('pembuat_pemeriksaan_penunjang',$pmr_pen["pembuat_pemeriksaan_penunjang"]);
      $this->load->view("ugd/isi",$data);
    }
    if($mode=='simpan_edit_penunjang'){
      $this->m_ol_rancak->edit_pemeriksaan_penunjang();
    }
    if($mode=='simpan_hapus_penunjang'){
      $id_pemeriksaan_penunjang = $this->input->post("daftar");
      $maker = $this->input->post("maker");
      if($this->session->id_pegawai == $maker){
      $this->m_umum->hapus_data('pemeriksaan_penunjang','id_pemeriksaan_penunjang',$id_pemeriksaan_penunjang);
      }
    }
    if($mode=='tabelpenunjang'){
      $data['page'] =  $data['page']."_tabelpenunjang";
      if($data['first_date'] == NULL OR empty($data['first_date'])){
  			$data['first_date'] = '0';
  		}
      $this->load->view("ugd/isi",$data);
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
      $this->load->view("ugd/isi",$data);
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
      $this->load->view("ugd/isi",$data);
    }
    if($mode=='simpan_hapus_pemeriksaan'){
      $barcode_pemeriksaan = $this->input->post("id");
      $id_status_pemeriksaan = $this->input->post("status");
			$kondisi_radiologi=array('barcode_pemeriksaan'=>$barcode_pemeriksaan,'id_status_pemeriksaan >'=>0);
			$jml_radiologi = $this->m_umum->jumlah_record_filter('pemeriksaan',$kondisi_radiologi);
			if($jml_radiologi == 0){
	      $this->m_umum->hapus_data('pemeriksaan','barcode_pemeriksaan',$barcode_pemeriksaan);
	      $this->m_umum->hapus_data('billing','barcode_pemeriksaan',$barcode_pemeriksaan);				      
			}
    }
	 }
	}
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("ugd/header",$data);
	$this->load->view("ugd/isi");
	$this->load->view("footer");
	$this->load->view("ugd/jsload");
	$this->load->view("ugd/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_topol",$data);
	$this->load->view("ugd/isi");
	$this->load->view("footer");
	$this->load->view("ugd/jsload");
	$this->load->view("ugd/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
