<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Ol_korespodensi extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
          $this->load->model('m_ol_korespodensi');
          $this->load->model('m_ol_rancak');
          $this->login_kah();
  }
  function login_kah(){
  	$kores = $this->m_umum->ambil_data('a_online','kode_online','ol_korespodensi');
  	if($kores['status_online'] == 1){
	  	$link_akses = $this->uri->segment(1, 0);
			$kondisi_hak=array('id_pegawai'=>$this->session->id_pegawai,'link_akses'=>$link_akses);
			$jumlah_hak_akses_pegawai=$this->m_rancak->jumlah_hak_akses_pegawai($kondisi_hak);
			if($jumlah_hak_akses_pegawai == 0){
				$this->cek_login_kah();
			}else{
				return TRUE;
			}
		}else{
			redirect(base_url('logout'));
		}
  }
  function cek_login_kah()
  {
      if ( $this->session->has_userdata('id_pegawai') )
          return TRUE;
     else
          redirect(base_url('logout'));
  }
	function index(){
		$data['page']="home";
		$data['header'] = "SURAT";
		$data['title'] = "SURAT";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$data['multi_level'] = $this->m_ol_rancak->ambil_data_link_pengurus($this->session->id_pegawai);
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
		$data['member_id'] = $pegawai["id_pegawai"];
		$data['member_name'] = $pegawai["nama_pegawai"];
		$data['level_name'] = $pegawai["nama_level"];
		$data['photo'] = $pegawai["foto"];	
		//======================= IMPORTANT =========================================
		$data['id']   = $this->uri->segment(4, 0);
		$this->tampil($data);
	}
  function pengajuan_korespodensi($mode='view')
  {
		$data['page']  = "pengajuan_korespodensi";
		$data['header'] = "PENGAJUAN SURAT";
		$data['title'] = "PENGAJUAN SURAT";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$data['multi_level'] = $this->m_ol_rancak->ambil_data_link_pengurus($this->session->id_pegawai);
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
		$data['pengcab_id'] = $pegawai["id_pengcab"];
		$data['photo'] = $pegawai["foto"];	
		//======================= IMPORTANT =========================================
		$data['id']   = $this->uri->segment(4, 0);
		if($mode=='view'){
			$this->tampil($data);
		}
		else if($mode=='data'){
			echo json_encode($this->m_ol_korespodensi->surat_pengajuan_all());
		}
		else if($mode=='dataprint'){
			echo json_encode($this->m_ol_rancak->kor_print_all($data['id']));
		}
 	 else{
	  $data['ambil_data_surat_kategori']=$this->m_ol_rancak->ambil_data_surat_kategori($this->session->id_jabatan);
	  $data['ambil_data_pengcabnonull']=$this->m_ol_rancak->ambil_data_pengcabnonull($this->session->id_jabatan);
	  $data['ambil_data_instansi']=$this->m_ol_rancak->ambil_data_instansi();
      if($mode=='tambah'){
          $data['page'] =  $data['page']."_tambah";
		      $data['id_kategori']  = set_value('id_kategori',$this->input->post('id_kategori'));
		      $data['pengcab_tujuan']  = set_value('pengcab_tujuan',$this->input->post('pengcab_tujuan'));
		      $data['id_instansi']  = set_value('id_instansi',$this->input->post('id_instansi'));
		      $this->load->view("ol_korespodensi/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($last = $this->m_ol_korespodensi->simpan_korespondensi()){
			  	$this->m_ol_korespodensi->simpan_kor_kategori($last);
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('ol_korespodensi/pengajuan_korespodensi'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('ol_korespodensi/pengajuan_korespodensi'));
			  }
      }
      if($mode=='mutasi'){
          $data['page'] =  $data['page']."_mutasi";
		      $data['id_kategori']  = set_value('id_kategori',$this->input->post('id_kategori'));
		      $data['pengcab_tujuan']  = set_value('pengcab_tujuan',$this->input->post('pengcab_tujuan'));
		      $data['id_instansi']  = set_value('id_instansi',$this->input->post('id_instansi'));
		      $this->load->view("ol_korespodensi/isi",$data);
      }
      if($mode=='simpan_mutasi'){
			  if($last = $this->m_ol_korespodensi->simpan_korespondensi()){
			  	$this->m_ol_korespodensi->simpan_kor_kategori($last);
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('ol_korespodensi/pengajuan_korespodensi'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('ol_korespodensi/pengajuan_korespodensi'));
			  }
      }
      if($mode=='kirim'){
			  if($this->m_ol_korespodensi->kirim($data['id'])){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Kirim');
					redirect(base_url('ol_korespodensi/pengajuan_korespodensi'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('ol_korespodensi/pengajuan_korespodensi'));
			  }
      }
      if($mode=='isi'){
        $data['page'] =  $data['page']."_isi";
				$data['ambil_berkas_data']=$this->m_ol_rancak->ambil_id_berkas_data($this->session->id_pegawai);
				$d	= $this->m_ol_rancak->ambil_data_korespodensi($data['id']);
				$dx	= $this->m_ol_rancak->ambil_data_okk_and_osk_4_pengajuan($d['id_korespodensi']);
		    if($d["id_pengirim"] !== $this->session->id_pegawai){
		      redirect(base_url('ol_korespodensi/pengajuan_korespodensi'));
		    }
				$data['nama_kategori']  = set_value('nama_kategori',$dx["nama_kategori"]);
				$data['syarat_kategori']  = set_value('syarat_kategori',$dx["syarat_kategori"]);
				$data['id_kategori']  = set_value('id_kategori',$dx["id_kategori"]);
				$data['id_korespodensi']  = set_value('id_korespodensi',$d["id_korespodensi"]);
				$data['barcode_korespodensi']  = set_value('barcode_korespodensi',$d["barcode_korespodensi"]);
				$data['status_korespodensi']  = set_value('status_korespodensi',$d["status_korespodensi"]);
				$data['wkt_korespodensi']  = date('d-m-Y H:i:s', strtotime($d["wkt_korespodensi"]));
				$data['no_korespodensi']  = set_value('no_korespodensi',$d["no_korespodensi"]);
				$data['sifat_surat']  = set_value('sifat_surat',$d["sifat_surat"]);
				$data['id_berkas']  = explode(",", $d["id_berkas"]);
				$data['berkas']  = $d["id_berkas"];
				$data['id_ijasah']  = explode(",", $d["id_ijasah"]);
				$data['ijasah']  = $d["id_ijasah"];
				$data['id_str']  = explode(",", $d["id_str"]);
				$data['str']  = $d["id_str"];
				$data['id_sertifikat']  = explode(",", $d["id_sertifikat"]);
				$data['sertifikat']  = $d["id_sertifikat"];
				$data['foto_pengaju']  = set_value('foto_pengaju',$d["foto"]);
				$data['nama_pengaju']  = set_value('nama_pengaju',$d["nama_pegawai"]);
				$data['tempat_kerja']  = set_value('tempat_kerja',$d["nama_working"]);
				$data['umur']  = set_value('umur',$d["umur"]);
				$data['jk']  = set_value('jk',$d["jk"]);
				$this->tampil($data);
				$action = $this->input->post('action');
				$id_pengajuan = $this->input->post('id_pengajuan');
				if($action == 'Btnsimpan') {
					$this->m_ol_korespodensi->edit_pengajuan();
			//		$this->m_ol_korespodensi->edit_pengcab();
					$this->session->set_flashdata('sukses', 'Pengajuan Sudah Di Simpan');
					redirect(base_url('ol_korespodensi/pengajuan_korespodensi'));
				}
	  	}
			if($mode=='pdf_surat'){
				$d	= $this->m_ol_rancak->ambil_data_kor_print_4_print($data['id']);
				$report = $this->load->view($d['link_print'], $data, TRUE);
			  $filename = $d["nama_kategori"]."-".$d["nama_pegawai"]."-print-date-".date('d-m-Y').".pdf";
			  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
			  $mpdf->AddPage('P', '', '', '', 2, 5, 5, 5, 10, 3, 3);
			  $mpdf->SetDisplayMode('fullpage');
			  $mpdf->SetTitle($data['header']);
			  $mpdf->SetAuthor($data['instance_name']);
			  $mpdf->defaultheaderline = 0;
		      $mpdf->defaultfooterline = 0;
		//	  $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
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
  function berkas_ijasah($mode='view')
  {
		$data['page']  = "berkas_ijasah";
		$data['header'] = "AMBIL BERKAS IJASAH";
		$data['title'] = "AMBIL BERKAS IJASAH";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$data['multi_level'] = $this->m_ol_rancak->ambil_data_link_pengurus($this->session->id_pegawai);
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
		$data['pengcab_id'] = $pegawai["id_pengcab"];
		$data['photo'] = $pegawai["foto"];	
		$data['id']  = $this->uri->segment(4, 0);
		$data['idb']  = $this->uri->segment(5, 0);
    if($mode=='view'){
		$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_ol_korespodensi->ijasah_all());
	}
  else{
      if($mode=='simpan'){
      	$cek_berkas=$this->m_umum->ambil_data('ol_berkas','id_berkas',$data['idb']);
      	if(empty($cek_berkas['link_berkas'])){
      		$this->session->set_flashdata('danger', 'Tidak File Gambar');
      	}else{
					$status_pengajuan=$this->m_umum->ambil_data('ol_korespodensi','barcode_korespodensi',$data['id']);
					$id_ijasahe = $status_pengajuan['id_ijasah'];
					$this->m_ol_korespodensi->simpan_berkas_ijasah($data['id'],$data['idb'],$id_ijasahe);
      	}
					redirect(base_url('ol_korespodensi/pengajuan_korespodensi/isi/'.$data['id']));
      }
	}
  }
  function berkas_sertifikat($mode='view')
  {
	$data['page']  = "berkas_sertifikat";
	$data['header'] = "AMBIL BERKAS PELATIHAN / SERTIFIKAT";
	$data['title'] = "AMBIL BERKAS PELATIHAN / SERTIFIKAT";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$data['multi_level'] = $this->m_ol_rancak->ambil_data_link_pengurus($this->session->id_pegawai);
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
		$data['pengcab_id'] = $pegawai["id_pengcab"];
		$data['photo'] = $pegawai["foto"];	
	$data['id']  = $this->uri->segment(4, 0);
	$data['idb']  = $this->uri->segment(5, 0);
    if($mode=='view'){
		$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_ol_korespodensi->pelatihan_all());
	}
  else{
      if($mode=='simpan'){
      	$cek_berkas=$this->m_umum->ambil_data('ol_berkas','id_berkas',$data['idb']);
      	if(empty($cek_berkas['link_berkas'])){
      		$this->session->set_flashdata('danger', 'Tidak File Gambar');
      	}else{
					$status_pengajuan=$this->m_umum->ambil_data('ol_korespodensi','barcode_korespodensi',$data['id']);
					$id_ijasahe = $status_pengajuan['id_sertifikat'];
					$this->m_ol_korespodensi->simpan_berkas_sertifikat($data['id'],$data['idb'],$id_ijasahe);
      	}
					redirect(base_url('ol_korespodensi/pengajuan_korespodensi/isi/'.$data['id']));
      }
	}
  }
  function berkas_str($mode='view')
  {
	$data['page']  = "berkas_str";
	$data['header'] = "AMBIL BERKAS SURAT IJIN";
	$data['title'] = "AMBIL BERKAS SURAT IJIN";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$data['multi_level'] = $this->m_ol_rancak->ambil_data_link_pengurus($this->session->id_pegawai);
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
		$data['pengcab_id'] = $pegawai["id_pengcab"];
		$data['photo'] = $pegawai["foto"];	
	$data['id']  = $this->uri->segment(4, 0);
	$data['idb']  = $this->uri->segment(5, 0);
    if($mode=='view'){
		$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_ol_korespodensi->str_all());
	}
  else{
      if($mode=='simpan'){
      	$cek_berkas=$this->m_umum->ambil_data('ol_berkas','id_berkas',$data['idb']);
      	if(empty($cek_berkas['link_berkas'])){
      		$this->session->set_flashdata('danger', 'Tidak File Gambar');
      	}else{
					$status_pengajuan=$this->m_umum->ambil_data('ol_korespodensi','barcode_korespodensi',$data['id']);
					$id_ijasahe = $status_pengajuan['id_str'];
					$this->m_ol_korespodensi->simpan_berkas_str($data['id'],$data['idb'],$id_ijasahe);
      	}
					redirect(base_url('ol_korespodensi/pengajuan_korespodensi/isi/'.$data['id']));
      }
	}
  }
  function berkaslain_berkas($mode='view')
  {
	$data['page']  = "berkaslain_berkas";
	$data['header'] = "AMBIL BERKAS UMUM";
	$data['title'] = "AMBIL BERKAS UMUM";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$data['multi_level'] = $this->m_ol_rancak->ambil_data_link_pengurus($this->session->id_pegawai);
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
		$data['pengcab_id'] = $pegawai["id_pengcab"];
		$data['photo'] = $pegawai["foto"];	
	$data['id']  = $this->uri->segment(4, 0);
	$data['idb']  = $this->uri->segment(5, 0);
    if($mode=='view'){
		$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_ol_korespodensi->berkas_pribadi_all());
	}
  else{
      if($mode=='simpan'){
      	$cek_berkas=$this->m_umum->ambil_data('ol_berkas','id_berkas',$data['idb']);
      	if(empty($cek_berkas['link_berkas'])){
      		$this->session->set_flashdata('danger', 'Tidak File Gambar');
      	}else{
					$status_pengajuan=$this->m_umum->ambil_data('ol_korespodensi','barcode_korespodensi',$data['id']);
					$id_ijasahe = $status_pengajuan['id_berkas'];
					$this->m_ol_korespodensi->simpan_berkaslain_berkas($data['id'],$data['idb'],$id_ijasahe);
      	}
					redirect(base_url('ol_korespodensi/pengajuan_korespodensi/isi/'.$data['id']));
      }
	}
  }
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("ol_korespodensi/header",$data);
	$this->load->view("ol_korespodensi/isi");
	$this->load->view("footer");
	$this->load->view("ol_korespodensi/jsload");
	$this->load->view("ol_korespodensi/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_top",$data);
	$this->load->view("ol_korespodensi/isi");
	$this->load->view("footer");
	$this->load->view("ol_korespodensi/jsload");
	$this->load->view("ol_korespodensi/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
