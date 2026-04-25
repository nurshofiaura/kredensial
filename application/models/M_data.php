<?php
class M_data extends CI_model{
	function ambil_data_dropdown_pegawai_no_null_instansi_all()
	{
		$this->db->join('ol_pegawai','ol_pegawai.id_pegawai=ol_pegawai_instansi.id_pegawai','left');
		$this->db->join('kol_working','kol_working.id_working=ol_pegawai_instansi.id_instansi','left');
		$this->db->group_by('ol_pegawai_instansi.id_instansi');
		$this->db->order_by('nama_pegawai', 'asc');
		$q = $this->db->get_where('ol_pegawai_instansi',array('status_pegawai'=>1,'visible'=>1));
		return $q->result_array();
	}
	function grafik_gender($id)
	{
		$this->db->select("if (jk = '1' ,SUM(case when jk = '1' then 1 else 0 end),SUM(case when jk = '0' then 1 else 0 end)) as total,
		if (jk = '1' ,'Pria','Perempuan') as jk");
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_pegawai_instansi.id_pegawai','left');
		$this->db->group_by('jk');
		if($id > 0){
			$q = $this->db->get_where('ol_pegawai_instansi',array('ol_pegawai_instansi.id_instansi'=>$id));
		}else{
			$q = $this->db->get_where('ol_pegawai_instansi');
		}
		return $q->result_array();
	}
	function grafik_pk($id)
	{
		$this->db->select("COUNT(ol_pegawai.id_kode_kewenangan) as total,if (ol_pegawai.id_kode_kewenangan = '0' ,'PK 0',nama_kode_kewenangan) as nama_kode_kewenangan");
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_pegawai_instansi.id_pegawai','left');
		$this->db->join('kol_kode_kewenangan', 'kol_kode_kewenangan.id_kode_kewenangan=ol_pegawai.id_kode_kewenangan','left');
		$this->db->group_by('ol_pegawai.id_kode_kewenangan');
		if($id > 0){
			$q = $this->db->get_where('ol_pegawai_instansi',array('ol_pegawai_instansi.id_instansi'=>$id));
		}else{
			$q = $this->db->get_where('ol_pegawai_instansi');
		}
		return $q->result_array();
	}
	function grafik_jb($id)
	{
		$this->db->select("COUNT(ol_pegawai.id_jabatan_fungsional) as total,if (ol_pegawai.id_jabatan_fungsional = '0' ,'Kosong',nama_jabatan_fungsional) as nama_jabatan_fungsional");
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_pegawai_instansi.id_pegawai','left');
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
		$this->db->group_by('ol_pegawai.id_jabatan_fungsional');
		if($id > 0){
			$q = $this->db->get_where('ol_pegawai_instansi',array('ol_pegawai_instansi.id_instansi'=>$id));
		}else{
			$q = $this->db->get_where('ol_pegawai_instansi');
		}
		return $q->result_array();
	}
	function grafik_pendidikan($id)
	{
		$this->db->select("COUNT(ol_pegawai.id_pendidikan) as total,if (ol_pegawai.id_pendidikan = '0' ,'Kosong',nama_pendidikan) as nama_pendidikan");
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_pegawai_instansi.id_pegawai','left');
		$this->db->join('kol_pendidikan', 'kol_pendidikan.id_pendidikan=ol_pegawai.id_pendidikan','left');
		$this->db->group_by('ol_pegawai.id_pendidikan');
		if($id > 0){
			$q = $this->db->get_where('ol_pegawai_instansi',array('ol_pegawai_instansi.id_instansi'=>$id));
		}else{
			$q = $this->db->get_where('ol_pegawai_instansi');
		}
		return $q->result_array();
	}
	function grafik_agama($id)
	{
		$this->db->select("COUNT(ol_pegawai.id_agama) as total,if (ol_pegawai.id_agama = '0' ,'Kosong',nama_agama) as nama_agama");
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_pegawai_instansi.id_pegawai','left');
		$this->db->join('kol_agama', 'kol_agama.id_agama=ol_pegawai.id_agama','left');
		$this->db->group_by('ol_pegawai.id_agama');
		if($id > 0){
			$q = $this->db->get_where('ol_pegawai_instansi',array('ol_pegawai_instansi.id_instansi'=>$id));
		}else{
			$q = $this->db->get_where('ol_pegawai_instansi');
		}
		return $q->result_array();
	}
	function grafik_status_kawin($id)
	{
		$this->db->select("COUNT(ol_pegawai.id_status_kawin) as total,if (ol_pegawai.id_status_kawin = '0' ,'Kosong',nama_status_kawin) as nama_status_kawin");
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_pegawai_instansi.id_pegawai','left');
		$this->db->join('kol_status_kawin', 'kol_status_kawin.id_status_kawin=ol_pegawai.id_status_kawin','left');
		$this->db->group_by('ol_pegawai.id_status_kawin');
		if($id > 0){
			$q = $this->db->get_where('ol_pegawai_instansi',array('ol_pegawai_instansi.id_instansi'=>$id));
		}else{
			$q = $this->db->get_where('ol_pegawai_instansi');
		}
		return $q->result_array();
	}
	function grafik_status_pegawai($id)
	{
		$this->db->select("COUNT(ol_pegawai.tipe_pegawai) as total,if (ol_pegawai.tipe_pegawai = '0' ,'Kosong',nama_status_pegawai) as nama_status_pegawai");
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_pegawai_instansi.id_pegawai','left');
		$this->db->join('ol_status_pegawai', 'ol_status_pegawai.id_status_pegawai=ol_pegawai.tipe_pegawai','left');
		$this->db->group_by('ol_pegawai.tipe_pegawai');
		if($id > 0){
			$q = $this->db->get_where('ol_pegawai_instansi',array('ol_pegawai_instansi.id_instansi'=>$id));
		}else{
			$q = $this->db->get_where('ol_pegawai_instansi');
		}
		return $q->result_array();
	}
  	function grafik_pelatihan($id){
	    $array_check = array(4,5,6,8,9,27,28);
		$this->db->select("COUNT(b.id_kategori_pelatihan) as total,if (b.id_kategori_pelatihan = '0' ,'Kosong',nama_kategori_pelatihan) as nama_kategori_pelatihan");
		$this->db->join('kol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=b.id_kategori_pelatihan','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=b.id_pegawai','left');
		$this->db->join('ol_pegawai_instansi', 'ol_pegawai_instansi.id_pegawai=peg.id_pegawai','left');
	    $this->db->where_in('b.id_kategori_berkas', $array_check);
	//    $this->db->where("b.id_kategori_pelatihan >", '0');
	    $this->db->where("b.status_berkas", 1);
		if($id > 0){
			$q = $this->db->get_where('ol_berkas b',array('ol_pegawai_instansi.id_instansi'=>$id));
		}else{
			$q = $this->db->get_where('ol_berkas b');
		}
			return $q->result_array();
	}
	function ambil_data_dropdown_kab($id)
	{
		return $this->db->get_where('kol_kabupaten',array('id_prov' => $id))->result_array();
	}
	function ambil_data_dropdown_kec($id)
	{
		return $this->db->get_where('kol_kecamatan',array('id_kab' => $id))->result_array();
	}
	function ambil_data_dropdown_kel($id)
	{
		return $this->db->get_where('kol_kelurahan',array('id_kec' => $id))->result_array();
	}
	function grafik_provinsi()
	{
		$this->db->select("COUNT(ol_pegawai.id_prov) as total,if (ol_pegawai.id_prov = '0' ,'Kosong',nama_prov) as nama_prov");
		$this->db->join('kol_provinsi', 'kol_provinsi.id_prov=ol_pegawai.id_prov','left');
		$this->db->group_by('ol_pegawai.id_prov');
		$q = $this->db->get_where('ol_pegawai');
		return $q->result_array();
	}
	function grafik_kab($id,$dx)
	{
		$this->db->select("COUNT(ol_pegawai.id_kab) as total,if (ol_pegawai.id_kab = '0' ,'Kosong',nama_kab) as nama_kab");
		$this->db->join('kol_kabupaten', 'kol_kabupaten.id_kab=ol_pegawai.id_kab','left');
		$this->db->group_by('ol_pegawai.id_kab');
		if($dx == 0){
			$q = $this->db->get_where('ol_pegawai',array('ol_pegawai.id_prov'=>$id));
		}else{
			$q = $this->db->get_where('ol_pegawai');
		}
		return $q->result_array();
	}
	function grafik_kec($id,$dx)
	{
		$this->db->select("COUNT(ol_pegawai.id_kec) as total,if (ol_pegawai.id_kec = '0' ,'Kosong',nama_kec) as nama_kec");
		$this->db->join('kol_kecamatan', 'kol_kecamatan.id_kec=ol_pegawai.id_kec','left');
		$this->db->group_by('ol_pegawai.id_kec');
		if($dx == 0){
			$q = $this->db->get_where('ol_pegawai',array('ol_pegawai.id_kab'=>$id));
		}else{
			$q = $this->db->get_where('ol_pegawai');
		}
		return $q->result_array();
	}
	function grafik_kel($id,$dx)
	{
		$this->db->select("COUNT(ol_pegawai.id_kel) as total,if (ol_pegawai.id_kel = '0' ,'Kosong',nama_kel) as nama_kel");
		$this->db->join('kol_kelurahan', 'kol_kelurahan.id_kel=ol_pegawai.id_kel','left');
		$this->db->group_by('ol_pegawai.id_kel');
		if($dx == 0){
			$q = $this->db->get_where('ol_pegawai',array('ol_pegawai.id_kec'=>$id));
		}else{
			$q = $this->db->get_where('ol_pegawai');
		}
		return $q->result_array();
	}
	function tambah_registrasi(){
		$kode = $this->m_rancak->kode_generator(15,'RG');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$tgl_lahir = date('Y-m-d', strtotime($tgl_lahir));
		$username= $this->input->post('username');
		$username = strtolower($username);
		$username = str_replace(' ', '-', $username);
		$username = preg_replace('/[^A-Za-z0-9\-]/', '', $username);
		$data_pendaftaran = array(
			'barcode_registrasi' => $kode,
			'nama_pegawai'  => $this->input->post('nama_pegawai'),
			'tmp_lahir'  => $this->input->post('tmp_lahir'),
			'tgl_lahir'  => $tgl_lahir,
			'id_status_kawin'  => $this->input->post('id_status_kawin'),
			'id_agama'  => $this->input->post('id_agama'),
			'username'  => $this->input->post('username'),
			'no_hp'  => $this->input->post('no_hp'),
			'tipe_pegawai'  => $this->input->post('id_status_pegawai'),
			'id_jabatan_fungsional'  => $this->input->post('id_jabatan_fungsional'),
			'nik'  => $this->input->post('nik'),
			'nip'  => $this->input->post('nip'),
			'email'  => $this->input->post('email'),
			'id_instansi'  => $this->input->post('id_working'),
			'id_pendidikan'  => $this->input->post('id_pendidikan'),
			'alamat'  => $this->input->post('alamat'),
			'nama_instansi'  => $this->input->post('nama_instansi'),
			'alamat_instansi'  => $this->input->post('alamat_instansi'),
			'nama_unit'  => $this->input->post('nama_unit'),
			'atasan_unit'  => $this->input->post('atasan_unit'),
			'jk'  => $this->input->post('jk')
		);
		return $this->db->insert('ol_registrasi', $data_pendaftaran);
		// $this->db->insert_id();
	}
}
