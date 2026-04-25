<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Spk extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
          $this->load->model('m_sample');
  }
	function index(){
		$data['page']="home";
		$data['header'] = "BERANDA";
		$data['title'] = "BERANDA";
		$data['link_kembali'] = base_url('spk');
		$data['link_awal'] = base_url('');
		$data['nama'] = "NAMA NAKES";
		$data['level'] = "Perawat Madya";
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','5');
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
		//======================= IMPORTANT =========================================
		$this->spk();
	}
	function spk($mode='view'){
		$data['page']="spk"; 
		$data['header'] = "UPLOAD DATA DAN SPK";
		$data['title'] = "UPLOAD DATA DAN SPK";
		$data['link_kembali'] = base_url('spk');
		$data['link_awal'] = base_url('');
		$data['nama'] = "NAMA NAKES";
		$data['level'] = "Perawat Madya";
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','5');
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
		//======================= IMPORTANT =========================================
		$data['id']    = $this->uri->segment(4, 0);
		if(empty($data['id'])){
			$data['id'] = "";
		}
		if($mode=='view'){
			$this->tampil_top($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
	      $id   = $this->input->post("id");
	      $trim_keyword   = urldecode(trim($this->input->post("id")));
				$replace_keyword   = preg_replace('/\s+/', ' ', $trim_keyword);
				$key = str_replace(' ', '-', $replace_keyword);
				redirect(base_url('s_kompetensi/spk/view/'.$key));
			}
		}
		else if($mode=='data'){
			echo json_encode($this->m_sample->pengajuan_kompetensi_spk_all());
		}
		else{
      if($mode=='kelengkapan'){
        $data['page'] =  $data['page']."_kelengkapan";
				$data['cmd_ambil_direktur'] = $this->m_sample->cmd_ambil_direktur($this->session->list_instansi);
				$kondisi_pengajuan=array('barcode_pengajuan'=>$data['id']);
				$pengajuan = $this->m_umum->ambil_data_kondisi('s_pengajuan',$kondisi_pengajuan);
				$kondisi_lampiran=array('id_pengajuan'=>$pengajuan['id_pengajuan']);
				$jml_lampiran = $this->m_umum->jumlah_record_filter('s_pengajuan_report',$kondisi_lampiran);
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
					$kr_pengajuan_report = $this->m_umum->ambil_data('s_pengajuan_report','id_pengajuan',$pengajuan['id_pengajuan']);
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
					$this->tampil_top($data);
        }else{
					$id_pengajuan= $this->input->post('id_pengajuan');
					$id_status_diusulkan= $this->input->post('id_status_diusulkan');
					$kondisi_lampir=array('id_pengajuan'=>$id_pengajuan);
					$jml_lampir = $this->m_umum->jumlah_record_filter('s_pengajuan_report',$kondisi_lampir);
					$lihat_kw = $this->m_umum->ambil_data_kondisi('s_pengajuan',$kondisi_lampir);
					if(empty($lihat_kw['kredensial']) || empty($lihat_kw['mutu']) || empty($lihat_kw['etika']) || empty($lihat_kw['spk'])){
			    //  $this->session->set_flashdata('danger', 'Data Upload Belum Lengkap');
						redirect(base_url('kompetensi/spk'));	
					}else{
						if($jml_lampiran == 0){
				//			$this->m_ol_validasi->simpan_kr_pengajuan_report();
						}else{
				//			$this->m_ol_validasi->edit_kr_pengajuan_report();
						}
				//		$this->session->set_flashdata('sukses', 'Data Sudah Dilengkapi Silahkan Print Penugasan Klinis');
						redirect(base_url('spk/spk'));
					}
        }
      }
		if($mode=='pdf'){
		  $report = $this->load->view('s_kompetensi/ol_penugasan_klinis', $data, TRUE);
		  $apk	=$this->m_sample->ambil_pengajuan_kompetensi_spk($data['id']);
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
	$this->load->view("s_kompetensi/header",$data);
	$this->load->view("s_kompetensi/isi");
	$this->load->view("footer");$this->load->view("s_kompetensi/jsload");
	$this->load->view("s_kompetensi/jscode");	

}
function tampil_top($data)
{
	$this->load->view("header_landing",$data);
	$this->load->view("s_kompetensi/isi");
	$this->load->view("footer");$this->load->view("s_kompetensi/jsload");
	$this->load->view("s_kompetensi/jscode");	

}
// -----------------------------------------------------------END-----------------------------------------
}
