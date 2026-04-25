<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dttb_ctrl extends CI_Controller
{
    protected function datatable_response($data, $total, $filtered)
    {
        $this->_json([
            'draw'            => (int)$this->input->post('draw'),
            'recordsTotal'    => (int)$total,
            'recordsFiltered' => (int)$filtered,
            'data'            => $data
        ]);
    }

    protected function json_ok($payload = [])
    {
        $this->_json(array_merge(['status'=>true], $payload));
    }

    protected function json_fail($msg)
    {
        $this->_json(['status'=>false, 'message'=>$msg]);
    }

    private function _json($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}