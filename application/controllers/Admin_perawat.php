<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Admin_perawat extends CI_controller
{
// -----------------------------------------------------------START-----------------------------------------
  public function __construct(){
          parent::__construct();
		  $this->login_kah();
          $this->load->model('m_admin_perawat');
          $this->load->model('m_rperawat');
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
     else
          redirect(base_url('logout'));
  }
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
	function index(){
		$data['page']="home";
		$data['header'] = "BERANDA";
		$data['title'] = "BERANDA";
		$pegawai=$this->m_rperawat->ambil_user_perawat($this->session->id_user);
		$program    = $this->m_umum->ambil_data('a_program','id_program','1');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$data['instance_id'] = $instansi["id_instansi"];
		$data['instance_name'] = $instansi["nama_instansi"];
		$data['idescription'] = $instansi["description"];
		$data['ikeywords'] = $instansi["keywords"];
		$data['iheader'] = $instansi["header"];
		$data['iheader_mini'] = $instansi["header_mini"];
		$data['ifooter'] = $instansi["footer"];
		$data['ilicensed'] = $instansi["licensed"];
		$data['member_id'] = $pegawai["id_pegawai"];
		$data['member_name'] = $pegawai["nama_pegawai"];
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
		//======================= IMPORTANT =========================================
		$searchValues  = [4,19,20];
		$data['ambil_pengumuman']   = $this->m_rancak->ambil_pengumuman($pegawai['id_jabatan'],$pegawai['id_level'],$program['jabatan']);
		$data['ambil_berkas_expired_all']=$this->m_rancak->ambil_berkas_expired_all();
		$data['jml_pengajuan']=$this->m_umum->jumlah_record_tabel('kr_pengajuan');
		$data['jml_user_kredensial']=$this->m_umum->jumlah_record_tabel('user');
		$data['jlm_pegawai']=$this->m_umum->jumlah_record_tabel('pegawai');
		$data['jml_logbook']=$this->m_umum->jumlah_record_tabel('logbook');
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
		  if($this->m_admin_perawat->simpan_pengumuman($program['jabatan'],$pegawai['id_level'])){
			redirect(base_url('admin_perawat'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Masalah Input Data. Hubungi Admin');
			redirect(base_url('admin_perawat'));
		  }
		}
	}
  function user($mode='view')
  {
	$data['page']  = "user";
	$data['header'] = "USER";
	$data['title'] = "USER";
	$data['link_kembali'] = base_url();
	$data['link_awal'] = base_url('admin_perawat/user');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$program    = $this->m_umum->ambil_data('a_program','id_program','1');//ppni
	$data['program_unit'] = $program["unit"];
	$data['program_user_level'] = $program["user_level"];
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
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
	$data['idpeg'] = $this->uri->segment(5, 0);
    if($mode=='view'){
		$this->tampil($data);
	}
    else if($mode=='data1'){
		echo json_encode($this->m_admin_perawat->pegawai_all($program['jabatan']));
	}
    else if($mode=='data'){
		echo json_encode($this->m_admin_perawat->user_all($data['id'],$program['user_level']));
	}
  else if($mode=='hapus'){
  		$kondisi=array('id_pegawai'=>$data['idpeg']);
  		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi);
  		if($jml > 1){
  		  if($this->m_umum->hapus_data('user','id_user',$data['id'])){
    			$this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
    			redirect(base_url('admin_perawat/user/edit/'.$data['idpeg']));
  		  }else{
    			$this->session->set_flashdata('danger', 'Masalah Hapus Data');
    			redirect(base_url('admin_perawat/user/edit/'.$data['idpeg']));
  		  }
  		 }else{
    			$this->session->set_flashdata('danger', 'Minimal Harus ada 1 User');
    			redirect(base_url('admin_perawat/user/edit/'.$data['idpeg']));
  		 }
  }
  else if($mode=='hapus_pegawai'){
  		$kondisi=array('id_pegawai'=>$data['id']);
  		$kondisi2=array('id_petugas'=>$data['id']);
  		$jml_berkas = $this->m_umum->jumlah_record_filter('berkas',$kondisi);
  		$jml_buket_pegawai = $this->m_umum->jumlah_record_filter('kr_buket_pegawai',$kondisi);
  		$jml_etik_pegawai = $this->m_umum->jumlah_record_filter('kr_etik_pegawai',$kondisi);
  		$jml_kewenangan_lulus = $this->m_umum->jumlah_record_filter('kr_kewenangan_lulus',$kondisi);
  		$jml_pengajuan = $this->m_umum->jumlah_record_filter('kr_pengajuan',$kondisi);
  		$jml_logbook = $this->m_umum->jumlah_record_filter('logbook',$kondisi);
  		$jml_abk = $this->m_umum->jumlah_record_filter('p_abk',$kondisi);
  		$jml_jadwal = $this->m_umum->jumlah_record_filter('pegawai_jadwal',$kondisi);
  		$jml_pemeriksaan = $this->m_umum->jumlah_record_filter('pemeriksaan',$kondisi);
  		$jml_pu = $this->m_umum->jumlah_record_filter('pendaftaran_unit',$kondisi2);
  		if($jml_berkas == 0){
        if($jml_buket_pegawai == 0){
          if($jml_etik_pegawai == 0){
            if($jml_kewenangan_lulus == 0){
              if($jml_pengajuan == 0){
                if($jml_logbook == 0){
                  if($jml_abk == 0){
                    if($jml_jadwal == 0){
                      if($jml_pemeriksaan == 0){
                        if($jml_pu == 0){
                            $this->m_admin_perawat->simpan_pegawai_del($data['id']);
                            $this->m_umum->hapus_data('user','id_pegawai',$data['id']);
                        		$this->m_umum->hapus_data('pegawai','id_pegawai',$data['id']);
                        		$this->m_umum->hapus_data('perawat_detil','id_pegawai',$data['id']);
                    		 }else{
                      			$this->session->set_flashdata('danger', 'Masih Ada Data di Pendaftaran');
                    		 }
                  		 }else{
                    			$this->session->set_flashdata('danger', 'Masih Ada Data di Pemeriksaan');
                  		 }
                		 }else{
                  			$this->session->set_flashdata('danger', 'Masih Ada Data di Jadwal');
                		 }
              		 }else{
                			$this->session->set_flashdata('danger', 'Masih Ada Data di ABK');
              		 }
            		 }else{
              			$this->session->set_flashdata('danger', 'Masih Ada Data di Logbook');
            		 }
          		 }else{
            			$this->session->set_flashdata('danger', 'Masih Ada Data di Pengajuan');
          		 }
        		 }else{
          			$this->session->set_flashdata('danger', 'Masih Ada Data di Kewenangan Lulus Pegawai');
        		 }
      		 }else{
        			$this->session->set_flashdata('danger', 'Masih Ada Data di Etik Pegawai');
      		 }
    		 }else{
      			$this->session->set_flashdata('danger', 'Masih Ada Data di Butir Kegiatan Pegawai');
    		 }
  		 }else{
    			$this->session->set_flashdata('danger', 'Masih Ada Data di Berkas');
  		 }
    	redirect(base_url('admin_perawat/user'));
  }
  else{
  		$data['cmd_tipe_pegawai'] = $this->m_rancak->cmd_tipe_pegawai();
  		$data['cmd_status'] = $this->m_rancak->cmd_status();
  		$data['gender'] = $this->m_rancak->cmd_jk();
  		$data['cmd_level_program'] = $this->m_rancak->cmd_level_program($data['program_user_level'],$data['level_id']);
  		$data['cmd_ruangan'] = $this->m_rancak->cmd_ruangan_perawat();
  		$data['cmd_unit'] = $this->m_rancak->cmd_struktur_jabatan_as_unit2();
  		$data['cmd_ambil_kode_kewenangan'] = $this->m_rperawat->cmd_ambil_kode_kewenangan();
      $data['cmd_jabfung'] = $this->m_rancak->cmd_jabfung();
    if($mode=='tambah'){
      $data['page'] =  $data['page']."_tambah";
  		$data['title'] = "TAMBAH USER";
  		$data['nama_pegawai']  = set_value('nama_pegawai',$this->input->post("nama_pegawai"));
  		$data['email']  = set_value('email',$this->input->post("email"));
  		$data['username']  = set_value('username',$this->input->post("username"));
  		$data['no_hp']  = set_value('no_hp',$this->input->post("no_hp"));
  		$data['id_level']  = set_value('id_level',$this->input->post("id_level"));
  		$data['id_ruangan']  = set_value('id_ruangan',$this->input->post("id_ruangan"));
  		$data['id_unit']  = set_value('id_unit',$this->input->post("id_unit"));
  		$data['jk']  = set_value('jk',$this->input->post("jk"));
  		$data['status_user']  = set_value('status_user',$this->input->post("status_user"));
  		$data['id_jabatan_fungsional']  = set_value('id_jabatan_fungsional',$this->input->post("id_jabatan_fungsional"));
  		$data['nip']  = set_value('nip',$this->input->post("nip"));
  		$data['id_kode_kewenangan']  = set_value('id_kode_kewenangan',$this->input->post("id_kode_kewenangan"));
  		$data['foto']  = set_value('foto',$this->input->post("foto"));
  		$data['tipe_pegawai']  = set_value('tipe_pegawai',$this->input->post("tipe_pegawai"));
  		$this->form_validation->set_rules('nama_pegawai','nama_pegawai','required');
      if ($this->form_validation->run() === FALSE){
			     $this->tampil($data);
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
  			$nip= $this->input->post('nip');
  			$nama_pegawai= $this->input->post('nama_pegawai');
  			$instance_name= $this->input->post('instance_name');
        $id_jabatan_fungsional= $this->input->post('id_jabatan_fungsional');
  			$username= $this->input->post('username');
  			$username = strtolower($username);
  			$username = str_replace(' ', '-', $username);
  			$username = preg_replace('/[^A-Za-z0-9\-]/', '', $username);
  			$kondisi=array('username'=>$username);
  			$jml = $this->m_umum->jumlah_record_filter('user',$kondisi);
        $kondisi2=array('nip'=>$nip);
  			$jml2 = $this->m_umum->jumlah_record_filter('pegawai',$kondisi2);
        if(empty($id_jabatan_fungsional) OR $id_jabatan_fungsional == 0){
          $this->session->set_flashdata('danger', 'Jabatan Fungsional Harus Diisi');
          redirect(base_url('admin_perawat/user'));
        }
        else{
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
    						$Q = $this->m_admin_perawat->simpan_pegawai($fileData['file_name']);
  					  }else{
  						  $Q = $this->m_admin_perawat->simpan_pegawai_no_pic();
  					  }
    					$this->m_admin_perawat->simpan_user($Q,$kode);
    	//				$kondisi=array('id_pegawai'=>$Q);
    //					$jml = $this->m_umum->jumlah_record_filter('user',$kondisi);
    					$this->m_admin_perawat->simpan_perawat_detil2($Q);
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
    		//			$this->m_rancak->simpan_log_wa($no_hp,$id_user,$pesan);
    					$this->session->set_flashdata('sukses', 'Data berhasil Di Tambah');
    					redirect(base_url('admin_perawat/user'));
  				}
          }else{
            $this->session->set_flashdata('danger', 'NIP Sudah Ada');
  					redirect(base_url('admin_perawat/user'));
          }
			}
			else{
					$this->session->set_flashdata('danger', 'Username Sudah Ada');
					redirect(base_url('admin_perawat/user'));
			}
    }
     }
    }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
    		$data['title'] = "EDIT USER";
    		$take = $this->m_rperawat->ambil_id_perawat($data['id']);
    		$data['id_pegawai']  = set_value('id_pegawai',$take['id_pegawai']);
    		$data['nama_pegawai']  = set_value('nama_pegawai',$take['nama_pegawai']);
    		$data['email']  = set_value('email',$take['email']);
    		$data['no_hp']  = set_value('no_hp',$take['no_hp']);
    		$data['id_unit']  = set_value('id_unit',$take['id_unit']);
    		$data['id_ruangan']  = set_value('id_ruangan',$take['id_ruangan']);
    		$data['jk']  = set_value('jk',$take['jk']);
    		$data['foto']  = set_value('foto',$take['foto']);
    		$data['tipe_pegawai']  = set_value('tipe_pegawai',$take['tipe_pegawai']);
    		$data['id_jabatan_fungsional']  = set_value('id_jabatan_fungsional',$take['id_jabatan_fungsional']);
    		$data['nip']  = set_value('nip',$take['nip']);
    		$data['id_kode_kewenangan']  = set_value('id_kode_kewenangan',$take['id_kode_kewenangan']);
    		$this->form_validation->set_rules('nama_pegawai','nama_pegawai','required');
        if ($this->form_validation->run() === FALSE){
			       $this->tampil($data);
        }else{
          $nip= $this->input->post('nip');
          $nip_lama= $this->input->post('nip_lama');
          $id_jabatan_fungsional= $this->input->post('id_jabatan_fungsional');
          $kondisi2=array('nip'=>$nip,'nip !='=>$nip_lama);
    			$jml2 = $this->m_umum->jumlah_record_filter('pegawai',$kondisi2);
          if(empty($id_jabatan_fungsional) OR $id_jabatan_fungsional == 0){
            $this->session->set_flashdata('danger', 'Jabatan Fungsional Harus Diisi');
            redirect(base_url('admin_perawat/user'));
          }
          else{
      			if($jml2 == 0){
              $ptn = "/^0/";  // Regex
        			$str = $this->input->post('no_hp'); //Your input, perhaps $_POST['textbox'] or whatever
        			$rpltxt = "62";  // Replacement string
        			$no_hp = preg_replace($ptn, $rpltxt, $str);
        			$id_user= $this->session->id_user;
              $id_level= $this->input->post('id_level');
        			$id_ruangan= $this->input->post('id_ruangan');
        			$wa= $this->input->post('wa');
        			$akses = $this->m_umum->ambil_data('user_level','id_level',$id_level);
        			$unit = $this->m_umum->ambil_data('ruangan','id_ruangan',$id_ruangan);
        			$nama_level= $akses['nama_level'];
        			$nama_unit= $unit['nama_ruangan'];
        			$id_pegawai= $this->input->post('id_pegawai');
        			$nama_pegawai= $this->input->post('nama_pegawai');
        			$instance_name= $this->input->post('instance_name');
        			$pesan = "EDIT AKUN NAMA : ".$nama_pegawai." , LEVEL : ".$nama_level." , UNIT : ".$nama_unit." , HP : ".$str;
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
        						$this->m_admin_perawat->edit_pegawai($fileData['file_name']);
        					}else{
        						$this->m_admin_perawat->edit_pegawai_no_pic();
        					}
        					$kondisipd=array('id_pegawai'=>$id_pegawai);
        					$jmlpd = $this->m_umum->jumlah_record_filter('perawat_detil',$kondisipd);
        					if($jmlpd == 0){
        						$this->m_admin_perawat->simpan_perawat_detil();
        					}else{
        						$this->m_admin_perawat->edit_perawat_detil();
        					}

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
  //      					$this->m_rancak->simpan_log_wa($no_hp,$id_user,$pesan);
        					$this->session->set_flashdata('sukses', 'Data berhasil Di Rubah');
        					redirect(base_url('admin_perawat/user'));
        				}
            }else{
              $this->session->set_flashdata('danger', 'NIP Sudah Ada');
    					redirect(base_url('admin_perawat/user'));
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
      if($mode=='user_tambah'){
        $data['page'] =  $data['page']."_user_tambah";
    		$data['id_level']  = set_value('id_level',$this->input->post('id_level'));
    		$data['username']  = set_value('username',$this->input->post('username'));
    		$data['status_user']  = set_value('status_user',$this->input->post('status_user'));
    		$this->load->view("adminperawat/isi",$data);
      }
      if($mode=='simpan_tambah'){
    		$id_level= $this->input->post('id_level');
    		$id_pegawai= $this->input->post('id_pegawai');
    		$username= $this->input->post('username');
    		$username = strtolower($username);
    		$username = str_replace(' ', '-', $username);
    		$username = preg_replace('/[^A-Za-z0-9\-]/', '', $username);
    		$kondisi=array('username'=>$username);
    		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi);
    		$kondisi2=array('id_level'=>$id_level,'id_pegawai'=>$id_pegawai);
    		$jml = $this->m_umum->jumlah_record_filter('user',$kondisi2);
    		if($jml == 0){
    			if($jml2 == 0){
    				$kode = $this->m_rancak->kode_generator(15,'');
    			  if($this->m_admin_perawat->simpan_user($id_pegawai,$kode)){
    				$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
    				redirect(base_url('admin_perawat/user/edit/'.$id_pegawai));
    			  }else{
    				$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
    				redirect(base_url('admin_perawat/user/edit/'.$id_pegawai));
    			  }
    			}else{
    				$this->session->set_flashdata('danger', 'Level Sudah Ada');
    				redirect(base_url('admin_perawat/user/edit/'.$id_pegawai));
    			}
    		}else{
    			$this->session->set_flashdata('danger', 'Username Sudah Ada');
    			redirect(base_url('admin_perawat/user/edit/'.$id_pegawai));
    		}
      }
      if($mode=='user_edit'){
        $data['page'] =  $data['page']."_user_edit";
		$keuangan    = $this->m_umum->ambil_data('user','id_user',$data['id']);
		$data['id_level']  = set_value('id_level',$keuangan["id_level"]);
		$data['username']  = set_value('username',$keuangan["username"]);
		$data['status_user']  = set_value('status_user',$keuangan["status_user"]);
		$this->load->view("adminperawat/isi",$data);
      }
      if($mode=='simpan_edit'){
		  $id_level= $this->input->post('id_level');
		  $id_pegawai= $this->input->post('id_pegawai');
		if($id_level == '99'){
			$this->session->set_flashdata('danger', 'Tidak dapat mereset Superadmin');
			redirect(base_url('admin_perawat/user/edit/'.$id_pegawai));
		}else{
		  if($this->m_admin_perawat->edit_user()){
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
			redirect(base_url('admin_perawat/user/edit/'.$id_pegawai));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
			redirect(base_url('admin_perawat/user/edit/'.$id_pegawai));
		  }
		}
      }
		if($mode=='reset'){
			$d = $this->m_rancak->ambil_user_pegawai($data['id']);
			$no_hp = $d['no_hp'];
			$nama_pegawai = $d['nama_pegawai'];
			$nama_level = $d['nama_level'];
			$id_user = $this->session->id_user;
			if($d['id_level'] == '99'){
				$this->session->set_flashdata('danger', 'Tidak dapat mereset Superadmin');
				redirect(base_url('admin_perawat/user/edit/'.$data['idpeg']));
			}else{
			  if($this->m_admin_perawat->reset_password($data['id'])){
				$tansi = $this->m_umum->ambil_data('a_instansi','id_instansi','2');
				$instance_name = $tansi["nama_instansi"];
				$wa = $tansi["wa"];
				if($wa =='1'){
				$ptn = "/^0/";
				$rpltxt = "62";  // Replacement string
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
				$pesan = "RESET AKUN ADMIN ID/NAMA : ".$data['id']." - ".$nama_pegawai;
				$this->m_rancak->simpan_log_wa($no_hp,$id_user,$pesan);
				$this->session->set_flashdata('sukses', 'Password di Reset menjadi 7654321');
				redirect(base_url('admin_perawat/user/edit/'.$data['idpeg']));
			  }else{
					$this->session->set_flashdata('danger', 'Masalah Edit Data');
					redirect(base_url('admin_perawat/user/edit/'.$data['idpeg']));
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
	$data['link_awal'] = base_url('admin_perawat/user');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$program    = $this->m_umum->ambil_data('a_program','id_program','1');//ppni
	$data['program_unit'] = $program["unit"];
	$data['program_user_level'] = $program["user_level"];
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
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
		$data['int']   = $this->uri->segment(5, 0);
		$data['id']   = $this->uri->segment(4, 0);
	  if($mode=='view'){
			$this->tampil($data);
		}
    else if($mode=='data'){
		echo json_encode($this->m_admin_perawat->hak_akses_all($data['id']));
	}
		else{
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
        $data['hak_akses'] = $this->m_rancak->hak_akses($data['id'],$program['akses']);
    		$this->load->view("adminperawat/isi",$data);
      }
      if($mode=='simpan_tambah'){
    		$id_pegawai= $this->input->post('id_pegawai');
			  $this->m_admin_perawat->simpan_pegawai_akses();
				$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
				redirect(base_url('admin_perawat/akses/view/'.$id_pegawai));
      }
			if($mode=='status'){
					$pegakses = $this->m_umum->ambil_data('pegawai_akses','id_pegawai_akses',$data['int']);
				  if($this->m_admin_perawat->status_pegawai_akses($data['id'],$data['int'])){
						$this->session->set_flashdata('sukses', 'Sukses Rubah Status');
						redirect(base_url('admin_perawat/akses/view/'.$pegakses['id_pegawai']));	  	
				  }else{
						$this->session->set_flashdata('danger', 'Masalah Edit Data');
						redirect(base_url('admin_perawat/akses/view/'.$pegakses['id_pegawai']));
				  }
			}
		}
  }
  function cat_oppe($mode='view')
  {
		$data['page']  = "cat_oppe";
		$data['header'] = "CATATAN REKOMENDASI OPPE";
		$data['title'] = "CATATAN REKOMENDASI OPPE";
	$data['link_kembali'] = base_url();
	$data['link_awal'] = base_url('admin_perawat/cat_oppe');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$program    = $this->m_umum->ambil_data('a_program','id_program','1');//ppni
	$data['program_unit'] = $program["unit"];
	$data['program_user_level'] = $program["user_level"];
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
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
		$data['int']   = $this->uri->segment(5, 0);
		$data['id']   = $this->uri->segment(4, 0);
	  if($mode=='view'){
			$this->tampil($data);
		}
    else if($mode=='data'){
		echo json_encode($this->m_admin_perawat->kol_catatan_oppe());
	}
		else{
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
				$keuangan    = $this->m_umum->ambil_data('kol_catatan','kode_catatan',$data['id']);
				$data['nama_catatan']  = set_value('nama_catatan',$keuangan["nama_catatan"]);
				$data['isi_catatan']  = set_value('isi_catatan',$keuangan["isi_catatan"]);
				$data['kode_catatan']  = set_value('kode_catatan',$keuangan["kode_catatan"]);
    		$this->load->view("adminperawat/isi",$data);
      }
      if($mode=='simpan_edit'){
    		$id_pegawai= $this->input->post('id_pegawai');
			  $this->m_admin_perawat->rubah_catatan_oppe();
				$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
				redirect(base_url('admin_perawat/cat_oppe'));
      }
		}
  }
  function warna($mode='view')
  {
	$data['page']  = "warna";
	$data['header'] = "WARNA JADWAL";
	$data['title'] = "WARNA JADWAL";
	$data['link_kembali'] = base_url('admin_perawat');
	$data['link_awal'] = base_url('admin_perawat/warna');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$program    = $this->m_umum->ambil_data('a_program','id_program',$pegawai["id_program"]);
	$data['program_unit'] = $program["unit"];
	$data['program_user_level'] = $program["user_level"];
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
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
	$data['room_id'] = $pegawai["id_ruangan"];
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
		$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_admin_perawat->warna_all());
	}
/*     else if($mode=='hapus'){
		$kondisi=array('id_kompetensi'=>$data['id']);
		$jml = $this->m_umum->jumlah_record_filter('kr_kewenangan',$kondisi);
		if($jml == 0){
		  if($this->m_umum->hapus_data('kr_kompetensi','id_kompetensi',$data['id'])){
			$this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
			redirect(base_url('admin_perawat/kategori_kompetensi'));
		  }else{
			$this->session->set_flashdata('danger', 'Masalah Hapus Data');
			redirect(base_url('admin_perawat/kategori_kompetensi'));
		  }
		}else{
			$this->session->set_flashdata('danger', 'Data Sudah Masuk Alur');
			redirect(base_url('admin_perawat/kategori_kompetensi'));
		}
    } */
  else{
		$data['cmd_status'] = $this->m_rancak->cmd_status();
		$data['cmd_jabatan'] = $this->m_rancak->cmd_jabatan();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		$data['nama_warna']  = set_value('nama_warna',$this->input->post('nama_warna'));
		$data['kode_warna']  = set_value('kode_warna',$this->input->post('kode_warna'));
		$this->load->view("adminperawat/isi",$data);
      }
      if($mode=='simpan_tambah'){
		  if($this->m_admin_perawat->simpan_warna()){
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
			redirect(base_url('admin_perawat/warna'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
			redirect(base_url('admin_perawat/warna'));
		  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
		$keuangan    = $this->m_umum->ambil_data('kol_warna','id_warna',$data['id']);
		$data['nama_warna']  = set_value('nama_warna',$keuangan["nama_warna"]);
		$data['kode_warna']  = set_value('kode_warna',$keuangan["kode_warna"]);
		$this->load->view("adminperawat/isi",$data);
      }
      if($mode=='simpan_edit'){
		  if($this->m_admin_perawat->edit_warna()){
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
			redirect(base_url('admin_perawat/warna'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
			redirect(base_url('admin_perawat/warna'));
		  }
      }
	}
  }
  function kategori_kompetensi($mode='view')
  {
	$data['page']  = "kategori_kompetensi";
	$data['header'] = "KATEGORI KOMPETENSI";
	$data['title'] = "KATEGORI KOMPETENSI";
	$data['link_kembali'] = base_url('admin_perawat');
	$data['link_awal'] = base_url('admin_perawat/kategori_kompetensi');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$program    = $this->m_umum->ambil_data('a_program','id_program',$pegawai["id_program"]);
	$data['program_unit'] = $program["unit"];
	$data['program_user_level'] = $program["user_level"];
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
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
	$data['room_id'] = $pegawai["id_ruangan"];
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
		$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_admin_perawat->kompetensi_all());
	}
    else if($mode=='hapus'){
		$kondisi=array('id_kompetensi'=>$data['id']);
		$jml = $this->m_umum->jumlah_record_filter('kr_kewenangan',$kondisi);
		if($jml == 0){
		  if($this->m_umum->hapus_data('kr_kompetensi','id_kompetensi',$data['id'])){
			$this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
			redirect(base_url('admin_perawat/kategori_kompetensi'));
		  }else{
			$this->session->set_flashdata('danger', 'Masalah Hapus Data');
			redirect(base_url('admin_perawat/kategori_kompetensi'));
		  }
		}else{
			$this->session->set_flashdata('danger', 'Data Sudah Masuk Alur');
			redirect(base_url('admin_perawat/kategori_kompetensi'));
		}
    }
  else{
		$data['cmd_status'] = $this->m_rancak->cmd_status();
		$data['cmd_jabatan'] = $this->m_rancak->cmd_jabatan();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		$data['nama_kompetensi']  = set_value('nama_kompetensi',$this->input->post('nama_kompetensi'));
		$data['id_jabatan']  = set_value('id_jabatan',$this->input->post('id_jabatan'));
		$data['status_kompetensi']  = set_value('status_kompetensi',$this->input->post('status_kompetensi'));
		$this->load->view("adminperawat/isi",$data);
      }
      if($mode=='simpan_tambah'){
		  if($this->m_admin_perawat->simpan_kompetensi()){
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
			redirect(base_url('admin_perawat/kategori_kompetensi'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
			redirect(base_url('admin_perawat/kategori_kompetensi'));
		  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
		$keuangan    = $this->m_umum->ambil_data('kr_kompetensi','id_kompetensi',$data['id']);
		$data['nama_kompetensi']  = set_value('nama_kompetensi',$keuangan["nama_kompetensi"]);
		$data['id_jabatan']  = set_value('id_jabatan',$keuangan["id_jabatan"]);
		$data['status_kompetensi']  = set_value('status_kompetensi',$keuangan["status_kompetensi"]);
		$this->load->view("adminperawat/isi",$data);
      }
      if($mode=='simpan_edit'){
		  if($this->m_admin_perawat->edit_kompetensi()){
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
			redirect(base_url('admin_perawat/kategori_kompetensi'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
			redirect(base_url('admin_perawat/kategori_kompetensi'));
		  }
      }
	}
  }
  function kategori_kewenangan($mode='view')
  {
	$data['page']  = "kategori_kewenangan";
	$data['header'] = "KATEGORI KEWENANGAN";
	$data['title'] = "KATEGORI KEWENANGAN";
	$data['link_kembali'] = base_url('admin_perawat');
	$data['link_awal'] = base_url('admin_perawat/kategori_kewenangan');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$program    = $this->m_umum->ambil_data('a_program','id_program',$pegawai["id_program"]);
	$data['program_unit'] = $program["unit"];
	$data['program_user_level'] = $program["user_level"];
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
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
	$data['room_id'] = $pegawai["id_ruangan"];
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
	$data['id_jabatan'] = $this->uri->segment(4, 0);
	if(empty($data['id_jabatan'])){
		$data['id_jabatan'] = '0';
	}
	$data['cmd_jabatan_null'] = $this->m_rancak->cmd_jabatan_null();
    if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$id_jabatan = $this->input->post("id_jabatan");
			redirect(base_url('admin_perawat/kategori_kewenangan/view/'.$id_jabatan));
		}
	}
    else if($mode=='data'){
		echo json_encode($this->m_admin_perawat->kewenangan_all($data['id_jabatan']));
	}
    else if($mode=='hapus'){
		$kondisi=array('id_kewenangan'=>$data['id_jabatan']);
		$jml = $this->m_umum->jumlah_record_filter('kr_kewenangan_detil',$kondisi);
		if($jml == 0){
		  if($this->m_umum->hapus_data('kr_kewenangan','id_kewenangan',$data['id_jabatan'])){
			$this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
			redirect(base_url('admin_perawat/kategori_kewenangan'));
		  }else{
			$this->session->set_flashdata('danger', 'Masalah Hapus Data');
			redirect(base_url('admin_perawat/kategori_kewenangan'));
		  }
		}else{
			$this->session->set_flashdata('danger', 'Data Sudah Masuk Alur');
			redirect(base_url('admin_perawat/kategori_kewenangan'));
		}
    }
  else{
		$data['cmd_kompetensi'] = $this->m_rperawat->cmd_kompetensi();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		$data['nama_kewenangan']  = set_value('nama_kewenangan',$this->input->post('nama_kewenangan'));
		$data['id_kompetensi']  = set_value('id_kompetensi',$this->input->post('id_kompetensi'));
		$data['wkt_kewenangan']  = set_value('wkt_kewenangan',$this->input->post('wkt_kewenangan'));
		$this->load->view("adminperawat/isi",$data);
      }
      if($mode=='simpan_tambah'){
		  if($this->m_admin_perawat->simpan_kewenangan()){
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
			redirect(base_url('admin_perawat/kategori_kewenangan'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
			redirect(base_url('admin_perawat/kategori_kewenangan'));
		  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
		$keuangan    = $this->m_umum->ambil_data('kr_kewenangan','id_kewenangan',$data['id_jabatan']);
		$data['nama_kewenangan']  = set_value('nama_kewenangan',$keuangan["nama_kewenangan"]);
		$data['id_kompetensi']  = set_value('id_kompetensi',$keuangan["id_kompetensi"]);
		$data['wkt_kewenangan']  = set_value('wkt_kewenangan',$keuangan["wkt_kewenangan"]);
		$this->load->view("adminperawat/isi",$data);
      }
      if($mode=='simpan_edit'){
		  if($this->m_admin_perawat->edit_kewenangan()){
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
			redirect(base_url('admin_perawat/kategori_kewenangan'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
			redirect(base_url('admin_perawat/kategori_kewenangan'));
		  }
      }
	}
  }
  function kompetensi($mode='view')
  {
	$data['page']  = "kompetensi";
	$data['header'] = "KOMPETENSI";
	$data['title'] = "KOMPETENSI";
	$data['link_kembali'] = base_url('admin_perawat');
	$data['link_awal'] = base_url('admin_perawat/kategori_kewenangan');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$program    = $this->m_umum->ambil_data('a_program','id_program',$pegawai["id_program"]);
	$data['program_jabatan'] = $program["jabatan"];
	$data['program_user_level'] = $program["user_level"];
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
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
	$data['room_id'] = $pegawai["id_ruangan"];
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
	if(empty($data['id'])){
		$data['id'] = '0';
	}
	$data['cmd_ruangan'] = $this->m_rancak->cmd_ruangan();
    if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$id = $this->input->post("id");
			redirect(base_url('admin_perawat/kompetensi/view/'.$id));
		}
	}
    else if($mode=='data'){
		echo json_encode($this->m_admin_perawat->kewenangan_detil_all($data['id']));
	}
/*     else if($mode=='hapus'){
		$kondisi=array('id_kewenangan'=>$data['id']);
		$jml = $this->m_umum->jumlah_record_filter('kr_kewenangan_detil',$kondisi);
		if($jml == 0){
		  if($this->m_umum->hapus_data('kr_kewenangan','id_kewenangan',$data['id'])){
			$this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
			redirect(base_url('admin_perawat/kategori_kewenangan'));
		  }else{
			$this->session->set_flashdata('danger', 'Masalah Hapus Data');
			redirect(base_url('admin_perawat/kategori_kewenangan'));
		  }
		}else{
			$this->session->set_flashdata('danger', 'Data Sudah Masuk Alur');
			redirect(base_url('admin_perawat/kategori_kewenangan'));
		}
    } */
  else{
		$data['cmd_sifat_kewenangan_null'] = $this->m_rperawat->cmd_sifat_kewenangan_null();
		$data['cmd_sifat_kewenangan'] = $this->m_rperawat->cmd_sifat_kewenangan();
		$data['cmd_kewenangan'] = $this->m_rperawat->cmd_kewenangan();
		$data['cmd_kewenangan_with_jabatan'] = $this->m_rperawat->cmd_kewenangan_with_jabatan($data['id']);
		$data['cmd_kode_kewenangan'] = $this->m_rperawat->cmd_kode_kewenangan();
		$data['cmd_kode_kewenangan_null'] = $this->m_rperawat->cmd_kode_kewenangan_null();
		$data['cmd_ruangan'] = $this->m_rancak->cmd_ruangan();
		$data['cmd_ruangan_unit'] = $this->m_rancak->ambil_data_radiologi_unit();
		$data['cmd_jabatan_null'] = $this->m_rancak->cmd_jabatan_null();
		$data['cmd_ruangan_rperawat'] = $this->m_rperawat->cmd_ruangan();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		$data['id_kewenangan']  = set_value('id_kewenangan',$this->input->post("id_kewenangan"));
		$data['id_kode_kewenangan']  = set_value('id_kode_kewenangan',$this->input->post("id_kode_kewenangan"));
		$data['id_sifat_kewenangan']  = set_value('id_sifat_kewenangan',$this->input->post("id_sifat_kewenangan"));
		$this->form_validation->set_rules('id_kewenangan','id_kewenangan','required');
        if ($this->form_validation->run() === FALSE){
			$this->tampil($data);

        }else{
			$this->m_admin_perawat->simpan_kewenangan_detil();
			$this->session->set_flashdata('sukses', 'Data Sudah Di Tambah & Data Dobel Tidak Di Tambah');
			redirect(base_url('admin_perawat/kompetensi'));
        }
      }
      if($mode=='tambah_unit'){
        $data['page'] =  $data['page']."_tambah_unit";
				$data['id_unit']  = set_value('id_unit',$this->input->post("id_unit"));
				$data['id_kewenangan']  = set_value('id_kewenangan',$this->input->post("id_kewenangan"));
				$data['id_kode_kewenangan']  = set_value('id_kode_kewenangan',$this->input->post("id_kode_kewenangan"));
				$data['id_sifat_kewenangan']  = set_value('id_sifat_kewenangan',$this->input->post("id_sifat_kewenangan"));
		$this->form_validation->set_rules('id_unit','id_unit','required');
        if ($this->form_validation->run() === FALSE){
					$this->tampil($data);
				}else{
					$action = $this->input->post('action');
					if($action == 'BtnProses') {
						$id_jabatan = $this->input->post("id_jabatan");
						redirect(base_url('admin_perawat/kompetensi/tambah_unit/'.$id_jabatan));
					}
					if($action == 'BtnSimpan') {
						$this->m_admin_perawat->simpan_kewenangan_detil_unit();
						$this->session->set_flashdata('sukses', 'Data Sudah Di Tambah & Data Dobel Tidak Di Tambah');
						redirect(base_url('admin_perawat/kompetensi'));
					}
        }
      }
      if($mode=='clone'){
        $data['page'] =  $data['page']."_clone";
		$keuangan    = $this->m_umum->ambil_data('kr_kewenangan_detil','id_kewenangan_detil',$data['id']);
		$data['id_kewenangan']  = set_value('id_kewenangan',$keuangan["id_kewenangan"]);
		$data['id_kode_kewenangan']  = set_value('id_kode_kewenangan',$keuangan["id_kode_kewenangan"]);
		$data['id_sifat_kewenangan']  = set_value('id_sifat_kewenangan',$keuangan["id_sifat_kewenangan"]);
		$this->form_validation->set_rules('id_kewenangan','id_kewenangan','required');
        if ($this->form_validation->run() === FALSE){
			$this->tampil($data);
        }else{
			$this->m_admin_perawat->simpan_kewenangan_detil();
			$this->session->set_flashdata('sukses', 'Data Sudah Di Tambah & Data Dobel Tidak Di Tambah');
			redirect(base_url('admin_perawat/kompetensi'));
        }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
    		$keuangan    = $this->m_umum->ambil_data('kr_kewenangan_detil','id_kewenangan_detil',$data['id']);
    		$data['id_kewenangan']  = set_value('id_kewenangan',$keuangan["id_kewenangan"]);
    		$data['id_kode_kewenangan']  = set_value('id_kode_kewenangan',$keuangan["id_kode_kewenangan"]);
    		$data['id_sifat_kewenangan']  = set_value('id_sifat_kewenangan',$keuangan["id_sifat_kewenangan"]);
    		$data['id_unit']  = set_value('id_unit',$keuangan["id_unit"]);
    		$this->load->view("adminperawat/isi",$data);
      }
      if($mode=='simpan_edit'){
			$id_kewenangan = $this->input->post('id_kewenangan');
			$id_kode_kewenangan = $this->input->post('id_kode_kewenangan');
			$id_sifat_kewenangan = $this->input->post('id_sifat_kewenangan');
			$id_unit = $this->input->post('id_unit');
			$id_kewenangan_lama = $this->input->post('id_kewenangan_lama');
			$id_kode_kewenangan_lama = $this->input->post('id_kode_kewenangan_lama');
			$id_sifat_kewenangan_lama = $this->input->post('id_sifat_kewenangan_lama');
			$id_unit_lama = $this->input->post('id_unit_lama');
			$kondisi=array('id_kewenangan'=>$id_kewenangan,'id_kode_kewenangan'=>$id_kode_kewenangan,
				'id_sifat_kewenangan'=>$id_sifat_kewenangan,'id_unit'=>$id_unit,
				'id_kewenangan !='=>$id_kewenangan_lama,'id_kode_kewenangan !='=>$id_kode_kewenangan_lama,
				'id_sifat_kewenangan !='=>$id_sifat_kewenangan_lama,'id_unit !='=>$id_unit_lama);
			$jml = $this->m_umum->jumlah_record_filter('kr_kewenangan_detil',$kondisi);
			if($jml == 0){
			  if($this->m_admin_perawat->edit_kewenangan_detil()){
				$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
				redirect(base_url('admin_perawat/kompetensi'));
			  }else{
				$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
				redirect(base_url('admin_perawat/kompetensi'));
			  }
			}else{
				$this->session->set_flashdata('danger', 'Data Sudah Ada');
				redirect(base_url('admin_perawat/kompetensi'));
			}
      }
	}
  }
  function jabfungstatus_data($ide)
  {
	if($ide=='2'){
		$id = '1';
	}else{
		$id = $ide;
	}
    $dt=$this->m_rancak->ambil_data_dropdown_jabfung_status($id);
    echo json_encode($dt);
  }
  function butir_kegiatan($mode='view')
  {
	$data['page']  = "butir_kegiatan";
	$data['header'] = "BUTIR KEGIATAN";
	$data['title'] = "BUTIR KEGIATAN";
	$data['link_kembali'] = base_url('admin_perawat');
	$data['link_awal'] = base_url('admin_perawat/butir_kegiatan');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$program    = $this->m_umum->ambil_data('a_program','id_program',$pegawai["id_program"]);
	$data['program_unit'] = $program["unit"];
	$data['program_user_level'] = $program["user_level"];
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
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
	$data['room_id'] = $pegawai["id_ruangan"];
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
	$data['cmd_jabfung'] = $this->m_rperawat->cmd_jabfung();
	$data['cmd_tipe_pegawai'] = $this->m_rancak->cmd_tipe_pegawai();
	$data['id_status_pegawai']  = set_value('id_status_pegawai',$this->input->post('id_status_pegawai'));
    if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$id = $this->input->post("id");
			redirect(base_url('admin_perawat/butir_kegiatan/view/'.$id));
		}
	}
    else if($mode=='data'){
		echo json_encode($this->m_admin_perawat->butir_kegiatan_all($data['id']));
	}
/*     else if($mode=='hapus'){
		$kondisi=array('id_kompetensi'=>$data['id']);
		$jml = $this->m_umum->jumlah_record_filter('kr_kewenangan',$kondisi);
		if($jml == 0){
		  if($this->m_umum->hapus_data('kr_kompetensi','id_kompetensi',$data['id'])){
			$this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
			redirect(base_url('admin_perawat/kategori_kompetensi'));
		  }else{
			$this->session->set_flashdata('danger', 'Masalah Hapus Data');
			redirect(base_url('admin_perawat/kategori_kompetensi'));
		  }
		}else{
			$this->session->set_flashdata('danger', 'Data Sudah Masuk Alur');
			redirect(base_url('admin_perawat/kategori_kompetensi'));
		}
    } */
  else{
	  $data['cmd_jabatan_fungsional'] = $this->m_rperawat->cmd_jabatan_fungsional($program['jabatan'],$pegawai['id_level']);
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
    		$data['nama_butir_kegiatan']  = set_value('nama_butir_kegiatan',$this->input->post('nama_butir_kegiatan'));
    		$data['id_jabatan_fungsional']  = set_value('id_jabatan_fungsional',$this->input->post('id_jabatan_fungsional'));
    		$data['ms_angka_kredit']  = set_value('ms_angka_kredit',$this->input->post('ms_angka_kredit'));
    		$data['ms_satuan_hasil']  = set_value('ms_satuan_hasil',$this->input->post('ms_satuan_hasil'));
    		$this->load->view("adminperawat/isi",$data);
      }
      if($mode=='simpan_tambah'){
  		  if($this->m_admin_perawat->simpan_butir_kegiatan()){
  			   $this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
  			   redirect(base_url('admin_perawat/butir_kegiatan'));
  		  }else{
  			   $this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
  			   redirect(base_url('admin_perawat/butir_kegiatan'));
  		  }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
    		$keuangan    = $this->m_umum->ambil_data('butir_kegiatan','id_butir_kegiatan',$data['id']);
    		$data['nama_butir_kegiatan']  = set_value('nama_butir_kegiatan',$keuangan["nama_butir_kegiatan"]);
    		$data['id_jabatan_fungsional']  = set_value('id_jabatan_fungsional',$keuangan["id_jabatan_fungsional"]);
    		$data['ms_angka_kredit']  = set_value('ms_angka_kredit',number_format($keuangan["angka_kredit"],3));
    		$data['ms_satuan_hasil']  = set_value('ms_satuan_hasil',$keuangan["satuan_hasil"]);
    		$this->load->view("adminperawat/isi",$data);
      }
      if($mode=='simpan_edit'){
  		  if($this->m_admin_perawat->edit_butir_kegiatan()){
    			$this->session->set_flashdata('sukses', 'Data Berhasil Di Rubah');
    			redirect(base_url('admin_perawat/butir_kegiatan'));
  		  }else{
    			$this->session->set_flashdata('danger', 'Ada Kesalahan Edit Data');
    			redirect(base_url('admin_perawat/butir_kegiatan'));
  		  }
      }
	}
  }
  function jabfungperawat_data($id)
  {
    $dt=$this->m_rperawat->ambil_data_dropdown_jabfung_perawat($id);
    echo json_encode($dt);
  }
  function butir_kewenangan($mode='view')
  {
	$data['page']  = "butir_kewenangan";
	$data['header'] = "BUTIR KEGIATAN KEWENANGAN";
	$data['title'] = "BUTIR KEGIATAN KEWENANGAN";
	$data['link_kembali'] = base_url('admin_perawat');
	$data['link_awal'] = base_url('admin_perawat/butir_kewenangan');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$program    = $this->m_umum->ambil_data('a_program','id_program',$pegawai["id_program"]);
	$data['program_unit'] = $program["unit"];
	$data['program_user_level'] = $program["user_level"];
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
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
	$data['room_id'] = $pegawai["id_ruangan"];
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
	$data['id_jabatan_fungsional'] = $this->uri->segment(4, 0);
	if(empty($data['id_jabatan_fungsional'])){
		$data['id_jabatan_fungsional'] = '1';
	}
	$data['id_butir_kegiatan'] = $this->uri->segment(5, 0);
	if(empty($data['id_butir_kegiatan'])){
		$data['id_butir_kegiatan'] = '1';
	}
	$data['cmd_jabatan_fungsional']=$this->m_rperawat->cmd_jabatan_fungsional($program['jabatan'],$pegawai['id_level']);
	$data['cmd_butir_kegiatan']=$this->m_rperawat->cmd_butir_kegiatan($data['id_jabatan_fungsional']);
	$data['id_status_pegawai']  = set_value('id_status_pegawai',$this->input->post('id_status_pegawai'));
    if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$id_jabatan_fungsional = $this->input->post("id_jabatan_fungsional");
			$id_butir_kegiatan = $this->input->post("id_butir_kegiatan");
			redirect(base_url('admin_perawat/butir_kewenangan/view/'.$id_jabatan_fungsional.'/'.$id_butir_kegiatan));
		}
	}
    else if($mode=='data'){
		echo json_encode($this->m_admin_perawat->butir_kewenangan_all($data['id_butir_kegiatan']));
	}
/*     else if($mode=='hapus'){
		$kondisi=array('id_kompetensi'=>$data['id']);
		$jml = $this->m_umum->jumlah_record_filter('kr_kewenangan',$kondisi);
		if($jml == 0){
		  if($this->m_umum->hapus_data('kr_kompetensi','id_kompetensi',$data['id'])){
			$this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
			redirect(base_url('admin_perawat/kategori_kompetensi'));
		  }else{
			$this->session->set_flashdata('danger', 'Masalah Hapus Data');
			redirect(base_url('admin_perawat/kategori_kompetensi'));
		  }
		}else{
			$this->session->set_flashdata('danger', 'Data Sudah Masuk Alur');
			redirect(base_url('admin_perawat/kategori_kompetensi'));
		}
    } */
  else{
      if($mode=='tambah'){
		$data['page'] =  $data['page']."_tambah";
        $data['id_kode_kewenangan']   = $this->uri->segment(6, 0);
		$data['kr_jabatan_fungsional']=$this->m_rperawat->kr_jabatan_fungsional($data['id_butir_kegiatan']);
		$data['kewenangan']   = $this->m_rperawat->kr_jabfung($data['id_kode_kewenangan'],$pegawai['id_jabatan'],$pegawai['id_level']);
		$this->form_validation->set_rules('id_butir_kegiatan','id_butir_kegiatan','required');
        if ($this->form_validation->run() === FALSE){
			$this->tampil($data);
        }else{
			$id_jabatan_fungsional = $this->input->post("id_jabatan_fungsional");
			$id_butir_kegiatan = $this->input->post("id_butir_kegiatan");
			$this->m_admin_perawat->simpan_kr_jabfung();
			$this->session->set_flashdata('sukses', 'Data Sudah Di Tambah');
			redirect(base_url('admin_perawat/butir_kewenangan/view/'.$id_jabatan_fungsional.'/'.$id_butir_kegiatan));
        }
      }
	}
  }
/*   function butir_pegawai($mode='view')
  {
	$data['page']  = "butir_pegawai";
	$data['header'] = "SETING BUTIR KEGIATAN PEGAWAI";
	$data['title'] = "SETING BUTIR KEGIATAN PEGAWAI";
	$data['link_kembali'] = base_url('admin_perawat');
	$data['link_awal'] = base_url('admin_perawat/butir_pegawai');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$program    = $this->m_umum->ambil_data('a_program','id_program',$pegawai["id_program"]);
	$data['program_unit'] = $program["unit"];
	$data['program_user_level'] = $program["user_level"];
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
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
	$data['room_id'] = $pegawai["id_ruangan"];
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
	$data['id_jabatan'] = $this->uri->segment(4, 0);
	if(empty($data['id_jabatan'])){
		$data['id_jabatan'] = '0';
	}
	$data['cmd_jabatan_null']=$this->m_rancak->cmd_jabatan_null();
    if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$id_jabatan = $this->input->post("id_jabatan");
			redirect(base_url('admin_perawat/butir_pegawai/view/'.$id_jabatan));
		}
	}
    else if($mode=='data'){
		echo json_encode($this->m_admin_perawat->kr_jabfung_all($data['id_jabatan']));
	}
     else if($mode=='hapus'){
		$kondisi=array('id_kompetensi'=>$data['id']);
		$jml = $this->m_umum->jumlah_record_filter('kr_kewenangan',$kondisi);
		if($jml == 0){
		  if($this->m_umum->hapus_data('kr_kompetensi','id_kompetensi',$data['id'])){
			$this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
			redirect(base_url('admin_perawat/kategori_kompetensi'));
		  }else{
			$this->session->set_flashdata('danger', 'Masalah Hapus Data');
			redirect(base_url('admin_perawat/kategori_kompetensi'));
		  }
		}else{
			$this->session->set_flashdata('danger', 'Data Sudah Masuk Alur');
			redirect(base_url('admin_perawat/kategori_kompetensi'));
		}
    }
  else{
      if($mode=='tambah'){
		$data['page'] =  $data['page']."_tambah";
        $data['id_kode_kewenangan']   = $this->uri->segment(6, 0);
		$data['kr_jabatan_fungsional']=$this->m_rperawat->kr_jabatan_fungsional($data['id_butir_kegiatan']);
		$data['kewenangan']   = $this->m_rperawat->kr_jabfung($data['id_kode_kewenangan'],$pegawai['id_jabatan'],$pegawai['id_level']);
		$this->form_validation->set_rules('id_butir_kegiatan','id_butir_kegiatan','required');
        if ($this->form_validation->run() === FALSE){
			$this->tampil($data);
        }else{
			$id_jabatan_fungsional = $this->input->post("id_jabatan_fungsional");
			$id_butir_kegiatan = $this->input->post("id_butir_kegiatan");
			$this->m_admin_perawat->simpan_kr_jabfung();
			$this->session->set_flashdata('sukses', 'Data Sudah Di Tambah');
			redirect(base_url('admin_perawat/butir_kewenangan/view/'.$id_jabatan_fungsional.'/'.$id_butir_kegiatan));
        }
      }
	}
  } */
  function seting_dupak($mode='view')
  {
	$data['page']  = "seting_dupak";
	$data['header'] = "AKTIF / NON AKTIFKAN BUTIR KEGIATAN KEWENANGAN PERAWAT";
	$data['title'] = "AKTIF / NON AKTIFKAN BUTIR KEGIATAN KEWENANGAN PERAWAT";
	$data['link_kembali'] = base_url('admin_perawat');
	$data['link_awal'] = base_url('admin_perawat/seting_dupak');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$program    = $this->m_umum->ambil_data('a_program','id_program',$pegawai["id_program"]);
	$data['program_unit'] = $program["unit"];
	$data['program_user_level'] = $program["user_level"];
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
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
	$data['room_id'] = $pegawai["id_ruangan"];
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
	$data['id_pegawai'] = $this->uri->segment(4, 0);
	if(empty($data['id_pegawai'])){
		$data['id_pegawai'] = '0';
	}
	$data['bulan'] = $this->uri->segment(5, 0);
	if(empty($data['bulan'])){
		$data['bulan'] = date('m');
	}
	$data['tahun'] = $this->uri->segment(6, 0);
	if(empty($data['tahun'])){
		$data['tahun'] = date('Y');
	}
	$data['cmd_bulan']=$this->m_rancak->cmd_bulan();
	$data['cmd_range_tahun']=$this->m_rancak->cmd_range_tahun(date('Y')-5,date('Y')+5);
	$data['cmd_pegawai']=$this->m_rancak->cmd_pegawai_null_with_unit_source_jabatan($program['jabatan'],$pegawai['id_level']);
    if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$id_pegawai = $this->input->post("id_pegawai");
			$bulan = $this->input->post("bulan");
			$tahun = $this->input->post("tahun");
			redirect(base_url('admin_perawat/seting_dupak/view/'.$id_pegawai.'/'.$bulan.'/'.$tahun));
		}
	}
    else if($mode=='data'){
		echo json_encode($this->m_admin_perawat->buket_pegawai($data['id_pegawai'],$data['bulan'],$data['tahun']));
	}
    else if($mode=='status'){
		$status_buket_pegawai   = $this->uri->segment(5, 0);
		$id_buket_pegawai   = $this->uri->segment(6, 0);
		$this->m_admin_perawat->status_buket_pegawai_rubah($id_buket_pegawai,$status_buket_pegawai);
		redirect(base_url('admin_perawat/seting_dupak/view/'.$data['id_pegawai']));
	}
    else if($mode=='hapus'){
		$id_buket_pegawai   = $this->uri->segment(5, 0);
		if($this->m_umum->hapus_data('kr_buket_pegawai','id_buket_pegawai',$id_buket_pegawai)){
			$this->session->set_flashdata('sukses', 'Data Sudah Di Hapus');
			redirect(base_url('admin_perawat/seting_dupak/view/'.$data['id_pegawai']));
		}else{
			$this->session->set_flashdata('danger', 'Masalah Hapus Data');
			redirect(base_url('admin_perawat/seting_dupak/view/'.$data['id_pegawai']));
		}
    }
  }
  function lulus($mode='view')
  {
	$data['page']  = "lulus";
	$data['header'] = "DATA KELULUSAN KEWENANGAN";
	$data['title'] = "DATA KELULUSAN KEWENANGAN";
	$data['link_kembali'] = base_url('pegawai');
	$data['link_awal'] = base_url('pegawai/lulus');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$program    = $this->m_umum->ambil_data('a_program','id_program',$pegawai["id_program"]);
	$data['program_unit'] = $program["unit"];
	$data['program_user_level'] = $program["user_level"];
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
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
	$data['jabatan_id'] = $pegawai["id_jabatan"];
	$data['member_id'] = $pegawai["id_pegawai"];
	$data['room_id'] = $pegawai["id_ruangan"];
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
	$data['cmd_pegawai']=$this->m_rancak->cmd_pegawai_null_with_unit_source_jabatan($program['jabatan'],$pegawai['id_level']);
	$data['id'] = $this->uri->segment(4, 0);
	$data['id_kompetensi'] = $this->uri->segment(5, 0);
	if(empty($data['id'])){
		$data['id'] = '0';
	}
	if(empty($data['id_kompetensi'])){
		$data['id_kompetensi'] = '0';
	}
    if($mode=='view'){
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$id = $this->input->post('id');
			redirect(base_url('admin_perawat/lulus/view/'.$id));
		}
	}
    else if($mode=='data'){
		echo json_encode($this->m_admin_perawat->lulus_all($data['id']));
	}
    else if($mode=='hapus'){
    $kondisi=array('id_pegawai'=>$data['id'],'id_kewenangan_lulus'=>$data['id_kompetensi']);
		$this->m_umum->hapus_data_kondisi('kr_kewenangan_lulus',$kondisi);
		redirect(base_url('admin_perawat/lulus/view/'.$data['id']));
    }
  else{
	//	$data['ambil_kr_kewenangan']=$this->m_rancak->ambil_kr_kewenangan($program['jabatan'],$pegawai['id_level']);
	//	$data['ambil_kr_kewenangan']=$this->m_rancak->ambil_kompetensi_all($data['id']);
		$data['ambil_kr_kewenangan']=$this->m_rancak->ambil_kompetensi_all();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		if(empty($data['id']) || $data['id'] == '0'){
			$this->session->set_flashdata('danger', 'Silahkan Pilih Pegawai Dulu');
			redirect(base_url('admin_perawat/lulus/view/'.$data['id']));
		}
		$ambil_pegawai=$this->m_rancak->ambil_pegawai($data['id']);
		$data['ambil_kr_kewenangan_per_kompetensi']=$this->m_rancak->ambil_kr_kewenangan_per_kompetensi($data['id_kompetensi'],$ambil_pegawai['id_jabatan']);
		$data['kewenangan_lulus_pegawai']=$this->m_rancak->kewenangan_lulus_pegawai($data['id']);
		$this->tampil($data);
		$action = $this->input->post('action');
		if($action == 'BtnProses') {
			$id = $this->input->post('id');
			$id_kompetensi = $this->input->post('id_kompetensi');
			redirect(base_url('admin_perawat/lulus/tambah/'.$id.'/'.$id_kompetensi));
		}
		if($action == 'BtnSimpan') {
			$id = $this->input->post('id');
			$this->m_admin_perawat->simpan_lulus_kewenangan();
			$this->session->set_flashdata('sukses', 'Data Sudah Di Tambah');
			redirect(base_url('admin_perawat/lulus/view/'.$id));
		}
	  }
	}
  }
	function intro(){
		$data['page']="intro";
		$data['header'] = "SETING INTRO DAN HEADER WEBSITE";
		$data['title'] = "SETING INTRO DAN HEADER WEBSITE";
		$pegawai=$this->m_rperawat->ambil_user_perawat($this->session->id_user);
		$program    = $this->m_umum->ambil_data('a_program','id_program','1');
		$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
		$data['instance_id'] = $instansi["id_instansi"];
		$data['instance_name'] = $instansi["nama_instansi"];
		$data['idescription'] = $instansi["description"];
		$data['ikeywords'] = $instansi["keywords"];
		$data['iheader'] = $instansi["header"];
		$data['iheader_mini'] = $instansi["header_mini"];
		$data['ifooter'] = $instansi["footer"];
		$data['ilicensed'] = $instansi["licensed"];
		$data['member_id'] = $pegawai["id_pegawai"];
		$data['member_name'] = $pegawai["nama_pegawai"];
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
		//======================= IMPORTANT =========================================
		$data['welcome'] = $instansi["welcome"];
		$data['web_header'] = $instansi["web_header"];
		$data['web_intro'] = $instansi['web_intro'];
		$data['web_slider'] = $instansi['web_slider'];
		$this->form_validation->set_rules('id_instansi','id_instansi','required');
        if ($this->form_validation->run() === FALSE){
			$this->tampil($data);
        }else{
		  if($this->m_admin_perawat->edit_web()){
			$this->session->set_flashdata('sukses', 'Data Sudah Di Rubah');
			redirect(base_url('admin_perawat/intro'));
		  }else{
			$this->session->set_flashdata('danger', 'Masalah Edit Data');
			redirect(base_url('admin_perawat/intro'));
		  }
        }
	}
  function faq($mode='view')
  {
	$data['page']  = "faq";
	$data['header'] = "DATA FREQUENTLY ASKED QUESTION";
	$data['title'] = "DATA FREQUENTLY ASKED QUESTION";
	$data['link_kembali'] = base_url('pegawai');
	$data['link_awal'] = base_url('pegawai/faq');
	$pegawai=$this->m_rancak->ambil_user_pegawai($this->session->id_user);
	$program    = $this->m_umum->ambil_data('a_program','id_program',$pegawai["id_program"]);
	$data['program_unit'] = $program["unit"];
	$data['program_user_level'] = $program["user_level"];
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi',1);
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
	$data['jabatan_id'] = $pegawai["id_jabatan"];
	$data['member_id'] = $pegawai["id_pegawai"];
	$data['room_id'] = $pegawai["id_ruangan"];
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
	$data['cmd_pegawai']=$this->m_rancak->cmd_pegawai_null_with_unit_source_jabatan($program['jabatan'],$pegawai['id_level']);
	$data['id'] = $this->uri->segment(4, 0);
    if($mode=='view'){
		$this->tampil($data);
	}
    else if($mode=='data'){
		echo json_encode($this->m_admin_perawat->faq_all());
	}
    else if($mode=='upload'){
		echo json_encode($this->m_admin_perawat->upload_all());
	}
    else if($mode=='hapus'){
		$this->m_umum->hapus_data('faq','id_faq',$data['id']);
		$this->session->set_flashdata('sukses', 'Berkas Sudah Di Hapus');
		redirect(base_url('admin_perawat/faq'));
    }
  else{
		$data['cmd_status']=$this->m_rancak->cmd_status();
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah";
		$data['judul_faq']  = set_value('judul_faq',$this->input->post('judul_faq'));
		$data['isi_faq']  = set_value('isi_faq',$this->input->post('isi_faq'));
		$data['status_faq']  = set_value('status_faq',$this->input->post('status_faq'));
		$data['faq']  = set_value('faq',$this->input->post('faq'));
		$this->form_validation->set_rules('faq','faq','required');
        if ($this->form_validation->run() === FALSE){
			$this->tampil($data);
        }else{
		  if($this->m_admin_perawat->simpan_faq()){
			$this->session->set_flashdata('sukses', 'Data Sudah Di Rubah');
			redirect(base_url('admin_perawat/faq'));
		  }else{
			$this->session->set_flashdata('danger', 'Masalah Edit Data');
			redirect(base_url('admin_perawat/faq'));
		  }
        }
	  }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit";
		$faq = $this->m_umum->ambil_data('faq','id_faq',$data['id']);
		$data['id_faq']  = set_value('id_faq',$faq['id_faq']);
		$data['judul_faq']  = set_value('judul_faq',$faq['judul_faq']);
		$data['isi_faq']  = set_value('isi_faq',$faq['isi_faq']);
		$data['status_faq']  = set_value('status_faq',$faq['status_faq']);
		$data['faq']  = set_value('faq',$faq['faq']);
		$this->form_validation->set_rules('faq','faq','required');
        if ($this->form_validation->run() === FALSE){
			$this->tampil_top($data);
        }else{
		  if($this->m_admin_perawat->edit_faq()){
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
			redirect(base_url('admin_perawat/faq'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
			redirect(base_url('admin_perawat/faq'));
		  }
        }
      }
/*       if($mode=='input'){
        $data['page'] =  $data['page']."_input";
		$data['nama_faq_image']  = set_value('nama_faq_image',$this->input->post("nama_faq_image"));
		$data['status_faq_image']  = set_value('status_faq_image',$this->input->post("status_faq_image"));
		$this->form_validation->set_rules('nama_faq_image','nama_faq_image','required');
        if ($this->form_validation->run() === FALSE){
			$this->tampil($data);
        }else{
			$data = array();
			$filesCount = count($_FILES['upload_Files']['name']);
			for($i = 0; $i < $filesCount; $i++){
				$_FILES['upload_File']['name'] = $_FILES['upload_Files']['name'][$i];
				$_FILES['upload_File']['type'] = $_FILES['upload_Files']['type'][$i];
				$_FILES['upload_File']['tmp_name'] = $_FILES['upload_Files']['tmp_name'][$i];
				$_FILES['upload_File']['error'] = $_FILES['upload_Files']['error'][$i];
				$_FILES['upload_File']['size'] = $_FILES['upload_Files']['size'][$i];
				$uploadPath = 'assets/faq/';
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['encrypt_name'] = TRUE;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if($this->upload->do_upload('upload_File')){
					$fileData = $this->upload->data();
					$this->m_admin_perawat->simpan_image($fileData['file_name']);
					$this->session->set_flashdata('sukses', 'Data berhasil Di Simpan');
					redirect(base_url('admin_perawat/faq'));
				}else{
					$this->session->set_flashdata('danger', 'Data Gagal Di Simpan');
					redirect(base_url('admin_perawat/faq'));
				}
			}
		}
	  }
      if($mode=='rubah'){
        $data['page'] =  $data['page']."_rubah";
		$faq = $this->m_umum->ambil_data('faq_image','id_faq_image',$data['id']);
		$data['id_faq_image']  = set_value('id_faq_image',$faq['id_faq_image']);
		$data['nama_faq_image']  = set_value('nama_faq_image',$faq['nama_faq_image']);
		$data['status_faq_image']  = set_value('status_faq_image',$faq['status_faq_image']);
		$this->form_validation->set_rules('nama_faq_image','nama_faq_image','required');
        if ($this->form_validation->run() === FALSE){
			$this->tampil_top($data);
        }else{
		  if($this->m_admin_perawat->edit_image()){
			$this->session->set_flashdata('sukses', 'Data Berhasil Di Simpan');
			redirect(base_url('admin_perawat/faq'));
		  }else{
			$this->session->set_flashdata('danger', 'Ada Kesalahan Tambah Data');
			redirect(base_url('admin_perawat/faq'));
		  }
        }
      }  */
	}
  }
//===================================================================
//========================= TOOLS ===================================
//===================================================================
function tampil($data)
{
	$this->load->view("adminperawat/header",$data);
	$this->load->view("adminperawat/isi");
	$this->load->view("footer");
	$this->load->view("adminperawat/jsload");
	$this->load->view("adminperawat/jscode");
}
function tampil_top($data)
{
	$this->load->view("header_top",$data);
	$this->load->view("adminperawat/isi");
	$this->load->view("footer");
	$this->load->view("adminperawat/jsload");
	$this->load->view("adminperawat/jscode");
}
// -----------------------------------------------------------END-----------------------------------------
}
