<?php
class M_admin_apotek extends CI_model{
	function pabrik_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*";
	//--------- Siapkan Parameter dari datatables ---------
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));
		$order = $this->input->post('order');
		$cari = $this->input->post('search');
	//--------- Cek kolom mana yg di urut dan asc/desc -----
		$col =$order[0]['column'];
		$dir= $order[0]['dir'];

	//--------- Ambil nama field dari daftar POST columns dttables
		$dt_kolom=$this->input->post('columns');

	//--------- Mulai Query UTAMA ---------------------------
		$this->db->select($fields);  //01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan [coding here]
					// case 'telp' : $nmf="peg.telp";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('apt_pabrik');

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'id_ms_code'   : $nmf="kc.id_ms_code";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('apt_pabrik');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('apt_pabrik');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_pabrik(){
		$data_pendaftaran = array(
			'nama_pabrik' => $this->input->post('nama_pabrik'),
			'kontak_pabrik' => $this->input->post('kontak_pabrik'),
			'alamat_pabrik' => $this->input->post('alamat_pabrik'),
			'kode_rekening' => $this->input->post('kode_rekening'),
			'status_pabrik' => $this->input->post('status_pabrik')
		);
		$this->db->insert('apt_pabrik', $data_pendaftaran);
		return $this->db->insert_id();
	}
	function edit_pabrik(){
		$id_pabrik = $this->input->post('id_pabrik');
		$data_pendaftaran = array(
			'nama_pabrik' => $this->input->post('nama_pabrik'),
			'kontak_pabrik' => $this->input->post('kontak_pabrik'),
			'alamat_pabrik' => $this->input->post('alamat_pabrik'),
			'kode_rekening' => $this->input->post('kode_rekening'),
			'status_pabrik' => $this->input->post('status_pabrik')
		);
		$this->db->where('id_pabrik',$id_pabrik);
		$this->db->update('apt_pabrik', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function supplier_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*";
	//--------- Siapkan Parameter dari datatables ---------
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));
		$order = $this->input->post('order');
		$cari = $this->input->post('search');
	//--------- Cek kolom mana yg di urut dan asc/desc -----
		$col =$order[0]['column'];
		$dir= $order[0]['dir'];

	//--------- Ambil nama field dari daftar POST columns dttables
		$dt_kolom=$this->input->post('columns');

	//--------- Mulai Query UTAMA ---------------------------
		$this->db->select($fields);  //01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan [coding here]
					// case 'telp' : $nmf="peg.telp";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('apt_supplier');

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'id_ms_code'   : $nmf="kc.id_ms_code";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('apt_supplier');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('apt_supplier');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_supplier(){
		$data_pendaftaran = array(
			'nama_supplier' => $this->input->post('nama_supplier'),
			'kontak_supplier' => $this->input->post('kontak_supplier'),
			'alamat_supplier' => $this->input->post('alamat_supplier'),
			'status_supplier' => $this->input->post('status_supplier')
		);
		$this->db->insert('apt_supplier', $data_pendaftaran);
		return $this->db->insert_id();
	}
	function edit_supplier(){
		$id_supplier = $this->input->post('id_supplier');
		$data_pendaftaran = array(
			'nama_supplier' => $this->input->post('nama_supplier'),
			'kontak_supplier' => $this->input->post('kontak_supplier'),
			'alamat_supplier' => $this->input->post('alamat_supplier'),
			'status_supplier' => $this->input->post('status_supplier')
		);
		$this->db->where('id_supplier',$id_supplier);
		$this->db->update('apt_supplier', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function customer_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*";
	//--------- Siapkan Parameter dari datatables ---------
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));
		$order = $this->input->post('order');
		$cari = $this->input->post('search');
	//--------- Cek kolom mana yg di urut dan asc/desc -----
		$col =$order[0]['column'];
		$dir= $order[0]['dir'];

	//--------- Ambil nama field dari daftar POST columns dttables
		$dt_kolom=$this->input->post('columns');

	//--------- Mulai Query UTAMA ---------------------------
		$this->db->select($fields);  //01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan [coding here]
					// case 'telp' : $nmf="peg.telp";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('apt_customer');

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'id_ms_code'   : $nmf="kc.id_ms_code";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('apt_customer');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('apt_customer');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_customer(){
		$data_pendaftaran = array(
			'nama_customer' => $this->input->post('nama_customer'),
			'kontak_customer' => $this->input->post('kontak_customer'),
			'alamat_customer' => $this->input->post('alamat_customer'),
			'status_customer' => $this->input->post('status_customer')
		);
		$this->db->insert('apt_customer', $data_pendaftaran);
		return $this->db->insert_id();
	}
	function edit_customer(){
		$id_customer = $this->input->post('id_customer');
		$data_pendaftaran = array(
			'nama_customer' => $this->input->post('nama_customer'),
			'kontak_customer' => $this->input->post('kontak_customer'),
			'alamat_customer' => $this->input->post('alamat_customer'),
			'status_customer' => $this->input->post('status_customer')
		);
		$this->db->where('id_customer',$id_customer);
		$this->db->update('apt_customer', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function barang_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*";
	//--------- Siapkan Parameter dari datatables ---------
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));
		$order = $this->input->post('order');
		$cari = $this->input->post('search');
	//--------- Cek kolom mana yg di urut dan asc/desc -----
		$col =$order[0]['column'];
		$dir= $order[0]['dir'];

	//--------- Ambil nama field dari daftar POST columns dttables
		$dt_kolom=$this->input->post('columns');

	//--------- Mulai Query UTAMA ---------------------------
		$this->db->select($fields);  //01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan [coding here]
					// case 'telp' : $nmf="peg.telp";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('apt_barang');
	    $this->db->join('kol_item_kategori kik', 'kik.id_item_kategori=apt_barang.id_item_kategori','left');

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'id_ms_code'   : $nmf="kc.id_ms_code";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('apt_barang');
	    $this->db->join('kol_item_kategori kik', 'kik.id_item_kategori=apt_barang.id_item_kategori','left');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('apt_barang');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_barang(){
		$kode = $this->m_rancak->kode_generator(15,'');
		$data_pendaftaran = array(
			'nama_barang' => $this->input->post('nama_barang'),
			'barcode_barang' => $kode,
			'id_item_kategori' => $this->input->post('id_item_kategori'),
			'status_barang' => $this->input->post('status_barang')
		);
		$this->db->insert('apt_barang', $data_pendaftaran);
		return $this->db->insert_id();
	}
	function edit_barang(){
		$id_barang = $this->input->post('id_barang');
		$data_pendaftaran = array(
			'nama_barang' => $this->input->post('nama_barang'),
			'id_item_kategori' => $this->input->post('id_item_kategori'),
			'status_barang' => $this->input->post('status_barang')
		);
		$this->db->where('id_barang',$id_barang);
		$this->db->update('apt_barang', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function termin_all()
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*";
	//--------- Siapkan Parameter dari datatables ---------
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));
		$order = $this->input->post('order');
		$cari = $this->input->post('search');
	//--------- Cek kolom mana yg di urut dan asc/desc -----
		$col =$order[0]['column'];
		$dir= $order[0]['dir'];

	//--------- Ambil nama field dari daftar POST columns dttables
		$dt_kolom=$this->input->post('columns');

	//--------- Mulai Query UTAMA ---------------------------
		$this->db->select($fields);  //01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan [coding here]
					// case 'telp' : $nmf="peg.telp";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

	    $this->db->from('kol_termin');

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'id_ms_code'   : $nmf="kc.id_ms_code";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('kol_termin');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('kol_termin');		//[coding here] ganti tabel utamanya

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}
	function simpan_termin(){
		$data_pendaftaran = array(
			'nama_termin' => $this->input->post('nama_termin'),
			'tempo_termin' => $this->input->post('tempo_termin'),
			'ket_termin' => $this->input->post('ket_termin'),
			'status_termin' => $this->input->post('status_termin')
		);
		$this->db->insert('kol_termin', $data_pendaftaran);
		return $this->db->insert_id();
	}
	function edit_termin(){
		$id_termin = $this->input->post('id_termin');
		$data_pendaftaran = array(
			'nama_termin' => $this->input->post('nama_termin'),
			'tempo_termin' => $this->input->post('tempo_termin'),
			'ket_termin' => $this->input->post('ket_termin'),
			'status_termin' => $this->input->post('status_termin')
		);
		$this->db->where('id_termin',$id_termin);
		$this->db->update('kol_termin', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows())
			return(FALSE);
		else
			return(TRUE);
	}
	function order_beli_all($date,$first_date,$last_date,$all)
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,DATE_FORMAT(tgl_pembelian,'%d-%m-%Y') as tgl_pembelian,if (status_pembelian = '1' ,'Done','Proses') as status_pembelian,
					if (pajak = '0' ,'Tanpa Pajak',if (pajak = '1' ,'Belum Pajak','Pajak')) as pajak,FORMAT(diskon_pembelian,'#,###,##0') as diskon_pembelian,if (app.id_termin = '0' ,'CASH',nama_termin) as nama_termin,
					FORMAT(subtotal_pembelian,'#,###,##0') as subtotal_pembelian,FORMAT(ppn_pembelian,'#,###,##0') as ppn_pembelian,
					FORMAT(total_pembelian,'#,###,##0') as total_pembelian,alamat_cp as address";
	//--------- Siapkan Parameter dari datatables ---------
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));
		$order = $this->input->post('order');
		$cari = $this->input->post('search');
	//--------- Cek kolom mana yg di urut dan asc/desc -----
		$col =$order[0]['column'];
		$dir= $order[0]['dir'];

	//--------- Ambil nama field dari daftar POST columns dttables
		$dt_kolom=$this->input->post('columns');

	//--------- Mulai Query UTAMA ---------------------------
		$this->db->select($fields);  //01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan [coding here]
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		if($date > 0){
		$this->db->where('tgl_pembelian BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		}
		if($all !== 'All'){
		$this->db->where('status_pembelian', $all);
		}
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by
		
	    $this->db->from('apt_pembelian app');
		$this->db->join('apt_supplier aps', 'aps.id_supplier=app.id_supplier','left');
		$this->db->join('kol_termin kt', 'kt.id_termin=app.id_termin','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=app.id_pegawai','left');
		if($date > 0){
		$this->db->where('tgl_pembelian BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		}
		if($all !== 'All'){
		$this->db->where('status_pembelian', $all);
		}
		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'no_hp' : $nmf="peg.no_hp";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		if($date > 0){
		$this->db->where('tgl_pembelian BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		}
		if($all !== 'All'){
		$this->db->where('status_pembelian', $all);
		}
			}
		  }
		}

	//  Tuliskan yang bakal di search saja. Yang tidak tidak usah ditulis. Cek di jscode mana yg searchable
	    $this->db->from('apt_pembelian app');
		$this->db->join('apt_supplier aps', 'aps.id_supplier=app.id_supplier','left');
		$this->db->join('kol_termin kt', 'kt.id_termin=app.id_termin','left');
		$this->db->join('ol_pegawai peg', 'peg.id_pegawai=app.id_pegawai','left');
		if($date > 0){
		$this->db->where('tgl_pembelian BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
		}
		if($all !== 'All'){
		$this->db->where('status_pembelian', $all);
		}	
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
		if($date > 0){
			$kondisi=('tgl_pembelian BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
			$jml = $this->m_umum->jumlah_record_filter('apt_pembelian',$kondisi);
		}else{
			$jml = $this->m_umum->jumlah_record_tabel('apt_pembelian');
		}

				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;	
	}
	function simpan_pembelian(){
		$tgl_pembelian = $this->input->post('tgl_pembelian');
		$tgl_pembelian = date('Y-m-d', strtotime($tgl_pembelian));	
		$kode = $this->m_rancak->kode_generator(15,'PB');
		$data_pendaftaran = array(
			'barcode_pembelian' => $kode,
			'tgl_pembelian' => $tgl_pembelian,
			'no_pembelian' => $this->input->post('no_pembelian'),
			'id_supplier' => $this->input->post('id_supplier'),
			'ket_pembelian' => $this->input->post('ket_pembelian'),
			'cp' => $this->input->post('cp'),
			'id_termin' => $this->input->post('id_termin')
		);
		$this->db->insert('apt_pembelian', $data_pendaftaran);
		return $kode;
	}
	function edit_pembelian(){
		$id_pembelian = $this->input->post('id_pembelian');
		$tgl_pembelian = $this->input->post('tgl_pembelian');
		$tgl_pembelian = date('Y-m-d', strtotime($tgl_pembelian));

		$pajak = $this->input->post('pajak');
		$persen_pembelian = $this->input->post('persen_pembelian');

		$subtotal_pembelian = $this->input->post('subtotal_pembelian');
		$subtotal_pembelian	= str_replace("'","&acute;",$subtotal_pembelian);
		$subtotal_pembelian	= str_replace(".","",$subtotal_pembelian);
		$subtotal_pembelian	= str_replace(" ","",$subtotal_pembelian);
		$subtotal_pembelian	= str_replace(",","",$subtotal_pembelian);

		$diskon_pembelian = $this->input->post('diskon_pembelian');
		$diskon_pembelian	= str_replace("'","&acute;",$diskon_pembelian);
		$diskon_pembelian	= str_replace(".","",$diskon_pembelian);
		$diskon_pembelian	= str_replace(" ","",$diskon_pembelian);
		$diskon_pembelian	= str_replace(",","",$diskon_pembelian);		

		$ppn_pembelian = $this->input->post('ppn_pembelian');
		$ppn_pembelian	= str_replace("'","&acute;",$ppn_pembelian);
		$ppn_pembelian	= str_replace(".","",$ppn_pembelian);
		$ppn_pembelian	= str_replace(" ","",$ppn_pembelian);
		$ppn_pembelian	= str_replace(",","",$ppn_pembelian);

		$total_pembelian = $this->input->post('total_pembelian');
		$total_pembelian	= str_replace("'","&acute;",$total_pembelian);
		$total_pembelian	= str_replace(".","",$total_pembelian);
		$total_pembelian	= str_replace(" ","",$total_pembelian);
		$total_pembelian	= str_replace(",","",$total_pembelian);

				if ($persen_pembelian == 0) {
					$percentase = $diskon_pembelian;		
				}else{
					$percentase = $subtotal_pembelian * $diskon_pembelian/100;
				}
				$sub_total = $subtotal_pembelian - $percentase;
				if ($pajak == 0) { 
					$pajak = 0;
					$ppn_pembelian = $pajak;
					$total_pembelian = $sub_total;
				}else if($pajak == 2) { 
					$dpp = $sub_total * 100/110;			
					$pajak = 10/100 * $dpp;			
					$ppn_pembelian = round($pajak,3);
					$total_pembelian = round($pajak,3) + $sub_total;
				}else{
					$pajak = $sub_total * 10/100;
					$ppn_pembelian = round($pajak,3);
					$total_pembelian = $sub_total;			
				}

		$data_pendaftaran = array(
			'tgl_pembelian' => $tgl_pembelian,
			'no_pembelian' => $this->input->post('no_pembelian'),
			'id_supplier' => $this->input->post('id_supplier'),
			'ket_pembelian' => $this->input->post('ket_pembelian'),
			'alamat_cp' => $this->input->post('alamat_cp'),
			'cp' => $this->input->post('cp'),
			'id_termin' => $this->input->post('id_termin'),
			'pajak' => $this->input->post('pajak'),
			'subtotal_pembelian' => $subtotal_pembelian,
			'ppn_pembelian' => $ppn_pembelian,
			'total_pembelian' => $total_pembelian
		);
		$this->db->where('id_pembelian',$id_pembelian);
		$this->db->update('apt_pembelian', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}
	function simpan_pembelian_detil($kode){
		$tgl_pembelian = $this->input->post('tgl_pembelian');
		$tglpth = date('Y', strtotime($tgl_pembelian));	
		$tglpbl = date('m', strtotime($tgl_pembelian));	
		$tglphr = date('d', strtotime($tgl_pembelian));	
		$tgl_expired = $this->input->post('tgl_expired');
		$tgleth = date('Y', strtotime($tgl_expired));	
		$tglebl = date('m', strtotime($tgl_expired));	
		$tglehr = date('d', strtotime($tgl_expired));		
		$kode_all = $kode .'-'. $tglphr . $tglpbl . $tglpth .'-'. $tglehr . $tglebl . $tgleth;
		$tgl_expired = $this->input->post('tgl_expired');
		$tgl_expired = date('Y-m-d', strtotime($tgl_expired));

		$konversi = $this->input->post('konversi');
		$konversi	= str_replace("'","&acute;",$konversi);
		$konversi	= str_replace(".","",$konversi);
		$konversi	= str_replace(" ","",$konversi);
		$konversi	= str_replace(",","",$konversi);

		$jml_pembelian_detil = $this->input->post('jml_pembelian_detil');
		$jml_pembelian_detil	= str_replace("'","&acute;",$jml_pembelian_detil);
		$jml_pembelian_detil	= str_replace(".","",$jml_pembelian_detil);
		$jml_pembelian_detil	= str_replace(" ","",$jml_pembelian_detil);
		$jml_pembelian_detil	= str_replace(",","",$jml_pembelian_detil);

		$harga_pembelian_detil = $this->input->post('harga_pembelian_detil');
		$harga_pembelian_detil	= str_replace("'","&acute;",$harga_pembelian_detil);
		$harga_pembelian_detil	= str_replace(".","",$harga_pembelian_detil);
		$harga_pembelian_detil	= str_replace(" ","",$harga_pembelian_detil);
		$harga_pembelian_detil	= str_replace(",","",$harga_pembelian_detil);

		$diskon_pembelian_detil = $this->input->post('diskon_pembelian_detil');
		$diskon_pembelian_detil	= str_replace("'","&acute;",$diskon_pembelian_detil);
		$diskon_pembelian_detil	= str_replace(".","",$diskon_pembelian_detil);
		$diskon_pembelian_detil	= str_replace(" ","",$diskon_pembelian_detil);
		$diskon_pembelian_detil	= str_replace(",","",$diskon_pembelian_detil);

		$total_pembelian_detil = $this->input->post('total_pembelian_detil');
		$total_pembelian_detil	= str_replace("'","&acute;",$total_pembelian_detil);
		$total_pembelian_detil	= str_replace(".","",$total_pembelian_detil);
		$total_pembelian_detil	= str_replace(" ","",$total_pembelian_detil);
		$total_pembelian_detil	= str_replace(",","",$total_pembelian_detil);

		$data_pendaftaran = array(
			'barcode_pembelian_detil' => $kode_all,
			'tgl_expired' => $tgl_expired,
			'id_barang' => $this->input->post('id_barang'),
			'id_pabrik' => $this->input->post('id_pabrik'),
			'id_pembelian' => $this->input->post('id_pembelian'),
			'satuan_besar' => $this->input->post('satuan_besar'),
			'satuan_kecil' => $this->input->post('satuan_kecil'),
			'persen_pembelian_detil' => $this->input->post('persen_pembelian_detil'),
			'ket_pembelian_detil' => $this->input->post('ket_pembelian_detil'),
			'konversi' => $konversi,
			'jml_pembelian_detil' => $jml_pembelian_detil,
			'harga_pembelian_detil' => $harga_pembelian_detil,
			'diskon_pembelian_detil' => $diskon_pembelian_detil,
			'total_pembelian_detil' => $total_pembelian_detil,
		);
		$this->db->insert('apt_pembelian_detil', $data_pendaftaran);
		return $this->db->insert_id();
	}
    function jumlah_record_pembelian_detil($id)    //igd.php untuk menampilkan jumlah antrian di igd saja
    {
        $query = $this->db->select("SUM(total_pembelian_detil) as num")->get_where('apt_pembelian_detil',array('id_pembelian'=>$id));
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
    }
	function edit_pembelian2(){
		$id_pembelian = $this->input->post('id_pembelian');
		$jml = $this->jumlah_record_pembelian_detil($id_pembelian);		
		$tgl_pembelian = $this->input->post('tgl_pembelian');
		$tgl_pembelian = date('Y-m-d', strtotime($tgl_pembelian));

		$pajak = $this->input->post('pajak');
		$persen_pembelian = $this->input->post('persen_pembelian');

		$subtotal_pembelian = $jml;

		$diskon_pembelian = $this->input->post('diskon_pembelian');
		$diskon_pembelian	= str_replace("'","&acute;",$diskon_pembelian);
		$diskon_pembelian	= str_replace(".","",$diskon_pembelian);
		$diskon_pembelian	= str_replace(" ","",$diskon_pembelian);
		$diskon_pembelian	= str_replace(",","",$diskon_pembelian);		

		$ppn_pembelian = $this->input->post('ppn_pembelian');
		$ppn_pembelian	= str_replace("'","&acute;",$ppn_pembelian);
		$ppn_pembelian	= str_replace(".","",$ppn_pembelian);
		$ppn_pembelian	= str_replace(" ","",$ppn_pembelian);
		$ppn_pembelian	= str_replace(",","",$ppn_pembelian);

		$total_pembelian = $this->input->post('total_pembelian');
		$total_pembelian	= str_replace("'","&acute;",$total_pembelian);
		$total_pembelian	= str_replace(".","",$total_pembelian);
		$total_pembelian	= str_replace(" ","",$total_pembelian);
		$total_pembelian	= str_replace(",","",$total_pembelian);

				if ($persen_pembelian == 0) {
					$percentase = $diskon_pembelian;		
				}else{
					$percentase = $subtotal_pembelian * $diskon_pembelian/100;
				}
				$sub_total = $subtotal_pembelian - $percentase;
				if ($pajak == 0) { 
					$pajak = 0;
					$ppn_pembelian = $pajak;
					$total_pembelian = $sub_total;
				}else if($pajak == 2) { 
					$dpp = $sub_total * 100/110;			
					$pajak = 10/100 * $dpp;			
					$ppn_pembelian = round($pajak,3);
					$total_pembelian = $pajak + $sub_total;
				}else{
					$pajak = $sub_total * 10/100;
					$ttotal = $sub_total + round($pajak,3);
					$ppn_pembelian = round($pajak,3);
					$total_pembelian = $sub_total;			
				}

		$data_pendaftaran = array(
			'tgl_pembelian' => $tgl_pembelian,
			'no_pembelian' => $this->input->post('no_pembelian'),
			'id_supplier' => $this->input->post('id_supplier'),
			'ket_pembelian' => $this->input->post('ket_pembelian'),
			'alamat_cp' => $this->input->post('alamat_cp'),
			'cp' => $this->input->post('cp'),
			'id_termin' => $this->input->post('id_termin'),
			'pajak' => $this->input->post('pajak'),
			'subtotal_pembelian' => $subtotal_pembelian,
			'ppn_pembelian' => $ppn_pembelian,
			'total_pembelian' => $total_pembelian
		);
		$this->db->where('id_pembelian',$id_pembelian);
		$this->db->update('apt_pembelian', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}
	function ambil_temp_pembelian_detil(){	
		$q = $this->db->get_where('temp_pembelian_detil',array('temp'=>$this->session->temp));	
		return $q->result_array();	
	}
	function ambil_temp_ob_detil($id){	
		$this->db->select("*,if(persen_pembelian_detil = 0,'Rupiah','Persen') as persen_pembelian_detil");
		$this->db->join('kol_satuan ksb', 'ksb.id_satuan=apt_pembelian_detil.satuan_kecil','left');
		$this->db->join('kol_satuan ksa', 'ksa.id_satuan=apt_pembelian_detil.satuan_besar','left');
		$this->db->join('apt_pabrik ap', 'ap.id_pabrik=apt_pembelian_detil.id_pabrik','left');
		$this->db->join('apt_barang kb', 'kb.id_barang=apt_pembelian_detil.id_barang','left');
		$q = $this->db->get_where('apt_pembelian_detil',array('id_pembelian'=>$id));	
		return $q->result_array();	
	}
	function simpan_tmp_simpan_pembelian($id,$sup,$term,$ket){
		$tgl_pembelian = $this->input->post('tgl_pembelian');
		$tgl_pembelian = date('Y-m-d', strtotime($tgl_pembelian));
		if(empty($term)){
			$term = "CASH";
		}
		$data_pendaftaran = array(
			'tgl_pembelian' => $tgl_pembelian,
			'id_pembelian' => $id,
			'no_pembelian' => $this->input->post('no_pembelian'),
			'supplier' => $sup,
			'termin' => $term,
			'cp' => $this->input->post('cp'),
			'alamat_cp' => $this->input->post('alamat_cp'),
			'ket_temp_pembelian' => $ket
		);
		return $this->db->insert('temp_pembelian', $data_pendaftaran);
	}
	function edit_tmp_pembelian(){
		$temp = $this->session->temp;
		$data_pendaftaran = array(
			'tgl_pembelian' => $tgl_pembelian,
			'no_pembelian' => $this->input->post('no_pembelian'),
			'id_supplier' => $this->input->post('id_supplier'),
			'id_termin' => $this->input->post('id_termin'),
			'ket_pembelian' => $this->input->post('ket_pembelian'),
			'pajak' => $this->input->post('pajak'),
			'cp' => $this->input->post('cp'),
			'alamat_cp' => $this->input->post('alamat_cp'),
		);
		$this->db->where('temp',$temp);
		$this->db->update('temp_pembelian', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}
	function edit_apt_stok_hapus($bc,$id){
		$kondisi=array('id_pembelian_detil'=>$id);
		$pmbdtl = $this->m_umum->ambil_data_kondisi('apt_pembelian_detil',$kondisi);

		$jml = $this->jumlah_record_apt_stok($bc);
		$jml_pembelian_detil = $pmbdtl['jml_pembelian_detil'];
		$qty = $jml - $jml_pembelian_detil;
		$data_pendaftaran = array(
			'qty' => $qty
		);
		$this->db->where('barcode_pembelian_detil',$bc);
		$this->db->update('apt_stok', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}
	function edit_pembelian_dari_detil_hapus($id){
		$pdtl = $this->m_umum->ambil_data('apt_pembelian','barcode_pembelian',$id);
		$id_pembelian = $pdtl['id_pembelian'];
		$kondisi=array('id_pembelian'=>$id_pembelian);
		$pmb = $this->m_umum->ambil_data_kondisi('apt_pembelian',$kondisi);

		$persen_pembelian = $pmb['persen_pembelian'];
		$diskon_pembelian = $pmb['diskon_pembelian'];
		$ppn_pembelian = $pmb['ppn_pembelian'];
		$total_pembelian = $pmb['total_pembelian'];
		$jml = $this->jumlah_record_pembelian_detil($id_pembelian);
		$subtotal_pembelian = $jml;
		if($jml == 0){
			$persen_pembelian = 0;
			$diskon_pembelian = 0;
			$subtotal_pembelian = 0;
			$ppn_pembelian = 0;
			$total_pembelian = 0;
		}else{
			if ($persen_pembelian == 0) {
				$percentase = $diskon_pembelian;		
			}else{
				$percentase = $subtotal_pembelian * $diskon_pembelian/100;
			}
			$sub_total = $subtotal_pembelian - $percentase;
			if ($pmb['pajak'] == 0) { 
				$pajak = 0;
				$ppn_pembelian = $pajak;
				$total_pembelian = $sub_total;
			}else if($pmb['pajak'] == 2) { 
				$dpp = $sub_total * 100/110;			
				$pajak = 10/100 * $dpp;			
				$ppn_pembelian = round($pajak,0);
				$total_pembelian = $pajak + $sub_total;
			}else{
				$pajak = $sub_total * 10/100;
				$ttotal = $sub_total + round($pajak,0);
				$ppn_pembelian = round($pajak,0);
				$total_pembelian = $sub_total;			
			}
		}
		$data_pendaftaran = array(
			'diskon_pembelian' => $diskon_pembelian,
			'persen_pembelian' => $persen_pembelian,
			'subtotal_pembelian' => $subtotal_pembelian,
			'ppn_pembelian' => $ppn_pembelian,
			'total_pembelian' => $total_pembelian
		);
		$this->db->where('id_pembelian',$id_pembelian);
		$this->db->update('apt_pembelian', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}
	function edit_diskon_pembelian(){
		$id_pembelian = $this->input->post('id_pembelian');
		$persen_pembelian = $this->input->post('persen_pembelian');
		$diskon_pembelian = $this->input->post('diskon_pembelian');
		$diskon_pembelian	= str_replace("'","&acute;",$diskon_pembelian);
		$diskon_pembelian	= str_replace(".","",$diskon_pembelian);
		$diskon_pembelian	= str_replace(" ","",$diskon_pembelian);
		$diskon_pembelian	= str_replace(",","",$diskon_pembelian);
		$kondisi=array('id_pembelian'=>$id_pembelian);
		$pmb = $this->m_umum->ambil_data_kondisi('apt_pembelian',$kondisi);
		$ppn_pembelian = $pmb['ppn_pembelian'];
		$total_pembelian = $pmb['total_pembelian'];
		$subtotal_pembelian = $pmb['subtotal_pembelian'];

				if ($persen_pembelian == 0) {
					$percentase = $diskon_pembelian;		
				}else{
					$percentase = $pmb['subtotal_pembelian'] * $diskon_pembelian/100;
				}
				$sub_total = $pmb['subtotal_pembelian'] - $percentase;
				if ($pmb['pajak'] == 0) { 
					$pajak = 0;
					$ppn_pembelian = $pajak;
					$total_pembelian = $sub_total;
				}else if($pmb['pajak'] == 2) { 
					$dpp = $sub_total * 100/110;			
					$pajak = 10/100 * $dpp;			
					$ppn_pembelian = round($pajak,0);
					$total_pembelian = $pajak + $sub_total;
				}else{
					$pajak = $sub_total * 10/100;
					$ttotal = $sub_total + round($pajak,0);
					$ppn_pembelian = round($pajak,0);
					$total_pembelian = $sub_total;			
				}

		$data_pendaftaran = array(
			'diskon_pembelian' => $diskon_pembelian,
			'persen_pembelian' => $persen_pembelian,
			'subtotal_pembelian' => $subtotal_pembelian,
			'ppn_pembelian' => $ppn_pembelian,
			'total_pembelian' => $total_pembelian
		);
		$this->db->where('id_pembelian',$id_pembelian);
		$this->db->update('apt_pembelian', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}
	function edit_harga_jual_stok(){
		$barcode_pembelian_detil = $this->input->post('barcode_pembelian_detil');
		$harga_jual = $this->input->post('harga_jual');
		$harga_jual	= str_replace("'","&acute;",$harga_jual);
		$harga_jual	= str_replace(".","",$harga_jual);
		$harga_jual	= str_replace(" ","",$harga_jual);
		$harga_jual	= str_replace(",","",$harga_jual);
		$data_pendaftaran = array(
			'harga_jual' => $harga_jual
		);
		$this->db->where('barcode_pembelian_detil',$barcode_pembelian_detil);
		$this->db->update('apt_stok', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}
	function simpan_apt_stok($id){
		$data_pendaftaran = array(
			'barcode_pembelian_detil' => $id,
			'id_barang' => $this->input->post('id_barang'),
			'qty' => $this->input->post('jml_pembelian_detil')
		);
		return $this->db->insert('apt_stok', $data_pendaftaran);
	}
	function edit_apt_stok($id){
		$jml = $this->jumlah_record_apt_stok($id);
		$jml_pembelian_detil = $this->input->post('jml_pembelian_detil');
		$qty = $jml_pembelian_detil + $jml;
		$data_pendaftaran = array(
			'qty' => $qty
		);
		$this->db->where('barcode_pembelian_detil',$id);
		$this->db->update('apt_stok', $data_pendaftaran);
		//echo $this->db->last_query();
		$this->db->trans_complete();	// untuk cek sukses update tidak
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
		// if (!$this->db->affected_rows()) 
			return(FALSE);
		else 
			return(TRUE);	
	}
    function jumlah_record_apt_stok($id)    //igd.php untuk menampilkan jumlah antrian di igd saja
    {
        $query = $this->db->select("SUM(qty) as num")->get_where('apt_stok',array('barcode_pembelian_detil'=>$id));
        $result = $query->row();
        if(isset($result))
            return $result->num;
        return 0;
    }
	function simpan_temp_pembelian_detil(){
		$tgl_order_beli = $this->input->post('tgl_order_beli');
		$tgl_order_beli = date('Y-m-d', strtotime($tgl_order_beli));	
		$harga_ob_detil = $this->input->post('harga_ob_detil');
		$harga_ob_detil	= str_replace("'","&acute;",$harga_ob_detil);
		$harga_ob_detil	= str_replace(".","",$harga_ob_detil);
		$harga_ob_detil	= str_replace(" ","",$harga_ob_detil);
		$harga_ob_detil	= str_replace(",","",$harga_ob_detil);
		$persen_ob_detil = $this->input->post('persen_ob_detil');
		$diskon_ob_detil = $this->input->post('diskon_ob_detil');
		$diskon_ob_detil	= str_replace("'","&acute;",$diskon_ob_detil);
		$diskon_ob_detil	= str_replace(".","",$diskon_ob_detil);
		$diskon_ob_detil	= str_replace(" ","",$diskon_ob_detil);
		$diskon_ob_detil	= str_replace(",","",$diskon_ob_detil);	
		$total_ob_detil = $this->input->post('total_ob_detil');
		$total_ob_detil	= str_replace("'","&acute;",$total_ob_detil);
		$total_ob_detil	= str_replace(".","",$total_ob_detil);
		$total_ob_detil	= str_replace(" ","",$total_ob_detil);
		$total_ob_detil	= str_replace(",","",$total_ob_detil);	
		$jml_last_id = $this->num_last_temp_ob();
		if($jml_last_id == 0){
			$ide = 1;
		}else{
			$last_id = $this->get_last_temp_ob();
			$ide = $last_id['id_temp_ob_detil'] + 1;			
		}
		if ($diskon_ob_detil > 0 && $persen_ob_detil > 0 ) {
			$diskon_ob_detil = 0;
		}
		$data_pendaftaran = array(
			'id_temp_ob_detil' => $ide,
			'tgl_order_beli' => $tgl_order_beli,
			'no_order_beli' => $this->input->post('no_order_beli'),
			'id_dk' => $this->input->post('id_dk'),
			'id_unit' => $this->input->post('id_unit'),
			'id_termin' => $this->input->post('id_termin'),
			'ket_order_beli' => $this->input->post('ket_order_beli'),
			'pajak' => $this->input->post('pajak'),
			'kontak' => $this->input->post('kontak'),
			'alamat' => $this->input->post('alamat'),
			'id_barang' => $this->input->post('id_barang'),
			'merk_ob_detil' => $this->input->post('merk_ob_detil'),
			'jml_ob_detil' => $this->input->post('jml_ob_detil'),
			'persen_ob_detil' => $persen_ob_detil,
			'satuan_besar' => $this->input->post('satuan_besar'),
			'konversi' => $this->input->post('konversi'),
			'satuan_kecil' => $this->input->post('satuan_kecil'),
			'ket_ob_detil' => $this->input->post('ket_ob_detil'),
			'harga_ob_detil' => $harga_ob_detil,
			'diskon_ob_detil' => $diskon_ob_detil,
			'total_ob_detil' => $total_ob_detil,
			'id_user' => $this->session->id_user,
			'temp' => $this->session->temp
		);
		return $this->db->insert('temp_ob_detil', $data_pendaftaran);
	}
	function pembelian_detil_all($id)
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "*,DATE_FORMAT(tgl_expired,'%d-%m-%Y') as tgl_expired,ks.nama_satuan as satuan_kecil,ks2.nama_satuan as satuan_besar,
					FORMAT(harga_pembelian_detil,'#,###,##0') as harga_pembelian_detil,
					FORMAT(diskon_pembelian_detil,'#,###,##0') as diskon_pembelian_detil,
					FORMAT(total_pembelian_detil,'#,###,##0') as total_pembelian_detil,FORMAT(harga_jual,'#,###,##0') as harga_jual,
					if(persen_pembelian_detil = '1' ,'Persen','Rupiah') as persen_pembelian_detil,
					if(persen_pembelian_detil = '1' ,CONCAT(FORMAT(diskon_pembelian_detil,'#,###,##0'),'%'),CONCAT('Rp.',FORMAT(diskon_pembelian_detil,'#,###,##0'))) as diskon_pembelian_detil,
					if(status_pembelian = '1' ,'Done','Proses') as status_pembelian";
	//--------- Siapkan Parameter dari datatables ---------
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));
		$order = $this->input->post('order');
		$cari = $this->input->post('search');
	//--------- Cek kolom mana yg di urut dan asc/desc -----
		$col =$order[0]['column'];
		$dir= $order[0]['dir'];

	//--------- Ambil nama field dari daftar POST columns dttables
		$dt_kolom=$this->input->post('columns');

	//--------- Mulai Query UTAMA ---------------------------
		$this->db->select($fields);  //01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan [coding here]
					// case 'id_level'   : $nmf="u.id_level";break;
				default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('app.barcode_pembelian', $id);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by
		
	    $this->db->from('apt_pembelian_detil apd');
		$this->db->join('apt_pembelian app', 'app.id_pembelian=apd.id_pembelian','left');
		$this->db->join('apt_barang ab', 'ab.id_barang=apd.id_barang','left');
		$this->db->join('apt_pabrik ap', 'ap.id_pabrik=apd.id_pabrik','left');
		$this->db->join('kol_satuan ks', 'ks.id_satuan=apd.satuan_kecil','left');
		$this->db->join('kol_satuan ks2', 'ks2.id_satuan=apd.satuan_besar','left');
		$this->db->join('apt_stok ast', 'ast.barcode_pembelian_detil=apd.barcode_pembelian_detil','left');
		$this->db->where('app.barcode_pembelian', $id);

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
				//	case 'no_hp' : $nmf="peg.no_hp";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
		$this->db->where('app.barcode_pembelian', $id);
			}
		  }
		}

	    $this->db->from('apt_pembelian_detil apd');
		$this->db->join('apt_pembelian app', 'app.id_pembelian=apd.id_pembelian','left');
		$this->db->join('apt_barang ab', 'ab.id_barang=apd.id_barang','left');
		$this->db->join('apt_pabrik ap', 'ap.id_pabrik=apd.id_pabrik','left');
		$this->db->join('kol_satuan ks', 'ks.id_satuan=apd.satuan_kecil','left');
		$this->db->join('kol_satuan ks2', 'ks2.id_satuan=apd.satuan_besar','left');
		$this->db->join('apt_stok ast', 'ast.barcode_pembelian_detil=apd.barcode_pembelian_detil','left');
		$this->db->where('app.barcode_pembelian', $id);

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil

	//--------- Query jumlah All data paling banyak -----
/*		if($date > 0){
			$kondisi=('tgl_pembelian BETWEEN "'. date('Y-m-d', strtotime($first_date)). '" and "'. date('Y-m-d', strtotime($last_date)).'"');
			$jml = $this->m_umum->jumlah_record_filter('apt_pembelian',$kondisi);
		}else{*/
			$jml = $this->m_umum->jumlah_record_tabel('apt_pembelian_detil');
	//	}

				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;	
	}
}
