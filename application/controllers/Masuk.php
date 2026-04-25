<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Masuk extends CI_controller{
  public function __construct(){
          parent::__construct();
          $this->load->model('m_ol_rancak');
  }
	function index(){
    if ($this->session->has_userdata('id_pegawai')) {
        redirect('member');
    }

    $masuk = $this->m_umum->ambil_data('a_online','kode_online','masuk');
    if ($masuk['status_online'] == 0) redirect(base_url());
    $web = $this->m_umum->ambil_data('a_online','kode_online','web_online');
    if ($web['status_online'] == 0) redirect(base_url());
    $instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
    $data = [
        'instance_id'   => $instansi['id_instansi'],
        'instance_name' => $instansi['nama_instansi'],
        'idescription'  => $instansi['description'],
        'ikeywords'     => $instansi['keywords'],
        'ifooter'       => $instansi['footer'],
        'licensed'      => $instansi['licensed'],
        'username' => set_value('username',$this->input->post("username")),
        'password' => set_value('password',$this->input->post("password")),
    ];


    // ====== VALIDATION (POST ONLY) ======
    $this->form_validation->set_rules('username','Username','required');
    $this->form_validation->set_rules('password','Password','required');

    if ($this->form_validation->run() === FALSE) {
        $this->load->view('login/masuk', $data);
        return;
    }

    $user = $this->m_premium->cek_login();

    if (!$user) {
        $this->session->set_flashdata('danger','USERNAME / PASSWORD SALAH');
        redirect('masuk');
    }

    if ($user['status_pegawai'] != 1 || $user['login'] != 1 || $user['status_user'] != 1) {
        $this->session->set_flashdata('danger','AKUN / WEB TIDAK AKTIF');
        redirect('masuk');
    }
       $kode = $this->m_rancak->kode_generator(5,'US');
       
    // ====== SESSION ======$this->session->set_userdata(
    $this->session->set_userdata([
        'id_user' => $user['id_user'],
        'id_pegawai' => $user['id_pegawai'],
        'barcode_pegawai' => $user['barcode_pegawai'],
        'level' => $user['id_level'],
        'id_jabatan' => $user['id_jabatan'],
        'tipe_pegawai' => $user['tipe_pegawai'],
        'id_jabatan_fungsional' => $user['id_jabatan_fungsional'],
        'id_status_asesor' => $user['id_status_asesor'],
        'mas_kred' => $user['mas_kred'],
        'mas_asesor' => $user['mas_asesor'],
        'mas_unit' => $user['mas_unit'],
        'mas_ins' => $user['id_mas_ins'],
        'online' => $user['login'],
        'id_grade' => $user['id_grade'],
        'refer' => $user['refer'],
        'barcode_working' => $user['id_barcode_working'],
        'unit' => $user['unit'],
        'status_asesor' => $user['status_asesor'],
        'validator' => $user['validator'],
        'area_klinis' => $user['id_area_klinis'],
        'temp' => $kode,
        'beranda' => 'member',
        'login_time' => date('Y-m-d H:i:s')
    ]);
    redirect('member');
	}

	function logout(){
		$this->session->sess_destroy();
		$data['pesan']='Logout Sukses';
		$this->session->set_flashdata('sukses', 'LOGOUT SUKSES');
		redirect(base_url());
	}

}
