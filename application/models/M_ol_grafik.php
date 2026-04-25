<?php
class M_ol_grafik extends CI_model{
/*	function ambil_data_prov_from_pegawai_pengurus($id)
	{
		$this->db->select("op.id_prov,prov.nama_prov");
		$this->db->join('ol_pengurus opg', 'opg.id_pengurus=opp.id_pengurus','left');
		$this->db->join('ol_pengcab op', 'op.id_pengcab=opg.id_pengcab','left');
		$this->db->join('kol_provinsi prov', 'prov.id_prov=op.id_prov','left');
		$this->db->join('kol_kabupaten kab', 'kab.id_kab=op.id_kab','left');
		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){
				$this->db->where('op.id_jabatan',$this->session->id_jabatan);
			}
		}
	    $this->db->group_by('op.id_prov'); 
		$q = $this->db->get_where('ol_pegawai_pengurus opp',array('status_pengcab'=>1));
			return $q->result_array();
	}	
	function ambil_data_kab_from_pegawai_pengurus($id) // untuk dropdown onchange
	{
		$this->db->select("op.id_kab,kab.nama_kab");
		$this->db->join('ol_pengurus opg', 'opg.id_pengurus=opp.id_pengurus','left');
		$this->db->join('ol_pengcab op', 'op.id_pengcab=opg.id_pengcab','left');
		$this->db->join('kol_provinsi prov', 'prov.id_prov=op.id_prov','left');
		$this->db->join('kol_kabupaten kab', 'kab.id_kab=op.id_kab','left');
		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){
				$this->db->where('op.id_jabatan',$this->session->id_jabatan);
			}
		}
	    $this->db->group_by('op.id_kab'); 
		$q = $this->db->get_where('ol_pegawai_pengurus opp',array('status_pengcab'=>1,'op.id_prov'=>$id));
			return $q->result_array();
	}*/
	function ambil_data_prov_from_pegawai_pengurus($id)
	{
		$this->db->join('kol_provinsi prov', 'prov.id_prov=op.id_prov','left');
		$this->db->join('kol_kabupaten kab', 'kab.id_kab=op.id_kab','left');
		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){
				$this->db->where('op.id_jabatan',$this->session->id_jabatan);
			}
		}
	    $this->db->group_by('op.id_prov'); 
		$q = $this->db->get_where('ol_pengcab op',array('status_pengcab'=>1));
			return $q->result_array();
	}	
	function ambil_data_kab_from_pegawai_pengurus($id) // untuk dropdown onchange
	{;
		$this->db->join('kol_provinsi prov', 'prov.id_prov=op.id_prov','left');
		$this->db->join('kol_kabupaten kab', 'kab.id_kab=op.id_kab','left');
		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){
				$this->db->where('op.id_jabatan',$this->session->id_jabatan);
			}
		}
	    $this->db->group_by('op.id_kab'); 
		$q = $this->db->get_where('ol_pengcab op',array('status_pengcab'=>1,'op.id_prov'=>$id));
			return $q->result_array();
	}
	function grafik_pengcab_prov_region($id)
	{
	//	$this->db->select("op.id_prov,op.id_kab,kab.nama_kab,prov.nama_prov");
		$this->db->join('kol_provinsi prov', 'prov.id_prov=op.id_prov','left');
		$this->db->join('kol_kabupaten kab', 'kab.id_kab=op.id_kab','left');
		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){
				$this->db->where('op.id_jabatan',$this->session->id_jabatan);
			}
		}		
		$this->db->where('op.id_prov', $id);
		$this->db->group_by('op.id_prov');
		$q = $this->db->get_where('ol_pengcab op',array('status_pengcab'=>1));
		return $q->result_array();
	}
	function grafik_pengcab_kab_region($id)
	{
	//	$this->db->select("op.id_prov,op.id_kab,kab.nama_kab,prov.nama_prov");
		$this->db->join('kol_provinsi prov', 'prov.id_prov=op.id_prov','left');
		$this->db->join('kol_kabupaten kab', 'kab.id_kab=op.id_kab','left');
		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){
				$this->db->where('op.id_jabatan',$this->session->id_jabatan);
			}
		}		
		$this->db->where('op.id_kab', $id);
		$this->db->group_by('op.id_kab');
		$q = $this->db->get_where('ol_pengcab op',array('status_pengcab'=>1));
		return $q->result_array();
	}
	function grafik_pengcab_region($id)
	{
	//	$this->db->select("op.id_prov,op.id_kab,kab.nama_kab,prov.nama_prov");
		$this->db->join('kol_provinsi prov', 'prov.id_prov=op.id_prov','left');
		$this->db->join('kol_kabupaten kab', 'kab.id_kab=op.id_kab','left');
		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){
				$this->db->where('op.id_jabatan',$this->session->id_jabatan);
			}
		}		
		$this->db->where('op.id_kab', $id);
		$this->db->group_by('op.id_pengcab');
		$q = $this->db->get_where('ol_pengcab op',array('status_pengcab'=>1));
		return $q->result_array();
	}
	// ================================
	function share_data_prov_from_pengurus2($idr,$id)
	{
		$this->db->join('kol_provinsi prov', 'prov.id_prov=op.id_prov','left');
		$this->db->join('kol_kabupaten kab', 'kab.id_kab=op.id_kab','left');
		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){
				$this->db->where('op.id_jabatan',$this->session->id_jabatan);
			}
		}
		$this->db->where($idr, $id);
		$this->db->group_by($idr); 
		$q = $this->db->get_where('ol_pengcab op',array('status_pengcab'=>1));
		return $q->result_array();
	}	
	function ambil_data_prov_from_pengurus2($idr)
	{
//		$this->db->join('ol_pengcab op', 'op.id_pengcab=peg.id_pengcab','left');
		$this->db->join('kol_provinsi prov', 'prov.id_prov=op.id_prov','left');
//		$this->db->join('kol_kabupaten kab', 'kab.id_kab=op.id_kab','left');	
		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){
				$this->db->where('op.id_jabatan',$this->session->id_jabatan);
			}
		}
		$this->db->group_by($idr); 
		$q = $this->db->get_where('ol_pengcab op');
		return $q->result_array();
	}
	function ambil_data_prov_from_pengcab($id)
	{
		$this->db->select("op.id_prov,prov.nama_prov");
	//	$this->db->join('ol_pengcab op', 'op.id_pengcab=peg.id_pengcab','left');
		$this->db->join('kol_provinsi prov', 'prov.id_prov=op.id_prov','left');
		$this->db->join('kol_kabupaten kab', 'kab.id_kab=op.id_kab','left');
	//	$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');	
		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){
				$this->db->where('op.id_jabatan',$this->session->id_jabatan);
			}
		}
		$this->db->group_by('op.id_prov'); 
		$query = $this->db->get_where('ol_pengcab op');
		return $query->result_array();
	}
	function ambil_data_kab_from_pengcab($id)
	{
		$this->db->select("op.id_kab,prov.nama_kab");
	//	$this->db->join('ol_pengcab op', 'op.id_pengcab=peg.id_pengcab','left');
		$this->db->join('kol_provinsi prov', 'prov.id_prov=op.id_prov','left');
		$this->db->join('kol_kabupaten kab', 'kab.id_kab=op.id_kab','left');
	//	$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');	
		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){
				$this->db->where('op.id_jabatan',$this->session->id_jabatan);
			}
		}
		$this->db->group_by('op.id_kab'); 
		$query = $this->db->get_where('ol_pengcab op',array('op.id_prov'=>$id));
		return $query->result_array();
	}
	function ambil_data_dropdown_kab_from_pengurus($id)
	{
		$this->db->join('ol_pengcab op', 'op.id_pengcab=peg.id_pengcab','left');
		$this->db->join('kol_provinsi prov', 'prov.id_prov=op.id_prov','left');
		$this->db->join('kol_kabupaten kab', 'kab.id_kab=op.id_kab','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');	
		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){
				$this->db->where('op.id_jabatan',$this->session->id_jabatan);
			}
		}
		$this->db->group_by('op.id_kab'); 
		$query = $this->db->get_where('ol_pegawai peg',array('op.id_prov' => $id,'jf.id_jabatan'=>$this->session->id_jabatan));
		return $query->result_array();
	}
	function grafik_pengcab_pegawai($select,$kondisi,$grup = FALSE)
	{
		$this->db->select($select);
		$this->db->join('ol_pengcab op', 'op.id_pengcab=ope.id_pengcab','left');
		$this->db->join('kol_pendidikan kpen', 'kpen.id_pendidikan=ope.id_pendidikan','left');
		$this->db->join('kol_agama kag', 'kag.id_agama=ope.id_agama','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=ope.id_status_kawin','left');
		$this->db->join('ol_status_pegawai osp', 'osp.id_status_pegawai=ope.tipe_pegawai','left');
		$this->db->join('kol_kode_kewenangan kkk', 'kkk.id_kode_kewenangan=ope.id_kode_kewenangan','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=ope.id_jabatan_fungsional','left');
	//	$this->db->join('kol_working kw', 'kw.id_working=ope.id_jabatan_fungsional','left');
		$this->db->join('kol_provinsi prov', 'prov.id_prov=ope.id_prov','left');
		$this->db->join('kol_kabupaten kab', 'kab.id_kab=ope.id_kab','left');
		$this->db->join('kol_kecamatan kec', 'kec.id_kec=ope.id_kec','left');
		$this->db->join('kol_kelurahan kel', 'kel.id_kel=ope.id_kel','left');		
		if($grup === FALSE)
		{ 
		$q = $this->db->get_where('ol_pegawai ope',$kondisi);
		return $q->result_array();
		}else{
		$this->db->group_by($grup); 
		$q = $this->db->get_where('ol_pegawai ope',$kondisi);
		return $q->result_array();		
		}
	}
	function grafik_pengcab_pegawai_instansi($select,$kondisi,$grup = FALSE)
	{
		$this->db->select($select);
		$this->db->join('ol_pegawai ope', 'ope.id_pegawai=opi.id_pegawai','left');
		$this->db->join('ol_pengcab op', 'op.id_pengcab=ope.id_pengcab','left');
		$this->db->join('kol_pendidikan kpen', 'kpen.id_pendidikan=ope.id_pendidikan','left');
		$this->db->join('kol_agama kag', 'kag.id_agama=ope.id_agama','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=ope.id_status_kawin','left');
		$this->db->join('ol_status_pegawai osp', 'osp.id_status_pegawai=ope.tipe_pegawai','left');
		$this->db->join('kol_kode_kewenangan kkk', 'kkk.id_kode_kewenangan=ope.id_kode_kewenangan','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=ope.id_jabatan_fungsional','left');
		$this->db->join('kol_working kw', 'kw.id_working=opi.id_instansi','left');
		$this->db->join('kol_provinsi prov', 'prov.id_prov=ope.id_prov','left');
		$this->db->join('kol_kabupaten kab', 'kab.id_kab=ope.id_kab','left');
		$this->db->join('kol_kecamatan kec', 'kec.id_kec=ope.id_kec','left');
		$this->db->join('kol_kelurahan kel', 'kel.id_kel=ope.id_kel','left');		
		if($grup === FALSE)
		{ 
		$q = $this->db->get_where('ol_pegawai_instansi opi',$kondisi);
		return $q->result_array();
		}else{
		$this->db->group_by($grup); 
		$q = $this->db->get_where('ol_pegawai_instansi opi',$kondisi);
		return $q->result_array();		
		}
	}
/*	function ambil_data_print_prov_pegawai($id_pengcab)
	{
		$this->db->select("COUNT(ope.id_prov) as total_prov,nama_prov,ope.id_prov,ope.id_kec");
		$this->db->join('ol_pengcab op', 'op.id_pengcab=ope.id_pengcab','left');
		$this->db->join('kol_provinsi prov', 'prov.id_prov=ope.id_prov','left');
		$this->db->join('kol_kabupaten kab', 'kab.id_kab=ope.id_kab','left');
		$this->db->join('kol_kecamatan kec', 'kec.id_kec=ope.id_kec','left');
		$this->db->join('kol_kelurahan kel', 'kel.id_kel=ope.id_kel','left');	
		$this->db->where('op.id_jabatan',$this->session->id_jabatan);	
		$this->db->where('ope.id_pengcab',$id_pengcab);	
		$q = $this->db->get_where('ol_pegawai ope');
		return $q->result_array();
	}
	function ambil_data_print_kab_pegawai($id_pengcab,$id_prov)
	{
		$this->db->select("COUNT(ope.id_kab) as total_kab,nama_kab,ope.id_kab");
		$this->db->join('ol_pengcab op', 'op.id_pengcab=ope.id_pengcab','left');
		$this->db->join('kol_provinsi prov', 'prov.id_prov=ope.id_prov','left');
		$this->db->join('kol_kabupaten kab', 'kab.id_kab=ope.id_kab','left');
		$this->db->join('kol_kecamatan kec', 'kec.id_kec=ope.id_kec','left');
		$this->db->join('kol_kelurahan kel', 'kel.id_kel=ope.id_kel','left');	
		$this->db->where('op.id_jabatan',$this->session->id_jabatan);	
		$this->db->where('ope.id_pengcab',$id_pengcab);	
		$this->db->where('ope.id_prov',$id_prov);	
		$q = $this->db->get_where('ol_pegawai ope');
		return $q->result_array();
	}
	function ambil_data_print_kec_pegawai($id_pengcab,$id_kab)
	{
		$this->db->select("COUNT(ope.id_kec) as total_kec,nama_kec,ope.id_kec");
		$this->db->join('ol_pengcab op', 'op.id_pengcab=ope.id_pengcab','left');
		$this->db->join('kol_provinsi prov', 'prov.id_prov=ope.id_prov','left');
		$this->db->join('kol_kabupaten kab', 'kab.id_kab=ope.id_kab','left');
		$this->db->join('kol_kecamatan kec', 'kec.id_kec=ope.id_kec','left');
		$this->db->join('kol_kelurahan kel', 'kel.id_kel=ope.id_kel','left');	
		$this->db->where('op.id_jabatan',$this->session->id_jabatan);	
		$this->db->where('ope.id_pengcab',$id_pengcab);	
		$this->db->where('ope.id_kab',$id_kab);	
		$q = $this->db->get_where('ol_pegawai ope');
		return $q->result_array();
	}
	function ambil_data_print_kel_pegawai($id_pengcab,$id_kec)
	{
		$this->db->select("COUNT(ope.id_kel) as total_kel,nama_kel,ope.id_kel");
		$this->db->join('ol_pengcab op', 'op.id_pengcab=ope.id_pengcab','left');
		$this->db->join('kol_provinsi prov', 'prov.id_prov=ope.id_prov','left');
		$this->db->join('kol_kabupaten kab', 'kab.id_kab=ope.id_kab','left');
		$this->db->join('kol_kecamatan kec', 'kec.id_kec=ope.id_kec','left');
		$this->db->join('kol_kelurahan kel', 'kel.id_kel=ope.id_kel','left');	
		$this->db->where('op.id_jabatan',$this->session->id_jabatan);	
		$this->db->where('ope.id_pengcab',$id_pengcab);	
		$this->db->where('ope.id_kec',$id_kec);	
		$q = $this->db->get_where('ol_pegawai ope');
		return $q->result_array();
	}*/
	function ambil_data_area_pegawai($id_pengcab,$id_kel)
	{
		$this->db->select("nama_pegawai,alamat");
		$this->db->join('ol_pengcab op', 'op.id_pengcab=ope.id_pengcab','left');
		$this->db->join('kol_provinsi prov', 'prov.id_prov=ope.id_prov','left');
		$this->db->join('kol_kabupaten kab', 'kab.id_kab=ope.id_kab','left');
		$this->db->join('kol_kecamatan kec', 'kec.id_kec=ope.id_kec','left');
		$this->db->join('kol_kelurahan kel', 'kel.id_kel=ope.id_kel','left');	
		$this->db->where('op.id_jabatan',$this->session->id_jabatan);	
		$this->db->where('ope.id_pengcab',$id_pengcab);	
		$this->db->where('ope.id_kel',$id_kel);	
		$q = $this->db->get_where('ol_pegawai ope');
		return $q->result_array();
	}
	function ambil_data_area_pegawai_instansi($id_working,$id_kel)
	{
		$this->db->select("nama_pegawai,alamat");
		$this->db->join('ol_pegawai ope', 'ope.id_pegawai=opi.id_pegawai','left');
		$this->db->join('ol_pengcab op', 'op.id_pengcab=ope.id_pengcab','left');
		$this->db->join('kol_provinsi prov', 'prov.id_prov=ope.id_prov','left');
		$this->db->join('kol_kabupaten kab', 'kab.id_kab=ope.id_kab','left');
		$this->db->join('kol_kecamatan kec', 'kec.id_kec=ope.id_kec','left');
		$this->db->join('kol_kelurahan kel', 'kel.id_kel=ope.id_kel','left');	
		$this->db->where('op.id_jabatan',$this->session->id_jabatan);	
		$this->db->where('opi.id_instansi',$id_working);	
		$this->db->where('ope.id_kel',$id_kel);	
		$q = $this->db->get_where('ol_pegawai_instansi opi');
		return $q->result_array();
	}
	function grafik_all_pengcab_pegawai($idr,$id,$select)
	{
		$this->db->select($select);
		$this->db->join('ol_pengcab op', 'op.id_pengcab=ope.id_pengcab','left');
		$this->db->join('kol_pendidikan kpen', 'kpen.id_pendidikan=ope.id_pendidikan','left');
		$this->db->join('kol_agama kag', 'kag.id_agama=ope.id_agama','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=ope.id_status_kawin','left');
		$this->db->join('ol_status_pegawai osp', 'osp.id_status_pegawai=ope.tipe_pegawai','left');
		$this->db->join('kol_kode_kewenangan kkk', 'kkk.id_kode_kewenangan=ope.id_kode_kewenangan','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=ope.id_jabatan_fungsional','left');
		$this->db->join('kol_working kw', 'kw.id_working=ope.id_jabatan_fungsional','left');
		$this->db->where('op.id_jabatan',$this->session->id_jabatan);		
		$this->db->where($idr, $id);
		$q = $this->db->get('ol_pegawai ope');
		return $q->row_array();
	}
	function grafik_all_pengcab_pegawai_instansi($idr,$id,$select)
	{
		$this->db->select($select);
		$this->db->join('ol_pegawai ope', 'ope.id_pegawai=opi.id_pegawai','left');
		$this->db->join('ol_pengcab op', 'op.id_pengcab=ope.id_pengcab','left');
		$this->db->join('kol_pendidikan kpen', 'kpen.id_pendidikan=ope.id_pendidikan','left');
		$this->db->join('kol_agama kag', 'kag.id_agama=ope.id_agama','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=ope.id_status_kawin','left');
		$this->db->join('ol_status_pegawai osp', 'osp.id_status_pegawai=ope.tipe_pegawai','left');
		$this->db->join('kol_kode_kewenangan kkk', 'kkk.id_kode_kewenangan=ope.id_kode_kewenangan','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=ope.id_jabatan_fungsional','left');
		$this->db->join('kol_working kw', 'kw.id_working=ope.id_jabatan_fungsional','left');
		$this->db->where('op.id_jabatan',$this->session->id_jabatan);		
		$this->db->where($idr, $id);
		$q = $this->db->get('ol_pegawai_instansi opi');
		return $q->row_array();
	}
  	function ambil_berkas_pelatihan($idr,$ruangan,$grup){
	    $array_check = array(4,5,6,8,9,27,28);
	    $this->db->select("COUNT(peg.id_pegawai) as total_pelatihan,nama_kategori_pelatihan");
		$this->db->join('kol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=b.id_kategori_pelatihan','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=b.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
	    $this->db->where_in('b.id_kategori_berkas', $array_check);
	    $this->db->where("b.id_kategori_pelatihan >", '0');
	    $this->db->where("b.status_berkas", 1);
	    $this->db->where('jf.id_jabatan',$this->session->id_jabatan);
	    $this->db->where($idr, $ruangan);
	    $this->db->group_by($grup);
		$q = $this->db->get_where('ol_berkas b');
			return $q->result_array();
	}
  	function ambil_berkas_pelatihan_instansi($idr,$ruangan,$grup){
	    $array_check = array(4,5,6,8,9,27,28);
	    $this->db->select("COUNT(peg.id_pegawai) as total_pelatihan,nama_kategori_pelatihan");
		$this->db->join('kol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=b.id_kategori_pelatihan','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=b.id_pegawai','left');
		$this->db->join('ol_pegawai_instansi opi', 'opi.id_pegawai=peg.id_pegawai','left');		
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
	    $this->db->where_in('b.id_kategori_berkas', $array_check);
	    $this->db->where("b.id_kategori_pelatihan >", '0');
	    $this->db->where("b.status_berkas", 1);
	    $this->db->where('jf.id_jabatan',$this->session->id_jabatan);
	    $this->db->where($idr, $ruangan);
	    $this->db->group_by($grup);
		$q = $this->db->get_where('ol_berkas b');
			return $q->result_array();
	}
  	function ambil_tempat_bekerja($idr,$ruangan){
	    $this->db->select("COUNT(pi.id_instansi) as total_instansi,nama_working");
		$this->db->join('kol_working kw', 'kw.id_working=pi.id_instansi','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=pi.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
		$this->db->where('jf.id_jabatan',$this->session->id_jabatan);
	    $this->db->where("status_pegawai_instansi", 1);
	    $this->db->where($idr, $ruangan);
	    $this->db->group_by('pi.id_instansi');
		$q = $this->db->get_where('ol_pegawai_instansi pi');
			return $q->result_array();
	}
  	function ambil_tempat_kat_bekerja($idr,$ruangan){
	    $this->db->select("COUNT(kw.id_cara_masuk) as total_kategori_work,nama_kategori_work");
		$this->db->join('kol_working kw', 'kw.id_working=pi.id_instansi','left');
		$this->db->join('kol_kategori_work kkw', 'kkw.id_kategori_work=kw.id_cara_masuk','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=pi.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
		$this->db->where('jf.id_jabatan',$this->session->id_jabatan);
	    $this->db->where("status_pegawai_instansi", 1);
	    $this->db->where($idr, $ruangan);
	    $this->db->group_by('kw.id_cara_masuk');
		$q = $this->db->get_where('ol_pegawai_instansi pi');
			return $q->result_array();
	}
    function jumlah_pegawai_nganggur($esql,$record,$value)    //igd.php untuk menampilkan jumlah antrian di igd saja
    {
	  $query1 = $this->db->query("select * from ol_pegawai_instansi 
	  	left join ol_pegawai on ol_pegawai.id_pegawai=ol_pegawai_instansi.id_pegawai where status_pegawai_instansi = 1 AND ". $esql. "");
	  $query1_result = $query1->result();
	//  echo $this->db->last_query();die();
	  $room_id= array();
	  foreach($query1_result as $row){
	     $room_id[] = $row->id_pegawai;
	   }
	  $room = implode(",",$room_id);
	  $ids = explode(",", $room);
	  $this->db->select("COUNT(*) as num");
	  $this->db->from('ol_pegawai');
	  $this->db->where_not_in('id_pegawai', $ids);
	  $this->db->where($record, $value);
	  $query = $this->db->get();
        $result = $query->row();
   //     echo $this->db->last_query();die();
        if(isset($result))
            return $result->num;
        return 0;
    }
	function grafik_pegawai_area($idr,$id)
	{
		$this->db->join('kol_provinsi kpr', 'kpr.id_prov=ope.id_prov','left');
		$this->db->join('kol_kabupaten kpk', 'kpk.id_kab=ope.id_kab','left');
		$this->db->join('kol_kelurahan kk', 'kk.id_kel=ope.id_kel','left');
		$this->db->join('kol_kecamatan kkec', 'kkec.id_kec=ope.id_kec','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=ope.id_jabatan_fungsional','left');
		$this->db->where('ope.'.$idr, $id);
		if ($this->session->id_level !== '99'){
			if($this->session->id_level !== '98'){
				$this->db->where('jf.id_jabatan',$this->session->id_jabatan);
			}
		}
		$q = $this->db->get('ol_pegawai ope');
		return $q->result_array();
	}
//=============================================== ASLI
	function ambil_prov_dari_pegawai(){
		$this->db->join('kol_provinsi kpr', 'kpr.id_prov=op.id_prov','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=op.id_jabatan_fungsional','left');
		$this->db->group_by('op.id_prov');
		$q = $this->db->get_where('ol_pegawai op',array('jf.id_jabatan'=>$this->session->id_jabatan));
		return $q->result_array();
	}
	function ambil_data_prov_from_pengurus($idr)
	{
		$this->db->join('ol_pengurus', 'ol_pengurus.id_pengurus=ol_pegawai_pengurus.id_pengurus','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pengurus.id_pengcab','left');
		$this->db->join('kol_provinsi prov', 'prov.id_prov=ol_pengcab.id_prov','left');
		$this->db->join('kol_kabupaten kab', 'kab.id_kab=ol_pengcab.id_kab','left');	
		$this->db->group_by($idr); 
		$q = $this->db->get_where('ol_pegawai_pengurus');
		return $q->result_array();
	}
	function ambil_data_pengcab_from_pengurus($idr)
	{
		$this->db->join('ol_pengurus', 'ol_pengurus.id_pengurus=ol_pegawai_pengurus.id_pengurus','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pengurus.id_pengcab','left');
		$this->db->join('kol_provinsi prov', 'prov.id_prov=ol_pengcab.id_prov','left');
		$this->db->join('kol_kabupaten kab', 'kab.id_kab=ol_pengcab.id_kab','left');	
		$this->db->group_by($idr); 
		$q = $this->db->get_where('ol_pegawai_pengurus');
		return $q->result_array();
	}
	function share_data_prov_from_pengurus($idr,$id)
	{
		$this->db->join('ol_pengurus', 'ol_pengurus.id_pengurus=ol_pegawai_pengurus.id_pengurus','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pengurus.id_pengcab','left');
		$this->db->join('kol_provinsi prov', 'prov.id_prov=ol_pengcab.id_prov','left');
		$this->db->join('kol_kabupaten kab', 'kab.id_kab=ol_pengcab.id_kab','left');	
		$this->db->where($idr, $id);
		$this->db->group_by($idr); 
		$q = $this->db->get_where('ol_pegawai_pengurus');
		return $q->result_array();
	}
	function ambil_data_prov_from_instansi($idr)
	{
		$this->db->join('kol_working kw', 'kw.id_working=pi.id_instansi','left');
		$this->db->join('kol_provinsi prov', 'prov.id_prov=kw.id_prov','left');
		$this->db->join('kol_kabupaten kab', 'kab.id_kab=kw.id_kab','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=pi.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
	    $this->db->group_by($idr); 
		$q = $this->db->get_where('ol_pegawai_instansi pi');
			return $q->result_array();
	}
	function ambil_data_unit_from_instansi($idr)
	{
		$this->db->join('ol_unit ou', 'ou.id_unit=pi.id_unit','left');
		$this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
		$this->db->join('kol_provinsi prov', 'prov.id_prov=kw.id_prov','left');
		$this->db->join('kol_kabupaten kab', 'kab.id_kab=kw.id_kab','left');
	//	$this->db->join('ol_pegawai peg', 'peg.id_pegawai=pi.id_pegawai','left');
	//	$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
	    $this->db->group_by('kw.id_prov'); 
		$q = $this->db->get_where('ol_pegawai_unit pi');
			return $q->result_array();
	}
	function ambil_data_dropdown_kab_from_instansi($id)
	{
		$this->db->join('kol_working kw', 'kw.id_working=pi.id_instansi','left');
		$this->db->join('kol_provinsi prov', 'prov.id_prov=kw.id_prov','left');
		$this->db->join('kol_kabupaten kab', 'kab.id_kab=kw.id_kab','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=pi.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');	
		$this->db->group_by('kw.id_kab'); 
		$query = $this->db->get_where('ol_pegawai_instansi pi',array('kw.id_prov' => $id));
		return $query->result_array();
	}
	function share_data_prov_from_instansi($idr,$id,$idp=FALSE)
	{
		$this->db->join('kol_working kw', 'kw.id_working=pi.id_instansi','left');
		$this->db->join('kol_provinsi prov', 'prov.id_prov=kw.id_prov','left');
		$this->db->join('kol_kabupaten kab', 'kab.id_kab=kw.id_kab','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=pi.id_pegawai','left');
		$this->db->where($idr, $id);
		if($idp === FALSE)
		{
			$this->db->group_by($idr);
		}else{
			$this->db->group_by($idp);
		} 
		$q = $this->db->get_where('ol_pegawai_instansi pi');
		return $q->result_array();
	}
	function grafik_pegawai_region($idg,$idr,$id)
	{
	//	$this->db->select($select);
		$this->db->join('kol_provinsi kpr', 'kpr.id_prov=ope.id_prov','left');
		$this->db->join('kol_kabupaten kpk', 'kpk.id_kab=ope.id_kab','left');
		$this->db->join('kol_kelurahan kk', 'kk.id_kel=ope.id_kel','left');
		$this->db->join('kol_kecamatan kkec', 'kkec.id_kec=ope.id_kec','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=ope.id_jabatan_fungsional','left');
		$this->db->where('ope.'.$idr, $id);
		$this->db->where('jf.id_jabatan', $this->session->id_jabatan);
		$this->db->group_by('ope.'.$idg);
		$q = $this->db->get('ol_pegawai ope');
		return $q->result_array();
	}
	function grafik_working_region($idr,$id)
	{
		$this->db->join('kol_provinsi kpr', 'kpr.id_prov=kol_working.id_prov','left');
		$this->db->join('kol_kabupaten kpk', 'kpk.id_kab=kol_working.id_kab','left');
		$this->db->join('kol_kelurahan kk', 'kk.id_kel=kol_working.id_kel','left');
		$this->db->join('kol_kecamatan kkec', 'kkec.id_kec=kol_working.id_kec','left');
		$this->db->where('kol_working.'.$idr, $id);
		$q = $this->db->get_where('kol_working');
		return $q->result_array();
	}
  	function grafik_tempat_bekerja_region($idg,$idr,$id){
/*		$this->db->join('kol_working kw', 'kw.id_working=pi.id_instansi','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=pi.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
		$this->db->where('jf.id_jabatan', $this->session->id_jabatan);
	    $this->db->where("status_pegawai_instansi", 1);
		$this->db->where('op.'.$idr, $id);
	    $this->db->group_by('pi.id_instansi');
		$q = $this->db->get_where('ol_pegawai_instansi pi');*/
		$this->db->join('kol_provinsi kpr', 'kpr.id_prov=kol_working.id_prov','left');
		$this->db->join('kol_kabupaten kpk', 'kpk.id_kab=kol_working.id_kab','left');
		$this->db->join('kol_kelurahan kk', 'kk.id_kel=kol_working.id_kel','left');
		$this->db->join('kol_kecamatan kkec', 'kkec.id_kec=kol_working.id_kec','left');
		$this->db->where('kol_working.'.$idr, $id);
		$this->db->group_by('kol_working.'.$idg);
		$q = $this->db->get_where('kol_working');
		return $q->result_array();
	}
	function grafik_pengcab_area($idr,$id)
	{
		$this->db->join('ol_pengcab op', 'op.id_pengcab=ope.id_pengcab','left');
		$this->db->join('kol_provinsi kpr', 'kpr.id_prov=op.id_prov','left');
		$this->db->join('kol_kabupaten kpk', 'kpk.id_kab=op.id_kab','left');
		$this->db->where('op.'.$idr, $id);
		$this->db->where('op.id_jabatan', $this->session->id_jabatan);
		$q = $this->db->get('ol_pegawai ope');
		return $q->result_array();
	}
	function grafik_working_pegawai($idr,$id,$select)
	{
		$this->db->select($select);
		$this->db->join('kol_working kw', 'kw.id_working=opi.id_instansi','left');
		$this->db->join('kol_provinsi kpr', 'kpr.id_prov=kw.id_prov','left');
		$this->db->join('kol_kabupaten kpk', 'kpk.id_kab=kw.id_kab','left');
		$this->db->join('ol_pegawai ope', 'ope.id_pegawai=opi.id_pegawai','left');
		$this->db->join('kol_pendidikan kpen', 'kpen.id_pendidikan=ope.id_pendidikan','left');
		$this->db->join('kol_agama kag', 'kag.id_agama=ope.id_agama','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=ope.id_status_kawin','left');
		$this->db->join('ol_status_pegawai osp', 'osp.id_status_pegawai=ope.tipe_pegawai','left');
		$this->db->join('kol_kode_kewenangan kkk', 'kkk.id_kode_kewenangan=ope.id_kode_kewenangan','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=ope.id_jabatan_fungsional','left');
		$this->db->where('kw.'.$idr, $id);
		$this->db->where('status_pegawai_instansi', 1);
		$this->db->where('jf.id_jabatan', $this->session->id_jabatan);
		$q = $this->db->get('ol_pegawai_instansi opi');
		return $q->result_array();
	}
  	function ambil_rs_berkas_pelatihan($ruangan){
	    $array_check = array(4,5,6,8,9,27,28);
	    $this->db->select("COUNT(b.id_kategori_pelatihan) as total_pelatihan,nama_kategori_pelatihan");
		$this->db->join('kol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=b.id_kategori_pelatihan','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=b.id_pegawai','left');
		$this->db->join('ol_pegawai_instansi opi', 'opi.id_pegawai=peg.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
	    $this->db->where_in('b.id_kategori_berkas', $array_check);
	    $this->db->where("b.id_kategori_pelatihan >", '0');
	    $this->db->where("b.status_berkas", 1);
	    $this->db->where("opi.id_instansi", $ruangan);
	    $this->db->where('jf.id_jabatan', $this->session->id_jabatan);
	    $this->db->group_by('b.id_kategori_pelatihan');
		$q = $this->db->get_where('ol_berkas b');
			return $q->result_array();
	}
  	function ambil_rs_pengcab($idr,$ruangan){
	    $this->db->select("COUNT(peg.id_pengcab) as total_instansi,nama_pengcab");
		$this->db->join('kol_working kw', 'kw.id_working=pi.id_instansi','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=pi.id_pegawai','left');
		$this->db->join('ol_pengcab op', 'op.id_pengcab=peg.id_pengcab','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
		$this->db->where('jf.id_jabatan', $this->session->id_jabatan);
	    $this->db->where("status_pegawai_instansi", 1);
	    $this->db->where($idr, $ruangan);
	    $this->db->group_by('pi.id_instansi');
		$q = $this->db->get_where('ol_pegawai_instansi pi');
			return $q->result_array();
	}
  	function ambil_tempat_bekerja_for_person($idr,$ruangan){
		$this->db->join('kol_working kw', 'kw.id_working=pi.id_instansi','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=pi.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
	    $this->db->where($idr, $ruangan);
		$q = $this->db->get_where('ol_pegawai_instansi pi');
			return $q->result_array();
	}
  	function ambil_unit_for_person($array){
		$this->db->join('ol_unit u', 'u.id_unit=opu.id_unit','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=opu.id_pegawai','left');
		$this->db->join('kol_working kw', 'kw.id_working=u.id_instansi','left');
	    $this->db->where($array);
		$q = $this->db->get_where('ol_pegawai_unit opu');
			return $q->result_array();
	}
  	function ambil_unit_induk($id){
		$this->db->join('ol_unit u', 'u.id_unit=opu.id_unit','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=opu.id_pegawai','left');
		$this->db->join('kol_working kw', 'kw.id_working=u.id_instansi','left');
	    $this->db->where('u.id_instansi',$id);
		$q = $this->db->get_where('ol_pegawai_unit opu');
			return $q->result_array();
	}
	function grafik_unit_pegawai($idr,$id,$select)
	{
		$this->db->select($select);
		$this->db->join('ol_unit u', 'u.id_unit=opu.id_unit','left');
		$this->db->join('ol_pegawai ope', 'ope.id_pegawai=opu.id_pegawai','left');
		$this->db->join('kol_working kw', 'kw.id_working=u.id_instansi','left');
		$this->db->join('kol_pendidikan kpen', 'kpen.id_pendidikan=ope.id_pendidikan','left');
		$this->db->join('kol_agama kag', 'kag.id_agama=ope.id_agama','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=ope.id_status_kawin','left');
		$this->db->join('ol_status_pegawai osp', 'osp.id_status_pegawai=ope.tipe_pegawai','left');
		$this->db->join('kol_kode_kewenangan kkk', 'kkk.id_kode_kewenangan=ope.id_kode_kewenangan','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=ope.id_jabatan_fungsional','left');
		$this->db->where($idr, $id);
		$this->db->where('status_pegawai_unit', 1);
		$this->db->where('jf.id_jabatan', $this->session->id_jabatan);
		$q = $this->db->get('ol_pegawai_unit opu');
		return $q->result_array();
	}
  	function ambil_unit_berkas_pelatihan($idr,$ruangan){
	    $array_check = array(4,5,6,8,9,27,28);
	    $this->db->select("COUNT(b.id_kategori_pelatihan) as total_pelatihan,nama_kategori_pelatihan");
		$this->db->join('kol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=b.id_kategori_pelatihan','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=b.id_pegawai','left');
		$this->db->join('ol_pegawai_unit opu', 'opu.id_pegawai=peg.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
	    $this->db->where_in('b.id_kategori_berkas', $array_check);
	    $this->db->where("b.id_kategori_pelatihan >", '0');
	    $this->db->where("b.status_berkas", 1);
	    $this->db->where($idr, $ruangan);
	    $this->db->where('jf.id_jabatan', $this->session->id_jabatan);
	    $this->db->group_by('b.id_kategori_pelatihan');
		$q = $this->db->get_where('ol_berkas b');
			return $q->result_array();
	}
	function ambil_berkas_expired_ijin_unit($idr,$id,$idk){
		$this->db->select("COUNT(ol_pegawai.id_pegawai) as total_str");
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_berkas.id_pegawai','left');
		$this->db->join('ol_pegawai_unit', 'ol_pegawai_unit.id_pegawai=ol_pegawai.id_pegawai','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pegawai.id_pengcab','left');
		$this->db->join('kol_kategori_berkas', 'kol_kategori_berkas.id_kategori_berkas=ol_berkas.id_kategori_berkas','left');
		$this->db->where('tgl_b_berkas <=', date('Y-m-d'));		
		$this->db->where("status_berkas", 1);
		$this->db->where($idr, $id);
		$this->db->where("ol_berkas.id_kategori_berkas", $idk);
		$this->db->group_by('ol_pegawai.id_pengcab');
		$q = $this->db->get_where('ol_berkas');
		return $q->result_array();
	}
	function ambil_berkas_aktif_ijin_unit($idr,$id,$idk){
		$this->db->select("COUNT(ol_pegawai.id_pegawai) as total_str");
		$this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_berkas.id_pegawai','left');
		$this->db->join('ol_pegawai_unit', 'ol_pegawai_unit.id_pegawai=ol_pegawai.id_pegawai','left');
		$this->db->join('ol_pengcab', 'ol_pengcab.id_pengcab=ol_pegawai.id_pengcab','left');
		$this->db->join('kol_kategori_berkas', 'kol_kategori_berkas.id_kategori_berkas=ol_berkas.id_kategori_berkas','left');
		$this->db->where('tgl_b_berkas >', date('Y-m-d'));		
		$this->db->where("status_berkas", 1);
		$this->db->where($idr, $id);
		$this->db->where("ol_berkas.id_kategori_berkas", $idk);
		$this->db->group_by('ol_pegawai.id_pengcab');
		$q = $this->db->get_where('ol_berkas');
		return $q->result_array();
	}
  	function ambil_berkas_pelatihan_person($idr,$ruangan){
	    $array_check = array(4,5,6,8,9,27,28);
		$this->db->join('kol_kategori_pelatihan kkp', 'kkp.id_kategori_pelatihan=b.id_kategori_pelatihan','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=b.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
	    $this->db->where_in('b.id_kategori_berkas', $array_check);
	    $this->db->where("b.id_kategori_pelatihan >", '0');
	    $this->db->where("b.status_berkas", 1);
	    $this->db->where($idr, $ruangan);
		$q = $this->db->get_where('ol_berkas b');
			return $q->result_array();
	}
  	function ambil_peminatan_person($idr,$ruangan){
		$this->db->join('ol_peminatan op', 'op.id_peminatan=opm.id_peminatan','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=opm.id_pegawai','left');
	//    $this->db->where("opm.id_pegawai",$ruangan);
	    $this->db->where($idr, $ruangan);
		$q = $this->db->get_where('ol_pegawai_minat opm');
			return $q->result_array();
	}
  	function ambil_peminatan($idr,$ruangan,$grup){
  		$this->db->select("COUNT(opm.id_peminatan) as total_peminatan,nama_peminatan,opm.id_peminatan");
		$this->db->join('ol_peminatan op', 'op.id_peminatan=opm.id_peminatan','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=opm.id_pegawai','left');
	//    $this->db->where("opm.id_pegawai",$ruangan);
	    $this->db->where($idr, $ruangan);
	    $this->db->group_by($grup);
		$q = $this->db->get_where('ol_pegawai_minat opm');
			return $q->result_array();
	}
  	function ambil_peminatan_instansi($idr,$ruangan,$grup){
  		$this->db->select("COUNT(opm.id_peminatan) as total_peminatan,nama_peminatan,opm.id_peminatan");
		$this->db->join('ol_peminatan op', 'op.id_peminatan=opm.id_peminatan','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=opm.id_pegawai','left');
		$this->db->join('ol_pegawai_instansi opi', 'opi.id_pegawai=peg.id_pegawai','left');
	//    $this->db->where("opm.id_pegawai",$ruangan);
	    $this->db->where($idr, $ruangan);
	    $this->db->group_by($grup);
		$q = $this->db->get_where('ol_pegawai_minat opm');
			return $q->result_array();
	}
}