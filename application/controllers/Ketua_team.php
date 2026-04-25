<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');
// ALTER TABLE `ol_user` ADD `status_asesor` TINYINT UNSIGNED NOT NULL DEFAULT '0' AFTER `status_user`;
class Ketua_team extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
          $this->load->model('m_ol_rancak');
          $this->load->model('m_admin_kredensial');
          $this->load->model('m_admin_user');
          $this->load->model('m_auth');
          $this->m_auth->login_kah();
  }
function index(){
  $this->surat_ijin();
}
	function surat_ijin($mode='view'){
		$data['page']  = "surat_ijin";
		$data['header'] = "SISTEM INFORMASI INDIKATOR MUTU, QUALITY CONTROL DAN KREDENSIAL";
		$data['title'] = "SISTEM INFORMASI INDIKATOR MUTU, QUALITY CONTROL DAN KREDENSIAL";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$stpeg = $this->m_umum->ambil_data('a_online','kode_online','ol_status_pegawai');
		$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
    $knds_unit = array('status_unit'=>1);
    $data['unitee'] = $this->m_umum->ambil_comma_join_kondisi('ol_unit',$knds_unit,'coun_unit',$this->session->mas_unit,'nama_unit','asc');
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
      if(empty($data['id'])){
        if($this->session->has_userdata('id1_ketua_srt')){
          $data['id'] = $this->session->id1_ketua_srt;
        }
      }
		  $this->tampil($data);
      $action = $this->input->post('action');
      if($action == 'BtnProses') {
        $id = $this->input->post("id");
        $data_user_level = array(
          'id1_ketua_srt'     => $id
        );
        $this->session->set_userdata($data_user_level);
        redirect(base_url('ketua_team/surat_ijin/view/'.$id));
      }
    }
	}
  function report($mode='view'){
    $data['page']="report";
    $data['title'] = "LAPORAN";
    $data['header'] = "SISTEM INFORMASI INDIKATOR MUTU, QUALITY CONTROL DAN KREDENSIAL";
    $pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
    $asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
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
    //======================= IMPORTANT =========================================
    $data['id'] = $this->uri->segment(4, 0);
    $data['id2'] = $this->uri->segment(5, 0);
    $data['id3'] = $this->uri->segment(6, 0);
    $data['id4'] = $this->uri->segment(7, 0);
    $kon = array('status_equipment'=>1,'jenis_equipment'=>1);
    $data['opsi'] = $this->m_admin_kredensial->ambil_equipment_mutu_null($kon);
    $data['all_kah'] = array('0'=>'Range Tanggal','1'=>'Semua');
    if($mode=='view'){
      if(empty($data['id'])){
        if($this->session->has_userdata('tgl_ketua_report1')){
          $data['id'] = $this->session->tgl_ketua_report1;
        }else{
          $data['id'] = '01-'.date('m-Y');
        }
      }
      if(empty($data['id2'])){
        if($this->session->has_userdata('tgl_ketua_report2')){
          $data['id2'] = $this->session->tgl_ketua_report2;
        }else{
          $data['id2'] = date('d-m-Y');
        }
      }
      if(empty($data['id3'])){
        if($this->session->has_userdata('opsi_ketua_report')){
          $data['id3'] = $this->session->opsi_ketua_report;
        }else{
          $data['id3'] = 0;
        }
      }
      if(empty($data['id4'])){
        if($this->session->has_userdata('range_report_report')){
          $data['id4'] = $this->session->range_report_report;
        }else{
          $data['id4'] = 1;
        }
      }
      $this->tampil($data);
      $action = $this->input->post('action');
      if($action == 'BtnProses') {
        $first_date = $this->input->post("id");
        $last_date = $this->input->post("id2");
        $opsi_ketua_report = $this->input->post("id3");
        $range_report_report = $this->input->post("id4");
        $data_user_level = array(
          'tgl_ketua_report1'     => $first_date,
          'tgl_ketua_report2'     => $last_date,
          'opsi_ketua_report'     => $opsi_report_imutu,
          'range_report_report'     => $range_report_imutu
        );
        $this->session->set_userdata($data_user_level); 
        redirect(base_url('ketua_team/'.$data['page'].'/view/'.$first_date.'/'.$last_date.'/'.$opsi_report_imutu.'/'.$range_report_report));
      }
    }
    else if($mode=='data'){
      echo json_encode($this->m_admin_kredensial->laporan_all($data['id'],$data['id2'],$data['id3'],$data['id4'],1));
    }
  }
  function sheet($mode='view'){
    $data['page']="sheet";
    $data['title'] = "LAPORAN";
    $data['header'] = "SISTEM INFORMASI INDIKATOR MUTU, QUALITY CONTROL DAN KREDENSIAL";
    $pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
    $asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
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
    //======================= IMPORTANT =========================================
    $data['idlap'] = $this->uri->segment(4, 0);
    $data['iddet'] = $this->uri->segment(5, 0);
    $lp = $this->m_ol_rancak->ambil_data_laporan_detil($data['iddet']); // id_laporan_detil
    $data['id_laporan']  = set_value('id_laporan',$lp["id_laporan"]);
    $data['nama_pegawai']  = set_value('nama_pegawai',$lp["nama_pegawai"]);
    $data['id_equipment']  = set_value('id_equipment',$lp["id_equipment"]);
    $data['nama_unit']  = set_value('nama_unit',$lp["nama_unit"]);
    $data['tgl_laporan']  = set_value('tgl_laporan',date('d-m-Y', strtotime($lp["tgl_laporan"])));
    $data['tgl_awal']  = set_value('tgl_awal',date('d-m-Y', strtotime($lp["tgl_awal"])));
    $data['tgl_akhir']  = set_value('tgl_akhir',date('d-m-Y', strtotime($lp["tgl_akhir"])));
    $data['id_pegawai']  = set_value('id_pegawai',$lp["id_pegawai"]);
    $data['barcode_pegawai']  = set_value('barcode_pegawai',$lp["barcode_pegawai"]);
    $data['header_laporan']  = set_value('header_laporan',$lp["header_laporan"]);
    $data['sub_header_laporan']  = set_value('sub_header_laporan',$lp["sub_header_laporan"]);
    $data['sub_sub_header_laporan']  = set_value('sub_sub_header_laporan',$lp["sub_sub_header_laporan"]);
    $data['judul_laporan']  = set_value('judul_laporan',$lp["judul_laporan"]);
    $data['tujuan_laporan']  = set_value('tujuan_laporan',$lp["tujuan_laporan"]);
    $data['periode_laporan']  = set_value('periode_laporan',$lp["periode_laporan"]);
    $data['sumber_laporan']  = set_value('sumber_laporan',$lp["sumber_laporan"]);
    $data['id_laporan_detil']  = set_value('id_laporan_detil',$lp["id_laporan_detil"]);
    $data['judul_laporan_detil']  = set_value('judul_laporan_detil',$lp["judul_laporan_detil"]);
    $data['analisa_laporan_detil']  = set_value('analisa_laporan_detil',$lp["analisa_laporan_detil"]);
    $data['rekomendasi_laporan_detil']  = set_value('rekomendasi_laporan_detil',$lp["rekomendasi_laporan_detil"]);
    $data['min_laporan_detil']  = set_value('min_laporan_detil',$lp["min_laporan_detil"]);
    $data['max_laporan_detil']  = set_value('max_laporan_detil',$lp["max_laporan_detil"]);
    $data['periode_laporan_detil']  = set_value('periode_laporan_detil',$lp["periode_laporan_detil"]);
    $data['numerator_laporan_detil']  = set_value('numerator_laporan_detil',$lp["numerator_laporan_detil"]);
    $data['denumerator_laporan_detil']  = set_value('denumerator_laporan_detil',$lp["denumerator_laporan_detil"]);
    $data['nudenum']  = set_value('nudenum',$lp["nudenum"]);
    $data['urutan_laporan_detil']  = set_value('urutan_laporan_detil',$lp["urutan_laporan_detil"]);
    $data['equipment_detil']  = set_value('equipment_detil',$lp["equipment_detil"]);
    $data['show_pdf']  = set_value('show_pdf',$lp["show_pdf"]);
    $data['tabel']  = set_value('tabel',$lp["tabel"]);
    $data['button']  = set_value('button',$lp["button"]);
    //========================================================
    $data['jns_eq'] = array('1','2');
    //========================================================
    $kondisi_cek = array('id_laporan_detil'=>$data['iddet'],'pembuat_laporan'=>$this->session->barcode_pegawai);
    $data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('ol_laporan_detil',$kondisi_cek,'ol_laporan','id_laporan');
    $data['ambil_tabel'] = $this->m_rancak->ambil_sn_tabel();
    $data['cmd_ya_tidak'] = $this->m_rancak->cmd_ya_tidak();
    $data['periode'] = $this->m_rancak->cmd_periode_laporan_detil();
    //========================================================
    if($mode=='view'){
      $this->tampil($data);
    }
    else if($mode=='data'){
      echo json_encode($this->m_admin_kredensial->laporan_detil_all($data['idlap'],1));
    }
  }
  function kinerja_klinis($mode='lbulanan'){
		$data['page']  = "kinerja_klinis";
		$data['header'] = "KINERJA KLINIS";
		$data['title'] = "KINERJA KLINIS";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
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
		$data['bulan'] = $this->uri->segment(4, 0);
		$data['tahun'] = $this->uri->segment(5, 0);
		$data['id_pegawai'] = $this->uri->segment(6, 0);
		$data['cmd_bentuk_laporan'] = $this->m_rancak->cmd_bentuk_laporan();
		$data['cmd_bulan'] = $this->m_rancak->cmd_bulan();
		$data['cmd_pegawai'] = $this->m_admin_kredensial->ambil_data_dropdown_pegawai_no_null_unit();
		if(empty($data['id_pegawai'])){
			$data['id_pegawai'] = '0';
		}
		$data['cmd_tahun_logbook'] = $this->m_admin_user->cmd_tahun_logbook($data['id_pegawai']);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$bulan = $this->input->post("bulan");
			$tahun = $this->input->post("tahun");
			$id_pegawai = $this->input->post("id_pegawai");
			redirect(base_url('ketua_team/kinerja_klinis/lbulanan/'.$bulan.'/'.$tahun.'/'.$id_pegawai));
		}
    if($mode=='lbulanan'){
			$data['page'] =  $data['page']."_lbulanan";
			if(empty($data['pages'])){
				$data['pages'] = 'lbulanan';
			}
			$datekah1 = $this->m_rancak->validateDate($data['bulan']);
			$datekah2 = $this->m_rancak->validateDate($data['tahun']);
			if($datekah1 == false){
				$data['bulan'] = '01-'.date('m-Y');
			}
			if($datekah2 == false){
				$data['tahun'] = date('d-m-Y');
			}
			$data['ambil_range']   = $this->m_admin_user->ambil_range_logbook_bulanane($data['bulan'],$data['tahun'],$data['id_pegawai']);
		$this->tampil($data);
		}
  }
  function pengembangan_profesi($mode='view'){
		$data['page']  = "pengembangan_profesi";
		$data['title'] = "PENGEMBANGAN PROFESI";
		$data['header'] = "PENGEMBANGAN PROFESI";
		$data['link_awal'] = base_url('ketua_team');
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
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
		$data['first_date'] = $this->uri->segment(4, 0);
		$data['last_date'] = $this->uri->segment(5, 0);
		$data['id_pegawai'] = $this->uri->segment(6, 0);
		if(empty($data['first_date'])){
			$data['first_date'] = '01-'.date('m-Y');
		}
		if(empty($data['last_date'])){
			$data['last_date'] = date('d-m-Y');
		}
		if(empty($data['id_pegawai'])){
			$data['id_pegawai'] = '0';
		}
		$data['semuakah'] = array('0'=>'Range Tanggal','1'=>'Semua');
		$data['cmd_pegawai'] = $this->m_admin_kredensial->ambil_data_dropdown_pegawai_no_null_unit();
		$data['ambil_range'] = $this->m_admin_user->ambil_kategori_pelatihan($data['first_date'],$data['last_date'],$data['id_pegawai']);
    if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$first_date = $this->input->post("first_date");
				$last_date = $this->input->post("last_date");
				$id_pegawai = $this->input->post("id_pegawai");
				$range = $this->input->post("range");
				redirect(base_url('ketua_team/pengembangan_profesi/view/'.$first_date.'/'.$last_date.'/'.$id_pegawai));
			}
		}
  }
   function etik($mode='view'){
		$data['page']  = "etik";
		$data['title'] = "ETIKA PROFESI";
		$data['header'] = "ETIKA PROFESI";
		$data['link_awal'] = base_url('ketua_team');
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
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
		$data['first_date'] = $this->uri->segment(4, 0);
		$data['last_date'] = $this->uri->segment(5, 0);
		$data['id_pegawai'] = $this->uri->segment(6, 0);
		if(empty($data['first_date'])){
			$data['first_date'] = '01-'.date('m-Y');
		}
		if(empty($data['last_date'])){
			$data['last_date'] = date('d-m-Y');
		}
		if(empty($data['id_pegawai'])){
			$data['id_pegawai'] = '0';
		}
		$data['semuakah'] = array('0'=>'Range Tanggal','1'=>'Semua');
		$data['cmd_pegawai'] = $this->m_admin_kredensial->ambil_data_dropdown_pegawai_no_null_unit();
		$data['ambil_range'] = $this->m_admin_user->ambil_etik($data['first_date'],$data['last_date'],$data['id_pegawai']);
    if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$first_date = $this->input->post("first_date");
				$last_date = $this->input->post("last_date");
				$id_pegawai = $this->input->post("id_pegawai");
				$range = $this->input->post("range");
				redirect(base_url('ketua_team/etik/view/'.$first_date.'/'.$last_date.'/'.$id_pegawai));
			}
		}
  }
   function oppe($mode='view'){
		$data['page']  = "oppe";
		$data['title'] = "On going Professional Practise Evaluation";
		$data['header'] = "On going Professional Practise Evaluation";
		$data['link_awal'] = base_url('ketua_team');
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
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
		$data['first_date'] = $this->uri->segment(4, 0);
		$data['last_date'] = $this->uri->segment(5, 0);
		$data['id_pegawai'] = $this->uri->segment(6, 0);
		if(empty($data['first_date'])){
			$data['first_date'] = '01-'.date('m-Y');
		}
		if(empty($data['last_date'])){
			$data['last_date'] = date('d-m-Y');
		}
		if(empty($data['id_pegawai'])){
			$data['id_pegawai'] = '0';
		}
		$data['semuakah'] = array('0'=>'Range Tanggal','1'=>'Semua');
		$data['cmd_pegawai'] = $this->m_admin_kredensial->ambil_data_dropdown_pegawai_no_null_unit();
		$data['pelatihan'] = $this->m_admin_user->ambil_kategori_pelatihan($data['first_date'],$data['last_date'],$data['id_pegawai']);
		$data['etika'] = $this->m_admin_user->ambil_etik($data['first_date'],$data['last_date'],$data['id_pegawai']);
		$data['logbook']   = $this->m_admin_user->ambil_range_logbook_bulanane($data['first_date'],$data['last_date'],$data['id_pegawai']);
    if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$first_date = $this->input->post("first_date");
				$last_date = $this->input->post("last_date");
				$id_pegawai = $this->input->post("id_pegawai");
				$range = $this->input->post("range");
				redirect(base_url('ketua_team/oppe/view/'.$first_date.'/'.$last_date.'/'.$id_pegawai));
			}
		}
  }
   function kinerja_unit($mode='view'){
		$data['page']  = "kinerja_unit";
		$data['header'] = "KINERJA KLINIS RUANGAN / UNIT";
		$data['title'] = "KINERJA KLINIS RUANGAN / UNIT";
		$data['link_awal'] = base_url('ketua_team');
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
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
		$data['first_date'] = $this->uri->segment(4, 0);
		$data['last_date'] = $this->uri->segment(5, 0);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$first_date = $this->input->post("first_date");
			$last_date = $this->input->post("last_date");
			redirect(base_url('ketua_team/kinerja_unit/view/'.$first_date.'/'.$last_date.'/'.$id_pegawai));
		}
    if($mode=='view'){
			$datekah1 = $this->m_rancak->validateDate($data['first_date']);
			$datekah2 = $this->m_rancak->validateDate($data['last_date']);
			if($datekah1 == false){
				$data['first_date'] = '01-'.date('m-Y');
			}
			if($datekah2 == false){
				$data['last_date'] = date('d-m-Y');
			}
      $kondisi_loop = array('status_unit'=>1);
      $data['loop_unit']=$this->m_umum->ambil_comma_join_kondisi('ol_unit',$kondisi_loop,'coun_unit',$this->session->mas_unit,'nama_unit','asc');
			$data['ambil_range']   = $this->m_admin_kredensial->ambil_list_unit_kinerja();
			$this->tampil($data);
		}
  }
	function demografi($mode='view'){
		$data['page']="demografi"; 
		$data['header'] = "DATA DEMOGRAFI";
		$data['title'] = "DATA DEMOGRAFI";
		$data['link_awal'] = base_url('ketua_team');
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',10);
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
		$data['id']   = $this->uri->segment(4, 0);
		$data['id2']   = $this->uri->segment(5, 0);
		//======================= IMPORTANT =========================================
			$data['working']=$this->m_admin_kredensial->ambil_data_rujukan_working();
			$data['jabatan']=$this->m_admin_kredensial->cmd_jabatan();
			$kondisi_loop = array('status_unit'=>1);
			$data['loop_unit']=$this->m_umum->ambil_comma_join_kondisi('ol_unit',$kondisi_loop,'coun_unit',$this->session->mas_unit,'nama_unit','asc');
	  if($mode=='view'){
			if(empty($data['id'])){
				$data['id'] = $this->session->refer;
			}
			if(empty($data['id2'])){
				$data['id2'] = $this->session->id_jabatan;
			}
			$kerjae = $this->m_umum->ambil_data('kol_working','id_working',$data['id']);
			$data['gawe_sekien'] = $kerjae['nama_working'];
			$fungsie = $this->m_umum->ambil_data('jabatan','id_jabatan',$data['id2']);
			$data['jab_sekien'] = $fungsie['nama_jabatan'];
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$id = $this->input->post("id");
				$id2 = $this->input->post("id2");
				redirect(base_url('ketua_team/demografi/view/'.$id.'/'.$id2));
			}
			$this->tampil_top($data);
		}
		if($mode=='pdf_gender'){
	    $report = $this->load->view('cetak/kred_gender', $data, TRUE);
		  $namaku = $this->m_umum->ambil_data('kol_working','id_working',$data['id']);
		  $arankerja = preg_replace('/[ .]+/', ' ', $namaku['nama_working']);
		  $jabatanku = $this->m_umum->ambil_data('jabatan','id_jabatan',$data['id2']);
		  $filename = 'kredensial-'.$arankerja."-".$jabatanku['nama_jabatan']."-print-date-".date('d-m-Y-H-i-s')."-instansi-jabfung-gender.pdf";
//$mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'L','margin_left' => '5','margin_right' => '5','margin_top' => '5','margin_bottom' => '5']);
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->AddPage('L', '', '', '', 2, 5, 5, 5, 5, 3, 3);
		  $mpdf->SetDisplayMode('fullpage');
		  //$mpdf->SetFooter('Page : {PAGENO}');
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
		if($mode=='pdf_religi'){
	    $report = $this->load->view('cetak/kred_religi', $data, TRUE);
		  $namaku = $this->m_umum->ambil_data('kol_working','id_working',$data['id']);
		  $arankerja = preg_replace('/[ .]+/', ' ', $namaku['nama_working']);
		  $jabatanku = $this->m_umum->ambil_data('jabatan','id_jabatan',$data['id2']);
		  $filename = 'kredensial-'.$arankerja."-".$jabatanku['nama_jabatan']."-print-date-".date('d-m-Y-H-i-s')."-instansi-jabfung-religi.pdf";
//$mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'L','margin_left' => '5','margin_right' => '5','margin_top' => '5','margin_bottom' => '5']);
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->AddPage('L', '', '', '', 2, 5, 5, 5, 5, 3, 3);
		  $mpdf->SetDisplayMode('fullpage');
		  //$mpdf->SetFooter('Page : {PAGENO}');
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
		if($mode=='pdf_marital'){
	    $report = $this->load->view('cetak/kred_marital', $data, TRUE);
		  $namaku = $this->m_umum->ambil_data('kol_working','id_working',$data['id']);
		  $arankerja = preg_replace('/[ .]+/', ' ', $namaku['nama_working']);
		  $jabatanku = $this->m_umum->ambil_data('jabatan','id_jabatan',$data['id2']);
		  $filename = 'kredensial-'.$arankerja."-".$jabatanku['nama_jabatan']."-print-date-".date('d-m-Y-H-i-s')."-instansi-jabfung-marital.pdf";
//$mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'L','margin_left' => '5','margin_right' => '5','margin_top' => '5','margin_bottom' => '5']);
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->AddPage('L', '', '', '', 2, 5, 5, 5, 5, 3, 3);
		  $mpdf->SetDisplayMode('fullpage');
		  //$mpdf->SetFooter('Page : {PAGENO}');
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
		if($mode=='pdf_asn'){
	    $report = $this->load->view('cetak/kred_asn', $data, TRUE);
		  $namaku = $this->m_umum->ambil_data('kol_working','id_working',$data['id']);
		  $arankerja = preg_replace('/[ .]+/', ' ', $namaku['nama_working']);
		  $jabatanku = $this->m_umum->ambil_data('jabatan','id_jabatan',$data['id2']);
		  $filename = 'kredensial-'.$arankerja."-".$jabatanku['nama_jabatan']."-print-date-".date('d-m-Y-H-i-s')."-instansi-jabfung-pegawai.pdf";
//$mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'L','margin_left' => '5','margin_right' => '5','margin_top' => '5','margin_bottom' => '5']);
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->AddPage('L', '', '', '', 2, 5, 5, 5, 5, 3, 3);
		  $mpdf->SetDisplayMode('fullpage');
		  //$mpdf->SetFooter('Page : {PAGENO}');
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
		if($mode=='pdf_grade'){
	    $report = $this->load->view('cetak/kred_grade', $data, TRUE);
		  $namaku = $this->m_umum->ambil_data('kol_working','id_working',$data['id']);
		  $arankerja = preg_replace('/[ .]+/', ' ', $namaku['nama_working']);
		  $jabatanku = $this->m_umum->ambil_data('jabatan','id_jabatan',$data['id2']);
		  $filename = 'kredensial-'.$arankerja."-".$jabatanku['nama_jabatan']."-print-date-".date('d-m-Y-H-i-s')."-instansi-grade.pdf";
//$mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'L','margin_left' => '5','margin_right' => '5','margin_top' => '5','margin_bottom' => '5']);
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->AddPage('L', '', '', '', 2, 5, 5, 5, 5, 3, 3);
		  $mpdf->SetDisplayMode('fullpage');
		  //$mpdf->SetFooter('Page : {PAGENO}');
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
		if($mode=='pdf_pendidikan'){
	    $report = $this->load->view('cetak/kred_pendidikan', $data, TRUE);
		  $namaku = $this->m_umum->ambil_data('kol_working','id_working',$data['id']);
		  $arankerja = preg_replace('/[ .]+/', ' ', $namaku['nama_working']);
		  $jabatanku = $this->m_umum->ambil_data('jabatan','id_jabatan',$data['id2']);
		  $filename = 'kredensial-'.$arankerja."-".$jabatanku['nama_jabatan']."-print-date-".date('d-m-Y-H-i-s')."-instansi-jabfung-pendidikan.pdf";
//$mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'L','margin_left' => '5','margin_right' => '5','margin_top' => '5','margin_bottom' => '5']);
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->AddPage('L', '', '', '', 2, 5, 5, 5, 5, 3, 3);
		  $mpdf->SetDisplayMode('fullpage');
		  //$mpdf->SetFooter('Page : {PAGENO}');
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
		if($mode=='pdf_jabfung'){
	    $report = $this->load->view('cetak/kred_jabfung', $data, TRUE);
		  $namaku = $this->m_umum->ambil_data('kol_working','id_working',$data['id']);
		  $arankerja = preg_replace('/[ .]+/', ' ', $namaku['nama_working']);
		  $jabatanku = $this->m_umum->ambil_data('jabatan','id_jabatan',$data['id2']);
		  $filename = 'kredensial-'.$arankerja."-".$jabatanku['nama_jabatan']."-print-date-".date('d-m-Y-H-i-s')."-instansi-jabfung-fungsional.pdf";
//$mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'L','margin_left' => '5','margin_right' => '5','margin_top' => '5','margin_bottom' => '5']);
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->AddPage('L', '', '', '', 2, 5, 5, 5, 5, 3, 3);
		  $mpdf->SetDisplayMode('fullpage');
		  //$mpdf->SetFooter('Page : {PAGENO}');
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
		if($mode=='pdf_pelatihan'){
	    $report = $this->load->view('cetak/kred_pelatihan', $data, TRUE);
		  $namaku = $this->m_umum->ambil_data('kol_working','id_working',$data['id']);
		  $arankerja = preg_replace('/[ .]+/', ' ', $namaku['nama_working']);
		  $jabatanku = $this->m_umum->ambil_data('jabatan','id_jabatan',$data['id2']);
		  $filename = 'kredensial-'.$arankerja."-".$jabatanku['nama_jabatan']."-print-date-".date('d-m-Y-H-i-s')."-instansi-jabfung-pelatihan.pdf";
//$mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'L','margin_left' => '5','margin_right' => '5','margin_top' => '5','margin_bottom' => '5']);
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->AddPage('L', '', '', '', 2, 5, 5, 5, 5, 3, 3);
		  $mpdf->SetDisplayMode('fullpage');
		  //$mpdf->SetFooter('Page : {PAGENO}');
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
		if($mode=='pdf_alamat'){
	    $report = $this->load->view('cetak/kred_alamat', $data, TRUE);
		  $namaku = $this->m_umum->ambil_data('kol_working','id_working',$data['id']);
		  $arankerja = preg_replace('/[ .]+/', ' ', $namaku['nama_working']);
		  $jabatanku = $this->m_umum->ambil_data('jabatan','id_jabatan',$data['id2']);
		  $filename = 'kredensial-'.$arankerja."-".$jabatanku['nama_jabatan']."-print-date-".date('d-m-Y-H-i-s')."-instansi-jabfung-alamat.pdf";
//$mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'L','margin_left' => '5','margin_right' => '5','margin_top' => '5','margin_bottom' => '5']);
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->AddPage('L', '', '', '', 2, 5, 5, 5, 5, 3, 3);
		  $mpdf->SetDisplayMode('fullpage');
		  //$mpdf->SetFooter('Page : {PAGENO}');
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
		if($mode=='pdf_surat_ijin_aktif'){
	    $report = $this->load->view('cetak/kred_aktif', $data, TRUE);
		  $namaku = $this->m_umum->ambil_data('kol_working','id_working',$data['id']);
		  $arankerja = preg_replace('/[ .]+/', ' ', $namaku['nama_working']);
		  $jabatanku = $this->m_umum->ambil_data('jabatan','id_jabatan',$data['id2']);
		  $filename = 'kredensial-'.$arankerja."-".$jabatanku['nama_jabatan']."-print-date-".date('d-m-Y-H-i-s')."-instansi-jabfung-aktif.pdf";
//$mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'L','margin_left' => '5','margin_right' => '5','margin_top' => '5','margin_bottom' => '5']);
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->AddPage('L', '', '', '', 2, 5, 5, 5, 5, 3, 3);
		  $mpdf->SetDisplayMode('fullpage');
		  //$mpdf->SetFooter('Page : {PAGENO}');
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
		if($mode=='pdf_surat_ijin_tenggang'){
	    $report = $this->load->view('cetak/kred_tenggang', $data, TRUE);
		  $namaku = $this->m_umum->ambil_data('kol_working','id_working',$data['id']);
		  $arankerja = preg_replace('/[ .]+/', ' ', $namaku['nama_working']);
		  $jabatanku = $this->m_umum->ambil_data('jabatan','id_jabatan',$data['id2']);
		  $filename = 'kredensial-'.$arankerja."-".$jabatanku['nama_jabatan']."-print-date-".date('d-m-Y-H-i-s')."-instansi-jabfung-tenggang.pdf";
//$mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'L','margin_left' => '5','margin_right' => '5','margin_top' => '5','margin_bottom' => '5']);
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->AddPage('L', '', '', '', 2, 5, 5, 5, 5, 3, 3);
		  $mpdf->SetDisplayMode('fullpage');
		  //$mpdf->SetFooter('Page : {PAGENO}');
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
		if($mode=='pdf_surat_ijin_expired'){
	    $report = $this->load->view('cetak/kred_expired', $data, TRUE);
		  $namaku = $this->m_umum->ambil_data('kol_working','id_working',$data['id']);
		  $arankerja = preg_replace('/[ .]+/', ' ', $namaku['nama_working']);
		  $jabatanku = $this->m_umum->ambil_data('jabatan','id_jabatan',$data['id2']);
		  $filename = 'kredensial-'.$arankerja."-".$jabatanku['nama_jabatan']."-print-date-".date('d-m-Y-H-i-s')."-instansi-jabfung-expired.pdf";
//$mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'L','margin_left' => '5','margin_right' => '5','margin_top' => '5','margin_bottom' => '5']);
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->AddPage('L', '', '', '', 2, 5, 5, 5, 5, 3, 3);
		  $mpdf->SetDisplayMode('fullpage');
		  //$mpdf->SetFooter('Page : {PAGENO}');
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
	}
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("ketua_team/header",$data);
	$this->load->view("ketua_team/isi");
	$this->load->view("footer");
	$this->load->view("ketua_team/jsload");
	$this->load->view("ketua_team/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_topol",$data);
	$this->load->view("ketua_team/isi");
	$this->load->view("footer");
	$this->load->view("ketua_team/jsload");
	$this->load->view("ketua_team/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
