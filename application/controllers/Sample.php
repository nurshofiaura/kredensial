<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Sample extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
          $this->load->model('m_sample');
  }
	function index(){
		$data['page']="home";
		$data['header'] = "GRAFIK KOMPETENSI";
		$data['title'] = "GRAFIK LOGBOOK PERTAHUN";
		$data['link_kembali'] = base_url();
		$program    = $this->m_umum->ambil_data('a_program','id_program','1');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','4');
		$data['instance_id'] = $instansi["id_instansi"];
		$data['instance_name'] = $instansi["nama_instansi"];
		$data['idescription'] = $instansi["description"];
		$data['ikeywords'] = $instansi["keywords"];
		$data['iheader'] = $instansi["header"];
		$data['iheader_mini'] = $instansi["header_mini"];
		$data['ifooter'] = $instansi["footer"];
		$data['ilicensed'] = $instansi["licensed"];
		$data['member_id'] = '0';
		$data['room_name'] = 'Ruangan Sample';
		$data['jabatan_id'] = '0';
		$data['member_name'] = 'PEGAWAI SAMPLE';
		$data['level_name'] = 'SAMPLE';
		$data['photo'] = '';
		$data['json'] = $this->m_sample->lt($data);
		$data['ambil_kol_golongan_pemeriksaan_graph'] = $this->m_sample->ambil_kol_golongan_pemeriksaan_graph();
		//======================= IMPORTANT =========================================
		$this->tampil($data);
	}
	function logbook($mode='view')
	{
		$data['page']="logbook";
		$data['header'] = "BERANDA";
		$data['title'] = "BERANDA";
		$data['link_kembali'] = base_url('sample');
		$data['link_awal'] = base_url('sample/logbook');
		$program    = $this->m_umum->ambil_data('a_program','id_program','1');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','4');
		$pegawai = $this->m_umum->ambil_data('s_pegawai','id_pegawai','1');
		$data['instance_id'] = $instansi["id_instansi"];
		$data['instance_name'] = $instansi["nama_instansi"];
		$data['idescription'] = $instansi["description"];
		$data['ikeywords'] = $instansi["keywords"];
		$data['iheader'] = $instansi["header"];
		$data['iheader_mini'] = $instansi["header_mini"];
		$data['ifooter'] = $instansi["footer"];
		$data['ilicensed'] = $instansi["licensed"];
		$data['member_id'] = $pegawai["id_pegawai"];
		$data['room_name'] = 'Ruangan Sample';
		$data['jabatan_id'] = '0';
		$data['member_name'] = $pegawai["nama_pegawai"];
		$data['level_name'] = 'SAMPLE';
		$data['photo'] = '';
		//======================= IMPORTANT =========================================
		$data['first_date'] = $this->uri->segment(4, 0);
		$data['last_date'] = $this->uri->segment(5, 0);
		$data['id'] = $this->uri->segment(6, 0);
		if(empty($data['first_date'])){
			$data['first_date'] = '01-'.date('m-Y');
		}
		if(empty($data['last_date'])){
			$data['last_date'] = date('d-m-Y');
		}
		if($mode=='view'){
			$this->tampil($data);
			$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$first_date = $this->input->post("first_date");
				$last_date = $this->input->post("last_date");
				redirect(base_url('sample/logbook/view/'.$first_date.'/'.$last_date));
			}
		}
		else if($mode=='data'){
			echo json_encode($this->m_sample->logbook_all($data['first_date'],$data['last_date']));
		}
		 else if($mode=='hapus'){
			$logbook = $this->m_umum->ambil_data('s_logbook','id_logbook',$data['id']);
			if($logbook['v_karu'] == 0 AND $logbook['v_kabid'] == 0 AND $logbook['v_asesor'] == 0 AND $logbook['v_komite'] == 0 AND $logbook['v_direktur'] == 0){
				$this->m_umum->hapus_data('s_logbook','id_logbook',$data['id']);
				$this->session->set_flashdata('sukses', 'LogBook Sudah Di Hapus');
				redirect(base_url('sample/logbook'));
			}else{
				$this->session->set_flashdata('danger', 'LogBook Sudah Di Validasi');
				redirect(base_url('sample/logbook'));
			}
		}
		else{
			$data['kr_kewenangan_detil']=$this->m_sample->kr_kewenangan_detil($data['id']);
		  if($mode=='non_keperawatan'){
			$this->session->set_flashdata('danger', 'Pengisian LogBook Umum Untuk Sample di Non Aktifkan');
			redirect(base_url('sample/logbook/view/'.$data['first_date'].'/'.$data['last_date']));
		  }
		  if($mode=='tambah'){
			$data['page'] =  $data['page']."_tambah";
			$this->form_validation->set_rules('id_pegawai','id_pegawai','required');
			if ($this->form_validation->run() === FALSE){
				$this->tampil($data);
			}else{
				$first_date = $this->input->post("first_date");
				$last_date = $this->input->post("last_date");
				if($this->input->post('chk')){
					$checkboxes = $this->input->post('chk');
					$chk = implode("-",$checkboxes);
					redirect(base_url('sample/logbook/isi/'.$first_date.'/'.$last_date.'/'.$chk));
				}else{
					redirect(base_url('sample/logbook/view/'.$first_date.'/'.$last_date));
				}
			}
		  }
		  if($mode=='isi'){
			$data['page'] =  $data['page']."_isi";
			$data['kr_kewenangan']=$this->m_sample->kewenangan_all();
			$data['terpilih'] = set_value('terpilih',explode("-", $data['id']));
			$data['tgl_logbook'] = set_value('tgl_logbook',date('d-m-Y'));
			$this->form_validation->set_rules('id_pegawai','id_pegawai','required');
			if ($this->form_validation->run() === FALSE)
			{
				  $this->tampil($data);
			}
			else
			{
				$this->m_sample->simpan_logbook();
				$this->session->set_flashdata('sukses', 'Data Berhasil Di Tambah');
				redirect(base_url('sample/logbook'));
			}
		  }
		}
	}
  function v_karu($mode='view')
  {
	$data['page']  = "v_karu";
	$data['header'] = "VALIDASI KEPALA RUANGAN";
	$data['title'] = "VALIDASI KEPALA RUANGAN";
	$data['link_kembali'] = base_url('sample');
	$data['link_awal'] = base_url('sample/logbook');
	$program    = $this->m_umum->ambil_data('a_program','id_program','1');
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','4');
	$pegawai = $this->m_umum->ambil_data('s_pegawai','id_pegawai','1');
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
	$data['member_id'] = $pegawai["id_pegawai"];
	$data['room_name'] = 'Ruangan Sample';
	$data['jabatan_id'] = '0';
	$data['member_name'] = $pegawai["nama_pegawai"];
	$data['level_name'] = 'SAMPLE';
	$data['photo'] = '';
	//=====================================
	$data['first_date'] = $this->uri->segment(4, 0);
	$data['last_date'] = $this->uri->segment(5, 0);
	if(empty($data['first_date'])){
		$data['first_date'] = '01-'.date('m-Y');
	}
	if(empty($data['last_date'])){
		$data['last_date'] = date('d-m-Y');
	}
	$isi = $this->uri->segment(6, 0);
	$id_logbook = $this->uri->segment(7, 0);
    if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$first_date = $this->input->post("first_date");
			$last_date = $this->input->post("last_date");
			$id = $this->input->post("id");
			redirect(base_url('sample/v_karu/view/'.$first_date.'/'.$last_date));
		}
	}
    else if($mode=='data'){
		echo json_encode($this->m_sample->logbook_all($data['first_date'],$data['last_date']));
	}
  else{
      if($mode=='validasi'){
		$kondisi=array('id_logbook'=>$id_logbook,'v_kabid'=>'0','v_asesor'=>'0','v_komite'=>'0','v_direktur'=>'0','id_pengajuan'=>'0');
		$jml = $this->m_umum->jumlah_record_filter('s_logbook',$kondisi);
		if($jml == 0){
			$this->session->set_flashdata('danger', 'Data Sudah Di Validasi / Dalam Tahap Pengajuan, Silahkan Cek Tabel');
		}
		else{
			$this->m_sample->update_v_karu($isi,$id_logbook,'2');
		}
			redirect(base_url('sample/v_karu/view/'.$data['first_date'].'/'.$data['last_date']));
      }
	}
  }
  function pengajuan_kompetensi($mode='view')
  {
	$data['page']  = "pengajuan_kompetensi";
	$data['header'] = "PENGAJUAN KOMPETENSI";
	$data['title'] = "PENGAJUAN KOMPETENSI";
	$data['link_kembali'] = base_url('sample');
	$data['link_awal'] = base_url('sample/logbook');
	$program    = $this->m_umum->ambil_data('a_program','id_program','1');
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','4');
	$pegawai = $this->m_umum->ambil_data('s_pegawai','id_pegawai','1');
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
	$data['member_id'] = $pegawai["id_pegawai"];
	$data['room_name'] = 'Ruangan Sample';
	$data['jabatan_id'] = '0';
	$data['member_name'] = $pegawai["nama_pegawai"];
	$data['level_name'] = 'SAMPLE';
	$data['photo'] = '';
	$data['id'] = $this->uri->segment(4, 0);
	$data['a'] = $this->uri->segment(5, 0);
	$data['b'] = $this->uri->segment(6, 0);
	$data['ambil_data_etik_pegawai_oppe'] = $this->m_sample->ambil_data_etik_pegawai_oppe();
    if($mode=='view'){
		$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_sample->pengajuan_kompetensi_all());
	}
    else if($mode=='grafik'){
		echo json_encode($this->m_sample->grafik_logbook($data['id']));
	}
    else if($mode=='tabel'){
		echo json_encode($this->m_sample->tabel_logbook($data['id'],$data['a']));
	}
  else{
	  $data['status_diusulkan_all']=$this->m_sample->status_diusulkan_all();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		$data['id_status_diusulkan']  = set_value('id_status_diusulkan',$this->input->post("id_status_diusulkan"));
		$this->load->view("isi_sample",$data);
      }
      if($mode=='simpan_tambah'){
		  if($last_ide = $this->m_sample->simpan_pengajuan_kompetensi()){
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
			redirect(base_url('sample/pengajuan_kompetensi/isi/'.$last_ide));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
			redirect(base_url('sample/pengajuan_kompetensi'));
		  }
      }
      if($mode=='isi'){
        $data['page'] =  $data['page']."_isi";
		$data['ambil_berkas_data']=$this->m_sample->ambil_id_berkas_data();
		$d	=$this->m_sample->ambil_pengajuan_kompetensi($data['id']);
		$data['id_pengajuan']  = set_value('id_pengajuan',$d["id_pengajuan"]);
		$data['id_status_diusulkan']  = set_value('id_status_diusulkan',$d["id_status_diusulkan"]);
		$data['id_berkas']  = explode(",", $d["id_berkas"]);
		$data['berkas']  = $d["id_berkas"];
		$data['id_ijasah']  = explode(",", $d["id_ijasah"]);
		$data['ijasah']  = $d["id_ijasah"];
		$data['id_str']  = explode(",", $d["id_str"]);
		$data['str']  = $d["id_str"];
		$data['id_sertifikat']  = explode(",", $d["id_sertifikat"]);
		$data['etike']  = explode(",", $d["id_etik_pegawai"]);
		$data['sertifikat']  = $d["id_sertifikat"];
		$data['kesesuaian_bukti']  = set_value('kesesuaian_bukti',explode(",", $d["kesesuaian_bukti"]));
		$data['id_logbook_a']  = set_value('id_logbook_a',$d["id_logbook_a"]);
		$data['id_logbook_b']  = set_value('id_logbook_b',$d["id_logbook_b"]);
		$data['status_pengajuan']  = set_value('status_pengajuan',$d["status_pengajuan"]);
		$data['id_etik_pegawai']  = set_value('id_etik_pegawai',$d["id_etik_pegawai"]);
		$data['acc_kabid']  = set_value('acc_kabid',$d["acc_kabid"]);
		$data['acc_komite']  = set_value('acc_komite',$d["acc_komite"]);
		$this->tampil($data);
		$action = $this->input->post('action');
		$id_pengajuan = $this->input->post('id_pengajuan');
		if($action == 'Btnsimpan') {
			$this->m_sample->edit_pengajuan($pegawai['id_level']);
			$this->session->set_flashdata('sukses', 'Pengajuan Sudah Di Simpan');
			redirect(base_url('sample/pengajuan_kompetensi'));
		}
		if($action == 'BtnKirim') {
		//	$this->m_profil->simpan_pengajuan_logbook_pegawai($id_pengajuan);
			$this->m_sample->terkirim($pegawai['id_level']);
			$this->session->set_flashdata('sukses', 'Pengajuan Sudah Diproses Cek Tabel Untuk Kelengkapan Data');
			redirect(base_url('sample/pengajuan_kompetensi'));
		}
	  }
	}
  }
  function berkas_logbook($mode='view')
  {
	$data['page']  = "berkas_logbook";
	$data['header'] = "PEMILIHAN ID LOGBOOK AWAL DAN AKHIR";
	$data['title'] = "PEMILIHAN ID LOGBOOK AWAL DAN AKHIR";
//	$data['link_kembali'] = base_url('sample');
	$data['link_awal'] = base_url('sample/pengajuan_kompetensi');
	$program    = $this->m_umum->ambil_data('a_program','id_program','1');
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','4');
	$pegawai = $this->m_umum->ambil_data('s_pegawai','id_pegawai','1');
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
	$data['member_id'] = $pegawai["id_pegawai"];
	$data['room_name'] = 'Ruangan Sample';
	$data['jabatan_id'] = '0';
	$data['member_name'] = $pegawai["nama_pegawai"];
	$data['level_name'] = 'SAMPLE';
	$data['photo'] = '';
	$data['first_date']  = $this->uri->segment(4, 0);
	$data['last_date']   = $this->uri->segment(5, 0);
	$data['id']   = $this->uri->segment(6, 0);
	$data['link_kembali'] = base_url('sample/pengajuan_kompetensi/isi/'.$data['id']);
	if(empty($data['first_date'])){
		$data['first_date'] =  '01-'.date('m-Y');
	}
	if(empty($data['last_date'])){
		$data['last_date'] = date('d-m-Y');
	}
    if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$first_date = $this->input->post("first_date");
			$last_date = $this->input->post("last_date");
			$id = $this->input->post("id");
			redirect(base_url('sample/berkas_logbook/view/'.$first_date.'/'.$last_date.'/'.$id));
		}
	}
    else if($mode=='data'){
		echo json_encode($this->m_sample->logbook_pengajuan_all($data['first_date'],$data['last_date']));
	}
  else{
      if($mode=='simpana'){
		$status_pengajuan=$this->m_umum->ambil_data('s_pengajuan','id_pengajuan',$data['first_date']);
		if($status_pengajuan['status_pengajuan']=="0"){
			$this->m_sample->simpan_pengajuan_logbook_a($data['first_date'],$data['last_date']);
			$this->m_sample->simpan_pengajuan_logbook_pegawai($data['first_date'],'0');
		}
		redirect(base_url('sample/pengajuan_kompetensi/isi/'.$data['first_date']));
      }
      if($mode=='simpanb'){
		$status_pengajuan=$this->m_umum->ambil_data('s_pengajuan','id_pengajuan',$data['first_date']);
		if($status_pengajuan['status_pengajuan']=="0"){
			$this->m_sample->simpan_pengajuan_logbook_b($data['first_date'],$data['last_date']);
			$this->m_sample->simpan_pengajuan_logbook_pegawai($data['first_date'],'0');
		}
		redirect(base_url('sample/pengajuan_kompetensi/isi/'.$data['first_date']));
      }
	}
  }
  function berkas_ijasah($mode='view')
  {
	$data['page']  = "berkas_ijasah";
	$data['header'] = "AMBIL BERKAS IJASAH";
	$data['title'] = "AMBIL BERKAS IJASAH";
	$data['link_awal'] = base_url('sample/pengajuan_kompetensi');
	$program    = $this->m_umum->ambil_data('a_program','id_program','1');
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','4');
	$pegawai = $this->m_umum->ambil_data('s_pegawai','id_pegawai','1');
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
	$data['member_id'] = $pegawai["id_pegawai"];
	$data['room_name'] = 'Ruangan Sample';
	$data['jabatan_id'] = '0';
	$data['member_name'] = $pegawai["nama_pegawai"];
	$data['level_name'] = 'SAMPLE';
	$data['photo'] = '';
	$data['id']  = $this->uri->segment(4, 0);
	$data['idb']  = $this->uri->segment(5, 0);
	$data['link_kembali'] = base_url('sample/pengajuan_kompetensi/isi/'.$data['id']);
    if($mode=='view'){
		$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_sample->ijasah_all());
	}
  else{
      if($mode=='simpan'){
		$status_pengajuan=$this->m_umum->ambil_data('s_pengajuan','id_pengajuan',$data['id']);
		$id_ijasahe = $status_pengajuan['id_ijasah'];
		$this->m_sample->simpan_berkas_ijasah($data['id'],$data['idb'],$id_ijasahe);
		redirect(base_url('sample/pengajuan_kompetensi/isi/'.$data['id']));
      }
	}
  }
  function berkas_sertifikat($mode='view')
  {
	$data['page']  = "berkas_sertifikat";
	$data['header'] = "AMBIL BERKAS PELATIHAN / SERTIFIKAT";
	$data['title'] = "AMBIL BERKAS PELATIHAN / SERTIFIKAT";
	$data['link_awal'] = base_url('sample/pengajuan_kompetensi');
	$program    = $this->m_umum->ambil_data('a_program','id_program','1');
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','4');
	$pegawai = $this->m_umum->ambil_data('s_pegawai','id_pegawai','1');
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
	$data['member_id'] = $pegawai["id_pegawai"];
	$data['room_name'] = 'Ruangan Sample';
	$data['jabatan_id'] = '0';
	$data['member_name'] = $pegawai["nama_pegawai"];
	$data['level_name'] = 'SAMPLE';
	$data['photo'] = '';
	$data['id']  = $this->uri->segment(4, 0);
	$data['idb']  = $this->uri->segment(5, 0);
	$data['link_kembali'] = base_url('sample/pengajuan_kompetensi/isi/'.$data['id']);
    if($mode=='view'){
		$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_sample->pelatihan_all());
	}
  else{
      if($mode=='simpan'){
		$status_pengajuan=$this->m_umum->ambil_data('s_pengajuan','id_pengajuan',$data['id']);
		$id_ijasahe = $status_pengajuan['id_sertifikat'];
		$this->m_sample->simpan_berkas_sertifikat($data['id'],$data['idb'],$id_ijasahe);
		redirect(base_url('sample/pengajuan_kompetensi/isi/'.$data['id']));
      }
	}
  }
  function berkas_str($mode='view')
  {
	$data['page']  = "berkas_str";
	$data['header'] = "AMBIL BERKAS SURAT IJIN";
	$data['title'] = "AMBIL BERKAS SURAT IJIN";
	$data['link_awal'] = base_url('sample/pengajuan_kompetensi');
	$program    = $this->m_umum->ambil_data('a_program','id_program','1');
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','4');
	$pegawai = $this->m_umum->ambil_data('s_pegawai','id_pegawai','1');
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
	$data['member_id'] = $pegawai["id_pegawai"];
	$data['room_name'] = 'Ruangan Sample';
	$data['jabatan_id'] = '0';
	$data['member_name'] = $pegawai["nama_pegawai"];
	$data['level_name'] = 'SAMPLE';
	$data['photo'] = '';
	$data['id']  = $this->uri->segment(4, 0);
	$data['idb']  = $this->uri->segment(5, 0);
	$data['link_kembali'] = base_url('sample/pengajuan_kompetensi/isi/'.$data['id']);
    if($mode=='view'){
		$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_sample->str_all());
	}
  else{
      if($mode=='simpan'){
		$status_pengajuan=$this->m_umum->ambil_data('s_pengajuan','id_pengajuan',$data['id']);
		$id_ijasahe = $status_pengajuan['id_str'];
		$this->m_sample->simpan_berkas_str($data['id'],$data['idb'],$id_ijasahe);
		redirect(base_url('sample/pengajuan_kompetensi/isi/'.$data['id']));
      }
	}
  }
  function berkaslain_berkas($mode='view')
  {
	$data['page']  = "berkaslain_berkas";
	$data['header'] = "AMBIL BERKAS UMUM";
	$data['title'] = "AMBIL BERKAS UMUM";
	$data['link_awal'] = base_url('sample/pengajuan_kompetensi');
	$program    = $this->m_umum->ambil_data('a_program','id_program','1');
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','4');
	$pegawai = $this->m_umum->ambil_data('s_pegawai','id_pegawai','1');
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
	$data['member_id'] = $pegawai["id_pegawai"];
	$data['room_name'] = 'Ruangan Sample';
	$data['jabatan_id'] = '0';
	$data['member_name'] = $pegawai["nama_pegawai"];
	$data['level_name'] = 'SAMPLE';
	$data['photo'] = '';
	$data['id']  = $this->uri->segment(4, 0);
	$data['idb']  = $this->uri->segment(5, 0);
	$data['link_kembali'] = base_url('sample/pengajuan_kompetensi/isi/'.$data['id']);
    if($mode=='view'){
		$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_sample->berkas_pribadi_all());
	}
  else{
      if($mode=='simpan'){
		$status_pengajuan=$this->m_umum->ambil_data('s_pengajuan','id_pengajuan',$data['id']);
		$id_ijasahe = $status_pengajuan['id_berkas'];
		$this->m_sample->simpan_berkaslain_berkas($data['id'],$data['idb'],$id_ijasahe);
		redirect(base_url('sample/pengajuan_kompetensi/isi/'.$data['id']));
      }
	}
  }
  function v_kabid($mode='view')
  {
	$data['page']  = "v_kabid";
	$data['header'] = "VALIDASI KABID";
	$data['title'] = "VALIDASI PENGAJUAN KOMPETENSI OLEH KABID";
	$data['link_kembali'] = base_url('sample');
	$data['link_awal'] = base_url('sample/v_kabid');
	$program    = $this->m_umum->ambil_data('a_program','id_program','1');
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','4');
	$pegawai = $this->m_umum->ambil_data('s_pegawai','id_pegawai','1');
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
	$data['member_id'] = $pegawai["id_pegawai"];
	$data['room_name'] = 'Ruangan Sample';
	$data['jabatan_id'] = '0';
	$data['member_name'] = $pegawai["nama_pegawai"];
	$data['level_name'] = 'SAMPLE';
	$data['photo'] = '';
	$data['id'] = $this->uri->segment(4, 0);
	$data['idp'] = $this->uri->segment(5, 0);
	if(empty($data['id'])){
		$data['id'] = '0';
	}
    if($mode=='view'){
		$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_sample->pengajuan_kompetensi_tes('1'));
	}
  else{
      if($mode=='isi'){
        $data['page'] =  $data['page']."_isi";
		$data['ambil_berkas_data']=$this->m_sample->ambil_all_id_berkas_data();
		$d	=$this->m_sample->ambil_pengajuan_kompetensi($data['id']);
		$data['id_pengajuan']  = set_value('id_pengajuan',$d["id_pengajuan"]);
		$data['id_status_diusulkan']  = set_value('id_status_diusulkan',$d["id_status_diusulkan"]);
		$data['id_berkas']  = explode(",", $d["id_berkas"]);
		$data['berkas']  = $d["id_berkas"];
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
		$data['acc_logbook_kabid']  = set_value('acc_logbook_kabid',$d["acc_logbook_kabid"]);
		$data['id_pegawai']  = set_value('id_pegawai',$d["id_pegawai"]);
		$data['foto']  = set_value('foto',$d["foto"]);
		$data['nama_pegawai']  = set_value('nama_pegawai',$d["nama_pegawai"]);
		$data['ambil_data_etik_pegawai_oppe'] = $this->m_sample->ambil_data_etik_pegawai_oppe();
		$this->tampil($data);
		$action = $this->input->post('action');
		$id_pengajuan = $this->input->post('id_pengajuan');
		if($action == 'BtnOke') {
			$this->m_sample->Kabid_Acc($data['id'],'1');
			$this->session->set_flashdata('sukses', 'Data Sudah di Simpan');
			redirect(base_url('sample/v_kabid'));
		}
		if($action == 'BtnTolak') {
			$this->m_sample->Kabid_Tolak($data['id'],'1');
			$this->session->set_flashdata('sukses', 'Data Sudah di Simpan');
			redirect(base_url('sample/v_kabid'));
		}
		if($action == 'BtnProses') {
			$this->m_sample->update_acc_kompetensi_kabid($data['id']);
			$this->session->set_flashdata('sukses', 'Data Sudah di Simpan');
			redirect(base_url('sample/v_kabid/isi/'.$data['id']));
		}
	  }
	}
  }
   function v_kabid_kompetensi(){
	$isi   = $this->uri->segment(3, 0);
	$tolak   = $this->uri->segment(4, 0);
	$id   = $this->uri->segment(5, 0);
	$id_pengajuan   = $this->uri->segment(6, 0);
	$d    = $this->m_umum->ambil_data('s_pengajuan','id_pengajuan',$id_pengajuan);
	$acc_logbook_kabid = $d['acc_logbook_kabid'];
	if($acc_logbook_kabid == '0'){
		$this->m_sample->update_v_kabid_kompetensi($isi,$tolak,$id,$id_pengajuan);
	}else{
		$this->session->set_flashdata('danger', 'Data Sudah di Validasi Kabid');
	}
	redirect(base_url('sample/v_kabid/isi/'.$id_pengajuan));
   }
  function v_asesor($mode='view')
  {
	$data['page']  = "v_asesor";
	$data['header'] = "VALIDASI ASESOR";
	$data['title'] = "VALIDASI PENGAJUAN KOMPETENSI OLEH ASESOR";
	$data['link_kembali'] = base_url('sample');
	$data['link_awal'] = base_url('sample/v_asesor');
	$program    = $this->m_umum->ambil_data('a_program','id_program','1');
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','4');
	$pegawai = $this->m_umum->ambil_data('s_pegawai','id_pegawai','1');
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
	$data['member_id'] = $pegawai["id_pegawai"];
	$data['room_name'] = 'Ruangan Sample';
	$data['jabatan_id'] = '0';
	$data['member_name'] = $pegawai["nama_pegawai"];
	$data['level_name'] = 'SAMPLE';
	$data['photo'] = '';
	$data['id'] = $this->uri->segment(4, 0);
	$data['idp'] = $this->uri->segment(5, 0);
	if(empty($data['id'])){
		$data['id'] = '0';
	}
    if($mode=='view'){
		$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_sample->pengajuan_kompetensi_tes('2'));
	}
  else{
      if($mode=='isi'){
        $data['page'] =  $data['page']."_isi";
		$data['ambil_berkas_data']=$this->m_sample->ambil_all_id_berkas_data();
		$d	=$this->m_sample->ambil_pengajuan_kompetensi($data['id']);
		$data['id_pengajuan']  = set_value('id_pengajuan',$d["id_pengajuan"]);
		$data['id_status_diusulkan']  = set_value('id_status_diusulkan',$d["id_status_diusulkan"]);
		$data['id_berkas']  = explode(",", $d["id_berkas"]);
		$data['berkas']  = $d["id_berkas"];
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
		$data['acc_logbook_asesor']  = set_value('acc_logbook_asesor',$d["acc_logbook_asesor"]);
		$data['id_pegawai']  = set_value('id_pegawai',$d["id_pegawai"]);
		$data['foto']  = set_value('foto',$d["foto"]);
		$data['nama_pegawai']  = set_value('nama_pegawai',$d["nama_pegawai"]);
		$data['ambil_data_etik_pegawai_oppe'] = $this->m_sample->ambil_data_etik_pegawai_oppe();
		$this->tampil($data);
		$action = $this->input->post('action');
		$id_pengajuan = $this->input->post('id_pengajuan');
		if($action == 'BtnOke') {
			$this->m_sample->Asesor_Acc($data['id']);
			$this->session->set_flashdata('sukses', 'Data Sudah di Simpan');
			redirect(base_url('sample/v_asesor'));
		}
		if($action == 'BtnTolak') {
			$this->m_sample->Asesor_Tolak($data['id']);
			$this->session->set_flashdata('sukses', 'Data Sudah di Simpan');
			redirect(base_url('sample/v_asesor'));
		}
		if($action == 'BtnProses') {
			$this->m_sample->update_acc_kompetensi_asesor($data['id']);
			$this->session->set_flashdata('sukses', 'Data Sudah di Simpan');
			redirect(base_url('sample/v_asesor/isi/'.$data['id']));
		}
	  }
	}
  }
   function v_asesor_kompetensi(){
	$isi   = $this->uri->segment(3, 0);
	$tolak   = $this->uri->segment(4, 0);
	$id   = $this->uri->segment(5, 0);
	$id_pengajuan   = $this->uri->segment(6, 0);
	$d    = $this->m_umum->ambil_data('s_pengajuan','id_pengajuan',$id_pengajuan);
	$acc_logbook_asesor = $d['acc_logbook_asesor'];
	if($acc_logbook_asesor =='0'){
		$this->m_sample->update_v_asesor_kompetensi($isi,$tolak,$id,$id_pengajuan);
	}
	else{
		$this->session->set_flashdata('danger', 'Data Sudah di Validasi Asesor');
	}
	redirect(base_url('sample/v_asesor/isi/'.$id_pengajuan));
   }
  function v_komite($mode='view')
  {
	$data['page']  = "v_komite";
	$data['header'] = "VALIDASI KOMITE";
	$data['title'] = "VALIDASI PENGAJUAN KOMPETENSI OLEH KOMITE";
	$data['link_kembali'] = base_url('sample');
	$data['link_awal'] = base_url('sample/v_komite');
	$program    = $this->m_umum->ambil_data('a_program','id_program','1');
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','4');
	$pegawai = $this->m_umum->ambil_data('s_pegawai','id_pegawai','1');
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
	$data['member_id'] = $pegawai["id_pegawai"];
	$data['room_name'] = 'Ruangan Sample';
	$data['jabatan_id'] = '0';
	$data['member_name'] = $pegawai["nama_pegawai"];
	$data['level_name'] = 'SAMPLE';
	$data['photo'] = '';
	$data['id'] = $this->uri->segment(4, 0);
	$data['idp'] = $this->uri->segment(5, 0);
	if(empty($data['id'])){
		$data['id'] = '0';
	}
    if($mode=='view'){
		$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_sample->pengajuan_kompetensi_tes('3'));
	}
  else{
      if($mode=='isi'){
        $data['page'] =  $data['page']."_isi";
		$data['ambil_berkas_data']=$this->m_sample->ambil_all_id_berkas_data();
		$d	=$this->m_sample->ambil_pengajuan_kompetensi($data['id']);
		$data['id_pengajuan']  = set_value('id_pengajuan',$d["id_pengajuan"]);
		$data['id_status_diusulkan']  = set_value('id_status_diusulkan',$d["id_status_diusulkan"]);
		$data['id_berkas']  = explode(",", $d["id_berkas"]);
		$data['berkas']  = $d["id_berkas"];
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
		$data['ambil_data_etik_pegawai_oppe'] = $this->m_sample->ambil_data_etik_pegawai_oppe();
		$this->tampil($data);
		$action = $this->input->post('action');
		$id_pengajuan = $this->input->post('id_pengajuan');
		if($action == 'BtnOke') {
			$this->m_sample->Komite_Acc($data['id']);
			redirect(base_url('sample/v_komite'));
		}
		if($action == 'BtnSimpan') {
			$this->m_sample->Komite_Simpan($data['id']);
			redirect(base_url('sample/v_komite'));
		}
		if($action == 'BtnTolak') {
			$this->m_sample->Komite_Tolak($data['id']);
			redirect(base_url('sample/v_komite'));
		}
		if($action == 'BtnProses') {
			$this->m_sample->update_acc_kompetensi_komite($data['id']);
			$this->session->set_flashdata('sukses', 'Data Sudah di Simpan');
			redirect(base_url('sample/v_komite/isi/'.$data['id']));
		}
	  }
	}
  }
    function v_komite_kompetensi(){
	$isi   = $this->uri->segment(3, 0);
	$tolak   = $this->uri->segment(4, 0);
	$id   = $this->uri->segment(5, 0);
	$id_pengajuan   = $this->uri->segment(6, 0);
	$idlb   = $this->uri->segment(7, 0);
	$d    = $this->m_umum->ambil_data('s_pengajuan','id_pengajuan',$id_pengajuan);
	$data['acc_logbook_komite'] = $d['acc_logbook_komite'];
		if($data['acc_logbook_komite']=='0'){
			$this->m_sample->update_v_komite_kompetensi($isi,$tolak,$id,$id_pengajuan);
		}
	redirect(base_url('sample/v_komite/isi/'.$id_pengajuan));
   }
   function v_direktur($mode='view')
  {
	$data['page']  = "v_direktur";
	$data['header'] = "VALIDASI DIREKTUR";
	$data['title'] = "VALIDASI PENGAJUAN KOMPETENSI OLEH DIREKTUR";
	$data['link_kembali'] = base_url('sample');
	$data['link_awal'] = base_url('sample/v_direktur');
	$program    = $this->m_umum->ambil_data('a_program','id_program','1');
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','4');
	$pegawai = $this->m_umum->ambil_data('s_pegawai','id_pegawai','1');
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
	$data['member_id'] = $pegawai["id_pegawai"];
	$data['room_name'] = 'Ruangan Sample';
	$data['jabatan_id'] = '0';
	$data['member_name'] = $pegawai["nama_pegawai"];
	$data['level_name'] = 'SAMPLE';
	$data['photo'] = '';
	$data['id'] = $this->uri->segment(4, 0);
	$data['idp'] = $this->uri->segment(5, 0);
	if(empty($data['id'])){
		$data['id'] = '0';
	}
    if($mode=='view'){
		$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_sample->pengajuan_kompetensi_tes('4'));
	}
  else{
      if($mode=='isi'){
        $data['page'] =  $data['page']."_isi";
		$data['ambil_berkas_data']=$this->m_sample->ambil_all_id_berkas_data();
		$d	=$this->m_sample->ambil_pengajuan_kompetensi($data['id']);
		$data['id_pengajuan']  = set_value('id_pengajuan',$d["id_pengajuan"]);
		$data['id_status_diusulkan']  = set_value('id_status_diusulkan',$d["id_status_diusulkan"]);
		$data['id_berkas']  = explode(",", $d["id_berkas"]);
		$data['berkas']  = $d["id_berkas"];
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
		$data['acc_logbook_direktur']  = set_value('acc_logbook_direktur',$d["acc_logbook_direktur"]);
		$data['id_pegawai']  = set_value('id_pegawai',$d["id_pegawai"]);
		$data['foto']  = set_value('foto',$d["foto"]);
		$data['nama_pegawai']  = set_value('nama_pegawai',$d["nama_pegawai"]);
		$data['ambil_data_etik_pegawai_oppe'] = $this->m_sample->ambil_data_etik_pegawai_oppe();
		$this->tampil($data);
		$action = $this->input->post('action');
		$id_pengajuan = $this->input->post('id_pengajuan');
		if($action == 'BtnOke') {
				$this->m_sample->Direktur_Acc($data['id']);
				$this->session->set_flashdata('sukses', 'Data Sudah di Simpan');
			redirect(base_url('sample/v_direktur'));
		}
		if($action == 'BtnTolak') {
				$this->m_sample->Direktur_Tolak($data['id']);
				$this->session->set_flashdata('sukses', 'Data Sudah di Simpan');
			redirect(base_url('sample/v_direktur'));
		}
		if($action == 'BtnProses') {
				$this->m_sample->update_acc_kompetensi_direktur($data['id']);
				$this->session->set_flashdata('sukses', 'Data Sudah di Simpan');
				redirect(base_url('sample/v_direktur/isi/'.$data['id']));
		}
	  }
	}
  }
    function v_direktur_kompetensi(){
	$isi   = $this->uri->segment(3, 0);
	$id_pengajuan   = $this->uri->segment(4, 0);
	$d    = $this->m_umum->ambil_data('s_pengajuan','id_pengajuan',$id_pengajuan);
	$data['acc_logbook_direktur'] = $d['acc_logbook_direktur'];
		$this->m_sample->update_v_direktur_kompetensi($isi,$id_pengajuan);
		$this->session->set_flashdata('sukses', 'Data Sudah di Simpan');
	redirect(base_url('sample/v_direktur/isi/'.$id_pengajuan));
   }
 //==============================================
   function jabfung($id)
  {
    $dt=$this->m_sample->jabfung($id);
    echo json_encode($dt);
  }
  function abk($mode='view')
  {
	$data['page']  = "abk";
	$data['header'] = "ANALISA BEBAN KERJA";
	$data['title'] = "ANALISA BEBAN KERJA";
	$data['link_kembali'] = base_url('sample');
	$data['link_awal'] = base_url('sample/abk');
	$program    = $this->m_umum->ambil_data('a_program','id_program','1');
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','4');
	$pegawai = $this->m_umum->ambil_data('s_pegawai','id_pegawai','1');
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
	$data['member_id'] = $pegawai["id_pegawai"];
	$data['room_name'] = 'Ruangan Sample';
	$data['jabatan_id'] = '0';
	$data['member_name'] = $pegawai["nama_pegawai"];
	$data['level_name'] = 'SAMPLE';
	$data['photo'] = '';
	$data['id'] = $this->uri->segment(4, 0);
	$data['id_bk_detil'] = $this->uri->segment(5, 0);
	if(empty($data['id'])){
		$data['id'] = date('Y');
	}
	$data['cmd_range_tahun']=$this->m_sample->cmd_range_tahun(date('Y')-1,date('Y')+5);
	$data['year_periode']=$this->m_sample->year_periode_abk();
    if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$id = $this->input->post("id");
			redirect(base_url('sample/abk/view/'.$id));
		}
	}
    else if($mode=='data'){
		echo json_encode($this->m_sample->abk_all($data['id'],$pegawai['id_ruangan']));
	}
    else if($mode=='data_butir_kegiatan'){
		echo json_encode($this->m_sample->id_butir_kegiatan_all($data['id']));
	}
  else{
		$data['cmd_jabatan_fungsional'] = $this->m_sample->cmd_jabatan_fungsional_id('1');
		$data['cmd_struktur_jabatan'] = $this->m_sample->cmd_struktur_jabatan();
		$data['option'] = $this->m_sample->cmd_count();
		$data['cmd_jabatan_null'] = $this->m_sample->cmd_jabatan_null();
		$injabdet = $this->m_sample->ambil_injab_detil($data['id']);
      if($mode=='periode'){
        $data['page'] =  $data['page']."_periode";
		$data['periode']  = set_value('periode',$this->input->post("periode"));
		$data['id_jabatan_fungsional']  = set_value('id_jabatan_fungsional',$this->input->post("id_jabatan_fungsional"));
		$data['id_struktur_jabatan']  = set_value('id_struktur_jabatan',$this->input->post("id_struktur_jabatan"));
		$data['id_jabatan']  = set_value('id_jabatan',$this->input->post("id_jabatan"));
		$this->load->view("isi_sample",$data);
      }
      if($mode=='simpan_periode'){
		$periode = $this->input->post('periode');
		$tgl_periode = $periode."-01-01";
		  $id_jabatan_fungsional = $this->input->post("id_jabatan_fungsional");
		$jml = $this->m_sample->jumlah_record_filter_injab($tgl_periode,$id_jabatan_fungsional);
		if($jml == 0){
		  if($last_ide = $this->m_sample->simpan_injab()){
			$last_injabdet = $this->m_sample->simpan_injab_detil($last_ide);
			redirect(base_url('sample/abk/isi/'.$last_injabdet));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
			redirect(base_url('sample/abk/view/'.$periode));
		  }
		}else{
			$this->session->set_flashdata('danger', 'Data Sudah Ada');
			redirect(base_url('sample/abk/view/'.$periode));
		}
      }
      if($mode=='isi'){
        $data['page'] =  $data['page']."_isi";
				$data['periode'] = set_value('periode',date('Y',strtotime($injabdet["periode"])));
				$data['nama_jabatan_fungsional'] = set_value('nama_jabatan_fungsional',$injabdet["nama_jabatan_fungsional"]);
				$data['nama_unit'] = 'Ruangan Radiologi';
				$data['nama_struktur_jabatan'] = set_value('nama_struktur_jabatan',$injabdet["nama_struktur_jabatan"]);
				$this->form_validation->set_rules('periode','periode','required');
        if ($this->form_validation->run() === FALSE){
					$this->tampil($data);
    		}else{
					$periode  = $this->input->post("periode");
					$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
					redirect(base_url('sample/abk/view/'.$periode));
        }
      }
      if($mode=='pilih_bk'){
        $data['page'] =  $data['page']."_pilih_bk";
				$data['butir_kegiatan_all']   = $this->m_sample->butir_kegiatan_all($injabdet['id_jabatan_fungsional']);
				$data['id_butir_kegiatan'] = set_value('id_butir_kegiatan',$injabdet["id_butir_kegiatan"]);
		$this->load->view("isi_sample",$data);
      }
      if($mode=='simpan_pilih_bk'){
		  $id_abk_detil = $this->input->post('id_abk_detil');
		if($this->input->post('chk')){
		  if($this->m_sample->rubah_bk()){
			redirect(base_url('sample/abk/isi/'.$id_abk_detil));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
			redirect(base_url('sample/abk/isi/'.$id_abk_detil));
		  }
		}else{
			redirect(base_url('sample/abk/isi/'.$id_abk_detil));
		}
	  }
      if($mode=='formasi'){
        $data['page'] =  $data['page']."_formasi";
		$kondisi_bk = array('id_bk_detil'=>$data['id_bk_detil']);
		$bk = $this->m_umum->ambil_data_kondisi('sbk_detil',$kondisi_bk);
		$pabkd = $this->m_umum->ambil_data('p_abk_detil','id_abk_detil',$bk['id_abk_detil']);
		$periodenya = date('Y', strtotime($pabkd['periode']));
		$ded = $this->m_umum->ambil_data('butir_kegiatan','id_butir_kegiatan',$bk['id_butir_kegiatan']);
		$data['id_butir_kegiatan'] = set_value('id_butir_kegiatan',$bk["id_butir_kegiatan"]);
		$data['angka_kredit'] = set_value('angka_kredit',$ded["angka_kredit"]);
		$data['satuan_hasil'] = set_value('satuan_hasil',$ded["satuan_hasil"]);
		$data['status_butir_kegiatan'] = set_value('status_butir_kegiatan',$bk["status_bk_detil"]);
		$data['nama_butir_kegiatan'] = set_value('nama_butir_kegiatan',$ded["nama_butir_kegiatan"]);
		$data['keterangan_jumlah'] = set_value('keterangan_jumlah',$bk["keterangan_jumlah"]);
		$data['konstanta'] = set_value('konstanta',$bk["konstanta"]);
		$data['wpk'] = set_value('wpk',$bk["wpk"]);
		$data['vol1th'] = set_value('vol1th',$bk["vol1th"]);
		$data['wpv'] = set_value('wpv',$bk["wpv"]);
		$data['formasi'] = set_value('formasi',$bk["formasi"]);
		$data['jam_efektif'] = set_value('jam_efektif',$bk["jam_efektif"]);
		$this->form_validation->set_rules('nama_butir_kegiatan','nama_butir_kegiatan','required');
        if ($this->form_validation->run() === FALSE){
			$this->tampil($data);
        }else{
		$id_abk_detil  = $this->input->post("id_abk_detil");
		  if($this->m_sample->rubah_bk_detil()){
			$this->session->set_flashdata('sukses', 'Data Sudah Disimpan');
			redirect(base_url('sample/abk/isi/'.$id_abk_detil));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Rubah Data. Hubungi Admin');
			redirect(base_url('sample/abk/isi/'.$id_abk_detil));
		  }
        }
      }
      if($mode=='urutan'){
        $data['page'] =  $data['page']."_urutan";
		$data['periode'] = set_value('periode',date('Y',strtotime($injabdet["periode"])));
		$data['nama_jabatan_fungsional']  = set_value('nama_jabatan_fungsional',$injabdet["nama_jabatan_fungsional"]);
		$data['no_urut']  = set_value('no_urut',$injabdet["no_urut"]);
		$this->load->view("isi_sample",$data);
      }
      if($mode=='simpan_urutan'){
		$periode = $this->input->post('periode');
		$tgl_periode = $periode."-01-01";
		  if($this->m_sample->edit_no_urut()){
			redirect(base_url('sample/abk/view/'.$periode));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
			redirect(base_url('sample/abk/view/'.$periode));
		  }
      }
      if($mode=='isi_pegawai'){
        $data['page'] =  $data['page']."_isi_pegawai";
				$data['periode'] = set_value('periode',date('Y',strtotime($injabdet["periode"])));
				$data['pns'] = set_value('pns',$injabdet["pns"]);
				$data['cpns'] = set_value('cpns',$injabdet["cpns"]);
				$data['blud'] = set_value('blud',$injabdet["blud"]);
				$this->load->view("isi_sample",$data);
      }
      if($mode=='simpan_isi_pegawai'){
			  $periode = $this->input->post('periode');
			  if($this->m_sample->rubah_jumlah_pegawai()){
				redirect(base_url('sample/abk/view/'.$periode));
			  }else{
				$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
				redirect(base_url('sample/abk/view/'.$periode));
			  }
      }
      if($mode=='pemenuhan_tambah'){
        $data['page'] =  $data['page']."_pemenuhan_tambah";
		$data['periode']  = set_value('periode',$this->input->post("periode"));
		$data['id_jabatan_fungsional']  = set_value('id_jabatan_fungsional',$injabdet["id_jabatan_fungsional"]);
		$data['periode_lama']  = set_value('periode_lama',date('Y', strtotime($injabdet["periode"])));
		$data['id_unit']  = set_value('id_unit',$pegawai["id_ruangan"]);
		$data['jml_pemenuhan']  = set_value('jml_pemenuhan','0');
		$data['jml_realisasi']  = set_value('jml_realisasi','0');
		$this->load->view("isi_sample",$data);
      }
      if($mode=='simpan_pemenuhan_tambah'){
		$periode_lama = $this->input->post('periode_lama');
		$periode = $this->input->post('periode');
		$tgl_periode = $periode."-01-01";
		  $id_unit = $this->input->post("id_unit");
		  $id_jabatan_fungsional = $this->input->post("id_jabatan_fungsional");
		$jml = $this->m_sample->jumlah_record_filter_pemenuhan($id_unit,$tgl_periode,$id_jabatan_fungsional);
		if($jml == 0){
		  if($this->m_sample->simpan_abk_pemenuhan()){
			redirect(base_url('sample/abk/view/'.$periode_lama));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
			redirect(base_url('sample/abk/view/'.$periode_lama));
		  }
		}else{
			$this->session->set_flashdata('danger', 'Data Sudah Ada');
			redirect(base_url('sample/abk/view/'.$periode_lama));
		}
      }
      if($mode=='pemenuhan_edit'){
        $data['page'] =  $data['page']."_pemenuhan_edit";
				$id_jabatan_fungsional = $injabdet["id_jabatan_fungsional"];
				$data['ambil_abk_pemenuhan'] = $this->m_sample->ambil_abk_pemenuhan($id_jabatan_fungsional);
				$this->load->view("isi_sample",$data);
      }
      if($mode=='simpan_pemenuhan_edit'){
		  $periodex = $this->input->post('periodex');
		  $this->m_sample->edit_abk_pemenuhan();
		  redirect(base_url('sample/abk/view/'.$periodex));
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
		$data['periode'] = set_value('periode',date('Y',strtotime($injabdet["periode"])));
		$data['id_jabatan_fungsional']  = set_value('id_jabatan_fungsional',$injabdet["id_jabatan_fungsional"]);
		$data['id_struktur_jabatan']  = set_value('id_struktur_jabatan',$injabdet["id_struktur_jabatan"]);
		$data['id_abk']  = set_value('id_abk',$injabdet["id_abk"]);
		$this->load->view("isi_sample",$data);
      }
      if($mode=='simpan_edit'){
		$id_abk = $this->input->post('id_abk');
		$id_abk_detil = $this->input->post('id_abk_detil');
		$periode = $this->input->post('periode');
		$periode_lama = $this->input->post('periode_lama');
		$tgl_periode = $periode."-01-01";
		$tgl_periode_lama = $periode_lama."-01-01";
		$id_jabatan_fungsional = $this->input->post("id_jabatan_fungsional");
		$jml = $this->m_sample->jumlah_record_filter_injab_edit($pegawai['id_ruangan'],$tgl_periode,$tgl_periode_lama,$id_jabatan_fungsional);
		if($jml == 0){
		  if($this->m_sample->edit_inform()){
			$this->m_sample->edit_inform_detil();
			redirect(base_url('sample/abk/view/'.$periode));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Penambahan Data. Hubungi Admin');
			redirect(base_url('sample/abk/view/'.$periode));
		  }
		}else{
			$this->session->set_flashdata('danger', 'Data Sudah Ada');
			redirect(base_url('sample/abk/view/'.$periode));
		}
      }
		if($mode=='pdf_evaluasi'){
			if(empty($data['id'])){ $data['id'] = date('Y'); }
		  $report = $this->load->view('cetak/sevaluasi_perencanaan', $data, TRUE);
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
	}
  }
  function normal($mode='view')
	{
		$data['page']="normal";
		$data['header'] = "HASIL NORMAL RADIOLOGI";
		$data['title'] = "HASIL NORMAL RADIOLOGI";
		$data['link_kembali'] = base_url('sample');
		$data['link_awal'] = base_url('sample/normal');
		$program    = $this->m_umum->ambil_data('a_program','id_program','1');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','4');
		$pegawai = $this->m_umum->ambil_data('s_pegawai','id_pegawai','1');
		$data['instance_id'] = $instansi["id_instansi"];
		$data['instance_name'] = $instansi["nama_instansi"];
		$data['idescription'] = $instansi["description"];
		$data['ikeywords'] = $instansi["keywords"];
		$data['iheader'] = $instansi["header"];
		$data['iheader_mini'] = $instansi["header_mini"];
		$data['ifooter'] = $instansi["footer"];
		$data['ilicensed'] = $instansi["licensed"];
		$data['member_id'] = $pegawai["id_pegawai"];
		$data['room_name'] = 'Ruangan Sample';
		$data['jabatan_id'] = '0';
		$data['member_name'] = $pegawai["nama_pegawai"];
		$data['level_name'] = 'SAMPLE';
		$data['photo'] = '';
		//======================= IMPORTANT =========================================
		if($mode=='view'){
			$this->tampil($data);
		}
		else if($mode=='data'){
			echo json_encode($this->m_sample->normal_all());
		}
	}
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("header_sample",$data);
	$this->load->view("isi_sample.php");
	$this->load->view("footer");
	$this->load->view("jsload_sample");
	$this->load->view("jscode_sample");
}
// -----------------------------------------------------------END-----------------------------------------
}
