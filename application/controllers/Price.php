<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Price extends CI_controller{
  public function __construct(){
          parent::__construct();
  }
	function index(){
		$data['pesan']="";
		$ologin = $this->m_umum->ambil_data('a_online','kode_online','login');
		if($ologin['status_online'] == 0){
			redirect(base_url());
		}		
		$oweb = $this->m_umum->ambil_data('a_online','kode_online','web_online');
		if($oweb['status_online'] == 0){
			redirect(base_url());
		}	
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','1');
		$data['instance_id'] = $instansi["id_instansi"];
		$data['instance_name'] = $instansi["nama_instansi"];
		$data['idescription'] = $instansi["description"];
		$data['ikeywords'] = $instansi["keywords"];
		$data['ifooter'] = $instansi["footer"];
		$data['licensed'] = $instansi["licensed"];
		$data['username'] = set_value('username',$this->input->post("username"));
		$data['password'] = set_value('password',$this->input->post("password"));
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run() == FALSE){
					if($this->session->has_userdata('id_level')){
							$berandae = $this->session->beranda;
							redirect(base_url($berandae));
					}else{
						if($this->session->has_userdata('online')){
							redirect(base_url('member'));
						}else{
							$this->load->view("login/login",$data);
						}
					}
		}else{
				$kode = $this->m_rancak->kode_generator(5,'US');
			if($data['dt']=$this->m_umum->cek_login())
			{
				if($data['dt']['status_user']==1 AND $data['dt']['status_pegawai']==1 AND $data['dt']['username']!=="" AND $data['dt']['password']!==""){
						$data_user = array(
							'id_program'     => $data['dt']['id_program'],
							'id_pegawai'     => $data['dt']['id_pegawai'],
							'barcode_pegawai'     => $data['dt']['barcode_pegawai'],
							'id_ruangan'     => $data['dt']['id_ruangan'],
							'id_user'     => $data['dt']['id_user'],
							'id_jabatan'     => $data['dt']['id_jabatan'],
							'id_level'     => $data['dt']['id_level'],
							'temp'     => $kode,
						);					
						if($data['dt']['id_level'] == 99 ){
							$data_beranda = array(
								'beranda'     => "sa"
							);
						}
	          else if($data['dt']['id_level'] == 98 ){
							$data_beranda = array(
								'beranda'     => "pegawai"
							);
						}
						else if($data['dt']['id_level'] == 1 ){
							$data_beranda = array(
								'beranda'     => "admin_keuangan"
							);
						}
	          else if($data['dt']['id_level'] == 3 ){
							$data_beranda = array(
								'beranda'     => "kepegawaian"
							);
						}
	          else if($data['dt']['id_level'] == 12 ){
							$data_beranda = array(
								'beranda'     => "penguji"
							);
						}
						else if($data['dt']['id_level'] == 15 ){
							$data_beranda = array(
								'beranda'     => "admin_perawat"
							);
						}
						else if($data['dt']['id_level'] == 16 ){
							$data_beranda = array(
								'beranda'     => "komite"
							);
						}
						else if($data['dt']['id_level'] == 17 ){
							$data_beranda = array(
								'beranda'     => "asesor"
							);
						}
						else if($data['dt']['id_level'] == 18 ){
							$data_beranda = array(
								'beranda'     => "kabid"
							);
						}
						else if($data['dt']['id_level'] == 19 ){
							$data_beranda = array(
								'beranda'     => "karu"
							);
						}
						else if($data['dt']['id_level'] == 20 ){
							$data_beranda = array(
								'beranda'     => "akunting"
							);
						}
						else if($data['dt']['id_level'] == 21 ){
							$data_beranda = array(
								'beranda'     => "pegawai"
							);
						}
						else if($data['dt']['id_level'] == 22 ){
							$data_beranda = array(
								'beranda'     => "radiologi"
							);
						}
						else if($data['dt']['id_level'] == 50 ){
							$data_beranda = array(
								'beranda'     => "direktur"
							);
						}
						else{
							$data['pesan']='LEVEL TIDAK DITEMUKAN';
							$this->session->set_flashdata('danger', 'LEVEL TIDAK DITEMUKAN');
							$this->load->view("login/login",$data);
						}
						// sejene
						if(!empty($data_user)){
							$this->session->set_userdata($data_user);
							$this->session->set_userdata($data_beranda);
							$berandae = $this->session->beranda;
/*							$followers = $this->m_rancak->ambil_data_level($data['dt']['id_pegawai']);
							foreach($followers as $key) {
								$key['id_level'] = array(
									"level_".$key['id_level']     => $key['id_level']
								);
								$this->session->set_userdata($key['id_level']);
							}*/
							redirect(base_url($berandae));
						}
				}else{
					$data['pesan']='AKUN TIDAK AKTIF';
					$this->session->set_flashdata('danger', 'AKUN TIDAK AKTIF');
					$this->load->view("login/login",$data);				
				}
			}else{
		    $data['pesan']='USERNAME / PASSWORD SALAH';
				$this->session->set_flashdata('danger', 'USERNAME / PASSWORD SALAH');
				$this->load->view("login/login",$data);			
			}
		}
	}

	function logout(){
		$this->session->sess_destroy();
		$data['pesan']='Logout Sukses';
		$this->session->set_flashdata('sukses', 'LOGOUT SUKSES');
		redirect(base_url());
	}

}
