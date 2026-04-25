<?php
class M_ol_registrasi extends CI_model{
	function simpan_barcode_registrasi($kode){
		$no_hp = $this->input->post('no_hp');
		$status_perawat = $this->input->post('status_perawat');
		if($status_perawat == 0){
			$id_kode_kewenangan = '0';
		}else{
			$id_kode_kewenangan = $this->input->post('id_kode_kewenangan');
		}
		$ptn = "/^0/";
		$rpltxt = "62";  // Replacement string
		$cp = preg_replace($ptn, $rpltxt, $no_hp);
		$tgl_lahir = $this->input->post('tgl_lahir');
		$tgl_lahir = date('Y-m-d', strtotime($tgl_lahir));
		$data_pendaftaran = array(
			'id_instansi' => $this->input->post('id_instansi'),
			'nama_pegawai' => $this->input->post('nama_pegawai'),
			'jk' => $this->input->post('jk'),
			'tmp_lahir' => $this->input->post('tmp_lahir'),
			'tgl_lahir' => $tgl_lahir,
			'email' => $this->input->post('email'),
			'no_hp' => $this->input->post('no_hp'),
			'nik' => $this->input->post('nik'),
			'id_pengcab' => $this->input->post('id_pengcab'),
			'nip' => $this->input->post('nip'),
			'id_prov' => $this->input->post('id_prov'),
			'tipe_pegawai' => $this->input->post('tipe_pegawai'),
			'id_kab' => $this->input->post('id_kab'),
			'id_kec' => $this->input->post('id_kec'),
			'id_kel' => $this->input->post('id_kel'),
			'no_profesi' => $this->input->post('no_profesi'),
			'id_status_kawin' => $this->input->post('id_status_kawin'),
			'id_agama' => $this->input->post('id_agama'),
			'id_pendidikan' => $this->input->post('id_pendidikan'),
			'id_jabatan_fungsional' => $this->input->post('id_jabatan_fungsional'),
			'id_kode_kewenangan' => $id_kode_kewenangan,
			'status_perawat' => $status_perawat,
			'alamat' => $this->input->post('alamat'),
			'username' => $this->input->post('username'),
			'wkt_simpan' => date('Y-m-d H:i:s'),
			'status_registrasi' =>1,
			'cp' => $no_hp,
			'barcode_registrasi' => $kode
		);
		return $this->db->insert('ol_registrasi', $data_pendaftaran);
	}
	function rubah_registrasi(){
		$barcode_registrasi = $this->input->post( 'barcode_registrasi');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$tgl_lahir = date('Y-m-d', strtotime($tgl_lahir));
		$status_perawat = $this->input->post('status_perawat');
		if($status_perawat == 0){
			$id_kode_kewenangan = '0';
		}else{
			$id_kode_kewenangan = $this->input->post('id_kode_kewenangan');
		}
		$data_pendaftaran = array(
			'id_instansi' => $this->input->post('id_instansi'),
			'nama_pegawai' => $this->input->post('nama_pegawai'),
			'jk' => $this->input->post('jk'),
			'tmp_lahir' => $this->input->post('tmp_lahir'),
			'tgl_lahir' => $tgl_lahir,
			'email' => $this->input->post('email'),
			'no_hp' => $this->input->post('no_hp'),
			'id_pengcab' => $this->input->post('id_pengcab'),
			'nik' => $this->input->post('nik'),
			'nip' => $this->input->post('nip'),
			'id_prov' => $this->input->post('id_prov'),
			'id_kab' => $this->input->post('id_kab'),
			'id_kec' => $this->input->post('id_kec'),
			'id_kel' => $this->input->post('id_kel'),
			'tipe_pegawai' => $this->input->post('tipe_pegawai'),
			'no_profesi' => $this->input->post('no_profesi'),
			'id_status_kawin' => $this->input->post('id_status_kawin'),
			'id_agama' => $this->input->post('id_agama'),
			'id_pendidikan' => $this->input->post('id_pendidikan'),
			'id_jabatan_fungsional' => $this->input->post('id_jabatan_fungsional'),
			'alamat' => $this->input->post('alamat'),
			'username' => $this->input->post('username'),
			'id_kode_kewenangan' => $id_kode_kewenangan,
			'status_perawat' => $status_perawat,
			'wkt_simpan' => date('Y-m-d H:i:s'),
			'status_registrasi' =>1
		);
		$this->db->where('barcode_registrasi',$barcode_registrasi);
		$this->db->update('ol_registrasi', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
}