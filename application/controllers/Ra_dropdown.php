<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ra_dropdown extends MY_Controller {

    public function kewenangan()
    {
        $search = $this->input->get('q');
        $page   = $this->input->get('page') ?? 1;
        $limit  = 30;
        $offset = ($page - 1) * $limit;

        $id_jabatan = $this->input->get('id_jabatan');

        $this->db
            ->select("
                ok.id_kewenangan as id,
                CONCAT(
                    ok.nama_kewenangan,
                    ' [ ',
                    okm.kode_unit,
                    ' - ',
                    okm.nama_kompetensi,
                    ' ]'
                ) as text
            ")
            ->from("nkr_kewenangan ok")
            ->join("nkr_kompetensi okm","okm.id_kompetensi=ok.id_kompetensi","left")
            ->where("okm.id_jabatan", $id_jabatan);

        if ($search) {
            $this->db->group_start();
            $this->db->like('ok.nama_kewenangan', $search);
            $this->db->or_like('okm.kode_unit', $search);
            $this->db->or_like('okm.nama_kompetensi', $search);
            $this->db->group_end();
        }

        $data = $this->db
            ->limit($limit, $offset)
            ->order_by("ok.coun_kewenangan", "asc")
            ->get()
            ->result_array();

        echo json_encode([
            "results" => $data,
            "pagination" => [
                "more" => count($data) == $limit
            ]
        ]);
    }

}