<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');
// ALTER TABLE `ol_user` ADD `status_asesor` TINYINT UNSIGNED NOT NULL DEFAULT '0' AFTER `status_user`;
class External extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
    parent::__construct();
    $this->load->model('m_ol_rancak');
    $this->load->model('m_external');
    $this->load->model('m_member');
    $this->load->model('m_ol_laporan');
    $this->load->model('m_anjababk');
  }
	function index(){
		$this->home();
	}
	function home(){
		$data['page']="home";
		$data['surveyor'] = '1';
		$data['member_name'] = 'WELCOME USER';
		$data['level_name'] = 'SURVEYOR';
		$data['photo'] = base_url().'assets/images/noavatar.jpg';
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$data['header'] = $instansi["nama_instansi"];
		$data['title'] = $instansi["nama_instansi"];
		$data['instance_status'] = $instansi["status_instansi"];
		$data['instance_id'] = $instansi["id_instansi"];
		$data['instance_name'] = $instansi["nama_instansi"];
		$data['idescription'] = $instansi["description"];
		$data['ikeywords'] = $instansi["keywords"];
		$data['iheader'] = $instansi["header"];
		$data['iheader_mini'] = $instansi["header_mini"];
		$data['ifooter'] = $instansi["footer"];
		$data['ilicensed'] = $instansi["licensed"];
		$data['iconik'] = $instansi["icon"];
		$data['logonik'] = $instansi["logo"];
		$whats = $this->m_umum->ambil_data('ol_whatsnew','id_whatsnew',1);
		$data['isi_whatsnew']   = $whats['isi_whatsnew'];
		$this->tampil($data);
	}
  function personal($mode='view'){
    $data['page']  = "personal";
    $data['member_name'] = 'WELCOME USER';
    $data['level_name'] = 'SURVEYOR';
    $data['link_awal'] = base_url('external/laporan');
    $instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
    $data['header'] = $instansi["nama_instansi"];
    $data['title'] = "LAPORAN";
    $data['instance_status'] = $instansi["status_instansi"];
    $data['instance_id'] = $instansi["id_instansi"];
    $data['instance_name'] = $instansi["nama_instansi"];
    $data['idescription'] = $instansi["description"];
    $data['ikeywords'] = $instansi["keywords"];
    $data['iheader'] = $instansi["header"];
    $data['iheader_mini'] = $instansi["header_mini"];
    $data['ifooter'] = $instansi["footer"];
    $data['ilicensed'] = $instansi["licensed"];
    $data['iconik'] = $instansi["icon"];
    $data['surveyor'] = '1';
    $data['member_name'] = 'WELCOME USER';
    $data['level_name'] = 'SURVEYOR';
    $data['photo'] = base_url().'assets/images/noavatar.jpg';
    $data['idlap'] = $this->uri->segment(4, 0);
    $data['iddet'] = $this->uri->segment(5, 0);
    $data['ambil_tabel'] = $this->m_external->ambil_ol_per_laporan_detil($data['idlap']);
    if(empty($data['iddet'])){
      redirect(base_url('external'));    
    }
    $kondisi=array('id_laporan_detil'=>$data['iddet']);
    $jml = $this->m_umum->jumlah_record_filter('ol_per_laporan_detil',$kondisi);
    if($jml == 0){
      redirect(base_url('external'));
    }
    //======================= IMPORTANT =========================================
    $kondisi_cek = array('id_laporan_detil'=>$data['iddet'],'pembuat_laporan'=>$this->session->barcode_pegawai);
    $data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('ol_per_laporan_detil',$kondisi_cek,'ol_per_laporan','id_laporan');
    $lp = $this->m_ol_rancak->ambil_data_per_laporan_detil($data['iddet']); // id_laporan_detil
    $data['id_laporan']  = set_value('id_laporan',$lp["id_laporan"]);
    $data['aran_pegawai']  = set_value('aran_pegawai',$lp["nama_pegawai"]);
    $data['id_equipment']  = set_value('id_equipment',$lp["id_equipment"]);
    $data['nama_unit']  = set_value('nama_unit',$lp["nama_unit"]);
    $data['tgl_laporan']  = set_value('tgl_laporan',date('d-m-Y', strtotime($lp["tgl_laporan"])));
  //  $data['tgl_awal']  = set_value('tgl_awal',date('d-m-Y', strtotime($lp["tgl_awal"])));
  //  $data['tgl_akhir']  = set_value('tgl_akhir',date('d-m-Y', strtotime($lp["tgl_akhir"])));
    $data['tgl_awal']  = set_value('tgl_awal',$lp["tgl_awal"]);
    $data['tgl_akhir']  = set_value('tgl_akhir',$lp["tgl_akhir"]);
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
    $data['show_pdf']  = set_value('show_pdf',$lp["show_pdf"]);
    $data['tabel']  = set_value('tabel',$lp["tabel"]);
    $data['button']  = set_value('button',$lp["button"]);
    $data['jenis_per_laporan_detil']  = set_value('jenis_per_laporan_detil',$lp["jenis_per_laporan_detil"]);
  //=====================================
    if($lp["jenis_per_laporan_detil"] == 2){
      $data['head1'] = 'indikator';
      $data['head2'] = 'Poin Mutu';
      $data['tabel_item'] = 'ol_per_imqc_hasil';
      $data['Kat_lv1'] = 'ol_per_imqc_detil.id_per_imqc';
      $data['id_kat_lv1'] = 'id_per_imqc';
      $data['coun_kat_lv1'] = 'coun_per_imqc';
      $data['nama_kat_lv1'] = 'nama_per_imqc';
      $data['Kat_lv2'] = 'ol_per_imqc_hasil.id_per_imqc_detil';
      $data['id_kat_lv2'] = 'id_per_imqc_detil';
      $data['coun_kat_lv2'] = 'coun_per_imqc_detil';
      $data['nama_kat_lv2'] = 'nama_per_imqc_detil';
      $data['tgl_item'] = 'tgl_per_imqc_hasil';
      $data['jml_item'] = 'hasil_per_imqc_hasil';
      $data['ins'] = 'ol_per_imqc_hasil.barcode_pegawai';
      $data['idinst'] = $lp['pembuat_laporan'];
      $data['yesno'] = 'yn_per_imqc_hasil';
    }
    if($lp["jenis_per_laporan_detil"] == 3){
      $data['head1'] = 'Kategori';
      $data['head2'] = 'Kompetensi / Kewenangan';
      $data['tabel_item'] = 'ol_logbook';
      $data['Kat_lv1'] = 'nkr_kewenangan.id_kompetensi';
      $data['id_kat_lv1'] = 'id_kompetensi';
      $data['coun_kat_lv1'] = 'coun_kompetensi';
      $data['nama_kat_lv1'] = 'nama_kompetensi';
      $data['Kat_lv2'] = 'ol_logbook.id_kewenangan';
      $data['id_kat_lv2'] = 'id_kewenangan';
      $data['coun_kat_lv2'] = 'coun_kewenangan';
      $data['nama_kat_lv2'] = 'nama_kewenangan';
      $data['tgl_item'] = 'tgl_logbook';
      $data['jml_item'] = 'jml_logbook';
      $data['ins'] = 'ol_logbook.id_logbooker';
      $data['idinst'] = $lp['id_pegawai'];
      $data['yesno'] = 'tolak';
    }
    if($lp["jenis_per_laporan_detil"] == 4){
      $data['head1'] = 'indikator';
      $data['head2'] = 'Poin Mutu';
      $data['tabel_item'] = 'ol_eq_imut';
      $data['Kat_lv1'] = 'ol_eq_detil.id_equipment';
      $data['id_kat_lv1'] = 'id_equipment';
      $data['coun_kat_lv1'] = 'coun_equipment';
      $data['nama_kat_lv1'] = 'nama_equipment';
      $data['Kat_lv2'] = 'ol_eq_imut.id_eq_detil';
      $data['id_kat_lv2'] = 'id_eq_detil';
      $data['coun_kat_lv2'] = 'coun_eq_detil';
      $data['nama_kat_lv2'] = 'nama_eq_detil';
      $data['tgl_item'] = 'tgl_eq_imut';
      $data['jml_item'] = 'hasil_eq_imut';
      $data['ins'] = 'id_unit';
      $data['idinst'] = $this->session->unit;
      $data['yesno'] = 'yn_eq_imut';
    }
    if($lp["jenis_per_laporan_detil"] == 5){
      $data['head1'] = 'Kategori Berkas';
      $data['head2'] = 'Berkas';
      $data['tabel_item'] = 'ol_berkas';
      $data['Kat_lv1'] = 'ol_berkas_kategori.id_berkas_kategori';
      $data['id_kat_lv1'] = 'id_berkas_kategori';
      $data['coun_kat_lv1'] = 'id_berkas_kategori';
      $data['nama_kat_lv1'] = 'nama_berkas_kategori';
      $data['Kat_lv2'] = 'ol_berkas.id_berkas';
      $data['id_kat_lv2'] = 'id_berkas';
      $data['coun_kat_lv2'] = 'id_berkas';
      $data['nama_kat_lv2'] = 'nama_berkas';
      $data['tgl_item'] = 'tgl_b_berkas';
      $data['jml_item'] = 'kredit';
      $data['ins'] = 'ol_berkas.id_pegawai';
      $data['idinst'] = $this->session->id_pegawai;
      $data['yesno'] = 'yn_eq_imut';
    }
  //=====================================
    $data['js_thn'] = 'js_thn';
    $data['js_bln'] = 'js_bln';
    $data['js_hr'] = 'js_hr';
    $data['tgl_bln'] = 'tgl_bln';
    $data['tgl_hr'] = 'tgl_hr';
    $data['tgl_thn'] = 'tgl_thn';
  //=====================================
    if($lp['periode_laporan_detil'] == 1){
      $data['period'] = 'MONTH('.$data['tgl_item'].')';
    }else{
      $data['period'] = 'YEAR('.$data['tgl_item'].')';
    }
  //=====================================
  $data['selectgrafik5'] = ("sum(".$data['jml_item'].") as ".$data['jml_item'].",".$data['Kat_lv2']." as ".$data['id_kat_lv1'].",DATE_FORMAT(".$data['tgl_item'].",'%d-%m-%Y') as tgl_hr,DATE_FORMAT(".$data['tgl_item'].",'%m-%Y') as tgl_bln,DATE_FORMAT(".$data['tgl_item'].",'%Y') as tgl_thn,".$data['tgl_item']." as ".$data['tgl_item'].",MONTH(".$data['tgl_item'].") as js_bln,YEAR(".$data['tgl_item'].") as js_thn,DATE_FORMAT(".$data['tgl_item'].",'%d') as js_hr,concat(".$data['nama_kat_lv2'].",' - ',".$data['nama_kat_lv1'].") as ".$data['nama_kat_lv2'].",".$data['coun_kat_lv1'].",".$data['coun_kat_lv2']."  ");
    $data['select_pie'] = ("*,sum(".$data['jml_item'].") as ".$data['jml_item']."");
    $data['select_semua'] = ("*");
    $data['select_all'] = ("*,
    DATE_FORMAT(".$data['tgl_item'].",'%d-%m-%Y') as tgl_hr,DATE_FORMAT(".$data['tgl_item'].",'%m-%Y') as tgl_bln,DATE_FORMAT(".$data['tgl_item'].",'%Y') as tgl_thn,".$data['tgl_item']." as ".$data['tgl_item'].",MONTH(".$data['tgl_item'].") as js_bln,YEAR(".$data['tgl_item'].") as js_thn,DATE_FORMAT(".$data['tgl_item'].",'%d') as js_hr,concat(".$data['nama_kat_lv2'].",' - ',".$data['nama_kat_lv1'].") as ".$data['nama_kat_lv2'].",".$data['coun_kat_lv1'].",".$data['coun_kat_lv2']."
      ");
    $data['kndsbln'] = array($data['tgl_item'].' >='=>$lp["tgl_awal"],$data['tgl_item'].' <='=>$lp["tgl_akhir"],$data['ins']=>$data['idinst']);
  //=====================================
    if($lp["periode_laporan_detil"] == 1){ // HARIAN
  $data['kondisi1'] = array(''.$data['tgl_item'].' >='=>$lp["tgl_awal"],''.$data['tgl_item'].' <='=>$lp["tgl_akhir"],$data['ins']=>$data['idinst'],''.$data['jml_item'].' >'=>0);
    $data['grupgrafikgaris'] = $data['tgl_item'];
    $data['viewgraphic'] ='tgl_hr';
    }
    if($lp["periode_laporan_detil"] == 2){ // BULANAN
  $data['kondisi1'] = array(''.$data['tgl_item'].' >='=>$lp["tgl_awal"],''.$data['tgl_item'].' <='=>$lp["tgl_akhir"],$data['ins']=>$data['idinst'],''.$data['jml_item'].' >'=>0);
    $data['grupgrafikgaris'] = 'MONTH('.$data['tgl_item'].')';
    $data['viewgraphic'] ='tgl_bln';
    }
    if($lp["periode_laporan_detil"] == 3){ // TAHUNAN
  $data['kondisi1'] = array($data['ins']=>$data['idinst'],''.$data['jml_item'].' >'=>0);
  $data['grupgrafikgaris'] = 'YEAR('.$data['tgl_item'].')';
  $data['viewgraphic'] ='tgl_thn';
    }
  //=====================================
    if($lp["jenis_per_laporan_detil"] == 4){
 //===================================== jenis_per_laporan_detil == 4
    $data['ambil_bulan'] = $this->m_external->ambil_isi($data['iddet'],$data['tabel_item'],$data['select_all'],$data['kndsbln'],$data['period']);
      //=====================================
  $data['ambil_data_min'] = $this->m_external->get_min($data['iddet'],$data['tabel_item'],$data['jml_item'],$data['kndsbln']);
  $data['ambil_data_max'] = $this->m_external->get_max($data['iddet'],$data['tabel_item'],$data['jml_item'],$data['kndsbln']);
  //=====================================
  $data['grafik5'] = $this->m_external->ambil_isi($data['iddet'],$data['tabel_item'],$data['selectgrafik5'],$data['kondisi1'],$data['grupgrafikgaris']);
  $data['grafikpie'] = $this->m_external->ambil_isi($data['iddet'],$data['tabel_item'],$data['select_pie'],$data['kondisi1'],$data['Kat_lv2']);
  $data['grafikbtg'] = $this->m_external->ambil_isi($data['iddet'],$data['tabel_item'],$data['select_semua'],$data['kondisi1'],$data['Kat_lv1']);
  $data['legendgrafik5'] = $this->m_external->ambil_isi($data['iddet'],$data['tabel_item'],$data['select_all'],$data['kondisi1'],$data['Kat_lv2']);
 //===================================== !jenis_per_laporan_detil == 4
    }else if($lp["jenis_per_laporan_detil"] == 5){
      $data['kondisi_berkas'] = array('id_kategori_berkas >'=>13,'link_berkas !='=>'','status_berkas'=>1,$data['ins']=>$data['idinst']);
      $data['kondisi_imut'] = array('id_kategori_berkas'=>12,'link_berkas !='=>'','status_berkas'=>1,$data['ins']=>$data['idinst']);
      $data['kondisi_ijasah'] = array('id_kategori_berkas'=>7,'link_berkas !='=>'','status_berkas'=>1,$data['ins']=>$data['idinst']);
      $data['kondisi_pelatihan'] = array('kunci'=>1,'link_berkas !='=>'','status_berkas'=>1,$data['ins']=>$data['idinst']);
      $data['kondisi_str'] = array('kunci'=>0,'link_berkas !='=>'','status_berkas'=>1,$data['ins']=>$data['idinst']);

      $data['jml_berkas'] = $this->m_external->jumlah_sumber_data_personal($data['iddet'],$data['tabel_item'],$data['select_all'],$data['kondisi_berkas']);
      $data['jml_imut'] = $this->m_external->jumlah_sumber_data_personal($data['iddet'],$data['tabel_item'],$data['select_all'],$data['kondisi_imut']);
      $data['jml_ijasah'] = $this->m_external->jumlah_sumber_data_personal($data['iddet'],$data['tabel_item'],$data['select_all'],$data['kondisi_ijasah']);
      $data['jml_pelatihan'] = $this->m_external->jumlah_sumber_data_personal($data['iddet'],$data['tabel_item'],$data['select_all'],$data['kondisi_pelatihan']);
      $data['jml_str'] = $this->m_external->jumlah_sumber_data_personal($data['iddet'],$data['tabel_item'],$data['select_all'],$data['kondisi_str']);

      $data['ambil_berkas'] = $this->m_external->ambil_isi_personal($data['iddet'],$data['tabel_item'],$data['select_all'],$data['kondisi_berkas']);
      $data['ambil_imut'] = $this->m_external->ambil_isi_personal($data['iddet'],$data['tabel_item'],$data['select_all'],$data['kondisi_imut']);
      $data['ambil_ijasah'] = $this->m_external->ambil_isi_personal($data['iddet'],$data['tabel_item'],$data['select_all'],$data['kondisi_ijasah']);
      $data['ambil_pelatihan'] = $this->m_external->ambil_isi_personal($data['iddet'],$data['tabel_item'],$data['select_all'],$data['kondisi_pelatihan']);
      $data['ambil_str'] = $this->m_external->ambil_isi_personal($data['iddet'],$data['tabel_item'],$data['select_all'],$data['kondisi_str']);
    }
    else{
 //===================================== jenis_per_laporan_detil == 4 ELSE
  $data['ambil_data_min'] = $this->m_external->get_min_personal($data['iddet'],$data['tabel_item'],$data['jml_item'],$data['kndsbln']);
  $data['ambil_data_max'] = $this->m_external->get_max_personal($data['iddet'],$data['tabel_item'],$data['jml_item'],$data['kndsbln']);
  //=====================================
  $data['grafik5'] = $this->m_external->ambil_isi_personal($data['iddet'],$data['tabel_item'],$data['selectgrafik5'],$data['kondisi1'],$data['grupgrafikgaris']);
  $data['grafikpie'] = $this->m_external->ambil_isi_personal($data['iddet'],$data['tabel_item'],$data['select_pie'],$data['kondisi1'],$data['Kat_lv2']);
  $data['grafikbtg'] = $this->m_external->ambil_isi_personal($data['iddet'],$data['tabel_item'],$data['select_semua'],$data['kondisi1'],$data['Kat_lv1']);
  $data['legendgrafik5'] = $this->m_external->ambil_isi_personal($data['iddet'],$data['tabel_item'],$data['select_semua'],$data['kondisi1'],$data['Kat_lv2']);
      //=====================================
    $data['ambil_bulan'] = $this->m_external->ambil_isi_personal($data['iddet'],$data['tabel_item'],$data['select_semua'],$data['kndsbln'],$data['period']);
 //===================================== jenis_per_laporan_detil == 4 ELSE
    }
      //=====================================
    if($mode=='view'){
      $this->tampil($data);
    }
  }
  function imut($mode='view'){
    $data['page']  = "imut";
    $data['member_name'] = 'WELCOME USER';
    $data['level_name'] = 'SURVEYOR';
    $data['link_awal'] = base_url('external/laporan');
    $instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
    $data['header'] = $instansi["nama_instansi"];
    $data['title'] = "LAPORAN";
    $data['instance_status'] = $instansi["status_instansi"];
    $data['instance_id'] = $instansi["id_instansi"];
    $data['instance_name'] = $instansi["nama_instansi"];
    $data['idescription'] = $instansi["description"];
    $data['ikeywords'] = $instansi["keywords"];
    $data['iheader'] = $instansi["header"];
    $data['iheader_mini'] = $instansi["header_mini"];
    $data['ifooter'] = $instansi["footer"];
    $data['ilicensed'] = $instansi["licensed"];
    $data['iconik'] = $instansi["icon"];
    $data['surveyor'] = '1';
    $data['member_name'] = 'WELCOME USER';
    $data['level_name'] = 'SURVEYOR';
    $data['photo'] = base_url().'assets/images/noavatar.jpg';
    $data['idlap'] = $this->uri->segment(4, 0);
    $data['iddet'] = $this->uri->segment(5, 0);
    $data['ambil_tabel'] = $this->m_external->ambil_ol_laporan_detil($data['idlap']);
    if(empty($data['iddet'])){
      redirect(base_url('external'));    
    }
    $kondisi=array('id_laporan_detil'=>$data['iddet']);
    $jml = $this->m_umum->jumlah_record_filter('ol_laporan_detil',$kondisi);
    if($jml == 0){
      redirect(base_url('external'));
    }
    //======================= IMPORTANT =========================================
    $kondisi_cek = array('id_laporan_detil'=>$data['iddet'],'pembuat_laporan'=>$this->session->barcode_pegawai);
    $data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('ol_laporan_detil',$kondisi_cek,'ol_laporan','id_laporan');
    $lp = $this->m_ol_rancak->ambil_data_laporan_detil($data['iddet']); // id_laporan_detil
    $data['id_laporan']  = set_value('id_laporan',$lp["id_laporan"]);
    $data['aran_pegawai']  = set_value('aran_pegawai',$lp["nama_pegawai"]);
    $data['id_equipment']  = set_value('id_equipment',$lp["id_equipment"]);
    $data['nama_unit']  = set_value('nama_unit',$lp["nama_unit"]);
    $data['tgl_laporan']  = set_value('tgl_laporan',date('d-m-Y', strtotime($lp["tgl_laporan"])));
  //  $data['tgl_awal']  = set_value('tgl_awal',date('d-m-Y', strtotime($lp["tgl_awal"])));
  //  $data['tgl_akhir']  = set_value('tgl_akhir',date('d-m-Y', strtotime($lp["tgl_akhir"])));
    $data['tgl_awal']  = set_value('tgl_awal',$lp["tgl_awal"]);
    $data['tgl_akhir']  = set_value('tgl_akhir',$lp["tgl_akhir"]);
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
    $data['show_pdf']  = set_value('show_pdf',$lp["show_pdf"]);
    $data['tabel']  = set_value('tabel',$lp["tabel"]);
    $data['button']  = set_value('button',$lp["button"]);
    $data['porsen'] = array($lp["numerator_laporan_detil"],$lp["denumerator_laporan_detil"]);
    $data['jenis_per_laporan_detil'] = array($lp["jenis_per_laporan_detil"],$lp["jenis_per_laporan_detil"]);
  //=====================================
    $data['tabel_kat_lv1'] = 'ol_equipment';
    $data['tabel_persen'] = 'ol_eq_denum';
    $data['target_persen'] = 'target_eq_denum';
    $data['x_persen'] = 'x.id_eq_detil';
    $data['xas_persen'] = 'xid';
    $data['y_persen'] = 'y.id_eq_detil';
    $data['yas_persen'] = 'yid';
    $data['x_nama_persen'] = 'x.nama_eq_detil';
    $data['xas_nama_persen'] = 'xnama';
    $data['y_nama_persen'] = 'y.nama_eq_detil';
    $data['yas_nama_persen'] = 'ynama';
    $data['status_persen'] = 'status_eq_denum';
    $data['tabel_item'] = 'ol_eq_imut';
    $data['Kat_lv1'] = 'ol_eq_detil.id_equipment';
    $data['id_kat_lv1'] = 'id_equipment';
    $data['coun_kat_lv1'] = 'coun_equipment';
    $data['nama_kat_lv1'] = 'nama_equipment';
    $data['Kat_lv2'] = 'ol_eq_imut.id_eq_detil';
    $data['id_kat_lv2'] = 'id_eq_detil';
    $data['coun_kat_lv2'] = 'coun_eq_detil';
    $data['nama_kat_lv2'] = 'nama_eq_detil';
    $data['tgl_item'] = 'tgl_eq_imut';
    $data['jml_item'] = 'hasil_eq_imut';
    $data['ins'] = 'id_unit';
    $data['idinst'] = $lp['id_unit'];
    $data['yesno'] = 'yn_eq_imut';
  //=====================================
    $data['js_thn'] = 'js_thn';
    $data['js_bln'] = 'js_bln';
    $data['js_hr'] = 'js_hr';
    $data['tgl_bln'] = 'tgl_bln';
    $data['tgl_hr'] = 'tgl_hr';
    $data['tgl_thn'] = 'tgl_thn';
  //=====================================
    if($lp['periode_laporan_detil'] == 1){
      $data['period'] = 'MONTH('.$data['tgl_item'].')';
    }else{
      $data['period'] = 'YEAR('.$data['tgl_item'].')';
    }
      //=====================================
    $data['selectpersen'] = ("*,".$data['y_persen']." as ".$data['yas_persen'].",".$data['x_persen']." as ".$data['xas_persen'].",".$data['y_nama_persen']." as ".$data['yas_nama_persen'].",".$data['x_nama_persen']." as ".$data['xas_nama_persen']."");
    $data['kndspersen'] = array($data['status_persen']=>1,$data['ins']=>$data['idinst']);
  $data['selectgrafik5'] = ("sum(".$data['jml_item'].") as ".$data['jml_item'].",".$data['Kat_lv2']." as ".$data['id_kat_lv1'].",DATE_FORMAT(".$data['tgl_item'].",'%d-%m-%Y') as tgl_hr,DATE_FORMAT(".$data['tgl_item'].",'%m-%Y') as tgl_bln,DATE_FORMAT(".$data['tgl_item'].",'%Y') as tgl_thn,".$data['tgl_item']." as ".$data['tgl_item'].",MONTH(".$data['tgl_item'].") as js_bln,YEAR(".$data['tgl_item'].") as js_thn,DATE_FORMAT(".$data['tgl_item'].",'%d') as js_hr,concat(".$data['nama_kat_lv2'].",' - ',".$data['nama_kat_lv1'].") as ".$data['nama_kat_lv2'].",".$data['coun_kat_lv1'].",".$data['coun_kat_lv2']."  ");
    $data['select_pie'] = ("*,sum(".$data['jml_item'].") as ".$data['jml_item']."");
    $data['select_semua'] = ("*");
    $data['select_all'] = ("*,
    DATE_FORMAT(".$data['tgl_item'].",'%d-%m-%Y') as tgl_hr,DATE_FORMAT(".$data['tgl_item'].",'%m-%Y') as tgl_bln,DATE_FORMAT(".$data['tgl_item'].",'%Y') as tgl_thn,".$data['tgl_item']." as ".$data['tgl_item'].",MONTH(".$data['tgl_item'].") as js_bln,YEAR(".$data['tgl_item'].") as js_thn,DATE_FORMAT(".$data['tgl_item'].",'%d') as js_hr,concat(".$data['nama_kat_lv2'].",' - ',".$data['nama_kat_lv1'].") as ".$data['nama_kat_lv2'].",".$data['coun_kat_lv1'].",".$data['coun_kat_lv2']."
      ");
    $data['kndsbln'] = array($data['tgl_item'].' >='=>$lp["tgl_awal"],$data['tgl_item'].' <='=>$lp["tgl_akhir"],$data['ins']=>$data['idinst']);
    $data['ambil_bulan'] = $this->m_external->ambil_isi($data['iddet'],$data['tabel_item'],$data['select_all'],$data['kndsbln'],$data['period']);
      //=====================================
    if($lp["periode_laporan_detil"] == 1){ // HARIAN
  $data['kondisi1'] = array(''.$data['tgl_item'].' >='=>$lp["tgl_awal"],''.$data['tgl_item'].' <='=>$lp["tgl_akhir"],$data['ins']=>$data['idinst'],''.$data['jml_item'].' >'=>0);
    $data['grupgrafikgaris'] = $data['tgl_item'];
    $data['viewgraphic'] ='tgl_hr';
    }
    if($lp["periode_laporan_detil"] == 2){ // BULANAN
  $data['kondisi1'] = array(''.$data['tgl_item'].' >='=>$lp["tgl_awal"],''.$data['tgl_item'].' <='=>$lp["tgl_akhir"],$data['ins']=>$data['idinst'],''.$data['jml_item'].' >'=>0);
    $data['grupgrafikgaris'] = 'MONTH('.$data['tgl_item'].')';
    $data['viewgraphic'] ='tgl_bln';
    }
    if($lp["periode_laporan_detil"] == 3){ // TAHUNAN
  $data['kondisi1'] = array($data['ins']=>$data['idinst'],''.$data['jml_item'].' >'=>0);
  $data['grupgrafikgaris'] = 'YEAR('.$data['tgl_item'].')';
  $data['viewgraphic'] ='tgl_thn';
    }
  //=====================================
  $data['ambil_data_min'] = $this->m_external->get_min($data['iddet'],$data['tabel_item'],$data['jml_item'],$data['kndsbln']);
  $data['ambil_data_max'] = $this->m_external->get_max($data['iddet'],$data['tabel_item'],$data['jml_item'],$data['kndsbln']);
  //=====================================
  $data['grafik5'] = $this->m_external->ambil_isi($data['iddet'],$data['tabel_item'],$data['selectgrafik5'],$data['kondisi1'],$data['grupgrafikgaris']);
  $data['grafikpie'] = $this->m_external->ambil_isi($data['iddet'],$data['tabel_item'],$data['select_pie'],$data['kondisi1'],$data['Kat_lv2']);
  $data['grafikbtg'] = $this->m_external->ambil_isi($data['iddet'],$data['tabel_item'],$data['select_semua'],$data['kondisi1'],$data['Kat_lv1']);
  $data['legendgrafik5'] = $this->m_external->ambil_isi($data['iddet'],$data['tabel_item'],$data['select_all'],$data['kondisi1'],$data['Kat_lv2']);
  //=====================================
    if($mode=='view'){
      $this->tampil($data);
    }
  }
  function forward($mode='view')
  {
    $data['page']  = "forward";
    $data['member_name'] = 'WELCOME USER';
    $data['level_name'] = 'SURVEYOR';
    $data['link_awal'] = base_url('external/laporan');
    $instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
    $data['header'] = $instansi["nama_instansi"];
    $data['title'] = "LAPORAN";
    $data['instance_status'] = $instansi["status_instansi"];
    $data['instance_id'] = $instansi["id_instansi"];
    $data['instance_name'] = $instansi["nama_instansi"];
    $data['idescription'] = $instansi["description"];
    $data['ikeywords'] = $instansi["keywords"];
    $data['iheader'] = $instansi["header"];
    $data['iheader_mini'] = $instansi["header_mini"];
    $data['ifooter'] = $instansi["footer"];
    $data['ilicensed'] = $instansi["licensed"];
    $data['iconik'] = $instansi["icon"];
    $data['surveyor'] = '1';
    $data['member_name'] = 'WELCOME USER';
    $data['level_name'] = 'SURVEYOR';
    $data['photo'] = base_url().'assets/images/noavatar.jpg';
    $data['idlap'] = $this->uri->segment(4, 0);
    $data['idtab'] = $this->uri->segment(5, 0);
  //======================= IMPORTANT ======================================
    $lp = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($data['idtab']); // id_laporan_tabel
    $worke = $this->m_umum->ambil_data('ol_unit','id_unit',$lp['id_unit']);
    $peg = $this->m_umum->ambil_data('ol_pegawai','barcode_pegawai',$lp['barcode_pegawai']);
    $kondisi_cek = array('id_laporan_tabel'=>$data['idtab'],'barcode_pegawai'=>$this->session->barcode_pegawai);
    $data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('ol_logbook_laporan_tabel',$kondisi_cek,'ol_logbook_laporan','id_laporan');

    $data['nama_unit']  = set_value('nama_unit',$worke["nama_unit"]);
    $data['id_laporan']  = set_value('id_laporan',$lp["id_laporan"]);
    $data['header_laporan']  = set_value('header_laporan',$lp["header_laporan"]);
    $data['judul_laporan']  = set_value('judul_laporan',$lp["judul_laporan"]);
    $data['urutan_laporan_tabel']  = set_value('urutan_laporan_tabel',$lp["urutan_laporan_tabel"]);
    $data['id_laporan_tabel']  = set_value('id_laporan_tabel',$lp["id_laporan_tabel"]);
    $data['id_instansi']  = set_value('id_instansi',$lp["id_instansi"]);
    $data['id_pegawai']  = set_value('id_pegawai',$lp["id_pegawai"]);
    $data['judul_laporan_tabel']  = set_value('judul_laporan_tabel',$lp["judul_laporan_tabel"]);
    $data['analisa_laporan_tabel']  = set_value('analisa_laporan_tabel',$lp["analisa_laporan_tabel"]);
    $data['rekomendasi_laporan_tabel']  = set_value('rekomendasi_laporan_tabel',$lp["rekomendasi_laporan_tabel"]);
    $data['barcode_pegawai']  = set_value('barcode_pegawai',$lp["barcode_pegawai"]);
    $data['idpeg']  = set_value('idpeg',$lp["id_pegawai"]);
    $data['share_it']  = set_value('share_it',$lp["share_it"]);
    $data['tgl_awal']  = set_value('tgl_awal',date('d-m-Y', strtotime($lp["tgl_awal"])));
    $data['tgl_akhir']  = set_value('tgl_akhir',date('d-m-Y', strtotime($lp["tgl_akhir"])));
    $data['tabel']  = set_value('tabel',$lp["tabel"]);
    $data['lhu']  = set_value('lhu',$lp["lhu"]);
    $data['qc_self']  = set_value('qc_self',$lp["qc_self"]);
    $data['isi_kompetensi']  = set_value('isi_kompetensi',$lp["isi_kompetensi"]);
    $data['kompetensi']  = set_value('kompetensi',$lp["kompetensi"]);
    $data['kewenangan']  = set_value('kewenangan',$lp["kewenangan"]);
    $data['show_pdf']  = set_value('show_pdf',$lp["show_pdf"]);
    $data['berkas']  = set_value('berkas',$lp["berkas"]);
    $data['header_laporan']  = set_value('header_laporan',$lp["header_laporan"]);
    $data['sub_header_laporan']  = set_value('sub_header_laporan',$lp["sub_header_laporan"]);
    $data['sub_sub_header_laporan']  = set_value('sub_sub_header_laporan',$lp["sub_sub_header_laporan"]);
    $data['judul_laporan']  = set_value('judul_laporan',$lp["judul_laporan"]);    
    $data['tujuan_laporan']  = set_value('tujuan_laporan',$lp["tujuan_laporan"]);     
    $data['periode_laporan']  = set_value('periode_laporan',$lp["periode_laporan"]);      
    $data['sumber_laporan']  = set_value('sumber_laporan',$lp["sumber_laporan"]);   
    $data['judul_laporan_tabel']  = set_value('judul_laporan_tabel',$lp["judul_laporan_tabel"]);    
    $data['analisa_laporan_tabel']  = set_value('analisa_laporan_tabel',$lp["analisa_laporan_tabel"]);    
    $data['rekomendasi_laporan_tabel']  = set_value('rekomendasi_laporan_tabel',$lp["rekomendasi_laporan_tabel"]);
    $data['sub']  = set_value('sub',$lp["sub"]);
    $data['ambil_tabel'] = $this->m_external->ambil_logbook_laporan_tabel($data['idlap']);
    $peg = $this->m_umum->ambil_data('ol_pegawai','barcode_pegawai',$lp['barcode_pegawai']);
    $data['aran_pegawai'] = $peg['nama_pegawai'];
    if($lp["min_laporan_tabel"]){
      $data['min_laporan_tabel'] = $lp["min_laporan_tabel"];
    }else{
      $data['min_laporan_tabel'] = '0';
    }
    if($lp["max_laporan_tabel"]){
      $data['max_laporan_tabel'] = $lp["max_laporan_tabel"];
    }else{
      $data['max_laporan_tabel'] = '0';
    }
    $data['js_thn'] = 'js_thn';
    $data['js_bln'] = 'js_bln';
    $data['js_hr'] = 'js_hr';
    $data['tgl_bln'] = 'tgl_bln';
    $data['tgl_hr'] = 'tgl_hr';
    $data['tgl_thn'] = 'tgl_thn';
    //===================================================== KET ======================
    $data['nama_pegawai'] = 'nama_pegawai';
    $data['ket_seting'] = 'seting';
    $data['ket_isi'] = 'isi';
    //===================================================== LHU ======================
    if($lp["lhu"] == 1){
      $data['text'] = 'SUMBER DATA : KOMPETENSI / KEWENANGAN';
      if($lp["kewenangan"] == 1){
        $data['grup_item'] = 'ol_logbook.id_kewenangan';
        $data['id_item'] = 'id_kewenangan';
        $data['coun_item'] = 'id_kewenangan';
        $data['nama_item'] = 'nama_kewenangan';
        $data['order'] = 'nkr_kewenangan.id_kompetensi';
        $data['tbllegend'] = 'nkr_kewenangan';
      }else{
        $data['grup_item'] = 'nkr_kewenangan.id_kompetensi';
        $data['id_item'] = 'id_kompetensi';
        $data['coun_item'] = 'id_kompetensi';
        $data['nama_item'] = 'nama_kompetensi';
        $data['order'] = 'nkr_kewenangan.id_kompetensi';
        $data['tbllegend'] = 'nkr_kompetensi';
      }
      $data['ins_item'] = 'id_kompetensi';
      $data['kat_item'] = 'nkr_kewenangan.id_kompetensi';
      $data['nama_kat'] = 'nama_kompetensi';
      $data['tabel_item'] = 'ol_logbook';
      $data['tgl_item'] = 'tgl_logbook';
      $data['jml_item'] = 'jml_logbook';
      $data['sume'] = 'jml_logbook';
      $data['sumeas'] = 'jml_logbook';
      $data['id_peg'] = 'id_logbooker';
      $data['pegawai'] = $lp['id_pegawai'];
      $data['ins'] = 'id_instansi';
      $data['idinst'] = $lp["id_instansi"];
      $data['nama_item1'] = 'nama_kompetensi';
      $data['nama_item2'] = 'nama_kewenangan';
      //=======================
      $data['tabel_seting'] = 'nkr_kewenangan';
      $data['nama_seting'] = 'id_kewenangan';
      $data['tabel_isi'] = 'ol_logbook';
      $data['nama_isi'] = 'id_logbook';
    }
    if($lp["lhu"] == 4){
      $data['text'] = 'SUMBER DATA : QUALITY CONTROL / INDIKATOR MUTU';
      $data['tabel_item'] = 'ol_logbook_lhu_detil';
      $data['grup_item'] = 'ol_logbook_lhu_detil.id_item_lhu';
      $data['ins_item'] = 'id_equipment';
      $data['kat_item'] = 'ol_logbook_item_lhu.id_equipment';
      $data['nama_kat'] = 'nama_equipment';
      $data['nama_item1'] = 'nama_item_lhu';
      $data['nama_item2'] = 'nama_equipment';
      $data['id_item'] = 'id_item_lhu';
      $data['nama_item'] = 'nama_item_lhu';
      $data['order'] = 'ol_logbook_lhu_detil.id_item_lhu';
      $data['tgl_item'] = 'tgl_lhu';
      $data['jml_item'] = 'hasil_lhu_detil';
      $data['sume'] = 'hasil_lhu_detil';
      $data['sumeas'] = 'hasil_lhu_detil';
      $data['id_peg'] = 'ol_logbook_lhu.barcode_pegawai';
      $data['pegawai'] = $lp['barcode_pegawai'];
      $data['ins'] = 'id_instansi';
      $data['idinst'] = $lp["id_instansi"];
      //=======================
      $data['tabel_seting'] = 'ol_logbook_lhu_detil';
      $data['nama_seting'] = 'id_lhu_detil';
      $data['ket_seting'] = 'seting';
      $data['tabel_isi'] = 'ol_logbook_item_lhu';
      $data['nama_isi'] = 'id_item_lhu';
      $data['ket_isi'] = 'isi';   
    }
    if($lp["lhu"] == 5){
      $data['text'] = 'SUMBER DATA : PENDAFTARAN PASIEN';
      $data['tabel_item'] = 'tindakan_daftar';
      $data['grup_item'] = 'tindakan_daftar.id_tindakan';
      $data['ins_item'] = 'id_golongan_pemeriksaan';
      $data['kat_item'] = 'tindakan.id_golongan_pemeriksaan';
      $data['nama_kat'] = 'nama_golongan_pemeriksaan';
      $data['nama_item1'] = 'nama_tindakan';
      $data['nama_item2'] = 'nama_golongan_pemeriksaan';
      $data['id_item'] = 'id_tindakan';
      $data['coun_item'] = 'coun_tindakan_daftar';
      $data['nama_item'] = 'nama_tindakan';
      $data['order'] = 'tindakan_daftar.id_tindakan';
      $data['tgl_item'] = 'tgl_daftar';
      $data['sume'] = 'tindakan_daftar.id_tindakan';
      $data['sumeas'] = 'jml_tindakan';
      $data['jml_item'] = 'jml_tindakan';
      $data['id_peg'] = 'tindakan_daftar.pendaftar';
      $data['pegawai'] = $lp['id_pegawai'];
      $data['ins'] = 'unit_tindakan';
      $data['idinst'] = $lp["id_unit"];
          //=======================
      $data['tabel_seting'] = 'tindakan';
      $data['nama_seting'] = 'id_tindakan';
      $data['ket_seting'] = 'seting';
      $data['tabel_isi'] = 'tindakan_daftar';
      $data['nama_isi'] = 'id_daftar';
      $data['ket_isi'] = 'isi';  
    }
    if($lp["lhu"] == 7){
      $data['text'] = 'SUMBER DATA : BERKAS';
      $data['tabel_item'] = 'ol_berkas';
      $data['grup_item'] = 'ol_berkas.id_kategori_berkas';
      $data['ins_item'] = 'id_kategori_berkas';
      $data['kat_item'] = 'ol_berkas.id_kategori_berkas';
      $data['nama_kat'] = 'nama_berkas_kategori';
      $data['nama_item1'] = 'nama_berkas_kategori';
      $data['nama_item2'] = 'nama_berkas_kategori';
      $data['id_item'] = 'id_berkas';
      $data['coun_item'] = 'id_berkas';
      $data['nama_item'] = 'nama_berkas';
      $data['order'] = 'ol_berkas.tgl_b_berkas';
      $data['tgl_item'] = 'tgl_b_berkas';
      $data['sume'] = 'ol_berkas.kredit';
      $data['sumeas'] = 'coun_berkas';
      $data['jml_item'] = 'coun_berkas';
      $data['id_peg'] = 'ol_berkas.id_pegawai';
      $data['pegawai'] = $lp['id_pegawai'];
      $data['ins'] = 'ol_berkas.id_pegawai';
      $data['idinst'] = $lp["id_pegawai"];
      $data['nama_berkas'] = 'nama_berkas';
      $data['penyelenggara'] = 'penyelenggara';
      $data['kredit'] = 'kredit';
      //=======================
      $data['tabel_seting'] = 'ol_berkas_kategori';
      $data['nama_seting'] = 'id_berkas_kategori';
      $data['ket_seting'] = 'seting';
      $data['tabel_isi'] = 'ol_berkas';
      $data['nama_isi'] = 'id_berkas';
      $data['ket_isi'] = 'isi'; 
    }
    if($lp["lhu"] == 8){
      $data['text'] = 'SUMBER DATA : EVEN DENGAN ABSENSI LOKASI';
      $data['tabel_item'] = 'abs_even';
      $data['grup_item'] = 'tgl_even';
      $data['ins_item'] = 'tgl_even';
      $data['kat_item'] = 'tgl_even';
      $data['nama_kat'] = 'nama_even';
      $data['nama_item1'] = 'nama_even';
      $data['nama_item2'] = 'alamat_even';
      $data['id_item'] = 'id_even';
      $data['coun_item'] = 'coun_even';
      $data['nama_item'] = 'nama_even';
      $data['order'] = 'tgl_even';
      $data['tgl_item'] = 'tgl_even';
      $data['sume'] = 'id_even';
      $data['sumeas'] = 'coun_even';
      $data['jml_item'] = 'coun_even';
      $data['id_peg'] = 'abs_even.barcode_pegawai';
      $data['pegawai'] = $lp['barcode_pegawai'];
      $data['ins'] = 'unit';
      $data['idinst'] = $lp["id_unit"];
      //=======================
      $data['tabel_seting'] = 'abs_even';
      $data['nama_seting'] = 'id_even';
      $data['ket_seting'] = 'seting';
      $data['tabel_isi'] = 'abs_even';
      $data['nama_isi'] = 'id_even';
      $data['ket_isi'] = 'isi'; 
    }
    //===================================================== ARRAY ======================
    $kondisi_seting = array('id_laporan_tabel'=>$data['idtab'],'nama_source'=>$data['nama_seting'],'tabel_source'=>$data['tabel_seting'],'ket_source'=>$data['ket_seting'],'status_laporan_tabel_detil'=>1,'pembuat_source'=>$this->session->barcode_pegawai);
    $kondisi_isi = array('id_laporan_tabel'=>$data['idtab'],'nama_source'=>$data['nama_isi'],'tabel_source'=>$data['tabel_isi'],'ket_source'=>$data['ket_isi'],'status_laporan_tabel_detil'=>1,'pembuat_source'=>$this->session->barcode_pegawai);

    $data['jml_isi'] = $this->m_umum->jumlah_record_filter('ol_logbook_laporan_tabel_detil',$kondisi_isi);
    $data['jml_seting'] = $this->m_umum->jumlah_record_filter('ol_logbook_laporan_tabel_detil',$kondisi_seting);
    $data['arr_seting'] = $this->m_umum->ambil_data_kondisi_result('ol_logbook_laporan_tabel_detil',$kondisi_seting);
    $data['arr_isi'] = $this->m_umum->ambil_data_kondisi_result('ol_logbook_laporan_tabel_detil',$kondisi_isi);
  //=====================================
    $data['select_all'] = ("*");
    $data['selectgrup'] = ("sum(".$data['sume'].") as ".$data['sumeas'].",".$data['nama_item1'].",".$data['nama_item2'].",".$data['nama_item']."");
    $data['kondisi1'] = array(''.$data['tgl_item'].' >='=>$lp["tgl_awal"],''.$data['tgl_item'].' <='=>$lp["tgl_akhir"],$data['id_peg']=>$data['pegawai'],$data['ins']=>$data['idinst'],''.$data['jml_item'].' >'=>0);
    if($lp["lhu"] == 4 && $lp["qc_self"] == 0){
      $data['kondisi1'] = array(''.$data['tgl_item'].' >='=>$lp["tgl_awal"],''.$data['tgl_item'].' <='=>$lp["tgl_akhir"],$data['ins']=>$data['idinst'],''.$data['jml_item'].' >'=>0);
    }

    $data['ambil_lhu'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select_all'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']);
    
    $data['grup_lhu'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrup'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],$data['grup_item']);
    
    $data['ambil_bulan'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select_all'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],'MONTH('.$data['tgl_item'].')');
        //============================================================================= BERKAS
      if($lp["lhu"] == 7){
        $data['kondisi_berkas'] = array('id_kategori_berkas >'=>13,'link_berkas !='=>'','status_berkas'=>1,$data['ins']=>$data['idinst']);
        $data['kondisi_imut'] = array('id_kategori_berkas'=>12,'link_berkas !='=>'','status_berkas'=>1,$data['ins']=>$data['idinst']);
        $data['kondisi_ijasah'] = array('id_kategori_berkas'=>7,'link_berkas !='=>'','status_berkas'=>1,$data['ins']=>$data['idinst']);
        $data['kondisi_pelatihan'] = array('kunci'=>1,'link_berkas !='=>'','status_berkas'=>1,$data['ins']=>$data['idinst']);
        $data['kondisi_str'] = array('kunci'=>0,'link_berkas !='=>'','status_berkas'=>1,$data['ins']=>$data['idinst']);
        $data['jml_berkas'] = $this->m_ol_laporan->jumlah_sumber_data($data['idtab'],$data['tabel_item'],$data['kondisi_berkas'],$lp["lhu"],$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']);
        $data['jml_imut'] = $this->m_ol_laporan->jumlah_sumber_data($data['idtab'],$data['tabel_item'],$data['kondisi_imut'],$lp["lhu"],$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']);
        $data['jml_ijasah'] = $this->m_ol_laporan->jumlah_sumber_data($data['idtab'],$data['tabel_item'],$data['kondisi_ijasah'],$lp["lhu"],$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']);
        $data['jml_pelatihan'] = $this->m_ol_laporan->jumlah_sumber_data($data['idtab'],$data['tabel_item'],$data['kondisi_pelatihan'],$lp["lhu"],$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']);
        $data['jml_str'] = $this->m_ol_laporan->jumlah_sumber_data($data['idtab'],$data['tabel_item'],$data['kondisi_str'],$lp["lhu"],$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']);
        $data['ambil_berkas'] = $this->m_ol_laporan->set_isi_sumber_data($data['idtab'],$data['tabel_item'],$data['select_all'],$data['kondisi_berkas'],$lp["lhu"],$data['order'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']);
        $data['ambil_imut'] = $this->m_ol_laporan->set_isi_sumber_data($data['idtab'],$data['tabel_item'],$data['select_all'],$data['kondisi_imut'],$lp["lhu"],$data['order'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']);
        $data['ambil_ijasah'] = $this->m_ol_laporan->set_isi_sumber_data($data['idtab'],$data['tabel_item'],$data['select_all'],$data['kondisi_ijasah'],$lp["lhu"],$data['order'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']);
        $data['ambil_pelatihan'] = $this->m_ol_laporan->set_isi_sumber_data($data['idtab'],$data['tabel_item'],$data['select_all'],$data['kondisi_pelatihan'],$lp["lhu"],$data['order'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']);
        $data['ambil_str'] = $this->m_ol_laporan->set_isi_sumber_data($data['idtab'],$data['tabel_item'],$data['select_all'],$data['kondisi_str'],$lp["lhu"],$data['order'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']);
      }
  //===========================================================================
  $data['chk_seting']=$this->m_ol_laporan->set_sumber_data($data['tabel_item'],$data['select_all'],$data['kondisi1'],$lp["lhu"],$data['grup_item']);
  $data['chk_isi'] = $this->m_ol_laporan->set_isi_sumber_data($data['idtab'],$data['tabel_item'],$data['select_all'],$data['kondisi1'],$lp["lhu"],$data['grup_item'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']);
  //=========================================================================== 
  $data['selectgrafik5'] = ("sum(".$data['jml_item'].") as ".$data['jml_item'].",".$data['grup_item']." as ".$data['id_item'].",DATE_FORMAT(".$data['tgl_item'].",'%d-%m-%Y') as ".$data['tgl_hr'].",DATE_FORMAT(".$data['tgl_item'].",'%m-%Y') as ".$data['tgl_bln'].",DATE_FORMAT(".$data['tgl_item'].",'%Y') as ".$data['tgl_thn'].",".$data['tgl_item']." as ".$data['tgl_item'].",MONTH(".$data['tgl_item'].") as ".$data['js_bln'].",YEAR(".$data['tgl_item'].") as ".$data['js_thn'].",DATE_FORMAT(".$data['tgl_item'].",'%d') as ".$data['js_hr'].",concat(".$data['nama_item1'].",' - ',".$data['nama_item2'].") as ".$data['nama_item']."  ");

  $data['selectgrafikhr'] = (" ".$data['grup_item']." as ".$data['id_item'].",DATE_FORMAT(".$data['tgl_item'].",'%d-%m-%Y') as ".$data['tgl_hr'].",DATE_FORMAT(".$data['tgl_item'].",'%m-%Y') as ".$data['tgl_bln'].",DATE_FORMAT(".$data['tgl_item'].",'%Y') as ".$data['tgl_thn'].",".$data['tgl_item']." as ".$data['tgl_item'].",MONTH(".$data['tgl_item'].") as ".$data['js_bln'].",YEAR(".$data['tgl_item'].") as ".$data['js_thn'].",DATE_FORMAT(".$data['tgl_item'].",'%d') as ".$data['js_hr'].",  ");

  $data['grafik5'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafik5'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],'MONTH('.$data['tgl_item'].')');

  $data['grafikhr'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafikhr'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],$data['tgl_item']);

  $data['legendgrafik5'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select_all'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],$data['grup_item']);

  $data['ambil_data_min'] = $this->m_ol_laporan->get_min($data['idtab'],$data['tabel_item'],$data['jml_item'],$data['kondisi1'],$lp["lhu"],$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']);
  $data['ambil_data_max'] = $this->m_ol_laporan->get_max($data['idtab'],$data['tabel_item'],$data['jml_item'],$data['kondisi1'],$lp["lhu"],$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting']);

  $data['grafikpie'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafik5'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['jml_isi'],$data['arr_isi'],$data['jml_seting'],$data['arr_seting'],$data['id_item']);
    //==================================
    if($mode=='view'){
      $this->tampil($data);
    }
  }
	function laporan($mode='view')
	{
	$data['page']  = "laporan";
	$data['member_name'] = 'WELCOME USER';
	$data['level_name'] = 'SURVEYOR';
	$data['link_awal'] = base_url('external/laporan');
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
	$data['header'] = $instansi["nama_instansi"];
	$data['title'] = "LAPORAN";
	$data['instance_status'] = $instansi["status_instansi"];
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
	$data['iconik'] = $instansi["icon"];
	$data['surveyor'] = '1';
	$data['member_name'] = 'WELCOME USER';
	$data['level_name'] = 'SURVEYOR';
	$data['photo'] = base_url().'assets/images/noavatar.jpg';
	$data['idlap'] = $this->uri->segment(4, 0);
	$data['idtab'] = $this->uri->segment(5, 0);
	//======================= IMPORTANT ======================================
	$lp = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($data['idtab']); // id_laporan_tabel
	$worke = $this->m_umum->ambil_data('ol_unit','id_unit',$lp['id_unit']);
	$peg = $this->m_umum->ambil_data('ol_pegawai','barcode_pegawai',$lp['barcode_pegawai']);
	$data['aran_pegawai'] = $peg['nama_pegawai'];
  	$kondisi_cek = array('id_laporan_tabel'=>$data['idtab'],'barcode_pegawai'=>$this->session->barcode_pegawai);
	$data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('ol_logbook_laporan_tabel',$kondisi_cek,'ol_logbook_laporan','id_laporan');	
  if($data['cek'] == 0){
    redirect(base_url('external'));
  }
  $data['ambil_tabel'] = $this->m_external->ambil_logbook_laporan_tabel($data['idlap']);
	$data['nama_unit']  = set_value('nama_unit',$worke["nama_unit"]);
	$data['id_laporan']  = set_value('id_laporan',$lp["id_laporan"]);
	$data['urutan_laporan_tabel']  = set_value('urutan_laporan_tabel',$lp["urutan_laporan_tabel"]);
	$data['id_laporan_tabel']  = set_value('id_laporan_tabel',$lp["id_laporan_tabel"]);
	$data['id_working']  = set_value('id_working',$lp["id_working"]);
	$data['id_instansi']  = set_value('id_instansi',$lp["id_instansi"]);
	$data['id_pegawai']  = set_value('id_pegawai',$lp["id_pegawai"]);
	$data['barcode_pegawai']  = set_value('barcode_pegawai',$lp["barcode_pegawai"]);
	$data['idpeg']  = set_value('idpeg',$lp["id_pegawai"]);
	$data['share_it']  = set_value('share_it',$lp["share_it"]);
	$data['tgl_laporan']  = set_value('tgl_laporan',date('d-m-Y', strtotime($lp["tgl_laporan"])));
	$data['tgl_awal']  = set_value('tgl_awal',date('d-m-Y', strtotime($lp["tgl_awal"])));
	$data['tgl_akhir']  = set_value('tgl_akhir',date('d-m-Y', strtotime($lp["tgl_akhir"])));
	$data['tabel']  = set_value('tabel',$lp["tabel"]);
	$data['lhu']  = set_value('lhu',$lp["lhu"]);
	$data['qc_self']  = set_value('qc_self',$lp["qc_self"]);
	$data['isi_kompetensi']  = set_value('isi_kompetensi',$lp["isi_kompetensi"]);
	$data['kompetensi']  = set_value('kompetensi',$lp["kompetensi"]);
	$data['kewenangan']  = set_value('kewenangan',$lp["kewenangan"]);
	$data['sub']  = set_value('sub',$lp["sub"]);
	$data['show_pdf']  = set_value('show_pdf',$lp["show_pdf"]);
	$data['berkas']  = set_value('berkas',$lp["berkas"]);
	$data['header_laporan']  = set_value('header_laporan',$lp["header_laporan"]);
	$data['sub_header_laporan']  = set_value('sub_header_laporan',$lp["sub_header_laporan"]);
	$data['sub_sub_header_laporan']  = set_value('sub_sub_header_laporan',$lp["sub_sub_header_laporan"]);
	$data['judul_laporan']  = set_value('judul_laporan',$lp["judul_laporan"]);		
	$data['tujuan_laporan']  = set_value('tujuan_laporan',$lp["tujuan_laporan"]);			
	$data['periode_laporan']  = set_value('periode_laporan',$lp["periode_laporan"]);			
	$data['sumber_laporan']  = set_value('sumber_laporan',$lp["sumber_laporan"]);		
	$data['judul_laporan_tabel']  = set_value('judul_laporan_tabel',$lp["judul_laporan_tabel"]);		
	$data['analisa_laporan_tabel']  = set_value('analisa_laporan_tabel',$lp["analisa_laporan_tabel"]);		
	$data['rekomendasi_laporan_tabel']  = set_value('rekomendasi_laporan_tabel',$lp["rekomendasi_laporan_tabel"]);
    	if($lp["min_laporan_tabel"]){
    		$data['min_laporan_tabel'] = $lp["min_laporan_tabel"];
    	}else{
    		$data['min_laporan_tabel'] = '0';
    	}
    	if($lp["max_laporan_tabel"]){
    		$data['max_laporan_tabel'] = $lp["max_laporan_tabel"];
    	}else{
    		$data['max_laporan_tabel'] = '0';
    	}
	//=========================================================================== LHU 1
	//'1'=>'Kompetensi','4'=>'QC / IM','5'=>'Pendaftaran Pasien','6'=>'Time Respon','7'=>'Berkas','8'=>'Even'
	/*
		1  ;Tabel Detail                ;1;1
		14 ;Tabel Logbook Total         ;1;2
		9  ;Grafik Garis                ;1;3
		5  ;Grafik Garis Combine        ;1;4
		8  ;Grafik Garis separate       ;1;5
		7  ;Grafik Garis Range Combine  ;1;6
		6  ;Grafik Garis Range separate ;1;7
		3  ;Grafik Pie                  ;1;8
		10 ;Grafik Batang               ;1;11
		11 ;Grafik Batang Persentase    ;1;12
		12 ;Grafik Batang Lokasi        ;0;13
		13 ;Grafik Batang Kelola Limbah ;0;14
		15 ;Tabel Berkas                ;0;16
		2  ;Grafik Pie Single %         ;0;17
		4  ;Grafik Garis Combine + Total;0;18
	*/
	//============================================================================= lhu 1
      if($lp["lhu"] == 1){
        $data['tabel_item'] = 'ol_logbook';
        if($lp["kewenangan"] == 1){
          $data['grup_item'] = 'ol_logbook.id_kewenangan';
          $data['id_item'] = 'id_kewenangan';
          $data['coun_item'] = 'id_kewenangan';
          $data['nama_item'] = 'nama_kewenangan';
          $data['order'] = 'nkr_kewenangan.id_kompetensi';
          $data['tbllegend'] = 'nkr_kewenangan';
        }else{
          $data['grup_item'] = 'nkr_kewenangan.id_kompetensi';
          $data['id_item'] = 'id_kompetensi';
          $data['coun_item'] = 'id_kompetensi';
          $data['nama_item'] = 'nama_kompetensi';
          $data['order'] = 'nkr_kewenangan.id_kompetensi';
          $data['tbllegend'] = 'nkr_kompetensi';
        }
        $data['text'] = 'SUMBER DATA : KOMPETENSI / KEWENANGAN';
        $data['ins_item'] = 'id_kompetensi';
        $data['kat_item'] = 'nkr_kewenangan.id_kompetensi';
        $data['nama_kat'] = 'nama_kompetensi';
        $data['tgl_item'] = 'tgl_logbook';
        $data['jml_item'] = 'jml_logbook';
        $data['sume'] = 'jml_logbook';
        $data['sumeas'] = 'jml_logbook';
        $data['id_peg'] = 'id_logbooker';
        $data['nama_item1'] = 'nama_kompetensi';
        $data['nama_item2'] = 'nama_kewenangan';
        $data['pegawai'] = $lp['id_pegawai'];
        $data['ins'] = 'id_instansi';
        $data['idinst'] = $lp["id_instansi"];
        $data['select1'] = ("*");
        $data['selectgrup'] = ("sum(".$data['sume'].") as ".$data['sumeas'].",nama_kewenangan,nama_kompetensi");
        $data['kondisi1'] = array('tgl_logbook >='=>$lp["tgl_awal"],'tgl_logbook <='=>$lp["tgl_akhir"],$data['id_peg']=>$data['pegawai'],$data['ins']=>$lp["id_instansi"],'jml_logbook >'=>0);
        $data['ambil_lhu'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc');
        $data['grup_lhu'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrup'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc',$data['grup_item']);
        $data['ambil_bulan'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc','MONTH('.$data['tgl_item'].')');
        //============================================================================= GRAFIK
        $data['js_thn'] = 'js_thn';
        $data['js_bln'] = 'js_bln';
        $data['js_hr'] = 'js_hr';
        $data['tgl_bln'] = 'tgl_bln';
        $data['tgl_hr'] = 'tgl_hr';
        $data['tgl_thn'] = 'tgl_thn';
        $data['selectgrafik5'] = ("sum(".$data['jml_item'].") as ".$data['jml_item'].",".$data['grup_item']." as ".$data['id_item'].",DATE_FORMAT(".$data['tgl_item'].",'%d-%m-%Y') as ".$data['tgl_hr'].",DATE_FORMAT(".$data['tgl_item'].",'%m-%Y') as ".$data['tgl_bln'].",DATE_FORMAT(".$data['tgl_item'].",'%Y') as ".$data['tgl_thn'].",".$data['tgl_item']." as ".$data['tgl_item'].",MONTH(".$data['tgl_item'].") as ".$data['js_bln'].",YEAR(".$data['tgl_item'].") as ".$data['js_thn'].",DATE_FORMAT(".$data['tgl_item'].",'%d') as ".$data['js_hr'].",concat(".$data['nama_item1'].",' - ',".$data['nama_item2'].") as ".$data['nama_item']."  ");
        $data['selectgrafikhr'] = (" ".$data['grup_item']." as ".$data['id_item'].",DATE_FORMAT(".$data['tgl_item'].",'%d-%m-%Y') as ".$data['tgl_hr'].",DATE_FORMAT(".$data['tgl_item'].",'%m-%Y') as ".$data['tgl_bln'].",DATE_FORMAT(".$data['tgl_item'].",'%Y') as ".$data['tgl_thn'].",".$data['tgl_item']." as ".$data['tgl_item'].",MONTH(".$data['tgl_item'].") as ".$data['js_bln'].",YEAR(".$data['tgl_item'].") as ".$data['js_thn'].",DATE_FORMAT(".$data['tgl_item'].",'%d') as ".$data['js_hr'].",  ");
        $data['grafik5'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafik5'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc','MONTH('.$data['tgl_item'].')');
        $data['grafikhr'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafikhr'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['tgl_item']);
        $data['legendgrafik5'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['grup_item']);
        $data['ambil_data_min'] = $this->m_ol_laporan->get_min($data['idtab'],$data['tabel_item'],$data['jml_item'],$data['kondisi1'],$lp["lhu"]);
        $data['ambil_data_max'] = $this->m_ol_laporan->get_max($data['idtab'],$data['tabel_item'],$data['jml_item'],$data['kondisi1'],$lp["lhu"]);
        $data['grafikpie'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafik5'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['id_item']);
      }
      //============================================================================= lhu 4
      if($lp["lhu"] == 4){
        $data['text'] = 'SUMBER DATA : QUALITY CONTROL / INDIKATOR MUTU';
        $data['tabel_item'] = 'ol_logbook_lhu_detil';
        $data['ins_item'] = 'id_equipment';
        $data['grup_item'] = 'ol_logbook_lhu_detil.id_item_lhu';
        $data['kat_item'] = 'ol_logbook_item_lhu.id_equipment';
        $data['nama_kat'] = 'nama_equipment';
        $data['nama_item1'] = 'nama_item_lhu';
        $data['nama_item2'] = 'nama_equipment';
        $data['id_item'] = 'id_item_lhu';
        $data['coun_item'] = 'coun_lhu_detil';
        $data['nama_item'] = 'nama_item_lhu';
        $data['order'] = 'ol_logbook_lhu_detil.id_item_lhu';
        $data['tgl_item'] = 'tgl_lhu';
        $data['jml_item'] = 'hasil_lhu_detil';
        $data['sume'] = 'hasil_lhu_detil';
        $data['sumeas'] = 'hasil_lhu_detil';
        $data['id_peg'] = 'ol_logbook_lhu.barcode_pegawai';
        $data['pegawai'] = $lp['barcode_pegawai'];
        $data['ins'] = 'id_instansi';
        $data['idinst'] = $lp["id_instansi"];
        $data['select1'] = ("*");
        $data['selectgrup'] = ("sum(".$data['sume'].") as ".$data['sumeas'].",nama_equipment,nama_item_lhu");
        if($lp["qc_self"] == 1){
          $data['kondisi1'] = array('tgl_lhu >='=>$lp["tgl_awal"],'tgl_lhu <='=>$lp["tgl_akhir"],$data['id_peg']=>$data['pegawai'],$data['ins']=>$data['idinst']);
        }else{
        //  $data['kondisi1'] = array('tgl_lhu >='=>$lp["tgl_awal"],'tgl_lhu <='=>$lp["tgl_akhir"],'ol_equipment.id_unit'=>$this->session->unit);
          $data['kondisi1'] = array('tgl_lhu >='=>$lp["tgl_awal"],'tgl_lhu <='=>$lp["tgl_akhir"],$data['ins']=>$lp["id_instansi"]);
        }
        $data['ambil_lhu'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc');
        $data['grup_lhu'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrup'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc',$data['grup_item']);
        $data['ambil_bulan'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc','MONTH('.$data['tgl_item'].')');
        //============================================================================= GRAFIK
        $data['js_thn'] = 'js_thn';
        $data['js_bln'] = 'js_bln';
        $data['js_hr'] = 'js_hr';
        $data['tgl_bln'] = 'tgl_bln';
        $data['tgl_hr'] = 'tgl_hr';
        $data['tgl_thn'] = 'tgl_thn';
        $data['selectgrafik5'] = ("sum(".$data['jml_item'].") as ".$data['jml_item'].",".$data['grup_item']." as ".$data['id_item'].",DATE_FORMAT(".$data['tgl_item'].",'%d-%m-%Y') as ".$data['tgl_hr'].",DATE_FORMAT(".$data['tgl_item'].",'%m-%Y') as ".$data['tgl_bln'].",DATE_FORMAT(".$data['tgl_item'].",'%Y') as ".$data['tgl_thn'].",".$data['tgl_item']." as ".$data['tgl_item'].",MONTH(".$data['tgl_item'].") as ".$data['js_bln'].",YEAR(".$data['tgl_item'].") as ".$data['js_thn'].",DATE_FORMAT(".$data['tgl_item'].",'%d') as ".$data['js_hr'].",concat(".$data['nama_item1'].",' - ',".$data['nama_item2'].") as ".$data['nama_item']."  ");
        $data['selectgrafikhr'] = (" ".$data['grup_item']." as ".$data['id_item'].",DATE_FORMAT(".$data['tgl_item'].",'%d-%m-%Y') as ".$data['tgl_hr'].",DATE_FORMAT(".$data['tgl_item'].",'%m-%Y') as ".$data['tgl_bln'].",DATE_FORMAT(".$data['tgl_item'].",'%Y') as ".$data['tgl_thn'].",".$data['tgl_item']." as ".$data['tgl_item'].",MONTH(".$data['tgl_item'].") as ".$data['js_bln'].",YEAR(".$data['tgl_item'].") as ".$data['js_thn'].",DATE_FORMAT(".$data['tgl_item'].",'%d') as ".$data['js_hr'].",  ");
        $data['grafik5'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafik5'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc','MONTH('.$data['tgl_item'].')');
        $data['grafikhr'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafikhr'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['tgl_item']);
        $data['legendgrafik5'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['grup_item']);
        $data['ambil_data_min'] = $this->m_ol_laporan->get_min($data['idtab'],$data['tabel_item'],$data['jml_item'],$data['kondisi1'],$lp["lhu"]);
        $data['ambil_data_max'] = $this->m_ol_laporan->get_max($data['idtab'],$data['tabel_item'],$data['jml_item'],$data['kondisi1'],$lp["lhu"]);
        $data['grafikpie'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafik5'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['id_item']);
      }
      //============================================================================= lhu 5
      if($lp["lhu"] == 5){
        $data['text'] = 'SUMBER DATA : PENDAFTARAN PASIEN';
        $data['tabel_item'] = 'tindakan_daftar';
        $data['grup_item'] = 'tindakan_daftar.id_tindakan';
        $data['ins_item'] = 'id_golongan_pemeriksaan';
        $data['kat_item'] = 'tindakan.id_golongan_pemeriksaan';
        $data['nama_kat'] = 'nama_golongan_pemeriksaan';
        $data['nama_item1'] = 'nama_tindakan';
        $data['nama_item2'] = 'nama_golongan_pemeriksaan';
        $data['id_item'] = 'id_tindakan';
        $data['coun_item'] = 'coun_tindakan_daftar';
        $data['nama_item'] = 'nama_tindakan';
        $data['order'] = 'tindakan_daftar.id_tindakan';
        $data['tgl_item'] = 'tgl_daftar';
        $data['sume'] = 'tindakan_daftar.id_tindakan';
        $data['sumeas'] = 'jml_tindakan';
        $data['jml_item'] = 'jml_tindakan';
        $data['id_peg'] = 'tindakan_daftar.pendaftar';
        $data['pegawai'] = $lp['id_pegawai'];
        $data['ins'] = 'unit_tindakan';
        $data['idinst'] = $lp["id_unit"];
        $data['select1'] = ("*");
        $data['selectgrup'] = ("count(".$data['sume'].") as ".$data['sumeas'].",nama_tindakan,nama_golongan_pemeriksaan");
        $data['kondisi1'] = array('tgl_daftar >='=>$lp["tgl_awal"],'tgl_daftar <='=>$lp["tgl_akhir"],$data['ins']=>$data['idinst']);
        $data['ambil_lhu'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc');
        $data['grup_lhu'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrup'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc',$data['grup_item']);
        $data['ambil_bulan'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc','MONTH('.$data['tgl_item'].')');
        //============================================================================= GRAFIK
        $data['js_thn'] = 'js_thn';
        $data['js_bln'] = 'js_bln';
        $data['js_hr'] = 'js_hr';
        $data['tgl_bln'] = 'tgl_bln';
        $data['tgl_hr'] = 'tgl_hr';
        $data['tgl_thn'] = 'tgl_thn';
        $data['selectgrafik5'] = ("count(".$data['sume'].") as ".$data['sumeas'].",".$data['grup_item']." as ".$data['id_item'].",DATE_FORMAT(".$data['tgl_item'].",'%d-%m-%Y') as ".$data['tgl_hr'].",DATE_FORMAT(".$data['tgl_item'].",'%m-%Y') as ".$data['tgl_bln'].",DATE_FORMAT(".$data['tgl_item'].",'%Y') as ".$data['tgl_thn'].",".$data['tgl_item']." as ".$data['tgl_item'].",MONTH(".$data['tgl_item'].") as ".$data['js_bln'].",YEAR(".$data['tgl_item'].") as ".$data['js_thn'].",DATE_FORMAT(".$data['tgl_item'].",'%d') as ".$data['js_hr'].",concat(".$data['nama_item1'].",' - ',".$data['nama_item2'].") as ".$data['nama_item']."  ");
        $data['selectgrafikhr'] = (" ".$data['grup_item']." as ".$data['id_item'].",DATE_FORMAT(".$data['tgl_item'].",'%d-%m-%Y') as ".$data['tgl_hr'].",DATE_FORMAT(".$data['tgl_item'].",'%m-%Y') as ".$data['tgl_bln'].",DATE_FORMAT(".$data['tgl_item'].",'%Y') as ".$data['tgl_thn'].",".$data['tgl_item']." as ".$data['tgl_item'].",MONTH(".$data['tgl_item'].") as ".$data['js_bln'].",YEAR(".$data['tgl_item'].") as ".$data['js_thn'].",DATE_FORMAT(".$data['tgl_item'].",'%d') as ".$data['js_hr'].",  ");
        $data['grafik5'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafik5'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc','MONTH('.$data['tgl_item'].')');
        $data['grafikhr'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafikhr'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['tgl_item']);
        $data['legendgrafik5'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['grup_item']);
        $data['ambil_data_min'] = $lp["min_laporan_tabel"];
        $data['ambil_data_max'] = $lp["max_laporan_tabel"];
        $data['grafikpie'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafik5'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['id_item']);
      }
      //============================================================================= lhu 7
      if($lp["lhu"] == 7){
        $data['text'] = 'SUMBER DATA : BERKAS';
        $data['tabel_item'] = 'ol_berkas';
        $data['grup_item'] = 'ol_berkas.id_kategori_berkas';
        $data['ins_item'] = 'id_kategori_berkas';
        $data['kat_item'] = 'ol_berkas.id_kategori_berkas';
        $data['nama_kat'] = 'nama_berkas_kategori';
        $data['nama_item1'] = 'nama_berkas_kategori';
        $data['nama_item2'] = 'nama_berkas_kategori';
        $data['id_item'] = 'id_berkas';
        $data['coun_item'] = 'id_berkas';
        $data['nama_item'] = 'nama_berkas';
        $data['order'] = 'ol_berkas.tgl_b_berkas';
        $data['tgl_item'] = 'tgl_b_berkas';
        $data['sume'] = 'ol_berkas.kredit';
        $data['sumeas'] = 'coun_berkas';
        $data['jml_item'] = 'coun_berkas';
        $data['id_peg'] = 'ol_berkas.id_pegawai';
        $data['pegawai'] = $lp['id_pegawai'];
        $data['ins'] = 'ol_berkas.id_pegawai';
        $data['idinst'] = $lp["id_pegawai"];
        $data['select1'] = ("*");
        $data['selectgrup'] = ("sum(".$data['sume'].") as ".$data['sumeas'].",nama_berkas,nama_berkas_kategori");
        $data['kondisi1'] = array('tgl_b_berkas >='=>$lp["tgl_awal"],'tgl_b_berkas <='=>$lp["tgl_akhir"],$data['ins']=>$data['idinst'],'link_berkas !='=>'','status_berkas'=>1);
        $data['ambil_lhu'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc');
        $data['grup_lhu'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrup'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc',$data['grup_item']);
        $data['ambil_bulan'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc','MONTH('.$data['tgl_item'].')');
        $data['kondisi_berkas'] = array('id_kategori_berkas >'=>13,'link_berkas !='=>'','status_berkas'=>1,$data['ins']=>$data['idinst']);
        $data['kondisi_imut'] = array('id_kategori_berkas'=>12,'link_berkas !='=>'','status_berkas'=>1,$data['ins']=>$data['idinst']);
        $data['kondisi_ijasah'] = array('id_kategori_berkas'=>7,'link_berkas !='=>'','status_berkas'=>1,$data['ins']=>$data['idinst']);
        $data['kondisi_pelatihan'] = array('kunci'=>1,'link_berkas !='=>'','status_berkas'=>1,$data['ins']=>$data['idinst']);
        $data['kondisi_str'] = array('kunci'=>0,'link_berkas !='=>'','status_berkas'=>1,$data['ins']=>$data['idinst']);
        $data['jml_berkas'] = $this->m_ol_laporan->jumlah_sumber_data($data['idtab'],$data['tabel_item'],$data['kondisi_berkas'],$lp["lhu"]);
        $data['jml_imut'] = $this->m_ol_laporan->jumlah_sumber_data($data['idtab'],$data['tabel_item'],$data['kondisi_imut'],$lp["lhu"]);
        $data['jml_ijasah'] = $this->m_ol_laporan->jumlah_sumber_data($data['idtab'],$data['tabel_item'],$data['kondisi_ijasah'],$lp["lhu"]);
        $data['jml_pelatihan'] = $this->m_ol_laporan->jumlah_sumber_data($data['idtab'],$data['tabel_item'],$data['kondisi_pelatihan'],$lp["lhu"]);
        $data['jml_str'] = $this->m_ol_laporan->jumlah_sumber_data($data['idtab'],$data['tabel_item'],$data['kondisi_str'],$lp["lhu"]);
        $data['ambil_berkas'] = $this->m_ol_laporan->set_isi_sumber_data($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi_berkas'],$lp["lhu"],$data['order'],'asc');
        $data['ambil_imut'] = $this->m_ol_laporan->set_isi_sumber_data($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi_imut'],$lp["lhu"],$data['order'],'asc');
        $data['ambil_ijasah'] = $this->m_ol_laporan->set_isi_sumber_data($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi_ijasah'],$lp["lhu"],$data['order'],'asc');
        $data['ambil_pelatihan'] = $this->m_ol_laporan->set_isi_sumber_data($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi_pelatihan'],$lp["lhu"],$data['order'],'asc');
        $data['ambil_str'] = $this->m_ol_laporan->set_isi_sumber_data($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi_str'],$lp["lhu"],$data['order'],'asc');
        //============================================================================= GRAFIK
        $data['js_thn'] = 'js_thn';
        $data['js_bln'] = 'js_bln';
        $data['js_hr'] = 'js_hr';
        $data['tgl_bln'] = 'tgl_bln';
        $data['tgl_hr'] = 'tgl_hr';
        $data['tgl_thn'] = 'tgl_thn';
        $data['selectgrafik5'] = ("count(".$data['sume'].") as ".$data['sumeas'].",".$data['grup_item']." as ".$data['id_item'].",DATE_FORMAT(".$data['tgl_item'].",'%d-%m-%Y') as ".$data['tgl_hr'].",DATE_FORMAT(".$data['tgl_item'].",'%m-%Y') as ".$data['tgl_bln'].",DATE_FORMAT(".$data['tgl_item'].",'%Y') as ".$data['tgl_thn'].",".$data['tgl_item']." as ".$data['tgl_item'].",MONTH(".$data['tgl_item'].") as ".$data['js_bln'].",YEAR(".$data['tgl_item'].") as ".$data['js_thn'].",DATE_FORMAT(".$data['tgl_item'].",'%d') as ".$data['js_hr'].",concat(".$data['nama_item1'].",' - ',".$data['nama_item2'].") as ".$data['nama_item']."  ");
        $data['selectgrafikhr'] = (" ".$data['grup_item']." as ".$data['id_item'].",DATE_FORMAT(".$data['tgl_item'].",'%d-%m-%Y') as ".$data['tgl_hr'].",DATE_FORMAT(".$data['tgl_item'].",'%m-%Y') as ".$data['tgl_bln'].",DATE_FORMAT(".$data['tgl_item'].",'%Y') as ".$data['tgl_thn'].",".$data['tgl_item']." as ".$data['tgl_item'].",MONTH(".$data['tgl_item'].") as ".$data['js_bln'].",YEAR(".$data['tgl_item'].") as ".$data['js_thn'].",DATE_FORMAT(".$data['tgl_item'].",'%d') as ".$data['js_hr'].",  ");
        $data['grafik5'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafik5'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc','MONTH('.$data['tgl_item'].')');
        $data['grafikhr'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafikhr'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['tgl_item']);
        $data['legendgrafik5'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['grup_item']);
        $data['ambil_data_min'] = $lp["min_laporan_tabel"];
        $data['ambil_data_max'] = $lp["max_laporan_tabel"];
        $data['grafikpie'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafik5'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['id_item']);
        //============================================================================= GRAFIK
        $data['js_thn'] = 'js_thn';
        $data['js_bln'] = 'js_bln';
        $data['js_hr'] = 'js_hr';
        $data['tgl_bln'] = 'tgl_bln';
        $data['tgl_hr'] = 'tgl_hr';
        $data['tgl_thn'] = 'tgl_thn';
        $data['selectgrafik5'] = ("sum(".$data['jml_item'].") as ".$data['jml_item'].",".$data['grup_item']." as ".$data['id_item'].",DATE_FORMAT(".$data['tgl_item'].",'%d-%m-%Y') as ".$data['tgl_hr'].",DATE_FORMAT(".$data['tgl_item'].",'%m-%Y') as ".$data['tgl_bln'].",DATE_FORMAT(".$data['tgl_item'].",'%Y') as ".$data['tgl_thn'].",".$data['tgl_item']." as ".$data['tgl_item'].",MONTH(".$data['tgl_item'].") as ".$data['js_bln'].",YEAR(".$data['tgl_item'].") as ".$data['js_thn'].",DATE_FORMAT(".$data['tgl_item'].",'%d') as ".$data['js_hr'].",concat(".$data['nama_item1'].",' - ',".$data['nama_item2'].") as ".$data['nama_item']."  ");
        $data['selectgrafikhr'] = (" ".$data['grup_item']." as ".$data['id_item'].",DATE_FORMAT(".$data['tgl_item'].",'%d-%m-%Y') as ".$data['tgl_hr'].",DATE_FORMAT(".$data['tgl_item'].",'%m-%Y') as ".$data['tgl_bln'].",DATE_FORMAT(".$data['tgl_item'].",'%Y') as ".$data['tgl_thn'].",".$data['tgl_item']." as ".$data['tgl_item'].",MONTH(".$data['tgl_item'].") as ".$data['js_bln'].",YEAR(".$data['tgl_item'].") as ".$data['js_thn'].",DATE_FORMAT(".$data['tgl_item'].",'%d') as ".$data['js_hr'].",  ");
        $data['grafik5'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafik5'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc','MONTH('.$data['tgl_item'].')');
        $data['grafikhr'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafikhr'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['tgl_item']);
        $data['legendgrafik5'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['grup_item']);
        $data['ambil_data_min'] = $this->m_ol_laporan->get_min($data['idtab'],$data['tabel_item'],$data['jml_item'],$data['kondisi1'],$lp["lhu"]);
        $data['ambil_data_max'] = $this->m_ol_laporan->get_max($data['idtab'],$data['tabel_item'],$data['jml_item'],$data['kondisi1'],$lp["lhu"]);
        $data['grafikpie'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafik5'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['id_item']);
      }
      //============================================================================= lhu 8
      if($lp["lhu"] == 8){
        $data['text'] = 'SUMBER DATA : EVEN DENGAN ABSENSI LOKASI';
        $data['tabel_item'] = 'abs_even';
        $data['grup_item'] = 'tgl_even';
        $data['ins_item'] = 'tgl_even';
        $data['kat_item'] = 'tgl_even';
        $data['nama_kat'] = 'nama_even';
        $data['nama_item1'] = 'nama_even';
        $data['nama_item2'] = 'alamat_even';
        $data['id_item'] = 'id_even';
        $data['coun_item'] = 'coun_even';
        $data['nama_item'] = 'nama_even';
        $data['order'] = 'tgl_even';
        $data['tgl_item'] = 'tgl_even';
        $data['sume'] = 'id_even';
        $data['sumeas'] = 'coun_even';
        $data['jml_item'] = 'coun_even';
        $data['id_peg'] = 'abs_even.barcode_pegawai';
        $data['pegawai'] = $lp['barcode_pegawai'];
        $data['ins'] = 'unit';
        $data['idinst'] = $lp["id_unit"];
        $data['select1'] = ("*");
        $data['selectgrup'] = ("sum(".$data['jml_item'].") as ".$data['jml_item'].",nama_even,alamat_even");
        $data['kondisi1'] = array('tgl_even >='=>$lp["tgl_awal"],'tgl_even <='=>$lp["tgl_akhir"],$data['ins']=>$data['idinst']);
        $data['ambil_lhu'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc');
        $data['grup_lhu'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrup'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc',$data['grup_item']);
        $data['ambil_bulan'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['order'],'asc','MONTH('.$data['tgl_item'].')');
        //============================================================================= GRAFIK
        $data['js_thn'] = 'js_thn';
        $data['js_bln'] = 'js_bln';
        $data['js_hr'] = 'js_hr';
        $data['tgl_bln'] = 'tgl_bln';
        $data['tgl_hr'] = 'tgl_hr';
        $data['tgl_thn'] = 'tgl_thn';
        $data['selectgrafik5'] = ("sum(".$data['jml_item'].") as ".$data['jml_item'].",".$data['grup_item']." as ".$data['id_item'].",DATE_FORMAT(".$data['tgl_item'].",'%d-%m-%Y') as ".$data['tgl_hr'].",DATE_FORMAT(".$data['tgl_item'].",'%m-%Y') as ".$data['tgl_bln'].",DATE_FORMAT(".$data['tgl_item'].",'%Y') as ".$data['tgl_thn'].",".$data['tgl_item']." as ".$data['tgl_item'].",MONTH(".$data['tgl_item'].") as ".$data['js_bln'].",YEAR(".$data['tgl_item'].") as ".$data['js_thn'].",DATE_FORMAT(".$data['tgl_item'].",'%d') as ".$data['js_hr'].",concat(".$data['nama_item1'].",' - ',".$data['nama_item2'].") as ".$data['nama_item']."  ");
        $data['selectgrafikhr'] = (" ".$data['grup_item']." as ".$data['id_item'].",DATE_FORMAT(".$data['tgl_item'].",'%d-%m-%Y') as ".$data['tgl_hr'].",DATE_FORMAT(".$data['tgl_item'].",'%m-%Y') as ".$data['tgl_bln'].",DATE_FORMAT(".$data['tgl_item'].",'%Y') as ".$data['tgl_thn'].",".$data['tgl_item']." as ".$data['tgl_item'].",MONTH(".$data['tgl_item'].") as ".$data['js_bln'].",YEAR(".$data['tgl_item'].") as ".$data['js_thn'].",DATE_FORMAT(".$data['tgl_item'].",'%d') as ".$data['js_hr'].",  ");
        $data['grafik5'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafik5'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc','MONTH('.$data['tgl_item'].')');
        $data['grafikhr'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafikhr'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['tgl_item']);
        $data['legendgrafik5'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['select1'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['grup_item']);
        $data['ambil_data_min'] = $lp["min_laporan_tabel"];
        $data['ambil_data_max'] = $lp["max_laporan_tabel"];
        $data['grafikpie'] = $this->m_ol_laporan->ambil_isi($data['idtab'],$data['tabel_item'],$data['selectgrafik5'],$data['kondisi1'],$lp["lhu"],$data['tgl_item'],'asc',$data['id_item']);
      }
	//============================================================================= !LHU
    if($mode=='view'){
      $this->tampil($data);
    }
 	}
  function lihat($mode='view')
  {
		$data['page']  = "lihat";
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$data['header'] = $instansi["nama_instansi"];
		$data['title'] = "LAPORAN INDIKATOR MUTU PERSONAL";
		$data['instance_status'] = $instansi["status_instansi"];
		$data['instance_id'] = $instansi["id_instansi"];
		$data['instance_name'] = $instansi["nama_instansi"];
		$data['idescription'] = $instansi["description"];
		$data['ikeywords'] = $instansi["keywords"];
		$data['iheader'] = $instansi["header"];
		$data['iheader_mini'] = $instansi["header_mini"];
		$data['ifooter'] = $instansi["footer"];
		$data['ilicensed'] = $instansi["licensed"];
		$data['iconik'] = $instansi["icon"];
		$data['surveyor'] = '1';
		$data['member_name'] = 'WELCOME USER';
		$data['level_name'] = 'SURVEYOR';
		$data['photo'] = base_url().'assets/images/noavatar.jpg';
		$data['id'] = $this->uri->segment(4, 0);
		$data['tbl'] = $this->uri->segment(5, 0);
		$data['all_berkas']=$this->m_ol_rancak->ambil_berkas_laporan();
		$kondisi_cek = array('id_laporan_tabel'=>$data['tbl']);
$data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('ol_logbook_laporan_tabel',$kondisi_cek,'ol_logbook_laporan','id_laporan');
$lptab = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($data['tbl']);
$bpeg = $this->m_umum->ambil_data('ol_pegawai','barcode_pegawai',$lptab['barcode_pegawai']);
$data['aran_pegawai'] = $bpeg['nama_pegawai'];
    if($mode=='pie'){
    		$lp = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($data['tbl']);
        if($lp['lhu'] == 1){ // 1kompetensi-2bakhp-3reject-4lhu
        	echo json_encode($this->m_member->grafik_pie_opsi_logbook($data['tbl']));
        }
        if($lp['lhu'] == 2){
        	echo json_encode($this->m_member->grafik_pie_pakai_opsi_pasien($data['tbl'],'id_bahan','jml_bahan','nama_bahan','id_bahan'));
        }
        if($lp['lhu'] == 3){
        	echo json_encode($this->m_member->grafik_pie_reject_opsi_pasien($data['tbl'],'id_reject','jml_reject','nama_reject','id_reject'));
        }
        if($lp['lhu'] == 4){
      	    echo json_encode($this->m_member->grafik_pie_opsi_lhu($data['tbl'],'id_lhu'));
        }
		}
		else if($mode=='data'){
			echo json_encode($this->m_member->logbook_pasien_instansi($data['tbl']));
		}
    if($mode=='laporan'){
      $data['page'] =  $data['page']."_laporan";
			if($data['cek'] == 0 OR empty($data['tbl'])){
				redirect(base_url('external'));
			}
      $data['ambil_tabel'] = $this->m_external->ambil_logbook_laporan_tabel($data['id']);
			$data['id_pegawai']  = set_value('id_pegawai',$lptab["id_pegawai"]);
			$data['barcode_pegawai']  = set_value('barcode_pegawai',$lptab["barcode_pegawai"]);
			$data['id_laporan']  = set_value('id_laporan',$lptab["id_laporan"]);
			$data['id_laporan_tabel']  = set_value('id_laporan_tabel',$lptab["id_laporan_tabel"]);
			$data['id_working']  = set_value('id_working',$lptab["id_working"]);
			$data['id_instansi']  = set_value('id_instansi',$lptab["id_instansi"]);
			$data['tgl_laporan']  = set_value('tgl_laporan',date('d-m-Y', strtotime($lptab["tgl_laporan"])));
			$data['tgl_awal']  = set_value('tgl_awal',date('d-m-Y', strtotime($lptab["tgl_awal"])));
			$data['tgl_akhir']  = set_value('tgl_akhir',date('d-m-Y', strtotime($lptab["tgl_akhir"])));
			$data['header_laporan']  = set_value('header_laporan',$lptab["header_laporan"]);
			$data['sub_header_laporan']  = set_value('sub_header_laporan',$lptab["sub_header_laporan"]);
			$data['sub_sub_header_laporan']  = set_value('sub_sub_header_laporan',$lptab["sub_sub_header_laporan"]);
			$data['judul_laporan']  = set_value('judul_laporan',$lptab["judul_laporan"]);		
			$data['tujuan_laporan']  = set_value('tujuan_laporan',$lptab["tujuan_laporan"]);			
			$data['periode_laporan']  = set_value('periode_laporan',$lptab["periode_laporan"]);			
			$data['sumber_laporan']  = set_value('sumber_laporan',$lptab["sumber_laporan"]);		
			$data['judul_laporan_tabel']  = set_value('judul_laporan_tabel',$lptab["judul_laporan_tabel"]);		
			$data['analisa_laporan_tabel']  = set_value('analisa_laporan_tabel',$lptab["analisa_laporan_tabel"]);		
			$data['rekomendasi_laporan_tabel']  = set_value('rekomendasi_laporan_tabel',$lptab["rekomendasi_laporan_tabel"]);		
			$data['kompetensi']  = set_value('kompetensi',$lptab["kompetensi"]);	
			$data['share_it']  = set_value('share_it',$lptab["share_it"]);	
			$data['idpeg']  = set_value('idpeg',$lptab["id_pegawai"]);
			$data['kewenangan']  = set_value('kewenangan',$lptab["kewenangan"]);	
			$data['bahan']  = set_value('bahan',$lptab["bahan"]);		
			$data['reject']  = set_value('reject',$lptab["reject"]);		
			$data['lhu']  = set_value('lhu',$lptab["lhu"]);		
			$data['tabel']  = set_value('tabel',$lptab["tabel"]);		
			$data['show_pdf']  = set_value('show_pdf',$lptab["show_pdf"]);
			$data['berkasere']  = set_value('berkasere',$lptab["berkas"]);
      	if(empty($lptab["min_laporan_tabel"])){
      		$data['min_laporan_tabel'] = '0';
      	}else{
      		$data['min_laporan_tabel'] = $lptab["min_laporan_tabel"];
      	}
      	if(empty($lp["max_laporan_tabel"])){
      		$data['max_laporan_tabel'] = '0';
      	}else{
      		$data['max_laporan_tabel'] = $lptab["max_laporan_tabel"];
      	}		
			$data['urutan_laporan_tabel']  = set_value('urutan_laporan_tabel',$lptab["urutan_laporan_tabel"]);	
        if($data['lhu'] == 1 OR $lptab['tabel'] == 1 OR empty($lptab['kompetensi'])){ // 1kompetensi-2bakhp-3reject-4lhu
        //	$data['ambil_lhu'] = $this->m_member->ambil_lhu_logbook($data['tbl']);
        	$select_logbook = "*";
        	$kondisi_logbook = array('ol.id_logbooker'=>$lptab['id_pegawai']);
        	$data['ambil_lhu'] = $this->m_external->ambil_lhu_logbook($data['tbl'],$select_logbook,$kondisi_logbook,'ol.tgl_logbook');
$data['ambil_bulan'] = $this->m_member->ambil_bulan_laporan_logbook($data['tbl']);
        	$data['garis_trend'] = $this->m_member->garis_trend($data['tbl']);
        	$data['grafik_garis_opsi'] = $this->m_member->grafik_garis_opsi_logbook($data['tbl']);
        	$data['ambil_limbah_grafik'] = $this->m_member->grafik_garis_opsi_logbook2($data['tbl'],$lptab["kewenangan"]);

if($data['kewenangan'] == 1){
$data['select2'] = ("ol_logbook.id_kewenangan  as id_lhu,sum(jml_logbook) as hasil_lhu_detil,tgl_logbook as tgl_lhu,nama_kewenangan as nama_lhu");
$data['grup2'] = "ol_logbook.id_kewenangan";
}else{
$data['select2'] = ("nkr_kewenangan.id_kompetensi  as id_lhu,sum(jml_logbook) as hasil_lhu_detil,tgl_logbook as tgl_lhu,nama_kompetensi as nama_lhu"); 
$data['grup2'] = "nkr_kewenangan.id_kompetensi";
}
$data['tabel1'] = 'ol_logbook';
$data['group1'] = 'MONTH(tgl_logbook)';
$data['grtgl'] = 'tgl_logbook';
$data['jumlah'] = 'jml_logbook >';
$data['konbln'] = array('id_logbooker'=>$data['id_pegawai'],$data['jumlah']=>0,'id_instansi'=>$data['id_instansi']);  
$grup2 = 'MONTH(tgl_logbook)';
$kondisi2 = array('tgl_logbook >='=>$lptab["tgl_awal"],'tgl_logbook <='=>$lptab["tgl_akhir"],'jml_logbook >'=>0,'id_logbooker'=>$data['id_pegawai'],'id_instansi'=>$data['id_instansi']);
        }
        if($data['lhu'] == 2){
        	$data['ambil_lhu'] = $this->m_member->ambil_data_bakhp($data['tbl'],'olpk.id_bahan','jml_bahan');
        	$data['ambil_bulan'] = $this->m_member->ambil_data_bulan_bakhp($data['tbl'],'olpk.id_bahan','jml_bahan');
        	$data['grafik_garis_opsi'] = $this->m_member->grafik_garis_opsi_pakai($data['tbl'],'olpk.id_bahan','jml_bahan','nama_bahan');
        	$data['ambil_limbah_grafik'] = $this->m_member->grafik_garis_opsi_pakai($data['tbl'],'olpk.id_bahan','jml_bahan','nama_bahan','olpk.id_bahan');

$data['tabel1'] = 'ol_logbook_pakai';
$data['group1'] = 'MONTH(tgl_logbook)';
$data['jumlah'] = 'jml_bahan >';
$data['konbln'] = array('id_logbooker'=>$data['id_pegawai'],$data['jumlah']=>0,'id_instansi'=>$data['id_instansi']);  
$data['select2'] = ("ol_bahan.in_bahan  as id_lhu,sum(jml_bahan) as hasil_lhu_detil,tgl_logbook as tgl_lhu,nama_bahan as nama_lhu"); 
$data['grup2'] = "ol_logbook_pakai.id_bahan";
        }
        if($data['lhu'] == 3){
        	$data['ambil_lhu'] = $this->m_member->ambil_data_reject($data['tbl'],'olpk.id_reject','jml_reject');
        	$data['ambil_bulan'] = $this->m_member->ambil_data_bulan_reject($data['tbl'],'olpk.id_reject','jml_reject');
        	$data['grafik_garis_opsi'] = $this->m_member->grafik_garis_opsi_reject($data['tbl'],'olpk.id_reject','jml_reject','nama_reject');
        	$data['ambil_limbah_grafik'] = $this->m_member->grafik_garis_opsi_reject($data['tbl'],'olpk.id_reject','jml_reject','nama_reject','olpk.id_reject');

$data['tabel1'] = 'ol_logbook_reject';
$data['group1'] = 'MONTH(tgl_logbook)';
$data['grtgl'] = 'tgl_logbook';
$data['grtgl'] = 'tgl_logbook';
$data['jumlah'] = 'jml_reject >';
$data['konbln'] = array('id_logbooker'=>$data['id_pegawai'],$data['jumlah']=>0,'id_instansi'=>$data['id_instansi']);  
$data['select2'] = ("ol_logbook_reject.id_reject  as id_lhu,sum(jml_reject) as hasil_lhu_detil,tgl_logbook as tgl_lhu,nama_reject as nama_lhu"); 
$data['grup2'] = "ol_logbook_reject.id_reject";
        }
        if($data['lhu'] == 4){
 $data['selectk'] = ("*,SUM(hasil_lhu_detil) as jumlaha,olp.id_item_lhu as id_kompetensi,concat(nama_item_lhu,' - ',nama_equipment) as nama_kompetensi");
$data['select_lhu'] = ("*,hasil_lhu_detil as jml_logbook,olp.id_item_lhu as id_lhu,concat(nama_item_lhu,' - ',nama_equipment) as nama_lhu");
        		$select_lhu = ("*,hasil_lhu_detil as jml_logbook,olp.id_item_lhu as id_lhu,concat(nama_item_lhu,' - ',nama_equipment) as nama_lhu");
        		$data['select_jscode'] = ("olp.id_item_lhu as id_lhu,hasil_lhu_detil");
        		$select_opsi = ("olp.id_item_lhu as id_lhu,
        			concat(nama_item_lhu,' - ',nama_equipment) as nama_lhu,
							DATE_FORMAT(tgl_lhu,'%d-%m-%Y') as tgl_lhu,hasil_lhu_detil,
							DATE_FORMAT(tgl_lhu,'%Y') as thn,
							DATE_FORMAT(tgl_lhu,'%m') as bln,
							DATE_FORMAT(tgl_lhu,'%d') as hr");
      	    $data['ambil_lhu'] = $this->m_member->ambil_universal_lhu($data['tbl'],$select_lhu);
      	    $data['ambil_bulan'] = $this->m_member->ambil_universal_bulan_lhu($data['tbl'],$data['select_lhu']);
      	    $data['grafik_garis_opsi'] = $this->m_member->grafik_garis_opsi_lhu($data['tbl'],$select_opsi);
      	    $data['ambil_limbah_grafik'] = $this->m_member->grafik_garis_opsi_lhu($data['tbl'],$select_opsi,'olp.id_item_lhu');

$data['tabel1'] = 'ol_logbook_lhu_detil';
$data['group1'] = 'MONTH(tgl_lhu)';
$data['grtgl'] = 'tgl_lhu';
$data['jumlah'] = 'hasil_lhu_detil >';
$data['konbln'] = array('barcode_pegawai'=>$data['barcode_pegawai'],$data['jumlah']=>0,'id_instansi'=>$data['id_instansi']);
$data['select2'] = ("ol_logbook_item_lhu.in_item_lhu  as id_lhu,sum(hasil_lhu_detil) as hasil_lhu_detil,tgl_lhu,concat(nama_item_lhu,' - ',nama_equipment) as nama_lhu"); 
$data['grup2'] = "ol_logbook_lhu_detil.id_item_lhu";
        }
        if($data['lhu'] == 5){
        		$select_lhu = ("*,count(id_daftar) as jml_logbook,td.id_tindakan as id_lhu,concat(nama_tindakan,' - ',nama_golongan_pemeriksaan) as nama_lhu");
        $data['select_lhu'] = ("*,count(id_daftar) as jml_logbook,td.id_tindakan as id_lhu,concat(nama_tindakan,' - ',nama_golongan_pemeriksaan) as nama_lhu");
        		$data['select_jscode'] = ("td.id_tindakan as id_lhu,count(id_daftar) as hasil_lhu_detil");
        		$select_opsi = ("td.id_tindakan as id_lhu,
        			concat(nama_tindakan,' - ',nama_golongan_pemeriksaan) as nama_lhu,
							DATE_FORMAT(tgl_daftar,'%d-%m-%Y') as tgl_daftar,count(id_daftar) as hasil_lhu_detil,
							DATE_FORMAT(tgl_daftar,'%Y') as thn,
							DATE_FORMAT(tgl_daftar,'%m') as bln,
							DATE_FORMAT(tgl_daftar,'%d') as hr");
      	    $data['ambil_lhu'] = $this->m_member->ambil_daftar_tindakan_lhu($data['tbl'],$select_lhu);
      	    $data['ambil_bulan'] = $this->m_member->ambil_tindakan_daftar_bulan_lhu($data['tbl'],$data['select_lhu']);
      	    $data['grafik_garis_opsi'] = $this->m_member->grafik_garis_tindakan_daftar_lhu($data['tbl'],$select_opsi);
      	    $data['ambil_limbah_grafik'] = $this->m_member->grafik_garis_tindakan_daftar_lhu($data['tbl'],$select_opsi,'t.id_tindakan');

$data['tabel1'] = 'tindakan_daftar';
$data['group1'] = 'MONTH(tgl_daftar)';
$data['grtgl'] = 'tgl_daftar';
$data['konbln'] = array('id_instansi'=>$data['id_instansi']);
$data['select2'] = ("tindakan.in_tindakan  as id_lhu,count(id_daftar) as hasil_lhu_detil,tgl_daftar as tgl_lhu,concat(nama_tindakan,' - ',nama_golongan_pemeriksaan) as nama_lhu");
$data['grup2'] = "tindakan_daftar.id_tindakan";
        }
        if($data['lhu'] == 7){
$data['slct_range'] = ("*,
id_berkas as id_lhu,count(id_berkas) as hasil_lhu_detil,
				if (nama_kategori_pelatihan IS NULL or nama_kategori_pelatihan = '' ,SUM(case when nama_kategori_pelatihan IS NULL or nama_kategori_pelatihan = '' then 1 else 0 end),SUM(case when nama_kategori_pelatihan IS NOT NULL or nama_kategori_pelatihan <> '' then 1 else 0 end)) as total,
				if(nama_kategori_pelatihan IS NULL or nama_kategori_pelatihan = '','Bukan Kategori Pelatihan',nama_kategori_pelatihan) as nama_lhu,
				DATE_FORMAT(tgl_b_berkas,'%d-%m-%Y') as tgl_lhu,
				DATE_FORMAT(tgl_b_berkas,'%Y') as thn,
				DATE_FORMAT(tgl_b_berkas,'%m') as bln,
				DATE_FORMAT(tgl_b_berkas,'%d') as hr
	");
$data['slct_tr'] = ("*,id_berkas as id_lhu,count(id_berkas) as hasil_lhu_detil,if(nama_kategori_pelatihan IS NULL or nama_kategori_pelatihan = '','Bukan Kategori Pelatihan',nama_kategori_pelatihan) as nama_lhu,DATE_FORMAT(tgl_b_berkas,'%d-%m-%Y') as tgl_lhu
	");
$data['kon_tr'] = array('status_berkas'=>1);
    	    $data['ambil_range'] = $this->m_member->ambil_berkas_laporan($data['tbl'],$data['slct_tr'],$data['kon_tr']);
    	    $data['ambil_lhu'] = $this->m_member->ambil_berkas_laporan($data['tbl'],$data['slct_tr'],$data['kon_tr']);
    	    $data['ambil_bulan'] = $this->m_member->ambil_berkas_laporan($data['tbl'],$data['slct_tr'],$data['kon_tr']);

        	$data['kondisi_berkas'] = array('id_kategori_berkas >'=>13,'link_berkas !='=>'','status_berkas'=>1);
        	$data['kondisi_imut'] = array('id_kategori_berkas'=>12,'link_berkas !='=>'','status_berkas'=>1);
        	$data['kondisi_ijasah'] = array('id_kategori_berkas'=>7,'link_berkas !='=>'','status_berkas'=>1);
        	$data['kondisi_pelatihan'] = array('kunci'=>1,'link_berkas !='=>'','status_berkas'=>1);
        	$data['kondisi_str'] = array('kunci'=>0,'link_berkas !='=>'','status_berkas'=>1);
        	$data['ambil_berkas'] = $this->m_member->ambil_logbook_berkas($data['tbl'],$data['kondisi_berkas'],'id_kategori_berkas','asc');
        	$data['jml_berkas'] = $this->m_member->jumlah_record_filter_berkas($data['tbl'],$data['kondisi_berkas']);
        	$data['ambil_imut'] = $this->m_member->ambil_logbook_berkas($data['tbl'],$data['kondisi_imut'],'id_kategori_berkas','asc');
        	$data['jml_imut'] = $this->m_member->jumlah_record_filter_berkas($data['tbl'],$data['kondisi_imut']);
        	$data['ambil_ijasah'] = $this->m_member->ambil_logbook_berkas($data['tbl'],$data['kondisi_ijasah'],'id_kategori_berkas','asc');
        	$data['jml_ijasah'] = $this->m_member->jumlah_record_filter_berkas($data['tbl'],$data['kondisi_ijasah']);
        	$data['ambil_pelatihan'] = $this->m_member->ambil_logbook_berkas($data['tbl'],$data['kondisi_pelatihan'],'id_kategori_berkas','asc');
        	$data['jml_pelatihan'] = $this->m_member->jumlah_record_filter_berkas($data['tbl'],$data['kondisi_pelatihan']);
        	$data['ambil_str'] = $this->m_member->ambil_logbook_berkas($data['tbl'],$data['kondisi_str'],'id_kategori_berkas','asc');
        	$data['jml_str'] = $this->m_member->jumlah_record_filter_berkas($data['tbl'],$data['kondisi_str']);
        }
      $this->tampil($data);
    }
    if($mode=='tabel'){
      $data['page'] =  $data['page']."_tabel";
		if($data['cek'] == 0 OR empty($data['tbl'])){
			redirect(base_url('external'));
		}
      $data['ambil_tabel'] = $this->m_external->ambil_logbook_laporan_tabel($data['id']);
			$data['id_pegawai']  = set_value('id_pegawai',$lptab["id_pegawai"]);
			$data['barcode_pegawai']  = set_value('barcode_pegawai',$lptab["barcode_pegawai"]);
			$data['id_laporan']  = set_value('id_laporan',$lptab["id_laporan"]);
			$data['id_laporan_tabel']  = set_value('id_laporan_tabel',$lptab["id_laporan_tabel"]);
			$data['id_working']  = set_value('id_working',$lptab["id_working"]);
			$data['id_instansi']  = set_value('id_instansi',$lptab["id_instansi"]);
			$data['tgl_laporan']  = set_value('tgl_laporan',date('d-m-Y', strtotime($lptab["tgl_laporan"])));
			$data['tgl_awal']  = set_value('tgl_awal',date('d-m-Y', strtotime($lptab["tgl_awal"])));
			$data['tgl_akhir']  = set_value('tgl_akhir',date('d-m-Y', strtotime($lptab["tgl_akhir"])));
			$data['header_laporan']  = set_value('header_laporan',$lptab["header_laporan"]);
			$data['sub_header_laporan']  = set_value('sub_header_laporan',$lptab["sub_header_laporan"]);
			$data['sub_sub_header_laporan']  = set_value('sub_sub_header_laporan',$lptab["sub_sub_header_laporan"]);
			$data['judul_laporan']  = set_value('judul_laporan',$lptab["judul_laporan"]);		
			$data['tujuan_laporan']  = set_value('tujuan_laporan',$lptab["tujuan_laporan"]);			
			$data['periode_laporan']  = set_value('periode_laporan',$lptab["periode_laporan"]);			
			$data['sumber_laporan']  = set_value('sumber_laporan',$lptab["sumber_laporan"]);		
			$data['judul_laporan_tabel']  = set_value('judul_laporan_tabel',$lptab["judul_laporan_tabel"]);		
			$data['analisa_laporan_tabel']  = set_value('analisa_laporan_tabel',$lptab["analisa_laporan_tabel"]);		
			$data['rekomendasi_laporan_tabel']  = set_value('rekomendasi_laporan_tabel',$lptab["rekomendasi_laporan_tabel"]);		
			$data['kompetensi']  = set_value('kompetensi',$lptab["kompetensi"]);	
			$data['kewenangan']  = set_value('kewenangan',$lptab["kewenangan"]);	
			$data['share_it']  = set_value('share_it',$lptab["share_it"]);	
			$data['idpeg']  = set_value('idpeg',$lptab["id_pegawai"]);
			$data['bahan']  = set_value('bahan',$lptab["bahan"]);		
			$data['reject']  = set_value('reject',$lptab["reject"]);		
			$data['lhu']  = set_value('lhu',$lptab["lhu"]);		
			$data['tabel']  = set_value('tabel',$lptab["tabel"]);		
      	if(empty($lp["min_laporan_tabel"])){
      		$data['min_laporan_tabel'] = '0';
      	}else{
      		$data['min_laporan_tabel'] = $lp["min_laporan_tabel"];
      	}
      	if(empty($lp["max_laporan_tabel"])){
      		$data['max_laporan_tabel'] = '0';
      	}else{
      		$data['max_laporan_tabel'] = $lp["max_laporan_tabel"];
      	}
			$data['show_pdf']  = set_value('show_pdf',$lptab["show_pdf"]);		
			$data['berkasere']  = set_value('berkasere',$lptab["berkas"]);		
			$data['urutan_laporan_tabel']  = set_value('urutan_laporan_tabel',$lptab["urutan_laporan_tabel"]);	
//=========================================================================== LHU 1
        if($data['lhu'] == 1 OR $lptab['tabel'] == 1 OR empty($lptab['kompetensi'])){ // 1kompetensi-2bakhp-3reject-4lhu
        //	$data['ambil_lhu'] = $this->m_member->ambil_lhu_logbook($data['tbl']);
        	$select_logbook = "*";
        	$kondisi_logbook = array('ol.id_logbooker'=>$lptab['id_pegawai']);
        	$data['ambil_lhu'] = $this->m_external->ambil_lhu_logbook($data['tbl'],$select_logbook,$kondisi_logbook,'ol.tgl_logbook');
        	$data['ambil_bulan'] = $this->m_member->ambil_bulan_laporan_logbook($data['tbl']);
        	$data['garis_trend'] = $this->m_member->garis_trend($data['tbl']);
        	$data['grafik_garis_opsi'] = $this->m_member->grafik_garis_opsi_logbook($data['tbl']);
        	$data['ambil_limbah_grafik'] = $this->m_member->grafik_garis_opsi_logbook2($data['tbl'],$lptab["kewenangan"]);

if($data['kewenangan'] == 1){
$data['select2'] = ("ol_logbook.id_kewenangan  as id_lhu,sum(jml_logbook) as hasil_lhu_detil,tgl_logbook as tgl_lhu,nama_kewenangan as nama_lhu");
$data['grup2'] = "ol_logbook.id_kewenangan";
}else{
$data['select2'] = ("nkr_kewenangan.id_kompetensi  as id_lhu,sum(jml_logbook) as hasil_lhu_detil,tgl_logbook as tgl_lhu,nama_kompetensi as nama_lhu"); 
$data['grup2'] = "nkr_kewenangan.id_kompetensi";
}
$data['tabel1'] = 'ol_logbook';
$data['group1'] = 'MONTH(tgl_logbook)';
$data['grtgl'] = 'tgl_logbook';
$data['jumlah'] = 'jml_logbook >';
$data['konbln'] = array('id_logbooker'=>$data['id_pegawai'],$data['jumlah']=>0,'id_instansi'=>$data['id_instansi']);  
$grup2 = 'MONTH(tgl_logbook)';
$kondisi2 = array('tgl_logbook >='=>$lptab["tgl_awal"],'tgl_logbook <='=>$lptab["tgl_akhir"],'jml_logbook >'=>0,'id_logbooker'=>$data['id_pegawai'],'id_instansi'=>$data['id_instansi']);
        }
        if($data['lhu'] == 2){
        	$data['ambil_lhu'] = $this->m_member->ambil_data_bakhp($data['tbl'],'olpk.id_bahan','jml_bahan');
        	$data['ambil_bulan'] = $this->m_member->ambil_data_bulan_bakhp($data['tbl'],'olpk.id_bahan','jml_bahan');
        	$data['grafik_garis_opsi'] = $this->m_member->grafik_garis_opsi_pakai($data['tbl'],'olpk.id_bahan','jml_bahan','nama_bahan');
        	$data['ambil_limbah_grafik'] = $this->m_member->grafik_garis_opsi_pakai($data['tbl'],'olpk.id_bahan','jml_bahan','nama_bahan','olpk.id_bahan');

$data['tabel1'] = 'ol_logbook_pakai';
$data['group1'] = 'MONTH(tgl_logbook)';
$data['jumlah'] = 'jml_bahan >';
$data['konbln'] = array('id_logbooker'=>$data['id_pegawai'],$data['jumlah']=>0,'id_instansi'=>$data['id_instansi']);  
$data['select2'] = ("ol_bahan.in_bahan  as id_lhu,sum(jml_bahan) as hasil_lhu_detil,tgl_logbook as tgl_lhu,nama_bahan as nama_lhu"); 
$data['grup2'] = "ol_logbook_pakai.id_bahan";
        }
        if($data['lhu'] == 3){
        	$data['ambil_lhu'] = $this->m_member->ambil_data_reject($data['tbl'],'olpk.id_reject','jml_reject');
        	$data['ambil_bulan'] = $this->m_member->ambil_data_bulan_reject($data['tbl'],'olpk.id_reject','jml_reject');
        	$data['grafik_garis_opsi'] = $this->m_member->grafik_garis_opsi_reject($data['tbl'],'olpk.id_reject','jml_reject','nama_reject');
        	$data['ambil_limbah_grafik'] = $this->m_member->grafik_garis_opsi_reject($data['tbl'],'olpk.id_reject','jml_reject','nama_reject','olpk.id_reject');

$data['tabel1'] = 'ol_logbook_reject';
$data['group1'] = 'MONTH(tgl_logbook)';
$data['grtgl'] = 'tgl_logbook';
$data['grtgl'] = 'tgl_logbook';
$data['jumlah'] = 'jml_reject >';
$data['konbln'] = array('id_logbooker'=>$data['id_pegawai'],$data['jumlah']=>0,'id_instansi'=>$data['id_instansi']);  
$data['select2'] = ("ol_logbook_reject.id_reject  as id_lhu,sum(jml_reject) as hasil_lhu_detil,tgl_logbook as tgl_lhu,nama_reject as nama_lhu"); 
$data['grup2'] = "ol_logbook_reject.id_reject";
        }
        if($data['lhu'] == 4){
$data['selectk'] = ("*,SUM(hasil_lhu_detil) as jumlaha,olp.id_item_lhu as id_kompetensi,concat(nama_item_lhu,' - ',nama_equipment) as nama_kompetensi");
$data['select_lhu'] = ("*,hasil_lhu_detil as jml_logbook,olp.id_item_lhu as id_lhu,concat(nama_item_lhu,' - ',nama_equipment) as nama_lhu");
        		$select_lhu = ("*,hasil_lhu_detil as jml_logbook,olp.id_item_lhu as id_lhu,concat(nama_item_lhu,' - ',nama_equipment) as nama_lhu");
        		$data['select_jscode'] = ("olp.id_item_lhu as id_lhu,hasil_lhu_detil");
        		$select_opsi = ("olp.id_item_lhu as id_lhu,
        			concat(nama_item_lhu,' - ',nama_equipment) as nama_lhu,
							DATE_FORMAT(tgl_lhu,'%d-%m-%Y') as tgl_lhu,hasil_lhu_detil,
							DATE_FORMAT(tgl_lhu,'%Y') as thn,
							DATE_FORMAT(tgl_lhu,'%m') as bln,
							DATE_FORMAT(tgl_lhu,'%d') as hr");
      	    $data['ambil_lhu'] = $this->m_member->ambil_universal_lhu($data['tbl'],$select_lhu);
      	    $data['ambil_bulan'] = $this->m_member->ambil_universal_bulan_lhu($data['tbl'],$data['select_lhu']);
      	    $data['grafik_garis_opsi'] = $this->m_member->grafik_garis_opsi_lhu($data['tbl'],$select_opsi);
      	    $data['ambil_limbah_grafik'] = $this->m_member->grafik_garis_opsi_lhu($data['tbl'],$select_opsi,'olp.id_item_lhu');

$data['tabel1'] = 'ol_logbook_lhu_detil';
$data['group1'] = 'MONTH(tgl_lhu)';
$data['grtgl'] = 'tgl_lhu';
$data['jumlah'] = 'hasil_lhu_detil >';
$data['konbln'] = array('barcode_pegawai'=>$data['barcode_pegawai'],$data['jumlah']=>0,'id_instansi'=>$data['id_instansi']);
$data['select2'] = ("ol_logbook_item_lhu.in_item_lhu  as id_lhu,sum(hasil_lhu_detil) as hasil_lhu_detil,tgl_lhu,concat(nama_item_lhu,' - ',nama_equipment) as nama_lhu"); 
$data['grup2'] = "ol_logbook_lhu_detil.id_item_lhu";
        }
        if($data['lhu'] == 5){
        		$select_lhu = ("*,count(id_daftar) as jml_logbook,td.id_tindakan as id_lhu,concat(nama_tindakan,' - ',nama_golongan_pemeriksaan) as nama_lhu");
        $data['select_lhu'] = ("*,count(id_daftar) as jml_logbook,td.id_tindakan as id_lhu,concat(nama_tindakan,' - ',nama_golongan_pemeriksaan) as nama_lhu");
        		$data['select_jscode'] = ("td.id_tindakan as id_lhu,count(id_daftar) as hasil_lhu_detil");
        		$select_opsi = ("td.id_tindakan as id_lhu,
        			concat(nama_tindakan,' - ',nama_golongan_pemeriksaan) as nama_lhu,
							DATE_FORMAT(tgl_daftar,'%d-%m-%Y') as tgl_daftar,count(id_daftar) as hasil_lhu_detil,
							DATE_FORMAT(tgl_daftar,'%Y') as thn,
							DATE_FORMAT(tgl_daftar,'%m') as bln,
							DATE_FORMAT(tgl_daftar,'%d') as hr");
      	    $data['ambil_lhu'] = $this->m_member->ambil_daftar_tindakan_lhu($data['tbl'],$select_lhu);
      	    $data['ambil_bulan'] = $this->m_member->ambil_tindakan_daftar_bulan_lhu($data['tbl'],$data['select_lhu']);
      	    $data['grafik_garis_opsi'] = $this->m_member->grafik_garis_tindakan_daftar_lhu($data['tbl'],$select_opsi);
      	    $data['ambil_limbah_grafik'] = $this->m_member->grafik_garis_tindakan_daftar_lhu($data['tbl'],$select_opsi,'t.id_tindakan');

$data['tabel1'] = 'tindakan_daftar';
$data['group1'] = 'MONTH(tgl_daftar)';
$data['grtgl'] = 'tgl_daftar';
$data['konbln'] = array('id_instansi'=>$data['id_instansi']);
$data['select2'] = ("tindakan.in_tindakan  as id_lhu,count(id_daftar) as hasil_lhu_detil,tgl_daftar as tgl_lhu,concat(nama_tindakan,' - ',nama_golongan_pemeriksaan) as nama_lhu");
$data['grup2'] = "tindakan_daftar.id_tindakan";
        }
        if($data['lhu'] == 7){
$data['slct_range'] = ("*,
id_berkas as id_lhu,count(id_berkas) as hasil_lhu_detil,
				if (nama_kategori_pelatihan IS NULL or nama_kategori_pelatihan = '' ,SUM(case when nama_kategori_pelatihan IS NULL or nama_kategori_pelatihan = '' then 1 else 0 end),SUM(case when nama_kategori_pelatihan IS NOT NULL or nama_kategori_pelatihan <> '' then 1 else 0 end)) as total,
				if(nama_kategori_pelatihan IS NULL or nama_kategori_pelatihan = '','Bukan Kategori Pelatihan',nama_kategori_pelatihan) as nama_lhu,
				DATE_FORMAT(tgl_b_berkas,'%d-%m-%Y') as tgl_lhu,
				DATE_FORMAT(tgl_b_berkas,'%Y') as thn,
				DATE_FORMAT(tgl_b_berkas,'%m') as bln,
				DATE_FORMAT(tgl_b_berkas,'%d') as hr
	");
$data['slct_tr'] = ("*,id_berkas as id_lhu,count(id_berkas) as hasil_lhu_detil,if(nama_kategori_pelatihan IS NULL or nama_kategori_pelatihan = '','Bukan Kategori Pelatihan',nama_kategori_pelatihan) as nama_lhu,DATE_FORMAT(tgl_b_berkas,'%d-%m-%Y') as tgl_lhu
	");
$data['kon_tr'] = array('status_berkas'=>1);
    	    $data['ambil_range'] = $this->m_member->ambil_berkas_laporan($data['tbl'],$data['slct_tr'],$data['kon_tr']);
    	    $data['ambil_lhu'] = $this->m_member->ambil_berkas_laporan($data['tbl'],$data['slct_tr'],$data['kon_tr']);
    	    $data['ambil_bulan'] = $this->m_member->ambil_berkas_laporan($data['tbl'],$data['slct_tr'],$data['kon_tr']);

        	$data['kondisi_berkas'] = array('id_kategori_berkas >'=>13,'link_berkas !='=>'','status_berkas'=>1);
        	$data['kondisi_imut'] = array('id_kategori_berkas'=>12,'link_berkas !='=>'','status_berkas'=>1);
        	$data['kondisi_ijasah'] = array('id_kategori_berkas'=>7,'link_berkas !='=>'','status_berkas'=>1);
        	$data['kondisi_pelatihan'] = array('kunci'=>1,'link_berkas !='=>'','status_berkas'=>1);
        	$data['kondisi_str'] = array('kunci'=>0,'link_berkas !='=>'','status_berkas'=>1);
        	$data['ambil_berkas'] = $this->m_member->ambil_logbook_berkas($data['tbl'],$data['kondisi_berkas'],'id_kategori_berkas','asc');
        	$data['jml_berkas'] = $this->m_member->jumlah_record_filter_berkas($data['tbl'],$data['kondisi_berkas']);
        	$data['ambil_imut'] = $this->m_member->ambil_logbook_berkas($data['tbl'],$data['kondisi_imut'],'id_kategori_berkas','asc');
        	$data['jml_imut'] = $this->m_member->jumlah_record_filter_berkas($data['tbl'],$data['kondisi_imut']);
        	$data['ambil_ijasah'] = $this->m_member->ambil_logbook_berkas($data['tbl'],$data['kondisi_ijasah'],'id_kategori_berkas','asc');
        	$data['jml_ijasah'] = $this->m_member->jumlah_record_filter_berkas($data['tbl'],$data['kondisi_ijasah']);
        	$data['ambil_pelatihan'] = $this->m_member->ambil_logbook_berkas($data['tbl'],$data['kondisi_pelatihan'],'id_kategori_berkas','asc');
        	$data['jml_pelatihan'] = $this->m_member->jumlah_record_filter_berkas($data['tbl'],$data['kondisi_pelatihan']);
        	$data['ambil_str'] = $this->m_member->ambil_logbook_berkas($data['tbl'],$data['kondisi_str'],'id_kategori_berkas','asc');
        	$data['jml_str'] = $this->m_member->jumlah_record_filter_berkas($data['tbl'],$data['kondisi_str']);
        }
      $this->tampil($data);
    }
		if($mode=='pdf_logbook'){
	    $report = $this->load->view('cetak/ol_logbook_laporan', $data, TRUE);
		  $filename = date('dmYHis').$lptab['id_laporan'].$lptab['id_laporan_tabel'].'-laporan-'.$lptab['nama_pegawai']."-logbook.pdf";
	//    $mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'L','margin_left' => '5','margin_right' => '5','margin_top' => '5','margin_bottom' => '5']);
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->AddPage('L', '', '', '', 2, 5, 5, 5, 10, 3, 3);
		  $mpdf->SetDisplayMode('fullpage');
		//  $mpdf->SetFooter('Page : {PAGENO}');
		  $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
			for ($i = 1; $i > 2; $i++) {
		  $mpdf->SetHTMLFooter('');
			}		  
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
  }
  function anjababk($mode='view')
  {
		$data['page']  = "anjababk";
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$data['header'] = $instansi["nama_instansi"];
		$data['title'] = "LAPORAN INDIKATOR MUTU PERSONAL";
		$data['instance_status'] = $instansi["status_instansi"];
		$data['instance_id'] = $instansi["id_instansi"];
		$data['instance_name'] = $instansi["nama_instansi"];
		$data['idescription'] = $instansi["description"];
		$data['ikeywords'] = $instansi["keywords"];
		$data['iheader'] = $instansi["header"];
		$data['iheader_mini'] = $instansi["header_mini"];
		$data['ifooter'] = $instansi["footer"];
		$data['ilicensed'] = $instansi["licensed"];
		$data['iconik'] = $instansi["icon"];
		$data['surveyor'] = '1';
		$data['member_name'] = 'WELCOME USER';
		$data['level_name'] = 'SURVEYOR';
		$data['photo'] = base_url().'assets/images/noavatar.jpg';
		$data['id'] = $this->uri->segment(4, 0);
		$data['tbl'] = $this->uri->segment(5, 0);
		$kondisi_cek = array('p_abk_detil.id_abk_detil'=>$data['tbl'],'p_abk_detil.id_abk'=>$data['id']);
		$data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('p_abk_detil',$kondisi_cek,'p_abk','id_abk');
		if($data['cek'] == 0 OR empty($data['tbl'])){
			redirect(base_url('external'));
		}		
		$injabdet = $this->m_anjababk->ambil_injab_detil($data['tbl']);	
		$data['ambil_anjab'] = $this->m_anjababk->ambil_all_abk_e($injabdet["periode"],$injabdet["id_unit"]);		
		$data['aheader'] = set_value('aheader',$injabdet["header"]);
		$data['sub_header'] = set_value('sub_header',$injabdet["sub_header"]);
		$data['sub_sub_header'] = set_value('sub_sub_header',$injabdet["sub_sub_header"]);
		$data['header_pemenuhan'] = set_value('header_pemenuhan',$injabdet["header_pemenuhan"]);
		$data['sub_header_pemenuhan'] = set_value('sub_header_pemenuhan',$injabdet["sub_header_pemenuhan"]);
		$data['sub_sub_header_pemenuhan'] = set_value('sub_sub_header_pemenuhan',$injabdet["sub_sub_header_pemenuhan"]);
		$data['header_realisasi'] = set_value('header_realisasi',$injabdet["header_realisasi"]);
		$data['sub_header_realisasi'] = set_value('sub_header_realisasi',$injabdet["sub_header_realisasi"]);
		$data['sub_sub_header_realisasi'] = set_value('sub_sub_header_realisasi',$injabdet["sub_sub_header_realisasi"]);
		$data['id_abk'] = set_value('id_abk',$injabdet["id_abk"]);
		$data['id_abk_detil'] = set_value('id_abk_detil',$injabdet["id_abk_detil"]);
		$data['periode'] = set_value('periode',date('Y',strtotime($injabdet["periode"])));
		$data['nama_unit'] = set_value('nama_unit',$injabdet["nama_unit"]);
		$data['nama_working'] = set_value('nama_working',$injabdet["nama_working"]);
		$data['nama_jabatan_fungsional'] = set_value('nama_jabatan_fungsional',$injabdet["nama_jabatan_fungsional"]);
		$data['nama_struktur_jabatan'] = set_value('nama_struktur_jabatan',$injabdet["nama_struktur_jabatan"]);
		$data['iktisar_jabatan'] = set_value('iktisar_jabatan',$injabdet["iktisar_jabatan"]);
		$data['tugas_jabatan'] = set_value('tugas_jabatan',$injabdet["tugas_jabatan"]);
		$data['pengetahuan_kerja'] = set_value('pengetahuan_kerja',$injabdet["pengetahuan_kerja"]);
		$data['ketrampilan'] = set_value('ketrampilan',$injabdet["ketrampilan"]);
		$data['pelatihan'] = set_value('pelatihan',$injabdet["pelatihan"]);
		$data['pengalaman'] = set_value('pengalaman',$injabdet["pengalaman"]);		
		$data['fungsi_kerja'] = set_value('fungsi_kerja',$injabdet["fungsi_kerja"]);		
		$data['upaya_fisik'] = set_value('upaya_fisik',$injabdet["upaya_fisik"]);		
		$data['minat_kerja'] = set_value('minat_kerja',$injabdet["minat_kerja"]);		
		$data['temperamen_kerja'] = set_value('temperamen_kerja',$injabdet["temperamen_kerja"]);		
		$data['bakat_kerja'] = set_value('bakat_kerja',$injabdet["bakat_kerja"]);		
		$data['pangkat'] = set_value('pangkat',$injabdet["pangkat"]);		
		$data['resiko_bahaya'] = set_value('resiko_bahaya',$injabdet["resiko_bahaya"]);		
		$data['kondisi_tempat_kerja'] = set_value('kondisi_tempat_kerja',$injabdet["kondisi_tempat_kerja"]);		
		$data['hubungan_jabatan'] = set_value('hubungan_jabatan',$injabdet["hubungan_jabatan"]);		
		$data['perangkat_kerja'] = set_value('perangkat_kerja',$injabdet["perangkat_kerja"]);		
		$data['bahan_kerja'] = set_value('bahan_kerja',$injabdet["bahan_kerja"]);		
		$data['hasil_kerja'] = set_value('hasil_kerja',$injabdet["hasil_kerja"]);		
		$data['tanggung_jawab'] = set_value('tanggung_jawab',$injabdet["tanggung_jawab"]);		
		$data['wewenang'] = set_value('wewenang',$injabdet["wewenang"]);		
		$data['pendidikan_formal'] = set_value('pendidikan_formal',$injabdet["pendidikan_formal"]);
		$data['perid'] = date('Y', strtotime($injabdet['periode']));
		$data['thn0'] = $this->m_anjababk->ambil_thn_pemenuhan($injabdet['id_unit'],$data['perid']+1);
		$data['thn1'] = $this->m_anjababk->ambil_thn_pemenuhan($injabdet['id_unit'],$data['perid']+2);
		$data['thn2'] = $this->m_anjababk->ambil_thn_pemenuhan($injabdet['id_unit'],$data['perid']+3);
		if(empty($data['thn0']['jml_pemenuhan'])){ $data['prsn0'] = '0'; }else{ $data['prsn0'] = $data['thn0']['jml_realisasi'] / $data['thn0']['jml_pemenuhan'] * 100;}
		if(empty($data['thn1']['jml_pemenuhan'])){ $data['prsn1'] = '0'; }else{ $data['prsn1'] = $data['thn1']['jml_realisasi'] / $data['thn1']['jml_pemenuhan'] * 100;}
		if(empty($data['thn2']['jml_pemenuhan'])){ $data['prsn2'] = '0'; }else{ $data['prsn2'] = $data['thn2']['jml_realisasi'] / $data['thn2']['jml_pemenuhan'] * 100;}
    if($mode=='abk'){
      $data['page'] =  $data['page']."_abk";
      $this->tampil($data);
    }
    if($mode=='pola'){
      $data['page'] =  $data['page']."_pola";
      $this->tampil($data);
    }
    if($mode=='evaluasi'){
      $data['page'] =  $data['page']."_evaluasi";
      $this->tampil($data);
    }
  }
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("external/header",$data);
	$this->load->view("external/isi");
	$this->load->view("footer");
	$this->load->view("external/jsload");
	$this->load->view("external/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
