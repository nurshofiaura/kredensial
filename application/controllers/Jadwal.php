<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Jadwal extends CI_controller
{
  public function __construct(){
      parent::__construct();
      $this->load->model('m_ol_rancak');
      $this->load->model('m_jadwal');
      $this->load->model('m_auth');
      $this->m_auth->hak_member();
  }
	function index(){
		$this->jadwal_dinas();
	}
  function elemen($mode='view')
  {
	$data['page']  = "elemen";
	$data['header'] = "ELEMEN DINAS JAGA";
	$data['title'] = "ELEMEN DINAS JAGA";
	$data['link_kembali'] = base_url('jadwal/elemen');
	$data['link_awal'] = base_url('jadwal/elemen');
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
	$data['id'] = $this->uri->segment(4, 0);
    if($mode=='view'){
		$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_jadwal->elemen_dinas_all());
	}
  else{
 		$data['cmd_kol_warna']=$this->m_rancak->cmd_kol_warna();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		$data['nama_dinas_jaga']  = set_value('nama_dinas_jaga',$this->input->post("nama_dinas_jaga"));
		$data['jml_dinas_jaga']  = set_value('nama_dinas_jaga','0');
		$data['id_unit']  = set_value('id_unit',$this->session->unit);
		$data['id_warna']  = set_value('id_warna',$this->input->post("id_warna"));
		$data['id_text']  = set_value('id_text',$this->input->post("id_text"));
		$this->load->view("jadwal/isi",$data);
      }
      if($mode=='simpan_tambah'){
		  if($this->m_jadwal->tambah_elemen()){
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
			redirect(base_url('jadwal/elemen'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
			redirect(base_url('jadwal/elemen'));
		  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
		$keuangan    = $this->m_umum->ambil_data('kol_dinas_jaga','id_dinas_jaga',$data['id']);
		$data['nama_dinas_jaga']  = set_value('nama_dinas_jaga',$keuangan["nama_dinas_jaga"]);
		$data['jml_dinas_jaga']  = set_value('jml_dinas_jaga',$keuangan["jml_dinas_jaga"]);
		$data['id_unit']  = set_value('id_unit',$keuangan["id_unit"]);
		$data['id_warna']  = set_value('id_warna',$keuangan["id_warna"]);
		$data['id_text']  = set_value('id_text',$keuangan["id_text"]);
		$this->load->view("jadwal/isi",$data);
      }
      if($mode=='simpan_edit'){
		  if($this->m_jadwal->edit_elemen()){
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
			redirect(base_url('jadwal/elemen'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
			redirect(base_url('jadwal/elemen'));
		  }
      }
	}
  }
  function pelengkap($mode='view')
  {
	$data['page']  = "pelengkap";
	$data['header'] = "PELENGKAP PRINT DINAS JAGA";
	$data['title'] = "PELENGKAP PRINT ELEMEN DINAS JAGA";
	$data['link_kembali'] = base_url('jadwal/elemen');
	$data['link_awal'] = base_url('jadwal/elemen');
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
	$data['id'] = $this->uri->segment(4, 0);
    if($mode=='view'){
		$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_jadwal->pelengkap_dinas_all($this->session->unit));
	}
  else{
      if($mode=='urutan'){
        $data['page'] =  $data['page']."_urutan";
				$kondisi=array('id_pegawai'=>$data['id']);
				$jml = $this->m_umum->jumlah_record_filter('pegawai_urutan',$kondisi);
				if($jml == 0){
					$data['no_urutan']  = set_value('no_urutan',$this->input->post("no_urutan"));
				}else{
					$no_urutan  = $this->m_umum->ambil_data('pegawai_urutan','id_pegawai',$data['id']);
					$data['no_urutan']  = set_value('no_urutan',$no_urutan['no_urutan']);
				}
				$this->load->view("jadwal/isi",$data);
      }
      if($mode=='simpan_urutan'){
		$id_pegawai = $this->input->post('id_pegawai');
		$kondisi=array('id_pegawai'=>$id_pegawai);
		$jml = $this->m_umum->jumlah_record_filter('pegawai_urutan',$kondisi);
		if($jml == 0){
			$this->m_jadwal->simpan_urutan();
		}else{
			$this->m_jadwal->edit_urutan();
		}
		redirect(base_url('jadwal/pelengkap'));
      }
      if($mode=='signature'){
        $data['page'] =  $data['page']."_signature";
		$kondisi=array('id_unit'=>$this->session->unit);
		$jml = $this->m_umum->jumlah_record_filter('jadwal_pelengkap',$kondisi);
		if($jml == 0){
			$data['text_kiri_top']  = set_value('text_kiri_top',$this->input->post("text_kiri_top"));
			$data['text_tengah_top']  = set_value('text_tengah_top',$this->input->post("text_tengah_top"));
			$data['text_kanan_top']  = set_value('text_kanan_top',$this->input->post("text_kanan_top"));
			$data['text_kiri_middle']  = set_value('text_kiri_middle',$this->input->post("text_kiri_middle"));
			$data['text_tengah_middle']  = set_value('text_tengah_middle',$this->input->post("text_tengah_middle"));
			$data['text_kanan_middle']  = set_value('text_kanan_middle',$this->input->post("text_kanan_middle"));
			$data['text_kiri_bottom']  = set_value('text_kiri_bottom',$this->input->post("text_kiri_bottom"));
			$data['text_tengah_bottom']  = set_value('text_tengah_bottom',$this->input->post("text_tengah_bottom"));
			$data['text_kanan_bottom']  = set_value('text_kanan_bottom',$this->input->post("text_kanan_bottom"));
			$data['text_kiri_nip']  = set_value('text_kiri_nip',$this->input->post("text_kiri_nip"));
			$data['text_tengah_nip']  = set_value('text_tengah_nip',$this->input->post("text_tengah_nip"));
			$data['text_kanan_nip']  = set_value('text_kanan_nip',$this->input->post("text_kanan_nip"));
		}else{
			$no_urutan  = $this->m_umum->ambil_data('jadwal_pelengkap','id_unit',$this->session->unit);
			$data['text_kiri_top']  = set_value('text_kiri_top',$no_urutan['text_kiri_top']);
			$data['text_tengah_top']  = set_value('text_tengah_top',$no_urutan['text_tengah_top']);
			$data['text_kanan_top']  = set_value('text_kanan_top',$no_urutan['text_kanan_top']);
			$data['text_kiri_middle']  = set_value('text_kiri_middle',$no_urutan['text_kiri_middle']);
			$data['text_tengah_middle']  = set_value('text_tengah_middle',$no_urutan['text_tengah_middle']);
			$data['text_kanan_middle']  = set_value('text_kanan_middle',$no_urutan['text_kanan_middle']);
			$data['text_kiri_bottom']  = set_value('text_kiri_bottom',$no_urutan['text_kiri_bottom']);
			$data['text_tengah_bottom']  = set_value('text_tengah_bottom',$no_urutan['text_tengah_bottom']);
			$data['text_kanan_bottom']  = set_value('text_kanan_bottom',$no_urutan['text_kanan_bottom']);
			$data['text_kiri_nip']  = set_value('text_kiri_nip',$no_urutan['text_kiri_nip']);
			$data['text_tengah_nip']  = set_value('text_tengah_nip',$no_urutan['text_tengah_nip']);
			$data['text_kanan_nip']  = set_value('text_kanan_nip',$no_urutan['text_kanan_nip']);
		}
		$this->load->view("jadwal/isi",$data);
      }
      if($mode=='simpan_signature'){
		$id_unit = $this->input->post('id_unit');
		$kondisi=array('id_unit'=>$id_unit);
		$jml = $this->m_umum->jumlah_record_filter('jadwal_pelengkap',$kondisi);
		if($jml == 0){
			$this->m_jadwal->simpan_signature();
		}else{
			$this->m_jadwal->edit_signature();
		}
		redirect(base_url('jadwal/pelengkap'));
      }
	}
  }
  function jadwal_dinas($mode='view')
  {
	$data['page']  = "jadwal_dinas";
	$data['judul'] = "JADWAL";
	$data['header'] = "SESUAIKAN JADWAL";
	$data['title'] = "SESUAIKAN JADWAL";
	$data['link_kembali'] = base_url('jadwal/elemen');
	$data['link_awal'] = base_url('jadwal');
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
		$data['ruangan'] = $this->session->unit;
	$data['bulan']   = $this->uri->segment(4, 0);
	if(empty($data['bulan'])){
		$data['bulan']   = date('m');
	}
	$data['tahun']   = $this->uri->segment(5, 0);
	if(empty($data['tahun'])){
		$data['tahun']   = date('Y');
	}
	$data['header'] = "INPUT JADWAL DINAS Bulan ".$this->m_rancak->getBulan($data['bulan'])." / Tahun ".$data['tahun'];
	$data['title'] = "INPUT JADWAL DINAS <b>Bulan ".$this->m_rancak->getBulan($data['bulan'])." / Tahun ".$data['tahun']."</b>";
	$data['cmd_year']  = array('1'=>'Januari','2'=>'Februari','3'=>'Maret','4'=>'April','5'=>'Mei','6'=>'Juni',
			'7'=>'Juli','8'=>'Agustus','9'=>'September','10'=>'Oktober','11'=>'Nopember','12'=>'Desember');
	$data['ambil_data_pegawai'] = $this->m_jadwal->ambil_data_pegawai($this->session->unit);
	$data['cmd_pegawai']   = $this->m_jadwal->cmd_pegawai($this->session->unit);
  if($mode=='view'){
		$namaBulan = $this->m_rancak->getBulan($data['bulan']);
		$data['title'] = "Jadwal Dinas Bulan ".$namaBulan." ".$data['tahun'];
		$data['json'] = $this->m_jadwal->lb($data);
		$kondisi=array('bulan'=>$data['bulan'],'tahun'=>$data['tahun'],'id_unit'=>$this->session->unit);
		$jml = $this->m_umum->jumlah_record_filter('hari_libur',$kondisi);
		if($jml == 0){
			$data['tgl_hari_libur']  = explode(',', '');
		}else{
			$offday = $this->m_umum->ambil_data_kondisi('hari_libur',$kondisi);
			$data['tgl_hari_libur']  = explode(',', $offday['tgl_hari_libur']);
		}
		$this->tampil_top($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$bulan = $this->input->post("bulan");
			$tahun = $this->input->post("tahun");
			redirect(base_url('jadwal/jadwal_dinas/view/'.$bulan.'/'.$tahun));
		}
	}
/*  else if($mode=='data'){
		echo json_encode($this->m_jadwal->pegawai_dinas($this->session->unit,$data['bulan'],$data['tahun']));
	}*/
  else if($mode=='pegawai'){
		echo json_encode($this->m_jadwal->all_pegawai_dinas());
	}
  else if($mode=='hapus'){
    if(empty($data['bulan'])){
      $this->session->set_flashdata('danger', 'ID Kosong');
      redirect(base_url('jadwal/jadwal_dinas'));
  	}
    if($this->m_umum->hapus_data('pegawai_jadwal','id_jadwal',$data['bulan'])){
      $this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
      redirect(base_url('jadwal/jadwal_dinas'));
    }else{
      $this->session->set_flashdata('danger', 'Masalah Hapus Data');
      redirect(base_url('jadwal/jadwal_dinas'));
    }
  }
	else if($mode=='pdf'){
	  $report = $this->load->view('cetak/jadwal_dinas', $data, TRUE);
	  $filename = $data['header'].".pdf";
	  $mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'L','margin_left' => '5','margin_right' => '5','margin_top' => '5','margin_bottom' => '5']);
	  $mpdf->SetTitle($data['header']);
	  $mpdf->SetAuthor($data['instance_name']);
	  //$mpdf->SetFooter('Page : {PAGENO}');
	  ini_set("pcre.backtrack_limit", "5000000");
	  $mpdf->WriteHTML($report);
	  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
	}
	else{
		$data['cmd_dinas_jaga']   = $this->m_jadwal->cmd_dinas_jaga($this->session->unit);
      if($mode=='tanggal'){
        $data['page'] =  $data['page']."_tanggal";
		if($data['id_pegawai']=='0'){
			$this->session->set_flashdata('danger', 'Jangan Lupa Pilih Pegawai ^_^');
			redirect(base_url('jadwal/jadwal_dinas/view/'.$data['bulan'].'/'.$data['tahun'].'/'.$data['id_pegawai']));
		}
		$awal	= $data['tahun'].'-'.$data['bulan'].'-01';
		$data['tglakhir'] = date('t', strtotime($awal));
		$data['id_dinas_jaga']  = set_value('id_dinas_jaga',$this->input->post('id_dinas_jaga'));
		$this->form_validation->set_rules('id_pegawai','id_pegawai','required');
        if ($this->form_validation->run() === FALSE){
			$this->tampil_top($data);
        }else{
			$id_pegawai = $this->input->post("id_pegawai");
			$bulan = $this->input->post("bulan");
			$tahun = $this->input->post("tahun");
			$this->m_jadwal->simpan_jadwal_dinas();
			$this->session->set_flashdata('sukses', 'Data berhasil Di Tambah Jika Opsi Dipilih');
			redirect(base_url('jadwal/jadwal_dinas/view/'.$bulan.'/'.$tahun.'/'.$id_pegawai));
        }
      }
      if($mode=='tambah_dinas'){
        $data['page'] =  $data['page']."_tambah_dinas";
        $data['id_pegawai']   = $this->uri->segment(6, 0);
				$awal	= $data['tahun'].'-'.$data['bulan'].'-01';
				$data['tglakhir'] = date('t', strtotime($awal));
				$data['id_dinas_jaga']  = set_value('id_dinas_jaga',$this->input->post('id_dinas_jaga'));
				$pegawai = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$data['id_pegawai']);
$data['header'] = "INPUT JADWAL DINAS ".$pegawai['nama_pegawai']." Bulan ".$this->m_rancak->getBulan($data['bulan'])." / Tahun ".$data['tahun'];
$data['title'] = "INPUT JADWAL DINAS ".$pegawai['nama_pegawai']." <b>Bulan ".$this->m_rancak->getBulan($data['bulan'])." / Tahun ".$data['tahun']."</b>";
				$this->load->view("jadwal/isi",$data);
      }
      if($mode=='simpan_tambah_dinas'){
				$bulan = $this->input->post("bulan");
				$tahun = $this->input->post("tahun");
				$this->m_jadwal->simpan_jadwal_dinas();
				$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
				redirect(base_url('jadwal/jadwal_dinas/view/'.$bulan.'/'.$tahun));
      }
      if($mode=='rubah_dinas'){
        $data['page'] =  $data['page']."_rubah_dinas";
				$data['judul'] = "URUTAN";
				$data['title'] = "SESUAIKAN URUTAN";
        $data['dinas']   = $this->uri->segment(7, 0);
				$pegawai_jadwal = $this->m_umum->ambil_data('pegawai_jadwal','id_jadwal',$data['dinas']);
				$data['id_dinas_jaga']  = set_value('id_dinas_jaga',$pegawai_jadwal['id_dinas_jaga']);
				$this->load->view("jadwal/isi",$data);
      }
      if($mode=='simpan_rubah_dinas'){
				$id_pegawai = $this->input->post("id_pegawai");
				$bulan = $this->input->post("bulan");
				$tahun = $this->input->post("tahun");
				$this->m_jadwal->edit_jadwal_dinas();
				$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
				redirect(base_url('jadwal/jadwal_dinas/view/'.$bulan.'/'.$tahun.'/'.$id_pegawai));
      }
      if($mode=='hari_libur'){
        $data['page'] =  $data['page']."_hari_libur";
				$awal	= $data['tahun'].'-'.$data['bulan'].'-01';
				$data['tglakhir'] = date('t', strtotime($awal));
				$kondisi=array('bulan'=>$data['bulan'],'tahun'=>$data['tahun'],'id_unit'=>$this->session->unit);
				$jml = $this->m_umum->jumlah_record_filter('hari_libur',$kondisi);
				if($jml == 0){
					$data['id_hari_libur']  = set_value('id_hari_libur','0');
					$data['tgl_hari_libur']  = set_value('tgl_hari_libur',explode(',', ''));
				}else{
					$offday = $this->m_umum->ambil_data_kondisi('hari_libur',$kondisi);
					$data['id_hari_libur']  = set_value('id_hari_libur',$offday['id_hari_libur']);
					$data['tgl_hari_libur']  = set_value('tgl_hari_libur',explode(',', $offday['tgl_hari_libur']));
				}
				$this->form_validation->set_rules('id_hari_libur','id_hari_libur','required');
        if ($this->form_validation->run() === FALSE){
					$this->tampil_top($data);
        }else{
					$bulan = $this->input->post("bulan");
					$tahun = $this->input->post("tahun");
					$kondisi_num=array('bulan'=>$bulan,'tahun'=>$tahun);
					$jml = $this->m_umum->jumlah_record_filter('hari_libur',$kondisi_num);
					if($jml == 0){
						$this->m_jadwal->simpan_hari_libur();
					}else{
						$this->m_jadwal->edit_hari_libur();
					}
					$this->session->set_flashdata('sukses', 'Berhasil');
					redirect(base_url('jadwal/jadwal_dinas/view/'.$bulan.'/'.$tahun));
        }
      }
	}
  }
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("jadwal/header",$data);
	$this->load->view("jadwal/isi");
	$this->load->view("footer");
	$this->load->view("jadwal/jsload");
	$this->load->view("jadwal/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_topol",$data);
	$this->load->view("jadwal/isi");
	$this->load->view("footer");
	$this->load->view("jadwal/jsload");
	$this->load->view("jadwal/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
