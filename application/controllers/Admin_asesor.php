<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');
// ALTER TABLE `ol_user` ADD `status_asesor` TINYINT UNSIGNED NOT NULL DEFAULT '0' AFTER `status_user`;
class Admin_asesor extends MY_Controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
          $this->load->model('m_ol_rancak');
          $this->load->model('m_admin_asesor');
           $this->load->model('m_auth');
          $this->m_auth->login_kah();
  }
	function index(){
		$this->pengajuan_kompetensi();
	}
function menu_halaman()
{
    return [
        [
            'type'   => 'parent',
            'id'     => 'master',
            'label'  => 'Utama',
            'icon'   => 'ph-duotone ph-database',
            'children' => [

                [
                    'label' => 'Pengajuan Kompetensi',
                    'url'   => 'admin_asesor/pengajuan_kompetensi',
                    'match' => [
                        'admin_asesor/pengajuan_kompetensi',
                        'admin_asesor/pengajuan_kompetensi_tambah',
                        'admin_asesor/pengajuan_kompetensi_edit'
                    ]
                ]

            ]
        ]
    ];
}
function pengajuan_kompetensi($mode = 'view')
{
    switch ($mode) {
	    case 'view':
	        $data = [
	            'page'       => 'pengajuan_kompetensi',
	            'header'     => 'DATA PENGAJUAN KOMPETENSI',
	            'title'      => 'DATA PENGAJUAN KOMPETENSI'
	        ];

	        $this->renderpage('pengajuan_kompetensi', $data, 'ra', 'admin_asesor');
	    break;

			case 'data':
			    $dt  = $this->datatable_request();
			    $res = $this->m_ol_rancak->datatable_admin_asesor($dt);

			    // Tambahkan tanda & sebelum $row agar menjadi referensi
			    foreach ($res['data'] as $key => &$row) {
			        // Pastikan nama key 'pengajuan_status' sama dengan yang dipanggil di JS
			        $row['pengajuan_status'] = badge_status($row['status_pengajuan'], 'pengajuan');
			        
			        // Contoh untuk status lainnya jika ada
			        // $row['aktifasi_status'] = badge_status($row['is_active'], 'aktifasi');
			    }
			    unset($row); // Putus referensi setelah loop selesai (best practice)

			    $this->datatable_response(
			        $dt['draw'],
			        $res['total'],
			        $res['filtered'],
			        $res['data']
			    );
			break;

			case 'child_validator':
			    header('Content-Type: application/json');

			    // Ambil barcode dari POST data yang dikirim oleh DataTable child
			    $barcode_pengajuan = $this->input->post('barcode_pengajuan'); 
			    $dt = $this->datatable_request();

			    // Panggil model dengan parameter barcode
			    $res = $this->m_ol_rancak->datatable_pengajuan_validator($barcode_pengajuan, $dt);

			    if (!empty($res['data'])) {
			        foreach ($res['data'] as &$row) {
			            // Gunakan isset untuk berjaga-jaga jika status_form tidak terpanggil di query
			            $status = $row['status_form'] ?? 'Belum Ada Form';
			            $color  = ($status == 'Sudah Ada Form') ? 'bg-success' : 'bg-warning';
			            $row['status_form_label'] = '<span class="badge ' . $color . '">' . $status . '</span>';
			        }
			        unset($row);
			    }

			    $this->datatable_response(
			        $dt['draw'],
			        $res['total'],
			        $res['filtered'],
			        $res['data']
			    );
			    exit;
			break;

		    case 'tambah':
		        $data = [
					'page'=>'tambah',
					'header'=>'VALIDATOR TAMBAH',
					'title' => 'VALIDATOR TAMBAH',
					'id_pengajuan' => $this->input->get('id_pengajuan'),
		        ];
		        $this->load->view("admin_asesor/isi",$data);
		    break;

			case 'data_validator':
			    header('Content-Type: application/json');

			    // Pastikan request di-parsing dengan benar
			    $dt = $this->datatable_request(); // Fungsi ini harus mengembalikan 'draw', 'search', 'columns', dll.

			    $res = $this->m_ol_rancak->datatable_pengajuan_validator_pilih($dt);

			    echo json_encode([
			        "draw"            => intval($dt['draw'] ?? 1),
			        "recordsTotal"    => intval($res['total'] ?? 0),
			        "recordsFiltered" => intval($res['filtered'] ?? 0),
			        "data"            => $res['data'] ?? []
			    ]);
			    exit;
			break;

			case 'simpan_validator_pilih':
			    header('Content-Type: application/json');
			    
			    $id_pengajuan  = $this->input->post('id_pengajuan');
			    $ids_validator = $this->input->post('ids_validator'); // Ini berupa array $kode = $this->m_rancak->kode_generator_urut(15,'PV');

			    if (empty($id_pengajuan) || empty($ids_validator)) {
			        echo json_encode(['ok' => false, 'msg' => 'Data tidak lengkap']);
			        exit;
			    }

			    // Ambil detail pengajuan untuk mendapatkan barcode_pengajuan
			    $pengajuan = $this->db->get_where('ol_pengajuan', ['id_pengajuan' => $id_pengajuan])->row();
			    
			    if (!$pengajuan) {
			        echo json_encode(['ok' => false, 'msg' => 'Data pengajuan tidak ditemukan']);
			        exit;
			    }

			    $this->db->trans_begin();

			    $batch_data = [];
			    foreach ($ids_validator as $id_asesor) {
			        // Cek dulu apakah sudah ada agar tidak double
			        $exists = $this->db->get_where('nkr_pengajuan_validator', [
			            'barcode_pengajuan' => $pengajuan->barcode_pengajuan,
			            'id_asesor'         => $id_asesor
			        ])->num_rows();

			        if ($exists == 0) {
			            $batch_data[] = [
			                'barcode_pengajuan' => $pengajuan->barcode_pengajuan,
			                'id_asesor'         => $id_asesor,
			                'barcode_pengajuan_validator' => $this->m_rancak->kode_generator_urut(15,'PV'),
			                'created_by'        => $this->session->userdata('barcode_pegawai')
			            ];
			        }
			    }

			    if (!empty($batch_data)) {
			        $this->db->insert_batch('nkr_pengajuan_validator', $batch_data);
			    }

			    if ($this->db->trans_status() === FALSE) {
			        $this->db->trans_rollback();
			        echo json_encode(['ok' => false, 'msg' => 'Gagal menyimpan data ke database']);
			    } else {
			        $this->db->trans_commit();
			        echo json_encode(['ok' => true, 'msg' => count($batch_data) . ' Validator berhasil ditambahkan']);
			    }
			    exit;
			break;

		    case 'modal_hapus_validator':

			    $data = [
			    	'page'              => 'modal_hapus_validator',
			        'header'            => 'HAPUS VALIDATOR',
			        'title'             => 'HAPUS VALIDATOR',
			        'id_pengajuan_validator' => $this->input->get('id_pengajuan_validator'),
			        'child_table_id' 	=> $this->input->get('child_table_id'),
			        'nama_pegawai'      	=> $this->input->get('nama_pegawai')
			    ];

			    $this->load->view("admin_asesor/isi",$data);
		    break;

			case 'delete_validator':

			    $id_pengajuan_validator = $this->input->post('id_pengajuan_validator', true);

			    if(empty($id_pengajuan_validator)){
			        echo json_encode(['ok'=>false,'msg'=>'ID tidak valid']);
			        return;
			    }

			    $old = $this->db->get_where('nkr_pengajuan_validator', [
			        'id_pengajuan_validator' => $id_pengajuan_validator
			    ])->row_array();

			    if(!$old){
			        echo json_encode(['ok'=>false,'msg'=>'Data tidak ditemukan']);
			        return;
			    }

			    // ==========================================================
			    // TAMBAHAN SYARAT PENGHAPUSAN
			    // Cek apakah nkr_form sudah terisi (tidak null, tidak empty, tidak 0)
			    // ==========================================================
			    if (!empty($old['nkr_form']) && $old['nkr_form'] != 0) {
			        echo json_encode([
			            'ok'  => false, 
			            'msg' => 'Data tidak bisa dihapus karena validator form kompetensi sudah terisi.'
			        ]);
			        return;
			    }

			    // Jika syarat terpenuhi (nkr_form kosong/0), lanjutkan hapus
			    $this->db->where('id_pengajuan_validator', $id_pengajuan_validator);
			    $this->db->update('nkr_pengajuan_validator', [
			        'deleted_by' => $this->session->userdata('barcode_pegawai'),
			        'deleted_at' => date('Y-m-d H:i:s')
			    ]);

			    echo json_encode(['ok'=>true,'msg'=>'Data berhasil dihapus']);

			break;

			case 'data_form':
			    header('Content-Type: application/json');
			    $id_kompetensi = $this->input_auto('id_kompetensi');
			    $id_instansi = $this->input_auto('id_instansi');
			    // Pastikan request di-parsing dengan benar
			    $dt = $this->datatable_request(); // Fungsi ini harus mengembalikan 'draw', 'search', 'columns', dll.

			    $res = $this->m_ol_rancak->datatable_nkr_form($id_kompetensi,$id_instansi,$dt);

			    echo json_encode([
			        "draw"            => intval($dt['draw'] ?? 1),
			        "recordsTotal"    => intval($res['total'] ?? 0),
			        "recordsFiltered" => intval($res['filtered'] ?? 0),
			        "data"            => $res['data'] ?? []
			    ]);
			    exit;
			break;

			case 'form':
			    $id_pengajuan_validator = $this->input->get('id_pengajuan_validator');
			    
			    // Ambil data validator untuk mendapatkan nilai nkr_form yang sudah tersimpan
			    $current_data = $this->db->get_where('nkr_pengajuan_validator', [
			        'id_pengajuan_validator' => $id_pengajuan_validator
			    ])->row_array();

			    // Jika nkr_form tidak kosong, pecah string "1,2,3" menjadi array [1, 2, 3]
			    $existing_ids = [];
			    if (!empty($current_data['nkr_form'])) {
			        $existing_ids = explode(',', $current_data['nkr_form']);
			    }

			    $data = [
			        'page'                   => 'form',
			        'header'                 => 'SETING FORM',
			        'title'                  => 'SETING FORM',
			        'id_pengajuan_validator' => $id_pengajuan_validator,
			        'id_kompetensi'          => $this->input->get('id_kompetensi'),
			        'id_instansi'            => $this->input->get('id_instansi'),
			        'existing_ids'           => $existing_ids // Kirim array ke view
			    ];
			    $this->load->view("admin_asesor/isi", $data);
			break;

			case 'simpan_form':
			    header('Content-Type: application/json');
			    
			    $id_pengajuan_validator = $this->input->post('id_pengajuan_validator');
			    $ids_form = $this->input->post('ids_validator'); // Ini array ID Form dari JS

			    if (empty($id_pengajuan_validator) || empty($ids_form)) {
			        echo json_encode(['ok' => false, 'msg' => 'Silakan pilih minimal satu form!']);
			        exit;
			    }

			    // Menggabungkan array ID menjadi string: "1,4,7"
			    $string_ids = implode(',', $ids_form);

			    $this->db->trans_begin();

			    // Update kolom nkr_form pada tabel nkr_pengajuan_validator
			    $this->db->where('id_pengajuan_validator', $id_pengajuan_validator);
			    $this->db->update('nkr_pengajuan_validator', [
			        'nkr_form' => $string_ids
			    ]);

			    if ($this->db->trans_status() === FALSE) {
			        $this->db->trans_rollback();
			        echo json_encode(['ok' => false, 'msg' => 'Gagal memperbarui setting form']);
			    } else {
			        $this->db->trans_commit();
			        echo json_encode(['ok' => true, 'msg' => 'Setting form berhasil disimpan']);
			    }
			    exit;
			break;

    }
}
function pengajuan_signature($mode = 'view')
{
    switch ($mode) {
	    case 'view':
	        $data = [
	            'page'       => 'pengajuan_signature',
	            'header'     => 'DATA RKK',
	            'title'      => 'DATA RKK'
	        ];

	        $this->renderpage('pengajuan_signature', $data, 'ra', 'admin_asesor');
	    break;

		case 'data_signature':

		    header('Content-Type: application/json');

				$id_instansi = $this->session->userdata('refer');
			    $dt  = $this->datatable_request();
			    $res = $this->m_ol_rancak->datatable_pengajuan_signature($id_instansi,$dt);

		    $this->datatable_response(
		        $res['draw'],
		        $res['total'],
		        $res['filtered'],
		        $res['data']
		    );
		    exit;
		break;

		case 'child_signature_detil':

		    header('Content-Type: application/json');

		    $id_pengajuan_signature = $this->input_auto('id_pengajuan_signature');
		    $dt         = $this->datatable_request();

		    $res = $this->m_ol_rancak->datatable_pengajuan_signature_detil($id_pengajuan_signature, $dt);

		    $this->datatable_response(
		        $dt['draw'],
		        $res['total'],
		        $res['filtered'],
		        $res['data']
		    );
		    exit;
		break;

    }
}
	//===============================================================================
	function pengajuan_kompetensis($mode='view'){
		$data['page']="pengajuan_kompetensis"; 
		$data['header'] = "DATA PENGAJUAN KOMPETENSI";
		$data['title'] = "DATA PENGAJUAN KOMPETENSI";
		$data['link_awal'] = base_url($this->session->beranda);
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
//		$program = $this->m_umum->ambil_data('a_program','id_program',10);
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
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
//		$data['id']   = $this->uri->segment(4, 0);
		//======================= IMPORTANT =========================================
    $data['id']   = urldecode(trim($this->uri->segment(4, 0)));
    $data['id2']   = $this->uri->segment(5, 0);
		$replace_keyword   = preg_replace('/\s+/', ' ', $data['id']);
		$data['key'] = str_replace(' ', '-', $replace_keyword);
		if($data['key'] == NULL OR empty($data['key'])){
			$data['key'] = "";
		}
		if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
			if($action == 'BtnProses') {
        $trim_keyword   = urldecode(trim($this->input->post("key")));
  			$replace_keyword   = preg_replace('/\s+/', ' ', $trim_keyword);
  			$key = str_replace(' ', '-', $replace_keyword);
				redirect(base_url('admin_asesor/pengajuan_kompetensi/view/'.$key));
			}
		}
    else if($mode=='data'){
			$key = urldecode(trim($this->uri->segment(4, 0)));
			$key = strtolower($key);
			$key = preg_replace('/[^A-Za-z0-9\-]/', '', $key);
			$key = str_replace(' ', '-', $key);
			echo json_encode($this->m_admin_asesor->pengajuan_kompetensi_all($key));
		}
		else if($mode=='nkr_validator'){
			echo json_encode($this->m_admin_asesor->nkr_pengajuan_validator_tabel($data['key']));
		}
		else{
			if($mode=='pilih'){
			  $data['page'] =  $data['page']."_pilih";		
				$take = $this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$data['key']);
				$kondisi = array('barcode_pegawai'=>$take['barcode_pegawai']);
				$kondisinkr = array('barcode_pengajuan'=>$data['key']);
				$jfe = $this->m_umum->ambil_data_kondisi_2tabel_row('ol_pegawai',$kondisi,'jabatan_fungsional','id_jabatan_fungsional');		
				$data['nkrpengva'] = $this->m_umum->ambil_data_kondisi_result('nkr_pengajuan_validator',$kondisinkr);		
				$data['struktur'] = $this->m_admin_asesor->ambil_data_asesor_no_null();	
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$take['barcode_pengajuan']);
				$data['id_pengajuan']  = set_value('id_pengajuan',$take['id_pengajuan']);
				$data['status_pengajuan']  = set_value('status_pengajuan',$take['status_pengajuan']);
				$this->load->view("admin_asesor/isi",$data);
			}
			if($mode=='simpan_pilih'){
				$status_pengajuan = $this->input->post('status_pengajuan');
				if($status_pengajuan == 1){
			  	$this->m_admin_asesor->simpan_pegawai_pengajuan();
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('admin_asesor/pengajuan_kompetensi'));
				}else{
					$this->session->set_flashdata('danger', 'Kompetensi Sudah Selesai');
					redirect(base_url('admin_asesor/pengajuan_kompetensi'));
				}
			}
			if($mode=='form'){
				$data['page'] =  $data['page']."_form";
					if(empty($data['key'])){
						redirect(base_url('admin_asesor/pengajuan_kompetensi'));	
					}else{
						$this->tampil($data);	
					}										
			}
			if($mode=='pilih_form'){
			  $data['page'] =  $data['page']."_pilih_form";	
				$kondisi=array('barcode_pengajuan_validator'=>$data['key']);	
				$take = $this->m_umum->ambil_data_kondisi_2tabel_row('nkr_pengajuan_validator',$kondisi,'ol_pengajuan','barcode_pengajuan');		
				$data['form'] = $this->m_admin_asesor->ambil_data_nkr_form($take['kode_unit_pengajuan'],$take['id_instansi']);	
				$data['barcode_pengajuan_validator']  = set_value('barcode_pengajuan_validator',$take['barcode_pengajuan_validator']);
				$data['id_pengajuan_validator']  = set_value('id_pengajuan_validator',$take['id_pengajuan_validator']);
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$take['barcode_pengajuan']);
				$data['status_pengajuan']  = set_value('status_pengajuan',$take['status_pengajuan']);
				$data['nkr_form']  = set_value('nkr_form',$take['nkr_form']);
				$this->load->view("admin_asesor/isi",$data);
			}
			if($mode=='simpan_pilih_form'){
				$status_pengajuan = $this->input->post('status_pengajuan');
				$barcode_pengajuan = $this->input->post('barcode_pengajuan');
				if($status_pengajuan == 1){
			  	$this->m_admin_asesor->simpan_form_pengajuan_validator();
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('admin_asesor/pengajuan_kompetensi/form/'.$barcode_pengajuan));					
				}else{
					$this->session->set_flashdata('danger', 'Kompetensi Sudah Selesai');
					redirect(base_url('admin_asesor/pengajuan_kompetensi/form/'.$barcode_pengajuan));	
				}
			}
			if($mode=='seting'){
				$data['page'] =  $data['page']."_seting";
					if(empty($data['id'])){
						redirect(base_url('admin_asesor/pengajuan_kompetensi'));	
					}else{
						$this->tampil($data);	
					}										
			}
    if($mode=='selesai'){
     if($this->m_admin_asesor->seting_status_pengajuan($data['id'],$data['id2'])){
     $this->session->set_flashdata('sukses', 'Data Sudah Final');
     redirect(base_url('admin_asesor/pengajuan_rkk'));
     }else{
     $this->session->set_flashdata('danger', 'Masalah Final Data');
     redirect(base_url('admin_asesor/pengajuan_rkk'));
     }
    }
			if($mode=='lihat_form'){
			  $data['page'] =  $data['page']."_lihat_form";	
				$kondisi=array('barcode_pengajuan_validator'=>$data['key']);	
				$take = $this->m_umum->ambil_data_kondisi_2tabel_row('nkr_pengajuan_validator',$kondisi,'ol_pengajuan','barcode_pengajuan');		
				$data['form'] = $this->m_admin_asesor->ambil_data_nkr_form($take['kode_unit_pengajuan'],$take['id_instansi']);	
				$data['barcode_pengajuan_validator']  = set_value('barcode_pengajuan_validator',$take['barcode_pengajuan_validator']);
				$data['id_pengajuan_validator']  = set_value('id_pengajuan_validator',$take['id_pengajuan_validator']);
				$data['barcode_pengajuan']  = set_value('barcode_pengajuan',$take['barcode_pengajuan']);
				$data['status_pengajuan']  = set_value('status_pengajuan',$take['status_pengajuan']);
				$data['nkr_form']  = set_value('nkr_form',$take['nkr_form']);
				$this->load->view("admin_asesor/isi",$data);
			}
			if($mode=='simpan_lihat_form'){
				$status_pengajuan = $this->input->post('status_pengajuan');
				$barcode_pengajuan = $this->input->post('barcode_pengajuan');
				if($status_pengajuan == 1){
			  	$this->m_admin_asesor->simpan_form_pengajuan_validator();
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
					redirect(base_url('admin_asesor/pengajuan_kompetensi/form/'.$barcode_pengajuan));					
				}else{
					$this->session->set_flashdata('danger', 'Kompetensi Sudah Selesai');
					redirect(base_url('admin_asesor/pengajuan_kompetensi/form/'.$barcode_pengajuan));	
				}
			}
		}
	}
	function pengajuan_rkk($mode='view'){
		$data['page']="pengajuan_rkk"; 
		$data['header'] = "DATA PENGAJUAN RKK";
		$data['title'] = "DATA PENGAJUAN RKK";
		$data['link_awal'] = base_url($this->session->beranda);
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
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
		$asesor = $this->m_umum->ambil_data('kol_komite','id_komite',$this->session->status_asesor);
		$data['id']   = $this->uri->segment(4, 0);
  $data['id2']   = $this->uri->segment(5, 0);
		//======================= IMPORTANT =========================================
   if($mode=='view'){
   	$this->tampil($data);
   }
   else if($mode=='data'){
     echo json_encode($this->m_admin_asesor->pengajuan_rkk_all());
   }else{
     $data['yatidak'] = $this->m_rancak->cmd_ya_tidak();
     $data['gambar'] = $this->m_ol_rancak->cmd_gambar_kop();
     $data['struktur'] = $this->m_admin_asesor->ambil_data_asesor_no_null();
     if($mode=='tambah_sign'){
       $data['page'] =  $data['page']."_tambah_sign"; 
       $ambil_pengajuan = $this->m_umum->ambil_data('ol_pengajuan','barcode_pengajuan',$data['id']);
       $knds = array('barcode_pegawai'=>$ambil_pengajuan['barcode_pegawai']);
       $ambil_kw = $this->m_umum->ambil_order_kondisi_2tabel_result('ol_rkk',$knds,'nkr_kewenangan','id_kewenangan','nama_kewenangan','ASC');
       $arr = [];
       foreach($ambil_kw as $val){
           $arr[] = $val['coun_kewenangan'];
       }
       $data['eimplo'] = implode(",", $arr);
       $data['lampiran']  = set_value('lampiran',$this->input->post('lampiran'));
       $data['kop_signature']  = set_value('kop_signature',$this->input->post('kop_signature'));
       $data['no']  = set_value('no',$this->input->post('no'));
       $data['tanggal']  = set_value('tanggal',$this->input->post('tanggal'));
       $data['id_gambar']  = set_value('id_gambar',$this->input->post('id_gambar'));
       $data['header']  = set_value('header',$this->input->post('header'));
       $data['sub_header']  = set_value('sub_header',$this->input->post('sub_header'));
       $data['sub_sub_header']  = set_value('sub_sub_header',$this->input->post('sub_sub_header'));
       $data['sebelum']  = set_value('sebelum',$this->input->post('sebelum'));
       $data['sesudah']  = set_value('sesudah',$this->input->post('sesudah'));
       $data['kanan_tgl']  = set_value('kanan_tgl',$this->input->post('kanan_tgl'));
       $data['tengah_tgl']  = set_value('tengah_tgl',$this->input->post('tengah_tgl'));
       $data['kiri_tgl']  = set_value('kiri_tgl',$this->input->post('kiri_tgl'));
       $data['kanan_top']  = set_value('kanan_top',$this->input->post('kanan_top'));
       $data['kanan_middle']  = set_value('kanan_middle',$this->input->post('kanan_middle'));
       $data['kanan_nama']  = set_value('kanan_nama',$this->input->post('kanan_nama'));
       $data['kanan_nip']  = set_value('kanan_nip',$this->input->post('kanan_nip'));
       $data['tengah_top']  = set_value('tengah_top',$this->input->post('tengah_top'));
       $data['tengah_middle']  = set_value('tengah_middle',$this->input->post('tengah_middle'));
       $data['tengah_nama']  = set_value('tengah_nama',$this->input->post('tengah_nama'));
       $data['tengah_nip']  = set_value('tengah_nip',$this->input->post('tengah_nip'));
       $data['kiri_top']  = set_value('kiri_top',$this->input->post('kiri_top'));
       $data['kiri_middle']  = set_value('kiri_middle',$this->input->post('kiri_middle'));
       $data['kiri_nama']  = set_value('kiri_nama',$this->input->post('kiri_nama'));
       $data['kiri_nip']  = set_value('kiri_nip',$this->input->post('kiri_nip'));
       $data['kiri_signature']  = set_value('kiri_signature',0);
       $data['tengah_signature']  = set_value('tengah_signature',0);
       $data['kanan_signature']  = set_value('kanan_signature',0);
       $this->load->view("admin_asesor/isi",$data);
     }
     if($mode=='simpan_tambah_sign'){
      $status_pengajuan = $this->input->post('status_pengajuan');
      $barcode_pengajuan = $this->input->post('barcode_pengajuan');
      $knds = array('barcode_pengajuan'=>$barcode_pengajuan);
      $jml = $this->m_umum->jumlah_record_filter('ol_rkk',$knds);
      if($jml == 0){
        $this->session->set_flashdata('danger', 'Data Validasi Belum Ada');
        redirect(base_url('admin_asesor/pengajuan_kompetensi'));
      }else{
       if($this->m_admin_asesor->seting_status_pengajuan($barcode_pengajuan,$status_pengajuan)){
        $this->m_admin_asesor->simpan_signature();
        $this->session->set_flashdata('sukses', 'Data Berhasil Di Buat');
        redirect(base_url('admin_asesor/pengajuan_rkk'));
       }else{
        $this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
        redirect(base_url('admin_asesor/pengajuan_rkk'));
       }     
      }
     }
    if($mode=='tambah_kewenangan'){
     $data['page'] =  $data['page']."_tambah_kewenangan";
     $kondisinkr = array('id_signature'=>$data['id']);  
     $data['nkrpengva'] = $this->m_umum->ambil_data_kondisi_2tabel_row('ol_pengajuan_signature',$kondisinkr,'ol_pengajuan','barcode_pengajuan');
     $data['status_pengajuan'] = $data['nkrpengva']['status_pengajuan'];
     $data['barcode_pengajuan'] = $data['nkrpengva']['barcode_pengajuan'];

     $knds_peg = array('barcode_pegawai'=>$data['nkrpengva']['barcode_pegawai']);  
     $data['ambil_peg'] = $this->m_umum->ambil_data_kondisi('ol_pegawai',$knds_peg);

     $jabfung = $this->m_umum->ambil_data('jabatan_fungsional','id_jabatan_fungsional',$data['ambil_peg']['id_jabatan_fungsional']);

     $knds = array('id_jabatan'=>$jabfung['id_jabatan']);  
     $data['struktur'] = $this->m_umum->ambil_order_kondisi_2tabel_result('nkr_kewenangan',$knds,'nkr_kompetensi','id_kompetensi','nama_kewenangan','ASC');
     $this->load->view("admin_asesor/isi",$data);
    }
    if($mode=='simpan_tambah_kewenangan'){
     $status_pengajuan = $this->input->post('status_pengajuan');
     $barcode_pengajuan = $this->input->post('barcode_pengajuan');
     if($status_pengajuan == 3){
       $this->m_admin_asesor->edit_pegajuan_signature();
      $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
      redirect(base_url('admin_asesor/pengajuan_rkk'));    
     }else{
      $this->session->set_flashdata('danger', 'RKK Sudah Pernah Di Print');
      redirect(base_url('admin_asesor/pengajuan_rkk'));
     }
    }
    if($mode=='edit_sign'){
     $data['page'] =  $data['page']."_edit_sign"; 
     $kondisi = array('id_signature'=>$data['id']);  
     $keuangan = $this->m_umum->ambil_data_kondisi_2tabel_row('ol_pengajuan_signature',$kondisi,'ol_pengajuan','barcode_pengajuan');
     $data['barcode_pengajuan']  = set_value('barcode_pengajuan',$keuangan["barcode_pengajuan"]);
     $data['status_pengajuan']  = set_value('status_pengajuan',$keuangan["status_pengajuan"]);
     $data['lampiran']  = set_value('lampiran',$keuangan["lampiran"]);
     $data['kop_signature']  = set_value('kop_signature',$keuangan["kop_signature"]);
     $data['no']  = set_value('no',$keuangan["no"]);
     $data['tanggal']  = set_value('tanggal',$keuangan["tanggal"]);
     $data['id_gambar']  = set_value('id_gambar',$keuangan["id_gambar"]);
     $data['header']  = set_value('header',$keuangan["header"]);
     $data['sub_header']  = set_value('sub_header',$keuangan["sub_header"]);
     $data['sub_sub_header']  = set_value('sub_sub_header',$keuangan["sub_sub_header"]);
     $data['sebelum']  = set_value('sebelum',$keuangan["sebelum"]);
     $data['sesudah']  = set_value('sesudah',$keuangan["sesudah"]);
     $data['kanan_tgl']  = set_value('kanan_tgl',$keuangan["kanan_tgl"]);
     $data['tengah_tgl']  = set_value('tengah_tgl',$keuangan["tengah_tgl"]);
     $data['kiri_tgl']  = set_value('kiri_tgl',$keuangan["kiri_tgl"]);
     $data['kanan_top']  = set_value('kanan_top',$keuangan["kanan_top"]);
     $data['kanan_middle']  = set_value('kanan_middle',$keuangan["kanan_middle"]);
     $data['kanan_nama']  = set_value('kanan_nama',$keuangan["kanan_nama"]);    
     $data['kanan_nip']  = set_value('kanan_nip',$keuangan["kanan_nip"]);    
     $data['tengah_top']  = set_value('tengah_top',$keuangan["tengah_top"]);    
     $data['tengah_middle']  = set_value('tengah_middle',$keuangan["tengah_middle"]);    
     $data['tengah_nama']  = set_value('tengah_nama',$keuangan["tengah_nama"]);    
     $data['tengah_nip']  = set_value('tengah_nip',$keuangan["tengah_nip"]);    
     $data['kiri_top']  = set_value('kiri_top',$keuangan["kiri_top"]);    
     $data['kiri_middle']  = set_value('kiri_middle',$keuangan["kiri_middle"]);    
     $data['kiri_nama']  = set_value('kiri_nama',$keuangan["kiri_nama"]);    
     $data['kiri_nip']  = set_value('kiri_nip',$keuangan["kiri_nip"]); 
     $data['kiri_signature']  = set_value('kiri_signature',$keuangan["kiri_signature"]); 
     $data['tengah_signature']  = set_value('tengah_signature',$keuangan["tengah_signature"]); 
     $data['kanan_signature']  = set_value('kanan_signature',$keuangan["kanan_signature"]); 
     $this->load->view("admin_asesor/isi",$data);
    }
    if($mode=='simpan_edit_sign'){
      $status_pengajuan = $this->input->post('status_pengajuan');
      if($status_pengajuan == 3){
       if($this->m_admin_asesor->edit_signature()){
        $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
        redirect(base_url('admin_asesor/pengajuan_rkk'));
       }else{
        $this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
        redirect(base_url('admin_asesor/pengajuan_rkk'));
       }
      }else{
        $this->session->set_flashdata('danger', 'Data Sudah Pernah Print Out');
        redirect(base_url('admin_asesor/pengajuan_rkk'));
      }
    }
    if($mode=='pdf_rkk'){
      $report = $this->load->view('cetak/ol_pengajuan_rkk', $data, TRUE);
      $signature = $this->m_ol_rancak->ambil_data_pengajuan_signature($data['id']);
      $filename = date('dmYHis').'-rkk-'.$signature['barcode_pengajuan'].'-'.$signature['nama_pegawai'].".pdf";
      $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
      $mpdf->AddPage('P', '', '', '', 2, 5, 5, 5, 10, 3, 3);
      $mpdf->SetTitle($data['header']);
      $mpdf->SetAuthor($data['instance_name']);
      $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
      //$mpdf->SetFooter('Page : {PAGENO}');
      ini_set("pcre.backtrack_limit", "5000000");
      $mpdf->WriteHTML($report);
      $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
    }
   }
  }
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("admin_asesor/header",$data);
	$this->load->view("admin_asesor/isi");
	$this->load->view("footer");
	$this->load->view("admin_asesor/jsload");
	$this->load->view("admin_asesor/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_topol",$data);
	$this->load->view("admin_asesor/isi");
	$this->load->view("footer");
	$this->load->view("admin_asesor/jsload");
	$this->load->view("admin_asesor/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
