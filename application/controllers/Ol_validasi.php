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
  // ========================================================================
    function menu_halaman()
    {
        return 
            [
                [
                    'type'  => 'title',
                    'label' => 'Member'
                ],
                [
                    'type'   => 'parent',
                    'id'     => 'member-tools',
                    'label'  => 'Halaman',
                    'icon'   => 'ph-duotone ph-user',
                    'children' => [
                        ['label'=>'Profil','url'=>'member/profil'],
                        ['label'=>'Log Out','url'=>'logout']
                    ]
                ]
            ];
    }
// ========================================================================
function validasi($mode = 'view')
{
    switch ($mode) {

        case 'view':
            $data = [
                'header'            => 'PROFIL USER',
                'title'             => 'PROFIL USER'
            ];

            //$data = array_merge($data, $form_data);
            $this->renderpage('validasi', $data, 'ra', 'ol_validasi');
            break;

        case 'validasi':
            $data = [
                'header'            => 'PROFIL USER',
                'title'             => 'PROFIL USER'
            ];

            //$data = array_merge($data, $form_data);
            $this->renderpage('validasi_validasi', $data, 'ra', 'ol_validasi');
            break;

case 'rkk':

    $id_kewenangan   = $this->uri_auto(4);      // STRING
    $id_pegawai    = $this->uri_int(5);       // INT
    $id_sifat_kewenangan = $this->uri_int(6, false);
    $barcode_pegawai = $this->uri_auto(7, null, false); // STRING optional

    $logbook = $this->m_umum->ambil_data_kondisi(
        'ol_logbook',
        [
            'id_logbooker'  => $id_pegawai,
            'id_kewenangan' => $id_kewenangan
        ],
        'id_kewenangan'
    );

    if (!$logbook) {
        show_error('Data logbook tidak ditemukan', 404);
    }

    $pegawai = $this->m_umum->ambil_data(
        'ol_pegawai',
        'id_pegawai',
        $logbook['id_logbooker']
    );

    $data = [
        'page'                 => 'validasi_rkk',
        'barcode_pegawai'      => $pegawai['barcode_pegawai'],
        'id_kewenangan'      => $id_kewenangan,
        'rkk'                  => $this->m_rancak->cmd_status_rkk(),
        'statuse'              => $this->m_rancak->cmd_status(),
        'sifat_kewenangan'     => $this->m_ol_rancak->cmd_sifat_kewenangan(),
        'attr_ra'              => ['class' => 'select-example'],
        'id_sifat_kewenangan'  => set_value('id_sifat_kewenangan', $id_sifat_kewenangan),
        'status_validasi'      => set_value('status_validasi',$this->input->post("status_validasi"))
    ];

    // LOAD MODAL ONLY
    $this->load->view('ol_validasi/isi', $data);
    break;

        case 'simpan_rkk':
            if (!$this->input->is_ajax_request()) {
                swal_response([
                    'status'  => 'error',
                    'title'   => 'Akses Ditolak',
                    'message' => 'Request tidak valid'
                ]);
            }

            $result = $this->m_ol_validasi->simpan_rkk(
                $this->input->post('id_kewenangan'),
                $this->input->post('barcode_pegawai'),
                $this->input->post('id_sifat_kewenangan'),
                $this->input->post('status_validasi')
            );

            swal_response(array_merge($result, [
                'reload' => true
            ]));

            //$data = array_merge($data, $form_data);
       //     $this->renderpage('validasi_validasi', $data, 'ra', 'ol_validasi');
            break;

        case 'data':
            $dt  = $this->datatable_request();
            $res = $this->m_ol_validasi->datatable_pegawai($dt);

            $this->datatable_response(
                $dt['draw'],
                $res['total'],
                $res['filtered'],
                $res['data']
            );
            break;

        case 'child_pegawai':
            $pegawai = $this->input_auto('barcode_pegawai');
            $dt      = $this->datatable_request();
            $res     = $this->m_ol_validasi->datatable_child($pegawai, $dt);

            $this->datatable_response(
                $dt['draw'],
                $res['total'],
                $res['filtered'],
                $res['data']
            );
            break;

        case 'logbook':
            $pegawai = $this->input_auto('barcode_pegawai');
            $dt      = $this->datatable_request();
            $res     = $this->m_ol_validasi->datatable_logbook($pegawai, $dt);

            $this->datatable_response(
                $dt['draw'],
                $res['total'],
                $res['filtered'],
                $res['data']
            );
            break;

        default:
            show_404();
    }
}

// ========================================================================
	function index(){
		$this->validasi();
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
}
