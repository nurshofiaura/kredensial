<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Developer extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
          $this->load->model('m_developer');
          $this->load->model('m_ol_rancak');
          $this->load->model('m_direktur');
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
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==97 ) //developer
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
		$this->tampil($data);
	}
	function pengajuan_kompetensi($mode='view')
  {
	$data['page']  = "pengajuan_kompetensi";
	$data['header'] = "KOMPETENSI";
	$data['title'] = "KOMPETENSI";
	$data['link_kembali'] = base_url('developer');
	$data['link_awal'] = base_url('developer/pengajuan_kompetensi');
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
	$data['id'] = $this->uri->segment(4, 0);
	$data['all'] = $this->uri->segment(5, 0);
	$data['first_date'] = $this->uri->segment(6, 0);
	$data['last_date'] = $this->uri->segment(7, 0);
	if($data['first_date'] == NULL OR empty($data['first_date'])){
		$data['first_date'] = date('d-m-Y');
	}
	if($data['last_date'] == NULL OR empty($data['last_date'])){
		$data['last_date'] = date('d-m-Y');
	}
  if($mode=='view'){
	if($data['id'] == NULL OR empty($data['id'])){
		$data['id'] = "";
	}
	if($data['all'] == NULL OR empty($data['all'])){
		$data['all'] = "";
	}
		$this->tampil_top($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
      $trim_keyword   = urldecode(trim($this->input->post("id")));
			$replace_keyword   = preg_replace('/\s+/', ' ', $trim_keyword);
			$key = str_replace(' ', '-', $replace_keyword);
			redirect(base_url('developer/pengajuan_kompetensi/view/'.$key));
		}
	}
  else if($mode=='data_pengajuan'){
		echo json_encode($this->m_developer->pengajuan_kompetensi_all($data['id']));
	}
  else if($mode=='data_logbook'){
		echo json_encode($this->m_developer->logbook_all($data['id']));
	}
    else if($mode=='pemulihan'){
		echo json_encode($this->m_developer->tabel_pemulihan($data['id']));
	}
    else if($mode=='tabel_logbook'){
		if($data['id'] == NULL OR empty($data['id'])){
			$data['id'] = "0";
		}
		if($data['all'] == NULL OR empty($data['all'])){
			$data['all'] = "0";
		}
		echo json_encode($this->m_developer->tabel_logbook($data['id'],$data['all'],$data['first_date'],$data['last_date']));
	}
  else{
    if($mode=='logbook'){
      $data['page'] =  $data['page']."_logbook";
				$data['ambil_lobook_kompetensi_group_pengajuan']=$this->m_rancak->ambil_lobook_kompetensi_group_pengajuan($data['id']);
				$data['jml_komite_0']=$this->m_rancak->jumlah_record_logbook_pengajuan($data['id'],'v_komite','0');
				$data['jml_komite']=$this->m_rancak->jumlah_record_logbook_pengajuan($data['id'],'v_komite >','0');
				$data['jml_karu']=$this->m_rancak->jumlah_record_logbook_pengajuan($data['id'],'v_karu','2');
				$data['jml_kabid']=$this->m_rancak->jumlah_record_logbook_pengajuan($data['id'],'v_kabid','2');
				$data['jml_asesor']=$this->m_rancak->jumlah_record_logbook_pengajuan($data['id'],'v_asesor','2');
				$data['jumlah_record_logbook_pengajuan']=$data['jml_komite']+$data['jml_karu']+$data['jml_kabid']+$data['jml_asesor'];
				$kondisi_logbook_pengajuan=array('id_pengajuan'=>$data['id']);
				$data['jml_all_logbook_pengajuan']=$this->m_umum->jumlah_record_filter('logbook',$kondisi_logbook_pengajuan);
				if($data['jml_all_logbook_pengajuan'] == $data['jumlah_record_logbook_pengajuan']){
					$data['tampilkan_button'] = 'sama';
				}else{
					$data['tampilkan_button'] = 'taksama';
				}
				$data['ambil_berkas_data']=$this->m_rancak->ambil_all_id_berkas_data();
				$d	=$this->m_rancak->ambil_pengajuan_kompetensi($data['id']);
				$data['ambil_lobook_pemulihan']=$this->m_rancak->ambil_lobook_pemulihan($d['id_pegawai']);
				$data['id_pengajuan']  = set_value('id_pengajuan',$d["id_pengajuan"]);
				$data['id_status_diusulkan']  = set_value('id_status_diusulkan',$d["id_status_diusulkan"]);
				$data['id_berkas']  = explode(",", $d["id_berkas"]);
				$data['berkas']  = $d["id_berkas"];
				$data['tahun']  = date('Y', strtotime($d["tgl_pengajuan"]));
				$data['id_ijasah']  = explode(",", $d["id_ijasah"]);
				$data['id_str']  = explode(",", $d["id_str"]);
				$data['id_sertifikat']  = explode(",", $d["id_sertifikat"]);
				$data['kesesuaian_bukti']  = set_value('kesesuaian_bukti',explode(",", $d["kesesuaian_bukti"]));
				$data['id_etik_pegawai']  = set_value('id_etik_pegawai',explode(",", $d["id_etik_pegawai"]));
				$data['id_logbook_a']  = set_value('id_logbook_a',$d["id_logbook_a"]);
				$data['id_logbook_b']  = set_value('id_logbook_b',$d["id_logbook_b"]);
				$data['status_pengajuan']  = set_value('status_pengajuan',$d["status_pengajuan"]);
				$data['acc_kabid']  = set_value('acc_kabid',$d["acc_kabid"]);
				$data['acc_asesor']  = set_value('acc_asesor',$d["acc_asesor"]);
				$data['acc_komite']  = set_value('acc_komite',$d["acc_komite"]);
				$data['acc_direktur']  = set_value('acc_direktur',$d["acc_direktur"]);
				$data['acc_logbook_komite']  = set_value('acc_logbook_komite',$d["acc_logbook_komite"]);
				$data['id_pegawai']  = set_value('id_pegawai',$d["id_pegawai"]);
				$data['foto']  = set_value('foto',$d["foto"]);
				$data['nama_pegawai']  = set_value('nama_pegawai',$d["nama_pegawai"]);
				$data['tmp_lahir']  = set_value('tmp_lahir',$d["tmp_lahir"]);
				$data['tgl_lahir']  = set_value('tgl_lahir',$d["tgl_lahir"]);
				$data['nama_agama']  = set_value('nama_agama',$d["nama_agama"]);
				$data['nama_status_kawin']  = set_value('nama_status_kawin',$d["nama_status_kawin"]);
				$data['no_profesi']  = set_value('no_profesi',$d["no_profesi"]);
				$data['nip']  = set_value('nip',$d["nip"]);
				$data['nama_status_diusulkan'] = $d['nama_status_diusulkan'];
				$data['nama_pendidikan'] = $d['nama_pendidikan'];
				$data['no_hp'] = $d['no_hp'];
				$data['email'] = $d['email'];
				$data['nama_status_pegawai'] = $d['nama_status_pegawai'];
				$data['nama_ruangan'] = $d['nama_ruangan'];
				$data['nama_jabatan_fungsional'] = $d['nama_jabatan_fungsional'];
				$data['alamat'] = $d['alamat'];
				$data['ambil_data_etik_pegawai_oppe'] = $this->m_rancak->ambil_data_etik_pegawai_oppe($d['id_pegawai'],date('Y'));
				$this->tampil_top($data);
		}
    if($mode=='bcp'){
			if($data['id'] == NULL OR empty($data['id'])){
				$data['id'] = "0";
			}
			if($data['all'] == NULL OR empty($data['all'])){
				$data['all'] = "0";
			}
      $data['page'] =  $data['page']."_bcp";
      $data['cmd_pegawai'] = $this->m_rancak->cmd_pegawai_null_analisa();
      $data['cmd_sekarepe_dewe'] = $this->m_rancak->cmd_analisa();
      $this->tampil_top($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
	      $id   = $this->input->post("id");
	      $all   = $this->input->post("all");
	      $first_date   = $this->input->post("first_date");
	      $last_date   = $this->input->post("last_date");
				redirect(base_url('developer/pengajuan_kompetensi/bcp/'.$id.'/'.$all.'/'.$first_date.'/'.$last_date));
			}
		}
		if($mode=='pdf'){
		  $report = $this->load->view('cetak/penugasan_klinis', $data, TRUE);
		  $apk	=$this->m_rancak->ambil_pengajuan_kompetensi($data['id']);
		  $filename = "Penugasan_klinis-".$apk['nama_pegawai'].".pdf";
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
		  $mpdf->AddPage('P', '', '', '', 2, 25, 5, 5, 10, 3, 3);
		  $mpdf->SetDisplayMode('fullpage');
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->defaultheaderline = 0;
	      $mpdf->defaultfooterline = 0;
		  $mpdf->shrink_tables_to_fit = 1;
		  $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
		  for ($i = 1; $i > 2; $i++) {
			$mpdf->SetHTMLFooter('');
		  }
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
  }
}
  function lihat($mode='view')
  {
		$data['page']  = "lihat";
		$data['header'] = "TINJAU LAPORAN INDIKATOR MUTU";
		$data['title'] = "TINJAU LAPORAN INDIKATOR MUTU";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program','30');
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
		$data['id2'] = $this->uri->segment(5, 0);
		$data['id3'] = $this->uri->segment(6, 0);
		$data['id4'] = $this->uri->segment(7, 0);
		$data['id5'] = $this->uri->segment(8, 0);
		$data['id6'] = $this->uri->segment(9, 0);
		$data['ambil_data_working'] = $this->m_developer->ambil_data_rujukan_kab_working($this->session->list_working);
		$data['ambil_data_unit'] = $this->m_developer->ambil_data_rujukan_ol_unit($this->session->list_unit);
		$id_in =  array(1,3);
		$data['ambil_sn_standar_mutu'] = $this->m_developer->ambil_sn_standar_mutu($id_in);
		$data['cmd_jabatan'] = $this->m_rancak->cmd_jabatan();
	  $data['all_kah'] = array('0'=>'Range Tanggal','1'=>'Semua');
	  $data['kategori_kah'] = array('0'=>'Semua','1'=>'Sesuai Kategori');
    if($mode=='view'){
			if(empty($data['id'])){
				$data['id'] = '01-01'.date('Y');
			}
			if(empty($data['id2'])){
				$data['id2'] = date('d-m-Y');
			} 
			$this->tampil($data);  
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$first_date = $this->input->post("id");
				$last_date = $this->input->post("id2");
				$id_instansi = $this->input->post("id3");
				$id_standar_mutu = $this->input->post("id4");
				$id5 = $this->input->post("id5");  // tanggal
				$id6 = $this->input->post("id6");  // kategori
				redirect(base_url('developer/lihat/view/'.$first_date.'/'.$last_date.'/'.$id_instansi.'/'.$id_standar_mutu.'/'.$id5.'/'.$id6));
			}
		}
    else if($mode=='data'){
			if(empty($data['id'])){
				$data['id'] = '01-'.date('m-Y');
			}
			if(empty($data['id2'])){
				$data['id2'] = date('d-m-Y');
			}    	
			echo json_encode($this->m_developer->laporan_all($data['id'],$data['id2'],$data['id3'],$data['id4'],$data['id5'],$data['id6']));
		}
    else if($mode=='pie'){
			echo json_encode($this->m_developer->grafik_pie($data['id2']));
		}
    else if($mode=='pie_all'){
			echo json_encode($this->m_developer->grafik_pie_all($data['id2']));
		}
  	else{
      if($mode=='profil'){
        $data['page'] =  $data['page']."_profil";
        $lptab = $this->m_umum->ambil_data('sn_laporan','barcode_laporan',$data['id']);
        $data['ambil_sn_laporan_tabel'] = $this->m_developer->ambil_sn_laporan_tabel($data['id']);
				$data['header_profil']  = set_value('header_profil',$lptab["header_profil"]);
				$data['sub_header_profil']  = set_value('sub_header_profil',$lptab["sub_header_profil"]);
				$data['sejarah']  = set_value('sejarah',$lptab["sejarah"]);
				$data['visi_misi']  = set_value('visi_misi',$lptab["visi_misi"]);		
				$data['tujuan_fungsi']  = set_value('tujuan_fungsi',$lptab["tujuan_fungsi"]);		
				$data['struktur_organisasi']  = set_value('struktur_organisasi',$lptab["struktur_organisasi"]);		
				$data['informasi_layanan']  = set_value('informasi_layanan',$lptab["informasi_layanan"]);		
				$data['regulasi']  = set_value('regulasi',$lptab["regulasi"]);			
        $this->tampil($data);
      }
      if($mode=='galeri'){
        $data['page'] =  $data['page']."_galeri";
        $lptab = $this->m_umum->ambil_data('sn_laporan','barcode_laporan',$data['id']);
        $data['ambil_sn_laporan_tabel'] = $this->m_developer->ambil_sn_laporan_tabel($data['id']);	
				$data['galeri_laporan']  = set_value('galeri_laporan',$lptab["galeri_laporan"]);		
        $this->tampil($data);
      }
      if($mode=='laporan'){
        $data['page'] =  $data['page']."_laporan";
        $lptab = $this->m_umum->ambil_data('sn_laporan','barcode_laporan',$data['id']);
        $data['ambil_sn_laporan_tabel'] = $this->m_developer->ambil_sn_laporan_tabel($data['id']);
				$data['header_laporan']  = set_value('header_laporan',$lptab["header_laporan"]);
				$data['header_laporan']  = set_value('header_laporan',$lptab["header_laporan"]);
				$data['sub_header_laporan']  = set_value('sub_header_laporan',$lptab["sub_header_laporan"]);
				$data['sub_sub_header_laporan']  = set_value('sub_sub_header_laporan',$lptab["sub_sub_header_laporan"]);
				$data['judul_laporan']  = set_value('judul_laporan',$lptab["judul_laporan"]);
				$data['dimensi_laporan']  = set_value('dimensi_laporan',$lptab["dimensi_laporan"]);		
				$data['tujuan_laporan']  = set_value('tujuan_laporan',$lptab["tujuan_laporan"]);		
				$data['definisi_laporan']  = set_value('definisi_laporan',$lptab["definisi_laporan"]);		
				$data['dasar_laporan']  = set_value('dasar_laporan',$lptab["dasar_laporan"]);		
				$data['frekuensi_laporan']  = set_value('frekuensi_laporan',$lptab["frekuensi_laporan"]);		
				$data['periode_laporan']  = set_value('periode_laporan',$lptab["periode_laporan"]);		
				$data['numerator_laporan']  = set_value('numerator_laporan',$lptab["numerator_laporan"]);		
				$data['denominator_laporan']  = set_value('denominator_laporan',$lptab["denominator_laporan"]);		
				$data['sumber_laporan']  = set_value('sumber_laporan',$lptab["sumber_laporan"]);		
				$data['standar_laporan']  = set_value('standar_laporan',$lptab["standar_laporan"]);		
				$data['teknis_laporan']  = set_value('teknis_laporan',$lptab["teknis_laporan"]);		
				$data['tgjawab_laporan']  = set_value('tgjawab_laporan',$lptab["tgjawab_laporan"]);		
				$data['jenis_laporan']  = set_value('jenis_laporan',$lptab["jenis_laporan"]);		
				$data['satuan_laporan']  = set_value('satuan_laporan',$lptab["satuan_laporan"]);		
				$data['kriteria_laporan']  = set_value('kriteria_laporan',$lptab["kriteria_laporan"]);		
				$data['formula_laporan']  = set_value('formula_laporan',$lptab["formula_laporan"]);		
				$data['metode_laporan']  = set_value('metode_laporan',$lptab["metode_laporan"]);		
				$data['instrumen_laporan']  = set_value('instrumen_laporan',$lptab["instrumen_laporan"]);		
				$data['sampel_laporan']  = set_value('sampel_laporan',$lptab["sampel_laporan"]);		
				$data['penyajian_laporan']  = set_value('penyajian_laporan',$lptab["penyajian_laporan"]);		
        $this->tampil($data);
      }
      if($mode=='tabel'){
        $data['page'] =  $data['page']."_tabel";
        $lptab = $this->m_developer->ambil_sn_laporan_detil($data['id2']);
				$data['max_tanggal'] = $this->m_developer->max_tanggal_lhu($data['id2']);
				$data['min_tanggal'] = $this->m_developer->min_tanggal_lhu($data['id2']);
        $data['jumlah_bulan'] = $this->m_rancak->hitung_jumlah_bulan($data['min_tanggal'],$data['max_tanggal']);
				$data['max_standar'] = round($this->m_developer->max_standar_mutu($data['id2'],3));
				$min_standar = round($this->m_developer->min_standar_mutu($data['id2'],3));
				$min_range = round($this->m_developer->min_range_mutu($data['id2'],3));
				$min_hasil = round($this->m_developer->min_hasil($data['id2'],3));
				if($min_range == 0){
					$data['min_standar'] = $min_hasil - 10;
				}else{
					$data['min_standar'] = $min_range;
				}
				$data['jumlah_record_tabel_limbah_detil'] = $this->m_developer->jumlah_record_tabel_limbah_detil($data['id2']);
				$data['jumlah_record_tps'] = $this->m_developer->jumlah_record_tps($data['id2']);
				$data['jumlah_record_standar_mutu'] = $this->m_developer->jumlah_record_standar_mutu($data['id2']);
				$data['only_blnyear_lhu'] = $this->m_developer->only_blnyear_lhu($data['id2'],$data['min_tanggal'],$data['max_tanggal']);
				$data['tabel_limbah_detil'] = $this->m_developer->tabel_limbah_detil($data['id2']);
        $data['ambil_sn_laporan_tabel'] = $this->m_developer->ambil_sn_laporan_tabel($data['id']);
        $data['ambil_berkas_lhu'] = $this->m_developer->ambil_berkas_lhu($lptab["id_lhu"],$lptab["id_standar_mutu"],$lptab["tgl_awal"],$lptab["tgl_akhir"]);
        $data['count_berkas_lhu'] = $this->m_developer->count_berkas_lhu($lptab["id_lhu"],$lptab["id_standar_mutu"],$lptab["tgl_awal"],$lptab["tgl_akhir"]);
				$data['barcode_laporan_tabel']  = set_value('barcode_laporan_tabel',$lptab["barcode_laporan_tabel"]);
				$data['id_laporan_tabel']  = set_value('id_laporan_tabel',$lptab["id_laporan_tabel"]);
				$data['barcode_laporan']  = set_value('barcode_laporan',$lptab["barcode_laporan"]);
				$data['id_laporan']  = set_value('id_laporan',$lptab["id_laporan"]);		
				$data['judul_laporan_tabel']  = set_value('judul_laporan_tabel',$lptab["judul_laporan_tabel"]);		
				$data['analisa_laporan_tabel']  = set_value('analisa_laporan_tabel',$lptab["analisa_laporan_tabel"]);		
				$data['rekomendasi_laporan_tabel']  = set_value('rekomendasi_laporan_tabel',$lptab["rekomendasi_laporan_tabel"]);		
				$data['id_lhu']  = set_value('id_lhu',$lptab["id_lhu"]);		
				$data['id_sumber_emisi']  = set_value('id_sumber_emisi',$lptab["id_sumber_emisi"]);		
				$data['id_limbah']  = set_value('id_limbah',$lptab["id_limbah"]);		
				$data['urutan_laporan_tabel']  = set_value('urutan_laporan_tabel',$lptab["urutan_laporan_tabel"]);	
				$data['grafik']  = set_value('grafik',$lptab["tabel"]);	
				//-----------------------------------
        $data['jumlah_bulan'] = $this->m_rancak->hitung_jumlah_bulan($data['min_tanggal'],$data['max_tanggal']);
        $data['jumlah_bulan'] = $data['jumlah_bulan'] + 1;
				//-----------------------------------
				$data['grafik_garis_opsi'] = $this->m_developer->grafik_garis_opsi($data['id2']);
				$data['ambil_limbah_grafik'] = $this->m_developer->ambil_limbah_grafik_aza($data['id2']);
				$data['ambil_dt_limbah_grafik'] = $this->m_developer->ambil_dt_limbah_grafik($data['id2']);
				$data['grafik_batang_range'] = $this->m_developer->tabel_limbah_detil($data['id2']);
				$data['grafik_batang_range2'] = $this->m_developer->grafik_only_limbah($data['id2']);
				$data['grafik_batang_kelola'] = $this->m_developer->grafik_batang_kelola($data['id2']);
				$data['grafik_batang_range_jejer'] = $this->m_developer->grafik_batang_range_jejer($data['id2']);
        $this->tampil($data);
      }
		}
  }
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("developer/header",$data);
	$this->load->view("developer/isi");
	$this->load->view("footer");
	$this->load->view("developer/jsload");
	$this->load->view("developer/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_topol",$data);
	$this->load->view("developer/isi");
	$this->load->view("footer");
	$this->load->view("developer/jsload");
	$this->load->view("developer/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
