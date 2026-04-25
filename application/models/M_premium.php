<?php
class M_premium extends MY_Model{
    function cek_login()
    {
        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);
        $password = hash('sha512', md5($password));

        $this->db->from('ol_user');
        $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai = ol_user.id_pegawai', 'left');
        $this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional = ol_pegawai.id_jabatan_fungsional', 'left');
        $this->db->join('kol_working', 'kol_working.id_working = ol_user.refer', 'left');

        $this->db->where('ol_user.username', $username);
        $this->db->where('ol_user.password', $password);

        // soft delete filter
        $this->db->where('ol_pegawai.deleted_by IS NULL', null, false);

        $this->db->limit(1);

        return $this->db->get()->row_array();
    }
    function ambil_rujukan_working_null_data($id=FALSE)
    {
        $this->db->select("nama_working,id_working");
        $q = $this->db->get_where('kol_working',array('id_working'=>$id));
        return $q->result_array();
    }
}