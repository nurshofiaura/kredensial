<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Ol_validasi extends MY_Controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
    parent::__construct();
    $this->load->model('m_ol_rancak');
    $this->load->model('m_ol_validasi');
    $this->load->model('m_auth');
    $this->m_auth->validator();
  }
	function index(){
		$data['page']="home";
		$data['header'] = "BERANDA";
		$data['title'] = "BERANDA";
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
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
	//	$this->tampil_top($data);
		$this->validasi();
	}
	function validasi($mode='view'){
		$data['page']="validasi"; 
		$data['header'] = "VALIDASI KEGIATAN LOGBOOK PEGAWAI / USER";
		$data['title'] = "DATA KEWENANGAN YANG BELUM TERVALIDASI";
  		$data['link_awal'] = base_url('ol_validasi');
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
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
		$data['jeson'] = $this->m_ol_validasi->ambil_data_pegawai_dttb();		
		//======================= IMPORTANT =========================================
		$data['id']   = $this->uri->segment(4, 0);
		$data['id2']   = $this->uri->segment(5, 0);
		$data['id3']   = $this->uri->segment(6, 0);
		if($mode=='view'){
			$this->tampil_ra($data);
		}
		if($mode=='data'){
     $dt = $this->datatable_request();
     $res = $this->m_ol_validasi->datatable_pegawai($dt);

     $this->datatable_response(
         $dt['draw'],
         $res['total'],
         $res['filtered'],
         $res['data']
     );
		}
		if($mode=='logbook'){
    $barcode = trim($this->input->post('barcode_pegawai'));

    if ($barcode === '') {
        return $this->datatable_response_empty();
    }

    $dt  = $this->datatable_request();
    $res = $this->m_ol_validasi->datatable_logbook_pegawai($barcode, $dt);

    $this->datatable_response(
        $dt['draw'],
        $res['total'],
        $res['filtered'],
        $res['data']
    );
		}
		else{
		   $data['rkk'] = $this->m_rancak->cmd_status_rkk();
		   $data['sifat_kewenangan'] = $this->m_ol_rancak->cmd_sifat_kewenangan();
		if($mode=='validasi'){
			$data['page'] =  $data['page']."_validasi";
			$d	= $this->m_ol_validasi->cek_pegawai($data['id']);
			if($d == 0){
				redirect(base_url('member'));
			}
			if(empty($data['id'])){
				redirect(base_url('ol_validasi'));
			}
			$this->tampil_top($data);
	  	}
    if($mode=='rkk'){
      $data['page'] =  $data['page']."_rkk";
      $kondisi = array('id_logbooker'=>$data['id2'],'id_kewenangan'=>$data['id']);
      $apk = $this->m_umum->ambil_data_kondisi('ol_logbook',$kondisi,'id_kewenangan');
      $peg = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$apk["id_logbooker"]);
      $data['barcode_pegawai']  = $peg["barcode_pegawai"];
      $data['rkk'] = $this->m_rancak->cmd_status_rkk();
      $data['statuse'] = $this->m_rancak->cmd_status();
      $data['id_sifat_kewenangan']  = set_value('id_sifat_kewenangan',$data['id3']);
      $data['status_validasi']  = set_value('status_validasi',$this->input->post("status_validasi"));
      $this->load->view("ol_validasi/isi",$data);
    }
    if($mode=='simpan_rkk'){
     $id_sifat_kewenangan=$this->input->post('id_sifat_kewenangan');
     $id_kewenangan=$this->input->post('id_kewenangan');
     $barcode_pegawai=$this->input->post('barcode_pegawai');
     $kondisi2=array('barcode_pegawai'=>$barcode_pegawai,'id_kewenangan'=>$id_kewenangan);
     $kondisi=array('barcode_pegawai'=>$barcode_pegawai,'id_kewenangan'=>$id_kewenangan,'id_sifat_kewenangan'=>$id_sifat_kewenangan);
     $jml2 = $this->m_umum->jumlah_record_filter('ol_validasi',$kondisi2);
     $jml = $this->m_umum->jumlah_record_filter('ol_validasi',$kondisi);
     if($id_kewenangan && $barcode_pegawai){
      if($jml2 == 0){
       if($this->m_ol_validasi->simpan_ol_validasi($id_kewenangan,$barcode_pegawai,$id_sifat_kewenangan)){
        $this->session->set_flashdata('sukses', 'Data Sudah Di Rubah');
        redirect(base_url('ol_validasi/validasi/validasi/'.$barcode_pegawai));
       }else{
        $this->session->set_flashdata('danger', 'Ada Masalah Rubah Data. Hubungi Admin');
        redirect(base_url('ol_validasi/validasi/validasi/'.$barcode_pegawai));
       }
      }else{
       if($jml == 0){
        if($this->m_ol_validasi->rubah_ol_validasi($id_kewenangan,$barcode_pegawai,$id_sifat_kewenangan)){
         $this->session->set_flashdata('sukses', 'Data Sudah Di Rubah');
         redirect(base_url('ol_validasi/validasi/validasi/'.$barcode_pegawai));
        }else{
         $this->session->set_flashdata('danger', 'Ada Masalah Rubah Data. Hubungi Admin');
         redirect(base_url('ol_validasi/validasi/validasi/'.$barcode_pegawai));
        }
       }else{
        $this->session->set_flashdata('danger', 'Data Sudah Masuk RKK');
        redirect(base_url('ol_validasi/validasi/validasi/'.$barcode_pegawai));
       }
      }
     }else{
      redirect(base_url('ol_validasi/validasi/validasi/'.$barcode_pegawai));
     }
    }
		}
	}
public function update_cell()
{
    $id    = $this->input->post('id');
    $field = $this->input->post('field');
    $value = $this->input->post('value');

    // whitelist field (WAJIB)
    $allowed = ['nama_pegawai','nip'];

    if (!in_array($field, $allowed)) {
        show_error('Invalid field', 403);
    }

    $this->db->where('id_pegawai', $id);
    $this->db->update('ol_pegawai', [
        $field => $value
    ]);

    echo json_encode(['status' => true]);
}
public function update_cells()
{
    $id    = $this->input->post('id');
    $field = $this->input->post('field');
    $value = $this->input->post('value');

    // WHITELIST
    $allowed = ['status_asesor'];
    if (!in_array($field, $allowed)) {
        echo json_encode(['status'=>false,'message'=>'Field tidak diizinkan']);
        return;
    }

    $this->db->where('id_pegawai', $id)
             ->update('ol_user', [$field => $value]);

    // ambil text baru
    $text = $this->db->select('nama_komite')
                     ->from('kol_komite')
                     ->where('id_komite', $value)
                     ->get()->row()->nama_komite;

    echo json_encode([
        'status' => true,
        'text'   => $text
    ]);
}
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("ol_validasi/header",$data);
	$this->load->view("ol_validasi/isi");
	$this->load->view("footer");
	$this->load->view("ol_validasi/jsload");
	$this->load->view("ol_validasi/jscode");
}
function tampil_ra($data)
{
	$this->load->view("header_top_ra",$data);
	$this->load->view("ol_validasi/menu");
	$this->load->view("ol_validasi/isi");
	$this->load->view("footer_ra");
	$this->load->view("jsload_ra");
	$this->load->view("ol_validasi/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_topol",$data);
	$this->load->view("ol_validasi/isi");
	$this->load->view("footer");
	$this->load->view("ol_validasi/jsload");
	$this->load->view("ol_validasi/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
