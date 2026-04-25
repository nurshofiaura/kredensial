<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Controller extends CI_Controller
{
    protected $user_tz;
    protected $menu_master = [];
    protected $cards = [];
    protected $data = [];
    protected $layout = 'ra'; // default
    public function __construct()
    {
        parent::__construct();
        // timezone dari session (JS browser)
        $this->user_tz = $this->session->userdata('timezone') ?: 'Asia/Jakarta';
        // SERVER & DB tetap UTC
        $this->data['segments'] = $this->uri->segment_array();

        foreach ($this->data['segments'] as $i => $val) {
            $this->data["id$i"] = $val;
        }
/*
        $id     = $this->data['id3'];       // 15
        $action = $this->data['id2'];       // edit
        $all    = $this->data['segments'];  // array semua segment
*/
        date_default_timezone_set('UTC');
        $menu_online_all = $this->menu_online();              // SEMUA a_online
        $menu_online_enabled = $this->menu_online_enabled();

        // 👉 TOTAL 4 MENU
        $this->menu_master = array_merge(
            $menu_online_all,
            $menu_online_enabled
        );
        $id_user = $this->session->id_user;
        $id_pegawai = $this->session->id_pegawai;
        $barcode_pegawai = $this->session->barcode_pegawai;

        // instansi & pegawai (sesuaikan sumbernya)
        $instansi = $this->m_umum->ambil_data('a_instansi', 'id_instansi', 1);
        $pegawai = $this->m_ol_rancak->ambil_user_pegawai($id_user);

        // ===== DATA POKOK / GLOBAL =====
        $this->data = array_merge($this->data, [
            'instance_id'    => $instansi['id_instansi'],
            'instance_name'  => $instansi['nama_instansi'],
            'idescription'   => $instansi['description'],
            'ikeywords'      => $instansi['keywords'],
            'iheader'        => $instansi['header'],
            'iheader_mini'   => $instansi['header_mini'],
            'ifooter'        => $instansi['footer'],
            'ilicensed'      => $instansi['licensed'],

            'member_id'      => $pegawai['id_pegawai'],
            'member_name'    => $pegawai['nama_pegawai'],
            'level_name'     => $pegawai['nama_level'],
            'photo'          => $pegawai['foto'],
            'menu' => $this->merge_menu($this->menu_halaman()),
            'pegawai'        => $pegawai, // 👈 PENTING
            'instansi'        => $instansi, // 👈 PENTING
        ]);
    }

    /* ===============================
       MENU ONLINE (DB)
    ================================ */
    protected function menu_online()
    {
        $rows = $this->m_ol_rancak->ambil_data_a_online();

        $children = [];

        // ==============================
        // MENU DARI DATABASE
        // ==============================
        if ($rows) {
            foreach ($rows as $r) {
                $children[] = [
                    'label' => $r['nama_menu'],
                    'url'   => $r['kode_online']
                ];
            }
        }
        // ==============================
        // MENU STATIS (yang kamu tulis)
        // ==============================
        $children = array_merge($children, [
            ['label'=>'Biodata',            'url'=>'member/profil'],
            ['label'=>'Latihan Pengajuan',  'url'=>'member/tes'],
            ['label'=>'Berkas',             'url'=>'member/berkas'],
            ['label'=>'Ijasah',             'url'=>'member/ijasah'],
            ['label'=>'Pelatihan',          'url'=>'member/pelatihan'],
            ['label'=>'Surat Ijin',         'url'=>'member/surat_ijin'],
            ['label'=>'Laporan',            'url'=>'member/report'],
            ['label'=>'Log Out',            'url'=>'logout'],
        ]);

        return [
            [
                'type'     => 'parent',
                'id'       => 'menu-level',
                'label'    => 'Menu Online',
                'icon'     => 'ph-duotone ph-globe',
                'children' => $children
            ]
        ];
    }
    protected function menu_online_enabled()
    {
        if (empty($this->session->id_pegawai)) {
            return [];
        }

        $rows = $this->m_ol_rancak->ambil_data_a_enabled();

        if (!$rows) return [];

        $children = [];
        foreach ($rows as $r) {
            $children[] = [
                'label' => $r['nama_menu'],
                'url'   => $r['kode_online']
            ];
        }

        return [
            [
                'type'   => 'parent',
                'id'     => 'online-service',
                'label'  => 'Menu Level',
                'icon'   => 'ph-duotone ph-globe',
                'children' => $children
            ]
        ];
    }
    protected function merge_menu(array $extra = [])
    {
        return array_merge($extra, $this->menu_master);
    }
// ====================================================================
protected function renderpage($page, array $data = [], $layout = 'default', $memberFolder = 'member', $modal = false)
{
    // Simpan nama view content
    $data['page'] = $page;
    $data['member_folder'] = $memberFolder;

    // Merge data global + spesifik
    $finalData = array_merge($this->data, $data);

    // ================================
    // MODE MODAL (AJAX) => TANPA LAYOUT
    // ================================
    if ($modal) {
        $this->load->view($memberFolder . '/isi', $finalData);
        return;
        /*
        $this->renderpage('kompetensi_tambah', $data, 'ra', 'ms_kredensial', true);
        */
    }

    // Mapping layout
    $layouts = [
        'default' => [
            'header' => $memberFolder . '/header',
            'footer' => 'footer',
            'jsload' => $memberFolder . '/jsload',
        ],
        'top' => [
            'header' => 'header_topol',
            'footer' => 'footer',
            'jsload' => $memberFolder . '/jsload',
        ],
        'ra' => [
            'header' => 'header_ra',
            'footer' => 'footer_ra',
            'jsload' => 'jsload_ra',
        ],
        'top_ra' => [
            'header' => 'header_top_ra',
            'footer' => 'footer_ra',
            'jsload' => 'jsload_ra',
        ],
    ];

    $layoutConfig = $layouts[$layout] ?? $layouts['default'];

    // Load layout
    $this->load->view($layoutConfig['header'], $finalData);

    // Load wrapper isi
    $this->load->view($memberFolder . '/isi', $finalData);

    $this->load->view($layoutConfig['footer'], $finalData);
    $this->load->view($layoutConfig['jsload'], $finalData);
    $this->load->view($memberFolder . '/jscode', $finalData);
}

/*    protected function renderpage($page, array $data = [], $layout = 'default', $memberFolder = 'member')
    {
        // Simpan nama view content
        $data['page'] = $page;
        $data['member_folder'] = $memberFolder; // variabel untuk folder member

        // Merge data global + spesifik
        $finalData = array_merge($this->data, $data);

        // Mapping layout
        $layouts = [
            'default' => [
                'header' => $memberFolder . '/header',
                'footer' => 'footer',
                'jsload' => $memberFolder . '/jsload',
            ],
            'top' => [
                'header' => 'header_topol',
                'footer' => 'footer',
                'jsload' => $memberFolder . '/jsload',
            ],
            'ra' => [
                'header' => 'header_ra',
                'footer' => 'footer_ra',
                'jsload' => 'jsload_ra',
            ],
            'top_ra' => [
                'header' => 'header_top_ra',
                'footer' => 'footer_ra',
                'jsload' => 'jsload_ra',
            ],
        ];

        $layoutConfig = $layouts[$layout] ?? $layouts['default'];

        // Load layout
        $this->load->view($layoutConfig['header'], $finalData);

        // Load content utama (member/isi.php)
        // di sini member/isi akan pakai $finalData['page'] untuk load content
        $this->load->view($memberFolder . '/isi', $finalData);

        $this->load->view($layoutConfig['footer'], $finalData);
        $this->load->view($layoutConfig['jsload'], $finalData);
        $this->load->view($memberFolder . '/jscode', $finalData);
        
    }*/
    /*
    // Folder member
    $this->renderpage('home', $data, 'ra', 'member');

    // Folder admin
    $this->renderpage('dashboard', $data, 'default', 'admin');
    */
    protected function render($view, array $data = [])
    {
        $finalData = array_merge($this->data, $data);
        $this->tampil_ra($finalData);
    }
//===========================================================
    protected function generate_cards()
    {
        // ====== DARI ARRAY (STATIC) ======
        $dari_array = [
            [
                'jenis'  => 'url',
                'target' => '',
                'warna'  => 'primary',
                'title'  => 'Profil',
                'value'  => 'Profil',
                'url'    => base_url('member/profil'),
                'id'     => '',
                'class'  => '',
                'image'  => base_url('assets/images/profil.png')
            ],
            [
                'jenis'  => 'url',
                'target' => '',
                'warna'  => 'info',
                'title'  => 'Berkas',
                'value'  => 'Berkas',
                'url'    => base_url('member/berkas'),
                'id'     => '',
                'class'  => '',
                'image'  => base_url('assets/images/berkas.png')
            ],
            [
                'jenis'  => 'url',
                'target' => '',
                'warna'  => 'success',
                'title'  => 'Ijasah',
                'value'  => 'Ijasah',
                'url'    => base_url('member/ijasah'),
                'id'     => '',
                'class'  => '',
                'image'  => base_url('assets/images/ijasah.png')
            ],
            [
                'jenis'  => 'url',
                'target' => '',
                'warna'  => 'warning',
                'title'  => 'Pelatihan',
                'value'  => 'Pelatihan',
                'url'    => base_url('member/pelatihan'),
                'id'     => '',
                'class'  => '',
                'image'  => base_url('assets/images/sertifikat.png')
            ],
            [
                'jenis'  => 'url',
                'target' => '',
                'warna'  => 'danger',
                'title'  => 'Surat Ijin',
                'value'  => 'Surat Ijin',
                'url'    => base_url('member/surat_ijin'),
                'id'     => '',
                'class'  => '',
                'image'  => base_url('assets/images/str.png')
            ],
            [
                'jenis'  => 'url',
                'target' => '',
                'warna'  => 'success',
                'title'  => 'Logbook',
                'value'  => 'Logbook',
                'url'    => base_url('ol_logbook'),
                'id'     => '',
                'class'  => '',
                'image'  => base_url('assets/images/logbook.png')
            ],
            [
                'jenis'  => 'url',
                'target' => '',
                'warna'  => 'warning',
                'title'  => 'Latihan Kompetensi',
                'value'  => 'Latihan Kompetensi',
                'url'    => base_url('member/tes'),
                'id'     => '',
                'class'  => '',
                'image'  => base_url('assets/images/tes.png')
            ],
        ];

        // ====== BILLING ======
        $knds_billing = [
            'barcode_pegawai'       => $this->session->barcode_pegawai,
            'status_mitra'          => 1,
            'status_working_mitra'  => 1
        ];

        $cek_billing = $this->m_umum->jumlah_record_tabel_pengajuan(
            'kol_working_mitra',
            $knds_billing,
            'kol_mitra',
            'id_mitra'
        );

        $dari_billing = [];
        if ($cek_billing > 0) {
            $dari_billing[] = [
                'jenis'  => 'modal',
                'target' => 'id',
                'title'  => 'Billing',
                'value'  => 'Billing',
                'id'     => 'modal-default',
                'url'    => base_url('member/billing_lihat'),
                'class'  => 'open-modal',
                'image'  => base_url('assets/images/billing.png')
            ];
        }

        // ====== DARI DATABASE ======
        $dari_db_raw = $this->m_ol_rancak->ambil_data_a_shortcut();

        $dari_db = [];
        foreach ($dari_db_raw as $r) {

            if (is_object($r)) {
                $r = (array) $r;
            }

            $dari_db[] = [
                'jenis'  => $r['jenis']  ?? 'url',
                'target' => $r['target'] ?? '',
                'warna'  => $r['warna']  ?? 'primary',
                'title'  => $r['title']  ?? $r['nama_menu'] ?? '',
                'value'  => $r['value']  ?? $r['nama_menu'] ?? '',
                'id'     => $r['id']     ?? '',
                'url'    => $r['url']    ?? $r['link_shortcut'] ?? '#',
                'class'  => $r['class']  ?? '',
                'image'  => !empty($r['icon_shortcut'])
                    ? base_url($r['icon_shortcut'])
                    : base_url('assets/images/default.png')
            ];
        }

        // ====== FINAL ======
        $this->cards = array_merge(
            $dari_array ?? [],
            $dari_db ?? [],
            $dari_billing ?? []
        );

        return $this->cards;
    }
//===================================================================
    protected function json($data, $statusCode = 200)
    {
        $this->output
            ->set_status_header($statusCode)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($data, JSON_UNESCAPED_UNICODE))
            ->_display();
        exit;
    }
    protected function respond($status, $message, $data = null, $code = 200)
    {
        $this->json([
            'status'  => $status,
            'message' => $message,
            'data'    => $data
        ], $code);
    }
    protected function success($message, $data = null)
    {
        $this->respond('success', $message, $data, 200);
    }
    protected function error($message, $code = 400)
    {
        $this->respond('error', $message, null, $code);
    }
/*
$this->success('Data berhasil disimpan');
$this->error('Gagal menyimpan data');
return $this->success('Data berhasil disimpan');
*/
protected function datatable_request()
{
    return [
        'draw'    => (int) $this->input->post('draw'),
        'start'   => (int) $this->input->post('start'),
        'length'  => (int) $this->input->post('length'),
        'search'  => $this->input->post('search'),
        'order'   => $this->input->post('order'),

        // SUPPORT ENGINE BARU
        'columns' => $this->input->post('columns') ?? [],

        // SUPPORT ENGINE LAMA (biar ga rusak yg lama)
        'cols'    => $this->input->post('columns') ?? []
    ];
}
    protected function datatable_response($draw, $total, $filtered, $data)
    {
        echo json_encode([
            'draw'            => $draw,
            'recordsTotal'    => $total,
            'recordsFiltered' => $filtered,
            'data'            => $data
        ]);
    }
    /**
     * AUTO INPUT DETECTOR
     * - POST > GET > NULL
     * - ENUM → INT → STRING
     */
    function input_auto($key, $enum = null, $required = true)
    {
        $CI =& get_instance();

        // PRIORITAS POST → GET
        $val = $CI->input->post($key, true);
        if ($val === null) {
            $val = $CI->input->get($key, true);
        }

        if ($val === null || $val === '') {
            if ($required) {
                show_error("Input {$key} wajib diisi", 400);
            }
            return null;
        }

        $val = trim((string) $val);

        // =====================
        // 1️⃣ ENUM
        // =====================
        if (is_array($enum)) {
            if (!in_array($val, $enum, true)) {
                show_error("Input {$key} tidak valid (ENUM)", 403);
            }
            return $val;
        }

        // =====================
        // 2️⃣ INTEGER
        // =====================
        if (ctype_digit($val)) {
            return (int) $val;
        }

        // =====================
        // 3️⃣ STRING
        // =====================
        return $val;
    }
    /**
     * SAFE URI SEGMENT
     * Auto INT / STR / ENUM
     */
    function uri_auto($segment, $enum = null, $required = true)
    {
        $CI =& get_instance();

        $val = $CI->uri->segment($segment);

        if ($val === null || $val === '') {
            if ($required) {
                show_error("URI segment {$segment} wajib diisi", 404);
            }
            return null;
        }

        $val = trim((string) $val);

        // ENUM
        if (is_array($enum)) {
            if (!in_array($val, $enum, true)) {
                show_error("URI segment {$segment} tidak valid", 403);
            }
            return $val;
        }

        // INT
        if (ctype_digit($val)) {
            return (int) $val;
        }

        // STRING
        return $val;
    }
    function uri_int($segment, $required = true)
    {
        $CI =& get_instance();
        $val = $CI->uri->segment($segment);

        // kosong & tidak wajib → return null
        if ($val === null || $val === '') {
            if ($required) show_error("URI segment {$segment} wajib diisi", 404);
            return null;
        }

        // kalau ada isinya, cek angka
        if (!ctype_digit($val)) {
            show_error("URI segment {$segment} harus angka", 400);
        }

        return (int) $val;
    }
    /*
$barcode = $this->uri_auto(4, null, false);

if ($barcode !== null && !is_int($barcode)) {
    show_error('Barcode harus angka', 400);
} 
atau
$barcode = $this->uri_int(4, false);
uri_auto($segment, $enum = null, $required = true);
$barcode = $this->uri_auto(4); artinya
$segment = 4
$enum    = null
$required= true
| URI             | Hasil       |
| --------------- | ----------  |
| `/validasi/123` | `int(123)`  |
| `/validasi/abc` | `"abc"`     |
| `/validasi/`    | ❌ **404**  |

$barcode = $this->uri_auto(4, null, false);
$segment = 4
$enum    = null
$required= false
| URI             | Hasil      |
| --------------- | ---------- |
| `/validasi/123` | `int(123)` |
| `/validasi/abc` | `"abc"`    |
| `/validasi/`    | `null` ✅   |

*/
    function uri_segment_flexible($segment, $required = true)
    {
        $CI =& get_instance();
        $val = $CI->uri->segment($segment);

        if ($val === null || $val === '') {
            if ($required) show_error("URI segment {$segment} wajib diisi", 404);
            return null;
        }

        return $val; // return apa adanya, boleh angka, huruf, gabungan
    }

}