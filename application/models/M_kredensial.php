<?php
class M_kredensial extends CI_model{
	function cmd_jabatan_fr_indikator(){
		$this->db->select("id_jabatan,nama_jabatan");
		$this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nin.id_asesmen','left');
		$this->db->join('jabatan j', 'j.id_jabatan=nas.id_jabatan','left');
		$q = $this->db->get_where('nkr_indikator nin')->result_array();
		$hasil= array_column($q,'nama_jabatan','id_jabatan');
		return $hasil;
	}
	function cmd_jabatan_fr_question(){
		$this->db->select("id_jabatan,nama_jabatan");
		$this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nin.id_asesmen','left');
		$this->db->join('jabatan j', 'j.id_jabatan=nas.id_jabatan','left');
		$q = $this->db->get_where('nkr_question_f2 nin')->result_array();
		$hasil= array_column($q,'nama_jabatan','id_jabatan');
		return $hasil;
	}
	function cmd_kompetensi_in($id){
		$ids = explode(',', $id);
		$this->db->select("id_kompetensi, CONCAT('[',kode_unit,'] ',nama_kompetensi,'--',nama_jabatan) as nama_kompetensi");
		$this->db->join('jabatan j', 'j.id_jabatan=nkr_kompetensi.id_jabatan','left');
		if ( $this->session->has_userdata('id_level') && $this->session->userdata('id_level')==99 ){

		}else{
			$this->db->where_in('nkr_kompetensi.id_jabatan',$ids);
		}
		$this->db->order_by('nkr_kompetensi.id_kompetensi','desc');
		$q= $this->db->get_where('nkr_kompetensi',array('status_kompetensi'=>1))->result_array();
		$hasil= array_column($q,'nama_kompetensi','id_kompetensi');
		return $hasil;
	}
	function cek_num_pengajuan_kompetensi_validator($id)
	{
		$this->db->select('COUNT(*) as num');
		$this->db->where("FIND_IN_SET(".$this->session->id_pegawai.",pegawai_pengajuan)!=",0);
		$query = $this->db->get_where('ol_pengajuan',array('barcode_pengajuan'=>$id));
	    $result = $query->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
	}
	function cek_num_form_pengajuan_validator($id,$idp,$idf)
	{
	//	$ids = explode(',', $this->session->id_pegawai);
		$this->db->select('COUNT(*) as num');
	//	$this->db->where_in('pegawai_pengajuan',$ids);
		$this->db->where("FIND_IN_SET(".$idf.",nkr_form)!=",0);
		$query = $this->db->get_where('nkr_pengajuan_validator',array('barcode_pengajuan'=>$id,'id_asesor'=>$idp));
	    $result = $query->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
	}
	function cek_num_pengajuan_validator($id,$idp)
	{
		$this->db->select('COUNT(*) as num');
		$query = $this->db->get_where('nkr_pengajuan_validator',array('barcode_pengajuan'=>$id,'id_asesor'=>$idp));
	    $result = $query->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
	}
	function ambil_pengajuan_kompetensi($id){
		$this->db->select("*,ol_pengajuan.id_instansi as id_instansi,
							CONCAT((TIMESTAMPDIFF( YEAR, tgl_lahir, now() )), ' Tahun ', 
							TIMESTAMPDIFF( MONTH, tgl_lahir, now() ) % 12, ' Bulan ',
							FLOOR( TIMESTAMPDIFF( DAY, tgl_lahir, now() ) % 30.4375 ), ' Hari') as umur
		");
		$this->db->join('ol_status_diusulkan', 'ol_status_diusulkan.id_status_diusulkan=ol_pengajuan.id_status_diusulkan','left');
		$this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=ol_pengajuan.kode_unit_pengajuan','left');
    $this->db->join('ol_pegawai p', 'p.barcode_pegawai=ol_pengajuan.barcode_pegawai','left');
		$this->db->join('kol_agama ag', 'ag.id_agama=p.id_agama','left');
		$this->db->join('kol_status_kawin ksk', 'ksk.id_status_kawin=p.id_status_kawin','left');
		$this->db->join('kol_pendidikan pend', 'pend.id_pendidikan=p.id_pendidikan','left');
		$this->db->join('ol_status_pegawai ksp', 'ksp.id_status_pegawai=p.tipe_pegawai','left');
		$this->db->join('jabatan_fungsional jf', 'jf.id_jabatan_fungsional=p.id_jabatan_fungsional','left');
		$this->db->join('jabatan j', 'j.id_jabatan=jf.id_jabatan','left');
		$this->db->join('kol_provinsi kprov', 'kprov.id_prov=p.id_prov','left');
		$this->db->join('kol_kabupaten kkab', 'kkab.id_kab=p.id_kab','left');
		$this->db->join('kol_kecamatan kkec', 'kkec.id_kec=p.id_kec','left');
		$this->db->join('kol_kelurahan kkel', 'kkel.id_kel=p.id_kel','left');
		$this->db->join('kol_working kw', 'kw.id_working=ol_pengajuan.id_instansi','left');
		$q = $this->db->get_where('ol_pengajuan',array('barcode_pengajuan'=>$id));
		return $q->row_array();
	}
function ambil_link_asesi($id){
  $this->db->join('nkr_form nf', 'nf.barcode_form=npv.barcode_form','left');
  $this->db->join('kol_jenis_form kjf', 'kjf.id_jenis_form=nf.id_jenis_form','left');
  $this->db->join('ol_pegawai op', 'op.id_pegawai=npv.id_asesor','left');
  $this->db->order_by('nf.id_jenis_form','ASC');
  $q = $this->db->get_where('nkr_pengajuan_validasi npv',array('status_jenis_form'=>1,'display_asesi'=>1,'npv.barcode_pengajuan'=>$id));
  return $q->result_array();
}
function ambil_link_kompetensi($kondisi,$id = FALSE){
	$this->db->select("*,npv.barcode_pengajuan_validasi as bpv");
  $this->db->join('nkr_form nf', 'nf.barcode_form=npv.barcode_form','left');
  $this->db->join('kol_jenis_form kjf', 'kjf.id_jenis_form=nf.id_jenis_form','left');
  $this->db->join('ol_pegawai op', 'op.id_pegawai=npv.id_asesor','left');
	if($id === FALSE)
	{
		  $eimplo = explode(',', $id);
		  $this->db->where_in('nf.id_jenis_form',$eimplo);
	}
  $this->db->order_by('nf.id_jenis_form','ASC');
  $q = $this->db->get_where('nkr_pengajuan_validasi npv',$kondisi);
  return $q->row_array();
}
	function ambil_pengajuan_validasi_pengajuan_valiasi($id){
//	  $this->db->join('nkr_form nf', 'nf.barcode_form=npv.barcode_form','left');
	    $this->db->join('kol_jenis_form kjf', 'kjf.id_jenis_form=npv.id_jenis_form','left');
	  $this->db->join('nkr_kompetensi kp', 'kp.id_kompetensi=npv.id_kompetensi','left');
	  $this->db->join('jabatan j', 'j.id_jabatan=kp.id_jabatan','left');
	  $this->db->join('ol_pegawai p', 'p.id_pegawai=npv.id_asesor','left');
	  $q = $this->db->get_where('nkr_pengajuan_validasi npv',array('npv.barcode_pengajuan_validasi'=>$id));
	  return $q->row_array();
	}	
	function ambil_pengajuan_validasi_asesor($kondisi){
	  $this->db->join('nkr_kompetensi kp', 'kp.id_kompetensi=npv.id_kompetensi','left');
	  $this->db->join('jabatan j', 'j.id_jabatan=kp.id_jabatan','left');
	  $this->db->join('ol_pegawai p', 'p.id_pegawai=npv.id_asesor','left');
	  $q = $this->db->get_where('nkr_pengajuan_validasi npv',$kondisi);
	  return $q->row_array();
	}
	function ambil_form_clicked($kondisi){
		$this->db->select("concat(url_link,'||',barcode_pengajuan_validasi) as url_link,nama_jenis_form");
	  $this->db->join('kol_jenis_form kjf', 'kjf.id_jenis_form=npv.id_jenis_form','left');
	  $this->db->order_by('npv.id_jenis_form','ASC');
	  $q = $this->db->get_where('nkr_pengajuan_validasi npv',$kondisi);
	  return $q->result_array();
	}
	function result_pengajuan_validasi_asesor($id,$ids){
//	  $this->db->join('nkr_form nf', 'nf.barcode_form=npv.barcode_form','left');
	//  $this->db->join('nkr_kompetensi kp', 'kp.id_kompetensi=nf.id_kompetensi','left');
	  $this->db->join('kol_jenis_form kjf', 'kjf.id_jenis_form=npv.id_jenis_form','left');
	  $this->db->join('ol_pegawai p', 'p.id_pegawai=npv.id_asesor','left');
	  $q = $this->db->get_where('nkr_pengajuan_validasi npv',array('npv.barcode_pengajuan'=>$id,'id_asesor'=>$ids));
	  return $q->result_array();
	}
	function ambil_pengajuan_validasi($id,$form){
	  $this->db->join('nkr_form nf', 'nf.barcode_form=npv.barcode_form','left');
	  $this->db->join('kol_jenis_form kjf', 'kjf.id_jenis_form=nf.id_jenis_form','left');
	  $this->db->join('nkr_kompetensi kp', 'kp.id_kompetensi=nf.id_kompetensi','left');
	  $this->db->join('jabatan j', 'j.id_jabatan=kp.id_jabatan','left');
	  $this->db->join('ol_pegawai p', 'p.id_pegawai=npv.id_asesor','left');
	  $q = $this->db->get_where('nkr_pengajuan_validasi npv',array('npv.barcode_pengajuan'=>$id,'npv.barcode_form'=>$form));
	  return $q->row_array();
	}	
	function ambil_pengajuan_validasi_pengajuan($id){
	  $this->db->join('nkr_form nf', 'nf.barcode_form=npv.barcode_form','left');
	  $this->db->join('nkr_kompetensi kp', 'kp.id_kompetensi=nf.id_kompetensi','left');
	  $this->db->join('jabatan j', 'j.id_jabatan=kp.id_jabatan','left');
	  $this->db->join('ol_pegawai p', 'p.id_pegawai=npv.id_asesor','left');
	  $q = $this->db->get_where('nkr_pengajuan_validasi npv',array('npv.barcode_pengajuan'=>$id));
	  return $q->row_array();
	}	
	function jumlah_pengajuan_validasi($id,$idp,$form){
	  $this->db->select('COUNT(*) as num');
	  $this->db->join('nkr_form nf', 'nf.barcode_form=npv.barcode_form','left');
	  $query = $this->db->get_where('nkr_pengajuan_validasi npv',array('npv.barcode_pengajuan'=>$id,'id_asesor'=>$idp,'nf.id_jenis_form'=>$form));
	    $result = $query->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
	}
	function ambil_peval($id,$form,$idp){
		$this->db->join('nkr_form nf', 'nf.barcode_form=npv.barcode_form','left');
	    $this->db->join('nkr_kompetensi kp', 'kp.id_kompetensi=nf.id_kompetensi','left');
	    $this->db->join('jabatan j', 'j.id_jabatan=kp.id_jabatan','left');
		$this->db->join('ol_pegawai p', 'p.id_pegawai=npv.id_asesor','left');
		$q = $this->db->get_where('nkr_pengajuan_validasi npv',array('npv.barcode_pengajuan'=>$id,'npv.barcode_pengajuan'=>$pg,'id_asesor'=>$idp));
		return $q->row_array();
	}	
	function jumlah_peval($id,$pg,$idp){
	  $this->db->select('COUNT(*) as num');
	  $query = $this->db->get_where('nkr_pengajuan_validasi npv',array('npv.barcode_pengajuan'=>$id,'npv.barcode_pengajuan'=>$pg,'id_asesor'=>$idp));
	    $result = $query->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
	}
	function ambil_nkr_kewenangan_dari_nkr_kompetensi($id,$idk){
	  $this->db->join('nkr_kewenangan kk', 'kk.id_kewenangan=ol.id_kewenangan','left');
	  $this->db->group_by('ol.id_kewenangan');
	  $q = $this->db->get_where('ol_logbook ol',array('id_pengajuan'=>$id,'id_kompetensi'=>$idk));
	  return $q->result_array();
	}
	function ambil_soal_opsi($id){
	  $this->db->order_by('no_urut_soal_opsi','ASC');
	  $q = $this->db->get_where('nkr_soal_opsi',array('id_indikator'=>$id));
	  return $q->result_array();
	}
	function ambil_soal_opsie($id){
	  $this->db->order_by('no_urut_soal_opsi','ASC');
	  $q = $this->db->get_where('nkr_soal_opsi',array('id_indikator'=>$id,'status_soal_opsi'=>1));
	  return $q->result_array();
	}
	function ambil_nkr_kewenangan_dari_nkr_kompetensi_row($id){
	  $this->db->join('nkr_kewenangan kk', 'kk.id_kewenangan=ol.id_kewenangan','left');
	  $this->db->group_by('ol.id_kewenangan');
	  $q = $this->db->get_where('ol_logbook ol',array('id_pengajuan'=>$id));
	  return $q->row_array();
	}
	function ambil_nkr_asesmen_tuk_form($id,$idj){
	  $this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nf2.id_asesmen','left');
	  $this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
	  $this->db->join('jabatan j', 'j.id_jabatan=nas.id_jabatan','left');
	  if($idj > 0){
	  $this->db->where('nas.id_jabatan', $idj); }
	  if($id == 0){ $id = 1; }
	  $this->db->order_by('nas.id_jabatan','asc');
	  $q = $this->db->get_where('nkr_question_f2 nf2',array('nas.id_elemen'=>$id));
	  return $q->result_array();
	}
	function ambil_nkr_indikator_tuk_form3($id,$idj){
	  $this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nin.id_asesmen','left');
	  $this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
	  $q = $this->db->get_where('nkr_indikator nin',array('nas.id_elemen'=>$id,'nas.id_jabatan'=>$idj,'nin.status_indikator'=>1));
	  return $q->result_array();
	}
	function ambil_nkr_indikator_poin($id,$idj){
	  $this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nin.id_asesmen','left');
	  $this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
	  $this->db->where('nin.poin_indikator !="" ', NULL, FALSE);
	  $q = $this->db->get_where('nkr_indikator nin',array('nas.id_elemen'=>$id,'nas.id_jabatan'=>$idj,'nin.status_indikator'=>1));
	  return $q->result_array();
	}
	function ambil_nkr_indikator_ketercapaian($id,$idj){
	  $this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nin.id_asesmen','left');
	  $this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
	  $this->db->where('nin.ketercapaian_indikator !="" ', NULL, FALSE);
	  $q = $this->db->get_where('nkr_indikator nin',array('nas.id_elemen'=>$id,'nas.id_jabatan'=>$idj,'nin.status_indikator'=>1));
	  return $q->result_array();
	}
	function ambil_nkr_indikator_jawaban($id,$idj){
	  $this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nin.id_asesmen','left');
	  $this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
	  $this->db->where('nin.jawaban_indikator !="" ', NULL, FALSE);
	  $q = $this->db->get_where('nkr_indikator nin',array('nas.id_elemen'=>$id,'nas.id_jabatan'=>$idj,'nin.status_indikator'=>1));
	  return $q->result_array();
	}
	function ambil_nkr_indikator_pertanyaan($id,$idj){
	  $this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nin.id_asesmen','left');
	  $this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
	  $this->db->where('nin.pertanyaan_indikator !="" ', NULL, FALSE);
	  $q = $this->db->get_where('nkr_indikator nin',array('nas.id_elemen'=>$id,'nas.id_jabatan'=>$idj,'nin.status_indikator'=>1));
	  return $q->result_array();
	}
	function ambil_nkr_pra_detil($id,$idj){
	  $this->db->join('nkr_pra_asesmen npa', 'npa.barcode_pra_asesmen=npd.barcode_pra_asesmen','left');
	  $this->db->join('jabatan j', 'j.id_jabatan=npd.id_jabatan','left');
	  if($idj == 0){
		$array_check = array(0);
	  }else{
		$array_check = array(0,$idj);
	  }
	  $this->db->where_in('npd.id_jabatan', $array_check);
	  $q = $this->db->get_where('nkr_pra_detil npd',array('npd.barcode_pra_asesmen'=>$id));
	  return $q->result_array();
	}
	function find_edit_form($obj,$idobj,$id){
	  $find = $this->m_umum->ambil_data_result('nkr_form_detil',$idobj,$obj);
	  $arr = array();
	  foreach($find as $val){
	      $arr[] = $val[$id];
	  }
	  $eimplo = implode(",", $arr);
	  $array_check = array($eimplo);
	  $this->db->join('nkr_pra_asesmen npa', 'npa.barcode_pra_asesmen=npd.barcode_pra_asesmen','left');
	  $this->db->join('jabatan j', 'j.id_jabatan=npd.id_jabatan','left');
	  $this->db->where_in('npd.id_jabatan', $array_check);
	  $q = $this->db->get_where('nkr_pra_detil npd',array('npd.barcode_pra_asesmen'=>$id));
	  return $q->result_array();
	}
    function urut_form_detil($id)
    {
        $this->db->where("barcode_form", $id);
        $this->db->order_by('no_urut_detil', 'DESC');
        $query=$this->db->get_where("nkr_form_detil");
        $result = $query->row();
        // echo $this->db->last_query();
        // echo "No Antri = ".$result->no_antri;die();
        if(isset($result))
            return $result->no_urut_detil;
        return 0;
    }
	function ambil_nkr_form($id){
	  $this->db->join('nkr_kompetensi kp', 'kp.id_kompetensi=nf2.id_kompetensi','left');
	  $this->db->join('jabatan j', 'j.id_jabatan=kp.id_jabatan','left');
	  $this->db->join('kol_working kw', 'kw.id_working=nf2.id_instansi','left');
	  $q = $this->db->get_where('nkr_form nf2',array('nf2.barcode_form'=>$id));
	  return $q->row_array();
	}
	function ambil_nkr_form_detil($id,$kondisi){
	  $this->db->join('nkr_form nf2', 'nf2.barcode_form=nfd2.barcode_form','left');
	  $this->db->join('nkr_question_f2 nq2', 'nq2.id_question=nfd2.id_question','left');
	  $this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nq2.id_asesmen','left');
	  $this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
	  $this->db->join('nkr_kompetensi kp', 'kp.id_kompetensi=nf2.id_kompetensi','left');
	  $this->db->join('jabatan j', 'j.id_jabatan=kp.id_jabatan','left');
	  $this->db->join('kol_working kw', 'kw.id_working=nf2.id_instansi','left');
	  $ids = explode(',', $id);
	  $this->db->where('nfd2.id_question !="" ', NULL, FALSE);
	  $this->db->where_in('nf2.id_kompetensi', $ids);
	  $this->db->order_by('nfd2.no_urut_detil', 'asc');
	  $q = $this->db->get_where('nkr_form_detil nfd2',$kondisi);
	  return $q->result_array();
	}
	function ambil_poin_nkr_form4_detil($id,$ins){
	  $this->db->join('nkr_form nf3', 'nf3.barcode_form=nfd3.barcode_form','left');
	  $this->db->join('nkr_indikator nin', 'nin.id_indikator=nfd3.id_indikator','left');
	  $this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nin.id_asesmen','left');
	  $this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
	  $this->db->join('nkr_kompetensi kp', 'kp.id_kompetensi=nf3.id_kompetensi','left');
	  $this->db->join('jabatan j', 'j.id_jabatan=kp.id_jabatan','left');
	  $this->db->join('kol_working kw', 'kw.id_working=nf3.id_instansi','left');
	  $ids = explode(',', $id);
	  $this->db->where_in('nf3.id_kompetensi', $ids);
	  $this->db->where('nin.poin_indikator !="" ', NULL, FALSE);
	  $this->db->order_by('nfd3.id_indikator', 'ASC');
	  $q = $this->db->get_where('nkr_form_detil nfd3',array('nf3.id_instansi'=>$ins));
	//  echo $this->db->last_query();die();
	  return $q->result_array();
	}
	function ambil_nkr_grup_indikator($id,$grup,$field,$asc){
	  $this->db->join('nkr_form nf2', 'nf2.barcode_form=nfd2.barcode_form','left');
	  $this->db->join('nkr_indikator nq2', 'nq2.id_indikator=nfd2.id_indikator','left');
	  $this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nq2.id_asesmen','left');
	  $this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
	  $this->db->group_by($grup);
	  $this->db->order_by($field,$asc);
	  $q = $this->db->get_where('nkr_form_detil nfd2',array('nf2.barcode_form'=>$id));
	  return $q->result_array();
	}
	function ambil_nkr_grup_indikator_validasi($id,$grup,$field,$asc){
	//  $this->db->join('nkr_indikator_validasi nin', 'nin.id_indikator=nfd3.id_indikator','left');
	  $this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nfd3.id_asesmen','left');
	  $this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
	  $this->db->group_by($grup);
	  $this->db->order_by($field,$asc);
	  $q = $this->db->get_where('nkr_validasi_detil nfd3',array('nfd3.barcode_pengajuan_validasi'=>$id));
	  return $q->result_array();
	}
	function ambil_nkr_grup_pra_asesmen($id,$grup,$field,$asc){
	  $this->db->join('nkr_form nf2', 'nf2.barcode_form=nfd2.barcode_form','left');
	  $this->db->join('nkr_pra_detil npd', 'npd.id_pra_detil=nfd2.id_pra_detil','left');
	  $this->db->join('nkr_pra_asesmen npa', 'npa.barcode_pra_asesmen=npd.barcode_pra_asesmen','left');
	  $this->db->group_by($grup);
	  $this->db->order_by($field,$asc);
	  $q = $this->db->get_where('nkr_form_detil nfd2',array('nf2.barcode_form'=>$id));
	  return $q->result_array();
	}
	function ambil_nkr_grup_kaji_ulang($id,$grup,$field,$asc){
	  $this->db->join('nkr_form nf2', 'nf2.barcode_form=nfd2.barcode_form','left');
	  $this->db->join('nkr_kaji_ulang npd', 'npd.id_kaji_ulang=nfd2.id_kaji_ulang','left');
	  $this->db->join('nkr_kat_kaji npa', 'npa.id_kat_kaji=npd.id_kat_kaji','left');
	  $this->db->group_by($grup);
	  $this->db->order_by($field,$asc);
	  $q = $this->db->get_where('nkr_form_detil nfd2',array('nf2.barcode_form'=>$id));
	  return $q->result_array();
	}
	function ambil_nkr_grup_kaji_ulang_modal($kondisi,$grup,$field,$asc){
	  $this->db->join('nkr_form nf2', 'nf2.barcode_form=nfd2.barcode_form','left');
	  $this->db->join('nkr_kaji_ulang npd', 'npd.id_kaji_ulang=nfd2.id_kaji_ulang','left');
	  $this->db->join('nkr_kat_kaji npa', 'npa.id_kat_kaji=npd.id_kat_kaji','left');
	  $this->db->group_by($grup);
	  $this->db->order_by($field,$asc);
	  $q = $this->db->get_where('nkr_form_detil nfd2',$kondisi);
	  return $q->result_array();
	}
	function ambil_kaji_ulang_nkr_form_detil($id,$ide){
	  $this->db->join('nkr_form nf3', 'nf3.barcode_form=nfd3.barcode_form','left');
	  $this->db->join('nkr_kaji_ulang nin', 'nin.id_kaji_ulang=nfd3.id_kaji_ulang','left');
	  $this->db->join('nkr_kat_kaji nas', 'nas.id_kat_kaji=nin.id_kat_kaji','left');
	  $this->db->order_by('nin.id_kat_kaji','ASC');
	  $q = $this->db->get_where('nkr_form_detil nfd3',array('nfd3.barcode_form'=>$id,'nin.id_kat_kaji'=>$ide));
	  return $q->result_array();
	}
	function ambil_nkr_no_grup_kaji_ulang($id,$field,$asc){
	  $this->db->join('nkr_form nf2', 'nf2.barcode_form=nfd2.barcode_form','left');
	  $this->db->join('nkr_kaji_ulang npd', 'npd.id_kaji_ulang=nfd2.id_kaji_ulang','left');
	//  $this->db->join('nkr_kat_kaji npa', 'npa.id_kat_kaji=npd.id_kat_kaji','left');
	  $this->db->order_by($field,$asc);
	  $q = $this->db->get_where('nkr_form_detil nfd2',array('nf2.barcode_form'=>$id));
	  return $q->result_array();
	}
	function ambil_kaji_ulang_nkr_form_validasi_detil($id,$ide){
	//  $this->db->join('nkr_pengajuan_validasi nf3', 'nf3.barcode_form=nfd3.barcode_form','left');
	//  $this->db->join('nkr_kaji_ulang nin', 'nin.id_kaji_ulang=nfd3.id_kaji_ulang','left');
	  $this->db->join('nkr_kat_kaji nas', 'nas.id_kat_kaji=nfd3.id_kat_kaji','left');
	  $this->db->order_by('nfd3.id_kat_kaji','ASC');
	  $q = $this->db->get_where('nkr_validasi_detil nfd3',array('nfd3.barcode_pengajuan_validasi'=>$id,'nfd3.id_kat_kaji'=>$ide));
	  return $q->result_array();
	}
	function ambil_val_nkr_pra_detil($id,$idp){
	  $this->db->join('nkr_form nf2', 'nf2.barcode_form=nfd2.barcode_form','left');
	  $this->db->join('nkr_pra_detil npd', 'npd.id_pra_detil=nfd2.id_pra_detil','left');
	  $this->db->order_by('no_urut_detil','ASC');
	  $q = $this->db->get_where('nkr_form_detil nfd2',array('nf2.barcode_form'=>$id,'npd.barcode_pra_asesmen'=>$idp));
	  return $q->result_array();
	}
	function ambil_nkr_grup_question($id,$grup,$field,$asc){
	  $this->db->join('nkr_form nf2', 'nf2.barcode_form=nfd2.barcode_form','left');
	  $this->db->join('nkr_question_f2 nq2', 'nq2.id_question=nfd2.id_question','left');
	  $this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nq2.id_asesmen','left');
	  $this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
	  $this->db->group_by($grup);
	  $this->db->order_by($field,$asc);
	  $q = $this->db->get_where('nkr_form_detil nfd2',array('nf2.barcode_form'=>$id));
	  return $q->result_array();
	}
	function ambil_asesmen_nkr_question_form_detil($id,$ide){
	  $this->db->join('nkr_form nf3', 'nf3.barcode_form=nfd3.barcode_form','left');
	  $this->db->join('nkr_question_f2 nin', 'nin.id_question=nfd3.id_question','left');
	  $this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nin.id_asesmen','left');
	  $this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
	  $this->db->group_by('nin.id_asesmen');
	  $this->db->order_by('nas.id_elemen','ASC');
	  $q = $this->db->get_where('nkr_form_detil nfd3',array('nfd3.barcode_form'=>$id,'nas.id_elemen'=>$ide));
	  return $q->result_array();
	}
	function ambil_question_nkr_form_detil($id,$ide){
	  $this->db->join('nkr_form nf3', 'nf3.barcode_form=nfd3.barcode_form','left');
	  $this->db->join('nkr_question_f2 nin', 'nin.id_question=nfd3.id_question','left');
	  $this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nin.id_asesmen','left');
	  $this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
	  $this->db->order_by('nin.id_asesmen','ASC');
	  $q = $this->db->get_where('nkr_form_detil nfd3',array('nfd3.barcode_form'=>$id,'nin.id_asesmen'=>$ide));
	  return $q->result_array();
	}
	function ambil_indikator_nkr_form_detil($id,$ide){
	  $this->db->join('nkr_form nf3', 'nf3.barcode_form=nfd3.barcode_form','left');
	  $this->db->join('nkr_indikator nin', 'nin.id_indikator=nfd3.id_indikator','left');
	  $this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nin.id_asesmen','left');
	  $this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
	  $this->db->order_by('no_urut_detil','ASC');
	  $q = $this->db->get_where('nkr_form_detil nfd3',array('nfd3.barcode_form'=>$id,'nin.id_asesmen'=>$ide));
	  return $q->result_array();
	}
	function ambil_indikator_nkr_form_validasi_detil($id,$ide){
	//  $this->db->join('nkr_pengajuan_validasi nf3', 'nf3.barcode_form=nfd3.barcode_form','left');
	//  $this->db->join('nkr_indikator_validasi nin', 'nin.id_indikator=nfd3.id_indikator','left');
	  $this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nfd3.id_asesmen','left');
	  $this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
	  $this->db->order_by('no_urut_detil','ASC');
	  $q = $this->db->get_where('nkr_validasi_detil nfd3',array('nfd3.barcode_pengajuan_validasi'=>$id,'nfd3.id_asesmen'=>$ide));
	  return $q->result_array();
	}
	function ambil_asesmen_nkr_form_detil($id,$ide){
	  $this->db->join('nkr_form nf3', 'nf3.barcode_form=nfd3.barcode_form','left');
	  $this->db->join('nkr_indikator nin', 'nin.id_indikator=nfd3.id_indikator','left');
	  $this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nin.id_asesmen','left');
	  $this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
	  $this->db->group_by('nin.id_asesmen');
	  $this->db->order_by('no_urut_detil','ASC');
	  $q = $this->db->get_where('nkr_form_detil nfd3',array('nfd3.barcode_form'=>$id,'nas.id_elemen'=>$ide));
	  return $q->result_array();
	}
	function ambil_asesmen_nkr_elemen_validasi($id,$ide){
	//  $this->db->join('nkr_form nf3', 'nf3.barcode_form=nfd3.barcode_form','left');
	//  $this->db->join('nkr_indikator_validasi nin', 'nin.id_indikator=nfd3.id_indikator','left');
	  $this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nfd3.id_asesmen','left');
	  $this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
	  $this->db->group_by('nfd3.id_asesmen');
	  $this->db->order_by('no_urut_detil','ASC');
	  $q = $this->db->get_where('nkr_validasi_detil nfd3',array('nfd3.barcode_pengajuan_validasi'=>$id,'nas.id_elemen'=>$ide));
	  return $q->result_array();
	}
	function ambil_nkr_form_detil_grup($id){
//	  $this->db->join('nkr_form nf2', 'nf2.barcode_form=nfd2.barcode_form','left');
	  $this->db->join('nkr_question_f2 nq2', 'nq2.id_question=nfd2.id_question','left');
	  $this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nq2.id_asesmen','left');
	  $this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
	  $this->db->join('nkr_kompetensi kp', 'kp.id_kompetensi=nf2.id_kompetensi','left');
	  $this->db->join('jabatan j', 'j.id_jabatan=kp.id_jabatan','left');
	  $this->db->join('kol_working kw', 'kw.id_working=nf2.id_instansi','left');
	//  $ids = explode(',', $id);
	//  $this->db->where_in('nf2.id_kompetensi', $ids);
	  $this->db->group_by('nas.id_elemen');
	  $q = $this->db->get_where('nkr_form_detil nfd2',array('nf2.barcode_form'=>$id));
	  return $q->result_array();
	}
	function ambil_nkr_validasi_question_detil($id){
	  $this->db->join('nkr_pengajuan_validasi npv', 'npv.barcode_pengajuan_validasi=nvd.barcode_pengajuan_validasi','left');
	//  $this->db->join('nkr_question_validasi nq2', 'nq2.id_question=nvd.id_question','left');
	  $this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nvd.id_asesmen','left');
	  $this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
	  $this->db->order_by('nvd.no_urut_detil', 'asc');
	  $q = $this->db->get_where('nkr_validasi_detil nvd',array('nvd.barcode_pengajuan_validasi'=>$id,'status_validasi_detil'=>1));
	  return $q->result_array();
	}
	function ambil_nkr_validasi_indikator_detil($id,$grup=FALSE){
	  $this->db->join('nkr_pengajuan_validasi npv', 'npv.barcode_pengajuan_validasi=nvd.barcode_pengajuan_validasi','left');
//	  $this->db->join('nkr_indikator_validasi nq2', 'nq2.id_indikator=nvd.id_indikator','left');
	  $this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nvd.id_asesmen','left');
	  $this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
   if($grup){
    $this->db->group_by($grup);
   }
	  $this->db->order_by('no_urut_detil', 'ASC');
	  $q = $this->db->get_where('nkr_validasi_detil nvd',array('nvd.barcode_pengajuan_validasi'=>$id));
	  return $q->result_array();
	}
 function ambil_nkr_validasi_indikator_detil_select($id,$kondisi){
  $this->db->join('nkr_pengajuan_validasi npv', 'npv.barcode_pengajuan_validasi=nvd.barcode_pengajuan_validasi','left');
//   $this->db->join('nkr_indikator_validasi nq2', 'nq2.id_indikator=nvd.id_indikator','left');
  $this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nvd.id_asesmen','left');
  $this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
  $this->db->where($kondisi);
  $this->db->order_by('no_urut_detil', 'ASC');
  $q = $this->db->get_where('nkr_validasi_detil nvd',array('nvd.barcode_pengajuan_validasi'=>$id));
  return $q->result_array();
 }
	function ambil_validasi_grup_form7($id,$grup,$field,$asc){
	  $this->db->join('nkr_pengajuan_validasi npv', 'npv.barcode_pengajuan_validasi=nvd.barcode_pengajuan_validasi','left');
	//  $this->db->join('nkr_indikator nq2', 'nq2.id_indikator=nvd.id_indikator','left');
	  $this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nvd.id_asesmen','left');
	  $this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
	  $array_check = array(4,5,6,7);
	  $this->db->where_in('npv.id_jenis_form', $array_check);
	  $this->db->group_by($grup);
	  $this->db->order_by($field,$asc);
	  $q = $this->db->get_where('nkr_validasi_detil nvd',array('npv.barcode_pengajuan'=>$id));
	  return $q->result_array();
	}
	function ambil_validasi_detil_grup_form7($id,$grup,$field,$asc,$fieldwh,$idwh){
	  $this->db->join('nkr_pengajuan_validasi npv', 'npv.barcode_pengajuan_validasi=nvd.barcode_pengajuan_validasi','left');
	//  $this->db->join('nkr_form nf', 'nf.barcode_form=npv.barcode_form','left');
	  $this->db->join('nkr_indikator nq2', 'nq2.id_indikator=nvd.id_indikator','left');
	  $this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nq2.id_asesmen','left');
	  $this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
	  $array_check = array(4,5,6,7);
	  $this->db->where_in('npv.id_jenis_form', $array_check);
	  $this->db->where($fieldwh, $idwh);
	  $this->db->group_by($grup);
	  $this->db->order_by($field,$asc);
	  $q = $this->db->get_where('nkr_validasi_detil nvd',array('npv.barcode_pengajuan'=>$id));
	  return $q->result_array();
	}
	function ambil_validasi_detil_grup_nobarfor_form7($kondisi,$grup,$field,$asc,$fieldwh,$idwh){
	  $this->db->join('nkr_pengajuan_validasi npv', 'npv.barcode_pengajuan_validasi=nvd.barcode_pengajuan_validasi','left');
	//  $this->db->join('nkr_form nf', 'nf.barcode_form=npv.barcode_form','left');
	  $this->db->join('nkr_indikator nq2', 'nq2.id_indikator=nvd.id_indikator','left');
	  $this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nq2.id_asesmen','left');
	  $this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
	  $array_check = array(4,5,6,7);
	  $this->db->where_in('npv.id_jenis_form', $array_check);
	  $this->db->where($fieldwh, $idwh);
	  $this->db->group_by($grup);
	  $this->db->order_by($field,$asc);
	  $q = $this->db->get_where('nkr_validasi_detil nvd',$kondisi);
	  return $q->result_array();
	}
	function ambil_validasi_grup_pra_asesmen($id,$grup,$field,$asc){
	  $this->db->join('nkr_pengajuan_validasi npv', 'npv.barcode_pengajuan_validasi=nvd.barcode_pengajuan_validasi','left');
	//  $this->db->join('nkr_pra_detil npd', 'npd.id_pra_detil=nvd.id_pra_detil','left');
	  $this->db->join('nkr_pra_asesmen npa', 'npa.barcode_pra_asesmen=nvd.barcode_pra_asesmen','left');
	  $this->db->group_by($grup);
	  $this->db->order_by($field,$asc);
	  $q = $this->db->get_where('nkr_validasi_detil nvd',array('nvd.barcode_pengajuan_validasi'=>$id));
	  return $q->result_array();
	}
	function ambil_validasi_kaji_pra_detil($id,$field,$asc){
	  $this->db->join('nkr_pengajuan_validasi npv', 'npv.barcode_pengajuan_validasi=nvd.barcode_pengajuan_validasi','left');
	  $this->db->join('nkr_kat_kaji npd', 'npd.id_kat_kaji=nvd.id_kat_kaji','left');
	//  $this->db->join('nkr_kaji_ulang npd', 'npd.id_kaji_ulang=nvd.id_kaji_ulang','left');
	//  $this->db->join('nkr_pra_asesmen npa', 'npa.barcode_pra_asesmen=npd.barcode_pra_asesmen','left');
	//  $this->db->group_by($grup);
	  $this->db->order_by($field,$asc);
	  $q = $this->db->get_where('nkr_validasi_detil nvd',array('nvd.barcode_pengajuan_validasi'=>$id));
	  return $q->result_array();
	}
	function ambil_validasi_grup_kaji_pra_detil($id,$grup,$field,$asc){
	  $this->db->join('nkr_pengajuan_validasi npv', 'npv.barcode_pengajuan_validasi=nvd.barcode_pengajuan_validasi','left');
	  $this->db->join('nkr_kat_kaji npd', 'npd.id_kat_kaji=nvd.id_kat_kaji','left');
	//  $this->db->join('nkr_kaji_ulang npd', 'npd.id_kaji_ulang=nvd.id_kaji_ulang','left');
	//  $this->db->join('nkr_pra_asesmen npa', 'npa.barcode_pra_asesmen=npd.barcode_pra_asesmen','left');
	  $this->db->group_by($grup);
	  $this->db->order_by($field,$asc);
	  $q = $this->db->get_where('nkr_validasi_detil nvd',array('nvd.barcode_pengajuan_validasi'=>$id));
	  return $q->result_array();
	}
	function ambil_validasi_nkr_pra_detil($id,$idp){
	  $this->db->join('nkr_pra_detil npd', 'npd.id_pra_detil=nvd.id_pra_detil','left');
	  $this->db->order_by('no_urut_detil','ASC');
	  $q = $this->db->get_where('nkr_validasi_detil nvd',array('nvd.barcode_pengajuan_validasi'=>$id,'npd.barcode_pra_asesmen'=>$idp));
	  return $q->result_array();
	}
	function ambil_nkr_alat_bahan($idk,$ide,$idi){
	  $q = $this->db->get_where('nkr_alat_bahan nab',array('id_kompetensi'=>$idk,'id_elemen'=>$ide,'id_instansi'=>$idi));
	  return $q->row_array();
	}
	function jumlah_nkr_form3_detil($id,$ida,$idb){
	  $this->db->select('COUNT(*) as num');
	  $this->db->join('nkr_form3 nf3', 'nf3.barcode_form3=nfd3.barcode_form3','left');
	  $this->db->join('nkr_indikator nin', 'nin.id_indikator=nfd3.id_indikator','left');
	  $this->db->join('nkr_asesmen nas', 'nas.id_asesmen=nin.id_asesmen','left');
	  $this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
	//  $this->db->group_by($grup);
	  $query = $this->db->get_where('nkr_form3_detil nfd3',array('nf3.id_form3'=>$id,$ida=>$idb));
	    $result = $query->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
	}
	function cmd_elemen(){
		$this->db->select("id_elemen, nama_elemen");
		$this->db->order_by('id_elemen','desc');
		$q= $this->db->get_where('nkr_elemen')->result_array();
		$hasil= array_column($q,'nama_elemen','id_elemen');
		return $hasil;
	}
	function cmd_asesmen(){
		$this->db->select("id_asesmen, concat(nama_asesmen,' <b>[',nama_elemen,']</b> ',nama_jabatan) as nama_asesmen");
		$this->db->join('nkr_elemen nel', 'nel.id_elemen=nas.id_elemen','left');
		$this->db->join('jabatan j', 'j.id_jabatan=nas.id_jabatan','left');
		$this->db->order_by('nas.id_asesmen','desc');
		$q= $this->db->get_where('nkr_asesmen nas')->result_array();
		$hasil= array_column($q,'nama_asesmen','id_asesmen');
		return $hasil;
	}
	function ambil_nkr_alat(){
	  $q = $this->db->get_where('nkr_alat nal');
	  return $q->result_array();
	}
	function cmd_pra_asesmen(){
		$this->db->select("barcode_pra_asesmen, nama_pra_asesmen");
		$q= $this->db->get_where('nkr_pra_asesmen')->result_array();
		$hasil= array_column($q,'nama_pra_asesmen','barcode_pra_asesmen');
		return $hasil;
	}
	function cmd_form($array_check){
		$this->db->select("id_jenis_form, nama_jenis_form");
	//	$array_check = array(0,6);
	  	$this->db->where_in('id_jenis_form', $array_check);
		$q= $this->db->get_where('kol_jenis_form')->result_array();
		$hasil= array_column($q,'nama_jenis_form','id_jenis_form');
		return $hasil;
	}
	function ambil_nkr_kaji_ulang($id){
		$this->db->select("*,if(nku.id_kat_kaji = 0,'-',nama_kat_kaji) as nama_kat_kaji");
		$this->db->join('nkr_kat_kaji nkk', 'nkk.id_kat_kaji=nku.id_kat_kaji','left');
	  $q = $this->db->get_where('nkr_kaji_ulang nku',array('nku.id_jenis_form'=>$id));
	  return $q->result_array();
	}
}