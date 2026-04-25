<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Ol_logbook extends MY_Controller
{
	// -----------------------------------------------------------START------------------------------
	public function __construct(){
	  parent::__construct();
	  $this->load->model('m_member');
	  $this->m_auth->all_member();
	}
  	// ========================================================================
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
	                    'label' => 'Logbook',
	                    'url'   => 'ol_logbook/logbook',
	                    'match' => [
	                        'ol_logbook/logbook/tambah'
	                    ]
	                ],
                ]
            ]
        ];
    }
  	// ========================================================================
/*
$data['kr_kewenangan_detil']=$this->m_ol_rancak->opsi_logbook_new();
$data['sifat']=$this->m_ol_rancak->cmd_sifat_kewenangan();
if($mode=='edit'){
  $data['page'] =  $data['page']."_edit";
		$keuangan    = $this->m_umum->ambil_data('ol_logbook','barcode_logbook',$data['first_date']);
		$data['rm']  = set_value('rm',$keuangan["rm"]);
		$data['jml_logbook']  = set_value('jml_logbook',$keuangan["jml_logbook"]);
		$data['barcode_logbook']  = set_value('barcode_logbook',$keuangan["barcode_logbook"]);
		$data['id_pengajuan']  = set_value('id_pengajuan',$keuangan["id_pengajuan"]);
		$data['id_logbook']  = set_value('id_logbook',$keuangan["id_logbook"]);
		$data['id_instansi']  = set_value('id_instansi',$keuangan["id_instansi"]);
		$data['id_sifat_kewenangan']  = set_value('id_sifat_kewenangan',$keuangan["id_sifat_kewenangan"]);
		$data['tgl_logbook']  = set_value('tgl_logbook', date('d-m-Y',strtotime($keuangan["tgl_logbook"])));
		$this->load->view("member/isi",$data);
}
if($mode=='simpan_edit'){
	$id_pengajuan = $this->input->post('id_pengajuan');
		if($id_pengajuan == 0){
			  if($this->m_member->edit_logbook()){
					$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
					redirect(base_url('ol_logbook/logbook'));
			  }else{
					$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
					redirect(base_url('ol_logbook/logbook'));
			  }
			}else{
					$this->session->set_flashdata('danger', 'Data SUdah Masuk Pengajuan Kompetensi');
					redirect(base_url('ol_logbook/logbook'));
			  }
}
*/
public function get_data_ajax($limit = 30)
{
    $search = $this->input->get('q');
    $page   = max(1, (int)$this->input->get('page'));

    $data = $this->m_ol_rancak->get_kewenangan_ajax($search, $page, $limit);

    echo json_encode([
        'results'    => $data,
        'pagination' => [
            'more' => count($data) == $limit
        ]
    ]);
}
	function logbook($mode = 'view')
	{
	    switch ($mode) {

	      /* ===============================
	       * VIEW PAGE
	       * =============================== */
		    case 'view':
		    	$pegawai = $this->data['pegawai'];
		        $first_date = $this->uri_auto(4, null, false);
		        $last_date  = $this->uri_auto(5, null, false);
		        $id_ruangan = $this->uri->segment(6);// karena ini bisa nol / null daripada int
		      //  $id_ruangan = $this->uri_int(6, false);
		        $pxe        = $this->uri_auto(7, null, false);

		        /* fallback session */
		        if (!$first_date) {
		            $first_date = $this->session->first_date_log
		                ?? '01-' . date('m-Y');
		        }

		        if (!$last_date) {
		            $last_date = $this->session->last_date_log
		                ?? date('d-m-Y');
		        }

		        $data = [
		            'page'       => 'logbook',
		            'header'     => 'LOGBOOK',
		            'title'      => 'LOGBOOK',

		            'first_date' => $first_date,
		            'last_date'  => $last_date,
		            'id_ruangan' => $id_ruangan,
		            'id_instansi' => set_value('id_instansi', $this->input->post("id_instansi")),
		            'id_kompetensi' => set_value('id_kompetensi', $this->input->post("id_kompetensi")),
		            'pxe'        => $pxe,
								'link_kembali'  => base_url('member'),
								'link_awal'  => base_url('ol_logbook/logbook'),
		            'ambil_data_kompetensi_null' =>
		                $this->m_ol_rancak
		                    ->ambil_data_kompetensi_new(
		                        $first_date,
		                        $last_date,
		                        $id_ruangan
		                    ),
		            'ambil_data_instansi_null' =>
		                $this->m_ol_rancak
		                    ->ambil_data_instansi()
		        ];

		        $this->renderpage('logbook', $data, 'ra');
		    break;

			case 'filter':

			    $first_date  = $this->input->post('first_date', true);
			    $last_date   = $this->input->post('last_date', true);
			    $id_ruangan  = $this->input->post('id_instansi', true);
			    $pxe         = $this->input->post('id_kompetensi', true);

			    // validasi minimal
			    if (!$first_date || !$last_date) {
			        $this->session->set_flashdata(
			            'danger',
			            'Periode tanggal wajib diisi'
			        );
			        redirect(base_url('ol_logbook/logbook'));
			    }

			    // simpan ke session
			    $this->session->set_userdata([
			        'first_date_log' => $first_date,
			        'last_date_log'  => $last_date
			    ]);

			    redirect(
			        base_url(
			            'ol_logbook/logbook/view/'
			            . $first_date . '/'
			            . $last_date . '/'
			            . $id_ruangan . '/'
			            . $pxe
			        )
			    );
			break;

			case 'data_logbook':

			    header('Content-Type: application/json');

			    $dt  = $this->datatable_request();

				$dt['first_date']    = $this->input->post('first_date');
				$dt['last_date']     = $this->input->post('last_date');
				$dt['id_kompetensi'] = (int)$this->input->post('id_kompetensi');
				$dt['id_instansi']   = (int)$this->input->post('id_instansi');

			    $res = $this->m_ol_rancak->datatable_logbook($dt);

			    $this->datatable_response(
			        $res['draw'],
			        $res['total'],
			        $res['filtered'],
			        $res['data']
			    );
			    exit;
			break;

			case 'child_logbook_pasien':

			    header('Content-Type: application/json');

			    $id_logbook = $this->input_auto('id_logbook');
			    $dt         = $this->datatable_request();

			    $res = $this->m_ol_rancak->datatable_child_logbook_pasien($id_logbook, $dt);

			    $this->datatable_response(
			        $dt['draw'],
			        $res['total'],
			        $res['filtered'],
			        $res['data']
			    );
			    exit;
			break;

			case 'save_filter_session':

			    $first_date = $this->input->post('first_date');
			    $last_date  = $this->input->post('last_date');

			    $this->session->set_userdata([
			        'first_date_log' => $first_date,
			        'last_date_log'  => $last_date
			    ]);

			    echo json_encode([
			        'ok'  => true,
			        'msg' => 'Filter Berhasil'
			    ]);
			/*
			    json_response_null([
			        'ok' => true,
			        'msg'    => 'Session saved'
			    ]);
			*/
			break;

		    case 'tambah':
		        $data = [
		            'page'  => 'logbook_tambah',
		            'header'=> 'LOGBOOK TAMBAH',
		            'title' => 'LOGBOOK TAMBAH',
					'link_kembali'  => base_url('member'),
					'link_awal'  => base_url('ol_logbook/logbook'),
					'filter_grade' => set_value('filter_grade', $this->input->post("filter_grade")),
		            'grade'  => $this->m_ol_rancak->get_grade_by_jabatan()
		        ];

		        $action = $this->input->post('action');

		        if ($action == 'BtnProses') {
		            redirect(base_url('ol_logbook/logbook/tambah'));
		        }

		        if ($action == 'BtnSimpan') {
		            $chk = $this->input->post('chk');
		            if (!empty($chk)) {
		                $chk_str = implode("-", $chk); // gabungan ID / kode
		                redirect(base_url("ol_logbook/logbook/isi/{$chk_str}"));
		            } else {
		                redirect(base_url("ol_logbook/logbook/view/01-".date('m-Y')."/".date('d-m-Y')));
		            }
		        }

		        $this->renderpage('logbook_tambah', $data, 'ra');
		    break;

		    case 'edit':
			    $data = $this->input->method() === 'post'
			        ? $this->input->post()
			        : $this->input->get();

			    $id = $data['id_logbook'] ?? null;
		    	$kewenangan = $this->m_ol_rancak->get_row_logbook_by_id($id,$this->session->id_jabatan);

		        $data = [
				    'page'  => 'logbook_edit',
				    'header'=> 'LOGBOOK EDIT',
				    'title' => 'LOGBOOK EDIT',
					'link_kembali'  => base_url('member'),
					'link_awal'  => base_url('ol_logbook/logbook'),
					'tgl_logbook' => set_value('tgl_logbook', date('d-m-Y',strtotime($kewenangan['tgl_logbook']))),
					'id_sifat_kewenangan' => set_value('id_sifat_kewenangan', $kewenangan['id_sifat_kewenangan']),
					'id_logbook' => $id,
					'id_kewenangan' => set_value('id_kewenangan', $kewenangan['id_kewenangan']),
					'nama_kewenangan' => set_value('nama_kewenangan', $kewenangan['nama_kewenangan']),
					'nama_kompetensi' => set_value('nama_kompetensi', $kewenangan['nama_kompetensi']),
					'kode_unit' => set_value('kode_unit', $kewenangan['kode_unit']),
				    'get_kewenangan'  => $this->m_ol_rancak->get_kewenangan_dropdown($this->session->id_jabatan),
				    'sifat'  => $this->m_ol_rancak->get_sifat_kewenangan_dropdown(),

		        ];

		        $this->load->view("member/isi",$data);
		    break;

			case 'isi':
			    // ambil ID gabungan dari URI (checkbox)
			    $id_gabungan = $this->uri_segment_flexible(4, null, true);

			    $data = [
				    'header'      => 'LOGBOOK ISI',
				    'title'       => 'LOGBOOK ISI',
					'link_kembali'  => base_url('member'),
					'link_awal'  => base_url('ol_logbook/logbook'),
				    'kr_kewenangan' => $this->m_ol_rancak->kewenangan_all(),
				    'ambil_data_instansi' =>$this->m_ol_rancak->ambil_data_instansi(),
				    'sifat' =>$this->m_ol_rancak->cmd_sifat_kewenangan(),
				    'id_gabungan' => $this->uri_segment_flexible(4, null, true),
				    'count'       => 
				    	set_value('count', 
				    	$this->m_umum->ambil_data(
				    		'jabatan','id_jabatan',$this->session->id_jabatan)['count']),
				    'terpilih'    => set_value('terpilih', explode("-", $id_gabungan)),
				    'tgl_logbook' => set_value('tgl_logbook', date('d-m-Y')),
				    'id_instansi' => set_value('id_instansi', $this->input->post("id_instansi")),
				    'id_sifat_kewenangan' => set_value('id_sifat_kewenangan', $this->input->post("id_sifat_kewenangan"))
			    ];

			    $this->renderpage('logbook_isi', $data, 'top');
			break;

			case 'rubah_logbook':

			    $id_logbook          = $this->input->post('id_logbook');
			    $tgl_logbook         = $this->input->post('tgl_logbook');
			    $id_kewenangan       = $this->input->post('id_kewenangan');
			    $id_sifat_kewenangan = $this->input->post('id_sifat_kewenangan');
			    $jml_logbook         = $this->input->post('jml_logbook');

			    // ==========================
			    // VALIDASI
			    // ==========================
			    if(empty($id_logbook)){
			        echo json_encode([
			            "ok" => false,
			            "msg" => "ID Logbook kosong!"
			        ]);
			        exit;
			    }

			    if(empty($tgl_logbook)){
			        echo json_encode([
			            "ok" => false,
			            "msg" => "Tanggal logbook wajib diisi!"
			        ]);
			        exit;
			    }

			    if(empty($id_kewenangan)){
			        echo json_encode([
			            "ok" => false,
			            "msg" => "Kewenangan wajib dipilih!"
			        ]);
			        exit;
			    }

			    if(empty($id_sifat_kewenangan)){
			        echo json_encode([
			            "ok" => false,
			            "msg" => "Sifat kewenangan wajib dipilih!"
			        ]);
			        exit;
			    }

			    if(empty($jml_logbook) || $jml_logbook <= 0){
			        echo json_encode([
			            "ok" => false,
			            "msg" => "Jumlah logbook wajib diisi!"
			        ]);
			        exit;
			    }

			    // ==========================
			    // FORMAT TANGGAL (DD-MM-YYYY -> YYYY-MM-DD)
			    // ==========================
			    $tgl_fix = date("Y-m-d", strtotime(str_replace("/", "-", $tgl_logbook)));

			    // ==========================
			    // UPDATE ol_logbook
			    // ==========================
			    $data_update = [
			        "tgl_logbook"         => $tgl_fix,
			        "id_kewenangan"       => $id_kewenangan,
			        "id_sifat_kewenangan" => $id_sifat_kewenangan,
			        "jml_logbook"         => $jml_logbook
			    ];

			    $this->db->where("id_logbook", $id_logbook);
			    $update = $this->db->update("ol_logbook", $data_update);

			    if($update){

			        echo json_encode([
			            "ok" => true,
			            "msg" => "Logbook berhasil dirubah!"
			        ]);

			    }else{

			        echo json_encode([
			            "ok" => false,
			            "msg" => "Gagal merubah logbook!"
			        ]);

			    }

			exit;
			break;

		      /* ===============================
		       * DATATABLE / JSON
		       * =============================== */
		      
		    case 'data':

		          $first_date = $this->uri_auto(4);
		          $last_date  = $this->uri_auto(5);
		          $id_ruangan = $this->uri->segment(6);// karena ini bisa nol / null daripada int
		          $pxe        = $this->uri_auto(7, null, false);

		          $result = $this->m_member->logbook_all(
		              $first_date,
		              $last_date,
		              $id_ruangan,
		              $pxe
		          );

		          $this->output
		              ->set_content_type('application/json')
		              ->set_output(json_encode($result));
		    break;

			case 'data_kewenangan':

			    header('Content-Type: application/json');

			    $dt = $this->input->post();

			    $res = $this->m_ol_rancak->datatable_kewenangan_logbook($dt);

			    echo json_encode([
			        "draw"            => intval($dt['draw'] ?? 1),
			        "recordsTotal"    => intval($res['total'] ?? 0),
			        "recordsFiltered" => intval($res['filtered'] ?? 0),
			        "data"            => $res['data'] ?? []
			    ]);
			    exit;
			break;

			case 'pasien_cari_data':
			    $keyword = $this->input->get('query', TRUE);

			    $hasil['suggestions'] = $this->m_ol_rancak->search_pasien_all($keyword);

			    echo json_encode($hasil);
			    exit;
			break;

			case 'input_logbook':

				/* 
				echo "<pre>";
			    print_r($_POST);
			    die;
			    */

			    $ids = $this->input->post('id_kewenangan');

			    if (empty($ids) || !is_array($ids)) {
			        show_error("Data kosong, tidak ada kewenangan dipilih.");
			        return;
			    }

			    // ambil data kewenangan sesuai id_jabatan
			    $rows = $this->m_ol_rancak->get_kewenangan_by_ids($ids, $this->session->id_jabatan);

			    $data = [
			        'page'   => 'input_logbook',
			        'header' => 'INPUT LOGBOOK',
			        'title'  => 'INPUT LOGBOOK',
			        'rows'   => $rows,
					'id_sifat_kewenangan' => set_value('id_sifat_kewenangan', $this->input->post("id_sifat_kewenangan")),
					'id_instansi' => set_value('id_instansi', $this->input->post("id_instansi")),
					'tgl_logbook' => !empty($pegawai['tgl_logbook'])
								        ? date('d-m-Y', strtotime($pegawai['tgl_logbook']))
								        : date('d-m-Y'),
			        'ambil_data_instansi'  => $this->m_ol_rancak->ambil_data_instansi(),
			        'sifat'  => $this->m_ol_rancak->cmd_sifat_kewenangan()
			    ];

			    $this->renderpage('input_logbook', $data, 'ra');
			break;

			case 'save_logbook':

			    $ids   = $this->input->post('id_kewenangan');
			    $sifat = $this->input->post('id_sifat_kewenangan');
			    $jml   = $this->input->post('jml_logbook');
			    $id_instansi   = $this->input->post('id_instansi');

			    if (empty($ids) || !is_array($ids)) {
			        show_error("Data kosong, tidak ada kewenangan.");
			        return;
			    }

			    $tgl_logbook_input = $this->input->post('tgl_logbook', true);
			    $tgl_logbook_db = null;

			    if (!empty($tgl_logbook_input)) {
			        $tgl_logbook_db = date('Y-m-d', strtotime(str_replace('/', '-', $tgl_logbook_input)));
			    }

			    $this->db->trans_start();

			    foreach ($ids as $i => $coun_kewenangan) {
			        $id_logbook = $this->m_rancak->kode_generator_urut(15,'LB');
			        $barcode_logbook = $this->m_rancak->kode_generator_urut(15,'LB');
			        $id_kewenangan = $this->m_umum->ambil_data('nkr_kewenangan','coun_kewenangan',$coun_kewenangan);
			        $dataInsert = [

			            'id_logbook'         => $id_logbook,
			            'id_kewenangan'      => $id_kewenangan['id_kewenangan'],
			            'id_instansi'        => $id_instansi,
			            'id_unit'            => $this->session->unit,
			            'jml_logbook'        => $jml[$i] ?? 0,
			            'id_sifat_kewenangan'=> $sifat[$i] ?? null,
			            'tgl_logbook'        => $tgl_logbook_db,
			            'barcode_logbook'    => $barcode_logbook,
			            'id_logbooker'       => $this->session->id_pegawai

			        ];

			        $this->db->insert('ol_logbook', $dataInsert);
			    }

			    $this->db->trans_complete();

			    if ($this->db->trans_status() === FALSE) {
			        $this->session->set_flashdata('swal', [
			            'status' => 'error',
			            'title'  => 'Gagal',
			            'message'=> 'Terjadi kesalahan saat menyimpan logbook',
			            'toast'  => true
			        ]);
			    } else {
			        $this->session->set_flashdata('swal', [
			            'status' => 'success',
			            'title'  => 'Berhasil',
			            'message'=> 'Logbook berhasil disimpan',
			            'toast'  => true
			        ]);
			    }

			    redirect('ol_logbook/logbook');
			break;

		    case 'pasien_tambah':
			    $data = $this->input->method() === 'post'
			        ? $this->input->post()
			        : $this->input->get();

			    $id = $data['id_logbook'] ?? null;

			    $pegawai_fields = [
			        'id_pasien',
			        'rm',
			        'nama_pasien',
			        'tmp_lahir',
			        'jk',
			        'alamat'
			    ];

			    foreach ($pegawai_fields as $field) {
			        $form_default[$field] = $pegawai[$field] ?? null;
			    }

			    foreach ($form_default as $field => $value) {
			        $form_data[$field] = set_value($field, $value);
			    }

			    // ==========================
			    // DATA VIEW
			    // ==========================
			    $data = [
			        'page'              => 'pasien_tambah',
			        'header'            => 'TAMBAH PASIEN',
			        'title'             => 'TAMBAH PASIEN',
			        'gender'            => $this->m_rancak->cmd_jk(),
			        'tgl_lahir'         => date('d-m-Y'),
			        'id_logbook'        => $id
			    ];

			    $data = array_merge($data, $form_data);

		        $this->load->view("member/isi",$data);
		    break;

			case 'simpan_pasien':

			    $id_logbook = $this->input->post('id_logbook', true);

			    $tgl_lahir_input = $this->input->post('tgl_lahir', true);
			    $tgl_lahir_db = !empty($tgl_lahir_input)
			        ? date('Y-m-d', strtotime(str_replace('/', '-', $tgl_lahir_input)))
			        : null;

			    $data_pasien = [
			        'nama_pasien' => trim($this->input->post('nama_pasien', true)),
			        'rm'          => trim($this->input->post('rm', true)),
			        'tmp_lahir'   => trim($this->input->post('tmp_lahir', true)),
			        'tgl_lahir'   => $tgl_lahir_db,
			        'jk'          => trim($this->input->post('jk', true)),
			        'alamat'      => trim($this->input->post('alamat', true)),
			    ];

			    if(empty($data_pasien['nama_pasien']) || empty($data_pasien['rm'])){
			        echo json_encode(['ok'=>false,'msg'=>'Nama Pasien dan RM harus diisi']);
			        return;
			    }

			    $this->db->trans_begin();

			    // cek pasien existing berdasarkan RM
			    $existing_pasien = $this->db->get_where('ol_pasien', ['rm'=>$data_pasien['rm']])->row_array();

			    if(!$existing_pasien){

			        $data_pasien['id_pasien'] = $this->m_rancak->kode_generator(15,'PS');
			        $this->db->insert('ol_pasien', $data_pasien);

			    } else {

			        $data_pasien['id_pasien'] = $existing_pasien['id_pasien'];

			        $this->db->where('id_pasien', $existing_pasien['id_pasien']);
			        $this->db->update('ol_pasien', $data_pasien);
			    }

			    if($this->db->affected_rows() < 0){
			        $this->db->trans_rollback();
			        echo json_encode(['ok'=>false,'msg'=>'Gagal menyimpan data pasien']);
			        return;
			    }

			    // insert logbook pasien jika belum ada
			    $cek_lp = $this->db->get_where('ol_logbook_pasien', [
			        'id_pasien'  => $data_pasien['id_pasien'],
			        'id_logbook' => $id_logbook
			    ])->row_array();

			    if(!$cek_lp){

			        $data_logbook_pasien = [
			            'id_logbook_pasien' => $this->m_rancak->kode_generator_urut(15,'LP'),
			            'id_pasien'         => $data_pasien['id_pasien'],
			            'id_logbook'        => $id_logbook
			        ];

			        $this->db->insert('ol_logbook_pasien', $data_logbook_pasien);

			        if($this->db->affected_rows() <= 0){
			            $this->db->trans_rollback();
			            echo json_encode(['ok'=>false,'msg'=>'Gagal menyimpan data logbook pasien']);
			            return;
			        }
			    }

			    if($this->db->trans_status() === false){
			        $this->db->trans_rollback();
			        echo json_encode(['ok'=>false,'msg'=>'Terjadi kesalahan saat menyimpan data']);
			        return;
			    }

			    $this->db->trans_commit();
			    echo json_encode([
			        'ok'=>true,
			        'msg'=>'Data pasien berhasil disimpan'
			    ]);

			break;

			case 'modal_edit_pasien':

			    $data_pasien = [
			        'page'              => 'modal_edit_pasien',
			        'header'            => 'EDIT PASIEN',
			        'title'             => 'EDIT PASIEN',
			        'gender'            => $this->m_rancak->cmd_jk(),
			        'id_logbook_pasien' => $this->input->get('id_logbook_pasien'),
			        'id_logbook'      	=> $this->input->get('id_logbook'),
			        'id_pasien'      	=> $this->input->get('id_pasien'),
			        'rm'             	=> $this->input->get('rm'),
			        'nama_pasien'    	=> $this->input->get('nama_pasien'),
			        'tmp_lahir'      	=> $this->input->get('tmp_lahir'),
			        'alamat'         	=> $this->input->get('alamat'),
			        'jk'         		=> $this->input->get('jk'),
			        'child_table_id' 	=> $this->input->get('child_table_id'),
			    ];

			    $id_pasien = $this->input->post('id_pasien');
			    $this->db->join('ol_pasien', 'ol_pasien.id_pasien = ol_logbook_pasien.id_pasien', 'left');
			    $data['pasien'] = $this->db->get_where('ol_logbook_pasien', [
			        'ol_logbook_pasien.id_pasien' => $data_pasien['id_pasien'],
			        'ol_logbook_pasien.id_logbook' => $data_pasien['id_logbook']
			    ])->row_array();

			    $tgl_lahir_input = $this->input->get('tgl_lahir', true);
			    $tgl_lahir_db = !empty($tgl_lahir_input)
			        ? date('Y-m-d', strtotime(str_replace('/', '-', $tgl_lahir_input)))
			        : null;

			    $data_pages = [
			        'tgl_lahir'        => $tgl_lahir_input
			    ];
			    $data = array_merge($data_pasien, $data_pages);
			    $this->load->view("member/isi",$data);
			break;

			case 'update_pasien':

			    $id_logbook_pasien = $this->input->post('id_logbook_pasien');
			    $rm = $this->input->post('rm');
			    $pasien = $this->m_umum->ambil_data('ol_pasien','rm',$rm);

			    $update = [
			        'id_pasien' => $pasien['id_pasien']
			    ];

			    $this->db->where('id_logbook_pasien', $id_logbook_pasien);
			    $ok = $this->db->update('ol_logbook_pasien', $update);

			    echo json_encode([
			        'ok'  => $ok,
			        'msg' => $ok ? 'Data pasien berhasil diupdate' : 'Update gagal'
			    ]);
			break;
		      /* ===============================
		       * DELETE
		       * =============================== */
		    case 'modal_hapus_pasien':

			    $data = [
			    	'page'              => 'modal_hapus_pasien',
			        'header'            => 'HAPUS PASIEN',
			        'title'             => 'HAPUS PASIEN',
			        'id_logbook_pasien' => $this->input->get('id_logbook_pasien'),
			        'child_table_id' 	=> $this->input->get('child_table_id'),
			        'nama_pasien'      	=> $this->input->get('nama_pasien')
			    ];

			    $this->load->view("member/isi",$data);
		    break;

		    case 'delete_pasien':

			    $id_logbook_pasien = $this->input->post('id_logbook_pasien');

			    $this->db->where('id_logbook_pasien', $id_logbook_pasien);
			    $ok = $this->db->delete('ol_logbook_pasien');

			    echo json_encode([
			        'ok'  => $ok,
			        'msg' => $ok ? 'Data pasien berhasil dihapus' : 'Hapus gagal'
			    ]);
		    break;



			case 'pdf_logbook':
				$report = $this->load->view('cetak/ol_logbook_bulanan', $data, TRUE);
				$namaku = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$this->session->id_pegawai);
				$filename = date('dmYHis').'bcp-'.$namaku['nama_pegawai']."-bcp-kompetensi.pdf";
				//	  $mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'P','margin_left' => '5','margin_right' => '5','margin_top' => '5','margin_bottom' => '5']);
				// Define a default Landscape page size/format by name
				$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-L']);
				// Define a default page size/format by array - page will be 190mm wide x 236mm height
				$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [190, 236]]);
				// Define a default page using all default values except "L" for Landscape orientation
				$mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);
				$mpdf->SetTitle($data['header']);
				$mpdf->SetAuthor($data['instance_name']);
				$mpdf->AddPage('L', '', '', '', 2, 5, 5, 5, 0, 0, 0);
				$mpdf->SetDisplayMode('fullpage');
				$mpdf->SetHTMLFooter('<div style="text-align: center">{PAGENO}</div>');
				//  $mpdf->SetFooter('Page : {PAGENO}');
				//	  $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
				for ($i = 1; $i > 2; $i++) {
				$mpdf->SetHTMLFooter('');
				}		  
				ini_set("pcre.backtrack_limit", "5000000");
				$mpdf->WriteHTML($report);
				$mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
			break;


		    default:
		          show_404();
	    }
	}

	public function modal_logbook()
	{
	    $ids = $this->input->post('id_kewenangan');

	    if (empty($ids) || !is_array($ids)) {
	        echo json_encode([
	            'status' => false,
	            'msg' => 'Data kosong'
	        ]);
	        return;
	    }

	    $rows = $this->m_ol_rancak->get_kewenangan_by_ids($ids, $this->session->id_jabatan);

	    $data['rows']  = $rows;
	    $data['sifat'] = $this->m_ol_rancak->cmd_sifat_kewenangan();

	    $html = $this->load->view('ol_logbook/modal_input_logbook', $data, true);

	    echo json_encode([
	        'status' => true,
	        'html' => $html
	    ]);
	}

  // ========================================================================
	function index(){
		$this->logbook();
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
  function logbooks($mode='view')
  {
		$data['page']  = "logbook";
		$data['header'] = "LOGBOOK";
		$data['title'] = "LOGBOOK";
		$data['link_kembali'] = base_url('member');
		$data['link_awal'] = base_url('ol_logbook/logbook');
		$pegawai=$this->m_ol_rancak->ambil_user_pegawai($this->session->id_user);
	//	$program = $this->m_umum->ambil_data('a_program','id_program',$pegawai['id_program']);
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
/*		$data['multi_level'] = $this->m_ol_rancak->ambil_data_link_pengurus($this->session->id_pegawai);
		$data['ol_akses'] = $this->m_ol_rancak->ol_akses($this->session->id_pegawai);*/
		$data['ambil_data_a_online'] = $this->m_ol_rancak->ambil_data_a_online();
		$data['ambil_data_instansi'] = $this->m_ol_rancak->ambil_data_instansi();
		$data['ambil_data_instansi_null'] = $this->m_ol_rancak->ambil_data_instansi_null();
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
		$data['first_date'] = $this->uri->segment(4, 0);
		$data['last_date'] = $this->uri->segment(5, 0);
		$data['id_ruangan'] = $this->uri->segment(6, 0);
		$data['pxe'] = $this->uri->segment(7, 0);
		$data['break'] = $this->uri->segment(8, 0);
		$data['kpkw'] = $this->uri->segment(9, 0);
		if(empty($data['first_date'])){
			if($this->session->has_userdata('first_date_log')){
				$data['first_date'] = $this->session->first_date_log;
			}else{
				$data['first_date'] = '01-'.date('m-Y');
			}
		}
		if(empty($data['last_date'])){
			if($this->session->has_userdata('last_date_log')){
				$data['last_date'] = $this->session->last_date_log;
			}else{
				$data['last_date'] = date('d-m-Y');
			}
		}
		$data['ambil_data_kompetensi_null'] = $this->m_ol_rancak->ambil_data_kompetensi_null($data['first_date'],$data['last_date'],$data['id_ruangan']);
    if($mode=='view'){
		$this->tampil_top($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$first_date = $this->input->post("first_date");
			$last_date = $this->input->post("last_date");
			$id_instansi = $this->input->post("id_instansi");
			$pxe = $this->input->post("id_kompetensi");
			$data_user_level = array(
				'first_date_log'     => $first_date,
				'last_date_log'     => $last_date
			);	
			$this->session->set_userdata($data_user_level);						
//			$this->session->set_tempdata('otp', $your_value, 1000);
			redirect(base_url('ol_logbook/logbook/view/'.$first_date.'/'.$last_date.'/'.$id_instansi.'/'.$pxe));
		}
	}
    else if($mode=='data'){
		echo json_encode($this->m_member->logbook_all($data['first_date'],$data['last_date'],$data['id_ruangan'],$data['pxe']));
	}
  else if($mode=='hapus'){
  	$cek = $this->m_umum->ambil_data('ol_logbook','id_logbook',$data['first_date']);
  	if($cek['id_pengajuan'] > 0){
  		$this->session->set_flashdata('danger', 'Data SUdah Masuk Pengajuan Kompetensi');
  	}else{
  		$this->m_umum->hapus_data('ol_logbook','id_logbook',$data['first_date']);
  		$this->m_umum->hapus_data('ol_logbook_pasien','id_logbook',$data['first_date']);
  		$this->session->set_flashdata('sukses', 'Data Berhasil Di Hapus');
  	}
  	redirect(base_url('ol_logbook'));
  }
  else{
		$data['kr_kewenangan_detil']=$this->m_ol_rancak->opsi_logbook_new();
		$data['sifat']=$this->m_ol_rancak->cmd_sifat_kewenangan();
	    if($mode=='edit'){
	      $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('ol_logbook','barcode_logbook',$data['first_date']);
				$data['rm']  = set_value('rm',$keuangan["rm"]);
				$data['jml_logbook']  = set_value('jml_logbook',$keuangan["jml_logbook"]);
				$data['barcode_logbook']  = set_value('barcode_logbook',$keuangan["barcode_logbook"]);
				$data['id_pengajuan']  = set_value('id_pengajuan',$keuangan["id_pengajuan"]);
				$data['id_logbook']  = set_value('id_logbook',$keuangan["id_logbook"]);
				$data['id_instansi']  = set_value('id_instansi',$keuangan["id_instansi"]);
				$data['id_sifat_kewenangan']  = set_value('id_sifat_kewenangan',$keuangan["id_sifat_kewenangan"]);
				$data['tgl_logbook']  = set_value('tgl_logbook', date('d-m-Y',strtotime($keuangan["tgl_logbook"])));
				$this->load->view("member/isi",$data);
	    }
	    if($mode=='simpan_edit'){
	    	$id_pengajuan = $this->input->post('id_pengajuan');
				if($id_pengajuan == 0){
					  if($this->m_member->edit_logbook()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('ol_logbook/logbook'));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('ol_logbook/logbook'));
					  }
					}else{
							$this->session->set_flashdata('danger', 'Data SUdah Masuk Pengajuan Kompetensi');
							redirect(base_url('ol_logbook/logbook'));
					  }
	    }
	    if($mode=='sign'){
	      $data['page'] =  $data['page']."_sign";
	      $kondisi = array('barcode_pegawai'=>$this->session->barcode_pegawai,'id_unit'=>$this->session->unit);
				$jml    = $this->m_umum->jumlah_record_filter('ol_logbook_signature',$kondisi);
				if($jml == 0){
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
				}else{
					$keuangan    = $this->m_umum->ambil_data_kondisi('ol_logbook_signature',$kondisi);
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
				}
				$this->load->view("member/isi",$data);
	    }
	    if($mode=='simpan_sign'){
	      $kondisi = array('barcode_pegawai'=>$this->session->barcode_pegawai,'id_unit'=>$this->session->unit);
				$jml    = $this->m_umum->jumlah_record_filter('ol_logbook_signature',$kondisi);
				if($jml == 0){
					  if($this->m_member->simpan_signature()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('ol_logbook/logbook'));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('ol_logbook/logbook'));
					  }
					}else{
					  if($this->m_member->edit_signature()){
							$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
							redirect(base_url('ol_logbook/logbook'));
					  }else{
							$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
							redirect(base_url('ol_logbook/logbook'));
					  }
					}
	    }
    if($mode=='pasien'){
    	$data['page'] =  $data['page']."_pasien";
      if(empty($data['first_date']) OR $data['first_date'] == 0){
        $this->session->set_flashdata('danger', 'ID Kosong');
        redirect(base_url('ol_logbook/logbook'));
    	}
	 		$kondisi_idlog=array('id_logbook'=>$data['first_date']);
			$jml_idlog = $this->m_umum->jumlah_record_filter('ol_logbook',$kondisi_idlog);
			if($jml_idlog == 0){
        $this->session->set_flashdata('danger', 'ID Tidak Terdaftar');
        redirect(base_url('ol_logbook/logbook'));				
			}
      $aktivitas    = $this->m_umum->ambil_data('ol_logbook','id_logbook',$data['first_date']);
      $data['cmd_jk']    = $this->m_rancak->cmd_jk();
      $data['cmd_bahan']    = $this->m_ol_rancak->cmd_bahan();
      $data['cmd_reject']    = $this->m_ol_rancak->cmd_reject();
      $data['cmd_satuan_umur']    = array('2'=>'Tahun','1'=>'Bulan','0'=>'Hari');
      $data['data_pasien']    = $this->m_umum->ambil_data_result('ol_logbook_pasien','id_logbook',$data['first_date']);
      $data['id_logbook']  = set_value('id_logbook',$aktivitas["id_logbook"]);
      $this->form_validation->set_rules('id_logbook','id_logbook','required');
      if ($this->form_validation->run() === FALSE){
        $this->tampil_top($data);
      }else{
		  	$this->m_member->simpan_pasien();
				$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
				redirect(base_url('ol_logbook/logbook'));
      }
    }
		if($mode=='pdf_pasien'){
	    $report = $this->load->view('cetak/ol_logbook_pasien', $data, TRUE);
		  $namaku = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$this->session->id_pegawai);
		  $filename = date('dmYHis').'-bcp-'.$namaku['nama_pegawai']."-bcp-pasien.pdf";
	//    $mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'L','margin_left' => '5','margin_right' => '5','margin_top' => '5','margin_bottom' => '5']);
	//	  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
// Define a default Landscape page size/format by name
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
// Define a default page size/format by array - page will be 190mm wide x 236mm height
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [190, 236]]);
// Define a default page using all default values except "L" for Landscape orientation
$mpdf = new \Mpdf\Mpdf(['orientation' => 'P']);
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->AddPage('P', '', '', '', 2, 5, 5, 5, 0, 0, 0);
		  $mpdf->SetDisplayMode('fullpage');
		 // $mpdf->SetFooter('Page : {PAGENO}');
		//  $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
		  $mpdf->SetHTMLFooter('<div style="text-align: center">{PAGENO}</div>');
			for ($i = 1; $i > 2; $i++) {
		  $mpdf->SetHTMLFooter('');
			}		  
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
		if($mode=='pdf_analisis'){
	    $report = $this->load->view('cetak/ol_logbook_anaisis', $data, TRUE);
		  $namaku = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$this->session->id_pegawai);
		  $filename = date('dmYHis').'-bcp-'.$namaku['nama_pegawai']."-bcp-analisis.pdf";
	//    $mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'L','margin_left' => '5','margin_right' => '5','margin_top' => '5','margin_bottom' => '5']);
// Define a default Landscape page size/format by name
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
// Define a default page size/format by array - page will be 190mm wide x 236mm height
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [190, 236]]);
// Define a default page using all default values except "L" for Landscape orientation
$mpdf = new \Mpdf\Mpdf(['orientation' => 'P']);
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->AddPage('P', '', '', '', 2, 5, 5, 5, 0, 0, 0);
		  $mpdf->SetDisplayMode('fullpage');
		 $mpdf->SetHTMLFooter('<div style="text-align: center">{PAGENO}</div>');
		//  $mpdf->SetFooter('Page : {PAGENO}');
		//  $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
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
// Define a default Landscape page size/format by name
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-L']);
// Define a default page size/format by array - page will be 190mm wide x 236mm height
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [190, 236]]);
// Define a default page using all default values except "L" for Landscape orientation
$mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->AddPage('L', '', '', '', 2, 5, 5, 5, 0, 0, 0);
		  $mpdf->SetDisplayMode('fullpage');
		  $mpdf->SetHTMLFooter('<div style="text-align: center">{PAGENO}</div>');
		//  $mpdf->SetFooter('Page : {PAGENO}');
	//	  $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
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
// Define a default Landscape page size/format by name
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
// Define a default page size/format by array - page will be 190mm wide x 236mm height
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [190, 236]]);
// Define a default page using all default values except "L" for Landscape orientation
$mpdf = new \Mpdf\Mpdf(['orientation' => 'P']);
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->AddPage('P', '', '', '', 2, 5, 5, 5, 0, 0, 0);
		  $mpdf->SetDisplayMode('fullpage');
		  $mpdf->SetHTMLFooter('<div style="text-align: center">{PAGENO}</div>');
		//  $mpdf->SetFooter('Page : {PAGENO}');
	//	  $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
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
// Define a default Landscape page size/format by name
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-L']);
// Define a default page size/format by array - page will be 190mm wide x 236mm height
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [190, 236]]);
// Define a default page using all default values except "L" for Landscape orientation
$mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->AddPage('L', '', '', '', 2, 5, 5, 5, 0, 0, 0);
		  $mpdf->SetDisplayMode('fullpage');
		  $mpdf->SetHTMLFooter('<div style="text-align: center">{PAGENO}</div>');
		//  $mpdf->SetFooter('Page : {PAGENO}');
	//	  $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
			for ($i = 1; $i > 2; $i++) {
		  $mpdf->SetHTMLFooter('');
			}		  
		  ini_set("pcre.backtrack_limit", "5000000");
		  $mpdf->WriteHTML($report);
		  $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
		}
		if($mode=='pdf_tahunan'){
		  $report = $this->load->view('cetak/ol_logbook_tahunan', $data, TRUE);
		  $namaku = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$this->session->id_pegawai);
		  $filename = date('dmYHis').'bcp-'.$namaku['nama_pegawai']."-bcp-kompetensi.pdf";
	//	  $mpdf = new \Mpdf\Mpdf(['format' => 'Legal'.'-'.'P','margin_left' => '5','margin_right' => '5','margin_top' => '5','margin_bottom' => '5']);
// Define a default Landscape page size/format by name
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
// Define a default page size/format by array - page will be 190mm wide x 236mm height
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [190, 236]]);
// Define a default page using all default values except "L" for Landscape orientation
$mpdf = new \Mpdf\Mpdf(['orientation' => 'P']);
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->AddPage('P', '', '', '', 2, 5, 5, 5, 0, 0, 0);
		  $mpdf->SetDisplayMode('fullpage');
		  $mpdf->SetHTMLFooter('<div style="text-align: center">{PAGENO}</div>');
		//  $mpdf->SetFooter('Page : {PAGENO}');
	//	  $mpdf->SetHTMLFooter('<div style="text-align: center">Halaman {PAGENO} dari {nbpg}</div>');
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
// Define a default Landscape page size/format by name
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-P']);
// Define a default page size/format by array - page will be 190mm wide x 236mm height
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [190, 236]]);
// Define a default page using all default values except "L" for Landscape orientation
$mpdf = new \Mpdf\Mpdf(['orientation' => 'P']);
		  $mpdf->AddPage('P', '', '', '', 2, 5, 5, 5, 0, 0, 0);
		  $mpdf->SetDisplayMode('fullpage');
		  $mpdf->SetTitle($data['header']);
		  $mpdf->SetAuthor($data['instance_name']);
		  $mpdf->defaultheaderline = 0;
	      $mpdf->defaultfooterline = 0;
	      //  $mpdf->SetFooter('Page : {PAGENO}');
	      $mpdf->SetHTMLFooter('<div style="text-align: center">{PAGENO}</div>');
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
/* 		
$mpdf = new \Mpdf\Mpdf();

$mpdf->useOddEven = 1;
$mpdf->defHeaderByName(
    'myHeader', array (
        'L' => array (),
        'R' => array (),
        'C' => array (
            'content' => 'Chapter 2',
            'font-style' => 'B',
            'font-family' => 'serif'
        ),
        'line' => 1,
    )
);
$mpdf->defHTMLHeaderByName(
    'myHeader2',
    '<div style="text-align: center; font-weight: bold;">Chapter 2</div>'
);
$mpdf->WriteHTML('Your Introduction');

// Selects new headers for ODD and EVEN pages to use from the new page onwards
// Note the html_ prefix before the named HTML header
$mpdf->AddPage(
    '','NEXT-ODD','','','','','','','','','',
    'myHeader', 'html_myHeader2', '', '',
    1, 1, 0, 0
);
$mpdf->WriteHTML('Your Book text');

// Turns all headers/footers off from new page onwards
$mpdf->AddPage(
    '','NEXT-ODD','','','','','','','','','',
    '','','','',
    -1,-1,-1,-1
);
$mpdf->WriteHTML('End section of book with no headers');

//=====================================
$mpdf = new \Mpdf\Mpdf();

$mpdf->WriteHTML('Your Introduction');
$mpdf->AddPage('L','','','','',50,50,50,50,10,10);
$mpdf->WriteHTML('Your Book text');
//=====================================

$mpdf->WriteHTML('Your Foreword and Introduction');
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
