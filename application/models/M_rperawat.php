<?php
class M_rperawat extends CI_model{
	function ambil_user_perawat($id){
	//	$this->db->select("*, u.id_pegawai,");
		$this->db->join('pegawai p', 'p.id_pegawai=u.id_pegawai','left');
		$this->db->join('jabatan_fungsional jp', 'jp.id_jabatan_fungsional=p.id_jabatan_fungsional','left');
		$this->db->join('perawat_detil pd', 'pd.id_pegawai=p.id_pegawai','left');
		$this->db->join('ruangan r', 'r.id_ruangan=p.id_ruangan','left');
		$this->db->join('user_level ul', 'ul.id_level=u.id_level','left');
		$this->db->join('unit un', 'un.id_unit=p.id_unit','left');
		$q = $this->db->get_where('user u',array('u.id_user'=>$id));
		return $q->row_array();
	}
	function ambil_barcode_user_perawat($id){
		$this->db->select("*,u.id_pegawai,u.id_user");
		$this->db->join('pegawai p', 'p.id_pegawai=u.id_pegawai','left');
		$this->db->join('perawat_detil pd', 'pd.id_pegawai=p.id_pegawai','left');
		$this->db->join('user_level ul', 'ul.id_level=u.id_level','left');
		$q = $this->db->get_where('user u',array('u.barcode_user'=>$id));
		return $q->row_array();
	}
	function ambil_id_perawat($id){
		$this->db->join('perawat_detil pd', 'pd.id_pegawai=peg.id_pegawai','left');
		$q = $this->db->get_where('pegawai peg',array('peg.id_pegawai'=>$id));
		return $q->row_array();
	}
	function cmd_ambil_kode_kewenangan()
	{
		$this->db->select("id_kode_kewenangan,concat('',nama_kode_kewenangan,' - Jenjang Karir : ',jenjang_karir,'') as nama_kode_kewenangan");
		$q= $this->db->get('kol_kode_kewenangan');
		return $q->result_array();
    }
	function cmd_kompetensi(){
		$this->db->select("id_kompetensi,concat(nama_kompetensi,' - [ ',nama_jabatan,' ]') as nama_kompetensi");
		$this->db->join('jabatan', 'jabatan.id_jabatan=kr_kompetensi.id_jabatan','left');
		$q = $this->db->get_where('kr_kompetensi')->result_array();
		$hasil= array_column($q,'nama_kompetensi','id_kompetensi');
		return $hasil;
	}
	function cmd_kode_kewenangan(){
		$this->db->select("id_kode_kewenangan,concat('',nama_kode_kewenangan,' - Jenjang Karir : ',jenjang_karir,'') as nama_kode_kewenangan");
		$q = $this->db->get_where('kol_kode_kewenangan')->result_array();
		$hasil= array_column($q,'nama_kode_kewenangan','id_kode_kewenangan');
		return $hasil;
	}
	function cmd_kode_kewenangan_null(){
		$this->db->select("id_kode_kewenangan,concat('',nama_kode_kewenangan,' - Jenjang Karir : ',jenjang_karir,'') as nama_kode_kewenangan");
		return $q = $this->db->get_where('kol_kode_kewenangan')->result_array();
	}
	function cmd_kewenangan(){
	//	$this->db->select("id_kewenangan,nama_kewenangan");
		$this->db->select("id_kewenangan,nama_kewenangan");
//		$this->db->join('kr_kompetensi kkp', 'kkp.id_kompetensi=kk.id_kompetensi','left');
//		$this->db->join('jabatan j', 'j.id_jabatan=kkp.id_jabatan','left');
		$q = $this->db->get_where('kr_kewenangan kk')->result_array();
		$hasil= array_column($q,'nama_kewenangan','id_kewenangan');
		return $hasil;
	}
	function cmd_kewenangan_with_jabatan($id){
		$this->db->select("id_kewenangan,concat(nama_kewenangan,' - Kompetensi : ',nama_kompetensi,' - Jabatan : ',nama_jabatan) as nama_kewenangan");
		$this->db->join('kr_kompetensi kkp', 'kkp.id_kompetensi=kk.id_kompetensi','left');
		$this->db->join('jabatan j', 'j.id_jabatan=kkp.id_jabatan','left');
		$q = $this->db->get_where('kr_kewenangan kk',array('kkp.id_jabatan'=>$id));
		return $q->result_array();
	}
	function cmd_sifat_kewenangan(){
		$this->db->select("id_sifat_kewenangan,nama_sifat_kewenangan");
		$q = $this->db->get_where('kol_sifat_kewenangan')->result_array();
		$hasil= array_column($q,'nama_sifat_kewenangan','id_sifat_kewenangan');
		return $hasil;
	}
	function cmd_sifat_kewenangan_null(){
		$this->db->select("id_sifat_kewenangan,nama_sifat_kewenangan");
		return $q = $this->db->get_where('kol_sifat_kewenangan')->result_array();
	}
	function cmd_ruangan(){
		$this->db->select("id_ruangan,nama_ruangan");
		$q = $this->db->get_where('ruangan')->result_array();
		$hasil= array_column($q,'nama_ruangan','id_ruangan');
		return $hasil;
	}
	function ambil_data_dropdown_jabfung_status($id)	//daftar.php pasien
	{
		$this->db->where_in('id_jabatan', ['4','19','20']);
		$this->db->where("id_status_pegawai",$id);
		$query = $this->db->get_where('jabatan_fungsional');
		return $query->result_array();
	}
	function cmd_jabatan(){
		$this->db->select("id_jabatan,nama_jabatan");
		$this->db->where_in('id_jabatan', ['4','19','20']);
		$q = $this->db->get_where('jabatan')->result_array();
		$hasil= array_column($q,'nama_jabatan','id_jabatan');
		return $hasil;
	}
	function cmd_jabfung(){
		$this->db->select("id_jabatan_fungsional,nama_jabatan_fungsional");
		$this->db->where_in('id_jabatan', ['4','19','20']);
		$q = $this->db->get_where('jabatan_fungsional');
		return $q->result_array();
	}
	function cmd_jabatan_null(){
		$this->db->select("id_jabatan,nama_jabatan");
		$this->db->where_in('id_jabatan', ['4','19','20']);
		$q = $this->db->get_where('jabatan');
		return $q->result_array();
	}
	function cmd_jabatan_null_with_permission($jabatan,$level){
		$ids = explode(',', $jabatan);
		$this->db->select("id_jabatan,nama_jabatan");
		if($level !== '99'){
		$this->db->where_in('id_jabatan',$ids);
		}
		$q = $this->db->get_where('jabatan');
		return $q->result_array();
	}
	function cmd_jabatan_fungsional($id,$level){
		$ids = explode(',', $id);
		$this->db->select("id_jabatan_fungsional,nama_jabatan_fungsional");
		if($level !== '99'){
		$this->db->where_in('id_jabatan', $ids);
	//	$this->db->where_in('id_jabatan', ['4','19','20']);
		}
		$q = $this->db->get_where('jabatan_fungsional')->result_array();
	//	print_r($q);die();
		$hasil= array_column($q,'nama_jabatan_fungsional','id_jabatan_fungsional');
		return $hasil;
	}
	function ambil_data_dropdown_jabfung_perawat($id)
	{
		$this->db->select("id_butir_kegiatan,concat('JabFung : ',nama_jabatan_fungsional,' - ',nama_butir_kegiatan,'') as nama_butir_kegiatan");
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=butir_kegiatan.id_jabatan_fungsional','left');
	//	$this->db->where_in('id_jabatan', ['4','19','20']);
		$this->db->where("butir_kegiatan.id_jabatan_fungsional",$id);
		$query = $this->db->get_where('butir_kegiatan');
		return $query->result_array();
	}
	function cmd_butir_kegiatan($id)
	{
		$this->db->select("id_butir_kegiatan,concat('JabFung : ',nama_jabatan_fungsional,' - ',nama_butir_kegiatan,'') as nama_butir_kegiatan");
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=butir_kegiatan.id_jabatan_fungsional','left');
		$this->db->where_in('id_jabatan', ['1']);
		$this->db->where('butir_kegiatan.id_jabatan_fungsional',$id);
		$q= $this->db->get('butir_kegiatan')->result_array();
		$hasil= array_column($q,'nama_butir_kegiatan','id_butir_kegiatan');
		return $hasil;
    }
	function kr_jabatan_fungsional($id){
		$this->db->select('*');
		$q = $this->db->get_where('kr_jabfung',array('id_butir_kegiatan'=>$id));
		return $q->result_array();
	}
	function kr_jabfung($id,$jabatan,$level){
		$this->db->select('*');
		$this->db->join('kr_kewenangan', 'kr_kewenangan.id_kewenangan=kr_kewenangan_detil.id_kewenangan','left');
		$this->db->join('kol_kode_kewenangan', 'kol_kode_kewenangan.id_kode_kewenangan=kr_kewenangan_detil.id_kode_kewenangan','left');
		$this->db->join('kol_sifat_kewenangan', 'kol_sifat_kewenangan.id_sifat_kewenangan=kr_kewenangan_detil.id_sifat_kewenangan','left');
		$this->db->join('kr_kompetensi', 'kr_kompetensi.id_kompetensi=kr_kewenangan.id_kompetensi','left');
		$this->db->where('kr_kewenangan_detil.id_kode_kewenangan', $id);
		if($level !== '99'){
		$this->db->where('kr_kompetensi.id_jabatan', $jabatan);
		}
		$this->db->order_by("kr_kewenangan_detil.id_kewenangan", "asc");
		$this->db->group_by("kr_kewenangan_detil.id_kewenangan");
		$q = $this->db->get_where('kr_kewenangan_detil');
		return $q->result_array();
	}
	function cmd_pegawai()
	{
		$this->db->select("id_pegawai,nama_pegawai");
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=pegawai.id_jabatan_fungsional','left');
		$this->db->where_in('id_jabatan', ['4','19','20']);
		$q= $this->db->get('pegawai')->result_array();
		$hasil= array_column($q,'nama_pegawai','id_pegawai');
		return $hasil;
    }
}
