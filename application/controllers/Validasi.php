<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Validasi extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
          $this->load->model('m_ol_rancak');
          $this->load->model('m_kredensial');
          $this->load->model('m_ol_pengajuan');
          $this->load->model('m_validasi');
           $this->load->model('m_auth');
          $this->m_auth->login_kah();
  }
	function index(){
		$data['page']="home";
		$data['header'] = "BERANDA";
		$data['title'] = "BERANDA";
		$data['link_awal'] = base_url('validasi/pengajuan_kompetensi');
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',10);
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
		$this->pengajuan_kompetensi();
	}
    function signature($mode='view'){
        $data['page']="signature"; 
        $data['header'] = "UPLOAD SIGNATURE";
        $data['title'] = "UPLOAD SIGNATURE UNTUK KEPERLUAN PRINT OUT";
        $pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
        $data['link_awal'] = base_url('validasi');
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
        $mine = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$this->session->id_pegawai);
        $data['id_pegawai']  = set_value('id_pegawai',$mine['id_pegawai']);
        $data['ttd_pegawai']  = set_value('ttd_pegawai',$mine['ttd_pegawai']);
        $data['nama_pegawai']  = set_value('nama_pegawai',$mine['nama_pegawai']);
        $this->form_validation->set_rules('id_pegawai','id_pegawai','required');
        if ($this->form_validation->run() === FALSE){
            $this->tampil_top($data);
        }else{
            $data = array();
            $filesCount = count($_FILES['upload_Files']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['upload_File']['name'] = $_FILES['upload_Files']['name'][$i];
                $_FILES['upload_File']['type'] = $_FILES['upload_Files']['type'][$i];
                $_FILES['upload_File']['tmp_name'] = $_FILES['upload_Files']['tmp_name'][$i];
                $_FILES['upload_File']['error'] = $_FILES['upload_Files']['error'][$i];
                $_FILES['upload_File']['size'] = $_FILES['upload_Files']['size'][$i];
                $uploadPath = 'assets/berkas/im/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'png|jpg|jpeg';
                $config['encrypt_name'] = TRUE;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $id_pegawai = $this->input->post('id_pegawai');
                $user_pic=$this->m_umum->ambil_data('ol_pegawai','id_pegawai',$id_pegawai);
                $cek_file=FCPATH.'assets/berkas/im/'.$user_pic['ttd_pegawai'];
                if(file_exists($cek_file)){
                    unlink(FCPATH."assets/berkas/im/".$user_pic['ttd_pegawai']);
                }
                if($this->upload->do_upload('upload_File')){
                    $fileData = $this->upload->data();
                    $this->m_validasi->edit_signature_pegawai($fileData['file_name']);
                    $this->session->set_flashdata('sukses', 'Data berhasil Di Upload');
                    redirect(base_url('validasi'));
                }else{
                    $this->session->set_flashdata('danger', 'Tidak Ada Data Terupload');
                    redirect(base_url('validasi'));
                }
            }
        }
    }
	function pengajuan_kompetensi($mode='view'){
		$data['page']="pengajuan_kompetensi"; 
		$data['header'] = "DATA PENGAJUAN KOMPETENSI";
		$data['title'] = "DATA PENGAJUAN KOMPETENSI";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',10);
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
		$data['id']   = $this->uri->segment(4, 0);
		$data['id2']   = $this->uri->segment(5, 0);
		$data['id3']   = $this->uri->segment(6, 0);
		$data['isi']   = $this->uri->segment(7, 0);
		$data['tolak']   = $this->uri->segment(8, 0);
		$data['ik']   = $this->uri->segment(9, 0);
		$data['il']   = $this->uri->segment(10, 0);
		$data['ip']   = $this->uri->segment(11, 0);
		if(empty($data['id'])){
			$data['id'] = "";
		}
		if(empty($data['id2'])){
			$data['id2'] = "";
		}
		if($mode=='view'){
			$this->tampil_top($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
	      $id   = $this->input->post("id");
	      $trim_keyword   = urldecode(trim($this->input->post("id")));
				$replace_keyword   = preg_replace('/\s+/', ' ', $trim_keyword);
				$key = str_replace(' ', '-', $replace_keyword);
				redirect(base_url('validasi/pengajuan_kompetensi/view/'.$key));
			}
		}
		else if($mode=='data'){
			echo json_encode($this->m_validasi->pengajuan_kompetensi_all($data['id']));
		}
    else if($mode=='logbook'){
		echo json_encode($this->m_validasi->tabel_logbook($data['id']));
		}
    else if($mode=='link_kompetensi'){
		echo json_encode($this->m_validasi->table_link_kompetensi($data['id']));
		}
		else{
    if($mode=='pdf_rkk'){
        $apk = $this->m_kredensial->ambil_pengajuan_kompetensi($data['id']);
        $data['id_pengajuan']  = set_value('id_pengajuan',$apk['id_pengajuan']);
        $report = $this->load->view('cetak/ol_logbook_rkk', $data, TRUE);
        $filename = $data['header'].".pdf";
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
        $mpdf->AddPage('P', '', '', '', 2, 5, 5, 5, 10, 3, 3);
        $mpdf->SetTitle($data['header']);
        $mpdf->SetAuthor($data['instance_name']);
        $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
        //$mpdf->SetFooter('Page : {PAGENO}');
        ini_set("pcre.backtrack_limit", "5000000");
        $mpdf->WriteHTML($report);
        $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
      }
    if($mode=='pdf_logbook'){
        $apk = $this->m_kredensial->ambil_pengajuan_kompetensi($data['id']);
        $data['id_pengajuan']  = set_value('id_pengajuan',$apk['id_pengajuan']);
        $report = $this->load->view('cetak/ol_logbook_pengajuan', $data, TRUE);
        $filename = $data['header'].".pdf";
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
        $mpdf->AddPage('P', '', '', '', 2, 5, 5, 5, 10, 3, 3);
        $mpdf->SetTitle($data['header']);
        $mpdf->SetAuthor($data['instance_name']);
        $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
        //$mpdf->SetFooter('Page : {PAGENO}');
        ini_set("pcre.backtrack_limit", "5000000");
        $mpdf->WriteHTML($report);
        $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
      }
    if($mode=='pdf_permohonan'){
        $apk = $this->m_kredensial->ambil_pengajuan_kompetensi($data['id']);
        $data['id_pengajuan']  = set_value('id_pengajuan',$apk['id_pengajuan']);
        $report = $this->load->view('cetak/ol_permohonan', $data, TRUE);
        $filename = date('YmdHis') .'-'. $apk['nip'] .'-'. $apk['nama_pegawai']."-form-1.pdf";
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
        $mpdf->AddPage('P', '', '', '', 2, 5, 5, 5, 10, 3, 3);
        $mpdf->SetTitle($data['header']);
        $mpdf->SetAuthor($data['instance_name']);
       // $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
        $mpdf->SetFooter('Page : {PAGENO}');
        ini_set("pcre.backtrack_limit", "5000000");
        $mpdf->WriteHTML($report);
        $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
      }
    if($mode=='pdf_mandiri'){
        $apk = $this->m_kredensial->ambil_pengajuan_kompetensi($data['id']);
        $data['id_pengajuan']  = set_value('id_pengajuan',$apk['id_pengajuan']);
        $report = $this->load->view('cetak/ol_mandiri', $data, TRUE);
        $filename = date('YmdHis') .'-'. $apk['nip'] .'-'. $apk['nama_pegawai']."-form-2.pdf";
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
        $mpdf->AddPage('P', '', '', '', 2, 5, 5, 5, 10, 3, 3);
        $mpdf->SetTitle($data['header']);
        $mpdf->SetAuthor($data['instance_name']);
       // $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
        $mpdf->SetFooter('Page : {PAGENO}');
        ini_set("pcre.backtrack_limit", "5000000");
        $mpdf->WriteHTML($report);
        $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
      }
    if($mode=='pdf_rencana'){
        $apk = $this->m_kredensial->ambil_pengajuan_kompetensi($data['id']);
        $data['id_pengajuan']  = set_value('id_pengajuan',$apk['id_pengajuan']);
        $report = $this->load->view('cetak/ol_rencana', $data, TRUE);
        $filename = date('YmdHis') .'-'. $apk['nip'] .'-'. $apk['nama_pegawai']."-form-3.pdf";
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
        $mpdf->AddPage('P', '', '', '', 2, 5, 5, 5, 10, 3, 3);
        $mpdf->SetTitle($data['header']);
        $mpdf->SetAuthor($data['instance_name']);
       // $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
        $mpdf->SetFooter('Page : {PAGENO}');
        ini_set("pcre.backtrack_limit", "5000000");
        $mpdf->WriteHTML($report);
        $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
      }
    if($mode=='pdf_observasi'){
        $apk = $this->m_kredensial->ambil_pengajuan_kompetensi($data['id']);
        $data['id_pengajuan']  = set_value('id_pengajuan',$apk['id_pengajuan']);
        $report = $this->load->view('cetak/ol_observasi', $data, TRUE);
        $filename = date('YmdHis') .'-'. $apk['nip'] .'-'. $apk['nama_pegawai']."-form-4A.pdf";
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
        $mpdf->AddPage('P', '', '', '', 2, 5, 5, 5, 10, 3, 3);
        $mpdf->SetTitle($data['header']);
        $mpdf->SetAuthor($data['instance_name']);
       // $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
        $mpdf->SetFooter('Page : {PAGENO}');
        ini_set("pcre.backtrack_limit", "5000000");
        $mpdf->WriteHTML($report);
        $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
      }
    if($mode=='pdf_lisan'){
        $apk = $this->m_kredensial->ambil_pengajuan_kompetensi($data['id']);
        $data['id_pengajuan']  = set_value('id_pengajuan',$apk['id_pengajuan']);
        $report = $this->load->view('cetak/ol_lisan', $data, TRUE);
        $filename = date('YmdHis') .'-'. $apk['nip'] .'-'. $apk['nama_pegawai']."-form-4B.pdf";
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
        $mpdf->AddPage('P', '', '', '', 2, 5, 5, 5, 10, 3, 3);
        $mpdf->SetTitle($data['header']);
        $mpdf->SetAuthor($data['instance_name']);
       // $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
        $mpdf->SetFooter('Page : {PAGENO}');
        ini_set("pcre.backtrack_limit", "5000000");
        $mpdf->WriteHTML($report);
        $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
      }
    if($mode=='pdf_tulis'){
        $apk = $this->m_kredensial->ambil_pengajuan_kompetensi($data['id']);
        $data['id_pengajuan']  = set_value('id_pengajuan',$apk['id_pengajuan']);
        $report = $this->load->view('cetak/ol_tulis', $data, TRUE);
        $filename = date('YmdHis') .'-'. $apk['nip'] .'-'. $apk['nama_pegawai']."-form-4C.pdf";
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
        $mpdf->AddPage('P', '', '', '', 2, 5, 5, 5, 10, 3, 3);
        $mpdf->SetTitle($data['header']);
        $mpdf->SetAuthor($data['instance_name']);
       // $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
        $mpdf->SetFooter('Page : {PAGENO}');
        ini_set("pcre.backtrack_limit", "5000000");
        $mpdf->WriteHTML($report);
        $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
      }
    if($mode=='pdf_portofolio'){
        $apk = $this->m_kredensial->ambil_pengajuan_kompetensi($data['id']);
        $data['id_pengajuan']  = set_value('id_pengajuan',$apk['id_pengajuan']);
        $report = $this->load->view('cetak/ol_portofolio', $data, TRUE);
        $filename = $data['header'].".pdf";
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
        $mpdf->AddPage('P', '', '', '', 2, 5, 5, 5, 10, 3, 3);
        $mpdf->SetTitle($data['header']);
        $mpdf->SetAuthor($data['instance_name']);
        $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
        //$mpdf->SetFooter('Page : {PAGENO}');
        ini_set("pcre.backtrack_limit", "5000000");
        $mpdf->WriteHTML($report);
        $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
      }
    if($mode=='pdf_pasien'){
        $apk = $this->m_kredensial->ambil_pengajuan_kompetensi($data['id']);
        $data['kode_unit_pengajuan']  = set_value('kode_unit_pengajuan',$apk['kode_unit_pengajuan']);
        $data['id_instansi']  = set_value('id_instansi',$apk['id_instansi']);
        $data['id_pegawai']  = set_value('id_pegawai',$apk['id_pegawai']);
      $report = $this->load->view('cetak/ol_logbook_pasien_validasi', $data, TRUE);
      $namaku = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$apk['id_pegawai']);
      $filename = date('dmYHis').'-bcp-'.$namaku['nama_pegawai']."-bcp-pasien.pdf";
  //    $mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'L','margin_left' => '5','margin_right' => '5','margin_top' => '5','margin_bottom' => '5']);
  //    $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
// Define a default Landscape page size/format by name
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
// Define a default page size/format by array - page will be 190mm wide x 236mm height
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [190, 236]]);
// Define a default page using all default values except "L" for Landscape orientation
$mpdf = new \Mpdf\Mpdf(['orientation' => 'P']);
      $mpdf->SetTitle($data['header']);
      $mpdf->SetAuthor($data['instance_name']);
      $mpdf->AddPage('P', '', '', '', 2, 5, 5, 5, 0, 0, 0);
      $mpdf->SetDisplayMode('fullpage');
     // $mpdf->SetFooter('Page : {PAGENO}');
    //  $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
      $mpdf->SetHTMLFooter('<div style="text-align: center">{PAGENO}</div>');
      for ($i = 1; $i > 2; $i++) {
      $mpdf->SetHTMLFooter('');
      }     
      ini_set("pcre.backtrack_limit", "5000000");
      $mpdf->WriteHTML($report);
      $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
    }
      if($mode=='rkk'){
        $data['page'] =  $data['page']."_rkk";
   $data['rkk'] = $this->m_rancak->cmd_status_rkk();
   $data['sifat_kewenangan'] = $this->m_ol_rancak->cmd_sifat_kewenangan();
        $apk = $this->m_kredensial->ambil_pengajuan_kompetensi($data['id']);
        $data['barcode_pegawai']  = $apk["barcode_pegawai"];
        $data['id_sifat_kewenangan']  = set_value('id_sifat_kewenangan',$data['id3']);
        $data['status_rkk']  = set_value('status_rkk',$data['id2']);
        $this->load->view("validasi/isi",$data);
      }
      if($mode=='simpan_rkk'){
        $barcode_pengajuan=$this->input->post('barcode_pengajuan');
        $id_kewenangan=$this->input->post('id_kewenangan');
        $barcode_pegawai=$this->input->post('barcode_pegawai');
        $kondisi=array('id_kewenangan'=>$id_kewenangan,'barcode_pegawai'=>$barcode_pegawai);
        $jml = $this->m_umum->jumlah_record_filter('ol_rkk',$kondisi);
        if($jml == 0){
          if($this->m_validasi->simpan_rkk()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
            redirect(base_url('validasi/pengajuan_kompetensi/portofolio/'.$barcode_pengajuan));
          }else{
            $this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data');
            redirect(base_url('validasi/pengajuan_kompetensi/portofolio/'.$barcode_pengajuan));
          } 
        }else{
          if($this->m_validasi->edit_rkk()){
            $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
            redirect(base_url('validasi/pengajuan_kompetensi/portofolio/'.$barcode_pengajuan));
          }else{
            $this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data');
            redirect(base_url('validasi/pengajuan_kompetensi/portofolio/'.$barcode_pengajuan));
          } 
        }
      }
// =================================================== BERANDA
      if($mode=='beranda'){
        $data['page'] =  $data['page']."_beranda";
				$apk = $this->m_kredensial->ambil_pengajuan_kompetensi($data['id']);
				$jml = $this->m_kredensial->cek_num_pengajuan_validator($data['id'],$this->session->id_pegawai);
				if ( $this->session->has_userdata('id_level') && $this->session->userdata('id_level')==99 ){

				}else{
					if($jml == 0 OR $apk['status_pengajuan'] == 0){
							$this->session->set_flashdata('danger', 'Bukan Validator Form ini / Status Belum Terkirim');
							redirect(base_url('validasi/pengajuan_kompetensi'));
					}
				}
			
$kondisi_form=array('barcode_pengajuan'=>$data['id'],'id_asesor'=>$this->session->id_pegawai);
$ambil_nkr_formnya = $this->m_umum->ambil_data_kondisi('nkr_pengajuan_validator',$kondisi_form);
$kondisi_kompetensi=array('status_jenis_form'=>1,'display_asesor'=>1,'npv.barcode_pengajuan'=>$data['id'],'id_asesor'=>$this->session->id_pegawai);
$data['ambil_link'] = $this->m_umum->ambil_data_explode('kol_jenis_form','id_jenis_form',$ambil_nkr_formnya['nkr_form']);
				
				$data['ambil_berkas_data']=$this->m_ol_rancak->ambil_id_berkas_data($apk['id_pegawai']);
				$data['kembali'] = base_url('validasi/pengajuan_kompetensi');				
				$data['foto']  = set_value('foto',$apk["foto"]);
				$data['nama_pegawai']  = set_value('nama_pegawai',$apk["nama_pegawai"]);
				$data['id_pengajuan']  = set_value('id_pengajuan',$apk["id_pengajuan"]);
    $data['id_pegawai']  = set_value('id_pegawai',$apk["id_pegawai"]);
				$data['id_instansi']  = set_value('id_instansi',$apk["id_instansi"]);
				$data['jk']  = set_value('jk',$apk["jk"]);
				$data['tgl_lahir']  = set_value('tgl_lahir', date('d-m-Y',strtotime($apk["tgl_lahir"])));
				$data['tmp_lahir']  = set_value('tmp_lahir',$apk["tmp_lahir"]);
				$data['umur']  = set_value('umur',$apk["umur"]);
				$data['nama_status_kawin']  = set_value('nama_status_kawin',$apk["nama_status_kawin"]);
				$data['nama_agama']  = set_value('nama_agama',$apk["nama_agama"]);
				$data['nama_jabatan_fungsional']  = set_value('nama_jabatan_fungsional',$apk["nama_jabatan_fungsional"]);
				$data['nama_status_pegawai']  = set_value('nama_status_pegawai',$apk["nama_status_pegawai"]);
				$data['nip']  = set_value('nip',$apk["nip"]);
				$data['nama_pendidikan']  = set_value('nama_pendidikan',$apk["nama_pendidikan"]);
				$data['no_profesi']  = set_value('no_profesi',$apk["no_profesi"]);
				$data['no_hp']  = set_value('no_hp',$apk["no_hp"]);
				$data['email']  = set_value('email',$apk["email"]);
				$data['alamat']  = set_value('alamat',$apk["alamat"]);
				$data['nama_status_diusulkan']  = set_value('nama_status_diusulkan',$apk["nama_status_diusulkan"]);
				$data['id_berkas']  = explode(",", $apk["id_berkas"]);
				$data['berkas']  = $apk["id_berkas"];
				$data['id_ijasah']  = explode(",", $apk["id_ijasah"]);
				$data['ijasah']  = $apk["id_ijasah"];
				$data['id_str']  = explode(",", $apk["id_str"]);
				$data['str']  = $apk["id_str"];
				$data['id_sertifikat']  = explode(",", $apk["id_sertifikat"]);
				$data['sertifikat']  = $apk["id_sertifikat"];
        $data['kode_unit_pengajuan']  = $apk["kode_unit_pengajuan"];
        $data['nama_kompetensi']  = $apk["nama_kompetensi"];
				$data['id_etik_pegawai']  = explode(",", $apk["id_etik_pegawai"]);
				$data['ambil_data_etik_pegawai_oppe'] = $this->m_ol_rancak->ambil_data_etik_pegawai_oppe($apk["id_pegawai"],date('Y'));
				$data['ambil_lobook_kompetensi_group_pengajuan']=$this->m_ol_rancak->ambil_lobook_kompetensi_group_pengajuan($apk["id_pengajuan"]);
				$this->tampil_top($data);
      }
// =================================================== PERMOHONAN
      if($mode=='permohonan'){
        $data['page'] =  $data['page']."_permohonan";
				$apk = $this->m_kredensial->ambil_pengajuan_kompetensi($data['id']);
				$form = $this->m_umum->ambil_data('kol_jenis_form','id_jenis_form',1);
				$kondisi_asesor=array('barcode_pengajuan'=>$data["id"],'npv.id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi'],'id_jenis_form'=>$form["id_jenis_form"],'id_asesor'=>$this->session->id_pegawai);
				//=====================================
				$data['nama_jenis_form']  = set_value('nama_jenis_form',$form["nama_jenis_form"]);
				$kondisi_form=array('id_jenis_form'=>$form["id_jenis_form"],'id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi']);
				$ambil_form = $this->m_umum->ambil_data_kondisi('nkr_form',$kondisi_form);
				$data['barcode_form']  = $ambil_form["barcode_form"];
$kondisi_validasi=array('barcode_pengajuan'=>$data["id"],'id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi'],'id_jenis_form'=>$form["id_jenis_form"],'id_asesor'=>$this->session->id_pegawai);
//-----------------
$data['jml_validasi'] = $this->m_umum->jumlah_record_filter('nkr_pengajuan_validasi',$kondisi_validasi);
if($data['jml_validasi'] == 0){
	$kondisi_form_detil=array('id_instansi'=>$apk['id_instansi'],'id_jenis_form'=>$form["id_jenis_form"],'status_form_detil'=>1);
//-----------------
	$data['kesesuaian_bukti']  = explode(",", $apk["kesesuaian_bukti"]);
	$data['ket_pengajuan_validasi']  = set_value('ket_pengajuan_validasi',$this->input->post('ket_pengajuan_validasi'));
	$data['tgl_asesi']  = set_value('tgl_asesi',$this->input->post('tgl_asesi'));
	$data['tgl_asesor']  = set_value('tgl_asesor',$this->input->post('tgl_asesor'));
	$data['form2_detil'] = $this->m_kredensial->ambil_nkr_form_detil($apk['kode_unit_pengajuan'],$kondisi_form_detil);
}else{
	$apv = $this->m_kredensial->ambil_pengajuan_validasi_asesor($kondisi_asesor);
	$data['kesesuaian_bukti']  = explode(",", $apv["kesesuaian_bukti_validasi"]);
	$data['ket_pengajuan_validasi']  = $apv["ket_pengajuan_validasi"];
	$data['tgl_asesi']  = set_value('tgl_asesi',$apv["tgl_asesi"]);
	$data['tgl_asesor']  = set_value('tgl_asesor',$apv["tgl_asesor"]);
	$data['form2_detil'] = $this->m_kredensial->ambil_nkr_validasi_question_detil($apv['barcode_pengajuan_validasi']);
}

				$data['ambil_data_etik_pegawai_oppe'] = $this->m_ol_rancak->ambil_data_etik_pegawai_oppe($apk["id_pegawai"],date('Y'));
				$data['ambil_lobook_kompetensi_group_pengajuan']=$this->m_ol_rancak->ambil_lobook_kompetensi_group_pengajuan($apk["id_pengajuan"]);
				$data['kompetensi'] = $this->m_umum->ambil_data_explode('nkr_kompetensi','id_kompetensi',$apk['kode_unit_pengajuan']);
				$data['id_kompetensi']  = set_value('id_kompetensi',$apk['kode_unit_pengajuan']);
				$data['id_instansi']  = set_value('id_instansi',$apk['id_instansi']);
				$data['id_jenis_form']  = set_value('id_jenis_form',$form['id_jenis_form']);
				//=====================================
				$jml_form = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi_form);
				if($jml_form == 0){
						$this->session->set_flashdata('danger', 'Belum Ada template untuk Form ini');
						redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$data['id']));
				}
				$jml = $this->m_kredensial->cek_num_form_pengajuan_validator($data['id'],$this->session->id_pegawai,$form["id_jenis_form"]);	
				$data['kembali'] = base_url('validasi/pengajuan_kompetensi/beranda/'.$apk['barcode_pengajuan']);				
				if ( $this->session->has_userdata('id_level') && $this->session->userdata('id_level')==99 ){

				}else{
					if($jml == 0 OR $apk['status_pengajuan'] == 0){
							$this->session->set_flashdata('danger', 'Bukan Validator Form ini / Status Belum Terkirim');
							redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$data['id']));
					}
				}	
				$data['ambil_berkas_data']=$this->m_ol_rancak->ambil_id_berkas_data($apk['id_pegawai']);
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$apk["barcode_pengajuan"]);
				$data['status_pengajuan']  = set_value('status_pengajuan',$apk["status_pengajuan"]);
				$data['foto']  = set_value('foto',$apk["foto"]);
				$data['nama_pegawai']  = set_value('nama_pegawai',$apk["nama_pegawai"]);
				$data['id_pengajuan']  = set_value('id_pengajuan',$apk["id_pengajuan"]);
				$data['id_pegawai']  = set_value('id_pegawai',$apk["id_pegawai"]);
				$data['id_instansi']  = set_value('id_instansi',$apk["id_instansi"]);
				if($apk["jk"] == 1){ $data['jk'] = 'Laki-laki'; }else{ $data['jk'] = 'Perempuan'; }
				$data['tgl_lahir']  = $this->m_rancak->fullBulan(date('d-m-Y', strtotime($apk['tgl_lahir'])));
				$data['tmp_lahir']  = set_value('tmp_lahir',$apk["tmp_lahir"]);
				$data['umur']  = set_value('umur',$apk["umur"]);
				$data['nama_status_kawin']  = set_value('nama_status_kawin',$apk["nama_status_kawin"]);
				$data['nama_jabatan']  = set_value('nama_jabatan',$apk["nama_jabatan"]);
				$data['nama_status_pegawai']  = set_value('nama_status_pegawai',$apk["nama_status_pegawai"]);
				$data['nama_agama']  = set_value('nama_agama',$apk["nama_agama"]);
				$data['nama_jabatan_fungsional']  = set_value('nama_jabatan_fungsional',$apk["nama_jabatan_fungsional"]);
				$data['nama_status_pegawai']  = set_value('nama_status_pegawai',$apk["nama_status_pegawai"]);
				$data['nip']  = set_value('nip',$apk["nip"]);
				$data['nama_pendidikan']  = set_value('nama_pendidikan',$apk["nama_pendidikan"]);
				$data['no_profesi']  = set_value('no_profesi',$apk["no_profesi"]);
				$data['no_hp']  = set_value('no_hp',$apk["no_hp"]);
				$data['email']  = set_value('email',$apk["email"]);
				$data['alamat']  = set_value('alamat',$apk["alamat"]);
				$data['nama_prov']  = set_value('nama_prov',$apk["nama_prov"]);
				$data['nama_kab']  = set_value('nama_kab',$apk["nama_kab"]);
				$data['nama_kec']  = set_value('nama_kec',$apk["nama_kec"]);
				$data['nama_kel']  = set_value('nama_kel',$apk["nama_kel"]);
				$data['nama_working']  = set_value('nama_working',$apk["nama_working"]);
				$data['nama_status_diusulkan']  = set_value('nama_status_diusulkan',$apk["nama_status_diusulkan"]);
				$data['id_berkas']  = explode(",", $apk["id_berkas"]);
				$data['berkas']  = $apk["id_berkas"];
				$data['id_ijasah']  = explode(",", $apk["id_ijasah"]);
				$data['ijasah']  = $apk["id_ijasah"];
				$data['id_str']  = explode(",", $apk["id_str"]);
				$data['str']  = $apk["id_str"];
				$data['id_sertifikat']  = explode(",", $apk["id_sertifikat"]);
				$data['sertifikat']  = $apk["id_sertifikat"];
				$data['id_etik_pegawai']  = explode(",", $apk["id_etik_pegawai"]);
				$this->tampil_top($data);
				$status_pengajuan = $this->input->post('status_pengajuan');
				$id_jenis_form = $this->input->post('id_jenis_form');
				$id_kompetensi = $this->input->post('id_kompetensi');
				$barcode_pengajuan = $this->input->post('barcode_pengajuan');				
				$id_instansi = $this->input->post('id_instansi');				
$action = $this->input->post('action');
$kondisi_validasi=array('barcode_pengajuan'=>$barcode_pengajuan,'id_kompetensi'=>$id_kompetensi,'id_instansi'=>$id_instansi,'id_jenis_form'=>$id_jenis_form,'id_asesor'=>$this->session->id_pegawai);
$jml_validasi = $this->m_umum->jumlah_record_filter('nkr_pengajuan_validasi',$kondisi_validasi);
if($action == 'BtnSetuju') {
	if($status_pengajuan == 1){
		if($jml_validasi == 0){
			$this->m_validasi->pengajuan_validasi_berkas_simpan(1);
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');	
		}else{
			$this->m_validasi->pengajuan_validasi_berkas_edit(1,$this->session->id_pegawai);
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
		}
	}else{
			$this->session->set_flashdata('danger', 'Data Sudah Selesai');				
	}
			redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$barcode_pengajuan));		
}
if($action == 'BtnTolak') {
	if($status_pengajuan == 1){
		if($jml_validasi == 0){
			$this->m_validasi->pengajuan_validasi_berkas_simpan(2);
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
		}else{
			$this->m_validasi->pengajuan_validasi_berkas_edit(2,$this->session->id_pegawai);
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
		}
	}else{
			$this->session->set_flashdata('danger', 'Data Sudah Selesai');				
	}
			redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$barcode_pengajuan));		
}
      }
      if($mode=='asesmen'){
        $data['page'] =  $data['page']."_asesmen";
				$apk = $this->m_kredensial->ambil_pengajuan_kompetensi($data['id']);
				$form = $this->m_umum->ambil_data('kol_jenis_form','id_jenis_form',2);
$kondisi_asesor=array('barcode_pengajuan'=>$data["id"],'npv.id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi'],'id_jenis_form'=>$form["id_jenis_form"],'id_asesor'=>$this->session->id_pegawai);
//-----------------
				$data['nama_jenis_form']  = set_value('nama_jenis_form',$form["nama_jenis_form"]);
				$data['kompetensi'] = $this->m_umum->ambil_data_explode('nkr_kompetensi','id_kompetensi',$apk['kode_unit_pengajuan']);
				$kondisi_form=array('id_jenis_form'=>$form["id_jenis_form"],'id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi']);
//-----------------
				$nkre_form = $this->m_umum->ambil_data_kondisi('nkr_form',$kondisi_form);
				$jml_form = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi_form);
				if($jml_form == 0){
						$this->session->set_flashdata('danger', 'Belum Ada template untuk Form ini');
						redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$data['id']));
				}
//===================================================================================
$kondisi_validasi=array('barcode_pengajuan'=>$data["id"],'id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi'],'id_jenis_form'=>$form["id_jenis_form"],'id_asesor'=>$this->session->id_pegawai);
//-----------------
$data['jml_validasi'] = $this->m_umum->jumlah_record_filter('nkr_pengajuan_validasi',$kondisi_validasi);
if($data['jml_validasi'] == 0){
	$kondisi_form_detil=array('id_instansi'=>$apk['id_instansi'],'id_jenis_form'=>$form["id_jenis_form"],'status_form_detil'=>1);
//-----------------
	$data['kesesuaian_bukti']  = explode(",", $apk["kesesuaian_bukti"]);
	$data['ket_pengajuan_validasi']  = set_value('ket_pengajuan_validasi',$this->input->post('ket_pengajuan_validasi'));
	$data['tgl_asesi']  = set_value('tgl_asesi',$this->input->post('tgl_asesi'));
	$data['tgl_asesor']  = set_value('tgl_asesor',$this->input->post('tgl_asesor'));
	$data['nama_asesor']  = set_value('nama_asesor',$this->input->post('nama_asesor'));
	$data['form2_detil'] = $this->m_kredensial->ambil_nkr_form_detil($apk['kode_unit_pengajuan'],$kondisi_form_detil);
}else{
	$apv = $this->m_kredensial->ambil_pengajuan_validasi_asesor($kondisi_asesor);
	$data['kesesuaian_bukti']  = explode(",", $apv["kesesuaian_bukti_validasi"]);
	$data['ket_pengajuan_validasi']  = $apv["ket_pengajuan_validasi"];
	$data['tgl_asesi']  = set_value('tgl_asesi',$apv["tgl_asesi"]);
	$data['tgl_asesor']  = set_value('tgl_asesor',$apv["tgl_asesor"]);
	$data['nama_asesor']  = set_value('nama_asesor',$apv["nama_pegawai"]);
	$data['form2_detil'] = $this->m_kredensial->ambil_nkr_validasi_question_detil($apv['barcode_pengajuan_validasi']);
}
//===================================================================================
$data['kembali'] = base_url('validasi/pengajuan_kompetensi/beranda/'.$apk['barcode_pengajuan']);
				$jml = $this->m_kredensial->cek_num_form_pengajuan_validator($data['id'],$this->session->id_pegawai,$form["id_jenis_form"]);			
				if ( $this->session->has_userdata('id_level') && $this->session->userdata('id_level')==99 ){

				}else{
					if($jml == 0 OR $apk['status_pengajuan'] == 0){
							$this->session->set_flashdata('danger', 'Bukan Validator Form ini / Status Belum Terkirim');
							redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$data['id']));
					}
				}
				//=====================================
				$data['id_kompetensi']  = set_value('id_kompetensi',$apk['kode_unit_pengajuan']);
				$data['id_instansi']  = set_value('id_instansi',$apk['id_instansi']);
				$data['id_jenis_form']  = set_value('id_jenis_form',$form['id_jenis_form']);
				//=====================================
				$data['barcode_form']  = set_value('barcode_form',$nkre_form["barcode_form"]);			
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$apk["barcode_pengajuan"]);
				$data['status_pengajuan']  = set_value('status_pengajuan',$apk["status_pengajuan"]);
				$data['nama_pegawai']  = set_value('nama_pegawai',$apk["nama_pegawai"]);
				$data['nama_working']  = set_value('nama_working',$apk["nama_working"]);
				$data['tgl_pengajuan']  = $this->m_rancak->fullBulan(date('d-m-Y', strtotime($apk['tgl_pengajuan'])));
//				$data['ambil_data_etik_pegawai_oppe'] = $this->m_ol_rancak->ambil_data_etik_pegawai_oppe($apk["id_pegawai"],date('Y'));
//				$data['ambil_lobook_kompetensi_group_pengajuan']=$this->m_ol_rancak->ambil_lobook_kompetensi_group_pengajuan($apk["id_pengajuan"]);
				$this->tampil_top($data);
				$status_pengajuan = $this->input->post('status_pengajuan');
				$id_jenis_form = $this->input->post('id_jenis_form');
				$id_kompetensi = $this->input->post('id_kompetensi');
				$barcode_pengajuan = $this->input->post('barcode_pengajuan');				
				$id_instansi = $this->input->post('id_instansi');				
$action = $this->input->post('action');
$kondisi_validasi=array('barcode_pengajuan'=>$barcode_pengajuan,'id_kompetensi'=>$id_kompetensi,'id_instansi'=>$id_instansi,'id_jenis_form'=>$id_jenis_form,'id_asesor'=>$this->session->id_pegawai);
$jml_validasi = $this->m_umum->jumlah_record_filter('nkr_pengajuan_validasi',$kondisi_validasi);
if($action == 'BtnSetuju') {
	if($status_pengajuan == 1){
		if($jml_validasi == 0){
			$last_kode = $this->m_validasi->pengajuan_validasi_berkas_simpan(1);
			$this->m_validasi->simpan_question_validasi($last_kode);
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');	
		}else{
			$this->m_validasi->pengajuan_validasi_berkas_edit(1,$this->session->id_pegawai);
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
		}
	}else{
			$this->session->set_flashdata('danger', 'Data Sudah Selesai');				
	}
			redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$barcode_pengajuan));		
}
if($action == 'BtnTolak') {
	if($status_pengajuan == 1){
		if($jml_validasi == 0){
			$last_kode = $this->m_validasi->pengajuan_validasi_berkas_simpan(2);
			$this->m_validasi->simpan_question_validasi($last_kode);
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
		}else{
			$this->m_validasi->pengajuan_validasi_berkas_edit(2,$this->session->id_pegawai);
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
		}
	}else{
			$this->session->set_flashdata('danger', 'Data Sudah Selesai');				
	}
			redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$barcode_pengajuan));		
}
      }
      if($mode=='rencana'){
        $data['page'] =  $data['page']."_rencana";
				$apk = $this->m_kredensial->ambil_pengajuan_kompetensi($data['id']); 	
				$form = $this->m_umum->ambil_data('kol_jenis_form','id_jenis_form',3);																			// form
				$data['nama_jenis_form']  = set_value('nama_jenis_form',$form["nama_jenis_form"]);
				//=================================
				$kondisi_form=array('id_jenis_form'=>$form["id_jenis_form"],'id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi']);
				$nkre_form = $this->m_umum->ambil_data_kondisi('nkr_form',$kondisi_form);		
				$data['barcode_form']  = set_value('barcode_form',$nkre_form["barcode_form"]);
				//=================================
				$jml = $this->m_kredensial->cek_num_form_pengajuan_validator($data['id'],$this->session->id_pegawai,$form["id_jenis_form"]);		
				if ( $this->session->has_userdata('id_level') && $this->session->userdata('id_level')==99 ){}else{
					if($jml == 0 OR $apk['status_pengajuan'] == 0){
							$this->session->set_flashdata('danger', 'Bukan Validator Form ini / Status Belum Terkirim');
							redirect(base_url('validasi/pengajuan_kompetensi'));
					}
				}
				//=====================================
				$data['id_kompetensi']  = set_value('id_kompetensi',$apk['kode_unit_pengajuan']);
				$data['id_instansi']  = set_value('id_instansi',$apk['id_instansi']);
				$data['id_jenis_form']  = set_value('id_jenis_form',$form['id_jenis_form']);
				//=====================================
				$data['nama_status_diusulkan']  = set_value('nama_status_diusulkan',$apk["nama_status_diusulkan"]);
				$data['nama_jabatan_fungsional']  = set_value('nama_jabatan_fungsional',$apk["nama_jabatan_fungsional"]);
				$data['tgl_pengajuan']  = $this->m_rancak->fullBulan(date('d-m-Y', strtotime($apk['tgl_pengajuan'])));
				$data['id_jabatan']  = set_value('id_jabatan',$apk["id_jabatan"]);
				$data['id_instansi']  = set_value('id_instansi',$apk["id_instansi"]);
				$data['id_pengajuan']  = set_value('id_pengajuan',$apk["id_pengajuan"]);
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$apk["barcode_pengajuan"]);
				$data['status_pengajuan']  = set_value('status_pengajuan',$apk["status_pengajuan"]);
				$data['nama_pegawai']  = set_value('nama_pegawai',$apk["nama_pegawai"]);
				$data['nama_working']  = set_value('nama_working',$apk["nama_working"]);
				//=================================
$kondisi_asesor=array('barcode_pengajuan'=>$data["id"],'npv.id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi'],'id_jenis_form'=>$form["id_jenis_form"],'id_asesor'=>$this->session->id_pegawai);
				//=================================
				$jml_form = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi_form);
				if($jml_form == 0){
						$this->session->set_flashdata('danger', 'Belum Ada template untuk Form ini');
						redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$data['id']));
				}
				//=================================
$kondisi_validasi=array('barcode_pengajuan'=>$data["id"],'id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi'],'id_jenis_form'=>$form["id_jenis_form"],'id_asesor'=>$this->session->id_pegawai);
$data['jml_validasi'] = $this->m_umum->jumlah_record_filter('nkr_pengajuan_validasi',$kondisi_validasi);
				$data['kompetensi'] = $this->m_umum->ambil_data_explode('nkr_kompetensi','id_kompetensi',$apk['kode_unit_pengajuan']);
				//=================================				
if($data['jml_validasi'] == 0){
	$data['kesesuaian_bukti']  = explode(",", $apk["kesesuaian_bukti"]);
	$data['ket_pengajuan_validasi']  = set_value('ket_pengajuan_validasi',$this->input->post('ket_pengajuan_validasi'));
	$data['tgl_asesi']  = set_value('tgl_asesi',$this->input->post('tgl_asesi'));
	$data['tgl_asesor']  = set_value('tgl_asesor',$this->input->post('tgl_asesor'));
	$data['nama_asesor']  = set_value('nama_asesor',$this->input->post('nama_asesor'));
$data['detil_elemen'] = $this->m_kredensial->ambil_nkr_grup_indikator($nkre_form["barcode_form"],'nas.id_elemen','no_urut_detil','asc');
}else{
	$apv = $this->m_kredensial->ambil_pengajuan_validasi_asesor($kondisi_asesor);
	$data['kesesuaian_bukti']  = explode(",", $apv["kesesuaian_bukti_validasi"]);
	$data['ket_pengajuan_validasi']  = $apv["ket_pengajuan_validasi"];
	$data['tgl_asesi']  = set_value('tgl_asesi',$apv["tgl_asesi"]);
	$data['tgl_asesor']  = set_value('tgl_asesor',$apv["tgl_asesor"]);
	$data['nama_asesor']  = set_value('nama_asesor',$apv["nama_pegawai"]);
 $data['barcode_pengajuan_validasi']  = set_value('barcode_pengajuan_validasi',$apv["barcode_pengajuan_validasi"]);
$data['detil_elemen'] = $this->m_kredensial->ambil_nkr_grup_indikator_validasi($apv['barcode_pengajuan_validasi'],'nas.id_elemen','no_urut_detil','asc');
}	
$data['alat']	= $this->m_umum->ambil_data('nkr_alat');
$data['perangkat']	= $this->m_umum->ambil_data('nkr_perangkat');
$data['metode']	= $this->m_umum->ambil_data('nkr_metode');
				//=================================
				$data['perangkate'] = $this->m_umum->ambil_data('nkr_perangkat');
				$data['metodee'] = $this->m_umum->ambil_data('nkr_metode');
				$data['alatdanbahan'] = $this->m_umum->ambil_data('nkr_alat');
				$data['kembali'] = base_url('validasi/pengajuan_kompetensi/beranda/'.$apk['barcode_pengajuan']);
//				$data['ambil_data_etik_pegawai_oppe'] = $this->m_ol_rancak->ambil_data_etik_pegawai_oppe($apk["id_pegawai"],date('Y'));
//				$data['ambil_lobook_kompetensi_group_pengajuan']=$this->m_ol_rancak->ambil_lobook_kompetensi_group_pengajuan($apk["id_pengajuan"]);
				$this->tampil_top($data);
				$status_pengajuan = $this->input->post('status_pengajuan');
				$id_jenis_form = $this->input->post('id_jenis_form');
				$id_kompetensi = $this->input->post('id_kompetensi');
				$barcode_pengajuan = $this->input->post('barcode_pengajuan');				
				$id_instansi = $this->input->post('id_instansi');				
$action = $this->input->post('action');
$kondisi_validasi=array('barcode_pengajuan'=>$barcode_pengajuan,'id_kompetensi'=>$id_kompetensi,'id_instansi'=>$id_instansi,'id_jenis_form'=>$id_jenis_form,'id_asesor'=>$this->session->id_pegawai);
$jml_validasi = $this->m_umum->jumlah_record_filter('nkr_pengajuan_validasi',$kondisi_validasi);
if($action == 'BtnSetuju') {
	if($status_pengajuan == 1){
		if($jml_validasi == 0){
			$last_kode = $this->m_validasi->pengajuan_validasi_berkas_simpan(1);
			$this->m_validasi->simpan_indikator_metode_perangkat_validasi($last_kode);
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');	
		}else{
			$this->m_validasi->pengajuan_validasi_berkas_edit(1,$this->session->id_pegawai);
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
		}
	}else{
			$this->session->set_flashdata('danger', 'Data Sudah Selesai');				
	}
			redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$barcode_pengajuan));		
}
if($action == 'BtnTolak') {
	if($status_pengajuan == 1){
		if($jml_validasi == 0){
			$last_kode = $this->m_validasi->pengajuan_validasi_berkas_simpan(2);
			$this->m_validasi->simpan_indikator_metode_perangkat_validasi($last_kode);
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
		}else{
			$this->m_validasi->pengajuan_validasi_berkas_edit(2,$this->session->id_pegawai);
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
		}
	}else{
			$this->session->set_flashdata('danger', 'Data Sudah Selesai');				
	}
			redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$barcode_pengajuan));		
}
      }
      if($mode=='observasi'){
        $data['page'] =  $data['page']."_observasi";
				$apk = $this->m_kredensial->ambil_pengajuan_kompetensi($data['id']); 	
				//=================================
				$form = $this->m_umum->ambil_data('kol_jenis_form','id_jenis_form',4);																			// form
				$data['nama_jenis_form']  = set_value('nama_jenis_form',$form["nama_jenis_form"]);
				//=================================
				$kondisi_form=array('id_jenis_form'=>$form["id_jenis_form"],'id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi']);
				$nkre_form = $this->m_umum->ambil_data_kondisi('nkr_form',$kondisi_form);		
				$data['barcode_form']  = set_value('barcode_form',$nkre_form["barcode_form"]);
				$jml = $this->m_kredensial->cek_num_form_pengajuan_validator($data['id'],$this->session->id_pegawai,$form["id_jenis_form"]);			
				if ( $this->session->has_userdata('id_level') && $this->session->userdata('id_level')==99 ){}else{
					if($jml == 0 OR $apk['status_pengajuan'] == 0){
							$this->session->set_flashdata('danger', 'Bukan Validator Form ini / Status Belum Terkirim');
							redirect(base_url('validasi/pengajuan_kompetensi'));
					}
				}
				//=====================================
				$data['id_kompetensi']  = set_value('id_kompetensi',$apk['kode_unit_pengajuan']);
				$data['id_instansi']  = set_value('id_instansi',$apk['id_instansi']);
				$data['id_jenis_form']  = set_value('id_jenis_form',$form['id_jenis_form']);
				//=====================================
				$data['nama_status_diusulkan']  = set_value('nama_status_diusulkan',$apk["nama_status_diusulkan"]);
				$data['nama_jabatan_fungsional']  = set_value('nama_jabatan_fungsional',$apk["nama_jabatan_fungsional"]);
				$data['tgl_pengajuan']  = $this->m_rancak->fullBulan(date('d-m-Y', strtotime($apk['tgl_pengajuan'])));
				$data['id_jabatan']  = set_value('id_jabatan',$apk["id_jabatan"]);
				$data['id_instansi']  = set_value('id_instansi',$apk["id_instansi"]);
				$data['id_pengajuan']  = set_value('id_pengajuan',$apk["id_pengajuan"]);
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$apk["barcode_pengajuan"]);
				$data['status_pengajuan']  = set_value('status_pengajuan',$apk["status_pengajuan"]);
				$data['nama_pegawai']  = set_value('nama_pegawai',$apk["nama_pegawai"]);
				$data['nama_working']  = set_value('nama_working',$apk["nama_working"]);
				//=================================
$kondisi_asesor=array('barcode_pengajuan'=>$data["id"],'npv.id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi'],'id_jenis_form'=>$form["id_jenis_form"],'id_asesor'=>$this->session->id_pegawai);
				//=================================
				$jml_form = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi_form);
				if($jml_form == 0){
						$this->session->set_flashdata('danger', 'Belum Ada template untuk Form ini');
						redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$data['id']));
				}
				$data['kembali'] = base_url('validasi/pengajuan_kompetensi/beranda/'.$apk['barcode_pengajuan']);
$kondisi_validasi=array('barcode_pengajuan'=>$data["id"],'id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi'],'id_jenis_form'=>$form["id_jenis_form"],'id_asesor'=>$this->session->id_pegawai);
$data['jml_validasi'] = $this->m_umum->jumlah_record_filter('nkr_pengajuan_validasi',$kondisi_validasi);
				$data['kompetensi'] = $this->m_umum->ambil_data_explode('nkr_kompetensi','id_kompetensi',$apk['kode_unit_pengajuan']);
if($data['jml_validasi'] == 0){
	$data['kesesuaian_bukti']  = explode(",", $apk["kesesuaian_bukti"]);
	$data['ket_pengajuan_validasi']  = set_value('ket_pengajuan_validasi',$this->input->post('ket_pengajuan_validasi'));
	$data['tgl_asesi']  = set_value('tgl_asesi',$this->input->post('tgl_asesi'));
	$data['tgl_asesor']  = set_value('tgl_asesor',$this->input->post('tgl_asesor'));
	$data['nama_asesor']  = set_value('nama_asesor',$this->input->post('nama_asesor'));
$data['form2_detil'] = $this->m_kredensial->ambil_nkr_grup_indikator($nkre_form['barcode_form'],'nfd2.id_indikator','no_urut_detil','ASC');
}else{
	$apv = $this->m_kredensial->ambil_pengajuan_validasi_asesor($kondisi_asesor);
	$data['kesesuaian_bukti']  = explode(",", $apv["kesesuaian_bukti_validasi"]);
	$data['ket_pengajuan_validasi']  = $apv["ket_pengajuan_validasi"];
	$data['tgl_asesi']  = set_value('tgl_asesi',$apv["tgl_asesi"]);
	$data['tgl_asesor']  = set_value('tgl_asesor',$apv["tgl_asesor"]);
	$data['nama_asesor']  = set_value('nama_asesor',$apv["nama_pegawai"]);
	$data['form2_detil'] = $this->m_kredensial->ambil_nkr_validasi_indikator_detil($apv['barcode_pengajuan_validasi']);
}
				$this->tampil_top($data);
				$status_pengajuan = $this->input->post('status_pengajuan');
				$id_jenis_form = $this->input->post('id_jenis_form');
				$id_kompetensi = $this->input->post('id_kompetensi');
				$barcode_pengajuan = $this->input->post('barcode_pengajuan');				
				$id_instansi = $this->input->post('id_instansi');				
$action = $this->input->post('action');
$kondisi_validasi=array('barcode_pengajuan'=>$barcode_pengajuan,'id_kompetensi'=>$id_kompetensi,'id_instansi'=>$id_instansi,'id_jenis_form'=>$id_jenis_form,'id_asesor'=>$this->session->id_pegawai);
$jml_validasi = $this->m_umum->jumlah_record_filter('nkr_pengajuan_validasi',$kondisi_validasi);
if($action == 'BtnSetuju') {
	if($status_pengajuan == 1){
		if($jml_validasi == 0){
			$last_kode = $this->m_validasi->pengajuan_validasi_berkas_simpan(1);
			$this->m_validasi->simpan_indikator_validasi($last_kode);
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');	
		}else{
			$this->m_validasi->pengajuan_validasi_berkas_edit(1,$this->session->id_pegawai);
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
		}
	}else{
			$this->session->set_flashdata('danger', 'Data Sudah Selesai');				
	}
			redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$barcode_pengajuan));		
}
if($action == 'BtnTolak') {
	if($status_pengajuan == 1){
		if($jml_validasi == 0){
			$last_kode = $this->m_validasi->pengajuan_validasi_berkas_simpan(2);
			$this->m_validasi->simpan_indikator_validasi($last_kode);
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
		}else{
			$this->m_validasi->pengajuan_validasi_berkas_edit(2,$this->session->id_pegawai);
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
		}
	}else{
			$this->session->set_flashdata('danger', 'Data Sudah Selesai');				
	}
			redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$barcode_pengajuan));		
}
      }
      if($mode=='lisan'){
        $data['page'] =  $data['page']."_lisan";
				$apk = $this->m_kredensial->ambil_pengajuan_kompetensi($data['id']); 	
				//=================================
				$form = $this->m_umum->ambil_data('kol_jenis_form','id_jenis_form',5);
				$data['nama_jenis_form']  = set_value('nama_jenis_form',$form["nama_jenis_form"]);
				//=================================
				$kondisi_form=array('id_jenis_form'=>$form["id_jenis_form"],'id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi']);
				$nkre_form = $this->m_umum->ambil_data_kondisi('nkr_form',$kondisi_form);		
				$data['barcode_form']  = set_value('barcode_form',$nkre_form["barcode_form"]);
				$jml = $this->m_kredensial->cek_num_form_pengajuan_validator($data['id'],$this->session->id_pegawai,$form["id_jenis_form"]);				
				if ( $this->session->has_userdata('id_level') && $this->session->userdata('id_level')==99 ){}else{
					if($jml == 0 OR $apk['status_pengajuan'] == 0){
							$this->session->set_flashdata('danger', 'Bukan Validator Form ini / Status Belum Terkirim');
							redirect(base_url('validasi/pengajuan_kompetensi'));
					}
				}
				//=====================================
				$data['id_kompetensi']  = set_value('id_kompetensi',$apk['kode_unit_pengajuan']);
				$data['id_instansi']  = set_value('id_instansi',$apk['id_instansi']);
				$data['id_jenis_form']  = set_value('id_jenis_form',$form['id_jenis_form']);
				//=====================================
				$data['nama_status_diusulkan']  = set_value('nama_status_diusulkan',$apk["nama_status_diusulkan"]);
				$data['nama_jabatan_fungsional']  = set_value('nama_jabatan_fungsional',$apk["nama_jabatan_fungsional"]);
				$data['tgl_pengajuan']  = $this->m_rancak->fullBulan(date('d-m-Y', strtotime($apk['tgl_pengajuan'])));
				$data['id_jabatan']  = set_value('id_jabatan',$apk["id_jabatan"]);
				$data['id_instansi']  = set_value('id_instansi',$apk["id_instansi"]);
				$data['id_pengajuan']  = set_value('id_pengajuan',$apk["id_pengajuan"]);
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$apk["barcode_pengajuan"]);
				$data['status_pengajuan']  = set_value('status_pengajuan',$apk["status_pengajuan"]);
				$data['nama_pegawai']  = set_value('nama_pegawai',$apk["nama_pegawai"]);
				$data['nama_working']  = set_value('nama_working',$apk["nama_working"]);
				//=================================
$kondisi_asesor=array('barcode_pengajuan'=>$data["id"],'npv.id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi'],'id_jenis_form'=>$form["id_jenis_form"],'id_asesor'=>$this->session->id_pegawai);
			//=================================
				$jml_form = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi_form);
				if($jml_form == 0){
						$this->session->set_flashdata('danger', 'Belum Ada template untuk Form ini');
						redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$data['id']));
				}
				$data['kembali'] = base_url('validasi/pengajuan_kompetensi/beranda/'.$apk['barcode_pengajuan']);
$kondisi_validasi=array('barcode_pengajuan'=>$data["id"],'id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi'],'id_jenis_form'=>$form["id_jenis_form"],'id_asesor'=>$this->session->id_pegawai);
$data['jml_validasi'] = $this->m_umum->jumlah_record_filter('nkr_pengajuan_validasi',$kondisi_validasi);
				$data['kompetensi'] = $this->m_umum->ambil_data_explode('nkr_kompetensi','id_kompetensi',$apk['kode_unit_pengajuan']);
if($data['jml_validasi'] == 0){
	$data['kesesuaian_bukti']  = explode(",", $apk["kesesuaian_bukti"]);
	$data['ket_pengajuan_validasi']  = set_value('ket_pengajuan_validasi',$this->input->post('ket_pengajuan_validasi'));
	$data['tgl_asesi']  = set_value('tgl_asesi',$this->input->post('tgl_asesi'));
	$data['tgl_asesor']  = set_value('tgl_asesor',$this->input->post('tgl_asesor'));
	$data['nama_asesor']  = set_value('nama_asesor',$this->input->post('nama_asesor'));
$data['form2_detil'] = $this->m_kredensial->ambil_nkr_grup_indikator($nkre_form['barcode_form'],'nfd2.id_indikator','no_urut_detil','ASC');
}else{
	$apv = $this->m_kredensial->ambil_pengajuan_validasi_asesor($kondisi_asesor);
	$data['kesesuaian_bukti']  = explode(",", $apv["kesesuaian_bukti_validasi"]);
	$data['ket_pengajuan_validasi']  = $apv["ket_pengajuan_validasi"];
	$data['tgl_asesi']  = set_value('tgl_asesi',$apv["tgl_asesi"]);
	$data['tgl_asesor']  = set_value('tgl_asesor',$apv["tgl_asesor"]);
	$data['nama_asesor']  = set_value('nama_asesor',$apv["nama_pegawai"]);
$data['form2_detil'] = $this->m_kredensial->ambil_nkr_validasi_indikator_detil($apv['barcode_pengajuan_validasi']);
}
			//	$data['jawaban_asesi']  = set_value('jawaban_asesi',$this->input->post('jawaban_asesi'));
				$this->tampil_top($data);
				$status_pengajuan = $this->input->post('status_pengajuan');
				$id_jenis_form = $this->input->post('id_jenis_form');
				$id_kompetensi = $this->input->post('id_kompetensi');
				$barcode_pengajuan = $this->input->post('barcode_pengajuan');				
				$id_instansi = $this->input->post('id_instansi');				
$action = $this->input->post('action');
$kondisi_validasi=array('barcode_pengajuan'=>$barcode_pengajuan,'id_kompetensi'=>$id_kompetensi,'id_instansi'=>$id_instansi,'id_jenis_form'=>$id_jenis_form,'id_asesor'=>$this->session->id_pegawai);
$jml_validasi = $this->m_umum->jumlah_record_filter('nkr_pengajuan_validasi',$kondisi_validasi);
if($action == 'BtnSetuju') {
	if($status_pengajuan == 1){
		if($jml_validasi == 0){
			$last_kode = $this->m_validasi->pengajuan_validasi_berkas_simpan(1);
			$this->m_validasi->simpan_indikator_validasi_jawaban($last_kode);
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');	
		}else{
			$this->m_validasi->pengajuan_validasi_berkas_edit(1,$this->session->id_pegawai);
			$this->m_validasi->edit_indikator_validasi_jawaban();
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
		}
	}else{
			$this->session->set_flashdata('danger', 'Data Sudah Selesai');				
	}
			redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$barcode_pengajuan));		
}
if($action == 'BtnTolak') {
	if($status_pengajuan == 1){
		if($jml_validasi == 0){
			$last_kode = $this->m_validasi->pengajuan_validasi_berkas_simpan(2);
			$this->m_validasi->simpan_indikator_validasi_jawaban($last_kode);
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
		}else{
			$this->m_validasi->pengajuan_validasi_berkas_edit(2,$this->session->id_pegawai);
			$this->m_validasi->edit_indikator_validasi_jawaban();
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
		}
	}else{
			$this->session->set_flashdata('danger', 'Data Sudah Selesai');				
	}
			redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$barcode_pengajuan));		
}
      }
      if($mode=='tulis'){
        $data['page'] =  $data['page']."_tulis";
				$apk = $this->m_kredensial->ambil_pengajuan_kompetensi($data['id']); 	
				//=================================
				$form = $this->m_umum->ambil_data('kol_jenis_form','id_jenis_form',6);																			// form
				$data['nama_jenis_form']  = set_value('nama_jenis_form',$form["nama_jenis_form"]);
				//=================================
				$kondisi_form=array('id_jenis_form'=>$form["id_jenis_form"],'id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi']);
				$nkre_form = $this->m_umum->ambil_data_kondisi('nkr_form',$kondisi_form);		
				$data['barcode_form']  = set_value('barcode_form',$nkre_form["barcode_form"]);				
				$jml = $this->m_kredensial->cek_num_form_pengajuan_validator($data['id'],$this->session->id_pegawai,$form["id_jenis_form"]);						
				if ( $this->session->has_userdata('id_level') && $this->session->userdata('id_level')==99 ){}else{
					if($jml == 0 OR $apk['status_pengajuan'] == 0){
							$this->session->set_flashdata('danger', 'Bukan Validator Form ini / Status Belum Terkirim');
							redirect(base_url('validasi/pengajuan_kompetensi'));
					}
				}
				//=====================================
				$data['id_kompetensi']  = set_value('id_kompetensi',$apk['kode_unit_pengajuan']);
				$data['id_instansi']  = set_value('id_instansi',$apk['id_instansi']);
				$data['id_jenis_form']  = set_value('id_jenis_form',$form['id_jenis_form']);
				//=====================================
				$data['nama_status_diusulkan']  = set_value('nama_status_diusulkan',$apk["nama_status_diusulkan"]);
				$data['nama_jabatan_fungsional']  = set_value('nama_jabatan_fungsional',$apk["nama_jabatan_fungsional"]);
				$data['tgl_pengajuan']  = $this->m_rancak->fullBulan(date('d-m-Y', strtotime($apk['tgl_pengajuan'])));
				$data['id_jabatan']  = set_value('id_jabatan',$apk["id_jabatan"]);
				$data['id_instansi']  = set_value('id_instansi',$apk["id_instansi"]);
				$data['id_pengajuan']  = set_value('id_pengajuan',$apk["id_pengajuan"]);
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$apk["barcode_pengajuan"]);
				$data['status_pengajuan']  = set_value('status_pengajuan',$apk["status_pengajuan"]);
				$data['nama_pegawai']  = set_value('nama_pegawai',$apk["nama_pegawai"]);
				$data['nama_working']  = set_value('nama_working',$apk["nama_working"]);
				//=================================
$kondisi_asesor=array('barcode_pengajuan'=>$data["id"],'npv.id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi'],'id_jenis_form'=>$form["id_jenis_form"],'id_asesor'=>$this->session->id_pegawai);
				//=================================
				$jml_form = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi_form);
				if($jml_form == 0){
						$this->session->set_flashdata('danger', 'Belum Ada template untuk Form ini');
						redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$data['id']));
				}
				$data['kembali'] = base_url('validasi/pengajuan_kompetensi/beranda/'.$apk['barcode_pengajuan']);
$kondisi_validasi=array('barcode_pengajuan'=>$data["id"],'id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi'],'id_jenis_form'=>$form["id_jenis_form"],'id_asesor'=>$this->session->id_pegawai);
$data['jml_validasi'] = $this->m_umum->jumlah_record_filter('nkr_pengajuan_validasi',$kondisi_validasi);
				$data['kompetensi'] = $this->m_umum->ambil_data_explode('nkr_kompetensi','id_kompetensi',$apk['kode_unit_pengajuan']);
if($data['jml_validasi'] == 0){
	$data['kesesuaian_bukti']  = explode(",", $apk["kesesuaian_bukti"]);
	$data['ket_pengajuan_validasi']  = set_value('ket_pengajuan_validasi',$this->input->post('ket_pengajuan_validasi'));
	$data['tgl_asesi']  = set_value('tgl_asesi',$this->input->post('tgl_asesi'));
	$data['tgl_asesor']  = set_value('tgl_asesor',$this->input->post('tgl_asesor'));
	$data['nama_asesor']  = set_value('nama_asesor',$this->input->post('nama_asesor'));
	$data['locked']  = set_value('locked',$this->input->post('locked'));
$data['form2_detil'] = $this->m_kredensial->ambil_nkr_grup_indikator($nkre_form['barcode_form'],'nfd2.id_indikator','no_urut_detil','ASC');
}else{
	$apv = $this->m_kredensial->ambil_pengajuan_validasi_asesor($kondisi_asesor);
	$data['kesesuaian_bukti']  = explode(",", $apv["kesesuaian_bukti_validasi"]);
	$data['ket_pengajuan_validasi']  = $apv["ket_pengajuan_validasi"];
	$data['tgl_asesi']  = set_value('tgl_asesi',$apv["tgl_asesi"]);
	$data['tgl_asesor']  = set_value('tgl_asesor',$apv["tgl_asesor"]);
	$data['nama_asesor']  = set_value('nama_asesor',$apv["nama_pegawai"]);
	$data['locked']  = set_value('locked',$apv["locked"]);
$data['form2_detil'] = $this->m_kredensial->ambil_nkr_validasi_indikator_detil($apv['barcode_pengajuan_validasi']);
}
			//	$data['jawaban_asesi']  = set_value('jawaban_asesi',$this->input->post('jawaban_asesi'));
				$this->tampil_top($data);
				$status_pengajuan = $this->input->post('status_pengajuan');
				$id_jenis_form = $this->input->post('id_jenis_form');
				$id_kompetensi = $this->input->post('id_kompetensi');
				$barcode_pengajuan = $this->input->post('barcode_pengajuan');				
				$id_instansi = $this->input->post('id_instansi');				
$action = $this->input->post('action');
$kondisi_validasi=array('barcode_pengajuan'=>$barcode_pengajuan,'id_kompetensi'=>$id_kompetensi,'id_instansi'=>$id_instansi,'id_jenis_form'=>$id_jenis_form,'id_asesor'=>$this->session->id_pegawai);
$jml_validasi = $this->m_umum->jumlah_record_filter('nkr_pengajuan_validasi',$kondisi_validasi);
if($action == 'BtnSetuju') {
	if($status_pengajuan == 1){
		if($jml_validasi == 0){
			$last_kode = $this->m_validasi->pengajuan_validasi_berkas_simpan(1);
			$this->m_validasi->simpan_indikator_validasi_tulis_locked($last_kode);
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');	
		}else{
			$this->m_validasi->pengajuan_validasi_berkas_edit_locked(1,$this->session->id_pegawai,3);
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
		}
	}else{
			$this->session->set_flashdata('danger', 'Data Sudah Selesai');				
	}
			redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$barcode_pengajuan));		
}
if($action == 'BtnTolak') {
	if($status_pengajuan == 1){
		if($jml_validasi == 0){
			$last_kode = $this->m_validasi->pengajuan_validasi_berkas_simpan(2);
			$this->m_validasi->simpan_indikator_validasi_tulis_locked($last_kode);
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
		}else{
			$this->m_validasi->pengajuan_validasi_berkas_edit_locked(2,$this->session->id_pegawai,3);
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
		}
	}else{
			$this->session->set_flashdata('danger', 'Data Sudah Selesai');				
	}
			redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$barcode_pengajuan));		
}
if($action == 'BtnEdit') {
	if($status_pengajuan == 1){
		if($jml_validasi == 0){
			$last_kode = $this->m_validasi->pengajuan_validasi_berkas_simpan(0);
			$this->m_validasi->simpan_indikator_validasi_tulis_locked($last_kode);
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');	
		}else{
			$this->m_validasi->pengajuan_validasi_berkas_edit(0,$this->session->id_pegawai);
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
		}
	}else{
			$this->session->set_flashdata('danger', 'Data Sudah Selesai');				
	}
			redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$barcode_pengajuan));		
}
if($action == 'BtnAktif') {
	if($status_pengajuan == 1){
		if($jml_validasi == 0){
			$last_kode = $this->m_validasi->pengajuan_validasi_berkas_locked(0);
			$this->m_validasi->simpan_indikator_validasi_tulis_locked($last_kode);
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
		}else{
			$this->m_validasi->pengajuan_validasi_berkas_edit(2,$this->session->id_pegawai);
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
		}
	}else{
			$this->session->set_flashdata('danger', 'Data Sudah Selesai');				
	}
			redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$barcode_pengajuan));		
}
      }
      if($mode=='portofolio'){
        $data['page'] =  $data['page']."_portofolio";
				//=================================
				$form = $this->m_umum->ambil_data('kol_jenis_form','id_jenis_form',7);
				//=================================
				$data['nama_jenis_form']  = set_value('nama_jenis_form',$form["nama_jenis_form"]);
				//=================================
				$apk = $this->m_kredensial->ambil_pengajuan_kompetensi($data['id']); 	
				//=================================
				$kondisi_form=array('id_jenis_form'=>$form["id_jenis_form"],'id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi']);
				$jml_form = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi_form);
				//=================================
				if($jml_form == 0){
						$this->session->set_flashdata('danger', 'Belum Ada template untuk Form ini');
						redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$data['id']));
				}
				//=================================
				$nkre_form = $this->m_umum->ambil_data_kondisi('nkr_form',$kondisi_form);		
				$data['barcode_form']  = set_value('barcode_form',$nkre_form["barcode_form"]);	
				//=================================
				$jml = $this->m_kredensial->cek_num_form_pengajuan_validator($data['id'],$this->session->id_pegawai,$form["id_jenis_form"]);			
				if ( $this->session->has_userdata('id_level') && $this->session->userdata('id_level')==99 ){}else{
					if($jml == 0 OR $apk['status_pengajuan'] == 0){
							$this->session->set_flashdata('danger', 'Bukan Validator Form ini / Status Belum Terkirim');
							redirect(base_url('validasi/pengajuan_kompetensi'));
					}
				}
				//=====================================
				$data['id_kompetensi']  = set_value('id_kompetensi',$apk['kode_unit_pengajuan']);
				$data['id_instansi']  = set_value('id_instansi',$apk['id_instansi']);
				$data['id_jenis_form']  = set_value('id_jenis_form',$form['id_jenis_form']);
				//=====================================
				$data['nama_status_diusulkan']  = set_value('nama_status_diusulkan',$apk["nama_status_diusulkan"]);
				$data['nama_jabatan_fungsional']  = set_value('nama_jabatan_fungsional',$apk["nama_jabatan_fungsional"]);
				$data['tgl_pengajuan']  = $this->m_rancak->fullBulan(date('d-m-Y', strtotime($apk['tgl_pengajuan'])));
				$data['id_jabatan']  = set_value('id_jabatan',$apk["id_jabatan"]);
				$data['id_instansi']  = set_value('id_instansi',$apk["id_instansi"]);
				$data['id_pengajuan']  = set_value('id_pengajuan',$apk["id_pengajuan"]);
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$apk["barcode_pengajuan"]);
				$data['status_pengajuan']  = set_value('status_pengajuan',$apk["status_pengajuan"]);
				$data['id_pegawai']  = set_value('id_pegawai',$apk["id_pegawai"]);
				$data['nama_pegawai']  = set_value('nama_pegawai',$apk["nama_pegawai"]);
				$data['nama_working']  = set_value('nama_working',$apk["nama_working"]);
				//=================================
$kondisi_asesor=array('barcode_pengajuan'=>$data["id"],'npv.id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi'],'id_jenis_form'=>$form["id_jenis_form"],'id_asesor'=>$this->session->id_pegawai);
				//=================================
				$data['kembali'] = base_url('validasi/pengajuan_kompetensi/beranda/'.$apk['barcode_pengajuan']);
				//=================================
$kondisi_validasi=array('barcode_pengajuan'=>$data["id"],'id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi'],'id_jenis_form'=>$form["id_jenis_form"],'id_asesor'=>$this->session->id_pegawai);
$data['jml_validasi'] = $this->m_umum->jumlah_record_filter('nkr_pengajuan_validasi',$kondisi_validasi);
if($data['jml_validasi'] == 0){
	$data['kesesuaian_bukti']  = explode(",", $apk["kesesuaian_bukti"]);
	$data['ket_pengajuan_validasi']  = set_value('ket_pengajuan_validasi',$this->input->post('ket_pengajuan_validasi'));
	$data['tgl_asesi']  = set_value('tgl_asesi',$this->input->post('tgl_asesi'));
	$data['tgl_asesor']  = set_value('tgl_asesor',$this->input->post('tgl_asesor'));
	$data['nama_asesor']  = set_value('nama_asesor',$this->input->post('nama_asesor'));
	$data['locked']  = set_value('locked',$this->input->post('locked'));
 $data['form2_detil'] = $this->m_kredensial->ambil_nkr_grup_indikator($nkre_form['barcode_form'],'nfd2.id_indikator','no_urut_detil','ASC');
}else{
	$apv = $this->m_kredensial->ambil_pengajuan_validasi_asesor($kondisi_asesor);
	$data['kesesuaian_bukti']  = explode(",", $apv["kesesuaian_bukti_validasi"]);
	$data['ket_pengajuan_validasi']  = $apv["ket_pengajuan_validasi"];
	$data['tgl_asesi']  = set_value('tgl_asesi',$apv["tgl_asesi"]);
	$data['tgl_asesor']  = set_value('tgl_asesor',$apv["tgl_asesor"]);
	$data['nama_asesor']  = set_value('nama_asesor',$apv["nama_pegawai"]);
	$data['locked']  = set_value('locked',$apv["locked"]);
 $data['form2_detil'] = $this->m_kredensial->ambil_nkr_validasi_indikator_detil($apv['barcode_pengajuan_validasi']);
}
				$data['kompetensi'] = $this->m_umum->ambil_data_explode('nkr_kompetensi','id_kompetensi',$apk['kode_unit_pengajuan']);
				$data['ambil_lobook_kompetensi_group_pengajuan']=$this->m_ol_rancak->ambil_lobook_kompetensi_group_pengajuan($apk["id_pengajuan"]);
				$this->tampil_top($data);
				$status_pengajuan = $this->input->post('status_pengajuan');
				$id_jenis_form = $this->input->post('id_jenis_form');
				$id_kompetensi = $this->input->post('id_kompetensi');
				$barcode_pengajuan = $this->input->post('barcode_pengajuan');				
				$id_instansi = $this->input->post('id_instansi');				
$action = $this->input->post('action');
$kondisi_validasi=array('barcode_pengajuan'=>$barcode_pengajuan,'id_kompetensi'=>$id_kompetensi,'id_instansi'=>$id_instansi,'id_jenis_form'=>$id_jenis_form,'id_asesor'=>$this->session->id_pegawai);
$jml_validasi = $this->m_umum->jumlah_record_filter('nkr_pengajuan_validasi',$kondisi_validasi);
if($action == 'BtnSetuju') {
	if($status_pengajuan == 1){
		if($jml_validasi == 0){
			$last_kode = $this->m_validasi->pengajuan_validasi_berkas_simpan(1);
			$this->m_validasi->simpan_indikator_validasi_dokumen($last_kode);
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');	
		}else{
			$this->m_validasi->pengajuan_validasi_berkas_edit(1,$this->session->id_pegawai);
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
		}
	}else{
			$this->session->set_flashdata('danger', 'Data Sudah Selesai');				
	}
			redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$barcode_pengajuan));		
}
if($action == 'BtnTolak') {
	if($status_pengajuan == 1){
		if($jml_validasi == 0){
			$last_kode = $this->m_validasi->pengajuan_validasi_berkas_simpan(2);
			$this->m_validasi->simpan_indikator_validasi_dokumen($last_kode);
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
		}else{
			$this->m_validasi->pengajuan_validasi_berkas_edit(2,$this->session->id_pegawai);
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
		}
	}else{
			$this->session->set_flashdata('danger', 'Data Sudah Selesai');				
	}
			redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$barcode_pengajuan));		
}
      }
      if($mode=='v_kompetensi'){
      	$apk = $this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$data['isi']);
      	if($apk['status_pengajuan'] == 1){
					$kondisi=array('barcode_logbook'=>$data['id3']);
					$jml = $this->m_umum->jumlah_record_filter('ol_logbook_validasi',$kondisi);
					if($jml == 0){
						  if($this->m_validasi->simpan_ol_logbook_validasi($data['id'],$data['id2'],$data['id3'])){
								$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
								redirect(base_url('validasi/pengajuan_kompetensi/portofolio/'.$data['isi']));
						  }else{
								$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
								redirect(base_url('validasi/pengajuan_kompetensi/portofolio/'.$data['isi']));
						  }
					}else{
						  if($this->m_validasi->edit_ol_logbook_validasi($data['id'],$data['id2'],$data['id3'])){
								$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
								redirect(base_url('validasi/pengajuan_kompetensi/portofolio/'.$data['isi']));
						  }else{
								$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
								redirect(base_url('validasi/pengajuan_kompetensi/portofolio/'.$data['isi']));
						  }
					}
				}else{
					$this->session->set_flashdata('danger', 'Sesi Validasi Sudah Selesai');
					redirect(base_url('validasi/pengajuan_kompetensi/portofolio/'.$data['isi']));
				}
      }
      if($mode=='v_kompetensi_all'){
      	$apk = $this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$data['isi']);
      	if($apk['status_pengajuan'] == 1){
					 $this->m_validasi->simpan_ol_logbook_validasi_all($data['id'],$data['id2'],$data['id3'],$apk['id_pengajuan']);
					 $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					 redirect(base_url('validasi/pengajuan_kompetensi/portofolio/'.$data['isi']));
				}else{
					$this->session->set_flashdata('danger', 'Sesi Validasi Sudah Selesai');
					redirect(base_url('validasi/pengajuan_kompetensi/portofolio/'.$data['isi']));
				}
      }
      if($mode=='konsultasi'){
        $data['page'] =  $data['page']."_konsultasi";
				$apk = $this->m_kredensial->ambil_pengajuan_kompetensi($data['id']); 	
				//=================================
				$form = $this->m_umum->ambil_data('kol_jenis_form','id_jenis_form',8);																			// form
				$data['nama_jenis_form']  = set_value('nama_jenis_form',$form["nama_jenis_form"]);
				//=================================
				$kondisi_form=array('id_jenis_form'=>$form["id_jenis_form"],'id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi']);
				$nkre_form = $this->m_umum->ambil_data_kondisi('nkr_form',$kondisi_form);		
				$data['barcode_form']  = set_value('barcode_form',$nkre_form["barcode_form"]);				
				$jml = $this->m_kredensial->cek_num_form_pengajuan_validator($data['id'],$this->session->id_pegawai,$form["id_jenis_form"]);						
				if ( $this->session->has_userdata('id_level') && $this->session->userdata('id_level')==99 ){}else{
					if($jml == 0 OR $apk['status_pengajuan'] == 0){
							$this->session->set_flashdata('danger', 'Bukan Validator Form ini / Status Belum Terkirim');
							redirect(base_url('validasi/pengajuan_kompetensi'));
					}
				}
				//=====================================
				$data['id_kompetensi']  = set_value('id_kompetensi',$apk['kode_unit_pengajuan']);
				$data['id_instansi']  = set_value('id_instansi',$apk['id_instansi']);
				$data['id_jenis_form']  = set_value('id_jenis_form',$form['id_jenis_form']);
				//=====================================
				$data['nama_status_diusulkan']  = set_value('nama_status_diusulkan',$apk["nama_status_diusulkan"]);
				$data['nama_jabatan_fungsional']  = set_value('nama_jabatan_fungsional',$apk["nama_jabatan_fungsional"]);
				$data['tgl_pengajuan']  = $this->m_rancak->fullBulan(date('d-m-Y', strtotime($apk['tgl_pengajuan'])));
				$data['id_jabatan']  = set_value('id_jabatan',$apk["id_jabatan"]);
				$data['id_instansi']  = set_value('id_instansi',$apk["id_instansi"]);
				$data['id_pengajuan']  = set_value('id_pengajuan',$apk["id_pengajuan"]);
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$apk["barcode_pengajuan"]);
				$data['status_pengajuan']  = set_value('status_pengajuan',$apk["status_pengajuan"]);
				$data['nama_pegawai']  = set_value('nama_pegawai',$apk["nama_pegawai"]);
				$data['nama_working']  = set_value('nama_working',$apk["nama_working"]);
				//=================================
$kondisi_asesor=array('barcode_pengajuan'=>$data["id"],'npv.id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi'],'id_jenis_form'=>$form["id_jenis_form"],'id_asesor'=>$this->session->id_pegawai);
$kondisi_format=array('barcode_pengajuan'=>$data["id"],'npv.id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi']);
				$data['format'] = $this->m_kredensial->ambil_form_clicked($kondisi_format);
				//=================================
				$jml_form = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi_form);
				if($jml_form == 0){
						$this->session->set_flashdata('danger', 'Belum Ada template untuk Form ini');
						redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$data['id']));
				}
				$data['kembali'] = base_url('validasi/pengajuan_kompetensi/beranda/'.$apk['barcode_pengajuan']);
$kondisi_validasi=array('barcode_pengajuan'=>$data["id"],'id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi'],'id_jenis_form'=>$form["id_jenis_form"],'id_asesor'=>$this->session->id_pegawai);
$data['jml_validasi'] = $this->m_umum->jumlah_record_filter('nkr_pengajuan_validasi',$kondisi_validasi);
				$data['kompetensi'] = $this->m_umum->ambil_data_explode('nkr_kompetensi','id_kompetensi',$apk['kode_unit_pengajuan']);
		//		$data['link_kompetensi'] = $this->m_kredensial->result_pengajuan_validasi_asesor($data['id'],$this->session->id_pegawai);
if($data['jml_validasi'] == 0){
	$data['kesesuaian_bukti']  = explode(",", $apk["kesesuaian_bukti"]);
	$data['ket_pengajuan_validasi']  = set_value('ket_pengajuan_validasi',$this->input->post('ket_pengajuan_validasi'));
	$data['tgl_asesi']  = set_value('tgl_asesi',$this->input->post('tgl_asesi'));
	$data['tgl_asesor']  = set_value('tgl_asesor',$this->input->post('tgl_asesor'));
	$data['nama_asesor']  = set_value('nama_asesor',$this->input->post('nama_asesor'));
	$data['barcode_pengajuan_validasi']  = set_value('barcode_pengajuan_validasi',$this->input->post('barcode_pengajuan_validasi'));
	$data['banding_form']  = set_value('banding_form',$this->input->post('banding_form'));
	$data['locked']  = set_value('locked',$this->input->post('locked'));
$data['form2_detil'] = $this->m_kredensial->ambil_nkr_grup_pra_asesmen($nkre_form['barcode_form'],'npa.id_pra_asesmen','no_urut_detil','ASC');
}else{
	$apv = $this->m_kredensial->ambil_pengajuan_validasi_asesor($kondisi_asesor);
	$data['kesesuaian_bukti']  = explode(",", $apv["kesesuaian_bukti_validasi"]);
	$data['ket_pengajuan_validasi']  = $apv["ket_pengajuan_validasi"];
	$data['tgl_asesi']  = set_value('tgl_asesi',$apv["tgl_asesi"]);
	$data['tgl_asesor']  = set_value('tgl_asesor',$apv["tgl_asesor"]);
	$data['nama_asesor']  = set_value('nama_asesor',$apv["nama_pegawai"]);
	$data['barcode_pengajuan_validasi']  = set_value('barcode_pengajuan_validasi',$apv["barcode_pengajuan_validasi"]);
	$data['banding_form']  = set_value('banding_form',$apv["banding_form"]);
	$data['locked']  = set_value('locked',$apv["locked"]);
$data['form2_detil'] = $this->m_kredensial->ambil_validasi_grup_pra_asesmen($apv['barcode_pengajuan_validasi'],'npa.id_pra_asesmen','no_urut_detil','ASC');
}
			//	$data['jawaban_asesi']  = set_value('jawaban_asesi',$this->input->post('jawaban_asesi'));
				$this->tampil_top($data);
				$status_pengajuan = $this->input->post('status_pengajuan');
				$id_jenis_form = $this->input->post('id_jenis_form');
				$id_kompetensi = $this->input->post('id_kompetensi');
				$barcode_pengajuan = $this->input->post('barcode_pengajuan');				
				$id_instansi = $this->input->post('id_instansi');				
$action = $this->input->post('action');
$kondisi_validasi=array('barcode_pengajuan'=>$barcode_pengajuan,'id_kompetensi'=>$id_kompetensi,'id_instansi'=>$id_instansi,'id_jenis_form'=>$id_jenis_form,'id_asesor'=>$this->session->id_pegawai);
$jml_validasi = $this->m_umum->jumlah_record_filter('nkr_pengajuan_validasi',$kondisi_validasi);
if($action == 'BtnSetuju') {
	if($status_pengajuan == 1){
		if($jml_validasi == 0){
			$last_kode = $this->m_validasi->pengajuan_validasi_berkas_simpan(1);
			$this->m_validasi->simpan_validasi_pra_asesmen($last_kode);
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');	
		}else{
			$this->m_validasi->pengajuan_validasi_berkas_edit(1,$this->session->id_pegawai);
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
		}
	}else{
			$this->session->set_flashdata('danger', 'Data Sudah Selesai');				
	}
			redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$barcode_pengajuan));		
}
if($action == 'BtnTolak') {
	if($status_pengajuan == 1){
		if($jml_validasi == 0){
			$last_kode = $this->m_validasi->pengajuan_validasi_berkas_simpan(2);
			$this->m_validasi->simpan_validasi_pra_asesmen($last_kode);
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
		}else{
			$this->m_validasi->pengajuan_validasi_berkas_edit(2,$this->session->id_pegawai);
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
		}
	}else{
			$this->session->set_flashdata('danger', 'Data Sudah Selesai');				
	}
			redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$barcode_pengajuan));		
}
      }
      if($mode=='cek'){
        $data['page'] =  $data['page']."_cek";
				$apk = $this->m_kredensial->ambil_pengajuan_kompetensi($data['id']); 	
				//=================================
				$form = $this->m_umum->ambil_data('kol_jenis_form','id_jenis_form',9);																			// form
				$data['nama_jenis_form']  = set_value('nama_jenis_form',$form["nama_jenis_form"]);
				//=================================
				$kondisi_form=array('id_jenis_form'=>$form["id_jenis_form"],'id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi']);
				$nkre_form = $this->m_umum->ambil_data_kondisi('nkr_form',$kondisi_form);		
				$data['barcode_form']  = set_value('barcode_form',$nkre_form["barcode_form"]);				
				$jml = $this->m_kredensial->cek_num_form_pengajuan_validator($data['id'],$this->session->id_pegawai,$form["id_jenis_form"]);					
				if ( $this->session->has_userdata('id_level') && $this->session->userdata('id_level')==99 ){}else{
					if($jml == 0 OR $apk['status_pengajuan'] == 0){
							$this->session->set_flashdata('danger', 'Bukan Validator Form ini / Status Belum Terkirim');
							redirect(base_url('validasi/pengajuan_kompetensi'));
					}
				}
				//=====================================
				$data['id_kompetensi']  = set_value('id_kompetensi',$apk['kode_unit_pengajuan']);
				$data['id_instansi']  = set_value('id_instansi',$apk['id_instansi']);
				$data['id_jenis_form']  = set_value('id_jenis_form',$form['id_jenis_form']);
				//=====================================
				$data['nama_status_diusulkan']  = set_value('nama_status_diusulkan',$apk["nama_status_diusulkan"]);
				$data['nama_jabatan_fungsional']  = set_value('nama_jabatan_fungsional',$apk["nama_jabatan_fungsional"]);
				$data['tgl_pengajuan']  = $this->m_rancak->fullBulan(date('d-m-Y', strtotime($apk['tgl_pengajuan'])));
				$data['id_jabatan']  = set_value('id_jabatan',$apk["id_jabatan"]);
				$data['id_instansi']  = set_value('id_instansi',$apk["id_instansi"]);
				$data['id_pengajuan']  = set_value('id_pengajuan',$apk["id_pengajuan"]);
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$apk["barcode_pengajuan"]);
				$data['status_pengajuan']  = set_value('status_pengajuan',$apk["status_pengajuan"]);
				$data['nama_pegawai']  = set_value('nama_pegawai',$apk["nama_pegawai"]);
				$data['nama_working']  = set_value('nama_working',$apk["nama_working"]);
				//=================================
$kondisi_asesor=array('barcode_pengajuan'=>$data["id"],'npv.id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi'],'id_jenis_form'=>$form["id_jenis_form"],'id_asesor'=>$this->session->id_pegawai);
				//=================================
				$jml_form = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi_form);
				if($jml_form == 0){
						$this->session->set_flashdata('danger', 'Belum Ada template untuk Form ini');
						redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$data['id']));
				}
$kondisi_format=array('barcode_pengajuan'=>$data["id"],'npv.id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi']);
				$data['format'] = $this->m_kredensial->ambil_form_clicked($kondisi_format);
				$data['kembali'] = base_url('validasi/pengajuan_kompetensi/beranda/'.$apk['barcode_pengajuan']);
$kondisi_validasi=array('barcode_pengajuan'=>$data["id"],'id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi'],'id_jenis_form'=>$form["id_jenis_form"],'id_asesor'=>$this->session->id_pegawai);
$data['jml_validasi'] = $this->m_umum->jumlah_record_filter('nkr_pengajuan_validasi',$kondisi_validasi);
				$data['kompetensi'] = $this->m_umum->ambil_data_explode('nkr_kompetensi','id_kompetensi',$apk['kode_unit_pengajuan']);
				$data['link_kompetensi'] = $this->m_kredensial->result_pengajuan_validasi_asesor($data['id'],$this->session->id_pegawai);
if($data['jml_validasi'] == 0){
	$data['kesesuaian_bukti']  = explode(",", $apk["kesesuaian_bukti"]);
	$data['ket_pengajuan_validasi']  = set_value('ket_pengajuan_validasi',$this->input->post('ket_pengajuan_validasi'));
	$data['tgl_asesi']  = set_value('tgl_asesi',$this->input->post('tgl_asesi'));
	$data['tgl_asesor']  = set_value('tgl_asesor',$this->input->post('tgl_asesor'));
	$data['nama_asesor']  = set_value('nama_asesor',$this->input->post('nama_asesor'));
	$data['barcode_pengajuan_validasi']  = set_value('barcode_pengajuan_validasi',$this->input->post('barcode_pengajuan_validasi'));
	$data['banding_form']  = set_value('banding_form',$this->input->post('banding_form'));
	$data['locked']  = set_value('locked',$this->input->post('locked'));
$data['form2_detil'] = $this->m_kredensial->ambil_nkr_grup_pra_asesmen($nkre_form['barcode_form'],'npa.id_pra_asesmen','no_urut_detil','ASC');
}else{
	$apv = $this->m_kredensial->ambil_pengajuan_validasi_asesor($kondisi_asesor);
	$data['kesesuaian_bukti']  = explode(",", $apv["kesesuaian_bukti_validasi"]);
	$data['ket_pengajuan_validasi']  = $apv["ket_pengajuan_validasi"];
	$data['tgl_asesi']  = set_value('tgl_asesi',$apv["tgl_asesi"]);
	$data['tgl_asesor']  = set_value('tgl_asesor',$apv["tgl_asesor"]);
	$data['nama_asesor']  = set_value('nama_asesor',$apv["nama_pegawai"]);
	$data['barcode_pengajuan_validasi']  = set_value('barcode_pengajuan_validasi',$apv["barcode_pengajuan_validasi"]);
	$data['banding_form']  = set_value('banding_form',$apv["banding_form"]);
	$data['locked']  = set_value('locked',$apv["locked"]);
$data['form2_detil'] = $this->m_kredensial->ambil_validasi_grup_pra_asesmen($apv['barcode_pengajuan_validasi'],'npa.id_pra_asesmen','no_urut_detil','ASC');
}
			//	$data['jawaban_asesi']  = set_value('jawaban_asesi',$this->input->post('jawaban_asesi'));
				$this->tampil_top($data);
				$status_pengajuan = $this->input->post('status_pengajuan');
				$id_jenis_form = $this->input->post('id_jenis_form');
				$id_kompetensi = $this->input->post('id_kompetensi');
				$barcode_pengajuan = $this->input->post('barcode_pengajuan');				
				$id_instansi = $this->input->post('id_instansi');				
$action = $this->input->post('action');
$kondisi_validasi=array('barcode_pengajuan'=>$barcode_pengajuan,'id_kompetensi'=>$id_kompetensi,'id_instansi'=>$id_instansi,'id_jenis_form'=>$id_jenis_form,'id_asesor'=>$this->session->id_pegawai);
$jml_validasi = $this->m_umum->jumlah_record_filter('nkr_pengajuan_validasi',$kondisi_validasi);
if($action == 'BtnSetuju') {
	if($status_pengajuan == 1){
		if($jml_validasi == 0){
			$last_kode = $this->m_validasi->pengajuan_validasi_berkas_simpan(1);
			$this->m_validasi->simpan_validasi_pra_asesmen($last_kode);
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');	
		}else{
			$this->m_validasi->pengajuan_validasi_berkas_edit(1,$this->session->id_pegawai);
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
		}
	}else{
			$this->session->set_flashdata('danger', 'Data Sudah Selesai');				
	}
			redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$barcode_pengajuan));		
}
if($action == 'BtnTolak') {
	if($status_pengajuan == 1){
		if($jml_validasi == 0){
			$last_kode = $this->m_validasi->pengajuan_validasi_berkas_simpan(2);
			$this->m_validasi->simpan_validasi_pra_asesmen($last_kode);
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
		}else{
			$this->m_validasi->pengajuan_validasi_berkas_edit(2,$this->session->id_pegawai);
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
		}
	}else{
			$this->session->set_flashdata('danger', 'Data Sudah Selesai');				
	}
			redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$barcode_pengajuan));		
}
      }
      if($mode=='keputusan'){
        $data['page'] =  $data['page']."_keputusan";
				$apk = $this->m_kredensial->ambil_pengajuan_kompetensi($data['id']); 	
				//=================================
				$form = $this->m_umum->ambil_data('kol_jenis_form','id_jenis_form',10);																			// form
				$data['nama_jenis_form']  = set_value('nama_jenis_form',$form["nama_jenis_form"]);
				//=================================
				$kondisi_form=array('id_jenis_form'=>$form["id_jenis_form"],'id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi']);
				$nkre_form = $this->m_umum->ambil_data_kondisi('nkr_form',$kondisi_form);		
				$data['barcode_form']  = set_value('barcode_form',$nkre_form["barcode_form"]);				
				$jml = $this->m_kredensial->cek_num_form_pengajuan_validator($data['id'],$this->session->id_pegawai,$form["id_jenis_form"]);						
				if ( $this->session->has_userdata('id_level') && $this->session->userdata('id_level')==99 ){}else{
					if($jml == 0 OR $apk['status_pengajuan'] == 0){
							$this->session->set_flashdata('danger', 'Bukan Validator Form ini / Status Belum Terkirim');
							redirect(base_url('validasi/pengajuan_kompetensi'));
					}
				}
				//=====================================
				$data['id_kompetensi']  = set_value('id_kompetensi',$apk['kode_unit_pengajuan']);
				$data['id_instansi']  = set_value('id_instansi',$apk['id_instansi']);
				$data['id_jenis_form']  = set_value('id_jenis_form',$form['id_jenis_form']);
				//=====================================
				$data['nama_status_diusulkan']  = set_value('nama_status_diusulkan',$apk["nama_status_diusulkan"]);
				$data['nama_jabatan_fungsional']  = set_value('nama_jabatan_fungsional',$apk["nama_jabatan_fungsional"]);
				$data['tgl_pengajuan']  = $this->m_rancak->fullBulan(date('d-m-Y', strtotime($apk['tgl_pengajuan'])));
				$data['id_jabatan']  = set_value('id_jabatan',$apk["id_jabatan"]);
				$data['id_instansi']  = set_value('id_instansi',$apk["id_instansi"]);
				$data['id_pengajuan']  = set_value('id_pengajuan',$apk["id_pengajuan"]);
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$apk["barcode_pengajuan"]);
				$data['status_pengajuan']  = set_value('status_pengajuan',$apk["status_pengajuan"]);
				$data['nama_pegawai']  = set_value('nama_pegawai',$apk["nama_pegawai"]);
				$data['nama_working']  = set_value('nama_working',$apk["nama_working"]);
				//=================================
$kondisi_asesor=array('barcode_pengajuan'=>$data["id"],'npv.id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi'],'id_jenis_form'=>$form["id_jenis_form"],'id_asesor'=>$this->session->id_pegawai);
				//=================================
$kondisi_format=array('barcode_pengajuan'=>$data["id"],'npv.id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi']);
				$data['format'] = $this->m_kredensial->ambil_form_clicked($kondisi_format);
				//=================================
				$jml_form = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi_form);
				if($jml_form == 0){
						$this->session->set_flashdata('danger', 'Belum Ada template untuk Form ini');
						redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$data['id']));
				}
				$data['kembali'] = base_url('validasi/pengajuan_kompetensi/beranda/'.$apk['barcode_pengajuan']);
$kondisi_validasi=array('barcode_pengajuan'=>$data["id"],'id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi'],'id_jenis_form'=>$form["id_jenis_form"],'id_asesor'=>$this->session->id_pegawai);
$data['jml_validasi'] = $this->m_umum->jumlah_record_filter('nkr_pengajuan_validasi',$kondisi_validasi);
if($data['jml_validasi'] == 0){
	$data['kesesuaian_bukti']  = explode(",", $apk["kesesuaian_bukti"]);
	$data['ket_pengajuan_validasi']  = set_value('ket_pengajuan_validasi',$this->input->post('ket_pengajuan_validasi'));
	$data['tgl_asesi']  = set_value('tgl_asesi',$this->input->post('tgl_asesi'));
	$data['tgl_asesor']  = set_value('tgl_asesor',$this->input->post('tgl_asesor'));
	$data['nama_asesor']  = set_value('nama_asesor',$this->input->post('nama_asesor'));
	$data['barcode_pengajuan_validasi']  = set_value('barcode_pengajuan_validasi',$this->input->post('barcode_pengajuan_validasi'));
	$data['banding_form']  = set_value('banding_form',$this->input->post('banding_form'));
	$data['locked']  = set_value('locked',$this->input->post('locked'));
}else{
	$apv = $this->m_kredensial->ambil_pengajuan_validasi_asesor($kondisi_asesor);
	$data['kesesuaian_bukti']  = explode(",", $apv["kesesuaian_bukti_validasi"]);
	$data['ket_pengajuan_validasi']  = $apv["ket_pengajuan_validasi"];
	$data['tgl_asesi']  = set_value('tgl_asesi',$apv["tgl_asesi"]);
	$data['tgl_asesor']  = set_value('tgl_asesor',$apv["tgl_asesor"]);
	$data['nama_asesor']  = set_value('nama_asesor',$apv["nama_pegawai"]);
	$data['barcode_pengajuan_validasi']  = set_value('barcode_pengajuan_validasi',$apv["barcode_pengajuan_validasi"]);
	$data['banding_form']  = set_value('banding_form',$apv["banding_form"]);
	$data['locked']  = set_value('locked',$apv["locked"]);
}
				$data['kompetensi'] = $this->m_umum->ambil_data_explode('nkr_kompetensi','id_kompetensi',$apk['kode_unit_pengajuan']);
				$data['link_kompetensi'] = $this->m_kredensial->result_pengajuan_validasi_asesor($data['id'],$this->session->id_pegawai);
			$data['form2_detil'] = $this->m_kredensial->ambil_validasi_grup_form7($apk['barcode_pengajuan'],'nas.id_elemen','no_urut_detil','ASC');
				$this->tampil_top($data);
				$status_pengajuan = $this->input->post('status_pengajuan');
				$id_jenis_form = $this->input->post('id_jenis_form');
				$id_kompetensi = $this->input->post('id_kompetensi');
				$barcode_pengajuan = $this->input->post('barcode_pengajuan');				
				$id_instansi = $this->input->post('id_instansi');				
$action = $this->input->post('action');
$kondisi_validasi=array('barcode_pengajuan'=>$barcode_pengajuan,'id_kompetensi'=>$id_kompetensi,'id_instansi'=>$id_instansi,'id_jenis_form'=>$id_jenis_form,'id_asesor'=>$this->session->id_pegawai);
$jml_validasi = $this->m_umum->jumlah_record_filter('nkr_pengajuan_validasi',$kondisi_validasi);
if($action == 'BtnSetuju') {
	if($status_pengajuan == 1){
		if($jml_validasi == 0){
			$last_kode = $this->m_validasi->pengajuan_validasi_berkas_simpan(1);
		//	$this->m_validasi->simpan_validasi_pra_asesmen($last_kode);
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');	
		}else{
			$this->m_validasi->pengajuan_validasi_berkas_edit(1,$this->session->id_pegawai);
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
		}
	}else{
			$this->session->set_flashdata('danger', 'Data Sudah Selesai');				
	}
			redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$barcode_pengajuan));		
}
if($action == 'BtnTolak') {
	if($status_pengajuan == 1){
		if($jml_validasi == 0){
			$last_kode = $this->m_validasi->pengajuan_validasi_berkas_simpan(2);
	//		$this->m_validasi->simpan_validasi_pra_asesmen($last_kode);
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
		}else{
			$this->m_validasi->pengajuan_validasi_berkas_edit(2,$this->session->id_pegawai);
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
		}
	}else{
			$this->session->set_flashdata('danger', 'Data Sudah Selesai');				
	}
			redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$barcode_pengajuan));		
}
      }
      if($mode=='banding'){
        $data['page'] =  $data['page']."_banding";
				$apk = $this->m_kredensial->ambil_pengajuan_kompetensi($data['id']); 	
				//=================================
				$form = $this->m_umum->ambil_data('kol_jenis_form','id_jenis_form',11);	
				$data['nama_jenis_form']  = set_value('nama_jenis_form',$form["nama_jenis_form"]);
				//=================================
				$kondisi_form=array('id_jenis_form'=>$form["id_jenis_form"],'id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi']);
				$nkre_form = $this->m_umum->ambil_data_kondisi('nkr_form',$kondisi_form);		
				$data['barcode_form']  = set_value('barcode_form',$nkre_form["barcode_form"]);				
				$jml = $this->m_kredensial->cek_num_form_pengajuan_validator($data['id'],$this->session->id_pegawai,$form["id_jenis_form"]);						
				if ( $this->session->has_userdata('id_level') && $this->session->userdata('id_level')==99 ){}else{
					if($jml == 0 OR $apk['status_pengajuan'] == 0){
							$this->session->set_flashdata('danger', 'Bukan Validator Form ini / Status Belum Terkirim');
							redirect(base_url('validasi/pengajuan_kompetensi'));
					}
				}
				//=====================================
				$data['id_kompetensi']  = set_value('id_kompetensi',$apk['kode_unit_pengajuan']);
				$data['id_instansi']  = set_value('id_instansi',$apk['id_instansi']);
				$data['id_jenis_form']  = set_value('id_jenis_form',$form['id_jenis_form']);
				//=====================================
				$data['nama_status_diusulkan']  = set_value('nama_status_diusulkan',$apk["nama_status_diusulkan"]);
				$data['nama_jabatan_fungsional']  = set_value('nama_jabatan_fungsional',$apk["nama_jabatan_fungsional"]);
				$data['tgl_pengajuan']  = $this->m_rancak->fullBulan(date('d-m-Y', strtotime($apk['tgl_pengajuan'])));
				$data['id_jabatan']  = set_value('id_jabatan',$apk["id_jabatan"]);
				$data['id_instansi']  = set_value('id_instansi',$apk["id_instansi"]);
				$data['id_pengajuan']  = set_value('id_pengajuan',$apk["id_pengajuan"]);
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$apk["barcode_pengajuan"]);
				$data['status_pengajuan']  = set_value('status_pengajuan',$apk["status_pengajuan"]);
				$data['nama_pegawai']  = set_value('nama_pegawai',$apk["nama_pegawai"]);
				$data['nama_working']  = set_value('nama_working',$apk["nama_working"]);
				//=================================
$kondisi_asesor=array('barcode_pengajuan'=>$data["id"],'npv.id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi'],'id_jenis_form'=>$form["id_jenis_form"],'id_asesor'=>$this->session->id_pegawai);
				//=================================
$kondisi_format=array('barcode_pengajuan'=>$data["id"],'npv.id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi']);
				$data['format'] = $this->m_kredensial->ambil_form_clicked($kondisi_format);
				//=================================
				$jml_form = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi_form);
				if($jml_form == 0){
						$this->session->set_flashdata('danger', 'Belum Ada template untuk Form ini');
						redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$data['id']));
				}
				$data['kembali'] = base_url('validasi/pengajuan_kompetensi/beranda/'.$apk['barcode_pengajuan']);
$kondisi_validasi=array('barcode_pengajuan'=>$data["id"],'id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi'],'id_jenis_form'=>$form["id_jenis_form"],'id_asesor'=>$this->session->id_pegawai);
$data['jml_validasi'] = $this->m_umum->jumlah_record_filter('nkr_pengajuan_validasi',$kondisi_validasi);
if($data['jml_validasi'] == 0){
	$data['kesesuaian_bukti']  = explode(",", $apk["kesesuaian_bukti"]);
	$data['ket_pengajuan_validasi']  = set_value('ket_pengajuan_validasi',$this->input->post('ket_pengajuan_validasi'));
	$data['tgl_asesi']  = set_value('tgl_asesi',$this->input->post('tgl_asesi'));
	$data['tgl_asesor']  = set_value('tgl_asesor',$this->input->post('tgl_asesor'));
	$data['nama_asesor']  = set_value('nama_asesor',$this->input->post('nama_asesor'));
	$data['barcode_pengajuan_validasi']  = set_value('barcode_pengajuan_validasi',$this->input->post('barcode_pengajuan_validasi'));
	$data['banding_form']  = set_value('banding_form',$this->input->post('banding_form'));
	$data['banding_asesi']  = set_value('banding_asesi',$this->input->post('banding_asesi'));
	$data['banding_form_lama']  = set_value('banding_form_lama',$this->input->post('banding_form_lama'));
	$data['locked']  = set_value('locked',$this->input->post('locked'));
	$data['nama_banding_form']  = set_value('nama_banding_form',$this->input->post('nama_banding_form'));
}else{
	$apv = $this->m_kredensial->ambil_pengajuan_validasi_asesor($kondisi_asesor);
	$data['kesesuaian_bukti']  = explode(",", $apv["kesesuaian_bukti_validasi"]);
	$data['ket_pengajuan_validasi']  = $apv["ket_pengajuan_validasi"];
	$data['tgl_asesi']  = set_value('tgl_asesi',$apv["tgl_asesi"]);
	$data['tgl_asesor']  = set_value('tgl_asesor',$apv["tgl_asesor"]);
	$data['nama_asesor']  = set_value('nama_asesor',$apv["nama_pegawai"]);
	$data['barcode_pengajuan_validasi']  = set_value('barcode_pengajuan_validasi',$apv["barcode_pengajuan_validasi"]);
	$data['banding_form']  = set_value('banding_form',$apv["banding_form"]);
	$data['banding_asesi']  = set_value('banding_asesi',$apv["banding_asesi"]);
	$data['locked']  = set_value('locked',$apv["locked"]);
	$data['banding_form_lama']  = set_value('banding_form_lama',$apv["banding_form"]);
	$bpve = $this->m_umum->ambil_data('kol_jenis_form','id_jenis_form',$apv["banding_form"]);
	$data['nama_banding_form']  = set_value('nama_banding_form',$bpve["nama_jenis_form"]);
}
				$data['kompetensi'] = $this->m_umum->ambil_data_explode('nkr_kompetensi','id_kompetensi',$apk['kode_unit_pengajuan']);
				//=================================
				$this->tampil_top($data);
				$banding_form = $this->input->post('banding_form');
				$status_pengajuan = $this->input->post('status_pengajuan');
				$id_jenis_form = $this->input->post('id_jenis_form');
				$id_kompetensi = $this->input->post('id_kompetensi');
				$barcode_pengajuan = $this->input->post('barcode_pengajuan');				
				$barcode_pengajuan_validasi = $this->input->post('barcode_pengajuan_validasi');				
				$id_instansi = $this->input->post('id_instansi');		
$action = $this->input->post('action');
$kondisi_validasi=array('barcode_pengajuan'=>$barcode_pengajuan,'id_kompetensi'=>$id_kompetensi,'id_instansi'=>$id_instansi,'id_jenis_form'=>$id_jenis_form,'id_asesor'=>$this->session->id_pegawai);
$jml_validasi = $this->m_umum->jumlah_record_filter('nkr_pengajuan_validasi',$kondisi_validasi);
if($action == 'BtnBuka') {
	if($status_pengajuan == 1){
	//	if($jml_validasi == 0){
			if(empty($banding_form)){
				$this->session->set_flashdata('danger', 'Form Banding Tidak Boleh Kosong');
				redirect(base_url('validasi/pengajuan_kompetensi/banding/'.$barcode_pengajuan));
			}else{
				$last_kode = $this->m_validasi->pengajuan_validasi_banding_berkas_simpan_locked(1);
				$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');	
			}
	//	}
	}else{
			$this->session->set_flashdata('danger', 'Data Sudah Selesai');				
	}
			redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$barcode_pengajuan));		
}
if($action == 'BtnSimpan') {
	if($status_pengajuan == 1){
	//	if($jml_validasi == 0){
/*			if(empty($banding_form)){
				$this->session->set_flashdata('danger', 'Form Banding Tidak Boleh Kosong');
				redirect(base_url('validasi/pengajuan_kompetensi/banding/'.$barcode_pengajuan));
			}else{*/
				$this->m_validasi->pengajuan_validasi_banding_locked_berkas_edit($barcode_pengajuan_validasi);
				$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');	
//			}
	//	}
	}else{
			$this->session->set_flashdata('danger', 'Data Sudah Selesai');				
	}
			redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$barcode_pengajuan));		
}
if($action == 'BtnSetuju') {
	if($status_pengajuan == 1){
		if($this->m_validasi->pengajuan_validasi_banding_berkas_simpan(1,$barcode_pengajuan_validasi)){
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
		}else{
			$this->session->set_flashdata('danger', 'Ada masalah Simpan Data');
		}
	}else{
			$this->session->set_flashdata('danger', 'Data Sudah Selesai');				
	}
			redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$barcode_pengajuan));		
}
if($action == 'BtnTolak') {
	if($status_pengajuan == 1){
		if($this->m_validasi->pengajuan_validasi_banding_berkas_simpan(2,$barcode_pengajuan_validasi)){
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
		}else{
			$this->session->set_flashdata('danger', 'Ada masalah Simpan Data');
		}
	}else{
			$this->session->set_flashdata('danger', 'Data Sudah Selesai');				
	}
			redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$barcode_pengajuan));		
}
      }
      if($mode=='komponen'){
        $data['page'] =  $data['page']."_komponen";
				$apk = $this->m_kredensial->ambil_pengajuan_kompetensi($data['id']); 	
				//=================================
				$form = $this->m_umum->ambil_data('kol_jenis_form','id_jenis_form',12);
				$data['nama_jenis_form']  = set_value('nama_jenis_form',$form["nama_jenis_form"]);
				//=================================
				$kondisi_form=array('id_jenis_form'=>$form["id_jenis_form"],'id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi']);
				$nkre_form = $this->m_umum->ambil_data_kondisi('nkr_form',$kondisi_form);		
				$data['barcode_form']  = set_value('barcode_form',$nkre_form["barcode_form"]);				
				$jml = $this->m_kredensial->cek_num_form_pengajuan_validator($data['id'],$this->session->id_pegawai,$form["id_jenis_form"]);						
				if ( $this->session->has_userdata('id_level') && $this->session->userdata('id_level')==99 ){}else{
					if($jml == 0 OR $apk['status_pengajuan'] == 0){
							$this->session->set_flashdata('danger', 'Bukan Validator Form ini / Status Belum Terkirim');
							redirect(base_url('validasi/pengajuan_kompetensi'));
					}
				}
				//=====================================
				$data['id_kompetensi']  = set_value('id_kompetensi',$apk['kode_unit_pengajuan']);
				$data['id_instansi']  = set_value('id_instansi',$apk['id_instansi']);
				$data['id_jenis_form']  = set_value('id_jenis_form',$form['id_jenis_form']);
				//=====================================
				$data['nama_status_diusulkan']  = set_value('nama_status_diusulkan',$apk["nama_status_diusulkan"]);
				$data['nama_jabatan_fungsional']  = set_value('nama_jabatan_fungsional',$apk["nama_jabatan_fungsional"]);
				$data['tgl_pengajuan']  = $this->m_rancak->fullBulan(date('d-m-Y', strtotime($apk['tgl_pengajuan'])));
				$data['id_jabatan']  = set_value('id_jabatan',$apk["id_jabatan"]);
				$data['id_instansi']  = set_value('id_instansi',$apk["id_instansi"]);
				$data['id_pengajuan']  = set_value('id_pengajuan',$apk["id_pengajuan"]);
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$apk["barcode_pengajuan"]);
				$data['status_pengajuan']  = set_value('status_pengajuan',$apk["status_pengajuan"]);
				$data['nama_pegawai']  = set_value('nama_pegawai',$apk["nama_pegawai"]);
				$data['nama_working']  = set_value('nama_working',$apk["nama_working"]);
				//=================================
$kondisi_asesor=array('barcode_pengajuan'=>$data["id"],'npv.id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi'],'id_jenis_form'=>$form["id_jenis_form"],'id_asesor'=>$this->session->id_pegawai);
				//=================================
$kondisi_format=array('barcode_pengajuan'=>$data["id"],'npv.id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi']);
				$data['format'] = $this->m_kredensial->ambil_form_clicked($kondisi_format);
				//=================================
				$jml_form = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi_form);
				if($jml_form == 0){
						$this->session->set_flashdata('danger', 'Belum Ada template untuk Form ini');
						redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$data['id']));
				}
				$data['kembali'] = base_url('validasi/pengajuan_kompetensi/beranda/'.$apk['barcode_pengajuan']);
$kondisi_validasi=array('barcode_pengajuan'=>$data["id"],'id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi'],'id_jenis_form'=>$form["id_jenis_form"],'id_asesor'=>$this->session->id_pegawai);
$data['jml_validasi'] = $this->m_umum->jumlah_record_filter('nkr_pengajuan_validasi',$kondisi_validasi);
				$data['kompetensi'] = $this->m_umum->ambil_data_explode('nkr_kompetensi','id_kompetensi',$apk['kode_unit_pengajuan']);
if($data['jml_validasi'] == 0){
	$data['kesesuaian_bukti']  = explode(",", $apk["kesesuaian_bukti"]);
	$data['ket_pengajuan_validasi']  = set_value('ket_pengajuan_validasi',$this->input->post('ket_pengajuan_validasi'));
	$data['tgl_asesi']  = set_value('tgl_asesi',$this->input->post('tgl_asesi'));
	$data['tgl_asesor']  = set_value('tgl_asesor',$this->input->post('tgl_asesor'));
	$data['nama_asesor']  = set_value('nama_asesor',$this->input->post('nama_asesor'));
	$data['barcode_pengajuan_validasi']  = set_value('barcode_pengajuan_validasi',$this->input->post('barcode_pengajuan_validasi'));
	$data['banding_form']  = set_value('banding_form',$this->input->post('banding_form'));
	$data['banding_asesi']  = set_value('banding_asesi',$this->input->post('banding_asesi'));
	$data['locked']  = set_value('locked',$this->input->post('locked'));
//$data['formgrup'] = $this->m_kredensial->ambil_nkr_grup_kaji_ulang($nkre_form['barcode_form'],'npd.id_kat_kaji','npd.id_kat_kaji','ASC');
$data['form'] = $this->m_kredensial->ambil_nkr_no_grup_kaji_ulang($nkre_form['barcode_form'],'nfd2.id_kaji_ulang','ASC');
}else{
	$apv = $this->m_kredensial->ambil_pengajuan_validasi_asesor($kondisi_asesor);
	$data['kesesuaian_bukti']  = explode(",", $apv["kesesuaian_bukti_validasi"]);
	$data['ket_pengajuan_validasi']  = $apv["ket_pengajuan_validasi"];
	$data['tgl_asesi']  = set_value('tgl_asesi',$apv["tgl_asesi"]);
	$data['tgl_asesor']  = set_value('tgl_asesor',$apv["tgl_asesor"]);
	$data['nama_asesor']  = set_value('nama_asesor',$apv["nama_pegawai"]);
	$data['barcode_pengajuan_validasi']  = set_value('barcode_pengajuan_validasi',$apv["barcode_pengajuan_validasi"]);
	$data['banding_form']  = set_value('banding_form',$apv["banding_form"]);
	$data['banding_asesi']  = set_value('banding_asesi',$apv["banding_asesi"]);
	$data['locked']  = set_value('locked',$apv["locked"]);
$data['form'] = $this->m_kredensial->ambil_validasi_kaji_pra_detil($apv['barcode_pengajuan_validasi'],'nvd.id_kaji_ulang','ASC');
}
				$this->tampil_top($data);
				$status_pengajuan = $this->input->post('status_pengajuan');
				$id_jenis_form = $this->input->post('id_jenis_form');
				$id_kompetensi = $this->input->post('id_kompetensi');
				$barcode_pengajuan = $this->input->post('barcode_pengajuan');				
				$barcode_pengajuan_validasi = $this->input->post('barcode_pengajuan_validasi');				
				$id_instansi = $this->input->post('id_instansi');				
$action = $this->input->post('action');
$kondisi_validasi=array('barcode_pengajuan'=>$barcode_pengajuan,'id_kompetensi'=>$id_kompetensi,'id_instansi'=>$id_instansi,'id_jenis_form'=>$id_jenis_form,'id_asesor'=>$this->session->id_pegawai);
$jml_validasi = $this->m_umum->jumlah_record_filter('nkr_pengajuan_validasi',$kondisi_validasi);
if($action == 'BtnAktif') {
	if($status_pengajuan == 1){
		if($last_kode = $this->m_validasi->pengajuan_validasi_aktifasi_soal(1)){
			$this->m_validasi->simpan_validasi_kaji_ulang($last_kode);
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');	
		}else{
			$this->session->set_flashdata('danger', 'Ada masalah simpan Data');
		}
	}else{
			$this->session->set_flashdata('danger', 'Data Sudah Selesai');				
	}
			redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$barcode_pengajuan));		
}
if($action == 'BtnSetuju') {
	if($status_pengajuan == 1){
		if($this->m_validasi->pengajuan_validasi_banding_berkas_simpan(1,$barcode_pengajuan_validasi)){
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
		}else{
			$this->session->set_flashdata('danger', 'Ada masalah Simpan Data');
		}
	}else{
			$this->session->set_flashdata('danger', 'Data Sudah Selesai');				
	}
			redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$barcode_pengajuan));		
}
if($action == 'BtnTolak') {
	if($status_pengajuan == 1){
		if($this->m_validasi->pengajuan_validasi_banding_berkas_simpan(2,$barcode_pengajuan_validasi)){
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
		}else{
			$this->session->set_flashdata('danger', 'Ada masalah Simpan Data');
		}
	}else{
			$this->session->set_flashdata('danger', 'Data Sudah Selesai');				
	}
			redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$barcode_pengajuan));		
}
      }
      if($mode=='kesenjangan'){
        $data['page'] =  $data['page']."_kesenjangan";
				$apk = $this->m_kredensial->ambil_pengajuan_kompetensi($data['id']); 	
				//=================================
				$form = $this->m_umum->ambil_data('kol_jenis_form','id_jenis_form',13);
				$data['nama_jenis_form']  = set_value('nama_jenis_form',$form["nama_jenis_form"]);
				//=================================
				$kondisi_form=array('id_jenis_form'=>$form["id_jenis_form"],'id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi']);
				$nkre_form = $this->m_umum->ambil_data_kondisi('nkr_form',$kondisi_form);		
				$data['barcode_form']  = set_value('barcode_form',$nkre_form["barcode_form"]);				
				$jml = $this->m_kredensial->cek_num_form_pengajuan_validator($data['id'],$this->session->id_pegawai,$form["id_jenis_form"]);						
				if ( $this->session->has_userdata('id_level') && $this->session->userdata('id_level')==99 ){}else{
					if($jml == 0 OR $apk['status_pengajuan'] == 0){
							$this->session->set_flashdata('danger', 'Bukan Validator Form ini / Status Belum Terkirim');
							redirect(base_url('validasi/pengajuan_kompetensi'));
					}
				}
				//=====================================
				$data['id_kompetensi']  = set_value('id_kompetensi',$apk['kode_unit_pengajuan']);
				$data['id_instansi']  = set_value('id_instansi',$apk['id_instansi']);
				$data['id_jenis_form']  = set_value('id_jenis_form',$form['id_jenis_form']);
				//=====================================
				$data['nama_status_diusulkan']  = set_value('nama_status_diusulkan',$apk["nama_status_diusulkan"]);
				$data['nama_jabatan_fungsional']  = set_value('nama_jabatan_fungsional',$apk["nama_jabatan_fungsional"]);
				$data['tgl_pengajuan']  = $this->m_rancak->fullBulan(date('d-m-Y', strtotime($apk['tgl_pengajuan'])));
				$data['id_jabatan']  = set_value('id_jabatan',$apk["id_jabatan"]);
				$data['id_instansi']  = set_value('id_instansi',$apk["id_instansi"]);
				$data['id_pengajuan']  = set_value('id_pengajuan',$apk["id_pengajuan"]);
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$apk["barcode_pengajuan"]);
				$data['status_pengajuan']  = set_value('status_pengajuan',$apk["status_pengajuan"]);
				$data['nama_pegawai']  = set_value('nama_pegawai',$apk["nama_pegawai"]);
				$data['nama_working']  = set_value('nama_working',$apk["nama_working"]);
				//=================================
$kondisi_asesor=array('barcode_pengajuan'=>$data["id"],'npv.id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi'],'id_jenis_form'=>$form["id_jenis_form"],'id_asesor'=>$this->session->id_pegawai);
				//=================================
$kondisi_format=array('barcode_pengajuan'=>$data["id"],'npv.id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi']);
				$data['format'] = $this->m_kredensial->ambil_form_clicked($kondisi_format);
				//=================================
				$jml_form = $this->m_umum->jumlah_record_filter('nkr_form',$kondisi_form);
				if($jml_form == 0){
						$this->session->set_flashdata('danger', 'Belum Ada template untuk Form ini');
						redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$data['id']));
				}
				$data['kembali'] = base_url('validasi/pengajuan_kompetensi/beranda/'.$apk['barcode_pengajuan']);
$kondisi_validasi=array('barcode_pengajuan'=>$data["id"],'id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi'],'id_jenis_form'=>$form["id_jenis_form"],'id_asesor'=>$this->session->id_pegawai);
$data['jml_validasi'] = $this->m_umum->jumlah_record_filter('nkr_pengajuan_validasi',$kondisi_validasi);
				$data['kompetensi'] = $this->m_umum->ambil_data_explode('nkr_kompetensi','id_kompetensi',$apk['kode_unit_pengajuan']);
if($data['jml_validasi'] == 0){
	$data['kesesuaian_bukti']  = explode(",", $apk["kesesuaian_bukti"]);
	$data['ket_pengajuan_validasi']  = set_value('ket_pengajuan_validasi',$this->input->post('ket_pengajuan_validasi'));
	$data['tgl_asesi']  = set_value('tgl_asesi',$this->input->post('tgl_asesi'));
	$data['tgl_asesor']  = set_value('tgl_asesor',$this->input->post('tgl_asesor'));
	$data['nama_asesor']  = set_value('nama_asesor',$this->input->post('nama_asesor'));
	$data['barcode_pengajuan_validasi']  = set_value('barcode_pengajuan_validasi',$this->input->post('barcode_pengajuan_validasi'));
	$data['banding_form']  = set_value('banding_form',$this->input->post('banding_form'));
	$data['banding_asesi']  = set_value('banding_asesi',$this->input->post('banding_asesi'));
	$data['locked']  = set_value('locked',$this->input->post('locked'));
//$data['formgrup'] = $this->m_kredensial->ambil_nkr_grup_kaji_ulang($nkre_form['barcode_form'],'npd.id_kat_kaji','npd.id_kat_kaji','ASC');
$data['form'] = $this->m_kredensial->ambil_nkr_grup_kaji_ulang($nkre_form['barcode_form'],'npd.id_kat_kaji','npd.id_kat_kaji','ASC');
}else{
	$apv = $this->m_kredensial->ambil_pengajuan_validasi_asesor($kondisi_asesor);
	$data['kesesuaian_bukti']  = explode(",", $apv["kesesuaian_bukti_validasi"]);
	$data['ket_pengajuan_validasi']  = $apv["ket_pengajuan_validasi"];
	$data['tgl_asesi']  = set_value('tgl_asesi',$apv["tgl_asesi"]);
	$data['tgl_asesor']  = set_value('tgl_asesor',$apv["tgl_asesor"]);
	$data['nama_asesor']  = set_value('nama_asesor',$apv["nama_pegawai"]);
	$data['barcode_pengajuan_validasi']  = set_value('barcode_pengajuan_validasi',$apv["barcode_pengajuan_validasi"]);
	$data['banding_form']  = set_value('banding_form',$apv["banding_form"]);
	$data['banding_asesi']  = set_value('banding_asesi',$apv["banding_asesi"]);
	$data['locked']  = set_value('locked',$apv["locked"]);
$data['form'] = $this->m_kredensial->ambil_validasi_grup_kaji_pra_detil($apv['barcode_pengajuan_validasi'],'nvd.id_kat_kaji','nvd.id_kat_kaji','ASC');
}
				$this->tampil_top($data);
				$status_pengajuan = $this->input->post('status_pengajuan');
				$barcode_pengajuan_validasi = $this->input->post('barcode_pengajuan_validasi');
				$id_jenis_form = $this->input->post('id_jenis_form');
				$id_kompetensi = $this->input->post('id_kompetensi');
				$barcode_pengajuan = $this->input->post('barcode_pengajuan');				
				$id_instansi = $this->input->post('id_instansi');				
$action = $this->input->post('action');
$kondisi_validasi=array('barcode_pengajuan'=>$barcode_pengajuan,'id_kompetensi'=>$id_kompetensi,'id_instansi'=>$id_instansi,'id_jenis_form'=>$id_jenis_form,'id_asesor'=>$this->session->id_pegawai);
$jml_validasi = $this->m_umum->jumlah_record_filter('nkr_pengajuan_validasi',$kondisi_validasi);
if($action == 'BtnAktif') {
	if($status_pengajuan == 1){
		if($last_kode = $this->m_validasi->pengajuan_validasi_aktifasi_soal(1)){
			$this->m_validasi->simpan_validasi_kaji_ulang($last_kode);
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');	
		}else{
			$this->session->set_flashdata('danger', 'Ada masalah simpan Data');
		}
	}else{
			$this->session->set_flashdata('danger', 'Data Sudah Selesai');				
	}
			redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$barcode_pengajuan));		
}
if($action == 'BtnSetuju') {
	if($status_pengajuan == 1){
		if($this->m_validasi->pengajuan_validasi_banding_berkas_simpan(1,$barcode_pengajuan_validasi)){
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
		}else{
			$this->session->set_flashdata('danger', 'Ada masalah Simpan Data');
		}
	}else{
			$this->session->set_flashdata('danger', 'Data Sudah Selesai');				
	}
			redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$barcode_pengajuan));		
}
if($action == 'BtnTolak') {
	if($status_pengajuan == 1){
		if($this->m_validasi->pengajuan_validasi_banding_berkas_simpan(2,$barcode_pengajuan_validasi)){
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
		}else{
			$this->session->set_flashdata('danger', 'Ada masalah Simpan Data');
		}
	}else{
			$this->session->set_flashdata('danger', 'Data Sudah Selesai');				
	}
			redirect(base_url('validasi/pengajuan_kompetensi/beranda/'.$barcode_pengajuan));		
}
      }
// ========================================================================================================================
      if($mode=='permohonan_modal'){
        $data['page'] =  $data['page']."_permohonan_modal";
				$apv = $this->m_kredensial->ambil_pengajuan_validasi_pengajuan_valiasi($data['id']);
				$asesor = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$apv["id_asesor"]);
				$data['kesesuaian_bukti']  = explode(",", $apv["kesesuaian_bukti_validasi"]);
				$data['nama_asesor']  = set_value('nama_asesor',$asesor["nama_pegawai"]);
				$data['barcode_pengajuan_validasi']  = set_value('barcode_pengajuan_validasi',$apv["barcode_pengajuan_validasi"]);
				$data['validasi']  = set_value('validasi',$apv["validasi"]);
				$data['tgl_asesi']  = set_value('tgl_asesi',$apv["tgl_asesi"]);
				$data['tgl_asesor']  = set_value('tgl_asesor',$apv["tgl_asesor"]);
				$data['ket_pengajuan_validasi']  = set_value('ket_pengajuan_validasi',$apv["ket_pengajuan_validasi"]);
				$data['id_jenis_form']  = set_value('id_jenis_form',$apv["id_jenis_form"]);
				$data['nama_jenis_form']  = set_value('nama_jenis_form',$apv["nama_jenis_form"]);
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$apv["barcode_pengajuan"]);
				//====================================================
				$apk = $this->m_kredensial->ambil_pengajuan_kompetensi($apv['barcode_pengajuan']);
				$data['id_berkas']  = explode(",", $apk["id_berkas"]);
				$data['berkas']  = $apk["id_berkas"];
				$data['id_ijasah']  = explode(",", $apk["id_ijasah"]);
				$data['ijasah']  = $apk["id_ijasah"];
				$data['id_str']  = explode(",", $apk["id_str"]);
				$data['str']  = $apk["id_str"];
				$data['id_sertifikat']  = explode(",", $apk["id_sertifikat"]);
				$data['sertifikat']  = $apk["id_sertifikat"];
				$data['id_etik_pegawai']  = explode(",", $apk["id_etik_pegawai"]);
				$data['ambil_berkas_data']=$this->m_ol_rancak->ambil_id_berkas_data($apk['id_pegawai']);
        $data['ambil_data_etik_pegawai_oppe'] = $this->m_ol_rancak->ambil_data_etik_pegawai_oppe($apk["id_pegawai"],date('Y'));
				//====================================================
				$this->load->view("validasi/isi",$data);
      }
      if($mode=='asesmen_modal'){
        $data['page'] =  $data['page']."_asesmen_modal";
				$apv = $this->m_kredensial->ambil_pengajuan_validasi_pengajuan_valiasi($data['id']);
				$asesor = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$apv["id_asesor"]);
				$data['kesesuaian_bukti']  = explode(",", $apv["kesesuaian_bukti_validasi"]);
				$data['nama_asesor']  = set_value('nama_asesor',$asesor["nama_pegawai"]);
				$data['barcode_pengajuan_validasi']  = set_value('barcode_pengajuan_validasi',$apv["barcode_pengajuan_validasi"]);
				$data['validasi']  = set_value('validasi',$apv["validasi"]);
				$data['tgl_asesi']  = set_value('tgl_asesi',$apv["tgl_asesi"]);
				$data['tgl_asesor']  = set_value('tgl_asesor',$apv["tgl_asesor"]);
				$data['ket_pengajuan_validasi']  = set_value('ket_pengajuan_validasi',$apv["ket_pengajuan_validasi"]);
				$data['id_jenis_form']  = set_value('id_jenis_form',$apv["id_jenis_form"]);
				$data['nama_jenis_form']  = set_value('nama_jenis_form',$apv["nama_jenis_form"]);
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$apv["barcode_pengajuan"]);
				//====================================================
				$data['form'] = $this->m_kredensial->ambil_nkr_validasi_question_detil($apv['barcode_pengajuan_validasi']);
				//====================================================
				$this->load->view("validasi/isi",$data);
      }
      if($mode=='rencana_modal'){
        $data['page'] =  $data['page']."_rencana_modal";
				$apv = $this->m_kredensial->ambil_pengajuan_validasi_pengajuan_valiasi($data['id']);
				$asesor = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$apv["id_asesor"]);
				$data['kesesuaian_bukti']  = explode(",", $apv["kesesuaian_bukti_validasi"]);
				$data['nama_asesor']  = set_value('nama_asesor',$asesor["nama_pegawai"]);
				$data['barcode_pengajuan_validasi']  = set_value('barcode_pengajuan_validasi',$apv["barcode_pengajuan_validasi"]);
				$data['validasi']  = set_value('validasi',$apv["validasi"]);
				$data['tgl_asesi']  = set_value('tgl_asesi',$apv["tgl_asesi"]);
				$data['tgl_asesor']  = set_value('tgl_asesor',$apv["tgl_asesor"]);
				$data['ket_pengajuan_validasi']  = set_value('ket_pengajuan_validasi',$apv["ket_pengajuan_validasi"]);
				$data['id_jenis_form']  = set_value('id_jenis_form',$apv["id_jenis_form"]);
				$data['id_kompetensi']  = set_value('id_kompetensi',$apv["id_kompetensi"]);
				$data['id_instansi']  = set_value('id_instansi',$apv["id_instansi"]);
				$data['nama_jenis_form']  = set_value('nama_jenis_form',$apv["nama_jenis_form"]);
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$apv["barcode_pengajuan"]);
				$data['barcode_form']  = set_value('barcode_form',$apv["barcode_form"]);
				//====================================================
				$data['detil_elemen'] = $this->m_kredensial->ambil_nkr_grup_indikator_validasi($apv["barcode_pengajuan_validasi"],'nas.id_elemen','no_urut_detil','asc');
				$data['perangkat'] = $this->m_umum->ambil_data('nkr_perangkat');
				$data['metode'] = $this->m_umum->ambil_data('nkr_metode');
				$data['alat'] = $this->m_umum->ambil_data('nkr_alat');
				//====================================================
				$this->load->view("validasi/isi",$data);
      }
      if($mode=='observasi_modal'){
        $data['page'] =  $data['page']."_observasi_modal";
				$apv = $this->m_kredensial->ambil_pengajuan_validasi_pengajuan_valiasi($data['id']);
				$asesor = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$apv["id_asesor"]);
				$data['kesesuaian_bukti']  = explode(",", $apv["kesesuaian_bukti_validasi"]);
				$data['nama_asesor']  = set_value('nama_asesor',$asesor["nama_pegawai"]);
				$data['barcode_pengajuan_validasi']  = set_value('barcode_pengajuan_validasi',$apv["barcode_pengajuan_validasi"]);
				$data['validasi']  = set_value('validasi',$apv["validasi"]);
				$data['tgl_asesi']  = set_value('tgl_asesi',$apv["tgl_asesi"]);
				$data['tgl_asesor']  = set_value('tgl_asesor',$apv["tgl_asesor"]);
				$data['ket_pengajuan_validasi']  = set_value('ket_pengajuan_validasi',$apv["ket_pengajuan_validasi"]);
				$data['id_jenis_form']  = set_value('id_jenis_form',$apv["id_jenis_form"]);
				$data['nama_jenis_form']  = set_value('nama_jenis_form',$apv["nama_jenis_form"]);
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$apv["barcode_pengajuan"]);
	//			$data['barcode_form']  = set_value('barcode_form',$apv["barcode_form"]);
				//====================================================
				$data['form'] = $this->m_kredensial->ambil_nkr_validasi_indikator_detil($apv['barcode_pengajuan_validasi']);
				//====================================================
				$this->load->view("validasi/isi",$data);
      }
      if($mode=='lisan_modal'){
        $data['page'] =  $data['page']."_lisan_modal";
				$apv = $this->m_kredensial->ambil_pengajuan_validasi_pengajuan_valiasi($data['id']);
				$asesor = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$apv["id_asesor"]);
				$data['kesesuaian_bukti']  = explode(",", $apv["kesesuaian_bukti_validasi"]);
				$data['nama_asesor']  = set_value('nama_asesor',$asesor["nama_pegawai"]);
				$data['barcode_pengajuan_validasi']  = set_value('barcode_pengajuan_validasi',$apv["barcode_pengajuan_validasi"]);
				$data['validasi']  = set_value('validasi',$apv["validasi"]);
				$data['tgl_asesi']  = set_value('tgl_asesi',$apv["tgl_asesi"]);
				$data['tgl_asesor']  = set_value('tgl_asesor',$apv["tgl_asesor"]);
				$data['ket_pengajuan_validasi']  = set_value('ket_pengajuan_validasi',$apv["ket_pengajuan_validasi"]);
				$data['id_jenis_form']  = set_value('id_jenis_form',$apv["id_jenis_form"]);
				$data['nama_jenis_form']  = set_value('nama_jenis_form',$apv["nama_jenis_form"]);
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$apv["barcode_pengajuan"]);
		//		$data['barcode_form']  = set_value('barcode_form',$apv["barcode_form"]);
				//====================================================
				$data['form'] = $this->m_kredensial->ambil_nkr_validasi_indikator_detil($apv['barcode_pengajuan_validasi']);
				//====================================================
				$this->load->view("validasi/isi",$data);
      }
      if($mode=='tulis_modal'){
        $data['page'] =  $data['page']."_tulis_modal";
				$apv = $this->m_kredensial->ambil_pengajuan_validasi_pengajuan_valiasi($data['id']);
				$asesor = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$apv["id_asesor"]);
				$data['kesesuaian_bukti']  = explode(",", $apv["kesesuaian_bukti_validasi"]);
				$data['nama_asesor']  = set_value('nama_asesor',$asesor["nama_pegawai"]);
				$data['barcode_pengajuan_validasi']  = set_value('barcode_pengajuan_validasi',$apv["barcode_pengajuan_validasi"]);
				$data['validasi']  = set_value('validasi',$apv["validasi"]);
				$data['tgl_asesi']  = set_value('tgl_asesi',$apv["tgl_asesi"]);
				$data['tgl_asesor']  = set_value('tgl_asesor',$apv["tgl_asesor"]);
				$data['ket_pengajuan_validasi']  = set_value('ket_pengajuan_validasi',$apv["ket_pengajuan_validasi"]);
				$data['id_jenis_form']  = set_value('id_jenis_form',$apv["id_jenis_form"]);
				$data['nama_jenis_form']  = set_value('nama_jenis_form',$apv["nama_jenis_form"]);
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$apv["barcode_pengajuan"]);
		//		$data['barcode_form']  = set_value('barcode_form',$apv["barcode_form"]);
				//====================================================
				$data['form'] = $this->m_kredensial->ambil_nkr_validasi_indikator_detil($apv['barcode_pengajuan_validasi']);
				//====================================================
				$this->load->view("validasi/isi",$data);
      }
      if($mode=='portofolio_modal'){
        $data['page'] =  $data['page']."_portofolio_modal";
				$apv = $this->m_kredensial->ambil_pengajuan_validasi_pengajuan_valiasi($data['id']);
				$penga = $this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$apv["barcode_pengajuan"]);
        $asesor = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$apv["id_asesor"]);
				$data['kesesuaian_bukti']  = explode(",", $apv["kesesuaian_bukti_validasi"]);
				$data['nama_asesor']  = set_value('nama_asesor',$asesor["nama_pegawai"]);
				$data['barcode_pengajuan_validasi']  = set_value('barcode_pengajuan_validasi',$apv["barcode_pengajuan_validasi"]);
				$data['validasi']  = set_value('validasi',$apv["validasi"]);
				$data['tgl_asesi']  = set_value('tgl_asesi',$apv["tgl_asesi"]);
				$data['tgl_asesor']  = set_value('tgl_asesor',$apv["tgl_asesor"]);
				$data['ket_pengajuan_validasi']  = set_value('ket_pengajuan_validasi',$apv["ket_pengajuan_validasi"]);
				$data['id_jenis_form']  = set_value('id_jenis_form',$apv["id_jenis_form"]);
				$data['nama_jenis_form']  = set_value('nama_jenis_form',$apv["nama_jenis_form"]);
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$apv["barcode_pengajuan"]);
        $data['id_pengajuan']  = set_value('id_pengajuan',$penga["id_pengajuan"]);
	//			$data['barcode_form']  = set_value('barcode_form',$apv["barcode_form"]);
				//====================================================
				$apk = $this->m_kredensial->ambil_pengajuan_kompetensi($apv["barcode_pengajuan"]); 
				$data['kompetensi']=$this->m_ol_rancak->ambil_lobook_kompetensi_group_pengajuan($apk["id_pengajuan"]);
                $data['form2_detil'] = $this->m_kredensial->ambil_nkr_validasi_indikator_detil($apv['barcode_pengajuan_validasi']);
				//====================================================
				$this->load->view("validasi/isi",$data);
      }
      if($mode=='konsultasi_modal'){
        $data['page'] =  $data['page']."_konsultasi_modal";
				$apv = $this->m_kredensial->ambil_pengajuan_validasi_pengajuan_valiasi($data['id']);
				$asesor = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$apv["id_asesor"]);
				$data['kesesuaian_bukti']  = explode(",", $apv["kesesuaian_bukti_validasi"]);
				$data['nama_asesor']  = set_value('nama_asesor',$asesor["nama_pegawai"]);
				$data['barcode_pengajuan_validasi']  = set_value('barcode_pengajuan_validasi',$apv["barcode_pengajuan_validasi"]);
				$data['validasi']  = set_value('validasi',$apv["validasi"]);
				$data['tgl_asesi']  = set_value('tgl_asesi',$apv["tgl_asesi"]);
				$data['tgl_asesor']  = set_value('tgl_asesor',$apv["tgl_asesor"]);
				$data['ket_pengajuan_validasi']  = set_value('ket_pengajuan_validasi',$apv["ket_pengajuan_validasi"]);
				$data['id_jenis_form']  = set_value('id_jenis_form',$apv["id_jenis_form"]);
				$data['nama_jenis_form']  = set_value('nama_jenis_form',$apv["nama_jenis_form"]);
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$apv["barcode_pengajuan"]);
	//			$data['barcode_form']  = set_value('barcode_form',$apv["barcode_form"]);
				//====================================================
				$data['form'] = $this->m_kredensial->ambil_validasi_grup_pra_asesmen($apv['barcode_pengajuan_validasi'],'npa.id_pra_asesmen','no_urut_detil','ASC');
				//====================================================
				$this->load->view("validasi/isi",$data);
      }
      if($mode=='cek_modal'){
        $data['page'] =  $data['page']."_cek_modal";
				$apv = $this->m_kredensial->ambil_pengajuan_validasi_pengajuan_valiasi($data['id']);
				$asesor = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$apv["id_asesor"]);
				$data['kesesuaian_bukti']  = explode(",", $apv["kesesuaian_bukti_validasi"]);
				$data['nama_asesor']  = set_value('nama_asesor',$asesor["nama_pegawai"]);
				$data['barcode_pengajuan_validasi']  = set_value('barcode_pengajuan_validasi',$apv["barcode_pengajuan_validasi"]);
				$data['validasi']  = set_value('validasi',$apv["validasi"]);
				$data['tgl_asesi']  = set_value('tgl_asesi',$apv["tgl_asesi"]);
				$data['tgl_asesor']  = set_value('tgl_asesor',$apv["tgl_asesor"]);
				$data['ket_pengajuan_validasi']  = set_value('ket_pengajuan_validasi',$apv["ket_pengajuan_validasi"]);
				$data['id_jenis_form']  = set_value('id_jenis_form',$apv["id_jenis_form"]);
				$data['nama_jenis_form']  = set_value('nama_jenis_form',$apv["nama_jenis_form"]);
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$apv["barcode_pengajuan"]);
		//		$data['barcode_form']  = set_value('barcode_form',$apv["barcode_form"]);
				//====================================================
				$data['form'] = $this->m_kredensial->ambil_validasi_grup_pra_asesmen($apv['barcode_pengajuan_validasi'],'npa.id_pra_asesmen','no_urut_detil','ASC');
				//====================================================
				$this->load->view("validasi/isi",$data);
      }
      if($mode=='keputusan_modal'){
        $data['page'] =  $data['page']."_keputusan_modal";
				$apv = $this->m_kredensial->ambil_pengajuan_validasi_pengajuan_valiasi($data['id']);
				$asesor = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$apv["id_asesor"]);
				$data['kesesuaian_bukti']  = explode(",", $apv["kesesuaian_bukti_validasi"]);
				$data['nama_asesor']  = set_value('nama_asesor',$asesor["nama_pegawai"]);
				$data['barcode_pengajuan_validasi']  = set_value('barcode_pengajuan_validasi',$apv["barcode_pengajuan_validasi"]);
				$data['validasi']  = set_value('validasi',$apv["validasi"]);
				$data['tgl_asesi']  = set_value('tgl_asesi',$apv["tgl_asesi"]);
				$data['tgl_asesor']  = set_value('tgl_asesor',$apv["tgl_asesor"]);
				$data['ket_pengajuan_validasi']  = set_value('ket_pengajuan_validasi',$apv["ket_pengajuan_validasi"]);
				$data['id_jenis_form']  = set_value('id_jenis_form',$apv["id_jenis_form"]);
				$data['nama_jenis_form']  = set_value('nama_jenis_form',$apv["nama_jenis_form"]);
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$apv["barcode_pengajuan"]);
		//		$data['barcode_form']  = set_value('barcode_form',$apv["barcode_form"]);
				//====================================================
				$data['form'] = $this->m_kredensial->ambil_validasi_grup_form7($apv['barcode_pengajuan'],'nas.id_elemen','no_urut_detil','ASC');
				//====================================================
				$this->load->view("validasi/isi",$data);
      }
      if($mode=='banding_modal'){
        $data['page'] =  $data['page']."_banding_modal";
				$apv = $this->m_kredensial->ambil_pengajuan_validasi_pengajuan_valiasi($data['id']);
				$asesor = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$apv["id_asesor"]);
				$data['kesesuaian_bukti']  = explode(",", $apv["kesesuaian_bukti_validasi"]);
				$data['nama_asesor']  = set_value('nama_asesor',$asesor["nama_pegawai"]);
				$data['barcode_pengajuan_validasi']  = set_value('barcode_pengajuan_validasi',$apv["barcode_pengajuan_validasi"]);
				$data['validasi']  = set_value('validasi',$apv["validasi"]);
				$data['tgl_asesi']  = set_value('tgl_asesi',$apv["tgl_asesi"]);
				$data['tgl_asesor']  = set_value('tgl_asesor',$apv["tgl_asesor"]);
				$data['ket_pengajuan_validasi']  = set_value('ket_pengajuan_validasi',$apv["ket_pengajuan_validasi"]);
				$data['id_jenis_form']  = set_value('id_jenis_form',$apv["id_jenis_form"]);
				$data['nama_jenis_form']  = set_value('nama_jenis_form',$apv["nama_jenis_form"]);
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$apv["barcode_pengajuan"]);
				$data['banding_asesi']  = set_value('banding_asesi',$apv["banding_asesi"]);
				$bpve = $this->m_umum->ambil_data('kol_jenis_form','id_jenis_form',$apv["banding_form"]);
				$data['nama_banding_form']  = set_value('nama_banding_form',$bpve["nama_jenis_form"]);
				//====================================================
				$apk = $this->m_kredensial->ambil_pengajuan_kompetensi($apv['barcode_pengajuan']);
				$data['nama_status_diusulkan']  = set_value('nama_status_diusulkan',$apk["nama_status_diusulkan"]);
				$data['nama_jabatan_fungsional']  = set_value('nama_jabatan_fungsional',$apk["nama_jabatan_fungsional"]);
				$data['tgl_pengajuan']  = $this->m_rancak->fullBulan(date('d-m-Y', strtotime($apk['tgl_pengajuan'])));
				$data['id_jabatan']  = set_value('id_jabatan',$apk["id_jabatan"]);
				$data['id_instansi']  = set_value('id_instansi',$apk["id_instansi"]);
				$data['id_pengajuan']  = set_value('id_pengajuan',$apk["id_pengajuan"]);
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$apk["barcode_pengajuan"]);
				$data['status_pengajuan']  = set_value('status_pengajuan',$apk["status_pengajuan"]);
				$data['nama_pegawai']  = set_value('nama_pegawai',$apk["nama_pegawai"]);
				$data['nama_working']  = set_value('nama_working',$apk["nama_working"]);
				//====================================================
				$data['form'] = $this->m_kredensial->ambil_validasi_grup_form7($apv['barcode_pengajuan'],'nas.id_elemen','no_urut_detil','ASC');
				//====================================================
				$this->load->view("validasi/isi",$data);
      }
      if($mode=='komponen_modal'){
        $data['page'] =  $data['page']."_komponen_modal";
				$apv = $this->m_kredensial->ambil_pengajuan_validasi_pengajuan_valiasi($data['id']);
				$asesor = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$apv["id_asesor"]);
				$data['kesesuaian_bukti']  = explode(",", $apv["kesesuaian_bukti_validasi"]);
				$data['nama_asesor']  = set_value('nama_asesor',$asesor["nama_pegawai"]);
				$data['barcode_pengajuan_validasi']  = set_value('barcode_pengajuan_validasi',$apv["barcode_pengajuan_validasi"]);
				$data['validasi']  = set_value('validasi',$apv["validasi"]);
				$data['tgl_asesi']  = set_value('tgl_asesi',$apv["tgl_asesi"]);
				$data['tgl_asesor']  = set_value('tgl_asesor',$apv["tgl_asesor"]);
				$data['ket_pengajuan_validasi']  = set_value('ket_pengajuan_validasi',$apv["ket_pengajuan_validasi"]);
				$data['id_jenis_form']  = set_value('id_jenis_form',$apv["id_jenis_form"]);
				$data['nama_jenis_form']  = set_value('nama_jenis_form',$apv["nama_jenis_form"]);
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$apv["barcode_pengajuan"]);
		//		$data['barcode_form']  = set_value('barcode_form',$apv["barcode_form"]);
				//====================================================
				$data['form'] = $this->m_kredensial->ambil_validasi_kaji_pra_detil($apv['barcode_pengajuan_validasi'],'nvd.id_kaji_ulang','ASC');
				//====================================================
				$this->load->view("validasi/isi",$data);
      }
      if($mode=='kesenjangan_modal'){
        $data['page'] =  $data['page']."_kesenjangan_modal";
				$apv = $this->m_kredensial->ambil_pengajuan_validasi_pengajuan_valiasi($data['id']);
				$apk = $this->m_kredensial->ambil_pengajuan_kompetensi($apv['barcode_pengajuan']);
				$asesor = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$apv["id_asesor"]);
				$data['kesesuaian_bukti']  = explode(",", $apv["kesesuaian_bukti_validasi"]);
				$data['nama_asesor']  = set_value('nama_asesor',$asesor["nama_pegawai"]);
				$data['barcode_pengajuan_validasi']  = set_value('barcode_pengajuan_validasi',$apv["barcode_pengajuan_validasi"]);
				$data['validasi']  = set_value('validasi',$apv["validasi"]);
				$data['tgl_asesi']  = set_value('tgl_asesi',$apv["tgl_asesi"]);
				$data['tgl_asesor']  = set_value('tgl_asesor',$apv["tgl_asesor"]);
				$data['ket_pengajuan_validasi']  = set_value('ket_pengajuan_validasi',$apv["ket_pengajuan_validasi"]);
				$data['id_jenis_form']  = set_value('id_jenis_form',$apv["id_jenis_form"]);
				$data['nama_jenis_form']  = set_value('nama_jenis_form',$apv["nama_jenis_form"]);
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$apv["barcode_pengajuan"]);
		//		$data['barcode_form']  = set_value('barcode_form',$apv["barcode_form"]);
				//====================================================
				$kondisi=array('nf2.id_jenis_form'=>$apv["id_jenis_form"],'nf2.id_kompetensi'=>$apv['id_kompetensi'],'nf2.id_instansi'=>$apv['id_instansi']);
				$data['form'] = $this->m_kredensial->ambil_validasi_grup_kaji_pra_detil($apv['barcode_pengajuan_validasi'],'nvd.id_kat_kaji','nvd.id_kat_kaji','ASC');
				//====================================================
				$this->load->view("validasi/isi",$data);
      }
// ========================================================================================================================
		if($mode=='pdf_etika'){
		  $report = $this->load->view('cetak/etika_profesi', $data, TRUE);
	      $filename = "etika-profesi-".date('dmYHis').".pdf";
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-L']);
		  $mpdf->AddPage('P', '', '', '', 2, 5, 5, 5, 10, 3, 3);
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
		  //$mpdf->SetFooter('Page : {PAGENO}');
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
	    if($mode=='permohonan_print'){
	      $report = $this->load->view('cetak/nkr_form1', $data, TRUE);
	      $apk = $this->m_kredensial->ambil_pengajuan_kompetensi($data['id']);
	      $tgl = date('d-m-Y', strtotime($apk['tgl_pengajuan']));
	      $filename = "form-1-".$tgl."-".$apk['nama_status_diusulkan']."-".$apk['nik']."-".$apk['nama_pegawai']."-".date('dmYHis').".pdf";
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
	    } 
	    if($mode=='pdf_form2'){
	      $report = $this->load->view('cetak/nkr_form2', $data, TRUE);
	      $apk = $this->m_kredensial->ambil_pengajuan_kompetensi($data['id']);
	      $tgl = date('d-m-Y', strtotime($apk['tgl_pengajuan']));
	      $filename = "form-2-".$tgl."-".$apk['nama_status_diusulkan']."-".$apk['nik']."-".$apk['nama_pegawai']."-".date('dmYHis').".pdf";
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
	    } 
		}
	}
	function spk($mode='view'){
		$data['page']="spk"; 
		$data['header'] = "UPLOAD DATA DAN SPK";
		$data['title'] = "UPLOAD DATA DAN SPK";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
		$propinsie = $this->m_umum->ambil_data('ol_pengcab','id_pengcab',$pegawai['id_pengcab']);
		$data['prov_id'] = $propinsie["id_prov"];
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
		$data['id']    = $this->uri->segment(4, 0);
		if(empty($data['id'])){
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
				redirect(base_url('ol_kompetensi/spk/view/'.$key));
			}
		}
		else if($mode=='data'){
			echo json_encode($this->m_ol_validasi->pengajuan_kompetensi_spk_all($this->session->list_instansi,$data['id']));
		}
		else{
      if($mode=='upload_kredensial'){
        $data['page'] =  $data['page']."_upload_kredensial";
        $data['title'] = "UPLOAD DATA KREDENSIAL";
				$data['halaman'] = 'upload_kredensial';
				$pg = $this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$data['id']);
				$data['barcode_pengajuan']  = $pg['barcode_pengajuan'];
				$data['status_pengajuan']  = $pg['status_pengajuan'];
				$this->form_validation->set_rules('barcode_pengajuan','barcode_pengajuan','required');
        if ($this->form_validation->run() === FALSE){
					$this->tampil($data);
        }else{
        	$status_pengajuan= $this->input->post('status_pengajuan');
	        if($status_pengajuan == 2){
						$data = array();
						$filesCount = count($_FILES['upload_Files']['name']);
						for($i = 0; $i < $filesCount; $i++){
							$_FILES['upload_File']['name'] = $_FILES['upload_Files']['name'][$i];
							$_FILES['upload_File']['type'] = $_FILES['upload_Files']['type'][$i];
							$_FILES['upload_File']['tmp_name'] = $_FILES['upload_Files']['tmp_name'][$i];
							$_FILES['upload_File']['error'] = $_FILES['upload_Files']['error'][$i];
							$_FILES['upload_File']['size'] = $_FILES['upload_Files']['size'][$i];
							$uploadPath = 'assets/berkas/ol/';
							$config['upload_path'] = $uploadPath;
							$config['allowed_types'] = 'pdf';
							$config['encrypt_name'] = TRUE;
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
		  				if($this->upload->do_upload('upload_File')){
								$id_pengajuan = $this->input->post('id_pengajuan');
								$user_pic=$this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$data['id']);
								$cek_file=FCPATH.'assets/berkas/ol/'.$user_pic['kredensial'];
								if(file_exists($cek_file)){
									unlink(FCPATH."assets/berkas/ol/".$user_pic['kredensial']);
								}
		  					$fileData = $this->upload->data();
		  					$this->session->set_flashdata('sukses', 'Data berhasil Di Upload');
		  					$this->m_ol_validasi->edit_kredensial($fileData['file_name']);
		  					redirect(base_url('ol_kompetensi/spk'));
		  				}else{
				        $this->session->set_flashdata('danger', 'Data Gagal Di Upload');
								redirect(base_url('ol_kompetensi/spk'));
		  				}
						}
					}else{
			      $this->session->set_flashdata('danger', 'SPK Sudah Diterbitkan');
						redirect(base_url('ol_kompetensi/spk'));				
					}
				}
      }
      if($mode=='upload_mutu'){
        $data['page'] =  $data['page']."_upload_mutu";
        $data['title'] = "UPLOAD DATA MUTU";
        $data['halaman'] = 'upload_mutu';
				$pg = $this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$data['id']);
				$data['barcode_pengajuan']  = $pg['barcode_pengajuan'];
				$data['status_pengajuan']  = $pg['status_pengajuan'];
				$this->form_validation->set_rules('barcode_pengajuan','barcode_pengajuan','required');
        if ($this->form_validation->run() === FALSE){
					$this->tampil($data);
        }else{
        	$status_pengajuan= $this->input->post('status_pengajuan');
	        if($status_pengajuan == 2){
						$data = array();
						$filesCount = count($_FILES['upload_Files']['name']);
						for($i = 0; $i < $filesCount; $i++){
							$_FILES['upload_File']['name'] = $_FILES['upload_Files']['name'][$i];
							$_FILES['upload_File']['type'] = $_FILES['upload_Files']['type'][$i];
							$_FILES['upload_File']['tmp_name'] = $_FILES['upload_Files']['tmp_name'][$i];
							$_FILES['upload_File']['error'] = $_FILES['upload_Files']['error'][$i];
							$_FILES['upload_File']['size'] = $_FILES['upload_Files']['size'][$i];
							$uploadPath = 'assets/berkas/ol/';
							$config['upload_path'] = $uploadPath;
							$config['allowed_types'] = 'pdf';
							$config['encrypt_name'] = TRUE;
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
		  				if($this->upload->do_upload('upload_File')){
								$id_pengajuan = $this->input->post('id_pengajuan');
								$user_pic=$this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$data['id']);
								$cek_file=FCPATH.'assets/berkas/ol/'.$user_pic['mutu'];
								if(file_exists($cek_file)){
									unlink(FCPATH."assets/berkas/ol/".$user_pic['mutu']);
								}
		  					$fileData = $this->upload->data();
		  					$this->session->set_flashdata('sukses', 'Data berhasil Di Upload');
		  					$this->m_ol_validasi->edit_mutu($fileData['file_name']);
		  					redirect(base_url('ol_kompetensi/spk'));
		  				}else{
				        $this->session->set_flashdata('danger', 'Data Gagal Di Upload');
								redirect(base_url('ol_kompetensi/spk'));
		  				}
						}
					}else{
			      $this->session->set_flashdata('danger', 'SPK Sudah Diterbitkan');
						redirect(base_url('ol_kompetensi/spk'));							
					}
				}
      }
      if($mode=='upload_etika'){
        $data['page'] =  $data['page']."_upload_etika";
        $data['title'] = "UPLOAD DATA ETIKA";
				$data['halaman'] = 'upload_etika';
				$pg = $this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$data['id']);
				$data['barcode_pengajuan']  = $pg['barcode_pengajuan'];
				$data['status_pengajuan']  = $pg['status_pengajuan'];
				$this->form_validation->set_rules('barcode_pengajuan','barcode_pengajuan','required');
        if ($this->form_validation->run() === FALSE){
					$this->tampil($data);
        }else{
        	$status_pengajuan= $this->input->post('status_pengajuan');
	        if($status_pengajuan == 2){
						$data = array();
						$filesCount = count($_FILES['upload_Files']['name']);
						for($i = 0; $i < $filesCount; $i++){
							$_FILES['upload_File']['name'] = $_FILES['upload_Files']['name'][$i];
							$_FILES['upload_File']['type'] = $_FILES['upload_Files']['type'][$i];
							$_FILES['upload_File']['tmp_name'] = $_FILES['upload_Files']['tmp_name'][$i];
							$_FILES['upload_File']['error'] = $_FILES['upload_Files']['error'][$i];
							$_FILES['upload_File']['size'] = $_FILES['upload_Files']['size'][$i];
							$uploadPath = 'assets/berkas/ol/';
							$config['upload_path'] = $uploadPath;
							$config['allowed_types'] = 'pdf';
							$config['encrypt_name'] = TRUE;
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
		  				if($this->upload->do_upload('upload_File')){
								$id_pengajuan = $this->input->post('id_pengajuan');
								$user_pic=$this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$data['id']);
								$cek_file=FCPATH.'assets/berkas/ol/'.$user_pic['etika'];
								if(file_exists($cek_file)){
									unlink(FCPATH."assets/berkas/ol/".$user_pic['etika']);
								}
		  					$fileData = $this->upload->data();
		  					$this->session->set_flashdata('sukses', 'Data berhasil Di Upload');
		  					$this->m_ol_validasi->edit_etika($fileData['file_name']);
		  					redirect(base_url('ol_kompetensi/spk'));
		  				}else{
				        $this->session->set_flashdata('danger', 'Data Gagal Di Upload');
								redirect(base_url('ol_kompetensi/spk'));
		  				}
						}
					}else{
			      $this->session->set_flashdata('danger', 'SPK Sudah Diterbitkan');
						redirect(base_url('ol_kompetensi/spk'));							
					}
				}
      }
      if($mode=='upload_spk'){
        $data['page'] =  $data['page']."_upload_spk";
        $data['title'] = "UPLOAD DATA SPK";
				$data['halaman'] = 'upload_spk';
				$pg = $this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$data['id']);
				$data['barcode_pengajuan']  = $pg['barcode_pengajuan'];
				$data['status_pengajuan']  = $pg['status_pengajuan'];
				$this->form_validation->set_rules('barcode_pengajuan','barcode_pengajuan','required');
        if ($this->form_validation->run() === FALSE){
					$this->tampil($data);
        }else{
        	$status_pengajuan= $this->input->post('status_pengajuan');
	        if($status_pengajuan == 2){
						$data = array();
						$filesCount = count($_FILES['upload_Files']['name']);
						for($i = 0; $i < $filesCount; $i++){
							$_FILES['upload_File']['name'] = $_FILES['upload_Files']['name'][$i];
							$_FILES['upload_File']['type'] = $_FILES['upload_Files']['type'][$i];
							$_FILES['upload_File']['tmp_name'] = $_FILES['upload_Files']['tmp_name'][$i];
							$_FILES['upload_File']['error'] = $_FILES['upload_Files']['error'][$i];
							$_FILES['upload_File']['size'] = $_FILES['upload_Files']['size'][$i];
							$uploadPath = 'assets/berkas/ol/';
							$config['upload_path'] = $uploadPath;
							$config['allowed_types'] = 'pdf';
							$config['encrypt_name'] = TRUE;
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
		  				if($this->upload->do_upload('upload_File')){
								$id_pengajuan = $this->input->post('id_pengajuan');
								$user_pic=$this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$data['id']);
								$cek_file=FCPATH.'assets/berkas/ol/'.$user_pic['spk'];
								if(file_exists($cek_file)){
									unlink(FCPATH."assets/berkas/ol/".$user_pic['spk']);
								}
		  					$fileData = $this->upload->data();
		  					$this->session->set_flashdata('sukses', 'Data berhasil Di Upload');
		  					$this->m_ol_validasi->edit_spk($fileData['file_name']);
		  					redirect(base_url('ol_kompetensi/spk'));
		  				}else{
				        $this->session->set_flashdata('danger', 'Data Gagal Di Upload');
								redirect(base_url('ol_kompetensi/spk'));
		  				}
						}
					}else{
			      $this->session->set_flashdata('danger', 'Data Upload Belum Lengkap');
						redirect(base_url('ol_kompetensi/spk'));						
					}
				}
      }
      if($mode=='kelengkapan'){
        $data['page'] =  $data['page']."_kelengkapan";
				$data['cmd_ambil_direktur'] = $this->m_ol_rancak->cmd_ambil_direktur($this->session->list_instansi);
				$kondisi_pengajuan=array('barcode_pengajuan'=>$data['id']);
				$pengajuan = $this->m_umum->ambil_data_kondisi('ol_pengajuan',$kondisi_pengajuan);
				$kondisi_lampiran=array('id_pengajuan'=>$pengajuan['id_pengajuan']);
				$jml_lampiran = $this->m_umum->jumlah_record_filter('ol_pengajuan_report',$kondisi_lampiran);
				$data['id_pengajuan'] = $pengajuan['id_pengajuan'];
				$data['id_status_diusulkan'] = $pengajuan['id_status_diusulkan'];
				if($jml_lampiran == 0){
					$data['lampiran']  = set_value('lampiran',$this->input->post("lampiran"));
					$data['nomor']  = set_value('nomor',$this->input->post("nomor"));
					$data['tgl_nomor']  = set_value('tgl_nomor',date('d-m-Y'));
					$data['tentang']  = set_value('tentang',$this->input->post("tentang"));
					$data['kategori_kewenangan']  = set_value('kategori_kewenangan',$this->input->post("kategori_kewenangan"));
					$data['kewenangan_klinis']  = set_value('kewenangan_klinis',$this->input->post("kewenangan_klinis"));
					$data['ditetapkan']  = set_value('ditetapkan',$this->input->post("ditetapkan"));
					$data['id_direktur']  = set_value('id_direktur',$this->input->post("id_direktur"));
					$data['pangkat']  = set_value('pangkat',$this->input->post("pangkat"));
					$data['tgl_ditetapkan']  = set_value('tgl_ditetapkan',date('d-m-Y'));
				}else{
					$kr_pengajuan_report = $this->m_umum->ambil_data('ol_pengajuan_report','id_pengajuan',$pengajuan['id_pengajuan']);
					$data['lampiran'] = $kr_pengajuan_report['lampiran'];
					$data['nomor'] = $kr_pengajuan_report['nomor'];
					$data['tentang'] = $kr_pengajuan_report['tentang'];
					$data['kategori_kewenangan'] = $kr_pengajuan_report['kategori_kewenangan'];
					$data['kewenangan_klinis'] = $kr_pengajuan_report['kewenangan_klinis'];
					$data['ditetapkan'] = $kr_pengajuan_report['ditetapkan'];
					$data['id_direktur'] = $kr_pengajuan_report['id_direktur'];
					$data['pangkat'] = $kr_pengajuan_report['pangkat'];
					$data['tgl_nomor'] = date('d-m-Y', strtotime($kr_pengajuan_report['tgl_nomor']));
					$data['tgl_ditetapkan'] = date('d-m-Y', strtotime($kr_pengajuan_report['tgl_ditetapkan']));
				}
				$this->form_validation->set_rules('id_pengajuan','id_pengajuan','required');
        if ($this->form_validation->run() === FALSE){
					$this->tampil($data);
        }else{
					$id_pengajuan= $this->input->post('id_pengajuan');
					$id_status_diusulkan= $this->input->post('id_status_diusulkan');
					$kondisi_lampir=array('id_pengajuan'=>$id_pengajuan);
					$jml_lampir = $this->m_umum->jumlah_record_filter('ol_pengajuan_report',$kondisi_lampir);
					$lihat_kw = $this->m_umum->ambil_data_kondisi('ol_pengajuan',$kondisi_lampir);
					if(empty($lihat_kw['kredensial']) || empty($lihat_kw['mutu']) || empty($lihat_kw['etika']) || empty($lihat_kw['spk'])){
			      $this->session->set_flashdata('danger', 'Data Upload Belum Lengkap');
						redirect(base_url('ol_kompetensi/spk'));	
					}else{
						if($jml_lampiran == 0){
							$this->m_ol_validasi->simpan_kr_pengajuan_report();
						}else{
							$this->m_ol_validasi->edit_kr_pengajuan_report();
						}
						if(empty($lihat_kw['kw_terima'])){
							$ambil_kw_terima = $this->m_ol_rancak->ambil_kw_terima($lihat_kw['id_pegawai'],$id_pengajuan);
							$kw_terima = array();
							foreach($ambil_kw_terima as $valambil_kw_terima){
									$kw_terima[] = $valambil_kw_terima['id_kewenangan'];
							}
							$eimplokw_terima = implode(",", $kw_terima);
							$this->m_ol_validasi->simpan_kw_terima($id_pengajuan,$eimplokw_terima);
							$this->m_ol_validasi->simpan_lulus($lihat_kw['id_pegawai'],$eimplokw_terima);
							if($id_status_diusulkan == 4){
								$this->m_ol_validasi->simpan_rubah_tolak($lihat_kw['id_pegawai'],$eimplokw_terima);
							}
							$this->m_ol_validasi->simpan_kewenangan_lulus($lihat_kw['id_pegawai'],$eimplokw_terima);
							$this->m_ol_validasi->rubah_status($id_pengajuan);
						}
						if(empty($lihat_kw['kw_tolak'])){
							$ambil_kw_tolak = $this->m_ol_rancak->ambil_kw_tolak($lihat_kw['id_pegawai'],$id_pengajuan);
							$kw_tolak = array();
							foreach($ambil_kw_tolak as $valambil_kw_tolak){
									$kw_tolak[] = $valambil_kw_tolak['id_kewenangan'];
							}
							$eimplokw_tolak = implode(",", $kw_tolak);
							$this->m_ol_validasi->simpan_kw_tolak($id_pengajuan,$eimplokw_tolak);
						}
						if(empty($lihat_kw['kw_all'])){
							$ambil_kw_all = $this->m_ol_rancak->ambil_kw_all($lihat_kw['id_pegawai']);
							$kw_all = array();
							foreach($ambil_kw_all as $valambil_kw_all){
									$kw_all[] = $valambil_kw_all['id_kewenangan'];
							}
							$eimplokw_all = implode(",", $kw_all);
							$this->m_ol_validasi->simpan_kw_all($id_pengajuan,$eimplokw_all);
						}
						$this->session->set_flashdata('sukses', 'Data Sudah Dilengkapi Silahkan Print Penugasan Klinis');
						redirect(base_url('ol_kompetensi/spk'));
					}
        }
      }
		if($mode=='pdf'){
		  $report = $this->load->view('cetak/ol_penugasan_klinis', $data, TRUE);
		  $apk	=$this->m_ol_rancak->ambil_pengajuan_kompetensi_spk($data['id']);
		  $filename = "Penugasan_klinis-".$apk['nama_pegawai']."-".date('d-m-Y').".pdf";
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
	//    $mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'P','margin_left' => '5','margin_right' => '5','margin_top' => '5','margin_bottom' => '5']);
	//	  $mpdf = new \Mpdf\Mpdf(['format' => 'Legal']);
		// Define a default page size/format by array - page will be 190mm wide x 236mm height
		//  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [190, 236]]);
		// Define a default Landscape page size/format by name
/* 		$mpdf->WriteHTML('Your Foreword and Introduction');
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
	$this->load->view("validasi/header",$data);
	$this->load->view("validasi/isi");
	$this->load->view("footer");
	$this->load->view("validasi/jsload");
	$this->load->view("validasi/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_topol",$data);
	$this->load->view("validasi/isi");
	$this->load->view("footer");
	$this->load->view("validasi/jsload");
	$this->load->view("validasi/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
