<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');
// ALTER TABLE `ol_user` ADD `status_asesor` TINYINT UNSIGNED NOT NULL DEFAULT '0' AFTER `status_user`;
class Admin_even extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
          $this->load->model('m_ol_rancak');
          $this->load->model('m_admin_even');
          $this->load->model('m_auth');
          $this->m_auth->ol_enabled();
  }
	function index(){
		$this->even();
	}
  function even($mode='view')
  {
		$data['page']  = "even";
		$data['header'] = "DATA EVEN / KEGIATAN DENGAN ABSENSI LOKASI";
		$data['title'] = "DATA EVEN / KEGIATAN DENGAN ABSENSI LOKASI";
		$data['link_awal'] = base_url('admin_even');
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
	//======================= IMPORTANT ======================================
    if($mode=='view'){
	$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_admin_even->abs_even_all());
	}
	else{
		$data['cmd_status_even']=array('0'=>'Proses','1'=>'Pendaftaran','2'=>'Mulai Acara','3'=>'Selesai');
		$data['cmd_seen']=array('0'=>'Unshare','1'=>'Unit','2'=>'Instansi','4'=>'Profesi');
		$data['cmd_status']=$this->m_rancak->cmd_status();
		$data['cmd_struktur_jabatan']=$this->m_rancak->cmd_struktur_jabatan();
		$data['ambil_data_working'] = $this->m_ol_rancak->ambil_data_rujukan_kab_working($this->session->mas_ins);
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['tgl_even']  = set_value('tgl_even',date('d-m-Y'));
				$data['time_even']  = set_value('time_even',date('H:i'));
				$data['nama_even']  = set_value('nama_even',$this->input->post('nama_even'));
				$data['alamat_even']  = set_value('alamat_even',$this->input->post('alamat_even'));
				$data['location']  = set_value('location',$this->input->post('location_even'));
				$data['include_radius']  = set_value('include_radius',$this->input->post('include_radius'));
				$data['status_even']  = set_value('status_even',$this->input->post('status_even'));
				$data['seen_even']  = set_value('seen_even',$this->input->post('seen_even'));
				$this->load->view("admin_even/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($this->m_admin_even->simpan_abs_even()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('admin_even/even'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('admin_even/even'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('abs_even','id_even',$data['id']);
				$data['tgl_even']  = set_value('tgl_even',date('d-m-Y',strtotime($keuangan["tgl_even"])));
				$data['time_even']  = set_value('time_even',date('H:i',strtotime($keuangan["time_even"])));
				$data['id_even']  = set_value('id_even',$keuangan["id_even"]);
				$data['nama_even']  = set_value('nama_even',$keuangan["nama_even"]);
				$data['alamat_even']  = set_value('alamat_even',$keuangan["alamat_even"]);
				$data['location']  = set_value('location',$keuangan["location_even"]);
				$data['include_radius']  = set_value('include_radius',$keuangan["include_radius"]);
				$data['status_even']  = set_value('status_even',$keuangan["status_even"]);
				$data['seen_even']  = set_value('seen_even',$keuangan["seen_even"]);
				$this->load->view("admin_even/isi",$data);
      }
      if($mode=='simpan_edit'){
				  if($this->m_admin_even->edit_abs_even()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
						redirect(base_url('admin_even/even'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
						redirect(base_url('admin_even/even'));
				  }
      }
      if($mode=='even_detil'){
					$data_acara = array(
						'even_acara'     => $data['id']
					);
					$this->session->set_userdata($data_acara);	
	        redirect(base_url('admin_even/acara'));
      }
      if($mode=='even_peserta'){
					$data_acara = array(
						'even_acara'     => $data['id']
					);
					$this->session->set_userdata($data_acara);	
	        redirect(base_url('admin_even/peserta'));
      }
		}
  }
  function acara($mode='view')
  {
		$data['page']  = "acara";
		$data['header'] = "DATA ACARA UNTUK EVEN / KEGIATAN DENGAN ABSENSI LOKASI";
		$data['title'] = "DATA ACARA UNTUK EVEN / KEGIATAN DENGAN ABSENSI LOKASI";
		$data['link_awal'] = base_url('admin_even/acara');
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
	//======================= IMPORTANT ======================================
		if(empty($this->session->has_userdata('even_acara'))){
			redirect(base_url('admin_even/even'));
		}
		if(empty($this->session->has_userdata('even_acara'))){
			redirect(base_url('admin_even/even'));
		}
		$keuangan    = $this->m_umum->ambil_data('abs_even','id_even',$this->session->even_acara);
		$data['tgl_even']  = set_value('tgl_even',date('d-m-Y',strtotime($keuangan["tgl_even"])));
		$data['time_even']  = set_value('time_even',date('H:i',strtotime($keuangan["time_even"])));
		$data['id_even']  = set_value('id_even',$keuangan["id_even"]);
		$data['nama_even']  = set_value('nama_even',$keuangan["nama_even"]);
    if($mode=='view'){
			$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_admin_even->abs_even_detil_all($data['id']));
	}
  else if($mode=='hapus'){
	  if($this->m_umum->hapus_data('abs_even_detil','id_even_detil',$data['id'])){
			$this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
			redirect(base_url('admin_even/acara'));
	  }else{
			$this->session->set_flashdata('danger', 'Masalah Hapus Data');
			redirect(base_url('admin_even/acara'));
	  }
  }
	else{
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['tgl_even_detil']  = set_value('tgl_even_detil',date('d-m-Y'));
				$data['time_even_detil']  = set_value('time_even_detil',date('H:i'));
				$data['nama_even_detil']  = set_value('nama_even_detil',$this->input->post('nama_even_detil'));
				$data['speaker_even_detil']  = set_value('speaker_even_detil',$this->input->post('speaker_even_detil'));
				$data['hasil_even_detil']  = set_value('hasil_even_detil',$this->input->post('hasil_even_detil'));
				$data['kesimpulan_even_detil']  = set_value('kesimpulan_even_detil',$this->input->post('kesimpulan_even_detil'));
				$this->load->view("admin_even/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($this->m_admin_even->simpan_abs_even_detil()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('admin_even/acara'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('admin_even/acara'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('abs_even_detil','id_even_detil',$data['id']);
				$data['tgl_even_detil']  = set_value('tgl_even_detil',date('d-m-Y',strtotime($keuangan["tgl_even_detil"])));
				$data['time_even_detil']  = set_value('time_even_detil',date('H:i',strtotime($keuangan["time_even_detil"])));
				$data['nama_even_detil']  = set_value('nama_even_detil',$keuangan["nama_even_detil"]);
				$data['id_even']  = set_value('id_even',$keuangan["id_even"]);
				$data['id_even_detil']  = set_value('id_even_detil',$keuangan["id_even_detil"]);
				$data['speaker_even_detil']  = set_value('speaker_even_detil',$keuangan["speaker_even_detil"]);
				$data['hasil_even_detil']  = set_value('hasil_even_detil',$keuangan["hasil_even_detil"]);
				$data['kesimpulan_even_detil']  = set_value('kesimpulan_even_detil',$keuangan["kesimpulan_even_detil"]);

				$ev    = $this->m_umum->ambil_data('abs_even','id_even',$ev["id_even"]);
				$data['tgl_even']  = set_value('tgl_even',date('d-m-Y',strtotime($ev["tgl_even"])));
				$data['time_even']  = set_value('time_even',date('H:i',strtotime($ev["time_even"])));
				$data['id_even']  = set_value('id_even',$ev["id_even"]);
				$data['nama_even']  = set_value('nama_even',$ev["nama_even"]);
				$this->load->view("admin_even/isi",$data);
      }
      if($mode=='simpan_edit'){
				  if($this->m_admin_even->edit_abs_even_detil()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
						redirect(base_url('admin_even/acara'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
						redirect(base_url('admin_even/acara'));
				  }
      }
      if($mode=='acara_detil'){
					$data_acara = array(
						'hasil_acara'     => $data['id']
					);
					$this->session->set_userdata($data_acara);	
	        redirect(base_url('admin_even/hasil'));
      }
		}
  }
  function peserta($mode='view')
  {
		$data['page']  = "peserta";
		$data['header'] = "DATA PESERTA UNTUK EVEN / KEGIATAN DENGAN ABSENSI LOKASI";
		$data['title'] = "DATA PESERTA UNTUK EVEN / KEGIATAN DENGAN ABSENSI LOKASI";
		$data['link_awal'] = base_url('admin_even/peserta');
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
	//======================= IMPORTANT ======================================
		if(empty($this->session->has_userdata('even_acara'))){
			redirect(base_url('admin_even/even'));
		}
		$data['pegawaiee']    = $this->m_ol_rancak->ambil_data_pegawai();
		$keuangan    = $this->m_umum->ambil_data('abs_even','id_even',$this->session->even_acara);
		$data['tgl_even']  = set_value('tgl_even',date('d-m-Y',strtotime($keuangan["tgl_even"])));
		$data['time_even']  = set_value('time_even',date('H:i',strtotime($keuangan["time_even"])));
		$data['id_even']  = set_value('id_even',$keuangan["id_even"]);
		$data['nama_even']  = set_value('nama_even',$keuangan["nama_even"]);
		$data['peserta_even']  = set_value('peserta_even',$keuangan["peserta_even"]);
    if($mode=='view'){
			$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_admin_even->abs_even_peserta_all($data['id']));
	}
  else if($mode=='hapus'){
	  if($this->m_umum->hapus_data('abs_even_detil','id_even_detil',$data['id'])){
			$this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
			redirect(base_url('admin_even/acara'));
	  }else{
			$this->session->set_flashdata('danger', 'Masalah Hapus Data');
			redirect(base_url('admin_even/acara'));
	  }
  }
	else{
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$this->load->view("admin_even/isi",$data);
      }
      if($mode=='simpan_tambah'){
				  if($this->m_admin_even->simpan_peserta()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
						redirect(base_url('admin_even/peserta'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
						redirect(base_url('admin_even/peserta'));
				  }
      }
		}
  }
  function hasil($mode='view')
  {
		$data['page']  = "hasil";
		$data['header'] = "DATA ACARA UNTUK EVEN / KEGIATAN DENGAN ABSENSI LOKASI";
		$data['title'] = "DATA ACARA UNTUK EVEN / KEGIATAN DENGAN ABSENSI LOKASI";
		$data['link_awal'] = base_url('admin_even/acara');
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
	//======================= IMPORTANT ======================================
		if($this->session->has_userdata('hasil_acara')){
			$data['id'] = $this->session->hasil_acara;
		}else{
			redirect(base_url('admin_even/acara'));
		}
				$keuangan    = $this->m_umum->ambil_data('abs_even_detil','id_even_detil',$this->session->hasil_acara);
				$data['tgl_even_detil']  = set_value('tgl_even_detil',date('d-m-Y',strtotime($keuangan["tgl_even_detil"])));
				$data['time_even_detil']  = set_value('time_even_detil',date('H:i',strtotime($keuangan["time_even_detil"])));
				$data['nama_even_detil']  = set_value('nama_even_detil',$keuangan["nama_even_detil"]);
			//	$data['id_even']  = set_value('id_even',$keuangan["id_even"]);
				$data['id_even_detil']  = set_value('id_even_detil',$this->session->hasil_acara);
				$data['speaker_even_detil']  = set_value('speaker_even_detil',$keuangan["speaker_even_detil"]);
				$data['hasil_even_detil']  = set_value('hasil_even_detil',$keuangan["hasil_even_detil"]);
				$data['kesimpulan_even_detil']  = set_value('kesimpulan_even_detil',$keuangan["kesimpulan_even_detil"]);
				$ev    = $this->m_umum->ambil_data('abs_even','id_even',$keuangan["id_even"]);
				$data['tgl_even']  = set_value('tgl_even',date('d-m-Y',strtotime($ev["tgl_even"])));
				$data['time_even']  = set_value('time_even',date('H:i',strtotime($ev["time_even"])));
				$data['id_even']  = set_value('id_even',$ev["id_even"]);
				$data['nama_even']  = set_value('nama_even',$ev["nama_even"]);
    if($mode=='view'){
    		$this->form_validation->set_rules('id_even_detil','id_even_detil','required');
        if ($this->form_validation->run() === FALSE){
			       $this->tampil($data);
        }else{
				  if($this->m_admin_even->edit_abs_even_hasil_detil()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
						redirect(base_url('admin_even/hasil'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
						redirect(base_url('admin_even/hasil'));
				  }
		    }
		}
  }
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("admin_even/header",$data);
	$this->load->view("admin_even/isi");
	$this->load->view("footer");
	$this->load->view("admin_even/jsload");
	$this->load->view("admin_even/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_topol",$data);
	$this->load->view("admin_even/isi");
	$this->load->view("footer");
	$this->load->view("admin_even/jsload");
	$this->load->view("admin_even/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
