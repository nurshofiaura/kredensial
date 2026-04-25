<?php
class M_ol_rancak extends MY_Model{
//========================================================== ol_logbook tambah
  private $kewenangan_logbook_columns = [
  		null,
      'okm.kode_unit',
      'okm.nama_kompetensi',
      'ok.nama_kewenangan',
      'ol_pegawai_grade.nama_grade'
  ];
private function kewenangan_base_query($plus, $filter_grade = '')
{
    $id_jabatan = $this->session->userdata('id_jabatan');
    $sess_grade = $this->session->userdata('id_grade');
    $sess_area = $this->session->userdata('area_klinis');

    // 1. SELECT tetap sama untuk kedua kondisi
    $this->db->select("
        okm.kode_unit,
        ok.coun_kewenangan,
        okm.nama_kompetensi,
        oka.id_grade,
        ok.nama_kewenangan,
        IFNULL(ol_pegawai_grade.nama_grade, '-') AS nama_grade
    ");

    // 2. Tentukan tabel utama (FROM) berdasarkan kondisi session grade
    if ($sess_grade == 0) {
        $this->db->from("nkr_kewenangan ok");
        $this->db->join("nkr_kewenangan_area oka", "oka.id_kewenangan = ok.id_kewenangan", "left");
    } else {
        $this->db->from("nkr_kewenangan_area oka");
        $this->db->join("nkr_kewenangan ok", "ok.id_kewenangan = oka.id_kewenangan", "left");
    }

    // 3. JOIN yang selalu ada (Global Joins)
    $this->db->join("nkr_kompetensi okm", "okm.id_kompetensi = ok.id_kompetensi", "left");
    $this->db->join("ol_pegawai_grade", "ol_pegawai_grade.id_grade = oka.id_grade", "left");
    $this->db->join("jabatan", "jabatan.id_jabatan = okm.id_jabatan", "left");

    // 4. WHERE Utama
    $this->db->where("okm.id_jabatan", $id_jabatan);

    if (!empty($sess_area) && $sess_area != 0) {
        $this->db->where("oka.id_area_klinis", $sess_area);
    }
    // 5. PRIORITAS FILTER
    if (!empty($filter_grade) && $filter_grade != 0) {
        $this->db->where("oka.id_grade", $filter_grade);
    } else {
        $this->db->group_start()
            ->where("oka.id_grade <=", $plus)
            ->or_where("oka.id_grade IS NULL", null, false)
            ->or_where("oka.id_grade", 0)
        ->group_end();
    }
}
public function datatable_kewenangan_logbook($dt)
{
    $plus = empty($this->session->userdata('id_grade')) ? 1 : ($this->session->userdata('id_grade') + 1);

    $filter_grade = $dt['filter_grade'] ?? '';

    $start  = intval($dt['start'] ?? 0);
    $length = intval($dt['length'] ?? 10);

    $search  = $dt['search']['value'] ?? '';
    $columns = $dt['columns'] ?? [];

    $orderIndex = $dt['order'][0]['column'] ?? 0;
    $orderDir   = $dt['order'][0]['dir'] ?? 'asc';

    $orderCol = $this->kewenangan_logbook_columns[$orderIndex] ?? "okm.kode_unit";

    // =======================
    // DATA
    // =======================
    $this->kewenangan_base_query($plus, $filter_grade);
    $this->datatable_search($this->kewenangan_logbook_columns, $search, $columns);
    $this->db->order_by($orderCol, $orderDir);
    $this->db->limit($length, $start);

    $data = $this->db->get()->result_array();

    // =======================
    // FILTERED COUNT
    // =======================
    $this->kewenangan_base_query($plus, $filter_grade);
    $this->datatable_search($this->kewenangan_logbook_columns, $search, $columns);
    $filtered = $this->db->count_all_results();

    // =======================
    // TOTAL COUNT
    // =======================
    $this->kewenangan_base_query($plus, $filter_grade);
    $total = $this->db->count_all_results();

    return compact('data', 'total', 'filtered');
}
//========================================================== report
protected $report_columns = [
    null,
    null,
    null,
    null,
    "ol_logbook_laporan.judul_laporan",
    "ol_logbook_laporan.sumber_laporan",
    "ol_unit.nama_unit",
    "ol_pegawai.nama_pegawai"
];
public function datatable_report($dt)
{
    $columns = $this->report_columns;

    $first_date    = $dt['first_date'] ?? '';
    $last_date     = $dt['last_date'] ?? '';
    $kompetensi    = ($dt['kompetensi'] ?? 0);
    $range 		   = (int)($dt['range'] ?? 0);

    return $this->datatable_engine($dt, $columns, function($db) use ($first_date, $last_date, $kompetensi, $range){

        $db->select("
            ol_per_laporan.tgl_laporan AS tgl_sort,
            ol_per_laporan.id_laporan,
            ol_per_laporan.judul_laporan,
            ol_per_laporan.sumber_laporan,
            ol_unit.nama_unit,
            ol_pegawai.nama_pegawai,
            DATE_FORMAT(ol_per_laporan.tgl_laporan, '%d-%m-%Y') AS tgl_laporan,
            DATE_FORMAT(ol_per_laporan.tgl_awal, '%d-%m-%Y') AS tgl_awal,
            DATE_FORMAT(ol_per_laporan.tgl_akhir, '%d-%m-%Y') AS tgl_akhir
        ");

        $db->from("ol_per_laporan");
        $db->join("ol_unit", "ol_unit.id_unit = ol_per_laporan.laporan_unit", "left");
        $db->join("ol_pegawai", "ol_pegawai.barcode_pegawai = ol_per_laporan.pembuat_laporan", "left");

        // =============================
        // FILTER WAJIB
        // =============================
        $db->where("ol_per_laporan.pembuat_laporan", $this->session->barcode_pegawai);

        // =============================
        // FILTER INSTANSI (4)
        // =============================
        if ($kompetensi > 0) {
            $db->where("ol_per_laporan.id_equipment", $kompetensi);
        }

        // =============================
        // FILTER KOMPETENSI (3)
        // =============================
        if ($range > 0) {
	        // =============================
	        // FILTER TANGGAL (1 & 2)
	        // =============================
	        if (!empty($first_date) && !empty($last_date)) {

	            $fd = date('Y-m-d', strtotime($first_date));
	            $ld = date('Y-m-d', strtotime($last_date));

	            $db->where("ol_per_laporan.tgl_laporan >=", $fd);
	            $db->where("ol_per_laporan.tgl_laporan <=", $ld);
	        }
        }

    }, [
        "order_by" => [
            ["col" => "tgl_sort", "dir" => "desc"]
        ]
    ]);
}
//========================================================== ol_logbook logbook
public function child_laporan_detil($dt)
{
    // ============================
    // SAFE BARCODE
    // ============================
    $id = trim($dt['id_laporan'] ?? '');

    if ($id === '') {
        return [
            'draw'     => intval($dt['draw'] ?? 1),
            'data'     => [],
            'total'    => 0,
            'filtered' => 0
        ];
    }

    // ============================
    // COLUMN MAPPING
    // ============================
    $columns = [
        'ol_per_laporan_detil.urutan_laporan_detil',
        'ol_per_laporan_detil.judul_laporan_detil',
        'sn_tabel.nama_tabel',
        'jenis_per_laporan_detil'
    ];

    return $this->datatable_engine(
        $dt,
        $columns,
        function($db) use ($id) {

            $db->select("
                ol_per_laporan_detil.urutan_laporan_detil,ol_per_laporan_detil.id_laporan_detil,
                ol_per_laporan_detil.id_laporan,ol_per_laporan_detil.periode_laporan_detil as pld,
                ol_per_laporan_detil.jenis_per_laporan_detil as jpld,
                ol_per_laporan_detil.analisa_laporan_detil,ol_per_laporan_detil.rekomendasi_laporan_detil,
                ol_per_laporan_detil.min_laporan_detil,ol_per_laporan_detil.max_laporan_detil,
                ol_per_laporan_detil.tabel,ol_per_laporan_detil.button,
                IF(periode_laporan_detil = 2,'BULANAN','TAHUNAN') AS periode_laporan_detil,
                IF(jenis_per_laporan_detil = 2,'Quality Control',
                    IF(jenis_per_laporan_detil = 3,'Logbook',
                        IF(jenis_per_laporan_detil = 4,'Quality Control Ruangan / Unit',
                            IF(jenis_per_laporan_detil = 5,'Berkas','-')
                        )
                    )
                ) AS jenis_per_laporan_detil,
                ol_per_laporan_detil.judul_laporan_detil,
                sn_tabel.nama_tabel
            ");

	        $db->from('ol_per_laporan_detil');
	        $db->join('sn_tabel', 'sn_tabel.id_tabel = ol_per_laporan_detil.tabel', 'left');

            // FILTER WAJIB (string binding aman)
            $db->where('deleted_at IS NULL', null, false);
            $db->where('ol_per_laporan_detil.id_laporan', $id);
        },
        [
            "order_by" => [
                ["col" => "ol_per_laporan_detil.urutan_laporan_detil", "dir" => "desc"]
            ]
        ]
    );
}
//================================================== report child
protected $logbook_columns = [
    null,
    "ol.tgl_logbook",
    "okm.kode_unit",
    "okm.nama_kompetensi",
    "ok.nama_kewenangan",
    "ol.jml_logbook",
    "ks.nama_sifat_kewenangan"
];
public function datatable_logbook($dt)
{
    $columns = $this->logbook_columns;

    $first_date    = $dt['first_date'] ?? '';
    $last_date     = $dt['last_date'] ?? '';
    $id_instansi   = (int)($dt['id_instansi'] ?? 0);
    $id_kompetensi = ($dt['id_kompetensi'] ?? 0);

    return $this->datatable_engine($dt, $columns, function($db) use ($first_date, $last_date, $id_instansi, $id_kompetensi){

        $db->select("
            lp.tgl_logbook AS tgl_sort,
            lp.coun_logbook,lp.id_logbook,
            DATE_FORMAT(lp.tgl_logbook, '%d-%m-%Y') AS tgl_logbook,
            okm.kode_unit,
            okm.nama_kompetensi,
            ok.nama_kewenangan,
            lp.jml_logbook,
            ks.nama_sifat_kewenangan
        ");

        $db->from("ol_logbook lp");
        $db->join("nkr_kewenangan ok", "ok.id_kewenangan = lp.id_kewenangan", "left");
        $db->join("nkr_kompetensi okm", "okm.id_kompetensi = ok.id_kompetensi", "left");
        $db->join("kol_sifat_kewenangan ks", "ks.id_sifat_kewenangan = lp.id_sifat_kewenangan", "left");

        // =============================
        // FILTER WAJIB
        // =============================
        $db->where("lp.id_logbooker", $this->session->id_pegawai);

        // =============================
        // FILTER TANGGAL (1 & 2)
        // =============================
        if (!empty($first_date) && !empty($last_date)) {

            $fd = date('Y-m-d', strtotime($first_date));
            $ld = date('Y-m-d', strtotime($last_date));

            $db->where("lp.tgl_logbook >=", $fd);
            $db->where("lp.tgl_logbook <=", $ld);
        }

        // =============================
        // FILTER INSTANSI (4)
        // =============================
        if ($id_instansi > 0) {
            $db->where("lp.id_instansi", $id_instansi);
        }

        // =============================
        // FILTER KOMPETENSI (3)
        // =============================
        if ($id_kompetensi > 0) {
            $db->where("okm.id_kompetensi", $id_kompetensi);
        }

    }, [
        "order_by" => [
            ["col" => "lp.tgl_logbook", "dir" => "desc"]
        ]
    ]);
}
//================================================== logbook child
private function child_logbook_base($id_logbook)
{
    $this->db->select("
        ol_pasien.rm,
        ol_logbook_pasien.id_logbook_pasien,
        ol_logbook_pasien.id_logbook,
        ol_logbook_pasien.id_pasien,
        ol_pasien.nama_pasien,
        ol_pasien.jk,
        ol_pasien.tmp_lahir,
        DATE_FORMAT(ol_pasien.tgl_lahir,'%d-%m-%Y') as tgl_lahir,
        ol_pasien.alamat
    ");

    $this->db->from('ol_logbook_pasien');

    $this->db->join(
        'ol_logbook',
        'ol_logbook.id_logbook = ol_logbook_pasien.id_logbook',
        'left'
    );

    $this->db->join(
        'ol_pasien',
        'ol_pasien.id_pasien = ol_logbook_pasien.id_pasien',
        'left'
    );

    $this->db->where('ol_logbook_pasien.id_logbook', $id_logbook);
}

private function child_logbook_search($search)
{
    if (!empty($search)) {
        $this->db
            ->group_start()
            ->like('ol_pasien.rm', $search)
            ->or_like('ol_pasien.nama_pasien', $search)
            ->or_like('ol_pasien.tmp_lahir', $search)
            ->or_like('ol_pasien.tgl_lahir', $search)
            ->or_like('ol_pasien.alamat', $search)
            ->group_end();
    }
}

public function datatable_child_logbook_pasien($id_logbook, $dt)
{
    $search = $dt['search']['value'] ?? '';

    // ================= DATA =================
    $this->child_logbook_base($id_logbook);
    $this->child_logbook_search($search);

    $data = $this->db
        ->limit($dt['length'], $dt['start'])
        ->get()
        ->result_array();

    // ================= FILTERED =================
    $this->child_logbook_base($id_logbook);
    $this->child_logbook_search($search);

    $filtered = $this->db->count_all_results();

    // ================= TOTAL =================
    $this->child_logbook_base($id_logbook);

    $total = $this->db->count_all_results();

    return [
        'data'     => $data,
        'total'    => $total,
        'filtered' => $filtered
    ];
}
// ============================================================================== kompetensi
    private $kompetensi_columns = [
        'nkr_kompetensi.kode_unit',
        'nkr_kompetensi.nama_kompetensi',
        'jabatan.nama_jabatan',
        'nkr_kompetensi.status_kompetensi'
    ];
    public function datatable_kompetensi($dt)
    {
        // DATA
        $this->kompetensi_base();
        $this->datatable_search($this->kompetensi_columns, $dt['search'], $dt['cols']);

        $orderCol = $this->kompetensi_columns[$dt['order'][0]['column']] ?? 'nama_kompetensi';
        $orderDir = $dt['order'][0]['dir'] ?? 'asc';

        $this->db
            ->order_by($orderCol, $orderDir)
            ->limit($dt['length'], $dt['start']);

        $data = $this->db->get()->result_array();

        // FILTERED
        $this->kompetensi_base();
        $this->datatable_search($this->kompetensi_columns, $dt['search'], $dt['cols']);
        $filtered = $this->db->count_all_results();

        // TOTAL
        $total = $this->db->count_all('nkr_kompetensi');

        return compact('data', 'total', 'filtered');
    }
    private function kompetensi_base()
    {
    $this->db
        ->select("
            nkr_kompetensi.kode_unit,
            nkr_kompetensi.nama_kompetensi,
            nkr_kompetensi.id_kompetensi,
            nkr_kompetensi.status_kompetensi,
            nkr_kompetensi.id_jabatan,
            jabatan.nama_jabatan,
            IF(nkr_kompetensi.status_kompetensi = 1,
                '<span class=\"badge bg-success\">Aktif</span>',
                '<span class=\"badge bg-danger\">Non Aktif</span>'
            ) AS status_bagde
        ")
        ->from('nkr_kompetensi')
        ->join('jabatan','jabatan.id_jabatan = nkr_kompetensi.id_jabatan','left')
        ->where('nkr_kompetensi.deleted_at', null);

        // =========================
        // FILTER LEVEL (NON ADMIN)
        // =========================
        if($this->session->userdata('id_level') != 1){
            $this->db->where('nkr_kompetensi.id_jabatan', $this->session->userdata('id_jabatan'));
        }
    }
// ============================================================================== kewenangan
    private $kewenangan_columns = [
        'nkr_kompetensi.kode_unit',
        'nkr_kompetensi.nama_kompetensi',
        'nkr_kewenangan.nama_kewenangan',
        'nkr_kompetensi.id_jabatan','jabatan.nama_jabatan',
        'ol_pegawai_grade.nama_grade'
    ];
    public function datatable_kewenangan($dt)
    {
        // DATA
        $this->kewenangan_base();
        $this->datatable_search($this->kewenangan_columns, $dt['search'], $dt['cols']);

        $orderCol = $this->kewenangan_columns[$dt['order'][0]['column']] ?? 'nama_kewenangan';
        $orderDir = $dt['order'][0]['dir'] ?? 'asc';

        $this->db
            ->order_by($orderCol, $orderDir)
            ->limit($dt['length'], $dt['start']);

        $data = $this->db->get()->result_array();

        // FILTERED
        $this->kewenangan_base();
        $this->datatable_search($this->kewenangan_columns, $dt['search'], $dt['cols']);
        $filtered = $this->db->count_all_results();

        // TOTAL
        $total = $this->db->count_all('nkr_kewenangan');

        return compact('data', 'total', 'filtered');
    }
    private function kewenangan_base()
    {
    $this->db
        ->select("
            nkr_kompetensi.kode_unit,
            nkr_kewenangan.id_kewenangan,
            nkr_kewenangan.nama_kewenangan,
            nkr_kewenangan.status_kewenangan,
            ol_pegawai_grade.id_grade,
            ol_pegawai_grade.nama_grade,
            nkr_kompetensi.nama_kompetensi,
            nkr_kompetensi.id_kompetensi,
            nkr_kompetensi.id_jabatan,
            jabatan.nama_jabatan,

            IF(nkr_kewenangan.status_kewenangan = 1,
                '<span class=\"badge bg-success\">Aktif</span>',
                '<span class=\"badge bg-danger\">Non Aktif</span>'
            ) AS status_badge
        ")
        ->from('nkr_kewenangan')
        ->join('nkr_kompetensi','nkr_kompetensi.id_kompetensi = nkr_kewenangan.id_kompetensi','left')
        ->join('ol_pegawai_grade','ol_pegawai_grade.id_grade = nkr_kewenangan.id_kode_kewenangan','left')
        ->join('jabatan','jabatan.id_jabatan = nkr_kompetensi.id_jabatan','left')
        ->where('nkr_kewenangan.deleted_at', null);

        // =========================
        // FILTER LEVEL (NON ADMIN)
        // =========================
        if($this->session->userdata('id_level') != 1){
            $this->db->where('nkr_kompetensi.id_jabatan', $this->session->userdata('id_jabatan'));
        }
    }
// ============================================================================== ol_pegawai_grade
    private $grade_columns = [
        'ol_pegawai_grade.urutan_grade',
        'ol_pegawai_grade.nama_grade',
        'jabatan.nama_jabatan'
    ];
    public function datatable_grade($dt)
    {
        // DATA
        $this->grade_base();
        $this->datatable_search($this->grade_columns, $dt['search'], $dt['cols']);

        $orderCol = $this->grade_columns[$dt['order'][0]['column']] ?? 'nama_grade';
        $orderDir = $dt['order'][0]['dir'] ?? 'asc';

        $this->db
            ->order_by($orderCol, $orderDir)
            ->limit($dt['length'], $dt['start']);

        $data = $this->db->get()->result_array();

        // FILTERED
        $this->grade_base();
        $this->datatable_search($this->grade_columns, $dt['search'], $dt['cols']);
        $filtered = $this->db->count_all_results();

        // TOTAL
        $total = $this->db->count_all('ol_pegawai_grade');

        return compact('data', 'total', 'filtered');
    }
    private function grade_base()
    {
    $this->db
        ->select("
            ol_pegawai_grade.id_grade,
            ol_pegawai_grade.urutan_grade,
            ol_pegawai_grade.nama_grade,
            jabatan.nama_jabatan
        ")
        ->from('ol_pegawai_grade')
        ->join('jabatan','jabatan.id_jabatan = ol_pegawai_grade.id_jabatan','left');
    //    ->where('nkr_kewenangan.deleted_at', null);

        // =========================
        // FILTER LEVEL (NON ADMIN)
        // =========================
        if($this->session->userdata('id_level') != 1){
            $this->db->where('ol_pegawai_grade.id_jabatan', $this->session->userdata('id_jabatan'));
        }
    }
// ============================================================================== area klinis
    private $area_klinis_columns = [
        'olarea_klinis.nama_area_klinis',
        'olarea_klinis.nama_area_klinis'
    ];
    public function datatable_area_klinis($dt)
    {
        // DATA
        $this->area_klinis_base();
        $this->datatable_search($this->area_klinis_columns, $dt['search'], $dt['cols']);

        $orderCol = $this->area_klinis_columns[$dt['order'][0]['column']] ?? 'nama_area_klinis';
        $orderDir = $dt['order'][0]['dir'] ?? 'asc';

        $this->db
            ->order_by($orderCol, $orderDir)
            ->limit($dt['length'], $dt['start']);

        $data = $this->db->get()->result_array();

        // FILTERED
        $this->area_klinis_base();
        $this->datatable_search($this->area_klinis_columns, $dt['search'], $dt['cols']);
        $filtered = $this->db->count_all_results();

        // TOTAL
        $total = $this->db->count_all('olarea_klinis');

        return compact('data', 'total', 'filtered');
    }
    private function area_klinis_base()
    {
    $this->db
        ->select("
            olarea_klinis.nama_area_klinis,olarea_klinis.id_area_klinis,
            jabatan.nama_jabatan
        ")
        ->from('olarea_klinis')
        ->join('jabatan','jabatan.id_jabatan = olarea_klinis.id_jabatan','left')
        ->where('olarea_klinis.deleted_at', null);
    }
// ============================================================================= kewenangan area
    private $kewenangan_klinis_columns = [
        null,
        'nkr_kewenangan.nama_kewenangan',
        'olarea_klinis.nama_area_klinis',
        'kol_sifat_kewenangan.nama_sifat_kewenangan',
        'ol_pegawai_grade.nama_grade'
    ];
    public function datatable_kewenangan_klinis($dt)
    {
        // DATA
        $this->kewenangan_klinis_base();
        $this->datatable_search($this->kewenangan_klinis_columns, $dt['search'], $dt['cols']);

        $orderCol = $this->kewenangan_klinis_columns[$dt['order'][0]['column']] ?? 'nama_kewenangan';
        $orderDir = $dt['order'][0]['dir'] ?? 'asc';

        $this->db
            ->order_by($orderCol, $orderDir)
            ->limit($dt['length'], $dt['start']);

        $data = $this->db->get()->result_array();

        // FILTERED
        $this->kewenangan_klinis_base();
        $this->datatable_search($this->kewenangan_klinis_columns, $dt['search'], $dt['cols']);
        $filtered = $this->db->count_all_results();

        // TOTAL
        $total = $this->db->count_all('nkr_kewenangan_area');

        return compact('data', 'total', 'filtered');
    }
    private function kewenangan_klinis_base()
    {
    $this->db
        ->select("
            nkr_kewenangan_area.coun_kewenangan_area,nkr_kewenangan_area.id_kewenangan_area,
            olarea_klinis.id_area_klinis,olarea_klinis.nama_area_klinis,
            ol_pegawai_grade.nama_grade,ol_pegawai_grade.id_grade,
            nkr_kewenangan.nama_kewenangan,nkr_kewenangan.id_kewenangan,
            kol_sifat_kewenangan.nama_sifat_kewenangan,kol_sifat_kewenangan.id_sifat_kewenangan
        ")
        ->from('nkr_kewenangan_area')
        ->join('olarea_klinis','olarea_klinis.id_area_klinis = nkr_kewenangan_area.id_area_klinis','left')
        ->join('kol_sifat_kewenangan','kol_sifat_kewenangan.id_sifat_kewenangan = nkr_kewenangan_area.id_sifat_kewenangan','left')
        ->join('ol_pegawai_grade','ol_pegawai_grade.id_grade = nkr_kewenangan_area.id_grade','left')
        ->join('nkr_kewenangan','nkr_kewenangan.id_kewenangan = nkr_kewenangan_area.id_kewenangan','left')
        ->where('nkr_kewenangan_area.deleted_at', null);
    }
// ============================================================================== admin asesor
    private $admin_asesor_columns = [
        null,
        null,
        'ol_pegawai.nama_pegawai',
        'nkr_kewenangan.nama_kewenangan',
        'ol_status_diusulkan.nama_status_diusulkan',
        'ol_pengajuan.status_pengajuan'
    ];
    public function datatable_admin_asesor($dt)
    {
        // DATA
        $this->admin_asesor_base();
        $this->datatable_search($this->admin_asesor_columns, $dt['search'], $dt['cols']);

        $orderCol = $this->admin_asesor_columns[$dt['order'][0]['column']] ?? 'nama_kewenangan';
        $orderDir = $dt['order'][0]['dir'] ?? 'asc';

        $this->db
            ->order_by($orderCol, $orderDir)
            ->limit($dt['length'], $dt['start']);

        $data = $this->db->get()->result_array();

        // FILTERED
        $this->admin_asesor_base();
        $this->datatable_search($this->admin_asesor_columns, $dt['search'], $dt['cols']);
        $filtered = $this->db->count_all_results();

        // TOTAL
        $total = $this->db->count_all('ol_pengajuan');

        return compact('data', 'total', 'filtered');
    }
    private function admin_asesor_base()
    {
        $idx = $this->session->userdata('mas_ins');
        $ids = $this->session->userdata('mas_asesor');
        // 1. Definisikan fields dengan alias tabel agar tidak ambigu jika ada nama kolom yang sama
        $this->db->select("
            ol_pengajuan.*,tgl_pengajuan as tgl_sort,ol_pengajuan.id_pengajuan,
            ol_status_diusulkan.nama_status_diusulkan,
            ol_pegawai.nama_pegawai,
            CASE 
                WHEN tgl_pengajuan IS NULL OR tgl_pengajuan = '' THEN 'Belum Ada Tanggal' 
                ELSE DATE_FORMAT(tgl_pengajuan, '%d-%m-%Y') 
            END as tgl_pengajuan,
            CONCAT('[', nkr_kompetensi.kode_unit, '] - ', nkr_kompetensi.nama_kompetensi) as nama_kompetensi
        ", FALSE); // FALSE mencegah CI otomatis menambah backtick yang bisa merusak fungsi SQL kompleks

        // 2. Gunakan chaining agar kode lebih ringkas
        $this->db->from('ol_pengajuan');
        $this->db->join('ol_status_diusulkan', 'ol_status_diusulkan.id_status_diusulkan = ol_pengajuan.id_status_diusulkan', 'left');
        $this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi = ol_pengajuan.kode_unit_pengajuan', 'left');
        $this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kompetensi = nkr_kompetensi.id_kompetensi', 'left');
        $this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai = ol_pengajuan.barcode_pegawai', 'left');
        $this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional = ol_pegawai.id_jabatan_fungsional', 'left');

        // 3. Filtering
        $this->db->where('ol_pengajuan.status_pengajuan', 1);
        $this->db->where_in('ol_pengajuan.id_instansi', $idx);
        $this->db->where_in('jabatan_fungsional.id_jabatan', $ids);
    }
// ============================================================================== child validator adm asesor
private $pengajuan_validator_columns = [
    'ol_pegawai.nama_pegawai',
    'ol_pegawai.no_hp',
    'ol_pegawai.email',
    'status_form'
];

public function datatable_pengajuan_validator($barcode_pengajuan, $dt)
{
    // 1. Ambil DATA
    $this->pengajuan_validator_base($barcode_pengajuan); // Kirim barcode ke base
    $this->datatable_search($this->pengajuan_validator_columns, $dt['search'], $dt['cols']);

    $orderCol = $this->pengajuan_validator_columns[$dt['order'][0]['column']] ?? 'nama_pegawai';
    $orderDir = $dt['order'][0]['dir'] ?? 'asc';

    $this->db->order_by($orderCol, $orderDir)->limit($dt['length'], $dt['start']);
    $data = $this->db->get()->result_array();

    // 2. Hitung FILTERED
    $this->pengajuan_validator_base($barcode_pengajuan);
    $this->datatable_search($this->pengajuan_validator_columns, $dt['search'], $dt['cols']);
    $filtered = $this->db->count_all_results();

    // 3. Hitung TOTAL (Total murni untuk barcode tersebut)
    $this->db->where('barcode_pengajuan', $barcode_pengajuan);
    $total = $this->db->count_all_results('nkr_pengajuan_validator');

    return compact('data', 'total', 'filtered');
}

private function pengajuan_validator_base($barcode_pengajuan)
{
    $this->db->select("
        nkr_pengajuan_validator.*,
        ol_pegawai.nama_pegawai,ol_pengajuan.kode_unit_pengajuan as id_kompetensi,ol_pengajuan.id_instansi,
        ol_pegawai.email, 
        ol_pegawai.no_hp,
        /* Logika untuk status pengisian form */
        IF(
            nkr_pengajuan_validator.nkr_form IS NULL OR nkr_pengajuan_validator.nkr_form = 0 OR nkr_pengajuan_validator.nkr_form = '', 
            'Belum Ada Form', 
            'Sudah Ada Form'
        ) as status_form
    ", FALSE);

    $this->db->from('nkr_pengajuan_validator');
    $this->db->join('ol_pengajuan', 'ol_pengajuan.barcode_pengajuan = nkr_pengajuan_validator.barcode_pengajuan', 'left');
    $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai = nkr_pengajuan_validator.id_asesor', 'left');

    // Filter berdasarkan barcode yang diklik
    $this->db->where('nkr_pengajuan_validator.deleted_at IS NULL', null, false);
    $this->db->where('nkr_pengajuan_validator.barcode_pengajuan', $barcode_pengajuan);
}
// ============================================================================== child validator adm asesor
private $pengajuan_validator_pilih_columns = [
    'ol_pegawai.nama_pegawai',
    'ol_pegawai.no_hp',
    'ol_pegawai.nip',
    'jabatan.nama_jabatan',
    'ol_unit.nama_unit'
];

public function datatable_pengajuan_validator_pilih($dt)
{
    // Cek key columns untuk menghindari error undefined index
    $columns_data = $dt['columns'] ?? ($dt['cols'] ?? []);

    // DATA
    $this->pengajuan_validator_pilih_base();
    $this->datatable_search($this->pengajuan_validator_pilih_columns, $dt['search'], $columns_data);

    // Pastikan index order ada untuk mencegah error serupa
    $orderIndex = $dt['order'][0]['column'] ?? 0;
    $orderCol = $this->pengajuan_validator_pilih_columns[$orderIndex] ?? 'nama_pegawai';
    $orderDir = $dt['order'][0]['dir'] ?? 'asc';

    $this->db
        ->order_by($orderCol, $orderDir)
        ->limit($dt['length'], $dt['start']);

    $data = $this->db->get()->result_array();

    // FILTERED
    $this->pengajuan_validator_pilih_base();
    $this->datatable_search($this->pengajuan_validator_pilih_columns, $dt['search'], $columns_data);
    $filtered = $this->db->count_all_results();

    // TOTAL
    $total = $this->db->count_all('ol_pegawai');

    return compact('data', 'total', 'filtered');
}

private function pengajuan_validator_pilih_base()
{
    // Hapus parameter $barcode_pengajuan jika memang tidak digunakan untuk filter list ini
    $this->db->select("
        ol_pegawai.id_pegawai,
        ol_pegawai.nama_pegawai, 
        ol_pegawai.no_hp,
        ol_pegawai.email,
        ol_pegawai.nip,
        jabatan.nama_jabatan, 
        ol_unit.nama_unit
    ", FALSE);

    $this->db->from('ol_user');
    $this->db->join('ol_pegawai','ol_pegawai.id_pegawai=ol_user.id_pegawai','left');
    $this->db->join('ol_unit','ol_unit.id_unit=ol_user.unit','left');
    $this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
    $this->db->join('jabatan', 'jabatan.id_jabatan=jabatan_fungsional.id_jabatan','left');

    $this->db->where('ol_pegawai.status_pegawai', 1);
    $this->db->where('ol_pegawai.visible', 1);
    $this->db->where('ol_user.status_asesor >', 0);
    $this->db->where('ol_pegawai.deleted_at IS NULL', null, false);
    // Menggunakan userdata refer agar lebih aman
    $this->db->where('ol_user.refer >', (int)$this->session->userdata('refer'));
}
// ============================================================================== child validator adm asesor
private $nkr_form_columns = [
    'nkr_form.nama_form',
    'kol_jenis_form.nama_jenis_form',
    'nkr_kompetensi.nama_kompetensi'
];

public function datatable_nkr_form($id_kompetensi,$id_instansi,$dt)
{
    // Cek key columns untuk menghindari error undefined index
    $columns_data = $dt['columns'] ?? ($dt['cols'] ?? []);

    // DATA
    $this->nkr_form_base($id_kompetensi,$id_instansi);
    $this->datatable_search($this->nkr_form_columns, $dt['search'], $columns_data);

    // Pastikan index order ada untuk mencegah error serupa
    $orderIndex = $dt['order'][0]['column'] ?? 0;
    $orderCol = $this->nkr_form_columns[$orderIndex] ?? 'nama_form';
    $orderDir = $dt['order'][0]['dir'] ?? 'asc';

    $this->db
        ->order_by($orderCol, $orderDir)
        ->limit($dt['length'], $dt['start']);

    $data = $this->db->get()->result_array();

    // FILTERED
    $this->nkr_form_base($id_kompetensi,$id_instansi);
    $this->datatable_search($this->nkr_form_columns, $dt['search'], $columns_data);
    $filtered = $this->db->count_all_results();

    // TOTAL
    $total = $this->db->count_all('nkr_form');

    return compact('data', 'total', 'filtered');
}

private function nkr_form_base($id_kompetensi, $id_instansi)
{
    $this->db->select("
        nkr_form.id_form,nkr_form.coun_form,
        nkr_form.nama_form,
        kol_jenis_form.nama_jenis_form, 
        nkr_kompetensi.nama_kompetensi,
        kol_jenis_form.id_jenis_form,
        nkr_form.id_kompetensi
    ", FALSE);

    $this->db->from('nkr_form');
    // Join disesuaikan: biasanya kol_jenis_form join ke id_jenis_form
    $this->db->join('kol_jenis_form','kol_jenis_form.id_jenis_form=nkr_form.id_jenis_form','left');
    $this->db->join('nkr_kompetensi','nkr_kompetensi.id_kompetensi=nkr_form.id_kompetensi','left');

    // Gunakan parameter yang dikirim dari fungsi
    $this->db->where('nkr_form.id_kompetensi', $id_kompetensi);
    $this->db->where('nkr_kompetensi.instansi_kompetensi', $id_instansi);
}
// ============================================================================== ol_pengajuan_signature
private $pengajuan_signature_columns = [
    null,
    'ol_pengajuan_signature.tanggal',
    'ol_pengajuan_signature.header',
    'ol_pengajuan_signature.no',
    'ol_pegawai.nama_pegawai',
    'olarea_klinis.nama_area_klinis'
];

public function datatable_pengajuan_signature($id_instansi,$dt)
{
    // Cek key columns untuk menghindari error undefined index
    $columns_data = $dt['columns'] ?? ($dt['cols'] ?? []);

    // DATA
    $this->pengajuan_signature_base($id_instansi);
    $this->datatable_search($this->pengajuan_signature_columns, $dt['search'], $columns_data);

    // Pastikan index order ada untuk mencegah error serupa
    $orderIndex = $dt['order'][0]['column'] ?? 0;
    $orderCol = $this->pengajuan_signature_columns[$orderIndex] ?? 'barcode_pengajuan';
    $orderDir = $dt['order'][0]['dir'] ?? 'asc';

    $this->db
        ->order_by($orderCol, $orderDir)
        ->limit($dt['length'], $dt['start']);

    $data = $this->db->get()->result_array();

    // FILTERED
    $this->pengajuan_signature_base($id_instansi);
    $this->datatable_search($this->pengajuan_signature_columns, $dt['search'], $columns_data);
    $filtered = $this->db->count_all_results();

    // TOTAL
    $total = $this->db->count_all('nkr_form');

    return compact('data', 'total', 'filtered');
}

private function pengajuan_signature_base($id_instansi)
{
    $this->db->select("
        ol_pengajuan_signature.*,DATE_FORMAT(ol_pengajuan_signature.tanggal,'%d-%m-%Y') as tanggal,
        ol_pengajuan.id_pengajuan,ol_pengajuan.barcode_pengajuan,
        olarea_klinis.id_area_klinis,olarea_klinis.id_area_klinis,
        ol_status_diusulkan.nama_status_diusulkan,ol_status_diusulkan.id_status_diusulkan,
        jabatan_fungsional.nama_jabatan_fungsional,jabatan_fungsional.id_jabatan_fungsional,
        ol_pegawai.nama_pegawai,ol_pegawai.id_pegawai,ol_pegawai.barcode_pegawai
    ", FALSE);

    $this->db->from('ol_pengajuan_signature');
    // Join disesuaikan: biasanya kol_jenis_form join ke id_jenis_form
    $this->db->join('ol_pengajuan','ol_pengajuan.barcode_pengajuan=ol_pengajuan_signature.barcode_pengajuan','left');
    $this->db->join('ol_status_diusulkan', 'ol_status_diusulkan.id_status_diusulkan=ol_pengajuan.id_status_diusulkan','left');
    $this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=ol_pengajuan_signature.barcode_pegawai','left');
    $this->db->join('olarea_klinis', 'olarea_klinis.id_area_klinis=ol_pegawai.id_area_klinis','left');
    $this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
    $this->db->where('ol_pengajuan.id_instansi', $id_instansi);
}
//ALTER TABLE `ol_pengajuan_signature` ADD `barcode_pegawai` CHAR(35) NULL DEFAULT NULL AFTER `id_signature`;
// ============================================================================== ol_pengajuan_signature_detil
private $pengajuan_signature_detil_columns = [
    'nkr_kewenangan.nama_kewenangan',
    'nkr_kompetensi.nama_kompetensi'
];

public function datatable_pengajuan_signature_detil($id_pengajuan_signature,$dt)
{
    // Cek key columns untuk menghindari error undefined index
    $columns_data = $dt['columns'] ?? ($dt['cols'] ?? []);

    // DATA
    $this->pengajuan_signature_detil_base($id_pengajuan_signature);
    $this->datatable_search($this->pengajuan_signature_detil_columns, $dt['search'], $columns_data);

    // Pastikan index order ada untuk mencegah error serupa
    $orderIndex = $dt['order'][0]['column'] ?? 0;
    $orderCol = $this->pengajuan_signature_detil_columns[$orderIndex] ?? 'barcode_pengajuan';
    $orderDir = $dt['order'][0]['dir'] ?? 'asc';

    $this->db
        ->order_by($orderCol, $orderDir)
        ->limit($dt['length'], $dt['start']);

    $data = $this->db->get()->result_array();

    // FILTERED
    $this->pengajuan_signature_detil_base($id_pengajuan_signature);
    $this->datatable_search($this->pengajuan_signature_detil_columns, $dt['search'], $columns_data);
    $filtered = $this->db->count_all_results();

    // TOTAL
    $total = $this->db->count_all('nkr_form');

    return compact('data', 'total', 'filtered');
}

private function pengajuan_signature_detil_base($id_pengajuan_signature)
{
    $this->db->select("
        ol_pengajuan_signature_detil.*,
        ol_pengajuan_signature.*,
        nkr_kewenangan.id_kewenangan,nkr_kewenangan.nama_kewenangan,
        nkr_kompetensi.id_kompetensi,nkr_kompetensi.nama_kompetensi
    ", FALSE);

    $this->db->from('ol_pengajuan_signature_detil');
    // Join disesuaikan: biasanya kol_jenis_form join ke id_jenis_form
    $this->db->join('nkr_kewenangan','nkr_kewenangan.id_kewenangan=ol_pengajuan_signature_detil.id_kewenangan','left');
    $this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
    $this->db->join('jabatan', 'jabatan.id_jabatan=nkr_kompetensi.id_jabatan','left');
    $this->db->where('ol_pengajuan_signature_detil.id_pengajuan_signature', $id_pengajuan_signature);
}
// ==============================================================================
// ==============================================================================
public function get_grade_by_jabatan()
{
    $plus = empty($this->session->userdata('id_grade')) ? 1 : ($this->session->userdata('id_grade') + 1);
    $sess_jabatan = $this->session->userdata('id_jabatan');
    $sess_area_klinis = $this->session->userdata('area_klinis');
    $q = $this->db
        ->select("nkr_kewenangan_area.id_grade, ol_pegawai_grade.nama_grade")
        ->from("nkr_kewenangan_area")
        ->join("ol_pegawai_grade", "ol_pegawai_grade.id_grade = nkr_kewenangan_area.id_grade", "left")
        ->where("ol_pegawai_grade.id_jabatan", $sess_jabatan)
        ->where("ol_pegawai_grade.urutan_grade <=", $plus)
        ->group_by("nkr_kewenangan_area.id_grade")
        ->order_by("ol_pegawai_grade.urutan_grade", "asc")
        ->get()
        ->result_array();

    $hasil = array_column($q, 'nama_grade', 'id_grade');
    return $hasil;
}
public function get_grade($id_jabatan)
{
    $q = $this->db
        ->select("ol_pegawai_grade.id_grade, ol_pegawai_grade.nama_grade")
        ->from("ol_pegawai_grade")
        ->where("ol_pegawai_grade.id_jabatan", $id_jabatan)
        ->get()
        ->result_array();

    $hasil = array_column($q, 'nama_grade', 'id_grade');
    return $hasil;
}
public function dropdown_jabatan()
{
    $ids = $this->session->userdata('id_jabatan'); // misal "1,2,3"

    if(!empty($ids)){
        $ids = explode(',', $ids); // jadi array ["1","2","3"]
    }

    $rows = $this->db
        ->select('id_jabatan, nama_jabatan')
        ->from('jabatan')
        ->where_in('id_jabatan', $ids)
        ->order_by('nama_jabatan', 'ASC')
        ->get()
        ->result_array();

    return array_column($rows, 'nama_jabatan', 'id_jabatan');
}
public function dropdown_kompetensi()
{
    $ids = $this->session->userdata('id_jabatan'); // misal "1,2,3"

    if(!empty($ids)){
        $ids = explode(',', $ids); // jadi array ["1","2","3"]
    }

    $rows = $this->db
        ->select('id_kompetensi, nama_kompetensi')
        ->from('nkr_kompetensi')
        ->where('status_kompetensi', 1)
        ->where_in('id_jabatan', $ids)
        ->order_by('coun_kompetensi', 'DESC')
        ->get()
        ->result_array();

    return array_column($rows, 'nama_kompetensi', 'id_kompetensi');
}
function ambil_data_instansi()
{
    $q = $this->db
        ->select("id_working, nama_working")
        ->from("ol_pegawai_instansi pi")
        ->join("kol_working kw", "kw.id_working=pi.id_instansi", "left")
        ->join("ol_pegawai peg", "peg.id_pegawai=pi.id_pegawai", "left")
        ->where("pi.id_pegawai", $this->session->id_pegawai)
        ->group_by("pi.id_instansi")
        ->order_by("pi.id_instansi", "asc")
        ->get()
        ->result_array();
	$hasil= array_column($q,'nama_working','id_working');
	return $hasil;
}
function get_kol_sifat_kewenangan()
{
    $q = $this->db
        ->select("id_sifat_kewenangan, nama_sifat_kewenangan")
        ->from("kol_sifat_kewenangan")
        ->get()
        ->result_array();
    $hasil= array_column($q,'nama_sifat_kewenangan','id_sifat_kewenangan');
    return $hasil;
}function get_area_klinis()
{
    $q = $this->db
        ->select("id_area_klinis, nama_area_klinis")
        ->from("olarea_klinis")
        ->get()
        ->result_array();
    $hasil= array_column($q,'nama_area_klinis','id_area_klinis');
    return $hasil;
}
function ambil_equipment_mutu_null()
{
    $q = $this->db
        ->select("id_equipment, nama_equipment")
        ->from("ol_equipment")
        ->where("ol_equipment.status_equipment", 1)
        ->where("ol_equipment.id_unit", $this->session->unit)
        ->order_by("ol_equipment.nama_equipment", "asc")
        ->get()
        ->result_array();
	return array_column($q,'nama_equipment','id_equipment');
}
function ambil_data_instansi_null()
{
	$this->db->join('kol_working kw', 'kw.id_working=pi.id_instansi','left');
	$this->db->join('ol_pegawai peg', 'peg.id_pegawai=pi.id_pegawai','left');
    $this->db->group_by('pi.id_instansi'); 
	$q = $this->db->get_where('ol_pegawai_instansi pi',array('pi.id_pegawai'=>$this->session->id_pegawai));
		return $q->result_array();
}
public function ambil_data_kompetensi_new($idr = null, $first_date = null, $last_date = null)
{
    // Ambil data instansi jika $idr diberikan
    $id_instansi = null;
    if ($idr) {
        $work = $this->m_umum->ambil_data('kol_working', 'barcode_working', $idr);
        $id_instansi = $work['id_working'] ?? null;
    }

    // Tanggal default jika tidak diberikan
    $first_date = $first_date ?? date('Y-m-01'); // awal bulan
    $last_date  = $last_date  ?? date('Y-m-t');   // akhir bulan

    $this->db->select('nkk.id_kompetensi, nkp.nama_kompetensi');
    $this->db->from('ol_logbook lp');
    $this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan = lp.id_kewenangan', 'left');
    $this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi = nkk.id_kompetensi', 'left');

    $this->db->where('lp.id_logbooker', $this->session->id_pegawai);
/*    $this->db->where('lp.tgl_logbook >=', date('Y-m-d', strtotime($first_date)));
    $this->db->where('lp.tgl_logbook <=', date('Y-m-d', strtotime($last_date)));*/

    if ($id_instansi) {
        $this->db->where('lp.id_instansi', $id_instansi);
    }

    $this->db->group_by('nkk.id_kompetensi');

    $query = $this->db->get();
    $q = $query->result_array();

    // Konversi ke array id_kompetensi => nama_kompetensi
    $hasil = array_column($q, 'nama_kompetensi', 'id_kompetensi');
    return $hasil;
}
//==========================================================
public function get_kewenangan_by_ids($ids, $id_jabatan)
{
    if (empty($ids)) return [];

    return $this->db
        ->select("
            ok.id_kewenangan,
            ok.coun_kewenangan,
            ok.nama_kewenangan,
            okm.kode_unit,
            okm.nama_kompetensi
        ")
        ->from("nkr_kewenangan ok")
        ->join("nkr_kompetensi okm", "okm.id_kompetensi=ok.id_kompetensi", "left")
    //    ->where("okm.id_jabatan", $id_jabatan)
        ->where_in("ok.coun_kewenangan", $ids)
        ->order_by("ok.coun_kewenangan", "asc")
        ->get()
        ->result_array();
}
public function get_row_logbook_by_id($id, $id_jabatan)
{
    if (empty($id)) return [];

    return $this->db
        ->select("
            ol.id_kewenangan,
            nk.coun_kewenangan,
            nk.nama_kewenangan,ol.id_sifat_kewenangan,
            okm.kode_unit,ol.tgl_logbook,
            okm.nama_kompetensi
        ")
        ->from("ol_logbook ol")
        ->join("nkr_kewenangan nk", "nk.id_kewenangan=ol.id_kewenangan", "left")
        ->join("nkr_kompetensi okm", "okm.id_kompetensi=nk.id_kompetensi", "left")
    //    ->where("okm.id_jabatan", $id_jabatan)
        ->where("ol.id_logbook", $id)
        ->get()
        ->row_array();
}
public function get_kewenangan($id_jabatan)
{

    return $this->db
        ->select("
            ok.id_kewenangan,
            ok.coun_kewenangan,
            ok.nama_kewenangan,
            okm.kode_unit,
            okm.nama_kompetensi
        ")
        ->from("nkr_kewenangan ok")
        ->join("nkr_kompetensi okm", "okm.id_kompetensi=ok.id_kompetensi", "left")
        ->where("okm.id_jabatan", $id_jabatan)
        ->order_by("ok.coun_kewenangan", "asc")
        ->get()
        ->result_array();
}
public function get_kewenangan_ajax($search = '', $page = 1, $limit = 30)
{
    $sess_grade = $this->session->userdata('id_grade');
    $id_jabatan = $this->session->userdata('id_jabatan');
    $sess_area  = $this->session->userdata('area_klinis');
    $plus       = empty($sess_grade) ? 1 : ($sess_grade + 1);
    $offset     = ($page - 1) * $limit;

    // SELECT
    $this->db->select("
        ok.id_kewenangan as id, 
        CONCAT(ok.nama_kewenangan, ' [ ', okm.kode_unit, ' - ', okm.nama_kompetensi, ' ]') as text
    ");

    // FROM & JOIN (Sesuai logika sebelumnya)
    if ($sess_grade == 0) {
        $this->db->from("nkr_kewenangan ok");
        $this->db->join("nkr_kewenangan_area oka", "oka.id_kewenangan = ok.id_kewenangan", "left");
    } else {
        $this->db->from("nkr_kewenangan_area oka");
        $this->db->join("nkr_kewenangan ok", "ok.id_kewenangan = oka.id_kewenangan", "left");
    }

    $this->db->join("nkr_kompetensi okm", "okm.id_kompetensi = ok.id_kompetensi", "left");

    // FILTER UTAMA
    $this->db->where("okm.id_jabatan", $id_jabatan);

    if (!empty($sess_area) && $sess_area != 0) {
        $this->db->where("oka.id_area_klinis", $sess_area);
    }

    // FILTER GRADE
    $this->db->group_start()
        ->where("oka.id_grade <=", $plus)
        ->or_where("oka.id_grade IS NULL", null, false)
        ->or_where("oka.id_grade", 0)
    ->group_end();

    // FILTER PENCARIAN (Input dari User)
    if ($search != '') {
        $this->db->group_start();
        $this->db->like('ok.nama_kewenangan', $search);
        $this->db->or_like('okm.kode_unit', $search);
        $this->db->or_like('okm.nama_kompetensi', $search);
        $this->db->group_end();
    }

    $this->db->limit($limit, $offset);
    return $this->db->get()->result_array();
}
public function get_kewenangan_dropdown()
{
    // Ambil data session
    $sess_grade = $this->session->userdata('id_grade');
    $id_jabatan = $this->session->userdata('id_jabatan');
    $sess_area  = $this->session->userdata('area_klinis');
    
    // Logika plus: jika grade 2, maka bisa lihat sampai grade 3
    $plus = empty($sess_grade) ? 1 : ($sess_grade + 1);

    $this->db->select("
        ok.id_kewenangan,
        ok.nama_kewenangan,
        okm.kode_unit,
        okm.nama_kompetensi
    ");

    // Tentukan tabel utama
    if ($sess_grade == 0) {
        $this->db->from("nkr_kewenangan ok");
        $this->db->join("nkr_kewenangan_area oka", "oka.id_kewenangan = ok.id_kewenangan", "left");
    } else {
        $this->db->from("nkr_kewenangan_area oka");
        $this->db->join("nkr_kewenangan ok", "ok.id_kewenangan = oka.id_kewenangan", "left");
    }

    $this->db->join("nkr_kompetensi okm", "okm.id_kompetensi = ok.id_kompetensi", "left");
    $this->db->join("ol_pegawai_grade", "ol_pegawai_grade.id_grade = oka.id_grade", "left");
    $this->db->join("jabatan", "jabatan.id_jabatan = okm.id_jabatan", "left");

    // Filter Utama
    $this->db->where("okm.id_jabatan", $id_jabatan);

    // Filter Area Klinis
    if (!empty($sess_area) && $sess_area != 0) {
        $this->db->where("oka.id_area_klinis", $sess_area);
    }

    // Filter Grade (Logic group start dipastikan aman)
    $this->db->group_start()
        ->where("oka.id_grade <=", $plus)
        ->or_where("oka.id_grade IS NULL", null, false)
        ->or_where("oka.id_grade", 0)
    ->group_end();

    // EKSEKUSI QUERY (Penting: sebelumnya variabel $data tidak ada)
    $query = $this->db->get();
    $data  = $query->result_array();

    $result = [];
    foreach ($data as $row) {
        // Mencegah error jika id_kewenangan null (karena left join)
        if (!empty($row['id_kewenangan'])) {
            $result[$row['id_kewenangan']] = $row['nama_kewenangan'] . ' [ ' . $row['kode_unit'] .' - '. $row['nama_kompetensi'] . ' ]';
        }
    }

    return $result;
}
public function get_sifat_kewenangan_dropdown($id=FALSE)
{
    $config = [];

    // jika $id diberikan, tambahkan filter where
    if ($id !== FALSE) {
        $config['where'] = ['id_sifat_kewenangan' => $id];
    }

    return $this->get_selectra_dropdown(
        'kol_sifat_kewenangan',   // nama tabel
        'id_sifat_kewenangan',    // field value
        'nama_sifat_kewenangan',  // field label
        $config                    // config opsional
    );
}
public function get_row_laporan_by_id($id)
{
    if (empty($id)) return [];

    return $this->db
        ->select("
            *
        ")
        ->from("ol_per_laporan")
    //    ->join("nkr_kewenangan nk", "nk.id_kewenangan=ol.id_kewenangan", "left")
        ->where("ol_per_laporan.id_laporan", $id)
        ->get()
        ->row_array();
}
public function get_row_laporan_detil_by_id($id)
{
    if (empty($id)) return [];

    return $this->db
        ->select("
            *
        ")
        ->from("ol_per_laporan_detil")
    //    ->join("nkr_kewenangan nk", "nk.id_kewenangan=ol.id_kewenangan", "left")
        ->where("ol_per_laporan_detil.id_laporan_detil", $id)
        ->get()
        ->row_array();
}
/*public function search_pasien($keyword, $field = 'nama_pasien')
{
    $select = "
        rm as data,
        CONCAT('[', rm, '] [', YEAR(CURDATE()) - YEAR(tgl_lahir), '] ', nama_pasien) as value,
        nama_pasien,
        DATE_FORMAT(tgl_lahir,'%d-%m-%Y') as tgl_lahir,
        rm,
        jk,
        alamat
    ";

    return $this->search(
        'ol_pasien',
        $select,
        $field,
        $keyword,
        5
    );
}*/

public function search_pasien_all($keyword)
{
    $select = "
        rm as data,
        CONCAT('[', rm, '] [', YEAR(CURDATE()) - YEAR(tgl_lahir), '] ', nama_pasien) as value,
        nama_pasien,
        DATE_FORMAT(tgl_lahir,'%d-%m-%Y') as tgl_lahir,
        rm,
        jk,
        alamat
    ";

    return $this->search_multiple(
        'ol_pasien',
        $select,
        ['nama_pasien', 'rm'],
        $keyword,
        5
    );
}

//==========================================================
	public function jumlah_record_filter($table, $where = [])
	{
	  if (!empty($where) && is_array($where)) {
	      $this->db->where($where);
	  }
	  $this->db->from($table);
	  return (int) $this->db->count_all_results();
	}
	function cmd_pendidikan()
	{
		$this->db->where('status_pendidikan', 1);
	    $this->db->order_by('nama_pendidikan', 'ASC');
	    $q = $this->db->get('kol_pendidikan')->result_array();

	    $data = [];
	    foreach ($q as $row) {
	        $data[$row['id_pendidikan']] = $row['nama_pendidikan'];
	    }

	    return $data;
	}
	function cmd_kol_provinsi()
	{
	    $this->db->order_by('nama_prov', 'ASC');
	    $q = $this->db->get('kol_provinsi')->result_array();

	    $data = [];
	    foreach ($q as $row) {
	        $data[$row['id_prov']] = $row['nama_prov'];
	    }

	    return $data;
	}
	function cmd_jabatan_fungsional_no_null()
	{
		$this->db->where('id_jabatan', $this->session->id_jabatan);
	    $this->db->order_by('nama_jabatan_fungsional', 'ASC');
	    $q = $this->db->get('jabatan_fungsional')->result_array();

	    $data = [];
	    foreach ($q as $row) {
	        $data[$row['id_jabatan_fungsional']] = $row['nama_jabatan_fungsional'];
	    }

	    return $data;
	}
    function cmd_grade()
    {
        $this->db->where('id_jabatan', $this->session->id_jabatan);
        $this->db->order_by('nama_grade', 'ASC');
        $q = $this->db->get('ol_pegawai_grade')->result_array();

        $data = [];
        foreach ($q as $row) {
            $data[$row['id_grade']] = $row['nama_grade'];
        }

        return $data;
    }
    function ambil_calendar_event($where = [])
    {
        if(!empty($where)){
            $this->db->where($where);
        }

        return $this->db
                    ->get('calendar_event')
                    ->result_array();
    }
    function ambil_calendar_event_by_id($id)
    {
        return $this->db
                    ->where('id', $id)
                    ->get('calendar_event')
                    ->row_array();
    }
    public function ambil_pegawai_jadwal($id_pegawai = null)
    {
        if ($id_pegawai === null) {
            $id_pegawai = (int) $this->session->id_pegawai;
        }

        return $this->db
            ->select([
                'pj.tgl_jadwal',
                'peg.nama_pegawai',
                'peg.no_hp',
                'kdj.nama_dinas_jaga',
                'kw.kode_warna',
                'kw2.kode_warna AS text_warna'
            ])
            ->from('pegawai_jadwal pj')
            ->join('ol_pegawai peg', 'peg.id_pegawai = pj.id_pegawai', 'left')
            ->join('kol_dinas_jaga kdj', 'kdj.id_dinas_jaga = pj.id_dinas_jaga', 'left')
            ->join('kol_warna kw', 'kw.id_warna = kdj.id_warna', 'left')
            ->join('kol_warna kw2', 'kw2.id_warna = kdj.id_text', 'left')
            ->where('pj.id_pegawai', $id_pegawai)
            ->get()
            ->result_array();
    }
// =======================================================
	function ambil_data_kompetensi_null()
	{
		$work = $this->m_umum->ambil_data('kol_working','barcode_working',$idr);
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=lp.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
		$this->db->where("lp.id_logbooker", $this->session->id_pegawai);
		$this->db->where('lp.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		if($idr > 0){
			$this->db->where("lp.id_instansi", $work['id_working']);
		}
	    $this->db->group_by('nkk.id_kompetensi'); 
		$q = $this->db->get_where('ol_logbook lp',array('lp.id_logbooker'=>$this->session->id_pegawai));
			return $q->result_array();
	}
	function ambil_data_link_pengurus($id)
	{
		$this->db->join('ol_pengurus', 'ol_pengurus.id_pengurus=ol_pegawai_pengurus.id_pengurus','left');
		$this->db->join('kol_ms_pengurus', 'kol_ms_pengurus.id_ms_pengurus=ol_pengurus.id_ms_pengurus','left');
		$this->db->where('link_akses is NOT NULL', NULL, FALSE);
		/*$where = "link_akses is  NOT NULL";
		$this->db->where($where);*/
		$this->db->group_by('link_akses'); 
		$q = $this->db->get_where('ol_pegawai_pengurus',array('id_pegawai'=>$id,'status_ms_pengurus'=>1));
		return $q->result_array();
	}
	function ambil_data_link_struktur($id)
	{
		$this->db->join('ol_struktur', 'ol_struktur.id_struktur=ol_pegawai_struktur.id_struktur','left');
		$this->db->join('kol_ms_struktur', 'kol_ms_struktur.id_ms_struktur=ol_struktur.id_ms_struktur','left');
		$this->db->where('link_akses is NOT NULL', NULL, FALSE);
		/*$where = "link_akses is  NOT NULL";
		$this->db->where($where);*/
		$this->db->group_by('link_akses'); 
		$q = $this->db->get_where('ol_pegawai_struktur',array('id_pegawai'=>$id,'status_ms_struktur'=>1));
		return $q->result_array();
	}
	function ol_akses($id)
	{
		$this->db->join('akses', 'akses.id_akses=ol_akses.id_akses','left');
		$q = $this->db->get_where('ol_akses',array('id_pegawai'=>$id,'status_ol_akses'=>'1'));
		return $q->result_array();
	}
	function ambil_data_dropdown_pengurus_pengcab($id)
	{
		$this->db->select('nama_pengcab,ol_pengurus.id_pengcab,barcode_pengcab');
		$this->db->join('ol_pengurus', 'ol_pengurus.id_pengurus=ol_pegawai_pengurus.id_pengurus','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pengurus.id_pengcab','left');
		$this->db->group_by('ol_pengurus.id_pengcab'); 
		$q = $this->db->get_where('ol_pegawai_pengurus',array('ol_pegawai_pengurus.id_pegawai'=>$id,'status_pengcab'=>1,'status_pegawai_pengurus'=>1));
		return $q->result_array();
	}
	function ambil_data_rujukan_instansi()
	{
		$this->db->select("nama_instansi,id_instansi");
        $query = $this->db->get_where('ol_instansi')->result_array();
		$q= array_column($query,'nama_instansi','id_instansi');
		return $q;
	}
	  function ambil_berkas_surat_ijin_list(){
	    $this->db->join('ol_pegawai peg', 'peg.id_pegawai=ob.id_pegawai','left');
	    $this->db->join('ol_pegawai_instansi opi', 'opi.id_pegawai=peg.id_pegawai','left');
	    $this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
	    $this->db->join('ol_berkas_kategori obk', 'obk.id_berkas_kategori=ob.id_kategori_berkas','left');
	    $this->db->where("status_berkas", 1);
	    $this->db->where("ob.id_pegawai", $this->session->id_pegawai);
	    $this->db->where("obk.kunci", 0);
	    $q = $this->db->get_where('ol_berkas ob');
	    return $q->result_array();
	  }
	  function ambil_data_mitra(){
	    $this->db->join('kol_mitra', 'kol_mitra.id_mitra=kol_working_mitra.id_mitra','left');
	    $this->db->join('srt_struktur_jabatan', 'srt_struktur_jabatan.id_struktur_jabatan=kol_mitra.id_struktur_jabatan','left');
/*	    $this->db->join('ol_unit', 'ol_unit.id_struktur_jabatan=srt_struktur_jabatan.id_struktur_jabatan','left');
	    $this->db->join('kol_working', 'kol_working.id_working=ol_unit.id_instansi','left');*/
	    $this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=kol_working_mitra.barcode_pegawai','left');
	    $this->db->where("status_mitra", 1);
	    $this->db->where("status_working_mitra", 1);
	    $this->db->where("id_pegawai", $this->session->id_pegawai);
	  //  echo $this->db->last_query();die();
	    $q = $this->db->get('kol_working_mitra');
	    return $q->result_array();
	  }
	  function login_data_mitra($kondisi,$grup=FALSE){
	    $this->db->join('kol_mitra', 'kol_mitra.id_mitra=kol_working_mitra.id_mitra','left');
	    $this->db->join('srt_struktur_jabatan', 'srt_struktur_jabatan.id_struktur_jabatan=kol_mitra.id_struktur_jabatan','left');
	    $this->db->join('ol_unit', 'ol_unit.id_struktur_jabatan=srt_struktur_jabatan.id_struktur_jabatan','left');
	    $this->db->join('kol_working', 'kol_working.id_working=ol_unit.id_instansi','left');
	    $this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=kol_working_mitra.barcode_pegawai','left');
	    $this->db->where($kondisi);
/*	    $this->db->where("status_mitra", 1);
	    $this->db->where("status_working_mitra", 1);
	    $this->db->where("id_pegawai", $this->session->id_pegawai);*/
        if($grup){
          $this->db->group_by($grup);
        }
	    $q = $this->db->get_where('kol_working_mitra');
	    return $q->result_array();
	  }
	  function count_data_mitra($kondisi,$grup=FALSE){
	    $this->db->join('kol_mitra', 'kol_mitra.id_mitra=kol_working_mitra.id_mitra','left');
	    $this->db->join('srt_struktur_jabatan', 'srt_struktur_jabatan.id_struktur_jabatan=kol_mitra.id_struktur_jabatan','left');
	    $this->db->join('ol_unit', 'ol_unit.id_struktur_jabatan=srt_struktur_jabatan.id_struktur_jabatan','left');
	    $this->db->join('kol_working', 'kol_working.id_working=ol_unit.id_instansi','left');
	    $this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=kol_working_mitra.barcode_pegawai','left');
        $this->db->where($kondisi);
/*	    $this->db->where("status_mitra", 1);
	    $this->db->where("status_working_mitra", 1);
	    $this->db->where("id_pegawai", $this->session->id_pegawai);*/
        if($grup){
          $this->db->group_by($grup);
        }
        // id_unit, status_bayar_working, tgl_akhir_working_mitra
        $query = $this->db->select("COUNT(*) as num")->get_where('kol_working_mitra');
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
	  }
	// =======================================================================
	function cek_login()	//Login.php
	{
		$username=$this->input->post('username');
		$password=$this->input->post('password');
		$password=hash("sha512", md5($password));
	//	$this->db->select("*,ol_pegawai.username,ol_pegawai.password");
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_user.id_pegawai','left');
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
		$this->db->join('kol_working', 'kol_working.id_working=ol_user.refer','left');
		$query=$this->db->get_where('ol_user', array('username'=>$username, 'password'=>$password));
		return $query->row_array();
	}
	function ambil_user($id)
	{
		$this->db->order_by('id_user','ASC');
		$q = $this->db->get_where('ol_user',array('id_pegawai'=>$id));
		return $q->row_array();
	}
	function ambil_data_ms_pengurus_untuk_sa($id_pengcab,$id_ms_pengurus)
	{
	$this->db->join('ol_pegawai peg', 'peg.id_pegawai=opp.id_pegawai','left');
	$this->db->join('ol_pengurus op', 'op.id_pengurus=opp.id_pengurus','left');
	$this->db->join('ol_pengcab opc', 'opc.id_pengcab=op.id_pengcab','left');
	$this->db->join('kol_ms_pengurus kmp', 'kmp.id_ms_pengurus=op.id_ms_pengurus','left');
	if($id_pengcab > 0){
		$this->db->where('op.id_pengcab', $id_pengcab);		
	}	
	if($id_ms_pengurus > 0){
		$this->db->where('op.id_ms_pengurus', $id_ms_pengurus);		
	}	
	$query = $this->db->get_where('ol_pegawai_pengurus opp',array('status_pegawai_pengurus'=>'1','status_pengurus'=>'1','status_ms_pengurus'=>'1'));
	return $query->result_array();
	}
	function ambil_data_instansi_untuk_sa($id_instansi,$id_jabatan)
	{
	$this->db->join('ol_pegawai peg', 'peg.id_pegawai=opi.id_pegawai','left');
	$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
	$this->db->join('jabatan jb', 'jb.id_jabatan=jf.id_jabatan','left');
	$this->db->join('kol_working kw', 'kw.id_working=opi.id_instansi','left');
	if($id_instansi > 0){
		$this->db->where('opi.id_instansi', $id_instansi);		
	}	
	if($id_jabatan > 0){
		$this->db->where('jf.id_jabatan', $id_jabatan);		
	}		
	$query = $this->db->get_where('ol_pegawai_instansi opi',array('status_pegawai'=>'1','visible'=>'1','status_pegawai_instansi'=>'1'));
	return $query->result_array();
	}
/*	function ambil_data_pegawai_edit_pendaftaran($id)
	{
		$this->db->select("nama_pegawai,id_pegawai");
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pegawai.id_pengcab','left');
		$q = $this->db->get_where('ol_pegawai',array('ol_pegawai.id_pengcab'=>$id,'status_pegawai'=>'1','visible'=>'1'))->result_array();
		$hasil= array_column($q,'nama_pegawai','id_pegawai');
		return $hasil;
	}*/
	function ambil_bahan()
	{
		if(isset($_POST['searchTerm']) && !empty($_POST['searchTerm'])){
			$search = $this->input->post('searchTerm');
			$this->db->group_start();
			$this->db->like('nama_bahan', $search);
			$this->db->group_end();
		}
		$this->db->where('status_bahan', 1);
		$this->db->where('id_unit', $this->session->unit);
		$this->db->order_by("nama_bahan", "asc");
	//	$this->db->limit(5);
		$r = $this->db->get('ol_bahan')->result_array();
		return $r;
	}	
	function ambil_reject()
	{
		if(isset($_POST['searchTerm']) && !empty($_POST['searchTerm'])){
			$search = $this->input->post('searchTerm');
			$this->db->group_start();
			$this->db->like('nama_reject', $search);
			$this->db->group_end();
		}
		$this->db->where('status_reject', 1);
		$this->db->where('id_unit', $this->session->unit);
		$this->db->order_by("nama_reject", "asc");
	//	$this->db->limit(5);
		$r = $this->db->get('kol_reject')->result_array();
		return $r;
	}	
	function cmd_bahan(){
		$this->db->select("id_bahan, nama_bahan");
		$q = $this->db->get_where('ol_bahan',array('status_bahan'=> 1,'id_unit'=>$this->session->unit))->result_array();
		$hasil= array_column($q,'nama_bahan','id_bahan');
		return $hasil;
	}
	function cmd_reject(){
		$this->db->select("id_reject, nama_reject");
		$q = $this->db->get_where('kol_reject',array('status_reject'=> 1,'id_unit'=>$this->session->unit))->result_array();
		$hasil= array_column($q,'nama_reject','id_reject');
		return $hasil;
	}
	function ambil_etik_instansi(){
		$ids = explode(',', $this->session->list_instansi);
		$this->db->select("concat(nama_jabatan,' - ',nama_working) as nama_working, id_etik_instansi as id_working");
		$this->db->join('kol_working kw', 'kw.id_working=ol_etik_instansi.id_instansi','left');
		$this->db->join('jabatan', 'jabatan.id_jabatan=ol_etik_instansi.id_jabatan','left');
	    $this->db->where_in('ol_etik_instansi.id_instansi',$ids);
		$q = $this->db->get_where('ol_etik_instansi',array('status_etik_instansi'=> 1))->result_array();
		$hasil= array_column($q,'nama_working','id_working');
		return $hasil;
	}
	function ambil_etik_instansi_all(){
		$this->db->select("concat(nama_jabatan,' - ',nama_working) as nama_working, id_etik_instansi as id_working");
		$this->db->join('kol_working kw', 'kw.id_working=ol_etik_instansi.id_instansi','left');
		$this->db->join('jabatan', 'jabatan.id_jabatan=ol_etik_instansi.id_jabatan','left');
		$q = $this->db->get_where('ol_etik_instansi',array('status_etik_instansi'=> 1))->result_array();
		$hasil= array_column($q,'nama_working','id_working');
		return $hasil;
	}
	function cmd_gambar_kop(){
		$this->db->select("id_gambar, nama_gambar");
		$q = $this->db->get_where('kol_gambar',array('status_gambar'=> 1,'id_instansi'=>$this->session->refer))->result_array();
		$hasil= array_column($q,'nama_gambar','id_gambar');
		return $hasil;
	}
	function ambil_data_pegawai_4_sa()
	{
		$q = $this->db->get_where('ol_pegawai');
		return $q->result_array();
	}
	function ambil_data_pegawai_4_sa_no_null(){
		$this->db->select("concat(nik,' - ',nama_pegawai) as nama_pegawai,id_pegawai");
		$q = $this->db->get_where('ol_pegawai')->result_array();
		$hasil= array_column($q,'nama_pegawai','id_pegawai');
		return $hasil;
	}
	function ambil_data_instansi_all()
	{
		$this->db->select("nama_working,barcode_working");
		$this->db->join('kol_working kw', 'kw.id_working=pi.id_instansi','left');
	    $this->db->group_by('pi.id_instansi'); 
		$q = $this->db->get_where('ol_pegawai_instansi pi');
			return $q->result_array();
	}
	function ambil_data_unit_instansi()
	{
		$this->db->select("concat(nama_unit,' - ',nama_working) as nama_unit, id_unit");
		$this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
		$this->db->join('ol_pegawai_instansi opi', 'opi.id_instansi=kw.id_working','left');
		$q = $this->db->get_where('ol_unit ou',array('opi.id_pegawai'=>$this->session->id_pegawai))->result_array();
		$hasil= array_column($q,'nama_unit','id_unit');
		return $hasil;
	}
	function ambil_data_unit_pelayanan()
	{
		$this->db->select("nama_unit, id_unit");
		$this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
		return $q = $this->db->get_where('ol_unit ou')->result_array();
	}
	function ambil_data_unit_instansi_member()
	{
		$this->db->select("concat(nama_unit,' - ',nama_working) as nama_unit, id_unit");
		$this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
		$q = $this->db->get_where('ol_unit ou',array('ou.id_instansi'=>$this->session->refer))->result_array();
		$hasil= array_column($q,'nama_unit','id_unit');
		return $hasil;
	}
	function ambil_pengumuman($eimplo){
		$ids = explode(',', $eimplo);
		$this->db->join('ol_pegawai_pengurus opp', 'opp.id_pegawai_pengurus=ol_pengumuman.id_pegawai_pengurus','left');
		$this->db->join('ol_pengurus opg', 'opg.id_pengurus=opp.id_pengurus','left');
		$this->db->join('ol_pengcab opc', 'opc.id_pengcab=opg.id_pengcab','left');
		$this->db->join('kol_ms_pengurus kmp', 'kmp.id_ms_pengurus=opg.id_ms_pengurus','left');
		$this->db->join('ol_pegawai op', 'op.id_pegawai=ol_pengumuman.id_pegawai','left');
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=op.id_jabatan_fungsional','left');
		$this->db->where_in('opg.id_pengcab',$ids);
		$this->db->order_by("id_pengumuman desc, opg.id_pengcab ASC");
//		$this->db->order_by("ol_pengumuman.id_pengumuman", "desc");
		$this->db->limit(30);
		$q = $this->db->get_where('ol_pengumuman');
		return $q->result_array();
	}
	function ambil_data_dropdown_admin_pengumuman($id)
	{
		$this->db->select('nama_pengcab,ol_pengurus.id_pengcab,barcode_pengcab');
		$this->db->join('ol_pengurus', 'ol_pengurus.id_pengurus=ol_pegawai_pengurus.id_pengurus','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pengurus.id_pengcab','left');
		$this->db->order_by('ol_pengurus.id_pengcab', 'asc'); 
		$q = $this->db->get_where('ol_pegawai_pengurus',array('ol_pegawai_pengurus.id_pegawai'=>$id,'status_pengcab'=>1,'status_pegawai_pengurus'=>1,'id_ms_pengurus'=>1));
		return $q->row_array();
	}
  	function ambil_id_pegawai_unit($id){
		$this->db->join('ol_unit u', 'u.id_unit=opu.id_unit','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=opu.id_pegawai','left'); 
		$q = $this->db->get_where('ol_pegawai_unit opu',array('status_pegawai'=>1,'status_pegawai_unit'=>1,'status_unit'=>1,'opu.id_pegawai'=>$id));
		return $q->result_array();
	}
	function ambil_unit_nonull()
	{
		$instansi = explode(',', $this->session->mas_ins);
		$this->db->select("id_unit,concat(nama_unit,' - ',nama_working) as nama_unit");
		$this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
		$this->db->where_in('id_instansi', $instansi);
		$q = $this->db->get_where('ol_unit ou',array('status_unit'=>1))->result_array();
		$hasil= array_column($q,'nama_unit','id_unit');
		return $hasil;
    }
	function ambil_punit_nonull()
	{
		$this->db->select("id_working,nama_working");
		$this->db->join('ol_unit u', 'u.id_unit=opu.id_unit','left');		
		$this->db->join('kol_working kw', 'kw.id_working=u.id_instansi','left');
		$q = $this->db->get_where('ol_pegawai_unit opu',array('status_pegawai_unit'=>1,'status_unit'=>1,'opu.id_pegawai'=>$this->session->id_pegawai))->result_array();
		$hasil= array_column($q,'nama_working','id_working');
		return $hasil;
    }
	function ambil_punit_nonull2()
	{
		$this->db->select("opu.id_unit,nama_unit");
		$this->db->join('ol_unit u', 'u.id_unit=opu.id_unit','left');		
		$this->db->join('kol_working kw', 'kw.id_working=u.id_instansi','left');
		$q = $this->db->get_where('ol_pegawai_unit opu',array('status_pegawai_unit'=>1,'status_unit'=>1,'opu.id_pegawai'=>$this->session->id_pegawai))->result_array();
		$hasil= array_column($q,'nama_unit','id_unit');
		return $hasil;
    }
  	function ambil_id_pegawai_level($id){
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=opl.id_pegawai','left'); 
		$q = $this->db->get_where('ol_pegawai_level opl',array('status_pegawai'=>1,'status_pegawai_level'=>1,'opl.id_pegawai'=>$id));
		return $q->result_array();
	}
	function ambil_data_instansi_untuk_session($id)
	{
	//	$this->db->join('kol_working kw', 'kw.id_working=pi.id_instansi','left');
		$q = $this->db->get_where('ol_pegawai_instansi',array('id_pegawai'=>$id));
			return $q->result_array();
	}
	function ambil_data_ms_pengurus_untuk_session($id)	//daftar.php pasien
	{
	$this->db->join('ol_pengurus op', 'op.id_pengurus=opp.id_pengurus','left');
	$this->db->join('ol_pengcab opc', 'opc.id_pengcab=op.id_pengcab','left');
	$this->db->join('kol_ms_pengurus kmp', 'kmp.id_ms_pengurus=op.id_ms_pengurus','left');
//	$this->db->group_by('opp.id_pegawai');
	$query = $this->db->get_where('ol_pegawai_pengurus opp',array('status_pegawai_pengurus'=>'1','status_pengurus'=>'1','status_ms_pengurus'=>'1','id_pegawai'=>$id));
	return $query->result_array();
	}
	function ambil_data_ms_struktur_untuk_session($id)	//daftar.php pasien
	{
	$this->db->join('ol_struktur os', 'os.id_struktur=ops.id_struktur','left');
	$this->db->join('kol_working kw', 'kw.id_working=os.id_instansi','left');
	$this->db->join('kol_ms_struktur kms', 'kms.id_ms_struktur=os.id_ms_struktur','left');
//	$this->db->group_by('ops.id_pegawai');
	$query = $this->db->get_where('ol_pegawai_struktur ops',array('status_pegawai_struktur'=>'1','status_struktur'=>'1','status_ms_struktur'=>'1','id_pegawai'=>$id));
	return $query->result_array();
	}
	function ambil_data_ms_enabled_untuk_session($id)	//daftar.php pasien
	{
	$query = $this->db->get_where('a_ol_enabled',array('status_ol_enabled'=>'1','id_pegawai'=>$id));
	return $query->result_array();
	}
	function ambil_data_ms_akses_untuk_session($id)	//daftar.php pasien
	{
	$this->db->join('akses ak', 'ak.id_akses=oa.id_akses','left');
	$query = $this->db->get_where('ol_akses oa',array('status_ol_akses'=>'1','id_pegawai'=>$id));
	return $query->result_array();
	}
	function cmd_tahun_logbook()
	{
		$this->db->select("distinct(DATE_FORMAT(tgl_logbook,'%Y')) as tgl_logbook");
		$q= $this->db->get('ol_logbook')->result_array();
		$hasil= array_column($q,'tgl_logbook','tgl_logbook');
		return $hasil;
    }
	function cmd_working_logbook()
	{
		$this->db->select("distinct(id_instansi) as id_working,nama_working");
		$this->db->join('kol_working', 'kol_working.id_working=ol_logbook.id_instansi','left');
		$q= $this->db->get('ol_logbook');
		return $q->result_array();
    }
	function ambil_data_a_online()
	{
		$this->db->where("not exists (select null from a_ol_enabled where a_ol_enabled.id_kode_online = a_online.id_kode_online AND a_ol_enabled.id_pegawai = '".$this->session->id_pegawai."')",null,false);
		$q = $this->db->get_where('a_online',array('menu'=>1,'status_online'=>1,'header'=>0));
		//echo $this->db->last_query();
		return $q->result_array();
	}
	function ambil_data_a_shortcut()
	{
		$this->db->join('a_online', 'a_online.kode_online=a_shortcut.kode_online','left');	
		$this->db->join('a_ol_enabled', 'a_ol_enabled.id_kode_online=a_ol_enabled.id_kode_online','left');	
		$this->db->group_by('judul_shortcut');
		$q = $this->db->get_where('a_shortcut',array('status_shortcut'=>1,'status_ol_enabled'=>1,'enabled'=>1,'status_online'=>1,'header'=>0,'id_pegawai'=>$this->session->id_pegawai));
		//echo $this->db->last_query();
		return $q->result_array();
	}
	function ambil_data_a_enabled()
	{
		$this->db->join('a_online', 'a_online.id_kode_online=a_ol_enabled.id_kode_online','left');	
		$q = $this->db->get_where('a_ol_enabled',array('status_ol_enabled'=>1,'enabled'=>1,'status_online'=>1,'header'=>0,'id_pegawai'=>$this->session->id_pegawai));
		return $q->result_array();
	}
	function ambil_data_akses_pengurus($id)	//daftar.php pasien
	{
		$this->db->join('ol_pengurus', 'ol_pengurus.id_pengurus=ol_pegawai_pengurus.id_pengurus','left');		
		$this->db->join('kol_ms_pengurus', 'kol_ms_pengurus.id_ms_pengurus=ol_pengurus.id_ms_pengurus','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pengurus.id_pengcab','left');
		$query = $this->db->get_where('ol_pegawai_pengurus',array('id_pegawai'=>$id,'status_pegawai_pengurus'=>1,'status_pengurus'=>1,'status_pengcab'=>1,'status_ms_pengurus'=>1));
		return $query->row_array();
	}
    function jumlah_data_pegawai_pengurus_pengcab_4_saving($id,$id2)
    {
		$this->db->select("ol_pegawai_pengurus.id_pegawai_pengurus");
		$this->db->join('ol_pengurus', 'ol_pengurus.id_pengurus=ol_pegawai_pengurus.id_pengurus','left');
        $query = $this->db->select("COUNT(*) as num")->get_where('ol_pegawai_pengurus',array('ol_pengurus.id_pengcab'=>$id,'ol_pengurus.id_ms_pengurus'=>$id2));
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
    }
	function jumlah_record_logbook($id_kewenangan)
    {
    		$this->db->join('ol_logbook', 'ol_logbook.barcode_logbook=ol_logbook_validasi.barcode_logbook','left');
			$this->db->where('id_logbooker', $this->session->id_pegawai);
			$this->db->where('validasi', '2');
			$this->db->where('id_kewenangan', $id_kewenangan);
/*			$this->db->group_start();
			$this->db->where('v_karu', '2');
			$this->db->or_where('v_kabid', '2');
			$this->db->or_where('v_asesor', '2');
			$this->db->or_where('v_komite', '2');
			$this->db->or_where('v_direktur', '2');
			$this->db->group_end();*/
        $query = $this->db->select("COUNT(*) as num")->get_where('ol_logbook_validasi');
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
    }
    function jumlah_akses_pengurus($id,$level)    
    {
    	$this->db->join('ol_pengurus', 'ol_pengurus.id_pengurus=ol_pegawai_pengurus.id_pengurus','left');
		$this->db->join('kol_ms_pengurus', 'kol_ms_pengurus.id_ms_pengurus=ol_pengurus.id_ms_pengurus','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pengurus.id_pengcab','left');
        $query = $this->db->select("COUNT(*) as num")->get_where('ol_pegawai_pengurus',array('id_pegawai'=>$id,'ol_pengurus.id_ms_pengurus'=>$level,'status_pegawai_pengurus'=>1,'status_pengurus'=>1,'status_pengcab'=>1,'status_ms_pengurus'=>1));
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
    }
    function jumlah_akses_pengurus_barcodepengcab($id,$level)
    {
    	$this->db->join('ol_pengurus', 'ol_pengurus.id_pengurus=ol_pegawai_pengurus.id_pengurus','left');
		$this->db->join('kol_ms_pengurus', 'kol_ms_pengurus.id_ms_pengurus=ol_pengurus.id_ms_pengurus','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pengurus.id_pengcab','left');
        $query = $this->db->select("COUNT(*) as num")->get_where('ol_pegawai_pengurus',array('id_pegawai'=>$id,'barcode_pengcab'=>$level,'status_pegawai_pengurus'=>1,'status_pengurus'=>1,'status_pengcab'=>1,'status_ms_pengurus'=>1));
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
    }
    function jumlah_akses_struktur($kondisi)
    {
    	$this->db->join('kol_working', 'kol_working.id_working=ol_struktur.id_instansi','left');
		$this->db->join('kol_ms_struktur', 'kol_ms_struktur.id_ms_struktur=ol_struktur.id_ms_struktur','left');
        $query = $this->db->select("COUNT(*) as num")->get_where('ol_struktur',$kondisi);
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
    }
    function jumlah_hak_akses_pegawai($kondisi)  
    {
    	$this->db->join('akses', 'akses.id_akses=ol_akses.id_akses','left');
        $this->db->where($kondisi);
        $query = $this->db->select("COUNT(*) as num")->get_where('ol_akses',array('status_ol_akses'=>'1'));
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
    }
	function ambil_user_pegawai($id){
		$levelku = $this->session->id_level;
		$pegawaiku = $this->session->id_pegawai;
		if($this->session->has_userdata('give_level')){
			$this->db->join('ol_pegawai p', 'p.id_pegawai=u.id_pegawai','left');
			$this->db->join('user_level ul', 'ul.id_level=u.id_level','left');
			$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=p.id_jabatan_fungsional','left');
			$this->db->join('kol_provinsi prov', 'prov.id_prov=p.id_prov','left');
			$this->db->join('kol_kabupaten kab', 'kab.id_kab=p.id_kab','left');
			$this->db->join('kol_kecamatan kec', 'kec.id_kec=p.id_kec','left');
			$this->db->join('kol_kelurahan kel', 'kel.id_kel=p.id_kel','left');
			$q = $this->db->get_where('ol_user u',array('u.id_pegawai'=>$pegawaiku));
			return $q->row_array();
		}else{
			if($this->session->has_userdata('id_level')){
				$this->db->join('pegawai p', 'p.id_pegawai=u.id_pegawai','left');
				$this->db->join('user_level ul', 'ul.id_level=u.id_level','left');
				$this->db->join('unit un', 'un.id_unit=p.id_unit','left');
			//	$this->db->join('ruangan r', 'r.id_ruangan=p.id_ruangan','left');
			//	$this->db->join('struktur_jabatan sj', 'sj.id_struktur_jabatan=r.id_struktur_jabatan','left');
				$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=p.id_jabatan_fungsional','left');
				$this->db->join('kol_provinsi prov', 'prov.id_prov=p.id_prov','left');
				$this->db->join('kol_kabupaten kab', 'kab.id_kab=p.id_kab','left');
				$this->db->join('kol_kecamatan kec', 'kec.id_kec=p.id_kec','left');
				$this->db->join('kol_kelurahan kel', 'kel.id_kel=p.id_kel','left');
				$q = $this->db->get_where('user u',array('u.id_user'=>$id));
				return $q->row_array();
			}else{
				$this->db->join('ol_pegawai p', 'p.id_pegawai=u.id_pegawai','left');
				$this->db->join('user_level ul', 'ul.id_level=u.id_level','left');
				$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=p.id_jabatan_fungsional','left');
				$this->db->join('kol_provinsi prov', 'prov.id_prov=p.id_prov','left');
				$this->db->join('kol_kabupaten kab', 'kab.id_kab=p.id_kab','left');
				$this->db->join('kol_kecamatan kec', 'kec.id_kec=p.id_kec','left');
				$this->db->join('kol_kelurahan kel', 'kel.id_kel=p.id_kel','left');
				$q = $this->db->get_where('ol_user u',array('u.id_pegawai'=>$pegawaiku));
				return $q->row_array();
			}			
		}
	}
	function ambil_ol_pegawai($id){
			$this->db->join('ol_pegawai p', 'p.id_pegawai=u.id_pegawai','left');
			$this->db->join('user_level ul', 'ul.id_level=u.id_level','left');
			$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=p.id_jabatan_fungsional','left');
			$this->db->join('kol_provinsi prov', 'prov.id_prov=p.id_prov','left');
			$this->db->join('kol_kabupaten kab', 'kab.id_kab=p.id_kab','left');
			$this->db->join('kol_kecamatan kec', 'kec.id_kec=p.id_kec','left');
			$this->db->join('kol_kelurahan kel', 'kel.id_kel=p.id_kel','left');
			$q = $this->db->get_where('ol_user u',array('u.id_user'=>$id));
			return $q->row_array();	
	}
	function cek_online_level(){
		$pegawaiku = $this->session->id_pegawai;
			$this->db->join('ol_user u', 'u.id_pegawai=p.id_pegawai','left');
			$this->db->join('user_level ul', 'ul.id_level=u.id_level','left');
			$q = $this->db->get_where('ol_pegawai p',array('p.id_pegawai'=>$pegawaiku));
			return $q->row_array();
	}
	function ambil_data_pengurus_4_pengumuman($id)
	{
		$this->db->select("concat('Komentar Sebagai : ',nama_ms_pengurus,' - ',nama_pengcab) as nama_pegawai_pengurus,id_pegawai_pengurus");
		$this->db->join('ol_pengurus', 'ol_pengurus.id_pengurus=ol_pegawai_pengurus.id_pengurus','left');
		$this->db->join('kol_ms_pengurus', 'kol_ms_pengurus.id_ms_pengurus=ol_pengurus.id_ms_pengurus','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pengurus.id_pengcab','left');
        $query = $this->db->get_where('ol_pegawai_pengurus',array('ol_pegawai_pengurus.id_pegawai'=>$id,'status_pengcab'=>1,'status_pegawai_pengurus'=>1,'status_ms_pengurus'=>1,'ol_pengurus.id_ms_pengurus !='=>5))->result_array();
		$q= array_column($query,'nama_pegawai_pengurus','id_pegawai_pengurus');
		return $q;
	}
	function ambil_data_rujukan_working()
	{
		$this->db->select("nama_working,id_working");
        $query = $this->db->get_where('kol_working')->result_array();
		$q= array_column($query,'nama_working','id_working');
		return $q;
	}
	function ambil_rujukan_working_null_data()
	{
		$this->db->select("nama_working,id_working");
        $this->db->where('deleted_at IS NULL', null, false);
        $q = $this->db->get_where('kol_working');
		return $q->result_array();
	}
	function rec_rujukan_working_null_data($id)
	{
		$this->db->select('COUNT(*) as num');
		$this->db->where("status_bayar_working", 2);
		$this->db->or_where("status_bayar_working = 1 AND expired_working > CURDATE()", NULL, FALSE);
        $q = $this->db->get_where('kol_working',array('id_working'=>$id));
	    $result = $q->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
	}
	function ambil_data_rujukan_working_null()
	{
		$this->db->select("nama_working,id_working");
        $q = $this->db->get_where('kol_working');
		return $q->result_array();
	}
	function ambil_data_rujukan_working_prov()
	{
		$this->db->select("concat(nama_working,' ',nama_prov) nama_working,barcode_working");
		$this->db->join('kol_provinsi prov', 'prov.id_prov=kol_working.id_prov','left');
        $q = $this->db->get_where('kol_working');
		return $q->result_array();
	}
	function ambil_data_rujukan_no_null(){
		$this->db->select("id_working,nama_working");
		$q = $this->db->get_where('kol_working')->result_array();
		$hasil= array_column($q,'nama_working','id_working');
		return $hasil;
	}
	function ambil_kategori_gambar(){
		$this->db->select("id_kategori_gambar,nama_kategori_gambar");
		$q = $this->db->get_where('kol_kategori_gambar')->result_array();
		$hasil= array_column($q,'nama_kategori_gambar','id_kategori_gambar');
		return $hasil;
	}
	function cmd_jabfung(){
		$this->db->select("id_jabatan_fungsional,nama_jabatan_fungsional");
		$q = $this->db->get_where('jabatan_fungsional')->result_array();
		$hasil= array_column($q,'nama_jabatan_fungsional','id_jabatan_fungsional');
		return $hasil;
	}
	function cmd_jabfung_profil(){
		$this->db->select("id_jabatan_fungsional,nama_jabatan_fungsional");
		$q = $this->db->get_where('jabatan_fungsional',array('id_jabatan'=>$this->session->id_jabatan));
		return $q->result_array();
	}
	function ambil_instansi_no_null(){
		$this->db->select("id_instansi,nama_instansi");
		$q = $this->db->get_where('ol_instansi')->result_array();
		$hasil= array_column($q,'nama_instansi','id_instansi');
		return $hasil;
	}
	function cmd_tipe_pegawai(){
		$this->db->select("id_status_pegawai,nama_status_pegawai");
		$q= $this->db->get_where('ol_status_pegawai',array('status'=>'1'))->result_array();
		$hasil= array_column($q,'nama_status_pegawai','id_status_pegawai');
		return $hasil;
	}
	function cmd_tipe_pegawai_null(){
		$this->db->select("id_status_pegawai,nama_status_pegawai");
		return $q= $this->db->get_where('ol_status_pegawai',array('status'=>1))->result_array();
	}
	function status_perawat(){
		$status = array('0'=>'Non Keperawatan','1'=>'Perawat / Bidan');
		return $status;
	}
	function kol_kode_kewenangan_null(){
		$this->db->select("id_kode_kewenangan, concat(nama_kode_kewenangan,' - ',jenjang_karir) as nama_kode_kewenangan");
		$q = $this->db->get_where('kol_kode_kewenangan',array('status_kode_kewenangan'=>'1'));
		return $q->result_array();
	}
	function kol_kode_kewenangan_null_pk($id){
		$this->db->select("id_kode_kewenangan, concat(nama_kode_kewenangan,' - ',jenjang_karir) as nama_kode_kewenangan");
		$q = $this->db->get_where('kol_kode_kewenangan',array('status_kode_kewenangan'=>'1','id_kode_kewenangan <='=>$id));
		return $q->result_array();
	}
	function ambil_registrasi($id){
		$q = $this->db->get_where('ol_registrasi reg',array('barcode_registrasi'=>$id));
		return $q->row_array();
	}
	function cmd_level($id){
		$ids = explode(',', $id);
		$this->db->select("id_level,nama_level");
		$this->db->where_in('id_level',$ids);
		$q= $this->db->get_where('user_level',array('id_level !='=>'99'))->result_array();
		$hasil= array_column($q,'nama_level','id_level');
		return $hasil;
	}
	function a_icd10($id)
	{   
		$this->db->select("id_icd10 as data, CONCAT('[',id_icd10,'] ',nama_icd10) as value, nama_icd10 as nama");
        $this->db->like("id_icd10", $id);
        $this->db->or_like("nama_icd10", $id);
        $this->db->limit('50,0');
        return $this->db->get_where('kol_icd10')->result_array();
    }
	function ambil_a_icd10()
	{   
		$this->db->select("id_icd10 as id_icd10, CONCAT('[',id_icd10,'] ',nama_icd10) as nama_icd10");
        return $this->db->get_where('kol_icd10')->result_array();
    }
	function ambil_data_dropdown_unit()	//daftar.php pasien
	{
	//	$query = $this->db->get_where('ol_unit',array('id_instansi' => $id,'status_unit'=>1));
		$query = $this->db->get_where('ol_unit',array('status_unit'=>1));
		return $query->result_array();
	}
	function ambil_data_dropdown_unit_no_null($id)	//daftar.php pasien
	{
		$this->db->select("nama_unit,id_unit");
		$query = $this->db->get_where('ol_unit',array('id_instansi' => $id,'status_unit'=>1))->result_array();
		$q= array_column($query,'nama_unit','id_unit');
		return $q;
	}
	function ambil_data_dropdown_unit_null($id)	//daftar.php pasien
	{
		$this->db->select("concat(nama_unit,'  - [',nama_working,']') as nama_unit,id_unit");
		$this->db->join('kol_working', 'kol_working.id_working=ol_unit.id_instansi','left');
		$query = $this->db->get_where('ol_unit',array('id_instansi' => $id,'status_unit'=>1));
		return $query->result_array();
	}
	function ambil_peminatan()
	{
		$this->db->select("nama_peminatan,id_peminatan");
        $query = $this->db->get_where('ol_peminatan',array('id_jabatan'=>$this->session->id_jabatan))->result_array();
		$q= array_column($query,'nama_peminatan','id_peminatan');
		return $q;
	}
	function cmd_level_no_member($id){
		$ids = explode(',', $id);
		$this->db->select("id_level,nama_level");
		$this->db->where_in('id_level',$ids);
		$q= $this->db->get_where('user_level',array('id_level !='=>'99','id_level !='=>'51'))->result_array();
		$hasil= array_column($q,'nama_level','id_level');
		return $hasil;
	}
	function ambil_data_dropdown_kab($id)
	{
		$this->db->select("id_kab,nama_kab");
		$q= $this->db->get_where('kol_kabupaten',array('id_prov' => $id))->result_array();
		$hasil= array_column($q,'nama_kab','id_kab');
		return $hasil;
	}
	function ambil_data_dropdown_kec($id)
	{
		$this->db->select("id_kec,nama_kec");
		$q= $this->db->get_where('kol_kecamatan',array('id_kab' => $id))->result_array();
		$hasil= array_column($q,'nama_kec','id_kec');
		return $hasil;
	}
	function ambil_data_dropdown_kel($id)
	{
		$this->db->select("id_kel,nama_kel");
		$q= $this->db->get_where('kol_kelurahan',array('id_kec' => $id))->result_array();
		$hasil= array_column($q,'nama_kel','id_kel');
		return $hasil;
	}
	function ambil_user_level_member($id){
		$this->db->join('user_level ul', 'ul.id_level=u.id_level','left');
		$q = $this->db->get_where('ol_user u',array('status_user'=>'1','id_pegawai'=>$id));
		return $q->result_array();
	}
	function ambil_user_instansi_user(){
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=u.id_pegawai','left');
		$q = $this->db->get_where('ol_user u',array('status_user'=>1,'status_pegawai'=>1,'unit'=>$this->session->unit));
		return $q->result_array();
	}
	function cmd_kategori_working(){
		$this->db->select("id_kategori_work,nama_kategori_work");
		$q= $this->db->get_where('kol_kategori_work')->result_array();
		$hasil= array_column($q,'nama_kategori_work','id_kategori_work');
		return $hasil;
	}
	function ambil_data_dropdown_jabfung_aktifasi($id)	//daftar.php pasien
	{
		$query = $this->db->get_where('jabatan_fungsional',array('id_status_pegawai'=>$id));
		return $query->result_array();
	}
	function ambil_data_dropdown_jabfung_status($id)	//daftar.php pasien
	{
		$query = $this->db->get_where('jabatan_fungsional',array('id_status_pegawai'=>$id,'id_jabatan'=>$this->session->id_jabatan));
		return $query->result_array();
	}
	function ambil_kategori_str(){
		$this->db->select("id_berkas_kategori,nama_berkas_kategori");
		$q = $this->db->get_where('ol_berkas_kategori',array('kunci'=>0))->result_array();
		$hasil= array_column($q,'nama_berkas_kategori','id_berkas_kategori');
		return $hasil;
	}
	function ambil_kategori_berkas(){
		$this->db->select("id_berkas_kategori,nama_berkas_kategori");
		$q = $this->db->get_where('ol_berkas_kategori',array('kunci'=>25,'instansi_berkas_kategori'=>$this->session->refer))->result_array();
	//	$q = $this->db->get_where('ol_berkas_kategori',array('kunci'=>25))->result_array();
		$hasil= array_column($q,'nama_berkas_kategori','id_berkas_kategori');
		return $hasil;
	}
	function kategori_pelatihan()
	{
		$this->db->select("id_kategori_pelatihan, nama_kategori_pelatihan");
		$q = $this->db->get_where('ol_kategori_pelatihan',array('status_kategori_pelatihan'=>1,'instansi_kategori_pelatihan'=>$this->session->refer));
		return $q->result_array();
	}
	function ambil_kategori_berkas_pelatihan(){
		$this->db->select("id_berkas_kategori,nama_berkas_kategori");
		$q = $this->db->get_where('ol_berkas_kategori',array('kunci'=>1))->result_array();
		$hasil= array_column($q,'nama_berkas_kategori','id_berkas_kategori');
		return $hasil;
	}
	function ambil_data_surat_kategori($id)
	{
		$this->db->select("id_kategori,nama_kategori");
//$this->db->where('id_jabatan', $id);
	//	$this->db->where('status_kategori', 1);
	//	$this->db->or_where('kunci', 1);
		$q= $this->db->get_where('ol_surat_kategori',array('id_jabatan'=>$id,'status_kategori'=>1))->result_array();
		$hasil= array_column($q,'nama_kategori','id_kategori');
		return $hasil;
	}
	function ambil_data_pengcab($id)
	{
		return $this->db->get_where('ol_pengcab',array('id_jabatan'=>$id,'status_pengcab'=>'1'))->result_array();
	}
	function ambil_data_pengcab_dari_pegawai_pengurus($id)
	{
		$this->db->select('nama_pengcab,ol_pengurus.id_pengcab,barcode_pengcab');
		$this->db->join('ol_pengurus', 'ol_pengurus.id_pengurus=ol_pegawai_pengurus.id_pengurus','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pengurus.id_pengcab','left');
		$this->db->group_by('ol_pengurus.id_pengcab'); 
		$q = $this->db->get_where('ol_pegawai_pengurus',array('ol_pengcab.id_jabatan'=>$id,'status_pengcab'=>'1','status_pegawai_pengurus'=>'1'));
		return $q->result_array();
	}
	function ambil_data_dropdown_kab_pengcab($id)
	{
	//	$this->db->select('nama_pengcab,ol_pengurus.id_pengcab,barcode_pengcab');
		$this->db->join('kol_working kw', 'kw.id_working=opu.id_instansi','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=opu.id_pegawai','left');
	//	$this->db->join('ol_pengurus', 'ol_pengurus.id_pengurus=ol_pegawai_pengurus.id_pengurus','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=peg.id_pengcab','left');
		$this->db->group_by('opu.id_instansi'); 
		$q = $this->db->get_where('ol_pegawai_instansi opu',array('opu.id_pegawai'=>$id,'status_pengcab'=>'1','status_pegawai_instansi'=>'1'));
		return $q->result_array();
	}
	function ambil_data_rujukan_working_kab_null($eimplo)
	{
		$idx = explode(',', $eimplo);
		$this->db->select("nama_working,id_working");
		$this->db->where_in("kol_working.id_working",$idx);
        $q = $this->db->get_where('kol_working');
		return $q->result_array();
	}
	function ambil_data_rujukan_kab_working($eimplo)
	{
		$idx = explode(',', $eimplo);
		$this->db->select("nama_working,id_working");
		$this->db->where_in("kol_working.id_working",$idx);
        $query = $this->db->get_where('kol_working')->result_array();
		$q= array_column($query,'nama_working','id_working');
		return $q;
	}
	function ambil_lobook_pemulihan_detil($id){
		$this->db->join('ol_logbook_pemulihan olp', 'olp.id_logbook_pemulihan=lpd.id_logbook_pemulihan','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=olp.id_pegawai','left');
	//	$this->db->order_by('tgl_pengajuan', "desc");
		$q = $this->db->get_where('ol_logbook_pemulihan_detil lpd',array('lpd.id_logbook_pemulihan'=>$id));
		return $q->result_array();
	}
	function list_pengcab_from_session_no_null()
	{
		$idx = explode(',', $this->session->list_pengcab);
		$this->db->select('nama_pengcab,id_pengcab');
		$this->db->where_in("id_pengcab",$idx);
		$q = $this->db->get_where('ol_pengcab',array('status_pengcab'=>1))->result_array();
		$hasil= array_column($q,'nama_pengcab','id_pengcab');
		return $hasil;
	}
	function ambil_data_dropdown_struktur($id)
	{
		$this->db->select('nama_working,ol_struktur.id_instansi,barcode_working');
		$this->db->join('ol_struktur', 'ol_struktur.id_struktur=ol_pegawai_struktur.id_struktur','left');
		$this->db->join('kol_working', 'kol_working.id_working=ol_struktur.id_instansi','left');
		$this->db->group_by('ol_struktur.id_instansi'); 
		$q = $this->db->get_where('ol_pegawai_struktur',array('ol_pegawai_struktur.id_pegawai'=>$id,'status_struktur'=>1,'status_pegawai_struktur'=>1));
		return $q->result_array();
	}
	function ambil_data_semua_struktur()
	{
		$this->db->join('ol_struktur', 'ol_struktur.id_struktur=ol_pegawai_struktur.id_struktur','left');
		$this->db->join('kol_ms_struktur', 'kol_ms_struktur.id_ms_struktur=ol_struktur.id_ms_struktur','left');
		$this->db->join('kol_working', 'kol_working.id_working=ol_struktur.id_instansi','left');
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_pegawai_struktur.id_pegawai','left');
	//	$this->db->group_by('ol_struktur.id_instansi'); 
		$q = $this->db->get_where('ol_pegawai_struktur',array('status_struktur'=>1,'status_pegawai_struktur'=>1));
		return $q->result_array();
	}
	function ambil_logbook_pegawai($id){
		$q = $this->db->get_where('ol_logbook lp',array('lp.id_logbook'=>$id));
		return $q->row_array();
	}
	function ambil_kompetensi_null(){
		$id_in =  array(0,$this->session->refer);
		$this->db->select("nkk.id_kompetensi,nama_kompetensi");
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
		$this->db->where_in("nkp.instansi_kompetensi", $id_in);
		$this->db->group_by('nkk.id_kompetensi');
		$query = $this->db->get_where('ol_logbook ol',array('id_logbooker'=>$this->session->id_pegawai));
		return $query->result_array();
	}
	function ambil_kompetensi_range($tgla,$tglb,$kw)	//daftar.php pasien
	{
		$id_in =  array(0,$this->session->refer);
		$this->db->select("nkk.id_kompetensi,nama_kompetensi");
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
		$this->db->where('ol.tgl_logbook BETWEEN "'. $tgla. '" and "'. $tglb.'"');
		$this->db->where("ol.id_instansi", $kw);
		$this->db->group_by('nkk.id_kompetensi');
		$query = $this->db->get_where('ol_logbook ol',array('id_logbooker'=>$this->session->id_pegawai));
		return $query->result_array();
	}
	function ambil_instansi_range($tgla,$tglb)	//daftar.php pasien
	{
		$this->db->select("ol.id_instansi,nama_working");
		$this->db->join('kol_working kw', 'kw.id_working=ol.id_instansi','left');
		$this->db->where('ol.tgl_logbook BETWEEN "'. $tgla. '" and "'. $tglb.'"');
		$this->db->group_by('ol.id_instansi');
		$q = $this->db->get_where('ol_logbook ol',array('id_logbooker'=>$this->session->id_pegawai))->result_array();
		$hasil= array_column($q,'nama_working','id_instansi');
		return $hasil;
	}
	function ambil_bare_range($tgla,$tglb,$kw,$select,$where,$grup)	//daftar.php pasien
	{
		$this->db->select($select);
		$this->db->join('ol_logbook ol', 'ol.id_logbook=olp.id_logbook','left');
		$this->db->join('ol_bahan ob', 'ob.id_bahan=olp.id_bahan','left');
		$this->db->join('kol_reject or', 'or.id_reject=olp.id_reject','left');
		$this->db->where('ol.tgl_logbook BETWEEN "'. $tgla. '" and "'. $tglb.'"');
		$this->db->where("ol.id_instansi", $kw);
		$this->db->where($where.' >', 0);
		$this->db->group_by('olp.'.$grup);
		$query = $this->db->get_where('ol_logbook_pasien olp',array('id_logbooker'=>$this->session->id_pegawai));
		return $query->result_array();
	}
	function ambil_pasien_range($id,$select,$where,$grup=FALSE)	//daftar.php pasien
	{
	//	$lpd = $this->ambil_surveyor_logbook_laporan_tabel($id);
		$this->db->select($select);
		$this->db->join('ol_logbook ol', 'ol.id_logbook=olp.id_logbook','left');
		$this->db->join('ol_pasien ops', 'ops.id_pasien=olp.id_pasien','left');
		$this->db->join('ol_bahan ob', 'ob.id_bahan=olp.id_bahan','left');
		$this->db->join('kol_reject or', 'or.id_reject=olp.id_reject','left');
	//	$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
	//	$this->db->where("ol.id_instansi", $lpd['id_instansi']);
		$this->db->where($where.' >', 0);
		if($grup){
			$this->db->group_by('olp.'.$grup);
		}
		$query = $this->db->get_where('ol_logbook_pasien olp',array('ol.id_logbook'=>$id));
		return $query->result_array();
	}
	function ambil_logbook_pasien($id)	//daftar.php pasien
	{
		$this->db->join('ol_logbook ol', 'ol.id_logbook=olp.id_logbook','left');
		$this->db->join('ol_pasien ops', 'ops.id_pasien=olp.id_pasien','left');
		$query = $this->db->get_where('ol_logbook_pasien olp',array('olp.id_logbook_pasien'=>$id));
		return $query->row_array();
	}
	function ambil_data_struktur_ke_plan($id,$id2)
	{
		$this->db->select("id_pegawai_struktur,concat(nama_ms_struktur,' ',nama_working) as nama_pegawai_struktur");
		$this->db->join('ol_struktur', 'ol_struktur.id_struktur=ol_pegawai_struktur.id_struktur','left');
		$this->db->join('kol_working', 'kol_working.id_working=ol_struktur.id_instansi','left');
		$this->db->join('kol_ms_struktur', 'kol_ms_struktur.id_ms_struktur=ol_struktur.id_ms_struktur','left');
		$this->db->where('ol_pegawai_struktur.id_pegawai', $id);
		$this->db->where('ol_struktur.id_ms_struktur', $id2);
		$q = $this->db->get_where('ol_pegawai_struktur',array('status_struktur'=> 1,'status_pegawai_struktur'=> 1))->result_array();
		$hasil= array_column($q,'nama_pegawai_struktur','id_pegawai_struktur');
		return $hasil;
	}
	function ambil_data_struktur_ke_plan_same_prov($id)
	{
		$this->db->select("id_pegawai_struktur,concat(nama_ms_struktur,' ',nama_working) as nama_pegawai_struktur");
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_pegawai_struktur.id_pegawai','left');
		$this->db->join('ol_struktur', 'ol_struktur.id_struktur=ol_pegawai_struktur.id_struktur','left');
		$this->db->join('kol_working', 'kol_working.id_working=ol_struktur.id_instansi','left');
		$this->db->join('kol_ms_struktur', 'kol_ms_struktur.id_ms_struktur=ol_struktur.id_ms_struktur','left');
	//	$this->db->where('ol_pegawai.id_prov', 'kol_working.id_prov');
		$this->db->where('ol_struktur.id_ms_struktur', $id);
		$q = $this->db->get_where('ol_pegawai_struktur',array('status_struktur'=> 1,'status_pegawai_struktur'=> 1))->result_array();
		$hasil= array_column($q,'nama_pegawai_struktur','id_pegawai_struktur');
		return $hasil;
	}
  	function ambil_jabatan_from_pegstr($eimplo,$id,$idms){
  		$ids = explode(',', $eimplo);
  		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_pegawai_struktur.id_pegawai','left');
  		$this->db->join('ol_struktur', 'ol_struktur.id_struktur=ol_pegawai_struktur.id_struktur','left');
		$this->db->where_in('id_pegawai_struktur',$ids);
		$this->db->where('ol_pegawai_struktur.id_pegawai',$id);
		$this->db->where('ol_struktur.id_ms_struktur',$idms);
		$q = $this->db->get_where('ol_pegawai_struktur',array('status_pegawai'=>1,'status_pegawai_struktur'=>1));
		return $q->row_array();
	}
  	function cmd_pegawai_for_karu_null($eimplo){
  		$ids = explode(',', $eimplo);
		$this->db->where_in('id_pegawai',$ids);
		$q = $this->db->get_where('ol_pegawai peg',array('status_pegawai'=>1));
		return $q->result_array();
	}
	function ambil_data_pengcab_dari_pegawai_pengurusno_grup($id)
	{
		$this->db->select("ol_pegawai_pengurus.id_pegawai_pengurus,ol_pegawai_pengurus.id_pegawai,concat(nama_ms_pengurus,'  ',nama_pengcab,' : ',nama_pegawai) as nama_pegawai_pengurus");
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_pegawai_pengurus.id_pegawai','left');
		$this->db->join('ol_pengurus', 'ol_pengurus.id_pengurus=ol_pegawai_pengurus.id_pengurus','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pengurus.id_pengcab','left');
		$this->db->join('kol_ms_pengurus', 'kol_ms_pengurus.id_ms_pengurus=ol_pengurus.id_ms_pengurus','left');
		$q = $this->db->get_where('ol_pegawai_pengurus',array('ol_pengcab.id_jabatan'=>$this->session->id_jabatan,'status_pengcab'=>'1','status_pegawai_pengurus'=>'1','kol_ms_pengurus.id_ms_pengurus !='=>5));
		return $q->result_array();
	}
	function ambil_data_pengcab_dari_pegawai_pengurusno_grup_perpengcab($id)
	{
		$this->db->select("ol_pegawai_pengurus.id_pegawai_pengurus,ol_pegawai_pengurus.id_pegawai,concat(nama_ms_pengurus,'  ',nama_pengcab,' : ',nama_pegawai) as nama_pegawai_pengurus");
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_pegawai_pengurus.id_pegawai','left');
		$this->db->join('ol_pengurus', 'ol_pengurus.id_pengurus=ol_pegawai_pengurus.id_pengurus','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pengurus.id_pengcab','left');
		$this->db->join('kol_ms_pengurus', 'kol_ms_pengurus.id_ms_pengurus=ol_pengurus.id_ms_pengurus','left');
		$q = $this->db->get_where('ol_pegawai_pengurus',array('ol_pengcab.id_jabatan'=>$this->session->id_jabatan,'ol_pengurus.id_pengcab'=>$id,'status_pengcab'=>'1','status_pegawai_pengurus'=>'1','kol_ms_pengurus.id_ms_pengurus !='=>5));
		return $q->result_array();
	}
	function simpan_kor_tambah(){
		$kode = $this->m_rancak->kode_generator(15,'KK');
		$data_kewenangan = array(
			'barcode_kor_kategori' => $kode,
			'id_korespodensi' => $this->input->post('id_korespodensi'),
			'pengcab_asal' => $this->input->post('pengcab_asal'),
			'pengcab_tujuan' => $this->input->post('pengcab_tujuan'),
			'id_kategori' => $this->input->post('id_kategori')
		);
		return $this->db->insert('ol_kor_kategori', $data_kewenangan);
	}
	function simpan_kor_detil_pegawai(){
		$id_kor_kategori = $this->input->post('id_kor_kategori');
		$chk = $this->input->post('chk[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				$this->db->select("COUNT(*) as num");
				$this->db->where('id_kor_kategori', $id_kor_kategori);
				$this->db->where('id_pegawai_pengurus',$chk[$i]);
				$q = $this->db->get('ol_kor_detil')->row();
				$jmlx = $q->num;
				if($jmlx == 0){
					$data_pendaftaran2 = array(
						'id_kor_kategori' => $id_kor_kategori,
						'id_pegawai_pengurus' => $chk[$i]
					);
					$this->db->insert('ol_kor_detil', $data_pendaftaran2);
				}
			}
		}
	}
	function rubah_acc_kor_detil($isi,$id){
		$data_pendaftaran = array(
			'wkt_terbaca' => date('Y-m-d H:i:s'),
			'acc' => $isi
		);
		$this->db->where('id_kor_detil',$id);
		$this->db->update('ol_kor_detil', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}
	function rubah_status_kor_print($id){
		$data_pendaftaran = array(
			'status_kor_print' => 0
		);
		$this->db->where('id_kor_kategori',$id);
		$this->db->update('ol_kor_print', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}
	function simpan_kor_print(){
		$kode = $this->m_rancak->kode_generator(15,'KP');
		$tgl_kor_print = $this->input->post('tgl_kor_print');
		$tgl_kor_print = date('Y-m-d', strtotime($tgl_kor_print));
		$tgl_awal = $this->input->post('tgl_awal');
		$tgl_awal = date('Y-m-d', strtotime($tgl_awal));
		$tgl_akhir = $this->input->post('tgl_akhir');
		$tgl_akhir = date('Y-m-d', strtotime($tgl_akhir));
		$data_kewenangan = array(
			'barcode_kor_print' => $kode,
			'id_kor_kategori' => $this->input->post('id_kor_kategori'),
			'title_kor_print' => $this->input->post('title_kor_print'),
			'no_kor_print' => $this->input->post('no_kor_print'),
			'tmp_kor_print' => $this->input->post('tmp_kor_print'),
			'tmp_modul' => $this->input->post('tmp_modul'),
			'modul' => $this->input->post('modul'),
			'tgl_kor_print' => $tgl_kor_print,
			'tgl_awal' => $tgl_awal,
			'tgl_akhir' => $tgl_akhir,
			'font_size' => $this->input->post('font_size'),
			'id_pegawai' => $this->session->id_pegawai
		);
		$this->db->insert('ol_kor_print', $data_kewenangan);
		return $this->db->insert_id();
	}
	function simpan_kor_print_detil($id){
		$id_pegawai = $this->input->post('id_pegawai[]');
		$chk = $this->input->post('chk[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				$this->db->select("COUNT(*) as num");
				$this->db->where('id_pegawai_pengurus',$chk[$i]);
				$this->db->where('id_kor_print',$id);
				$q = $this->db->get('ol_kprint_detil')->row();
				$jmlx = $q->num;
				if($jmlx == 0){
					$data_pendaftaran2 = array(
						'id_kor_print' => $id,
						'id_pegawai_pengurus' => $chk[$i]
					);
					$this->db->insert('ol_kprint_detil', $data_pendaftaran2);
				}
			}
		}
	}
	function kor_print_all($id)
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*
		";
	//--------- Siapkan Parameter dari datatables ---------
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$cari = $this->input->post("search");
	//--------- Cek kolom mana yg di urut dan asc/desc -----
		$col =$order[0]['column'];
		$dir= $order[0]['dir'];

	//--------- Ambil nama field dari daftar POST columns dttables
		$dt_kolom=$this->input->post("columns");

	//--------- Mulai Query UTAMA ---------------------------
		$this->db->select($fields);  //01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan [coding here]
				//	 case 'nama_pengcab' : $nmf="op.nama_pengcab";break;
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->where("ok.barcode_korespodensi", $id);

			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('ol_kor_print okp');
		$this->db->join('ol_kor_kategori okk', 'okk.id_kor_kategori=okp.id_kor_kategori','left');
		$this->db->join('ol_korespodensi ok', 'ok.id_korespodensi=okk.id_korespodensi','left');
		$this->db->join('ol_surat_kategori', 'ol_surat_kategori.id_kategori=okk.id_kategori','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=okk.pengcab_asal','left');
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ok.id_pengirim','left');
		$this->db->where("ok.barcode_korespodensi", $id);

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'nama_pengcab' : $nmf="op.nama_pengcab";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where("ok.barcode_korespodensi", $id);

			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
		$this->db->from('ol_kor_print okp');
		$this->db->join('ol_kor_kategori okk', 'okk.id_kor_kategori=okp.id_kor_kategori','left');
		$this->db->join('ol_korespodensi ok', 'ok.id_korespodensi=okk.id_korespodensi','left');
		$this->db->join('ol_surat_kategori', 'ol_surat_kategori.id_kategori=okk.id_kategori','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=okk.pengcab_asal','left');
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ok.id_pengirim','left');
		$this->db->where("ok.barcode_korespodensi", $id);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/*		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){*/
/*		 		$kondisi=array('id_pengirim'=>$this->session->id_pegawai);
				$jml = $this->m_umum->jumlah_record_filter('ol_korespodensi',$kondisi);*/
/*			}else{
				$jml = $this->m_umum->jumlah_record_tabel('ol_surat');
			}
		}else{
			$jml = $this->m_umum->jumlah_record_tabel('ol_surat');
		}*/		
		$jml = $this->m_umum->jumlah_record_tabel('ol_kor_print');
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function ambil_kor_detil_pengcab($id){
	//	$this->db->join('ol_kor_ttd', 'ol_kor_ttd.id_kor_detil=ol_kor_detil.id_kor_detil','left');
		$this->db->select("*,concat(nama_ms_pengurus,' ',nama_pengcab,'  : ',nama_pegawai) as nama_pegawai_pengurus");
		$this->db->join('ol_pegawai_pengurus', 'ol_pegawai_pengurus.id_pegawai_pengurus=ol_kor_detil.id_pegawai_pengurus','left');
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_pegawai_pengurus.id_pegawai','left');
		$this->db->join('ol_pengurus', 'ol_pengurus.id_pengurus=ol_pegawai_pengurus.id_pengurus','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pengurus.id_pengcab','left');
		$this->db->join('kol_ms_pengurus', 'kol_ms_pengurus.id_ms_pengurus=ol_pengurus.id_ms_pengurus','left');
	//	$this->db->order_by('ol_pengurus.id_pengcab','asc');
		$q = $this->db->get_where('ol_kor_detil',array('id_kor_kategori'=>$id));
		return $q->result_array();
	}
	function ambil_kor_detil_signature($id){
	//	$this->db->join('ol_kor_ttd', 'ol_kor_ttd.id_kor_detil=ol_kor_detil.id_kor_detil','left');
		$this->db->select("*,concat(nama_ms_pengurus,' ',nama_pengcab,'  : ',nama_pegawai) as nama_pegawai_pengurus");
		$this->db->join('ol_kor_detil', 'ol_kor_detil.id_kor_kategori=ol_kor_kategori.id_kor_kategori','left');
		$this->db->join('ol_pegawai_pengurus', 'ol_pegawai_pengurus.id_pegawai_pengurus=ol_kor_detil.id_pegawai_pengurus','left');
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_pegawai_pengurus.id_pegawai','left');
		$this->db->join('ol_pengurus', 'ol_pengurus.id_pengurus=ol_pegawai_pengurus.id_pengurus','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pengurus.id_pengcab','left');
		$this->db->join('kol_ms_pengurus', 'kol_ms_pengurus.id_ms_pengurus=ol_pengurus.id_ms_pengurus','left');
		$this->db->order_by('ol_pengurus.id_pengcab','asc');
		$q = $this->db->get_where('ol_kor_kategori',array('id_kor_kategori'=>$id));
		return $q->result_array();
	}
	function ambil_data_pengcab_for_tambah($id)
	{
		$this->db->join('ol_pegawai_pengurus', 'ol_pegawai_pengurus.id_pegawai_pengurus=ol_kor_detil.id_pegawai_pengurus','left');
		$this->db->join('ol_pengurus', 'ol_pengurus.id_pengurus=ol_pegawai_pengurus.id_pengurus','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pengurus.id_pengcab','left');
		$this->db->join('kol_ms_pengurus', 'kol_ms_pengurus.id_ms_pengurus=ol_pengurus.id_ms_pengurus','left');
		$q = $this->db->get_where('ol_kor_detil',array('ol_kor_detil.id_kor_detil'=>$id));
		return $q->row_array();
	}
	function ambil_data_okk_and_osk_4_pengajuan($id)
	{
		$this->db->join('ol_surat_kategori', 'ol_surat_kategori.id_kategori=ol_kor_kategori.id_kategori','left');
		$this->db->order_by('id_kor_kategori','asc');
		$q = $this->db->get_where('ol_kor_kategori',array('ol_kor_kategori.id_korespodensi'=>$id));
		return $q->row_array();
	}
	function ambil_data_instansi_4_print($id)
	{
		$this->db->join('kol_working kw', 'kw.id_working=pi.id_instansi','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=pi.id_pegawai','left');
	//    $this->db->group_by('pi.id_instansi'); 
		$q = $this->db->get_where('ol_pegawai_instansi pi',array('pi.id_pegawai'=>$id));
			return $q->result_array();
	}
	function ambil_data_kor_print_4_print($id)
	{
		$this->db->select("*, opc.nama_pengcab as asal, opd.nama_pengcab as tujuan");
		$this->db->join('ol_kor_kategori okk', 'okk.id_kor_kategori=okp.id_kor_kategori','left');
		$this->db->join('ol_surat_kategori osk', 'osk.id_kategori=okk.id_kategori','left');
		$this->db->join('ol_korespodensi ok', 'ok.id_korespodensi=okk.id_korespodensi','left');
		$this->db->join('kol_working kwr', 'kwr.id_working=ok.id_instansi','left');
/*		$this->db->join('ol_pegawai_pengurus opp', 'opp.id_pegawai_pengurus=okpd.id_pegawai_pengurus','left');
		$this->db->join('ol_pengurus op', 'op.id_pengurus=opp.id_pengurus','left');*/
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=ok.id_pengirim','left');
		$this->db->join('ol_pengcab opc', 'opc.id_pengcab=okk.pengcab_asal','left');
		$this->db->join('ol_pengcab opd', 'opd.id_pengcab=okk.pengcab_tujuan','left');
		$q = $this->db->get_where('ol_kor_print okp',array('okp.id_kor_print'=>$id));
		return $q->row_array();
	}
	function ambil_data_kprin_detil_4_print($id)
	{
		$this->db->join('ol_kor_print', 'ol_kor_print.id_kor_print=ol_kprint_detil.id_kor_print','left');
		$this->db->join('ol_pegawai_pengurus', 'ol_pegawai_pengurus.id_pegawai_pengurus=ol_kprint_detil.id_pegawai_pengurus','left');
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_pegawai_pengurus.id_pegawai','left');
		$this->db->join('ol_pengurus', 'ol_pengurus.id_pengurus=ol_pegawai_pengurus.id_pengurus','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pengurus.id_pengcab','left');
		$this->db->join('kol_ms_pengurus', 'kol_ms_pengurus.id_ms_pengurus=ol_pengurus.id_ms_pengurus','left');
		$q = $this->db->get_where('ol_kprint_detil',array('ol_kprint_detil.id_kor_print'=>$id));
		return $q->result_array();
	}
	function ambil_data_korespodensi($id)
	{
		$this->db->select("*,if(jk = '1' ,'Laki-laki','Perempuan') as jk,
			CONCAT((TIMESTAMPDIFF( YEAR, tgl_lahir, now() )), ' Tahun ',
			TIMESTAMPDIFF( MONTH, tgl_lahir, now() ) % 12, ' Bulan ',		
			FLOOR( TIMESTAMPDIFF( DAY, tgl_lahir, now() ) % 30.4375 ), ' Hari') as umur");
		$this->db->join('kol_working', 'kol_working.id_working=ok.id_instansi','left');
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ok.id_pengirim','left');
		$q = $this->db->get_where('ol_korespodensi ok',array('ok.barcode_korespodensi'=>$id));
		return $q->row_array();
	}
	function ambil_data_korespodensi_4_print($id)
	{
		$this->db->select("*,asal.nama_pengcab as asal,tujuan.nama_pengcab as tujuan,asal.kop_pengcab as kop");
		$this->db->join('ol_korespodensi ok', 'ok.id_korespodensi=ol_kor_kategori.id_korespodensi','left');
		$this->db->join('ol_pengcab asal', 'asal.id_pengcab=ok.pengcab_asal','left');
		$this->db->join('ol_pengcab tujuan', 'tujuan.id_pengcab=ok.pengcab_tujuan','left');
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ok.id_pengirim','left');
		$this->db->join('ol_surat_kategori', 'ol_surat_kategori.id_kategori=ol_kor_kategori.id_kategori','left');
	//	$this->db->join('ol_surat_format', 'ol_surat_format.id_kategori=ol_surat_kategori.id_kategori','left');
		$this->db->order_by('id_kor_kategori','asc');
		$q = $this->db->get_where('ol_kor_kategori',array('ol_kor_kategori.id_kor_kategori'=>$id));
		return $q->row_array();
	}
	function ambil_data_dropdown_pengcab($id)
	{
		$this->db->select('nama_pengcab,id_pengcab');
		$q = $this->db->get_where('ol_pengcab',array('id_jabatan'=>$id,'status_pengcab'=>'1'));
		return $q->result_array();
	}
	function ambil_data_pengcabnonull($id)
	{
		$this->db->select("id_pengcab,nama_pengcab");
		$q= $this->db->get_where('ol_pengcab',array('id_jabatan'=>$id,'status_pengcab'=>'1'))->result_array();
		$hasil= array_column($q,'nama_pengcab','id_pengcab');
		return $hasil;
	}
	function ambil_data_struktur_master_no_null()
	{
		$this->db->select("id_struktur,concat(nama_ms_struktur,' - ',nama_working) as nama_struktur");
		$this->db->join('kol_working', 'kol_working.id_working=ol_struktur.id_instansi','left');
		$this->db->join('kol_ms_struktur', 'kol_ms_struktur.id_ms_struktur=ol_struktur.id_ms_struktur','left');
		$q = $this->db->get_where('ol_struktur',array('status_struktur'=>1,'id_struktur >'=>0))->result_array();
		$hasil= array_column($q,'nama_struktur','id_struktur');
		return $hasil;
	}
	function ambil_data_struktur_master_bknadmin_null($id)
	{
		$ids = explode(',', $id);
		$this->db->select("id_struktur,concat(nama_ms_struktur,' - ',nama_working) as nama_struktur");
		$this->db->join('kol_working', 'kol_working.id_working=ol_struktur.id_instansi','left');
		$this->db->join('kol_ms_struktur', 'kol_ms_struktur.id_ms_struktur=ol_struktur.id_ms_struktur','left');
		$this->db->where_in('id_working',$ids);
		$q = $this->db->get_where('ol_struktur',array('status_struktur'=>1,'id_struktur >'=>1))->result_array();
		$hasil= array_column($q,'nama_struktur','id_struktur');
		return $hasil;
	}
	function ambil_data_pengurus_master_no_null($id)
	{
		$this->db->select("id_pengurus,concat(nama_pengcab,' - ',nama_ms_pengurus) as nama_pengurus");
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pengurus.id_pengcab','left');
		$this->db->join('kol_ms_pengurus', 'kol_ms_pengurus.id_ms_pengurus=ol_pengurus.id_ms_pengurus','left');
		$q = $this->db->get_where('ol_pengurus',array('ol_pengcab.id_jabatan'=>$id,'status_pengcab'=>'1'))->result_array();
		$hasil= array_column($q,'nama_pengurus','id_pengurus');
		return $hasil;
	}
	function ambil_data_pengurus_master_with_pegawai_no_null($id,$eimplo)
	{
		$idx = explode(',', $eimplo);
		$this->db->select("ol_pengurus.id_pengurus,concat(nama_pengcab,' - ',nama_ms_pengurus) as nama_pengurus");
//		$this->db->join('ol_pengurus', 'ol_pengurus.id_pengurus=ol_pegawai_pengurus.id_pengurus','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pengurus.id_pengcab','left');
		$this->db->join('kol_ms_pengurus', 'kol_ms_pengurus.id_ms_pengurus=ol_pengurus.id_ms_pengurus','left');
		$this->db->where_in("ol_pengurus.id_pengcab",$idx);
//		$this->db->group_by('ol_pegawai_pengurus.id_pengurus'); 
		$q = $this->db->get_where('ol_pengurus',array('ol_pengcab.id_jabatan'=>$id,'status_pengcab'=>'1'))->result_array();
		$hasil= array_column($q,'nama_pengurus','id_pengurus');
		return $hasil;
	}
	function ambil_data_pengurus_master_with_pegawai_no_null_no_admin($id,$eimplo)
	{
		$idx = explode(',', $eimplo);
		$this->db->select("ol_pengurus.id_pengurus,concat(nama_pengcab,' - ',nama_ms_pengurus) as nama_pengurus");
//		$this->db->join('ol_pengurus', 'ol_pengurus.id_pengurus=ol_pegawai_pengurus.id_pengurus','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pengurus.id_pengcab','left');
		$this->db->join('kol_ms_pengurus', 'kol_ms_pengurus.id_ms_pengurus=ol_pengurus.id_ms_pengurus','left');
		$this->db->where_in("ol_pengurus.id_pengcab",$idx);
//		$this->db->group_by('ol_pegawai_pengurus.id_pengurus'); 
		$q = $this->db->get_where('ol_pengurus',array('ol_pengcab.id_jabatan'=>$id,'status_pengcab'=>'1','ol_pengurus.id_ms_pengurus >'=>'1'))->result_array();
		$hasil= array_column($q,'nama_pengurus','id_pengurus');
		return $hasil;
	}
	function ambil_data_pengurus_master_pengcab($eimplo)
	{
		$idx = explode(',', $eimplo);
		$this->db->select("ol_pengurus.id_pengurus,concat(nama_pengcab,' - ',nama_ms_pengurus) as nama_pengurus");
//		$this->db->join('ol_pengurus', 'ol_pengurus.id_pengurus=ol_pegawai_pengurus.id_pengurus','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pengurus.id_pengcab','left');
		$this->db->join('kol_ms_pengurus', 'kol_ms_pengurus.id_ms_pengurus=ol_pengurus.id_ms_pengurus','left');
		$this->db->where_in("ol_pengurus.id_pengcab",$idx);
		$this->db->order_by("nama_pengcab","asc");
		$q = $this->db->get_where('ol_pengurus',array('status_pengcab'=>'1','ol_pengurus.id_ms_pengurus >'=>'1'))->result_array();
		$hasil= array_column($q,'nama_pengurus','id_pengurus');
		return $hasil;
	}
	function ambil_data_struktur($id)
	{
		$this->db->select("ol_struktur.id_struktur,concat(nama_working,' - ',nama_ms_struktur) as nama_struktur");
//		$this->db->join('ol_pengurus', 'ol_pengurus.id_pengurus=ol_pegawai_pengurus.id_pengurus','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pengurus.id_pengcab','left');
		$this->db->join('kol_ms_pengurus', 'kol_ms_pengurus.id_ms_pengurus=ol_pengurus.id_ms_pengurus','left');
//		$this->db->group_by('ol_pegawai_pengurus.id_pengurus'); 
		$q = $this->db->get_where('ol_struktur',array('barcode_working'=>$id,'ol_struktur.id_ms_struktur >'=>'1'))->result_array();
		$hasil= array_column($q,'nama_struktur','id_struktur');
		return $hasil;
	}
	function ambil_data_ms_pengurus_no_null($id,$prov)
	{
		$this->db->select("id_ms_pengurus,nama_ms_pengurus");
		$this->db->where('id_prov', $prov);
		$this->db->where('id_jabatan', $id);
	//	$this->db->where('id_ms_pengurus !=', 5);				
		$this->db->where('status_ms_pengurus', 1);
//		$this->db->group_start();
//		$this->db->group_end();
		$this->db->or_where('kunci', 1);
		$q = $this->db->get_where('kol_ms_pengurus')->result_array();
		$hasil= array_column($q,'nama_ms_pengurus','id_ms_pengurus');
		return $hasil;
	}
	function ambil_data_ms_struktur_no_null($eimplo)
	{
		$ids = explode(',', $eimplo);
		$this->db->select("id_ms_struktur,nama_ms_struktur");
		$this->db->where_in('instansi_struktur', $ids);
		$this->db->where('status_ms_struktur', 1);
		$this->db->or_where('kunci', 1);
		$q = $this->db->get_where('kol_ms_struktur');
		return $q->result_array();
	}
	function ambil_data_ms_struktur_no_syarat()
	{
		$this->db->where('status_ms_struktur', 1);
		$q = $this->db->get_where('kol_ms_struktur');
		return $q->result_array();
	}
	function ambil_data_ms_struktur_no_syarat_no_null()
	{
		$this->db->select("id_ms_struktur,nama_ms_struktur");
		$this->db->where('status_ms_struktur', 1);
		$q = $this->db->get_where('kol_ms_struktur')->result_array();
		$hasil= array_column($q,'nama_ms_struktur','id_ms_struktur');
		return $hasil;
	}
	function ambil_data_ms_struktur_no_admin_syarat()
	{
		$q = $this->db->get_where('kol_ms_struktur',array('status_ms_struktur'=> 1,'id_ms_struktur >'=> 1));
		return $q->result_array();
	}
	function ambil_data_ms_struktur_no_admin_syarat_no_null()
	{
		$this->db->select("id_ms_struktur,nama_ms_struktur");
		$q = $this->db->get_where('kol_ms_struktur',array('status_ms_struktur'=> 1,'id_ms_struktur >'=> 1))->result_array();
		$hasil= array_column($q,'nama_ms_struktur','id_ms_struktur');
		return $hasil;
	}
	function ambil_data_ms_struktur_null($eimplo)
	{
		$ids = explode(',', $eimplo);
		$this->db->select("id_ms_struktur,nama_ms_struktur");
		$this->db->where_in('instansi_struktur', $ids);
		$this->db->where('status_ms_struktur', 1);
		$this->db->or_where('kunci', 1);
		$q = $this->db->get_where('kol_ms_struktur')->result_array();
		$hasil= array_column($q,'nama_ms_struktur','id_ms_struktur');
		return $hasil;
	}
	function ambil_data_ms_pengurus_no_null_no_admin($id,$prov)
	{
		$this->db->select("id_ms_pengurus,nama_ms_pengurus");
		$this->db->where('id_prov', $prov);
		$this->db->where('id_jabatan', $id);
		$this->db->where('status_ms_pengurus', 1);
		$this->db->or_where('kunci', 1);
		$q = $this->db->get_where('kol_ms_pengurus',array('id_ms_pengurus >'=>'1'))->result_array();
		$hasil= array_column($q,'nama_ms_pengurus','id_ms_pengurus');
		return $hasil;
	}
	function ambil_data_ms_pengurus($id,$prov)
	{
		$this->db->select("id_ms_pengurus,nama_ms_pengurus");
		$this->db->where('id_prov', $prov);
		$this->db->where('id_jabatan', $id);
		$this->db->where('status_ms_pengurus', 1);
		$this->db->or_where('kunci', 1);
		$q = $this->db->get_where('kol_ms_pengurus');
		return $q->result_array();
	}
	function ambil_data_etik_pegawai($id)
	{
		$this->db->join('ol_etik', 'ol_etik.id_etik=ol_etik_detil.id_etik','left');
		$q = $this->db->get_where('ol_etik_detil',array('id_etik_pegawai'=> $id));
		return $q->result_array();
	}
	function ambil_data_ms_pengurus_no_admin($id,$prov)
	{
		$this->db->select("id_ms_pengurus,nama_ms_pengurus");
		if($prov > 0){
		$this->db->where('id_prov', $prov); }
		$this->db->where('id_jabatan', $id);
		$this->db->where('status_ms_pengurus', 1);
		$this->db->or_where('kunci', 1);
		$q = $this->db->get_where('kol_ms_pengurus',array('id_ms_pengurus >'=>'1'));
		return $q->result_array();
	}
	function ambil_data_dropdown_pegawai_no_null($id,$prov)
	{
		$this->db->select("concat(nama_pegawai,' - ',nama_pengcab) as nama_pegawai,id_pegawai");
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pegawai.id_pengcab','left');
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
		$q = $this->db->get_where('ol_pegawai',array('ol_pengcab.id_jabatan'=>$id,'status_pegawai'=>'1','visible'=>'1','ol_pegawai.id_prov'=>$prov))->result_array();
		$hasil= array_column($q,'nama_pegawai','id_pegawai');
		return $hasil;
	}
	function ambil_data_dropdown_pegawai_no_null_pengcab($eimplo)
	{
		$idx = explode(',', $eimplo);
		$this->db->select("concat(nama_pegawai,' - ',nama_pengcab) as nama_pegawai,id_pegawai");
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pegawai.id_pengcab','left');
		$this->db->where_in("ol_pengcab.id_pengcab",$idx);
		$this->db->order_by("nama_pegawai","asc");
		$q = $this->db->get_where('ol_pegawai',array('status_pegawai'=>'1','visible'=>'1'))->result_array();
		$hasil= array_column($q,'nama_pegawai','id_pegawai');
		return $hasil;
	}
	function ambil_data_dropdown_pegawai_no_null_instansi($id)
	{
		$idx = explode(',', $id);
		$this->db->join('ol_pegawai','ol_pegawai.id_pegawai=ol_pegawai_instansi.id_pegawai','left');
	//	$this->db->join('kol_kode_kewenangan','kol_kode_kewenangan.id_kode_kewenangan=ol_pegawai.id_kode_kewenangan','left');
		$this->db->join('kol_working','kol_working.id_working=ol_pegawai_instansi.id_instansi','left');
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
		$this->db->where_in("ol_pegawai_instansi.id_instansi",$idx);
		$this->db->order_by('nama_pegawai', 'asc');
		$q = $this->db->get_where('ol_pegawai_instansi',array('status_pegawai'=>1,'visible'=>1));
		return $q->result_array();
	}
	function ambil_data_dropdown_pegawai_no_null_instansi_all()
	{
		$this->db->join('ol_pegawai','ol_pegawai.id_pegawai=ol_pegawai_instansi.id_pegawai','left');
		$this->db->join('kol_kode_kewenangan','kol_kode_kewenangan.id_kode_kewenangan=ol_pegawai.id_kode_kewenangan','left');
		$this->db->join('kol_working','kol_working.id_working=ol_pegawai_instansi.id_instansi','left');
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
		$this->db->order_by('nama_pegawai', 'asc');
		$q = $this->db->get_where('ol_pegawai_instansi',array('status_pegawai'=>1,'visible'=>1));
		return $q->result_array();
	}
	function ambil_data_dropdown_pegawai_untuk_pemulihan($id)
	{
		$this->db->select("concat(nama_pegawai,' - NIP : ',nip,' - ',nama_working) as nama_pegawai,ol_pegawai_instansi.id_pegawai");
		$this->db->join('ol_pegawai','ol_pegawai.id_pegawai=ol_pegawai_instansi.id_pegawai','left');
		$this->db->join('kol_kode_kewenangan','kol_kode_kewenangan.id_kode_kewenangan=ol_pegawai.id_kode_kewenangan','left');
		$this->db->join('kol_working','kol_working.id_working=ol_pegawai_instansi.id_instansi','left');
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
		$this->db->order_by('nama_pegawai', 'asc');
		$q = $this->db->get_where('ol_pegawai_instansi',array('status_pegawai'=>1,'visible'=>1,'ol_pegawai_instansi.id_instansi'=>$id));
		return $q->result_array();
	}
	function ambil_data_dropdown_pegawai_untuk_pemulihan_no_null($id)
	{
		$this->db->select("concat(nama_pegawai,' - NIP : ',nip,' - ',nama_working) as nama_pegawai,ol_pegawai_instansi.id_pegawai");
		$this->db->join('ol_pegawai','ol_pegawai.id_pegawai=ol_pegawai_instansi.id_pegawai','left');
		$this->db->join('kol_kode_kewenangan','kol_kode_kewenangan.id_kode_kewenangan=ol_pegawai.id_kode_kewenangan','left');
		$this->db->join('kol_working','kol_working.id_working=ol_pegawai_instansi.id_instansi','left');
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
		$this->db->order_by('nama_pegawai', 'asc');
		$q = $this->db->get_where('ol_pegawai_instansi',array('status_pegawai'=>1,'visible'=>1,'ol_pegawai_instansi.id_instansi'=>$id))->result_array();
		$hasil= array_column($q,'nama_pegawai','id_pegawai');
		return $hasil;
	}
	function ambil_lobook_perorang($id){
		$this->db->join('ol_logbook ol', 'ol.barcode_logbook=olv.barcode_logbook','left');
	  $this->db->join('ol_kewenangan kk', 'kk.id_kewenangan=ol.id_kewenangan','left');
//		$this->db->group_start();
	  $this->db->where('validasi', 2);
//	  $this->db->group_end();
	//	$this->db->order_by('tgl_pengajuan', "desc");
	  $q = $this->db->get_where('ol_logbook_validasi olv',array('ol.id_logbooker'=>$id));
	  return $q->result_array();
	}
	function ambil_lobook_pemulihan_detile($id){
	  $this->db->select("tgl_logbook,nama_kewenangan,olpd.result_tolak");
	  $this->db->join('ol_logbook_pemulihan olp', 'olp.id_logbook_pemulihan=olpd.id_logbook_pemulihan','left');
	  $this->db->join('ol_logbook_validasi olv', 'olv.id_logbook_validasi=olpd.id_logbook_validasi','left');
	  $this->db->join('ol_logbook ol', 'ol.id_logbook=olv.id_logbook','left');
	  $this->db->join('ol_kewenangan kk', 'kk.id_kewenangan=ol.id_kewenangan','left');
	  $this->db->where('olpd.result_tolak >', 0);
	  $q = $this->db->get_where('ol_logbook_pemulihan_detil olpd',array('olpd.id_logbook_pemulihan'=>$id));
	  return $q->result_array();
	}
	function ambil_kewenangan_lobook_pemulihan_detil($id){
		$this->db->join('ol_logbook_validasi olv', 'olv.id_logbook_validasi=opd.id_logbook_validasi','left');
		$this->db->join('ol_logbook ol', 'ol.id_logbook=olv.id_logbook','left');
	  $this->db->join('ol_kewenangan kk', 'kk.id_kewenangan=ol.id_kewenangan','left');
		$q = $this->db->get_where('ol_logbook_pemulihan_detil opd',array('opd.id_logbook_pemulihan'=>$id));
		return $q->result_array();
	}
	function ambil_jabatan_pendaftaran_pasien(){
		$this->db->join('ol_pegawai op', 'op.id_pegawai=opi.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=op.id_jabatan_fungsional','left');
	  	$this->db->join('jabatan j', 'j.id_jabatan=jf.id_jabatan','left');
	  	$this->db->group_by('jf.id_jabatan'); 
		$q = $this->db->get_where('ol_pegawai_instansi opi',array('op.status_pegawai'=>1,'id_instansi'=>$this->session->refer));
		return $q->result_array();
	}
	function ambil_pegawai_daftar($id)
	{
		$this->db->select("concat(nama_pegawai,' - Profesi : ',nama_jabatan) as nama_pegawai,ol_pegawai.id_pegawai,barcode_pegawai");
		$this->db->join('ol_pegawai','ol_pegawai.id_pegawai=ol_user.id_pegawai','left');
		$this->db->join('kol_kode_kewenangan','kol_kode_kewenangan.id_kode_kewenangan=ol_pegawai.id_kode_kewenangan','left');
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
		$this->db->join('jabatan', 'jabatan.id_jabatan=jabatan_fungsional.id_jabatan','left');
		$this->db->order_by('nama_pegawai', 'asc');
		$q = $this->db->get_where('ol_user',array('ol_pegawai.status_pegawai'=>1,'refer'=>$this->session->refer,'jabatan_fungsional.id_jabatan'=>$id));
		return $q->result_array();
	}
	function ambil_data_etik_instansi_no_null_all()
	{
		$this->db->select("concat(nama_pegawai,' - NIP : ',nip,' - ',nama_working) as nama_pegawai,ol_pegawai_instansi.id_pegawai,barcode_pegawai");
		$this->db->join('ol_pegawai','ol_pegawai.id_pegawai=ol_pegawai_instansi.id_pegawai','left');
		$this->db->join('kol_kode_kewenangan','kol_kode_kewenangan.id_kode_kewenangan=ol_pegawai.id_kode_kewenangan','left');
		$this->db->join('kol_working','kol_working.id_working=ol_pegawai_instansi.id_instansi','left');
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
		$this->db->order_by('nama_pegawai', 'asc');
		$q = $this->db->get_where('ol_pegawai_instansi',array('status_pegawai'=>1,'visible'=>1))->result_array();
		$hasil= array_column($q,'nama_pegawai','id_pegawai');
		return $hasil;
	}
	function ambil_data_etik_instansi_all()
	{
		$this->db->select("concat(nama_pegawai,' - NIP : ',nip,' - ',nama_working) as nama_pegawai,ol_pegawai_instansi.id_pegawai,barcode_pegawai");
		$this->db->join('ol_pegawai','ol_pegawai.id_pegawai=ol_pegawai_instansi.id_pegawai','left');
		$this->db->join('kol_kode_kewenangan','kol_kode_kewenangan.id_kode_kewenangan=ol_pegawai.id_kode_kewenangan','left');
		$this->db->join('kol_working','kol_working.id_working=ol_pegawai_instansi.id_instansi','left');
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
		$this->db->order_by('nama_pegawai', 'asc');
		$q = $this->db->get_where('ol_pegawai_instansi',array('status_pegawai'=>1,'visible'=>1))->result_array();
		$hasil= array_column($q,'nama_pegawai','id_pegawai');
		return $hasil;
	}
	function ambil_data_nkr_form($id,$idi)
	{
		$this->db->select("concat(nama_jenis_form,' - <b>[Kompetensi : ',nama_kompetensi,']</b> - Instansi : ',nama_working) as nama_form,nf.id_jenis_form");
		$this->db->join('kol_jenis_form kjf','kjf.id_jenis_form=nf.id_jenis_form','left');
		$this->db->join('nkr_kompetensi nkp','nkp.id_kompetensi=nf.id_kompetensi','left');
		$this->db->join('kol_working kw','kw.id_working=nf.id_instansi','left');
		$this->db->order_by('nf.id_jenis_form', 'asc');
		$q = $this->db->get_where('nkr_form nf',array('nf.id_kompetensi'=>$id,'nf.id_instansi'=>$idi));
		return $q->result_array();
	}
	function ambil_data_daftar_no_null()
	{
		$this->db->select("concat(nama_pegawai,' - Profesi : ',nama_jabatan) as nama_pegawai,ol_pegawai_instansi.id_pegawai,barcode_pegawai");
		$this->db->join('ol_pegawai','ol_pegawai.id_pegawai=ol_pegawai_instansi.id_pegawai','left');
		$this->db->join('kol_kode_kewenangan','kol_kode_kewenangan.id_kode_kewenangan=ol_pegawai.id_kode_kewenangan','left');
		$this->db->join('kol_working','kol_working.id_working=ol_pegawai_instansi.id_instansi','left');
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
		$this->db->join('jabatan', 'jabatan.id_jabatan=jabatan_fungsional.id_jabatan','left');
		$this->db->order_by('nama_pegawai', 'asc');
		$q = $this->db->get_where('ol_pegawai_instansi',array('status_pegawai'=>1,'visible'=>1));
		return $q->result_array();
	}
	function ambil_data_etik_instansi($id)
	{
		$idx = explode(',', $id);
		$this->db->select("concat(nama_pegawai,' - NIP : ',nip,' - ',nama_working) as nama_pegawai,ol_pegawai_instansi.id_pegawai,barcode_pegawai");
		$this->db->join('ol_pegawai','ol_pegawai.id_pegawai=ol_pegawai_instansi.id_pegawai','left');
		$this->db->join('kol_kode_kewenangan','kol_kode_kewenangan.id_kode_kewenangan=ol_pegawai.id_kode_kewenangan','left');
		$this->db->join('kol_working','kol_working.id_working=ol_pegawai_instansi.id_instansi','left');
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
		$this->db->where_in("ol_pegawai_instansi.id_instansi",$idx);
		$this->db->order_by('nama_pegawai', 'asc');
		$q = $this->db->get_where('ol_pegawai_instansi',array('status_pegawai'=>1,'visible'=>1));
		return $q->result_array();
	}
	function ambil_data_etik_instansi_no_null($id)
	{
		$idx = explode(',', $id);
		$this->db->select("concat(nama_pegawai,' - NIP : ',nip,' - ',nama_working) as nama_pegawai,ol_pegawai_instansi.id_pegawai,barcode_pegawai");
		$this->db->join('ol_pegawai','ol_pegawai.id_pegawai=ol_pegawai_instansi.id_pegawai','left');
		$this->db->join('kol_kode_kewenangan','kol_kode_kewenangan.id_kode_kewenangan=ol_pegawai.id_kode_kewenangan','left');
		$this->db->join('kol_working','kol_working.id_working=ol_pegawai_instansi.id_instansi','left');
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
		$this->db->where_in("ol_pegawai_instansi.id_instansi",$idx);
		$this->db->order_by('nama_pegawai', 'asc');
		$q = $this->db->get_where('ol_pegawai_instansi',array('status_pegawai'=>1,'visible'=>1))->result_array();
		$hasil= array_column($q,'nama_pegawai','id_pegawai');
		return $hasil;
	}
	function ambil_data_dropdown_pegawai_instansi_no_nulls($id)
	{
		$idx = explode(',', $id);
		$this->db->select("concat(nama_pegawai,' - NIP : ',nip,' - ',nama_working) as nama_pegawai,pi.id_pegawai");
		$this->db->join('kol_working kw', 'kw.id_working=pi.id_instansi','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=pi.id_pegawai','left');
		if(!$this->session->has_userdata('id_level')){
		$this->db->where_in('pi.id_instansi',$idx); }
		$q = $this->db->get_where('ol_pegawai_instansi pi',array('status_pegawai'=>'1','visible'=>'1'))->result_array();		
		$hasil= array_column($q,'nama_pegawai','id_pegawai');
		return $hasil;
	}
	function ambil_data_dropdown_pegawai_no_nulls($id)
	{
		$this->db->select("concat(nama_pegawai,' - ',nama_pengcab) as nama_pegawai,id_pegawai");
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pegawai.id_pengcab','left');
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
		$q = $this->db->get_where('ol_pegawai',array('ol_pengcab.id_jabatan'=>$id,'status_pegawai'=>'1','visible'=>'1'))->result_array();
		$hasil= array_column($q,'nama_pegawai','id_pegawai');
		return $hasil;
	}
	function ambil_data_dropdown_pegawai($id)
	{
		$this->db->select("concat(nama_pegawai,' - ',nama_pengcab) as nama_pegawai,id_pegawai");
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pegawai.id_pengcab','left');
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
		$q = $this->db->get_where('ol_pegawai',array('ol_pengcab.id_jabatan'=>$id,'status_pegawai'=>'1','visible'=>'1'));
		return $q->result_array();
	}
	function ambil_data_pegawai()
	{
		$this->db->select("concat('Nama User : ',nama_pegawai,'<strong>, NIK : ',nik,'</strong>, Profesi : ',nama_jabatan_fungsional,' <strong>, Email : ',email,' </strong>, No HP : ',no_hp,' <strong>, Unit/Ruangan : ',nama_unit,'</strong>, Nama Instansi : ',nama_working) as nama_pegawai,barcode_pegawai");
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_pegawai_unit.id_pegawai','left');
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
		$this->db->join('ol_unit', 'ol_unit.id_unit=ol_pegawai_unit.id_unit','left');
		$this->db->join('kol_working', 'kol_working.id_working=ol_unit.id_instansi','left');
		$q = $this->db->get_where('ol_pegawai_unit',array('status_pegawai'=>'1','visible'=>'1'));
		return $q->result_array();
	}
	function ambil_data_pegawai_unit($id)
	{
		$this->db->select("ol_pegawai.nama_pegawai,ol_pegawai_unit.id_pegawai,no_hp");
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_pegawai_unit.id_pegawai','left');
		$q = $this->db->get_where('ol_pegawai_unit',array('status_pegawai'=>1,'visible'=>1,'ol_pegawai_unit.id_unit'=>$id));
		return $q->result_array();
	}
	function ambil_data_dropdown_pegawai_clicked($idj,$id)
	{
		$this->db->select("concat(nama_pegawai,' - ',nama_pengcab) as nama_pegawai,id_pegawai");
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pegawai.id_pengcab','left');
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
		$q = $this->db->get_where('ol_pegawai',array('ol_pengcab.id_jabatan'=>$idj,'ol_pegawai.id_pengcab'=>$id,'status_pegawai'=>'1','visible'=>'1'));
		return $q->result_array();
	}
	function ambil_data_dropdown_pegawai_comma($idj,$eimplo)
	{
		$id = explode(',', $eimplo);
		$this->db->select("concat(nama_pegawai,' - ',nama_pengcab) as nama_pegawai,ol_pegawai.id_pegawai");
		$this->db->join('ol_pengurus', 'ol_pengurus.id_pengurus=ol_pegawai_pengurus.id_pengurus','left');
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_pegawai_pengurus.id_pegawai','left');
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
		$this->db->join('kol_ms_pengurus', 'kol_ms_pengurus.id_ms_pengurus=ol_pengurus.id_ms_pengurus','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pengurus.id_pengcab','left');
		$this->db->where_in("ol_pengurus.id_pengcab",$id);
		$this->db->group_by('ol_pegawai_pengurus.id_pegawai'); 
		$q = $this->db->get_where('ol_pegawai_pengurus',array('jabatan_fungsional.id_jabatan'=>$idj,'status_pegawai'=>'1','visible'=>'1'));
		return $q->result_array();
	}
	function ambil_data_dropdown_pegawai_comma_no_null($idj,$eimplo)
	{
		$id = explode(',', $eimplo);
		$this->db->select("concat(nama_pegawai,' - ',nama_pengcab) as nama_pegawai,ol_pegawai.id_pegawai");
		$this->db->join('ol_pengurus', 'ol_pengurus.id_pengurus=ol_pegawai_pengurus.id_pengurus','left');
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_pegawai_pengurus.id_pegawai','left');
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
		$this->db->join('kol_ms_pengurus', 'kol_ms_pengurus.id_ms_pengurus=ol_pengurus.id_ms_pengurus','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pengurus.id_pengcab','left');
		$this->db->where_in("ol_pengurus.id_pengcab",$id);
	//	$this->db->group_by('ol_pegawai_pengurus.id_pegawai'); 
		$q = $this->db->get_where('ol_pegawai_pengurus',array('jabatan_fungsional.id_jabatan'=>$idj,'status_pegawai'=>'1','visible'=>'1'))->result_array();
		$hasil= array_column($q,'nama_pegawai','id_pegawai');
		return $hasil;
	}
	function ambil_kompetensi(){
		$q = $this->db->get_where('ol_kompetensi',array('id_jabatan'=>$this->session->id_jabatan));
		return $q->result_array();
	}
	function ambil_kategori_tambah($id){
		$this->db->select("*,opa.nama_pengcab as asale,opb.nama_pengcab as tujuane");
		$this->db->join('ol_pengcab opb', 'opb.id_pengcab=okk.pengcab_tujuan','left');
		$this->db->join('ol_pengcab opa', 'opa.id_pengcab=okk.pengcab_asal','left');
		$this->db->join('ol_surat_kategori osk', 'osk.id_kategori=okk.id_kategori','left');
		$q = $this->db->get_where('ol_kor_kategori okk',array('id_korespodensi'=>$id));
		return $q->result_array();
	}
	function ambil_kor_detil($id,$idp){
		$this->db->select("*,concat(nama_ms_pengurus,'  : ',nama_pegawai) as nama_pegawai_pengurus,ol_pegawai_pengurus.id_pegawai");
		$this->db->join('ol_pegawai_pengurus', 'ol_pegawai_pengurus.id_pegawai_pengurus=ol_kor_detil.id_pegawai_pengurus','left');
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_pegawai_pengurus.id_pegawai','left');
		$this->db->join('ol_pengurus', 'ol_pengurus.id_pengurus=ol_pegawai_pengurus.id_pengurus','left');
		$this->db->join('kol_ms_pengurus', 'kol_ms_pengurus.id_ms_pengurus=ol_pengurus.id_ms_pengurus','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pengurus.id_pengcab','left');
	//	$this->db->group_by('ol_pengurus.id_pengcab');
		$q = $this->db->get_where('ol_kor_detil',array('ol_kor_detil.id_korespodensi'=>$id,'ol_pengurus.id_pengcab'=>$idp));
		return $q->result_array();
	}
	function ambil_data_pengurus_pengcab($id,$eimplo)
	{
		$idx = explode(',', $eimplo);
		$this->db->select("*,concat(nama_ms_pengurus,' ', nama_pengcab,' : ',nama_pegawai) as nama_pegawai_pengurus,id_pegawai_pengurus");
		$this->db->join('ol_pegawai_pengurus', 'ol_pegawai_pengurus.id_pengurus=ol_pengurus.id_pengurus','left');
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_pegawai_pengurus.id_pegawai','left');
		$this->db->join('kol_ms_pengurus', 'kol_ms_pengurus.id_ms_pengurus=ol_pengurus.id_ms_pengurus','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pengurus.id_pengcab','left');
		$this->db->where_in("kol_ms_pengurus.id_ms_pengurus",$idx);
		$q = $this->db->get_where('ol_pengurus',array('ol_pengurus.id_pengcab'=>$id,'status_pegawai'=>'1','status_pengcab'=>'1','status_pegawai_pengurus'=>'1'));
		return $q->result_array();
	}
	function ambil_data_kor_ttd($id,$eimplo)
	{
		$idx = explode(',', $eimplo);
		$this->db->select("*,concat(nama_ms_pengurus,' : ',nama_pegawai) as nama_pegawai_pengurus,ol_kor_ttd.id_pegawai_pengurus,ol_kor_ttd.id_kor_detil");
		$this->db->join('ol_pegawai_pengurus', 'ol_pegawai_pengurus.id_pegawai_pengurus=ol_kor_ttd.id_pegawai_pengurus','left');
		$this->db->join('ol_pengurus', 'ol_pengurus.id_pengurus=ol_pegawai_pengurus.id_pengurus','left');
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_pegawai_pengurus.id_pegawai','left');
		$this->db->join('kol_ms_pengurus', 'kol_ms_pengurus.id_ms_pengurus=ol_pengurus.id_ms_pengurus','left');
		$this->db->join('ol_kor_detil', 'ol_kor_detil.id_kor_detil=ol_kor_ttd.id_kor_detil','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_kor_detil.id_pengcab','left');
		$this->db->where("ol_kor_ttd.id_kor_detil",$id);
		$q = $this->db->get_where('ol_kor_ttd',array('status_pegawai'=>'1','status_pengcab'=>'1','status_pegawai_pengurus'=>'1'));
		return $q->result_array();
	}
	function ambil_data_pegawai_pengurus_pengcab_4_saving($id,$id2)
	{
		$this->db->select("ol_pegawai_pengurus.id_pegawai_pengurus");
		$this->db->join('ol_pengurus', 'ol_pengurus.id_pengurus=ol_pegawai_pengurus.id_pengurus','left');
		$q = $this->db->get_where('ol_pegawai_pengurus',array('ol_pengurus.id_pengcab'=>$id,'ol_pengurus.id_ms_pengurus'=>$id2));
		return $q->row_array();
	}
/*	function ambil_data_nambah_pegawai_pengurus($id)
	{
		$this->db->select('nama_pengcab,ol_pengurus.id_pengcab,barcode_pengcab');
		$this->db->join('ol_pengurus', 'ol_pengurus.id_pengurus=ol_pegawai_pengurus.id_pengurus','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pengurus.id_pengcab','left');
		$q = $this->db->get_where('ol_pegawai_pengurus',array('ol_pengurus.id_pengcab'=>$id,'status_pengcab'=>'1','status_pegawai_pengurus'=>'1'));
		return $q->result_array();
	}*/
	function ambil_barang($id)
	{
		if(isset($_POST['searchTerm']) && !empty($_POST['searchTerm'])){
			$search = $this->input->post('searchTerm');
			$this->db->group_start();
			$this->db->like('nama_barang', $search);
			$this->db->or_like('kode_barang', $search);
			$this->db->group_end();
		}
		if($id > 0){ $this->db->where('id_item_kategori', $id); }
		$this->db->order_by("nama_barang", "asc");
	//	$this->db->limit(5);
		$r = $this->db->get_where('apt_barang',array('status_barang'=>1))->result_array();
		return $r;
	}
	function ambil_satuan()
	{
		if(isset($_POST['searchTerm']) && !empty($_POST['searchTerm'])){
			$search = $this->input->post('searchTerm');
			$this->db->group_start();
			$this->db->like('nama_satuan', $search);
			$this->db->group_end();
		}
		$this->db->order_by("nama_satuan", "asc");
	//	$this->db->limit(5);
		$r = $this->db->get_where('kol_satuan',array('status_satuan'=>1))->result_array();
		return $r;
	}
	function ambil_pabrik()
	{
		if(isset($_POST['searchTerm']) && !empty($_POST['searchTerm'])){
			$search = $this->input->post('searchTerm');
			$this->db->group_start();
			$this->db->like('nama_pabrik', $search);
			$this->db->group_end();
		}
		$this->db->order_by("nama_pabrik", "asc");
	//	$this->db->limit(5);
		$r = $this->db->get_where('apt_pabrik',array('status_pabrik'=>1))->result_array();
		return $r;
	}
	function ambil_data_pengurus_pengcab_4_saving($id,$id2)
	{
		$q = $this->db->get_where('ol_pengurus',array('id_pengcab'=>$id,'id_ms_pengurus'=>$id2));
		return $q->row_array();
	}
	function multi_akses($hak)
	{
		$ids = explode(',', $hak);
	//	if($this->session->id_level !== '99'){
		$this->db->where_in('akses.id_akses',$ids);
	//	}
		$q = $this->db->get_where('akses',array('id_akses >'=>50));
		return $q->result_array();
	}
	function multi_akses_pelayanan($hak)
	{
	//	$ids = array(4,25);
		$ids = explode(',', $hak);
		$this->db->where_in('akses.id_akses',$ids);
		$q = $this->db->get_where('akses');
		return $q->result_array();
	}
	function ambil_berkas_expired_from_pengcab($id,$rangekah,$first_date,$last_date=FALSE){
		if($rangekah == 1){
		//	$first_date = date("Y-m-d", strtotime("-10 years"));
		//	$last_date = date("Y-m-d", strtotime("+3 month"));	
			$first_date = $first_date;
			$last_date = $last_date;
		}else{
			$tgl = $first_date;
		}
		$first_date = date("Y-m-d", strtotime("-10 years"));
		$last_date = date("Y-m-d", strtotime("+3 month"));
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_berkas.id_pegawai','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pegawai.id_pengcab','left');
		$this->db->join('kol_kategori_berkas', 'kol_kategori_berkas.id_kategori_berkas=ol_berkas.id_kategori_berkas','left');
		if($rangekah == 1){
			$this->db->where('tgl_b_berkas >=', $first_date);
			$this->db->where('tgl_b_berkas <=', $last_date);
		}else{
			$this->db->where('tgl_b_berkas <=', $tgl);
		}		
//		$this->db->where('tgl_b_berkas', strtotime($database_date) > strtotime('now'));
		$this->db->where("status_berkas", 1);
		$this->db->where("ol_pegawai.id_pengcab", $id);
		$this->db->where("(ol_berkas.id_kategori_berkas='1' OR ol_berkas.id_kategori_berkas='2' OR ol_berkas.id_kategori_berkas='3')", NULL, FALSE);
		$q = $this->db->get_where('ol_berkas');
		return $q->result_array();
	}
	function ambil_berkas_from_kab($id,$idk,$idp){
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_berkas.id_pegawai','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pegawai.id_pengcab','left');
		$this->db->join('kol_kategori_berkas', 'kol_kategori_berkas.id_kategori_berkas=ol_berkas.id_kategori_berkas','left');
		$this->db->where("status_berkas", 1);
		$this->db->where('ol_pengcab.id_jabatan',$this->session->id_jabatan);
		$this->db->where("ol_pegawai.id_kab", $id);
		$this->db->where("ol_berkas.id_pegawai", $idp);
		$this->db->where("ol_berkas.id_kategori_berkas", $idk);
		$q = $this->db->get_where('ol_berkas');
		return $q->result_array();
	}
	function ambil_struktur_lihat_pelatihan($id){
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=b.id_pegawai','left');
		$this->db->join('ol_berkas_kategori kb', 'kb.id_berkas_kategori=b.id_kategori_berkas','left');
		$this->db->join('ol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=b.id_kategori_pelatihan','left');
		$this->db->where("kunci", 1);
		$this->db->where("b.id_pegawai", $id);
		$q = $this->db->get_where('ol_berkas b');
		return $q->result_array();
	}
	function ambil_berkas_expired_ijin_pengcab($idr,$id,$idk){
		$this->db->select("COUNT(ol_pegawai.id_pegawai) as total_str");
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_berkas.id_pegawai','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pegawai.id_pengcab','left');
		$this->db->join('kol_kategori_berkas', 'kol_kategori_berkas.id_kategori_berkas=ol_berkas.id_kategori_berkas','left');
		$this->db->where('tgl_b_berkas <=', date('Y-m-d'));		
		$this->db->where("status_berkas", 1);
		$this->db->where('ol_pengcab.id_jabatan',$this->session->id_jabatan);
		$this->db->where($idr, $id);
		$this->db->where("ol_berkas.id_kategori_berkas", $idk);
		$this->db->group_by('ol_pegawai.id_pengcab');
		$q = $this->db->get_where('ol_berkas');
		return $q->result_array();
	}
	function ambil_berkas_expired_ijin_instansi($idr,$id,$idk){
		$this->db->select("COUNT(ol_pegawai.id_pegawai) as total_str");
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_berkas.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
		$this->db->join('ol_pegawai_instansi', 'ol_pegawai_instansi.id_pegawai=ol_pegawai.id_pegawai','left');
		$this->db->join('kol_kategori_berkas', 'kol_kategori_berkas.id_kategori_berkas=ol_berkas.id_kategori_berkas','left');
		$this->db->where('tgl_b_berkas <=', date('Y-m-d'));		
		$this->db->where("status_berkas", 1);
		$this->db->where('jf.id_jabatan',$this->session->id_jabatan);
		$this->db->where($idr, $id);
		$this->db->where("ol_berkas.id_kategori_berkas", $idk);
		$this->db->group_by('ol_pegawai.id_pengcab');
		$q = $this->db->get_where('ol_berkas');
		return $q->result_array();
	}
	function ambil_berkas_ijin_instansi($kondisi){
		$this->db->join('ol_pegawai','ol_pegawai.id_pegawai=ol_berkas.id_pegawai','left');
		$this->db->join('ol_pegawai_instansi opi','opi.id_pegawai=ol_pegawai.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf','jf.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
		$this->db->join('kol_kategori_berkas','kol_kategori_berkas.id_kategori_berkas=ol_berkas.id_kategori_berkas','left');
		$q = $this->db->get_where('ol_berkas',$kondisi);
		return $q->result_array();
	}
	function ambil_berkas_ijin_pengcab($kondisi){
		$this->db->join('ol_pegawai','ol_pegawai.id_pegawai=ol_berkas.id_pegawai','left');
		$this->db->join('ol_pengcab op','op.id_pengcab=ol_pegawai.id_pengcab','left');
		$this->db->join('kol_kategori_berkas','kol_kategori_berkas.id_kategori_berkas=ol_berkas.id_kategori_berkas','left');
		$q = $this->db->get_where('ol_berkas',$kondisi);
		return $q->result_array();
	}
	function cmd_kompetensi(){
		$this->db->select("id_kompetensi,concat(nama_kompetensi,' - [ ',nama_jabatan,' ]') as nama_kompetensi");
		$this->db->join('jabatan', 'jabatan.id_jabatan=kr_kompetensi.id_jabatan','left');
		$q = $this->db->get_where('kr_kompetensi')->result_array();
		$hasil= array_column($q,'nama_kompetensi','id_kompetensi');
		return $hasil;
	}
	function cmd_ruangan(){
		$this->db->select('nama_ruangan,id_ruangan');
		$q = $this->db->get_where('ol_ruangan',array('status_ruangan'=>'1'));
		return $q->result_array();
	}
	function cmd_ruangan_no_null(){
		$this->db->select('nama_ruangan,id_ruangan');
		$q = $this->db->get_where('ol_ruangan',array('status_ruangan'=>'1'))->result_array();
		$hasil= array_column($q,'nama_ruangan','id_ruangan');
		return $hasil;
	}
	function cmd_kode_kewenangan_null(){
		$this->db->select("id_kode_kewenangan,concat('',nama_kode_kewenangan,' - Jenjang Karir : ',jenjang_karir,'') as nama_kode_kewenangan");
		return $q = $this->db->get_where('kol_kode_kewenangan')->result_array();
	}
	function cmd_sifat_kewenangan_null(){
		$this->db->select("id_sifat_kewenangan,nama_sifat_kewenangan");
		return $q = $this->db->get_where('kol_sifat_kewenangan')->result_array();
	}
	function cmd_sifat_kewenangan(){
		$this->db->select("id_sifat_kewenangan,nama_sifat_kewenangan");
		$q = $this->db->get_where('kol_sifat_kewenangan')->result_array();
		$hasil= array_column($q,'nama_sifat_kewenangan','id_sifat_kewenangan');
		return $hasil;
	}
	function cmd_kewenangan($id){
		$this->db->join('ol_kompetensi kkp', 'kkp.id_kompetensi=kk.id_kompetensi','left');
		$this->db->join('kol_kode_kewenangan kw', 'kw.id_kode_kewenangan=kk.id_kode_kewenangan','left');
		$this->db->join('kol_sifat_kewenangan sk', 'sk.id_sifat_kewenangan=kk.id_sifat_kewenangan','left');
		$this->db->join('jabatan j', 'j.id_jabatan=kkp.id_jabatan','left');
		if($id > 0){
			$this->db->where("kkp.id_jabatan", $id);
		}
		return $q = $this->db->get_where('ol_kewenangan kk')->result_array();
	}
	function cmd_kewenangan_idj_no_null($id){
		$this->db->select("id_kewenangan,nama_kewenangan");
		$this->db->join('ol_kompetensi kkp', 'kkp.id_kompetensi=kk.id_kompetensi','left');
		$this->db->join('kol_kode_kewenangan kw', 'kw.id_kode_kewenangan=kk.id_kode_kewenangan','left');
		$this->db->join('kol_sifat_kewenangan sk', 'sk.id_sifat_kewenangan=kk.id_sifat_kewenangan','left');
		$this->db->join('jabatan j', 'j.id_jabatan=kkp.id_jabatan','left');
		if($id > 0){
			$this->db->where("kkp.id_jabatan", $id);
		}
		$q = $this->db->get_where('ol_kewenangan kk')->result_array();
		$hasil= array_column($q,'nama_kewenangan','id_kewenangan');
		return $hasil;
	}
	function cmd_kewenangan_id_kewenangan($id){
		$this->db->join('ol_kompetensi kkp', 'kkp.id_kompetensi=kk.id_kompetensi','left');;
		$this->db->join('jabatan j', 'j.id_jabatan=kkp.id_jabatan','left');
		$this->db->where("kk.id_kewenangan", $id);
		return $q = $this->db->get_where('ol_kewenangan kk')->row_array();
	}
	function cmd_kewenangan_no_null(){
		$this->db->select("id_kewenangan,nama_kewenangan");
		$this->db->join('ol_kompetensi kkp', 'kkp.id_kompetensi=kk.id_kompetensi','left');
		$this->db->join('kol_kode_kewenangan kw', 'kw.id_kode_kewenangan=kk.id_kode_kewenangan','left');
		$this->db->join('kol_sifat_kewenangan sk', 'sk.id_sifat_kewenangan=kk.id_sifat_kewenangan','left');
		$this->db->join('jabatan j', 'j.id_jabatan=kkp.id_jabatan','left');
		$q = $this->db->get_where('ol_kewenangan kk')->result_array();
		$hasil= array_column($q,'nama_kewenangan','id_kewenangan');
		return $hasil;
	}
	function status_diusulkan()
	{
		$this->db->select("id_status_diusulkan,nama_status_diusulkan");
		$q= $this->db->get_where('ol_status_diusulkan',array('id_status_diusulkan <'=>'3'))->result_array();
		$hasil= array_column($q,'nama_status_diusulkan','id_status_diusulkan');
		return $hasil;
	}
	function status_diusulkan_all()
	{
		$this->db->select("id_status_diusulkan,nama_status_diusulkan");
		$q= $this->db->get_where('ol_status_diusulkan')->result_array();
		$hasil= array_column($q,'nama_status_diusulkan','id_status_diusulkan');
		return $hasil;
	}
	function item_kategori()
	{
		$this->db->select("id_item_kategori,nama_item_kategori");
		$q= $this->db->get_where('kol_item_kategori',array('status_item_kategori'=>1))->result_array();
		$hasil= array_column($q,'nama_item_kategori','id_item_kategori');
		return $hasil;
	}
	function jenis_barang()
	{
		$this->db->select("id_jenis_barang,nama_jenis_barang");
		$q= $this->db->get_where('kol_jenis_barang',array('status_jenis_barang'=>1))->result_array();
		$hasil= array_column($q,'nama_jenis_barang','id_jenis_barang');
		return $hasil;
	}
	function ambil_tabel_personil()
	{
		$this->db->select("id_tabel,nama_tabel");
		$q= $this->db->get_where('sn_tabel',array('status_tabel'=>1,'id_tabel <'=>10))->result_array();
		$hasil= array_column($q,'nama_tabel','id_tabel');
		return $hasil;
	}
function ambil_crew_logbook_laporan_tabel($id){
$this->db->join('ol_logbook_laporan oll', 'oll.id_laporan=ollt.id_laporan','left');
$this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=oll.barcode_pegawai','left');
$this->db->join('ol_unit ou', 'ou.id_unit=oll.id_unit','left');
$this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
$q = $this->db->get_where('ol_logbook_laporan_tabel ollt',array('ollt.id_laporan_tabel'=>$id));
return $q->row_array();
}
function ambil_surveyor_header_logbook_laporan_tabel($id){
$this->db->join('ol_logbook_laporan oll', 'oll.id_laporan=ollt.id_laporan','left');
$this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=oll.barcode_pegawai','left');
$this->db->join('ol_unit ou', 'ou.id_unit=oll.id_unit','left');
$this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
$q = $this->db->get_where('ol_logbook_laporan_tabel ollt',array('ollt.id_laporan_tabel'=>$id));
return $q->row_array();
}
function ambil_surveyor_logbook_laporan_tabel($id){
$this->db->join('ol_logbook_laporan oll', 'oll.id_laporan=ollt.id_laporan','left');
$this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=oll.barcode_pegawai','left');
$this->db->join('ol_unit ou', 'ou.id_unit=oll.id_unit','left');
$this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
$q = $this->db->get_where('ol_logbook_laporan_tabel ollt',array('ollt.id_laporan_tabel'=>$id));
return $q->row_array();
}
function ambil_tamu_laporan_tabel($tabel,$id){
$this->db->join('ol_logbook_laporan oll', 'oll.id_laporan=ollt.id_laporan','left');
$q = $this->db->get_where('ol_logbook_laporan_tabel ollt',array('ollt.'.$tabel=>$id));
return $q->row_array();
}
function ambil_per_imqc($kondisi)
{
$this->db->select("id_per_imqc,nama_per_imqc");
$q= $this->db->get_where('ol_per_imqc',$kondisi)->result_array();
//$q= $this->db->get_where('ol_per_imqc',array('status_per_imqc'=>1,'id_unit'=>$this->session->unit,'jenis_per_imqc'=>$id))->result_array();
$hasil= array_column($q,'nama_per_imqc','id_per_imqc');
return $hasil;
}
function ambil_per_imqc_null($kondisi)
{
$this->db->select("id_per_imqc,nama_per_imqc");
$q= $this->db->get_where('ol_per_imqc',$kondisi);
return $q->result_array();
}
function ambil_per_imqc_detil($kondisi)
{
$this->db->select("id_per_imqc_detil,concat(nama_per_imqc_detil,' - Indikator : ',nama_per_imqc) as nama_per_imqc_detil");
$this->db->join('ol_per_imqc', 'ol_per_imqc.id_per_imqc=ol_per_imqc_detil.id_per_imqc','left');
$q= $this->db->get_where('ol_per_imqc_detil',$kondisi)->result_array();
$hasil= array_column($q,'nama_per_imqc_detil','id_per_imqc_detil');
return $hasil;
}
function ambil_equipment_in($jns)
{
	$idx = explode(',', $this->session->mas_unit);
$this->db->select("id_equipment,nama_equipment");
$this->db->join('ol_unit','ol_unit.id_unit=ol_equipment.id_unit','left');
$this->db->where_in('ol_unit.coun_unit',$idx);
$q= $this->db->get_where('ol_equipment',array('status_equipment'=>1,'jenis_equipment'=>$jns))->result_array();
$hasil= array_column($q,'nama_equipment','id_equipment');
return $hasil;
}
function ambil_equipment()
{
$this->db->select("id_equipment,nama_equipment");
$q= $this->db->get_where('ol_equipment',array('status_equipment'=>1,'id_unit'=>$this->session->unit))->result_array();
$hasil= array_column($q,'nama_equipment','id_equipment');
return $hasil;
}
function ambil_equipment_mutu($kondisi)
{
$this->db->select("id_equipment,nama_equipment");
$q= $this->db->get_where('ol_equipment',$kondisi)->result_array();
//$q= $this->db->get_where('ol_equipment',array('status_equipment'=>1,'id_unit'=>$this->session->unit,'jenis_equipment'=>$id))->result_array();
$hasil= array_column($q,'nama_equipment','id_equipment');
return $hasil;
}
function ambil_equipment_imut($kondisi)
{
$this->db->select("id_eq_detil,concat(nama_eq_detil,' - Indikator : ',nama_equipment) as nama_eq_detil");
$this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_eq_detil.id_equipment','left');
$q= $this->db->get_where('ol_eq_detil',$kondisi)->result_array();
$hasil= array_column($q,'nama_eq_detil','id_eq_detil');
return $hasil;
}
	function distance($lat1, $lon1, $lat2, $lon2){
		$theta      = $lon1 - $lon2;
		$miles      = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
		$miles      = acos($miles);
		$miles      = rad2deg($miles);
		$miles      = $miles * 60 * 1.1515;
		$feet       = $miles * 5280;
		$yards      = $feet / 3;
		$kilometers = $miles * 1.609344;
		$meters     = $kilometers * 1000;
		return compact('meters');
	}
	function cmd_abs_kategori_absen()
	{
		$this->db->select("id_kategori_absen,nama_kategori_absen");
		$this->db->group_start();
		$this->db->where('id_instansi',0);	
		$this->db->or_where('id_instansi',$this->session->refer);	
		$this->db->group_end();
		$q= $this->db->get_where('abs_kategori_absen',array('status_kategori_absen'=>1))->result_array();
		$hasil= array_column($q,'nama_kategori_absen','id_kategori_absen');
		return $hasil;
	}
	function cmd_item_lhu()
	{
		$this->db->select("id_item_lhu,concat('Indikator Mutu : ',nama_item_lhu,' - [',nama_equipment,']') as nama_item_lhu");
		$this->db->join('ol_equipment oe', 'oe.id_equipment=olil.id_equipment','left');
		$q= $this->db->get_where('ol_logbook_item_lhu olil',array('status_item_lhu'=>1,'oe.id_unit'=>$this->session->unit))->result_array();
		$hasil= array_column($q,'nama_item_lhu','id_item_lhu');
		return $hasil;
	}
function ambil_logbook_laporan_tabel($tabel,$id,$grup=FALSE)
{
	$this->db->join('ol_logbook_laporan oll', 'oll.id_laporan=ollt.id_laporan','left');
	$this->db->join('sn_tabel stb', 'stb.id_tabel=ollt.tabel','left');
	if($grup){
		$this->db->group_by('ollt.'.$grup);
	}
	$q = $this->db->get_where('ol_logbook_laporan_tabel ollt',array('ollt.'.$tabel=>$id));
	return $q->result_array();
}
	function ambil_id_berkas_data($id){
		$this->db->join('kol_pendidikan kp', 'kp.id_pendidikan=ob.id_pendidikan','left');
		$this->db->join('ol_kategori_pelatihan okp', 'okp.id_kategori_pelatihan=ob.id_kategori_pelatihan','left');
		$this->db->join('ol_berkas_kategori okb', 'okb.id_berkas_kategori=ob.id_kategori_berkas','left');
		$q = $this->db->get_where('ol_berkas ob',array('ob.id_pegawai'=>$id,'status_berkas'=>1));
		return $q->result_array();
	}
	function ambil_abs_absen($id){
		$this->db->join('abs_seting as', 'as.id_seting=aa.id_seting','left');
		$this->db->join('abs_kategori_absen aka', 'aka.id_kategori_absen=aa.id_kategori_absen','left');
		$this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=aa.barcode_pegawai','left');
		$q = $this->db->get_where('abs_absen aa',array('aa.id_absen'=>$id));
		return $q->row_array();
	}
	function ambil_data_etik_pegawai_oppe($id_pegawai,$tahun)
	{
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=kep.id_penguji','left');
		$this->db->where("kep.id_pegawai", $id_pegawai);
	//	$this->db->where('year(tgl_etik_pegawai)', $tahun);
		$q = $this->db->get_where('ol_etik_pegawai kep')->result_array();
	//	print_r($q);die();
		return $q;
    }
	function ambil_data_nkr_pengajuan_validator_asesor($id)
	{
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=npv.id_asesor','left');
		$this->db->where("npv.barcode_pengajuan", $id);
		$q = $this->db->get_where('nkr_pengajuan_validator npv')->result_array();
	//	print_r($q);die();
		return $q;
    }
	function ambil_lobook_kompetensi_group_pengajuan($id){
	  $this->db->join('nkr_kewenangan kw', 'kw.id_kewenangan=ol.id_kewenangan','left');
	  $this->db->join('nkr_kompetensi kk', 'kk.id_kompetensi=kw.id_kompetensi','left');
	  $this->db->group_by('kw.id_kompetensi');
	  $q = $this->db->get_where('ol_logbook ol',array('id_pengajuan'=>$id));
	  return $q->result_array();
	}
	function ambil_lobook_kewenangan_group_pengajuan($id,$idk){
	  $this->db->select("COUNT(*) as num, nama_kewenangan");
	  $this->db->join('nkr_kewenangan kk', 'kk.id_kewenangan=ol.id_kewenangan','left');
	  $this->db->group_by('ol.id_kewenangan');
	  $q = $this->db->get_where('ol_logbook ol',array('id_pengajuan'=>$id,'id_kompetensi'=>$idk));
	  return $q->result_array();
	}
	function ambil_lobook_nkr_kompetensi_group_pengajuan(){
	  $this->db->join('nkr_kewenangan kw', 'kw.id_kewenangan=ol.id_kewenangan','left');
	  $this->db->join('nkr_kompetensi kk', 'kk.id_kompetensi=kw.id_kompetensi','left');
	  $this->db->group_by('kw.id_kompetensi');
	  $q = $this->db->get_where('ol_logbook ol',array('id_pengajuan'=>0,'lulus'=>0,'id_logbooker'=>$this->session->id_pegawai));
	  return $q->result_array();
	}
	function ambil_berkas_laporan(){
	  $this->db->join('ol_berkas_kategori kkb', 'kkb.id_berkas_kategori=ob.id_kategori_berkas','left');
	  $q = $this->db->get_where('ol_berkas ob',array('status_berkas'=>1,'id_kategori_berkas'=>12,'id_pegawai'=>$this->session->id_pegawai));
	  return $q->result_array();
	}
	function ambil_berkas_ijasahku(){
	  $this->db->join('kol_pendidikan kp', 'kp.id_pendidikan=b.id_pendidikan','left');
	  $this->db->order_by('b.tgl_b_berkas','desc');
	  $q = $this->db->get_where('ol_berkas b',array('b.id_kategori_berkas'=>7,'link_berkas !='=>"",'status_berkas'=>1,'b.id_pegawai'=>$this->session->id_pegawai));
	  return $q->result_array();
	}
	function ambil_berkas_strku(){
		$this->db->join('ol_berkas_kategori kb', 'kb.id_berkas_kategori=b.id_kategori_berkas','left');
		$this->db->join('ol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=b.id_kategori_pelatihan','left');
		$this->db->order_by('b.tgl_b_berkas','desc');
	  $q = $this->db->get_where('ol_berkas b',array('kunci'=>0,'link_berkas !='=>"",'status_berkas'=>1,'b.id_pegawai'=>$this->session->id_pegawai));
	  return $q->result_array();
	}
	function ambil_berkas_sertifikatku(){
		$this->db->join('ol_berkas_kategori kb', 'kb.id_berkas_kategori=b.id_kategori_berkas','left');
		$this->db->join('ol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=b.id_kategori_pelatihan','left');
		$this->db->order_by('b.tgl_b_berkas','desc');
	  $q = $this->db->get_where('ol_berkas b',array('kunci'=>1,'link_berkas !='=>"",'status_berkas'=>1,'b.id_pegawai'=>$this->session->id_pegawai));
	  return $q->result_array();
	}
	function ambil_berkas_berkasku(){
		$this->db->join('ol_berkas_kategori kb', 'kb.id_berkas_kategori=b.id_kategori_berkas','left');
		$this->db->order_by('b.id_berkas','desc');
	  $q = $this->db->get_where('ol_berkas b',array('b.id_kategori_berkas >'=>13,'link_berkas !='=>"",'status_berkas'=>1,'b.id_pegawai'=>$this->session->id_pegawai));
	  return $q->result_array();
	}
	function ambil_berkas_etikku(){
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=oep.id_penguji','left');
		$this->db->order_by('oep.tgl_etik_pegawai','ASC');
	  $q = $this->db->get_where('ol_etik_pegawai oep',array('oep.id_pegawai'=>$this->session->id_pegawai));
	  return $q->result_array();
	}
	function ambil_berkas_rkk($select,$kondisi,$grup){
		$this->db->select($select);
		$this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_rkk.id_kewenangan','left');
		$this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
		$this->db->join('kol_sifat_kewenangan', 'kol_sifat_kewenangan.id_sifat_kewenangan=ol_rkk.id_sifat_kewenangan','left');
		$this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=ol_rkk.validator_rkk','left');
		$this->db->where($kondisi);
		if($grup){
			$this->db->group_by($grup);
		}
		$q = $this->db->get_where('ol_rkk');
		return $q->result_array();
	}
	function ambil_berkas_logbook_rkk($select,$kondisi,$grup=FALSE){
		$this->db->select($select);
		$this->db->join('ol_rkk', 'ol_rkk.id_kewenangan=ol_logbook.id_kewenangan','left');
		$this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_rkk.id_kewenangan','left');
		$this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
		$this->db->join('kol_sifat_kewenangan', 'kol_sifat_kewenangan.id_sifat_kewenangan=ol_rkk.id_sifat_kewenangan','left');
		$this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=ol_rkk.validator_rkk','left');
		$this->db->where($kondisi);
		if($grup){
			$this->db->group_by($grup);
		}
		$q = $this->db->get_where('ol_logbook');
		return $q->result_array();
	}
	function ambil_berkas_logbookku($id,$ins){
		$this->db->join('nkr_kewenangan krw', 'krw.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nk', 'nk.id_kompetensi=krw.id_kompetensi','left');
		$this->db->join('kol_sifat_kewenangan ksk', 'ksk.id_sifat_kewenangan=ol.id_sifat_kewenangan','left');
		$this->db->where_in('krw.id_kompetensi',$id);
		$this->db->order_by('ol.tgl_logbook','desc');
	  $q = $this->db->get_where('ol_logbook ol',array('ol.id_instansi'=>$ins,'ol.id_pengajuan'=>0,'ol.id_logbooker'=>$this->session->id_pegawai));
	  return $q->result_array();
	}
	function ambil_berkas_logbook_pengajuan($id,$select,$kondisi,$grup=FALSE){
		$ids = explode(',', $id);
		$this->db->select($select);
		$this->db->join('nkr_kewenangan krw', 'krw.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nk', 'nk.id_kompetensi=krw.id_kompetensi','left');
		$this->db->join('kol_sifat_kewenangan ksk', 'ksk.id_sifat_kewenangan=ol.id_sifat_kewenangan','left');
		$this->db->where_in('krw.id_kompetensi',$ids);
		$this->db->order_by('ol.tgl_logbook','desc');
		if($grup){
			$this->db->group_by($grup);
		}
		$q = $this->db->get_where('ol_logbook ol',$kondisi);
		return $q->result_array();
	}
	function ambil_lobook_validasi_group_pengajuan($id){
	//  $this->db->select("COUNT(*) as num, nama_kewenangan,validasi,result_tolak,ol.id_kewenangan,nama_pegawai,nama_ms_struktur");
	  $this->db->join('ol_logbook ol', 'ol.barcode_logbook=olv.barcode_logbook','left');
	  $this->db->join('nkr_kewenangan kk', 'kk.id_kewenangan=ol.id_kewenangan','left');
	  $this->db->join('nkr_kompetensi nk', 'nk.id_kompetensi=kk.id_kompetensi','left');
	  $this->db->order_by('olv.id_logbook_validasi','asc');
	  $q = $this->db->get_where('ol_logbook_validasi olv',array('id_pengajuan'=>$id));
	  return $q->result_array();
	}
	function cmd_pasien($id)
	{   
		$this->db->select("rm as data, CONCAT('[',rm,'] [',YEAR(CURDATE()) - YEAR(tgl_lahir),'] ',nama_pasien) as value, 
			nama_pasien, DATE_FORMAT(tgl_lahir,'%d-%m-%Y') as tgl_lahir, rm, jk, alamat");
        $this->db->like("rm", $id);
        $this->db->or_like("nama_pasien", $id);
        $this->db->limit('50,0');
        return $this->db->get_where('ol_pasien')->result_array();
	}
	function ambil_pilih_ms_etik($id){
		if($id > 0){
			$this->db->where("ol_etik.id_jabatan", $id);
		}
		$this->db->join('jabatan', 'jabatan.id_jabatan=ol_etik.id_jabatan','left');
		$this->db->order_by('id_etik','desc');
		$q = $this->db->get_where('ol_etik',array('status_etik'=> 1));
		return $q->result_array();
	}
	function ambil_pengajuan_kompetensi($id){
		$this->db->select("*,if (jk = '1' ,'Laki-laki','Perempuan') as jk,
							CONCAT((TIMESTAMPDIFF( YEAR, tgl_lahir, now() )), ' Tahun ', 
							TIMESTAMPDIFF( MONTH, tgl_lahir, now() ) % 12, ' Bulan ',
							FLOOR( TIMESTAMPDIFF( DAY, tgl_lahir, now() ) % 30.4375 ), ' Hari') as umur
		");
	//	$this->db->join('ol_status_diusulkan', 'ol_status_diusulkan.id_status_diusulkan=ol_pengajuan.id_status_diusulkan','left');
		$this->db->join('ol_status_diusulkan', 'ol_status_diusulkan.id_status_diusulkan=ol_pengajuan.id_status_diusulkan','left');
		$this->db->join('ol_pegawai p', 'p.barcode_pegawai=ol_pengajuan.barcode_pegawai','left');
		$this->db->join('kol_agama ag', 'ag.id_agama=p.id_agama','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=p.id_status_kawin','left');
		$this->db->join('kol_pendidikan pend', 'pend.id_pendidikan=p.id_pendidikan','left');
		$this->db->join('ol_status_pegawai ksp', 'ksp.id_status_pegawai=p.tipe_pegawai','left');
		$this->db->join('kol_working u', 'u.id_working=ol_pengajuan.id_instansi','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=p.id_jabatan_fungsional','left');
		$q = $this->db->get_where('ol_pengajuan',array('barcode_pengajuan'=>$id));
		return $q->row_array();
	}
	function ambil_pengajuan_validasi($id){
		$this->db->select("*,if (jk = '1' ,'Laki-laki','Perempuan') as jk,
							CONCAT((TIMESTAMPDIFF( YEAR, tgl_lahir, now() )), ' Tahun ', 
							TIMESTAMPDIFF( MONTH, tgl_lahir, now() ) % 12, ' Bulan ',
							FLOOR( TIMESTAMPDIFF( DAY, tgl_lahir, now() ) % 30.4375 ), ' Hari') as umur
		");
		$this->db->join('ol_pengajuan', 'ol_pengajuan.id_pengajuan=ol_pengajuan_validasi.id_pengajuan','left');
		$this->db->join('ol_status_diusulkan', 'ol_status_diusulkan.id_status_diusulkan=ol_pengajuan.id_status_diusulkan','left');
		$this->db->join('ol_pegawai p', 'p.id_pegawai=ol_pengajuan.id_pegawai','left');
		$this->db->join('kol_agama ag', 'ag.id_agama=p.id_agama','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=p.id_status_kawin','left');
		$this->db->join('kol_pendidikan pend', 'pend.id_pendidikan=p.id_pendidikan','left');
		$this->db->join('ol_status_pegawai ksp', 'ksp.id_status_pegawai=p.tipe_pegawai','left');
		$this->db->join('kol_working u', 'u.id_working=ol_pengajuan.id_instansi','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=p.id_jabatan_fungsional','left');
		$q = $this->db->get_where('ol_pengajuan_validasi',array('barcode_pengajuan_validasi'=>$id));
		return $q->row_array();
	}
	function ambil_pengajuan_validasi_ms_struktur($id){
		$this->db->join('ol_pengajuan', 'ol_pengajuan.id_pengajuan=ol_pengajuan_validasi.id_pengajuan','left');
		$this->db->join('ol_pegawai p', 'p.id_pegawai=ol_pengajuan.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=p.id_jabatan_fungsional','left');
		$this->db->join('ol_status_diusulkan', 'ol_status_diusulkan.id_status_diusulkan=ol_pengajuan.id_status_diusulkan','left');
		$this->db->join('ol_pegawai_struktur ops', 'ops.id_pegawai_struktur=ol_pengajuan_validasi.id_pegawai_struktur','left');
		$this->db->join('ol_struktur os', 'os.id_struktur=ops.id_struktur','left');
		$this->db->join('kol_ms_struktur kms', 'kms.id_ms_struktur=os.id_ms_struktur','left');
		$this->db->join('kol_working u', 'u.id_working=ol_pengajuan.id_instansi','left');
		$q = $this->db->get_where('ol_pengajuan_validasi',array('barcode_pengajuan_validasi'=>$id));
		return $q->row_array();
	}
	function cmd_pegawai_null_with_unit_source_jabatan($id){
		$ids = explode(',', $id);
		$this->db->select("nama_pegawai,id_pegawai");
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
/*		if($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){
			//	$this->db->where_in('id_jabatan',$ids);
			}
		}*/
		$q = $this->db->get_where('ol_pegawai');
		return $q->result_array();
	}
	function ambil_pegawai($id){
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
		$q = $this->db->get_where('ol_pegawai peg',array('peg.id_pegawai'=>$id));
		return $q->row_array();
	}
	function ambil_kr_kewenangan_per_kompetensi($id,$jabatan){
		$this->db->select("kkw.id_kewenangan,concat(nama_kewenangan,' [ Kompetensi : ',nama_kompetensi,' - Jabatan : ',nama_jabatan,' ]') as nama_kewenangan");
		$this->db->join('ol_kompetensi kk', 'kk.id_kompetensi=kkw.id_kompetensi','left');
		$this->db->join('jabatan', 'jabatan.id_jabatan=kk.id_jabatan','left');
		if($id == 0){
		$this->db->where('kk.id_jabatan', $jabatan);
		}else{
		$this->db->where('kkw.id_kompetensi', $id);
		}
		$q = $this->db->get_where('ol_kewenangan kkw');
		return $q->result_array();
	}
	function kewenangan_lulus_pegawai($id){
		$q = $this->db->get_where('ol_kewenangan_lulus',array('id_pegawai'=>$id));
		return $q->result_array();
	}
	function ambil_data_catatan_oppe()
	{
		$this->db->select("kode_catatan,,REPLACE(kode_catatan,'_',' ') as kodes_catatan");
    	$this->db->group_by('kode_catatan'); 
		$query = $this->db->get('ol_catatan')->result_array();
		$q= array_column($query,'kodes_catatan','kode_catatan');
		return $q;
	}
	function opsi_logbook($ruangan,$jabatan_fungsional,$opsi,$idkw){
		if($opsi == 1){
			$this->db->join('ol_kewenangan_bk okbk', 'okbk.id_kewenangan=ok.id_kewenangan','left');
			$this->db->join('butir_kegiatan bk', 'bk.id_butir_kegiatan=okbk.id_butir_kegiatan','left');
			$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=bk.id_jabatan_fungsional','left');
			if($jabatan_fungsional > 0){
			$this->db->where('bk.id_jabatan_fungsional', $jabatan_fungsional); }
			$this->db->where('jf.id_jabatan', $this->session->id_jabatan);
			$q = $this->db->get_where('ol_kewenangan ok');
		}else{
			if($ruangan == 0){
				$this->db->join('ol_kompetensi okm', 'okm.id_kompetensi=ok.id_kompetensi','left');
				$this->db->join('jabatan', 'jabatan.id_jabatan=okm.id_jabatan','left');
				$this->db->join('kol_kode_kewenangan kkw', 'kkw.id_kode_kewenangan=ok.id_kode_kewenangan','left');
				$this->db->join('kol_sifat_kewenangan ksk', 'ksk.id_sifat_kewenangan=ok.id_sifat_kewenangan','left');
				$this->db->where('ok.id_kode_kewenangan', $idkw);
				$this->db->where('okm.id_jabatan', $this->session->id_jabatan);
				$q = $this->db->get_where('ol_kewenangan ok');			
			}else{
				$this->db->join('ol_kewenangan ok', 'ok.id_kewenangan=okd.id_kewenangan','left');
				$this->db->join('ol_kompetensi okm', 'okm.id_kompetensi=ok.id_kompetensi','left');
				$this->db->join('jabatan', 'jabatan.id_jabatan=okm.id_jabatan','left');
				$this->db->join('kol_kode_kewenangan kkw', 'kkw.id_kode_kewenangan=ok.id_kode_kewenangan','left');
				$this->db->join('kol_sifat_kewenangan ksk', 'ksk.id_sifat_kewenangan=ok.id_sifat_kewenangan','left');
				$this->db->where('ok.id_kode_kewenangan', $idkw);
				$this->db->where('okd.id_ruangan', $ruangan);
				$this->db->where('okm.id_jabatan', $this->session->id_jabatan);
				$q = $this->db->get_where('ol_kewenangan_detil okd');
			}	
		}				
		return $q->result_array();
	}
	function opsi_logbook_new(){
		$grade = $this->m_umum->ambil_data('ol_pegawai_grade','id_grade',$this->session->id_grade);
		if(empty($grade['urutan_grade'])){
			$plus = 1;
		}else{
			$plus = $grade['urutan_grade']+1;			
		}
		$kompetensie = $this->session->refer;
		$this->db->join('nkr_kompetensi okm', 'okm.id_kompetensi=ok.id_kompetensi','left');
		$this->db->join('ol_pegawai_grade', 'ol_pegawai_grade.id_grade=okm.id_grade','left');
		$this->db->join('jabatan', 'jabatan.id_jabatan=okm.id_jabatan','left');
		$this->db->where('okm.id_jabatan', $this->session->id_jabatan);
		$this->db->order_by("okm.kode_unit","asc");
		$q = $this->db->get_where('nkr_kewenangan ok');				
		return $q->result_array();
	}
	function kewenangan_all()
	{
		$this->db->join('nkr_kompetensi okm', 'okm.id_kompetensi=ok.id_kompetensi','left');
		$this->db->join('jabatan', 'jabatan.id_jabatan=okm.id_jabatan','left');
		$this->db->where('okm.id_jabatan', $this->session->id_jabatan);
	//	$this->db->where('okm.instansi_kompetensi', $this->session->refer);
		$q = $this->db->get_where('nkr_kewenangan ok');
		//print_r($q->row_array());
		return $q->result_array();
	}
	function rkk_print_all($id)
	{
		$this->db->join('nkr_kewenangan ok', 'ok.id_kewenangan=or.id_kewenangan','left');
		$this->db->join('nkr_kompetensi okm', 'okm.id_kompetensi=ok.id_kompetensi','left');
		$this->db->where('or.barcode_pengajuan', $id);
	//	$this->db->where('okm.instansi_kompetensi', $this->session->refer);
		$q = $this->db->get_where('ol_rkk or');
		//print_r($q->row_array());
		return $q->result_array();
	}
	function kewenangan_all_no_null()
	{
		$this->db->select("id_kewenangan,concat(nama_kewenangan,' [ ',nama_kompetensi,' ]') as nama_kewenangan");
		$this->db->join('nkr_kompetensi okm', 'okm.id_kompetensi=ok.id_kompetensi','left');
		$this->db->join('jabatan', 'jabatan.id_jabatan=okm.id_jabatan','left');
		$this->db->where('okm.id_jabatan', $this->session->id_jabatan);
		$q= $this->db->get_where('nkr_kewenangan ok')->result_array();
		$hasil= array_column($q,'nama_kewenangan','id_kewenangan');
		return $hasil;
	}
	function cmd_pegawai_null_analisa(){
	//	$this->db->select("concat(nama_pegawai,'  [',nama_ruangan,']') as nama_pegawai,id_pegawai");
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
	//	$this->db->group_by('pegawai.id_pegawai');
		$q = $this->db->get_where('ol_pegawai',array('visible'=>'1','jabatan_fungsional.id_jabatan'=>$this->session->id_jabatan));
		return $q->result_array();
	}
	function kewenangan_look($idj,$idr,$idkw){
		$this->db->join('ol_kompetensi okm', 'okm.id_kompetensi=ok.id_kompetensi','left');
		$this->db->join('ol_kewenangan_detil okd', 'okd.id_kewenangan=ok.id_kewenangan','left');
		$this->db->join('jabatan', 'jabatan.id_jabatan=okm.id_jabatan','left');
		$this->db->join('kol_kode_kewenangan kkw', 'kkw.id_kode_kewenangan=ok.id_kode_kewenangan','left');
		$this->db->join('kol_sifat_kewenangan ksk', 'ksk.id_sifat_kewenangan=ok.id_sifat_kewenangan','left');
		$this->db->join('ol_ruangan or', 'or.id_ruangan=okd.id_ruangan','left');
		$this->db->where("not exists (select null from ol_kewenangan_bk olv where olv.id_kewenangan = ok.id_kewenangan)",null,false);
		$this->db->where('okm.id_jabatan', $idj);
		if($idr > 0){
		$this->db->where('okd.id_ruangan', $idr); }
		if($idkw > 0){
		$this->db->where('ok.id_kode_kewenangan', $idkw); }
	//	$this->db->where('ok.bk', 0);
		$q = $this->db->get_where('ol_kewenangan ok');						
		return $q->result_array();
	}
	function cmd_jabfung_buket(){
		$this->db->select("id_jabatan_fungsional,nama_jabatan_fungsional");
		$q = $this->db->get_where('jabatan_fungsional');
		return $q->result_array();
	}
	function cmd_jabatan_fungsional_id()
	{
		$this->db->select("id_jabatan_fungsional,nama_jabatan_fungsional");
		$q= $this->db->get_where('jabatan_fungsional')->result_array();
		$hasil= array_column($q,'nama_jabatan_fungsional','id_jabatan_fungsional');
		return $hasil;
    }
    function jumlah_record_logbook_4_anjababk($id,$periode)   //dibawah
    {
	    $this->db->join('nkr_kewenangan nkw', 'nkw.id_kewenangan=ol.id_kewenangan','left');
	    $this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkw.id_kompetensi','left');
	    $this->db->where("nkp.id_jabatan",$this->session->id_jabatan);
	    $this->db->where("ol.id_instansi",$this->session->refer);
	//    $this->db->where("YEAR(tgl_logbook)",date('Y',strtotime($periode)));
	    $this->db->group_by("nkw.id_kompetensi");
        $query = $this->db->select("SUM(jml_logbook) as num")->get_where('ol_logbook ol');
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
    }
	function peminatan_fr_opminat($kondisi,$grup=FALSE){
		$this->db->join('ol_pegawai ope', 'ope.id_pegawai=opm.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=ope.id_jabatan_fungsional','left');
		$this->db->join('ol_peminatan op', 'op.id_peminatan=opm.id_peminatan','left');
		if($grup === FALSE)
		{ 
			$q = $this->db->get_where('ol_pegawai_minat opm',$kondisi);						
			return $q->result_array();
		}else{
			$this->db->group_by($grup); 
			$q = $this->db->get_where('ol_pegawai_minat opm',$kondisi);						
			return $q->result_array();	
		}
	}
	function peminatan_fr_opminat_instansi($kondisi,$grup=FALSE){
		$this->db->join('ol_pegawai ope', 'ope.id_pegawai=opm.id_pegawai','left');
		$this->db->join('ol_pegawai_instansi opi', 'opi.id_pegawai=ope.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=ope.id_jabatan_fungsional','left');
		$this->db->join('ol_peminatan op', 'op.id_peminatan=opm.id_peminatan','left');
		if($grup === FALSE)
		{ 
			$q = $this->db->get_where('ol_pegawai_minat opm',$kondisi);						
			return $q->result_array();
		}else{
			$this->db->group_by($grup); 
			$q = $this->db->get_where('ol_pegawai_minat opm',$kondisi);						
			return $q->result_array();	
		}
	}
	function instansi_fr_opinstansi($kondisi,$grup=FALSE){
		$this->db->join('ol_pegawai ope', 'ope.id_pegawai=opi.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=ope.id_jabatan_fungsional','left');
		$this->db->join('kol_working kw', 'kw.id_working=opi.id_instansi','left');
		$this->db->join('kol_kategori_work kkw', 'kkw.id_kategori_work=kw.id_cara_masuk','left');
		if($grup === FALSE)
		{ 
			$q = $this->db->get_where('ol_pegawai_instansi opi',$kondisi);						
			return $q->result_array();
		}else{
			$this->db->group_by($grup); 
			$q = $this->db->get_where('ol_pegawai_instansi opi',$kondisi);						
			return $q->result_array();	
		}
	}
	function pelatihan_fr_opinstansi($kondisi,$grup=FALSE){
		$array_check = array(4,5,6,8,9,27,28);
		$this->db->join('kol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=b.id_kategori_pelatihan','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=b.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
		$this->db->where_in('b.id_kategori_berkas', $array_check);
		if($grup === FALSE)
		{ 
			$q = $this->db->get_where('ol_berkas b',$kondisi);						
			return $q->result_array();
		}else{
			$this->db->group_by($grup); 
			$q = $this->db->get_where('ol_berkas b',$kondisi);						
			return $q->result_array();	
		}
	}
	function pelatihan_fr_opinstansi_instansi($kondisi,$grup=FALSE){
		$array_check = array(4,5,6,8,9,27,28);
		$this->db->join('kol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=b.id_kategori_pelatihan','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=b.id_pegawai','left');		
		$this->db->join('ol_pegawai_instansi opi', 'opi.id_pegawai=peg.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
		$this->db->where_in('b.id_kategori_berkas', $array_check);
		if($grup === FALSE)
		{ 
			$q = $this->db->get_where('ol_berkas b',$kondisi);						
			return $q->result_array();
		}else{
			$this->db->group_by($grup); 
			$q = $this->db->get_where('ol_berkas b',$kondisi);						
			return $q->result_array();	
		}
	}
	function prov_fr_peg($kondisi,$grup=FALSE){
		$this->db->join('kol_provinsi prov', 'prov.id_prov=peg.id_prov','left');
		$this->db->join('kol_kabupaten kab', 'kab.id_kab=peg.id_kab','left');
		$this->db->join('kol_kecamatan kec', 'kec.id_kec=peg.id_kec','left');
		$this->db->join('kol_kelurahan kel', 'kel.id_kel=peg.id_kel','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
		if($grup === FALSE)
		{ 
			$q = $this->db->get_where('ol_pegawai peg',$kondisi);						
			return $q->result_array();
		}else{
			$this->db->group_by($grup); 
			$q = $this->db->get_where('ol_pegawai peg',$kondisi);						
			return $q->result_array();	
		}
	}
	function attr_fr_pegawai($kondisi,$grup=FALSE){
		$this->db->join('ol_pengcab op', 'op.id_pengcab=ope.id_pengcab','left');
		$this->db->join('kol_pendidikan kpen', 'kpen.id_pendidikan=ope.id_pendidikan','left');
		$this->db->join('kol_agama kag', 'kag.id_agama=ope.id_agama','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=ope.id_status_kawin','left');
		$this->db->join('ol_status_pegawai osp', 'osp.id_status_pegawai=ope.tipe_pegawai','left');
		$this->db->join('kol_kode_kewenangan kkk', 'kkk.id_kode_kewenangan=ope.id_kode_kewenangan','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=ope.id_jabatan_fungsional','left');
		if($grup === FALSE)
		{ 
			$q = $this->db->get_where('ol_pegawai ope',$kondisi);						
			return $q->result_array();
		}else{
			$this->db->group_by($grup); 
			$q = $this->db->get_where('ol_pegawai ope',$kondisi);						
			return $q->result_array();	
		}
	}
	function attr_fr_pegawai_instansi($kondisi,$grup=FALSE){
		$this->db->join('ol_pegawai ope', 'ope.id_pegawai=opi.id_pegawai','left');
		$this->db->join('kol_working kw', 'kw.id_working=opi.id_instansi','left');
		$this->db->join('kol_pendidikan kpen', 'kpen.id_pendidikan=ope.id_pendidikan','left');
		$this->db->join('kol_agama kag', 'kag.id_agama=ope.id_agama','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=ope.id_status_kawin','left');
		$this->db->join('ol_status_pegawai osp', 'osp.id_status_pegawai=ope.tipe_pegawai','left');
		$this->db->join('kol_kode_kewenangan kkk', 'kkk.id_kode_kewenangan=ope.id_kode_kewenangan','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=ope.id_jabatan_fungsional','left');
		if($grup === FALSE)
		{ 
			$q = $this->db->get_where('ol_pegawai_instansi opi',$kondisi);						
			return $q->result_array();
		}else{
			$this->db->group_by($grup); 
			$q = $this->db->get_where('ol_pegawai_instansi opi',$kondisi);						
			return $q->result_array();	
		}
	}
	function asn_fr_pegawai($kondisi,$grup=FALSE){
		$this->db->join('ol_pengcab op', 'op.id_pengcab=ope.id_pengcab','left');
		$this->db->join('ol_status_pegawai osp', 'osp.id_status_pegawai=ope.tipe_pegawai','left');
		if($grup === FALSE)
		{ 
			$q = $this->db->get_where('ol_pegawai ope',$kondisi);						
			return $q->result_array();
		}else{
			$this->db->group_by($grup); 
			$q = $this->db->get_where('ol_pegawai ope',$kondisi);						
			return $q->result_array();	
		}
	}
	function asn_fr_pegawai_instansi($kondisi,$grup=FALSE){
	//	$this->db->select("nama_pegawai,nama_status_pegawai,ope");
		$this->db->join('ol_pegawai ope', 'ope.id_pegawai=opi.id_pegawai','left');
		$this->db->join('ol_pengcab op', 'op.id_pengcab=ope.id_pengcab','left');
		$this->db->join('ol_status_pegawai osp', 'osp.id_status_pegawai=ope.tipe_pegawai','left');
	//	$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=ope.id_jabatan_fungsional','left');
		if($grup === FALSE)
		{ 
			$q = $this->db->get_where('ol_pegawai_instansi opi',$kondisi);						
			return $q->result_array();
		}else{
			$this->db->group_by($grup); 
			$q = $this->db->get_where('ol_pegawai_instansi opi',$kondisi);						
			return $q->result_array();	
		}
	}
	function cmd_ambil_direktur($id){
		$ids = explode(',', $id);
		$this->db->select("id_direktur,nama_direktur");
		$this->db->where_in('id_instansi',$ids);
		$q = $this->db->get_where('ol_direktur',array('status_direktur'=>'1'))->result_array();
		$hasil= array_column($q,'nama_direktur','id_direktur');
		return $hasil;
	}
	function ambil_pengajuan_kompetensi_spk($id){
		$this->db->join('ol_status_diusulkan', 'ol_status_diusulkan.id_status_diusulkan=ol_pengajuan.id_status_diusulkan','left');
		$this->db->join('ol_pegawai p', 'p.id_pegawai=ol_pengajuan.id_pegawai','left');
		$this->db->join('kol_agama ag', 'ag.id_agama=p.id_agama','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=p.id_status_kawin','left');
		$this->db->join('kol_pendidikan pend', 'pend.id_pendidikan=p.id_pendidikan','left');
		$this->db->join('kol_status_pegawai ksp', 'ksp.id_status_pegawai=p.tipe_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=p.id_jabatan_fungsional','left');
		$this->db->join('kol_working kw', 'kw.id_working=ol_pengajuan.id_instansi','left');
		$q = $this->db->get_where('ol_pengajuan',array('barcode_pengajuan'=>$id));
		return $q->row_array();
	}
	function ambil_kw_terima($id,$idp){
		$this->db->join('ol_logbook', 'ol_logbook.barcode_logbook=ol_logbook_validasi.barcode_logbook','left');		
		$this->db->where('id_logbooker',$id);
		$this->db->where('id_pengajuan', $idp);
		$this->db->where('validasi', 1);
		$this->db->group_by('ol_logbook.id_kewenangan');
		$this->db->order_by('ol_logbook.id_kewenangan','asc');
		$q = $this->db->get_where('ol_logbook_validasi');
		return $q->result_array();		
	}
	function ambil_kw_tolak($id,$idp){
		$this->db->join('ol_logbook', 'ol_logbook.barcode_logbook=ol_logbook_validasi.barcode_logbook','left');		
		$this->db->where('id_logbooker',$id);
		$this->db->where('id_pengajuan', $idp);
		$this->db->where('validasi', 2);
		$this->db->group_by('ol_logbook.id_kewenangan');
		$this->db->order_by('ol_logbook.id_kewenangan','asc');
		$q = $this->db->get_where('ol_logbook_validasi');
		return $q->result_array();		
	}
	function ambil_kw_all($id){
		$this->db->join('ol_logbook', 'ol_logbook.barcode_logbook=ol_logbook_validasi.barcode_logbook','left');		
		$this->db->where('id_logbooker',$id);
		$this->db->where('validasi', 1);
		$this->db->group_by('ol_logbook.id_kewenangan');
		$this->db->order_by('ol_logbook.id_kewenangan','asc');
		$q = $this->db->get_where('ol_logbook_validasi');
		return $q->result_array();		
	}
	function ambil_kompetensi_spk($id){
		$this->db->join('ol_logbook', 'ol_logbook.barcode_logbook=ol_logbook_validasi.barcode_logbook','left');		
		$this->db->join('ol_kewenangan', 'ol_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');		
		$this->db->join('ol_kompetensi', 'ol_kompetensi.id_kompetensi=ol_kewenangan.id_kompetensi','left');		
		$this->db->where('id_logbooker',$id);
		$this->db->where('validasi', 1);
		$this->db->group_by('ol_kewenangan.id_kompetensi');
		$this->db->order_by('ol_kompetensi.nama_kompetensi','asc');
		$q = $this->db->get_where('ol_logbook_validasi');
		return $q->result_array();		
	}
	function ambil_kewenangan_tertolak($id){
		$this->db->join('ol_logbook', 'ol_logbook.barcode_logbook=ol_logbook_validasi.barcode_logbook','left');
		$this->db->where('id_logbooker',$id);
		$this->db->where('validasi', 2);
		$this->db->group_by('ol_logbook.id_kewenangan');
		$q = $this->db->get_where('ol_logbook_validasi');
		return $q->result_array();		
	}
	function ambil_kewenangan_spk($id,$idk){
		$this->db->join('ol_logbook', 'ol_logbook.barcode_logbook=ol_logbook_validasi.barcode_logbook','left');
		$this->db->join('ol_kewenangan', 'ol_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');		
		$this->db->where('id_logbooker',$id);
		$this->db->where('ol_kewenangan.id_kompetensi',$idk);
		$this->db->where('validasi', 1);
		$this->db->group_by('ol_logbook.id_kewenangan');
		$this->db->order_by('ol_kewenangan.nama_kewenangan','asc');
		$q = $this->db->get_where('ol_logbook_validasi');
		return $q->result_array();		
	}
	function ambil_data_px_rm($id){
		$this->db->select("*,CONCAT(alamat,', ',nama_kel,', ',nama_kec,', ',nama_kab,', ',nama_prov) as alamat,
			CONCAT((TIMESTAMPDIFF( YEAR, tgl_lahir, now() )), ' Tahun ',
			TIMESTAMPDIFF( MONTH, tgl_lahir, now() ) % 12, ' Bulan ',
			FLOOR( TIMESTAMPDIFF( DAY, tgl_lahir, now() ) % 30.4375 ), ' Hari') as umur
			");
		$this->db->join('pendaftaran p', 'p.barcode_pendaftaran=pu.barcode_pendaftaran','left');
		$this->db->join('pasien ps', 'ps.barcode_pasien=p.barcode_pasien','left');
		$this->db->join('kol_golongan_darah kgd', 'kgd.id_golongan_darah=ps.id_golongan_darah','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=ps.id_status_kawin','left');
		$this->db->join('kol_pekerjaan kpk', 'kpk.id_pekerjaan=ps.id_pekerjaan','left');
		$this->db->join('kol_pendidikan pendi', 'pendi.id_pendidikan=ps.id_pendidikan','left');
		$this->db->join('kol_provinsi kprov', 'kprov.id_prov=ps.id_prov','left');
		$this->db->join('kol_kabupaten kkab', 'kkab.id_kab=ps.id_kab','left');
		$this->db->join('kol_kecamatan kkec', 'kkec.id_kec=ps.id_kec','left');
		$this->db->join('kol_kelurahan kkel', 'kkel.id_kel=ps.id_kel','left');
		$this->db->join('kol_agama ag', 'ag.id_agama=ps.id_agama','left');
/*		$this->db->join('pemeriksaan_ku pku', 'pku.barcode_pendaftaran=p.barcode_pendaftaran','left');
		$this->db->join('pasien_ku_igd pki', 'pki.id_pendaftaran=p.id_pendaftaran','left');
		$this->db->join('kol_kontak kkon', 'kkon.id_kontak=pki.id_kontak','left');
		$this->db->join('kol_detil_cara_bayar kdcb', 'kdcb.id_detil_cara_bayar=p.id_detil_cara_bayar','left');
		$this->db->join('kol_rujukan_dokter dr','dr.id_dokter_rujukan=p.id_dokter_rujukan','left');
		$this->db->join('kol_rujukan_instansi ir','ir.id_rujukan_instansi=p.id_instansi_cara_masuk','left');
		$this->db->join('kol_cara_masuk cm',  'cm.id_cara_masuk=p.id_cara_masuk','left');
		$this->db->join('kol_cara_bayar cb',  'cb.id_cara_bayar=p.id_cara_bayar','left');*/
		$q = $this->db->get_where('pendaftaran_unit pu',array('pu.barcode_pendaftaran_unit'=>$id));
		return $q->row_array();
	}
	function ambil_data_vital($id){
		$this->db->select("*,
			DATE_FORMAT(tgl_pendaftaran_unit,'%d-%m-%Y %H:%i:%s') as tgl_pendaftaran_unit,op.nama_pegawai as perawate,
			if(p.id_cara_bayar = '6',concat('Karyawan : ',peg1.nama_pegawai),ka.nama_detil_cara_bayar) as nama_bayar,peg.nama_pegawai,
			if(p.id_cara_masuk = '7',u1.nama_unit,if(p.id_instansi_cara_masuk = '0','-',nama_rujukan_instansi)) as nama_instansi,
			if(p.id_cara_masuk = '7',rapen.nama_pegawai,if(p.id_dokter_rujukan = '0','-',nama_rujukan_dokter)) as nama_dokter			
			");
		$this->db->join('pendaftaran_unit pu', 'pu.barcode_pendaftaran_unit=pvs.barcode_pendaftaran_unit','left');
		$this->db->join('kol_triase kt', 'kt.id_triase=pvs.id_triase','left');
		$this->db->join('pendaftaran p', 'p.barcode_pendaftaran=pu.barcode_pendaftaran','left');
		$this->db->join('kol_cara_bayar cb','cb.id_cara_bayar=p.id_cara_bayar','left');
		$this->db->join('kol_detil_cara_bayar ka','ka.id_detil_cara_bayar=p.id_detil_cara_bayar','left');
		$this->db->join('kol_cara_masuk cm',  'cm.id_cara_masuk=p.id_cara_masuk','left');
		$this->db->join('kol_rujukan_dokter dr','dr.id_rujukan_dokter=p.id_dokter_rujukan','left');
		$this->db->join('kol_rujukan_instansi ir','ir.id_rujukan_instansi=p.id_instansi_cara_masuk','left');
		$this->db->join('ol_pegawai op','op.id_pegawai=pvs.pembuat_pemeriksaan_vital_sign','left');
		$this->db->join('ol_pegawai peg','peg.id_pegawai=pu.pembuat_pendaftaran_unit','left');
		$this->db->join('ol_pegawai peg1','peg1.id_pegawai=p.id_detil_cara_bayar','left');
		$this->db->join('ol_pegawai rapen','rapen.id_pegawai=p.id_dokter_rujukan','left');
		$this->db->join('ol_unit u1','u1.id_unit=p.id_instansi_cara_masuk','left');	
		$this->db->join('ol_unit ou', 'ou.id_unit=pu.unit_ke','left');
		$this->db->order_by('waktu_pemeriksaan_vital_sign','desc');
		$q = $this->db->get_where('pemeriksaan_vital_sign pvs',array('pu.barcode_pendaftaran'=>$id));
		return $q->result_array();
	}
	function ambil_data_vital_row($id){
		$this->db->join('pendaftaran_unit pu', 'pu.barcode_pendaftaran_unit=pvs.barcode_pendaftaran_unit','left');
		$this->db->join('kol_triase kt', 'kt.id_triase=pvs.id_triase','left');
		$this->db->order_by('waktu_pemeriksaan_vital_sign','desc');
		$q = $this->db->get_where('pemeriksaan_vital_sign pvs',array('pu.barcode_pendaftaran'=>$id));
		return $q->row_array();
	}
	function ambil_data_asuhan($id){
		$ps = $this->ambil_data_pasien($id);
		$this->db->select("*,
			if(p.id_cara_bayar = '6',concat('Karyawan : ',peg1.nama_pegawai),ka.nama_detil_cara_bayar) as nama_bayar,peg.nama_pegawai,
			if(p.id_cara_masuk = '7',u1.nama_unit,if(p.id_instansi_cara_masuk = '0','-',nama_rujukan_instansi)) as nama_instansi,
			if(p.id_cara_masuk = '7',rapen.nama_pegawai,if(p.id_dokter_rujukan = '0','-',nama_rujukan_dokter)) as nama_dokter,op.nama_pegawai as perawate
			");
		$this->db->join('pendaftaran_unit pu', 'pu.barcode_pendaftaran_unit=pa.barcode_pendaftaran_unit','left');
		$this->db->join('pendaftaran p', 'p.barcode_pendaftaran=pu.barcode_pendaftaran','left');
		$this->db->join('kol_gcs_eye kge', 'kge.id_gcs_eye=pa.eye_pemeriksaan_asuhan','left');
		$this->db->join('kol_gcs_motorik kgm', 'kgm.id_gcs_motorik=pa.motorik_pemeriksaan_asuhan','left');
		$this->db->join('kol_gcs_verb kgv', 'kgv.id_gcs_verb=pa.verbal_pemeriksaan_asuhan','left');
		$this->db->join('ol_pegawai op', 'op.id_pegawai=pa.pembuat_pemeriksaan_asuhan','left');
		$this->db->join('kol_cara_bayar cb','cb.id_cara_bayar=p.id_cara_bayar','left');
		$this->db->join('kol_detil_cara_bayar ka','ka.id_detil_cara_bayar=p.id_detil_cara_bayar','left');
		$this->db->join('kol_cara_masuk cm',  'cm.id_cara_masuk=p.id_cara_masuk','left');
		$this->db->join('kol_rujukan_dokter dr','dr.id_rujukan_dokter=p.id_dokter_rujukan','left');
		$this->db->join('kol_rujukan_instansi ir','ir.id_rujukan_instansi=p.id_instansi_cara_masuk','left');
		$this->db->join('ol_pegawai peg','peg.id_pegawai=pu.pembuat_pendaftaran_unit','left');
		$this->db->join('ol_pegawai peg1','peg1.id_pegawai=p.id_detil_cara_bayar','left');
		$this->db->join('ol_pegawai rapen','rapen.id_pegawai=p.id_dokter_rujukan','left');
		$this->db->join('ol_unit u1','u1.id_unit=p.id_instansi_cara_masuk','left');
		$this->db->order_by('waktu_pemeriksaan_asuhan','desc');
		$q = $this->db->get_where('pemeriksaan_asuhan pa',array('p.barcode_pasien'=>$ps['barcode_pasien']));
		return $q->result_array();
	}
	function ambil_data_redres_to_punit($id){
		$this->db->select("*,
			CONCAT((TIMESTAMPDIFF( YEAR, ps.tgl_lahir, now() )), ' Tahun ',
			TIMESTAMPDIFF( MONTH, ps.tgl_lahir, now() ) % 12, ' Bulan ',
			FLOOR( TIMESTAMPDIFF( DAY, ps.tgl_lahir, now() ) % 30.4375 ), ' Hari') as umur
		");
		$this->db->join('pemeriksaan pmr', 'pmr.barcode_pemeriksaan=rr.barcode_pemeriksaan','left');
		$this->db->join('pendaftaran_unit pu', 'pu.barcode_pendaftaran_unit=pmr.barcode_pendaftaran_unit','left');
		$this->db->join('pendaftaran pd', 'pd.barcode_pendaftaran=pu.barcode_pendaftaran','left');
		$this->db->join('kol_working kw', 'kw.id_working=pd.pendaftaran_instansi','left');
		$this->db->join('pasien ps', 'ps.barcode_pasien=pd.barcode_pasien','left');
		$this->db->join('billing bil', 'bil.barcode_pemeriksaan=pmr.barcode_pemeriksaan','left');
		$this->db->join('tindakan_tarif tt', 'tt.barcode_tindakan_tarif=bil.barcode_tindakan_tarif','left');
		$this->db->join('tindakan t', 't.id_tindakan=tt.id_tindakan','left');
		$this->db->join('ol_pegawai op', 'op.id_pegawai=rr.id_radiolog','left');
		$q = $this->db->get_where('radiologi_result rr',array('rr.barcode_radiologi_result'=>$id));
		return $q->row_array();
	}
	function ambil_data_pu_from_billing($id){
		$this->db->join('pemeriksaan pmr', 'pmr.barcode_pemeriksaan=b.barcode_pemeriksaan','left');
		$this->db->join('pendaftaran_unit pu', 'pu.barcode_pendaftaran_unit=pmr.barcode_pendaftaran_unit','left');
		$this->db->join('pendaftaran pd', 'pd.barcode_pendaftaran=pu.barcode_pendaftaran','left');
		$q = $this->db->get_where('billing b',array('b.barcode_billing'=>$id));
		return $q->row_array();
	}
	function ambil_print_pu_from_billing($id){
		$this->db->select("*,
			CONCAT((TIMESTAMPDIFF( YEAR, ps.tgl_lahir, DATE(wkt_daftar) )), ' Tahun ',
			TIMESTAMPDIFF( MONTH, ps.tgl_lahir, DATE(wkt_daftar) ) % 12, ' Bulan ',
			FLOOR( TIMESTAMPDIFF( DAY, ps.tgl_lahir, DATE(wkt_daftar) ) % 30.4375 ), ' Hari') as umur,
			if(pd.id_cara_bayar = '6',peg1.nama_pegawai,ka.nama_detil_cara_bayar) as nama_detil_cara_bayar
			");
		$this->db->join('pasien ps', 'ps.barcode_pasien=pd.barcode_pasien','left');
		$this->db->join('pendaftaran_unit pu', 'pu.barcode_pendaftaran=pd.barcode_pendaftaran','left');
		$this->db->join('kol_cara_bayar cb','cb.id_cara_bayar=pd.id_cara_bayar','left');
		$this->db->join('kol_detil_cara_bayar ka','ka.id_detil_cara_bayar=pd.id_detil_cara_bayar','left');
		$this->db->join('kol_working kw', 'kw.id_working=pd.pendaftaran_instansi','left');
		$this->db->join('ol_pegawai peg1','peg1.id_pegawai=pd.id_detil_cara_bayar','left');
		$q = $this->db->get_where('pendaftaran pd',array('pd.barcode_pendaftaran'=>$id));
		return $q->row_array();
	}
	function ambil_print_unit($id){
		$this->db->join('pendaftaran_unit pu','pu.barcode_pendaftaran=pd.barcode_pendaftaran','left');
		$this->db->join('ol_unit ou','ou.id_unit=pu.unit_ke','left');
		$q = $this->db->get_where('pendaftaran pd',array('pd.barcode_pendaftaran'=>$id));
		return $q->result_array();
	}
	function ambil_print_tindakan($id,$unit){
		$this->db->join('pemeriksaan pmr', 'pmr.barcode_pemeriksaan=b.barcode_pemeriksaan','left');
		$this->db->join('tindakan_tarif tt', 'tt.barcode_tindakan_tarif=b.barcode_tindakan_tarif','left');
		$this->db->join('tindakan t', 't.id_tindakan=tt.id_tindakan','left');
		$this->db->join('pendaftaran_unit pu', 'pu.barcode_pendaftaran_unit=pmr.barcode_pendaftaran_unit','left');
		$this->db->join('pendaftaran pd', 'pd.barcode_pendaftaran=pu.barcode_pendaftaran','left');
		$q = $this->db->get_where('billing b',array('pd.barcode_pendaftaran'=>$id,'pu.unit_ke'=>$unit));
		return $q->result_array();
	}
	function jumlah_record_tabel_bil_pmr($kondisi)	//sa.php
	{
		$this->db->select('COUNT(*) as num');
		$this->db->join('pemeriksaan pmr', 'pmr.barcode_pemeriksaan=b.barcode_pemeriksaan','left');
		$this->db->join('tindakan_tarif tt', 'tt.barcode_tindakan_tarif=b.barcode_tindakan_tarif','left');
		$this->db->join('tindakan t', 't.id_tindakan=tt.id_tindakan','left');
		$this->db->where($kondisi);
		$query = $this->db->get_where('billing b');
	    $result = $query->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
	}
	function ambil_laboratorium_result($id){
		$this->db->join('tindakan t', 't.id_tindakan=lr.id_tindakan','left');
		$q = $this->db->get_where('laboratorium_result lr',array('lr.barcode_pemeriksaan'=>$id));
		return $q->result_array();
	}
	function simpan_radiologi_dosis($id,$idt,$umur){
	$sources = $this->ambil_radiologi_fe($idt,$umur);
		foreach($sources as $rowsources){
			$kv = $rowsources['kv'];
			$mas = $rowsources['mas'];
			$fpd = $rowsources['fpd'];
			$id_field_size = $rowsources['id_field_size'];
			$id_proyeksi = $rowsources['id_proyeksi'];
			$grid = $rowsources['grid'];
			$thickness = $rowsources['thickness'];
			$this->simpan_raddosis($kv,$mas,$fpd,$id_field_size,$id_proyeksi,$grid,$thickness,$id);
		}
	}
 	function ambil_radiologi_fe($id,$umur){
 		$this->db->join('radiologi_proyeksi', 'radiologi_proyeksi.id_proyeksi=radiologi_fe.id_proyeksi','left');
		$q = $this->db->get_where('radiologi_fe',array('id_tindakan'=>$id,'age'=>$umur));
		return $q->result_array();
	}
	function simpan_raddosis($kv,$mas,$fpd,$id_field_size,$id_proyeksi,$grid,$thickness,$id){
			$kode = $this->m_rancak->kode_generator(15,'RD');
			$data_pendaftaran = array(
				'kv' => $kv,
				'mas' => $mas,
				'fpd' => $fpd,
				'id_field_size' => $id_field_size,
				'id_proyeksi' => $id_proyeksi,
				'grid' => $grid,
				'thickness' => $thickness,
				'barcode_radiologi_dosis' => $kode,
				'barcode_pemeriksaan' => $id
			);
			return $this->db->insert('radiologi_dosis', $data_pendaftaran);
	}
	function simpan_tambah_pemeriksaan_billing($id_kelas){
		$barcode_pendaftaran_unit = $this->input->post('daftar');
		$tgl_pemeriksaan = $this->input->post('tgl');
		$tgl_pemeriksaan = date('Y-m-d', strtotime($tgl_pemeriksaan));
		$kode = $this->m_rancak->kode_generator(15,'PM');
		$bpunit = $this->m_umum->ambil_data('pendaftaran_unit','barcode_pendaftaran_unit',$barcode_pendaftaran_unit);
		if($bpunit['id_status_pasien'] < 2){
			$this->update_pendaftaran_unit(2,$barcode_pendaftaran_unit);
		}
		$data_pendaftaran = array(
			'barcode_pemeriksaan' => $kode,
			'barcode_pendaftaran_unit' => $barcode_pendaftaran_unit,
			'tgl_pemeriksaan' => $tgl_pemeriksaan,
			'no_pemeriksaan' => $this->input->post('no'),
			'ket_pemeriksaan' => $this->input->post('ket'),
			'id_pegawai' => $this->session->id_pegawai,
			'id_status_pemeriksaan' => 0
		);
		$this->db->insert('pemeriksaan', $data_pendaftaran);
		return $kode;
	}
	function simpan_log($log){
		$kode = $this->m_rancak->kode_generator(15,'');
		$data_pendaftaran = array(
			'barcode_pendaftaran_log' => $kode,
			'id_pegawai' => $this->session->id_pegawai,
			'log' => $log
		);
		// print_r($data_pendaftaran);die();
		$this->db->insert('pendaftaran_log', $data_pendaftaran);
		return $kode;
	}
	function tambah_pendaftaran_unit(){
		$id_pegawai = $this->session->id_pegawai;
		$kode = $this->m_rancak->kode_generator(15,'PU');
		$id_unit = $this->input->post('id_unit_lobby');
		$data_pendaftaran = array(
			'barcode_pendaftaran' => $this->input->post('barcode_pendaftaran'),
			'barcode_pendaftaran_unit' => $kode,
			'tgl_pendaftaran_unit' => date('Y-m-d'),
			'ket_pendaftaran_unit' => $this->input->post('ket_lobby'),
			'dr_petugas' => $this->input->post('id_dokter'),
			'id_unit' => $this->input->post('id_unit_lobby'),
			'daftar_ke' => 1,
			'id_kelas' => 1,
			'dr_pengirim' => $this->input->post('id_dokter'),
			'unit_ke' => $this->input->post('unit_ke_lobby'),
			'no_antri' => 1,
			'id_status_pasien' => 1,
			'pembuat_pendaftaran_unit' => $this->session->id_pegawai
		);
		// print_r($data_pendaftaran);die();
		$this->db->insert('pendaftaran_unit', $data_pendaftaran);
		return $kode;
	}
	function simpan_billing_lobby_rad($id){
		$chk = $this->input->post('chk[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				$tt = $this->m_umum->ambil_data('tindakan_tarif','id_tindakan_tarif',$chk[$i]);				
				$last_ide = $this->simpan_tambah_pemeriksaan_billing2($tt['id_kelas'],$id);
				$kode = $this->m_rancak->kode_generator(15,'PM');
				$pu = $this->m_umum->ambil_data('pendaftaran_unit','barcode_pendaftaran_unit',$id);
				$p = $this->m_umum->ambil_data('pendaftaran','barcode_pendaftaran',$pu['barcode_pendaftaran']);
				$ps = $this->m_umum->ambil_data('pasien','barcode_pasien',$p['barcode_pasien']);
				$d = $this->m_umum->ambil_data('tindakan_tarif','barcode_tindakan_tarif',$tt['barcode_tindakan_tarif']);
              $kondisi=array('id_tindakan'=>$d['id_tindakan']);
              $jmlfe = $this->m_umum->jumlah_record_filter('radiologi_fe',$kondisi);
              if($jmlfe > 0){
                $umur  = $this->m_rancak->anakordewasa($ps['tgl_lahir']);
                $this->simpan_radiologi_dosis($last_ide,$d['id_tindakan'],$umur);
              }
				$data_pendaftaran = array(
					'barcode_tindakan_tarif' => $tt['barcode_tindakan_tarif'],
					'jml_billing' => 1,
					'id_cara_bayar_billing' => $this->input->post('id_cara_bayar'),
					'id_detil_cara_bayar_billing' => $this->input->post('id_detil_cara_bayar'),
					'barcode_pemeriksaan' => $last_ide,
					'barcode_billing' => $kode,
					'nominal_billing' => $tt['harga_tindakan']
				);
				$this->db->insert('billing', $data_pendaftaran);
			}
		}
	}
	function simpan_billing_lobby($id){
		$chk = $this->input->post('chk[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				$tt = $this->m_umum->ambil_data('tindakan_tarif','id_tindakan_tarif',$chk[$i]);				
				$last_ide = $this->simpan_tambah_pemeriksaan_billing2($tt['id_kelas'],$id);
				$kode = $this->m_rancak->kode_generator(15,'PM');
				$data_pendaftaran = array(
					'barcode_tindakan_tarif' => $tt['barcode_tindakan_tarif'],
					'jml_billing' => 1,
					'id_cara_bayar_billing' => $this->input->post('id_cara_bayar'),
					'id_detil_cara_bayar_billing' => $this->input->post('id_detil_cara_bayar'),
					'barcode_pemeriksaan' => $last_ide,
					'barcode_billing' => $kode,
					'nominal_billing' => $tt['harga_tindakan']
				);
				$this->db->insert('billing', $data_pendaftaran);
			}
		}
	}
	function simpan_billing_lobby_lab($id){
		$chk = $this->input->post('chk[]');
		if($chk){
			$jml_kode = count($chk);
			for ($i=0;$i<$jml_kode;$i++){
				$tt = $this->m_umum->ambil_data('tindakan_tarif','id_tindakan_tarif',$chk[$i]);				
				$last_ide = $this->simpan_tambah_pemeriksaan_billing2($tt['id_kelas'],$id);

         //     $last_ide = $this->m_ol_rancak->simpan_tambah_pemeriksaan_billing($id_kelas);
         $kondisi=array('barcode_tindakan_tarif'=>$tt['barcode_tindakan_tarif'],'tindakan_paket.id_instansi'=>$this->session->refer,'status_paket'=>1);
         $jml_paket = $this->m_umum->jumlah_record_tabel_pengajuan('tindakan_paket',$kondisi,'tindakan_tarif','id_tindakan');
        //      $this->m_ol_rancak->simpan_tambah_p_billing($last_ide,$harga_tindakan,$barcode_tindakan_tarif,$jml);
              if($jml_paket == 0){
                $this->m_ol_rancak->simpan_lab_result($last_ide,$tt['barcode_tindakan_tarif']);
              }else{
                $pkt = $this->m_umum->ambil_data_kondisi_2tabel_row('tindakan_paket',$kondisi,'tindakan_tarif','id_tindakan');
                $paket = $pkt['paket'];
                $this->m_ol_rancak->simpan_lab_result_array($last_ide,$paket);
              } 

				$kode = $this->m_rancak->kode_generator(15,'PM');

				$data_pendaftaran = array(
					'barcode_tindakan_tarif' => $tt['barcode_tindakan_tarif'],
					'jml_billing' => 1,
					'id_cara_bayar_billing' => $this->input->post('id_cara_bayar'),
					'id_detil_cara_bayar_billing' => $this->input->post('id_detil_cara_bayar'),
					'barcode_pemeriksaan' => $last_ide,
					'barcode_billing' => $kode,
					'nominal_billing' => $tt['harga_tindakan']
				);
				$this->db->insert('billing', $data_pendaftaran);
			}
		}
	}
	function simpan_tambah_pemeriksaan_billing2($id_kelas,$id){
		$kode = $this->m_rancak->kode_generator(15,'PM');
		$bpunit = $this->m_umum->ambil_data('pendaftaran_unit','barcode_pendaftaran_unit',$id);
		if($bpunit['id_status_pasien'] < 2){
			$this->update_pendaftaran_unit(2,$id);
		}
		$data_pendaftaran = array(
			'barcode_pemeriksaan' => $kode,
			'barcode_pendaftaran_unit' => $id,
			'tgl_pemeriksaan' => date('Y-m-d'),
			'ket_pemeriksaan' => $this->input->post('ket_lobby'),
			'id_pegawai' => $this->session->id_pegawai,
			'id_status_pemeriksaan' => 0
		);
		$this->db->insert('pemeriksaan', $data_pendaftaran);
		return $kode;
	}
	function simpan_tambah_p_billing($last_id,$harga_tindakan,$id,$jml){
		$kode = $this->m_rancak->kode_generator(15,'PM');
		$data_pendaftaran = array(
			'barcode_tindakan_tarif' => $id,
			'jml_billing' => $jml,
			'id_cara_bayar_billing' => $this->input->post('cb'),
			'id_detil_cara_bayar_billing' => $this->input->post('dcb'),
			'barcode_pemeriksaan' => $last_id,
			'barcode_billing' => $kode,
			'nominal_billing' => $harga_tindakan
		);
		return $this->db->insert('billing', $data_pendaftaran);
	}
	function update_pendaftaran_lobby($id,$bpu){
		$data_pendaftaran = array(
			'status_lobby' => $id
		);
		$this->db->where('barcode_lobby',$bpu);
		$this->db->update('pendaftaran_lobby', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function update_pendaftaran_unit($id,$bpu){
		$data_pendaftaran = array(
			'id_status_pasien' => $id
		);
		$this->db->where('barcode_pendaftaran_unit',$bpu);
		$this->db->update('pendaftaran_unit', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function update_pemeriksaan($id,$bpu){
		$data_pendaftaran = array(
			'id_status_pemeriksaan' => $id
		);
		$this->db->where('barcode_pemeriksaan',$bpu);
		$this->db->update('pemeriksaan', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function simpan_dokter_baca(){
		$barcode_pemeriksaan = $this->input->post('barcode_pemeriksaan');
		$barcode_pendaftaran_unit = $this->input->post('barcode_pendaftaran_unit');
		$kode = $this->m_rancak->kode_generator(15,'RR');
		$this->update_pendaftaran_unit(3,$barcode_pendaftaran_unit);
		$this->update_pemeriksaan(2,$barcode_pemeriksaan);
		$data_pendaftaran = array(
			'barcode_radiologi_result' => $kode,
			'barcode_pemeriksaan' => $barcode_pemeriksaan,
			'id_radiolog' => $this->input->post('id_radiolog')
		);
		return $this->db->insert('radiologi_result', $data_pendaftaran);
	}
	function simpan_lab_result_array($id,$pkt){
		$pkt = $this->m_umum->ambil_data_explode('tindakan','id_tindakan',$pkt);
		foreach($pkt as $rowtemp){
			$kode = $this->m_rancak->kode_generator(15,'LR');
			$id_tindakan = $rowtemp['id_tindakan'];
			$data_pendaftaran = array(
				'id_tindakan' => $id_tindakan,
				'barcode_pemeriksaan' => $id,
				'barcode_lresult' => $kode
			);
			$this->db->insert('laboratorium_result', $data_pendaftaran);			
		}
	}
	function simpan_lab_result($id,$pkt){
		$pkt = $this->m_umum->ambil_data('tindakan_tarif','barcode_tindakan_tarif',$pkt);
		$kode = $this->m_rancak->kode_generator(15,'LR');
		$data_pendaftaran = array(
			'id_tindakan' => $pkt['id_tindakan'],
			'barcode_pemeriksaan' => $id,
			'barcode_lresult' => $kode
		);
		$this->db->insert('laboratorium_result', $data_pendaftaran);			
	}
	function edit_pemeriksaan(){
		$barcode_pemeriksaan = $this->input->post('barcode_pemeriksaan');
		$data_pendaftaran = array(
			'no_pemeriksaan' =>$this->input->post('no_pemeriksaan')
		);
		$this->db->where('barcode_pemeriksaan',$barcode_pemeriksaan);
		$this->db->update('pemeriksaan', $data_pendaftaran);
		echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function edit_billing(){
		$barcode_pemeriksaan = $this->input->post('barcode_pemeriksaan');
		$data_pendaftaran = array(
			'jml_billing' => $this->input->post('jml_billing')
		);
		$this->db->where('barcode_pemeriksaan',$barcode_pemeriksaan);
		$this->db->update('billing', $data_pendaftaran);
	//	echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function simpan_pemeriksaan_penunjang(){
		$tgl_pemeriksaan_penunjang = $this->input->post('tgl');
		$tgl_pemeriksaan_penunjang = date('Y-m-d', strtotime($tgl_pemeriksaan_penunjang));
		$kode = $this->m_rancak->kode_generator(15,'PP');
		$data_pendaftaran = array(
			'id_tindakan' => $this->input->post('nama'),
			'hasil_pemeriksaan_penunjang' => $this->input->post('hasil'),
			'dokter_pemeriksaan_penunjang' => $this->input->post('dokter'),
			'barcode_pemeriksaan_penunjang' => $kode,
			'tgl_pemeriksaan_penunjang' => $tgl_pemeriksaan_penunjang,
			'pembuat_pemeriksaan_penunjang' => $this->session->id_pegawai,
			'barcode_pendaftaran' => $this->input->post('daftar')
		);
		return $this->db->insert('pemeriksaan_penunjang', $data_pendaftaran);
	}
	function edit_pemeriksaan_penunjang(){
		$id_pemeriksaan_penunjang = $this->input->post('daftar');
		$tgl_pemeriksaan_penunjang = $this->input->post('tgl');
		$tgl_pemeriksaan_penunjang = date('Y-m-d', strtotime($tgl_pemeriksaan_penunjang));
		$data_pendaftaran = array(
			'id_tindakan' => $this->input->post('nama'),
			'hasil_pemeriksaan_penunjang' => $this->input->post('hasil'),
			'dokter_pemeriksaan_penunjang' => $this->input->post('dokter'),
			'tgl_pemeriksaan_penunjang' => $tgl_pemeriksaan_penunjang
		);
		$this->db->where('id_pemeriksaan_penunjang',$id_pemeriksaan_penunjang);
		$this->db->update('pemeriksaan_penunjang', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function simpan_pemeriksaan_vital_sign(){
		$kasus = $this->input->post('kasus[]');
		$kasus = implode(',',$kasus);
		$sirkulasi = $this->input->post('sirkulasi[]');
		$sirkulasi = implode(',',$sirkulasi);
		$respon = $this->input->post('respon[]');
		$respon = implode(',',$respon);
		$barcode_pendaftaran_unit = $this->input->post('barcode_pendaftaran_unit');
		$this->update_pendaftaran_unit(3,$barcode_pendaftaran_unit);
		$kode = $this->m_rancak->kode_generator(15,'VS');
		$data_pendaftaran = array(
			'barcode_pendaftaran_unit' => $this->input->post('barcode_pendaftaran_unit'),
			'hamil' => $this->input->post('hamil'),
			'tb' => $this->input->post('tb'),
			'barcode_pemeriksaan_vital_sign' => $kode,
			'bb' => $this->input->post('bb'),
			'sistole' => $this->input->post('sistole'),
			'diastole' => $this->input->post('diastole'),
			'rr' => $this->input->post('rr'),
			'nadi' => $this->input->post('nadi'),
			'suhu' => $this->input->post('suhu'),
			'spo2' => $this->input->post('spo2'),
			'id_gcs_eye' => $this->input->post('id_gcs_eye'),
			'id_gcs_motorik' => $this->input->post('id_gcs_motorik'),
			'id_gcs_verb' => $this->input->post('id_gcs_verb'),
			'id_jalan_napas' => $this->input->post('id_jalan_napas'),
			'id_pernapasan' => $this->input->post('id_pernapasan'),
			'riwayat_alergi' => $this->input->post('riwayat_alergi'),
			'id_nyeri' => $this->input->post('id_nyeri'),
			'nyeri_lokasi' => $this->input->post('nyeri_lokasi'),
			'nyeri_hilang' => $this->input->post('nyeri_hilang'),
			'sirkulasi' => $sirkulasi,
			'id_nutrisi' => $this->input->post('id_nutrisi'),
			'id_geriatri' => $this->input->post('id_geriatri'),
			'id_edmonson' => $this->input->post('id_edmonson'),
			'id_morse' => $this->input->post('id_morse'),
			'id_hd' => $this->input->post('id_hd'),
			'id_triase' => $this->input->post('id_triase'),
			'kasus' => $kasus,
			'respon' => $respon,
			'talk_problem' => $this->input->post('talk_problem'),
			'habit' => $this->input->post('habit'),
			'hereditary' => $this->input->post('hereditary'),
			'komplikasi' => $this->input->post('komplikasi'),
			'ket_pemeriksaan_vital_sign' => $this->input->post('ket_pemeriksaan_vital_sign'),
			'pembuat_pemeriksaan_vital_sign' => $this->session->id_pegawai
		);
		return $this->db->insert('pemeriksaan_vital_sign', $data_pendaftaran);
	}
	function ambil_data_pasien($id)
	{
		$this->db->select("*,CONCAT(ps.alamat,', ',nama_kel,', ',nama_kec,', ',nama_kab,', ',nama_prov) as alamat,peg.nama_pegawai,
			CONCAT((TIMESTAMPDIFF( YEAR, ps.tgl_lahir, tgl_pendaftaran_unit )), ' Tahun ',
			TIMESTAMPDIFF( MONTH, ps.tgl_lahir, tgl_pendaftaran_unit ) % 12, ' Bulan ',
			FLOOR( TIMESTAMPDIFF( DAY, ps.tgl_lahir, tgl_pendaftaran_unit ) % 30.4375 ), ' Hari') as umur,
			if(p.id_cara_bayar = '6',concat('Karyawan : ',peg1.nama_pegawai),ka.nama_detil_cara_bayar) as nama_bayar,p.barcode_pendaftaran,
			if(p.id_cara_masuk = '7',u1.nama_unit,if(p.id_instansi_cara_masuk = '0','-',nama_rujukan_instansi)) as nama_instansi,
			if(p.id_cara_masuk = '7',rapen.nama_pegawai,if(p.id_dokter_rujukan = '0','-',nama_rujukan_dokter)) as nama_dokter,
			");
		$this->db->join('pendaftaran p', 'p.barcode_pendaftaran=pu.barcode_pendaftaran','left');
		$this->db->join('pasien ps', 'ps.barcode_pasien=p.barcode_pasien','left');
		$this->db->join('kol_golongan_darah kgd', 'kgd.id_golongan_darah=ps.id_golongan_darah','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=ps.id_status_kawin','left');
		$this->db->join('kol_pekerjaan kpk', 'kpk.id_pekerjaan=ps.id_pekerjaan','left');
		$this->db->join('kol_pendidikan pendi', 'pendi.id_pendidikan=ps.id_pendidikan','left');
		$this->db->join('kol_provinsi kprov', 'kprov.id_prov=ps.id_prov','left');
		$this->db->join('kol_kabupaten kkab', 'kkab.id_kab=ps.id_kab','left');
		$this->db->join('kol_kecamatan kkec', 'kkec.id_kec=ps.id_kec','left');
		$this->db->join('kol_kelurahan kkel', 'kkel.id_kel=ps.id_kel','left');
		$this->db->join('kol_agama ag', 'ag.id_agama=ps.id_agama','left');	
		$this->db->join('kol_cara_bayar cb','cb.id_cara_bayar=p.id_cara_bayar','left');
		$this->db->join('kol_detil_cara_bayar ka','ka.id_detil_cara_bayar=p.id_detil_cara_bayar','left');
		$this->db->join('kol_cara_masuk cm',  'cm.id_cara_masuk=p.id_cara_masuk','left');
		$this->db->join('kol_rujukan_dokter dr','dr.id_rujukan_dokter=p.id_dokter_rujukan','left');
		$this->db->join('kol_rujukan_instansi ir','ir.id_rujukan_instansi=p.id_instansi_cara_masuk','left');
		$this->db->join('ol_pegawai peg','peg.id_pegawai=pu.pembuat_pendaftaran_unit','left');
		$this->db->join('ol_pegawai peg1','peg1.id_pegawai=p.id_detil_cara_bayar','left');
		$this->db->join('ol_pegawai rapen','rapen.id_pegawai=p.id_dokter_rujukan','left');
		$this->db->join('ol_unit u1','u1.id_unit=p.id_instansi_cara_masuk','left');
		$q = $this->db->get_where('pendaftaran_unit pu',array('pu.barcode_pendaftaran_unit'=>$id));
		return $q->row_array();
	}
	function histori_px($id)
	{
		$ps = $this->ambil_data_pasien($id);
		$fields = "*,DATE_FORMAT(wkt_daftar_unit,'%d-%m-%Y %H:%i:%s') as wkt_daftar_unit,
			if(p.id_cara_bayar = '6',concat('Karyawan : ',peg1.nama_pegawai),ka.nama_detil_cara_bayar) as nama_bayar,peg.nama_pegawai,
			if(p.id_cara_masuk = '7',u1.nama_unit,if(p.id_instansi_cara_masuk = '0','-',nama_rujukan_instansi)) as nama_instansi,
			if(p.id_cara_masuk = '7',rapen.nama_pegawai,if(p.id_dokter_rujukan = '0','-',nama_rujukan_dokter)) as nama_dokter			
		";
	//--------- Siapkan Parameter dari datatables ---------
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));
		$order = $this->input->post('order');
		$cari = $this->input->post('search');
	//--------- Cek kolom mana yg di urut dan asc/desc -----
		$col =$order[0]['column'];
		$dir= $order[0]['dir'];

	//--------- Ambil nama field dari daftar POST columns dttables
		$dt_kolom=$this->input->post('columns');

	//--------- Mulai Query UTAMA ---------------------------
		$this->db->select($fields);  //01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan [coding here]
/*					case 'id_pendaftaran' : $nmf="pd.id_pendaftaran";break;
				//	case 'rm' : $nmf="pd.rm";break;
					case 'nama_unit' : $nmf="u.nama_unit";break;
					case 'jk' : $nmf='ps.jk';break;
					case 'petugas' : $nmf='peg2.nama_pegawai';break;
				//	case 'umur' : $nmf='YEAR(CURDATE()) - YEAR(ps.tgl_lahir)';break;*/
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('p.barcode_pasien',$ps['barcode_pasien']);
		$this->db->where("pendaftaran_instansi", $this->session->refer);		
		
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('pendaftaran_unit pu');                   //04 Form.. left join
		$this->db->join('pendaftaran p', 'p.barcode_pendaftaran=pu.barcode_pendaftaran','left');
		$this->db->join('kol_cara_bayar cb','cb.id_cara_bayar=p.id_cara_bayar','left');
		$this->db->join('kol_detil_cara_bayar ka','ka.id_detil_cara_bayar=p.id_detil_cara_bayar','left');
		$this->db->join('kol_cara_masuk cm',  'cm.id_cara_masuk=p.id_cara_masuk','left');
		$this->db->join('kol_rujukan_dokter dr','dr.id_rujukan_dokter=p.id_dokter_rujukan','left');
		$this->db->join('kol_rujukan_instansi ir','ir.id_rujukan_instansi=p.id_instansi_cara_masuk','left');
		$this->db->join('ol_pegawai peg','peg.id_pegawai=pu.pembuat_pendaftaran_unit','left');
		$this->db->join('ol_pegawai peg1','peg1.id_pegawai=p.id_detil_cara_bayar','left');
		$this->db->join('ol_pegawai rapen','rapen.id_pegawai=p.id_dokter_rujukan','left');
		$this->db->join('ol_unit u1','u1.id_unit=p.id_instansi_cara_masuk','left');	
		$this->db->join('ol_unit ou', 'ou.id_unit=pu.unit_ke','left');
		$this->db->where('p.barcode_pasien',$ps['barcode_pasien']);
		$this->db->where("pendaftaran_instansi", $this->session->refer);
		$this->db->order_by("wkt_daftar_unit", "desc");	
		
		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
/*					case 'id_pendaftaran' : $nmf="pd.id_pendaftaran";break;
				//	case 'rm' : $nmf="pd.rm";break;
					case 'nama_unit' : $nmf="u.nama_unit";break;
					case 'jk' : $nmf='ps.jk';break;
					case 'petugas' : $nmf='peg2.nama_pegawai';break;
				//	case 'umur' : $nmf='YEAR(CURDATE()) - YEAR(ps.tgl_lahir)';break;*/
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('p.barcode_pasien',$ps['barcode_pasien']);
		$this->db->where("pendaftaran_instansi", $this->session->refer);			
		
			}
		  }
		}

		$this->db->from('pendaftaran_unit pu');                   //04 Form.. left join
		$this->db->join('pendaftaran p', 'p.barcode_pendaftaran=pu.barcode_pendaftaran','left');
		$this->db->join('kol_cara_bayar cb','cb.id_cara_bayar=p.id_cara_bayar','left');
		$this->db->join('kol_detil_cara_bayar ka','ka.id_detil_cara_bayar=p.id_detil_cara_bayar','left');
		$this->db->join('kol_cara_masuk cm',  'cm.id_cara_masuk=p.id_cara_masuk','left');
		$this->db->join('kol_rujukan_dokter dr','dr.id_rujukan_dokter=p.id_dokter_rujukan','left');
		$this->db->join('kol_rujukan_instansi ir','ir.id_rujukan_instansi=p.id_instansi_cara_masuk','left');
		$this->db->join('ol_pegawai peg','peg.id_pegawai=pu.pembuat_pendaftaran_unit','left');
		$this->db->join('ol_pegawai peg1','peg1.id_pegawai=p.id_detil_cara_bayar','left');
		$this->db->join('ol_pegawai rapen','rapen.id_pegawai=p.id_dokter_rujukan','left');
		$this->db->join('ol_unit u1','u1.id_unit=p.id_instansi_cara_masuk','left');	
		$this->db->join('ol_unit ou', 'ou.id_unit=pu.unit_ke','left');
		$this->db->where('p.barcode_pasien',$ps['barcode_pasien']);
		$this->db->where("pendaftaran_instansi", $this->session->refer);
		$this->db->order_by("wkt_daftar_unit", "desc");			
		
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
	//	$kondisi=array('id_level !='=>'99');
	//	$jml = $this->m_umum->jumlah_record_filter('user',$kondisi);		//[coding here] ganti tabel utamanya
		$jml = $this->m_umum->jumlah_record_tabel('pendaftaran_unit');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function hasil_lab_all($id)
	{
		$ps = $this->ambil_data_pasien($id);
		$fields = "*,
			DATE_FORMAT(tgl_pendaftaran_unit,'%d-%m-%Y') as tgl_pendaftaran_unit,pmr.barcode_pemeriksaan,
			if(p.id_cara_bayar = '6',concat('Karyawan : ',peg1.nama_pegawai),ka.nama_detil_cara_bayar) as nama_bayar,op.nama_pegawai,
			if(p.id_cara_masuk = '7',u1.nama_unit,if(p.id_instansi_cara_masuk = '0','-',nama_rujukan_instansi)) as nama_instansi,
			if(p.id_cara_masuk = '7',rapen.nama_pegawai,if(p.id_dokter_rujukan = '0','-',nama_rujukan_dokter)) as nama_dokter
			";
	//--------- Siapkan Parameter dari datatables ---------
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));
		$order = $this->input->post('order');
		$cari = $this->input->post('search');
	//--------- Cek kolom mana yg di urut dan asc/desc -----
		$col =$order[0]['column'];
		$dir= $order[0]['dir'];

	//--------- Ambil nama field dari daftar POST columns dttables
		$dt_kolom=$this->input->post('columns');

	//--------- Mulai Query UTAMA ---------------------------
		$this->db->select($fields);  //01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan [coding here]

				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('p.barcode_pasien',$ps['barcode_pasien']);
		$this->db->where("pu.unit_ke", 3);	
		$this->db->where("pendaftaran_instansi", $this->session->refer);					
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('pemeriksaan pmr');
		$this->db->join('pendaftaran_unit pu', 'pu.barcode_pendaftaran_unit=pmr.barcode_pendaftaran_unit','left');
		$this->db->join('pendaftaran p', 'p.barcode_pendaftaran=pu.barcode_pendaftaran','left');
		$this->db->join('ol_pegawai op', 'op.id_pegawai=pu.dr_petugas','left');
		$this->db->join('kol_cara_bayar cb','cb.id_cara_bayar=p.id_cara_bayar','left');
		$this->db->join('kol_detil_cara_bayar ka','ka.id_detil_cara_bayar=p.id_detil_cara_bayar','left');
		$this->db->join('kol_cara_masuk cm',  'cm.id_cara_masuk=p.id_cara_masuk','left');
		$this->db->join('kol_rujukan_dokter dr','dr.id_rujukan_dokter=p.id_dokter_rujukan','left');
		$this->db->join('kol_rujukan_instansi ir','ir.id_rujukan_instansi=p.id_instansi_cara_masuk','left');
		$this->db->join('ol_pegawai peg1','peg1.id_pegawai=p.id_detil_cara_bayar','left');
		$this->db->join('ol_pegawai rapen','rapen.id_pegawai=p.id_dokter_rujukan','left');
		$this->db->join('ol_unit u1','u1.id_unit=p.id_instansi_cara_masuk','left');	
		$this->db->join('ol_unit ou', 'ou.id_unit=pu.unit_ke','left');
		$this->db->where('p.barcode_pasien',$ps['barcode_pasien']);
	//	$this->db->where('pmr.barcode_pendaftaran_unit',$id);
		$this->db->where("pu.unit_ke", 3);	
		$this->db->where("pendaftaran_instansi", $this->session->refer);	
		$this->db->order_by("wkt_daftar_unit", "desc");			

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]

					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('p.barcode_pasien',$ps['barcode_pasien']);
		$this->db->where("pu.unit_ke", 3);	
		$this->db->where("pendaftaran_instansi", $this->session->refer);						
		
			}
		  }
		}

		$this->db->from('pemeriksaan pmr');
		$this->db->join('pendaftaran_unit pu', 'pu.barcode_pendaftaran_unit=pmr.barcode_pendaftaran_unit','left');
		$this->db->join('pendaftaran p', 'p.barcode_pendaftaran=pu.barcode_pendaftaran','left');
		$this->db->join('ol_pegawai op', 'op.id_pegawai=pu.dr_petugas','left');
		$this->db->join('kol_cara_bayar cb','cb.id_cara_bayar=p.id_cara_bayar','left');
		$this->db->join('kol_detil_cara_bayar ka','ka.id_detil_cara_bayar=p.id_detil_cara_bayar','left');
		$this->db->join('kol_cara_masuk cm',  'cm.id_cara_masuk=p.id_cara_masuk','left');
		$this->db->join('kol_rujukan_dokter dr','dr.id_rujukan_dokter=p.id_dokter_rujukan','left');
		$this->db->join('kol_rujukan_instansi ir','ir.id_rujukan_instansi=p.id_instansi_cara_masuk','left');
		$this->db->join('ol_pegawai peg1','peg1.id_pegawai=p.id_detil_cara_bayar','left');
		$this->db->join('ol_pegawai rapen','rapen.id_pegawai=p.id_dokter_rujukan','left');
		$this->db->join('ol_unit u1','u1.id_unit=p.id_instansi_cara_masuk','left');	
		$this->db->join('ol_unit ou', 'ou.id_unit=pu.unit_ke','left');
		$this->db->where('p.barcode_pasien',$ps['barcode_pasien']);
		$this->db->where("pu.unit_ke", 3);	
		$this->db->where("pendaftaran_instansi", $this->session->refer);	
		$this->db->order_by("wkt_daftar_unit", "desc");					
		

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
	//	$kondisi=array('id_level !='=>'99');
	//	$jml = $this->m_umum->jumlah_record_filter('user',$kondisi);		//[coding here] ganti tabel utamanya
		$jml = $this->m_umum->jumlah_record_tabel('pemeriksaan');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function penunjang_luar($id)
	{
		$ps = $this->ambil_data_pasien($id);
		$fields = "*,DATE_FORMAT(wkt_daftar,'%d-%m-%Y %H:%i:%s') as wkt_daftar,DATE_FORMAT(tgl_pemeriksaan_penunjang,'%d-%m-%Y') as tgl_pemeriksaan_penunjang
		";
	//--------- Siapkan Parameter dari datatables ---------
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));
		$order = $this->input->post('order');
		$cari = $this->input->post('search');
	//--------- Cek kolom mana yg di urut dan asc/desc -----
		$col =$order[0]['column'];
		$dir= $order[0]['dir'];

	//--------- Ambil nama field dari daftar POST columns dttables
		$dt_kolom=$this->input->post('columns');

	//--------- Mulai Query UTAMA ---------------------------
		$this->db->select($fields);  //01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan [coding here]
/*					case 'id_pendaftaran' : $nmf="pd.id_pendaftaran";break;
				//	case 'rm' : $nmf="pd.rm";break;
					case 'nama_unit' : $nmf="u.nama_unit";break;
					case 'jk' : $nmf='ps.jk';break;
					case 'petugas' : $nmf='peg2.nama_pegawai';break;
				//	case 'umur' : $nmf='YEAR(CURDATE()) - YEAR(ps.tgl_lahir)';break;*/
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('pd.barcode_pasien',$ps['barcode_pasien']);
		$this->db->where("pendaftaran_instansi", $this->session->refer);		
		
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('pemeriksaan_penunjang pnj');                   //04 Form.. left join
		$this->db->join('pendaftaran pd', 'pd.barcode_pendaftaran=pnj.barcode_pendaftaran','left');
		$this->db->join('tindakan t', 't.id_tindakan=pnj.id_tindakan','left');
		$this->db->where('pd.barcode_pasien',$ps['barcode_pasien']);
		$this->db->where("pendaftaran_instansi", $this->session->refer);
		$this->db->order_by("wkt_daftar", "desc");	
		
		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
/*					case 'id_pendaftaran' : $nmf="pd.id_pendaftaran";break;
				//	case 'rm' : $nmf="pd.rm";break;
					case 'nama_unit' : $nmf="u.nama_unit";break;
					case 'jk' : $nmf='ps.jk';break;
					case 'petugas' : $nmf='peg2.nama_pegawai';break;
				//	case 'umur' : $nmf='YEAR(CURDATE()) - YEAR(ps.tgl_lahir)';break;*/
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('pd.barcode_pasien',$ps['barcode_pasien']);
		$this->db->where("pendaftaran_instansi", $this->session->refer);			
		
			}
		  }
		}

		$this->db->from('pemeriksaan_penunjang pnj');                   //04 Form.. left join
		$this->db->join('pendaftaran pd', 'pd.barcode_pendaftaran=pnj.barcode_pendaftaran','left');
		$this->db->join('tindakan t', 't.id_tindakan=pnj.id_tindakan','left');
		$this->db->where('pd.barcode_pasien',$ps['barcode_pasien']);
		$this->db->where("pendaftaran_instansi", $this->session->refer);
		$this->db->order_by("wkt_daftar", "desc");			
		
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
	//	$kondisi=array('id_level !='=>'99');
	//	$jml = $this->m_umum->jumlah_record_filter('user',$kondisi);		//[coding here] ganti tabel utamanya
		$jml = $this->m_umum->jumlah_record_tabel('pemeriksaan_penunjang');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function tabel_radiologi_result($id)
	{
		$ps = $this->ambil_data_pasien($id);
		$fields = "*,if(waktu_radiologi_result IS NULL,'Belum Baca',DATE_FORMAT(waktu_radiologi_result,'%d-%m-%Y %H:%i:%s')) as waktu_radiologi_result,DATE_FORMAT(wkt_daftar_unit,'%d-%m-%Y %H:%i:%s') as wkt_daftar_unit,if(waktu_radiologi_result IS NULL,'Belum Baca',timediff(waktu_radiologi_result, wkt_daftar_unit)) as selisih
		";
	//--------- Siapkan Parameter dari datatables ---------
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));
		$order = $this->input->post('order');
		$cari = $this->input->post('search');
	//--------- Cek kolom mana yg di urut dan asc/desc -----
		$col =$order[0]['column'];
		$dir= $order[0]['dir'];

	//--------- Ambil nama field dari daftar POST columns dttables
		$dt_kolom=$this->input->post('columns');

	//--------- Mulai Query UTAMA ---------------------------
		$this->db->select($fields);  //01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan [coding here]
/*					case 'id_pendaftaran' : $nmf="pd.id_pendaftaran";break;
				//	case 'rm' : $nmf="pd.rm";break;
					case 'nama_unit' : $nmf="u.nama_unit";break;
					case 'jk' : $nmf='ps.jk';break;
					case 'petugas' : $nmf='peg2.nama_pegawai';break;
				//	case 'umur' : $nmf='YEAR(CURDATE()) - YEAR(ps.tgl_lahir)';break;*/
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('pd.barcode_pasien',$ps['barcode_pasien']);
		$this->db->where("pendaftaran_instansi", $this->session->refer);		
		
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('radiologi_result rr');                   //04 Form.. left join
		$this->db->join('pemeriksaan pmr', 'pmr.barcode_pemeriksaan=rr.barcode_pemeriksaan','left');
		$this->db->join('billing bil', 'bil.barcode_pemeriksaan=pmr.barcode_pemeriksaan','left');
		$this->db->join('tindakan_tarif tt', 'tt.barcode_tindakan_tarif=bil.barcode_tindakan_tarif','left');
		$this->db->join('tindakan t', 't.id_tindakan=tt.id_tindakan','left');
		$this->db->join('pendaftaran_unit pu', 'pu.barcode_pendaftaran_unit=pmr.barcode_pendaftaran_unit','left');
		$this->db->join('pendaftaran pd', 'pd.barcode_pendaftaran=pu.barcode_pendaftaran','left');
		$this->db->join('ol_pegawai op', 'op.id_pegawai=rr.id_radiolog','left');
		$this->db->where('pd.barcode_pasien', $ps['barcode_pasien']);
		$this->db->where("pendaftaran_instansi", $this->session->refer);
		
		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
/*					case 'id_pendaftaran' : $nmf="pd.id_pendaftaran";break;
				//	case 'rm' : $nmf="pd.rm";break;
					case 'nama_unit' : $nmf="u.nama_unit";break;
					case 'jk' : $nmf='ps.jk';break;
					case 'petugas' : $nmf='peg2.nama_pegawai';break;
				//	case 'umur' : $nmf='YEAR(CURDATE()) - YEAR(ps.tgl_lahir)';break;*/
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('pd.barcode_pasien',$ps['barcode_pasien']);
		$this->db->where("pendaftaran_instansi", $this->session->refer);			
		
			}
		  }
		}

		$this->db->from('radiologi_result rr');                   //04 Form.. left join
		$this->db->join('pemeriksaan pmr', 'pmr.barcode_pemeriksaan=rr.barcode_pemeriksaan','left');
		$this->db->join('billing bil', 'bil.barcode_pemeriksaan=pmr.barcode_pemeriksaan','left');
		$this->db->join('tindakan_tarif tt', 'tt.barcode_tindakan_tarif=bil.barcode_tindakan_tarif','left');
		$this->db->join('tindakan t', 't.id_tindakan=tt.id_tindakan','left');
		$this->db->join('pendaftaran_unit pu', 'pu.barcode_pendaftaran_unit=pmr.barcode_pendaftaran_unit','left');
		$this->db->join('pendaftaran pd', 'pd.barcode_pendaftaran=pu.barcode_pendaftaran','left');
		$this->db->join('ol_pegawai op', 'op.id_pegawai=rr.id_radiolog','left');
		$this->db->where('pd.barcode_pasien', $ps['barcode_pasien']);
		$this->db->where("pendaftaran_instansi", $this->session->refer);	
		
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
	//	$kondisi=array('id_level !='=>'99');
	//	$jml = $this->m_umum->jumlah_record_filter('user',$kondisi);		//[coding here] ganti tabel utamanya
		$jml = $this->m_umum->jumlah_record_tabel('radiologi_result');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function tabel_lobby_perunit($unit)
	{
		$fields = "*,
			CONCAT((TIMESTAMPDIFF( YEAR, ps.tgl_lahir, tgl_pendaftaran_unit )), ' Tahun ',
			TIMESTAMPDIFF( MONTH, ps.tgl_lahir, tgl_pendaftaran_unit ) % 12, ' Bulan ',
			FLOOR( TIMESTAMPDIFF( DAY, ps.tgl_lahir, tgl_pendaftaran_unit ) % 30.4375 ), ' Hari') as umur,
			DATE_FORMAT(tgl_pendaftaran_unit,'%d-%m-%Y') as tgl_pendaftaran_unit, 
			DATE_FORMAT(waktu_lobby,'%d-%m-%Y %H:%i:%s') as waktu_lobby, 
			if(p.id_cara_bayar = '6',concat('Karyawan : ',peg1.nama_pegawai),ka.nama_detil_cara_bayar) as nama_bayar,
			if(p.id_cara_masuk = '7',u1.nama_unit,if(p.id_instansi_cara_masuk = '0','-',nama_rujukan_instansi)) as nama_instansi,
			if(p.id_cara_masuk = '7',rapen.nama_pegawai,if(p.id_dokter_rujukan = '0','-',nama_rujukan_dokter)) as nama_dokter,op.nama_pegawai
		";
	//--------- Siapkan Parameter dari datatables ---------
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));
		$order = $this->input->post('order');
		$cari = $this->input->post('search');
	//--------- Cek kolom mana yg di urut dan asc/desc -----
		$col =$order[0]['column'];
		$dir= $order[0]['dir'];

	//--------- Ambil nama field dari daftar POST columns dttables
		$dt_kolom=$this->input->post('columns');

	//--------- Mulai Query UTAMA ---------------------------
		$this->db->select($fields);  //01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan [coding here]
/*					case 'id_pendaftaran' : $nmf="pd.id_pendaftaran";break;
				//	case 'rm' : $nmf="pd.rm";break;
					case 'nama_unit' : $nmf="u.nama_unit";break;
					case 'jk' : $nmf='ps.jk';break;
					case 'petugas' : $nmf='peg2.nama_pegawai';break;
				//	case 'umur' : $nmf='YEAR(CURDATE()) - YEAR(ps.tgl_lahir)';break;*/
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('pl.unit_ke_lobby', $unit);
		$this->db->where('pl.status_lobby', 1);
		$this->db->where("pendaftaran_instansi", $this->session->refer);		
		
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('pendaftaran_lobby pl');                   //04 Form.. left join
		$this->db->join('pendaftaran_unit pu', 'pu.barcode_pendaftaran_unit=pl.barcode_pendaftaran_unit','left');
		$this->db->join('pendaftaran p', 'p.barcode_pendaftaran=pu.barcode_pendaftaran','left');
		$this->db->join('pasien ps', 'ps.barcode_pasien=p.barcode_pasien','left');
		$this->db->join('kol_agama a', 'a.id_agama=ps.id_agama','left');
		$this->db->join('kol_golongan_darah kgd', 'kgd.id_golongan_darah=ps.id_golongan_darah','left');
		$this->db->join('kol_pendidikan pend', 'pend.id_pendidikan=ps.id_pendidikan','left');
		$this->db->join('kol_pekerjaan kp', 'kp.id_pekerjaan=ps.id_pekerjaan','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=ps.id_status_kawin','left');
		$this->db->join('kol_provinsi provi', 'provi.id_prov=ps.id_prov','left');
		$this->db->join('kol_kabupaten kabu', 'kabu.id_kab=ps.id_kab','left');
		$this->db->join('kol_kecamatan keca', 'keca.id_kec=ps.id_kec','left');
		$this->db->join('kol_kelurahan kelu', 'kelu.id_kel=ps.id_kel','left');
		$this->db->join('kol_working kw', 'kw.id_working=p.pendaftaran_instansi','left');
		$this->db->join('ol_pegawai op','op.id_pegawai=pl.id_dokter','left');
		$this->db->join('kol_cara_bayar cb','cb.id_cara_bayar=p.id_cara_bayar','left');
		$this->db->join('kol_detil_cara_bayar ka','ka.id_detil_cara_bayar=p.id_detil_cara_bayar','left');
		$this->db->join('kol_cara_masuk cm',  'cm.id_cara_masuk=p.id_cara_masuk','left');
		$this->db->join('kol_rujukan_dokter dr','dr.id_rujukan_dokter=p.id_dokter_rujukan','left');
		$this->db->join('kol_rujukan_instansi ir','ir.id_rujukan_instansi=p.id_instansi_cara_masuk','left');
		$this->db->join('ol_pegawai peg','peg.id_pegawai=pu.pembuat_pendaftaran_unit','left');
		$this->db->join('ol_pegawai peg1','peg1.id_pegawai=p.id_detil_cara_bayar','left');
		$this->db->join('ol_pegawai rapen','rapen.id_pegawai=p.id_dokter_rujukan','left');
		$this->db->join('ol_unit u1','u1.id_unit=p.id_instansi_cara_masuk','left');
		$this->db->where('pl.unit_ke_lobby', $unit);
		$this->db->where('pl.status_lobby', 1);
		$this->db->where("pendaftaran_instansi", $this->session->refer);
		$this->db->order_by("waktu_lobby", "desc");
		
		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
/*					case 'id_pendaftaran' : $nmf="pd.id_pendaftaran";break;
				//	case 'rm' : $nmf="pd.rm";break;
					case 'nama_unit' : $nmf="u.nama_unit";break;
					case 'jk' : $nmf='ps.jk';break;
					case 'petugas' : $nmf='peg2.nama_pegawai';break;
				//	case 'umur' : $nmf='YEAR(CURDATE()) - YEAR(ps.tgl_lahir)';break;*/
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('pl.unit_ke_lobby', $unit);
		$this->db->where('pl.status_lobby', 1);
		$this->db->where("pendaftaran_instansi", $this->session->refer);			
		
			}
		  }
		}

		$this->db->from('pendaftaran_lobby pl');                   //04 Form.. left join
		$this->db->join('pendaftaran_unit pu', 'pu.barcode_pendaftaran_unit=pl.barcode_pendaftaran_unit','left');
		$this->db->join('pendaftaran p', 'p.barcode_pendaftaran=pu.barcode_pendaftaran','left');
		$this->db->join('pasien ps', 'ps.barcode_pasien=p.barcode_pasien','left');
		$this->db->join('kol_agama a', 'a.id_agama=ps.id_agama','left');
		$this->db->join('kol_golongan_darah kgd', 'kgd.id_golongan_darah=ps.id_golongan_darah','left');
		$this->db->join('kol_pendidikan pend', 'pend.id_pendidikan=ps.id_pendidikan','left');
		$this->db->join('kol_pekerjaan kp', 'kp.id_pekerjaan=ps.id_pekerjaan','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=ps.id_status_kawin','left');
		$this->db->join('kol_provinsi provi', 'provi.id_prov=ps.id_prov','left');
		$this->db->join('kol_kabupaten kabu', 'kabu.id_kab=ps.id_kab','left');
		$this->db->join('kol_kecamatan keca', 'keca.id_kec=ps.id_kec','left');
		$this->db->join('kol_kelurahan kelu', 'kelu.id_kel=ps.id_kel','left');
		$this->db->join('kol_working kw', 'kw.id_working=p.pendaftaran_instansi','left');
		$this->db->join('ol_pegawai op','op.id_pegawai=pl.id_dokter','left');
		$this->db->join('kol_cara_bayar cb','cb.id_cara_bayar=p.id_cara_bayar','left');
		$this->db->join('kol_detil_cara_bayar ka','ka.id_detil_cara_bayar=p.id_detil_cara_bayar','left');
		$this->db->join('kol_cara_masuk cm',  'cm.id_cara_masuk=p.id_cara_masuk','left');
		$this->db->join('kol_rujukan_dokter dr','dr.id_rujukan_dokter=p.id_dokter_rujukan','left');
		$this->db->join('kol_rujukan_instansi ir','ir.id_rujukan_instansi=p.id_instansi_cara_masuk','left');
		$this->db->join('ol_pegawai peg','peg.id_pegawai=pu.pembuat_pendaftaran_unit','left');
		$this->db->join('ol_pegawai peg1','peg1.id_pegawai=p.id_detil_cara_bayar','left');
		$this->db->join('ol_pegawai rapen','rapen.id_pegawai=p.id_dokter_rujukan','left');
		$this->db->join('ol_unit u1','u1.id_unit=p.id_instansi_cara_masuk','left');
		$this->db->where('pl.unit_ke_lobby', $unit);
		$this->db->where('pl.status_lobby', 1);
		$this->db->where("pendaftaran_instansi", $this->session->refer);
		$this->db->order_by("waktu_lobby", "desc");	
		
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$kondisi=array('status_lobby'=>1,'unit_ke_lobby'=>$unit);
		$jml = $this->m_umum->jumlah_record_filter('pendaftaran_lobby',$kondisi);		//[coding here] ganti tabel utamanya
	//	$jml = $this->m_umum->jumlah_record_tabel('pendaftaran_lobby');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function tabel_sparkling_line($id)
	{
		$ps = $this->ambil_data_pasien($id);
		$fields = "*,
			DATE_FORMAT(tgl_pendaftaran_unit,'%d-%m-%Y') as tgl_pendaftaran_unit, 
			DATE_FORMAT(waktu_pemeriksaan_vital_sign,'%d-%m-%Y %H:%i:%s') as waktu_pemeriksaan_vital_sign, 
			sistole,diastole,rr,nadi,tb,bb,nadi,spo2,suhu,
			if(p.id_cara_bayar = '6',concat('Karyawan : ',peg1.nama_pegawai),ka.nama_detil_cara_bayar) as nama_bayar,peg.nama_pegawai,
			if(p.id_cara_masuk = '7',u1.nama_unit,if(p.id_instansi_cara_masuk = '0','-',nama_rujukan_instansi)) as nama_instansi,
			if(p.id_cara_masuk = '7',rapen.nama_pegawai,if(p.id_dokter_rujukan = '0','-',nama_rujukan_dokter)) as nama_dokter,op.nama_pegawai as perawate
		";
	//--------- Siapkan Parameter dari datatables ---------
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));
		$order = $this->input->post('order');
		$cari = $this->input->post('search');
	//--------- Cek kolom mana yg di urut dan asc/desc -----
		$col =$order[0]['column'];
		$dir= $order[0]['dir'];

	//--------- Ambil nama field dari daftar POST columns dttables
		$dt_kolom=$this->input->post('columns');

	//--------- Mulai Query UTAMA ---------------------------
		$this->db->select($fields);  //01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan [coding here]
/*					case 'id_pendaftaran' : $nmf="pd.id_pendaftaran";break;
				//	case 'rm' : $nmf="pd.rm";break;
					case 'nama_unit' : $nmf="u.nama_unit";break;
					case 'jk' : $nmf='ps.jk';break;
					case 'petugas' : $nmf='peg2.nama_pegawai';break;
				//	case 'umur' : $nmf='YEAR(CURDATE()) - YEAR(ps.tgl_lahir)';break;*/
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('pd.barcode_pasien',$ps['barcode_pasien']);
		$this->db->where("pendaftaran_instansi", $this->session->refer);		
		
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('pemeriksaan_vital_sign pvs');                   //04 Form.. left join
		$this->db->join('pendaftaran_unit pu', 'pu.barcode_pendaftaran_unit=pvs.barcode_pendaftaran_unit','left');
		$this->db->join('pendaftaran p', 'p.barcode_pendaftaran=pu.barcode_pendaftaran','left');
		$this->db->join('ol_pegawai op','op.id_pegawai=pvs.pembuat_pemeriksaan_vital_sign','left');
		$this->db->join('kol_cara_bayar cb','cb.id_cara_bayar=p.id_cara_bayar','left');
		$this->db->join('kol_detil_cara_bayar ka','ka.id_detil_cara_bayar=p.id_detil_cara_bayar','left');
		$this->db->join('kol_cara_masuk cm',  'cm.id_cara_masuk=p.id_cara_masuk','left');
		$this->db->join('kol_rujukan_dokter dr','dr.id_rujukan_dokter=p.id_dokter_rujukan','left');
		$this->db->join('kol_rujukan_instansi ir','ir.id_rujukan_instansi=p.id_instansi_cara_masuk','left');
		$this->db->join('ol_pegawai peg','peg.id_pegawai=pu.pembuat_pendaftaran_unit','left');
		$this->db->join('ol_pegawai peg1','peg1.id_pegawai=p.id_detil_cara_bayar','left');
		$this->db->join('ol_pegawai rapen','rapen.id_pegawai=p.id_dokter_rujukan','left');
		$this->db->join('ol_unit u1','u1.id_unit=p.id_instansi_cara_masuk','left');
		$this->db->where('waktu_pemeriksaan_vital_sign > NOW() - INTERVAL 3 YEAR');
		$this->db->where('p.barcode_pasien', $ps['barcode_pasien']);
		$this->db->where("pendaftaran_instansi", $this->session->refer);
		$this->db->order_by("waktu_pemeriksaan_vital_sign", "desc");
		
		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
/*					case 'id_pendaftaran' : $nmf="pd.id_pendaftaran";break;
				//	case 'rm' : $nmf="pd.rm";break;
					case 'nama_unit' : $nmf="u.nama_unit";break;
					case 'jk' : $nmf='ps.jk';break;
					case 'petugas' : $nmf='peg2.nama_pegawai';break;
				//	case 'umur' : $nmf='YEAR(CURDATE()) - YEAR(ps.tgl_lahir)';break;*/
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('pd.barcode_pasien',$ps['barcode_pasien']);
		$this->db->where("pendaftaran_instansi", $this->session->refer);			
		
			}
		  }
		}

		$this->db->from('pemeriksaan_vital_sign pvs');                   //04 Form.. left join
		$this->db->join('pendaftaran_unit pu', 'pu.barcode_pendaftaran_unit=pvs.barcode_pendaftaran_unit','left');
		$this->db->join('pendaftaran p', 'p.barcode_pendaftaran=pu.barcode_pendaftaran','left');
		$this->db->join('ol_pegawai op','op.id_pegawai=pvs.pembuat_pemeriksaan_vital_sign','left');
		$this->db->join('kol_cara_bayar cb','cb.id_cara_bayar=p.id_cara_bayar','left');
		$this->db->join('kol_detil_cara_bayar ka','ka.id_detil_cara_bayar=p.id_detil_cara_bayar','left');
		$this->db->join('kol_cara_masuk cm',  'cm.id_cara_masuk=p.id_cara_masuk','left');
		$this->db->join('kol_rujukan_dokter dr','dr.id_rujukan_dokter=p.id_dokter_rujukan','left');
		$this->db->join('kol_rujukan_instansi ir','ir.id_rujukan_instansi=p.id_instansi_cara_masuk','left');
		$this->db->join('ol_pegawai peg','peg.id_pegawai=pu.pembuat_pendaftaran_unit','left');
		$this->db->join('ol_pegawai peg1','peg1.id_pegawai=p.id_detil_cara_bayar','left');
		$this->db->join('ol_pegawai rapen','rapen.id_pegawai=p.id_dokter_rujukan','left');
		$this->db->join('ol_unit u1','u1.id_unit=p.id_instansi_cara_masuk','left');
		$this->db->where('waktu_pemeriksaan_vital_sign > NOW() - INTERVAL 3 YEAR');
		$this->db->where('p.barcode_pasien', $ps['barcode_pasien']);
		$this->db->where("pendaftaran_instansi", $this->session->refer);
		$this->db->order_by("waktu_pemeriksaan_vital_sign", "desc");		
		
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
	//	$kondisi=array('id_level !='=>'99');
	//	$jml = $this->m_umum->jumlah_record_filter('user',$kondisi);		//[coding here] ganti tabel utamanya
		$jml = $this->m_umum->jumlah_record_tabel('pemeriksaan_vital_sign');

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function ambil_data_pemeriksaan_format($id_tindakan,$id_radiolog){
		$this->db->where('id_dokter', $id_radiolog);
		$this->db->where('id_tindakan', $id_tindakan);
		$this->db->where('status_pemeriksaan_format', 1);
		$q = $this->db->get_where('pemeriksaan_format')->result_array();
		//echo $this->db->last_query();die();
		return $q;
	}
	function grafik_sparkling_line($id){
		$ps = $this->ambil_data_pasien($id);
		$this->db->select("sistole,diastole,rr,nadi,tb,bb,nadi,spo2,suhu");
		$this->db->join('pendaftaran_unit pu', 'pu.barcode_pendaftaran_unit=pvs.barcode_pendaftaran_unit','left');
		$this->db->join('pendaftaran pd', 'pd.barcode_pendaftaran=pu.barcode_pendaftaran','left');
		$this->db->where('waktu_pemeriksaan_vital_sign > NOW() - INTERVAL 3 YEAR');
		$this->db->where('pd.barcode_pasien', $ps['barcode_pasien']);
		$this->db->order_by('pvs.waktu_pemeriksaan_vital_sign', 'desc');
		$q = $this->db->get_where('pemeriksaan_vital_sign pvs')->result_array();
		//echo $this->db->last_query();die();
		return $q;
	}
	function grafik_garis($id){
		$ps = $this->ambil_data_pasien($id);
		$this->db->select("DATE_FORMAT(waktu_pemeriksaan_vital_sign,'%d-%m-%Y, %H:%i:%s') as waktu_pemeriksaan_vital,waktu_pemeriksaan_vital_sign,
			DATE_FORMAT(waktu_pemeriksaan_vital_sign,'%Y') as thn,DATE_FORMAT(waktu_pemeriksaan_vital_sign,'%m') as bln,DATE_FORMAT(waktu_pemeriksaan_vital_sign,'%d') as hr,DATE_FORMAT(waktu_pemeriksaan_vital_sign,'%H') as jam,DATE_FORMAT(waktu_pemeriksaan_vital_sign,'%i') as mnt,DATE_FORMAT(waktu_pemeriksaan_vital_sign,'%s') as dtk
			");
		$this->db->join('pendaftaran_unit pu', 'pu.barcode_pendaftaran_unit=pvs.barcode_pendaftaran_unit','left');
		$this->db->join('pendaftaran pd', 'pd.barcode_pendaftaran=pu.barcode_pendaftaran','left');
		$this->db->where('waktu_pemeriksaan_vital_sign > NOW() - INTERVAL 3 YEAR');
		$this->db->where('pd.barcode_pasien', $ps['barcode_pasien']);
	//	$this->db->where('sistole > 0 AND diastole > 0 AND rr > 0 AND nadi > 0 AND suhu > 0 AND spo2 > 0', NULL, FALSE);
		$this->db->group_by("DATE(waktu_pemeriksaan_vital_sign)");
		$q = $this->db->get_where('pemeriksaan_vital_sign pvs')->result_array();
		//echo $this->db->last_query();die();
		return $q;
	}
	function grafik_garis_hasil($tgl,$id){
		$ps = $this->ambil_data_pasien($id);
	//	$this->db->select("sld.id_limbah,hasil_lhu_detil,round(hasil_lhu_detil/total_lhu_detil*100,1) as prosen,nama_limbah");
	//	$this->db->select("sld.id_limbah,sum(hasil_lhu_detil) as hasil_lhu_detil");
		$this->db->join('pendaftaran_unit pu', 'pu.barcode_pendaftaran_unit=pvs.barcode_pendaftaran_unit','left');
		$this->db->join('pendaftaran pd', 'pd.barcode_pendaftaran=pu.barcode_pendaftaran','left');
		$this->db->where('pd.barcode_pasien', $ps['barcode_pasien']);
	//	$this->db->where('sistole > 0 OR diastole > 0 OR rr > 0 OR nadi > 0 OR suhu > 0 OR spo2 > 0', NULL, FALSE);
		$this->db->where('DATE(waktu_pemeriksaan_vital_sign)', date('Y-m-d', strtotime($tgl)));
	//	$this->db->group_by("sld.id_limbah,hasil_lhu_detil");
		$q = $this->db->get_where('pemeriksaan_vital_sign pvs')->result_array();
		//echo $this->db->last_query();die();
		return $q;
	}
	function ambil_pemeriksaan_dokter($id){
		$ps = $this->ambil_data_pasien($id);
		$this->db->select("*,DATE_FORMAT(waktu_pemeriksaan_dokter,'%d-%m-%Y %H:%i:%s') as waktu_pemeriksaan_dokter,
					cd1.nama_icd10 as cd1,cd2.nama_icd10 as cd2,cd3.nama_icd10 as cd3,op.nama_pegawai as dr_pemeriksa,
			DATE_FORMAT(tgl_pendaftaran_unit,'%d-%m-%Y %H:%i:%s') as tgl_pendaftaran_unit,op.nama_pegawai as perawate,
			if(p.id_cara_bayar = '6',concat('Karyawan : ',peg1.nama_pegawai),ka.nama_detil_cara_bayar) as nama_bayar,peg.nama_pegawai,
			if(p.id_cara_masuk = '7',u1.nama_unit,if(p.id_instansi_cara_masuk = '0','-',nama_rujukan_instansi)) as nama_instansi,
			if(p.id_cara_masuk = '7',rapen.nama_pegawai,if(p.id_dokter_rujukan = '0','-',nama_rujukan_dokter)) as nama_dokter	
			");
		$this->db->join('pendaftaran_unit pu', 'pu.barcode_pendaftaran_unit=pdr.barcode_pendaftaran_unit','left');
		$this->db->join('pendaftaran p', 'p.barcode_pendaftaran=pu.barcode_pendaftaran','left');
		$this->db->join('kol_cara_bayar cb','cb.id_cara_bayar=p.id_cara_bayar','left');
		$this->db->join('kol_detil_cara_bayar ka','ka.id_detil_cara_bayar=p.id_detil_cara_bayar','left');
		$this->db->join('kol_cara_masuk cm',  'cm.id_cara_masuk=p.id_cara_masuk','left');
		$this->db->join('kol_rujukan_dokter dr','dr.id_rujukan_dokter=p.id_dokter_rujukan','left');
		$this->db->join('kol_rujukan_instansi ir','ir.id_rujukan_instansi=p.id_instansi_cara_masuk','left');
		$this->db->join('ol_pegawai peg','peg.id_pegawai=pu.pembuat_pendaftaran_unit','left');
		$this->db->join('ol_pegawai peg1','peg1.id_pegawai=p.id_detil_cara_bayar','left');
		$this->db->join('ol_pegawai rapen','rapen.id_pegawai=p.id_dokter_rujukan','left');
		$this->db->join('ol_unit u1','u1.id_unit=p.id_instansi_cara_masuk','left');	
//		$this->db->join('ol_unit ou', 'ou.id_unit=pu.unit_ke','left');
		$this->db->join('ol_pegawai op', 'op.id_pegawai=pdr.id_dokter','left');
		$this->db->join('kol_icd10 cd1', 'cd1.id_icd10=pdr.id_icdten1','left');
		$this->db->join('kol_icd10 cd2', 'cd2.id_icd10=pdr.id_icdten2','left');
		$this->db->join('kol_icd10 cd3', 'cd3.id_icd10=pdr.id_icdten3','left');
		$this->db->where('p.barcode_pasien', $ps['barcode_pasien']);
		$this->db->order_by('waktu_pemeriksaan_dokter','desc');
		$q = $this->db->get('pemeriksaan_dokter pdr');	
		return $q->result_array();		
	}
	function ambil_pemeriksaan_laboratorium_pd($id){
		$this->db->join('tindakan t', 't.id_tindakan=lr.id_tindakan','left');
		$this->db->join('pemeriksaan pmr', 'pmr.barcode_pemeriksaan=lr.barcode_pemeriksaan','left');
		$this->db->join('pendaftaran_unit pu', 'pu.barcode_pendaftaran_unit=pmr.barcode_pendaftaran_unit','left');
		$this->db->join('pendaftaran pd', 'pd.barcode_pendaftaran=pu.barcode_pendaftaran','left');
		$this->db->where('lr.barcode_pemeriksaan', $id);
		$this->db->order_by('wkt_daftar','desc');
		$this->db->group_by('pu.barcode_pendaftaran');
		$q = $this->db->get('laboratorium_result lr');	
		return $q->result_array();		
	}
	function ambil_pemeriksaan_laboratorium_pu($id){
		$this->db->select("*,DATE_FORMAT(tgl_pendaftaran_unit,'%d-%m-%Y') as tgl_pendaftaran_unit
			");
		$this->db->join('tindakan t', 't.id_tindakan=lr.id_tindakan','left');
		$this->db->join('pemeriksaan pmr', 'pmr.barcode_pemeriksaan=lr.barcode_pemeriksaan','left');
		$this->db->join('pendaftaran_unit pu', 'pu.barcode_pendaftaran_unit=pmr.barcode_pendaftaran_unit','left');
		$this->db->join('pendaftaran pd', 'pd.barcode_pendaftaran=pu.barcode_pendaftaran','left');
		$this->db->where('lr.barcode_pemeriksaan', $id);
	//	$this->db->where('pu.barcode_pendaftaran', $idp);
		$this->db->order_by('wkt_daftar_unit','asc');
		$this->db->group_by('pmr.barcode_pendaftaran_unit');
		$q = $this->db->get('laboratorium_result lr');	
		return $q->result_array();		
	}
	function ambil_pemeriksaan_laboratorium($id,$kgp){
		$this->db->join('tindakan t', 't.id_tindakan=lr.id_tindakan','left');
		$this->db->join('laboratorium_format lf', 'lf.id_tindakan=t.id_tindakan','left');
		$this->db->join('pemeriksaan pmr', 'pmr.barcode_pemeriksaan=lr.barcode_pemeriksaan','left');
		$this->db->join('pendaftaran_unit pu', 'pu.barcode_pendaftaran_unit=pmr.barcode_pendaftaran_unit','left');
		$this->db->join('pendaftaran pd', 'pd.barcode_pendaftaran=pu.barcode_pendaftaran','left');
		$this->db->where('lr.barcode_pemeriksaan', $id);
		$this->db->where('t.id_golongan_pemeriksaan', $kgp);
	//	$this->db->where('pmr.barcode_pendaftaran_unit', $idp);
	//	$this->db->where('lr.id_instansi', $this->session->refer);
		$q = $this->db->get('laboratorium_result lr');	
		return $q->result_array();		
	}
	function ambil_pemeriksaan_laboratorium_pj($id){
		$this->db->join('ol_pegawai op', 'op.id_pegawai=lr.id_pj','left');
		$this->db->group_by('lr.id_pj');
		$q = $this->db->get_where('laboratorium_result lr',array('lr.barcode_pemeriksaan'=>$id));	
		return $q->result_array();		
	}
	function ambil_pemeriksaan_laboratorium_analis($id){	
		$this->db->join('pemeriksaan pmr', 'pmr.barcode_pemeriksaan=lr.barcode_pemeriksaan','left');
		$this->db->join('ol_pegawai op', 'op.id_pegawai=pmr.id_pegawai','left');
		$this->db->group_by('pmr.id_pegawai');
		$q = $this->db->get_where('laboratorium_result lr',array('lr.barcode_pemeriksaan'=>$id));	
		return $q->result_array();	
	}
	function ambil_pemeriksaan_laboratorium_kgp($id,$idp){
		$this->db->select("*
			");
		$this->db->join('tindakan t', 't.id_tindakan=lr.id_tindakan','left');
		$this->db->join('kol_golongan_pemeriksaan kgp', 'kgp.id_golongan_pemeriksaan=t.id_golongan_pemeriksaan','left');
		$this->db->join('pemeriksaan pmr', 'pmr.barcode_pemeriksaan=lr.barcode_pemeriksaan','left');
		$this->db->join('pendaftaran_unit pu', 'pu.barcode_pendaftaran_unit=pmr.barcode_pendaftaran_unit','left');
		$this->db->join('pendaftaran pd', 'pd.barcode_pendaftaran=pu.barcode_pendaftaran','left');
		$this->db->join('ol_pegawai op', 'op.id_pegawai=pmr.id_pegawai','left');
		$this->db->where('lr.barcode_pemeriksaan', $id);
		$this->db->where('pu.barcode_pendaftaran_unit', $idp);
		$this->db->group_by('t.id_golongan_pemeriksaan');
		$q = $this->db->get('laboratorium_result lr');	
		return $q->result_array();		
	}
	function ambil_pemeriksaan_plus_kgp($id){
		$this->db->select("
			id_tindakan_tarif,concat(nama_tindakan,' Kelas : ',nama_kelas,' - Rp.',harga_tindakan) as nama_tindakan
			");
		$this->db->join('tindakan t', 't.id_tindakan=tt.id_tindakan','left');
		$this->db->join('kol_golongan_pemeriksaan kgp', 'kgp.id_golongan_pemeriksaan=t.id_golongan_pemeriksaan','left');
		$this->db->join('kol_kelas kk', 'kk.id_kelas=tt.id_kelas','left');
		$this->db->where('kgp.id_unit', $id);
		$this->db->order_by('tt.id_kelas','asc');
		$q = $this->db->get('tindakan_tarif tt');	
		return $q->result_array();		
	}
	function asuhan_pengkajian($id){
		$this->db->where('id_pengkajian', $id);
		$this->db->where('status_pengkajian', 1);
		$q = $this->db->get('asuhan_pengkajian');	
		return $q->result_array();		
	}
	function asuhan_masalah($id){
		$this->db->where('id_masalah', $id);
		$this->db->where('status_masalah', 1);
		$q = $this->db->get('asuhan_masalah');	
		return $q->result_array();		
	}
	function asuhan_implementasi($id){
		$this->db->where('id_implementasi', $id);
		$this->db->where('status_implementasi', 1);
		$q = $this->db->get('asuhan_implementasi');	
		return $q->result_array();		
	}
	function asuhan_pengkajian_detil($id,$jml=FALSE,$no=FALSE){
		$this->db->where('id_pengkajian', $id);
		$this->db->where('status_kaji_detil', 1);
		if($jml!==FALSE || $no!==FALSE){
		$this->db->limit($jml, $no);}
		$q = $this->db->get('asuhan_kaji_detil');	
		return $q->result_array();		
	}
	function asuhan_masalah_detil($id){
		$this->db->where('id_masalah', $id);
		$this->db->where('status_mas_detil', 1);
		$q = $this->db->get('asuhan_mas_detil');	
		return $q->result_array();		
	}
	function asuhan_implementasi_detil($id,$jml=FALSE,$no=FALSE){
		$this->db->where('id_implementasi', $id);
		$this->db->where('status_imp_detil', 1);
		if($jml!==FALSE || $no!==FALSE){
		$this->db->limit($jml, $no);}
		$q = $this->db->get('asuhan_imp_detil');	
		return $q->result_array();		
	}
	function simpan_asuhan(){	
		$id_kaji_detil = $this->input->post('id_kaji_detil');
		if($id_kaji_detil){
			$id_kaji_detil = implode(',',$id_kaji_detil);
		}else{
			$id_kaji_detil = "";
		}
		$id_mas_detil = $this->input->post('id_mas_detil');
		if($id_mas_detil){
			$id_mas_detil = implode(',',$id_mas_detil);
		}else{
			$id_mas_detil = "";
		}
		$id_imp_detil = $this->input->post('id_imp_detil');
		if($id_imp_detil){
			$id_imp_detil = implode(',',$id_imp_detil);
		}else{
			$id_imp_detil = "";
		}
		$barcode_pendaftaran_unit = $this->input->post('barcode_pendaftaran_unit');
		$this->update_pendaftaran_unit(3,$barcode_pendaftaran_unit);
		$data_pendaftaran = array(
			'barcode_pendaftaran_unit' => $this->input->post('barcode_pendaftaran_unit'),					
			'rr_pemeriksaan_asuhan' => $this->input->post('rr_asuhan'),
			'rr_ritme' => $this->input->post('rr_ritme'),
			'sistole_pemeriksaan_asuhan' => $this->input->post('sistole_asuhan'),
			'diastole_pemeriksaan_asuhan' => $this->input->post('diastole_asuhan'),
			'gcs_pemeriksaan_asuhan' => $this->input->post('gcs_asuhan'),
			'eye_pemeriksaan_asuhan' => $this->input->post('eye_asuhan'),
			'ext_atas' => $this->input->post('ext_atas'),
			'ext_bawah' => $this->input->post('ext_bawah'),
			'motorik_pemeriksaan_asuhan' => $this->input->post('motorik_asuhan'),
			'verbal_pemeriksaan_asuhan' => $this->input->post('verbal_asuhan'),
			'diameter_pupil' => $this->input->post('diameter_pupil'),
			'breathingo2' => $this->input->post('breathingo2'),
			'disabilitygcs' => $this->input->post('disabilitygcs'),
			'disabilityo2' => $this->input->post('disabilityo2'),
			'id_kaji_detil' => $id_kaji_detil,
			'id_mas_detil' => $id_mas_detil,
			'id_imp_detil' => $id_imp_detil,
			'pembuat_pemeriksaan_asuhan' => $this->session->id_pegawai
		);
		return $this->db->insert('pemeriksaan_asuhan', $data_pendaftaran);
	}
/*	function ambil_data_ku($id){
		$this->db->order_by('waktu_pemeriksaan_ku','desc');
		$q = $this->db->get_where('pemeriksaan_ku pku',array('pku.barcode_pendaftaran'=>$id));
		return $q->result_array();
	}
	function timeline_pd($id)
	{
		$this->db->order_by("wkt_daftar", "desc");
	//	$this->db->limit(5,0);
		$q = $this->db->get_where('pendaftaran',array('barcode_pasien' => $id));
		return $q->result_array();		
	}
	function timeline_pu($id)
	{
		$this->db->select("*,DATE_FORMAT(wkt_daftar_unit,'%d-%m-%Y %H:%i:%s') as wkt_daftar_unit");
		$this->db->join('ol_unit u','u.id_unit=pendaftaran_unit.unit_ke','left');
		$this->db->order_by("wkt_daftar_unit", "asc");
		$q = $this->db->get_where('pendaftaran_unit',array('barcode_pendaftaran' => $id));
		return $q->result_array();		
	}*/
	function ambil_data_edit_pemeriksaan_clicked($id,$idj)
	{
		$this->db->select('nama_tindakan,barcode_tindakan_tarif');
		$this->db->join('tindakan','tindakan.id_tindakan=tindakan_tarif.id_tindakan','left');
		$this->db->join('kol_golongan_pemeriksaan','kol_golongan_pemeriksaan.id_golongan_pemeriksaan=tindakan.id_golongan_pemeriksaan','left');
		$query = $this->db->get_where('tindakan_tarif',array('id_kelas' => $id,'id_jabatan'=>$idj));
		return $query->result_array();
	}
	function ambil_data_edit_pemeriksaan($id)
	{
		$this->db->select('nama_tindakan,barcode_tindakan_tarif');
		$this->db->join('tindakan','tindakan.id_tindakan=tindakan_tarif.id_tindakan','left');
		$q = $this->db->get_where('tindakan_tarif',array('barcode_tindakan_tarif'=>$id))->result_array();
		$hasil= array_column($q,'nama_tindakan','barcode_tindakan_tarif');
		return $hasil;
	}
	function ambil_pemeriksaan(){
		$ids = explode(',', $this->session->mas_unit);
		$this->db->select("tindakan.id_tindakan,
			case when tarif IS NULL or tarif = ''
            then concat(nama_tindakan,'[ 0 ] - Kategori : ',nama_golongan_pemeriksaan)
            else concat(nama_tindakan,'[ ',tarif,' ] - Kategori : ',nama_golongan_pemeriksaan)
       		end as nama_tindakan 
			");
		$this->db->join('kol_golongan_pemeriksaan','kol_golongan_pemeriksaan.id_golongan_pemeriksaan=tindakan.id_golongan_pemeriksaan','left');
		$this->db->join('ol_unit','ol_unit.id_unit=kol_golongan_pemeriksaan.id_unit','left');
		$this->db->join('tindakan_tarif','tindakan_tarif.id_tindakan=tindakan.id_tindakan','left');
	    $this->db->where_in('coun_unit',$ids);
		$q = $this->db->get_where('tindakan',array('status_tindakan'=>1))->result_array();
		$hasil= array_column($q,'nama_tindakan','id_tindakan');
		return $hasil;
	}
	function ambil_row_pemeriksaan($id){
		//$ids = explode(',', $this->session->mas_unit);
		$this->db->select("tindakan.id_tindakan,
			concat(nama_tindakan,' - Kategori : ',nama_golongan_pemeriksaan) as nama_tindakan 
			");
		$this->db->join('kol_golongan_pemeriksaan','kol_golongan_pemeriksaan.id_golongan_pemeriksaan=tindakan.id_golongan_pemeriksaan','left');
		$this->db->join('ol_unit','ol_unit.id_unit=kol_golongan_pemeriksaan.id_unit','left');
		$this->db->join('tindakan_tarif','tindakan_tarif.id_tindakan=tindakan.id_tindakan','left');
	    //$this->db->where_in('coun_unit',$ids);
		$q = $this->db->get_where('tindakan',array('tindakan.id_tindakan'=>$id))->row_array();
		return $q;
	}
	function cmd_rm($id)
	{   
		$this->db->select("rm as data, CONCAT('[',rm,'] [',YEAR(CURDATE()) - YEAR(tgl_lahir),'] ',nama_pasien) as value, 
			nama_pasien, DATE_FORMAT(tgl_lahir,'%d-%m-%Y') as tgl_lahir, rm, jk, alamat");
        $this->db->like("rm", $id);
    //    $this->db->or_like("nama_pasien", $id);
        $this->db->limit('5,0');
        return $this->db->get_where('ol_pasien')->result_array();
	}
	function cmd_golongan_pemeriksaan(){
		$this->db->select("id_golongan_pemeriksaan,nama_golongan_pemeriksaan");
		$this->db->join('ol_unit','ol_unit.id_unit=kol_golongan_pemeriksaan.id_unit','left');
		$q = $this->db->get_where('kol_golongan_pemeriksaan',array('status_golongan_pemeriksaan'=>1,'ol_unit.id_instansi'=>$this->session->refer))->result_array();
		$hasil= array_column($q,'nama_golongan_pemeriksaan','id_golongan_pemeriksaan');
		return $hasil;
	}
	function ambil_golongan_pemeriksaan(){
		$mas_unit = explode(',', $this->session->mas_unit);
		$this->db->select("id_golongan_pemeriksaan,concat(nama_golongan_pemeriksaan,' - ',nama_unit) as nama_golongan_pemeriksaan");
		$this->db->join('ol_unit','ol_unit.id_unit=kol_golongan_pemeriksaan.id_unit','left');
		$this->db->where_in('coun_unit', $mas_unit);
		$q = $this->db->get_where('kol_golongan_pemeriksaan',array('status_golongan_pemeriksaan'=>1,'ol_unit.id_instansi'=>$this->session->refer))->result_array();
		$hasil= array_column($q,'nama_golongan_pemeriksaan','id_golongan_pemeriksaan');
		return $hasil;
	}
	function ambil_unit_transaksi()
	{
		$mas_unit = explode(',', $this->session->mas_unit);
		$this->db->select("id_unit,concat(nama_unit,' - ',nama_working) as nama_unit");
		$this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
		$this->db->where_in('coun_unit', $mas_unit);
		$q = $this->db->get_where('ol_unit ou',array('status_unit'=>1))->result_array();
		$hasil= array_column($q,'nama_unit','id_unit');
		return $hasil;
    }
	function ambil_tindakan_barang()
	{
		$mas_unit = explode(',', $this->session->mas_unit);
		$this->db->select("id_barang,concat(nama_barang,' - Satuan : ',satuan_barang,' - [',nama_kategori_barang,' - ',nama_unit,'] - ',nama_working) as nama_barang");
		$this->db->join('tindakan_kategori_barang', 'tindakan_kategori_barang.id_kategori_barang=tindakan_barang.id_kategori_barang','left');
		$this->db->join('ol_unit', 'ol_unit.id_unit=tindakan_kategori_barang.id_unit','left');
		$this->db->join('kol_working', 'kol_working.id_working=ol_unit.id_instansi','left');
		$this->db->where_in('coun_unit', $mas_unit);
		$q = $this->db->get_where('tindakan_barang',array('status_barang'=>1))->result_array();
		$hasil= array_column($q,'nama_barang','id_barang');
		return $hasil;
    }
	function ambil_kategori_barang()
	{
		$mas_unit = explode(',', $this->session->mas_unit);
		$this->db->select("id_kategori_barang,concat(nama_kategori_barang,' [',nama_unit,'] - ',nama_working) as nama_kategori_barang");
		$this->db->join('ol_unit', 'ol_unit.id_unit=tindakan_kategori_barang.id_unit','left');
		$this->db->join('kol_working', 'kol_working.id_working=ol_unit.id_instansi','left');
		$this->db->where_in('coun_unit', $mas_unit);
		$q = $this->db->get_where('tindakan_kategori_barang',array('status_kategori_barang'=>1))->result_array();
		$hasil= array_column($q,'nama_kategori_barang','id_kategori_barang');
		return $hasil;
    }
	function ambil_data_unit_no_null()	//daftar.php pasien
	{
		$mas_unit = explode(',', $this->session->mas_unit);
		$this->db->select("nama_unit,id_unit");
		$this->db->where_in('coun_unit', $mas_unit);
		$query = $this->db->get_where('ol_unit',array('id_instansi' => $this->session->refer,'status_unit'=>1))->result_array();
		$q= array_column($query,'nama_unit','id_unit');
		return $q;
	}
	function cmd_golongan_pemeriksaan_null(){
		$this->db->select("id_golongan_pemeriksaan,nama_golongan_pemeriksaan");
		$this->db->join('ol_unit','ol_unit.id_unit=kol_golongan_pemeriksaan.id_unit','left');
		$q = $this->db->get_where('kol_golongan_pemeriksaan',array('status_golongan_pemeriksaan'=>1,'ol_unit.id_instansi'=>$this->session->refer))->result_array();
		return $q;
	}
	function cmd_tindakan(){
		$this->db->select("id_tindakan, concat(nama_tindakan,' [ ',nama_golongan_pemeriksaan,'] ') as nama_tindakan");
		$this->db->join('kol_golongan_pemeriksaan', 'kol_golongan_pemeriksaan.id_golongan_pemeriksaan=tindakan.id_golongan_pemeriksaan','left');
		$q = $this->db->get_where('tindakan',array('tindakan.status_tindakan'=>1,'kol_golongan_pemeriksaan.id_unit'=>$this->session->unit))->result_array();
		$hasil= array_column($q,'nama_tindakan','id_tindakan');
		return $hasil;
	}
	function cmd_rujukan_dokter(){
		$this->db->select("id_rujukan_dokter, nama_rujukan_dokter");
		$q = $this->db->get_where('kol_rujukan_dokter',array('id_instansi'=>$this->session->refer))->result_array();
		$hasil= array_column($q,'nama_rujukan_dokter','id_rujukan_dokter');
		return $hasil;
	}
	function ambil_data_tindakan_katbarang(){
		$mas_unit = explode(',', $this->session->mas_ins);
		$this->db->select("id_kategori_barang,
			case when status_kategori_barang = '0'
            then concat('<b>',nama_kategori_barang,'</b> - ',nama_unit,' - Status NON AKTIF<br>',nama_working)
            else concat('<b>',nama_kategori_barang,'</b> - ',nama_unit,' - Status AKTIF<br>',nama_working)
       		end as nama_kategori_barang 
			");
		$this->db->join('ol_unit','ol_unit.id_unit=tindakan_kategori_barang.id_unit','left');
		$this->db->join('kol_working','kol_working.id_working=ol_unit.id_instansi','left');
		$this->db->where_in('id_instansi', $mas_unit);
		$q = $this->db->get_where('tindakan_kategori_barang')->result_array();
		return $q;
	}
	function ambil_data_tindakan_barang(){
		$mas_unit = explode(',', $this->session->mas_ins);
		$this->db->select("id_barang,
			case when status_barang = '0'
            then concat('<b>',nama_barang,'</b><br>',nama_kategori_barang,' - ',nama_unit,' - Status NON AKTIF<br>',nama_working)
            else concat('<b>',nama_barang,'</b><br>',nama_kategori_barang,' - ',nama_unit,' - Status AKTIF<br>',nama_working)
       		end as nama_barang 
			");
		$this->db->join('tindakan_kategori_barang','tindakan_kategori_barang.id_kategori_barang=tindakan_barang.id_kategori_barang','left');
		$this->db->join('ol_unit','ol_unit.id_unit=tindakan_kategori_barang.id_unit','left');
		$this->db->join('kol_working','kol_working.id_working=ol_unit.id_instansi','left');
		$this->db->where_in('id_instansi', $mas_unit);
		$q = $this->db->get_where('tindakan_barang')->result_array();
		return $q;
	}
	function ambil_data_tindakan_hasil(){
		$mas_unit = explode(',', $this->session->mas_ins);
		$this->db->select("id_hasil,
			case when status_hasil = '0'
            then concat('<b>',nama_hasil,'</b> - ',nama_unit,' - Status NON AKTIF<br>',nama_working)
            else concat('<b>',nama_hasil,'</b> - ',nama_unit,' - Status AKTIF<br>',nama_working)
       		end as nama_hasil 
			");
		$this->db->join('ol_unit','ol_unit.id_unit=tindakan_hasil.id_unit','left');
		$this->db->join('kol_working','kol_working.id_working=ol_unit.id_instansi','left');
		$this->db->where_in('id_instansi', $mas_unit);
		$q = $this->db->get_where('tindakan_hasil')->result_array();
		return $q;
	}
	function ambil_stok_barang(){
		$mas_unit = explode(',', $this->session->mas_ins);
		$this->db->select("tindakan_stok.id_barang,id_stok,jml_stok,
			case when status_barang = '0'
            then concat('<b>',nama_barang,'</b><br>',nama_kategori_barang,' - ',nama_unit,' - Status NON AKTIF<br>',nama_working)
            else concat('<b>',nama_barang,'</b><br>',nama_kategori_barang,' - ',nama_unit,' - Status AKTIF<br>',nama_working)
       		end as nama_barang 
			");
		$this->db->join('tindakan_barang','tindakan_barang.id_barang=tindakan_stok.id_barang','left');
		$this->db->join('tindakan_kategori_barang','tindakan_kategori_barang.id_kategori_barang=tindakan_barang.id_kategori_barang','left');
		$this->db->join('ol_unit','ol_unit.id_unit=tindakan_kategori_barang.id_unit','left');
		$this->db->join('kol_working','kol_working.id_working=ol_unit.id_instansi','left');
		$this->db->where_in('id_instansi', $mas_unit);
		$q = $this->db->get_where('tindakan_stok')->result_array();
		return $q;
	}
	function ambil_data_tindakan_operator($id){
		$this->db->join('ol_pegawai','ol_pegawai.barcode_pegawai=tindakan_operator.admin_operator','left');
		$this->db->join('jabatan_fungsional','jabatan_fungsional.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
		$this->db->where('id_transaksi', $id);
		$q = $this->db->get_where('tindakan_operator')->result_array();
		return $q;
	}
	function ambil_data_barang_keluar($id)
	{
		$this->db->join('tindakan_barang','tindakan_barang.id_barang=tindakan_keluar.id_barang','left');
		$this->db->join('tindakan_kategori_barang','tindakan_kategori_barang.id_kategori_barang=tindakan_barang.id_kategori_barang','left');
		$q = $this->db->get_where('tindakan_keluar',array('id_transaksi'=>$id))->result_array();
		return $q;
	}
	function ambil_data_tindakan_kelengkapan($id)
	{
		$this->db->join('tindakan_hasil','tindakan_hasil.id_hasil=tindakan_kelengkapan.id_hasil','left');
		$q = $this->db->get_where('tindakan_kelengkapan',array('id_transaksi'=>$id))->result_array();
		return $q;
	}
	function ambil_data_operator_kw($id){
		$this->db->join('ol_pegawai','ol_pegawai.barcode_pegawai=tindakan_operator.admin_operator','left');
		$this->db->join('jabatan_fungsional','jabatan_fungsional.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
		$this->db->where('id_operator', $id);
		$q = $this->db->get_where('tindakan_operator')->row_array();
		return $q;
	}
	function ambil_data_pegawai_operator($id)
	{
		$this->db->select("nama_pegawai,barcode_pegawai");
		$this->db->join('ol_pegawai','ol_pegawai.id_pegawai=ol_user.id_pegawai','left');
		$this->db->where('find_in_set("'.$id.'", mas_unit) != 0');
		$this->db->order_by("nama_pegawai","asc");
		$q = $this->db->get_where('ol_user',array('status_pegawai'=>1,'visible'=>1,'status_user'=>1))->result_array();
		$hasil= array_column($q,'nama_pegawai','barcode_pegawai');
		return $hasil;
	}
	function ambil_data_stok_barang($id)
	{
		$this->db->select("concat(nama_barang,' - Stok : ',jml_stok) as nama_barang,tindakan_stok.id_barang");
		$this->db->join('tindakan_barang','tindakan_barang.id_barang=tindakan_stok.id_barang','left');
		$this->db->join('tindakan_kategori_barang','tindakan_kategori_barang.id_kategori_barang=tindakan_barang.id_kategori_barang','left');
		$this->db->order_by("nama_barang","asc");
		$q = $this->db->get_where('tindakan_stok',array('status_barang'=>1,'id_unit'=>$id))->result_array();
		$hasil= array_column($q,'nama_barang','id_barang');
		return $hasil;
	}
	function ambil_tindakan_kelengkapan($id)
	{
		$this->db->select("nama_hasil,id_hasil");
		$this->db->order_by("nama_hasil","asc");
		$q = $this->db->get_where('tindakan_hasil',array('id_unit'=>$id,'status_hasil'=>1))->result_array();
		$hasil= array_column($q,'nama_hasil','id_hasil');
		return $hasil;
	}
	function ambil_data_pegawai_operator_null($id)
	{
		$this->db->join('ol_pegawai','ol_pegawai.id_pegawai=ol_user.id_pegawai','left');
		$this->db->where('find_in_set("'.$id.'", mas_unit) != 0');
		$this->db->order_by("nama_pegawai","asc");
		$q = $this->db->get_where('ol_user',array('status_pegawai'=>1,'visible'=>1,'status_user'=>1))->result_array();
		return $q;
	}
	function ambil_data_operator(){
  		$mas_unit = explode(',', $this->session->mas_unit);
		$this->db->select("ol_pegawai.id_pegawai,barcode_pegawai,
			concat('<b>',nama_pegawai,'</b> - JabFung : <b>',nama_jabatan_fungsional,'</b> - Unit : <b>',nama_unit,'</b>') as nama_pegawai 
			");
  		$this->db->join('ol_pegawai','ol_pegawai.id_pegawai=ol_user.id_pegawai','left');
  		$this->db->join('ol_unit','ol_unit.id_unit=ol_user.unit','left');
  		$this->db->join('jabatan_fungsional','jabatan_fungsional.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
	//	$this->db->where_in('coun_unit', $mas_unit);
	//	$this->db->where_in('mas_unit', $this->session->mas_unit);
	//	$this->db->where('find_in_set("'.$this->session->mas_unit.'", mas_unit) <> 0');
		$q = $this->db->get_where('ol_user',array('status_pegawai'=>1,'status_user'=>1,'id_instansi'=>$this->session->refer))->result_array();
	//	echo $this->db->last_query();die();
		return $q;
	}
	function ambil_data_tindakan_kewenangan($id,$il){
		$this->db->join('ol_logbook','ol_logbook.id_logbook=tindakan_kewenangan.id_logbook','left');
		$this->db->join('nkr_kewenangan','nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');
		$this->db->join('nkr_kompetensi','nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
		$this->db->where('id_operator', $id);
		$this->db->where('id_logbooker', $il);
		$q = $this->db->get_where('tindakan_kewenangan')->result_array();
		return $q;
	}
	function ambil_data_tindakan_fhasil($id){
		$this->db->join('tindakan_hasil','tindakan_hasil.id_hasil=tindakan_fhasil.id_hasil','left');
		$q = $this->db->get_where('tindakan_fhasil',array('tindakan_fhasil.id_hasil'=>$id))->result_array();
		return $q;
	}
function ambil_data_laporan_detil($id){
$this->db->join('ol_laporan', 'ol_laporan.id_laporan=ol_laporan_detil.id_laporan','left');
//$this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_laporan_detil.id_equipment','left');
$this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=ol_laporan.pembuat_laporan','left');
$this->db->join('ol_unit', 'ol_unit.id_unit=ol_laporan.laporan_unit','left');
$q = $this->db->get_where('ol_laporan_detil',array('ol_laporan_detil.id_laporan_detil'=>$id));
return $q->row_array();
}
function ambil_data_per_laporan_detil($id){
$this->db->join('ol_per_laporan', 'ol_per_laporan.id_laporan=ol_per_laporan_detil.id_laporan','left');
//$this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_per_laporan_detil.id_equipment','left');
$this->db->join('ol_pegawai', 'ol_pegawai.barcode_pegawai=ol_per_laporan.pembuat_laporan','left');
$this->db->join('ol_unit', 'ol_unit.id_unit=ol_per_laporan.laporan_unit','left');
$q = $this->db->get_where('ol_per_laporan_detil',array('ol_per_laporan_detil.id_laporan_detil'=>$id));
return $q->row_array();
}
	function ambil_data_pengajuan_signature($id)
	{
		$this->db->join('ol_pengajuan op', 'op.barcode_pengajuan=ops.barcode_pengajuan','left');
		$this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=op.barcode_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
		$q = $this->db->get_where('ol_pengajuan_signature ops',array('ops.id_signature'=>$id));
		return $q->row_array();
	}
	function kewenangan_kompetensi($kondisi,$source,$comma,$order,$asc,$grup=FALSE)
	{
		$ids = explode(',', $comma);
		$this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
		$this->db->where_in($source,$ids);
		if($grup){
			$this->db->group_by($grup);
		}
		$this->db->order_by($order,$asc);
		$q = $this->db->get_where('nkr_kewenangan',$kondisi);
		//print_r($q->row_array());
		return $q->result_array();
	}
}