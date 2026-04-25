<?php
class M_rancak extends CI_model{
    function jumlah_hak_akses_pegawai($kondisi)  
    {
    	$this->db->join('akses', 'akses.id_akses=pegawai_akses.id_akses','left');
        $this->db->where($kondisi);
        $query = $this->db->select("COUNT(*) as num")->get_where('pegawai_akses',array('status_pegawai_akses'=>'1'));
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
    }
    // =================================================================================================
	function ambil_user_pegawai($id){
		$this->db->join('pegawai p', 'p.id_pegawai=u.id_pegawai','left');
		$this->db->join('user_level ul', 'ul.id_level=u.id_level','left');
	//	$this->db->join('unit un', 'un.id_unit=p.id_unit','left');
	//	$this->db->join('ruangan r', 'r.id_ruangan=p.id_ruangan','left');
	//	$this->db->join('struktur_jabatan sj', 'sj.id_struktur_jabatan=r.id_struktur_jabatan','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=p.id_jabatan_fungsional','left');
		$q = $this->db->get_where('user u',array('u.id_user'=>$id));
		return $q->row_array();
	}
	function ambil_pegawai_akses_login($id){
		$q = $this->db->get_where('pegawai_akses pa',array('id_pegawai'=>$id));
		return $q->result_array();
	}
	function ambil_data_a_online_null()
	{
		$q = $this->db->get_where('a_online');
		return $q->result_array();
	}
	function ambil_data_a_online_no_null(){
		$this->db->select("id_kode_online,kode_online");
		$q = $this->db->get_where('a_online',array('status_online'=>1))->result_array();
		$hasil= array_column($q,'kode_online','id_kode_online');
		return $hasil;
	}
	function ambil_barcode_user_pegawai($id){
		$this->db->join('pegawai p', 'p.id_pegawai=u.id_pegawai','left');
		$this->db->join('user_level ul', 'ul.id_level=u.id_level','left');
		$q = $this->db->get_where('user u',array('u.barcode_user'=>$id));
		return $q->row_array();
	}
	function ambil_pegawai($id){
		$this->db->join('unit un', 'un.id_unit=peg.id_unit','left');
		$this->db->join('ruangan r', 'r.id_ruangan=peg.id_ruangan','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
		$q = $this->db->get_where('pegawai peg',array('peg.id_pegawai'=>$id));
		return $q->row_array();
	}
	function ambil_pk_pegawai($id){
		$this->db->join('perawat_detil pd', 'peg.id_pegawai=pd.id_pegawai','left');
		$this->db->join('kol_kode_kewenangan kkk', 'kkk.id_kode_kewenangan=pd.id_kode_kewenangan','left');
		$q = $this->db->get_where('pegawai peg',array('peg.id_pegawai'=>$id));
		return $q->row_array();
	}
	function ambil_jabatan_pegawai($id){
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
		$q = $this->db->get_where('pegawai peg',array('peg.id_pegawai'=>$id));
		return $q->row_array();
	}
	function ambil_direktur(){
		$this->db->join('pegawai peg', 'peg.id_pegawai=u.id_pegawai','left');
		$q = $this->db->get_where('user u',array('id_level'=>'50','status_user'=>'1','status_pegawai'=>'1'));
		return $q->row_array();
	}
	function ambil_pengirim_surat_no_null(){
		$this->db->select("id_pengirim,nama_pengirim");
		$q = $this->db->get_where('surat_pengirim')->result_array();
		$hasil= array_column($q,'nama_pengirim','id_pengirim');
		return $hasil;
	}
	function ambil_kategori_surat_no_null(){
		$this->db->select("id_kategori,nama_kategori");
		$q = $this->db->get_where('surat_kategori',array('status_kategori'=>'1'))->result_array();
		$hasil= array_column($q,'nama_kategori','id_kategori');
		return $hasil;
	}
	function ambil_pengumuman($id,$level,$jabatan){
		$this->db->join('pegawai', 'pegawai.id_pegawai=pengumuman.id_pegawai','left');
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=pegawai.id_jabatan_fungsional','left');
//		if($level !== '99'){
//		$this->db->where('find_in_set("'.$id.'", "'.$jabatan.'") != 0');
//		}
		$this->db->order_by("pengumuman.id_pengumuman", "desc");
		$this->db->limit(30);
		$q = $this->db->get_where('pengumuman');
		return $q->result_array();
	}
	function ambil_all_id_berkas_data(){
		$q = $this->db->get_where('berkas');
		return $q->result_array();
	}
	function ambil_surat_detil($id){
	//	$this->db->order_by('no_urut', 'asc');
		$this->db->order_by("no_urut ASC, id_surat_detil ASC");
		$q = $this->db->get_where('surat_detil',array('id_surat'=>$id));
		return $q->result_array();
	}
	function ambil_level_4_surat($id){
		$ids = explode(',', $id);
		$this->db->where_in('id_level',$ids);
		$q = $this->db->get_where('user_level');
		return $q->result_array();
	}
	function ambil_pegawai_4_surat($id){
		$ids = explode(',', $id);
		$this->db->where_in('id_jabatan',$ids);
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=pegawai.id_jabatan_fungsional','left');
		$this->db->order_by('nama_pegawai', 'asc');
		$q = $this->db->get_where('pegawai');
		return $q->result_array();
	}
	function ambil_unit_4_surat($id){
		$ids = explode(',', $id);
		$this->db->where_in('id_ruangan',$ids);
		$q = $this->db->get_where('ruangan');
		return $q->result_array();
	}
	function ambil_urutan_surat($id){
		$this->db->select("
				*,
				if(tipe_penerima = '0',nama_level,nama_pegawai) as id_penerima
			");
		$this->db->join('user_level ul', 'ul.id_level=sr.id_penerima','left');
		$this->db->join('pegawai peg', 'peg.id_pegawai=sr.id_penerima','left');
		$this->db->order_by('no_urut', 'asc');
		$q = $this->db->get_where('surat_detil sr',array('sr.id_surat'=>$id));
		return $q->result_array();
	}
	function hak_akses($id,$hak){
		$ids = explode(',', $hak);
		if($this->session->id_level !== '99'){
		$this->db->where_in('akses.id_akses',$ids);
		}
		$q = $this->db->get_where('akses');
		return $q->result_array();
	}
	function hak_akses_pegawai($id,$hak){
		$ids = explode(',', $hak);
		$this->db->join('akses', 'akses.id_akses=pegawai_akses.id_akses','left');
		if($this->session->id_level !== 99){
		$this->db->where_in('pegawai_akses.id_akses',$ids);
		}
		$q = $this->db->get_where('pegawai_akses',array('id_pegawai'=>$id,'status_pegawai_akses'=>'1'));
		return $q->result_array();
	}
	function ambil_hak_akses_pegawai($id){
		$this->db->join('akses', 'akses.id_akses=pegawai_akses.id_akses','left');
		$q = $this->db->get_where('pegawai_akses',array('id_pegawai'=>$id,'status_pegawai_akses'=>'1'));
		return $q->result_array();
	}
	function ambil_pengajuan_kompetensi($id){
		$this->db->join('kol_status_diusulkan', 'kol_status_diusulkan.id_status_diusulkan=kr_pengajuan.id_status_diusulkan','left');
		$this->db->join('pegawai p', 'p.id_pegawai=kr_pengajuan.id_pegawai','left');
		$this->db->join('kol_agama ag', 'ag.id_agama=p.id_agama','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=p.id_status_kawin','left');
		$this->db->join('kol_pendidikan pend', 'pend.id_pendidikan=p.id_pendidikan','left');
		$this->db->join('kol_status_pegawai ksp', 'ksp.id_status_pegawai=p.tipe_pegawai','left');
		$this->db->join('ruangan u', 'u.id_ruangan=p.id_ruangan','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=p.id_jabatan_fungsional','left');
		$q = $this->db->get_where('kr_pengajuan',array('id_pengajuan'=>$id));
		return $q->row_array();
	}
	function ambil_birthday(){
		$this->db->join('unit', 'unit.id_unit=pegawai.id_unit','left');
		$this->db->where('DATE_FORMAT(pegawai.tgl_lahir,"%m-%d") IN ( DATE_FORMAT(CURDATE(),"%m-%d"), DATE_FORMAT(CURDATE()+INTERVAL 1 DAY,"%m-%d"))');
		$this->db->order_by("day(pegawai.tgl_lahir)", "desc");
		$q = $this->db->get_where('pegawai',array('status_pegawai'=>'1'));
		return $q->result_array();
	}
	function ambil_asesor($id){
		$this->db->join('pegawai', 'pegawai.id_pegawai=kr_pengajuan.id_pegawai','left');
		$this->db->order_by('tgl_pengajuan', "desc");
		$q = $this->db->get_where('kr_pengajuan',array('id_asesor'=>$id));
		return $q->result_array();
	}
	function ambil_lobook_pemulihan_detil($id){
		$this->db->join('logbook_pemulihan', 'logbook_pemulihan.id_logbook_pemulihan=logbook_pemulihan_detil.id_logbook_pemulihan','left');
		$this->db->join('pegawai', 'pegawai.id_pegawai=logbook_pemulihan.id_pegawai','left');
	//	$this->db->order_by('tgl_pengajuan', "desc");
		$q = $this->db->get_where('logbook_pemulihan_detil',array('logbook_pemulihan_detil.id_logbook_pemulihan'=>$id));
		return $q->result_array();
	}
	function ambil_kewenangan_lobook_pemulihan_detil2($id){
		$this->db->join('logbook', 'logbook.id_logbook=logbook_pemulihan_detil.id_logbook','left');
		$this->db->join('kr_kewenangan_detil kkd', 'kkd.id_kewenangan_detil=logbook.id_kewenangan_detil','left');
	  $this->db->join('kr_kewenangan kk', 'kk.id_kewenangan=kkd.id_kewenangan','left');
		$q = $this->db->get_where('logbook_pemulihan_detil',array('logbook_pemulihan_detil.id_logbook_pemulihan'=>$id));
		return $q->result_array();
	}
	function ambil_kewenangan_lobook_pemulihan_detil($id){
		$this->db->join('logbook', 'logbook.id_logbook=logbook_pemulihan_detil.id_logbook','left');
		$this->db->join('kr_kewenangan_detil kkd', 'kkd.id_kewenangan_detil=logbook.id_kewenangan_detil','left');
	  	$this->db->join('kr_kewenangan kk', 'kk.id_kewenangan=kkd.id_kewenangan','left');
		$this->db->group_by('kkd.id_kewenangan');
		$q = $this->db->get_where('logbook_pemulihan_detil',array('logbook_pemulihan_detil.id_logbook_pemulihan'=>$id));
		return $q->result_array();
	}
	function ambil_kewenangan_lobook_kegiatan_pemulihan_detil($id){
		$this->db->join('pegawai', 'pegawai.id_pegawai=logbook_kegiatan_pemulihan.id_penguji','left');
		$this->db->join('logbook_pemulihan', 'logbook_pemulihan.id_logbook_pemulihan=logbook_kegiatan_pemulihan.id_logbook_pemulihan','left');
	  $this->db->join('kr_kewenangan', 'kr_kewenangan.id_kewenangan=logbook_kegiatan_pemulihan.id_kewenangan','left');
		$q = $this->db->get_where('logbook_kegiatan_pemulihan',array('logbook_kegiatan_pemulihan.id_logbook_pemulihan'=>$id));
		return $q->result_array();
	}
	function ambil_lobook_pemulihan($id){
		$this->db->join('pegawai', 'pegawai.id_pegawai=logbook_pemulihan.id_pemulihan','left');
		$this->db->join('ruangan', 'ruangan.id_ruangan=logbook_pemulihan.id_unit_pemulihan','left');
		$q = $this->db->get_where('logbook_pemulihan',array('logbook_pemulihan.id_pegawai'=>$id));
		return $q->result_array();
	}
	function ambil_lobook_pemulihan_pertahun($id,$thn){
		$this->db->select("*,peg.nama_pegawai,peg2.nama_pegawai as penanggungjawab,r2.nama_ruangan as tujuan");
		$this->db->join('pegawai peg', 'peg.id_pegawai=logbook_pemulihan.id_pegawai','left');
		$this->db->join('pegawai peg2', 'peg2.id_pegawai=logbook_pemulihan.id_pemulihan','left');
		$this->db->join('ruangan r1', 'r1.id_ruangan=logbook_pemulihan.id_unit','left');
		$this->db->join('ruangan r2', 'r2.id_ruangan=logbook_pemulihan.id_unit_pemulihan','left');
		$q = $this->db->get_where('logbook_pemulihan',array('logbook_pemulihan.id_pegawai'=>$id,'YEAR(tgl_awal)'=>$thn));
		return $q->result_array();
	}
	function ambil_lobook_perorang($id){
		$this->db->join('kr_kewenangan_detil kkd', 'kkd.id_kewenangan_detil=logbook.id_kewenangan_detil','left');
	  $this->db->join('kr_kewenangan kk', 'kk.id_kewenangan=kkd.id_kewenangan','left');
		$this->db->group_start();
	  $this->db->where("v_karu", '2');
	  $this->db->or_where("v_kabid", '2');
	  $this->db->or_where("v_asesor", '2');
	  $this->db->or_where("v_komite", '2');
	  $this->db->group_end();
	//	$this->db->order_by('tgl_pengajuan', "desc");
	  $q = $this->db->get_where('logbook',array('logbook.id_pegawai'=>$id));
	  return $q->result_array();
	}
	function ambil_berkas_expired($id){
		$first_date = date("Y-m-d", strtotime("-10 years"));
		$last_date = date("Y-m-d", strtotime("+6 month"));
		$this->db->join('pegawai', 'pegawai.id_pegawai=berkas.id_pegawai','left');
		$this->db->join('user', 'user.id_pegawai=pegawai.id_pegawai','left');
		$this->db->join('unit', 'unit.id_unit=pegawai.id_unit','left');
		$this->db->join('kol_kategori_berkas', 'kol_kategori_berkas.id_kategori_berkas=berkas.id_kategori_berkas','left');
		$this->db->where('tgl_b_berkas >=', $first_date);
		$this->db->where('tgl_b_berkas <=', $last_date);
		$this->db->where("status_berkas", '1');
		$this->db->where("id_user", $id);
		$this->db->where("(berkas.id_kategori_berkas='1' OR berkas.id_kategori_berkas='2' OR berkas.id_kategori_berkas='3')", NULL, FALSE);
		$q = $this->db->get_where('berkas');
		return $q->result_array();
	}
	function ambil_berkas_expired_all(){
		$first_date = date("Y-m-d", strtotime("-10 years"));
		$last_date = date("Y-m-d", strtotime("+6 month"));
		$this->db->join('pegawai', 'pegawai.id_pegawai=berkas.id_pegawai','left');
		$this->db->join('ruangan', 'ruangan.id_ruangan=pegawai.id_ruangan','left');
		$this->db->join('kol_kategori_berkas', 'kol_kategori_berkas.id_kategori_berkas=berkas.id_kategori_berkas','left');
		$this->db->where('tgl_b_berkas >=', $first_date);
		$this->db->where('tgl_b_berkas <=', $last_date);
		$this->db->where("status_berkas", 1);
		$this->db->where("(berkas.id_kategori_berkas='1' OR berkas.id_kategori_berkas='2' OR berkas.id_kategori_berkas='3')", NULL, FALSE);
		$q = $this->db->get_where('berkas');
		return $q->result_array();
	}
	function ambil_berkas_expired_karu($id){
		$first_date = date("Y-m-d", strtotime("-10 years"));
		$last_date = date("Y-m-d", strtotime("+6 month"));
		$this->db->join('pegawai', 'pegawai.id_pegawai=berkas.id_pegawai','left');
		$this->db->join('ruangan', 'ruangan.id_ruangan=pegawai.id_ruangan','left');
		$this->db->join('kol_kategori_berkas', 'kol_kategori_berkas.id_kategori_berkas=berkas.id_kategori_berkas','left');
		$this->db->where('tgl_b_berkas >=', $first_date);
		$this->db->where('tgl_b_berkas <=', $last_date);
		$this->db->where("status_berkas", '1');
		$this->db->where("pegawai.id_ruangan", $id);
		$this->db->where("(berkas.id_kategori_berkas='1' OR berkas.id_kategori_berkas='2' OR berkas.id_kategori_berkas='3')", NULL, FALSE);
		$q = $this->db->get_where('berkas');
		return $q->result_array();
	}
	function ambil_coa()
	{
		if(isset($_POST['searchTerm']) && !empty($_POST['searchTerm'])){
			$search = $this->input->post('searchTerm');
			$this->db->group_start();
			$this->db->like('nama_coa', $search);
			$this->db->or_like('kode_coa', $search);
			$this->db->group_end();
		}
		$this->db->where('status_coa', '1');
		$this->db->order_by("nama_coa", "asc");
	//	$this->db->limit(5);
		$r = $this->db->get('keu_coa')->result_array();
		return $r;
	}		
	function ambil_tindakan_radiologi($id,$idt)
	{
	//	$idjd = $this->m_umum->ambil_data('ruangan','id_ruangan',$this->session->id_ruangan);
		$this->db->join('kol_kelas', 'kol_kelas.id_kelas=tindakan_tarif.id_kelas','left');
		$this->db->join('tindakan', 'tindakan.id_tindakan=tindakan_tarif.id_tindakan','left');
		$this->db->join('kol_golongan_pemeriksaan kgp', 'kgp.id_golongan_pemeriksaan=tindakan.id_golongan_pemeriksaan','left');
		if(isset($_POST['searchTerm']) && !empty($_POST['searchTerm'])){
			$search = $this->input->post('searchTerm');
			$this->db->group_start();
			$this->db->like('nama_tindakan', $search);
			$this->db->or_like('nama_golongan_pemeriksaan', $search);
			$this->db->or_like('nama_kelas', $search);
			$this->db->or_like('nama_struktur_jabatan', $search);
			$this->db->group_end();
		}
/*		if($id > 0){$this->db->where('tindakan_tarif.id_kelas', $id);}		
		if($this->session->id_level !== '99'){$this->db->where('kgp.id_struktur_jabatan', $idjd['id_jabatan_jabatan']);}	*/	
		$this->db->where('tindakan_tarif.id_kelas', $id);
		$this->db->where_in('kgp.id_unit', $idt);
		$this->db->where('status_tarif', 1);
		$this->db->where('status_tindakan', 1);
		$this->db->where('status_golongan_pemeriksaan', 1);
		$this->db->where('status_kelas', 1);
		$this->db->order_by("nama_tindakan", "asc");
	//	$this->db->limit(5);
		$r = $this->db->get('tindakan_tarif')->result_array();
		return $r;
	}
	function ambil_kelas_pelayanan()
	{
		if(isset($_POST['searchTerm']) && !empty($_POST['searchTerm'])){
			$search = $this->input->post('searchTerm');
			$this->db->group_start();
			$this->db->like('nama_kelas', $search);
			$this->db->or_like('id_kelas', $search);
			$this->db->group_end();
		}
		$this->db->where('status_kelas', '1');
	//	$this->db->limit(5);
		$r = $this->db->get('kol_kelas')->result_array();
		return $r;
	}
	function ambil_coa_kas()
	{
		if(isset($_POST['searchTerm']) && !empty($_POST['searchTerm'])){
			$search = $this->input->post('searchTerm');
			$this->db->group_start();
			$this->db->like('nama_coa', $search);
			$this->db->or_like('kode_coa', $search);
			$this->db->group_end();
		}
		$this->db->where('id_code', '1');
		$this->db->where('status_coa', '1');
		$this->db->order_by("nama_coa", "asc");
	//	$this->db->limit(5);
		$r = $this->db->get('keu_coa')->result_array();
		return $r;
	}
	function ambil_coa_bank()
	{
		if(isset($_POST['searchTerm']) && !empty($_POST['searchTerm'])){
			$search = $this->input->post('searchTerm');
			$this->db->group_start();
			$this->db->like('nama_coa', $search);
			$this->db->or_like('kode_coa', $search);
			$this->db->group_end();
		}
		$this->db->where('id_code', '2');
		$this->db->where('status_coa', '1');
		$this->db->order_by("nama_coa", "asc");
	//	$this->db->limit(5);
		$r = $this->db->get('keu_coa')->result_array();
		return $r;
	}
	function ambil_coa_nokas()
	{
		if(isset($_POST['searchTerm']) && !empty($_POST['searchTerm'])){
			$search = $this->input->post('searchTerm');
			$this->db->group_start();
			$this->db->like('nama_coa', $search);
			$this->db->or_like('kode_coa', $search);
			$this->db->group_end();
		}
		$this->db->where('id_code !=', '1');
		$this->db->where('id_code !=', '2');
		$this->db->where('status_coa', '1');
		$this->db->order_by("nama_coa", "asc");
	//	$this->db->limit(5);
		$r = $this->db->get('keu_coa')->result_array();
		return $r;
	}
	function ambil_coa_saldo_awal()
	{
		if(isset($_POST['searchTerm']) && !empty($_POST['searchTerm'])){
			$search = $this->input->post('searchTerm');
			$this->db->group_start();
			$this->db->like('nama_coa', $search);
			$this->db->or_like('kode_coa', $search);
			$this->db->group_end();
		}
		$this->db->where('id_coa !=', '2');
	//	$this->db->where('id_code !=', '2');
		$this->db->where('status_coa', '1');
		$this->db->order_by("nama_coa", "asc");
	//	$this->db->limit(5);
		$r = $this->db->get('keu_coa')->result_array();
		return $r;
	}
	function ambil_logbook_pegawai($id){
		$this->db->join('kr_kewenangan_detil', 'kr_kewenangan_detil.id_kewenangan_detil=lp.id_kewenangan_detil','left');
		$q = $this->db->get_where('logbook lp',array('lp.id_logbook'=>$id));
		return $q->row_array();
	}
	function ambil_pegawai_dari_pengajuan($id){
		$this->db->join('pegawai peg', 'peg.id_pegawai=kp.id_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=peg.id_jabatan_fungsional','left');
		$q = $this->db->get_where('kr_pengajuan kp',array('kp.id_pengajuan'=>$id));
		return $q->row_array();
	}
	function sum_billing($id){
		$this->db->select_sum('nominal_billing');
		$this->db->join('pemeriksaan pmr', 'pmr.barcode_pemeriksaan=b.barcode_pemeriksaan','left');
		$this->db->join('pendaftaran_unit pu', 'pu.barcode_pendaftaran_unit=pmr.barcode_pendaftaran_unit','left');
		$q = $this->db->get_where('billing b',array('pu.barcode_pendaftaran_unit'=>$id));
    	return $q->row()->nominal_billing;
	}
	function ambil_barang()
	{
		if(isset($_POST['searchTerm']) && !empty($_POST['searchTerm'])){
			$search = $this->input->post('searchTerm');
			$this->db->group_start();
			$this->db->like('nama_barang', $search);
			$this->db->or_like('kode_barang', $search);
			$this->db->group_end();
		}
		$this->db->order_by("nama_barang", "asc");
	//	$this->db->limit(5);
		$r = $this->db->get('keu_barang')->result_array();
		return $r;
	}
	function ambil_satuan()
	{
		if(isset($_POST['searchTerm']) && !empty($_POST['searchTerm'])){
			$search = $this->input->post('searchTerm');
			$this->db->group_start();
			$this->db->like('nama_satuan', $search);
			$this->db->group_end();
		}
		$this->db->where('status_satuan', '1');
		$this->db->order_by("nama_satuan", "asc");
	//	$this->db->limit(5);
		$r = $this->db->get('kol_satuan')->result_array();
		return $r;
	}
	function ambil_kategori_berkas(){
		$this->db->select("id_kategori_berkas,nama_kategori_berkas");
		$q = $this->db->get_where('kol_kategori_berkas',array('id_kategori_berkas >'=>9))->result_array();
		$hasil= array_column($q,'nama_kategori_berkas','id_kategori_berkas');
		return $hasil;
	}
	function ambil_kategori_berkas_null(){
		$q = $this->db->get_where('kol_kategori_berkas',array('id_kategori_berkas >'=>9));
		return $q->result_array();
	}
	function ambil_kategori_berkas_pelatihan(){
		$this->db->select("id_kategori_berkas,nama_kategori_berkas");
		$q = $this->db->get_where('kol_kategori_berkas',array('kunci'=>1))->result_array();
		$hasil= array_column($q,'nama_kategori_berkas','id_kategori_berkas');
		return $hasil;
	}
	function cmd_keu_coa(){
		$this->db->select("id_coa,concat('[ ',kode_coa,' ] - ',nama_coa) as nama_coa");
		$q = $this->db->get_where('keu_coa',array('status_coa'=>'1'))->result_array();
		$hasil= array_column($q,'nama_coa','id_coa');
		return $hasil;
	}
	function cmd_struktur_jabatan(){
		$this->db->select("id_struktur_jabatan,concat(nama_working,' - ',nama_struktur_jabatan) as nama_struktur_jabatan");
		$this->db->join('kol_working', 'kol_working.id_working=srt_struktur_jabatan.id_instansi','left');
		$q = $this->db->get_where('srt_struktur_jabatan',array('status_struktur_jabatan'=>1))->result_array();
		$hasil= array_column($q,'nama_struktur_jabatan','id_struktur_jabatan');
		return $hasil;
	}
	function struktur_jabatan(){
		$this->db->select('*');
		$this->db->order_by("nama_struktur_jabatan", "asc");
		$q = $this->db->get_where('struktur_jabatan');
		return $q->result_array();
	}
	function struktur_jabatan_as_unit(){
		$this->db->select('id_struktur_jabatan as id_unit,nama_struktur_jabatan as nama_unit');
		$this->db->order_by("nama_struktur_jabatan", "asc");
		$q = $this->db->get_where('struktur_jabatan');
		return $q->result_array();
	}
	function cmd_struktur_jabatan_as_unit(){
		$this->db->select('id_struktur_jabatan as id_unit,nama_struktur_jabatan as nama_unit');
		$q = $this->db->get_where('struktur_jabatan',array('status_struktur_jabatan'=>'1'))->result_array();
		$hasil= array_column($q,'nama_unit','id_unit');
		return $hasil;
	}
	function cmd_struktur_jabatan_as_unit2(){
		$this->db->select('id_unit,nama_unit');
		$q = $this->db->get_where('unit',array('status_unit'=>'1'))->result_array();
		$hasil= array_column($q,'nama_unit','id_unit');
		return $hasil;
	}
	function cmd_jabatan(){
		$this->db->select("id_jabatan,nama_jabatan");
		$q = $this->db->get_where('jabatan')->result_array();
		$hasil= array_column($q,'nama_jabatan','id_jabatan');
		return $hasil;
	}
	function cmd_jabatan_wherein(){
		$jabatan = explode(',', $this->session->mas_kred);
		$this->db->select("id_jabatan,nama_jabatan");
		$this->db->where_in('id_jabatan', $jabatan);
		$q = $this->db->get_where('jabatan')->result_array();
		$hasil= array_column($q,'nama_jabatan','id_jabatan');
		return $hasil;
	}
	function cmd_golongan_pemeriksaan(){
		$this->db->select("id_golongan_pemeriksaan,nama_golongan_pemeriksaan");
		$q = $this->db->get_where('kol_golongan_pemeriksaan',array('status_golongan_pemeriksaan'=>'1'))->result_array();
		$hasil= array_column($q,'nama_golongan_pemeriksaan','id_golongan_pemeriksaan');
		return $hasil;
	}
	function golongan_pemeriksaan($id){
		$this->db->select("id_golongan_pemeriksaan,nama_golongan_pemeriksaan");
		$q = $this->db->get_where('kol_golongan_pemeriksaan',array('status_golongan_pemeriksaan'=>'1','id_struktur_jabatan'=>$id))->result_array();
		return $q;
	}
	function cmd_ambil_direktur(){
		$this->db->select("user.id_pegawai,nama_pegawai");
		$this->db->join('pegawai', 'pegawai.id_pegawai=user.id_pegawai','left');
		$q = $this->db->get_where('user',array('user.id_level'=>'50','status_user'=>'1','status_pegawai'=>'1'))->result_array();
		$hasil= array_column($q,'nama_pegawai','id_pegawai');
		return $hasil;
	}
	function ambil_data_level($id)	//daftar.php pasien
	{
		$query = $this->db->get_where('user',array('status_user'=>'1','id_pegawai'=>$id));
		return $query->result_array();
	}
	function ambil_kurs()
	{
		if(isset($_POST['searchTerm']) && !empty($_POST['searchTerm'])){
			$search = $this->input->post('searchTerm');
			$this->db->like('kode_mata_uang', $search);
		}
		$this->db->order_by("id_mata_uang", "asc");
		$this->db->limit(5);
		$r = $this->db->get('keu_mata_uang')->result_array();
		return $r;
	}
	function kode_generator($length,$no)
	{
		// jumlah char = 30
		$thn = date('Y');
		$bln = date('m');
		$tgl = date('d');
		$jam = date('H');
		$mnt = date('i');
		$sec = date('s');
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		$kode = $no . $randomString . $thn . $bln. $tgl . $jam . $mnt . $sec;
		return $kode;
	}
	function kode_generator_urut($length,$no)
	{
		// jumlah char = 30
		$thn = date('Y');
		$bln = date('m');
		$tgl = date('d');
		$jam = date('H');
		$mnt = date('i');
		$sec = date('s');
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		$kode =  $thn . $bln. $tgl . $jam . $mnt . $sec . $no . $randomString;
		return $kode;
	}
	function cek_date($tgl)
	{
		$date = date('Y-m-d', strtotime($tgl));
		if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
			$res = "1";
		} else {
			$res = "0";
		}
		return $res;
	}
	function terbilang($x) {
	  if($x<0) {
		$hasil="minus " . trim($this->kekata($x));
	  } else {
		$poin = trim($this->tkoma($x));
		$hasil  = trim($this->kekata($x));
	  }
	  if($poin) {
		$hasil  = ucwords($hasil) . ' Koma ' . ucwords($poin);
	  } else {
		$hasil  = ucwords($hasil);
	  }
	  return $hasil . " Rupiah";
	}

	function kekata($x) {
	  $x=abs($x);
	  $angka=array("","satu","dua","tiga","empat","lima","enam","tujuh","delapan","sembilan","sepuluh","sebelas");
	  $temp=" ";

	  if($x<12) {
		$temp=" " . $angka[$x];
	  } else if ($x<20) {
		$temp=$this->kekata($x-10) ." belas";
	  } else if ($x<20) {
		$temp=$this->kekata($x-10) ." belas";
	  } else if ($x<100) {
		$temp=$this->kekata($x/10) ." puluh" . $this->kekata($x%10);
	  } else if ($x<200) {
		$temp=" seratus" . $this->kekata($x-100);
		} else if ($x <1000) {
			$temp = $this->kekata($x/100) . " ratus" . $this->kekata($x % 100);
		} else if ($x <2000) {
			$temp = " seribu" . $this->kekata($x - 1000);
		} else if ($x <1000000) {
			$temp = $this->kekata($x/1000) . " ribu" . $this->kekata($x % 1000);
		} else if ($x <1000000000) {
			$temp = $this->kekata($x/1000000) . " juta" . $this->kekata($x % 1000000);
		} else if ($x <1000000000000) {
			$temp = $this->kekata($x/1000000000) . " milyar" . $this->kekata(fmod($x,1000000000));
		} else if ($x <1000000000000000) {
			$temp = $this->kekata($x/1000000000000) . " trilyun" . $this->kekata(fmod($x,1000000000000));
		}
		return $temp;
	}
	function tkoma($x) {
	  $x = stristr($x,'.');

	  $angka = array("nol", "satu", "dua", "tiga", "empat", "lima",
	  "enam", "tujuh", "delapan", "sembilan");

	  $temp = " ";
	  $pjg = strlen($x);
	  $pos = 1;

	  while ($pos <$pjg) {
		$char=substr($x,$pos,1);
		$pos++;
		$temp .= " " . $angka[$char];
	  }
	  return $temp;
	}
/* 	function cek_kode($length,$no,$table,$field)
	{
		$key = true;
		while($key){
			$kode = $this->kode_generator($length,$no);
			$kondisi=array($field=>$kode);
			$jml = $this->m_umum->jumlah_record_filter($table,$kondisi);
			if($jml > 0) $key = false;
		}
		return $kode;
	} */
	function simpan_log_wa($no_log_wageblast,$id,$subyek){
		$data_pendaftaran = array(
			'no_log_wageblast' => $no_log_wageblast,
			'id_user' => $id,
			'subyek_log_wageblast' => $subyek
		);
		return $this->db->insert('log_wageblast', $data_pendaftaran);
	}
	function cmd_jenis_jurnal(){
		$status = array('1'=>'UMUM','2'=>'ADJUSTMENT');
		return $status;
	}
	function cmd_lhu_personal(){
		$status = array('1'=>'Kompetensi','4'=>'QC / IM','5'=>'Pendaftaran Pasien','7'=>'Berkas','8'=>'Even');
		return $status;
	}
	function cmd_komporke(){
		$status = array('1'=>'Kewenangan','2'=>'Kompetensi');
		return $status;
	}
	function cmd_qcim(){
		$status = array('0'=>'Ruangan','1'=>'Personal');
		return $status;
	}
	function dayofweek(){
		$status = array('1'=>'Minggu','2'=>'Senin','3'=>'Selasa','4'=>'Rabu','5'=>'Kamis','6'=>'Jumat','7'=>'Sabtu');
		return $status;
	}
	function kol_dayofweek(){
		$this->db->order_by("id_dayofweek", "asc");
		$q = $this->db->get_where('dayofweek');
		return $q->result_array();
	}
	function cmd_jenis_barang(){
		$status = array('1'=>'PERSEDIAAN','2'=>'JASA');
		return $status;
	}
	function ambil_sn_tabel(){
		$this->db->order_by('urut_tabel','asc');
		$q = $this->db->get_where('sn_tabel',array('status_tabel'=>1));
		return $q->result_array();
	}
	function bakhp_tindakan($id){
		$this->db->select("*,if(status_pemeriksaan_bakhp='1','AKTIF','NON AKTIF') as status_pemeriksaan_bakhp");
		$this->db->join('tindakan t', 't.id_tindakan=pb.id_tindakan','left');
		$this->db->join('keu_barang kb', 'kb.id_barang=pb.id_barang','left');
		$this->db->join('ruangan r', 'r.id_ruangan=pb.id_unit','left');
		$this->db->join('kol_satuan s', 's.id_satuan=pb.id_satuan','left');
		$q = $this->db->get_where('pemeriksaan_bakhp pb',array('pb.id_tindakan'=>$id));
		return $q->result_array();
	}
	function ambil_pemeriksaan($id){
		$this->db->join('billing b', 'b.id_pemeriksaan=p.id_pemeriksaan','left');
		$q = $this->db->get_where('pemeriksaan p',array('p.id_pemeriksaan'=>$id));
		return $q->row_array();
	}
	function ambil_tindakan_pemeriksaan($id){
		$this->db->select("*,concat(nama_tindakan,' ( ',nama_struktur_jabatan,' ) - Kelas : ',nama_kelas,' - Harga : ',harga_tindakan) as nama_tindakan");
		$this->db->join('kol_kelas', 'kol_kelas.id_kelas=tindakan_tarif.id_kelas','left');
		$this->db->join('tindakan', 'tindakan.id_tindakan=tindakan_tarif.id_tindakan','left');
		$this->db->join('kol_golongan_pemeriksaan kgp', 'kgp.id_golongan_pemeriksaan=tindakan.id_golongan_pemeriksaan','left');
		$this->db->join('struktur_jabatan st', 'st.id_struktur_jabatan=kgp.id_struktur_jabatan','left');
		$q = $this->db->get_where('tindakan_tarif',array('tindakan_tarif.id_kelas'=>$id));
		return $q->result_array();
	}
	function ambil_unit_instansi(){
		$this->db->select("*,concat(nama_unit,' <b>[',nama_working,']</b>') as nama_unit");
		$this->db->join('kol_working','kol_working.id_working=ol_unit.id_instansi','left');
		$q = $this->db->get_where('ol_unit',array('status_unit'=>1));
		return $q->result_array();
	}
	function ambil_pegawai_unit_instansi(){
		$this->db->select("*,concat(nama_pegawai,' <b>[',nama_unit,' - ',nama_working,']</b>') as nama_unit");
		$this->db->join('ol_pegawai','ol_pegawai.id_pegawai=ol_user.id_pegawai','left');
		$this->db->join('ol_unit','ol_unit.id_unit=ol_user.unit','left');
		$this->db->join('kol_working','kol_working.id_working=ol_unit.id_instansi','left');
		$q = $this->db->get_where('ol_user',array('status_pegawai'=>1,'status_user'=>1));
		return $q->result_array();
	}
	function bakhp($id){
		$this->db->order_by("id_barang", "asc");
		$q = $this->db->get_where('keu_barang',array('id_unit'=>$id));
		return $q->result_array();
	}
	function cmd_fat(){
		$status = array('0'=>'SLIM','1'=>'FAT','2'=>'VERY FAT');
		return $status;
	}
	function cmd_grid(){
		$status = array('0'=>'Tanpa Grid','1'=>'Grid');
		return $status;
	}
	function cmd_kompeten(){
		$status = array('0'=>'Proses','1'=>'Kompeten','2'=>'Tidak Kompeten');
		return $status;
	}
	function fat(){
		$this->db->order_by("id_proyeksi", "asc");
		$q = $this->db->get_where('radiologi_proyeksi');
		return $q->result_array();
	}
	function cmd_ol_logbook_judul_laporan()
	{
		$this->db->select("id_laporan,judul_laporan");
		$this->db->order_by("tgl_laporan", "asc");
		$q= $this->db->get_where('ol_logbook_laporan',array('barcode_pegawai'=>$this->session->barcode_pegawai))->result_array();
		$hasil= array_column($q,'judul_laporan','id_laporan');
		return $hasil;
	}
	function proyeksi_nonull()
	{
		$this->db->select("id_proyeksi,nama_proyeksi");
		$q= $this->db->get('radiologi_proyeksi')->result_array();
		$hasil= array_column($q,'nama_proyeksi','id_proyeksi');
		return $hasil;
	}
	function pemeriksaan_penunjang($id){
		$this->db->order_by("tgl_pemeriksaan_penunjang", "asc");
		$q = $this->db->get_where('pemeriksaan_penunjang',array('id_pendaftaran'=>$id));
		return $q->result_array();
	}
	function ambil_level_4_user($id){
		$this->db->join('user_level', 'user_level.id_level=user.id_level','left');
		$q = $this->db->get_where('user',array('id_pegawai'=>$id));
		return $q->result_array();
	}
	function fe_fat($id,$id_proyeksi){
		$this->db->select("*");
		$this->db->order_by("id_proyeksi", "asc");
		$q = $this->db->get_where('radiologi_fe',array('id_tindakan'=>$id,'id_proyeksi'=>$id_proyeksi));
		return $q->row_array();
	}
	function field_size()
	{
		$this->db->select("id_field_size,nama_field_size");
		$q= $this->db->get('radiologi_field_size')->result_array();
		$hasil= array_column($q,'nama_field_size','id_field_size');
		return $hasil;
	}
	function cmd_departemen(){
		$status = array('1'=>'STRUKTURAL','2'=>'FUNGSIONAL','3'=>'PELAKSANA');
		return $status;
	}
	function cmd_hamil(){
		$status = array('0'=>'Tidak Hamil','1'=>'Hamil');
		return $status;
	}
	function cmd_nol(){
		$status = array('0'=>'SEMUA REKENING TERMASUK YANG NOL','1'=>'HANYA REKENING TRANSAKSI');
		return $status;
	}
	function cmd_bentuk_laporan(){
		$status = array('lbulanan'=>'Bulanan','ltahunan'=>'Tahunan');
		return $status;
	}
	function cmd_grafik_laporan(){
		$status = array('lt'=>'Tahunan','lb'=>'Bulanan','lh'=>'Harian');
		return $status;
	}
	function cmd_periode_laporan_detil(){
		$status = array('3'=>'Tahunan','2'=>'Bulanan','1'=>'Harian');
		return $status;
	}
	function cmd_semua_transaksi(){
		$status = array('1'=>'HANYA TRANSAKSI PADA RANGE INI','2'=>'SEMUA REKENING TERMASUK YANG NOL');
		return $status;
	}
	function cmd_pajak(){
		$status = array('0'=>'Tanpa Pajak','2'=>'Belum Pajak','1'=>'Termasuk Pajak');
		return $status;
	}
	function cmd_jenis_rujukan(){
		$status = array('1'=>'Dokter','2'=>'Bidan / Mantri');
		return $status;
	}
	function cmd_jenis_faskes(){
		$status = array('1'=>'RS Pemerintah','2'=>'RS Swasta','3'=>'Klinik');
		return $status;
	}
	function cmd_ms_dk()
	{
		$status = array('D'=>'Debitur','K'=>'KREDITUR');
		return $status;
  }
	function cmd_expired(){
		$status = array('0'=>'Aktif','1'=>'Expired');
		return $status;
	}
	function cmd_status(){
		$status = array('1'=>'AKTIF','0'=>'TIDAK AKTIF');
		return $status;
	}
	function cmd_bekerja(){
		$status = array('1'=>'MASIH BEKERJA','0'=>'RESIGN');
		return $status;
	}
	function cmd_analisa(){
		$status = array('0'=>'Semua Record','1'=>'Range Tanggal');
		return $status;
	}
	function cmd_jk(){
		$jk = array('1'=>'Laki-laki','0'=>'Perempuan');
		return $jk;
	}
  function cmd_status_rkk(){
    $status_rkk = array('0'=>'Proses','1'=>'Kompeten Penuh','2'=>'Dengan Mentorship','3'=>'Tidak Kompeten / Ditolak');
    return $status_rkk;
  }
	function cmd_dk(){
		$dk = array('D'=>'DEBET','K'=>'KREDIT');
		return $dk;
	}
	function status_korespodensi(){
		$sk = array('0'=>'Registrasi','1'=>'Proses','2'=>'Validasi','3'=>'Selesai','4'=>'Ditolak');
		return $sk;
	}
	function sifat_surat(){
		$sk = array('0'=>'KOSONG','1'=>'BIASA','2'=>'PENTING','3'=>'SANGAT PENTING');
		return $sk;
	}
/*	function cmd_count(){
		$count = array('0'=>'PNS AUTO COUNT','1'=>'NON PNS / SWASTA AUTO COUNT','2'=>'TANPA KONSTANTA AUTO COUNT',
								'3'=>'PNS','4'=>'NON PNS / SWASTA','5'=>'TANPA KONSTANTA');
		return $count;
	}*/
	function cmd_count(){
		$count = array('0'=>'PNS AUTO COUNT');
		return $count;
	}
  function jenis_imut(){
    $count = array('2'=>'Quality Control','3'=>'Logbook','4'=>'Quality Control Ruangan / Unit','5'=>'Berkas');
    return $count;
  }
	function cmd_jabatan_fungsional_id($id)
	{
		$this->db->select("id_jabatan_fungsional,nama_jabatan_fungsional");
		$q= $this->db->get_where('jabatan_fungsional',array('id_jabatan'=>$id))->result_array();
		$hasil= array_column($q,'nama_jabatan_fungsional','id_jabatan_fungsional');
		return $hasil;
    }
	function cmd_jabatan_fungsional_dg_id($id)
	{
		$this->db->select("id_jabatan_fungsional,nama_jabatan_fungsional");
		if($id > 0){
		$this->db->where('id_jabatan', $id); }
		$q= $this->db->get_where('jabatan_fungsional')->result_array();
		$hasil= array_column($q,'nama_jabatan_fungsional','id_jabatan_fungsional');
		return $hasil;
    }
	function cmd_bulan(){
		$status = array('1'=>'Januari','2'=>'Februari','3'=>'Maret','4'=>'April','5'=>'Mei','6'=>'Juni',
						'7'=>'Juli','8'=>'Agustus','9'=>'September','10'=>'Oktober','11'=>'Nopember','12'=>'Desember');
		return $status;
	}
	function cmd_range_tahun($begin, $end){
		$status = array_combine(range($begin, $end), range($begin, $end));
		return $status;
	}
	function kr_buket_personal($id){
		$this->db->select('*');
		$q = $this->db->get_where('kr_buket_pegawai',array('id_pegawai'=>$id));
		return $q->result_array();
	}
	function ambil_buket($id){
		$this->db->join('butir_kegiatan', 'butir_kegiatan.id_butir_kegiatan=kr_buket_pegawai.id_butir_kegiatan','left');
		$this->db->group_by('kr_buket_pegawai.id_butir_kegiatan');
		$q = $this->db->get_where('kr_buket_pegawai',array('status_buket_pegawai'=>'1','id_pegawai'=>$id));
		return $q->result_array();
	}
	function cmd_ya_tidak(){
		$jk = array('1'=>'YA','0'=>'TIDAK');
		return $jk;
	}
	function array_laporan(){
		$this->db->join('unit u', 'u.id_unit=aml.id_unit','left');
		if($this->session->userdata('id_level')!==99 || $this->session->userdata('id_level')!==1){
		$this->db->where('status_m_laporan', '1');
		}
		$q = $this->db->get_where('a_m_laporan aml');
		return $q->result_array();
	}
	function ambil_lobook_kompetensi_group_pengajuan($id){
	  $this->db->select("COUNT(*) as num, nama_kewenangan");
	  $this->db->join('kr_kewenangan_detil kkd', 'kkd.id_kewenangan_detil=logbook.id_kewenangan_detil','left');
	  $this->db->join('kr_kewenangan kk', 'kk.id_kewenangan=kkd.id_kewenangan','left');
	  $this->db->group_by('kk.id_kewenangan');
	  $q = $this->db->get_where('logbook',array('id_pengajuan'=>$id));
	  return $q->result_array();
	}
	function jumlah_record_logbook_pengajuan($id,$valid,$no)
    {
	  $this->db->where('id_pengajuan', $id);
	  $this->db->where($valid, $no);
      $query = $this->db->select("COUNT(*) as num")->get_where('logbook');
      $result = $query->row();
      if(isset($result))
        return $result->num;
      return 0;
    }
    function jumlah_record_notification($id_pegawai,$id_unit,$id_level)
    {
		$this->db->group_start();
		$this->db->where('id_unit', $id_unit);
		$this->db->or_where('id_unit', '0');
		$this->db->group_end();
		$this->db->where('receiver', $id_level);
		$this->db->or_where('receiver', '0');
        $query = $this->db->select("COUNT(*) as num")->get_where('notification');
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
    }
	function jumlah_record_logbook($id_pegawai,$id_kewenangan)
    {
			$this->db->join('kr_kewenangan_detil', 'kr_kewenangan_detil.id_kewenangan_detil=logbook.id_kewenangan_detil','left');
			$this->db->where('id_pegawai', $id_pegawai);
			$this->db->where('id_kewenangan', $id_kewenangan);
			$this->db->group_start();
			$this->db->where('v_karu', '2');
			$this->db->or_where('v_kabid', '2');
			$this->db->or_where('v_asesor', '2');
			$this->db->or_where('v_komite', '2');
			$this->db->or_where('v_direktur', '2');
			$this->db->group_end();
        $query = $this->db->select("COUNT(*) as num")->get_where('logbook');
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
    }
    function link_notification($id_unit,$id_level)
    {
		$this->db->group_start();
		$this->db->where('id_unit', $id_unit);
		$this->db->or_where('id_unit', '0');
		$this->db->group_end();
/* 		$this->db->group_start();
		$this->db->where('receiver', $id_level);
		$this->db->or_where('receiver', '0');
		$this->db->group_end();	 */
		$q = $this->db->get_where('notification');
		return $q->result_array();
    }
	function cmd_keu_dk(){
		$this->db->select("concat(kode_rekening,' - ',nama_dk) as nama_dk,id_dk");
		$q = $this->db->get_where('keu_dk');
		return $q->result_array();
	}
	function cmd_supplier(){
		$this->db->select("nama_supplier,id_supplier");
		$q = $this->db->get_where('apt_supplier',array('status_supplier'=>1));
		return $q->result_array();
	}
	function apt_supplier()
	{
		$this->db->select("id_supplier,nama_supplier");
		$q= $this->db->get_where('apt_supplier',array('status_supplier'=>1))->result_array();
		$hasil= array_column($q,'nama_supplier','id_supplier');
		return $hasil;
	}
	function cmd_kelas(){
		$this->db->select("id_kelas, nama_kelas");
		$q = $this->db->get_where('kol_kelas',array('status_kelas'=>'1'));
		return $q->result_array();
	}
	function cmd_kol_warna(){
		$this->db->select('*');
		$q = $this->db->get('kol_warna');
		return $q->result_array();
	}
	function buket($id){
		$this->db->select("id_butir_kegiatan, nama_butir_kegiatan");
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=butir_kegiatan.id_jabatan_fungsional','left');
		$this->db->where('jabatan_fungsional.id_jabatan', $id);
		$this->db->order_by("butir_kegiatan.id_jabatan_fungsional", "asc");
		$q = $this->db->get_where('butir_kegiatan');
		return $q->result_array();
	}
	function buket_no_null($id){
		$this->db->select("id_butir_kegiatan, nama_butir_kegiatan");
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=butir_kegiatan.id_jabatan_fungsional','left');
		$this->db->where('jabatan_fungsional.id_jabatan', $id);
		$q = $this->db->get_where('butir_kegiatan')->result_array();
		$hasil= array_column($q,'nama_butir_kegiatan','id_butir_kegiatan');
		return $hasil;
	}
	function butir_kegiatan_all($id){
		$query = $this->db->get_where('butir_kegiatan',array('id_jabatan_fungsional'=>$id));
		return $query->result_array();
	}
	function butir_kegiatan_no_null($id){
		$this->db->select("id_butir_kegiatan, nama_butir_kegiatan");
		$q= $this->db->get_where('butir_kegiatan',array('id_jabatan_fungsional'=>$id))->result_array();
		$hasil= array_column($q,'nama_butir_kegiatan','id_butir_kegiatan');
		return $hasil;
	}
	function cmd_tindakan($id){
		$this->db->select("id_tindakan, concat(nama_tindakan,' [ ',nama_golongan_pemeriksaan,'] ') as nama_tindakan");
		$this->db->join('kol_golongan_pemeriksaan', 'kol_golongan_pemeriksaan.id_golongan_pemeriksaan=tindakan.id_golongan_pemeriksaan','left');
		$q = $this->db->get_where('tindakan',array('tindakan.status_tindakan'=>1,'kol_golongan_pemeriksaan.id_unit'=>$id));
		return $q->result_array();
	}
	function cmd_tindakan_paket(){
		$this->db->select("id_tindakan, concat(nama_tindakan,' [ ',nama_golongan_pemeriksaan,'] ') as nama_tindakan");
		$this->db->join('kol_golongan_pemeriksaan', 'kol_golongan_pemeriksaan.id_golongan_pemeriksaan=tindakan.id_golongan_pemeriksaan','left');
		$this->db->where("not exists (select 1 from tindakan_paket where tindakan_paket.id_tindakan = tindakan.id_tindakan)",null,false);
		$q = $this->db->get_where('tindakan',array('tindakan.status_tindakan'=>1));
		return $q->result_array();
	}
	function ambil_tindakan_no_null($id){
		$this->db->select("id_tindakan,nama_tindakan");
		$this->db->join('kol_golongan_pemeriksaan', 'kol_golongan_pemeriksaan.id_golongan_pemeriksaan=tindakan.id_golongan_pemeriksaan','left');
		$q = $this->db->get_where('tindakan',array('tindakan.status_tindakan'=>1,'kol_golongan_pemeriksaan.id_unit'=>$id))->result_array();
		$hasil= array_column($q,'nama_tindakan','id_tindakan');
		return $hasil;
	}
	function cmd_opsi_keu_coa(){
		$this->db->select("id_coa,concat('[ ',kode_coa,' ] - ',nama_coa) as nama_coa");
		$q = $this->db->get_where('keu_coa',array('status_coa'=>'1'));
		return $q->result_array();
	}
	function cmd_pegawai_null($id,$level){
		$ids = explode(',', $id);
		$this->db->select('nama_pegawai,id_pegawai');
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=pegawai.id_jabatan_fungsional','left');
		if($level !== '99'){
		$this->db->where_in('id_jabatan',$ids);
		}
		$q = $this->db->get_where('pegawai');
		return $q->result_array();
	}
	function cmd_pegawai_karu_null($id,$level){
		$this->db->select("concat(nama_pegawai,'  [',nama_ruangan,']') as nama_pegawai,id_pegawai");
		$this->db->join('ruangan', 'ruangan.id_ruangan=pegawai.id_ruangan','left');
		if($id > '0'){
		$this->db->where('pegawai.id_ruangan',$id);
		}
		$q = $this->db->get_where('pegawai');
		return $q->result_array();
	}
	function cmd_pegawai_null_with_unit_source_jabatan($id,$level){
		$ids = explode(',', $id);
		$this->db->select("concat(nama_pegawai,'  [',nama_ruangan,']') as nama_pegawai,id_pegawai");
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=pegawai.id_jabatan_fungsional','left');
		$this->db->join('ruangan', 'ruangan.id_ruangan=pegawai.id_ruangan','left');
		if($level !== '99'){
		$this->db->where_in('id_jabatan',$ids);
		}
		$q = $this->db->get_where('pegawai');
		return $q->result_array();
	}
	function cmd_pegawai_null_with_unit_source_jabatan_for_karu($id,$level,$ruangan){
		$ids = explode(',', $id);
	//	$this->db->select("concat(nama_pegawai,'  [',nama_ruangan,']') as nama_pegawai,id_pegawai,barcode_pegawai");
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=pegawai.id_jabatan_fungsional','left');
	//	$this->db->join('ruangan', 'ruangan.id_ruangan=pegawai.id_ruangan','left');
		if($level == '19'){
		$this->db->where('pegawai.id_ruangan',$ruangan);
		}
/*		elseif($level !== '99'){
		$this->db->where_in('id_jabatan',$ids);
		}*/
		$q = $this->db->get_where('pegawai');
		return $q->result_array();
	}
	function cmd_pegawai_null_analisa(){
	//	$this->db->select("concat(nama_pegawai,'  [',nama_ruangan,']') as nama_pegawai,id_pegawai");
	//	$this->db->join('ruangan', 'ruangan.id_ruangan=pegawai.id_ruangan','left');
	//	$this->db->group_by('pegawai.id_pegawai');
		$q = $this->db->get_where('pegawai',array('visible'=>'1'));
		return $q->result_array();
	}
	function cmd_pegawai_null_pemulihan(){
//		$this->db->select("nama_pegawai,id_pegawai");
		$this->db->select("concat(nama_pegawai,'  [ ',nama_ruangan,' - ',nama_jabatan_fungsional,' ]') as nama_pegawai,id_pegawai,barcode_pegawai");
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=pegawai.id_jabatan_fungsional','left');
		$this->db->join('ruangan', 'ruangan.id_ruangan=pegawai.id_ruangan','left');
		$q = $this->db->get_where('pegawai',array('status_pegawai'=>'1'));
		return $q->result_array();
	}
	function cmd_pegawai_null_pemulihan2(){
		$q = $this->db->get_where('pegawai',array('status_pegawai'=>'1'));
		return $q->result_array();
	}
	function cmd_pegawai_null_pemulihan3(){
		$q = $this->db->get_where('pegawai',array('status_pegawai'=>'1','id_pegawai >'=>'3'));
		return $q->result_array();
	}
	function cmd_radiolog($struktur_jabatan,$ruangan){
		$this->db->select("id_pegawai,nama_pegawai");
		$q= $this->db->get_where('pegawai',array('id_unit'=>$struktur_jabatan,'id_ruangan'=>$ruangan))->result_array();
		$hasil= array_column($q,'nama_pegawai','id_pegawai');
		return $hasil;
	}
	function cmd_pegawai($id,$level){
		$ids = explode(',', $id);
		$this->db->select("concat(nama_pegawai,'  [',nama_ruangan,']') as nama_pegawai,id_pegawai");
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=pegawai.id_jabatan_fungsional','left');
		$this->db->join('ruangan', 'ruangan.id_ruangan=pegawai.id_ruangan','left');
		if($level !== '99'){
		$this->db->where_in('id_jabatan',$ids);
		}
		$q= $this->db->get_where('pegawai')->result_array();
		$hasil= array_column($q,'nama_pegawai','id_pegawai');
		return $hasil;
	}
	function cmd_unit_null(){
		$this->db->select('nama_unit,id_unit');
		$q = $this->db->get_where('unit');
		return $q->result_array();
	}
	function cmd_jabatan_null(){
		$this->db->select("id_jabatan,nama_jabatan");
		$q = $this->db->get_where('jabatan');
		return $q->result_array();
	}
	function ambil_data_jabatan_in($id)	
	{
		$ids = explode(',', $id);
		if ( $this->session->has_userdata('id_level') && $this->session->userdata('id_level')==99 ){

		}else{
			$this->db->where_in('id_jabatan',$ids);
		}
		$q = $this->db->get_where('jabatan')->result_array();
		$hasil= array_column($q,'nama_jabatan','id_jabatan');
		return $hasil;
	}
	function cmd_ruangan(){
		$this->db->select('nama_ruangan,id_ruangan');
		$q = $this->db->get_where('ruangan',array('status_ruangan'=>'1'));
		return $q->result_array();
	}
	function cmd_ruangan_perawat(){
		$ids = array('4','5','6','7','8','9');
		$this->db->select('nama_ruangan,id_ruangan');
		$this->db->where_in('id_struktur_jabatan',$ids);
		$this->db->order_by('nama_ruangan','asc');
		$q = $this->db->get_where('ruangan',array('status_ruangan'=>'1'));
		return $q->result_array();
	}
	function ruangan_jabatan(){
		$ids = array('4','5','6','7','8','9','10');
		$this->db->select('nama_ruangan,id_ruangan');
		$this->db->where_in('id_struktur_jabatan',$ids);
		$this->db->order_by('nama_ruangan','asc');
		$q = $this->db->get_where('ruangan',array('status_ruangan'=>'1'));
		return $q->result_array();
	}
	function ambil_id_berkas_data($id){
		$q = $this->db->get_where('berkas',array('id_pegawai'=>$id));
		return $q->result_array();
	}
	function ambil_data_etik_pegawai_oppe($id_pegawai,$tahun)
	{
		$this->db->join('pegawai peg', 'peg.id_pegawai=kep.id_penguji','left');
		$this->db->where("kep.id_pegawai", $id_pegawai);
	//	$this->db->where('year(tgl_etik_pegawai)', $tahun);
		$q = $this->db->get_where('kr_etik_pegawai kep')->result_array();
	//	print_r($q);die();
		return $q;
    }
	function kategori_pelatihan()
	{
		$this->db->select("id_kategori_pelatihan, nama_kategori_pelatihan");
		$q = $this->db->get_where('kol_kategori_pelatihan',array('status_kategori_pelatihan'=>'1'));
		return $q->result_array();
	}
	function cmd_termin(){
		$this->db->select('nama_termin,id_termin');
		$q = $this->db->get_where('kol_termin');
		return $q->result_array();
	}
	function cmd_jabfung(){
		$this->db->select("id_jabatan_fungsional,nama_jabatan_fungsional");
		$q = $this->db->get_where('jabatan_fungsional');
		return $q->result_array();
	}
	function cmd_jabfung_no_null(){
		$this->db->select("id_jabatan_fungsional,nama_jabatan_fungsional");
		$q = $this->db->get_where('jabatan_fungsional')->result_array();
		$hasil= array_column($q,'nama_jabatan_fungsional','id_jabatan_fungsional');
		return $hasil;
	}
	function ambil_data_dropdown_jabfung_status($id)	
	{
//		$this->db->where_in('id_jabatan', ['4','19','20']);
//		$this->db->where("id_status_pegawai",$id);
		$query = $this->db->get_where('jabatan_fungsional',array('id_status_pegawai'=>$id,'id_jabatan'=>$this->session->id_jabatan));
		return $query->result_array();
	}
	function ambil_data_dropdown_jabfung_registrasi($id)	
	{
//		$this->db->where_in('id_jabatan', ['4','19','20']);
//		$this->db->where("id_status_pegawai",$id);
		$query = $this->db->get_where('jabatan_fungsional',array('id_status_pegawai'=>$id));
		return $query->result_array();
	}
	function ambil_data_dropdown_jabfung_status_sesi($id,$jabatan)	
	{
//		$this->db->where_in('id_jabatan', ['4','19','20']);
//		$this->db->where("id_status_pegawai",$id);
		$query = $this->db->get_where('jabatan_fungsional',array('id_status_pegawai'=>$id,'id_jabatan'=>$jabatan));
		return $query->result_array();
	}
	function cmd_jabfung_buket($id){
		$this->db->select("id_jabatan_fungsional,nama_jabatan_fungsional");
		$q = $this->db->get_where('jabatan_fungsional',array('id_jabatan'=>$id));
		return $q->result_array();
	}
	function cmd_item_kategori(){
		$this->db->select("id_item_kategori,nama_item_kategori");
		$q= $this->db->get_where('keu_item_kategori',array('status_item_kategori'=>'1'))->result_array();
		$hasil= array_column($q,'nama_item_kategori','id_item_kategori');
		return $hasil;
	}
	function year_periode_abk($id_unit)
	{
		$this->db->select("distinct(DATE_FORMAT(periode,'%Y')) as periode");
		$this->db->join('p_abk', 'p_abk.id_abk=p_abk_detil.id_abk','left');
		$this->db->where('id_unit', $id_unit);
		$q= $this->db->get('p_abk_detil')->result_array();
		return $q;
	}
	function ambil_bk_detil4new($id){
	//	$this->db->select("butir_kegiatan.nama_butir_kegiatan,bk_detil.*");
		$this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=p_bk_detil.id_kompetensi','left');
		$query = $this->db->get_where('p_bk_detil',array('id_abk_detil'=>$id));
		return $query->result_array();
	}
	function kategori_str_all()
	{
		$this->db->select("id_kategori_berkas,nama_kategori_berkas");
		$this->db->where('kunci =', '0');
		$q= $this->db->get('kol_kategori_berkas')->result_array();
		$hasil= array_column($q,'nama_kategori_berkas','id_kategori_berkas');
		return $hasil;
	}
	function status_diusulkan_all()
	{
		$this->db->select("id_status_diusulkan,nama_status_diusulkan");
		$q= $this->db->get_where('kol_status_diusulkan')->result_array();
		$hasil= array_column($q,'nama_status_diusulkan','id_status_diusulkan');
		return $hasil;
	}
	function status_diusulkan_1()
	{
		$this->db->select("id_status_diusulkan,nama_status_diusulkan");
		$q= $this->db->get_where('kol_status_diusulkan',array('id_status_diusulkan <'=>'3'))->result_array();
		$hasil= array_column($q,'nama_status_diusulkan','id_status_diusulkan');
		return $hasil;
	}
	function status_diusulkan_pemulihan()
	{
		$this->db->select("id_status_diusulkan,nama_status_diusulkan");
		$q= $this->db->get_where('kol_status_diusulkan',array('id_status_diusulkan'=>'3'))->result_array();
		$hasil= array_column($q,'nama_status_diusulkan','id_status_diusulkan');
		return $hasil;
	}
	function cmd_tipe_pegawai(){
		$this->db->select("id_status_pegawai,nama_status_pegawai");
		$q= $this->db->get_where('kol_status_pegawai',array('status'=>'1'))->result_array();
		$hasil= array_column($q,'nama_status_pegawai','id_status_pegawai');
		return $hasil;
	}
	function cmd_tipe_pegawai_null(){
		$this->db->select("id_status_pegawai,nama_status_pegawai");
		return $q= $this->db->get_where('kol_status_pegawai',array('status'=>'1'))->result_array();
	}
	function cmd_kelas_tindakan(){
		$this->db->select("id_kelas,nama_kelas");
		$q= $this->db->get_where('kol_kelas',array('status_kelas'=>'1'))->result_array();
		$hasil= array_column($q,'nama_kelas','id_kelas');
		return $hasil;
	}
	function cmd_satuan_barang(){
		$this->db->select("id_satuan,nama_satuan");
		$q= $this->db->get_where('kol_satuan',array('status_satuan'=>'1'))->result_array();
		$hasil= array_column($q,'nama_satuan','id_satuan');
		return $hasil;
	}
	function cmd_level_program($id,$level){
		$ids = explode(',', $id);
		$this->db->select("id_level,nama_level");
		if($level !== '99'){
		$this->db->where_in('id_level',$ids);
		}
		$q= $this->db->get_where('user_level',array('id_level !='=>'99'))->result_array();
		$hasil= array_column($q,'nama_level','id_level');
		return $hasil;
	}
	function cmd_level_program2($id,$level){
		$ids = explode(',', $id);
		$this->db->select("id_level,nama_level");
		if($level !== '99'){
		$this->db->where_not_in('id_level',$ids);
		}
		$q= $this->db->get_where('user_level',array('id_level !='=>'99'))->result_array();
		$hasil= array_column($q,'nama_level','id_level');
		return $hasil;
	}
	function cmd_level_program3($id,$level){
		$ids = explode(',', $id);
		$this->db->select("id_level,nama_level");
		if($level !== '99'){
		$this->db->where_in('id_level',$ids);
		}
		$q= $this->db->get_where('user_level',array('id_level !='=>'99'))->result_array();
		$hasil= array_column($q,'nama_level','id_level');
		return $hasil;
	}
	function cmd_level_komite($id,$level){
		$ids = array('21','19','18','17','16');
	//	$ids = explode(',', $idx);
		$this->db->select("id_level,nama_level");
		if($level !== '99'){
		$this->db->where_in('id_level',$ids);
		}
		$this->db->order_by('id_level','desc');
		$q= $this->db->get_where('user_level',array('id_level !='=>'99'))->result_array();
		$hasil= array_column($q,'nama_level','id_level');
		return $hasil;
	}
	function cmd_unit(){
		$this->db->select("id_unit,nama_unit");
		$q= $this->db->get_where('unit',array('status_unit'=>'1'))->result_array();
		$hasil= array_column($q,'nama_unit','id_unit');
		return $hasil;
	}
	function cmd_agama(){
		$this->db->select("id_agama,nama_agama");
		$q= $this->db->get_where('kol_agama')->result_array();
		$hasil= array_column($q,'nama_agama','id_agama');
		return $hasil;
	}
	function cmd_agama_null(){
		$this->db->select("id_agama,nama_agama");
		$q= $this->db->get_where('kol_agama')->result_array();
		return $q;
	}
	function cmd_pendidikan(){
		$this->db->select("id_pendidikan,nama_pendidikan");
		$q= $this->db->get_where('kol_pendidikan',array('status_pendidikan'=>1))->result_array();
		$hasil= array_column($q,'nama_pendidikan','id_pendidikan');
		return $hasil;
	}
	function cmd_pendidikan_null(){
		$this->db->select("id_pendidikan,nama_pendidikan");
		$q= $this->db->get_where('kol_pendidikan',array('status_pendidikan'=>1))->result_array();
		return $q;
	}
	function cmd_kol_golongan_darah(){
		$this->db->select("id_golongan_darah,nama_golongan_darah");
		$q= $this->db->get_where('kol_golongan_darah')->result_array();
		return $q;
	}
	function cmd_status_kawin(){
		$this->db->select("id_status_kawin,nama_status_kawin");
		$q= $this->db->get_where('kol_status_kawin')->result_array();
		$hasil= array_column($q,'nama_status_kawin','id_status_kawin');
		return $hasil;
	}
	function cmd_status_kawin_null(){
		$this->db->select("id_status_kawin,nama_status_kawin");
		$q= $this->db->get_where('kol_status_kawin')->result_array();
		return $q;
	}
	function cmd_mata_uang(){
		$this->db->select("id_mata_uang,kode_mata_uang");
		$q= $this->db->get_where('keu_mata_uang')->result_array();
		$hasil= array_column($q,'kode_mata_uang','id_mata_uang');
		return $hasil;
	}
	function cmd_code(){
		$this->db->select("id_code,nama_code");
		$q= $this->db->get_where('keu_code')->result_array();
		$hasil= array_column($q,'nama_code','id_code');
		return $hasil;
	}
	function cmd_cara_bayar(){
		$this->db->select("id_cara_bayar,nama_cara_bayar");
		$q= $this->db->get_where('kol_cara_bayar')->result_array();
		$hasil= array_column($q,'nama_cara_bayar','id_cara_bayar');
		return $hasil;
	}
	function cmd_input_cara_bayar(){
		$this->db->select("id_cara_bayar,nama_cara_bayar");
		$array_check = array(2,5);
		$this->db->where_in('id_cara_bayar', $array_check);
		$q= $this->db->get_where('kol_cara_bayar')->result_array();
		$hasil= array_column($q,'nama_cara_bayar','id_cara_bayar');
		return $hasil;
	}
	function cmd_cara_masuk(){
		$this->db->select("id_cara_masuk,nama_cara_masuk");
		$q= $this->db->get_where('kol_cara_masuk')->result_array();
		$hasil= array_column($q,'nama_cara_masuk','id_cara_masuk');
		return $hasil;
	}
	function cmd_input_cara_masuk(){
		$this->db->select("id_cara_masuk,nama_cara_masuk");
		$array_check = array(3,4,5);
		$this->db->where_in('id_cara_masuk', $array_check);
		$q= $this->db->get_where('kol_cara_masuk')->result_array();
		$hasil= array_column($q,'nama_cara_masuk','id_cara_masuk');
		return $hasil;
	}
	function cmd_tindakan_no_null($jabatan){
		$this->db->select("id_tindakan,nama_tindakan");
		$this->db->join('kol_golongan_pemeriksaan', 'kol_golongan_pemeriksaan.id_golongan_pemeriksaan=tindakan.id_golongan_pemeriksaan','left');
//		$this->db->where('kr_kompetensi.id_jabatan', $jabatan);
		$q= $this->db->get('tindakan')->result_array();
		$hasil= array_column($q,'nama_tindakan','id_tindakan');
		return $hasil;
	}
	function cmd_kompetensi_no_null($id){
		$this->db->select("id_kompetensi,nama_kompetensi");
		$q= $this->db->get_where('kr_kompetensi',array('id_jabatan'=>$id))->result_array();
		$hasil= array_column($q,'nama_kompetensi','id_kompetensi');
		return $hasil;
	}
	function ambil_kol_golongan_pemeriksaan_graph($id)
	{
		$q = $this->db->get_where('kr_kompetensi',array('id_jabatan'=>$id))->result_array();
		return $q;
    }
		function ambil_kol_golongan_pemeriksaan_graph2($id)
		{
			$first_date = '01-'.date('m-Y');
			$last_date = date('d-m-Y');
			$this->db->select("kr_kewenangan.id_kompetensi,nama_kompetensi");
			$this->db->join('kr_kewenangan_detil', 'kr_kewenangan_detil.id_kewenangan_detil=logbook.id_kewenangan_detil','left');
			$this->db->join('kr_kewenangan', 'kr_kewenangan.id_kewenangan=kr_kewenangan_detil.id_kewenangan','left');
			$this->db->join('kr_kompetensi', 'kr_kompetensi.id_kompetensi=kr_kewenangan.id_kompetensi','left');
			$this->db->where('logbook.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
			$this->db->group_by('id_kompetensi');
			$q = $this->db->get_where('logbook',array('logbook.id_pegawai'=>$id))->result_array();
			return $q;
	    }
	function ambil_kompetensi_all()
	{
		$this->db->select("id_kompetensi,concat(nama_kompetensi, ' [ ',nama_jabatan,' ]') as nama_kompetensi,nama_jabatan");
		$this->db->join('jabatan', 'jabatan.id_jabatan=kr_kompetensi.id_jabatan','left');
		$q = $this->db->get_where('kr_kompetensi',array('status_kompetensi'=>'1'))->result_array();
		return $q;
    }
	function cmd_tahun_logbook()
	{
		$this->db->select("distinct(DATE_FORMAT(tgl_logbook,'%Y')) as tgl_logbook");
		$q= $this->db->get('logbook')->result_array();
		$hasil= array_column($q,'tgl_logbook','tgl_logbook');
		return $hasil;
    }
	function cmd_tahun_pemulihan()
	{
		$this->db->select("distinct(DATE_FORMAT(tgl_awal,'%Y')) as tgl_awal");
		$q= $this->db->get('logbook_pemulihan')->result_array();
		$hasil= array_column($q,'tgl_awal','tgl_awal');
		return $hasil;
    }
		function cmd_tahun_pemeriksaan()
		{
			$this->db->select("distinct(DATE_FORMAT(tgl_pemeriksaan,'%Y')) as tgl_pemeriksaan");
			$q= $this->db->get('pemeriksaan')->result_array();
			$hasil= array_column($q,'tgl_pemeriksaan','tgl_pemeriksaan');
			return $hasil;
	    }
	function cmd_tahun_pengajuan()
	{
		$this->db->select("distinct(DATE_FORMAT(tgl_pengajuan,'%Y')) as tgl_pengajuan");
		$q= $this->db->get('kr_pengajuan')->result_array();
		$hasil= array_column($q,'tgl_pengajuan','tgl_pengajuan');
		return $hasil;
    }
	function cmd_kewenangan(){
		$this->db->select('nama_kewenangan,id_kewenangan');
		$q = $this->db->get_where('kr_kewenangan');
		return $q->result_array();
	}
	function validateDate($date, $format = 'd-m-Y')
	{
		$d = DateTime::createFromFormat($format, $date);
		// The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
		return $d && $d->format($format) === $date;
	}
	function get_oppe_in_year($id,$thn){
		$janawal = $thn.'-01-01';
		$akhirjan = date('t', strtotime($janawal));
		$janakhir = $thn.'-01-'.$akhirjan;
		$kondisi_jml_jan = array('tgl_logbook >='=>$janawal,'tgl_logbook <='=>$janakhir,'id_pegawai'=>$id);
		$jml_jan = $this->m_umum->jumlah_record_filter('logbook',$kondisi_jml_jan);
		if($jml_jan > 0){
			$skor_jan = 1;
		}
		else{
			$skor_jan = 0;
		}

		$febawal = $thn.'-02-01';
		$akhirfeb = date('t', strtotime($febawal));
		$febakhir = $thn.'-02-'.$akhirfeb;
		$kondisi_jml_feb = array('tgl_logbook >='=>$febawal,'tgl_logbook <='=>$febakhir,'id_pegawai'=>$id);
		$jml_feb = $this->m_umum->jumlah_record_filter('logbook',$kondisi_jml_feb);
		if($jml_feb > 0){
			$skor_feb = 1;
		}
		else{
			$skor_feb = 0;
		}

		$marawal = $thn.'-03-01';
		$akhirmar = date('t', strtotime($marawal));
		$marakhir = $thn.'-03-'.$akhirmar;
		$kondisi_jml_mar = array('tgl_logbook >='=>$marawal,'tgl_logbook <='=>$marakhir,'id_pegawai'=>$id);
		$jml_mar = $this->m_umum->jumlah_record_filter('logbook',$kondisi_jml_mar);
		if($jml_mar > 0){
			$skor_mar = 1;
		}
		else{
			$skor_mar = 0;
		}

		$aprawal = $thn.'-04-01';
		$akhirapr = date('t', strtotime($aprawal));
		$aprakhir = $thn.'-04-'.$akhirapr;
		$kondisi_jml_apr = array('tgl_logbook >='=>$aprawal,'tgl_logbook <='=>$aprakhir,'id_pegawai'=>$id);
		$jml_apr = $this->m_umum->jumlah_record_filter('logbook',$kondisi_jml_apr);
		if($jml_apr > 0){
			$skor_apr = 1;
		}
		else{
			$skor_apr = 0;
		}

		$meiawal = $thn.'-05-01';
		$akhirmei = date('t', strtotime($meiawal));
		$meiakhir = $thn.'-05-'.$akhirmei;
		$kondisi_jml_mei = array('tgl_logbook >='=>$meiawal,'tgl_logbook <='=>$meiakhir,'id_pegawai'=>$id);
		$jml_mei = $this->m_umum->jumlah_record_filter('logbook',$kondisi_jml_mei);
		if($jml_mei > 0){
			$skor_mei = 1;
		}
		else{
			$skor_mei = 0;
		}

		$juniawal = $thn.'-06-01';
		$akhirjuni = date('t', strtotime($juniawal));
		$juniakhir = $thn.'-06-'.$akhirjuni;
		$kondisi_jml_juni = array('tgl_logbook >='=>$juniawal,'tgl_logbook <='=>$juniakhir,'id_pegawai'=>$id);
		$jml_juni = $this->m_umum->jumlah_record_filter('logbook',$kondisi_jml_juni);
		if($jml_juni > 0){
			$skor_juni = 1;
		}
		else{
			$skor_juni = 0;
		}

		$juliawal = $thn.'-07-01';
		$akhirjuli = date('t', strtotime($juliawal));
		$juliakhir = $thn.'-07-'.$akhirjuli;
		$kondisi_jml_juli = array('tgl_logbook >='=>$juliawal,'tgl_logbook <='=>$juliakhir,'id_pegawai'=>$id);
		$jml_juli = $this->m_umum->jumlah_record_filter('logbook',$kondisi_jml_juli);
		if($jml_juli > 0){
			$skor_juli = 1;
		}
		else{
			$skor_juli = 0;
		}

		$agstawal = $thn.'-08-01';
		$akhiragst = date('t', strtotime($agstawal));
		$agstakhir = $thn.'-08-'.$akhiragst;
		$kondisi_jml_agst = array('tgl_logbook >='=>$agstawal,'tgl_logbook <='=>$agstakhir,'id_pegawai'=>$id);
		$jml_agst = $this->m_umum->jumlah_record_filter('logbook',$kondisi_jml_agst);
		if($jml_agst > 0){
			$skor_agst = 1;
		}
		else{
			$skor_agst = 0;
		}

		$septawal = $thn.'-09-01';
		$akhirsept = date('t', strtotime($septawal));
		$septakhir = $thn.'-09-'.$akhirsept;
		$kondisi_jml_sept = array('tgl_logbook >='=>$septawal,'tgl_logbook <='=>$septakhir,'id_pegawai'=>$id);
		$jml_sept = $this->m_umum->jumlah_record_filter('logbook',$kondisi_jml_sept);
		if($jml_sept > 0){
			$skor_sept = 1;
		}
		else{
			$skor_sept = 0;
		}

		$oktawal = $thn.'-10-01';
		$akhirokt = date('t', strtotime($oktawal));
		$oktakhir = $thn.'-10-'.$akhirokt;
		$kondisi_jml_okt = array('tgl_logbook >='=>$oktawal,'tgl_logbook <='=>$oktakhir,'id_pegawai'=>$id);
		$jml_okt = $this->m_umum->jumlah_record_filter('logbook',$kondisi_jml_okt);
		if($jml_okt > 0){
			$skor_okt = 1;
		}
		else{
			$skor_okt = 0;
		}

		$nopawal = $thn.'-11-01';
		$akhirnop = date('t', strtotime($nopawal));
		$nopakhir = $thn.'-11-'.$akhirnop;
		$kondisi_jml_nop = array('tgl_logbook >='=>$nopawal,'tgl_logbook <='=>$nopakhir,'id_pegawai'=>$id);
		$jml_nop = $this->m_umum->jumlah_record_filter('logbook',$kondisi_jml_nop);
		if($jml_nop > 0){
			$skor_nop = 1;
		}
		else{
			$skor_nop = 0;
		}

		$desawal = $thn.'-12-01';
		$akhirdes = date('t', strtotime($desawal));
		$desakhir = $thn.'-12-'.$akhirdes;
		$kondisi_jml_des = array('tgl_logbook >='=>$desawal,'tgl_logbook <='=>$desakhir,'id_pegawai'=>$id);
		$jml_des = $this->m_umum->jumlah_record_filter('logbook',$kondisi_jml_des);
		if($jml_des > 0){
			$skor_des = 1;
		}
		else{
			$skor_des = 0;
		}

		$totalskor=$skor_jan+$skor_feb+$skor_mar+$skor_apr+$skor_mei+$skor_juni+$skor_juli+$skor_agst+$skor_sept+$skor_okt+$skor_nop+$skor_des;
		return $totalskor;
	}
   function reverse_birthday($date,$age) {
    list($year,$month,$day) = explode("-", $date);
    $range = $year - $age;
    return $range.'-'.$month.'-'.$day;
   }
	function hitung_jumlah_bulan($tgl1,$tgl2)
	{
		$ts1 = strtotime($tgl1);
		$ts2 = strtotime($tgl2);

		$year1 = date('Y', $ts1);
		$year2 = date('Y', $ts2);

		$month1 = date('m', $ts1);
		$month2 = date('m', $ts2);

		$diff = (($year2 - $year1) * 12) + ($month2 - $month1);
		return $diff;
	}
	function getsemiBulan($bln){
			switch ($bln){
					case 1:
						return "Jan";
						break;
					case 2:
						return "Feb";
						break;
					case 3:
						return "Mar";
						break;
					case 4:
						return "Apr";
						break;
					case 5:
						return "Mei";
						break;
					case 6:
						return "Jun";
						break;
					case 7:
						return "Jul";
						break;
					case 8:
						return "Ags";
						break;
					case 9:
						return "Sep";
						break;
					case 10:
						return "Okt";
						break;
					case 11:
						return "Nov";
						break;
					case 12:
						return "Des";
						break;
			}
	}
	function getBulan($bln){
			switch ($bln){
					case 1:
						return "Januari";
						break;
					case 2:
						return "Februari";
						break;
					case 3:
						return "Maret";
						break;
					case 4:
						return "April";
						break;
					case 5:
						return "Mei";
						break;
					case 6:
						return "Juni";
						break;
					case 7:
						return "Juli";
						break;
					case 8:
						return "Agustus";
						break;
					case 9:
						return "September";
						break;
					case 10:
						return "Oktober";
						break;
					case 11:
						return "November";
						break;
					case 12:
						return "Desember";
						break;
			}
	}
	function fullBulan($date){
		// $date = d-m-Y / 01-01-1970
		$hari = substr($date, 0, 2);
		$bln = substr($date, 3, 2);
		$thn = substr($date, 6, 4);
			switch ($bln){
					case 1:
						$bulan = "Januari";
						break;
					case 2:
						$bulan = "Februari";
						break;
					case 3:
						$bulan = "Maret";
						break;
					case 4:
						$bulan = "April";
						break;
					case 5:
						$bulan = "Mei";
						break;
					case 6:
						$bulan = "Juni";
						break;
					case 7:
						$bulan = "Juli";
						break;
					case 8:
						$bulan = "Agustus";
						break;
					case 9:
						$bulan = "September";
						break;
					case 10:
						$bulan = "Oktober";
						break;
					case 11:
						$bulan = "November";
						break;
					case 12:
						$bulan = "Desember";
						break;
			}
			return $hari.' '.$bulan.' '.$thn;
	}
	function fullBulantime($date){
		// $date = d-m-Y / 01-01-1970 00:00:00
		$hari = substr($date, 0, 2);
		$bln = substr($date, 3, 2);
		$thn = substr($date, 6, 4);
		$jam = substr($date, 11, 2);
		$mnt = substr($date, 14, 2);
		$dtk = substr($date, 17, 2);
			switch ($bln){
					case 1:
						$bulan = "Januari";
						break;
					case 2:
						$bulan = "Februari";
						break;
					case 3:
						$bulan = "Maret";
						break;
					case 4:
						$bulan = "April";
						break;
					case 5:
						$bulan = "Mei";
						break;
					case 6:
						$bulan = "Juni";
						break;
					case 7:
						$bulan = "Juli";
						break;
					case 8:
						$bulan = "Agustus";
						break;
					case 9:
						$bulan = "September";
						break;
					case 10:
						$bulan = "Oktober";
						break;
					case 11:
						$bulan = "November";
						break;
					case 12:
						$bulan = "Desember";
						break;
			}
			return $hari.' '.$bulan.' '.$thn.' - '.$jam.':'.$mnt.':'.$dtk;
	}
function dropdown_bulan()
{
    return [
        '01' => 'Januari',
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember'
    ];
}
function dropdown_tahun($rg)
{
    $now  = (int) date('Y');
    $data = [];
    $range = $rg;
    for ($i = $now - $range; $i <= $now + $range; $i++) {
        $data[$i] = $i;
    }

    return $data;
}

	function dob($date){
		$dob = $date;	 
		$today = date("Y-m-d");	 
		$diff = date_diff(date_create($dob), date_create($today));
		return $diff->format('%y') . " Tahun " . $diff->format('%m') . " Bulan " . $diff->format('%d') . " Hari";
	}
	function calc_age($date)
	{
	    $now      = new DateTime();
	    $birthday = new DateTime($date.' 00:00:00'); //Y-m-d
	    return $now->diff($birthday)->format('%y');
	}
	function anakordewasa($date)
	{
		$age = $this->calc_age($date);
		if($age > 15){
			return 'Dewasa';
		}else{
			return 'Anak';
		}
	}
	function kr_kewenangan_detil($unit,$id){
		$this->db->select('*');
		$this->db->join('kr_kewenangan', 'kr_kewenangan.id_kewenangan=kr_kewenangan_detil.id_kewenangan','left');
		$this->db->join('kr_kompetensi', 'kr_kompetensi.id_kompetensi=kr_kewenangan.id_kompetensi','left');
		$this->db->join('kol_kode_kewenangan', 'kol_kode_kewenangan.id_kode_kewenangan=kr_kewenangan_detil.id_kode_kewenangan','left');
		$this->db->join('kol_sifat_kewenangan', 'kol_sifat_kewenangan.id_sifat_kewenangan=kr_kewenangan_detil.id_sifat_kewenangan','left');
		$this->db->where('kr_kewenangan_detil.id_kode_kewenangan', $id);
		$this->db->where('kr_kewenangan_detil.id_unit', $unit);
		$this->db->order_by("kr_kewenangan_detil.id_kewenangan", "asc");
		$q = $this->db->get_where('kr_kewenangan_detil');
		return $q->result_array();
	}
	function kr_kewenangan_detil_logbook($unit,$id,$id_jabatan){
		$this->db->select('*');
		$this->db->join('kr_kewenangan', 'kr_kewenangan.id_kewenangan=kr_kewenangan_detil.id_kewenangan','left');
		$this->db->join('kr_kompetensi', 'kr_kompetensi.id_kompetensi=kr_kewenangan.id_kompetensi','left');
		$this->db->join('jabatan', 'jabatan.id_jabatan=kr_kompetensi.id_jabatan','left');
		$this->db->join('kol_kode_kewenangan', 'kol_kode_kewenangan.id_kode_kewenangan=kr_kewenangan_detil.id_kode_kewenangan','left');
		$this->db->join('kol_sifat_kewenangan', 'kol_sifat_kewenangan.id_sifat_kewenangan=kr_kewenangan_detil.id_sifat_kewenangan','left');
		$this->db->where('kr_kewenangan_detil.id_kode_kewenangan', $id);
		$this->db->where('kr_kewenangan_detil.id_unit', $unit);
		$this->db->where('kr_kompetensi.id_jabatan', $id_jabatan);
		$this->db->order_by("kr_kewenangan_detil.id_kewenangan", "asc");
		$q = $this->db->get_where('kr_kewenangan_detil');
		return $q->result_array();
	}
	//function ambil_kr_kewenangan($jabatan,$level){
	function ambil_kr_kewenangan($id){
	//	$ids = explode(',', $jabatan);
		$jabatane = $this->ambil_jabatan_pegawai($id);
		$this->db->select("kr_kewenangan.id_kewenangan,concat(nama_kewenangan,' [ ',nama_kompetensi,' - ',nama_jabatan,' ]') as nama_kewenangan");
		$this->db->join('kr_kompetensi', 'kr_kompetensi.id_kompetensi=kr_kewenangan.id_kompetensi','left');
		$this->db->join('jabatan', 'jabatan.id_jabatan=kr_kompetensi.id_jabatan','left');
/* 		if($level !== '99'){
		$this->db->where_in('kr_kompetensi.id_jabatan',$ids);
		} */
		$this->db->where('kr_kompetensi.id_jabatan', $jabatane['id_jabatan']);
		$q = $this->db->get_where('kr_kewenangan');
		return $q->result_array();
	}
	function ambil_kr_kewenangan_per_kompetensi($id,$jabatan){
		$this->db->select("kr_kewenangan.id_kewenangan,concat(nama_kewenangan,' [ Kompetensi : ',nama_kompetensi,' - Jabatan : ',nama_jabatan,' ]') as nama_kewenangan");
		$this->db->join('kr_kompetensi', 'kr_kompetensi.id_kompetensi=kr_kewenangan.id_kompetensi','left');
		$this->db->join('jabatan', 'jabatan.id_jabatan=kr_kompetensi.id_jabatan','left');
		if($id == 0){
		$this->db->where('kr_kompetensi.id_jabatan', $jabatan);
		}else{
		$this->db->where('kr_kewenangan.id_kompetensi', $id);
		}
		$q = $this->db->get_where('kr_kewenangan');
		return $q->result_array();
	}
	function kewenangan_lulus_pegawai($id){
		$this->db->select('*');
		$q = $this->db->get_where('kr_kewenangan_lulus',array('id_pegawai'=>$id));
		return $q->result_array();
	}
	function kewenangan_all()
	{
		$this->db->select('*');
		$this->db->join('kr_kewenangan', 'kr_kewenangan.id_kewenangan=kr_kewenangan_detil.id_kewenangan','left');
		$q = $this->db->get('kr_kewenangan_detil');
		//print_r($q->row_array());
		return $q->result_array();
	}
	function ambil_kol_W_recmed($id)
	{
		$q = $this->db->get_where('kol_working',array('id_working'=>$id));
		//print_r($q->row_array());
		return $q->row_array();
	}
	function ambil_rm($id)
	{
        $this->db->select("rm");
        $this->db->order_by('rm', 'DESC');
        $query=$this->db->get_where("pasien",array('pasien_instansi'=>$id));
        $result = $query->row();
        // echo $this->db->last_query();
        // echo "No Antri = ".$result->no_antri;die();
        if(isset($result))
            return $result->rm;
        return 0;
	}
    function get_rm()  //daftar.php
    {
    	$rm = $this->ambil_kol_W_recmed($this->session->refer);
    	$rm_ps = $this->ambil_rm($this->session->refer);
		$recmed = $rm['recmed'];
		$jml_recmed = $rm['jml_recmed'];
		$jml_no_recmed = $rm['jml_no_recmed'];
		$after_recmed_1 = $rm['after_recmed_1'];
		$after_recmed_2 = $rm['after_recmed_2'];
		if(empty($recmed)){
			$recmed = "";
		}else{
			$recmed = $recmed;
		}
		if($after_recmed_1 == "y2"){
			$year = date("y");
		}else if($after_recmed_1 == "y4"){
			$year = date("Y");
		}else{
			$year = "";
		}
		if($after_recmed_2 == "m2"){
			$month = date("m");
		}else if($after_recmed_2 == "m4"){
			$month = date("M");
		}else{
			$month = "";
		}		
		$noUrut = (int) substr($rm_ps, $jml_recmed, $jml_no_recmed);
		$stringe = '9';
		$repeat = $jml_no_recmed;
		$maxno = str_repeat($stringe,$jml_no_recmed);
				if ($noUrut == $maxno) {
					$noUrut = sprintf("%0".$jml_no_recmed."s", "0");
				}
				else {
					$noUrut++;
				}
		$newID = sprintf("%0".$jml_no_recmed."s", $noUrut);
		return $new_rm = $recmed . $year . $month . $newID;

    }
	function ambil_no_urut_pendaftaran($id)
	{
        $this->db->select("no_pendaftaran");
        $this->db->order_by('no_pendaftaran', 'DESC');
        $query=$this->db->get_where("pendaftaran",array('pendaftaran_instansi'=>$id));
        $result = $query->row();
        // echo $this->db->last_query();
        // echo "No Antri = ".$result->no_antri;die();
        if(isset($result))
            return $result->no_pendaftaran;
        return 0;
	}
    function get_no_urut_pendaftaran()  //daftar.php
    {
    	$rm = $this->ambil_kol_W_recmed($this->session->refer);
    	$rm_ps = $this->ambil_no_urut_pendaftaran($this->session->refer);
		$recmed = $rm['daftar'];
		$jml_recmed = $rm['jml_daftar'];
		$jml_no_recmed = $rm['jml_no_daftar'];
		$after_recmed_1 = $rm['after_daftar_1'];
		$after_recmed_2 = $rm['after_daftar_2'];
		if(empty($recmed)){
			$recmed = "";
		}else{
			$recmed = $recmed;
		}
		if($after_recmed_1 == "y2"){
			$year = date("y");
		}else if($after_recmed_1 == "y4"){
			$year = date("Y");
		}else{
			$year = "";
		}
		if($after_recmed_2 == "m2"){
			$month = date("m");
		}else if($after_recmed_2 == "m4"){
			$month = date("M");
		}else{
			$month = "";
		}		
		$noUrut = (int) substr($rm_ps, $jml_recmed, $jml_no_recmed);
		$stringe = '9';
		$repeat = $jml_no_recmed;
		$maxno = str_repeat($stringe,$jml_no_recmed);
				if ($noUrut == $maxno) {
					$noUrut = sprintf("%0".$jml_no_recmed."s", "0");
				}
				else {
					$noUrut++;
				}
		$newID = sprintf("%0".$jml_no_recmed."s", $noUrut);
		return $new_rm = $recmed . $year . $month . $newID;

    }
	function cmd_kol_pekerjaan()
	{
		$this->db->select('nama_pekerjaan,id_pekerjaan');
		$q = $this->db->get('kol_pekerjaan');
		return $q->result_array();
	}
	function cmd_kol_provinsi()
	{
		$this->db->select('nama_prov,id_prov');
		$q = $this->db->get_where('kol_provinsi');
		return $q->result_array();
	}
	function ambil_data_dropdown_kab($id)
	{
		$query = $this->db->get_where('kol_kabupaten',array('id_prov' => $id));
		return $query->result_array();
	}
	function ambil_data_dropdown_kec($id)
	{
		return $this->db->get_where('kol_kecamatan',array('id_kab' => $id))->result_array();
	}
	function ambil_data_dropdown_kel($id)
	{
		return $this->db->get_where('kol_kelurahan',array('id_kec' => $id))->result_array();
	}
	function ambil_data_dropdown_kabs($id)
	{
		$this->db->select('nama_kab,id_kab');
		$q = $this->db->get_where('kol_kabupaten',array('id_prov'=>$id));
		return $q->result_array();
	}
	function ambil_data_dropdown_kecs($id)
	{
		$this->db->select('nama_kec,id_kec');
		$q = $this->db->get_where('kol_kecamatan',array('id_kab'=>$id));
		return $q->result_array();
	}
	function ambil_data_dropdown_kels($id)
	{
		$this->db->select('nama_kel,id_kel');
		$q = $this->db->get_where('kol_kelurahan',array('id_kec'=>$id));
		return $q->result_array();
	}
	function pd_cara_masuk()
	{
		$this->db->select('nama_cara_masuk,id_cara_masuk');
		$this->db->order_by('id_cara_masuk', 'DESC');
		$q = $this->db->get_where('kol_cara_masuk');
		return $q->result_array();
	}
	function pd_cara_bayar()
	{
		$this->db->select('nama_cara_bayar,id_cara_bayar');
		$q = $this->db->get_where('kol_cara_bayar');
		return $q->result_array();
	}
	function ambil_data_dropdown_unit($sj)
	{
		$this->db->select("id_ruangan, nama_ruangan");
//		if($this->session->id_level !== '99'){
//        $ids = explode(',', $sj);$this->db->where_in('id_ruangan',$ids);
//    	}	
		$query = $this->db->get_where('ruangan',array('status_ruangan'=>1))->result_array();
		$q= array_column($query,'nama_ruangan','id_ruangan');
		return $q;
	}
	function ambil_data_dropdown_cara_bayar($id)
	{
		return $this->db->get_where('kol_detil_cara_bayar',array('id_cara_bayar' => $id))->result_array();
	}
	function ambil_data_kol_detil_cara_bayar_pd($id)
	{
		$this->db->select("nama_detil_cara_bayar,id_detil_cara_bayar");
        $query = $this->db->get_where('kol_detil_cara_bayar',array('id_cara_bayar' => $id))->result_array();
		$q= array_column($query,'nama_detil_cara_bayar','id_detil_cara_bayar');
		return $q;
	}
	function ambil_data_kol_detil_cara_bayar()
	{
		$this->db->select("nama_detil_cara_bayar,id_detil_cara_bayar");
        $query = $this->db->get_where('kol_detil_cara_bayar')->result_array();
		$q= array_column($query,'nama_detil_cara_bayar','id_detil_cara_bayar');
		return $q;
	}
	function ambil_data_dropdown_rujukan_instansi($id)
	{
		return $this->db->get_where('kol_rujukan_instansi',array('id_cara_masuk' => $id))->result_array();
	}
	function ambil_data_rujukan_instansi()
	{
		$this->db->select("nama_rujukan_instansi,id_rujukan_instansi");
        $query = $this->db->get_where('kol_rujukan_instansi')->result_array();
		$q= array_column($query,'nama_rujukan_instansi','id_rujukan_instansi');
		return $q;
	}
	function ambil_data_dropdown_rujukan_dokter($id)
	{
		if($id=='6'){
			$query = $this->db->get_where('kol_rujukan_dokter',array('id_kategori_dokter' => '2'));
		}elseif($id=='2'){
			$query = $this->db->get_where('kol_rujukan_dokter',array('id_kategori_dokter' => '1'));
		}else{
			$query = $this->db->get_where('kol_rujukan_dokter');
		}
		return $query->result_array();
	}
	function ambil_data_dropdown_radiologi_pengirim()
	{
		$ids = "14,24,127,132";
		$id = explode(',', $ids);
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
		$this->db->join('ol_user', 'ol_user.id_pegawai=ol_pegawai.id_pegawai','left');
		$this->db->where_in('id_jabatan',$id);
		$query = $this->db->get_where('ol_pegawai',array('status_pegawai' => 1,'refer'=>$this->session->refer));
		return $query->result_array();
	}
	function ambil_data_radiologi_pengirim()
	{
		$this->db->select("nama_pegawai,ol_user.id_pegawai");
		$ids = "14,24,127,132";
		$id = explode(',', $ids);
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
		$this->db->join('ol_user', 'ol_user.id_pegawai=ol_pegawai.id_pegawai','left');
		$this->db->where_in('id_jabatan',$id);
        $query = $this->db->get_where('ol_pegawai',array('status_pegawai'=>1,'refer'=>$this->session->refer))->result_array();
		$q= array_column($query,'nama_pegawai','id_pegawai');
		return $q;
	}
	function ambil_data_spesialis()
	{
		$this->db->select("nama_pegawai,ol_user.id_pegawai");
		$ids = "127,132";
		$id = explode(',', $ids);
		$this->db->join('jabatan_fungsional', 'jabatan_fungsional.id_jabatan_fungsional=ol_pegawai.id_jabatan_fungsional','left');
		$this->db->join('ol_user', 'ol_user.id_pegawai=ol_pegawai.id_pegawai','left');
		$this->db->where_in('id_jabatan',$id);
        $query = $this->db->get_where('ol_pegawai',array('status_pegawai'=>1,'refer'=>$this->session->refer))->result_array();
		$q= array_column($query,'nama_pegawai','id_pegawai');
		return $q;
	}
	function ambil_pegawai_daftar()
	{
		$this->db->join('ol_user', 'ol_user.id_pegawai=ol_pegawai.id_pegawai','left');
	//	$this->db->where_in('id_jabatan',$id);
		$query = $this->db->get_where('ol_pegawai',array('status_pegawai' => 1,'refer'=>$this->session->refer));
		return $query->result_array();
	}
	function ambil_data_dropdown_radiologi_unit($id)
	{
		$radiologi    = $this->m_umum->ambil_data('a_program','id_program','1');
		$ids = explode(',', $radiologi['ruangan']);
		$this->db->where_in('id_ruangan',$ids);
		$query = $this->db->get_where('ruangan',array('status_ruangan' => '1'));
		return $query->result_array();
	}
	function ambil_data_radiologi_unit()
	{
		$this->db->select("nama_ruangan,id_ruangan");
        $query = $this->db->get_where('ruangan')->result_array();
		$q= array_column($query,'nama_ruangan','id_ruangan');
		return $q;
	}
	function cmd_data_ruangan()
	{
		$ids = array('4','5','6','7','8','9','10');
		$this->db->select('nama_ruangan,id_ruangan');
		$this->db->where_in('id_struktur_jabatan',$ids);
    $query = $this->db->get_where('ruangan',array('status_ruangan' => '1'))->result_array();
		$q= array_column($query,'nama_ruangan','id_ruangan');
		return $q;
	}
	function ambil_kol_komite(){
		$this->db->select("id_komite,nama_komite");
		$q = $this->db->get_where('kol_komite',array('status_komite'=>1))->result_array();
		$hasil= array_column($q,'nama_komite','id_komite');
		return $hasil;
	}
	function ambil_kol_komite_null()
	{
		$this->db->select('nama_komite,id_komite');
		$q = $this->db->get_where('kol_komite',array('status_komite'=>1));
		return $q->result_array();
	}
	function ambil_srt_dpk_null()
	{
		$this->db->select('nama_dpk,id_dpk');
		$q = $this->db->get_where('srt_dpk',array('status_dpk'=>1,'id_jabatan'=>$this->session->id_jabatan));
		return $q->result_array();
	}
}
/*
	var keycode;
	$('.nospace').keypress(function (event) {
		keycode = (event.charCode) ? event.charCode : ((event.which) ? event.which : event.keyCode);
		if (keycode == 32) {
			return false
		};
	});
	
{ "data": null, "orderable": false, 
"render" : function ( data, type, full ) { 
return 'RM : '+full['rm']+' - NIK : '+full['nik']+' - '+full['nama_pasien']+' TTL : ('+full['tmp_lahir']+', '+full['tgl_lahir']+') - [ '+full['umur']+' ]';
}
},
====================================================
ADD REMOVE ROW TABLE

<table id="addProducts" border="1">
            <tr>
                <td>POI</td>
                <td>Quantity</td>
                <td>Price</td>
                <td>Product</td>
                <td>Add Rows?</td>
            </tr>
            <tr>
                <td>1</td>
                <td><input size=25 type="text" id="lngbox" readonly=true/></td> 
                <td><input size=25 type="text" class="price" readonly=true/></td>
                <td>
                    <select name="selRow0" class="products">
                        <option value="500">Product 1</option>
                        <option value="200">Product 2</option>
                         <option value="450">Product 3</option>
                    </select>   
                </td>   
                <td><input type="button" class="delProduct" value="Delete" /></td>
                <td><input type="button" class="addProduct" value="AddMore" /></td>
            </tr>
        </table>
        <div id="shw"></div>
        
$(function () {
  $(document).on('change', 'select.products', function(){
    var selected = $(this).val();
    //$(".price").val(selected);
    $(this).closest('tr').find(".price").val(selected);
  });
  $(document).on('click', '.addProduct', function(){
    var ele = $(this).parents('tr').clone();
    ele.find('input[type=text]').val('');
    $(this).parents('tr').after(ele);
  });
  $(document).on('click', '.delProduct', function(){
    if($(this).parents('table').find('tr').length > 2) {
      $(this).parents('tr').remove();
    }
  });
});
====================================================
// =================================================================
	MEMBUAT NO URUT DENGAN KODE
// =================================================================
	$tahun = date("Y");
	$month = date('m');
	$jenisx = "PX";
	$queryx = "SELECT max(no_pasien) as maxID FROM pasien";
	$hasilx = mysql_query($queryx);
	$datax  = mysql_fetch_array($hasilx);
	$idMax = $datax['maxID'];
	$noUrut = (int) substr($idMax, 8, 6);
			if ($noUrut == "999999") {
				$noUrut = "000000";
			}
			else {
				$noUrut++;
			}
	$newID = $jenisx . $tahun . $month . sprintf("%06s", $noUrut);
// =================================================================

document.getElementById('input').onkeydown = function (e) {
  var value =  e.target.value;
  //only allow a-z, A-Z, digits 0-9 and comma, with only 1 consecutive comma ...
  if (e.key.match(/_/) || !e.key.match(/[\w\d,]/) || (e.key == ',' && value[value.length-1] == ',')) {
    e.preventDefault();  
  }
};


seting numeric or others
// Restricts input for the given textbox to the given inputFilter.
function setInputFilter(textbox, inputFilter, errMsg) {
  ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop", "focusout"].forEach(function(event) {
    textbox.addEventListener(event, function(e) {
      if (inputFilter(this.value)) {
        // Accepted value
        if (["keydown","mousedown","focusout"].indexOf(e.type) >= 0){
          this.classList.remove("input-error");
          this.setCustomValidity("");
        }
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        // Rejected value - restore the previous one
        this.classList.add("input-error");
        this.setCustomValidity(errMsg);
        this.reportValidity();
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      } else {
        // Rejected value - nothing to restore
        this.value = "";
      }
    });
  });
}


// Install input filters.
setInputFilter(document.getElementById("intTextBox"), function(value) {
  return /^-?\d*$/.test(value); }, "Must be an integer");
setInputFilter(document.getElementById("uintTextBox"), function(value) {
  return /^\d*$/.test(value); }, "Must be an unsigned integer");
setInputFilter(document.getElementById("intLimitTextBox"), function(value) {
  return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 500); }, "Must be between 0 and 500");
setInputFilter(document.getElementById("floatTextBox"), function(value) {
  return /^-?\d*[.,]?\d*$/.test(value); }, "Must be a floating (real) number");
setInputFilter(document.getElementById("currencyTextBox"), function(value) {
  return /^-?\d*[.,]?\d{0,2}$/.test(value); }, "Must be a currency value");
setInputFilter(document.getElementById("latinTextBox"), function(value) {
  return /^[a-z]*$/i.test(value); }, "Must use alphabetic latin characters");
setInputFilter(document.getElementById("hexTextBox"), function(value) {
  return /^[0-9a-f]*$/i.test(value); }, "Must use hexadecimal characters");


// html
<h2>JavaScript input filter showcase</h2>
<p>Supports Copy+Paste, Drag+Drop, keyboard shortcuts, context menu operations, non-typeable keys, the caret position, different keyboard layouts, and <a href="https://caniuse.com/#feat=input-event" target="_blank">all browsers since IE 9</a>.</p>
<p>There is also a <a href="https://jsfiddle.net/emkey08/tvx5e7q3" target="_blank">jQuery version</a> of this.</p>
<table>
  <tr><td>Integer</td><td><input id="intTextBox"></td></tr>
  <tr><td>Integer &gt;= 0</td><td><input id="uintTextBox"></td></tr>
  <tr><td>Integer &gt;= 0 and &lt;= 500</td><td><input id="intLimitTextBox"></td></tr>
  <tr><td>Float (use . or , as decimal separator)</td><td><input id="floatTextBox"></td></tr>
  <tr><td>Currency (at most two decimal places)</td><td><input id="currencyTextBox"></td></tr>
  <tr><td>A-Z only</td><td><input id="latinTextBox"></td></tr>
  <tr><td>Hexadecimal</td><td><input id="hexTextBox"></td></tr>
</table>

//css
.input-error{
  outline: 1px solid red;
}



Comparison      | Result
------------------------
 "0" == "0"     | true
 "0" == "0.0"   | true
 "0" == "foo"   | false
 "0" == ""      | false
"42" == "   42" | true
"42" == "42foo" | false

Null means "nothing". The var has not been initialized.

False means "not true in a boolean context". Used to explicitly show you are dealing with logical issues.

0 is an int. Nothing to do with the rest above, used for mathematics.

Now, what is tricky, it's that in dynamic languages like PHP, all of them have a value in a boolean context, which (in PHP) is False.

If you test it with ==, it's testing the boolean value, so you will get equality. If you test it with ===, it will test the type, and you will get inequality.

if($variable === NULL) {...}
Note the ===.
When use ==, as you did, PHP treats NULL, false, 0, the empty string, and empty arrays as equal.

=======================================================
Rumus Aktiva Lancar (Current Assets)
===============================================================
Current Assets = C + CE + I + AR + MS + PE +OLA

Keterangan:
C = Cash atau uang tunai
CE = Cash Equivalents atau aset lain setara kas
I = Inventory atau persediaan
AR = Accounts Receivable atau piutang usaha
MS = Marketable Securities atau surat berharga
PE = Prepaid Expenses atau biaya dibayar dimuka
OLA = Other Liquid Assets atau aset likuid lainnya


Rumus Pasiva Lancar (Current Liabilities)
===============================================================
Current Liabilities = NP + AP + STL + AE + UR + CPLTD + OSTD

Keterangan:
NP = Notes Payable atau utang wesel
AP = Accounts Payable atau utang usaha
STL = Short-term Loans atau pinjaman jangka pendek
AE = Accrued Expenses atau beban yang masih perlu dibayar
UR = Unearned Revenue atau pendapatan diterima di muka
CPLTD = Current Portion of Long-term Debts atau utang jangka panjang
OSTD = Other Short-term Debt atau utang jangka pendek lainnya


Rumus Aktiva Tetap (Fixed Assets)
===============================================================
Net Fixed Assets = TFA – AD

Keterangan:
TFA = Total Fixed Assets atau total aktiva tetap
AD = Accumulated Depreciation atau akumulasi penyusutan


Rumus Pasiva Tetap (Long-Term Liabilities)
===============================================================
Long-Term Liabilities = D + L + DTL

Keterangan:
D = Debentures atau Surat Utang
Loan = Loans atau Pinjaman
DFL = Deferred Tax Liabilities atau kewajiban pajak tertunda
------------------------------------------------------------------------------
RESIZE IMAGE BEFORE UPLOAD IMAGE

CONTROLLER :
------------
function doUpload($control, $path, $imageName, $sizes)
{
    if( ! isset($_FILES[$control]) || ! is_uploaded_file($_FILES[$control]['tmp_name']))
    {
        print('No file was chosen');
        return FALSE;
    } 
    if($_FILES[$control]['size']>2048000)
    {
        print('File is too large ('.round(($_FILES[$control]["size"]/1000)).'kb), please choose a file under 2,048kb');
        return FALSE;
    }
    if($_FILES[$control]['error'] !== UPLOAD_ERR_OK)
    {
        print('Upload failed. Error code: '.$_FILES[$control]['error']);
        Return FALSE;
    }
    switch(strtolower($_FILES[$control]['type']))
    {
    case 'image/jpeg':
            $image = imagecreatefromjpeg($_FILES[$control]['tmp_name']);
            move_uploaded_file($_FILES[$control]["tmp_name"],$path.$imageName);
            break;
    case 'image/png':
            $image = imagecreatefrompng($_FILES[$control]['tmp_name']);
            move_uploaded_file($_FILES[$control]["tmp_name"],$path.$imageName);
            break;
    case 'image/gif':
            $image = imagecreatefromgif($_FILES[$control]['tmp_name']);
            move_uploaded_file($_FILES[$control]["tmp_name"],$path.$imageName);
            break;
    default:
           print('This file type is not allowed');
           return false;
    }
    @unlink($_FILES[$control]['tmp_name']);
    $old_width      = imagesx($image);
    $old_height     = imagesy($image);


    //Create tn version
    if($sizes=='tn' || $sizes=='all')
    {
    $max_width = 100;
    $max_height = 100;
    $scale          = min($max_width/$old_width, $max_height/$old_height);
    if ($old_width > 100 || $old_height > 100)
    {
    $new_width      = ceil($scale*$old_width);
    $new_height     = ceil($scale*$old_height);
    } else {
        $new_width = $old_width;
        $new_height = $old_height;
    }
    $new = imagecreatetruecolor($new_width, $new_height);
    imagecopyresampled($new, $image,0, 0, 0, 0,$new_width, $new_height, $old_width, $old_height);
    switch(strtolower($_FILES[$control]['type']))
    {
    case 'image/jpeg':
            imagejpeg($new, $path.'tn_'.$imageName, 90);
            break;
    case 'image/png':
            imagealphablending($new, false);
            imagecopyresampled($new, $image,0, 0, 0, 0,$new_width, $new_height, $old_width, $old_height);
            imagesavealpha($new, true); 
            imagepng($new, $path.'tn_'.$imageName, 0);
            break;
    case 'image/gif':
            imagegif($new, $path.'tn_'.$imageName);
            break;
    default:
    }
    }

    imagedestroy($image);
    imagedestroy($new);
    print '<div style="font-family:arial;"><b>'.$imageName.'</b> Uploaded successfully. Size: '.round($_FILES[$control]['size']/1000).'kb</div>';
}

VIEW
----
<input type="file" name="manuLogoUpload" id="manuLogoUpload" onchange="return ajaxFileUpload2(this);"/>

AJAX
----
function ajaxFileUpload2(upload_field)
{
    var re_text = /\.jpg|\.gif|\.jpeg|\.png/i;
    var filename = upload_field.value;
    var imagename = filename.replace("C:\\fakepath\\","");
    if (filename.search(re_text) == -1) 
    {
        alert("File must be an image");
        upload_field.form.reset();
        return false;
    }
    upload_field.form.action = "addManufacturerLogo";
    upload_field.form.target = "upload_iframe";
    upload_field.form.submit();
    upload_field.form.action = "";
    upload_field.form.target = "";
    document.getElementById("logoFileName").value = imagename;
    document.getElementById("logoFileName1").value = imagename;
    document.getElementById("manuLogoText").style.display="block";
    document.getElementById("logoLink").style.display="none";
    $.prettyPhoto.close();
    return true;        
}

Regular controller function:
----------------------------
function addManufacturerLogo()
{
    $control = 'manuLogoUpload';
    $image = $_FILES[$control]['name'];
    if($imageName = $this->doUpload($control,LOGO_PATH,$image,'all'))
    {

    } else {

    }
}

config/constants.php << for the LOGO_PATH. Change these (and the name) to suit your purposes. The reasoning is if I ever change where I want to save images I change it in the constants rather than in 10 places throughout my application.

define('LOGO_PATH',APPPATH.'assets/images/manulogos/');
define('PROD_IMAGE_PATH',APPPATH.'../assets/images/prod_images/');

==================================
uploadmax
if(!empty($_FILES['image']['name']) && ($_FILES['image']['error']==1 || $_FILES['image']['size']>2097152))
{
    return "<div class='alert alert-danger'>Max 2MB file is allowed for image.</div>";
}
 */
