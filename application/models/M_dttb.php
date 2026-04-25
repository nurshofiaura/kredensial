<?php
class MY_Model extends CI_Model
{
    protected $table;
    protected $column_order = [];
    protected $column_search = [];
    protected $default_order = [];

    protected function _datatable_query($whereCallback = null)
    {
        $post = $this->input->post();

        if ($whereCallback) {
            $whereCallback($this->db);
        }

        // 🔍 GLOBAL SEARCH
        if (!empty($post['search']['value'])) {
            $this->db->group_start();
            foreach ($this->column_search as $col) {
                $this->db->or_like($col, $post['search']['value']);
            }
            $this->db->group_end();
        }

        // 📌 ORDER
        if (!empty($post['order'][0])) {
            $col = $this->column_order[$post['order'][0]['column']] ?? null;
            $dir = $post['order'][0]['dir'] ?? 'asc';
            if ($col) $this->db->order_by($col, $dir);
        } elseif ($this->default_order) {
            $this->db->order_by(
                key($this->default_order),
                current($this->default_order)
            );
        }
    }

    public function datatable($whereCallback = null)
    {
        $post   = $this->input->post();
        $start  = (int)$post['start'];
        $length = (int)$post['length'];

        // DATA
        $this->_datatable_query($whereCallback);
        $this->db->limit($length, $start);
        $data = $this->db->get()->result_array();

        // FILTERED
        $this->_datatable_query($whereCallback);
        $filtered = $this->db->count_all_results();

        // TOTAL
        $total = $this->db->count_all($this->table);

        return compact('data','total','filtered');
    }
}