<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class S_logbook extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
          $this->load->model('m_sample');
  }
	function index(){
		$this->logbook();
	}
  function jabfung_data($id)
  {
    $dt=$this->m_sample->ambil_data_dropdown_jabfung_status($id);
    echo json_encode($dt);
  }
  function logbook($mode='view')
  {
		$data['page']  = "logbook";
		$data['header'] = "LOGBOOK";
		$data['title'] = "LOGBOOK";
		$data['link_kembali'] = base_url('s_logbook');
		$data['link_awal'] = base_url('');
		$data['nama_pk'] = "PK";
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
		$data['id_jabatan'] = $this->uri->segment(4, 0);
		$data['id_jabatan_fungsional'] = $this->uri->segment(5, 0);
		$data['id_ruangan'] = $this->uri->segment(6, 0);
		$data['opsi_kewenangan'] = $this->uri->segment(7, 0);
		$data['id_kode_kewenangan'] = $this->uri->segment(8, 0);
    if($mode=='view'){
		$this->tampil_top($data);
		}
    else if($mode=='data'){
		echo json_encode($this->m_sample->s_logbook_all());
	}
  else{
		$data['cmd_opsi'] = array('0'=>'Buku Putih Keperawatan','1'=>'Butir Kegiatan (Semua Nakes)');
		$data['kr_kewenangan_detil']=$this->m_sample->opsi_logbook($data['id_ruangan'],$data['id_jabatan_fungsional'],$data['opsi_kewenangan'],$data['id_kode_kewenangan']);
		$data['cmd_ruangan']=$this->m_sample->cmd_ruangan();
		$data['cmd_jabatan']=$this->m_rancak->cmd_jabatan();
		$data['cmd_jabfung_buket']=$this->m_sample->ambil_data_dropdown_jabfung_all();
		$data['kol_kode_kewenangan_null_pk']=$this->m_sample->kol_kode_kewenangan_null_pk();
	//	$data['cmd_working_logbook']=$this->m_ol_rancak->cmd_working_logbook();
    if($mode=='tambah'){
      $data['page'] =  $data['page']."_tambah";
			$this->form_validation->set_rules('opsi_kewenangan','opsi_kewenangan','required');
	    if ($this->form_validation->run() === FALSE){
				$this->tampil_top($data);
	    }else{
				$id_jabatan = $this->input->post("id_jabatan");
				$id_jabatan_fungsional = $this->input->post("id_jabatan_fungsional");
				$id_ruangan = $this->input->post("id_ruangan");
				$opsi_kewenangan = $this->input->post("opsi_kewenangan");
				$id_kode_kewenangan = $this->input->post("id_kode_kewenangan");
				$action = $this->input->post("action");
if($action == 'BtnProses') {
	redirect(base_url('s_logbook/logbook/tambah/'.$id_jabatan.'/'.$id_jabatan_fungsional.'/'.$id_ruangan.'/'.$opsi_kewenangan.'/'.$id_kode_kewenangan));
}		
				if($action == 'BtnSimpan') {
					if($this->input->post('chk')){
						$checkboxes = $this->input->post('chk');
						$chk = implode("-",$checkboxes);
						redirect(base_url('s_logbook/logbook/isi/'.$chk));
					}else{
						redirect(base_url('s_logbook/logbook/'));
					}
				}
			}
	  }
      if($mode=='isi'){
				$data['page'] =  $data['page']."_isi";
				$data['kr_kewenangan']=$this->m_sample->kewenangan_all();
				$data['terpilih'] = set_value('terpilih',explode("-", $data['id_jabatan']));
				$data['tgl_logbook'] = set_value('tgl_logbook',date('d-m-Y'));
				$this->form_validation->set_rules('tgl_logbook','tgl_logbook','required');
				if ($this->form_validation->run() === FALSE)
				{
					  $this->tampil_top($data);
				}
				else
				{
					$action = $this->input->post('action');
					if($action == 'BtnProses') {
					//	$this->session->set_flashdata('danger', 'Sample Tidak Simpan Data');
						redirect(base_url('s_logbook/logbook'));
					}
				}
      }
		if($mode=='pdf_eukom'){
	      $report = $this->load->view('cetak/ol_logbook_eukom', $data, TRUE);
		//  $namaku = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$this->session->id_pegawai);
		  $filename = 'bcp-'.'TENAGA MEDIS'."-print-date-".date('d-m-Y')."-bcp-ukom.pdf";
	//    $mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'L','margin_left' => '5','margin_right' => '5','margin_top' => '5','margin_bottom' => '5']);
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
		if($mode=='pdf_logbook'){
		  $report = $this->load->view('cetak/ol_logbook_bulanan', $data, TRUE);
		//  $namaku = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$this->session->id_pegawai);
		  $filename = 'bcp-'.'TENAGA MEDIS'."-print-date-".date('d-m-Y')."-bcp-logbook.pdf";
	//	  $mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'P','margin_left' => '5','margin_right' => '5','margin_top' => '5','margin_bottom' => '5']);
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
		if($mode=='pdf_tahunan'){
		  $report = $this->load->view('cetak/logbook_tahunan', $data, TRUE);
		  $namaku = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$this->session->id_pegawai);
		  $filename = 'bcp-tahunan-'.$namaku['nama_pegawai']."-print-date-".date('d-m-Y')."-bcp-ukom.pdf";
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
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
	$this->load->view("s_logbook/header",$data);
	$this->load->view("s_logbook/isi");
	$this->load->view("footer");
	$this->load->view("s_logbook/jsload");
	$this->load->view("s_logbook/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_landing",$data);
	$this->load->view("s_logbook/isi");
	$this->load->view("footer");
	$this->load->view("s_logbook/jsload");
	$this->load->view("s_logbook/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
