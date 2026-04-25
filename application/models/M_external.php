<?php
class M_external extends CI_model{
	function ambil_lhu_logbook($id,$select,$kondisi,$grup=FALSE)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
		$idl = explode(',', $lpd['kompetensi']);
		$idlb = explode(',', $lpd['isi_kompetensi']);
		$this->db->select($select);
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
		$this->db->where('ol.tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where("ol.id_instansi",$lpd['id_instansi']);
		$this->db->where("ol.jml_logbook >",0);
		if(!empty($lpd['kompetensi'])){
			$this->db->where_in("nkk.id_kompetensi",$idl);
		}
		if(!empty($lpd['isi_kompetensi'])){
			$idlb = explode(',', $lpd['isi_kompetensi']);
			$this->db->where_in("ol.id_logbook",$idlb);
		}
		if($grup){
			$this->db->group_by($grup);			
		}
		$q = $this->db->get_where('ol_logbook ol',$kondisi)->result_array();	
	//	$q = $this->db->get_where('ol_logbook ol',array('ol.id_logbooker'=>$lpd['id_pegawai']))->result_array();	
	//	}echo $this->db->last_query();
		return $q;
    }
	function ambil_lhu_pasien($id,$select,$kondisi,$grup=FALSE)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
		$idl = explode(',', $lpd['kompetensi']);
		$idc = explode(',', $lpd['bahan']);
		$ids = explode(',', $lpd['reject']);
	//	$this->db->select('*,SUM('.$jml.') as '.$jml);
		$this->db->select($select);
		$this->db->join('ol_logbook ol', 'ol.id_logbook=olp.id_logbook','left');
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
		$this->db->join('kol_reject krj', 'krj.id_reject=olp.id_reject','left');
		$this->db->join('ol_bahan obh', 'obh.id_bahan=olp.id_bahan','left');
		$this->db->where('ol.tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where("ol.id_instansi",$lpd['id_instansi']);
	//	$this->db->where($jml.' >',0);
	//	$this->db->where("(olp.jml_bahan > 0 OR olp.jml_reject > 0)", NULL, FALSE);
		if(!empty($lpd['kompetensi'])){
			$this->db->where_in("nkk.id_kompetensi",$idl);
		}
		if(!empty($lpd['bahan'])){
			$this->db->where_in("olp.id_bahan",$idc);
		}
		if(!empty($lpd['reject'])){
			$this->db->where_in("olp.id_reject",$ids);
		}
		if(!empty($lpd['isi_kompetensi'])){
			$idlb = explode(',', $lpd['isi_kompetensi']);
			$this->db->where_in("ol.id_logbook",$idlb);
		}
		$this->db->group_by($grup);
	//	$q = $this->db->get_where('ol_logbook_pasien olp',array('ol.id_logbooker'=>$lpd['id_pegawai']))->result_array();				
		$q = $this->db->get_where('ol_logbook_pasien olp',$kondisi)->result_array();				
		return $q;
    }
	function ambil_lhu_pakai($id,$select,$kondisi,$grup=FALSE)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
		$idl = explode(',', $lpd['kompetensi']);
		$idc = explode(',', $lpd['bahan']);
		$ids = explode(',', $lpd['reject']);
	//	$this->db->select('*,SUM('.$jml.') as '.$jml);
		$this->db->select($select);
		$this->db->join('ol_logbook_pasien olp', 'olp.id_logbook_pasien=olpk.id_logbook_pasien','left');
		$this->db->join('ol_logbook ol', 'ol.id_logbook=olp.id_logbook','left');
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
	//	$this->db->join('kol_reject krj', 'krj.id_reject=olp.id_reject','left');
		$this->db->join('ol_bahan obh', 'obh.id_bahan=olpk.id_bahan','left');
		$this->db->where('ol.tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where("ol.id_instansi",$lpd['id_instansi']);
	//	$this->db->where($jml.' >',0);
	//	$this->db->where("(olp.jml_bahan > 0 OR olp.jml_reject > 0)", NULL, FALSE);
		if(!empty($lpd['kompetensi'])){
			$this->db->where_in("nkk.id_kompetensi",$idl);
		}
		if(!empty($lpd['bahan'])){
			$this->db->where_in("olpk.id_bahan",$idc);
		}
/*		if(!empty($lpd['reject'])){
			$this->db->where_in("olp.id_reject",$ids);
		}*/
		if(!empty($lpd['isi_kompetensi'])){
			$idlb = explode(',', $lpd['isi_kompetensi']);
			$this->db->where_in("ol.id_logbook",$idlb);
		}
		$this->db->group_by($grup);
	//	$q = $this->db->get_where('ol_logbook_pasien olp',array('ol.id_logbooker'=>$lpd['id_pegawai']))->result_array();				
		$q = $this->db->get_where('ol_logbook_pakai olpk',$kondisi)->result_array();				
		return $q;
    }
	function ambil_lhu_reject($id,$select,$kondisi,$grup=FALSE)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id);
		$idl = explode(',', $lpd['kompetensi']);
		$idc = explode(',', $lpd['bahan']);
		$ids = explode(',', $lpd['reject']);
	//	$this->db->select('*,SUM('.$jml.') as '.$jml);
		$this->db->select($select);
		$this->db->join('ol_logbook_pasien olp', 'olp.id_logbook_pasien=olpk.id_logbook_pasien','left');
		$this->db->join('ol_logbook ol', 'ol.id_logbook=olp.id_logbook','left');
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
		$this->db->join('kol_reject krj', 'krj.id_reject=olpk.id_reject','left');
		$this->db->join('ol_bahan obh', 'obh.id_bahan=olpk.id_bahan','left');
		$this->db->where('ol.tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where("ol.id_instansi",$lpd['id_instansi']);
	//	$this->db->where($jml.' >',0);
	//	$this->db->where("(olp.jml_bahan > 0 OR olp.jml_reject > 0)", NULL, FALSE);
		if(!empty($lpd['kompetensi'])){
			$this->db->where_in("nkk.id_kompetensi",$idl);
		}
/*		if(!empty($lpd['bahan'])){
			$this->db->where_in("olpk.id_bahan",$idc);
		}*/
		if(!empty($lpd['reject'])){
			$this->db->where_in("olpk.id_reject",$ids);
		}
		if(!empty($lpd['isi_kompetensi'])){
			$idlb = explode(',', $lpd['isi_kompetensi']);
			$this->db->where_in("ol.id_logbook",$idlb);
		}
		$this->db->group_by($grup);
	//	$q = $this->db->get_where('ol_logbook_pasien olp',array('ol.id_logbooker'=>$lpd['id_pegawai']))->result_array();				
		$q = $this->db->get_where('ol_logbook_reject olpk',$kondisi)->result_array();				
		return $q;
    }
	function ambil_universal_lhu($id,$select,$kondisi,$grup=FALSE)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id); //id_laporan_tabel
		$this->db->select($select);
		$this->db->join('ol_logbook_lhu oll', 'oll.id_lhu=olp.id_lhu','left');
		$this->db->join('ol_logbook_item_lhu olil', 'olil.id_item_lhu=olp.id_item_lhu','left');
		$this->db->join('ol_equipment oe', 'oe.id_equipment=olil.id_equipment','left');
		$this->db->where('oll.tgl_lhu BETWEEN "'. $lpd['tgl_awal']. '" and "'. $lpd['tgl_akhir'].'"');
		if(!empty($lpd['i_mutu'])){
			$idlh = explode(',', $lpd['i_mutu']);
			$this->db->where_in("olp.id_lhu_detil",$idlh); // nama_lhu - tgl_lhu
		}
		if(!empty($lpd['item_lhu'])){
			$idilhu = explode(',', $lpd['item_lhu']);
			$this->db->where_in("olil.id_item_lhu",$idilhu); // nama_item_lhu
		}
/*		if(!empty($lpd['id_lhu'])){
			$idlb = explode(',', $lpd['id_lhu']);
			$this->db->where_in("olil.id_equipment",$idlb); //nama_equipment
		}*/
		if($grup){
			$this->db->group_by($grup);
		}
		$this->db->order_by('olil.id_equipment','asc');
		$q = $this->db->get_where('ol_logbook_lhu_detil olp',$kondisi)->result_array();
//	echo $this->db->last_query();die();
	//print_r($q);die();
		return $q;
    }
	function ambil_daftar_tindakan_lhu($id,$select,$kondisi,$grup=FALSE)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id); //id_laporan_tabel
		$this->db->select($select);
		$this->db->join('tindakan t', 't.id_tindakan=td.id_tindakan','left');
		$this->db->join('kol_golongan_pemeriksaan kgp', 'kgp.id_golongan_pemeriksaan=t.id_golongan_pemeriksaan','left');
		$this->db->join('ol_unit ou', 'ou.id_unit=td.unit_pengirim','left');
		$this->db->join('ol_unit ou2', 'ou2.id_unit=td.unit_tindakan','left');
		$this->db->join('kol_rujukan_dokter krj', 'krj.id_rujukan_dokter=td.dr_tindakan','left');
		$this->db->join('kol_rujukan_dokter krj2', 'krj2.id_rujukan_dokter=td.dr_pengirim','left');
		$this->db->join('kol_working kw', 'kw.id_working=ou.id_instansi','left');
		$this->db->join('ol_pasien px', 'px.id_pasien=td.id_pasien','left');
		$this->db->where('tgl_daftar BETWEEN "'. $lpd['tgl_awal']. '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where("ou.id_instansi",$lpd['id_instansi']);
		if(!empty($lpd['tindakan'])){
			$idlh = explode(',', $lpd['tindakan']);
			$this->db->where_in("td.id_tindakan",$idlh); // nama_lhu - tgl_lhu
		}
		if($grup){
			$this->db->group_by($grup);
		}
		$this->db->order_by('t.id_golongan_pemeriksaan','asc');
		$q = $this->db->get_where('tindakan_daftar td',$kondisi)->result_array();
//	echo $this->db->last_query();die();
	//print_r($q);die();
		return $q;
    }
	function grafik_pie_opsi_logbook($id,$grup=FALSE)
	{
		$lpd = $this->m_ol_rancak->ambil_surveyor_logbook_laporan_tabel($id);
		$this->db->select("nkk.id_kompetensi  as id_lhu,jml_logbook as hasil_lhu_detil,SUM(jml_logbook) as total,
				DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_lhu,nama_kewenangan as nama_lhu,
				DATE_FORMAT(tgl_logbook,'%Y') as thn,
				DATE_FORMAT(tgl_logbook,'%m') as bln,
				DATE_FORMAT(tgl_logbook,'%d') as hr
			");
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
		if($lpd['kompetensi'] == "" OR empty($lpd['kompetensi'])){
			$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		}else{
			$idx = explode(',', $lpd['kompetensi']);
			$this->db->where_in("nkk.id_kompetensi",$idx);
			$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		}
		if($lpd['kewenangan'] == "0" OR empty($lpd['kewenangan'])){
			$this->db->group_by('nkk.id_kewenangan');
		}else{
			if($lpd['kewenangan'] == 1){
				$this->db->group_by('nkk.id_kewenangan');
			}else{
				$this->db->group_by('nkk.id_kompetensi');
			}
		}
		$this->db->where('ol.jml_logbook >',0);
		$this->db->where('ol.id_instansi',$lpd['id_working']);
		$q = $this->db->get_where('ol_logbook ol')->result_array();
		return $q;
    }
	function grafik_pie_opsi_pasien($id,$bhn,$jml,$nama,$grup=FALSE)
	{
		$lpd = $this->m_ol_rancak->ambil_surveyor_logbook_laporan_tabel($id);
		$this->db->select("olp.".$bhn."  as id_lhu,".$jml." as hasil_lhu_detil,SUM(".$jml.") as total,
				DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_lhu,".$nama." as nama_lhu,
				DATE_FORMAT(tgl_logbook,'%Y') as thn,
				DATE_FORMAT(tgl_logbook,'%m') as bln,
				DATE_FORMAT(tgl_logbook,'%d') as hr
			");
		$this->db->join('ol_logbook ol', 'ol.id_logbook=olp.id_logbook','left');
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
/*		$this->db->join('kol_reject krj', 'krj.id_reject=olp.id_reject','left');
		$this->db->join('ol_bahan obh', 'obh.id_bahan=olp.id_bahan','left');*/
		if($lpd['kompetensi'] == "" OR empty($lpd['kompetensi'])){
			$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		}else{
			$idx = explode(',', $lpd['kompetensi']);
			$this->db->where_in("nkk.id_kompetensi",$idx);
			$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		}
		$this->db->where($jml.' >',0);
		$this->db->where('ol.id_instansi',$lpd['id_working']);
		if($grup){
			$this->db->group_by('olp.'.$grup);
		}
		$q = $this->db->get_where('ol_logbook_pasien olp')->result_array();
		return $q;
    }
	function grafik_pie_opsi_lhu($id,$grup=FALSE)
	{
		$lpd = $this->m_ol_rancak->ambil_surveyor_logbook_laporan_tabel($id);
		$this->db->select("olp.id_lhu as id_lhu,SUM(hasil_lhu_detil) as total,
				DATE_FORMAT(tgl_lhu,'%d-%m-%Y') as tgl_lhu,hasil_lhu_detil,
				DATE_FORMAT(tgl_lhu,'%Y') as thn,
				DATE_FORMAT(tgl_lhu,'%m') as bln,
				DATE_FORMAT(tgl_lhu,'%d') as hr
			");
		$this->db->join('ol_logbook_lhu ol', 'ol.id_lhu=olp.id_lhu','left');
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where('hasil_lhu_detil >',0);
		if($grup){
			$this->db->group_by('olp.'.$grup);
		}
		$q = $this->db->get_where('ol_logbook_lhu_detil olp')->result_array();
		return $q;
    }
	function grafik_garis_opsi_logbook($id,$grup=FALSE)
	{
		$lpd = $this->m_ol_rancak->ambil_surveyor_logbook_laporan_tabel($id);
				$this->db->select("nkk.id_kompetensi  as id_lhu,jml_logbook as hasil_lhu_detil,
							DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_lhu,nama_kompetensi as nama_lhu,
							DATE_FORMAT(tgl_logbook,'%Y') as thn,
							DATE_FORMAT(tgl_logbook,'%m') as bln,
							DATE_FORMAT(tgl_logbook,'%d') as hr
						");
		if(empty($lpd['kewenangan'])){

		}else{
			if($lpd['kewenangan'] == 1){
				$this->db->select("ol.id_kewenangan  as id_lhu,jml_logbook as hasil_lhu_detil,
						DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_lhu,nama_kewenangan as nama_lhu,
						DATE_FORMAT(tgl_logbook,'%Y') as thn,
						DATE_FORMAT(tgl_logbook,'%m') as bln,
						DATE_FORMAT(tgl_logbook,'%d') as hr
					");
			}else{
				$this->db->select("nkk.id_kompetensi  as id_lhu,jml_logbook as hasil_lhu_detil,
							DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_lhu,nama_kompetensi as nama_lhu,
							DATE_FORMAT(tgl_logbook,'%Y') as thn,
							DATE_FORMAT(tgl_logbook,'%m') as bln,
							DATE_FORMAT(tgl_logbook,'%d') as hr
						");
			}			
		}

		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
		if($lpd['kompetensi'] == "" OR empty($lpd['kompetensi'])){
			$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		}else{
			$idx = explode(',', $lpd['kompetensi']);
			$this->db->where_in("nkk.id_kompetensi",$idx);
			$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		}
		$this->db->where('ol.jml_logbook >',0);
		$this->db->where('ol.id_instansi',$lpd['id_working']);
		if(empty($lpd['kewenangan'])){
			$this->db->group_by('nkk.id_kompetensi');
		}else{
			if($lpd['kewenangan'] == 1){
				$this->db->group_by('nkk.id_kewenangan');
			}else{
				$this->db->group_by('nkk.id_kompetensi');
			}			
		}
		$q = $this->db->get_where('ol_logbook ol')->result_array();
	//	echo $this->db->last_query();
	//	print_r($q);die();
		return $q;
    }
	function grafik_garis_opsi_pasien($id,$bhn,$jml,$nama,$grup=FALSE)
	{
		$lpd = $this->m_ol_rancak->ambil_surveyor_logbook_laporan_tabel($id);
		$this->db->select("olp.".$bhn."  as id_lhu,".$jml." as hasil_lhu_detil,
				DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_lhu,".$nama." as nama_lhu,
				DATE_FORMAT(tgl_logbook,'%Y') as thn,
				DATE_FORMAT(tgl_logbook,'%m') as bln,
				DATE_FORMAT(tgl_logbook,'%d') as hr
			");
		$this->db->join('ol_logbook ol', 'ol.id_logbook=olp.id_logbook','left');
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
/*		$this->db->join('kol_reject krj', 'krj.id_reject=olp.id_reject','left');
		$this->db->join('ol_bahan obh', 'obh.id_bahan=olp.id_bahan','left');*/
		if($lpd['kompetensi'] == "" OR empty($lpd['kompetensi'])){
			$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		}else{
			$idx = explode(',', $lpd['kompetensi']);
			$this->db->where_in("nkk.id_kompetensi",$idx);
			$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		}
		$this->db->where($jml.' >',0);
		$this->db->where('ol.id_instansi',$lpd['id_working']);
		if($grup){
			$this->db->group_by('olp.'.$grup);
		}
		$q = $this->db->get_where('ol_logbook_pasien olp')->result_array();
		return $q;
    }
	function grafik_garis_opsi_lhu($id,$grup=FALSE)
	{
		$lpd = $this->m_ol_rancak->ambil_surveyor_logbook_laporan_tabel($id);
		$this->db->select("olp.id_lhu as id_lhu,
				DATE_FORMAT(tgl_lhu,'%d-%m-%Y') as tgl_lhu,hasil_lhu_detil,
				DATE_FORMAT(tgl_lhu,'%Y') as thn,
				DATE_FORMAT(tgl_lhu,'%m') as bln,
				DATE_FORMAT(tgl_lhu,'%d') as hr
			");
		$this->db->join('ol_logbook_lhu ol', 'ol.id_lhu=olp.id_lhu','left');
		$this->db->where('tgl_lhu BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where('hasil_lhu_detil >',0);
		if($grup){
			$this->db->group_by('olp.'.$grup);
		}
		$q = $this->db->get_where('ol_logbook_lhu_detil olp')->result_array();
		return $q;
    }
	function grafik_garis_hasil_logbook($tgl,$id,$hasil)
	{
		if(empty($hasil)){
			$this->db->select("nkk.id_kompetensi as id_lhu,sum(jml_logbook) as hasil_lhu_detil");
		}else{
			if($hasil == 1){
				$this->db->select("ol.id_kewenangan as id_lhu,sum(jml_logbook) as hasil_lhu_detil");
			}else{
				$this->db->select("nkk.id_kompetensi as id_lhu,sum(jml_logbook) as hasil_lhu_detil");
			}
		}
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
		if(empty($hasil)){
			$this->db->where('nkk.id_kompetensi', $id);
		}else{
			if($hasil == 1){
				$this->db->where('ol.id_kewenangan', $id);
			}else{
				$this->db->where('nkk.id_kompetensi', $id);
			}
		}		
		$this->db->where('tgl_logbook', date('Y-m-d', strtotime($tgl)));
		$this->db->where('jml_logbook >',0);
		$q = $this->db->get_where('ol_logbook ol')->result_array();
	//	echo $this->db->last_query();
	//	print_r($q);die();
		return $q;
    }
	function grafik_garis_hasil_pasien($tgl,$id,$bhn,$jml)
	{
		$lpd = $this->m_ol_rancak->ambil_surveyor_logbook_laporan_tabel($id);
		$this->db->select("olp.".$bhn."  as id_lhu,SUM(".$jml.") as hasil_lhu_detil");
		$this->db->join('ol_logbook ol', 'ol.id_logbook=olp.id_logbook','left');
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
		$this->db->join('kol_reject krj', 'krj.id_reject=olp.id_reject','left');
		$this->db->join('ol_bahan obh', 'obh.id_bahan=olp.id_bahan','left');
		$this->db->where('olp.'.$bhn, $id);
		$this->db->where('tgl_logbook', date('Y-m-d', strtotime($tgl)));
		$this->db->where('ol.jml_logbook >',0);
		$this->db->where($jml.' >',0);
		$q = $this->db->get_where('ol_logbook_pasien olp')->result_array();
		return $q;
    }
	function grafik_garis_hasil_lhu($tgl,$id)
	{
		$lpd = $this->m_ol_rancak->ambil_surveyor_logbook_laporan_tabel($id);
		$this->db->select("olp.id_lhu as id_lhu,SUM(hasil_lhu_detil) as hasil_lhu_detil");
		$this->db->join('ol_logbook_lhu ol', 'ol.id_lhu=olp.id_lhu','left');
		$this->db->where('olp.id_lhu', $id);
		$this->db->where('tgl_lhu', date('Y-m-d', strtotime($tgl)));
		$this->db->where('hasil_lhu_detil >',0);
		$q = $this->db->get_where('ol_logbook_lhu_detil olp')->result_array();
		return $q;
    }
	function ambil_logbook_laporan_tabel($id)
	{
		$this->db->join('ol_logbook_laporan oll', 'oll.id_laporan=ollt.id_laporan','left');
		$this->db->join('sn_tabel stb', 'stb.id_tabel=ollt.tabel','left');
		$q = $this->db->get_where('ol_logbook_laporan_tabel ollt',array('ollt.id_laporan'=>$id,'status_urutan_tabel'=>1));
		//	echo $this->db->last_query();
		//	print_r($q);die();
		return $q->result_array();
	}
	function ambil_logbook_laporan_tabellap($id)
	{
		$this->db->join('ol_logbook_laporan oll', 'oll.id_laporan=ollt.id_laporan','left');
		$this->db->join('sn_tabel stb', 'stb.id_tabel=ollt.tabel','left');
		$this->db->join('ol_unit ou', 'ou.id_unit=oll.id_unit','left');
		$this->db->join('ol_pegawai peg', 'peg.barcode_pegawai=oll.barcode_pegawai','left');
		$q = $this->db->get_where('ol_logbook_laporan_tabel ollt',array('ollt.id_laporan'=>$id));
		//	echo $this->db->last_query();
		//	print_r($q);die();
		return $q->row_array();
	}
	function ambil_laporan_logbook_2_grup($id,$grup,$kondisi=FALSE)
	{
		$lpd = $this->m_ol_rancak->ambil_surveyor_logbook_laporan_tabel($id);
		$idk = explode(',', $lpd['kompetensi']);
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=ol.id_logbooker','left');
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
		$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where('ol.jml_logbook >',0);
		if($kondisi){
			$this->db->where($kondisi);
		}
		if(!empty($lpd['kompetensi'])){
			$this->db->where_in("nkk.id_kompetensi",$idk);
		}
		$this->db->order_by($grup,'ASC');		
		$this->db->group_by($grup);
		$q = $this->db->get_where('ol_logbook ol',array('peg.barcode_pegawai'=>$lpd['barcode_pegawai']))->result_array();
		//	echo $this->db->last_query();
		//	print_r($q);die();
		return $q;
    }
	function ambil_laporan_logbook_grup($id,$grup,$kondisi=FALSE)
	{
		$lpd = $this->m_ol_rancak->ambil_surveyor_logbook_laporan_tabel($id);
		$idk = explode(',', $lpd['kompetensi']);
		$idb = explode(',', $lpd['bahan']);
		$idr = explode(',', $lpd['reject']);
		$this->db->join('ol_logbook ol', 'ol.id_logbook=olp.id_logbook','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=ol.id_logbooker','left');
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
		$this->db->join('kol_reject krj', 'krj.id_reject=olp.id_reject','left');
		$this->db->join('ol_bahan obh', 'obh.id_bahan=olp.id_bahan','left');
		$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where('ol.jml_logbook >',0);
		$this->db->where("(olp.jml_bahan > 0 OR olp.jml_reject > 0)", NULL, FALSE);
		$this->db->where('ol.id_instansi',$lpd['id_working']);
		if($kondisi){
			$this->db->where($kondisi);
		}
		if(!empty($lpd['kompetensi'])){
			$this->db->where_in("nkk.id_kompetensi",$idk);
		}
		if(!empty($lpd['bahan'])){
			$this->db->where_in("olp.id_bahan",$idb);
		}
		if(!empty($lpd['reject'])){
			$this->db->where_in("olp.id_reject",$idr);
		}
		$this->db->order_by($grup,'ASC');		
		$this->db->group_by($grup);
		$q = $this->db->get_where('ol_logbook_pasien olp',array('peg.barcode_pegawai'=>$lpd['barcode_pegawai']))->result_array();
		//	echo $this->db->last_query();
		//	print_r($q);die();
		return $q;
    }
	function ambil_laporan_logbook_pasien($id,$idl)
	{
		$lpd = $this->m_ol_rancak->ambil_surveyor_logbook_laporan_tabel($id);
		$idk = explode(',', $lpd['kompetensi']);
		$idb = explode(',', $lpd['bahan']);
		$idr = explode(',', $lpd['reject']);
		$this->db->select("*,if(ops.jk = 1,'Laki-laki','Perempuan') as gender_pasien,ops.rm as rm_pasien,
			CONCAT((TIMESTAMPDIFF( YEAR, ops.tgl_lahir, tgl_logbook )), ' Tahun ',
			TIMESTAMPDIFF( MONTH, ops.tgl_lahir, tgl_logbook ) % 12, ' Bulan ',
			FLOOR( TIMESTAMPDIFF( DAY, ops.tgl_lahir, tgl_logbook ) % 30.4375 ), ' Hari') as umur_pasien
			");
		$this->db->join('ol_logbook ol', 'ol.id_logbook=olp.id_logbook','left');
		$this->db->join('ol_pasien ops', 'ops.id_pasien=olp.id_pasien','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=ol.id_logbooker','left');
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
		$this->db->join('kol_reject krj', 'krj.id_reject=olp.id_reject','left');
		$this->db->join('ol_bahan obh', 'obh.id_bahan=olp.id_bahan','left');
		$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where('ol.jml_logbook >',0);
		$this->db->where('ol.id_instansi',$lpd['id_working']);
		$this->db->where("(olp.jml_bahan > 0 OR olp.jml_reject > 0)", NULL, FALSE);
		if(!empty($lpd['kompetensi'])){
			$this->db->where_in("nkk.id_kompetensi",$idk);
		}
		if(!empty($lpd['bahan'])){
			$this->db->where_in("olp.id_bahan",$idb);
		}
		if(!empty($lpd['reject'])){
			$this->db->where_in("olp.id_reject",$idr);
		}
		$q = $this->db->get_where('ol_logbook_pasien olp',array('peg.barcode_pegawai'=>$lpd['barcode_pegawai'],'olp.id_logbook'=>$idl))->result_array();
		//	echo $this->db->last_query();
		//	print_r($q);die();
		return $q;
    }
	function ambil_universal_lhu_lg($id,$select,$kondisi,$grup=FALSE)
	{
		$lpd = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($id); //id_laporan_tabel
		$this->db->select($select);
		$this->db->join('ol_logbook_lhu oll', 'oll.id_lhu=olp.id_lhu','left');
		$this->db->join('ol_logbook_item_lhu olil', 'olil.id_item_lhu=olp.id_item_lhu','left');
		$this->db->join('ol_equipment oe', 'oe.id_equipment=olil.id_equipment','left');
		if(!empty($lpd['i_mutu'])){
			$idlh = explode(',', $lpd['i_mutu']);
			$this->db->where_in("olp.id_lhu_detil",$idlh); // nama_lhu - tgl_lhu
		}
		if(!empty($lpd['item_lhu'])){
			$idilhu = explode(',', $lpd['item_lhu']);
			$this->db->where_in("olil.id_item_lhu",$idilhu); // nama_item_lhu
		}
/*		if(!empty($lpd['id_lhu'])){
			$idlb = explode(',', $lpd['id_lhu']);
			$this->db->where_in("olil.id_equipment",$idlb); //nama_equipment
		}*/
		if($grup){
			$this->db->group_by($grup);
		}
		$this->db->order_by('olil.id_equipment','asc');
		$q = $this->db->get_where('ol_logbook_lhu_detil olp',$kondisi)->result_array();
//	echo $this->db->last_query();die();
	//print_r($q);die();
		return $q;
    }
	function print_logbook_per_pasien($first_date,$last_date,$idr,$id)
	{
		$this->db->select("DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_logbook,ol.id_logbook,rm,
		concat(nama_kompetensi,' - <b>[',nama_kewenangan,']</b>') as nama_kompetensi
			");
		$this->db->join('nkr_kewenangan ok', 'ok.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi okm', 'okm.id_kompetensi=ok.id_kompetensi','left');
		$this->db->where('ol.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$this->db->order_by('ol.tgl_logbook','ASC');
		$q = $this->db->get_where('ol_logbook ol',array('ol.id_logbooker'=>$id,'ol.id_instansi'=>$idr))->result_array();
		return $q;
    }
	function print_logbook_per_pasien_bakhpr($first_date,$last_date,$kondisi)
	{
		$this->db->select("DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_logbook,ol.id_logbook,rm,
		concat(nama_kompetensi,' - <b>[',nama_kewenangan,']</b>') as nama_kompetensi
			");
	//	$this->db->join('ol_logbook_pasien olp', 'olp.id_logbook_pasien=olpk.id_logbook_pasien','left');
		$this->db->join('ol_logbook ol', 'ol.id_logbook=olp.id_logbook','left');
		$this->db->join('nkr_kewenangan ok', 'ok.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi okm', 'okm.id_kompetensi=ok.id_kompetensi','left');
		$this->db->where('ol.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$this->db->order_by('ol.tgl_logbook','ASC');
		$q = $this->db->get_where('ol_logbook_pasien olp',$kondisi)->result_array();
		return $q;
    }
	function print_logbook_per_pasien_pakai($first_date,$last_date,$kondisi)
	{
		$this->db->select("DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_logbook,ol.id_logbook,rm,
		concat(nama_kompetensi,' - <b>[',nama_kewenangan,']</b>') as nama_kompetensi
			");
		$this->db->join('ol_logbook_pasien olp', 'olp.id_logbook_pasien=olpk.id_logbook_pasien','left');
		$this->db->join('ol_logbook ol', 'ol.id_logbook=olp.id_logbook','left');
		$this->db->join('nkr_kewenangan ok', 'ok.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi okm', 'okm.id_kompetensi=ok.id_kompetensi','left');
		$this->db->where('ol.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$this->db->order_by('ol.tgl_logbook','ASC');
		$q = $this->db->get_where('ol_logbook_pakai olpk',$kondisi)->result_array();
		return $q;
    }
	function print_logbook_per_pasien_reject($first_date,$last_date,$kondisi)
	{
		$this->db->select("DATE_FORMAT(tgl_logbook,'%d-%m-%Y') as tgl_logbook,ol.id_logbook,rm,
		concat(nama_kompetensi,' - <b>[',nama_kewenangan,']</b>') as nama_kompetensi
			");
		$this->db->join('ol_logbook_pasien olp', 'olp.id_logbook_pasien=olpk.id_logbook_pasien','left');
		$this->db->join('ol_logbook ol', 'ol.id_logbook=olp.id_logbook','left');
		$this->db->join('nkr_kewenangan ok', 'ok.id_kewenangan=ol.id_kewenangan','left');
		$this->db->join('nkr_kompetensi okm', 'okm.id_kompetensi=ok.id_kompetensi','left');
		$this->db->where('ol.tgl_logbook BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		$this->db->order_by('ol.tgl_logbook','ASC');
		$q = $this->db->get_where('ol_logbook_reject olpk',$kondisi)->result_array();
		return $q;
    }
	function print_per_pasien($id)
	{
		$this->db->select("*,if(jk = 1,'Laki-laki','Perempuan') as jk,
			CONCAT((TIMESTAMPDIFF( YEAR, ops.tgl_lahir, tgl_logbook )), ' Tahun ',
			TIMESTAMPDIFF( MONTH, ops.tgl_lahir, tgl_logbook ) % 12, ' Bulan ',
			FLOOR( TIMESTAMPDIFF( DAY, ops.tgl_lahir, tgl_logbook ) % 30.4375 ), ' Hari') as umur
			");
		$this->db->join('ol_logbook ol', 'ol.id_logbook=olp.id_logbook','left');
		$this->db->join('ol_pasien ops', 'ops.id_pasien=olp.id_pasien','left');
/*		$this->db->join('kol_reject krj', 'krj.id_reject=olp.id_reject','left');
		$this->db->join('ol_bahan obh', 'obh.id_bahan=olp.id_bahan','left');*/
		$q = $this->db->get_where('ol_logbook_pasien olp',array('olp.id_logbook'=>$id))->result_array();
		return $q;
    }
	function print_per_pasien_bakhp($id,$kondisi)
	{
		$this->db->select("*,if(jk = 1,'Laki-laki','Perempuan') as jk,
			CONCAT((TIMESTAMPDIFF( YEAR, ops.tgl_lahir, tgl_logbook )), ' Tahun ',
			TIMESTAMPDIFF( MONTH, ops.tgl_lahir, tgl_logbook ) % 12, ' Bulan ',
			FLOOR( TIMESTAMPDIFF( DAY, ops.tgl_lahir, tgl_logbook ) % 30.4375 ), ' Hari') as umur
			");
		$this->db->join('ol_logbook_pasien olp', 'olp.id_logbook_pasien=olpk.id_logbook_pasien','left');
		$this->db->join('ol_logbook ol', 'ol.id_logbook=olp.id_logbook','left');
		$this->db->join('ol_pasien ops', 'ops.id_pasien=olp.id_pasien','left');
		$this->db->join('ol_bahan obh', 'obh.id_bahan=olp.id_bahan','left');
		$q = $this->db->get_where('ol_logbook_pakai olpk',array('olp.id_logbook'=>$id))->result_array();
		return $q;
    }
	function print_per_pasien_reject($id,$kondisi)
	{
		$this->db->select("*,if(jk = 1,'Laki-laki','Perempuan') as jk,
			CONCAT((TIMESTAMPDIFF( YEAR, ops.tgl_lahir, tgl_logbook )), ' Tahun ',
			TIMESTAMPDIFF( MONTH, ops.tgl_lahir, tgl_logbook ) % 12, ' Bulan ',
			FLOOR( TIMESTAMPDIFF( DAY, ops.tgl_lahir, tgl_logbook ) % 30.4375 ), ' Hari') as umur
			");
		$this->db->join('ol_logbook_pasien olp', 'olp.id_logbook_pasien=olpk.id_logbook_pasien','left');
		$this->db->join('ol_logbook ol', 'ol.id_logbook=olp.id_logbook','left');
		$this->db->join('ol_pasien ops', 'ops.id_pasien=olp.id_pasien','left');
		$this->db->join('kol_reject krj', 'krj.id_reject=olp.id_reject','left');
		$this->db->join('ol_bahan obh', 'obh.id_bahan=olp.id_bahan','left');
		$q = $this->db->get_where('ol_logbook_reject olpk',array('olp.id_logbook'=>$id))->result_array();
		return $q;
    }
	function count_bakhp($kondisi)
	{
		$this->db->select('COUNT(*) as num');
		$this->db->where($kondisi);
		$this->db->join('ol_logbook_pasien', 'ol_logbook_pasien.id_logbook_pasien=ol_logbook_pakai.id_logbook_pasien','left');
		$query = $this->db->get_where('ol_logbook_pakai');
	    $result = $query->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
	}
	function count_reject($kondisi)
	{
		$this->db->select('COUNT(*) as num');
		$this->db->where($kondisi);
		$this->db->join('ol_logbook_pasien', 'ol_logbook_pasien.id_logbook_pasien=ol_logbook_reject.id_logbook_pasien','left');
		$query = $this->db->get_where('ol_logbook_reject');
	    $result = $query->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
	}
	function jml_bakhp($kondisi)
	{
		$this->db->select('SUM(jml_bahan) as num');
		$this->db->where($kondisi);
		$this->db->join('ol_logbook_pasien', 'ol_logbook_pasien.id_logbook_pasien=ol_logbook_pakai.id_logbook_pasien','left');
		$query = $this->db->get_where('ol_logbook_pakai');
	    $result = $query->row();
	    if($result->num > 0)
	    	return $result->num;
	    return 0;
	}
	function jml_rejects($kondisi)
	{
		$this->db->select('SUM(jml_bahan) as num');
		$this->db->where($kondisi);
		$this->db->join('ol_logbook_pasien', 'ol_logbook_pasien.id_logbook_pasien=ol_logbook_reject.id_logbook_pasien','left');
		$query = $this->db->get_where('ol_logbook_reject');
	    $result = $query->row();
	    if($result->num > 0)
	    	return $result->num;
	    return 0;
	}
	function count_all_bakhp($id,$kondisi)
	{
		$lpd = $this->m_ol_rancak->ambil_surveyor_logbook_laporan_tabel($id);
		$idk = explode(',', $lpd['kompetensi']);
		$idb = explode(',', $lpd['bahan']);
		$idr = explode(',', $lpd['reject']);
		$this->db->select('COUNT(*) as num');
		$this->db->join('ol_logbook_pasien olp', 'olp.id_logbook_pasien=olpk.id_logbook_pasien','left');
		$this->db->join('ol_logbook lp', 'lp.id_logbook=olp.id_logbook','left');
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=lp.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
		$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where('lp.jml_logbook >',0);
		$this->db->where('olpk.jml_bahan >',0);
	//	$this->db->where("(olp.jml_bahan > 0 OR olp.jml_reject > 0)", NULL, FALSE);
		$this->db->where('lp.id_instansi',$lpd['id_working']);
		if(!empty($lpd['kompetensi'])){
			$this->db->where_in("nkk.id_kompetensi",$idk);
		}
		if(!empty($lpd['bahan'])){
			$this->db->where_in("olp.id_bahan",$idb);
		}
		if(!empty($lpd['reject'])){
			$this->db->where_in("olp.id_reject",$idr);
		}
		$query = $this->db->get_where('ol_logbook_pakai olpk',$kondisi);
	    $result = $query->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
	}
	function count_all_reject($id,$kondisi)
	{
		$lpd = $this->m_ol_rancak->ambil_surveyor_logbook_laporan_tabel($id);
		$idk = explode(',', $lpd['kompetensi']);
		$idb = explode(',', $lpd['bahan']);
		$idr = explode(',', $lpd['reject']);
		$this->db->select('COUNT(*) as num');
		$this->db->join('ol_logbook_pasien olp', 'olp.id_logbook_pasien=olpk.id_logbook_pasien','left');
		$this->db->join('ol_logbook lp', 'lp.id_logbook=olp.id_logbook','left');
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=lp.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
		$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where('lp.jml_logbook >',0);
		$this->db->where('olpk.jml_reject >',0);
	//	$this->db->where("(olp.jml_bahan > 0 OR olp.jml_reject > 0)", NULL, FALSE);
		$this->db->where('lp.id_instansi',$lpd['id_working']);
		if(!empty($lpd['kompetensi'])){
			$this->db->where_in("nkk.id_kompetensi",$idk);
		}
		if(!empty($lpd['bahan'])){
			$this->db->where_in("olp.id_bahan",$idb);
		}
		if(!empty($lpd['reject'])){
			$this->db->where_in("olp.id_reject",$idr);
		}
		$query = $this->db->get_where('ol_logbook_reject olpk',$kondisi);
	    $result = $query->row();
	    if(isset($result))
	    	return $result->num;
	    return 0;
	}
	function jml_all_bakhp($id,$kondisi)
	{
		$lpd = $this->m_ol_rancak->ambil_surveyor_logbook_laporan_tabel($id);
		$idk = explode(',', $lpd['kompetensi']);
		$idb = explode(',', $lpd['bahan']);
		$idr = explode(',', $lpd['reject']);
		$this->db->select('SUM(jml_bahan) as num');
		$this->db->join('ol_logbook lp', 'lp.id_logbook=olp.id_logbook','left');
		$this->db->join('nkr_kewenangan nkk', 'nkk.id_kewenangan=lp.id_kewenangan','left');
		$this->db->join('nkr_kompetensi nkp', 'nkp.id_kompetensi=nkk.id_kompetensi','left');
		$this->db->where('tgl_logbook BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'].'"');
		$this->db->where('lp.jml_logbook >',0);
		$this->db->where("(olp.jml_bahan > 0 OR olp.jml_reject > 0)", NULL, FALSE);
		$this->db->where('lp.id_instansi',$lpd['id_working']);
		if(!empty($lpd['kompetensi'])){
			$this->db->where_in("nkk.id_kompetensi",$idk);
		}
		if(!empty($lpd['bahan'])){
			$this->db->where_in("olp.id_bahan",$idb);
		}
		if(!empty($lpd['reject'])){
			$this->db->where_in("olp.id_reject",$idr);
		}
		$query = $this->db->get_where('ol_logbook_pasien olp',$kondisi);
	    $result = $query->row();
	    if($result->num > 0)
	    	return $result->num;
	    return 0;
	}
//=====================================================
  function ambil_bulan_ol_eq_imut($id)
  {
    $lpd = $this->m_ol_rancak->ambil_data_laporan_detil($id);
    $this->db->join('ol_eq_detil', 'ol_eq_detil.id_eq_detil=ol_eq_imut.id_eq_detil','left');
    $this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_eq_detil.id_equipment','left');
    $this->db->where('tgl_eq_imut BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'] .'"');
    $this->db->where("id_unit",$this->session->unit);
    if($lpd['id_equipment']){
      $ideq = explode(',', $lpd['id_equipment']);
      $this->db->where_in("ol_equipment.coun_equipment",$ideq);
    }
    if($lpd['equipment_detil']){
      $ideqdet = explode(',', $lpd['equipment_detil']);
      $this->db->where_in("ol_eq_detil.coun_eq_detil",$ideqdet);
    }
      $this->db->group_by($grup);
    $q = $this->db->get_where('ol_eq_imut')->result_array(); 
    //echo $this->db->last_query();die();
    //print_r($q);die();
    return $q;
  }
  function ambil_equipment_ol_eq_imut($id,$tgl)
  {
    $lpd = $this->m_ol_rancak->ambil_data_laporan_detil($id);
    $this->db->join('ol_eq_detil', 'ol_eq_detil.id_eq_detil=ol_eq_imut.id_eq_detil','left');
    $this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_eq_detil.id_equipment','left');
    $this->db->where('tgl_eq_imut BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'] .'"');
    $this->db->where("id_unit",$this->session->unit);
    if($lpd['id_equipment']){
      $ideq = explode(',', $lpd['id_equipment']);
      $this->db->where_in("ol_equipment.coun_equipment",$ideq);
    }
    if($lpd['equipment_detil']){
      $ideqdet = explode(',', $lpd['equipment_detil']);
      $this->db->where_in("ol_eq_detil.coun_eq_detil",$ideqdet);
    }
    $this->db->group_by('ol_eq_detil.id_equipment');
    $q = $this->db->get_where('ol_eq_imut')->result_array(); 
    //echo $this->db->last_query();die();
    //print_r($q);die();
    return $q;
  }
  function ambil_eq_detil_ol_eq_imut($id,$tgl)
  {
    $lpd = $this->m_ol_rancak->ambil_data_laporan_detil($id);
    $this->db->join('ol_eq_detil', 'ol_eq_detil.id_eq_detil=ol_eq_imut.id_eq_detil','left');
    $this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_eq_detil.id_equipment','left');
    $this->db->where('tgl_eq_imut BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'] .'"');
    $this->db->where("id_unit",$this->session->unit);
    if($lpd['id_equipment']){
      $ideq = explode(',', $lpd['id_equipment']);
      $this->db->where_in("ol_equipment.coun_equipment",$ideq);
    }
    if($lpd['equipment_detil']){
      $ideqdet = explode(',', $lpd['equipment_detil']);
      $this->db->where_in("ol_eq_detil.coun_eq_detil",$ideqdet);
    }
    $this->db->group_by('ol_eq_imut.id_eq_detil');
    $q = $this->db->get_where('ol_eq_imut')->result_array(); 
    //echo $this->db->last_query();die();
    //print_r($q);die();
    return $q;
  }
  function jumlah_eq_detil_ol_eq_imut($id,$tgl,$kat)
  {
    $lpd = $this->m_ol_rancak->ambil_data_laporan_detil($id);
    $this->db->join('ol_eq_detil', 'ol_eq_detil.id_eq_detil=ol_eq_imut.id_eq_detil','left');
    $this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_eq_detil.id_equipment','left');
    $this->db->where('tgl_eq_imut BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'] .'"');
    $this->db->where("id_unit",$this->session->unit);
    $this->db->where('tgl_eq_imut',$tgl);
    $this->db->where("ol_eq_imut.id_eq_detil", $kat);
    $query = $this->db->select("COUNT(*) as num")->get_where('ol_eq_imut');
    //echo $this->db->last_query();die();
    $result = $query->row();
    if(isset($result))
        return $result->num;
    return 0;
  }
  function total_eq_detil_ol_eq_imut($id,$tgl,$kat)
  {
    $lpd = $this->m_ol_rancak->ambil_data_laporan_detil($id);
    $this->db->select('SUM(hasil_eq_imut) as jumlahe');
    $this->db->join('ol_eq_detil', 'ol_eq_detil.id_eq_detil=ol_eq_imut.id_eq_detil','left');
    $this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_eq_detil.id_equipment','left');
    $this->db->where('tgl_eq_imut BETWEEN "'. $lpd['tgl_awal'] . '" and "'. $lpd['tgl_akhir'] .'"');
    $this->db->where("id_unit",$this->session->unit);
    $this->db->where('tgl_eq_imut',$tgl);
    $this->db->where("ol_eq_imut.id_eq_detil", $kat);
    $q = $this->db->get_where('ol_eq_imut');
    return $q->result_array();
  }
  function ambil_isi_order($id,$tabel,$select,$kondisi,$order,$asc,$grup=FALSE)
  {
    $lpd = $this->m_ol_rancak->ambil_data_laporan_detil($id);
    $this->db->select($select);
    $this->db->join('ol_eq_detil', 'ol_eq_detil.id_eq_detil=ol_eq_imut.id_eq_detil','left');
    $this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_eq_detil.id_equipment','left');
    if($lpd['id_equipment']){
      $ideq = explode(',', $lpd['id_equipment']);
      $this->db->where_in("ol_equipment.coun_equipment",$ideq);
    }
    if($lpd['equipment_detil']){
      $ideqdet = explode(',', $lpd['equipment_detil']);
      $this->db->where_in("ol_eq_detil.coun_eq_detil",$ideqdet);
    }
    if($grup){
      $this->db->group_by($grup);
    }
    $this->db->order_by($order,$asc);
    $q = $this->db->get_where($tabel,$kondisi)->result_array(); 
    //echo $this->db->last_query();die();
    //print_r($q);die();
    return $q;
  }
  function ambil_isi_persen($id,$tabel,$select,$kondisi,$grup=FALSE)
  {
    $lpd = $this->m_ol_rancak->ambil_data_laporan_detil($id);
    $this->db->select($select);
    $this->db->join('ol_eq_detil x', 'x.id_eq_detil=ol_eq_denum.num_eq_denum','left');
    $this->db->join('ol_eq_detil y', 'y.id_eq_detil=ol_eq_denum.denum_eq_denum','left');
/*    $this->db->join('ol_eq_imut ix', 'ix.id_eq_detil=ol_eq_denum.num_eq_denum','left');
    $this->db->join('ol_eq_imut iy', 'iy.id_eq_detil=ol_eq_denum.denum_eq_denum','left');
	$this->db->join('ol_eq_detil dx', 'dx.id_eq_detil=ol_eq_denum.num_eq_denum','left');
    $this->db->join('ol_eq_detil dy', 'dy.id_eq_detil=ol_eq_denum.denum_eq_denum','left');*/
    $this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_eq_denum.id_equipment','left');
    if($lpd['id_equipment']){
      $ideq = explode(',', $lpd['id_equipment']);
      $this->db->where_in("ol_equipment.coun_equipment",$ideq);
    }
    if($lpd['equipment_detil']){
      $ideqdet = explode(',', $lpd['equipment_detil']);
      $this->db->where_in("ol_eq_detil.coun_eq_detil",$ideqdet);
    }
    if($grup){
      $this->db->group_by($grup);
    }
    $q = $this->db->get_where($tabel,$kondisi)->result_array(); 
    //echo $this->db->last_query();die();
    //print_r($q);die();
    return $q;
  }
  function ambil_isi($id,$tabel,$select,$kondisi,$grup=FALSE)
  {
    $lpd = $this->m_ol_rancak->ambil_data_laporan_detil($id);
    $this->db->select($select);
    $this->db->join('ol_eq_detil', 'ol_eq_detil.id_eq_detil=ol_eq_imut.id_eq_detil','left');
    $this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_eq_detil.id_equipment','left');
    if($lpd['id_equipment']){
      $ideq = explode(',', $lpd['id_equipment']);
      $this->db->where_in("ol_equipment.coun_equipment",$ideq);
    }
    if($lpd['equipment_detil']){
      $ideqdet = explode(',', $lpd['equipment_detil']);
      $this->db->where_in("ol_eq_detil.coun_eq_detil",$ideqdet);
    }
    if($grup){
      $this->db->group_by($grup);
    }
    $q = $this->db->get_where($tabel,$kondisi)->result_array(); 
    //echo $this->db->last_query();die();
    //print_r($q);die();
    return $q;
  }
  function jumlah_record_filter_select($id,$tabel,$kondisi,$grup=FALSE)
  {
    $lpd = $this->m_ol_rancak->ambil_data_laporan_detil($id);
  //  $this->db->select($select);
    $this->db->join('ol_eq_imut', 'ol_eq_imut.id_eq_detil=ol_eq_denum.num_eq_denum','left');
    $this->db->join('ol_eq_detil', 'ol_eq_detil.id_eq_detil=ol_eq_imut.id_eq_detil','left');
    $this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_eq_detil.id_equipment','left');
    if($lpd['id_equipment']){
      $ideq = explode(',', $lpd['id_equipment']);
      $this->db->where_in("ol_equipment.coun_equipment",$ideq);
    }
    if($lpd['equipment_detil']){
      $ideqdet = explode(',', $lpd['equipment_detil']);
      $this->db->where_in("ol_eq_detil.coun_eq_detil",$ideqdet);
    }
    if($grup){
      $this->db->group_by($grup);
    }
    $query = $this->db->select("COUNT(*) as num")->get_where($tabel,$kondisi);
    //echo $this->db->last_query();die();
    $result = $query->row();
    if(isset($result))
        return $result->num;
    return 0;
  }
  function jumlah_sumber_data($id,$tabel,$select,$kondisi,$grup=FALSE)
  {
    $lpd = $this->m_ol_rancak->ambil_data_laporan_detil($id);
  //  $this->db->select($select);
    $this->db->join('ol_eq_detil', 'ol_eq_detil.id_eq_detil=ol_eq_imut.id_eq_detil','left');
    $this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_eq_detil.id_equipment','left');
    if($lpd['id_equipment']){
      $ideq = explode(',', $lpd['id_equipment']);
      $this->db->where_in("ol_equipment.coun_equipment",$ideq);
    }
    if($lpd['equipment_detil']){
      $ideqdet = explode(',', $lpd['equipment_detil']);
      $this->db->where_in("ol_eq_detil.coun_eq_detil",$ideqdet);
    }
    if($grup){
      $this->db->group_by($grup);
    }
    $query = $this->db->select("COUNT(*) as num")->get_where($tabel,$kondisi);
    //echo $this->db->last_query();die();
    $result = $query->row();
    if(isset($result))
        return $result->num;
    return 0;
  }
  function total_range_tabel_persen($id,$tabel,$fieldsum,$kondisi,$grup=FALSE)
  {
  	$lpd = $this->m_ol_rancak->ambil_data_laporan_detil($id);
	$this->db->select_sum($fieldsum);
    $this->db->join('ol_eq_detil', 'ol_eq_detil.id_eq_detil=ol_eq_imut.id_eq_detil','left');
    $this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_eq_detil.id_equipment','left');
    if($lpd['id_equipment']){
      $ideq = explode(',', $lpd['id_equipment']);
      $this->db->where_in("ol_equipment.coun_equipment",$ideq);
    }
    if($lpd['equipment_detil']){
      $ideqdet = explode(',', $lpd['equipment_detil']);
      $this->db->where_in("ol_eq_detil.coun_eq_detil",$ideqdet);
    }
    if($grup){
      $this->db->group_by($grup);
    }
	$query = $this->db->get_where($tabel,$kondisi);
	//  echo $this->db->last_query();
	return $query->row()->$fieldsum;
  }
  function total_sumber_data($id,$tabel,$select,$kondisi,$grup=FALSE){
    $lpd = $this->m_ol_rancak->ambil_data_laporan_detil($id);
    $this->db->select($select);
    $this->db->join('ol_eq_detil', 'ol_eq_detil.id_eq_detil=ol_eq_imut.id_eq_detil','left');
    $this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_eq_detil.id_equipment','left');
    if($lpd['id_equipment']){
      $ideq = explode(',', $lpd['id_equipment']);
      $this->db->where_in("ol_equipment.coun_equipment",$ideq);
    }
    if($lpd['equipment_detil']){
      $ideqdet = explode(',', $lpd['equipment_detil']);
      $this->db->where_in("ol_eq_detil.coun_eq_detil",$ideqdet);
    }
    if($grup){
      $this->db->group_by($grup);
    }
    $q = $this->db->get_where($tabel,$kondisi);
    return $q->result_array();
  }
  function ambil_ol_laporan_detil($id)
  {
    $this->db->join('ol_laporan', 'ol_laporan.id_laporan=ol_laporan_detil.id_laporan','left');
    $this->db->join('sn_tabel', 'sn_tabel.id_tabel=ol_laporan_detil.tabel','left');
    $q = $this->db->get_where('ol_laporan_detil',array('ol_laporan_detil.id_laporan'=>$id,'status_urutan_detil'=>1));
    //  echo $this->db->last_query();
    //  print_r($q);die();
    return $q->result_array();
  }
  function ambil_ol_per_laporan_detil($id)
  {
    $this->db->join('ol_per_laporan', 'ol_per_laporan.id_laporan=ol_per_laporan_detil.id_laporan','left');
    $this->db->join('sn_tabel', 'sn_tabel.id_tabel=ol_per_laporan_detil.tabel','left');
    $q = $this->db->get_where('ol_per_laporan_detil',array('ol_per_laporan_detil.id_laporan'=>$id,'status_urutan_detil'=>1));
    //  echo $this->db->last_query();
    //  print_r($q);die();
    return $q->result_array();
  }
  function get_min($id,$tabel,$field,$kondisi,$grup=FALSE){
    $lpd = $this->m_ol_rancak->ambil_data_laporan_detil($id);
  //  $this->db->select($select);
    $this->db->join('ol_eq_detil', 'ol_eq_detil.id_eq_detil=ol_eq_imut.id_eq_detil','left');
    $this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_eq_detil.id_equipment','left');
    if($lpd['id_equipment']){
      $ideq = explode(',', $lpd['id_equipment']);
      $this->db->where_in("ol_equipment.coun_equipment",$ideq);
    }
    if($lpd['equipment_detil']){
      $ideqdet = explode(',', $lpd['equipment_detil']);
      $this->db->where_in("ol_eq_detil.coun_eq_detil",$ideqdet);
    }
    if($grup){
      $this->db->group_by($grup);
    }
    //echo $this->db->last_query();die();
    $query = $this->db->select("MIN(".$field.") as num")->get_where($tabel,$kondisi);
      $result = $query->row();
      if(isset($result))
        return $result->num;
      return 0;
  }
  function get_max($id,$tabel,$field,$kondisi,$grup=FALSE){
    $lpd = $this->m_ol_rancak->ambil_data_laporan_detil($id);
  //  $this->db->select($select);
    $this->db->join('ol_eq_detil', 'ol_eq_detil.id_eq_detil=ol_eq_imut.id_eq_detil','left');
    $this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_eq_detil.id_equipment','left');
    if($lpd['id_equipment']){
      $ideq = explode(',', $lpd['id_equipment']);
      $this->db->where_in("ol_equipment.coun_equipment",$ideq);
    }
    if($lpd['equipment_detil']){
      $ideqdet = explode(',', $lpd['equipment_detil']);
      $this->db->where_in("ol_eq_detil.coun_eq_detil",$ideqdet);
    }
    if($grup){
      $this->db->group_by($grup);
    }
    //echo $this->db->last_query();die();
    $query = $this->db->select("MAX(".$field.") as num")->get_where($tabel,$kondisi);
      $result = $query->row();
      if(isset($result))
        return $result->num;
      return 0;
  }
//=====================================================
  function ambil_isi_personal_order($id,$tabel,$select,$kondisi,$order,$asc,$grup=FALSE)
  {
    $lpd = $this->m_ol_rancak->ambil_data_per_laporan_detil($id);
    $this->db->select($select);
    if($lpd['jenis_per_laporan_detil'] == 2){
      $this->db->join('ol_per_imqc_detil','ol_per_imqc_detil.id_per_imqc_detil=ol_per_imqc_hasil.id_per_imqc_detil','left');
      $this->db->join('ol_per_imqc','ol_per_imqc.id_per_imqc=ol_per_imqc_detil.id_per_imqc','left');
      if($lpd['id_equipment']){
        $ideq = explode(',', $lpd['id_equipment']);
        $this->db->where_in("ol_per_imqc.coun_per_imqc",$ideq);
      }
      if($lpd['equipment_detil']){
        $ideqdet = explode(',', $lpd['equipment_detil']);
        $this->db->where_in("ol_per_imqc_detil.coun_per_imqc_detil",$ideqdet);
      }
    }
    if($lpd['jenis_per_laporan_detil'] == 3){
      $this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');     
      $this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
      if($lpd['id_equipment']){
        $ideq = explode(',', $lpd['id_equipment']);
        $this->db->where_in("nkr_kompetensi.coun_kompetensi",$ideq);
      }
      if($lpd['equipment_detil']){
        $ideqdet = explode(',', $lpd['equipment_detil']);
        $this->db->where_in("nkr_kewenangan.coun_kewenangan",$ideqdet);
      }
    }
    if($lpd['jenis_per_laporan_detil'] == 4){
	    $this->db->join('ol_eq_detil', 'ol_eq_detil.id_eq_detil=ol_eq_imut.id_eq_detil','left');
	    $this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_eq_detil.id_equipment','left');
	    if($lpd['id_equipment']){
	      $ideq = explode(',', $lpd['id_equipment']);
	      $this->db->where_in("ol_equipment.coun_equipment",$ideq);
	    }
	    if($lpd['equipment_detil']){
	      $ideqdet = explode(',', $lpd['equipment_detil']);
	      $this->db->where_in("ol_eq_detil.coun_eq_detil",$ideqdet);
	    }
    }
    if($lpd['jenis_per_laporan_detil'] == 5){
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_berkas.id_pegawai','left');
      $this->db->join('ol_berkas_kategori', 'ol_berkas_kategori.id_berkas_kategori=ol_berkas.id_kategori_berkas','left');
      $this->db->join('ol_kategori_pelatihan', 'ol_kategori_pelatihan.id_kategori_pelatihan=ol_berkas.id_kategori_pelatihan','left');
      $this->db->join('kol_pendidikan', 'kol_pendidikan.id_pendidikan=ol_berkas.id_pendidikan','left');
      if($lpd['id_equipment']){
        $ideq = explode(',', $lpd['id_equipment']);
        $this->db->where_in("ol_berkas.id_kategori_berkas",$ideq);
      }
      if($lpd['equipment_detil']){
        $ideqdet = explode(',', $lpd['equipment_detil']);
        $this->db->where_in("ol_berkas.id_berkas",$ideqdet);
      }
    }
    if($grup){
      $this->db->group_by($grup);
    }
    $this->db->order_by($order,$asc);
    $q = $this->db->get_where($tabel,$kondisi)->result_array(); 
    //echo $this->db->last_query();die();
    //print_r($q);die();
    return $q;
  }
  function ambil_isi_personal($id,$tabel,$select,$kondisi,$grup=FALSE)
  {
    $lpd = $this->m_ol_rancak->ambil_data_per_laporan_detil($id);
    $this->db->select($select);
    if($lpd['jenis_per_laporan_detil'] == 2){
      $this->db->join('ol_per_imqc_detil','ol_per_imqc_detil.id_per_imqc_detil=ol_per_imqc_hasil.id_per_imqc_detil','left');
      $this->db->join('ol_per_imqc','ol_per_imqc.id_per_imqc=ol_per_imqc_detil.id_per_imqc','left');
      if($lpd['id_equipment']){
        $ideq = explode(',', $lpd['id_equipment']);
        $this->db->where_in("ol_per_imqc.coun_per_imqc",$ideq);
      }
      if($lpd['equipment_detil']){
        $ideqdet = explode(',', $lpd['equipment_detil']);
        $this->db->where_in("ol_per_imqc_detil.coun_per_imqc_detil",$ideqdet);
      }
    }
    if($lpd['jenis_per_laporan_detil'] == 3){
      $this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');     
      $this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
      if($lpd['id_equipment']){
        $ideq = explode(',', $lpd['id_equipment']);
        $this->db->where_in("nkr_kompetensi.coun_kompetensi",$ideq);
      }
      if($lpd['equipment_detil']){
        $ideqdet = explode(',', $lpd['equipment_detil']);
        $this->db->where_in("nkr_kewenangan.coun_kewenangan",$ideqdet);
      }
    }
    if($lpd['jenis_per_laporan_detil'] == 4){
	    $this->db->join('ol_eq_detil', 'ol_eq_detil.id_eq_detil=ol_eq_imut.id_eq_detil','left');
	    $this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_eq_detil.id_equipment','left');
	    if($lpd['id_equipment']){
	      $ideq = explode(',', $lpd['id_equipment']);
	      $this->db->where_in("ol_equipment.coun_equipment",$ideq);
	    }
	    if($lpd['equipment_detil']){
	      $ideqdet = explode(',', $lpd['equipment_detil']);
	      $this->db->where_in("ol_eq_detil.coun_eq_detil",$ideqdet);
	    }
    }
    if($lpd['jenis_per_laporan_detil'] == 5){
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_berkas.id_pegawai','left');
      $this->db->join('ol_berkas_kategori', 'ol_berkas_kategori.id_berkas_kategori=ol_berkas.id_kategori_berkas','left');
      $this->db->join('ol_kategori_pelatihan', 'ol_kategori_pelatihan.id_kategori_pelatihan=ol_berkas.id_kategori_pelatihan','left');
      $this->db->join('kol_pendidikan', 'kol_pendidikan.id_pendidikan=ol_berkas.id_pendidikan','left');
      if($lpd['id_equipment']){
        $ideq = explode(',', $lpd['id_equipment']);
        $this->db->where_in("ol_berkas.id_kategori_berkas",$ideq);
      }
      if($lpd['equipment_detil']){
        $ideqdet = explode(',', $lpd['equipment_detil']);
        $this->db->where_in("ol_berkas.id_berkas",$ideqdet);
      }
    }
    if($grup){
      $this->db->group_by($grup);
    }
 //   echo $this->db->last_query();die();
    $q = $this->db->get_where($tabel,$kondisi)->result_array(); 
 //   echo $this->db->last_query();die();
    //print_r($q);die();
    return $q;
  }
  function jumlah_sumber_data_personal($id,$tabel,$select,$kondisi,$grup=FALSE)
  {
    $lpd = $this->m_ol_rancak->ambil_data_per_laporan_detil($id);
    if($lpd['jenis_per_laporan_detil'] == 2){
      $this->db->join('ol_per_imqc_detil','ol_per_imqc_detil.id_per_imqc_detil=ol_per_imqc_hasil.id_per_imqc_detil','left');
      $this->db->join('ol_per_imqc','ol_per_imqc.id_per_imqc=ol_per_imqc_detil.id_per_imqc','left');
      if($lpd['id_equipment']){
        $ideq = explode(',', $lpd['id_equipment']);
        $this->db->where_in("ol_per_imqc.coun_per_imqc",$ideq);
      }
      if($lpd['equipment_detil']){
        $ideqdet = explode(',', $lpd['equipment_detil']);
        $this->db->where_in("ol_per_imqc_detil.coun_per_imqc_detil",$ideqdet);
      }
    }
    if($lpd['jenis_per_laporan_detil'] == 3){
      $this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');     
      $this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
      if($lpd['id_equipment']){
        $ideq = explode(',', $lpd['id_equipment']);
        $this->db->where_in("nkr_kompetensi.coun_kompetensi",$ideq);
      }
      if($lpd['equipment_detil']){
        $ideqdet = explode(',', $lpd['equipment_detil']);
        $this->db->where_in("nkr_kewenangan.coun_kewenangan",$ideqdet);
      }
    }
    if($lpd['jenis_per_laporan_detil'] == 4){
	    $this->db->join('ol_eq_detil', 'ol_eq_detil.id_eq_detil=ol_eq_imut.id_eq_detil','left');
	    $this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_eq_detil.id_equipment','left');
	    if($lpd['id_equipment']){
	      $ideq = explode(',', $lpd['id_equipment']);
	      $this->db->where_in("ol_equipment.coun_equipment",$ideq);
	    }
	    if($lpd['equipment_detil']){
	      $ideqdet = explode(',', $lpd['equipment_detil']);
	      $this->db->where_in("ol_eq_detil.coun_eq_detil",$ideqdet);
	    }
    }
    if($lpd['jenis_per_laporan_detil'] == 5){
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_berkas.id_pegawai','left');
      $this->db->join('ol_berkas_kategori', 'ol_berkas_kategori.id_berkas_kategori=ol_berkas.id_kategori_berkas','left');
      $this->db->join('ol_kategori_pelatihan', 'ol_kategori_pelatihan.id_kategori_pelatihan=ol_berkas.id_kategori_pelatihan','left');
      $this->db->join('kol_pendidikan', 'kol_pendidikan.id_pendidikan=ol_berkas.id_pendidikan','left');
      if($lpd['id_equipment']){
        $ideq = explode(',', $lpd['id_equipment']);
        $this->db->where_in("ol_berkas.id_kategori_berkas",$ideq);
      }
      if($lpd['equipment_detil']){
        $ideqdet = explode(',', $lpd['equipment_detil']);
        $this->db->where_in("ol_berkas.id_berkas",$ideqdet);
      }
    }
    if($grup){
      $this->db->group_by($grup);
    }
    $query = $this->db->select("COUNT(*) as num")->get_where($tabel,$kondisi);
    //echo $this->db->last_query();die();
    $result = $query->row();
    if(isset($result))
        return $result->num;
    return 0;
  }
  function total_sumber_data_personal($id,$tabel,$select,$kondisi,$grup=FALSE){
    $lpd = $this->m_ol_rancak->ambil_data_per_laporan_detil($id);
    $this->db->select($select);
    if($lpd['jenis_per_laporan_detil'] == 2){
      $this->db->join('ol_per_imqc_detil','ol_per_imqc_detil.id_per_imqc_detil=ol_per_imqc_hasil.id_per_imqc_detil','left');
      $this->db->join('ol_per_imqc','ol_per_imqc.id_per_imqc=ol_per_imqc_detil.id_per_imqc','left');
      if($lpd['id_equipment']){
        $ideq = explode(',', $lpd['id_equipment']);
        $this->db->where_in("ol_per_imqc.coun_per_imqc",$ideq);
      }
      if($lpd['equipment_detil']){
        $ideqdet = explode(',', $lpd['equipment_detil']);
        $this->db->where_in("ol_per_imqc_detil.coun_per_imqc_detil",$ideqdet);
      }
    }
    if($lpd['jenis_per_laporan_detil'] == 3){
      $this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');     
      $this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
      if($lpd['id_equipment']){
        $ideq = explode(',', $lpd['id_equipment']);
        $this->db->where_in("nkr_kompetensi.coun_kompetensi",$ideq);
      }
      if($lpd['equipment_detil']){
        $ideqdet = explode(',', $lpd['equipment_detil']);
        $this->db->where_in("nkr_kewenangan.coun_kewenangan",$ideqdet);
      }
    }
    if($lpd['jenis_per_laporan_detil'] == 4){
	    $this->db->join('ol_eq_detil', 'ol_eq_detil.id_eq_detil=ol_eq_imut.id_eq_detil','left');
	    $this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_eq_detil.id_equipment','left');
	    if($lpd['id_equipment']){
	      $ideq = explode(',', $lpd['id_equipment']);
	      $this->db->where_in("ol_equipment.coun_equipment",$ideq);
	    }
	    if($lpd['equipment_detil']){
	      $ideqdet = explode(',', $lpd['equipment_detil']);
	      $this->db->where_in("ol_eq_detil.coun_eq_detil",$ideqdet);
	    }
    }
    if($lpd['jenis_per_laporan_detil'] == 5){
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_berkas.id_pegawai','left');
      $this->db->join('ol_berkas_kategori', 'ol_berkas_kategori.id_berkas_kategori=ol_berkas.id_kategori_berkas','left');
      $this->db->join('ol_kategori_pelatihan', 'ol_kategori_pelatihan.id_kategori_pelatihan=ol_berkas.id_kategori_pelatihan','left');
      $this->db->join('kol_pendidikan', 'kol_pendidikan.id_pendidikan=ol_berkas.id_pendidikan','left');
      if($lpd['id_equipment']){
        $ideq = explode(',', $lpd['id_equipment']);
        $this->db->where_in("ol_berkas.id_kategori_berkas",$ideq);
      }
      if($lpd['equipment_detil']){
        $ideqdet = explode(',', $lpd['equipment_detil']);
        $this->db->where_in("ol_berkas.id_berkas",$ideqdet);
      }
    }
    if($grup){
      $this->db->group_by($grup);
    }
    $q = $this->db->get_where($tabel,$kondisi);
    //echo $this->db->last_query();die();
    return $q->result_array();
  }
  function get_min_personal($id,$tabel,$field,$kondisi,$grup=FALSE){
    $lpd = $this->m_ol_rancak->ambil_data_per_laporan_detil($id);
    if($lpd['jenis_per_laporan_detil'] == 2){
      $this->db->join('ol_per_imqc_detil','ol_per_imqc_detil.id_per_imqc_detil=ol_per_imqc_hasil.id_per_imqc_detil','left');
      $this->db->join('ol_per_imqc','ol_per_imqc.id_per_imqc=ol_per_imqc_detil.id_per_imqc','left');
      if($lpd['id_equipment']){
        $ideq = explode(',', $lpd['id_equipment']);
        $this->db->where_in("ol_per_imqc.coun_per_imqc",$ideq);
      }
      if($lpd['equipment_detil']){
        $ideqdet = explode(',', $lpd['equipment_detil']);
        $this->db->where_in("ol_per_imqc_detil.coun_per_imqc_detil",$ideqdet);
      }
    }
    if($lpd['jenis_per_laporan_detil'] == 3){
      $this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');     
      $this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
      if($lpd['id_equipment']){
        $ideq = explode(',', $lpd['id_equipment']);
        $this->db->where_in("nkr_kompetensi.coun_kompetensi",$ideq);
      }
      if($lpd['equipment_detil']){
        $ideqdet = explode(',', $lpd['equipment_detil']);
        $this->db->where_in("nkr_kewenangan.coun_kewenangan",$ideqdet);
      }
    }
    if($lpd['jenis_per_laporan_detil'] == 4){
	    $this->db->join('ol_eq_detil', 'ol_eq_detil.id_eq_detil=ol_eq_imut.id_eq_detil','left');
	    $this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_eq_detil.id_equipment','left');
	    if($lpd['id_equipment']){
	      $ideq = explode(',', $lpd['id_equipment']);
	      $this->db->where_in("ol_equipment.coun_equipment",$ideq);
	    }
	    if($lpd['equipment_detil']){
	      $ideqdet = explode(',', $lpd['equipment_detil']);
	      $this->db->where_in("ol_eq_detil.coun_eq_detil",$ideqdet);
	    }
    }
    if($lpd['jenis_per_laporan_detil'] == 5){
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_berkas.id_pegawai','left');
      $this->db->join('ol_berkas_kategori', 'ol_berkas_kategori.id_berkas_kategori=ol_berkas.id_kategori_berkas','left');
      $this->db->join('ol_kategori_pelatihan', 'ol_kategori_pelatihan.id_kategori_pelatihan=ol_berkas.id_kategori_pelatihan','left');
      $this->db->join('kol_pendidikan', 'kol_pendidikan.id_pendidikan=ol_berkas.id_pendidikan','left');
      if($lpd['id_equipment']){
        $ideq = explode(',', $lpd['id_equipment']);
        $this->db->where_in("ol_berkas.id_kategori_berkas",$ideq);
      }
      if($lpd['equipment_detil']){
        $ideqdet = explode(',', $lpd['equipment_detil']);
        $this->db->where_in("ol_berkas.id_berkas",$ideqdet);
      }
    }
    if($grup){
      $this->db->group_by($grup);
    }
    //echo $this->db->last_query();die();
    $query = $this->db->select("MIN(".$field.") as num")->get_where($tabel,$kondisi);
      $result = $query->row();
      if(isset($result))
        return $result->num;
      return 0;
  }
  function get_max_personal($id,$tabel,$field,$kondisi,$grup=FALSE){
    $lpd = $this->m_ol_rancak->ambil_data_per_laporan_detil($id);
    if($lpd['jenis_per_laporan_detil'] == 2){
      $this->db->join('ol_per_imqc_detil','ol_per_imqc_detil.id_per_imqc_detil=ol_per_imqc_hasil.id_per_imqc_detil','left');
      $this->db->join('ol_per_imqc','ol_per_imqc.id_per_imqc=ol_per_imqc_detil.id_per_imqc','left');
      if($lpd['id_equipment']){
        $ideq = explode(',', $lpd['id_equipment']);
        $this->db->where_in("ol_per_imqc.coun_per_imqc",$ideq);
      }
      if($lpd['equipment_detil']){
        $ideqdet = explode(',', $lpd['equipment_detil']);
        $this->db->where_in("ol_per_imqc_detil.coun_per_imqc_detil",$ideqdet);
      }
    }
    if($lpd['jenis_per_laporan_detil'] == 3){
      $this->db->join('nkr_kewenangan', 'nkr_kewenangan.id_kewenangan=ol_logbook.id_kewenangan','left');     
      $this->db->join('nkr_kompetensi', 'nkr_kompetensi.id_kompetensi=nkr_kewenangan.id_kompetensi','left');
      if($lpd['id_equipment']){
        $ideq = explode(',', $lpd['id_equipment']);
        $this->db->where_in("nkr_kompetensi.coun_kompetensi",$ideq);
      }
      if($lpd['equipment_detil']){
        $ideqdet = explode(',', $lpd['equipment_detil']);
        $this->db->where_in("nkr_kewenangan.coun_kewenangan",$ideqdet);
      }
    }
    if($lpd['jenis_per_laporan_detil'] == 4){
	    $this->db->join('ol_eq_detil', 'ol_eq_detil.id_eq_detil=ol_eq_imut.id_eq_detil','left');
	    $this->db->join('ol_equipment', 'ol_equipment.id_equipment=ol_eq_detil.id_equipment','left');
	    if($lpd['id_equipment']){
	      $ideq = explode(',', $lpd['id_equipment']);
	      $this->db->where_in("ol_equipment.coun_equipment",$ideq);
	    }
	    if($lpd['equipment_detil']){
	      $ideqdet = explode(',', $lpd['equipment_detil']);
	      $this->db->where_in("ol_eq_detil.coun_eq_detil",$ideqdet);
	    }
    }
    if($lpd['jenis_per_laporan_detil'] == 5){
      $this->db->join('ol_pegawai', 'ol_pegawai.id_pegawai=ol_berkas.id_pegawai','left');
      $this->db->join('ol_berkas_kategori', 'ol_berkas_kategori.id_berkas_kategori=ol_berkas.id_kategori_berkas','left');
      $this->db->join('ol_kategori_pelatihan', 'ol_kategori_pelatihan.id_kategori_pelatihan=ol_berkas.id_kategori_pelatihan','left');
      $this->db->join('kol_pendidikan', 'kol_pendidikan.id_pendidikan=ol_berkas.id_pendidikan','left');
      if($lpd['id_equipment']){
        $ideq = explode(',', $lpd['id_equipment']);
        $this->db->where_in("ol_berkas.id_kategori_berkas",$ideq);
      }
      if($lpd['equipment_detil']){
        $ideqdet = explode(',', $lpd['equipment_detil']);
        $this->db->where_in("ol_berkas.id_berkas",$ideqdet);
      }
    }
    if($grup){
      $this->db->group_by($grup);
    }
    //echo $this->db->last_query();die();
    $query = $this->db->select("MAX(".$field.") as num")->get_where($tabel,$kondisi);
      $result = $query->row();
      if(isset($result))
        return $result->num;
      return 0;
  }
//=====================================================
}