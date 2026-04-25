<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class User extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
		  $this->login_kah();
          $this->load->model('m_administrator');
  }
  function login_kah(){
  	$link_akses = $this->uri->segment(1, 0);
		$kondisi_hak=array('id_pegawai'=>$this->session->id_pegawai,'link_akses'=>$link_akses);
		$jumlah_hak_akses_pegawai=$this->m_rancak->jumlah_hak_akses_pegawai($kondisi_hak);
		if($jumlah_hak_akses_pegawai == 0){
			$this->cek_login_kah();
		}else{
			return TRUE;
		}
  }
  function cek_login_kah()
  {
      if ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==99 )
          return TRUE;
          elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==98 )
              return TRUE;
      elseif ( $this->session->has_userdata('id_pegawai') && $this->session->userdata('id_level')==15 )
         return TRUE;
		 // redirect(base_url('admin_perawat/user'));
     else
          redirect(base_url('logout'));
  }
  function index(){
    $this->user();
  }
 // ================================================ USER ==================================
	function check_availability(){
		$username=$this->input->post('username');
		$username = strtolower($username);
		$username = str_replace(' ', '-', $username);
		$username = preg_replace('/[^A-Za-z0-9\-]/', '', $username);
		$kondisi=array('username'=>$username);
		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi);
		if($jml == 0){
			echo "<span style='color:green'> Username Tersedia.</span>";
		}else{
			echo "<span style='color:red'> Username Sudah Ada</span>";
		}
	}
  function check_nip(){
		$nip=$this->input->post('nip');
		$kondisi=array('nip'=>$nip);
		$jml = $this->m_umum->jumlah_record_filter('pegawai',$kondisi);
		if($jml == 0){
			echo "<span style='color:green'> NIP Tersedia.</span>";
		}else{
			echo "<span style='color:red'> NIP Sudah Ada</span>";
		}
	}
  function jabfung_data($id)
  {
    if($id == 3){
      $ids = '3';
    }else{
      $ids = '1';
    }
    $dt=$this->m_rancak->ambil_data_dropdown_jabfung_status($ids);
    echo json_encode($dt);
  }
  function user($mode='view')
  {
	$data['page']  = "user";
	$data['header'] = "PEGAWAI";
	$data['title'] = "PEGAWAI - STATUS PEGAWAI JIKA NON AKTIF TIDAK DAPAT LOGIN";
	$data['link_kembali'] = base_url();
	$data['link_awal'] = base_url('user');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$program    = $this->m_umum->ambil_data('a_program','id_program',$pegawai["id_program"]);
	$programnp    = $this->m_umum->ambil_data('a_program','id_program','5');
	$data['program_unit'] = $program["unit"];
	$data['program_user_level'] = $programnp["user_level"];
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','1');
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
	$data['pake_wa'] = $instansi["wa"];
	$data['member_name'] = $pegawai["nama_pegawai"];
	$data['level_id'] = $pegawai["id_level"];
	$data['level_name'] = $pegawai["nama_level"];
	$data['photo'] = $pegawai["foto"];
	$data['notifikasi']=$this->m_rancak->jumlah_record_notification($pegawai["id_pegawai"],$pegawai["id_unit"],$pegawai["id_level"]);
	$data['link_notification']=$this->m_rancak->link_notification($pegawai["id_unit"],$pegawai["id_level"]);
	$data['ambil_birthday']   = $this->m_rancak->ambil_birthday();
	$datea = date("Y-m-d", strtotime("-10 years"));
	$dateb = date("Y-m-d", strtotime("+6 month"));
	$data['ambil_berkas_expired']=$this->m_rancak->ambil_berkas_expired($this->session->id_user);
	$kondisi_str=array('tgl_b_berkas >='=>$datea,'tgl_b_berkas <='=>$dateb,'status_berkas'=>1,
		'id_kategori_berkas'=>1,'id_pegawai'=>$this->session->id_pegawai);
	$data['jml_str']=$this->m_umum->jumlah_record_filter('berkas',$kondisi_str);
	$kondisi_sip=array('tgl_b_berkas >='=>$datea,'tgl_b_berkas <='=>$dateb,'status_berkas'=>1,
		'id_kategori_berkas'=>2,'id_pegawai'=>$this->session->id_pegawai);
	$data['jml_sip']=$this->m_umum->jumlah_record_filter('berkas',$kondisi_sip);
	$kondisi_sik=array('tgl_b_berkas >='=>$datea,'tgl_b_berkas <='=>$dateb,'status_berkas'=>1,
		'id_kategori_berkas'=>3,'id_pegawai'=>$this->session->id_pegawai);
	$data['jml_sik']=$this->m_umum->jumlah_record_filter('berkas',$kondisi_sik);
	$data['id'] = $this->uri->segment(4, 0);
    if($mode=='view'){
		$this->tampil_top($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_administrator->user_all($data['program_unit'],$data['level_id']));
	}
  else{
  		$data['cmd_tipe_pegawai'] = $this->m_rancak->cmd_tipe_pegawai();
  		$data['status'] = $this->m_rancak->cmd_status();
  		$data['gender'] = $this->m_rancak->cmd_jk();
  		$data['level'] = $this->m_rancak->cmd_level_program3($data['program_user_level'],$data['level_id']);
  		$data['unit'] = $this->m_rancak->cmd_struktur_jabatan_as_unit2();
  		$data['cmd_ruangan'] = $this->m_rancak->cmd_ruangan();
      $data['cmd_jabfung'] = $this->m_rancak->cmd_jabfung();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
    		$data['title'] = "TAMBAH USER";
    		$data['nama_pegawai']  = set_value('nama_pegawai',$this->input->post("nama_pegawai"));
    		$data['email']  = set_value('email',$this->input->post("email"));
    		$data['username']  = set_value('username',$this->input->post("username"));
    		$data['no_hp']  = set_value('no_hp',$this->input->post("no_hp"));
    		$data['id_level']  = set_value('id_level',$this->input->post("id_level"));
    		$data['id_unit']  = set_value('id_unit',$this->input->post("id_unit"));
    		$data['id_ruangan']  = set_value('id_ruangan',$this->input->post("id_ruangan"));
    		$data['id_jabatan_fungsional']  = set_value('id_jabatan_fungsional',$this->input->post("id_jabatan_fungsional"));
    		$data['jk']  = set_value('jk',$this->input->post("jk"));
    		$data['status_user']  = set_value('status_user',$this->input->post("status_user"));
    		$data['foto']  = set_value('foto',$this->input->post("foto"));
    		$data['nip']  = set_value('nip',$this->input->post("nip"));
    		$data['tipe_pegawai']  = set_value('tipe_pegawai',$this->input->post("tipe_pegawai"));
    		$this->form_validation->set_rules('nama_pegawai','nama_pegawai','required');
        if ($this->form_validation->run() === FALSE){
			       $this->tampil_top($data);
        }else{
      			$ptn = "/^0/";  // Regex
      			$str = $this->input->post('no_hp'); //Your input, perhaps $_POST['textbox'] or whatever
      			$rpltxt = "62";  // Replacement string
      			$no_hp = preg_replace($ptn, $rpltxt, $str);
      			$id_user= $this->session->id_user;
      			$id_level= $this->input->post('id_level');
      			$id_unit= $this->input->post('id_unit');
      			$wa= $this->input->post('wa');
      			$akses = $this->m_umum->ambil_data('user_level','id_level',$id_level);
      			$unit = $this->m_umum->ambil_data('unit','id_unit',$id_unit);
      			$nama_level= $akses['nama_level'];
      			$nama_unit= $unit['nama_unit'];
      			$nama_pegawai= $this->input->post('nama_pegawai');
      			$instance_name= $this->input->post('instance_name');
            $nip= $this->input->post('nip');
            $nip = str_replace(' ', '', $nip);
            $id_jabatan_fungsional= $this->input->post('id_jabatan_fungsional');
      			$username = $this->input->post('username');
      			$username = strtolower($username);
      			$username = str_replace(' ', '-', $username);
      			$username = preg_replace('/[^A-Za-z0-9\-]/', '', $username);
      			$kondisi=array('username'=>$username);
      			$jml = $this->m_umum->jumlah_record_filter('user',$kondisi);
            $kondisi2=array('nip'=>$nip);
            $kondisi3=array('id_level'=>'50','status_user'=>'1');
      			$jml3 = $this->m_umum->jumlah_record_filter('user',$kondisi3);
      			$jml2 = $this->m_umum->jumlah_record_filter('pegawai',$kondisi2);
            if(empty($id_jabatan_fungsional) OR $id_jabatan_fungsional == 0){
              $this->session->set_flashdata('danger', 'Jabatan Fungsional Harus Diisi');
              redirect(base_url('user/user'));
            }
            else{
              if($jml3 > 1){
                $this->session->set_flashdata('danger', 'Akun Direktur Masih Aktif');
                redirect(base_url('user/user'));
              }else{
                if($jml == 0){
            			if($jml2 == 0){
                    $pesan = "TAMBAH AKUN NAMA : ".$nama_pegawai." , LEVEL : ".$nama_level." , PASSWORD : 7654321, USERNAME :
            				".$username." , UNIT : ".$nama_unit." , HP : ".$str;
            				$kode = $this->m_rancak->kode_generator(15,'');
            				$data = array();
            				$filesCount = count($_FILES['upload_Files']['name']);
            				$wa = $this->input->post('wa');
            				for($i = 0; $i < $filesCount; $i++){
            					$_FILES['upload_File']['name'] = $_FILES['upload_Files']['name'][$i];
            					$_FILES['upload_File']['type'] = $_FILES['upload_Files']['type'][$i];
            					$_FILES['upload_File']['tmp_name'] = $_FILES['upload_Files']['tmp_name'][$i];
            					$_FILES['upload_File']['error'] = $_FILES['upload_Files']['error'][$i];
            					$_FILES['upload_File']['size'] = $_FILES['upload_Files']['size'][$i];
            					$uploadPath = 'assets/foto/';
            					$config['upload_path'] = $uploadPath;
            					$config['allowed_types'] = 'gif|jpg|jpeg|png';
            					$config['encrypt_name'] = TRUE;
            					$this->load->library('upload', $config);
            					$this->upload->initialize($config);
            					if($this->upload->do_upload('upload_File')){
            						$fileData = $this->upload->data();
            						$Q = $this->m_administrator->simpan_pegawai($fileData['file_name']);
            					}else{
            						$Q = $this->m_administrator->simpan_pegawai_no_pic();
            					}
            					$this->m_administrator->simpan_user($Q,$kode);
            					if($wa =='1'){
            						$br = "\n";
            						$message = "*".$instance_name."*";
            						$message .= $br. $br."SELAMAT AKUN ANDA BERHASIL DI BUAT";
            						$message .= $br."📜 Data Anda";
            						$message .= $br. "Nama : " . $nama_pegawai;
            						$message .= $br. "No HP : " . $str;
            						$message .= $br. "Hak Akses : " . $nama_level;
            						$message .= $br. "username (terisi jika ganti username): " . $username;
            						$message .= $br. "Password (terisi jika ganti password): 7654321";
            						$this->m_umum->kirim_wageblast($message,$no_hp);
            					}
//            					$this->m_rancak->simpan_log_wa($no_hp,$id_user,$pesan);
            					$this->session->set_flashdata('sukses', 'Data berhasil Di Tambah');
            					redirect(base_url('user/user'));
            				}
                  }else{
                    $this->session->set_flashdata('danger', 'NIP Sudah Ada');
                    redirect(base_url('user/user'));
                  }
          			}
          			else{
          					$this->session->set_flashdata('danger', 'Username Sudah Ada');
          					redirect(base_url('user/user'));
          			}
              }
          }
        }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
    		$data['title'] = "EDIT USER";
    		$take = $this->m_administrator->ambil_barcode_user_pegawai($data['id']);
    		$data['id_user']  = set_value('id_user',$take['id_user']);
    		$data['id_pegawai']  = set_value('id_pegawai',$take['id_pegawai']);
    		$data['nama_pegawai']  = set_value('nama_pegawai',$take['nama_pegawai']);
    		$data['email']  = set_value('email',$take['email']);
  //  		$data['username']  = set_value('username',$this->input->post("username"));
    		$data['username']  = set_value('username',$take['username']);
    		$data['password']  = set_value('password',$take['password']);
    		$data['password_lama']  = set_value('password_lama',$take['password']);
    		$data['id_level']  = set_value('id_level',$take['id_level']);
    		$data['no_hp']  = set_value('no_hp',$take['no_hp']);
    		$data['id_unit']  = set_value('id_unit',$take['id_unit']);
    		$data['id_ruangan']  = set_value('id_ruangan',$take['id_ruangan']);
    		$data['id_jabatan_fungsional']  = set_value('id_jabatan_fungsional',$take['id_jabatan_fungsional']);
    		$data['jk']  = set_value('jk',$take['jk']);
    		$data['status_user']  = set_value('status_user',$take['status_pegawai']);
    		$data['foto']  = set_value('foto',$take['foto']);
    		$data['nip']  = set_value('nip',$take['nip']);
    		$data['tipe_pegawai']  = set_value('tipe_pegawai',$take['tipe_pegawai']);
    		$this->form_validation->set_rules('nama_pegawai','nama_pegawai','required');
        if ($this->form_validation->run() === FALSE){
			       $this->tampil_top($data);
        }else{
    			$ptn = "/^0/";
    			$str = $this->input->post('no_hp');
    			$rpltxt = "62";
    			$no_hp = preg_replace($ptn, $rpltxt, $str);
    			$id_user= $this->session->id_user;
    			$id_user_direktur= $this->input->post('id_user');
    			$id_level= $this->input->post('id_level');
    			$id_unit= $this->input->post('id_unit');
    			$wa= $this->input->post('wa');
    			$akses = $this->m_umum->ambil_data('user_level','id_level',$id_level);
    			$unit = $this->m_umum->ambil_data('unit','id_unit',$id_unit);
    			$nama_level= $akses['nama_level'];
    			$nama_unit= $unit['nama_unit'];
          $nip= $this->input->post('nip');
          $nip = str_replace(' ', '', $nip);
    			$nip_lama= $this->input->post('nip_lama');
    			$nama_pegawai= $this->input->post('nama_pegawai');
    			$instance_name= $this->input->post('instance_name');
    			$username_lama = $this->input->post('username_lama');
          $id_jabatan_fungsional= $this->input->post('id_jabatan_fungsional');
    			$username= $this->input->post('username');
    			$username = strtolower($username);
    			$username = str_replace(' ', '-', $username);
    			$username = preg_replace('/[^A-Za-z0-9\-]/', '', $username);
    			$kondisi=array('username'=>$username,'username !='=>$username_lama);
    			$pesan = "EDIT AKUN NAMA : ".$nama_pegawai." , LEVEL : ".$nama_level." , USERNAME : ".$username." , UNIT : ".$nama_unit." , HP : ".$str;
    			$jml = $this->m_umum->jumlah_record_filter('user',$kondisi);
          $kondisi2=array('nip'=>$nip,'nip !='=>$nip_lama);
    			$jml2 = $this->m_umum->jumlah_record_filter('pegawai',$kondisi2);
          $kondisi3=array('id_level'=>'50','status_user'=>'1','id_user !='=>$id_user_direktur);
          $jml3 = $this->m_umum->jumlah_record_filter('user',$kondisi3);
          if(empty($id_jabatan_fungsional) OR $id_jabatan_fungsional == 0){
            $this->session->set_flashdata('danger', 'Jabatan Fungsional Harus Diisi');
            redirect(base_url('user/user'));
          }
          else{
            if($jml3 > 1){
              $this->session->set_flashdata('danger', 'Akun Direktur Masih Aktif');
              redirect(base_url('user/user'));
            }else{
              if($jml == 0){
          			if($jml2 == 0){
                  $data = array();
          				$filesCount = count($_FILES['upload_Files']['name']);
          				$wa = $this->input->post('wa');
          				for($i = 0; $i < $filesCount; $i++){
          					$_FILES['upload_File']['name'] = $_FILES['upload_Files']['name'][$i];
          					$_FILES['upload_File']['type'] = $_FILES['upload_Files']['type'][$i];
          					$_FILES['upload_File']['tmp_name'] = $_FILES['upload_Files']['tmp_name'][$i];
          					$_FILES['upload_File']['error'] = $_FILES['upload_Files']['error'][$i];
          					$_FILES['upload_File']['size'] = $_FILES['upload_Files']['size'][$i];
          					$uploadPath = 'assets/foto/';
          					$config['upload_path'] = $uploadPath;
          					$config['allowed_types'] = 'gif|jpg|jpeg|png';
          					$config['encrypt_name'] = TRUE;
          					$this->load->library('upload', $config);
          					$this->upload->initialize($config);
          					if($this->upload->do_upload('upload_File')){
          						$id_pegawai = $this->input->post('id_pegawai');
          						$user_pic=$this->m_umum->ambil_data('pegawai','id_pegawai',$id_pegawai);
          						$cek_file=FCPATH.'assets/foto/'.$user_pic['foto'];
          						if(file_exists($cek_file)){
          							unlink(FCPATH."assets/foto/".$user_pic['foto']);
          						}
          						$fileData = $this->upload->data();
          						$this->m_administrator->edit_pegawai($fileData['file_name']);
          					}else{
          						$this->m_administrator->edit_pegawai_no_pic();
          					}
          					$this->m_administrator->edit_user();
          					if($wa =='1'){
          						$br = "\n";
          						$message = "*".$instance_name."*";
          						$message .= $br. $br."SELAMAT AKUN ANDA BERHASIL DI RUBAH";
          						$message .= $br."📜 Data Anda";
          						$message .= $br. "Nama : " . $nama_pegawai;
          						$message .= $br. "No HP : " . $str;
          						$message .= $br. "Hak Akses : " . $nama_level;
          						$message .= $br. "username (terisi jika ganti username): " . $username;
          						$this->m_umum->kirim_wageblast($message,$no_hp);
          					}
//          					$this->m_rancak->simpan_log_wa($no_hp,$id_user,$pesan);
          					$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
          					redirect(base_url('user/user'));
          				}
                }else{
                  $this->session->set_flashdata('danger', 'NIP Sudah Ada');
        					redirect(base_url('user/user'));
                }
        			}
        			else{
        					$this->session->set_flashdata('danger', 'Username Sudah Ada');
        					redirect(base_url('user/user'));
        			}
            }
        }
        }
      }
      if($mode=='lihat'){
        $data['page'] =  $data['page']."_lihat";
    		$data['levelnya'] = $this->m_rancak->ambil_level_4_user($data['id']);
        $peg = $this->m_umum->ambil_data('pegawai','id_pegawai',$data['id']);
        $data['potonya']  = $peg['foto'];
        $data['namanya']  = $peg['nama_pegawai'];
    		$this->load->view("adminperawat/isi",$data);
      }
		if($mode=='reset'){
			$d = $this->m_rancak->ambil_user_pegawai($data['id']);
			$no_hp = $d['no_hp'];
			$nama_pegawai = $d['nama_pegawai'];
			$nama_level = $d['nama_level'];
			$id_user = $this->session->id_user;
			if($d['id_level'] == '99'){
				$this->session->set_flashdata('danger', 'Tidak dapat mereset Superadmin');
				redirect(base_url('user/user'));
			}else{
			  if($this->m_administrator->reset_password($data['id'])){
  				$tansi = $this->m_umum->ambil_data('a_instansi','id_instansi','1');
  				$instance_name = $tansi["nama_instansi"];
  				$wa = $tansi["wa"];
  				if($wa =='1'){
  				$ptn = "/^0/";
  				$rpltxt = "62";
  				$no_hp = preg_replace($ptn, $rpltxt, $no_hp);
					$br = "\n";
					$message = "*".$instance_name."*";
					$message .= $br. $br."SELAMAT AKUN ANDA BERHASIL DI RESET";
					$message .= $br."📜 Data Anda";
					$message .= $br. "Nama : " . $nama_pegawai;
					$message .= $br. "No HP : " . $no_hp;
					$message .= $br. "Hak Akses : " . $nama_level;
					$message .= $br. "Password : 7654321";
					$this->m_umum->kirim_wageblast($message,$no_hp);
				}
  	//			$pesan = "RESET AKUN ADMIN ID/NAMA : ".$data['id']." - ".$nama_pegawai;
  	//			$this->m_rancak->simpan_log_wa($no_hp,$id_user,$pesan);
  				$this->session->set_flashdata('sukses', 'Password di Reset menjadi 7654321');
  				redirect(base_url('user/user'));
			  }else{
					$this->session->set_flashdata('danger', 'Masalah Edit Data');
					redirect(base_url('user/user'));
			  }
			}
		}
	}
  }
  function akses($mode='view')
  {
		$data['page']  = "akses";
		$data['header'] = "HAK AKSES TAMBAHAN";
		$data['title'] = "HAK AKSES TAMBAHAN";
	$data['link_kembali'] = base_url();
	$data['link_awal'] = base_url('user');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$program    = $this->m_umum->ambil_data('a_program','id_program',$pegawai["id_program"]);
	$programnp    = $this->m_umum->ambil_data('a_program','id_program','5');
	$data['program_unit'] = $program["unit"];
	$data['program_user_level'] = $programnp["user_level"];
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','1');
	$data['instance_id'] = $instansi["id_instansi"];
	$data['instance_name'] = $instansi["nama_instansi"];
	$data['idescription'] = $instansi["description"];
	$data['ikeywords'] = $instansi["keywords"];
	$data['iheader'] = $instansi["header"];
	$data['iheader_mini'] = $instansi["header_mini"];
	$data['ifooter'] = $instansi["footer"];
	$data['ilicensed'] = $instansi["licensed"];
	$data['pake_wa'] = $instansi["wa"];
	$data['member_name'] = $pegawai["nama_pegawai"];
	$data['level_id'] = $pegawai["id_level"];
	$data['level_name'] = $pegawai["nama_level"];
	$data['photo'] = $pegawai["foto"];
	$data['notifikasi']=$this->m_rancak->jumlah_record_notification($pegawai["id_pegawai"],$pegawai["id_unit"],$pegawai["id_level"]);
	$data['link_notification']=$this->m_rancak->link_notification($pegawai["id_unit"],$pegawai["id_level"]);
	$data['ambil_birthday']   = $this->m_rancak->ambil_birthday();
	$datea = date("Y-m-d", strtotime("-10 years"));
	$dateb = date("Y-m-d", strtotime("+6 month"));
	$data['ambil_berkas_expired']=$this->m_rancak->ambil_berkas_expired($this->session->id_user);
	$kondisi_str=array('tgl_b_berkas >='=>$datea,'tgl_b_berkas <='=>$dateb,'status_berkas'=>1,
		'id_kategori_berkas'=>1,'id_pegawai'=>$this->session->id_pegawai);
	$data['jml_str']=$this->m_umum->jumlah_record_filter('berkas',$kondisi_str);
	$kondisi_sip=array('tgl_b_berkas >='=>$datea,'tgl_b_berkas <='=>$dateb,'status_berkas'=>1,
		'id_kategori_berkas'=>2,'id_pegawai'=>$this->session->id_pegawai);
	$data['jml_sip']=$this->m_umum->jumlah_record_filter('berkas',$kondisi_sip);
	$kondisi_sik=array('tgl_b_berkas >='=>$datea,'tgl_b_berkas <='=>$dateb,'status_berkas'=>1,
		'id_kategori_berkas'=>3,'id_pegawai'=>$this->session->id_pegawai);
	$data['jml_sik']=$this->m_umum->jumlah_record_filter('berkas',$kondisi_sik);
		$data['id']   = $this->uri->segment(4, 0);
		$data['int']   = $this->uri->segment(5, 0);
	  if($mode=='view'){
			$this->tampil_top($data);
		}
    else if($mode=='data'){
		echo json_encode($this->m_administrator->hak_akses_all($data['id']));
	}
		else{
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
        $data['hak_akses'] = $this->m_rancak->hak_akses($data['id'],$program['akses']);
    		$this->load->view("administrator/isi",$data);
      }
      if($mode=='simpan_tambah'){
    		$id_pegawai= $this->input->post('id_pegawai');
			  $this->m_administrator->simpan_pegawai_akses();
				$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
				redirect(base_url('user/akses/view/'.$id_pegawai));
      }
			if($mode=='status'){
					$pegakses = $this->m_umum->ambil_data('pegawai_akses','id_pegawai_akses',$data['int']);
				  if($this->m_administrator->status_pegawai_akses($data['id'],$data['int'])){
						$this->session->set_flashdata('sukses', 'Sukses Rubah Status');
						redirect(base_url('user/akses/view/'.$pegakses['id_pegawai']));	  	
				  }else{
						$this->session->set_flashdata('danger', 'Masalah Edit Data');
						redirect(base_url('user/akses/view/'.$pegakses['id_pegawai']));
				  }
			}
		}
  }
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("administrator/header",$data);
	$this->load->view("administrator/isi");
	$this->load->view("footer");
	$this->load->view("administrator/jsload");
	$this->load->view("administrator/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_top",$data);
	$this->load->view("administrator/isi");
	$this->load->view("footer");
	$this->load->view("administrator/jsload");
	$this->load->view("administrator/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
