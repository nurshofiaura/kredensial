<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Jadwal_all extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
      parent::__construct();
		  $this->load->model('m_ol_rancak');
      $this->load->model('m_jadwal');
      $this->load->model('m_member');
      $this->load->model('m_instansi_user');
      $this->load->model('m_auth');
		  $this->m_auth->hak_member();
  }
  function login_kah()
  {
      if ( $this->session->has_userdata('id_pegawai') )
					if($this->session->refer > 0 OR $this->session->unit > 0){
						return TRUE;
					}else{
						$this->session->set_flashdata('danger', 'Unit dan Instansi Belum di set, Hubungi Admin');
						redirect(base_url('member'));
					}
     else
          redirect(base_url('logout'));
  }
  function index(){
	  $this->lihat_jadwal();
  }
  function lihat_jadwal($mode='view')
  {
    $data['page']="lihat_jadwal";
	$data['link_kembali'] = base_url($this->session->beranda);
	$data['link_awal'] = base_url('jadwal_all/chat');
	$data['link_daftar'] = base_url('jadwal_all/daftar_tindakan');
	$data['link_tambahan'] = base_url('jadwal_all/pengambilan');
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
	$uni = $this->m_umum->ambil_data('ol_unit','id_unit',$this->session->unit);
	$data['unit_name'] = $uni['nama_unit'];
	$data['header'] = "JADWAL DINAS Bulan ".$this->m_rancak->getBulan($data['bulan'])." / Tahun ".$data['tahun'];
	$data['title'] = "JADWAL DINAS <b>Bulan ".$this->m_rancak->getBulan($data['bulan'])." / Tahun ".$data['tahun']."</b>";
	$data['cmd_year']  = array('1'=>'Januari','2'=>'Februari','3'=>'Maret','4'=>'April','5'=>'Mei','6'=>'Juni',
			'7'=>'Juli','8'=>'Agustus','9'=>'September','10'=>'Oktober','11'=>'Nopember','12'=>'Desember');
	$data['ambil_data_pegawai'] = $this->m_jadwal->ambil_data_pegawai($this->session->unit);
    if($mode=='view'){
		$namaBulan = $this->m_rancak->getBulan($data['bulan']);
		$data['title'] = "Jadwal Dinas Bulan ".$namaBulan." ".$data['tahun'];
		$kondisi=array('bulan'=>$data['bulan'],'tahun'=>$data['tahun'],'id_unit'=>$uni['id_unit']);
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
			redirect(base_url('jadwal_all/lihat_jadwal/view/'.$bulan.'/'.$tahun));
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
  }
  function chat($mode='view')
  {
    $data['page']="chat";
	$data['header'] = "LAPORAN JAGA DINAS";
	$data['title'] = "LAPORAN JAGA DINAS";
	$data['link_kembali'] = base_url($this->session->beranda);
	$data['link_awal'] = base_url('jadwal_all/lihat_jadwal');
	$data['link_daftar'] = base_url('jadwal_all/daftar_tindakan');
	$data['link_tambahan'] = base_url('jadwal_all/pengambilan');
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
	$unitku = $this->m_umum->ambil_data('ol_unit','id_unit',$this->session->unit);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$stpeg = $this->m_umum->ambil_data('a_online','kode_online','ol_status_pegawai');
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
	$data['cmd_year']  = array('0'=>'PILIH BULAN','1'=>'Januari','2'=>'Februari','3'=>'Maret','4'=>'April','5'=>'Mei','6'=>'Juni',
			'7'=>'Juli','8'=>'Agustus','9'=>'September','10'=>'Oktober','11'=>'Nopember','12'=>'Desember');
		$data['isi_chat']  = set_value('isi_chat',$unitku["format_laporan_jaga"]);
//=========================================
	$data['first_date']   = $this->uri->segment(4, 0);
	$data['last_date']   = $this->uri->segment(5, 0);
		if(empty($data['first_date'])){
			$data['first_date'] = '01-'.date('m-Y');
		}
		if(empty($data['last_date'])){
			$data['last_date'] = date('d-m-Y');
		}
    if($mode=='view'){
    			$this->tampil_top($data);
	 		$action = $this->input->post('action');
			if($action == 'BtnProses') {
			  	$this->m_jadwal->simpan_chat();
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('jadwal_all/chat'));
			} 
			if($action == 'BtnCari') {
				$first_date = $this->input->post("first_date");
				$last_date = $this->input->post("last_date");
				redirect(base_url('jadwal_all/chat/view/'.$first_date.'/'.$last_date));
			}
		}
    else if($mode=='data'){
		echo json_encode($this->m_jadwal->chat_all($data['first_date'],$data['last_date']));
		}
	  else if($mode=='hapus'){
		  if($this->m_umum->hapus_data('chat','id_chat',$data['first_date'])){
				$this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
				redirect(base_url('jadwal_all/pengambilan'));
		  }else{
				$this->session->set_flashdata('danger', 'Masalah Hapus Data');
				redirect(base_url('jadwal_all/pengambilan'));
		  }
	  }
		else{
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('chat','id_chat',$data['first_date']);
				$data['id_chat']  = set_value('id_chat',$keuangan["id_chat"]);
				$data['isi_chat']  = set_value('isi_chat',$keuangan["isi_chat"]);
				$data['id_pegawai']  = set_value('id_pegawai',$keuangan["id_pegawai"]);
				$this->load->view("jadwal/isi",$data);
      }
      if($mode=='simpan_edit'){
      	$id_pegawai = $this->input->post("id_pegawai");
      	if($id_pegawai == $this->session->id_pegawai){
				  if($this->m_jadwal->edit_chat()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
						redirect(base_url('jadwal_all/chat'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
						redirect(base_url('jadwal_all/chat'));
				  }
				}else{
						$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Laporannya Sendiri');
						redirect(base_url('jadwal_all/chat'));					
				}
      }
		}
  }
  function pasien($mode='view')
  {
    $data['page']="pasien";
	$data['header'] = "DATA PASIEN";
	$data['title'] = "DATA PASIEN";
	$data['link_kembali'] = base_url($this->session->beranda);
	$data['link_awal'] = base_url('jadwal_all/lihat_jadwal');
	$data['link_daftar'] = base_url('jadwal_all/daftar_tindakan');
	$data['link_tambahan'] = base_url('jadwal_all/pengambilan');
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
	$unitku = $this->m_umum->ambil_data('ol_unit','id_unit',$this->session->unit);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$stpeg = $this->m_umum->ambil_data('a_online','kode_online','ol_status_pegawai');
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
//=========================================
    if($mode=='view'){
    			$this->tampil_top($data);
		}
    else if($mode=='data'){
		echo json_encode($this->m_jadwal->pasien_all());
		}else{
			$data['cmd_jk']    = $this->m_rancak->cmd_jk();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['tgl_lahir']  = set_value('tgl_lahir',date('d-m-Y'));
				$data['rm']  = set_value('rm',$this->input->post("rm"));
				$data['nama_pasien']  = set_value('nama_pasien',$this->input->post("nama_pasien"));
				$data['jk']  = set_value('jk',$this->input->post("jk"));
				$data['alamat']  = set_value('alamat',$this->input->post("alamat"));
				$this->load->view("jadwal/isi",$data);
      }
      if($mode=='simpan_tambah'){
      	if($this->m_jadwal->simpan_ol_pasien()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('jadwal_all/pasien'));   		
				}else{
				  	$this->m_jadwal->simpan_ol_lpasien();
						$this->session->set_flashdata('danger', 'Ada keslahan Simpan data');
						redirect(base_url('jadwal_all/pasien'));			
				}
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$id = $this->uri->segment(4, 0);
				$keuangan    = $this->m_umum->ambil_data('ol_pasien','id_pasien',$id);
				$data['id_pasien']  = set_value('id_pasien',$keuangan["id_pasien"]);
				$data['tgl_lahir']  = set_value('tgl_lahir',date('d-m-Y', strtotime($keuangan["tgl_lahir"])));
				$data['rm']  = set_value('rm',$keuangan["rm"]);
				$data['nama_pasien']  = set_value('nama_pasien',$keuangan["nama_pasien"]);
				$data['jk']  = set_value('jk',$keuangan["jk"]);
				$data['alamat']  = set_value('alamat',$keuangan["alamat"]);
				$this->load->view("jadwal/isi",$data);
      }
      if($mode=='simpan_edit'){
      	if($this->m_jadwal->rubah_ol_pasien()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('jadwal_all/pasien'));   		
				}else{
				  	$this->m_jadwal->simpan_ol_lpasien();
						$this->session->set_flashdata('danger', 'Ada keslahan edit data');
						redirect(base_url('jadwal_all/pasien'));			
				}
      }
		}
  }
  function pasien_cari_data(){
    $id=$this->input->get('query');
    $hasil=array();
    $data=$this->m_ol_rancak->cmd_pasien($id);
    $hasil['suggestions']=$data;
    echo json_encode($hasil);
  }
  function rm_cari_data(){
    $id=$this->input->get('query');
    $hasil=array();
    $data=$this->m_member->cmd_rm($id);
    $hasil['suggestions']=$data;
    echo json_encode($hasil);
  }
/*  function daftar_tindakan($mode='view')
  {
    $data['page']="daftar_tindakan";
	$data['header'] = "DATA PENDAFTARAN TINDAKAN / PEMERIKSAAN";
	$data['title'] = "DATA PENDAFTARAN TINDAKAN / PEMERIKSAAN";
	$data['link_kembali'] = base_url($this->session->beranda);
	$data['link_awal'] = base_url('jadwal_all/lihat_jadwal');
	$data['link_daftar'] = base_url('jadwal_all/chat');
	$data['link_tambahan'] = base_url('jadwal_all/pengambilan');
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
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
	$data['cmd_year']  = array('0'=>'PILIH TAHUN','1'=>'Januari','2'=>'Februari','3'=>'Maret','4'=>'April','5'=>'Mei','6'=>'Juni',
			'7'=>'Juli','8'=>'Agustus','9'=>'September','10'=>'Oktober','11'=>'Nopember','12'=>'Desember');
	$data['ambil_golongan'] = $this->m_ol_rancak->cmd_golongan_pemeriksaan_null();
//=========================================
		$data['first_date'] = $this->uri->segment(4, 0);
		$data['last_date'] = $this->uri->segment(5, 0);
	if(empty($data['first_date'])){
		if($this->session->has_userdata('first_date_daftar')){
			$data['first_date'] = $this->session->first_date_daftar;
		}else{
			$data['first_date'] = date('d-m-Y');
		}
	}
	if(empty($data['last_date'])){
		if($this->session->has_userdata('last_date_daftar')){
			$data['last_date'] = $this->session->last_date_daftar;
		}else{
			$data['last_date'] = date('d-m-Y');
		}
	}
	$data['id']   = $this->uri->segment(6, 0);
	$kondizi = array('td.unit_tindakan'=>$this->session->unit);
	$data['ambil_data_daftar_tgl']=$this->m_jadwal->ambil_data_daftar_range($data['first_date'],$data['last_date'],$data['id'],$kondizi,'tgl_daftar');
    if($mode=='view'){
  		$this->tampil_top($data);
	 		$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$first_date = $this->input->post("first_date");
				$last_date = $this->input->post("last_date");
				$id = $this->input->post("id_tindakan");
				$data_user_level = array(
					'first_date_daftar'     => $first_date,
					'last_date_daftar'     => $last_date
				);	
				$this->session->set_userdata($data_user_level);
				redirect(base_url('jadwal_all/daftar_tindakan/view/'.$first_date.'/'.$last_date.'/'.$id));
			}
		}
    else if($mode=='data'){
		echo json_encode($this->m_jadwal->daftar_all($data['first_date'],$data['last_date'],$data['id']));
		}
	  else if($mode=='hapus'){
		  if($this->m_umum->hapus_data('daftar_tindakan','id_daftar',$data['first_date'])){
				$this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
				redirect(base_url('jadwal_all/pengambilan'));
		  }else{
				$this->session->set_flashdata('danger', 'Masalah Hapus Data');
				redirect(base_url('jadwal_all/pengambilan'));
		  }
	  }
		else{
			$data['cmd_jk']    = $this->m_rancak->cmd_jk();
			$data['cmd_tindakan']=$this->m_ol_rancak->cmd_tindakan();
			$data['cmd_dokter']=$this->m_ol_rancak->cmd_rujukan_dokter();
			$data['cmd_unit']=$this->m_ol_rancak->ambil_data_unit_instansi_member();
			$data['status']=array('0'=>'Proses','1'=>'Selesai','2'=>'Batal');
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['id_tindakan']  = set_value('id_tindakan',$this->input->post("id_tindakan"));
				$data['tgl_daftar']  = set_value('tgl_daftar',date('d-m-Y'));
				$data['tgl_lahir']  = set_value('tgl_lahir',date('d-m-Y'));
				$data['rm']  = set_value('rm',$this->input->post("rm"));
				$data['nama_pasien']  = set_value('nama_pasien',$this->input->post("nama_pasien"));
				$data['jk']  = set_value('jk',$this->input->post("jk"));
				$data['unit_pengirim']  = set_value('unit_pengirim',$this->input->post("unit_pengirim"));
				$data['pasien_daftar']  = set_value('pasien_daftar',$this->input->post("pasien_daftar"));
				$data['dr_tindakan']  = set_value('dr_tindakan',$this->input->post("dr_tindakan"));
				$data['dr_pengirim']  = set_value('dr_pengirim',$this->input->post("dr_pengirim"));
				$this->load->view("jadwal/isi",$data);
      }
      if($mode=='simpan_tambah'){
      	$id_tindakan = $this->input->post("id_tindakan");
      	$dr_tindakan = $this->input->post("dr_tindakan");
      	$unit_pengirim = $this->input->post("unit_pengirim");
      	$dr_pengirim = $this->input->post("dr_pengirim");
      	if(empty($id_tindakan) OR empty($dr_tindakan) OR empty($unit_pengirim) OR empty($dr_pengirim)){
						$this->session->set_flashdata('danger', 'Data Belum Lengkap');
						redirect(base_url('jadwal_all/daftar_tindakan'));      		
				}else{
				  	$this->m_jadwal->simpan_ol_lpasien();
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
						redirect(base_url('jadwal_all/daftar_tindakan'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
						redirect(base_url('jadwal_all/daftar_tindakan'));
				  }				
				}
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$first_date = $this->uri->segment(4, 0);
				$keuangan    = $this->m_umum->ambil_data('tindakan_daftar','id_daftar',$first_date);
				$data['id_daftar']  = set_value('id_daftar',$keuangan["id_daftar"]);
				$data['pendaftar']  = set_value('pendaftar',$keuangan["pendaftar"]);
				$data['id_tindakan']  = set_value('id_tindakan',$keuangan["id_tindakan"]);
				$data['pasien_daftar']  = set_value('pasien_daftar',$keuangan["pasien_daftar"]);
				$data['tgl_daftar']  = set_value('tgl_daftar',date('d-m-Y',strtotime($keuangan["tgl_daftar"])));
				$data['unit_pengirim']  = set_value('unit_pengirim',$keuangan["unit_pengirim"]);
				$data['dr_tindakan']  = set_value('dr_tindakan',$keuangan["dr_tindakan"]);
				$data['dr_pengirim']  = set_value('dr_pengirim',$keuangan["dr_pengirim"]);
				$pse = $this->m_umum->ambil_data('ol_pasien','id_pasien',$keuangan["id_pasien"]);
				$data['tgl_lahir']  = set_value('tgl_lahir',date('d-m-Y', strtotime($pse["tgl_lahir"])));
				$data['rm']  = set_value('rm',$pse["rm"]);
				$data['nama_pasien']  = set_value('nama_pasien',$pse["nama_pasien"]);
				$data['jk']  = set_value('jk',$pse["jk"]);
				$this->load->view("jadwal/isi",$data);
      }
      if($mode=='simpan_edit'){
      	$id_tindakan = $this->input->post("id_tindakan");
      	$dr_tindakan = $this->input->post("dr_tindakan");
      	$unit_pengirim = $this->input->post("unit_pengirim");
      	$dr_pengirim = $this->input->post("dr_pengirim");
      	if(empty($id_tindakan) OR empty($dr_tindakan) OR empty($unit_pengirim) OR empty($dr_pengirim)){
						$this->session->set_flashdata('danger', 'Data Belum Lengkap');
						redirect(base_url('jadwal_all/daftar_tindakan'));	
				}else{
    //  	if($id_pegawai == $this->session->id_pegawai){
				  	$this->m_jadwal->rubah_ol_lpasien();
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
						redirect(base_url('jadwal_all/daftar_tindakan'));
			  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
						redirect(base_url('jadwal_all/daftar_tindakan'));
				  }
				}else{
						$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Laporannya Sendiri');
						redirect(base_url('jadwal_all/daftar_tindakan'));					
				}				
				}
      }
      if($mode=='hasil'){
        $data['page'] =  $data['page']."_hasil";
        $first_date = $this->uri->segment(4, 0);
				$keuangan    = $this->m_umum->ambil_data('tindakan_daftar','id_daftar',$first_date);
				$data['id_daftar']  = set_value('id_daftar',$keuangan["id_daftar"]);
				$data['pendaftar']  = set_value('pendaftar',$keuangan["pendaftar"]);
				$data['hasil']  = set_value('hasil',$keuangan["hasil"]);
				$data['status_daftar']  = set_value('status_daftar',$keuangan["status_daftar"]);
				$this->load->view("jadwal/isi",$data);
      }
      if($mode=='simpan_hasil'){
      	$id_pegawai = $this->input->post("id_pegawai");
    //  	if($id_pegawai == $this->session->id_pegawai){
				  if($this->m_jadwal->edit_hasil()){
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
						redirect(base_url('jadwal_all/daftar_tindakan'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
						redirect(base_url('jadwal_all/daftar_tindakan'));
				  }
				}else{
						$this->session->set_flashdata('danger', 'Hanya Bisa Rubah Laporannya Sendiri');
						redirect(base_url('jadwal_all/daftar_tindakan'));					
				}
      }
		}
  }*/
  function pengambilan($mode='view')
  {
    $data['page']="pengambilan";
	$data['header'] = "DATA PENGAMBILAN TINDAKAN / PEMERIKSAAN";
	$data['title'] = "DATA PENGAMBILAN TINDAKAN / PEMERIKSAAN";
	$data['link_kembali'] = base_url($this->session->beranda);
	$data['link_awal'] = base_url('jadwal_all/lihat_jadwal');
	$data['link_daftar'] = base_url('jadwal_all/chat');
	$data['link_tambahan'] = base_url('jadwal_all/daftar_tindakan');
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
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
	$data['cmd_year']  = array('0'=>'PILIH TAHUN','1'=>'Januari','2'=>'Februari','3'=>'Maret','4'=>'April','5'=>'Mei','6'=>'Juni',
			'7'=>'Juli','8'=>'Agustus','9'=>'September','10'=>'Oktober','11'=>'Nopember','12'=>'Desember');
	$data['ambil_golongan'] = $this->m_ol_rancak->cmd_golongan_pemeriksaan_null();
			$data['cmd_jk']    = $this->m_rancak->cmd_jk();
			$data['cmd_tindakan']=$this->m_ol_rancak->cmd_tindakan();
			$data['cmd_dokter']=$this->m_ol_rancak->cmd_rujukan_dokter();
			$data['cmd_unit']=$this->m_ol_rancak->ambil_data_unit_instansi_member();
			$data['status']=array('1'=>'Pengambilan Hasil','2'=>'Pinjam Basah');
//=========================================
		$data['first_date'] = $this->uri->segment(4, 0);
		$data['last_date'] = $this->uri->segment(5, 0);
    $trim_keyword   = urldecode(trim($this->uri->segment(6, 0)));
		$replace_keyword   = preg_replace('/\s+/', ' ', $trim_keyword);
		$data['key'] = str_replace(' ', '-', $replace_keyword);
		if($data['key'] == NULL OR empty($data['key'])){
			$data['key'] = "";
		}
	if(empty($data['first_date'])){
		if($this->session->has_userdata('first_date_ambil')){
			$data['first_date'] = $this->session->first_date_ambil;
		}else{
			$data['first_date'] = date('d-m-Y');
		}
	}
	if(empty($data['last_date'])){
		if($this->session->has_userdata('last_date_ambil')){
			$data['last_date'] = $this->session->last_date_ambil;
		}else{
			$data['last_date'] = date('d-m-Y');
		}
	}
    if($mode=='view'){
  		$this->tampil_top($data);
	 		$action = $this->input->post('action');
			if($action == 'BtnProses') {
				$first_date = $this->input->post("first_date");
				$last_date = $this->input->post("last_date");
				$id = $this->input->post("id_tindakan");
				$data_user_level = array(
					'first_date_ambil'     => $first_date,
					'last_date_ambil'     => $last_date
				);	
				$this->session->set_userdata($data_user_level);
        $trim_keyword   = urldecode(trim($this->input->post("key")));
  			$replace_keyword   = preg_replace('/\s+/', ' ', $trim_keyword);
  			$key = str_replace(' ', '-', $replace_keyword);
				redirect(base_url('jadwal_all/pengambilan/view/'.$first_date.'/'.$last_date.'/'.$key));
			}
		}
    else if($mode=='data'){
			$key = urldecode(trim($this->uri->segment(6, 0)));
			$key = strtolower($key);
			$key = preg_replace('/[^A-Za-z0-9\-]/', '', $key);
			$key = str_replace(' ', '-', $key);
		echo json_encode($this->m_jadwal->pengambilan_all($data['first_date'],$data['last_date'],$key));
		}
  else if($mode=='hapus'){
	  if($this->m_umum->hapus_data('tindakan_ambil','id_ambil',$data['first_date'])){
			$this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
			redirect(base_url('jadwal_all/pengambilan'));
	  }else{
			$this->session->set_flashdata('danger', 'Masalah Hapus Data');
			redirect(base_url('jadwal_all/pengambilan'));
	  }
  }
		else{
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
					if($this->session->has_userdata('id_tindakan')){
						$data['id_tindakan'] = $this->session->id_tindakan;
					}else{
						$data['id_tindakan']  = set_value('id_tindakan',$this->input->post("id_tindakan"));				
					}
					if($this->session->has_userdata('nama_pengambil')){
						$data['nama_pengambil'] = $this->session->nama_pengambil;
					}else{
						$data['nama_pengambil']  = set_value('nama_pengambil',$this->input->post("nama_pengambil"));				
					}
					$data['tgl_ambil']  = set_value('tgl_ambil',date('d-m-Y'));
					$data['tgl_lahir']  = set_value('tgl_lahir',date('d-m-Y'));
					$data['rm']  = set_value('rm',$this->input->post("rm"));
					$data['nama_pasien']  = set_value('nama_pasien',$this->input->post("nama_pasien"));
					$data['alamat']  = set_value('alamat',$this->input->post("alamat"));
					$data['jk']  = set_value('jk',$this->input->post("jk"));
					if($this->session->has_userdata('unit_pengirim')){
						$data['unit_pengirim'] = $this->session->unit_pengirim;
					}else{
						$data['unit_pengirim']  = set_value('unit_pengirim',$this->input->post("unit_pengirim"));				
					}
					if($this->session->has_userdata('dr_tindakan')){
						$data['dr_tindakan'] = $this->session->dr_tindakan;
					}else{
						$data['dr_tindakan']  = set_value('dr_tindakan',$this->input->post("dr_tindakan"));				
					}
					if($this->session->has_userdata('dr_pengirim')){
						$data['dr_pengirim'] = $this->session->dr_pengirim;
					}else{
						$data['dr_pengirim']  = set_value('dr_pengirim',$this->input->post("dr_pengirim"));				
					}
					$data['status_ambil']  = set_value('status_ambil',$this->input->post("status_ambil"));
				$this->load->view("jadwal/isi",$data);
      }
      if($mode=='simpan_tambah'){
				$rm = $this->input->post("rm");
				$nama_pasien = $this->input->post("nama_pasien");
				$id_tindakan = $this->input->post("id_tindakan");
				if(!empty($rm) && !empty($nama_pasien) && !empty($id_tindakan)){
			  	$this->m_jadwal->simpan_pengambilan();
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
					redirect(base_url('jadwal_all/pengambilan'));		
				}else{
						$this->session->set_flashdata('danger', 'Data Pasien Tidak Boleh Kosong');
						redirect(base_url('jadwal_all/pengambilan'));					
				}
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$first_date = $this->uri->segment(4, 0);
				$keuangan    = $this->m_umum->ambil_data('tindakan_ambil','id_ambil',$first_date);
				$data['id_ambil']  = set_value('id_ambil',$keuangan["id_ambil"]);
				$data['id_pasien']  = set_value('id_pasien',$keuangan["id_pasien"]);
				$data['nama_pasien']  = set_value('nama_pasien',$keuangan["nama_pasien"]);
				$data['rm']  = set_value('rm',$keuangan["rm"]);
				$data['jk']  = set_value('jk',$keuangan["jk"]);
				$data['id_tindakan']  = set_value('id_tindakan',$keuangan["id_tindakan"]);
				$data['tgl_ambil']  = set_value('tgl_ambil',date('d-m-Y',strtotime($keuangan["tgl_ambil"])));
				$data['unit_pengirim']  = set_value('unit_pengirim',$keuangan["unit_pengirim"]);
				$data['dr_tindakan']  = set_value('dr_tindakan',$keuangan["dr_tindakan"]);
				$data['dr_pengirim']  = set_value('dr_pengirim',$keuangan["dr_pengirim"]);
				$data['tgl_lahir']  = set_value('tgl_lahir',date('d-m-Y', strtotime($keuangan["tgl_lahir"])));
				$data['alamat']  = set_value('alamat',$keuangan["alamat"]);
				$data['status_ambil']  = set_value('status_ambil',$keuangan["status_ambil"]);
				$data['nama_pengambil']  = set_value('nama_pengambil',$keuangan["nama_pengambil"]);
				$data['id_pegawai']  = set_value('id_pegawai',$keuangan["statuser"]);
				$this->load->view("jadwal/isi",$data);
      }
      if($mode=='simpan_edit'){
				$rm = $this->input->post("rm");
				$nama_pasien = $this->input->post("nama_pasien");
				$id_tindakan = $this->input->post("id_tindakan");
				if(!empty($rm) && !empty($nama_pasien) && !empty($id_tindakan)){
			  	$this->m_jadwal->rubah_pengambilan();
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
					redirect(base_url('jadwal_all/pengambilan'));		
				}else{
						$this->session->set_flashdata('danger', 'Data Pasien Tidak Boleh Kosong');
						redirect(base_url('jadwal_all/pengambilan'));					
				}
      }
      if($mode=='tabel'){
        $data['page'] =  $data['page']."_tabel";
				$this->load->view("jadwal/isi",$data);
      }
		}
  }
  function tindakan($mode='view')
  {
		$data['page']  = "tindakan";
		$data['header'] = "DATA TINDAKAN / PEMERIKSAAN";
		$data['title'] = "DATA TINDAKAN / PEMERIKSAAN";
	$data['link_kembali'] = base_url('jadwal_all/daftar_tindakan');
	$data['link_awal'] = base_url('jadwal_all/lihat_jadwal');
	$data['link_daftar'] = base_url('jadwal_all/chat');
	$data['link_tambahan'] = base_url('jadwal_all/pengambilan');
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
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
	$this->tampil_top($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_instansi_user->tindakan_all());
	}
	else{
		$data['cmd_status']=$this->m_rancak->cmd_status();
		$data['ambil_golongan'] = $this->m_ol_rancak->cmd_golongan_pemeriksaan();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
				$data['id_golongan_pemeriksaan']  = set_value('id_golongan_pemeriksaan',$this->input->post('id_golongan_pemeriksaan'));
				$data['nama_tindakan']  = set_value('nama_tindakan',$this->input->post('nama_tindakan'));
				$data['status_tindakan']  = set_value('status_tindakan',$this->input->post('status_tindakan'));
				$data['tarif']  = set_value('tarif',$this->input->post('tarif'));
				$this->load->view("jadwal/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($Q = $this->m_jadwal->simpan_tindakan()){
			  	$this->m_jadwal->cek_tarif($Q);
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('jadwal_all/tindakan'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('jadwal_all/tindakan'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('tindakan','id_tindakan',$data['id']);
				$data['id_tindakan']  = set_value('id_tindakan',$keuangan["id_tindakan"]);
				$data['id_golongan_pemeriksaan']  = set_value('id_golongan_pemeriksaan',$keuangan["id_golongan_pemeriksaan"]);
				$data['nama_tindakan']  = set_value('nama_tindakan',$keuangan["nama_tindakan"]);
				$data['status_tindakan']  = set_value('status_tindakan',$keuangan["status_tindakan"]);
				$kondisi = array('id_tindakan'=>$data['id']);
				$jml = $this->m_umum->jumlah_record_filter('tindakan_tarif',$kondisi);
				if($jml == 0){
					$data['tarif']  = set_value('tarif','0');
				}else{
					$tarf = $this->m_umum->ambil_data('tindakan_tarif','id_tindakan',$data['id']);
					$data['tarif']  = set_value('tarif',number_format($tarf["tarif"]));
				}
				$this->load->view("jadwal/isi",$data);
      }
      if($mode=='simpan_edit'){
      		$id_tindakan = $this->input->post("id_tindakan");
				  if($this->m_jadwal->edit_tindakan()){
				  	$this->m_jadwal->cek_tarif($id_tindakan);
						$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
						redirect(base_url('jadwal_all/tindakan'));
				  }else{
						$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
						redirect(base_url('jadwal_all/tindakan'));
				  }
      }
		}
  }
    function pengirim($mode='view')
  {
	$data['page']  = "pengirim";
	$data['header'] = "DATA DOKTER";
	$data['title'] = "DATA DOKTER";
	$data['link_kembali'] = base_url('jadwal_all/daftar_tindakan');
	$data['link_awal'] = base_url('jadwal_all/lihat_jadwal');
	$data['link_daftar'] = base_url('jadwal_all/chat');
	$data['link_tambahan'] = base_url('jadwal_all/pengambilan');
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
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
	$this->tampil_top($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_instansi_user->rujukan_all());
	}
	else{
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		    $data['kab']=array("");
		    $data['kec']=array("");
		    $data['kel']=array("");
				$data['nama_rujukan_dokter']  = set_value('nama_rujukan_dokter',$this->input->post('nama_rujukan_dokter'));
				$data['alamat_rujukan_dokter']  = set_value('alamat_rujukan_dokter',$this->input->post('alamat_rujukan_dokter'));
				$data['email_rujukan_dokter']  = set_value('email_rujukan_dokter',$this->input->post('email_rujukan_dokter'));
				$data['kontak_rujukan_dokter']  = set_value('kontak_rujukan_dokter',$this->input->post('kontak_rujukan_dokter'));
				$data['id_prov']  = set_value('id_prov',$this->input->post('id_prov'));
	  		$data['id_kab']  = set_value('id_kab',$this->input->post('id_kab'));
	  		$data['id_kel']  = set_value('id_kel',$this->input->post('id_kel'));
	  		$data['id_kec']  = set_value('id_kec',$this->input->post('id_kec'));
				$this->load->view("jadwal/isi",$data);
      }
      if($mode=='simpan_tambah'){
			  if($this->m_instansi_user->simpan_rujukan_dokter()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('jadwal_all/pengirim'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
					redirect(base_url('jadwal_all/pengirim'));
			  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('kol_rujukan_dokter','id_rujukan_dokter',$data['id']);
    		$data['kab'] = $this->m_ol_rancak->ambil_data_dropdown_kab($keuangan['id_prov']);
    		$data['kec'] = $this->m_ol_rancak->ambil_data_dropdown_kec($keuangan['id_kab']);
    		$data['kel'] = $this->m_ol_rancak->ambil_data_dropdown_kel($keuangan['id_kec']);
				$data['nama_rujukan_dokter']  = set_value('nama_rujukan_dokter',$keuangan["nama_rujukan_dokter"]);
				$data['id_rujukan_dokter']  = set_value('id_rujukan_dokter',$keuangan["id_rujukan_dokter"]);
				$data['alamat_rujukan_dokter']  = set_value('alamat_rujukan_dokter',$keuangan["alamat_rujukan_dokter"]);
				$data['email_rujukan_dokter']  = set_value('email_rujukan_dokter',$keuangan["email_rujukan_dokter"]);
				$data['kontak_rujukan_dokter']  = set_value('kontak_rujukan_dokter',$keuangan["kontak_rujukan_dokter"]);
				$data['id_prov']  = set_value('id_prov',$keuangan["id_prov"]);
				$data['id_kab']  = set_value('id_kab',$keuangan["id_kab"]);
				$data['id_kel']  = set_value('id_kel',$keuangan["id_kel"]);
				$data['id_kec']  = set_value('id_kec',$keuangan["id_kec"]);
				$this->load->view("jadwal/isi",$data);
      }
      if($mode=='simpan_edit'){
			  if($this->m_instansi_user->edit_rujukan_dokter()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
					redirect(base_url('jadwal_all/pengirim'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
					redirect(base_url('jadwal_all/pengirim'));
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
