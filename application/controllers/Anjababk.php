<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Anjababk extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
          $this->load->model('m_ol_rancak');
          $this->load->model('m_anjababk');
          $this->load->model('m_auth');
          $this->m_auth->ol_enabled();
  }
	function index(){
/*		$data['page']="home";
		$data['header'] = "BERANDA";
		$data['title'] = "BERANDA";
		$data['link_awal'] = base_url('instansi_user');
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
		$data['id']   = $this->uri->segment(4, 0);*/
		$this->informasi_jabatan();
	}
  function pegawai($mode='view')
  {
	$data['page']  = "pegawai";
	$data['header'] = "DATA PEGAWAI";
	$data['title'] = "DATA PEGAWAI";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',10);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$stpeg = $this->m_umum->ambil_data('a_online','kode_online','ol_status_pegawai');
/*		$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
		$data['aran_jabatan'] = $jabatanekuh["nama_jabatan"];*/
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
		echo json_encode($this->m_anjababk->pegawai_unite());
	}
  else{
	 	 	$data['cmd_status'] = $this->m_rancak->cmd_status();
	 	 	$data['cmd_jabatan_fungsional'] = $this->m_ol_rancak->cmd_jabatan_fungsional_no_null();
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$ded = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$data['id']);
				$data['id_pegawai'] = set_value('id_pegawai',$ded["id_pegawai"]);
				$data['nama_pegawai'] = set_value('nama_pegawai',$ded["nama_pegawai"]);
				$data['id_jabatan_fungsional'] = set_value('id_jabatan_fungsional',$ded["id_jabatan_fungsional"]);
				$this->load->view("anjababk/isi",$data);
      }
      if($mode=='simpan_edit'){
			  if($this->m_anjababk->rubah_pegawai()){
					$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
					redirect(base_url('anjababk/pegawai'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Masalah Rubah Data. Hubungi Admin');
					redirect(base_url('anjababk/pegawai'));
			  }
      }
	}
  }
  function jabfung($id)
  {
    $dt=$this->m_anjababk->jabfung($id);
    echo json_encode($dt);
  }
  function informasi_jabatan($mode='view')
  {
	$data['page']  = "informasi_jabatan";
	$data['header'] = "ANALISA JABATAN DAN BEBAN KERJA";
	$data['title'] = "ANALISA JABATAN DAN BEBAN KERJA";
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
	$data['id_bk_detil'] = $this->uri->segment(5, 0);
	if(empty($data['id'])){
			if($this->session->has_userdata('periode_anjababk')){
				$data['id'] = $this->session->periode_anjababk;
			}else{
				$data['id'] = date('Y');
			}
	}
	$data['cmd_range_tahun']=$this->m_rancak->cmd_range_tahun(date('Y')-2,date('Y')+5);
	$data['year_periode']=$this->m_rancak->year_periode_abk($this->session->unit);
    if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$id = $this->input->post("id");
			$data_user_level = array(
				'periode_anjababk'     => $id
			);	
			$this->session->set_userdata($data_user_level);	
			redirect(base_url('anjababk/informasi_jabatan/view/'.$id));
		}
	}
    else if($mode=='data'){
		echo json_encode($this->m_anjababk->abk_all($data['id'],$this->session->unit));
	}
    else if($mode=='data_butir_kegiatan'){
		echo json_encode($this->m_anjababk->id_butir_kegiatan_all($data['id']));
	}
  else if($mode=='hapus'){
	  if($this->m_umum->hapus_data('p_bk_detil','id_bk_detil',$data['id_bk_detil'])){
  		$this->m_anjababk->totalin_jumlah_pegawai($data['id_bk_detil']);
  		$this->session->set_flashdata('sukses', 'Data Sudah Dihapus');
    	redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$data['id']));
	  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Hapus Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$data['id']));
	  }
  }
  else{
		$data['cmd_jabatan_fungsional'] = $this->m_rancak->cmd_jabatan_fungsional_id($this->session->id_jabatan);
		$data['cmd_struktur_jabatan'] = $this->m_rancak->cmd_struktur_jabatan();
		$data['option'] = $this->m_rancak->cmd_count();
		$data['cmd_jabatan_null'] = $this->m_rancak->cmd_jabatan_null();
		$injabdet = $this->m_anjababk->ambil_injab_detil($data['id']);
      if($mode=='periode'){
        $data['page'] =  $data['page']."_periode";
				$data['periode']  = set_value('periode',$this->input->post("periode"));
				$data['id_jabatan_fungsional']  = set_value('id_jabatan_fungsional',$this->input->post("id_jabatan_fungsional"));
				$data['id_struktur_jabatan']  = set_value('id_struktur_jabatan',$this->input->post("id_struktur_jabatan"));
				$data['id_jabatan']  = set_value('id_jabatan',$this->input->post("id_jabatan"));
				$this->load->view("anjababk/isi",$data);
      }
      if($mode=='simpan_periode'){
				$periode = $this->input->post('periode');
				$tgl_periode = $periode."-01-01";
			  $id_jabatan_fungsional = $this->input->post("id_jabatan_fungsional");
			  $id_struktur_jabatan = $this->input->post("id_struktur_jabatan");
			  if(!empty($id_struktur_jabatan) && !empty($id_jabatan_fungsional)){
					$jml = $this->m_anjababk->jumlah_record_filter_injab($this->session->unit,$tgl_periode,$id_jabatan_fungsional);
					if($jml == 0){
					  if($last_ide = $this->m_anjababk->simpan_injab($this->session->unit,$pegawai['id_pegawai'])){
						$last_injabdet = $this->m_anjababk->simpan_injab_detil($last_ide);
						redirect(base_url('anjababk/informasi_jabatan/isi/'.$last_injabdet));
					  }else{
						$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
						redirect(base_url('anjababk/informasi_jabatan/view/'.$periode));
					  }
					}else{
						$this->session->set_flashdata('danger', 'Data Sudah Ada');
						redirect(base_url('anjababk/informasi_jabatan/view/'.$periode));
					}
				}else{
					$this->session->set_flashdata('danger', 'Data Atasan Langsung / Jabatan Masih Kosong');
					redirect(base_url('anjababk/informasi_jabatan'));					
				}
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$data['periode'] = set_value('periode',date('Y',strtotime($injabdet["periode"])));
				$data['id_jabatan_fungsional']  = set_value('id_jabatan_fungsional',$injabdet["id_jabatan_fungsional"]);
				$data['id_struktur_jabatan']  = set_value('id_struktur_jabatan',$injabdet["id_struktur_jabatan"]);
				$data['id_abk']  = set_value('id_abk',$injabdet["id_abk"]);
				$data['header']  = set_value('header',$injabdet["header"]);
				$data['sub_header']  = set_value('sub_header',$injabdet["sub_header"]);
				$data['sub_sub_header']  = set_value('sub_sub_header',$injabdet["sub_sub_header"]);
				$data['header_pemenuhan']  = set_value('header_pemenuhan',$injabdet["header_pemenuhan"]);
				$data['sub_header_pemenuhan']  = set_value('sub_header_pemenuhan',$injabdet["sub_header_pemenuhan"]);
				$data['sub_sub_header_pemenuhan']  = set_value('sub_sub_header_pemenuhan',$injabdet["sub_sub_header_pemenuhan"]);
				$data['header_realisasi']  = set_value('header_realisasi',$injabdet["header_realisasi"]);
				$data['sub_header_realisasi']  = set_value('sub_header_realisasi',$injabdet["sub_header_realisasi"]);
				$data['sub_sub_header_realisasi']  = set_value('sub_sub_header_realisasi',$injabdet["sub_sub_header_realisasi"]);
		$this->load->view("anjababk/isi",$data);
      }
      if($mode=='simpan_edit'){
    		$periode = $this->input->post('periode');  	
/*		$id_abk = $this->input->post('id_abk');
		$id_abk_detil = $this->input->post('id_abk_detil');
		$periode_lama = $this->input->post('periode_lama');
		$tgl_periode = $periode."-01-01";
		$tgl_periode_lama = $periode_lama."-01-01";
		$id_jabatan_fungsional = $this->input->post("id_jabatan_fungsional");
		$jml = $this->m_anjababk->jumlah_record_filter_injab_edit($this->session->unit,$tgl_periode,$tgl_periode_lama,$id_jabatan_fungsional);
//		if($jml == 0){*/
		  if($this->m_anjababk->edit_inform()){
				$this->m_anjababk->edit_inform_detil();
				redirect(base_url('anjababk/informasi_jabatan/view/'.$periode));
		  }else{
				$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
				redirect(base_url('anjababk/informasi_jabatan/view/'.$periode));
		  }
/*		}else{
			$this->session->set_flashdata('danger', 'Data Sudah Ada / Detil Sudah Dibuat');
			redirect(base_url('anjababk/informasi_jabatan/view/'.$periode));
		}*/
      }
      if($mode=='pemenuhan_tambah'){
        $data['page'] =  $data['page']."_pemenuhan_tambah";
		$data['periode']  = set_value('periode',$this->input->post("periode"));
		$data['id_jabatan_fungsional']  = set_value('id_jabatan_fungsional',$injabdet["id_jabatan_fungsional"]);
		$data['periode_lama']  = set_value('periode_lama',date('Y', strtotime($injabdet["periode"])));
		$data['id_unit']  = set_value('id_unit',$this->session->unit);
		$data['jml_pemenuhan']  = set_value('jml_pemenuhan','0');
		$data['jml_realisasi']  = set_value('jml_realisasi','0');
		$this->load->view("anjababk/isi",$data);
      }
      if($mode=='simpan_pemenuhan_tambah'){
		$periode_lama = $this->input->post('periode_lama');
		$periode = $this->input->post('periode');
		$tgl_periode = $periode."-01-01";
		  $id_unit = $this->input->post("id_unit");
		  $id_jabatan_fungsional = $this->input->post("id_jabatan_fungsional");
		$jml = $this->m_anjababk->jumlah_record_filter_pemenuhan($id_unit,$tgl_periode,$id_jabatan_fungsional);
		if($jml == 0){
		  if($this->m_anjababk->simpan_abk_pemenuhan()){
			redirect(base_url('anjababk/informasi_jabatan/view/'.$periode_lama));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/view/'.$periode_lama));
		  }
		}else{
			$this->session->set_flashdata('danger', 'Data Sudah Ada');
			redirect(base_url('anjababk/informasi_jabatan/view/'.$periode_lama));
		}
      }
      if($mode=='pemenuhan_edit'){
        $data['page'] =  $data['page']."_pemenuhan_edit";
		$id_jabatan_fungsional = $injabdet["id_jabatan_fungsional"];
		$id_unit = $this->session->unit;
		$data['ambil_abk_pemenuhan'] = $this->m_anjababk->ambil_abk_pemenuhan($id_unit,$id_jabatan_fungsional);
		$this->load->view("anjababk/isi",$data);
      }
      if($mode=='simpan_pemenuhan_edit'){
		  $periodex = $this->input->post('periodex');
		  $this->m_anjababk->edit_abk_pemenuhan();
		  redirect(base_url('anjababk/informasi_jabatan/view/'.$periodex));
      }
      if($mode=='copy'){
        $data['page'] =  $data['page']."_copy";
		$data['periode']  = set_value('periode',$this->input->post("periode"));
		$data['id_jabatan_fungsional']  = set_value('id_jabatan_fungsional',$this->input->post("id_jabatan_fungsional"));
		$data['id_struktur_jabatan']  = set_value('id_struktur_jabatan',$this->input->post("id_struktur_jabatan"));
		$this->load->view("anjababk/isi",$data);
      }
      if($mode=='simpan_copy'){
		$id_abk_detil = $this->input->post('id_abk_detil');
		$periode = $this->input->post('periode');
		$tgl_periode = $periode."-01-01";
		$id_jabatan_fungsional = $this->input->post("id_jabatan_fungsional");
		$jml = $this->m_anjababk->jumlah_record_filter_injab($this->session->unit,$tgl_periode,$id_jabatan_fungsional);
		if($jml == 0){
		  if($last_ide = $this->m_anjababk->simpan_injab($this->session->unit,$pegawai['id_pegawai'])){
			$last_injabdet = $this->m_anjababk->simpan_copy_injab_detil($last_ide,$id_abk_detil);
			redirect(base_url('anjababk/informasi_jabatan/view/'.$periode));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/view/'.$periode));
		  }
		}else{
			$this->session->set_flashdata('danger', 'Data Sudah Ada');
			redirect(base_url('anjababk/informasi_jabatan/view/'.$periode));
		}
      }
      if($mode=='urutan'){
        $data['page'] =  $data['page']."_urutan";
		$data['periode'] = set_value('periode',date('Y',strtotime($injabdet["periode"])));
		$data['nama_jabatan_fungsional']  = set_value('nama_jabatan_fungsional',$injabdet["nama_jabatan_fungsional"]);
		$data['no_urut']  = set_value('no_urut',$injabdet["no_urut"]);
		$this->load->view("anjababk/isi",$data);
      }
      if($mode=='simpan_urutan'){
		$periode = $this->input->post('periode');
		$tgl_periode = $periode."-01-01";
		  if($this->m_anjababk->edit_no_urut()){
			redirect(base_url('anjababk/informasi_jabatan/view/'.$periode));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/view/'.$periode));
		  }
      }
      if($mode=='isi_pegawai'){
        $data['page'] =  $data['page']."_isi_pegawai";
		$data['periode'] = set_value('periode',date('Y',strtotime($injabdet["periode"])));
		$data['id_abk_detil'] = set_value('id_abk_detil',$injabdet["id_abk_detil"]);
		$data['pns'] = set_value('pns',$injabdet["pns"]);
		$data['cpns'] = set_value('cpns',$injabdet["cpns"]);
		$data['pppk'] = set_value('pppk',$injabdet["pppk"]);
		$data['blud'] = set_value('blud',$injabdet["blud"]);
		$this->load->view("anjababk/isi",$data);
      }
      if($mode=='simpan_isi_pegawai'){
		  $periode = $this->input->post('periode');
		  if($this->m_anjababk->rubah_jumlah_pegawai()){
			redirect(base_url('anjababk/informasi_jabatan/view/'.$periode));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/view/'.$periode));
		  }
      }
		if($mode=='pdf_uraian'){
		  $report = $this->load->view('cetak/uraian_jabatan', $data, TRUE);
		  $filename = $data['header'].'-uraian-'.$data['id'].".pdf";
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
		  $mpdf->AddPage('P', '', '', '', 2, 5, 5, 5, 10, 3, 3);
		  $mpdf->SetDisplayMode('fullpage');
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->defaultheaderline = 0;
	      $mpdf->defaultfooterline = 0;
		  $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
			for ($i = 1; $i > 2; $i++) {
		  $mpdf->SetHTMLFooter('');
			}
		  //$mpdf->SetFooter('Page : {PAGENO}');
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
		if($mode=='pdf_abk'){
		  $report = $this->load->view('cetak/abk', $data, TRUE);
		  $filename = $data['header'].'-abk-'.$data['id'].".pdf";
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
		  $mpdf->AddPage('P', '', '', '', 2, 5, 5, 5, 10, 3, 3);
		  $mpdf->SetDisplayMode('fullpage');
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->defaultheaderline = 0;
	      $mpdf->defaultfooterline = 0;
		  $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
			for ($i = 1; $i > 2; $i++) {
		  $mpdf->SetHTMLFooter('');
			}
		  //$mpdf->SetFooter('Page : {PAGENO}');
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
		if($mode=='pdf_ketenagaan'){
			if(empty($data['id'])){ $data['id'] = date('Y'); }
		  $report = $this->load->view('cetak/pola_ketenagaan', $data, TRUE);
		  $filename = $data['header'].'-pola-ketenagaan-'.$data['id'].".pdf";
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-L']);
		  $mpdf->AddPage('L', '', '', '', 2, 5, 5, 5, 10, 3, 3);
		  $mpdf->SetDisplayMode('fullpage');
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->defaultheaderline = 0;
	      $mpdf->defaultfooterline = 0;
		  $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
			for ($i = 1; $i > 2; $i++) {
		  $mpdf->SetHTMLFooter('');
			}
		  //$mpdf->SetFooter('Page : {PAGENO}');
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
		if($mode=='pdf_evaluasi'){
			if(empty($data['id'])){ $data['id'] = date('Y'); }
		  $report = $this->load->view('cetak/evaluasi_perencanaan', $data, TRUE);
		  $filename = $data['header'].'-evaluasi-perencanaan-'.$data['id'].".pdf";
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-L']);
		  $mpdf->AddPage('L', '', '', '', 2, 5, 5, 5, 10, 3, 3);
		  $mpdf->SetDisplayMode('fullpage');
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->defaultheaderline = 0;
	      $mpdf->defaultfooterline = 0;
		  $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
			for ($i = 1; $i > 2; $i++) {
		  $mpdf->SetHTMLFooter('');
			}
		  //$mpdf->SetFooter('Page : {PAGENO}');
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
      if($mode=='isi'){
        $data['page'] =  $data['page']."_isi";
		$data['periode'] = set_value('periode',date('Y',strtotime($injabdet["periode"])));
		$ruang    = $this->m_umum->ambil_data('ol_unit','id_unit',$this->session->unit);
		$data['nama_unit'] = set_value('nama_unit',$ruang["nama_unit"]);
		$data['nama_jabatan_fungsional'] = set_value('nama_jabatan_fungsional',$injabdet["nama_jabatan_fungsional"]);
		$data['nama_struktur_jabatan'] = set_value('nama_struktur_jabatan',$injabdet["nama_struktur_jabatan"]);
		$data['iktisar_jabatan'] = set_value('iktisar_jabatan',$injabdet["iktisar_jabatan"]);
		$data['tugas_jabatan'] = set_value('tugas_jabatan',$injabdet["tugas_jabatan"]);
		$data['pengetahuan_kerja'] = set_value('pengetahuan_kerja',$injabdet["pengetahuan_kerja"]);
		$data['ketrampilan'] = set_value('ketrampilan',$injabdet["ketrampilan"]);
		$data['pelatihan'] = set_value('pelatihan',$injabdet["pelatihan"]);
		$data['pengalaman'] = set_value('pengalaman',$injabdet["pengalaman"]);
		$this->form_validation->set_rules('periode','periode','required');
        if ($this->form_validation->run() === FALSE){
			$this->tampil($data);
        }else{
		$periode  = $this->input->post("periode");
		  if($this->m_anjababk->edit_injab_detil()){
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
			redirect(base_url('anjababk/informasi_jabatan/view/'.$periode));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Rubah Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/view/'.$periode));
		  }
        }
      }
      if($mode=='pilihan'){
        $data['page'] =  $data['page']."_pilihan";
				$ruang    = $this->m_umum->ambil_data('ol_unit','id_unit',$this->session->unit);
				$data['nama_unit'] = set_value('nama_unit',$ruang["nama_unit"]);
				$data['periode'] = set_value('periode',date('Y',strtotime($injabdet["periode"])));
				$data['nama_jabatan_fungsional'] = set_value('nama_jabatan_fungsional',$injabdet["nama_jabatan_fungsional"]);
				$data['nama_struktur_jabatan'] = set_value('nama_struktur_jabatan',$injabdet["nama_struktur_jabatan"]);
				$data['wewenang'] = set_value('wewenang',$injabdet["wewenang"]); // wewenang
				$data['wewenang_terpilih']   = $this->m_anjababk->wewenang_terpilih($data['wewenang']);
				$data['tanggung_jawab'] = set_value('tanggung_jawab',$injabdet["tanggung_jawab"]); // tanggung_jawab
				$data['tanggung_jawab_terpilih']   = $this->m_anjababk->tanggung_jawab_terpilih($data['tanggung_jawab']);
				$data['hasil_kerja'] = set_value('hasil_kerja',$injabdet["hasil_kerja"]); // hasil_kerja
				$data['hasil_kerja_terpilih']   = $this->m_anjababk->hasil_kerja_terpilih($data['hasil_kerja']);
				$data['bahan_kerja'] = set_value('bahan_kerja',$injabdet["bahan_kerja"]); // bahan_kerja
				$data['bahan_kerja_terpilih']   = $this->m_anjababk->bahan_kerja_terpilih($data['bahan_kerja']);
				$data['perangkat_kerja'] = set_value('perangkat_kerja',$injabdet["perangkat_kerja"]); // perangkat_kerja
				$data['perangkat_kerja_terpilih']   = $this->m_anjababk->perangkat_kerja_terpilih($data['perangkat_kerja']);
				$data['hubungan_jabatan'] = set_value('hubungan_jabatan',$injabdet["hubungan_jabatan"]); // hubungan jabatan
				$data['hubungan_jabatan_terpilih']   = $this->m_anjababk->hubungan_jabatan_terpilih($data['hubungan_jabatan']);
				$data['kondisi_tempat'] = set_value('kondisi_tempat',$injabdet["kondisi_tempat_kerja"]); // kondisi tempat
				$data['kondisi_tempat_terpilih']   = $this->m_anjababk->kondisi_tempat_terpilih($data['kondisi_tempat']);
				$data['upaya_fisik'] = set_value('upaya_fisik',$injabdet["upaya_fisik"]); // upaya fisik
				$data['upaya_fisik_terpilih']   = $this->m_anjababk->upaya_fisik_terpilih($data['upaya_fisik']);
				$data['resiko_bahaya'] = set_value('resiko_bahaya',$injabdet["resiko_bahaya"]); // resiko bahaya
				$data['resiko_bahaya_terpilih']   = $this->m_anjababk->resiko_bahaya_terpilih($data['resiko_bahaya']);
				$data['pangkat'] = set_value('pangkat',$injabdet["pangkat"]); // pangkat
				$data['pangkat_terpilih']   = $this->m_anjababk->pangkat_terpilih($data['pangkat']);
				$data['bakat_kerja'] = set_value('bakat_kerja',$injabdet["bakat_kerja"]); // bakat kerja
				$data['bakat_kerja_terpilih']   = $this->m_anjababk->bakat_kerja_terpilih($data['bakat_kerja']);
				$data['pendidikan'] = set_value('pendidikan',$injabdet["pendidikan_formal"]); // bakat kerja
				$data['pendidikan_terpilih']   = $this->m_anjababk->pendidikan_terpilih($data['pendidikan']);
				$data['temperamen_kerja'] = set_value('temperamen_kerja',$injabdet["temperamen_kerja"]); // temperamen kerja
				$data['temperamen_kerja_terpilih']   = $this->m_anjababk->temperamen_kerja_terpilih($data['temperamen_kerja']);
				$data['minat_kerja'] = set_value('minat_kerja',$injabdet["minat_kerja"]); // minat kerja
				$data['minat_kerja_terpilih']   = $this->m_anjababk->minat_kerja_terpilih($data['minat_kerja']);
				$data['fungsi_kerja'] = set_value('fungsi_kerja',$injabdet["fungsi_kerja"]); // fungsi kerja
				$data['fungsi_kerja_terpilih']   = $this->m_anjababk->fungsi_kerja_terpilih($data['fungsi_kerja']);
				$data['total'] = set_value('total',$injabdet["total"]);
				$data['pns'] = set_value('pns',$injabdet["pns"]);
				$data['cpns'] = set_value('cpns',$injabdet["cpns"]);
				$data['blud'] = set_value('blud',$injabdet["blud"]);
				$data['average'] = set_value('average',$injabdet["average"]);
			//	$data['ambil_num_formasi'] = $this->m_anjababk->ambil_num_formasi($data['id']);
		$this->form_validation->set_rules('periode','periode','required');
        if ($this->form_validation->run() === FALSE){
			$this->tampil($data);
        }else{
		$periode  = $this->input->post("periode");
//		  if($this->m_anjababk->edit_injab_detil()){
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
			redirect(base_url('anjababk/informasi_jabatan/view/'.$periode));
/* 		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Rubah Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/view/'.$periode));
		  } */
        }
      }
      if($mode=='abk'){
        $data['page'] =  $data['page']."_abk";
		$kondisi_bk = array('id_bk_detil'=>$data['id_bk_detil']);
		$bk = $this->m_umum->ambil_data_kondisi('p_bk_detil',$kondisi_bk);
		$pabkd = $this->m_umum->ambil_data('p_abk_detil','id_abk_detil',$bk['id_abk_detil']);
		$periodenya = date('Y', strtotime($pabkd['periode']));
		$ded = $this->m_umum->ambil_data('nkr_kompetensi','id_kompetensi',$bk['id_kompetensi']);
		$num_volume = $this->m_anjababk->ambil_num_volume_abk($periodenya,$bk['id_kompetensi']);
		$data['jumlah'] = $num_volume["jumlah"];
		$data['waktu'] = $num_volume["waktu"];
		$data['id_kompetensi'] = set_value('id_kompetensi',$bk["id_kompetensi"]);
		$data['angka_kredit'] = set_value('angka_kredit',$bk["angka_kredit"]);
		$data['satuan_hasil'] = set_value('satuan_hasil',$bk["satuan_hasil"]);
		$data['status_butir_kegiatan'] = set_value('status_butir_kegiatan',$bk["status_bk_detil"]);
		$data['nama_kompetensi'] = set_value('nama_kompetensi',$ded["nama_kompetensi"]);
		$data['keterangan_jumlah'] = set_value('keterangan_jumlah',$bk["keterangan_jumlah"]);
		$data['konstanta'] = set_value('konstanta',$bk["konstanta"]);
		$data['wpk'] = set_value('wpk',$bk["wpk"]);
		$data['vol1th'] = set_value('vol1th',$bk["vol1th"]);
		$data['wpv'] = set_value('wpv',$bk["wpv"]);
		$data['formasi'] = set_value('formasi',$bk["formasi"]);
		$data['jam_efektif'] = set_value('jam_efektif',$bk["jam_efektif"]);
		$this->form_validation->set_rules('nama_kompetensi','nama_kompetensi','required');
        if ($this->form_validation->run() === FALSE){
			$this->tampil($data);
        }else{
		$id_abk_detil  = $this->input->post("id_abk_detil");
		  if($this->m_anjababk->rubah_bk_detil()){
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Rubah Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }
        }
      }
	  //WEWENANG
      if($mode=='wewenang'){
        $data['page'] =  $data['page']."_wewenang";
				$data['title'] = "WEWENANG";
				$injabdet = $this->m_anjababk->ambil_injab_detil($data['id']);
				$data['wewenang_all']   = $this->m_anjababk->wewenang_all($this->session->id_jabatan);
				$data['wewenang'] = set_value('wewenang',$injabdet["wewenang"]);
				$this->load->view("anjababk/isi",$data);
      }
      if($mode=='simpan_wewenang'){
		  $id_abk_detil = $this->input->post('id_abk_detil');
		if($this->input->post('chk')){
		  if($this->m_anjababk->rubah_wewenang()){
		//	$this->session->set_flashdata('sukses', 'Data Sudah Di Rubah');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }
		}else{
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		}
      }
      if($mode=='tambah_wewenang'){
        $data['page'] =  $data['page']."_tambah_wewenang";
		$data['title'] = "TAMBAH WEWENANG";
		$data['nama_wewenang']  = set_value('nama_wewenang',$this->input->post("nama_wewenang"));
		$this->load->view("anjababk/isi",$data);
      }
      if($mode=='simpan_tambah_wewenang'){
		  $id_abk_detil = $this->input->post('id_abk_detil');
		  if($this->m_anjababk->simpan_wewenang()){
			$this->session->set_flashdata('sukses', 'Data Sudah Di Tambah Silahkan Pilih Lagi');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }
      }
      if($mode=='kosong_wewenang'){
		  if($this->m_anjababk->null_wewenang($data['id'])){
			$this->session->set_flashdata('sukses', 'Data Sudah Di Kosongkan');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$data['id']));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Kosongkan Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$data['id']));
		  }
      }
	  //TANGGUNG JAWAB
      if($mode=='tanggung_jawab'){
        $data['page'] =  $data['page']."_tanggung_jawab";
		$data['title'] = "TANGGUNG JAWAB";
		$injabdet = $this->m_anjababk->ambil_injab_detil($data['id']);
		$data['tanggung_jawab_all']   = $this->m_anjababk->tanggung_jawab_all($this->session->id_jabatan);
		$data['tanggung_jawab'] = set_value('tanggung_jawab',$injabdet["tanggung_jawab"]);
		$this->load->view("anjababk/isi",$data);
      }
      if($mode=='simpan_tanggung_jawab'){
		  $id_abk_detil = $this->input->post('id_abk_detil');
		if($this->input->post('chk')){
		  if($this->m_anjababk->rubah_tanggung_jawab()){
		//	$this->session->set_flashdata('sukses', 'Data Sudah Di Rubah');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }
		}else{
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		}
      }
      if($mode=='tambah_tanggung_jawab'){
        $data['page'] =  $data['page']."_tambah_tanggung_jawab";
		$data['title'] = "TAMBAH TANGGUNG JAWAB";
		$data['nama_tanggung_jawab']  = set_value('nama_tanggung_jawab',$this->input->post("nama_tanggung_jawab"));
		$this->load->view("anjababk/isi",$data);
      }
      if($mode=='simpan_tambah_tanggung_jawab'){
		  $id_abk_detil = $this->input->post('id_abk_detil');
		  if($this->m_anjababk->simpan_tanggung_jawab()){
			$this->session->set_flashdata('sukses', 'Data Sudah Di Tambah Silahkan Pilih Lagi');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }
      }
      if($mode=='kosong_tanggung_jawab'){
		  if($this->m_anjababk->null_tanggung_jawab($data['id'])){
			$this->session->set_flashdata('sukses', 'Data Sudah Di Kosongkan');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$data['id']));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Kosongkan Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$data['id']));
		  }
      }
	  //HASIL KERJA
      if($mode=='hasil_kerja'){
        $data['page'] =  $data['page']."_hasil_kerja";
		$data['title'] = "HASIL KERJA";
		$injabdet = $this->m_anjababk->ambil_injab_detil($data['id']);
		$data['hasil_kerja_all']   = $this->m_anjababk->hasil_kerja_all($this->session->id_jabatan);
		$data['hasil_kerja'] = set_value('hasil_kerja',$injabdet["hasil_kerja"]);
		$this->load->view("anjababk/isi",$data);
      }
      if($mode=='simpan_hasil_kerja'){
		  $id_abk_detil = $this->input->post('id_abk_detil');
		if($this->input->post('chk')){
		  if($this->m_anjababk->rubah_hasil_kerja()){
		//	$this->session->set_flashdata('sukses', 'Data Sudah Di Rubah');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }
		}else{
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		}
	  }
      if($mode=='tambah_hasil_kerja'){
        $data['page'] =  $data['page']."_tambah_hasil_kerja";
		$data['title'] = "TAMBAH HASIL KERJA";
		$data['nama_hasil_kerja']  = set_value('nama_hasil_kerja',$this->input->post("nama_hasil_kerja"));
		$data['satuan_hasil_kerja']  = set_value('satuan_hasil_kerja',$this->input->post("satuan_hasil_kerja"));
		$this->load->view("anjababk/isi",$data);
      }
      if($mode=='simpan_tambah_hasil_kerja'){
		  $id_abk_detil = $this->input->post('id_abk_detil');
		  if($this->m_anjababk->simpan_hasil_kerja()){
			$this->session->set_flashdata('sukses', 'Data Sudah Di Tambah Silahkan Pilih Lagi');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }
      }
      if($mode=='kosong_hasil_kerja'){
		  if($this->m_anjababk->null_hasil_kerja($data['id'])){
			$this->session->set_flashdata('sukses', 'Data Sudah Di Kosongkan');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$data['id']));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Kosongkan Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$data['id']));
		  }
      }
	  //BAHAN KERJA
      if($mode=='bahan_kerja'){
        $data['page'] =  $data['page']."_bahan_kerja";
		$data['title'] = "BAHAN KERJA";
		$injabdet = $this->m_anjababk->ambil_injab_detil($data['id']);
		$data['bahan_kerja_all']   = $this->m_anjababk->bahan_kerja_all($this->session->id_jabatan);
		$data['bahan_kerja'] = set_value('bahan_kerja',$injabdet["bahan_kerja"]);
		$this->load->view("anjababk/isi",$data);
      }
      if($mode=='simpan_bahan_kerja'){
		  $id_abk_detil = $this->input->post('id_abk_detil');
		if($this->input->post('chk')){
		  if($this->m_anjababk->rubah_bahan_kerja()){
		//	$this->session->set_flashdata('sukses', 'Data Sudah Di Rubah');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }
		}else{
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		}
	  }
      if($mode=='tambah_bahan_kerja'){
        $data['page'] =  $data['page']."_tambah_bahan_kerja";
		$data['title'] = "TAMBAH BAHAN KERJA";
		$data['nama_bahan_kerja']  = set_value('nama_bahan_kerja',$this->input->post("nama_bahan_kerja"));
		$data['penggunaan']  = set_value('penggunaan',$this->input->post("penggunaan"));
		$this->load->view("anjababk/isi",$data);
      }
      if($mode=='simpan_tambah_bahan_kerja'){
		  $id_abk_detil = $this->input->post('id_abk_detil');
		  if($this->m_anjababk->simpan_bahan_kerja()){
			$this->session->set_flashdata('sukses', 'Data Sudah Di Tambah Silahkan Pilih Lagi');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }
      }
      if($mode=='kosong_bahan_kerja'){
		  if($this->m_anjababk->null_bahan_kerja($data['id'])){
			$this->session->set_flashdata('sukses', 'Data Sudah Di Kosongkan');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$data['id']));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Kosongkan Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$data['id']));
		  }
      }
	  //PERANGKAT KERJA
      if($mode=='perangkat_kerja'){
        $data['page'] =  $data['page']."_perangkat_kerja";
		$data['title'] = "PERANGKAT KERJA";
		$injabdet = $this->m_anjababk->ambil_injab_detil($data['id']);
		$data['perangkat_kerja_all']   = $this->m_anjababk->perangkat_kerja_all($this->session->id_jabatan);
		$data['perangkat_kerja'] = set_value('perangkat_kerja',$injabdet["perangkat_kerja"]);
		$this->load->view("anjababk/isi",$data);
      }
      if($mode=='simpan_perangkat_kerja'){
		  $id_abk_detil = $this->input->post('id_abk_detil');
		if($this->input->post('chk')){
		  if($this->m_anjababk->rubah_perangkat_kerja()){
		//	$this->session->set_flashdata('sukses', 'Data Sudah Di Rubah');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }
		}else{
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		}
	  }
      if($mode=='tambah_perangkat_kerja'){
        $data['page'] =  $data['page']."_tambah_perangkat_kerja";
		$data['title'] = "TAMBAH PERANGKAT KERJA";
		$data['nama_perangkat_kerja']  = set_value('nama_perangkat_kerja',$this->input->post("nama_perangkat_kerja"));
		$data['penggunaan']  = set_value('penggunaan',$this->input->post("penggunaan"));
		$this->load->view("anjababk/isi",$data);
      }
      if($mode=='simpan_tambah_perangkat_kerja'){
		  $id_abk_detil = $this->input->post('id_abk_detil');
		  if($this->m_anjababk->simpan_perangkat_kerja()){
			$this->session->set_flashdata('sukses', 'Data Sudah Di Tambah Silahkan Pilih Lagi');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }
      }
      if($mode=='kosong_perangkat_kerja'){
		  if($this->m_anjababk->null_perangkat_kerja($data['id'])){
			$this->session->set_flashdata('sukses', 'Data Sudah Di Kosongkan');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$data['id']));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Kosongkan Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$data['id']));
		  }
      }
	  //FUNGSI KERJA
      if($mode=='fungsi_kerja'){
        $data['page'] =  $data['page']."_fungsi_kerja";
		$data['title'] = "FUNGSI KERJA";
		$injabdet = $this->m_anjababk->ambil_injab_detil($data['id']);
		$data['fungsi_kerja_all']   = $this->m_anjababk->fungsi_kerja_all($this->session->id_jabatan);
		$data['fungsi_kerja'] = set_value('fungsi_kerja',$injabdet["fungsi_kerja"]);
		$this->load->view("anjababk/isi",$data);
      }
      if($mode=='simpan_fungsi_kerja'){
		  $id_abk_detil = $this->input->post('id_abk_detil');
		if($this->input->post('chk')){
		  if($this->m_anjababk->rubah_fungsi_kerja()){
		//	$this->session->set_flashdata('sukses', 'Data Sudah Di Rubah');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }
		}else{
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		}
      }
      if($mode=='tambah_fungsi_kerja'){
        $data['page'] =  $data['page']."_tambah_fungsi_kerja";
		$data['title'] = "TAMBAH FUNGSI KERJA";
		$data['id_fungsi_kerja']  = set_value('id_fungsi_kerja',$this->input->post("id_fungsi_kerja"));
		$data['arti']  = set_value('arti',$this->input->post("arti"));
		$data['deskripsi']  = set_value('deskripsi',$this->input->post("deskripsi"));
		$this->load->view("anjababk/isi",$data);
      }
      if($mode=='simpan_tambah_fungsi_kerja'){
		  $id_abk_detil = $this->input->post('id_abk_detil');
		  $id_fungsi_kerja = $this->input->post('id_fungsi_kerja');
			$kondisi=array('id_fungsi_kerja'=>$id_fungsi_kerja);
			$jml = $this->m_umum->jumlah_record_filter('p_fungsi_kerja',$kondisi);
			if($jml == 0){
			  if($this->m_anjababk->simpan_fungsi_kerja()){
				$this->session->set_flashdata('sukses', 'Data Sudah Di Tambah Silahkan Pilih Lagi');
				redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
			  }else{
				$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
				redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
			  }
			}else{
				$this->session->set_flashdata('danger', 'Kode Sudah Ada');
				redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
			}
      }
      if($mode=='kosong_fungsi_kerja'){
		  if($this->m_anjababk->null_fungsi_kerja($data['id'])){
			$this->session->set_flashdata('sukses', 'Data Sudah Di Kosongkan');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$data['id']));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Kosongkan Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$data['id']));
		  }
      }
	  //HUBUNGAN JABATAN
      if($mode=='hubungan_jabatan'){
        $data['page'] =  $data['page']."_hubungan_jabatan";
		$data['title'] = "HUBUNGAN JABATAN";
		$injabdet = $this->m_anjababk->ambil_injab_detil($data['id']);
		$data['hubungan_jabatan_all']   = $this->m_anjababk->hubungan_jabatan_all($this->session->id_jabatan);
		$data['hubungan_jabatan'] = set_value('hubungan_jabatan',$injabdet["hubungan_jabatan"]);
		$this->load->view("anjababk/isi",$data);
      }
      if($mode=='simpan_hubungan_jabatan'){
		  $id_abk_detil = $this->input->post('id_abk_detil');
		if($this->input->post('chk')){
		  if($this->m_anjababk->rubah_hubungan_jabatan()){
		//	$this->session->set_flashdata('sukses', 'Data Sudah Di Rubah');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }
		}else{
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		}
	  }
      if($mode=='tambah_hubungan_jabatan'){
        $data['page'] =  $data['page']."_tambah_hubungan_jabatan";
		$data['title'] = "TAMBAH HUBUNGAN JABATAN";
		$data['nama_hubungan_jabatan']  = set_value('nama_hubungan_jabatan',$this->input->post("nama_hubungan_jabatan"));
		$data['unit_kerja']  = set_value('unit_kerja',$this->input->post("unit_kerja"));
		$data['hal']  = set_value('hal',$this->input->post("hal"));
		$this->load->view("anjababk/isi",$data);
      }
      if($mode=='simpan_tambah_hubungan_jabatan'){
		  $id_abk_detil = $this->input->post('id_abk_detil');
		  if($this->m_anjababk->simpan_hubungan_jabatan()){
			$this->session->set_flashdata('sukses', 'Data Sudah Di Tambah Silahkan Pilih Lagi');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }
      }
      if($mode=='kosong_hubungan_jabatan'){
		  if($this->m_anjababk->null_hubungan_jabatan($data['id'])){
			$this->session->set_flashdata('sukses', 'Data Sudah Di Kosongkan');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$data['id']));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Kosongkan Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$data['id']));
		  }
      }
	  //KONDISI TEMPAT
      if($mode=='kondisi_tempat'){
        $data['page'] =  $data['page']."_kondisi_tempat";
		$data['title'] = "KONDISI TEMPAT";
		$injabdet = $this->m_anjababk->ambil_injab_detil($data['id']);
		$data['kondisi_tempat_all']   = $this->m_anjababk->kondisi_tempat_all($this->session->id_jabatan);
		$data['kondisi_tempat'] = set_value('kondisi_tempat',$injabdet["kondisi_tempat_kerja"]);
		$this->load->view("anjababk/isi",$data);
      }
      if($mode=='simpan_kondisi_tempat'){
		  $id_abk_detil = $this->input->post('id_abk_detil');
		if($this->input->post('chk')){
		  if($this->m_anjababk->rubah_kondisi_tempat()){
		//	$this->session->set_flashdata('sukses', 'Data Sudah Di Rubah');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }
		}else{
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		}
	  }
      if($mode=='tambah_kondisi_tempat'){
        $data['page'] =  $data['page']."_tambah_kondisi_tempat";
		$data['title'] = "TAMBAH KONDISI TEMPAT";
		$data['aspek']  = set_value('aspek',$this->input->post("aspek"));
		$data['faktor']  = set_value('faktor',$this->input->post("faktor"));
		$this->load->view("anjababk/isi",$data);
      }
      if($mode=='simpan_tambah_kondisi_tempat'){
		  $id_abk_detil = $this->input->post('id_abk_detil');
		  if($this->m_anjababk->simpan_kondisi_tempat()){
			$this->session->set_flashdata('sukses', 'Data Sudah Di Tambah Silahkan Pilih Lagi');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }
      }
      if($mode=='kosong_kondisi_tempat'){
		  if($this->m_anjababk->null_kondisi_tempat($data['id'])){
			$this->session->set_flashdata('sukses', 'Data Sudah Di Kosongkan');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$data['id']));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Kosongkan Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$data['id']));
		  }
      }
	  //UPAYA FISIK
      if($mode=='upaya_fisik'){
        $data['page'] =  $data['page']."_upaya_fisik";
		$data['title'] = "UPAYA FISIK";
		$injabdet = $this->m_anjababk->ambil_injab_detil($data['id']);
		$data['upaya_fisik_all']   = $this->m_anjababk->upaya_fisik_all($this->session->id_jabatan);
		$data['upaya_fisik'] = set_value('upaya_fisik',$injabdet["upaya_fisik"]);
		$this->load->view("anjababk/isi",$data);
      }
      if($mode=='simpan_upaya_fisik'){
		  $id_abk_detil = $this->input->post('id_abk_detil');
		if($this->input->post('chk')){
		  if($this->m_anjababk->rubah_upaya_fisik()){
		//	$this->session->set_flashdata('sukses', 'Data Sudah Di Rubah');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }
		}else{
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		}
	  }
      if($mode=='kosong_upaya_fisik'){
		  if($this->m_anjababk->null_upaya_fisik($data['id'])){
			$this->session->set_flashdata('sukses', 'Data Sudah Di Kosongkan');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$data['id']));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Kosongkan Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$data['id']));
		  }
      }
	  //KONDISI TEMPAT
      if($mode=='resiko_bahaya'){
        $data['page'] =  $data['page']."_resiko_bahaya";
		$data['title'] = "RESIKO BAHAYA";
		$injabdet = $this->m_anjababk->ambil_injab_detil($data['id']);
		$data['resiko_bahaya_all']   = $this->m_anjababk->resiko_bahaya_all($this->session->id_jabatan);
		$data['resiko_bahaya'] = set_value('resiko_bahaya',$injabdet["resiko_bahaya"]);
		$this->load->view("anjababk/isi",$data);
      }
      if($mode=='simpan_resiko_bahaya'){
		  $id_abk_detil = $this->input->post('id_abk_detil');
		if($this->input->post('chk')){
		  if($this->m_anjababk->rubah_resiko_bahaya()){
		//	$this->session->set_flashdata('sukses', 'Data Sudah Di Rubah');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }
		}else{
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		}
	  }
      if($mode=='tambah_resiko_bahaya'){
        $data['page'] =  $data['page']."_tambah_resiko_bahaya";
		$data['title'] = "TAMBAH RESIKO BAHAYA";
		$data['fisik']  = set_value('fisik',$this->input->post("fisik"));
		$data['penyebab']  = set_value('penyebab',$this->input->post("penyebab"));
		$this->load->view("anjababk/isi",$data);
      }
      if($mode=='simpan_tambah_resiko_bahaya'){
		  $id_abk_detil = $this->input->post('id_abk_detil');
		  if($this->m_anjababk->simpan_resiko_bahaya()){
			$this->session->set_flashdata('sukses', 'Data Sudah Di Tambah Silahkan Pilih Lagi');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }
      }
      if($mode=='kosong_resiko_bahaya'){
		  if($this->m_anjababk->null_resiko_bahaya($data['id'])){
			$this->session->set_flashdata('sukses', 'Data Sudah Di Kosongkan');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$data['id']));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Kosongkan Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$data['id']));
		  }
      }
	  //PENDIDIKAN
      if($mode=='pendidikan'){
        $data['page'] =  $data['page']."_pendidikan";
		$data['title'] = "PENDIDIKAN";
		$injabdet = $this->m_anjababk->ambil_injab_detil($data['id']);
		$data['pendidikan_all']   = $this->m_anjababk->pendidikan_all($this->session->id_jabatan);
		$data['pendidikan'] = set_value('pendidikan',$injabdet["pendidikan_formal"]);
		$this->load->view("anjababk/isi",$data);
      }
      if($mode=='simpan_pendidikan'){
		  $id_abk_detil = $this->input->post('id_abk_detil');
		if($this->input->post('chk')){
		  if($this->m_anjababk->rubah_pendidikan()){
		//	$this->session->set_flashdata('sukses', 'Data Sudah Di Rubah');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }
		}else{
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		}
	  }
      if($mode=='tambah_pendidikan'){
        $data['page'] =  $data['page']."_tambah_pendidikan";
		$data['title'] = "TAMBAH PENDIDIKAN";
		$data['nama_pendidikan']  = set_value('nama_pendidikan',$this->input->post("nama_pendidikan"));
		$this->load->view("anjababk/isi",$data);
      }
      if($mode=='simpan_tambah_pendidikan'){
		  $id_abk_detil = $this->input->post('id_abk_detil');
		  if($this->m_anjababk->simpan_pendidikan()){
			$this->session->set_flashdata('sukses', 'Data Sudah Di Tambah Silahkan Pilih Lagi');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }
      }
      if($mode=='kosong_pendidikan'){
		  if($this->m_anjababk->null_pendidikan($data['id'])){
			$this->session->set_flashdata('sukses', 'Data Sudah Di Kosongkan');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$data['id']));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Kosongkan Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$data['id']));
		  }
      }
	  //PANGKAT
      if($mode=='pangkat'){
        $data['page'] =  $data['page']."_pangkat";
		$data['title'] = "PANGKAT / GOLONGAN";
		$injabdet = $this->m_anjababk->ambil_injab_detil($data['id']);
		$data['pangkat_all']   = $this->m_anjababk->pangkat_all($this->session->id_jabatan);
		$data['pangkat'] = set_value('pangkat',$injabdet["pangkat"]);
		$this->load->view("anjababk/isi",$data);
      }
      if($mode=='simpan_pangkat'){
		  $id_abk_detil = $this->input->post('id_abk_detil');
		if($this->input->post('chk')){
		  if($this->m_anjababk->rubah_pangkat()){
		//	$this->session->set_flashdata('sukses', 'Data Sudah Di Rubah');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }
		}else{
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		}
	  }
      if($mode=='kosong_pangkat'){
		  if($this->m_anjababk->null_pangkat($data['id'])){
			$this->session->set_flashdata('sukses', 'Data Sudah Di Kosongkan');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$data['id']));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Kosongkan Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$data['id']));
		  }
      }
	  //BAKAT KERJA
      if($mode=='bakat_kerja'){
        $data['page'] =  $data['page']."_bakat_kerja";
		$data['title'] = "BAKAT KERJA";
		$injabdet = $this->m_anjababk->ambil_injab_detil($data['id']);
		$data['bakat_kerja_all']   = $this->m_anjababk->bakat_kerja_all($this->session->id_jabatan);
		$data['bakat_kerja'] = set_value('bakat_kerja',$injabdet["bakat_kerja"]);
		$this->load->view("anjababk/isi",$data);
      }
      if($mode=='simpan_bakat_kerja'){
		  $id_abk_detil = $this->input->post('id_abk_detil');
		if($this->input->post('chk')){
		  if($this->m_anjababk->rubah_bakat_kerja()){
		//	$this->session->set_flashdata('sukses', 'Data Sudah Di Rubah');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }
		}else{
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		}
	  }
      if($mode=='kosong_bakat_kerja'){
		  if($this->m_anjababk->null_bakat_kerja($data['id'])){
			$this->session->set_flashdata('sukses', 'Data Sudah Di Kosongkan');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$data['id']));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Kosongkan Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$data['id']));
		  }
      }
	  //TEMPERAMEN KERJA
      if($mode=='temperamen_kerja'){
        $data['page'] =  $data['page']."_temperamen_kerja";
		$data['title'] = "TEMPERAMEN KERJA";
		$injabdet = $this->m_anjababk->ambil_injab_detil($data['id']);
		$data['temperamen_kerja_all']   = $this->m_anjababk->temperamen_kerja_all($this->session->id_jabatan);
		$data['temperamen_kerja'] = set_value('temperamen_kerja',$injabdet["temperamen_kerja"]);
		$this->load->view("anjababk/isi",$data);
      }
      if($mode=='simpan_temperamen_kerja'){
		  $id_abk_detil = $this->input->post('id_abk_detil');
		if($this->input->post('chk')){
		  if($this->m_anjababk->rubah_temperamen_kerja()){
		//	$this->session->set_flashdata('sukses', 'Data Sudah Di Rubah');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }
		}else{
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		}
	  }
      if($mode=='kosong_temperamen_kerja'){
		  if($this->m_anjababk->null_temperamen_kerja($data['id'])){
			$this->session->set_flashdata('sukses', 'Data Sudah Di Kosongkan');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$data['id']));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Kosongkan Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$data['id']));
		  }
      }
	  //MINAT KERJA
      if($mode=='minat_kerja'){
        $data['page'] =  $data['page']."_minat_kerja";
		$data['title'] = "MINAT KERJA";
		$injabdet = $this->m_anjababk->ambil_injab_detil($data['id']);
		$data['minat_kerja_all']   = $this->m_anjababk->minat_kerja_all($this->session->id_jabatan);
		$data['minat_kerja'] = set_value('minat_kerja',$injabdet["minat_kerja"]);
		$this->load->view("anjababk/isi",$data);
      }
      if($mode=='simpan_minat_kerja'){
		  $id_abk_detil = $this->input->post('id_abk_detil');
		if($this->input->post('chk')){
		  if($this->m_anjababk->rubah_minat_kerja()){
		//	$this->session->set_flashdata('sukses', 'Data Sudah Di Rubah');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  }
		}else{
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		}
	  }
      if($mode=='kosong_minat_kerja'){
		  if($this->m_anjababk->null_minat_kerja($data['id'])){
			$this->session->set_flashdata('sukses', 'Data Sudah Di Kosongkan');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$data['id']));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Kosongkan Data. Hubungi Admin');
			redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$data['id']));
		  }
      }
	  //BUTIR KEGIATAN
      if($mode=='pilih_bk'){
        $data['page'] =  $data['page']."_pilih_bk";
				$injabdet = $this->m_anjababk->ambil_injab_detil($data['id']);
				$data['butir_kegiatan_all']   = $this->m_anjababk->ambil_nkr_kompetensi($this->session->id_jabatan);
				$data['id_kompetensi'] = set_value('id_kompetensi', $injabdet["id_kompetensi"]);
				$data['periode'] = set_value('periode', $injabdet["periode"]);
				$this->load->view("anjababk/isi",$data);
      }
      if($mode=='simpan_pilih_bk'){
		  	$id_abk_detil = $this->input->post('id_abk_detil');
				if($this->input->post('chk')){
		  		if($this->m_anjababk->rubah_bk()){
					//	$this->session->set_flashdata('sukses', 'Data Sudah Di Rubah');
					redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  		}else{
						$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
						redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
		  		}
				}else{
					redirect(base_url('anjababk/informasi_jabatan/pilihan/'.$id_abk_detil));
				}
	  }
	}
  }
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("anjababk/header",$data);
	$this->load->view("anjababk/isi");
	$this->load->view("footer");
	$this->load->view("anjababk/jsload");
	$this->load->view("anjababk/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_top",$data);
	$this->load->view("anjababk/isi");
	$this->load->view("footer");
	$this->load->view("anjababk/jsload");
	$this->load->view("anjababk/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
