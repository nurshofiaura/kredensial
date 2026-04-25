<?php
class M_dttb_all extends M_dttb
{
    protected $table = 'ol_user';

    protected $column_order = [
        null,
        'nama_pegawai',
        'nip',
        'nama_unit',
        'nama_komite'
    ];

    protected $column_search = [
        'nama_pegawai',
        'nip',
        'nama_unit',
        'nama_komite'
    ];

    protected $default_order = ['nama_unit'=>'asc'];

    private function base_query()
    {
        $this->db->select("
            ol_user.*,
            ol_pegawai.*,
            ol_unit.nama_unit,
            IF(status_asesor=0,'Pegawai',kol_komite.nama_komite) AS nama_komite
        ");

        $this->db->from('ol_user');
        $this->db->join('ol_pegawai','ol_pegawai.id_pegawai=ol_user.id_pegawai','left');
        $this->db->join('ol_pegawai_unit','ol_pegawai_unit.id_pegawai=ol_pegawai.id_pegawai','left');
        $this->db->join('ol_unit','ol_unit.id_unit=ol_pegawai_unit.id_unit','left');
        $this->db->join('kol_komite','kol_komite.id_komite=ol_user.status_asesor','left');

        $this->db->where('ol_user.id_pegawai !=', $this->session->id_pegawai);
        $this->db->group_start()
            ->where('(validator=2 AND ol_pegawai_unit.id_unit="'.$this->session->unit.'")', null, false)
            ->or_where('validator', $this->session->id_pegawai)
        ->group_end();
    }

    public function datatable_pegawai()
    {
        return $this->datatable(function($db){
            $this->base_query();
        });
    }
}