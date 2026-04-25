<?php
class M_member_surat extends CI_model{
	function edit_pegawai($pic){
		$id_pegawai = $this->input->post('id_pegawai');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$tgl_lahir = date('Y-m-d', strtotime($tgl_lahir));
		$username = $this->input->post('username');
		$username_lama = $this->input->post('username_lama');
		if($username==""){
			$username = $username_lama;
		}else{
			$username = strtolower($username);
			$username = str_replace(' ', '-', $username);
			$username = preg_replace('/[^A-Za-z0-9\-]/', '', $username);
		}
		$password = $this->input->post('password');
		$passlama = $this->input->post('password_lama');
		if($password==""){
			$passworde = $passlama;
		}else{
			$passworde = hash("sha512", md5($password));
		}
		$data_pendaftaran = array(
			'username' => $username,
			'password' => $passworde,
			'email' =>$this->input->post('email'),
			'nama_pegawai' => $this->input->post('nama_pegawai'),
			'tipe_pegawai' =>$this->input->post('tipe_pegawai'),
			'no_hp' =>$this->input->post('no_hp'),
			'jk' =>$this->input->post('jk'),
			'nik' => $this->input->post('nik'),
			'nip' => $this->input->post('nip'),
			'no_profesi' => $this->input->post('no_profesi'),
			'tmp_lahir' => $this->input->post('tmp_lahir'),
			'id_pengcab' => $this->input->post('id_pengcab'),
			'id_prov' => $this->input->post('id_prov'),
			'id_kab' => $this->input->post('id_kab'),
			'id_kel' => $this->input->post('id_kel'),
			'id_kec' => $this->input->post('id_kec'),
			'tgl_lahir' => $tgl_lahir,
			'id_status_kawin' => $this->input->post('id_status_kawin'),
			'id_pendidikan' => $this->input->post('id_pendidikan'),
			'id_jabatan_fungsional' => $this->input->post('id_jabatan_fungsional'),
			'id_agama' => $this->input->post('id_agama'),
			'alamat' => $this->input->post('alamat'),
			'foto' =>$pic
		);
		$this->db->where('id_pegawai',$id_pegawai);
		$this->db->update('ol_pegawai', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function edit_pegawai_no_pic(){
		$id_pegawai = $this->input->post('id_pegawai');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$tgl_lahir = date('Y-m-d', strtotime($tgl_lahir));
		$username = $this->input->post('username');
		$username_lama = $this->input->post('username_lama');
		if($username==""){
			$username = $username_lama;
		}else{
			$username = strtolower($username);
			$username = str_replace(' ', '-', $username);
			$username = preg_replace('/[^A-Za-z0-9\-]/', '', $username);
		}
		$password = $this->input->post('password');
		$passlama = $this->input->post('password_lama');
		if($password==""){
			$passworde = $passlama;
		}else{
			$passworde = hash("sha512", md5($password));
		}
		$data_pendaftaran = array(
			'username' => $username,
			'password' => $passworde,
			'email' =>$this->input->post('email'),
			'nama_pegawai' => $this->input->post('nama_pegawai'),
			'tipe_pegawai' =>$this->input->post('tipe_pegawai'),
			'no_hp' =>$this->input->post('no_hp'),
			'jk' =>$this->input->post('jk'),
			'nik' => $this->input->post('nik'),
			'nip' => $this->input->post('nip'),
			'no_profesi' => $this->input->post('no_profesi'),
			'tmp_lahir' => $this->input->post('tmp_lahir'),
			'id_pengcab' => $this->input->post('id_pengcab'),
			'id_prov' => $this->input->post('id_prov'),
			'id_kab' => $this->input->post('id_kab'),
			'id_kel' => $this->input->post('id_kel'),
			'id_kec' => $this->input->post('id_kec'),
			'tgl_lahir' => $tgl_lahir,
			'id_status_kawin' => $this->input->post('id_status_kawin'),
			'id_pendidikan' => $this->input->post('id_pendidikan'),
			'id_jabatan_fungsional' => $this->input->post('id_jabatan_fungsional'),
			'id_agama' => $this->input->post('id_agama'),
			'alamat' => $this->input->post('alamat'),
		);
		$this->db->where('id_pegawai',$id_pegawai);
		$this->db->update('ol_pegawai', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function berkas_pribadi_all()
	{
		$fields = "*";
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));
		$order = $this->input->post('order');
		$cari = $this->input->post('search');
		$col =$order[0]['column'];
		$dir= $order[0]['dir'];
		$dt_kolom=$this->input->post('columns');
		$this->db->select($fields);  
		if(!empty($cari['value'])) {    
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ 
				switch($k['data']){		
				//	 case 'no_hp' : $nmf="peg.no_hp";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where("b.id_kategori_berkas >", 9);
				$this->db->where("b.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir); 
	    $this->db->from('ol_berkas b');
		$this->db->join('kol_kategori_berkas kb', 'kb.id_kategori_berkas=b.id_kategori_berkas','left');
		$this->db->where("b.id_kategori_berkas >", 9);
		$this->db->where("b.id_pegawai", $this->session->id_pegawai);
		$q = $this->db->limit($length,$start)->get_where(); 
		$list=$q->result_array(); //06 Hasil
		$this->db->select("COUNT(*) as num");	
		if(!empty($cari['value'])) {    
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ 
				switch($k['data']){		
				//	case 'no_hp' : $nmf="peg.no_hp";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where("b.id_kategori_berkas >", 9);
				$this->db->where("b.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}
	    $this->db->from('ol_berkas b');
		$this->db->join('kol_kategori_berkas kb', 'kb.id_kategori_berkas=b.id_kategori_berkas','left');
		$this->db->where("b.id_kategori_berkas >", 9);
		$this->db->where("b.id_pegawai", $this->session->id_pegawai);
		$q = $this->db->get_where();
		$jml_filter = $q->row()->num;
 		$kondisi=array('kol_kategori_berkas.id_kategori_berkas >'=>9, 'ol_berkas.id_pegawai'=>$this->session->id_pegawai);
		$jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_berkas',$kondisi,'kol_kategori_berkas','id_kategori_berkas');	
	//	$jml = $this->m_umum->jumlah_record_tabel('berkas');
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_berkas_file($id){
		$kode = $this->m_rancak->kode_generator(15,'');
		if(empty($id)){
			$data_kewenangan = array(
				'id_pegawai' => $this->input->post('id_pegawai'),
				'nama_berkas' => $this->input->post('nama_berkas'),
				'id_kategori_berkas' => $this->input->post('id_kategori_berkas'),
				'no_berkas' => $this->input->post('no_berkas'),
				'barcode_berkas' => $kode
			);			
		}else{
			$data_kewenangan = array(
				'id_pegawai' => $this->input->post('id_pegawai'),
				'nama_berkas' => $this->input->post('nama_berkas'),
				'id_kategori_berkas' => $this->input->post('id_kategori_berkas'),
				'no_berkas' => $this->input->post('no_berkas'),
				'barcode_berkas' => $kode,
				'link_berkas' => $id
			);
		}
		return $this->db->insert('ol_berkas', $data_kewenangan);
	}
	function edit_berkas_file($id){
		$id_berkas = $this->input->post('id_berkas');
		$user_pic=$this->m_umum->ambil_data('ol_berkas','id_berkas',$id_berkas);
		if(!empty($user_pic['link_berkas'])){
			$cek_file=FCPATH.'assets/berkas/ol/'.$user_pic['link_berkas'];
			if(file_exists($cek_file)){
				unlink(FCPATH."assets/berkas/ol/".$user_pic['link_berkas']);
			}
		}
		if(empty($id)){
			$data_pendaftaran = array(
				'nama_berkas' => $this->input->post('nama_berkas'),
				'id_kategori_berkas' => $this->input->post('id_kategori_berkas'),
				'no_berkas' => $this->input->post('no_berkas')
			);
		}else{
			$data_pendaftaran = array(
				'nama_berkas' => $this->input->post('nama_berkas'),
				'id_kategori_berkas' => $this->input->post('id_kategori_berkas'),
				'no_berkas' => $this->input->post('no_berkas'),
				'link_berkas' => $id
			);
		}
		$this->db->where('id_berkas',$id_berkas);
		$this->db->update('ol_berkas', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function berkas_ijasah_all()
	{
		$fields = "*,
					if (b.tgl_b_berkas = '0000-00-00' ,'TIDAK ADA',if (b.tgl_b_berkas = NULL ,'TIDAK ADA',DATE_FORMAT(b.tgl_b_berkas,'%d-%m-%Y'))) as tgl_b_berkas
		";
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));
		$order = $this->input->post('order');
		$cari = $this->input->post('search');
		$col =$order[0]['column'];
		$dir= $order[0]['dir'];
		$dt_kolom=$this->input->post('columns');
		$this->db->select($fields);  
		if(!empty($cari['value'])) {    
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ 
				switch($k['data']){		
				//	 case 'no_hp' : $nmf="peg.no_hp";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where("b.id_kategori_berkas", 7);
				$this->db->where("b.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir); 
	    $this->db->from('ol_berkas b');
		$this->db->join('kol_pendidikan kp', 'kp.id_pendidikan=b.id_pendidikan','left');
		$this->db->where("b.id_kategori_berkas", 7);
		$this->db->where("b.id_pegawai", $this->session->id_pegawai);
		$q = $this->db->limit($length,$start)->get_where(); 
		$list=$q->result_array(); //06 Hasil
		$this->db->select("COUNT(*) as num");	
		if(!empty($cari['value'])) {    
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ 
				switch($k['data']){		
				//	case 'no_hp' : $nmf="peg.no_hp";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where("b.id_kategori_berkas", 7);
				$this->db->where("b.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}
	    $this->db->from('ol_berkas b');
		$this->db->join('kol_pendidikan kp', 'kp.id_pendidikan=b.id_pendidikan','left');
		$this->db->where("b.id_kategori_berkas", 7);
		$this->db->where("b.id_pegawai", $this->session->id_pegawai);
		$q = $this->db->get_where();
		$jml_filter = $q->row()->num;
 		$kondisi=array('kol_kategori_berkas.id_kategori_berkas'=>7, 'ol_berkas.id_pegawai'=>$this->session->id_pegawai);
		$jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_berkas',$kondisi,'kol_kategori_berkas','id_kategori_berkas');	
	//	$jml = $this->m_umum->jumlah_record_tabel('berkas');
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_berkas_file_ijasah($id){
		$tgl_b_berkas = $this->input->post('tgl_b_berkas');
		$tgl_b_berkas = date('Y-m-d', strtotime($tgl_b_berkas));
		$kode = $this->m_rancak->kode_generator(15,'');
		if(empty($id)){
			$data_kewenangan = array(
				'id_pegawai' => $this->input->post('id_pegawai'),
				'nama_berkas' => $this->input->post('nama_berkas'),
				'id_kategori_berkas' => 7,
				'tgl_b_berkas' => $tgl_b_berkas,
				'barcode_berkas' => $kode,
				'no_berkas' => $this->input->post('no_berkas'),
				'id_pendidikan' =>$this->input->post('id_pendidikan')

			);
		}else{
			$data_kewenangan = array(
				'id_pegawai' => $this->input->post('id_pegawai'),
				'nama_berkas' => $this->input->post('nama_berkas'),
				'id_kategori_berkas' => 7,
				'tgl_b_berkas' => $tgl_b_berkas,
				'barcode_berkas' => $kode,
				'no_berkas' => $this->input->post('no_berkas'),
				'link_berkas' => $id,
				'id_pendidikan' =>$this->input->post('id_pendidikan')

			);
		}
		return $this->db->insert('ol_berkas', $data_kewenangan);
	}
	function edit_berkas_file_ijasah($id){
		$id_berkas = $this->input->post('id_berkas');
		$tgl_b_berkas = $this->input->post('tgl_b_berkas');
		$tgl_b_berkas = date('Y-m-d', strtotime($tgl_b_berkas));
		$user_pic=$this->m_umum->ambil_data('ol_berkas','id_berkas',$id_berkas);
		if(!empty($user_pic['link_berkas'])){
			$cek_file=FCPATH.'assets/berkas/ol/'.$user_pic['link_berkas'];
			if(file_exists($cek_file)){
				unlink(FCPATH."assets/berkas/ol/".$user_pic['link_berkas']);
			}
		}
		if(empty($id)){
			$data_pendaftaran = array(
				'nama_berkas' => $this->input->post('nama_berkas'),
				'tgl_b_berkas' => $tgl_b_berkas,
				'no_berkas' => $this->input->post('no_berkas'),
				'id_pendidikan' =>$this->input->post('id_pendidikan')
			);
		}else{
			$data_pendaftaran = array(
				'nama_berkas' => $this->input->post('nama_berkas'),
				'tgl_b_berkas' => $tgl_b_berkas,
				'no_berkas' => $this->input->post('no_berkas'),
				'id_pendidikan' =>$this->input->post('id_pendidikan'),
				'link_berkas' => $id
			);
		}
		$this->db->where('id_berkas',$id_berkas);
		$this->db->update('ol_berkas', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function berkas_pelatihan_all()
	{
		$fields = "*,
					if (b.tgl_a_berkas = '0000-00-00' ,'TIDAK ADA',if (b.tgl_a_berkas = NULL ,'TIDAK ADA',DATE_FORMAT(b.tgl_a_berkas,'%d-%m-%Y'))) as tgl_a_berkas,
					if (b.tgl_b_berkas = '0000-00-00' ,'TIDAK ADA',if (b.tgl_b_berkas = NULL ,'TIDAK ADA',DATE_FORMAT(b.tgl_b_berkas,'%d-%m-%Y'))) as tgl_b_berkas
		";
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));
		$order = $this->input->post('order');
		$cari = $this->input->post('search');
		$col =$order[0]['column'];
		$dir= $order[0]['dir'];
		$dt_kolom=$this->input->post('columns');
		$this->db->select($fields);  
		if(!empty($cari['value'])) {    
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ 
				switch($k['data']){		
				//	 case 'no_hp' : $nmf="peg.no_hp";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where("kunci", 1);
				$this->db->where("b.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir); 
	    $this->db->from('ol_berkas b');
		$this->db->join('kol_kategori_berkas kb', 'kb.id_kategori_berkas=b.id_kategori_berkas','left');
		$this->db->join('kol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=b.id_kategori_pelatihan','left');
		$this->db->where("kunci", 1);
		$this->db->where("b.id_pegawai", $this->session->id_pegawai);
		$q = $this->db->limit($length,$start)->get_where(); 
		$list=$q->result_array(); //06 Hasil
		$this->db->select("COUNT(*) as num");	
		if(!empty($cari['value'])) {    
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ 
				switch($k['data']){		
				//	case 'no_hp' : $nmf="peg.no_hp";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where("kunci", 1);
				$this->db->where("b.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}
	    $this->db->from('ol_berkas b');
		$this->db->join('kol_kategori_berkas kb', 'kb.id_kategori_berkas=b.id_kategori_berkas','left');
		$this->db->join('kol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=b.id_kategori_pelatihan','left');
		$this->db->where("kunci", 1);
		$this->db->where("b.id_pegawai", $this->session->id_pegawai);
		$q = $this->db->get_where();
		$jml_filter = $q->row()->num;
 		$kondisi=array('kol_kategori_berkas.kunci'=>1, 'ol_berkas.id_pegawai'=>$this->session->id_pegawai);
		$jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_berkas',$kondisi,'kol_kategori_berkas','id_kategori_berkas');	
	//	$jml = $this->m_umum->jumlah_record_tabel('berkas');
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_berkas_file_pelatihan($id){
		$tgl_a_berkas = $this->input->post('tgl_a_berkas');
		$tgl_a_berkas = date('Y-m-d', strtotime($tgl_a_berkas));
		$tgl_b_berkas = $this->input->post('tgl_b_berkas');
		$tgl_b_berkas = date('Y-m-d', strtotime($tgl_b_berkas));
		$kode = $this->m_rancak->kode_generator(15,'');
		if(empty($id)){
			$data_kewenangan = array(
				'id_pegawai' => $this->input->post('id_pegawai'),
				'nama_berkas' => $this->input->post('nama_berkas'),
				'id_kategori_berkas' => $this->input->post('id_kategori_berkas'),
				'tgl_a_berkas' => $tgl_a_berkas,
				'tgl_b_berkas' => $tgl_b_berkas,
				'barcode_berkas' => $kode,
				'penyelenggara' => $this->input->post('penyelenggara'),
				'kredit' => $this->input->post('kredit'),
				'no_sertifikat' => $this->input->post('no_sertifikat'),
				'id_kategori_pelatihan' =>$this->input->post('id_kategori_pelatihan')

			);
		}else{
			$data_kewenangan = array(
				'id_pegawai' => $this->input->post('id_pegawai'),
				'nama_berkas' => $this->input->post('nama_berkas'),
				'id_kategori_berkas' => $this->input->post('id_kategori_berkas'),
				'tgl_a_berkas' => $tgl_a_berkas,
				'tgl_b_berkas' => $tgl_b_berkas,
				'barcode_berkas' => $kode,
				'penyelenggara' => $this->input->post('penyelenggara'),
				'kredit' => $this->input->post('kredit'),
				'no_sertifikat' => $this->input->post('no_sertifikat'),
				'link_berkas' => $id,
				'id_kategori_pelatihan' =>$this->input->post('id_kategori_pelatihan')

			);
		}
		return $this->db->insert('ol_berkas', $data_kewenangan);
	}
	function edit_berkas_file_pelatihan($id){
		$id_berkas = $this->input->post('id_berkas');
		$tgl_a_berkas = $this->input->post('tgl_a_berkas');
		$tgl_a_berkas = date('Y-m-d', strtotime($tgl_a_berkas));
		$tgl_b_berkas = $this->input->post('tgl_b_berkas');
		$tgl_b_berkas = date('Y-m-d', strtotime($tgl_b_berkas));
		$user_pic=$this->m_umum->ambil_data('ol_berkas','id_berkas',$id_berkas);
		if(!empty($user_pic['link_berkas'])){
			$cek_file=FCPATH.'assets/berkas/ol/'.$user_pic['link_berkas'];
			if(file_exists($cek_file)){
				unlink(FCPATH."assets/berkas/ol/".$user_pic['link_berkas']);
			}
		}
		if(empty($id)){
			$data_pendaftaran = array(
				'nama_berkas' => $this->input->post('nama_berkas'),
				'id_kategori_berkas' => $this->input->post('id_kategori_berkas'),
				'tgl_a_berkas' => $tgl_a_berkas,
				'tgl_b_berkas' => $tgl_b_berkas,
				'penyelenggara' => $this->input->post('penyelenggara'),
				'kredit' => $this->input->post('kredit'),
				'no_sertifikat' => $this->input->post('no_sertifikat'),
				'id_kategori_pelatihan' =>$this->input->post('id_kategori_pelatihan')
			);
		}else{
			$data_pendaftaran = array(
				'nama_berkas' => $this->input->post('nama_berkas'),
				'id_kategori_berkas' => $this->input->post('id_kategori_berkas'),
				'tgl_a_berkas' => $tgl_a_berkas,
				'tgl_b_berkas' => $tgl_b_berkas,
				'penyelenggara' => $this->input->post('penyelenggara'),
				'kredit' => $this->input->post('kredit'),
				'no_sertifikat' => $this->input->post('no_sertifikat'),
				'id_kategori_pelatihan' =>$this->input->post('id_kategori_pelatihan'),
				'link_berkas' => $id
			);
		}
		$this->db->where('id_berkas',$id_berkas);
		$this->db->update('ol_berkas', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function berkas_str_all()
	{
		$fields = "*,
					if (b.tgl_a_berkas = '0000-00-00' ,'TIDAK ADA',if (b.tgl_a_berkas = NULL ,'TIDAK ADA',DATE_FORMAT(b.tgl_a_berkas,'%d-%m-%Y'))) as tgl_a_berkas,
					if (b.tgl_b_berkas = '0000-00-00' ,'TIDAK ADA',if (b.tgl_b_berkas = NULL ,'TIDAK ADA',DATE_FORMAT(b.tgl_b_berkas,'%d-%m-%Y'))) as tgl_b_berkas
		";
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));
		$order = $this->input->post('order');
		$cari = $this->input->post('search');
		$col =$order[0]['column'];
		$dir= $order[0]['dir'];
		$dt_kolom=$this->input->post('columns');
		$this->db->select($fields);  
		if(!empty($cari['value'])) {    
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ 
				switch($k['data']){		
				//	 case 'no_hp' : $nmf="peg.no_hp";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where("kunci", 0);
				$this->db->where("b.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir); 
	    $this->db->from('ol_berkas b');
		$this->db->join('kol_kategori_berkas kb', 'kb.id_kategori_berkas=b.id_kategori_berkas','left');
		$this->db->join('kol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=b.id_kategori_pelatihan','left');
		$this->db->where("kunci", 0);
		$this->db->where("b.id_pegawai", $this->session->id_pegawai);
		$q = $this->db->limit($length,$start)->get_where(); 
		$list=$q->result_array(); //06 Hasil
		$this->db->select("COUNT(*) as num");	
		if(!empty($cari['value'])) {    
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ 
				switch($k['data']){		
				//	case 'no_hp' : $nmf="peg.no_hp";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
				$this->db->where("kunci", 0);
				$this->db->where("b.id_pegawai", $this->session->id_pegawai);
			}
		  }
		}
	    $this->db->from('ol_berkas b');
		$this->db->join('kol_kategori_berkas kb', 'kb.id_kategori_berkas=b.id_kategori_berkas','left');
		$this->db->join('kol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=b.id_kategori_pelatihan','left');
		$this->db->where("kunci", 0);
		$this->db->where("b.id_pegawai", $this->session->id_pegawai);
		$q = $this->db->get_where();
		$jml_filter = $q->row()->num;
 		$kondisi=array('kol_kategori_berkas.kunci'=>0, 'ol_berkas.id_pegawai'=>$this->session->id_pegawai);
		$jml = $this->m_umum->jumlah_record_tabel_pengajuan('ol_berkas',$kondisi,'kol_kategori_berkas','id_kategori_berkas');	
	//	$jml = $this->m_umum->jumlah_record_tabel('berkas');
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_berkas_file_surat_ijin($id){
		$tgl_a_berkas = $this->input->post('tgl_a_berkas');
		$tgl_a_berkas = date('Y-m-d', strtotime($tgl_a_berkas));
		$tgl_b_berkas = $this->input->post('tgl_b_berkas');
		$tgl_b_berkas = date('Y-m-d', strtotime($tgl_b_berkas));
		$kode = $this->m_rancak->kode_generator(15,'');
		if(empty($id)){
			$data_kewenangan = array(
				'id_pegawai' => $this->input->post('id_pegawai'),
				'nama_berkas' => $this->input->post('nama_berkas'),
				'id_kategori_berkas' => $this->input->post('id_kategori_berkas'),
				'tgl_a_berkas' => $tgl_a_berkas,
				'tgl_b_berkas' => $tgl_b_berkas,
				'barcode_berkas' => $kode,
				'no_berkas' => $this->input->post('no_berkas')

			);
		}else{
			$data_kewenangan = array(
				'id_pegawai' => $this->input->post('id_pegawai'),
				'nama_berkas' => $this->input->post('nama_berkas'),
				'id_kategori_berkas' => $this->input->post('id_kategori_berkas'),
				'tgl_a_berkas' => $tgl_a_berkas,
				'tgl_b_berkas' => $tgl_b_berkas,
				'barcode_berkas' => $kode,
				'no_berkas' => $this->input->post('no_berkas'),
				'link_berkas' => $id

			);
		}
		return $this->db->insert('ol_berkas', $data_kewenangan);
	}
	function edit_berkas_file_surat_ijin($id){
		$id_berkas = $this->input->post('id_berkas');
		$tgl_a_berkas = $this->input->post('tgl_a_berkas');
		$tgl_a_berkas = date('Y-m-d', strtotime($tgl_a_berkas));
		$tgl_b_berkas = $this->input->post('tgl_b_berkas');
		$tgl_b_berkas = date('Y-m-d', strtotime($tgl_b_berkas));
		$user_pic=$this->m_umum->ambil_data('ol_berkas','id_berkas',$id_berkas);
		if(!empty($user_pic['link_berkas'])){
			$cek_file=FCPATH.'assets/berkas/ol/'.$user_pic['link_berkas'];
			if(file_exists($cek_file)){
				unlink(FCPATH."assets/berkas/ol/".$user_pic['link_berkas']);
			}
		}
		if(empty($id)){
			$data_pendaftaran = array(
				'nama_berkas' => $this->input->post('nama_berkas'),
				'tgl_a_berkas' => $tgl_a_berkas,
				'tgl_b_berkas' => $tgl_b_berkas,
				'no_berkas' => $this->input->post('no_berkas')
			);
		}else{
			$data_pendaftaran = array(
				'nama_berkas' => $this->input->post('nama_berkas'),
				'tgl_a_berkas' => $tgl_a_berkas,
				'tgl_b_berkas' => $tgl_b_berkas,
				'no_berkas' => $this->input->post('no_berkas'),
				'link_berkas' => $id
			);
		}
		$this->db->where('id_berkas',$id_berkas);
		$this->db->update('ol_berkas', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function simpan_perpanjangan_berkas_file_surat_ijin($id){
		$id_berkas = $this->input->post('id_berkas');
		$tgl_a_berkas = $this->input->post('tgl_a_berkas');
		$tgl_a_berkas = date('Y-m-d', strtotime($tgl_a_berkas));
		$tgl_b_berkas = $this->input->post('tgl_b_berkas');
		$tgl_b_berkas = date('Y-m-d', strtotime($tgl_b_berkas));
		$kode = $this->m_rancak->kode_generator(15,'');
		$this->perpanjangan_str($id_berkas);
		if(empty($id)){
			$data_kewenangan = array(
				'id_pegawai' => $this->input->post('id_pegawai'),
				'nama_berkas' => $this->input->post('nama_berkas'),
				'id_kategori_berkas' => $this->input->post('id_kategori_berkas'),
				'tgl_a_berkas' => $tgl_a_berkas,
				'tgl_b_berkas' => $tgl_b_berkas,
				'barcode_berkas' => $kode,
				'no_berkas' => $this->input->post('no_berkas')

			);
		}else{
			$data_kewenangan = array(
				'id_pegawai' => $this->input->post('id_pegawai'),
				'nama_berkas' => $this->input->post('nama_berkas'),
				'id_kategori_berkas' => $this->input->post('id_kategori_berkas'),
				'tgl_a_berkas' => $tgl_a_berkas,
				'tgl_b_berkas' => $tgl_b_berkas,
				'barcode_berkas' => $kode,
				'no_berkas' => $this->input->post('no_berkas'),
				'link_berkas' => $id

			);
		}
		return $this->db->insert('ol_berkas', $data_kewenangan);
	}
	function perpanjangan_str($id){
		$data_pendaftaran = array(
			'status_berkas' => 0
		);
		$this->db->where('id_berkas',$id);
		$this->db->update('ol_berkas', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
}
