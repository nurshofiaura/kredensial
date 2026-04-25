<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_auth extends CI_model
{
    /* =========================
     * BASIC CHECK
     * ========================= */

    private function logged()
    {
        return $this->session->has_userdata('id_pegawai');
    }

    private function deny($msg)
    {
        $this->session->set_flashdata('danger', $msg);
        redirect('member');
        exit;
    }
    public function all_member()
    {
        if (!$this->logged()) {
            redirect('logout');
        }
        return true;
    }

    public function hak_member()
    {
        $this->all_member();
        if ((int)$this->session->userdata('level') === 53) {
            $this->deny('Mahasiswa Tidak Dapat Mengakses Menu Ini');
        }

        return true;
    }

    public function admin()
    {
        $level = (int)$this->session->userdata('id_level');
        $idPeg = (int)$this->session->userdata('id_pegawai');

        if (in_array($level, [98,99], true)) return true;
        if ($idPeg === 1) return true;
    }

    public function mahasiswa()
    {
        $this->admin();
        $level = (int)$this->session->userdata('id_level');
        if ((int)$this->session->userdata('level') === 53) return true;
        $this->deny('Hanya Untuk Mahasiswa');
    }

    public function mantan_kah()
    {
        $this->mahasiswa();
        $barcode = $this->session->userdata('barcode_pegawai');

        $jml = $this->m_umum->jumlah_record_filter(
            'mhs_pegawai_unit',
            ['barcode_pegawai' => $barcode]
        );

        if ($jml === 0) {
            return $this->mahasiswa();
        }

        return true;
    }
    public function online_clean($kode_online)
    {
        $jml = $this->m_umum->jumlah_record_filter(
            'a_online',
            [
                'id_pegawai' => $this->session->userdata('id_pegawai'),
                'kode_online' => $kode_online,
                'status_online' => 1
            ]
        );

        if ($jml === 0) {
            return $this->ol_enabled_clean($kode_online);
        }

        return true;
    }

    public function ol_enabled_clean($kode_online)
    {
        $kondisi = [
            'id_pegawai'        => $this->session->userdata('id_pegawai'),
            'kode_online'       => $kode_online,
            'enabled'           => 1,
            'status_ol_enabled' => 1,
            'status_online'     => 1
        ];
        $jml = $this->m_umum->jumlah_record_tabel_pengajuan(
            'a_ol_enabled',
            $kondisi,
            'a_online',
            'id_kode_online'
        );
        if ($jml === 0) {
            $this->deny('Aplikasi Belum Aktif / Tidak Punya Hak Akses');
        }

        return true;
    }

    /* =========================
     * VALIDATOR
     * ========================= */
    public function validator()
    {
        $this->admin();

        $cek = $this->m_umum->ambil_data_kondisi_2tabel_row(
            'ol_user',
            ['ol_user.id_pegawai' => $this->session->userdata('id_pegawai')],
            'ol_pegawai',
            'id_pegawai'
        );

        if (!empty($cek) && (int)$cek['status_asesor'] > 0) {
            return true;
        }

        $this->deny('Maaf Anda Bukan Validator');
    }
    //======================================================
   function online_kah(){
      $kode_online = $this->uri->segment(1, 0);
      $kondisi_cek_online=array('kode_online'=>$kode_online,'status_online'=>1);
      $jml_cek_online = $this->m_umum->jumlah_record_filter('a_online',$kondisi_cek_online);
      if($jml_cek_online == 0){
          $this->ol_enabled();
      }else{
          if ($this->session->has_userdata('id_pegawai')){
              return TRUE;
          }else{
              $this->session->set_flashdata('danger', 'Hubungi Admin Untuk Aktifasi');
              redirect(base_url('member'));
          }
      }
    }
    function ol_enabled(){
      $kode_online = $this->uri->segment(1, 0);
      $kondisi_cek_online=array('id_pegawai'=>$this->session->id_pegawai,'kode_online'=>$kode_online,'enabled'=>1,'status_ol_enabled'=>1,'status_online'=>1);
      $jml_cek_online = $this->m_umum->jumlah_record_tabel_pengajuan('a_ol_enabled',$kondisi_cek_online,'a_online','id_kode_online');
      if($jml_cek_online == 0){
              $this->session->set_flashdata('danger', 'Aplikasi Belum AKtif / Tidak Punya Hak Akses');
              redirect(base_url('member'));
      }else{
          if ( $this->session->has_userdata('id_pegawai')){
              return TRUE;
          }else{
              $this->session->set_flashdata('danger', 'Hubungi Admin Untuk Aktifasi');
              redirect(base_url('member'));
          }
      }
    }
    function login_kah()
    {
      if($this->session->has_userdata('id_pegawai') && $this->session->userdata('level')==53){
          $this->session->set_flashdata('danger', 'Mahasiswa Tidak Dapat Mengakses Menu Ini');
          redirect(base_url('member'));
      }else{
          $this->ol_enabled();
      }
    }
}
/*
    function hak_member(){
      if ( $this->session->has_userdata('id_pegawai') ){
        if ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('level')==53 ){
              $this->session->set_flashdata('danger', 'Mahasiswa Tidak Dapat Mengakses Menu Ini');
              redirect(base_url('member'));
          }
         else{
              return TRUE;
         }
        }
       else{
            redirect(base_url('logout'));
       }
    }
    function all_member(){
      if ( $this->session->has_userdata('id_pegawai') )
        return TRUE;
       else
        redirect(base_url('logout'));
    }
    function mantankah(){
      $kondisi_mine=array('barcode_pegawai'=>$this->session->barcode_pegawai);
      $jml_mine=$this->m_umum->jumlah_record_filter('mhs_pegawai_unit',$kondisi_mine);
      if($jml_mine == 0){
        $this->mahasiswa();
      }else{
        return TRUE;
      }
    }
    function mahasiswa(){
      if ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==99 )
          return TRUE;
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==98 )
          return TRUE;
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('level')==53 )
        return TRUE;
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_pegawai')==1 )
          return TRUE;
       else{
        $this->session->set_flashdata('danger', 'Hanya Untuk Mahasiwa');
        redirect(base_url('member'));
        }
    }
    function validator()
    {
      if ($this->session->has_userdata('id_pegawai')){
        $kondisie = array('ol_user.id_pegawai'=>$this->session->id_pegawai);
        $cek = $this->m_umum->ambil_data_kondisi_2tabel_row('ol_user',$kondisie,'ol_pegawai','id_pegawai');
        if($cek['status_asesor'] > 0){
          return TRUE;
        }else{
          $this->session->set_flashdata('danger', 'Maaf Anda Bukan Validator');
          redirect(base_url('member'));         
        }
      }else{
          redirect(base_url('member'));
      }
    }
    function bayar_kah()
    {

      if($this->session->has_userdata('id_pegawai') && $this->session->userdata('level')==53){
          $this->session->set_flashdata('danger', 'Mahasiswa Tidak Dapat Mengakses Menu Ini');
          redirect(base_url('member'));
      }else{
       if($this->session->has_userdata('struktur_jabatan')){
        if($this->session->refer == 3){
         return TRUE;
        }else{
          $knds_bayar = array('status_mitra'=>1,'status_working_mitra','id_struktur_jabatan'=>$this->session->struktur_jabatan);
          $knds_exp = array('status_mitra'=>1,'status_working_mitra','id_struktur_jabatan'=>$this->session->struktur_jabatan,'expired_mitra <'=>date('Y-m-d'));
          $jml_bayar = $this->m_umum->jumlah_record_filter('kol_mitra',$knds_bayar);
          if($jml_bayar > 0){
        //   $date_now = date("Y-m-d");
           $cek_bayar = $this->m_umum->ambil_data_kondisi('kol_mitra',$knds_bayar);
           if($cek_bayar['expired_mitra'] < date('Y-m-d')){
            $this->session->set_flashdata('danger', 'Mohon Perbaharui Akun, Akun Expired');
            redirect(base_url('member'));
           }else{
            $this->ol_enabled();
           }
          }else{
           $cek_bayar_pegawai = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$this->session->id_pegawai);
           if($cek_bayar_pegawai['status_bayar_pegawai'] == 0){
            $this->session->set_flashdata('danger', 'Anda Bukan Akun Premium');
            redirect(base_url('member'));
           }else{
            $this->ol_enabled();
           }
          }         
        }

       }else{
          $this->session->set_flashdata('danger', 'Data Struktur Jabatan Belum Lengkap');
          redirect(base_url('member'));
       }
      }
    }
*/