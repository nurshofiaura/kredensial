<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Mahasiswa extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
          $this->load->model('m_ol_rancak');
          $this->load->model('m_member');
          $this->load->model('m_auth');
          $this->m_auth->mantankah();
  }
  // ========================================================================
	function index(){
		$this->mhs_logbook();
	}
  function data_bahan()
  {
		$dt=$this->m_ol_rancak->ambil_bahan();
		$data = array();
		foreach($dt as $row){
			$data[] = array("id"=>$row['id_bahan'], "text"=>$row['nama_bahan']);
		}
		echo json_encode($data);
  }
  function data_reject()
  {
		$dt=$this->m_ol_rancak->ambil_reject();
		$data = array();
		foreach($dt as $row){
			$data[] = array("id"=>$row['id_reject'], "text"=>$row['nama_reject']);
		}
		echo json_encode($data);
  }
  function mhs_logbook($mode='view')
  {
		$data['page']  = "mhs_logbook";
		$data['header'] = "LOGBOOK";
		$data['title'] = "LOGBOOK";
		$data['link_kembali'] = base_url('member');
		$data['link_awal'] = base_url('mahasiswa/mhs_logbook');
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
/*		$data['multi_level'] = $this->m_ol_rancak->ambil_data_link_pengurus($this->session->id_pegawai);
		$data['ol_akses'] = $this->m_ol_rancak->ol_akses($this->session->id_pegawai);*/
		$data['ambil_data_a_online'] = $this->m_ol_rancak->ambil_data_a_online();
		$data['ambil_data_instansi'] = $this->m_member->ambil_data_instansi();
		$data['ambil_data_instansi_null'] = $this->m_member->ambil_data_instansi_null();
		$data['cmd_penguji'] = $this->m_member->ambil_data_penguji();
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
		$data['bcp_id_pegawai'] = $this->session->id_pegawai;
		if($this->session->has_userdata('id_level')){
			redirect(base_url('member'));
		}
		if($this->session->id_jabatan == 4){
			$data['nama_pk'] = "BK";
		}else{
			$data['nama_pk'] = "PK";
		}
		$data['first_date'] = $this->uri->segment(4, 0);
		$data['last_date'] = $this->uri->segment(5, 0);
		$data['id_ruangan'] = $this->uri->segment(6, 0);
		$data['pxe'] = $this->uri->segment(7, 0);
		if(empty($data['first_date'])){
			if($this->session->has_userdata('first_date_mhs')){
				$data['first_date'] = $this->session->first_date_mhs;
			}else{
				$data['first_date'] = '01-'.date('m-Y');
			}
		}
		if(empty($data['last_date'])){
			if($this->session->has_userdata('last_date_mhs')){
				$data['last_date'] = $this->session->last_date_mhs;
			}else{
				$data['last_date'] = date('d-m-Y');
			}
		}
		$data['ambil_data_kompetensi_null'] = $this->m_member->ambil_data_kompetensi_null($data['first_date'],$data['last_date'],$data['id_ruangan']);
    if($mode=='view'){
		$this->tampil_top($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$first_date = $this->input->post("first_date");
			$last_date = $this->input->post("last_date");
			$id_instansi = $this->input->post("id_instansi");
			$pxe = $this->input->post("id_kompetensi");
			$data_user_level = array(
				'first_date_mhs'     => $first_date,
				'last_date_mhs'     => $last_date
			);	
			$this->session->set_userdata($data_user_level);						
//			$this->session->set_tempdata('otp', $your_value, 1000);
			redirect(base_url('mahasiswa/mhs_logbook/view/'.$first_date.'/'.$last_date.'/'.$id_instansi.'/'.$pxe));
		}
	}
    else if($mode=='data'){
		echo json_encode($this->m_member->mhs_logbook_all($data['first_date'],$data['last_date'],$data['id_ruangan'],$data['pxe']));
	}
  else if($mode=='hapus'){
  	$cek = $this->m_umum->ambil_data('mhs_logbook','id_logbook',$data['first_date']);
  	if($cek['id_pengajuan'] > 0){
  		$this->session->set_flashdata('danger', 'Data SUdah Masuk Pengajuan Kompetensi');
  	}else{
  		$this->m_umum->hapus_data('mhs_logbook','id_logbook',$data['first_date']);
  		$this->m_umum->hapus_data('mhs_logbook_pasien','id_logbook',$data['first_date']);
  		$this->session->set_flashdata('sukses', 'Data Berhasil Di Hapus');
  	}
  	redirect(base_url('mahasiswa'));
  }
/*  else if($mode=='hapus'){
      $kondisi_mine=array('id_logbook'=>$data['id']);
  		$jml_mine=$this->m_umum->jumlah_record_filter('kr_pengajuan_logbook',$kondisi_mine);
  		if($jml_mine == 0){
        $idnya    = $this->m_umum->ambil_data('logbook','id_logbook',$data['id']);
    	  if($idnya['v_karu'] == 0 AND $idnya['v_kabid'] == 0 AND $idnya['v_asesor'] == 0 AND $idnya['v_komite'] == 0 AND $idnya['v_direktur'] == 0){
    		  if($this->m_umum->hapus_data('logbook','id_logbook',$data['id']) ){
            $this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
      			redirect(base_url('ol_logbook/logbook/view/'.$data['first_date'].'/'.$data['last_date']));
    		  }else{
      			$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
      			redirect(base_url('ol_logbook/logbook/view/'.$data['first_date'].'/'.$data['last_date']));
    		  }
      }
      else{
        $this->session->set_flashdata('danger', 'Data Sudah Di Validasi');
        redirect(base_url('ol_logbook/logbook/view/'.$data['first_date'].'/'.$data['last_date']));
      }
     }
      else{
        $this->session->set_flashdata('danger', 'Data Sudah Ada Di Pengajuan');
  			redirect(base_url('ol_logbook/logbook/view/'.$data['first_date'].'/'.$data['last_date']));
      }
    }*/
  else{
		$data['kr_kewenangan_detil']=$this->m_ol_rancak->opsi_logbook_new();
		$data['sifat']=$this->m_ol_rancak->cmd_sifat_kewenangan();
    if($mode=='tambah'){
      $data['page'] =  $data['page']."_tambah";
			$this->form_validation->set_rules('id_jabatan','id_jabatan','required');
	    if ($this->form_validation->run() === FALSE){
				$this->tampil_top($data);
	    }else{
				$first_date = $this->input->post("first_date");
				$last_date = $this->input->post("last_date");
				$action = $this->input->post('action');
				if($action == 'BtnProses') {
					$id = $this->input->post("id_kab");
					redirect(base_url('mahasiswa/mhs_logbook/tambah'));
				}
				if($action == 'BtnSimpan') {
					if($this->input->post('chk')){
						$checkboxes = $this->input->post('chk');
						$chk = implode("-",$checkboxes);
						redirect(base_url('mahasiswa/mhs_logbook/isi/'.$chk));
					}else{
						redirect(base_url('mahasiswa/mhs_logbook/view/01-'.date('m-Y').'/'.date('d-m-Y')));
					}
				}		
			}
	  }
	    if($mode=='edit'){
	      $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('mhs_logbook','barcode_logbook',$data['first_date']);
				$data['rm']  = set_value('rm',$keuangan["rm"]);
				$data['jml_logbook']  = set_value('jml_logbook',$keuangan["jml_logbook"]);
				$data['barcode_logbook']  = set_value('barcode_logbook',$keuangan["barcode_logbook"]);
				$data['id_pengajuan']  = set_value('id_pengajuan',$keuangan["id_pengajuan"]);
				$data['id_logbook']  = set_value('id_logbook',$keuangan["id_logbook"]);
				$data['id_instansi']  = set_value('id_instansi',$keuangan["id_instansi"]);
				$data['id_sifat_kewenangan']  = set_value('id_sifat_kewenangan',$keuangan["id_sifat_kewenangan"]);
				$data['id_penguji']  = set_value('id_penguji',$keuangan["barcode_pegawai"]);
				$data['tgl_logbook']  = set_value('tgl_logbook', date('d-m-Y',strtotime($keuangan["tgl_logbook"])));
				$this->load->view("member/isi",$data);
	    }
	    if($mode=='simpan_edit'){
	    	$id_pengajuan = $this->input->post('id_pengajuan');
				if($id_pengajuan == 0){
					  if($this->m_member->edit_mhs_logbook()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('mahasiswa/mhs_logbook'));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('mahasiswa/mhs_logbook'));
					  }
					}else{
							$this->session->set_flashdata('danger', 'Data SUdah Masuk Pengajuan Kompetensi');
							redirect(base_url('mahasiswa/mhs_logbook'));
					  }
	    }
      if($mode=='isi'){
				$data['page'] =  $data['page']."_isi";
				$data['kr_kewenangan']=$this->m_ol_rancak->kewenangan_all();
				$du = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
				$data['count']  = set_value('count',$du['count']);
				$data['terpilih'] = set_value('terpilih',explode("-", $data['first_date']));
				$data['tgl_logbook'] = set_value('tgl_logbook',date('d-m-Y'));
				$data['id_instansi']  = set_value('id_instansi',$this->input->post("id_instansi"));
				$data['id_penguji']  = set_value('id_penguji',$this->input->post("id_penguji"));
				$data['id_sifat_kewenangan']  = set_value('id_sifat_kewenangan',$this->input->post("id_sifat_kewenangan"));
				$this->form_validation->set_rules('id_instansi','id_instansi','required');
				if ($this->form_validation->run() === FALSE)
				{
					  $this->tampil_top($data);
				}
				else
				{
					$counter = $this->input->post('counter');
					if($counter=='0') {
						$this->m_member->simpan_mhs_logbook0();
					}else{
						$this->m_member->simpan_mhs_logbook();
					}
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Tambah');
					redirect(base_url('mahasiswa/mhs_logbook'));
				}
      }
/*    if($mode=='pasien'){
    	$data['page'] =  $data['page']."_pasien";
      if(empty($data['first_date']) OR $data['first_date'] == 0){
        $this->session->set_flashdata('danger', 'ID Kosong');
        redirect(base_url('mahasiswa/mhs_logbook'));
    	}
	 		$kondisi_idlog=array('id_logbook'=>$data['first_date']);
			$jml_idlog = $this->m_umum->jumlah_record_filter('mhs_logbook',$kondisi_idlog);
			if($jml_idlog == 0){
        $this->session->set_flashdata('danger', 'ID Tidak Terdaftar');
        redirect(base_url('mahasiswa/mhs_logbook'));				
			}
      $aktivitas    = $this->m_umum->ambil_data('mhs_logbook','id_logbook',$data['first_date']);
      $data['cmd_jk']    = $this->m_rancak->cmd_jk();
      $data['cmd_bahan']    = $this->m_ol_rancak->cmd_bahan();
      $data['cmd_reject']    = $this->m_ol_rancak->cmd_reject();
      $data['cmd_satuan_umur']    = array('2'=>'Tahun','1'=>'Bulan','0'=>'Hari');
      $data['data_pasien']    = $this->m_umum->ambil_data_result('mhs_logbook_pasien','id_logbook',$data['first_date']);
      $data['id_logbook']  = set_value('id_logbook',$aktivitas["id_logbook"]);
      $this->form_validation->set_rules('id_logbook','id_logbook','required');
      if ($this->form_validation->run() === FALSE){
        $this->tampil_top($data);
      }else{
		  	$this->m_member->simpan_mhs_pasien();
				$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
				redirect(base_url('mahasiswa/mhs_logbook'));
      }
    }*/
		if($mode=='pdf_pasien'){
	    $report = $this->load->view('cetak/mhs_logbook_pasien', $data, TRUE);
		  $namaku = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$this->session->id_pegawai);
		  $filename = date('dmYHis').'-bcp-'.$namaku['nama_pegawai']."-bcp-pasien.pdf";
	//    $mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'P','margin_left' => '5','margin_right' => '5','margin_top' => '5','margin_bottom' => '5']);
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
		if($mode=='pdf_analisis'){
	    $report = $this->load->view('cetak/mhs_logbook_anaisis', $data, TRUE);
		  $namaku = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$this->session->id_pegawai);
		  $filename = date('dmYHis').'-bcp-'.$namaku['nama_pegawai']."-bcp-analisis.pdf";
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
		if($mode=='pdf_eukom'){
	    $report = $this->load->view('cetak/ol_logbook_eukom', $data, TRUE);
		  $namaku = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$this->session->id_pegawai);
		  $filename = date('dmYHis').'-bcp-'.$namaku['nama_pegawai']."-bcp-kewenangan.pdf";
	//    $mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'L','margin_left' => '5','margin_right' => '5','margin_top' => '5','margin_bottom' => '5']);
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->AddPage('L', '', '', '', 2, 5, 5, 5, 10, 3, 3);
		  $mpdf->SetDisplayMode('fullpage');
//		  $mpdf->SetFooter('Page : {PAGENO}');
		  $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
			for ($i = 1; $i > 2; $i++) {
		  $mpdf->SetHTMLFooter('');
			}		  
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
		if($mode=='pdf_reject'){
	    $report = $this->load->view('cetak/ol_logbook_reject', $data, TRUE);
		  $namaku = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$this->session->id_pegawai);
		  $filename = date('dmYHis').'-bcp-'.$namaku['nama_pegawai']."-bcp-reject.pdf";
	//    $mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'L','margin_left' => '5','margin_right' => '5','margin_top' => '5','margin_bottom' => '5']);
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->AddPage('L', '', '', '', 2, 5, 5, 5, 10, 3, 3);
		  $mpdf->SetDisplayMode('fullpage');
//		  $mpdf->SetFooter('Page : {PAGENO}');
		  $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
			for ($i = 1; $i > 2; $i++) {
		  $mpdf->SetHTMLFooter('');
			}		  
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
		if($mode=='pdf_logbook'){
		  $report = $this->load->view('cetak/ol_logbook_bulanan', $data, TRUE);
		  $namaku = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$this->session->id_pegawai);
		  $filename = date('dmYHis').'bcp-'.$namaku['nama_pegawai']."-bcp-kompetensi.pdf";
	//	  $mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'P','margin_left' => '5','margin_right' => '5','margin_top' => '5','margin_bottom' => '5']);
		  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->AddPage('L', '', '', '', 2, 5, 5, 5, 10, 3, 3);
		  $mpdf->SetDisplayMode('fullpage');
	//	  $mpdf->SetFooter('Page : {PAGENO}');
		  $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
			for ($i = 1; $i > 2; $i++) {
		  $mpdf->SetHTMLFooter('');
			}		  
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
  function rm_cari_data(){
    $id=$this->input->get('query');
    $hasil=array();
    $data=$this->m_member->cmd_rm($id);
    $hasil['suggestions']=$data;
    echo json_encode($hasil);
  }
  function pasien_cari_data(){
    $id=$this->input->get('query');
    $hasil=array();
    $data=$this->m_member->cmd_pasien($id);
    $hasil['suggestions']=$data;
    echo json_encode($hasil);
  }
	function mhs_pasien($mode='view'){
		$data['page']="mhs_pasien"; 
		$data['header'] = "DATA PASIEN";
		$data['title'] = "DATA PASIEN";
		$data['link_kembali'] = base_url('member');
		$data['link_awal'] = base_url('mahasiswa/mhs_logbook');
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
/*		$data['multi_level'] = $this->m_ol_rancak->ambil_data_link_pengurus($this->session->id_pegawai);
		$data['ol_akses'] = $this->m_ol_rancak->ol_akses($this->session->id_pegawai);*/
		$data['ambil_data_a_online'] = $this->m_ol_rancak->ambil_data_a_online();
		$data['ambil_data_instansi'] = $this->m_member->ambil_data_instansi();
		$data['ambil_data_instansi_null'] = $this->m_member->ambil_data_instansi_null();
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
		$data['idp'] = $this->uri->segment(5, 0);
		$data['jml'] = $this->uri->segment(6, 0);
		$koendisi3 = array('id_logbook'=>$data['id']);
		$nm_kwn = $this->m_umum->ambil_data_kondisi_2tabel_row('mhs_logbook',$koendisi3,'nkr_kewenangan','id_kewenangan');
		$data['nm_kewenangan'] = $nm_kwn["nama_kewenangan"];
		if($mode=='view'){
			$this->tampil_top($data);
		}
		else if($mode=='data'){
			echo json_encode($this->m_member->mhs_logbook_pasien($data['id']));
		}
  else if($mode=='hapus_pasien'){
/*  	//	$lp = $this->m_umum->ambil_data('mhs_logbook_pasien','id_logbook_pasien',$data['idp']);
  		$this->m_umum->hapus_data('mhs_logbook_pasien','id_logbook_pasien',$data['idp']);
		$kondisi=array('id_logbook'=>$data['id']);
		$jml = $this->m_umum->jumlah_record_filter('mhs_logbook_pasien',$kondisi);*/
  		$this->m_member->hapus_dan_hitung($data['id'],$data['idp']);
    	redirect(base_url('mahasiswa/mhs_pasien/view/'.$data['id']));
  }
		else{
      $data['cmd_jk']    = $this->m_rancak->cmd_jk();
      $data['cmd_bahan']    = $this->m_ol_rancak->cmd_bahan();
      $data['cmd_reject']    = $this->m_ol_rancak->cmd_bahan();
      if($mode=='pasien'){
        $data['page'] =  $data['page']."_pasien";
        $lp = $this->m_umum->ambil_crew_logbook_laporan_tabel($data['id']);
				$data['link_awal'] = base_url('member/tabel/view/'.$lp['id_laporan']);
			  $kondisi_cek = array('id_laporan_tabel'=>$data['id'],'barcode_pegawai'=>$this->session->barcode_pegawai);
				$data['cek'] = $this->m_umum->jumlah_record_tabel_pengajuan('ol_logbook_laporan_tabel',$kondisi_cek,'ol_logbook_laporan','id_laporan');	
				$select_pasien = array("*");
				$data['ambil_pasien_range'] = $this->m_ol_rancak->ambil_pasien_range($data['idl'],$select_pasien,'jml_logbook');
				$data['lhu']  = set_value('lhu',$lp["lhu"]);
				$this->tampil($data);
      }
			if($mode=='tambah'){
			  $data['page'] =  $data['page']."_tambah";
			  $lpd = $this->m_umum->ambil_data('mhs_logbook','id_logbook',$data['id']);
			  $data['id_logbook']  = set_value('id_logbook',$lpd["id_logbook"]);
			  $data['id_pegawai']  = set_value('id_pegawai',$lpd["id_logbooker"]);
			  $data['jml_logbook']  = set_value('jml_logbook',$lpd["jml_logbook"]);
	//		  $data['ambil_pasien'] = $this->m_ol_rancak->ambil_pasien_range($data['idl'],$select_pasien,'jml_logbook');
    		$data['tgl_lahir']  = set_value('tgl_lahir',date('d-m-Y'));
    		$data['nama_pasien']  = set_value('nama_pasien',$this->input->post("nama_pasien"));    		
    		$data['rm']  = set_value('rm',$this->input->post("rm"));    		
    		$data['jk']  = set_value('jk',$this->input->post("jk"));    		
    		$data['alamat']  = set_value('alamat',$this->input->post("alamat"));    		
    		$data['jml_bahan']  = set_value('jml_bahan','0');    		
    		$data['jml_reject']  = set_value('jml_reject','0');    		
    		$data['id_reject']  = set_value('id_reject',$this->input->post("id_reject"));    		
    		$data['id_bahan']  = set_value('id_bahan',$this->input->post("id_bahan"));    		   		    		
				$this->load->view("member/isi",$data);
			}
			if($mode=='simpan_tambah'){
				$id_logbook = $this->input->post("id_logbook");
				$id_pegawai = $this->input->post("id_pegawai");
				$kondisi=array('id_logbook'=>$id_logbook,'id_logbooker'=>$id_pegawai);
				$jml = $this->m_umum->jumlah_record_filter('mhs_logbook',$kondisi);
				if($jml == 0){
					$this->session->set_flashdata('danger', 'Data Tidak Valid');
					redirect(base_url('mahasiswa/mhs_pasien/view/'.$id_logbook));
				}else{
				 		$this->m_member->simpan_mhs_lpasien();
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('mahasiswa/mhs_pasien/view/'.$id_logbook));
				}
			}
			if($mode=='edit'){
			  $data['page'] =  $data['page']."_edit";
				$keuangan = $this->m_member->ambil_logbook_pasien($data['id']);		
				$data['id_logbook_pasien']  = set_value('id_logbook_pasien',$keuangan["id_logbook_pasien"]);
				$data['id_logbook']  = set_value('id_logbook',$keuangan["id_logbook"]);
				$data['id_pasien']  = set_value('id_pasien',$keuangan["id_pasien"]);
				$data['jml_logbook']  = set_value('jml_logbook',$keuangan["jml_logbook"]);
				$data['rm']  = set_value('rm',$keuangan["rm"]);
				$data['nama_pasien']  = set_value('nama_pasien',$keuangan["nama_pasien"]);
				$data['tgl_lahir']  = set_value('tgl_lahir',date('d-m-Y', strtotime($keuangan["tgl_lahir"])));
				$data['jk']  = set_value('jk',$keuangan["jk"]);
				$data['alamat']  = set_value('alamat',$keuangan["alamat"]);
				$data['jml_bahan']  = set_value('jml_bahan',$keuangan["jml_bahan"]);
				$data['id_bahan']  = set_value('id_bahan',$keuangan["id_bahan"]);
				$data['jml_reject']  = set_value('jml_reject',$keuangan["jml_reject"]);
				$data['id_reject']  = set_value('id_reject',$keuangan["id_reject"]);
				$this->load->view("member/isi",$data);
			}
			if($mode=='simpan_edit'){
				$id_logbook = $this->input->post("id_logbook");
		 		$this->m_member->rubah_mhss_lpasien();
				$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
				redirect(base_url('mahasiswa/mhs_pasien/view/'.$id_logbook));
			}
		}
	}
  function unit_data_perinstansi($id)
  {
    $dt=$this->m_ol_rancak->ambil_data_dropdown_unit($id);
    echo json_encode($dt);
  }
  function unit_data_opi_pegawai($id)
  {
    $dt=$this->m_ol_rancak->ambil_data_dropdown_pegawai_untuk_pemulihan($id);
    echo json_encode($dt);
  }
  function list_kegiatan($mode='view')
  {
	$data['page']  = "list_kegiatan";
	$data['header'] = "DAFTAR PILIHAN KEWENANGAN PEGAWAI TERTOLAK";
	$data['title'] = "DAFTAR PILIHAN KEWENANGAN PEGAWAI TERTOLAK";
/*		$data['multi_level'] = $this->m_ol_rancak->ambil_data_link_pengurus($this->session->id_pegawai);
		$data['multi_struktur'] = $this->m_ol_rancak->ambil_data_link_struktur($this->session->id_pegawai);
		$data['ol_akses'] = $this->m_ol_rancak->ol_akses($this->session->id_pegawai);*/
		$data['ambil_data_a_online'] = $this->m_ol_rancak->ambil_data_a_online();
	$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
//	$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
	$jabatanekuh = $this->m_umum->ambil_data('jabatan','id_jabatan',$this->session->id_jabatan);
//	$propinsie = $this->m_umum->ambil_data('ol_pengcab','id_pengcab',$pegawai['id_pengcab']);
//	$data['prov_id'] = $propinsie["id_prov"];
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
  if($mode=='view'){
		$this->tampil($data);
	}
  else if($mode=='data'){
		echo json_encode($this->m_member->logbook_pemulihan_validasi());
	}
  else if($mode=='data2'){
		echo json_encode($this->m_member->logbook_kegiatan_pemulihan($data['id']));
	}
	else{
    if($mode=='isi'){
      $data['page'] =  $data['page']."_isi";
      $aktivitas = $this->m_umum->ambil_data('ol_logbook_pemulihan','barcode_logbook_pemulihan',$data['id']);
      $data['ambil_lobook_pemulihan_detile']=$this->m_ol_rancak->ambil_lobook_pemulihan_detile($aktivitas['id_logbook_pemulihan']);
      $data['ambil_lobook_pemulihan_detil']=$this->m_ol_rancak->ambil_lobook_pemulihan_detil($aktivitas['id_logbook_pemulihan']);
      $data['ambil_data_rujukan_working'] = $this->m_ol_rancak->ambil_data_rujukan_working(); 
      $data['ambil_data_etik_instansi_no_null_all'] = $this->m_ol_rancak->ambil_data_etik_instansi_no_null_all(); 
	      $ole = $this->m_ol_rancak->ambil_data_instansi_untuk_session($aktivitas['id_pegawai']);
	      $data['cmd_id_unit_pegawai'] = $this->m_ol_rancak->ambil_data_dropdown_unit_no_null($aktivitas['id_instansi_pegawai']); 
	      $data['cmd_data_ruangan'] = $this->m_ol_rancak->ambil_data_dropdown_unit_no_null($aktivitas['id_instansi_pemulihan']); 
				$arr = array();
				foreach($ole as $val){
						$arr[] = $val['id_instansi'];
				}
				$eimplo = implode(",", $arr);
				$data['ambil_id_instansi_pegawai'] = $this->m_ol_rancak->ambil_data_rujukan_working_kab_null($eimplo); 
      $data['tgl_awal']  = date('d-m-Y', strtotime($aktivitas["tgl_awal"]));
      $data['tgl_akhir']  = date('d-m-Y', strtotime($aktivitas["tgl_akhir"]));
      $data['id_logbook_pemulihan']  = set_value('id_logbook_pemulihan',$aktivitas["id_logbook_pemulihan"]);
      $data['id_instansi_pegawai']  = set_value('id_instansi_pegawai',$aktivitas["id_instansi_pegawai"]);
      $data['id_unit_pegawai']  = set_value('id_unit_pegawai',$aktivitas["id_unit_pegawai"]);
      $data['id_pemulihan']  = set_value('id_pemulihan',$aktivitas["id_pemulihan"]);
      $data['id_instansi']  = set_value('id_instansi',$aktivitas["id_instansi_pemulihan"]);
      $data['id_unit_pemulihan']  = set_value('id_unit_pemulihan',$aktivitas["id_unit_pemulihan"]);
      $data['result_pemulihan']  = set_value('result_pemulihan',$aktivitas["result_pemulihan"]);
      $this->form_validation->set_rules('id_logbook_pemulihan','id_logbook_pemulihan','required');
      if ($this->form_validation->run() === FALSE){
        $this->tampil($data);
      }else{
        $result_pemulihan = $this->input->post('result_pemulihan');
        if($result_pemulihan == 0){
          $this->m_ol_pemulihan->edit_pemulihan();
          $this->session->set_flashdata('sukses', 'Data Sudah Di Rubah');
        }else{
          $this->session->set_flashdata('danger', 'Data Sudah Dilakukan Validasi');
        }
        redirect(base_url('ol_pemulihan/kegiatan'));
      }
    }
    if($mode=='tambah'){
      $data['page'] =  $data['page']."_tambah";
      $aktivitas = $this->m_umum->ambil_data('ol_logbook_pemulihan','barcode_logbook_pemulihan',$data['id']);
      $data['ambil_lobook_perorang']=$this->m_ol_rancak->ambil_lobook_perorang($aktivitas['id_pegawai']);
      $data['id_logbook_pemulihan']  = set_value('id_logbook_pemulihan',$aktivitas['id_logbook_pemulihan']);
      $data['result_pemulihan']  = set_value('result_pemulihan',$aktivitas['result_pemulihan']);
      $this->form_validation->set_rules('id_logbook_pemulihan','id_logbook_pemulihan','required');
      if ($this->form_validation->run() === FALSE){
        $this->tampil($data);
      }else{
        $barcode_logbook_pemulihan = $this->input->post('barcode_logbook_pemulihan');
        $result_pemulihan = $this->input->post('result_pemulihan');
        if($result_pemulihan == 0){
          $this->m_ol_pemulihan->simpan_logbook_pemulihan_detil();
    			$this->session->set_flashdata('sukses', 'Data Sudah Di Tambah & Data Dobel Tidak Di Tambah');
          redirect(base_url('ol_pemulihan/kegiatan/edit/'.$barcode_logbook_pemulihan));
        }else{
          $this->session->set_flashdata('danger', 'Data Sudah Dilakukan Validasi');
          redirect(base_url('ol_pemulihan/kegiatan/edit/'.$barcode_logbook_pemulihan));
        }
      }
    }
    if($mode=='hasil'){
      if(empty($data['id'])){
        $this->session->set_flashdata('danger', 'Tidak Ada ID');
        redirect(base_url('ol_pemulihan/kegiatan'));
    	}
      $data['page'] =  $data['page']."_hasil";
      $aktivitas    = $this->m_umum->ambil_data('ol_logbook_pemulihan','barcode_logbook_pemulihan',$data['id']);
			$kondisi_hasil_kegiatan=array('id_logbook_pemulihan'=>$aktivitas['id_logbook_pemulihan']);
			$data['jml_hasil_kegiatan']=$this->m_umum->jumlah_record_filter('ol_logbook_kegiatan_pemulihan',$kondisi_hasil_kegiatan);
      $data['cmd_kompeten']=$this->m_rancak->cmd_kompeten();
      $data['ambil_lobook_pemulihan_detil']=$this->m_ol_rancak->ambil_kewenangan_lobook_pemulihan_detil($data['id']);
      $data['id_logbook_pemulihan']  = set_value('id_logbook_pemulihan',$aktivitas['id_logbook_pemulihan']);
      $data['result_pemulihan']  = set_value('result_pemulihan',$aktivitas['result_pemulihan']);
      $data['catatan_pemulihan']  = set_value('catatan_pemulihan',$aktivitas['catatan_pemulihan']);
      $this->form_validation->set_rules('id_logbook_pemulihan','id_logbook_pemulihan','required');
      if ($this->form_validation->run() === FALSE){
        $this->tampil($data);
      }else{
      	$jml_hasil_kegiatan = $this->input->post('jml_hasil_kegiatan');
      	if($jml_hasil_kegiatan > 0){
	        if($this->m_pemulihan->edit_logbook_pemulihan()){
	          $this->session->set_flashdata('sukses', 'Hasil Sudah Terupdate');
	          redirect(base_url('pemulihan/kegiatan'));
	        }else{
	          $this->session->set_flashdata('danger', 'Masalah Penambahan Data');
	          redirect(base_url('pemulihan/kegiatan'));
	        }
	      }else{
          $this->session->set_flashdata('danger', 'Belum Ada Data Kegiatan Pemulihan');
          redirect(base_url('pemulihan/kegiatan'));	      	
	      }
      }
    }
	 }
  }
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("member/header",$data);
	$this->load->view("member/isi");
	$this->load->view("footer");
	$this->load->view("member/jsload");
	$this->load->view("member/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_topol",$data);
	$this->load->view("member/isi");
	$this->load->view("footer");
	$this->load->view("member/jsload");
	$this->load->view("member/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
