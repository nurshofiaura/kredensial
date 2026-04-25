<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Model extends CI_Model
{
    protected $table;
    protected $pk = 'id';

    public function __construct()
    {
        parent::__construct();
    }

// ============================================================
// MAIN ENGINE DATATABLE SERVER SIDE (FULL COMPATIBLE)
// ============================================================
public function datatable_engine($dt, $columns, $baseQueryCallback, $extra = [])
{
    $draw   = intval($dt['draw'] ?? 1);
    $start  = intval($dt['start'] ?? 0);
    $length = intval($dt['length'] ?? 10);

    if ($length <= 0) $length = 10;

    // ============================
    // SEARCH INPUT COMPATIBLE
    // ============================
    $search = $dt['search'] ?? '';

    // kalau datatable lama kirim string
    if (is_string($search)) {
        $search = ['value' => $search];
    }

    if (!is_array($search)) {
        $search = ['value' => ''];
    }

    $searchValue = $search['value'] ?? '';

    // ============================
    // ORDER INPUT COMPATIBLE
    // ============================
    $orderIndex = $dt['order'][0]['column'] ?? 0;
    $orderDir   = $dt['order'][0]['dir'] ?? 'asc';

    $orderDir = strtolower($orderDir) === 'desc' ? 'desc' : 'asc';

    // kolom order berdasarkan index
    $orderCol = $columns[$orderIndex] ?? null;

    // ============================
    // DATATABLE COLUMNS REQUEST
    // ============================
    $dtCols = $dt['columns'] ?? [];

    // ============================
    // DATA QUERY
    // ============================
    $this->db->reset_query();

    if (is_callable($baseQueryCallback)) {
        call_user_func($baseQueryCallback, $this->db);
    }

    $this->datatable_apply_extra($extra);

    // apply search global + column search
    $this->datatable_apply_search_nullsafe($columns, $search, $dtCols);

    // ============================
    // ORDER BY
    // ============================
    if (!empty($extra['order_by']) && is_array($extra['order_by'])) {

        foreach ($extra['order_by'] as $ob) {
            if (!empty($ob['col'])) {
                $dir = (!empty($ob['dir']) && strtolower($ob['dir']) == 'desc') ? 'desc' : 'asc';
                $this->db->order_by($ob['col'], $dir);
            }
        }

    } else {

        // order dari request datatable
        if (!empty($orderCol)) {
            $this->db->order_by($orderCol, $orderDir);
        }
    }

    // ============================
    // LIMIT PAGINATION
    // ============================
    $this->db->limit($length, $start);

    $data = $this->db->get()->result_array();

    // ============================
    // FILTERED COUNT
    // ============================
    $this->db->reset_query();

    if (is_callable($baseQueryCallback)) {
        call_user_func($baseQueryCallback, $this->db);
    }

    $this->datatable_apply_extra($extra);

    $this->datatable_apply_search_nullsafe($columns, $search, $dtCols);

    $filtered = $this->datatable_count_safe();

    // ============================
    // TOTAL COUNT
    // ============================
    $this->db->reset_query();

    if (is_callable($baseQueryCallback)) {
        call_user_func($baseQueryCallback, $this->db);
    }

    $this->datatable_apply_extra($extra);

    $total = $this->datatable_count_safe();

    return [
        'draw'     => $draw,
        'data'     => $data,
        'total'    => $total,
        'filtered' => $filtered
    ];
}


// ============================================================
// APPLY EXTRA FILTER (WHERE, LIKE, GROUP, HAVING, DISTINCT, ETC)
// ============================================================
public function datatable_apply_extra($extra = [])
{
    if (empty($extra) || !is_array($extra)) return;

    // distinct
    if (!empty($extra['distinct'])) {
        $this->db->distinct();
    }

    // select injection
    if (!empty($extra['select'])) {
        if (is_array($extra['select'])) {
            foreach ($extra['select'] as $sel) {
                $this->db->select($sel, false);
            }
        } else {
            $this->db->select($extra['select'], false);
        }
    }

    // join injection
    if (!empty($extra['joins']) && is_array($extra['joins'])) {
        foreach ($extra['joins'] as $j) {
            if (!empty($j['table']) && !empty($j['on'])) {
                $type = $j['type'] ?? 'left';
                $this->db->join($j['table'], $j['on'], $type);
            }
        }
    }

    // where
    if (!empty($extra['where']) && is_array($extra['where'])) {
        foreach ($extra['where'] as $k => $v) {
            $this->db->where($k, $v);
        }
    }

    // or_where
    if (!empty($extra['or_where']) && is_array($extra['or_where'])) {
        foreach ($extra['or_where'] as $k => $v) {
            $this->db->or_where($k, $v);
        }
    }

    // where_in
    if (!empty($extra['where_in']) && is_array($extra['where_in'])) {
        foreach ($extra['where_in'] as $k => $arr) {
            if (!empty($arr) && is_array($arr)) {
                $this->db->where_in($k, $arr);
            }
        }
    }

    // or_where_in
    if (!empty($extra['or_where_in']) && is_array($extra['or_where_in'])) {
        foreach ($extra['or_where_in'] as $k => $arr) {
            if (!empty($arr) && is_array($arr)) {
                $this->db->or_where_in($k, $arr);
            }
        }
    }

    // like
    if (!empty($extra['like']) && is_array($extra['like'])) {
        foreach ($extra['like'] as $k => $v) {
            $this->db->like($k, $v);
        }
    }

    // or_like
    if (!empty($extra['or_like']) && is_array($extra['or_like'])) {
        foreach ($extra['or_like'] as $k => $v) {
            $this->db->or_like($k, $v);
        }
    }

    // raw where
    if (!empty($extra['raw']) && is_array($extra['raw'])) {
        foreach ($extra['raw'] as $raw) {
            if (!empty($raw)) {
                $this->db->where($raw, null, false);
            }
        }
    }

    // nested group_start / or_group_start
    if (!empty($extra['groups']) && is_array($extra['groups'])) {
        $this->datatable_apply_groups($extra['groups']);
    }

    // group_by
    if (!empty($extra['group_by'])) {
        if (is_array($extra['group_by'])) {
            foreach ($extra['group_by'] as $gb) {
                $this->db->group_by($gb);
            }
        } else {
            $this->db->group_by($extra['group_by']);
        }
    }

    // having
    if (!empty($extra['having']) && is_array($extra['having'])) {
        foreach ($extra['having'] as $k => $v) {
            $this->db->having($k, $v);
        }
    }

    // or_having
    if (!empty($extra['or_having']) && is_array($extra['or_having'])) {
        foreach ($extra['or_having'] as $k => $v) {
            $this->db->or_having($k, $v);
        }
    }
}


// ============================================================
// APPLY GROUPS (CURVED BRACKET NESTED)
// ============================================================
private function datatable_apply_groups($groups)
{
    foreach ($groups as $g) {

        if (empty($g['type'])) continue;

        $type = $g['type'];

        // start groups
        if ($type === 'group_start') {
            $this->db->group_start();
        } elseif ($type === 'or_group_start') {
            $this->db->or_group_start();
        } elseif ($type === 'not_group_start') {
            $this->db->not_group_start();
        } elseif ($type === 'or_not_group_start') {
            $this->db->or_not_group_start();
        }

        // if group has items
        if (!empty($g['items']) && is_array($g['items'])) {

            foreach ($g['items'] as $item) {

                if (empty($item['type'])) continue;

                // recursion group
                if (in_array($item['type'], [
                    'group_start',
                    'or_group_start',
                    'not_group_start',
                    'or_not_group_start'
                ])) {
                    $this->datatable_apply_groups([$item]);
                    continue;
                }

                $t = $item['type'];

                if ($t === 'where') {
                    $this->db->where($item['field'], $item['value']);
                }
                elseif ($t === 'or_where') {
                    $this->db->or_where($item['field'], $item['value']);
                }
                elseif ($t === 'where_in') {
                    $this->db->where_in($item['field'], $item['value']);
                }
                elseif ($t === 'or_where_in') {
                    $this->db->or_where_in($item['field'], $item['value']);
                }
                elseif ($t === 'like') {
                    $this->db->like($item['field'], $item['value']);
                }
                elseif ($t === 'or_like') {
                    $this->db->or_like($item['field'], $item['value']);
                }
                elseif ($t === 'raw') {
                    $this->db->where($item['value'], null, false);
                }
                elseif ($t === 'having') {
                    $this->db->having($item['field'], $item['value']);
                }
                elseif ($t === 'or_having') {
                    $this->db->or_having($item['field'], $item['value']);
                }
            }
        }

        // close group
        if (in_array($type, [
            'group_start',
            'or_group_start',
            'not_group_start',
            'or_not_group_start'
        ])) {
            $this->db->group_end();
        }
    }
}


// ============================================================
// APPLY SEARCH (GLOBAL + COLUMN) NULLSAFE
// columns boleh ada NULL / ''
// ============================================================
protected function datatable_apply_search_nullsafe($columns, $search, $dtCols = [])
{
    // ============================
    // NORMALIZE SEARCH
    // ============================
    if (is_string($search)) {
        $search = ['value' => $search];
    }

    if (!is_array($search)) {
        $search = ['value' => ''];
    }

    $globalValue = trim($search['value'] ?? '');

    // ============================
    // GLOBAL SEARCH
    // ============================
    if ($globalValue !== '') {

        $this->db->group_start();

        foreach ($columns as $col) {

            if ($col === null || $col === '') continue;

            // skip aggregate
            if (stripos($col, 'COUNT(') !== false) continue;
            if (stripos($col, 'SUM(') !== false) continue;

            $this->db->or_like($col, $globalValue);
        }

        $this->db->group_end();
    }

    // ============================
    // COLUMN SEARCH (tfoot)
    // ============================
    if (!empty($dtCols) && is_array($dtCols)) {

        foreach ($dtCols as $i => $colInfo) {

            $val = trim($colInfo['search']['value'] ?? '');

            // kalau kosong skip
            if ($val === '') continue;

            // kalau column mapping kosong/null skip
            if (!isset($columns[$i])) continue;
            if ($columns[$i] === null || $columns[$i] === '') continue;

            $this->db->like($columns[$i], $val);
        }
    }
}


// ============================================================
// SAFE COUNT FOR GROUP BY / HAVING / DISTINCT
// ============================================================
public function datatable_count_safe()
{
    $sql = $this->db->get_compiled_select();

    $countSQL = "SELECT COUNT(*) AS total_rows FROM ($sql) AS dt_count";

    $query = $this->db->query($countSQL);
    $row = $query->row_array();

    return intval($row['total_rows'] ?? 0);
}


/*
controller
public function save()
{
    $data = $this->input->post();
    $result = $this->My_model->insert($data);
    echo json_encode($result);
}
Contoh di JavaScript (SweetAlert2)
$.ajax({
    url: '/save',
    method: 'POST',
    data: $('#form').serialize(),
    dataType: 'json',
    success: function (res) {
        Swal.fire({
            icon: res.status === 'sukses' ? 'success' : 'error',
            title: res.status === 'sukses' ? 'Berhasil' : 'Gagal',
            text: res.message
        });

        if (res.status === 'sukses') {
            // misal reload table
            location.reload();
        }
    }
});
Sedikit Saran Biar Lebih “SweetAlert-ready”
Kalau mau lebih rapi, kamu bisa samakan nama status dengan icon SweetAlert2:
protected function success($msg)
{
    return [
        'status'  => 'success',
        'message' => $msg
    ];
}

protected function fail($msg)
{
    return [
        'status'  => 'error',
        'message' => $msg
    ];
}
Lalu JS jadi super simpel:
Swal.fire({
    icon: res.status,
    text: res.message
});

public function save()
{
    $result = $this->My_model->insert($this->input->post());
    $this->json($result);
}
$('#form').on('submit', function (e) {
    e.preventDefault();

    $.ajax({
        url: '<?= site_url("user/save") ?>',
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function (res) {

            Swal.fire({
                icon: res.status,      // success | error
                title: res.status === 'success' ? 'Berhasil' : 'Gagal',
                text: res.message
            });

            if (res.status === 'success') {
                // contoh aksi setelah sukses
                $('#form')[0].reset();
            }
        },
        error: function () {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Server tidak merespon'
            });
        }
    });
});
*/
    // ============================================================
    // MAIN ENGINE DATATABLE SERVER SIDE
    // ============================================================
/*    public function datatable_engine($dt, $columns, $baseQueryCallback, $extra = [])
    {
        $draw   = intval($dt['draw'] ?? 1);
        $start  = intval($dt['start'] ?? 0);
        $length = intval($dt['length'] ?? 10);

        if ($length <= 0) $length = 10;

        $searchValue = $dt['search']['value'] ?? '';
        $orderIndex  = $dt['order'][0]['column'] ?? 0;
        $orderDir    = $dt['order'][0]['dir'] ?? 'asc';

        // fallback
        $orderDir = strtolower($orderDir) === 'desc' ? 'desc' : 'asc';

        $orderCol = $columns[$orderIndex] ?? null;

        // ============================
        // DATA QUERY
        // ============================
        $this->db->reset_query();

        if (is_callable($baseQueryCallback)) {
            call_user_func($baseQueryCallback, $this->db);
        }

        $this->datatable_apply_extra($extra);

        // search
        if (!empty($searchValue)) {
         //   $this->datatable_search($columns, $searchValue, $dt['cols'] ?? []);
            $this->datatable_search($columns, $searchValue, $dt['columns'] ?? []);
        }

        // order by override
        if (!empty($extra['order_by']) && is_array($extra['order_by'])) {
            foreach ($extra['order_by'] as $ob) {
                if (!empty($ob['col'])) {
                    $dir = (!empty($ob['dir']) && strtolower($ob['dir']) == 'desc') ? 'desc' : 'asc';
                    $this->db->order_by($ob['col'], $dir);
                }
            }
        } else {
            if (!empty($orderCol)) {
                $this->db->order_by($orderCol, $orderDir);
            }
        }

        // limit
        $this->db->limit($length, $start);

        $data = $this->db->get()->result_array();

        // ============================
        // FILTERED COUNT (AMAN GROUP BY)
        // ============================
        $this->db->reset_query();

        if (is_callable($baseQueryCallback)) {
            call_user_func($baseQueryCallback, $this->db);
        }

        $this->datatable_apply_extra($extra);

        if (!empty($searchValue)) {
        //    $this->datatable_search($columns, $searchValue, $dt['cols'] ?? []);
            $this->datatable_search($columns, $searchValue, $dt['columns'] ?? []);
        }

        $filtered = $this->datatable_count_safe();

        // ============================
        // TOTAL COUNT (AMAN GROUP BY)
        // ============================
        $this->db->reset_query();

        if (is_callable($baseQueryCallback)) {
            call_user_func($baseQueryCallback, $this->db);
        }

        $this->datatable_apply_extra($extra);

        $total = $this->datatable_count_safe();

        return [
            'draw'     => $draw,
            'data'     => $data,
            'total'    => $total,
            'filtered' => $filtered
        ];
    }

    // ============================================================
    // APPLY EXTRA FILTER (WHERE, LIKE, GROUP, HAVING, DISTINCT, ETC)
    // ============================================================
    public function datatable_apply_extra($extra = [])
    {
        if (empty($extra) || !is_array($extra)) return;

        // distinct
        if (!empty($extra['distinct'])) {
            $this->db->distinct();
        }

        // select injection
        if (!empty($extra['select'])) {
            if (is_array($extra['select'])) {
                foreach ($extra['select'] as $sel) {
                    $this->db->select($sel, false);
                }
            } else {
                $this->db->select($extra['select'], false);
            }
        }

        // join injection
        if (!empty($extra['joins']) && is_array($extra['joins'])) {
            foreach ($extra['joins'] as $j) {
                if (!empty($j['table']) && !empty($j['on'])) {
                    $type = $j['type'] ?? 'left';
                    $this->db->join($j['table'], $j['on'], $type);
                }
            }
        }

        // where
        if (!empty($extra['where']) && is_array($extra['where'])) {
            foreach ($extra['where'] as $k => $v) {
                $this->db->where($k, $v);
            }
        }

        // or_where
        if (!empty($extra['or_where']) && is_array($extra['or_where'])) {
            foreach ($extra['or_where'] as $k => $v) {
                $this->db->or_where($k, $v);
            }
        }

        // where_in
        if (!empty($extra['where_in']) && is_array($extra['where_in'])) {
            foreach ($extra['where_in'] as $k => $arr) {
                if (!empty($arr) && is_array($arr)) {
                    $this->db->where_in($k, $arr);
                }
            }
        }

        // or_where_in
        if (!empty($extra['or_where_in']) && is_array($extra['or_where_in'])) {
            foreach ($extra['or_where_in'] as $k => $arr) {
                if (!empty($arr) && is_array($arr)) {
                    $this->db->or_where_in($k, $arr);
                }
            }
        }

        // like
        if (!empty($extra['like']) && is_array($extra['like'])) {
            foreach ($extra['like'] as $k => $v) {
                $this->db->like($k, $v);
            }
        }

        // or_like
        if (!empty($extra['or_like']) && is_array($extra['or_like'])) {
            foreach ($extra['or_like'] as $k => $v) {
                $this->db->or_like($k, $v);
            }
        }

        // raw where
        if (!empty($extra['raw']) && is_array($extra['raw'])) {
            foreach ($extra['raw'] as $raw) {
                if (!empty($raw)) {
                    $this->db->where($raw, null, false);
                }
            }
        }

        // nested group_start / or_group_start
        if (!empty($extra['groups']) && is_array($extra['groups'])) {
            $this->datatable_apply_groups($extra['groups']);
        }

        // group_by
        if (!empty($extra['group_by'])) {
            if (is_array($extra['group_by'])) {
                foreach ($extra['group_by'] as $gb) {
                    $this->db->group_by($gb);
                }
            } else {
                $this->db->group_by($extra['group_by']);
            }
        }

        // having
        if (!empty($extra['having']) && is_array($extra['having'])) {
            foreach ($extra['having'] as $k => $v) {
                $this->db->having($k, $v);
            }
        }

        // or_having
        if (!empty($extra['or_having']) && is_array($extra['or_having'])) {
            foreach ($extra['or_having'] as $k => $v) {
                $this->db->or_having($k, $v);
            }
        }
    }

    // ============================================================
    // APPLY GROUPS (CURVED BRACKET NESTED)
    // ============================================================
    private function datatable_apply_groups($groups)
    {
        foreach ($groups as $g) {

            if (empty($g['type'])) continue;

            $type = $g['type'];

            // start groups
            if ($type === 'group_start') {
                $this->db->group_start();
            } elseif ($type === 'or_group_start') {
                $this->db->or_group_start();
            } elseif ($type === 'not_group_start') {
                $this->db->not_group_start();
            } elseif ($type === 'or_not_group_start') {
                $this->db->or_not_group_start();
            }

            // if group has items
            if (!empty($g['items']) && is_array($g['items'])) {
                foreach ($g['items'] as $item) {

                    if (empty($item['type'])) continue;

                    // nested group recursion
                    if (in_array($item['type'], [
                        'group_start',
                        'or_group_start',
                        'not_group_start',
                        'or_not_group_start'
                    ])) {
                        $this->datatable_apply_groups([$item]);
                        continue;
                    }

                    // normal condition
                    $t = $item['type'];

                    if ($t === 'where') {
                        $this->db->where($item['field'], $item['value']);
                    }
                    elseif ($t === 'or_where') {
                        $this->db->or_where($item['field'], $item['value']);
                    }
                    elseif ($t === 'where_in') {
                        $this->db->where_in($item['field'], $item['value']);
                    }
                    elseif ($t === 'or_where_in') {
                        $this->db->or_where_in($item['field'], $item['value']);
                    }
                    elseif ($t === 'like') {
                        $this->db->like($item['field'], $item['value']);
                    }
                    elseif ($t === 'or_like') {
                        $this->db->or_like($item['field'], $item['value']);
                    }
                    elseif ($t === 'raw') {
                        $this->db->where($item['value'], null, false);
                    }
                    elseif ($t === 'having') {
                        $this->db->having($item['field'], $item['value']);
                    }
                    elseif ($t === 'or_having') {
                        $this->db->or_having($item['field'], $item['value']);
                    }
                }
            }

            // always close group if opened
            if (in_array($type, [
                'group_start',
                'or_group_start',
                'not_group_start',
                'or_not_group_start'
            ])) {
                $this->db->group_end();
            }
        }
    }

protected function datatable_search($columns, $search, $dtCols)
{
    // GLOBAL SEARCH
    if (!empty($search['value'])) {
        $this->db->group_start();
        foreach ($columns as $col) {
            if (!empty($col)) {
                $this->db->or_like($col, $search['value']);
            }
        }
        $this->db->group_end();
    }

    // COLUMN SEARCH (tfoot filter)
    if (!empty($dtCols) && is_array($dtCols)) {
        foreach ($dtCols as $i => $col) {

            $val = $col['search']['value'] ?? '';

            if ($val !== '' && isset($columns[$i]) && !empty($columns[$i])) {
                $this->db->like($columns[$i], $val);
            }
        }
    }
}

    // ============================================================
    // SAFE COUNT FOR GROUP BY / HAVING / DISTINCT
    // ============================================================
    public function datatable_count_safe()
    {
        // build SQL current query
        $sql = $this->db->get_compiled_select();

        // wrap as subquery to count safely
        $countSQL = "SELECT COUNT(*) AS total_rows FROM ($sql) AS dt_count";

        $query = $this->db->query($countSQL);
        $row = $query->row_array();

        return intval($row['total_rows'] ?? 0);
    }*/
    // ================================
    // INSERT dengan table opsional
    // ================================
    public function insert(array $data, $table = null)
    {
        $table = $table ?? $this->table; // pakai table default jika tidak diberikan
        if(empty($table)){
            return $this->fail('Table belum didefinisikan');
        }

        $data['created_at'] = date('Y-m-d H:i:s');

        $ok = $this->db->insert($table, $data);

        return $ok
            ? $this->success('Data berhasil disimpan')
            : $this->fail('Gagal menyimpan data');
    }

    // ================================
    // UPDATE dengan table opsional
    // ================================
    public function update(array $where, array $data, $table = null)
    {
        $table = $table ?? $this->table;
        if(empty($table)){
            return $this->fail('Table belum didefinisikan');
        }

        $this->db->where($where);
        $ok = $this->db->update($table, $data);

        return $ok
            ? $this->success('Data berhasil diupdate')
            : $this->fail('Gagal mengupdate data');
    }

    // ================================
    // CEK ADA / TIDAK
    // ================================
    public function exists(array $where, $table = null)
    {
        $table = $table ?? $this->table;
        if(empty($table)){
            return false;
        }

        return $this->db->where($where)
                        ->from($table)
                        ->count_all_results() > 0;
    }

    // ================================
    // UPSERT dengan table opsional
    // ================================
    public function upsert(array $where, array $data, $table = null)
    {
        $table = $table ?? $this->table;

        if (!$this->exists($where, $table)) {
            return $this->insert(array_merge($where, $data), $table);
        }

        return $this->update($where, $data, $table);
    }

    /* ===============================
       FLEXIBLE SEARCH (Autocomplete)
    =============================== */

    public function search($table, $select, $likeField, $keyword, $limit = 5)
    {
        return $this->db
            ->select($select)
            ->from($table)
            ->like($likeField, $keyword)
            ->limit($limit)
            ->get()
            ->result_array();
    }

    /* ===============================
       ADVANCED SEARCH (MULTI FIELD)
    =============================== */

    public function search_multiple($table, $select, $fields = [], $keyword = '', $limit = 5)
    {
        $this->db->select($select)
                 ->from($table)
                 ->group_start();

        foreach ($fields as $index => $field) {
            if ($index == 0) {
                $this->db->like($field, $keyword);
            } else {
                $this->db->or_like($field, $keyword);
            }
        }

        $this->db->group_end()
                 ->limit($limit);

        return $this->db->get()->result_array();
    }
    
    /* =========================
     * RESPONSE STANDARD
     * ========================= */
    private function success($msg = "OK", $data = [])
    {
        return [
            'status' => true,
            'msg'    => $msg,
            'data'   => $data
        ];
    }

    private function fail($msg = "Gagal", $data = [])
    {
        return [
            'status' => false,
            'msg'    => $msg,
            'data'   => $data
        ];
    }
    protected function datatable_search($columns, $search, $dtCols)
    {
        // GLOBAL SEARCH
        if (!empty($search['value'])) {
            $this->db->group_start();
            foreach ($columns as $col) {
                if (!empty($col)) {
                    $this->db->or_like($col, $search['value']);
                }
            }
            $this->db->group_end();
        }

        // COLUMN SEARCH (tfoot filter)
        if (!empty($dtCols) && is_array($dtCols)) {
            foreach ($dtCols as $i => $col) {

                $val = $col['search']['value'] ?? '';

                if ($val !== '' && isset($columns[$i]) && !empty($columns[$i])) {
                    $this->db->like($columns[$i], $val);
                }
            }
        }
    }
/*
get_selectra_dropdown() → versi simple (mirip model lama, parameter terpisah)
get_selectra_raw() → versi powerful (pakai config array)
get_selectra_kv() → return id => label
*/
public function get_selectra_dropdown(
    $table,
    $value_field,
    $label_field,
    $config = []
) {

    $this->db->reset_query();

    // =============================
    // SELECT
    // =============================
    $select = $config['select'] ?? "$value_field, $label_field";
    $this->db->select($select);

    if (!empty($config['distinct'])) {
        $this->db->distinct();
    }

    $this->db->from($table);

    // =============================
    // JOIN (powerful)
    // =============================
    if (!empty($config['join'])) {
        foreach ($config['join'] as $j) {
            /*
            Format fleksibel:

            [
                [
                    'table' => 'table_name alias',
                    'on'    => 'kondisi_join',
                    'type'  => 'left' // optional (default left)
                ]
            ]
            */

            $this->db->join(
                $j['table'],
                $j['on'],
                $j['type'] ?? 'left'
            );
        }
    }

    // =============================
    // WHERE
    // =============================
    if (!empty($config['where'])) {
        $this->db->where($config['where']);
    }

    if (!empty($config['or_where'])) {
        $this->db->or_where($config['or_where']);
    }

    // =============================
    // WHERE IN
    // =============================
    if (!empty($config['where_in'])) {
        foreach ($config['where_in'] as $field => $values) {
            $this->db->where_in($field, $values);
        }
    }

    if (!empty($config['where_not_in'])) {
        foreach ($config['where_not_in'] as $field => $values) {
            $this->db->where_not_in($field, $values);
        }
    }

    // =============================
    // LIKE
    // =============================
    if (!empty($config['like'])) {
        foreach ($config['like'] as $field => $value) {
            $this->db->like($field, $value);
        }
    }

    if (!empty($config['or_like'])) {
        foreach ($config['or_like'] as $field => $value) {
            $this->db->or_like($field, $value);
        }
    }

    // =============================
    // GROUP BY
    // =============================
    if (!empty($config['group_by'])) {
        if (is_array($config['group_by'])) {
            foreach ($config['group_by'] as $g) {
                $this->db->group_by($g);
            }
        } else {
            $this->db->group_by($config['group_by']);
        }
    }

    // =============================
    // HAVING
    // =============================
    if (!empty($config['having'])) {
        $this->db->having($config['having']);
    }

    // =============================
    // ORDER BY
    // =============================
    if (!empty($config['order_by'])) {
        if (is_array($config['order_by'])) {
            foreach ($config['order_by'] as $field => $dir) {
                $this->db->order_by($field, $dir);
            }
        } else {
            $this->db->order_by($config['order_by']);
        }
    }

    // =============================
    // LIMIT
    // =============================
    if (!empty($config['limit'])) {
        if (is_array($config['limit'])) {
            $this->db->limit($config['limit'][0], $config['limit'][1] ?? 0);
        } else {
            $this->db->limit($config['limit']);
        }
    }

    // =============================
    // AUTO FILTER is_active
    // =============================
    if (!empty($config['is_active_field'])) {
        $this->db->where($config['is_active_field'], 1);
    }

    // =============================
    // AUTO SOFT DELETE
    // =============================
    if (!empty($config['soft_delete_field'])) {
        $this->db->where($config['soft_delete_field'], NULL);
    }

    return $this->db->get()->result_array();
}
public function get_selectra_raw(
    $table,
    $value_field,
    $label_field,
    $config = []
) {

    $this->db->reset_query();

    $this->db->select($config['select'] ?? "$value_field, $label_field");

    if (!empty($config['distinct'])) {
        $this->db->distinct();
    }

    $this->db->from($table);

    // JOIN
    if (!empty($config['join'])) {
        foreach ($config['join'] as $j) {
            $this->db->join(
                $j['table'],
                $j['on'],
                $j['type'] ?? 'left'
            );
        }
    }

    // =========================
    // GROUP START
    // =========================
    if (!empty($config['start_group'])) {
        $this->db->group_start();
    }

    // WHERE
    if (!empty($config['where'])) {
        $this->db->where($config['where']);
    }

    if (!empty($config['or_where'])) {
        $this->db->or_where($config['or_where']);
    }

    // WHERE IN
    if (!empty($config['where_in'])) {
        foreach ($config['where_in'] as $field => $values) {
            $this->db->where_in($field, $values);
        }
    }

    // LIKE
    if (!empty($config['like'])) {
        foreach ($config['like'] as $field => $value) {
            $this->db->like($field, $value);
        }
    }

    if (!empty($config['or_like'])) {
        foreach ($config['or_like'] as $field => $value) {
            $this->db->or_like($field, $value);
        }
    }

    // =========================
    // GROUP END
    // =========================
    if (!empty($config['end_group'])) {
        $this->db->group_end();
    }

    // GROUP BY
    if (!empty($config['group_by'])) {
        $this->db->group_by($config['group_by']);
    }

    // HAVING
    if (!empty($config['having'])) {
        $this->db->having($config['having']);
    }

    // ORDER
    if (!empty($config['order_by'])) {
        if (is_array($config['order_by'])) {
            foreach ($config['order_by'] as $field => $dir) {
                $this->db->order_by($field, $dir);
            }
        } else {
            $this->db->order_by($config['order_by']);
        }
    }

    // LIMIT
    if (!empty($config['limit'])) {
        if (is_array($config['limit'])) {
            $this->db->limit($config['limit'][0], $config['limit'][1] ?? 0);
        } else {
            $this->db->limit($config['limit']);
        }
    }

    return $this->db->get()->result_array();
}
public function get_selectra_kv(
    $table,
    $value_field,
    $label_field,
    $config = [],
    $concat = []
) {

    $rows = $this->get_selectra_raw(
        $table,
        $value_field,
        $label_field,
        $config
    );

    $result = [];

    foreach ($rows as $row) {

        $value = $row[$value_field] ?? null;

        if (!empty($concat)) {

            $labels = [];

            foreach ($concat as $field) {
                if (isset($row[$field])) {
                    $labels[] = $row[$field];
                }
            }

            $label = implode(' - ', $labels);

        } else {
            $label = $row[$label_field] ?? $value;
        }

        $result[$value] = $label;
    }

    return $result;
}

/*
$data = $this->Model->get_selectra_dropdown(
    'nkr_kewenangan ok',
    'ok.id_kewenangan',
    'ok.nama_kewenangan',
    [
        'join' => [
            [
                'table' => 'nkr_kompetensi okm',
                'on'    => 'okm.id_kompetensi = ok.id_kompetensi',
                'type'  => 'inner'
            ]
        ],
        'where' => [
            'okm.id_jabatan' => $id_jabatan
        ],
        'order_by' => [
            'ok.coun_kewenangan' => 'ASC'
        ]
    ]
);
$data = $this->Model->get_selectra_dropdown(
    'nkr_kompetensi',
    'id_kompetensi',
    'nama_kompetensi',
    [
        'where_in' => [
            'id_jabatan' => [1,2,3]
        ],
        'like' => [
            'nama_kompetensi' => 'Bedah'
        ],
        'order_by' => [
            'nama_kompetensi' => 'ASC'
        ]
    ]
);
$data = $this->Model->get_selectra_dropdown(
    'nkr_kewenangan',
    'kode_unit',
    'kode_unit',
    [
        'group_by' => 'kode_unit',
        'having'   => 'COUNT(id_kewenangan) > 2',
        'order_by' => [
            'kode_unit' => 'ASC'
        ]
    ]
);
$data = $this->Model->get_selectra_dropdown(
    'users',
    'id',
    'name',
    [
        'is_active_field'   => 'is_active',
        'soft_delete_field' => 'deleted_at',
        'order_by' => [
            'name' => 'ASC'
        ]
    ]
);
$data = $this->Model->get_selectra_raw(
    'nkr_kewenangan',
    'id_kewenangan',
    'nama_kewenangan',
    [
        'start_group' => true,
        'like' => ['nama_kewenangan' => 'bedah'],
        'or_like' => ['kode_unit' => 'BD'],
        'end_group' => true,
        'order_by' => ['nama_kewenangan' => 'ASC']
    ]
);
| Function                  | Level           | Return       |
| ------------------------- | --------------- | ------------ |
| `get_selectra_dropdown()` | Simple          | result_array |
| `get_selectra_raw()`      | Advanced        | result_array |
| `get_selectra_kv()`       | Dropdown Direct | id => label  |


*/
}